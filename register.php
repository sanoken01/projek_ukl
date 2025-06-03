<?php
session_start();
include 'config.php';

if (isset($_POST['register'])) {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $alamat = trim($_POST['alamat']);
    $role = "user"; // Default role

    // Cek jika field kosong
    if ($username && $email && $password && $alamat) {
        // Cek apakah email sudah terdaftar
        $check_query = "SELECT id_pengguna FROM pengguna WHERE email = ?";
        $stmt = mysqli_prepare($conn, $check_query);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            echo "<script>alert('Email sudah terdaftar!');</script>";
        } else {
            // Hash password dan insert data ke database
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $query = "INSERT INTO pengguna (username, email, password, alamat, role) VALUES (?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, "sssss", $username, $email, $hashed_password, $alamat, $role);

            if (mysqli_stmt_execute($stmt)) {
                $_SESSION['user_id'] = mysqli_insert_id($conn);
                $_SESSION['username'] = $username;
                $_SESSION['email'] = $email;
                $_SESSION['role'] = $role;

                echo "<script>alert('Pendaftaran berhasil!'); window.location='Halaman web/projek_ukl.php';</script>";
                exit;
            } else {
                echo "<script>alert('Pendaftaran gagal: " . mysqli_error($conn) . "');</script>";
            }
        }
    } else {
        echo "<script>alert('Semua field harus diisi!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="css/register.css">
    <link rel="stylesheet" href="fontawesome/css/font-awesome.min.css">
</head>
<body>
    <div>
        <h2>Register</h2>
        <form action="" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="text" name="alamat" placeholder="Alamat" required>
            <button type="submit" name="register">Register</button>
            <p>Sudah punya akun? <a href="login.php">Login di sini</a></p>
            <a href="Halaman web/projek_ukl.php" class="home-icon"><i class="fa fa-home"></i></a>
        </form>
    </div>
</body>
</html>
