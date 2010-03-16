-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 16, 2010 at 10:28 AM
-- Server version: 5.1.36
-- PHP Version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `sbf-anmalan`
--

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `name`) VALUES
(1, 'testevent');

--
-- Dumping data for table `people`
--


--
-- Dumping data for table `registrations`
--


--
-- Dumping data for table `registrators`
--


--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'Kanslipersonal'),
(2, 'Värd'),
(3, 'En till roll'),
(4, 'Pristagare'),
(5, 'En annan roll');
