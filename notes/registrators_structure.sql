-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 06, 2010 at 08:14 AM
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
