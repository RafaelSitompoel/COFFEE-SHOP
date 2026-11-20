<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $customers = Customer::all();
        $products = Product::all();

        if ($customers->isEmpty() || $products->isEmpty()) {
            return;
        }

        $orderDefinitions = [
            [
                'customer_idx' => 0,
                'days_ago' => 6,
                'status' => 'Completed',
                'payment_status' => 'Paid',
                'payment_method' => 'Transfer Bank',
                'items' => [
                    ['sku' => 'CF-ESP-001', 'qty' => 2],
                    ['sku' => 'CF-PAS-001', 'qty' => 2],
                ],
                'notes' => 'Tolong buatkan kopi less ice ya.',
            ],
            [
                'customer_idx' => 1,
                'days_ago' => 5,
                'status' => 'Completed',
                'payment_status' => 'Paid',
                'payment_method' => 'Transfer Bank',
                'items' => [
                    ['sku' => 'CF-ESP-002', 'qty' => 1],
                    ['sku' => 'CF-CLD-001', 'qty' => 2],
                ],
                'notes' => 'Diantar ke lobi apartemen.',
            ],
            [
                'customer_idx' => 2,
                'days_ago' => 3,
                'status' => 'Shipped',
                'payment_status' => 'Paid',
                'payment_method' => 'Cash on Delivery',
                'items' => [
                    ['sku' => 'CF-MAN-001', 'qty' => 1],
                    ['sku' => 'CF-NON-001', 'qty' => 1],
                ],
                'notes' => 'Titip di pos satpam jika tidak ada orang.',
            ],
            [
                'customer_idx' => 3,
                'days_ago' => 2,
                'status' => 'Processing',
                'payment_status' => 'Paid',
                'payment_method' => 'Transfer Bank',
                'items' => [
                    ['sku' => 'CF-CLD-002', 'qty' => 2],
                    ['sku' => 'CF-PAS-002', 'qty' => 1],
                ],
                'notes' => 'Gula pisah ya barista.',
            ],
            [
                'customer_idx' => 4,
                'days_ago' => 1,
                'status' => 'Pending',
                'payment_status' => 'Unpaid',
                'payment_method' => 'Transfer Bank',
                'items' => [
                    ['sku' => 'CF-ESP-003', 'qty' => 2],
                    ['sku' => 'CF-NON-002', 'qty' => 1],
                ],
                'notes' => 'Segera bayar via BCA.',
            ],
            [
                'customer_idx' => 0,
                'days_ago' => 0,
                'status' => 'Processing',
                'payment_status' => 'Paid',
                'payment_method' => 'Cash on Delivery',
                'items' => [
                    ['sku' => 'CF-ESP-002', 'qty' => 1],
                    ['sku' => 'CF-PAS-001', 'qty' => 3],
                ],
                'notes' => 'Pesanan pagi untuk sarapan kantor.',
            ],
        ];

        foreach ($orderDefinitions as $idx => $def) {
            $customer = $customers[$def['customer_idx']];
            $orderDate = Carbon::now()->subDays($def['days_ago'])->subHours(rand(1, 10));

            $totalAmount = 0;
            $itemsData = [];

            foreach ($def['items'] as $itemDef) {
                $product = $products->firstWhere('sku', $itemDef['sku']) ?? $products->first();
                $price = $product->effective_price;
                $subtotal = $price * $itemDef['qty'];
                $totalAmount += $subtotal;

                $itemsData[] = [
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'unit_price' => $price,
                    'quantity' => $itemDef['qty'],
                    'subtotal' => $subtotal,
                ];
            }

            $order = Order::updateOrCreate(
                ['invoice_number' => 'INV-' . $orderDate->format('Ymd') . '-00' . ($idx + 1)],
                [
                    'customer_id' => $customer->id,
                    'order_date' => $orderDate,
                    'total_amount' => $totalAmount,
                    'status' => $def['status'],
                    'payment_status' => $def['payment_status'],
                    'payment_method' => $def['payment_method'],
                    'customer_name' => $customer->name,
                    'customer_phone' => $customer->phone,
                    'shipping_address' => $customer->address,
                    'notes' => $def['notes'],
                ]
            );

            // Create order items
            $order->items()->delete();
            foreach ($itemsData as $item) {
                $order->items()->create($item);
            }

            // Create payment record
            Payment::updateOrCreate(
                ['order_id' => $order->id],
                [
                    'payment_method' => $def['payment_method'],
                    'amount' => $totalAmount,
                    'payment_status' => $def['payment_status'],
                    'payment_proof' => $def['payment_status'] === 'Paid' ? 'proof_demo.jpg' : null,
                    'payment_date' => $def['payment_status'] === 'Paid' ? $orderDate->copy()->addMinutes(15) : null,
                    'notes' => $def['payment_method'] === 'Transfer Bank' ? 'Transfer Bank Berhasil' : 'Bayar saat pesanan tiba',
                ]
            );
        }
    }
}
