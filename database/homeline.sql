-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 01, 2023 at 03:39 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `homeline`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `user_id` varchar(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `level_id` varchar(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`user_id`, `username`, `level_id`, `email`, `password`) VALUES
('U0001', 'ADMIN', 'lvl003', 'admin123@gmail.com', '383ab00c3ca9e990d60b2d7b493215c4'),
('U0002', 'Faizalmakmur321', 'lvl001', 'faizal@gmail.com', '3adbf84fcc3478d48d608190a72187f3'),
('U0003', 'inesta', 'lvl002', 'ines@gmail.com', '9f93e68b0ed00aa53be71f228341346e'),
('U0004', 'miko', 'lvl001', 'miko@gmail.com', 'daac24b31d3fb2eb54c9deb8397d35f4'),
('U0005', 'Akbar123', 'lvl002', 'akbar@gmail.com', 'f039e5f60e85d10bf7b742e65ad931ca'),
('U0006', 'zihan123', 'lvl002', 'zihan@gmail.com', '21d70af5872ce9d00e343dc11bd47437'),
('U0007', 'alan123', 'lvl002', 'alan@gmail.com', 'bab891de979ae791cfa37bfc88ed9e88'),
('U0008', 'Ratna', 'lvl002', 'ratna@gmail.com', '1a6544e89e67f3b6d53c00ada12a5f2d');

-- --------------------------------------------------------

--
-- Table structure for table `account_level`
--

CREATE TABLE `account_level` (
  `level_id` varchar(10) NOT NULL,
  `role` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account_level`
--

INSERT INTO `account_level` (`level_id`, `role`) VALUES
('lvl001', 'Pembeli'),
('lvl002', 'Penjual'),
('lvl003', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `house_data`
--

CREATE TABLE `house_data` (
  `house_id` varchar(10) NOT NULL,
  `user_id` varchar(10) NOT NULL,
  `thumbnail_photo` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `price` double DEFAULT NULL,
  `home_address` varchar(255) NOT NULL,
  `no_wa` varchar(20) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status_id` varchar(5) NOT NULL DEFAULT 'S001'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `house_data`
--

INSERT INTO `house_data` (`house_id`, `user_id`, `thumbnail_photo`, `title`, `price`, `home_address`, `no_wa`, `description`, `status_id`) VALUES
('H00001', 'U0005', '62b5b05eee867.jpg', 'Rumah Kayu', 800000000, 'Jl. Kudus, Bedahan, Sawangan, Kota Depok, Jawa Barat', '887433065058', 'Mempunyai 2 kamar tidur, 2 kamar mandi, mempuanyai sebuah ruang tamu, dapur, dan juga sebuah Garasi.', 'S002'),
('H00002', 'U0005', '62b5b290d0f2a.jpg', 'Rumah Futuristik', 1450000000, 'Jl. Kenangan, Depok II, Margonda, Kota Depok, Jawa Barat', '82266012696', 'Mempunyai 2 kamar tidur, 2 kamar mandi, mempuanyai sebuah ruang tamu, dapur, dan juga sebuah Garasi.', 'S001'),
('H00003', 'U0005', '62b5b37b80434.jpg', 'Rumah Serem', 3560000000, 'Jl. Krukut, Pandawa, Grabag, Magelang, Jawa Tengah', '85161457030', 'Mempunyai 2 kamar tidur, 2 kamar mandi, mempuanyai sebuah ruang tamu, dapur, dan juga sebuah Garasi.', 'S002'),
('H00004', 'U0006', '62b5e097c0159.jpg', 'Rumah Rumahan', 2300000000, 'Jl. Tango, Kosambi, Jatimulya, Tanggerang, Tanggerang', '87733199288', 'Mempunyai 2 kamar tidur, 2 kamar mandi, mempuanyai sebuah ruang tamu, dapur, dan juga sebuah Garasi.', 'S002'),
('H00005', 'U0006', '63b1151a70c38.jpg', 'Rumah Industri', 1250000000, 'Jl. Ceres Rt 04/004, Mirit, Kebumen, Jawa Tengah.', '87733199288', 'Mempunyai 2 kamar tidur, 2 kamar mandi, mempuanyai sebuah ruang tamu, dapur, dan juga sebuah Garasi.', 'S002'),
('H00006', 'U0007', '63b277a394f21.jpg', 'Rumah Kita', 3000000000, 'Jl. Aqua', '87733199288', 'klamdkankndalnlasnfnalksf', 'S001');

-- --------------------------------------------------------

--
-- Table structure for table `house_data_status`
--

CREATE TABLE `house_data_status` (
  `status_id` varchar(5) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `house_data_status`
--

INSERT INTO `house_data_status` (`status_id`, `status`) VALUES
('S001', 'Waiting'),
('S002', 'Available'),
('S003', 'Sold');

-- --------------------------------------------------------

--
-- Table structure for table `house_photo`
--

CREATE TABLE `house_photo` (
  `house_id` varchar(10) NOT NULL,
  `photo_id` varchar(10) DEFAULT NULL,
  `sub_photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `house_photo`
--

INSERT INTO `house_photo` (`house_id`, `photo_id`, `sub_photo`) VALUES
('H00001', 'P000001', '62b5b234fs3.jpg'),
('H00001', 'P000002', '62b5bsdf.jpg'),
('H00002', 'P000003', '62b5ca435.jpg'),
('H00002', 'P000004', '62b5cadasd.jpg'),
('H00003', 'P000005', '62b5e4fds.jpg'),
('H00003', 'P000006', '62b5b234fs3.jpg'),
('H00004', 'P000007', '62b5bsdf.jpg'),
('H00004', 'P000008', '62b5cadasd.jpg'),
('H00005', 'P000009', '63a780fea29cd.jpg'),
('H00005', 'P000010', '63a780fea352b.jpg'),
('H00006', 'P000011', '63b277a3a4cb1.jpg'),
('H00006', 'P000012', '63b277a3a5b68.jpg'),
('H00006', 'P000013', '63b277a3a69e1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `sertivicate`
--

CREATE TABLE `sertivicate` (
  `house_id` varchar(10) NOT NULL,
  `sertiv_id` varchar(10) DEFAULT NULL,
  `sertiv_photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sertivicate`
--

INSERT INTO `sertivicate` (`house_id`, `sertiv_id`, `sertiv_photo`) VALUES
('H00001', 'S00001', '62c5sf3qf.jpg'),
('H00002', 'S00002', '62c5sf3qf.jpg'),
('H00003', 'S00003', '62c5sf3qf.jpg'),
('H00004', 'S00004', '62c5sf3qf.jpg'),
('H00005', 'S00005', '63a780fea1364.jpg'),
('H00006', 'S00006', '63b277a3a28ce.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `level_id` (`level_id`);

--
-- Indexes for table `account_level`
--
ALTER TABLE `account_level`
  ADD PRIMARY KEY (`level_id`);

--
-- Indexes for table `house_data`
--
ALTER TABLE `house_data`
  ADD PRIMARY KEY (`house_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `status_id` (`status_id`);

--
-- Indexes for table `house_data_status`
--
ALTER TABLE `house_data_status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `house_photo`
--
ALTER TABLE `house_photo`
  ADD KEY `house_id` (`house_id`);

--
-- Indexes for table `sertivicate`
--
ALTER TABLE `sertivicate`
  ADD KEY `house_id` (`house_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `account`
--
ALTER TABLE `account`
  ADD CONSTRAINT `account_ibfk_1` FOREIGN KEY (`level_id`) REFERENCES `account_level` (`level_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `house_data`
--
ALTER TABLE `house_data`
  ADD CONSTRAINT `house_data_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `account` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `house_data_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `house_data_status` (`status_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `house_photo`
--
ALTER TABLE `house_photo`
  ADD CONSTRAINT `house_photo_ibfk_1` FOREIGN KEY (`house_id`) REFERENCES `house_data` (`house_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sertivicate`
--
ALTER TABLE `sertivicate`
  ADD CONSTRAINT `sertivicate_ibfk_1` FOREIGN KEY (`house_id`) REFERENCES `house_data` (`house_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
