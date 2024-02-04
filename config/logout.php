<?php
session_start();

// Hapus semua data sesi
session_unset();

// bersihkan sesi
session_destroy();

//kembali ke login
header("Location: http://localhost/uts_project1_web1_hilmanmutaqin/index.html");
exit();
?>
