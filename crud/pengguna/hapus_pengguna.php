<?php
session_start();
require '../../config.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../../login.php");
    exit;
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $stmt = $conn->prepare("DELETE FROM pengguna WHERE id_pengguna = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: ../data_pengguna.php?hapus=sukses");
        exit;
    } else {
        header("Location: ../data_pengguna.php?hapus=gagal");
        exit;
    }
} else {
    header("Location: ../data_pengguna.php");
    exit;
}