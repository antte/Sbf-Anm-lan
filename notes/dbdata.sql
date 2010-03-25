-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 25, 2010 at 09:58 AM
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
(7, 'Årsmöte Svenska Bilsportförbundet 2010', 1),
(8, 'Årsmöte Svenska Bilsportförbundet 2009', 0);

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(11, 'Åhörare'),
(10, 'VIP'),
(12, 'Ordförande'),
(13, 'Styrelsemedlem');
