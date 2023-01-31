-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 31, 2023 at 05:29 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pwpb_pelaporan_pengaduan_masyarakat`
--

-- --------------------------------------------------------

--
-- Table structure for table `masyarakat`
--

CREATE TABLE `masyarakat` (
  `id` int(11) NOT NULL,
  `nik` char(16) NOT NULL,
  `nama` varchar(35) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(32) NOT NULL,
  `telepon` varchar(13) NOT NULL,
  `dibuat` timestamp NOT NULL DEFAULT current_timestamp(),
  `diubah` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `dihapus` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `masyarakat`
--

INSERT INTO `masyarakat` (`id`, `nik`, `nama`, `username`, `password`, `telepon`, `dibuat`, `diubah`, `dihapus`) VALUES
(1, '1', 'Masyarakat 1', 'masyarakat1', '72ce908807f5f6426ad0e4100e7a7af6', '1', '2023-01-29 07:44:48', '2023-01-31 06:13:26', 0),
(2, '2', 'Masyarakat 2', 'masyarakat2', '22f7ee24d04366ef973c3ed933536fc8', '2', '2023-01-29 13:43:49', '2023-01-29 13:44:02', 0),
(3, '3', 'Masyarakat 3', 'masyarakat3', 'dd3947f50cd4ebe30a8083979f2b1072', '3', '2023-01-31 00:27:58', '2023-01-31 16:24:05', 0),
(4, '4', 'Masyarakat 4', 'masyarakat4', '60deeb75b00a121d6e947b728d308e40', '4', '2023-01-31 08:39:38', '2023-01-31 16:24:11', 0),
(5, '5', 'Masyarakat 5', 'masyarakat5', '15df3b45f6aa626192bad6f058646254', '5', '2023-01-31 08:40:46', '2023-01-31 16:24:14', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pengaduan`
--

CREATE TABLE `pengaduan` (
  `id` int(11) NOT NULL,
  `id_masyarakat` int(11) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `isi_pengaduan` text NOT NULL,
  `status` enum('belum direspon','ditolak','diproses','selesai') NOT NULL DEFAULT 'belum direspon',
  `dibuat` timestamp NOT NULL DEFAULT current_timestamp(),
  `diubah` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `dihapus` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `id` int(11) NOT NULL,
  `nama` varchar(35) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(32) NOT NULL,
  `telepon` varchar(32) NOT NULL,
  `level` enum('superadministrator','administrator','petugas') NOT NULL DEFAULT 'petugas',
  `status` enum('tidak aktif','aktif') NOT NULL DEFAULT 'tidak aktif',
  `dibuat` timestamp NOT NULL DEFAULT current_timestamp(),
  `diubah` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `dihapus` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id`, `nama`, `username`, `password`, `telepon`, `level`, `status`, `dibuat`, `diubah`, `dihapus`) VALUES
(1, 'Petugas 1', 'petugas1', 'b53fe7751b37e40ff34d012c7774d65f', '1', 'petugas', 'aktif', '2023-02-02 11:57:44', '2023-01-31 16:22:23', 0),
(2, 'Petugas 2', 'petugas2', 'ac5604a8b8504d4ff5b842480df02e91', '2', 'petugas', 'aktif', '2022-01-29 11:58:02', '2022-01-29 15:57:49', 0),
(3, 'Petugas 3', 'petugas3', '6f7dc121bccfd778744109cac9593474', '3', 'petugas', 'aktif', '2023-01-29 15:02:23', '2023-01-31 16:25:19', 0),
(4, 'Petugas 4', 'petugas4', '95c477e4932b3b16500674c18fb6f9a4', '4', 'petugas', 'aktif', '2023-01-29 15:03:08', '2023-01-31 16:25:24', 0),
(5, 'Petugas 5', 'petugas5', 'bd71eb9c0e0e5f21713f18bb58ec3f15', '5', 'petugas', 'aktif', '2023-01-29 15:03:55', '2023-01-31 16:25:28', 0),
(6, 'Petugas 6', 'petugas6', 'fe9954b9d78535aeb6a719a4c2e74a4b', '6', 'petugas', 'aktif', '2023-01-29 15:06:24', '2023-01-31 16:25:31', 0),
(7, 'Administrator 1', 'administrator1', 'd5cee333abe432891a0de57d0ee38713', '1', 'administrator', 'aktif', '2023-01-30 15:29:02', '2023-01-31 16:25:33', 0),
(8, 'Administrator 2', 'administrator2', '82954495ff7e2a735ed2192c35b2cd00', '2', 'administrator', 'aktif', '2023-01-30 15:29:18', '2023-01-31 16:25:36', 0),
(9, 'Superadministrator 1', 'superadministrator1', 'f8d21eb7697751fb4274efeea7880109', '1', 'superadministrator', 'aktif', '2023-01-30 15:30:18', '2023-01-31 16:28:03', 0),
(10, 'Superadministrator 2', 'superadministrator2', 'ba51b75987d08875e98382777afdbc5b', '2', 'superadministrator', 'aktif', '2023-01-30 15:29:56', '2023-01-31 16:28:06', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tanggapan`
--

CREATE TABLE `tanggapan` (
  `id` int(11) NOT NULL,
  `id_petugas` int(11) NOT NULL,
  `id_pengaduan` int(11) NOT NULL,
  `isi_tanggapan` text NOT NULL,
  `dibuat` timestamp NOT NULL DEFAULT current_timestamp(),
  `diubah` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `dihapus` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `masyarakat`
--
ALTER TABLE `masyarakat`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nik` (`nik`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `pengaduan`
--
ALTER TABLE `pengaduan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_id_masyarakat` (`id_masyarakat`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `tanggapan`
--
ALTER TABLE `tanggapan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_id_petugas` (`id_petugas`),
  ADD KEY `FK_id_pengaduan` (`id_pengaduan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `masyarakat`
--
ALTER TABLE `masyarakat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pengaduan`
--
ALTER TABLE `pengaduan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tanggapan`
--
ALTER TABLE `tanggapan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pengaduan`
--
ALTER TABLE `pengaduan`
  ADD CONSTRAINT `FK_id_masyarakat` FOREIGN KEY (`id_masyarakat`) REFERENCES `masyarakat` (`id`);

--
-- Constraints for table `tanggapan`
--
ALTER TABLE `tanggapan`
  ADD CONSTRAINT `FK_id_pengaduan` FOREIGN KEY (`id_pengaduan`) REFERENCES `pengaduan` (`id`),
  ADD CONSTRAINT `FK_id_petugas` FOREIGN KEY (`id_petugas`) REFERENCES `petugas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
