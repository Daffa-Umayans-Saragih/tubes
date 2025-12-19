-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Des 2025 pada 13.12
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

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
-- Struktur dari tabel `akun`
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
-- Dumping data untuk tabel `akun`
--

INSERT INTO `akun` (`id_akun`, `email`, `username`, `password`, `status`, `created_at`, `is_premium`) VALUES
(1, 'daffaumayans2007@gmail.com', 'daffa', '$2y$10$/HD0piiYU2UVhICBXCgLFuQeSeOX/T7YvnTTQ.8fS8osQO7q1kK26', 'customer', '2025-12-15 07:12:21', 1),
(2, 'daffa7@gmail.com', 'daffa2', '$2y$10$kOQw4lG6eS4mIqAss8.PceDBtmplLJ9p8qeyZmFwz7Zydn/H.rH1a', 'customer', '2025-12-15 07:44:16', 1),
(3, 'sina@gmail.com', 'sina', '$2y$10$ygvq7mqerasbZ.GsWTQ94u3zbwyrOc6kSxqq.b6Z6PtlMdw2O3Sua', 'customer', '2025-12-15 09:23:50', 1),
(4, '', 'guest1', '', 'guest', '2025-12-16 09:44:47', 0),
(5, 'admin123@gmail.com', 'admin', '$2y$10$GydVlCmgmCTd7/i2.z2HOezGoTSVrL87rl3VSdPQS4Ccm0RNFUvvW', 'admin', '2025-12-16 10:43:21', 1),
(6, 'nadin@gmail.com', 'nadin', '$2y$10$P7o2SzlfpS6SA4lV/InPF.9U.xdJDfh6B65zmdAio4hxSxUGFIIg2', 'customer', '2025-12-16 12:06:46', 0),
(11, 'guest2@guest.local', 'guest2', '', 'guest', '2025-12-16 14:24:52', 0),
(12, 'jelitacantik@gmail.com', 'jelita', '$2y$10$60WZCxKBEplE4gIuGqOv1.gAgCamjvNOxyc.6eG.9UOnZNjrOaAnu', 'customer', '2025-12-17 07:31:08', 1),
(13, 'guest3@guest.local', 'guest3', '', 'guest', '2025-12-17 07:37:30', 1),
(14, '1@gmail.com', '1', '$2y$10$cJ0enxwDe1rOoPuEyuZZ1eY9vaV65TzR65.eIG6rASpqp6H3QxM96', 'customer', '2025-12-17 07:38:35', 1),
(15, '2@gmail.com', '2', '$2y$10$VaGsCqjdOzAijNHu0ftXbuDQFLc6RwrTht6Fa2PyjkwcQ2npt7qLy', 'customer', '2025-12-17 07:42:47', 1),
(16, 'guest4@guest.local', 'guest4', '', 'guest', '2025-12-17 07:43:42', 0),
(17, '3@gmail.com', '3', '$2y$10$9kMTavRhu9QE.r5IYaVWV.w1SL3CosCmfufPodkKuPh/5/ExD3H7C', 'customer', '2025-12-17 07:44:03', 1),
(18, 'guest5@guest.local', 'guest5', '', 'guest', '2025-12-17 10:14:28', 0),
(19, '10@gmail.com', '10', '$2y$10$fp/o.D30p7EenJiLp9Zac.96mlkdvKOmMGfOY9/eFmsY5YW2kHuue', 'customer', '2025-12-17 10:19:59', 1),
(20, '11@gmail.com', '11', '$2y$10$oUXX/qedNFAvdcHTjLTIseJMxIxqXfqi9eIrS8ttIWylmuWavHQgm', 'customer', '2025-12-17 10:31:25', 1),
(21, '12@gmail.com', '12', '$2y$10$VS0Qqq.rugUUqs6LTW4VfOzmGHkY3ZO06FylJVNkpenTYRlSQtOia', 'customer', '2025-12-17 10:52:25', 0),
(22, 'kasir@gmail.com', 'kasir', '$2y$10$26fGvFzGmMjQDl4FW5H6DOpIaHJp0y8qpwq0LJ7LEKXmQHe4KDXli', 'kasir', '2025-12-17 23:49:58', 0),
(23, 'dapur@gmail.com', 'dapur', '$2y$10$LOdLloC2r/B57ITCep8I9erDg.Wf7nFjYpcvJF31y7WkHZvFZoyxe', 'dapur', '2025-12-17 23:50:31', 0),
(24, 'supplier@gmail.com', 'supplier', '$2y$10$Xve9SruUP3WhdueTmsgAY.IHBL36.2f/X3PUILWzogQEdSPLOtmey', 'supplier', '2025-12-17 23:51:06', 0),
(25, '13@gmail.com', '13', '$2y$10$P.hntAS9EewcN.pUXGEBleTZE/vUVAkXfXjmlliSMu5hTaE1zsIyW', 'customer', '2025-12-19 02:56:18', 0),
(26, 'guest6@guest.local', 'guest6', '', 'guest', '2025-12-19 04:21:19', 0),
(27, 'guest7@guest.local', 'guest7', '', 'guest', '2025-12-19 05:55:26', 0),
(28, 'guest8@guest.local', 'guest8', '', 'guest', '2025-12-19 06:02:14', 0),
(29, 'guest9@guest.local', 'guest9', '', 'guest', '2025-12-19 06:02:54', 0),
(30, 'guest10@guest.local', 'guest10', '', 'guest', '2025-12-19 06:02:56', 0),
(31, 'guest11@guest.local', 'guest11', '', 'guest', '2025-12-19 06:02:57', 0),
(32, 'guest12@guest.local', 'guest12', '', 'guest', '2025-12-19 06:02:57', 0),
(33, 'guest13@guest.local', 'guest13', '', 'guest', '2025-12-19 06:02:57', 0),
(34, 'guest14@guest.local', 'guest14', '', 'guest', '2025-12-19 06:02:57', 0),
(35, 'guest15@guest.local', 'guest15', '', 'guest', '2025-12-19 06:02:57', 0),
(36, 'guest16@guest.local', 'guest16', '', 'guest', '2025-12-19 06:02:57', 0),
(51, 'guest17@guest.local', 'guest17', '', 'guest', '2025-12-19 06:24:15', 0),
(52, 'guest18@guest.local', 'guest18', '', 'guest', '2025-12-19 06:25:57', 0),
(53, 'guest19@guest.local', 'guest19', '', 'guest', '2025-12-19 06:35:59', 0),
(54, 'guest20@guest.local', 'guest20', '', 'guest', '2025-12-19 06:42:50', 0),
(55, 'guest21@guest.local', 'guest21', '', 'guest', '2025-12-19 06:53:43', 0),
(56, 'guest22@guest.local', 'guest22', '', 'guest', '2025-12-19 06:58:20', 0),
(57, 'guest23@guest.local', 'guest23', '', 'guest', '2025-12-19 10:19:01', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_transaksi`
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
-- Dumping data untuk tabel `detail_transaksi`
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
(51, 39, 26, 5, 3, 'haloo', 32000.00, 96000.00),
(52, 40, 5, 12, 3, 'halo', 120000.00, 360000.00),
(53, 40, 27, 12, 3, '', 15000.00, 45000.00),
(54, 41, 27, 98, 4, '', 15000.00, 60000.00),
(55, 42, 37, 111, 9, '', 12000.00, 108000.00),
(56, 42, 38, 111, 7, '', 7000.00, 49000.00),
(57, 43, 5, 8, 1, '', 120000.00, 120000.00),
(58, 44, 26, 9, 1, '', 32000.00, 32000.00),
(59, 45, 5, 2, 3, 'BHITA\n', 120000.00, 360000.00),
(60, 45, 37, 2, 5, '', 12000.00, 60000.00),
(61, 46, 27, 18, 1, 'testt', 15000.00, 15000.00),
(62, 46, 42, 18, 7, '', 14000.00, 98000.00),
(63, 47, 5, 19, 1, '', 120000.00, 120000.00),
(64, 47, 41, 19, 5, 'okoko\n', 15000.00, 75000.00),
(65, 48, 5, 123, 1, '', 120000.00, 120000.00),
(66, 49, 36, 12, 1, '', 9500.00, 9500.00),
(67, 50, 5, 122, 1, '', 120000.00, 120000.00),
(68, 51, 27, 3, 1, '', 15000.00, 15000.00),
(69, 52, 41, 5, 1, '', 15000.00, 15000.00),
(71, 54, 5, 43, 1, '', 120000.00, 120000.00),
(73, 56, 27, 12, 1, '', 15000.00, 15000.00),
(74, 57, 27, 45, 1, '', 15000.00, 15000.00),
(75, 58, 25, 45, 1, '', 25000.00, 25000.00),
(76, 59, 27, 45, 1, '', 15000.00, 15000.00),
(78, 61, 5, 12, 1, '', 120000.00, 120000.00),
(79, 62, 5, 12, 1, '', 120000.00, 120000.00),
(80, 63, 5, 5, 1, '', 120000.00, 120000.00),
(81, 64, 27, 8, 2, '', 15000.00, 30000.00),
(82, 65, 4, 6, 1, '', 18000.00, 18000.00),
(83, 66, 5, 3, 3, '', 120000.00, 360000.00),
(84, 67, 5, 3, 2, '', 120000.00, 240000.00),
(86, 69, 5, 12, 3, '', 120000.00, 360000.00),
(87, 70, 5, 5, 3, '', 120000.00, 360000.00),
(88, 71, 5, 159, 3, 'wkkw', 120000.00, 360000.00),
(89, 71, 27, 159, 1, '', 15000.00, 15000.00),
(90, 72, 5, 12, 3, 'add', 120000.00, 360000.00),
(91, 72, 27, 12, 2, '', 15000.00, 30000.00),
(92, 73, 5, 145, 4, 'sasa', 120000.00, 480000.00),
(93, 74, 5, 145, 4, 'sasa', 120000.00, 480000.00),
(94, 74, 27, 145, 3, '', 15000.00, 45000.00),
(95, 75, 27, 145, 3, 'aaa', 15000.00, 45000.00),
(96, 76, 27, 12121, 3, '', 15000.00, 45000.00),
(97, 77, 27, 121, 3, '', 15000.00, 45000.00),
(98, 78, 25, 122, 2, '', 25000.00, 50000.00),
(99, 79, 26, 76, 4, 'hihljhl', 32000.00, 128000.00),
(100, 79, 2, 76, 2, '', 45000.00, 90000.00),
(101, 80, 5, 575, 1, 'j', 120000.00, 120000.00),
(102, 80, 27, 575, 2, '', 15000.00, 30000.00),
(103, 81, 26, 898, 2, 'ijnipnlj', 32000.00, 64000.00),
(104, 81, 3, 898, 1, 'bkjbjbkj', 20000.00, 20000.00),
(105, 82, 3, 66, 3, 'yggy', 20000.00, 60000.00),
(106, 82, 2, 66, 4, 'jhjuhu', 45000.00, 180000.00),
(107, 83, 25, 8668, 5, 'uhughg', 25000.00, 125000.00),
(108, 83, 3, 8668, 3, '', 20000.00, 60000.00),
(109, 84, 3, 65, 4, 'h.knj', 20000.00, 80000.00),
(110, 84, 2, 65, 1, 'n', 45000.00, 45000.00),
(111, 85, 2, 557, 3, 'jhygy', 45000.00, 135000.00),
(112, 85, 3, 557, 1, 'a', 20000.00, 20000.00),
(113, 86, 30, 86, 1, '3', 7000.00, 7000.00),
(114, 87, 30, 1331, 5, '', 7000.00, 35000.00),
(115, 88, 30, 98, 2, '', 7000.00, 14000.00),
(117, 90, 30, 12121, 6, '', 7000.00, 42000.00),
(118, 91, 30, 1221, 3, '', 7000.00, 21000.00),
(119, 92, 25, 434, 5, 'sdsdsd', 25000.00, 125000.00),
(120, 92, 3, 434, 1, 'xxcssc', 20000.00, 20000.00),
(121, 93, 26, 3, 1, 'ee', 32000.00, 32000.00),
(122, 94, 25, 12, 3, '', 25000.00, 75000.00),
(123, 95, 25, 6, 2, 'tses', 20500.00, 41000.00),
(124, 96, 25, 6, 2, '', 20500.00, 41000.00),
(125, 97, 3, 9, 3, 'jn', 16400.00, 49200.00);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelola_pesanan`
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
-- Dumping data untuk tabel `kelola_pesanan`
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
(14, 38, 5, '5x Kelp Burger, 2x Triple Krabby Supreme', '2025-12-17 05:27:21', 'SERVED'),
(15, 39, 5, '3x Kelp Burger, 3x Triple Krabby Supreme', '2025-12-17 05:40:41', 'SERVED'),
(16, 40, 12, '3x Krabby Patty, 3x Kelp Burger', '2025-12-17 06:46:11', 'SERVED'),
(17, 41, 98, '4x Kelp Burger', '2025-12-17 23:56:58', 'SERVED'),
(18, 42, 111, '9x Jellyfish Juice, 7x Jellyfish Jelly', '2025-12-18 20:41:40', 'COOKING'),
(19, 44, 9, '1x Triple Krabby Supreme', '2025-12-18 22:09:57', 'COOKING'),
(20, 45, 2, '3x Krabby Patty, 5x Jellyfish Juice', '2025-12-19 01:16:02', 'SERVED'),
(21, 46, 18, '1x Kelp Burger, 7x Bubble Berry Pie', '2025-12-19 01:49:19', 'SERVED'),
(22, 47, 19, '1x Krabby Patty, 5x Coral Cake', '2025-12-19 01:49:50', 'SERVED'),
(23, 48, 123, '1x Krabby Patty', '2025-12-19 02:13:45', 'SERVED'),
(24, 49, 12, '1x Ocean Blue Lemonade', '2025-12-19 02:14:11', 'SERVED'),
(25, 50, 122, '1x Krabby Patty', '2025-12-19 04:22:30', 'COOKING'),
(26, 51, 3, '1x Kelp Burger', '2025-12-19 04:24:16', 'COOKING'),
(27, 52, 5, '1x Coral Cake', '2025-12-19 05:09:01', 'COOKING'),
(28, 54, 43, '1x Krabby Patty', '2025-12-19 05:25:10', 'COOKING'),
(29, 62, 12, '1x Krabby Patty', '2025-12-19 06:49:29', 'COOKING'),
(30, 63, 5, '1x Krabby Patty', '2025-12-19 06:54:08', 'COOKING'),
(31, 64, 8, '2x Kelp Burger', '2025-12-19 06:58:31', 'COOKING'),
(32, 65, 6, '1x Krusty Shake', '2025-12-19 07:07:18', 'COOKING'),
(33, 75, 145, '3x Kelp Burger (aaa)', '2025-12-19 08:00:51', 'COOKING'),
(34, 78, 122, '2x Double Krabby Paty', '2025-12-19 08:04:23', 'COOKING'),
(35, 80, 575, '1x Krabby Patty (j), 2x Kelp Burger', '2025-12-19 08:17:09', 'COOKING'),
(36, 81, 898, '2x Triple Krabby Supreme (ijnipnlj), 1x Krusty Krab Hot (bkjbjbkj)', '2025-12-19 08:19:13', 'COOKING'),
(37, 82, 66, '3x Krusty Krab Hot (yggy), 4x Krusty Krab Pizza (jhjuhu)', '2025-12-19 08:20:02', 'COOKING'),
(38, 84, 65, '4x Krusty Krab Hot (h.knj), 1x Krusty Krab Pizza (n)', '2025-12-19 08:40:30', 'COOKING'),
(39, 85, 557, '3x Krusty Krab Pizza (jhygy), 1x Krusty Krab Hot (a)', '2025-12-19 08:41:02', 'COOKING'),
(40, 86, 86, '1x Coral Bits (3)', '2025-12-19 08:42:26', 'COOKING'),
(41, 88, 98, '2x Coral Bits', '2025-12-19 08:45:44', 'COOKING'),
(42, 92, 434, '5x Double Krabby Paty (sdsdsd), 1x Krusty Krab Hot (xxcssc)', '2025-12-19 09:08:26', 'COOKING'),
(43, 93, 3, '1x Triple Krabby Supreme (ee)', '2025-12-19 09:41:45', 'COOKING'),
(44, 94, 12, '3x Double Krabby Paty', '2025-12-19 09:46:12', 'COOKING'),
(45, 97, 9, '3x Krusty Krab Hot (jn)', '2025-12-19 10:12:03', 'SERVED');

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu`
--

CREATE TABLE `menu` (
  `id_menu` int(11) NOT NULL,
  `nama_menu` varchar(100) NOT NULL,
  `tipe` enum('MAIN_COURSE','APPETIZER','DRINK','DESSERT') NOT NULL,
  `harga_menu` decimal(10,2) NOT NULL,
  `jumlah_stock` int(11) NOT NULL DEFAULT 0,
  `is_aktif` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `menu`
--

INSERT INTO `menu` (`id_menu`, `nama_menu`, `tipe`, `harga_menu`, `jumlah_stock`, `is_aktif`, `created_at`, `gambar`) VALUES
(2, 'Krusty Krab Pizza', 'MAIN_COURSE', 45000.00, 72, 1, '2025-12-15 05:30:32', 'image/krusty krab pizza.jpeg'),
(3, 'Krusty Krab Hot', 'MAIN_COURSE', 20000.00, 87, 1, '2025-12-15 05:30:32', 'image/krusty krab hot.jpeg'),
(4, 'Krusty Shake', 'DRINK', 18000.00, 200, 1, '2025-12-15 05:30:32', 'image/krusty shake.jpeg'),
(5, 'Krabby Patty', 'MAIN_COURSE', 120000.00, 0, 1, '2025-12-15 16:19:17', 'image/Krabby_Patty_icon.webp\r\n\r\n'),
(25, 'Double Krabby Paty', 'MAIN_COURSE', 25000.00, 4, 1, '2025-12-15 16:29:36', NULL),
(26, 'Triple Krabby Supreme', 'MAIN_COURSE', 32000.00, 1, 1, '2025-12-15 16:29:36', 'image/triple krabby supreme.jpeg'),
(27, 'Kelp Burger', 'MAIN_COURSE', 15000.00, 4, 1, '2025-12-15 16:29:36', 'image/kelp burger.jpeg'),
(28, 'Kelp Fries', 'APPETIZER', 8000.00, 0, 1, '2025-12-15 16:29:36', 'image/kelp fries.jpeg'),
(29, 'Salty Sea Dog', 'APPETIZER', 12000.00, 0, 1, '2025-12-15 16:29:36', 'image/salty sea dog.jpeg'),
(30, 'Coral Bits', 'APPETIZER', 7000.00, 2, 1, '2025-12-15 16:29:36', 'image/coral bits.jpeg'),
(31, 'Seaweed Nuggets', 'APPETIZER', 9000.00, 0, 1, '2025-12-15 16:29:36', 'image/seaweed nuggets.jpeg'),
(32, 'Barnacle Bites', 'APPETIZER', 8500.00, 0, 1, '2025-12-15 16:29:36', 'image/barnacle bites.jpeg'),
(33, 'Kelp Shake', 'DRINK', 10000.00, 0, 1, '2025-12-15 16:29:36', 'image/kelp shake.jpeg'),
(34, 'Seafoam Soda', 'DRINK', 9000.00, 0, 1, '2025-12-15 16:29:36', 'image/seafoam soda.jpeg'),
(35, 'Bubble Bass Juice', 'DRINK', 11000.00, 0, 1, '2025-12-15 16:29:36', 'image/bubble bass juice.jpeg'),
(36, 'Ocean Blue Lemonade', 'DRINK', 9500.00, 0, 1, '2025-12-15 16:29:36', 'image/ocean blue lemonade.jpeg'),
(37, 'Jellyfish Juice', 'DRINK', 12000.00, 0, 1, '2025-12-15 16:29:36', 'image/jellyfish juice.jpeg'),
(38, 'Jellyfish Jelly', 'DESSERT', 7000.00, 0, 1, '2025-12-15 16:29:36', 'image/jellyfish jelly.jpeg'),
(39, 'Kelp Cookie', 'DESSERT', 6000.00, 0, 1, '2025-12-15 16:29:36', 'image/kelp cookie.jpeg'),
(40, 'Sea Star Sundae', 'DESSERT', 13000.00, 0, 1, '2025-12-15 16:29:36', 'image/sea star sundae.jpeg'),
(41, 'Coral Cake', 'DESSERT', 15000.00, 0, 1, '2025-12-15 16:29:36', 'image/coral cake.jpeg'),
(42, 'Bubble Berry Pie', 'DESSERT', 14000.00, 0, 1, '2025-12-15 16:29:36', 'image/bubble berry pie.jpeg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
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
-- Dumping data untuk tabel `transaksi`
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
(38, 3, 'sina', 'TRX-20251217-062719', 139000.00, 'SELESAI', '2025-12-22 05:27:19'),
(39, 3, 'sina', 'TRX-20251217-064039', 141000.00, 'SELESAI', '2025-12-17 05:40:39'),
(40, 3, 'sina', 'TRX-20251217-074608', 405000.00, 'SELESAI', '2025-12-17 06:46:08'),
(41, 14, '1', 'TRX-20251218-005655', 60000.00, 'SELESAI', '2025-12-17 23:56:55'),
(42, 21, '12', 'TRX-20251218-214138', 157000.00, 'SELESAI', '2025-12-18 20:41:38'),
(43, 5, 'admin', 'TRX-20251218-230722', 120000.00, 'PENDING', '2025-12-18 22:07:22'),
(44, 5, 'admin', 'TRX-20251218-230953', 32000.00, 'SELESAI', '2025-12-18 22:09:53'),
(45, 5, 'admin', 'TRX-20251219-021558', 420000.00, 'SELESAI', '2025-12-19 01:15:58'),
(46, 21, '12', 'TRX-20251219-024913', 113000.00, 'SELESAI', '2025-12-19 01:49:13'),
(47, 21, '12', 'TRX-20251219-024947', 195000.00, 'SELESAI', '2025-12-19 01:49:47'),
(48, 21, '12', 'TRX-20251219-031321', 120000.00, 'SELESAI', '2025-12-19 02:13:21'),
(49, 21, '12', 'TRX-20251219-031408', 9500.00, 'SELESAI', '2025-12-19 02:14:08'),
(50, 25, '13', 'TRX-20251219-052227', 120000.00, 'SELESAI', '2025-12-19 04:22:27'),
(51, 25, '13', 'TRX-20251219-052412', 15000.00, 'SELESAI', '2025-12-19 04:24:12'),
(52, 25, '13', 'TRX-20251219-060138', 15000.00, 'SELESAI', '2025-12-19 05:01:38'),
(54, 25, '13', 'TRX-20251219-062502', 120000.00, 'SELESAI', '2025-12-19 05:25:02'),
(56, 25, '13', 'TRX-20251219-062738', 15000.00, 'PENDING', '2025-12-19 05:27:38'),
(57, 25, '13', 'TRX-20251219-062957', 15000.00, 'PENDING', '2025-12-19 05:29:57'),
(58, 25, '13', 'TRX-20251219-063008', 25000.00, 'PENDING', '2025-12-19 05:30:08'),
(59, 25, '13', 'TRX-20251219-063613', 15000.00, 'PENDING', '2025-12-19 05:36:13'),
(61, 53, 'guest19', 'TRX-20251219-074919', 120000.00, 'PENDING', '2025-12-19 06:49:19'),
(62, 53, 'guest19', 'TRX-20251219-074924', 120000.00, 'SELESAI', '2025-12-19 06:49:24'),
(63, 55, 'guest21', 'TRX-20251219-075405', 120000.00, 'SELESAI', '2025-12-19 06:54:05'),
(64, 56, 'guest22', 'TRX-20251219-075828', 30000.00, 'SELESAI', '2025-12-19 06:58:28'),
(65, 56, 'guest22', 'TRX-20251219-080715', 18000.00, 'SELESAI', '2025-12-19 07:07:15'),
(66, 25, '13', 'TRX-20251219-081507', 360000.00, 'PENDING', '2025-12-19 07:15:07'),
(67, 25, '13', 'TRX-20251219-081538', 240000.00, 'PENDING', '2025-12-19 07:15:38'),
(69, 25, '13', 'TRX-20251219-081743', 360000.00, 'PENDING', '2025-12-19 07:17:43'),
(70, 25, '13', 'TRX-20251219-083830', 360000.00, 'SELESAI', '2025-12-19 07:38:30'),
(71, 25, '13', 'TRX-20251219-084509', 375000.00, 'PENDING', '2025-12-19 07:45:09'),
(72, 25, '13', 'TRX-20251219-085526', 390000.00, 'PENDING', '2025-12-19 07:55:26'),
(73, 25, '13', 'TRX-20251219-090036', 480000.00, 'PENDING', '2025-12-19 08:00:36'),
(74, 25, '13', 'TRX-20251219-090041', 525000.00, 'PENDING', '2025-12-19 08:00:41'),
(75, 25, '13', 'TRX-20251219-090047', 45000.00, 'SELESAI', '2025-12-19 08:00:47'),
(76, 25, '13', 'TRX-20251219-090132', 45000.00, 'PENDING', '2025-12-19 08:01:32'),
(77, 25, '13', 'TRX-20251219-090354', 45000.00, 'PENDING', '2025-12-19 08:03:54'),
(78, 25, '13', 'TRX-20251219-090420', 50000.00, 'SELESAI', '2025-12-19 08:04:20'),
(79, 25, '13', 'TRX-20251219-091620', 218000.00, 'PENDING', '2025-12-19 08:16:20'),
(80, 25, '13', 'TRX-20251219-091705', 150000.00, 'SELESAI', '2025-12-19 08:17:05'),
(81, 25, '13', 'TRX-20251219-091910', 84000.00, 'SELESAI', '2025-12-19 08:19:10'),
(82, 25, '13', 'TRX-20251219-092000', 240000.00, 'SELESAI', '2025-12-19 08:20:00'),
(83, 25, '13', 'TRX-20251219-092817', 185000.00, 'PENDING', '2025-12-19 08:28:17'),
(84, 25, '13', 'TRX-20251219-093803', 125000.00, 'SELESAI', '2025-12-19 08:38:03'),
(85, 25, '13', 'TRX-20251219-094059', 155000.00, 'SELESAI', '2025-12-19 08:40:59'),
(86, 25, '13', 'TRX-20251219-094224', 7000.00, 'SELESAI', '2025-12-19 08:42:24'),
(87, 25, '13', 'TRX-20251219-094444', 35000.00, 'PENDING', '2025-12-19 08:44:44'),
(88, 25, '13', 'TRX-20251219-094542', 14000.00, 'SELESAI', '2025-12-19 08:45:42'),
(90, 25, '13', 'TRX-20251219-095611', 42000.00, 'PENDING', '2025-12-19 08:56:11'),
(91, 25, '13', 'TRX-20251219-100746', 21000.00, 'PENDING', '2025-12-19 09:07:46'),
(92, 25, '13', 'TRX-20251219-100824', 145000.00, 'SELESAI', '2025-12-19 09:08:24'),
(93, 1, 'daffa', 'TRX-20251219-104141', 32000.00, 'SELESAI', '2025-12-19 09:41:41'),
(94, 1, 'daffa', 'TRX-20251219-104609', 75000.00, 'SELESAI', '2025-12-19 09:46:09'),
(95, 1, 'daffa', 'TRX-20251219-111101', 41000.00, 'PENDING', '2025-12-19 10:11:01'),
(96, 1, 'daffa', 'TRX-20251219-111135', 41000.00, 'PENDING', '2025-12-19 10:11:35'),
(97, 1, 'daffa', 'TRX-20251219-111201', 49200.00, 'SELESAI', '2025-12-19 10:12:01');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`id_akun`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indeks untuk tabel `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `fk_detail_transaksi` (`id_transaksi`),
  ADD KEY `fk_detail_menu` (`id_menu`);

--
-- Indeks untuk tabel `kelola_pesanan`
--
ALTER TABLE `kelola_pesanan`
  ADD PRIMARY KEY (`id_pesanan`),
  ADD KEY `fk_kelola_transaksi` (`id_transaksi`);

--
-- Indeks untuk tabel `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`),
  ADD UNIQUE KEY `nama_menu` (`nama_menu`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD UNIQUE KEY `kode_transaksi` (`kode_transaksi`),
  ADD KEY `fk_transaksi_akun` (`id_akun`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `akun`
--
ALTER TABLE `akun`
  MODIFY `id_akun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT untuk tabel `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT untuk tabel `kelola_pesanan`
--
ALTER TABLE `kelola_pesanan`
  MODIFY `id_pesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT untuk tabel `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD CONSTRAINT `fk_detail_menu` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id_menu`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_detail_transaksi` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kelola_pesanan`
--
ALTER TABLE `kelola_pesanan`
  ADD CONSTRAINT `fk_kelola_transaksi` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `fk_transaksi_akun` FOREIGN KEY (`id_akun`) REFERENCES `akun` (`id_akun`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
