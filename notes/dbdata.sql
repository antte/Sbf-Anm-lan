-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Värd: localhost
-- Skapad: 29 mars 2010 kl 14:25
-- Serverversion: 5.1.36
-- PHP-version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databas: `sbf-anmalan`
--

--
-- Data i tabell `events`
--

INSERT INTO `events` (`id`, `name`, `is_active`, `confirmation_message`) VALUES
(7, 'Gala', 1, 'Du är välkommen att ta med dig egen mat till detta event.'),
(8, 'Konferens', 0, NULL);

--
-- Data i tabell `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(14, 'Besökare'),
(15, 'VIP'),
(16, 'Ordförande'),
(17, 'Styrelsemedlem');
