<?php
$koneksi = new mysqli("localhost", "root", "", "projek_ukl");

// Cek jika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $alamat = $_POST['alamat'];

    $query = "INSERT INTO pengguna (username, email, password, alamat) VALUES ('$nama', '$email','$password', '$alamat')";
    $result = $koneksi->query($query);

    if ($result) {
        header("Location: index.php"); // kembali ke halaman utama data user
        exit;
    } else {
        echo "<p style='color:red;'>Gagal menambahkan data!</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Tambah Data User</title>
  <link rel="stylesheet" href="style.css"> <!-- pastikan path-nya sesuai -->
</head>
<body>
  <div class="container">
    <div class="main-content">
      <h1>Tambah Data Pengguna</h1>
      <form method="POST" action="">
        <label for="username">Nama:</label>
        <input type="text" name="username" id="username" required placeholder="Masukkan nama">

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required placeholder="Masukkan email">

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required placeholder="Masukkan password">


        <label for="alamat">Alamat:</label>
        <input type="text" name="alamat" id="alamat" required placeholder="Masukkan alamat">

        <button type="submit">Simpan</button>
      </form>
      <a href="index.php" class="back-link">← Kembali ke Data User</a>
    </div>
  </div>
</body>
</html>
