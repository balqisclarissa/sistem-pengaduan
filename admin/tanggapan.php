<?php
session_start();
include '../config/koneksi.php';

$id = $_GET['id'];

$data = mysqli_query(
    $conn, "SELECT * FROM pengaduan WHERE id_pengaduan='$id'"
);

$pengaduan = mysqli_fetch_assoc($data);

if(isset($_POST['submit'])) {
    $tanggapan = $_POST['tanggapan'];

    $update = mysqli_query(
        $conn, 
        "UPDATE pengaduan SET tanggapan='$tanggapan' WHERE id_pengaduan='$id'"
    );

    if($update) {
        echo "<script>
        alert('Tanggapan berhasil ditambahkan');
        window.location.href='index.php';
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tanggapan Pengaduan</title>
</head>
<body>
    <p>
        <b>Isi Pengaduan</b><br>
        <?= $pengaduan['isi_pengaduan']; ?>
    </p>

    <form method="POST">
        <label>Tanggapan:</label><br><br>
        <textarea name="tanggapan" placeholder="Masukkan / Edit Tanggapan" rows="5" cols="50" required><?= htmlspecialchars($pengaduan['tanggapan'] ?? ''); ?></textarea><br><br>
        <button type="submit" name="submit">Simpan Tanggapan</button>
    </form>
    <button onclick="window.location.href='index.php'">Kembali</button>
</body>
</html>