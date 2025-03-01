<?php
session_start();
include 'config.php';

// Pastikan user sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Ambil data user dari database
$query = "SELECT username, email, alamat FROM pengguna WHERE id_pengguna = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $username, $email, $alamat);
mysqli_stmt_fetch($stmt);
mysqli_stmt_close($stmt);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya</title>
    <link rel="stylesheet" href="profil.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container">
        <h2>Profil Saya</h2>
        <table class="profile-table">
            <tr>
                <th>Username</th>
                <td contenteditable="true" class="editable" data-field="username"><?php echo htmlspecialchars($username); ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?php echo htmlspecialchars($email); ?> (tidak bisa diubah)</td>
            </tr>
            <tr>
                <th>Alamat</th>
                <td contenteditable="true" class="editable" data-field="alamat"><?php echo htmlspecialchars($alamat); ?></td>
            </tr>
        </table>
        <p class="info">Klik pada kolom untuk mengedit, perubahan akan tersimpan otomatis.</p>
    </div>

    <script>
        $(document).ready(function() {
            $(".editable").on("blur", function() {
                var field = $(this).data("field");
                var value = $(this).text().trim();

                $.ajax({
                    url: "update_profil.php",
                    type: "POST",
                    data: { field: field, value: value },
                    success: function(response) {
                        alert(response);
                    },
                    error: function() {
                        alert("Terjadi kesalahan, coba lagi!");
                    }
                });
            });
        });
    </script>
</body>
</html>
