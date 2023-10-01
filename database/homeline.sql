-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 01, 2023 at 03:44 PM
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
