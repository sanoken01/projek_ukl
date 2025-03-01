<?php
session_start();
include 'config.php'; // Koneksi ke database

if (isset($_POST['register'])) {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $alamat = trim($_POST['alamat']);
    $role = "user"; // Default role adalah "user"

    if (empty($username) || empty($email) || empty($password) || empty($alamat)) {
        echo "<script>alert('Semua field harus diisi!');</script>";
    } else {
        // Cek apakah email sudah digunakan
        $check_query = "SELECT id_pengguna FROM pengguna WHERE email = ?";
        $stmt_check = mysqli_prepare($conn, $check_query);
        mysqli_stmt_bind_param($stmt_check, "s", $email);
        mysqli_stmt_execute($stmt_check);
        mysqli_stmt_store_result($stmt_check);

        if (mysqli_stmt_num_rows($stmt_check) > 0) {
            echo "<script>alert('Email sudah terdaftar! Silakan gunakan email lain.');</script>";
        } else {
            // Hash password sebelum disimpan
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert data ke database
            $query = "INSERT INTO pengguna (username, email, password, alamat, role) VALUES (?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, "sssss", $username, $email, $hashed_password, $alamat, $role);

            if (mysqli_stmt_execute($stmt)) {
                // Ambil ID pengguna yang baru dibuat
                $user_id = mysqli_insert_id($conn);

                // Simpan session agar langsung login
                $_SESSION['user_id'] = $user_id;
                $_SESSION['username'] = $username;
                $_SESSION['email'] = $email;
                $_SESSION['role'] = $role;

                echo "<script>alert('Pendaftaran berhasil!'); window.location='projek_ukl.php';</script>";
                exit;
            } else {
                echo "<script>alert('Pendaftaran gagal! Error: " . mysqli_error($conn) . "');</script>";
            }
            mysqli_stmt_close($stmt); // Tutup statement insert
        }
        mysqli_stmt_close($stmt_check); // Tutup statement cek email
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar</title>
    <link rel="stylesheet" href="desain.css">
</head>
<body>
    <div class="form-container">
        <h2>Daftar</h2>
        <form action="" method="POST">
            <div class="input-group">
                <input type="text" name="username" placeholder="Username" required>
            </div>

            <div class="input-group">
                <input type="email" name="email" placeholder="Email" required>
            </div>

            <div class="input-group">
                <input type="password" name="password" placeholder="Password" required>
            </div>

            <div class="input-group">
                <input type="text" name="alamat" placeholder="Alamat" required>
            </div>
            
            <button type="submit" name="register" class="btn">Daftar</button>
            
            <p class="login-register-text">Sudah punya akun? <a href="login.php">Login</a></p>
        </form>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html>
