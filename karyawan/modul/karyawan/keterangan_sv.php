<?php
include 'koneksi.php';

if (isset($_POST['simpan'])) {
    $id_karyawan = $_POST['id_karyawan'];
    $nama = $_POST['nama'];
    $keterangan = $_POST['keterangan'];
    $alasan = $_POST['alasan'];
    $waktu = $_POST['waktu']; // Mengambil waktu dari input hidden

    // Mengubah format tanggal dari d-m-Y H:i:s ke Y-m-d H:i:s
    $tanggal = DateTime::createFromFormat('d-m-Y H:i:s', $waktu);
    if ($tanggal) {
        $waktu = $tanggal->format('Y-m-d H:i:s'); // Format yang akan disimpan ke database
    } else {
        echo "<script>alert('Format tanggal tidak valid');</script>";
        echo '<script>window.history.back();</script>';
        exit; // Berhenti jika format tanggal tidak valid
    }

    // Untuk gambar
    $bukti = $_FILES['bukti']['name'];
    $tmp = $_FILES['bukti']['tmp_name'];
    $buktibaru = date('dmYHis') . $bukti;
    $path = "buktiket/" . $buktibaru;

    if (move_uploaded_file($tmp, $path)) {
        // Memeriksa apakah sudah ada entri untuk hari ini
        $sql = "SELECT * FROM tb_absen 
                WHERE id_karyawan = '$id_karyawan' 
                AND DATE(waktu) = CURDATE()"; // Menggunakan DATE untuk membandingkan tanggal
        $result = mysqli_query($koneksi, $sql);

        if (mysqli_num_rows($result) == 0) {
            // Masukkan data baru jika belum ada entri untuk hari ini
            $query = "INSERT INTO tb_absen (id_karyawan, nama, keterangan, alasan, waktu, bukti) VALUES ('$id_karyawan', '$nama', '$keterangan', '$alasan', '$waktu', '$buktibaru')";
            $insert = mysqli_query($koneksi, $query);

            if ($insert) {
                echo "<script>alert('Keterangan berhasil disimpan');</script>";
                echo '<script>window.history.back();</script>';
            } else {
                echo "Gagal menyimpan data: " . mysqli_error($koneksi);
            }
        } else {
            // Jika sudah ada entri, tampilkan alert
            echo "<script>alert('Anda sudah memberi keterangan untuk hari ini');</script>";
            echo '<script>window.history.back();</script>';
        }
    } else {
        echo "Gagal mengupload file.";
    }
}
?>
