
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Beranda</title>
    <link rel="icon" href="img/Absensi.png" type="image/png">
    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

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

</head>

<body class="animsition">
    <?php 
    session_start();
    include 'koneksi.php';

    if (!isset($_SESSION['username'])) {
        header("location: index.php");
    }else {
        $username = $_SESSION['username'];  
    }

    // Count total admins in `tb_admin`
    $query_admin = "SELECT COUNT(*) as total_admin FROM tb_admin";
    $result_admin = mysqli_query($koneksi, $query_admin);
    $data_admin = mysqli_fetch_assoc($result_admin);

    // Count total jabatan in `tb_jabatan`
    $query_jabatan = "SELECT COUNT(*) as total_jabatan FROM tb_jabatan";
    $result_jabatan = mysqli_query($koneksi, $query_jabatan);
    $data_jabatan = mysqli_fetch_assoc($result_jabatan);

    // Count total karyawan in `tb_karyawan`
    $query_karyawan = "SELECT COUNT(*) as total_karyawan FROM tb_karyawan";
    $result_karyawan = mysqli_query($koneksi, $query_karyawan);
    $data_karyawan = mysqli_fetch_assoc($result_karyawan);
    
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
                            <h2>Absent Home</h2>
                        </div>
                    </div>
                </div>
            </header>
            <!-- HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">

                        <!-- Admin Card -->
                <div class="col-md-4">
                    <div class="card text-white bg-primary custom-card">
                        <div class="card-body text-center">
                            <h5 class="card-title">Admin</h5>
                            <p class="card-text"><?php echo $data_admin['total_admin']; ?></p>
                        </div>
                    </div>
                </div>

                <!-- Jabatan Card -->
                <div class="col-md-4">
                    <div class="card text-white bg-success custom-card">
                        <div class="card-body text-center">
                            <h5 class="card-title">Jabatan</h5>
                            <p class="card-text"><?php echo $data_jabatan['total_jabatan']; ?></p>
                        </div>
                    </div>
                </div>

                <!-- Karyawan Card -->
                <div class="col-md-4">
                    <div class="card text-white bg-info custom-card">
                        <div class="card-body text-center">
                            <h5 class="card-title">Karyawan</h5>
                            <p class="card-text"><?php echo $data_karyawan['total_karyawan']; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
                    <div class="row">
                <div class="col-md-12">
            <div class="copyright">
                <p>Copyright © 2018 Colorlib. All rights reserved. Template by <a href="https://colorlib.com">Colorlib</a>.</p>
        </div>
    </div>
</div>

    <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
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

    <!-- Main JS-->
    <script src="js/main.js"></script>

</body>

</html>
<!-- end document-->
