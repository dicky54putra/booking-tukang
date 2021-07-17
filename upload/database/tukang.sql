-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 17, 2021 at 06:02 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.3.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tukang`
--

-- --------------------------------------------------------

--
-- Table structure for table `menu_navigasi`
--

CREATE TABLE `menu_navigasi` (
  `id_menu_navigasi` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `id_parent` int(11) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `no_urut` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu_navigasi`
--

INSERT INTO `menu_navigasi` (`id_menu_navigasi`, `nama`, `url`, `id_parent`, `icon`, `no_urut`, `status`) VALUES
(1, 'Master Data', '#', 0, 'database', 2, 1),
(2, 'Sidebar Menu', 'menu_navigasi', 1, '#', 1, 1),
(3, 'User', 'user', 1, '#', 2, 1),
(4, 'Home', 'auth', 0, 'home', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pemesan`
--

CREATE TABLE `pemesan` (
  `id_pemesan` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jk` tinyint(1) DEFAULT NULL,
  `alamat` text NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pemesan`
--

INSERT INTO `pemesan` (`id_pemesan`, `nama`, `jk`, `alamat`, `no_hp`, `email`, `id_user`) VALUES
(1, 'Dicky', 1, '123', '109', 'saputradicky705@gmail.com', 6);

-- --------------------------------------------------------

--
-- Table structure for table `proyek`
--

CREATE TABLE `proyek` (
  `id_proyek` int(11) NOT NULL,
  `jenis_proyek` tinyint(1) NOT NULL COMMENT '0: Harian, 1: Borongan',
  `tanggal_awal` date NOT NULL,
  `tanggal_akhir` date NOT NULL,
  `fee` double(100,2) NOT NULL,
  `deskripsi` text NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `id_tukang` int(11) NOT NULL,
  `id_pemesan` int(11) NOT NULL,
  `skor` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL COMMENT '1 = cart, 2 = on progress, 3 = done'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `proyek`
--

INSERT INTO `proyek` (`id_proyek`, `jenis_proyek`, `tanggal_awal`, `tanggal_akhir`, `fee`, `deskripsi`, `lokasi`, `id_tukang`, `id_pemesan`, `skor`, `status`) VALUES
(1, 0, '2021-07-17', '2021-07-24', 700000.00, 'qwe', 'qwe', 1, 1, NULL, 1),
(2, 0, '2021-07-10', '2021-07-23', 1040000.00, 'qqq', 'qqqq', 2, 1, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tr_menu_navigasi`
--

CREATE TABLE `tr_menu_navigasi` (
  `id_menu_navigasi` int(11) NOT NULL,
  `id_role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tr_menu_navigasi`
--

INSERT INTO `tr_menu_navigasi` (`id_menu_navigasi`, `id_role`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tukang`
--

CREATE TABLE `tukang` (
  `id_tukang` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jk` tinyint(1) NOT NULL,
  `alamat` text NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `fee_per_day` double(100,2) NOT NULL,
  `skills` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `id_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tukang`
--

INSERT INTO `tukang` (`id_tukang`, `nama`, `jk`, `alamat`, `tanggal_lahir`, `no_hp`, `fee_per_day`, `skills`, `foto`, `id_user`) VALUES
(1, 'Dicky', 1, 'Jepara', '2001-11-28', '089123123123', 100000.00, 'pasang kramik, bangun rumah, pasang genteng, perbaiki wc', '', NULL),
(2, 'Riski', 1, 'Aceh', '1999-12-09', '087123123145', 80000.00, 'pasang genteng, ngecor , pondasi', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `role` tinyint(1) NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama`, `role`, `foto`) VALUES
(1, 'admin', '$2y$10$FNOtkHsYDXwq8D277Si.Y.6iObVMqInK/QoL2bsclA.et2/E9bKGG', 'Admin', 1, 'avatar5.png'),
(6, 'rezha05', '$2y$10$1hEu8JGdcjBEVWIkXRHQBeLx0CzCtk.dV/RP3RgxrVzkcCCsCHMV2', 'Dicky', 2, 'def.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menu_navigasi`
--
ALTER TABLE `menu_navigasi`
  ADD PRIMARY KEY (`id_menu_navigasi`);

--
-- Indexes for table `pemesan`
--
ALTER TABLE `pemesan`
  ADD PRIMARY KEY (`id_pemesan`);

--
-- Indexes for table `proyek`
--
ALTER TABLE `proyek`
  ADD PRIMARY KEY (`id_proyek`);

--
-- Indexes for table `tukang`
--
ALTER TABLE `tukang`
  ADD PRIMARY KEY (`id_tukang`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menu_navigasi`
--
ALTER TABLE `menu_navigasi`
  MODIFY `id_menu_navigasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pemesan`
--
ALTER TABLE `pemesan`
  MODIFY `id_pemesan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `proyek`
--
ALTER TABLE `proyek`
  MODIFY `id_proyek` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tukang`
--
ALTER TABLE `tukang`
  MODIFY `id_tukang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
