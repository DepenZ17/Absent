<?php
include '../koneksi.php';

if (isset($_POST['simpan'])) {
    $id_karyawan = $_POST['id_karyawan'];
    $nama = $_POST['nama'];
    $waktu = $_POST['waktu'];
    $status = $_POST['simpan']; // Mengambil nilai status (masuk/pulang)

    // Menghindari SQL Injection
    $id_karyawan = mysqli_real_escape_string($koneksi, $id_karyawan);
    $nama = mysqli_real_escape_string($koneksi, $nama);
    $waktu = mysqli_real_escape_string($koneksi, $waktu);
    $status = mysqli_real_escape_string($koneksi, $status);

    // Mengubah format tanggal dari d-m-Y H:i:s ke Y-m-d H:i:s
    $tanggal = DateTime::createFromFormat('d-m-Y H:i:s', $waktu);
    if ($tanggal) {
        $waktu = $tanggal->format('Y-m-d H:i:s');
    } else {
        echo "<script>alert('Format tanggal tidak valid');</script>";
        echo "<script>window.location.href = 'index.php?m=awal';</script>";
        exit;
    }

    // Mengecek apakah sudah absen dengan status yang sama hari ini
    $queryCheck = "SELECT status FROM tb_kehadiran 
                  WHERE id_karyawan = '$id_karyawan' 
                  AND DATE(waktu) = CURDATE() 
                  AND status LIKE '$status%'"; // Menggunakan LIKE untuk mencakup status terlambat
    $resultCheck = mysqli_query($koneksi, $queryCheck);
    
    if (mysqli_num_rows($resultCheck) > 0) {
        $message = $status == 'masuk' ? 'Anda sudah absen masuk hari ini' : 'Anda sudah absen pulang hari ini';
        echo "<script>alert('$message');</script>";
        echo "<script>window.location.href = 'index.php?m=awal';</script>";
    } else {
        // Jika status pulang, cek apakah sudah absen masuk
        if ($status == 'pulang') {
            $checkMasuk = "SELECT status FROM tb_kehadiran 
                          WHERE id_karyawan = '$id_karyawan' 
                          AND DATE(waktu) = CURDATE() 
                          AND status LIKE 'masuk%'";
            $resultMasuk = mysqli_query($koneksi, $checkMasuk);
            
            if (mysqli_num_rows($resultMasuk) == 0) {
                echo "<script>alert('Anda harus absen masuk terlebih dahulu');</script>";
                echo "<script>window.location.href = 'index.php?m=awal';</script>";
                exit;
            }
        }

        // Cek waktu masuk
        if ($status == 'masuk') {
            $jam_masuk = strtotime(date('H:i:s', strtotime($waktu)));
            $batas_jam = strtotime('07:00:00');
            
            if ($jam_masuk <= $batas_jam) {
                $status = 'masuk-tepat waktu';
                $selisih = $batas_jam - $jam_masuk;
                $jam = floor($selisih / 3600);
                $menit = floor(($selisih % 3600) / 60);
                
                if ($selisih > 0) {
                    echo "<script>alert('Anda lebih awal $jam jam $menit menit');</script>";
                } else {
                    echo "<script>alert('Anda masuk tepat waktu!');</script>";
                }
            } else {
                $status = 'masuk-terlambat'; // Mengubah 'terlambat' menjadi 'masuk-terlambat'
                $selisih = $jam_masuk - $batas_jam;
                $jam = floor($selisih / 3600);
                $menit = floor(($selisih % 3600) / 60);
                echo "<script>alert('Anda terlambat $jam jam $menit menit');</script>";
            }
        }

        // Simpan data absen
        $save = "INSERT INTO tb_kehadiran (id_karyawan, nama, waktu, status) 
                VALUES ('$id_karyawan', '$nama', '$waktu', '$status')";
        
        if (mysqli_query($koneksi, $save)) {
            $message = $status == 'masuk-tepat waktu' ? 'Absen berhasil (Tepat Waktu)' : 
                     ($status == 'masuk-terlambat' ? 'Absen berhasil (Terlambat)' : 'Absen pulang berhasil');
            echo "<script>alert('$message');</script>";
            echo "<script>window.location.href = 'index.php?m=awal';</script>";
        } else {
            echo "Absen gagal: " . mysqli_error($koneksi);
        }
    }
}
?>
