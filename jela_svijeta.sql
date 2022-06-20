-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 20, 2022 at 04:00 PM
-- Server version: 10.5.10-MariaDB-debug
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jela_svijeta`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`) VALUES
(1),
(2),
(3),
(4),
(5);

-- --------------------------------------------------------

--
-- Table structure for table `category_names`
--

CREATE TABLE `category_names` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `locale` varchar(200) NOT NULL,
  `title` varchar(200) NOT NULL,
  `slug` varchar(200) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category_names`
--

INSERT INTO `category_names` (`id`, `category_id`, `locale`, `title`, `slug`, `created_at`) VALUES
(1, 1, 'hr', 'Ulica Tina Ujevića', 'ulica-tina-ujevića', '2022-06-20 15:33:28'),
(2, 1, 'eng', 'Zackary Mountain', 'ulica-tina-ujevića', '2022-06-20 15:33:28'),
(3, 1, 'fr', 'rue de Chevallier', 'ulica-tina-ujevića', '2022-06-20 15:33:28'),
(4, 2, 'hr', 'Mirna ulica', 'mirna-ulica', '2022-06-20 15:33:36'),
(5, 2, 'eng', 'Rodger Valleys', 'mirna-ulica', '2022-06-20 15:33:36'),
(6, 2, 'fr', 'place de Gallet', 'mirna-ulica', '2022-06-20 15:33:36'),
(7, 3, 'hr', 'Ulica Matije Petra Katančića', 'ulica-matije-petra-katančića', '2022-06-20 15:33:37'),
(8, 3, 'eng', 'Bartell Road', 'ulica-matije-petra-katančića', '2022-06-20 15:33:37'),
(9, 3, 'fr', 'rue Isaac Morvan', 'ulica-matije-petra-katančića', '2022-06-20 15:33:37'),
(10, 4, 'hr', 'Šećeranska ulica', 'Šećeranska-ulica', '2022-06-20 15:33:37'),
(11, 4, 'eng', 'Kailey Mission', 'Šećeranska-ulica', '2022-06-20 15:33:37'),
(12, 4, 'fr', 'impasse Arthur Leclercq', 'Šećeranska-ulica', '2022-06-20 15:33:37'),
(13, 5, 'hr', 'Ulica Petra Drapšina', 'ulica-petra-drapšina', '2022-06-20 15:33:38'),
(14, 5, 'eng', 'Martina Ways', 'ulica-petra-drapšina', '2022-06-20 15:33:38'),
(15, 5, 'fr', 'place Mendes', 'ulica-petra-drapšina', '2022-06-20 15:33:38');

-- --------------------------------------------------------

--
-- Table structure for table `ingredients`
--

CREATE TABLE `ingredients` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ingredients`
--

INSERT INTO `ingredients` (`id`) VALUES
(1),
(2),
(3),
(4),
(5),
(6),
(7);

-- --------------------------------------------------------

--
-- Table structure for table `ingredients_names`
--

CREATE TABLE `ingredients_names` (
  `id` int(11) NOT NULL,
  `ingredients_id` int(11) NOT NULL,
  `locale` varchar(200) NOT NULL,
  `title` varchar(200) NOT NULL,
  `slug` varchar(200) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ingredients_names`
--

INSERT INTO `ingredients_names` (`id`, `ingredients_id`, `locale`, `title`, `slug`, `created_at`) VALUES
(1, 2, 'hr', 'Maras j.d.o.o.', 'maras-j.d.o.o.', '2022-06-20 09:26:35'),
(2, 2, 'eng', 'Schmidt, Anderson and Prosacco', 'maras-j.d.o.o.', '2022-06-20 09:26:35'),
(3, 2, 'fr', 'Herve', 'maras-j.d.o.o.', '2022-06-20 09:26:35'),
(4, 3, 'hr', 'Turistička agencija Emil', 'turistička-agencija-emil', '2022-06-20 09:26:36'),
(5, 3, 'eng', 'Bogan-Spencer', 'turistička-agencija-emil', '2022-06-20 09:26:36'),
(6, 3, 'fr', 'Rousseau', 'turistička-agencija-emil', '2022-06-20 09:26:36'),
(7, 4, 'hr', 'Brož j.d.o.o.', 'brož-j.d.o.o.', '2022-06-20 09:26:36'),
(8, 4, 'eng', 'Moore-Rice', 'brož-j.d.o.o.', '2022-06-20 09:26:36'),
(9, 4, 'fr', 'Menard', 'brož-j.d.o.o.', '2022-06-20 09:26:36'),
(10, 5, 'hr', 'Mesnica Ena', 'mesnica-ena', '2022-06-20 09:26:37'),
(11, 5, 'eng', 'Bednar Group', 'mesnica-ena', '2022-06-20 09:26:37'),
(12, 5, 'fr', 'Lemaitre S.A.R.L.', 'mesnica-ena', '2022-06-20 09:26:37'),
(13, 6, 'hr', 'Kasun j.d.o.o.', 'kasun-j.d.o.o.', '2022-06-20 09:26:37'),
(14, 6, 'eng', 'Franecki, Yundt and Zulauf', 'kasun-j.d.o.o.', '2022-06-20 09:26:37'),
(15, 6, 'fr', 'Roussel S.A.S.', 'kasun-j.d.o.o.', '2022-06-20 09:26:37'),
(16, 7, 'hr', 'Vlahović d.o.o.', 'vlahović-d.o.o.', '2022-06-20 09:26:38'),
(17, 7, 'eng', 'Klein Group', 'vlahović-d.o.o.', '2022-06-20 09:26:38'),
(18, 7, 'fr', 'Letellier', 'vlahović-d.o.o.', '2022-06-20 09:26:38');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `locale` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `title`, `locale`, `created_at`) VALUES
(1, 'Croatian', 'hr', '2022-06-12 17:48:04'),
(2, 'English', 'eng', '2022-06-12 17:48:04'),
(3, 'French', 'fr', '2022-06-12 17:48:23');

-- --------------------------------------------------------

--
-- Table structure for table `meals`
--

CREATE TABLE `meals` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `meals`
--

INSERT INTO `meals` (`id`, `category_id`, `created_at`) VALUES
(1, 2, '2022-06-20 15:34:27'),
(2, 4, '2022-06-20 15:34:29'),
(3, 5, '2022-06-20 15:34:29'),
(4, NULL, '2022-06-20 15:34:40'),
(5, 3, '2022-06-20 15:34:41'),
(6, 4, '2022-06-20 15:34:42'),
(7, 5, '2022-06-20 15:34:44'),
(8, 3, '2022-06-20 15:34:45'),
(9, NULL, '2022-06-20 15:34:45'),
(10, 2, '2022-06-20 15:34:46'),
(11, 2, '2022-06-20 15:34:54'),
(12, NULL, '2022-06-20 15:34:54'),
(13, 5, '2022-06-20 15:34:55'),
(14, 4, '2022-06-20 15:34:55'),
(15, 3, '2022-06-20 15:34:56'),
(16, NULL, '2022-06-20 15:34:56'),
(17, 3, '2022-06-20 15:34:57'),
(18, 1, '2022-06-20 15:34:57'),
(19, 5, '2022-06-20 15:34:57'),
(20, 3, '2022-06-20 15:35:02');

-- --------------------------------------------------------

--
-- Table structure for table `meals_ingredients`
--

CREATE TABLE `meals_ingredients` (
  `id` int(11) NOT NULL,
  `meals_id` int(11) NOT NULL,
  `ingredients_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `meals_ingredients`
--

INSERT INTO `meals_ingredients` (`id`, `meals_id`, `ingredients_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 2, '2022-06-20 15:49:57', NULL, NULL),
(2, 2, 4, '2022-06-20 15:50:00', NULL, NULL),
(3, 3, 5, '2022-06-20 15:50:01', NULL, NULL),
(4, 4, 2, '2022-06-20 15:50:06', NULL, NULL),
(5, 4, 3, '2022-06-20 15:50:07', NULL, NULL),
(6, 5, 3, '2022-06-20 15:50:11', NULL, NULL),
(7, 6, 1, '2022-06-20 15:50:13', NULL, NULL),
(8, 6, 2, '2022-06-20 15:50:14', NULL, NULL),
(9, 7, 4, '2022-06-20 15:50:19', NULL, NULL),
(10, 8, 6, '2022-06-20 15:50:23', NULL, NULL),
(11, 9, 4, '2022-06-20 15:50:27', NULL, NULL),
(12, 9, 1, '2022-06-20 15:50:28', NULL, NULL),
(13, 10, 7, '2022-06-20 15:50:33', NULL, NULL),
(14, 11, 3, '2022-06-20 15:50:35', NULL, NULL),
(15, 12, 2, '2022-06-20 15:50:39', NULL, NULL),
(16, 12, 3, '2022-06-20 15:50:40', NULL, NULL),
(17, 13, 6, '2022-06-20 15:50:46', NULL, NULL),
(18, 13, 7, '2022-06-20 15:50:48', NULL, NULL),
(19, 14, 6, '2022-06-20 15:50:51', NULL, NULL),
(20, 15, 5, '2022-06-20 15:50:53', NULL, NULL),
(21, 16, 1, '2022-06-20 15:50:57', NULL, NULL),
(22, 16, 5, '2022-06-20 15:51:02', NULL, NULL),
(23, 17, 4, '2022-06-20 15:51:08', NULL, NULL),
(24, 18, 2, '2022-06-20 15:51:13', NULL, NULL),
(25, 19, 3, '2022-06-20 15:51:16', NULL, NULL),
(26, 20, 1, '2022-06-20 15:51:19', NULL, NULL),
(27, 20, 3, '2022-06-20 15:51:20', NULL, NULL),
(28, 10, 3, '2022-06-20 15:51:39', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `meals_names`
--

CREATE TABLE `meals_names` (
  `id` int(11) NOT NULL,
  `meals_id` int(11) NOT NULL,
  `locale` varchar(200) NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `status` varchar(200) NOT NULL DEFAULT 'created',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `meals_names`
--

INSERT INTO `meals_names` (`id`, `meals_id`, `locale`, `title`, `description`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'hr', 'Informatički obrt Marušić', 'Poljska', 'created', '2022-06-20 15:34:27', NULL, NULL),
(2, 1, 'eng', 'Ernser Inc', 'Afghanistan', 'created', '2022-06-20 15:34:27', NULL, NULL),
(3, 1, 'fr', 'Legros Chartier SARL', 'Tunisie', 'created', '2022-06-20 15:34:27', NULL, NULL),
(4, 2, 'hr', 'Vuka d.o.o.', 'Namibija', 'created', '2022-06-20 15:34:29', NULL, NULL),
(5, 2, 'eng', 'Collier, Hayes and Lueilwitz', 'Niger', 'created', '2022-06-20 15:34:29', NULL, NULL),
(6, 2, 'fr', 'Monnier Leveque S.A.R.L.', 'Qatar', 'created', '2022-06-20 15:34:29', NULL, NULL),
(7, 3, 'hr', 'Market Tina', 'Malta', 'created', '2022-06-20 15:34:29', NULL, NULL),
(8, 3, 'eng', 'Pfannerstill-Kirlin', 'Central African Republic', 'created', '2022-06-20 15:34:29', NULL, NULL),
(9, 3, 'fr', 'Mary', 'Martinique', 'created', '2022-06-20 15:34:29', NULL, NULL),
(10, 4, 'hr', 'Prijevoznički obrt Kovačević', 'Kanada', 'created', '2022-06-20 15:34:40', NULL, NULL),
(11, 4, 'eng', 'Jerde, Bauch and Cole', 'Barbados', 'created', '2022-06-20 15:34:40', NULL, NULL),
(12, 4, 'fr', 'Guibert', 'Bosnie-Herzégovine', 'created', '2022-06-20 15:34:40', NULL, NULL),
(13, 5, 'hr', 'Turistička agencija Juriša', 'Češka', 'deleted', '2022-06-20 15:34:41', NULL, '2022-06-20 15:54:21'),
(14, 5, 'eng', 'Donnelly Inc', 'New Zealand', 'deleted', '2022-06-20 15:34:41', NULL, '2022-06-20 15:54:21'),
(15, 5, 'fr', 'Lebon Godard S.A.', 'Niue', 'deleted', '2022-06-20 15:34:41', NULL, '2022-06-20 15:54:21'),
(16, 6, 'hr', 'Ratković j.d.o.o.', 'Gambija', 'created', '2022-06-20 15:34:42', NULL, NULL),
(17, 6, 'eng', 'Brown-Krajcik', 'Martinique', 'created', '2022-06-20 15:34:42', NULL, NULL),
(18, 6, 'fr', 'Barre', 'Nicaragua', 'created', '2022-06-20 15:34:42', NULL, NULL),
(19, 7, 'hr', 'Prijevoznički obrt Vice', 'Etiopija', 'modified', '2022-06-20 15:34:44', '2022-06-20 15:53:56', NULL),
(20, 7, 'eng', 'Krajcik-Trantow', 'Venezuela', 'modified', '2022-06-20 15:34:44', '2022-06-20 15:53:56', NULL),
(21, 7, 'fr', 'Jacquot', 'Ukraine', 'modified', '2022-06-20 15:34:44', '2022-06-20 15:53:56', NULL),
(22, 8, 'hr', 'Cvjećarnica Robert', 'Libija', 'created', '2022-06-20 15:34:45', NULL, NULL),
(23, 8, 'eng', 'Price-Abernathy', 'Belgium', 'created', '2022-06-20 15:34:45', NULL, NULL),
(24, 8, 'fr', 'Reynaud', 'Lettonie', 'created', '2022-06-20 15:34:45', NULL, NULL),
(25, 9, 'hr', 'Prijevoznički obrt Tomčić', 'Namibija', 'deleted', '2022-06-20 15:34:45', NULL, '2022-06-20 15:54:24'),
(26, 9, 'eng', 'Larkin LLC', 'Poland', 'deleted', '2022-06-20 15:34:45', NULL, '2022-06-20 15:54:24'),
(27, 9, 'fr', 'Imbert', 'Monaco', 'deleted', '2022-06-20 15:34:45', NULL, '2022-06-20 15:54:24'),
(28, 10, 'hr', 'Prijevoznički obrt Daniel', 'Norveška', 'created', '2022-06-20 15:34:46', NULL, NULL),
(29, 10, 'eng', 'Pollich, Rau and Rosenbaum', 'Solomon Islands', 'created', '2022-06-20 15:34:46', NULL, NULL),
(30, 10, 'fr', 'Bernier et Fils', 'Brésil', 'created', '2022-06-20 15:34:46', NULL, NULL),
(31, 11, 'hr', 'Voćarna Josipa', 'Bangladeš', 'modified', '2022-06-20 15:34:54', '2022-06-20 15:54:03', NULL),
(32, 11, 'eng', 'Cormier-Schulist', 'Saint Martin', 'modified', '2022-06-20 15:34:54', '2022-06-20 15:54:03', NULL),
(33, 11, 'fr', 'Pascal Roussel SA', 'Pologne', 'modified', '2022-06-20 15:34:54', '2022-06-20 15:54:03', NULL),
(34, 12, 'hr', 'Prijevoznički obrt Juraj', 'Namibija', 'created', '2022-06-20 15:34:54', NULL, NULL),
(35, 12, 'eng', 'Parker-Becker', 'Mayotte', 'created', '2022-06-20 15:34:54', NULL, NULL),
(36, 12, 'fr', 'Pineau', 'Saint Vincent et les Grenadines', 'created', '2022-06-20 15:34:54', NULL, NULL),
(37, 13, 'hr', 'Kamenorezački obrt Vlašić', 'Bolivija', 'modified', '2022-06-20 15:34:55', '2022-06-20 15:54:07', NULL),
(38, 13, 'eng', 'Hand Ltd', 'Egypt', 'modified', '2022-06-20 15:34:55', '2022-06-20 15:54:07', NULL),
(39, 13, 'fr', 'Picard', 'Antarctique', 'modified', '2022-06-20 15:34:55', '2022-06-20 15:54:07', NULL),
(40, 14, 'hr', 'Mesnica Andrija', 'Makedonija', 'created', '2022-06-20 15:34:55', NULL, NULL),
(41, 14, 'eng', 'Goldner, Klein and Zieme', 'Greenland', 'created', '2022-06-20 15:34:55', NULL, NULL),
(42, 14, 'fr', 'Fouquet S.A.', 'Sahara Occidental', 'created', '2022-06-20 15:34:55', NULL, NULL),
(43, 15, 'hr', 'Informatički obrt Kovačić', 'Alžir', 'modified', '2022-06-20 15:34:56', '2022-06-20 15:54:09', NULL),
(44, 15, 'eng', 'Kshlerin, Russel and Kassulke', 'Montenegro', 'modified', '2022-06-20 15:34:56', '2022-06-20 15:54:09', NULL),
(45, 15, 'fr', 'Toussaint', 'Érythrée', 'modified', '2022-06-20 15:34:56', '2022-06-20 15:54:09', NULL),
(46, 16, 'hr', 'Market Kovač', 'Izrael', 'created', '2022-06-20 15:34:56', NULL, NULL),
(47, 16, 'eng', 'Waters PLC', 'China', 'created', '2022-06-20 15:34:56', NULL, NULL),
(48, 16, 'fr', 'Nicolas SARL', 'Japon', 'created', '2022-06-20 15:34:56', NULL, NULL),
(49, 17, 'hr', 'Prijevoznički obrt Modrić', 'Poljska', 'created', '2022-06-20 15:34:57', NULL, NULL),
(50, 17, 'eng', 'Kris-Goldner', 'Montserrat', 'created', '2022-06-20 15:34:57', NULL, NULL),
(51, 17, 'fr', 'Breton', 'São Tomé et Príncipe (Rép.)', 'created', '2022-06-20 15:34:57', NULL, NULL),
(52, 18, 'hr', 'Suvenirnica Toni', 'Finska', 'deleted', '2022-06-20 15:34:57', NULL, '2022-06-20 15:54:34'),
(53, 18, 'eng', 'Stark, Schmeler and Schaden', 'Ecuador', 'deleted', '2022-06-20 15:34:57', NULL, '2022-06-20 15:54:34'),
(54, 18, 'fr', 'Foucher', 'Nigeria', 'deleted', '2022-06-20 15:34:57', NULL, '2022-06-20 15:54:34'),
(55, 19, 'hr', 'Suvenirnica Luka', 'Singapur', 'deleted', '2022-06-20 15:34:57', NULL, '2022-06-20 15:54:35'),
(56, 19, 'eng', 'Price PLC', 'Namibia', 'deleted', '2022-06-20 15:34:57', NULL, '2022-06-20 15:54:35'),
(57, 19, 'fr', 'Petit', 'Sénégal', 'deleted', '2022-06-20 15:34:57', NULL, '2022-06-20 15:54:35'),
(58, 20, 'hr', 'Kladionice Vlašić', 'Katar', 'created', '2022-06-20 15:35:02', NULL, NULL),
(59, 20, 'eng', 'Rempel-Pouros', 'Egypt', 'created', '2022-06-20 15:35:02', NULL, NULL),
(60, 20, 'fr', 'Fischer', 'Honduras', 'created', '2022-06-20 15:35:02', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `meals_tags`
--

CREATE TABLE `meals_tags` (
  `id` int(11) NOT NULL,
  `meals_id` int(11) NOT NULL,
  `tags_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `meals_tags`
--

INSERT INTO `meals_tags` (`id`, `meals_id`, `tags_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 3, '2022-06-20 15:46:13', NULL, NULL),
(2, 2, 7, '2022-06-20 15:46:22', NULL, NULL),
(3, 3, 2, '2022-06-20 15:46:28', NULL, NULL),
(4, 4, 3, '2022-06-20 15:46:31', NULL, NULL),
(5, 5, 5, '2022-06-20 15:46:35', NULL, NULL),
(6, 6, 7, '2022-06-20 15:46:38', NULL, NULL),
(7, 7, 3, '2022-06-20 15:46:44', NULL, NULL),
(8, 7, 6, '2022-06-20 15:46:46', NULL, NULL),
(9, 8, 3, '2022-06-20 15:46:50', NULL, NULL),
(10, 9, 1, '2022-06-20 15:46:53', NULL, NULL),
(11, 10, 3, '2022-06-20 15:46:56', NULL, NULL),
(12, 11, 2, '2022-06-20 15:46:58', NULL, NULL),
(13, 12, 3, '2022-06-20 15:47:03', NULL, NULL),
(14, 13, 3, '2022-06-20 15:47:08', NULL, NULL),
(15, 14, 4, '2022-06-20 15:47:12', NULL, NULL),
(16, 15, 2, '2022-06-20 15:47:14', NULL, NULL),
(17, 16, 4, '2022-06-20 15:47:18', NULL, NULL),
(18, 17, 2, '2022-06-20 15:47:22', NULL, NULL),
(19, 18, 4, '2022-06-20 15:47:28', NULL, NULL),
(20, 19, 3, '2022-06-20 15:47:32', NULL, NULL),
(21, 20, 2, '2022-06-20 15:47:35', NULL, NULL),
(22, 4, 5, '2022-06-20 15:47:42', NULL, NULL),
(23, 8, 4, '2022-06-20 15:47:48', NULL, NULL),
(24, 9, 5, '2022-06-20 15:47:52', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`) VALUES
(1),
(2),
(3),
(4),
(5),
(6),
(7);

-- --------------------------------------------------------

--
-- Table structure for table `tags_names`
--

CREATE TABLE `tags_names` (
  `id` int(11) NOT NULL,
  `tags_id` int(11) NOT NULL,
  `locale` varchar(200) NOT NULL,
  `title` varchar(200) NOT NULL,
  `slug` varchar(200) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tags_names`
--

INSERT INTO `tags_names` (`id`, `tags_id`, `locale`, `title`, `slug`, `created_at`) VALUES
(1, 1, 'hr', 'Raić-Sudar Security', 'raić-sudar-security', '2022-06-20 09:26:58'),
(2, 1, 'eng', 'DuBuque, Ernser and Bartoletti', 'raić-sudar-security', '2022-06-20 09:26:58'),
(3, 1, 'fr', 'Maillot Besnard S.A.S.', 'raić-sudar-security', '2022-06-20 09:26:58'),
(4, 2, 'hr', 'Franić d.o.o.', 'franić-d.o.o.', '2022-06-20 09:26:59'),
(5, 2, 'eng', 'Kemmer-Aufderhar', 'franić-d.o.o.', '2022-06-20 09:26:59'),
(6, 2, 'fr', 'Denis', 'franić-d.o.o.', '2022-06-20 09:26:59'),
(7, 3, 'hr', 'Mlakar Security', 'mlakar-security', '2022-06-20 09:27:00'),
(8, 3, 'eng', 'O\'Hara LLC', 'mlakar-security', '2022-06-20 09:27:00'),
(9, 3, 'fr', 'Turpin', 'mlakar-security', '2022-06-20 09:27:00'),
(10, 4, 'hr', 'Brož j.d.o.o.', 'brož-j.d.o.o.', '2022-06-20 09:27:00'),
(11, 4, 'eng', 'Bailey and Sons', 'brož-j.d.o.o.', '2022-06-20 09:27:00'),
(12, 4, 'fr', 'Maillard', 'brož-j.d.o.o.', '2022-06-20 09:27:00'),
(13, 5, 'hr', 'Dragović d.o.o.', 'dragović-d.o.o.', '2022-06-20 09:27:01'),
(14, 5, 'eng', 'Kshlerin-Collier', 'dragović-d.o.o.', '2022-06-20 09:27:01'),
(15, 5, 'fr', 'Mary et Fils', 'dragović-d.o.o.', '2022-06-20 09:27:01'),
(16, 6, 'hr', 'Informatički obrt Mara', 'informatički-obrt-mara', '2022-06-20 09:27:01'),
(17, 6, 'eng', 'Fritsch, Waelchi and Mann', 'informatički-obrt-mara', '2022-06-20 09:27:01'),
(18, 6, 'fr', 'Merle', 'informatički-obrt-mara', '2022-06-20 09:27:01'),
(19, 7, 'hr', 'Prijevoznički obrt Paola', 'prijevoznički-obrt-paola', '2022-06-20 09:27:02'),
(20, 7, 'eng', 'Labadie-O\'Keefe', 'prijevoznički-obrt-paola', '2022-06-20 09:27:02'),
(21, 7, 'fr', 'Prevost S.A.S.', 'prijevoznički-obrt-paola', '2022-06-20 09:27:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_names`
--
ALTER TABLE `category_names`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_names_category_id` (`category_id`),
  ADD KEY `category_names_locale_index` (`locale`) USING BTREE;

--
-- Indexes for table `ingredients`
--
ALTER TABLE `ingredients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ingredients_names`
--
ALTER TABLE `ingredients_names`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ingredients_names_ingredients_id` (`ingredients_id`),
  ADD KEY `ingredients_names_locale_index` (`locale`) USING BTREE;

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meals`
--
ALTER TABLE `meals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `meals_category_id` (`category_id`);

--
-- Indexes for table `meals_ingredients`
--
ALTER TABLE `meals_ingredients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `meals_ingredients_meals_id` (`meals_id`),
  ADD KEY `meals_ingredients_ingredients_id` (`ingredients_id`);

--
-- Indexes for table `meals_names`
--
ALTER TABLE `meals_names`
  ADD PRIMARY KEY (`id`),
  ADD KEY `meals_names_id` (`meals_id`),
  ADD KEY `meals_names_locale_index` (`locale`) USING BTREE;

--
-- Indexes for table `meals_tags`
--
ALTER TABLE `meals_tags`
  ADD PRIMARY KEY (`id`),
  ADD KEY `meals_tags_meals_id` (`meals_id`),
  ADD KEY `meals_tags_tags_id` (`tags_id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags_names`
--
ALTER TABLE `tags_names`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tags_names_tags_id` (`tags_id`),
  ADD KEY `locale` (`locale`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `category_names`
--
ALTER TABLE `category_names`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `ingredients_names`
--
ALTER TABLE `ingredients_names`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `meals`
--
ALTER TABLE `meals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `meals_ingredients`
--
ALTER TABLE `meals_ingredients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `meals_names`
--
ALTER TABLE `meals_names`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `meals_tags`
--
ALTER TABLE `meals_tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tags_names`
--
ALTER TABLE `tags_names`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `category_names`
--
ALTER TABLE `category_names`
  ADD CONSTRAINT `category_names_category_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ingredients_names`
--
ALTER TABLE `ingredients_names`
  ADD CONSTRAINT `ingredients_names_ingredients_id` FOREIGN KEY (`ingredients_id`) REFERENCES `ingredients` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `meals`
--
ALTER TABLE `meals`
  ADD CONSTRAINT `meals_category_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `meals_ingredients`
--
ALTER TABLE `meals_ingredients`
  ADD CONSTRAINT `meals_ingredients_ingredients_id` FOREIGN KEY (`ingredients_id`) REFERENCES `ingredients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `meals_ingredients_meals_id` FOREIGN KEY (`meals_id`) REFERENCES `meals` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `meals_names`
--
ALTER TABLE `meals_names`
  ADD CONSTRAINT `meals_names_id` FOREIGN KEY (`meals_id`) REFERENCES `meals` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `meals_tags`
--
ALTER TABLE `meals_tags`
  ADD CONSTRAINT `meals_tags_meals_id` FOREIGN KEY (`meals_id`) REFERENCES `meals` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `meals_tags_tags_id` FOREIGN KEY (`tags_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tags_names`
--
ALTER TABLE `tags_names`
  ADD CONSTRAINT `tag_id` FOREIGN KEY (`tags_id`) REFERENCES `tags` (`id`),
  ADD CONSTRAINT `tags_names_tags_id` FOREIGN KEY (`tags_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
