<?php
session_start();

// Pastikan pengguna adalah admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: projek_ukl.php");
    exit();
}

include('koneksi.php');

// Tambah pengguna baru
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tambah'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    $sql = "INSERT INTO pengguna (nama, email, role) VALUES ('$nama', '$email', '$role')";
    if (mysqli_query($conn, $sql)) {
        header("Location: admin.php"); // Refresh halaman setelah tambah
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Edit pengguna
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $sql = "SELECT * FROM pengguna WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);
}

// Update pengguna setelah edit
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    $sql = "UPDATE pengguna SET nama='$nama', email='$email', role='$role' WHERE id=$id";
    if (mysqli_query($conn, $sql)) {
        header("Location: admin.php"); // Refresh halaman setelah update
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Hapus pengguna
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $sql = "DELETE FROM pengguna WHERE id = $id";
    if (mysqli_query($conn, $sql)) {
        header("Location: admin.php"); // Refresh halaman setelah hapus
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Ambil semua pengguna untuk ditampilkan
$sql = "SELECT * FROM pengguna";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - TaniPintar</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<!-- Navbar -->
<header>
    <nav>
        <ul>
            <li><a href="projek_ukl.php">Home</a></li>
            <li><a href="kalender_tanam.php">Kalender Tanam</a></li>
            <li><a href="panduan.php">Panduan</a></li>
            <li><a href="konsultasi.php">Konsultasi</a></li>
            <li><a href="admin.php">Admin Panel</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
</header>

<!-- Admin Content -->
<section class="content">
    <h2>Admin Panel</h2>
    <p>Selamat datang di panel admin, di sini kamu bisa mengelola data pengguna.</p>

    <!-- Form Tambah Pengguna -->
    <h3>Tambah Pengguna Baru</h3>
    <form method="POST">
        <input type="text" name="nama" placeholder="Nama" required>
        <input type="email" name="email" placeholder="Email" required>
        <select name="role" required>
            <option value="user">User</option>
            <option value="admin">Admin</option>
        </select>
        <button type="submit" name="tambah">Tambah Pengguna</button>
    </form>

    <!-- Tabel Daftar Pengguna -->
    <h3>Daftar Pengguna</h3>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['nama'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['role'] . "</td>";
                    echo "<td>
                            <a href='admin.php?edit=" . $row['id'] . "'>Edit</a> |
                            <a href='admin.php?hapus=" . $row['id'] . "' onclick='return confirm(\"Yakin ingin menghapus?\")'>Hapus</a>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Tidak ada data pengguna</td></tr>";
            }
            ?>
        </tbody>
    </table>
</section>

<!-- Edit Pengguna (Form Edit) -->
<?php if (isset($user)): ?>
    <section class="content">
        <h3>Edit Pengguna</h3>
        <form method="POST">
            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
            <input type="text" name="nama" value="<?php echo $user['nama']; ?>" required>
            <input type="email" name="email" value="<?php echo $user['email']; ?>" required>
            <select name="role" required>
                <option value="user" <?php echo ($user['role'] == 'user') ? 'selected' : ''; ?>>User</option>
                <option value="admin" <?php echo ($user['role'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
            </select>
            <button type="submit" name="edit">Update Pengguna</button>
        </form>
    </section>
<?php endif; ?>

<!-- Footer -->
<footer>
    <div class="footer-content">
        <h3>TaniPintar</h3>
        <p>Email: petani@tanipintar.id</p>
        <p>Telepon: (+62) 123-4567-8765</p>
        <p>Alamat: Jl. Pertanian Pintar No. 123, Atlantis</p>
        <div class="social-links">
            <a href="#">Facebook</a>
            <a href="#">Instagram</a>
            <a href="#">WhatsApp</a>
        </div>
    </div>
</footer>

</body>
</html>