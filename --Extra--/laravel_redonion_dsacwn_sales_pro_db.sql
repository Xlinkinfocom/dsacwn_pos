-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 29, 2021 at 06:31 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel_redonion_dsacwn_sales_pro_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(10) UNSIGNED NOT NULL,
  `account_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `initial_balance` double DEFAULT NULL,
  `total_balance` double NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_default` tinyint(1) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `account_no`, `name`, `initial_balance`, `total_balance`, `note`, `is_default`, `is_active`, `created_at`, `updated_at`) VALUES
(1, '11111', 'Sales Account', 1000, 1000, 'this is first account', 1, 1, '2018-12-18 02:58:02', '2020-08-06 17:03:28'),
(3, '21211', 'Sa', NULL, 0, NULL, 0, 1, '2018-12-18 02:58:56', '2020-08-06 17:03:16'),
(4, '31311', 'khan', 10000, 10000, NULL, 0, 1, '2020-07-23 16:38:30', '2020-08-06 17:03:28');

-- --------------------------------------------------------

--
-- Table structure for table `adjustments`
--

CREATE TABLE `adjustments` (
  `id` int(10) UNSIGNED NOT NULL,
  `reference_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `document` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_qty` double NOT NULL,
  `item` int(11) NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `adjustments`
--

INSERT INTO `adjustments` (`id`, `reference_no`, `warehouse_id`, `document`, `total_qty`, `item`, `note`, `created_at`, `updated_at`) VALUES
(1, 'adr-20210111-024155', 2, NULL, 100, 1, NULL, '2021-01-11 02:41:55', '2021-01-11 02:41:55');

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `id` int(10) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `employee_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `checkin` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `checkout` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `billers`
--

CREATE TABLE `billers` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vat_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postal_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `billers`
--

INSERT INTO `billers` (`id`, `name`, `image`, `company_name`, `vat_number`, `email`, `phone_number`, `address`, `city`, `state`, `postal_code`, `country`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'akshae', NULL, 'SUN SHINE IT SOLUTION', NULL, 'akshayshrivastav3@gmail.com', '6546465465465', 'kota', 'kota', 'india', '2313874', 'India', 0, '2020-07-26 13:11:48', '2020-08-08 05:14:45'),
(2, 'Aminul', NULL, 'Bengal Store', NULL, 'begalstore2020@gmail.com', '0416263177', '19 Dobell Road', 'Claymore', 'NSW', '2566', 'Australia', 1, '2020-08-08 05:16:34', '2020-08-08 05:16:34');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `parent_id`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Scale Item', 5, 1, '2020-07-26 08:04:51', '2021-01-10 22:53:37'),
(2, 'Food Item', 4, 1, '2020-07-26 08:05:07', '2021-01-10 22:51:45'),
(3, 'Unknown Product', 2, 1, '2020-08-04 16:19:44', '2020-08-04 16:19:44'),
(4, 'Non-Veg', NULL, 1, '2021-01-10 22:51:31', '2021-01-10 22:51:31'),
(5, 'Veg-Product', NULL, 1, '2021-01-10 22:53:20', '2021-01-10 22:53:20');

-- --------------------------------------------------------

--
-- Table structure for table `commission_log`
--

CREATE TABLE `commission_log` (
  `commission_log_id` bigint(20) NOT NULL,
  `cat_id` bigint(20) NOT NULL,
  `sub_cat_id` bigint(20) DEFAULT NULL,
  `commssion` varchar(25) NOT NULL DEFAULT '0',
  `payment_fee` varchar(25) DEFAULT '0',
  `vat` varchar(25) NOT NULL DEFAULT '0',
  `total_commission` varchar(25) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `commission_log`
--

INSERT INTO `commission_log` (`commission_log_id`, `cat_id`, `sub_cat_id`, `commssion`, `payment_fee`, `vat`, `total_commission`, `created_at`, `updated_at`) VALUES
(1, 0, 0, '2', '2', '2', '6', '2020-12-29 04:18:03', '2020-12-29 04:18:03'),
(2, 2, 3, '2', '2', '2', '6', '2020-12-29 05:23:13', '2020-12-29 05:23:13'),
(3, 4, 2, '2', '2', '2', '6', '2021-01-10 22:52:45', '2021-01-10 22:52:45'),
(4, 5, 1, '5', '5', '5', '15', '2021-01-10 22:54:08', '2021-01-10 22:54:08');

-- --------------------------------------------------------

--
-- Table structure for table `commission_mst`
--

CREATE TABLE `commission_mst` (
  `commission_id` int(10) NOT NULL,
  `commission_log_id` bigint(20) NOT NULL,
  `cat_id` bigint(20) NOT NULL,
  `sub_cat_id` bigint(20) DEFAULT NULL,
  `commssion` varchar(25) NOT NULL DEFAULT '0',
  `payment_fee` varchar(25) NOT NULL DEFAULT '0',
  `vat` varchar(25) NOT NULL DEFAULT '0',
  `total_commission` varchar(25) NOT NULL DEFAULT '0',
  `is_active` int(2) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `commission_mst`
--

INSERT INTO `commission_mst` (`commission_id`, `commission_log_id`, `cat_id`, `sub_cat_id`, `commssion`, `payment_fee`, `vat`, `total_commission`, `is_active`, `created_at`, `updated_at`) VALUES
(2, 2, 2, 3, '2', '2', '2', '6', 1, '2020-12-29 05:23:13', '2020-12-29 05:23:13'),
(3, 3, 4, 2, '2', '2', '2', '6', 1, '2021-01-10 22:52:45', '2021-01-10 22:52:45'),
(4, 4, 5, 1, '5', '5', '5', '15', 1, '2021-01-10 22:54:08', '2021-01-10 22:54:08');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double NOT NULL,
  `minimum_amount` double DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `used` int(11) NOT NULL,
  `expired_date` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `credit_package_log`
--

CREATE TABLE `credit_package_log` (
  `credit_package_log_id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `face_value` int(10) NOT NULL,
  `cost` double(10,2) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `expiry_inDays` bigint(10) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `credit_package_log`
--

INSERT INTO `credit_package_log` (`credit_package_log_id`, `name`, `face_value`, `cost`, `description`, `expiry_inDays`, `created_at`, `updated_at`) VALUES
(1, 'SILVER', 10, 10.00, NULL, 0, '2020-04-09 00:00:00', '2020-04-09 00:00:00'),
(2, 'PLATINUM', 100, 100.00, NULL, 0, '2020-04-09 00:00:00', '2020-04-09 00:00:00'),
(3, 'GOLD', 50, 50.00, NULL, 0, '2020-04-09 00:00:00', '2020-04-09 00:00:00'),
(4, 'GOLD', 25, 50.00, NULL, 0, '2020-04-17 11:22:46', '2020-04-17 11:22:46'),
(5, 'SILVER', 100, 100.00, NULL, 0, '2020-12-22 02:09:11', '2020-12-22 02:09:11'),
(6, 'SILVER', 100, 100.00, 'jkhkjhk', 0, '2020-12-22 18:26:01', '2020-12-22 18:26:01'),
(7, 'test', 1000, 1000.00, 'kjhkjhbgj l k', 0, '2020-12-22 19:22:18', '2020-12-22 19:22:18'),
(8, 'test', 1000, 1000.00, 'kjhkjhbgj l k', 0, '2020-12-22 19:23:37', '2020-12-22 19:23:37'),
(9, 'Subs Pro', 12, 12.00, 'For testing', 0, '2021-01-02 01:30:03', '2021-01-02 01:30:03'),
(10, 'test', 6, 6.00, 'test', 0, '2021-01-14 18:30:45', '2021-01-14 18:30:45'),
(11, 'test', 6, 6.00, 'test1', 0, '2021-01-14 18:36:53', '2021-01-14 18:36:53'),
(12, 'test', 6, 6.00, 'test1', 0, '2021-01-14 18:37:05', '2021-01-14 18:37:05');

-- --------------------------------------------------------

--
-- Table structure for table `credit_package_mst`
--

CREATE TABLE `credit_package_mst` (
  `credit_package_id` int(10) NOT NULL,
  `credit_package_log_id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `face_value` int(10) NOT NULL,
  `cost` double(10,2) NOT NULL,
  `expiry_inDays` bigint(10) NOT NULL DEFAULT 0,
  `is_active` int(2) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `credit_package_mst`
--

INSERT INTO `credit_package_mst` (`credit_package_id`, `credit_package_log_id`, `name`, `description`, `face_value`, `cost`, `expiry_inDays`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 6, 'SILVER', 'jkhkjhk', 100, 100.00, 0, 0, '2020-04-09 00:00:00', '2020-12-22 18:26:01'),
(2, 2, 'PLATINUM', NULL, 100, 100.00, 0, 0, '2020-04-09 00:00:00', '2020-04-09 00:00:00'),
(3, 4, 'GOLD', NULL, 25, 50.00, 0, 0, '2020-04-09 00:00:00', '2020-04-17 11:22:47'),
(5, 9, 'Subs Pro', 'For testing', 12, 12.00, 0, 1, '2021-01-02 01:30:03', '2021-01-02 01:30:03');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(10) UNSIGNED NOT NULL,
  `customer_group_id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tax_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postal_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deposit` double DEFAULT NULL,
  `expense` double DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `customer_group_id`, `name`, `company_name`, `email`, `phone_number`, `tax_no`, `address`, `city`, `state`, `postal_code`, `country`, `deposit`, `expense`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 2, 'akshay shriv', 'SUN SHINE IT SOLUTION', 'akshayshrivastav3@gmail.com', '6546465465465', NULL, 'kota', 'kota', 'india', '2313874', 'India', NULL, 0, 0, '2020-07-26 12:26:55', '2020-08-08 05:19:34'),
(2, 2, 'Regular Customer', NULL, NULL, '1233', NULL, '122', '11223', NULL, NULL, NULL, NULL, NULL, 0, '2020-07-26 13:40:28', '2020-08-08 05:19:34'),
(3, 2, 'test', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2020-07-28 17:34:34', '2020-08-08 05:19:34'),
(4, 4, 'Walk In Customer', NULL, NULL, '9051181895', NULL, 'kolkata', 'kolkata', NULL, NULL, NULL, NULL, NULL, 1, '2020-08-08 05:20:20', '2021-01-11 02:44:57');

-- --------------------------------------------------------

--
-- Table structure for table `customer_groups`
--

CREATE TABLE `customer_groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `percentage` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_groups`
--

INSERT INTO `customer_groups` (`id`, `name`, `percentage`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Walk In', '100', 0, '2020-07-26 11:02:05', '2020-07-26 11:03:38'),
(2, 'Walk In', '0', 0, '2020-07-26 12:26:06', '2020-08-08 05:06:46'),
(3, 'KISAN', '20', 0, '2020-07-31 13:51:50', '2020-08-08 05:06:53'),
(4, 'Walk In Customer', '0', 1, '2020-08-08 05:07:22', '2020-08-08 05:07:22');

-- --------------------------------------------------------

--
-- Table structure for table `deliveries`
--

CREATE TABLE `deliveries` (
  `id` int(10) UNSIGNED NOT NULL,
  `reference_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sale_id` int(11) NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivered_by` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `recieved_by` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `deposits`
--

CREATE TABLE `deposits` (
  `id` int(10) UNSIGNED NOT NULL,
  `amount` double NOT NULL,
  `customer_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `id` int(8) NOT NULL DEFAULT 0,
  `state_id` int(8) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`id`, `state_id`, `name`) VALUES
(1, 1, 'North Andaman'),
(2, 1, 'South Andaman'),
(3, 1, 'Nicobar'),
(4, 2, 'Adilabad'),
(5, 2, 'Anantapur'),
(6, 2, 'Chittoor'),
(7, 2, 'East Godavari'),
(8, 2, 'Guntur'),
(9, 2, 'Hyderabad'),
(10, 2, 'Karimnagar'),
(11, 2, 'Khammam'),
(12, 2, 'Krishna'),
(13, 2, 'Kurnool'),
(14, 2, 'Mahbubnagar'),
(15, 2, 'Medak'),
(16, 2, 'Nalgonda'),
(17, 2, 'Nizamabad'),
(18, 2, 'Prakasam'),
(19, 2, 'Ranga Reddy'),
(20, 2, 'Srikakulam'),
(21, 2, 'Sri Potti Sri Ramulu Nellore'),
(22, 2, 'Vishakhapatnam'),
(23, 2, 'Vizianagaram'),
(24, 2, 'Warangal'),
(25, 2, 'West Godavari'),
(26, 2, 'Cudappah'),
(27, 3, 'Anjaw'),
(28, 3, 'Changlang'),
(29, 3, 'East Siang'),
(30, 3, 'East Kameng'),
(31, 3, 'Kurung Kumey'),
(32, 3, 'Lohit'),
(33, 3, 'Lower Dibang Valley'),
(34, 3, 'Lower Subansiri'),
(35, 3, 'Papum Pare'),
(36, 3, 'Tawang'),
(37, 3, 'Tirap'),
(38, 3, 'Dibang Valley'),
(39, 3, 'Upper Siang'),
(40, 3, 'Upper Subansiri'),
(41, 3, 'West Kameng'),
(42, 3, 'West Siang'),
(43, 4, 'Baksa'),
(44, 4, 'Barpeta'),
(45, 4, 'Bongaigaon'),
(46, 4, 'Cachar'),
(47, 4, 'Chirang'),
(48, 4, 'Darrang'),
(49, 4, 'Dhemaji'),
(50, 4, 'Dima Hasao'),
(51, 4, 'Dhubri'),
(52, 4, 'Dibrugarh'),
(53, 4, 'Goalpara'),
(54, 4, 'Golaghat'),
(55, 4, 'Hailakandi'),
(56, 4, 'Jorhat'),
(57, 4, 'Kamrup'),
(58, 4, 'Kamrup Metropolitan'),
(59, 4, 'Karbi Anglong'),
(60, 4, 'Karimganj'),
(61, 4, 'Kokrajhar'),
(62, 4, 'Lakhimpur'),
(63, 4, 'Morigaon'),
(64, 4, 'Nagaon'),
(65, 4, 'Nalbari'),
(66, 4, 'Sivasagar'),
(67, 4, 'Sonitpur'),
(68, 4, 'Tinsukia'),
(69, 4, 'Udalguri'),
(70, 5, 'Araria'),
(71, 5, 'Arwal'),
(72, 5, 'Aurangabad'),
(73, 5, 'Banka'),
(74, 5, 'Begusarai'),
(75, 5, 'Bhagalpur'),
(76, 5, 'Bhojpur'),
(77, 5, 'Buxar'),
(78, 5, 'Darbhanga'),
(79, 5, 'East Champaran'),
(80, 5, 'Gaya'),
(81, 5, 'Gopalganj'),
(82, 5, 'Jamui'),
(83, 5, 'Jehanabad'),
(84, 5, 'Kaimur'),
(85, 5, 'Katihar'),
(86, 5, 'Khagaria'),
(87, 5, 'Kishanganj'),
(88, 5, 'Lakhisarai'),
(89, 5, 'Madhepura'),
(90, 5, 'Madhubani'),
(91, 5, 'Munger'),
(92, 5, 'Muzaffarpur'),
(93, 5, 'Nalanda'),
(94, 5, 'Nawada'),
(95, 5, 'Patna'),
(96, 5, 'Purnia'),
(97, 5, 'Rohtas'),
(98, 5, 'Saharsa'),
(99, 5, 'Samastipur'),
(100, 5, 'Saran'),
(101, 5, 'Sheikhpura'),
(102, 5, 'Sheohar'),
(103, 5, 'Sitamarhi'),
(104, 5, 'Siwan'),
(105, 5, 'Supaul'),
(106, 6, 'Chandigarh'),
(107, 7, 'Bastar'),
(108, 7, 'Bijapur'),
(109, 7, 'Bilaspur'),
(110, 7, 'Dantewada'),
(111, 7, 'Dhamtari'),
(112, 7, 'Durg'),
(113, 7, 'Jashpur'),
(114, 7, 'Janjgir-Champa'),
(115, 7, 'Korba'),
(116, 7, 'Koriya'),
(117, 7, 'Kanker'),
(118, 7, 'Kabirdham (formerly Kawardha)'),
(119, 7, 'Mahasamund'),
(120, 7, 'Narayanpur'),
(121, 7, 'Raigarh'),
(122, 7, 'Rajnandgaon'),
(123, 7, 'Raipur'),
(124, 7, 'Surguja'),
(125, 8, 'Dadra and Nagar Haveli'),
(126, 9, 'Daman'),
(127, 9, 'Diu'),
(128, 10, 'Central Delhi'),
(129, 10, 'East Delhi'),
(130, 10, 'New Delhi'),
(131, 10, 'North Delhi'),
(132, 10, 'North East Delhi'),
(133, 10, 'North West Delhi'),
(134, 10, 'South Delhi'),
(135, 10, 'South West Delhi'),
(136, 10, 'West Delhi'),
(137, 11, 'North Goa'),
(138, 11, 'South Goa'),
(139, 12, 'Ahmedabad'),
(140, 12, 'Amreli district'),
(141, 12, 'Anand'),
(142, 12, 'Banaskantha'),
(143, 12, 'Bharuch'),
(144, 12, 'Bhavnagar'),
(145, 12, 'Dahod'),
(146, 12, 'The Dangs'),
(147, 12, 'Gandhinagar'),
(148, 12, 'Jamnagar'),
(149, 12, 'Junagadh'),
(150, 12, 'Kutch'),
(151, 12, 'Kheda'),
(152, 12, 'Mehsana'),
(153, 12, 'Narmada'),
(154, 12, 'Navsari'),
(155, 12, 'Patan'),
(156, 12, 'Panchmahal'),
(157, 12, 'Porbandar'),
(158, 12, 'Rajkot'),
(159, 12, 'Sabarkantha'),
(160, 12, 'Surendranagar'),
(161, 12, 'Surat'),
(162, 12, 'Tapi'),
(163, 12, 'Vadodara'),
(164, 12, 'Valsad'),
(165, 13, 'Ambala'),
(166, 13, 'Bhiwani'),
(167, 13, 'Faridabad'),
(168, 13, 'Fatehabad'),
(169, 13, 'Gurgaon'),
(170, 13, 'Hissar'),
(171, 13, 'Jhajjar'),
(172, 13, 'Jind'),
(173, 13, 'Karnal'),
(174, 13, 'Kaithal'),
(175, 13, 'Kurukshetra'),
(176, 13, 'Mahendragarh'),
(177, 13, 'Mewat'),
(178, 13, 'Palwal'),
(179, 13, 'Panchkula'),
(180, 13, 'Panipat'),
(181, 13, 'Rewari'),
(182, 13, 'Rohtak'),
(183, 13, 'Sirsa'),
(184, 13, 'Sonipat'),
(185, 13, 'Yamuna Nagar'),
(186, 14, 'Bilaspur'),
(187, 14, 'Chamba'),
(188, 14, 'Hamirpur'),
(189, 14, 'Kangra'),
(190, 14, 'Kinnaur'),
(191, 14, 'Kullu'),
(192, 14, 'Lahaul and Spiti'),
(193, 14, 'Mandi'),
(194, 14, 'Shimla'),
(195, 14, 'Sirmaur'),
(196, 14, 'Solan'),
(197, 14, 'Una'),
(198, 15, 'Anantnag'),
(199, 15, 'Badgam'),
(200, 15, 'Bandipora'),
(201, 15, 'Baramulla'),
(202, 15, 'Doda'),
(203, 15, 'Ganderbal'),
(204, 15, 'Jammu'),
(205, 15, 'Kargil'),
(206, 15, 'Kathua'),
(207, 15, 'Kishtwar'),
(208, 15, 'Kupwara'),
(209, 15, 'Kulgam'),
(210, 15, 'Leh'),
(211, 15, 'Poonch'),
(212, 15, 'Pulwama'),
(213, 15, 'Rajouri'),
(214, 15, 'Ramban'),
(215, 15, 'Reasi'),
(216, 15, 'Samba'),
(217, 15, 'Shopian'),
(218, 15, 'Srinagar'),
(219, 15, 'Udhampur'),
(220, 16, 'Bokaro'),
(221, 16, 'Chatra'),
(222, 16, 'Deoghar'),
(223, 16, 'Dhanbad'),
(224, 16, 'Dumka'),
(225, 16, 'East Singhbhum'),
(226, 16, 'Garhwa'),
(227, 16, 'Giridih'),
(228, 16, 'Godda'),
(229, 16, 'Gumla'),
(230, 16, 'Hazaribag'),
(231, 16, 'Jamtara'),
(232, 16, 'Khunti'),
(233, 16, 'Koderma'),
(234, 16, 'Latehar'),
(235, 16, 'Lohardaga'),
(236, 16, 'Pakur'),
(237, 16, 'Palamu'),
(238, 16, 'Ramgarh'),
(239, 16, 'Ranchi'),
(240, 16, 'Sahibganj'),
(241, 16, 'Seraikela Kharsawan'),
(242, 16, 'Simdega'),
(243, 16, 'West Singhbhum'),
(244, 17, 'Bagalkot'),
(245, 17, 'Bangalore Rural'),
(246, 17, 'Bangalore Urban'),
(247, 17, 'Belgaum'),
(248, 17, 'Bellary'),
(249, 17, 'Bidar'),
(250, 17, 'Bijapur'),
(251, 17, 'Chamarajnagar'),
(252, 17, 'Chikkamagaluru'),
(253, 17, 'Chikkaballapur'),
(254, 17, 'Chitradurga'),
(255, 17, 'Davanagere'),
(256, 17, 'Dharwad'),
(257, 17, 'Dakshina Kannada'),
(258, 17, 'Gadag'),
(259, 17, 'Gulbarga'),
(260, 17, 'Hassan'),
(261, 17, 'Haveri district'),
(262, 17, 'Kodagu'),
(263, 17, 'Kolar'),
(264, 17, 'Koppal'),
(265, 17, 'Mandya'),
(266, 17, 'Mysore'),
(267, 17, 'Raichur'),
(268, 17, 'Shimoga'),
(269, 17, 'Tumkur'),
(270, 17, 'Udupi'),
(271, 17, 'Uttara Kannada'),
(272, 17, 'Ramanagara'),
(273, 17, 'Yadgir'),
(274, 18, 'Alappuzha'),
(275, 18, 'Ernakulam'),
(276, 18, 'Idukki'),
(277, 18, 'Kannur'),
(278, 18, 'Kasaragod'),
(279, 18, 'Kollam'),
(280, 18, 'Kottayam'),
(281, 18, 'Kozhikode'),
(282, 18, 'Malappuram'),
(283, 18, 'Palakkad'),
(284, 18, 'Pathanamthitta'),
(285, 18, 'Thrissur'),
(286, 18, 'Thiruvananthapuram'),
(287, 18, 'Wayanad'),
(288, 19, 'Lakshadweep'),
(289, 20, 'Agar'),
(290, 20, 'Alirajpur'),
(291, 20, 'Anuppur'),
(292, 20, 'Ashok Nagar'),
(293, 20, 'Balaghat'),
(294, 20, 'Barwani'),
(295, 20, 'Betul'),
(296, 20, 'Bhind'),
(297, 20, 'Bhopal'),
(298, 20, 'Burhanpur'),
(299, 20, 'Chhatarpur'),
(300, 20, 'Chhindwara'),
(301, 20, 'Damoh'),
(302, 20, 'Datia'),
(303, 20, 'Dewas'),
(304, 20, 'Dhar'),
(305, 20, 'Dindori'),
(306, 20, 'Guna'),
(307, 20, 'Gwalior'),
(308, 20, 'Harda'),
(309, 20, 'Hoshangabad'),
(310, 20, 'Indore'),
(311, 20, 'Jabalpur'),
(312, 20, 'Jhabua'),
(313, 20, 'Katni'),
(314, 20, 'Khandwa (East Nimar)'),
(315, 20, 'Khargone (West Nimar)'),
(316, 20, 'Mandla'),
(317, 20, 'Mandsaur'),
(318, 20, 'Morena'),
(319, 20, 'Narsinghpur'),
(320, 20, 'Neemuch'),
(321, 20, 'Panna'),
(322, 20, 'Raisen'),
(323, 20, 'Rajgarh'),
(324, 20, 'Ratlam'),
(325, 20, 'Rewa'),
(326, 20, 'Sagar'),
(327, 20, 'Satna'),
(328, 20, 'Sehore'),
(329, 20, 'Seoni'),
(330, 20, 'Shahdol'),
(331, 20, 'Shajapur'),
(332, 20, 'Sheopur'),
(333, 20, 'Shivpuri'),
(334, 20, 'Sidhi'),
(335, 20, 'Singrauli'),
(336, 20, 'Tikamgarh'),
(337, 20, 'Ujjain'),
(338, 20, 'Umaria'),
(339, 20, 'Vidisha'),
(340, 21, 'Ahmednagar'),
(341, 21, 'Akola'),
(342, 21, 'Amravati'),
(343, 21, 'Aurangabad'),
(344, 21, 'Beed'),
(345, 21, 'Bhandara'),
(346, 21, 'Buldhana'),
(347, 21, 'Chandrapur'),
(348, 21, 'Dhule'),
(349, 21, 'Gadchiroli'),
(350, 21, 'Gondia'),
(351, 21, 'Hingoli'),
(352, 21, 'Jalgaon'),
(353, 21, 'Jalna'),
(354, 21, 'Kolhapur'),
(355, 21, 'Latur'),
(356, 21, 'Mumbai City'),
(357, 21, 'Mumbai suburban'),
(358, 21, 'Nanded'),
(359, 21, 'Nandurbar'),
(360, 21, 'Nagpur'),
(361, 21, 'Nashik'),
(362, 21, 'Osmanabad'),
(363, 21, 'Parbhani'),
(364, 21, 'Pune'),
(365, 21, 'Raigad'),
(366, 21, 'Ratnagiri'),
(367, 21, 'Sangli'),
(368, 21, 'Satara'),
(369, 21, 'Sindhudurg'),
(370, 21, 'Solapur'),
(371, 21, 'Thane'),
(372, 21, 'Wardha'),
(373, 21, 'Washim'),
(374, 21, 'Yavatmal'),
(375, 22, 'Bishnupur'),
(376, 22, 'Churachandpur'),
(377, 22, 'Chandel'),
(378, 22, 'Imphal East'),
(379, 22, 'Senapati'),
(380, 22, 'Tamenglong'),
(381, 22, 'Thoubal'),
(382, 22, 'Ukhrul'),
(383, 22, 'Imphal West'),
(384, 23, 'East Garo Hills'),
(385, 23, 'East Khasi Hills'),
(386, 23, 'Jaintia Hills'),
(387, 23, 'Ri Bhoi'),
(388, 23, 'South Garo Hills'),
(389, 23, 'West Garo Hills'),
(390, 23, 'West Khasi Hills'),
(391, 24, 'Aizawl'),
(392, 24, 'Champhai'),
(393, 24, 'Kolasib'),
(394, 24, 'Lawngtlai'),
(395, 24, 'Lunglei'),
(396, 24, 'Mamit'),
(397, 24, 'Saiha'),
(398, 24, 'Serchhip'),
(399, 25, 'Dimapur'),
(400, 25, 'Kiphire'),
(401, 25, 'Kohima'),
(402, 25, 'Longleng'),
(403, 25, 'Mokokchung'),
(404, 25, 'Mon'),
(405, 25, 'Peren'),
(406, 25, 'Phek'),
(407, 25, 'Tuensang'),
(408, 25, 'Wokha'),
(409, 25, 'Zunheboto'),
(410, 26, 'Angul'),
(411, 26, 'Boudh (Bauda)'),
(412, 26, 'Bhadrak'),
(413, 26, 'Balangir'),
(414, 26, 'Bargarh (Baragarh)'),
(415, 26, 'Balasore'),
(416, 26, 'Cuttack'),
(417, 26, 'Debagarh (Deogarh)'),
(418, 26, 'Dhenkanal'),
(419, 26, 'Ganjam'),
(420, 26, 'Gajapati'),
(421, 26, 'Jharsuguda'),
(422, 26, 'Jajpur'),
(423, 26, 'Jagatsinghpur'),
(424, 26, 'Khordha'),
(425, 26, 'Kendujhar (Keonjhar)'),
(426, 26, 'Kalahandi'),
(427, 26, 'Kandhamal'),
(428, 26, 'Koraput'),
(429, 26, 'Kendrapara'),
(430, 26, 'Malkangiri'),
(431, 26, 'Mayurbhanj'),
(432, 26, 'Nabarangpur'),
(433, 26, 'Nuapada'),
(434, 26, 'Nayagarh'),
(435, 26, 'Puri'),
(436, 26, 'Rayagada'),
(437, 26, 'Sambalpur'),
(438, 26, 'Subarnapur (Sonepur)'),
(439, 26, 'Sundergarh'),
(440, 27, 'Karaikal'),
(441, 27, 'Mahe'),
(442, 27, 'Pondicherry'),
(443, 27, 'Yanam'),
(444, 28, 'Amritsar'),
(445, 28, 'Barnala'),
(446, 28, 'Bathinda'),
(447, 28, 'Firozpur'),
(448, 28, 'Faridkot'),
(449, 28, 'Fatehgarh Sahib'),
(450, 28, 'Fazilka[6]'),
(451, 28, 'Gurdaspur'),
(452, 28, 'Hoshiarpur'),
(453, 28, 'Jalandhar'),
(454, 28, 'Kapurthala'),
(455, 28, 'Ludhiana'),
(456, 28, 'Mansa'),
(457, 28, 'Moga'),
(458, 28, 'Sri Muktsar Sahib'),
(459, 28, 'Pathankot'),
(460, 28, 'Patiala'),
(461, 28, 'Rupnagar'),
(462, 28, 'Ajitgarh (Mohali)'),
(463, 28, 'Sangrur'),
(464, 28, 'Shahid Bhagat Singh Nagar'),
(465, 28, 'Tarn Taran'),
(466, 29, 'Ajmer'),
(467, 29, 'Alwar'),
(468, 29, 'Bikaner'),
(469, 29, 'Barmer'),
(470, 29, 'Banswara'),
(471, 29, 'Bharatpur'),
(472, 29, 'Baran'),
(473, 29, 'Bundi'),
(474, 29, 'Bhilwara'),
(475, 29, 'Churu'),
(476, 29, 'Chittorgarh'),
(477, 29, 'Dausa'),
(478, 29, 'Dholpur'),
(479, 29, 'Dungapur'),
(480, 29, 'Ganganagar'),
(481, 29, 'Hanumangarh'),
(482, 29, 'Jhunjhunu'),
(483, 29, 'Jalore'),
(484, 29, 'Jodhpur'),
(485, 29, 'Jaipur'),
(486, 29, 'Jaisalmer'),
(487, 29, 'Jhalawar'),
(488, 29, 'Karauli'),
(489, 29, 'Kota'),
(490, 29, 'Nagaur'),
(491, 29, 'Pali'),
(492, 29, 'Pratapgarh'),
(493, 29, 'Rajsamand'),
(494, 29, 'Sikar'),
(495, 29, 'Sawai Madhopur'),
(496, 29, 'Sirohi'),
(497, 29, 'Tonk'),
(498, 29, 'Udaipur'),
(499, 30, 'East Sikkim'),
(500, 30, 'North Sikkim'),
(501, 30, 'South Sikkim'),
(502, 30, 'West Sikkim'),
(503, 31, 'Ariyalur'),
(504, 31, 'Chennai'),
(505, 31, 'Coimbatore'),
(506, 31, 'Cuddalore'),
(507, 31, 'Dharmapuri'),
(508, 31, 'Dindigul'),
(509, 31, 'Erode'),
(510, 31, 'Kanchipuram'),
(511, 31, 'Kanyakumari'),
(512, 31, 'Karur'),
(513, 31, 'Krishnagiri'),
(514, 31, 'Madurai'),
(515, 31, 'Nagapattinam'),
(516, 31, 'Nilgiris'),
(517, 31, 'Namakkal'),
(518, 31, 'Perambalur'),
(519, 31, 'Pudukkottai'),
(520, 31, 'Ramanathapuram'),
(521, 31, 'Salem'),
(522, 31, 'Sivaganga'),
(523, 31, 'Tirupur'),
(524, 31, 'Tiruchirappalli'),
(525, 31, 'Theni'),
(526, 31, 'Tirunelveli'),
(527, 31, 'Thanjavur'),
(528, 31, 'Thoothukudi'),
(529, 31, 'Tiruvallur'),
(530, 31, 'Tiruvarur'),
(531, 31, 'Tiruvannamalai'),
(532, 31, 'Vellore'),
(533, 31, 'Viluppuram'),
(534, 31, 'Virudhunagar'),
(535, 32, 'Dhalai'),
(536, 32, 'North Tripura'),
(537, 32, 'South Tripura'),
(538, 32, 'Khowai[7]'),
(539, 32, 'West Tripura'),
(540, 33, 'Agra'),
(541, 33, 'Aligarh'),
(542, 33, 'Allahabad'),
(543, 33, 'Ambedkar Nagar'),
(544, 33, 'Auraiya'),
(545, 33, 'Azamgarh'),
(546, 33, 'Bagpat'),
(547, 33, 'Bahraich'),
(548, 33, 'Ballia'),
(549, 33, 'Balrampur'),
(550, 33, 'Banda'),
(551, 33, 'Barabanki'),
(552, 33, 'Bareilly'),
(553, 33, 'Basti'),
(554, 33, 'Bijnor'),
(555, 33, 'Budaun'),
(556, 33, 'Bulandshahr'),
(557, 33, 'Chandauli'),
(558, 33, 'Chhatrapati Shahuji Maharaj Nagar[8]'),
(559, 33, 'Chitrakoot'),
(560, 33, 'Deoria'),
(561, 33, 'Etah'),
(562, 33, 'Etawah'),
(563, 33, 'Faizabad'),
(564, 33, 'Farrukhabad'),
(565, 33, 'Fatehpur'),
(566, 33, 'Firozabad'),
(567, 33, 'Gautam Buddh Nagar'),
(568, 33, 'Ghaziabad'),
(569, 33, 'Ghazipur'),
(570, 33, 'Gonda'),
(571, 33, 'Gorakhpur'),
(572, 33, 'Hamirpur'),
(573, 33, 'Hardoi'),
(574, 33, 'Hathras'),
(575, 33, 'Jalaun'),
(576, 33, 'Jaunpur district'),
(577, 33, 'Jhansi'),
(578, 33, 'Jyotiba Phule Nagar'),
(579, 33, 'Kannauj'),
(580, 33, 'Kanpur'),
(581, 33, 'Kanshi Ram Nagar'),
(582, 33, 'Kaushambi'),
(583, 33, 'Kushinagar'),
(584, 33, 'Lakhimpur Kheri'),
(585, 33, 'Lalitpur'),
(586, 33, 'Lucknow'),
(587, 33, 'Maharajganj'),
(588, 33, 'Mahoba'),
(589, 33, 'Mainpuri'),
(590, 33, 'Mathura'),
(591, 33, 'Mau'),
(592, 33, 'Meerut'),
(593, 33, 'Mirzapur'),
(594, 33, 'Moradabad'),
(595, 33, 'Muzaffarnagar'),
(596, 33, 'Panchsheel Nagar district (Hapur)'),
(597, 33, 'Pilibhit'),
(598, 33, 'Pratapgarh'),
(599, 33, 'Raebareli'),
(600, 33, 'Ramabai Nagar (Kanpur Dehat)'),
(601, 33, 'Rampur'),
(602, 33, 'Saharanpur'),
(603, 33, 'Sant Kabir Nagar'),
(604, 33, 'Sant Ravidas Nagar'),
(605, 33, 'Shahjahanpur'),
(606, 33, 'Shamli[9]'),
(607, 33, 'Shravasti'),
(608, 33, 'Siddharthnagar'),
(609, 33, 'Sitapur'),
(610, 33, 'Sonbhadra'),
(611, 33, 'Sultanpur'),
(612, 33, 'Unnao'),
(613, 33, 'Varanasi'),
(614, 34, 'Almora'),
(615, 34, 'Bageshwar'),
(616, 34, 'Chamoli'),
(617, 34, 'Champawat'),
(618, 34, 'Dehradun'),
(619, 34, 'Haridwar'),
(620, 34, 'Nainital'),
(621, 34, 'Pauri Garhwal'),
(622, 34, 'Pithoragarh'),
(623, 34, 'Rudraprayag'),
(624, 34, 'Tehri Garhwal'),
(625, 34, 'Udham Singh Nagar'),
(626, 34, 'Uttarkashi'),
(627, 35, 'Bankura'),
(628, 35, 'Bardhaman'),
(629, 35, 'Birbhum'),
(630, 35, 'Cooch Behar'),
(631, 35, 'Dakshin Dinajpur'),
(632, 35, 'Darjeeling'),
(633, 35, 'Hooghly'),
(634, 35, 'Howrah'),
(635, 35, 'Jalpaiguri'),
(636, 35, 'Kolkata'),
(637, 35, 'Maldah'),
(638, 35, 'Murshidabad'),
(639, 35, 'Nadia'),
(640, 35, 'North 24 Parganas'),
(641, 35, 'Paschim Medinipur'),
(642, 35, 'Purba Medinipur'),
(643, 35, 'Purulia'),
(644, 35, 'South 24 Parganas'),
(645, 35, 'Uttar Dinajpur');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` int(10) UNSIGNED NOT NULL,
  `reference_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expense_category_id` int(11) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expense_categories`
--

CREATE TABLE `expense_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `general_settings`
--

CREATE TABLE `general_settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `site_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `site_logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `staff_access` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_format` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `theme` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `currency_position` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `general_settings`
--

INSERT INTO `general_settings` (`id`, `site_title`, `site_logo`, `currency`, `staff_access`, `date_format`, `theme`, `created_at`, `updated_at`, `currency_position`) VALUES
(1, 'Sun Shine POS', 'Sun shine solution 21.png', 'AUD', 'own', 'd/m/Y', 'default.css', '2018-07-06 06:13:11', '2020-08-13 17:10:11', 'prefix');

-- --------------------------------------------------------

--
-- Table structure for table `gift_cards`
--

CREATE TABLE `gift_cards` (
  `id` int(10) UNSIGNED NOT NULL,
  `card_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double NOT NULL,
  `expense` double NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `expired_date` date DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gift_cards`
--

INSERT INTO `gift_cards` (`id`, `card_no`, `amount`, `expense`, `customer_id`, `user_id`, `expired_date`, `created_by`, `is_active`, `created_at`, `updated_at`) VALUES
(1, '2709542133789104', 4000, 0, 4, NULL, '2021-01-04', 22, 1, '2021-01-04 15:55:18', '2021-01-04 15:55:18');

-- --------------------------------------------------------

--
-- Table structure for table `gift_card_recharges`
--

CREATE TABLE `gift_card_recharges` (
  `id` int(10) UNSIGNED NOT NULL,
  `gift_card_id` int(11) NOT NULL,
  `amount` double NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `holidays`
--

CREATE TABLE `holidays` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_approved` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hrm_settings`
--

CREATE TABLE `hrm_settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `checkin` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `checkout` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hrm_settings`
--

INSERT INTO `hrm_settings` (`id`, `checkin`, `checkout`, `created_at`, `updated_at`) VALUES
(1, '10:00am', '6:00pm', '2019-01-02 02:20:08', '2019-01-02 04:20:53');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `code`, `created_at`, `updated_at`) VALUES
(1, 'en', '2018-07-07 22:59:17', '2019-12-24 17:34:20');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_02_17_060412_create_categories_table', 1),
(4, '2018_02_20_035727_create_brands_table', 1),
(5, '2018_02_25_100635_create_suppliers_table', 1),
(6, '2018_02_27_101619_create_warehouse_table', 1),
(7, '2018_03_03_040448_create_units_table', 1),
(8, '2018_03_04_041317_create_taxes_table', 1),
(9, '2018_03_10_061915_create_customer_groups_table', 1),
(10, '2018_03_10_090534_create_customers_table', 1),
(11, '2018_03_11_095547_create_billers_table', 1),
(12, '2018_04_05_054401_create_products_table', 1),
(13, '2018_04_06_133606_create_purchases_table', 1),
(14, '2018_04_06_154600_create_product_purchases_table', 1),
(15, '2018_04_06_154915_create_product_warhouse_table', 1),
(16, '2018_04_10_085927_create_sales_table', 1),
(17, '2018_04_10_090133_create_product_sales_table', 1),
(18, '2018_04_10_090254_create_payments_table', 1),
(19, '2018_04_10_090341_create_payment_with_cheque_table', 1),
(20, '2018_04_10_090509_create_payment_with_credit_card_table', 1),
(21, '2018_04_13_121436_create_quotation_table', 1),
(22, '2018_04_13_122324_create_product_quotation_table', 1),
(23, '2018_04_14_121802_create_transfers_table', 1),
(24, '2018_04_14_121913_create_product_transfer_table', 1),
(25, '2018_05_13_082847_add_payment_id_and_change_sale_id_to_payments_table', 2),
(26, '2018_05_13_090906_change_customer_id_to_payment_with_credit_card_table', 3),
(27, '2018_05_20_054532_create_adjustments_table', 4),
(28, '2018_05_20_054859_create_product_adjustments_table', 4),
(29, '2018_05_21_163419_create_returns_table', 5),
(30, '2018_05_21_163443_create_product_returns_table', 5),
(31, '2018_06_02_050905_create_roles_table', 6),
(32, '2018_06_02_073430_add_columns_to_users_table', 7),
(33, '2018_06_03_053738_create_permission_tables', 8),
(36, '2018_06_21_063736_create_pos_setting_table', 9),
(37, '2018_06_21_094155_add_user_id_to_sales_table', 10),
(38, '2018_06_21_101529_add_user_id_to_purchases_table', 11),
(39, '2018_06_21_103512_add_user_id_to_transfers_table', 12),
(40, '2018_06_23_061058_add_user_id_to_quotations_table', 13),
(41, '2018_06_23_082427_add_is_deleted_to_users_table', 14),
(42, '2018_06_25_043308_change_email_to_users_table', 15),
(43, '2018_07_06_115449_create_general_settings_table', 16),
(44, '2018_07_08_043944_create_languages_table', 17),
(45, '2018_07_11_102144_add_user_id_to_returns_table', 18),
(46, '2018_07_11_102334_add_user_id_to_payments_table', 18),
(47, '2018_07_22_130541_add_digital_to_products_table', 19),
(49, '2018_07_24_154250_create_deliveries_table', 20),
(50, '2018_08_16_053336_create_expense_categories_table', 21),
(51, '2018_08_17_115415_create_expenses_table', 22),
(55, '2018_08_18_050418_create_gift_cards_table', 23),
(56, '2018_08_19_063119_create_payment_with_gift_card_table', 24),
(57, '2018_08_25_042333_create_gift_card_recharges_table', 25),
(58, '2018_08_25_101354_add_deposit_expense_to_customers_table', 26),
(59, '2018_08_26_043801_create_deposits_table', 27),
(60, '2018_09_02_044042_add_keybord_active_to_pos_setting_table', 28),
(61, '2018_09_09_092713_create_payment_with_paypal_table', 29),
(62, '2018_09_10_051254_add_currency_to_general_settings_table', 30),
(63, '2018_10_22_084118_add_biller_and_store_id_to_users_table', 31),
(65, '2018_10_26_034927_create_coupons_table', 32),
(66, '2018_10_27_090857_add_coupon_to_sales_table', 33),
(67, '2018_11_07_070155_add_currency_position_to_general_settings_table', 34),
(68, '2018_11_19_094650_add_combo_to_products_table', 35),
(69, '2018_12_09_043712_create_accounts_table', 36),
(70, '2018_12_17_112253_add_is_default_to_accounts_table', 37),
(71, '2018_12_19_103941_add_account_id_to_payments_table', 38),
(72, '2018_12_20_065900_add_account_id_to_expenses_table', 39),
(73, '2018_12_20_082753_add_account_id_to_returns_table', 40),
(74, '2018_12_26_064330_create_return_purchases_table', 41),
(75, '2018_12_26_144210_create_purchase_product_return_table', 42),
(76, '2018_12_26_144708_create_purchase_product_return_table', 43),
(77, '2018_12_27_110018_create_departments_table', 44),
(78, '2018_12_30_054844_create_employees_table', 45),
(79, '2018_12_31_125210_create_payrolls_table', 46),
(80, '2018_12_31_150446_add_department_id_to_employees_table', 47),
(81, '2019_01_01_062708_add_user_id_to_expenses_table', 48),
(82, '2019_01_02_075644_create_hrm_settings_table', 49),
(83, '2019_01_02_090334_create_attendances_table', 50),
(84, '2019_01_27_160956_add_three_columns_to_general_settings_table', 51),
(85, '2019_02_15_183303_create_stock_counts_table', 52),
(86, '2019_02_17_101604_add_is_adjusted_to_stock_counts_table', 53),
(87, '2019_04_13_101707_add_tax_no_to_customers_table', 54),
(89, '2019_10_14_111455_create_holidays_table', 55),
(90, '2019_11_13_145619_add_is_variant_to_products_table', 56),
(91, '2019_11_13_150206_create_product_variants_table', 57),
(92, '2019_11_13_153828_create_variants_table', 57),
(93, '2019_11_25_134041_add_qty_to_product_variants_table', 58),
(94, '2019_11_25_134922_add_variant_id_to_product_purchases_table', 58),
(95, '2019_11_25_145341_add_variant_id_to_product_warehouse_table', 58),
(96, '2019_11_29_182201_add_variant_id_to_product_sales_table', 59),
(97, '2019_12_04_121311_add_variant_id_to_product_quotation_table', 60),
(98, '2019_12_05_123802_add_variant_id_to_product_transfer_table', 61),
(100, '2019_12_08_114954_add_variant_id_to_product_returns_table', 62),
(101, '2019_12_08_203146_add_variant_id_to_purchase_product_return_table', 63),
(102, '2020_02_28_103340_create_money_transfers_table', 64);

-- --------------------------------------------------------

--
-- Table structure for table `money_transfers`
--

CREATE TABLE `money_transfers` (
  `id` int(10) UNSIGNED NOT NULL,
  `reference_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_account_id` int(11) NOT NULL,
  `to_account_id` int(11) NOT NULL,
  `amount` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('rafiqaust@gmail.com', '$2y$10$JIVxPcdhIqSKYYTBk9QdIOsD.iD7nLttXG6WZ/TzUY90HNkz4ATYG', '2020-07-26 05:58:54');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(10) UNSIGNED NOT NULL,
  `payment_reference` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `purchase_id` int(11) DEFAULT NULL,
  `sale_id` int(11) DEFAULT NULL,
  `account_id` int(11) NOT NULL,
  `amount` double NOT NULL,
  `by_cash` double DEFAULT NULL,
  `by_card` double DEFAULT NULL,
  `change` double NOT NULL,
  `paying_method` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `payment_reference`, `user_id`, `purchase_id`, `sale_id`, `account_id`, `amount`, `by_cash`, `by_card`, `change`, `paying_method`, `payment_note`, `created_at`, `updated_at`) VALUES
(1, 'spr-20200726-064249', 1, NULL, 1, 1, 49.5, NULL, NULL, 0.5, 'Cash', NULL, '2020-07-26 13:12:49', '2020-07-26 13:12:49'),
(2, 'spr-20200726-064402', 1, NULL, 2, 1, 29.7, NULL, NULL, 22.3, 'Credit Card', NULL, '2020-07-26 13:14:02', '2020-07-26 13:14:02'),
(3, 'spr-20200726-064408', 1, NULL, 3, 1, 29.7, NULL, NULL, 20.3, 'Cash', NULL, '2020-07-26 13:14:08', '2020-07-26 13:14:08'),
(4, 'spr-20200726-064633', 1, NULL, 4, 1, 29.7, NULL, NULL, 20.3, 'Cash', NULL, '2020-07-26 13:16:33', '2020-07-26 13:16:33'),
(5, 'spr-20200726-064907', 1, NULL, 5, 1, 29.7, NULL, NULL, 0.3000000000000007, 'Cash', NULL, '2020-07-26 13:19:07', '2020-07-26 13:19:07'),
(6, 'spr-20200726-065132', 1, NULL, 6, 1, 29.7, NULL, NULL, 20.3, 'Cash', NULL, '2020-07-26 13:21:32', '2020-07-26 13:21:32'),
(7, 'spr-20200726-065246', 1, NULL, 7, 1, 59.4, NULL, NULL, 0, 'Credit Card', NULL, '2020-07-26 13:22:46', '2020-07-26 13:22:46'),
(9, 'spr-20200726-071834', 1, NULL, 13, 1, 29.7, NULL, NULL, 0.3000000000000007, 'Credit Card', NULL, '2020-07-26 13:48:34', '2020-07-26 13:48:34'),
(10, 'spr-20200726-072154', 1, NULL, 14, 1, 19.8, NULL, NULL, 0.1999999999999993, 'Cash', NULL, '2020-07-26 13:51:54', '2020-07-26 13:51:54'),
(11, 'spr-20200728-104830', 1, NULL, 16, 3, 29.7, 10, 19.7, 0, 'Mix Payment', NULL, '2020-07-28 17:18:30', '2020-07-28 17:18:30'),
(13, 'spr-20200728-105056', 1, NULL, 18, 3, 29.7, 0, 0, 0, 'Credit Card', NULL, '2020-07-28 17:20:56', '2020-07-28 17:20:56'),
(14, 'spr-20200729-084524', 1, NULL, 19, 3, 148.5, 28.5, 120, 0, 'Mix Payment', NULL, '2020-07-29 03:15:24', '2020-07-29 03:15:24'),
(16, 'spr-20200729-084833', 1, NULL, 21, 3, 29.7, 40, 0, 10.3, 'Mix Payment', NULL, '2020-07-29 03:18:33', '2020-07-29 03:18:33'),
(18, 'spr-20200729-085104', 1, NULL, 23, 3, 29.7, 0, 0, 0, 'Credit Card', NULL, '2020-07-29 03:21:04', '2020-07-29 03:21:04'),
(20, 'spr-20200729-063010', 32, NULL, 27, 3, 29.7, 0, 0, 0.3000000000000007, 'Cash', NULL, '2020-07-29 13:00:10', '2020-07-29 13:00:10'),
(21, 'spr-20200802-105440', 21, NULL, 28, 3, 29.7, NULL, NULL, 0, 'Credit Card', NULL, '2020-08-02 17:24:40', '2020-08-02 17:24:40'),
(22, 'spr-20200802-105547', 32, NULL, 29, 3, 59.4, 100, NULL, 40.6, 'Cash', NULL, '2020-08-02 17:25:47', '2020-08-02 17:25:47'),
(23, 'spr-20200802-110149', 21, NULL, 30, 3, 29.7, 20, 9.7, 0, 'Mix Payment', NULL, '2020-08-02 17:31:49', '2020-08-02 17:31:49'),
(24, 'spr-20200802-111334', 32, NULL, 32, 3, 71.77, 50, 21.77, 0, 'Mix Payment', NULL, '2020-08-02 17:43:34', '2020-08-02 17:43:34'),
(25, 'spr-20200802-111455', 21, NULL, 33, 3, 69.45, 20, 49.45, 0, 'Mix Payment', NULL, '2020-08-02 17:44:55', '2020-08-02 17:44:55'),
(26, 'spr-20200804-100742', 32, NULL, 35, 3, 7229.7, NULL, NULL, 0, 'Credit Card', NULL, '2020-08-04 16:37:42', '2020-08-04 16:37:42'),
(27, 'spr-20200804-100955', 21, NULL, 36, 3, 29.7, 50, NULL, 20.3, 'Cash', NULL, '2020-08-04 16:39:55', '2020-08-04 16:39:55'),
(29, 'spr-20200804-104926', 32, NULL, 38, 3, 49.5, 50, NULL, 0.5, 'Cash', NULL, '2020-08-04 17:19:26', '2020-08-04 17:19:26'),
(30, 'spr-20200805-111934', 21, NULL, 39, 3, 29.7, 20, 9.7, 0, 'Mix Payment', NULL, '2020-08-05 05:49:34', '2020-08-05 05:49:34'),
(31, 'spr-20200805-112041', 32, NULL, 41, 3, 59.4, NULL, NULL, 0, 'Credit Card', NULL, '2020-08-05 05:50:41', '2020-08-05 05:50:41'),
(32, 'spr-20200805-112922', 1, NULL, 43, 3, 89.1, NULL, NULL, 0, 'Credit Card', NULL, '2020-08-05 05:59:22', '2020-08-05 05:59:22'),
(33, 'spr-20200805-113207', 1, NULL, 44, 3, 59.4, 28.5, 30.9, 0, 'Mix Payment', NULL, '2020-08-05 06:02:07', '2020-08-05 06:02:07'),
(34, 'spr-20200805-113322', 1, NULL, 45, 3, 19.8, 15, 5, 0.1999999999999993, 'Mix Payment', NULL, '2020-08-05 06:03:22', '2020-08-05 06:03:22'),
(35, 'spr-20200805-100229', 1, NULL, 48, 3, 59.4, 60, NULL, 0.6000000000000014, 'Cash', NULL, '2020-08-05 16:32:29', '2020-08-05 16:32:29'),
(36, 'spr-20200805-100334', 1, NULL, 49, 3, 29.7, 10, 19.7, 0, 'Mix Payment', NULL, '2020-08-05 16:33:34', '2020-08-05 16:33:34'),
(37, 'spr-20200805-101139', 1, NULL, 51, 3, 29.7, 50, NULL, 20.3, 'Cash', NULL, '2020-08-05 16:41:39', '2020-08-05 16:41:39'),
(38, 'spr-20200806-091537', 1, NULL, 53, 3, 29.7, NULL, NULL, 0, 'Cash', NULL, '2020-08-06 15:45:37', '2020-08-06 15:45:37'),
(39, 'spr-20200806-091915', 1, NULL, 54, 3, 29.7, NULL, NULL, -29.7, 'Mix Payment', NULL, '2020-08-06 15:49:15', '2020-08-06 15:49:15'),
(40, 'spr-20200806-092052', 1, NULL, 55, 3, 29.7, 20, 9.7, 0, 'Mix Payment', NULL, '2020-08-06 15:50:52', '2020-08-06 15:50:52'),
(41, 'spr-20200806-101806', 1, NULL, 56, 3, 61.35, NULL, NULL, 0, 'Credit Card', NULL, '2020-08-06 16:48:06', '2020-08-06 16:48:06'),
(42, 'spr-20200806-102007', 1, NULL, 57, 3, 29.7, 50, NULL, 20.3, 'Cash', NULL, '2020-08-06 16:50:07', '2020-08-06 16:50:07'),
(43, 'spr-20200806-102108', 1, NULL, 58, 3, 30, 50, NULL, 20, 'Cash', NULL, '2020-08-06 16:51:08', '2020-08-06 16:51:08'),
(44, 'spr-20200806-102511', 1, NULL, 59, 3, 30, 20, 10, 0, 'Mix Payment', NULL, '2020-08-06 16:55:11', '2020-08-06 16:55:11'),
(45, 'spr-20200807-112901', 1, NULL, 60, 1, 34.65, NULL, NULL, 0, 'Credit Card', NULL, '2020-08-07 05:59:01', '2020-08-07 05:59:01'),
(46, 'spr-20200808-022035', 1, NULL, 61, 1, 13.2, NULL, NULL, 0, 'Credit Card', NULL, '2020-08-07 20:50:35', '2020-08-07 20:50:35'),
(47, 'spr-20200808-022215', 1, NULL, 62, 1, 13.2, 10, 3.2, 0, 'Mix Payment', NULL, '2020-08-07 20:52:15', '2020-08-07 20:52:15'),
(48, 'spr-20200808-022504', 1, NULL, 63, 1, 13.2, NULL, NULL, 0, 'Credit Card', NULL, '2020-08-07 20:55:04', '2020-08-07 20:55:04'),
(49, 'spr-20200808-022703', 1, NULL, 64, 1, 13.2, NULL, NULL, 0, 'Credit Card', NULL, '2020-08-07 20:57:03', '2020-08-07 20:57:03'),
(50, 'spr-20200808-022729', 1, NULL, 65, 1, 13.2, NULL, NULL, 0, 'Credit Card', NULL, '2020-08-07 20:57:29', '2020-08-07 20:57:29'),
(51, 'spr-20200808-025200', 1, NULL, 66, 1, 13.2, 20, NULL, 6.800000000000001, 'Cash', NULL, '2020-08-07 21:22:00', '2020-08-07 21:22:00'),
(52, 'spr-20200808-025609', 1, NULL, 67, 1, 3.3, NULL, NULL, 0, 'Credit Card', NULL, '2020-08-07 21:26:09', '2020-08-07 21:26:09'),
(53, 'spr-20200808-025822', 1, NULL, 68, 1, 3.63, NULL, NULL, 0, 'Credit Card', NULL, '2020-08-07 21:28:22', '2020-08-07 21:28:22'),
(54, 'spr-20200808-111417', 1, NULL, 71, 1, 6, NULL, NULL, 0, 'Credit Card', NULL, '2020-08-08 05:44:17', '2020-08-08 05:44:17'),
(55, 'spr-20200808-111848', 1, NULL, 72, 1, 3, 10, NULL, 7, 'Cash', NULL, '2020-08-08 05:48:48', '2020-08-08 05:48:48'),
(56, 'spr-20200808-045527', 1, NULL, 73, 1, 3, 10, NULL, 7, 'Cash', NULL, '2020-08-08 11:25:27', '2020-08-08 11:25:27'),
(57, 'spr-20200808-092209', 1, NULL, 74, 1, 3, NULL, NULL, 17, 'Cash', NULL, '2020-08-08 15:52:09', '2020-08-08 15:52:09'),
(58, 'spr-20200808-092723', 1, NULL, 75, 1, 3, NULL, NULL, 0, 'Credit Card', NULL, '2020-08-08 15:57:23', '2020-08-08 15:57:23'),
(59, 'spr-20200808-093106', 1, NULL, 76, 1, 3, 50, NULL, 47, 'Cash', NULL, '2020-08-08 16:01:06', '2020-08-08 16:01:06'),
(60, 'spr-20200808-093328', 1, NULL, 77, 1, 6, NULL, NULL, 0, 'Credit Card', NULL, '2020-08-08 16:03:28', '2020-08-08 16:03:28'),
(61, 'spr-20200808-093428', 1, NULL, 78, 1, 3, 10, NULL, 7, 'Cash', NULL, '2020-08-08 16:04:28', '2020-08-08 16:04:28'),
(62, 'spr-20200808-093529', 1, NULL, 79, 1, 3, 5, NULL, 2, 'Cash', NULL, '2020-08-08 16:05:29', '2020-08-08 16:05:29'),
(63, 'spr-20200808-094532', 1, NULL, 80, 1, 15, NULL, NULL, 35, 'Cash', NULL, '2020-08-08 16:15:32', '2020-08-08 16:15:32'),
(64, 'spr-20200808-095024', 1, NULL, 81, 1, 16, 20, NULL, 4, 'Cash', NULL, '2020-08-08 16:20:24', '2020-08-08 16:20:24'),
(65, 'spr-20200808-103408', 1, NULL, 82, 1, 3, NULL, NULL, 0, 'Credit Card', NULL, '2020-08-08 17:04:08', '2020-08-08 17:04:08'),
(66, 'spr-20200808-104820', 1, NULL, 83, 1, 3, 5, NULL, 2, 'Cash', NULL, '2020-08-08 17:18:20', '2020-08-08 17:18:20'),
(67, 'spr-20200809-032419', 1, NULL, 84, 1, 7, NULL, NULL, 0, 'Credit Card', NULL, '2020-08-09 09:54:19', '2020-08-09 09:54:19'),
(68, 'spr-20200809-040420', 1, NULL, 85, 1, 10, 35, NULL, 25, 'Cash', NULL, '2020-08-09 10:34:20', '2020-08-09 10:34:20'),
(69, 'spr-20200809-040421', 1, NULL, 86, 1, 10, 35, NULL, 25, 'Cash', NULL, '2020-08-09 10:34:21', '2020-08-09 10:34:21'),
(70, 'spr-20200809-055640', 1, NULL, 87, 1, 3, NULL, NULL, 0, 'Paypal', NULL, '2020-08-09 12:26:40', '2020-08-09 12:26:40'),
(71, 'spr-20200809-060257', 1, NULL, 88, 1, 2, NULL, NULL, 0, 'Gift Card', NULL, '2020-08-09 12:32:57', '2020-08-09 12:32:57'),
(72, 'spr-20200813-012307', 1, NULL, 89, 1, 3, NULL, NULL, 0, 'Cash', NULL, '2020-08-13 07:53:07', '2020-08-13 07:53:07'),
(73, 'spr-20200815-091633', 1, NULL, 90, 1, 6, NULL, NULL, 0, 'Credit Card', NULL, '2020-08-15 15:46:33', '2020-08-15 15:46:33'),
(74, 'spr-20201208-075102', 1, NULL, 91, 1, 2, NULL, NULL, 0, 'Credit Card', NULL, '2020-12-08 19:51:02', '2020-12-08 19:51:02'),
(75, 'spr-20210108-020657', 1, NULL, 92, 1, 6, NULL, NULL, 0, 'Paypal', NULL, '2021-01-08 02:06:57', '2021-01-08 02:06:57'),
(76, 'spr-20210108-021928', 1, NULL, 93, 1, 9, NULL, NULL, 0, 'Paypal', NULL, '2021-01-08 02:19:28', '2021-01-08 02:19:28'),
(77, 'spr-20210108-033249', 1, NULL, 94, 1, 3, NULL, NULL, 0, 'Paypal', NULL, '2021-01-08 03:32:49', '2021-01-08 03:32:49'),
(78, 'spr-20210108-065452', 1, NULL, 95, 1, 3, NULL, NULL, 0, 'Paypal', NULL, '2021-01-08 06:54:52', '2021-01-08 06:54:52'),
(79, 'spr-20210109-085902', 1, NULL, 96, 1, 3, NULL, NULL, 0, 'Credit Card', NULL, '2021-01-09 20:59:02', '2021-01-09 20:59:02'),
(80, 'spr-20210109-090025', 1, NULL, 97, 1, 3, NULL, NULL, 0, 'Credit Card', NULL, '2021-01-09 21:00:25', '2021-01-09 21:00:25'),
(81, 'spr-20210110-091021', 1, NULL, 98, 1, 3, NULL, NULL, 0, 'Credit Card', NULL, '2021-01-10 09:10:21', '2021-01-10 09:10:21'),
(82, 'spr-20210123-014521', 22, NULL, 99, 1, 120, NULL, NULL, 0, 'Credit Card', NULL, '2021-01-23 01:45:21', '2021-01-23 01:45:21'),
(83, 'spr-20210124-102159', 22, NULL, 100, 1, 104, NULL, NULL, 0, 'Credit Card', NULL, '2021-01-24 22:21:59', '2021-01-24 22:21:59'),
(84, 'spr-20210129-061942', 32, NULL, 101, 1, 208, NULL, NULL, 0, 'Credit Card', NULL, '2021-01-29 06:19:42', '2021-01-29 06:19:42'),
(85, 'spr-20210129-072200', 32, NULL, 102, 1, 312, NULL, NULL, 0, 'Credit Card', NULL, '2021-01-29 07:22:00', '2021-01-29 07:22:00'),
(86, 'spr-20210129-072224', 32, NULL, 103, 1, 104, NULL, NULL, 0, 'Credit Card', NULL, '2021-01-29 07:22:24', '2021-01-29 07:22:24'),
(87, 'spr-20210129-072242', 32, NULL, 104, 1, 312, NULL, NULL, 0, 'Credit Card', NULL, '2021-01-29 07:22:42', '2021-01-29 07:22:42'),
(88, 'spr-20210129-072336', 21, NULL, 105, 1, 2, NULL, NULL, 0, 'Credit Card', NULL, '2021-01-29 07:23:36', '2021-01-29 07:23:36'),
(89, 'spr-20210129-072356', 21, NULL, 106, 1, 312, NULL, NULL, 0, 'Credit Card', NULL, '2021-01-29 07:23:56', '2021-01-29 07:23:56');

-- --------------------------------------------------------

--
-- Table structure for table `payment_with_cheque`
--

CREATE TABLE `payment_with_cheque` (
  `id` int(10) UNSIGNED NOT NULL,
  `payment_id` int(11) NOT NULL,
  `cheque_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_with_credit_card`
--

CREATE TABLE `payment_with_credit_card` (
  `id` int(10) UNSIGNED NOT NULL,
  `payment_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `customer_stripe_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `charge_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_with_gift_card`
--

CREATE TABLE `payment_with_gift_card` (
  `id` int(10) UNSIGNED NOT NULL,
  `payment_id` int(11) NOT NULL,
  `gift_card_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_with_paypal`
--

CREATE TABLE `payment_with_paypal` (
  `id` int(10) UNSIGNED NOT NULL,
  `payment_id` int(11) NOT NULL,
  `transaction_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_with_subscripe`
--

CREATE TABLE `payment_with_subscripe` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(10) NOT NULL,
  `payment_reference` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `transaction_id` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `payment_status` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `payment_date` datetime NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `payment_with_subscripe`
--

INSERT INTO `payment_with_subscripe` (`id`, `user_id`, `payment_reference`, `transaction_id`, `payment_status`, `payment_date`, `created_at`, `updated_at`) VALUES
(1, 35, '1', '8LJ15259C1946983T', 'Completed', '2021-01-11 09:54:15', '2021-01-11', '2021-01-11');

-- --------------------------------------------------------

--
-- Table structure for table `payrolls`
--

CREATE TABLE `payrolls` (
  `id` int(10) UNSIGNED NOT NULL,
  `reference_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `employee_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` double NOT NULL,
  `paying_method` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(4, 'products-edit', 'web', '2018-06-03 01:00:09', '2018-06-03 01:00:09'),
(5, 'products-delete', 'web', '2018-06-03 22:54:22', '2018-06-03 22:54:22'),
(6, 'products-add', 'web', '2018-06-04 00:34:14', '2018-06-04 00:34:14'),
(7, 'products-index', 'web', '2018-06-04 03:34:27', '2018-06-04 03:34:27'),
(8, 'purchases-index', 'web', '2018-06-04 08:03:19', '2018-06-04 08:03:19'),
(9, 'purchases-add', 'web', '2018-06-04 08:12:25', '2018-06-04 08:12:25'),
(10, 'purchases-edit', 'web', '2018-06-04 09:47:36', '2018-06-04 09:47:36'),
(11, 'purchases-delete', 'web', '2018-06-04 09:47:36', '2018-06-04 09:47:36'),
(12, 'sales-index', 'web', '2018-06-04 10:49:08', '2018-06-04 10:49:08'),
(13, 'sales-add', 'web', '2018-06-04 10:49:52', '2018-06-04 10:49:52'),
(14, 'sales-edit', 'web', '2018-06-04 10:49:52', '2018-06-04 10:49:52'),
(15, 'sales-delete', 'web', '2018-06-04 10:49:53', '2018-06-04 10:49:53'),
(16, 'quotes-index', 'web', '2018-06-04 22:05:10', '2018-06-04 22:05:10'),
(17, 'quotes-add', 'web', '2018-06-04 22:05:10', '2018-06-04 22:05:10'),
(18, 'quotes-edit', 'web', '2018-06-04 22:05:10', '2018-06-04 22:05:10'),
(19, 'quotes-delete', 'web', '2018-06-04 22:05:10', '2018-06-04 22:05:10'),
(20, 'transfers-index', 'web', '2018-06-04 22:30:03', '2018-06-04 22:30:03'),
(21, 'transfers-add', 'web', '2018-06-04 22:30:03', '2018-06-04 22:30:03'),
(22, 'transfers-edit', 'web', '2018-06-04 22:30:03', '2018-06-04 22:30:03'),
(23, 'transfers-delete', 'web', '2018-06-04 22:30:03', '2018-06-04 22:30:03'),
(24, 'returns-index', 'web', '2018-06-04 22:50:24', '2018-06-04 22:50:24'),
(25, 'returns-add', 'web', '2018-06-04 22:50:24', '2018-06-04 22:50:24'),
(26, 'returns-edit', 'web', '2018-06-04 22:50:25', '2018-06-04 22:50:25'),
(27, 'returns-delete', 'web', '2018-06-04 22:50:25', '2018-06-04 22:50:25'),
(28, 'customers-index', 'web', '2018-06-04 23:15:54', '2018-06-04 23:15:54'),
(29, 'customers-add', 'web', '2018-06-04 23:15:55', '2018-06-04 23:15:55'),
(30, 'customers-edit', 'web', '2018-06-04 23:15:55', '2018-06-04 23:15:55'),
(31, 'customers-delete', 'web', '2018-06-04 23:15:55', '2018-06-04 23:15:55'),
(32, 'suppliers-index', 'web', '2018-06-04 23:40:12', '2018-06-04 23:40:12'),
(33, 'suppliers-add', 'web', '2018-06-04 23:40:12', '2018-06-04 23:40:12'),
(34, 'suppliers-edit', 'web', '2018-06-04 23:40:12', '2018-06-04 23:40:12'),
(35, 'suppliers-delete', 'web', '2018-06-04 23:40:12', '2018-06-04 23:40:12'),
(36, 'product-report', 'web', '2018-06-24 23:05:33', '2018-06-24 23:05:33'),
(37, 'purchase-report', 'web', '2018-06-24 23:24:56', '2018-06-24 23:24:56'),
(38, 'sale-report', 'web', '2018-06-24 23:33:13', '2018-06-24 23:33:13'),
(39, 'customer-report', 'web', '2018-06-24 23:36:51', '2018-06-24 23:36:51'),
(40, 'due-report', 'web', '2018-06-24 23:39:52', '2018-06-24 23:39:52'),
(41, 'users-index', 'web', '2018-06-25 00:00:10', '2018-06-25 00:00:10'),
(42, 'users-add', 'web', '2018-06-25 00:00:10', '2018-06-25 00:00:10'),
(43, 'users-edit', 'web', '2018-06-25 00:01:30', '2018-06-25 00:01:30'),
(44, 'users-delete', 'web', '2018-06-25 00:01:30', '2018-06-25 00:01:30'),
(45, 'profit-loss', 'web', '2018-07-14 21:50:05', '2018-07-14 21:50:05'),
(46, 'best-seller', 'web', '2018-07-14 22:01:38', '2018-07-14 22:01:38'),
(47, 'daily-sale', 'web', '2018-07-14 22:24:21', '2018-07-14 22:24:21'),
(48, 'monthly-sale', 'web', '2018-07-14 22:30:41', '2018-07-14 22:30:41'),
(49, 'daily-purchase', 'web', '2018-07-14 22:36:46', '2018-07-14 22:36:46'),
(50, 'monthly-purchase', 'web', '2018-07-14 22:48:17', '2018-07-14 22:48:17'),
(51, 'payment-report', 'web', '2018-07-14 23:10:41', '2018-07-14 23:10:41'),
(52, 'warehouse-stock-report', 'web', '2018-07-14 23:16:55', '2018-07-14 23:16:55'),
(53, 'product-qty-alert', 'web', '2018-07-14 23:33:21', '2018-07-14 23:33:21'),
(54, 'supplier-report', 'web', '2018-07-30 03:00:01', '2018-07-30 03:00:01'),
(55, 'expenses-index', 'web', '2018-09-05 01:07:10', '2018-09-05 01:07:10'),
(56, 'expenses-add', 'web', '2018-09-05 01:07:10', '2018-09-05 01:07:10'),
(57, 'expenses-edit', 'web', '2018-09-05 01:07:10', '2018-09-05 01:07:10'),
(58, 'expenses-delete', 'web', '2018-09-05 01:07:11', '2018-09-05 01:07:11'),
(59, 'general_setting', 'web', '2018-10-19 23:10:04', '2018-10-19 23:10:04'),
(60, 'mail_setting', 'web', '2018-10-19 23:10:04', '2018-10-19 23:10:04'),
(61, 'pos_setting', 'web', '2018-10-19 23:10:04', '2018-10-19 23:10:04'),
(62, 'hrm_setting', 'web', '2019-01-02 10:30:23', '2019-01-02 10:30:23'),
(63, 'purchase-return-index', 'web', '2019-01-02 21:45:14', '2019-01-02 21:45:14'),
(64, 'purchase-return-add', 'web', '2019-01-02 21:45:14', '2019-01-02 21:45:14'),
(65, 'purchase-return-edit', 'web', '2019-01-02 21:45:14', '2019-01-02 21:45:14'),
(66, 'purchase-return-delete', 'web', '2019-01-02 21:45:14', '2019-01-02 21:45:14'),
(67, 'account-index', 'web', '2019-01-02 22:06:13', '2019-01-02 22:06:13'),
(68, 'balance-sheet', 'web', '2019-01-02 22:06:14', '2019-01-02 22:06:14'),
(69, 'account-statement', 'web', '2019-01-02 22:06:14', '2019-01-02 22:06:14'),
(70, 'department', 'web', '2019-01-02 22:30:01', '2019-01-02 22:30:01'),
(71, 'attendance', 'web', '2019-01-02 22:30:01', '2019-01-02 22:30:01'),
(72, 'payroll', 'web', '2019-01-02 22:30:01', '2019-01-02 22:30:01'),
(73, 'employees-index', 'web', '2019-01-02 22:52:19', '2019-01-02 22:52:19'),
(74, 'employees-add', 'web', '2019-01-02 22:52:19', '2019-01-02 22:52:19'),
(75, 'employees-edit', 'web', '2019-01-02 22:52:19', '2019-01-02 22:52:19'),
(76, 'employees-delete', 'web', '2019-01-02 22:52:19', '2019-01-02 22:52:19'),
(77, 'user-report', 'web', '2019-01-16 06:48:18', '2019-01-16 06:48:18'),
(78, 'stock_count', 'web', '2019-02-17 10:32:01', '2019-02-17 10:32:01'),
(79, 'adjustment', 'web', '2019-02-17 10:32:02', '2019-02-17 10:32:02'),
(80, 'sms_setting', 'web', '2019-02-22 05:18:03', '2019-02-22 05:18:03'),
(81, 'create_sms', 'web', '2019-02-22 05:18:03', '2019-02-22 05:18:03'),
(82, 'print_barcode', 'web', '2019-03-07 05:02:19', '2019-03-07 05:02:19'),
(83, 'empty_database', 'web', '2019-03-07 05:02:19', '2019-03-07 05:02:19'),
(84, 'customer_group', 'web', '2019-03-07 05:37:15', '2019-03-07 05:37:15'),
(85, 'unit', 'web', '2019-03-07 05:37:15', '2019-03-07 05:37:15'),
(86, 'tax', 'web', '2019-03-07 05:37:15', '2019-03-07 05:37:15'),
(87, 'gift_card', 'web', '2019-03-07 06:29:38', '2019-03-07 06:29:38'),
(88, 'coupon', 'web', '2019-03-07 06:29:38', '2019-03-07 06:29:38'),
(89, 'holiday', 'web', '2019-10-19 08:57:15', '2019-10-19 08:57:15'),
(90, 'warehouse-report', 'web', '2019-10-22 06:00:23', '2019-10-22 06:00:23'),
(91, 'warehouse', 'web', '2020-02-26 06:47:32', '2020-02-26 06:47:32'),
(92, 'brand', 'web', '2020-02-26 06:59:59', '2020-02-26 06:59:59'),
(93, 'billers-index', 'web', '2020-02-26 07:11:15', '2020-02-26 07:11:15'),
(94, 'billers-add', 'web', '2020-02-26 07:11:15', '2020-02-26 07:11:15'),
(95, 'billers-edit', 'web', '2020-02-26 07:11:15', '2020-02-26 07:11:15'),
(96, 'billers-delete', 'web', '2020-02-26 07:11:15', '2020-02-26 07:11:15'),
(97, 'money-transfer', 'web', '2020-03-02 05:41:48', '2020-03-02 05:41:48'),
(98, 'quick-sales-index', 'web', '2018-06-04 10:49:08', '2018-06-04 10:49:08'),
(99, 'quick-sales-add', 'web', '2018-06-04 10:49:52', '2018-06-04 10:49:52'),
(100, 'quick-sales-delete', 'web', '2018-06-04 10:49:53', '2018-06-04 10:49:53'),
(101, 'seller-index', 'web', '2020-02-26 07:11:15', '2020-02-26 07:11:15'),
(102, 'seller-add', 'web', '2020-02-26 07:11:15', '2020-02-26 07:11:15'),
(103, 'seller-edit', 'web', '2020-02-26 07:11:15', '2020-02-26 07:11:15'),
(104, 'seller-delete', 'web', '2020-02-26 07:11:15', '2020-02-26 07:11:15'),
(105, 'manageSubscription-index', 'web', '2020-12-30 15:20:37', '2020-12-30 15:20:37'),
(106, 'manageSubscription-add', 'web', '2020-12-30 15:20:38', '2020-12-30 15:20:38'),
(107, 'manageSubscription-edit', 'web', '2020-12-30 15:20:38', '2020-12-30 15:20:38'),
(108, 'manageSubscription-delete', 'web', '2020-12-30 15:20:38', '2020-12-30 15:20:38'),
(109, 'manageCommission-index', 'web', '2020-12-30 15:20:37', '2020-12-30 15:20:37'),
(110, 'manageCommission-add', 'web', '2020-12-30 15:20:38', '2020-12-30 15:20:38'),
(111, 'manageCommission-edit', 'web', '2020-12-30 15:20:38', '2020-12-30 15:20:38'),
(112, 'manageCommission-delete', 'web', '2020-12-30 15:20:38', '2020-12-30 15:20:38'),
(113, 'mySubscription-index', 'web', '2020-12-30 15:20:37', '2020-12-30 15:20:37'),
(114, 'mySubscription-add', 'web', '2020-12-30 15:20:38', '2020-12-30 15:20:38'),
(115, 'manageCommission-edit', 'web', '2020-12-30 15:20:38', '2020-12-30 15:20:38'),
(116, 'mySubscription-delete', 'web', '2020-12-30 15:20:38', '2020-12-30 15:20:38'),
(117, 'mySubscription-edit', 'web', '2021-01-01 19:00:24', '2021-01-01 19:00:24'),
(118, 'seller-transaction', 'web', '2021-01-11 01:00:47', '2021-01-11 01:00:47');

-- --------------------------------------------------------

--
-- Table structure for table `pos_setting`
--

CREATE TABLE `pos_setting` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `biller_id` int(11) NOT NULL,
  `product_number` int(11) NOT NULL,
  `keybord_active` tinyint(1) NOT NULL,
  `stripe_public_key` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stripe_secret_key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pos_setting`
--

INSERT INTO `pos_setting` (`id`, `customer_id`, `warehouse_id`, `biller_id`, `product_number`, `keybord_active`, `stripe_public_key`, `stripe_secret_key`, `created_at`, `updated_at`) VALUES
(1, 4, 2, 2, 4, 1, 'pk_test_ITN7KOYiIsHSCQ0UMRcgaYUB', 'sk_test_TtQQaawhEYRwa3mU9CzttrEy', '2018-09-02 03:17:04', '2020-08-08 16:13:10');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `seller_id` bigint(20) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `barcode_symbology` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `purchase_unit_id` int(11) NOT NULL,
  `sale_unit_id` int(11) NOT NULL,
  `cost` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` double DEFAULT NULL,
  `alert_quantity` double DEFAULT NULL,
  `promotion` tinyint(4) DEFAULT NULL,
  `promotion_price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `starting_date` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_date` date DEFAULT NULL,
  `tax_id` int(11) DEFAULT NULL,
  `tax_method` int(11) DEFAULT NULL,
  `image` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_variant` tinyint(1) DEFAULT NULL,
  `featured` tinyint(4) DEFAULT NULL,
  `product_list` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qty_list` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price_list` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `seller_id`, `name`, `code`, `type`, `barcode_symbology`, `brand_id`, `category_id`, `unit_id`, `purchase_unit_id`, `sale_unit_id`, `cost`, `price`, `qty`, `alert_quantity`, `promotion`, `promotion_price`, `starting_date`, `last_date`, `tax_id`, `tax_method`, `image`, `file`, `is_variant`, `featured`, `product_list`, `qty_list`, `price_list`, `product_details`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, 'Ispahani Tea 500gm', '1234567', 'standard', 'C128', NULL, 2, 1, 1, 1, '10', '12', -13, NULL, NULL, NULL, NULL, NULL, 1, 1, '1595744964354Ispahani-Mirzapore-Best-Leaf-400gm.png', NULL, NULL, NULL, NULL, NULL, NULL, '<p>Syllet Tea</p>', 0, '2020-07-26 11:00:00', '2020-08-08 05:05:22'),
(2, 1, 'Lipton Tea 500gm', '30042671', 'standard', 'C128', NULL, 2, 1, 1, 1, '15', '18', -42, NULL, NULL, NULL, NULL, NULL, 1, 1, 'zummXD2dvAtI.png', NULL, NULL, 1, NULL, NULL, NULL, '<p>Product from India</p>', 0, '2020-07-26 13:04:03', '2020-08-08 05:05:13'),
(3, 1, 'Chiken', '71430283', 'standard', 'C128', NULL, 1, 7, 7, 7, '5', '7', -5.5, 5, NULL, NULL, NULL, NULL, 1, 1, 'zummXD2dvAtI.png', NULL, NULL, NULL, NULL, NULL, NULL, '', 0, '2020-07-26 14:21:44', '2020-08-08 05:05:03'),
(4, 1, 'Shan Chicken Spices', '40251846', 'standard', 'C128', NULL, 2, 1, 1, 1, '2.50', '3.00', -4, 5, NULL, NULL, NULL, NULL, 1, 1, 'zummXD2dvAtI.png', NULL, NULL, NULL, NULL, NULL, NULL, '', 0, '2020-07-27 02:51:03', '2020-08-08 05:04:53'),
(5, 1, 'Drychoclate', '02918631', 'standard', 'C128', NULL, 2, 1, 3, 1, '10', '12', 0, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'zummXD2dvAtI.png', NULL, NULL, 0, NULL, NULL, NULL, '', 0, '2020-07-27 12:05:06', '2020-08-08 05:01:20'),
(6, 1, 'lemon p', '100', 'standard', 'C128', NULL, 2, 1, 1, 1, '9', '10', -1, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'zummXD2dvAtI.png', NULL, NULL, 0, NULL, NULL, NULL, '', 0, '2020-07-27 12:17:39', '2020-08-08 05:04:43'),
(7, 1, 'lemon B', '200', 'standard', 'C128', NULL, 2, 1, 1, 1, '10', '20', 0, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'zummXD2dvAtI.png', NULL, NULL, NULL, NULL, NULL, NULL, '', 0, '2020-07-27 12:18:46', '2020-08-08 05:04:33'),
(8, 1, 'pizza', 'familiar', 'standard', 'C128', NULL, 2, 1, 1, 1, '140', '183', 0, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'zummXD2dvAtI.png', NULL, 1, 1, NULL, NULL, NULL, '', 0, '2020-07-31 20:45:21', '2020-08-08 05:02:19'),
(9, 1, 'unknown Product', '93184592', 'standard', 'C128', NULL, 3, 1, 1, 3, '100', '200', 0, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'zummXD2dvAtI.png', NULL, NULL, NULL, NULL, NULL, NULL, '', 0, '2020-08-04 16:21:11', '2020-08-08 05:04:25'),
(10, 1, 'Parle Biscuits', '99344059', 'standard', 'C128', NULL, 2, 1, 1, 1, '10', '20', -3, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'zummXD2dvAtI.png', NULL, NULL, NULL, NULL, NULL, NULL, '', 0, '2020-08-06 16:21:39', '2020-08-08 05:04:05'),
(11, 1, 'Test Product', '51902196', 'standard', 'C128', NULL, 3, 1, 1, 1, '10', '15', 0, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'zummXD2dvAtI.png', NULL, NULL, 0, NULL, NULL, NULL, '', 0, '2020-08-06 23:29:13', '2020-08-08 05:02:39'),
(12, 1, 'Novi', '79683719', 'standard', 'C128', NULL, 2, 1, 1, 1, '10', '20', 0, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'zummXD2dvAtI.png', NULL, NULL, NULL, NULL, NULL, NULL, '', 0, '2020-08-07 05:21:47', '2020-08-08 05:03:48'),
(13, 1, 'Tandoori Masala', '788821030016', 'standard', 'C128', NULL, 2, 1, 1, 1, '1.50', '2.00', 189, 10, NULL, NULL, NULL, NULL, NULL, 2, '1596848640764Shan Tandoori Masala.jpg', NULL, NULL, 1, NULL, NULL, NULL, '<p>Tandoori Style Barbecue Chicken</p>', 1, '2020-08-08 05:35:39', '2021-01-29 07:23:36'),
(14, 2, 'Haleem Mix', '8941100511725', 'standard', 'C128', NULL, 2, 1, 1, 1, '2.50', '3.00', 59, 10, NULL, NULL, NULL, NULL, NULL, 2, '1596849076380Radhuni Haleem Mix.jpg', NULL, NULL, 0, NULL, NULL, NULL, '<p>Radhuni Haleem Mix</p>', 1, '2020-08-08 05:41:21', '2021-01-14 02:42:51'),
(15, 1, 'Fish', '2344324', 'standard', 'C128', NULL, 2, 7, 7, 7, '100', '150', 101, 5, NULL, NULL, NULL, NULL, NULL, 1, '1609660995785Quality.png', NULL, NULL, 1, NULL, NULL, NULL, '', 1, '2021-01-03 19:03:23', '2021-01-23 01:19:01'),
(16, 32, 'test', '58981220', 'standard', 'C128', NULL, 2, 1, 1, 1, '100', '104', 87, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'zummXD2dvAtI.png', NULL, NULL, 1, NULL, NULL, NULL, '', 1, '2021-01-19 21:27:02', '2021-01-29 07:23:56'),
(17, 32, 'Fish-2', '76525378', 'standard', 'C128', NULL, 2, 1, 1, 1, '100', '120', 0, 4, NULL, NULL, NULL, NULL, NULL, 1, '1611324786765product7.jpeg,1611941238968product20.jpeg', NULL, NULL, 0, NULL, NULL, NULL, '<p>Best quality product</p>', 1, '2021-01-23 01:13:25', '2021-01-29 22:57:22'),
(18, 32, 'Mutton Cabab', '11936200', 'standard', 'C128', NULL, 4, 1, 1, 1, '80', '100', 1, 4, NULL, NULL, NULL, NULL, NULL, 1, '1611325684233product14.jpeg', NULL, NULL, NULL, NULL, NULL, NULL, '<p>very good</p>', 1, '2021-01-23 01:28:16', '2021-01-23 01:29:28'),
(19, 32, 'Mutton Curry', '97231115', 'standard', 'C128', NULL, 4, 1, 1, 1, '13', '140', 0, 5, NULL, NULL, NULL, NULL, NULL, 1, '1611570953941product14.jpeg', NULL, NULL, NULL, NULL, NULL, NULL, '<p>Good</p>', 1, '2021-01-25 21:36:03', '2021-01-25 21:36:03');

-- --------------------------------------------------------

--
-- Table structure for table `product_adjustments`
--

CREATE TABLE `product_adjustments` (
  `id` int(10) UNSIGNED NOT NULL,
  `adjustment_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` double NOT NULL,
  `action` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_adjustments`
--

INSERT INTO `product_adjustments` (`id`, `adjustment_id`, `product_id`, `qty`, `action`, `created_at`, `updated_at`) VALUES
(1, 1, 13, 100, '+', '2021-01-11 02:41:55', '2021-01-11 02:41:55');

-- --------------------------------------------------------

--
-- Table structure for table `product_purchases`
--

CREATE TABLE `product_purchases` (
  `id` int(10) UNSIGNED NOT NULL,
  `purchase_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `variant_id` int(11) DEFAULT NULL,
  `qty` double NOT NULL,
  `recieved` double NOT NULL,
  `purchase_unit_id` int(11) NOT NULL,
  `net_unit_cost` double NOT NULL,
  `discount` double NOT NULL,
  `tax_rate` double NOT NULL,
  `tax` double NOT NULL,
  `total` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_purchases`
--

INSERT INTO `product_purchases` (`id`, `purchase_id`, `product_id`, `variant_id`, `qty`, `recieved`, `purchase_unit_id`, `net_unit_cost`, `discount`, `tax_rate`, `tax`, `total`, `created_at`, `updated_at`) VALUES
(13, 11, 14, NULL, 100, 100, 1, 2.5, 0, 0, 0, 250, '2020-08-08 05:42:21', '2020-08-08 05:42:21'),
(14, 12, 13, NULL, 100, 100, 1, 1.5, 0, 0, 0, 150, '2020-08-08 05:42:59', '2020-08-08 05:42:59'),
(15, 13, 17, NULL, 1, 1, 1, 100, 0, 0, 0, 100, '2021-01-23 01:19:01', '2021-01-23 01:19:01'),
(16, 13, 15, NULL, 1, 1, 7, 100, 0, 0, 0, 100, '2021-01-23 01:19:01', '2021-01-23 01:19:01'),
(17, 14, 18, NULL, 1, 1, 1, 80, 0, 0, 0, 80, '2021-01-23 01:29:28', '2021-01-23 01:29:28'),
(19, 15, 16, NULL, 100, 100, 1, 100, 0, 0, 0, 10000, '2021-01-24 22:21:25', '2021-01-24 22:21:25');

-- --------------------------------------------------------

--
-- Table structure for table `product_quotation`
--

CREATE TABLE `product_quotation` (
  `id` int(10) UNSIGNED NOT NULL,
  `quotation_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `variant_id` int(11) DEFAULT NULL,
  `qty` double NOT NULL,
  `sale_unit_id` int(11) NOT NULL,
  `net_unit_price` double NOT NULL,
  `discount` double NOT NULL,
  `tax_rate` double NOT NULL,
  `tax` double NOT NULL,
  `total` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_returns`
--

CREATE TABLE `product_returns` (
  `id` int(10) UNSIGNED NOT NULL,
  `return_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `variant_id` int(11) DEFAULT NULL,
  `qty` double NOT NULL,
  `sale_unit_id` int(11) NOT NULL,
  `net_unit_price` double NOT NULL,
  `discount` double NOT NULL,
  `tax_rate` double NOT NULL,
  `tax` double NOT NULL,
  `total` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_sales`
--

CREATE TABLE `product_sales` (
  `id` int(10) UNSIGNED NOT NULL,
  `sale_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `variant_id` int(11) DEFAULT NULL,
  `qty` double NOT NULL,
  `sale_unit_id` int(11) NOT NULL,
  `net_unit_price` double NOT NULL,
  `discount` double NOT NULL,
  `tax_rate` double NOT NULL,
  `tax` double NOT NULL,
  `total` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_sales`
--

INSERT INTO `product_sales` (`id`, `sale_id`, `product_id`, `variant_id`, `qty`, `sale_unit_id`, `net_unit_price`, `discount`, `tax_rate`, `tax`, `total`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, 1, 1, 18, 0, 10, 1.8, 19.8, '2020-07-26 13:12:49', '2020-07-26 13:12:49'),
(2, 1, 2, NULL, 1, 1, 27, 0, 10, 2.7, 29.7, '2020-07-26 13:12:49', '2020-07-26 13:12:49'),
(3, 2, 2, NULL, 1, 1, 27, 0, 10, 2.7, 29.7, '2020-07-26 13:14:02', '2020-07-26 13:14:02'),
(4, 3, 2, NULL, 1, 1, 27, 0, 10, 2.7, 29.7, '2020-07-26 13:14:08', '2020-07-26 13:14:08'),
(5, 4, 2, NULL, 1, 1, 27, 0, 10, 2.7, 29.7, '2020-07-26 13:16:33', '2020-07-26 13:16:33'),
(6, 5, 2, NULL, 1, 1, 27, 0, 10, 2.7, 29.7, '2020-07-26 13:19:07', '2020-07-26 13:19:07'),
(7, 6, 2, NULL, 1, 1, 27, 0, 10, 2.7, 29.7, '2020-07-26 13:21:32', '2020-07-26 13:21:32'),
(8, 7, 2, NULL, 2, 1, 27, 0, 10, 5.4, 59.4, '2020-07-26 13:22:46', '2020-07-26 13:22:46'),
(15, 14, 1, NULL, 1, 1, 18, 0, 10, 1.8, 19.8, '2020-07-26 13:51:54', '2020-07-26 13:51:54'),
(16, 15, 2, NULL, 1, 1, 27, 0, 10, 2.7, 29.7, '2020-07-26 14:14:35', '2020-07-26 14:14:35'),
(17, 16, 2, NULL, 1, 1, 27, 0, 10, 2.7, 29.7, '2020-07-28 17:18:30', '2020-07-28 17:18:30'),
(19, 18, 2, NULL, 1, 1, 27, 0, 10, 2.7, 29.7, '2020-07-28 17:20:56', '2020-07-28 17:20:56'),
(20, 19, 2, NULL, 5, 1, 27, 0, 10, 13.5, 148.5, '2020-07-29 03:15:24', '2020-07-29 03:15:24'),
(22, 21, 2, NULL, 1, 1, 27, 0, 10, 2.7, 29.7, '2020-07-29 03:18:33', '2020-07-29 03:18:33'),
(27, 26, 2, NULL, 1, 1, 27, 0, 10, 2.7, 29.7, '2020-07-29 12:47:41', '2020-07-29 12:47:41'),
(28, 27, 2, NULL, 1, 1, 27, 0, 10, 2.7, 29.7, '2020-07-29 13:00:10', '2020-07-29 13:00:10'),
(29, 28, 2, NULL, 1, 1, 27, 0, 10, 2.7, 29.7, '2020-08-02 17:24:40', '2020-08-02 17:24:40'),
(30, 29, 2, NULL, 2, 1, 27, 0, 10, 5.4, 59.4, '2020-08-02 17:25:47', '2020-08-02 17:25:47'),
(31, 30, 2, NULL, 1, 1, 27, 0, 10, 2.7, 29.7, '2020-08-02 17:31:49', '2020-08-02 17:31:49'),
(33, 32, 2, NULL, 1, 1, 27, 0, 10, 2.7, 29.7, '2020-08-02 17:43:33', '2020-08-02 17:43:33'),
(34, 32, 3, NULL, 1.5, 7, 10.5, 0, 10, 1.58, 17.32, '2020-08-02 17:43:33', '2020-08-02 17:43:33'),
(35, 32, 1, NULL, 1, 1, 18, 0, 10, 1.8, 19.8, '2020-08-02 17:43:34', '2020-08-02 17:43:34'),
(36, 32, 4, NULL, 1, 1, 4.5, 0, 10, 0.45, 4.95, '2020-08-02 17:43:34', '2020-08-02 17:43:34'),
(37, 33, 2, NULL, 1, 1, 27, 0, 10, 2.7, 29.7, '2020-08-02 17:44:55', '2020-08-02 17:44:55'),
(38, 33, 1, NULL, 1, 1, 18, 0, 10, 1.8, 19.8, '2020-08-02 17:44:55', '2020-08-02 17:44:55'),
(39, 33, 4, NULL, 1, 1, 4.5, 0, 10, 0.45, 4.95, '2020-08-02 17:44:55', '2020-08-02 17:44:55'),
(40, 33, 6, NULL, 1, 1, 15, 0, 0, 0, 15, '2020-08-02 17:44:55', '2020-08-02 17:44:55'),
(43, 36, 2, NULL, 1, 1, 27, 0, 10, 2.7, 29.7, '2020-08-04 16:39:55', '2020-08-04 16:39:55'),
(45, 38, 1, NULL, 1, 1, 18, 0, 10, 1.8, 19.8, '2020-08-04 17:19:26', '2020-08-04 17:19:26'),
(46, 38, 2, NULL, 1, 1, 27, 0, 10, 2.7, 29.7, '2020-08-04 17:19:26', '2020-08-04 17:19:26'),
(47, 39, 2, NULL, 1, 1, 27, 0, 10, 2.7, 29.7, '2020-08-05 05:49:34', '2020-08-05 05:49:34'),
(49, 41, 2, NULL, 2, 1, 27, 0, 10, 5.4, 59.4, '2020-08-05 05:50:41', '2020-08-05 05:50:41'),
(51, 43, 2, NULL, 3, 1, 27, 0, 10, 8.1, 89.1, '2020-08-05 05:59:22', '2020-08-05 05:59:22'),
(52, 44, 2, NULL, 2, 1, 27, 0, 10, 5.4, 59.4, '2020-08-05 06:02:07', '2020-08-05 06:02:07'),
(53, 45, 1, NULL, 1, 1, 18, 0, 10, 1.8, 19.8, '2020-08-05 06:03:22', '2020-08-05 12:41:00'),
(56, 48, 2, NULL, 2, 1, 27, 0, 10, 5.4, 59.4, '2020-08-05 16:32:29', '2020-08-05 16:32:29'),
(57, 49, 2, NULL, 1, 1, 27, 0, 10, 2.7, 29.7, '2020-08-05 16:33:34', '2020-08-05 16:33:34'),
(59, 51, 2, NULL, 1, 1, 27, 0, 10, 2.7, 29.7, '2020-08-05 16:41:39', '2020-08-05 16:41:39'),
(61, 53, 2, NULL, 1, 1, 27, 0, 10, 2.7, 29.7, '2020-08-06 15:45:37', '2020-08-06 15:45:37'),
(63, 55, 2, NULL, 1, 1, 27, 0, 10, 2.7, 29.7, '2020-08-06 15:50:52', '2020-08-06 15:50:52'),
(64, 56, 3, NULL, 1, 7, 10.5, 0, 10, 1.05, 11.55, '2020-08-06 16:48:06', '2020-08-06 16:48:06'),
(65, 56, 10, NULL, 1, 1, 30, 0, 0, 0, 30, '2020-08-06 16:48:06', '2020-08-06 16:48:06'),
(66, 56, 1, NULL, 1, 1, 18, 0, 10, 1.8, 19.8, '2020-08-06 16:48:06', '2020-08-06 16:48:06'),
(67, 57, 2, NULL, 1, 1, 27, 0, 10, 2.7, 29.7, '2020-08-06 16:50:07', '2020-08-06 16:50:07'),
(68, 58, 10, NULL, 1, 1, 30, 0, 0, 0, 30, '2020-08-06 16:51:08', '2020-08-06 16:51:08'),
(69, 59, 10, NULL, 1, 1, 30, 0, 0, 0, 30, '2020-08-06 16:55:11', '2020-08-06 16:55:11'),
(70, 60, 3, NULL, 3, 7, 10.5, 0, 10, 3.15, 34.65, '2020-08-07 05:59:01', '2020-08-07 05:59:01'),
(71, 61, 1, NULL, 1, 1, 12, 0, 10, 1.2, 13.2, '2020-08-07 20:50:35', '2020-08-07 20:50:35'),
(72, 62, 1, NULL, 1, 1, 12, 0, 10, 1.2, 13.2, '2020-08-07 20:52:15', '2020-08-07 20:52:15'),
(73, 63, 1, NULL, 1, 1, 12, 0, 10, 1.2, 13.2, '2020-08-07 20:55:04', '2020-08-07 20:55:04'),
(74, 64, 1, NULL, 1, 1, 12, 0, 10, 1.2, 13.2, '2020-08-07 20:57:03', '2020-08-07 20:57:03'),
(75, 65, 1, NULL, 1, 1, 12, 0, 10, 1.2, 13.2, '2020-08-07 20:57:29', '2020-08-07 20:57:29'),
(76, 66, 1, NULL, 1, 1, 12, 0, 10, 1.2, 13.2, '2020-08-07 21:22:00', '2020-08-07 21:22:00'),
(77, 67, 4, NULL, 1, 1, 3, 0, 10, 0.3, 3.3, '2020-08-07 21:26:09', '2020-08-07 21:26:09'),
(78, 68, 4, NULL, 1, 1, 3, 0, 10, 0.3, 3.3, '2020-08-07 21:28:22', '2020-08-07 21:28:22'),
(79, 69, 1, NULL, 1, 1, 12, 0, 10, 1.2, 13.2, '2020-08-07 21:37:18', '2020-08-07 21:37:18'),
(80, 70, 4, NULL, 1, 1, 3, 0, 10, 0.3, 3.3, '2020-08-07 21:37:43', '2020-08-07 21:37:43'),
(81, 71, 14, NULL, 2, 1, 3, 0, 0, 0, 6, '2020-08-08 05:44:17', '2020-08-08 05:44:17'),
(82, 72, 14, NULL, 1, 1, 3, 0, 0, 0, 3, '2020-08-08 05:48:48', '2020-08-08 05:48:48'),
(83, 73, 14, NULL, 1, 1, 3, 0, 0, 0, 3, '2020-08-08 11:25:27', '2020-08-08 11:25:27'),
(84, 74, 14, NULL, 1, 1, 3, 0, 0, 0, 3, '2020-08-08 15:52:09', '2020-08-08 15:52:09'),
(85, 75, 14, NULL, 1, 1, 3, 0, 0, 0, 3, '2020-08-08 15:57:23', '2020-08-08 15:57:23'),
(86, 76, 14, NULL, 1, 1, 3, 0, 0, 0, 3, '2020-08-08 16:01:06', '2020-08-08 16:01:06'),
(87, 77, 14, NULL, 2, 1, 3, 0, 0, 0, 6, '2020-08-08 16:03:28', '2020-08-08 16:03:28'),
(88, 78, 14, NULL, 1, 1, 3, 0, 0, 0, 3, '2020-08-08 16:04:28', '2020-08-08 16:04:28'),
(89, 79, 14, NULL, 1, 1, 3, 0, 0, 0, 3, '2020-08-08 16:05:29', '2020-08-08 16:05:29'),
(90, 80, 14, NULL, 5, 1, 3, 0, 0, 0, 15, '2020-08-08 16:15:32', '2020-08-08 16:15:32'),
(91, 81, 14, NULL, 4, 1, 3, 0, 0, 0, 12, '2020-08-08 16:20:24', '2020-08-08 16:20:24'),
(92, 81, 13, NULL, 2, 1, 2, 0, 0, 0, 4, '2020-08-08 16:20:24', '2020-08-08 16:20:24'),
(93, 82, 14, NULL, 1, 1, 3, 0, 0, 0, 3, '2020-08-08 17:04:08', '2020-08-08 17:04:08'),
(94, 83, 14, NULL, 1, 1, 3, 0, 0, 0, 3, '2020-08-08 17:18:20', '2020-08-08 17:18:20'),
(95, 84, 13, NULL, 2, 1, 2, 0, 0, 0, 4, '2020-08-09 09:54:19', '2020-08-09 09:54:19'),
(96, 84, 14, NULL, 1, 1, 3, 0, 0, 0, 3, '2020-08-09 09:54:19', '2020-08-09 09:54:19'),
(97, 85, 14, NULL, 2, 1, 3, 0, 0, 0, 6, '2020-08-09 10:34:20', '2020-08-09 10:34:20'),
(98, 85, 13, NULL, 2, 1, 2, 0, 0, 0, 4, '2020-08-09 10:34:20', '2020-08-09 10:34:20'),
(99, 86, 14, NULL, 2, 1, 3, 0, 0, 0, 6, '2020-08-09 10:34:20', '2020-08-09 10:34:20'),
(100, 86, 13, NULL, 2, 1, 2, 0, 0, 0, 4, '2020-08-09 10:34:21', '2020-08-09 10:34:21'),
(101, 87, 14, NULL, 1, 1, 3, 0, 0, 0, 3, '2020-08-09 12:26:40', '2020-08-09 12:26:40'),
(102, 88, 13, NULL, 1, 1, 2, 0, 0, 0, 2, '2020-08-09 12:32:57', '2020-08-09 12:32:57'),
(103, 89, 14, NULL, 1, 1, 3, 0, 0, 0, 3, '2020-08-13 07:53:07', '2020-08-13 07:53:07'),
(104, 90, 14, NULL, 2, 1, 3, 0, 0, 0, 6, '2020-08-15 15:46:33', '2020-08-15 15:46:33'),
(105, 91, 13, NULL, 1, 1, 2, 0, 0, 0, 2, '2020-12-08 19:51:02', '2020-12-08 19:51:02'),
(106, 92, 14, NULL, 2, 1, 3, 0, 0, 0, 6, '2021-01-08 02:06:57', '2021-01-08 02:06:57'),
(107, 93, 14, NULL, 3, 1, 3, 0, 0, 0, 9, '2021-01-08 02:19:28', '2021-01-08 02:19:28'),
(108, 94, 14, NULL, 1, 1, 3, 0, 0, 0, 3, '2021-01-08 03:32:49', '2021-01-08 03:32:49'),
(109, 95, 14, NULL, 1, 1, 3, 0, 0, 0, 3, '2021-01-08 06:54:52', '2021-01-08 06:54:52'),
(110, 96, 14, NULL, 1, 1, 3, 0, 0, 0, 3, '2021-01-09 20:59:02', '2021-01-09 20:59:02'),
(111, 97, 14, NULL, 1, 1, 3, 0, 0, 0, 3, '2021-01-09 21:00:25', '2021-01-09 21:00:25'),
(112, 98, 14, NULL, 1, 1, 3, 0, 0, 0, 3, '2021-01-10 09:10:21', '2021-01-10 09:10:21'),
(113, 99, 17, NULL, 1, 1, 120, 0, 0, 0, 120, '2021-01-23 01:45:21', '2021-01-23 01:45:21'),
(114, 100, 16, NULL, 1, 1, 104, 0, 0, 0, 104, '2021-01-24 22:21:59', '2021-01-24 22:21:59'),
(115, 101, 16, NULL, 2, 1, 104, 0, 0, 0, 208, '2021-01-29 06:19:42', '2021-01-29 06:19:42'),
(116, 102, 16, NULL, 3, 1, 104, 0, 0, 0, 312, '2021-01-29 07:22:00', '2021-01-29 07:22:00'),
(117, 103, 16, NULL, 1, 1, 104, 0, 0, 0, 104, '2021-01-29 07:22:24', '2021-01-29 07:22:24'),
(118, 104, 16, NULL, 3, 1, 104, 0, 0, 0, 312, '2021-01-29 07:22:42', '2021-01-29 07:22:42'),
(119, 105, 13, NULL, 1, 1, 2, 0, 0, 0, 2, '2021-01-29 07:23:36', '2021-01-29 07:23:36'),
(120, 106, 16, NULL, 3, 1, 104, 0, 0, 0, 312, '2021-01-29 07:23:56', '2021-01-29 07:23:56');

-- --------------------------------------------------------

--
-- Table structure for table `product_transfer`
--

CREATE TABLE `product_transfer` (
  `id` int(10) UNSIGNED NOT NULL,
  `transfer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `variant_id` int(11) DEFAULT NULL,
  `qty` double NOT NULL,
  `purchase_unit_id` int(11) NOT NULL,
  `net_unit_cost` double NOT NULL,
  `tax_rate` double NOT NULL,
  `tax` double NOT NULL,
  `total` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_variants`
--

CREATE TABLE `product_variants` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `variant_id` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  `item_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `additional_price` double DEFAULT NULL,
  `qty` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_variants`
--

INSERT INTO `product_variants` (`id`, `product_id`, `variant_id`, `position`, `item_code`, `additional_price`, `qty`, `created_at`, `updated_at`) VALUES
(1, 8, 1, 1, 'pepperoni-familiar', NULL, 0, '2020-07-31 20:45:21', '2020-07-31 20:45:21'),
(2, 8, 2, 2, 'jamon-familiar', NULL, 0, '2020-07-31 20:45:21', '2020-07-31 20:45:21'),
(3, 8, 3, 3, 'salami-familiar', NULL, 0, '2020-07-31 20:45:21', '2020-07-31 20:45:21'),
(4, 8, 4, 4, 'salchicha-familiar', NULL, 0, '2020-07-31 20:45:21', '2020-07-31 20:45:21'),
(5, 8, 5, 5, 'chorizo-familiar', NULL, 0, '2020-07-31 20:45:21', '2020-07-31 20:45:21');

-- --------------------------------------------------------

--
-- Table structure for table `product_warehouse`
--

CREATE TABLE `product_warehouse` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `variant_id` int(11) DEFAULT NULL,
  `warehouse_id` int(11) NOT NULL,
  `qty` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_warehouse`
--

INSERT INTO `product_warehouse` (`id`, `product_id`, `variant_id`, `warehouse_id`, `qty`, `created_at`, `updated_at`) VALUES
(1, '1', NULL, 1, -13, '2020-07-26 13:05:35', '2020-08-08 05:05:22'),
(2, '2', NULL, 1, -42, '2020-07-26 13:08:29', '2020-08-08 05:05:13'),
(3, '3', NULL, 1, -5.5, '2020-07-26 14:23:15', '2020-08-08 05:05:03'),
(4, '4', NULL, 1, -4, '2020-07-27 02:53:53', '2020-08-08 05:04:53'),
(5, '6', NULL, 1, -1, '2020-07-27 12:24:11', '2020-08-08 05:04:43'),
(6, '7', NULL, 1, 0, '2020-07-27 12:46:21', '2020-08-08 05:04:33'),
(7, '9', NULL, 1, 0, '2020-08-04 16:21:42', '2020-08-08 05:04:25'),
(8, '10', NULL, 1, -3, '2020-08-06 16:22:19', '2020-08-08 05:04:05'),
(9, '12', NULL, 1, 0, '2020-08-07 05:22:40', '2020-08-08 05:03:48'),
(10, '14', NULL, 2, 59, '2020-08-08 05:42:21', '2021-01-10 09:10:21'),
(11, '13', NULL, 2, 189, '2020-08-08 05:42:59', '2021-01-29 07:23:36'),
(12, '17', NULL, 2, 0, '2021-01-23 01:19:01', '2021-01-23 01:45:21'),
(13, '15', NULL, 2, 1, '2021-01-23 01:19:01', '2021-01-23 01:19:01'),
(14, '18', NULL, 2, 1, '2021-01-23 01:29:28', '2021-01-23 01:29:28'),
(15, '16', NULL, 2, 87, '2021-01-24 22:20:28', '2021-01-29 07:23:56');

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `id` int(10) UNSIGNED NOT NULL,
  `reference_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `item` int(11) NOT NULL,
  `total_qty` double NOT NULL,
  `total_discount` double NOT NULL,
  `total_tax` double NOT NULL,
  `total_cost` double NOT NULL,
  `order_tax_rate` double DEFAULT NULL,
  `order_tax` double DEFAULT NULL,
  `order_discount` double DEFAULT NULL,
  `shipping_cost` double DEFAULT NULL,
  `grand_total` double NOT NULL,
  `paid_amount` double NOT NULL,
  `status` int(11) NOT NULL,
  `payment_status` int(11) NOT NULL,
  `document` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`id`, `reference_no`, `user_id`, `warehouse_id`, `supplier_id`, `item`, `total_qty`, `total_discount`, `total_tax`, `total_cost`, `order_tax_rate`, `order_tax`, `order_discount`, `shipping_cost`, `grand_total`, `paid_amount`, `status`, `payment_status`, `document`, `note`, `created_at`, `updated_at`) VALUES
(11, 'pr-20200808-111221', 1, 2, NULL, 1, 100, 0, 0, 250, 0, 0, NULL, NULL, 250, 0, 1, 1, NULL, NULL, '2020-08-08 05:42:21', '2020-08-08 05:42:21'),
(12, 'pr-20200808-111259', 1, 2, NULL, 1, 100, 0, 0, 150, 0, 0, NULL, NULL, 150, 0, 1, 1, NULL, NULL, '2020-08-08 05:42:59', '2020-08-08 05:42:59'),
(13, 'pr-20210123-011901', 22, 2, 1, 2, 2, 0, 0, 200, 0, 0, 10, 40, 230, 0, 1, 1, 'pro1.jpg', 'Sold', '2021-01-23 01:19:01', '2021-01-23 01:19:01'),
(14, 'pr-20210123-012928', 32, 2, 1, 1, 1, 0, 0, 80, 0, 0, 5, 20, 95, 0, 1, 1, 'product1.jpeg', 'Sold', '2021-01-23 01:29:28', '2021-01-23 01:29:28'),
(15, 'pr-20210124-102028', 22, 2, 1, 1, 100, 0, 0, 10000, 0, 0, 0, 0, 10000, 0, 1, 1, NULL, NULL, '2021-01-24 22:20:28', '2021-01-24 22:21:25');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_product_return`
--

CREATE TABLE `purchase_product_return` (
  `id` int(10) UNSIGNED NOT NULL,
  `return_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `variant_id` int(11) DEFAULT NULL,
  `qty` double NOT NULL,
  `purchase_unit_id` int(11) NOT NULL,
  `net_unit_cost` double NOT NULL,
  `discount` double NOT NULL,
  `tax_rate` double NOT NULL,
  `tax` double NOT NULL,
  `total` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quick_product_sales`
--

CREATE TABLE `quick_product_sales` (
  `id` int(10) UNSIGNED NOT NULL,
  `sale_id` int(11) DEFAULT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qty` double DEFAULT NULL,
  `sale_unit` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `net_unit_price` double DEFAULT NULL,
  `tax_rate` double DEFAULT NULL,
  `tax` double DEFAULT NULL,
  `total` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `quick_product_sales`
--

INSERT INTO `quick_product_sales` (`id`, `sale_id`, `product_name`, `qty`, `sale_unit`, `net_unit_price`, `tax_rate`, `tax`, `total`, `created_at`, `updated_at`) VALUES
(1, 1, 'Suger', 2, 'KG', 100, 10, 28.7, 220, '2020-07-31 21:30:46', '2020-07-31 21:30:46'),
(2, 1, 'Brush', 5, 'Piece', 50, 15, 37.5, 287.5, '2020-07-31 21:30:46', '2020-07-31 21:30:46'),
(3, 2, 'Pen', 10, 'Piece', 20, 10, 20, 220, '2020-08-01 00:08:30', '2020-08-01 00:08:30'),
(4, 3, 'Spice', 2, 'Piece', 5, 0, 0, 10, '2020-08-02 17:29:41', '2020-08-02 17:29:41'),
(5, 4, 'hgvcj', 1, 'Piece', 100, 10, 10, 110, '2020-08-04 13:06:11', '2020-08-04 13:06:11'),
(6, 5, 'lemaon', 1, 'Piece', 100, 0, 0, 100, '2020-08-04 13:35:14', '2020-08-04 13:35:14'),
(7, 5, 'sugar', 1, 'Piece', 200, 0, 0, 200, '2020-08-04 13:35:14', '2020-08-04 13:35:14'),
(8, 5, 'Drychoclate', 2, 'Piece', 100, 0, 0, 200, '2020-08-04 13:35:14', '2020-08-04 13:35:14'),
(9, 6, 'tea', 1, 'Piece', 100, 0, 0, 100, '2020-08-04 16:00:47', '2020-08-04 16:00:47'),
(10, 7, 'tea1', 1, 'Piece', 100, 0, 0, 100, '2020-08-04 16:02:23', '2020-08-04 16:02:23'),
(11, 7, 'tea2', 2, 'Piece', 100, 0, 0, 200, '2020-08-04 16:02:23', '2020-08-04 16:02:23'),
(12, 7, 'tea3', 2, 'Piece', 500, 0, 0, 1000, '2020-08-04 16:02:23', '2020-08-04 16:02:23'),
(13, 8, 'te', 1, 'Piece', 100, 0, 0, 100, '2020-08-04 16:36:08', '2020-08-04 16:36:08'),
(14, 9, 'lip', 5, 'Piece', 10, 0, 0, 50, '2020-08-05 05:57:18', '2020-08-05 05:57:18'),
(15, 10, 'Biscuit', 5, 'Piece', 10, 10, 5, 55, '2020-08-05 05:58:36', '2020-08-05 05:58:36'),
(16, 11, 'Rice', 7, 'KG', 50, 10, 35, 385, '2020-08-06 12:57:43', '2020-08-06 12:57:43'),
(17, 12, 'unknown Product', 1, 'Piece', 15, 0, 0, 15, '2020-08-06 15:52:49', '2020-08-06 15:52:49'),
(18, 13, 'hh', 1, 'Piece', 10, 0, 0, 10, '2020-08-12 15:12:20', '2020-08-12 15:12:20'),
(19, 14, 'Tandoori Masala', 1, 'Piece', 11, 0, 0, 11, '2020-08-12 15:47:26', '2020-08-12 15:47:26'),
(20, 15, 'Rice', 5, 'KG', 80, 10, 40, 440, '2020-08-13 12:30:50', '2020-08-13 12:30:50'),
(21, 16, 'Rice Test', 8, 'KG', 40, 0, 0, 320, '2020-08-13 12:35:38', '2020-08-13 12:35:38'),
(22, 17, 'Rice Test', 8, 'KG', 40, 0, 0, 320, '2020-08-13 12:35:48', '2020-08-13 12:35:48'),
(23, 18, 'test item', 4, 'Piece', 35, 10, 14, 154, '2020-08-13 16:12:31', '2020-08-13 16:12:31'),
(24, 19, 'Tandoori Masala', 1, 'Piece', 5, 0, 0, 5, '2020-08-13 17:02:05', '2020-08-13 17:02:05'),
(25, 20, 'Tandoori Masala', 1, 'Piece', 10, 10, 1, 11, '2020-08-14 11:58:02', '2020-08-14 11:58:02'),
(26, 21, 'Test', 10, 'Piece', 20, 0, 0, 200, '2020-08-14 15:50:11', '2020-08-14 15:50:11'),
(27, 22, 'Brush', 5, 'KG', 50, 10, 25, 275, '2020-08-14 15:57:50', '2020-08-14 15:57:50'),
(28, 23, 'Test2', 2, 'Piece', 25, 0, 0, 50, '2020-08-14 16:13:47', '2020-08-14 16:13:47'),
(29, 24, 'Test 3', 12, 'Piece', 22, 0, 0, 264, '2020-08-14 16:14:51', '2020-08-14 16:14:51'),
(30, 25, 'Tandoori Masala', 1, 'Piece', 123, 0, 0, 123, '2020-08-14 16:34:22', '2020-08-14 16:34:22'),
(31, 26, 'Haleem Mix', 1, 'Piece', 6, 0, 0, 6, '2020-08-15 15:48:03', '2020-08-15 15:48:03'),
(32, 27, 'Beef', 5, 'Piece', 1, 0, 0, 5, '2020-08-17 14:41:21', '2020-08-17 14:41:21'),
(33, 28, 'Shan Chicken Spices', 10, 'Piece', 10, 0, 0, 100, '2020-08-18 15:29:59', '2020-08-18 15:29:59'),
(34, 29, 'rice', 1, 'Piece', 123, 0, 0, 123, '2021-01-03 19:11:50', '2021-01-03 19:11:50'),
(35, 30, 'rice', 1, 'Piece', 123, 0, 0, 123, '2021-01-03 19:11:50', '2021-01-03 19:11:50'),
(36, 31, 'test', 10, 'Piece', 100, 0, 0, 1000, '2021-01-24 22:24:10', '2021-01-24 22:24:10');

-- --------------------------------------------------------

--
-- Table structure for table `quick_sales`
--

CREATE TABLE `quick_sales` (
  `id` int(10) UNSIGNED NOT NULL,
  `reference_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `warehouse_id` int(11) NOT NULL,
  `biller_id` int(11) NOT NULL,
  `customer_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item` int(11) DEFAULT NULL,
  `total_qty` double DEFAULT NULL,
  `total_tax` double DEFAULT NULL,
  `total_price` double DEFAULT NULL,
  `grand_total` double DEFAULT NULL,
  `sale_status` int(11) DEFAULT NULL,
  `payment_status` int(11) DEFAULT NULL,
  `paid_amount` double DEFAULT NULL,
  `by_cash` double DEFAULT NULL,
  `by_card` double DEFAULT NULL,
  `quick_change` double DEFAULT NULL,
  `sale_note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `staff_note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paying_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `quick_sales`
--

INSERT INTO `quick_sales` (`id`, `reference_no`, `user_id`, `warehouse_id`, `biller_id`, `customer_name`, `item`, `total_qty`, `total_tax`, `total_price`, `grand_total`, `sale_status`, `payment_status`, `paid_amount`, `by_cash`, `by_card`, `quick_change`, `sale_note`, `staff_note`, `payment_note`, `paying_method`, `created_at`, `updated_at`) VALUES
(1, 'qckpos-20200801-030046', 1, 2, 2, 'Walk-In-Customer', 2, 7, 57.5, 507.5, 507.5, 1, 4, 507.5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-07-31 21:30:46', '2020-07-31 21:30:46'),
(2, 'qckpos-20200801-053830', 1, 2, 2, 'Walk-In-Customer', 1, 10, 20, 220, 220, 1, 4, 220, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-08-01 00:08:30', '2020-08-01 00:08:30'),
(3, 'qckpos-20200802-105941', 1, 2, 2, 'Walk-In-Customer', 1, 2, 0, 10, 10, 1, 4, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-08-02 17:29:41', '2020-08-02 17:29:41'),
(4, 'qckpos-20200804-063611', 1, 2, 2, 'Walk-In-Customer', 1, 1, 10, 110, 110, 1, 4, 110, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-08-04 13:06:11', '2020-08-04 13:06:11'),
(5, 'qckpos-20200804-070514', 1, 2, 2, 'Walk-In-Customer', 3, 4, 0, 500, 500, 1, 4, 500, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-08-04 13:35:14', '2020-08-04 13:35:14'),
(6, 'qckpos-20200804-093047', 1, 2, 2, 'Walk-In-Customer', 1, 1, 0, 100, 100, 1, 4, 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-08-04 16:00:47', '2020-08-04 16:00:47'),
(7, 'qckpos-20200804-093223', 1, 2, 2, 'Walk-In-Customer', 3, 5, 0, 1300, 1300, 1, 4, 1300, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-08-04 16:02:23', '2020-08-04 16:02:23'),
(8, 'qckpos-20200804-100608', 1, 2, 2, 'Walk-In-Customer', 1, 1, 0, 100, 100, 1, 4, 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-08-04 16:36:08', '2020-08-04 16:36:08'),
(9, 'qckpos-20200805-112718', 1, 2, 2, 'Walk-In-Customer', 1, 5, 0, 50, 50, 1, 4, 50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-08-05 05:57:18', '2020-08-05 05:57:18'),
(10, 'qckpos-20200805-112836', 1, 2, 2, 'Walk-In-Customer', 1, 5, 5, 55, 55, 1, 4, 55, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-08-05 05:58:36', '2020-08-05 05:58:36'),
(11, 'qckpos-20200806-062743', 1, 2, 2, 'Walk-In-Customer', 1, 7, 35, 385, 385, 1, 4, 385, 390, NULL, 5, 'st', 'sft', 'pt', 'Mix Payment', '2020-08-06 12:57:43', '2020-08-06 12:57:43'),
(12, 'qckpos-20200806-092249', 1, 2, 2, 'Walk-In-Customer', 1, 1, 0, 15, 15, 1, 4, 15, NULL, NULL, 0, NULL, NULL, NULL, 'Credit Card', '2020-08-06 15:52:49', '2020-08-06 15:52:49'),
(13, 'qckpos-20200812-084220', 1, 2, 2, 'Walk-In-Customer', 1, 1, 0, 10, 10, 1, 4, 10, NULL, NULL, 0, NULL, NULL, NULL, 'Credit Card', '2020-08-12 15:12:20', '2020-08-12 15:12:20'),
(14, 'qckpos-20200812-091726', 20, 2, 2, 'Walk-In-Customer', 1, 1, 0, 11, 11, 1, 4, 11, NULL, NULL, 0, NULL, NULL, NULL, 'Cash', '2020-08-12 15:47:26', '2020-08-12 15:47:26'),
(15, 'qckpos-20200813-060050', 1, 2, 2, 'Walk-In-Customer', 1, 5, 40, 440, 440, 1, 4, 440, 500, NULL, 0, NULL, NULL, NULL, 'Cash', '2020-08-13 12:30:50', '2020-08-13 12:30:50'),
(16, 'qckpos-20200813-060538', 1, 2, 2, 'Walk-In-Customer', 1, 8, 0, 320, 320, 1, 4, 320, 200, 120, 0, NULL, NULL, NULL, 'Mix Payment', '2020-08-13 12:35:38', '2020-08-13 12:35:38'),
(17, 'qckpos-20200813-060548', 1, 2, 2, 'Walk-In-Customer', 1, 8, 0, 320, 320, 1, 4, 320, 200, 120, 0, NULL, NULL, NULL, 'Mix Payment', '2020-08-13 12:35:48', '2020-08-13 12:35:48'),
(18, 'qckpos-20200813-094231', 2, 2, 2, 'Walk-In-Customer', 1, 4, 14, 154, 154, 1, 4, 154, 100, NULL, 0, NULL, NULL, NULL, 'Cash', '2020-08-13 16:12:31', '2020-08-13 16:12:31'),
(19, 'qckpos-20200813-103205', 2, 2, 2, 'Walk-In-Customer', 1, 1, 0, 5, 5, 1, 4, 5, 5, NULL, 0, NULL, NULL, NULL, 'Cash', '2020-08-13 17:02:05', '2020-08-13 17:02:05'),
(20, 'qckpos-20200814-052802', 2, 2, 2, 'Walk-In-Customer', 1, 1, 1, 11, 11, 1, 4, 11, NULL, NULL, -1, NULL, NULL, NULL, 'Cash', '2020-08-14 11:58:02', '2020-08-14 11:58:02'),
(21, 'qckpos-20200814-092011', 1, 2, 2, 'Walk-In-Customer', 1, 10, 0, 200, 200, 1, 4, 200, NULL, NULL, 0, NULL, NULL, NULL, 'Credit Card', '2020-08-14 15:50:11', '2020-08-14 15:50:11'),
(22, 'qckpos-20200814-092750', 1, 2, 2, 'Walk-In-Customer', 1, 5, 25, 275, 275, 1, 4, 275, NULL, NULL, 0, NULL, NULL, NULL, 'Credit Card', '2020-08-14 15:57:50', '2020-08-14 15:57:50'),
(23, 'qckpos-20200814-094347', 9, 2, 2, 'Walk-In-Customer', 1, 2, 0, 50, 50, 1, 4, 50, NULL, NULL, 0, NULL, NULL, NULL, 'Credit Card', '2020-08-14 16:13:47', '2020-08-14 16:13:47'),
(24, 'qckpos-20200814-094451', 1, 2, 2, 'Walk-In-Customer', 1, 12, 0, 264, 264, 1, 4, 264, NULL, NULL, 0, NULL, NULL, NULL, 'Credit Card', '2020-08-14 16:14:51', '2020-08-14 16:14:51'),
(25, 'qckpos-20200814-100422', 20, 2, 2, 'Walk-In-Customer', 1, 1, 0, 123, 123, 1, 4, 123, 100, NULL, -23, NULL, NULL, NULL, 'Cash', '2020-08-14 16:34:22', '2020-08-14 16:34:22'),
(26, 'qckpos-20200815-091803', 1, 2, 2, 'Walk-In-Customer', 1, 1, 0, 6, 6, 1, 4, 6, NULL, NULL, 0, NULL, NULL, NULL, 'Credit Card', '2020-08-15 15:48:03', '2020-08-15 15:48:03'),
(27, 'qckpos-20200817-081121', 9, 2, 2, 'Walk-In-Customer', 1, 5, 0, 5, 5, 1, 4, 5, NULL, NULL, 0, NULL, NULL, NULL, 'Credit Card', '2020-08-17 14:41:21', '2020-08-17 14:41:21'),
(28, 'qckpos-20200818-085959', 1, 2, 2, 'Walk-In-Customer', 1, 10, 0, 100, 100, 1, 4, 100, NULL, NULL, 0, NULL, NULL, NULL, 'Credit Card', '2020-08-18 15:29:59', '2020-08-18 15:29:59'),
(29, 'qckpos-20210103-071150', 21, 2, 2, 'Walk-In-Customer', 1, 1, 0, 123, 123, 1, 4, 123, NULL, NULL, 0, NULL, NULL, NULL, 'Credit Card', '2021-01-03 19:11:50', '2021-01-03 19:11:50'),
(30, 'qckpos-20210103-071150', 21, 2, 2, 'Walk-In-Customer', 1, 1, 0, 123, 123, 1, 4, 123, NULL, NULL, 0, NULL, NULL, NULL, 'Credit Card', '2021-01-03 19:11:50', '2021-01-03 19:11:50'),
(31, 'qckpos-20210124-102410', 32, 2, 2, 'Walk-In-Customer', 1, 10, 0, 1000, 1000, 1, 4, 1000, NULL, NULL, 0, NULL, NULL, NULL, 'Credit Card', '2021-01-24 22:24:10', '2021-01-24 22:24:10');

-- --------------------------------------------------------

--
-- Table structure for table `quotations`
--

CREATE TABLE `quotations` (
  `id` int(10) UNSIGNED NOT NULL,
  `reference_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `biller_id` int(11) NOT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `customer_id` int(11) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `item` int(11) NOT NULL,
  `total_qty` double NOT NULL,
  `total_discount` double NOT NULL,
  `total_tax` double NOT NULL,
  `total_price` double NOT NULL,
  `order_tax_rate` double DEFAULT NULL,
  `order_tax` double DEFAULT NULL,
  `order_discount` double DEFAULT NULL,
  `shipping_cost` double DEFAULT NULL,
  `grand_total` double NOT NULL,
  `quotation_status` int(11) NOT NULL,
  `document` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `returns`
--

CREATE TABLE `returns` (
  `id` int(10) UNSIGNED NOT NULL,
  `reference_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `biller_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `item` int(11) NOT NULL,
  `total_qty` double NOT NULL,
  `total_discount` double NOT NULL,
  `total_tax` double NOT NULL,
  `total_price` double NOT NULL,
  `order_tax_rate` double DEFAULT NULL,
  `order_tax` double DEFAULT NULL,
  `grand_total` double NOT NULL,
  `document` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `return_note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `staff_note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `return_purchases`
--

CREATE TABLE `return_purchases` (
  `id` int(10) UNSIGNED NOT NULL,
  `reference_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `warehouse_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `item` int(11) NOT NULL,
  `total_qty` double NOT NULL,
  `total_discount` double NOT NULL,
  `total_tax` double NOT NULL,
  `total_cost` double NOT NULL,
  `order_tax_rate` double DEFAULT NULL,
  `order_tax` double DEFAULT NULL,
  `grand_total` double NOT NULL,
  `document` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `return_note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `staff_note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`, `guard_name`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin can access all data...', 'web', 1, '2018-06-01 23:46:44', '2018-06-02 23:13:05'),
(2, 'Owner', 'Owner of shop...', 'web', 1, '2018-10-22 02:38:13', '2018-10-22 02:38:13'),
(4, 'staff', 'staff has specific acess...', 'web', 1, '2018-06-02 00:05:27', '2018-06-02 00:05:27'),
(5, 'sanjay parasher', 'this is staff member', 'web', 1, '2020-07-13 11:19:30', '2020-07-13 11:19:30'),
(6, 'Staff12', 'Staff member', 'web', 1, '2020-08-12 15:45:49', '2020-08-12 15:45:49'),
(7, 'Seller', 'Seller ', 'web', 1, '2020-08-12 15:45:49', '2020-08-12 15:45:49'),
(8, 'Super Admin', 'Supper Admin', 'web', 1, '2020-12-16 19:28:39', '2020-12-16 19:28:39');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(4, 1),
(4, 2),
(4, 7),
(4, 8),
(5, 1),
(5, 2),
(5, 7),
(5, 8),
(6, 1),
(6, 2),
(6, 4),
(6, 7),
(6, 8),
(7, 1),
(7, 2),
(7, 4),
(7, 7),
(7, 8),
(8, 1),
(8, 2),
(8, 4),
(8, 7),
(8, 8),
(9, 1),
(9, 2),
(9, 4),
(9, 7),
(9, 8),
(10, 1),
(10, 2),
(10, 7),
(10, 8),
(11, 1),
(11, 2),
(11, 7),
(11, 8),
(12, 1),
(12, 2),
(12, 4),
(12, 7),
(12, 8),
(13, 1),
(13, 2),
(13, 4),
(13, 7),
(13, 8),
(14, 1),
(14, 2),
(14, 7),
(14, 8),
(15, 1),
(15, 2),
(15, 7),
(15, 8),
(16, 1),
(16, 2),
(16, 7),
(16, 8),
(17, 1),
(17, 2),
(17, 7),
(17, 8),
(18, 1),
(18, 2),
(18, 7),
(18, 8),
(19, 1),
(19, 2),
(19, 7),
(19, 8),
(20, 1),
(20, 2),
(20, 4),
(20, 7),
(20, 8),
(21, 1),
(21, 2),
(21, 4),
(21, 7),
(21, 8),
(22, 1),
(22, 2),
(22, 7),
(22, 8),
(23, 1),
(23, 2),
(23, 7),
(23, 8),
(24, 1),
(24, 2),
(24, 4),
(24, 7),
(24, 8),
(25, 1),
(25, 2),
(25, 4),
(25, 7),
(25, 8),
(26, 1),
(26, 2),
(26, 7),
(26, 8),
(27, 1),
(27, 2),
(27, 7),
(27, 8),
(28, 1),
(28, 2),
(28, 4),
(28, 7),
(28, 8),
(29, 1),
(29, 2),
(29, 4),
(29, 7),
(29, 8),
(30, 1),
(30, 2),
(30, 7),
(30, 8),
(31, 1),
(31, 2),
(31, 7),
(31, 8),
(32, 1),
(32, 2),
(32, 4),
(32, 8),
(33, 1),
(33, 2),
(33, 4),
(33, 8),
(34, 1),
(34, 2),
(34, 8),
(35, 1),
(35, 2),
(35, 8),
(36, 1),
(36, 2),
(36, 7),
(36, 8),
(37, 1),
(37, 2),
(37, 7),
(37, 8),
(38, 1),
(38, 2),
(38, 7),
(38, 8),
(39, 1),
(39, 2),
(39, 7),
(39, 8),
(40, 1),
(40, 2),
(40, 7),
(40, 8),
(41, 1),
(41, 2),
(41, 8),
(42, 1),
(42, 2),
(42, 8),
(43, 1),
(43, 2),
(43, 8),
(44, 1),
(44, 2),
(44, 8),
(45, 2),
(45, 7),
(45, 8),
(46, 1),
(46, 2),
(46, 7),
(46, 8),
(47, 1),
(47, 2),
(47, 7),
(47, 8),
(48, 1),
(48, 2),
(48, 7),
(48, 8),
(49, 1),
(49, 2),
(49, 7),
(49, 8),
(50, 1),
(50, 2),
(50, 7),
(50, 8),
(51, 1),
(51, 2),
(51, 7),
(51, 8),
(52, 1),
(52, 2),
(52, 7),
(52, 8),
(53, 1),
(53, 2),
(53, 7),
(53, 8),
(54, 1),
(54, 2),
(54, 8),
(55, 1),
(55, 2),
(55, 7),
(55, 8),
(56, 1),
(56, 2),
(56, 7),
(56, 8),
(57, 1),
(57, 2),
(57, 7),
(57, 8),
(58, 1),
(58, 2),
(58, 7),
(58, 8),
(59, 1),
(59, 2),
(59, 8),
(60, 1),
(60, 2),
(60, 8),
(61, 1),
(61, 2),
(61, 7),
(61, 8),
(62, 1),
(62, 2),
(62, 8),
(63, 1),
(63, 2),
(63, 4),
(63, 7),
(63, 8),
(64, 1),
(64, 2),
(64, 4),
(64, 7),
(64, 8),
(65, 1),
(65, 2),
(65, 7),
(65, 8),
(66, 1),
(66, 2),
(66, 7),
(66, 8),
(67, 1),
(67, 2),
(67, 7),
(67, 8),
(68, 1),
(68, 2),
(68, 7),
(68, 8),
(69, 1),
(69, 2),
(69, 8),
(70, 1),
(70, 2),
(70, 8),
(71, 1),
(71, 2),
(71, 8),
(72, 1),
(72, 2),
(72, 8),
(73, 1),
(73, 2),
(73, 8),
(74, 1),
(74, 2),
(74, 8),
(75, 1),
(75, 2),
(75, 8),
(76, 1),
(76, 2),
(76, 8),
(77, 1),
(77, 2),
(77, 7),
(77, 8),
(78, 1),
(78, 2),
(78, 7),
(78, 8),
(79, 1),
(79, 2),
(79, 7),
(79, 8),
(80, 1),
(80, 2),
(80, 8),
(81, 1),
(81, 2),
(81, 8),
(82, 1),
(82, 2),
(82, 8),
(83, 1),
(83, 2),
(83, 8),
(84, 1),
(84, 2),
(84, 7),
(84, 8),
(85, 1),
(85, 2),
(85, 7),
(85, 8),
(86, 1),
(86, 2),
(86, 7),
(86, 8),
(87, 1),
(87, 2),
(87, 7),
(87, 8),
(88, 1),
(88, 2),
(88, 8),
(89, 1),
(89, 2),
(89, 8),
(90, 1),
(90, 2),
(90, 7),
(90, 8),
(91, 1),
(91, 2),
(91, 7),
(91, 8),
(92, 1),
(92, 2),
(92, 7),
(92, 8),
(93, 1),
(93, 2),
(93, 4),
(93, 8),
(94, 1),
(94, 2),
(94, 4),
(94, 8),
(95, 1),
(95, 2),
(95, 8),
(96, 1),
(96, 2),
(96, 8),
(97, 1),
(97, 2),
(97, 7),
(97, 8),
(98, 1),
(98, 2),
(98, 4),
(98, 7),
(98, 8),
(99, 1),
(99, 2),
(99, 4),
(99, 7),
(99, 8),
(100, 1),
(100, 2),
(100, 7),
(100, 8),
(101, 1),
(101, 7),
(101, 8),
(102, 1),
(102, 8),
(103, 1),
(103, 8),
(104, 1),
(104, 8),
(105, 1),
(105, 8),
(106, 1),
(106, 8),
(107, 1),
(107, 8),
(108, 1),
(108, 8),
(109, 1),
(109, 8),
(110, 1),
(110, 8),
(111, 1),
(111, 8),
(112, 1),
(112, 8),
(113, 7),
(114, 7),
(116, 7),
(117, 7);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(10) UNSIGNED NOT NULL,
  `reference_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `biller_id` int(11) DEFAULT NULL,
  `item` int(11) NOT NULL,
  `total_qty` double NOT NULL,
  `total_discount` double NOT NULL,
  `total_tax` double NOT NULL,
  `total_price` double NOT NULL,
  `grand_total` double NOT NULL,
  `order_tax_rate` double DEFAULT NULL,
  `order_tax` double DEFAULT NULL,
  `order_discount` double DEFAULT NULL,
  `coupon_id` int(11) DEFAULT NULL,
  `coupon_discount` double DEFAULT NULL,
  `shipping_cost` double DEFAULT NULL,
  `sale_status` int(11) NOT NULL,
  `payment_status` int(11) NOT NULL,
  `document` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paid_amount` double DEFAULT NULL,
  `sale_note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `staff_note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_seller_paid` int(1) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `reference_no`, `user_id`, `customer_id`, `warehouse_id`, `biller_id`, `item`, `total_qty`, `total_discount`, `total_tax`, `total_price`, `grand_total`, `order_tax_rate`, `order_tax`, `order_discount`, `coupon_id`, `coupon_discount`, `shipping_cost`, `sale_status`, `payment_status`, `document`, `paid_amount`, `sale_note`, `staff_note`, `is_seller_paid`, `created_at`, `updated_at`) VALUES
(1, 'posr-20200726-064249', 1, 1, 1, 1, 2, 2, 0, 4.5, 49.5, 49.5, 0, 0, NULL, NULL, NULL, NULL, 1, 4, NULL, 49.5, NULL, NULL, 0, '2020-07-26 13:12:49', '2020-07-26 13:12:49'),
(2, 'posr-20200726-064402', 1, 1, 1, 1, 1, 1, 0, 2.7, 29.7, 29.7, 0, 0, NULL, NULL, NULL, NULL, 1, 4, NULL, 29.7, NULL, NULL, 0, '2020-07-26 13:14:02', '2020-07-26 13:14:02'),
(3, 'posr-20200726-064407', 1, 1, 1, 1, 1, 1, 0, 2.7, 29.7, 29.7, 0, 0, NULL, NULL, NULL, NULL, 1, 4, NULL, 29.7, NULL, NULL, 0, '2020-07-26 13:14:07', '2020-07-26 13:14:07'),
(4, 'posr-20200726-064633', 1, 1, 1, 1, 1, 1, 0, 2.7, 29.7, 29.7, 0, 0, NULL, NULL, NULL, NULL, 1, 4, NULL, 29.7, NULL, NULL, 0, '2020-07-26 13:16:33', '2020-07-26 13:16:33'),
(5, 'posr-20200726-064907', 1, 1, 1, 1, 1, 1, 0, 2.7, 29.7, 29.7, 0, 0, NULL, NULL, NULL, NULL, 1, 4, NULL, 29.7, NULL, NULL, 0, '2020-07-26 13:19:07', '2020-07-26 13:19:07'),
(6, 'posr-20200726-065132', 1, 1, 1, 1, 1, 1, 0, 2.7, 29.7, 29.7, 0, 0, NULL, NULL, NULL, NULL, 1, 4, NULL, 29.7, NULL, NULL, 0, '2020-07-26 13:21:32', '2020-07-26 13:21:32'),
(7, 'posr-20200726-065246', 1, 1, 1, 1, 1, 2, 0, 5.4, 59.4, 59.4, 0, 0, NULL, NULL, NULL, NULL, 1, 4, NULL, 59.4, NULL, NULL, 0, '2020-07-26 13:22:46', '2020-07-26 13:22:46'),
(13, 'posr-20200726-071834', 1, 2, 1, 1, 1, 1, 0, 2.7, 29.7, 29.7, 0, 0, NULL, NULL, NULL, NULL, 1, 4, NULL, 29.7, NULL, NULL, 0, '2020-07-26 13:48:34', '2020-07-26 13:48:34'),
(14, 'posr-20200726-072154', 1, 1, 1, 1, 1, 1, 0, 1.8, 19.8, 19.8, 0, 0, NULL, NULL, NULL, NULL, 1, 4, NULL, 19.8, NULL, NULL, 0, '2020-07-26 13:51:54', '2020-07-26 13:51:54'),
(15, 'sr-20200726-074435', 18, 2, 1, 1, 1, 1, 0, 2.7, 29.7, 29.7, 0, 0, NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, 0, '2020-07-26 14:14:35', '2020-07-26 14:14:35'),
(16, 'posr-20200728-104830', 1, 2, 1, 1, 1, 1, 0, 2.7, 29.7, 29.7, 0, 0, NULL, NULL, NULL, NULL, 1, 4, NULL, 29.7, NULL, NULL, 0, '2020-07-28 17:18:30', '2020-07-28 17:18:30'),
(18, 'posr-20200728-105056', 1, 2, 1, 1, 1, 1, 0, 2.7, 29.7, 29.7, 0, 0, NULL, NULL, NULL, NULL, 1, 4, NULL, 29.7, NULL, NULL, 0, '2020-07-28 17:20:56', '2020-07-28 17:20:56'),
(19, 'posr-20200729-084524', 1, 2, 1, 1, 1, 5, 0, 13.5, 148.5, 148.5, 0, 0, NULL, NULL, NULL, NULL, 1, 4, NULL, 148.5, NULL, NULL, 0, '2020-07-29 03:15:24', '2020-07-29 03:15:24'),
(21, 'posr-20200729-084833', 1, 2, 1, 1, 1, 1, 0, 2.7, 29.7, 29.7, 0, 0, NULL, NULL, NULL, NULL, 1, 4, NULL, 29.7, NULL, NULL, 0, '2020-07-29 03:18:33', '2020-07-29 03:18:33'),
(23, 'posr-20200729-085104', 1, 2, 1, 1, 1, 1, 0, 2.7, 29.7, 29.7, 0, 0, NULL, NULL, NULL, NULL, 1, 4, NULL, 29.7, NULL, NULL, 0, '2020-07-29 03:21:04', '2020-07-29 03:21:04'),
(26, 'posr-20200729-061740', 1, 2, 1, 1, 1, 1, 0, 2.7, 29.7, 29.7, NULL, 0, 0, NULL, NULL, 0, 1, 4, NULL, 29.7, NULL, NULL, 0, '2020-07-29 12:47:40', '2020-07-29 12:47:40'),
(27, 'posr-20200729-063010', 32, 2, 1, 1, 1, 1, 0, 2.7, 29.7, 29.7, 0, 0, NULL, NULL, NULL, NULL, 1, 4, NULL, 29.7, NULL, NULL, 0, '2020-07-29 13:00:10', '2020-07-29 13:00:10'),
(28, 'posr-20200802-105440', 21, 2, 1, 1, 1, 1, 0, 2.7, 29.7, 29.7, 0, 0, NULL, NULL, NULL, NULL, 1, 4, NULL, 29.7, NULL, NULL, 0, '2020-08-02 17:24:40', '2020-08-02 17:24:40'),
(29, 'posr-20200802-105547', 32, 2, 1, 1, 1, 2, 0, 5.4, 59.4, 59.4, 0, 0, NULL, NULL, NULL, NULL, 1, 4, NULL, 59.4, NULL, NULL, 0, '2020-08-02 17:25:47', '2020-08-02 17:25:47'),
(30, 'posr-20200802-110149', 21, 2, 1, 1, 1, 1, 0, 2.7, 29.7, 29.7, 0, 0, NULL, NULL, NULL, NULL, 1, 4, NULL, 29.7, NULL, NULL, 0, '2020-08-02 17:31:49', '2020-08-02 17:31:49'),
(32, 'posr-20200802-111333', 32, 2, 1, 1, 4, 4.5, 0, 6.53, 71.77, 71.77, 0, 0, NULL, NULL, NULL, NULL, 1, 4, NULL, 71.77, NULL, NULL, 0, '2020-08-02 17:43:33', '2020-08-02 17:43:33'),
(33, 'posr-20200802-111455', 21, 2, 1, 1, 4, 4, 0, 4.95, 69.45, 69.45, 0, 0, NULL, NULL, NULL, NULL, 1, 4, NULL, 69.45, NULL, NULL, 0, '2020-08-02 17:44:55', '2020-08-02 17:44:55'),
(36, 'posr-20200804-100955', 32, 2, 1, 1, 1, 1, 0, 2.7, 29.7, 29.7, NULL, 0, 0, NULL, NULL, 0, 1, 4, NULL, 29.7, NULL, NULL, 0, '2020-08-04 16:39:55', '2020-08-04 16:39:55'),
(38, 'posr-20200804-104926', 21, 2, 1, 1, 2, 2, 0, 4.5, 49.5, 49.5, 0, 0, NULL, NULL, NULL, NULL, 1, 4, NULL, 49.5, NULL, NULL, 0, '2020-08-04 17:19:26', '2020-08-04 17:19:26'),
(39, 'posr-20200805-111934', 32, 2, 1, 1, 1, 1, 0, 2.7, 29.7, 29.7, 0, 0, NULL, NULL, NULL, NULL, 1, 4, NULL, 29.7, NULL, NULL, 0, '2020-08-05 05:49:34', '2020-08-05 05:49:34'),
(41, 'posr-20200805-112041', 32, 2, 1, 1, 1, 2, 0, 5.4, 59.4, 59.4, NULL, 0, 0, NULL, NULL, 0, 1, 4, NULL, 59.4, NULL, NULL, 0, '2020-08-05 05:50:41', '2020-08-05 05:50:41'),
(43, 'posr-20200805-112922', 1, 2, 1, 1, 1, 3, 0, 8.1, 89.1, 89.1, 0, 0, NULL, NULL, NULL, NULL, 1, 4, NULL, 89.1, NULL, NULL, 0, '2020-08-05 05:59:22', '2020-08-05 05:59:22'),
(44, 'posr-20200805-113207', 1, 2, 1, 1, 1, 2, 0, 5.4, 59.4, 59.4, 0, 0, NULL, NULL, NULL, NULL, 1, 4, NULL, 59.4, NULL, NULL, 0, '2020-08-05 06:02:07', '2020-08-05 06:02:07'),
(45, 'posr-20200805-113322', 1, 2, 1, 1, 1, 1, 0, 1.8, 19.8, 19.8, 0, 0, 0, NULL, NULL, 0, 1, 4, NULL, 19.8, NULL, NULL, 0, '2020-08-05 06:03:22', '2020-08-05 12:41:00'),
(48, 'posr-20200805-100229', 1, 2, 1, 1, 1, 2, 0, 5.4, 59.4, 59.4, 0, 0, NULL, NULL, NULL, NULL, 1, 4, NULL, 59.4, NULL, NULL, 0, '2020-08-05 16:32:29', '2020-08-05 16:32:29'),
(49, 'posr-20200805-100334', 1, 2, 1, 1, 1, 1, 0, 2.7, 29.7, 29.7, 0, 0, NULL, NULL, NULL, NULL, 1, 4, NULL, 29.7, NULL, NULL, 0, '2020-08-05 16:33:34', '2020-08-05 16:33:34'),
(51, 'posr-20200805-101139', 1, 2, 1, 1, 1, 1, 0, 2.7, 29.7, 29.7, NULL, 0, 0, NULL, NULL, 0, 1, 4, NULL, 29.7, NULL, NULL, 0, '2020-08-05 16:41:39', '2020-08-05 16:41:39'),
(53, 'posr-20200806-091537', 1, 2, 1, 1, 1, 1, 0, 2.7, 29.7, 29.7, 0, 0, NULL, NULL, NULL, NULL, 1, 4, NULL, 29.7, NULL, NULL, 0, '2020-08-06 15:45:37', '2020-08-06 15:45:37'),
(55, 'posr-20200806-092052', 1, 2, 1, 1, 1, 1, 0, 2.7, 29.7, 29.7, NULL, 0, 0, NULL, NULL, 0, 1, 4, NULL, 29.7, NULL, NULL, 0, '2020-08-06 15:50:52', '2020-08-06 15:50:52'),
(56, 'posr-20200806-101806', 1, 2, 1, 1, 3, 3, 0, 2.85, 61.35, 61.35, 0, 0, NULL, NULL, NULL, NULL, 1, 4, NULL, 61.35, NULL, NULL, 0, '2020-08-06 16:48:06', '2020-08-06 16:48:06'),
(57, 'posr-20200806-102007', 1, 2, 1, 1, 1, 1, 0, 2.7, 29.7, 29.7, 0, 0, NULL, NULL, NULL, NULL, 1, 4, NULL, 29.7, NULL, NULL, 0, '2020-08-06 16:50:07', '2020-08-06 16:50:07'),
(58, 'posr-20200806-102108', 1, 2, 1, 1, 1, 1, 0, 0, 30, 30, 0, 0, NULL, NULL, NULL, NULL, 1, 4, NULL, 30, NULL, NULL, 0, '2020-08-06 16:51:08', '2020-08-06 16:51:08'),
(59, 'posr-20200806-102511', 1, 2, 1, 1, 1, 1, 0, 0, 30, 30, 0, 0, NULL, NULL, NULL, NULL, 1, 4, NULL, 30, NULL, NULL, 0, '2020-08-06 16:55:11', '2020-08-06 16:55:11'),
(60, 'posr-20200807-112901', 1, 2, 1, 1, 1, 3, 0, 3.15, 34.65, 34.65, 0, 0, NULL, NULL, NULL, NULL, 1, 4, NULL, 34.65, NULL, NULL, 0, '2020-08-07 05:59:01', '2020-08-07 05:59:01'),
(61, 'posr-20200808-022035', 1, 2, 1, 1, 1, 1, 0, 1.2, 13.2, 13.2, 0, 0, NULL, NULL, NULL, NULL, 1, 4, NULL, 13.2, NULL, NULL, 0, '2020-08-07 20:50:35', '2020-08-07 20:50:35'),
(62, 'posr-20200808-022215', 1, 2, 1, 1, 1, 1, 0, 1.2, 13.2, 13.2, 0, 0, NULL, NULL, NULL, NULL, 1, 4, NULL, 13.2, NULL, NULL, 0, '2020-08-07 20:52:15', '2020-08-07 20:52:15'),
(63, 'posr-20200808-022504', 1, 2, 1, 1, 1, 1, 0, 1.2, 13.2, 13.2, 0, 0, NULL, NULL, NULL, NULL, 1, 4, NULL, 13.2, NULL, NULL, 0, '2020-08-07 20:55:04', '2020-08-07 20:55:04'),
(64, 'posr-20200808-022703', 1, 2, 1, 1, 1, 1, 0, 1.2, 13.2, 13.2, 0, 0, NULL, NULL, NULL, NULL, 1, 4, NULL, 13.2, NULL, NULL, 0, '2020-08-07 20:57:03', '2020-08-07 20:57:03'),
(65, 'posr-20200808-022729', 1, 2, 1, 1, 1, 1, 0, 1.2, 13.2, 13.2, 0, 0, NULL, NULL, NULL, NULL, 1, 4, NULL, 13.2, NULL, NULL, 0, '2020-08-07 20:57:29', '2020-08-07 20:57:29'),
(66, 'posr-20200808-025200', 1, 2, 1, 1, 1, 1, 0, 1.2, 13.2, 13.2, 0, 0, NULL, NULL, NULL, NULL, 1, 4, NULL, 13.2, NULL, NULL, 0, '2020-08-07 21:22:00', '2020-08-07 21:22:00'),
(67, 'posr-20200808-025609', 1, 2, 1, 1, 1, 1, 0, 0.3, 3.3, 3.3, 0, 0, NULL, NULL, NULL, NULL, 1, 4, NULL, 3.3, NULL, NULL, 0, '2020-08-07 21:26:09', '2020-08-07 21:26:09'),
(68, 'posr-20200808-025822', 1, 2, 1, 1, 1, 1, 0, 0.3, 3.3, 3.63, 10, 0.33, NULL, NULL, NULL, NULL, 1, 4, NULL, 3.63, NULL, NULL, 0, '2020-08-07 21:28:22', '2020-08-07 21:28:22'),
(69, 'posr-20200808-030718', 1, 2, 1, 1, 1, 1, 0, 1.2, 13.2, 13.2, 0, 0, NULL, NULL, NULL, NULL, 3, 2, NULL, NULL, NULL, NULL, 0, '2020-08-07 21:37:18', '2020-08-07 21:37:18'),
(70, 'posr-20200808-030743', 1, 2, 1, 1, 1, 1, 0, 0.3, 3.3, 3.3, 0, 0, NULL, NULL, NULL, NULL, 3, 2, NULL, NULL, NULL, NULL, 0, '2020-08-07 21:37:43', '2020-08-07 21:37:43'),
(71, 'posr-20200808-111417', 1, 4, 2, 2, 1, 2, 0, 0, 6, 6, 0, 0, NULL, NULL, NULL, NULL, 1, 4, NULL, 6, NULL, NULL, 0, '2020-08-08 05:44:17', '2020-08-08 05:44:17'),
(72, 'posr-20200808-111848', 1, 4, 2, 2, 1, 1, 0, 0, 3, 3, 0, 0, NULL, NULL, NULL, NULL, 1, 4, NULL, 3, NULL, NULL, 0, '2020-08-08 05:48:48', '2020-08-08 05:48:48'),
(73, 'posr-20200808-045527', 1, 4, 2, 2, 1, 1, 0, 0, 3, 3, 0, 0, NULL, NULL, NULL, NULL, 1, 4, NULL, 3, NULL, NULL, 0, '2020-08-08 11:25:27', '2020-08-08 11:25:27'),
(74, 'posr-20200808-092209', 1, 4, 2, 2, 1, 1, 0, 0, 3, 3, 0, 0, NULL, NULL, NULL, NULL, 1, 4, NULL, 3, NULL, NULL, 0, '2020-08-08 15:52:09', '2020-08-08 15:52:09'),
(75, 'posr-20200808-092723', 1, 4, 2, 2, 1, 1, 0, 0, 3, 3, 0, 0, NULL, NULL, NULL, NULL, 1, 4, NULL, 3, NULL, NULL, 0, '2020-08-08 15:57:23', '2020-08-08 15:57:23'),
(76, 'posr-20200808-093106', 1, 4, 2, 2, 1, 1, 0, 0, 3, 3, 0, 0, NULL, NULL, NULL, NULL, 1, 4, NULL, 3, NULL, NULL, 0, '2020-08-08 16:01:06', '2020-08-08 16:01:06'),
(77, 'posr-20200808-093328', 1, 4, 2, 2, 1, 2, 0, 0, 6, 6, 0, 0, NULL, NULL, NULL, NULL, 1, 4, NULL, 6, NULL, NULL, 0, '2020-08-08 16:03:28', '2020-08-08 16:03:28'),
(78, 'posr-20200808-093428', 1, 4, 2, 2, 1, 1, 0, 0, 3, 3, 0, 0, NULL, NULL, NULL, NULL, 1, 4, NULL, 3, NULL, NULL, 0, '2020-08-08 16:04:28', '2020-08-08 16:04:28'),
(79, 'posr-20200808-093529', 1, 4, 2, 2, 1, 1, 0, 0, 3, 3, 0, 0, NULL, NULL, NULL, NULL, 1, 4, NULL, 3, NULL, NULL, 0, '2020-08-08 16:05:29', '2020-08-08 16:05:29'),
(80, 'posr-20200808-094532', 1, 4, 2, 2, 1, 5, 0, 0, 15, 15, 0, 0, NULL, NULL, NULL, NULL, 1, 4, NULL, 15, NULL, NULL, 0, '2020-08-08 16:15:32', '2020-08-08 16:15:32'),
(81, 'posr-20200808-095024', 1, 4, 2, 2, 2, 6, 0, 0, 16, 16, 0, 0, NULL, NULL, NULL, NULL, 1, 4, NULL, 16, NULL, NULL, 0, '2020-08-08 16:20:24', '2020-08-08 16:20:24'),
(82, 'posr-20200808-103408', 1, 4, 2, 2, 1, 1, 0, 0, 3, 3, 0, 0, NULL, NULL, NULL, NULL, 1, 4, NULL, 3, NULL, NULL, 0, '2020-08-08 17:04:08', '2020-08-08 17:04:08'),
(83, 'posr-20200808-104820', 1, 4, 2, 2, 1, 1, 0, 0, 3, 3, 0, 0, NULL, NULL, NULL, NULL, 1, 4, NULL, 3, NULL, NULL, 0, '2020-08-08 17:18:20', '2020-08-08 17:18:20'),
(84, 'posr-20200809-032419', 1, 4, 2, 2, 2, 3, 0, 0, 7, 7, 0, 0, NULL, NULL, NULL, NULL, 1, 4, NULL, 7, NULL, NULL, 0, '2020-08-09 09:54:19', '2020-08-09 09:54:19'),
(85, 'posr-20200809-040420', 1, 4, 2, 2, 2, 4, 0, 0, 10, 10, 0, 0, NULL, NULL, NULL, NULL, 1, 4, NULL, 10, NULL, NULL, 0, '2020-08-09 10:34:20', '2020-08-09 10:34:20'),
(86, 'posr-20200809-040420', 1, 4, 2, 2, 2, 4, 0, 0, 10, 10, 0, 0, NULL, NULL, NULL, NULL, 1, 4, NULL, 10, NULL, NULL, 0, '2020-08-09 10:34:20', '2020-08-09 10:34:20'),
(87, 'posr-20200809-055640', 1, 4, 2, 2, 1, 1, 0, 0, 3, 3, 0, 0, NULL, NULL, NULL, NULL, 1, 4, NULL, 3, NULL, NULL, 0, '2020-08-09 12:26:40', '2020-08-09 12:26:40'),
(88, 'posr-20200809-060257', 1, 4, 2, 2, 1, 1, 0, 0, 2, 2, 0, 0, NULL, NULL, NULL, NULL, 1, 4, NULL, 2, NULL, NULL, 0, '2020-08-09 12:32:57', '2020-08-09 12:32:57'),
(89, 'posr-20200813-012307', 1, 4, 2, 2, 1, 1, 0, 0, 3, 3, 0, 0, NULL, NULL, NULL, NULL, 1, 4, NULL, 3, NULL, NULL, 0, '2020-08-13 07:53:07', '2020-08-13 07:53:07'),
(90, 'posr-20200815-091633', 1, 4, 2, 2, 1, 2, 0, 0, 6, 6, 0, 0, NULL, NULL, NULL, NULL, 1, 4, NULL, 6, NULL, NULL, 0, '2020-08-15 15:46:33', '2020-08-15 15:46:33'),
(91, 'posr-20201208-075102', 1, 4, 2, 2, 1, 1, 0, 0, 2, 2, 0, 0, NULL, NULL, NULL, NULL, 1, 4, NULL, 2, NULL, NULL, 0, '2020-12-08 19:51:02', '2020-12-08 19:51:02'),
(92, 'posr-20210108-020657', 1, 4, 2, 2, 1, 2, 0, 0, 6, 6, 0, 0, NULL, NULL, NULL, NULL, 1, 4, NULL, 6, NULL, NULL, 0, '2021-01-08 02:06:57', '2021-01-08 02:06:57'),
(93, 'posr-20210108-021928', 1, 4, 2, 2, 1, 3, 0, 0, 9, 9, 0, 0, NULL, NULL, NULL, NULL, 1, 4, NULL, 9, NULL, NULL, 0, '2021-01-08 02:19:28', '2021-01-08 02:19:28'),
(94, 'posr-20210108-033249', 1, 4, 2, 2, 1, 1, 0, 0, 3, 3, 0, 0, NULL, NULL, NULL, NULL, 1, 4, NULL, 3, NULL, NULL, 0, '2021-01-08 03:32:49', '2021-01-08 03:32:49'),
(95, 'posr-20210108-065452', 1, 4, 2, 2, 1, 1, 0, 0, 3, 3, 0, 0, NULL, NULL, NULL, NULL, 1, 4, NULL, 3, NULL, NULL, 0, '2021-01-08 06:54:52', '2021-01-08 06:54:52'),
(96, 'posr-20210109-085902', 1, 4, 2, 2, 1, 1, 0, 0, 3, 3, 0, 0, NULL, NULL, NULL, NULL, 1, 4, NULL, 3, NULL, NULL, 0, '2021-01-09 20:59:02', '2021-01-09 20:59:02'),
(97, 'posr-20210109-090025', 1, 4, 2, 2, 1, 1, 0, 0, 3, 3, 0, 0, NULL, NULL, NULL, NULL, 1, 4, NULL, 3, NULL, NULL, 0, '2021-01-09 21:00:25', '2021-01-09 21:00:25'),
(98, 'posr-20210110-091021', 1, 4, 2, 2, 1, 1, 0, 0, 3, 3, 0, 0, NULL, NULL, NULL, NULL, 1, 4, NULL, 3, NULL, NULL, 0, '2021-01-10 09:10:21', '2021-01-10 09:10:21'),
(99, 'posr-20210123-014521', 22, 4, 2, 2, 1, 1, 0, 0, 120, 120, 0, 0, NULL, NULL, NULL, NULL, 1, 4, NULL, 120, NULL, NULL, 0, '2021-01-23 01:45:21', '2021-01-23 01:45:21'),
(100, 'posr-20210124-102158', 22, 4, 2, 2, 1, 1, 0, 0, 104, 104, 0, 0, NULL, NULL, NULL, NULL, 1, 4, NULL, 104, NULL, NULL, 0, '2021-01-24 22:21:58', '2021-01-24 22:21:58'),
(101, 'posr-20210129-061942', 32, 4, 2, 2, 1, 2, 0, 0, 208, 208, 0, 0, NULL, NULL, NULL, NULL, 1, 4, NULL, 208, NULL, NULL, 0, '2021-01-29 06:19:42', '2021-01-29 06:19:42'),
(102, 'posr-20210129-072200', 32, 4, 2, 2, 1, 3, 0, 0, 312, 312, 0, 0, NULL, NULL, NULL, NULL, 1, 4, NULL, 312, NULL, NULL, 0, '2021-01-29 07:22:00', '2021-01-29 07:22:00'),
(103, 'posr-20210129-072224', 32, 4, 2, 2, 1, 1, 0, 0, 104, 104, 0, 0, NULL, NULL, NULL, NULL, 1, 4, NULL, 104, NULL, NULL, 0, '2021-01-29 07:22:24', '2021-01-29 07:22:24'),
(104, 'posr-20210129-072242', 32, 4, 2, 2, 1, 3, 0, 0, 312, 312, 0, 0, NULL, NULL, NULL, NULL, 1, 4, NULL, 312, NULL, NULL, 0, '2021-01-29 07:22:42', '2021-01-29 07:22:42'),
(105, 'posr-20210129-072336', 21, 4, 2, 2, 1, 1, 0, 0, 2, 2, 0, 0, NULL, NULL, NULL, NULL, 1, 4, NULL, 2, NULL, NULL, 0, '2021-01-29 07:23:36', '2021-01-29 07:23:36'),
(106, 'posr-20210129-072355', 21, 4, 2, 2, 1, 3, 0, 0, 312, 312, 0, 0, NULL, NULL, NULL, NULL, 1, 4, NULL, 312, NULL, NULL, 1, '2021-01-29 07:23:55', '2021-01-29 07:23:55');

-- --------------------------------------------------------

--
-- Table structure for table `sellers`
--

CREATE TABLE `sellers` (
  `id` bigint(20) NOT NULL,
  `user_id` int(10) NOT NULL,
  `aacount_type` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `address_1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address_2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` int(10) DEFAULT NULL,
  `state_id` int(10) NOT NULL,
  `district_id` int(10) NOT NULL,
  `zip_code` int(6) NOT NULL,
  `citizennumber` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `panno` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `vatno` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gstno` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `bankaccountname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `bankname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `accountnumber` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `branchname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `business_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `seller_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `company_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `areaofinterest` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `baddress1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `baddress2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bcountry` int(10) DEFAULT NULL,
  `bstate_id` int(10) NOT NULL,
  `bdistrict_id` int(10) NOT NULL,
  `bzipcode` int(7) NOT NULL,
  `panno_image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `citizenship_document` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `passportsizephoto` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gst_document` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `check_image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_kyc_verified` int(1) DEFAULT 0,
  `is_active` int(1) NOT NULL DEFAULT 1,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sellers`
--

INSERT INTO `sellers` (`id`, `user_id`, `aacount_type`, `address_1`, `address_2`, `country`, `state_id`, `district_id`, `zip_code`, `citizennumber`, `panno`, `vatno`, `gstno`, `bankaccountname`, `bankname`, `accountnumber`, `branchname`, `business_name`, `seller_name`, `company_name`, `areaofinterest`, `baddress1`, `baddress2`, `bcountry`, `bstate_id`, `bdistrict_id`, `bzipcode`, `panno_image`, `citizenship_document`, `passportsizephoto`, `gst_document`, `check_image`, `is_kyc_verified`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 32, 'business', '102, N. S. Road, Kolkata  - 700 001', 'kolkata', 1, 35, 633, 712248, '789456', '1245A320', '123456', '123456', 'SAUMEN', 'SBI', '9051', 'SR. BRANCH', 'kOLKATA BAZAR', 'SAUMEN LAHA', 'KOLKATA BAZAR', 'Wholesale Selling to Rollo', '102, N. S. Road, Kolkata  - 700 001', NULL, 1, 35, 633, 712248, 'panno_338589024.jpg', 'citizenship_1997253860.jpg', 'passportsize_1414193662.jpg', 'gst_1012931807.jpg', 'check_293617589.jpg', NULL, 1, '2020-12-28', '2021-01-04'),
(2, 21, 'business', '102, N. S. Road, Kolkata  - 700 001', 'kolkata', 1, 35, 633, 712248, '789456', '1245A320', '123456', '123456', 'SAUMEN', 'SBI', '9051', 'SR. BRANCH', 'kOLKATA BAZAR', 'SAUMEN LAHA', 'KOLKATA BAZAR', 'Wholesale Selling to Rollo', '102, N. S. Road, Kolkata  - 700 001', 'kolkata', 1, 35, 633, 712248, 'panno_1966550697.jpeg', 'citizenship_298378797.jpg', 'passportsize_1389763557.jpg', 'gst_856704810.jpg', 'check_2019128540.jpg', 1, 1, '2021-01-01', '2021-01-01');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` int(8) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `name`) VALUES
(1, 'Andaman and Nicobar (AN)'),
(2, 'Andhra Pradesh (AP)'),
(3, 'Arunachal Pradesh (AR)'),
(4, 'Assam (AS)'),
(5, 'Bihar (BR)'),
(6, 'Chandigarh (CH)'),
(7, 'Chhattisgarh (CG)'),
(8, 'Dadra and Nagar Haveli (DN)'),
(9, 'Daman and Diu (DD)'),
(10, 'Delhi (DL)'),
(11, 'Goa (GA)'),
(12, 'Gujarat (GJ)'),
(13, 'Haryana (HR)'),
(14, 'Himachal Pradesh (HP)'),
(15, 'Jammu and Kashmir (JK)'),
(16, 'Jharkhand (JH)'),
(17, 'Karnataka (KA)'),
(18, 'Kerala (KL)'),
(19, 'Lakshdweep (LD)'),
(20, 'Madhya Pradesh (MP)'),
(21, 'Maharashtra (MH)'),
(22, 'Manipur (MN)'),
(23, 'Meghalaya (ML)'),
(24, 'Mizoram (MZ)'),
(25, 'Nagaland (NL)'),
(26, 'Odisha (OD)'),
(27, 'Puducherry (PY)'),
(28, 'Punjab (PB)'),
(29, 'Rajasthan (RJ)'),
(30, 'Sikkim (SK)'),
(31, 'Tamil Nadu (TN)'),
(32, 'Tripura (TR)'),
(33, 'Uttar Pradesh (UP)'),
(34, 'Uttarakhand (UK)'),
(35, 'West Bengal (WB)');

-- --------------------------------------------------------

--
-- Table structure for table `stock_counts`
--

CREATE TABLE `stock_counts` (
  `id` int(10) UNSIGNED NOT NULL,
  `reference_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `category_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `brand_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `initial_file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `final_file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_adjusted` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stock_counts`
--

INSERT INTO `stock_counts` (`id`, `reference_no`, `warehouse_id`, `category_id`, `brand_id`, `user_id`, `type`, `initial_file`, `final_file`, `note`, `is_adjusted`, `created_at`, `updated_at`) VALUES
(1, 'scr-20200806-093156', 1, NULL, NULL, 1, 'full', '20200806-093156.csv', NULL, NULL, 0, '2020-08-06 16:01:56', '2020-08-06 16:01:56'),
(2, 'scr-20200807-043555', 1, NULL, NULL, 1, 'full', '20200807-043555.csv', NULL, NULL, 0, '2020-08-06 23:05:55', '2020-08-06 23:05:55'),
(3, 'scr-20210111-013603', 2, NULL, NULL, 32, 'full', '20210111-013603.csv', NULL, NULL, 0, '2021-01-11 01:36:03', '2021-01-11 01:36:03'),
(4, 'scr-20210119-115831', 2, NULL, NULL, 32, 'full', '20210119-115831.csv', NULL, NULL, 0, '2021-01-19 23:58:31', '2021-01-19 23:58:31');

-- --------------------------------------------------------

--
-- Table structure for table `stransaction`
--

CREATE TABLE `stransaction` (
  `id` bigint(20) NOT NULL,
  `seller_id` bigint(20) NOT NULL,
  `invoice_id` bigint(20) NOT NULL,
  `invoice_date` date NOT NULL,
  `sale_value` double NOT NULL,
  `commission` double DEFAULT NULL,
  `commission_amt` double DEFAULT NULL,
  `seller_payable_amount` double NOT NULL,
  `seller_pay_status` int(1) NOT NULL DEFAULT 0,
  `payment_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` bigint(10) NOT NULL,
  `user_id` bigint(10) NOT NULL,
  `package_id` int(10) NOT NULL,
  `expire_date` datetime NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `subscriptions`
--

INSERT INTO `subscriptions` (`id`, `user_id`, `package_id`, `expire_date`, `created_at`, `updated_at`) VALUES
(1, 32, 3, '2021-01-31 19:50:51', '2021-01-10', '2021-01-10'),
(3, 33, 5, '2021-02-11 07:49:11', '2021-01-11', '2021-01-11'),
(4, 34, 5, '2021-02-11 09:48:53', '2021-01-11', '2021-01-11'),
(5, 35, 1, '2021-02-11 09:53:04', '2021-01-11', '2021-01-11'),
(6, 21, 5, '2021-02-11 20:26:29', '2021-01-11', '2021-01-11');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vat_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postal_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `image`, `company_name`, `vat_number`, `email`, `phone_number`, `address`, `city`, `state`, `postal_code`, `country`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Amazon', NULL, 'Amazon', NULL, 'taj@hotmail.com', '8767789557', 'kdjkfj', 'black river', NULL, NULL, NULL, 1, '2020-08-14 09:13:53', '2020-08-14 09:13:53');

-- --------------------------------------------------------

--
-- Table structure for table `taxes`
--

CREATE TABLE `taxes` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rate` double NOT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `taxes`
--

INSERT INTO `taxes` (`id`, `name`, `rate`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'GST', 10, 1, '2020-07-26 08:09:09', '2020-07-26 08:09:09');

-- --------------------------------------------------------

--
-- Table structure for table `transfers`
--

CREATE TABLE `transfers` (
  `id` int(10) UNSIGNED NOT NULL,
  `reference_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `from_warehouse_id` int(11) NOT NULL,
  `to_warehouse_id` int(11) NOT NULL,
  `item` int(11) NOT NULL,
  `total_qty` double NOT NULL,
  `total_tax` double NOT NULL,
  `total_cost` double NOT NULL,
  `shipping_cost` double DEFAULT NULL,
  `grand_total` double NOT NULL,
  `document` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` int(10) UNSIGNED NOT NULL,
  `unit_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `base_unit` int(11) DEFAULT NULL,
  `operator` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `operation_value` double DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `unit_code`, `unit_name`, `base_unit`, `operator`, `operation_value`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'pc', 'Piece', NULL, '*', 1, 1, '2018-05-12 02:27:46', '2018-08-17 21:41:53'),
(2, 'dozen', 'dozen box', 1, '*', 12, 1, '2018-05-12 09:57:05', '2018-05-12 09:57:05'),
(3, 'cartoon', 'cartoon box', 1, '*', 24, 1, '2018-05-12 09:57:45', '2020-03-11 10:36:59'),
(4, 'm', 'meter', NULL, '*', 1, 1, '2018-05-12 09:58:07', '2018-05-27 23:20:57'),
(6, 'test', 'test', NULL, '*', 1, 0, '2018-05-27 23:20:20', '2018-05-27 23:20:25'),
(7, 'kg', 'kilogram', NULL, '*', 1, 1, '2018-06-25 00:49:26', '2018-06-25 00:49:26'),
(8, '20', 'ni33', 8, '*', 1, 0, '2018-07-31 22:35:51', '2018-07-31 22:40:54'),
(9, 'gm', 'gram', 7, '*', 1000, 1, '2018-09-01 00:06:28', '2020-07-29 11:17:15'),
(10, 'gz', 'goz', NULL, '*', 1, 0, '2018-11-29 03:40:29', '2019-03-02 11:53:29'),
(11, 'BOX', 'Box 10', 1, '*', 10, 0, '2020-07-27 10:24:18', '2020-07-28 10:36:57'),
(12, 'Test 2', 'Test 10', 1, '*', 10, 0, '2020-07-28 10:35:57', '2020-07-28 10:36:48'),
(13, 'cartoon10', 'cartoon10', 1, '*', 10, 1, '2020-07-29 11:16:52', '2020-07-29 11:16:52'),
(14, 'Singlebox', 'Singlebox', 1, '*', 20, 1, '2020-07-29 12:56:56', '2020-07-29 12:56:56'),
(15, 'Box100', 'Box100', 1, '*', 100, 1, '2020-08-07 20:33:05', '2020-08-07 20:33:05');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` int(11) NOT NULL,
  `biller_id` int(11) DEFAULT NULL,
  `warehouse_id` int(11) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  `is_supersdmin` int(2) NOT NULL DEFAULT 0,
  `seller_url` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `phone`, `company_name`, `role_id`, `biller_id`, `warehouse_id`, `is_active`, `is_deleted`, `is_supersdmin`, `seller_url`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$DWAHTfjcvwCpOCXaJg11MOhsqns03uvlwiSUOQwkHL2YYrtrXPcL6', 'Mb4k734zdP149dEZDCSTruoYglTwIb9ltd72ckexzZrrliv5cHXXHxZrznla', '12112', 'Sunshiene Softech', 8, 2, 2, 1, 0, 0, NULL, '2018-06-02 03:24:15', '2020-07-08 15:59:06'),
(3, 'dhiman da', 'dhiman@gmail.com', '$2y$10$Fef6vu5E67nm11hX7V5a2u1ThNCQ6n9DRCvRF9TD7stk.Pmt2R6O.', '5ehQM6JIfiQfROgTbB5let0Z93vjLHS7rd9QD5RPNgOxli3xdo7fykU7vtTt', '212', 'lioncoders', 1, NULL, NULL, 1, 0, 0, NULL, '2018-06-13 22:00:31', '2018-12-25 03:47:07'),
(6, 'test', 'test@gmail.com', '$2y$10$TDAeHcVqHyCmurki0wjLZeIl1SngKX3WLOhyTiCoZG3souQfqv.LS', 'KpW1gYYlOFacumklO2IcRfSsbC3KcWUZzOI37gqoqM388Xie6KdhaOHIFEYm', '1234', '212312', 4, NULL, NULL, 0, 1, 0, NULL, '2018-06-23 03:05:33', '2018-06-23 03:13:45'),
(8, 'test', 'test@yahoo.com', '$2y$10$hlMigidZV0j2/IPkgE/xsOSb8WM2IRlsMv.1hg1NM7kfyd6bGX3hC', NULL, '31231', NULL, 4, NULL, NULL, 0, 1, 0, NULL, '2018-06-24 22:35:49', '2018-07-02 01:07:39'),
(9, 'staff', 'anda@gmail.com', '$2y$10$kxDbnynB6mB1e1w3pmtbSOlSxy/WwbLPY5TJpMi0Opao5ezfuQjQm', 'itFKIPTtkJeAiI5SEb43LwEyNYKUDjxmsFe8AdwlGPF7bGGL774stPWOoSFt', '3123', NULL, 4, 2, 2, 1, 0, 0, NULL, '2018-07-02 01:08:08', '2020-08-18 12:33:52'),
(10, 'abul', 'abul@alpha.com', '$2y$10$5zgB2OOMyNBNVAd.QOQIju5a9fhNnTqPx5H6s4oFlXhNiF6kXEsPq', 'x7HlttI5bM0vSKViqATaowHFJkLS3PHwfvl7iJdFl5Z1SsyUgWCVbLSgAoi0', '1234', 'anda', 1, NULL, NULL, 0, 0, 0, NULL, '2018-09-07 23:44:48', '2018-09-07 23:44:48'),
(11, 'teststaff', 'a@a.com', '$2y$10$5KNBIIhZzvvZEQEhkHaZGu.Q8bbQNfqYvYgL5N55B8Pb4P5P/b/Li', 'DkHDEcCA0QLfsKPkUK0ckL0CPM6dPiJytNa0k952gyTbeAyMthW3vi7IRitp', '111', 'aa', 4, 5, 1, 0, 1, 0, NULL, '2018-10-22 02:47:56', '2018-10-23 02:10:56'),
(12, 'john', 'john@gmail.com', '$2y$10$P/pN2J/uyTYNzQy2kRqWwuSv7P2f6GE/ykBwtHdda7yci3XsfOKWe', 'O0f1WJBVjT5eKYl3Js5l1ixMMtoU6kqrH7hbHDx9I1UCcD9CmiSmCBzHbQZg', '10001', NULL, 4, 2, 2, 0, 1, 0, NULL, '2018-12-30 00:48:37', '2019-03-06 04:59:49'),
(13, 'jjj', 'test@test.com', '$2y$10$/Qx3gHWYWUhlF1aPfzXaCeZA7fRzfSEyCIOnk/dcC4ejO8PsoaalG', NULL, '1213', NULL, 1, NULL, NULL, 0, 1, 0, NULL, '2019-01-03 00:08:31', '2019-03-03 04:02:29'),
(16, 'admin1', 'test_user@gmail.com', '$2y$10$OrUIexU4K1zMNdvlFjW8D.506aJFw0P8S.DO3qRridM7bT0PbMERG', 'kSx0v0ex8XtowvjhIsH7uB3cKD1sI3RRCeGv4UdBCp9XbejlF9IteIIEBoWl', '12112', 'Sunshiene Softech', 1, NULL, NULL, 1, 0, 0, NULL, '2018-06-02 03:24:15', '2020-07-08 15:59:06'),
(17, 'Belkmouf', 'belkmouf@gmail.com', '$2y$10$D6VWMVhVLafPMLte7c8n7.4w/SofhyFmQ7oPtQAwvsavBPEbhuo1i', 'WSRLGAbB76OMtnpFqxMog2cyFS4qG3tfk8LTjJNkpGPAm0JMu8q1zKzehEHt', '966563662778', 'Mobily', 1, 1, 1, 0, 0, 0, NULL, '2020-07-25 00:30:19', '2020-07-25 00:30:19'),
(18, 'rafiq', 'rafiqaust@gmail.com', '$2y$10$ZC.7cTp4W2hsPpMRGYxQw.e78ouyOmG3vI6UbAa119jFe2u05x.Pq', 'w1VVPw2kc0yTLzWSarWqSTIvPEuppx7s9zh1xAJhesRmCk7Fqr2iMAjCVePh', '0433825718', NULL, 4, NULL, 1, 0, 1, 0, NULL, '2020-07-26 05:55:46', '2020-08-06 17:06:23'),
(19, 'aminula', 'aminul@gmail.com', '$2y$10$4ldG4c7Bl9tbAWpos.dKgOeDlPwTgPJaIHg3TxphYXa/PggupQzvK', NULL, '12345678', NULL, 2, NULL, NULL, 0, 1, 0, NULL, '2020-07-26 08:10:36', '2020-08-06 17:06:44'),
(20, 'akshay', 'a@gmail.com', '$2y$10$AfCM42wd64G.zDNLaEv45.QT3.9viKM4nbLNZkDAIcJ7cYlky2ww6', 'VcV3H7tOh7EkM3vzt7mr77cNw5arOlU2vJ3iSenc2uyJYTT5rIesYypEScVE', '1234567890', 'SUN SHINE IT SOLUTION', 4, 2, 2, 1, 0, 0, NULL, '2020-08-12 15:46:45', '2020-08-14 16:32:43'),
(21, 'abc', 'aadb@a.com', '$2y$10$xEHkqrnHrKg97IduZSJZWe3yp0qqalUqrtIpqnsTMs1zIRYYChGaq', 'OP4dUPzQmHK2nbZbvv05ZbHAHYQNLfif6UugDg48n5KaPwvU0zhUwnMaHKir', '8542106642', 'KOLKATA BAZAR', 7, NULL, NULL, 1, 0, 0, NULL, '2020-12-16 10:42:02', '2021-01-01 09:48:54'),
(22, 'superadmin', 'supperadmin@admin.com', '$2y$10$NLo4BFzgucyQqzO5HSUYB.gmA.pC1KnbyS7OnX5LYlsrFU0yIPk/a', 'PKl2A05NwZDBQpFYOanSDbKc8Q34xtToTkRNBvl4ZCWmtmY7qMrm9lGgiNUN', '8542106642', 'Sun Shine Pos', 8, 2, 2, 1, 0, 1, NULL, '2020-12-16 19:30:25', '2020-12-16 19:30:25'),
(23, 'seller one', 'sellerone@sellerone.com', '$2y$10$ztedP0bEYypeD2sg0Blha.pj0tFb9bJIwGBbGg5o8DJrWf5Rcuzqq', 'XFqmMvxIDaA3HTWamCG6M1s5wl7FEKzxPFFiwukj1WooQPmZhbiDm9T3cEZY', '0987654321', 'Seller One', 7, NULL, NULL, 0, 0, 0, NULL, '2020-12-17 00:05:40', '2020-12-17 00:05:40'),
(24, 'subadmin', 'sub@gmail.com', '$2y$10$hTZYZOyN3wnUeE0WwHb67./3p6jAWgtvpscNSNg4tBmcPXEsVkfjK', 'N1OdpoHZ1teaIWNDcXV3fjKFgpWZuAaTeu0z2UYg93ImLhVe7uFIbtoq2LIR', '12345556889898', 'SUN SHINE IT SOLUTION', 7, NULL, NULL, 0, 0, 0, NULL, '2020-12-17 18:34:25', '2020-12-17 18:34:25'),
(25, 'sanjay', 'san@gmail.com', '$2y$10$dDo99/CYLMjfC7wqWs3GgOy.jeWro4vGdgoqUBmCF/zmPglgE6GH.', 'MzjjZ2tJep3LphX0spBlWVZoHxwfigBP3PkSgJPQSzZbJ1G6AUIFeKNNpPBr', '6546465465465', 'SUN SHINE IT SOLUTION', 7, NULL, NULL, 0, 0, 0, NULL, '2020-12-23 03:38:36', '2020-12-23 03:38:36'),
(32, 'saumen', 'saumen08laha@gmail.com', '$2y$10$dtz2VAPq0A1xH/qSLZrMGu0nYbO4dBMJ.5sRvEJeRUfmt.ZL13cSK', 'zjtmqOLF0vRBNDl0QjjJFQoORFUMDNAxMEocN5bDwEaEw6h3ZVfXpxID4los', '9051181895', 'KOLKATA BAZAR', 7, NULL, NULL, 1, 0, 0, NULL, '2020-12-28 01:40:09', '2021-01-01 09:30:14'),
(33, 'samiran', 'info@xlinkinfocom.com', '$2y$10$xnSSh8iNPmN/./lfvJRnQ..txd.XQpdiw398i0wHOG19g/GuFJaHS', '8zuqijVzYtKy65i4EN9KPRUFt0wwWs64ivbrFHxN9bzgufsG1qaikxrLNlcH', '9051181895', 'kolkata Bazar', 7, NULL, NULL, 1, 0, 0, NULL, '2020-12-28 02:21:18', '2020-12-28 02:21:18'),
(34, 'abczyz', 'abcxyz@gmail.com', '$2y$10$k9MA0P92YT5ECSkzejDQF.5ypXNwS1nlhDsn5eK3Z0BU0PD6N3w42', 'MG0Qfo6woagtIXbMEPf9EFHazteeRek6whqUD41bUdxCiK2I9CbQTIkMmwvs', '9874563210', 'abcxyz', 7, NULL, NULL, 1, 0, 0, NULL, '2020-12-28 02:22:45', '2020-12-28 02:22:45'),
(35, 'Seller1', 'seller@gmail.com', '$2y$10$y/1wGcZXDlZYd9zgdiqNoukEug.mCNMq0Sp4QAP.TQ3SHUXIsOTA.', 'tDrgBFUvoDAjrD3RUHBEKXaVcXptcfOT8aDfhlOIyVjfI1eL0X9zzRdEXhXa', '4849879879', 'Seller', 7, NULL, NULL, 1, 0, 0, NULL, '2020-12-29 19:43:14', '2020-12-29 19:43:14'),
(36, 'optus', 'countryroadnepal@gmail.com', '$2y$10$xcLd6.Ud28vO8HDMFeJzXOPhlRyaM5uNOYGFyb2D5WpiS9WEvWByW', '7w7mHsbZj9WZgFQDxmIYPebkK0VwJoXz1a6Ups3JiSYuvtWhFEgrZzI5SzUT', '9810470805', 'optus', 7, NULL, NULL, 1, 0, 0, NULL, '2020-12-29 20:00:02', '2020-12-29 20:00:02'),
(37, 'seller12', 'sw@gmail.com', '$2y$10$LazlMo5E2xpLEHHR4nHLDeu/Iw09bPsgMAMRSIrG1JFaFqvqzjbfW', 'QWevhfG2sSwmZLzaQzfprchKrOVudGnLwa0nHrRQIDBxTpkv0mB1sii778fY', '897653210', 'Swe@', 7, NULL, NULL, 1, 0, 0, NULL, '2020-12-30 22:02:55', '2020-12-30 22:02:55'),
(38, 'Bikash', 'bikash@gmail.com', '$2y$10$CVoC4RPXbjVj4MSnQSxv1.Gk.g1Nq7sG.TTrLaIyfVWJteS4tFrxO', 'Z1soCn4JnjsdQjlNOVfOMZbHFbywbG2pcmq3ioI81qfGFmnhxbUpBE1OZEpm', '9051181895', 'Bikash', 7, NULL, NULL, 1, 0, 0, NULL, '2021-01-08 18:51:41', '2021-01-08 18:51:41'),
(39, 'Krishna Dutta', 'krish@gmail.com', '$2y$10$n7TlhJm0SX0nQXg1YIWnzuKXnqlgOsSU41ZV2I9V1AmYO9wI/W2hG', '3UhZFgzTXTsVCKy3lYImhuJD2aK6gPfgoc1rsWnQQUVzqIvWCafl7CTojhvp', '9051181895', 'Big Bazar', 7, NULL, NULL, 1, 0, 0, NULL, '2021-01-13 02:26:06', '2021-01-13 02:26:06'),
(40, 'Subrata', 'subratasah@gmail.com', '$2y$10$o3BkSn9diCr.eHuHAOA4YeW1dlbKQBsap4m/rFIHL3OCUSqTso1qy', '20MxISn3mBhmiBIGZWsDOYOgAPp6Ny8ECSifMcCLUWrWsVPK3Cli6QfD6ABo', '9163550175', 'Xlinkinfocom', 8, 2, 2, 1, 0, 1, NULL, '2021-01-29 22:47:22', '2021-01-29 22:47:22');

-- --------------------------------------------------------

--
-- Table structure for table `variants`
--

CREATE TABLE `variants` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `variants`
--

INSERT INTO `variants` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'pepperoni', '2020-07-31 20:45:21', '2020-07-31 20:45:21'),
(2, 'jamon', '2020-07-31 20:45:21', '2020-07-31 20:45:21'),
(3, 'salami', '2020-07-31 20:45:21', '2020-07-31 20:45:21'),
(4, 'salchicha', '2020-07-31 20:45:21', '2020-07-31 20:45:21'),
(5, 'chorizo', '2020-07-31 20:45:21', '2020-07-31 20:45:21');

-- --------------------------------------------------------

--
-- Table structure for table `warehouses`
--

CREATE TABLE `warehouses` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `warehouses`
--

INSERT INTO `warehouses` (`id`, `name`, `phone`, `email`, `address`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Main Store', '12345678', NULL, '123 Macedon', 0, '2020-07-26 08:08:13', '2020-08-08 05:11:00'),
(2, 'Bengal Store', '0416263177', 'begalstore2020@gmail.com', '19 Dobell Road, Claymore.', 1, '2020-08-08 05:13:09', '2020-08-08 05:13:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `adjustments`
--
ALTER TABLE `adjustments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `billers`
--
ALTER TABLE `billers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `commission_log`
--
ALTER TABLE `commission_log`
  ADD PRIMARY KEY (`commission_log_id`);

--
-- Indexes for table `commission_mst`
--
ALTER TABLE `commission_mst`
  ADD PRIMARY KEY (`commission_id`),
  ADD KEY `credit_package_log_id` (`commission_log_id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `credit_package_log`
--
ALTER TABLE `credit_package_log`
  ADD PRIMARY KEY (`credit_package_log_id`);

--
-- Indexes for table `credit_package_mst`
--
ALTER TABLE `credit_package_mst`
  ADD PRIMARY KEY (`credit_package_id`),
  ADD KEY `credit_package_log_id` (`credit_package_log_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_groups`
--
ALTER TABLE `customer_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deliveries`
--
ALTER TABLE `deliveries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deposits`
--
ALTER TABLE `deposits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expense_categories`
--
ALTER TABLE `expense_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `general_settings`
--
ALTER TABLE `general_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gift_cards`
--
ALTER TABLE `gift_cards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gift_card_recharges`
--
ALTER TABLE `gift_card_recharges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `holidays`
--
ALTER TABLE `holidays`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hrm_settings`
--
ALTER TABLE `hrm_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `money_transfers`
--
ALTER TABLE `money_transfers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_with_cheque`
--
ALTER TABLE `payment_with_cheque`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_with_credit_card`
--
ALTER TABLE `payment_with_credit_card`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_with_gift_card`
--
ALTER TABLE `payment_with_gift_card`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_with_paypal`
--
ALTER TABLE `payment_with_paypal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_with_subscripe`
--
ALTER TABLE `payment_with_subscripe`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payrolls`
--
ALTER TABLE `payrolls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pos_setting`
--
ALTER TABLE `pos_setting`
  ADD UNIQUE KEY `pos_setting_id_unique` (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_adjustments`
--
ALTER TABLE `product_adjustments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_purchases`
--
ALTER TABLE `product_purchases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_quotation`
--
ALTER TABLE `product_quotation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_returns`
--
ALTER TABLE `product_returns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_sales`
--
ALTER TABLE `product_sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_transfer`
--
ALTER TABLE `product_transfer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_variants`
--
ALTER TABLE `product_variants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_warehouse`
--
ALTER TABLE `product_warehouse`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_product_return`
--
ALTER TABLE `purchase_product_return`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quick_product_sales`
--
ALTER TABLE `quick_product_sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quick_sales`
--
ALTER TABLE `quick_sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quotations`
--
ALTER TABLE `quotations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `returns`
--
ALTER TABLE `returns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `return_purchases`
--
ALTER TABLE `return_purchases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sellers`
--
ALTER TABLE `sellers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_counts`
--
ALTER TABLE `stock_counts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stransaction`
--
ALTER TABLE `stransaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `taxes`
--
ALTER TABLE `taxes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transfers`
--
ALTER TABLE `transfers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `variants`
--
ALTER TABLE `variants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `warehouses`
--
ALTER TABLE `warehouses`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `adjustments`
--
ALTER TABLE `adjustments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `billers`
--
ALTER TABLE `billers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `commission_log`
--
ALTER TABLE `commission_log`
  MODIFY `commission_log_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `commission_mst`
--
ALTER TABLE `commission_mst`
  MODIFY `commission_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `credit_package_log`
--
ALTER TABLE `credit_package_log`
  MODIFY `credit_package_log_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `credit_package_mst`
--
ALTER TABLE `credit_package_mst`
  MODIFY `credit_package_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `customer_groups`
--
ALTER TABLE `customer_groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `deliveries`
--
ALTER TABLE `deliveries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `deposits`
--
ALTER TABLE `deposits`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expense_categories`
--
ALTER TABLE `expense_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `general_settings`
--
ALTER TABLE `general_settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `gift_cards`
--
ALTER TABLE `gift_cards`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `gift_card_recharges`
--
ALTER TABLE `gift_card_recharges`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `holidays`
--
ALTER TABLE `holidays`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hrm_settings`
--
ALTER TABLE `hrm_settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `money_transfers`
--
ALTER TABLE `money_transfers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `payment_with_cheque`
--
ALTER TABLE `payment_with_cheque`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_with_credit_card`
--
ALTER TABLE `payment_with_credit_card`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_with_gift_card`
--
ALTER TABLE `payment_with_gift_card`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_with_paypal`
--
ALTER TABLE `payment_with_paypal`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_with_subscripe`
--
ALTER TABLE `payment_with_subscripe`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payrolls`
--
ALTER TABLE `payrolls`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `product_adjustments`
--
ALTER TABLE `product_adjustments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product_purchases`
--
ALTER TABLE `product_purchases`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `product_quotation`
--
ALTER TABLE `product_quotation`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_returns`
--
ALTER TABLE `product_returns`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_sales`
--
ALTER TABLE `product_sales`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `product_transfer`
--
ALTER TABLE `product_transfer`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_variants`
--
ALTER TABLE `product_variants`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product_warehouse`
--
ALTER TABLE `product_warehouse`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `purchase_product_return`
--
ALTER TABLE `purchase_product_return`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quick_product_sales`
--
ALTER TABLE `quick_product_sales`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `quick_sales`
--
ALTER TABLE `quick_sales`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `quotations`
--
ALTER TABLE `quotations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `returns`
--
ALTER TABLE `returns`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `return_purchases`
--
ALTER TABLE `return_purchases`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `sellers`
--
ALTER TABLE `sellers`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `stock_counts`
--
ALTER TABLE `stock_counts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `stransaction`
--
ALTER TABLE `stransaction`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `taxes`
--
ALTER TABLE `taxes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transfers`
--
ALTER TABLE `transfers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `variants`
--
ALTER TABLE `variants`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `warehouses`
--
ALTER TABLE `warehouses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
