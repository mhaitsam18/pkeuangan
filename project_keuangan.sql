-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 15, 2022 at 05:10 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_keuangan`
--

-- --------------------------------------------------------

--
-- Table structure for table `artikel`
--

CREATE TABLE `artikel` (
  `id` int(11) NOT NULL,
  `tanggal` varchar(128) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `images` varchar(128) NOT NULL,
  `detail` text NOT NULL,
  `jumlah_share` int(11) NOT NULL,
  `youtube` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `artikel`
--

INSERT INTO `artikel` (`id`, `tanggal`, `nama`, `images`, `detail`, `jumlah_share`, `youtube`) VALUES
(1, '24-07-2022', 'Duta Artikel', 'b377a360d7c3c989d3ab29ad6ab9badf.jpg', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam vitae corporis sit a officiis dolores enim quidem, illo accusantium numquam explicabo blanditiis eligendi veniam odit ab mollitia totam recusandae nihil autem, repudiandae libero quos voluptatem. Ducimus nobis explicabo voluptatibus facilis totam, atque dolore quia nesciunt, deserunt nemo velit, distinctio est natus in ipsum eligendi. Aperiam, fuga magnam autem et labore veritatis, ut explicabo sint culpa natus quo pariatur incidunt debitis delectus dolore quam qui aliquid eligendi libero recusandae laborum accusamus ab dolorum facilis! Quam, ad explicabo accusantium culpa aliquam tenetur itaque vero minus enim provident! Velit id provident obcaecati esse.', 0, 'p5JuH8Ig9kE'),
(2, '15-09-2022', 'SMS Gateway', 'b377a360d7c3c989d3ab29ad6ab9badf.jpg', '<p>tess</p>', 0, 'QDZ2oFNNcHw');

-- --------------------------------------------------------

--
-- Table structure for table `bayar`
--

CREATE TABLE `bayar` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `hutang_id` bigint(20) UNSIGNED DEFAULT NULL,
  `jumlah_bayar` float(16,2) NOT NULL,
  `tanggal` date NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bayar`
--

INSERT INTO `bayar` (`id`, `user_id`, `hutang_id`, `jumlah_bayar`, `tanggal`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 100000.00, '2022-08-17', '2022-08-17 03:04:18', '2022-08-17 03:04:18'),
(2, 1, 5, 20000.00, '2022-08-25', '2022-08-25 09:11:07', '2022-08-25 09:11:07');

-- --------------------------------------------------------

--
-- Table structure for table `blokirktp`
--

CREATE TABLE `blokirktp` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_pengguna` int(11) DEFAULT NULL,
  `no_ktp` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `channel`
--

CREATE TABLE `channel` (
  `id` int(11) NOT NULL,
  `nama` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `gambar_artikel`
--

CREATE TABLE `gambar_artikel` (
  `id` bigint(20) NOT NULL,
  `id_artikel` int(11) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gambar_artikel`
--

INSERT INTO `gambar_artikel` (`id`, `id_artikel`, `gambar`, `created_at`, `updated_at`) VALUES
(1, 1, 'be282d3e6a0d84996dd095dc045bb314.jpg', '2022-07-24 08:24:24', '2022-07-24 08:24:24'),
(2, 1, 'c9e3b6c44774d3f819927c7c3a21b215.png', '2022-07-24 08:27:07', '2022-07-24 08:27:07'),
(3, 1, 'a0f9f92d2ff2589900763ecd076ca3be.jpg', '2022-07-24 14:11:55', '2022-07-24 14:11:55'),
(4, 1, '1d5517cd3024bcab1c2365e2f827dd25.jpg', '2022-08-16 15:52:59', '2022-08-16 15:52:59');

-- --------------------------------------------------------

--
-- Table structure for table `hutang`
--

CREATE TABLE `hutang` (
  `id` bigint(11) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `jumlah` varchar(128) NOT NULL,
  `keterangan` varchar(128) NOT NULL,
  `level` int(11) NOT NULL,
  `tanggal` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hutang`
--

INSERT INTO `hutang` (`id`, `user_id`, `jumlah`, `keterangan`, `level`, `tanggal`) VALUES
(1, 2, '50000', 'Peledakan', 1, '2022-04-15'),
(2, 1, '100000', 'Hutang', 2, '2022-08-18'),
(3, 1, '20000', 'lagi', 1, '2022-08-17'),
(4, 1, '10000', 'lagi', 1, '2022-08-18'),
(5, 1, '20000', 'hutang', 2, '2022-08-21'),
(6, 1, '5000', 'hutang', 1, '2022-08-25');

-- --------------------------------------------------------

--
-- Table structure for table `pemasukan`
--

CREATE TABLE `pemasukan` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `jumlah` varchar(128) NOT NULL,
  `keterangan` varchar(256) NOT NULL,
  `penyimpanan` varchar(128) NOT NULL,
  `tanggal` varchar(128) NOT NULL,
  `sumber` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pemasukan`
--

INSERT INTO `pemasukan` (`id`, `user_id`, `jumlah`, `keterangan`, `penyimpanan`, `tanggal`, `sumber`) VALUES
(1, 1, '10000', ' pemasukan', 'test', '2022-04-19', 'Gaji'),
(2, 1, '500000', 'Gaji Bulan Juni', 'Tunai', '2022-07-19', 'Gaji'),
(3, 1, '1500000', 'Oke', 'Tunai', '2022-08-26', 'Hadiah'),
(4, 1, '10000000', 'asd', 'Tunai', '2022-09-15', 'Gaji');

-- --------------------------------------------------------

--
-- Table structure for table `pengeluaran`
--

CREATE TABLE `pengeluaran` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `jumlah` varchar(128) NOT NULL,
  `tanggal` varchar(128) NOT NULL,
  `keterangan` varchar(128) NOT NULL,
  `rab_id` bigint(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengeluaran`
--

INSERT INTO `pengeluaran` (`id`, `user_id`, `jumlah`, `tanggal`, `keterangan`, `rab_id`) VALUES
(1, 1, '12000', '2022-08-15', '', 2),
(2, 1, '15000', '2021-09-15', '', 23),
(3, 1, '20000', '2022-09-15', '', 16),
(4, 1, '12000', '2022-09-02', '', 16),
(5, 1, '27000', '2022-09-26', '', 16),
(6, 1, '7000', '2022-09-06', '', 16),
(7, 1, '110000', '2022-09-26', '', 16),
(8, 1, '12500', '2022-09-01', '', 16),
(9, 1, '67000', '2022-09-23', '', 16),
(10, 1, '100000', '2022-09-18', '', 16);

-- --------------------------------------------------------

--
-- Table structure for table `persen`
--

CREATE TABLE `persen` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama_pos` varchar(128) NOT NULL,
  `per` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pos`
--

CREATE TABLE `pos` (
  `id` int(11) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `min` int(11) NOT NULL,
  `max` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pos`
--

INSERT INTO `pos` (`id`, `nama`, `min`, `max`) VALUES
(1, 'Zakat', 0, 10),
(2, 'Tabungan', 10, 15),
(3, 'Cicilan Hutang', 0, 30),
(4, 'Kebutuhan Rutin', 10, 20),
(5, 'Konsumsi', 20, 30),
(6, 'Pendidikan', 10, 20),
(7, 'Kesehatan', 5, 10),
(8, 'Lain-lain', 5, 10);

-- --------------------------------------------------------

--
-- Table structure for table `rab`
--

CREATE TABLE `rab` (
  `id` bigint(11) UNSIGNED NOT NULL,
  `nama` varchar(128) NOT NULL,
  `pos_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `persen` double(5,2) NOT NULL,
  `min` int(11) NOT NULL,
  `max` int(11) NOT NULL,
  `bulan` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `is_default` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rab`
--

INSERT INTO `rab` (`id`, `nama`, `pos_id`, `user_id`, `persen`, `min`, `max`, `bulan`, `tahun`, `is_default`, `created_at`, `updated_at`) VALUES
(1, 'Zakat', 1, 1, 0.00, 0, 10, 8, 2022, 1, '2022-09-15 01:45:50', '2022-09-15 01:45:50'),
(2, 'Tabungan', 2, 1, 10.00, 10, 15, 8, 2022, 1, '2022-09-15 01:45:50', '2022-09-15 01:45:50'),
(3, 'Cicilan Hutang', 3, 1, 30.00, 0, 30, 8, 2022, 1, '2022-09-15 01:45:50', '2022-09-15 01:45:50'),
(4, 'Kebutuhan Rutin', 4, 1, 10.00, 10, 20, 8, 2022, 1, '2022-09-15 01:45:50', '2022-09-15 01:45:50'),
(5, 'Konsumsi', 5, 1, 20.00, 20, 30, 8, 2022, 1, '2022-09-15 01:45:50', '2022-09-15 01:45:50'),
(6, 'Pendidikan', 6, 1, 10.00, 10, 20, 8, 2022, 1, '2022-09-15 01:45:50', '2022-09-15 01:45:50'),
(7, 'Kesehatan', 7, 1, 5.00, 5, 10, 8, 2022, 1, '2022-09-15 01:45:50', '2022-09-15 01:45:50'),
(8, 'Zakat', 1, 3, 0.00, 0, 10, 8, 2022, 1, '2022-09-15 01:45:50', '2022-09-15 01:45:50'),
(9, 'Tabungan', 2, 3, 10.00, 10, 15, 8, 2022, 1, '2022-09-15 01:45:50', '2022-09-15 01:45:50'),
(10, 'Cicilan Hutang', 3, 3, 30.00, 0, 30, 8, 2022, 1, '2022-09-15 01:45:50', '2022-09-15 01:45:50'),
(11, 'Kebutuhan Rutin', 4, 3, 10.00, 10, 20, 8, 2022, 1, '2022-09-15 01:45:50', '2022-09-15 01:45:50'),
(12, 'Konsumsi', 5, 3, 20.00, 20, 30, 8, 2022, 1, '2022-09-15 01:45:50', '2022-09-15 01:45:50'),
(13, 'Pendidikan', 6, 3, 20.00, 10, 20, 8, 2022, 1, '2022-09-15 01:45:50', '2022-09-15 01:45:50'),
(14, 'Kesehatan', 7, 3, 5.00, 5, 10, 8, 2022, 1, '2022-09-15 01:45:50', '2022-09-15 01:45:50'),
(15, 'Zakat', 1, 1, 0.00, 0, 10, 9, 2022, 1, '2022-09-15 01:52:13', '2022-09-15 01:52:13'),
(16, 'Tabungan', 2, 1, 10.00, 10, 15, 9, 2022, 1, '2022-09-15 01:52:13', '2022-09-15 01:52:13'),
(17, 'Cicilan Hutang', 3, 1, 30.00, 0, 30, 9, 2022, 1, '2022-09-15 01:52:13', '2022-09-15 01:52:13'),
(18, 'Kebutuhan Rutin', 4, 1, 10.00, 10, 20, 9, 2022, 1, '2022-09-15 01:52:13', '2022-09-15 01:52:13'),
(19, 'Konsumsi', 5, 1, 20.00, 20, 30, 9, 2022, 1, '2022-09-15 01:52:13', '2022-09-15 01:52:13'),
(20, 'Pendidikan', 6, 1, 10.00, 10, 20, 9, 2022, 1, '2022-09-15 01:52:13', '2022-09-15 01:52:13'),
(21, 'Kesehatan', 7, 1, 5.00, 5, 10, 9, 2022, 1, '2022-09-15 01:52:13', '2022-09-15 01:52:13'),
(22, 'Zakat', 1, 1, 0.00, 0, 10, 9, 2021, 1, '2022-09-15 01:53:39', '2022-09-15 01:53:39'),
(23, 'Tabungan', 2, 1, 10.00, 10, 15, 9, 2021, 1, '2022-09-15 01:53:39', '2022-09-15 01:53:39'),
(24, 'Cicilan Hutang', 3, 1, 30.00, 0, 30, 9, 2021, 1, '2022-09-15 01:53:39', '2022-09-15 01:53:39'),
(25, 'Kebutuhan Rutin', 4, 1, 10.00, 10, 20, 9, 2021, 1, '2022-09-15 01:53:39', '2022-09-15 01:53:39'),
(26, 'Konsumsi', 5, 1, 20.00, 20, 30, 9, 2021, 1, '2022-09-15 01:53:39', '2022-09-15 01:53:39'),
(27, 'Pendidikan', 6, 1, 20.00, 10, 20, 9, 2021, 1, '2022-09-15 01:53:39', '2022-09-15 01:53:39'),
(28, 'Kesehatan', 7, 1, 5.00, 5, 10, 9, 2021, 1, '2022-09-15 01:53:39', '2022-09-15 01:53:39'),
(29, 'Ngoding Bareng', NULL, 1, 2.00, 0, 5, 9, 2022, 0, '2022-09-15 06:05:36', '2022-09-15 06:05:36'),
(30, 'Zakat', 1, 1, 0.00, 0, 10, 10, 2022, 1, '2022-09-15 07:34:00', '2022-09-15 07:34:00'),
(31, 'Tabungan', 2, 1, 10.00, 10, 15, 10, 2022, 1, '2022-09-15 07:34:00', '2022-09-15 07:34:00'),
(32, 'Cicilan Hutang', 3, 1, 30.00, 0, 30, 10, 2022, 1, '2022-09-15 07:34:00', '2022-09-15 07:34:00'),
(33, 'Kebutuhan Rutin', 4, 1, 10.00, 10, 20, 10, 2022, 1, '2022-09-15 07:34:00', '2022-09-15 07:34:00'),
(34, 'Konsumsi', 5, 1, 20.00, 20, 30, 10, 2022, 1, '2022-09-15 07:34:00', '2022-09-15 07:34:00'),
(35, 'Pendidikan', 6, 1, 20.00, 10, 20, 10, 2022, 1, '2022-09-15 07:34:00', '2022-09-15 07:34:00'),
(36, 'Kesehatan', 7, 1, 5.00, 5, 10, 10, 2022, 1, '2022-09-15 07:34:00', '2022-09-15 07:34:00'),
(37, 'Zakat', 1, 1, 0.00, 0, 10, 11, 2022, 1, '2022-09-15 07:34:31', '2022-09-15 07:34:31'),
(38, 'Tabungan', 2, 1, 10.00, 10, 15, 11, 2022, 1, '2022-09-15 07:34:31', '2022-09-15 07:34:31'),
(39, 'Cicilan Hutang', 3, 1, 30.00, 0, 30, 11, 2022, 1, '2022-09-15 07:34:31', '2022-09-15 07:34:31'),
(40, 'Kebutuhan Rutin', 4, 1, 10.00, 10, 20, 11, 2022, 1, '2022-09-15 07:34:31', '2022-09-15 07:34:31'),
(41, 'Konsumsi', 5, 1, 20.00, 20, 30, 11, 2022, 1, '2022-09-15 07:34:31', '2022-09-15 07:34:31'),
(42, 'Pendidikan', 6, 1, 20.00, 10, 20, 11, 2022, 1, '2022-09-15 07:34:31', '2022-09-15 07:34:31'),
(43, 'Kesehatan', 7, 1, 5.00, 5, 10, 11, 2022, 1, '2022-09-15 07:34:31', '2022-09-15 07:34:31'),
(44, 'Zakat', 1, 1, 0.00, 0, 10, 12, 2022, 1, '2022-09-15 07:41:52', '2022-09-15 07:41:52'),
(45, 'Tabungan', 2, 1, 10.00, 10, 15, 12, 2022, 1, '2022-09-15 07:41:52', '2022-09-15 07:41:52'),
(46, 'Cicilan Hutang', 3, 1, 30.00, 0, 30, 12, 2022, 1, '2022-09-15 07:41:52', '2022-09-15 07:41:52'),
(47, 'Kebutuhan Rutin', 4, 1, 10.00, 10, 20, 12, 2022, 1, '2022-09-15 07:41:52', '2022-09-15 07:41:52'),
(48, 'Konsumsi', 5, 1, 20.00, 20, 30, 12, 2022, 1, '2022-09-15 07:41:52', '2022-09-15 07:41:52'),
(49, 'Pendidikan', 6, 1, 20.00, 10, 20, 12, 2022, 1, '2022-09-15 07:41:52', '2022-09-15 07:41:52'),
(50, 'Kesehatan', 7, 1, 5.00, 5, 10, 12, 2022, 1, '2022-09-15 07:41:52', '2022-09-15 07:41:52');

-- --------------------------------------------------------

--
-- Table structure for table `tabungan`
--

CREATE TABLE `tabungan` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `jumlah` varchar(128) NOT NULL,
  `tanggal` varchar(128) NOT NULL,
  `keterangan` varchar(128) NOT NULL,
  `penyimpanan` varchar(128) NOT NULL,
  `channel` varchar(128) NOT NULL,
  `pengeluaran_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tabungan`
--

INSERT INTO `tabungan` (`id`, `user_id`, `jumlah`, `tanggal`, `keterangan`, `penyimpanan`, `channel`, `pengeluaran_id`) VALUES
(1, 1, '12000', '2022-08-15', '', 'Tabungan', 'Bank BNI', 1),
(2, 1, '15000', '2021-09-15', '', 'Tabungan', 'Bank BRI', 2),
(3, 1, '20000', '2022-09-15', '', 'Tabungan', 'Bank BCA', 3),
(4, 1, '12000', '2022-09-02', '', 'Tabungan', 'Bank BTN', 4),
(5, 1, '27000', '2022-09-26', '', 'Tabungan', 'Bank BCA', 5),
(6, 1, '7000', '2022-09-06', '', 'Tabungan', 'Bank BCA', 6),
(7, 1, '110000', '2022-09-26', '', 'Tabungan', 'Bank BTN', 7),
(8, 1, '12500', '2022-09-01', '', 'Tabungan', 'Bank BCA', 8),
(9, 1, '67000', '2022-09-23', '', 'Tabungan', 'Bank BCA', 9),
(10, 1, '100000', '2022-09-18', '', 'Tabungan', 'Bank BCA', 10);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_log_aktivitas`
--

CREATE TABLE `tbl_log_aktivitas` (
  `log_id` int(11) NOT NULL,
  `log_nama` text DEFAULT NULL,
  `log_tanggal` timestamp NULL DEFAULT current_timestamp(),
  `log_ip` varchar(20) DEFAULT NULL,
  `log_pengguna_id` int(11) DEFAULT NULL,
  `log_icon` blob DEFAULT NULL,
  `log_jenis_icon` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pengguna`
--

CREATE TABLE `tbl_pengguna` (
  `pengguna_id` int(11) NOT NULL,
  `pengguna_email` varchar(255) DEFAULT NULL,
  `pengguna_no_ktp` varchar(255) NOT NULL,
  `pengguna_foto_ktp` varchar(255) DEFAULT NULL,
  `pengguna_ktp_verified` int(11) NOT NULL DEFAULT 0,
  `pengguna_nama` varchar(50) DEFAULT NULL,
  `pengguna_jenkel` varchar(2) DEFAULT NULL,
  `pengguna_nohp` varchar(128) DEFAULT NULL,
  `pengguna_username` varchar(30) DEFAULT NULL,
  `pengguna_password` varchar(35) DEFAULT NULL,
  `pengguna_status` int(2) DEFAULT 1,
  `tanggal_nonaktif` date DEFAULT NULL,
  `tanggal_aktif` date DEFAULT NULL,
  `pengguna_level` varchar(3) DEFAULT NULL,
  `pengguna_register` timestamp NULL DEFAULT current_timestamp(),
  `pengguna_photo` varchar(40) DEFAULT NULL,
  `pengguna_unik` varchar(128) NOT NULL,
  `is_active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pengguna`
--

INSERT INTO `tbl_pengguna` (`pengguna_id`, `pengguna_email`, `pengguna_no_ktp`, `pengguna_foto_ktp`, `pengguna_ktp_verified`, `pengguna_nama`, `pengguna_jenkel`, `pengguna_nohp`, `pengguna_username`, `pengguna_password`, `pengguna_status`, `tanggal_nonaktif`, `tanggal_aktif`, `pengguna_level`, `pengguna_register`, `pengguna_photo`, `pengguna_unik`, `is_active`) VALUES
(1, 'rezaregita@gmail.com', '3215151802990003', '608e235ca1321fe821a1d3a500728bd2.jpg', 0, 'Reza Regita Putria', 'P', '085376220093', 'rezaregita', 'ded83e5056fb70432ab2df607e70aa2e', 1, NULL, NULL, '2', '2022-07-16 07:47:29', 'a16204142ca4be8957c411cf39b5ca85.png', '8IFfiYN0WOgAn2Md', 0),
(2, 'windamaiyastri@gmail.com', '3215151802990001', '608e235ca1321fe821a1d3a500728bd2.jpg', 0, 'Winda Maiyastri', 'P', '085376220093', 'windamaiyastri', 'e46006c7bbade630508f33c4c6791d8e', 1, NULL, NULL, '1', '2022-07-17 04:05:40', '2ea74a169f1157b6bdfc321c3cabec6f.jpg', '03uVMgnbGTv6iXKC', 0),
(3, 'nura@gmail.com', '3215251404990002', 'e6b4cc56975e84b24ec0e606925bba75.jpeg', 0, 'Nura', 'L', '082117503125', 'nura', '81dc9bdb52d04dc20036dbd8313ed055', 1, NULL, NULL, '2', '2022-08-31 07:37:11', '5505ab93cff1b4b5d6eb7855d84b8505.png', 'FP0JwqhpkIEytu5Q', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ulasan`
--

CREATE TABLE `ulasan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_artikel` int(11) DEFAULT NULL,
  `id_pengguna` int(11) DEFAULT NULL,
  `rating` enum('1','2','3','4','5') NOT NULL,
  `ulasan` text NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ulasan`
--

INSERT INTO `ulasan` (`id`, `id_artikel`, `id_pengguna`, `rating`, `ulasan`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '4', 'tes', '2022-09-01 15:54:12', '2022-09-01 11:25:03');

-- --------------------------------------------------------

--
-- Table structure for table `user_token`
--

CREATE TABLE `user_token` (
  `id` int(11) NOT NULL,
  `pengguna_id` bigint(20) UNSIGNED DEFAULT NULL,
  `email` varchar(128) NOT NULL,
  `token` varchar(255) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `artikel`
--
ALTER TABLE `artikel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bayar`
--
ALTER TABLE `bayar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blokirktp`
--
ALTER TABLE `blokirktp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `channel`
--
ALTER TABLE `channel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gambar_artikel`
--
ALTER TABLE `gambar_artikel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hutang`
--
ALTER TABLE `hutang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pemasukan`
--
ALTER TABLE `pemasukan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `persen`
--
ALTER TABLE `persen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pos`
--
ALTER TABLE `pos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rab`
--
ALTER TABLE `rab`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tabungan`
--
ALTER TABLE `tabungan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_log_aktivitas`
--
ALTER TABLE `tbl_log_aktivitas`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `log_pengguna_id` (`log_pengguna_id`);

--
-- Indexes for table `tbl_pengguna`
--
ALTER TABLE `tbl_pengguna`
  ADD PRIMARY KEY (`pengguna_id`),
  ADD UNIQUE KEY `pengguna_no_ktp` (`pengguna_no_ktp`),
  ADD UNIQUE KEY `pengguna_email` (`pengguna_email`);

--
-- Indexes for table `ulasan`
--
ALTER TABLE `ulasan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `artikel`
--
ALTER TABLE `artikel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bayar`
--
ALTER TABLE `bayar`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `blokirktp`
--
ALTER TABLE `blokirktp`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `channel`
--
ALTER TABLE `channel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gambar_artikel`
--
ALTER TABLE `gambar_artikel`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `hutang`
--
ALTER TABLE `hutang`
  MODIFY `id` bigint(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pemasukan`
--
ALTER TABLE `pemasukan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `persen`
--
ALTER TABLE `persen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pos`
--
ALTER TABLE `pos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `rab`
--
ALTER TABLE `rab`
  MODIFY `id` bigint(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `tabungan`
--
ALTER TABLE `tabungan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_log_aktivitas`
--
ALTER TABLE `tbl_log_aktivitas`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_pengguna`
--
ALTER TABLE `tbl_pengguna`
  MODIFY `pengguna_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ulasan`
--
ALTER TABLE `ulasan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
