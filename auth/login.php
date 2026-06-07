<?php
session_start();
if (isset($_SESSION['id_user'])) {
    if ($_SESSION['role'] == 'admin') {
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
    <title>Login | Sistem Pengaduan</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="col-md-5 col-lg-4">

            <div class="card card-custom p-4">
                <h3 class="text-center mb-4 fw-bold" style="color: #1E3A8A;">Login Sistem</h3>

                <form action="proses_login.php" method="POST">
                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">Email</label>
                        <input type="email" class="form-control" placeholder="Masukkan Email" id="email" name="email" required>
                    </div>

                    <div class="mb-4">
                        <label for="password" class="form-label fw-semibold">Password</label>
                        <input type="password" class="form-control" placeholder="Masukkan Password" id="password" name="password" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 fw-bold">Login</button>
                </form>

                <div class="text-center mt-3">
                    <p class="mb-0 text-muted">Belum punya akun? <a href="register.php" class="text-decoration-none fw-semibold">Daftar di sini</a></p>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>