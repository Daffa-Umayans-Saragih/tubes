-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 16, 2025 at 12:14 AM
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
  `status` enum('admin','customer','membership','supplier') NOT NULL DEFAULT 'customer',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_premium` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`id_akun`, `email`, `username`, `password`, `status`, `created_at`, `is_premium`) VALUES
(1, 'daffaumayans2007@gmail.com', 'daffa', '$2y$10$/HD0piiYU2UVhICBXCgLFuQeSeOX/T7YvnTTQ.8fS8osQO7q1kK26', 'customer', '2025-12-15 07:12:21', 1),
(2, 'daffa7@gmail.com', 'daffa2', '$2y$10$kOQw4lG6eS4mIqAss8.PceDBtmplLJ9p8qeyZmFwz7Zydn/H.rH1a', 'customer', '2025-12-15 07:44:16', 1),
(3, 'sina@gmail.com', 'sina', '$2y$10$ygvq7mqerasbZ.GsWTQ94u3zbwyrOc6kSxqq.b6Z6PtlMdw2O3Sua', 'customer', '2025-12-15 09:23:50', 0);

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
(20, 22, 2, 4, 4, '', 45000.00, 180000.00);

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
(22, 1, 'daffa', 'TRX-20251215-235959', 225000.00, 'SELESAI', '2025-12-15 22:59:59');

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
  MODIFY `id_akun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

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
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `fk_transaksi_akun` FOREIGN KEY (`id_akun`) REFERENCES `akun` (`id_akun`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
