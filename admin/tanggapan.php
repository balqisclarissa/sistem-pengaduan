<?php
session_start();
include '../config/koneksi.php';

$id = $_GET['id'];

$data = mysqli_query(
    $conn,
    "SELECT * FROM pengaduan WHERE id_pengaduan='$id'"
);

$pengaduan = mysqli_fetch_assoc($data);

if (isset($_POST['submit'])) {
    $tanggapan = $_POST['tanggapan'];

    $update = mysqli_query(
        $conn,
        "UPDATE pengaduan SET tanggapan='$tanggapan' WHERE id_pengaduan='$id'"
    );

    if ($update) {
        echo "<script>
        alert('Tanggapan berhasil ditambahkan');
        window.location.href='index.php';
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tanggapan Pengaduan | Sistem Pengaduan</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body class="bg-light">

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="fw-bold" style="color: #1E3A8A;">Berikan Tanggapan</h3>
                </div>

                <div class="card card-custom border-0 shadow-sm">
                    <div class="card-body p-4">

                        <div class="alert alert-secondary mb-4">
                            <h6 class="fw-bold mb-1">Laporan Pelapor:</h6>
                            <p class="mb-0 text-dark"><?= htmlspecialchars($pengaduan['isi_pengaduan']); ?></p>
                        </div>

                        <form method="POST">
                            <div class="mb-4">
                                <label for="tanggapan" class="form-label fw-bold">Tanggapan Admin:</label>
                                <textarea class="form-control" id="tanggapan" name="tanggapan" placeholder="Masukkan / Edit tanggapan di sini..." rows="5" required><?= htmlspecialchars($pengaduan['tanggapan'] ?? ''); ?></textarea>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" name="submit" class="btn btn-primary fw-bold px-4">Simpan Tanggapan</button>
                                <a href="index.php" class="btn btn-secondary px-4">Batal / Kembali</a>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>

</body>

</html>