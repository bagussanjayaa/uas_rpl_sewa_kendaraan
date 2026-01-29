-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 25, 2026 at 10:30 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sewa_kendaraan`
--

-- --------------------------------------------------------

--
-- Table structure for table `kendaraan`
--

CREATE TABLE `kendaraan` (
  `id_kendaraan` int(11) NOT NULL,
  `nama_kendaraan` varchar(100) NOT NULL,
  `foto_kendaraan` varchar(255) DEFAULT NULL,
  `jenis` enum('Bus','Minibus','Motor') NOT NULL,
  `harga_sewa` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `status` enum('Tersedia','Disewa') DEFAULT 'Tersedia',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kendaraan`
--

INSERT INTO `kendaraan` (`id_kendaraan`, `nama_kendaraan`, `foto_kendaraan`, `jenis`, `harga_sewa`, `stok`, `status`, `created_at`) VALUES
(1, 'Bus Pariwisata A', 'bus1\r\n', 'Bus', 1500000, 5, 'Tersedia', '2026-01-16 09:52:51'),
(2, 'Bus Pariwisata B', 'bus2.jpg', 'Bus', 1400000, 0, 'Disewa', '2026-01-16 09:52:51'),
(3, 'Minibus Elf A', 'minibus1.webp', 'Minibus', 750000, 3, 'Tersedia', '2026-01-16 09:52:51'),
(4, 'Minibus Hiace', 'minibus2.webp', 'Minibus', 850000, 2, 'Tersedia', '2026-01-16 09:52:51'),
(5, 'Motor Vario 125', 'vario_125.jpg', 'Motor', 150000, 4, 'Tersedia', '2026-01-16 09:52:51'),
(6, 'Motor NMAX', 'nmax.avif', 'Motor', 180000, 0, 'Disewa', '2026-01-16 09:52:51');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `nama_pelanggan` varchar(100) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `alamat` text DEFAULT NULL,
  `no_ktp` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama_pelanggan`, `no_hp`, `alamat`, `no_ktp`, `created_at`) VALUES
(1, 'Andi Pratama', '081234567890', 'Bekasi', '3275012345670001', '2026-01-16 09:52:51'),
(2, 'Budi Santoso', '082345678901', 'Karawang', '3216012345670002', '2026-01-16 09:52:51'),
(3, 'Citra Lestari', '083456789012', 'Depok', '3276012345670003', '2026-01-16 09:52:51'),
(4, 'Dewi Anggraini', '084567890123', 'Bogor', '3273012345670004', '2026-01-16 09:52:51');

-- --------------------------------------------------------

--
-- Table structure for table `pengembalian`
--

CREATE TABLE `pengembalian` (
  `id_pengembalian` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `tanggal_pengembalian` date NOT NULL,
  `keterlambatan` int(11) DEFAULT 0,
  `denda` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengembalian`
--

INSERT INTO `pengembalian` (`id_pengembalian`, `id_transaksi`, `tanggal_pengembalian`, `keterlambatan`, `denda`) VALUES
(1, 2, '2025-01-04', 0, 0),
(2, 3, '2025-01-08', 2, 100000);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `id_kendaraan` int(11) NOT NULL,
  `tanggal_sewa` date NOT NULL,
  `tanggal_kembali` date NOT NULL,
  `tanggal_kembali_real` date DEFAULT NULL,
  `total_biaya` int(11) DEFAULT NULL,
  `denda` int(11) DEFAULT 0,
  `status` enum('Disewa','Dikembalikan') DEFAULT 'Disewa'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_user`, `id_pelanggan`, `id_kendaraan`, `tanggal_sewa`, `tanggal_kembali`, `tanggal_kembali_real`, `total_biaya`, `denda`, `status`) VALUES
(1, 1, 1, 1, '2025-01-01', '2025-01-03', '2026-01-16', 3000000, 18900000, 'Dikembalikan'),
(2, 2, 2, 3, '2025-01-02', '2025-01-04', '2025-01-04', 1500000, 0, 'Dikembalikan'),
(3, 1, 3, 5, '2025-01-05', '2025-01-06', '2025-01-08', 150000, 100000, 'Dikembalikan'),
(4, 2, 1, 5, '2026-01-16', '2026-01-17', '2026-01-16', 150000, 0, 'Dikembalikan'),
(5, 2, 3, 5, '2026-01-01', '2026-01-09', '2026-01-16', 1200000, 350000, 'Dikembalikan'),
(6, 2, 3, 5, '2026-01-01', '2026-01-09', NULL, 1200000, 0, 'Disewa'),
(9, NULL, 1, 3, '2026-01-01', '2026-01-14', '2026-01-16', 9750000, 100000, 'Dikembalikan');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('Admin','Petugas') DEFAULT 'Petugas',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nama_user`, `username`, `password`, `role`, `created_at`) VALUES
(1, 'Administrator', 'admin', '0192023a7bbd73250516f069df18b500', 'Admin', '2026-01-16 09:33:27'),
(2, 'Petugas Sewa', 'petugas', '570c396b3fc856eceb8aa7357f32af1a', 'Petugas', '2026-01-16 09:33:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kendaraan`
--
ALTER TABLE `kendaraan`
  ADD PRIMARY KEY (`id_kendaraan`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`),
  ADD UNIQUE KEY `no_ktp` (`no_ktp`);

--
-- Indexes for table `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD PRIMARY KEY (`id_pengembalian`),
  ADD KEY `id_transaksi` (`id_transaksi`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_pelanggan` (`id_pelanggan`),
  ADD KEY `id_kendaraan` (`id_kendaraan`),
  ADD KEY `fk_user_transaksi` (`id_user`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kendaraan`
--
ALTER TABLE `kendaraan`
  MODIFY `id_kendaraan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pengembalian`
--
ALTER TABLE `pengembalian`
  MODIFY `id_pengembalian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD CONSTRAINT `pengembalian_ibfk_1` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `fk_user_transaksi` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`id_kendaraan`) REFERENCES `kendaraan` (`id_kendaraan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
