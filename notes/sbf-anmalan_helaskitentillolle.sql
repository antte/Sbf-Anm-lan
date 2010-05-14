-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 14, 2010 at 12:14 PM
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
(7, 5, 3),
(7, 3, 4),
(7, 4, 5);

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE IF NOT EXISTS `invoices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `registration_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `expiry_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=47 ;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `registration_id`, `created`, `expiry_date`) VALUES
(5, 0, '2010-05-14 09:26:10', '2010-06-13 09:26:10'),
(6, 0, '2010-05-14 09:36:14', '2010-06-13 09:36:14'),
(7, 21, '2010-05-14 10:09:25', '2010-06-13 10:09:25'),
(8, 22, '2010-05-14 10:10:47', '2010-06-13 10:10:47'),
(9, 23, '2010-05-14 10:11:42', '2010-06-13 10:11:42'),
(10, 24, '2010-05-14 10:13:25', '2010-06-13 10:13:25'),
(11, 25, '2010-05-14 10:16:00', '2010-06-13 10:16:00'),
(12, 26, '2010-05-14 10:16:35', '2010-06-13 10:16:35'),
(13, 27, '2010-05-14 10:19:22', '2010-06-13 10:19:22'),
(14, 28, '0000-00-00 00:00:00', '2010-06-13 10:20:34'),
(15, 29, '2010-05-14 10:21:32', '2010-06-13 10:21:32'),
(16, 30, '2010-05-14 10:22:13', '2010-06-13 10:22:13'),
(17, 31, '2010-05-14 10:23:37', '2010-06-13 10:23:37'),
(18, 32, '2010-05-14 10:35:24', '2010-06-13 10:35:24'),
(19, 33, '2010-05-14 10:38:41', '2010-06-13 10:38:41'),
(20, 34, '2010-05-14 10:39:45', '2010-06-13 10:39:44'),
(21, 35, '2010-05-14 10:41:59', '2010-06-13 10:41:59'),
(22, 36, '2010-05-14 10:48:13', '2010-06-13 10:48:13'),
(23, 37, '2010-05-14 11:26:01', '2010-06-13 11:26:01'),
(24, 38, '2010-05-14 11:27:02', '2010-06-13 11:27:02'),
(25, 39, '2010-05-14 11:28:19', '2010-06-13 11:28:19'),
(26, 40, '2010-05-14 11:29:28', '2010-06-13 11:29:28'),
(27, 41, '2010-05-14 11:32:42', '2010-06-13 11:32:42'),
(28, 42, '2010-05-14 11:37:22', '2010-06-13 11:37:22'),
(29, 43, '2010-05-14 11:42:25', '2010-06-13 11:42:25'),
(30, 44, '2010-05-14 11:43:34', '2010-06-13 11:43:34'),
(31, 45, '2010-05-14 11:44:23', '2010-06-13 11:44:23'),
(32, 46, '2010-05-14 11:45:30', '2010-06-13 11:45:30'),
(33, 47, '2010-05-14 11:46:23', '2010-06-13 11:46:23'),
(34, 48, '2010-05-14 11:48:27', '2010-06-13 11:48:27'),
(35, 49, '2010-05-14 11:49:22', '2010-06-13 11:49:21'),
(36, 50, '2010-05-14 11:52:48', '2010-06-13 11:52:48'),
(37, 51, '2010-05-14 11:54:08', '2010-06-13 11:54:08'),
(38, 52, '2010-05-14 11:54:42', '2010-06-13 11:54:42'),
(39, 53, '2010-05-14 11:58:15', '2010-06-13 11:58:15'),
(40, 54, '2010-05-14 11:59:14', '2010-06-13 11:59:14'),
(41, 55, '2010-05-14 12:00:13', '2010-06-13 12:00:12'),
(42, 56, '2010-05-14 12:05:46', '2010-06-13 12:05:46'),
(43, 57, '2010-05-14 12:06:35', '2010-06-13 12:06:35'),
(44, 58, '2010-05-14 12:08:47', '2010-06-13 12:08:47'),
(45, 59, '2010-05-14 12:11:07', '2010-06-13 12:11:07'),
(46, 60, '2010-05-14 12:13:20', '2010-06-13 12:13:20');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_id` int(11) NOT NULL,
  `price` double DEFAULT NULL,
  `description` varchar(127) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `invoice_id`, `price`, `description`) VALUES
(1, 35, 1100.5, 'Andreas Fliesberg'),
(2, 35, 1100.5, 'Tim Olsson'),
(3, 35, 1100.5, 'Pelle Skarsgård'),
(4, 36, 1100.5, 'Andreas Fliesberg'),
(5, 36, 1100.5, 'Tim Olsson'),
(6, 36, 1100.5, 'Pelle Skarsgård'),
(7, 37, 1100.5, 'Andreas Fliesberg'),
(8, 37, 1100.5, 'Tim Olsson'),
(9, 37, 1100.5, 'Pelle Skarsgård'),
(10, 0, 1100.5, 'Andreas Fliesberg'),
(11, 0, 1100.5, 'Tim Olsson'),
(12, 0, 1100.5, 'Pelle Skarsgård'),
(13, 0, 1100.5, 'Andreas Fliesberg'),
(14, 0, 1100.5, 'Tim Olsson'),
(15, 0, 1100.5, 'Pelle Skarsgård'),
(16, 0, 1100.5, 'Andreas Fliesberg'),
(17, 0, 1100.5, 'Tim Olsson'),
(18, 0, 1100.5, 'Pelle Skarsgård'),
(19, 0, 1100.5, 'Pelle Skarsgård'),
(20, 0, 1100.5, 'Pelle Skarsgård');

-- --------------------------------------------------------

--
-- Table structure for table `people`
--

CREATE TABLE IF NOT EXISTS `people` (
  `registration_id` int(11) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) DEFAULT NULL,
  `reduction_code_id` int(11) DEFAULT NULL,
  `first_name` varchar(127) CHARACTER SET utf8 NOT NULL,
  `last_name` varchar(127) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`),
  KEY `registration_id` (`registration_id`,`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=161 ;

--
-- Dumping data for table `people`
--

INSERT INTO `people` (`registration_id`, `id`, `role_id`, `reduction_code_id`, `first_name`, `last_name`) VALUES
(1, 1, 14, 0, 'aa', 'ab'),
(2, 4, 17, 0, 'Pelle', 'Skarsgård'),
(2, 3, 17, 0, 'Tim', 'Olsson'),
(2, 2, 14, 0, 'Andreas', 'Fliesberg'),
(9, 5, 18, NULL, 'Andreas', 'Fliesberg'),
(9, 6, 18, NULL, 'Tim', 'Olsson'),
(9, 7, 18, NULL, 'Pelle', 'Skarsgård'),
(10, 8, 18, NULL, 'Andreas', 'Fliesberg'),
(10, 9, 18, NULL, 'Tim', 'Olsson'),
(10, 10, 18, NULL, 'Pelle', 'Skarsgård'),
(11, 11, 18, NULL, 'Andreas', 'Fliesberg'),
(11, 12, 18, NULL, 'Tim', 'Olsson'),
(11, 13, 18, NULL, 'Pelle', 'Skarsgård'),
(12, 14, 18, NULL, 'Andreas', 'Fliesberg'),
(12, 15, 18, NULL, 'Tim', 'Olsson'),
(12, 16, 18, NULL, 'Pelle', 'Skarsgård'),
(13, 17, 18, NULL, 'Andreas', 'Fliesberg'),
(13, 18, 18, NULL, 'Tim', 'Olsson'),
(13, 19, 18, NULL, 'Pelle', 'Skarsgård'),
(14, 20, 18, NULL, 'Andreas', 'Fliesberg'),
(14, 21, 18, NULL, 'Tim', 'Olsson'),
(14, 22, 18, NULL, 'Pelle', 'Skarsgård'),
(15, 23, 18, NULL, 'Andreas', 'Fliesberg'),
(15, 24, 18, NULL, 'Tim', 'Olsson'),
(15, 25, 18, NULL, 'Pelle', 'Skarsgård'),
(16, 26, 18, NULL, 'Andreas', 'Fliesberg'),
(16, 27, 18, NULL, 'Tim', 'Olsson'),
(16, 28, 18, NULL, 'Pelle', 'Skarsgård'),
(17, 29, 18, NULL, 'Andreas', 'Fliesberg'),
(17, 30, 18, NULL, 'Tim', 'Olsson'),
(17, 31, 18, NULL, 'Pelle', 'Skarsgård'),
(18, 32, 18, NULL, 'Andreas', 'Fliesberg'),
(18, 33, 18, NULL, 'Tim', 'Olsson'),
(18, 34, 18, NULL, 'Pelle', 'Skarsgård'),
(19, 35, 18, NULL, 'Andreas', 'Fliesberg'),
(19, 36, 18, NULL, 'Tim', 'Olsson'),
(19, 37, 18, NULL, 'Pelle', 'Skarsgård'),
(20, 38, 18, NULL, 'Andreas', 'Fliesberg'),
(20, 39, 18, NULL, 'Tim', 'Olsson'),
(20, 40, 18, NULL, 'Pelle', 'Skarsgård'),
(21, 41, 18, NULL, 'Andreas', 'Fliesberg'),
(21, 42, 18, NULL, 'Tim', 'Olsson'),
(21, 43, 18, NULL, 'Pelle', 'Skarsgård'),
(22, 44, 18, NULL, 'Andreas', 'Fliesberg'),
(22, 45, 18, NULL, 'Tim', 'Olsson'),
(22, 46, 18, NULL, 'Pelle', 'Skarsgård'),
(23, 47, 18, NULL, 'Andreas', 'Fliesberg'),
(23, 48, 18, NULL, 'Tim', 'Olsson'),
(23, 49, 18, NULL, 'Pelle', 'Skarsgård'),
(24, 50, 18, NULL, 'Andreas', 'Fliesberg'),
(24, 51, 18, NULL, 'Tim', 'Olsson'),
(24, 52, 18, NULL, 'Pelle', 'Skarsgård'),
(25, 53, 18, NULL, 'Andreas', 'Fliesberg'),
(25, 54, 18, NULL, 'Tim', 'Olsson'),
(25, 55, 18, NULL, 'Pelle', 'Skarsgård'),
(26, 56, 18, NULL, 'Andreas', 'Fliesberg'),
(26, 57, 18, NULL, 'Tim', 'Olsson'),
(26, 58, 18, NULL, 'Pelle', 'Skarsgård'),
(27, 59, 18, NULL, 'Andreas', 'Fliesberg'),
(27, 60, 18, NULL, 'Tim', 'Olsson'),
(27, 61, 18, NULL, 'Pelle', 'Skarsgård'),
(28, 62, 18, NULL, 'Andreas', 'Fliesberg'),
(28, 63, 18, NULL, 'Tim', 'Olsson'),
(28, 64, 18, NULL, 'Pelle', 'Skarsgård'),
(29, 65, 18, NULL, 'Andreas', 'Fliesberg'),
(29, 66, 18, NULL, 'Tim', 'Olsson'),
(29, 67, 18, NULL, 'Pelle', 'Skarsgård'),
(30, 68, 18, NULL, 'Andreas', 'Fliesberg'),
(30, 69, 18, NULL, 'Tim', 'Olsson'),
(30, 70, 18, NULL, 'Pelle', 'Skarsgård'),
(31, 71, 18, NULL, 'Andreas', 'Fliesberg'),
(31, 72, 18, NULL, 'Tim', 'Olsson'),
(31, 73, 18, NULL, 'Pelle', 'Skarsgård'),
(32, 74, 18, NULL, 'Andreas', 'Fliesberg'),
(32, 75, 18, NULL, 'Tim', 'Olsson'),
(32, 76, 18, NULL, 'Pelle', 'Skarsgård'),
(33, 77, 18, NULL, 'Andreas', 'Fliesberg'),
(33, 78, 18, NULL, 'Tim', 'Olsson'),
(33, 79, 18, NULL, 'Pelle', 'Skarsgård'),
(34, 80, 18, NULL, 'Andreas', 'Fliesberg'),
(34, 81, 18, NULL, 'Tim', 'Olsson'),
(34, 82, 18, NULL, 'Pelle', 'Skarsgård'),
(35, 83, 18, NULL, 'Andreas', 'Fliesberg'),
(35, 84, 18, NULL, 'Tim', 'Olsson'),
(35, 85, 18, NULL, 'Pelle', 'Skarsgård'),
(36, 86, 18, NULL, 'Andreas', 'Fliesberg'),
(36, 87, 18, NULL, 'Tim', 'Olsson'),
(36, 88, 18, NULL, 'Pelle', 'Skarsgård'),
(37, 89, 18, NULL, 'Andreas', 'Fliesberg'),
(37, 90, 18, NULL, 'Tim', 'Olsson'),
(37, 91, 18, NULL, 'Pelle', 'Skarsgård'),
(38, 92, 18, NULL, 'Andreas', 'Fliesberg'),
(38, 93, 18, NULL, 'Tim', 'Olsson'),
(38, 94, 18, NULL, 'Pelle', 'Skarsgård'),
(39, 95, 18, NULL, 'Andreas', 'Fliesberg'),
(39, 96, 18, NULL, 'Tim', 'Olsson'),
(39, 97, 18, NULL, 'Pelle', 'Skarsgård'),
(40, 98, 18, NULL, 'Andreas', 'Fliesberg'),
(40, 99, 18, NULL, 'Tim', 'Olsson'),
(40, 100, 18, NULL, 'Pelle', 'Skarsgård'),
(41, 101, 18, NULL, 'Andreas', 'Fliesberg'),
(41, 102, 18, NULL, 'Tim', 'Olsson'),
(41, 103, 18, NULL, 'Pelle', 'Skarsgård'),
(42, 104, 18, NULL, 'Andreas', 'Fliesberg'),
(42, 105, 18, NULL, 'Tim', 'Olsson'),
(42, 106, 18, NULL, 'Pelle', 'Skarsgård'),
(43, 107, 18, NULL, 'Andreas', 'Fliesberg'),
(43, 108, 18, NULL, 'Tim', 'Olsson'),
(43, 109, 18, NULL, 'Pelle', 'Skarsgård'),
(44, 110, 18, NULL, 'Andreas', 'Fliesberg'),
(44, 111, 18, NULL, 'Tim', 'Olsson'),
(44, 112, 18, NULL, 'Pelle', 'Skarsgård'),
(45, 113, 18, NULL, 'Andreas', 'Fliesberg'),
(45, 114, 18, NULL, 'Tim', 'Olsson'),
(45, 115, 18, NULL, 'Pelle', 'Skarsgård'),
(46, 116, 18, NULL, 'Andreas', 'Fliesberg'),
(46, 117, 18, NULL, 'Tim', 'Olsson'),
(46, 118, 18, NULL, 'Pelle', 'Skarsgård'),
(47, 119, 18, NULL, 'Andreas', 'Fliesberg'),
(47, 120, 18, NULL, 'Tim', 'Olsson'),
(47, 121, 18, NULL, 'Pelle', 'Skarsgård'),
(48, 122, 18, NULL, 'Andreas', 'Fliesberg'),
(48, 123, 18, NULL, 'Tim', 'Olsson'),
(48, 124, 18, NULL, 'Pelle', 'Skarsgård'),
(49, 125, 18, NULL, 'Andreas', 'Fliesberg'),
(49, 126, 18, NULL, 'Tim', 'Olsson'),
(49, 127, 18, NULL, 'Pelle', 'Skarsgård'),
(50, 128, 18, NULL, 'Andreas', 'Fliesberg'),
(50, 129, 18, NULL, 'Tim', 'Olsson'),
(50, 130, 18, NULL, 'Pelle', 'Skarsgård'),
(51, 131, 18, NULL, 'Andreas', 'Fliesberg'),
(51, 132, 18, NULL, 'Tim', 'Olsson'),
(51, 133, 18, NULL, 'Pelle', 'Skarsgård'),
(52, 134, 18, NULL, 'Andreas', 'Fliesberg'),
(52, 135, 18, NULL, 'Tim', 'Olsson'),
(52, 136, 18, NULL, 'Pelle', 'Skarsgård'),
(53, 137, 18, NULL, 'Andreas', 'Fliesberg'),
(53, 138, 18, NULL, 'Tim', 'Olsson'),
(53, 139, 18, NULL, 'Pelle', 'Skarsgård'),
(54, 140, 18, NULL, 'Andreas', 'Fliesberg'),
(54, 141, 18, NULL, 'Tim', 'Olsson'),
(54, 142, 18, NULL, 'Pelle', 'Skarsgård'),
(55, 143, 18, NULL, 'Andreas', 'Fliesberg'),
(55, 144, 18, NULL, 'Tim', 'Olsson'),
(55, 145, 18, NULL, 'Pelle', 'Skarsgård'),
(56, 146, 18, NULL, 'Andreas', 'Fliesberg'),
(56, 147, 18, NULL, 'Tim', 'Olsson'),
(56, 148, 18, NULL, 'Pelle', 'Skarsgård'),
(57, 149, 18, NULL, 'Andreas', 'Fliesberg'),
(57, 150, 18, NULL, 'Tim', 'Olsson'),
(57, 151, 18, NULL, 'Pelle', 'Skarsgård'),
(58, 152, 18, NULL, 'Andreas', 'Fliesberg'),
(58, 153, 18, NULL, 'Tim', 'Olsson'),
(58, 154, 18, NULL, 'Pelle', 'Skarsgård'),
(59, 155, 18, NULL, 'Andreas', 'Fliesberg'),
(59, 156, 18, NULL, 'Tim', 'Olsson'),
(59, 157, 18, NULL, 'Pelle', 'Skarsgård'),
(60, 158, 18, NULL, 'Andreas', 'Fliesberg'),
(60, 159, 18, NULL, 'Tim', 'Olsson'),
(60, 160, 18, NULL, 'Pelle', 'Skarsgård');

-- --------------------------------------------------------

--
-- Table structure for table `reduction_codes`
--

CREATE TABLE IF NOT EXISTS `reduction_codes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) NOT NULL,
  `code` varchar(128) NOT NULL,
  `number_of_people` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `reduction_codes`
--

INSERT INTO `reduction_codes` (`id`, `event_id`, `code`, `number_of_people`) VALUES
(1, 7, 'HA', '6');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=61 ;

--
-- Dumping data for table `registrations`
--

INSERT INTO `registrations` (`id`, `event_id`, `number`, `created`, `modified`, `modified_admin`, `modified_admin_id`) VALUES
(1, 7, 'WOYLT1', '2010-05-07 07:15:29', '2010-05-07 07:15:29', NULL, NULL),
(2, 7, '6KOQDJ', '2010-05-07 10:05:48', '2010-05-07 10:09:36', NULL, NULL),
(3, 7, 'HJTXKG', '2010-05-07 11:59:19', '2010-05-07 11:59:19', NULL, NULL),
(4, 7, 'EAKDYT', '2010-05-07 12:00:03', '2010-05-07 12:00:03', NULL, NULL),
(5, 7, 'OTFI74', '2010-05-07 12:08:06', '2010-05-07 12:08:06', NULL, NULL),
(6, 7, 'GH5Z8X', '2010-05-14 08:54:55', '2010-05-14 08:54:55', NULL, NULL),
(7, 7, 'CE7KJY', '2010-05-14 09:16:34', '2010-05-14 09:16:34', NULL, NULL),
(8, 7, 'AOW4Y0', '2010-05-14 09:22:42', '2010-05-14 09:22:42', NULL, NULL),
(9, 7, 'YF1KMX', '2010-05-14 09:26:10', '2010-05-14 09:26:10', NULL, NULL),
(10, 7, 'EC90PJ', '2010-05-14 09:36:14', '2010-05-14 09:36:14', NULL, NULL),
(11, 7, '6B7IUC', '2010-05-14 09:37:50', '2010-05-14 09:37:50', NULL, NULL),
(12, 7, '4UTGH7', '2010-05-14 09:43:38', '2010-05-14 09:43:38', NULL, NULL),
(13, 7, 'CBQYJ3', '2010-05-14 09:46:51', '2010-05-14 09:46:51', NULL, NULL),
(14, 7, '0CEAOF', '2010-05-14 09:49:08', '2010-05-14 09:49:08', NULL, NULL),
(15, 7, 'RDJ7NF', '2010-05-14 09:49:39', '2010-05-14 09:49:39', NULL, NULL),
(16, 7, '61Z59J', '2010-05-14 09:58:16', '2010-05-14 09:58:16', NULL, NULL),
(17, 7, 'YHOD0C', '2010-05-14 10:00:32', '2010-05-14 10:00:32', NULL, NULL),
(18, 7, 'DXW4QH', '2010-05-14 10:02:05', '2010-05-14 10:02:05', NULL, NULL),
(19, 7, '7E10JB', '2010-05-14 10:03:34', '2010-05-14 10:03:34', NULL, NULL),
(20, 7, '37OLYX', '2010-05-14 10:07:12', '2010-05-14 10:07:12', NULL, NULL),
(21, 7, 'PRUH96', '2010-05-14 10:09:25', '2010-05-14 10:09:25', NULL, NULL),
(22, 7, 'I0V3ZE', '2010-05-14 10:10:47', '2010-05-14 10:10:47', NULL, NULL),
(23, 7, 'YASV96', '2010-05-14 10:11:42', '2010-05-14 10:11:42', NULL, NULL),
(24, 7, 'WE7LK8', '2010-05-14 10:13:25', '2010-05-14 10:13:25', NULL, NULL),
(25, 7, '5MHUB7', '2010-05-14 10:16:00', '2010-05-14 10:16:00', NULL, NULL),
(26, 7, '2ZWAUH', '2010-05-14 10:16:35', '2010-05-14 10:16:35', NULL, NULL),
(27, 7, 'JA32DC', '2010-05-14 10:19:22', '2010-05-14 10:19:22', NULL, NULL),
(28, 7, 'N14E82', '2010-05-14 10:20:34', '2010-05-14 10:20:34', NULL, NULL),
(29, 7, '7QVK1I', '2010-05-14 10:21:32', '2010-05-14 10:21:32', NULL, NULL),
(30, 7, 'SYOQT6', '2010-05-14 10:22:13', '2010-05-14 10:22:13', NULL, NULL),
(31, 7, '9MZWD4', '2010-05-14 10:23:37', '2010-05-14 10:23:37', NULL, NULL),
(32, 7, '5IK64J', '2010-05-14 10:35:24', '2010-05-14 10:35:24', NULL, NULL),
(33, 7, 'TVHP0B', '2010-05-14 10:38:41', '2010-05-14 10:38:41', NULL, NULL),
(34, 7, 'XSPJL0', '2010-05-14 10:39:44', '2010-05-14 10:39:44', NULL, NULL),
(35, 7, 'KSOLXW', '2010-05-14 10:41:59', '2010-05-14 10:41:59', NULL, NULL),
(36, 7, 'TN1YXL', '2010-05-14 10:48:13', '2010-05-14 10:48:13', NULL, NULL),
(37, 7, 'B14GE5', '2010-05-14 11:26:01', '2010-05-14 11:26:01', NULL, NULL),
(38, 7, 'Q3M9CW', '2010-05-14 11:27:02', '2010-05-14 11:27:02', NULL, NULL),
(39, 7, 'A2F9SM', '2010-05-14 11:28:19', '2010-05-14 11:28:19', NULL, NULL),
(40, 7, 'RV2GHK', '2010-05-14 11:29:28', '2010-05-14 11:29:28', NULL, NULL),
(41, 7, 'DUN4AK', '2010-05-14 11:32:42', '2010-05-14 11:32:42', NULL, NULL),
(42, 7, 'GUPX1Y', '2010-05-14 11:37:22', '2010-05-14 11:37:22', NULL, NULL),
(43, 7, 'HALUX7', '2010-05-14 11:42:25', '2010-05-14 11:42:25', NULL, NULL),
(44, 7, 'MVG1WD', '2010-05-14 11:43:34', '2010-05-14 11:43:34', NULL, NULL),
(45, 7, 'SM3W0K', '2010-05-14 11:44:23', '2010-05-14 11:44:23', NULL, NULL),
(46, 7, 'JVDA0I', '2010-05-14 11:45:30', '2010-05-14 11:45:30', NULL, NULL),
(47, 7, '3OAVDZ', '2010-05-14 11:46:23', '2010-05-14 11:46:23', NULL, NULL),
(48, 7, '02TBAL', '2010-05-14 11:48:27', '2010-05-14 11:48:27', NULL, NULL),
(49, 7, 'SC714D', '2010-05-14 11:49:22', '2010-05-14 11:49:22', NULL, NULL),
(50, 7, '05VYZ9', '2010-05-14 11:52:48', '2010-05-14 11:52:48', NULL, NULL),
(51, 7, '1OQ8MA', '2010-05-14 11:54:08', '2010-05-14 11:54:08', NULL, NULL),
(52, 7, 'ZJO9Q0', '2010-05-14 11:54:42', '2010-05-14 11:54:42', NULL, NULL),
(53, 7, 'OWCK2B', '2010-05-14 11:58:15', '2010-05-14 11:58:15', NULL, NULL),
(54, 7, '231DWN', '2010-05-14 11:59:14', '2010-05-14 11:59:14', NULL, NULL),
(55, 7, 'MNZLU7', '2010-05-14 12:00:12', '2010-05-14 12:00:12', NULL, NULL),
(56, 7, 'TY14R6', '2010-05-14 12:05:46', '2010-05-14 12:05:46', NULL, NULL),
(57, 7, '5F8UOE', '2010-05-14 12:06:35', '2010-05-14 12:06:35', NULL, NULL),
(58, 7, 'GT6YNI', '2010-05-14 12:08:47', '2010-05-14 12:08:47', NULL, NULL),
(59, 7, 'A2Q0UN', '2010-05-14 12:11:07', '2010-05-14 12:11:07', NULL, NULL),
(60, 7, 'I5XLOE', '2010-05-14 12:13:20', '2010-05-14 12:13:20', NULL, NULL);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=55 ;

--
-- Dumping data for table `registrators`
--

INSERT INTO `registrators` (`id`, `registration_id`, `first_name`, `last_name`, `email`, `phone`, `c_o`, `street_address`, `city`, `postal_code`, `extra_information`) VALUES
(1, 1, 'aa', 'ab', 'andreas_fliesberg@hotmail.com', '234567890', '', 'wwwwwww', 'es', '34566', ''),
(2, 2, 'Andreas', 'Fliesberg', 'andreas_fliesberg@hotmail.com', '070-123456789', '', 'Wollmar Yxkullsgatan 28', 'Stockholm', '121 83', 'Tim Olsson i mitt sällskap är allergisk mot spiskummin'),
(3, 9, 'Andreas', 'Fliesberg', 'andreas_fliesberg@hotmail.com', '070-123456789', '', 'Wollmar Yxkullsgatan 28', 'Stockholm', '121 83', 'Tim Olsson i mitt sällskap är allergisk mot spiskummin'),
(4, 10, 'Andreas', 'Fliesberg', 'andreas_fliesberg@hotmail.com', '070-123456789', '', 'Wollmar Yxkullsgatan 28', 'Stockholm', '121 83', 'Tim Olsson i mitt sällskap är allergisk mot spiskummin'),
(5, 11, 'Andreas', 'Fliesberg', 'andreas_fliesberg@hotmail.com', '070-123456789', '', 'Wollmar Yxkullsgatan 28', 'Stockholm', '121 83', 'Tim Olsson i mitt sällskap är allergisk mot spiskummin'),
(6, 12, 'Andreas', 'Fliesberg', 'andreas_fliesberg@hotmail.com', '070-123456789', '', 'Wollmar Yxkullsgatan 28', 'Stockholm', '121 83', 'Tim Olsson i mitt sällskap är allergisk mot spiskummin'),
(7, 13, 'Andreas', 'Fliesberg', 'andreas_fliesberg@hotmail.com', '070-123456789', '', 'Wollmar Yxkullsgatan 28', 'Stockholm', '121 83', 'Tim Olsson i mitt sällskap är allergisk mot spiskummin'),
(8, 14, 'Andreas', 'Fliesberg', 'andreas_fliesberg@hotmail.com', '070-123456789', '', 'Wollmar Yxkullsgatan 28', 'Stockholm', '121 83', 'Tim Olsson i mitt sällskap är allergisk mot spiskummin'),
(9, 15, 'Andreas', 'Fliesberg', 'andreas_fliesberg@hotmail.com', '070-123456789', '', 'Wollmar Yxkullsgatan 28', 'Stockholm', '121 83', 'Tim Olsson i mitt sällskap är allergisk mot spiskummin'),
(10, 16, 'Andreas', 'Fliesberg', 'andreas_fliesberg@hotmail.com', '070-123456789', '', 'Wollmar Yxkullsgatan 28', 'Stockholm', '121 83', 'Tim Olsson i mitt sällskap är allergisk mot spiskummin'),
(11, 17, 'Andreas', 'Fliesberg', 'andreas_fliesberg@hotmail.com', '070-123456789', '', 'Wollmar Yxkullsgatan 28', 'Stockholm', '121 83', 'Tim Olsson i mitt sällskap är allergisk mot spiskummin'),
(12, 18, 'Andreas', 'Fliesberg', 'andreas_fliesberg@hotmail.com', '070-123456789', '', 'Wollmar Yxkullsgatan 28', 'Stockholm', '121 83', 'Tim Olsson i mitt sällskap är allergisk mot spiskummin'),
(13, 19, 'Andreas', 'Fliesberg', 'andreas_fliesberg@hotmail.com', '070-123456789', '', 'Wollmar Yxkullsgatan 28', 'Stockholm', '121 83', 'Tim Olsson i mitt sällskap är allergisk mot spiskummin'),
(14, 20, 'Andreas', 'Fliesberg', 'andreas_fliesberg@hotmail.com', '070-123456789', '', 'Wollmar Yxkullsgatan 28', 'Stockholm', '121 83', 'Tim Olsson i mitt sällskap är allergisk mot spiskummin'),
(15, 21, 'Andreas', 'Fliesberg', 'andreas_fliesberg@hotmail.com', '070-123456789', '', 'Wollmar Yxkullsgatan 28', 'Stockholm', '121 83', 'Tim Olsson i mitt sällskap är allergisk mot spiskummin'),
(16, 22, 'Andreas', 'Fliesberg', 'andreas_fliesberg@hotmail.com', '070-123456789', '', 'Wollmar Yxkullsgatan 28', 'Stockholm', '121 83', 'Tim Olsson i mitt sällskap är allergisk mot spiskummin'),
(17, 23, 'Andreas', 'Fliesberg', 'andreas_fliesberg@hotmail.com', '070-123456789', '', 'Wollmar Yxkullsgatan 28', 'Stockholm', '121 83', 'Tim Olsson i mitt sällskap är allergisk mot spiskummin'),
(18, 24, 'Andreas', 'Fliesberg', 'andreas_fliesberg@hotmail.com', '070-123456789', '', 'Wollmar Yxkullsgatan 28', 'Stockholm', '121 83', 'Tim Olsson i mitt sällskap är allergisk mot spiskummin'),
(19, 25, 'Andreas', 'Fliesberg', 'andreas_fliesberg@hotmail.com', '070-123456789', '', 'Wollmar Yxkullsgatan 28', 'Stockholm', '121 83', 'Tim Olsson i mitt sällskap är allergisk mot spiskummin'),
(20, 26, 'Andreas', 'Fliesberg', 'andreas_fliesberg@hotmail.com', '070-123456789', '', 'Wollmar Yxkullsgatan 28', 'Stockholm', '121 83', 'Tim Olsson i mitt sällskap är allergisk mot spiskummin'),
(21, 27, 'Andreas', 'Fliesberg', 'andreas_fliesberg@hotmail.com', '070-123456789', '', 'Wollmar Yxkullsgatan 28', 'Stockholm', '121 83', 'Tim Olsson i mitt sällskap är allergisk mot spiskummin'),
(22, 28, 'Andreas', 'Fliesberg', 'andreas_fliesberg@hotmail.com', '070-123456789', '', 'Wollmar Yxkullsgatan 28', 'Stockholm', '121 83', 'Tim Olsson i mitt sällskap är allergisk mot spiskummin'),
(23, 29, 'Andreas', 'Fliesberg', 'andreas_fliesberg@hotmail.com', '070-123456789', '', 'Wollmar Yxkullsgatan 28', 'Stockholm', '121 83', 'Tim Olsson i mitt sällskap är allergisk mot spiskummin'),
(24, 30, 'Andreas', 'Fliesberg', 'andreas_fliesberg@hotmail.com', '070-123456789', '', 'Wollmar Yxkullsgatan 28', 'Stockholm', '121 83', 'Tim Olsson i mitt sällskap är allergisk mot spiskummin'),
(25, 31, 'Andreas', 'Fliesberg', 'andreas_fliesberg@hotmail.com', '070-123456789', '', 'Wollmar Yxkullsgatan 28', 'Stockholm', '121 83', 'Tim Olsson i mitt sällskap är allergisk mot spiskummin'),
(26, 32, 'Andreas', 'Fliesberg', 'andreas_fliesberg@hotmail.com', '070-123456789', '', 'Wollmar Yxkullsgatan 28', 'Stockholm', '121 83', 'Tim Olsson i mitt sällskap är allergisk mot spiskummin'),
(27, 33, 'Andreas', 'Fliesberg', 'andreas_fliesberg@hotmail.com', '070-123456789', '', 'Wollmar Yxkullsgatan 28', 'Stockholm', '121 83', 'Tim Olsson i mitt sällskap är allergisk mot spiskummin'),
(28, 34, 'Andreas', 'Fliesberg', 'andreas_fliesberg@hotmail.com', '070-123456789', '', 'Wollmar Yxkullsgatan 28', 'Stockholm', '121 83', 'Tim Olsson i mitt sällskap är allergisk mot spiskummin'),
(29, 35, 'Andreas', 'Fliesberg', 'andreas_fliesberg@hotmail.com', '070-123456789', '', 'Wollmar Yxkullsgatan 28', 'Stockholm', '121 83', 'Tim Olsson i mitt sällskap är allergisk mot spiskummin'),
(30, 36, 'Andreas', 'Fliesberg', 'andreas_fliesberg@hotmail.com', '070-123456789', '', 'Wollmar Yxkullsgatan 28', 'Stockholm', '121 83', 'Tim Olsson i mitt sällskap är allergisk mot spiskummin'),
(31, 37, 'Andreas', 'Fliesberg', 'andreas_fliesberg@hotmail.com', '070-123456789', '', 'Wollmar Yxkullsgatan 28', 'Stockholm', '121 83', 'Tim Olsson i mitt sällskap är allergisk mot spiskummin'),
(32, 38, 'Andreas', 'Fliesberg', 'andreas_fliesberg@hotmail.com', '070-123456789', '', 'Wollmar Yxkullsgatan 28', 'Stockholm', '121 83', 'Tim Olsson i mitt sällskap är allergisk mot spiskummin'),
(33, 39, 'Andreas', 'Fliesberg', 'andreas_fliesberg@hotmail.com', '070-123456789', '', 'Wollmar Yxkullsgatan 28', 'Stockholm', '121 83', 'Tim Olsson i mitt sällskap är allergisk mot spiskummin'),
(34, 40, 'Andreas', 'Fliesberg', 'andreas_fliesberg@hotmail.com', '070-123456789', '', 'Wollmar Yxkullsgatan 28', 'Stockholm', '121 83', 'Tim Olsson i mitt sällskap är allergisk mot spiskummin'),
(35, 41, 'Andreas', 'Fliesberg', 'andreas_fliesberg@hotmail.com', '070-123456789', '', 'Wollmar Yxkullsgatan 28', 'Stockholm', '121 83', 'Tim Olsson i mitt sällskap är allergisk mot spiskummin'),
(36, 42, 'Andreas', 'Fliesberg', 'andreas_fliesberg@hotmail.com', '070-123456789', '', 'Wollmar Yxkullsgatan 28', 'Stockholm', '121 83', 'Tim Olsson i mitt sällskap är allergisk mot spiskummin'),
(37, 43, 'Andreas', 'Fliesberg', 'andreas_fliesberg@hotmail.com', '070-123456789', '', 'Wollmar Yxkullsgatan 28', 'Stockholm', '121 83', 'Tim Olsson i mitt sällskap är allergisk mot spiskummin'),
(38, 44, 'Andreas', 'Fliesberg', 'andreas_fliesberg@hotmail.com', '070-123456789', '', 'Wollmar Yxkullsgatan 28', 'Stockholm', '121 83', 'Tim Olsson i mitt sällskap är allergisk mot spiskummin'),
(39, 45, 'Andreas', 'Fliesberg', 'andreas_fliesberg@hotmail.com', '070-123456789', '', 'Wollmar Yxkullsgatan 28', 'Stockholm', '121 83', 'Tim Olsson i mitt sällskap är allergisk mot spiskummin'),
(40, 46, 'Andreas', 'Fliesberg', 'andreas_fliesberg@hotmail.com', '070-123456789', '', 'Wollmar Yxkullsgatan 28', 'Stockholm', '121 83', 'Tim Olsson i mitt sällskap är allergisk mot spiskummin'),
(41, 47, 'Andreas', 'Fliesberg', 'andreas_fliesberg@hotmail.com', '070-123456789', '', 'Wollmar Yxkullsgatan 28', 'Stockholm', '121 83', 'Tim Olsson i mitt sällskap är allergisk mot spiskummin'),
(42, 48, 'Andreas', 'Fliesberg', 'andreas_fliesberg@hotmail.com', '070-123456789', '', 'Wollmar Yxkullsgatan 28', 'Stockholm', '121 83', 'Tim Olsson i mitt sällskap är allergisk mot spiskummin'),
(43, 49, 'Andreas', 'Fliesberg', 'andreas_fliesberg@hotmail.com', '070-123456789', '', 'Wollmar Yxkullsgatan 28', 'Stockholm', '121 83', 'Tim Olsson i mitt sällskap är allergisk mot spiskummin'),
(44, 50, 'Andreas', 'Fliesberg', 'andreas_fliesberg@hotmail.com', '070-123456789', '', 'Wollmar Yxkullsgatan 28', 'Stockholm', '121 83', 'Tim Olsson i mitt sällskap är allergisk mot spiskummin'),
(45, 51, 'Andreas', 'Fliesberg', 'andreas_fliesberg@hotmail.com', '070-123456789', '', 'Wollmar Yxkullsgatan 28', 'Stockholm', '121 83', 'Tim Olsson i mitt sällskap är allergisk mot spiskummin'),
(46, 52, 'Andreas', 'Fliesberg', 'andreas_fliesberg@hotmail.com', '070-123456789', '', 'Wollmar Yxkullsgatan 28', 'Stockholm', '121 83', 'Tim Olsson i mitt sällskap är allergisk mot spiskummin'),
(47, 53, 'Andreas', 'Fliesberg', 'andreas_fliesberg@hotmail.com', '070-123456789', '', 'Wollmar Yxkullsgatan 28', 'Stockholm', '121 83', 'Tim Olsson i mitt sällskap är allergisk mot spiskummin'),
(48, 54, 'Andreas', 'Fliesberg', 'andreas_fliesberg@hotmail.com', '070-123456789', '', 'Wollmar Yxkullsgatan 28', 'Stockholm', '121 83', 'Tim Olsson i mitt sällskap är allergisk mot spiskummin'),
(49, 55, 'Andreas', 'Fliesberg', 'andreas_fliesberg@hotmail.com', '070-123456789', '', 'Wollmar Yxkullsgatan 28', 'Stockholm', '121 83', 'Tim Olsson i mitt sällskap är allergisk mot spiskummin'),
(50, 56, 'Andreas', 'Fliesberg', 'andreas_fliesberg@hotmail.com', '070-123456789', '', 'Wollmar Yxkullsgatan 28', 'Stockholm', '121 83', 'Tim Olsson i mitt sällskap är allergisk mot spiskummin'),
(51, 57, 'Andreas', 'Fliesberg', 'andreas_fliesberg@hotmail.com', '070-123456789', '', 'Wollmar Yxkullsgatan 28', 'Stockholm', '121 83', 'Tim Olsson i mitt sällskap är allergisk mot spiskummin'),
(52, 58, 'Andreas', 'Fliesberg', 'andreas_fliesberg@hotmail.com', '070-123456789', '', 'Wollmar Yxkullsgatan 28', 'Stockholm', '121 83', 'Tim Olsson i mitt sällskap är allergisk mot spiskummin'),
(53, 59, 'Andreas', 'Fliesberg', 'andreas_fliesberg@hotmail.com', '070-123456789', '', 'Wollmar Yxkullsgatan 28', 'Stockholm', '121 83', 'Tim Olsson i mitt sällskap är allergisk mot spiskummin'),
(54, 60, 'Andreas', 'Fliesberg', 'andreas_fliesberg@hotmail.com', '070-123456789', '', 'Wollmar Yxkullsgatan 28', 'Stockholm', '121 83', 'Tim Olsson i mitt sällskap är allergisk mot spiskummin');

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
(5, 'Pris', 'Rabattkoder', 'ReductionCodes', 'create');
