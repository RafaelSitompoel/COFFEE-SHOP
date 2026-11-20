<?php $__env->startSection('title', 'Keranjang Belanja Kopi - ' . ($settings->shop_name ?? 'Aura Coffee')); ?>

<?php $__env->startSection('content'); ?>
    <div class="py-12 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-8">
            <div>
                <span class="text-xs uppercase tracking-widest text-amber-600 font-bold block mb-1">Pesanan Anda</span>
                <h1 class="font-serif text-3xl font-bold text-coffee-950">Keranjang Belanja</h1>
            </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($cart)): ?>
                <form action="<?php echo e(route('cart.clear')); ?>" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin mengosongkan seluruh isi keranjang?')">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="text-xs text-rose-600 hover:text-rose-800 font-semibold flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        Kosongkan Keranjang
                    </button>
                </form>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(empty($cart)): ?>
            <!-- Empty Cart State -->
            <div class="bg-white rounded-3xl border border-coffee-200/80 p-12 text-center max-w-lg mx-auto shadow-sm">
                <div class="w-20 h-20 rounded-full bg-amber-100 text-amber-600 flex items-center justify-center mx-auto text-4xl mb-4">
                    🛒
                </div>
                <h2 class="font-serif text-2xl font-bold text-coffee-900">Keranjang Anda Masih Kosong</h2>
                <p class="text-xs sm:text-sm text-coffee-500 mt-2 leading-relaxed">
                    Belum ada menu kopi atau pastry yang ditambahkan ke keranjang belanja Anda. Jelajahi menu kami dan temukan rasa favorit Anda!
                </p>
                <div class="mt-8">
                    <a href="<?php echo e(route('catalog.index')); ?>" class="px-8 py-3.5 rounded-2xl bg-amber-600 hover:bg-amber-700 text-white font-bold text-sm shadow-md transition inline-flex items-center gap-2">
                        <span>Lihat Menu Kopi Sekarang</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>
            </div>
        <?php else: ?>
            <!-- Active Cart Layout -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
                <!-- Items Table / List -->
                <div class="lg:col-span-8">
                    <div class="bg-white rounded-3xl border border-coffee-200/80 shadow-sm overflow-hidden">
                        <div class="p-6 border-b border-coffee-100">
                            <h2 class="font-bold text-base text-coffee-900">Daftar Menu Kopi</h2>
                        </div>

                        <div class="divide-y divide-coffee-100">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="p-6 flex flex-col sm:flex-row items-center gap-6">
                                    <!-- Thumbnail -->
                                    <div class="w-20 h-20 rounded-2xl overflow-hidden bg-coffee-100 shrink-0 border border-coffee-200/60">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($item['image'])): ?>
                                            <img src="<?php echo e(Str::startsWith($item['image'], 'http') ? $item['image'] : asset('storage/' . $item['image'])); ?>" 
                                                 alt="<?php echo e($item['name']); ?>" 
                                                 class="w-full h-full object-cover">
                                        <?php else: ?>
                                            <div class="w-full h-full flex items-center justify-center bg-coffee-200 text-2xl">☕</div>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </div>

                                    <!-- Details -->
                                    <div class="flex-grow text-center sm:text-left">
                                        <a href="<?php echo e(route('catalog.show', $item['slug'])); ?>" class="font-serif font-bold text-base text-coffee-950 hover:text-amber-700 transition">
                                            <?php echo e($item['name']); ?>

                                        </a>
                                        <div class="text-xs text-coffee-500 mt-1">
                                            Harga Satuan: <strong class="text-coffee-800">Rp <?php echo e(number_format($item['price'], 0, ',', '.')); ?></strong>
                                        </div>
                                    </div>

                                    <!-- Quantity Controls (Monolithic Server-Side Form Post) -->
                                    <div class="flex items-center gap-3">
                                        <!-- Decrement Form -->
                                        <form action="<?php echo e(route('cart.update')); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <input type="hidden" name="product_id" value="<?php echo e($id); ?>">
                                            <input type="hidden" name="action" value="decrement">
                                            <button type="submit" class="w-8 h-8 rounded-lg bg-coffee-100 hover:bg-amber-100 text-coffee-800 flex items-center justify-center font-bold transition">
                                                -
                                            </button>
                                        </form>

                                        <span class="w-8 text-center font-bold text-sm text-coffee-950">
                                            <?php echo e($item['quantity']); ?>

                                        </span>

                                        <!-- Increment Form -->
                                        <form action="<?php echo e(route('cart.update')); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <input type="hidden" name="product_id" value="<?php echo e($id); ?>">
                                            <input type="hidden" name="action" value="increment">
                                            <button type="submit" class="w-8 h-8 rounded-lg bg-coffee-100 hover:bg-amber-100 text-coffee-800 flex items-center justify-center font-bold transition">
                                                +
                                            </button>
                                        </form>
                                    </div>

                                    <!-- Subtotal & Remove -->
                                    <div class="text-center sm:text-right shrink-0">
                                        <span class="text-xs text-coffee-400 block sm:hidden">Total Item:</span>
                                        <span class="font-bold text-base text-amber-700 block">
                                            Rp <?php echo e(number_format($item['price'] * $item['quantity'], 0, ',', '.')); ?>

                                        </span>

                                        <!-- Remove Item Form -->
                                        <form action="<?php echo e(route('cart.remove')); ?>" method="POST" class="mt-2">
                                            <?php echo csrf_field(); ?>
                                            <input type="hidden" name="product_id" value="<?php echo e($id); ?>">
                                            <button type="submit" class="text-xs text-rose-500 hover:text-rose-700 font-medium">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    </div>

                    <div class="mt-6 flex justify-between items-center">
                        <a href="<?php echo e(route('catalog.index')); ?>" class="text-xs font-semibold text-amber-700 hover:text-amber-800 flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                            <span>Tambah Menu Lain</span>
                        </a>
                    </div>
                </div>

                <!-- Cart Summary & Checkout CTA -->
                <div class="lg:col-span-4">
                    <div class="bg-white rounded-3xl border border-coffee-200/80 shadow-sm p-6 space-y-6">
                        <h2 class="font-bold text-lg text-coffee-950 pb-4 border-b border-coffee-100">
                            Ringkasan Pesanan
                        </h2>

                        <div class="space-y-3 text-xs">
                            <div class="flex justify-between text-coffee-600">
                                <span>Total Item</span>
                                <span class="font-semibold text-coffee-900"><?php echo e(array_sum(array_column($cart, 'quantity'))); ?> Porsi</span>
                            </div>
                            <div class="flex justify-between text-coffee-600">
                                <span>Subtotal</span>
                                <span class="font-semibold text-coffee-900">Rp <?php echo e(number_format($subtotal, 0, ',', '.')); ?></span>
                            </div>
                            <div class="flex justify-between text-coffee-600">
                                <span>Pajak Resto & Kemasan</span>
                                <span class="font-semibold text-emerald-600">Termasuk</span>
                            </div>
                        </div>

                        <div class="pt-4 border-t border-coffee-100 flex justify-between items-baseline">
                            <span class="font-bold text-sm text-coffee-950">Total Belanja</span>
                            <span class="font-serif text-2xl font-bold text-amber-700">
                                Rp <?php echo e(number_format($subtotal, 0, ',', '.')); ?>

                            </span>
                        </div>

                        <a href="<?php echo e(route('checkout.index')); ?>" 
                           class="w-full py-4 rounded-2xl bg-amber-600 hover:bg-amber-700 text-white font-bold text-sm shadow-xl shadow-amber-900/20 hover:shadow-amber-900/30 transition flex items-center justify-center gap-2">
                            <span>Lanjut ke Pembayaran</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </a>

                        <div class="p-3 rounded-xl bg-coffee-50 border border-coffee-200/60 text-[11px] text-coffee-600 space-y-1">
                            <p class="font-semibold text-coffee-800">☕ Kualitas Kopi Terjamin</p>
                            <p>Pesanan akan langsung disiapkan oleh barista kami sesaat setelah konfirmasi pembayaran.</p>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ACER NITRO\Documents\COFFEE SHOP\resources\views/frontend/cart/index.blade.php ENDPATH**/ ?>