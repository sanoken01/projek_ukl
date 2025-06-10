<?php
session_start();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>TaniPintar - Halaman Utama</title>
    <link rel="stylesheet" href="../css/main.css"/>
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

<section class="content">
    <div class="row">
        <div class="text">
            <h2>Apa Itu TaniPintar?</h2>
            <p>
                TaniPintar adalah platform pertanian digital yang membantu petani serta yang memiliki hobi pertanian 
                untuk mendapatkan informasi terkini mengenai musim tanam, teknik bertani, serta konsultasi langsung dengan ahli pertanian.
            </p>
        </div>
        <div class="image">
            <img src="../petani1.jpg" alt="petani di sawaah le" />
        </div>
    </div>

    <div class="row reverse">
        <div class="image">
            <img src="../gambar2.jpg" alt="petani lagi" />
        </div>
        <div class="text">
            <h2>Apa yang Bisa Kamu Lakukan?</h2>
            <p>
                - Mengetahui tanaman apa yang cocok untuk ditanam setiap bulan.<br />
                - Membaca panduan bertani yang mudah dipahami.<br />
                - Bertanya langsung kepada yang ahli pertanian.<br />
            </p>
        </div>
    </div>

    <?php if (!isset($_SESSION['user_id'])): ?>
        <div class="center-text">
            <h2>Bergabung dengan Kami</h2>
            <p>
                Ayo tingkatkan hasil pertanianmu dengan informasi yang lebih akurat dan teknik bertani yang lebih baik.
                Daftar sekarang dan mulai perjalananmu di dunia pertanian modern!
            </p>
            <a href="../register.php" class="cta-btn">Yuk Daftar Sekarang</a>
        </div>
    <?php endif; ?>
</section>

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