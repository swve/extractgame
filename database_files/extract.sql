-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 29, 2018 at 03:22 PM
-- Server version: 5.7.23
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `extract`
--

-- --------------------------------------------------------

--
-- Table structure for table `carte`
--

DROP TABLE IF EXISTS `carte`;
CREATE TABLE IF NOT EXISTS `carte` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fichier` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `valeur` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carte`
--

INSERT INTO `carte` (`id`, `nom`, `fichier`, `valeur`) VALUES
(1, 'Disque', 'carte_disque.png', 6),
(2, 'Disque', 'carte_disque.png', 6),
(3, 'Disque', 'carte_disque.png', 6),
(4, 'Disque', 'carte_disque.png', 6),
(5, 'Disque', 'carte_disque.png', 6),
(6, 'Disque', 'carte_disque.png', 6),
(7, 'Audio', 'carte_audio.png', 5),
(8, 'Audio', 'carte_audio.png', 5),
(9, 'Audio', 'carte_audio.png', 5),
(10, 'Audio', 'carte_audio.png', 5),
(11, 'Audio', 'carte_audio.png', 5),
(12, 'Audio', 'carte_audio.png', 5),
(13, 'Appareil Photo', 'carte_app.png', 4),
(14, 'Appareil Photo', 'carte_app.png', 4),
(15, 'Appareil Photo', 'carte_app.png', 4),
(16, 'Appareil Photo', 'carte_app.png', 4),
(17, 'Appareil Photo', 'carte_app.png', 4),
(18, 'Appareil Photo', 'carte_app.png', 4),
(19, 'Videos', 'carte_videos.png', 3),
(20, 'Videos', 'carte_videos.png', 3),
(21, 'Videos', 'carte_videos.png', 3),
(22, 'Videos', 'carte_videos.png', 3),
(23, 'Videos', 'carte_videos.png', 3),
(24, 'Videos', 'carte_videos.png', 3),
(25, 'Videos', 'carte_videos.png', 3),
(26, 'Videos', 'carte_videos.png', 3),
(27, 'Plan', 'carte_plans.png', 2),
(28, 'Plan', 'carte_plans.png', 2),
(29, 'Plan', 'carte_plans.png', 2),
(30, 'Plan', 'carte_plans.png', 2),
(31, 'Plan', 'carte_plans.png', 2),
(32, 'Plan', 'carte_plans.png', 2),
(33, 'Plan', 'carte_plans.png', 2),
(34, 'Plan', 'carte_plans.png', 2),
(35, 'Data', 'carte_datas.png', 1),
(36, 'Data', 'carte_datas.png', 1),
(37, 'Data', 'carte_datas.png', 1),
(38, 'Data', 'carte_datas.png', 1),
(39, 'Data', 'carte_datas.png', 1),
(40, 'Data', 'carte_datas.png', 1),
(41, 'Data', 'carte_datas.png', 1),
(42, 'Data', 'carte_datas.png', 1),
(43, 'Data', 'carte_datas.png', 1),
(44, 'Data', 'carte_datas.png', 1),
(45, 'Valise', 'valise.png', 0),
(46, 'Valise', 'valise.png', 0),
(47, 'Valise', 'valise.png', 0),
(48, 'Valise', 'valise.png', 0),
(49, 'Valise', 'valise.png', 0),
(50, 'Valise', 'valise.png', 0),
(51, 'Valise', 'valise.png', 0),
(52, 'Valise', 'valise.png', 0),
(53, 'Valise', 'valise.png', 0),
(54, 'Valise', 'valise.png', 0),
(55, 'Valise', 'valise.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `jeton`
--

DROP TABLE IF EXISTS `jeton`;
CREATE TABLE IF NOT EXISTS `jeton` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `valeur` int(11) NOT NULL,
  `fichier` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jeton`
--

INSERT INTO `jeton` (`id`, `nom`, `valeur`, `fichier`, `type`) VALUES
(1, 'Data 5', 5, 'data_5.png', 'data'),
(2, 'Data 5', 5, 'data_5.png', 'data'),
(3, 'Data 5', 5, 'data_5.png', 'data'),
(4, 'Data 7', 7, 'data_7.png', 'data'),
(5, 'Data 7', 7, 'data_7.png', 'data'),
(6, 'Plan 5 ', 5, 'plan_5.png', 'plan'),
(7, 'Plan 5 ', 5, 'plan_5.png', 'plan'),
(8, 'Plan 5 ', 5, 'plan_5.png', 'plan'),
(9, 'Plan 6', 6, 'plan_6.png', 'plan'),
(10, 'Plan 6', 6, 'plan_6.png', 'plan'),
(11, 'Video 5', 5, 'video_5.png', 'video'),
(12, 'Video 5', 5, 'video_5.png', 'video'),
(13, 'Video 5', 5, 'video_5.png', 'video'),
(14, 'Video 5', 5, 'video_5.png', 'video'),
(15, 'Video 5', 5, 'video_5.png', 'video'),
(16, 'Video 5', 5, 'video_5.png', 'video'),
(17, 'App 1', 1, 'app_1.png', 'app'),
(18, 'App 1', 1, 'app_1.png', 'app'),
(19, 'App 2', 2, 'app_2.png', 'app'),
(20, 'App 2', 2, 'app_2.png', 'app'),
(21, 'App 3', 3, 'app_3.png', 'app'),
(22, 'App 3', 3, 'app_3.png', 'app'),
(23, 'App 5', 5, 'app_5.png', 'app'),
(24, 'Audio 1', 1, 'audio_1.png', 'audio'),
(25, 'Audio 1', 1, 'audio_1.png', 'audio'),
(26, 'Audio 2', 2, 'audio_2.png', 'audio'),
(28, 'Audio 2', 2, 'audio_2.png', 'audio'),
(29, 'Audio 3', 3, 'audio_3.png', 'audio'),
(30, 'Audio 3', 3, 'audio_3.png', 'audio'),
(31, 'Audio 5', 5, 'audio_5.png', 'audio'),
(32, 'Disque 1', 1, 'disque_1.png', 'disque'),
(33, 'Disque 1', 1, 'disque_1.png', 'disque'),
(34, 'Disque 1', 1, 'disque_1.png', 'disque'),
(35, 'Disque 1', 1, 'disque_1.png', 'disque'),
(36, 'Disque 1', 1, 'disque_1.png', 'disque'),
(37, 'Disque 1', 1, 'disque_1.png', 'disque'),
(38, 'Disque 2', 2, 'disque_2.png', 'disque'),
(39, 'Disque 3', 3, 'disque_3.png', 'disque'),
(40, 'Disque 4', 4, 'disque_4.png', 'disque'),
(41, 'Bonus 3', 3, 'bonus_3.png', 'Bonus_3'),
(42, 'Bonus 3', 3, 'bonus_3.png', 'Bonus_3'),
(43, 'Bonus 3', 3, 'bonus_3.png', 'Bonus_3'),
(44, 'Bonus 3', 3, 'bonus_3.png', 'Bonus_3'),
(45, 'Bonus 3', 3, 'bonus_3.png', 'Bonus_3'),
(46, 'Bonus 3', 3, 'bonus_3.png', 'Bonus_3'),
(47, 'Bonus 3', 3, 'bonus_3.png', 'Bonus_3'),
(48, 'Bonus 4', 4, 'bonus_4.png', 'Bonus_4'),
(49, 'Bonus 4', 4, 'bonus_4.png', 'Bonus_4'),
(50, 'Bonus 4', 4, 'bonus_4.png', 'Bonus_4'),
(51, 'Bonus 4', 4, 'bonus_4.png', 'Bonus_4'),
(52, 'Bonus 4', 4, 'bonus_4.png', 'Bonus_4'),
(53, 'Bonus 4', 4, 'bonus_4.png', 'Bonus_4'),
(54, 'Bonus 5', 5, 'bonus_5.png', 'Bonus_5'),
(55, 'Bonus 5', 5, 'bonus_5.png', 'Bonus_5'),
(56, 'Bonus 5', 5, 'bonus_5.png', 'Bonus_5'),
(57, 'Bonus 5', 5, 'bonus_5.png', 'Bonus_5'),
(58, 'Bonus 5', 5, 'bonus_5.png', 'Bonus_5');

