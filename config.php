<?php
$host = "localhost"; // Host database
$user = "root"; // Username database
$pass = ""; // Password database (kosong jika tidak ada)
$db   = "projek_ukl"; // Nama database

// Membuat koneksi
$conn = new mysqli($host, $user, $pass, $db);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
