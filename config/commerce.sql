-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Mer 30 Août 2017 à 11:36
-- Version du serveur :  10.1.21-MariaDB
-- Version de PHP :  7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `commerce`
--

-- --------------------------------------------------------

--
-- Structure de la table `commerce`
--

CREATE TABLE `commerce` (
  `id` int(11) NOT NULL,
  `nom` varchar(30) NOT NULL DEFAULT 'inconnu',
  `rue` varchar(60) NOT NULL DEFAULT 'inconnu',
  `cp` varchar(10) NOT NULL DEFAULT 'inconnu',
  `ville` varchar(20) DEFAULT 'inconnu',
  `pays` varchar(20) NOT NULL DEFAULT 'inconnu',
  `phone` varchar(10) NOT NULL DEFAULT 'inconnu',
  `fix` varchar(12) NOT NULL DEFAULT 'inconnu',
  `mail` text NOT NULL,
  `actif` varchar(2) NOT NULL,
  `cat` varchar(20) NOT NULL DEFAULT 'inconnu',
  `lat` varchar(20) NOT NULL DEFAULT 'inconnu',
  `lng` varchar(20) NOT NULL DEFAULT 'inconnu',
  `icons` varchar(50) NOT NULL DEFAULT 'inconnu',
  `desmarqueur` varchar(150) NOT NULL DEFAULT 'inconnu',
  `des` varchar(500) NOT NULL DEFAULT 'inconnu',
  `image` varchar(30) NOT NULL DEFAULT 'inconnu',
  `lien` varchar(250) NOT NULL DEFAULT 'inconnu'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `commerce`
--

INSERT INTO `commerce` (`id`, `nom`, `rue`, `cp`, `ville`, `pays`, `phone`, `fix`, `mail`, `actif`, `cat`, `lat`, `lng`, `icons`, `desmarqueur`, `des`, `image`, `lien`) VALUES
(1, 'mac do', '190 impasse de la loueve', '42300', 'Villerest', 'FRANCE', '', '', 'mr.metaye.enzo@gmail.com', '1', 'food', '45.9870075', '4.0342917', 'icons/food.png', 'ok', 'desc', 'images/snacks.jpg', 'http://127.0.0.1/carte/'),
(2, 'transport', '12 rue saint martin', '68440', 'habsheim', 'FRANCE', '06', '', '', '1', 'transport', '47.7264821', '7.4250084', 'icons/test2.png', '2', 'grande', '', 'http://127.0.0.1/carte/'),
(7, 'Docteur didi', 'rue Jules ferry', '42300', 'Roanne', 'France', '0641935', '', 'mr.metayer.enzo@gmail.com', '1', 'docteur', '46.03171', '4.0700336', 'icons/docteur.png', '3', 'page', '', '');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `commerce`
--
ALTER TABLE `commerce`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `commerce`
--
ALTER TABLE `commerce`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
