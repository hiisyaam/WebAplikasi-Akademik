<?php
/**
 * File: koneksi.php
 * Deskripsi: File ini bertanggung jawab untuk membuat dan memvalidasi koneksi
 * ke database MySQL menggunakan ekstensi MySQLi.
 */

// ===== 1. KONFIGURASI KREDENSIAL DATABASE =====
// Kredensial ini digunakan untuk mengautentikasi aplikasi ke server database.
// Catatan: Untuk lingkungan produksi (live server), sangat disarankan untuk tidak
// menulis kredensial secara langsung di dalam kode. Gunakan metode yang lebih aman
// seperti environment variables (.env) untuk menghindari kebocoran data.

$servername = 'localhost';      // Alamat server database, 'localhost' berarti di mesin yang sama.
$username   = 'root';           // Username untuk mengakses database.
$password   = '';               // Password untuk username tersebut (kosong untuk XAMPP default).
$database   = 'data_mahasiswa'; // Nama database yang akan digunakan.


// ===== 2. MEMBUAT KONEKSI DATABASE =====
// Menggunakan fungsi mysqli_connect() untuk mencoba terhubung ke server database
// dengan kredensial yang telah didefinisikan di atas.
// Hasil koneksi (objek koneksi atau false jika gagal) disimpan dalam variabel $conn.

$conn = mysqli_connect($servername, $username, $password, $database);


// ===== 3. VALIDASI KONEKSI =====
// Ini adalah langkah keamanan yang krusial. Selalu periksa apakah koneksi berhasil.
// Jika variabel $conn bernilai `false` (koneksi gagal), maka...

if (!$conn) {
    // ...hentikan eksekusi skrip secara total menggunakan die().
    // die() akan menampilkan pesan error yang jelas dan menghentikan rendering halaman.
    // mysqli_connect_error() memberikan detail spesifik tentang mengapa koneksi gagal.
    die("Koneksi Database Gagal: " . mysqli_connect_error());
}

// Komentar di bawah ini tidak dieksekusi, hanya sebagai penanda.
// Jika skrip berhasil melewati blok 'if' di atas, artinya koneksi berhasil
// dan variabel $conn siap digunakan untuk query di file-file lain.

?>