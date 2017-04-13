-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Mar 21 Mars 2017 à 13:58
-- Version du serveur :  10.1.21-MariaDB
-- Version de PHP :  7.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `projects_manag_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `actiondisciplinaires`
--

CREATE TABLE `actiondisciplinaires` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` mediumtext COLLATE utf8_unicode_ci,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_type` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified_type` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `assoc_clients_projects`
--

CREATE TABLE `assoc_clients_projects` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `assoc_clients_projects`
--

INSERT INTO `assoc_clients_projects` (`id`, `client_id`, `project_id`) VALUES
(1, 2, 7),
(2, 3, 7),
(3, 7, 7),
(4, 9, 7),
(5, 9, 8),
(6, 9, 10),
(7, 9, 11);

-- --------------------------------------------------------

--
-- Structure de la table `assoc_companies_members`
--

CREATE TABLE `assoc_companies_members` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `accessLevel` int(11) DEFAULT '0',
  `companyManager` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `assoc_companies_users`
--

CREATE TABLE `assoc_companies_users` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `accessLevel` int(11) DEFAULT '0',
  `companyManager` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `assoc_companies_users`
--

INSERT INTO `assoc_companies_users` (`id`, `user_id`, `company_id`, `accessLevel`, `companyManager`) VALUES
(1, 10, 6, 5, 1);

-- --------------------------------------------------------

--
-- Structure de la table `assoc_departements_criterions`
--

CREATE TABLE `assoc_departements_criterions` (
  `id` int(11) NOT NULL,
  `departement_id` int(11) NOT NULL,
  `criterion_id` int(11) NOT NULL,
  `content` mediumtext COLLATE utf8_unicode_ci,
  `percent` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `assoc_departements_criterions`
--

INSERT INTO `assoc_departements_criterions` (`id`, `departement_id`, `criterion_id`, `content`, `percent`) VALUES
(1, 9, 5, '', 50),
(2, 10, 5, '', 25);

-- --------------------------------------------------------

--
-- Structure de la table `assoc_departements_members`
--

CREATE TABLE `assoc_departements_members` (
  `id` int(11) NOT NULL,
  `departement_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `accessLevel` int(11) DEFAULT '0',
  `departementManager` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `assoc_departements_users`
--

CREATE TABLE `assoc_departements_users` (
  `id` int(11) NOT NULL,
  `departement_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `accessLevel` int(11) DEFAULT '0',
  `departementManager` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `assoc_members_projects`
--

CREATE TABLE `assoc_members_projects` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `projectManager` int(11) DEFAULT '0',
  `accessLevel` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `assoc_projects_criterions`
--

CREATE TABLE `assoc_projects_criterions` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `criterion_id` int(11) NOT NULL,
  `content` tinytext COLLATE utf8_unicode_ci,
  `percent` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `assoc_projects_teams`
--

CREATE TABLE `assoc_projects_teams` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `assoc_projects_teams`
--

INSERT INTO `assoc_projects_teams` (`id`, `project_id`, `team_id`) VALUES
(6, 3, 14),
(8, 5, 14),
(9, 5, 15),
(10, 5, 16),
(11, 6, 14),
(12, 6, 15),
(13, 6, 16),
(14, 6, 17),
(15, 8, 18),
(16, 7, 14),
(17, 9, 20),
(18, 10, 22),
(19, 11, 22),
(20, 11, 23),
(21, 11, 24),
(22, 11, 14),
(23, 11, 15);

-- --------------------------------------------------------

--
-- Structure de la table `assoc_teams_criterions`
--

CREATE TABLE `assoc_teams_criterions` (
  `id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `criterion_id` int(11) NOT NULL,
  `content` mediumtext COLLATE utf8_unicode_ci,
  `percent` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `assoc_teams_criterions`
--

INSERT INTO `assoc_teams_criterions` (`id`, `team_id`, `criterion_id`, `content`, `percent`) VALUES
(1, 15, 4, '', 50);

-- --------------------------------------------------------

--
-- Structure de la table `assoc_teams_members`
--

CREATE TABLE `assoc_teams_members` (
  `id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `accessLevel` int(11) DEFAULT '0',
  `teamManager` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `assoc_teams_users`
--

CREATE TABLE `assoc_teams_users` (
  `id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `accessLevel` int(11) DEFAULT '3',
  `teamManager` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `assoc_teams_users`
--

INSERT INTO `assoc_teams_users` (`id`, `team_id`, `user_id`, `accessLevel`, `teamManager`) VALUES
(11, 17, 6, 3, 0),
(14, 14, 8, 3, 0),
(15, 15, 8, 3, 0),
(18, 16, 7, 3, 0),
(19, 18, 2, 3, 0),
(20, 19, 1, 3, 1),
(29, 15, 9, 3, 0),
(30, 18, 1, 3, 0),
(31, 20, 3, 3, 0),
(32, 20, 4, 3, 0),
(33, 20, 1, 1, 0),
(34, 20, 1, 1, 0),
(36, 22, 2, 3, 0),
(40, 23, 2, 3, 0),
(41, 23, 3, 3, 0),
(42, 24, 2, 3, 0),
(43, 24, 3, 3, 0),
(45, 22, 11, 3, 0),
(47, 14, 12, 3, 0),
(48, 23, 12, 3, 0),
(49, 24, 12, 3, 0),
(50, 21, 10, 3, 0),
(51, 21, 11, 3, 0),
(52, 23, 11, 3, 0),
(53, 24, 11, 3, 0);

-- --------------------------------------------------------

--
-- Structure de la table `assoc_users_actiondisciplinaires`
--

CREATE TABLE `assoc_users_actiondisciplinaires` (
  `id` int(11) NOT NULL,
  `actiondisciplinaire_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `assoc_users_criterions`
--

CREATE TABLE `assoc_users_criterions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `criterion_id` int(11) NOT NULL,
  `content` tinytext COLLATE utf8_unicode_ci,
  `percent` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `assoc_users_criterions`
--

INSERT INTO `assoc_users_criterions` (`id`, `user_id`, `criterion_id`, `content`, `percent`) VALUES
(1, 1, 6, 'aaaaaaa', 7),
(2, 1, 7, 'aaaaaaaaa', 7),
(3, 10, 6, '', 0),
(4, 10, 7, '', 0);

-- --------------------------------------------------------

--
-- Structure de la table `assoc_users_projects`
--

CREATE TABLE `assoc_users_projects` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `time_dedicated` int(11) DEFAULT NULL,
  `projectManager` int(11) DEFAULT '0',
  `accessLevel` int(11) DEFAULT '3'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `assoc_users_projects`
--

INSERT INTO `assoc_users_projects` (`id`, `user_id`, `project_id`, `time_dedicated`, `projectManager`, `accessLevel`) VALUES
(73, 1, 5, 80, 0, 5),
(74, 2, 5, 30, 1, 2),
(75, 4, 5, 20, 0, 2),
(76, 1, 6, 80, 0, 3),
(77, 2, 6, 20, 0, 2),
(78, 4, 6, 60, 0, 2),
(79, 5, 6, 0, 0, 2),
(80, 6, 6, 10, 0, 2),
(81, 7, 6, 50, 0, 2),
(82, 8, 6, 30, 1, 2),
(90, 8, 7, NULL, 0, 2),
(91, 8, 3, 80, 0, 2),
(92, 1, 8, 20, 0, 3),
(93, 2, 8, 50, 0, 2),
(97, 1, 9, NULL, 0, 1),
(98, 3, 9, NULL, 1, 3),
(99, 4, 9, NULL, 0, 0),
(100, 2, 10, NULL, 0, 3),
(101, 2, 11, NULL, 1, 3),
(102, 3, 11, NULL, 0, 3),
(103, 8, 11, NULL, 0, 3),
(104, 9, 11, NULL, 0, 3);

-- --------------------------------------------------------

--
-- Structure de la table `authentifications`
--

CREATE TABLE `authentifications` (
  `id` int(11) NOT NULL,
  `type` varchar(55) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` tinytext COLLATE utf8_unicode_ci,
  `client_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `member_id` int(11) DEFAULT NULL,
  `group_manager` int(11) DEFAULT '0',
  `clients_manager` int(11) DEFAULT '0',
  `criterions_manager` int(11) DEFAULT '0',
  `priorities_manager` int(11) DEFAULT '0',
  `projectstages_manager` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `authentifications`
--

INSERT INTO `authentifications` (`id`, `type`, `email`, `password`, `client_id`, `user_id`, `member_id`, `group_manager`, `clients_manager`, `criterions_manager`, `priorities_manager`, `projectstages_manager`) VALUES
(3, 'user', 'test@test.com', '$2y$10$Vsci5PhxjEGiqDoOrM/kxu6razvt4NVBcc6PODNHmBMlKxuvTQ836', NULL, NULL, NULL, 0, 0, 0, 0, 0),
(4, 'user', 'test54@test.com', '$2y$10$VknuSU0H.9LwelFoadwt8e1S9Esh38krrfZCacCWkdF2qaPweaoXW', NULL, NULL, NULL, 0, 0, 0, 0, 0),
(6, 'member', 'superadmin@superadmin.com', '$2y$10$VAS8YUW0KnYoC1gCYCepPOLeXnDeAZIP.25446NOCPhKuD/WvqIxO', NULL, NULL, 1, 1, 0, 0, 0, 0),
(7, 'client', 'test1@test.com1', '$2y$10$o7/TacxO9J4LPHo.L.IGge1wLknAid.9xfcIXkwN.MgXJTLiwY9C.', 7, NULL, NULL, 0, 0, 0, 0, 0),
(8, 'client', 'mdr@mdr.mdr', '$2y$10$CiyOspMQItQ2Kiw0.G/TEOEHyNoYmHeu.j67Syl/P63QlEdyHPdjG', 9, NULL, NULL, 0, 0, 0, 0, 0),
(9, 'user', 'ziedhaffoudhi@gmail.com', '$2y$10$VU.7AM.91mU.VucVgJsEaO/jT0pmO4AUjBsuPSpYWDKEGID7ItFgi', NULL, 1, NULL, 0, 1, 1, 1, 1),
(10, 'user', 'test001@test.com', '$2y$10$b8qrnLNdCOl5wZEmT1iKvOnicX0YBNLmaRabuA6SPyp/mQ639jdhC', NULL, 2, NULL, 0, 0, 0, 0, 0),
(11, 'client', 'test001111@test.com', '$2y$10$CNGDpXCgeEs/5zs1pdVsqeoPEaIsDGRGQ5.NG5VBi4l6m1ze2bWue', 2, NULL, NULL, 0, 0, 0, 0, 0),
(12, 'client', 'test001111@test.tn', '$2y$10$ZFyNYbgVLxezMIY05CJhhetyeDrI03Uyud4lQcbHYqpMy0CA3EMUa', 3, NULL, NULL, 0, 0, 0, 0, 0),
(13, 'user', 'sdfsfd@dfsdf.com', '$2y$10$/s/Yn00F20mhDfNc2RB6E.YitebTXqY39BYPWq8rNUSVnrDeG.zv6', NULL, 3, NULL, 0, 0, 0, 0, 0),
(14, 'member', 'dali@gmail.com', '$2y$10$b0k7uu7lg0SFoUsk1RZoq.N9GuMigRD4mszJw4b5kJGmve2lkW0AO', NULL, NULL, 2, 0, 1, 1, 0, 1),
(15, 'user', 'test@gmail.com', '$2y$10$spuVygX6elhvbb.7ZW9heOtZyshxYTD5AYTWfGvuhKGltxXiuStHC', NULL, 9, NULL, 0, 1, 1, 1, 0),
(16, 'user', 'autre1@autre.fr', '$2y$10$9GQprXfwRgbh0zrXMfFSxehPiG1FFWOUxXyCgBJfMj9qivZPHThA6', NULL, 4, NULL, 0, 1, 1, 1, 1),
(17, 'user', 'mouwafek@gmail.com', '$2y$10$VZ4h72MtDeNkcivesg.T4O6TUY2NSPLm6JbtS7oUiTSXbbHyVj/8a', NULL, 10, NULL, 0, 0, 0, 0, 0),
(18, 'user', 'test@test.com5555', '$2y$10$SSt36a2GQYJ47lM401NJSOsTeupxH7bDGl5Uas.1wfvOqzP9KIKcu', NULL, 11, NULL, 0, 0, 0, 0, 0),
(19, 'user', 'test@test.com2222', '$2y$10$ElWuKznR23XEViNYXPIPGuQFGP5XYkD9qbVwHA2.gE6n9tpvhGaJG', NULL, 12, NULL, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lastName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` mediumtext COLLATE utf8_unicode_ci,
  `path_image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_type` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified_type` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `clients`
--

INSERT INTO `clients` (`id`, `name`, `lastName`, `description`, `path_image`, `created`, `modified`, `created_by`, `modified_by`, `created_type`, `modified_type`) VALUES
(2, 'qsqsdqsd', 'qsdqdsqds', 'qsdqds', '', '2016-12-27 12:51:56', '2017-01-25 09:16:11', NULL, NULL, NULL, NULL),
(3, 'azeazaezzaezae', 'azeaez', '', '', '2016-12-29 10:32:09', '2017-01-25 09:26:22', NULL, NULL, NULL, NULL),
(7, 'test', 'test', 'test', '', '2017-01-24 14:29:25', '2017-01-24 15:32:01', NULL, NULL, NULL, NULL),
(9, 'mdr', 'mdr', 'mdr', '', '2017-01-24 16:07:40', '2017-01-24 16:07:40', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `companies`
--

CREATE TABLE `companies` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `adresse` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` mediumtext COLLATE utf8_unicode_ci,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_type` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified_type` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `companies`
--

INSERT INTO `companies` (`id`, `name`, `email`, `adresse`, `description`, `created`, `modified`, `created_by`, `modified_by`, `created_type`, `modified_type`) VALUES
(1, 'Khidma', 'khidma@contact.tn', '1001 Rue de liberté, Tunis, Tunisie', 'Company for doing nothing test', '2017-02-18 15:28:50', '2017-02-28 12:08:51', NULL, NULL, NULL, NULL),
(4, 'Universal', '', '', '', '2017-02-28 12:17:15', '2017-02-28 12:17:15', NULL, NULL, NULL, NULL),
(5, 'Swift', 'test@test.com', '', '', '2017-03-06 14:32:10', '2017-03-06 14:32:10', NULL, NULL, NULL, NULL),
(6, 'Aswe9', 'aswe9@gmail.com', '', '', '2017-03-15 08:42:31', '2017-03-15 08:42:31', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `criterions`
--

CREATE TABLE `criterions` (
  `id` int(11) NOT NULL,
  `name` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(45) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `criterions`
--

INSERT INTO `criterions` (`id`, `name`, `type`) VALUES
(1, 'Indicateur 1', 'Projects'),
(2, 'Test d\'indicateur', 'Projects'),
(3, 'A Test', 'Projects'),
(4, 'test001', 'Teams'),
(5, 'test002', 'Departements'),
(6, 'test003', 'Employees'),
(7, 'test005', 'Employees');

-- --------------------------------------------------------

--
-- Structure de la table `departements`
--

CREATE TABLE `departements` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` mediumtext COLLATE utf8_unicode_ci,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_type` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified_type` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `departements`
--

INSERT INTO `departements` (`id`, `name`, `description`, `created`, `modified`, `created_by`, `modified_by`, `created_type`, `modified_type`, `company_id`) VALUES
(9, 'dep1', 'qsd', '2016-12-16 15:07:30', '2017-02-18 15:29:10', NULL, NULL, NULL, NULL, 1),
(10, 'dep2', '', '2016-12-16 15:08:17', '2017-02-18 15:29:20', NULL, NULL, NULL, NULL, 1),
(11, 'NothingDep', '', '2016-12-26 10:51:31', '2017-03-01 15:02:39', NULL, NULL, NULL, NULL, 4),
(12, 'TeamNothing', 'zaeaze', '2016-12-26 10:53:24', '2017-02-18 15:29:39', NULL, NULL, NULL, NULL, 1),
(13, 'Swift', 'Swift', '2017-03-06 14:32:34', '2017-03-06 14:32:34', NULL, NULL, NULL, NULL, 5),
(16, 'Aswe9 Dep 1', 'azeazeaze', '2017-03-15 11:09:10', '2017-03-15 11:09:10', NULL, NULL, NULL, NULL, 6),
(17, 'Aswek Dep 2', 'aze', '2017-03-16 13:47:32', '2017-03-16 13:47:32', NULL, NULL, NULL, NULL, 6);

-- --------------------------------------------------------

--
-- Structure de la table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` mediumtext COLLATE utf8_unicode_ci,
  `path_image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_type` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified_type` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `members`
--

INSERT INTO `members` (`id`, `name`, `lastName`, `description`, `path_image`, `created`, `modified`, `created_by`, `modified_by`, `created_type`, `modified_type`) VALUES
(1, 'super', 'admin', '', '', '2017-01-23 15:25:00', '2017-01-23 15:25:00', NULL, NULL, NULL, NULL),
(2, 'Dali', 'Test', '', '', '2017-02-23 09:57:28', '2017-03-11 08:44:13', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `priorities`
--

CREATE TABLE `priorities` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `order_priority` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `priorities`
--

INSERT INTO `priorities` (`id`, `name`, `order_priority`) VALUES
(1, 'Faible', 1),
(2, 'Moyen', 2),
(3, 'Important', 3);

-- --------------------------------------------------------

--
-- Structure de la table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `accomplishment` double DEFAULT '0',
  `description` mediumtext COLLATE utf8_unicode_ci,
  `objective` mediumtext COLLATE utf8_unicode_ci,
  `path_dir` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dateBegin` datetime DEFAULT NULL,
  `dateEnd` datetime DEFAULT NULL,
  `project_stage_id` int(11) DEFAULT NULL,
  `priority_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_type` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified_type` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `projects`
--

INSERT INTO `projects` (`id`, `name`, `accomplishment`, `description`, `objective`, `path_dir`, `dateBegin`, `dateEnd`, `project_stage_id`, `priority_id`, `created`, `modified`, `created_by`, `modified_by`, `created_type`, `modified_type`) VALUES
(3, 'projectManager', 80, 'qsdqsqs', 'dfgdg df dfg ', '3-projectmanager', '2016-12-23 08:00:00', '2016-12-23 18:00:00', 3, 2, '2016-12-23 15:24:20', '2017-02-20 14:28:03', NULL, NULL, NULL, NULL),
(5, 'AAEAEZA', 60, 'azeqsd', 'dfdfgd', NULL, '2016-12-26 08:00:00', '2016-12-26 18:00:00', 2, 3, '2016-12-26 10:36:28', '2016-12-29 10:55:37', NULL, NULL, NULL, NULL),
(6, 'TestTri', 100, 'qsqdqs  aeaze aaze ', 'qsdq qsd qds qsd', NULL, '2016-12-26 08:00:00', '2016-12-26 18:00:00', 8, 2, '2016-12-26 10:56:02', '2016-12-26 10:56:02', NULL, NULL, NULL, NULL),
(7, 'Authentification GSP', 20, 'tets', 'test', '7-authentificationgsp', '2017-01-21 08:00:00', '2017-01-25 18:00:00', 5, 3, '2017-01-25 09:28:40', '2017-03-02 14:34:02', NULL, NULL, NULL, NULL),
(8, 'Authorisation', 50, 'Desc', 'Obj', NULL, '2017-03-09 08:00:00', '2017-06-22 08:01:00', 2, 1, '2017-03-02 12:16:11', '2017-03-02 12:16:11', NULL, NULL, NULL, NULL),
(9, 'Swift Project', 45, '', '', '', NULL, NULL, 2, 1, '2017-03-06 14:33:25', '2017-03-09 08:13:11', NULL, NULL, NULL, NULL),
(10, 'Project Aswek 1', 0, '', '', '', '2017-03-16 08:00:00', '2017-03-16 18:00:00', 2, 2, '2017-03-16 16:07:41', '2017-03-16 16:08:09', NULL, NULL, NULL, NULL),
(11, 'Project Aswek 2', 27, '', '', '', '2017-03-16 08:00:00', '2017-03-16 18:00:00', 3, 1, '2017-03-16 16:09:24', '2017-03-17 08:00:31', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `project_stages`
--

CREATE TABLE `project_stages` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `order_stage` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `project_stages`
--

INSERT INTO `project_stages` (`id`, `name`, `order_stage`) VALUES
(1, 'Idée', 1),
(2, 'Étude', 2),
(3, 'Analyse des besoins', 3),
(4, 'Def Objectifs', 4),
(5, 'Construire', 5),
(6, 'Planifier', 6),
(7, 'Conduire', 7),
(8, 'Piloter', 8),
(9, 'Clôturer', 9),
(10, 'Evaluer', 10);

-- --------------------------------------------------------

--
-- Structure de la table `project_urls`
--

CREATE TABLE `project_urls` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `project_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `project_urls`
--

INSERT INTO `project_urls` (`id`, `name`, `url`, `project_id`) VALUES
(1, 'GoogleTest', 'http://www.google.tn', 6),
(2, 'ABC', 'http://www.abc.com', 6),
(3, 'Auth Test', 'http://trarara.com', 3),
(4, 'YahooFr', 'http://yahoo.fr', 7),
(6, 'Fb', 'http://www.facebook.com', 7),
(7, 'qsdqsd', 'aze', 3),
(8, 'qsdqsdaze', 'azeaze', 7),
(9, 'azer', 'azer.com', 5),
(10, 'azeaze', 'azrazrazr', 9);

-- --------------------------------------------------------

--
-- Structure de la table `rapports`
--

CREATE TABLE `rapports` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `rapport` mediumtext COLLATE utf8_unicode_ci,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `teams`
--

CREATE TABLE `teams` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` mediumtext COLLATE utf8_unicode_ci,
  `departement_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_type` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified_type` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `path_image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `teams`
--

INSERT INTO `teams` (`id`, `name`, `description`, `departement_id`, `created`, `modified`, `created_by`, `modified_by`, `created_type`, `modified_type`, `path_image`) VALUES
(14, 'eq1', 'aze', 9, '2016-12-16 15:06:40', '2017-01-04 09:16:16', NULL, NULL, NULL, NULL, ''),
(15, 'eq2', 'aze', 9, '2016-12-16 15:08:05', '2017-01-04 09:16:06', NULL, NULL, NULL, NULL, ''),
(16, 'NothingTeam', 'zrzrzer', 12, '2016-12-26 10:53:09', '2017-01-04 09:16:31', NULL, NULL, NULL, NULL, ''),
(17, 'TeamNothing', 'zaeaez', 12, '2016-12-26 10:54:07', '2017-01-04 09:16:38', NULL, NULL, NULL, NULL, ''),
(18, 'Image test', 'Test', 11, '2017-01-04 09:54:29', '2017-03-02 11:14:13', NULL, NULL, NULL, NULL, 'Sans titre.png'),
(19, 'test test', 'azeqsd', 10, '2017-01-04 10:40:42', '2017-01-04 10:44:35', NULL, NULL, NULL, NULL, 'lotus.png'),
(20, 'Swift', '', 13, '2017-03-06 14:32:52', '2017-03-08 10:27:36', NULL, NULL, NULL, NULL, '20-swift'),
(21, 'Aswek Team 1', 'fqsfqsf', 16, '2017-03-15 15:56:50', '2017-03-16 15:47:10', NULL, NULL, NULL, NULL, '21-qsdqsdqsd'),
(22, 'Aswek Team 2', 'sdf', 16, '2017-03-16 13:35:18', '2017-03-16 15:52:13', NULL, NULL, NULL, NULL, '22-sdf'),
(23, 'Aswek Team 3', 'azezea', 17, '2017-03-16 13:52:39', '2017-03-16 15:52:25', NULL, NULL, NULL, NULL, '23-azeeza'),
(24, 'Aswek Team 4', 'azesqd', 17, '2017-03-16 13:52:49', '2017-03-16 15:52:49', NULL, NULL, NULL, NULL, '24-azeqsd');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lastName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` mediumtext COLLATE utf8_unicode_ci,
  `path_image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_type` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_type` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `name`, `lastName`, `description`, `path_image`, `created`, `modified`, `created_by`, `modified_by`, `modified_type`, `created_type`) VALUES
(1, 'zied', 'Haffoudhi', 'test', '1-ziedtest', '2016-12-19 15:28:56', '2017-03-11 11:02:20', NULL, NULL, NULL, NULL),
(2, 'jamel', 'test', 'test', '2-jameltest', '2016-12-19 15:38:47', '2017-01-25 09:14:17', NULL, NULL, NULL, NULL),
(3, 'test', 'azeaz', '', '3-testazeaz', '2016-12-20 10:16:47', '2017-01-25 09:26:49', NULL, NULL, NULL, NULL),
(4, 'autre', 'autre', 'zae', '4-autreautre', '2016-12-20 14:50:58', '2017-03-11 08:34:42', NULL, NULL, NULL, NULL),
(5, 'Moez', 'Jouadi', '', '5-moezjouadi', '2016-12-26 10:49:52', '2017-01-04 15:38:58', NULL, NULL, NULL, NULL),
(6, 'Med', 'arazraz', '', '', '2016-12-26 10:53:46', '2016-12-26 10:53:46', NULL, NULL, NULL, NULL),
(7, 'Moslem', 'Paliser', '', '', '2016-12-26 10:54:39', '2016-12-26 10:54:39', NULL, NULL, NULL, NULL),
(8, 'Francois', 'Hollande', '', '', '2016-12-26 10:55:07', '2016-12-26 10:55:07', NULL, NULL, NULL, NULL),
(9, 'test', 'test', '', '9-testtest', '2017-02-24 14:42:33', '2017-02-24 14:42:33', NULL, NULL, NULL, NULL),
(10, 'Mouwafek', 'Zribi', '', '10-mouwafekzribi', '2017-03-15 08:43:34', '2017-03-17 11:01:25', NULL, NULL, NULL, NULL),
(11, 'Aswek', 'Colaborateur 1', 'azeqsd', '11-aswekcolaborateur1', '2017-03-17 10:02:49', '2017-03-17 16:00:06', NULL, NULL, NULL, NULL),
(12, 'Aswek', 'Colaborateur 2', '', '12-aswekcolaborateur2', '2017-03-17 10:03:24', '2017-03-17 10:03:24', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `user_urls`
--

CREATE TABLE `user_urls` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `actiondisciplinaires`
--
ALTER TABLE `actiondisciplinaires`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `assoc_clients_projects`
--
ALTER TABLE `assoc_clients_projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_assocCP_projects_idx` (`project_id`),
  ADD KEY `FK_assocCP_clients_idx` (`client_id`);

--
-- Index pour la table `assoc_companies_members`
--
ALTER TABLE `assoc_companies_members`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_ACU_company_idx` (`company_id`),
  ADD KEY `FK_ACM_members_idx` (`member_id`);

--
-- Index pour la table `assoc_companies_users`
--
ALTER TABLE `assoc_companies_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_ACU_users_idx` (`user_id`),
  ADD KEY `FK_ACU_company_idx` (`company_id`);

--
-- Index pour la table `assoc_departements_criterions`
--
ALTER TABLE `assoc_departements_criterions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_ADC_departements_idx` (`departement_id`),
  ADD KEY `FK_ADC_criterions_idx` (`criterion_id`);

--
-- Index pour la table `assoc_departements_members`
--
ALTER TABLE `assoc_departements_members`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_ADU_departements_idx` (`departement_id`),
  ADD KEY `FK_ADM_members_idx` (`member_id`);

--
-- Index pour la table `assoc_departements_users`
--
ALTER TABLE `assoc_departements_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_ADU_departements_idx` (`departement_id`),
  ADD KEY `FK_ADU_users_idx` (`user_id`);

--
-- Index pour la table `assoc_members_projects`
--
ALTER TABLE `assoc_members_projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_assocCP_projects_idx` (`project_id`),
  ADD KEY `FK_AMP_members_idx` (`member_id`);

--
-- Index pour la table `assoc_projects_criterions`
--
ALTER TABLE `assoc_projects_criterions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_APC_criterions_idx` (`criterion_id`),
  ADD KEY `FK_APC_projects_idx` (`project_id`);

--
-- Index pour la table `assoc_projects_teams`
--
ALTER TABLE `assoc_projects_teams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_assocPT_teams_idx` (`team_id`),
  ADD KEY `FK_assocPT_teams_idx1` (`project_id`);

--
-- Index pour la table `assoc_teams_criterions`
--
ALTER TABLE `assoc_teams_criterions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_teams_criterions_idx` (`team_id`),
  ADD KEY `FK_ATC_criterions_idx` (`criterion_id`);

--
-- Index pour la table `assoc_teams_members`
--
ALTER TABLE `assoc_teams_members`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_assocTR_teams_idx` (`team_id`),
  ADD KEY `FK_ATM_members_idx` (`member_id`);

--
-- Index pour la table `assoc_teams_users`
--
ALTER TABLE `assoc_teams_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_assocTR_teams_idx` (`team_id`),
  ADD KEY `FK_assocTR_users_idx` (`user_id`);

--
-- Index pour la table `assoc_users_actiondisciplinaires`
--
ALTER TABLE `assoc_users_actiondisciplinaires`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_assocRA_actionDisciplinaire_idx` (`actiondisciplinaire_id`),
  ADD KEY `FK_assocRA_ressources_idx` (`user_id`);

--
-- Index pour la table `assoc_users_criterions`
--
ALTER TABLE `assoc_users_criterions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_AUC_users_idx` (`user_id`),
  ADD KEY `FK_AUC_criterions_idx` (`criterion_id`);

--
-- Index pour la table `assoc_users_projects`
--
ALTER TABLE `assoc_users_projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_assocCP_projects_idx` (`project_id`),
  ADD KEY `FK_assocUP_users_idx` (`user_id`);

--
-- Index pour la table `authentifications`
--
ALTER TABLE `authentifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_authentifications_clients_idx` (`client_id`),
  ADD KEY `FK_authentifications_users_idx` (`user_id`),
  ADD KEY `FK_authentifications_members_idx` (`member_id`);

--
-- Index pour la table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `criterions`
--
ALTER TABLE `criterions`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `departements`
--
ALTER TABLE `departements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_departements_companies_idx` (`company_id`);

--
-- Index pour la table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `priorities`
--
ALTER TABLE `priorities`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_projects_ps_idx` (`project_stage_id`),
  ADD KEY `FK_projects_priorities_idx` (`priority_id`);

--
-- Index pour la table `project_stages`
--
ALTER TABLE `project_stages`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `project_urls`
--
ALTER TABLE `project_urls`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_project_urls_projects_idx` (`project_id`);

--
-- Index pour la table `rapports`
--
ALTER TABLE `rapports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_rappots_users_idx` (`user_id`);

--
-- Index pour la table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_teams_departements_idx` (`departement_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user_urls`
--
ALTER TABLE `user_urls`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_userUrls_users_idx` (`user_id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `actiondisciplinaires`
--
ALTER TABLE `actiondisciplinaires`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `assoc_clients_projects`
--
ALTER TABLE `assoc_clients_projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `assoc_companies_members`
--
ALTER TABLE `assoc_companies_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `assoc_companies_users`
--
ALTER TABLE `assoc_companies_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `assoc_departements_criterions`
--
ALTER TABLE `assoc_departements_criterions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `assoc_departements_members`
--
ALTER TABLE `assoc_departements_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `assoc_departements_users`
--
ALTER TABLE `assoc_departements_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `assoc_members_projects`
--
ALTER TABLE `assoc_members_projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `assoc_projects_criterions`
--
ALTER TABLE `assoc_projects_criterions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `assoc_projects_teams`
--
ALTER TABLE `assoc_projects_teams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT pour la table `assoc_teams_criterions`
--
ALTER TABLE `assoc_teams_criterions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `assoc_teams_members`
--
ALTER TABLE `assoc_teams_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `assoc_teams_users`
--
ALTER TABLE `assoc_teams_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT pour la table `assoc_users_actiondisciplinaires`
--
ALTER TABLE `assoc_users_actiondisciplinaires`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `assoc_users_criterions`
--
ALTER TABLE `assoc_users_criterions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `assoc_users_projects`
--
ALTER TABLE `assoc_users_projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;
--
-- AUTO_INCREMENT pour la table `authentifications`
--
ALTER TABLE `authentifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT pour la table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pour la table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `criterions`
--
ALTER TABLE `criterions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `departements`
--
ALTER TABLE `departements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT pour la table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `priorities`
--
ALTER TABLE `priorities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT pour la table `project_stages`
--
ALTER TABLE `project_stages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT pour la table `project_urls`
--
ALTER TABLE `project_urls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT pour la table `rapports`
--
ALTER TABLE `rapports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT pour la table `user_urls`
--
ALTER TABLE `user_urls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `assoc_clients_projects`
--
ALTER TABLE `assoc_clients_projects`
  ADD CONSTRAINT `FK_assocCP_clients` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_assocCP_projects` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `assoc_companies_members`
--
ALTER TABLE `assoc_companies_members`
  ADD CONSTRAINT `FK_ACM_company` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_ACM_members` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `assoc_companies_users`
--
ALTER TABLE `assoc_companies_users`
  ADD CONSTRAINT `FK_ACU_company` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_ACU_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `assoc_departements_criterions`
--
ALTER TABLE `assoc_departements_criterions`
  ADD CONSTRAINT `FK_ADC_criterions` FOREIGN KEY (`criterion_id`) REFERENCES `criterions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_ADC_departements` FOREIGN KEY (`departement_id`) REFERENCES `departements` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `assoc_departements_members`
--
ALTER TABLE `assoc_departements_members`
  ADD CONSTRAINT `FK_ADM_departements` FOREIGN KEY (`departement_id`) REFERENCES `departements` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_ADM_members` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `assoc_departements_users`
--
ALTER TABLE `assoc_departements_users`
  ADD CONSTRAINT `FK_ADU_departements` FOREIGN KEY (`departement_id`) REFERENCES `departements` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_ADU_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `assoc_members_projects`
--
ALTER TABLE `assoc_members_projects`
  ADD CONSTRAINT `FK_AMP_members` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_AMP_projects` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `assoc_projects_criterions`
--
ALTER TABLE `assoc_projects_criterions`
  ADD CONSTRAINT `FK_APC_criterions` FOREIGN KEY (`criterion_id`) REFERENCES `criterions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_APC_projects` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `assoc_projects_teams`
--
ALTER TABLE `assoc_projects_teams`
  ADD CONSTRAINT `FK_assocPT_projects` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_assocPT_teams` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `assoc_teams_criterions`
--
ALTER TABLE `assoc_teams_criterions`
  ADD CONSTRAINT `FK_ATC_criterions` FOREIGN KEY (`criterion_id`) REFERENCES `criterions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_teams_criterions` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `assoc_teams_members`
--
ALTER TABLE `assoc_teams_members`
  ADD CONSTRAINT `FK_ATM_members` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_ATM_teams` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `assoc_teams_users`
--
ALTER TABLE `assoc_teams_users`
  ADD CONSTRAINT `FK_assocTR_teams` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_assocTR_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `assoc_users_actiondisciplinaires`
--
ALTER TABLE `assoc_users_actiondisciplinaires`
  ADD CONSTRAINT `FK_assocRA_actionDisciplinaire` FOREIGN KEY (`actiondisciplinaire_id`) REFERENCES `actiondisciplinaires` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_assocRA_ressources` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `assoc_users_criterions`
--
ALTER TABLE `assoc_users_criterions`
  ADD CONSTRAINT `FK_AUC_criterions` FOREIGN KEY (`criterion_id`) REFERENCES `criterions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_AUC_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `assoc_users_projects`
--
ALTER TABLE `assoc_users_projects`
  ADD CONSTRAINT `FK_assocUP_projects` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_assocUP_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `authentifications`
--
ALTER TABLE `authentifications`
  ADD CONSTRAINT `FK_authentifications_clients` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_authentifications_members` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_authentifications_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `departements`
--
ALTER TABLE `departements`
  ADD CONSTRAINT `FK_departements_companies` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Contraintes pour la table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `FK_projects_priorities` FOREIGN KEY (`priority_id`) REFERENCES `priorities` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_projects_ps` FOREIGN KEY (`project_stage_id`) REFERENCES `project_stages` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION;

--
-- Contraintes pour la table `project_urls`
--
ALTER TABLE `project_urls`
  ADD CONSTRAINT `FK_project_urls_projects` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Contraintes pour la table `rapports`
--
ALTER TABLE `rapports`
  ADD CONSTRAINT `FK_rappots_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `teams`
--
ALTER TABLE `teams`
  ADD CONSTRAINT `FK_teams_departements` FOREIGN KEY (`departement_id`) REFERENCES `departements` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `user_urls`
--
ALTER TABLE `user_urls`
  ADD CONSTRAINT `FK_userUrls_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
