-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Nov 2026 pada 04.26
-- Versi server: 10.11.16-MariaDB
-- Versi PHP: 8.3.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Basis data: `db_coffee_shop`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `description`, `image`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Espresso Based', 'espresso-based', 'Minuman kopi klasik dan modern berbasis espresso berkualitas tinggi yang diekstrak dengan presisi.', 'https://images.unsplash.com/photo-1510591509098-f4fdc6d0ff04?auto=format&fit=crop&w=600&q=80', 1, '2026-11-18 14:11:25', '2026-11-18 14:11:25'),
(2, 'Manual Brew & Single Origin', 'manual-brew-single-origin', 'Seduhan tangan V60, Aeropress, dan Japanese Iced dengan varietas biji kopi pilihan nusantara.', 'https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?auto=format&fit=crop&w=600&q=80', 1, '2026-11-18 14:11:25', '2026-11-18 14:11:25'),
(3, 'Signature Cold Brew', 'signature-cold-brew', 'Kopi seduh dingin selama 16 jam dengan rasa lembut, rendah asam, dan aroma buah yang menyegarkan.', 'https://images.unsplash.com/photo-1517701604599-bb29b565090c?auto=format&fit=crop&w=600&q=80', 1, '2026-11-18 14:11:25', '2026-11-18 14:11:25'),
(4, 'Artisan Tea & Non-Coffee', 'artisan-tea-non-coffee', 'Pilihan teh aromatik, matcha premium, cokelat artisan Belgia untuk kesegaran harian.', 'https://images.unsplash.com/photo-1536256263959-770b48d82b0a?auto=format&fit=crop&w=600&q=80', 1, '2026-11-18 14:11:25', '2026-11-18 14:11:25'),
(5, 'Pastry & Bakery', 'pastry-bakery', 'Croissant renyah berlapis mentega Prancis dan pastry fresh-baked setiap pagi.', 'https://images.unsplash.com/photo-1555507036-ab1f4038808a?auto=format&fit=crop&w=600&q=80', 1, '2026-11-18 14:11:25', '2026-11-18 14:11:25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) NOT NULL,
  `address` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '2024_01_01_000001_create_categories_table', 1),
(3, '2024_01_01_000002_create_products_table', 1),
(4, '2024_01_01_000003_create_customers_table', 1),
(5, '2024_01_01_000004_create_orders_table', 1),
(6, '2024_01_01_000005_create_order_items_table', 1),
(7, '2024_01_01_000006_create_payments_table', 1),
(8, '2024_01_01_000007_create_settings_table', 1),
(9, '2026_11_18_214324_add_courier_details_to_orders_table', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `invoice_number` varchar(255) NOT NULL,
  `order_date` datetime NOT NULL,
  `total_amount` decimal(12,2) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Pending',
  `payment_status` varchar(255) NOT NULL DEFAULT 'Unpaid',
  `payment_method` varchar(255) NOT NULL DEFAULT 'Transfer Bank',
  `customer_name` varchar(255) NOT NULL,
  `customer_phone` varchar(255) NOT NULL,
  `shipping_address` text NOT NULL,
  `courier_name` varchar(255) DEFAULT 'Gojek (GoSend)',
  `driver_name` varchar(255) DEFAULT NULL,
  `driver_phone` varchar(255) DEFAULT NULL,
  `driver_plate` varchar(255) DEFAULT NULL,
  `driver_status` varchar(255) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_name` varchar(255) NOT NULL,
  `unit_price` decimal(12,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `subtotal` decimal(12,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `amount` decimal(12,2) NOT NULL,
  `payment_status` varchar(255) NOT NULL DEFAULT 'Unpaid',
  `payment_proof` varchar(255) DEFAULT NULL,
  `payment_date` datetime DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `sku` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(12,2) NOT NULL,
  `discount_price` decimal(12,2) DEFAULT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `slug`, `sku`, `image`, `description`, `price`, `discount_price`, `stock`, `status`, `is_featured`, `created_at`, `updated_at`) VALUES
(1, 1, 'Caffe Americano Classico', 'caffe-americano-classico', 'CF-ESP-001', 'https://images.unsplash.com/photo-1514432324607-a09d9b4aefdd?auto=format&fit=crop&w=600&q=80', 'Double shot espresso murni dari biji Arabika Gayo dicampur air mineral panas dengan krema emas yang pekat.', 28000.00, 25000.00, 30, 'active', 1, '2026-11-18 14:11:25', '2026-11-19 13:42:30'),
(2, 1, 'Caramel Macchiato Velvet', 'caramel-macchiato-velvet', 'CF-ESP-002', 'https://images.unsplash.com/photo-1485808191679-5f86510681a2?auto=format&fit=crop&w=800&q=80', 'Susu segar berbusa lembut dengan sirup vanilla artisan, di-drizzle saus karamel mentega gurih dan double shot espresso.', 38000.00, 34000.00, 45, 'active', 1, '2026-11-18 14:11:25', '2026-11-18 14:58:51'),
(3, 1, 'Spanish Latte Dulce', 'spanish-latte-dulce', 'CF-ESP-003', 'https://images.unsplash.com/photo-1534778101976-62847782c213?auto=format&fit=crop&w=600&q=80', 'Perpaduan seimbang antara condensed milk creamy, susu segar steamed, dan espresso pekat rasa cokelat kacang.', 36000.00, NULL, 60, 'active', 1, '2026-11-18 14:11:25', '2026-11-18 14:11:25'),
(4, 1, 'Flat White Microfoam', 'flat-white-microfoam', 'CF-ESP-004', 'https://images.unsplash.com/photo-1577968897966-3d4325b36b61?auto=format&fit=crop&w=600&q=80', 'Ristretto ganda dengan microfoam susu yang sangat lembut, menonjolkan aroma buah dan rasa manis alami susu.', 32000.00, NULL, 35, 'active', 0, '2026-11-18 14:11:25', '2026-11-18 14:11:25'),
(5, 2, 'Single Origin Gayo Wine Honey (V60)', 'single-origin-gayo-wine-honey-v60', 'CF-MAN-001', 'https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?auto=format&fit=crop&w=600&q=80', 'Biji kopi proses fermentasi wine dari Takengon Aceh. Tasting notes: Anggur hitam, kismis, madu liar, dan keasaman sitrus yang menyegarkan.', 42000.00, 38000.00, 25, 'active', 1, '2026-11-18 14:11:25', '2026-11-18 14:11:25'),
(6, 2, 'Single Origin Toraja Sapan Fully Washed', 'single-origin-toraja-sapan', 'CF-MAN-002', 'https://images.unsplash.com/photo-1511920170033-f8396924c348?auto=format&fit=crop&w=600&q=80', 'Biji kopi dari dataran tinggi Toraja Sulawesi Selatan dengan karakter body penuh, aroma rempah herbal manis, dan sentuhan cokelat pekat.', 40000.00, NULL, 30, 'active', 0, '2026-11-18 14:11:25', '2026-11-18 14:11:25'),
(7, 3, 'Peach Blossom Cold Brew 250ml', 'peach-blossom-cold-brew', 'CF-CLD-001', 'https://images.unsplash.com/photo-1517701604599-bb29b565090c?auto=format&fit=crop&w=600&q=80', 'Cold brew 18 jam diinfus dengan ekstrak buah persik asli dan irisan lemon segar. Manis lembut, floral, dan menyegarkan.', 35000.00, 30000.00, 40, 'active', 1, '2026-11-18 14:11:25', '2026-11-18 14:11:25'),
(8, 3, 'Nitro Vanilla Sweet Cream Cold Brew', 'nitro-vanilla-sweet-cream', 'CF-CLD-002', 'https://images.unsplash.com/photo-1461023058943-07fcbe16d735?auto=format&fit=crop&w=600&q=80', 'Cold brew kaya rasa dengan cascading foam nitrogen di atasnya, disempurnakan dengan limpahan sweet cream vanilla buatan sendiri.', 39000.00, NULL, 20, 'active', 1, '2026-11-18 14:11:25', '2026-11-18 14:11:25'),
(9, 4, 'Kyoto Ceremonial Uji Matcha Latte', 'kyoto-ceremonial-uji-matcha-latte', 'CF-NON-001', 'https://images.unsplash.com/photo-1536256263959-770b48d82b0a?auto=format&fit=crop&w=600&q=80', 'Matcha ceremonial grade asli Kyoto Jepang yang dikocok tradisional dengan chasen bambu, dipadukan susu oat krimi.', 37000.00, 33000.00, 50, 'active', 1, '2026-11-18 14:11:25', '2026-11-18 14:11:25'),
(10, 4, 'Belgian Dark Chocolate Sea Salt', 'belgian-dark-chocolate-sea-salt', 'CF-NON-002', 'https://images.unsplash.com/photo-1542990253-0d0f5be5f0ed?auto=format&fit=crop&w=600&q=80', 'Cokelat hitam murni Belgia 70% dilelehkan bersama susu hangat dan taburan sea salt Maldon untuk rasa gurih mewah.', 35000.00, NULL, 40, 'active', 0, '2026-11-18 14:11:25', '2026-11-18 14:11:25'),
(11, 5, 'French Butter Croissant', 'french-butter-croissant', 'CF-PAS-001', 'https://images.unsplash.com/photo-1555507036-ab1f4038808a?auto=format&fit=crop&w=600&q=80', 'Pastry berlapis mentega Prancis Elle & Vire dengan kulit luar super renyah keemasan dan tekstur dalam empuk berongga.', 24000.00, 21000.00, 30, 'active', 1, '2026-11-18 14:11:25', '2026-11-18 14:11:25'),
(12, 5, 'Pain Au Chocolat Royal', 'pain-au-chocolat-royal', 'CF-PAS-002', 'https://images.unsplash.com/photo-1608198093002-ad4e005484ec?auto=format&fit=crop&w=600&q=80', 'Croissant dengan isian double stick dark chocolate couverture leleh yang kaya rasa.', 28000.00, NULL, 25, 'active', 0, '2026-11-18 14:11:25', '2026-11-18 14:11:25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `shop_name` varchar(255) NOT NULL DEFAULT 'Aura Coffee & Roastery',
  `logo` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `whatsapp_number` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `bank_info` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `settings`
--

INSERT INTO `settings` (`id`, `shop_name`, `logo`, `address`, `whatsapp_number`, `email`, `description`, `bank_info`, `created_at`, `updated_at`) VALUES
(1, 'Aura Coffee & Roastery', NULL, 'Jl. Sutomo No. 45, Pematangsiantar, Sumatera Utara, 21111', '081234567890', 'halo@auracoffee.id', 'Aura Coffee menyajikan kopi spesialti biji pilihan Nusantara dan racikan artisan terbaik untuk menemani setiap cerita dan inspirasi hari Anda.', 'Bank Central Asia (BCA)\nNo. Rekening: 8820 1928 31\nAtas Nama: PT Aura Kopi Nusantara\n\nBank Mandiri\nNo. Rekening: 137 00 1928 3740\nAtas Nama: PT Aura Kopi Nusantara', '2026-11-18 14:11:25', '2026-11-18 14:11:25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'admin',
  `is_admin` tinyint(1) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `is_admin`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin Aura', 'admin@coffeeshop.com', NULL, '$2y$12$ycQD/qifeQBHT8VCv9X/qOfoAb.WpeiDrVXl0mPSX4dGe6Tms0/yG', 'admin', 1, NULL, '2026-11-18 14:11:25', '2026-11-18 15:13:52');

--
-- Indeks untuk tabel yang dibuang
--

--
-- Indeks untuk tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Indeks untuk tabel `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customers_email_index` (`email`),
  ADD KEY `customers_phone_index` (`phone`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_invoice_number_unique` (`invoice_number`),
  ADD KEY `orders_customer_id_foreign` (`customer_id`),
  ADD KEY `orders_invoice_number_status_payment_status_order_date_index` (`invoice_number`,`status`,`payment_status`,`order_date`);

--
-- Indeks untuk tabel `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`),
  ADD KEY `order_items_order_id_product_id_index` (`order_id`,`product_id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_order_id_payment_status_index` (`order_id`,`payment_status`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`),
  ADD UNIQUE KEY `products_sku_unique` (`sku`),
  ADD KEY `products_category_id_status_is_featured_index` (`category_id`,`status`,`is_featured`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
