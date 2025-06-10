<?php
$koneksi = new mysqli("localhost", "root", "", "projek_ukl");
$data = $koneksi->query("SELECT * FROM pengguna");
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Data Pengguna</title>
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
      <li><a href="../Halaman_web/projek_ukl.php">Ke Beranda</a></li>
      <li><a href="data_pengguna.php">Data User</a></li>
      <li><a href="data_beranda.php">Data Beranda</a></li> <!-- nanti buat projek_ukl -->
    </ul>
  </div>
  <div class="main-content">
    <button class="toggle-btn" onclick="toggleSidebar()">☰</button>
    <h1>Data Pengguna</h1>
    <a href="pengguna/tambah_pengguna.php" class="add-btn">Tambah</a>
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Nama</th>
          <th>Email</th>
          <th>Alamat</th>
          <th>Role</th>
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
          <td><?= $row['role'] ?></td>
          <td>
            <a href="pengguna/edit_pengguna.php?id=<?= $row['id_pengguna'] ?>" class="icon-btn" title="Edit"><i class="fas fa-edit"></i></a>
            <a href="pengguna/hapus_pengguna.php?id=<?= $row['id_pengguna'] ?>" class="icon-btn delete" onclick="return confirm('Yakin ingin menghapus data ini?')" title="Hapus"><i class="fas fa-trash-alt"></i></a>
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
