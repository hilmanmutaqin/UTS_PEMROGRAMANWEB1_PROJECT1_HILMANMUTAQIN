<?php
include("../koneksi/koneksi.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Fungsi untuk membersihkan dan melindungi dari SQL injection
    function clean_input($data) {
        global $conn;
        $data = mysqli_real_escape_string($conn, htmlspecialchars(strip_tags(trim($data))));
        return $data;
    }

    // Mengambil data dari formulir dan membersihkannya
    $nis = isset($_POST["inputNis"]) ? clean_input($_POST["inputNis"]) : '';
    $nama = isset($_POST["inputNama"]) ? clean_input($_POST["inputNama"]) : '';
    $email = isset($_POST["inputEmail"]) ? clean_input($_POST["inputEmail"]) : '';
    $password = isset($_POST["inputPassword"]) ? clean_input($_POST["inputPassword"]) : '';

    // Validasi data
    if (empty($nis) || empty($nama) || empty($email) || empty($password)) {
        echo '<script>alert("Semua kolom harus diisi.")</script>';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo '<script>alert("Format email tidak valid.")</script>';
    } else {
        // Cek apakah email sudah terdaftar
        $checkQuery = "SELECT * FROM `tbl_user` WHERE `email` = '$email'";
        $result = mysqli_query($conn, $checkQuery);

        if (mysqli_num_rows($result) > 0) {
            echo '<script>alert("Email sudah terdaftar. Gunakan email lain.")</script>';
        } else {
            // Query SQL untuk menyimpan data ke database tanpa hashing password
            $query = "INSERT INTO `tbl_user` (`nis`, `nama`, `email`, `password`) VALUES ('$nis', '$nama', '$email', '$password')";

            if (mysqli_query($conn, $query)) {
                echo '<script>alert("Registrasi berhasil. Redirecting to login page.")</script>';
                header("Location: ../login.html");
                exit();
            } else {
                echo "Pendaftaran gagal: " . mysqli_error($conn);
            }
        }
    }
} else {
    echo "Metode request tidak valid.";
}
?>
