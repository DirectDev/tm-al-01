-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Client: 127.0.0.1:3306
-- Généré le : Mar 20 Janvier 2015 à 13:04
-- Version du serveur: 5.5.37
-- Version de PHP: 5.5.13-2+deb.sury.org~precise+1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";
set foreign_key_checks = 0 ;


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `tradelab_dev`
--

-- --------------------------------------------------------

--
-- Structure de la table `exelate_segment_subcategory`
--

CREATE TABLE IF NOT EXISTS `exelate_segment_subcategory` (
  `id` tinyint(2) unsigned NOT NULL AUTO_INCREMENT,
  `segment_category_id` tinyint(1) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `segment_category_id_2` (`segment_category_id`,`name`),
  KEY `segment_category_id` (`segment_category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=30 ;

--
-- Contenu de la table `exelate_segment_subcategory`
--

INSERT INTO `exelate_segment_subcategory` (`id`, `segment_category_id`, `name`) VALUES
(1, 1, 'Age'),
(2, 1, 'Career'),
(3, 1, 'Female Age'),
(5, 1, 'Gender'),
(6, 1, 'Household'),
(7, 1, 'Income Level'),
(4, 1, 'Male Age'),
(29, 1, 'Others'),
(28, 1, 'Technographics'),
(8, 1, 'Urbanicity'),
(9, 2, 'Auto Owners'),
(10, 2, 'Beauty and Style'),
(11, 2, 'Business'),
(12, 2, 'Entertainment'),
(13, 2, 'Events'),
(14, 2, 'Finance'),
(15, 2, 'General Interest'),
(16, 2, 'Hobbies'),
(17, 2, 'Home Improvement'),
(19, 2, 'Others'),
(18, 2, 'Parenting'),
(20, 2, 'Tech Enthusiasts'),
(21, 3, 'Auto Buyers'),
(22, 3, 'CPG'),
(23, 3, 'Finance and Insurance'),
(26, 3, 'Others'),
(24, 3, 'Services'),
(25, 3, 'Shopping'),
(27, 3, 'Travel');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `exelate_segment_subcategory`
--
ALTER TABLE `exelate_segment_subcategory`
  ADD CONSTRAINT `exelate_segment_subcategory_ibfk_1` FOREIGN KEY (`segment_category_id`) REFERENCES `exelate_segment_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
