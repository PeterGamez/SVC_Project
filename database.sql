-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 03, 2023 at 03:55 PM
-- Server version: 10.3.39-MariaDB-0+deb10u1-log
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
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `create_by` int(5) NOT NULL,
  `update_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_by` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `username`, `email`, `email_verified`, `email_verified_at`, `password`, `avatar`, `role`, `create_at`, `create_by`, `update_at`, `update_by`) VALUES
(1, 'peter', 'chanakan.kea@gmail.com', '1', '2023-07-11 16:32:36', '$2y$10$y1iXCH2fJoKJ8SQrYi0WaOnA898DfYLcyBZGiZRq4aK85v.Vhw8u2', 'https://lh3.googleusercontent.com/a/AAcHTtfHhDm_aeVln-N4e6sIFduGI21Zlg5gNh8TzSjCXILjdg=s96-c', 'superadmin', '2023-06-08 14:14:25', 1, '2023-07-11 16:32:36', 1),
(2, 'mhai', 'j.baem.sjw@gmail.com', '0', NULL, '$2y$10$y1iXCH2fJoKJ8SQrYi0WaOnA898DfYLcyBZGiZRq4aK85v.Vhw8u2', 'https://lh3.googleusercontent.com/a/AAcHTtdJuVDzWSgwZTxVtdA2JEOJD2lUlVlJ6r2GevU9=s96-c', 'superadmin', '2023-06-08 20:03:15', 1, '2023-06-08 20:03:15', 1),
(3, 'sense', '0873323066z@gmail.com', '1', '2023-07-11 16:44:21', '$2y$10$y1iXCH2fJoKJ8SQrYi0WaOnA898DfYLcyBZGiZRq4aK85v.Vhw8u2', 'https://lh3.googleusercontent.com/a/AAcHTtcY0ZwPcczdKmgOD0tmRh5_eCM7v4O1tP6bKEAsODYkKW4=s96-c', 'admin', '2023-06-09 13:56:43', 1, '2023-07-11 16:44:21', 3),
(4, 'splinter', 'punkubon2549@gmail.com', '0', NULL, '$2y$10$UkQ6ILeaHP3KzWGqC7CP5uVsw2KpT9vLNHtRyBXE1LRUxhF23uwsS', NULL, 'seller', '2023-08-03 15:32:59', 0, '2023-08-03 15:32:59', 0),
(5, 'mre', '64301060028@technicrayong.ac.th', '0', NULL, '$2y$10$DYtZer0FmVXOpUZYI9QJgOKc2ol1x2JL3ZJX7piVaC.OTLA/lJuZq', NULL, 'seller', '2023-08-03 15:32:59', 0, '2023-08-03 15:32:59', 0),
(6, 'xcer', 'nanthida625@gmail.com', '0', NULL, '$2y$10$/C.ZCmG8h9jTG93Rp6IhReb8I6qcwJetcTy1Z2HC4uUQ.Dgo0Lhta', NULL, 'seller', '2023-08-03 15:33:00', 0, '2023-08-03 15:33:00', 0),
(7, 'shinobu', 'ccun473@gmail.com', '0', NULL, '$2y$10$ITupYMVsGn0Co39RkzelMejlpb5.e2GkXzl3rNO8Ce54Zno4.Ktp2', NULL, 'seller', '2023-08-03 15:33:00', 0, '2023-08-03 15:33:00', 0),
(8, 'sompong', 'panachai2304@gmail.com', '0', NULL, '$2y$10$6SCRBvTgnsVc5FiGHR1n9ukyLhWAhsFqNgyV14cHeFr9aUXfxy59e', NULL, 'seller', '2023-08-03 15:33:00', 0, '2023-08-03 15:33:00', 0),
(9, 'dekkhainitro', 'parm141265@gmail.com', '0', NULL, '$2y$10$efX4jNRjK2ShGxlIrqXj9.0C7eU5opUpi/J/Qj14I6k7rgmfeFq8i', NULL, 'seller', '2023-08-03 15:33:01', 0, '2023-08-03 15:33:01', 0),
(10, 'mingqishop', 'nananitrooo@gmail.com', '0', NULL, '$2y$10$NJt8qpeb8SGM4T6QUMuqEOHWIgcoEpb1tp8dAZM1UTL/GHm4u3O36', NULL, 'seller', '2023-08-03 15:33:01', 0, '2023-08-03 15:33:01', 0),
(11, 'sunkiss', 'thanatcha.npd@gmail.com', '0', NULL, '$2y$10$IMAOqLce8L9KdZdE2lZWMOBK.ZlWiE6ciDaSBi1K3S4cpL1A8FP9e', NULL, 'seller', '2023-08-03 15:33:01', 0, '2023-08-03 15:33:01', 0),
(12, 'noikwasarm', 'newgolf3@hotmail.com', '0', NULL, '$2y$10$akvZu/lnAeHZDerOFC0Nz.sUi4u5lJN0YeA8xZiM7hZTYTzmYGAuO', NULL, 'seller', '2023-08-03 15:33:02', 0, '2023-08-03 15:33:02', 0),
(13, 'maynitro', 'wrayyasinsmuthrthiy03@gmail.com', '0', NULL, '$2y$10$sq.MfZN.Y0dXMAlVJVXJxujES.OrMrrcFN33coz/bNZfsPFRDy.D2', NULL, 'seller', '2023-08-03 15:33:02', 0, '2023-08-03 15:33:02', 0),
(14, 'sora', 'xfifa62@gmail.com', '0', NULL, '$2y$10$kUFxPXPQ6OGV80TNxvObXeg9R2zSGm2AvYJuGoXppt2UDI.dO9DKC', NULL, 'seller', '2023-08-03 15:33:02', 0, '2023-08-03 15:33:02', 0),
(15, 'cooper', 'kongsirawit2005@gmail.com', '0', NULL, '$2y$10$bIDMU5VBfLMqjq.a1x5k6OHVg1pkenQghQtaDj2rJNO3MJz94vwxm', NULL, 'seller', '2023-08-03 15:33:02', 0, '2023-08-03 15:33:02', 0),
(16, 'xiaotimp', 'ballbuy0710@gmail.com', '0', NULL, '$2y$10$/rLqIT.zh1kCGLpwIULRNOppW42IoGAzp9zlVqh3lkAJpJw4ujk.q', NULL, 'seller', '2023-08-03 15:33:02', 0, '2023-08-03 15:33:02', 0),
(17, 'eslhv', 'yeen252252@gmail.com', '0', NULL, '$2y$10$S0KW55/NOzapOmUjvfmPfOAbVzVY6w8WS8ROd6XtnlA91nLVdFnsS', NULL, 'seller', '2023-08-03 15:33:02', 0, '2023-08-03 15:33:02', 0),
(18, 'withoutyou', 'frontbf0531@gmail.com', '0', NULL, '$2y$10$xhUfQmgP/2B97vHssYFz8.S/1QVE7tsCZmmtE5i8wcyZqvsF1Gsr2', NULL, 'seller', '2023-08-03 15:33:02', 0, '2023-08-03 15:33:02', 0),
(19, 'mamomi', 'hopfulying@gmail.com', '0', NULL, '$2y$10$/awrn0lcGXTDMIaHZHVZ7.rcj6v7cPR/SCi/CqtUypNHt0O2wSKE2', NULL, 'seller', '2023-08-03 15:33:02', 0, '2023-08-03 15:33:02', 0),
(20, 'shiro', 'shiro100446@gmail.com', '0', NULL, '$2y$10$YRFRFuEX5hBPzc4UXFlEKuuH/FrxGmM78x4CZPBWbhdjDpKLSdHTG', NULL, 'seller', '2023-08-03 15:33:02', 0, '2023-08-03 15:33:02', 0),
(21, 'babybigboy ', 'aembabybigboy@gmail.com', '0', NULL, '$2y$10$DmiGvguvy2/CqBA.5yFMRu2n8QTA6OcdhGE1yNLxMaAzQ/671wmgK', NULL, 'seller', '2023-08-03 15:33:02', 0, '2023-08-03 15:33:02', 0),
(22, 'bettermart', 'namenotnoob@gmail.com', '0', NULL, '$2y$10$UvW6rRHkm8gbeiMihyeoFO3/aLpmzk4KdmdM0z3oF/s2BJNxzs.s2', NULL, 'seller', '2023-08-03 15:33:03', 0, '2023-08-03 15:33:03', 0),
(23, 'halaservice', 'kanokpichaadpakdee3000@gmail.com', '0', NULL, '$2y$10$IGpW0VgT6PS5SLPEWapAe.efE4fWmIh7l/8UtyLntLZrCExFTcDvy', NULL, 'seller', '2023-08-03 15:33:03', 0, '2023-08-03 15:33:03', 0),
(24, 'dekchimon', 'nawapolmiw301059@gmail.com', '0', NULL, '$2y$10$afk7J5iszQOByYvAeZqNF./xgZTynmN/TJYG55myoBnJNxEiwPD5C', NULL, 'seller', '2023-08-03 15:33:03', 0, '2023-08-03 15:33:03', 0),
(25, 'rtxshopie', 'gunzeedrex@genailordx.com', '0', NULL, '$2y$10$Z.5RJhJfpwPs2binVXFti.8KepI1Q3mpFFtxp8kPXWhehJdSmWhvy', NULL, 'seller', '2023-08-03 15:33:03', 0, '2023-08-03 15:33:03', 0),
(26, 'chakeawnitro', 'pinpinathmalai@gmail.com', '0', NULL, '$2y$10$J/KGoSwIlmyyATjOLU3YxuRn6LBlY9EQpVg0ffIwbo0EbhXpPh52y', NULL, 'seller', '2023-08-03 15:33:03', 0, '2023-08-03 15:33:03', 0),
(27, 'horizon', 'tanonchai300549@gmail.com', '0', NULL, '$2y$10$Qj9fkXcyDlwkxdy/VZCqLuWBcRFNOYDccZ0Nv/Qyd7NrbPTaMx7ia', NULL, 'seller', '2023-08-03 15:33:03', 0, '2023-08-03 15:33:03', 0),
(28, '1001', 'aomsinliona@gmail.com', '0', NULL, '$2y$10$oqEbM6XBkHh/OhluWqvl1O9MVM8y0zdOLbsq43wmsIvdJKXmNGe7O', NULL, 'seller', '2023-08-03 15:33:03', 0, '2023-08-03 15:33:03', 0),
(29, 'sleep ', 'thinganchalee@gmail.com', '0', NULL, '$2y$10$dMksaoHsdcUwGoayeDP/qOLa41f5xoaIdl8PaFyKS2I3zU5v0pl0y', NULL, 'seller', '2023-08-03 15:33:03', 0, '2023-08-03 15:33:03', 0),
(30, 'brain', 'nam74102@gmail.com', '0', NULL, '$2y$10$M.dhQzV.6mgn.HvZWpDfR.WuABQTTrCA.bEtyc3TXmZ/14ei8mh2K', NULL, 'seller', '2023-08-03 15:33:03', 0, '2023-08-03 15:33:03', 0),
(31, 'highschool', 'smileok004@hotmail.com', '0', NULL, '$2y$10$cXBkVLxO/Z2Kh81B02.tPOPujcwzn/EqxdkTItqeINhNUOfj6HhhO', NULL, 'seller', '2023-08-03 15:33:03', 0, '2023-08-03 15:33:03', 0),
(32, 't3r', 'pannatornyxt03@gmail.com', '0', NULL, '$2y$10$T16H3VHc3Dkb77Xq.XiLCO.4RTxX0hcO9DK/Z2VT/tycVTlmQm.PK', NULL, 'seller', '2023-08-03 15:33:03', 0, '2023-08-03 15:33:03', 0),
(33, 'lonelyday', 'hotcold375@gmail.com', '0', NULL, '$2y$10$EHEtu3ZnYgqWlN4e4vvv2u5AOBAWhrYPXO.aYkgwtlX4tZ21W1W1G', NULL, 'seller', '2023-08-03 15:33:03', 0, '2023-08-03 15:33:03', 0),
(34, 'thunderboost', 'thunderboost.th@gmail.com', '0', NULL, '$2y$10$exWk4ziPygz6QY97Fs5gFO9nbTXE6wP1Z7o0vumY6ROtSKp0dA8fa', NULL, 'seller', '2023-08-03 15:33:04', 0, '2023-08-03 15:33:04', 0),
(35, 'honghong', 'kanghun2547@gmail.com', '0', NULL, '$2y$10$PpUEdmIc.0wq1jIzIRQcxeYsljauU7oOQWkAgjy9jM/L4g37krjay', NULL, 'seller', '2023-08-03 15:33:04', 0, '2023-08-03 15:33:04', 0),
(36, 'kalamang', 'gungun390143@gmail.com', '0', NULL, '$2y$10$WbTJjnnFXgnustRHrfXSDOfdYBmBzFwn8VYUF1c1.cDSxWPA07kFm', NULL, 'seller', '2023-08-03 15:33:04', 0, '2023-08-03 15:33:04', 0),
(37, 'angel', 'pikachuamp@gmail.com', '0', NULL, '$2y$10$EYhAcgok.9TrtdoPifAWJeLFT2tUcAEpfR7M9ggkIYYXZzRjy6jjG', NULL, 'seller', '2023-08-03 15:33:04', 0, '2023-08-03 15:33:04', 0),
(38, 'killua', 'jeydczsdwdw@gmail.com', '0', NULL, '$2y$10$HA1rI5m2QXLfKMMS0ZGn1exnjg.uoJ2aIRONdcDOD8oOvrZrFhkxS', NULL, 'seller', '2023-08-03 15:33:04', 0, '2023-08-03 15:33:04', 0),
(39, 'summer', 'fxcus06@gmail.com', '0', NULL, '$2y$10$NC/FMrFsvl8f5GxR4TdU6.zoZyu8uwuiwbQbpbsrNGQTXrWZiknVW', NULL, 'seller', '2023-08-03 15:33:04', 0, '2023-08-03 15:33:04', 0),
(40, 'pangko', 'consideb@hotmail.com', '0', NULL, '$2y$10$a0gA95FVm/KEPA6Q0MyewupuYUEBYyxlogiOoJ5FN4y23T0Ig6Vae', NULL, 'seller', '2023-08-03 15:33:04', 0, '2023-08-03 15:33:04', 0),
(41, 'robcannabis', 'robshop36@gmail.com', '0', NULL, '$2y$10$SrO9N3tx7Big5R/Tt0aHCen4io6YQCL.Y38zLqAWiBpDa4B8iBUf.', NULL, 'seller', '2023-08-03 15:33:04', 0, '2023-08-03 15:33:04', 0),
(42, 'geevee', 'thewarit025@gmail.com', '0', NULL, '$2y$10$C0KhVec3ICfggdn1uGKQp.ZBBXLh0NyhTZhioseEKo0ZrXVtyBErO', NULL, 'seller', '2023-08-03 15:33:04', 0, '2023-08-03 15:33:04', 0),
(43, 'pandora', 'merschmeath9@hotmail.com', '0', NULL, '$2y$10$zGvxXXx09zk.OKR4gs4qDuekbrtfWtjKUOLEZ23RJ5fIFfD3Zo4Ya', NULL, 'seller', '2023-08-03 15:33:04', 0, '2023-08-03 15:33:04', 0),
(44, 'jaomin', 'saranpong.masang@gmail.com', '0', NULL, '$2y$10$mTll22KMUPDo20fFCdXpSubx6uNVXoEVIIthJQxnr..bC.7lNBfye', NULL, 'seller', '2023-08-03 15:33:04', 0, '2023-08-03 15:33:04', 0),
(45, 'lava', 'phairodyowa1@gmail.com', '0', NULL, '$2y$10$uwBerd2BxPnziP00pdyEsOJTPrlsXjPMlhHNXyr.qBhmTZwQOjjLu', NULL, 'seller', '2023-08-03 15:33:04', 0, '2023-08-03 15:33:04', 0),
(46, 'chillvibes', 'meko.meowmeow@gmail.com', '0', NULL, '$2y$10$n78e/b5hr/lY8AcZEEvXeu97Sa1lNVNcKcIp/OhWQ190X062iGEMy', NULL, 'seller', '2023-08-03 15:33:05', 0, '2023-08-03 15:33:05', 0),
(47, 'picha', 'aaim46514@gmil.com', '0', NULL, '$2y$10$zNU3tCCObpsxH6XGgH/VfO8LDkpKDOH9GM9sLWS5Lnxdpy69o13UK', NULL, 'seller', '2023-08-03 15:33:05', 0, '2023-08-03 15:33:05', 0),
(48, 'happypluem', 'naphuk5522@gmail.com', '0', NULL, '$2y$10$T3Mol52vAxPmSroqHnElhuB4itbN4RXn2E.uhJ97kIEKdgfdho/Fi', NULL, 'seller', '2023-08-03 15:33:05', 0, '2023-08-03 15:33:05', 0),
(49, 'stellalou', 'ntnattamon19@gmail.com', '0', NULL, '$2y$10$vNXGkrMOls4tC0VqVwayx..On/rFqbEDDXpxOTBp5ZWQ6D9v1Ctw6', NULL, 'seller', '2023-08-03 15:33:05', 0, '2023-08-03 15:33:05', 0),
(50, 'skyall', 'skyball.allstore@gmail.com', '0', NULL, '$2y$10$aS/MAjRNc/rkzUE3HXgLCeAiuncMeqltccvOoxvwyFn62jUo8axO2', NULL, 'seller', '2023-08-03 15:33:05', 0, '2023-08-03 15:33:05', 0),
(51, 'whitefuyu', 'prytaz.ch@gmail.com', '0', NULL, '$2y$10$Yz5i5A16rULiXxYEup2Mz.OqMs6gglB6cPnQAoHrb5yIzQ7asjHfW', NULL, 'seller', '2023-08-03 15:33:05', 0, '2023-08-03 15:33:05', 0),
(52, 'sarxnx', 'indonesiamark7414@gmail.com', '0', NULL, '$2y$10$DPwBk00a86st5rvc9mMgfu6SOB1/8F447udWTY.msAOQAvcsI4Vjm', NULL, 'seller', '2023-08-03 15:33:05', 0, '2023-08-03 15:33:05', 0),
(53, 'luna', 'lunashop1512@gmail.com', '0', NULL, '$2y$10$reJUvsPc3C/LVLwUTZVp6u94hh504/wi5tT0sFi/kRlLFgAf70WRa', NULL, 'seller', '2023-08-03 15:33:05', 0, '2023-08-03 15:33:05', 0),
(54, 'musub', 'chachatee123456789@gmail.com', '0', NULL, '$2y$10$NRVuxShCeGxye7EYskFUjOZWryQf3k7VozvZhyAjW2R6LW2eZfdrS', NULL, 'seller', '2023-08-03 15:33:05', 0, '2023-08-03 15:33:05', 0),
(55, 'b2j', 'daosirirotk@gmail.com', '0', NULL, '$2y$10$NjWp4MbswFk4UeDkp0wtzuyu4/.aZNmHjdfH6DEm612l8MvO1Bgh2', NULL, 'seller', '2023-08-03 15:33:06', 0, '2023-08-03 15:33:06', 0),
(56, 'dubleake', 'aekoop20@gmail.com', '0', NULL, '$2y$10$qahwHR7dKQGtQdSFPG.wAe8LA/irfBmbXiS4aWwF7irMeRmweYZL6', NULL, 'seller', '2023-08-03 15:33:06', 0, '2023-08-03 15:33:06', 0),
(57, '2000x', 'phumin_olo2543@hotmail.com', '0', NULL, '$2y$10$8iIiVqAcgGZ4omx9xKnvR.dQxZaD74I/0JgtyRi4HosVc94No1cvW', NULL, 'seller', '2023-08-03 15:33:06', 0, '2023-08-03 15:33:06', 0),
(58, 'jnmumi', 'ployploy182549@gmail.com', '0', NULL, '$2y$10$k99L5ROYnnfMiq5TjC4.tuFlmJeLgg77.RELoYyuIgRLe37e5UTe6', NULL, 'seller', '2023-08-03 15:33:06', 0, '2023-08-03 15:33:06', 0),
(59, 'cookiieznoir', 'f0ndantz@gmail.com', '0', NULL, '$2y$10$VBx9jQYuNAbD91FZobbSn.pu3j8nsedLORTuyVXrPW.iK2Cs.zFrW', NULL, 'seller', '2023-08-03 15:33:06', 0, '2023-08-03 15:33:06', 0);

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

--
-- Dumping data for table `blacklist`
--

INSERT INTO `blacklist` (`id`, `name`, `reason`, `website`, `blacklist_category_id`, `id_firstname`, `id_lastname`, `id_number`, `id_image`, `bank_id`, `bank_number`, `item_name`, `item_balance`, `item_date`, `approve_id`, `approve_reason`, `approve_by`, `approve_at`, `create_at`, `create_by`, `update_at`, `update_by`) VALUES
(1, '1', '1', '1', 1, '1', '1', '1', 'https://cdn.discordapp.com/attachments/1122438398569877634/1124718736318935060/8b90.png', 1, '1', '1', 1, '2023-07-01 22:10:00', 1, NULL, NULL, NULL, '2023-07-01 22:10:43', 1, '2023-07-01 22:10:43', 1),
(2, '2', '2', '2', 1, '2', '2', '2', 'https://cdn.discordapp.com/attachments/1122438398569877634/1124719161390661664/8f8d.png', 1, '2', '2', 2, '2023-07-01 22:12:00', 1, NULL, NULL, NULL, '2023-07-01 22:12:24', 1, '2023-07-01 22:12:24', 1);

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

--
-- Dumping data for table `blacklist_category`
--

INSERT INTO `blacklist_category` (`id`, `name`, `create_at`, `create_by`, `update_at`, `update_by`) VALUES
(1, 'ฉ้อโกงการซื้อขาย', '2023-07-08 14:39:54', 1, '2023-07-08 14:39:54', 1),
(2, 'พฤติกรรมน่าสงสัย', '2023-07-08 14:40:07', 1, '2023-07-08 14:40:07', 1);

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

--
-- Dumping data for table `blacklist_image`
--

INSERT INTO `blacklist_image` (`id`, `blacklist_id`, `image`, `create_at`, `create_by`, `update_at`, `update_by`) VALUES
(1, 1, 'https://cdn.discordapp.com/attachments/1118810897067036702/1124716981111750676/b15f.png', '2023-07-01 22:03:44', 1, '2023-07-01 22:03:44', 1),
(2, 1, 'https://cdn.discordapp.com/attachments/1118810897067036702/1124718739766652928/525a.png', '2023-07-01 22:10:44', 1, '2023-07-01 22:10:44', 1),
(3, 2, 'https://cdn.discordapp.com/attachments/1118810897067036702/1124719165559820358/3a43.png', '2023-07-01 22:12:25', 1, '2023-07-01 22:12:25', 1);

-- --------------------------------------------------------

--
-- Table structure for table `email_verify`
--

CREATE TABLE `email_verify` (
  `id` int(5) NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `verified` enum('0','1') NOT NULL,
  `expired_at` datetime NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `email_verify`
--

INSERT INTO `email_verify` (`id`, `email`, `token`, `verified`, `expired_at`, `create_at`) VALUES
(1, 'chanakan.kea@gmail.com', 'zAELGCFlnzCvUVhw', '1', '2023-07-11 17:05:20', '2023-07-11 16:05:20'),
(2, '0873323066z@gmail.com', 'sw9e3SpLDd1DnMuK', '1', '2023-07-11 17:43:25', '2023-07-11 16:43:25');

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
-- Dumping data for table `whitelist`
--

INSERT INTO `whitelist` (`id`, `tag`, `name`, `description`, `account_id`, `banner`, `website`, `id_firstname`, `id_lastname`, `id_number`, `id_image`, `approve_id`, `approve_reason`, `approve_at`, `approve_by`, `create_at`, `create_by`, `update_at`, `update_by`) VALUES
(1, 'WLS00001', 'SPLINTER STORE', ' ร้านขายสินค้า ดิสคอร์ด . แอพดูหนังฯ . เติมเกม บริดีงานไว ปลอดภัยแน่นอน', 3, 'https://share.creavite.co/FYWuGbpNLlpQU7AX.png', 'https://discord.gg/C348XCkZrb', 'ปุณณสิน', 'วงศ์ขวัญ', '', '', 2, 'โอนย้ายข้อมูลเดิม', '2023-08-03 15:47:17', 1, '2023-08-03 15:37:14', 1, '2023-08-03 15:37:14', 1),
(2, 'WLS00002', 'MRE Nitro', '-', 4, 'https://cdn.discordapp.com/embed/avatars/0.png', 'https://discord.gg/Zdy63mt4sY', 'จิรายุส', 'พลรักษา', '', '', 2, 'โอนย้ายข้อมูลเดิม', '2023-08-03 15:47:17', 1, '2023-08-03 15:37:14', 1, '2023-08-03 15:37:14', 1),
(3, 'WLS00003', 'Xcershop', '-', 5, 'https://cdn.discordapp.com/embed/avatars/0.png', 'https://facebook.com/profile.php?id=100084658511431', 'มัลลิกา', 'ขันทอง', '', '', 2, 'โอนย้ายข้อมูลเดิม', '2023-08-03 15:47:17', 1, '2023-08-03 15:37:14', 1, '2023-08-03 15:37:14', 1),
(4, 'WLS00004', 'JomJun Shop', 'รับเติมไนโตรราคาถูก/รับทำระบบ Discord/ขายไก่ตัน/และฯลฯอีกมากมาย', 6, 'https://cdn.discordapp.com/embed/avatars/0.png', 'https://discord.gg/SEkqJEShNx', 'ปานิตา', 'ทูลนอก', '', '', 2, 'โอนย้ายข้อมูลเดิม', '2023-08-03 15:47:17', 1, '2023-08-03 15:37:14', 1, '2023-08-03 15:37:14', 1),
(5, 'WLS00005', 'กอจอ ขายตามใจ', '-', 7, 'https://cdn.discordapp.com/embed/avatars/0.png', 'https://discord.gg/BXND9qBYBu', 'ปณชัย', 'ข่วงทิพย์', '', '', 2, 'โอนย้ายข้อมูลเดิม', '2023-08-03 15:47:17', 1, '2023-08-03 15:37:14', 1, '2023-08-03 15:37:14', 1),
(6, 'WLS00006', 'DekKhaiNitro', 'รับทุกอย่างที่เกี่ยวกับ Discord และ Five M (ร้านสารพัดรับจ้าง)', 8, 'https://cdn.discordapp.com/embed/avatars/0.png', 'https://discord.gg/dekkhainitro', 'ธีร์ดนัย', 'รัตนกุลชัยนันท์', '', '', 2, 'โอนย้ายข้อมูลเดิม', '2023-08-03 15:47:17', 1, '2023-08-03 15:37:14', 1, '2023-08-03 15:37:14', 1),
(7, 'WLS00007', 'kwanxi.shop', 'รับเติมไนโตรบูสต์ / ขายลิ้งค์ไนโตรต่างๆ / ขายแอคติดไนโตรราคาถูก - ꒱', 9, 'https://cdn.discordapp.com/embed/avatars/0.png', 'https://discord.gg/swcFJ6gy2f', 'มิ่งขวัญ', 'ชูชีพ', '', '', 2, 'โอนย้ายข้อมูลเดิม', '2023-08-03 15:47:17', 1, '2023-08-03 15:37:14', 1, '2023-08-03 15:37:14', 1),
(8, 'WLS00008', 'Sunkiss shop', '-', 10, 'https://media.discordapp.net/attachments/1049172355521458258/1052967551275122698/90_20221031103523.png?width=701&height=701', 'https://discord.gg/sunkisshop', 'ธนัชชา', 'นิลประดิษฐ', '', '', 2, 'โอนย้ายข้อมูลเดิม', '2023-08-03 15:47:17', 1, '2023-08-03 15:37:14', 1, '2023-08-03 15:37:14', 1),
(9, 'WLS00009', 'NoiKwaSarm', '-', 11, 'https://cdn.discordapp.com/attachments/1051906584869085195/1053230771961348136/LogoNKS.png', 'https://discord.gg/qBXBB8DMh4', 'พชรพล', 'แก้วศรีขำ', '', '', 2, 'โอนย้ายข้อมูลเดิม', '2023-08-03 15:47:17', 1, '2023-08-03 15:37:14', 1, '2023-08-03 15:37:14', 1),
(10, 'WLS00010', 'MAY Nitro', '-', 12, 'https://cdn.discordapp.com/embed/avatars/0.png', 'https://discord.gg/dBTSEtTX', 'วรัญญา', 'สินสมุทรไทย', '', '', 2, 'โอนย้ายข้อมูลเดิม', '2023-08-03 15:47:17', 1, '2023-08-03 15:37:14', 1, '2023-08-03 15:37:14', 1),
(11, 'WLS00011', 'SORA shop', 'รับทำเซิร์ฟเวอร์ เซ็ตระบบ ขายไนโตร และอื่นๆ', 13, 'https://cdn.discordapp.com/attachments/958047331629035610/1052972264062197800/SORA_SHOP_logo2.png', 'https://discord.gg/EUy3FD4P5K', 'นาซีฟะห์', 'บูละ', '', '', 2, 'โอนย้ายข้อมูลเดิม', '2023-08-03 15:47:17', 1, '2023-08-03 15:37:14', 1, '2023-08-03 15:37:14', 1),
(12, 'WLS00012', 'คูเป๋อขายไนโตร', 'รับเติมไนโตร /เติม PointValorant /App-premium', 14, 'https://media.discordapp.net/attachments/1041716260699910248/1052976012973047808/100_20221031104452.png?width=701&height=701', 'https://discord.gg/kUs492hJxd ', 'ศิรวิทย์', 'ดิสโร', '', '', 2, 'โอนย้ายข้อมูลเดิม', '2023-08-03 15:47:17', 1, '2023-08-03 15:37:15', 1, '2023-08-03 15:37:15', 1),
(13, 'WLS00013', 'XiaoTimp Nitro', 'รับเติมไนโตร ????\r\nไนโตเบสิค/บูสต์\r\n\r\n', 15, 'https://cdn.discordapp.com/embed/avatars/0.png', 'https://discord.gg/H4fVG47gJa', 'ชินวัตร', 'สองธานี', '', '', 2, 'โอนย้ายข้อมูลเดิม', '2023-08-03 15:47:17', 1, '2023-08-03 15:37:15', 1, '2023-08-03 15:37:15', 1),
(14, 'WLS00014', 'eslhv shop', '-', 16, 'https://cdn.discordapp.com/embed/avatars/0.png', 'https://facebook.com/profile.php?id=100088353417489', 'พลอยชนก', 'สามเกษร', '', '', 2, 'โอนย้ายข้อมูลเดิม', '2023-08-03 15:47:17', 1, '2023-08-03 15:37:15', 1, '2023-08-03 15:37:15', 1),
(15, 'WLS00015', 'withoutyou', 'รับกด Nitro ราคาถูก เริ่มต้นที่ 100 บาท เท่านั้น /  รับกด App Premium ทุกประเภท เช่น Faceapp', 17, 'https://cdn.discordapp.com/attachments/1051631538502107158/1058412811115577475/discord_by_tnorf.png', 'https://discord.gg/V8ukGrTyEm', 'ณัฏฐ์ธรัช', 'สิทธิอุดมพร', '', '', 2, 'โอนย้ายข้อมูลเดิม', '2023-08-03 15:47:17', 1, '2023-08-03 15:37:15', 1, '2023-08-03 15:37:15', 1),
(16, 'WLS00016', 'MAMOMI SHOP', 'ร้านนี้ตึง บอกแค่นี้', 18, 'https://media.discordapp.net/attachments/1008674309667037255/1053290835778732093/MAMOMI_SHOP.png?width=605&height=585', 'https://discord.gg/mamomishop', 'ภัทรจักร', 'เงาะเศษ', '', '', 2, 'โอนย้ายข้อมูลเดิม', '2023-08-03 15:47:17', 1, '2023-08-03 15:37:15', 1, '2023-08-03 15:37:15', 1),
(17, 'WLS00017', 'shiro', '-', 19, 'https://cdn.discordapp.com/embed/avatars/0.png', 'https://facebook.com/hoyoung100446', 'นริศรา', 'อุดมสมัคร', '', '', 2, 'โอนย้ายข้อมูลเดิม', '2023-08-03 15:47:17', 1, '2023-08-03 15:37:15', 1, '2023-08-03 15:37:15', 1),
(18, 'WLS00018', 'BABYBIGBOY SHOP', 'รับทําดิสคอร์ด,ระบบต่างๆ\r\nดิสสําเร็จราคาเริ่มต้น 30-100฿\r\nสามารถกดคําว่า \" ไปยังร้าน \" เพื่อทักไปสั่งทําได้เลยครับ อัพเดทลิ้งค์แล้วครับ', 20, 'https://cdn.discordapp.com/embed/avatars/0.png', 'https://facebook.com/imma.nattawat', 'ณัฐวัฒร', 'ระวีวงษ์', '', '', 2, 'โอนย้ายข้อมูลเดิม', '2023-08-03 15:47:17', 1, '2023-08-03 15:37:15', 1, '2023-08-03 15:37:15', 1),
(19, 'WLS00019', 'Better_Mart', 'ขายNitro Discord/Roblox ตัวไก่ตัน และอื่นๆ สนใจกดเข้าดิสมาได้เลอออ\nมีแจกของในดิสด้วยน้าาา จุ้ฟๆ\nแอดมิน ชิทโพสต์mark ใจดี? ต่อรองราคาได้ หายใจไม่ออกก', 21, 'https://media.discordapp.net/attachments/681647576902139979/1056607937260441656/bettermart.png', 'https://discord.gg/6qP45FHUVX', 'เนติณัฎฐ์ ', 'ณรงคะชวนะ', '', '', 2, 'โอนย้ายข้อมูลเดิม', '2023-08-03 15:47:17', 1, '2023-08-03 15:37:16', 1, '2023-08-03 15:37:16', 1),
(20, 'WLS00020', 'HALA SERVICE', '-', 22, 'https://cdn.discordapp.com/icons/921284305936859217/758d93101a4ade26fd9e4d55e2154217.webp', 'https://discord.gg/tyHZR8QCPP', 'กนกพิชญ์', 'อาจภักดี', '', '', 2, 'โอนย้ายข้อมูลเดิม', '2023-08-03 15:47:17', 1, '2023-08-03 15:37:16', 1, '2023-08-03 15:37:16', 1),
(21, 'WLS00021', 'DekChimon', '-', 23, 'https://cdn.discordapp.com/embed/avatars/0.png', 'https://discord.gg/RYBWwVQFQ9', 'จิตรลดา ', 'กรดมณี', '', '', 2, 'โอนย้ายข้อมูลเดิม', '2023-08-03 15:47:17', 1, '2023-08-03 15:37:16', 1, '2023-08-03 15:37:16', 1),
(22, 'WLS00022', 'RTXSHOPIE', 'ร้านขายไอดีเกมมายคราฟ Toy Code และอื่นๆ อีกมากมาย', 24, 'https://www.bng-img.ml/images/20221208rTmhxv772a4RDK2c11Ot.png', 'https://rtxshopie.com/', 'ธนกฤต', 'แย้มสุข', '', '', 2, 'โอนย้ายข้อมูลเดิม', '2023-08-03 15:47:17', 1, '2023-08-03 15:37:16', 1, '2023-08-03 15:37:16', 1),
(23, 'WLS00023', 'Chakeaw Nitro Shop', 'รับเติม Nitro discord แลกเงิน เติมเกมต่างๆ', 25, 'https://cdn.discordapp.com/attachments/998521940287434792/1056458446372876288/66_20221225132524.png', 'https://discord.gg/gNcn7wSryg', 'ปิ่นปินัทธ์', 'มาลัย', '', '', 2, 'โอนย้ายข้อมูลเดิม', '2023-08-03 15:47:17', 1, '2023-08-03 15:37:16', 1, '2023-08-03 15:37:16', 1),
(24, 'WLS00024', '1001 SHOP', 'บริการเติมNitro , เติมเกม และจำหน่ายแอพพรีเมียม ฯลฯ', 26, 'https://cdn.discordapp.com/attachments/1059074784396316695/1061492389648277626/20230108_105041_0000.png', 'https://discord.gg/cm7A8PGRwD', 'รุ่งวิกรัย', 'ลายทอง', '', '', 2, 'โอนย้ายข้อมูลเดิม', '2023-08-03 15:47:17', 1, '2023-08-03 15:37:17', 1, '2023-08-03 15:37:17', 1),
(25, 'WLS00025', 'คุณนอนรับเติมไนโตรนะ', 'รับเติมไนโตรราคาถูก\r\nบริการรับแลกเงิน วอ&ธนาคาร\r\n', 27, 'https://cdn.discordapp.com/embed/avatars/0.png', 'https://discord.gg/8na9uyJZbk', 'อัญชลี', 'แซ่จง', '', '', 2, 'โอนย้ายข้อมูลเดิม', '2023-08-03 15:47:17', 1, '2023-08-03 15:37:17', 1, '2023-08-03 15:37:17', 1),
(26, 'WLS00026', 'Horizon Store', 'บริการขายสินค้า ต่างๆ  เช่น Nitro ID-PASS / NItro GIFT / VCC / Token อายุ 1 เดือน / แอพดูหนัง / Nitro 1M & 3M\r\nปลอดภัยรวดเร็วไม่มีการ Refund', 28, 'https://cdn.discordapp.com/embed/avatars/0.png', 'https://discord.gg/HwXc2sbH3B', 'ธนาคิม', 'แซ่ฉั่ว', '', '', 2, 'โอนย้ายข้อมูลเดิม', '2023-08-03 15:47:17', 1, '2023-08-03 15:37:17', 1, '2023-08-03 15:37:17', 1),
(27, 'WLS00027', 'Brain Shop', '⚒️ รับทำระบบเซิฟเวอร์ดิสคอร์ด พร้อมใช้งาน ✏️ ออกแบบสื่อ โลโก้ แบนเนอร์', 29, 'https://media.discordapp.net/attachments/1053309685987557466/1053309845874421760/4AB38483-8E47-41CC-8368-72D66A944B15.png', 'https://discord.gg/fj9GVvJuxW', 'ตะวัน', 'นามโสม', '', '', 2, 'โอนย้ายข้อมูลเดิม', '2023-08-03 15:47:17', 1, '2023-08-03 15:37:17', 1, '2023-08-03 15:37:17', 1),
(28, 'WLS00028', 'HighSchool Shop', 'บริการรับเติม Nitro ( BACIS / BOOSTER )  ราคาถูก ', 30, 'https://cdn.discordapp.com/embed/avatars/0.png', 'https://www.facebook.com/bangflim007', 'ณัฐวุฒิ', 'หนูแก้ว', '', '', 2, 'โอนย้ายข้อมูลเดิม', '2023-08-03 15:47:17', 1, '2023-08-03 15:37:17', 1, '2023-08-03 15:37:17', 1),
(29, 'WLS00029', '♡ T3R STORE ヅ', '– รับเติม Discord Nitro\r\n– ขายแอพพรีเมี่ยมต่างๆ\r\n– รับปลดแบน FiveM\r\n– รับแก้ปัญหาเกี่ยวกับคอมพิวเตอร์ทุกอาการ', 31, 'https://media.discordapp.net/attachments/1045786656558567565/1070706908022972547/Y2KT3R.png?', 'https://discord.gg/JcePbSSRjA', 'ปัณณธร', 'ยุทธกิจกำจร', '', '', 2, 'โอนย้ายข้อมูลเดิม', '2023-08-03 15:47:17', 1, '2023-08-03 15:37:17', 1, '2023-08-03 15:37:17', 1),
(30, 'WLS00030', 'Momay Shop', 'บริการรับเติมไนโตร ราคาถูก!\r\nเริ่มต้น 59 บาท', 32, 'https://i.imgur.com/wx1RWJy.jpg', 'https://discord.gg/momayshop', 'ศุภณัฐ', 'ชาวโพสะ', '', '', 2, 'โอนย้ายข้อมูลเดิม', '2023-08-03 15:47:17', 1, '2023-08-03 15:37:17', 1, '2023-08-03 15:37:17', 1),
(31, 'WLS00031', 'THUNDER BOOST', 'จำหน่ายผลิตภัณฑ์เกี่ยวกับ Discord\r\n- เติม Nitro\r\n- ส่ง Nitro Gift\r\n- บริการเม็ดบูสต์เซิฟเวอร์\r\nบริการประทับใจยิ่งกว่าญาติสนิท การันตีด้วยความรักที่มอบให้ทุกคนนนน~', 33, 'https://cdn.discordapp.com/embed/avatars/0.png', 'https://discord.gg/thunderboost', 'ชาตรี', 'ฐิตานุวงศ์', '', '', 2, 'โอนย้ายข้อมูลเดิม', '2023-08-03 15:47:17', 1, '2023-08-03 15:37:18', 1, '2023-08-03 15:37:18', 1),
(32, 'WLS00032', 'HongHongShop', 'บริการกดเกมพาสทุกแมพ [Roblox]\r\nบริการไก่ตัน BloxFruit\r\nรับเติมเกมออนไลน์', 34, 'https://cdn.discordapp.com/attachments/1026802803823362090/1071708033819885608/page.png', 'https://www.facebook.com/profile.php?id=100089362911271', 'กังหัน', 'แสงอรุณ', '', '', 2, 'โอนย้ายข้อมูลเดิม', '2023-08-03 15:47:17', 1, '2023-08-03 15:37:18', 1, '2023-08-03 15:37:18', 1),
(33, 'WLS00033', 'KALAMANG STORE', '-', 35, 'https://cdn.discordapp.com/embed/avatars/0.png', 'https://discord.gg/rySv58WBJs', 'ฟ้าคุ้ม', 'นวลขจี', '', '', 2, 'โอนย้ายข้อมูลเดิม', '2023-08-03 15:47:17', 1, '2023-08-03 15:37:18', 1, '2023-08-03 15:37:18', 1),
(34, 'WLS00034', 'boost 88!', 'รับเติม Nitro ราคาถูกที่สุด ปลอดภัย รวดเร็ว ♥ \r\nสามารถเติมสะสมหลายเดือนได้!\r\n', 36, 'https://media.discordapp.net/attachments/702436540587966545/1080058018558922772/Neon_Pink_and_Cyan_Futuristic_and_Fun_Twitch_Logo_3.png?width=580&height=580', 'https://discord.gg/ESEdEwMWYv', 'อริศรา', 'อุราชื่น', '', '', 2, 'โอนย้ายข้อมูลเดิม', '2023-08-03 15:47:17', 1, '2023-08-03 15:37:18', 1, '2023-08-03 15:37:18', 1),
(35, 'WLS00035', 'Killua NITRO•₊˚', 'ขาย Nitro เริ่มต้น 59 บาท / ขายยูทูปพรีเมี่ยมเเค่ 65 บาท / และแอะดูหนังอื่นๆ', 37, 'https://cdn.discordapp.com/attachments/1061128130431029258/1079969136744083476/26_20230106172345.png', 'https://discord.gg/ePArPQjX4F', 'อนุชา', 'จำปาทอง', '', '', 2, 'โอนย้ายข้อมูลเดิม', '2023-08-03 15:47:17', 1, '2023-08-03 15:37:18', 1, '2023-08-03 15:37:18', 1),
(36, 'WLS00036', 'Rykershop', 'รับเติมไนโตรดิสคอร์ดราคาน่ารัก ปลอดภัย เติมไวคั้บ', 38, 'https://cdn.discordapp.com/attachments/1084335345711206421/1114777035248775238/1079_20230505085727.png', 'https://discord.gg/KEWGWuxPMK', 'ณพัชร', 'จิรกิตติชญานนท์', '', '', 2, 'โอนย้ายข้อมูลเดิม', '2023-08-03 15:47:17', 1, '2023-08-03 15:37:18', 1, '2023-08-03 15:37:18', 1),
(37, 'WLS00037', 'Pangko Nitro', 'ร้านขายสินค้าและบริการ Nitro ต่างๆ', 39, 'https://cdn.discordapp.com/attachments/955786936474300416/1091710339936161902/533ebd036a2c179b.png', 'https://discord.gg/687AXSthnt', 'สุประดิษฐ์', 'ตาวงค์', '', '', 2, 'โอนย้ายข้อมูลเดิม', '2023-08-03 15:47:17', 1, '2023-08-03 15:37:18', 1, '2023-08-03 15:37:18', 1),
(38, 'WLS00038', 'Rob Shop', '[#] รับเติมไนโตร\r\n[#] บูสต์เซิร์ฟเวอร์\r\n[#] ไนโตรลิ้งค์\r\n[#] SRC ต่างๆ\r\n[#] แบนเนอร์ / โปรไฟล์\r\n[#] ระบบดิสต่างๆ\r\n// พร้อมบริการ 24hr', 40, 'https://cdn.discordapp.com/attachments/1062631159688871936/1092102354058350723/33_20230212171657_1.png', 'https://discord.gg/n2YV89WksM', 'จักรพันธ์', 'บุตรพรม', '', '', 2, 'โอนย้ายข้อมูลเดิม', '2023-08-03 15:47:17', 1, '2023-08-03 15:37:19', 1, '2023-08-03 15:37:19', 1),
(39, 'WLS00039', 'Geevee Shop', '-', 41, 'https://cdn.discordapp.com/embed/avatars/0.png', 'https://facebook.com/profile.php?id=100024170347977', 'เทวฤทธ์', 'บุญแพง', '', '', 2, 'โอนย้ายข้อมูลเดิม', '2023-08-03 15:47:17', 1, '2023-08-03 15:37:19', 1, '2023-08-03 15:37:19', 1),
(40, 'WLS00040', 'PANDORA SHOP', '-', 42, 'https://cdn.discordapp.com/embed/avatars/0.png', 'https://discord.gg/JEQ56W7v', 'กานน', 'ปลื้มจิตต์', '', '', 2, 'โอนย้ายข้อมูลเดิม', '2023-08-03 15:47:17', 1, '2023-08-03 15:37:19', 1, '2023-08-03 15:37:19', 1),
(41, 'WLS00041', 'JAOMIN SHOP', '• รับทำดิส เริ่มต้นที่ 50 บาท\r\n• รับเซ็ตบอท เริ่มต้นที่ 5 บาท\r\n• รับทำโลโก้ เริ่มต้นที่ 10 บาท\r\n• รับดูเเลระบบ อาทิตย์ล่ะ 69บาท\r\n• ขายดิสสำเร็จรูป เริ่มต้นที่ 20 บาท', 43, 'https://cdn.discordapp.com/embed/avatars/0.png', 'https://discord.gg/Pb9yMwhs8N', 'ศรันย์พงษ์', 'มาสังข์', '', '', 2, 'โอนย้ายข้อมูลเดิม', '2023-08-03 15:47:17', 1, '2023-08-03 15:37:19', 1, '2023-08-03 15:37:19', 1),
(42, 'WLS00042', 'LAVA SHOP', '-', 44, 'https://media.discordapp.net/attachments/1016929996301942828/1093810160553693215/26696610_148633269190033_1099178672_n42.png?width=640&height=640', 'https://discord.gg/e4YhJ8mb4n ', 'ไพโรจน์', 'โยวะ', '', '', 2, 'โอนย้ายข้อมูลเดิม', '2023-08-03 15:47:17', 1, '2023-08-03 15:37:19', 1, '2023-08-03 15:37:19', 1),
(43, 'WLS00043', 'CHILL VIBES, ONLY', '-', 45, 'https://cdn.discordapp.com/embed/avatars/0.png', 'https://discord.gg/chillvibesonly', 'กฤตพร', 'ศิริอุดมเดชกุล', '', '', 2, 'โอนย้ายข้อมูลเดิม', '2023-08-03 15:47:17', 1, '2023-08-03 15:37:19', 1, '2023-08-03 15:37:19', 1),
(44, 'WLS00044', 'picha nitro', '-', 46, 'https://cdn.discordapp.com/embed/avatars/0.png', 'https://discord.gg/4TEjaZEf', 'พิชญาภา', 'ดิเรกโชค', '', '', 2, 'โอนย้ายข้อมูลเดิม', '2023-08-03 15:47:17', 1, '2023-08-03 15:37:20', 1, '2023-08-03 15:37:20', 1),
(45, 'WLS00045', 'HAPPYPLUEMSTORE', 'ขาย Discord Nitro ราคาถูก!', 47, 'https://cdn.discordapp.com/embed/avatars/0.png', 'https://discord.gg/ucXSZ8zs8y', 'ณภัค', 'เมฆหมอก', '', '', 2, 'โอนย้ายข้อมูลเดิม', '2023-08-03 15:47:17', 1, '2023-08-03 15:37:20', 1, '2023-08-03 15:37:20', 1),
(46, 'WLS00046', 'StellaLou', '-', 48, 'https://cdn.discordapp.com/embed/avatars/0.png', 'https://discord.gg/stellalou', 'นัทธมน', 'ทองคำอ้น', '', '', 2, 'โอนย้ายข้อมูลเดิม', '2023-08-03 15:47:17', 1, '2023-08-03 15:37:20', 1, '2023-08-03 15:37:20', 1),
(47, 'WLS00047', 'Skyallstore', '-', 49, 'https://cdn.discordapp.com/embed/avatars/0.png', 'https://facebook.com/pskpk.ball', 'ภาสกร', 'พวงแก้ว', '', '', 2, 'โอนย้ายข้อมูลเดิม', '2023-08-03 15:47:17', 1, '2023-08-03 15:37:20', 1, '2023-08-03 15:37:20', 1),
(48, 'WLS00048', 'WhiteFuyu', '-', 50, 'https://cdn.discordapp.com/embed/avatars/0.png', 'https://facebook.com/whitefuyu', 'เงินแสน', 'ไชยศรีสังข์', '', '', 2, 'โอนย้ายข้อมูลเดิม', '2023-08-03 15:47:17', 1, '2023-08-03 15:37:20', 1, '2023-08-03 15:37:20', 1),
(49, 'WLS00049', 'SARXN.X SHOP', '-', 51, 'https://cdn.discordapp.com/embed/avatars/0.png', 'https://discord.gg/sarxnx', 'ชลสิทธิ์', 'รอดภัยลี', '', '', 2, 'โอนย้ายข้อมูลเดิม', '2023-08-03 15:47:17', 1, '2023-08-03 15:37:20', 1, '2023-08-03 15:37:20', 1),
(50, 'WLS00050', 'LUNA STORE', '-', 52, 'https://cdn.discordapp.com/embed/avatars/0.png', 'https://discord.gg/CHYytTZwwC', 'ณัชชา', 'เทพบริรักษ์', '', '', 2, 'โอนย้ายข้อมูลเดิม', '2023-08-03 15:47:17', 1, '2023-08-03 15:37:20', 1, '2023-08-03 15:37:20', 1),
(51, 'WLS00051', 'MuSuBshop', '-', 53, 'https://cdn.discordapp.com/embed/avatars/0.png', 'https://facebook.com/profile.php?id=100083320967562', 'กิตติธาร', 'คำดี', '', '', 2, 'โอนย้ายข้อมูลเดิม', '2023-08-03 15:47:17', 1, '2023-08-03 15:37:20', 1, '2023-08-03 15:37:20', 1),
(52, 'WLS00052', 'B2J SHOP', '– รับเติม Discord Nitro \r\n– ขายแอพพรีเมี่ยมต่างๆ ', 54, 'https://media.discordapp.net/attachments/1099965520167587902/1112276908105801848/452.png?width=683&height=683', 'https://discord.gg/TeMahaBU9H', 'กฤษฎา', 'ดาวศิริโรจน์', '', '', 2, 'โอนย้ายข้อมูลเดิม', '2023-08-03 15:47:17', 1, '2023-08-03 15:37:20', 1, '2023-08-03 15:37:20', 1),
(53, 'WLS00053', 'Dubleake Store', '-', 55, 'https://cdn.discordapp.com/embed/avatars/0.png', 'https://discord.gg/cusFeqkVUq', 'เจริญทรัพย์', 'หนูสงค์', '', '', 2, 'โอนย้ายข้อมูลเดิม', '2023-08-03 15:47:17', 1, '2023-08-03 15:37:20', 1, '2023-08-03 15:37:20', 1),
(54, 'WLS00054', '୧˚2000X SHOP ˚ ✦', 'ร้านเติมไนโตรเเละรับเติมเกม', 56, 'https://media.discordapp.net/attachments/1102208796035653703/1115639162272493598/22.jpg', 'https://discord.gg/3cd45E7wpg', 'ภูมินทร์', 'วงษ์ขุลี', '', '', 2, 'โอนย้ายข้อมูลเดิม', '2023-08-03 15:47:17', 1, '2023-08-03 15:37:21', 1, '2023-08-03 15:37:21', 1),
(55, 'WLS00055', 'JNmumi', '-', 57, 'https://cdn.discordapp.com/embed/avatars/0.png', 'https://discord.gg/mdBk228R65', 'ปภัสสร', 'ตาบุดดา', '', '', 2, 'โอนย้ายข้อมูลเดิม', '2023-08-03 15:47:17', 1, '2023-08-03 15:37:21', 1, '2023-08-03 15:37:21', 1),
(56, 'WLS00056', 'คุกกี้เติมเกม', '-', 58, 'https://cdn.discordapp.com/embed/avatars/0.png', 'https://facebook.com/cktermgame', 'อรวรรณ', 'มารุ่งเรือง', '', '', 2, 'โอนย้ายข้อมูลเดิม', '2023-08-03 15:47:17', 1, '2023-08-03 15:37:21', 1, '2023-08-03 15:37:21', 1);

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
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

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
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `blacklist_category`
--
ALTER TABLE `blacklist_category`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `blacklist_image`
--
ALTER TABLE `blacklist_image`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `email_verify`
--
ALTER TABLE `email_verify`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `whitelist`
--
ALTER TABLE `whitelist`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
