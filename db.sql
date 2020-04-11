-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Sam 11 Avril 2020 à 10:23
-- Version du serveur :  5.7.28-0ubuntu0.18.04.4
-- Version de PHP :  7.2.24-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `projetsr03`
--

-- --------------------------------------------------------

--
-- Structure de la table `email`
--

CREATE TABLE `email` (
  `id` int(30) NOT NULL,
  `mail` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `email`
--

INSERT INTO `email` (`id`, `mail`) VALUES
(5, 'lacouranaelanim@gmail.com'),
(10, 'uromys1er@gmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `id_msg` int(11) NOT NULL,
  `id_user_to` int(30) NOT NULL,
  `id_user_from` int(30) NOT NULL,
  `sujet_msg` varchar(40) NOT NULL,
  `corps_msg` varchar(800) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id_user` int(30) NOT NULL,
  `login` varchar(20) NOT NULL,
  `profil_user` varchar(40) NOT NULL,
  `nom` varchar(40) NOT NULL,
  `prenom` varchar(40) NOT NULL,
  `numero_compte` int(20) NOT NULL,
  `solde_compte` int(40) NOT NULL,
  `mot_de_passe` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id_user`, `login`, `profil_user`, `nom`, `prenom`, `numero_compte`, `solde_compte`, `mot_de_passe`) VALUES
(5, 'lacouran', 'client', 'jean', 'dupont', 3567, 2000, '$2y$10$QpnuczLlu7DSCNa7/N277u7u8jI8v2GnepKJ..1Wo6RKv4V3douiy'),
(7, 'alex', 'client', 'alex', 'Veise', 6776, 900, '$2y$10$aR7SSwUuc3yQKJHrmjtPPegjytnSBorBhp0q5m3IHFZYvwAh.pwTi'),
(10, 'admin', 'employe', 'flo', 'vlad', 999, 998, '$2y$10$m.0iphFwToWw0G0PNJQW.e29plfqGeOWy6An4OatDOu9xf/Kz0aFu');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `email`
--
ALTER TABLE `email`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id_msg`),
  ADD KEY `fk_id_user` (`id_user_to`),
  ADD KEY `user2` (`id_user_from`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `id_msg` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `email`
--
ALTER TABLE `email`
  ADD CONSTRAINT `id_user_email` FOREIGN KEY (`id`) REFERENCES `users` (`id_user`);

--
-- Contraintes pour la table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `fk_id_user` FOREIGN KEY (`id_user_to`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `user2` FOREIGN KEY (`id_user_from`) REFERENCES `users` (`id_user`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
