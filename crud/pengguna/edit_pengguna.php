<?php
$koneksi = new mysqli("localhost", "root", "", "projek_ukl");

// Ambil ID dari URL
$id = $_GET['id'];

// Ambil data pengguna berdasarkan ID
$data = $koneksi->query("SELECT * FROM pengguna WHERE id_pengguna = $id")->fetch_assoc();

// Proses update jika form disubmit
if (isset($_POST['update'])) {
    $username = $_POST['username'];
    $email    = $_POST['email'];
    $alamat   = $_POST['alamat'];
    $role     = $_POST['role'];

    $koneksi->query("UPDATE pengguna SET 
    username = '$username', 
    email = '$email', 
    alamat = '$alamat', 
    role = '$role'
    WHERE id_pengguna = $id");

    echo "<script>alert('Data berhasil diupdate!'); window.location='data_pengguna.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Pengguna</title>
  <link rel="stylesheet" href="../../css/register.css"> 
</head>
<body>
  <div>
    <h2>Edit Pengguna</h2>
    <form method="POST">
      <input type="text" name="username" value="<?= $data['username'] ?>" required>
      <input type="email" name="email" value="<?= $data['email'] ?>" required>
      <input type="text" name="alamat" value="<?= $data['alamat'] ?>" required>

      <select name="role" required>
        <option value="user" <?= $data['role'] == 'user' ? 'selected' : '' ?>>User</option>
        <option value="konsultan" <?= $data['role'] == 'konsultan' ? 'selected' : '' ?>>Konsultan</option>
        <option value="admin" <?= $data['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
      </select>

      <button type="submit" name="update">Simpan Perubahan</button>
      <p><a href="../data_pengguna.php">← Kembali ke Data Pengguna</a></p>
    </form>
  </div>
</body>
</html>
