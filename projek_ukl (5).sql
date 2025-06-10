-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 10, 2025 at 03:51 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projek_ukl`
--

-- --------------------------------------------------------

--
-- Table structure for table `chat_konsultasi`
--

CREATE TABLE `chat_konsultasi` (
  `id_chat` int(11) NOT NULL,
  `id_konsultasi` int(11) NOT NULL,
  `pengirim` enum('pengguna','konsultan') NOT NULL,
  `isi_pesan` text NOT NULL,
  `waktu_kirim` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chat_konsultasi`
--

INSERT INTO `chat_konsultasi` (`id_chat`, `id_konsultasi`, `pengirim`, `isi_pesan`, `waktu_kirim`) VALUES
(8, 2, 'pengguna', 'hai', '2025-06-08 22:04:22'),
(9, 4, 'pengguna', 'haloo', '2025-06-09 16:53:20'),
(10, 4, 'konsultan', 'yey', '2025-06-09 17:15:50'),
(11, 4, 'pengguna', 'haloo', '2025-06-09 17:17:54'),
(12, 4, 'konsultan', 'yey', '2025-06-09 17:17:59'),
(13, 4, 'konsultan', 'yey', '2025-06-09 17:18:16'),
(14, 6, 'pengguna', 'aku son', '2025-06-10 10:01:52');

-- --------------------------------------------------------

--
-- Table structure for table `kalender_tanam`
--

CREATE TABLE `kalender_tanam` (
  `id_kalender` int(11) NOT NULL,
  `nama_tanaman` varchar(100) NOT NULL,
  `musim` enum('Hujan','Kemarau') NOT NULL,
  `nama_bulan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `konsultan`
--

CREATE TABLE `konsultan` (
  `id_konsultan` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `keahlian` varchar(20) NOT NULL,
  `id_pengguna` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `konsultan`
--

INSERT INTO `konsultan` (`id_konsultan`, `nama`, `email`, `keahlian`, `id_pengguna`) VALUES
(2, 'Pak Konsul', 'panji@gmail.com', 'Padi dan Jagung', 15),
(3, '', '', 'Padi dan Jagung', 16),
(4, '', '', 'nanem', 17);

-- --------------------------------------------------------

--
-- Table structure for table `konsultasi`
--

CREATE TABLE `konsultasi` (
  `id_konsultasi` int(11) NOT NULL,
  `id_pengguna` int(11) NOT NULL,
  `id_konsultan` int(11) NOT NULL,
  `tanggal_konsultasi` datetime DEFAULT current_timestamp(),
  `pertanyaan` text NOT NULL,
  `jawaban` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `konsultasi`
--

INSERT INTO `konsultasi` (`id_konsultasi`, `id_pengguna`, `id_konsultan`, `tanggal_konsultasi`, `pertanyaan`, `jawaban`) VALUES
(2, 14, 2, '2025-06-08 22:04:18', '-', NULL),
(3, 2, 2, '2025-06-09 15:50:56', '-', NULL),
(4, 17, 4, '2025-06-09 16:53:17', '-', NULL),
(5, 21, 2, '2025-06-10 10:01:40', '-', NULL),
(6, 21, 3, '2025-06-10 10:01:46', '-', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `panduan_bertani`
--

CREATE TABLE `panduan_bertani` (
  `id_panduan` int(11) NOT NULL,
  `tanaman_yang_ditanam` varchar(25) NOT NULL,
  `cara_tanam` varchar(700) NOT NULL,
  `id_tanaman` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id_pengguna` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `role` varchar(20) DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id_pengguna`, `username`, `email`, `password`, `alamat`, `role`) VALUES
(2, 'barii', 'bar@gmail.com', '$2y$10$n2XzvQxqqjv/MEPHVGXJru0RMLKZRjoqkJiNNAHdbLBcK2MzdXhna', 'jl. ahfbfb', 'admin'),
(6, 'sannddy', 'gamb@gmail.com', '', '', 'user'),
(9, 'sanken', 'sandy@gmail.com', '', '', 'user'),
(10, 'qwerty', 'qwert@gmail.com', '$2y$10$pQNXK2NPlNiKzEqd0YQGAeZjCz9R0fxi9JV/sA1Z5V/ZnRrLAD9s6', 'sondoy', 'user'),
(11, 'haha', 'ken@gmail.com', '$2y$10$tZ2zomviF1wLYKB3ESVi5OiMbW6JUnr8zfkguL0MEPlEx1jGu83GW', 'hsbdc', 'user'),
(12, 'faris', 'brahma@gmail.com', '$2y$10$ZUFCwuAaPSAsQEIz8KJwHOuV8hNOeMugr0lqzXykBFLYGNZ6mPJ2m', 'msn', 'user'),
(13, 'sakib', 'sakib@gmail.com', '1', 'sekardangan', 'user'),
(14, 'son', 'son@gmail.com', '$2y$10$AQtcVN1Zo4Wb76E/p9MF1OiKU4SxZUmWuEBM9EMyEAIUGId6APccq', 'gedangan', 'user'),
(15, 'pakKonsul', 'panji@gmail.com', '1', 'Bangah', 'konsultan'),
(16, 'sandyy', 'xaa@gmail.com', '$2y$10$qbQRUPF1XDbjo9QA.tC1P.rT.ABf56I8kHybCxlFcdWZTv4d6l/16', 'gedangan', 'konsultan'),
(17, 'sanoken', 'n@gmail.com', '1', 'bungur', 'konsultan'),
(18, 'zaza', 'za@gmail.com', '1', 'buduran', 'user'),
(20, 'kak', 'ka@gmail.com', '2', 'wqq', 'user'),
(21, 'hrs', 'hr@gmail.com', '1', 'hai', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `tanaman`
--

CREATE TABLE `tanaman` (
  `id_tanaman` int(11) NOT NULL,
  `nama_tanaman` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chat_konsultasi`
--
ALTER TABLE `chat_konsultasi`
  ADD PRIMARY KEY (`id_chat`),
  ADD KEY `id_konsultasi` (`id_konsultasi`);

--
-- Indexes for table `kalender_tanam`
--
ALTER TABLE `kalender_tanam`
  ADD PRIMARY KEY (`id_kalender`);

--
-- Indexes for table `konsultan`
--
ALTER TABLE `konsultan`
  ADD PRIMARY KEY (`id_konsultan`),
  ADD KEY `fk_konsultan_user` (`id_pengguna`);

--
-- Indexes for table `konsultasi`
--
ALTER TABLE `konsultasi`
  ADD PRIMARY KEY (`id_konsultasi`),
  ADD KEY `fk_pengguna` (`id_pengguna`),
  ADD KEY `fk_konsultan` (`id_konsultan`);

--
-- Indexes for table `panduan_bertani`
--
ALTER TABLE `panduan_bertani`
  ADD PRIMARY KEY (`id_panduan`),
  ADD KEY `fk_panduan_tanaman` (`id_tanaman`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id_pengguna`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `tanaman`
--
ALTER TABLE `tanaman`
  ADD PRIMARY KEY (`id_tanaman`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chat_konsultasi`
--
ALTER TABLE `chat_konsultasi`
  MODIFY `id_chat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `kalender_tanam`
--
ALTER TABLE `kalender_tanam`
  MODIFY `id_kalender` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `konsultan`
--
ALTER TABLE `konsultan`
  MODIFY `id_konsultan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `konsultasi`
--
ALTER TABLE `konsultasi`
  MODIFY `id_konsultasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `panduan_bertani`
--
ALTER TABLE `panduan_bertani`
  MODIFY `id_panduan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tanaman`
--
ALTER TABLE `tanaman`
  MODIFY `id_tanaman` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chat_konsultasi`
--
ALTER TABLE `chat_konsultasi`
  ADD CONSTRAINT `chat_konsultasi_ibfk_1` FOREIGN KEY (`id_konsultasi`) REFERENCES `konsultasi` (`id_konsultasi`) ON DELETE CASCADE;

--
-- Constraints for table `konsultan`
--
ALTER TABLE `konsultan`
  ADD CONSTRAINT `fk_konsultan_user` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id_pengguna`) ON DELETE CASCADE;

--
-- Constraints for table `konsultasi`
--
ALTER TABLE `konsultasi`
  ADD CONSTRAINT `fk_konsultan` FOREIGN KEY (`id_konsultan`) REFERENCES `konsultan` (`id_konsultan`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_pengguna` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id_pengguna`) ON DELETE CASCADE;

--
-- Constraints for table `panduan_bertani`
--
ALTER TABLE `panduan_bertani`
  ADD CONSTRAINT `fk_panduan_tanaman` FOREIGN KEY (`id_tanaman`) REFERENCES `tanaman` (`id_tanaman`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
