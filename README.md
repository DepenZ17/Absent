# Aplikasi Absensi Karyawan

Aplikasi Absensi Karyawan berbasis web yang digunakan untuk mencatat data karyawan, kehadiran, keterlambatan, dan membuat laporan absensi. Aplikasi ini ditujukan untuk membantu admin/HRD mengelola data absensi secara lebih rapi, terstruktur, dan mudah dicek kembali.

---

## ✨ Fitur Utama

- **Manajemen Data Karyawan**
  - Tambah, ubah, dan hapus data karyawan.
  - Manajemen jabatan / divisi.

- **Pencatatan Absensi**
  - Input kehadiran (hadir, izin, sakit, alfa).
  - Pencatatan absensi per tanggal.

- **Laporan Absensi**
  - Laporan absensi per karyawan.
  - Laporan absensi per periode (harian / bulanan).
  - Cetak / download laporan (jika diaktifkan di aplikasi).

- **Autentikasi**
  - Halaman login dan logout untuk admin / petugas.

---

## 🛠️ Teknologi yang Digunakan

- **Bahasa Pemrograman**: PHP  
- **Database**: MySQL  
- **Front-end**:
  - HTML, CSS, JavaScript  
  - Bootstrap / CSS custom  
  - jQuery  
  - Font Awesome  

---

## 📁 Struktur Folder (singkat)

Beberapa folder penting di dalam project:

- `absen/` – logika dan halaman terkait absensi  
- `admin/` – halaman admin / pengelolaan  
- `css/` – file stylesheet  
- `js/` – file JavaScript  
- `images/` / `img/` – asset gambar  
- `db/` – file SQL untuk struktur dan data awal database  
- `karyawan/` – pengelolaan data karyawan  
- `jabatan/` – pengelolaan data jabatan / divisi  

---

## 📦 Persyaratan Sistem

- PHP 7.x atau lebih baru  
- MySQL / MariaDB  
- Web server (Apache)  
- Disarankan menggunakan:
  - XAMPP / Laragon / WAMP atau stack sejenis  

---

## 🚀 Cara Instalasi (Lokal)

1. **Clone / Download Project**

   Clone repo:

   ```bash
   git clone https://github.com/DepenZ17/Absent.git
Atau download sebagai ZIP dari GitHub dan extract ke folder htdocs (XAMPP) atau www (Laragon).

Buat Database

Buka phpMyAdmin.

Buat database baru, misalnya: absensi_karyawan.

Import file SQL yang ada di folder:

db/absensi_karyawan.sql


(ganti dengan nama file .sql yang memang ada di folder db milik Anda).

Konfigurasi Koneksi Database

Buka file koneksi database, misalnya:

koneksi.php


Sesuaikan konfigurasi berikut:

$host     = "localhost";
$user     = "root";
$password = "";
$db       = "absensi_karyawan";


Ubah nama database, user, dan password sesuai dengan pengaturan MySQL Anda.

Jalankan Aplikasi

Aktifkan Apache dan MySQL di XAMPP / Laragon.

Buka browser dan akses:

http://localhost/Absent


(sesuaikan dengan nama folder project ini di htdocs / www).

🧑‍💻 Pengembangan

Jika ingin mengembangkan aplikasi ini lebih lanjut:

Ubah logika dan tampilan di file PHP di root dan folder seperti absen/, admin/, karyawan/, dll.

Sesuaikan CSS dan JavaScript di folder css/ dan js/.
