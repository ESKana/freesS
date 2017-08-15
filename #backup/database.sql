-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 14 Août 2017 à 17:39
-- Version du serveur :  5.6.24
-- Version de PHP :  5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `webdesign_twitter`
--

-- --------------------------------------------------------

--
-- Structure de la table `url`
--

CREATE TABLE IF NOT EXISTS `url` (
  `id_url` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `rank` varchar(255) NOT NULL,
  `id_user` int(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `url`
--

INSERT INTO `url` (`id_url`, `url`, `rank`, `id_user`) VALUES
(1, 'freeSocialaezrfgzrethj.onion', 'admin', 2);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `url`
--
ALTER TABLE `url`
  ADD PRIMARY KEY (`id_url`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `url`
--
ALTER TABLE `url`
  MODIFY `id_url` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
