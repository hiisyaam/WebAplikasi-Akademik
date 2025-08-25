<?php
// Memulai sesi untuk proses login.
session_start();
// Menyertakan file koneksi database.
include 'koneksi.php';

// ===== 1. PERLINDUNGAN HALAMAN =====
// Jika pengguna SUDAH login (ada session 'username'),
// langsung alihkan ke halaman utama (index.php). Mencegah user yang sudah
// login untuk melihat halaman login lagi.
if (isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}


// ===== 2. PROSES SUBMIT FORM LOGIN =====
// Cek apakah form telah disubmit (tombol dengan name="tekan" ditekan).
if (isset($_POST['tekan'])) {
    // !!! PERINGATAN KEAMANAN #1: SQL INJECTION !!!
    // Query ini sangat berbahaya. Penyerang bisa memasukkan kode SQL
    // berbahaya ke dalam input username/password untuk merusak atau mencuri data.
    // CONTOH SERANGAN: Jika penyerang memasukkan username: ' OR '1'='1
    // Maka query akan menjadi:
    // SELECT * FROM users WHERE username='' OR '1'='1' AND password='...'
    // Ini akan selalu mengembalikan hasil (true) dan penyerang bisa login
    // tanpa mengetahui password siapapun.
    //
    // SOLUSI: Gunakan Prepared Statements (mysqli_prepare, bind_param, execute).
    $sql = "SELECT username, password FROM users WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $_POST['username']);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // !!! PERINGATAN KEAMANAN #2: PLAIN TEXT PASSWORD !!!
    // Anda menyimpan dan membandingkan password dalam bentuk teks biasa (tidak di-hash).
    // Jika database Anda bocor, semua password pengguna akan terekspos.
    //
    // SOLUSI:
    // - Saat registrasi: Simpan password menggunakan `password_hash($password, PASSWORD_DEFAULT);`
    // - Saat login: Ambil hash dari DB berdasarkan username, lalu verifikasi dengan
    //   `password_verify($password, $hash_dari_db);`

    // Cek apakah query menemukan pengguna yang cocok.

    if ($result->num_rows > 0) {
        // Jika berhasil, buat session dan alihkan ke dashboard.
        $row = mysqli_fetch_assoc($result);
        $hashed_password = $row['password'];

        // 2. Verifikasi password yang di-hash
        if (password_verify($_POST['password'], $hashed_password)) {
            // Password cocok, login berhasil
            $_SESSION['username'] = $row['username'];
            header("Location: index.php");
            exit();
        }
    }

    // Jika gagal, tampilkan pesan error menggunakan JavaScript.
    echo "<script>alert('Username atau password Anda salah!')</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Login Web Akademik</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <style>
        .vertical-line {
            border-left: 1px solid #e0e0e0;
            height: 100%;
        }
        .bg-login-image img {
            width: 100%;
            height: auto;
        }
    </style>
</head>
<body class="bg-gradient-primary">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5 mb-4">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image">
                                <img src="img/GambarLogin.svg" alt="Gambar Login">
                            </div>
                            <div class="col-lg-1 d-none d-lg-block vertical-line"></div>
                            <div class="col-lg-5">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Hola! <br>Ini Web Akademik</br></h1>
                                    </div>
                                    <form class="user" action="login.php" method="post">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" id="username" name="username" placeholder="Masukin Username" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Passwordnya Awas Typo" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block" name="tekan">Login</button>
                                    </form>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
</body>
</html>

