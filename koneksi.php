<?php
    // Cek apakah pengguna sudah login
$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'data_mahasiswa';

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if(!$conn){
    die ("Database belum terhubung !" . mysqli_connect_error());
}
?>