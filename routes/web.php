<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

// Frontend Pelanggan
Route::get('/', [HomeController::class, 'index'])->name('home');

// Katalog & Produk
Route::get('/katalog', [CatalogController::class, 'index'])->name('catalog.index');
Route::get('/katalog/{slug}', [CatalogController::class, 'show'])->name('catalog.show');

// Shopping Cart (Session based)
Route::get('/keranjang', [CartController::class, 'index'])->name('cart.index');
Route::post('/keranjang/tambah', [CartController::class, 'add'])->name('cart.add');
Route::post('/keranjang/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/keranjang/hapus', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/keranjang/kosongkan', [CartController::class, 'clear'])->name('cart.clear');

// Checkout
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout/proses', [CheckoutController::class, 'process'])->name('checkout.process');

// Pesanan & Invoice Pelanggan
Route::get('/pesanan', [OrderController::class, 'history'])->name('order.history');
Route::get('/pesanan/{invoice_number}', [OrderController::class, 'show'])->name('order.show');
Route::post('/pesanan/{invoice_number}/bukti', [OrderController::class, 'uploadProof'])->name('order.upload_proof');
Route::get('/pesanan/{invoice_number}/invoice', [OrderController::class, 'invoice'])->name('order.invoice');
Route::get('/pesanan/{invoice_number}/struk', [OrderController::class, 'struk'])->name('order.struk');
Route::get('/pesanan/{invoice_number}/selesai', [OrderController::class, 'completed'])->name('order.completed');
Route::post('/pesanan/{invoice_number}/terima', [OrderController::class, 'confirmReceived'])->name('order.confirm_received');
Route::post('/pesanan/{invoice_number}/review', [OrderController::class, 'submitReview'])->name('order.submit_review');
