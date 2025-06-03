<?php
session_start();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panduan Bertani - TaniPintar</title>
    <link rel="stylesheet" href="../css/panduan.css">
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
                <li><a href="page-admin/admin.php">Admin Panel</a></li>
            <?php endif; ?>

            <?php if (isset($_SESSION['user_id'])): ?>
                <li><a href="../profil.php">Profil</a></li>
                <li><a href="../logout.php">Logout</a></li>
            <?php else: ?>
                <li><a href="../login.php">Login</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>

<!-- Konten -->
<section class="panduan-container">
    <h2>Panduan Bertani</h2>
    <p>Halaman Panduan di TaniPintar dibuat untuk membantu para petani dan pemula memahami cara bertani dengan lebih mudah, efisien, dan tepat sasaran.
    Di halaman ini, pengguna dapat memilih jenis tanaman yang ingin ditanam, kemudian melihat langkah-langkah menanam secara rinci sesuai dengan tanaman tersebut.
    Panduan mencakup berbagai aspek penting seperti:
    - Persiapan lahan dan benih,
    - Teknik penanaman yang benar,
    - Waktu pemupukan dan penyiraman,
    - Hingga waktu panen yang ideal.
    - Dengan adanya fitur ini, diharapkan setiap pengguna bisa memulai bercocok tanam dengan pengetahuan yang cukup dan hasil yang lebih baik.
    Silakan pilih tanaman yang ingin Anda tanam, lalu ikuti panduan langkah demi langkah yang tersedia.</p>

    <!-- Pilihan Tanaman -->
    <label for="plant-select">Pilih tanaman:</label>
    <select id="plant-select" onchange="showGuide()">
        <option value="">-- Pilih Tanaman --</option>
        <option value="padi">Padi</option>
        <option value="cabai">Cabai</option>
        <option value="tomat">Tomat</option>
        <option value="jagung">Jagung</option>
    </select>

    <!-- Panduan Tanam -->
    <div id="padi" class="plant-guide">
        <h3>Panduan Menanam Padi</h3>
        <ol>
            <li>Persiapkan lahan sawah dengan pengolahan tanah dan pengairan yang baik.</li>
            <li>Gunakan benih unggul dan rendam sebelum disemai.</li>
            <li>Pindahkan bibit setelah 20-25 hari ke lahan utama.</li>
            <li>Lakukan pemupukan dan pengairan teratur.</li>
            <li>Panen saat 90% bulir menguning.</li>
        </ol>
    </div>

    <div id="cabai" class="plant-guide">
        <h3>Panduan Menanam Cabai</h3>
        <ol>
            <li>Siapkan tanah gembur dan subur di lahan terbuka atau pot.</li>
            <li>Semai benih cabai selama 3-4 minggu.</li>
            <li>Pindahkan bibit ke lahan utama dengan jarak tanam 60 cm.</li>
            <li>Sirami setiap hari dan lakukan pemupukan setiap 2 minggu.</li>
            <li>Panen saat buah sudah berwarna merah cerah.</li>
        </ol>
    </div>

    <div id="tomat" class="plant-guide">
        <h3>Panduan Menanam Tomat</h3>
        <ol>
            <li>Pilih varietas tomat sesuai iklim setempat.</li>
            <li>Semai benih selama 2-3 minggu.</li>
            <li>Pindahkan ke lahan dengan jarak 50 cm.</li>
            <li>Berikan ajir (penyangga) agar batang tidak roboh.</li>
            <li>Panen setelah 60-80 hari atau saat buah berwarna merah merata.</li>
        </ol>
    </div>

    <div id="jagung" class="plant-guide">
        <h3>Panduan Menanam Jagung</h3>
        <ol>
            <li>Bajak tanah dan buat bedengan untuk menanam jagung.</li>
            <li>Tanam benih langsung di tanah sedalam 3-5 cm.</li>
            <li>Siram secara teratur, terutama saat masa pertumbuhan.</li>
            <li>Gunakan pupuk NPK dan pestisida alami jika perlu.</li>
            <li>Panen saat kulit jagung mengering dan biji keras.</li>
        </ol>
    </div>
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

<script>
function showGuide() {
    const guides = document.querySelectorAll(".plant-guide");
    guides.forEach(guide => guide.style.display = "none");

    const selected = document.getElementById("plant-select").value;
    if (selected) {
        document.getElementById(selected).style.display = "block";
    }
}
</script>

</body>
</html>