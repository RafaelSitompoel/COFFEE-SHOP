<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Setting;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $settings = Setting::getShopSettings();
        $cart = session()->get('cart', []);

        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        return view('frontend.cart.index', compact('cart', 'subtotal', 'settings'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);

        if ($product->status !== 'active' || $product->stock <= 0) {
            return redirect()->back()->with('error', 'Maaf, produk ini sedang tidak tersedia atau stok habis.');
        }

        $cart = session()->get('cart', []);
        $productId = $product->id;
        $requestedQty = (int) $request->quantity;

        $currentQtyInCart = isset($cart[$productId]) ? $cart[$productId]['quantity'] : 0;
        $totalQty = $currentQtyInCart + $requestedQty;

        if ($totalQty > $product->stock) {
            return redirect()->back()->with('error', "Stok tidak mencukupi. Sisa stok tersedia: {$product->stock} porsi.");
        }

        $price = $product->effective_price;

        $cart[$productId] = [
            'id' => $product->id,
            'name' => $product->name,
            'slug' => $product->slug,
            'price' => $price,
            'image' => $product->image,
            'quantity' => $totalQty,
            'max_stock' => $product->stock,
        ];

        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', "{$product->name} berhasil ditambahkan ke keranjang!");
    }

    public function update(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'action' => 'required|in:increment,decrement,set',
            'quantity' => 'nullable|integer|min:1',
        ]);

        $cart = session()->get('cart', []);
        $productId = $request->product_id;

        if (!isset($cart[$productId])) {
            return redirect()->route('cart.index')->with('error', 'Produk tidak ditemukan di keranjang.');
        }

        $product = Product::findOrFail($productId);

        if ($request->action === 'increment') {
            if ($cart[$productId]['quantity'] + 1 > $product->stock) {
                return redirect()->route('cart.index')->with('error', "Maksimal stok tercapai ({$product->stock}).");
            }
            $cart[$productId]['quantity']++;
        } elseif ($request->action === 'decrement') {
            if ($cart[$productId]['quantity'] > 1) {
                $cart[$productId]['quantity']--;
            } else {
                unset($cart[$productId]);
            }
        } elseif ($request->action === 'set') {
            $newQty = (int) $request->quantity;
            if ($newQty > $product->stock) {
                return redirect()->route('cart.index')->with('error', "Stok hanya tersedia {$product->stock}.");
            }
            $cart[$productId]['quantity'] = $newQty;
        }

        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Keranjang belanja berhasil diperbarui.');
    }

    public function remove(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
        ]);

        $cart = session()->get('cart', []);
        $productId = $request->product_id;

        if (isset($cart[$productId])) {
            $productName = $cart[$productId]['name'];
            unset($cart[$productId]);
            session()->put('cart', $cart);
            return redirect()->route('cart.index')->with('success', "{$productName} telah dihapus dari keranjang.");
        }

        return redirect()->route('cart.index');
    }

    public function clear()
    {
        session()->forget('cart');
        return redirect()->route('cart.index')->with('success', 'Keranjang belanja berhasil dikosongkan.');
    }
}
