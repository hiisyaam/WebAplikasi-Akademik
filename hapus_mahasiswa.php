
<?php

session_start();

// Cek apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

    require "koneksi.php";
    $id = $_GET['x'];
    $queryHapus = "DELETE FROM list_mahasiswa WHERE id = $id";
    if (mysqli_query($conn,$queryHapus)) {
        header("Location: list_data.php");
        ?>
        <meta http-equiv="refresh" content="3; url=list_data.php" />
        <?php
        echo "<script>alert('Belum Dibangun!')</script>";
    }else{
        echo "Gagal";
    }
?>