<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Aura Coffee & Roastery - Artisanal Coffee Experience'); ?></title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Playfair+Display:ital,wght@0,600;0,700;0,800;1,600&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        serif: ['"Playfair Display"', 'serif'],
                    },
                    colors: {
                        coffee: {
                            50: '#FDFBF7',
                            100: '#F7F2EB',
                            200: '#EFE5D8',
                            300: '#DCC7AF',
                            400: '#C4A482',
                            500: '#A7815B',
                            600: '#8A623C',
                            700: '#684729',
                            800: '#4A311C',
                            900: '#2A1A0E',
                            950: '#1A0F07',
                        },
                        amber: {
                            400: '#FBBF24',
                            500: '#F59E0B',
                            600: '#D97706',
                            700: '#B45309',
                        }
                    }
                }
            }
        }
    </script>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.3/dist/cdn.min.js"></script>

    <!-- Lenis Smooth Scroll -->
    <script src="https://cdn.jsdelivr.net/npm/lenis@1.1.20/dist/lenis.min.js"></script>

    <style>
        [x-cloak] { display: none !important; }

        html {
            scroll-behavior: smooth;
        }

        html.lenis, html.lenis body {
            height: auto;
        }

        .lenis.lenis-smooth {
            scroll-behavior: auto !important;
        }

        .lenis.lenis-smooth [data-lenis-prevent] {
            overscroll-behavior: contain;
        }

        .lenis.lenis-stopped {
            overflow: hidden;
        }

        /* Scroll Reveal Animation Styles */
        .scroll-reveal {
            opacity: 0;
            transform: translateY(32px);
            transition: opacity 0.8s cubic-bezier(0.16, 1, 0.3, 1), transform 0.8s cubic-bezier(0.16, 1, 0.3, 1);
            will-change: opacity, transform;
        }

        .scroll-reveal.revealed {
            opacity: 1;
            transform: translateY(0);
        }

        .scroll-reveal-left {
            opacity: 0;
            transform: translateX(-40px);
            transition: opacity 0.8s cubic-bezier(0.16, 1, 0.3, 1), transform 0.8s cubic-bezier(0.16, 1, 0.3, 1);
            will-change: opacity, transform;
        }

        .scroll-reveal-left.revealed {
            opacity: 1;
            transform: translateX(0);
        }

        .scroll-reveal-right {
            opacity: 0;
            transform: translateX(40px);
            transition: opacity 0.8s cubic-bezier(0.16, 1, 0.3, 1), transform 0.8s cubic-bezier(0.16, 1, 0.3, 1);
            will-change: opacity, transform;
        }

        .scroll-reveal-right.revealed {
            opacity: 1;
            transform: translateX(0);
        }

        .hero-pattern {
            background-color: #1A0F07;
            background-image: radial-gradient(#4A311C 1px, transparent 1px);
            background-size: 24px 24px;
        }
    </style>
</head>
<body class="bg-coffee-50 text-coffee-950 font-sans antialiased flex flex-col min-h-screen">

    <!-- Top Announcement Bar -->
    <div class="bg-coffee-950 text-coffee-300 text-xs py-2 px-4 text-center border-b border-coffee-800">
        <div class="max-w-7xl mx-auto flex justify-between items-center px-4">
            <span class="flex items-center gap-2">
                <span class="inline-block w-2 h-2 rounded-full bg-amber-400 animate-pulse"></span>
                Freshly Roasted Coffee Beans Nusantara & Special Brews
            </span>
            <div class="hidden md:flex items-center gap-4 text-coffee-400">
                <a href="https://wa.me/<?php echo e(preg_replace('/[^0-9]/', '', $settings->whatsapp_number ?? '081234567890')); ?>" target="_blank" class="hover:text-amber-400 transition">
                    WhatsApp: <?php echo e($settings->whatsapp_number ?? '081234567890'); ?>

                </a>
                <span>•</span>
                <a href="<?php echo e(url('/admin')); ?>" class="hover:text-amber-400 transition font-medium">Dashboard Admin</a>
            </div>
        </div>
    </div>

    <!-- Main Navigation Bar -->
    <header x-data="{ mobileMenuOpen: false }" class="sticky top-0 z-40 bg-white/95 backdrop-blur border-b border-coffee-100 shadow-sm transition">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Brand / Logo -->
                <a href="<?php echo e(route('home')); ?>" class="flex items-center gap-3 group">
                    <div class="w-11 h-11 rounded-2xl bg-gradient-to-br from-coffee-800 to-coffee-950 flex items-center justify-center text-amber-400 shadow-md group-hover:scale-105 transition duration-300">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M2,21H20V19H2M20,8H18V5H20M20,3H4V13A4,4 0 0,0 8,17H14A4,4 0 0,0 18,13V10H20A2,2 0 0,0 22,8V5C22,3.89 21.1,3 20,3Z"/>
                        </svg>
                    </div>
                    <div>
                        <span class="font-serif text-2xl font-bold tracking-tight text-coffee-900 block leading-tight">
                            <?php echo e($settings->shop_name ?? 'Aura Coffee'); ?>

                        </span>
                        <span class="text-xs uppercase tracking-widest text-coffee-500 font-semibold block">
                            Artisanal Roastery
                        </span>
                    </div>
                </a>

                <!-- Desktop Navigation Links -->
                <nav class="hidden md:flex items-center space-x-8">
                    <a href="<?php echo e(route('home')); ?>" class="font-medium text-sm transition <?php echo e(request()->routeIs('home') ? 'text-amber-600 font-semibold' : 'text-coffee-800 hover:text-amber-600'); ?>">
                        Beranda
                    </a>
                    <a href="<?php echo e(route('catalog.index')); ?>" class="font-medium text-sm transition <?php echo e(request()->routeIs('catalog.*') ? 'text-amber-600 font-semibold' : 'text-coffee-800 hover:text-amber-600'); ?>">
                        Menu Kopi
                    </a>
                    <a href="<?php echo e(route('order.history')); ?>" class="font-medium text-sm transition <?php echo e(request()->routeIs('order.*') ? 'text-amber-600 font-semibold' : 'text-coffee-800 hover:text-amber-600'); ?>">
                        Lacak Pesanan
                    </a>
                </nav>

                <!-- Header Actions (Cart & Admin) -->
                <div class="flex items-center gap-4">
                    <?php
                        $cartCount = array_sum(array_column(session('cart', []), 'quantity'));
                    ?>

                    <!-- Cart Button -->
                    <a href="<?php echo e(route('cart.index')); ?>" class="relative p-2.5 rounded-xl bg-coffee-100/70 hover:bg-amber-100/60 text-coffee-800 hover:text-amber-700 transition flex items-center gap-2 group">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                        </svg>
                        <span class="hidden sm:inline text-xs font-bold text-coffee-900">Keranjang</span>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($cartCount > 0): ?>
                            <span class="inline-flex items-center justify-center px-2 py-0.5 text-xs font-bold leading-none text-white bg-amber-600 rounded-full animate-bounce">
                                <?php echo e($cartCount); ?>

                            </span>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </a>

                    <!-- Admin Portal Link -->
                    <a href="<?php echo e(url('/admin')); ?>" class="hidden lg:inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl text-xs font-semibold bg-coffee-900 text-coffee-100 hover:bg-coffee-800 transition">
                        <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                        Admin
                    </a>

                    <!-- Mobile Menu Hamburger Button -->
                    <button @click="mobileMenuOpen = !mobileMenuOpen" type="button" class="md:hidden p-2 rounded-lg text-coffee-700 hover:text-coffee-950 focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                            <path x-show="mobileMenuOpen" x-cloak stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu Drawer -->
        <div x-show="mobileMenuOpen" x-cloak class="md:hidden border-t border-coffee-100 bg-white px-4 pt-3 pb-6 space-y-2 shadow-lg">
            <a href="<?php echo e(route('home')); ?>" class="block px-3 py-2 rounded-lg text-base font-medium text-coffee-900 hover:bg-coffee-50 <?php echo e(request()->routeIs('home') ? 'bg-coffee-100 font-bold text-amber-600' : ''); ?>">
                Beranda
            </a>
            <a href="<?php echo e(route('catalog.index')); ?>" class="block px-3 py-2 rounded-lg text-base font-medium text-coffee-900 hover:bg-coffee-50 <?php echo e(request()->routeIs('catalog.*') ? 'bg-coffee-100 font-bold text-amber-600' : ''); ?>">
                Menu Kopi
            </a>
            <a href="<?php echo e(route('order.history')); ?>" class="block px-3 py-2 rounded-lg text-base font-medium text-coffee-900 hover:bg-coffee-50 <?php echo e(request()->routeIs('order.*') ? 'bg-coffee-100 font-bold text-amber-600' : ''); ?>">
                Lacak Pesanan
            </a>
            <a href="<?php echo e(url('/admin')); ?>" class="block px-3 py-2 rounded-lg text-base font-medium text-amber-700 hover:bg-coffee-50">
                Dashboard Admin
            </a>
        </div>
    </header>

    <!-- Global Flash Alerts -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4 w-full">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
            <div x-data="{ show: true }" x-show="show" class="mb-4 flex items-center justify-between p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-2xl shadow-sm">
                <div class="flex items-center gap-3">
                    <svg class="w-6 h-6 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span class="text-sm font-semibold"><?php echo e(session('success')); ?></span>
                </div>
                <button @click="show = false" class="text-emerald-500 hover:text-emerald-700">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('error')): ?>
            <div x-data="{ show: true }" x-show="show" class="mb-4 flex items-center justify-between p-4 bg-rose-50 border border-rose-200 text-rose-800 rounded-2xl shadow-sm">
                <div class="flex items-center gap-3">
                    <svg class="w-6 h-6 text-rose-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span class="text-sm font-semibold"><?php echo e(session('error')); ?></span>
                </div>
                <button @click="show = false" class="text-rose-500 hover:text-rose-700">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($errors->any()): ?>
            <div class="mb-4 p-4 bg-rose-50 border border-rose-200 text-rose-800 rounded-2xl shadow-sm">
                <p class="font-bold text-sm mb-1">Harap periksa kembali input Anda:</p>
                <ul class="list-disc list-inside text-xs space-y-1">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </ul>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>

    <!-- Main Page Content -->
    <main class="flex-grow">
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <!-- Floating Scroll-to-Top Button -->
    <button id="back-to-top" 
            class="fixed bottom-6 right-6 z-50 p-3.5 rounded-2xl bg-coffee-950 text-amber-400 hover:bg-amber-600 hover:text-white shadow-2xl border border-coffee-800/80 transition-all duration-300 opacity-0 pointer-events-none translate-y-4 hover:scale-110 cursor-pointer"
            title="Kembali ke Atas"
            aria-label="Kembali ke Atas">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
        </svg>
    </button>

    <!-- Footer -->
    <footer class="bg-coffee-950 text-coffee-200 border-t border-coffee-900 mt-20 pt-16 pb-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 pb-12 border-b border-coffee-800">
                <!-- Shop Profile -->
                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-amber-600 flex items-center justify-center text-white">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M2,21H20V19H2M20,8H18V5H20M20,3H4V13A4,4 0 0,0 8,17H14A4,4 0 0,0 18,13V10H20A2,2 0 0,0 22,8V5C22,3.89 21.1,3 20,3Z"/>
                            </svg>
                        </div>
                        <span class="font-serif text-2xl font-bold text-white"><?php echo e($settings->shop_name ?? 'Aura Coffee'); ?></span>
                    </div>
                    <p class="text-sm text-coffee-400 leading-relaxed">
                        <?php echo e($settings->description ?? 'Menyajikan biji kopi artisanal pilihan Nusantara dengan proses roasting teliti dan rasa yang berkesan.'); ?>

                    </p>
                    <div class="flex items-center gap-3 pt-2">
                        <a href="https://wa.me/<?php echo e(preg_replace('/[^0-9]/', '', $settings->whatsapp_number ?? '081234567890')); ?>" target="_blank" class="w-9 h-9 rounded-full bg-emerald-600/30 text-emerald-400 flex items-center justify-center hover:bg-emerald-600 hover:text-white transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21 5.46 0 9.91-4.45 9.91-9.91 0-2.65-1.03-5.14-2.9-7.01A9.816 9.816 0 0 0 12.04 2m.01 1.67c2.2 0 4.26.86 5.82 2.42a8.225 8.225 0 0 1 2.41 5.83c0 4.54-3.7 8.24-8.24 8.24-1.48 0-2.93-.4-4.2-1.15l-.3-.18-3.12.82.83-3.04-.2-.31a8.196 8.196 0 0 1-1.26-4.38c0-4.54 3.7-8.24 8.24-8.24m4.52 11.66c-.25-.13-1.47-.72-1.7-.81-.23-.08-.39-.13-.56.13-.17.25-.64.81-.79.97-.14.17-.29.19-.54.06s-1.05-.39-2-1.23c-.74-.66-1.24-1.47-1.39-1.72-.14-.25-.02-.38.11-.51.11-.11.25-.29.37-.44.13-.14.17-.25.25-.42.08-.17.04-.31-.02-.44s-.56-1.36-.77-1.86c-.2-.49-.41-.42-.56-.43h-.48c-.17 0-.44.06-.67.31-.23.25-.88.86-.88 2.1s.9 2.43 1.03 2.6c.13.17 1.77 2.7 4.28 3.79.6.26 1.07.41 1.43.53.6.19 1.15.16 1.58.1.48-.07 1.47-.6 1.68-1.18.21-.58.21-1.07.15-1.18-.06-.11-.23-.17-.48-.29z"/></svg>
                        </a>
                        <span class="text-xs text-coffee-400">Pesan via WhatsApp</span>
                    </div>
                </div>

                <!-- Navigation Quick Links -->
                <div>
                    <h3 class="text-white font-bold text-base mb-4 tracking-wide font-serif">Menu & Layanan</h3>
                    <ul class="space-y-2.5 text-sm text-coffee-400">
                        <li><a href="<?php echo e(route('home')); ?>" class="hover:text-amber-400 transition">Beranda Utama</a></li>
                        <li><a href="<?php echo e(route('catalog.index')); ?>" class="hover:text-amber-400 transition">Katalog Seluruh Menu</a></li>
                        <li><a href="<?php echo e(route('catalog.index', ['sort' => 'latest'])); ?>" class="hover:text-amber-400 transition">Kopi Spesial Terbaru</a></li>
                        <li><a href="<?php echo e(route('cart.index')); ?>" class="hover:text-amber-400 transition">Keranjang Belanja</a></li>
                        <li><a href="<?php echo e(route('order.history')); ?>" class="hover:text-amber-400 transition">Cek Status & Invoice</a></li>
                    </ul>
                </div>

                <!-- Location & Contact -->
                <div>
                    <h3 class="text-white font-bold text-base mb-4 tracking-wide font-serif">Lokasi & Kontak</h3>
                    <ul class="space-y-3 text-sm text-coffee-400">
                        <li class="flex items-start gap-2.5">
                            <svg class="w-5 h-5 text-amber-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            <span><?php echo e($settings->address ?? 'Jl. Sutomo No. 45, Pematangsiantar, Sumatera Utara'); ?></span>
                        </li>
                        <li class="flex items-center gap-2.5">
                            <svg class="w-5 h-5 text-amber-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            <span><?php echo e($settings->email ?? 'halo@auracoffee.id'); ?></span>
                        </li>
                        <li class="flex items-center gap-2.5">
                            <svg class="w-5 h-5 text-amber-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <span>Buka Setiap Hari: 08:00 - 22:00 WIB</span>
                        </li>
                    </ul>
                </div>

                <!-- Payment Methods Info -->
                <div>
                    <h3 class="text-white font-bold text-base mb-4 tracking-wide font-serif">Metode Pembayaran</h3>
                    <p class="text-xs text-coffee-400 mb-3 leading-relaxed">
                        Kami menerima pembayaran melalui Transfer Bank resmi serta Cash on Delivery (COD).
                    </p>
                    <div class="bg-coffee-900/80 p-3 rounded-xl border border-coffee-800 text-xs text-coffee-300 whitespace-pre-line font-mono">
                        <?php echo e($settings->bank_info ?? "BCA: 8820 1928 31\nMandiri: 137 00 1928 3740"); ?>

                    </div>
                </div>
            </div>

            <!-- Bottom Copyright -->
            <div class="pt-8 flex flex-col md:flex-row justify-between items-center gap-4 text-xs text-coffee-500">
                <p>&copy; <?php echo e(date('Y')); ?> <?php echo e($settings->shop_name ?? 'Aura Coffee & Roastery'); ?>. All rights reserved.</p>
                <div class="flex items-center gap-6">
                    <span>Monolithic Laravel Architecture</span>
                    <span>•</span>
                    <a href="<?php echo e(url('/admin')); ?>" class="text-amber-500 hover:underline">Filament Admin Dashboard</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Smooth Scroll Engine & Scroll Reveal Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // 1. Initialize Lenis Smooth Scroll Engine
            let lenis = null;
            if (typeof Lenis !== 'undefined') {
                lenis = new Lenis({
                    duration: 1.2,
                    easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
                    orientation: 'vertical',
                    gestureOrientation: 'vertical',
                    smoothWheel: true,
                    wheelMultiplier: 1.05,
                    touchMultiplier: 1.5,
                });

                function raf(time) {
                    lenis.raf(time);
                    requestAnimationFrame(raf);
                }
                requestAnimationFrame(raf);
            }

            // 2. Smooth Scroll for all internal hash anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    const href = this.getAttribute('href');
                    if (href && href !== '#') {
                        const target = document.querySelector(href);
                        if (target) {
                            e.preventDefault();
                            if (lenis) {
                                lenis.scrollTo(target, { offset: -80, duration: 1.2 });
                            } else {
                                target.scrollIntoView({ behavior: 'smooth' });
                            }
                        }
                    }
                });
            });

            // 3. Floating Scroll-to-Top Button
            const backToTopBtn = document.getElementById('back-to-top');
            if (backToTopBtn) {
                window.addEventListener('scroll', function () {
                    if (window.scrollY > 300) {
                        backToTopBtn.classList.remove('opacity-0', 'pointer-events-none', 'translate-y-4');
                        backToTopBtn.classList.add('opacity-100', 'pointer-events-auto', 'translate-y-0');
                    } else {
                        backToTopBtn.classList.remove('opacity-100', 'pointer-events-auto', 'translate-y-0');
                        backToTopBtn.classList.add('opacity-0', 'pointer-events-none', 'translate-y-4');
                    }
                });

                backToTopBtn.addEventListener('click', function () {
                    if (lenis) {
                        lenis.scrollTo(0, { duration: 1.2 });
                    } else {
                        window.scrollTo({ top: 0, behavior: 'smooth' });
                    }
                });
            }

            // 4. Scroll Reveal Animations on Viewport Intersection
            const revealElements = document.querySelectorAll('.scroll-reveal, .scroll-reveal-left, .scroll-reveal-right');
            if (revealElements.length > 0 && 'IntersectionObserver' in window) {
                const observerOptions = {
                    threshold: 0.1,
                    rootMargin: '0px 0px -40px 0px'
                };

                const revealObserver = new IntersectionObserver(function (entries, observer) {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('revealed');
                            observer.unobserve(entry.target);
                        }
                    });
                }, observerOptions);

                revealElements.forEach(el => revealObserver.observe(el));
            } else {
                // Fallback: reveal all immediately if IntersectionObserver not supported
                revealElements.forEach(el => el.classList.add('revealed'));
            }
        });
    </script>
</body>
</html>
<?php /**PATH C:\Users\ACER NITRO\Documents\COFFEE SHOP\resources\views/layouts/app.blade.php ENDPATH**/ ?>