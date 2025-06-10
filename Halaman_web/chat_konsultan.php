<?php
session_start();
$conn = new mysqli("localhost", "root", "", "projek_ukl");

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'konsultan') {
    header("Location: ../login.php");
    exit;
}

$id_pengguna_login = $_SESSION['user_id'];

// Ambil id_konsultan berdasarkan id_pengguna login
$getKonsultan = $conn->query("SELECT id_konsultan FROM konsultan WHERE id_pengguna = $id_pengguna_login");
if ($getKonsultan->num_rows === 0) {
    echo "Data konsultan tidak ditemukan.";
    exit;
}
$id_konsultan = $getKonsultan->fetch_assoc()['id_konsultan'];

// Ambil daftar sesi konsultasi ke konsultan ini
$q = $conn->query("
    SELECT k.id_konsultasi, p.username, p.email
    FROM konsultasi k
    JOIN pengguna p ON k.id_pengguna = p.id_pengguna
    WHERE k.id_konsultan = $id_konsultan
    ORDER BY k.id_konsultasi DESC
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pesan Masuk | Konsultan</title>
    <link rel="stylesheet" href="../css/main.css">
    <style>
        .chat-list-container {
            max-width: 800px;
            margin: 60px auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .chat-item {
            padding: 15px;
            border: 1px solid #ddd;
            margin-bottom: 15px;
            border-radius: 8px;
            background-color: #f9f9f9;
        }

        .chat-item a {
            color: #2d4053;
            font-weight: bold;
            text-decoration: none;
        }

        .chat-item a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="chat-list-container">
    <h2>Daftar Konsultasi Masuk</h2>
    <?php if ($q->num_rows > 0): ?>
        <?php while ($row = $q->fetch_assoc()): ?>
            <div class="chat-item">
                <p><strong>Pengguna:</strong> <?php echo htmlspecialchars($row['username']); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($row['email']); ?></p>
                <a href="chat_konsultasi_detail.php?id_konsultasi=<?php echo $row['id_konsultasi']; ?>">Lihat Chat</a>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>Tidak ada konsultasi aktif saat ini.</p>
    <?php endif; ?>
</div>

</body>
</html>