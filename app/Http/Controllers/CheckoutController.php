<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $settings = Setting::getShopSettings();
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang belanja Anda masih kosong. Silakan pilih kopi favorit Anda terlebih dahulu.');
        }

        // Re-calculate subtotal strictly from DB
        $subtotal = 0;
        $cartItems = [];

        foreach ($cart as $productId => $item) {
            $product = Product::find($productId);
            if ($product && $product->status === 'active') {
                $price = $product->effective_price;
                $lineTotal = $price * $item['quantity'];
                $subtotal += $lineTotal;

                $cartItems[] = [
                    'product' => $product,
                    'quantity' => $item['quantity'],
                    'price' => $price,
                    'line_total' => $lineTotal,
                ];
            }
        }

        if (empty($cartItems)) {
            session()->forget('cart');
            return redirect()->route('cart.index')->with('error', 'Produk di keranjang tidak tersedia lagi.');
        }

        return view('frontend.checkout.index', compact('cartItems', 'subtotal', 'settings'));
    }

    public function process(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang belanja Anda kosong.');
        }

        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:50',
            'customer_email' => 'nullable|email|max:255',
            'shipping_address' => 'required|string|max:1000',
            'courier_name' => 'nullable|string|max:255',
            'payment_method' => 'required|in:Transfer Bank,Cash on Delivery',
            'notes' => 'nullable|string|max:500',
        ]);

        try {
            $order = DB::transaction(function () use ($validated, $cart) {
                // 1. Validate real-time stock and fetch prices from database
                $totalAmount = 0;
                $itemsToSave = [];

                foreach ($cart as $productId => $item) {
                    // Lock the row for update to prevent race conditions
                    $product = Product::lockForUpdate()->find($productId);

                    if (!$product || $product->status !== 'active') {
                        throw new \Exception("Produk '{$item['name']}' tidak lagi aktif atau tersedia.");
                    }

                    $qty = (int) $item['quantity'];

                    if ($product->stock < $qty) {
                        throw new \Exception("Stok produk '{$product->name}' tidak mencukupi (Tersisa: {$product->stock}). Silakan sesuaikan jumlah pesanan Anda.");
                    }

                    // NEVER trust client session price - take snapshot directly from DB
                    $unitPrice = $product->effective_price;
                    $lineTotal = $unitPrice * $qty;
                    $totalAmount += $lineTotal;

                    // Deduct stock
                    $product->decrement('stock', $qty);

                    // If stock reaches 0, update status to out_of_stock
                    if ($product->fresh()->stock <= 0) {
                        $product->update(['status' => 'out_of_stock']);
                    }

                    $itemsToSave[] = [
                        'product_id' => $product->id,
                        'product_name' => $product->name,
                        'unit_price' => $unitPrice,
                        'quantity' => $qty,
                        'subtotal' => $lineTotal,
                    ];
                }

                // 2. Find or create Customer record
                $customer = Customer::updateOrCreate(
                    ['phone' => $validated['customer_phone']],
                    [
                        'name' => $validated['customer_name'],
                        'email' => $validated['customer_email'] ?? null,
                        'address' => $validated['shipping_address'],
                    ]
                );

                // 3. Generate unique invoice number
                $invoiceNumber = Order::generateInvoiceNumber();

                // 4. Create Order
                $order = Order::create([
                    'customer_id' => $customer->id,
                    'invoice_number' => $invoiceNumber,
                    'order_date' => Carbon::now(),
                    'total_amount' => $totalAmount,
                    'status' => 'Pending',
                    'payment_status' => 'Unpaid',
                    'payment_method' => $validated['payment_method'],
                    'customer_name' => $validated['customer_name'],
                    'customer_phone' => $validated['customer_phone'],
                    'shipping_address' => $validated['shipping_address'],
                    'courier_name' => $validated['courier_name'] ?? 'Gojek (GoSend Instant)',
                    'notes' => $validated['notes'] ?? null,
                ]);

                // 5. Create OrderItems
                foreach ($itemsToSave as $itemData) {
                    $order->items()->create($itemData);
                }

                // 6. Create Initial Payment record
                Payment::create([
                    'order_id' => $order->id,
                    'payment_method' => $validated['payment_method'],
                    'amount' => $totalAmount,
                    'payment_status' => 'Unpaid',
                    'payment_proof' => null,
                    'payment_date' => null,
                    'notes' => $validated['payment_method'] === 'Transfer Bank' ? 'Menunggu transfer bank' : 'Bayar tunai di tempat saat pesanan tiba (COD)',
                ]);

                return $order;
            });

            // Clear session cart
            session()->forget('cart');

            return redirect()->route('order.show', $order->invoice_number)
                ->with('success', 'Pesanan Anda berhasil dibuat! Silakan simpan nomor invoice Anda.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal memproses pesanan: ' . $e->getMessage());
        }
    }
}
