<?php 
$koneksi = mysqli_connect("localhost", "root", "", "karyawansi");

if (!$koneksi) {
    echo "Connection failed: " . mysqli_connect_error();
    exit();
}
?>
