<?php
session_start();
include '../config/koneksi.php';

if (isset($_POST['id_pengaduan']) && isset($_POST['status'])) {

    $id_pengaduan = $_POST['id_pengaduan'];
    $status = $_POST['status'];

    $update = mysqli_query(
        $conn,
        "UPDATE pengaduan
         SET status='$status'
         WHERE id_pengaduan='$id_pengaduan'"
    );

    if ($update) {

        echo "<script>
            alert('Status berhasil diubah');
            window.location.href='index.php';
        </script>";

    } else {

        echo "<script>
            alert('Status gagal diubah');
            window.location.href='index.php';
        </script>";

    }

} else {

    header("Location: index.php");
    exit;

}
?>