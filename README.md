# Coffee Shop Management System (Aura Coffee & Roastery)

Aplikasi web **Coffee Shop Management System** berbasis **Laravel 11** dan **Filament v3 Admin Dashboard** dengan arsitektur **Pure Monolithic Laravel**. Tidak menggunakan REST API, tanpa GraphQL, dan tanpa dependensi eksternal. Semua alur transaksi, session keranjang belanja, kalkulasi harga, dan dashboard admin berjalan server-side secara aman dan terintegrasi.

---

## 🛠️ Teknologi yang Digunakan

- **Backend:** Laravel 11 (PHP 8.2+)
- **Admin Dashboard:** Filament v3 (Livewire 3 + Alpine.js)
- **Frontend Pelanggan:** Laravel Blade Templating Engine
- **Styling:** Tailwind CSS (Palet warna Coffee Shop: Dark Brown, Coffee Brown, Cream, Beige, Amber Gold)
- **Database:** MySQL / MariaDB (Database: `coffee_shop_db`)
- **Autentikasi:** Laravel Authentication & Filament Admin Guard
- **Session:** Laravel Server-Side Session untuk Keranjang Belanja
- **Testing:** PHPUnit 11 (Automated Feature Tests)

---

## ☕ Fitur-Fitur Aplikasi

### 1. Frontend Pelanggan
- **Homepage (`/`):**
  - Hero Section dengan banner Coffee Roastery & CTA interaktif.
  - Value Proposition Cards (100% Single Origin Nusantara, Slow Cold Brew Extraction, Fresh Roast).
  - Produk Kopi Unggulan (Featured Products) dengan badge diskon & quick add to cart.
  - Kategori Menu Kopi lengkap dengan jumlah menu.
  - Menu Kopi Terbaru dari Roastery.
  - Cerita Filosofi Kopi (About Us) & Jam Operasional.
  - Alamat toko & direct button konsultasi barista via WhatsApp.
- **Katalog Produk (`/katalog`):**
  - Menampilkan seluruh menu minuman & pastry.
  - Filter interaktif berdasarkan kategori menu.
  - Form pencarian produk (nama, deskripsi, SKU).
  - Sorting produk (Harga Terendah, Harga Tertinggi, Terbaru, Nama A-Z).
  - Paginasi rapi.
- **Detail Produk (`/katalog/{slug}`):**
  - Galeri foto produk, nama, kategori, kode SKU, indikator ketersediaan stok real-time.
  - Perhitungan harga diskon & penghematan belanja.
  - Catatan rasa (Tasting notes) & deskripsi penyajian.
  - Stepper jumlah pesanan (+/-) dengan validasi batas stok maksimum.
  - Rekomendasi menu serupa dalam kategori yang sama.
- **Shopping Cart (`/keranjang`):**
  - Penyimpanan keranjang menggunakan server-side Laravel Session (`session('cart')`).
  - Tambah menu, ubah kuantitas (+ / -), hapus item per produk, dan tombol kosongkan keranjang.
  - Perhitungan subtotal dan total belanja otomatis.
- **Checkout Transaksi (`/checkout`):**
  - Formulir pemesan: Nama, WhatsApp/Telepon, Email, Alamat Pengiriman, Catatan Barista.
  - Pilihan metode pembayaran: **Transfer Bank (BCA / Mandiri)** atau **Cash on Delivery (COD)**.
  - Validasi ketat sisi server: Memvalidasi ketersediaan stok dan menghitung ulang harga produk langsung dari database saat checkout (anti manipulasi harga sisi klien).
  - Transaksi database atomik (`DB::transaction` & `lockForUpdate`).
  - Generate nomor invoice otomatis (`INV-YYYYMMDD-XXXX`).
  - Pemotongan stok otomatis dan penyimpanan snapshot harga pada `order_items`.
- **Lacak & Riwayat Pesanan (`/pesanan`):**
  - Pencarian transaksi menggunakan nomor invoice atau nomor WhatsApp pelanggan.
  - Kartu riwayat transaksi dengan badge status bayar dan status pesanan.
- **Detail Pesanan & Pembayaran (`/pesanan/{invoice_number}`):**
  - Stepper status pesanan: **Menunggu (Pending) -> Diracik Barista (Processing) -> Dalam Pengiriman (Shipped) -> Selesai (Completed)**.
  - Instruksi rekening pembayaran bank resmi atau petunjuk COD.
  - Formulir unggah bukti transfer bank (JPG, PNG, WEBP) langsung dari halaman detail.
- **Cetak Invoice Resmi (`/pesanan/{invoice_number}/invoice`):**
  - Tampilan struk invoice profesional yang siap cetak atau simpan sebagai PDF (`window.print()`).

---

### 2. Dashboard Admin Filament (`/admin`)

- **Dashboard Utama & Statistik:**
  - Card Widget: **Total Pendapatan (Lunas)**, **Total Pesanan**, **Produk Aktif**, **Total Pelanggan**.
  - **Grafik Pendapatan:** Tren omset harian selama 7 hari terakhir.
  - **Grafik Jumlah Pesanan:** Volume order harian.
  - **Tabel Produk Terlaris:** Menampilkan menu kopi dengan kuantitas penjualan tertinggi dan total omset.
  - **Tabel Pesanan Terbaru:** Daftar pesanan masuk real-time dengan shortcut edit status.
- **Manajemen Kategori (`/admin/categories`):**
  - CRUD Kategori: Nama, Slug otomatis, Deskripsi, Upload Gambar, Status Aktif.
- **Manajemen Produk Kopi (`/admin/products`):**
  - CRUD Produk: Nama, Kategori, Slug, SKU otomatis, Upload Foto (dengan Image Editor), Deskripsi, Harga Normal, Harga Diskon, Stok, Status Produk (Aktif, Nonaktif, Stok Habis), Menu Unggulan (Featured).
  - Filter kategori, status, dan produk unggulan.
- **Manajemen Pesanan (`/admin/orders`):**
  - Daftar lengkap pesanan, pencarian invoice dan nama pelanggan.
  - Update Status Pesanan: `Pending`, `Processing`, `Shipped`, `Completed`, `Cancelled`.
  - Update Status Pembayaran: `Unpaid`, `Paid`, `Failed`, `Refunded`.
  - Rincian produk yang dipesan (snapshot item, kuantitas, harga).
  - Tombol aksi satu-klik **"Cetak Invoice"**.
- **Manajemen Pelanggan (`/admin/customers`):**
  - Data nama, nomor WhatsApp/telepon, email, alamat, total frekuensi order, dan akumulasi total belanja lunas.
- **Manajemen Pembayaran (`/admin/payments`):**
  - Rincian pembayaran, metode bayar, nominal, waktu transaksi, dan preview foto bukti transfer.
- **Pengaturan Toko (`/admin/settings`):**
  - Pengaturan nama kedai kopi, alamat kafe, nomor WhatsApp resmi, email, deskripsi toko, dan rincian rekening bank transfer.

---

## 🔑 Akun Login Admin

Buka URL: `http://localhost:8000/admin`

| Role | Email | Password |
|---|---|---|
| **Super Admin** | `admin@coffeeshop.com` | `password` |
| **Lead Barista** | `barista@coffeeshop.com` | `password` |

---

## 🚀 Cara Menjalankan Aplikasi

1. **Pastikan MySQL / MariaDB Berjalan** (misal via XAMPP).
   - Database: `coffee_shop_db`
   - Port: `3306`
   - User: `root`, Password: `` (kosong)

2. **Jalankan Migration & Seeder (jika ingin reset data)**:
   ```bash
   php artisan migrate:fresh --seed
   ```

3. **Jalankan Server Lokal Laravel**:
   ```bash
   php artisan serve
   ```

4. **Akses Aplikasi**:
   - **Frontend Pelanggan:** `http://localhost:8000`
   - **Dashboard Admin:** `http://localhost:8000/admin`
   - **Lacak Pesanan:** `http://localhost:8000/pesanan`

5. **Menjalankan Pengujian Otomatis (Testing)**:
   ```bash
   php vendor/phpunit/phpunit/phpunit
   ```
