<?php
session_start();
include '../config/koneksi.php';

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
    <title>Data Pengaduan | Sistem Pengaduan</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body class="bg-light">

    <div class="container mt-5">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold" style="color: #1E3A8A;">Riwayat Pengaduan Saya</h3>
            <a href="index.php" class="btn btn-secondary btn-sm">Kembali ke Dashboard</a>
        </div>

        <div class="card card-custom border-0 shadow-sm">
            <div class="card-body p-0">

                <div class="table-responsive">
                    <table class="table table-hover table-striped align-middle mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th class="py-3 px-4">Tanggal</th>
                                <th class="py-3 px-4">Isi Pengaduan</th>
                                <th class="py-3 px-4">Status</th>
                                <th class="py-3 px-4">Tanggapan</th>
                                <th class="py-3 px-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (mysqli_num_rows($pengaduan) > 0) {
                                while ($data = mysqli_fetch_assoc($pengaduan)) {
                                    echo "<tr>";
                                    // Data Kolom
                                    echo "<td class='px-4'>" . $data['tanggal'] . "</td>";
                                    echo "<td class='px-4'>" . $data['isi_pengaduan'] . "</td>";
                                    echo "<td class='px-4'><span class='badge bg-info text-dark'>" . $data['status'] . "</span></td>";
                                    echo "<td class='px-4'>" . ($data['tanggapan'] ? $data['tanggapan'] : '<em>Belum ditanggapi</em>') . "</td>";

                                    // Kolom Aksi (Tombol Edit & Hapus digabung)
                                    echo "<td class='px-4 text-center'>
                                            <a href='edit.php?id=" . $data['id_pengaduan'] . "' class='btn btn-warning btn-sm me-1'>Edit</a>
                                            <a href='hapus_pengaduan.php?id=" . $data['id_pengaduan'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Anda yakin ingin menghapus pengaduan ini?\")'>Hapus</a>
                                          </td>";
                                    echo "</tr>";
                                }
                            } else {
                                // Colspan diperbaiki menjadi 5 sesuai jumlah header
                                echo "<tr>";
                                echo "<td colspan='5' class='text-center py-4 text-muted'>Belum ada riwayat pengaduan yang diajukan.</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>

</body>

</html>