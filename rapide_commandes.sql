-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  Dim 22 déc. 2019 à 10:18
-- Version du serveur :  5.7.21
-- Version de PHP :  7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `market`
--

-- --------------------------------------------------------

--
-- Structure de la table `rapide_commandes`
--

DROP TABLE IF EXISTS `rapide_commandes`;
CREATE TABLE IF NOT EXISTS `rapide_commandes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(255) NOT NULL,
  `id_client` int(10) NOT NULL,
  `statut` int(1) NOT NULL COMMENT '0=en attente ; 1=livré ; 2=annulé ; 3=en cours de livraison; 4=rejeté',
  `montant_ht` float DEFAULT NULL,
  `frais_livraison` float DEFAULT NULL,
  `montant_total` float DEFAULT NULL,
  `image_link` varchar(255) DEFAULT NULL,
  `description_commande` text,
  `id_livraison_destination` int(11) NOT NULL,
  `id_livreur` int(20) DEFAULT NULL,
  `id_utilisateur` int(20) DEFAULT NULL,
  `motif_rejet` text,
  `date_creation` datetime NOT NULL,
  `date_modification` datetime NOT NULL,
  `date_livraison` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
