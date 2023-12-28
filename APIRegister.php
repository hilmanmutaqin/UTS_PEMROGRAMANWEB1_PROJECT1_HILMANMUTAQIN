<?php
include("koneksi/koneksi.php");

// Periksa jika metode permintaan adalah POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mendapatkan data JSON dari tubuh permintaan
    $json_data = file_get_contents("php://input");
    $data = json_decode($json_data, true);

    // Periksa apakah field yang dibutuhkan sudah diset dalam data JSON
    if (isset($data["inputName"]) && isset($data["inputEmail"]) && isset($data["inputPassword"])) {
        $full_name = $data["inputName"];
        $email = $data["inputEmail"];
        $password = $data["inputPassword"];

        // Periksa apakah email sudah terdaftar
        $checkQuery = "SELECT * FROM `tbl_user` WHERE `email` = '$email'";
        $result = mysqli_query($conn, $checkQuery);

        if (mysqli_num_rows($result) > 0) {
            // Email sudah terdaftar
            echo json_encode(array('message' => 'Email sudah terdaftar. Gunakan email lain.'));
        } else {
            // Masukkan data pengguna ke dalam database
            $query = "INSERT INTO `tbl_user`(`full_name`, `email`, `password`) VALUES ('$full_name','$email','$password')";

            if (mysqli_query($conn, $query)) {
                // Registrasi berhasil
                echo json_encode(array('message' => 'Registrasi berhasil.'));
            } else {
                // Registrasi gagal
                echo json_encode(array('error' => 'Pendaftaran gagal: ' . mysqli_error($conn)));
            }
        }
    } else {
        // Field yang dibutuhkan tidak diset
        echo json_encode(array('error' => 'Field formulir tidak diset.'));
    }
} else {
    // Metode permintaan tidak valid
    echo json_encode(array('error' => 'Metode permintaan tidak valid.'));
}

// Tutup koneksi database
mysqli_close($conn);
?>
