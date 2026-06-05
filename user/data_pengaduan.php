<?php
session_start();
include '../config/koneksi.php';

// Cek apakah user sudah login
if (!isset($_SESSION['id_user'])) {
    header("Location: ../auth/login.php");
    exit;
}

$id_user = $_SESSION['id_user'];

$pengaduan = mysqli_query(
    $conn,
    "SELECT * FROM pengaduan
     WHERE id_user='$id_user'
     ORDER BY id_pengaduan DESC"
);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pengaduan</title>
</head>
<body>

    <h2>Data Pengaduan Saya</h2>

    <table border="1" cellpadding="10">
        <tr>
            <th>Isi Pengaduan</th>
            <th>Edit Pengaduan</th>
            <th>Tanggal Pengaduan</th>
            <th>Status</th>
            <th>Tanggapan</th>
        </tr>

        <?php
        if (mysqli_num_rows($pengaduan) > 0) {

            while ($data = mysqli_fetch_assoc($pengaduan)) {
                echo "<tr>";
                echo "<td>".$data['isi_pengaduan']."</td>";
                echo "<td>
                        <a href='edit.php?id=".$data['id_pengaduan']."'>
                            <button>Edit</button>   
                        </a>
                      </td>";
                echo "<td>".$data['tanggal']."</td>";
                echo "<td>".$data['status']."</td>";
                echo "<td>".$data['tanggapan']."</td>";
                echo "</tr>";
            }

        } else {

            echo "<tr>";
            echo "<td colspan='4'>Belum ada pengaduan.</td>";
            echo "</tr>";

        }
        ?>
    </table>

    <br>

    <button onclick="window.location.href='index.php'">
        Kembali
    </button>

</body>
</html>