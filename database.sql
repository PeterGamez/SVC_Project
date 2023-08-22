-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 20, 2023 at 09:02 PM
-- Server version: 10.3.39-MariaDB-0+deb10u1-log
-- PHP Version: 8.2.8

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
  `username` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `email_verified` enum('0','1') NOT NULL DEFAULT '0',
  `email_verified_at` datetime DEFAULT NULL,
  `password` varchar(60) NOT NULL,
  `avatar` varchar(100) DEFAULT NULL,
  `role` enum('user','seller','staff','admin','superadmin') DEFAULT 'user',
  `last_login` datetime DEFAULT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `create_by` int(5) NOT NULL,
  `update_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_by` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `approve`
--

CREATE TABLE `approve` (
  `id` int(5) NOT NULL,
  `name` varchar(50) NOT NULL,
  `color` varchar(10) NOT NULL DEFAULT 'secondary',
  `icon` varchar(50) NOT NULL,
  `whitelist` enum('0','1') NOT NULL DEFAULT '0',
  `whitelist_waiting` enum('0','1') DEFAULT '0',
  `blacklist` enum('0','1') NOT NULL DEFAULT '0',
  `create_at` datetime NOT NULL,
  `create_by` int(5) NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime NOT NULL,
  `update_by` int(5) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

CREATE TABLE `bank` (
  `id` int(5) NOT NULL,
  `name` varchar(50) NOT NULL,
  `image` varchar(110) NOT NULL,
  `create_at` datetime NOT NULL,
  `create_by` int(5) NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime NOT NULL,
  `update_by` int(5) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blacklist`
--

CREATE TABLE `blacklist` (
  `id` int(5) NOT NULL,
  `name` varchar(50) NOT NULL,
  `reason` varchar(255) NOT NULL,
  `website` varchar(50) NOT NULL,
  `blacklist_category_id` int(5) NOT NULL,
  `id_firstname` varchar(50) NOT NULL,
  `id_lastname` varchar(50) NOT NULL,
  `id_number` varchar(13) NOT NULL,
  `id_image` varchar(110) NOT NULL,
  `bank_id` int(5) NOT NULL,
  `bank_number` varchar(12) NOT NULL,
  `item_name` varchar(50) NOT NULL,
  `item_balance` int(5) NOT NULL,
  `item_date` datetime NOT NULL,
  `approve_id` int(5) NOT NULL DEFAULT 1,
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
  `name` varchar(50) NOT NULL,
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
  `image` varchar(110) NOT NULL,
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
  `email` varchar(50) NOT NULL,
  `token` varchar(20) NOT NULL,
  `verified` enum('0','1') NOT NULL,
  `type` enum('register','verify') NOT NULL,
  `expired_at` datetime NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `whitelist`
--

CREATE TABLE `whitelist` (
  `id` int(5) NOT NULL,
  `tag` varchar(50) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `account_id` int(5) NOT NULL,
  `banner` varchar(110) DEFAULT NULL,
  `website` varchar(50) NOT NULL,
  `id_firstname` varchar(50) NOT NULL,
  `id_lastname` varchar(50) NOT NULL,
  `id_number` varchar(13) NOT NULL,
  `id_image` varchar(110) NOT NULL,
  `approve_id` int(5) DEFAULT 1,
  `approve_reason` varchar(255) DEFAULT NULL,
  `approve_at` datetime DEFAULT NULL,
  `approve_by` int(5) DEFAULT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `create_by` int(5) NOT NULL,
  `update_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_by` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `whitelist_waiting`
--

CREATE TABLE `whitelist_waiting` (
  `id` int(5) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `account_id` int(5) NOT NULL,
  `banner` varchar(110) DEFAULT NULL,
  `website` varchar(50) NOT NULL,
  `id_firstname` varchar(50) NOT NULL,
  `id_lastname` varchar(50) NOT NULL,
  `id_number` varchar(13) NOT NULL,
  `id_image` varchar(110) NOT NULL,
  `approve_id` int(5) DEFAULT 1,
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
  ADD UNIQUE KEY `UNIQUE` (`username`,`email`) USING BTREE,
  ADD KEY `INDEX` (`email`,`username`) USING BTREE;

--
-- Indexes for table `approve`
--
ALTER TABLE `approve`
  ADD PRIMARY KEY (`id`),
  ADD KEY `INDEX` (`whitelist`,`blacklist`,`whitelist_waiting`) USING BTREE;

--
-- Indexes for table `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blacklist`
--
ALTER TABLE `blacklist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blacklist_ibfk_blacklist_category` (`blacklist_category_id`),
  ADD KEY `blacklist_ibfk_approve` (`approve_id`),
  ADD KEY `INDEX` (`id_firstname`,`id_lastname`,`id_number`) USING BTREE;

--
-- Indexes for table `blacklist_category`
--
ALTER TABLE `blacklist_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blacklist_image`
--
ALTER TABLE `blacklist_image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `INDEX` (`blacklist_id`) USING BTREE;

--
-- Indexes for table `email_verify`
--
ALTER TABLE `email_verify`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQUE` (`token`) USING BTREE,
  ADD KEY `INDEX` (`email`,`token`) USING BTREE;

--
-- Indexes for table `whitelist`
--
ALTER TABLE `whitelist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `whitelist_ibfk_approve` (`approve_id`),
  ADD KEY `INDEX` (`tag`,`account_id`,`approve_id`) USING BTREE,
  ADD KEY `whitelist_ibfk_account` (`account_id`);

--
-- Indexes for table `whitelist_waiting`
--
ALTER TABLE `whitelist_waiting`
  ADD PRIMARY KEY (`id`),
  ADD KEY `whitelist_waiting_ibfk_approve` (`approve_id`),
  ADD KEY `INDEX` (`account_id`,`approve_id`) USING BTREE;

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
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bank`
--
ALTER TABLE `bank`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;

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

--
-- AUTO_INCREMENT for table `whitelist_waiting`
--
ALTER TABLE `whitelist_waiting`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blacklist_image`
--
ALTER TABLE `blacklist_image`
  ADD CONSTRAINT `blacklist_image_ibfk_blacklist` FOREIGN KEY (`blacklist_id`) REFERENCES `blacklist` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `email_verify`
--
ALTER TABLE `email_verify`
  ADD CONSTRAINT `email_verify_ibfk_1` FOREIGN KEY (`email`) REFERENCES `account` (`email`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `whitelist`
--
ALTER TABLE `whitelist`
  ADD CONSTRAINT `whitelist_ibfk_account` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `whitelist_waiting`
--
ALTER TABLE `whitelist_waiting`
  ADD CONSTRAINT `whitelist_waiting_ibfk_account` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
