<?php
// Memulai sesi untuk memeriksa status login.
session_start();

// ===== 1. KEAMANAN HALAMAN =====
// Memastikan hanya pengguna yang sudah login yang bisa mengakses halaman ini.
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Menyertakan file koneksi database.
require "koneksi.php";

// ===== 2. PENGAMBILAN DATA UNTUK FORM =====

// Mengambil semua data jurusan untuk ditampilkan di dropdown/select.
$queryJurusan = mysqli_query($conn, "SELECT * FROM list_jurusan");
$jumlahJurusan = mysqli_num_rows($queryJurusan);

// Mengambil ID mahasiswa dari URL parameter (?x=...).
$id = $_GET['x'];

// !!! PERINGATAN KEAMANAN #1: SQL INJECTION (pada SELECT) !!!
// Query ini rentan karena nilai `$id` dari URL langsung dimasukkan ke dalam string SQL.
// Penyerang bisa memanipulasi URL untuk menjalankan query berbahaya.
// SOLUSI: Gunakan Prepared Statements.
$queryDataMhs = mysqli_query($conn, "SELECT * FROM list_mahasiswa WHERE id = $id");
$dataMhs = mysqli_fetch_array($queryDataMhs);

// ===== 3. PROSES UPDATE DATA (SETELAH FORM DISUBMIT) =====
if (isset($_POST['simpan-perubahan-data'])) {
    
    // Mengambil data baru dari form yang disubmit.
    $nama = $_POST['nama'];
    $jurusan = $_POST['jurusan'];
    $email = $_POST['email'];

    // !!! PERINGATAN KEAMANAN #2: SQL INJECTION (pada UPDATE) !!!
    // Ini adalah celah keamanan yang SANGAT BERBAHAYA. Penyerang bisa
    // memasukkan data berbahaya ke dalam form yang akan merusak database Anda.
    // SOLUSI: Gunakan Prepared Statements (mysqli_prepare, bind_param, execute).
    $sql = "UPDATE list_mahasiswa SET nama = '$nama', jurusan = '$jurusan', email = '$email' WHERE id=$id";

    if (mysqli_query($conn, $sql)) {
        // Jika update berhasil, tampilkan pesan sukses dan refresh halaman.
        ?>
        <div class="alert alert-success mt-3" role="alert">
            <h4 class="alert-heading">Berhasil!</h4>
            <p>Data Berhasil Diperbaharui</p>
            <hr>
            <p class="mb-0"><i>Pastikan untuk selalu menjaga keamanan data</i></p>
        </div>
        <!-- Meta refresh adalah cara sederhana untuk redirect, namun redirect via header PHP lebih disarankan. -->
        <meta http-equiv="refresh" content="1; url=list_data.php" />
        <?php
    } else {
        // Jika update gagal, tampilkan pesan error.
        ?>
        <div class="alert alert-danger mt-3" role="alert">
            <h4 class="alert-heading">Error!</h4>
            <p>Data Gagal Diperbaharui</p>
            <hr>
            <p class="mb-0"><i>Pastikan semua data sudah benar</i></p>
        </div>
        <?php
    }
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
    <title>Edit Data Mahasiswa</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body id="page-top">    

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include 'sidebar.php'; ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include 'topbar.php'; ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Perbarui Data Mahsiswa</h1>
                    <p class="mb-4">Update Identitas Mahasiswa.</p>

                    <!-- DataTales Example -->

                    <div class="card shadow mb-4">
                        <div class="row">
                            <div class="col-8 mx-3 mb-3">
                                <form action="" method="post">
                                    <div class="mt-3">
                                        <label for="nama">Nama Lengkap</label>
                                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukan Nama Dengan Lengkap" value="<?php echo $dataMhs['nama']; ?>"
                                    </div>
            
                                    <div class="mt-3">
                                        <label for="jurusan">Jurusan</label>
                                        <select class="form-control" aria-label="Default select example" name="jurusan" aria-placeholder="Hai">
                                            
                                            <option selected>
                                            <?php echo $dataMhs['jurusan']; ?>
                                            </option>
                                            
                                            <?php
                                                while ($jurusan = mysqli_fetch_array($queryJurusan)) {
                                                    ?>
                                                    <option><?php echo $jurusan['jurusan'];?></option>
                                            <?php
                                                }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="mt-3">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" name="email" id="email" placeholder="Masukan Alamat Email" value="<?php echo $dataMhs['email']; ?>">
                                    </div>
            
                                    <div class="mt-3">
                                        <div class="row-6 text-right">
                                            <button type="submit" class="btn btn-outline-primary" name="simpan-perubahan-data"> Simpan Perubahan </button>
                                        </div>
                                    </div>
                                </form>

                                <?php
                                    if(isset($_POST['simpan-perubahan-data'])){
                                        
                                        $nama = $_POST['nama'];
                                        $jurusan = $_POST['jurusan'];
                                        $email = $_POST['email'];

                                        $sql = "UPDATE list_mahasiswa SET nama = '$nama', jurusan = '$jurusan', email = '$email' WHERE id=$id";

                                            if(mysqli_query($conn,$sql)){
                                                ?>
                                                <div class="alert alert-success mt-3" role="alert">
                                                        <h4 class="alert-heading">Berhasil!</h4>
                                                        <p>Data Berhasil Diperbaharui</p>
                                                        <hr>
                                                        <p class="mb-0"><i>Pastikan untuk selalu menjaga keamanan data</i></p>
                                                </div>
                                                <meta http-equiv="refresh" content="1; url=list_data.php" />
                                                <?php
                                            } else {
                                                ?>
                                                <div class="alert alert-danger mt-3" role="alert">
                                                        <h4 class="alert-heading">Error!</h4>
                                                        <p>Data Gagal Diperbaharui</p>
                                                        <hr>
                                                        <p class="mb-0"><i>Pastikan semua data sudah benar</i></p>
                                                    </div>
                                                <?php
                                            }

                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php include 'footer.php'; ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <?php include "modal.php" ?>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

</body>

</html>