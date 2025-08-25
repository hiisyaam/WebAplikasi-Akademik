<?php
// ===== BLOK LOGIKA & KEAMANAN =====

// 1. Menyertakan file koneksi database. 
//    Ini adalah praktik yang baik untuk memisahkan kredensial database dari logika utama.
include ('koneksi.php');

// 2. Memulai sesi PHP. 
//    Dibutuhkan untuk mengakses variabel session seperti $_SESSION['username'].
session_start();

// 3. Pengecekan Sesi (Gerbang Keamanan).
//    Memastikan bahwa hanya pengguna yang sudah login (memiliki session 'username') 
//    yang dapat mengakses halaman ini. Jika tidak, akan dialihkan ke halaman login.
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit(); // Menghentikan eksekusi skrip setelah redirect.
}

// 4. Pengambilan Data dari Database.
//    Menjalankan query SQL untuk mengambil semua data dari tabel 'teks'.
//    Hasilnya disimpan di variabel $queryTeks untuk digunakan nanti di bagian HTML.
$queryTeks = mysqli_query($conn, "SELECT * FROM teks");
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Sistem Informasi UNTAT">
    <meta name="author" content="anomali">
    <title>Web Akademik UNTAT</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body id="page-top">
    <div id="wrapper">
        <?php
        // Praktik terbaik: Memisahkan bagian-bagian yang berulang (seperti sidebar)
        // ke dalam file terpisah agar mudah dikelola dan digunakan di banyak halaman.
        include 'sidebar.php';
        ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php
                // Sama seperti sidebar, topbar juga dipisahkan menjadi komponen sendiri.
                include 'topbar.php';
                ?>
                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 mb-4">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Kata Pengantar</h6>
                                </div>
                                <div class="card-body">
                                <?php
                                    // Mengambil satu baris data dari hasil query yang sudah dijalankan di atas.
                                    $data = mysqli_fetch_array($queryTeks);
                                ?>
                                <p><?php echo $data['teks_penjelasan']; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                </div>
            <?php include "footer.php"; ?>
        </div>
        </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <?php include "modal.php" ?>

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
</body>
</html>