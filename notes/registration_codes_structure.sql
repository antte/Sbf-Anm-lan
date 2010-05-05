-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Värd: localhost
-- Skapad: 05 maj 2010 kl 10:16
-- Serverversion: 5.1.37
-- PHP-version: 5.2.11

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
-- Struktur för tabell `reduction_codes`
--

CREATE TABLE `reduction_codes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(128) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `number_of_people` int(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Data i tabell `reduction_codes`
--

INSERT INTO `reduction_codes` VALUES(1, 'Firstblood', 4);
INSERT INTO `reduction_codes` VALUES(2, 'Loosers', 10);
INSERT INTO `reduction_codes` VALUES(3, 'jakan', 0);
INSERT INTO `reduction_codes` VALUES(4, 'jakan', 0);
