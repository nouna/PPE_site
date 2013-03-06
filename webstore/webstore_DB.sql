-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Lun 04 Mars 2013 à 10:31
-- Version du serveur: 5.5.24-log
-- Version de PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `webstore`
--
CREATE DATABASE `webstore` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `webstore`;

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomcat` varchar(45) NOT NULL,
  `desccat` varchar(250) NOT NULL,
  `image_cat` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=39 ;

--
-- Contenu de la table `categories`
--

INSERT INTO `categories` (`id`, `nomcat`, `desccat`, `image_cat`) VALUES
(19, 'kjihukgfdgfhjkl', 'mokjlihukjyghjhkj', '0airline-1-01-h.png'),
(20, 'lkljh', 'MLJKH', '0photoshop_brushes_by_morten_by_jaau.jpg'),
(24, 'HHKHAO', 'ljkhg', '0plane 2.jpg'),
(30, 'GIRLY', 'lkjhg', '0pixel_arrow.jpg'),
(31, 'DECO', 'lkjhghjlk', '0arrow.jpg'),
(32, 'GEEK', 'lkljkhjlkm', '0logo.png'),
(33, 'ECOLO', 'kjhghkjlk', '0Banner (2).jpg'),
(34, 'FIESTA', 'MLHKJHV', '0Ribbons.jpg'),
(35, 'CHIC', 'pokjhyg', '0Image8.png'),
(36, 'UOIYoklijk', 'JLHKJGFH', '0Image9.png');

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_cli` varchar(45) DEFAULT NULL,
  `prenom_cli` varchar(45) DEFAULT NULL,
  `email_cli` varchar(45) NOT NULL,
  `password_cli` varchar(45) NOT NULL,
  `ad1_cli` varchar(45) DEFAULT NULL,
  `ad2_cli` varchar(45) DEFAULT NULL,
  `cp_cli` varchar(45) DEFAULT NULL,
  `ville_cli` varchar(45) DEFAULT NULL,
  `date_inscription` datetime NOT NULL,
  `dernière_connexion` datetime NOT NULL,
  `sexe_cli` varchar(45) DEFAULT NULL,
  `annee_naiss` year(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE IF NOT EXISTS `commande` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `etat_commande` varchar(45) NOT NULL,
  `Clients_id` int(11) NOT NULL,
  `date_commande` datetime NOT NULL,
  `etat_envoi` varchar(45) NOT NULL,
  PRIMARY KEY (`id`,`Clients_id`),
  KEY `fk_Panier_Clients1_idx` (`Clients_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` varchar(300) NOT NULL,
  `Produits_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`message`),
  KEY `fk_comment_Produits_idx` (`Produits_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `fournisseurs`
--

CREATE TABLE IF NOT EXISTS `fournisseurs` (
  `idFournisseurs` int(11) NOT NULL AUTO_INCREMENT,
  `nom_four` varchar(45) NOT NULL,
  `site_web_four` varchar(45) DEFAULT NULL,
  `ad_four` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idFournisseurs`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Produits_id` int(11) NOT NULL,
  `FILE_NAME` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `FILE_SIZE` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `FILE_TYPE` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_images_Produits1_idx` (`Produits_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=229 ;

--
-- Contenu de la table `images`
--

INSERT INTO `images` (`id`, `Produits_id`, `FILE_NAME`, `FILE_SIZE`, `FILE_TYPE`) VALUES
(145, 104, '0afr1.jpg', '57234', 'image/jpeg'),
(146, 104, '1afr2.jpg', '75247', 'image/jpeg'),
(147, 104, '2camion3.jpg', '9960', 'image/jpeg'),
(157, 108, '0traffic.jpg', '113867', 'image/jpeg'),
(158, 108, '1volvoC30.jpg', '211657', 'image/jpeg'),
(163, 111, '0camion4.jpg', '45648', 'image/jpeg'),
(164, 111, '1camion5.jpg', '75247', 'image/jpeg'),
(170, 116, '0camion6.jpg', '25313', 'image/jpeg'),
(173, 119, '0camion_man.jpg', '114151', 'image/jpeg'),
(177, 122, '0afr1.jpg', '57234', 'image/jpeg'),
(178, 122, '1afr2.jpg', '75247', 'image/jpeg'),
(179, 122, '2brousse_voiture2.jpg', '20351', 'image/jpeg'),
(180, 123, '0camion_man2.jpg', '66054', 'image/jpeg'),
(184, 127, '0brousse_voiture2.jpg', '20351', 'image/jpeg'),
(185, 127, '1camion_man.jpg', '114151', 'image/jpeg'),
(186, 127, '2camion_man2.jpg', '66054', 'image/jpeg'),
(187, 127, '3camion3.jpg', '9960', 'image/jpeg'),
(216, 136, '0Banner (1).jpg', '1754816', 'image/jpeg'),
(217, 137, '0Banner (4).jpg', '1740861', 'image/jpeg'),
(219, 139, '0Banner (3).jpg', '1170539', 'image/jpeg'),
(220, 140, '0sakura_lake_wallpaper.jpg', '462425', 'image/jpeg'),
(221, 140, '1tumblr_m7a12cSZm41raezz2o1_500.png', '209850', 'image/png'),
(222, 140, '2tumblr_m74q9t9z0C1qdm0pgo1_500 (1).jpg', '51241', 'image/jpeg'),
(226, 142, '0Image8.png', '679982', 'image/png'),
(227, 142, '1Image9.png', '513388', 'image/png'),
(228, 142, '2Image10.png', '437966', 'image/png');

-- --------------------------------------------------------

--
-- Structure de la table `inventaire`
--

CREATE TABLE IF NOT EXISTS `inventaire` (
  `idInventaire` int(11) NOT NULL,
  PRIMARY KEY (`idInventaire`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `inventaire_vers_produits`
--

CREATE TABLE IF NOT EXISTS `inventaire_vers_produits` (
  `Inventaire_idInventaire` int(11) NOT NULL,
  `Produits_id` int(11) NOT NULL,
  PRIMARY KEY (`Inventaire_idInventaire`,`Produits_id`),
  KEY `fk_Inventaire_has_Produits_Produits1_idx` (`Produits_id`),
  KEY `fk_Inventaire_has_Produits_Inventaire1_idx` (`Inventaire_idInventaire`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `ligne_commande`
--

CREATE TABLE IF NOT EXISTS `ligne_commande` (
  `Produits_id` int(11) NOT NULL AUTO_INCREMENT,
  `Commande_id` int(11) NOT NULL,
  `Commande_Clients_id` int(11) NOT NULL,
  `qte_produit` int(11) NOT NULL,
  PRIMARY KEY (`Produits_id`,`Commande_id`,`Commande_Clients_id`),
  KEY `fk_Produits_has_Commande_Commande1_idx` (`Commande_id`,`Commande_Clients_id`),
  KEY `fk_Produits_has_Commande_Produits1_idx` (`Produits_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `notation`
--

CREATE TABLE IF NOT EXISTS `notation` (
  `id` int(11) NOT NULL,
  `valeur` int(11) NOT NULL,
  `Produits_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Notation_Produits1_idx` (`Produits_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `offres`
--

CREATE TABLE IF NOT EXISTS `offres` (
  `idOffres` int(11) NOT NULL,
  `date_debut` datetime DEFAULT NULL,
  `date_fin` datetime DEFAULT NULL,
  `Produits_id` int(11) NOT NULL,
  PRIMARY KEY (`idOffres`),
  KEY `fk_Offres_Produits1_idx` (`Produits_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `panier_vers_produit`
--

CREATE TABLE IF NOT EXISTS `panier_vers_produit` (
  `Produits_id` int(11) NOT NULL,
  `Panier_id` int(11) NOT NULL,
  PRIMARY KEY (`Produits_id`,`Panier_id`),
  KEY `fk_panier_vers_produit_Panier1_idx` (`Panier_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

CREATE TABLE IF NOT EXISTS `produits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomproduit` varchar(45) NOT NULL,
  `titreproduit` varchar(45) NOT NULL,
  `description_produit` varchar(250) NOT NULL,
  `cree_le` datetime DEFAULT NULL,
  `modifie_le` datetime DEFAULT NULL,
  `prixproduit` decimal(16,2) NOT NULL,
  `petite_description` varchar(120) DEFAULT NULL,
  `quantite` int(11) NOT NULL,
  `poids_produit` decimal(16,3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=143 ;

--
-- Contenu de la table `produits`
--

INSERT INTO `produits` (`id`, `nomproduit`, `titreproduit`, `description_produit`, `cree_le`, `modifie_le`, `prixproduit`, `petite_description`, `quantite`, `poids_produit`) VALUES
(104, 'ITEM 7', 'JLH', 'LJHKGV', '2013-02-28 11:24:24', '2013-02-28 11:24:24', '87.00', 'HLJM', 990, '998.000'),
(108, 'ITEM 2', 'OMKJ', 'KMKJ', '2013-02-28 11:35:51', '2013-02-28 11:35:51', '98.00', 'LJM', 90, '9.000'),
(111, 'ITEM 9', 'KLJ', 'LKJJMJ', '2013-02-28 11:38:49', '2013-02-28 11:38:49', '98.00', 'LLJM', 987, '86.000'),
(116, 'ITEM TEST MIDI', 'KJLH', 'MOJH', '2013-02-28 12:05:31', '2013-02-28 12:05:31', '98.00', 'JLHK', 98, '80.000'),
(119, 'IHLHLjlh', 'LHKBGV', 'LJKH', '2013-02-28 12:08:37', '2013-02-28 12:08:37', '98.00', 'LKJH', 98, '98.000'),
(122, 'BESTUIIA', 'MKJLH', 'KMJLKHG', '2013-02-28 12:16:39', '2013-02-28 12:16:39', '90876.00', 'MLKJH', 5678, '76.000'),
(123, 'TEST 122', 'BOUIAAAÂ²KMJ?KLNJBÂ²', 'MJLHKJH', '2013-02-28 12:17:10', '2013-02-28 12:17:10', '98.00', 'JLKH', 908, '8.000'),
(127, 'CRAYO', 'DKJDF', 'JLHFDK', '2013-02-28 14:09:47', '2013-02-28 14:09:47', '98.00', 'JLIHKJ', 98, '657.000'),
(136, 'TEST', 'lkljkh', 'lmkjbhj', '2013-02-28 16:40:16', '2013-02-28 16:40:16', '98.00', 'lk,njbh,n', 67, '54.000'),
(137, 'TEST_multiple', 'pkojhkj', 'lknjbh', '2013-02-28 16:40:55', '2013-02-28 16:40:55', '98.00', 'lmkjbh', 976, '989.000'),
(139, 'kjlh', 'kjlkbh', 'kljlknbjkh', '2013-03-01 08:15:26', '2013-03-01 08:15:26', '8.00', ',kn;jb,', 809, '8098.000'),
(140, 'Stylo BIC', 'stylo magique geek glitters', 'kljhb', '2013-03-01 08:19:26', '2013-03-01 08:19:26', '98.00', 'kljnb', 98, '980.000'),
(142, 'pkojlihkugjKMJLKH', 'OJLIHKUGMKOJ', 'LIHMOLIHKUG', '2013-03-04 08:34:14', '2013-03-04 08:34:14', '98.00', 'MOLIHKUG', 98, '8.000');

-- --------------------------------------------------------

--
-- Structure de la table `produits_has_fournisseurs`
--

CREATE TABLE IF NOT EXISTS `produits_has_fournisseurs` (
  `Produits_id` int(11) NOT NULL,
  `Fournisseurs_idFournisseurs` int(11) NOT NULL,
  PRIMARY KEY (`Produits_id`,`Fournisseurs_idFournisseurs`),
  KEY `fk_Produits_has_Fournisseurs_Fournisseurs1_idx` (`Fournisseurs_idFournisseurs`),
  KEY `fk_Produits_has_Fournisseurs_Produits1_idx` (`Produits_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `produits_vers_cat`
--

CREATE TABLE IF NOT EXISTS `produits_vers_cat` (
  `Produits_id` int(11) NOT NULL,
  `categories_id` int(11) NOT NULL,
  PRIMARY KEY (`Produits_id`,`categories_id`),
  KEY `fk_produits_vers_cat_Produits1_idx` (`Produits_id`),
  KEY `fk_produits_vers_cat_categories1_idx` (`categories_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `produits_vers_cat`
--

INSERT INTO `produits_vers_cat` (`Produits_id`, `categories_id`) VALUES
(136, 34),
(137, 30),
(137, 33),
(139, 30),
(140, 30),
(140, 32),
(140, 34),
(142, 30),
(142, 32);

-- --------------------------------------------------------

--
-- Structure de la table `statut`
--

CREATE TABLE IF NOT EXISTS `statut` (
  `idstatut` int(11) NOT NULL,
  `nom_stat` varchar(45) NOT NULL,
  PRIMARY KEY (`idstatut`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `fk_Panier_Clients1` FOREIGN KEY (`Clients_id`) REFERENCES `clients` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `fk_comment_Produits` FOREIGN KEY (`Produits_id`) REFERENCES `produits` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `fk_images_Produits1` FOREIGN KEY (`Produits_id`) REFERENCES `produits` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `inventaire_vers_produits`
--
ALTER TABLE `inventaire_vers_produits`
  ADD CONSTRAINT `fk_Inventaire_has_Produits_Inventaire1` FOREIGN KEY (`Inventaire_idInventaire`) REFERENCES `inventaire` (`idInventaire`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Inventaire_has_Produits_Produits1` FOREIGN KEY (`Produits_id`) REFERENCES `produits` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `ligne_commande`
--
ALTER TABLE `ligne_commande`
  ADD CONSTRAINT `fk_Produits_has_Commande_Commande1` FOREIGN KEY (`Commande_id`, `Commande_Clients_id`) REFERENCES `commande` (`id`, `Clients_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Produits_has_Commande_Produits1` FOREIGN KEY (`Produits_id`) REFERENCES `produits` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `notation`
--
ALTER TABLE `notation`
  ADD CONSTRAINT `fk_Notation_Produits1` FOREIGN KEY (`Produits_id`) REFERENCES `produits` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `offres`
--
ALTER TABLE `offres`
  ADD CONSTRAINT `fk_Offres_Produits1` FOREIGN KEY (`Produits_id`) REFERENCES `produits` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `panier_vers_produit`
--
ALTER TABLE `panier_vers_produit`
  ADD CONSTRAINT `fk_panier_vers_produit_Panier1` FOREIGN KEY (`Panier_id`) REFERENCES `commande` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_panier_vers_produit_Produits1` FOREIGN KEY (`Produits_id`) REFERENCES `produits` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `produits_has_fournisseurs`
--
ALTER TABLE `produits_has_fournisseurs`
  ADD CONSTRAINT `fk_Produits_has_Fournisseurs_Fournisseurs1` FOREIGN KEY (`Fournisseurs_idFournisseurs`) REFERENCES `fournisseurs` (`idFournisseurs`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Produits_has_Fournisseurs_Produits1` FOREIGN KEY (`Produits_id`) REFERENCES `produits` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `produits_vers_cat`
--
ALTER TABLE `produits_vers_cat`
  ADD CONSTRAINT `fk_produits_vers_cat_categories1` FOREIGN KEY (`categories_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_produits_vers_cat_Produits1` FOREIGN KEY (`Produits_id`) REFERENCES `produits` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
