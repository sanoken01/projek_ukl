<?php
session_start();
session_unset(); // Hapus semua variabel session
session_destroy(); // Hancurkan session

// Redirect ke halaman utama
header("Location:Halaman web/projek_ukl");
exit;
?>
