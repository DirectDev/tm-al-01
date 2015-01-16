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
-- Structure de la table `exelate_segment_subcategory`
--

CREATE TABLE IF NOT EXISTS `exelate_segment_subcategory` (
  `id` tinyint(2) unsigned NOT NULL AUTO_INCREMENT,
  `segment_category_id` tinyint(1) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `segment` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `segment_category_id_2` (`segment_category_id`,`name`),
  KEY `segment_category_id` (`segment_category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=34 ;

--
-- Contenu de la table `exelate_segment_subcategory`
--

INSERT INTO `exelate_segment_subcategory` (`id`, `segment_category_id`, `name`, `segment`) VALUES
(1, 1, 'Age', 0),
(2, 3, 'Auto - Buyers', 1),
(3, 2, 'Automotive Owners', 0),
(4, 2, 'Beauty and Style', 1),
(5, 2, 'Business', 0),
(6, 1, 'Career', 1),
(7, 3, 'CPG', 1),
(8, 2, 'Diet and Fitness', 1),
(9, 2, 'Entertainment', 1),
(10, 1, 'Female Age', 0),
(11, 1, 'Male Age', 0),
(12, 2, 'Events', 1),
(13, 2, 'Finance', 1),
(14, 3, 'Finance and Insurance', 1),
(15, 1, 'Gender', 0),
(16, 2, 'General Interest', 0),
(17, 2, 'Hobbies', 1),
(18, 2, 'Home Improvement', 1),
(19, 1, 'Household', 0),
(20, 1, 'Income Level', 0),
(21, 2, 'Parenting', 1),
(22, 2, 'Pets', 1),
(23, 2, 'Politics', 1),
(24, 3, 'Services', 0),
(25, 3, 'Shopping', 1),
(26, 2, 'Sports', 1),
(27, 2, 'Spring Seasonal', 0),
(28, 2, 'Tech - Enthusiasts', 1),
(29, 3, 'Tickets', 1),
(30, 3, 'Travel', 1),
(31, 1, 'Urbanicity', 0),
(32, 2, 'Purchase Behaviors', 0),
(33, 3, 'Propensity - Personal Tech', 0);

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
