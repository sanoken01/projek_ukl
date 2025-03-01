<?php
session_start();
session_unset(); // Hapus semua variabel session
session_destroy(); // Hancurkan session

// Redirect ke halaman utama
header("Location: projek_ukl.php");
exit;
?>
