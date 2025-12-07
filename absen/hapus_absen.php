<?php 

include '../koneksi.php';

$id = $_GET['id'];

$sql = "DELETE FROM tb_kehadiran WHERE id_absensi = '$id'";
$hapus = mysqli_query($koneksi, $sql);

if ($hapus) {
	header("location: ../data_absen.php");
}else{
echo "gagal dihapus";
} 
 ?>
