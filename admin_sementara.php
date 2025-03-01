<?php
session_start();
include 'config.php';

// Cek apakah user sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Cek apakah user adalah admin
$is_admin = isset($_SESSION['role']) && $_SESSION['role'] === 'admin';

// Ambil data pengguna
$sql = "SELECT id_pengguna, email, role FROM pengguna";
$result = $conn->query($sql);

// Handle CRUD: Tambah, Edit, Hapus
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add'])) {
        $email = trim($_POST['email']);
        $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);
        $role = trim($_POST['role']);
        
        // Insert data pengguna baru
        $stmt = $conn->prepare("INSERT INTO pengguna (email, password, role) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $email, $password, $role);
        $stmt->execute();
        header("Location: admin_sementara.php");
        exit;
    }

    if (isset($_POST['edit'])) {
        $id = $_POST['id'];
        $email = trim($_POST['email']);
        $role = trim($_POST['role']);
        
        // Update data pengguna
        $stmt = $conn->prepare("UPDATE pengguna SET email = ?, role = ? WHERE id_pengguna = ?");
        $stmt->bind_param("ssi", $email, $role, $id);
        $stmt->execute();
        header("Location: admin_sementara.php");
        exit;
    }

    if (isset($_POST['delete'])) {
        $id = $_POST['id'];
        
        // Hapus data pengguna
        $stmt = $conn->prepare("DELETE FROM pengguna WHERE id_pengguna = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        header("Location: admin_sementara.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manajemen Pengguna</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>

<header>
    <nav>
        <ul>
            <li><a href="projek_ukl.php">Home</a></li>
            <li><a href="admin_sementara.php">Admin Panel</a></li>
            <li><a href="profil.php">Profil</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
</header>

<section class="content">
    <h2>Manajemen Pengguna</h2>

    <?php if ($is_admin): ?>
        <!-- Form untuk menambah pengguna baru -->
        <h3>Tambah Pengguna Baru</h3>
        <form method="POST">
            <label for="email">Email:</label>
            <input type="email" name="email" required><br>

            <label for="password">Password:</label>
            <input type="password" name="password" required><br>

            <label for="role">Role:</label>
            <select name="role">
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select><br>

            <button type="submit" name="add">Tambah Pengguna</button>
        </form>
    <?php endif; ?>

    <h3>Daftar Pengguna</h3>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id_pengguna']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['role']; ?></td>
                    <td>
                        <?php if ($is_admin): ?>
                            <!-- Edit dan Hapus hanya untuk Admin -->
                            <form method="POST" style="display:inline;">
                                <input type="hidden" name="id" value="<?php echo $row['id_pengguna']; ?>">
                                <input type="text" name="email" value="<?php echo $row['email']; ?>" required>
                                <select name="role">
                                    <option value="user" <?php echo ($row['role'] === 'user') ? 'selected' : ''; ?>>User</option>
                                    <option value="admin" <?php echo ($row['role'] === 'admin') ? 'selected' : ''; ?>>Admin</option>
                                </select>
                                <button type="submit" name="edit">Edit</button>
                            </form>
                            <form method="POST" style="display:inline;">
                                <input type="hidden" name="id" value="<?php echo $row['id_pengguna']; ?>">
                                <button type="submit" name="delete">Hapus</button>
                            </form>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</section>

<footer>
    <p>© 2025 TaniPintar. Semua hak dilindungi.</p>
</footer>

</body>
</html>
