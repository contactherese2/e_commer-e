-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 05 mai 2026 à 14:26
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `commerce`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id_cat` smallint(3) NOT NULL,
  `nom_cat` varchar(35) NOT NULL,
  `description_cat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id_cat`, `nom_cat`, `description_cat`) VALUES
(1, 'AESTHETIQUE', 'Produits destinés à améliorer l\'apparence physique,entretenir la peau et valoriser le bien etre'),
(2, ' SOINS CAPILLAIRE', 'Pro)duits destinés à l\'entretien,la protection et l\'embeillisement des cheveux'),
(3, 'DECORATION INTERIEUR', 'Produit destinés à embellir et aménager les espaces intérieurs');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `id_cmd` smallint(3) NOT NULL,
  `id_u` smallint(3) NOT NULL,
  `total_cmd` int(15) NOT NULL,
  `statut_cmd` enum('attente','valide') DEFAULT 'attente',
  `adresse_cmd` varchar(35) NOT NULL,
  `create_cmd` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `detail_commande`
--

CREATE TABLE `detail_commande` (
  `id_det` smallint(3) NOT NULL,
  `id_p` smallint(3) NOT NULL,
  `id_cmd` smallint(3) NOT NULL,
  `quantite_det` int(10) NOT NULL,
  `prix_unit` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

CREATE TABLE `panier` (
  `id_pa` smallint(3) NOT NULL,
  `quantite_pa` smallint(15) NOT NULL,
  `id_u` smallint(3) NOT NULL,
  `id_p` smallint(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

CREATE TABLE `produits` (
  `id_p` smallint(3) NOT NULL,
  `nom_p` varchar(35) NOT NULL,
  `description_p` text NOT NULL,
  `prix_p` int(15) NOT NULL,
  `stock_p` int(15) NOT NULL,
  `image` text NOT NULL,
  `id_cat` smallint(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id_p`, `nom_p`, `description_p`, `prix_p`, `stock_p`, `image`, `id_cat`) VALUES
(5, 'yugtrefd', 'uy(hrgtsxq', 556000, 22, 'WhatsApp Image 2026-04-20 at 15.24.09.jpeg', 1);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id_u` smallint(3) NOT NULL,
  `email_u` varchar(35) NOT NULL,
  `password_u` varchar(20) NOT NULL,
  `role` enum('client','admin') DEFAULT 'client',
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `nom_u` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id_u`, `email_u`, `password_u`, `role`, `create_at`, `nom_u`) VALUES
(1, 'rachid@gmail.com', 'rere', 'client', '2026-04-25 15:34:59', 'rachide'),
(2, 'rachid@gmail.com', 'rere', 'client', '2026-04-25 15:41:06', 'rachide'),
(3, 'brouhanoudine2@gmail.com', '0000', 'client', '2026-04-25 15:43:21', 'brouhane');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_cat`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id_cmd`),
  ADD KEY `fk3` (`id_u`);

--
-- Index pour la table `detail_commande`
--
ALTER TABLE `detail_commande`
  ADD PRIMARY KEY (`id_det`),
  ADD KEY `fk4` (`id_p`),
  ADD KEY `fk5` (`id_cmd`);

--
-- Index pour la table `panier`
--
ALTER TABLE `panier`
  ADD PRIMARY KEY (`id_pa`),
  ADD KEY `fk1` (`id_u`),
  ADD KEY `fk2` (`id_p`);

--
-- Index pour la table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`id_p`),
  ADD KEY `fk` (`id_cat`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_u`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id_cat` smallint(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `id_cmd` smallint(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `detail_commande`
--
ALTER TABLE `detail_commande`
  MODIFY `id_det` smallint(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `panier`
--
ALTER TABLE `panier`
  MODIFY `id_pa` smallint(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `produits`
--
ALTER TABLE `produits`
  MODIFY `id_p` smallint(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id_u` smallint(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `fk3` FOREIGN KEY (`id_u`) REFERENCES `user` (`id_u`);

--
-- Contraintes pour la table `detail_commande`
--
ALTER TABLE `detail_commande`
  ADD CONSTRAINT `fk4` FOREIGN KEY (`id_p`) REFERENCES `produits` (`id_p`),
  ADD CONSTRAINT `fk5` FOREIGN KEY (`id_cmd`) REFERENCES `commande` (`id_cmd`);

--
-- Contraintes pour la table `panier`
--
ALTER TABLE `panier`
  ADD CONSTRAINT `fk1` FOREIGN KEY (`id_u`) REFERENCES `user` (`id_u`),
  ADD CONSTRAINT `fk2` FOREIGN KEY (`id_p`) REFERENCES `produits` (`id_p`);

--
-- Contraintes pour la table `produits`
--
ALTER TABLE `produits`
  ADD CONSTRAINT `fk` FOREIGN KEY (`id_cat`) REFERENCES `categories` (`id_cat`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
