# Guestbook API 🚀

> Backend layanan Guestbook Digital. Menangani manajemen buku tamu, sinkronisasi database, autentikasi pengguna, dan manajemen data referensi (Siswa, Pegawai, Jabatan).

## 🛠 Tech Stack

- **Framework:** Laravel 11.x (PHP 8.2+)
- **Database:** MySQL
- **Authentication:** Laravel Sanctum (Token-based Auth)
- **CORS:** Laravel Native CORS Handling

## ✨ Features

- **RESTful API:** Arsitektur API yang terstruktur rapi untuk konsumsi aplikasi klien (frontend).
- **Database Integration:** Relasi Eloquent yang terintegrasi (Entitas Buku Tamu, Siswa, Pegawai, dan Jabatan).
- **Authentication & Authorization:** Pengamanan endpoint menggunakan Sanctum Bearer Token.
- **Input Validation:** Validasi payload (request) Laravel secara ketat dan aman.

## 📡 API Endpoints

### 🟢 Public Routes (Tidak butuh token)
- `GET  /api/guestbook/data` - Mengambil data referensi untuk form public (misalnya Dropdown Pegawai)
- `POST /api/guestbook/store` - Menyimpan data buku tamu (Submit form tamu)
- `POST /api/login` - Autentikasi Admin/Petugas

### 🔴 Protected Routes (Membutuhkan Bearer Token)
> Tambahkan header saat request: `Authorization: Bearer <your-token>`

**Auth & Dashboard**
- `POST /api/logout` - Keluar dari sesi
- `GET  /api/profile` - Mengambil detail profil user yang sedang login
- `GET  /api/dashboard` - Mengambil statistik rekapitulasi dashboard

**Buku Tamu**
- `GET    /api/bukutamu` - Mengambil semua entri buku tamu
- `GET    /api/bukutamu/grafik` - Mengambil data rekap chart statistik
- `POST   /api/bukutamu` - Menambah entri tamu secara manual
- `GET    /api/bukutamu/{id}` - Mengambil detail spesifik entri tamu
- `DELETE /api/bukutamu/{id}` - Menghapus entri tamu

**Data Master (Siswa, Pegawai, Jabatan)**
Masing-masing entitas memiliki rute CRUD standar (GET, POST, PUT, DELETE). Contoh:
- `/api/siswa`
- `/api/pegawai`
- `/api/jabatan`

## ⚙️ Setup & Instalasi

Ikuti panduan langkah demi langkah berikut untuk menjalankan server secara lokal:

1. **Clone repositori dan masuk ke direktori backend:**
   ```bash
   cd guestbook-be
   ```

2. **Install dependensi Composer:**
   ```bash
   composer install
   ```

3. **Konfigurasi Environment Variables:**
   Duplikat file `.env.example` dan ubah namanya menjadi `.env`.
   ```bash
   cp .env.example .env
   ```

4. **Generate Application Key:**
   ```bash
   php artisan key:generate
   ```

5. **Migrasi dan Seeding Database:**
   Pastikan konfigurasi `DB_*` di `.env` sudah benar sesuai database lokal Anda, lalu jalankan migrasi:
   ```bash
   php artisan migrate --seed
   ```

6. **Jalankan Server Development:**
   ```bash
   php artisan serve
   ```
   > Aplikasi akan berjalan pada: `http://localhost:8000`

## 🔑 Environment Variables Utama (.env)

Pastikan variabel koneksi database berikut telah dikonfigurasi:
```env
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=guestbook_db
DB_USERNAME=root
DB_PASSWORD=
```

---
*Dibuat untuk Sistem Guestbook Digital.*
