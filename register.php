<?php
session_start();
include 'config.php';

if (isset($_POST['register'])) {
    $username = trim($_POST['username']);
    $email    = trim($_POST['email']);
    $password = trim($_POST['password']);
    $alamat   = trim($_POST['alamat']);
    $role     = isset($_POST['konsultan']) ? 'konsultan' : 'user';
    $keahlian = isset($_POST['keahlian']) ? trim($_POST['keahlian']) : null;

    if ($username && $email && $password && $alamat) {
        $cek = mysqli_query($conn, "SELECT id_pengguna FROM pengguna WHERE email = '$email'");
        if (mysqli_num_rows($cek) > 0) {
            echo "<script>alert('Email sudah terdaftar!');</script>";
        } else {
            // Insert pengguna
            mysqli_query($conn, "INSERT INTO pengguna (username, email, password, alamat, role) 
                                 VALUES ('$username', '$email', '$password', '$alamat', '$role')");

            $id_pengguna = mysqli_insert_id($conn);

            // Insert ke konsultan jika role konsultan
            if ($role == 'konsultan' && $keahlian) {
                mysqli_query($conn, "INSERT INTO konsultan (id_pengguna, keahlian) 
                                     VALUES ('$id_pengguna', '$keahlian')");
            }

            $_SESSION['user_id'] = $id_pengguna;
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            $_SESSION['role'] = $role;

            echo "<script>alert('Pendaftaran berhasil!'); window.location='Halaman_web/projek_ukl.php';</script>";
            exit;
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

            <label>
                <input type="checkbox" name="konsultan" id="konsultanCheckbox" onchange="toggleKeahlian()"> Daftar sebagai Konsultan
            </label>
            <input type="text" name="keahlian" id="keahlianInput" placeholder="Keahlian Konsultan" style="display:none;">

            <button type="submit" name="register">Register</button>
            <p>Sudah punya akun? <a href="login.php">Login di sini</a></p>
            <a href="Halaman_web/projek_ukl.php" class="home-icon"><i class="fa fa-home"></i></a>
        </form>

        <script>
        function toggleKeahlian() {
            document.getElementById('keahlianInput').style.display =
                document.getElementById('konsultanCheckbox').checked ? 'block' : 'none';
        }
        </script>

    </div>
</body>
</html>
