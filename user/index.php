<?php
    session_start();

    if(!isset($_SESSION['login'])) {
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
</head>
<body>
    <p>Selamat datang, <?php echo $_SESSION['nama_lengkap']; ?>!</p> 
    
    <ul>
        <li><a href="tambah_pengaduan.php">Tambah Pengaduan</a></li>
        <li><a href="data_pengaduan.php">Data Pengaduan</a></li>
        <li><a href="../auth/logout.php" onclick="return confirm('Anda akan keluar dari sistem. Lanjutnkan?')">Logout</a></li>
    </ul>
</body>
</html>