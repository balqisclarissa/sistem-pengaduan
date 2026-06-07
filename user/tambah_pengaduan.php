<?php
session_start();
include '../config/koneksi.php';

// Validasi Sesi
if (!isset($_SESSION['login'])) {
    header("Location: ../auth/login.php");
    exit;
}

if (isset($_POST['submit'])) {
    $id_user = $_SESSION['id_user'];

    // Taktik Penggabungan Data: Mengambil value API dan teks manual
    $instansi = $_POST['instansi'];
    $laporan = $_POST['isi_pengaduan'];

    // Menggabungkan keduanya ke dalam satu variabel agar masuk ke struktur database rekan Anda
    $isi_pengaduan = "Instansi: [" . $instansi . "] - Detail: " . $laporan;

    $query = mysqli_query($conn, "INSERT INTO pengaduan (id_user, isi_pengaduan) VALUES ('$id_user', '$isi_pengaduan')");

    if ($query) {
        echo "<script> 
            alert('Pengaduan berhasil ditambahkan');
            window.location.href = 'data_pengaduan.php';
            </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pengaduan</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3>Buat Pengaduan Baru</h3>
                    <a href="index.php" class="btn btn-secondary btn-sm">Kembali ke Dashboard</a>
                </div>

                <div class="card card-custom">
                    <div class="card-body p-4">
                        <form method="POST">

                            <div class="mb-3">
                                <label for="instansi" class="form-label fw-bold">Pilih Instansi Pendidikan</label>
                                <select class="form-select" id="instansi" name="instansi" required>
                                    <option value="">Memuat data API...</option>
                                </select>
                                <small class="text-muted">Data instansi ditarik secara dinamis dari server API.</small>
                            </div>

                            <div class="mb-4">
                                <label for="isi_pengaduan" class="form-label fw-bold">Detail Pengaduan</label>
                                <textarea class="form-control" id="isi_pengaduan" name="isi_pengaduan" rows="5" placeholder="Tuliskan keluhan atau laporan Anda secara detail..." required></textarea>
                            </div>

                            <button type="submit" name="submit" class="btn btn-primary w-100">Kirim Laporan</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        // Melakukan request ke endpoint API
        fetch('https://raw.githubusercontent.com/farizdotid/DAFTAR-API-LOKAL-INDONESIA/master/data/education/id.json')
            .then(response => response.json())
            .then(data => {
                let dropdown = document.getElementById('instansi');
                dropdown.innerHTML = '<option value="">-- Pilih Instansi yang Tersedia --</option>';

                // Looping data JSON untuk dimasukkan ke elemen option
                data.apis.forEach(item => {
                    let option = document.createElement('option');
                    option.value = item.apiName;
                    option.text = item.apiName;
                    dropdown.appendChild(option);
                });
            })
            .catch(error => {
                console.log('Error API:', error);
                document.getElementById('instansi').innerHTML = '<option value="Instansi Tidak Terdaftar">Gagal memuat API - Lanjut isi manual</option>';
            });
    </script>
</body>

</html>