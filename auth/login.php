<?php
    session_start();
    if(isset($_SESSION['id_user'])) {

        if($_SESSION['role'] == 'admin') {
            header("Location: ../admin/index.php");
        } else {
            header("Location: ../user/index.php");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Pengaduan</title>
</head>
<body>
    <div class="container">
        <h1>Login Pengaduan</h1>
        <form action="proses_login.php" method="POST">
            <label for="email">Email</label>
            <input type="email" placeholder="Masukkan Email" id="email" name="email" required><br><br>

            <label for="password">Password:</label>
            <input type="password" placeholder="Masukkan Password" id="password" name="password" required><br><br>
            
            <button type="submit">Login</button>
        </form>

        <div>
            <p>Belum punya akun? <a href="register.php">Daftar di sini</a></p>
        </div>
    </div>
</body>
</html>