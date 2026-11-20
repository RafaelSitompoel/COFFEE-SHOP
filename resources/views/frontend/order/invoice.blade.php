<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice {{ $order->invoice_number }} - {{ $settings->shop_name ?? 'Aura Coffee' }}</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        coffee: {
                            50: '#FDFBF7',
                            900: '#2A1A0E',
                            950: '#1A0F07',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        @media print {
            .no-print {
                display: none !important;
            }
            body {
                background: white !important;
                color: black !important;
            }
            .invoice-box {
                box-shadow: none !important;
                border: none !important;
                padding: 0 !important;
            }
        }
    </style>
</head>
<body class="bg-gray-100 text-gray-800 antialiased p-4 sm:p-8 font-sans">

    <!-- Action Toolbar (Hidden during print) -->
    <div class="max-w-3xl mx-auto mb-6 flex flex-wrap justify-between items-center gap-3 no-print">
        <a href="{{ route('order.show', $order->invoice_number) }}" class="inline-flex items-center gap-2 text-xs font-bold text-gray-600 hover:text-gray-900 bg-white px-4 py-2 rounded-xl shadow-xs border border-gray-200">
            ← Kembali ke Detail Pesanan
        </a>
        <div class="flex gap-2">
            <a href="{{ route('order.struk', $order->invoice_number) }}" target="_blank" class="inline-flex items-center gap-2 text-xs font-bold text-coffee-900 bg-amber-100 hover:bg-amber-200 px-4 py-2.5 rounded-xl border border-amber-300 transition">
                <span>🧾 Struk Kasir PNG</span>
            </a>
            <button onclick="window.print()" class="inline-flex items-center gap-2 text-xs font-bold text-white bg-amber-600 hover:bg-amber-700 px-5 py-2.5 rounded-xl shadow transition cursor-pointer">
                🖨️ Cetak / Unduh PDF
            </button>
        </div>
    </div>

    <!-- Printable Invoice Container -->
    <div class="invoice-box max-w-3xl mx-auto bg-white rounded-3xl shadow-lg border border-gray-200 p-8 sm:p-12">
        <!-- Invoice Header -->
        <div class="flex flex-col sm:flex-row justify-between items-start gap-6 pb-8 border-b-2 border-gray-100">
            <div>
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-amber-600 text-white flex items-center justify-center font-bold text-xl">
                        ☕
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold tracking-tight text-gray-900 font-serif">
                            {{ $settings->shop_name ?? 'Aura Coffee & Roastery' }}
                        </h1>
                        <p class="text-xs text-gray-500">Official Artisanal Coffee Receipt</p>
                    </div>
                </div>
                <div class="mt-4 text-xs text-gray-500 space-y-1">
                    <p>{{ $settings->address ?? 'Jl. Sutomo No. 45, Pematangsiantar, Sumatera Utara' }}</p>
                    <p>WhatsApp: {{ $settings->whatsapp_number ?? '081234567890' }} | Email: {{ $settings->email ?? 'halo@auracoffee.id' }}</p>
                </div>
            </div>

            <div class="text-left sm:text-right">
                <span class="inline-block px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider 
                    @if($order->payment_status === 'Paid') bg-emerald-100 text-emerald-800
                    @elseif($order->payment_status === 'Unpaid') bg-amber-100 text-amber-800
                    @else bg-rose-100 text-rose-800 @endif">
                    {{ $order->payment_status === 'Paid' ? 'LUNAS (PAID)' : 'BELUM BAYAR (UNPAID)' }}
                </span>
                <p class="font-mono text-lg font-bold text-gray-900 mt-2">{{ $order->invoice_number }}</p>
                <p class="text-xs text-gray-500 mt-0.5">Tanggal: {{ $order->order_date->format('d/m/Y H:i') }}</p>
            </div>
        </div>

        <!-- Customer & Order Meta -->
        <div class="grid grid-cols-2 gap-8 py-6 border-b border-gray-100 text-xs">
            <div>
                <span class="font-bold text-gray-400 uppercase tracking-wider block mb-1">Ditujukan Kepada:</span>
                <p class="text-sm font-bold text-gray-900">{{ $order->customer_name }}</p>
                <p class="text-gray-600 mt-0.5">No. Telp: {{ $order->customer_phone }}</p>
                <p class="text-gray-600 mt-1 leading-relaxed">{{ $order->shipping_address }}</p>
            </div>
            <div class="text-right space-y-2">
                <div>
                    <span class="font-bold text-gray-400 uppercase tracking-wider block">Metode Pembayaran:</span>
                    <strong class="text-gray-800 text-sm">{{ $order->payment_method }}</strong>
                </div>
                <div>
                    <span class="font-bold text-gray-400 uppercase tracking-wider block">Status Pesanan:</span>
                    <strong class="text-gray-800 text-sm">
                        {{ match($order->status) {
                            'Pending' => 'Pending (Menunggu)',
                            'Processing' => 'Diproses Barista',
                            'Shipped' => 'Dalam Pengiriman',
                            'Completed' => 'Selesai',
                            'Cancelled' => 'Dibatalkan',
                            default => $order->status
                        } }}
                    </strong>
                </div>
            </div>
        </div>

        <!-- Itemized Table -->
        <div class="py-6">
            <table class="w-full text-xs text-left">
                <thead>
                    <tr class="border-b-2 border-gray-200 text-gray-500 uppercase tracking-wider">
                        <th class="py-3 font-bold">No</th>
                        <th class="py-3 font-bold">Menu Kopi</th>
                        <th class="py-3 text-right font-bold">Harga Satuan</th>
                        <th class="py-3 text-center font-bold">Jumlah</th>
                        <th class="py-3 text-right font-bold">Subtotal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($order->items as $index => $item)
                        <tr>
                            <td class="py-3 text-gray-400">{{ $index + 1 }}</td>
                            <td class="py-3 font-bold text-gray-900">{{ $item->product_name }}</td>
                            <td class="py-3 text-right text-gray-700">Rp {{ number_format($item->unit_price, 0, ',', '.') }}</td>
                            <td class="py-3 text-center font-semibold text-gray-900">{{ $item->quantity }}</td>
                            <td class="py-3 text-right font-bold text-gray-900">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Total Calculation -->
        <div class="pt-4 border-t-2 border-gray-200">
            <div class="flex justify-end">
                <div class="w-64 space-y-2 text-xs">
                    <div class="flex justify-between text-gray-600">
                        <span>Subtotal Belanja:</span>
                        <span class="font-semibold text-gray-900">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-gray-600">
                        <span>Ongkos Kirim:</span>
                        <span class="font-semibold text-emerald-600">Rp 0 (FREE)</span>
                    </div>
                    <div class="flex justify-between text-base font-bold text-gray-900 pt-2 border-t border-gray-200">
                        <span>Total Tagihan:</span>
                        <span class="text-amber-700">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer / Bank Details & Notes -->
        <div class="mt-12 pt-6 border-t border-gray-100 text-xs text-gray-500 grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
                <span class="font-bold text-gray-700 block mb-1">Informasi Rekening Toko:</span>
                <p class="whitespace-pre-line font-mono text-[11px] text-gray-600">
                    {{ $settings->bank_info ?? "BCA: 8820 1928 31 a/n PT Aura Kopi Nusantara\nMandiri: 137 00 1928 3740 a/n PT Aura Kopi Nusantara" }}
                </p>
            </div>
            <div class="text-left sm:text-right">
                <span class="font-bold text-gray-700 block mb-1">Terima Kasih Telah Menikmati Kopi Kami!</span>
                <p class="text-gray-400 italic">"Good coffee warms the soul, great conversation awakens the mind."</p>
            </div>
        </div>
    </div>

</body>
</html>
