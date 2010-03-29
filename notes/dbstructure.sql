-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Värd: localhost
-- Skapad: 29 mars 2010 kl 10:47
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
-- Struktur för tabell `events`
--

CREATE TABLE IF NOT EXISTS `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(127) COLLATE utf8_bin NOT NULL,
  `is_active` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Struktur för tabell `people`
--

CREATE TABLE IF NOT EXISTS `people` (
  `registration_id` int(11) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) DEFAULT NULL,
  `first_name` varchar(127) COLLATE utf8_bin NOT NULL,
  `last_name` varchar(127) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  KEY `registration_id` (`registration_id`,`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=17 ;

-- --------------------------------------------------------

--
-- Struktur för tabell `registrations`
--

CREATE TABLE IF NOT EXISTS `registrations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) NOT NULL,
  `number` varchar(6) COLLATE utf8_bin NOT NULL DEFAULT '',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `number` (`number`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=54 ;

-- --------------------------------------------------------

--
-- Struktur för tabell `registrators`
--

CREATE TABLE IF NOT EXISTS `registrators` (
  `registration_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(127) COLLATE utf8_bin NOT NULL,
  `last_name` varchar(127) COLLATE utf8_bin NOT NULL,
  `email` varchar(127) COLLATE utf8_bin NOT NULL,
  `phone` varchar(127) COLLATE utf8_bin DEFAULT NULL,
  `street_address` varchar(127) COLLATE utf8_bin DEFAULT NULL,
  `city` varchar(127) COLLATE utf8_bin DEFAULT NULL,
  `postal_code` varchar(127) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`registration_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=54 ;

-- --------------------------------------------------------

--
-- Struktur för tabell `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(127) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=14 ;
