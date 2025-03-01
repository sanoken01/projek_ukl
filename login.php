<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $stmt = $conn->prepare("SELECT id_pengguna, password FROM pengguna WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $hashed_password);
    $stmt->fetch();

    if ($stmt->num_rows > 0 && password_verify($password, $hashed_password)) {
        $_SESSION['user_id'] = $id;

        // Debugging: Cek apakah session tersimpan
        echo "<pre>";
        print_r($_SESSION);
        echo "</pre>";

        header("Location: projek_ukl.php");
        exit;
    } else {
        echo "<script>alert('Email atau Password salah!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="auth.css">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
<div class="form-container">
        <h2>Login</h2>
        <form method="POST">
            <div class="input-group">
                <input type="email" name="email" id="email" placeholder=" " required>
                <label for="email">Email</label>
            </div>

            <div class="input-group">
                <input type="password" name="password" id="password" placeholder=" " required>
                <label for="password">Password</label>
            </div>

            <button type="submit" class="btn-auth">Login</button>
        </form>
        <p>Belum punya akun? <a href="daftar.php">Daftar</a></p>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html>
