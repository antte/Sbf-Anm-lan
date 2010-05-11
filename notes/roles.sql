-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Värd: localhost
-- Skapad: 10 maj 2010 kl 14:30
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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=58 ;

--
-- Data i tabell `roles`
--

INSERT INTO `roles` (`id`, `name`, `code`) VALUES
(21, 'Kansliet', 1120),
(20, 'Styrelsen', 1110),
(19, 'Förbund', NULL),
(18, 'Besökare', NULL),
(22, 'SBF', 1130),
(23, 'Rally', 2000),
(24, 'Racing', 2100),
(25, 'Dragracing', 2200),
(26, 'Rallycross', 2300),
(27, 'Rallycross Junior', 2301),
(28, 'Folkrace', 2400),
(29, 'Karting', 2500),
(30, 'Radiostyrdbilsport', 2600),
(31, 'Crosscart', 2700),
(32, 'Offroad', 2800),
(33, 'Bil-O', 2900),
(34, 'Internationella kommittén', 3000),
(35, 'Säkerhetskommittén', 3100),
(36, 'Historiska kommittén', 3200),
(37, 'Virtuell bilsport', 3300),
(38, 'Drifting', 3400),
(39, 'Tekniska kommittén', 5700),
(40, 'Banbesiktningskommittén', 5800),
(41, 'Juridiska kommittén', 5900),
(42, 'Förbundsjurist', 5901),
(43, 'Miljökommittén', 6000),
(44, 'Ungdomsgruppen', 6400),
(45, 'Förbundskapten rally', 6500),
(46, 'Förbundskapten racing', 6501),
(47, 'Förbundskapten karting', 6502),
(48, 'Marknadsavdelningen', 6503),
(49, 'Rig', 6504),
(50, 'Utbildning/Förbundsfunktionär', 6505),
(51, 'Valberedningen', 6506),
(52, 'Nez', 6507),
(53, 'Bosön / JES', 6509),
(54, 'Gästmekaniker', 6513),
(55, 'Bilsportarvet', 6518),
(56, 'Idrottslyftet', 6521),
(57, 'Enkla tävlingsformer', 6522);
