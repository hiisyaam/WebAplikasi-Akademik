# 🌐 Sistem Informasi Akademik Sederhana


Sebuah aplikasi web sederhana untuk manajemen data akademik mahasiswa yang dibangun menggunakan PHP native dan MySQL. Proyek ini ditujukan sebagai sarana pembelajaran untuk memahami dasar-dasar pengembangan web dengan arsitektur CRUD (*Create, Read, Update, Delete*).

---

## ✨ Fitur Utama

-   **🔐 Autentikasi Pengguna**: Sistem login dan logout berbasis *session*.
-   **📊 Dashboard**: Halaman utama yang menampilkan ringkasan informasi.
-   ** CRUD Mahasiswa**:
    -   Menambah data mahasiswa baru.
    -   Melihat daftar semua mahasiswa.
    -   Mengedit data mahasiswa yang ada.
    -   Menghapus data mahasiswa.
-   **🎨 Tampilan Responsif**: Antarmuka yang ramah pengguna berkat *template* SB Admin 2 berbasis Bootstrap.

---

## 🛠️ Teknologi yang Digunakan

-   **Backend**: PHP (Native)
-   **Database**: MySQL
-   **Frontend**: HTML, CSS, JavaScript
-   **Framework/Library**: Bootstrap, Font Awesome, jQuery

---

## 🚀 Instalasi & Persiapan

Ikuti langkah-langkah di bawah ini untuk menjalankan proyek ini di komputer lokal Anda.

1.  **Prasyarat**
    -   Pastikan Anda sudah menginstal XAMPP atau web server sejenis yang mencakup Apache, PHP, dan MySQL.

2.  **Clone Repository**
    ```bash
    git clone [https://github.com/username-anda/nama-repository.git](https://github.com/username-anda/nama-repository.git)
    ```
    Pindahkan folder proyek ke dalam direktori `htdocs` di dalam instalasi XAMPP Anda.

3.  **Setup Database**
    -   Buka phpMyAdmin (`http://localhost/phpmyadmin`).
    -   Buat database baru dengan nama `data_mahasiswa`.
    -   Impor file `.sql` yang berisi struktur tabel ke dalam database tersebut.

4.  **Konfigurasi Koneksi**
    -   Buka file `koneksi.php`.
    -   Sesuaikan nilai `$servername`, `$username`, `$password`, dan `$database` jika diperlukan.
    ```php
    $servername = 'localhost';
    $username   = 'root';
    $password   = '';
    $database   = 'data_mahasiswa';
    ```

5.  **Jalankan Aplikasi**
    -   Buka browser dan akses proyek melalui `http://localhost/nama-folder-proyek`.

---

## ⚠️ PEMBERITAHUAN KEAMANAN PENTING

Proyek ini dibuat untuk **tujuan edukasi dan portofolio semata**. Terdapat beberapa celah keamanan yang sengaja tidak diperbaiki, di antaranya:

1.  **SQL Injection**: *Query* database yang digunakan tidak menggunakan *Prepared Statements*, sehingga sangat rentan terhadap serangan.
2.  **Password Teks Biasa**: Sistem login tidak menggunakan *hashing* untuk kata sandi.

**JANGAN GUNAKAN KODE INI DI LINGKUNGAN PRODUKSI TANPA MEMPERBAIKI CELAH KEAMANAN TERSEBUT.**

---

## 📄 Lisensi

Proyek ini dilisensikan di bawah Lisensi MIT. Lihat file `LICENSE` untuk detail lebih lanjut.