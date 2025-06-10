<?php
session_start();
$conn = new mysqli("localhost", "root", "", "projek_ukl");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$id = $_SESSION['user_id'];
$role = $_SESSION['role'];

// Ambil data pengguna
$user = $conn->query("SELECT * FROM pengguna WHERE id_pengguna = $id")->fetch_assoc();

// Ambil data konsultan jika role konsultan
$konsultan = null;
if ($role === 'konsultan') {
    $konsultan = $conn->query("SELECT * FROM konsultan WHERE id_pengguna = $id")->fetch_assoc();
}

// Proses update
$update_success = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_username = $conn->real_escape_string($_POST['username']);
    $new_password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : null;

    $conn->query("UPDATE pengguna SET username = '$new_username' " . 
        ($new_password ? ", password = '$new_password'" : "") . 
        " WHERE id_pengguna = $id");

    if ($role === 'konsultan' && isset($_POST['keahlian'])) {
        $new_keahlian = $conn->real_escape_string($_POST['keahlian']);
        $conn->query("UPDATE konsultan SET keahlian = '$new_keahlian' WHERE id_pengguna = $id");
    }

    $update_success = true;
    $user = $conn->query("SELECT * FROM pengguna WHERE id_pengguna = $id")->fetch_assoc();
    if ($role === 'konsultan') {
        $konsultan = $conn->query("SELECT * FROM konsultan WHERE id_pengguna = $id")->fetch_assoc();
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Profil Saya</title>
    <link rel="stylesheet" href="css/profil.css">
</head>
<body>

<div class="profil-container">
    <h2>Profil Saya</h2>

    <?php if ($update_success): ?>
        <div class="success-msg">✔️ Profil berhasil diperbarui.</div>
    <?php endif; ?>

    <form method="POST">
        <label>Username</label>
        <input type="text" name="username" value="<?= htmlspecialchars($user['username']) ?>" required>

        <label>Email</label>
        <input type="text" value="<?= htmlspecialchars($user['email']) ?>" readonly>

        <?php if ($role === 'user'): ?>
            <label>Alamat</label>
            <input type="text" value="<?= htmlspecialchars($user['alamat']) ?>" readonly>
        <?php endif; ?>

        <?php if ($role === 'konsultan' && $konsultan): ?>
            <label>Keahlian</label>
            <input type="text" name="keahlian" value="<?= htmlspecialchars($konsultan['keahlian']) ?>" required>
        <?php endif; ?>

        <label>Password Baru (opsional)</label>
        <input type="password" name="password" placeholder="Biarkan kosong jika tidak ingin diubah">

        <div class="btn-group">
            <button type="submit">Simpan Perubahan</button>
            <a href="Halaman_web/projek_ukl.php" class="btn">Kembali</a>
        </div>
    </form>
</div>

</body>
</html>