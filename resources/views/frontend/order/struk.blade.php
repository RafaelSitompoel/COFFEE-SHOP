<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk - {{ $order->invoice_number }}</title>

    <!-- html2canvas CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #f0ebe3;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            min-height: 100vh;
            padding: 20px;
            font-family: 'Courier New', Courier, monospace;
        }

        /* ─── Action Buttons (tidak ikut dicetak) ─── */
        .action-bar {
            display: flex;
            gap: 12px;
            margin-bottom: 24px;
            flex-wrap: wrap;
            justify-content: center;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 22px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            border: none;
            text-decoration: none;
            transition: all 0.2s;
            font-family: 'Arial', sans-serif;
        }

        .btn-primary {
            background: #3d1a08;
            color: #fff;
        }

        .btn-primary:hover {
            background: #5c2b0f;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(61, 26, 8, 0.3);
        }

        .btn-secondary {
            background: #fff;
            color: #3d1a08;
            border: 2px solid #3d1a08;
        }

        .btn-secondary:hover {
            background: #f5ede5;
        }

        .btn-success {
            background: #16a34a;
            color: #fff;
        }

        .btn-success:hover {
            background: #15803d;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(22, 163, 74, 0.3);
        }

        /* ─── Struk Wrapper ─── */
        #struk-wrapper {
            background: #fff;
            width: 320px;
            padding: 0;
            border-radius: 2px;
            box-shadow: 0 4px 32px rgba(0,0,0,0.15);
            position: relative;
        }

        /* Efek tepi bergerigi atas */
        #struk-wrapper::before {
            content: '';
            display: block;
            height: 16px;
            background:
                radial-gradient(circle at 8px -4px, #f0ebe3 10px, transparent 11px),
                radial-gradient(circle at 24px -4px, #f0ebe3 10px, transparent 11px);
            background-size: 16px 16px;
            background-repeat: repeat-x;
        }

        /* Efek tepi bergerigi bawah */
        #struk-wrapper::after {
            content: '';
            display: block;
            height: 16px;
            background:
                radial-gradient(circle at 8px 20px, #f0ebe3 10px, transparent 11px),
                radial-gradient(circle at 24px 20px, #f0ebe3 10px, transparent 11px);
            background-size: 16px 16px;
            background-repeat: repeat-x;
        }

        /* ─── Struk Content ─── */
        #struk {
            padding: 20px 24px;
            font-size: 12px;
            line-height: 1.6;
            color: #1a1a1a;
        }

        /* Header toko */
        .struk-header {
            text-align: center;
            margin-bottom: 12px;
        }

        .struk-logo {
            font-size: 22px;
            font-weight: 900;
            letter-spacing: 2px;
            font-family: 'Georgia', serif;
            color: #3d1a08;
            text-transform: uppercase;
        }

        .struk-tagline {
            font-size: 10px;
            color: #888;
            letter-spacing: 1px;
            margin-top: 2px;
        }

        .struk-address {
            font-size: 10px;
            color: #666;
            margin-top: 4px;
            line-height: 1.4;
        }

        /* Divider */
        .divider-dash {
            border: none;
            border-top: 1px dashed #bbb;
            margin: 10px 0;
        }

        .divider-solid {
            border: none;
            border-top: 1px solid #ccc;
            margin: 10px 0;
        }

        /* Info baris */
        .info-row {
            display: flex;
            justify-content: space-between;
            font-size: 11px;
            margin-bottom: 3px;
        }

        .info-label {
            color: #666;
            flex-shrink: 0;
        }

        .info-value {
            font-weight: 600;
            text-align: right;
            color: #1a1a1a;
        }

        /* Judul section */
        .section-title {
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #888;
            text-align: center;
            margin: 8px 0 6px;
        }

        /* Item pesanan */
        .item-row {
            margin-bottom: 8px;
        }

        .item-name {
            font-weight: 700;
            font-size: 12px;
            color: #1a1a1a;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .item-detail {
            display: flex;
            justify-content: space-between;
            font-size: 11px;
            color: #555;
            margin-top: 1px;
        }

        /* Subtotal / total area */
        .total-row {
            display: flex;
            justify-content: space-between;
            font-size: 12px;
            margin-bottom: 4px;
        }

        .total-label {
            color: #555;
        }

        .total-value {
            font-weight: 600;
        }

        .grand-total-row {
            display: flex;
            justify-content: space-between;
            font-size: 15px;
            font-weight: 900;
            color: #3d1a08;
            margin: 6px 0;
        }

        /* Status badge */
        .status-badge {
            display: inline-block;
            padding: 2px 10px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .status-paid    { background: #dcfce7; color: #16a34a; }
        .status-unpaid  { background: #fef9c3; color: #ca8a04; }
        .status-failed  { background: #fee2e2; color: #dc2626; }
        .status-refunded{ background: #e0e7ff; color: #4f46e5; }

        /* Footer struk */
        .struk-footer {
            text-align: center;
            margin-top: 10px;
        }

        .struk-footer p {
            font-size: 10px;
            color: #888;
            line-height: 1.6;
        }

        .struk-footer .thank-you {
            font-size: 13px;
            font-weight: 700;
            color: #3d1a08;
            font-family: 'Georgia', serif;
            margin-bottom: 4px;
        }

        /* Barcode-like decoration */
        .barcode {
            display: flex;
            justify-content: center;
            gap: 2px;
            margin: 10px 0 4px;
        }

        .barcode span {
            display: inline-block;
            width: 2px;
            background: #1a1a1a;
        }

        /* Invoice number kecil */
        .invoice-code {
            font-size: 10px;
            text-align: center;
            color: #bbb;
            letter-spacing: 2px;
            margin-top: 4px;
        }

        /* Loading overlay */
        #loading-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.5);
            z-index: 999;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            gap: 16px;
        }

        #loading-overlay.active {
            display: flex;
        }

        .spinner {
            width: 48px;
            height: 48px;
            border: 4px solid rgba(255,255,255,0.3);
            border-top-color: #fff;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        #loading-overlay p {
            color: #fff;
            font-family: Arial, sans-serif;
            font-size: 16px;
            font-weight: 600;
        }

        /* Toast notif */
        #toast {
            position: fixed;
            bottom: 32px;
            left: 50%;
            transform: translateX(-50%) translateY(80px);
            background: #16a34a;
            color: #fff;
            padding: 12px 28px;
            border-radius: 50px;
            font-family: Arial, sans-serif;
            font-size: 14px;
            font-weight: 600;
            box-shadow: 0 4px 20px rgba(0,0,0,0.2);
            transition: transform 0.3s ease;
            z-index: 1000;
            white-space: nowrap;
        }

        #toast.show {
            transform: translateX(-50%) translateY(0);
        }

        @media print {
            .action-bar { display: none; }
            body { background: #fff; padding: 0; }
            #struk-wrapper { box-shadow: none; }
        }
    </style>
</head>
<body>

<!-- Loading Overlay -->
<div id="loading-overlay">
    <div class="spinner"></div>
    <p>Menyimpan struk sebagai PNG...</p>
</div>

<!-- Toast -->
<div id="toast">✅ Struk berhasil diunduh!</div>

<!-- Action Buttons -->
<div class="action-bar no-print">
    <button class="btn btn-success" onclick="downloadPNG()">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5 5 5-5M12 3v12"/>
        </svg>
        Unduh PNG
    </button>

    <button class="btn btn-primary" onclick="window.print()">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 9V2h12v7M6 18H4a2 2 0 01-2-2v-5a2 2 0 012-2h16a2 2 0 012 2v5a2 2 0 01-2 2h-2M6 14h12v8H6z"/>
        </svg>
        Cetak
    </button>

    <a href="{{ route('order.show', $order->invoice_number) }}" class="btn btn-secondary">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
        </svg>
        Kembali
    </a>
</div>

<!-- ═══════════════════════════════════════ -->
<!--           STRUK KASIR CONTENT           -->
<!-- ═══════════════════════════════════════ -->
<div id="struk-wrapper">
    <div id="struk">

        {{-- ── HEADER ── --}}
        <div class="struk-header">
            <div class="struk-logo">☕ {{ $settings['shop_name'] ?? 'Aura Coffee' }}</div>
            <div class="struk-tagline">Premium Coffee & Roastery</div>
            @if(!empty($settings['address']))
            <div class="struk-address">{{ $settings['address'] }}</div>
            @endif
            @if(!empty($settings['phone']))
            <div class="struk-address">WA: {{ $settings['phone'] }}</div>
            @endif
        </div>

        <hr class="divider-solid">

        {{-- ── INFO TRANSAKSI ── --}}
        <div class="info-row">
            <span class="info-label">Invoice</span>
            <span class="info-value">{{ $order->invoice_number }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">Tanggal</span>
            <span class="info-value">{{ $order->created_at->format('d/m/Y H:i') }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">Kasir</span>
            <span class="info-value">Aura Coffee</span>
        </div>

        <hr class="divider-dash">

        {{-- ── INFO PELANGGAN ── --}}
        <div class="info-row">
            <span class="info-label">Pelanggan</span>
            <span class="info-value">{{ $order->customer_name }}</span>
        </div>
        @if($order->customer_phone)
        <div class="info-row">
            <span class="info-label">Telp</span>
            <span class="info-value">{{ $order->customer_phone }}</span>
        </div>
        @endif
        @if($order->shipping_address)
        <div class="info-row">
            <span class="info-label">Alamat</span>
            <span class="info-value" style="max-width:160px; text-align:right;">{{ Str::limit($order->shipping_address, 50) }}</span>
        </div>
        @endif
        @if($order->payment_method)
        <div class="info-row">
            <span class="info-label">Pembayaran</span>
            <span class="info-value">{{ strtoupper(str_replace('_', ' ', $order->payment_method)) }}</span>
        </div>
        @endif
        @if($order->courier_name)
        <div class="info-row">
            <span class="info-label">Pengiriman</span>
            <span class="info-value">{{ $order->courier_name }}</span>
        </div>
        @endif
        @if($order->driver_name)
        <div class="info-row">
            <span class="info-label">Driver</span>
            <span class="info-value">{{ $order->driver_name }}</span>
        </div>
        @endif
        @if($order->driver_plate)
        <div class="info-row">
            <span class="info-label">Plat Motor</span>
            <span class="info-value">{{ $order->driver_plate }}</span>
        </div>
        @endif

        <hr class="divider-dash">

        {{-- ── DAFTAR ITEM ── --}}
        <div class="section-title">— Pesanan —</div>

        @foreach($order->items as $item)
        <div class="item-row">
            <div class="item-name">{{ $item->product_name ?? ($item->product->name ?? 'Produk') }}</div>
            <div class="item-detail">
                <span>{{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}</span>
                <span style="font-weight:700;">Rp {{ number_format($item->quantity * $item->price, 0, ',', '.') }}</span>
            </div>
            @if($item->notes)
            <div style="font-size:10px; color:#888; padding-left:4px;">📝 {{ $item->notes }}</div>
            @endif
        </div>
        @endforeach

        <hr class="divider-dash">

        {{-- ── RINGKASAN HARGA ── --}}
        @php
            $subtotal = $order->items->sum(fn($i) => $i->quantity * $i->price);
            $discount = $subtotal - $order->total_amount;
            $discount = max(0, $discount);
        @endphp

        <div class="total-row">
            <span class="total-label">Subtotal</span>
            <span class="total-value">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
        </div>

        @if($discount > 0)
        <div class="total-row" style="color:#dc2626;">
            <span>Diskon</span>
            <span>- Rp {{ number_format($discount, 0, ',', '.') }}</span>
        </div>
        @endif

        @if(!empty($order->delivery_fee) && $order->delivery_fee > 0)
        <div class="total-row">
            <span class="total-label">Ongkir</span>
            <span class="total-value">Rp {{ number_format($order->delivery_fee, 0, ',', '.') }}</span>
        </div>
        @endif

        <div class="divider-solid" style="margin:6px 0;"></div>

        <div class="grand-total-row">
            <span>TOTAL</span>
            <span>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
        </div>

        <hr class="divider-dash">

        {{-- ── STATUS ── --}}
        <div style="display:flex; justify-content:space-between; align-items:center; margin: 6px 0;">
            <span style="font-size:11px; color:#666;">Status Pesanan</span>
            @php
                $orderStatusMap = [
                    'pending'    => ['label' => 'Menunggu',    'class' => 'status-unpaid'],
                    'processing' => ['label' => 'Diproses',    'class' => 'status-unpaid'],
                    'shipped'    => ['label' => 'Dikirim',     'class' => 'status-unpaid'],
                    'completed'  => ['label' => 'Selesai',     'class' => 'status-paid'],
                    'cancelled'  => ['label' => 'Dibatalkan',  'class' => 'status-failed'],
                ];
                $payStatusMap = [
                    'unpaid'    => ['label' => 'Belum Bayar', 'class' => 'status-unpaid'],
                    'paid'      => ['label' => 'Lunas',       'class' => 'status-paid'],
                    'failed'    => ['label' => 'Gagal',       'class' => 'status-failed'],
                    'refunded'  => ['label' => 'Dikembalikan','class' => 'status-refunded'],
                ];
                $os = $orderStatusMap[$order->status] ?? ['label' => ucfirst($order->status), 'class' => 'status-unpaid'];
                $ps = $payStatusMap[$order->payment_status ?? 'unpaid'] ?? ['label' => ucfirst($order->payment_status), 'class' => 'status-unpaid'];
            @endphp
            <span class="status-badge {{ $os['class'] }}">{{ $os['label'] }}</span>
        </div>

        <div style="display:flex; justify-content:space-between; align-items:center; margin: 6px 0;">
            <span style="font-size:11px; color:#666;">Status Bayar</span>
            <span class="status-badge {{ $ps['class'] }}">{{ $ps['label'] }}</span>
        </div>

        @if($order->notes)
        <hr class="divider-dash">
        <div style="font-size:10px; color:#666;">
            <span style="font-weight:700;">Catatan:</span> {{ $order->notes }}
        </div>
        @endif

        <hr class="divider-dash">

        {{-- ── FOOTER ── --}}
        <div class="struk-footer">
            <p class="thank-you">Terima Kasih!</p>
            <p>Selamat menikmati kopi Anda ☕</p>
            <p>Simpan struk ini sebagai bukti pembelian</p>
            @if(!empty($settings['phone']))
            <p style="margin-top:4px;">Komplain? Hubungi kami di WA: {{ $settings['phone'] }}</p>
            @endif
        </div>

        {{-- Barcode dekoratif ── --}}
        <div class="barcode">
            @php $heights = [20,32,20,28,16,36,24,32,20,28,16,36,24,32,20,28,32,20]; @endphp
            @foreach($heights as $h)
            <span style="height:{{ $h }}px;"></span>
            @endforeach
        </div>

        <div class="invoice-code">{{ strtoupper(str_replace(['/', '-'], '', $order->invoice_number)) }}</div>

        {{-- Tanggal cetak ── --}}
        <p style="font-size:9px; text-align:center; color:#ccc; margin-top:8px;">
            Dicetak: {{ now()->format('d/m/Y H:i:s') }}
        </p>

    </div>{{-- #struk --}}
</div>{{-- #struk-wrapper --}}


<script>
    async function downloadPNG() {
        const overlay  = document.getElementById('loading-overlay');
        const toast    = document.getElementById('toast');
        const struk    = document.getElementById('struk-wrapper');
        const actionBar = document.querySelector('.action-bar');

        // Sembunyikan tombol sementara
        actionBar.style.display = 'none';
        overlay.classList.add('active');

        try {
            const canvas = await html2canvas(struk, {
                scale: 3,            // High-res (3× = ~300dpi feel)
                useCORS: true,
                backgroundColor: '#ffffff',
                logging: false,
                allowTaint: false,
                windowWidth: struk.scrollWidth,
                windowHeight: struk.scrollHeight,
            });

            // Download
            const link = document.createElement('a');
            link.download = 'struk-{{ $order->invoice_number }}.png';
            link.href = canvas.toDataURL('image/png');
            link.click();

            // Toast sukses
            toast.classList.add('show');
            setTimeout(() => toast.classList.remove('show'), 3000);

        } catch (err) {
            console.error('Gagal render PNG:', err);
            alert('Gagal membuat PNG. Silakan coba lagi.');
        } finally {
            overlay.classList.remove('active');
            actionBar.style.display = 'flex';
        }
    }
</script>

</body>
</html>
