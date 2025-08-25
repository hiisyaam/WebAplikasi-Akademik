<?php
/**
 * File: logout.php
 * Deskripsi: Skrip ini menangani proses logout pengguna dengan cara
 * menghancurkan sesi (session) yang aktif dan mengalihkannya
 * kembali ke halaman login.
 */

// 1. Memulai atau melanjutkan sesi yang ada.
//    Fungsi session_start() wajib dipanggil sebelum bisa memanipulasi
//    variabel-variabel di dalam $_SESSION.
session_start();

// 2. Membersihkan semua variabel sesi.
//    session_unset() akan menghapus semua data yang tersimpan di dalam
//    array $_SESSION, seperti $_SESSION['username'], tetapi sesi itu sendiri
//    masih ada di server.
session_unset();

// 3. Menghancurkan sesi sepenuhnya.
//    session_destroy() akan menghapus file sesi dari server. Ini adalah
//    langkah terakhir dan terpenting untuk memastikan pengguna benar-benar keluar.
session_destroy();

// 4. Mengalihkan (Redirect) pengguna.
//    Setelah sesi dihancurkan, pengguna dialihkan kembali ke halaman login.
//    Ini adalah langkah logis untuk menyelesaikan proses logout.
header("Location: login.php");
exit(); // Best practice: Selalu tambahkan exit() setelah header redirect.
?>