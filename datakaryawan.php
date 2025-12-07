<?php
error_reporting(0); 
require_once("koneksi.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta Tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="SI">
    <meta name="author" content="Duha">
    <meta name="keywords" content="SI">

    <!-- Title Page -->
    <title>Data Karyawan</title>
    <link rel="icon" href="img/Absensi.png" type="image/png">
</head>

<body class="animsition">
    <?php 
    session_start();
    if (!isset($_SESSION['username'])) {
        header("location: index.php");
    }else {
        $username = $_SESSION['username'];  
    }

    ?>
    
<div class="page-wrapper">
    <!-- HEADER MOBILE-->
    <header class="header-mobile d-block d-lg-none">
    <div class="header-mobile__bar">
        <div class="container-fluid">
            <div class="header-mobile-inner">
                <a class="logo" href="index.html">
                    <h2>Admin</h2>
                </a>
                <button class="hamburger hamburger--slider" type="button">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <nav class="navbar-mobile">
        <div class="container-fluid">
            <ul class="navbar-mobile__list list-unstyled">
                <li>
                    <a class="js-arrow" href="admin2.php">
                        <i class="zmdi zmdi-info"></i>Beranda</a>
                </li>
                <!-- Dropdown Data Master -->
                <li class="has-sub">
                    <a class="js-arrow" href="#">
                        <i class="zmdi zmdi-dns"></i>Data Master</a>
                    <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                        <li><a href="datauser.php"><i class="zmdi zmdi-account-box"></i>Data Admin</a></li>
                        <li><a href="datakaryawan.php"><i class="zmdi zmdi-account"></i>Data Karyawan</a></li>
                        <li><a href="datajabatan.php"><i class="zmdi zmdi-case"></i>Data Jabatan</a></li>
                    </ul>
                </li>
                <!-- Dropdown Data Absensi -->
                <li class="has-sub">
                    <a class="js-arrow" href="#">
                        <i class="zmdi zmdi-calendar"></i>Data Absensi</a>
                    <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                        <li><a href="data_absen.php"><i class="zmdi zmdi-calendar-check"></i>Data Kehadiran</a></li>
                        <li><a href="data_keterangan.php"><i class="zmdi zmdi-label"></i>Data Absen</a></li>
                    </ul>
                </li>
                <li>
                    <a href="laporan.php">
                        <i class="zmdi zmdi-file-text"></i>Laporan</a>
                </li>
                <li>
                    <a href="logout.php">
                        <i class="zmdi zmdi-power"></i>Logout</a>
                </li>
            </ul>
        </div>
    </nav>
</header>
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR -->
        <aside class="menu-sidebar d-none d-lg-block">
    <div class="logo">
        <a href="admin2.php">
            <h2>Admin</h2>
        </a>
    </div>
    <div class="menu-sidebar__content js-scrollbar1">
        <nav class="navbar-sidebar">
            <ul class="list-unstyled navbar__list">
                <li>
                    <a href="admin2.php">
                        <i class="zmdi zmdi-info"></i>Beranda</a>
                </li>
                <!-- Dropdown Data Master -->
                <li class="has-sub">
                    <a class="js-arrow" href="#">
                        <i class="zmdi zmdi-dns"></i>Data Master</a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                        <li><a href="datauser.php"><i class="zmdi zmdi-account-box"></i>Data Admin</a></li>
                        <li><a href="datakaryawan.php"><i class="zmdi zmdi-account"></i>Data Karyawan</a></li>
                        <li><a href="datajabatan.php"><i class="zmdi zmdi-case"></i>Data Jabatan</a></li>
                    </ul>
                </li>
                <!-- Dropdown Data Absensi -->
                <li class="has-sub">
                    <a class="js-arrow" href="#">
                        <i class="zmdi zmdi-calendar"></i>Data Absensi</a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                        <li><a href="data_absen.php"><i class="zmdi zmdi-calendar-check"></i>Data Kehadiran</a></li>
                        <li><a href="data_keterangan.php"><i class="zmdi zmdi-label"></i>Data Absen</a></li>
                    </ul>
                </li>
                <li>
                    <a href="laporan.php">
                        <i class="zmdi zmdi-file-text"></i>Laporan</a>
                </li>
                <li>
                    <a href="logout.php">
                        <i class="zmdi zmdi-power"></i>Logout</a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
<!-- END MENU SIDEBAR -->
    
    <!-- PAGE CONTAINER-->
    <div class="page-container">
        <!-- HEADER DESKTOP-->
        <header class="header-desktop">
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    <div class="header-wrap">
                    <h3>Data Karyawan</h3>
                        <form class="form-header" action="prospenkar.php" method="POST">
                            <input class="au-input au-input--xl" autocomplete="off" type="text" name="cari" placeholder="Cari NIP atau nama karyawan" />
                            <button class="au-btn--submit" type="submit">
                                <i class="zmdi zmdi-search"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </header>
        <!-- END HEADER DESKTOP-->

        <!-- MAIN CONTENT-->
        <div class="main-content">
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                <!-- Button to trigger-->
                <a href="datakaryawan-form.php" class="btn btn-primary mb-3">
                Tambahkan Karyawan
                </a>

            <?php 
            include 'koneksi.php';
            $query1 = "SELECT * FROM tb_karyawan ORDER BY id_karyawan";
            $pola = 'asc';
            $polabaru = 'asc';
            if (isset($_GET['orderby'])) {
                $orderby = $_GET['orderby'];
                $pola = $_GET['pola'];
            $query1 = "SELECT * FROM tb_karyawan ORDER BY $orderby $pola";
            mysqli_query($koneksi, $query1);
            if ($pola=='asc') {
                $polabaru = 'desc';
            }else{
                $polabaru = 'asc';
            }
            }
            ?>

            <div class="row">
                <div class="table-responsive table--no-card m-b-30">
                <table class="table table-borderless table-striped table-earning">
                    <thead>
                        <tr>
                            <th>No</th>   
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>Tempat & Tanggal Lahir</th>
                            <th class="text-right">Jenis Kelamin</th>
                            <th class="text-right">Agama</th>
                            <th>Alamat</th>
                            <th>Nomor Telepon</th>
                            <th>Jabatan</th>
                            <th>Foto</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                    <?php 
                    include 'koneksi.php';
                    // Paginasi
                    $batas = 5; // Jumlah data per halaman
                    $halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
                    $halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

                    $data = mysqli_query($koneksi, "SELECT * FROM tb_karyawan");
                    $jumlah_data = mysqli_num_rows($data);
                    $total_halaman = ceil($jumlah_data / $batas);
                    $data_karyawan = mysqli_query($koneksi, "SELECT * FROM tb_karyawan LIMIT $halaman_awal, $batas");
                    $no = $halaman_awal + 1;
                    while ($row = mysqli_fetch_array($data_karyawan)) {
                    ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $row['id_karyawan']; ?></td>
                        <td><?php echo $row['nama']; ?></td>
                        <td><?php echo $row['tmp_tgl_lahir']; ?></td>
                        <td><?php echo $row['jenkel']; ?></td>
                        <td><?php echo $row['agama']; ?></td>
                        <td><?php echo $row['alamat']; ?></td>
                        <td><?php echo $row['no_tel']; ?></td>
                        <td><?php echo $row['jabatan']; ?></td>
                        <td><img src="images/<?php echo $row['foto'];?>" alt="Foto Karyawan"></td>
                        <td>
                            <a href="datakaryawan/karyawan_edit.php?id_karyawan=<?php echo $row['id_karyawan']; ?>">
                                <button class="btn btn-primary">Ubah</button>
                            </a>
                            <a href="datakaryawan/hapus.php?id_karyawan=<?php echo $row['id_karyawan']; ?>">
                                <button class="btn btn-danger" onclick="return confirm('yakin ingin dihapus?');">Hapus</button>
                            </a>
                        </td>
                    </tr>

                    <?php 
                    $no++;
                    }
                    ?>

                    </tbody>
                </table>
                </div>
            </div>
                    <ul class="pagination justify-content-center">
                        <li class="page-item <?php if ($halaman <= 1) { echo 'disabled'; } ?>">
                            <a class="page-link" <?php if ($halaman > 1) { echo "href='?halaman=".($halaman - 1)."'"; } ?>>Previous</a>
                        </li>
                    <?php 
                    for ($x = 1; $x <= $total_halaman; $x++) {
                    ?> 
                        <li class="page-item <?php if ($x == $halaman) { echo 'active'; } ?>">
                            <a class="page-link" href="?halaman=<?php echo $x; ?>"><?php echo $x; ?></a>
                        </li>
                    <?php 
                    }
                    ?>              
                        <li class="page-item <?php if ($halaman >= $total_halaman) { echo 'disabled'; } ?>">
                            <a class="page-link" <?php if ($halaman < $total_halaman) { echo "href='?halaman=".($halaman + 1)."'"; } ?>>Next</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap CSS and Main Scripts-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    <!-- Fontfaces CSS-->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" media="all">
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">

    <!-- Vendor JS -->
    <script src="vendor/slick/slick.min.js">
    </script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/select2/select2.min.js">
    </script>

    <!-- Main JS -->
    <script src="js/main.js"></script>
    <!-- end script -->
</div>    
</body>
</html>
<!-- end document-->
