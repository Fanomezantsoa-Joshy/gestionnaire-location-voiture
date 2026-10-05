-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 24 juin 2026 à 02:23
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

START TRANSACTION;

SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */
;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */
;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */
;
/*!40101 SET NAMES utf8mb4 */
;

--
-- Base de données : `location_voiture`
--

CREATE DATABASE `location_voiture`;

USE `location_voiture`;

-- --------------------------------------------------------

--
-- Structure de la table `location`
--

CREATE TABLE `location` (
    `num_loc` varchar(10) NOT NULL,
    `nom_loc` varchar(50) NOT NULL,
    `design_voiture` varchar(20) NOT NULL,
    `nombre_jours` int(11) NOT NULL,
    `taux_journalier` int(11) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--
-- Déchargement des données de la table `location`
--

INSERT INTO
    `location` (
        `num_loc`,
        `nom_loc`,
        `design_voiture`,
        `nombre_jours`,
        `taux_journalier`
    )
VALUES (
        'LOC-001',
        'Joshy',
        'Ferrari',
        3,
        500000
    ),
    (
        'LOC-002',
        'José',
        'BMW',
        2,
        450000
    ),
    (
        'LOC-003',
        'Paul',
        'Starex',
        4,
        300000
    ),
    (
        'LOC-004',
        'Rabe',
        'Ferrari',
        3,
        500000
    ),
    (
        'LOC-005',
        'Jean',
        'Peugeot 308',
        4,
        200000
    ),
    (
        'LOC-006',
        'Rasoa',
        'Audi A4',
        5,
        300000
    ),
    (
        'LOC-007',
        'Soa',
        'Renault',
        5,
        200000
    ),
    (
        'LOC-008',
        'Jacqueline',
        'Hyundai',
        4,
        250000
    ),
    (
        'LOC-009',
        'Pierre',
        'Mercedes',
        3,
        400000
    );

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
    `nom` varchar(50) NOT NULL,
    `prenoms` varchar(50) NOT NULL,
    `Date_naissance` date NOT NULL,
    `email` varchar(50) NOT NULL,
    `nom_utilisateur` varchar(50) DEFAULT NULL,
    `mdp` varchar(10) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO
    `utilisateur` (
        `nom`,
        `prenoms`,
        `Date_naissance`,
        `email`,
        `nom_utilisateur`,
        `mdp`
    )
VALUES (
        'RAKOTOARINIRINA',
        'Fanomezantsoa Joshy',
        '2000-01-01',
        'joshyfanomezantsoa3@gmail.com',
        'Admin',
        'motdepasse'
    );

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
ADD UNIQUE KEY `nom_utilisateur` (`nom_utilisateur`);

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */
;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */
;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */
;