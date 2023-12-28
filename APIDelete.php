<?php
include("koneksi/koneksi.php");

// Periksa jika metode permintaan adalah DELETE
if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
    // Mendapatkan data JSON dari tubuh permintaan
    $json_data = file_get_contents("php://input");
    $data = json_decode($json_data, true);

    // Periksa apakah field yang dibutuhkan sudah diset dalam data JSON
    if (isset($data["full_name"])) {
        $full_name = $data["full_name"];

        // Periksa apakah pengguna dengan full_name tertentu ada dalam database
        $checkQuery = "SELECT * FROM `tbl_user` WHERE `full_name` = '$full_name'";
        $result = mysqli_query($conn, $checkQuery);

        if (mysqli_num_rows($result) > 0) {
            // Hapus pengguna dengan full_name tertentu
            $deleteQuery = "DELETE FROM `tbl_user` WHERE `full_name` = '$full_name'";
            if (mysqli_query($conn, $deleteQuery)) {
                // Hapus berhasil
                echo json_encode(array('message' => 'Hapus pengguna berhasil.'));
            } else {
                // Hapus gagal
                echo json_encode(array('error' => 'Hapus pengguna gagal: ' . mysqli_error($conn)));
            }
        } else {
            // Pengguna dengan full_name tertentu tidak ditemukan
            echo json_encode(array('error' => 'Pengguna tidak ditemukan.'));
        }
    } else {
        // Field yang dibutuhkan tidak diset
        echo json_encode(array('error' => 'Field yang dibutuhkan tidak diset.'));
    }
} else {
    // Metode permintaan tidak valid
    echo json_encode(array('error' => 'Metode permintaan tidak valid.'));
}

// Tutup koneksi database
mysqli_close($conn);
?>
