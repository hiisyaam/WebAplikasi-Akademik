<?php
/**
 * File: topbar.php
 * Deskripsi: Komponen ini menampilkan bar navigasi atas, termasuk
 * nama pengguna yang sedang login dan menu dropdown profil.
 */

// !!! KESALAHAN LOGIKA PENTING !!!
// Kode di bawah ini salah karena mengambil SEMUA pengguna dan hanya menampilkan
// pengguna pertama dari tabel. Seharusnya, nama pengguna diambil dari
// variabel SESSION yang sudah dibuat saat login.

/*
    // KODE YANG SALAH (JANGAN DIGUNAKAN):
    require "koneksi.php";
    $query = mysqli_query($conn, "SELECT * FROM users");
    $data = mysqli_fetch_array($query);
*/

// CARA YANG BENAR:
// Ambil nama pengguna dari session yang aktif.
// Pastikan session_start() sudah dipanggil di file utama (seperti index.php).
$loggedInUsername = $_SESSION['username'] ?? 'Guest'; // Gunakan 'Guest' jika session tidak ada

?>

<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>
    
    <ul class="navbar-nav ml-auto">

        <div class="topbar-divider d-none d-sm-block"></div>

        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Halo, <?php echo htmlspecialchars($loggedInUsername); ?></span>
                
                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
            </a>
            
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#" onclick="alert('Belum Dibangun')">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
            </div>
        </li>

    </ul>
</nav>