-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Client: 127.0.0.1:3306
-- Généré le : Ven 19 Décembre 2014 à 17:50
-- Version du serveur: 5.5.37
-- Version de PHP: 5.5.13-2+deb.sury.org~precise+1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";
set foreign_key_checks = 0;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `tradelab_dev`
--

-- --------------------------------------------------------

--
-- Structure de la table `exelate_pixel`
--

CREATE TABLE IF NOT EXISTS `exelate_pixel` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `usr_id` mediumint(8) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `active` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `usr_id_2` (`usr_id`,`name`),
  KEY `usr_id` (`usr_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Contenu de la table `exelate_pixel`
--

INSERT INTO `exelate_pixel` (`id`, `usr_id`, `name`, `active`) VALUES
(1, 527, 'AdvertiserA Performance - Pixel #1', 1),
(2, 633, 'AdvertiserB - Pixel #1', 1),
(3, 306, 'AdvertiserC - Pixel #1', 1),
(4, 758, 'AdvertiserD - Pixel #1', 1),
(5, 801, 'AdvertiserE - Pixel #1', 1),
(6, 527, 'AdvertiserF - Pixel #2', 1),
(7, 633, 'AdvertiserG - Pixel #2', 1),
(8, 528, 'AdvertiserH - Pixel #1', 1),
(9, 526, 'AdvertiserI - Pixel #1', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
