# Anireshop 🛍️

### Anime & K-Pop Merchandise E-Commerce Web Application

## 📌 Latar Belakang

Anireshop dibuat sebagai aplikasi e-commerce berbasis web untuk membantu proses penjualan merchandise Anime, K-Pop, dan berbagai aksesori koleksi secara lebih terstruktur.

Website ini dirancang untuk menangani proses bisnis mulai dari menampilkan produk, pengelolaan keranjang dan checkout, pembayaran, verifikasi pesanan, pengelolaan stok, hingga proses pengiriman.

Selain sisi customer, Anireshop menyediakan panel admin untuk mengelola produk, kategori, stok, tarif pengiriman, pembayaran, dan pesanan.

---

## ✨ Fitur Utama

### Customer
- Melihat katalog dan detail produk
- Filter berdasarkan kategori
- Register, login, dan logout
- Shopping cart
- Checkout
- Memilih kurir JNE / J&T
- Memilih metode pembayaran QRIS / Bank Transfer
- Upload bukti pembayaran
- Melihat status pembayaran dan pesanan
- Melihat kurir dan nomor resi

### Admin
- Dashboard
- CRUD kategori
- CRUD produk
- Mengelola gambar produk
- Mengelola stok
- Mengelola tarif pengiriman
- Mengelola pesanan
- Verifikasi pembayaran
- Mengubah status pesanan
- Input kurir dan nomor resi

---

## 💳 Pembayaran, Order & Stock Reservation

Metode pembayaran:
- QRIS
- Bank Transfer

Alur pembayaran:

```text
PENDING
   ↓
WAITING_VERIFICATION
   ↓
PAID
```

Jika pembayaran ditolak:

```text
WAITING_VERIFICATION
   ↓
REJECTED
```

Setiap order memiliki batas pembayaran **2 jam**.

Anireshop menggunakan:

```text
available_stock = stock - reserved_stock
```

Saat checkout, stok yang tersedia di-reserve. Jika pembayaran disetujui, `reserved_stock` dan `stock` dikurangi sesuai jumlah pembelian.

Jika order expired, `reserved_stock` dilepaskan tanpa mengurangi `stock`.

Proses checkout dan perubahan stok menggunakan **database transaction** untuk menjaga konsistensi data.

---

## 🚚 Shipping

Anireshop tidak menggunakan shipping API.

Tarif pengiriman dikelola melalui tabel `shipping_rates` berdasarkan:
- Kurir
- Kabupaten/Kota tujuan
- Biaya pengiriman

Kurir yang digunakan:
- JNE
- J&T

Admin dapat mengelola tarif melalui admin panel.

---

## 🗂️ Produk & Kategori

Anireshop memiliki **9 kategori**:

1. Plush
2. Keychain
3. Poster
4. Card Accessories
5. Pin
6. Uchiwa Fan
7. K-Pop
8. Tote Bag
9. Other Accessories

Total katalog saat ini: **24 produk**.

Product variation tidak menggunakan tabel database terpisah. Variasi disampaikan melalui deskripsi produk dan `variation_note` pada order item.

---

## 🗃️ Database & Relasi

Anireshop menggunakan **MySQL** dengan 7 tabel utama:

```text
users
categories
products
product_images
shipping_rates
orders
order_items
```

Relasi utama:

```text
User
 └── hasMany Orders

Category
 └── hasMany Products

Product
 ├── belongsTo Category
 ├── hasMany ProductImages
 └── hasMany OrderItems

ProductImage
 └── belongsTo Product

Order
 ├── belongsTo User
 └── hasMany OrderItems

OrderItem
 ├── belongsTo Order
 └── belongsTo Product
```

`order_items` menyimpan snapshot nama produk, harga, quantity, subtotal, dan variasi agar histori transaksi tetap sesuai saat pembelian dilakukan.

---

## 🏗️ Arsitektur

Anireshop menggunakan pola **MVC (Model-View-Controller)** Laravel.

```text
Browser
   ↓
Route
   ↓
Controller
   ↓
Model / Eloquent
   ↓
MySQL
   ↓
Blade View
   ↓
Browser
```

---

## 🛠️ Technology Stack

| Technology | Usage |
|---|---|
| PHP 8.3 | Backend |
| Laravel 13 | Web Framework |
| Blade | View / Template |
| Bootstrap 5 | UI |
| Vanilla JavaScript | Client-side interaction |
| MySQL | Database |
| Composer | Dependency Management |
| Git & GitHub | Version Control |
| VS Code | Code Editor |
| XAMPP | MySQL / phpMyAdmin |

Komponen Laravel yang digunakan meliputi Routing, Controller, Model, Eloquent ORM, Migration, Seeder, Factory, Middleware, Validation, Authentication, Authorization, File Handling, Database Transaction, dan Artisan Command.

---

## 🔐 Authentication & Validation

Terdapat dua role:

| Role | Access |
|---|---|
| Customer | Catalog, Cart, Checkout, Payment, Orders |
| Admin | Dashboard dan pengelolaan data |

Customer hanya dapat mengakses pesanan miliknya sendiri, sedangkan fungsi administrasi dibatasi untuk role Admin.

Validasi server-side Laravel digunakan untuk:
- Data registrasi
- Email dan password
- Nomor WhatsApp
- Alamat pengiriman
- Quantity dan stok
- Produk
- Kurir dan tujuan
- Metode pembayaran
- Bukti pembayaran

---

## 🖼️ Product Images

Gambar katalog disimpan langsung sebagai asset project:

```text
public/
└── images/
    └── products/
```

Terdapat **24 gambar produk** dalam format PNG.

Bukti pembayaran menggunakan Laravel Storage karena merupakan file upload dari customer.

---

## 🧪 Testing

Anireshop memiliki Feature Tests untuk memeriksa fungsi dasar aplikasi, struktur database, relationship, stok, shipping rate, dan home route.

Hasil testing terakhir:

```text
9 tests passed
9 assertions
```

Menjalankan testing:

```bash
php artisan test
```

---

## 🚀 Installation

### Requirements

- PHP 8.3+
- Composer
- MySQL
- Git

### Clone Repository

```bash
git clone https://github.com/ibnuwildan12/anireshop.git
cd anireshop
```

### Install Dependency

```bash
composer install
```

### Setup Environment

Windows:

```bash
copy .env.example .env
```

Linux/macOS:

```bash
cp .env.example .env
```

Generate application key:

```bash
php artisan key:generate
```

Atur database pada `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=anireshop_db
DB_USERNAME=root
DB_PASSWORD=
```

### Setup Database

```bash
php artisan migrate --seed
```

Kemudian:

```bash
php artisan optimize:clear
php artisan serve
```

Buka:

```text
http://localhost:8000
```

---

## 👤 Demo Account

### Admin

```text
Email    : ibnuwildan12@gmail.com
Password : ***REMOVED***
```

### Customer

```text
Email    : customer@anireshop.com
Password : ***REMOVED***
```

> Credential tersebut digunakan untuk development/assessment.

---

## 📁 Project Structure

```text
anireshop/
├── app/
│   ├── Console/
│   ├── Http/Controllers/
│   └── Models/
├── database/
│   ├── factories/
│   ├── migrations/
│   └── seeders/
├── public/
│   └── images/products/
├── resources/views/
│   ├── admin/
│   ├── cart/
│   ├── orders/
│   ├── payments/
│   └── products/
├── routes/
│   └── web.php
├── tests/Feature/
├── .env.example
├── composer.json
└── README.md
```

---

## 📌 Project Scope

### Included

```text
Customer
├── Catalog
├── Category
├── Product Detail
├── Authentication
├── Cart
├── Checkout
├── Shipping
├── Payment
└── Orders

Admin
├── Dashboard
├── Categories
├── Products
├── Product Images
├── Stock
├── Shipping Rates
└── Orders
```

### Not Included

- Payment Gateway
- Shipping API
- Wishlist
- Voucher/Coupon
- Review & Rating
- Chat
- Advanced Analytics
- Automatic Notification

---

## 👨‍💻 Author

**Ibnu Wildan Al Muna**

Information Systems — Universitas Duta Bangsa Surakarta

**Anireshop — Anime & K-Pop Merchandise E-Commerce**

Repository:

```text
https://github.com/ibnuwildan12/anireshop
```

**Project Status:** Portfolio / Junior Web Programmer Assessment Project
