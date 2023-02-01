-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 24, 2023 at 03:24 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jateng`
--

-- --------------------------------------------------------

--
-- Table structure for table `iwkbu`
--

CREATE TABLE `iwkbu` (
  `iwkbu_id` int(255) NOT NULL,
  `kode_loket` int(10) NOT NULL,
  `nominal` varchar(100) NOT NULL,
  `tanggal` date NOT NULL,
  `date_created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `iwkbu`
--

INSERT INTO `iwkbu` (`iwkbu_id`, `kode_loket`, `nominal`, `tanggal`, `date_created`) VALUES
(181, 1, '7975100000', '2023-01-24', '2023-01-24'),
(182, 2, '7182000000', '2023-01-24', '2023-01-24'),
(183, 3, '19711000000', '2023-01-24', '2023-01-24'),
(184, 4, '9196400000', '2023-01-24', '2023-01-24'),
(185, 5, '12489000000', '2023-01-24', '2023-01-24'),
(186, 6, '9008800000', '2023-01-24', '2023-01-24'),
(187, 7, '3254900000', '2023-01-24', '2023-01-24'),
(188, 8, '4975100000', '2023-01-24', '2023-01-24'),
(189, 9, '', '2023-01-24', '2023-01-24');

-- --------------------------------------------------------

--
-- Table structure for table `iwkl`
--

CREATE TABLE `iwkl` (
  `iwkl_id` int(255) NOT NULL,
  `kode_loket` int(10) NOT NULL,
  `nominal` varchar(100) NOT NULL,
  `tanggal` date NOT NULL,
  `date_created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `iwkl`
--

INSERT INTO `iwkl` (`iwkl_id`, `kode_loket`, `nominal`, `tanggal`, `date_created`) VALUES
(240, 10, '6232700000', '2023-01-24', '2023-01-24'),
(241, 11, '4851400000', '2023-01-24', '2023-01-24'),
(242, 12, '9324600000', '2023-01-24', '2023-01-24'),
(243, 13, '5844100000', '2023-01-24', '2023-01-24'),
(244, 14, '8436100000', '2023-01-24', '2023-01-24'),
(245, 15, '7900600000', '2023-01-24', '2023-01-24'),
(246, 16, '1051800000', '2023-01-24', '2023-01-24'),
(247, 17, '2099700000', '2023-01-24', '2023-01-24'),
(248, 18, '', '2023-01-24', '2023-01-24');

-- --------------------------------------------------------

--
-- Table structure for table `loket`
--

CREATE TABLE `loket` (
  `kode_loket` int(3) NOT NULL,
  `nama_loket` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `loket`
--

INSERT INTO `loket` (`kode_loket`, `nama_loket`) VALUES
(1, 'Loket Cabang Jawa Tengah '),
(2, 'Loket Perwakilan Surakarta'),
(3, 'Loket Perwakilan Magelang'),
(4, 'Loket Perwakilan Purwokerto'),
(5, 'Loket Perwakilan Pekalongan'),
(6, 'Loket Perwakilan Pati'),
(7, 'Loket Perwakilan Semarang'),
(8, 'Loket Perwakilan Sukoharjo'),
(9, 'Kantor Pelayanan Klaten');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `nama_lengkap` varchar(150) NOT NULL,
  `username` varchar(50) NOT NULL,
  `user_password` varchar(300) NOT NULL,
  `email` varchar(150) NOT NULL,
  `kode_loket` varchar(10) NOT NULL,
  `user_status` int(11) NOT NULL,
  `role` int(1) NOT NULL,
  `photo_profile` varchar(255) NOT NULL DEFAULT 'default.png',
  `file_qrcode` varchar(255) NOT NULL DEFAULT 'default.png'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `nama`, `nama_lengkap`, `username`, `user_password`, `email`, `kode_loket`, `user_status`, `role`, `photo_profile`, `file_qrcode`) VALUES
(34, 'Pelihat', 'Kevin Gilbert Toding', 'pelihat', 'bb20d8997a87ea9cb3337be25594ff20370a2cdae329bef94ad2a2f3', 'gilberttodingkevin@gmail.com', '1', 1, 1, '4c19e884e72b3a58c649be20a9253f3a.png', 'f20d316345d6fafb1b829544200b0e56.png'),
(35, 'Pengentry', 'Kevin Gilbert Toding', 'pengentry', '92d1d9f3d403fba80a7fa82a04ee3ab753605abd9a02725bc2ef60ad', 'kevingilbertware@gmail.com', '1', 1, 2, '4c19e884e72b3a58c649be20a9253f3a.png', 'f20d316345d6fafb1b829544200b0e56.png'),
(36, 'Super Admin', 'Kevin Gilbert Toding', 'super admin', '769f747b1433a979bcdf39966221e9e1de33a2d999f18991cf1ca4a6', 'kevingilbertware@gmail.com', '1', 1, 3, '71bd14a430e1e659c0391053e3227742.png', 'af69a94c44f0ec21ec9165ee49a16ff6.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `iwkbu`
--
ALTER TABLE `iwkbu`
  ADD PRIMARY KEY (`iwkbu_id`);

--
-- Indexes for table `iwkl`
--
ALTER TABLE `iwkl`
  ADD PRIMARY KEY (`iwkl_id`);

--
-- Indexes for table `loket`
--
ALTER TABLE `loket`
  ADD PRIMARY KEY (`kode_loket`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `iwkbu`
--
ALTER TABLE `iwkbu`
  MODIFY `iwkbu_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=190;

--
-- AUTO_INCREMENT for table `iwkl`
--
ALTER TABLE `iwkl`
  MODIFY `iwkl_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=249;

--
-- AUTO_INCREMENT for table `loket`
--
ALTER TABLE `loket`
  MODIFY `kode_loket` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
