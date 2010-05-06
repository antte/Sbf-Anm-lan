-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 06, 2010 at 08:17 AM
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

--
-- Dumping data for table `steps`
--

INSERT INTO `steps` (`id`, `name`, `admin_label`, `controller`, `action`) VALUES
(1, 'Sällskap', 'Anmälda', 'People', 'create'),
(2, 'Kontaktuppgifter', 'Bokningar', 'Registrators', 'create'),
(3, 'Granska', '', 'Registrations', 'review'),
(4, 'Kvitto', '', 'Registrations', 'receipt'),
(5, '', 'Rabattkoder', 'ReductionCodes', 'create');
