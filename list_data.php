<?php
// Cek apakah pengguna sudah login
session_start();
require "koneksi.php";
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
    
    $queryMahasiswa = mysqli_query($conn, "SELECT * FROM list_mahasiswa");
    $jumlahMahasiswa = mysqli_num_rows($queryMahasiswa);                                                
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Tambah Data</title>

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
                    <h1 class="h3 mb-2 text-gray-800">List Mahasiswa</h1>
                    <p class="mb-4">Daftar Identitas Mahasiswa UNTAT.</p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                        <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Jurusan</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Action</th>
                                        </tr>
                                </thead>
                                <tbody>
                                    
                                <?php
                                        $nomor = 1;

                                       while($data=mysqli_fetch_array($queryMahasiswa)){
                                ?>
                                        <tr>
                                            <th scope="col"><?php echo $nomor; ?></th>
                                            <th scope="col"><?php echo $data['nama']; ?></th>
                                            <th scope="col"><?php echo $data['jurusan']; ?></th>
                                            <th scope="col"><?php echo $data['email']; ?></th>
                                            <th scope="col">
                                                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                                    <a href="edit-Mahasiswa.php?x=<?php  echo $data['id'] ; ?>" class="btn btn-warning">Edit</a>
                                                    <a href="hapus_mahasiswa.php?x=<?php  echo $data['id'] ; ?>" class="btn btn-danger">Delete</a>
                                                    
                                                </div>
                                            </th>
                                        </tr>
                                <?php 
                                       $nomor++;
                                       }

                                       if (isset($_POST['hapus_Mahasiswa'])) {
                                        echo 'Berhasil';
                                    }
                                    ?>
                                </tbody>
                                </table>
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