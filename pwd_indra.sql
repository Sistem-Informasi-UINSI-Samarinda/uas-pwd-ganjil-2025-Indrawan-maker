-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 20, 2025 at 12:19 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pwd_indra`
--

-- --------------------------------------------------------

--
-- Table structure for table `jenis_roti`
--

CREATE TABLE `jenis_roti` (
  `id_jenis` int NOT NULL,
  `nama_jenis` varchar(80) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `jenis_roti`
--

INSERT INTO `jenis_roti` (`id_jenis`, `nama_jenis`, `created_at`) VALUES
(1, 'Roti Manis', '2025-12-20 11:44:18'),
(2, 'Roti Isi', '2025-12-20 11:44:34'),
(3, 'ice cream', '2025-12-20 11:45:14'),
(4, 'booba', '2025-12-20 11:45:22'),
(5, 'coffe', '2025-12-20 12:06:54'),
(6, 'tea', '2025-12-20 12:06:59');

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan`
--

CREATE TABLE `kegiatan` (
  `id_kegiatan` int NOT NULL,
  `judul_kegiatan` varchar(180) NOT NULL,
  `isi_kegiatan` text NOT NULL,
  `foto_kegiatan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kegiatan`
--

INSERT INTO `kegiatan` (`id_kegiatan`, `judul_kegiatan`, `isi_kegiatan`, `foto_kegiatan`) VALUES
(3, 'Rotiku Berbagi untuk Anak Bangsa', '\r\nDalam rangka merayakan Hari Anak, Rotiku  menghadirkan program berbagi kebahagiaan dengan membagikan roti gratis kepada anak-anak di sekolah. Kegiatan ini menjadi wujud kepedulian Rotiku  dalam mendukung tumbuh kembang anak Indonesia dengan cara yang hangat dan menyenangkan. Melalui momen kecil yang penuh senyum, Rotiku  ingin menjadi bagian dari masa kecil yang manis dan berkesan.\r\n', '6946894ce2798_kegiatan1.png'),
(4, ' Rotiku  Berbagi untuk Pahlawan Kesehatan', 'Sebagai bentuk apresiasi dan dukungan kepada dokter serta tenaga kesehatan yang selalu berada di garis depan dalam menjaga kesehatan masyarakat, Rotiku  mengadakan program pembagian roti gratis di Hari Dokter. Melalui kegiatan ini, Rotiku  percaya bahwa perhatian sederhana bisa memberikan dampak besar bagi pahlawan kesehatan kita.\r\n', '69468b96b7992_kegiatan2.png');

-- --------------------------------------------------------

--
-- Table structure for table `promo`
--

CREATE TABLE `promo` (
  `id_promo` int NOT NULL,
  `video_promo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `promo`
--

INSERT INTO `promo` (`id_promo`, `video_promo`) VALUES
(2, '694688227bd57_video4.mp4'),
(3, '6946882be1a8a_video3.mp4'),
(4, '6946883cdf2c6_video2.mp4');

-- --------------------------------------------------------

--
-- Table structure for table `roti`
--

CREATE TABLE `roti` (
  `id_roti` int NOT NULL,
  `id_jenis` int NOT NULL,
  `nama_roti` varchar(180) NOT NULL,
  `deskripsi_roti` text NOT NULL,
  `foto_roti` varchar(255) NOT NULL,
  `tanggal_produksi` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `roti`
--

INSERT INTO `roti` (`id_roti`, `id_jenis`, `nama_roti`, `deskripsi_roti`, `foto_roti`, `tanggal_produksi`) VALUES
(1, 3, 'ice cream cone', 'Es krim vanila-cokelat lembut dalam cone renyah.', '69468d9173876_icecreamcone.png', '2025-12-01'),
(2, 4, 'RAINBOW BOBA SUNDAE', 'Perpaduan sempurna es krim dan boba untuk momen yang lebih spesial', '69468f340c2fb_rainbowbobasundae.png', '2025-12-02'),
(3, 3, 'ROTIO ICE CREAM MIX VANILLA CHOCOLATE', 'Dua rasa favorit, vanila dan coklat dalam satu gigitan.', '69468f51ed44a_rotiku-ice-cream-mix-vanilla-chocolate.png', '2025-12-02'),
(4, 1, 'CHOCOLATE PASTRY', 'Pastry berlapis dengan coklat manis yang menggoda.', '694690c904967_chocolate_pastry.png', '2025-12-03'),
(5, 2, 'MARTABAK CROISSANT', 'Croissant isi cokelat dan keju, gurih manis.', '694690ed42ef9_martabak_croissant.png', '2025-12-04'),
(6, 1, 'CROMBO', 'Croissant cokelat premium dengan taburan sprinkle manis.', '694691459b7b2_crombo.png', '2025-12-04'),
(7, 6, 'ICE LYCHEE TEA', 'Teh dingin segar dengan rasa leci yang manis alami', '6946917bd45ce_icelycheetea.png', '2025-12-21'),
(8, 5, 'CHCOCOLATE BROWN SUGAR', 'Manis lembut, coklat kuat.', '6946919e760d0_chocobrownsugar.png', '2025-12-14'),
(9, 5, 'BUTTERSCOTCH LATTE', 'Lembut, manis, dan bikin nagih di setiap tegukan!', '694691b82ab0c_butterscotchlatte.png', '2025-12-13');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(180) NOT NULL,
  `email` varchar(180) NOT NULL,
  `password` varchar(180) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `nama_lengkap`) VALUES
(1, 'admin', 'admin@admin.com', '$2y$10$/6ednH/YQKEV2FtavxviQ./HvusYT1v43fgiLbqCuDUIUzyJ/0VRG', 'administrator');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jenis_roti`
--
ALTER TABLE `jenis_roti`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indexes for table `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD PRIMARY KEY (`id_kegiatan`);

--
-- Indexes for table `promo`
--
ALTER TABLE `promo`
  ADD PRIMARY KEY (`id_promo`);

--
-- Indexes for table `roti`
--
ALTER TABLE `roti`
  ADD PRIMARY KEY (`id_roti`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jenis_roti`
--
ALTER TABLE `jenis_roti`
  MODIFY `id_jenis` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `kegiatan`
--
ALTER TABLE `kegiatan`
  MODIFY `id_kegiatan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `promo`
--
ALTER TABLE `promo`
  MODIFY `id_promo` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `roti`
--
ALTER TABLE `roti`
  MODIFY `id_roti` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
