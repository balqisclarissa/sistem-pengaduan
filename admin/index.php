<?php
session_start();
include '../config/koneksi.php';

// Menarik seluruh data pengaduan
$pengaduan = mysqli_query($conn, "SELECT * FROM pengaduan ORDER BY id_pengaduan DESC");
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin | Sistem Pengaduan</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body class="bg-light">

    <div class="container mt-5">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold mb-0" style="color: #1E3A8A;">Panel Admin</h3>
                <small class="text-muted">Manajemen Seluruh Data Pengaduan</small>
            </div>
            <a href="../auth/logout.php" class="btn btn-danger btn-sm" onclick="return confirm('Sesi Admin akan diakhiri. Lanjutkan?')">Logout</a>
        </div>

        <div class="card card-custom border-0 shadow-sm">
            <div class="card-body p-0">

                <div class="table-responsive">
                    <table class="table table-hover table-striped align-middle mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th class="py-3 px-4">Nama Pelapor</th>
                                <th class="py-3 px-4">Isi Pengaduan</th>
                                <th class="py-3 px-4">Status</th>
                                <th class="py-3 px-4">Tanggapan</th>
                                <th class="py-3 px-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Mengecek apakah ada data
                            if (mysqli_num_rows($pengaduan) > 0) {
                                while ($data = mysqli_fetch_assoc($pengaduan)) {

                                    // Mengambil nama user berdasarkan id_user
                                    $id_user = $data['id_user'];
                                    $user = mysqli_query($conn, "SELECT * FROM user WHERE id_user='$id_user'");
                                    $data_user = mysqli_fetch_assoc($user);
                            ?>

                                    <tr>
                                        <td class="px-4 fw-medium"><?= htmlspecialchars($data_user['nama_lengkap']); ?></td>
                                        <td class="px-4"><?= htmlspecialchars($data['isi_pengaduan']); ?></td>

                                        <td class="px-4">
                                            <form action="ubah_status.php" method="POST" class="m-0">
                                                <input type="hidden" name="id_pengaduan" value="<?= $data['id_pengaduan']; ?>">
                                                <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                                                    <option value="Menunggu" <?= ($data['status'] == 'Menunggu') ? 'selected' : ''; ?>>Menunggu</option>
                                                    <option value="Diproses" <?= ($data['status'] == 'Diproses') ? 'selected' : ''; ?>>Diproses</option>
                                                    <option value="Selesai" <?= ($data['status'] == 'Selesai') ? 'selected' : ''; ?>>Selesai</option>
                                                </select>
                                            </form>
                                        </td>

                                        <td class="px-4">
                                            <?= $data['tanggapan'] ? htmlspecialchars($data['tanggapan']) : '<em class="text-muted">Belum ada</em>'; ?>
                                        </td>

                                        <td class="px-4 text-center">
                                            <a href="tanggapan.php?id=<?= $data['id_pengaduan']; ?>" class="btn btn-primary btn-sm me-1">Tanggapi</a>
                                            <a href="hapus_pengaduan.php?id=<?= $data['id_pengaduan']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus pengaduan ini?')">Hapus</a>
                                        </td>
                                    </tr>

                            <?php
                                }
                            } else {
                                echo "<tr><td colspan='5' class='text-center py-4 text-muted'>Belum ada pengaduan yang masuk ke sistem.</td></tr>";
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