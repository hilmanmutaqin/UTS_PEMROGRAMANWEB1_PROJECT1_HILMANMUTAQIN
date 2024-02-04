<?php
session_start();

if (!isset($_SESSION['user_email'])) {
    header("Location: ../index.html"); 
    exit();
}

include("../koneksi/koneksi.php");

$email = $_SESSION['user_email'];

$query = "SELECT * FROM `tbl_user` WHERE `email` = '$email'";
$result = mysqli_query($conn, $query);

if ($result) {
    $user_info = mysqli_fetch_assoc($result);
    $nis = $user_info['nis'];
    $nama = $user_info['nama'];
    $email = $user_info['email'];
} else {
    $nis = $nama = $email = "Error";
}

mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Utama - SMA AL-AMANAH CIWIDEY</title>
    <link rel="stylesheet" href="../css/menuutama.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<style>
    .offcanvas.show .navbar-nav a.nav-link {
        color: black !important;
    }

    .offcanvas.show .navbar-nav {
        margin-left: 0;
    }
</style>

<body>
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-md navbar-dark bg-primary">
        <div class="container-fluid mx-auto">
            <a class="navbar-brand" href="#">
                <img src="../images/Logo_alamanah.png" alt="Logo" width="50" height="50" class="d-inline-block align-text-center">
                SMA AL-AMANAH CIWIDEY
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#navbarNav" aria-controls="navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Offcanvas -->
            <div class="offcanvas offcanvas-end" tabindex="-1" id="navbarNav" aria-labelledby="navbarNavLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="navbarNavLabel">Menu</h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body" style="color: black;">
                    <div class="navbar-nav ms-auto">
                        <a class="nav-link active text-end" aria-current="page" href="#">Dashboard</a>
                        <a class="nav-link text-end" href="logout.php">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <!-- End NAVBAR -->

    <!-- Konten Utama -->
    <div class="container mt-5">
        <h2>Selamat datang, <?php echo $nama; ?>!</h2>
        <p>Ini adalah halaman menu utama. Berikut adalah informasi Anda:</p>
        <ul>
            <li><strong>NIS:</strong> <?php echo $nis; ?></li>
            <li><strong>Nama Lengkap:</strong> <?php echo $nama; ?></li>
            <li><strong>Email:</strong> <?php echo $email; ?></li>
        </ul>
    </div>
    <!-- End Konten Utama -->

    <!-- FOOTER -->
    <footer class="footer mt-5 text-center-footer bg-primary text-white">
        <!-- Konten footer -->
        <div class="container">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <p>&copy; HILMAN MUTAQIN || Mahasiswa teknik informatika</p>
                    <p>Pemrograman Web 1</p>
                    <a href="https://sttbandung.ac.id/">SEKOLAH TINGGI TEKNOLOGI BANDUNG</a>
                </div>
            </div>
        </div>
    </footer>
    <!-- END FOOTER -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-eF2Gq1uJZ2qg24t5uXAY4MoazpTYAQv0Lt6Q4r0BjO4eIn1eZ5htpa47EqIbbV4" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

</body>

</html>
