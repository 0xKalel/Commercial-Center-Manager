-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Lun 09 Mars 2015 à 11:40
-- Version du serveur: 5.5.8
-- Version de PHP: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `gestion_locaux`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `nom` varchar(100) COLLATE hp8_bin NOT NULL,
  `mot_de_passe` varchar(100) COLLATE hp8_bin NOT NULL,
  `type` varchar(10) COLLATE hp8_bin NOT NULL,
  UNIQUE KEY `nom` (`nom`)
) ENGINE=InnoDB DEFAULT CHARSET=hp8 COLLATE=hp8_bin;

--
-- Contenu de la table `admin`
--

INSERT INTO `admin` (`nom`, `mot_de_passe`, `type`) VALUES
('badou', 'badou', 'principal'),
('hamada', 'hamada', 'pricipal'),
('hamid', 'hamid', 'principal'),
('khalil', 'khalil', 'assistant'),
('monder', 'monder', 'assistant');

-- --------------------------------------------------------

--
-- Structure de la table `contrats`
--

CREATE TABLE IF NOT EXISTS `contrats` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `local` int(255) NOT NULL,
  `locataire` int(255) NOT NULL,
  `date` varchar(10) COLLATE hp8_bin NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `montant` int(200) NOT NULL,
  `autre_declaration` int(100) DEFAULT NULL,
  `fichier` varchar(250) COLLATE hp8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=hp8 COLLATE=hp8_bin AUTO_INCREMENT=151 ;

--
-- Contenu de la table `contrats`
--

INSERT INTO `contrats` (`id`, `local`, `locataire`, `date`, `date_debut`, `date_fin`, `montant`, `autre_declaration`, `fichier`) VALUES
(1, 1, 1, '', '2012-01-01', '2013-01-01', 120000, 120000, ''),
(3, 3, 3, '', '2013-01-12', '2014-09-12', 200000, 230000, ''),
(4, 4, 4, '', '2013-06-19', '2015-06-19', 240000, 240000, ''),
(6, 6, 6, '', '2011-01-01', '2013-01-01', 240000, 240000, ''),
(7, 6, 7, '', '2015-01-01', '2017-01-01', 240000, 240000, ''),
(52, 1, 18, '', '2014-10-01', '2015-05-01', 2000, 2300, ''),
(124, 2, 4, '', '2015-02-01', '2016-02-01', 123, 21, ''),
(125, 2, 4, '', '2015-02-01', '2016-02-01', 123, 21, ''),
(126, 2, 4, '', '2015-02-01', '2016-02-01', 123, 21, 'elements/documents/contrats/126/1423745469document0.jpg'),
(127, 1, 1, '', '2015-02-01', '2015-03-01', 1234, 0, 'elements/documents/contrats/127/1423745266document0.jpg'),
(128, 6, 5, '', '2015-02-01', '2016-02-01', 12, 212, 'elements/documents/contrats/128/1423745218document0.jpg'),
(129, 1, 1, '', '2015-02-01', '2016-02-01', 123, 0, 'elements/documents/contrats/129/1423745106document0.jpg'),
(130, 1, 1, '', '2015-02-01', '2016-02-01', 123, 0, 'elements/documents/contrats/130/1423744959document0.jpg'),
(131, 1, 1, '', '2015-02-01', '2016-02-01', 123, 0, 'elements/documents/contrats/131/1423744989document0.jpg'),
(132, 1, 1, '', '2015-02-01', '2016-02-01', 123, 0, 'elements/documents/contrats/132/1423743957document0.jpg'),
(133, 1, 1, '', '2015-02-01', '2016-02-01', 123, 0, 'elements/documents/contrats/133/1423743006document0.jpg'),
(134, 1, 1, '', '2015-02-01', '2016-02-01', 123, 0, 'elements/documents/contrats/134/1423740406document0.jpg'),
(135, 1, 1, '', '2015-02-01', '2016-02-01', 123, 0, 'elements/documents/contrats/135/1423746637document0.jpg'),
(136, 1, 1, '', '2015-02-01', '2016-02-01', 123, 0, 'elements/documents/contrats/136/1423734955document0.jpg'),
(138, 1, 1, '', '2015-02-01', '2016-02-01', 123, 0, 'elements/documents/contrats/138/1423483072document0.png'),
(139, 1, 1, '', '2015-02-01', '2016-02-01', 123, 0, 'elements/documents/contrats/139/1424591767document0.jpg'),
(141, 1, 1, '', '2015-02-01', '2016-02-01', 18000, 0, 'elements/documents/contrats/141/1423740099document0.png'),
(142, 3, 1, '', '2015-02-23', '2016-02-23', 1234, 232, ''),
(143, 3, 1, '', '2015-02-23', '2016-02-23', 1234, 232, ''),
(144, 1, 1, '', '2015-02-23', '2016-02-23', 22222, 0, ''),
(145, 1, 1, '', '2015-02-23', '2016-02-23', 144234, 0, ''),
(146, 1, 1, '23/2/2015', '2015-02-23', '2016-02-23', 144234, 0, 'elements/documents/contrats/146/1425202531document0.jpg'),
(147, 1, 2, '23/2/2015', '2015-02-23', '2016-02-23', 1234, 0, ''),
(148, 1, 0, '23/2/2015', '2015-02-23', '2016-02-23', 0, 0, ''),
(149, 1, 0, '8/3/2015', '2015-03-08', '2016-03-08', 123, 22, ''),
(150, 1, 0, '8/3/2015', '2015-03-08', '2016-03-08', 123, 22, '');

-- --------------------------------------------------------

--
-- Structure de la table `locataires`
--

CREATE TABLE IF NOT EXISTS `locataires` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) CHARACTER SET utf8 NOT NULL,
  `tel` varchar(20) CHARACTER SET hp8 COLLATE hp8_bin DEFAULT '',
  `mobile` varchar(20) CHARACTER SET hp8 COLLATE hp8_bin DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=ascii COLLATE=ascii_bin AUTO_INCREMENT=42 ;

--
-- Contenu de la table `locataires`
--

INSERT INTO `locataires` (`id`, `nom`, `tel`, `mobile`) VALUES
(1, 'FASTLINER', '038540000', '0777889900'),
(2, 'تباني أمير بن ناجي', '038524198', '0798653214'),
(3, 'DATA DISTRUBUSTION', '', ''),
(4, 'Nom', '06', '06'),
(5, 'monder', '06', '06'),
(6, 'as2', 'as', 'ads'),
(7, 'as', 'as', 'as'),
(13, 'as', 'as', 'as'),
(14, 'sdg', 'seg', 'drh'),
(15, 'ljhj', '34541', '65454'),
(16, 'ljhj2', '34541', '65454'),
(17, 'a', 'as', 'as'),
(18, 'akh', 'as', 'as'),
(19, 'asas', 'asas', 'asas'),
(20, 'jh', 'jh', 'jh'),
(21, 'zd', 'zd', 'zd'),
(22, 'rf', 'rf', 'rf'),
(23, 'ev', 'ev', 'evf'),
(24, 'fb', 'tg', 'th'),
(25, 'hamada', 'hamada', 'hamada'),
(26, 'mou7', 'mou7', 'mou7'),
(27, 'mondersky', 'monderskuy', 'fb'),
(28, 'mondersky', 'jkb', 'khj'),
(29, 'mondersky', '999', '999'),
(30, 'hg', 'hg', 'hg'),
(32, 'hg', 'db', 'ib'),
(33, 'po', 'po', 'po'),
(35, 'pop', 'po', 'po'),
(37, 'lllllllll', 'llllll', 'llll'),
(38, 'llll', 'lll', 'lll'),
(39, 'lk', 'lk', 'lk'),
(40, 'pll', 'plo', 'plo'),
(41, 'pikjh', '34', '4654');

-- --------------------------------------------------------

--
-- Structure de la table `locaux`
--

CREATE TABLE IF NOT EXISTS `locaux` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(100) DEFAULT NULL,
  `etage` int(2) NOT NULL,
  `description` varchar(1000) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `longueur` double NOT NULL,
  `largeur` double NOT NULL,
  `surface` double NOT NULL,
  `width` int(100) NOT NULL,
  `height` int(100) NOT NULL,
  `top` int(100) NOT NULL,
  `gauche` varchar(100) NOT NULL,
  `z_index` int(100) NOT NULL,
  `top_desc` int(100) NOT NULL,
  `left_desc` int(100) NOT NULL,
  `font_size` int(100) NOT NULL,
  `display_desc` varchar(50) NOT NULL DEFAULT 'block',
  `type` varchar(10) NOT NULL DEFAULT 'local',
  `lefts` varchar(12) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=137 ;

--
-- Contenu de la table `locaux`
--

INSERT INTO `locaux` (`id`, `libelle`, `etage`, `description`, `longueur`, `largeur`, `surface`, `width`, `height`, `top`, `gauche`, `z_index`, `top_desc`, `left_desc`, `font_size`, `display_desc`, `type`, `lefts`) VALUES
(1, 'Local N°1', 1, 'Arrière local', 10.1, 8.1, 81.7, 105, 90, 194, '18', 2, 15, 10, 16, 'block', 'local', ''),
(2, 'B7', 1, 'Local', 9.9, 4.8, 47, 45, 112, 288, '18', 2, 35, 2, 11, 'block', 'local', ''),
(3, 'B6', 1, 'Local', 9.8, 5.2, 34.9, 56, 112, 288, '67', 2, 25, 2, 14, 'block', 'local', ''),
(4, 'B8', 1, 'nnnnnn', 5.5, 2.7, 14.9, 64, 30, 288, '127', 2, 0, 10, 8, 'block', 'local', ''),
(5, 'B8', 1, 'Local', 7.1, 5.5, 34.9, 64, 78, 322, '127', 2, 10, 17, 12, 'block', 'local', ''),
(6, 'Magasin n°1', 1, 'Local', 9.1, 6.5, 59, 70, 103, 15, '164', 2, 20, 5, 16, 'block', 'local', ''),
(7, 'Magasin n°2', 1, 'Local', 9.1, 4.3, 39, 47, 103, 15, '238', 2, 25, 1, 12, 'block', 'local', ''),
(8, 'Magasin n°3', 1, 'Local', 9.1, 4.8, 43.7, 56, 103, 15, '289', 2, 25, 2, 14, 'block', 'local', ''),
(9, 'B4', 1, 'Bureau', 4, 3, 12, 50, 35, 15, '349', 2, 0, 10, 10, 'block', 'bureau', ''),
(10, 'b3', 1, 'Bureau', 3, 3, 9, 42, 45, 54, '349', 2, 1, 2, 11, 'block', 'bureau', ''),
(11, 'dddddddd', 1, 'Bureau', 10, 10, 100, 230, 103, 15, '349', 1, 20, 110, 16, 'block', 'bureau', ''),
(12, 'B5', 1, 'Local commercial', 24.8, 22.6, 440.6, 251, 278, 122, '127', 1, 105, 70, 16, 'block', 'local', ''),
(13, 'dddd', 1, 'dede', 17.5, 12.4, 191.3, 197, 125, 122, '382', 2, 30, 40, 16, 'block', 'local', ''),
(14, 'test', 1, 'Local commercial', 20.1, 15.5, 273.3, 197, 149, 251, '382', 2, 40, 40, 16, 'block', 'local', ''),
(15, NULL, 1, 'Local commercial', 10, 10, 100, 33, 103, 15, '127', 2, 230, 30, 16, 'none', 'local', ''),
(126, 'hichem', 2, '', 0, 0, 0, 159, 141, 15, '420', 2, 0, 0, 13, 'block', 'local', ''),
(127, 'bureau 2', 2, '', 0, 0, 0, 177, 100, 17, '233', 2, 0, 0, 13, 'block', 'local', ''),
(128, 'Nouveau local', 3, '', 0, 0, 0, 157, 170, 15, '422', 2, 0, 0, 13, 'block', 'local', ''),
(129, 'test', 2, 'jezekkb zefkjbzef', 1231, 123123, 221, 312, 105, 162, '85', 2, 0, 0, 13, 'block', 'local', ''),
(130, 'Nouveau local', 2, '', 122, 111, 0, 100, 100, 302, '479', 2, 0, 0, 13, 'block', 'local', ''),
(131, 'Nouveau local', 2, '', 0, 0, 0, 100, 100, 302, '158', 2, 0, 0, 13, 'block', 'local', ''),
(132, 'mawaki3', 3, '', 100, 20, 220, 391, 163, 19, '127', 2, 0, 0, 13, 'block', 'bureau', ''),
(133, 'Nouveau local', 1, '', 0, 0, 0, 100, 100, 126, '273', 2, 0, 0, 13, 'block', 'local', ''),
(134, 'Nouveau local', 2, '', 0, 0, 0, 204, 102, 19, '19', 2, 0, 0, 13, 'block', 'local', ''),
(135, 'bureau detude', 3, '', 0, 0, 0, 431, 100, 302, '19', 2, 0, 0, 13, 'block', 'local', ''),
(136, 'Nouveau local', 3, '', 0, 0, 0, 100, 100, 302, '479', 2, 0, 0, 13, 'block', 'local', '');

-- --------------------------------------------------------

--
-- Structure de la table `options`
--

CREATE TABLE IF NOT EXISTS `options` (
  `etage` varchar(10) NOT NULL,
  `nbr` int(4) NOT NULL,
  `color1` varchar(7) NOT NULL,
  `color2` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `options`
--

INSERT INTO `options` (`etage`, `nbr`, `color1`, `color2`) VALUES
('RDC', 6, '#1C2BFF', '#3CFF2E');

-- --------------------------------------------------------

--
-- Structure de la table `paiement`
--

CREATE TABLE IF NOT EXISTS `paiement` (
  `contrat` int(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=hp8 COLLATE=hp8_bin;

--
-- Contenu de la table `paiement`
--

INSERT INTO `paiement` (`contrat`, `date`) VALUES
(1, '2013-01-01'),
(2, '2015-01-01'),
(3, '2014-05-12'),
(4, '2014-01-19'),
(4, '2014-05-19'),
(6, '2013-01-01'),
(8, '2014-01-01');

-- --------------------------------------------------------

--
-- Structure de la table `proforma`
--

CREATE TABLE IF NOT EXISTS `proforma` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `local` int(255) NOT NULL,
  `locataire` varchar(255) COLLATE hp8_bin NOT NULL,
  `date` varchar(10) COLLATE hp8_bin NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `montant` int(200) NOT NULL,
  `autre_declaration` int(100) DEFAULT NULL,
  `fichier` varchar(250) COLLATE hp8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=hp8 COLLATE=hp8_bin AUTO_INCREMENT=5 ;

--
-- Contenu de la table `proforma`
--

INSERT INTO `proforma` (`id`, `local`, `locataire`, `date`, `date_debut`, `date_fin`, `montant`, `autre_declaration`, `fichier`) VALUES
(1, 1, 'test', '8/3/2015', '2015-03-08', '2016-03-08', 123, 22, ''),
(2, 1, 'monder', '8/3/2015', '2015-03-08', '2016-03-08', 123, 222, ''),
(3, 1, '123', '8/3/2015', '2015-03-08', '2016-03-08', 123, 123, ''),
(4, 1, 'monzd', '8/3/2015', '2015-03-08', '2017-03-08', 123, 123, '');
