-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 08, 2026 at 03:14 AM
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
-- Database: `sehatyuk`
--

-- --------------------------------------------------------

--
-- Table structure for table `tips`
--

CREATE TABLE `tips` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `isi` text NOT NULL,
  `tanggal_post` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tips`
--

INSERT INTO `tips` (`id`, `judul`, `isi`, `tanggal_post`) VALUES
(1, '7 Kebiasaan Pagi yang Bikin Hidup Lebih Sehat', 'Memulai hari dengan kebiasaan sehat dapat memberikan energi positif sepanjang hari. Beberapa kebiasaan yang bisa Anda coba adalah: bangun lebih awal, minum air putih sebelum melakukan aktivitas lain, melakukan peregangan ringan atau olahraga ringan, sarapan bergizi, dan meditasi atau afirmasi positif. Tidak hanya bermanfaat untuk tubuh, tapi juga untuk kesehatan mental Anda.', '2025-07-24 03:33:49'),
(2, 'Manfaat Jalan Kaki 30 Menit Setiap Hari', 'Berjalan kaki selama 30 menit setiap hari dapat meningkatkan kesehatan jantung, menurunkan tekanan darah, memperkuat tulang, dan membantu menurunkan berat badan. Selain itu, jalan kaki di pagi hari juga dapat membantu meningkatkan mood dan mengurangi stres. Aktivitas ringan ini bisa menjadi rutinitas yang menyenangkan jika dilakukan sambil mendengarkan musik atau podcast favorit.', '2025-07-24 03:33:49'),
(3, 'Pentingnya Tidur Cukup untuk Imunitas Tubuh', 'Tidur yang cukup dan berkualitas sangat penting untuk menjaga daya tahan tubuh. Selama tidur, tubuh memperbaiki sel-sel yang rusak dan memproduksi hormon penting. Kurang tidur bisa membuat sistem imun melemah dan meningkatkan risiko terkena penyakit. Usahakan tidur 7-9 jam setiap malam dan hindari penggunaan gadget sebelum tidur.', '2025-07-24 03:33:49'),
(4, 'Mengapa Sarapan Tidak Boleh Dilewatkan?', 'Sarapan adalah waktu makan paling penting karena memberikan energi untuk memulai hari. Melewatkan sarapan dapat membuat Anda mudah lapar dan cenderung makan berlebihan di siang hari. Pilih makanan tinggi serat dan protein seperti oatmeal, telur, atau buah-buahan segar agar kenyang lebih lama dan tetap berenergi.', '2025-07-24 03:33:49'),
(5, 'Tips Mengatur Pola Makan Sehat di Tengah Kesibukan', 'Dalam rutinitas yang padat, seringkali kita lupa menjaga pola makan. Beberapa tips yang bisa diterapkan adalah: siapkan bekal dari rumah, buat jadwal makan yang teratur, konsumsi makanan segar dan minim olahan, serta hindari camilan berkalori tinggi. Makan dengan porsi kecil namun sering juga bisa membantu menjaga energi tetap stabil.', '2025-07-24 03:33:49'),
(6, 'Olahraga Ringan yang Bisa Dilakukan di Rumah', 'Tidak punya waktu ke gym? Tidak masalah. Anda bisa mencoba olahraga ringan seperti yoga, push up, sit up, lompat tali, atau bahkan menari di rumah. Lakukan minimal 15-30 menit setiap hari untuk menjaga kebugaran. Gunakan video tutorial dari internet untuk panduan gerakan agar tidak membosankan.', '2025-07-24 03:33:49'),
(7, 'Minum Air Putih yang Cukup, Ini Alasannya!', 'Air merupakan komponen utama tubuh kita. Minum air putih yang cukup membantu menjaga suhu tubuh, melancarkan pencernaan, dan membuang racun dari tubuh. Kebutuhan air setiap orang berbeda, namun secara umum disarankan minum 8 gelas atau sekitar 2 liter per hari. Bawalah botol minum kemanapun Anda pergi sebagai pengingat.', '2025-07-24 03:33:49'),
(8, 'Cara Mengelola Stres dengan Teknik Relaksasi Sederhana', 'Stres yang tidak ditangani dengan baik bisa berdampak buruk bagi kesehatan fisik dan mental. Cobalah teknik relaksasi seperti pernapasan dalam, meditasi mindfulness, mendengarkan musik tenang, atau menulis jurnal harian. Luangkan waktu 10-15 menit sehari untuk menenangkan pikiran dan mengurangi ketegangan otot.', '2025-07-24 03:33:49'),
(9, 'Kenali Makanan Superfood dan Manfaatnya', 'Superfood adalah makanan yang kaya nutrisi dan memberikan manfaat luar biasa bagi tubuh. Contohnya adalah blueberry, brokoli, salmon, alpukat, dan biji chia. Superfood mengandung antioksidan, vitamin, dan mineral yang dapat meningkatkan kekebalan tubuh, menjaga kesehatan jantung, dan menurunkan risiko penyakit kronis.', '2025-07-24 03:33:49'),
(10, 'Update! WHO Anjurkan Lebih Banyak Aktivitas Fisik di Tengah Pandemi', 'Organisasi Kesehatan Dunia (WHO) kembali menegaskan pentingnya aktivitas fisik, terutama di masa pandemi. Menurut pedoman terbaru, orang dewasa disarankan melakukan aktivitas fisik sedang hingga berat selama minimal 150 menit per minggu. Aktivitas ini mencakup olahraga, berjalan cepat, naik turun tangga, atau bahkan berkebun di rumah.', '2025-07-24 03:33:49');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`) VALUES
(3, 'Maulana K', 'maulanak@mailnesia.com', '$2b$10$Nr/QxSBSYN1nLApcnRu2YOEqneIraJCD5IeXXrFWn6LmU.LCQamVK', 'user'),
(4, 'Swasono', 'swasono@mailnesia.com', '$2b$10$jO/FA2vaZkGtdH8MUjtX8u4mlDoVbWOYNE2LBbqwDG6.Q06h22.gS', 'user'),
(5, 'Kamu', 'kamu@mailnesia.com', '$2b$10$ICAuywmo5N3HF//pkCSkLeNyWYGjD6GY1WRmJTp7Mjr6.yX.ia8x2', 'user'),
(6, 'Admin', 'admin@gmail.com', '$2b$10$ffg9dp1G0tafJWpriz.8R.lU9XAkv0D98i05cwxo/IBPSwDz4YPdi', 'admin'),
(7, 'hana', 'hana@mailnesia.com', '$2b$10$OnDvpnKHDvtF3kb4viKQpedPk18iic7F0pNiCLqTKR88d31QlfThW', 'user'),
(8, 'Swasono Adi', 'swasono@gmail.com', '$2b$10$Yq/TR2bilmSYla5BxewzzONEwCH9hv71cQbYBa/7iFHna0e42pJYK', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tips`
--
ALTER TABLE `tips`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tips`
--
ALTER TABLE `tips`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
