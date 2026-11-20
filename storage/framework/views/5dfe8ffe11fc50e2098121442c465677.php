<?php $__env->startSection('title', 'Detail Pesanan ' . $order->invoice_number . ' - ' . ($settings->shop_name ?? 'Aura Coffee')); ?>

<?php $__env->startSection('content'); ?>
    <div class="py-12 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header & Action Bar -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
            <div>
                <div class="flex items-center gap-2">
                    <span class="text-xs uppercase tracking-widest text-amber-600 font-bold">Detail Transaksi</span>
                    <span class="text-coffee-300">•</span>
                    <span class="text-xs text-coffee-500 font-mono"><?php echo e($order->order_date->format('d M Y, H:i')); ?> WIB</span>
                </div>
                <h1 class="font-serif text-3xl font-bold text-coffee-950 mt-1 flex items-center gap-3">
                    <span><?php echo e($order->invoice_number); ?></span>
                    <button onclick="navigator.clipboard.writeText('<?php echo e($order->invoice_number); ?>'); alert('Nomor invoice disalin ke clipboard!');" 
                            class="text-xs px-2.5 py-1 rounded-lg bg-coffee-100 hover:bg-amber-100 text-coffee-700 font-sans font-semibold transition"
                            title="Salin Nomor Invoice">
                        📋 Salin
                    </button>
                </h1>
            </div>

            <div class="flex flex-wrap items-center gap-3">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($order->status === 'Completed'): ?>
                    <a href="<?php echo e(route('order.completed', $order->invoice_number)); ?>" 
                       class="px-5 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow transition flex items-center gap-2">
                        <span>★ Halaman Kopi Diterima</span>
                    </a>
                <?php elseif($order->status === 'Shipped'): ?>
                    <form action="<?php echo e(route('order.confirm_received', $order->invoice_number)); ?>" method="POST" class="inline">
                        <?php echo csrf_field(); ?>
                        <button type="submit" onclick="return confirm('Apakah pesanan kopi sudah Anda terima?')" class="px-5 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow transition flex items-center gap-2">
                            <span>✓ Konfirmasi Kopi Diterima</span>
                        </button>
                    </form>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <a href="<?php echo e(route('order.struk', $order->invoice_number)); ?>" 
                   target="_blank" 
                   class="px-5 py-2.5 rounded-xl bg-amber-600 hover:bg-amber-700 text-white font-bold text-xs shadow transition flex items-center gap-2">
                    <span>🧾 Struk Kasir (PNG)</span>
                </a>

                <a href="<?php echo e(route('order.invoice', $order->invoice_number)); ?>" 
                   target="_blank" 
                   class="px-5 py-2.5 rounded-xl bg-coffee-900 hover:bg-coffee-800 text-white font-bold text-xs shadow transition flex items-center gap-2">
                    <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                    <span>Cetak Invoice</span>
                </a>
            </div>
        </div>

        <!-- Order Status Progress Timeline -->
        <div class="bg-white rounded-3xl border border-coffee-200/80 p-6 sm:p-8 shadow-sm mb-8">
            <h2 class="text-xs font-bold uppercase tracking-wider text-coffee-500 mb-6">Status Pengerjaan Kopi</h2>

            <?php
                $statusOrder = ['Pending' => 1, 'Processing' => 2, 'Shipped' => 3, 'Completed' => 4];
                $currentStep = $statusOrder[$order->status] ?? 1;
                $isCancelled = $order->status === 'Cancelled';
            ?>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isCancelled): ?>
                <div class="p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 flex items-center gap-3">
                    <span class="text-2xl">⚠️</span>
                    <div>
                        <strong class="block text-sm">Pesanan Ini Telah Dibatalkan</strong>
                        <span class="text-xs">Hubungi customer service kami jika ada kekeliruan atau ingin memesan ulang.</span>
                    </div>
                </div>
            <?php else: ?>
                <div class="grid grid-cols-4 gap-2 text-center relative">
                    <!-- Step 1: Pending -->
                    <div class="flex flex-col items-center">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-xs mb-2 transition <?php echo e($currentStep >= 1 ? 'bg-amber-600 text-white shadow-md' : 'bg-coffee-100 text-coffee-400'); ?>">
                            1
                        </div>
                        <span class="font-bold text-xs text-coffee-900">Menunggu</span>
                        <span class="text-[10px] text-coffee-500 hidden sm:block">Pesanan Dibuat</span>
                    </div>

                    <!-- Step 2: Processing -->
                    <div class="flex flex-col items-center">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-xs mb-2 transition <?php echo e($currentStep >= 2 ? 'bg-amber-600 text-white shadow-md' : 'bg-coffee-100 text-coffee-400'); ?>">
                            2
                        </div>
                        <span class="font-bold text-xs text-coffee-900">Diracik Barista</span>
                        <span class="text-[10px] text-coffee-500 hidden sm:block">Seduhan Segar</span>
                    </div>

                    <!-- Step 3: Shipped -->
                    <div class="flex flex-col items-center">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-xs mb-2 transition <?php echo e($currentStep >= 3 ? 'bg-amber-600 text-white shadow-md' : 'bg-coffee-100 text-coffee-400'); ?>">
                            3
                        </div>
                        <span class="font-bold text-xs text-coffee-900">Dikirim</span>
                        <span class="text-[10px] text-coffee-500 hidden sm:block">Kurir Menuju Lokasi</span>
                    </div>

                    <!-- Step 4: Completed -->
                    <div class="flex flex-col items-center">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-xs mb-2 transition <?php echo e($currentStep >= 4 ? 'bg-emerald-600 text-white shadow-md' : 'bg-coffee-100 text-coffee-400'); ?>">
                            4
                        </div>
                        <span class="font-bold text-xs text-coffee-900">Selesai</span>
                        <span class="text-[10px] text-coffee-500 hidden sm:block">Kopi Diterima</span>
                    </div>
                </div>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($order->status === 'Completed'): ?>
                    <div class="mt-6 p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <div class="flex items-center gap-3">
                            <span class="text-3xl">☕🎉</span>
                            <div>
                                <strong class="block text-sm font-bold text-emerald-900">Transaksi Berhasil & Selesai!</strong>
                                <span class="text-xs text-emerald-700">Pesanan kopi Anda telah selesai disajikan dan pembayaran lunas. Terima kasih atas kunjungannya!</span>
                            </div>
                        </div>
                        <div class="flex flex-wrap items-center gap-2">
                            <a href="<?php echo e(route('order.completed', $order->invoice_number)); ?>" class="px-4 py-2 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs shrink-0 inline-flex items-center gap-1.5 shadow">
                                <span>★ Halaman Kopi Diterima</span>
                            </a>
                            <a href="<?php echo e(route('order.struk', $order->invoice_number)); ?>" target="_blank" class="px-4 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shrink-0 inline-flex items-center gap-1.5 shadow">
                                <span>🧾 Unduh Struk PNG</span>
                            </a>
                        </div>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($order->driver_name) || in_array($order->status, ['Shipped', 'Completed']) || ($order->courier_name && str_contains(strtolower($order->courier_name), 'gojek'))): ?>
            <div class="bg-white rounded-3xl border-2 border-emerald-500/80 p-6 sm:p-8 shadow-md mb-8 overflow-hidden relative">
                <!-- Top Brand Banner Gojek -->
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 border-b border-gray-100">
                    <div class="flex items-center gap-3.5">
                        <div class="w-12 h-12 rounded-2xl bg-[#00AA13] flex items-center justify-center text-white text-2xl shadow-sm shrink-0">
                            🛵
                        </div>
                        <div>
                            <div class="flex items-center gap-2">
                                <span class="px-2.5 py-0.5 rounded-md bg-emerald-100 text-[#00AA13] text-[10px] font-black uppercase tracking-wider">
                                    <?php echo e($order->courier_name ?? 'Gojek (GoSend Instant)'); ?>

                                </span>
                                <span class="inline-flex items-center gap-1 text-[11px] font-bold text-emerald-600">
                                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-ping"></span>
                                    <?php echo e($order->status === 'Completed' ? 'Selesai Terantar' : 'Live Pengantaran'); ?>

                                </span>
                            </div>
                            <h3 class="font-bold text-lg text-gray-900 mt-0.5">
                                <?php echo e($order->driver_status ?? ($order->status === 'Completed' ? 'Pesanan Kopi Telah Diterima' : 'Driver Gojek Sedang Mengantar Kopi')); ?>

                            </h3>
                        </div>
                    </div>

                    <div class="flex flex-wrap items-center gap-2">
                        <a href="https://www.google.com/maps/dir/?api=1&origin=<?php echo e(urlencode($settings->address ?? 'Jl. Sutomo No. 45, Pematangsiantar')); ?>&destination=<?php echo e(urlencode($order->shipping_address)); ?>" 
                           target="_blank" 
                           class="px-4 py-2 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-800 text-xs font-bold transition flex items-center gap-1.5">
                            🗺️ Rute Google Maps
                        </a>
                    </div>
                </div>

                <!-- Driver Information -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 pt-6">
                    <!-- Driver Profile Box -->
                    <div class="flex items-center gap-4 bg-gray-50 p-4 rounded-2xl border border-gray-200/80">
                        <div class="w-14 h-14 rounded-full bg-[#00AA13] border-2 border-white shadow flex items-center justify-center text-2xl text-white shrink-0">
                            🧔‍♂️
                        </div>
                        <div>
                            <span class="text-[10px] uppercase font-bold text-gray-400">Driver Gojek Siantar</span>
                            <h4 class="font-bold text-sm text-gray-900 leading-tight">
                                <?php echo e($order->driver_name ?? 'Surya Pratama (Gojek Siantar)'); ?>

                            </h4>
                            <div class="flex items-center gap-1.5 mt-1">
                                <span class="text-amber-500 text-xs">⭐⭐⭐⭐⭐</span>
                                <span class="text-[11px] font-bold text-gray-600">4.9 (1.420 trip)</span>
                            </div>
                        </div>
                    </div>

                    <!-- Vehicle & Plate Box -->
                    <div class="flex items-center gap-4 bg-gray-50 p-4 rounded-2xl border border-gray-200/80">
                        <div class="w-12 h-12 rounded-xl bg-emerald-100 text-[#00AA13] flex items-center justify-center text-2xl shrink-0">
                            🛵
                        </div>
                        <div>
                            <span class="text-[10px] uppercase font-bold text-gray-400">Kendaraan & Plat</span>
                            <h4 class="font-bold text-sm text-gray-900 leading-tight">
                                <?php echo e($order->driver_plate ?? 'BK 4218 WAB (Honda Vario)'); ?>

                            </h4>
                            <span class="text-[11px] text-gray-500 block mt-0.5">Kopi diantar dalam thermal bag aman</span>
                        </div>
                    </div>

                    <!-- Contact Buttons Box -->
                    <div class="flex flex-col justify-center gap-2">
                        <?php
                            $phoneRaw = $order->driver_phone ?? '082168923344';
                            $driverPhoneClean = preg_replace('/[^0-9]/', '', $phoneRaw);
                            if (str_starts_with($driverPhoneClean, '0')) {
                                $driverPhoneClean = '62' . substr($driverPhoneClean, 1);
                            }
                        ?>
                        <a href="https://wa.me/<?php echo e($driverPhoneClean); ?>?text=<?php echo e(urlencode('Halo Bang Gojek, saya pemesan kopi Aura Coffee (Invoice: ' . $order->invoice_number . '). Alamat pengiriman saya: ' . $order->shipping_address)); ?>" 
                           target="_blank" 
                           class="w-full py-2.5 px-4 rounded-xl bg-[#25D366] hover:bg-[#1ebc59] text-white font-bold text-xs shadow-xs transition flex items-center justify-center gap-2">
                            <span>💬 Chat Driver via WhatsApp</span>
                        </a>

                        <a href="tel:<?php echo e($phoneRaw); ?>" 
                           class="w-full py-2.5 px-4 rounded-xl bg-[#00AA13] hover:bg-[#008f10] text-white font-bold text-xs shadow-xs transition flex items-center justify-center gap-2">
                            <span>📞 Telepon Driver (<?php echo e($phoneRaw); ?>)</span>
                        </a>
                    </div>
                </div>

                <div class="mt-4 pt-3 border-t border-gray-100 flex flex-col sm:flex-row sm:items-center justify-between gap-2 text-[11px] text-gray-500">
                    <span>💡 Tips: Pastikan nomor HP Anda (<strong><?php echo e($order->customer_phone); ?></strong>) aktif agar driver Gojek mudah menghubungi saat tiba.</span>
                    <span class="font-mono text-emerald-700 font-bold">Aura Coffee × Gojek Pematangsiantar</span>
                </div>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <!-- Left: Order Items & Customer Details -->
            <div class="lg:col-span-7 space-y-8">
                <!-- Order Items Card -->
                <div class="bg-white rounded-3xl border border-coffee-200/80 p-6 sm:p-8 shadow-sm">
                    <h2 class="font-bold text-base text-coffee-950 pb-4 border-b border-coffee-100">
                        Menu Kopi yang Dipesan
                    </h2>

                    <div class="divide-y divide-coffee-100">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="py-4 flex items-center justify-between">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-xl bg-coffee-100 flex items-center justify-center text-xl shrink-0">
                                        ☕
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-sm text-coffee-950"><?php echo e($item->product_name); ?></h3>
                                        <p class="text-xs text-coffee-500">
                                            <?php echo e($item->quantity); ?> x Rp <?php echo e(number_format($item->unit_price, 0, ',', '.')); ?>

                                        </p>
                                    </div>
                                </div>
                                <span class="font-bold text-sm text-amber-700">
                                    Rp <?php echo e(number_format($item->subtotal, 0, ',', '.')); ?>

                                </span>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>

                    <!-- Price Calculation -->
                    <div class="pt-4 border-t border-coffee-100 space-y-2 text-xs">
                        <div class="flex justify-between text-coffee-600">
                            <span>Subtotal</span>
                            <span class="font-semibold text-coffee-900">Rp <?php echo e(number_format($order->total_amount, 0, ',', '.')); ?></span>
                        </div>
                        <div class="flex justify-between text-coffee-600">
                            <span>Biaya Pengantaran</span>
                            <span class="font-semibold text-emerald-600">GRATIS</span>
                        </div>
                        <div class="pt-2 border-t border-coffee-100 flex justify-between items-baseline text-sm">
                            <span class="font-bold text-coffee-950">Total Transaksi</span>
                            <span class="font-serif text-xl font-bold text-amber-700">
                                Rp <?php echo e(number_format($order->total_amount, 0, ',', '.')); ?>

                            </span>
                        </div>
                    </div>
                </div>

                <!-- Customer Details Card -->
                <div class="bg-white rounded-3xl border border-coffee-200/80 p-6 sm:p-8 shadow-sm space-y-4">
                    <h2 class="font-bold text-base text-coffee-950 pb-3 border-b border-coffee-100">
                        Informasi Pengiriman
                    </h2>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                        <div>
                            <span class="text-coffee-400 block">Nama Penerima:</span>
                            <span class="font-bold text-coffee-900 text-sm mt-0.5 block"><?php echo e($order->customer_name); ?></span>
                        </div>
                        <div>
                            <span class="text-coffee-400 block">Nomor WhatsApp / HP:</span>
                            <span class="font-bold text-coffee-900 text-sm mt-0.5 block"><?php echo e($order->customer_phone); ?></span>
                        </div>
                        <div class="sm:col-span-2">
                            <span class="text-coffee-400 block">Alamat Pengiriman:</span>
                            <p class="font-medium text-coffee-800 mt-1 leading-relaxed"><?php echo e($order->shipping_address); ?></p>
                        </div>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($order->notes): ?>
                            <div class="sm:col-span-2 p-3 rounded-xl bg-amber-50 border border-amber-200/60">
                                <span class="text-amber-800 font-bold block">Catatan untuk Barista:</span>
                                <p class="text-amber-900 mt-0.5"><?php echo e($order->notes); ?></p>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Right: Payment Box & Upload Proof -->
            <div class="lg:col-span-5 space-y-8">
                <!-- Payment Status Box -->
                <div class="bg-white rounded-3xl border border-coffee-200/80 p-6 sm:p-8 shadow-sm space-y-6">
                    <div class="flex items-center justify-between pb-4 border-b border-coffee-100">
                        <h2 class="font-bold text-base text-coffee-950">Status Pembayaran</h2>
                        <span class="px-3 py-1 rounded-full text-xs font-bold 
                            <?php if($order->payment_status === 'Paid'): ?> bg-emerald-100 text-emerald-800
                            <?php elseif($order->payment_status === 'Unpaid'): ?> bg-amber-100 text-amber-800
                            <?php else: ?> bg-rose-100 text-rose-800 <?php endif; ?>">
                            <?php echo e($order->payment_status === 'Paid' ? 'Lunas' : ($order->payment_status === 'Unpaid' ? 'Menunggu Pembayaran' : $order->payment_status)); ?>

                        </span>
                    </div>

                    <div class="space-y-3 text-xs">
                        <div class="flex justify-between">
                            <span class="text-coffee-500">Metode Bayar:</span>
                            <strong class="text-coffee-900"><?php echo e($order->payment_method); ?></strong>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-coffee-500">Total Tagihan:</span>
                            <strong class="text-amber-700 text-sm">Rp <?php echo e(number_format($order->total_amount, 0, ',', '.')); ?></strong>
                        </div>
                    </div>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($order->payment_method === 'Transfer Bank'): ?>
                        <!-- Bank Info Box -->
                        <div class="p-4 rounded-2xl bg-coffee-50 border border-coffee-200 text-xs space-y-2">
                            <span class="font-bold text-coffee-900 block">Silakan Transfer ke Rekening Toko:</span>
                            <div class="bg-white p-3 rounded-xl border border-coffee-200/80 font-mono text-coffee-900 whitespace-pre-line leading-relaxed text-xs">
                                <?php echo e($settings->bank_info ?? "BCA: 8820 1928 31\nMandiri: 137 00 1928 3740"); ?>

                            </div>
                        </div>

                        <!-- Upload Proof Form (Monolithic server-side file upload) -->
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($order->payment_status !== 'Paid'): ?>
                            <div class="pt-4 border-t border-coffee-100">
                                <h3 class="font-bold text-sm text-coffee-900 mb-2">Unggah Bukti Transfer</h3>
                                <p class="text-xs text-coffee-500 mb-4">
                                    Setelah mentransfer, lampirkan struk / screenshot bukti pembayaran di bawah ini agar barista dapat langsung memproses pesanan Anda.
                                </p>

                                <form action="<?php echo e(route('order.upload_proof', $order->invoice_number)); ?>" method="POST" enctype="multipart/form-data" class="space-y-4">
                                    <?php echo csrf_field(); ?>
                                    <div>
                                        <input type="file" 
                                               name="payment_proof" 
                                               required
                                               accept="image/jpeg,image/png,image/jpg,image/webp"
                                               class="w-full text-xs text-coffee-700 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-amber-600 file:text-white hover:file:bg-amber-700 cursor-pointer">
                                        <span class="text-[11px] text-coffee-400 mt-1 block">Format: JPG, PNG, WEBP (Maksimal 5MB)</span>
                                    </div>

                                    <button type="submit" class="w-full py-3 rounded-2xl bg-amber-600 hover:bg-amber-700 text-white font-bold text-xs shadow transition">
                                        Unggah Bukti Pembayaran
                                    </button>
                                </form>
                            </div>
                        <?php else: ?>
                            <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs">
                                <strong>✓ Pembayaran Telah Dikonfirmasi Lunas</strong>
                                <p class="mt-1">Terima kasih atas pembayaran Anda. Pesanan kopi sedang diracik dengan penuh cinta.</p>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($order->payment && $order->payment->payment_proof): ?>
                            <div class="pt-4 border-t border-coffee-100">
                                <span class="text-xs text-coffee-500 block mb-2 font-medium">Bukti Transfer yang Telah Diunggah:</span>
                                <div class="rounded-xl overflow-hidden border border-coffee-200 max-h-48">
                                    <img src="<?php echo e(asset('storage/' . $order->payment->payment_proof)); ?>" 
                                         alt="Bukti Transfer" 
                                         class="w-full h-full object-cover">
                                </div>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    <?php else: ?>
                        <!-- COD Info Box -->
                        <div class="p-4 rounded-2xl bg-amber-50 border border-amber-200 text-amber-900 text-xs space-y-1">
                            <strong>🛵 Cash on Delivery (COD)</strong>
                            <p>Siapkan uang pas sejumlah <strong>Rp <?php echo e(number_format($order->total_amount, 0, ',', '.')); ?></strong> saat kurir menyerahkan pesanan kopi Anda.</p>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ACER NITRO\Documents\COFFEE SHOP\resources\views/frontend/order/show.blade.php ENDPATH**/ ?>