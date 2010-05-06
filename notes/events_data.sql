-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 06, 2010 at 08:07 AM
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
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `name`, `is_active`, `confirmation_message`, `price_per_person`) VALUES
(7, 'Gala', 1, 'Välkommen!', 1100.5),
(8, 'Konferens', 1, 'Du är välkommen att ta med mat till konferensen', 150),
(9, 'Gala 2009', 0, 'hejhopp', 1100.5);
