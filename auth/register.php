<?php
    include '../config/koneksi.php';

    if(isset($_POST['register'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $nama_lengkap = $_POST['nama_lengkap'];
        $telp = $_POST['telp'];

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $check_query = "SELECT * FROM user WHERE email='$email'";
        $check_result = mysqli_query($conn, $check_query);

        if(mysqli_num_rows($check_result) > 0) {
            echo "<script>alert('Email sudah terdaftar. Silakan gunakan email lain.'); window.location.href='register.php';</script>";
        } else {

            $insert_query = "INSERT INTO user (email,password, nama_lengkap, telp) VALUES ('$email', '$hashed_password', '$nama_lengkap', '$telp')";
            if(mysqli_query($conn, $insert_query)) {
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
    <meta name="viewport" content="width=
    , initial-scale=1.0">
    <title>Register Pengaduan</title>
</head>
<body>
    <div class="container">
        <h1>Register Pengaduan</h1>
        <form action="register.php" method="POST">

            <label for="email">Email:</label>
            <input type="email" placeholder="Masukkan Email" id="email" name="email" required><br><br>

            <label for="password">Password:</label>
            <input type="password" placeholder="Masukkan Password" id="password" name="password" minlegth="8" required><br><br>

            <label for="nama_lengkap">Nama Lengkap:</label>
            <input type="text" placeholder="Masukkan Nama Lengkap" id="nama_lengkap" name="nama_lengkap" required><br><br>

            <label for="telp">No. Telepon:</label>
            <input type="text" placeholder="Masukkan No. Telepon" id="telp" name="telp" required><br><br>

            <button type="submit" name="register">Register</button>
        </form>

        <div>
            <p>Sudah punya akun? <a href="login.php">Login di sini</a></p>
        </div>
    </div>
</body>
</html>