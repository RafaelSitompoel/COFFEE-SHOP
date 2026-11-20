<?php $__env->startSection('title', $product->name . ' - ' . ($settings->shop_name ?? 'Aura Coffee')); ?>

<?php $__env->startSection('content'); ?>
    <!-- Breadcrumb -->
    <div class="bg-white border-b border-coffee-100 py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex text-xs text-coffee-500 font-medium">
                <a href="<?php echo e(route('home')); ?>" class="hover:text-amber-700">Beranda</a>
                <span class="mx-2 text-coffee-300">/</span>
                <a href="<?php echo e(route('catalog.index')); ?>" class="hover:text-amber-700">Menu Kopi</a>
                <span class="mx-2 text-coffee-300">/</span>
                <a href="<?php echo e(route('catalog.index', ['category' => $product->category->slug])); ?>" class="hover:text-amber-700">
                    <?php echo e($product->category->name); ?>

                </a>
                <span class="mx-2 text-coffee-300">/</span>
                <span class="text-coffee-900 font-bold truncate"><?php echo e($product->name); ?></span>
            </nav>
        </div>
    </div>

    <!-- Product Detail Section -->
    <div class="py-12 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-3xl border border-coffee-200/80 shadow-sm p-6 sm:p-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
                <!-- Product Image Gallery -->
                <div class="lg:col-span-6">
                    <div class="relative rounded-3xl overflow-hidden bg-coffee-100 border border-coffee-200/60 shadow-inner h-[400px] sm:h-[480px]">
                        <img src="<?php echo e($product->image_url); ?>" 
                             alt="<?php echo e($product->name); ?>" 
                             class="w-full h-full object-cover">

                        <div class="absolute top-4 left-4 flex flex-col gap-2">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($product->is_featured): ?>
                                <span class="px-3 py-1 rounded-full text-xs font-bold bg-amber-600 text-white shadow">
                                    Menu Unggulan
                                </span>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($product->has_discount): ?>
                                <span class="px-3 py-1 rounded-full text-xs font-bold bg-rose-600 text-white shadow">
                                    Diskon Spesial
                                </span>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Product Information & Order Actions -->
                <div class="lg:col-span-6 flex flex-col justify-between" x-data="{ qty: 1, maxStock: <?php echo e($product->stock); ?> }">
                    <div class="space-y-6">
                        <!-- Category & SKU -->
                        <div class="flex items-center justify-between">
                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-coffee-100 text-coffee-800">
                                <?php echo e($product->category->name); ?>

                            </span>
                            <span class="text-xs text-coffee-400 font-mono">
                                SKU: <?php echo e($product->sku); ?>

                            </span>
                        </div>

                        <!-- Product Title -->
                        <h1 class="font-serif text-3xl sm:text-4xl font-bold text-coffee-950 leading-tight">
                            <?php echo e($product->name); ?>

                        </h1>

                        <!-- Pricing -->
                        <div class="p-4 rounded-2xl bg-coffee-50/80 border border-coffee-200/60">
                            <span class="text-xs text-coffee-500 font-medium block">Harga Produk</span>
                            <div class="flex items-baseline gap-3 mt-1">
                                <span class="font-serif text-3xl font-bold text-amber-700">
                                    Rp <?php echo e(number_format($product->effective_price, 0, ',', '.')); ?>

                                </span>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($product->has_discount): ?>
                                    <span class="text-base text-coffee-400 line-through">
                                        Rp <?php echo e(number_format($product->price, 0, ',', '.')); ?>

                                    </span>
                                    <span class="text-xs font-bold text-rose-600 bg-rose-50 px-2.5 py-1 rounded-lg border border-rose-200">
                                        Hemat Rp <?php echo e(number_format($product->price - $product->discount_price, 0, ',', '.')); ?>

                                    </span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        </div>

                        <!-- Stock Status -->
                        <div class="flex items-center gap-3">
                            <span class="text-xs font-semibold text-coffee-600">Status Stok:</span>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($product->stock > 0 && $product->status === 'active'): ?>
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                    Tersedia (<?php echo e($product->stock); ?> porsi)
                                </span>
                            <?php else: ?>
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-rose-50 text-rose-700 border border-rose-200">
                                    <span class="w-2 h-2 rounded-full bg-rose-500"></span>
                                    Stok Habis / Sementara Tidak Dijual
                                </span>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>

                        <!-- Description -->
                        <div class="border-t border-coffee-100 pt-4">
                            <h3 class="text-sm font-bold text-coffee-900 mb-2">Deskripsi & Catatan Rasa</h3>
                            <p class="text-sm text-coffee-600 leading-relaxed font-light">
                                <?php echo e($product->description); ?>

                            </p>
                        </div>
                    </div>

                    <!-- Add to Cart Form -->
                    <div class="border-t border-coffee-100 pt-6 mt-8">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($product->stock > 0 && $product->status === 'active'): ?>
                            <form action="<?php echo e(route('cart.add')); ?>" method="POST" class="space-y-4">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>">

                                <div class="flex flex-col sm:flex-row items-center gap-4">
                                    <!-- Quantity Stepper -->
                                    <div class="flex items-center rounded-2xl border border-coffee-300 bg-coffee-50 p-1 w-full sm:w-auto">
                                        <button type="button" 
                                                @click="if (qty > 1) qty--" 
                                                class="w-10 h-10 rounded-xl bg-white text-coffee-800 hover:bg-amber-100 flex items-center justify-center font-bold text-lg shadow-sm transition">
                                            -
                                        </button>
                                        <input type="number" 
                                               name="quantity" 
                                               x-model="qty" 
                                               min="1" 
                                               :max="maxStock" 
                                               class="w-16 text-center bg-transparent border-0 font-bold text-coffee-950 focus:outline-none">
                                        <button type="button" 
                                                @click="if (qty < maxStock) qty++" 
                                                class="w-10 h-10 rounded-xl bg-white text-coffee-800 hover:bg-amber-100 flex items-center justify-center font-bold text-lg shadow-sm transition">
                                            +
                                        </button>
                                    </div>

                                    <!-- Submit Button -->
                                    <button type="submit" class="flex-grow w-full py-4 px-6 rounded-2xl bg-coffee-950 hover:bg-amber-700 text-white font-bold text-sm shadow-xl transition flex items-center justify-center gap-2">
                                        <svg class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                                        <span>Masukkan ke Keranjang</span>
                                    </button>
                                </div>
                            </form>
                        <?php else: ?>
                            <button disabled class="w-full py-4 rounded-2xl bg-coffee-100 text-coffee-400 font-bold text-sm cursor-not-allowed">
                                Produk Sedang Tidak Tersedia
                            </button>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Products Section -->
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($relatedProducts->isNotEmpty()): ?>
            <div class="mt-16">
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <span class="text-xs uppercase tracking-widest text-amber-600 font-bold block mb-1">Menu Serupa</span>
                        <h2 class="font-serif text-2xl font-bold text-coffee-900">Produk Terkait Dari Kategori Ini</h2>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $relatedProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="bg-white rounded-2xl border border-coffee-200/80 p-4 shadow-sm hover:shadow-md transition flex flex-col justify-between">
                            <div>
                                <div class="relative h-40 rounded-xl overflow-hidden bg-coffee-100 mb-3">
                                    <a href="<?php echo e(route('catalog.show', $rel->slug)); ?>">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($rel->image): ?>
                                            <img src="<?php echo e(Str::startsWith($rel->image, 'http') ? $rel->image : asset('storage/' . $rel->image)); ?>" 
                                                 alt="<?php echo e($rel->name); ?>" 
                                                 class="w-full h-full object-cover hover:scale-105 transition">
                                        <?php else: ?>
                                            <div class="w-full h-full flex items-center justify-center bg-coffee-200 text-3xl">☕</div>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </a>
                                </div>
                                <a href="<?php echo e(route('catalog.show', $rel->slug)); ?>" class="font-bold text-sm text-coffee-900 line-clamp-1 hover:text-amber-700 transition">
                                    <?php echo e($rel->name); ?>

                                </a>
                                <div class="mt-2 text-sm font-bold text-amber-700">
                                    Rp <?php echo e(number_format($rel->effective_price, 0, ',', '.')); ?>

                                </div>
                            </div>

                            <a href="<?php echo e(route('catalog.show', $rel->slug)); ?>" class="mt-4 block text-center py-2 rounded-xl bg-coffee-50 hover:bg-amber-600 hover:text-white text-coffee-800 font-bold text-xs transition">
                                Lihat Menu
                            </a>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ACER NITRO\Documents\COFFEE SHOP\resources\views/frontend/catalog/show.blade.php ENDPATH**/ ?>