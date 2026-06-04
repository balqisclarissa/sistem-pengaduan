<?php
    $host = "localhost";
    $username = "balqis";
    $password = "BalqisCallie_1644";
    $database = "db_pengaduan";
    $port = 3307;
    $conn = mysqli_connect($host, $username, $password, $database, $port);

    if (!$conn) {
        die("Koneksi gagal: " . mysqli_connect_error());
    }
?>