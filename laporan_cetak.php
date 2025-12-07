<?php
require_once("koneksi.php");
session_start();

if (isset($_GET['awal']) && isset($_GET['akhir'])) {
    $mulai = $_GET['awal'];
    $selesai = $_GET['akhir'];

    $mulai_display = DateTime::createFromFormat('Y-m-d', $mulai)->format('d/m/Y');
    $selesai_display = DateTime::createFromFormat('Y-m-d', $selesai)->format('d/m/Y');

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
    AND DATE(waktu) BETWEEN '$mulai' AND '$selesai'

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
    AND DATE(waktu) BETWEEN '$mulai' AND '$selesai'
    ORDER BY waktu;
    ";

    $query = mysqli_query($koneksi, $sql);

    if (!$query) {
        die("Query Error: " . mysqli_error($koneksi));
    }

    // Page description
    $pagedesc = "Laporan Data Kehadiran - Periode $mulai_display - $selesai_display";
    $pagetitle = str_replace(" ", "_", $pagedesc);
} else {
    die("Error: Tanggal awal dan akhir tidak ditemukan!");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Jaya Raya">

    <title><?php echo $pagetitle ?></title>
    <link rel="icon" href="img/Absensi.png" type="image/png">
<style>
/* General styles for the table in body-of-report */
#body-of-report table {
    border-collapse: collapse;
    width: 100%;
}

#body-of-report table, 
#body-of-report th, 
#body-of-report td {
    border: 2px solid black; /* Thicker border for visibility */
    padding: 8px;
    text-align: center;
}

#body-of-report th {
    background-color: #f2f2f2; /* Light gray for header */
    font-weight: bold;
    color: #000; /* Black text for header */
}

#body-of-report td {
    background-color: #ffffff; /* White background for body cells */
    color: #333; /* Slightly darker text for readability */
}

/* Hover effect for rows */
#body-of-report tr:hover {
    background-color: #f9f9f9; /* Light background on hover */
}

/* Responsive adjustments */
@media (max-width: 768px) {
    #body-of-report table {
        font-size: 14px; /* Adjust font size for smaller screens */
    }
}

/* Print styles */
@media print {
    #body-of-report table, 
    #body-of-report th, 
    #body-of-report td {
        border: 2px solid black !important; /* Ensure borders are visible in print */
    }
    #body-of-report th {
        background-color: #f2f2f2 !important;
        -webkit-print-color-adjust: exact; /* Chrome/Safari */
        print-color-adjust: exact; /* Other browsers */
    }
    #body-of-report td {
        background-color: #ffffff !important; /* Ensure white background in print */
    }
}

/* Style for horizontal line below the header */
hr.line-bottom {
    border: 0;
    border-top: 3px solid black; /* Garis tebal */
    margin-top: 10px;
    margin-bottom: 20px; /* Jarak dari elemen lainnya */
}
</style>

    <body onload="window.print()">
    <section id="header-kop">
    <div class="container-fluid">
        <table class="table table-borderless">
            <tbody>
                <tr>
                    <td class="text-left" width="20%">
                        <img src="images/jr_logo.jpg" alt="jr_logo" width="102" />
                    </td>
                    <td class="text-center" width="60%">
                        <b>SUKU DINAS PENDIDIKAN</b> <br>
                        Ktr. Walikota Jkt Tim., Komplek Jl. Dr. Sumarno No.1, Pulo Gebang, Kec. Cakung, Kota Jakarta Timur, Daerah Khusus Ibukota Jakarta 13940<br>
                        Telp: (021) 48702407
                    </td>
                    <td class="text-right" width="20%">
                        <!-- Kosong jika tidak ada konten tambahan -->
                    </td>
                </tr>
            </tbody>
        </table>
        <hr class="line-bottom" />
    </div>
    </section>

    
    <section id="body-of-report">
        <div class="container-fluid">
            <h4 class="text-center">LAPORAN DATA KEHADIRAN</h4>
            <h5 class="text-center">Periode <?php echo $mulai_display ." - ". $selesai_display ?></h5>
            <br />
            <table class="table table-bordered table-keuangan">
                <thead>
                    <tr>
                        <th width="1%">No</th>
                        <th width="15%">ID Karyawan</th>
                        <th width="20%">Nama</th>
                        <th width="10%">Jenis</th>
                        <th width="10%">Status</th>
                        <th width="15%">Tanggal & Waktu</th>
                        <th width="15%">Keterangan</th>
                        <th width="15%">Alasan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    while ($data = mysqli_fetch_array($query)) {
                        $date = DateTime::createFromFormat('Y-m-d H:i:s', $data['waktu']);
                        $tanggal_waktu = $date ? $date->format('d-m-Y / H:i:s') : 'Invalid Date';

                        echo '<tr>';
                        echo '<td class="text-center">' . $i . '</td>';
                        echo '<td>' . $data['id_karyawan'] . '</td>';
                        echo '<td>' . $data['nama'] . '</td>';
                        echo '<td class="text-center">' . $data['jenis'] . '</td>';
                        echo '<td class="text-center">' . $data['status'] . '</td>';
                        echo '<td class="text-center">' . $tanggal_waktu . '</td>';
                        echo '<td>' . ($data['keterangan'] ?: '-') . '</td>';
                        echo '<td>' . ($data['alasan'] ?: '-') . '</td>';
                        echo '</tr>';
                        $i++;
                    }
                    ?>
                </tbody>
            </table>
            <br />
        </div>
    </section>

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
