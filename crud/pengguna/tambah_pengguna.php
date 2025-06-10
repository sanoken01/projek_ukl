<?php
$koneksi = new mysqli("localhost", "root", "", "projek_ukl");

if (isset($_POST['tambah'])) {
    $username = $_POST['username'];
    $email    = $_POST['email'];
    $password = $_POST['password'];
    $alamat   = $_POST['alamat'];
    $role     = $_POST['role'];

    // Insert data
    $query = "INSERT INTO pengguna (username, email, password, alamat, role) 
              VALUES ('$username', '$email', '$password', '$alamat', '$role')";

    if ($koneksi->query($query)) {
        echo "<script>alert('Data berhasil ditambahkan!'); window.location='data_pengguna.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Pengguna</title>
  <link rel="stylesheet" href="../../css/register.css"> <!-- pakai css register -->
</head>
<body>
  <div>
    <h2>Tambah Pengguna Baru</h2>
    <form method="POST">
      <input type="text" name="username" placeholder="Username" required>
      <input type="email" name="email" placeholder="Email" required>
      <input type="password" name="password" placeholder="Password" required>
      <input type="text" name="alamat" placeholder="Alamat" required>

      <select name="role" required>
        <option value="user">User</option>
        <option value="konsultan">Konsultan</option>
        <option value="admin">Admin</option>
      </select>

      <button type="submit" name="tambah">Tambah</button>
      <p><a href="../data_pengguna.php">← Kembali ke Data Pengguna</a></p>
    </form>
  </div>
</body>
</html>