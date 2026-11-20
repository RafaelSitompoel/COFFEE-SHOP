@extends('layouts.app')

@section('title', 'Selesai - Kopi Diterima (' . $order->invoice_number . ') - ' . ($settings->shop_name ?? 'Aura Coffee'))

@section('content')
<div class="py-12 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

    {{-- Breadcrumb Navigation --}}
    <div class="mb-6 flex items-center justify-between text-xs">
        <a href="{{ route('order.show', $order->invoice_number) }}" class="inline-flex items-center gap-1.5 font-bold text-coffee-600 hover:text-coffee-950 transition">
            ← Kembali ke Status Detail
        </a>
        <span class="font-mono text-coffee-400">{{ $order->invoice_number }}</span>
    </div>

    {{-- ── CELEBRATION HERO CARD ── --}}
    <div class="bg-white rounded-3xl border border-coffee-200/80 p-8 sm:p-12 shadow-sm text-center relative overflow-hidden mb-8">
        {{-- Background decorative ambient --}}
        <div class="absolute -top-16 -right-16 w-48 h-48 rounded-full bg-emerald-100/50 filter blur-2xl pointer-events-none"></div>
        <div class="absolute -bottom-16 -left-16 w-48 h-48 rounded-full bg-amber-100/50 filter blur-2xl pointer-events-none"></div>

        {{-- Success animated icon --}}
        <div class="relative inline-flex items-center justify-center mb-6">
            <div class="w-24 h-24 rounded-full bg-emerald-500/10 border-4 border-emerald-500 flex items-center justify-center text-5xl shadow-inner">
                ☕
            </div>
            <div class="absolute -bottom-1 -right-1 w-9 h-9 rounded-full bg-emerald-600 text-white flex items-center justify-center text-lg font-bold border-2 border-white shadow">
                ✓
            </div>
        </div>

        <div class="inline-block px-3.5 py-1 rounded-full bg-emerald-100 text-emerald-800 text-xs font-bold uppercase tracking-wider mb-3">
            STATUS: SELESAI
        </div>

        <h1 class="font-serif text-3xl sm:text-4xl font-extrabold text-coffee-950 mb-3">
            Kopi Telah Diterima!
        </h1>

        <p class="text-sm sm:text-base text-coffee-700 max-w-xl mx-auto leading-relaxed mb-6">
            Pesanan Anda telah berhasil diserahterimakan dalam kondisi terbaik. Selamat menikmati aroma dan kenikmatan seduhan segar dari barista <strong>{{ $settings->shop_name ?? 'Aura Coffee' }}</strong>.
        </p>

        {{-- Mini details banner --}}
        <div class="inline-flex flex-wrap items-center justify-center gap-3 py-2 px-5 rounded-2xl bg-coffee-50 border border-coffee-200/60 text-xs text-coffee-800">
            <span>Invoice: <strong class="font-mono text-coffee-950">{{ $order->invoice_number }}</strong></span>
            <span class="text-coffee-300">•</span>
            <span>Waktu Selesai: <strong>{{ now()->format('d M Y, H:i') }} WIB</strong></span>
            <span class="text-coffee-300">•</span>
            <span class="px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-800 font-bold">LUNAS</span>
        </div>
    </div>

    {{-- ── 4-STEP TIMELINE (ALL COMPLETED) ── --}}
    <div class="bg-white rounded-3xl border border-coffee-200/80 p-6 sm:p-8 shadow-sm mb-8">
        <h2 class="text-xs font-bold uppercase tracking-wider text-coffee-500 mb-6 text-center sm:text-left">
            Proses Pengerjaan Selesai Sepenuhnya
        </h2>

        <div class="grid grid-cols-4 gap-2 text-center relative">
            <!-- Step 1: Menunggu -->
            <div class="flex flex-col items-center">
                <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-xs mb-2 bg-emerald-600 text-white shadow-md">
                    ✓
                </div>
                <span class="font-bold text-xs text-coffee-900">Menunggu</span>
                <span class="text-[10px] text-coffee-500 hidden sm:block">Pesanan Dibuat</span>
            </div>

            <!-- Step 2: Diracik Barista -->
            <div class="flex flex-col items-center">
                <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-xs mb-2 bg-emerald-600 text-white shadow-md">
                    ✓
                </div>
                <span class="font-bold text-xs text-coffee-900">Diracik Barista</span>
                <span class="text-[10px] text-coffee-500 hidden sm:block">Seduhan Segar</span>
            </div>

            <!-- Step 3: Dikirim -->
            <div class="flex flex-col items-center">
                <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-xs mb-2 bg-emerald-600 text-white shadow-md">
                    ✓
                </div>
                <span class="font-bold text-xs text-coffee-900">Dikirim</span>
                <span class="text-[10px] text-coffee-500 hidden sm:block">Kurir Gojek Siantar</span>
            </div>

            <!-- Step 4: Selesai -->
            <div class="flex flex-col items-center">
                <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-xs mb-2 bg-emerald-600 text-white ring-4 ring-emerald-200 shadow-md">
                    ★
                </div>
                <span class="font-bold text-xs text-emerald-700">Selesai</span>
                <span class="text-[10px] text-emerald-600 font-semibold hidden sm:block">Kopi Diterima</span>
            </div>
        </div>
    </div>

    {{-- ── COURIER / PENYERAHAN CARD ── --}}
    @if($order->courier_name || $order->driver_name)
    <div class="bg-white rounded-3xl border border-emerald-300 p-6 sm:p-8 shadow-sm mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-6">
        <div class="flex items-center gap-4">
            <div class="w-14 h-14 rounded-2xl bg-[#00AA13] text-white flex items-center justify-center text-3xl shrink-0 shadow-sm">
                🛵
            </div>
            <div>
                <span class="text-[10px] uppercase font-bold text-emerald-700 tracking-wider block">
                    {{ $order->courier_name ?? 'Gojek (GoSend Instant)' }}
                </span>
                <h3 class="font-bold text-base text-coffee-950">
                    Diantar oleh {{ $order->driver_name ?? 'Driver Gojek Siantar' }}
                </h3>
                <p class="text-xs text-coffee-600 mt-0.5">
                    Kendaraan: <strong>{{ $order->driver_plate ?? 'BK 4218 WAB' }}</strong> • Alamat: {{ Str::limit($order->shipping_address, 45) }}
                </p>
            </div>
        </div>

        <div class="px-4 py-2.5 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-bold flex items-center gap-2 self-start sm:self-center shrink-0">
            <span>📍 Tiba di Lokasi & Diterima</span>
        </div>
    </div>
    @endif

    {{-- ── DETAIL PESANAN YANG DITERIMA ── --}}
    <div class="bg-white rounded-3xl border border-coffee-200/80 p-6 sm:p-8 shadow-sm mb-8">
        <h2 class="font-bold text-base text-coffee-950 pb-4 border-b border-coffee-100 flex items-center justify-between">
            <span>Daftar Menu Kopi yang Telah Diterima</span>
            <span class="text-xs font-normal text-coffee-500">{{ $order->items->count() }} Item Menu</span>
        </h2>

        <div class="divide-y divide-coffee-100">
            @foreach($order->items as $item)
                <div class="py-4 flex items-center justify-between text-xs">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-coffee-100 flex items-center justify-center text-lg shrink-0">
                            ☕
                        </div>
                        <div>
                            <h3 class="font-bold text-sm text-coffee-950">{{ $item->product_name }}</h3>
                            <p class="text-coffee-500">{{ $item->quantity }} x Rp {{ number_format($item->unit_price, 0, ',', '.') }}</p>
                        </div>
                    </div>
                    <span class="font-bold text-sm text-amber-700">
                        Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                    </span>
                </div>
            @endforeach
        </div>

        <div class="pt-4 border-t border-coffee-100 flex justify-between items-baseline text-sm">
            <span class="font-bold text-coffee-900">Total Pembayaran Lunas</span>
            <span class="font-serif text-2xl font-bold text-amber-800">
                Rp {{ number_format($order->total_amount, 0, ',', '.') }}
            </span>
        </div>
    </div>

    {{-- ── FORM RATING & ULASAN KOPI (INTERACTIVE) ── --}}
    <div class="bg-white rounded-3xl border border-amber-200/80 p-6 sm:p-8 shadow-sm mb-8" x-data="{ rating: 5, hoverRating: 0 }">
        <div class="text-center max-w-md mx-auto mb-6">
            <span class="text-2xl mb-1 block">⭐</span>
            <h2 class="font-serif text-xl font-bold text-coffee-950">Bagaimana Seduhan Kopi Kami Hari Ini?</h2>
            <p class="text-xs text-coffee-600 mt-1">
                Berikan bintang dan ulasan singkat untuk racikan barista serta layanan pengantaran kami.
            </p>
        </div>

        <form action="{{ route('order.submit_review', $order->invoice_number) }}" method="POST" class="space-y-4 max-w-lg mx-auto">
            @csrf

            {{-- Star Rating Picker --}}
            <div class="flex items-center justify-center gap-2 mb-2">
                <template x-for="star in [1, 2, 3, 4, 5]" :key="star">
                    <button type="button" 
                            @click="rating = star" 
                            @mouseenter="hoverRating = star" 
                            @mouseleave="hoverRating = 0" 
                            class="text-3xl transition transform hover:scale-125 focus:outline-none">
                        <span x-text="(hoverRating || rating) >= star ? '⭐' : '☆'" 
                              :class="(hoverRating || rating) >= star ? 'opacity-100' : 'opacity-40'"></span>
                    </button>
                </template>
                <input type="hidden" name="rating" :value="rating">
            </div>

            <p class="text-center text-xs font-bold text-amber-700 mb-4">
                <span x-show="rating === 5">Sangat Puas! Nikmat & Segar Sekali 🔥</span>
                <span x-show="rating === 4">Enak & Memuaskan 👍</span>
                <span x-show="rating === 3">Cukup Baik 👌</span>
                <span x-show="rating === 2">Kurang Sesuai Selera ☕</span>
                <span x-show="rating === 1">Perlu Peningkatan 🙏</span>
            </p>

            <div>
                <label for="review" class="block text-xs font-bold text-coffee-800 mb-1">
                    Ulasan Anda (Opsional)
                </label>
                <textarea id="review" 
                          name="review" 
                          rows="3" 
                          placeholder="Ceritakan rasa kopinya, kesegaran susu, atau keramahan driver Gojek..." 
                          class="w-full px-4 py-2.5 rounded-2xl border border-coffee-200 text-xs focus:outline-none focus:border-amber-600 bg-coffee-50/30"></textarea>
            </div>

            <button type="submit" class="w-full py-3 rounded-2xl bg-amber-600 hover:bg-amber-700 text-white font-bold text-xs shadow transition">
                Kirim Ulasan & Penilaian ⭐
            </button>
        </form>
    </div>

    {{-- ── ACTION BUTTONS BAR ── --}}
    <div class="flex flex-wrap items-center justify-center gap-4 pt-4">
        <a href="{{ route('order.struk', $order->invoice_number) }}" 
           target="_blank" 
           class="px-6 py-3 rounded-2xl bg-amber-600 hover:bg-amber-700 text-white font-bold text-xs shadow transition flex items-center gap-2">
            <span>🧾 Unduh Struk Kasir (PNG)</span>
        </a>

        <a href="{{ route('order.invoice', $order->invoice_number) }}" 
           target="_blank" 
           class="px-6 py-3 rounded-2xl bg-coffee-900 hover:bg-coffee-800 text-white font-bold text-xs shadow transition flex items-center gap-2">
            <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
            <span>Cetak Invoice</span>
        </a>

        <a href="{{ route('catalog.index') }}" 
           class="px-6 py-3 rounded-2xl bg-white hover:bg-coffee-50 text-coffee-900 font-bold text-xs border border-coffee-300 shadow-xs transition flex items-center gap-2">
            <span>☕ Pesan Kopi Lagi</span>
        </a>
    </div>

</div>
@endsection
