-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Mer 01 Février 2017 à 12:35
-- Version du serveur :  5.7.14
-- Version de PHP :  5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `projet151`
--

-- --------------------------------------------------------

--
-- Structure de la table `t_book`
--

CREATE TABLE `t_book` (
  `id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `overview` text NOT NULL,
  `author_sex` varchar(100) NOT NULL COMMENT 'M=MALE / F=FEMALE',
  `author_name` varchar(100) NOT NULL,
  `author_fname` varchar(100) NOT NULL,
  `year` int(4) NOT NULL COMMENT 'YYYY',
  `price` decimal(11,2) NOT NULL COMMENT 'en CHF',
  `img_cover` varchar(1000) NOT NULL COMMENT 'image location path',
  `edition` varchar(100) NOT NULL,
  `logistic_qnt` int(11) NOT NULL COMMENT 'état unités en stock',
  `FK_genre` int(11) NOT NULL,
  `creation_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'INSERT datetime',
  `modif_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'UPDATE datetime',
  `deleted` int(1) NOT NULL DEFAULT '0' COMMENT '0=visible / 1=invisible'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `t_book`
--

INSERT INTO `t_book` (`id`, `title`, `overview`, `author_sex`, `author_name`, `author_fname`, `year`, `price`, `img_cover`, `edition`, `logistic_qnt`, `FK_genre`, `creation_date`, `modif_date`, `deleted`) VALUES
(1, 'Une brève histoire du temps', 'overview', 'M', 'David', 'Miranda', 2014, '35.00', 'dsdasdsadasd', 'edition', 1, 1, '2017-01-24 14:16:40', '2017-01-24 14:16:40', 0),
(2, 'Navigation d\'Ulysse', 'overview', 'M', 'David', 'Miranda', 2014, '4.50', 'dsdasdsadasd', 'edition', 13, 1, '2017-01-24 14:16:40', '2017-01-24 14:16:40', 0),
(3, 'Feu Mathias Pascal', 'overview', 'M', 'David', 'Miranda', 2014, '15.00', 'dsdasdsadasd', 'edition', 14, 1, '2017-01-24 14:16:40', '2017-01-24 14:16:40', 0),
(4, 'Fumée rouge', 'overview', 'M', 'David', 'Miranda', 2014, '61.00', 'dsdasdsadasd', 'edition', 15, 1, '2017-01-24 14:16:40', '2017-01-24 14:16:40', 0),
(5, 'Voyage au bout de la nuit', 'overview', 'M', 'David', 'Miranda', 2014, '60.50', 'dsdasdsadasd', 'edition', 15, 1, '2017-01-24 14:16:40', '2017-01-24 14:16:40', 0),
(6, 'Le guide Marabout du Judo', 'overview', 'M', 'David', 'Miranda', 2014, '17.50', 'dsdasdsadasd', 'edition', 15, 2, '2017-01-24 14:16:40', '2017-01-24 14:16:40', 0),
(7, 'Métapsychologie', 'overview', 'M', 'David', 'Miranda', 2014, '4.50', 'dsdasdsadasd', 'edition', 15, 1, '2017-01-24 14:16:40', '2017-01-24 14:16:40', 0),
(8, 'Se', 'overview', 'M', 'David', 'Miranda', 2014, '71.00', 'dsdasdsadasd', 'edition', 15, 2, '2017-01-24 14:16:40', '2017-01-24 14:16:40', 0),
(9, 'Tolérance zéro', 'overview', 'M', 'David', 'Miranda', 2014, '40.00', 'dsdasdsadasd', 'edition', 15, 1, '2017-01-24 14:16:40', '2017-01-24 14:16:40', 0),
(10, 'Le meilleur des mondes', 'overview', 'M', 'David', 'Miranda', 2014, '85.50', 'dsdasdsadasd', 'edition', 15, 1, '2017-01-24 14:16:40', '2017-01-24 14:16:40', 0),
(11, 'Bel-Ami', 'overview', 'M', 'David', 'Miranda', 2014, '8.00', 'dsdasdsadasd', 'edition', 15, 1, '2017-01-24 14:16:40', '2017-01-24 14:16:40', 0),
(12, 'Les oreilles rouges', 'overview', 'M', 'David', 'Miranda', 2014, '82.00', 'dsdasdsadasd', 'edition', 15, 1, '2017-01-24 14:16:40', '2017-01-24 14:16:40', 0),
(13, 'La chute', 'overview', 'M', 'David', 'Miranda', 2014, '86.00', 'dsdasdsadasd', 'edition', 15, 1, '2017-01-24 14:16:40', '2017-01-24 14:16:40', 0),
(14, 'Français-Allemand', 'overview', 'M', 'David', 'Miranda', 2014, '82.50', 'dsdasdsadasd', 'edition', 15, 2, '2017-01-24 14:16:40', '2017-01-24 14:16:40', 0),
(15, 'Alex', 'overview', 'M', 'David', 'Miranda', 2014, '53.00', 'dsdasdsadasd', 'edition', 15, 1, '2017-01-24 14:16:40', '2017-01-24 14:16:40', 0),
(16, 'The joy luck club', 'overview', 'M', 'David', 'Miranda', 2014, '17.50', 'dsdasdsadasd', 'edition', 15, 1, '2017-01-24 14:16:40', '2017-01-24 14:16:40', 0),
(17, 'Le cœur conscient', 'overview', 'M', 'David', 'Miranda', 2014, '27.50', 'dsdasdsadasd', 'edition', 15, 1, '2017-01-24 14:16:40', '2017-01-24 14:16:40', 0),
(18, 'La part du vent', 'overview', 'M', 'David', 'Miranda', 2014, '84.50', 'dsdasdsadasd', 'edition', 15, 1, '2017-01-24 14:16:40', '2017-01-24 14:16:40', 0),
(19, 'Jonathan Livingston Seagull', 'overview', 'M', 'David', 'Miranda', 2014, '39.00', 'dsdasdsadasd', 'edition', 15, 1, '2017-01-24 14:16:40', '2017-01-24 14:16:40', 0),
(20, 'Educating Rita', 'overview', 'M', 'David', 'Miranda', 2014, '40.50', 'dsdasdsadasd', 'edition', 15, 1, '2017-01-24 14:16:40', '2017-01-24 14:16:40', 0),
(21, 'Lies of silence', 'overview', 'M', 'David', 'Miranda', 2014, '85.00', 'dsdasdsadasd', 'edition', 15, 1, '2017-01-24 14:16:40', '2017-01-24 14:16:40', 0),
(22, 'Nuits d\'enfer', 'overview', 'M', 'David', 'Miranda', 2014, '3.50', 'dsdasdsadasd', 'edition', 15, 1, '2017-01-24 14:16:40', '2017-01-24 14:16:40', 0),
(23, 'Enemies', 'overview', 'M', 'David', 'Miranda', 2014, '60.00', 'dsdasdsadasd', 'edition', 15, 1, '2017-01-24 14:16:40', '2017-01-24 14:16:40', 0),
(24, 'Maria, fille de Flandre', 'overview', 'M', 'David', 'Miranda', 2014, '90.50', 'dsdasdsadasd', 'edition', 15, 1, '2017-01-24 14:16:40', '2017-01-24 14:16:40', 0),
(25, 'Aphrodite', 'overview', 'M', 'David', 'Miranda', 2014, '70.00', 'dsdasdsadasd', 'edition', 15, 1, '2017-01-24 14:16:40', '2017-01-24 14:16:40', 0),
(26, 'Le pot au noir', 'overview', 'M', 'David', 'Miranda', 2014, '79.50', 'dsdasdsadasd', 'edition', 15, 1, '2017-01-24 14:16:40', '2017-01-24 14:16:40', 0),
(27, 'Le grand Meaulnes', 'overview', 'M', 'David', 'Miranda', 2014, '86.50', 'dsdasdsadasd', 'edition', 15, 1, '2017-01-24 14:16:40', '2017-01-24 14:16:40', 0),
(28, 'Corps et âmes', 'overview', 'M', 'David', 'Miranda', 2014, '92.00', 'dsdasdsadasd', 'edition', 15, 1, '2017-01-24 14:16:40', '2017-01-24 14:16:40', 0),
(29, 'La Bible', 'overview', 'M', 'David', 'Miranda', 2014, '100.00', 'dsdasdsadasd', 'edition', 15, 1, '2017-01-24 14:16:40', '2017-01-24 14:16:40', 0),
(30, 'La crevasse des maquisards', 'overview', 'M', 'David', 'Miranda', 2014, '23.50', 'dsdasdsadasd', 'edition', 15, 1, '2017-01-24 14:16:40', '2017-01-24 14:16:40', 0),
(31, 'Tristan et Iseult', 'overview', 'M', 'David', 'Miranda', 2014, '17.50', 'dsdasdsadasd', 'edition', 15, 1, '2017-01-24 14:16:40', '2017-01-24 14:16:40', 0),
(32, 'Le gambit des étoiles', 'overview', 'M', 'David', 'Miranda', 2014, '17.00', 'dsdasdsadasd', 'edition', 15, 1, '2017-01-24 14:16:40', '2017-01-24 14:16:40', 0),
(33, 'Stamps & stories', 'overview', 'M', 'David', 'Miranda', 2014, '30.00', 'dsdasdsadasd', 'edition', 15, 2, '2017-01-24 14:16:40', '2017-01-24 14:16:40', 0),
(34, 'Skinwalkers', 'overview', 'M', 'David', 'Miranda', 2014, '98.50', 'dsdasdsadasd', 'edition', 15, 1, '2017-01-24 14:16:40', '2017-01-24 14:16:40', 0),
(35, 'The Christmas books', 'overview', 'M', 'David', 'Miranda', 2014, '2.00', 'dsdasdsadasd', 'edition', 15, 1, '2017-01-24 14:16:40', '2017-01-24 14:16:40', 0),
(36, 'A Christmas Carol', 'overview', 'M', 'David', 'Miranda', 2014, '14.50', 'dsdasdsadasd', 'edition', 15, 1, '2017-01-24 14:16:40', '2017-01-24 14:16:40', 0),
(37, 'La dixième prophétie', 'overview', 'M', 'David', 'Miranda', 2014, '66.00', 'dsdasdsadasd', 'edition', 15, 1, '2017-01-24 14:16:40', '2017-01-24 14:16:40', 0),
(38, 'L\'homme qui rétrécit', 'overview', 'M', 'David', 'Miranda', 2014, '85.50', 'dsdasdsadasd', 'edition', 15, 1, '2017-01-24 14:16:40', '2017-01-24 14:16:40', 0),
(39, 'Histoires extraordinaires', 'overview', 'M', 'David', 'Miranda', 2014, '29.00', 'dsdasdsadasd', 'edition', 15, 1, '2017-01-24 14:16:40', '2017-01-24 14:16:40', 0),
(40, 'Nouvelles histoires extraordinaires', 'overview', 'M', 'David', 'Miranda', 2014, '88.50', 'dsdasdsadasd', 'edition', 15, 1, '2017-01-24 14:16:40', '2017-01-24 14:16:40', 0),
(41, 'La pureté dangereuse', 'overview', 'M', 'David', 'Miranda', 2014, '53.00', 'dsdasdsadasd', 'edition', 15, 1, '2017-01-24 14:16:40', '2017-01-24 14:16:40', 0),
(42, 'Zazie dans le métro', 'overview', 'M', 'David', 'Miranda', 2014, '100.00', 'dsdasdsadasd', 'edition', 15, 1, '2017-01-24 14:16:40', '2017-01-24 14:16:40', 0),
(43, 'La visite de la vieille dame', 'overview', 'M', 'David', 'Miranda', 2014, '40.50', 'dsdasdsadasd', 'edition', 15, 1, '2017-01-24 14:16:40', '2017-01-24 14:16:40', 0),
(44, 'Le Colonel Chabert', 'overview', 'M', 'David', 'Miranda', 2014, '2.00', 'dsdasdsadasd', 'edition', 15, 1, '2017-01-24 14:16:40', '2017-01-24 14:16:40', 0),
(45, 'Phèdre', 'overview', 'M', 'David', 'Miranda', 2014, '87.50', 'dsdasdsadasd', 'edition', 15, 1, '2017-01-24 14:16:40', '2017-01-24 14:16:40', 0);

-- --------------------------------------------------------

--
-- Structure de la table `t_comment`
--

CREATE TABLE `t_comment` (
  `id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `user` int(11) NOT NULL,
  `status` int(1) NOT NULL COMMENT '0=à valider, 1=validé',
  `FK_book` int(11) NOT NULL,
  `creation_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'INSERT datetime',
  `validation_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'VALIDATION datetime',
  `deleted` int(1) NOT NULL DEFAULT '0' COMMENT '0=visible / 1=invisible'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `t_comment`
--

INSERT INTO `t_comment` (`id`, `comment`, `user`, `status`, `FK_book`, `creation_date`, `validation_date`, `deleted`) VALUES
(1, 'qwegwetgwjegnkwejgnwkejgnkwgnkwejrg', 1, 0, 1, '2017-01-24 16:07:00', '2017-01-24 16:07:00', 0);

-- --------------------------------------------------------

--
-- Structure de la table `t_genre`
--

CREATE TABLE `t_genre` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `creation_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'INSERT datetime',
  `deleted` int(1) NOT NULL DEFAULT '0' COMMENT '0=visible / 1=invisible'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `t_genre`
--

INSERT INTO `t_genre` (`id`, `name`, `creation_date`, `deleted`) VALUES
(1, 'Dictionnaire', '2017-01-24 14:16:39', 0),
(2, 'Magazine', '2017-01-24 14:16:39', 0),
(3, 'Roman & Fictions', '2017-01-24 14:16:39', 0),
(4, 'Bande Dessinée & Mangas', '2017-01-24 14:16:39', 0),
(5, 'Manuel scolaire', '2017-01-24 14:16:39', 0),
(6, 'Essai', '2017-01-24 14:16:39', 0),
(7, 'Polar', '2017-01-24 14:16:39', 0),
(8, 'Autre', '2017-01-24 14:16:39', 0),
(9, 'Religions, spiritualité', '2017-01-24 14:16:39', 0),
(10, 'Humour', '2017-01-24 14:16:39', 0),
(11, 'Fantastique', '2017-01-24 14:16:39', 0),
(12, 'Théâtre', '2017-01-24 14:16:39', 0),
(13, 'Nouvelle', '2017-01-24 14:16:39', 0),
(14, 'Horreur', '2017-01-24 14:16:39', 0),
(15, 'Science-fiction', '2017-01-24 14:16:39', 0),
(16, 'Poésie', '2017-01-24 14:16:39', 0),
(17, 'dont vous êtes le héro', '2017-01-24 14:16:39', 0),
(18, 'Extraits', '2017-01-24 14:16:39', 0),
(19, 'Recueil de planches', '2017-01-24 14:16:39', 0),
(20, 'Atlas', '2017-01-24 14:16:39', 0),
(21, 'Brochure', '2017-01-24 14:16:39', 0),
(22, 'Documents & Sciences', '2017-01-24 14:16:39', 0),
(23, 'Mode d\'emploi', '2017-01-24 14:16:39', 0),
(24, 'Cuisine', '2017-01-24 14:16:39', 0),
(25, 'Polycopié', '2017-01-24 14:16:39', 0),
(26, 'Manuel', '2017-01-24 14:16:39', 0),
(27, 'Revue', '2017-01-24 14:16:39', 0),
(28, 'Abécédaire', '2017-01-24 14:16:39', 0),
(29, 'Biographie', '2017-01-24 14:16:39', 0),
(30, 'Annuaire', '2017-01-24 14:16:39', 0),
(31, 'Esotérisme', '2017-01-24 14:16:39', 0),
(32, 'Lexique', '2017-01-24 14:16:39', 0),
(33, 'Loisirs', '2017-01-24 14:16:39', 0),
(34, 'Sport', '2017-01-24 14:16:39', 0);

-- --------------------------------------------------------

--
-- Structure de la table `t_order`
--

CREATE TABLE `t_order` (
  `id` int(11) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'INSERT datetime',
  `user` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `total_price` decimal(11,2) NOT NULL COMMENT 'en CHF',
  `deleted` int(1) NOT NULL DEFAULT '0' COMMENT '0=visible / 1=invisible',
  `bookqnt` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `t_order`
--

INSERT INTO `t_order` (`id`, `order_date`, `user`, `status`, `total_price`, `deleted`, `bookqnt`) VALUES
(1, '2017-01-30 15:16:29', 0, 0, '0.00', 1, '0'),
(2, '2017-01-30 15:27:46', 1, 0, '220.50', 0, 'a:4:{i:0;a:2:{s:2:"id";s:1:"1";s:6:"amount";i:4;}i:1;a:2:{s:2:"id";s:1:"2";s:6:"amount";i:1;}i:2;a:2:{s:2:"id";s:1:"3";s:6:"amount";i:1;}i:3;a:2:{s:2:"id";s:1:"4";s:6:"amount";i:1;}}'),
(3, '2017-01-30 15:28:54', 1, 0, '220.50', 0, 'a:4:{i:0;a:2:{s:2:"id";s:1:"1";s:6:"amount";i:4;}i:1;a:2:{s:2:"id";s:1:"2";s:6:"amount";i:1;}i:2;a:2:{s:2:"id";s:1:"3";s:6:"amount";i:1;}i:3;a:2:{s:2:"id";s:1:"4";s:6:"amount";i:1;}}'),
(4, '2017-01-31 09:20:53', 1, 0, '35.00', 0, 'a:1:{i:0;a:2:{s:2:"id";s:1:"1";s:6:"amount";i:1;}}'),
(5, '2017-02-01 11:54:48', 1, 0, '35.00', 0, 'a:1:{i:0;a:2:{s:2:"id";s:1:"1";s:6:"amount";i:1;}}'),
(6, '2017-02-01 12:00:33', 1, 0, '9.00', 0, 'a:1:{i:0;a:2:{s:2:"id";s:1:"2";s:6:"amount";i:2;}}'),
(7, '2017-02-01 12:56:35', 1, 0, '15.00', 0, 'a:1:{i:0;a:2:{s:2:"id";s:1:"3";s:6:"amount";i:1;}}');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `t_book`
--
ALTER TABLE `t_book`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_genre` (`FK_genre`);

--
-- Index pour la table `t_comment`
--
ALTER TABLE `t_comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_book` (`FK_book`);

--
-- Index pour la table `t_genre`
--
ALTER TABLE `t_genre`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `t_order`
--
ALTER TABLE `t_order`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `t_book`
--
ALTER TABLE `t_book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT pour la table `t_comment`
--
ALTER TABLE `t_comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `t_genre`
--
ALTER TABLE `t_genre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT pour la table `t_order`
--
ALTER TABLE `t_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `t_book`
--
ALTER TABLE `t_book`
  ADD CONSTRAINT `t_book_ibfk_1` FOREIGN KEY (`FK_genre`) REFERENCES `t_genre` (`id`);

--
-- Contraintes pour la table `t_comment`
--
ALTER TABLE `t_comment`
  ADD CONSTRAINT `t_comment_ibfk_1` FOREIGN KEY (`FK_book`) REFERENCES `t_book` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
