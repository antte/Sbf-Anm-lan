-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 29, 2010 at 11:00 AM
-- Server version: 5.1.36
-- PHP Version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `sbf-anmalan`
--

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `name`, `is_active`) VALUES
(7, 'Gala', 1),
(8, 'Konferens', 0);

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(14, 'Besökare'),
(15, 'VIP'),
(16, 'Ordförande'),
(17, 'Styrelsemedlem');
