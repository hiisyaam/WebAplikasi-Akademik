<?php
/**
 * File: session.php
 * Deskripsi: Skrip ini berfungsi sebagai pemeriksa sesi (session guard).
 * Tujuannya adalah untuk disertakan (`include`) di bagian atas halaman-halaman
 * yang hanya boleh diakses oleh pengguna yang sudah login.
 */

// Memulai atau melanjutkan sesi yang ada.
session_start();

// Memeriksa apakah variabel session 'username' TIDAK ada.
if (!isset($_SESSION['username'])) {
    // Jika tidak ada, berarti pengguna belum login.
    // Alihkan paksa ke halaman login.
    header("Location: login.php");
    // Hentikan eksekusi skrip untuk mencegah kode di bawahnya berjalan.
    exit;
}
?>