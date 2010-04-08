-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 07, 2010 at 12:01 PM
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

INSERT INTO `events` (`id`, `name`, `is_active`, `confirmation_message`) VALUES
(7, 'Gala', 1, 'gala confirm message super duper'),
(8, 'Konferens', 0, NULL);

--
-- Dumping data for table `events_steps`
--

INSERT INTO `events_steps` (`event_id`, `step_id`, `order`) VALUES
(7, 1, 1),
(7, 2, 2),
(7, 4, 4),
(7, 3, 3);

--
-- Dumping data for table `people`
--

INSERT INTO `people` (`registration_id`, `id`, `role_id`, `first_name`, `last_name`) VALUES
(54, 1, 15, 'sdg', 'sdg'),
(55, 2, 14, 'sdg', 'sdfh'),
(56, 3, 14, 'fgh', 'qwer'),
(57, 4, 14, 'fgh', 'qwer'),
(58, 5, 14, 'asd', 'aesft'),
(59, 6, 14, 'asd', 'aesft'),
(60, 7, 14, 'asdg', 'sdg'),
(61, 8, 14, 'adg', 'adfh'),
(62, 9, 14, 'adg', 'adfh'),
(63, 10, 14, 'asdg', 'afsdg'),
(64, 11, 15, 'asdf', 'asdfh'),
(65, 12, 14, 'asfd', 'qwer'),
(66, 13, 14, 'asf', 'sdfg'),
(67, 14, 15, 'sdfg', 'qwert'),
(67, 15, 14, 'sdf', 'rg'),
(68, 16, 14, 'sdfgqwer', 'qwert'),
(69, 17, 14, 'asdf', 'qwe'),
(70, 18, 14, 'asdf', 'qwe'),
(71, 19, 16, 'asdfgh', 'qwert'),
(72, 20, 16, 'adfgh', 'fgh'),
(73, 21, 14, 'sdf', 'qwer'),
(74, 22, 15, 'wertyu', 'wertyuil'),
(75, 23, 16, 'dgkj', 'qwerty'),
(76, 24, 15, 'sedrtfgyh', 'esdfgh');

--
-- Dumping data for table `registrations`
--

INSERT INTO `registrations` (`id`, `event_id`, `number`, `created`, `modified`) VALUES
(54, 7, 'LHC8J0', '2010-03-29 11:51:44', '2010-03-29 11:51:44'),
(55, 7, 'D7VOCU', '2010-03-29 13:59:00', '2010-03-29 13:59:00'),
(56, 7, '430JBP', '2010-03-29 14:14:55', '2010-03-29 14:14:55'),
(57, 7, 'M3EKQJ', '2010-03-29 14:15:20', '2010-03-29 14:15:20'),
(58, 7, 'QB61NE', '2010-03-29 14:18:44', '2010-03-29 14:18:44'),
(59, 7, 'ATEXJM', '2010-03-29 14:19:14', '2010-03-29 14:19:14'),
(60, 7, 'Y9NQGK', '2010-03-29 14:35:08', '2010-03-29 14:35:08'),
(61, 7, '4NBAR3', '2010-03-29 14:37:35', '2010-03-29 14:37:35'),
(62, 7, 'VIAHGZ', '2010-03-29 14:37:43', '2010-03-29 14:37:43'),
(63, 7, 'O27GVI', '2010-03-29 14:38:18', '2010-03-29 14:38:18'),
(64, 7, 'G794J6', '2010-03-29 14:45:43', '2010-03-29 14:45:43'),
(65, 7, 'EJSAGZ', '2010-03-29 14:48:27', '2010-03-29 14:48:27'),
(66, 7, '9CEBVM', '2010-03-29 14:59:08', '2010-03-29 14:59:08'),
(67, 7, '6ZE0NQ', '2010-04-06 11:10:37', '2010-04-06 11:10:37'),
(68, 7, 'QSV9YO', '2010-04-06 11:16:57', '2010-04-06 11:16:57'),
(69, 7, 'DT3YN4', '2010-04-06 11:57:01', '2010-04-06 11:57:01'),
(70, 7, 'QS1OBN', '2010-04-06 12:00:46', '2010-04-06 12:00:46'),
(71, 7, 'RGFU8B', '2010-04-06 13:36:09', '2010-04-06 13:36:09'),
(72, 7, 'VONXPR', '2010-04-06 13:42:10', '2010-04-06 13:42:10'),
(73, 7, 'O5X7A8', '2010-04-06 13:49:26', '2010-04-06 13:49:26'),
(74, 7, 'QCGDM0', '2010-04-06 13:51:47', '2010-04-06 13:51:47'),
(75, 7, 'AZ7FVH', '2010-04-06 14:03:37', '2010-04-06 14:03:37'),
(76, 7, 'EI5ZBP', '2010-04-06 14:11:52', '2010-04-06 14:11:52');

--
-- Dumping data for table `registrators`
--

INSERT INTO `registrators` (`registration_id`, `first_name`, `last_name`, `email`, `phone`, `c_o`, `street_address`, `city`, `postal_code`) VALUES
(54, 'FGSG', 'GFSG', 'a@a.nu', '', NULL, 'SDFG', 'sdg', '12142'),
(55, 'sdg', 'srg', 'andreas_fliesberg@hotmail.com', '', NULL, 'aef', 'adg', '21412'),
(56, 'sdg', 'qwer', 'andreas_fliesberg@hotmail.com', '', NULL, 'aagh', 'awertyu', '23451'),
(57, 'sdg', 'qwer', 'andreas_fliesberg@hotmail.com', '', NULL, 'aagh', 'awertyu', '23451'),
(58, 'asdg', 'asdg', 'andreas_fliesberg@hotmail.com', '', NULL, 'asdfg', 'sdgh', '12346'),
(59, 'asdg', 'asdg', 'andreas_fliesberg@hotmail.com', '', NULL, 'asdfg', 'sdgh', '12346'),
(60, 'asdf', 'sadf', 'andreas_fliesberg@hotmail.com', '', NULL, 'sadg', 'sdg', '12415'),
(61, 'asdfg', 'adf', 'andreas_fliesberg@hotmail.com', '', NULL, 'sadg', 'edg', '12451'),
(62, 'asdfg', 'adf', 'andreas_fliesberg@hotmail.com', '', NULL, 'sadg', 'edg', '12451'),
(63, 'sdg', 'sdgf', 'andreas_fliesberg@hotmail.com', '4575434', NULL, 'adsgsg', 'egahh', '32434'),
(64, 'qwed', 'wer', 'andreas_fliesberg@hotmail.com', '32541346', 'cocoocococcocc', 'dfghj', 'tyuikjl', '23456'),
(65, 'g', 'qwe', 'andreas_fliesberg@hotmail.com', '34567842', 'edrftgyh', 'wedrfghj', 'aseftyui', '23453'),
(66, 'asdwedf', 'sdagf', 'andreas_fliesberg@hotmail.com', '345678523', 'sadfghj', 'sdfghj', 'asdrftgjh', '34564'),
(67, 'sdfg', 'qwert', 'a@a.nu', '234567843', '', 'asfdasg', 'sadfghjkl', '23456'),
(68, 'sdfgqwer', 'qwert', 'a@a.nu', '23456789', '', 'sadasd', 'asdsdas', '21412'),
(69, 'asdf', 'qwe', 'a@a.nu', '23456789', '', 'adf', 'sdfs', '12351'),
(70, 'asdf', 'qwe', 'a@a.nu', '23456789', '', 'adf', 'sdfs', '12351'),
(71, 'asdfgh', 'qwert', 'a@a.nu', '234567890', '', 'qwefhj', 'sdfgh', '12521'),
(72, 'adfgh', 'fgh', 'a@a.nu', '234567890', '', 'dfgh', 'eh', '24554'),
(73, 'sdf', 'qwer', 'a@a.nu', '23456789', '', 'rtyu', 'wsedrftyukjl', '23456'),
(74, 'wertyu', 'wertyuil', 'a@a.nu', '34567890', '', 'edfghj', 'ertuk', '34567'),
(75, 'dgkj', 'qwerty', 'a@a.nu', '23456890', '', 'sedfghj', 'sdrfgthjk', '34567'),
(76, 'sedrtfgyh', 'esdfgh', 'a@a.nu', '34567890', 'werfgth', 'qwert', 'rsdyhde', '12345');

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(14, 'Besökare'),
(15, 'VIP'),
(16, 'Ordförande'),
(17, 'Styrelsemedlem');

--
-- Dumping data for table `steps`
--

INSERT INTO `steps` (`id`, `name`, `controller`, `action`) VALUES
(1, 'Sällskap', 'People', 'create'),
(2, 'Kontaktuppgifter', 'Registrators', 'create'),
(3, 'Granska', 'Registrations', 'review'),
(4, 'Kvitto', 'Registrations', 'receipt');
