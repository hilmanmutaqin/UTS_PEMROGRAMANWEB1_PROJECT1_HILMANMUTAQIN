<?php

$database_hostname = "localhost";
$database_username = "root";
$database_password = "";
$database_name = "db_uts_21552011107_web1";
$database_port = 3306;

$conn = mysqli_connect($database_hostname, $database_username, $database_password, $database_name, $database_port);

if (!$conn) {
    die("Koneksi Gagal: " . mysqli_connect_error());
} else {
    // echo "koneksi berhasil"; 
}
?>
