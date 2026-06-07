<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: ../auth/login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard User</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <div class="container mt-5">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Dashboard Pelapor</h2>
            <a href="../auth/logout.php" class="btn btn-danger" onclick="return confirm('Yakin ingin logout?')">Logout</a>
        </div>

        <div class="alert alert-primary">
            Selamat datang, <strong><?php echo htmlspecialchars($_SESSION['nama_lengkap']); ?></strong>!
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="card card-custom">
                    <div class="card-body">
                        <h4>Tambah Pengaduan</h4>
                        <p>Buat laporan atau pengaduan baru di sini.</p>
                        <a href="tambah_pengaduan.php" class="btn btn-primary">Buat Pengaduan</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <div class="card card-custom">
                    <div class="card-body">
                        <h4>Data Pengaduan</h4>
                        <p>Lihat status dan riwayat pengaduan Anda.</p>
                        <a href="data_pengaduan.php" class="btn btn-outline-primary">Lihat Data</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>

</html>