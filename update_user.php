<?php
session_start();
include 'config.php';

// Pastikan hanya admin yang bisa mengakses
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    echo "Akses ditolak!";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $field = $_POST['field'];
    $value = trim($_POST['value']);

    // Validasi field
    if ($field === "username" || $field === "alamat") {
        $query = "UPDATE pengguna SET $field = ? WHERE id_pengguna = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "si", $value, $id);

        if (mysqli_stmt_execute($stmt)) {
            echo "Perubahan berhasil disimpan!";
        } else {
            echo "Gagal menyimpan perubahan.";
        }
        mysqli_stmt_close($stmt);
    }
}
?>
