-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 12, 2021 at 06:49 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wp_laravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(12, '2021_02_19_144607_create_user_table', 2),
(13, '2021_02_19_152357_create_kriteria_table', 3),
(16, '2021_02_19_160819_create_alternatif_table', 4),
(17, '2021_02_19_160833_create_rel_alternatif_table', 4),
(18, '2021_07_02_065738_add_alternatif', 5),
(19, '2021_07_02_074627_add_nilai', 6),
(20, '2021_07_09_033218_create_nilai_table', 7);

-- --------------------------------------------------------

--
-- Table structure for table `tb_alternatif`
--

CREATE TABLE `tb_alternatif` (
  `kode_alternatif` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_alternatif` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis_kelamin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prodi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `semester` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nilai` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total` double DEFAULT NULL,
  `rank` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_kriteria`
--

CREATE TABLE `tb_kriteria` (
  `kode_kriteria` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_kriteria` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `range1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `range2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bobot` double DEFAULT NULL,
  `atribut` varchar(16) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_kriteria`
--

INSERT INTO `tb_kriteria` (`kode_kriteria`, `nama_kriteria`, `range1`, `range2`, `bobot`, `atribut`, `created_at`, `updated_at`) VALUES
('C01', 'Asuransi', 'Punya', 'Tidak Punya', 1, 'cost', '2021-06-16 16:04:18', '2021-06-16 16:07:46'),
('C02', 'Gaji Orang Tua', '0 - 1.000.000', '1.000.000 - ke atas', 1, 'cost', '2021-06-17 17:41:30', '2021-06-17 17:41:30'),
('C03', 'Kepemilikan Rumah', 'Pribadi', 'Sewa / Menumpang', 5, 'benefit', '2021-06-17 17:44:04', '2021-06-17 17:44:04'),
('C04', 'Tanggungan Orangtua', '1', '3', 4, 'benefit', '2021-07-02 03:12:14', '2021-07-02 03:12:14');

-- --------------------------------------------------------

--
-- Table structure for table `tb_nilai`
--

CREATE TABLE `tb_nilai` (
  `ID` int(10) UNSIGNED NOT NULL,
  `kode_alternatif` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_kriteria` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nilai` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_rel_alternatif`
--

CREATE TABLE `tb_rel_alternatif` (
  `ID` bigint(20) UNSIGNED NOT NULL,
  `kode_alternatif` varchar(16) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kode_kriteria` varchar(16) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nilai` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `nama_user` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `level` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_user` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `nama_user`, `username`, `password`, `level`, `status_user`, `created_at`, `updated_at`) VALUES
(6, 'Admin Beasiswa', 'admin', '$2y$10$fFnjbv0NmoahrnIIqygQRuleBYzCkR8b1EE54NJAp.0XP.BOJ4oJm', 'admin', 1, '2021-06-16 16:27:20', '2021-07-08 19:06:17'),
(7, 'Pegawai Beasiswa', 'pegawai', '$2y$10$rX6ZEdX7z4yd9FpkZ9OON.U/XlngCeDgY/qQk5/4IFNjcio1VhDEu', 'user', 1, '2021-06-16 16:27:55', '2021-07-08 19:07:09'),
(8, 'Mahasiswa', 'mhs', '$2y$10$2HOcDVJhsjct7l71Pv/21.zMHFjxMWrMGGquitwXar0BLGhQ/HgJW', 'mhs', 1, '2021-06-16 16:28:12', '2021-07-06 14:20:24'),
(12, 'hilya', 'hilya', '$2y$10$yihq4ik5NDc0vZxWIDdbSeodIt7kW.L9gcIT.duxVX8d0YqIYn3QG', 'mhs', 1, '2021-07-06 16:28:16', '2021-07-06 16:28:16'),
(15, 'Hilyatus Sa\'adah W', 'hilyatus', '$2y$10$ZKmFxbeIJLPlsC7AvPYbVOhjkUS.4G2lT8Bxcs7QrpSJyuQ6/xuM6', 'mhs', 1, '2021-07-06 20:21:04', '2021-07-06 20:23:24'),
(16, 'Febby Erdana', 'febbyer', '$2y$10$t8tvAfMNSh/Gzx8LpPVS3.xzo.UHHAwJ6lq3LhldxzhwKAH/Ul3TC', 'mhs', 1, '2021-07-11 03:39:42', '2021-07-11 03:39:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_alternatif`
--
ALTER TABLE `tb_alternatif`
  ADD PRIMARY KEY (`kode_alternatif`);

--
-- Indexes for table `tb_kriteria`
--
ALTER TABLE `tb_kriteria`
  ADD PRIMARY KEY (`kode_kriteria`);

--
-- Indexes for table `tb_nilai`
--
ALTER TABLE `tb_nilai`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_tb_nilai_tb_alternatif1_idx` (`kode_alternatif`),
  ADD KEY `tb_nilai_kriteria_id_foreign` (`kode_kriteria`);

--
-- Indexes for table `tb_rel_alternatif`
--
ALTER TABLE `tb_rel_alternatif`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `tb_user_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tb_nilai`
--
ALTER TABLE `tb_nilai`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `tb_rel_alternatif`
--
ALTER TABLE `tb_rel_alternatif`
  MODIFY `ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=219;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_nilai`
--
ALTER TABLE `tb_nilai`
  ADD CONSTRAINT `fk_tb_nilai_tb_alternatif1` FOREIGN KEY (`kode_alternatif`) REFERENCES `tb_alternatif` (`kode_alternatif`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tb_nilai_kriteria_id_foreign` FOREIGN KEY (`kode_kriteria`) REFERENCES `tb_kriteria` (`kode_kriteria`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
