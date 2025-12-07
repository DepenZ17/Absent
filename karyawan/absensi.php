<?php 
error_reporting(0);
?>
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
    <title>Absensi</title>
    <link rel="icon" href="../img/Absensi.png" type="image/png">

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
<?php date_default_timezone_set('Asia/Jakarta'); ?>
<body class="animsition" >
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="#">
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
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-tachometer-alt"></i>Kehadiran</a>
                    
                        </li>

                    </ul>
                </div>
            </nav>
        </header>
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="#">
                <h2>Pegawai</h2>
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li class="active has-sub">
                            <a class="js-arrow" href="?m=awal">
                                <i class="fa fa-address-card"></i>Kehadiran</a>
                        </li>
                        <li class="active has-sub">
                            <a class="js-arrow" href="?m=karyawan&s=absensi">
                                <i class="fa fa-calendar"></i>Data Absensi</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <form class="form-header" action="" method="POST">
                                <input class="au-input au-input--xl" type="text" name="search" value="Data Absensi" readonly="" />
                            
                            </form>
                            <div class="header-button">
                            

                                <?php
                                    $id = $_SESSION['idsi'];
                                    include '../koneksi.php';
                                    $sql = "SELECT * FROM tb_karyawan WHERE id_karyawan = '$id'";
                                    $query = mysqli_query($koneksi, $sql);
                                    $r = mysqli_fetch_array($query);
                                ?>

                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="image">
                                            <img src="../images/<?php echo $r['foto'];?>" class="img-circle" alt="<?php echo $r['nama'];?>" />
                                        </div>
                                        <div class="content">
                                            <a class="js-acc-btn" href="#"><?php echo $r['nama']; ?></a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                <div class="image">
                                                    <a href="#">
                                                        <img src="../images/<?php echo $r['foto'];?>" class="img-circle" />
                                                    </a>
                                                </div>
                                                <div class="content">
                                                    <h5 class="name">
                                                        <a href="#"><?php echo $r['nama']; ?></a>
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href="?m=karyawan&s=profil">
                                                        <i class="zmdi zmdi-account"></i>Account</a>
                                                </div>
                                            <div class="account-dropdown__footer">
                                                <a href="logout.php">
                                                    <i class="zmdi zmdi-power"></i>Logout</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                    <div class="table-responsive table--no-card m-b-30">
                <table class="table table-borderless table-striped table-earning">
                        <thead>
                        <tr>
                        <th>No</th>
                        <th>NIP</th>
                        <th>Nama</th>
                        <th>Jenis</th>
                        <th>Status</th>
                        <th>Tanggal & Waktu</th>
                        <th>Keterangan</th>
                        <th>Alasan</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        session_start();
                        if (!isset($_SESSION['idsi'])) {
                            echo '<tr><td colspan="8" class="text-center">Session IDSI is not set.</td></tr>';
                            exit;
                        }

                        $id = $_SESSION['idsi'];
                        include '../koneksi.php';

                        // Paginasi
                        $batas = 10;
                        $halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
                        $halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

                        $data = mysqli_query($koneksi, "SELECT * FROM tb_karyawan WHERE id_karyawan = '$id'");
                        $jumlah_data = mysqli_num_rows($data);
                        $total_halaman = ceil($jumlah_data / $batas);
                        
                        $data_karyawan = mysqli_query($koneksi, "
                            SELECT * FROM (
                                SELECT 
                                    id_karyawan, 
                                    nama, 
                                    'Kehadiran' AS jenis,
                                    COALESCE(status, '-') as status, 
                                    waktu, 
                                    NULL AS keterangan, 
                                    NULL AS alasan
                                FROM tb_kehadiran
                                WHERE id_karyawan = '$id'
                                UNION ALL
                                SELECT 
                                    id_karyawan, 
                                    nama, 
                                    'Absen' AS jenis,
                                    '-' as status, 
                                    waktu, 
                                    keterangan, 
                                    alasan
                                FROM tb_absen
                                WHERE id_karyawan = '$id'
                            ) AS combined_data
                            ORDER BY waktu DESC
                            LIMIT $halaman_awal, $batas
                        ");

                        if (!$data_karyawan) {
                            echo '<tr><td colspan="8" class="text-center">Query Error: ' . mysqli_error($koneksi) . '</td></tr>';
                        } else {
                            if (mysqli_num_rows($data_karyawan) > 0) {
                                $no = $halaman_awal + 1;
                                while ($row = mysqli_fetch_assoc($data_karyawan)) {
                                    $tanggal = DateTime::createFromFormat('Y-m-d H:i:s', $row['waktu'])->format('d-m-Y / H:i:s');
                                    
                                    echo '<tr>';
                                    echo '<td>' . $no++ . '</td>';
                                    echo '<td>' . $row['id_karyawan'] . '</td>';
                                    echo '<td>' . $row['nama'] . '</td>';
                                    echo '<td>' . $row['jenis'] . '</td>';
                                    echo '<td>' . $row['status'] . '</td>';
                                    echo '<td>' . $tanggal . '</td>';
                                    echo '<td>' . ($row['keterangan'] ? $row['keterangan'] : '-') . '</td>';
                                    echo '<td>' . ($row['alasan'] ? $row['alasan'] : '-') . '</td>';
                                    echo '</tr>';
                                }
                            } else {
                                echo '<tr><td colspan="8" class="text-center">Tidak ada data untuk karyawan ini.</td></tr>';
                            }
                        }
                        ?>
                        </tbody>
                </table>
                </div>
                </div>
                
                <ul class="pagination justify-content-center">
        <li class="page-item <?php if ($halaman <= 1) { echo 'disabled'; } ?>">
            <a class="page-link" <?php if ($halaman > 1) { echo "href='?m=karyawan&s=absensi&halaman=".($halaman - 1)."'"; } ?>>Previous</a>
        </li>
    <?php 
    for ($x = 1; $x <= $total_halaman; $x++) {
    ?> 
        <li class="page-item <?php if ($x == $halaman) { echo 'active'; } ?>">
            <a class="page-link" href="?m=karyawan&s=absensi&halaman=<?php echo $x; ?>"><?php echo $x; ?></a>
        </li>
    <?php 
    }
    ?>              
        <li class="page-item <?php if ($halaman >= $total_halaman) { echo 'disabled'; } ?>">
            <a class="page-link" <?php if ($halaman < $total_halaman) { echo "href='?m=karyawan&s=absensi&halaman=".($halaman + 1)."'"; } ?>>Next</a>
        </li>
    </ul>
                    </div>
                </div>
            </div>       
            <!-- END MAIN CONTENT-->
            <!-- END PAGE CONTAINER-->
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

    <div class="row">
        <div class="col-md-12">
            <div class="copyright">
                <p>Copyright © 2018 Colorlib. All rights reserved. Template by <a href="https://colorlib.com">Colorlib</a>.</p>
            </div>
        </div>
    </div>

</body>

</html>
<!-- end document-->