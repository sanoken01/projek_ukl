<?php
session_start();
$conn = new mysqli("localhost", "root", "", "projek_ukl");

// Cek apakah user login
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}

$id_pengguna = $_SESSION['user_id'];
$role = $_SESSION['role']; // 'user' atau 'admin'
$id_konsultan = intval($_GET['id_konsultan']); // dari pilih_konsultan.php

// Cari atau buat sesi konsultasi
$q = $conn->query("SELECT id_konsultasi FROM konsultasi WHERE id_pengguna=$id_pengguna AND id_konsultan=$id_konsultan");
if ($q->num_rows > 0) {
    $row = $q->fetch_assoc();
    $id_konsultasi = $row['id_konsultasi'];
} else {
    $conn->query("INSERT INTO konsultasi (id_pengguna, id_konsultan, pertanyaan) VALUES ($id_pengguna, $id_konsultan, '-')");
    $id_konsultasi = $conn->insert_id;
}

// Kirim pesan
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['pesan'])) {
    $pesan = $conn->real_escape_string($_POST['pesan']);
    $pengirim = ($role === 'admin') ? 'konsultan' : 'pengguna';
    $conn->query("INSERT INTO chat_konsultasi (id_konsultasi, pengirim, isi_pesan) VALUES ($id_konsultasi, '$pengirim', '$pesan')");
}

// Ambil pesan
$chats = $conn->query("SELECT * FROM chat_konsultasi WHERE id_konsultasi = $id_konsultasi ORDER BY waktu_kirim ASC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Chat Konsultasi | TaniPintar</title>
    <link rel="stylesheet" href="../css/main.css">
    <style>
        .chat-container {
            max-width: 800px;
            margin: 40px auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        .chat-box {
            max-height: 400px;
            overflow-y: auto;
            border: 1px solid #ddd;
            padding: 15px;
            margin-bottom: 20px;
            background-color: #f9f9f9;
        }

        .chat-msg {
            margin-bottom: 15px;
        }

        .chat-msg.pengguna strong {
            color: #2c3e50;
        }

        .chat-msg.konsultan strong {
            color: #e74c3c;
        }

        form.chat-form {
            display: flex;
            gap: 10px;
        }

        .chat-form input[type="text"] {
            flex: 1;
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }

        .chat-form button {
            padding: 10px 20px;
            background-color: #2d4053;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        .chat-form button:hover {
            background-color: #1f2d3a;
        }

        .konsultasi-btn {
            display: inline-block;
            background-color: #e74c3c;
            color: white;
            padding: 10px 20px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

.konsultasi-btn:hover {
    background-color: #c0392b;
}
    </style>
</head>
<body>

    <div class="chat-container">
        <h2>Chat Konsultasi</h2>
        <div class="chat-box">
            <?php while ($row = $chats->fetch_assoc()): ?>
                <div class="chat-msg <?php echo $row['pengirim']; ?>">
                    <strong><?php echo ucfirst($row['pengirim']); ?>:</strong>
                    <?php echo htmlspecialchars($row['isi_pesan']); ?>
                    <div style="font-size: 0.8em; color: #777;"><?php echo $row['waktu_kirim']; ?></div>
                </div>
            <?php endwhile; ?>
        </div>

        <form method="post" class="chat-form">
            <input type="text" name="pesan" placeholder="Ketik pesan..." required>
            <button type="submit">Kirim</button>
        </form>
    </div>

    <div style="text-align: center; margin-top: 20px;">
        <a href="konsultasi.php" class="konsultasi-btn">← Kembali ke Konsultasi</a>
    </div>

</body>
</html>