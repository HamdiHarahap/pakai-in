# Pakai-in — E-Commerce Pakaian Modern

**Pakai-in** adalah aplikasi e-commerce berbasis web yang berfokus pada penjualan pakaian **pria, wanita, dan anak-anak**.  
Aplikasi ini dirancang dengan pengalaman pengguna yang modern, alur transaksi yang jelas, serta sistem manajemen admin yang terstruktur dan mudah digunakan.

---

## Demo

### Demo Pengguna

### Demo Admin

---

## Fitur Utama

### Fitur Pengguna (Customer)

Pengguna dapat berbelanja dengan alur yang sederhana dan nyaman:

-   **Menjelajah Produk**

    -   Melihat seluruh koleksi pakaian
    -   Filter produk berdasarkan kategori (Pria, Wanita, Anak-anak)
    -   Melihat detail produk (deskripsi, harga, gambar, ukuran tersedia)

-   **Keranjang Belanja**

    -   Menambahkan produk ke keranjang
    -   Mengatur jumlah (qty) dan ukuran (size)
    -   Menghapus item dari keranjang
    -   Melihat subtotal dan total harga

-   **Checkout & Pembayaran**

    -   Pilihan metode pembayaran:
        -   **Cash On Delivery (COD)**
        -   **Transfer Bank (Midtrans Payment Gateway)**
    -   Untuk **COD**:
        -   Pesanan langsung dibuat
    -   Untuk **Transfer**:
        -   Proses pembayaran melalui **Midtrans**
        -   Pesanan akan tersimpan dengan status _unpaid_
        -   Pesanan dapat diselesaikan setelah pembayaran berhasil

-   **Pesanan Saya**
    -   Melihat daftar pesanan yang pernah dibuat
    -   Melihat detail pesanan (item, ukuran, qty, total harga)
    -   Status pesanan dan pembayaran ditampilkan dengan jelas

---

### Fitur Admin

Admin memiliki kontrol penuh terhadap sistem dan transaksi:

-   **Manajemen Master Data**

    -   Kelola **kategori produk**
    -   Kelola **produk** (nama, harga, deskripsi, gambar)
    -   Kelola **stok produk** berdasarkan ukuran (S, M, L, XL)

-   **Data Customer**

    -   Melihat daftar pengguna terdaftar
    -   Informasi customer yang melakukan transaksi

-   **Keranjang Customer**

    -   Melihat isi keranjang milik customer
    -   Detail item: produk, ukuran, jumlah, dan subtotal

-   **Pesanan Customer**
    -   Melihat seluruh pesanan yang dibuat customer
    -   Melihat detail isi pesanan:
        -   Produk
        -   Ukuran
        -   Quantity
        -   Total harga
    -   Memantau status pesanan dan pembayaran

---

## Integrasi Payment Gateway

Pakai-in terintegrasi dengan **Midtrans** untuk metode pembayaran transfer:

-   Mendukung pembayaran non-COD secara aman
-   Status pembayaran otomatis terupdate
-   Pesanan tersimpan hingga pembayaran berhasil
-   Cocok untuk skenario pembayaran tertunda

---

## Desain & User Experience

-   Tampilan **modern dan minimalis**
-   Konsisten menggunakan **Tailwind CSS**
-   Fokus pada:
    -   Kemudahan navigasi
    -   Kejelasan status transaksi
    -   Kenyamanan pengguna

---

## Teknologi yang Digunakan

-   **Framework**: Laravel
-   **Database**: MySQL
-   **Frontend**: Blade + Tailwind CSS
-   **Payment Gateway**: Midtrans

---

## Keunggulan Project

-   Alur checkout yang jelas dan fleksibel
-   Mendukung pembayaran COD & Transfer
-   Sistem admin yang lengkap dan terstruktur
-   Manajemen stok berbasis ukuran
-   Cocok untuk skala UMKM hingga menengah
-   Kode terorganisir dan mudah dikembangkan

---

## Catatan Pengembangan

Project **Pakai-in** dirancang agar mudah dikembangkan ke depannya, seperti:

-   Notifikasi status pesanan
-   Dashboard analitik penjualan
-   Fitur wishlist
-   Pengiriman dengan kurir terintegrasi

---

**Pakai-in**  
E-Commerce Pakaian Modern  
Dikembangkan untuk kebutuhan pembelajaran & pengembangan sistem e-commerce.

---

_Belanja pakaian jadi lebih mudah, cepat, dan aman bersama Pakai-in._
