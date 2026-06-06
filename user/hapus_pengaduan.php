<?php
    session_start();
    include '../config/koneksi.php';

    if (!isset($_SESSION['login'])) {
        header ("Location: ../auth/login.php");
        exit;
    }

    $id = $_GET['id'];

    $cek = mysqli_query($conn, "SELECT tanggapan FROM pengaduan WHERE id_pengaduan='$id'");

    $data = mysqli_fetch_assoc($cek);

    if ($data['tanggapan'] != '') {
        echo "<script>
            alert('Pengaduan tidak dapat dihapus karena sudah ditanggapi');
            window.location.href='data_pengaduan.php';
        </script>";
    } else {
        $hapus = mysqli_query($conn, "DELETE FROM pengaduan WHERE id_pengaduan='$id'");

        if ($hapus) {
            echo "<script>
                alert('Pengaduan berhasil dihapus');
                window.location.href='data_pengaduan.php';
            </script>";
        }
    }
?>