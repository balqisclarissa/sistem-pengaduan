<?php
    session_start();
    include '../config/koneksi.php';

    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = mysqli_query($conn, "SELECT * FROM user WHERE email='$email'");

    if(mysqli_num_rows($query) > 0) {
        $user = mysqli_fetch_assoc($query);

        if(password_verify($password, $user['password'])) {
            $_SESSION['login'] = true;
            $_SESSION['id_user'] = $user['id_user'];
            $_SESSION['nama_lengkap'] = $user['nama_lengkap'];
            $_SESSION['role'] = $user['role'];

            if($user['role'] == 'admin') {
                header("Location: ../admin/index.php");
                exit;
            } else {
                header("Location: ../user/index.php");
                exit;
            }
        } else {
            echo "<script>alert('Password salah');history.back();</script>";
        }
    } else {
        echo "<script>alert('Email tidak ditemukan');history.back();</script>";
    }
?>