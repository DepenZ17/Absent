<?php
include 'koneksi.php';

//proses input
if (isset($_POST['simpan'])) {
  $id_karyawan = $_POST['id_karyawan'];
  $username = $_POST['username'];
  $password = $_POST['password']; // Tidak langsung di-hash
  $nama = $_POST['nama'];
  $tmp_tgl_lahir = $_POST['tmp_tgl_lahir'];
  $jenkel = $_POST['jenkel'];
  $agama = $_POST['agama'];
  $alamat = $_POST['alamat'];
  $no_tel = $_POST['no_tel'];
  $jabatan = $_POST['jabatan'];

  // Jika password kosong, ambil password lama dari database
  if (empty($password)) {
    $sql_password = "SELECT password FROM tb_karyawan WHERE id_karyawan = '$id_karyawan'";
    $result_password = mysqli_query($koneksi, $sql_password);
    if ($row_password = mysqli_fetch_assoc($result_password)) {
      $password = $row_password['password']; // Gunakan password lama
    } else {
      echo "Gagal mendapatkan password lama.";
      exit;
    }
  } else {
    $password = md5($password); // Hash password baru
  }

  if (isset($_POST['ubahfoto'])) { // Cek apakah user ingin mengubah fotonya atau tidak
    $foto     = $_FILES['inpfoto']['name'];
    $tmp      = $_FILES['inpfoto']['tmp_name'];
    $fotobaru = date('dmYHis') . $foto;
    $path     = "../images/" . $fotobaru;

    if (move_uploaded_file($tmp, $path)) { //awal move upload file
      $sql    = "SELECT * FROM tb_karyawan WHERE id_karyawan = '$id_karyawan'";
      $query  = mysqli_query($koneksi, $sql);
      $hapus_f = mysqli_fetch_array($query);

      //proses hapus gambar
      $file = "../images/" . $hapus_f['foto'];
      unlink($file); //nama variabel yang ada di server

      // Proses ubah data ke Database
      $sql_f = "UPDATE tb_karyawan SET username='$username', password='$password', nama='$nama', tmp_tgl_lahir='$tmp_tgl_lahir', jenkel='$jenkel', agama='$agama', alamat='$alamat', no_tel='$no_tel', jabatan='$jabatan', foto='$fotobaru' WHERE id_karyawan='$id_karyawan'";
      $ubah  = mysqli_query($koneksi, $sql_f);
      if ($ubah) {
        echo "<script>alert('Ubah Data Dengan ID Karyawan = " . $id_karyawan . " Berhasil');</script>";
        header('Location:index.php?m=karyawan&s=profil');
        exit;
      } else {
        echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";
      }
    } else {
      // Jika gambar gagal diupload, kembalikan ke halaman ini
      echo "<script>alert('Gambar gagal diupload. Pastikan file valid.');</script>";
      echo "<script>window.history.back();</script>";
      exit;
    }
  } else { //hanya untuk mengubah data tanpa foto
    $sql_d = "UPDATE tb_karyawan SET username='$username', password='$password', nama='$nama', tmp_tgl_lahir='$tmp_tgl_lahir', jenkel='$jenkel', agama='$agama', alamat='$alamat', no_tel='$no_tel', jabatan='$jabatan' WHERE id_karyawan='$id_karyawan'";
    $data = mysqli_query($koneksi, $sql_d);
    if ($data) {
      echo "<script>alert('Ubah Data Dengan ID Karyawan = " . $id_karyawan . " Berhasil');</script>";
      header('Location:index.php?m=karyawan&s=profil');
      exit;
    } else {
      echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";
    }
  }
}
?>