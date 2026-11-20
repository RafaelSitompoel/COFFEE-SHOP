<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    public function history(Request $request)
    {
        $settings = Setting::getShopSettings();
        $orders = collect();
        $queryValue = $request->query('query');

        if ($request->filled('query')) {
            $search = trim($request->query('query'));
            $orders = Order::with(['items', 'payment'])
                ->where('invoice_number', $search)
                ->orWhere('customer_phone', $search)
                ->latest()
                ->paginate(10)
                ->withQueryString();
        }

        return view('frontend.order.history', compact('orders', 'queryValue', 'settings'));
    }

    public function show($invoice_number)
    {
        $settings = Setting::getShopSettings();
        $order = Order::with(['items.product', 'payment', 'customer'])
            ->where('invoice_number', $invoice_number)
            ->firstOrFail();

        return view('frontend.order.show', compact('order', 'settings'));
    }

    public function uploadProof(Request $request, $invoice_number)
    {
        $order = Order::with('payment')
            ->where('invoice_number', $invoice_number)
            ->firstOrFail();

        $request->validate([
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg,webp|max:5120', // max 5MB
        ]);

        if ($request->hasFile('payment_proof')) {
            $path = $request->file('payment_proof')->store('payment_proofs', 'public');

            $payment = $order->payment;
            if (!$payment) {
                $payment = new Payment();
                $payment->order_id = $order->id;
                $payment->payment_method = $order->payment_method;
                $payment->amount = $order->total_amount;
            }

            $payment->payment_proof = $path;
            $payment->payment_date = now();
            $payment->notes = 'Bukti transfer diunggah oleh pelanggan pada ' . now()->format('d M Y H:i');
            $payment->save();

            return redirect()->route('order.show', $order->invoice_number)
                ->with('success', 'Bukti transfer berhasil diunggah! Barista kami akan memverifikasi pesanan Anda.');
        }

        return redirect()->back()->with('error', 'Gagal mengunggah bukti pembayaran.');
    }

    public function invoice($invoice_number)
    {
        $settings = Setting::getShopSettings();
        $order = Order::with(['items.product', 'payment', 'customer'])
            ->where('invoice_number', $invoice_number)
            ->firstOrFail();

        return view('frontend.order.invoice', compact('order', 'settings'));
    }

    public function struk($invoice_number)
    {
        $settings = Setting::getShopSettings();
        $order = Order::with(['items.product', 'payment', 'customer'])
            ->where('invoice_number', $invoice_number)
            ->firstOrFail();

        return view('frontend.order.struk', compact('order', 'settings'));
    }

    public function completed($invoice_number)
    {
        $settings = Setting::getShopSettings();
        $order = Order::with(['items.product', 'payment', 'customer'])
            ->where('invoice_number', $invoice_number)
            ->firstOrFail();

        return view('frontend.order.completed', compact('order', 'settings'));
    }

    public function confirmReceived(Request $request, $invoice_number)
    {
        $order = Order::with('payment')
            ->where('invoice_number', $invoice_number)
            ->firstOrFail();

        $order->update([
            'status' => 'Completed',
            'payment_status' => 'Paid',
            'driver_status' => 'Tiba di Lokasi & Kopi Telah Diterima',
        ]);

        if ($order->payment) {
            $order->payment->update([
                'payment_status' => 'Paid',
                'payment_date' => $order->payment->payment_date ?? now(),
            ]);
        }

        return redirect()->route('order.completed', $order->invoice_number)
            ->with('success', 'Kopi berhasil diterima! Terima kasih telah menikmati seduhan Aura Coffee.');
    }

    public function submitReview(Request $request, $invoice_number)
    {
        $order = Order::where('invoice_number', $invoice_number)->firstOrFail();

        $rating = $request->input('rating', 5);
        $review = $request->input('review');

        // Append review to notes if present
        if ($review) {
            $existingNotes = $order->notes ? $order->notes . ' | ' : '';
            $order->update([
                'notes' => $existingNotes . "Ulasan Pelanggan: [{$rating} Bintang] " . $review,
            ]);
        }

        return redirect()->back()->with('success', "Terima kasih banyak atas penilaian bintang {$rating}! Ulasan Anda sangat berarti bagi tim barista kami.");
    }
}
