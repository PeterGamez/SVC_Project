-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 08, 2023 at 03:20 PM
-- Server version: 10.3.38-MariaDB-0+deb10u1-log
-- PHP Version: 8.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lastboss`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` int(5) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified` enum('0','1') NOT NULL DEFAULT '0',
  `email_verified_at` datetime DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `role` enum('user','seller','staff','admin','superadmin') DEFAULT 'user',
  `create_at` datetime NOT NULL,
  `create_by` int(5) NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime NOT NULL,
  `update_by` int(5) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `approve`
--

CREATE TABLE `approve` (
  `id` int(5) NOT NULL,
  `name` varchar(255) NOT NULL,
  `color` varchar(10) NOT NULL DEFAULT 'secondary',
  `icon` varchar(255) NOT NULL,
  `whitelist` enum('0','1') NOT NULL DEFAULT '0',
  `blacklist` enum('0','1') NOT NULL DEFAULT '0',
  `create_at` datetime NOT NULL,
  `create_by` int(5) NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime NOT NULL,
  `update_by` int(5) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `approve`
--

INSERT INTO `approve` (`id`, `name`, `color`, `icon`, `whitelist`, `blacklist`, `create_at`, `create_by`, `update_at`, `update_by`) VALUES
(1, 'รอตรวจสอบ', 'secondary', 'fa-sharp fa-light fa-circle-v', '1', '1', '2023-06-29 14:04:37', 1, '2023-06-29 14:04:37', 1),
(2, 'อนุมัติ', 'success', 'fa-sharp fa-light fa-circle-check', '1', '1', '2023-06-29 14:04:51', 1, '2023-06-29 14:04:51', 1),
(3, 'ไม่อนุมัติ', 'danger', 'fa-sharp fa-light fa-circle-xmark', '1', '1', '2023-06-29 14:05:03', 1, '2023-06-29 14:05:03', 1),
(4, 'คำขอแก้ไข', 'warning', 'fa-sharp fa-light fa-circle-plus', '1', '0', '2023-06-29 14:05:13', 1, '2023-06-29 14:05:13', 1),
(5, 'คำขอลบ', 'warning', 'fa-sharp fa-light fa-circle-exclamation', '1', '0', '2023-06-29 14:05:25', 1, '2023-06-29 14:05:25', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

CREATE TABLE `bank` (
  `id` int(5) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `create_at` datetime NOT NULL,
  `create_by` int(5) NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime NOT NULL,
  `update_by` int(5) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `bank`
--

INSERT INTO `bank` (`id`, `name`, `image`, `create_at`, `create_by`, `update_at`, `update_by`) VALUES
(1, 'ทรูมันนี่วอลเล็ท', 'https://cdn.discordapp.com/attachments/1122009587797725184/1123864475968217148/250743c44bf85102.png', '2023-06-25 09:57:24', 1, '2023-06-29 13:36:12', 1),
(2, 'ธนาคารกรุงศรีอยุธยา', 'https://cdn.discordapp.com/attachments/1122009587797725184/1123865524191895562/49f376f48a6f46ce.png', '2023-06-24 22:11:44', 1, '2023-06-29 13:40:21', 1),
(3, 'ธนาคารกรุงเทพ', 'https://cdn.discordapp.com/attachments/1122009587797725184/1123865573147820062/32baa6bdbd70b3e1.png', '2023-06-24 22:10:38', 1, '2023-06-29 13:40:33', 1),
(4, 'ธนาคารกรุงไทย', 'https://cdn.discordapp.com/attachments/1122009587797725184/1123865608447070269/9ce6cc915eb8c158.png', '2023-06-24 22:11:19', 1, '2023-06-29 13:40:41', 1),
(5, 'ธนาคารกสิกรไทย', 'https://cdn.discordapp.com/attachments/1122009587797725184/1123865645600231476/ff14888d14df3ee2.png', '2023-06-24 21:17:58', 1, '2023-06-29 13:40:50', 1),
(6, 'ธนาคารทหารไทยธนชาต', 'https://cdn.discordapp.com/attachments/1122009587797725184/1123865764454219796/6be4a7edea829e43.png', '2023-06-29 13:17:16', 1, '2023-06-29 13:41:18', 1),
(7, 'ธนาคารออมสิน', 'https://cdn.discordapp.com/attachments/1122009587797725184/1123865851133698119/dae95028634e3c3e.png', '2023-06-24 22:12:34', 1, '2023-06-29 13:41:39', 1),
(8, 'ธนาคารเกียรตินาคินภัทร', 'https://cdn.discordapp.com/attachments/1122009587797725184/1123865893911404544/54c77c3ac3c006e0.png', '2023-06-29 13:33:28', 1, '2023-06-29 13:41:49', 1),
(9, 'ธนาคารไทยพาณิชย์ ', 'https://cdn.discordapp.com/attachments/1122009587797725184/1123865938622685264/f0c5eea9e38f919d.png', '2023-06-24 22:13:20', 1, '2023-06-29 13:42:00', 1),
(10, 'พร้อมเพย์', 'https://cdn.discordapp.com/attachments/1122009587797725184/1123865990686584922/0e0c56629fb2711d.png', '2023-06-29 13:33:17', 1, '2023-06-29 13:42:12', 1);

-- --------------------------------------------------------

--
-- Table structure for table `blacklist`
--

CREATE TABLE `blacklist` (
  `id` int(5) NOT NULL,
  `name` varchar(255) NOT NULL,
  `reason` varchar(255) NOT NULL,
  `website` varchar(255) NOT NULL,
  `blacklist_category_id` int(5) NOT NULL,
  `id_firstname` varchar(255) NOT NULL,
  `id_lastname` varchar(255) NOT NULL,
  `id_number` varchar(255) NOT NULL,
  `id_image` varchar(255) NOT NULL,
  `bank_id` int(5) NOT NULL,
  `bank_number` varchar(255) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_balance` int(2) NOT NULL,
  `item_date` datetime NOT NULL,
  `approve_id` tinyint(1) NOT NULL DEFAULT 1,
  `approve_reason` varchar(255) DEFAULT NULL,
  `approve_by` int(5) DEFAULT NULL,
  `approve_at` datetime DEFAULT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `create_by` int(5) NOT NULL,
  `update_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_by` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blacklist_category`
--

CREATE TABLE `blacklist_category` (
  `id` int(5) NOT NULL,
  `name` varchar(255) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `create_by` int(5) NOT NULL,
  `update_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_by` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blacklist_image`
--

CREATE TABLE `blacklist_image` (
  `id` int(5) NOT NULL,
  `blacklist_id` int(5) NOT NULL,
  `image` varchar(255) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `create_by` int(5) NOT NULL,
  `update_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_by` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `email_verify`
--

CREATE TABLE `email_verify` (
  `id` int(5) NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `verifed` enum('0','1') NOT NULL,
  `expired_at` datetime NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `whitelist`
--

CREATE TABLE `whitelist` (
  `id` int(5) NOT NULL,
  `tag` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `account_id` int(5) NOT NULL,
  `banner` varchar(255) DEFAULT NULL,
  `website` varchar(255) NOT NULL,
  `id_firstname` varchar(255) NOT NULL,
  `id_lastname` varchar(255) NOT NULL,
  `id_number` varchar(255) NOT NULL,
  `id_image` varchar(255) NOT NULL,
  `approve_id` tinyint(1) DEFAULT 1,
  `approve_reason` varchar(255) DEFAULT NULL,
  `approve_at` datetime DEFAULT NULL,
  `approve_by` int(5) DEFAULT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `create_by` int(5) NOT NULL,
  `update_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_by` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username_2` (`username`),
  ADD UNIQUE KEY `email_2` (`email`),
  ADD KEY `email` (`email`),
  ADD KEY `username` (`username`) USING BTREE;

--
-- Indexes for table `approve`
--
ALTER TABLE `approve`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blacklist`
--
ALTER TABLE `blacklist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blacklist_category`
--
ALTER TABLE `blacklist_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blacklist_image`
--
ALTER TABLE `blacklist_image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_verify`
--
ALTER TABLE `email_verify`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `whitelist`
--
ALTER TABLE `whitelist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `approve`
--
ALTER TABLE `approve`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `bank`
--
ALTER TABLE `bank`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `blacklist`
--
ALTER TABLE `blacklist`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blacklist_category`
--
ALTER TABLE `blacklist_category`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blacklist_image`
--
ALTER TABLE `blacklist_image`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `email_verify`
--
ALTER TABLE `email_verify`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `whitelist`
--
ALTER TABLE `whitelist`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
