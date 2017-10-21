-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 12, 2017 at 04:50 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projects_manag_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `actiondisciplinaires`
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
-- Table structure for table `assoc_clients_projects`
--

CREATE TABLE `assoc_clients_projects` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `assoc_clients_projects`
--

INSERT INTO `assoc_clients_projects` (`id`, `client_id`, `project_id`) VALUES
(10, 12, 14),
(11, 12, 15),
(12, 12, 16),
(13, 12, 17);

-- --------------------------------------------------------

--
-- Table structure for table `assoc_companies_members`
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
-- Table structure for table `assoc_companies_users`
--

CREATE TABLE `assoc_companies_users` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `accessLevel` int(11) DEFAULT '0',
  `companyManager` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `assoc_companies_users`
--

INSERT INTO `assoc_companies_users` (`id`, `user_id`, `company_id`, `accessLevel`, `companyManager`) VALUES
(2, 18, 9, 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `assoc_departements_criterions`
--

CREATE TABLE `assoc_departements_criterions` (
  `id` int(11) NOT NULL,
  `departement_id` int(11) NOT NULL,
  `criterion_id` int(11) NOT NULL,
  `content` mediumtext COLLATE utf8_unicode_ci,
  `percent` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `assoc_departements_members`
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
-- Table structure for table `assoc_departements_users`
--

CREATE TABLE `assoc_departements_users` (
  `id` int(11) NOT NULL,
  `departement_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `accessLevel` int(11) DEFAULT '0',
  `departementManager` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `assoc_departements_users`
--

INSERT INTO `assoc_departements_users` (`id`, `departement_id`, `user_id`, `accessLevel`, `departementManager`) VALUES
(1, 21, 21, 5, 0),
(2, 22, 22, 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `assoc_members_projects`
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
-- Table structure for table `assoc_projects_criterions`
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
-- Table structure for table `assoc_projects_teams`
--

CREATE TABLE `assoc_projects_teams` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `assoc_projects_teams`
--

INSERT INTO `assoc_projects_teams` (`id`, `project_id`, `team_id`) VALUES
(28, 14, 32),
(29, 15, 32),
(30, 16, 29),
(31, 16, 31),
(32, 17, 31);

-- --------------------------------------------------------

--
-- Table structure for table `assoc_teams_criterions`
--

CREATE TABLE `assoc_teams_criterions` (
  `id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `criterion_id` int(11) NOT NULL,
  `content` mediumtext COLLATE utf8_unicode_ci,
  `percent` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `assoc_teams_members`
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
-- Table structure for table `assoc_teams_users`
--

CREATE TABLE `assoc_teams_users` (
  `id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `accessLevel` int(11) DEFAULT '3',
  `teamManager` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `assoc_teams_users`
--

INSERT INTO `assoc_teams_users` (`id`, `team_id`, `user_id`, `accessLevel`, `teamManager`) VALUES
(80, 32, 17, 4, 0),
(81, 29, 19, 3, 0),
(82, 31, 20, 3, 0),
(83, 29, 21, 3, 0),
(84, 32, 21, 3, 0),
(85, 31, 22, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `assoc_users_actiondisciplinaires`
--

CREATE TABLE `assoc_users_actiondisciplinaires` (
  `id` int(11) NOT NULL,
  `actiondisciplinaire_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `assoc_users_criterions`
--

CREATE TABLE `assoc_users_criterions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `criterion_id` int(11) NOT NULL,
  `content` tinytext COLLATE utf8_unicode_ci,
  `percent` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `assoc_users_projects`
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
-- Dumping data for table `assoc_users_projects`
--

INSERT INTO `assoc_users_projects` (`id`, `user_id`, `project_id`, `time_dedicated`, `projectManager`, `accessLevel`) VALUES
(111, 17, 14, 51, 0, 5),
(112, 17, 15, NULL, 0, 5),
(113, 19, 16, NULL, 0, 3),
(114, 20, 16, NULL, 0, 3),
(115, 21, 16, NULL, 0, 5),
(116, 20, 17, NULL, 0, 5),
(117, 22, 17, NULL, 0, 3);

-- --------------------------------------------------------

--
-- Table structure for table `authentifications`
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
-- Dumping data for table `authentifications`
--

INSERT INTO `authentifications` (`id`, `type`, `email`, `password`, `client_id`, `user_id`, `member_id`, `group_manager`, `clients_manager`, `criterions_manager`, `priorities_manager`, `projectstages_manager`) VALUES
(3, 'user', 'test@test.com', '$2y$10$Vsci5PhxjEGiqDoOrM/kxu6razvt4NVBcc6PODNHmBMlKxuvTQ836', NULL, NULL, NULL, 0, 0, 0, 0, 0),
(4, 'user', 'test54@test.com', '$2y$10$VknuSU0H.9LwelFoadwt8e1S9Esh38krrfZCacCWkdF2qaPweaoXW', NULL, NULL, NULL, 0, 0, 0, 0, 0),
(6, 'member', 'superadmin@superadmin.com', '$2y$10$VAS8YUW0KnYoC1gCYCepPOLeXnDeAZIP.25446NOCPhKuD/WvqIxO', NULL, NULL, 1, 1, 0, 0, 0, 0),
(27, 'user', 'jamel@jamel.com', '$2y$10$WdJfgSv/FeltYKKCdDAeZOqzXIah4vHfVPRm9gTL0O.uYmH4.Bvvq', NULL, 17, NULL, 0, 1, 0, 0, 0),
(28, 'client', 'wali@walid.com', '$2y$10$1o7Fy1fT.oeNkOHqeYgpv.DCIUMX0.GSXjH1fvN45Ql/SbGx458Ai', 12, NULL, NULL, 0, 0, 0, 0, 0),
(29, 'user', 'saber@saber.com', '$2y$10$2FkISKM9gFjlkU6yLpvFee5n/7SKSbbauRh5WggZIZh7ymndQZsMm', NULL, 18, NULL, 0, 0, 0, 0, 0),
(30, 'user', 'zied@zied.com', '$2y$10$7d0l1GlU..SDeWkFLP8ijOSDlKkTyiakZdBYqtDLU8..2zuw.6.T2', NULL, 19, NULL, 0, 0, 0, 0, 0),
(31, 'user', 'nabil@nabil.com', '$2y$10$pCDVZCmGMhGHIJlMCQ/7q.uragFSulli8PSgKbp7WxSqEq.b7nTOu', NULL, 20, NULL, 0, 0, 0, 0, 0),
(32, 'user', 'jacob@jacob.com', '$2y$10$2MzDsQr.2jVBjaJ/4E1LBOgkENVjRMuBco8fL4OTC1hOY9JT9IRny', NULL, 21, NULL, 0, 0, 0, 0, 0),
(33, 'user', 'taher@taher.com', '$2y$10$DJfoi7lF1o5SyovZWb/Nkudo.OHvOBkriG3SOxZxV2rv3ScF5H1ZK', NULL, 22, NULL, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `clients`
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
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `name`, `lastName`, `description`, `path_image`, `created`, `modified`, `created_by`, `modified_by`, `created_type`, `modified_type`) VALUES
(12, 'walid', 'zr', '', '', '2017-10-06 10:37:57', '2017-10-06 10:37:57', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `companies`
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
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `name`, `email`, `adresse`, `description`, `created`, `modified`, `created_by`, `modified_by`, `created_type`, `modified_type`) VALUES
(9, 'khidma', 'khidma@khidma.com', '', 'ju', '2017-10-06 09:28:11', '2017-10-06 14:01:20', NULL, NULL, NULL, NULL),
(10, 'azerzer', '', '', '', '2017-10-07 09:58:11', '2017-10-07 09:58:11', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `criterions`
--

CREATE TABLE `criterions` (
  `id` int(11) NOT NULL,
  `name` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(45) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `departements`
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
-- Dumping data for table `departements`
--

INSERT INTO `departements` (`id`, `name`, `description`, `created`, `modified`, `created_by`, `modified_by`, `created_type`, `modified_type`, `company_id`) VALUES
(21, 'devops', '', '2017-10-06 09:28:52', '2017-10-06 09:28:52', NULL, NULL, NULL, NULL, 9),
(22, 'support', '', '2017-10-06 09:29:00', '2017-10-06 09:29:00', NULL, NULL, NULL, NULL, 9),
(23, 'info', 'tt', '2017-10-06 14:56:30', '2017-10-06 14:56:30', NULL, NULL, NULL, NULL, 9);

-- --------------------------------------------------------

--
-- Table structure for table `members`
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
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `name`, `lastName`, `description`, `path_image`, `created`, `modified`, `created_by`, `modified_by`, `created_type`, `modified_type`) VALUES
(1, 'super', 'admin', '', '', '2017-01-23 15:25:00', '2017-01-23 15:25:00', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `priorities`
--

CREATE TABLE `priorities` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `order_priority` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `priorities`
--

INSERT INTO `priorities` (`id`, `name`, `order_priority`) VALUES
(1, 'Faible', 1),
(2, 'Moyen', 2),
(3, 'Important', 3);

-- --------------------------------------------------------

--
-- Table structure for table `projects`
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
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `name`, `accomplishment`, `description`, `objective`, `path_dir`, `dateBegin`, `dateEnd`, `project_stage_id`, `priority_id`, `created`, `modified`, `created_by`, `modified_by`, `created_type`, `modified_type`) VALUES
(14, 'platin', 85, '', '', '', '2017-10-06 08:00:00', '2017-10-06 18:00:00', 8, 2, '2017-10-06 09:59:38', '2017-10-06 10:36:04', NULL, NULL, NULL, NULL),
(15, 'forn', 45, '', '', NULL, '2017-10-06 08:00:00', '2017-10-06 18:00:00', 1, 2, '2017-10-06 15:00:57', '2017-10-06 15:00:57', NULL, NULL, NULL, NULL),
(16, 'machrou3', 67, '', '', NULL, '2017-10-11 08:00:00', '2017-10-11 18:00:00', 3, 2, '2017-10-11 10:52:47', '2017-10-11 10:52:47', NULL, NULL, NULL, NULL),
(17, 'assistance', 98, '', '', NULL, '2017-10-11 08:00:00', '2017-10-11 18:00:00', 10, 3, '2017-10-11 10:53:46', '2017-10-11 10:53:46', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `project_stages`
--

CREATE TABLE `project_stages` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `order_stage` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `project_stages`
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
-- Table structure for table `project_urls`
--

CREATE TABLE `project_urls` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `project_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `project_urls`
--

INSERT INTO `project_urls` (`id`, `name`, `url`, `project_id`) VALUES
(12, 'google', 'www.google.com', 15);

-- --------------------------------------------------------

--
-- Table structure for table `rapports`
--

CREATE TABLE `rapports` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `rapport` mediumtext COLLATE utf8_unicode_ci,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teams`
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
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `name`, `description`, `departement_id`, `created`, `modified`, `created_by`, `modified_by`, `created_type`, `modified_type`, `path_image`) VALUES
(29, 'web dev', '', 21, '2017-10-06 09:29:38', '2017-10-06 09:29:38', NULL, NULL, NULL, NULL, '29-webdev'),
(31, 'support team', '', 22, '2017-10-06 09:30:09', '2017-10-06 09:30:09', NULL, NULL, NULL, NULL, '31-supportteam'),
(32, 'lotus dev', 'lo', 21, '2017-10-06 09:33:21', '2017-10-06 10:35:25', NULL, NULL, NULL, NULL, '32-lotusdev'),
(33, 'hu', 'hh', 23, '2017-10-06 14:57:40', '2017-10-06 14:57:48', NULL, NULL, NULL, NULL, '33-hu');

-- --------------------------------------------------------

--
-- Table structure for table `users`
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
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `lastName`, `description`, `path_image`, `created`, `modified`, `created_by`, `modified_by`, `modified_type`, `created_type`) VALUES
(17, 'Jamel', 'nefzi', '', '17-jamelnefzi', '2017-10-06 09:32:28', '2017-10-06 14:59:04', NULL, NULL, NULL, NULL),
(18, 'saber', 'zermani', '', '18-saberzermani', '2017-10-06 10:55:17', '2017-10-06 14:00:44', NULL, NULL, NULL, NULL),
(19, 'Zied ', 'haffoudhi', '', '19-ziedhaffoudhi', '2017-10-11 10:48:20', '2017-10-11 10:48:20', NULL, NULL, NULL, NULL),
(20, 'nabil', 'mechergui', '', '20-nabilmechergui', '2017-10-11 10:48:58', '2017-10-11 10:48:58', NULL, NULL, NULL, NULL),
(21, 'jacob', 'klai', '', '21-jacobklai', '2017-10-11 10:49:45', '2017-10-11 10:49:45', NULL, NULL, NULL, NULL),
(22, 'taher', 'elloumi', '', '22-taherelloumi', '2017-10-11 10:50:22', '2017-10-11 10:50:22', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_urls`
--

CREATE TABLE `user_urls` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `actiondisciplinaires`
--
ALTER TABLE `actiondisciplinaires`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assoc_clients_projects`
--
ALTER TABLE `assoc_clients_projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_assocCP_projects_idx` (`project_id`),
  ADD KEY `FK_assocCP_clients_idx` (`client_id`);

--
-- Indexes for table `assoc_companies_members`
--
ALTER TABLE `assoc_companies_members`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_ACU_company_idx` (`company_id`),
  ADD KEY `FK_ACM_members_idx` (`member_id`);

--
-- Indexes for table `assoc_companies_users`
--
ALTER TABLE `assoc_companies_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_ACU_users_idx` (`user_id`),
  ADD KEY `FK_ACU_company_idx` (`company_id`);

--
-- Indexes for table `assoc_departements_criterions`
--
ALTER TABLE `assoc_departements_criterions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_ADC_departements_idx` (`departement_id`),
  ADD KEY `FK_ADC_criterions_idx` (`criterion_id`);

--
-- Indexes for table `assoc_departements_members`
--
ALTER TABLE `assoc_departements_members`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_ADU_departements_idx` (`departement_id`),
  ADD KEY `FK_ADM_members_idx` (`member_id`);

--
-- Indexes for table `assoc_departements_users`
--
ALTER TABLE `assoc_departements_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_ADU_departements_idx` (`departement_id`),
  ADD KEY `FK_ADU_users_idx` (`user_id`);

--
-- Indexes for table `assoc_members_projects`
--
ALTER TABLE `assoc_members_projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_assocCP_projects_idx` (`project_id`),
  ADD KEY `FK_AMP_members_idx` (`member_id`);

--
-- Indexes for table `assoc_projects_criterions`
--
ALTER TABLE `assoc_projects_criterions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_APC_criterions_idx` (`criterion_id`),
  ADD KEY `FK_APC_projects_idx` (`project_id`);

--
-- Indexes for table `assoc_projects_teams`
--
ALTER TABLE `assoc_projects_teams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_assocPT_teams_idx` (`team_id`),
  ADD KEY `FK_assocPT_teams_idx1` (`project_id`);

--
-- Indexes for table `assoc_teams_criterions`
--
ALTER TABLE `assoc_teams_criterions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_teams_criterions_idx` (`team_id`),
  ADD KEY `FK_ATC_criterions_idx` (`criterion_id`);

--
-- Indexes for table `assoc_teams_members`
--
ALTER TABLE `assoc_teams_members`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_assocTR_teams_idx` (`team_id`),
  ADD KEY `FK_ATM_members_idx` (`member_id`);

--
-- Indexes for table `assoc_teams_users`
--
ALTER TABLE `assoc_teams_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_assocTR_teams_idx` (`team_id`),
  ADD KEY `FK_assocTR_users_idx` (`user_id`);

--
-- Indexes for table `assoc_users_actiondisciplinaires`
--
ALTER TABLE `assoc_users_actiondisciplinaires`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_assocRA_actionDisciplinaire_idx` (`actiondisciplinaire_id`),
  ADD KEY `FK_assocRA_ressources_idx` (`user_id`);

--
-- Indexes for table `assoc_users_criterions`
--
ALTER TABLE `assoc_users_criterions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_AUC_users_idx` (`user_id`),
  ADD KEY `FK_AUC_criterions_idx` (`criterion_id`);

--
-- Indexes for table `assoc_users_projects`
--
ALTER TABLE `assoc_users_projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_assocCP_projects_idx` (`project_id`),
  ADD KEY `FK_assocUP_users_idx` (`user_id`);

--
-- Indexes for table `authentifications`
--
ALTER TABLE `authentifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_authentifications_clients_idx` (`client_id`),
  ADD KEY `FK_authentifications_users_idx` (`user_id`),
  ADD KEY `FK_authentifications_members_idx` (`member_id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `criterions`
--
ALTER TABLE `criterions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departements`
--
ALTER TABLE `departements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_departements_companies_idx` (`company_id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `priorities`
--
ALTER TABLE `priorities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_projects_ps_idx` (`project_stage_id`),
  ADD KEY `FK_projects_priorities_idx` (`priority_id`);

--
-- Indexes for table `project_stages`
--
ALTER TABLE `project_stages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_urls`
--
ALTER TABLE `project_urls`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_project_urls_projects_idx` (`project_id`);

--
-- Indexes for table `rapports`
--
ALTER TABLE `rapports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_rappots_users_idx` (`user_id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_teams_departements_idx` (`departement_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_urls`
--
ALTER TABLE `user_urls`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_userUrls_users_idx` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `actiondisciplinaires`
--
ALTER TABLE `actiondisciplinaires`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `assoc_clients_projects`
--
ALTER TABLE `assoc_clients_projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `assoc_companies_members`
--
ALTER TABLE `assoc_companies_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `assoc_companies_users`
--
ALTER TABLE `assoc_companies_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `assoc_departements_criterions`
--
ALTER TABLE `assoc_departements_criterions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `assoc_departements_members`
--
ALTER TABLE `assoc_departements_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `assoc_departements_users`
--
ALTER TABLE `assoc_departements_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `assoc_members_projects`
--
ALTER TABLE `assoc_members_projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `assoc_projects_criterions`
--
ALTER TABLE `assoc_projects_criterions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `assoc_projects_teams`
--
ALTER TABLE `assoc_projects_teams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `assoc_teams_criterions`
--
ALTER TABLE `assoc_teams_criterions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `assoc_teams_members`
--
ALTER TABLE `assoc_teams_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `assoc_teams_users`
--
ALTER TABLE `assoc_teams_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;
--
-- AUTO_INCREMENT for table `assoc_users_actiondisciplinaires`
--
ALTER TABLE `assoc_users_actiondisciplinaires`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `assoc_users_criterions`
--
ALTER TABLE `assoc_users_criterions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `assoc_users_projects`
--
ALTER TABLE `assoc_users_projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;
--
-- AUTO_INCREMENT for table `authentifications`
--
ALTER TABLE `authentifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `criterions`
--
ALTER TABLE `criterions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `departements`
--
ALTER TABLE `departements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `priorities`
--
ALTER TABLE `priorities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `project_stages`
--
ALTER TABLE `project_stages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `project_urls`
--
ALTER TABLE `project_urls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `rapports`
--
ALTER TABLE `rapports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `user_urls`
--
ALTER TABLE `user_urls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `assoc_clients_projects`
--
ALTER TABLE `assoc_clients_projects`
  ADD CONSTRAINT `FK_assocCP_clients` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_assocCP_projects` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `assoc_companies_members`
--
ALTER TABLE `assoc_companies_members`
  ADD CONSTRAINT `FK_ACM_company` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_ACM_members` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `assoc_companies_users`
--
ALTER TABLE `assoc_companies_users`
  ADD CONSTRAINT `FK_ACU_company` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_ACU_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `assoc_departements_criterions`
--
ALTER TABLE `assoc_departements_criterions`
  ADD CONSTRAINT `FK_ADC_criterions` FOREIGN KEY (`criterion_id`) REFERENCES `criterions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_ADC_departements` FOREIGN KEY (`departement_id`) REFERENCES `departements` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `assoc_departements_members`
--
ALTER TABLE `assoc_departements_members`
  ADD CONSTRAINT `FK_ADM_departements` FOREIGN KEY (`departement_id`) REFERENCES `departements` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_ADM_members` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `assoc_departements_users`
--
ALTER TABLE `assoc_departements_users`
  ADD CONSTRAINT `FK_ADU_departements` FOREIGN KEY (`departement_id`) REFERENCES `departements` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_ADU_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `assoc_members_projects`
--
ALTER TABLE `assoc_members_projects`
  ADD CONSTRAINT `FK_AMP_members` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_AMP_projects` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `assoc_projects_criterions`
--
ALTER TABLE `assoc_projects_criterions`
  ADD CONSTRAINT `FK_APC_criterions` FOREIGN KEY (`criterion_id`) REFERENCES `criterions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_APC_projects` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `assoc_projects_teams`
--
ALTER TABLE `assoc_projects_teams`
  ADD CONSTRAINT `FK_assocPT_projects` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_assocPT_teams` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `assoc_teams_criterions`
--
ALTER TABLE `assoc_teams_criterions`
  ADD CONSTRAINT `FK_ATC_criterions` FOREIGN KEY (`criterion_id`) REFERENCES `criterions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_teams_criterions` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `assoc_teams_members`
--
ALTER TABLE `assoc_teams_members`
  ADD CONSTRAINT `FK_ATM_members` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_ATM_teams` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `assoc_teams_users`
--
ALTER TABLE `assoc_teams_users`
  ADD CONSTRAINT `FK_assocTR_teams` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_assocTR_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `assoc_users_actiondisciplinaires`
--
ALTER TABLE `assoc_users_actiondisciplinaires`
  ADD CONSTRAINT `FK_assocRA_actionDisciplinaire` FOREIGN KEY (`actiondisciplinaire_id`) REFERENCES `actiondisciplinaires` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_assocRA_ressources` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `assoc_users_criterions`
--
ALTER TABLE `assoc_users_criterions`
  ADD CONSTRAINT `FK_AUC_criterions` FOREIGN KEY (`criterion_id`) REFERENCES `criterions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_AUC_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `assoc_users_projects`
--
ALTER TABLE `assoc_users_projects`
  ADD CONSTRAINT `FK_assocUP_projects` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_assocUP_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `authentifications`
--
ALTER TABLE `authentifications`
  ADD CONSTRAINT `FK_authentifications_clients` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_authentifications_members` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_authentifications_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `departements`
--
ALTER TABLE `departements`
  ADD CONSTRAINT `FK_departements_companies` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `FK_projects_priorities` FOREIGN KEY (`priority_id`) REFERENCES `priorities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_projects_ps` FOREIGN KEY (`project_stage_id`) REFERENCES `project_stages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `project_urls`
--
ALTER TABLE `project_urls`
  ADD CONSTRAINT `FK_project_urls_projects` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `rapports`
--
ALTER TABLE `rapports`
  ADD CONSTRAINT `FK_rappots_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `teams`
--
ALTER TABLE `teams`
  ADD CONSTRAINT `FK_teams_departements` FOREIGN KEY (`departement_id`) REFERENCES `departements` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_urls`
--
ALTER TABLE `user_urls`
  ADD CONSTRAINT `FK_userUrls_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
