<?php $__env->startSection('title', 'Checkout Pembayaran - ' . ($settings->shop_name ?? 'Aura Coffee')); ?>

<?php $__env->startSection('content'); ?>
    <div class="py-12 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb / Steps -->
        <div class="mb-8">
            <div class="flex items-center justify-center max-w-xl mx-auto">
                <div class="flex items-center text-xs font-semibold text-emerald-700">
                    <span class="w-7 h-7 rounded-full bg-emerald-100 flex items-center justify-center mr-2 border border-emerald-300">✓</span>
                    Keranjang
                </div>
                <div class="w-16 h-0.5 bg-amber-500 mx-4"></div>
                <div class="flex items-center text-xs font-bold text-amber-700">
                    <span class="w-7 h-7 rounded-full bg-amber-600 text-white flex items-center justify-center mr-2 shadow">2</span>
                    Checkout
                </div>
                <div class="w-16 h-0.5 bg-coffee-200 mx-4"></div>
                <div class="flex items-center text-xs font-medium text-coffee-400">
                    <span class="w-7 h-7 rounded-full bg-coffee-100 flex items-center justify-center mr-2">3</span>
                    Selesai
                </div>
            </div>
        </div>

        <form action="<?php echo e(route('checkout.process')); ?>" method="POST" x-data="{ paymentMethod: 'Transfer Bank' }">
            <?php echo csrf_field(); ?>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
                <!-- Left Column: Customer Form & Payment Method -->
                <div class="lg:col-span-7 space-y-8">
                    <!-- Customer Information Card -->
                    <div class="bg-white rounded-3xl border border-coffee-200/80 shadow-sm p-6 sm:p-8 space-y-6">
                        <div class="flex items-center gap-3 pb-4 border-b border-coffee-100">
                            <div class="w-8 h-8 rounded-lg bg-amber-100 text-amber-700 flex items-center justify-center font-bold text-sm">
                                1
                            </div>
                            <h2 class="font-bold text-base text-coffee-950">Data Pemesan & Pengiriman</h2>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <!-- Name -->
                            <div class="sm:col-span-2">
                                <label for="customer_name" class="block text-xs font-bold text-coffee-800 mb-1">
                                    Nama Lengkap <span class="text-rose-500">*</span>
                                </label>
                                <input type="text" 
                                       id="customer_name" 
                                       name="customer_name" 
                                       value="<?php echo e(old('customer_name')); ?>" 
                                       required
                                       placeholder="Contoh: Dimas Pratama" 
                                       class="w-full px-4 py-2.5 rounded-xl border border-coffee-200 text-sm focus:outline-none focus:border-amber-600 bg-coffee-50/40">
                            </div>

                            <!-- Phone / WA -->
                            <div>
                                <label for="customer_phone" class="block text-xs font-bold text-coffee-800 mb-1">
                                    Nomor Telepon / WhatsApp <span class="text-rose-500">*</span>
                                </label>
                                <input type="tel" 
                                       id="customer_phone" 
                                       name="customer_phone" 
                                       value="<?php echo e(old('customer_phone')); ?>" 
                                       required
                                       placeholder="Contoh: 081234567890" 
                                       class="w-full px-4 py-2.5 rounded-xl border border-coffee-200 text-sm focus:outline-none focus:border-amber-600 bg-coffee-50/40">
                                <span class="text-[11px] text-coffee-400 mt-0.5 block">Digunakan untuk konfirmasi pesanan dan kurir</span>
                            </div>

                            <!-- Email -->
                            <div>
                                <label for="customer_email" class="block text-xs font-bold text-coffee-800 mb-1">
                                    Alamat Email (Opsional)
                                </label>
                                <input type="email" 
                                       id="customer_email" 
                                       name="customer_email" 
                                       value="<?php echo e(old('customer_email')); ?>" 
                                       placeholder="Contoh: dimas@gmail.com" 
                                       class="w-full px-4 py-2.5 rounded-xl border border-coffee-200 text-sm focus:outline-none focus:border-amber-600 bg-coffee-50/40">
                            </div>

                            <!-- Shipping Address -->
                            <div class="sm:col-span-2">
                                <label for="shipping_address" class="block text-xs font-bold text-coffee-800 mb-1">
                                    Alamat Lengkap Pengiriman <span class="text-rose-500">*</span>
                                </label>
                                <textarea id="shipping_address" 
                                          name="shipping_address" 
                                          rows="3" 
                                          required
                                          placeholder="Tuliskan jalan, nomor rumah, RT/RW, kelurahan, kecamatan, patokan gedung..." 
                                          class="w-full px-4 py-2.5 rounded-xl border border-coffee-200 text-sm focus:outline-none focus:border-amber-600 bg-coffee-50/40"><?php echo e(old('shipping_address')); ?></textarea>
                            </div>

                            <!-- Notes -->
                            <div class="sm:col-span-2">
                                <label for="notes" class="block text-xs font-bold text-coffee-800 mb-1">
                                    Catatan Tambahan untuk Barista (Opsional)
                                </label>
                                <input type="text" 
                                       id="notes" 
                                       name="notes" 
                                       value="<?php echo e(old('notes')); ?>" 
                                       placeholder="Contoh: Less ice, gula pisah, atau titip di pos sekuriti" 
                                       class="w-full px-4 py-2.5 rounded-xl border border-coffee-200 text-sm focus:outline-none focus:border-amber-600 bg-coffee-50/40">
                            </div>
                        </div>
                    </div>

                    <!-- Courier / Gojek Delivery Method Card -->
                    <div class="bg-white rounded-3xl border border-coffee-200/80 shadow-sm p-6 sm:p-8 space-y-6" x-data="{ courier: 'Gojek (GoSend Instant)' }">
                        <div class="flex items-center justify-between pb-4 border-b border-coffee-100">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-emerald-100 text-[#00AA13] flex items-center justify-center font-bold text-sm">
                                    🛵
                                </div>
                                <h2 class="font-bold text-base text-coffee-950">Layanan Pengantaran</h2>
                            </div>
                            <span class="px-2.5 py-0.5 rounded-full bg-emerald-100 text-emerald-800 text-[10px] font-bold">
                                Area Pematangsiantar
                            </span>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <!-- Gojek Option -->
                            <label class="relative flex flex-col p-4 rounded-2xl border-2 cursor-pointer transition"
                                   :class="courier === 'Gojek (GoSend Instant)' ? 'border-emerald-600 bg-emerald-50/40 ring-1 ring-emerald-600' : 'border-coffee-200 hover:border-coffee-300'">
                                <div class="flex items-center justify-between mb-2">
                                    <div class="flex items-center gap-2">
                                        <span class="text-2xl">🛵</span>
                                        <div>
                                            <span class="font-bold text-sm text-coffee-900 block">Gojek (GoSend Instant)</span>
                                            <span class="text-[10px] text-emerald-700 font-semibold">15 - 30 Menit Sampai</span>
                                        </div>
                                    </div>
                                    <input type="radio" 
                                           name="courier_name" 
                                           value="Gojek (GoSend Instant)" 
                                           x-model="courier" 
                                           class="text-emerald-600 focus:ring-emerald-500 h-4 w-4">
                                </div>
                                <p class="text-xs text-coffee-600">Driver Gojek Siantar siap mengambil kopi segar dari toko dan langsung menuju alamat Anda.</p>
                                <span class="text-[11px] font-bold text-emerald-600 mt-2">GRATIS ONGKIR PROMO</span>
                            </label>

                            <!-- Pickup Option -->
                            <label class="relative flex flex-col p-4 rounded-2xl border-2 cursor-pointer transition"
                                   :class="courier === 'Pickup di Toko' ? 'border-emerald-600 bg-emerald-50/40 ring-1 ring-emerald-600' : 'border-coffee-200 hover:border-coffee-300'">
                                <div class="flex items-center justify-between mb-2">
                                    <div class="flex items-center gap-2">
                                        <span class="text-2xl">🏪</span>
                                        <div>
                                            <span class="font-bold text-sm text-coffee-900 block">Ambil Sendiri di Toko</span>
                                            <span class="text-[10px] text-coffee-500">Jl. Sutomo No. 45</span>
                                        </div>
                                    </div>
                                    <input type="radio" 
                                           name="courier_name" 
                                           value="Pickup di Toko" 
                                           x-model="courier" 
                                           class="text-emerald-600 focus:ring-emerald-500 h-4 w-4">
                                </div>
                                <p class="text-xs text-coffee-600">Ambil langsung di kasir Aura Coffee Pematangsiantar tanpa antre saat kopi siap.</p>
                                <span class="text-[11px] font-bold text-coffee-600 mt-2">BEBAS BIAYA</span>
                            </label>
                        </div>
                    </div>

                    <!-- Payment Method Card -->
                    <div class="bg-white rounded-3xl border border-coffee-200/80 shadow-sm p-6 sm:p-8 space-y-6">
                        <div class="flex items-center gap-3 pb-4 border-b border-coffee-100">
                            <div class="w-8 h-8 rounded-lg bg-amber-100 text-amber-700 flex items-center justify-center font-bold text-sm">
                                3
                            </div>
                            <h2 class="font-bold text-base text-coffee-950">Metode Pembayaran</h2>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <!-- Transfer Bank Option -->
                            <label class="relative flex flex-col p-4 rounded-2xl border-2 cursor-pointer transition"
                                   :class="paymentMethod === 'Transfer Bank' ? 'border-amber-600 bg-amber-50/30 ring-1 ring-amber-600' : 'border-coffee-200 hover:border-coffee-300'">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="font-bold text-sm text-coffee-900">Transfer Bank</span>
                                    <input type="radio" 
                                           name="payment_method" 
                                           value="Transfer Bank" 
                                           x-model="paymentMethod" 
                                           class="text-amber-600 focus:ring-amber-500 h-4 w-4">
                                </div>
                                <p class="text-xs text-coffee-600">BCA / Mandiri. Unggah bukti transfer setelah checkout.</p>
                            </label>

                            <!-- COD Option -->
                            <label class="relative flex flex-col p-4 rounded-2xl border-2 cursor-pointer transition"
                                   :class="paymentMethod === 'Cash on Delivery' ? 'border-amber-600 bg-amber-50/30 ring-1 ring-amber-600' : 'border-coffee-200 hover:border-coffee-300'">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="font-bold text-sm text-coffee-900">Cash on Delivery (COD)</span>
                                    <input type="radio" 
                                           name="payment_method" 
                                           value="Cash on Delivery" 
                                           x-model="paymentMethod" 
                                           class="text-amber-600 focus:ring-amber-500 h-4 w-4">
                                </div>
                                <p class="text-xs text-coffee-600">Bayar tunai di tempat secara langsung saat kurir tiba.</p>
                            </label>
                        </div>

                        <!-- Bank Details Display when Transfer Bank Selected -->
                        <div x-show="paymentMethod === 'Transfer Bank'" x-transition class="p-4 rounded-2xl bg-coffee-50 border border-coffee-200 text-xs text-coffee-800 space-y-2">
                            <p class="font-bold text-coffee-900">Rekening Resmi Toko Kopi:</p>
                            <div class="bg-white p-3 rounded-xl border border-coffee-200/80 font-mono text-coffee-900 whitespace-pre-line leading-relaxed">
                                <?php echo e($settings->bank_info ?? "BCA: 8820 1928 31\nMandiri: 137 00 1928 3740"); ?>

                            </div>
                            <p class="text-[11px] text-coffee-500">Nomor invoice dan tombol upload bukti bayar akan langsung tersedia setelah pesanan dibuat.</p>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Order Summary -->
                <div class="lg:col-span-5">
                    <div class="bg-white rounded-3xl border border-coffee-200/80 shadow-sm p-6 sm:p-8 space-y-6 sticky top-28">
                        <div class="flex items-center justify-between pb-4 border-b border-coffee-100">
                            <h2 class="font-bold text-base text-coffee-950">Ringkasan Pesanan</h2>
                            <a href="<?php echo e(route('cart.index')); ?>" class="text-xs font-semibold text-amber-700 hover:underline">
                                Edit Keranjang
                            </a>
                        </div>

                        <!-- Items List -->
                        <div class="divide-y divide-coffee-100 max-h-72 overflow-y-auto pr-1">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $cartItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="py-3 flex items-center justify-between text-xs">
                                    <div class="flex-grow pr-4">
                                        <p class="font-bold text-coffee-900"><?php echo e($item['product']->name); ?></p>
                                        <p class="text-coffee-500 text-[11px]">
                                            <?php echo e($item['quantity']); ?> x Rp <?php echo e(number_format($item['price'], 0, ',', '.')); ?>

                                        </p>
                                    </div>
                                    <span class="font-bold text-coffee-800 shrink-0">
                                        Rp <?php echo e(number_format($item['line_total'], 0, ',', '.')); ?>

                                    </span>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>

                        <!-- Calculations -->
                        <div class="space-y-2.5 pt-4 border-t border-coffee-100 text-xs">
                            <div class="flex justify-between text-coffee-600">
                                <span>Subtotal Belanja</span>
                                <span class="font-semibold text-coffee-900">Rp <?php echo e(number_format($subtotal, 0, ',', '.')); ?></span>
                            </div>
                            <div class="flex justify-between text-coffee-600">
                                <span>Biaya Pengantaran</span>
                                <span class="font-semibold text-emerald-600">GRATIS</span>
                            </div>
                            <div class="flex justify-between text-coffee-600">
                                <span>Biaya Layanan & Pajak</span>
                                <span class="font-semibold text-emerald-600">Termasuk</span>
                            </div>
                        </div>

                        <!-- Total -->
                        <div class="pt-4 border-t border-coffee-100 flex justify-between items-baseline">
                            <span class="font-bold text-sm text-coffee-950">Total Pembayaran</span>
                            <span class="font-serif text-2xl font-bold text-amber-700">
                                Rp <?php echo e(number_format($subtotal, 0, ',', '.')); ?>

                            </span>
                        </div>

                        <!-- Submit Order Button -->
                        <button type="submit" 
                                class="w-full py-4 rounded-2xl bg-amber-600 hover:bg-amber-700 text-white font-bold text-sm shadow-xl shadow-amber-900/20 hover:shadow-amber-900/30 transition flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            <span>Konfirmasi & Buat Pesanan</span>
                        </button>

                        <p class="text-[11px] text-center text-coffee-400">
                            Dengan mengklik tombol di atas, Anda menyetujui pesanan kopi akan segera disiapkan oleh barista.
                        </p>
                    </div>
                </div>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ACER NITRO\Documents\COFFEE SHOP\resources\views/frontend/checkout/index.blade.php ENDPATH**/ ?>