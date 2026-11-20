<?php $__env->startSection('title', 'Aura Coffee & Roastery - Artisanal Coffee & Signature Brews'); ?>

<?php $__env->startSection('content'); ?>
    <!-- Hero Section -->
    <section class="relative bg-coffee-950 text-white overflow-hidden py-20 lg:py-28">
        <!-- Background Ambient Glow -->
        <div class="absolute -top-40 -left-40 w-96 h-96 bg-amber-600/20 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-40 -right-40 w-96 h-96 bg-coffee-700/30 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                <!-- Hero Text -->
                <div class="lg:col-span-7 space-y-6 scroll-reveal-left">
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-coffee-900/90 border border-coffee-800 text-amber-400 text-xs font-semibold tracking-wide">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M2,21H20V19H2M20,8H18V5H20M20,3H4V13A4,4 0 0,0 8,17H14A4,4 0 0,0 18,13V10H20A2,2 0 0,0 22,8V5C22,3.89 21.1,3 20,3Z"/></svg>
                        Artisanal Specialty Coffee & Roastery
                    </div>

                    <h1 class="font-serif text-4xl sm:text-5xl lg:text-6xl font-bold tracking-tight leading-tight text-coffee-50">
                        Cita Rasa Kopi Murni Nusantara, <span class="text-amber-500 italic">Disangrai Sempurna.</span>
                    </h1>

                    <p class="text-base sm:text-lg text-coffee-300 max-w-2xl font-light leading-relaxed">
                        Rasakan kelezatan seduhan espresso otentik, single origin pour-over beraroma buah, hingga signature cold brew yang lembut di setiap tegukan Anda.
                    </p>

                    <div class="pt-4 flex flex-wrap items-center gap-4">
                        <a href="<?php echo e(route('catalog.index')); ?>" class="px-7 py-3.5 rounded-2xl bg-gradient-to-r from-amber-600 to-amber-700 hover:from-amber-500 hover:to-amber-600 text-white font-bold text-sm shadow-xl shadow-amber-900/20 hover:shadow-amber-900/40 hover:-translate-y-0.5 transition flex items-center gap-2">
                            <span>Jelajahi Menu Kopi</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </a>
                        <a href="<?php echo e(route('order.history')); ?>" class="px-7 py-3.5 rounded-2xl bg-coffee-900/80 hover:bg-coffee-800 text-coffee-200 border border-coffee-800 font-semibold text-sm transition">
                            Lacak Pesanan
                        </a>
                    </div>

                    <!-- Trust Stats -->
                    <div class="grid grid-cols-3 gap-6 pt-8 border-t border-coffee-800/80">
                        <div>
                            <span class="block font-serif text-2xl lg:text-3xl font-bold text-amber-400">100%</span>
                            <span class="text-xs text-coffee-400">Arabika Nusantara Asli</span>
                        </div>
                        <div>
                            <span class="block font-serif text-2xl lg:text-3xl font-bold text-amber-400">16 Jam</span>
                            <span class="text-xs text-coffee-400">Slow Cold Brew Extraction</span>
                        </div>
                        <div>
                            <span class="block font-serif text-2xl lg:text-3xl font-bold text-amber-400">Fresh</span>
                            <span class="text-xs text-coffee-400">Di-roast Berkala Tiap Pekan</span>
                        </div>
                    </div>
                </div>

                <!-- Hero Image Showcase -->
                <div class="lg:col-span-5 relative scroll-reveal-right">
                    <div class="relative mx-auto max-w-md rounded-3xl overflow-hidden shadow-2xl border-4 border-coffee-800/60 group">
                        <img src="https://images.unsplash.com/photo-1501339847302-ac426a4a7cbb?auto=format&fit=crop&w=800&q=80" 
                             alt="Coffee Shop Roastery Atmosphere" 
                             class="w-full h-[450px] object-cover group-hover:scale-105 transition duration-700 ease-out">
                        <div class="absolute inset-0 bg-gradient-to-t from-coffee-950 via-coffee-950/20 to-transparent"></div>
                        <div class="absolute bottom-6 left-6 right-6 p-4 rounded-2xl bg-white/10 backdrop-blur-md border border-white/20 text-white">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-xs font-semibold uppercase tracking-wider text-amber-400">Menu Rekomendasi</p>
                                    <p class="font-serif text-lg font-bold">Single Origin Gayo Wine</p>
                                </div>
                                <span class="px-3 py-1 rounded-full bg-amber-500/90 text-white text-xs font-bold">Best Seller</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Value Highlights / Pillars -->
    <section class="py-12 bg-white border-b border-coffee-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="flex items-start gap-4 p-4 rounded-2xl bg-coffee-50/50 hover:bg-coffee-50 transition scroll-reveal">
                    <div class="w-12 h-12 rounded-xl bg-amber-100 text-amber-700 flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12,3L1,9L12,15L21,10.09V17H23V9M5,13.18V17.18L12,21L19,17.18V13.18L12,17L5,13.18Z"/></svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-coffee-900 text-sm">Biji Pilihan Petani Lokal</h4>
                        <p class="text-xs text-coffee-600 mt-1">Dipanen matang sempurna dari lereng pegunungan Gayo, Toraja, hingga Kintamani.</p>
                    </div>
                </div>

                <div class="flex items-start gap-4 p-4 rounded-2xl bg-coffee-50/50 hover:bg-coffee-50 transition scroll-reveal">
                    <div class="w-12 h-12 rounded-xl bg-amber-100 text-amber-700 flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-coffee-900 text-sm">Roasting Presisi Tinggi</h4>
                        <p class="text-xs text-coffee-600 mt-1">Profil sangrai medium-to-dark menjaga keseimbangan rasa manis, asam, dan body kopi.</p>
                    </div>
                </div>

                <div class="flex items-start gap-4 p-4 rounded-2xl bg-coffee-50/50 hover:bg-coffee-50 transition scroll-reveal">
                    <div class="w-12 h-12 rounded-xl bg-amber-100 text-amber-700 flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-coffee-900 text-sm">Pengiriman Cepat & Aman</h4>
                        <p class="text-xs text-coffee-600 mt-1">Kemasan double sealed kedap udara dengan valve satu arah menjaga kesegaran kopi.</p>
                    </div>
                </div>

                <div class="flex items-start gap-4 p-4 rounded-2xl bg-coffee-50/50 hover:bg-coffee-50 transition scroll-reveal">
                    <div class="w-12 h-12 rounded-xl bg-amber-100 text-amber-700 flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-coffee-900 text-sm">Garansi Rasa Kepuasan</h4>
                        <p class="text-xs text-coffee-600 mt-1">Kami menjamin setiap cangkir kopi yang Anda seduh memiliki kualitas barista kafe terbaik.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="py-16 bg-coffee-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 scroll-reveal">
                <div>
                    <span class="text-amber-600 text-xs font-bold uppercase tracking-widest block mb-1">Eksplorasi Rasa</span>
                    <h2 class="font-serif text-3xl font-bold text-coffee-900">Kategori Menu Kopi</h2>
                </div>
                <a href="<?php echo e(route('catalog.index')); ?>" class="mt-4 md:mt-0 text-sm font-semibold text-amber-700 hover:text-amber-800 flex items-center gap-1 group">
                    <span>Lihat Semua Kategori</span>
                    <svg class="w-4 h-4 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('catalog.index', ['category' => $category->slug])); ?>" 
                       class="group relative rounded-2xl overflow-hidden bg-white border border-coffee-200/80 shadow-sm hover:shadow-xl hover:-translate-y-1 transition duration-300 scroll-reveal">
                        <div class="h-36 overflow-hidden bg-coffee-100">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($category->image): ?>
                                <img src="<?php echo e(Str::startsWith($category->image, 'http') ? $category->image : asset('storage/' . $category->image)); ?>" 
                                     alt="<?php echo e($category->name); ?>" 
                                     class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                            <?php else: ?>
                                <div class="w-full h-full flex items-center justify-center bg-coffee-200 text-coffee-500 font-serif text-xl font-bold">
                                    ☕
                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                        <div class="p-4 text-center">
                            <h3 class="font-bold text-sm text-coffee-900 group-hover:text-amber-700 transition">
                                <?php echo e($category->name); ?>

                            </h3>
                            <span class="text-xs text-coffee-500 mt-1 block">
                                <?php echo e($category->products_count); ?> Menu Pilihan
                            </span>
                        </div>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Featured Products Section -->
    <section class="py-16 bg-white border-y border-coffee-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 scroll-reveal">
                <div>
                    <span class="text-amber-600 text-xs font-bold uppercase tracking-widest block mb-1">Rekomendasi Barista</span>
                    <h2 class="font-serif text-3xl font-bold text-coffee-900">Produk Kopi Unggulan</h2>
                    <p class="text-sm text-coffee-600 mt-1">Kopi terfavorit dengan racikan khas yang paling banyak dipesan para penikmat kopi.</p>
                </div>
                <a href="<?php echo e(route('catalog.index')); ?>" class="mt-4 md:mt-0 px-5 py-2.5 rounded-xl bg-coffee-100 hover:bg-amber-100/70 text-coffee-900 font-bold text-xs transition">
                    Lihat Katalog Lengkap →
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $featuredProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="bg-coffee-50/50 rounded-3xl border border-coffee-200/80 overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-1 transition duration-300 flex flex-col justify-between scroll-reveal">
                        <div>
                            <!-- Product Image & Badges -->
                            <div class="relative h-60 overflow-hidden bg-coffee-100">
                                <a href="<?php echo e(route('catalog.show', $product->slug)); ?>">
                                    <img src="<?php echo e($product->image_url); ?>" 
                                         alt="<?php echo e($product->name); ?>" 
                                         class="w-full h-full object-cover hover:scale-105 transition duration-500">
                                </a>

                                <div class="absolute top-4 left-4 flex flex-col gap-1.5">
                                    <span class="px-3 py-1 rounded-full text-xs font-bold bg-amber-600 text-white shadow">
                                        Unggulan
                                    </span>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($product->has_discount): ?>
                                        <span class="px-3 py-1 rounded-full text-xs font-bold bg-rose-600 text-white shadow">
                                            Hemat Rp <?php echo e(number_format($product->price - $product->discount_price, 0, ',', '.')); ?>

                                        </span>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>

                                <div class="absolute top-4 right-4">
                                    <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-white/90 backdrop-blur text-coffee-800 shadow-sm">
                                        <?php echo e($product->category->name ?? 'Kopi'); ?>

                                    </span>
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="p-6">
                                <a href="<?php echo e(route('catalog.show', $product->slug)); ?>" class="block">
                                    <h3 class="font-serif text-xl font-bold text-coffee-900 hover:text-amber-700 transition">
                                        <?php echo e($product->name); ?>

                                    </h3>
                                </a>
                                <p class="text-xs text-coffee-600 mt-2 line-clamp-2 leading-relaxed">
                                    <?php echo e($product->description); ?>

                                </p>

                                <div class="mt-4 flex items-center justify-between">
                                    <div>
                                        <span class="text-xs text-coffee-400 block font-medium">Harga</span>
                                        <div class="flex items-baseline gap-2">
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
                                    <div class="text-right">
                                        <span class="text-xs text-coffee-400 block font-medium">Stok</span>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($product->stock > 0): ?>
                                            <span class="text-xs font-semibold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-md border border-emerald-200">
                                                Tersedia (<?php echo e($product->stock); ?>)
                                            </span>
                                        <?php else: ?>
                                            <span class="text-xs font-semibold text-rose-700 bg-rose-50 px-2 py-0.5 rounded-md border border-rose-200">
                                                Habis
                                            </span>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Add to Cart Form -->
                        <div class="p-6 pt-0">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($product->stock > 0 && $product->status === 'active'): ?>
                                <form action="<?php echo e(route('cart.add')); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="w-full py-3 rounded-2xl bg-coffee-900 hover:bg-amber-700 text-white font-bold text-xs shadow-md transition flex items-center justify-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                                        Tambah ke Keranjang
                                    </button>
                                </form>
                            <?php else: ?>
                                <button disabled class="w-full py-3 rounded-2xl bg-coffee-200 text-coffee-400 font-semibold text-xs cursor-not-allowed">
                                    Stok Sedang Habis
                                </button>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Latest Products Section -->
    <section class="py-16 bg-coffee-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-12 scroll-reveal">
                <span class="text-amber-600 text-xs font-bold uppercase tracking-widest block mb-1">Menu Baru Kami</span>
                <h2 class="font-serif text-3xl font-bold text-coffee-900">Produk Terbaru Dari Roastery</h2>
                <p class="text-sm text-coffee-600 mt-2">Daftar seduhan terbaru dan varian biji kopi edisi terbatas yang siap memanjakan lidah Anda.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $latestProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="bg-white rounded-2xl border border-coffee-200/80 p-4 shadow-sm hover:shadow-lg transition flex flex-col justify-between scroll-reveal">
                        <div>
                            <div class="relative h-44 rounded-xl overflow-hidden bg-coffee-100 mb-4">
                                <a href="<?php echo e(route('catalog.show', $product->slug)); ?>">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($product->image): ?>
                                        <img src="<?php echo e(Str::startsWith($product->image, 'http') ? $product->image : asset('storage/' . $product->image)); ?>" 
                                             alt="<?php echo e($product->name); ?>" 
                                             class="w-full h-full object-cover hover:scale-105 transition duration-300">
                                    <?php else: ?>
                                        <div class="w-full h-full flex items-center justify-center bg-coffee-200 text-3xl">☕</div>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </a>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($product->has_discount): ?>
                                    <span class="absolute top-2 left-2 px-2 py-0.5 rounded-full text-[10px] font-bold bg-rose-600 text-white">
                                        PROMO
                                    </span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>

                            <span class="text-[11px] font-semibold text-amber-600 uppercase tracking-wider block">
                                <?php echo e($product->category->name ?? 'Kopi'); ?>

                            </span>
                            <a href="<?php echo e(route('catalog.show', $product->slug)); ?>" class="block mt-1">
                                <h3 class="font-bold text-sm text-coffee-900 line-clamp-1 hover:text-amber-700 transition">
                                    <?php echo e($product->name); ?>

                                </h3>
                            </a>
                            <div class="mt-2 flex items-baseline gap-2">
                                <span class="font-bold text-sm text-amber-700">
                                    Rp <?php echo e(number_format($product->effective_price, 0, ',', '.')); ?>

                                </span>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($product->has_discount): ?>
                                    <span class="text-[11px] text-coffee-400 line-through">
                                        Rp <?php echo e(number_format($product->price, 0, ',', '.')); ?>

                                    </span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        </div>

                        <div class="mt-4 pt-3 border-t border-coffee-100">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($product->stock > 0 && $product->status === 'active'): ?>
                                <form action="<?php echo e(route('cart.add')); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="w-full py-2 rounded-xl bg-coffee-100 hover:bg-amber-600 hover:text-white text-coffee-900 font-bold text-xs transition">
                                        + Pesan
                                    </button>
                                </form>
                            <?php else: ?>
                                <span class="block text-center text-xs text-rose-500 font-semibold py-2">
                                    Habis
                                </span>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="py-20 bg-coffee-950 text-white relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="space-y-6 scroll-reveal-left">
                    <span class="text-amber-400 text-xs font-bold uppercase tracking-widest block">Cerita Kami</span>
                    <h2 class="font-serif text-3xl sm:text-4xl font-bold leading-tight">
                        Tentang <?php echo e($settings->shop_name ?? 'Aura Coffee & Roastery'); ?>

                    </h2>
                    <p class="text-coffee-300 leading-relaxed text-sm sm:text-base font-light">
                        Berdiri dengan semangat menyajikan pengalaman minum kopi terbaik, kami memilih langsung biji kopi dari para petani lokal berdedikasi tinggi di Aceh Gayo, Toraja, Bali Kintamani, hingga Flores Bajawa.
                    </p>
                    <p class="text-coffee-300 leading-relaxed text-sm sm:text-base font-light">
                        Dengan teknik pemanggangan mikro (micro-batch roasting), setiap aroma dan karakter unik dari terroir tanah Indonesia dapat terekspresikan secara harmonis di cangkir Anda.
                    </p>
                    <div class="pt-2 flex items-center gap-6 text-sm">
                        <div class="flex items-center gap-2 text-amber-400">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                            <span>Specialty Grade Beans</span>
                        </div>
                        <div class="flex items-center gap-2 text-amber-400">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                            <span>Higienis & Halal</span>
                        </div>
                    </div>
                </div>

                <div class="relative scroll-reveal-right">
                    <div class="grid grid-cols-2 gap-4">
                        <img src="https://images.unsplash.com/photo-1442512595331-e89e73853f31?auto=format&fit=crop&w=600&q=80" alt="Latte Art" class="rounded-3xl object-cover h-64 w-full shadow-lg">
                        <img src="https://images.unsplash.com/photo-1511920170033-f8396924c348?auto=format&fit=crop&w=600&q=80" alt="Coffee Brewing" class="rounded-3xl object-cover h-64 w-full mt-8 shadow-lg">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact & Store Location Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-gradient-to-br from-coffee-100 to-amber-50 rounded-3xl p-8 lg:p-12 border border-coffee-200/80 shadow-sm scroll-reveal">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                    <div>
                        <span class="text-amber-600 text-xs font-bold uppercase tracking-widest block mb-2">Kunjungi Kafe Kami</span>
                        <h3 class="font-serif text-3xl font-bold text-coffee-900">
                            Nikmati Suasana Nyaman di Kedai Kopi Kami
                        </h3>
                        <p class="text-sm text-coffee-700 mt-3 leading-relaxed">
                            Butuh tempat santai untuk bekerja (WFC), berbincang bersama teman, atau sekadar menikmati secangkir manual brew hangat? Barista kami siap menyambut Anda.
                        </p>

                        <div class="mt-6 space-y-3 text-sm text-coffee-800">
                            <p class="flex items-center gap-3">
                                <span class="w-8 h-8 rounded-lg bg-amber-600 text-white flex items-center justify-center shrink-0">📍</span>
                                <strong><?php echo e($settings->address ?? 'Jl. Sutomo No. 45, Pematangsiantar, Sumatera Utara'); ?></strong>
                            </p>
                            <p class="flex items-center gap-3">
                                <span class="w-8 h-8 rounded-lg bg-amber-600 text-white flex items-center justify-center shrink-0">⏰</span>
                                <span>Buka Setiap Hari: <strong>08.00 - 22.00 WIB</strong></span>
                            </p>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-coffee-200 text-center space-y-4">
                        <div class="w-16 h-16 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center mx-auto text-3xl">
                            💬
                        </div>
                        <h4 class="font-bold text-coffee-900 text-lg">Konsultasi Biji Kopi & Pemesanan Cepat</h4>
                        <p class="text-xs text-coffee-600">
                            Ingin rekomendasi kopi sesuai selera gilingan atau pemesanan event dalam jumlah banyak? Hubungi tim barista kami via WhatsApp.
                        </p>
                        <a href="https://wa.me/<?php echo e(preg_replace('/[^0-9]/', '', $settings->whatsapp_number ?? '081234567890')); ?>" 
                           target="_blank" 
                           class="inline-flex items-center justify-center gap-2 w-full py-3.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-sm shadow-md transition">
                            <span>Hubungi Barista di WhatsApp</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ACER NITRO\Documents\COFFEE SHOP\resources\views/frontend/home.blade.php ENDPATH**/ ?>