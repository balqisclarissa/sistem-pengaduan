<?php
    session_start();
    include '../config/koneksi.php';

    $id_user = $_SESSION['id_user'];

    $user = mysqli_query($conn, "SELECT * FROM pengaduan WHERE id_user='$id_user' ORDER BY id_pengaduan DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pengaduan</title>
</head>
<body>
    <h2>Data Pengaduan</h2>

    <table border="1" cellpadding="10">
        <tr>
            <th>No</th>
            <th>Isi Pengaduan</th>
            <th>Tanggal Pengaduan</th>
            <th>Status</th>
        </tr>
        <?php
            $no = 1;
            while ($data = mysqli_fetch_array($user)) {
                echo "<tr>";
                echo "<td>".$no++."</td>";
                echo "<td>".$data['isi_pengaduan']."</td>";
                echo "<td>".$data['tgl_pengaduan']."</td>";
                echo "<td>".$data['status']."</td>";
                echo "</tr>";
            }
        ?>
    </table>
</body>
</html>