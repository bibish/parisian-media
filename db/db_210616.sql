-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mar 21 Juin 2016 à 16:18
-- Version du serveur :  5.5.42
-- Version de PHP :  7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `ParisianInsider`
--
CREATE DATABASE IF NOT EXISTS `ParisianInsider` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `ParisianInsider`;

-- --------------------------------------------------------

--
-- Structure de la table `content`
--

DROP TABLE IF EXISTS `content`;
CREATE TABLE `content` (
  `id` int(10) unsigned NOT NULL,
  `texte` text NOT NULL,
  `category` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `content`
--

INSERT INTO `content` (`id`, `texte`, `category`) VALUES
(1, 'kikoo', 'concept'),
(6, 'fffff', 'contact'),
(7, 'coucou', 'podcast'),
(8, 'salut', 'insider'),
(9, 'hey', 'truc');

-- --------------------------------------------------------

--
-- Structure de la table `insider`
--

DROP TABLE IF EXISTS `insider`;
CREATE TABLE `insider` (
  `id` int(10) unsigned NOT NULL,
  `titre` varchar(200) NOT NULL,
  `son_titre` varchar(200) NOT NULL,
  `sous_titre` text NOT NULL,
  `image` varchar(50) DEFAULT NULL,
  `son` varchar(50) NOT NULL,
  `text_before` text NOT NULL,
  `x` varchar(100) DEFAULT NULL,
  `y` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `text_after` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `insider`
--

INSERT INTO `insider` (`id`, `titre`, `son_titre`, `sous_titre`, `image`, `son`, `text_before`, `x`, `y`, `created_at`, `updated_at`, `text_after`) VALUES
(8, 'Insider N°24', 'Marie, 25ans nous parle d''une rencontre atypique', 'Semaine du 18 mais 2016', 'insider-8-1466518164.jpeg', 'insider-8-1466515805.mp3', '  blablablablablaba', 'cc', 'cc', '2016-06-21 13:30:05', '2016-06-21 14:09:24', 'blablabalbalbalbalba');

-- --------------------------------------------------------

--
-- Structure de la table `links`
--

DROP TABLE IF EXISTS `links`;
CREATE TABLE `links` (
  `id` int(10) unsigned NOT NULL,
  `category` varchar(30) NOT NULL,
  `url` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `podcast`
--

DROP TABLE IF EXISTS `podcast`;
CREATE TABLE `podcast` (
  `id` int(10) unsigned NOT NULL,
  `son` varchar(50) NOT NULL,
  `titre` varchar(200) NOT NULL,
  `sous_titre` varchar(200) NOT NULL,
  `texte` text NOT NULL,
  `personnes` text NOT NULL,
  `x` varchar(100) NOT NULL,
  `y` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `son_titre` varchar(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `podcast`
--

INSERT INTO `podcast` (`id`, `son`, `titre`, `sous_titre`, `texte`, `personnes`, `x`, `y`, `created_at`, `updated_at`, `son_titre`) VALUES
(12, 'podcast-12-1466516946.mp3', 'episode 3', 'blabla', 'blabla', '', 'blabla', 'blabla', '2016-06-21 13:49:06', '2016-06-21 13:49:06', 'blabla');

-- --------------------------------------------------------

--
-- Structure de la table `truck`
--

DROP TABLE IF EXISTS `truck`;
CREATE TABLE `truck` (
  `id` int(10) unsigned NOT NULL,
  `titre` varchar(200) NOT NULL,
  `texte` text NOT NULL,
  `image` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `truck`
--

INSERT INTO `truck` (`id`, `titre`, `texte`, `image`, `created_at`, `updated_at`) VALUES
(18, 'Boite de sardines', 'blablablablablablablablablabablablablablablablablablablabablablablablablablablablablabablablablablablablablablablabablablablablablablablablablabablablablablablablablablablabablablablablablablablablablabablablablablablablablablablabablablablablablablablablablabablablablablablablablablablabablablablablablablablablablabablablablablablablablablablabablablablablablablablablablabablablablablablablablablablabablablablablablablablablablaba', 'truc-18-1466518083.jpg', '2016-06-21 14:08:03', '2016-06-21 14:08:03');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL,
  `user` varchar(20) NOT NULL,
  `password` varchar(250) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `user`, `password`, `created_at`, `updated_at`) VALUES
(1, 'test1', '6ed4c7bcb4cbcc578c2239dfabba2c4730711da7b3dbbf884728d1473d5ef37a675eae9600261e09b4e60c0cee1c874aa346727421cfb7042546e2ef2caab9af', '2016-06-13 13:55:44', '0000-00-00 00:00:00');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `content`
--
ALTER TABLE `content`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `insider`
--
ALTER TABLE `insider`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `links`
--
ALTER TABLE `links`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `podcast`
--
ALTER TABLE `podcast`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `truck`
--
ALTER TABLE `truck`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `content`
--
ALTER TABLE `content`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pour la table `insider`
--
ALTER TABLE `insider`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `links`
--
ALTER TABLE `links`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `podcast`
--
ALTER TABLE `podcast`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT pour la table `truck`
--
ALTER TABLE `truck`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;