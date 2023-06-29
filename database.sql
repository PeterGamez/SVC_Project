-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 29, 2023 at 01:09 PM
-- Server version: 10.3.38-MariaDB-0+deb10u1-log
-- PHP Version: 8.0.28

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
  `password` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `role` enum('user','seller','staff','admin','superadmin') DEFAULT 'user',
  `create_at` datetime NOT NULL,
  `create_by` int(5) NOT NULL,
  `update_at` datetime NOT NULL,
  `update_by` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

CREATE TABLE `bank` (
  `id` int(5) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `create_at` datetime NOT NULL,
  `create_by` int(5) NOT NULL,
  `update_at` datetime NOT NULL,
  `update_by` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blacklist`
--

CREATE TABLE `blacklist` (
  `id` int(5) NOT NULL,
  `name` varchar(255) NOT NULL,
  `reason` varchar(255) NOT NULL,
  `blacklist_category_id` int(5) NOT NULL,
  `website` varchar(255) NOT NULL,
  `id_name` varchar(255) NOT NULL,
  `id_number` varchar(255) NOT NULL,
  `id_image` varchar(255) NOT NULL,
  `bank_id` int(5) NOT NULL,
  `bank_number` varchar(255) NOT NULL,
  `approve_agree` tinyint(1) NOT NULL DEFAULT 0,
  `approve_by` int(5) DEFAULT NULL,
  `approve_at` datetime DEFAULT NULL,
  `create_at` datetime NOT NULL,
  `create_by` int(5) NOT NULL,
  `update_at` datetime DEFAULT NULL,
  `update_by` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blacklist_category`
--

CREATE TABLE `blacklist_category` (
  `id` int(5) NOT NULL,
  `name` varchar(255) NOT NULL,
  `create_at` datetime NOT NULL,
  `create_by` int(5) NOT NULL,
  `update_at` datetime NOT NULL,
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
  `create_at` datetime NOT NULL,
  `create_by` int(5) NOT NULL,
  `update_at` datetime NOT NULL,
  `update_by` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `whitelist`
--

CREATE TABLE `whitelist` (
  `id` int(5) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `whitelist_category_id` int(5) NOT NULL,
  `account_id` int(5) NOT NULL,
  `banner` varchar(255) DEFAULT NULL,
  `website` varchar(255) NOT NULL,
  `id_name` varchar(255) NOT NULL,
  `id_number` varchar(255) NOT NULL,
  `id_image` varchar(255) NOT NULL,
  `approve_agree` tinyint(1) DEFAULT 0,
  `approve_at` datetime DEFAULT NULL,
  `approve_by` int(5) DEFAULT NULL,
  `create_at` datetime NOT NULL,
  `create_by` int(5) NOT NULL,
  `update_at` datetime NOT NULL,
  `update_by` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `whitelist_category`
--

CREATE TABLE `whitelist_category` (
  `id` int(5) NOT NULL,
  `name` varchar(255) NOT NULL,
  `create_at` datetime NOT NULL,
  `create_by` int(5) NOT NULL,
  `update_at` datetime NOT NULL,
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
-- Indexes for table `whitelist`
--
ALTER TABLE `whitelist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `whitelist_category`
--
ALTER TABLE `whitelist_category`
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
-- AUTO_INCREMENT for table `whitelist`
--
ALTER TABLE `whitelist`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `whitelist_category`
--
ALTER TABLE `whitelist_category`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
