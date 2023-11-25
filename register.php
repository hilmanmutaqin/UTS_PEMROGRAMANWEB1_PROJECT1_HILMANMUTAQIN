<?php
include("koneksi/koneksi.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["inputName"]) && isset($_POST["inputEmail"]) && isset($_POST["inputPassword"])) {
        $full_name = $_POST["inputName"];
        $email = $_POST["inputEmail"];
        $password = $_POST["inputPassword"];

        // cek email
        $checkQuery = "SELECT * FROM `tbl_user` WHERE `email` = '$email'";
        $result = mysqli_query($conn, $checkQuery);

        if (mysqli_num_rows($result) > 0) {
            echo '<script>alert("Email sudah terdaftar. Gunakan email lain.")</script>';
        } else {

            // Query SQL untuk menyimpan data ke database
            $query = "INSERT INTO `tbl_user`(`full_name`, `email`, `password`) VALUES ('$full_name','$email','$password')";

            if (mysqli_query($conn, $query)) {
                echo '<script>alert("Registrasi berhasil. Redirecting to login page.")</script>';
                header("Location: register.php");
                exit();
            } else {
                echo "Pendaftaran gagal: " . mysqli_error($conn);
            }
        }
    } else {
        echo "Form fields are not set.";
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - SMA AL-AMANAH CIWIDEY</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    
    <link rel="stylesheet" href="css/register.css">



    <!-- JS btn regist -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('registerButton').addEventListener('click', function(event) {
                var password = document.getElementById('inputPassword').value;

                //validasi password harus lebih dari 8 dan menggunakan angka
                if (password.length < 8 || !/\d/.test(password)) {
                    alert('Password must be at least 8 characters long and contain at least one numeric digit.');
                    event.preventDefault();
                }
            });
        });
    </script>

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

    <!-- Register Form -->
    <div class="container mt-5">
        <form class="form-signup" action="register.php" method="post">
            <h2 class="mb-3">Register</h2>
            <label for="inputName" class="visually-hidden">Full Name</label>
            <input type="text" id="inputName" name="inputName" class="form-control" placeholder="Full Name" required autofocus>
            <label for="inputEmail" class="visually-hidden">Email address</label>
            <input type="email" id="inputEmail" name="inputEmail" class="form-control" placeholder="Email address" required>
            <label for="inputPassword" class="visually-hidden">Password</label>
            <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Password" required>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <button id="registerButton" class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
                </div>
                <div class="col-md-6 mb-3">
                    <a href="index.php" class="btn btn-lg btn-secondary btn-block">Kembali</a>
                </div>
            </div>
    </div>

    <!-- End Register Form -->

    <!-- FOOTER -->
    <footer class="footer">
        <div class="container">
            <p>&copy; HILMAN MUTAQIN || Mahasiswa teknik informatika</p>
            <p>Pemrograman Web 1</p>
            <a href="https://sttbandung.ac.id/">SEKOLAH TINGGI TEKNOLOGI BANDUNG</a>
        </div>
    </footer>
    <!-- END FOOTER -->




</body>

</html>