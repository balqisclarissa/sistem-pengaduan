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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pengaduan | Sistem Pengaduan</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body class="bg-light">

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="fw-bold" style="color: #1E3A8A;">Edit Pengaduan</h3>
                </div>

                <div class="card card-custom border-0 shadow-sm">
                    <div class="card-body p-4">
                        <form method="POST">

                            <div class="mb-4">
                                <label for="isi_pengaduan" class="form-label fw-bold">Isi Pengaduan (Instansi & Detail)</label>
                                <textarea class="form-control" id="isi_pengaduan" name="isi_pengaduan" rows="6" required><?= htmlspecialchars($data['isi_pengaduan']); ?></textarea>
                                <small class="text-muted">Anda dapat mengubah nama instansi maupun detail laporan secara langsung pada kotak di atas.</small>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" name="submit" class="btn btn-warning fw-bold px-4">Simpan Perubahan</button>
                                <a href="data_pengaduan.php" class="btn btn-secondary px-4">Batal / Kembali</a>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

</body>

</html>