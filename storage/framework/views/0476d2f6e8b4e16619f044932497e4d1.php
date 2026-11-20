<?php $__env->startSection('title', 'Lacak & Riwayat Pesanan - ' . ($settings->shop_name ?? 'Aura Coffee')); ?>

<?php $__env->startSection('content'); ?>
    <div class="py-12 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl mx-auto text-center mb-10">
            <span class="text-xs uppercase tracking-widest text-amber-600 font-bold block mb-1">Status Kopi Anda</span>
            <h1 class="font-serif text-3xl font-bold text-coffee-950">Lacak & Cek Riwayat Pesanan</h1>
            <p class="text-xs sm:text-sm text-coffee-500 mt-2 font-light">
                Masukkan nomor invoice pesanan Anda (misal: <strong class="text-coffee-800">INV-20261118-001</strong>) atau nomor WhatsApp yang Anda gunakan saat pemesanan.
            </p>

            <!-- Search Form -->
            <form action="<?php echo e(route('order.history')); ?>" method="GET" class="mt-6 flex flex-col sm:flex-row gap-3">
                <div class="relative flex-grow">
                    <input type="text" 
                           name="query" 
                           value="<?php echo e($queryValue); ?>" 
                           required
                           placeholder="Ketik Nomor Invoice atau No. WhatsApp..." 
                           class="w-full pl-11 pr-4 py-3.5 rounded-2xl border border-coffee-200 text-sm focus:outline-none focus:border-amber-600 focus:ring-1 focus:ring-amber-600 bg-white shadow-sm">
                    <div class="absolute left-4 top-3.5 text-coffee-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                </div>
                <button type="submit" class="px-8 py-3.5 rounded-2xl bg-amber-600 hover:bg-amber-700 text-white font-bold text-sm shadow-md transition flex items-center justify-center gap-2">
                    <span>Lacak Pesanan</span>
                </button>
            </form>
        </div>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($queryValue): ?>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($orders->isEmpty()): ?>
                <div class="bg-white rounded-3xl border border-coffee-200/80 p-10 text-center max-w-md mx-auto shadow-sm">
                    <div class="w-16 h-16 rounded-full bg-rose-50 text-rose-500 flex items-center justify-center mx-auto text-3xl mb-3">
                        🔍
                    </div>
                    <h3 class="font-serif text-lg font-bold text-coffee-900">Pesanan Tidak Ditemukan</h3>
                    <p class="text-xs text-coffee-500 mt-2">
                        Tidak ada riwayat transaksi dengan nomor invoice atau nomor telepon "<?php echo e($queryValue); ?>". Pastikan penulisan sudah benar.
                    </p>
                </div>
            <?php else: ?>
                <div class="space-y-4 max-w-3xl mx-auto">
                    <p class="text-xs text-coffee-600 font-semibold mb-2">
                        Ditemukan <?php echo e($orders->total()); ?> pesanan untuk pencarian "<?php echo e($queryValue); ?>":
                    </p>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="bg-white rounded-2xl border border-coffee-200/80 p-6 shadow-sm hover:shadow-md transition">
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-coffee-100">
                                <div>
                                    <span class="text-xs text-coffee-400 block font-mono">Invoice</span>
                                    <span class="font-serif text-lg font-bold text-coffee-950"><?php echo e($order->invoice_number); ?></span>
                                    <span class="text-xs text-coffee-500 block mt-0.5">
                                        <?php echo e($order->order_date->format('d M Y, H:i')); ?> WIB
                                    </span>
                                </div>

                                <div class="flex items-center gap-2 flex-wrap">
                                    <!-- Payment Status Badge -->
                                    <span class="px-3 py-1 rounded-full text-xs font-bold 
                                        <?php if($order->payment_status === 'Paid'): ?> bg-emerald-100 text-emerald-800
                                        <?php elseif($order->payment_status === 'Unpaid'): ?> bg-amber-100 text-amber-800
                                        <?php else: ?> bg-rose-100 text-rose-800 <?php endif; ?>">
                                        <?php echo e($order->payment_status === 'Paid' ? 'Lunas' : ($order->payment_status === 'Unpaid' ? 'Belum Bayar' : $order->payment_status)); ?>

                                    </span>

                                    <!-- Order Status Badge -->
                                    <span class="px-3 py-1 rounded-full text-xs font-bold 
                                        <?php if($order->status === 'Completed'): ?> bg-emerald-600 text-white
                                        <?php elseif($order->status === 'Processing'): ?> bg-blue-600 text-white
                                        <?php elseif($order->status === 'Shipped'): ?> bg-purple-600 text-white
                                        <?php elseif($order->status === 'Pending'): ?> bg-amber-500 text-white
                                        <?php else: ?> bg-rose-600 text-white <?php endif; ?>">
                                        <?php echo e(match($order->status) {
                                            'Pending' => 'Pending',
                                            'Processing' => 'Sedang Diracik',
                                            'Shipped' => 'Dalam Pengiriman',
                                            'Completed' => 'Selesai',
                                            'Cancelled' => 'Dibatalkan',
                                            default => $order->status
                                        }); ?>

                                    </span>
                                </div>
                            </div>

                            <!-- Items Summary -->
                            <div class="py-4 text-xs text-coffee-700 space-y-1">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="flex justify-between">
                                        <span><?php echo e($item->product_name); ?> x <?php echo e($item->quantity); ?></span>
                                        <span class="font-semibold text-coffee-900">Rp <?php echo e(number_format($item->subtotal, 0, ',', '.')); ?></span>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>

                            <div class="pt-4 border-t border-coffee-100 flex flex-col sm:flex-row items-center justify-between gap-4">
                                <div class="text-left w-full sm:w-auto">
                                    <span class="text-xs text-coffee-400">Total Pembayaran:</span>
                                    <span class="font-bold text-base text-amber-700 block">
                                        Rp <?php echo e(number_format($order->total_amount, 0, ',', '.')); ?>

                                    </span>
                                </div>

                                <div class="flex items-center gap-3 w-full sm:w-auto justify-end">
                                    <a href="<?php echo e(route('order.invoice', $order->invoice_number)); ?>" 
                                       target="_blank" 
                                       class="px-4 py-2 rounded-xl bg-coffee-100 hover:bg-coffee-200 text-coffee-800 text-xs font-bold transition">
                                        Cetak Invoice
                                    </a>
                                    <a href="<?php echo e(route('order.show', $order->invoice_number)); ?>" 
                                       class="px-5 py-2 rounded-xl bg-amber-600 hover:bg-amber-700 text-white text-xs font-bold shadow transition">
                                        Lihat Detail
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    <div class="pt-6">
                        <?php echo e($orders->links()); ?>

                    </div>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <?php else: ?>
            <!-- Instruction Info -->
            <div class="max-w-xl mx-auto bg-white rounded-3xl border border-coffee-200/80 p-8 shadow-sm">
                <h3 class="font-serif text-lg font-bold text-coffee-900 mb-4 flex items-center gap-2">
                    <span>💡</span> Cara Melacak Pesanan Kopi Anda
                </h3>
                <ul class="space-y-3 text-xs text-coffee-600 leading-relaxed list-disc list-inside">
                    <li>Setelah melakukan checkout, Anda akan mendapatkan <strong>Nomor Invoice</strong> unik (contoh: <em>INV-20261118-XXXX</em>).</li>
                    <li>Ketik nomor invoice tersebut pada kotak pencarian di atas untuk memeriksa apakah barista kami sedang meracik kopi Anda.</li>
                    <li>Bila lupa nomor invoice, cukup masukkan <strong>Nomor WhatsApp</strong> yang digunakan saat checkout.</li>
                    <li>Anda juga dapat langsung mengunggah bukti transfer bank atau mencetak struk invoice resmi.</li>
                </ul>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ACER NITRO\Documents\COFFEE SHOP\resources\views/frontend/order/history.blade.php ENDPATH**/ ?>