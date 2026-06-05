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

    $query = mysqli_query($conn, "
        SELECT p.*, u.nama_lengkap
        FROM pengaduan p
        JOIN user u ON p.id_user = u.id_user
        ORDER BY p.tanggal DESC
    ");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>

    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

    <h2>Dashboard Admin</h2>

    <p>
        Selamat Datang,
        <b><?php echo $_SESSION['nama_lengkap']; ?></b>
    </p>

    <a href="../auth/logout.php">Logout</a>

    <br><br>

    <table border="1" cellpadding="10">

        <tr>
            <th>ID</th>
            <th>Nama Pelapor</th>
            <th>Isi Pengaduan</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>

        <?php while($data = mysqli_fetch_assoc($query)) { ?>

        <tr>

            <td><?php echo $data['id_pengaduan']; ?></td>

            <td><?php echo $data['nama_lengkap']; ?></td>

            <td><?php echo $data['isi_pengaduan']; ?></td>

            <td><?php echo $data['status']; ?></td>

            <td>

                <a href="ubah_status.php?id=<?php echo $data['id_pengaduan']; ?>">
                    Ubah Status
                </a>

                |

                <a href="hapus_pengaduan.php?id=<?php echo $data['id_pengaduan']; ?>"
                onclick="return confirm('Yakin ingin menghapus pengaduan ini?')">
                    Hapus
                </a>

            </td>

        </tr>

        <?php } ?>

    </table>

</body>
</html>