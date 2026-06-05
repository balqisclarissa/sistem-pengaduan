<?php
    session_start();
    include '../config/koneksi.php';

    if (!isset($_SESSION['login'])) {
        header("Location: ../auth/login.php");
        exit;
    }

    if ($_SESSION['role'] != 'admin') {
        header("Location: ../user/index.php");
        exit;
    }

    $id = $_GET['id'];

    $cek = mysqli_query($conn,
        "SELECT status
        FROM pengaduan
        WHERE id_pengaduan='$id'"
    );

    $data = mysqli_fetch_assoc($cek);

    if ($data['status'] != 'Selesai') {

        echo "<script>
            alert('Pengaduan hanya dapat dihapus jika status telah selesai');
            window.location.href='index.php';
        </script>";

    } else {

        $hapus = mysqli_query($conn,
            "DELETE FROM pengaduan
            WHERE id_pengaduan='$id'"
        );

        if ($hapus) {
            echo "<script>
                alert('Pengaduan berhasil dihapus');
                window.location.href='index.php';
            </script>";
        }
    }
?>