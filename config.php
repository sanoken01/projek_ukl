<?php
$host = 'localhost'; // atau sesuai dengan konfigurasi server kamu
$username = 'root'; // username database
$password = ''; // password database
$dbname = 'projek_ukl'; // nama database

$conn = mysqli_connect($host, $username, $password, $dbname);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>