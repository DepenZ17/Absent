<?php
session_start();
require_once("../koneksi.php"); // Pastikan jalur ini benar

$username = $_POST['username'];
$password = md5($_POST['password']); // Enkripsi password dengan MD5

// Cek Admin menggunakan prepared statement
$sqlAdmin = "SELECT * FROM tb_admin WHERE username = ? AND password = ?";
$stmtAdmin = $koneksi->prepare($sqlAdmin);
$stmtAdmin->bind_param("ss", $username, $password);
$stmtAdmin->execute();
$resultAdmin = $stmtAdmin->get_result();

// Cek Karyawan menggunakan prepared statement
$sqlKaryawan = "SELECT * FROM tb_karyawan WHERE username = ? AND password = ?";
$stmtKaryawan = $koneksi->prepare($sqlKaryawan);
$stmtKaryawan->bind_param("ss", $username, $password);
$stmtKaryawan->execute();
$resultKaryawan = $stmtKaryawan->get_result();

// Debugging: Cek hasil query
if ($resultAdmin->num_rows > 0) {
    $adminData = $resultAdmin->fetch_assoc();
    $_SESSION['username'] = $adminData['username'];
    $_SESSION['role'] = 'admin';
    $_SESSION['success'] = "Login admin berhasil!";
    // Redirect menggunakan JavaScript
    echo '<script>
            sessionStorage.setItem("redirect", "../admin2.php");
            sessionStorage.setItem("alertType", "success");
            sessionStorage.setItem("alertMessage", "' . $_SESSION['success'] . '");
            window.location = "login_karyawan.php";
          </script>';
    exit();
} 

// Proses Login Karyawan
elseif ($resultKaryawan->num_rows > 0) {
    $karyawanData = $resultKaryawan->fetch_assoc();
    $_SESSION['idsi'] = $karyawanData['id_karyawan'];
    $_SESSION['usersi'] = $karyawanData['username'];
    $_SESSION['namasi'] = $karyawanData['nama'];
    $_SESSION['ttlsi'] = $karyawanData['tmp_tgl_lahir'];
    $_SESSION['jenkelsi'] = $karyawanData['jenkel'];
    $_SESSION['agamasi'] = $karyawanData['agama'];
    $_SESSION['alamatsi'] = $karyawanData['alamat'];
    $_SESSION['teleponsi'] = $karyawanData['no_tel'];
    $_SESSION['jabatansi'] = $karyawanData['jabatan'];
    $_SESSION['fotosi'] = $karyawanData['foto'];

    $_SESSION['success'] = "Login karyawan berhasil!";
    // Redirect menggunakan JavaScript
    echo '<script>
            sessionStorage.setItem("redirect", "index.php?m=awal");
            sessionStorage.setItem("alertType", "success");
            sessionStorage.setItem("alertMessage", "' . $_SESSION['success'] . '");
            window.location = "login_karyawan.php";
          </script>';
    exit();
} 
// Jika tidak ditemukan di keduanya
else {
    // Pesan error ditambahkan untuk debugging
    $_SESSION['error'] = "Username atau password salah!";
    echo '<script>
            sessionStorage.setItem("redirect", "login_karyawan.php");
            sessionStorage.setItem("alertType", "error");
            sessionStorage.setItem("alertMessage", "' . $_SESSION['error'] . '");
            window.location = "login_karyawan.php";
          </script>';
    exit();
}
?>
