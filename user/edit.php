<?php
session_start();
include '../config/koneksi.php';

if (!isset($_SESSION['id_user'])) {
    header("Location: ../auth/login.php");
    exit;
}

$id_pengaduan = $_GET['id'];
$id_user = $_SESSION['id_user'];

$query = mysqli_query(
    $conn,
    "SELECT * FROM pengaduan
     WHERE id_pengaduan='$id_pengaduan'
     AND id_user='$id_user'"
);

$data = mysqli_fetch_assoc($query);

if (!$data) {
    echo "Data tidak ditemukan!";
    exit;
}

if (isset($_POST['submit'])) {

    $isi_pengaduan = $_POST['isi_pengaduan'];

    $update = mysqli_query(
        $conn,
        "UPDATE pengaduan
         SET isi_pengaduan='$isi_pengaduan'
         WHERE id_pengaduan='$id_pengaduan'"
    );

    if ($update) {

        echo "<script>
            alert('Pengaduan berhasil diubah');
            window.location.href='data_pengaduan.php';
        </script>";

    } else {

        echo "<script>
            alert('Pengaduan gagal diubah');
        </script>";

    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Pengaduan</title>
</head>
<body>

    <h2>Edit Pengaduan</h2>

    <form method="POST">

        <label>Isi Pengaduan</label>
        <br><br>

        <textarea
            name="isi_pengaduan"
            rows="5"
            cols="50"
            required><?= $data['isi_pengaduan']; ?></textarea>

        <br><br>

        <button type="submit" name="submit">
            Simpan Perubahan
        </button>

        <button type="button"
                onclick="window.location.href='data_pengaduan.php'">
            Kembali
        </button>

    </form>

</body>
</html>