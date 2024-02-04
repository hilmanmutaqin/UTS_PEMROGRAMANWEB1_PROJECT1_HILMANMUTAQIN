<?php
session_start();

include("../koneksi/koneksi.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    function clean_input($data) {
        global $conn;
        $data = mysqli_real_escape_string($conn, htmlspecialchars(strip_tags(trim($data))));
        return $data;
    }

    $email = clean_input($_POST["inputEmail"]);
    $password = clean_input($_POST["inputPassword"]);

    $query = "SELECT * FROM `tbl_user` WHERE `email` = '$email'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $user_info = mysqli_fetch_assoc($result);
        $dbPassword = $user_info['password'];

        if ($password === $dbPassword) {
            $_SESSION['user_email'] = $email;
            header("Location: ../config/menuutama.php");
            exit();
        } else {
            echo '<script>alert("Email atau password salah.")</script>';
        }
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
