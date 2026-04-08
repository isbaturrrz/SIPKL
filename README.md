# SIPKL - Sistem Informasi Praktek Kerja Lapangan 🚀

[![Laravel Version](https://img.shields.io/badge/Laravel-12.x-red.svg)](https://laravel.com)
[![PHP Version](https://img.shields.io/badge/PHP-8.2+-blue.svg)](https://www.php.net)
[![License](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)

**SIPKL** adalah platform digital yang dirancang khusus untuk mempermudah seluruh rangkaian kegiatan Praktek Kerja Lapangan (PKL) dalam satu sistem yang terpadu. Melalui website ini, siswa dapat mencari, memilih, hingga mendaftarkan diri ke instansi tempat mereka akan melakukan magang secara mandiri. Selama masa PKL, siswa tidak perlu lagi repot dengan laporan kertas karena semua aktivitas harian dapat dicatat langsung ke dalam jurnal digital yang transparan.

Di sisi lain, guru pembimbing dari sekolah dan mentor dari tempat magang dapat memantau perkembangan serta kinerja siswa secara real-time dari mana saja. Mentor perusahaan memiliki akses mudah untuk memvalidasi laporan harian serta memberikan penilaian akhir yang objektif. Seluruh proses ini—mulai dari pendaftaran, absensi, penjurnalan, hingga otomatisasi laporan nilai dan sertifikat dalam format PDF—dikelola secara otomatis untuk memastikan pengalaman PKL yang lebih profesional, terorganisir, dan efisien bagi semua pihak yang terlibat.

---

## ✨ Bagaimana Cara Kerjanya?

**Sistem ini menghubungkan empat pihak utama untuk memastikan kegiatan PKL berjalan sempurna:**

**1. Untuk Siswa:** Kami menyediakan portal mandiri di mana siswa bisa mencari tempat PKL yang mereka inginkan, melakukan pendaftaran, hingga mencatat apa saja yang mereka pelajari setiap harinya dalam bentuk jurnal digital. Tidak ada lagi tumpukan kertas laporan di akhir periode, karena semua sudah tersusun rapi secara otomatis.

**2. Untuk Guru Pembimbing:** Guru dapat memantau dengan jelas di mana saja siswa bimbingan mereka ditempatkan dan bagaimana perkembangan mereka dari hari ke hari. Jika ada kendala, guru dapat segera mengetahuinya melalui sistem, sehingga bimbingan menjadi lebih efektif dan tepat sasaran.

**3. Untuk Mentor Instansi:** Sebagai pembimbing di lapangan, mentor di perusahaan dapat memberikan masukan langsung terhadap aktivitas siswa. Mentor juga diberikan kemudahan untuk mengisi nilai kinerja siswa secara objektif melalui formulir online yang hasilnya bisa langsung dilihat oleh pihak sekolah.

**4. Untuk Administrator Sekolah:** Admin memiliki kontrol penuh untuk mengelola pendaftaran masal melalui sistem import data yang cepat, memvalidasi tempat PKL yang diajukan siswa, serta mengatur keseluruhan sistem agar berjalan lancar bagi semua pengguna.

Secara keseluruhan, sistem ini bukan hanya sekadar database, melainkan alat bantu untuk menciptakan ekosistem kerja praktek yang transparan, mulai dari hari pertama pendaftaran hingga nanti siswa mendapatkan sertifikat dan nilai akhir mereka.

---

## 🏗️ Teknologi & Library yang Digunakan

Berikut adalah daftar lengkap teknologi dan library yang menjadi tulang punggung sistem ini:

### ⚙️ Backend (PHP / Composer)

**Dependensi Utama (Production)**

| Library | Versi | Fungsi |
| :--- | :---: | :--- |
| `php` | `^8.2` | Bahasa pemrograman server-side utama |
| `laravel/framework` | `^12.0` | Framework PHP untuk membangun aplikasi web |
| `laravel/tinker` | `^2.10.1` | REPL interaktif untuk debugging dan eksplorasi data |
| `barryvdh/laravel-dompdf` | `^3.1` | Konversi data HTML menjadi file laporan PDF |
| `maatwebsite/excel` | `^3.1` | Import & export data menggunakan file Excel (.xlsx) |

**Dependensi Pengembangan (Development Only)**

| Library | Versi | Fungsi |
| :--- | :---: | :--- |
| `fakerphp/faker` | `^1.23` | Membuat data palsu/dummy untuk keperluan testing |
| `phpunit/phpunit` | `^11.5.3` | Framework untuk unit testing dan fitur otomatis |
| `laravel/pint` | `^1.24` | Code formatter otomatis agar kode tetap rapi |
| `laravel/sail` | `^1.41` | Lingkungan development berbasis Docker |
| `laravel/pail` | `^1.2.2` | Tool monitoring log aplikasi secara real-time |
| `mockery/mockery` | `^1.6` | Library mocking untuk keperluan testing yang terisolasi |
| `nunomaduro/collision` | `^8.6` | Menampilkan pesan error yang lebih jelas dan mudah dibaca |

---

### 🎨 Frontend (CSS / JavaScript)

**Admin Template & Layout**

| Library | Versi | Fungsi |
| :--- | :---: | :--- |
| `Bootstrap` | `5.x` | Framework CSS utama untuk layout, komponen, dan responsivitas |
| `SB Admin 2` | `4.x` | Template admin berbasis Bootstrap dengan sidebar dan topbar siap pakai |
| `Font Awesome` | `6.0.0` | Ikon vektor modern untuk seluruh elemen antarmuka |
| `Google Fonts (Nunito)` | `-` | Font utama aplikasi yang memberikan tampilan bersih dan profesional |

**Visualisasi Data**

| Library | Versi | Fungsi |
| :--- | :---: | :--- |
| `Chart.js` | `-` | Membuat grafik dan chart statistik di halaman dashboard |

**Peta & Geolokasi**

| Library | Versi | Fungsi |
| :--- | :---: | :--- |
| `Leaflet.js` | `1.9.4` | Menampilkan peta interaktif lokasi absensi/check-in siswa saat jurnal |

**Notifikasi & Interaksi**

| Library | Versi | Fungsi |
| :--- | :---: | :--- |
| `SweetAlert2` | `^11` | Menampilkan dialog konfirmasi dan notifikasi yang menarik |
| `Lottie Files` | `0.9.3` | Menampilkan animasi grafis ringan pada halaman tertentu |

**Build Tool (Vite)**

| Library | Versi | Fungsi |
| :--- | :---: | :--- |
| `vite` | `^7.0.7` | Kompilasi dan bundling aset frontend (CSS & JS) secara cepat |
| `laravel-vite-plugin` | `^2.0.0` | Integrasi Vite ke dalam ekosistem Laravel |
| `axios` | `^1.11.0` | HTTP client untuk komunikasi AJAX antara frontend dan server |
| `concurrently` | `^9.0.1` | Menjalankan beberapa proses (server, queue, vite) bersamaan lewat satu perintah |

---

## 📊 Kesiapan Data (Penting!)

Untuk administrator, sistem ini dilengkapi dengan fitur **"Pembuat Template Otomatis"**. Sebelum melakukan pendaftaran masal, Anda bisa menjalankan perintah sederhana di bawah ini untuk mendapatkan file Excel yang sudah siap diisi sesuai standar sistem:

```bash
php make-templates.php
```

File template akan tersimpan di dalam folder `public/templates/` dan siap digunakan untuk memasukkan data siswa atau guru dalam sekejap.

---

## 🚀 Instalasi Lokal

Ikuti langkah-langkah berikut untuk menjalankan project di komputer lokal Anda:

1. **Clone Repository**
   ```bash
   git clone https://github.com/username/SIPKL.git
   cd SIPKL
   ```

2. **Install Dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Konfigurasi Environment**
   Salin file `.env.example` menjadi `.env` dan sesuaikan pengaturan database Anda:
   ```bash
   cp .env.example .env
   ```

4. **Generate App Key & Database**
   ```bash
   php artisan key:generate
   php artisan migrate --seed
   ```

5. **Jalankan Aplikasi**
   Gunakan perintah berikut (membutuhkan `concurrently` yang sudah terpasang):
   ```bash
   npm run dev
   ```
   Atau jalankan secara terpisah:
   ```bash
   php artisan serve
   npm run dev
   ```

---

## 🔐 Akun Demo (Default)

| Role | Username | Password |
| :--- | :--- | :--- |
| **Admin** | `admin` | `123456` |
| **Guru** | `guru` | `123456` |
| **Siswa** | `siswa` | `123456` |
| **Mentor** | `mentor` | `123456` |

---

## 📝 Lisensi

Project ini dilisensikan di bawah [MIT License](LICENSE).

---

<p align="center">
  Dibuat dengan ❤️ untuk kemudahan manajemen PKL.
</p>
