<?php
session_start();
require 'config.php'; // pastikan koneksi ke database

if (!isset($_SESSION['user_id'])) {
    header("Location:login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$query = mysqli_query($conn, "SELECT * FROM pengguna WHERE id = '$user_id'");
$data = mysqli_fetch_assoc($query);

// Proses update profil
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    
    $update = mysqli_query($conn, "UPDATE pengguna SET username='$username', email='$email' WHERE id='$user_id'");
    
    if ($update) {
        echo "<p style='color: green;'>Profil berhasil diperbarui!</p>";
        // refresh data
        $query = mysqli_query($conn, "SELECT * FROM pengguna WHERE id = '$user_id'");
        $data = mysqli_fetch_assoc($query);
    } else {
        echo "<p style='color: red;'>Gagal memperbarui profil.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Profil Saya</title>
    <link rel="stylesheet" href="css/projek_ukl.css">
</head>
<body>

<header>
    <nav>
        <ul>
            <li><a href="Halaman web/projek_ukl.php">Home</a></li>
            <li><a href="Halaman web/kalender_tanam.php">Informasi</a></li>
            <li><a href="Halaman web/panduan.php">Panduan</a></li>
            <li><a href="Halaman web/konsultasi.php">Konsultasi</a></li>
            <li><a href="Halaman web/profil.php">Profil</a></li>
            <li><a href="Halaman web/logout.php">Logout</a></li>
        </ul>
    </nav>
</header>

<main class="content">
    <h2>Profil Saya</h2>
    <form method="POST" action="">
        <label>Nama:</label><br>
        <input type="text" name="nama" value="<?= htmlspecialchars($data['username']) ?>" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" value="<?= htmlspecialchars($data['email']) ?>" required><br><br>

        <button type="submit">Simpan Perubahan</button>
    </form>
</main>

</body>
</html>
