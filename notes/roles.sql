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
(3, 'Förbund', NULL, NULL),
(4, 'Besökare', NULL, NULL),
(5, 'SBF', 1130, NULL),
(6, 'Rally', 2000, NULL),
(7, 'Racing', 2100, NULL),
(8, 'Dragracing', 2200, NULL),
(9, 'Rallycross', 2300, NULL),
(10, 'Rallycross Junior', 2301, NULL),
(11, 'Folkrace', 2400, NULL),
(12, 'Karting', 2500, NULL),
(13, 'Radiostyrdbilsport', 2600, NULL),
(14, 'Crosscart', 2700, NULL),
(15, 'Offroad', 2800, NULL),
(16, 'Bil-O', 2900, NULL),
(17, 'Internationella kommittén', 3000, NULL),
(18, 'Säkerhetskommittén', 3100, NULL),
(19, 'Historiska kommittén', 3200, NULL),
(20, 'Virtuell bilsport', 3300, NULL),
(21, 'Drifting', 3400, NULL),
(22, 'Tekniska kommittén', 5700, NULL),
(23, 'Banbesiktningskommittén', 5800, NULL),
(24, 'Juridiska kommittén', 5900, NULL),
(25, 'Förbundsjurist', 5901, NULL),
(26, 'Miljökommittén', 6000, NULL),
(27, 'Ungdomsgruppen', 6400, NULL),
(28, 'Förbundskapten rally', 6500, NULL),
(29, 'Förbundskapten racing', 6501, NULL),
(30, 'Förbundskapten karting', 6502, NULL),
(31, 'Marknadsavdelningen', 6503, NULL),
(32, 'Rig', 6504, NULL),
(33, 'Utbildning/Förbundsfunktionär', 6505, NULL),
(34, 'Valberedningen', 6506, NULL),
(35, 'Nez', 6507, NULL),
(36, 'Bosön / JES', 6509, NULL),
(37, '1', 6513, NULL),
(38, 'Bilsportarvet', 6518, NULL),
(39, 'Idrottslyftet', 6521, NULL),
(40, 'Enkla tävlingsformer', 6522, NULL);
