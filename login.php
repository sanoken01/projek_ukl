<?php
session_start();
include 'config.php';

$error = '';

if (isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($email) || empty($password)) {
        $error = "Email dan Password tidak boleh kosong!";
    } else {
        // Prepared Statement untuk mencegah SQL Injection
        $query = "SELECT * FROM pengguna WHERE email = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $user = mysqli_fetch_assoc($result);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id_pengguna'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            header("Location: Halaman web/projek_ukl.php");
            exit;
        } else {
            $error = "Email atau Password salah!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/Login.css">
    <link rel="stylesheet" href="fontawesome/css/font-awesome.min.css">
</head>
<body>

    <div>
        <h2>Login</h2>
        <form action="" method="POST">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="login">Login</button>
            <p>Belum punya akun? <a href="register.php">Register di sini</a></p>
            <a href="halaman web/projek_ukl.php" class="home-icon"><i class="fa fa-home"></i></a>
        </form>
    </div>
    
</body>
</html>
