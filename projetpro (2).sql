-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 13 jan. 2021 à 00:23
-- Version du serveur :  8.0.18
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `projetpro`
--

-- --------------------------------------------------------

--
-- Structure de la table `box_options`
--

DROP TABLE IF EXISTS `box_options`;
CREATE TABLE IF NOT EXISTS `box_options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_plat` int(11) NOT NULL,
  `choix` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `categories_plats`
--

DROP TABLE IF EXISTS `categories_plats`;
CREATE TABLE IF NOT EXISTS `categories_plats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `commandes`
--

DROP TABLE IF EXISTS `commandes`;
CREATE TABLE IF NOT EXISTS `commandes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_utilisateur` int(11) NOT NULL,
  `prix` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `numero_commande` int(11) NOT NULL,
  `moyen_paiement` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `commandes_options`
--

DROP TABLE IF EXISTS `commandes_options`;
CREATE TABLE IF NOT EXISTS `commandes_options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_commande` int(11) NOT NULL,
  `id_box_options` int(11) NOT NULL,
  `id_plat` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `commandes_plats`
--

DROP TABLE IF EXISTS `commandes_plats`;
CREATE TABLE IF NOT EXISTS `commandes_plats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `numero_commande` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prix` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `id_plat` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `pack`
--

DROP TABLE IF EXISTS `pack`;
CREATE TABLE IF NOT EXISTS `pack` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `prix` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `pack_options`
--

DROP TABLE IF EXISTS `pack_options`;
CREATE TABLE IF NOT EXISTS `pack_options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pack` int(11) NOT NULL,
  `id_categorie_plat` int(11) NOT NULL,
  `id_plat` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

DROP TABLE IF EXISTS `panier`;
CREATE TABLE IF NOT EXISTS `panier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quantite` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `id_plat` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `plats`
--

DROP TABLE IF EXISTS `plats`;
CREATE TABLE IF NOT EXISTS `plats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `prix` int(11) NOT NULL,
  `id_categorie_plat` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `popup`
--

DROP TABLE IF EXISTS `popup`;
CREATE TABLE IF NOT EXISTS `popup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `genre` tinyint(1) NOT NULL,
  `objectif` int(11) NOT NULL,
  `age` int(11) NOT NULL,
  `habitude` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `preference_user`
--

DROP TABLE IF EXISTS `preference_user`;
CREATE TABLE IF NOT EXISTS `preference_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_utilisateur` int(11) NOT NULL,
  `boeuf` tinyint(1) NOT NULL,
  `poulet` tinyint(1) NOT NULL,
  `dinde` tinyint(1) NOT NULL,
  `saumon` tinyint(1) NOT NULL,
  `thon` tinyint(1) NOT NULL,
  `calamar` tinyint(1) NOT NULL,
  `haricots` tinyint(1) NOT NULL,
  `pommeDeTerre` tinyint(1) NOT NULL,
  `brocolis` tinyint(1) NOT NULL,
  `avocat` tinyint(1) NOT NULL,
  `choux` tinyint(1) NOT NULL,
  `salade` tinyint(1) NOT NULL,
  `poivrons` tinyint(1) NOT NULL,
  `champignon` tinyint(1) NOT NULL,
  `lentilles` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `preference_user`
--

INSERT INTO `preference_user` (`id`, `id_utilisateur`, `boeuf`, `poulet`, `dinde`, `saumon`, `thon`, `calamar`, `haricots`, `pommeDeTerre`, `brocolis`, `avocat`, `choux`, `salade`, `poivrons`, `champignon`, `lentilles`) VALUES
(10, 24, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `civilite` tinyint(1) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `tel` int(11) NOT NULL,
  `id_popup` int(11) NOT NULL,
  `id_droits` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `civilite`, `nom`, `prenom`, `mdp`, `mail`, `tel`, `id_popup`, `id_droits`) VALUES
(24, 1, 'Azzouz', 'Mohamed', '$2y$12$LgHU9Wq/pAa4.LTas4si3e.zdFjghQ6IEEdNUBPN.SgQCtiHvAgE6', 'azzouz.mohamed@outlook.com', 695969727, 0, 10);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
