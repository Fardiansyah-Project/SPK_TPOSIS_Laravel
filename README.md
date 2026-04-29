# Sistem Pendukung Keputusan (SPK) Penentuan Penerima BPNT - Metode TOPSIS

Aplikasi berbasis web ini dikembangkan menggunakan kerangka kerja (framework) **Laravel 11** dan didesain menggunakan **Tailwind CSS**. Sistem ini menggunakan algoritma **TOPSIS (Technique for Order Preference by Similarity to Ideal Solution)** untuk membantu menentukan kandidat terbaik yang berhak menerima Bantuan Pangan Non Tunai (BPNT).

## 🌟 Fitur Utama
1. **Autentikasi Aman:** Sistem login untuk admin.
2. **Manajemen Kriteria & Sub Kriteria:** CRUD kriteria yang dinamis dengan pembobotan otomatis.
3. **Manajemen Objek & Kandidat:** Menambahkan penduduk dan memilih siapa saja yang akan diikutkan dalam penilaian.
4. **Penilaian Dinamis:** Memberikan nilai kepada setiap kandidat berdasarkan sub-kriteria yang telah dibuat.
5. **Perhitungan TOPSIS Otomatis:** Perhitungan matematis (Matriks Keputusan, Normalisasi, Normalisasi Berbobot, Jarak Solusi Ideal, dan Nilai Preferensi) diproses seketika di latar belakang.
6. **Ekspor Laporan PDF:** Menghasilkan dokumen cetak PDF berisi hasil perangkingan secara instan.

---

## 🛠️ Persyaratan Sistem (Prerequisites)
Sebelum menjalankan proyek ini di komputer Anda, pastikan Anda telah menginstal aplikasi berikut:
- **PHP** versi 8.2 atau yang lebih baru.
- **Composer** (untuk mengelola dependensi PHP).
- **MySQL / MariaDB** (bisa menggunakan XAMPP, Laragon, dsb).
- **Git** (opsional, untuk mengkloning repositori).

---

## 🚀 Langkah-langkah Instalasi dan Menjalankan Proyek

Ikuti panduan berikut secara berurutan untuk menjalankan aplikasi ini di komputer lokal Anda:

### 1. Dapatkan Kode Sumber (Clone/Download)
Ekstrak folder proyek ini ke dalam komputer Anda, atau *clone* melalui terminal:
```bash
git clone https://github.com/Fardiansyah-Project/SPK_TPOSIS_Laravel.git
cd penentuan_BPNT_metode_TOPSIS
```

### 2. Instal Dependensi PHP (Composer)
Buka terminal/Command Prompt di dalam folder proyek tersebut, lalu jalankan:
```bash
composer install
```
*Catatan: Pastikan komputer Anda terhubung ke internet karena proses ini akan mengunduh pustaka Laravel dan DOMPDF.*

### 3. Konfigurasi File *Environment* (.env)
Salin file konfigurasi bawaan Laravel:
```bash
cp .env.example .env
```
*(Di Windows PowerShell, Anda bisa menggunakan perintah `copy .env.example .env`)*

Buka file `.env` menggunakan teks editor (Notepad/VS Code), dan ubah bagian koneksi database sesuaikan dengan pengaturan MySQL Anda:
```ini
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=spk_bpnt_topsis   <-- (Atau nama database apa saja yang Anda buat di phpMyAdmin)
DB_USERNAME=root              <-- (Username MySQL Anda, biasanya root)
DB_PASSWORD=                  <-- (Kosongkan jika Anda memakai XAMPP default)
```

### 4. Buat Database
Buka **phpMyAdmin** (biasanya di `http://localhost/phpmyadmin`) dan buat sebuah database baru dengan nama yang sama seperti yang Anda isikan di `DB_DATABASE` (contoh: `spk_bpnt_topsis`).

### 5. Generate Application Key
Jalankan perintah ini di terminal untuk membuat kunci enkripsi aplikasi:
```bash
php artisan key:generate
```

### 6. Migrasi Tabel & Masukkan Data Awal (Seeding)
Jalankan perintah berikut untuk membuat semua tabel yang dibutuhkan beserta memasukkan akun Admin default:
```bash
php artisan migrate:fresh --seed
```

### 7. Jalankan Aplikasi
Nyalakan *local server* Laravel dengan perintah:
```bash
php artisan serve
```
Aplikasi kini berjalan. Buka browser Anda dan kunjungi URL berikut:
👉 **`http://127.0.0.1:8000`**

---

## 🔐 Kredensial Login Default

Karena Anda telah menjalankan perintah `--seed` pada langkah ke-6, sebuah akun administrator telah terbuat secara otomatis. Gunakan data berikut untuk masuk ke dalam sistem:

- **Email:** `admin@admin.com`
- **Password:** `password123`

*(Catatan: Anda bisa mengubah data seeder ini di file `database/seeders/UserSeeder.php`)*

---
### Catatan Tambahan Terkait Desain (Tailwind)
Aplikasi ini menggunakan **Tailwind CSS via CDN** untuk penataannya. Oleh karena itu, Anda **tidak perlu** menginstal NodeJS atau menjalankan perintah `npm run dev`. Tampilan akan otomatis bekerja asalkan komputer/browser Anda terhubung ke jaringan internet.
