<?php
    session_start();

    // Cek apakah pengguna sudah login
    if (!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit();
    }

    require "koneksi.php";

    $queryJurusan = mysqli_query($conn,"SELECT * FROM list_jurusan");
    $jumlahJurusan = mysqli_num_rows($queryJurusan);
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Tambah Mahasiswa</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
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
                    <h1 class="h3 mb-2 text-gray-800">Tambah Data Mahsiswa</h1>
                    <p class="mb-4">Masukan Identitas Mahasiswa.</p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="row">
                            <div class="col-8 mx-3 mb-3">
                                <form action="" method="post">
                                    <div class="mt-3">
                                        <label for="nama">Nama Lengkap</label>
                                        <input type="text" id="nama" name="nama" placeholder="Masukan Nama Lengkap" class="form-control">
                                    </div>
            
                                    <div class="mt-3">
                                        <label for="jurusan">Jurusan</label>
                                        <select class="form-control" aria-label="Default select example" name="jurusan">
                                            <option selected>Pilih Jurusan</option>
                                            <?php
                                            while ($data = mysqli_fetch_array($queryJurusan)) {
                                            ?>
                                                <option><?php echo $data['jurusan']; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
            
            
                                    <div class="mt-3">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" id="email" class="form-control" placeholder="Masukan Alamat Email">
                                    </div>
            
                                    <div class="mt-3">
                                        <div class="row-6 text-right">
                                            <button type="submit" class="btn btn-outline-primary" name="simpan-data"> Submit </button>
                                            <button type="reset" class="btn btn-outline-secondary"> Reset </button>
                                        </div>
                                    </div>
                                </form>

                                

                                <?php
                                    if(isset($_POST['simpan-data'])){
                                        $nama = $_POST['nama'];
                                        $jurusan = $_POST['jurusan'];
                                        $email = $_POST['email'];

                                        $sql = "INSERT INTO list_mahasiswa (nama, jurusan, email) VALUES ('$nama', '$jurusan', '$email')";
                                        
                                            
                                
                                            if (mysqli_query($conn, $sql)) {
                                                ?>
                                                    <div class="alert alert-success mt-3" role="alert">
                                                        <h4 class="alert-heading">Berhasil!</h4>
                                                        <p>Data yang dimasukan berhasil disimpan. Pastikan data yang diinput benar. Anda dapat mengubah pada halaman list Mahasiswa</p>
                                                        <hr>
                                                        <p class="mb-0"><i>Pastikan untuk selalu menjaga keamanan data</i></p>
                                                        <meta http-equiv="refresh" content="3; url=tambahMahasiswa.php" />
                                                    </div>
                                                <?php
                                            } else {
                                                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
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