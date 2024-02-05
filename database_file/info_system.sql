-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 05, 2024 at 04:03 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `info_system`
--

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
(2, '2014_10_12_000000_create_users_table', 1),
(3, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2023_11_19_062600_create_savings_table', 1),
(7, '2023_11_19_062613_create_welfare_table', 1),
(8, '2023_11_19_062624_create_disaster_table', 1),
(9, '2023_11_19_062634_create_loans_table', 1),
(10, '2023_12_03_063410_create__non_members_loans_table', 1),
(11, '2023_12_03_063438_create_shares_table', 1),
(12, '2023_12_03_063457_create_transactions_table', 1),
(14, '2023_12_29_184013_create_total_savings_table', 1),
(16, '2024_01_08_135556_create_requests_table', 2),
(17, '2014_09_19_062513_create_groups_table', 3),
(19, '2023_12_27_074642_create_settings_table', 4);

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
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `amount` double(18,2) NOT NULL,
  `loanType` varchar(255) NOT NULL,
  `reason` longtext NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`id`, `amount`, `loanType`, `reason`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 5000.00, 'savings', 'Trial', 5, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `savings`
--

CREATE TABLE `savings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `saved_amount` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `group_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `savings`
--

INSERT INTO `savings` (`id`, `saved_amount`, `created_at`, `updated_at`, `user_id`, `group_id`) VALUES
(1, 38000.00, NULL, NULL, 5, 2);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `welfareDefaultAmount` double(8,2) NOT NULL DEFAULT 0.00,
  `disasterDefaultAmount` double(8,2) NOT NULL DEFAULT 0.00,
  `sharesDefaultAmount` double(8,2) NOT NULL DEFAULT 0.00,
  `membersLoanInterestRate` int(11) NOT NULL DEFAULT 0,
  `nonMembersInterestRate` int(11) NOT NULL DEFAULT 0,
  `guarantorPayRate` int(11) NOT NULL DEFAULT 0,
  `group_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `welfareDefaultAmount`, `disasterDefaultAmount`, `sharesDefaultAmount`, `membersLoanInterestRate`, `nonMembersInterestRate`, `guarantorPayRate`, `group_id`, `created_at`, `updated_at`) VALUES
(1, 50000.00, 60000.00, 400000.00, 8, 10, 2, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shares`
--

CREATE TABLE `shares` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `shareAmount` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `group_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `total_savings`
--

CREATE TABLE `total_savings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `savings` double(8,2) NOT NULL,
  `welfare` double(8,2) NOT NULL,
  `disaster` double(8,2) NOT NULL,
  `shares` double(8,2) NOT NULL,
  `interest` double(8,2) NOT NULL,
  `sharesInterest` double(8,2) NOT NULL,
  `group_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `total_savings`
--

INSERT INTO `total_savings` (`id`, `savings`, `welfare`, `disaster`, `shares`, `interest`, `sharesInterest`, `group_id`, `created_at`, `updated_at`) VALUES
(1, 33000.00, 0.00, 0.00, 0.00, 6229.45, 0.00, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `transactionType` varchar(255) NOT NULL,
  `transactionID` varchar(255) DEFAULT NULL,
  `amount` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `group_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `transactionType`, `transactionID`, `amount`, `created_at`, `updated_at`, `user_id`, `group_id`) VALUES
(1, 'savings', NULL, 60000.00, NULL, NULL, 5, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nin` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `village` varchar(255) NOT NULL,
  `parish` varchar(255) NOT NULL,
  `sub-county` varchar(255) NOT NULL,
  `district` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT 0,
  `email_verified_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `group_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `nin`, `contact`, `village`, `parish`, `sub-county`, `district`, `role`, `status`, `verified`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`, `group_id`) VALUES
(1, 'Okello Emmanuel', 'emmanuel13458@gmail.com', '$2y$10$O6bX2cJ0iv4sGbxCXzOiLOu5uWem9AvhN7segUR4N7u4VopMXfJyu', 'CM009838927VHH', '0784573131', 'Ayile \'B\'', 'Okio', 'Ayami', 'Lira', 'super_admin', 'Active', 0, '2024-01-18 19:18:28', NULL, '2024-01-17 09:34:56', '2024-01-17 09:34:56', NULL),
(4, 'Ayena peter ', 'peter@gmail.com', '$2y$10$rSPaQrnPw7ScXo0cmfIOxOXkNFD6trQ7cE/GyBujsN0RQzb7BLIL.', 'CM009838927VHH', '0392893823', 'Punu Anyeri', 'Okio', 'Ayami', 'Lira', 'secretary', 'Active', 0, '2024-01-31 20:30:50', NULL, '2024-01-19 18:46:18', '2024-01-19 18:46:18', 1),
(5, 'Okullu Tom ', 'tom@gmail.com', '$2y$10$2R2RCCxaORNZNvhkBrkVxOpMm..4LICnreJMy6VMGfBz0EtXZ.CUa', 'CMHu9838927VHH', '0392893823', 'Ayile \'B\'', 'Okio', 'Ayami', 'Lira', 'member', 'Active', 0, '2024-02-01 22:36:38', NULL, '2024-01-19 18:59:04', '2024-01-19 18:59:04', 2),
(6, 'ocen isaac ', 'isaac@gmail.com', '$2y$10$sMDidu7Oxon.zv2TGLTI2.SKuNR0v8fVXma2pF9aCaSyIWKZssGOi', 'cmvh9839yuhh', '078635425', 'punu-anyeri', 'okio', 'ayami', 'lira', 'secretary', 'Active', 0, '2024-01-21 06:35:24', NULL, '2024-01-21 06:35:24', '2024-01-21 06:35:24', 2),
(7, 'Olyech ben ', 'ben@gmail.com', '$2y$10$BLtZ6tqApml8wYvzmkTPyOhTSXt3WNT/.jyyJy9uMgsMLmGImV3VW', 'cm9037chhjkj', '0756432325', 'Punu Anyeri', 'Okio', 'ayami', 'lira', 'member', 'Active', 0, '2024-01-21 06:40:49', NULL, '2024-01-21 06:40:49', '2024-01-21 06:40:49', 2),
(8, 'Acii betty ', 'betty@gmail.com', '$2y$10$V0Ce4aBZeI2NIpYJV3IGFuX63Uvy2oeIo670tGcRsf/Vru1KWwq6y', 'cf673582vhhj', '0392893823', 'punu-anyeri', 'Okio', 'ayami', 'lira', 'member', 'Active', 0, '2024-01-27 11:21:17', NULL, '2024-01-27 11:21:17', '2024-01-27 11:21:17', 2),
(10, 'Ayena peter ', 'peter1@gmail.com', '$2y$10$/uDZ4GQSNv6n3BqN9IrdiuSuuTV5YIAKi8ZyN3TPVmvxtNxDP.4PG', 'CM009838927VHH', '0784573131', 'Punu Anyeri', 'okio', 'ayami', 'lira', 'admin', 'Active', 0, '2024-02-01 21:19:26', NULL, '2024-02-01 21:19:26', '2024-02-01 21:19:26', 1);

-- --------------------------------------------------------

--
-- Table structure for table `welfare`
--

CREATE TABLE `welfare` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `welfare_paid` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `group_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `_non_members_loans`
--

CREATE TABLE `_non_members_loans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `maritalStatus` varchar(255) NOT NULL,
  `occupation` varchar(255) NOT NULL,
  `village` varchar(255) NOT NULL,
  `parish` varchar(255) NOT NULL,
  `subCounty` varchar(255) NOT NULL,
  `district` varchar(255) NOT NULL,
  `NIN` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `LC1Names` varchar(255) NOT NULL,
  `LC1Contacts` varchar(255) NOT NULL,
  `ClanLeaderNames` varchar(255) NOT NULL,
  `ClanLeaderContact` varchar(255) NOT NULL,
  `amountRequested` double(8,2) NOT NULL,
  `reason` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `group_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

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
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `requests_user_id_foreign` (`user_id`);

--
-- Indexes for table `savings`
--
ALTER TABLE `savings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `savings_user_id_unique` (`user_id`),
  ADD KEY `savings_group_id_foreign` (`group_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `settings_group_id_foreign` (`group_id`);

--
-- Indexes for table `shares`
--
ALTER TABLE `shares`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `shares_user_id_unique` (`user_id`),
  ADD KEY `shares_group_id_foreign` (`group_id`);

--
-- Indexes for table `total_savings`
--
ALTER TABLE `total_savings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `total_savings_group_id_unique` (`group_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transactions_user_id_foreign` (`user_id`),
  ADD KEY `transactions_group_id_foreign` (`group_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_group_id_foreign` (`group_id`);

--
-- Indexes for table `welfare`
--
ALTER TABLE `welfare`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `welfare_user_id_unique` (`user_id`),
  ADD KEY `welfare_group_id_foreign` (`group_id`);

--
-- Indexes for table `_non_members_loans`
--
ALTER TABLE `_non_members_loans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `_non_members_loans_user_id_foreign` (`user_id`),
  ADD KEY `_non_members_loans_group_id_foreign` (`group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `savings`
--
ALTER TABLE `savings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `shares`
--
ALTER TABLE `shares`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `total_savings`
--
ALTER TABLE `total_savings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `welfare`
--
ALTER TABLE `welfare`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `_non_members_loans`
--
ALTER TABLE `_non_members_loans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `requests`
--
ALTER TABLE `requests`
  ADD CONSTRAINT `requests_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `savings`
--
ALTER TABLE `savings`
  ADD CONSTRAINT `savings_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `vsla_db`.`groups` (`id`),
  ADD CONSTRAINT `savings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `settings`
--
ALTER TABLE `settings`
  ADD CONSTRAINT `settings_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `vsla_db`.`groups` (`id`);

--
-- Constraints for table `shares`
--
ALTER TABLE `shares`
  ADD CONSTRAINT `shares_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `vsla_db`.`groups` (`id`),
  ADD CONSTRAINT `shares_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `total_savings`
--
ALTER TABLE `total_savings`
  ADD CONSTRAINT `total_savings_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `vsla_db`.`groups` (`id`);

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `vsla_db`.`groups` (`id`),
  ADD CONSTRAINT `transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `vsla_db`.`groups` (`id`);

--
-- Constraints for table `welfare`
--
ALTER TABLE `welfare`
  ADD CONSTRAINT `welfare_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `vsla_db`.`groups` (`id`),
  ADD CONSTRAINT `welfare_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `_non_members_loans`
--
ALTER TABLE `_non_members_loans`
  ADD CONSTRAINT `_non_members_loans_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `vsla_db`.`groups` (`id`),
  ADD CONSTRAINT `_non_members_loans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
