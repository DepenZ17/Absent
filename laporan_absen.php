<?php
require_once("koneksi.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil tanggal dari form
    $awal = $_POST['awal'];
    $akhir = $_POST['akhir'];
}
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
    <title>Hasil Laporan Kehadiran</title>
    <link rel="icon" href="img/Absensi.png" type="image/png">
</head>

<body class="animsition">
    <?php 
    if (!isset($_SESSION['username'])) {
        header("location: index.php");
    } else {
        $username = $_SESSION['username'];  
    }
    if (isset($_GET['awal']) && isset($_GET['akhir'])) {
        $mulai = $_GET['awal'];
        $selesai = $_GET['akhir'];
    
        // Validasi dan format tanggal jika perlu
        $mulai_date = DateTime::createFromFormat('Y-m-d', $mulai);
        $selesai_date = DateTime::createFromFormat('Y-m-d', $selesai);

        if (!$mulai_date || !$selesai_date) {
            echo "<script>alert('Format tanggal tidak valid');</script>";
            exit;
        }
        
        // Convert to d/m/Y for display but keep the original format for calculations
        $mulai_display = DateTime::createFromFormat('Y-m-d', $mulai)->format('d/m/Y');
        $selesai_display = DateTime::createFromFormat('Y-m-d', $selesai)->format('d/m/Y');
        
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
                        <h3>Laporan Absen</h3>
                        </div>
                    </div>
                </div>
            </header>
            <!-- END HEADER DESKTOP-->

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <h2 class="text-center">LAPORAN DATA KEHADIRAN</h2>
            <h5 class="text-center">Periode <?php echo $mulai_display ." - ". $selesai_display ?></h5>
            
            <?php
            // Check if date range is provided


                // Query to fetch data
                $sql = "
                SELECT 
                    id_karyawan, 
                    nama, 
                    'Kehadiran' AS jenis,
                    COALESCE(status, '-') as status, 
                    waktu, 
                    NULL AS keterangan, 
                    NULL AS alasan
                FROM tb_kehadiran
                WHERE id_karyawan IS NOT NULL 
                AND DATE(waktu) BETWEEN '{$mulai}' AND '{$selesai}'

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
                WHERE id_karyawan IS NOT NULL 
                AND DATE(waktu) BETWEEN '{$mulai}' AND '{$selesai}'
                ORDER BY waktu;
                ";

                $query = mysqli_query($koneksi, $sql);

                echo '<div class="text-right">';
                echo '<a href="laporan_cetak.php?awal=' . $mulai . '&akhir=' . $selesai . '" target="_blank" class="btn btn-success mb-3">Cetak Laporan</a>';
                echo '</div>';

                if (!$query) {
                    echo '<div class="alert alert-danger">Query Error: ' . mysqli_error($koneksi) . '</div>';
                    exit;
                }

            if (mysqli_num_rows($query) > 0) {
                echo '<div class="table-responsive table--no-card m-b-30">';
                echo '<table class="table table-borderless table-striped table-earning">';
                echo '<thead>';
                echo '<tr>';
                echo '<th>No</th>';
                echo '<th>ID Karyawan</th>';
                echo '<th>Nama</th>';
                echo '<th>Jenis</th>';
                echo '<th>Status</th>';
                echo '<th>Tanggal & Waktu</th>';
                echo '<th>Keterangan</th>';
                echo '<th>Alasan</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';

                $no = 1;
                while ($row = mysqli_fetch_assoc($query)) {
                    // Format waktu
                    $tanggal_waktu = DateTime::createFromFormat('Y-m-d H:i:s', $row['waktu'])->format('d-m-Y / H:i:s');

                    echo '<tr>';
                    echo '<td>' . $no++ . '</td>';
                    echo '<td>' . $row['id_karyawan'] . '</td>';
                    echo '<td>' . $row['nama'] . '</td>';
                    echo '<td>' . $row['jenis'] . '</td>';
                    echo '<td>' . $row['status'] . '</td>';
                    echo '<td>' . $tanggal_waktu . '</td>';
                    echo '<td>' . ($row['keterangan'] ? $row['keterangan'] : '-') . '</td>';
                    echo '<td>' . ($row['alasan'] ? $row['alasan'] : '-') . '</td>';
                    echo '</tr>';
                }

                echo '</tbody>';
                echo '</table>';
                echo '</div>';
                } else {
                    echo '<div class="alert alert-info">Tidak ada data untuk rentang tanggal yang dipilih.</div>';
                }
            } else {
                echo '<div class="alert alert-danger">Tanggal awal dan akhir diperlukan!</div>';
            }
            ?>
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
    <script src="vendor/slick/slick.min.js"></script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-circle-progress@1.2.2/dist/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/select2/select2.min.js"></script>

    <!-- Main JS -->
    <script src="js/main.js"></script>

    <!-- Datepicker JS-->
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>

    <!-- Datepicker -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

    <!-- Datepicker Initialization -->
    <script>
    $(document).ready(function () {
        $("#awal").datepicker({
            dateFormat: "dd-mm-yy",
            onSelect: function (selectedDate) {
                $("#akhir").datepicker("option", "minDate", selectedDate);
            }
        });

        $("#akhir").datepicker({
            dateFormat: "dd-mm-yy",
            onSelect: function (selectedDate) {
                $("#awal").datepicker("option", "maxDate", selectedDate);
            }
        });
    });
    </script>
</body>
</html>