<?php
include("koneksi/koneksi.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["inputEmail"]) && isset($_POST["inputPassword"])) {
        $email = trim($_POST["inputEmail"]);
        $password = trim($_POST["inputPassword"]);

        $query_sql = "SELECT * FROM tbl_user WHERE email = '$email' AND password = '$password'";
        $result = mysqli_query($conn, $query_sql);

        if (mysqli_num_rows($result) > 0) {
            
            $user_data = mysqli_fetch_assoc($result);

            // Mulai sesi
            session_start();

            // Simpan data user dalam sesi
            $_SESSION['user_email'] = $user_data['email'];
            $_SESSION['user_full_name'] = $user_data['full_name'];

            // Redirect ke menuutama.php
            header("Location: menuutama.php");
            exit(); 
        } else {
            echo '<script>alert("Email atau password salah");</script>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SMA AL-AMANAH CIWIDEY</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/loginn.css">

    <style>



    </style>
</head>

<body>
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="images/Logo_alamanah.png" alt="Logo" width="50" height="50" class="d-inline-block align-text-center">
                SMA AL-AMANAH CIWIDEY
            </a>
        </div>
    </nav>
    <!-- End NAVBAR -->

    <!-- Formulir Login -->
    <div class="container mt-5">
        <form class="form-signin" action="login.php" method="post">
            <h2 class="mb-4 text-center">Login</h2>
            <div class="form-group">
                <label for="inputEmail" class="visually-hidden">Alamat Email</label>
                <input type="email" id="inputEmail" name="inputEmail" class="form-control" placeholder="Alamat Email" required autofocus>
            </div>
            <div class="form-group">
                <label for="inputPassword" class="visually-hidden">Password</label>
                <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Password" required>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <button id="loginButton" class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
                </div>
                <div class="col-md-6 mb-3">
                    <a href="register.php" class="btn btn-lg btn-secondary btn-block">Register</a>
                </div>
            </div>
        </form>
    </div>
    <!-- End Formulir Login -->


    <!-- FOOTER -->
    <footer class="footer">
        <!-- Konten Footer -->
        <div class="container">
            <p>&copy; HILMAN MUTAQIN || Mahasiswa teknik informatika</p>
            <p>Pemrograman Web 1</p>
            <a href="https://sttbandung.ac.id/">SEKOLAH TINGGI TEKNOLOGI BANDUNG</a>
        </div>
    </footer>
    <!-- END FOOTER -->

</body>

</html>