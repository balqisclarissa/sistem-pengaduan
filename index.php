<?php
    session_start();

    if (isset($_SESSION['login'])) {
        $user = $_SESSION['user'];
        if ($user['role'] == 'admin') {
            header("Location: ../admin/index.php");
            exit;
        } else {
            header("Location: ../user/index.php");
            exit;
        }
    } else {
        header("Location: auth/login.php");
        exit;
    }
?>
