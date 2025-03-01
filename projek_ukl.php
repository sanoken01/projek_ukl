<?php
session_start();
if (isset($_SESSION['user_id'])) {
    session_regenerate_id(true); // Menghindari session fixation
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaniPintar - Halaman Utama</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<!-- Navbar -->
<header>
    <nav>
         <ul>
            <li><a href="projek_ukl.php">Home</a></li>
            <li><a href="kalender_tanam.php">Informasi</a></li>
            <li><a href="panduan.php">Panduan</a></li>
            <li><a href="konsultasi.php">Konsultasi</a></li>

            <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                <li><a href="admin.php">Admin Panel</a></li>
            <?php endif; ?>

            <?php if (isset($_SESSION['user_id'])): ?>
                <li><a href="profil.php">Profil</a></li>
                <li><a href="logout.php">Logout</a></li>
             <?php else: ?>
                <li><a href="login.php">Login</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>

<!-- Konten Utama -->
<section class="content">
    <!-- Bagian 1: Teks di Kiri, Gambar di Kanan -->
    <div class="row">
        <div class="text">
            <h2>Apa Itu TaniPintar?</h2>
            <p>
                TaniPintar adalah platform pertanian digital yang membantu petani dan penghobi pertanian 
                dalam mendapatkan informasi terkini mengenai musim tanam, teknik bertani, serta konsultasi langsung dengan ahli pertanian.
            </p>
        </div>
        <div class="image">
            <img src="petani1.jpg" alt="Seorang petani sedang menggarap sawah dengan teknik modern">
        </div>
    </div>

    <!-- Bagian 2: Teks di Kanan, Gambar di Kiri -->
    <div class="row reverse">
        <div class="image">
            <img src="gambar2.jpg" alt="Teknik bertani modern">
        </div>
        <div class="text">
            <h2>Apa yang Bisa Kamu Lakukan?</h2>
            <p>
                - Mengetahui tanaman apa yang cocok untuk ditanam setiap musim.<br>
                - Membaca panduan bertani yang mudah dipahami.<br>
                - Bertanya langsung kepada ahli pertanian.<br>
                - Bergabung dengan komunitas petani untuk berbagi pengalaman.
            </p>
        </div>
    </div>

    <!-- Bagian 3: Teks di Tengah, Gambar di Bawah -->
    <?php if (!isset($_SESSION['user_id'])): ?>
        <div class="center-text">
            <h2>Bergabung dengan Kami</h2>
            <p> Ayo tingkatkan hasil pertanianmu dengan informasi yang lebih akurat dan teknik bertani yang lebih baik.
                Daftar sekarang dan mulai perjalananmu di dunia pertanian modern!
            </p>
            <a href="daftar.php" class="cta-btn">Yuk Daftar Sekarang</a>
        </div>
    <?php endif; ?>
</section>

<!-- Footer -->
<footer>
    <div class="footer-content">
        <h3>TaniPintar</h3>
        <p>Email: petani@tanipintar.id</p>
        <p>Telepon: (+62) 123-4567-8765</p>
        <p>Alamat: Jl. Pertanian Pintar No. 123, Atlantis</p>
        <div class="social-links">
            <a href="#">Facebook</a>
            <a href="#">Instagram</a>
            <a href="#">WhatsApp</a>
        </div>
    </div>
</footer>

</body>
</html>
