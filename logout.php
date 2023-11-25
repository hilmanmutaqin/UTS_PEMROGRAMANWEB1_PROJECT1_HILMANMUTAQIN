<?php
session_start();

// Hapus semua data sesi
session_unset();

// bersihkan sesi
session_destroy();

//kembali ke login
header("Location: login.php");
exit();
?>
