-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 06, 2010 at 08:28 AM
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
-- Table structure for table `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(127) NOT NULL,
  `password` varchar(127) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`) VALUES
(3, 'user', '1a1dc91c907325c69271ddf0c944bc72');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE IF NOT EXISTS `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(127) CHARACTER SET utf8 NOT NULL,
  `is_active` int(1) DEFAULT '0',
  `confirmation_message` varchar(1023) CHARACTER SET utf8 DEFAULT NULL,
  `price_per_person` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=11 ;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `name`, `is_active`, `confirmation_message`, `price_per_person`) VALUES
(7, 'Gala', 1, 'Välkommen!', 1100.5),
(8, 'Konferens', 1, 'Du är välkommen att ta med mat till konferensen', 150),
(9, 'Gala 2009', 0, 'hejhopp', 1100.5);

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `events_steps`
--

INSERT INTO `events_steps` (`event_id`, `step_id`, `order`) VALUES
(7, 1, 1),
(7, 2, 2),
(7, 5, 5),
(7, 3, 3),
(7, 4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE IF NOT EXISTS `invoices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `registration_id` int(64) NOT NULL,
  `price` double NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `invoices`
--


-- --------------------------------------------------------

--
-- Table structure for table `people`
--

CREATE TABLE IF NOT EXISTS `people` (
  `registration_id` int(11) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) DEFAULT NULL,
  `reduction_code_code` varchar(128) CHARACTER SET utf8 DEFAULT NULL,
  `first_name` varchar(127) CHARACTER SET utf8 NOT NULL,
  `last_name` varchar(127) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`),
  KEY `registration_id` (`registration_id`,`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- Dumping data for table `people`
--


-- --------------------------------------------------------

--
-- Table structure for table `reduction_codes`
--

CREATE TABLE IF NOT EXISTS `reduction_codes` (
  `event_id` int(11) NOT NULL,
  `code` varchar(128) NOT NULL,
  `number_of_people` varchar(128) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reduction_codes`
--


-- --------------------------------------------------------

--
-- Table structure for table `registrations`
--

CREATE TABLE IF NOT EXISTS `registrations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) NOT NULL,
  `number` varchar(6) CHARACTER SET utf8 NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modified_admin` datetime DEFAULT NULL,
  `modified_admin_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `number` (`number`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- Dumping data for table `registrations`
--


-- --------------------------------------------------------

--
-- Table structure for table `registrators`
--

CREATE TABLE IF NOT EXISTS `registrators` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `registration_id` int(11) DEFAULT NULL,
  `first_name` varchar(127) CHARACTER SET utf8 NOT NULL,
  `last_name` varchar(127) CHARACTER SET utf8 NOT NULL,
  `email` varchar(127) CHARACTER SET utf8 NOT NULL,
  `phone` varchar(127) CHARACTER SET utf8 DEFAULT NULL,
  `c_o` varchar(127) CHARACTER SET utf8 DEFAULT NULL,
  `street_address` varchar(127) CHARACTER SET utf8 DEFAULT NULL,
  `city` varchar(127) CHARACTER SET utf8 DEFAULT NULL,
  `postal_code` varchar(127) CHARACTER SET utf8 DEFAULT NULL,
  `extra_information` text CHARACTER SET utf8,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- Dumping data for table `registrators`
--


-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(127) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=18 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(14, 'Besökare'),
(15, 'VIP'),
(16, 'Ordförande'),
(17, 'Styrelsemedlem');

-- --------------------------------------------------------

--
-- Table structure for table `steps`
--

CREATE TABLE IF NOT EXISTS `steps` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `admin_label` varchar(128) NOT NULL,
  `controller` varchar(128) NOT NULL,
  `action` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `steps`
--

INSERT INTO `steps` (`id`, `name`, `admin_label`, `controller`, `action`) VALUES
(1, 'Sällskap', 'Anmälda', 'People', 'create'),
(2, 'Kontaktuppgifter', 'Bokningar', 'Registrators', 'create'),
(3, 'Granska', '', 'Registrations', 'review'),
(4, 'Kvitto', '', 'Registrations', 'receipt'),
(5, '', 'Rabattkoder', 'ReductionCodes', 'create');
