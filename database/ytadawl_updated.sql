-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 30, 2021 at 01:11 AM
-- Server version: 8.0.18
-- PHP Version: 7.4.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ytadawl_new`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts_groups`
--

DROP TABLE IF EXISTS `accounts_groups`;
CREATE TABLE IF NOT EXISTS `accounts_groups` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `parent_group` bigint(20) UNSIGNED NOT NULL,
  `group_code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `group_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `group_name_en` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `can_edited` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `accounts_groups_group_code_unique` (`group_code`),
  KEY `accounts_groups_parent_group_foreign` (`parent_group`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `accounts_tree`
--

DROP TABLE IF EXISTS `accounts_tree`;
CREATE TABLE IF NOT EXISTS `accounts_tree` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `account_number` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_name_en` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `acc_group_code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `balance_type` enum('cr','dr') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'dr' COMMENT 'cr =credit,dr=debit',
  `opening_balance` decimal(13,4) DEFAULT '0.0000',
  `current_balance` decimal(13,4) DEFAULT '0.0000',
  `is_bank_cash` tinyint(1) DEFAULT '0',
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `accounts_tree_account_number_unique` (`account_number`),
  UNIQUE KEY `accounts_tree_account_name_unique` (`account_name`),
  KEY `accounts_tree_acc_group_code_foreign` (`acc_group_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

DROP TABLE IF EXISTS `activity_log`;
CREATE TABLE IF NOT EXISTS `activity_log` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `log_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject_id` bigint(20) UNSIGNED DEFAULT NULL,
  `causer_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `causer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `properties` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `subject` (`subject_type`,`subject_id`),
  KEY `causer` (`causer_type`,`causer_id`),
  KEY `activity_log_log_name_index` (`log_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('PUBLISHED','DRAFT') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'PUBLISHED',
  `date` date NOT NULL,
  `featured` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `article_tag`
--

DROP TABLE IF EXISTS `article_tag`;
CREATE TABLE IF NOT EXISTS `article_tag` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `article_id` int(10) UNSIGNED NOT NULL,
  `tag_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `badges`
--

DROP TABLE IF EXISTS `badges`;
CREATE TABLE IF NOT EXISTS `badges` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `img_path` mediumtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `badges`
--

INSERT INTO `badges` (`id`, `name`, `description`, `img_path`, `created_at`, `updated_at`) VALUES
(1, '{\"ar\":\"\\u0630\\u0647\\u0628\\u064a\"}', '{\"ar\":\"\\u0630\\u0647\\u0628\\u064a\"}', 'storage/badges/d5cc8bd9ee170f05be7f6352939c9920.png', '2021-04-22 16:18:55', '2021-04-22 16:18:55'),
(2, '{\"ar\":\"\\u0641\\u0636\\u064a\"}', '{\"ar\":null}', 'storage/badges/21e80478e01efc0cf10c78f09030fe65.png', '2021-04-22 16:19:08', '2021-04-22 16:19:08'),
(3, '{\"ar\":\"\\u0628\\u0631\\u0648\\u0646\\u0632\\u064a\"}', '{\"ar\":null}', 'storage/badges/3387754aebc03486d33314395bb519b2.png', '2021-04-22 16:19:24', '2021-04-22 16:19:24');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT '0',
  `lft` int(10) UNSIGNED DEFAULT NULL,
  `rgt` int(10) UNSIGNED DEFAULT NULL,
  `depth` int(10) UNSIGNED DEFAULT NULL,
  `name` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

DROP TABLE IF EXISTS `cities`;
CREATE TABLE IF NOT EXISTS `cities` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_en` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` decimal(11,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `timezone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_name_city_country_code_unique` (`name`,`country_code`),
  KEY `cities_country_code_foreign` (`country_code`)
) ENGINE=InnoDB AUTO_INCREMENT=576 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`, `name_en`, `country_code`, `latitude`, `longitude`, `timezone`, `active`, `created_at`, `updated_at`) VALUES
(255, 'زنجبار', 'زنجبار', 'YE', '13.12870026', '45.38069916', 'Asia/Aden', 1, NULL, NULL),
(256, 'زبيد', 'زبيد', 'YE', '14.19509983', '43.31520081', 'Asia/Aden', 1, NULL, NULL),
(257, 'يريم', 'يريم', 'YE', '14.29800034', '44.37789917', 'Asia/Aden', 1, NULL, NULL),
(258, 'تعز', 'تعز', 'YE', '13.57950020', '44.02090073', 'Asia/Aden', 1, NULL, NULL),
(259, 'سيان', 'سيان', 'YE', '15.17179966', '44.32440186', 'Asia/Aden', 1, NULL, NULL),
(260, 'صنعاء', 'صنعاء', 'YE', '15.35470009', '44.20669937', 'Asia/Aden', 1, NULL, NULL),
(261, 'سحار', 'سحار', 'YE', '15.31639957', '44.30879974', 'Asia/Aden', 1, NULL, NULL),
(262, 'صعدة', 'صعدة', 'YE', '16.94020081', '43.76390076', 'Asia/Aden', 1, NULL, NULL),
(263, 'مارب', 'مارب', 'YE', '15.46249962', '45.32580185', 'Asia/Aden', 1, NULL, NULL),
(264, 'لحج', 'لحج', 'YE', '13.05669975', '44.88190079', 'Asia/Aden', 1, NULL, NULL),
(265, 'جوف المغبة', 'جوف المغبة', 'YE', '13.83780003', '45.83489990', 'Asia/Aden', 1, NULL, NULL),
(266, 'اب', 'اب', 'YE', '13.96669960', '44.18330002', 'Asia/Aden', 1, NULL, NULL),
(267, 'حجة', 'حجة', 'YE', '15.69429970', '43.60580063', 'Asia/Aden', 1, NULL, NULL),
(268, 'حديبو', 'حديبو', 'YE', '12.64879990', '54.01900101', 'Asia/Aden', 1, NULL, NULL),
(269, 'ذي السفال', 'ذي السفال', 'YE', '13.83450031', '44.11470032', 'Asia/Aden', 1, NULL, NULL),
(270, 'ذمار', 'ذمار', 'YE', '14.54269981', '44.40510178', 'Asia/Aden', 1, NULL, NULL),
(271, 'بيت الفقيه', 'بيت الفقيه', 'YE', '14.51630020', '43.32450104', 'Asia/Aden', 1, NULL, NULL),
(272, 'باجل', 'باجل', 'YE', '15.05900002', '43.28730011', 'Asia/Aden', 1, NULL, NULL),
(273, 'عتق', 'عتق', 'YE', '14.53769970', '46.83190155', 'Asia/Aden', 1, NULL, NULL),
(274, 'عمران', 'عمران', 'YE', '15.65939999', '43.94390106', 'Asia/Aden', 1, NULL, NULL),
(275, 'المكلا', 'المكلا', 'YE', '14.54249954', '49.12419891', 'Asia/Aden', 1, NULL, NULL),
(276, 'المحويت', 'المحويت', 'YE', '15.47010040', '43.54479980', 'Asia/Aden', 1, NULL, NULL),
(277, 'الحديدة', 'الحديدة', 'YE', '14.79780006', '42.95449829', 'Asia/Aden', 1, NULL, NULL),
(278, 'الحزم', 'الحزم', 'YE', '16.16410065', '44.77690125', 'Asia/Aden', 1, NULL, NULL),
(279, 'الغيضة', 'الغيضة', 'YE', '16.20789909', '52.17599869', 'Asia/Aden', 1, NULL, NULL),
(280, 'البيضاء', 'البيضاء', 'YE', '13.98519993', '45.57270050', 'Asia/Aden', 1, NULL, NULL),
(281, 'الضالع', 'الضالع', 'YE', '13.69569969', '44.73139954', 'Asia/Aden', 1, NULL, NULL),
(282, 'ينبع', 'ينبع', 'SA', '24.08950043', '38.06179810', 'Asia/Riyadh', 1, NULL, NULL),
(283, 'ام لاج', 'ام لاج', 'SA', '25.02129936', '37.26850128', 'Asia/Riyadh', 1, NULL, NULL),
(284, 'ام السحيق', 'ام السحيق', 'SA', '26.65360069', '49.91640091', 'Asia/Riyadh', 1, NULL, NULL),
(285, 'Turaif', 'Turaif', 'SA', '31.67250061', '38.66370010', 'Asia/Riyadh', 1, NULL, NULL),
(286, 'طرابة', 'طرابة', 'SA', '21.21409988', '41.63309860', 'Asia/Riyadh', 1, NULL, NULL),
(287, 'At Tūbī', 'At Tūbī', 'SA', '26.55780029', '49.99169922', 'Asia/Riyadh', 1, NULL, NULL),
(288, 'Tārūt', 'Tārūt', 'SA', '26.57329941', '50.04029846', 'Asia/Riyadh', 1, NULL, NULL),
(289, 'Tanūmah', 'Tanūmah', 'SA', '27.10000038', '44.13330078', 'Asia/Riyadh', 1, NULL, NULL),
(290, 'Tabuk', 'Tabuk', 'SA', '28.39979935', '36.57149887', 'Asia/Riyadh', 1, NULL, NULL),
(291, 'Ţubarjal', 'Ţubarjal', 'SA', '30.49990082', '38.21599960', 'Asia/Riyadh', 1, NULL, NULL),
(292, 'Tabālah', 'Tabālah', 'SA', '19.95000076', '42.40000153', 'Asia/Riyadh', 1, NULL, NULL),
(293, 'Sulţānah', 'Sulţānah', 'SA', '24.49259949', '39.58570099', 'Asia/Riyadh', 1, NULL, NULL),
(294, 'Sayhāt', 'Sayhāt', 'SA', '26.48340034', '50.04850006', 'Asia/Riyadh', 1, NULL, NULL),
(295, 'Şāmitah', 'Şāmitah', 'SA', '16.59600067', '42.94440079', 'Asia/Riyadh', 1, NULL, NULL),
(296, 'Sakakah', 'Sakakah', 'SA', '29.96969986', '40.20640182', 'Asia/Riyadh', 1, NULL, NULL),
(297, 'Şafwá', 'Şafwá', 'SA', '26.64970016', '49.95520020', 'Asia/Riyadh', 1, NULL, NULL),
(298, 'Şabyā', 'Şabyā', 'SA', '17.14949989', '42.62540054', 'Asia/Riyadh', 1, NULL, NULL),
(299, 'Raḩīmah', 'Raḩīmah', 'SA', '26.70789909', '50.06190109', 'Asia/Riyadh', 1, NULL, NULL),
(300, 'Rābigh', 'Rābigh', 'SA', '22.79859924', '39.03490067', 'Asia/Riyadh', 1, NULL, NULL),
(301, 'Qal‘at Bīshah', 'Qal‘at Bīshah', 'SA', '20.00049973', '42.60520172', 'Asia/Riyadh', 1, NULL, NULL),
(302, 'Najrān', 'Najrān', 'SA', '17.49329948', '44.12770081', 'Asia/Riyadh', 1, NULL, NULL),
(303, 'Mulayjah', 'Mulayjah', 'SA', '27.27099991', '48.42419815', 'Asia/Riyadh', 1, NULL, NULL),
(304, 'Mislīyah', 'Mislīyah', 'SA', '17.45989990', '42.55720139', 'Asia/Riyadh', 1, NULL, NULL),
(305, 'Marāt', 'Marāt', 'SA', '25.07060051', '45.45769882', 'Asia/Riyadh', 1, NULL, NULL),
(306, 'Mecca', 'Mecca', 'SA', '21.42659950', '39.82559967', 'Asia/Riyadh', 1, NULL, NULL),
(307, 'Khamis Mushait', 'Khamis Mushait', 'SA', '18.29999924', '42.73329926', 'Asia/Riyadh', 1, NULL, NULL),
(308, 'Julayjilah', 'Julayjilah', 'SA', '25.50000000', '49.59999847', 'Asia/Riyadh', 1, NULL, NULL),
(309, 'Jizan', 'Jizan', 'SA', '16.88920021', '42.55110168', 'Asia/Riyadh', 1, NULL, NULL),
(310, 'Jeddah', 'Jeddah', 'SA', '21.54240036', '39.19800186', 'Asia/Riyadh', 1, NULL, NULL),
(311, 'Ha\'il', 'Ha\'il', 'SA', '27.52190018', '41.69070053', 'Asia/Riyadh', 1, NULL, NULL),
(312, 'Hafar Al-Batin', 'Hafar Al-Batin', 'SA', '28.43280029', '45.97079849', 'Asia/Riyadh', 1, NULL, NULL),
(313, 'Farasān', 'Farasān', 'SA', '16.70219994', '42.11830139', 'Asia/Riyadh', 1, NULL, NULL),
(314, 'Duba', 'Duba', 'SA', '27.35129929', '35.69010162', 'Asia/Riyadh', 1, NULL, NULL),
(315, 'Buraydah', 'Buraydah', 'SA', '26.32600021', '43.97499847', 'Asia/Riyadh', 1, NULL, NULL),
(316, 'Abqaiq', 'Abqaiq', 'SA', '25.93400002', '49.66880035', 'Asia/Riyadh', 1, NULL, NULL),
(317, 'Badr Ḩunayn', 'Badr Ḩunayn', 'SA', '23.78289986', '38.79050064', 'Asia/Riyadh', 1, NULL, NULL),
(318, 'Az Zulfī', 'Az Zulfī', 'SA', '26.29940033', '44.81539917', 'Asia/Riyadh', 1, NULL, NULL),
(319, 'Dhahran', 'Dhahran', 'SA', '26.28860092', '50.11399841', 'Asia/Riyadh', 1, NULL, NULL),
(320, 'Aţ Ţaraf', 'Aţ Ţaraf', 'SA', '25.36230087', '49.72760010', 'Asia/Riyadh', 1, NULL, NULL),
(321, 'Ta’if', 'Ta’if', 'SA', '21.27029991', '40.41579819', 'Asia/Riyadh', 1, NULL, NULL),
(322, 'As Sulayyil', 'As Sulayyil', 'SA', '20.46069908', '45.57789993', 'Asia/Riyadh', 1, NULL, NULL),
(323, 'Sājir', 'Sājir', 'SA', '25.18250084', '44.59960175', 'Asia/Riyadh', 1, NULL, NULL),
(324, 'As Saffānīyah', 'As Saffānīyah', 'SA', '27.97080040', '48.72999954', 'Asia/Riyadh', 1, NULL, NULL),
(325, 'Riyadh', 'Riyadh', 'SA', '24.68770027', '46.72190094', 'Asia/Riyadh', 1, NULL, NULL),
(326, 'Ar Rass', 'Ar Rass', 'SA', '25.86940002', '43.49729919', 'Asia/Riyadh', 1, NULL, NULL),
(327, 'Arar', 'Arar', 'SA', '30.97529984', '41.03810120', 'Asia/Riyadh', 1, NULL, NULL),
(328, 'An Nimāş', 'An Nimāş', 'SA', '19.14550018', '42.12009811', 'Asia/Riyadh', 1, NULL, NULL),
(329, 'Qurayyat', 'Qurayyat', 'SA', '31.33180046', '37.34280014', 'Asia/Riyadh', 1, NULL, NULL),
(330, 'Al Wajh', 'Al Wajh', 'SA', '26.24550056', '36.45249939', 'Asia/Riyadh', 1, NULL, NULL),
(331, 'Al-`Ula', 'Al-`Ula', 'SA', '26.60849953', '37.92319870', 'Asia/Riyadh', 1, NULL, NULL),
(332, 'Al Qurayn', 'Al Qurayn', 'SA', '25.48329926', '49.59999847', 'Asia/Riyadh', 1, NULL, NULL),
(333, 'Qaisumah', 'Qaisumah', 'SA', '28.31119919', '46.12730026', 'Asia/Riyadh', 1, NULL, NULL),
(334, 'Al Qaţīf', 'Al Qaţīf', 'SA', '26.56539917', '50.00889969', 'Asia/Riyadh', 1, NULL, NULL),
(335, 'Al Qārah', 'Al Qārah', 'SA', '25.41670036', '49.66669846', 'Asia/Riyadh', 1, NULL, NULL),
(336, 'Al Muţayrifī', 'Al Muţayrifī', 'SA', '25.47879982', '49.55820084', 'Asia/Riyadh', 1, NULL, NULL),
(337, 'Al Munayzilah', 'Al Munayzilah', 'SA', '25.38330078', '49.66669846', 'Asia/Riyadh', 1, NULL, NULL),
(338, 'Al Mubarraz', 'Al Mubarraz', 'SA', '25.40769958', '49.59030151', 'Asia/Riyadh', 1, NULL, NULL),
(339, 'Al Mindak', 'Al Mindak', 'SA', '20.15880013', '41.28340149', 'Asia/Riyadh', 1, NULL, NULL),
(340, 'Al Mithnab', 'Al Mithnab', 'SA', '25.86009979', '44.22230148', 'Asia/Riyadh', 1, NULL, NULL),
(341, 'Al Markaz', 'Al Markaz', 'SA', '25.39999962', '49.73329926', 'Asia/Riyadh', 1, NULL, NULL),
(342, 'Medina', 'Medina', 'SA', '24.46859932', '39.61420059', 'Asia/Riyadh', 1, NULL, NULL),
(343, 'Khobar', 'Khobar', 'SA', '26.27939987', '50.20830154', 'Asia/Riyadh', 1, NULL, NULL),
(344, 'Al Kharj', 'Al Kharj', 'SA', '24.15539932', '47.33459854', 'Asia/Riyadh', 1, NULL, NULL),
(345, 'Al Khafjī', 'Al Khafjī', 'SA', '28.43910027', '48.49129868', 'Asia/Riyadh', 1, NULL, NULL),
(346, 'Al Jumūm', 'Al Jumūm', 'SA', '21.61689949', '39.69810104', 'Asia/Riyadh', 1, NULL, NULL),
(347, 'Al Jubayl', 'Al Jubayl', 'SA', '27.01740074', '49.62250137', 'Asia/Riyadh', 1, NULL, NULL),
(349, 'Al Jarādīyah', 'Al Jarādīyah', 'SA', '16.57950020', '42.91239929', 'Asia/Riyadh', 1, NULL, NULL),
(350, 'Al Jafr', 'Al Jafr', 'SA', '25.37739944', '49.72150040', 'Asia/Riyadh', 1, NULL, NULL),
(351, 'Al Hufūf', 'Al Hufūf', 'SA', '25.36470032', '49.58760071', 'Asia/Riyadh', 1, NULL, NULL),
(352, 'Al Bukayrīyah', 'Al Bukayrīyah', 'SA', '26.13920021', '43.65779877', 'Asia/Riyadh', 1, NULL, NULL),
(353, 'Al Baţţālīyah', 'Al Baţţālīyah', 'SA', '25.43330002', '49.63330078', 'Asia/Riyadh', 1, NULL, NULL),
(354, 'Al Bahah', 'Al Bahah', 'SA', '20.01289940', '41.46770096', 'Asia/Riyadh', 1, NULL, NULL),
(355, 'Al Arţāwīyah', 'Al Arţāwīyah', 'SA', '26.50390053', '45.34809875', 'Asia/Riyadh', 1, NULL, NULL),
(356, 'Al Awjām', 'Al Awjām', 'SA', '26.56320000', '49.94329834', 'Asia/Riyadh', 1, NULL, NULL),
(357, 'Afif', 'Afif', 'SA', '23.90649986', '42.91719818', 'Asia/Riyadh', 1, NULL, NULL),
(358, 'Adh Dhibiyah', 'Adh Dhibiyah', 'SA', '26.02700043', '43.15700150', 'Asia/Riyadh', 1, NULL, NULL),
(359, 'Ad Dilam', 'Ad Dilam', 'SA', '23.99099922', '47.16180038', 'Asia/Riyadh', 1, NULL, NULL),
(360, 'Ad Dawādimī', 'Ad Dawādimī', 'SA', '24.50769997', '44.39239883', 'Asia/Riyadh', 1, NULL, NULL),
(361, 'Ad Darb', 'Ad Darb', 'SA', '17.72290039', '42.25260162', 'Asia/Riyadh', 1, NULL, NULL),
(362, 'Dammam', 'Dammam', 'SA', '26.43440056', '50.10329819', 'Asia/Riyadh', 1, NULL, NULL),
(363, 'Abū ‘Arīsh', 'Abū ‘Arīsh', 'SA', '16.96890068', '42.83250046', 'Asia/Riyadh', 1, NULL, NULL),
(364, 'Abha', 'Abha', 'SA', '18.21640015', '42.50529861', 'Asia/Riyadh', 1, NULL, NULL),
(365, 'Janūb as Surrah', 'Janūb as Surrah', 'KW', '29.26919937', '47.97809982', 'Asia/Kuwait', 1, NULL, NULL),
(366, 'حوالي', 'حوالي', 'KW', '29.33279991', '48.02859879', 'Asia/Kuwait', 1, NULL, NULL),
(367, 'بيان', 'بيان', 'KW', '29.30319977', '48.04880142', 'Asia/Kuwait', 1, NULL, NULL),
(368, 'الزاوار', 'الزاوار', 'KW', '29.44249916', '48.27470016', 'Asia/Kuwait', 1, NULL, NULL),
(369, 'As Sālimīyah', 'As Sālimīyah', 'KW', '29.33390045', '48.07609940', 'Asia/Kuwait', 1, NULL, NULL),
(370, 'Ash Shāmīyah', 'Ash Shāmīyah', 'KW', '29.34720039', '47.96170044', 'Asia/Kuwait', 1, NULL, NULL),
(371, 'Ar Rumaythīyah', 'Ar Rumaythīyah', 'KW', '29.31170082', '48.07419968', 'Asia/Kuwait', 1, NULL, NULL),
(372, 'Ar Riqqah', 'Ar Riqqah', 'KW', '29.14579964', '48.09469986', 'Asia/Kuwait', 1, NULL, NULL),
(373, 'Al Wafrah', 'Al Wafrah', 'KW', '28.63920021', '47.93059921', 'Asia/Kuwait', 1, NULL, NULL),
(374, 'Al Manqaf', 'Al Manqaf', 'KW', '29.09609985', '48.13280106', 'Asia/Kuwait', 1, NULL, NULL),
(375, 'Al Mahbūlah', 'Al Mahbūlah', 'KW', '29.14500046', '48.13029861', 'Asia/Kuwait', 1, NULL, NULL),
(376, 'Kuwait City', 'Kuwait City', 'KW', '29.36969948', '47.97829819', 'Asia/Kuwait', 1, NULL, NULL),
(377, 'Al Jahrā’', 'Al Jahrā’', 'KW', '29.33749962', '47.65810013', 'Asia/Kuwait', 1, NULL, NULL),
(378, 'Al Faḩāḩīl', 'Al Faḩāḩīl', 'KW', '29.08250046', '48.13029861', 'Asia/Kuwait', 1, NULL, NULL),
(379, 'Al Finţās', 'Al Finţās', 'KW', '29.17390060', '48.12110138', 'Asia/Kuwait', 1, NULL, NULL),
(380, 'Al Farwānīyah', 'Al Farwānīyah', 'KW', '29.27750015', '47.95859909', 'Asia/Kuwait', 1, NULL, NULL),
(381, 'Al Aḩmadī', 'Al Aḩmadī', 'KW', '29.07690048', '48.08390045', 'Asia/Kuwait', 1, NULL, NULL),
(382, 'Ad Dasmah', 'Ad Dasmah', 'KW', '29.36499977', '48.00139999', 'Asia/Kuwait', 1, NULL, NULL),
(383, 'Sur', 'Sur', 'OM', '22.56669998', '59.52890015', 'Asia/Muscat', 1, NULL, NULL),
(384, 'Sohar', 'Sohar', 'OM', '24.34749985', '56.70940018', 'Asia/Muscat', 1, NULL, NULL),
(385, 'Sufālat Samā’il', 'Sufālat Samā’il', 'OM', '23.31669998', '58.01670074', 'Asia/Muscat', 1, NULL, NULL),
(386, 'Shināş', 'Shināş', 'OM', '24.74259949', '56.46699905', 'Asia/Muscat', 1, NULL, NULL),
(387, 'Şalālah', 'Şalālah', 'OM', '17.01510048', '54.09239960', 'Asia/Muscat', 1, NULL, NULL),
(388, 'Şaḩam', 'Şaḩam', 'OM', '24.17219925', '56.88859940', 'Asia/Muscat', 1, NULL, NULL),
(389, 'Nizwá', 'Nizwá', 'OM', '22.93330002', '57.53329849', 'Asia/Muscat', 1, NULL, NULL),
(390, 'Muscat', 'Muscat', 'OM', '23.58410072', '58.40779877', 'Asia/Muscat', 1, NULL, NULL),
(391, 'Khasab', 'Khasab', 'OM', '26.17989922', '56.24769974', 'Asia/Muscat', 1, NULL, NULL),
(392, 'Izkī', 'Izkī', 'OM', '22.93330002', '57.76670074', 'Asia/Muscat', 1, NULL, NULL),
(393, '‘Ibrī', '‘Ibrī', 'OM', '23.22570038', '56.51570129', 'Asia/Muscat', 1, NULL, NULL),
(394, 'Ibrā’', 'Ibrā’', 'OM', '22.69059944', '58.53340149', 'Asia/Muscat', 1, NULL, NULL),
(395, 'Haymā’', 'Haymā’', 'OM', '19.95929909', '56.27569962', 'Asia/Muscat', 1, NULL, NULL),
(396, 'Bidbid', 'Bidbid', 'OM', '23.40789986', '58.12829971', 'Asia/Muscat', 1, NULL, NULL),
(397, 'Bawshar', 'Bawshar', 'OM', '23.57769966', '58.39979935', 'Asia/Muscat', 1, NULL, NULL),
(398, 'Barkā’', 'Barkā’', 'OM', '23.67869949', '57.88610077', 'Asia/Muscat', 1, NULL, NULL),
(399, 'Bahlā’', 'Bahlā’', 'OM', '22.97890091', '57.30469894', 'Asia/Muscat', 1, NULL, NULL),
(400, 'Badīyah', 'Badīyah', 'OM', '22.45000076', '58.79999924', 'Asia/Muscat', 1, NULL, NULL),
(401, 'As Suwayq', 'As Suwayq', 'OM', '23.84939957', '57.43859863', 'Asia/Muscat', 1, NULL, NULL),
(402, 'Seeb', 'Seeb', 'OM', '23.67029953', '58.18909836', 'Asia/Muscat', 1, NULL, NULL),
(403, 'Rustaq', 'Rustaq', 'OM', '23.39080048', '57.42440033', 'Asia/Muscat', 1, NULL, NULL),
(404, 'Al Qābil', 'Al Qābil', 'OM', '22.57099915', '58.69469833', 'Asia/Muscat', 1, NULL, NULL),
(405, 'Liwá', 'Liwá', 'OM', '24.53079987', '56.56299973', 'Asia/Muscat', 1, NULL, NULL),
(406, 'Al Khābūrah', 'Al Khābūrah', 'OM', '23.97139931', '57.09310150', 'Asia/Muscat', 1, NULL, NULL),
(407, 'Al Buraymī', 'Al Buraymī', 'OM', '24.25090027', '55.79309845', 'Asia/Muscat', 1, NULL, NULL),
(408, 'Adam', 'Adam', 'OM', '22.37929916', '57.52719879', 'Asia/Muscat', 1, NULL, NULL),
(409, 'Umm Al Quwain City', 'Umm Al Quwain City', 'AE', '25.56469917', '55.55519867', 'Asia/Dubai', 1, NULL, NULL),
(410, 'Ras Al Khaimah City', 'Ras Al Khaimah City', 'AE', '25.78949928', '55.94319916', 'Asia/Dubai', 1, NULL, NULL),
(411, 'Muzayri‘', 'Muzayri‘', 'AE', '23.14360046', '53.78810120', 'Asia/Dubai', 1, NULL, NULL),
(412, 'Zayed City', 'Zayed City', 'AE', '23.65419960', '53.70520020', 'Asia/Dubai', 1, NULL, NULL),
(413, 'Khawr Fakkān', 'Khawr Fakkān', 'AE', '25.33130074', '56.34199905', 'Asia/Dubai', 1, NULL, NULL),
(414, 'Dubai', 'Dubai', 'AE', '25.06570053', '55.17129898', 'Asia/Dubai', 1, NULL, NULL),
(415, 'Dibba Al-Fujairah', 'Dibba Al-Fujairah', 'AE', '25.59250069', '56.26179886', 'Asia/Dubai', 1, NULL, NULL),
(416, 'Dibba Al-Hisn', 'Dibba Al-Hisn', 'AE', '25.61960030', '56.27289963', 'Asia/Dubai', 1, NULL, NULL),
(417, 'Sharjah', 'Sharjah', 'AE', '25.33740044', '55.41210175', 'Asia/Dubai', 1, NULL, NULL),
(418, 'Ar Ruways', 'Ar Ruways', 'AE', '24.11030006', '52.73059845', 'Asia/Dubai', 1, NULL, NULL),
(419, 'Al Fujairah City', 'Al Fujairah City', 'AE', '25.11639977', '56.34140015', 'Asia/Dubai', 1, NULL, NULL),
(420, 'Al Ain City', 'Al Ain City', 'AE', '24.19169998', '55.76060104', 'Asia/Dubai', 1, NULL, NULL),
(421, 'Ajman City', 'Ajman City', 'AE', '25.40180016', '55.47880173', 'Asia/Dubai', 1, NULL, NULL),
(422, 'Adh Dhayd', 'Adh Dhayd', 'AE', '25.28809929', '55.88159943', 'Asia/Dubai', 1, NULL, NULL),
(423, 'Abu Dhabi', 'Abu Dhabi', 'AE', '24.46669960', '54.36669922', 'Asia/Dubai', 1, NULL, NULL),
(424, 'Zefta', 'Zefta', 'EG', '30.71419907', '31.24419975', 'Africa/Cairo', 1, NULL, NULL),
(425, 'Toukh', 'Toukh', 'EG', '30.35490036', '31.20100021', 'Africa/Cairo', 1, NULL, NULL),
(426, 'Tanda', 'Tanda', 'EG', '30.78849983', '31.00189972', 'Africa/Cairo', 1, NULL, NULL),
(427, 'Ţāmiyah', 'Ţāmiyah', 'EG', '29.47640038', '30.96120071', 'Africa/Cairo', 1, NULL, NULL),
(428, 'Ţalkhā', 'Ţalkhā', 'EG', '31.05389977', '31.37789917', 'Africa/Cairo', 1, NULL, NULL),
(429, 'Talā', 'Talā', 'EG', '30.67980003', '30.94359970', 'Africa/Cairo', 1, NULL, NULL),
(430, 'Ţahţā', 'Ţahţā', 'EG', '26.76930046', '31.50209999', 'Africa/Cairo', 1, NULL, NULL),
(431, 'Sumusţā as Sulţānī', 'Sumusţā as Sulţānī', 'EG', '28.91670036', '30.85000038', 'Africa/Cairo', 1, NULL, NULL),
(432, 'Sohag', 'Sohag', 'EG', '26.55690002', '31.69479942', 'Africa/Cairo', 1, NULL, NULL),
(433, 'Siwa Oasis', 'Siwa Oasis', 'EG', '29.20319939', '25.51959991', 'Africa/Cairo', 1, NULL, NULL),
(434, 'Sīdī Sālim', 'Sīdī Sālim', 'EG', '31.27129936', '30.78619957', 'Africa/Cairo', 1, NULL, NULL),
(435, 'Shirbīn', 'Shirbīn', 'EG', '31.19689941', '31.52429962', 'Africa/Cairo', 1, NULL, NULL),
(436, 'Shibīn al Qanāṭir', 'Shibīn al Qanāṭir', 'EG', '30.31270027', '31.32019997', 'Africa/Cairo', 1, NULL, NULL),
(437, 'Shibīn al Kawm', 'Shibīn al Kawm', 'EG', '30.55260086', '31.00900078', 'Africa/Cairo', 1, NULL, NULL),
(438, 'Sharm el-Sheikh', 'Sharm el-Sheikh', 'EG', '27.91580009', '34.32989883', 'Africa/Cairo', 1, NULL, NULL),
(439, 'Samannūd', 'Samannūd', 'EG', '30.96159935', '31.24069977', 'Africa/Cairo', 1, NULL, NULL),
(440, 'Samālūţ', 'Samālūţ', 'EG', '28.31209946', '30.71010017', 'Africa/Cairo', 1, NULL, NULL),
(441, 'Rosetta', 'Rosetta', 'EG', '31.39949989', '30.41720009', 'Africa/Cairo', 1, NULL, NULL),
(442, 'Ras Gharib', 'Ras Gharib', 'EG', '28.35829926', '33.07830048', 'Africa/Cairo', 1, NULL, NULL),
(443, 'Quwaysinā', 'Quwaysinā', 'EG', '30.56480026', '31.15780067', 'Africa/Cairo', 1, NULL, NULL),
(444, 'Quţūr', 'Quţūr', 'EG', '30.97220039', '30.95610046', 'Africa/Cairo', 1, NULL, NULL),
(445, 'Kousa', 'Kousa', 'EG', '25.91410065', '32.76359940', 'Africa/Cairo', 1, NULL, NULL),
(446, 'Qinā', 'Qinā', 'EG', '26.16419983', '32.72669983', 'Africa/Cairo', 1, NULL, NULL),
(447, 'Qalyūb', 'Qalyūb', 'EG', '30.17919922', '31.20560074', 'Africa/Cairo', 1, NULL, NULL),
(448, 'Naja\' Ḥammādī', 'Naja\' Ḥammādī', 'EG', '26.04949951', '32.24140167', 'Africa/Cairo', 1, NULL, NULL),
(449, 'Minyat an Naşr', 'Minyat an Naşr', 'EG', '31.12619972', '31.64310074', 'Africa/Cairo', 1, NULL, NULL),
(450, 'Munūf', 'Munūf', 'EG', '30.46599960', '30.93199921', 'Africa/Cairo', 1, NULL, NULL),
(451, 'Maţāy', 'Maţāy', 'EG', '28.41900063', '30.77919960', 'Africa/Cairo', 1, NULL, NULL),
(452, 'Mashtūl as Sūq', 'Mashtūl as Sūq', 'EG', '30.36059952', '31.37759972', 'Africa/Cairo', 1, NULL, NULL),
(453, 'Mersa Matruh', 'Mersa Matruh', 'EG', '31.35289955', '27.23719978', 'Africa/Cairo', 1, NULL, NULL),
(454, 'Marsa Alam', 'Marsa Alam', 'EG', '25.06299973', '34.88999939', 'Africa/Cairo', 1, NULL, NULL),
(455, 'Manfalūţ', 'Manfalūţ', 'EG', '27.31040001', '30.96999931', 'Africa/Cairo', 1, NULL, NULL),
(456, 'Mallawī', 'Mallawī', 'EG', '27.73139954', '30.84169960', 'Africa/Cairo', 1, NULL, NULL),
(457, 'Madīnat Sittah Uktūbar', 'Madīnat Sittah Uktūbar', 'EG', '29.81669998', '31.04999924', 'Africa/Cairo', 1, NULL, NULL),
(458, 'Kawm Umbū', 'Kawm Umbū', 'EG', '24.47669983', '32.94630051', 'Africa/Cairo', 1, NULL, NULL),
(459, 'Kawm Ḩamādah', 'Kawm Ḩamādah', 'EG', '30.76129913', '30.69969940', 'Africa/Cairo', 1, NULL, NULL),
(460, 'Kafr Şaqr', 'Kafr Şaqr', 'EG', '30.79339981', '31.62570000', 'Africa/Cairo', 1, NULL, NULL),
(461, 'Kafr az Zayyāt', 'Kafr az Zayyāt', 'EG', '30.82480049', '30.81809998', 'Africa/Cairo', 1, NULL, NULL),
(462, 'Kafr ash Shaykh', 'Kafr ash Shaykh', 'EG', '31.11170006', '30.93989944', 'Africa/Cairo', 1, NULL, NULL),
(463, 'Kafr ad Dawwār', 'Kafr ad Dawwār', 'EG', '31.13380051', '30.12969971', 'Africa/Cairo', 1, NULL, NULL),
(464, 'Juhaynah', 'Juhaynah', 'EG', '26.67320061', '31.49760056', 'Africa/Cairo', 1, NULL, NULL),
(465, 'Jirjā', 'Jirjā', 'EG', '26.33830070', '31.89159966', 'Africa/Cairo', 1, NULL, NULL),
(466, '‘Izbat al Burj', '‘Izbat al Burj', 'EG', '31.50839996', '31.84110069', 'Africa/Cairo', 1, NULL, NULL),
(467, 'Iţsā', 'Iţsā', 'EG', '29.23760033', '30.78940010', 'Africa/Cairo', 1, NULL, NULL),
(468, 'Isnā', 'Isnā', 'EG', '25.29339981', '32.55400085', 'Africa/Cairo', 1, NULL, NULL),
(469, 'Idkū', 'Idkū', 'EG', '31.30730057', '30.29809952', 'Africa/Cairo', 1, NULL, NULL),
(470, 'Idfū', 'Idfū', 'EG', '24.97920036', '32.87720108', 'Africa/Cairo', 1, NULL, NULL),
(471, 'Ibshawāy', 'Ibshawāy', 'EG', '29.35899925', '30.68059921', 'Africa/Cairo', 1, NULL, NULL),
(472, 'Ḩalwān', 'Ḩalwān', 'EG', '29.84140015', '31.30080032', 'Africa/Cairo', 1, NULL, NULL),
(473, 'Hihyā', 'Hihyā', 'EG', '30.67130089', '31.58799934', 'Africa/Cairo', 1, NULL, NULL),
(474, 'Ḩawsh ‘Īsá', 'Ḩawsh ‘Īsá', 'EG', '30.91279984', '30.29019928', 'Africa/Cairo', 1, NULL, NULL),
(475, 'Fuwwah', 'Fuwwah', 'EG', '31.20359993', '30.54910088', 'Africa/Cairo', 1, NULL, NULL),
(476, 'Farshūţ', 'Farshūţ', 'EG', '26.05489922', '32.16329956', 'Africa/Cairo', 1, NULL, NULL),
(477, 'Fāraskūr', 'Fāraskūr', 'EG', '31.32979965', '31.71509933', 'Africa/Cairo', 1, NULL, NULL),
(478, 'Fāqūs', 'Fāqūs', 'EG', '30.72820091', '31.79700089', 'Africa/Cairo', 1, NULL, NULL),
(479, 'Damietta', 'Damietta', 'EG', '31.41650009', '31.81329918', 'Africa/Cairo', 1, NULL, NULL),
(480, 'Diyarb Najm', 'Diyarb Najm', 'EG', '30.75440025', '31.44020081', 'Africa/Cairo', 1, NULL, NULL),
(481, 'Disūq', 'Disūq', 'EG', '31.13260078', '30.64780045', 'Africa/Cairo', 1, NULL, NULL),
(482, 'Dishnā', 'Dishnā', 'EG', '26.12470055', '32.47600174', 'Africa/Cairo', 1, NULL, NULL),
(483, 'Dikirnis', 'Dikirnis', 'EG', '31.08900070', '31.59480095', 'Africa/Cairo', 1, NULL, NULL),
(484, 'Dahab', 'Dahab', 'EG', '28.48209953', '34.49499893', 'Africa/Cairo', 1, NULL, NULL),
(485, 'Dayrūţ', 'Dayrūţ', 'EG', '27.55599976', '30.80760002', 'Africa/Cairo', 1, NULL, NULL),
(486, 'Dayr Mawās', 'Dayr Mawās', 'EG', '27.64179993', '30.84659958', 'Africa/Cairo', 1, NULL, NULL),
(487, 'Damanhūr', 'Damanhūr', 'EG', '31.03409958', '30.46820068', 'Africa/Cairo', 1, NULL, NULL),
(488, 'Būsh', 'Būsh', 'EG', '29.14819908', '31.12730026', 'Africa/Cairo', 1, NULL, NULL),
(489, 'Port Said', 'Port Said', 'EG', '31.25650024', '32.28409958', 'Africa/Cairo', 1, NULL, NULL),
(490, 'Safaga', 'Safaga', 'EG', '26.74909973', '33.93889999', 'Africa/Cairo', 1, NULL, NULL),
(491, 'Bilqās', 'Bilqās', 'EG', '31.21450043', '31.35799980', 'Africa/Cairo', 1, NULL, NULL),
(492, 'Bilbays', 'Bilbays', 'EG', '30.42040062', '31.56220055', 'Africa/Cairo', 1, NULL, NULL),
(493, 'Basyūn', 'Basyūn', 'EG', '30.93980026', '30.81340027', 'Africa/Cairo', 1, NULL, NULL),
(494, 'Banī Suwayf', 'Banī Suwayf', 'EG', '29.07439995', '31.09790039', 'Africa/Cairo', 1, NULL, NULL),
(495, 'Banī Mazār', 'Banī Mazār', 'EG', '28.50359917', '30.80039978', 'Africa/Cairo', 1, NULL, NULL),
(496, 'Banhā', 'Banhā', 'EG', '30.45980072', '31.18420029', 'Africa/Cairo', 1, NULL, NULL),
(497, 'الزقازيق', 'الزقازيق', 'EG', '30.58769989', '31.50200081', 'Africa/Cairo', 1, NULL, NULL),
(498, 'Awsīm', 'Awsīm', 'EG', '30.12299919', '31.13570023', 'Africa/Cairo', 1, NULL, NULL),
(499, 'El-Tor', 'El-Tor', 'EG', '28.24169922', '33.62220001', 'Africa/Cairo', 1, NULL, NULL),
(500, 'At Tall al Kabīr', 'At Tall al Kabīr', 'EG', '30.54319954', '31.78499985', 'Africa/Cairo', 1, NULL, NULL),
(501, 'Asyūţ', 'Asyūţ', 'EG', '27.18099976', '31.18370056', 'Africa/Cairo', 1, NULL, NULL),
(502, 'Aswan', 'Aswan', 'EG', '24.09079933', '32.89939880', 'Africa/Cairo', 1, NULL, NULL),
(503, 'Suez', 'Suez', 'EG', '29.97369957', '32.52629852', 'Africa/Cairo', 1, NULL, NULL),
(504, 'Aş Şaff', 'Aş Şaff', 'EG', '29.56469917', '31.28109932', 'Africa/Cairo', 1, NULL, NULL),
(505, 'Ash Shuhadā’', 'Ash Shuhadā’', 'EG', '30.59679985', '30.89929962', 'Africa/Cairo', 1, NULL, NULL),
(506, 'Ashmūn', 'Ashmūn', 'EG', '30.29730034', '30.97640038', 'Africa/Cairo', 1, NULL, NULL),
(507, 'Al Wāsiţah', 'Al Wāsiţah', 'EG', '29.33779907', '31.20560074', 'Africa/Cairo', 1, NULL, NULL),
(508, 'Luxor', 'Luxor', 'EG', '25.69890022', '32.64210129', 'Africa/Cairo', 1, NULL, NULL),
(509, 'Al Qūşīyah', 'Al Qūşīyah', 'EG', '27.44020081', '30.81839943', 'Africa/Cairo', 1, NULL, NULL),
(510, 'Al Quşayr', 'Al Quşayr', 'EG', '26.10429955', '34.27790070', 'Africa/Cairo', 1, NULL, NULL),
(512, 'Al Qanāyāt', 'Al Qanāyāt', 'EG', '30.61930084', '31.46170044', 'Africa/Cairo', 1, NULL, NULL),
(513, 'Al Qanāţir al Khayrīyah', 'Al Qanāţir al Khayrīyah', 'EG', '30.19330025', '31.13699913', 'Africa/Cairo', 1, NULL, NULL),
(514, 'Cairo', 'Cairo', 'EG', '30.06259918', '31.24970055', 'Africa/Cairo', 1, NULL, NULL),
(515, 'Al Minyā', 'Al Minyā', 'EG', '28.10989952', '30.75029945', 'Africa/Cairo', 1, NULL, NULL),
(516, 'Al Maţarīyah', 'Al Maţarīyah', 'EG', '31.18289948', '32.03110123', 'Africa/Cairo', 1, NULL, NULL),
(517, 'Al Manzalah', 'Al Manzalah', 'EG', '31.15819931', '31.93600082', 'Africa/Cairo', 1, NULL, NULL),
(518, 'Al Manşūrah', 'Al Manşūrah', 'EG', '31.03639984', '31.38069916', 'Africa/Cairo', 1, NULL, NULL),
(519, 'Al Manshāh', 'Al Manshāh', 'EG', '26.47690010', '31.80349922', 'Africa/Cairo', 1, NULL, NULL),
(520, 'Al Maḩallah al Kubrá', 'Al Maḩallah al Kubrá', 'EG', '30.97060013', '31.16690063', 'Africa/Cairo', 1, NULL, NULL),
(521, 'Al Khārijah', 'Al Khārijah', 'EG', '25.45140076', '30.54640007', 'Africa/Cairo', 1, NULL, NULL),
(522, 'Al Khānkah', 'Al Khānkah', 'EG', '30.21039963', '31.36809921', 'Africa/Cairo', 1, NULL, NULL),
(523, 'Giza', 'Giza', 'EG', '30.00810051', '31.21089935', 'Africa/Cairo', 1, NULL, NULL),
(524, 'Al Jammālīyah', 'Al Jammālīyah', 'EG', '31.18070030', '31.86499977', 'Africa/Cairo', 1, NULL, NULL),
(525, 'Ismailia', 'Ismailia', 'EG', '30.60429955', '32.27230072', 'Africa/Cairo', 1, NULL, NULL),
(526, 'Alexandria', 'Alexandria', 'EG', '31.20179939', '29.91580009', 'Africa/Cairo', 1, NULL, NULL),
(527, 'Al Ibrāhīmīyah', 'Al Ibrāhīmīyah', 'EG', '30.71879959', '31.56299973', 'Africa/Cairo', 1, NULL, NULL),
(528, 'Al Ḩawāmidīyah', 'Al Ḩawāmidīyah', 'EG', '29.89999962', '31.25000000', 'Africa/Cairo', 1, NULL, NULL),
(529, 'Al Ḩāmūl', 'Al Ḩāmūl', 'EG', '31.31150055', '31.14769936', 'Africa/Cairo', 1, NULL, NULL),
(530, 'Hurghada', 'Hurghada', 'EG', '27.25740051', '33.81290054', 'Africa/Cairo', 1, NULL, NULL),
(531, 'Al Fayyūm', 'Al Fayyūm', 'EG', '29.30990028', '30.84180069', 'Africa/Cairo', 1, NULL, NULL),
(532, 'Al Fashn', 'Al Fashn', 'EG', '28.82430077', '30.89949989', 'Africa/Cairo', 1, NULL, NULL),
(533, 'Al Bawīţī', 'Al Bawīţī', 'EG', '28.34919930', '28.86590004', 'Africa/Cairo', 1, NULL, NULL),
(534, 'Al Balyanā', 'Al Balyanā', 'EG', '26.23570061', '32.00350189', 'Africa/Cairo', 1, NULL, NULL),
(535, 'Al Bājūr', 'Al Bājūr', 'EG', '30.43050003', '31.03680038', 'Africa/Cairo', 1, NULL, NULL),
(536, 'Al Badārī', 'Al Badārī', 'EG', '26.99259949', '31.41550064', 'Africa/Cairo', 1, NULL, NULL),
(537, 'Al ‘Ayyāţ', 'Al ‘Ayyāţ', 'EG', '29.61969948', '31.25749969', 'Africa/Cairo', 1, NULL, NULL),
(538, 'Arish', 'Arish', 'EG', '31.13159943', '33.79840088', 'Africa/Cairo', 1, NULL, NULL),
(539, 'Al ‘Alamayn', 'Al ‘Alamayn', 'EG', '30.83009911', '28.95499992', 'Africa/Cairo', 1, NULL, NULL),
(540, 'Akhmīm', 'Akhmīm', 'EG', '26.56220055', '31.74500084', 'Africa/Cairo', 1, NULL, NULL),
(541, 'Ajā', 'Ajā', 'EG', '30.94160080', '31.29039955', 'Africa/Cairo', 1, NULL, NULL),
(542, 'Ad Dilinjāt', 'Ad Dilinjāt', 'EG', '30.82799911', '30.53549957', 'Africa/Cairo', 1, NULL, NULL),
(543, 'Abū Tīj', 'Abū Tīj', 'EG', '27.04409981', '31.31900024', 'Africa/Cairo', 1, NULL, NULL),
(544, 'Abū Qurqāş', 'Abū Qurqāş', 'EG', '27.93120003', '30.83839989', 'Africa/Cairo', 1, NULL, NULL),
(545, 'Abū Kabīr', 'Abū Kabīr', 'EG', '30.72509956', '31.67149925', 'Africa/Cairo', 1, NULL, NULL),
(546, 'Abū al Maţāmīr', 'Abū al Maţāmīr', 'EG', '30.91020012', '30.17440033', 'Africa/Cairo', 1, NULL, NULL),
(547, 'Abnūb', 'Abnūb', 'EG', '27.26959991', '31.15110016', 'Africa/Cairo', 1, NULL, NULL),
(548, 'Salwá', 'Salwá', 'KW', '29.29579926', '48.07860184', 'Asia/Kuwait', 1, NULL, NULL),
(549, 'Ar Rābiyah', 'Ar Rābiyah', 'KW', '29.29500008', '47.93310165', 'Asia/Kuwait', 1, NULL, NULL),
(550, 'Şuwayr', 'Şuwayr', 'SA', '30.11709976', '40.38930130', 'Asia/Riyadh', 1, NULL, NULL),
(551, 'Tumayr', 'Tumayr', 'SA', '25.70350075', '45.86840057', 'Asia/Riyadh', 1, NULL, NULL),
(552, 'Al Fuwayliq', 'Al Fuwayliq', 'SA', '26.44359970', '43.25159836', 'Asia/Riyadh', 1, NULL, NULL),
(553, 'Al Majāridah', 'Al Majāridah', 'SA', '19.12360001', '41.91109848', 'Asia/Riyadh', 1, NULL, NULL),
(554, 'الجبين', 'الجبين', 'YE', '14.70390034', '43.59920120', 'Asia/Aden', 1, NULL, NULL),
(555, 'Al Muwayh', 'Al Muwayh', 'SA', '22.43330002', '41.75830078', 'Asia/Riyadh', 1, NULL, NULL),
(556, 'Al Hadā', 'Al Hadā', 'SA', '21.36750031', '40.28689957', 'Asia/Riyadh', 1, NULL, NULL),
(557, 'Ash Shafā', 'Ash Shafā', 'SA', '21.07209969', '40.31190109', 'Asia/Riyadh', 1, NULL, NULL),
(558, 'Mizhirah', 'Mizhirah', 'SA', '16.82609940', '42.73329926', 'Asia/Riyadh', 1, NULL, NULL),
(559, 'Yanqul', 'Yanqul', 'OM', '23.58650017', '56.53969955', 'Asia/Muscat', 1, NULL, NULL),
(560, 'Bayt al ‘Awābī', 'Bayt al ‘Awābī', 'OM', '23.30319977', '57.52460098', 'Asia/Muscat', 1, NULL, NULL),
(561, 'Şabāḩ as Sālim', 'Şabāḩ as Sālim', 'KW', '29.25720024', '48.05720139', 'Asia/Kuwait', 1, NULL, NULL),
(562, 'عدن', 'عدن', 'YE', '12.77939987', '45.03670120', 'Asia/Aden', 1, NULL, NULL),
(563, 'Az Zarqā', 'Az Zarqā', 'EG', '31.20859909', '31.63529968', 'Africa/Cairo', 1, NULL, NULL),
(564, 'El Gouna', 'El Gouna', 'EG', '27.39419937', '33.67819977', 'Africa/Cairo', 1, NULL, NULL),
(565, 'Mubārak al Kabīr', 'Mubārak al Kabīr', 'KW', '29.18980026', '48.08720016', 'Asia/Kuwait', 1, NULL, NULL),
(566, 'Ain Sukhna', 'Ain Sukhna', 'EG', '29.60020065', '32.31669998', 'Africa/Cairo', 1, NULL, NULL),
(567, 'New Cairo', 'New Cairo', 'EG', '30.03000069', '31.46999931', 'Africa/Cairo', 1, NULL, NULL),
(568, 'Khalifah A City', 'Khalifah A City', 'AE', '24.42589951', '54.60499954', 'Asia/Dubai', 1, NULL, NULL),
(569, 'جدر', 'جدر', 'YE', '15.46700001', '44.17789841', 'Asia/Aden', 1, NULL, '2021-03-22 07:39:16'),
(570, 'Oman Smart Future City', 'Oman Smart Future City', 'OM', '23.65270042', '57.59930038', 'Asia/Muscat', 1, NULL, NULL),
(571, 'Bani Yas City', 'Bani Yas City', 'AE', '24.30979919', '54.62939835', 'Asia/Dubai', 1, NULL, NULL),
(572, 'Musaffah', 'Musaffah', 'AE', '24.35890007', '54.48270035', 'Asia/Dubai', 1, NULL, NULL),
(573, 'Al Shamkhah City', 'Al Shamkhah City', 'AE', '24.39270020', '54.70780182', 'Asia/Dubai', 1, NULL, NULL),
(574, 'Reef Al Fujairah City', 'Reef Al Fujairah City', 'AF', '25.14480019', '56.24760056', 'Asia/Dubai', 1, NULL, '2021-03-22 06:46:09'),
(575, 'Abu Dhabi Island and Internal Islands City', 'Abu Dhabi Island and Internal Islands City', 'AE', '24.45109940', '54.39690018', 'Asia/Dubai', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `commenter_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `commenter_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guest_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guest_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `commentable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `commentable_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT '1',
  `child_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `comments_commenter_id_commenter_type_index` (`commenter_id`,`commenter_type`),
  KEY `comments_commentable_type_commentable_id_index` (`commentable_type`,`commentable_id`),
  KEY `comments_child_id_foreign` (`child_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comments_old`
--

DROP TABLE IF EXISTS `comments_old`;
CREATE TABLE IF NOT EXISTS `comments_old` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `commentable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `commentable_id` bigint(20) UNSIGNED NOT NULL,
  `likes` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `dislikes` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `comments_old_customer_id_foreign` (`customer_id`),
  KEY `comments_old_commentable_type_commentable_id_index` (`commentable_type`,`commentable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `consultants`
--

DROP TABLE IF EXISTS `consultants`;
CREATE TABLE IF NOT EXISTS `consultants` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `consultants_category_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(3000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `consultant_type` enum('free','paid') COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(13,2) DEFAULT '0.00',
  `currency_id` bigint(20) UNSIGNED DEFAULT '1',
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `service_package_id` bigint(20) UNSIGNED DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `who_will_benefit` text COLLATE utf8mb4_unicode_ci,
  `what_will_benefit` text COLLATE utf8mb4_unicode_ci,
  `img_path` text COLLATE utf8mb4_unicode_ci,
  `external_link` text COLLATE utf8mb4_unicode_ci,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `consultants_consultants_category_id_foreign` (`consultants_category_id`),
  KEY `consultants_service_id_foreign` (`service_id`),
  KEY `consultants_service_package_id_foreign` (`service_package_id`),
  KEY `consultants_currency_id_foreign` (`currency_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `consultants`
--

INSERT INTO `consultants` (`id`, `consultants_category_id`, `name`, `consultant_type`, `price`, `currency_id`, `service_id`, `service_package_id`, `description`, `who_will_benefit`, `what_will_benefit`, `img_path`, `external_link`, `active`, `created_at`, `updated_at`) VALUES
(2, 1, '{\"ar\":\"استشارة في التسويق الفعال للمشاريع الناشئة في ظل ازمة اقتصادية عارمة في البلاد\"}', 'paid', '6.00', 1, 4, 1, '{\"ar\":\"استشارة في التسويق الفعال للمشاريع الناشئة في ظل ازمة اقتصادية عارمة في البلاد\"}', NULL, NULL, '{\"ar\":\"storage\\/consultants\\/bba01d78d54fd92c32a8c9d6638c86ca.png\"}', 'http://sss', 1, '2021-04-09 16:37:26', '2021-04-09 17:11:05'),
(3, 1, '{\"ar\":\"استشارةجديدة عنالتغيرات المالية\"}', 'paid', '2.00', 1, 4, 1, '{\"ar\":\"لاشي جديد\"}', NULL, NULL, '{\"ar\":\"{\\\"ar\\\":\\\"storage\\\\\\/consultants\\\\\\/196e6d1087f431315d117002d5e957ae.png\\\"}\"}', NULL, 1, '2021-04-25 21:03:52', '2021-05-22 20:32:45');

-- --------------------------------------------------------

--
-- Table structure for table `consultants_categories`
--

DROP TABLE IF EXISTS `consultants_categories`;
CREATE TABLE IF NOT EXISTS `consultants_categories` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(3000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img_path` text COLLATE utf8mb4_unicode_ci,
  `short_description` text COLLATE utf8mb4_unicode_ci,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `consultants_categories`
--

INSERT INTO `consultants_categories` (`id`, `name`, `slug`, `img_path`, `short_description`, `active`, `created_at`, `updated_at`) VALUES
(1, '{\"ar\":\"استشارات في التسويق\"}', 'markteing', 'storage/consultants/fc52094b6bd0b1bb911ca820252f08a1.png', '{\"ar\":null}', 1, '2021-04-09 13:48:17', '2021-04-09 15:12:32'),
(2, '{\"ar\":\"استشارات في التداول\"}', 'trading', 'storage/consultants/5c3ae432a96b8da25c17f729189b9d80.png', '{\"ar\":null}', 1, '2021-04-09 13:50:49', '2021-04-09 15:12:00'),
(3, '{\"ar\":\"استشارات تعليمية\"}', 'learing', 'storage/consultants/5de4d2c2f0cf804f840dc8d2b0144753.png', '{\"ar\":null}', 1, '2021-04-09 13:54:34', '2021-04-09 15:11:44'),
(4, '{\"ar\":\"استشارات شركات ناشئة\"}', 'company', 'storage/consultants/cb2a35789916007e4601bf5e711621ce.png', '{\"ar\":null}', 1, '2021-04-09 13:55:05', '2021-04-09 15:11:22'),
(5, '{\"ar\":\"استشارات تكنولوجية\"}', 'techno', 'storage/consultants/af421c9da4e9e8a3219c42c7335f0165.png', '{\"ar\":null}', 1, '2021-04-09 13:55:35', '2021-04-09 15:24:29');

-- --------------------------------------------------------

--
-- Table structure for table `consultants_orders_procedures`
--

DROP TABLE IF EXISTS `consultants_orders_procedures`;
CREATE TABLE IF NOT EXISTS `consultants_orders_procedures` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `consultants_order_id` bigint(20) UNSIGNED NOT NULL,
  `procedure_type_id` bigint(20) UNSIGNED DEFAULT NULL,
  `process_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `consultants_orders_procedures_consultants_order_id_foreign` (`consultants_order_id`),
  KEY `consultants_orders_procedures_procedure_type_id_foreign` (`procedure_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
CREATE TABLE IF NOT EXISTS `countries` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_en` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_source_transferring` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'is this country a source in transfer by YtadawulPay',
  `is_dist_transferring` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'is this country a destination place in transfer by YtadawulPay',
  `currency_id` bigint(20) UNSIGNED DEFAULT NULL,
  `transfer_fee` decimal(5,2) NOT NULL DEFAULT '0.01',
  `img_path` text COLLATE utf8mb4_unicode_ci COMMENT 'the map path',
  `flag_path` text COLLATE utf8mb4_unicode_ci,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `countries_code_unique` (`code`),
  KEY `countries_currency_id_foreign` (`currency_id`)
) ENGINE=InnoDB AUTO_INCREMENT=253 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `code`, `name`, `name_en`, `is_source_transferring`, `is_dist_transferring`, `currency_id`, `transfer_fee`, `img_path`, `flag_path`, `active`, `created_at`, `updated_at`) VALUES
(1, 'AD', 'Andorra', 'Andorra', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(2, 'AE', 'Imarat', 'Imarat', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(3, 'AF', 'Afganistan', 'Afganistan', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(4, 'AG', 'Antigua and Barbuda', 'Antigua and Barbuda', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(5, 'AI', 'Anguilla', 'Anguilla', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(6, 'AL', 'Shqipëria', 'Shqipëria', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(7, 'AM', 'Hayastan', 'Hayastan', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(8, 'AN', 'Netherlands Antilles', 'Netherlands Antilles', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(9, 'AO', 'Angola', 'Angola', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(10, 'AQ', 'Antarctica', 'Antarctica', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(11, 'AR', 'Argentina', 'Argentina', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(12, 'AS', 'American Samoa', 'American Samoa', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(13, 'AT', 'Österreich', 'Österreich', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(14, 'AU', 'Australia', 'Australia', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(15, 'AW', 'Aruba', 'Aruba', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(16, 'AX', 'Aland Islands', 'Aland Islands', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(17, 'AZ', 'Azərbaycan', 'Azərbaycan', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(18, 'BA', 'Bosna i Hercegovina', 'Bosna i Hercegovina', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(19, 'BB', 'Barbados', 'Barbados', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(20, 'BD', 'Bāṅlādēś', 'Bāṅlādēś', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(21, 'BE', 'Belgique', 'Belgique', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(22, 'BF', 'Burkina Faso', 'Burkina Faso', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(23, 'BG', 'Bŭlgarija', 'Bŭlgarija', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(24, 'BH', 'Baḥrayn', 'Baḥrayn', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(25, 'BI', 'Burundi', 'Burundi', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(26, 'BJ', 'Bénin', 'Bénin', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(27, 'BL', 'Saint Barthelemy', 'Saint Barthelemy', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(28, 'BM', 'Bermuda', 'Bermuda', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(29, 'BN', 'Brunei Darussalam', 'Brunei Darussalam', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(30, 'BO', 'Bolivia', 'Bolivia', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(31, 'BQ', 'Bonaire, Saint Eustatius and Saba ', 'Bonaire, Saint Eustatius and Saba ', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(32, 'BR', 'Brasil', 'Brasil', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(33, 'BS', 'Bahamas', 'Bahamas', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(34, 'BT', 'Druk-yul', 'Druk-yul', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(35, 'BV', 'Bouvet Island', 'Bouvet Island', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(36, 'BW', 'Botswana', 'Botswana', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(37, 'BY', 'Biełaruś', 'Biełaruś', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(38, 'BZ', 'Belize', 'Belize', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(39, 'CA', 'Canada', 'Canada', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(40, 'CC', 'Cocos Islands', 'Cocos Islands', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(41, 'CD', 'RDC', 'RDC', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(42, 'CF', 'Centrafrique', 'Centrafrique', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(43, 'CG', 'Congo', 'Congo', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(44, 'CH', 'Switzerland', 'Switzerland', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(45, 'CI', 'Côte d\'Ivoire', 'Côte d\'Ivoire', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(46, 'CK', 'Cook Islands', 'Cook Islands', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(47, 'CL', 'Chile', 'Chile', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(48, 'CM', 'Cameroun', 'Cameroun', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(49, 'CN', 'Zhōngguó', 'Zhōngguó', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(50, 'CO', 'Colombia', 'Colombia', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(51, 'CR', 'Costa Rica', 'Costa Rica', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(52, 'CS', 'Serbia and Montenegro', 'Serbia and Montenegro', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(53, 'CU', 'Cuba', 'Cuba', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(54, 'CV', 'Cabo Verde', 'Cabo Verde', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(55, 'CW', 'Curacao', 'Curacao', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(56, 'CX', 'Christmas Island', 'Christmas Island', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(57, 'CY', 'Kýpros (Kıbrıs)', 'Kýpros (Kıbrıs)', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(58, 'CZ', 'Česko', 'Česko', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(59, 'DE', 'Deutschland', 'Deutschland', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(60, 'DJ', 'Djibouti', 'Djibouti', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(61, 'DK', 'Danmark', 'Danmark', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(62, 'DM', 'Dominica', 'Dominica', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(63, 'DO', 'República Dominicana', 'República Dominicana', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(64, 'DZ', 'Algérie', 'Algérie', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(65, 'EC', 'Ecuador', 'Ecuador', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(66, 'EE', 'Eesti', 'Eesti', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(67, 'EG', 'Egypt', 'Egypt', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(68, 'EH', 'aṣ-Ṣaḥrāwīyâ al-ʿArabīyâ', 'aṣ-Ṣaḥrāwīyâ al-ʿArabīyâ', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(69, 'ER', 'Ertrā', 'Ertrā', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(70, 'ES', 'España', 'España', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(71, 'ET', 'Ityoṗya', 'Ityoṗya', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(72, 'FI', 'Suomi (Finland)', 'Suomi (Finland)', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(73, 'FJ', 'Viti', 'Viti', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(74, 'FK', 'Falkland Islands', 'Falkland Islands', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(75, 'FM', 'Micronesia', 'Micronesia', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(76, 'FO', 'Føroyar', 'Føroyar', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(77, 'FR', 'France', 'France', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(78, 'GA', 'Gabon', 'Gabon', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(79, 'GD', 'Grenada', 'Grenada', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(80, 'GE', 'Sak\'art\'velo', 'Sak\'art\'velo', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(81, 'GF', 'Guyane', 'Guyane', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(82, 'GG', 'Guernsey', 'Guernsey', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(83, 'GH', 'Ghana', 'Ghana', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(84, 'GI', 'Gibraltar', 'Gibraltar', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(85, 'GL', 'Grønland', 'Grønland', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(86, 'GM', 'Gambia', 'Gambia', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(87, 'GN', 'Guinée', 'Guinée', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(88, 'GP', 'Guadeloupe', 'Guadeloupe', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(89, 'GQ', 'Guinée Equatoriale', 'Guinée Equatoriale', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(90, 'GR', 'Elláda', 'Elláda', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(91, 'GS', 'South Georgia and the South Sandwich Islands', 'South Georgia and the South Sandwich Islands', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(92, 'GT', 'Guatemala', 'Guatemala', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(93, 'GU', 'Guam', 'Guam', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(94, 'GW', 'Guiné-Bissau', 'Guiné-Bissau', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(95, 'GY', 'Guyana', 'Guyana', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(96, 'HK', 'Hèunggóng', 'Hèunggóng', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(97, 'HM', 'Heard Island and McDonald Islands', 'Heard Island and McDonald Islands', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(98, 'HN', 'Honduras', 'Honduras', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(99, 'HR', 'Hrvatska', 'Hrvatska', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(100, 'HT', 'Haïti', 'Haïti', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(101, 'HU', 'Magyarország', 'Magyarország', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(102, 'ID', 'Indonesia', 'Indonesia', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(103, 'IE', 'Ireland', 'Ireland', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(104, 'IL', 'Yiśrā\'ēl', 'Yiśrā\'ēl', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(105, 'IM', 'Isle of Man', 'Isle of Man', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(106, 'IN', 'Bhārat', 'Bhārat', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(107, 'IO', 'British Indian Ocean Territory', 'British Indian Ocean Territory', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(108, 'IQ', 'Iraq', 'Iraq', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(109, 'IR', 'Īrān', 'Īrān', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(110, 'IS', 'Ísland', 'Ísland', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(111, 'IT', 'Italia', 'Italia', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(112, 'JE', 'Jersey', 'Jersey', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(113, 'JM', 'Jamaica', 'Jamaica', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(114, 'JO', 'Urdun', 'Urdun', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(115, 'JP', 'Nihon', 'Nihon', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(116, 'KE', 'Kenya', 'Kenya', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(117, 'KG', 'Kyrgyzstan', 'Kyrgyzstan', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(118, 'KH', 'Kambucā', 'Kambucā', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(119, 'KI', 'Kiribati', 'Kiribati', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(120, 'KM', 'Comores', 'Comores', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(121, 'KN', 'Saint Kitts and Nevis', 'Saint Kitts and Nevis', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(122, 'KP', 'Joseon', 'Joseon', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(123, 'KR', 'Hanguk', 'Hanguk', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(124, 'KW', 'Kuwayt', 'Kuwayt', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(125, 'KY', 'Cayman Islands', 'Cayman Islands', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(126, 'KZ', 'Ķazaķstan', 'Ķazaķstan', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(127, 'LA', 'Lāw', 'Lāw', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(128, 'LB', 'Lubnān', 'Lubnān', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(129, 'LC', 'Saint Lucia', 'Saint Lucia', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(130, 'LI', 'Liechtenstein', 'Liechtenstein', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(131, 'LK', 'Šrī Laṁkā', 'Šrī Laṁkā', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(132, 'LR', 'Liberia', 'Liberia', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(133, 'LS', 'Lesotho', 'Lesotho', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(134, 'LT', 'Lietuva', 'Lietuva', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(135, 'LU', 'Lëtzebuerg', 'Lëtzebuerg', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(136, 'LV', 'Latvija', 'Latvija', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(137, 'LY', 'Lībiyā', 'Lībiyā', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(138, 'MA', 'Maroc', 'Maroc', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(139, 'MC', 'Monaco', 'Monaco', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(140, 'MD', 'Moldova', 'Moldova', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(141, 'ME', 'Crna Gora', 'Crna Gora', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(142, 'MF', 'Saint Martin', 'Saint Martin', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(143, 'MG', 'Madagascar', 'Madagascar', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(144, 'MH', 'Marshall Islands', 'Marshall Islands', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(145, 'MK', 'Makedonija', 'Makedonija', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(146, 'ML', 'Mali', 'Mali', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(147, 'MM', 'Mẏanmā', 'Mẏanmā', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(148, 'MN', 'Mongol Uls', 'Mongol Uls', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(149, 'MO', 'Ngoumún', 'Ngoumún', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(150, 'MP', 'Northern Mariana Islands', 'Northern Mariana Islands', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(151, 'MQ', 'Martinique', 'Martinique', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(152, 'MR', 'Mauritanie', 'Mauritanie', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(153, 'MS', 'Montserrat', 'Montserrat', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(154, 'MT', 'Malta', 'Malta', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(155, 'MU', 'Mauritius', 'Mauritius', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(156, 'MV', 'Dhivehi', 'Dhivehi', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(157, 'MW', 'Malawi', 'Malawi', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(158, 'MX', 'México', 'México', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(159, 'MY', 'Malaysia', 'Malaysia', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(160, 'MZ', 'Moçambique', 'Moçambique', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(161, 'NA', 'Namibia', 'Namibia', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(162, 'NC', 'Nouvelle Calédonie', 'Nouvelle Calédonie', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(163, 'NE', 'Niger', 'Niger', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(164, 'NF', 'Norfolk Island', 'Norfolk Island', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(165, 'NG', 'Nigeria', 'Nigeria', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(166, 'NI', 'Nicaragua', 'Nicaragua', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(167, 'NL', 'Nederland', 'Nederland', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(168, 'NO', 'Norge (Noreg)', 'Norge (Noreg)', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(169, 'NP', 'Nēpāl', 'Nēpāl', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(170, 'NR', 'Naoero', 'Naoero', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(171, 'NU', 'Niue', 'Niue', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(172, 'NZ', 'New Zealand', 'New Zealand', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(173, 'OM', 'ʿUmān', 'ʿUmān', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(174, 'PA', 'Panamá', 'Panamá', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(175, 'PE', 'Perú', 'Perú', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(176, 'PF', 'Polinésie Française', 'Polinésie Française', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(177, 'PG', 'Papua New Guinea', 'Papua New Guinea', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(178, 'PH', 'Pilipinas', 'Pilipinas', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(179, 'PK', 'Pākistān', 'Pākistān', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(180, 'PL', 'Polska', 'Polska', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(181, 'PM', 'Saint Pierre and Miquelon', 'Saint Pierre and Miquelon', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(182, 'PN', 'Pitcairn', 'Pitcairn', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(183, 'PR', 'Puerto Rico', 'Puerto Rico', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(184, 'PS', 'Filasṭīn', 'Filasṭīn', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(185, 'PT', 'Portugal', 'Portugal', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(186, 'PW', 'Palau', 'Palau', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(187, 'PY', 'Paraguay', 'Paraguay', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(188, 'QA', 'Qaṭar', 'Qaṭar', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(189, 'RE', 'Réunion', 'Réunion', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(190, 'RO', 'România', 'România', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(191, 'RS', 'Srbija', 'Srbija', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(192, 'RU', 'Rossija', 'Rossija', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(193, 'RW', 'Rwanda', 'Rwanda', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(194, 'SA', 'as-Saʿūdīyâ', 'as-Saʿūdīyâ', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(195, 'SB', 'Solomon Islands', 'Solomon Islands', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(196, 'SC', 'Seychelles', 'Seychelles', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(197, 'SD', 'Sudan', 'Sudan', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(198, 'SE', 'Sverige', 'Sverige', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(199, 'SG', 'xīnjiāpō', 'xīnjiāpō', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(200, 'SH', 'Saint Helena', 'Saint Helena', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(201, 'SI', 'Slovenija', 'Slovenija', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(202, 'SJ', 'Svalbard and Jan Mayen', 'Svalbard and Jan Mayen', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(203, 'SK', 'Slovensko', 'Slovensko', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(204, 'SL', 'Sierra Leone', 'Sierra Leone', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(205, 'SM', 'San Marino', 'San Marino', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(206, 'SN', 'Sénégal', 'Sénégal', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(207, 'SO', 'Soomaaliya', 'Soomaaliya', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(208, 'SR', 'Suriname', 'Suriname', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(209, 'SS', 'South Sudan', 'South Sudan', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(210, 'ST', 'São Tomé e Príncipe', 'São Tomé e Príncipe', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(211, 'SV', 'El Salvador', 'El Salvador', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(212, 'SX', 'Sint Maarten', 'Sint Maarten', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(213, 'SY', 'Sūrīyâ', 'Sūrīyâ', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(214, 'SZ', 'Swaziland', 'Swaziland', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(215, 'TC', 'Turks and Caicos Islands', 'Turks and Caicos Islands', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(216, 'TD', 'Tchad', 'Tchad', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(217, 'TF', 'French Southern Territories', 'French Southern Territories', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(218, 'TG', 'Togo', 'Togo', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(219, 'TH', 'Prathēt tai', 'Prathēt tai', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(220, 'TJ', 'Tojikiston', 'Tojikiston', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(221, 'TK', 'Tokelau', 'Tokelau', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(222, 'TL', 'Timór Lorosa\'e', 'Timór Lorosa\'e', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(223, 'TM', 'Turkmenistan', 'Turkmenistan', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(224, 'TN', 'Tunisie', 'Tunisie', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(225, 'TO', 'Tonga', 'Tonga', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(226, 'TR', 'Türkiye', 'Türkiye', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(227, 'TT', 'Trinidad and Tobago', 'Trinidad and Tobago', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(228, 'TV', 'Tuvalu', 'Tuvalu', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(229, 'TW', 'T\'ai2-wan1', 'T\'ai2-wan1', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(230, 'TZ', 'Tanzania', 'Tanzania', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(231, 'UA', 'Ukrajina', 'Ukrajina', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(232, 'UG', 'Uganda', 'Uganda', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(233, 'UK', 'United Kingdom', 'United Kingdom', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(234, 'UM', 'United States Minor Outlying Islands', 'United States Minor Outlying Islands', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(235, 'US', 'USA', 'USA', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(236, 'UY', 'Uruguay', 'Uruguay', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(237, 'UZ', 'O\'zbekiston', 'O\'zbekiston', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(238, 'VA', 'Vaticanum', 'Vaticanum', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(239, 'VC', 'Saint Vincent and the Grenadines', 'Saint Vincent and the Grenadines', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(240, 'VE', 'Venezuela', 'Venezuela', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(241, 'VG', 'British Virgin Islands', 'British Virgin Islands', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(242, 'VI', 'U.S. Virgin Islands', 'U.S. Virgin Islands', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(243, 'VN', 'Việt Nam', 'Việt Nam', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(244, 'VU', 'Vanuatu', 'Vanuatu', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(245, 'WF', 'Wallis and Futuna', 'Wallis and Futuna', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(246, 'WS', 'Samoa', 'Samoa', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(247, 'XK', 'Kosovo', 'Kosovo', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(248, 'YE', 'Yemen', 'Yemen', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(249, 'YT', 'Mayotte', 'Mayotte', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(250, 'ZA', 'South Africa', 'South Africa', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(251, 'ZM', 'Zambia', 'Zambia', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, NULL),
(252, 'ZW', 'Zimbabwee', 'Zimbabwee', 1, 1, 1, '0.01', NULL, NULL, 1, NULL, '2021-03-22 06:17:24');

-- --------------------------------------------------------

--
-- Table structure for table `courses_categories`
--

DROP TABLE IF EXISTS `courses_categories`;
CREATE TABLE IF NOT EXISTS `courses_categories` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(2000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img_path` text COLLATE utf8mb4_unicode_ci,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses_categories`
--

INSERT INTO `courses_categories` (`id`, `name`, `img_path`, `active`, `created_at`, `updated_at`) VALUES
(1, '{\"ar\":\"كورسات تعليمية في التسويق\"}', NULL, 1, '2021-04-09 13:42:39', '2021-04-09 13:47:40'),
(2, '{\"ar\":\"كورسات التحليل الاقتصادس\"}', 'storage/courses_categories/d3af5342215fbb484ff5384b65d48bcc.png', 1, '2021-04-22 19:45:25', '2021-04-22 19:45:25');

-- --------------------------------------------------------

--
-- Table structure for table `courses_trainings`
--

DROP TABLE IF EXISTS `courses_trainings`;
CREATE TABLE IF NOT EXISTS `courses_trainings` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `teacher_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(3000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_category_id` bigint(20) UNSIGNED NOT NULL,
  `language` enum('ar','en') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ar',
  `description` text COLLATE utf8mb4_unicode_ci,
  `requirements` text COLLATE utf8mb4_unicode_ci,
  `what_learn` text COLLATE utf8mb4_unicode_ci,
  `img_path` text COLLATE utf8mb4_unicode_ci,
  `price` decimal(11,2) NOT NULL,
  `currency_id` bigint(20) UNSIGNED DEFAULT NULL,
  `discount` decimal(11,2) DEFAULT '0.00',
  `discount_type` enum('percent','amount') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'amount',
  `external_link` text COLLATE utf8mb4_unicode_ci,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `level` enum('beginner','intermediate','advanced','all_levels') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'all_levels',
  `subjects_count` int(11) DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `total_students` int(11) DEFAULT '0' COMMENT 'who studies in this course',
  `rating` decimal(2,1) DEFAULT '4.0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `courses_trainings_teacher_id_foreign` (`teacher_id`),
  KEY `courses_trainings_currency_id_foreign` (`currency_id`),
  KEY `courses_trainings_course_category_id_foreign` (`course_category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses_trainings`
--

INSERT INTO `courses_trainings` (`id`, `teacher_id`, `name`, `course_category_id`, `language`, `description`, `requirements`, `what_learn`, `img_path`, `price`, `currency_id`, `discount`, `discount_type`, `external_link`, `active`, `level`, `subjects_count`, `duration`, `total_students`, `rating`, `created_at`, `updated_at`) VALUES
(5, 1, '{\"ar\":\"thirdCourse\"}', 1, 'ar', '{\"ar\":\"<p>awda<\\/p>\"}', '{\"ar\":\"<p>rwe<\\/p>\"}', '{\"ar\":\"<p>werwer<\\/p>\"}', '{\"ar\":\"storage\\/courses\\/ee5cb34fab7f387227ed44508be359ae.png\"}', '22.00', 1, NULL, 'percent', NULL, 1, 'beginner', NULL, NULL, NULL, NULL, '2021-04-26 16:45:32', '2021-04-26 16:45:34');

-- --------------------------------------------------------

--
-- Table structure for table `course_exercises`
--

DROP TABLE IF EXISTS `course_exercises`;
CREATE TABLE IF NOT EXISTS `course_exercises` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `part_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sort` int(11) NOT NULL DEFAULT '0',
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `external_link` text COLLATE utf8mb4_unicode_ci,
  `subject_type` enum('Q','A') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Q' COMMENT 'Question OR Answer',
  `visited` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `is_helpful` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `is_not_helpful` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `course_exercises_course_id_foreign` (`course_id`),
  KEY `course_exercises_part_id_foreign` (`part_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `course_parts`
--

DROP TABLE IF EXISTS `course_parts`;
CREATE TABLE IF NOT EXISTS `course_parts` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `name` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `course_parts_course_id_foreign` (`course_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_parts`
--

INSERT INTO `course_parts` (`id`, `course_id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(2, 5, 'course_5_part1', NULL, '2021-04-26 16:45:32', '2021-04-26 16:45:32');

-- --------------------------------------------------------

--
-- Table structure for table `course_subjects`
--

DROP TABLE IF EXISTS `course_subjects`;
CREATE TABLE IF NOT EXISTS `course_subjects` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `part_id` bigint(20) UNSIGNED NOT NULL,
  `sort` int(11) NOT NULL DEFAULT '0',
  `name` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_path` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `subject_type` enum('video','file','image') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'video',
  `kb_volume` decimal(8,2) NOT NULL COMMENT 'in kilobyte',
  `duration` int(11) DEFAULT NULL COMMENT 'by minutes',
  `is_free` tinyint(1) NOT NULL DEFAULT '0',
  `visited` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `likes` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `dis_likes` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `course_subjects_course_id_foreign` (`course_id`),
  KEY `course_subjects_part_id_foreign` (`part_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

DROP TABLE IF EXISTS `currencies`;
CREATE TABLE IF NOT EXISTS `currencies` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_en` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `symbol` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `img_path` mediumtext COLLATE utf8mb4_unicode_ci,
  `exchange_price` decimal(8,2) NOT NULL DEFAULT '1.00',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `currencies_code_unique` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `name`, `name_en`, `code`, `symbol`, `img_path`, `exchange_price`, `active`, `created_at`, `updated_at`) VALUES
(1, 'دولار', 'Dollar', 'USD', '$', 'storage/currencies/c916a7b5ba4b6381dd18f1678027d6e1.png', '1.00', 1, '2021-02-12 12:35:25', '2021-05-29 23:13:22'),
(2, 'ريال يمني', 'Yemeni Ryal', 'YER', 'YER', NULL, '610.00', 1, '2021-02-23 09:36:29', '2021-03-19 06:48:56'),
(3, 'ريال يمني - منطقة الجنوب', 'Reyal In South', 'SER', 'SYER', NULL, '860.00', 1, '2021-02-23 09:38:26', '2021-02-23 09:38:48');

-- --------------------------------------------------------

--
-- Table structure for table `currency_changes`
--

DROP TABLE IF EXISTS `currency_changes`;
CREATE TABLE IF NOT EXISTS `currency_changes` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `admin_id` bigint(20) UNSIGNED NOT NULL COMMENT 'who did this changes',
  `currency_id` bigint(20) UNSIGNED NOT NULL,
  `from_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `to_date` timestamp NULL DEFAULT NULL,
  `currency_value` decimal(13,4) NOT NULL COMMENT 'value for this currency per USD in this duration',
  `is_current_value` tinyint(1) DEFAULT '0',
  `description` text COLLATE utf8mb4_unicode_ci COMMENT 'why this changes accrue',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `currency_changes_admin_id_foreign` (`admin_id`),
  KEY `currency_changes_currency_id_foreign` (`currency_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE IF NOT EXISTS `customers` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `img_profile` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `whatsapp_acc` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook_acc` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` enum('F','M') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'M',
  `birth_date` date DEFAULT NULL,
  `city_id` bigint(20) UNSIGNED DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `address_2` text COLLATE utf8mb4_unicode_ci,
  `account_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'that related with wallet account',
  `customer_type` enum('customer','per_consultant','consultant') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'customer',
  `badge_id` bigint(20) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_login_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `customers_email_unique` (`email`),
  UNIQUE KEY `customers_account_number_unique` (`account_number`),
  KEY `customers_city_id_foreign` (`city_id`),
  KEY `customers_badge_id_foreign` (`badge_id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `first_name`, `last_name`, `email`, `password`, `email_verified_at`, `phone`, `img_profile`, `whatsapp_acc`, `facebook_acc`, `country_code`, `phone2`, `gender`, `birth_date`, `city_id`, `address`, `address_2`, `account_number`, `customer_type`, `badge_id`, `active`, `remember_token`, `last_login_at`, `created_at`, `updated_at`) VALUES
(1, 'last', 'test', 'testing@testing.asdcom', '$2y$10$TYO/rdtGeMumyt7qML5fh.MBp1clrxBuGKpbEkuf89G6RoTf/mJB.', NULL, '23asdas4234', NULL, 'tweqwu', 'http://dfacebook.com', '248', NULL, 'F', NULL, NULL, NULL, NULL, NULL, 'customer', NULL, 1, 'bEwfhbEpaeD14SIT3O8gkadY21YvKjRXRKFk4F8j6b6Gx347gClQ0ewgkS5F', '2021-05-29 20:38:07', '2021-03-30 20:53:22', '2021-05-29 21:11:37'),
(2, 'test1', 'test', 'testing@testing1.com', '$2y$10$/5BTjA62ar8p7qlUxwzdSudQo5ewCTaynB6csoXVJtuG5GZYaDJlW', NULL, NULL, NULL, 'tweqwu', 'http://facebook.com', '248', 'ERWR', 'F', NULL, NULL, NULL, NULL, NULL, 'consultant', NULL, 1, NULL, NULL, '2021-03-30 21:08:36', '2021-04-14 17:17:40'),
(3, 'wqerqwerwer', 'testingwerwr', 'test@test3.com', '$2y$10$7rdgfAV4Z4mucjqhlojff.HuLbpD970OZbm/G67Q0Nu0vwi73F5v2', NULL, NULL, NULL, '234234', NULL, '248', NULL, 'F', NULL, NULL, NULL, NULL, NULL, 'customer', NULL, 1, 'S2a9Kb6iDgEy92EedfvN8716NHhyay8BTnPmpCBEGTkFUfEUjAJyjelp94fC', '2021-04-06 18:49:27', '2021-03-30 21:14:01', '2021-04-06 20:26:49'),
(4, 'tagreeb', 'test', 'tagreeb@test.com', '$2y$10$eUjgNDz88ee8KZLwLcPiZO6ymHfKEzp42vKIfOer0QeEEatv9vq72', NULL, NULL, NULL, NULL, NULL, '2', NULL, 'M', NULL, NULL, NULL, NULL, NULL, 'customer', NULL, 1, NULL, NULL, '2021-05-19 13:43:42', '2021-05-19 13:43:42'),
(5, 'test@finance.com', 'testfinance', 'test@finance.com', '$2y$10$L8SaBvKKI7PNvrRoWbkEgOqV/dRML6zEY8RNR0m6cZqHLiybNowIm', NULL, NULL, NULL, NULL, NULL, '248', NULL, 'M', NULL, NULL, NULL, NULL, NULL, 'customer', NULL, 1, NULL, NULL, '2021-05-20 12:41:09', '2021-05-20 12:41:09'),
(6, 'first_full', 'last_full', 'email@full.com', '$2y$10$GFRwfAt1cri83tM/QHp.u.dy.ZlI95OZ0IWv0V0hWov106IJD0qiK', NULL, NULL, NULL, NULL, NULL, '78', NULL, 'M', NULL, NULL, NULL, NULL, NULL, 'customer', NULL, 1, NULL, NULL, '2021-05-20 13:36:00', '2021-05-20 13:36:00'),
(12, 'firstFull', 'lastFull', 'email@fullin.com', '$2y$10$9bPZDT5t2DiGrGo7VscDseVkKdXjrzluRMSefqbnGALsogm0NTD/a', NULL, NULL, NULL, NULL, NULL, '34', NULL, 'M', NULL, NULL, NULL, NULL, NULL, 'customer', NULL, 1, NULL, NULL, '2021-05-20 13:49:50', '2021-05-20 13:49:50'),
(13, 'firstFull', 'lastFull', 'email@fullirn.com', '$2y$10$n8nHmkuXB0IsKAItTYh3S.815qkHxlyDVinUXTpYdKzj.9xh0dE7e', NULL, NULL, NULL, NULL, NULL, '34', NULL, 'M', NULL, NULL, NULL, NULL, NULL, 'customer', NULL, 1, NULL, NULL, '2021-05-20 13:51:17', '2021-05-20 13:51:17'),
(14, 'ssss', 'eee', 'sss@cc.com', '$2y$10$y2gVy7NSG.IiqZIk6sRtGOF0H.S52Ugnbeun/YL0Wh.aG1APwmBCq', NULL, NULL, NULL, NULL, NULL, '65', NULL, 'M', NULL, NULL, NULL, NULL, NULL, 'consultant', NULL, 1, NULL, NULL, '2021-05-20 13:54:26', '2021-05-20 13:54:26'),
(15, 'apiregister', 'API_REGISTERLAST', 'api@email.com', '$2y$10$qylpJI4hR8HMw7aXRgqRHuJPqnw2/4y5Fi3LZ/xv0mj/TEfcRBNWm', NULL, NULL, NULL, NULL, NULL, '248', NULL, 'M', NULL, NULL, NULL, NULL, NULL, 'customer', NULL, 1, NULL, NULL, '2021-05-20 14:29:11', '2021-05-20 14:29:11'),
(16, 'apiregisterw', 'API_REGISTERLAST', 'api2@email.com', '$2y$10$tRKXdcj8slMg6VHGN97xx.CfycMnQpqRrF40Ng0NKdYnfsfIo4V3q', NULL, NULL, NULL, NULL, NULL, '248', NULL, 'M', NULL, NULL, NULL, NULL, NULL, 'customer', NULL, 1, NULL, NULL, '2021-05-20 14:30:40', '2021-05-20 14:30:40'),
(17, 'apiregisterw', 'API_REGISTERLAST', 'api3@email.com', '$2y$10$j73B0JMBdcuMbNOOZjKpOuF/iciiIR2isREQUsMcFPK6v6yiBMU62', NULL, NULL, NULL, NULL, NULL, '248', NULL, 'M', NULL, NULL, NULL, NULL, NULL, 'customer', NULL, 1, NULL, NULL, '2021-05-20 14:31:00', '2021-05-20 14:31:00'),
(18, 'apiregisterw', 'API_REGISTERLAST', 'api4@email.com', '$2y$10$ZpLlXpEMEdSWeMEB8NfKzeqtPQXwH9Q5d2f0Y/m1JfF5QrW1bkpcq', NULL, NULL, NULL, NULL, NULL, '248', NULL, 'M', NULL, NULL, NULL, NULL, NULL, 'customer', NULL, 1, NULL, NULL, '2021-05-20 14:32:33', '2021-05-20 14:32:33'),
(19, 'apiregisterw', 'API_REGISTERLAST', 'ap1i4@email.com', '$2y$10$8z0JfEO7TRqD5H3g8RKCf.kTk2AyEIL3RGGc5Fjkf.dsLMj5LLycW', NULL, NULL, NULL, NULL, NULL, '248', NULL, 'M', NULL, NULL, NULL, NULL, NULL, 'customer', NULL, 1, NULL, NULL, '2021-05-20 14:32:55', '2021-05-20 14:32:55'),
(20, 'apiregisterw', 'API_REGISTERLAST', 'ap1is4@email.com', '$2y$10$7MOQim2wNX.yyXnNo0bC0.JToAGirWyXgTMZ4rSXfEbJQDYRJdERW', NULL, NULL, NULL, NULL, NULL, '248', NULL, 'M', NULL, NULL, NULL, NULL, NULL, 'customer', NULL, 1, NULL, NULL, '2021-05-20 14:35:42', '2021-05-20 14:35:42'),
(21, 'apiregisterw', 'API_REGISTERLAST', 'ap1iss4@email.com', '$2y$10$4kHP1m.bANjnu0eQt18vMerWjne5uVTQ1bvlQ.tSDb9XhKPZOn9/i', NULL, NULL, NULL, NULL, NULL, '248', NULL, 'M', NULL, NULL, NULL, NULL, NULL, 'customer', NULL, 1, NULL, NULL, '2021-05-20 14:35:56', '2021-05-20 14:35:56'),
(22, 'apiregisterw', 'API_REGISTERLAST', 'sap1iss4@email.com', '$2y$10$rDzRv9Mj4YMWaaBiEtINseLkAA0O3lC6Tew1JbamOYgrgCbhHyzFi', NULL, NULL, NULL, NULL, NULL, '248', NULL, 'M', NULL, NULL, NULL, NULL, NULL, 'customer', NULL, 1, NULL, NULL, '2021-05-20 14:37:52', '2021-05-20 14:37:52'),
(23, 'apiregisterw', 'API_REGISTERLAST', 'saps1iss4@email.com', '$2y$10$BPSXg/GbTkvBowoo/0WoTecpiK5L6hAr5YGRTQHDuXRaty2QIzNQy', NULL, NULL, NULL, NULL, NULL, '248', NULL, 'M', NULL, NULL, NULL, NULL, NULL, 'customer', NULL, 1, NULL, NULL, '2021-05-20 14:39:13', '2021-05-20 14:39:13'),
(24, 'after_marge', 'last_marg', 'marg@email.com', '$2y$10$JFVgvuoCaS1fINDjPWowqO0yyGZeb6STHYnZEo0eWPdXhilP5pDaO', NULL, NULL, NULL, NULL, NULL, '248', NULL, 'M', NULL, NULL, NULL, NULL, NULL, 'customer', NULL, 1, NULL, NULL, '2021-05-25 13:52:37', '2021-05-25 13:52:37'),
(25, 'after_marge', 'last_marg', 'marging@email.com', '$2y$10$y9AI7e46Tp.0G2FOmf2IrOIUkx.tWTUoyz7PIfu4N8xDGzxi/HpEe', NULL, NULL, NULL, NULL, NULL, '248', NULL, 'M', NULL, NULL, NULL, NULL, NULL, 'customer', NULL, 1, NULL, NULL, '2021-05-25 13:57:37', '2021-05-25 13:57:37'),
(26, 'first_regiset', 'last_regist', 'email@regist.com', '$2y$10$IZxcMSFRzs/oH5FVxGHwResCj.yvCnu4g5KOv5.P5LX/3Qnnnkadm', NULL, NULL, NULL, NULL, NULL, '248', NULL, 'M', NULL, NULL, NULL, NULL, NULL, 'customer', NULL, 1, NULL, NULL, '2021-05-29 16:44:34', '2021-05-29 16:44:34'),
(27, 'after_merg_eman', 'eman', 'eman@merge.com', '$2y$10$ZWwpGRkXLwnedOQu9cM1wOT73nxOd/z.pNmTOIVV/U/b9KqWd1kH6', NULL, NULL, NULL, NULL, NULL, '248', NULL, 'M', NULL, NULL, NULL, NULL, NULL, 'customer', NULL, 1, NULL, NULL, '2021-05-29 19:51:39', '2021-05-29 19:51:39'),
(28, 'mimiiii', 'miiiii', 'maili@maili.co', '$2y$10$yHUtqGGij8saPeb9IH1Ow.xu7KJQf3T4TuCpJKphPl5Tfiq4b1u3m', NULL, NULL, NULL, NULL, NULL, '104', NULL, 'M', NULL, NULL, NULL, NULL, NULL, 'customer', NULL, 1, NULL, NULL, '2021-05-29 20:05:27', '2021-05-29 20:05:27'),
(29, 'gataa', 'tadawul', 'tadawul@tada.com', '$2y$10$LJMQAdFJb5h1vK2YdsoAk.lumUXgRc0ISeJaBwuMTlnPzlyw3DDHa', NULL, NULL, NULL, NULL, NULL, '248', NULL, 'M', NULL, NULL, NULL, NULL, NULL, 'customer', NULL, 1, NULL, NULL, '2021-05-29 20:24:05', '2021-05-29 20:24:05');

-- --------------------------------------------------------

--
-- Table structure for table `customers_courses`
--

DROP TABLE IF EXISTS `customers_courses`;
CREATE TABLE IF NOT EXISTS `customers_courses` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `joined_date` timestamp NOT NULL,
  `last_subject_id` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'the last subject that customer interact with',
  `completed_subjects` json DEFAULT NULL,
  `final_degree` decimal(5,2) NOT NULL DEFAULT '0.00' COMMENT 'that will get in course',
  `level_result` enum('A','B','C','D') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'A',
  `customer_note` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customers_courses_course_id_foreign` (`course_id`),
  KEY `customers_courses_customer_id_foreign` (`customer_id`),
  KEY `customers_courses_last_subject_id_foreign` (`last_subject_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers_courses`
--

INSERT INTO `customers_courses` (`id`, `course_id`, `customer_id`, `joined_date`, `last_subject_id`, `completed_subjects`, `final_degree`, `level_result`, `customer_note`, `created_at`, `updated_at`) VALUES
(2, 5, 2, '2021-05-22 20:25:19', NULL, NULL, '0.00', 'A', NULL, '2021-05-22 20:25:19', '2021-05-22 20:25:19'),
(3, 5, 2, '2021-05-22 20:30:11', NULL, NULL, '0.00', 'A', NULL, '2021-05-22 20:30:11', '2021-05-22 20:30:11');

-- --------------------------------------------------------

--
-- Table structure for table `customers_loyalty_points_prices`
--

DROP TABLE IF EXISTS `customers_loyalty_points_prices`;
CREATE TABLE IF NOT EXISTS `customers_loyalty_points_prices` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `customer_s_p_ops_id` bigint(20) UNSIGNED DEFAULT NULL,
  `count_scores` decimal(15,2) NOT NULL DEFAULT '0.00',
  `score_type` enum('confirmed','deserved') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'deserved',
  `transferred` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'when transferred wil convert to equable price',
  `transferred_date` timestamp NULL DEFAULT NULL,
  `transferred_by` enum('admin','customer') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `loyaltyable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `loyaltyable_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `customers_loyalty_points_prices_customer_id_foreign` (`customer_id`),
  KEY `cust_loyalty_ops_index` (`loyaltyable_type`,`loyaltyable_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers_loyalty_points_prices`
--

INSERT INTO `customers_loyalty_points_prices` (`id`, `customer_id`, `customer_s_p_ops_id`, `count_scores`, `score_type`, `transferred`, `transferred_date`, `transferred_by`, `created_at`, `updated_at`, `loyaltyable_type`, `loyaltyable_id`) VALUES
(1, 2, NULL, '12.00', 'confirmed', 0, NULL, NULL, '2021-05-22 20:25:19', '2021-05-22 20:25:19', '\\App\\Models\\CourseTraining', 2),
(2, 2, NULL, '12.00', 'confirmed', 0, NULL, NULL, '2021-05-22 20:30:11', '2021-05-22 20:30:11', '\\App\\Models\\CourseTraining', 3),
(3, 1, NULL, '10.00', 'confirmed', 0, NULL, NULL, '2021-05-29 21:53:37', '2021-05-29 21:53:37', '\\App\\Models\\TransferWithdrawOrder', 14),
(4, 1, NULL, '10.00', 'confirmed', 0, NULL, NULL, '2021-05-29 22:07:27', '2021-05-29 22:07:27', '\\App\\Models\\TransferWithdrawOrder', 15),
(5, 1, NULL, '10.00', 'confirmed', 0, NULL, NULL, '2021-05-29 22:11:33', '2021-05-29 22:11:33', '\\App\\Models\\TransferWithdrawOrder', 16),
(6, 1, NULL, '10.00', 'confirmed', 0, NULL, NULL, '2021-05-29 22:11:42', '2021-05-29 22:11:42', '\\App\\Models\\TransferWithdrawOrder', 17);

-- --------------------------------------------------------

--
-- Table structure for table `customers_services_packages`
--

DROP TABLE IF EXISTS `customers_services_packages`;
CREATE TABLE IF NOT EXISTS `customers_services_packages` (
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer_banking_accounts`
--

DROP TABLE IF EXISTS `customer_banking_accounts`;
CREATE TABLE IF NOT EXISTS `customer_banking_accounts` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `account_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_type` enum('cash','wallet') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'cash',
  `receiving_agencies_country_id` bigint(20) UNSIGNED NOT NULL,
  `country_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `account_number_unique` (`account_number`,`receiving_agencies_country_id`),
  KEY `customer_banking_accounts_customer_id_foreign` (`customer_id`),
  KEY `customer_banking_accounts_receiving_agencies_country_id_foreign` (`receiving_agencies_country_id`),
  KEY `customer_banking_accounts_country_code_foreign` (`country_code`),
  KEY `customer_banking_accounts_currency_id_foreign` (`currency_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer_consultants_orders`
--

DROP TABLE IF EXISTS `customer_consultants_orders`;
CREATE TABLE IF NOT EXISTS `customer_consultants_orders` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `consultant_id` bigint(20) UNSIGNED NOT NULL,
  `price` decimal(11,2) NOT NULL DEFAULT '0.00',
  `is_open` tinyint(1) NOT NULL,
  `current_status` enum('pending','processing','succeed','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `paid_status` enum('not_paid','paid','part_paid') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'not_paid',
  `reference_id_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_consultants_orders_customer_id_foreign` (`customer_id`),
  KEY `customer_consultants_orders_consultant_id_foreign` (`consultant_id`),
  KEY `customer_consultants_orders_currency_id_foreign` (`currency_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_consultants_orders`
--

INSERT INTO `customer_consultants_orders` (`id`, `customer_id`, `consultant_id`, `price`, `is_open`, `current_status`, `paid_status`, `reference_id_type`, `currency_id`, `created_at`, `updated_at`) VALUES
(1, 2, 3, '2.00', 1, 'pending', 'paid', NULL, 1, '2021-05-22 20:31:47', '2021-05-22 20:36:48');

-- --------------------------------------------------------

--
-- Table structure for table `customer_d_c_orders`
--

DROP TABLE IF EXISTS `customer_d_c_orders`;
CREATE TABLE IF NOT EXISTS `customer_d_c_orders` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `current_status` enum('ordering','order_accepted','customer_canceled','admin_rejected','in_processing','order_completed','canceled_by_admin') COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_amount` decimal(8,2) NOT NULL DEFAULT '0.00',
  `customer_hint` text COLLATE utf8mb4_unicode_ci,
  `admin_note` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_d_c_orders_customer_id_foreign` (`customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer_d_c_order_details`
--

DROP TABLE IF EXISTS `customer_d_c_order_details`;
CREATE TABLE IF NOT EXISTS `customer_d_c_order_details` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `digital_card_id` bigint(20) UNSIGNED NOT NULL,
  `card_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'when order accept and admin will put code here',
  `description` text COLLATE utf8mb4_unicode_ci COMMENT 'instruction about using',
  `cost_price` decimal(13,2) DEFAULT NULL,
  `currency_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_d_c_order_details_order_id_foreign` (`order_id`),
  KEY `customer_d_c_order_details_digital_card_id_foreign` (`digital_card_id`),
  KEY `customer_d_c_order_details_currency_id_foreign` (`currency_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer_finance_accounts`
--

DROP TABLE IF EXISTS `customer_finance_accounts`;
CREATE TABLE IF NOT EXISTS `customer_finance_accounts` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `agency_id` bigint(20) UNSIGNED NOT NULL,
  `agency_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_agency_acc_number` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_number_acc_customers` (`customer_id`,`agency_id`,`customer_agency_acc_number`),
  KEY `cutomer_finance_accounts_agency_id_foreign` (`agency_id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_finance_accounts`
--

INSERT INTO `customer_finance_accounts` (`id`, `customer_id`, `agency_id`, `agency_name`, `customer_agency_acc_number`, `created_at`, `updated_at`) VALUES
(11, 1, 2, NULL, '23423223', '2021-05-24 14:52:30', '2021-05-25 11:33:34'),
(12, 1, 3, NULL, '234234888', '2021-05-24 18:58:54', '2021-05-29 22:38:42'),
(13, 25, 1, 'KoraimiAgency', NULL, '2021-05-25 13:58:00', '2021-05-25 13:58:00'),
(14, 25, 2, 'expressAgency', NULL, '2021-05-25 13:58:00', '2021-05-25 13:58:00'),
(15, 2, 2, 'expressAgency', 'qweqweqwe', NULL, NULL),
(16, 2, 1, 'a238473294', NULL, NULL, NULL),
(17, 26, 1, 'KoraimiAgency', NULL, '2021-05-29 16:44:34', '2021-05-29 16:44:34'),
(18, 26, 2, 'expressAgency', NULL, '2021-05-29 16:44:34', '2021-05-29 16:44:34'),
(19, 26, 4, 'النجم للصرافة والتحويلات', NULL, '2021-05-29 16:44:34', '2021-05-29 16:44:34'),
(20, 27, 1, 'KoraimiAgency', NULL, '2021-05-29 19:51:39', '2021-05-29 19:51:39'),
(21, 27, 2, 'expressAgency', NULL, '2021-05-29 19:51:39', '2021-05-29 19:51:39'),
(22, 27, 4, 'النجم للصرافة والتحويلات', NULL, '2021-05-29 19:51:39', '2021-05-29 19:51:39'),
(23, 28, 1, 'KoraimiAgency', NULL, '2021-05-29 20:05:27', '2021-05-29 20:05:27'),
(24, 28, 2, 'expressAgency', NULL, '2021-05-29 20:05:27', '2021-05-29 20:05:27'),
(25, 28, 4, 'النجم للصرافة والتحويلات', NULL, '2021-05-29 20:05:27', '2021-05-29 20:05:27'),
(26, 29, 1, 'KoraimiAgency', NULL, '2021-05-29 20:24:05', '2021-05-29 20:24:05'),
(27, 29, 2, 'expressAgency', NULL, '2021-05-29 20:24:05', '2021-05-29 20:24:05'),
(28, 29, 4, 'النجم للصرافة والتحويلات', NULL, '2021-05-29 20:24:05', '2021-05-29 20:24:05'),
(29, 1, 4, NULL, '767868', '2021-05-29 22:38:17', '2021-05-29 22:38:30');

-- --------------------------------------------------------

--
-- Table structure for table `customer_s_p_ops`
--

DROP TABLE IF EXISTS `customer_s_p_ops`;
CREATE TABLE IF NOT EXISTS `customer_s_p_ops` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `service_package_id` bigint(20) UNSIGNED NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci COMMENT 'this will fill by customer',
  `link_url` text COLLATE utf8mb4_unicode_ci,
  `file_path` text COLLATE utf8mb4_unicode_ci,
  `current_status` enum('ordering','order_accepted','customer_canceled','admin_rejected','in_processing','order_completed','canceled_by_admin') COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_open` tinyint(1) NOT NULL DEFAULT '1',
  `ip_address` text COLLATE utf8mb4_unicode_ci,
  `device_type` enum('web','mobile') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'web',
  `device_info` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_note` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_s_p_ops_customer_id_foreign` (`customer_id`),
  KEY `customer_s_p_ops_service_package_id_foreign` (`service_package_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `deposit_agencies`
--

DROP TABLE IF EXISTS `deposit_agencies`;
CREATE TABLE IF NOT EXISTS `deposit_agencies` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `national` enum('national','international') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'national',
  `description` text COLLATE utf8mb4_unicode_ci,
  `img_path` mediumtext COLLATE utf8mb4_unicode_ci,
  `address` mediumtext COLLATE utf8mb4_unicode_ci,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `deposit_agencies`
--

INSERT INTO `deposit_agencies` (`id`, `name`, `national`, `description`, `img_path`, `address`, `phone`, `active`, `created_at`, `updated_at`) VALUES
(1, '{\"ar\":\"KoraimiAgency\"}', 'national', '{\"ar\":\"ايداع لنا عن طريق هذا الحساب\"}', 'storage/deposit_agencies/3db82839a96796f327a69152a1a5fad7.png', NULL, NULL, 1, '2021-04-15 18:15:18', '2021-05-24 14:06:39'),
(2, '{\"ar\":\"expressAgency\"}', 'national', '{\"ar\":\"ايداع لنا عن طريق هذا الحساب\"}', 'storage/deposit_agencies/9c110b0f356f8c3b01aedb18b200f503.png', NULL, NULL, 1, '2021-04-15 18:15:51', '2021-05-24 14:07:18'),
(3, '{\"ar\":\"Paypal\"}', 'international', '{\"ar\":\"الايداع من  هذا الحساب\"}', 'storage/deposit_agencies/644190a55abcff04bd44ea1013dffd8c.png', NULL, NULL, 1, '2021-05-19 12:32:46', '2021-05-19 12:32:46'),
(4, '{\"ar\":\"النجم للصرافة والتحويلات\"}', 'national', '{\"ar\":\"سيتم تلقي ايداعكعبر هذة الشركة\"}', 'storage/deposit_agencies/3772db030d8b75ddd3487aca30167e22.png', 'صنعاي', NULL, 1, '2021-05-25 15:11:25', '2021-05-25 15:11:25'),
(5, '{\"ar\":\"Payeer\"}', 'international', '{\"ar\":\"لاشي\"}', NULL, 'اين تقع', NULL, 1, '2021-05-28 17:32:34', '2021-05-28 17:32:34');

-- --------------------------------------------------------

--
-- Table structure for table `deposit_agencies_methods`
--

DROP TABLE IF EXISTS `deposit_agencies_methods`;
CREATE TABLE IF NOT EXISTS `deposit_agencies_methods` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `deposit_agency_id` bigint(20) UNSIGNED NOT NULL,
  `deposit_method_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `agencies_deposit_methods_deposit_agency_id_foreign` (`deposit_agency_id`),
  KEY `agencies_deposit_methods_deposit_method_id_foreign` (`deposit_method_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `deposit_agencies_methods`
--

INSERT INTO `deposit_agencies_methods` (`id`, `deposit_agency_id`, `deposit_method_id`, `created_at`, `updated_at`) VALUES
(1, 2, 1, NULL, NULL),
(2, 2, 2, NULL, NULL),
(3, 2, 3, NULL, NULL),
(4, 2, 4, NULL, NULL),
(5, 1, 1, NULL, NULL),
(6, 1, 3, NULL, NULL),
(7, 3, 2, NULL, NULL),
(8, 4, 1, NULL, NULL),
(9, 4, 3, NULL, NULL),
(10, 5, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `deposit_agency_countries`
--

DROP TABLE IF EXISTS `deposit_agency_countries`;
CREATE TABLE IF NOT EXISTS `deposit_agency_countries` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `deposit_agency_id` bigint(20) UNSIGNED NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `ytadawul_account_number` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'ytadawul account number in this country_id for this agency_id',
  `description` text COLLATE utf8mb4_unicode_ci COMMENT 'here will show the description for client how will we receive deposit from him ',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `deposit_agency_countries_deposit_agency_id_foreign` (`deposit_agency_id`),
  KEY `deposit_agency_countries_country_id_foreign` (`country_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `deposit_agency_countries`
--

INSERT INTO `deposit_agency_countries` (`id`, `deposit_agency_id`, `country_id`, `ytadawul_account_number`, `description`, `created_at`, `updated_at`) VALUES
(1, 2, 67, '333', NULL, NULL, NULL),
(2, 2, 188, '122345565', '{\"ar\":null}', NULL, '2021-05-29 22:44:58'),
(3, 2, 248, '12121212', '{\"ar\":null}', NULL, '2021-05-29 22:44:37'),
(5, 1, 248, '580458230485', '{\"ar\":null}', NULL, '2021-04-15 18:32:12'),
(6, 1, 125, '333', NULL, NULL, NULL),
(7, 1, 126, '345345345', '{\"ar\":\"5ertete\"}', NULL, '2021-04-22 09:12:08'),
(8, 4, 67, NULL, NULL, NULL, NULL),
(9, 4, 188, NULL, NULL, NULL, NULL),
(10, 4, 248, NULL, NULL, NULL, NULL),
(11, 5, 241, '3224234', '{\"ar\":null}', NULL, '2021-05-28 18:00:11');

-- --------------------------------------------------------

--
-- Table structure for table `deposit_methods`
--

DROP TABLE IF EXISTS `deposit_methods`;
CREATE TABLE IF NOT EXISTS `deposit_methods` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deposit_type` enum('cash','electronic_bank','bank_deposit','bitcoin','earning_withdrawals') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'cash',
  `description` text COLLATE utf8mb4_unicode_ci,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `deposit_methods`
--

INSERT INTO `deposit_methods` (`id`, `name`, `deposit_type`, `description`, `active`, `created_at`, `updated_at`) VALUES
(1, '{\"ar\":\"تحويل مصرفي مباشر\",\"en\":\"cash\"}', 'cash', '{\"ar\":\"مثلا تحويل عن طريق النجم أو غيره\"}', 1, '2021-04-15 18:03:55', '2021-04-25 17:26:52'),
(2, '{\"ar\":\"ايداع من حساب بنكي الكتروني\",\"en\":\"electronic_bank\"}', 'electronic_bank', '{\"en\":null}', 1, '2021-04-15 18:05:13', '2021-04-15 18:06:41'),
(3, '{\"ar\":\"ايداع من حساب بنكي عادي\",\"en\":\"bank_deposit\"}', 'bank_deposit', '{\"en\":null}', 1, '2021-04-15 18:05:34', '2021-04-15 18:06:58'),
(4, '{\"ar\":\"ايداع من عملةرقمية\",\"en\":\"bitcoin_deposit\"}', 'bitcoin', '{\"en\":null}', 1, '2021-04-15 18:05:51', '2021-04-15 18:07:18'),
(6, '{\"ar\":\"عن طريق سحب الارباح من مواقع العمل الحر\"}', 'earning_withdrawals', '{\"ar\":null}', 1, '2021-05-25 19:37:13', '2021-05-25 19:37:13');

-- --------------------------------------------------------

--
-- Table structure for table `deposit_orders`
--

DROP TABLE IF EXISTS `deposit_orders`;
CREATE TABLE IF NOT EXISTS `deposit_orders` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `deposit_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `op_type` enum('deposit','withdraw') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'deposit' COMMENT 'is deposit or withdrawals',
  `order_type` enum('normal_deposit','normal_withdraw','pull_earning','paying_order') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'normal_deposit' COMMENT 'this col to know the deposit type not ..',
  `amount` decimal(13,2) NOT NULL,
  `currency_id` bigint(20) UNSIGNED NOT NULL DEFAULT '1',
  `exchange_price` decimal(11,4) NOT NULL DEFAULT '1.0000' COMMENT 'the exchange price per USD in deposit moment ',
  `fee_percent` decimal(5,2) NOT NULL DEFAULT '0.00',
  `withdraw_fee` decimal(13,4) NOT NULL DEFAULT '0.0000',
  `customer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deposit_type` enum('electronic_bank','bitcoin','cash','bank_deposit','earning_withdrawals') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'cash',
  `deposit_agency_country_id` bigint(20) UNSIGNED DEFAULT NULL,
  `customer_finance_account` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `current_status` enum('pending','rejected','confirmed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `status_note` text COLLATE utf8mb4_unicode_ci COMMENT 'when rejected or when still pending',
  `status_changed_date` timestamp NULL DEFAULT NULL,
  `confirmed_code` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'DEPRECATED the voucher id in transaction head or the deposit_id in wallet',
  `detail_statement` text COLLATE utf8mb4_unicode_ci,
  `admin_id` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'who confirmed this op',
  `img_path` text COLLATE utf8mb4_unicode_ci,
  `reference_id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'will be filled by customer and reviewed by admin',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `deposit_orders_confirmed_code_unique` (`confirmed_code`),
  KEY `deposit_orders_currency_id_foreign` (`currency_id`),
  KEY `deposit_orders_customer_id_foreign` (`customer_id`),
  KEY `deposit_orders_deposit_agency_country_id_foreign` (`deposit_agency_country_id`),
  KEY `deposit_orders_admin_id_foreign` (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `deposit_orders`
--

INSERT INTO `deposit_orders` (`id`, `deposit_date`, `op_type`, `order_type`, `amount`, `currency_id`, `exchange_price`, `fee_percent`, `withdraw_fee`, `customer_id`, `deposit_type`, `deposit_agency_country_id`, `customer_finance_account`, `current_status`, `status_note`, `status_changed_date`, `confirmed_code`, `detail_statement`, `admin_id`, `img_path`, `reference_id`, `created_at`, `updated_at`) VALUES
(1, '2021-04-30 00:00:00', 'deposit', 'normal_deposit', '123.00', 1, '1.0000', '0.00', '0.0000', 3, 'cash', 5, '0', 'confirmed', '34', '2021-05-20 21:17:04', NULL, '34', 1, NULL, '34', '2021-04-23 19:15:13', '2021-05-20 21:17:04'),
(2, '2021-04-08 00:00:00', 'deposit', 'normal_deposit', '34.00', 1, '2.0000', '0.00', '0.0000', 2, 'electronic_bank', 6, '0', 'confirmed', '234', '2021-05-20 20:10:29', NULL, '234', 1, NULL, '234', '2021-04-23 20:17:35', '2021-05-20 20:10:29'),
(3, '2021-05-05 00:00:00', 'deposit', 'normal_deposit', '0.00', 1, '1.0000', '0.00', '0.0000', 1, 'bank_deposit', 5, '0', 'confirmed', NULL, '2021-05-20 20:16:17', NULL, NULL, 1, NULL, NULL, '2021-05-04 21:15:57', '2021-05-20 20:16:17'),
(4, '2021-05-05 00:00:00', 'deposit', 'normal_deposit', '0.00', 1, '1.0000', '0.00', '0.0000', 1, 'bitcoin', 5, '0', 'confirmed', NULL, '2021-05-20 20:06:54', NULL, NULL, 1, NULL, NULL, '2021-05-04 21:17:55', '2021-05-20 20:06:54'),
(5, '2021-05-05 00:00:00', 'deposit', 'normal_deposit', '12.00', 1, '1.0000', '0.00', '0.0000', 23, 'bitcoin', 5, '0', 'confirmed', 'werwer', '2021-05-20 19:23:51', NULL, 'wer', 1, NULL, '23', '2021-05-04 21:19:08', '2021-05-20 19:23:51'),
(6, '2021-05-05 00:00:00', 'deposit', 'normal_deposit', '15.00', 1, '1.0000', '0.00', '0.0000', 1, 'cash', 5, '0', 'confirmed', NULL, '2021-05-20 22:25:47', NULL, '23', 1, NULL, NULL, '2021-05-04 21:27:51', '2021-05-20 22:25:47'),
(7, '2020-12-12 00:00:00', 'deposit', 'normal_deposit', '23.00', 1, '1.0000', '0.00', '0.0000', 1, 'electronic_bank', 3, '0', 'confirmed', NULL, '2021-05-22 19:36:46', NULL, 'يالله', 1, NULL, NULL, '2021-05-22 19:24:15', '2021-05-22 19:36:46'),
(8, '2020-12-12 00:00:00', 'deposit', 'normal_deposit', '25.00', 1, '1.0000', '0.00', '0.0000', 3, 'electronic_bank', 3, '0', 'confirmed', NULL, '2021-05-22 19:43:15', NULL, 'aa', 1, NULL, NULL, '2021-05-22 19:41:39', '2021-05-22 19:43:15'),
(9, '2020-12-12 00:00:00', 'deposit', 'normal_deposit', '35.00', 1, '1.0000', '0.00', '0.0000', 2, 'electronic_bank', 3, '0', 'confirmed', NULL, '2021-05-22 19:45:59', NULL, 'wer', 1, NULL, NULL, '2021-05-22 19:45:31', '2021-05-22 19:45:59'),
(10, '2021-05-24 22:29:27', 'deposit', 'normal_deposit', '33.00', 1, '1.0000', '0.00', '0.0000', 1, 'bank_deposit', 3, '0', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-24 19:29:34', '2021-05-24 19:29:34'),
(11, '2021-05-25 02:03:43', 'withdraw', 'normal_deposit', '44.00', 1, '1.0000', '0.00', '0.0000', 1, 'bank_deposit', 3, '0', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-24 20:03:43', '2021-05-24 20:03:43'),
(12, '2021-05-25 02:05:08', 'withdraw', 'normal_deposit', '600.00', 2, '1.0000', '0.00', '0.0000', 1, 'bank_deposit', 3, '0', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-24 20:05:08', '2021-05-24 20:05:08'),
(13, '2021-05-25 02:19:28', 'withdraw', 'normal_deposit', '600.00', 2, '1.0000', '0.00', '0.0000', 1, 'bank_deposit', 3, '888777', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-24 20:19:28', '2021-05-24 20:19:28'),
(14, '2021-05-25 03:13:02', 'withdraw', 'normal_deposit', '44.00', 1, '1.0000', '0.44', '0.0100', 1, 'bank_deposit', 3, '888777', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-24 21:13:02', '2021-05-24 21:13:02'),
(15, '2020-12-12 00:00:00', 'deposit', 'normal_deposit', '35.00', 1, '1.0000', '0.00', '0.0000', 2, 'electronic_bank', 3, '0', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-27 19:15:25', '2021-05-27 19:15:25'),
(16, '2021-05-28 02:06:18', 'withdraw', 'normal_withdraw', '30.00', 1, '1.0000', '0.30', '0.0100', 2, 'bank_deposit', 3, 'qweqweqwe', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-27 20:06:18', '2021-05-27 20:06:18'),
(17, '2021-05-28 02:09:55', 'withdraw', 'normal_withdraw', '30.00', 1, '1.0000', '0.30', '0.0100', 2, 'bank_deposit', 3, 'qweqweqwe', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-27 20:09:55', '2021-05-27 20:09:55'),
(18, '2021-05-27 23:41:20', 'deposit', 'pull_earning', '30.00', 1, '1.0000', '0.00', '0.0000', 2, 'electronic_bank', 3, '0', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-27 20:41:26', '2021-05-27 20:41:26'),
(19, '2021-05-28 00:21:16', 'deposit', 'pull_earning', '30.00', 1, '1.0000', '0.00', '0.0000', 2, 'electronic_bank', 3, '0', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-27 21:21:16', '2021-05-27 21:21:16'),
(20, '2021-05-28 03:23:16', 'withdraw', 'normal_withdraw', '30.00', 1, '1.0000', '0.30', '0.0100', 2, 'bank_deposit', 3, 'qweqweqwe', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-27 21:23:16', '2021-05-27 21:23:16'),
(21, '2020-12-12 00:00:00', 'deposit', 'normal_deposit', '35.00', 1, '1.0000', '0.00', '0.0000', 2, 'electronic_bank', 3, '0', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-27 21:23:25', '2021-05-27 21:23:25'),
(22, '2021-05-28 02:46:19', 'deposit', 'normal_deposit', '50.00', 2, '1.0000', '0.00', '0.0000', 1, 'cash', 5, '0', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-27 23:46:19', '2021-05-27 23:46:19'),
(23, '2021-05-30 01:45:41', 'deposit', 'normal_deposit', '50.00', 1, '1.0000', '0.00', '0.0000', 1, 'cash', 3, '0', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-29 22:45:41', '2021-05-29 22:45:41'),
(24, '2021-05-30 00:00:00', 'withdraw', 'normal_withdraw', '23.00', 1, '1.0000', '0.50', '0.0100', 1, 'bank_deposit', 3, '23423223', 'pending', NULL, '2021-05-29 23:04:02', NULL, NULL, 1, NULL, NULL, '2021-05-29 22:46:39', '2021-05-29 23:04:02');

-- --------------------------------------------------------

--
-- Table structure for table `deposit_withdraw_processes`
--

DROP TABLE IF EXISTS `deposit_withdraw_processes`;
CREATE TABLE IF NOT EXISTS `deposit_withdraw_processes` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `processable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `processable_id` bigint(20) UNSIGNED NOT NULL,
  `transfer_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference_id_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin_id` bigint(20) UNSIGNED NOT NULL COMMENT 'who confirmed this op',
  `admin_note` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `deposit_withdraw_processes_processable_type_processable_id_index` (`processable_type`,`processable_id`),
  KEY `deposit_withdraw_processes_admin_id_foreign` (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detail_transactions`
--

DROP TABLE IF EXISTS `detail_transactions`;
CREATE TABLE IF NOT EXISTS `detail_transactions` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `voucher_id` bigint(20) UNSIGNED NOT NULL,
  `account_number` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `credit` decimal(13,4) NOT NULL DEFAULT '0.0000',
  `debit` decimal(13,4) NOT NULL DEFAULT '0.0000',
  `detailed_statement` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference_id` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `detail_transactions_voucher_id_foreign` (`voucher_id`),
  KEY `detail_transactions_account_number_foreign` (`account_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `digital_cards`
--

DROP TABLE IF EXISTS `digital_cards`;
CREATE TABLE IF NOT EXISTS `digital_cards` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `provider_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(2000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `img_path` text COLLATE utf8mb4_unicode_ci,
  `img_path_en` text COLLATE utf8mb4_unicode_ci,
  `price` decimal(11,2) NOT NULL DEFAULT '0.00',
  `currency_id` bigint(20) UNSIGNED NOT NULL,
  `discount` decimal(11,2) NOT NULL DEFAULT '0.00',
  `bound_value` decimal(11,2) DEFAULT NULL COMMENT 'amount or the value of card per to 1USD dollar',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `digital_cards_provider_id_foreign` (`provider_id`),
  KEY `digital_cards_currency_id_foreign` (`currency_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `digital_cards_providers`
--

DROP TABLE IF EXISTS `digital_cards_providers`;
CREATE TABLE IF NOT EXISTS `digital_cards_providers` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(2000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `img_path` text COLLATE utf8mb4_unicode_ci,
  `img_path_en` text COLLATE utf8mb4_unicode_ci,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `digital_cards_purchases`
--

DROP TABLE IF EXISTS `digital_cards_purchases`;
CREATE TABLE IF NOT EXISTS `digital_cards_purchases` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `purchase_date` timestamp NULL DEFAULT NULL,
  `credit_account_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '1010001',
  `total_invoice` decimal(13,2) NOT NULL DEFAULT '0.00',
  `currency_id` bigint(20) UNSIGNED NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `reference_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `digital_cards_purchases_currency_id_foreign` (`currency_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `d_cards_purchases_details`
--

DROP TABLE IF EXISTS `d_cards_purchases_details`;
CREATE TABLE IF NOT EXISTS `d_cards_purchases_details` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `digital_cards_purchase_id` bigint(20) UNSIGNED NOT NULL,
  `digital_card_id` bigint(20) UNSIGNED NOT NULL,
  `card_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'when order accept and admin will put code here',
  `buy_price` decimal(13,2) NOT NULL DEFAULT '0.00',
  `expire_date` timestamp NULL DEFAULT NULL,
  `sell_price` decimal(13,2) DEFAULT NULL,
  `currency_id` bigint(20) UNSIGNED DEFAULT NULL,
  `card_status` enum('free','used','expired') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'free',
  `customer_d_c_order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `assign_date` timestamp NULL DEFAULT NULL COMMENT 'when the card assigned to the customer',
  `description` text COLLATE utf8mb4_unicode_ci COMMENT 'instruction about using',
  `assigned_type` enum('auto','by_admin') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'auto',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `card_code` (`digital_card_id`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `freelancing_platforms`
--

DROP TABLE IF EXISTS `freelancing_platforms`;
CREATE TABLE IF NOT EXISTS `freelancing_platforms` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img_path` mediumtext COLLATE utf8mb4_unicode_ci,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `freelancing_platforms`
--

INSERT INTO `freelancing_platforms` (`id`, `name`, `img_path`, `active`, `created_at`, `updated_at`) VALUES
(1, 'خمسات', NULL, 1, '2021-05-19 12:52:39', '2021-05-19 12:52:39'),
(2, 'fsds', 'storage/freelancing/da0d4054d0cad0de52ee074fbe49c0bc.png', 1, '2021-05-19 12:52:57', '2021-05-19 12:59:22');

-- --------------------------------------------------------

--
-- Table structure for table `freelancing_platforms_deposit_agencies`
--

DROP TABLE IF EXISTS `freelancing_platforms_deposit_agencies`;
CREATE TABLE IF NOT EXISTS `freelancing_platforms_deposit_agencies` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `freelancing_platform_id` bigint(20) UNSIGNED NOT NULL,
  `deposit_agency_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `free_plat_FK` (`freelancing_platform_id`),
  KEY `free_agencies_FK` (`deposit_agency_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `freelancing_platforms_deposit_agencies`
--

INSERT INTO `freelancing_platforms_deposit_agencies` (`id`, `freelancing_platform_id`, `deposit_agency_id`, `created_at`, `updated_at`) VALUES
(1, 1, 3, NULL, NULL),
(2, 2, 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `head_transaction`
--

DROP TABLE IF EXISTS `head_transaction`;
CREATE TABLE IF NOT EXISTS `head_transaction` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `voucher_id` bigint(20) UNSIGNED NOT NULL,
  `voucher_type` enum('journal','receipt','payment','equation') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'journal',
  `total_voucher` decimal(13,4) NOT NULL COMMENT 'in USD',
  `voucher_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `detailed_statement` text COLLATE utf8mb4_unicode_ci,
  `reference_id` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'when typed from user ',
  `reference_type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `is_simple` tinyint(1) DEFAULT '1',
  `auto_created` tinyint(1) DEFAULT '1',
  `is_deported` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `head_transaction_voucher_id_unique` (`voucher_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

DROP TABLE IF EXISTS `languages`;
CREATE TABLE IF NOT EXISTS `languages` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `abbr` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `locale` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `local_name` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `flag` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `direction` enum('ltr','rtl') COLLATE utf8mb4_unicode_ci DEFAULT 'ltr',
  `date_format` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `datetime_format` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(1) DEFAULT '1',
  `default` tinyint(1) DEFAULT '0',
  `lft` int(10) UNSIGNED DEFAULT NULL,
  `rgt` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `languages_abbr_unique` (`abbr`),
  KEY `languages_active_index` (`active`),
  KEY `languages_default_index` (`default`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `abbr`, `locale`, `name`, `local_name`, `flag`, `direction`, `date_format`, `datetime_format`, `active`, `default`, `lft`, `rgt`, `created_at`, `updated_at`) VALUES
(1, 'en', 'en_US', 'English', 'English', NULL, 'ltr', 'MMM Do, YYYY', 'MMM Do, YYYY [at] HH:mm', 1, 0, 2, 3, '2021-02-18 12:30:07', '2021-05-20 17:43:55'),
(2, 'ar', 'ar_SA', 'Arabic', 'العربية', NULL, 'rtl', 'DD/MMMM/YYYY', 'DD/MMMM/YYYY HH:mm', 1, 1, 8, 9, '2021-02-18 12:30:07', '2021-05-20 17:43:55');

-- --------------------------------------------------------

--
-- Table structure for table `lib_transactions`
--

DROP TABLE IF EXISTS `lib_transactions`;
CREATE TABLE IF NOT EXISTS `lib_transactions` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `payable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payable_id` bigint(20) UNSIGNED NOT NULL,
  `wallet_id` bigint(20) UNSIGNED DEFAULT NULL,
  `type` enum('deposit','withdraw') COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(64,0) NOT NULL,
  `confirmed` tinyint(1) NOT NULL,
  `meta` json DEFAULT NULL,
  `reference_type` enum('normal_transaction','course_order','consulting_order','deposit_order','transfer_order','withdraw_order','d_card_parches_order','loyalty_point_transform','trading_cash_order','trading_live_order','trading_marketing_order') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'normal_transaction',
  `reference_id` bigint(20) UNSIGNED DEFAULT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `lib_transactions_uuid_unique` (`uuid`),
  KEY `lib_transactions_payable_type_payable_id_index` (`payable_type`,`payable_id`),
  KEY `payable_type_ind` (`payable_type`,`payable_id`,`type`),
  KEY `payable_confirmed_ind` (`payable_type`,`payable_id`,`confirmed`),
  KEY `payable_type_confirmed_ind` (`payable_type`,`payable_id`,`type`,`confirmed`),
  KEY `lib_transactions_type_index` (`type`),
  KEY `lib_transactions_wallet_id_foreign` (`wallet_id`)
) ENGINE=InnoDB AUTO_INCREMENT=173 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lib_transactions`
--

INSERT INTO `lib_transactions` (`id`, `payable_type`, `payable_id`, `wallet_id`, `type`, `amount`, `confirmed`, `meta`, `reference_type`, `reference_id`, `uuid`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\Customer', 3, 1, 'deposit', '1000', 1, NULL, 'normal_transaction', NULL, '6532ace0-4169-40cc-95d1-b00cfed987a1', '2021-03-30 22:04:46', '2021-03-30 22:04:46'),
(2, 'App\\Models\\Customer', 3, 1, 'deposit', '1005', 1, NULL, 'normal_transaction', NULL, 'babcb671-995b-48c5-a8f0-f6ed15c72d24', '2021-03-30 22:04:46', '2021-03-30 22:04:46'),
(3, 'App\\Models\\Customer', 3, 1, 'deposit', '1000', 1, NULL, 'normal_transaction', NULL, '3d1a890e-e80a-4dfc-8434-b7e3f7b4404e', '2021-03-30 22:11:02', '2021-03-30 22:11:02'),
(4, 'App\\Models\\Customer', 3, 1, 'deposit', '1033', 1, NULL, 'normal_transaction', NULL, '72834431-4e22-44f9-a914-11eb424f9005', '2021-03-30 22:11:02', '2021-03-30 22:11:02'),
(5, 'App\\Models\\Customer', 3, 1, 'deposit', '1000', 1, NULL, 'normal_transaction', NULL, 'a87491ff-3cf2-4c22-9b85-b159cc618436', '2021-03-30 22:12:23', '2021-03-30 22:12:23'),
(6, 'App\\Models\\Customer', 3, 1, 'deposit', '1033', 1, NULL, 'normal_transaction', NULL, 'ecd54598-9fd3-4b54-893e-6070ee6f7ec5', '2021-03-30 22:12:23', '2021-03-30 22:12:23'),
(7, 'App\\Models\\Customer', 3, 1, 'deposit', '1000', 1, NULL, 'normal_transaction', NULL, '82cc38db-89f3-41bf-a706-7801b78ea7ed', '2021-03-30 22:12:35', '2021-03-30 22:12:35'),
(8, 'App\\Models\\Customer', 3, 1, 'deposit', '1033', 1, NULL, 'normal_transaction', NULL, '4884eac2-9ff6-477c-aa32-64d758c99996', '2021-03-30 22:12:35', '2021-03-30 22:12:35'),
(9, 'App\\Models\\Customer', 3, 1, 'deposit', '1000', 1, NULL, 'normal_transaction', NULL, '70ec9ddf-0318-4174-87f9-d1d092466652', '2021-04-06 18:49:29', '2021-04-06 18:49:29'),
(10, 'App\\Models\\Customer', 3, 1, 'deposit', '1033', 1, NULL, 'normal_transaction', NULL, '8781c279-a326-40f3-bc2a-da65badf2ad1', '2021-04-06 18:49:29', '2021-04-06 18:49:29'),
(11, 'App\\Models\\Customer', 3, 1, 'deposit', '1000', 1, NULL, 'normal_transaction', NULL, '78849ee3-45ac-42aa-9490-f55aa197c00e', '2021-04-06 18:50:58', '2021-04-06 18:50:58'),
(12, 'App\\Models\\Customer', 3, 1, 'deposit', '1033', 1, NULL, 'normal_transaction', NULL, 'edb272cc-130c-412a-b7bc-12906cee70e6', '2021-04-06 18:50:58', '2021-04-06 18:50:58'),
(13, 'App\\Models\\Customer', 3, 1, 'deposit', '1000', 1, NULL, 'normal_transaction', NULL, 'c39a770d-3b3a-4ed4-a370-9ffd9b20199a', '2021-04-06 18:53:53', '2021-04-06 18:53:53'),
(14, 'App\\Models\\Customer', 3, 1, 'deposit', '1033', 1, NULL, 'normal_transaction', NULL, '7dd705e2-3245-405f-91a8-e741cc5ed7a9', '2021-04-06 18:53:53', '2021-04-06 18:53:53'),
(15, 'App\\Models\\Customer', 3, 1, 'deposit', '1000', 1, NULL, 'normal_transaction', NULL, '6d3295da-f2e1-491e-aea1-fb80505864e5', '2021-04-06 18:56:03', '2021-04-06 18:56:03'),
(16, 'App\\Models\\Customer', 3, 1, 'deposit', '1033', 1, NULL, 'normal_transaction', NULL, '872d3ffa-fa70-44f9-bf31-7da4e8e7444a', '2021-04-06 18:56:03', '2021-04-06 18:56:03'),
(17, 'App\\Models\\Customer', 3, 1, 'deposit', '1000', 1, NULL, 'normal_transaction', NULL, 'b5bb2035-e69f-41ba-b3b0-d05141f46409', '2021-04-06 18:56:38', '2021-04-06 18:56:38'),
(18, 'App\\Models\\Customer', 3, 1, 'deposit', '1033', 1, NULL, 'normal_transaction', NULL, '99fed50a-fd1b-467c-b469-764081d1bc74', '2021-04-06 18:56:39', '2021-04-06 18:56:39'),
(19, 'App\\Models\\Customer', 3, 1, 'deposit', '1000', 1, NULL, 'normal_transaction', NULL, 'eb497f4b-a0e8-4c70-b879-7bb8d92cb1f2', '2021-04-06 19:00:32', '2021-04-06 19:00:32'),
(20, 'App\\Models\\Customer', 3, 1, 'deposit', '1033', 1, NULL, 'normal_transaction', NULL, 'ae8a2504-64ff-4833-9813-ee3a46a55ce8', '2021-04-06 19:00:32', '2021-04-06 19:00:32'),
(21, 'App\\Models\\Customer', 3, 1, 'deposit', '1000', 1, NULL, 'normal_transaction', NULL, 'bf694510-da6d-4889-9cd2-583ab6369167', '2021-04-06 19:04:26', '2021-04-06 19:04:26'),
(22, 'App\\Models\\Customer', 3, 1, 'deposit', '1033', 1, NULL, 'normal_transaction', NULL, 'a339d054-90e7-4d70-8042-5020dad5c3f4', '2021-04-06 19:04:26', '2021-04-06 19:04:26'),
(23, 'App\\Models\\Customer', 3, 1, 'deposit', '1000', 1, NULL, 'normal_transaction', NULL, '82db0cf9-cfbe-4af6-b7a4-dbe2b1b75f16', '2021-04-06 19:05:17', '2021-04-06 19:05:17'),
(24, 'App\\Models\\Customer', 3, 1, 'deposit', '1033', 1, NULL, 'normal_transaction', NULL, '8003376d-1df3-4722-8557-32d97ab3a88f', '2021-04-06 19:05:17', '2021-04-06 19:05:17'),
(25, 'App\\Models\\Customer', 3, 1, 'deposit', '1000', 1, NULL, 'normal_transaction', NULL, '6e20059b-512b-45fa-b41e-35b7f11301bc', '2021-04-06 19:05:37', '2021-04-06 19:05:37'),
(26, 'App\\Models\\Customer', 3, 1, 'deposit', '1033', 1, NULL, 'normal_transaction', NULL, '45c4620b-ce35-4894-a69d-919c1452ac8e', '2021-04-06 19:05:37', '2021-04-06 19:05:37'),
(27, 'App\\Models\\Customer', 3, 1, 'deposit', '1000', 1, NULL, 'normal_transaction', NULL, '3dd9c0dc-efdb-4e3b-9c2c-acb5f7216744', '2021-04-06 19:06:06', '2021-04-06 19:06:06'),
(28, 'App\\Models\\Customer', 3, 1, 'deposit', '1033', 1, NULL, 'normal_transaction', NULL, '2f87e104-19ca-41e0-a8d6-2e69af8de450', '2021-04-06 19:06:07', '2021-04-06 19:06:07'),
(29, 'App\\Models\\Customer', 3, 1, 'deposit', '1000', 1, NULL, 'normal_transaction', NULL, '004188a2-7fdf-428e-b586-1405c8bf2cb7', '2021-04-06 19:11:19', '2021-04-06 19:11:19'),
(30, 'App\\Models\\Customer', 3, 1, 'deposit', '1033', 1, NULL, 'normal_transaction', NULL, '96a52ea2-8397-4124-923f-950aa07d97ed', '2021-04-06 19:11:19', '2021-04-06 19:11:19'),
(31, 'App\\Models\\Customer', 3, 1, 'deposit', '1000', 1, NULL, 'normal_transaction', NULL, '71b84fdd-657d-4228-b770-3c1d94bc96e2', '2021-04-06 19:12:54', '2021-04-06 19:12:54'),
(32, 'App\\Models\\Customer', 3, 1, 'deposit', '1033', 1, NULL, 'normal_transaction', NULL, '92623c77-195b-4e22-9a33-a961953cb24e', '2021-04-06 19:12:54', '2021-04-06 19:12:54'),
(33, 'App\\Models\\Customer', 3, 1, 'deposit', '1000', 1, NULL, 'normal_transaction', NULL, '13ddeb16-3914-40b4-a533-2efe391fc157', '2021-04-06 19:13:40', '2021-04-06 19:13:40'),
(34, 'App\\Models\\Customer', 3, 1, 'deposit', '1033', 1, NULL, 'normal_transaction', NULL, '23d956ab-f99d-4e0c-a492-436a993afd82', '2021-04-06 19:13:40', '2021-04-06 19:13:40'),
(35, 'App\\Models\\Customer', 3, 1, 'deposit', '1000', 1, NULL, 'normal_transaction', NULL, '91365550-cef9-4e44-a5d6-71445ce8d70f', '2021-04-06 19:14:15', '2021-04-06 19:14:15'),
(36, 'App\\Models\\Customer', 3, 1, 'deposit', '1033', 1, NULL, 'normal_transaction', NULL, '3e1a224b-43a2-4600-a42a-8e75318225a0', '2021-04-06 19:14:15', '2021-04-06 19:14:15'),
(37, 'App\\Models\\Customer', 3, 1, 'deposit', '1000', 1, NULL, 'normal_transaction', NULL, 'dd205f0f-9abd-45b6-b800-f041d4a3fef2', '2021-04-06 19:14:44', '2021-04-06 19:14:44'),
(38, 'App\\Models\\Customer', 3, 1, 'deposit', '1033', 1, NULL, 'normal_transaction', NULL, 'c1008aed-cf78-4cbe-9f12-31f2e6c5ff61', '2021-04-06 19:14:44', '2021-04-06 19:14:44'),
(39, 'App\\Models\\Customer', 3, 1, 'deposit', '1000', 1, NULL, 'normal_transaction', NULL, 'd735521e-bd7e-4e20-be14-6069c9cc821e', '2021-04-06 19:15:46', '2021-04-06 19:15:46'),
(40, 'App\\Models\\Customer', 3, 1, 'deposit', '1033', 1, NULL, 'normal_transaction', NULL, '3ab2dfec-a66e-4487-af69-6af95ba51289', '2021-04-06 19:15:46', '2021-04-06 19:15:46'),
(41, 'App\\Models\\Customer', 3, 1, 'deposit', '1000', 1, NULL, 'normal_transaction', NULL, '51a4addf-8410-445d-b133-340286128088', '2021-04-06 19:16:02', '2021-04-06 19:16:02'),
(42, 'App\\Models\\Customer', 3, 1, 'deposit', '1033', 1, NULL, 'normal_transaction', NULL, 'e7311371-0248-4931-8eac-9f669f76e32a', '2021-04-06 19:16:02', '2021-04-06 19:16:02'),
(43, 'App\\Models\\Customer', 3, 1, 'deposit', '1000', 1, NULL, 'normal_transaction', NULL, '4cbf3189-cef0-4bed-b2fe-4c60bc6e1f30', '2021-04-06 19:16:20', '2021-04-06 19:16:20'),
(44, 'App\\Models\\Customer', 3, 1, 'deposit', '1033', 1, NULL, 'normal_transaction', NULL, '0434c4d3-09e3-4d8b-b849-2b2648bd0c1d', '2021-04-06 19:16:20', '2021-04-06 19:16:20'),
(45, 'App\\Models\\Customer', 3, 1, 'deposit', '1000', 1, NULL, 'normal_transaction', NULL, '4fe296e8-bb6b-4966-be52-c38aeabf6b31', '2021-04-06 19:16:33', '2021-04-06 19:16:33'),
(46, 'App\\Models\\Customer', 3, 1, 'deposit', '1033', 1, NULL, 'normal_transaction', NULL, '91514028-390b-47b8-b0ab-189dd4366fe0', '2021-04-06 19:16:33', '2021-04-06 19:16:33'),
(47, 'App\\Models\\Customer', 3, 1, 'deposit', '1000', 1, NULL, 'normal_transaction', NULL, 'acb0c3f3-7692-4025-9f24-96db7b516ca1', '2021-04-06 19:17:01', '2021-04-06 19:17:01'),
(48, 'App\\Models\\Customer', 3, 1, 'deposit', '1033', 1, NULL, 'normal_transaction', NULL, '5cff05e5-ce76-4a2d-a94e-d9ffe3eaecb7', '2021-04-06 19:17:01', '2021-04-06 19:17:01'),
(49, 'App\\Models\\Customer', 3, 1, 'deposit', '1000', 1, NULL, 'normal_transaction', NULL, '9dbe6669-66dd-4451-aa77-3dd980e54dab', '2021-04-06 19:17:46', '2021-04-06 19:17:46'),
(50, 'App\\Models\\Customer', 3, 1, 'deposit', '1033', 1, NULL, 'normal_transaction', NULL, '515893db-94a3-4351-ac5f-e1c03a5f5765', '2021-04-06 19:17:46', '2021-04-06 19:17:46'),
(51, 'App\\Models\\Customer', 3, 1, 'deposit', '1000', 1, NULL, 'normal_transaction', NULL, '6f52c55a-39bc-4ec1-b2a4-a34a4dd2867c', '2021-04-06 19:17:59', '2021-04-06 19:17:59'),
(52, 'App\\Models\\Customer', 3, 1, 'deposit', '1033', 1, NULL, 'normal_transaction', NULL, '0346c901-2b07-4242-8a4d-1e5cc8ea3aa1', '2021-04-06 19:17:59', '2021-04-06 19:17:59'),
(53, 'App\\Models\\Customer', 3, 1, 'deposit', '1000', 1, NULL, 'normal_transaction', NULL, 'ba551db5-070d-4901-976e-483e7fefe6a7', '2021-04-06 19:18:36', '2021-04-06 19:18:36'),
(54, 'App\\Models\\Customer', 3, 1, 'deposit', '1033', 1, NULL, 'normal_transaction', NULL, '9bdfefac-b467-4b79-9d72-700eaf775a6e', '2021-04-06 19:18:36', '2021-04-06 19:18:36'),
(55, 'App\\Models\\Customer', 3, 1, 'deposit', '1000', 1, NULL, 'normal_transaction', NULL, 'e12a516c-9f55-40a1-aa74-225c0205ff1b', '2021-04-06 19:18:56', '2021-04-06 19:18:56'),
(56, 'App\\Models\\Customer', 3, 1, 'deposit', '1033', 1, NULL, 'normal_transaction', NULL, 'e4f5c389-7e82-49d7-96e2-a5e502670266', '2021-04-06 19:18:56', '2021-04-06 19:18:56'),
(57, 'App\\Models\\Customer', 3, 1, 'deposit', '1000', 1, NULL, 'normal_transaction', NULL, 'e9c0133e-37d5-4936-ad93-34eda9e2c46e', '2021-04-06 19:19:58', '2021-04-06 19:19:58'),
(58, 'App\\Models\\Customer', 3, 1, 'deposit', '1033', 1, NULL, 'normal_transaction', NULL, 'b9c23df4-1de5-4d76-a677-ebc20f1aaf72', '2021-04-06 19:19:58', '2021-04-06 19:19:58'),
(59, 'App\\Models\\Customer', 3, 1, 'deposit', '1000', 1, NULL, 'normal_transaction', NULL, '00e041f8-63ef-4e41-8f50-ef0f439028bb', '2021-04-06 19:20:17', '2021-04-06 19:20:17'),
(60, 'App\\Models\\Customer', 3, 1, 'deposit', '1033', 1, NULL, 'normal_transaction', NULL, 'a656f9df-09f4-4ec7-9657-7d2bd998137c', '2021-04-06 19:20:17', '2021-04-06 19:20:17'),
(61, 'App\\Models\\Customer', 3, 1, 'deposit', '1000', 1, NULL, 'normal_transaction', NULL, '80299bc0-46e7-4b3a-84f4-a325228213d7', '2021-04-06 19:20:52', '2021-04-06 19:20:52'),
(62, 'App\\Models\\Customer', 3, 1, 'deposit', '1033', 1, NULL, 'normal_transaction', NULL, '04d83307-2767-49ff-8ff1-c77009211650', '2021-04-06 19:20:52', '2021-04-06 19:20:52'),
(63, 'App\\Models\\Customer', 3, 1, 'deposit', '1000', 1, NULL, 'normal_transaction', NULL, 'cd297239-93d4-4a81-bc4d-2577b175e8c0', '2021-04-06 19:21:05', '2021-04-06 19:21:05'),
(64, 'App\\Models\\Customer', 3, 1, 'deposit', '1033', 1, NULL, 'normal_transaction', NULL, '3901f418-d349-4e80-b89a-1471729ad338', '2021-04-06 19:21:05', '2021-04-06 19:21:05'),
(65, 'App\\Models\\Customer', 3, 1, 'deposit', '1000', 1, NULL, 'normal_transaction', NULL, '57267b7c-bb2b-410f-9e80-79b830eea081', '2021-04-06 19:21:55', '2021-04-06 19:21:55'),
(66, 'App\\Models\\Customer', 3, 1, 'deposit', '1033', 1, NULL, 'normal_transaction', NULL, 'b3a5381d-3c82-45f2-bbbe-7c118bd7898d', '2021-04-06 19:21:55', '2021-04-06 19:21:55'),
(67, 'App\\Models\\Customer', 3, 1, 'deposit', '1000', 1, NULL, 'normal_transaction', NULL, 'fbad1005-dc4e-4f6c-9a47-2dd2c3cd2c44', '2021-04-06 19:23:08', '2021-04-06 19:23:08'),
(68, 'App\\Models\\Customer', 3, 1, 'deposit', '1033', 1, NULL, 'normal_transaction', NULL, '2d5385cb-28ce-4b36-b59b-3b960e72317a', '2021-04-06 19:23:08', '2021-04-06 19:23:08'),
(69, 'App\\Models\\Customer', 3, 1, 'deposit', '1000', 1, NULL, 'normal_transaction', NULL, 'd4cdd1ba-e865-41c3-a581-7c522efc968b', '2021-04-06 19:23:33', '2021-04-06 19:23:33'),
(70, 'App\\Models\\Customer', 3, 1, 'deposit', '1033', 1, NULL, 'normal_transaction', NULL, '00d6bc3a-ff28-42a3-9726-f67c7cf6b0b7', '2021-04-06 19:23:33', '2021-04-06 19:23:33'),
(71, 'App\\Models\\Customer', 3, 1, 'deposit', '1000', 1, NULL, 'normal_transaction', NULL, '31cfd0ac-2204-4121-bdcc-d74afff4a8ba', '2021-04-06 19:23:49', '2021-04-06 19:23:49'),
(72, 'App\\Models\\Customer', 3, 1, 'deposit', '1033', 1, NULL, 'normal_transaction', NULL, '04eae422-4f69-4680-9a0c-8688db01e610', '2021-04-06 19:23:49', '2021-04-06 19:23:49'),
(73, 'App\\Models\\Customer', 3, 1, 'deposit', '1000', 1, NULL, 'normal_transaction', NULL, 'b913ddcf-2ba4-4123-89d2-6fc3caef7cd3', '2021-04-06 19:24:31', '2021-04-06 19:24:31'),
(74, 'App\\Models\\Customer', 3, 1, 'deposit', '1033', 1, NULL, 'normal_transaction', NULL, '3b58207f-5fb5-41c2-92c7-190e315bc37c', '2021-04-06 19:24:31', '2021-04-06 19:24:31'),
(75, 'App\\Models\\Customer', 3, 1, 'deposit', '1000', 1, NULL, 'normal_transaction', NULL, '1d61fc42-c024-4dd5-ab61-0cb7c39379eb', '2021-04-06 19:25:03', '2021-04-06 19:25:03'),
(76, 'App\\Models\\Customer', 3, 1, 'deposit', '1033', 1, NULL, 'normal_transaction', NULL, '4b103f60-ce93-4cc7-ab64-fd98b52f457e', '2021-04-06 19:25:03', '2021-04-06 19:25:03'),
(77, 'App\\Models\\Customer', 3, 1, 'deposit', '1000', 1, NULL, 'normal_transaction', NULL, '54fd04cf-edf8-4151-991a-df6f991a6f71', '2021-04-06 19:33:16', '2021-04-06 19:33:16'),
(78, 'App\\Models\\Customer', 3, 1, 'deposit', '1033', 1, NULL, 'normal_transaction', NULL, 'f5ca414b-7baa-46bd-abaf-f01d3abf118e', '2021-04-06 19:33:16', '2021-04-06 19:33:16'),
(79, 'App\\Models\\Customer', 3, 1, 'deposit', '1000', 1, NULL, 'normal_transaction', NULL, '317dc538-f101-4d6f-ad2a-a2c88a160111', '2021-04-06 19:37:59', '2021-04-06 19:37:59'),
(80, 'App\\Models\\Customer', 3, 1, 'deposit', '1033', 1, NULL, 'normal_transaction', NULL, '97cc572b-2c5f-4bc8-b4d4-28807bbf410b', '2021-04-06 19:37:59', '2021-04-06 19:37:59'),
(81, 'App\\Models\\Customer', 3, 1, 'deposit', '1000', 1, NULL, 'normal_transaction', NULL, '752db972-2b48-4381-828d-d666986c9dff', '2021-04-06 19:38:59', '2021-04-06 19:38:59'),
(82, 'App\\Models\\Customer', 3, 1, 'deposit', '1033', 1, NULL, 'normal_transaction', NULL, '2f86e31d-7306-4cb5-8249-e417630686b3', '2021-04-06 19:38:59', '2021-04-06 19:38:59'),
(83, 'App\\Models\\Customer', 3, 1, 'deposit', '1000', 1, NULL, 'normal_transaction', NULL, 'a45dbeb8-a7e9-4c51-a186-c66797be2bf5', '2021-04-06 19:40:15', '2021-04-06 19:40:15'),
(84, 'App\\Models\\Customer', 3, 1, 'deposit', '1000', 1, NULL, 'normal_transaction', NULL, '84dc8369-65b0-4049-a00a-63c9ad3bb68c', '2021-04-06 19:41:09', '2021-04-06 19:41:09'),
(85, 'App\\Models\\Customer', 3, 1, 'deposit', '1000', 1, NULL, 'normal_transaction', NULL, '911847e3-31f5-4381-9c3d-97747fc6bf10', '2021-04-06 19:41:53', '2021-04-06 19:41:53'),
(86, 'App\\Models\\Customer', 3, 1, 'deposit', '1000', 1, NULL, 'normal_transaction', NULL, '2365dbd1-434d-4f8a-a23d-f81ca8b220dc', '2021-04-06 19:42:30', '2021-04-06 19:42:30'),
(87, 'App\\Models\\Customer', 3, 1, 'deposit', '1000', 1, NULL, 'normal_transaction', NULL, 'c91b660e-13f8-46b7-861b-44c832b33471', '2021-04-06 19:44:13', '2021-04-06 19:44:13'),
(88, 'App\\Models\\Customer', 3, 1, 'deposit', '1000', 1, NULL, 'normal_transaction', NULL, '79f54868-86b3-4696-937a-5d0e58f24f0e', '2021-04-06 19:44:29', '2021-04-06 19:44:29'),
(89, 'App\\Models\\Customer', 3, 1, 'deposit', '1000', 1, NULL, 'normal_transaction', NULL, 'af4acd55-1975-4c48-9ddf-504abdd904bb', '2021-04-06 19:44:40', '2021-04-06 19:44:40'),
(90, 'App\\Models\\Customer', 3, 1, 'deposit', '1000', 1, NULL, 'normal_transaction', NULL, '6a23387d-c177-43d7-bec6-26eed5079567', '2021-04-06 19:54:58', '2021-04-06 19:54:58'),
(91, 'App\\Models\\Customer', 3, 1, 'deposit', '1000', 1, NULL, 'normal_transaction', NULL, '70d52541-b8b7-4ce7-9e81-1ca6c242f748', '2021-04-06 19:55:06', '2021-04-06 19:55:06'),
(92, 'App\\Models\\Customer', 3, 1, 'deposit', '1000', 1, NULL, 'normal_transaction', NULL, 'f9c3ae5a-3ea6-4c11-ac97-bffd74da3aff', '2021-04-06 20:05:42', '2021-04-06 20:05:42'),
(93, 'App\\Models\\Customer', 3, 1, 'deposit', '1000', 1, NULL, 'normal_transaction', NULL, 'd57fe654-b56e-4ea2-acaa-5748f73fba57', '2021-04-06 20:08:13', '2021-04-06 20:08:13'),
(94, 'App\\Models\\Customer', 3, 1, 'deposit', '1000', 1, NULL, 'normal_transaction', NULL, 'b89a51a3-512f-4b07-81bd-e67b505ce550', '2021-04-06 20:08:46', '2021-04-06 20:08:46'),
(95, 'App\\Models\\Customer', 3, 1, 'deposit', '1000', 1, NULL, 'normal_transaction', NULL, '4a650dda-46f2-49d3-aab2-661bdbea14c7', '2021-04-06 20:13:35', '2021-04-06 20:13:35'),
(96, 'App\\Models\\Customer', 3, 1, 'deposit', '1000', 1, NULL, 'normal_transaction', NULL, '67771656-3791-4cc2-a952-be5bc0294aa0', '2021-04-06 20:14:46', '2021-04-06 20:14:46'),
(97, 'App\\Models\\Customer', 3, 1, 'deposit', '1000', 1, NULL, 'normal_transaction', NULL, '74082160-2101-44ef-a759-bc7b03a822ea', '2021-04-06 20:15:31', '2021-04-06 20:15:31'),
(98, 'App\\Models\\Customer', 3, 1, 'deposit', '1000', 1, NULL, 'normal_transaction', NULL, 'e419f530-6520-4d69-863b-9d94f640aae1', '2021-04-06 20:16:24', '2021-04-06 20:16:24'),
(99, 'App\\Models\\Customer', 3, 1, 'deposit', '1000', 1, NULL, 'normal_transaction', NULL, 'd17e55b9-9d04-42d6-b14a-c7a629783578', '2021-04-06 20:54:00', '2021-04-06 20:54:00'),
(100, 'App\\Models\\Customer', 3, 1, 'deposit', '1000', 1, NULL, 'normal_transaction', NULL, '7584c979-a2f9-4e28-8cf9-dc18972f39ab', '2021-04-06 20:54:56', '2021-04-06 20:54:56'),
(101, 'App\\Models\\Customer', 3, 1, 'deposit', '1000', 1, NULL, 'normal_transaction', NULL, 'e70f82a8-0098-4c8d-a763-5200c307a977', '2021-04-06 20:56:28', '2021-04-06 20:56:28'),
(102, 'App\\Models\\Customer', 3, 1, 'deposit', '1000', 1, NULL, 'normal_transaction', NULL, '9e95f947-56d4-44f8-a5f4-a0bc2e87b3a2', '2021-04-06 20:57:05', '2021-04-06 20:57:05'),
(103, 'App\\Models\\Customer', 3, 1, 'deposit', '1000', 1, NULL, 'normal_transaction', NULL, 'b4e75339-de1f-4879-ae1a-f1f5985c9f4c', '2021-04-06 20:57:46', '2021-04-06 20:57:46'),
(104, 'App\\Models\\Customer', 3, 1, 'deposit', '1000', 1, NULL, 'normal_transaction', NULL, '52e9d154-9117-4346-a92a-be61525593b4', '2021-04-06 21:04:28', '2021-04-06 21:04:28'),
(105, 'App\\Models\\Customer', 1, 2, 'deposit', '1000', 1, NULL, 'normal_transaction', NULL, '99d8a48c-305b-410f-8496-7af3bd0d7883', '2021-05-17 13:00:45', '2021-05-17 13:00:45'),
(106, 'App\\Models\\Customer', 1, 2, 'deposit', '1000', 1, NULL, 'normal_transaction', NULL, '005a1efa-017b-4202-8971-34bda6666d93', '2021-05-17 14:01:10', '2021-05-17 14:01:10'),
(107, 'App\\Models\\Customer', 4, 3, 'deposit', '1000', 1, NULL, 'normal_transaction', NULL, 'e5f8d9f6-be2f-41d6-a759-060a42747af7', '2021-05-19 13:46:09', '2021-05-19 13:46:09'),
(108, 'App\\Models\\Customer', 4, 3, 'deposit', '1000', 1, NULL, 'normal_transaction', NULL, '530f5bbf-b695-449d-9896-8bd376ae9c2a', '2021-05-19 13:46:42', '2021-05-19 13:46:42'),
(109, 'App\\Models\\Customer', 4, 3, 'deposit', '1000', 1, NULL, 'normal_transaction', NULL, '56977b3f-df97-443b-8cbb-9e4630cd930c', '2021-05-19 13:46:47', '2021-05-19 13:46:47'),
(110, 'App\\Models\\Customer', 4, 3, 'deposit', '1000', 1, NULL, 'normal_transaction', NULL, 'a612ec7a-6adb-415a-81c5-75b49f5f3d7c', '2021-05-19 13:46:53', '2021-05-19 13:46:53'),
(111, 'App\\Models\\Customer', 4, 3, 'deposit', '1000', 1, NULL, 'normal_transaction', NULL, 'f0d8c38a-3e06-4e9b-aa75-d947e775a4f8', '2021-05-19 13:47:05', '2021-05-19 13:47:05'),
(112, 'App\\Models\\Customer', 5, 4, 'deposit', '1000', 1, NULL, 'normal_transaction', NULL, '4eb4f824-7d9c-481a-80f1-b18c16df11be', '2021-05-20 12:41:12', '2021-05-20 12:41:12'),
(113, 'App\\Models\\Customer', 13, 5, 'deposit', '1000', 1, NULL, 'normal_transaction', NULL, 'ca421967-f71d-4969-a0cd-85b995be30d1', '2021-05-20 13:51:27', '2021-05-20 13:51:27'),
(114, 'App\\Models\\Customer', 14, 6, 'deposit', '1000', 1, NULL, 'normal_transaction', NULL, '73f13872-2d95-450f-b24e-f0368084bfb5', '2021-05-20 13:54:35', '2021-05-20 13:54:35'),
(115, 'App\\Models\\Customer', 3, 1, 'deposit', '123', 1, '{\"amount\": \"123\", \"admin_id\": 1, \"country_id\": \"248\", \"currency_id\": \"1\", \"status_note\": \"34\", \"deposit_date\": \"2021-04-30\", \"deposit_agency_id\": \"1\"}', 'normal_transaction', NULL, 'f17b7bd7-b116-4a98-935e-682013a6f302', '2021-05-20 21:16:35', '2021-05-20 21:16:35'),
(116, 'App\\Models\\Customer', 3, 1, 'deposit', '123', 1, '{\"amount\": \"123\", \"admin_id\": 1, \"country_id\": \"248\", \"currency_id\": \"1\", \"status_note\": \"34\", \"deposit_date\": \"2021-04-30\", \"deposit_agency_id\": \"1\"}', 'normal_transaction', NULL, 'b8a2bf59-35f3-40a2-bb6b-a8f55e0af529', '2021-05-20 21:16:47', '2021-05-20 21:16:47'),
(117, 'App\\Models\\Customer', 3, 1, 'deposit', '123', 1, '{\"amount\": \"123\", \"admin_id\": 1, \"country_id\": \"248\", \"currency_id\": \"1\", \"status_note\": \"34\", \"deposit_date\": \"2021-04-30\", \"deposit_agency_id\": \"1\"}', 'normal_transaction', NULL, 'ef66b94e-64e1-42a1-ae07-75e6ee8cf811', '2021-05-20 21:17:03', '2021-05-20 21:17:03'),
(118, 'App\\Models\\Customer', 3, 1, 'deposit', '123', 1, '{\"amount\": \"123\", \"admin_id\": 1, \"country_id\": \"248\", \"currency_id\": \"1\", \"status_note\": \"34\", \"deposit_date\": \"2021-04-30\", \"deposit_agency_id\": \"1\"}', 'normal_transaction', NULL, '2c616a07-10fe-438f-9d53-2eb0b9925548', '2021-05-20 21:17:05', '2021-05-20 21:17:05'),
(119, 'App\\Models\\Customer', 1, 2, 'deposit', '12', 1, '{\"amount\": \"12\", \"admin_id\": 1, \"country_id\": \"248\", \"currency_id\": \"1\", \"status_note\": null, \"deposit_date\": \"2021-05-05\", \"deposit_agency_id\": \"1\"}', 'normal_transaction', NULL, 'a9f39e26-ab99-4069-be2b-73d6a7ddb3af', '2021-05-20 21:24:32', '2021-05-20 21:24:32'),
(120, 'App\\Models\\Customer', 1, 2, 'deposit', '14', 1, '{\"amount\": \"14\", \"admin_id\": 1, \"country_id\": \"248\", \"currency_id\": \"1\", \"status_note\": null, \"deposit_date\": \"2021-05-05T00:00:00.000000Z\", \"deposit_agency_id\": \"1\"}', 'normal_transaction', NULL, '8d1261a8-3619-44ee-9b14-92f616c94530', '2021-05-20 22:13:12', '2021-05-20 22:13:12'),
(121, 'App\\Models\\Customer', 1, 2, 'deposit', '15', 1, '{\"amount\": \"15\", \"admin_id\": 1, \"country_id\": \"248\", \"currency_id\": \"1\", \"status_note\": null, \"deposit_date\": \"2021-05-05T00:00:00.000000Z\", \"deposit_agency_id\": \"1\"}', 'normal_transaction', NULL, '12c1a98b-2a7e-46d5-9b2b-6acbbb36cc85', '2021-05-20 22:20:24', '2021-05-20 22:20:24'),
(122, 'App\\Models\\Customer', 1, 2, 'deposit', '15', 1, '{\"amount\": \"15.00\", \"admin_id\": 1, \"country_id\": \"248\", \"currency_id\": \"1\", \"status_note\": null, \"deposit_date\": \"2021-05-05T00:00:00.000000Z\", \"deposit_agency_id\": \"1\"}', 'normal_transaction', NULL, '5b2a8601-db07-4f5e-9c53-5bdce198c379', '2021-05-20 22:23:49', '2021-05-20 22:23:49'),
(123, 'App\\Models\\Customer', 1, 2, 'deposit', '1500', 1, '{\"amount\": \"15.00\", \"admin_id\": 1, \"country_id\": \"248\", \"currency_id\": \"1\", \"status_note\": null, \"deposit_date\": \"2021-05-05T00:00:00.000000Z\", \"deposit_agency_id\": \"1\"}', 'normal_transaction', NULL, '410fb2a1-db43-43b2-9520-2b78ff13078f', '2021-05-20 22:25:47', '2021-05-20 22:25:47'),
(124, 'App\\Models\\Customer', 1, 2, 'deposit', '1000', 1, NULL, 'normal_transaction', NULL, '6b9ba7e2-68d2-4f6e-9330-adc3d65853a1', '2021-05-22 18:45:18', '2021-05-22 18:45:18'),
(125, 'App\\Models\\Customer', 1, 2, 'deposit', '1000', 1, NULL, 'normal_transaction', NULL, '43507c09-b665-40b5-9fb4-fc900efcc563', '2021-05-22 18:55:29', '2021-05-22 18:55:29'),
(127, 'App\\Models\\Customer', 1, 2, 'deposit', '2300', 1, '{\"amount\": \"23.00\", \"op_type\": \"deposit\", \"admin_id\": 1, \"country_id\": \"248\", \"currency_id\": \"1\", \"status_note\": null, \"deposit_date\": \"2020-12-12T00:00:00.000000Z\", \"deposit_agency_id\": \"2\"}', 'deposit_order', 7, '36655288-8de7-4078-a1a1-b437e958168b', '2021-05-22 19:36:53', '2021-05-22 19:36:55'),
(128, 'App\\Models\\Customer', 3, 1, 'deposit', '2500', 1, '{\"amount\": \"25.00\", \"op_type\": \"deposit\", \"admin_id\": 1, \"country_id\": \"248\", \"currency_id\": \"1\", \"status_note\": null, \"deposit_date\": \"2020-12-12T00:00:00.000000Z\", \"deposit_agency_id\": \"2\"}', 'deposit_order', 8, '67c4c5e3-fe75-4fd5-b557-4b2362731fd5', '2021-05-22 19:43:23', '2021-05-22 19:43:24'),
(129, 'App\\Models\\Customer', 2, 7, 'deposit', '3500', 1, '{\"amount\": \"35.00\", \"op_type\": \"deposit\", \"admin_id\": 1, \"country_id\": \"248\", \"currency_id\": \"1\", \"status_note\": null, \"deposit_date\": \"2020-12-12T00:00:00.000000Z\", \"deposit_agency_id\": \"2\"}', 'deposit_order', 9, '02453bda-e0d4-4906-b913-71e9ef7c7be5', '2021-05-22 19:46:04', '2021-05-22 19:46:05'),
(130, 'App\\Models\\Customer', 2, 7, 'withdraw', '-22', 1, NULL, 'course_order', 2, '74584506-9116-4249-848b-b459b0b54571', '2021-05-22 20:25:19', '2021-05-22 20:25:19'),
(131, 'App\\Models\\Customer', 2, 7, 'withdraw', '-22', 1, NULL, 'course_order', 3, '0821ea63-4376-43ef-a267-ff560745ab73', '2021-05-22 20:30:12', '2021-05-22 20:30:12'),
(132, 'App\\Models\\Customer', 2, 7, 'withdraw', '-2', 1, NULL, 'normal_transaction', NULL, '9c741fa2-fc2e-4472-a91e-3619029ca153', '2021-05-22 20:36:48', '2021-05-22 20:36:48'),
(134, 'App\\Models\\Customer', 1, 2, 'withdraw', '-30', 1, NULL, 'normal_transaction', NULL, 'c8e50c32-c018-4900-ab6b-ba8502dd1d59', '2021-05-23 20:52:02', '2021-05-23 20:52:02'),
(135, 'App\\Models\\Customer', 1, 2, 'withdraw', '-30', 1, NULL, 'normal_transaction', NULL, '6b3f8263-8dc2-412e-8d3f-c45d4a51709c', '2021-05-23 20:54:13', '2021-05-23 20:54:13'),
(136, 'App\\Models\\Customer', 1, 2, 'withdraw', '-30', 1, NULL, 'normal_transaction', NULL, 'b9f62e72-c194-4402-8c1d-3dab254d27d2', '2021-05-23 20:59:58', '2021-05-23 20:59:58'),
(137, 'App\\Models\\Customer', 1, 2, 'deposit', '1000', 1, NULL, 'normal_transaction', NULL, 'b7ce59bd-29eb-4153-b664-21ba5703d45a', '2021-05-24 12:36:11', '2021-05-24 12:36:11'),
(138, 'App\\Models\\Customer', 1, 2, 'withdraw', '-20', 1, NULL, 'normal_transaction', NULL, 'ced3fe2f-ba45-45a1-a60f-a9659ce9250c', '2021-05-24 21:27:37', '2021-05-24 21:27:37'),
(139, 'App\\Models\\Customer', 1, 2, 'withdraw', '-20', 1, NULL, 'normal_transaction', NULL, '31d6e502-3e57-417f-ab6b-03de6ed381ee', '2021-05-24 21:29:18', '2021-05-24 21:29:18'),
(140, 'App\\Models\\Customer', 1, 2, 'withdraw', '-20', 1, NULL, 'normal_transaction', NULL, '3a112efc-79f1-4466-b1e8-2455fab145b0', '2021-05-24 21:48:36', '2021-05-24 21:48:36'),
(141, 'App\\Models\\Customer', 1, 2, 'withdraw', '-20', 1, NULL, 'normal_transaction', NULL, '0e42605c-dc7f-4c81-80e8-1ee037ee8cff', '2021-05-25 11:20:28', '2021-05-25 11:20:28'),
(142, 'App\\Models\\Customer', 25, 8, 'deposit', '1000', 1, NULL, 'normal_transaction', NULL, '7281d2bb-f91c-4da6-b2b5-9ee20911db27', '2021-05-25 13:58:08', '2021-05-25 13:58:08'),
(143, 'App\\Models\\Customer', 1, 2, 'deposit', '1000', 1, NULL, 'normal_transaction', NULL, '3ab8cf86-c366-4ce5-9f28-b6fb39fae0f1', '2021-05-25 23:00:33', '2021-05-25 23:00:33'),
(144, 'App\\Models\\Customer', 1, 2, 'withdraw', '-30', 1, NULL, 'normal_transaction', NULL, 'd5990c62-d951-4cd7-ade6-43744ad49fc3', '2021-05-26 12:04:54', '2021-05-26 12:04:54'),
(145, 'App\\Models\\Customer', 2, 7, 'deposit', '30', 1, NULL, 'normal_transaction', NULL, '1da31c5b-5a48-4fd2-9f35-54e72c4e8b02', '2021-05-26 12:04:54', '2021-05-26 12:04:54'),
(146, 'App\\Models\\Customer', 1, 2, 'withdraw', '-30', 1, NULL, 'normal_transaction', NULL, '25db78f5-097c-419b-b33a-1a406c6e5f07', '2021-05-26 12:06:09', '2021-05-26 12:06:09'),
(147, 'App\\Models\\Customer', 2, 7, 'deposit', '30', 1, NULL, 'normal_transaction', NULL, 'e8603223-2102-4c04-8a95-33665c42bdf0', '2021-05-26 12:06:09', '2021-05-26 12:06:09'),
(148, 'App\\Models\\Customer', 1, 2, 'withdraw', '-3000', 1, NULL, 'normal_transaction', NULL, '43b0f3b2-52d7-4b13-98a9-537629d85cc9', '2021-05-26 12:09:36', '2021-05-26 12:09:36'),
(149, 'App\\Models\\Customer', 2, 7, 'deposit', '3000', 1, NULL, 'normal_transaction', NULL, '311a4261-da1a-4cab-841a-2531b44df39f', '2021-05-26 12:09:36', '2021-05-26 12:09:36'),
(150, 'App\\Models\\Customer', 1, 2, 'withdraw', '-3000', 1, NULL, 'normal_transaction', NULL, '841db73d-fdfe-47aa-8d4c-1464109bd3cc', '2021-05-26 12:17:07', '2021-05-26 12:17:07'),
(151, 'App\\Models\\Customer', 2, 7, 'deposit', '3000', 1, NULL, 'normal_transaction', NULL, '90dfc0b4-58ff-4f84-9c81-d5ebabc3361e', '2021-05-26 12:17:07', '2021-05-26 12:17:07'),
(152, 'App\\Models\\Customer', 1, 2, 'withdraw', '-3000', 1, NULL, 'normal_transaction', NULL, '2f5f0536-83ae-4164-bf64-77079e787e04', '2021-05-26 12:17:47', '2021-05-26 12:17:47'),
(153, 'App\\Models\\Customer', 2, 7, 'deposit', '3000', 1, NULL, 'normal_transaction', NULL, 'e8ae4fc8-9437-4eef-a9e7-3dc2480dc33e', '2021-05-26 12:17:48', '2021-05-26 12:17:48'),
(154, 'App\\Models\\Customer', 2, 7, 'withdraw', '-1000', 1, NULL, 'normal_transaction', NULL, '5a70fedc-cf35-42a1-b176-05a09e15d65c', '2021-05-26 12:18:51', '2021-05-26 12:18:51'),
(155, 'App\\Models\\Customer', 2, 7, 'deposit', '1000', 1, NULL, 'normal_transaction', NULL, '4bcb1e3e-ac31-4eec-a93c-f19d04f353e3', '2021-05-26 12:18:51', '2021-05-26 12:18:51'),
(156, 'App\\Models\\Customer', 1, 2, 'deposit', '100000', 1, NULL, 'normal_transaction', NULL, '16b2fd98-fda6-4923-86e9-e4bc0965eb57', '2021-05-26 18:56:57', '2021-05-26 18:56:57'),
(157, 'App\\Models\\Customer', 1, 2, 'deposit', '100000', 1, NULL, 'normal_transaction', NULL, 'a0c5a1cb-3abc-4620-a9fb-8f523d223910', '2021-05-26 18:57:01', '2021-05-26 18:57:01'),
(158, 'App\\Models\\Customer', 1, 2, 'deposit', '100000', 1, NULL, 'normal_transaction', NULL, '731e5d6b-be44-47b1-b5d6-17f25806804c', '2021-05-26 18:57:03', '2021-05-26 18:57:03'),
(159, 'App\\Models\\Customer', 1, 2, 'withdraw', '-30', 1, NULL, 'normal_transaction', NULL, '3763938b-1c13-44a9-9e7d-05ea883067a4', '2021-05-26 18:57:28', '2021-05-26 18:57:28'),
(160, 'App\\Models\\Customer', 1, 2, 'withdraw', '-24', 1, NULL, 'normal_transaction', NULL, 'edb486c5-d29d-4ee2-9ed8-e9b4526597d3', '2021-05-26 18:58:49', '2021-05-26 18:58:49'),
(161, 'App\\Models\\Customer', 2, 7, 'withdraw', '-30', 1, NULL, 'normal_transaction', NULL, '60f6237e-a155-4369-bce8-50a3aa71e46d', '2021-05-27 19:31:36', '2021-05-27 19:31:36'),
(162, 'App\\Models\\Customer', 2, 7, 'withdraw', '-30', 1, NULL, 'normal_transaction', NULL, '9afa458a-3a70-4171-ad94-1902146a66de', '2021-05-27 19:32:38', '2021-05-27 19:32:38'),
(163, 'App\\Models\\Customer', 2, 7, 'withdraw', '-30', 1, NULL, 'normal_transaction', NULL, 'dc04bf0f-3418-495e-992b-f5ab10b54b86', '2021-05-27 21:23:21', '2021-05-27 21:23:21'),
(164, 'App\\Models\\Customer', 26, 9, 'deposit', '1000', 1, NULL, 'normal_transaction', NULL, 'cd264158-0b4c-4e4e-8808-99de4ef0a888', '2021-05-29 16:44:39', '2021-05-29 16:44:39'),
(165, 'App\\Models\\Customer', 26, 9, 'deposit', '1000', 1, NULL, 'normal_transaction', NULL, '87ee2776-5d43-4f25-b002-b32b9ee38932', '2021-05-29 19:48:48', '2021-05-29 19:48:48'),
(166, 'App\\Models\\Customer', 27, 10, 'deposit', '1000', 1, NULL, 'normal_transaction', NULL, 'd085b637-d1aa-4c24-b038-c33a0334b3c6', '2021-05-29 19:51:43', '2021-05-29 19:51:43'),
(167, 'App\\Models\\Customer', 27, 10, 'deposit', '1000', 1, NULL, 'normal_transaction', NULL, '67b0abb6-ed69-42b1-8d2c-d533f285c048', '2021-05-29 19:52:53', '2021-05-29 19:52:53'),
(168, 'App\\Models\\Customer', 27, 10, 'deposit', '1000', 1, NULL, 'normal_transaction', NULL, 'd4112f1e-0b38-40c5-bc07-0e3f141c3cca', '2021-05-29 19:52:58', '2021-05-29 19:52:58'),
(169, 'App\\Models\\Customer', 1, 2, 'withdraw', '-30', 1, NULL, 'normal_transaction', NULL, '11e026da-d438-4aaa-856b-97f24f4d0940', '2021-05-29 21:53:34', '2021-05-29 21:53:34'),
(170, 'App\\Models\\Customer', 1, 2, 'withdraw', '0', 1, NULL, 'normal_transaction', NULL, '31a7b613-3a13-4353-84a5-1431fb2c3bd2', '2021-05-29 22:07:26', '2021-05-29 22:07:26'),
(171, 'App\\Models\\Customer', 1, 2, 'withdraw', '0', 1, NULL, 'normal_transaction', NULL, '64f4e9e9-ab34-4c30-b20d-0d7b0ef87c66', '2021-05-29 22:11:33', '2021-05-29 22:11:33'),
(172, 'App\\Models\\Customer', 1, 2, 'withdraw', '0', 1, NULL, 'normal_transaction', NULL, '040398ab-cdb7-43ab-b739-c1dbb41571fa', '2021-05-29 22:11:42', '2021-05-29 22:11:42');

-- --------------------------------------------------------

--
-- Table structure for table `lib_transfers`
--

DROP TABLE IF EXISTS `lib_transfers`;
CREATE TABLE IF NOT EXISTS `lib_transfers` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `from_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_id` bigint(20) UNSIGNED NOT NULL,
  `to_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `to_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('exchange','transfer','paid','refund','gift') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'transfer',
  `status_last` enum('exchange','transfer','paid','refund','gift') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deposit_id` bigint(20) UNSIGNED NOT NULL,
  `withdraw_id` bigint(20) UNSIGNED NOT NULL,
  `discount` decimal(64,0) NOT NULL DEFAULT '0',
  `fee` decimal(64,0) NOT NULL DEFAULT '0',
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `lib_transfers_uuid_unique` (`uuid`),
  KEY `lib_transfers_from_type_from_id_index` (`from_type`,`from_id`),
  KEY `lib_transfers_to_type_to_id_index` (`to_type`,`to_id`),
  KEY `lib_transfers_deposit_id_foreign` (`deposit_id`),
  KEY `lib_transfers_withdraw_id_foreign` (`withdraw_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lib_transfers`
--

INSERT INTO `lib_transfers` (`id`, `from_type`, `from_id`, `to_type`, `to_id`, `status`, `status_last`, `deposit_id`, `withdraw_id`, `discount`, `fee`, `uuid`, `created_at`, `updated_at`) VALUES
(1, 'Bavix\\Wallet\\Models\\Wallet', 2, 'Bavix\\Wallet\\Models\\Wallet', 7, 'transfer', NULL, 145, 144, '0', '0', '7a2e5684-291d-41fd-a56d-57fa3c27a42a', '2021-05-26 12:04:54', '2021-05-26 12:04:54'),
(2, 'Bavix\\Wallet\\Models\\Wallet', 2, 'App\\Models\\Customer', 2, 'transfer', NULL, 147, 146, '0', '0', '2de7eb28-1091-415c-9b5e-0dfac2966e04', '2021-05-26 12:06:09', '2021-05-26 12:06:09'),
(3, 'Bavix\\Wallet\\Models\\Wallet', 2, 'App\\Models\\Customer', 2, 'transfer', NULL, 149, 148, '0', '0', '9272c86a-8e4f-4eb3-ae4a-b9c09e036cfa', '2021-05-26 12:09:36', '2021-05-26 12:09:36'),
(4, 'Bavix\\Wallet\\Models\\Wallet', 2, 'App\\Models\\Customer', 2, 'transfer', NULL, 151, 150, '0', '0', 'c98cc6bc-ae0b-48f9-ad86-c08c2d021313', '2021-05-26 12:17:07', '2021-05-26 12:17:07'),
(5, 'Bavix\\Wallet\\Models\\Wallet', 2, 'Bavix\\Wallet\\Models\\Wallet', 7, 'transfer', NULL, 153, 152, '0', '0', '044f3a3e-f816-420a-866e-4d38432122fc', '2021-05-26 12:17:48', '2021-05-26 12:17:48'),
(6, 'Bavix\\Wallet\\Models\\Wallet', 7, 'Bavix\\Wallet\\Models\\Wallet', 7, 'transfer', NULL, 155, 154, '0', '0', 'e9df1d59-9974-42dc-8fc9-2bdc7cb9728a', '2021-05-26 12:18:51', '2021-05-26 12:18:51');

-- --------------------------------------------------------

--
-- Table structure for table `lib_wallets`
--

DROP TABLE IF EXISTS `lib_wallets`;
CREATE TABLE IF NOT EXISTS `lib_wallets` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `holder_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `holder_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta` json DEFAULT NULL,
  `balance` decimal(64,0) NOT NULL DEFAULT '0',
  `decimal_places` smallint(6) NOT NULL DEFAULT '2',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `lib_wallets_holder_type_holder_id_slug_unique` (`holder_type`,`holder_id`,`slug`),
  KEY `lib_wallets_holder_type_holder_id_index` (`holder_type`,`holder_id`),
  KEY `lib_wallets_slug_index` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lib_wallets`
--

INSERT INTO `lib_wallets` (`id`, `holder_type`, `holder_id`, `name`, `slug`, `description`, `meta`, `balance`, `decimal_places`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\Customer', 3, 'Default Wallet', 'default', NULL, '[]', '108317', 2, '2021-03-30 22:04:46', '2021-05-22 19:43:23'),
(2, 'App\\Models\\Customer', 1, 'Default Wallet', 'default', NULL, '[]', '300542', 2, '2021-05-04 19:03:05', '2021-05-29 22:11:42'),
(3, 'App\\Models\\Customer', 4, 'Default Wallet', 'default', NULL, '[]', '5000', 2, '2021-05-19 13:46:08', '2021-05-19 13:47:05'),
(4, 'App\\Models\\Customer', 5, 'Default Wallet', 'default', NULL, '[]', '1000', 2, '2021-05-20 12:41:12', '2021-05-20 12:41:12'),
(5, 'App\\Models\\Customer', 13, 'Default Wallet', 'default', NULL, '[]', '1000', 2, '2021-05-20 13:51:27', '2021-05-20 13:51:27'),
(6, 'App\\Models\\Customer', 14, 'Default Wallet', 'default', NULL, '[]', '1000', 2, '2021-05-20 13:54:35', '2021-05-20 13:54:35'),
(7, 'App\\Models\\Customer', 2, 'Default Wallet', 'default', NULL, '[]', '12424', 2, '2021-05-22 19:46:03', '2021-05-27 21:23:21'),
(8, 'App\\Models\\Customer', 25, 'Default Wallet', 'default', NULL, '[]', '1000', 2, '2021-05-25 13:58:07', '2021-05-25 13:58:08'),
(9, 'App\\Models\\Customer', 26, 'Default Wallet', 'default', NULL, '[]', '2000', 2, '2021-05-29 16:44:39', '2021-05-29 19:48:48'),
(10, 'App\\Models\\Customer', 27, 'Default Wallet', 'default', NULL, '[]', '3000', 2, '2021-05-29 19:51:43', '2021-05-29 19:52:58'),
(11, 'App\\Models\\Customer', 28, 'Default Wallet', 'default', NULL, '[]', '0', 2, '2021-05-29 20:05:31', '2021-05-29 20:05:31'),
(12, 'App\\Models\\Customer', 29, 'Default Wallet', 'default', NULL, '[]', '0', 2, '2021-05-29 20:24:08', '2021-05-29 20:24:08');

-- --------------------------------------------------------

--
-- Table structure for table `live_tradings`
--

DROP TABLE IF EXISTS `live_tradings`;
CREATE TABLE IF NOT EXISTS `live_tradings` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `trader_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trading_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `live_subject` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci,
  `start_time` timestamp NULL DEFAULT NULL,
  `duration` int(10) UNSIGNED NOT NULL COMMENT 'in minutes',
  `sharing_link` text COLLATE utf8mb4_unicode_ci COMMENT 'zoom,gmeet,..',
  `external_link` text COLLATE utf8mb4_unicode_ci COMMENT 'after complete maybe share it on youtube',
  `commentable` tinyint(1) NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `loyalty_points_prices`
--

DROP TABLE IF EXISTS `loyalty_points_prices`;
CREATE TABLE IF NOT EXISTS `loyalty_points_prices` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `from` decimal(15,2) NOT NULL,
  `to` decimal(15,2) NOT NULL,
  `badge_id` bigint(20) UNSIGNED DEFAULT NULL,
  `price` decimal(15,2) NOT NULL DEFAULT '0.00',
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `loyalty_points_badge_fk` (`badge_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `loyalty_points_prices`
--

INSERT INTO `loyalty_points_prices` (`id`, `from`, `to`, `badge_id`, `price`, `description`, `created_at`, `updated_at`) VALUES
(1, '3.00', '7.00', 2, '22.00', NULL, '2021-04-22 08:58:06', '2021-04-22 16:35:57'),
(2, '20.00', '30.00', 1, '50.00', NULL, '2021-04-22 16:34:15', '2021-04-22 16:34:15');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=165 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2015_08_04_130507_create_article_tag_table', 1),
(4, '2015_08_04_130520_create_articles_table', 1),
(5, '2015_08_04_130551_create_categories_table', 1),
(6, '2015_08_04_131614_create_settings_table', 1),
(7, '2015_08_04_131626_create_tags_table', 1),
(8, '2016_05_25_121918_create_pages_table', 1),
(9, '2016_07_24_060017_add_slug_to_categories_table', 1),
(10, '2016_07_24_060101_add_slug_to_tags_table', 1),
(11, '2017_04_10_195926_change_extras_to_longtext', 1),
(12, '2018_11_06_222923_create_transactions_table', 1),
(13, '2018_11_07_192923_create_transfers_table', 1),
(14, '2018_11_07_202152_update_transfers_table', 1),
(15, '2018_11_15_124230_create_wallets_table', 1),
(16, '2018_11_19_164609_update_transactions_table', 1),
(17, '2018_11_20_133759_add_fee_transfers_table', 1),
(18, '2018_11_22_131953_add_status_transfers_table', 1),
(19, '2018_11_22_133438_drop_refund_transfers_table', 1),
(20, '2019_05_13_111553_update_status_transfers_table', 1),
(21, '2019_06_25_103755_add_exchange_status_transfers_table', 1),
(22, '2019_07_29_184926_decimal_places_wallets_table', 1),
(23, '2019_08_19_000000_create_failed_jobs_table', 1),
(24, '2019_10_02_193759_add_discount_transfers_table', 1),
(25, '2020_03_31_114745_remove_backpackuser_model', 1),
(26, '2020_10_30_193412_add_meta_wallets_table', 1),
(27, '2021_02_08_002449_create_permission_tables', 1),
(28, '2021_02_10_210005_create_currencies_table', 1),
(29, '2021_02_10_210099_create_transfer_agencies_table', 1),
(30, '2021_02_10_210100_create_countries_table', 1),
(31, '2021_02_10_210129_create_receiving_transfer_methods_table', 1),
(32, '2021_02_10_210454_create_cities_table', 1),
(33, '2021_02_10_210458_create_customers_table', 1),
(34, '2021_02_10_212842_create_parent_services_table', 1),
(35, '2021_02_10_213325_create_services_table', 1),
(36, '2021_02_10_214120_create_packages_categories_table', 1),
(37, '2021_02_10_215015_create_loyalty_points_prices_table', 1),
(38, '2021_02_10_215025_create_services_packages_table', 1),
(39, '2021_02_10_215838_create_customers_services_packages_table', 1),
(40, '2021_02_10_221958_create_customers_s_p_operations_table', 1),
(41, '2021_02_10_232100_create_customers_loyalty_points_prices_table', 1),
(42, '2021_02_11_144859_create_digital_cards_providers_table', 1),
(43, '2021_02_11_145121_create_digital_cards_table', 1),
(44, '2021_02_11_174333_create_digital_cards_purchases_table', 1),
(45, '2021_02_11_175419_create_d_cards_purchases_details_table', 1),
(46, '2021_02_11_181923_create_customer_d_c_orders_table', 1),
(47, '2021_02_12_153147_create_consultants_categories_table', 1),
(48, '2021_02_12_153149_create_consultants_table', 1),
(49, '2021_02_12_154041_create_courses_categories_table', 1),
(50, '2021_02_12_154506_create_teacher_details_table', 1),
(51, '2021_02_12_154509_create_courses_trainings_table', 1),
(52, '2021_02_12_160454_create_course_parts_table', 1),
(53, '2021_02_12_163427_create_course_subjects_table', 1),
(54, '2021_02_12_190805_create_course_exercises_table', 1),
(55, '2021_02_12_191128_create_customers_courses_table', 1),
(56, '2021_02_12_211638_create_comments_table', 1),
(57, '2021_02_19_002545_create_languages_table', 1),
(58, '2021_02_21_160220_create_deposit_methods_table', 1),
(59, '2021_02_21_160607_create_deposit_agencies_table', 1),
(60, '2021_02_21_161413_create_deposit_agency_countries_table', 1),
(61, '2021_02_21_162425_create_accounts_groups_table', 1),
(62, '2021_02_21_162430_create_accounts_tree_table', 1),
(63, '2021_02_21_162534_create_head_transaction_table', 1),
(64, '2021_02_21_162535_create_detail_transactions', 1),
(65, '2021_02_21_171938_create_currency_changes_table', 1),
(66, '2021_02_21_181902_create_deposit_orders_table', 1),
(67, '2021_02_26_000631_add_col_last_login_to_customers_table', 1),
(68, '2021_03_02_202711_create_trading_services_table', 1),
(69, '2021_03_02_203032_create_trading_agencies_table', 1),
(70, '2021_03_02_203728_create_trading_services_orders_table', 1),
(71, '2021_03_02_204221_create_trading_services_customers', 1),
(72, '2021_03_02_210716_create_trading_customers_points_table', 1),
(73, '2021_03_02_211906_create_live_tradings_table', 1),
(74, '2021_03_11_170928_create_org_sliders_table', 1),
(75, '2021_03_11_171111_create_org_offers_table', 1),
(76, '2021_03_11_172407_create_org_why_us_table', 1),
(77, '2021_03_11_172722_create_org_certificates_table', 1),
(78, '2021_03_11_172853_create_org_news_table', 1),
(79, '2021_03_11_172945_create_org_partners_table', 1),
(80, '2021_03_11_173214_create_org_brokerage_firms_table', 1),
(81, '2021_03_11_173332_create_org_payment_companies_table', 1),
(82, '2021_03_11_173450_create_org_about_company_page_settings_table', 1),
(83, '2021_03_11_173831_create_org_page_setups_table', 1),
(84, '2021_03_11_174107_create_org_counters_table', 1),
(85, '2021_03_11_174340_create_org_service_categories_table', 1),
(86, '2021_03_11_174426_create_org_services_table', 1),
(87, '2021_03_11_174644_create_org_service_features_table', 1),
(88, '2021_03_11_232256_create_org_post_categories_table', 1),
(89, '2021_03_11_232314_create_org_posts_table', 1),
(90, '2021_03_11_232522_create_org_privacy_policies_table', 1),
(91, '2021_03_11_232612_create_org_access_policies_table', 1),
(92, '2021_03_11_232854_create_org_contact_us_page_settings_table', 1),
(93, '2021_03_11_232958_create_org_contact_us_social_link_setups_table', 1),
(94, '2021_03_11_233121_create_org_newsletter_subscribers_table', 1),
(95, '2021_03_12_011848_add_forgotten_cols_to_contact_us_table', 1),
(96, '2021_03_13_160944_create_org_settings_table', 1),
(97, '2021_03_19_155525_create_activity_log_table', 1),
(98, '2021_03_23_080921_add_col_slug_to_parent_services_table', 1),
(99, '2021_03_24_213341_add_col_img_path_to_courses_categories_table', 1),
(100, '2021_03_24_214307_create_subject_attachments_table', 1),
(101, '2021_03_24_222019_create_customer_d_c_order_details_table', 1),
(102, '2021_03_29_214959_create_services_features_table', 1),
(104, '2021_03_30_201237_add_is_open_to_customer_s_p_ops_table', 2),
(105, '2021_03_30_201711_add_loyalty_to_customers_loyalty_points_prices_table', 3),
(106, '2021_03_30_211247_create_customer_consultants_orders_table', 4),
(109, '2021_03_30_212025_create_procedure_types_table', 5),
(110, '2021_03_30_212427_create_consultants_orders_procedures_table', 5),
(111, '2018_06_30_113500_create_comments_table', 6),
(112, '2021_03_30_231653_add_customer_old_cols_to_customers_table', 6),
(113, '2021_04_06_212532_add_cols_to_consultants_table', 7),
(114, '2021_04_07_001558_add_current_status_to_customer_consultants_order_table', 8),
(115, '2021_04_07_003611_add_course_category_to_courses_trainings_table', 9),
(116, '2021_04_09_163622_add_active_to_consultants_table', 10),
(117, '2021_04_09_164341_add_cols_to_consultants_categories_table', 11),
(118, '2021_04_09_181729_add_slug_to_consultans_categories_table', 12),
(119, '2021_04_09_195927_add_price_to_cunsoltants_table', 13),
(120, '2021_04_09_200549_add_currency_to_consultants_table', 14),
(121, '2021_04_09_230624_add_paid_cols_to_customer_consultants_orders_table', 15),
(122, '2021_04_15_191106_create_customer_banking_accounts_table', 16),
(123, '2021_04_15_192416_create_related_loves_accounts_table', 16),
(124, '2021_02_12_211638_create_comments_old_table', 17),
(125, '2021_04_22_184533_create_badges_table', 17),
(127, '2021_04_22_185116_add_col_badget_id_to_customers_table', 18),
(128, '2021_04_22_192018_add_col_to_loyalty_points_prices_table', 19),
(130, '2021_04_23_204430_create_transfer_withdraw_order_table', 20),
(133, '2021_04_23_210924_create_deposit_withdraw_processes_table', 21),
(134, '2021_04_25_200403_create_agencies_deposit_methods_table', 21),
(136, '2021_04_25_215733_add_col_to_customer_courses_table', 22),
(137, '2021_04_28_211849_add_cols_to_deposit_agencies_table', 23),
(138, '2021_05_01_012600_add_cols_to_lib_wallets_table', 23),
(139, '2021_05_02_213249_add_view_link_to_services_table', 23),
(140, '2021_05_18_173025_create_cutomer_finance_accounts_table', 23),
(141, '2021_05_19_152343_add_cols_national_to_deposit_agencies_table', 24),
(142, '2021_05_19_153450_create_freelancing_platforms_table', 25),
(143, '2021_05_19_154028_create_freelancing_platforms_deposit_agencies_table', 26),
(144, '2021_05_20_152147_add_name_agency_col_to_customer_finance_accounts_table', 27),
(146, '2021_05_21_214803_add_col_fee_percent_to_transfer_withdraw_orders_table', 28),
(147, '2021_05_21_230657_add_col_receiving_mode_to_transfer_withdraw_orders_table', 29),
(148, '2021_05_22_004435_add_col_receiving_info_to_transfer_withdraw_orders_table', 30),
(149, '2021_05_22_215926_add_tranfer_fee_to_countries_table', 31),
(150, '2021_05_23_221625_add_col_instructions_to_services', 32),
(152, '2021_05_24_183536_create_services_instructions_table', 33),
(153, '2021_05_24_231157_add_cutomer_finance_acc_to_deposit_orders_table', 34),
(154, '2021_05_24_234923_add_fee_cols_to_deposit_orders_table', 35),
(157, '2018_08_08_100000_create_telescope_entries_table', 36),
(158, '2021_05_25_224513_add_deposit_type_to_deposit_methods_table', 36),
(159, '2021_05_26_014438_add_col_order_type_to_deposit_orders_table', 37),
(160, '2021_05_26_145517_add_cols_to_d_cards_purchases_details_table', 38),
(162, '2021_05_26_194027_create_paying_orders_table', 39),
(163, '2021_05_26_222316_add_col_paying_time_to_paying_orders_table', 40),
(164, '2021_05_30_020902_add_col_to_currencies_table', 41);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `org_about_company_page_settings`
--

DROP TABLE IF EXISTS `org_about_company_page_settings`;
CREATE TABLE IF NOT EXISTS `org_about_company_page_settings` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `trade_mark_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `trade_mark_desc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `Definition_company_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Definition_company_desc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `trade_mark_title_en` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `trade_mark_desc_en` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `Definition_company_title_en` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Definition_company_desc_en` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `org_about_company_page_settings`
--

INSERT INTO `org_about_company_page_settings` (`id`, `trade_mark_title`, `trade_mark_desc`, `Definition_company_title`, `Definition_company_desc`, `trade_mark_title_en`, `trade_mark_desc_en`, `Definition_company_title_en`, `Definition_company_desc_en`, `created_at`, `updated_at`) VALUES
(1, 'العلامة التجارية للشركة', '<p><font face=\"Helvetica Neue, Segoe UI, Helvetica, Arial, sans-serif\"><span style=\"font-size: 16px; white-space: pre-wrap; background-color: rgb(255, 255, 255);\"><b style=\"\">تم انتقاء العلامة التجارية لشركة يمن تداول وفق معايير الأداء والبراعة لتدل على خدمات الشركة وتكون علامة تجارية مميزة ، يشهد لها ، بانها شركة رائدة في قطاع الخدمات الكترونية في اليمن والشرق الأوسط وشمال إفريقيا ، تفوقت على أسماء كبيرة في صناعة الخدمات الكترونية ، بالإضافة للسمعة الحسنة والموثوقة واهتمامها بمبادرات المسؤولية الاجتماعية فضلا عن تقديم عروض ومنتجات مغرية.</b></span></font><br></p>', 'عن الشركة', '<p><b>يمن تداول هي شركة ريادية متطورة تعمل في مجال الاستشارات والخدمات الكترونية بموجب ترخيص من وزارة التجارة والصناعة (ترخيص رقم 139) و تساند العاملين في منصة الأعمال التجارية الكترونية بمساندة متقدمة ومرنة عبر باقات متنوعه من الخدمات الكترونية ، لتستمر حركة مواردهم التجارية إلى الأمام .</b><br></p>', 'Company\'s brand', '<p><font face=\"Helvetica Neue, Segoe UI, Helvetica, Arial, sans-serif\"><span style=\"font-size: 16px; white-space: pre-wrap; background-color: rgb(255, 255, 255);\"><b style=\"\">تم انتقاء العلامة التجارية لشركة يمن تداول وفق معايير الأداء والبراعة لتدل على خدمات الشركة وتكون علامة تجارية مميزة ، يشهد لها ، بانها شركة رائدة في قطاع الخدمات الكترونية في اليمن والشرق الأوسط وشمال إفريقيا ، تفوقت على أسماء كبيرة في صناعة الخدمات الكترونية ، بالإضافة للسمعة الحسنة والموثوقة واهتمامها بمبادرات المسؤولية الاجتماعية فضلا عن تقديم عروض ومنتجات مغرية.</b></span></font><br></p>', 'About Company', '<p><b>يمن تداول هي شركة ريادية متطورة تعمل في مجال الاستشارات والخدمات الكترونية بموجب ترخيص من وزارة التجارة والصناعة (ترخيص رقم 139) و تساند العاملين في منصة الأعمال التجارية الكترونية بمساندة متقدمة ومرنة عبر باقات متنوعه من الخدمات الكترونية ، لتستمر حركة مواردهم التجارية إلى الأمام .</b><br></p>', '2020-08-24 17:46:43', '2020-08-24 17:53:33');

-- --------------------------------------------------------

--
-- Table structure for table `org_access_policies`
--

DROP TABLE IF EXISTS `org_access_policies`;
CREATE TABLE IF NOT EXISTS `org_access_policies` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `introduction` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `target` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `uses_website` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `included_website` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `subscribe_customer` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `Alternative_solutions` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `Compliance_standards` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `whatsApp` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `default_email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `introduction_en` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `target_en` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `uses_website_en` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `included_website_en` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `subscribe_customer_en` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `Alternative_solutions_en` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `Compliance_standards_en` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `org_access_policies`
--

INSERT INTO `org_access_policies` (`id`, `introduction`, `target`, `uses_website`, `included_website`, `subscribe_customer`, `Alternative_solutions`, `Compliance_standards`, `phone`, `whatsApp`, `default_email`, `introduction_en`, `target_en`, `uses_website_en`, `included_website_en`, `subscribe_customer_en`, `Alternative_solutions_en`, `Compliance_standards_en`, `created_at`, `updated_at`) VALUES
(1, 'تم الاعتماد على نهج استباقي لتحسين موقع شركة يمن تداول والخدمات المقدمة من خلال الموقع. لتلبية احتياجات العملاء وخصوصا  ذوي الاحتياجات الخاصة , وبناء على ذلك اصدرموقع الشركة على  شبكة الإنترنت العالمية  (W3C) ومع وضع إرشادات الوصول إلى المحتوى على شبكة الإنترنت وفق معيار WCAG) 1.0 AA.', 'ايصال خدمات الشركة  وما تقدمة عبر صفحات موقع شركة يمن تداول الإلكتروني', 'لقد تم تطوير موقع يمن تداول  لكي تتمثل بالكامل لمعايير html 5 من حيث العناوين ، والروابط ، وغيرها من الأشكال والتغيرات والعوامل كالشكل وحجم الخط على حدٍّ بافتراض الاستخدام المعقول.', 'عن الشركة , الاخبار , خريطة الموقع , تفاصيل.بيانات الاتصال لتوفير تغذية مرجعية بخصوص تحسين الوصول إلى موقع يمن تداول ، والى الخدمات والعروض التي تقدمها الشركة والسياسات والقوانين التي تتمتثلها الشركة .', 'شركة يمن تداول ترحب بتعليقات المستخدمين على موقعها الكتروني', 'عملت شركة يمن تداول على توفير جميع الحلول وترحب الشركة باراء واقتراحات مستخدمي موقعها الكتروني من خلال وسائل التواصل الرسمية', 'تطوُّع موقع يمن تداول إلى الإلتزام الدائم بالتعليم على شبكة الإنترنت  .', '777792063', '739670711', 'support@yTadawul.com', 'df', 'sdf', 'sf', 'sf', 'sf', 'sf', 'sf', '2020-07-26 01:52:04', '2020-10-02 11:18:59'),
(2, 'dfsf', 'sdf', 'sf', 'sf', 'سيببببببببببب', 'sf', 'سيبسيب', '777', '777777', 'mood20161514@gmail.com', 'df', 'sdf', 'sf', 'sf', 'sf', 'sf', 'sf', '2020-07-26 01:53:33', '2020-07-26 01:53:33');

-- --------------------------------------------------------

--
-- Table structure for table `org_brokerage_firms`
--

DROP TABLE IF EXISTS `org_brokerage_firms`;
CREATE TABLE IF NOT EXISTS `org_brokerage_firms` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `brokerage_firms_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brokerage_firms_logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `brokerage_firms_link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `language` enum('ar','en') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ar',
  `original_row` bigint(20) DEFAULT NULL,
  `translated` tinyint(1) NOT NULL DEFAULT '0',
  `translated_id` bigint(20) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `org_brokerage_firms_user_id_foreign` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `org_brokerage_firms`
--

INSERT INTO `org_brokerage_firms` (`id`, `brokerage_firms_name`, `brokerage_firms_logo`, `brokerage_firms_link`, `language`, `original_row`, `translated`, `translated_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'fbs', 'BrokerageFirm/16015848575f763ed92d20d.jpg', 'https://bit.ly/2MkcGm2', 'ar', NULL, 0, NULL, 1, '2020-10-01 17:40:57', '2020-10-01 17:40:57'),
(2, 'فوركس تايم', 'BrokerageFirm/16015855085f764164ef06d.png', 'https://bit.ly/2GLMHQ3', 'ar', NULL, 0, NULL, 1, '2020-10-01 17:49:37', '2020-10-01 17:51:48'),
(3, 'مولتي بنك', 'BrokerageFirm/16015858415f7642b1a2876.jpg', 'http://bit.ly/Open-real-account-with-Multibank', 'ar', NULL, 0, NULL, 1, '2020-10-01 17:54:17', '2020-10-01 17:57:21'),
(4, 'تكميل', 'BrokerageFirm/16015861655f7643f52ef76.png', 'https://bit.ly/33btrVL', 'ar', NULL, 0, NULL, 1, '2020-10-01 18:02:45', '2020-10-01 18:02:45'),
(5, 'xm', 'BrokerageFirm/16050842285faba444aefac.png', 'https://bit.ly/2GRflPw', 'ar', NULL, 0, NULL, 1, '2020-11-11 04:43:48', '2020-11-11 04:43:48');

-- --------------------------------------------------------

--
-- Table structure for table `org_certificates`
--

DROP TABLE IF EXISTS `org_certificates`;
CREATE TABLE IF NOT EXISTS `org_certificates` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `certificate_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `certificate_image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `certificate_link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `language` enum('ar','en') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ar',
  `original_row` bigint(20) DEFAULT NULL,
  `translated` tinyint(1) NOT NULL DEFAULT '0',
  `translated_id` bigint(20) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `org_certificates_user_id_foreign` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `org_certificates`
--

INSERT INTO `org_certificates` (`id`, `certificate_name`, `certificate_image`, `certificate_link`, `language`, `original_row`, `translated`, `translated_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'تعامل', 'Certificate/16050850425faba772dfaeb.png', 'https://www.facebook.com/majedalmoqbeli0/posts/133413038462750', 'ar', 0, 0, NULL, 1, '2020-11-11 04:57:22', '2020-11-11 04:57:22'),
(2, 'gfrf', 'Certificate/16052923905faed1660b9da.png', 'https://www.facebook.com/100010152335880/posts/1202268970121503/', 'ar', 0, 0, NULL, 1, '2020-11-13 14:33:10', '2020-11-13 14:33:10'),
(3, 'gfrf', 'Certificate/16052924035faed1731b845.png', 'https://www.facebook.com/100010152335880/posts/1202268970121503/', 'ar', 0, 0, NULL, 1, '2020-11-13 14:33:23', '2020-11-13 14:33:23'),
(4, 'rf', 'Certificate/16052924155faed17fb0d31.png', 'https://www.facebook.com/100010152335880/posts/1202268970121503/', 'ar', 0, 0, NULL, 1, '2020-11-13 14:33:35', '2020-11-13 14:33:35'),
(5, 'gfrf', 'Certificate/16052924285faed18c8198c.png', 'https://www.facebook.com/100010152335880/posts/1202268970121503/', 'ar', 0, 0, NULL, 1, '2020-11-13 14:33:48', '2020-11-13 14:33:48'),
(6, 'red', 'Certificate/16052924665faed1b2eb6cb.png', 'https://www.facebook.com/100010152335880/posts/1202268970121503/', 'ar', 0, 0, NULL, 1, '2020-11-13 14:34:26', '2020-11-13 14:34:26'),
(7, 'ew3d', 'Certificate/16052924825faed1c207590.png', 'https://www.facebook.com/100010152335880/posts/1202268970121503/', 'ar', 0, 0, NULL, 1, '2020-11-13 14:34:42', '2020-11-13 14:34:42');

-- --------------------------------------------------------

--
-- Table structure for table `org_contact_us_page_settings`
--

DROP TABLE IF EXISTS `org_contact_us_page_settings`;
CREATE TABLE IF NOT EXISTS `org_contact_us_page_settings` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_paragraph` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `second_paragraph` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `whatsapp` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `support_email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_en` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_paragraph_en` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `second_paragraph_en` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `org_contact_us_page_settings`
--

INSERT INTO `org_contact_us_page_settings` (`id`, `title`, `first_paragraph`, `second_paragraph`, `phone`, `whatsapp`, `support_email`, `title_en`, `first_paragraph_en`, `second_paragraph_en`, `created_at`, `updated_at`) VALUES
(1, 'اليمن - صنعاء - شارع حده - شركة يمن تداول امام مطاعم الخضراء والحمراء - فوق شركة المريسي للصرافة', 'وسائل التواصل بنا&nbsp;', '<p><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\">.</font></font></p>', '777792063', '739670711', 'support@yTadawul.com', 'dgg', '<p>rte3</p>', '<p><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\">sd</font></font></p>', '2020-10-02 11:32:03', '2020-12-21 06:47:29');

-- --------------------------------------------------------

--
-- Table structure for table `org_contact_us_social_link_setups`
--

DROP TABLE IF EXISTS `org_contact_us_social_link_setups`;
CREATE TABLE IF NOT EXISTS `org_contact_us_social_link_setups` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `whatsapp` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telegram` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `messenger` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `skype` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `viber` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `fb` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkdein` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `org_contact_us_social_link_setups`
--

INSERT INTO `org_contact_us_social_link_setups` (`id`, `phone`, `whatsapp`, `email`, `telegram`, `messenger`, `skype`, `viber`, `created_at`, `updated_at`, `fb`, `twitter`, `instagram`, `linkdein`, `youtube`) VALUES
(1, '00967777792063', '967739670711', 'info@ytadawul.com', 'https://t.me/Ytadawul', 'https://M.me/ytadawul', '00967777792063', 'viber://pa?chatURI=967777792063', '2020-08-24 15:31:43', '2020-10-31 17:18:51', 'https://www.facebook.com/yTadawul/', 'https://Twitter.com/ytadawul', 'https://www.instagram.com/ytadawul', 'https://www.linkedin.com/company/ytadawul', 'https://m.youtube.com/channel/UC1xn3wgAMtcWGEJl-d57Dfg');

-- --------------------------------------------------------

--
-- Table structure for table `org_counters`
--

DROP TABLE IF EXISTS `org_counters`;
CREATE TABLE IF NOT EXISTS `org_counters` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `counter` text COLLATE utf8mb4_unicode_ci,
  `language` enum('ar','en') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ar',
  `original_row` bigint(20) DEFAULT NULL,
  `translated` tinyint(1) NOT NULL DEFAULT '0',
  `translated_id` bigint(20) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `org_counters_user_id_foreign` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `org_counters`
--

INSERT INTO `org_counters` (`id`, `title`, `description`, `image`, `counter`, `language`, `original_row`, `translated`, `translated_id`, `user_id`, `created_at`, `updated_at`) VALUES
(7, 'عدد العملاء', 'عدد عملاء الشركة', 'Counter/16016399465f77160a567d3.svg', '1296', 'ar', 0, 0, NULL, 1, '2020-10-02 08:59:06', '2020-12-21 06:42:05'),
(8, 'عدد الشركاء', 'عدد شركاء يمن تدوال', 'Counter/16016410555f771a5fc8248.jpg', '15', 'ar', 0, 0, NULL, 1, '2020-10-02 09:17:35', '2020-11-21 15:55:17'),
(9, 'فريق العمل', 'عدد فريق العمل', 'Counter/16016414635f771bf74f2bb.jpg', '16', 'ar', 0, 0, NULL, 1, '2020-10-02 09:24:23', '2020-12-18 09:34:19'),
(10, 'عدد الدول التي نتواجد بها', 'ننتشر  في الوطن العربي بخدماتنا في 45 دولة', 'Counter/16016421805f771ec4f11c6.jpg', '45', 'ar', 0, 0, NULL, 1, '2020-10-02 09:36:20', '2020-10-02 09:39:33');

-- --------------------------------------------------------

--
-- Table structure for table `org_news`
--

DROP TABLE IF EXISTS `org_news`;
CREATE TABLE IF NOT EXISTS `org_news` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `new_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `new_subtitle` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_link` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keywords` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `views` bigint(20) NOT NULL,
  `new_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `new_content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `language` enum('ar','en') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ar',
  `original_row` bigint(20) DEFAULT NULL,
  `translated` tinyint(1) NOT NULL DEFAULT '0',
  `translated_id` bigint(20) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `org_news_user_id_foreign` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `org_news`
--

INSERT INTO `org_news` (`id`, `new_title`, `new_subtitle`, `slug`, `short_link`, `keywords`, `views`, `new_image`, `new_content`, `language`, `original_row`, `translated`, `translated_id`, `user_id`, `created_at`, `updated_at`) VALUES
(2, 'بمناسبة تدشين إفتتاح مقرنا الجديد,', 'تخفيض 50% من رسوم الشحن والسحب من الـ باي بال (PayPal) العرض لفترة محدودة', 'tadsheen', 'https://ytadawul.com/ar/news/09/09/2020', 'تخفيض', 26, 'News/16015809075f762f6be6a11.jpg', '<font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\">تخفيض 50٪ من رسوم الشحن والسحب من الـ باي بال (PayPal)&nbsp;&nbsp;بمناسبة تدشين افتتاح مقرنا الجديد</font></font>', 'ar', 0, 0, NULL, 1, '2020-10-01 16:35:07', '2021-03-23 01:06:44'),
(3, 'مطلوب محترف يكملنا ?', 'مطلوب محترف يكملنا ???', 'job', 'https://ytadawul.com/ar/news_post/job', 'وظيفة', 111, 'News/16045327995fa33a3f6e327.jpg', '<div><b><u>مطلوب محترف يكملنا ?</u></b></div><div><b><u><br></u></b></div><div><b><u>&nbsp; محرر وصانع&nbsp;فيديوهات</u></b></div><div><b><u>Editor &amp;video maker</u></b></div><div><br></div><div><br></div><div>☆<b> المهارات اللازمة لوظيفة&nbsp; &nbsp;محرر (مونتاج) وصناع (مصور) فيديوهات:</b></div><div><br></div><div>&nbsp;</div><div>&nbsp;□ إجادة مهارات الحاسوب وعمليات معالجة مقاطع الفيديو والصور ترتيب المشاهد واستخدام الوقت المناسب بين اللقطات، أو الإضافات الرقمية الأخرى .</div><div>□ القدرة على التعامل باحترافية مع التقنيات الرقمية والبرامج مثل Photoshop, Adobe Premiere,After Effects,&nbsp;</div><div>&nbsp; &nbsp;وغيرها من برامج معالجة مقاطع الفيديو والصور حسب متطلبات العمل .&nbsp;</div><div>□ إجادة&nbsp; استخدام كاميرا التصوير باحترافية ، و مهارات التصوير&nbsp; وفهم الأساليب والألوان ، والضوء لإنشاء صور وفيديوهات&nbsp; ممتعة بصريًا&nbsp; والتعامل مع الإضاءة&nbsp; ووحدة الصوت بشكل احترافي.</div><div>□ لديه القدرة على تقديم أفكار إبداعية على سبيل المثال أفكار الفيديوهات والإعلانات بنظام الفيديو جرافيك التي تقدم المعلومات السريعة عبر الصور والجرافيك.</div><div>□ اجادة استخدام المؤثرات البصرية.</div><div>□ معرفة طرق استخدام وتركيب الصور ثلاثية الأبعاد.</div><div><br></div><div><div><b>متطلبات العمل في وظيفة محرر (مونتاج) وصناع (مصور) فيديوهات :</b></div><div>□ أن يكون المتقدم حاصلا على الأقل على دبلوم&nbsp; &nbsp;في الدراسات السينمائية أو الإعلام او تلفزيون، وسائط متعددة، غيرها&nbsp;</div><div>□ الخبرة السابقة في مهنة تحرير (مونتاج) وصناعة (تصوير) فيديوهات لا تقل عن ثلاث سنوات&nbsp;</div><div>□ وجود سابقة أعمال لمقاطع فيديو.</div><div>التمتع بشخصية مرنة دبلوماسية مبتكرة وسباقة، وقادرة على حل مشكلات العمل.</div><div>□ القدرة على العمل تحت الضغط، والتحلي بروح العمل التطوعي</div><div><br></div><div><b>طريـــــــقة التقديم&nbsp;</b></div><div>إرسال ما يلي</div><div>•<span style=\"white-space:pre\">	</span>ملف السيرة الذاتية بصيغة pdf</div><div>•<span style=\"white-space:pre\">	</span>رابط معرض أعمالك الإبداعية&nbsp; السابقة&nbsp; وحسابك على Behence, Dribbble او غيرها إن وجدت</div><div><br></div><div>&nbsp;إلى الايميل الرسمي&nbsp;<span style=\"font-weight: bolder; font-size: 0.875rem;\">job@ytadawul.com</span></div><div><br></div></div>', 'ar', 0, 0, NULL, 1, '2020-11-04 19:33:19', '2021-03-19 06:57:38');

-- --------------------------------------------------------

--
-- Table structure for table `org_newsletter_subscribers`
--

DROP TABLE IF EXISTS `org_newsletter_subscribers`;
CREATE TABLE IF NOT EXISTS `org_newsletter_subscribers` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `org_offers`
--

DROP TABLE IF EXISTS `org_offers`;
CREATE TABLE IF NOT EXISTS `org_offers` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `offer_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `activated` tinyint(1) NOT NULL DEFAULT '1',
  `offer_logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `offer_discount_text` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `offer_small_description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `offer_desc_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `offer_desc` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `old_price` int(11) DEFAULT NULL,
  `discount_rate` int(11) DEFAULT NULL,
  `new_price` int(11) DEFAULT NULL,
  `offer_currency` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '$',
  `offer_period` int(11) DEFAULT NULL,
  `finish_date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `offer_button_text` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `offer_button_link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `language` enum('ar','en') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ar',
  `original_row` bigint(20) DEFAULT NULL,
  `translated` tinyint(1) NOT NULL DEFAULT '0',
  `translated_id` bigint(20) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `org_offers_user_id_foreign` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `org_offers`
--

INSERT INTO `org_offers` (`id`, `offer_title`, `activated`, `offer_logo`, `offer_discount_text`, `offer_small_description`, `offer_desc_title`, `offer_desc`, `old_price`, `discount_rate`, `new_price`, `offer_currency`, `offer_period`, `finish_date`, `offer_button_text`, `offer_button_link`, `language`, `original_row`, `translated`, `translated_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'بمناسبة تدشين افتتاح مقرنا الجديد', 1, 'OffersPanel/1615480644604a47442a811.jpg', 'تخفيض 50%', 'تخفيض 50% من رسوم الشحن والسحب من الـ باي بال (PayPal) العرض لفترة محدودة', 'خصم zzxczzxc', 'بمناسبة تدشين افتتاح مقرنا الجديد تخفيض 50% من رسوم الشحن والسحب من الـ باي بال (PayPal) العرض لفترة محدودة', 10, 3, 3, '%', 33, '2020-10-09', 'احصل علية الان', 'https://wa.me/967739670711', 'ar', 0, 0, NULL, 1, '2020-10-01 16:13:55', '2021-03-11 04:37:24');

-- --------------------------------------------------------

--
-- Table structure for table `org_page_setups`
--

DROP TABLE IF EXISTS `org_page_setups`;
CREATE TABLE IF NOT EXISTS `org_page_setups` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `about_company_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `about_company_background` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `about_company_sub_title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `about_company_keyword` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `news_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `news_background` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `news_sub_title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `news_keyword` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `services_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `services_background` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `services_sub_title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `services_keyword` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `offers_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `offers_background` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `offers_sub_title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `offers_keyword` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `blog_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `blog_background` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `blog_sub_title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `blog_keyword` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `about_company_title_en` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `about_company_sub_title_en` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `about_company_keyword_en` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `news_title_en` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `news_sub_title_en` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `news_keyword_en` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `services_title_en` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `services_sub_title_en` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `services_keyword_en` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `offers_title_en` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `offers_sub_title_en` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `offers_keyword_en` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `blog_title_en` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `blog_sub_title_en` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `blog_keyword_en` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `org_page_setups`
--

INSERT INTO `org_page_setups` (`id`, `about_company_title`, `about_company_background`, `about_company_sub_title`, `about_company_keyword`, `news_title`, `news_background`, `news_sub_title`, `news_keyword`, `services_title`, `services_background`, `services_sub_title`, `services_keyword`, `offers_title`, `offers_background`, `offers_sub_title`, `offers_keyword`, `blog_title`, `blog_background`, `blog_sub_title`, `blog_keyword`, `about_company_title_en`, `about_company_sub_title_en`, `about_company_keyword_en`, `news_title_en`, `news_sub_title_en`, `news_keyword_en`, `services_title_en`, `services_sub_title_en`, `services_keyword_en`, `offers_title_en`, `offers_sub_title_en`, `offers_keyword_en`, `blog_title_en`, `blog_sub_title_en`, `blog_keyword_en`, `created_at`, `updated_at`) VALUES
(1, 'معلومات عن شركة يمن تداول', 'PageSetup.about_company_background/2oF4UWDUlGlLJ9uCukMbCbYjQkZB6398CXknlM4W.jpeg', 'معلومات عن اول شركة يمنية رائده في الخدمات المالية الكترونية', 'يمن تداول', 'اخر الاخبار', 'PageSetup.news_background/m4BU0RTzV6eEO3wfE4eKNavlLrVBEJVC9jUYNE7J.png', 'اخبار حصرية من اقوى المصادر', 'اخبار التداول', 'خدمات الشركة', 'PageSetup.services_background/wk8CVZZXBr3ohCbAmb8Lf8NSNhu1uz0rrE52JPD8.png', 'نقدم لكم مجموعة متنوعة من الخدمات مقدمه يجودة عالية وبمعايير دولية', 'خدمات يمن تداول', 'عروض الشركة', 'PageSetup.offers_background/rpt0Pnj6K1FgbtzR88tdwD3LuJU7qgt3xlwoGBpr.png', 'عروض خاصة وحصرية تتميز بها شركتنا', 'تخفيضات', 'مدونه يمن تداول', 'PageSetup.blog_background/P8RoGAczCtY5vcEcLUjITO5YyjrQ5XXOtvy2uv78.jpeg', 'كل ما يهمك تجدة هنا فمعنا تجد المعرفه الكاملة', 'فوركس', 'Information about Yemen Tadawul Company', 'Information about the first Yemeni company leading in electronic financial services', 'YEMEN TADAWUL', 'latest news', 'Exclusive news from the most powerful sources', 'Trading news', 'Company services', 'We offer you a variety of services provided with high quality and international standards', 'Yemen Tradawul Services', 'Company offers', 'Special and exclusive offers that characterize our company', 'Cuts', 'Blog Yemen Tradawul', 'All that matters to you will be found here, with us you will find the full knowledge', 'Forex', '2020-10-02 08:05:35', '2020-10-02 08:05:35');

-- --------------------------------------------------------

--
-- Table structure for table `org_partners`
--

DROP TABLE IF EXISTS `org_partners`;
CREATE TABLE IF NOT EXISTS `org_partners` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `partner_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `partner_logo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `partner_link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `language` enum('ar','en') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ar',
  `original_row` bigint(20) DEFAULT NULL,
  `translated` tinyint(1) NOT NULL DEFAULT '0',
  `translated_id` bigint(20) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `org_partners_user_id_foreign` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `org_partners`
--

INSERT INTO `org_partners` (`id`, `partner_name`, `partner_logo`, `partner_link`, `language`, `original_row`, `translated`, `translated_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'البيضاني للصرافه', 'Partner/16015880165f764b306a18e.png', 'https://albidani.amwali.net/login', 'ar', 0, 0, NULL, 1, '2020-10-01 18:33:36', '2020-10-01 18:33:36');

-- --------------------------------------------------------

--
-- Table structure for table `org_payment_companies`
--

DROP TABLE IF EXISTS `org_payment_companies`;
CREATE TABLE IF NOT EXISTS `org_payment_companies` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `payment_company_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_company_logo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_company_link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `language` enum('ar','en') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ar',
  `original_row` bigint(20) DEFAULT NULL,
  `translated` tinyint(1) NOT NULL DEFAULT '0',
  `translated_id` bigint(20) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `org_payment_companies_user_id_foreign` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `org_payment_companies`
--

INSERT INTO `org_payment_companies` (`id`, `payment_company_name`, `payment_company_logo`, `payment_company_link`, `language`, `original_row`, `translated`, `translated_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Master Card', '/tmp/phpk4PAUU', 'payment_company/15990314955f4f48c78bfef.png', 'ar', 0, 0, NULL, 1, '2020-08-26 22:56:04', '2020-09-02 04:24:55'),
(2, 'bitcoin', 'payment_company/16015314985f756e6ab1d53.jpg', 'https://bitcoin.org/ar/', 'ar', 0, 0, NULL, 1, '2020-10-01 02:51:38', '2020-10-01 02:51:38'),
(3, 'paypal', 'payment_company/16015316505f756f02636fe.jpg', 'https://www.paypal.com', 'ar', 0, 0, NULL, 1, '2020-10-01 02:54:10', '2020-10-01 02:54:10'),
(4, 'payeer', 'payment_company/16015317385f756f5a12435.jpg', 'https://payeer.com/en/', 'ar', 0, 0, NULL, 1, '2020-10-01 02:55:38', '2020-10-01 02:55:38'),
(5, 'payoneer', 'payment_company/16015317855f756f896436f.jpg', 'https://www.payoneer.com/', 'ar', 0, 0, NULL, 1, '2020-10-01 02:56:25', '2020-10-01 02:56:25'),
(6, 'perfect money', 'payment_company/16015318585f756fd214864.png', 'https://perfectmoney.is/?welcome=1', 'ar', 0, 0, NULL, 1, '2020-10-01 02:57:38', '2020-10-01 02:57:38'),
(7, 'skrill', 'payment_company/16015319085f757004a17c8.jpg', 'https://www.skrill.com/en/', 'ar', 0, 0, NULL, 1, '2020-10-01 02:58:28', '2020-10-01 02:58:28'),
(12, 'bitcoin', 'payment_company/16015327185f75732e11488.png', 'https://bitcoin.org/ar/', 'ar', 0, 0, NULL, 1, '2020-10-01 03:11:58', '2020-10-01 03:11:58'),
(13, 'Mastercard', 'payment_company/16015328765f7573cc9005e.png', 'https://Mastercard.com/', 'ar', 0, 0, NULL, 1, '2020-10-01 03:14:36', '2020-10-01 03:14:36'),
(14, 'https://www.neteller.com/ar', 'payment_company/16015329825f757436e29bd.png', 'https://www.neteller.com/ar', 'ar', 0, 0, NULL, 1, '2020-10-01 03:16:22', '2020-10-01 03:16:22'),
(15, 'مصرف الراجحي', '/tmp/phpRjdk3o', 'payment_company/16015864375f764505d3993.png', 'ar', 0, 0, NULL, 1, '2020-10-01 17:44:01', '2020-10-01 18:07:17'),
(16, 'بنك الاهلي', 'payment_company/16015863585f7644b61765c.png', 'https://www.alahli.com/ar-sa/Pages/RB-NCB-Home-New.aspx', 'ar', 0, 0, NULL, 1, '2020-10-01 18:05:58', '2020-10-01 18:05:58');

-- --------------------------------------------------------

--
-- Table structure for table `org_posts`
--

DROP TABLE IF EXISTS `org_posts`;
CREATE TABLE IF NOT EXISTS `org_posts` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `post_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_subtitle` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author_post` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_link` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keywords` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `views` bigint(20) NOT NULL,
  `post_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `post_content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `language` enum('ar','en') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ar',
  `original_row` bigint(20) DEFAULT NULL,
  `translated` tinyint(1) NOT NULL DEFAULT '0',
  `translated_id` bigint(20) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `post_category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `org_posts_user_id_foreign` (`user_id`),
  KEY `org_posts_post_category_id_foreign` (`post_category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `org_post_categories`
--

DROP TABLE IF EXISTS `org_post_categories`;
CREATE TABLE IF NOT EXISTS `org_post_categories` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `color` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `for_what` enum('post','new') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'post',
  `language` enum('ar','en') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ar',
  `original_row` bigint(20) DEFAULT NULL,
  `translated` tinyint(1) NOT NULL DEFAULT '0',
  `translated_id` bigint(20) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `org_post_categories_user_id_foreign` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `org_post_categories`
--

INSERT INTO `org_post_categories` (`id`, `title`, `description`, `color`, `for_what`, `language`, `original_row`, `translated`, `translated_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'قسم التحليلات الاقتصادية  لأسواق  المال', 'قسم مقال&nbsp;', '#0ccfc2', 'post', 'ar', 0, 0, NULL, 1, '2020-10-30 04:38:43', '2020-11-14 03:15:53'),
(3, 'قسم الدروس التعليمية', '<font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\">                                             &nbsp;قسم الدروس التعليمية \r\n                                </font></font>', '#278f19', 'post', 'ar', 0, 0, NULL, 1, '2020-10-30 05:19:07', '2020-12-21 06:49:42'),
(4, 'قسم البنوك الكترونية', '<font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\">الدفع الكتروني</font></font>', '#000000', 'post', 'ar', 0, 0, NULL, 1, '2020-11-02 06:18:59', '2020-11-02 06:18:59'),
(5, 'قسم المقالات التعليمية', '&nbsp;قسم المقالات التعليمية', '#000000', 'post', 'ar', 0, 0, NULL, 1, '2020-12-21 07:00:47', '2020-12-21 07:00:47');

-- --------------------------------------------------------

--
-- Table structure for table `org_privacy_policies`
--

DROP TABLE IF EXISTS `org_privacy_policies`;
CREATE TABLE IF NOT EXISTS `org_privacy_policies` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `public_information` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_for_data` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `manage_personal_data` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `information_collect` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `how_Uses_data` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `sharing_data` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `For_inquiries` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `public_information_en` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_for_data_en` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `manage_personal_data_en` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `information_collect_en` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `how_Uses_data_en` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `sharing_data_en` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `For_inquiries_en` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `org_services`
--

DROP TABLE IF EXISTS `org_services`;
CREATE TABLE IF NOT EXISTS `org_services` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `service_title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_sub_title` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_background` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `language` enum('ar','en') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ar',
  `original_row` bigint(20) DEFAULT NULL,
  `translated` tinyint(1) NOT NULL DEFAULT '0',
  `translated_id` bigint(20) DEFAULT NULL,
  `service_short_desc_title` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_short_desc` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_desc` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_icons` text COLLATE utf8mb4_unicode_ci,
  `login_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `login_desc` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_keyword` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `service_category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `org_services_user_id_foreign` (`user_id`),
  KEY `org_services_service_category_id_foreign` (`service_category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `org_services`
--

INSERT INTO `org_services` (`id`, `service_title`, `service_sub_title`, `service_background`, `language`, `original_row`, `translated`, `translated_id`, `service_short_desc_title`, `service_short_desc`, `service_desc`, `slug`, `service_icons`, `login_title`, `login_desc`, `service_keyword`, `user_id`, `service_category_id`, `created_at`, `updated_at`) VALUES
(4, 'خدمات المدفوعات الاكترونية للاعمال التجارية', 'وصف هذه الخدمة', 'Services/16015901135f765361762cb.jpg', 'ar', 0, 0, NULL, 'الان مدفوعاتك التجارية على الانترنت صااارت اسهل واسرع', 'دفع الكتروني', '<span style=\"color: rgb(33, 37, 41); font-size: 16px; text-align: center;\">نحن راعينا معاناة المتداولين والعاملين في منصة الاعمال التجارية و الماليه والاستثماريه والحرة وما تواجه من صعوبات في السحب والايداع في شركات بورصه العملات الاجنبيه والمحافظ والبنوك الالكترونيه وجعلنا لكم اسهل واسرع وذلك عبر المدفوعات للاعمال التجارية</span>', 'paymentTrade', 'Services/16015901135f765361775e7.jpg', 'سجل دخولك لطلب الخدمة', 'سجل دخولك لتبدا مرحلة العمل التجاري الافضل مع خدمات المدفوعات التجارية', 'سحب,شحن,سكريل', 1, 3, '2020-08-24 18:39:20', '2020-10-01 19:08:33'),
(5, 'خدمات الاستشارات المالية والاستثمارية', 'وصف هذه الخدمة', 'Services/16015909085f76567c659c1.jpg', 'ar', 0, 0, NULL, 'استشارات يمن تداول  النافذة المباشرة لتلبية ما تريد', 'استشارات', 'نحن راعينا معاناة من يريدوا العمل في منصات&nbsp; الاعمال التجارية و الماليه والاستثماريه والحرة&nbsp; وما تواجه من صعوبات في الخطي قدما نحو الافضل وتحقيق نتائج ممتازة لذا جعلها لكم اسهل واسرع وذلك عبر خدمات الاستشارات التجارية و الماليه والاستثماريه والحرة&nbsp;فقط اطلبها والباقي علينا', 'Consulting', 'Services/16015909085f76567c66a57.jpg', 'سجل دخولك لطلب الخدمة', 'سجل دخولك لطلب الخدمة', 'استشارات,مالي,استثمارية,فوركس,أساسيات الاستثمار والتمويل,المادية,دراسات السوق المحلي والاقليمي والعالمي,استثمار,كيف اربح من النت', 1, 5, '2020-08-24 19:39:57', '2020-10-01 19:21:48'),
(6, 'خدمات التدريب والتطوير للعمل في منصات التجارية و الماليه والاستثماريه والحرة', 'وصف هذه الخدمة', 'Services/16015912775f7657ed91513.jpg', 'ar', 0, 0, NULL, 'تدريب  افضل للعمل متميز  في منصات التجارية و الماليه والاستثماريه والحرة', 'تدريب مالي', 'كل ما تبحث عنه&nbsp;للعمل في منصات التجارية و الماليه والاستثماريه والحرة تجدة تحت سقف واحد<br>', 'Training', 'Services/16015912775f7657ed925a8.jpg', 'سجل دخولك لطلب الخدمة', 'سجل دخولك لطلب الخدمة', 'ندريب,تطوير,تعليم,فوركس,ربح', 1, 6, '2020-08-24 19:43:28', '2020-10-01 19:27:57'),
(7, 'خدمات الانتفاع بالتداول في اسواق التداول العاملية', 'تداول', 'Services/15990320395f4f4ae719b2f.jpg', 'ar', 0, 0, NULL, 'كل ما تحتاجة من الالف الى الياء لكي يكون تداولك افضل', 'تداول', 'كل ما تحتاجة من الالف الى الياء لكي يكون تداولك افضل&nbsp;', 'TradeMarketes', 'Services/16016388885f7711e893b5f.jpg', 'سجل دخولك لطلب الخدمة', 'سجل دخول لكب تستفيد من كل ما تحتاجة من الالف الى الياء لكي يكون تداولك افضل&nbsp;', 'FX,تداول', 1, 4, '2020-08-24 19:54:59', '2020-10-02 08:41:29');

-- --------------------------------------------------------

--
-- Table structure for table `org_service_categories`
--

DROP TABLE IF EXISTS `org_service_categories`;
CREATE TABLE IF NOT EXISTS `org_service_categories` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_desc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_icon` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_keywords` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `language` enum('ar','en') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ar',
  `original_row` bigint(20) DEFAULT NULL,
  `translated` tinyint(1) NOT NULL DEFAULT '0',
  `translated_id` bigint(20) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `org_service_categories_user_id_foreign` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `org_service_categories`
--

INSERT INTO `org_service_categories` (`id`, `category_name`, `category_desc`, `category_icon`, `category_keywords`, `slug`, `language`, `original_row`, `translated`, `translated_id`, `user_id`, `created_at`, `updated_at`) VALUES
(3, 'خدمات المدفوعات للاعمال التجارية', '<span style=\"color: rgb(33, 37, 41); font-size: 16px; text-align: center;\">نحن راعينا معاناة المتداولين والعاملين في منصة الاعمال التجارية و الماليه والاستثماريه والحرة وما تواجه من صعوبات في السحب والايداع في شركات بورصه العملات الاجنبيه والمحافظ والبنوك الالكترونيه وجعلنا لكم اسهل واسرع وذلك عبر المدفوعات للاعمال التجارية</span>', 'ServiceCategory/15983029215f442ac939de7.jpg', 'سحب,شحن,سكريل,نتلر,يمن', 'payment', 'ar', 0, 0, NULL, 1, '2020-08-24 18:02:01', '2020-08-24 18:02:01'),
(4, 'خدمات الانتفاع بالتداول في اسواق التداول العاملية', 'كل ما تحتاجة من الالف الى الياء لكي يكون تداولك افضل&nbsp;', 'ServiceCategory/15983031235f442b93968e4.jpg', 'تداول,فوركس يمن,يمن فوركس,تداول الفوركس,forex,fx', 'trading', 'ar', 0, 0, NULL, 1, '2020-08-24 18:05:23', '2020-08-24 18:05:23'),
(5, 'خدمات الاستشارات التجارية والمالية والاستثمارية', 'نحن راعينا معاناة من يريدوا العمل في منصات&nbsp; الاعمال التجارية و الماليه والاستثماريه والحرة&nbsp; وما تواجه من صعوبات في الخطي قدما نحو الافضل وتحقيق نتائج ممتازة لذا جعلها لكم اسهل واسرع وذلك عبر خدمات الاستشارات التجارية و الماليه والاستثماريه والحرة&nbsp;فقط اطلبها والباقي علينا', 'ServiceCategory/15983038165f442e4822c5f.jpg', 'استشارة,مالية,استشارة مالية,استشارة تجارية,استشارة استثمارية', 'Consulting', 'ar', 0, 0, NULL, 1, '2020-08-24 18:16:56', '2020-08-24 18:16:56'),
(6, 'خدمات التدريب والتطوير للعمل في منصات التجارية و الماليه والاستثماريه والحرة', 'كل ما تبحث عنه&nbsp;للعمل في منصات التجارية و الماليه والاستثماريه والحرة تجدة تحت سقف واحد', 'ServiceCategory/15983044355f4430b3deb0a.jpg', 'تدريب,تعليم', 'Training', 'ar', 0, 0, NULL, 1, '2020-08-24 18:27:15', '2020-08-24 18:27:15');

-- --------------------------------------------------------

--
-- Table structure for table `org_service_features`
--

DROP TABLE IF EXISTS `org_service_features`;
CREATE TABLE IF NOT EXISTS `org_service_features` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `feature_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `feature_desc` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `language` enum('ar','en') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ar',
  `original_row` bigint(20) DEFAULT NULL,
  `translated` tinyint(1) NOT NULL DEFAULT '0',
  `translated_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `org_service_features_service_id_foreign` (`service_id`),
  KEY `org_service_features_user_id_foreign` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `org_service_features`
--

INSERT INTO `org_service_features` (`id`, `feature_title`, `feature_desc`, `service_id`, `user_id`, `language`, `original_row`, `translated`, `translated_id`, `created_at`, `updated_at`) VALUES
(1, 'لارسوم خفية', '<div style=\"text-align: justify;\"><font color=\"#656565\" face=\"cairo\"><b>.</b></font></div>', 4, 1, 'ar', 0, 0, NULL, '2020-08-24 20:03:03', '2020-08-24 20:03:03'),
(2, 'الثقة والامان', '.', 4, 1, 'ar', 0, 0, NULL, '2020-08-24 20:04:21', '2020-08-24 20:04:21'),
(3, 'سرعة إنجاز المعاملات', '.', 4, 1, 'ar', 0, 0, NULL, '2020-08-24 20:05:18', '2020-08-24 20:05:18');

-- --------------------------------------------------------

--
-- Table structure for table `org_settings`
--

DROP TABLE IF EXISTS `org_settings`;
CREATE TABLE IF NOT EXISTS `org_settings` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `website_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `website_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `home_keywords` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `show_two_lang` tinyint(1) NOT NULL DEFAULT '1',
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `who_us` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `mission` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `vision` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `default_email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `copy_right` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `website_title_en` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `website_description_en` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `home_keywords_en` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `who_us_en` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `mission_en` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `vision_en` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `copy_right_en` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `org_settings`
--

INSERT INTO `org_settings` (`id`, `website_title`, `website_description`, `home_keywords`, `show_two_lang`, `logo`, `who_us`, `mission`, `vision`, `default_email`, `copy_right`, `website_title_en`, `website_description_en`, `home_keywords_en`, `who_us_en`, `mission_en`, `vision_en`, `copy_right_en`, `created_at`, `updated_at`) VALUES
(1, 'يمن تداول شارت الدولية', '<span style=\"outline: none; margin: 0px; font-weight: bolder; color: rgb(33, 37, 41); font-size: 16px; letter-spacing: 0.5px;\">هي شركة ريادية متطورة تعمل في مجال الاستشارات والخدمات الكترونية بموجب ترخيص من وزارة التجارة والصناعة (ترخيص رقم 139) و تساند العاملين في منصة الأعمال التجارية الكترونية بمساندة متقدمة ومرنة عبر باقات متنوعه من الخدمات الكترونية ، لتستمر حركة مواردهم التجارية إلى الأمام .</span>', 'يمن تداول', 1, 'BrokerageFirm/xkpvqRBKQeb1No6Ci7JzWPrzeH9C9LwxxreaCWGM.png', '<span style=\"font-weight: bold;\">نحن فريق متخصص ذوي خبرة عالية وعلى دراية تامة بكافة الإختصاصات المالية نعمل على نمو شركتنا لتغطي أكبر شريحة ممكنه من العملاء من خلال العمل الجاد والخدمة المميزة والمواكبة لأحدث التقنيات والأفكار</span>', '<span style=\"font-weight: bold;\">مساعدة عملائنا في تحقيق أهدافهم وتطلعاتهم المستقبلية من خلال العناية المهنية المركزة بالعمل الدائم بكل طاقاتنا مع استخدام أحدث التقنيات والخبرات المتراكمة لاضافه أعلى قيمة مضافة ممكنه ولنكون لهم الخيار الاستراتيجي والشريك المطور المفضل والمؤتمن والأفضل دائما في عملهم التجاري .</span><br>', '<span style=\"font-family: &quot;Helvetica Neue&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 700; white-space: pre-wrap;\">ان تكون يمن تداول هي الشركة اليمنية الرائدة والمتميزة و المتفوقه بخدماتها التي تحتل مركزا متقدماً في الريادة والتميز ، وان تكون الخيار الأول والملاذ الآمن لعملائها من الأفراد والشركات والمؤسسات والبنوك والجهات والهيئات الأخرى وأفضل من يلبي لهم إحتياجاتهم ومتطالباتهم بمعايير الجودة والدقة والمصداقية على المستوي المحلي والدولي</span>', 'Info@yTadawul.com', 'Copyright © 2019 - 2021 Yemen Tadawul Company , LLC. All Rights Reserved.', 'Yemen Tadawul  Chart  International', '<div>It is a pioneering developed company working in the field of consulting and electronic services under a license from the Ministry of Commerce and Industry (License No. 139) and supports the employees of the electronic business platform with advanced and flexible support through a variety of electronic services, to keep their commercial resources moving forward.<br></div>', 'Yemen Tadawul', 'We are a specialized team with high experience and fully aware of all financial specialties. We are working on the growth of our company to cover the largest possible segment of customers through hard work, distinguished service and keeping up with the latest technologies and ideas', 'Helping our clients achieve their goals and future aspirations through focused professional care by working permanently with all our energies while using the latest technologies and accumulated experience to add the highest possible added value and to be for them the strategic choice and the preferred, trusted and always best developed partner in their business.', 'For Yemen Tadawul to be the leading, distinguished and distinguished Yemeni company with its services that occupies an advanced position in leadership and excellence, and to be the first choice and safe haven for its clients from individuals, companies, institutions, banks, entities and other bodies and the best of those who meet their needs and requirements of quality standards, accuracy and credibility at the local and international level', 'Copyright © 2019 - 2021 YemenTadawul Company , LLC. All Rights Reserved.', '2020-07-18 04:29:02', '2021-01-15 19:31:05');

-- --------------------------------------------------------

--
-- Table structure for table `org_sliders`
--

DROP TABLE IF EXISTS `org_sliders`;
CREATE TABLE IF NOT EXISTS `org_sliders` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(2000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_en` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `showSlide` tinyint(1) NOT NULL DEFAULT '0',
  `button_text` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `button_link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `language` enum('ar','en') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ar',
  `original_row` bigint(20) DEFAULT NULL,
  `translated` tinyint(1) NOT NULL DEFAULT '0',
  `translated_id` bigint(20) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `org_sliders_user_id_foreign` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `org_sliders`
--

INSERT INTO `org_sliders` (`id`, `title`, `description`, `image`, `image_en`, `showSlide`, `button_text`, `button_link`, `language`, `original_row`, `translated`, `translated_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'شركة يمن تداول شارت الدولية', 'هي شركة ريادية متطورة تعمل في مجال الاستشارات والخدمات المالية الكترونية', 'Slider/16016378115f770db31b537.jpg', NULL, 1, 'تواصل بنا', 'https://wa.me/967739670711', 'ar', 0, 0, NULL, 1, '2020-08-24 20:44:49', '2020-12-18 09:28:51'),
(2, 'عرض خاص', 'بمناسبة قرب السنة الجديدة تخفيض 30% من رسوم الشحن والسحب من الـ باي بال (PayPal) العرض لفترة محدودة', 'Slider/16083270685fdd1f9c1c23b.png', NULL, 1, 'احصل على العرض الان', 'https://wa.me/967739670711', 'ar', 0, 0, NULL, 1, '2020-09-27 09:59:30', '2020-12-18 09:31:36'),
(3, 'خدمات شركة يمن تداول', 'نقدم لكم مجموعة متنوعة من الخدمات مقدمه يجودة عالية وبمعايير دولية', 'Slider/16016386455f7710f58f673.jpg', NULL, 1, 'تصفح خدمات الشركة', 'https://ytadawul.com/ar/services', 'ar', 0, 0, NULL, 1, '2020-10-02 08:37:25', '2020-10-02 08:37:32'),
(4, '11', 'يمن تداول شارت الدولية المحدودة  هي شركة ريادية متطورة تعمل في مجال المال', 'Slider/16058185835fb6d8d7b8a4d.jpg', NULL, 0, 'hgh', 'https://ytadawul.com/ar/userRegister', 'ar', 0, 0, NULL, 1, '2020-11-19 16:40:10', '2020-12-18 09:33:31');

-- --------------------------------------------------------

--
-- Table structure for table `org_why_us`
--

DROP TABLE IF EXISTS `org_why_us`;
CREATE TABLE IF NOT EXISTS `org_why_us` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `language` enum('ar','en') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ar',
  `original_row` bigint(20) DEFAULT NULL,
  `translated` tinyint(1) NOT NULL DEFAULT '0',
  `translated_id` bigint(20) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `org_why_us_user_id_foreign` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `org_why_us`
--

INSERT INTO `org_why_us` (`id`, `title`, `icon`, `description`, `language`, `original_row`, `translated`, `translated_id`, `user_id`, `created_at`, `updated_at`) VALUES
(2, 'لماذا نحن', 'WhyUs/16015784705f7625e63fb1e.svg', 'نسخر خبرات الشركاء لتقديم خدمة إستثنائية', 'ar', 0, 0, NULL, 1, '2020-08-24 15:24:19', '2020-10-01 15:54:30'),
(3, 'لماذا نحن', 'WhyUs/16015786745f7626b2d9af9.svg', 'نقدم خدماتنا بخصوصية متفردة', 'ar', 0, 0, NULL, 1, '2020-08-24 20:34:55', '2020-10-01 15:57:54'),
(4, 'لماذا نحن', 'WhyUs/16015787005f7626ccc610d.svg', 'الإستقلالية التامة وسرية المعلومات', 'ar', 0, 0, NULL, 1, '2020-08-24 20:35:19', '2020-10-01 15:58:20'),
(5, 'لماذا نحن', 'WhyUs/16015782625f76251640de9.svg', 'لإبتكار والنوعية في الخدمات المقدمة', 'ar', 0, 0, NULL, 1, '2020-08-24 20:35:52', '2020-10-01 15:51:02');

-- --------------------------------------------------------

--
-- Table structure for table `packages_categories`
--

DROP TABLE IF EXISTS `packages_categories`;
CREATE TABLE IF NOT EXISTS `packages_categories` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_description` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci,
  `num_days` enum('0','1','7','31','365') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'for once usage 0 ,for one day 1 , for week 7 for month 31 for year 365',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `packages_categories_num_days_unique` (`num_days`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `packages_categories`
--

INSERT INTO `packages_categories` (`id`, `name`, `short_description`, `description`, `num_days`, `active`, `created_at`, `updated_at`) VALUES
(1, '{\"ar\":\"مرة واحدة\"}', NULL, '{\"ar\":\"مرة واحدة هذة الباقة هي للخدمات التي يكون فيها الاشتراك واستخدامها لمرة واحدة وهي الفعالة الان الوحيدة\"}', '0', 1, '2021-03-24 02:17:21', '2021-03-30 17:38:58'),
(2, '{\"ar\":\"\\u064a\\u0648\\u0645 \\u0648\\u0627\\u062d\\u062f\"}', NULL, '{\"ar\":\"\\u0647\\u0630\\u0629 \\u0627\\u0644\\u0628\\u0627\\u0642\\u0629 \\u0647\\u064a \\u0644\\u0644\\u0627\\u0634\\u062a\\u0631\\u0627\\u0643 \\u0644\\u0645\\u062f\\u0629 \\u0632\\u0645\\u0646\\u064a\\u0629 \\u064a\\u0648\\u0645 \\u0648\\u0627\\u062d\\u062f \\u0648\\u0633\\u064a\\u062a\\u0645 \\u062a\\u0633\\u0639\\u064a\\u0631 \\u0641\\u064a \\u062e\\u062f\\u0645\\u0627\\u062a \\u0627\\u0644\\u0628\\u0627\\u0642\\u0627\\u062a\"}', '1', 0, '2021-03-24 02:17:45', '2021-03-24 02:17:45'),
(3, '{\"ar\":\"\\u0633\\u0628\\u0639\\u0629 \\u0627\\u064a\\u0627\\u0645\"}', NULL, '{\"ar\":\"\\u0647\\u0630\\u0629 \\u0627\\u0644\\u0628\\u0627\\u0642\\u0629 \\u064a\\u0643\\u0648\\u0646 \\u0627\\u0633\\u062a\\u062e\\u062f\\u0627\\u0645\\u0647\\u0627 \\u0644\\u0645\\u062f\\u0629 \\u0633\\u0628\\u0639\\u0629 \\u0623\\u064a\\u0627\\u0645\"}', '7', 0, '2021-03-24 02:19:05', '2021-03-24 02:19:05'),
(4, '{\"ar\":\"\\u0634\\u0647\\u0631\\u064a\\u0629\"}', NULL, '{\"ar\":\"\\u0647\\u0630\\u0629 \\u0627\\u0644\\u0628\\u0627\\u0642\\u0629 \\u064a\\u0643\\u0648\\u0646 \\u0627\\u0633\\u062a\\u062e\\u062f\\u0627\\u0645\\u0647\\u0627 \\u0644\\u0645\\u062f\\u0629 30 \\u064a\\u0648\\u0645\"}', '31', 0, '2021-03-24 02:20:24', '2021-03-24 02:20:24'),
(5, '{\"ar\":\"\\u0633\\u0646\\u0648\\u064a\\u0629\"}', NULL, '{\"ar\":\"\\u0647\\u0630\\u0629 \\u0627\\u0644\\u0628\\u0627\\u0642\\u0629 \\u064a\\u0643\\u0648\\u0646 \\u0627\\u0633\\u062a\\u062e\\u062f\\u0627\\u0645\\u0647\\u0627 \\u0644\\u0645\\u062f\\u0629 \\u0633\\u0646\\u0629 \\u0643\\u0627\\u0645\\u0644\\u0629\"}', '365', 0, '2021-03-24 02:20:50', '2021-03-24 02:20:50');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `template` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `extras` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `parent_services`
--

DROP TABLE IF EXISTS `parent_services`;
CREATE TABLE IF NOT EXISTS `parent_services` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_description` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci,
  `img_path` text COLLATE utf8mb4_unicode_ci,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `parent_services`
--

INSERT INTO `parent_services` (`id`, `name`, `short_description`, `description`, `img_path`, `active`, `slug`, `created_at`, `updated_at`) VALUES
(1, '{\"ar\":\"خدمة محفظة نقد باي - خدمة المحفظة الالكترونية\",\"en\":\"electronic paid services\"}', NULL, '{\"ar\":\"لا يوجد وصف\",\"en\":\"<p>nothing<\\/p>\"}', '{\"en\":\"{\\\"en\\\":\\\"storage\\\\\\/services\\\\\\/9954d8a62fb3bc8f36538721020f2d80.jpg\\\",\\\"ar\\\":\\\"{\\\\\\\"en\\\\\\\":\\\\\\\"storage\\\\\\\\\\\\\\/services\\\\\\\\\\\\\\/9954d8a62fb3bc8f36538721020f2d80.jpg\\\\\\\",\\\\\\\"ar\\\\\\\":\\\\\\\"storage\\\\\\\\\\\\\\/services\\\\\\\\\\\\\\/4db7fde01b201f8fd64264c7ca1bf70b.jpg\\\\\\\"}\\\"}\",\"ar\":\"storage\\/services\\/3cb9a20b884a9fee205a1c64ad5d8f3b.png\"}', 1, NULL, '2021-03-23 02:10:26', '2021-04-09 15:46:07'),
(2, '{\"ar\":\"خدمة البطاقات الرقمية\",\"en\":\"dfasdf\"}', NULL, '{\"en\":null}', '{\"en\":\"storage\\/services\\/3f18568b3a5e3685d906e5bb67a620e9.png\"}', 1, NULL, '2021-03-24 01:53:04', '2021-04-22 08:56:19'),
(3, '{\"ar\":\"خدمة الاستشارات و التخطيط\",\"en\":\"analyses and consultings\"}', NULL, '{\"ar\":null}', '{\"ar\":null}', 1, '{\"ar\":\"khdm-l-stsh-r-t-o-ltkhtyt\",\"en\":\"{\\\"ar\\\":\\\"khdm-l-stsh-r-t-o-ltkhtyt\\\"}\"}', '2021-03-23 02:13:21', '2021-03-29 17:42:07'),
(4, '{\"ar\":\"خدمة التدريب و التطوير\"}', NULL, '{\"ar\":null}', '{\"ar\":null}', 1, NULL, '2021-03-23 03:05:01', '2021-03-29 17:35:53'),
(5, '{\"ar\":\"خدمة الانتفاع بالتداول\"}', NULL, '{\"ar\":null}', '{\"ar\":null}', 1, NULL, '2021-03-23 03:05:38', '2021-03-29 17:45:58'),
(6, '{\"ar\":\"خدمة الولاء\"}', NULL, '{\"ar\":null}', '{\"ar\":null}', 1, NULL, '2021-03-23 03:06:13', '2021-03-29 17:45:45'),
(7, '{\"ar\":\"خدمة التسويق بالعمولة\"}', NULL, '{\"ar\":null}', '{\"ar\":null}', 1, NULL, '2021-03-23 03:06:35', '2021-03-29 17:36:31');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `paying_orders`
--

DROP TABLE IF EXISTS `paying_orders`;
CREATE TABLE IF NOT EXISTS `paying_orders` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paying_date` datetime DEFAULT NULL,
  `product_price` decimal(13,4) NOT NULL,
  `currency_id` bigint(20) UNSIGNED NOT NULL DEFAULT '1',
  `commission_percent` decimal(5,2) DEFAULT '0.00',
  `commission_fee` decimal(11,4) DEFAULT '0.0000',
  `description` text COLLATE utf8mb4_unicode_ci COMMENT 'this will fill by customer',
  `link_url` text COLLATE utf8mb4_unicode_ci,
  `file_path` text COLLATE utf8mb4_unicode_ci,
  `current_status` enum('pending','order_accepted','customer_canceled','admin_rejected','in_processing','order_completed','canceled_by_admin') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_id` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'who process the order',
  `admin_note` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `paying_orders_customer_id_foreign` (`customer_id`),
  KEY `paying_orders_currency_id_foreign` (`currency_id`),
  KEY `paying_orders_admin_id_foreign` (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `paying_orders`
--

INSERT INTO `paying_orders` (`id`, `customer_id`, `product_name`, `paying_date`, `product_price`, `currency_id`, `commission_percent`, `commission_fee`, `description`, `link_url`, `file_path`, `current_status`, `admin_id`, `admin_note`, `created_at`, `updated_at`) VALUES
(1, 1, 'حناء', '2021-08-19 13:45:00', '50.0000', 1, NULL, '0.0000', 'حناء مرنقش', 'https://henna.com', NULL, 'pending', NULL, NULL, '2021-05-26 20:01:24', '2021-05-26 20:01:24'),
(2, 1, 'حناء', '2021-08-19 13:45:00', '50.0000', 1, NULL, '0.0000', 'حناء مرنقش', 'https://henna.com', NULL, 'pending', NULL, NULL, '2021-05-26 20:02:35', '2021-05-26 20:02:35'),
(3, 1, 'حناء', '2021-08-19 13:45:00', '50.0000', 1, NULL, '0.0000', 'حناء مرنقش', 'https://henna.com', NULL, 'pending', NULL, NULL, '2021-05-26 20:05:38', '2021-05-26 20:05:38'),
(4, 1, 'حناء', '2021-08-19 13:45:00', '50.0000', 1, NULL, '0.0000', 'حناء مرنقش', 'https://henna.com', NULL, 'pending', NULL, NULL, '2021-05-26 20:06:33', '2021-05-26 20:06:33'),
(5, 1, 'حناء', '2021-08-19 13:45:00', '100.0000', 1, '0.07', '0.0000', 'حناء مرنقش', 'https://henna.com', NULL, 'pending', NULL, NULL, '2021-05-26 20:11:18', '2021-05-26 20:11:18'),
(6, 1, 'حناء', '2021-08-19 13:45:00', '100.0000', 1, '0.07', '7.0000', 'حناء مرنقش', 'https://henna.com', NULL, 'pending', NULL, NULL, '2021-05-26 20:13:36', '2021-05-26 20:13:36'),
(7, 1, 'حناء', '2011-08-19 13:45:00', '50.0000', 1, '0.07', '3.5000', 'حناء مرنقش', 'https://henna.com', NULL, 'pending', NULL, NULL, '2021-05-26 20:32:37', '2021-05-26 20:32:37'),
(8, 2, 'wallet', NULL, '30.0000', 1, '0.07', '2.1000', NULL, '248', NULL, 'pending', NULL, NULL, '2021-05-27 20:22:27', '2021-05-27 20:22:27'),
(9, 2, 'wallet', NULL, '30.0000', 1, '0.07', '2.1000', NULL, 'http://sss.com', NULL, 'pending', NULL, NULL, '2021-05-27 21:22:38', '2021-05-27 21:22:38');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `procedure_types`
--

DROP TABLE IF EXISTS `procedure_types`;
CREATE TABLE IF NOT EXISTS `procedure_types` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(2000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `command_processing` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'what the processing which admin must did when chose this type',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `procedure_types`
--

INSERT INTO `procedure_types` (`id`, `name`, `command_processing`, `active`, `created_at`, `updated_at`) VALUES
(1, '{\"ar\":\"فتح محادثه واتس\"}', '{\"ar\":\"عند اختيار هذا النوع من المعالجة يجب إدخال رابط او رقم الواتس الذي يتسطيع العميل التواصل عبره\"}', 1, '2021-03-30 18:51:56', '2021-03-30 18:56:17'),
(2, '{\"ar\":\"اتصال هاتفي\"}', '{\"ar\":\"عند اختيار هذا النوع يجب وضع رقم تلفون عند معالجة طلب استشارة\"}', 1, '2021-03-30 19:05:10', '2021-03-30 19:05:10'),
(3, '{\"ar\":\"احالة الى موقع\"}', '{\"ar\":\"عند اختيار هذا النوع من الاستشارة يجب وضع عنوان او عناوين الرابط الذي يطلبه العميل\"}', 1, '2021-03-30 19:06:25', '2021-03-30 19:06:25'),
(4, '{\"ar\":\"تزويد ببريد الكتروني\"}', '{\"ar\":\"عند اختيار هذا النوع من المعالجة يجب ارفاق البريد الالكتروني اثناء معالجة الطلب\"}', 1, '2021-03-30 19:07:40', '2021-03-30 19:07:40'),
(5, '{\"ar\":\"تزويد بتعليمات\"}', '{\"ar\":\"عند اختيار هذا النوع من المعالجة يجب تزويد العميل بتعليمات معينة طبقا لطلب استشارته\"}', 1, '2021-03-30 19:09:10', '2021-03-30 19:09:10');

-- --------------------------------------------------------

--
-- Table structure for table `receiving_agencies_countries`
--

DROP TABLE IF EXISTS `receiving_agencies_countries`;
CREATE TABLE IF NOT EXISTS `receiving_agencies_countries` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `transfer_agency_id` bigint(20) UNSIGNED NOT NULL,
  `transfer_fee` decimal(5,2) DEFAULT '0.01' COMMENT 'transfer percent will count over the amount of transferred money and must be less then 100',
  `description` text COLLATE utf8mb4_unicode_ci COMMENT 'explain how the fees counted',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_country_id_transfer_agency_id` (`country_id`,`transfer_agency_id`),
  KEY `receiving_agencies_countries_transfer_agency_id_foreign` (`transfer_agency_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `receiving_agencies_countries`
--

INSERT INTO `receiving_agencies_countries` (`id`, `country_id`, `transfer_agency_id`, `transfer_fee`, `description`, `created_at`, `updated_at`) VALUES
(1, 67, 1, '0.01', '{\"ar\":\"<p>this description<\\/p>\",\"en\":\"<p>this desc<\\/p>\"}', '2021-04-14 17:46:17', '2021-04-15 15:49:57'),
(2, 124, 1, '0.01', NULL, NULL, NULL),
(3, 248, 1, '0.01', NULL, NULL, NULL),
(4, 1, 2, '0.01', NULL, NULL, NULL),
(5, 5, 2, '0.01', NULL, NULL, NULL),
(6, 6, 2, '0.01', NULL, NULL, NULL),
(10, 1, 3, '0.01', NULL, NULL, NULL),
(11, 5, 3, '0.01', NULL, NULL, NULL),
(12, 248, 3, '0.01', '{\"ar\":null}', NULL, '2021-05-23 20:30:31');

-- --------------------------------------------------------

--
-- Table structure for table `related_loves_accounts`
--

DROP TABLE IF EXISTS `related_loves_accounts`;
CREATE TABLE IF NOT EXISTS `related_loves_accounts` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `lover_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `account_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_type` enum('cash','wallet') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'cash',
  `receiving_agencies_country_id` bigint(20) UNSIGNED NOT NULL,
  `country_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `account_number_lover_unique` (`account_number`,`receiving_agencies_country_id`),
  KEY `related_loves_accounts_customer_id_foreign` (`customer_id`),
  KEY `related_loves_accounts_receiving_agencies_country_id_foreign` (`receiving_agencies_country_id`),
  KEY `related_loves_accounts_country_code_foreign` (`country_code`),
  KEY `related_loves_accounts_currency_id_foreign` (`currency_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
CREATE TABLE IF NOT EXISTS `services` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_description` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci,
  `instructions` text COLLATE utf8mb4_unicode_ci,
  `parent_service_id` bigint(20) UNSIGNED NOT NULL,
  `price_type` enum('free','paid') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'free',
  `img_path` text COLLATE utf8mb4_unicode_ci,
  `view_link` mediumtext COLLATE utf8mb4_unicode_ci,
  `img_path_en` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `services_parent_service_id_foreign` (`parent_service_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `short_description`, `description`, `instructions`, `parent_service_id`, `price_type`, `img_path`, `view_link`, `img_path_en`, `created_at`, `updated_at`) VALUES
(1, '{\"ar\":\"خدمة سداد فواتير المشتريات من الانترنت\"}', NULL, '{\"ar\":\"نقوم بشراء اي شي تريده\"}', '{\"ar\":\"نقوم بشراء اي شي تريده\"}', 1, 'free', '{\"ar\":null}', NULL, NULL, '2021-03-23 01:43:29', '2021-04-09 13:09:27'),
(2, '{\"ar\":\"خدمة سحب الأرباح من مواقع  الحر\",\"en\":\"withdrawal earnings from freelance service\"}', NULL, '{\"en\":\"we offer withdrawal earnings from freelance  service\",\"ar\":\"نحن نقدم هذة الخدمة\"}', '{\"ar\":\"<ol><li><b><span style=\\\"font-family: Tahoma;\\\"><font color=\\\"#000000\\\">خدمة التطوير والتدريب اونلاين<\\/font><\\/span><\\/b><\\/li><li><b><span style=\\\"font-family: Tahoma;\\\"><font color=\\\"#000000\\\">قم بالتسخ<\\/font><\\/span><\\/b><\\/li><li><b><span style=\\\"font-family: Tahoma;\\\"><font color=\\\"#000000\\\">اعمل تحويل<\\/font><\\/span><\\/b><\\/li><li><b style=\\\"\\\"><font color=\\\"#000000\\\"><span style=\\\"font-family: Tahoma;\\\">اذهب الى <\\/span><a href=\\\"https:\\/\\/paypal.com\\\" target=\\\"_blank\\\">https:\\/\\/paypal.com<\\/a><span style=\\\"font-family: Tahoma;\\\">&nbsp;<\\/span><\\/font><\\/b><\\/li><li><b><span style=\\\"font-family: Tahoma;\\\"><font color=\\\"#000000\\\">تاكد<\\/font><\\/span><\\/b><\\/li><\\/ol>\",\"en\":\"<ol><li style=\\\"text-align: left; direction: ltr;\\\">-make deposit<\\/li><li style=\\\"text-align: left; direction: ltr;\\\">-goto paypaly.com<\\/li><li style=\\\"text-align: left; direction: ltr;\\\">make sure<\\/li><\\/ol>\"}', 1, 'free', '{\"ar\":\"{\\\"ar\\\":\\\"{\\\\\\\"ar\\\\\\\":\\\\\\\"{\\\\\\\\\\\\\\\"ar\\\\\\\\\\\\\\\":\\\\\\\\\\\\\\\"{\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"ar\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\":\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"{\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"ar\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\":\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"storage\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\/services\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\/6c098607cdfb514be154396f372af2c7.png\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"}\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"}\\\\\\\\\\\\\\\"}\\\\\\\",\\\\\\\"en\\\\\\\":null}\\\"}\"}', NULL, NULL, '2021-03-24 01:44:57', '2021-05-23 21:02:41'),
(3, '{\"ar\":\"خدمة تداول باي لتحويل الأموال عبر المحفظة\"}', NULL, '{\"ar\":null}', NULL, 1, 'paid', '{\"ar\":null}', NULL, NULL, '2021-03-24 01:46:03', '2021-04-09 12:48:49'),
(4, '{\"ar\":\"خدمة الإستشارات المجانية والمدفوعة\",\"en\":\"Consulting\'s Paid&Feee service\"}', NULL, '{\"ar\":null}', NULL, 3, 'paid', '{\"ar\":null}', NULL, NULL, '2021-03-24 01:46:57', '2021-04-09 13:14:39'),
(5, '{\"ar\":\"خدمة التطوير والتدريب اونلاين\"}', NULL, '{\"ar\":null}', NULL, 4, 'free', '{\"ar\":null}', NULL, NULL, '2021-03-24 01:47:39', '2021-04-09 12:51:20'),
(6, '{\"ar\":\"خدمة الكاش_باك\"}', NULL, '{\"ar\":null}', NULL, 5, 'paid', '{\"ar\":null}', NULL, NULL, '2021-03-24 01:48:37', '2021-04-09 12:53:24'),
(7, '{\"ar\":\"خدمة التداول الحي\"}', NULL, '{\"ar\":null}', NULL, 5, 'paid', '{\"ar\":null}', NULL, NULL, '2021-03-24 01:49:10', '2021-04-09 12:54:06'),
(8, '{\"ar\":\"خدمة التوصيات و التحليلات\"}', NULL, '{\"ar\":null}', NULL, 5, 'paid', '{\"ar\":null}', NULL, NULL, '2021-03-24 01:49:57', '2021-04-09 12:54:32'),
(9, '{\"ar\":\"خدمة نسخ التداول\"}', NULL, '{\"ar\":null}', NULL, 5, 'paid', '{\"ar\":null}', NULL, NULL, '2021-03-24 01:50:58', '2021-04-09 12:54:53'),
(10, '{\"ar\":\"خدمة   الولاء\"}', NULL, '{\"ar\":null}', NULL, 6, 'paid', '{\"ar\":null}', NULL, NULL, '2021-03-24 01:51:30', '2021-04-09 12:55:13'),
(11, '{\"ar\":\"خدمة التسويق بالعموله\"}', NULL, '{\"ar\":null}', NULL, 7, 'paid', '{\"ar\":null}', NULL, NULL, '2021-03-24 01:52:09', '2021-04-09 12:55:53'),
(12, '{\"ar\":\"خدمة البطاقات  الرقمية\"}', NULL, '{\"ar\":null}', NULL, 2, 'paid', '{\"ar\":null}', NULL, NULL, '2021-03-24 01:53:38', '2021-04-09 12:56:52');

-- --------------------------------------------------------

--
-- Table structure for table `services_features`
--

DROP TABLE IF EXISTS `services_features`;
CREATE TABLE IF NOT EXISTS `services_features` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `parent_service_id` bigint(20) UNSIGNED NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `services_features_parent_service_id_foreign` (`parent_service_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services_features`
--

INSERT INTO `services_features` (`id`, `parent_service_id`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, '{\"ar\":\"<p>* \\u0644\\u0627 \\u0631\\u0633\\u0648\\u0645 \\u062e\\u0641\\u064a\\u0629<\\/p><p>\\u0644\\u0627 \\u064a\\u0648\\u062c\\u062f \\u0631\\u0633\\u0648\\u0645 \\u063a\\u064a\\u0631 \\u0627\\u0644\\u062a\\u064a \\u0645\\u0648\\u0636\\u062d\\u0629&nbsp;<\\/p>\"}', '2021-03-29 16:23:50', '2021-03-29 16:27:46'),
(2, 1, '{\"ar\":\"<ul><li>\\u0627\\u0644\\u062b\\u0642\\u0629 \\u0648\\u0627\\u0644\\u0623\\u0645\\u0627\\u0646<\\/li><\\/ul><p>\\u0623\\u0645\\u0648\\u0627\\u0644\\u0643 \\u0641\\u064a \\u0627\\u0644\\u062d\\u0641\\u0638 \\u0648\\u0627\\u0644\\u0635\\u0648\\u0646<\\/p><p><br><\\/p>\"}', '2021-03-29 16:28:50', '2021-03-29 16:28:50'),
(3, 1, '{\"ar\":\"<p>\\u0633\\u0631\\u0639\\u0629 \\u0627\\u0646\\u062c\\u0627\\u0632 \\u0627\\u0644\\u0639\\u0645\\u0627\\u0645\\u0644\\u0629<\\/p>\"}', '2021-03-29 16:29:17', '2021-03-29 16:29:17');

-- --------------------------------------------------------

--
-- Table structure for table `services_instructions`
--

DROP TABLE IF EXISTS `services_instructions`;
CREATE TABLE IF NOT EXISTS `services_instructions` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `service_name` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `steps` enum('step1','step2','step3','step4','step5') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'step1',
  `instructions` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `img_path` mediumtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services_instructions`
--

INSERT INTO `services_instructions` (`id`, `service_name`, `steps`, `instructions`, `img_path`, `created_at`, `updated_at`) VALUES
(1, '{\"ar\":\"deposit\",\"en\":\"sdfdsa\"}', 'step1', '{\"ar\":\"<p>الا ياسين<\\/p><h3><font color=\\\"#397b21\\\"><b><span style=\\\"font-family: Tahoma;\\\">الا ياسين من صدق<\\/span><\\/b><\\/font><\\/h3>\"}', '{\"ar\":\"storage\\/service_instructions\\/2e0da7773e0ca96cf7dcc2f279492f5f.png\",\"en\":\"storage\\/service_instructions\\/cbfee77ec2f0a2665f2656aff1801813.png\"}', '2021-05-24 15:48:21', '2021-05-27 19:23:56'),
(2, '{\"ar\":\"add_finance_account\"}', 'step1', NULL, '{\"ar\":null}', '2021-05-25 11:51:25', '2021-05-25 11:51:25'),
(3, '{\"ar\":\"تعليمات خدمات السحب الدالخلي\"}', 'step1', '{\"ar\":null}', '{\"ar\":null}', '2021-05-25 20:35:45', '2021-05-25 20:35:45'),
(4, '{\"ar\":\"تعليمات التحويل الخارجي\"}', 'step1', '{\"ar\":\"<ol><li><span style=\\\"font-family: Verdana; background-color: rgb(255, 255, 255);\\\"><b style=\\\"\\\"><font color=\\\"#21104a\\\">-قم باختيار الدولة المراد التحويل اليها&nbsp;<\\/font><\\/b><\\/span><\\/li><li>- قم باختيار طريقة الاستلام<\\/li><li>- اختر وكالة التحويل<\\/li><li>- قم بادخال المبلغ المراد تحويله<\\/li><li><font color=\\\"#ce0000\\\"><b>-ادخل بيانات المستلم<\\/b><\\/font><\\/li><\\/ol>\"}', '{\"ar\":null}', '2021-05-25 20:36:03', '2021-05-29 22:22:42'),
(5, '{\"ar\":\"تعليمات سحب الارباح من الانترنت\"}', 'step1', '{\"ar\":null}', '{\"ar\":null}', '2021-05-25 20:36:26', '2021-05-25 20:36:26');

-- --------------------------------------------------------

--
-- Table structure for table `services_packages`
--

DROP TABLE IF EXISTS `services_packages`;
CREATE TABLE IF NOT EXISTS `services_packages` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `package_id` bigint(20) UNSIGNED NOT NULL,
  `price` decimal(11,2) NOT NULL DEFAULT '0.00',
  `currency_id` bigint(20) UNSIGNED NOT NULL,
  `discount` decimal(11,2) DEFAULT '0.00',
  `subscription_scores` decimal(15,2) NOT NULL DEFAULT '0.00' COMMENT 'count scores which customer win when subscribe in service',
  `operation_scores` decimal(15,2) NOT NULL DEFAULT '0.00' COMMENT 'count the scores will gave to customer when use this service',
  `orders_count` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'count the orders that customer can reuse this services by this price for this services,if 0 then unlimited',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `services_packages_service_id_foreign` (`service_id`),
  KEY `services_packages_package_id_foreign` (`package_id`),
  KEY `services_packages_currency_id_foreign` (`currency_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services_packages`
--

INSERT INTO `services_packages` (`id`, `service_id`, `package_id`, `price`, `currency_id`, `discount`, `subscription_scores`, `operation_scores`, `orders_count`, `created_at`, `updated_at`) VALUES
(1, 4, 1, '100.00', 1, NULL, '10.00', '10.00', 0, '2021-04-09 16:31:33', '2021-04-09 16:32:21'),
(2, 5, 1, '0.00', 1, NULL, '0.00', '12.00', 0, '2021-04-09 20:56:18', '2021-04-09 20:56:18'),
(3, 1, 1, '0.00', 1, '0.00', '0.00', '10.00', 0, '2021-04-22 17:30:18', '2021-04-22 17:30:18'),
(7, 6, 1, '0.00', 1, '0.00', '0.00', '12.00', 0, '2021-04-22 18:10:39', '2021-04-22 18:11:01');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `field` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_key_unique` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `name`, `description`, `value`, `field`, `active`, `created_at`, `updated_at`) VALUES
(1, 'contact_email', 'Contact form email address', 'The email address that all emails from the contact form will go to.', 'admin@updivision.com', '{\"name\":\"value\",\"label\":\"Value\",\"type\":\"email\"}', 1, NULL, NULL),
(2, 'contact_cc', 'Contact form CC field', 'Email addresses separated by comma, to be included as CC in the email sent by the contact form.', '', '{\"name\":\"value\",\"label\":\"Value\",\"type\":\"text\"}', 1, NULL, NULL),
(3, 'contact_bcc', 'Contact form BCC field', 'Email addresses separated by comma, to be included as BCC in the email sent by the contact form.', '', '{\"name\":\"value\",\"label\":\"Value\",\"type\":\"email\"}', 1, NULL, NULL),
(4, 'motto', 'Motto', 'Website motto', 'this is the value', '{\"name\":\"value\",\"label\":\"Value\",\"type\":\"textarea\"}', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subject_attachments`
--

DROP TABLE IF EXISTS `subject_attachments`;
CREATE TABLE IF NOT EXISTS `subject_attachments` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `subject_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_path` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `subject_type` enum('video','file','image') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'video',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `subject_attachments_subject_id_foreign` (`subject_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tags_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teacher_details`
--

DROP TABLE IF EXISTS `teacher_details`;
CREATE TABLE IF NOT EXISTS `teacher_details` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `last_certificate` date DEFAULT NULL,
  `classification` text COLLATE utf8mb4_unicode_ci,
  `scores` decimal(5,2) NOT NULL COMMENT 'that has from university',
  `skills` text COLLATE utf8mb4_unicode_ci,
  `rating` decimal(2,1) NOT NULL DEFAULT '4.0',
  `join_date` timestamp NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `teacher_details_customer_id_foreign` (`customer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teacher_details`
--

INSERT INTO `teacher_details` (`id`, `customer_id`, `last_certificate`, `classification`, `scores`, `skills`, `rating`, `join_date`, `active`, `created_at`, `updated_at`) VALUES
(1, 3, '2021-04-16', 'تحليل', '78.60', '<p>شتنيشسنتيان</p>', '4.0', '2021-04-27 21:00:00', 1, '2021-04-22 20:05:20', '2021-04-22 20:11:23');

-- --------------------------------------------------------

--
-- Table structure for table `telescope_entries`
--

DROP TABLE IF EXISTS `telescope_entries`;
CREATE TABLE IF NOT EXISTS `telescope_entries` (
  `sequence` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `family_hash` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `should_display_on_index` tinyint(1) NOT NULL DEFAULT '1',
  `type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`sequence`),
  UNIQUE KEY `telescope_entries_uuid_unique` (`uuid`),
  KEY `telescope_entries_batch_id_index` (`batch_id`),
  KEY `telescope_entries_family_hash_index` (`family_hash`),
  KEY `telescope_entries_created_at_index` (`created_at`),
  KEY `telescope_entries_type_should_display_on_index_index` (`type`,`should_display_on_index`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `telescope_entries_tags`
--

DROP TABLE IF EXISTS `telescope_entries_tags`;
CREATE TABLE IF NOT EXISTS `telescope_entries_tags` (
  `entry_uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tag` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  KEY `telescope_entries_tags_entry_uuid_tag_index` (`entry_uuid`,`tag`),
  KEY `telescope_entries_tags_tag_index` (`tag`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `telescope_monitoring`
--

DROP TABLE IF EXISTS `telescope_monitoring`;
CREATE TABLE IF NOT EXISTS `telescope_monitoring` (
  `tag` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trading_agencies`
--

DROP TABLE IF EXISTS `trading_agencies`;
CREATE TABLE IF NOT EXISTS `trading_agencies` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(2000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `img_path` text COLLATE utf8mb4_unicode_ci,
  `img_path_en` text COLLATE utf8mb4_unicode_ci,
  `primary_email` text COLLATE utf8mb4_unicode_ci,
  `secondary_mail` text COLLATE utf8mb4_unicode_ci,
  `phone1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_info` text COLLATE utf8mb4_unicode_ci,
  `email_from_yt_to` text COLLATE utf8mb4_unicode_ci,
  `email_from_cust_to` text COLLATE utf8mb4_unicode_ci,
  `agency_terms` text COLLATE utf8mb4_unicode_ci COMMENT 'if there term in agency',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trading_customers_points`
--

DROP TABLE IF EXISTS `trading_customers_points`;
CREATE TABLE IF NOT EXISTS `trading_customers_points` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `trading_service_id` bigint(20) UNSIGNED DEFAULT NULL,
  `trading_agency_id` bigint(20) UNSIGNED DEFAULT NULL,
  `operation_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `loyalty_points` decimal(11,2) NOT NULL DEFAULT '0.00',
  `dollar_equal` decimal(11,2) NOT NULL DEFAULT '0.00',
  `transferred` tinyint(1) NOT NULL DEFAULT '0',
  `win_lose` enum('win','lose') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'win',
  `transferred_date` timestamp NOT NULL COMMENT 'when convert to usd',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trading_customers_points_customer_id_foreign` (`customer_id`),
  KEY `trading_customers_points_trading_service_id_foreign` (`trading_service_id`),
  KEY `trading_customers_points_trading_agency_id_foreign` (`trading_agency_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trading_services`
--

DROP TABLE IF EXISTS `trading_services`;
CREATE TABLE IF NOT EXISTS `trading_services` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(2000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trading_services_customers`
--

DROP TABLE IF EXISTS `trading_services_customers`;
CREATE TABLE IF NOT EXISTS `trading_services_customers` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `trading_service_id` bigint(20) UNSIGNED NOT NULL,
  `trading_agency_id` bigint(20) UNSIGNED NOT NULL,
  `customer_agency_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subscription_status` enum('pending','accepted','rejected_by_admin','rejected_by_agency','canceled_by_customer','stopped_by_admin') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `status_change_reason` text COLLATE utf8mb4_unicode_ci,
  `status_change_date` timestamp NULL DEFAULT NULL,
  `replay_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agency_replay` text COLLATE utf8mb4_unicode_ci,
  `admin_note` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trading_services_customers_customer_id_foreign` (`customer_id`),
  KEY `trading_services_customers_trading_service_id_foreign` (`trading_service_id`),
  KEY `trading_services_customers_trading_agency_id_foreign` (`trading_agency_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trading_services_orders`
--

DROP TABLE IF EXISTS `trading_services_orders`;
CREATE TABLE IF NOT EXISTS `trading_services_orders` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `trading_service_id` bigint(20) UNSIGNED NOT NULL,
  `order_status` enum('pending','accepted','rejected','stopped') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `status_change_reason` text COLLATE utf8mb4_unicode_ci,
  `status_change_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trading_services_orders_customer_id_foreign` (`customer_id`),
  KEY `trading_services_orders_trading_service_id_foreign` (`trading_service_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transfer_agencies`
--

DROP TABLE IF EXISTS `transfer_agencies`;
CREATE TABLE IF NOT EXISTS `transfer_agencies` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `agency_name` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `agency_desc` text COLLATE utf8mb4_unicode_ci,
  `img_path` text COLLATE utf8mb4_unicode_ci,
  `receive_method` enum('cash','wallet','both') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'both',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transfer_agencies`
--

INSERT INTO `transfer_agencies` (`id`, `agency_name`, `agency_desc`, `img_path`, `receive_method`, `active`, `created_at`, `updated_at`) VALUES
(1, '{\"ar\":\"expressAgency\"}', '{\"ar\":\"<p>this services is founded in north africa<\\/p>\"}', '{\"ar\":null}', 'both', 1, '2021-04-14 17:42:45', '2021-05-26 18:53:02'),
(2, '{\"ar\":\"secondAgency\"}', '{\"ar\":\"<h3><span class=\\\"marker\\\"><strong>سيتم عرض وصف عن الشركة هنا<\\/strong><\\/span><\\/h3>\"}', '{\"ar\":\"storage\\/Agencies\\/525fd0234fb2b690a6f959c516dab83c.png\"}', 'cash', 1, '2021-04-22 18:28:04', '2021-04-22 19:12:38'),
(3, '{\"ar\":\"thirdAgency\"}', '{\"ar\":\"<p>وصف ايضا<\\/p>\"}', '{\"ar\":\"{\\\"ar\\\":\\\"storage\\\\\\/Agencies\\\\\\/efaf468e6ad3d9728ac379590093de8d.png\\\"}\"}', 'both', 1, '2021-04-22 18:33:55', '2021-04-22 19:21:04');

-- --------------------------------------------------------

--
-- Table structure for table `transfer_withdraw_orders`
--

DROP TABLE IF EXISTS `transfer_withdraw_orders`;
CREATE TABLE IF NOT EXISTS `transfer_withdraw_orders` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `amount` decimal(13,2) NOT NULL,
  `currency_id` bigint(20) UNSIGNED NOT NULL DEFAULT '1',
  `exchange_price` decimal(11,4) NOT NULL DEFAULT '1.0000' COMMENT 'the exchange price per USD in deposit moment ',
  `transfer_fee` decimal(13,4) NOT NULL DEFAULT '0.0000' COMMENT 'صافي رسوم التحويل التي ستضاف فوق المبلغ ويسحب من رصيد المحفظة عليه ',
  `fee_percent` decimal(11,2) DEFAULT '0.00' COMMENT 'نسبة رسوم التحويل',
  `transferred_amount` decimal(13,2) DEFAULT '0.00',
  `transferred_currency_id` bigint(20) UNSIGNED DEFAULT NULL,
  `customer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `transfer_type` enum('transfer','withdraw') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'transfer' COMMENT 'depracted',
  `receiving_mode` enum('cash','wallet') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'cash',
  `transfer_agency_country_id` bigint(20) UNSIGNED DEFAULT NULL,
  `current_status` enum('pending','rejected','confirmed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `status_note` text COLLATE utf8mb4_unicode_ci COMMENT 'when rejected or when still pending',
  `status_changed_date` timestamp NULL DEFAULT NULL,
  `detail_statement` text COLLATE utf8mb4_unicode_ci,
  `admin_id` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'who confirmed this op',
  `img_path` text COLLATE utf8mb4_unicode_ci,
  `reference_id_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receiver_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receiver_acc_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receiver_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receiver_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receiver_address` mediumtext COLLATE utf8mb4_unicode_ci,
  `receiver_other_info` mediumtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `transfer_withdraw_orders_currency_id_foreign` (`currency_id`),
  KEY `transfer_withdraw_orders_customer_id_foreign` (`customer_id`),
  KEY `transfer_withdraw_orders_transfer_agency_country_id_foreign` (`transfer_agency_country_id`),
  KEY `transfer_withdraw_orders_admin_id_foreign` (`admin_id`),
  KEY `transfer_withdraw_orders_transferred_currency_id_foreign` (`transferred_currency_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transfer_withdraw_orders`
--

INSERT INTO `transfer_withdraw_orders` (`id`, `amount`, `currency_id`, `exchange_price`, `transfer_fee`, `fee_percent`, `transferred_amount`, `transferred_currency_id`, `customer_id`, `transfer_type`, `receiving_mode`, `transfer_agency_country_id`, `current_status`, `status_note`, `status_changed_date`, `detail_statement`, `admin_id`, `img_path`, `reference_id_type`, `receiver_name`, `receiver_acc_number`, `receiver_phone`, `receiver_email`, `receiver_address`, `receiver_other_info`, `created_at`, `updated_at`) VALUES
(2, '30.00', 1, '1.0000', '0.3000', '0.00', '0.00', 1, 1, 'transfer', 'wallet', 3, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-23 20:52:00', '2021-05-23 20:52:00'),
(3, '30.00', 1, '1.0000', '0.3000', '0.01', '30.00', 1, 1, 'transfer', 'wallet', 3, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-23 20:54:13', '2021-05-23 20:54:13'),
(4, '30.00', 1, '1.0000', '0.3000', '0.01', '30.00', 1, 1, 'transfer', 'wallet', 3, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-23 20:59:58', '2021-05-23 20:59:58'),
(5, '20.00', 1, '1.0000', '0.2000', '0.01', '20.00', 1, 1, 'transfer', 'cash', 12, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-24 21:27:34', '2021-05-24 21:27:34'),
(6, '20.00', 1, '1.0000', '0.2000', '0.01', '20.00', 1, 1, 'transfer', 'cash', 12, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-24 21:29:17', '2021-05-24 21:29:17'),
(7, '20.00', 1, '1.0000', '0.2000', '0.01', '20.00', 1, 1, 'transfer', 'cash', 12, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-24 21:48:35', '2021-05-24 21:48:35'),
(8, '20.00', 1, '1.0000', '0.2000', '0.01', '20.00', 1, 1, 'transfer', 'cash', 12, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-25 11:20:28', '2021-05-25 11:20:28'),
(9, '30.00', 1, '1.0000', '0.3000', '0.01', '30.00', 1, 1, 'transfer', 'cash', 1, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-26 18:57:28', '2021-05-26 18:57:28'),
(10, '24.00', 1, '1.0000', '0.2400', '0.01', '24.00', 1, 1, 'transfer', 'cash', 1, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-26 18:58:49', '2021-05-26 18:58:49'),
(11, '30.00', 1, '1.0000', '0.3000', '0.01', '30.00', 1, 2, 'transfer', 'wallet', 12, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-27 19:31:35', '2021-05-27 19:31:35'),
(12, '30.00', 1, '1.0000', '0.3000', '0.01', '30.00', 1, 2, 'transfer', 'wallet', 12, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-27 19:32:38', '2021-05-27 19:32:38'),
(13, '30.00', 1, '1.0000', '0.3000', '0.01', '30.00', 1, 2, 'transfer', 'wallet', 12, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-27 21:23:21', '2021-05-27 21:23:21'),
(14, '30.00', 1, '1.0000', '0.3000', '0.01', '30.00', 1, 1, 'transfer', 'wallet', 1, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-29 21:53:32', '2021-05-29 21:53:32'),
(15, '40.00', 1, '1.0000', '0.4000', '0.01', '40.00', 1, 1, 'transfer', 'cash', 6, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-29 22:07:26', '2021-05-29 22:07:26'),
(16, '34.00', 1, '1.0000', '0.3400', '0.01', '34.00', 1, 1, 'transfer', 'wallet', 3, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-29 22:11:33', '2021-05-29 22:11:33'),
(17, '34.00', 1, '1.0000', '0.3400', '0.01', '34.00', 1, 1, 'transfer', 'wallet', 3, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-29 22:11:42', '2021-05-29 22:11:42');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4000 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'first_user', 'admin@ytadawul.com', NULL, '$2y$10$TYO/rdtGeMumyt7qML5fh.MBp1clrxBuGKpbEkuf89G6RoTf/mJB.', 'z5xvX5uz8Pbq1ah7jPMymNzn5Zs01s95uyjr0DXNwtDMtlrN4uu1w6IkWQow', '2021-02-07 12:45:20', '2021-05-28 12:59:32'),
(2, 'M Gatta', 'admin@admin.com', NULL, '$2y$10$2aYrCPlkAjvSXkFCwyvEiuARW3wv4sianVT9jD7k/oZvsMSsx57Sm', '', NULL, '2021-04-26 19:56:33'),
(3, 'علي النائب', 'Ali.Alnab@ytadawul.com', NULL, '$2y$10$PWrh3veQ0wNH4IYEM6ClvO.arnCiHsSg1YAyNko4xN2l/UagMfvgy', NULL, '2020-10-25 13:12:55', '2020-10-25 13:14:13'),
(4, 'jack dowarasi', 'hikibiw5361@synevde.com', NULL, '$2y$10$PWrh3veQ0wNH4IYEM6ClvO.arnCiHsSg1YAyNko4xN2l/UagMfvgy', NULL, '2020-08-29 15:16:49', '2020-08-29 15:16:49'),
(5, 'jack dowarasi', 'hikibiw535@synevde.com', NULL, '$2y$10$PWrh3veQ0wNH4IYEM6ClvO.arnCiHsSg1YAyNko4xN2l/UagMfvgy', NULL, '2020-08-29 15:21:07', '2020-08-30 09:35:43'),
(6, 'TebbaaX', '80x12@protonmail.com', NULL, '$2y$10$PWrh3veQ0wNH4IYEM6ClvO.arnCiHsSg1YAyNko4xN2l/UagMfvgy', NULL, '2020-08-30 15:39:00', '2020-08-30 17:16:03'),
(7, 'غسان محمد علي عصبه', 'ghsan077@gmail.com', NULL, '$2y$10$PWrh3veQ0wNH4IYEM6ClvO.arnCiHsSg1YAyNko4xN2l/UagMfvgy', NULL, '2020-09-01 07:37:32', '2020-09-01 07:37:32'),
(8, 'Younis AL Monifi', 'monify7@gmail.com', NULL, '$2y$10$PWrh3veQ0wNH4IYEM6ClvO.arnCiHsSg1YAyNko4xN2l/UagMfvgy', NULL, '2020-09-10 23:51:32', '2020-09-11 01:37:39'),
(9, 'أسامة عادل صالح عبدالله', 'mr.oas86@gmail.com', NULL, '$2y$10$PWrh3veQ0wNH4IYEM6ClvO.arnCiHsSg1YAyNko4xN2l/UagMfvgy', NULL, '2020-09-16 04:16:25', '2020-09-16 04:16:25'),
(10, 'سعيد احمد محمد عبدالله باذيب', 'sambbox17@gmail.com', NULL, '$2y$10$PWrh3veQ0wNH4IYEM6ClvO.arnCiHsSg1YAyNko4xN2l/UagMfvgy', NULL, '2020-09-22 12:25:46', '2020-09-22 12:25:46'),
(11, 'Amjed radman Ahmed Mohammed alshaibani', 'amjedradman39@gmail.com', NULL, '$2y$10$PWrh3veQ0wNH4IYEM6ClvO.arnCiHsSg1YAyNko4xN2l/UagMfvgy', NULL, '2020-09-24 08:52:42', '2020-09-24 08:52:42'),
(12, 'Zakaria', 'zakaria.ahmed.alariqi5@gmail.com', NULL, '$2y$10$PWrh3veQ0wNH4IYEM6ClvO.arnCiHsSg1YAyNko4xN2l/UagMfvgy', NULL, '2020-09-26 13:46:44', '2020-09-26 13:46:44'),
(13, 'يزن ناصر المجهلي', 'yazan.naseer.ali@outlook.sa', NULL, '$2y$10$PWrh3veQ0wNH4IYEM6ClvO.arnCiHsSg1YAyNko4xN2l/UagMfvgy', NULL, '2020-09-28 21:48:07', '2020-09-28 21:48:07'),
(14, 'يزن ناصر المجهلي', 'yazan.naseer.ali@gmail.com', NULL, '$2y$10$PWrh3veQ0wNH4IYEM6ClvO.arnCiHsSg1YAyNko4xN2l/UagMfvgy', NULL, '2020-09-28 21:54:14', '2020-09-28 21:54:14'),
(15, 'Hassan Saleh Mohammed', 'hsnsalh121@gmail.com', NULL, '$2y$10$PWrh3veQ0wNH4IYEM6ClvO.arnCiHsSg1YAyNko4xN2l/UagMfvgy', NULL, '2020-10-08 22:56:52', '2020-10-08 22:56:52'),
(16, 'محمد احمد محمد باحكيم', 'bahakim2020@gmail.com', NULL, '$2y$10$PWrh3veQ0wNH4IYEM6ClvO.arnCiHsSg1YAyNko4xN2l/UagMfvgy', NULL, '2020-10-25 22:34:24', '2020-10-25 22:34:24'),
(17, 'Mohssen Jamal Hassan bin Hassan', 'wwwmhassan111@gmail.com', NULL, '$2y$10$PWrh3veQ0wNH4IYEM6ClvO.arnCiHsSg1YAyNko4xN2l/UagMfvgy', NULL, '2020-10-26 08:54:09', '2020-10-26 08:54:09'),
(18, 'محمد عبدالكريم القهالي', 'Mohammedalgohaliy2@gmail.com', NULL, '$2y$10$PWrh3veQ0wNH4IYEM6ClvO.arnCiHsSg1YAyNko4xN2l/UagMfvgy', NULL, '2020-10-26 14:59:28', '2020-10-26 14:59:28'),
(19, 'Ali ali algohaliy', 'aeghf7781@gmail.com', NULL, '$2y$10$PWrh3veQ0wNH4IYEM6ClvO.arnCiHsSg1YAyNko4xN2l/UagMfvgy', NULL, '2020-10-26 16:26:32', '2020-10-26 16:26:32'),
(20, 'rushdi rashid abdo alwan', 'roshstiv@gmail.com', NULL, '$2y$10$PWrh3veQ0wNH4IYEM6ClvO.arnCiHsSg1YAyNko4xN2l/UagMfvgy', NULL, '2020-10-27 12:47:05', '2020-10-27 13:00:02'),
(21, 'Ebrahem Saleh Almmlok', 'ebrahemalmmlok422@gmail.com', NULL, '$2y$10$PWrh3veQ0wNH4IYEM6ClvO.arnCiHsSg1YAyNko4xN2l/UagMfvgy', NULL, '2020-10-27 15:57:19', '2020-10-27 15:57:19'),
(22, 'Himyar Mohammed', 'h_aljedri@hotmail.com', NULL, '$2y$10$PWrh3veQ0wNH4IYEM6ClvO.arnCiHsSg1YAyNko4xN2l/UagMfvgy', NULL, '2020-10-28 07:15:28', '2020-10-28 07:15:28'),
(23, 'Fahad Mohammed Abdel Qyoom', 'norrrras@hotmail.com', NULL, '$2y$10$PWrh3veQ0wNH4IYEM6ClvO.arnCiHsSg1YAyNko4xN2l/UagMfvgy', NULL, '2020-11-03 04:09:36', '2020-11-03 04:09:36'),
(24, 'علي عبد الرزاق احمد الذيباني', 'alialthaibani139@gmail.com', NULL, '$2y$10$PWrh3veQ0wNH4IYEM6ClvO.arnCiHsSg1YAyNko4xN2l/UagMfvgy', NULL, '2020-11-09 11:07:21', '2020-11-09 11:07:21'),
(25, 'رشيد عبدالله محمد صالح', 'rsheed73957@gmail.com', NULL, '$2y$10$PWrh3veQ0wNH4IYEM6ClvO.arnCiHsSg1YAyNko4xN2l/UagMfvgy', NULL, '2020-11-10 22:42:07', '2020-11-10 22:42:07'),
(26, 'Ayman ali', 'wasf041@gmail.com', NULL, '$2y$10$PWrh3veQ0wNH4IYEM6ClvO.arnCiHsSg1YAyNko4xN2l/UagMfvgy', NULL, '2020-11-17 01:08:19', '2020-11-17 01:08:19'),
(27, 'محمد جابر', 'alhmami2009@gmail.com', NULL, '$2y$10$PWrh3veQ0wNH4IYEM6ClvO.arnCiHsSg1YAyNko4xN2l/UagMfvgy', NULL, '2020-11-25 20:10:13', '2020-11-25 20:10:13'),
(28, 'ayman abdo bakri fakerah', 'ayman32312@gmail.com', NULL, '$2y$10$PWrh3veQ0wNH4IYEM6ClvO.arnCiHsSg1YAyNko4xN2l/UagMfvgy', NULL, '2020-12-09 11:32:12', '2020-12-09 11:32:12'),
(29, 'عبدالملك العزي سالم قايد الحطامي', 'al7tamy@gmail.com', NULL, '$2y$10$PWrh3veQ0wNH4IYEM6ClvO.arnCiHsSg1YAyNko4xN2l/UagMfvgy', NULL, '2020-12-10 08:59:02', '2020-12-10 08:59:02'),
(30, 'محمد عبدالوهاب محمد المطهر', 'almutahar2016@outlook.com', NULL, '$2y$10$PWrh3veQ0wNH4IYEM6ClvO.arnCiHsSg1YAyNko4xN2l/UagMfvgy', NULL, '2020-12-13 07:21:59', '2020-12-13 07:21:59'),
(31, 'Sharfabdulla kalb Aldbe', 'sharf9703@gmail.com', NULL, '$2y$10$PWrh3veQ0wNH4IYEM6ClvO.arnCiHsSg1YAyNko4xN2l/UagMfvgy', NULL, '2020-12-13 09:51:08', '2020-12-13 09:51:08'),
(32, 'WAGEEB ABDULQAWI TAMBASH', 'forutechmax@gmail.com', NULL, '$2y$10$PWrh3veQ0wNH4IYEM6ClvO.arnCiHsSg1YAyNko4xN2l/UagMfvgy', NULL, '2020-12-13 11:52:05', '2020-12-13 11:52:05'),
(33, 'Najla', 'najla.m.alariki@gmail.com', NULL, '$2y$10$PWrh3veQ0wNH4IYEM6ClvO.arnCiHsSg1YAyNko4xN2l/UagMfvgy', NULL, '2020-12-17 02:57:04', '2020-12-17 02:57:04'),
(34, 'ايمان محمد اللوندي', 'emanlowndi@gmail.com', NULL, '$2y$10$PWrh3veQ0wNH4IYEM6ClvO.arnCiHsSg1YAyNko4xN2l/UagMfvgy', NULL, '2020-12-26 22:11:28', '2020-12-26 22:11:28'),
(35, 'سعيد خالد بامطرف', 'saeedkhlaid@gmail.com', NULL, '$2y$10$PWrh3veQ0wNH4IYEM6ClvO.arnCiHsSg1YAyNko4xN2l/UagMfvgy', NULL, '2021-01-02 01:38:21', '2021-01-02 01:38:21'),
(36, 'OsamaAlamoudi', 'ssoooor19@gmail.com', NULL, '$2y$10$PWrh3veQ0wNH4IYEM6ClvO.arnCiHsSg1YAyNko4xN2l/UagMfvgy', NULL, '2021-01-10 01:34:45', '2021-01-10 01:34:45'),
(37, 'Osama Abdullah Hussein Alamoudi', 'ssoooor3@gmail.com', NULL, '$2y$10$PWrh3veQ0wNH4IYEM6ClvO.arnCiHsSg1YAyNko4xN2l/UagMfvgy', NULL, '2021-01-12 11:07:01', '2021-01-12 11:07:01'),
(38, 'Osama Abdullah Hussein Alamoudi', 'ssoooor10@gmail.com', NULL, '$2y$10$PWrh3veQ0wNH4IYEM6ClvO.arnCiHsSg1YAyNko4xN2l/UagMfvgy', NULL, '2021-01-12 11:07:53', '2021-01-12 11:07:53'),
(39, 'يحيى عبدالمؤمن عبدالملك الحدابي', 'yahya22772@gmail.com', NULL, '$2y$10$PWrh3veQ0wNH4IYEM6ClvO.arnCiHsSg1YAyNko4xN2l/UagMfvgy', NULL, '2021-01-17 14:30:23', '2021-01-17 14:30:23'),
(40, 'Loai Samir Abdulwahab Al-Ghashm', 'loaialghashm@gmail.com', NULL, '$2y$10$PWrh3veQ0wNH4IYEM6ClvO.arnCiHsSg1YAyNko4xN2l/UagMfvgy', NULL, '2021-01-22 04:14:08', '2021-01-22 04:14:08');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accounts_groups`
--
ALTER TABLE `accounts_groups`
  ADD CONSTRAINT `accounts_groups_parent_group_foreign` FOREIGN KEY (`parent_group`) REFERENCES `accounts_groups` (`id`);

--
-- Constraints for table `accounts_tree`
--
ALTER TABLE `accounts_tree`
  ADD CONSTRAINT `accounts_tree_acc_group_code_foreign` FOREIGN KEY (`acc_group_code`) REFERENCES `accounts_groups` (`group_code`);

--
-- Constraints for table `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `cities_country_code_foreign` FOREIGN KEY (`country_code`) REFERENCES `countries` (`code`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_child_id_foreign` FOREIGN KEY (`child_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `comments_old`
--
ALTER TABLE `comments_old`
  ADD CONSTRAINT `comments_old_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`);

--
-- Constraints for table `consultants`
--
ALTER TABLE `consultants`
  ADD CONSTRAINT `consultants_consultants_category_id_foreign` FOREIGN KEY (`consultants_category_id`) REFERENCES `consultants_categories` (`id`),
  ADD CONSTRAINT `consultants_currency_id_foreign` FOREIGN KEY (`currency_id`) REFERENCES `currencies` (`id`),
  ADD CONSTRAINT `consultants_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`),
  ADD CONSTRAINT `consultants_service_package_id_foreign` FOREIGN KEY (`service_package_id`) REFERENCES `services_packages` (`id`);

--
-- Constraints for table `consultants_orders_procedures`
--
ALTER TABLE `consultants_orders_procedures`
  ADD CONSTRAINT `consultants_orders_procedures_consultants_order_id_foreign` FOREIGN KEY (`consultants_order_id`) REFERENCES `customer_consultants_orders` (`id`),
  ADD CONSTRAINT `consultants_orders_procedures_procedure_type_id_foreign` FOREIGN KEY (`procedure_type_id`) REFERENCES `procedure_types` (`id`);

--
-- Constraints for table `countries`
--
ALTER TABLE `countries`
  ADD CONSTRAINT `countries_currency_id_foreign` FOREIGN KEY (`currency_id`) REFERENCES `currencies` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `courses_trainings`
--
ALTER TABLE `courses_trainings`
  ADD CONSTRAINT `courses_trainings_course_category_id_foreign` FOREIGN KEY (`course_category_id`) REFERENCES `courses_categories` (`id`),
  ADD CONSTRAINT `courses_trainings_currency_id_foreign` FOREIGN KEY (`currency_id`) REFERENCES `currencies` (`id`),
  ADD CONSTRAINT `courses_trainings_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `teacher_details` (`id`);

--
-- Constraints for table `course_exercises`
--
ALTER TABLE `course_exercises`
  ADD CONSTRAINT `course_exercises_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses_trainings` (`id`),
  ADD CONSTRAINT `course_exercises_part_id_foreign` FOREIGN KEY (`part_id`) REFERENCES `course_parts` (`id`);

--
-- Constraints for table `course_parts`
--
ALTER TABLE `course_parts`
  ADD CONSTRAINT `course_parts_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses_trainings` (`id`);

--
-- Constraints for table `course_subjects`
--
ALTER TABLE `course_subjects`
  ADD CONSTRAINT `course_subjects_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses_trainings` (`id`),
  ADD CONSTRAINT `course_subjects_part_id_foreign` FOREIGN KEY (`part_id`) REFERENCES `course_parts` (`id`);

--
-- Constraints for table `currency_changes`
--
ALTER TABLE `currency_changes`
  ADD CONSTRAINT `currency_changes_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `currency_changes_currency_id_foreign` FOREIGN KEY (`currency_id`) REFERENCES `currencies` (`id`);

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_badge_id_foreign` FOREIGN KEY (`badge_id`) REFERENCES `badges` (`id`),
  ADD CONSTRAINT `customers_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `customers_courses`
--
ALTER TABLE `customers_courses`
  ADD CONSTRAINT `customers_courses_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses_trainings` (`id`),
  ADD CONSTRAINT `customers_courses_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `customers_courses_last_subject_id_foreign` FOREIGN KEY (`last_subject_id`) REFERENCES `course_subjects` (`id`);

--
-- Constraints for table `customers_loyalty_points_prices`
--
ALTER TABLE `customers_loyalty_points_prices`
  ADD CONSTRAINT `customers_loyalty_points_prices_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`);

--
-- Constraints for table `customer_banking_accounts`
--
ALTER TABLE `customer_banking_accounts`
  ADD CONSTRAINT `customer_banking_accounts_country_code_foreign` FOREIGN KEY (`country_code`) REFERENCES `countries` (`code`),
  ADD CONSTRAINT `customer_banking_accounts_currency_id_foreign` FOREIGN KEY (`currency_id`) REFERENCES `currencies` (`id`),
  ADD CONSTRAINT `customer_banking_accounts_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `customer_banking_accounts_receiving_agencies_country_id_foreign` FOREIGN KEY (`receiving_agencies_country_id`) REFERENCES `receiving_agencies_countries` (`id`);

--
-- Constraints for table `customer_consultants_orders`
--
ALTER TABLE `customer_consultants_orders`
  ADD CONSTRAINT `customer_consultants_orders_consultant_id_foreign` FOREIGN KEY (`consultant_id`) REFERENCES `consultants` (`id`),
  ADD CONSTRAINT `customer_consultants_orders_currency_id_foreign` FOREIGN KEY (`currency_id`) REFERENCES `currencies` (`id`),
  ADD CONSTRAINT `customer_consultants_orders_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`);

--
-- Constraints for table `customer_d_c_orders`
--
ALTER TABLE `customer_d_c_orders`
  ADD CONSTRAINT `customer_d_c_orders_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`);

--
-- Constraints for table `customer_d_c_order_details`
--
ALTER TABLE `customer_d_c_order_details`
  ADD CONSTRAINT `customer_d_c_order_details_currency_id_foreign` FOREIGN KEY (`currency_id`) REFERENCES `currencies` (`id`),
  ADD CONSTRAINT `customer_d_c_order_details_digital_card_id_foreign` FOREIGN KEY (`digital_card_id`) REFERENCES `digital_cards` (`id`),
  ADD CONSTRAINT `customer_d_c_order_details_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `customer_d_c_orders` (`id`);

--
-- Constraints for table `customer_finance_accounts`
--
ALTER TABLE `customer_finance_accounts`
  ADD CONSTRAINT `cutomer_finance_accounts_agency_id_foreign` FOREIGN KEY (`agency_id`) REFERENCES `deposit_agencies` (`id`),
  ADD CONSTRAINT `cutomer_finance_accounts_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`);

--
-- Constraints for table `customer_s_p_ops`
--
ALTER TABLE `customer_s_p_ops`
  ADD CONSTRAINT `customer_s_p_ops_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `customer_s_p_ops_service_package_id_foreign` FOREIGN KEY (`service_package_id`) REFERENCES `services_packages` (`id`);

--
-- Constraints for table `deposit_agencies_methods`
--
ALTER TABLE `deposit_agencies_methods`
  ADD CONSTRAINT `agencies_deposit_methods_deposit_agency_id_foreign` FOREIGN KEY (`deposit_agency_id`) REFERENCES `deposit_agencies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `agencies_deposit_methods_deposit_method_id_foreign` FOREIGN KEY (`deposit_method_id`) REFERENCES `deposit_methods` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `deposit_agency_countries`
--
ALTER TABLE `deposit_agency_countries`
  ADD CONSTRAINT `deposit_agency_countries_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`),
  ADD CONSTRAINT `deposit_agency_countries_deposit_agency_id_foreign` FOREIGN KEY (`deposit_agency_id`) REFERENCES `deposit_agencies` (`id`);

--
-- Constraints for table `deposit_orders`
--
ALTER TABLE `deposit_orders`
  ADD CONSTRAINT `deposit_orders_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `deposit_orders_currency_id_foreign` FOREIGN KEY (`currency_id`) REFERENCES `currencies` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `deposit_orders_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `deposit_orders_deposit_agency_country_id_foreign` FOREIGN KEY (`deposit_agency_country_id`) REFERENCES `deposit_agency_countries` (`id`);

--
-- Constraints for table `deposit_withdraw_processes`
--
ALTER TABLE `deposit_withdraw_processes`
  ADD CONSTRAINT `deposit_withdraw_processes_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `detail_transactions`
--
ALTER TABLE `detail_transactions`
  ADD CONSTRAINT `detail_transactions_account_number_foreign` FOREIGN KEY (`account_number`) REFERENCES `accounts_tree` (`account_number`),
  ADD CONSTRAINT `detail_transactions_voucher_id_foreign` FOREIGN KEY (`voucher_id`) REFERENCES `head_transaction` (`voucher_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `digital_cards`
--
ALTER TABLE `digital_cards`
  ADD CONSTRAINT `digital_cards_currency_id_foreign` FOREIGN KEY (`currency_id`) REFERENCES `currencies` (`id`),
  ADD CONSTRAINT `digital_cards_provider_id_foreign` FOREIGN KEY (`provider_id`) REFERENCES `digital_cards_providers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `digital_cards_purchases`
--
ALTER TABLE `digital_cards_purchases`
  ADD CONSTRAINT `digital_cards_purchases_currency_id_foreign` FOREIGN KEY (`currency_id`) REFERENCES `currencies` (`id`);

--
-- Constraints for table `freelancing_platforms_deposit_agencies`
--
ALTER TABLE `freelancing_platforms_deposit_agencies`
  ADD CONSTRAINT `free_agencies_FK` FOREIGN KEY (`deposit_agency_id`) REFERENCES `deposit_agencies` (`id`),
  ADD CONSTRAINT `free_plat_FK` FOREIGN KEY (`freelancing_platform_id`) REFERENCES `freelancing_platforms` (`id`);

--
-- Constraints for table `lib_transactions`
--
ALTER TABLE `lib_transactions`
  ADD CONSTRAINT `lib_transactions_wallet_id_foreign` FOREIGN KEY (`wallet_id`) REFERENCES `lib_wallets` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `lib_transfers`
--
ALTER TABLE `lib_transfers`
  ADD CONSTRAINT `lib_transfers_deposit_id_foreign` FOREIGN KEY (`deposit_id`) REFERENCES `lib_transactions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `lib_transfers_withdraw_id_foreign` FOREIGN KEY (`withdraw_id`) REFERENCES `lib_transactions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `loyalty_points_prices`
--
ALTER TABLE `loyalty_points_prices`
  ADD CONSTRAINT `loyalty_points_badge_fk` FOREIGN KEY (`badge_id`) REFERENCES `badges` (`id`);

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `org_brokerage_firms`
--
ALTER TABLE `org_brokerage_firms`
  ADD CONSTRAINT `org_brokerage_firms_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `org_certificates`
--
ALTER TABLE `org_certificates`
  ADD CONSTRAINT `org_certificates_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `org_counters`
--
ALTER TABLE `org_counters`
  ADD CONSTRAINT `org_counters_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `org_news`
--
ALTER TABLE `org_news`
  ADD CONSTRAINT `org_news_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `org_offers`
--
ALTER TABLE `org_offers`
  ADD CONSTRAINT `org_offers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `org_partners`
--
ALTER TABLE `org_partners`
  ADD CONSTRAINT `org_partners_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `org_payment_companies`
--
ALTER TABLE `org_payment_companies`
  ADD CONSTRAINT `org_payment_companies_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `org_posts`
--
ALTER TABLE `org_posts`
  ADD CONSTRAINT `org_posts_post_category_id_foreign` FOREIGN KEY (`post_category_id`) REFERENCES `org_post_categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `org_posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `org_post_categories`
--
ALTER TABLE `org_post_categories`
  ADD CONSTRAINT `org_post_categories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `org_services`
--
ALTER TABLE `org_services`
  ADD CONSTRAINT `org_services_service_category_id_foreign` FOREIGN KEY (`service_category_id`) REFERENCES `org_service_categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `org_services_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `org_service_categories`
--
ALTER TABLE `org_service_categories`
  ADD CONSTRAINT `org_service_categories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `org_service_features`
--
ALTER TABLE `org_service_features`
  ADD CONSTRAINT `org_service_features_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `org_services` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `org_service_features_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `org_sliders`
--
ALTER TABLE `org_sliders`
  ADD CONSTRAINT `org_sliders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `org_why_us`
--
ALTER TABLE `org_why_us`
  ADD CONSTRAINT `org_why_us_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `paying_orders`
--
ALTER TABLE `paying_orders`
  ADD CONSTRAINT `paying_orders_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `paying_orders_currency_id_foreign` FOREIGN KEY (`currency_id`) REFERENCES `currencies` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `paying_orders_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`);

--
-- Constraints for table `receiving_agencies_countries`
--
ALTER TABLE `receiving_agencies_countries`
  ADD CONSTRAINT `receiving_agencies_countries_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`),
  ADD CONSTRAINT `receiving_agencies_countries_transfer_agency_id_foreign` FOREIGN KEY (`transfer_agency_id`) REFERENCES `transfer_agencies` (`id`);

--
-- Constraints for table `related_loves_accounts`
--
ALTER TABLE `related_loves_accounts`
  ADD CONSTRAINT `related_loves_accounts_country_code_foreign` FOREIGN KEY (`country_code`) REFERENCES `countries` (`code`),
  ADD CONSTRAINT `related_loves_accounts_currency_id_foreign` FOREIGN KEY (`currency_id`) REFERENCES `currencies` (`id`),
  ADD CONSTRAINT `related_loves_accounts_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `related_loves_accounts_receiving_agencies_country_id_foreign` FOREIGN KEY (`receiving_agencies_country_id`) REFERENCES `receiving_agencies_countries` (`id`);

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services_parent_service_id_foreign` FOREIGN KEY (`parent_service_id`) REFERENCES `parent_services` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `services_features`
--
ALTER TABLE `services_features`
  ADD CONSTRAINT `services_features_parent_service_id_foreign` FOREIGN KEY (`parent_service_id`) REFERENCES `parent_services` (`id`);

--
-- Constraints for table `services_packages`
--
ALTER TABLE `services_packages`
  ADD CONSTRAINT `services_packages_currency_id_foreign` FOREIGN KEY (`currency_id`) REFERENCES `currencies` (`id`),
  ADD CONSTRAINT `services_packages_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `packages_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `services_packages_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subject_attachments`
--
ALTER TABLE `subject_attachments`
  ADD CONSTRAINT `subject_attachments_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `course_subjects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `teacher_details`
--
ALTER TABLE `teacher_details`
  ADD CONSTRAINT `teacher_details_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`);

--
-- Constraints for table `telescope_entries_tags`
--
ALTER TABLE `telescope_entries_tags`
  ADD CONSTRAINT `telescope_entries_tags_entry_uuid_foreign` FOREIGN KEY (`entry_uuid`) REFERENCES `telescope_entries` (`uuid`) ON DELETE CASCADE;

--
-- Constraints for table `trading_customers_points`
--
ALTER TABLE `trading_customers_points`
  ADD CONSTRAINT `trading_customers_points_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `trading_customers_points_trading_agency_id_foreign` FOREIGN KEY (`trading_agency_id`) REFERENCES `trading_agencies` (`id`),
  ADD CONSTRAINT `trading_customers_points_trading_service_id_foreign` FOREIGN KEY (`trading_service_id`) REFERENCES `trading_services` (`id`);

--
-- Constraints for table `trading_services_customers`
--
ALTER TABLE `trading_services_customers`
  ADD CONSTRAINT `trading_services_customers_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `trading_services_customers_trading_agency_id_foreign` FOREIGN KEY (`trading_agency_id`) REFERENCES `trading_agencies` (`id`),
  ADD CONSTRAINT `trading_services_customers_trading_service_id_foreign` FOREIGN KEY (`trading_service_id`) REFERENCES `trading_services` (`id`);

--
-- Constraints for table `trading_services_orders`
--
ALTER TABLE `trading_services_orders`
  ADD CONSTRAINT `trading_services_orders_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `trading_services_orders_trading_service_id_foreign` FOREIGN KEY (`trading_service_id`) REFERENCES `trading_services` (`id`);

--
-- Constraints for table `transfer_withdraw_orders`
--
ALTER TABLE `transfer_withdraw_orders`
  ADD CONSTRAINT `transfer_withdraw_orders_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `transfer_withdraw_orders_currency_id_foreign` FOREIGN KEY (`currency_id`) REFERENCES `currencies` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `transfer_withdraw_orders_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `transfer_withdraw_orders_transfer_agency_country_id_foreign` FOREIGN KEY (`transfer_agency_country_id`) REFERENCES `receiving_agencies_countries` (`id`),
  ADD CONSTRAINT `transfer_withdraw_orders_transferred_currency_id_foreign` FOREIGN KEY (`transferred_currency_id`) REFERENCES `currencies` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
