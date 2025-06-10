<?php
session_start();
$conn = new mysqli("localhost", "root", "", "projek_ukl");

// Cek login & role konsultan
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'konsultan') {
    header("Location: ../login.php");
    exit;
}

// Ambil ID sesi konsultasi dari URL
$id_konsultasi = intval($_GET['id_konsultasi']);

// Ambil ID konsultan dari tabel konsultan
$id_pengguna_login = $_SESSION['user_id'];
$getKonsultan = $conn->query("SELECT id_konsultan FROM konsultan WHERE id_pengguna = $id_pengguna_login");
if ($getKonsultan->num_rows === 0) {
    echo "Data konsultan tidak ditemukan.";
    exit;
}
$id_konsultan = $getKonsultan->fetch_assoc()['id_konsultan'];

// Cek apakah sesi valid untuk konsultan ini
$cek = $conn->query("SELECT * FROM konsultasi WHERE id_konsultasi = $id_konsultasi AND id_konsultan = $id_konsultan");
if ($cek->num_rows === 0) {
    echo "Sesi tidak valid atau bukan milik Anda.";
    exit;
}

// Kirim pesan jika ada
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['pesan'])) {
    $pesan = $conn->real_escape_string($_POST['pesan']);
    $conn->query("INSERT INTO chat_konsultasi (id_konsultasi, pengirim, isi_pesan) VALUES ($id_konsultasi, 'konsultan', '$pesan')");
}

// Ambil semua chat
$chats = $conn->query("SELECT * FROM chat_konsultasi WHERE id_konsultasi = $id_konsultasi ORDER BY waktu_kirim ASC");

// Cek pengirim terakhir untuk notifikasi
$last_chat = $conn->query("SELECT pengirim FROM chat_konsultasi WHERE id_konsultasi = $id_konsultasi ORDER BY waktu_kirim DESC LIMIT 1");
$notif = '';
if ($last_chat && $last_chat->num_rows > 0) {
    $last_pengirim = $last_chat->fetch_assoc()['pengirim'];
    if ($last_pengirim === 'pengguna') {
        $notif = "🔔 Pengguna telah mengirim pesan terakhir.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Konsultasi</title>
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

        .notif-box {
            padding: 10px 15px;
            background-color: #fff3cd;
            border: 1px solid #ffeeba;
            color: #856404;
            margin-bottom: 15px;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<div class="chat-container">
    <h2>Detail Konsultasi</h2>

    <?php if ($notif): ?>
        <div class="notif-box"><?php echo $notif; ?></div>
    <?php endif; ?>

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
        <input type="text" name="pesan" placeholder="Ketik balasan..." required>
        <button type="submit">Kirim</button>
    </form>

    <div style="text-align:center; margin-top: 20px;">
        <a href="chat_konsultan.php" class="konsultasi-btn">← Kembali ke Daftar Konsultasi</a>
    </div>
</div>

</body>
</html>