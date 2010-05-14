-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Värd: localhost
-- Skapad: 12 maj 2010 kl 11:03
-- Serverversion: 5.1.36
-- PHP-version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databas: `sbf-anmalan`
--

-- --------------------------------------------------------

--
-- Struktur för tabell `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(127) CHARACTER SET utf8 NOT NULL,
  `code` int(11) DEFAULT NULL,
  `is_external` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=58 ;

--
-- Data i tabell `roles`
--

INSERT INTO `roles` (`id`, `name`, `code`, `is_external`) VALUES
(1, 'Kansliet', 1120, NULL),
(2, 'Styrelsen', 1110, NULL),
(3, 'Medföljande', NULL, NULL),
(4, 'Förbund', NULL, NULL),
(5, 'Besökare', NULL, NULL),
(6, 'SBF', 1130, NULL),
(7, 'Rally', 2000, NULL),
(8, 'Racing', 2100, NULL),
(9, 'Dragracing', 2200, NULL),
(10, 'Rallycross', 2300, NULL),
(11, 'Rallycross Junior', 2301, NULL),
(12, 'Folkrace', 2400, NULL),
(13, 'Karting', 2500, NULL),
(14, 'Radiostyrdbilsport', 2600, NULL),
(15, 'Crosscart', 2700, NULL),
(16, 'Offroad', 2800, NULL),
(17, 'Bil-O', 2900, NULL),
(18, 'Internationella kommittén', 3000, NULL),
(19, 'Säkerhetskommittén', 3100, NULL),
(20, 'Historiska kommittén', 3200, NULL),
(21, 'Virtuell bilsport', 3300, NULL),
(22, 'Drifting', 3400, NULL),
(23, 'Tekniska kommittén', 5700, NULL),
(24, 'Banbesiktningskommittén', 5800, NULL),
(25, 'Juridiska kommittén', 5900, NULL),
(26, 'Förbundsjurist', 5901, NULL),
(27, 'Miljökommittén', 6000, NULL),
(28, 'Ungdomsgruppen', 6400, NULL),
(29, 'Förbundskapten rally', 6500, NULL),
(30, 'Förbundskapten racing', 6501, NULL),
(31, 'Förbundskapten karting', 6502, NULL),
(32, 'Marknadsavdelningen', 6503, NULL),
(33, 'Rig', 6504, NULL),
(34, 'Utbildning/Förbundsfunktionär', 6505, NULL),
(35, 'Valberedningen', 6506, NULL),
(36, 'Nez', 6507, NULL),
(37, 'Bosön / JES', 6509, NULL),
(38, '1', 6513, NULL),
(39, 'Bilsportarvet', 6518, NULL),
(40, 'Idrottslyftet', 6521, NULL),
(41, 'Enkla tävlingsformer', 6522, NULL);
