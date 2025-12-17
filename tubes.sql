-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2025 at 06:51 AM
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
-- Database: `tubes`
--

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

CREATE TABLE `akun` (
  `id_akun` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` enum('guest','customer','admin','supplier','kasir','dapur') NOT NULL DEFAULT 'customer',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_premium` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`id_akun`, `email`, `username`, `password`, `status`, `created_at`, `is_premium`) VALUES
(1, 'daffaumayans2007@gmail.com', 'daffa', '$2y$10$/HD0piiYU2UVhICBXCgLFuQeSeOX/T7YvnTTQ.8fS8osQO7q1kK26', 'customer', '2025-12-15 07:12:21', 1),
(2, 'daffa7@gmail.com', 'daffa2', '$2y$10$kOQw4lG6eS4mIqAss8.PceDBtmplLJ9p8qeyZmFwz7Zydn/H.rH1a', 'customer', '2025-12-15 07:44:16', 1),
(3, 'sina@gmail.com', 'sina', '$2y$10$ygvq7mqerasbZ.GsWTQ94u3zbwyrOc6kSxqq.b6Z6PtlMdw2O3Sua', 'customer', '2025-12-15 09:23:50', 0),
(4, '', 'guest1', '', 'guest', '2025-12-16 09:44:47', 0),
(5, 'admin123@gmail.com', 'admin', '$2y$10$GydVlCmgmCTd7/i2.z2HOezGoTSVrL87rl3VSdPQS4Ccm0RNFUvvW', 'admin', '2025-12-16 10:43:21', 0),
(6, 'nadin@gmail.com', 'nadin', '$2y$10$P7o2SzlfpS6SA4lV/InPF.9U.xdJDfh6B65zmdAio4hxSxUGFIIg2', 'customer', '2025-12-16 12:06:46', 0),
(11, 'guest2@guest.local', 'guest2', '', 'guest', '2025-12-16 14:24:52', 0);

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id_detail` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `no_meja` int(11) DEFAULT NULL,
  `jumlah` int(11) NOT NULL,
  `catatan` text DEFAULT NULL,
  `harga_satuan` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`id_detail`, `id_transaksi`, `id_menu`, `no_meja`, `jumlah`, `catatan`, `harga_satuan`, `subtotal`) VALUES
(19, 22, 27, 4, 3, 'halo', 15000.00, 45000.00),
(20, 22, 2, 4, 4, '', 45000.00, 180000.00),
(21, 23, 27, 7, 5, 'halo', 15000.00, 75000.00),
(22, 23, 5, 7, 3, '', 120000.00, 360000.00),
(23, 24, 27, 4, 4, 'wokeh\n', 15000.00, 60000.00),
(24, 24, 5, 4, 2, '', 120000.00, 240000.00),
(25, 25, 27, 5, 5, 'p\n', 15000.00, 75000.00),
(26, 25, 5, 5, 2, '', 120000.00, 240000.00),
(27, 26, 27, 5, 4, 'looping', 15000.00, 60000.00),
(28, 26, 5, 5, 2, '', 120000.00, 240000.00),
(29, 27, 25, 5, 3, 'test', 25000.00, 75000.00),
(30, 27, 27, 5, 3, '', 15000.00, 45000.00),
(31, 28, 27, 2, 4, '3', 15000.00, 60000.00),
(32, 28, 5, 2, 3, '', 120000.00, 360000.00),
(33, 29, 5, 5, 4, 'halo', 120000.00, 480000.00),
(34, 29, 27, 5, 3, '', 15000.00, 45000.00),
(35, 30, 36, 23, 5, '', 9500.00, 47500.00),
(36, 30, 34, 23, 6, '', 9000.00, 54000.00),
(37, 31, 5, 6, 2, '', 120000.00, 240000.00),
(38, 32, 27, 6, 1, '', 15000.00, 15000.00),
(39, 33, 27, 12, 3, '', 15000.00, 45000.00),
(40, 33, 5, 12, 2, '', 120000.00, 240000.00),
(41, 34, 27, 7, 1, 'haloo', 15000.00, 15000.00),
(42, 34, 5, 7, 6, '', 120000.00, 720000.00),
(43, 35, 27, 123, 4, 'diameter jari jari roti nya harus 18', 15000.00, 60000.00),
(44, 35, 5, 123, 12, 'acar nya harus 2', 120000.00, 1440000.00),
(45, 36, 27, 100, 5, '', 15000.00, 75000.00),
(46, 36, 30, 100, 1, 'halo', 7000.00, 7000.00),
(47, 37, 27, 45, 3, '', 15000.00, 45000.00),
(48, 38, 27, 5, 5, 'halooo', 15000.00, 75000.00),
(49, 38, 26, 5, 2, '', 32000.00, 64000.00),
(50, 39, 27, 5, 3, '', 15000.00, 45000.00),
(51, 39, 26, 5, 3, 'haloo', 32000.00, 96000.00);

-- --------------------------------------------------------

--
-- Table structure for table `kelola_pesanan`
--

CREATE TABLE `kelola_pesanan` (
  `id_pesanan` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `no_meja` int(11) NOT NULL,
  `item` text NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('PENDING','COOKING','READY','SERVED') NOT NULL DEFAULT 'PENDING'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kelola_pesanan`
--

INSERT INTO `kelola_pesanan` (`id_pesanan`, `id_transaksi`, `no_meja`, `item`, `waktu`, `status`) VALUES
(1, 23, 7, '5x Kelp Burger, 3x Krabby Patty', '2025-12-16 00:00:45', 'SERVED'),
(2, 24, 4, '4x Kelp Burger, 2x Krabby Patty', '2025-12-16 08:56:57', 'SERVED'),
(3, 25, 5, '5x Kelp Burger, 2x Krabby Patty', '2025-12-16 09:01:56', 'SERVED'),
(4, 25, 5, '5x Kelp Burger, 2x Krabby Patty', '2025-12-16 09:02:22', 'PENDING'),
(5, 26, 5, '4x Kelp Burger, 2x Krabby Patty', '2025-12-16 09:03:35', 'COOKING'),
(6, 27, 5, '3x Double Krabby Patty, 3x Kelp Burger', '2025-12-16 09:12:38', 'SERVED'),
(7, 28, 2, '4x Kelp Burger, 3x Krabby Patty', '2025-12-16 09:45:49', 'COOKING'),
(8, 29, 5, '4x Krabby Patty, 3x Kelp Burger', '2025-12-16 11:03:21', 'SERVED'),
(9, 33, 12, '3x Kelp Burger, 2x Krabby Patty', '2025-12-16 13:34:07', 'SERVED'),
(10, 34, 7, '1x Kelp Burger, 6x Krabby Patty', '2025-12-16 13:44:38', 'SERVED'),
(11, 35, 123, '4x Kelp Burger, 12x Krabby Patty', '2025-12-16 13:50:26', 'COOKING'),
(12, 36, 100, '5x Kelp Burger, 1x Coral Bits', '2025-12-16 13:52:37', 'COOKING'),
(13, 37, 45, '3x Kelp Burger', '2025-12-16 14:25:05', 'COOKING'),
(14, 38, 5, '5x Kelp Burger, 2x Triple Krabby Supreme', '2025-12-17 05:27:21', 'COOKING'),
(15, 39, 5, '3x Kelp Burger, 3x Triple Krabby Supreme', '2025-12-17 05:40:41', 'COOKING');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id_menu` int(11) NOT NULL,
  `nama_menu` varchar(100) NOT NULL,
  `tipe` enum('MAIN_COURSE','APPETIZER','DRINK','DESSERT') NOT NULL,
  `harga_menu` decimal(10,2) NOT NULL,
  `jumlah_stock` int(11) NOT NULL DEFAULT 0,
  `is_aktif` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id_menu`, `nama_menu`, `tipe`, `harga_menu`, `jumlah_stock`, `is_aktif`, `created_at`) VALUES
(2, 'Krusty Krab Pizza', 'MAIN_COURSE', 45000.00, 80, 1, '2025-12-15 05:30:32'),
(3, 'Krusty Krab Hot', 'MAIN_COURSE', 20000.00, 100, 1, '2025-12-15 05:30:32'),
(4, 'Krusty Shake', 'DRINK', 18000.00, 200, 1, '2025-12-15 05:30:32'),
(5, 'Krabby Patty', 'MAIN_COURSE', 120000.00, 0, 1, '2025-12-15 16:19:17'),
(25, 'Double Krabby Patty', 'MAIN_COURSE', 25000.00, 0, 1, '2025-12-15 16:29:36'),
(26, 'Triple Krabby Supreme', 'MAIN_COURSE', 32000.00, 0, 1, '2025-12-15 16:29:36'),
(27, 'Kelp Burger', 'MAIN_COURSE', 15000.00, 0, 1, '2025-12-15 16:29:36'),
(28, 'Kelp Fries', 'APPETIZER', 8000.00, 0, 1, '2025-12-15 16:29:36'),
(29, 'Salty Sea Dog', 'APPETIZER', 12000.00, 0, 1, '2025-12-15 16:29:36'),
(30, 'Coral Bits', 'APPETIZER', 7000.00, 0, 1, '2025-12-15 16:29:36'),
(31, 'Seaweed Nuggets', 'APPETIZER', 9000.00, 0, 1, '2025-12-15 16:29:36'),
(32, 'Barnacle Bites', 'APPETIZER', 8500.00, 0, 1, '2025-12-15 16:29:36'),
(33, 'Kelp Shake', 'DRINK', 10000.00, 0, 1, '2025-12-15 16:29:36'),
(34, 'Seafoam Soda', 'DRINK', 9000.00, 0, 1, '2025-12-15 16:29:36'),
(35, 'Bubble Bass Juice', 'DRINK', 11000.00, 0, 1, '2025-12-15 16:29:36'),
(36, 'Ocean Blue Lemonade', 'DRINK', 9500.00, 0, 1, '2025-12-15 16:29:36'),
(37, 'Jellyfish Juice', 'DRINK', 12000.00, 0, 1, '2025-12-15 16:29:36'),
(38, 'Jellyfish Jelly', 'DESSERT', 7000.00, 0, 1, '2025-12-15 16:29:36'),
(39, 'Kelp Cookie', 'DESSERT', 6000.00, 0, 1, '2025-12-15 16:29:36'),
(40, 'Sea Star Sundae', 'DESSERT', 13000.00, 0, 1, '2025-12-15 16:29:36'),
(41, 'Coral Cake', 'DESSERT', 15000.00, 0, 1, '2025-12-15 16:29:36'),
(42, 'Bubble Berry Pie', 'DESSERT', 14000.00, 0, 1, '2025-12-15 16:29:36');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_akun` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `kode_transaksi` varchar(30) NOT NULL,
  `total_belanja` decimal(10,2) NOT NULL DEFAULT 0.00,
  `status_transaksi` enum('PENDING','SELESAI','BATAL') NOT NULL DEFAULT 'PENDING',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_akun`, `username`, `kode_transaksi`, `total_belanja`, `status_transaksi`, `created_at`) VALUES
(22, 1, 'daffa', 'TRX-20251215-235959', 225000.00, 'SELESAI', '2025-12-15 22:59:59'),
(23, 1, 'daffa', 'TRX-20251216-010045', 435000.00, 'SELESAI', '2025-12-16 00:00:45'),
(24, 3, 'sina', 'TRX-20251216-095657', 300000.00, 'SELESAI', '2025-12-16 08:56:57'),
(25, 2, 'daffa2', 'TRX-20251216-100156', 315000.00, 'SELESAI', '2025-12-16 09:01:56'),
(26, 2, 'daffa2', 'TRX-20251216-100335', 300000.00, 'PENDING', '2025-12-16 09:03:35'),
(27, 2, 'daffa2', 'TRX-20251216-101137', 120000.00, 'SELESAI', '2025-12-16 09:11:37'),
(28, 4, 'guest1', 'TRX-20251216-104525', 420000.00, 'SELESAI', '2025-12-16 09:45:25'),
(29, 3, 'sina', 'TRX-20251216-120319', 525000.00, 'SELESAI', '2025-12-16 11:03:19'),
(30, 6, 'nadin', 'TRX-20251216-130800', 101500.00, 'PENDING', '2025-12-16 12:08:00'),
(31, 5, 'admin', 'TRX-20251216-132002', 240000.00, 'PENDING', '2025-12-16 12:20:02'),
(32, 5, 'admin', 'TRX-20251216-132026', 15000.00, 'PENDING', '2025-12-16 12:20:26'),
(33, 5, 'admin', 'TRX-20251216-143254', 285000.00, 'SELESAI', '2025-12-16 13:32:54'),
(34, 5, 'admin', 'TRX-20251216-144435', 735000.00, 'SELESAI', '2025-12-16 13:44:35'),
(35, 5, 'admin', 'TRX-20251216-145021', 1500000.00, 'SELESAI', '2025-12-16 13:50:21'),
(36, 3, 'sina', 'TRX-20251216-145236', 82000.00, 'SELESAI', '2025-12-16 13:52:36'),
(37, 11, 'guest2', 'TRX-20251216-152503', 45000.00, 'SELESAI', '2025-12-16 14:25:03'),
(38, 3, 'sina', 'TRX-20251217-062719', 139000.00, 'SELESAI', '2025-12-17 05:27:19'),
(39, 3, 'sina', 'TRX-20251217-064039', 141000.00, 'SELESAI', '2025-12-17 05:40:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`id_akun`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `fk_detail_transaksi` (`id_transaksi`),
  ADD KEY `fk_detail_menu` (`id_menu`);

--
-- Indexes for table `kelola_pesanan`
--
ALTER TABLE `kelola_pesanan`
  ADD PRIMARY KEY (`id_pesanan`),
  ADD KEY `fk_kelola_transaksi` (`id_transaksi`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`),
  ADD UNIQUE KEY `nama_menu` (`nama_menu`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD UNIQUE KEY `kode_transaksi` (`kode_transaksi`),
  ADD KEY `fk_transaksi_akun` (`id_akun`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akun`
--
ALTER TABLE `akun`
  MODIFY `id_akun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `kelola_pesanan`
--
ALTER TABLE `kelola_pesanan`
  MODIFY `id_pesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD CONSTRAINT `fk_detail_menu` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id_menu`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_detail_transaksi` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kelola_pesanan`
--
ALTER TABLE `kelola_pesanan`
  ADD CONSTRAINT `fk_kelola_transaksi` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `fk_transaksi_akun` FOREIGN KEY (`id_akun`) REFERENCES `akun` (`id_akun`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
