-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 16, 2026 at 10:31 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

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
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `slug` varchar(120) NOT NULL,
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
  `uuid` varchar(255) NOT NULL,
  `connection` varchar(255) NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
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
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
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
  `migration` varchar(255) NOT NULL,
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
  `order_number` varchar(30) NOT NULL,
  `total_amount` decimal(15,2) NOT NULL,
  `shipping_cost` decimal(15,2) NOT NULL DEFAULT 0.00,
  `courier` varchar(20) DEFAULT NULL,
  `shipping_address` text NOT NULL,
  `shipping_city` varchar(100) NOT NULL,
  `shipping_district` varchar(100) NOT NULL,
  `shipping_postal_code` varchar(5) NOT NULL,
  `payment_method` varchar(30) NOT NULL,
  `payment_status` varchar(30) NOT NULL DEFAULT 'PENDING',
  `payment_proof` varchar(255) DEFAULT NULL,
  `payment_submitted_at` timestamp NULL DEFAULT NULL,
  `payment_verified_at` timestamp NULL DEFAULT NULL,
  `order_status` varchar(30) NOT NULL DEFAULT 'PENDING',
  `tracking_number` varchar(100) DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `order_number`, `total_amount`, `shipping_cost`, `courier`, `shipping_address`, `shipping_city`, `shipping_district`, `shipping_postal_code`, `payment_method`, `payment_status`, `payment_proof`, `payment_submitted_at`, `payment_verified_at`, `order_status`, `tracking_number`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 3, 'ANS-20260916082039-X1GGS', 315000.00, 15000.00, 'JNE', 'Boyolali', 'Boyolali', 'Musuk', '57331', 'QRIS', 'PENDING', NULL, NULL, NULL, 'PENDING', NULL, '2026-09-16 03:20:39', '2026-09-16 01:20:39', '2026-09-16 01:20:39'),
(2, 3, 'ANS-20260916082523-KTMQ7', 315000.00, 15000.00, 'JNE', 'Boyolali', 'Boyolali', 'Musuk', '57331', 'QRIS', 'PENDING', NULL, NULL, NULL, 'PENDING', NULL, '2026-09-16 03:25:23', '2026-09-16 01:25:23', '2026-09-16 01:25:23');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(150) NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL,
  `price` decimal(15,2) NOT NULL,
  `subtotal` decimal(15,2) NOT NULL,
  `variation_note` varchar(500) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `product_name`, `quantity`, `price`, `subtotal`, `variation_note`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Levi Ackerman Plush', 2, 150000.00, 300000.00, NULL, '2026-09-16 01:20:39', '2026-09-16 01:20:39'),
(2, 2, 1, 'Levi Ackerman Plush', 2, 150000.00, 300000.00, NULL, '2026-09-16 01:25:23', '2026-09-16 01:25:23');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(150) NOT NULL,
  `slug` varchar(170) NOT NULL,
  `description` text DEFAULT NULL,
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
(1, 1, 'Levi Ackerman Plush', 'levi-ackerman-plush', 'Plush karakter anime dengan ukuran dan variasi sesuai deskripsi produk.', 150000.00, 10, 4, '2026-09-15 20:47:39', '2026-09-16 01:25:23'),
(2, 2, 'One Piece Acrylic Keychain', 'one-piece-acrylic-keychain', 'Acrylic keychain bertema One Piece.', 35000.00, 20, 0, '2026-09-15 20:47:39', '2026-09-15 20:47:39'),
(3, 3, 'Anime Wall Poster', 'anime-wall-poster', 'Poster anime untuk dekorasi kamar.', 45000.00, 15, 0, '2026-09-15 20:47:39', '2026-09-15 20:47:39'),
(4, 4, 'Photocard Holder', 'photocard-holder', 'Holder untuk menyimpan dan melindungi photocard.', 25000.00, 25, 0, '2026-09-15 20:47:39', '2026-09-15 20:47:39'),
(5, 5, 'Anime Character Pin', 'anime-character-pin', 'Pin karakter anime untuk koleksi dan dekorasi.', 15000.00, 30, 0, '2026-09-15 20:47:39', '2026-09-15 20:47:39'),
(6, 6, 'K-Pop Uchiwa Fan', 'k-pop-uchiwa-fan', 'Uchiwa fan untuk koleksi K-Pop.', 50000.00, 12, 0, '2026-09-15 20:47:39', '2026-09-15 20:47:39'),
(7, 7, 'K-Pop Photocard', 'k-pop-photocard', 'Photocard K-Pop untuk koleksi.', 30000.00, 20, 0, '2026-09-15 20:47:39', '2026-09-15 20:47:39'),
(8, 8, 'Anime Canvas Tote Bag', 'anime-canvas-tote-bag', 'Tote bag canvas dengan desain anime.', 85000.00, 10, 0, '2026-09-15 20:47:40', '2026-09-15 20:47:40');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image_path`, `created_at`, `updated_at`) VALUES
(1, 1, 'products/levi-plush-1.jpg', '2026-09-15 20:47:39', '2026-09-15 20:47:39'),
(2, 1, 'products/levi-plush-2.jpg', '2026-09-15 20:47:39', '2026-09-15 20:47:39'),
(3, 2, 'products/one-piece-keychain.jpg', '2026-09-15 20:47:39', '2026-09-15 20:47:39'),
(4, 3, 'products/anime-poster.jpg', '2026-09-15 20:47:39', '2026-09-15 20:47:39'),
(5, 4, 'products/photocard-holder.jpg', '2026-09-15 20:47:39', '2026-09-15 20:47:39'),
(6, 5, 'products/anime-pin.jpg', '2026-09-15 20:47:39', '2026-09-15 20:47:39'),
(7, 6, 'products/kpop-uchiwa.jpg', '2026-09-15 20:47:39', '2026-09-15 20:47:39'),
(8, 7, 'products/kpop-photocard.jpg', '2026-09-15 20:47:40', '2026-09-15 20:47:40'),
(9, 8, 'products/anime-tote-bag.jpg', '2026-09-15 20:47:40', '2026-09-15 20:47:40');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('4WOxbUbrRPvWHRNMgn0B2fnFvgT0y48ykHhOugFa', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiI4TVBoc05oR3pTZTUydlBndlNXa29zM2RnUXAwWlpJckNhUTZQTTVQIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwXC9vcmRlcnNcLzIiLCJyb3V0ZSI6Im9yZGVycy5zaG93In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjN9', 1789547124);

-- --------------------------------------------------------

--
-- Table structure for table `shipping_rates`
--

CREATE TABLE `shipping_rates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `courier` varchar(20) NOT NULL,
  `city` varchar(100) NOT NULL,
  `cost` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shipping_rates`
--

INSERT INTO `shipping_rates` (`id`, `courier`, `city`, `cost`, `created_at`, `updated_at`) VALUES
(1, 'JNE', 'Boyolali', 15000.00, '2026-09-15 20:47:40', '2026-09-15 20:47:40'),
(2, 'JNE', 'Surakarta', 12000.00, '2026-09-15 20:47:40', '2026-09-15 20:47:40'),
(3, 'JNE', 'Semarang', 15000.00, '2026-09-15 20:47:40', '2026-09-15 20:47:40'),
(4, 'JNE', 'Salatiga', 12000.00, '2026-09-15 20:47:40', '2026-09-15 20:47:40'),
(5, 'J&T', 'Boyolali', 14000.00, '2026-09-15 20:47:40', '2026-09-15 20:47:40'),
(6, 'J&T', 'Surakarta', 11000.00, '2026-09-15 20:47:40', '2026-09-15 20:47:40'),
(7, 'J&T', 'Semarang', 14000.00, '2026-09-15 20:47:40', '2026-09-15 20:47:40'),
(8, 'J&T', 'Salatiga', 11000.00, '2026-09-15 20:47:40', '2026-09-15 20:47:40');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `whatsapp` varchar(20) NOT NULL,
  `role` varchar(20) NOT NULL DEFAULT 'customer',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `shipping_rates`
--
ALTER TABLE `shipping_rates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
