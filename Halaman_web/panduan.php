<?php
session_start();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panduan Bertani - TaniPintar</title>
    <link rel="stylesheet" href="../css/main.css">
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

<section class="panduan-container">
    <h2>Panduan Bertani</h2>
    <p>Selamat datang di halaman Panduan Bertani TaniPintar! Kami menyediakan panduan lengkap dan terstruktur untuk menanam berbagai jenis tanaman dengan pendekatan modern. Teknologi pertanian masa kini seperti irigasi tetes otomatis, sensor kelembaban tanah, pemupukan terjadwal dengan sistem digital, dan aplikasi pencatat pertumbuhan tanaman dapat meningkatkan efisiensi dan hasil panen. Panduan ini cocok bagi pemula maupun petani berpengalaman yang ingin meningkatkan hasil tanam dengan cara yang lebih cerdas dan terencana.</p>

    <label for="plant-select">Pilih tanaman:</label>
    <select id="plant-select" onchange="showGuide()">
        <option value="">-- Pilih Tanaman --</option>
        <option value="padi">Padi</option>
        <option value="cabai">Cabai</option>
        <option value="tomat">Tomat</option>
        <option value="jagung">Jagung</option>
        <option value="kangkung">Kangkung</option>
        <option value="bayam">Bayam</option>
        <option value="selada">Selada</option>
        <option value="terong">Terong</option>
    </select>

    <div id="padi" class="plant-guide">
        <h3>Panduan Menanam Padi</h3>
        <ol>
            <li>Analisis tanah dengan alat uji pH dan kelembaban.</li>
            <li>Gunakan benih unggul bersertifikasi dan rendam 24 jam.</li>
            <li>Gunakan drone pertanian untuk menyemai secara merata jika memungkinkan.</li>
            <li>Pindahkan bibit ke lahan utama setelah 20-25 hari.</li>
            <li>Pasang irigasi otomatis untuk pengairan efisien.</li>
            <li>Lakukan pemupukan berbasis jadwal menggunakan aplikasi pencatat tanaman.</li>
            <li>Panen ketika bulir sudah menguning 90%.</li>
        </ol>
    </div>

    <div id="cabai" class="plant-guide">
        <h3>Panduan Menanam Cabai</h3>
        <ol>
            <li>Gunakan media tanam yang kaya unsur hara, bisa juga dalam sistem hidroponik.</li>
            <li>Semai benih dalam tray semai selama 3-4 minggu.</li>
            <li>Tanam di polybag atau lahan dengan jarak tanam yang tepat.</li>
            <li>Gunakan sensor tanah untuk memastikan kelembaban optimal.</li>
            <li>Pupuk organik cair bisa ditambahkan setiap 2 minggu.</li>
            <li>Gunakan aplikasi pencatat hama jika ditemukan gejala serangan.</li>
            <li>Panen ketika buah berwarna merah cerah.</li>
        </ol>
    </div>

    <div id="tomat" class="plant-guide">
        <h3>Panduan Menanam Tomat</h3>
        <ol>
            <li>Pilih varietas tomat sesuai musim dan iklim lokal.</li>
            <li>Gunakan lampu UV untuk pembibitan agar tumbuh optimal di indoor.</li>
            <li>Pindahkan ke tanah terbuka atau greenhouse setelah 2-3 minggu.</li>
            <li>Gunakan sistem fertigasi (pupuk + irigasi) untuk efisiensi nutrisi.</li>
            <li>Ajir digunakan untuk menopang batang tomat.</li>
            <li>Panen setelah 60-80 hari saat buah matang sempurna.</li>
        </ol>
    </div>

    <div id="jagung" class="plant-guide">
        <h3>Panduan Menanam Jagung</h3>
        <ol>
            <li>Siapkan bedengan dan pastikan tanah cukup unsur hara NPK.</li>
            <li>Tanam langsung benih jagung dengan alat tanam otomatis jika tersedia.</li>
            <li>Gunakan penyiram otomatis atau drip irrigation.</li>
            <li>Lakukan pemupukan sesuai fase pertumbuhan menggunakan aplikasi monitoring.</li>
            <li>Panen saat tongkol penuh dan kulit kering.</li>
        </ol>
    </div>

    <div id="kangkung" class="plant-guide">
        <h3>Panduan Menanam Kangkung</h3>
        <ol>
            <li>Kangkung dapat ditanam di lahan maupun sistem hidroponik NFT.</li>
            <li>Gunakan benih kering dan tanam langsung ke media tanam basah.</li>
            <li>Siram setiap hari dan gunakan larutan nutrisi hidroponik jika perlu.</li>
            <li>Panen dalam waktu 25-30 hari setelah tanam.</li>
        </ol>
    </div>

    <div id="bayam" class="plant-guide">
        <h3>Panduan Menanam Bayam</h3>
        <ol>
            <li>Gunakan tanah gembur dan cukup sinar matahari.</li>
            <li>Tabur benih langsung dan sirami secara rutin.</li>
            <li>Dapat menggunakan sistem vertikultur di pekarangan rumah.</li>
            <li>Panen saat daun muda sudah cukup besar (20-30 hari).</li>
        </ol>
    </div>

    <div id="selada" class="plant-guide">
        <h3>Panduan Menanam Selada</h3>
        <ol>
            <li>Tanam dengan metode hidroponik rakit apung atau DFT.</li>
            <li>Semai terlebih dahulu selama 10-14 hari.</li>
            <li>Pindah ke sistem hidroponik dan jaga nutrisi stabil.</li>
            <li>Gunakan aplikasi pencatat TDS & pH air.</li>
            <li>Panen saat daun besar dan rapat (30-40 hari).</li>
        </ol>
    </div>

    <div id="terong" class="plant-guide">
        <h3>Panduan Menanam Terong</h3>
        <ol>
            <li>Siapkan tanah gembur kaya nutrisi, atau gunakan polybag besar.</li>
            <li>Semai benih selama 3 minggu, lalu pindahkan ke media tanam.</li>
            <li>Gunakan pupuk kandang dan NPK, serta penyiram otomatis.</li>
            <li>Panen setelah 70-90 hari saat buah mengkilap dan padat.</li>
        </ol>
    </div>
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