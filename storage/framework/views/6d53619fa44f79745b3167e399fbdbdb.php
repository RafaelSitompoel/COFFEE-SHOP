<?php $__env->startSection('title', 'Katalog Menu Kopi - ' . ($settings->shop_name ?? 'Aura Coffee')); ?>

<?php $__env->startSection('content'); ?>
    <!-- Catalog Header Banner -->
    <div class="bg-coffee-950 text-white py-12 border-b border-coffee-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <span class="text-xs uppercase tracking-widest text-amber-400 font-bold block mb-1">Daftar Menu Pilihan</span>
            <h1 class="font-serif text-3xl sm:text-4xl font-bold">Katalog Kopi & Minuman</h1>
            <p class="text-xs sm:text-sm text-coffee-300 mt-2 max-w-xl mx-auto font-light">
                Pilih racikan kopi terbaik mulai dari manual brew, espresso klasik, hingga artisan pastry pendamping yang lezat.
            </p>
        </div>
    </div>

    <!-- Filter & Search Bar Section -->
    <div class="bg-white border-b border-coffee-100 py-6 sticky top-20 z-30 shadow-xs">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <form action="<?php echo e(route('catalog.index')); ?>" method="GET" class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <!-- Retain Category If Selected -->
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(request('category')): ?>
                    <input type="hidden" name="category" value="<?php echo e(request('category')); ?>">
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <!-- Search Input -->
                <div class="relative flex-grow max-w-md">
                    <input type="text" 
                           name="search" 
                           value="<?php echo e(request('search')); ?>" 
                           placeholder="Cari menu kopi, rasa, atau SKU..." 
                           class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-coffee-200 text-sm focus:outline-none focus:border-amber-600 focus:ring-1 focus:ring-amber-600 bg-coffee-50/50">
                    <div class="absolute left-3.5 top-3 text-coffee-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(request('search')): ?>
                        <a href="<?php echo e(route('catalog.index', ['category' => request('category')])); ?>" class="absolute right-3 top-2.5 text-xs text-coffee-400 hover:text-coffee-600">
                            ✕ Hapus
                        </a>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                <!-- Sorting Dropdown -->
                <div class="flex items-center gap-3 self-end md:self-auto">
                    <label for="sort" class="text-xs font-semibold text-coffee-600 whitespace-nowrap">Urutkan:</label>
                    <select name="sort" 
                            id="sort" 
                            onchange="this.form.submit()" 
                            class="py-2 pl-3 pr-8 rounded-xl border border-coffee-200 text-xs font-medium bg-white text-coffee-900 focus:outline-none focus:border-amber-600">
                        <option value="latest" <?php echo e(request('sort') == 'latest' ? 'selected' : ''); ?>>Terbaru</option>
                        <option value="price_low" <?php echo e(request('sort') == 'price_low' ? 'selected' : ''); ?>>Harga: Terendah ke Tertinggi</option>
                        <option value="price_high" <?php echo e(request('sort') == 'price_high' ? 'selected' : ''); ?>>Harga: Tertinggi ke Terendah</option>
                        <option value="name_asc" <?php echo e(request('sort') == 'name_asc' ? 'selected' : ''); ?>>Nama Menu (A-Z)</option>
                    </select>

                    <button type="submit" class="hidden sm:inline-block px-4 py-2 rounded-xl bg-amber-600 hover:bg-amber-700 text-white font-bold text-xs transition">
                        Cari
                    </button>
                </div>
            </form>

            <!-- Category Pills Filter -->
            <div class="flex items-center gap-2 overflow-x-auto pt-4 pb-1 no-scrollbar">
                <a href="<?php echo e(route('catalog.index', ['search' => request('search'), 'sort' => request('sort')])); ?>" 
                   class="px-4 py-1.5 rounded-full text-xs font-semibold whitespace-nowrap transition <?php echo e(!request('category') ? 'bg-amber-600 text-white shadow-sm' : 'bg-coffee-100 text-coffee-700 hover:bg-coffee-200'); ?>">
                    Semua Menu
                </a>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('catalog.index', ['category' => $cat->slug, 'search' => request('search'), 'sort' => request('sort')])); ?>" 
                       class="px-4 py-1.5 rounded-full text-xs font-semibold whitespace-nowrap transition <?php echo e(request('category') == $cat->slug ? 'bg-amber-600 text-white shadow-sm' : 'bg-coffee-100 text-coffee-700 hover:bg-coffee-200'); ?>">
                        <?php echo e($cat->name); ?> (<?php echo e($cat->products_count); ?>)
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Products Grid -->
    <div class="py-12 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($currentCategory): ?>
            <div class="mb-6 p-4 rounded-2xl bg-amber-50 border border-amber-200/70 flex items-center justify-between">
                <div>
                    <h2 class="font-serif text-lg font-bold text-coffee-950">Kategori: <?php echo e($currentCategory->name); ?></h2>
                    <p class="text-xs text-coffee-700 mt-0.5"><?php echo e($currentCategory->description); ?></p>
                </div>
                <a href="<?php echo e(route('catalog.index')); ?>" class="text-xs font-bold text-amber-700 hover:underline">
                    Reset Filter ✕
                </a>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($products->isEmpty()): ?>
            <div class="text-center py-20 bg-white rounded-3xl border border-coffee-200/80 p-8">
                <div class="w-16 h-16 rounded-full bg-amber-100 text-amber-600 flex items-center justify-center mx-auto text-3xl mb-4">
                    ☕
                </div>
                <h3 class="font-serif text-xl font-bold text-coffee-900">Menu Tidak Ditemukan</h3>
                <p class="text-xs text-coffee-500 mt-2 max-w-md mx-auto">
                    Tidak ada produk kopi yang sesuai dengan filter atau kata kunci pencarian Anda. Silakan coba kata kunci lain.
                </p>
                <a href="<?php echo e(route('catalog.index')); ?>" class="mt-6 inline-block px-6 py-2.5 rounded-xl bg-amber-600 text-white font-bold text-xs shadow hover:bg-amber-700 transition">
                    Lihat Semua Menu Kopi
                </a>
            </div>
        <?php else: ?>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="bg-white rounded-3xl border border-coffee-200/80 overflow-hidden shadow-xs hover:shadow-xl hover:-translate-y-1 transition duration-300 flex flex-col justify-between scroll-reveal">
                        <div>
                            <!-- Product Image -->
                            <div class="relative h-56 bg-coffee-100 overflow-hidden">
                                <a href="<?php echo e(route('catalog.show', $product->slug)); ?>">
                                    <img src="<?php echo e($product->image_url); ?>" 
                                         alt="<?php echo e($product->name); ?>" 
                                         class="w-full h-full object-cover hover:scale-105 transition duration-500">
                                </a>

                                <div class="absolute top-3 left-3 flex flex-col gap-1">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($product->is_featured): ?>
                                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-amber-600 text-white shadow">
                                            Unggulan
                                        </span>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($product->has_discount): ?>
                                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-rose-600 text-white shadow">
                                            Diskon
                                        </span>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>

                                <div class="absolute top-3 right-3">
                                    <span class="px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-white/95 text-coffee-800 shadow-sm">
                                        <?php echo e($product->category->name ?? 'Kopi'); ?>

                                    </span>
                                </div>
                            </div>

                            <!-- Details -->
                            <div class="p-6">
                                <div class="flex items-center justify-between text-xs text-coffee-400 mb-1">
                                    <span>SKU: <?php echo e($product->sku); ?></span>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($product->stock > 0): ?>
                                        <span class="text-emerald-700 font-semibold">Tersedia: <?php echo e($product->stock); ?></span>
                                    <?php else: ?>
                                        <span class="text-rose-600 font-semibold">Habis</span>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>

                                <a href="<?php echo e(route('catalog.show', $product->slug)); ?>" class="block">
                                    <h3 class="font-serif text-lg font-bold text-coffee-950 hover:text-amber-700 transition">
                                        <?php echo e($product->name); ?>

                                    </h3>
                                </a>

                                <p class="text-xs text-coffee-600 mt-2 line-clamp-2 leading-relaxed">
                                    <?php echo e($product->description); ?>

                                </p>

                                <div class="mt-4 flex items-baseline gap-2">
                                    <span class="font-bold text-lg text-amber-700">
                                        Rp <?php echo e(number_format($product->effective_price, 0, ',', '.')); ?>

                                    </span>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($product->has_discount): ?>
                                        <span class="text-xs text-coffee-400 line-through">
                                            Rp <?php echo e(number_format($product->price, 0, ',', '.')); ?>

                                        </span>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <!-- Add to Cart / Detail CTA -->
                        <div class="p-6 pt-0 flex gap-2">
                            <a href="<?php echo e(route('catalog.show', $product->slug)); ?>" 
                               class="p-2.5 rounded-2xl bg-coffee-100 hover:bg-coffee-200 text-coffee-800 transition"
                               title="Lihat Detail">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            </a>

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($product->stock > 0 && $product->status === 'active'): ?>
                                <form action="<?php echo e(route('cart.add')); ?>" method="POST" class="flex-grow">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="w-full py-2.5 rounded-2xl bg-coffee-950 hover:bg-amber-700 text-white font-bold text-xs shadow-md transition flex items-center justify-center gap-1.5">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                                        + Keranjang
                                    </button>
                                </form>
                            <?php else: ?>
                                <button disabled class="flex-grow py-2.5 rounded-2xl bg-coffee-100 text-coffee-400 font-semibold text-xs cursor-not-allowed">
                                    Habis
                                </button>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            <!-- Pagination -->
            <div class="mt-12">
                <?php echo e($products->links()); ?>

            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ACER NITRO\Documents\COFFEE SHOP\resources\views/frontend/catalog/index.blade.php ENDPATH**/ ?>