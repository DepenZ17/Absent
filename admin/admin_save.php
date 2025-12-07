<?php 
include '../koneksi.php';

if (isset($_POST['simpan'])) {
    
    $username = $_POST['username'];
    $password = md5($_POST['password']); // Enkripsi password menggunakan MD5

    // Simpan data ke dalam database
    $save = "INSERT INTO tb_admin (username, password) VALUES ('$username', '$password')";
    
    if (mysqli_query($koneksi, $save)) {
        header("Location: ../datauser.php");
        exit(); // Pastikan untuk exit setelah header untuk menghentikan eksekusi skrip
    } else {
        echo "Gagal disimpan: " . mysqli_error($koneksi); // Tampilkan pesan kesalahan
    }
}

?>
