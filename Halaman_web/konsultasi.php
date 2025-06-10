<?php
session_start();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Konsultasi | TaniPintar</title>
    <link rel="stylesheet" href="../css/main.css"> <!-- Pastikan path ini benar -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<header>
    <nav class="navbar">
        <div class="nav-content">
            <a href="projek_ukl.php" class="logo">TaniPintar</a>
            <ul class="nav-links"> 
                <div class="nav-middle">
                <?php if (isset($_SESSION['role'])): ?>
                    <li><a href="projek_ukl.php">Beranda</a></li>
                    <li><a href="informasi.php">Informasi</a></li>
                    <li><a href="panduan.php">Panduan</a></li>

                <?php if ($_SESSION['role'] === 'user'): ?>
                    <li><a href="konsultasi.php">Konsultasi</a></li>

                <?php elseif ($_SESSION['role'] === 'admin'): ?>                   
                    <li><a href="../crud/data_pengguna.php">CRUD Admin</a></li>

                <?php elseif ($_SESSION['role'] === 'konsultan'): ?>
                    <li><a href="chat_konsultan.php">Pesan Masuk</a></li>
                <?php endif; ?>

                <?php else: ?>
                    <!-- Jika belum login -->
                    <li><a href="projek_ukl.php">Beranda</a></li>
                    <li><a href="informasi.php">Informasi</a></li>
                    <li><a href="panduan.php">Panduan</a></li>
                    <li><a href="konsultasi.php">Konsultasi</a></li>
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

<!-- ===== KONTEN KONSULTASI ===== -->
<section class="konsultasi-container section-padding">
    <h2>Layanan Konsultasi Pertanian</h2>

    <p>
        Selamat datang di fitur <strong>Konsultasi TaniPintar</strong>! Di sini, kamu bisa terhubung langsung 
        dengan para konsultan pertanian yang berpengalaman dan siap membantu kamu kapan saja.
    </p>

    <p>
        🔍 Bingung memilih jenis tanaman yang cocok di musim ini?  
        <br>
        🐛 Mengalami serangan hama dan butuh solusi cepat?
        <br>
        🌾 Ingin tahu teknik tanam modern yang bisa meningkatkan hasil panenmu?
    </p>

    <p>
        Yuk, manfaatkan layanan konsultasi ini! Kamu bisa bertanya secara langsung dan berdiskusi 
        lewat fitur chat interaktif yang telah kami siapkan.
    </p>

    <p><strong>Fitur Konsultasi TaniPintar mencakup:</strong></p>
    <ul>
        <li>💬 Chat dua arah dengan konsultan pilihanmu</li>
        <li>🧠 Rekomendasi teknik bertani sesuai kondisi lahanmu</li>
        <li>🌱 Saran pemilihan bibit, pupuk, dan pengendalian hama</li>
        <li>🗓️ Konsultasi kapan saja tanpa harus datang ke tempat</li>
    </ul>

    <p>
        Pilih konsultan sesuai bidang keahliannya, dan mulai bertanya!
    </p>

    <div style="text-align: center;">
        <a href="pilih_konsultan.php" class="konsultasi-btn">Pilih Konsultan Sekarang</a>
    </div>
</section>

<!-- ===== FOOTER ===== -->
<footer class="site-footer">
    <div class="footer-container">
        <div class="footer-column">
            <h3>TaniPintar</h3>
            <p>
                TaniPintar adalah platform pertanian digital yang mendukung petani Indonesia dengan informasi, panduan, dan konsultasi terpercaya.
            </p>
        </div>
        <div class="footer-column">
            <h4>Mengenai Kami</h4>
            <ul>
                <li><a href="#">Tentang TaniPintar</a></li>
                <li><a href="#">Visi & Misi</a></li>
                <li><a href="#">Tim Kami</a></li>
                <li><a href="#">Karir</a></li>
            </ul>
        </div>
        <div class="footer-column">
            <h4>Layanan</h4>
            <ul>
                <li><a href="projek_ukl.php">Beranda</a></li>
                <li><a href="informasi.php">Kalender Tanam</a></li>
                <li><a href="panduan.php">Panduan Bertani</a></li>
                <li><a href="konsultasi.php">Konsultasi Ahli</a></li>
            </ul>
        </div>
        <div class="footer-column">
            <h4>Kontak Kami</h4>
            <p>Email: <a href="mailto:petani@tanipintar.id">petani@tanipintar.id</a></p>
            <p>Telepon: (+62) 123-4567-8765</p>
            <p>Alamat: Jl. Pertanian Pintar No. 123, Atlantis</p>
        </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2025 TaniPintar. Semua hak dilindungi.</p>
        </div>
</footer>

</body>
</html>