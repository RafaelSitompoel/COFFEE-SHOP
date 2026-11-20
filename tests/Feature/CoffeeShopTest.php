<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Tests\TestCase;

class CoffeeShopTest extends TestCase
{
    public function test_homepage_loads_successfully(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Aura Coffee');
        $response->assertSee('Menu Kopi');
    }

    public function test_catalog_page_loads_and_filters(): void
    {
        $response = $this->get('/katalog');
        $response->assertStatus(200);
        $response->assertSee('Katalog Kopi');

        $category = Category::where('is_active', true)->first();
        if ($category) {
            $catResponse = $this->get('/katalog?category=' . $category->slug);
            $catResponse->assertStatus(200);
            $catResponse->assertSee($category->name);
        }
    }

    public function test_product_detail_page_loads(): void
    {
        $product = Product::where('status', 'active')->first();
        $this->assertNotNull($product);

        $response = $this->get('/katalog/' . $product->slug);
        $response->assertStatus(200);
        $response->assertSee($product->name);
        $response->assertSee('Masukkan ke Keranjang');
    }

    public function test_shopping_cart_workflow(): void
    {
        $product = Product::where('status', 'active')->where('stock', '>', 5)->first();
        $this->assertNotNull($product);

        // 1. Add to cart
        $addResponse = $this->post('/keranjang/tambah', [
            'product_id' => $product->id,
            'quantity' => 2,
        ]);
        $addResponse->assertRedirect('/keranjang');
        $this->assertNotEmpty(session('cart'));
        $this->assertEquals(2, session('cart')[$product->id]['quantity']);

        // 2. View cart
        $cartPageResponse = $this->withSession(['cart' => session('cart')])->get('/keranjang');
        $cartPageResponse->assertStatus(200);
        $cartPageResponse->assertSee($product->name);

        // 3. Increment cart
        $incResponse = $this->withSession(['cart' => session('cart')])->post('/keranjang/update', [
            'product_id' => $product->id,
            'action' => 'increment',
        ]);
        $incResponse->assertRedirect('/keranjang');
        $this->assertEquals(3, session('cart')[$product->id]['quantity']);

        // 4. Remove from cart
        $removeResponse = $this->withSession(['cart' => session('cart')])->post('/keranjang/hapus', [
            'product_id' => $product->id,
        ]);
        $removeResponse->assertRedirect('/keranjang');
        $this->assertEmpty(session('cart'));
    }

    public function test_checkout_and_order_creation_flow(): void
    {
        $product = Product::where('status', 'active')->where('stock', '>', 5)->first();
        $initialStock = $product->stock;

        $cart = [
            $product->id => [
                'id' => $product->id,
                'name' => $product->name,
                'slug' => $product->slug,
                'price' => $product->effective_price,
                'image' => $product->image,
                'quantity' => 2,
                'max_stock' => $initialStock,
            ],
        ];

        // Process checkout directly with cart in session
        $processResponse = $this->withSession(['cart' => $cart])->post('/checkout/proses', [
            'customer_name' => 'Fajar Nugraha',
            'customer_phone' => '081299998888',
            'customer_email' => 'fajar@example.com',
            'shipping_address' => 'Jl. Kebon Jeruk No. 10 Jakarta Barat',
            'payment_method' => 'Transfer Bank',
            'notes' => 'Tolong antar sebelum jam 12 siang',
        ]);

        $order = Order::where('customer_phone', '081299998888')->latest()->first();
        $this->assertNotNull($order);
        $processResponse->assertRedirect('/pesanan/' . $order->invoice_number);

        // Assert stock decremented
        $product->refresh();
        $this->assertEquals($initialStock - 2, $product->stock);

        // Assert items and payment created
        $this->assertCount(1, $order->items);
        $this->assertNotNull($order->payment);
        $this->assertEquals('Transfer Bank', $order->payment_method);
        $this->assertEquals('Pending', $order->status);

        // Assert session cart cleared
        $this->assertEmpty(session('cart'));
    }

    public function test_order_detail_and_invoice_pages(): void
    {
        $order = Order::first();
        $this->assertNotNull($order);

        // Order detail page
        $response = $this->get('/pesanan/' . $order->invoice_number);
        $response->assertStatus(200);
        $response->assertSee($order->invoice_number);
        $response->assertSee($order->customer_name);

        // Invoice page
        $invoiceResponse = $this->get('/pesanan/' . $order->invoice_number . '/invoice');
        $invoiceResponse->assertStatus(200);
        $invoiceResponse->assertSee($order->invoice_number);

        // Struk PNG page
        $strukResponse = $this->get('/pesanan/' . $order->invoice_number . '/struk');
        $strukResponse->assertStatus(200);
        $strukResponse->assertSee($order->invoice_number);
        $strukResponse->assertSee('html2canvas');
        $strukResponse->assertSee('Unduh PNG');

        // Completed (Kopi Diterima) page
        $completedResponse = $this->get('/pesanan/' . $order->invoice_number . '/selesai');
        $completedResponse->assertStatus(200);
        $completedResponse->assertSee('Kopi Telah Diterima');
        $completedResponse->assertSee($order->invoice_number);
        $completedResponse->assertSee('Bagaimana Seduhan Kopi Kami Hari Ini?');
    }

    public function test_customer_confirms_kopi_diterima_and_submits_review(): void
    {
        $order = Order::first();
        $this->assertNotNull($order);

        // Confirm received
        $confirmResponse = $this->post('/pesanan/' . $order->invoice_number . '/terima');
        $confirmResponse->assertRedirect('/pesanan/' . $order->invoice_number . '/selesai');

        $order->refresh();
        $this->assertEquals('Completed', $order->status);
        $this->assertEquals('Paid', $order->payment_status);

        // Submit review
        $reviewResponse = $this->post('/pesanan/' . $order->invoice_number . '/review', [
            'rating' => 5,
            'review' => 'Kopi mantap dan creamy sekali!',
        ]);
        $reviewResponse->assertSessionHas('success');

        $order->refresh();
        $this->assertStringContainsString('5 Bintang', $order->notes);
    }

    public function test_order_status_sync_to_completed(): void
    {
        $order = Order::with('payment')->first();
        $this->assertNotNull($order);

        $order->update([
            'status' => 'Completed',
            'payment_status' => 'Paid',
        ]);

        $order->refresh();
        $this->assertEquals('Completed', $order->status);
        $this->assertEquals('Paid', $order->payment_status);

        if ($order->payment) {
            $order->payment->refresh();
            $this->assertEquals('Paid', $order->payment->payment_status);
        }
    }

    public function test_admin_login_and_filament_routes(): void
    {
        $response = $this->get('/admin/login');
        $response->assertStatus(200);
        $response->assertSee('password', false);

        // Test authenticated admin dashboard & resources
        $admin = \App\Models\User::where('email', 'admin@coffeeshop.com')->first();
        if (!$admin) {
            $admin = \App\Models\User::factory()->create([
                'email' => 'admin@coffeeshop.com',
                'is_admin' => true,
                'role' => 'admin',
            ]);
        }

        $this->actingAs($admin);

        // 1. Dashboard (renders all widgets: stats, charts, latest orders, top products)
        $dashResponse = $this->get('/admin');
        $dashResponse->assertStatus(200);

        // 2. Orders list
        $ordersResponse = $this->get('/admin/orders');
        $ordersResponse->assertStatus(200);

        // 3. Products list
        $productsResponse = $this->get('/admin/products');
        $productsResponse->assertStatus(200);

        // 4. Payments list
        $paymentsResponse = $this->get('/admin/payments');
        $paymentsResponse->assertStatus(200);

        // 5. Users management list in Super Admin
        $usersResponse = $this->get('/admin/users');
        $usersResponse->assertStatus(200);
    }

    public function test_barista_panel_routes_and_access_separation(): void
    {
        // Barista login page loads
        $loginResponse = $this->get('/barista/login');
        $loginResponse->assertStatus(200);

        $barista = \App\Models\User::where('email', 'barista@coffeeshop.com')->first();
        if (!$barista) {
            $barista = \App\Models\User::factory()->create([
                'email' => 'barista@coffeeshop.com',
                'is_admin' => false,
                'role' => 'lead_barista',
            ]);
        }

        // 1. Barista logs in
        $this->actingAs($barista);

        // 2. Barista can access /barista dashboard
        $baristaDash = $this->get('/barista');
        $baristaDash->assertStatus(200);

        // 3. Barista can access Barista Orders queue
        $baristaOrders = $this->get('/barista/orders');
        $baristaOrders->assertStatus(200);

        // 4. Barista can access Barista Product Stock
        $baristaProducts = $this->get('/barista/products');
        $baristaProducts->assertStatus(200);

        // 5. SEPARATION CHECK: Barista is forbidden from Super Admin panel (/admin)
        $adminPanelTry = $this->get('/admin');
        $adminPanelTry->assertStatus(403);
    }
}
