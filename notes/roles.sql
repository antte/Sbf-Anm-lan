-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 11, 2010 at 09:02 AM
-- Server version: 5.1.36
-- PHP Version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sbf-anmalan`
--

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(127) CHARACTER SET utf8 NOT NULL,
  `code` int(11) DEFAULT NULL,
  `is_external` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=58 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `code`, `is_external`) VALUES
(21, 'Kansliet', 1120, 0),
(20, 'Styrelsen', 1110, 0),
(19, 'Förbund', NULL, 0),
(18, 'Besökare', NULL, 1),
(22, 'SBF', 1130, 0),
(23, 'Rally', 2000, 0),
(24, 'Racing', 2100, 0),
(25, 'Dragracing', 2200, 0),
(26, 'Rallycross', 2300, 0),
(27, 'Rallycross Junior', 2301, 0),
(28, 'Folkrace', 2400, 0),
(29, 'Karting', 2500, 0),
(30, 'Radiostyrdbilsport', 2600, 0),
(31, 'Crosscart', 2700, 0),
(32, 'Offroad', 2800, 0),
(33, 'Bil-O', 2900, 0),
(34, 'Internationella kommittén', 3000, 0),
(35, 'Säkerhetskommittén', 3100, 0),
(36, 'Historiska kommittén', 3200, 0),
(37, 'Virtuell bilsport', 3300, 0),
(38, 'Drifting', 3400, 0),
(39, 'Tekniska kommittén', 5700, 0),
(40, 'Banbesiktningskommittén', 5800, 0),
(41, 'Juridiska kommittén', 5900, 0),
(42, 'Förbundsjurist', 5901, 0),
(43, 'Miljökommittén', 6000, 0),
(44, 'Ungdomsgruppen', 6400, 0),
(45, 'Förbundskapten rally', 6500, 0),
(46, 'Förbundskapten racing', 6501, 0),
(47, 'Förbundskapten karting', 6502, 0),
(48, 'Marknadsavdelningen', 6503, 0),
(49, 'Rig', 6504, 0),
(50, 'Utbildning/Förbundsfunktionär', 6505, 0),
(51, 'Valberedningen', 6506, 0),
(52, 'Nez', 6507, 0),
(53, 'Bosön / JES', 6509, 0),
(54, 'Gästmekaniker', 6513, 0),
(55, 'Bilsportarvet', 6518, 0),
(56, 'Idrottslyftet', 6521, 0),
(57, 'Enkla tävlingsformer', 6522, 0);
