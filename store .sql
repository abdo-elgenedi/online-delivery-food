-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 18, 2021 at 02:55 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `store`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `dob` date DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `photo` varchar(50) DEFAULT 'admin.jpg',
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `fullname`, `username`, `password`, `email`, `phone`, `dob`, `address`, `photo`, `created_at`, `updated_at`) VALUES
(1, 'Abdelrhman Kamal Genedi', 'abdoelgenedi', '$2y$10$27VMyxrGxSrEw483y/TAzutBH8cKaMT/vkFcEf.wxpzkPO/JOiQqm', 'abdoelgenedi@gmail.com', '01150911573', '1996-06-10', 'Bnei-suef', '1602602041.jpg', '2020-10-03', '2021-02-11');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`) VALUES
(6, 'giza');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` int(11) UNSIGNED NOT NULL,
  `total_price` float NOT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `vendor_id` int(11) UNSIGNED DEFAULT NULL,
  `address` text NOT NULL,
  `notes` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `total_price`, `user_id`, `vendor_id`, `address`, `notes`, `status`, `created_at`, `updated_at`) VALUES
(4, 532, 1, 13, 'الامريكيه برج2 - فوق كشري التحرير - الدور التالت - شقه 36', 'شطه ودقه', 4, '2021-02-08 18:49:36', '2021-02-08 18:49:36'),
(5, 824, 1, 13, 'الامريكيه برج2 - فوق كشري التحرير - الدور التالت - شقه 36', 'خبز زياده من فضلك', 0, '2021-02-09 13:15:25', '2021-02-09 13:15:25'),
(6, 678, 1, 13, 'الامريكيه برج2 - فوق كشري التحرير - الدور التالت - شقه 36', 'dsfsd', 0, '2021-02-09 15:48:46', '2021-02-09 15:48:46'),
(7, 678, 1, 13, 'الامريكيه برج2 - فوق كشري التحرير - الدور التالت - شقه 36', 'زياده كاتشب', 3, '2021-02-09 16:58:20', '2021-02-09 16:58:20'),
(8, 470, 1, 13, 'الامريكيه برج2 - فوق كشري التحرير - الدور التالت - شقه 36', 'ببلبال', 4, '2021-02-09 17:47:51', '2021-02-09 17:47:51'),
(9, 174, 1, 13, 'الامريكيه برج2 - فوق كشري التحرير - الدور التالت - شقه 36', 'dfdfd', 1, '2021-02-10 12:43:36', '2021-02-10 12:43:36'),
(10, 247, 1, 24, 'الامريكيه برج2 - فوق كشري التحرير - الدور التالت - شقه 36', 'gfdgh', 4, '2021-02-10 17:03:50', '2021-02-11 09:26:07'),
(11, 225, 1, 24, 'الامريكيه برج2 - فوق كشري التحرير - الدور التالت - شقه 36', 'sdfgfg', 4, '2021-02-10 17:04:49', '2021-02-11 09:42:47'),
(12, 625.5, 1, 24, 'الامريكيه برج2 - فوق كشري التحرير - الدور التالت - شقه 36', 'ghygyig', 0, '2021-02-10 17:05:43', '2021-02-11 09:28:59'),
(13, 120, 1, 24, 'fgf', 'fg', 4, '2021-02-11 14:02:38', '2021-02-11 14:25:54'),
(14, 528, 1, 13, 'الامريكيه برج2 - فوق كشري التحرير - الدور التالت - شقه 36', 'زود الشطه', 1, '2021-02-17 16:24:38', '2021-02-17 16:24:38'),
(15, 148.5, 1, 24, 'الامريكيه برج2 - فوق كشري التحرير - الدور التالت - شقه 36', 'tr', 4, '2021-02-17 16:26:21', '2021-02-17 14:27:09');

-- --------------------------------------------------------

--
-- Table structure for table `main_categories`
--

CREATE TABLE `main_categories` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(150) NOT NULL,
  `photo` varchar(150) DEFAULT 'maincategory.jpg',
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `main_categories`
--

INSERT INTO `main_categories` (`id`, `name`, `photo`, `active`, `created_at`, `updated_at`) VALUES
(76, 'foods', '1603293866.jpg', 1, NULL, '2021-02-11 10:26:15'),
(223, 'sandwitches', 'GkJdMhzS0g3JOPOqNwsMby8WLQUvnNmV0BN2bz3V.png', 1, NULL, '2021-02-11 10:27:17'),
(227, 'oriental dishes', 'maincategory.jpg', 1, '2021-02-11 10:37:41', '2021-02-11 10:38:06');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `product_id` int(11) UNSIGNED NOT NULL,
  `invoice_id` int(11) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `product_id`, `invoice_id`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 9, 4, 3, '2021-02-08 16:49:36', '2021-02-08 16:49:36'),
(2, 12, 4, 1, '2021-02-08 16:49:36', '2021-02-08 16:49:36'),
(3, 16, 4, 1, '2021-02-08 16:49:36', '2021-02-08 16:49:36'),
(4, 5, 4, 1, '2021-02-08 16:49:36', '2021-02-08 16:49:36'),
(5, 6, 4, 1, '2021-02-08 16:49:36', '2021-02-08 16:49:36'),
(6, 9, 5, 1, '2021-02-09 11:15:25', '2021-02-09 11:15:25'),
(7, 12, 5, 2, '2021-02-09 11:15:25', '2021-02-09 11:15:25'),
(8, 14, 5, 1, '2021-02-09 11:15:25', '2021-02-09 11:15:25'),
(9, 16, 5, 1, '2021-02-09 11:15:25', '2021-02-09 11:15:25'),
(10, 5, 5, 1, '2021-02-09 11:15:25', '2021-02-09 11:15:25'),
(11, 6, 5, 1, '2021-02-09 11:15:25', '2021-02-09 11:15:25'),
(12, 10, 5, 1, '2021-02-09 11:15:25', '2021-02-09 11:15:25'),
(13, 11, 5, 1, '2021-02-09 11:15:25', '2021-02-09 11:15:25'),
(14, 14, 6, 1, '2021-02-09 13:48:46', '2021-02-09 13:48:46'),
(15, 16, 6, 1, '2021-02-09 13:48:46', '2021-02-09 13:48:46'),
(16, 5, 6, 1, '2021-02-09 13:48:46', '2021-02-09 13:48:46'),
(17, 6, 6, 1, '2021-02-09 13:48:46', '2021-02-09 13:48:46'),
(18, 10, 6, 1, '2021-02-09 13:48:46', '2021-02-09 13:48:46'),
(19, 11, 6, 1, '2021-02-09 13:48:46', '2021-02-09 13:48:46'),
(20, 9, 6, 2, '2021-02-09 13:48:46', '2021-02-09 13:48:46'),
(21, 14, 7, 1, '2021-02-09 14:58:20', '2021-02-09 14:58:20'),
(22, 16, 7, 1, '2021-02-09 14:58:20', '2021-02-09 14:58:20'),
(23, 5, 7, 1, '2021-02-09 14:58:20', '2021-02-09 14:58:20'),
(24, 6, 7, 1, '2021-02-09 14:58:20', '2021-02-09 14:58:20'),
(25, 10, 7, 1, '2021-02-09 14:58:20', '2021-02-09 14:58:20'),
(26, 11, 7, 1, '2021-02-09 14:58:20', '2021-02-09 14:58:20'),
(27, 9, 7, 2, '2021-02-09 14:58:20', '2021-02-09 14:58:20'),
(28, 12, 8, 1, '2021-02-09 15:47:51', '2021-02-09 15:47:51'),
(29, 14, 8, 1, '2021-02-09 15:47:51', '2021-02-09 15:47:51'),
(30, 16, 8, 1, '2021-02-09 15:47:51', '2021-02-09 15:47:51'),
(31, 5, 8, 1, '2021-02-09 15:47:51', '2021-02-09 15:47:51'),
(32, 6, 8, 1, '2021-02-09 15:47:51', '2021-02-09 15:47:51'),
(33, 9, 9, 1, '2021-02-10 10:43:36', '2021-02-10 10:43:36'),
(34, 12, 9, 1, '2021-02-10 10:43:36', '2021-02-10 10:43:36'),
(35, 21, 10, 2, '2021-02-10 15:03:50', '2021-02-10 15:03:50'),
(36, 20, 10, 2, '2021-02-10 15:03:50', '2021-02-10 15:03:50'),
(37, 20, 11, 1, '2021-02-10 15:04:49', '2021-02-10 15:04:49'),
(38, 18, 11, 1, '2021-02-10 15:04:49', '2021-02-10 15:04:49'),
(39, 22, 11, 1, '2021-02-10 15:04:49', '2021-02-10 15:04:49'),
(40, 18, 12, 2, '2021-02-10 15:05:43', '2021-02-10 15:05:43'),
(41, 20, 12, 5, '2021-02-10 15:05:43', '2021-02-10 15:05:43'),
(42, 21, 12, 2, '2021-02-10 15:05:43', '2021-02-10 15:05:43'),
(43, 22, 12, 2, '2021-02-10 15:05:43', '2021-02-10 15:05:43'),
(44, 21, 13, 1, '2021-02-11 12:02:38', '2021-02-11 12:02:38'),
(45, 9, 14, 2, '2021-02-17 14:24:38', '2021-02-17 14:24:38'),
(46, 12, 14, 2, '2021-02-17 14:24:38', '2021-02-17 14:24:38'),
(47, 14, 14, 1, '2021-02-17 14:24:38', '2021-02-17 14:24:38'),
(48, 16, 14, 1, '2021-02-17 14:24:38', '2021-02-17 14:24:38'),
(49, 21, 15, 1, '2021-02-17 14:26:21', '2021-02-17 14:26:21'),
(50, 20, 15, 1, '2021-02-17 14:26:21', '2021-02-17 14:26:21');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `vendor_id` int(11) UNSIGNED NOT NULL,
  `sub_category` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `price` float NOT NULL,
  `photo` varchar(100) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `vendor_id`, `sub_category`, `status`, `price`, `photo`, `updated_at`, `created_at`) VALUES
(5, 'fried  chicken', '4-pieces fried chicken , pepsi can, salad,1-bread', 13, 24, 1, 50, 'product.jpg', '2021-01-25 16:48:32', '2021-01-25 16:48:32'),
(6, '7 october', '4-pieces fried chicken , pepsi can, salad,1-bread ghdgfhdghgdhgd', 13, 24, 1, 100, 'product.jpg', '2021-01-25 17:33:58', '2021-01-25 16:49:14'),
(9, '6 october', 'dfgfgf', 13, 9, 1, 54, 'product.jpg', '2021-01-25 17:48:47', '2021-01-25 17:29:00'),
(10, 'burger', '4-pieces fried chicken , pepsi can, salad,1-bread ghdgfhdghgdhgd', 13, 24, 1, 100, 'product.jpg', '2021-01-25 17:33:58', '2021-01-25 16:49:14'),
(11, 'burger', '4-pieces fried chicken , pepsi can, salad,1-bread ghdgfhdghgdhgd', 13, 24, 1, 100, 'product.jpg', '2021-01-25 17:33:58', '2021-01-25 16:49:14'),
(12, 'burger', '4-pieces fried chicken , pepsi can, salad,1-bread ghdgfhdghgdhgd', 13, 9, 1, 100, 'product.jpg', '2021-01-25 17:33:58', '2021-01-25 16:49:14'),
(13, 'burger', '4-pieces fried chicken , pepsi can, salad,1-bread ghdgfhdghgdhgd', 13, 24, 1, 100, 'product.jpg', '2021-01-25 17:33:58', '2021-01-25 16:49:14'),
(14, 'burger', '4-pieces fried chicken , pepsi can, salad,1-bread ghdgfhdghgdhgd', 13, 9, 1, 100, 'product.jpg', '2021-01-25 17:33:58', '2021-01-25 16:49:14'),
(15, 'burger', '4-pieces fried chicken , pepsi can, salad,1-bread ghdgfhdghgdhgd', 13, 24, 1, 100, 'product.jpg', '2021-01-25 17:33:58', '2021-01-25 16:49:14'),
(16, 'burger', '4-pieces fried chicken , pepsi can, salad,1-bread ghdgfhdghgdhgd', 13, 9, 1, 100, 'product.jpg', '2021-01-25 17:33:58', '2021-01-25 16:49:14'),
(17, 'burger', '4-pieces fried chicken , pepsi can, salad,1-bread ghdgfhdghgdhgd', 13, 24, 1, 100, 'product.jpg', '2021-01-25 17:33:58', '2021-01-25 16:49:14'),
(18, 'pizza meat (Large)', 'large pizza (meat), 3 Ketchup , 1 Pepsi', 24, 29, 1, 90, '241612975694PCDLVVHYOZMgKCjSPGkv4bhFVo5FFlrQDxUrntnj.jpeg', '2021-02-10 14:48:14', '2021-02-10 14:40:32'),
(20, 'shawarma', 'shawarma sandwich , tahina , pepsi', 24, 28, 1, 28.5, '2416129764235egyTGuzjUujtvB1L1KFM5VES64X2lly9Z7b6jnl.jpeg', '2021-02-10 15:00:23', '2021-02-10 15:00:23'),
(21, 'Fatah shawarma', 'Fatah shawarma  , fries , pickled , bread', 24, 27, 1, 70, '241612976504l0m9CMG8Nc32McFQoVC3ocy0mqtNd93HYq25Pd0I.jpeg', '2021-02-10 15:01:44', '2021-02-10 15:01:44'),
(22, 'meat pie', 'meat pie , pickles , tahina , Marinda', 24, 30, 1, 56.5, '241612976560c7AbTND4iVpsBUyRwiPGhcT8kiCq2y3Eqo93GKPx.jpeg', '2021-02-10 15:02:40', '2021-02-10 15:02:40');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `city_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `name`, `city_id`) VALUES
(4, 'october', 6);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `username` varchar(100) CHARACTER SET utf8 NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `mobile` varchar(50) CHARACTER SET utf8 NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `image` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `mobile`, `email_verified_at`, `password`, `status`, `image`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'abdo elgenedi', 'abdo_elegendi', 'abdoelgenedi@gmail.com', '01150911573', NULL, '$2y$10$mk3zbEUVbCdqctrd8FDhBuFBHo05p6.b45XPVr9LpE.kQzLP7tX.y', 1, 'abdo_elegendikWKYiDZVwQKNtQZ8VjJMpIJkCuL2IwU4SQcU2See.jpeg', 'o5f4pnyShaXl8Y5Wk746i77apVGcU5TipCShXd8EdwvXCvHGSarVOultAjvo', '2021-01-26 15:06:53', '2021-02-17 10:25:36'),
(2, 'abdo elgenedi', 'abdo_elegendid', 'abdoelgenedid@gmail.com', '01150911576', NULL, '$2y$10$mk3zbEUVbCdqctrd8FDhBuFBHo05p6.b45XPVr9LpE.kQzLP7tX.y', 1, 'customer.jpg', 'fMH9CK6PJSe7eS80EeooEG9sah0Bxb1A6v3pIhmg1gURS1ZFpKUFXeBK7HOs', '2021-01-26 15:06:53', '2021-02-11 11:48:15');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(150) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `mobile` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `logo` varchar(200) NOT NULL DEFAULT 'vendor.jpg',
  `status` tinyint(1) NOT NULL DEFAULT -1,
  `city_id` int(11) DEFAULT NULL,
  `state_id` int(11) DEFAULT NULL,
  `delivery_fees` float NOT NULL,
  `delivery_time` varchar(100) NOT NULL,
  `open_status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`id`, `name`, `username`, `password`, `mobile`, `email`, `logo`, `status`, `city_id`, `state_id`, `delivery_fees`, `delivery_time`, `open_status`, `created_at`, `updated_at`) VALUES
(13, 'pizza hut', 'pizza_hut', '$2y$10$ZF81fSnCdmTrClxhEzuZ8ObQttWdA15dquIfO7tLBa5U1h7YLkp5m', '19552', 'order@pizzahut.com', '1603731327.png', 1, 6, 4, 20, '50', 1, '2020-10-26 14:55:27', '2020-11-10 09:06:35'),
(14, 'buffalo burger', 'buffalo_burger', '$2y$10$ZF81fSnCdmTrClxhEzuZ8ObQttWdA15dquIfO7tLBa5U1h7YLkp5m', '16321', 'order@buffalo.com', '1603731575.png', 1, 6, 4, 0, '', 0, '2020-10-26 14:59:35', '2020-11-10 09:06:32'),
(21, 'macdonalds', 'mac', '$2y$10$ZF81fSnCdmTrClxhEzuZ8ObQttWdA15dquIfO7tLBa5U1h7YLkp5m', '12458', 'order@mac.com', '1603731931.png', 0, 6, 4, 0, '', 0, '2020-10-26 15:05:31', '2020-11-10 09:06:35'),
(24, 'Abdo Elgenedi', 'abdoelgenedi', '$2y$10$ZF81fSnCdmTrClxhEzuZ8ObQttWdA15dquIfO7tLBa5U1h7YLkp5m', '01150911573', 'abdoelgenedi@gmail.com', 'vendor.jpg', 1, 6, 4, 50, '50', 1, '2020-10-26 15:05:31', '2021-02-17 11:00:32'),
(25, 'hgjgf', 'kfc', '$2y$10$3w8rpsA4MDuQl2P1ChNMMunk1lL.x6xzz4vE7zPHmOmZugfdYoydW', '566556', 'gjhgf@huhg.com', 'vendor.jpg', 0, 6, 4, 0, '', 0, '2020-11-19 14:32:51', '2021-02-02 13:52:17'),
(26, 'mahmoud', 'mahmoud', '$2y$10$MNx4w8jGoJ4dFdztH.La/OIRG3u7Be3gG0.poiGWEg1258nDpANfm', '454848', 'mahmoud@mahmoud.com', 'vendor.jpg', 0, 6, 4, 0, '', 0, '2020-11-19 16:04:53', '2021-02-02 13:52:19'),
(27, 'Crazy Chicken', 'crazy_chicken', '$2y$10$KcqA2L5k3bX7aQn7D8v.pexv.kOdhB8TJOnnsKolxjmvwxb.BnP2C', '19632', 'feedback@crazy.com', 'vendor.jpg', 0, 6, 4, 20, '50', 0, '2021-01-25 13:38:47', '2021-02-02 13:52:14'),
(29, 'buffalo burger', 'buffalo_burgerd', '$2y$10$ZF81fSnCdmTrClxhEzuZ8ObQttWdA15dquIfO7tLBa5U1h7YLkp5m', '16321d', 'ordedr@buffalo.com', '1603731575.png', 1, 6, 4, 0, '', 0, '2020-10-26 14:59:35', '2020-11-10 09:06:32'),
(30, 'buffalo burger', 'buffalo_burgerdf', '$2y$10$ZF81fSnCdmTrClxhEzuZ8ObQttWdA15dquIfO7tLBa5U1h7YLkp5m', '16321df', 'ordedfr@buffalo.com', '1603731575.png', 1, 6, 4, 0, '', 1, '2020-10-26 14:59:35', '2020-11-10 09:06:32'),
(31, 'buffalo burger', 'buffalo_dburgerd', '$2y$10$ZF81fSnCdmTrClxhEzuZ8ObQttWdA15dquIfO7tLBa5U1h7YLkp5m', '1632d1d', 'ordeddr@buffalo.com', '1603731575.png', 1, 6, 4, 0, '', 0, '2020-10-26 14:59:35', '2020-11-10 09:06:32'),
(35, 'buffalo burger', 'buffalsdo_bdsurgerdf', '$2y$10$ZF81fSnCdmTrClxhEzuZ8ObQttWdA15dquIfO7tLBa5U1h7YLkp5m', '163sdfd21df', 'ordedfr@busdgffalo.com', '1603731575.png', 1, 6, 4, 0, '', 0, '2020-10-26 14:59:35', '2020-11-10 09:06:32'),
(40, 'buffalo burger', 'bufsdgfdfalsdo_bdsurgerdf', '$2y$10$ZF81fSnCdmTrClxhEzuZ8ObQttWdA15dquIfO7tLBa5U1h7YLkp5m', '163sdghsfgdhfd21df', 'ordesfdgdfr@busdgffalo.com', '1603731575.png', 1, 6, 4, 0, '', 1, '2020-10-26 14:59:35', '2020-11-10 09:06:32'),
(41, 'buffalo burger', 'buffhsrtyhalo_dsdburgerd', '$2y$10$ZF81fSnCdmTrClxhEzuZ8ObQttWdA15dquIfO7tLBa5U1h7YLkp5m', '1sdf6sdfgh32d1d', 'ordesfgddr@buffalo.com', '1603731575.png', 1, 6, 4, 0, '', 1, '2020-10-26 14:59:35', '2020-11-10 09:06:32'),
(42, 'buffalo burger', 'buffartysdlo_dburgerd', '$2y$10$ZF81fSnCdmTrClxhEzuZ8ObQttWdA15dquIfO7tLBa5U1h7YLkp5m', '163sdfdrey21d', 'ordsfgedr@bufdfalo.com', '1603731575.png', 1, 6, 4, 0, '', 0, '2020-10-26 14:59:35', '2020-11-10 09:06:32'),
(43, 'buffalo burger', 'buffreydasdflo_burgerd', '$2y$10$ZF81fSnCdmTrClxhEzuZ8ObQttWdA15dquIfO7tLBa5U1h7YLkp5m', '16sdrayf321dd', 'ordeddr@bufsfgfalo.com', '1603731575.png', 0, 6, 4, 0, '', 0, '2020-10-26 14:59:35', '2021-02-11 10:44:02'),
(44, 'buffalo burger', 'bduffrteuasdflo_burgerd', '$2y$10$ZF81fSnCdmTrClxhEzuZ8ObQttWdA15dquIfO7tLBa5U1h7YLkp5m', '163seraysdf2d1d', 'ordeddr@buffasfglo.com', '1603731575.png', -1, 6, 4, 0, '', 0, '2020-10-26 14:59:35', '2020-11-10 09:06:32'),
(45, 'buffalo burger', 'buffasashdflo_beurgerd', '$2y$10$ZF81fSnCdmTrClxhEzuZ8ObQttWdA15dquIfO7tLBa5U1h7YLkp5m', '163sggjtdf2e1d', 'ordedr@beusfgffalo.com', '1603731575.png', -1, 6, 4, 0, '', 0, '2020-10-26 14:59:35', '2020-11-10 09:06:32'),
(46, 'buffalo burger', 'buffaastrlosdf_bureagerd', '$2y$10$ZF81fSnCdmTrClxhEzuZ8ObQttWdA15dquIfO7tLBa5U1h7YLkp5m', '1dstewsdfa6321d', 'ordeafdr@buffalsfgo.com', '1603731575.png', -1, 6, 4, 0, '', 0, '2020-10-26 14:59:35', '2020-11-10 09:06:32'),
(47, 'buffalo burger', 'buffawetadasdfflo_burgerd', '$2y$10$ZF81fSnCdmTrClxhEzuZ8ObQttWdA15dquIfO7tLBa5U1h7YLkp5m', '1632sytujdf1adfd', 'oadfrdedr@buffasfglo.com', '1603731575.png', -1, 6, 4, 0, '', 0, '2020-10-26 14:59:35', '2020-11-10 09:06:32'),
(48, 'buffalo burger', 'buffaghthjlsdfo_sdfburgerd', '$2y$10$ZF81fSnCdmTrClxhEzuZ8ObQttWdA15dquIfO7tLBa5U1h7YLkp5m', '16stwerqdsdff321d', 'ordedsdfr@buffsfgalo.com', '1603731575.png', -1, 6, 4, 0, '', 0, '2020-10-26 14:59:35', '2020-11-10 09:06:32'),
(49, 'buffalo burger', 'buffalhrto_bsddsffurgerd', '$2y$10$ZF81fSnCdmTrClxhEzuZ8ObQttWdA15dquIfO7tLBa5U1h7YLkp5m', '1ddswtyweyf6sdf321d', 'osdfrdedr@buffsfgalo.com', '1603731575.png', -1, 6, 4, 0, '', 0, '2020-10-26 14:59:35', '2020-11-10 09:06:32'),
(50, 'buffalo burger', 'bufsdgfdfuktydalsdo_bdsurgerdf', '$2y$10$ZF81fSnCdmTrClxhEzuZ8ObQttWdA15dquIfO7tLBa5U1h7YLkp5m', '163sdkiirutjghsfgdhfd21df', 'ordesfdjtryjgdfr@busdgffalo.com', '1603731575.png', -1, 6, 4, 0, '', 0, '2020-10-26 14:59:35', '2020-11-10 09:06:32'),
(51, 'buffalo burger', 'buffhhdkawssrtyhalo_dsdburgerd', '$2y$10$ZF81fSnCdmTrClxhEzuZ8ObQttWdA15dquIfO7tLBa5U1h7YLkp5m', '1sdf6sdfghghjfduj32d1d', 'ordesfgfdgjtyukddr@buffalo.com', '1603731575.png', -1, 6, 4, 0, '', 0, '2020-10-26 14:59:35', '2020-11-10 09:06:32'),
(52, 'buffalo burger', 'bufsgdfhfartysdlo_dburgerd', '$2y$10$ZF81fSnCdmTrClxhEzuZ8ObQttWdA15dquIfO7tLBa5U1h7YLkp5m', '163sdfsdhfgsdrey21d', 'ordsfgedr@sdhsdfgbufdtrfalo.com', '1603731575.png', -1, 6, 4, 0, '', 0, '2020-10-26 14:59:35', '2020-11-10 09:06:32'),
(53, 'buffalo burger', 'buffreysdghdsfdasdflo_burgerd', '$2y$10$ZF81fSnCdmTrClxhEzuZ8ObQttWdA15dquIfO7tLBa5U1h7YLkp5m', '16sdhgfdssdrayf321dd', 'ordeddr@busdhshfsfgfalo.com', '1603731575.png', -1, 6, 4, 0, '', 0, '2020-10-26 14:59:35', '2020-11-10 09:06:32'),
(54, 'buffalo burger', 'bduffrteuasdfsdyhtlo_burgerd', '$2y$10$ZF81fSnCdmTrClxhEzuZ8ObQttWdA15dquIfO7tLBa5U1h7YLkp5m', '163seraysdsydsdf2d1d', 'ordeddr@buffasfgltsuytsho.com', '1603731575.png', -1, 6, 4, 0, '', 0, '2020-10-26 14:59:35', '2020-11-10 09:06:32'),
(55, 'buffalo burger', 'buffasasdsysdthdflo_beurgerd', '$2y$10$ZF81fSnCdmTrClxhEzuZ8ObQttWdA15dquIfO7tLBa5U1h7YLkp5m', '163sggjsdytdstdf2e1d', 'ordedr@beusfgffartsystetelo.com', '1603731575.png', -1, 6, 4, 0, '', 0, '2020-10-26 14:59:35', '2020-11-10 09:06:32'),
(57, 'buffalo burger', 'bufsdgfdfuktyd1alsdo_bdsurgerdf', '$2y$10$ZF81fSnCdmTrClxhEzuZ8ObQttWdA15dquIfO7tLBa5U1h7YLkp5m', '163sdk1iirutjghsfgdhfd21df', 'ordesfdj1tryjgdfr@busdgffalo.com', '1603731575.png', -1, 6, 4, 0, '', 0, '2020-10-26 14:59:35', '2020-11-10 09:06:32'),
(58, 'buffalo burger', 'buffh2hdkawssrtyhalo_dsdburgerd', '$2y$10$ZF81fSnCdmTrClxhEzuZ8ObQttWdA15dquIfO7tLBa5U1h7YLkp5m', '1sdf6s2dfghghjfduj32d1d', 'ordesfgfdgjtyukddr@buf2falo.com', '1603731575.png', -1, 6, 4, 0, '', 0, '2020-10-26 14:59:35', '2020-11-10 09:06:32'),
(59, 'buffalo burger', 'bufsgd3fhfartysdlo_dburgerd', '$2y$10$ZF81fSnCdmTrClxhEzuZ8ObQttWdA15dquIfO7tLBa5U1h7YLkp5m', '163s3dfsdhfgsdrey21d', 'ordsfgedr@sdhsdfgbufd3trfalo.com', '1603731575.png', -1, 6, 4, 0, '', 0, '2020-10-26 14:59:35', '2020-11-10 09:06:32'),
(60, 'buffalo burger', 'buffreysdghd4sfdasdflo_burgerd', '$2y$10$ZF81fSnCdmTrClxhEzuZ8ObQttWdA15dquIfO7tLBa5U1h7YLkp5m', '16sdhg4fdssdrayf321dd', 'ordeddr@busdhs4hfsfgfalo.com', '1603731575.png', -1, 6, 4, 0, '', 0, '2020-10-26 14:59:35', '2020-11-10 09:06:32'),
(61, 'buffalo burger', 'bduffrteu5asdfsdyhtlo_burgerd', '$2y$10$ZF81fSnCdmTrClxhEzuZ8ObQttWdA15dquIfO7tLBa5U1h7YLkp5m', '163sera5ysdsydsdf2d1d', 'ordeddr@buffasf5gltsuytsho.com', '1603731575.png', -1, 6, 4, 0, '', 0, '2020-10-26 14:59:35', '2020-11-10 09:06:32'),
(62, 'buffalo burger', 'buffasasd6sysdthdflo_beurgerd', '$2y$10$ZF81fSnCdmTrClxhEzuZ8ObQttWdA15dquIfO7tLBa5U1h7YLkp5m', '163sggj6sdytdstdf2e1d', 'ordedr@beusfgffartsyste6telo.com', '1603731575.png', -1, 6, 4, 0, '', 0, '2020-10-26 14:59:35', '2020-11-10 09:06:32'),
(63, 'buffalo burger', 'buffaastrlosdf_bur7eagerd', '$2y$10$ZF81fSnCdmTrClxhEzuZ8ObQttWdA15dquIfO7tLBa5U1h7YLkp5m', '1dstewseyre7dfa6321d', 'ordeafdr@buffalsdy7wesfgo.com', '1603731575.png', -1, 6, 4, 0, '', 0, '2020-10-26 14:59:35', '2020-11-10 09:06:32'),
(64, 'buffalo burger', 'bufersfawe8tadasdfflo_burgerd', '$2y$10$ZF81fSnCdmTrClxhEzuZ8ObQttWdA15dquIfO7tLBa5U1h7YLkp5m', '1638eryery2sytujdf1adfd', 'oadfrd8edr@buffteyasfglo.com', '1603731575.png', -1, 6, 4, 0, '', 0, '2020-10-26 14:59:35', '2020-11-10 09:06:32'),
(65, 'buffalo burger', 'buffagtsdy9tsdhthjlsdfo_sdfburgerd', '$2y$10$ZF81fSnCdmTrClxhEzuZ8ObQttWdA15dquIfO7tLBa5U1h7YLkp5m', '16sdtytsdstwerqd9sdff321d', 'ordedsdsdy9arfr@buffsfgalo.com', '1603731575.png', -1, 6, 4, 0, '', 0, '2020-10-26 14:59:35', '2020-11-10 09:06:32'),
(66, 'buffalo burger', 'buffalhrtsdyesdo_bsdds9ffurgerd', '$2y$10$ZF81fSnCdmTrClxhEzuZ8ObQttWdA15dquIfO7tLBa5U1h7YLkp5m', '1ddssdt9ywtyweyf6sdf321d', 'osdfrdedr@busdty9stdffsfgalo.com', '1603731575.png', -1, 6, 4, 0, '', 0, '2020-10-26 14:59:35', '2020-11-10 09:06:32'),
(67, 'new', 'new', 'wefdgvd', '65454', 'email@fgf.com', 'vendor.jpg', 0, 6, 4, 20, '50', 0, '2021-01-28 16:28:41', '2021-02-02 13:52:20');

-- --------------------------------------------------------

--
-- Table structure for table `vendor_categories`
--

CREATE TABLE `vendor_categories` (
  `id` int(11) NOT NULL,
  `rest_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(150) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vendor_categories`
--

INSERT INTO `vendor_categories` (`id`, `rest_id`, `name`, `created_at`, `updated_at`) VALUES
(9, 13, 'men clothes', NULL, '2020-11-17 13:17:33'),
(24, 13, 'chicken', '2020-09-28 13:02:23', '2020-11-17 13:27:37'),
(27, 24, 'shawarma', '2021-02-10 14:07:57', '2021-02-10 14:11:01'),
(28, 24, 'sandwiches', '2021-02-10 14:11:24', '2021-02-10 14:11:24'),
(29, 24, 'oriental pizza', '2021-02-10 14:12:12', '2021-02-10 14:12:12'),
(30, 24, 'oriental pies', '2021-02-10 14:12:26', '2021-02-10 14:12:26');

-- --------------------------------------------------------

--
-- Table structure for table `vendor_maincategories`
--

CREATE TABLE `vendor_maincategories` (
  `id` int(11) UNSIGNED NOT NULL,
  `category_id` int(11) UNSIGNED NOT NULL,
  `vendor_id` int(11) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vendor_maincategories`
--

INSERT INTO `vendor_maincategories` (`id`, `category_id`, `vendor_id`, `created_at`, `updated_at`) VALUES
(3, 223, 13, NULL, NULL),
(7, 76, 24, '2021-02-10 13:46:37', '2021-02-10 13:46:37'),
(8, 223, 24, '2021-02-11 10:06:53', '2021-02-11 10:06:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_invoice` (`user_id`),
  ADD KEY `vendor_invoice` (`vendor_id`);

--
-- Indexes for table `main_categories`
--
ALTER TABLE `main_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_order` (`product_id`),
  ADD KEY `invoice_order` (`invoice_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vendor_product` (`vendor_id`),
  ADD KEY `sub_product` (`sub_category`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`),
  ADD KEY `city_state` (`city_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `mobile` (`mobile`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `mobile` (`mobile`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `city` (`city_id`),
  ADD KEY `state` (`state_id`);

--
-- Indexes for table `vendor_categories`
--
ALTER TABLE `vendor_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vendor_cat` (`rest_id`);

--
-- Indexes for table `vendor_maincategories`
--
ALTER TABLE `vendor_maincategories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vendor_main` (`vendor_id`),
  ADD KEY `main_category` (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `main_categories`
--
ALTER TABLE `main_categories`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=228;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `vendor_categories`
--
ALTER TABLE `vendor_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `vendor_maincategories`
--
ALTER TABLE `vendor_maincategories`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `user_invoice` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `vendor_invoice` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `invoice_order` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_order` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `sub_product` FOREIGN KEY (`sub_category`) REFERENCES `vendor_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vendor_product` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `states`
--
ALTER TABLE `states`
  ADD CONSTRAINT `city_state` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vendors`
--
ALTER TABLE `vendors`
  ADD CONSTRAINT `city` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `state` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `vendor_categories`
--
ALTER TABLE `vendor_categories`
  ADD CONSTRAINT `vendor_cat` FOREIGN KEY (`rest_id`) REFERENCES `vendors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vendor_maincategories`
--
ALTER TABLE `vendor_maincategories`
  ADD CONSTRAINT `main_category` FOREIGN KEY (`category_id`) REFERENCES `main_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vendor_main` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
