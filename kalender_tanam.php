<?php
session_start();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalender Tanam - TaniPintar</title>
    <link rel="stylesheet" href="kalender_tanam.css">
</head>
<body>

<!-- Header -->
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
    <h2>Informasi Tentang TaniPintar</h2>
    <p>
        TaniPintar adalah platform pertanian digital yang hadir untuk membantu para petani dan masyarakat yang ingin memulai bertani. Kami memberikan berbagai informasi penting mengenai musim tanam, teknik bertani yang lebih efisien, serta konsultasi langsung dengan para ahli di bidang pertanian.
    </p>
    <p>
        Melalui platform ini, kami bertujuan untuk meningkatkan hasil pertanian dan mempermudah akses informasi bagi petani di Indonesia, dengan tujuan utama untuk mencapai pertanian yang lebih modern, efisien, dan berkelanjutan.
    </p>
    <p>
        Selain itu, TaniPintar juga menawarkan fitur kalender tanam yang akan membantu petani mengetahui kapan waktu terbaik untuk menanam berbagai jenis tanaman sesuai dengan musim. Fitur ini sangat penting untuk memaksimalkan hasil panen dengan menggunakan waktu yang tepat.
    </p>
    
    <div class="row">
        <div class="column">
            <h3>Manfaat TaniPintar</h3>
            <ul>
                <li>Membantu menentukan tanaman yang tepat untuk musim tertentu</li>
                <li>Panduan bertani dengan teknik terbaru dan ramah lingkungan</li>
                <li>Akses ke konsultasi dengan ahli pertanian berlisensi</li>
                <li>Mempermudah petani dalam berbagi pengalaman dengan komunitas</li>
            </ul>
        </div>
        <div class="column">
            <h3>Fitur Utama</h3>
            <ul>
                <li>Kalender Tanam dengan informasi musim tanam terbaru</li>
                <li>Panduan bertani berdasarkan jenis tanaman</li>
                <li>Konsultasi langsung dengan konsultan ahli pertanian</li>
                <li>Forum komunitas untuk berbagi pengalaman dan tips bertani</li>
            </ul>
        </div>
    </div>

    <h2>Kalender Tanam</h2>
    <p>Berikut adalah kalender tanam untuk beberapa tanaman yang dapat ditanam pada setiap bulan.</p>

    <!-- Tabel Kalender Tanam -->
    <table>
        <thead>
            <tr>
                <th>Bulan</th>
                <th>Tanaman</th>
                <th>Musim Tanam</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Januari</td>
                <td>Padi, Jagung, Kacang Tanah</td>
                <td>Musim hujan</td>
            </tr>
            <tr>
                <td>Februari</td>
                <td>Padi, Jagung, Kacang Tanah</td>
                <td>Musim hujan</td>
            </tr>
            <tr>
                <td>Maret</td>
                <td>Padi, Jagung, Cabai</td>
                <td>Musim hujan</td>
            </tr>
            <tr>
                <td>April</td>
                <td>Padi, Jagung, Tomat</td>
                <td>Musim kemarau</td>
            </tr>
            <tr>
                <td>Mei</td>
                <td>Cabai, Terong, Timun</td>
                <td>Musim kemarau</td>
            </tr>
            <tr>
                <td>Juni</td>
                <td>Cabai, Terong, Timun</td>
                <td>Musim kemarau</td>
            </tr>
            <tr>
                <td>Juli</td>
                <td>Padi, Kacang Tanah</td>
                <td>Musim kemarau</td>
            </tr>
            <tr>
                <td>Agustus</td>
                <td>Padi, Kacang Tanah</td>
                <td>Musim kemarau</td>
            </tr>
            <tr>
                <td>September</td>
                <td>Cabai, Tomat, Timun</td>
                <td>Musim hujan</td>
            </tr>
            <tr>
                <td>Oktober</td>
                <td>Cabai, Tomat, Timun</td>
                <td>Musim hujan</td>
            </tr>
            <tr>
                <td>November</td>
                <td>Padi, Kacang Tanah, Jagung</td>
                <td>Musim hujan</td>
            </tr>
            <tr>
                <td>Desember</td>
                <td>Padi, Kacang Tanah, Jagung</td>
                <td>Musim hujan</td>
            </tr>
        </tbody>
    </table>
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
