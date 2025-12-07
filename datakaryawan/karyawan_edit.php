<?php 
include '../koneksi.php';
error_reporting(0);
session_start();

// Fetch data for the selected employee
$id = $_GET['id_karyawan'];
$data = mysqli_query($koneksi, "SELECT * FROM tb_karyawan WHERE id_karyawan = '$id'");
$d = mysqli_fetch_array($data);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <title>Ubah Data Karyawan</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Additional CSS -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" media="all">
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">
    <link href="css/theme.css" rel="stylesheet" media="all">
</head>

<body>
    <div class="container">
        <h2 class="mt-4">Ubah Data Karyawan</h2>
        <form action="proedit_karyawan.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="id_karyawan">NIP</label>
                <input type="text" class="form-control" readonly name="id_karyawan" autocomplete="off" value="<?php echo $d['id_karyawan']; ?>">
            </div>

            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" name="username" autocomplete="off" value="<?php echo $d['username']; ?>">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" autocomplete="off">
            </div>

            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" name="nama" autocomplete="off" value="<?php echo $d['nama']; ?>">
            </div>

            <div class="form-group">
                <label for="tmp_tgl_lahir">Tempat dan Tanggal Lahir</label>
                <input type="text" class="form-control" name="tmp_tgl_lahir" autocomplete="off" value="<?php echo $d['tmp_tgl_lahir']; ?>">
            </div>

            <div class="form-group">
                <label for="jenkel">Jenis Kelamin</label>
                <select class="form-control" name="jenkel">
                    <option><?php echo $d['jenkel']; ?></option>
                    <option>Laki-laki</option>
                    <option>Perempuan</option>
                </select>
            </div>

            <div class="form-group">
                <label for="agama">Agama</label>
                <select class="form-control" name="agama">
                    <option><?php echo $d['agama']; ?></option>
                    <option>Islam</option>
                    <option>Kristen</option>
                    <option>Katholik</option>
                    <option>Hindu</option>
                    <option>Buddha</option>
                    <option>KongHuCu</option>
                </select>
            </div>

            <div class="form-group">
                <label for="alamat">Alamat</label>
                <textarea class="form-control" name="alamat" autocomplete="off"><?php echo $d['alamat']; ?></textarea>
            </div>

            <div class="form-group">
                <label for="no_tel">Telepon</label>
                <input type="text" class="form-control" name="no_tel" value="<?php echo $d['no_tel']; ?>">
            </div>

            <div class="form-group">
                <label for="jabatan">Jabatan</label>
                <select class="form-control" name="jabatan">
                    <?php 
                    $sql = "SELECT * FROM tb_jabatan";
                    $hasil = mysqli_query($koneksi, $sql);
                    while ($data = mysqli_fetch_array($hasil)) {
                    ?>
                    <option value="<?php echo $data['jabatan']; ?>"><?php echo $data['jabatan']; ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="form-group">
                <label>Foto</label><br>
                <?php 
                if ($d['foto'] != '') {
                    echo "<img src=\"../images/$d[foto]\" height=\"150\" />";  
                } else {
                    echo "Tidak ada gambar";
                }
                ?>
            </div>

            <div class="form-group">
                <label>Ubah Foto</label>
                <input type="checkbox" name="ubahfoto" value="true"> Ceklis jika ingin mengubah foto!<br>
                <input type="file" name="inpfoto">
            </div>

            <button type="submit" class="btn btn-primary" name="ubahdata">Ubah Data</button>
            <a href="../datakaryawan.php" class="btn btn-danger">Batal</a>
        </form>
    </div>
</body>
</html>
