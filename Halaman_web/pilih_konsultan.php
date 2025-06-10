<?php
session_start();
$conn = new mysqli("localhost", "root", "", "projek_ukl");

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data konsultan
$result = $conn->query("SELECT * FROM konsultan");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pilih Konsultan | TaniPintar</title>
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>

    <!-- Header -->
    <header>
        <nav class="navbar">
            <div class="nav-content">
                <a href="projek_ukl.php" class="logo">TaniPintar</a>
                <ul class="nav-links"> 
                    <div class="nav-middle">
                        <li><a href="projek_ukl.php">Beranda</a></li>
                        <li><a href="informasi.php">Informasi</a></li>
                        <li><a href="panduan.php">Panduan</a></li>
                        <li><a href="konsultasi.php">Konsultasi</a></li>
                        <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                            <li><a href="page-admin/admin.php">Admin Panel</a></li>
                        <?php endif; ?>
                    </div>
                    <div class="nav-right">
                        <?php if (isset($_SESSION['user_id'])): ?>
                            <li><a href="../profil.php">Profil</a></li>
                            <li><a href="../logout.php">Logout</a></li>
                        <?php else: ?>
                            <li><a href="../login.php">Login</a></li>
                        <?php endif; ?>
                    </div>
                </ul>
            </div>
        </nav>
    </header>

    <!-- Daftar Konsultan -->
    <div class="konsultasi-container section-padding">
        <h2>Pilih Konsultan</h2>
        <p>Silakan pilih konsultan sesuai dengan bidang keahlian yang kamu butuhkan:</p>

        <?php if ($result->num_rows > 0): ?>
            <ul style="list-style: none; padding: 0;">
                <?php while ($row = $result->fetch_assoc()): ?>
                    <li style="margin-bottom: 20px;">
                        <div style="background: #f2f2f2; padding: 20px; border-radius: 10px;">
                            <h3 style="margin-bottom: 8px;"><?php echo htmlspecialchars($row['nama']); ?></h3>
                            <p><strong>Keahlian:</strong> <?php echo htmlspecialchars($row['keahlian']); ?></p>
                            <a href="chat.php?id_konsultan=<?php echo $row['id_konsultan']; ?>" class="konsultasi-btn">Konsultasi Sekarang</a>
                        </div>
                    </li>
                <?php endwhile; ?>
            </ul>
        <?php else: ?>
            <p>Tidak ada konsultan tersedia saat ini.</p>
        <?php endif; ?>
    </div>

    <!-- Footer -->
    <footer class="site-footer">
        <div class="footer-container">
            <div class="footer-column">
                <h3>TaniPintar</h3>
                <p>Solusi digital untuk pertanian modern.</p>
            </div>
            <div class="footer-column">
                <h4>Layanan</h4>
                <ul>
                    <li><a href="projek_ukl.php">Beranda</a></li>
                    <li><a href="informasi.php">Kalender Tanam</a></li>
                    <li><a href="panduan.php">Panduan Bertani</a></li>
                    <li><a href="konsultasi.php">Konsultasi</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h4>Kontak Kami</h4>
                <p>Email: <a href="mailto:petani@tanipintar.id">petani@tanipintar.id</a></p>
                <p>Telepon: (+62) 123-4567-8765</p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2025 TaniPintar. Semua hak dilindungi.</p>
        </div>
    </footer>

</body>
</html>