-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 02, 2023 at 10:51 PM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rewards`
--
CREATE DATABASE IF NOT EXISTS `rewards` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `rewards`;

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

DROP TABLE IF EXISTS `account`;
CREATE TABLE IF NOT EXISTS `account` (
  `accountId` int NOT NULL AUTO_INCREMENT,
  `userId` int NOT NULL,
  `accountType` varchar(100) NOT NULL,
  `points` int NOT NULL,
  PRIMARY KEY (`accountId`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`accountId`, `userId`, `accountType`, `points`) VALUES
(1, 1, 'Regular', 90),
(2, 2, 'Premium', 250),
(3, 3, 'Regular', 50),
(4, 4, 'Premium', 200),
(5, 5, 'Regular', 75);

-- --------------------------------------------------------

--
-- Table structure for table `giftcard`
--

DROP TABLE IF EXISTS `giftcard`;
CREATE TABLE IF NOT EXISTS `giftcard` (
  `cardId` int NOT NULL AUTO_INCREMENT,
  `cardName` varchar(100) NOT NULL,
  `cardType` varchar(100) NOT NULL,
  `cardValue` float NOT NULL,
  `points` int NOT NULL,
  PRIMARY KEY (`cardId`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `giftcard`
--

INSERT INTO `giftcard` (`cardId`, `cardName`, `cardType`, `cardValue`, `points`) VALUES
(1, 'Card 1', 'Electronic', 0, 0),
(2, 'Gift Card 2', 'Physical', 50, 100),
(3, 'Gift Card 3', 'Electronic', 100, 20),
(4, 'Gift Card 4', 'Electronic', 10, 10),
(5, 'Gift Card 5', 'Electronic', 200, 30),
(6, 'Gift Card 6', 'Physical', 150, 25),
(7, 'Gift Card 7', 'Electronic', 50, 10),
(8, 'Gift Card 8', 'Physical', 25, 5),
(9, 'Gift Card 9', 'Electronic', 100, 20),
(10, 'Gift Card 10', 'Physical', 75, 15),
(11, 'Gift Card 11', 'Electronic', 200, 30),
(12, 'Gift Card 12', 'Physical', 150, 25),
(13, 'Gift Card 13', 'Electronic', 50, 10),
(14, 'Gift Card 14', 'Physical', 25, 5),
(15, 'Gift Card 15', 'Physical', 200, 20),
(16, 'Gift Card 16', 'Physical', 75, 15),
(17, 'Gift Card 17', 'Electronic', 200, 30),
(18, 'Gift Card 18', 'Physical', 150, 25),
(19, 'Gift Card 19', 'Electronic', 50, 10),
(20, 'Gift Card 20', 'Physical', 25, 5),
(21, 'New Card', 'Electronic', 200, 100),
(22, 'Card 22', 'Physical', 100, 200),
(23, 'Test Card', 'Electronic', 100, 100),
(24, 'Air Asia Card', 'Physical', 300, 100),
(25, 'Air Asia Gift Card Test', 'Physical', 200, 100),
(26, 'New Card', 'Electronic', 50, 100);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `username`, `role`) VALUES
(1, 'bsmith', 'admin'),
(2, 'pjones', 'customer'),
(3, 'SwethaUppula', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `forename` varchar(128) NOT NULL,
  `surname` varchar(128) NOT NULL,
  `username` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`forename`, `surname`, `username`, `password`) VALUES
('Bill', 'Smith', 'bsmith', '$2y$10$1JZ.JEFMwbQV4IQBRBA4xOEttL8ZNbZX4Ujfp95HcwbnrgCz/KA4S'),
('Pauline', 'Jones', 'pjones', '$2y$10$ZTQddN7PweZRx13/vX/ti.EG2NlgdeQkDODJsBpQuFakTBwF5RLV2'),
('Swetha', 'Uppula', 'SwethaUppula', '$2y$10$QFVl5zX4ODJdl3MPscVND.DFt7omxjsJx1g0O.80Ejxxhq/LQOV3y');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
