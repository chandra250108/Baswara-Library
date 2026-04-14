-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 14, 2026 at 03:04 AM
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
-- Database: `perpustakaan_sekolah`
--

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id_buku` int(11) NOT NULL,
  `judul` varchar(200) NOT NULL,
  `penulis` varchar(100) NOT NULL,
  `penerbit` varchar(100) NOT NULL,
  `stok` int(11) NOT NULL,
  `cover` varchar(255) DEFAULT NULL,
  `status` enum('tersedia','habis') DEFAULT 'tersedia',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_deleted` tinyint(1) DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id_buku`, `judul`, `penulis`, `penerbit`, `stok`, `cover`, `status`, `created_at`, `is_deleted`, `deleted_at`) VALUES
(5, 'Hujan', 'Tere Liye', 'Gramedia', 8, '3bb3958d2b7e00ffd5f691588cc7d96b.jpeg', 'tersedia', '2026-04-11 09:16:26', 0, NULL),
(7, 'Ceroz dan Batozar', 'Tere Liye', 'Gramedia', 5, '735e2e541d79534b89ee2f9a29b0ce34.jpeg', 'tersedia', '2026-04-11 09:28:08', 0, NULL),
(8, 'Matahari Minor', 'Tere Liye', 'Gramedia', 9, '4628c474dbbde22a10e1642ef204877c.jpeg', 'tersedia', '2026-04-11 09:28:29', 0, NULL),
(10, 'Harga Sebuah Percaya', 'Tere Liye', 'Gramedia', 15, '4885b68dbef094c16bf88fc24c4bb08c.jpeg', 'tersedia', '2026-04-11 10:06:27', 0, NULL),
(11, 'Hello', 'Tere Liye', 'Gramedia', 15, '576f65e37263ba0d76b857d576df01cc.jpeg', 'tersedia', '2026-04-11 10:11:11', 0, NULL),
(12, 'Tentang Kamu', 'Tere Liye', 'Gramedia', 5, '3cbf9eba765c5e95ac2baae8efffee98.jpeg', 'tersedia', '2026-04-11 10:11:40', 0, NULL),
(14, 'Pergi', 'Tere Liye', 'Gramedia', 10, '42811c70fc559bf5ccc1ee28d871f175.jpeg', 'tersedia', '2026-04-11 13:32:03', 0, NULL),
(15, 'Selena', 'Tere Liye', 'Gramedia', 20, '4b590914624b760c33871a020af758b9.jpeg', 'tersedia', '2026-04-11 13:32:25', 0, NULL),
(22, 'ILY', 'Tere Liye', 'Gramedia', 15, 'cc35d8818e12b49d5f6992f45558e4ab.jpeg', 'tersedia', '2026-04-11 14:19:12', 0, NULL),
(23, 'Yang Telah Lama Pergi', 'Tere Liye', 'Gramedia', 5, 'b03b1fa9ecc08568cfd982e30bb8d61b.jpeg', 'tersedia', '2026-04-11 14:23:47', 0, NULL),
(24, 'Bandit Bandit Berkelas', 'Tere Liye', 'Gramedia', 9, '25259bea287cf6ee166502d4aedfa851.jpeg', 'tersedia', '2026-04-13 14:13:56', 0, NULL),
(25, 'Negeri Para Bedebah', 'Tere Liye', 'Gramedia', 14, '8fe6f7f13b1e52f5219377deb276f0f5.jpeg', 'tersedia', '2026-04-13 14:17:06', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `batas_pengembalian` date NOT NULL,
  `tanggal_kembali` date DEFAULT NULL,
  `status` enum('dipinjam','dikembalikan') DEFAULT 'dipinjam',
  `denda` int(11) DEFAULT 0,
  `status_denda` enum('lunas','belum_lunas') DEFAULT 'belum_lunas'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_siswa`, `id_buku`, `tanggal_pinjam`, `batas_pengembalian`, `tanggal_kembali`, `status`, `denda`, `status_denda`) VALUES
(30, 7, 23, '2026-04-03', '2026-04-10', '2026-04-11', 'dikembalikan', 1000, 'lunas'),
(32, 2, 10, '2026-04-07', '2026-04-14', '2026-04-10', 'dikembalikan', 0, 'lunas'),
(33, 7, 10, '2026-04-11', '2026-04-18', '2026-04-11', 'dikembalikan', 0, 'lunas'),
(34, 8, 22, '2026-04-13', '2026-04-20', '2026-04-13', 'dikembalikan', 0, 'lunas'),
(35, 11, 11, '2026-04-13', '2026-04-20', '2026-04-13', 'dikembalikan', 0, 'lunas'),
(37, 11, 5, '2026-04-13', '2026-04-20', '2026-04-15', 'dikembalikan', 0, 'lunas'),
(40, 4, 15, '2026-04-12', '2026-04-20', '2026-04-13', 'dikembalikan', 0, 'lunas'),
(44, 13, 10, '2026-04-13', '2026-04-20', '2026-04-13', 'dikembalikan', 0, 'lunas'),
(45, 13, 11, '2026-04-13', '2026-04-20', '2026-04-13', 'dikembalikan', 0, 'lunas'),
(46, 15, 25, '2026-04-02', '2026-04-12', NULL, 'dipinjam', 0, 'belum_lunas'),
(49, 5, 8, '2026-04-13', '2026-04-20', NULL, 'dipinjam', 0, 'belum_lunas'),
(51, 15, 24, '2026-04-13', '2026-04-17', NULL, 'dipinjam', 0, 'belum_lunas'),
(52, 14, 5, '2026-04-13', '2026-04-20', NULL, 'dipinjam', 0, 'belum_lunas'),
(58, 2, 5, '2026-04-12', '2026-04-20', NULL, 'dipinjam', 0, 'belum_lunas');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `kelas` varchar(20) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `no_hp` varchar(15) DEFAULT NULL,
  `role` enum('admin','siswa') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `nama_lengkap`, `kelas`, `alamat`, `no_hp`, `role`, `created_at`, `is_deleted`, `deleted_at`) VALUES
(2, 'moozaa', '$2y$10$O7x0LO2QEi1sA3XLK/mA3eqIu0Sas2Oiu.0Lx5yq.VArHWkqBtFPS', 'Mooza Aleqyeruzka Chandraa', 'XII PPLG', 'jalanin dulu', '0123456789', 'siswa', '2026-04-10 08:38:18', 0, NULL),
(4, 'chandra', '$2y$10$jiBfrux9OAELORU7Vb03ee9cwtBQicA9l5F1EDJ7LrVsUvK8oAjcG', 'zaa', 'XII PPLG', 'jalanin dulu', '0123132314321', 'siswa', '2026-04-11 07:48:38', 0, NULL),
(5, 'baswara', '$2y$10$BzZz3BdtAiWaEnNF6c9OSuK7nMrsUWPEVJazFHJBiTwhAnRVMx5.e', 'baswara', 'XI MPLB', 'Jalan yok', '34324324234', 'siswa', '2026-04-11 08:25:14', 0, NULL),
(7, 'Eleanor', '$2y$10$5OFKHEyTinN9wKS3TzYPAet6RQakqT/vvUEChoFssCl4y1ALWF9nq', 'Eleanors Baswara Chandra', 'XII AKL', 'Jalanin aja', '1234567890', 'siswa', '2026-04-11 10:28:19', 0, NULL),
(8, 'Zee', '$2y$10$/75pEPx5p99INgogdMAEZeFew5W.UJSoiwxtQMbR8QtNTy0OHf4OG', 'Azizi Shafa Asadel', 'XI AKL', 'Jalan yaa', '012345343', 'siswa', '2026-04-11 13:24:23', 0, NULL),
(11, 'Yeruzka', '$2y$10$kBQiMTHNOKUaSU8VGqJLdufzcbAoqqPnY7TaMDjOd8T0jzT1P1.bW', 'Yeruzka Baswara Chandra', 'X AKL', 'PIK 2', '086313246', 'siswa', '2026-04-13 03:41:46', 0, NULL),
(14, 'zoyaa', '$2y$10$uIEpdrZv36JqRt3eZizcr.XdHj02s0xWqMyOw/kVm7fBzkriFtzk.', 'zoyaa', 'X MPLB', 'Jalan apa yaaa', '099183912345', 'siswa', '2026-04-13 14:48:36', 0, NULL),
(15, 'miaaa', '$2y$10$XFnbxo6H3uGFlAuckjdGneMxl2BKmn6dKOQKtZCr9Tm0RkH9UKlYi', 'Mia Genyle', 'X TJKT', 'Jalan apa yaaa', '08324787434', 'siswa', '2026-04-13 14:54:15', 0, NULL),
(17, 'admin', '0192023a7bbd73250516f069df18b500', 'Administrator', NULL, NULL, NULL, 'admin', '2026-04-13 15:45:27', 0, NULL),
(18, 'yaya', '$2y$10$sl3Fv.yWhjbyYujw7tRL3etyyh9rgX3TseVti334a.BCJ/ELWrC6a', 'yayaaa', 'XI AKL', 'jalan jalan', '08237283', 'siswa', '2026-04-13 17:35:15', 0, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_siswa` (`id_siswa`),
  ADD KEY `id_buku` (`id_buku`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_siswa`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id_buku`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
