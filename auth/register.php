<?php
include '../config/koneksi.php';

if (isset($_POST['register'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $telp = $_POST['telp'];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $check_query = "SELECT * FROM user WHERE email='$email'";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        echo "<script>alert('Email sudah terdaftar. Silakan gunakan email lain.'); window.location.href='register.php';</script>";
    } else {

        $insert_query = "INSERT INTO user (email,password, nama_lengkap, telp) VALUES ('$email', '$hashed_password', '$nama_lengkap', '$telp')";
        if (mysqli_query($conn, $insert_query)) {
            echo "<script>alert('Registrasi berhasil! Silakan login.'); window.location.href='login.php';</script>";
        } else {
            echo "<script>alert('Terjadi kesalahan saat registrasi. Silakan coba lagi.'); window.location.href='register.php';</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Sistem Pengaduan</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100 py-5">
        <div class="col-md-6 col-lg-5">

            <div class="card card-custom p-4">
                <h3 class="text-center mb-4 fw-bold" style="color: #1E3A8A;">Registrasi Akun</h3>

                <form action="register.php" method="POST">
                    <div class="mb-3">
                        <label for="nama_lengkap" class="form-label fw-semibold">Nama Lengkap</label>
                        <input type="text" class="form-control" placeholder="Masukkan Nama Lengkap" id="nama_lengkap" name="nama_lengkap" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">Email</label>
                        <input type="email" class="form-control" placeholder="Masukkan Email" id="email" name="email" required>
                    </div>

                    <div class="mb-3">
                        <label for="telp" class="form-label fw-semibold">No. Telepon</label>
                        <input type="text" class="form-control" placeholder="Masukkan No. Telepon" id="telp" name="telp" required>
                    </div>

                    <div class="mb-4">
                        <label for="password" class="form-label fw-semibold">Password</label>
                        <input type="password" class="form-control" placeholder="Masukkan Password (Min. 8 Karakter)" id="password" name="password" minlength="8" required>
                    </div>

                    <button type="submit" name="register" class="btn btn-primary w-100 fw-bold mb-3">Register</button>
                </form>

                <div class="text-center">
                    <p class="mb-0 text-muted">Sudah punya akun? <a href="login.php" class="text-decoration-none fw-semibold">Login di sini</a></p>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>