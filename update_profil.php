<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    echo "Akses ditolak!";
    exit;
}

$id_pengguna = $_SESSION['id_pengguna'];
$field = $_POST['field'];
$value = trim($_POST['value']);

// Validasi field yang diizinkan
$allowed_fields = ['username', 'alamat'];
if (!in_array($field, $allowed_fields)) {
    echo "Field tidak valid!";
    exit;
}

// Update data di database
$query = "UPDATE pengguna SET $field = ? WHERE id_pengguna = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "si", $value, $id_pengguna);

if (mysqli_stmt_execute($stmt)) {
    echo "Perubahan berhasil disimpan!";
} else {
    echo "Gagal menyimpan perubahan!";
}

mysqli_stmt_close($stmt);
?>
