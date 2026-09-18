-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 18, 2026 at 08:53 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `anireshop_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Plush', 'plush', '2026-09-15 20:47:37', '2026-09-15 20:47:37'),
(2, 'Keychain', 'keychain', '2026-09-15 20:47:37', '2026-09-15 20:47:37'),
(3, 'Poster', 'poster', '2026-09-15 20:47:37', '2026-09-15 20:47:37'),
(4, 'Card Accessories', 'card-accessories', '2026-09-15 20:47:37', '2026-09-15 20:47:37'),
(5, 'Pin', 'pin', '2026-09-15 20:47:37', '2026-09-15 20:47:37'),
(6, 'Uchiwa Fan', 'uchiwa-fan', '2026-09-15 20:47:37', '2026-09-15 20:47:37'),
(7, 'K-Pop', 'k-pop', '2026-09-15 20:47:37', '2026-09-15 20:47:37'),
(8, 'Tote Bag', 'tote-bag', '2026-09-15 20:47:37', '2026-09-15 20:47:37'),
(9, 'Other Accessories', 'other-accessories', '2026-09-15 20:47:37', '2026-09-15 20:47:37');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` smallint(5) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_09_16_033152_add_whatsapp_and_role_to_users_table', 2),
(5, '2026_09_16_033202_create_categories_table', 2),
(6, '2026_09_16_033209_create_products_table', 2),
(7, '2026_09_16_033213_create_product_images_table', 2),
(8, '2026_09_16_033218_create_shipping_rates_table', 2),
(9, '2026_09_16_033225_create_orders_table', 2),
(10, '2026_09_16_033251_create_order_items_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `order_number` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_amount` decimal(15,2) NOT NULL,
  `shipping_cost` decimal(15,2) NOT NULL DEFAULT 0.00,
  `courier` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipping_city` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipping_district` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipping_postal_code` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_method` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_status` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'PENDING',
  `payment_proof` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_submitted_at` timestamp NULL DEFAULT NULL,
  `payment_verified_at` timestamp NULL DEFAULT NULL,
  `order_status` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'PENDING',
  `tracking_number` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `order_number`, `total_amount`, `shipping_cost`, `courier`, `shipping_address`, `shipping_city`, `shipping_district`, `shipping_postal_code`, `payment_method`, `payment_status`, `payment_proof`, `payment_submitted_at`, `payment_verified_at`, `order_status`, `tracking_number`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 3, 'ANS-20260916082039-X1GGS', '315000.00', '15000.00', 'JNE', 'Boyolali', 'Boyolali', 'Musuk', '57331', 'QRIS', 'PENDING', NULL, NULL, NULL, 'EXPIRED', NULL, '2026-09-16 03:20:39', '2026-09-16 01:20:39', '2026-09-17 00:01:01'),
(2, 3, 'ANS-20260916082523-KTMQ7', '315000.00', '15000.00', 'JNE', 'Boyolali', 'Boyolali', 'Musuk', '57331', 'QRIS', 'PENDING', NULL, NULL, NULL, 'EXPIRED', NULL, '2026-09-16 03:25:23', '2026-09-16 01:25:23', '2026-09-17 00:01:01'),
(3, 3, 'ANS-20260917045418-RDEPT', '41000.00', '11000.00', 'J&T', 'asasas', 'Salatiga', 'Tengaran', '66666', 'BANK_TRANSFER', 'PAID', 'payment-proofs/tlNyWMz7n3g5SYqAwsejKWntW838hccom8qFHOsJ.jpg', '2026-09-16 21:54:41', '2026-09-16 21:59:24', 'COMPLETED', 'J&T123456789', '2026-09-16 23:54:18', '2026-09-16 21:54:18', '2026-09-17 00:08:31'),
(4, 3, 'ANS-20260917071746-KY619', '41000.00', '11000.00', 'J&T', 'Surakarta', 'Surakarta', 'Solo', '99999', 'QRIS', 'PAID', 'payment-proofs/EAKO9eunkvzi75pQXiONKAxZq2UJA8IKEWF8Avf6.jpg', '2026-09-17 00:18:35', '2026-09-17 00:19:07', 'COMPLETED', 'J&T1111111', '2026-09-17 02:17:46', '2026-09-17 00:17:46', '2026-09-17 00:20:29'),
(5, 3, 'ANS-20260917073057-4Z8NY', '23000.00', '8000.00', 'JNE', 'asasa', 'Boyolali', 'sasas', '22222', 'BANK_TRANSFER', 'PENDING', NULL, NULL, NULL, 'EXPIRED', NULL, '2026-09-17 02:30:57', '2026-09-17 00:30:57', '2026-09-17 18:25:46'),
(6, 3, 'ANS-20260917074113-JWG9W', '30000.00', '15000.00', 'JNE', 'asasas', 'Semarang', 'sasa', '55656', 'BANK_TRANSFER', 'PENDING', NULL, NULL, NULL, 'EXPIRED', NULL, '2026-09-17 02:41:13', '2026-09-17 00:41:13', '2026-09-17 18:25:47'),
(7, 2, 'ANS-20260917121859-HYCBZ', '85000.00', '15000.00', 'JNE', 'test', 'Semarang', 'test', '99999', 'QRIS', 'WAITING_VERIFICATION', 'payment-proofs/V1XiUsDakiCrakZnYYoyGIKKHs4moxYgpU9kate5.jpg', '2026-09-17 05:24:42', NULL, 'PENDING', NULL, '2026-09-17 07:18:59', '2026-09-17 05:18:59', '2026-09-17 05:24:42'),
(8, 2, 'ANS-20260917122736-UOMKN', '39000.00', '14000.00', 'J&T', 'iiiii', 'Boyolali', 'iiiii', '77777', 'BANK_TRANSFER', 'PENDING', NULL, NULL, NULL, 'EXPIRED', NULL, '2026-09-17 07:27:36', '2026-09-17 05:27:36', '2026-09-17 18:25:47');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL,
  `price` decimal(15,2) NOT NULL,
  `subtotal` decimal(15,2) NOT NULL,
  `variation_note` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `product_name`, `quantity`, `price`, `subtotal`, `variation_note`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Levi Ackerman Plush', 2, '150000.00', '300000.00', NULL, '2026-09-16 01:20:39', '2026-09-16 01:20:39'),
(2, 2, 1, 'Levi Ackerman Plush', 2, '150000.00', '300000.00', NULL, '2026-09-16 01:25:23', '2026-09-16 01:25:23'),
(3, 3, 10, 'Anya Keychain', 2, '15000.00', '30000.00', NULL, '2026-09-16 21:54:18', '2026-09-16 21:54:18'),
(4, 4, 10, 'Anya Keychain', 2, '15000.00', '30000.00', 'Anya 2', '2026-09-17 00:17:46', '2026-09-17 00:17:46'),
(5, 5, 10, 'Anya Keychain', 1, '15000.00', '15000.00', NULL, '2026-09-17 00:30:57', '2026-09-17 00:30:57'),
(6, 6, 5, 'Anime Character Pin', 1, '15000.00', '15000.00', NULL, '2026-09-17 00:41:13', '2026-09-17 00:41:13'),
(7, 7, 2, 'One Piece Acrylic Keychain', 2, '35000.00', '70000.00', NULL, '2026-09-17 05:18:59', '2026-09-17 05:18:59'),
(8, 8, 4, 'Photocard Holder', 1, '25000.00', '25000.00', NULL, '2026-09-17 05:27:36', '2026-09-17 05:27:36');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(170) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(15,2) NOT NULL,
  `stock` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `reserved_stock` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `slug`, `description`, `price`, `stock`, `reserved_stock`, `created_at`, `updated_at`) VALUES
(1, 1, 'Plush Gojo Satoru', 'plush-gojo-satoru', 'Plush karakter Gojo Satoru untuk koleksi merchandise anime.', '25000.00', 10, 0, '2026-09-15 20:47:39', '2026-09-17 06:34:53'),
(2, 2, 'Luffy Keychain', 'luffy-keychain', 'Keychain karakter Luffy untuk koleksi dan aksesori.', '15000.00', 20, 0, '2026-09-15 20:47:39', '2026-09-17 06:34:53'),
(3, 3, 'One Piece Poster', 'one-piece-poster', 'Poster One Piece untuk dekorasi kamar dan koleksi.', '10000.00', 15, 0, '2026-09-15 20:47:39', '2026-09-17 06:29:57'),
(4, 4, 'Hatsune Miku Hologram Card', 'hatsune-miku-hologram-card', 'Hologram card Hatsune Miku untuk koleksi.', '12000.00', 25, 0, '2026-09-15 20:47:39', '2026-09-17 18:25:47'),
(5, 5, 'Nailong Pin', 'nailong-pin', 'Pin Nailong untuk koleksi dan dekorasi.', '6000.00', 30, 0, '2026-09-15 20:47:39', '2026-09-17 18:25:47'),
(6, 6, 'Muichiro Uchiwa Fan', 'muichiro-uchiwa-fan', 'Uchiwa fan karakter Muichiro untuk koleksi.', '10000.00', 12, 0, '2026-09-15 20:47:39', '2026-09-17 06:29:57'),
(7, 7, 'BLACKPINK A', 'blackpink-a', 'Merchandise K-Pop BLACKPINK untuk koleksi penggemar.', '15000.00', 20, 0, '2026-09-15 20:47:39', '2026-09-17 06:29:57'),
(8, 8, 'One Piece Tote Bag', 'one-piece-tote-bag', 'Tote bag bertema One Piece untuk penggunaan sehari-hari.', '15000.00', 10, 0, '2026-09-15 20:47:40', '2026-09-17 06:29:57'),
(9, 1, 'Plush Tanjiro', 'plush-tanjiro', 'Plush karakter Tanjiro untuk koleksi merchandise anime.', '25000.00', 10, 0, '2026-09-16 18:45:27', '2026-09-17 06:29:57'),
(10, 2, 'Anya Keychain', 'anya-keychain', 'Keychain karakter Anya untuk koleksi dan aksesori.', '15000.00', 11, 0, '2026-09-16 19:00:27', '2026-09-17 18:25:46'),
(13, 1, 'Plush Umaru-chan', 'plush-umaru-chan', 'Plush Umaru-chan untuk koleksi dan dekorasi.', '25000.00', 10, 0, '2026-09-17 06:29:57', '2026-09-17 06:29:57'),
(14, 2, 'Elaina Keychain', 'elaina-keychain', 'Keychain karakter Elaina untuk koleksi dan aksesori.', '15000.00', 20, 0, '2026-09-17 06:29:57', '2026-09-17 06:29:57'),
(16, 3, 'Frieren Poster', 'frieren-poster', 'Poster Frieren untuk dekorasi kamar dan koleksi.', '10000.00', 15, 0, '2026-09-17 06:29:57', '2026-09-17 06:29:57'),
(17, 3, 'Jujutsu Kaisen Poster', 'jujutsu-kaisen-poster', 'Poster Jujutsu Kaisen untuk dekorasi kamar dan koleksi.', '10000.00', 15, 0, '2026-09-17 06:29:57', '2026-09-17 06:29:57'),
(19, 4, 'Kafka Hologram Card', 'kafka-hologram-card', 'Hologram card Kafka untuk koleksi.', '12000.00', 25, 0, '2026-09-17 06:29:57', '2026-09-17 06:29:57'),
(20, 4, 'Furina Hologram Card', 'furina-hologram-card', 'Hologram card Furina untuk koleksi.', '12000.00', 25, 0, '2026-09-17 06:29:57', '2026-09-17 06:29:57'),
(22, 5, 'Zenitsu Pin', 'zenitsu-pin', 'Pin karakter Zenitsu untuk koleksi dan dekorasi.', '6000.00', 30, 0, '2026-09-17 06:29:57', '2026-09-17 06:29:57'),
(23, 5, 'Shinobu Pin', 'shinobu-pin', 'Pin karakter Shinobu untuk koleksi dan dekorasi.', '6000.00', 30, 0, '2026-09-17 06:29:57', '2026-09-17 06:29:57'),
(24, 6, 'Gojo Uchiwa Fan', 'gojo-uchiwa-fan', 'Uchiwa fan karakter Gojo untuk koleksi.', '10000.00', 12, 0, '2026-09-17 06:29:57', '2026-09-17 06:29:57'),
(25, 6, 'Tanjiro Uchiwa Fan', 'tanjiro-uchiwa-fan', 'Uchiwa fan karakter Tanjiro untuk koleksi.', '10000.00', 12, 0, '2026-09-17 06:29:57', '2026-09-17 06:29:57'),
(26, 7, 'aespa A', 'aespa-a', 'Merchandise K-Pop aespa untuk koleksi penggemar.', '15000.00', 20, 0, '2026-09-17 06:29:57', '2026-09-17 06:29:57'),
(27, 7, 'BOYNEXTDOOR A', 'boynextdoor-a', 'Merchandise K-Pop BOYNEXTDOOR untuk koleksi penggemar.', '15000.00', 20, 0, '2026-09-17 06:29:57', '2026-09-17 06:29:57'),
(28, 8, 'Gojo Tote Bag', 'gojo-tote-bag', 'Tote bag bertema Gojo untuk penggunaan sehari-hari.', '15000.00', 10, 0, '2026-09-17 06:29:57', '2026-09-17 06:29:57'),
(29, 8, 'Cute Girl Tote Bag', 'cute-girl-tote-bag', 'Tote bag dengan desain cute girl untuk penggunaan sehari-hari.', '15000.00', 10, 0, '2026-09-17 06:29:57', '2026-09-17 06:29:57');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image_path`, `created_at`, `updated_at`) VALUES
(41, 1, 'products/01_gojo-plush.png', '2026-09-17 07:39:48', '2026-09-17 07:39:48'),
(42, 9, 'products/02_tanjiro-plush.png', '2026-09-17 07:39:48', '2026-09-17 07:39:48'),
(43, 13, 'products/03_umaru-plush.png', '2026-09-17 07:39:48', '2026-09-17 07:39:48'),
(44, 10, 'products/04_anya-keychain.png', '2026-09-17 07:39:48', '2026-09-17 07:39:48'),
(45, 14, 'products/05_elaina-keychain.png', '2026-09-17 07:39:48', '2026-09-17 07:39:48'),
(46, 2, 'products/06_luffy-keychain.png', '2026-09-17 07:39:48', '2026-09-17 07:39:48'),
(47, 3, 'products/07_one-piece-poster.png', '2026-09-17 07:39:48', '2026-09-17 07:39:48'),
(48, 16, 'products/08_frieren-poster.png', '2026-09-17 07:39:48', '2026-09-17 07:39:48'),
(49, 17, 'products/09_jujutsu-kaisen-poster.png', '2026-09-17 07:39:48', '2026-09-17 07:39:48'),
(50, 4, 'products/10_miku-hologram-card.png', '2026-09-17 07:39:48', '2026-09-17 07:39:48'),
(51, 19, 'products/11_kafka-hologram-card.png', '2026-09-17 07:39:48', '2026-09-17 07:39:48'),
(52, 20, 'products/12_furina-hologram-card.png', '2026-09-17 07:39:48', '2026-09-17 07:39:48'),
(53, 5, 'products/13_nailong-pin.png', '2026-09-17 07:39:48', '2026-09-17 07:39:48'),
(54, 22, 'products/14_zenitsu-pin.png', '2026-09-17 07:39:48', '2026-09-17 07:39:48'),
(55, 23, 'products/15_shinobu-pin.png', '2026-09-17 07:39:48', '2026-09-17 07:39:48'),
(56, 6, 'products/16_muichiro-uchiwa.png', '2026-09-17 07:39:48', '2026-09-17 07:39:48'),
(57, 24, 'products/17_gojo-uchiwa.png', '2026-09-17 07:39:48', '2026-09-17 07:39:48'),
(58, 25, 'products/18_tanjiro-uchiwa.png', '2026-09-17 07:39:48', '2026-09-17 07:39:48'),
(59, 7, 'products/19_blackpink-a.png', '2026-09-17 07:39:48', '2026-09-17 07:39:48'),
(60, 26, 'products/20_aespa-a.png', '2026-09-17 07:39:48', '2026-09-17 07:39:48'),
(61, 27, 'products/21_boynextdoor-a.png', '2026-09-17 07:39:48', '2026-09-17 07:39:48'),
(62, 8, 'products/22_one-piece-tote-bag.png', '2026-09-17 07:39:48', '2026-09-17 07:39:48'),
(63, 28, 'products/23_gojo-tote-bag.png', '2026-09-17 07:39:48', '2026-09-17 07:39:48'),
(64, 29, 'products/24_cute-girl-tote-bag.png', '2026-09-17 07:39:48', '2026-09-17 07:39:48');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('GkGlzKPFcxemiUP3LvvTpOU5VO1KKl7iinNkFwo3', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:156.0) Gecko/20100101 Firefox/156.0', 'eyJfdG9rZW4iOiJBWkJOa3RZa1p2ZWJPMHN4NUNxbnVycTFhdFo5RnpOMDg1YmxtZ0x1IiwiX2ZsYXNoIjp7Im5ldyI6W10sIm9sZCI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvbG9jYWxob3N0OjgwMDBcL2NoZWNrb3V0Iiwicm91dGUiOiJjaGVja291dC5pbmRleCJ9LCJjYXJ0Ijp7IjIiOnsicXVhbnRpdHkiOjQsInZhcmlhdGlvbl9ub3RlIjoiTHVmZnkgS2V5Y2hhaW4gQSJ9fSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjJ9', 1789661310),
('JxVwlEnHepLi1XGq5d284VDQuGc6tpDkhBYlpbLN', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiIyZWNtQ25MclhuenhmdWFGWWVucWE5Qm5vaUpWNnppOWdTSmZnUmE0IiwiX2ZsYXNoIjp7Im5ldyI6W10sIm9sZCI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvbG9jYWxob3N0OjgwMDBcL29yZGVyc1wvNlwvcGF5bWVudCIsInJvdXRlIjoicGF5bWVudHMuc2hvdyJ9LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6M30=', 1789632238);

-- --------------------------------------------------------

--
-- Table structure for table `shipping_rates`
--

CREATE TABLE `shipping_rates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `courier` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cost` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shipping_rates`
--

INSERT INTO `shipping_rates` (`id`, `courier`, `city`, `cost`, `created_at`, `updated_at`) VALUES
(1, 'JNE', 'Boyolali', '10000.00', '2026-09-15 20:47:40', '2026-09-17 05:53:22'),
(2, 'JNE', 'Surakarta', '12000.00', '2026-09-15 20:47:40', '2026-09-15 20:47:40'),
(3, 'JNE', 'Semarang', '16000.00', '2026-09-15 20:47:40', '2026-09-17 05:53:22'),
(4, 'JNE', 'Salatiga', '15000.00', '2026-09-15 20:47:40', '2026-09-17 05:53:22'),
(5, 'J&T', 'Boyolali', '10000.00', '2026-09-15 20:47:40', '2026-09-17 05:53:22'),
(6, 'J&T', 'Surakarta', '11000.00', '2026-09-15 20:47:40', '2026-09-15 20:47:40'),
(7, 'J&T', 'Semarang', '15000.00', '2026-09-15 20:47:40', '2026-09-17 05:53:22'),
(8, 'J&T', 'Salatiga', '14000.00', '2026-09-15 20:47:40', '2026-09-17 05:53:22'),
(10, 'JNE', 'Sukoharjo', '12000.00', '2026-09-17 05:53:22', '2026-09-17 05:53:22'),
(11, 'JNE', 'Klaten', '13000.00', '2026-09-17 05:53:22', '2026-09-17 05:53:22'),
(12, 'JNE', 'Karanganyar', '13000.00', '2026-09-17 05:53:22', '2026-09-17 05:53:22'),
(13, 'JNE', 'Sragen', '14000.00', '2026-09-17 05:53:22', '2026-09-17 05:53:22'),
(14, 'JNE', 'Magelang', '16000.00', '2026-09-17 05:53:22', '2026-09-17 05:53:22'),
(15, 'JNE', 'Yogyakarta', '17000.00', '2026-09-17 05:53:22', '2026-09-17 05:53:22'),
(16, 'J&T', 'Sukoharjo', '11000.00', '2026-09-17 05:53:22', '2026-09-17 05:53:22'),
(17, 'J&T', 'Klaten', '12000.00', '2026-09-17 05:53:22', '2026-09-17 05:53:22'),
(18, 'J&T', 'Karanganyar', '12000.00', '2026-09-17 05:53:22', '2026-09-17 05:53:22'),
(19, 'J&T', 'Sragen', '13000.00', '2026-09-17 05:53:22', '2026-09-17 05:53:22'),
(20, 'J&T', 'Magelang', '15000.00', '2026-09-17 05:53:22', '2026-09-17 05:53:22'),
(21, 'J&T', 'Yogyakarta', '16000.00', '2026-09-17 05:53:22', '2026-09-17 05:53:22');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `whatsapp` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'customer',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `whatsapp`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Anireshop Admin', 'ibnuwildan12@gmail.com', '081328971435', 'admin', NULL, '$2y$12$EygYY8gQXIEy2FiFI8uw4ugEC.2UGPZUkDt2w1a2ymh3NiVaHV7fK', NULL, '2026-09-15 20:47:39', '2026-09-15 20:47:39'),
(2, 'Anireshop Customer', 'customer@anireshop.com', '085600635251', 'customer', NULL, '$2y$12$26moe4aWrpHlHHOBPx870uKb2SS7WQ7Uo0cnJHyM1RYwa40Sq3s.6', NULL, '2026-09-15 20:47:39', '2026-09-15 20:47:39'),
(3, 'Test Customer', 'test@anireshop.com', '081234567892', 'customer', NULL, '$2y$12$bsi3GNoQbuJ9XK2buTcDAOU7BMAOGf822QkgmzsKdMYIUXgnn6uU2', NULL, '2026-09-15 21:06:51', '2026-09-15 21:06:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  ADD KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
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
  ADD UNIQUE KEY `orders_order_number_unique` (`order_number`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_images_product_id_foreign` (`product_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `shipping_rates`
--
ALTER TABLE `shipping_rates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `shipping_rates_courier_city_unique` (`courier`,`city`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `shipping_rates`
--
ALTER TABLE `shipping_rates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
