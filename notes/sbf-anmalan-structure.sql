-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 07, 2010 at 12:00 PM
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
-- Table structure for table `events`
--

CREATE TABLE IF NOT EXISTS `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(127) COLLATE utf8_bin NOT NULL,
  `is_active` int(1) DEFAULT '0',
  `confirmation_message` varchar(1023) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Table structure for table `events_steps`
--

CREATE TABLE IF NOT EXISTS `events_steps` (
  `event_id` int(11) NOT NULL,
  `step_id` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  KEY `event_id` (`event_id`),
  KEY `step_id` (`step_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `people`
--

CREATE TABLE IF NOT EXISTS `people` (
  `registration_id` int(11) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) DEFAULT NULL,
  `first_name` varchar(127) COLLATE utf8_bin NOT NULL,
  `last_name` varchar(127) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  KEY `registration_id` (`registration_id`,`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=25 ;

-- --------------------------------------------------------

--
-- Table structure for table `registrations`
--

CREATE TABLE IF NOT EXISTS `registrations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) NOT NULL,
  `number` varchar(6) COLLATE utf8_bin NOT NULL DEFAULT '',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `number` (`number`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=77 ;

-- --------------------------------------------------------

--
-- Table structure for table `registrators`
--

CREATE TABLE IF NOT EXISTS `registrators` (
  `registration_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(127) COLLATE utf8_bin NOT NULL,
  `last_name` varchar(127) COLLATE utf8_bin NOT NULL,
  `email` varchar(127) COLLATE utf8_bin NOT NULL,
  `phone` varchar(127) COLLATE utf8_bin DEFAULT NULL,
  `c_o` varchar(127) COLLATE utf8_bin DEFAULT NULL,
  `street_address` varchar(127) COLLATE utf8_bin DEFAULT NULL,
  `city` varchar(127) COLLATE utf8_bin DEFAULT NULL,
  `postal_code` varchar(127) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`registration_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=77 ;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(127) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=18 ;

-- --------------------------------------------------------

--
-- Table structure for table `steps`
--

CREATE TABLE IF NOT EXISTS `steps` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `controller` varchar(128) NOT NULL,
  `action` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;
