-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 28, 2023 at 07:46 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `agricultural_drone_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `drones`
--

CREATE TABLE `drones` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `battery` int(11) NOT NULL,
  `payload` varchar(255) NOT NULL,
  `lat` decimal(10,8) NOT NULL,
  `lng` decimal(11,8) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `drones`
--

INSERT INTO `drones` (`id`, `code`, `battery`, `payload`, `lat`, `lng`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'D23', 100, 'camera', '30.56876200', '88.43953100', 1, '2023-05-27 22:43:21', '2023-05-27 22:43:21'),
(2, 'D24', 60, 'ប៉ពង់បាញ់', '30.56876200', '-100.43953100', 1, '2023-05-27 22:43:21', '2023-05-27 22:43:21'),
(3, 'D25', 100, 'ប៉ពង់បាញ់', '30.56876200', '88.43953100', 1, '2023-05-27 22:43:21', '2023-05-27 22:43:21'),
(4, 'Z20', 88, 'camera', '50.56876200', '-68.43953100', 2, '2023-05-27 22:43:21', '2023-05-27 22:43:21'),
(5, 'Z30', 90, 'ប៉ពង់បាញ់', '50.56876200', '78.43953100', 2, '2023-05-27 22:43:21', '2023-05-27 22:43:21'),
(6, 'Z40', 100, 'ប៉ពង់បាញ់', '22.56876200', '-78.43953100', 2, '2023-05-27 22:43:21', '2023-05-27 22:43:21');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `farms`
--

CREATE TABLE `farms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `province_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `farms`
--

INSERT INTO `farms` (`id`, `name`, `province_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'KC Farm', 1, 1, '2023-05-27 22:43:21', '2023-05-27 22:43:21'),
(2, 'Chetra Farm', 1, 1, '2023-05-27 22:43:21', '2023-05-27 22:43:21'),
(3, 'Dara Farm', 2, 2, '2023-05-27 22:43:21', '2023-05-27 22:43:21');

-- --------------------------------------------------------

--
-- Table structure for table `instructions`
--

CREATE TABLE `instructions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `run_mode` varchar(255) NOT NULL,
  `speed` int(11) NOT NULL,
  `lat` decimal(10,8) NOT NULL,
  `lng` decimal(11,8) NOT NULL,
  `drone_id` bigint(20) UNSIGNED NOT NULL,
  `plan_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `instructions`
--

INSERT INTO `instructions` (`id`, `run_mode`, `speed`, `lat`, `lng`, `drone_id`, `plan_id`, `created_at`, `updated_at`) VALUES
(1, 'start', 60, '30.56876200', '88.43953100', 2, 1, '2023-05-27 22:43:21', '2023-05-27 22:43:21'),
(2, 'start', 60, '30.56876200', '88.43953100', 3, 1, '2023-05-27 22:43:21', '2023-05-27 22:43:21'),
(3, 'start', 80, '20.56876200', '50.43953100', 5, 3, '2023-05-27 22:43:21', '2023-05-27 22:43:21'),
(4, 'start', 80, '20.56876200', '50.43953100', 6, 3, '2023-05-27 22:43:21', '2023-05-27 22:43:21');

-- --------------------------------------------------------

--
-- Table structure for table `maps`
--

CREATE TABLE `maps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `farm_id` bigint(20) UNSIGNED NOT NULL,
  `drone_id` bigint(20) UNSIGNED NOT NULL,
  `image` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `maps`
--

INSERT INTO `maps` (`id`, `farm_id`, `drone_id`, `image`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'data:image/png;base64, iVBAAQVQI12P4//8/w38GIAXDIABJRU5ErkJggg==', '2023-05-27 22:43:21', '2023-05-27 22:43:21'),
(2, 1, 1, 'data:image/png;base64, dDFDSKFHKDJKAFDF///DSADSADSADSADASDUuudjsd', '2023-05-27 22:43:21', '2023-05-27 22:43:21'),
(3, 2, 1, 'data:image/png;base64, iVBAAQVQI12P4//8/w38GIAXDIABJRU5ErkJddsadsa', '2023-05-27 22:43:21', '2023-05-27 22:43:21'),
(4, 2, 1, 'data:image/png;base64, dDFDSKFHKDJKAFDF///DDSDADADewDASDSASDA', '2023-05-27 22:43:21', '2023-05-27 22:43:21'),
(5, 3, 4, 'data:image/png;base64, oDSADASDASBVCXVCXC///DDSDREWERWEREWRRRRASDA', '2023-05-27 22:43:21', '2023-05-27 22:43:21');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_05_20_041248_create_provinces_table', 1),
(6, '2023_05_20_045817_create_farms_table', 1),
(7, '2023_05_20_111722_create_drones_table', 1),
(8, '2023_05_24_073203_create_maps_table', 1),
(9, '2023_05_25_125633_create_plans_table', 1),
(10, '2023_05_26_021851_create_instructions_table', 1);

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
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

CREATE TABLE `plans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `datetime` datetime NOT NULL,
  `area` text NOT NULL,
  `density` int(11) NOT NULL,
  `map_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `plans`
--

INSERT INTO `plans` (`id`, `name`, `type`, `datetime`, `area`, `density`, `map_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Spray007', 'Spraying', '2023-05-30 16:00:00', 'POLYGON((6.535406112670899 46.655990545464206,6.5360498428344735 46.655710711675226,6.535298824310304 46.654561905156164,6.534655094146729 46.654723917810095,6.535406112670899 46.655990545464206))', 76, 1, 1, '2023-05-27 22:43:21', '2023-05-27 22:43:21'),
(2, 'Order66', 'Harvesting', '2023-05-30 11:00:00', 'POLYGON((8.535406112670899 47.655990545464206,6.5360498428344735 46.655710711675226,6.535298824310304 46.654561905156164,6.534655094146729 46.654723917810095,6.535406112670899 46.655990545464206))', 86, 2, 1, '2023-05-27 22:43:21', '2023-05-27 22:43:21'),
(3, 'Spray59', 'Spraying', '2023-06-01 14:00:00', 'POLYGON((6.535406112670899 46.655990545464206,6.5360498428344735 46.655710711675226,6.535298824310304 46.654561905156164,6.534655094146729 46.654723917810095,6.535406112670899 46.655990545464206))', 66, 5, 2, '2023-05-27 22:43:21', '2023-05-27 22:43:21');

-- --------------------------------------------------------

--
-- Table structure for table `provinces`
--

CREATE TABLE `provinces` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `provinces`
--

INSERT INTO `provinces` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Takeo', '2023-05-27 22:43:21', '2023-05-27 22:43:21'),
(2, 'Kampong Cham', '2023-05-27 22:43:21', '2023-05-27 22:43:21'),
(3, 'Kampong Chhnang', '2023-05-27 22:43:21', '2023-05-27 22:43:21'),
(4, 'Kampong Thom', '2023-05-27 22:43:21', '2023-05-27 22:43:21'),
(5, 'Kampong Speu', '2023-05-27 22:43:21', '2023-05-27 22:43:21'),
(6, 'Bathambong', '2023-05-27 22:43:21', '2023-05-27 22:43:21'),
(7, 'Prey Veng', '2023-05-27 22:43:21', '2023-05-27 22:43:21');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Chetra', 'Hong', 'chetra@gmail.com', NULL, '$2y$10$GRRKBqkF5ac/WH3bfMrBEOetvz/uKGG/wZ9Cy2PwPqx9NfEuJDgF2', NULL, '2023-05-27 22:43:21', '2023-05-27 22:43:21'),
(2, 'Dara', 'Sombat', 'dara@gmail.com', NULL, '$2y$10$ZYZXYc6Nc6ICxrYDt4LZ1uIHVde3X.lApYkxHkARoLmziV0BeKoZy', NULL, '2023-05-27 22:43:21', '2023-05-27 22:43:21'),
(3, 'Phalla', 'Ser', 'phalla@gmail.com', NULL, '$2y$10$FgVn/cuW57fI3SQ29zRezeHLXpk9drJjunzyjRTn4lBX5/JEYuifO', NULL, '2023-05-27 22:43:21', '2023-05-27 22:43:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `drones`
--
ALTER TABLE `drones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `drones_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `farms`
--
ALTER TABLE `farms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `farms_province_id_foreign` (`province_id`),
  ADD KEY `farms_user_id_foreign` (`user_id`);

--
-- Indexes for table `instructions`
--
ALTER TABLE `instructions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `instructions_drone_id_foreign` (`drone_id`),
  ADD KEY `instructions_plan_id_foreign` (`plan_id`);

--
-- Indexes for table `maps`
--
ALTER TABLE `maps`
  ADD PRIMARY KEY (`id`),
  ADD KEY `maps_farm_id_foreign` (`farm_id`),
  ADD KEY `maps_drone_id_foreign` (`drone_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `plans_name_unique` (`name`),
  ADD KEY `plans_map_id_foreign` (`map_id`),
  ADD KEY `plans_user_id_foreign` (`user_id`);

--
-- Indexes for table `provinces`
--
ALTER TABLE `provinces`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `drones`
--
ALTER TABLE `drones`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `farms`
--
ALTER TABLE `farms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `instructions`
--
ALTER TABLE `instructions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `maps`
--
ALTER TABLE `maps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `provinces`
--
ALTER TABLE `provinces`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `drones`
--
ALTER TABLE `drones`
  ADD CONSTRAINT `drones_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `farms`
--
ALTER TABLE `farms`
  ADD CONSTRAINT `farms_province_id_foreign` FOREIGN KEY (`province_id`) REFERENCES `provinces` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `farms_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `instructions`
--
ALTER TABLE `instructions`
  ADD CONSTRAINT `instructions_drone_id_foreign` FOREIGN KEY (`drone_id`) REFERENCES `drones` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `instructions_plan_id_foreign` FOREIGN KEY (`plan_id`) REFERENCES `plans` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `maps`
--
ALTER TABLE `maps`
  ADD CONSTRAINT `maps_drone_id_foreign` FOREIGN KEY (`drone_id`) REFERENCES `drones` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `maps_farm_id_foreign` FOREIGN KEY (`farm_id`) REFERENCES `farms` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `plans`
--
ALTER TABLE `plans`
  ADD CONSTRAINT `plans_map_id_foreign` FOREIGN KEY (`map_id`) REFERENCES `maps` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `plans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
