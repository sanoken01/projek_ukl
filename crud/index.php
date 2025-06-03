<?php
$koneksi = new mysqli("localhost", "root", "", "projek_ukl");
$data = $koneksi->query("SELECT * FROM pengguna");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Data User</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>
<body>
<div class="container">
  <div class="sidebar" id="sidebar">
    <div class="logo">
      <h2 style="color: white;">CRUD Admin</h2>
    </div>
    <ul>
    <li><a href="../Halaman web/projek_ukl.php">Dashboard</a></li>
      <li><a href="/tani_pintar/crud/index.php">Data User</a></li>
      <li><a href="/tani_pintar/crud/index.php">data Informasi</a></li>
    </ul>
  </div>
  <div class="main-content">
    <button class="toggle-btn" onclick="toggleSidebar()">☰</button>
    <h1>Data User</h1>
    <a href="tambah.php" class="add-btn">Tambah</a>
    <table>
      <thead>
        <tr>
          <th>Id</th>
          <th>Nama</th>
          <th>Email</th>
          <th>alamat</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php while($row = $data->fetch_assoc()): ?>
        <tr>
          <td><?= $row['id_pengguna'] ?></td>
          <td><?= $row['username'] ?></td>
          <td><?= $row['email'] ?></td>
          <td><?= $row['alamat'] ?></td>
          <td>
  <a href="../profil.php=<?= $row['id_pengguna'] ?>" class="icon-btn" title="Edit"><i class="fas fa-edit"></i></a>
  <a href="../logout.php=<?= $row['id_pengguna'] ?>" class="icon-btn delete" title="Hapus" onclick="return confirm('Hapus data ini?')"><i class="fas fa-trash-alt"></i></a>
          </td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</div>

<script>
function toggleSidebar() {
  document.getElementById("sidebar").classList.toggle("hidden");
}
</script>
</body>
</html>