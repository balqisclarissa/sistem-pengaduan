<?php
    session_start();
    include '../config/koneksi.php';

    if (!isset($_SESSION['login'])) {
        header("Location: ../auth/login.php");
        exit;
    }

    if (isset($_POST['submit'])) {
        $id_user = $_SESSION['id_user'];
        $isi_pengaduan = $_POST['isi_pengaduan'];

        $query = mysqli_query ($conn, "INSERT INTO pengaduan (id_user, isi_pengaduan) VALUES ('$id_user', '$isi_pengaduan')");

        if ($query) {
            echo "<script> 
            alert('Pengaduan berhasil ditambahkan');
            window.location.href = 'data_pengaduan.php';
            </script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pengaduan</title>
</head>
<body>
    <h2>Tambah Pengaduan</h2>
    <form method="POST">
        <label>Isi Pengaduan:</label><br><br>
        <input type="text" name="isi_pengaduan" placeholder="Masukkan Pengaduan"required><br><br>

        <button type="submit" name="submit">Submit</button>
    </form>
</body>
</html>