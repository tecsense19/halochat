-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 01, 2023 at 06:14 AM
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
-- Database: `halochat`
--

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `message_id` bigint(20) UNSIGNED NOT NULL,
  `profile_id` int(11) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sender_id` bigint(20) UNSIGNED DEFAULT NULL,
  `receiver_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` enum('Active','Archived','Deleted') NOT NULL,
  `message_text` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `media_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`message_id`, `profile_id`, `user_id`, `sender_id`, `receiver_id`, `status`, `message_text`, `timestamp`, `media_url`, `created_at`, `updated_at`) VALUES
(114, 4, 3, 3, 4, 'Active', 'Hey there… have we met before?', '2023-10-30 13:38:15', 'https://fastly.picsum.photos/id/912/200/300.jpg?hmac=wRzqCXn4iQFYYTjMpB_LljooIBYELbMYz8kUuWS-toc', '2023-10-30 08:07:52', '2023-10-30 08:07:52'),
(115, 4, 3, 4, 3, 'Active', 'Heloo', '2023-10-30 13:37:59', NULL, '2023-10-30 08:07:59', '2023-10-30 08:07:59'),
(116, 5, 3, 3, 5, 'Active', 'Hey there… have we met before?', '2023-10-30 13:38:32', 'https://fastly.picsum.photos/id/912/200/300.jpg?hmac=wRzqCXn4iQFYYTjMpB_LljooIBYELbMYz8kUuWS-toc', '2023-10-30 08:08:21', '2023-10-30 08:08:21'),
(117, 5, 1, 1, 5, 'Active', 'Hey there… have we met before?', '2023-10-30 13:40:38', 'https://fastly.picsum.photos/id/912/200/300.jpg?hmac=wRzqCXn4iQFYYTjMpB_LljooIBYELbMYz8kUuWS-toc', '2023-10-30 08:10:27', '2023-10-30 08:10:27');

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
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(2, '2023_10_25_071446_create_users_table', 1),
(3, '2023_10_25_071857_create_profiles_table', 1),
(4, '2023_10_25_072621_create_plans_table', 1),
(5, '2023_10_25_072819_create_messages_table', 1),
(6, '2023_10_25_073002_create_subscriptions_table', 1),
(7, '2023_10_25_073004_create_profile_images', 1),
(8, '2023_10_25_092322_add_deleted_at_to_users_table', 2);

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
  `Plan_id` bigint(20) UNSIGNED NOT NULL,
  `Plan_name` varchar(255) NOT NULL,
  `Plan_price` decimal(10,2) NOT NULL,
  `Trail_period_days` int(11) DEFAULT NULL,
  `Interval` enum('month','year','week','day') NOT NULL,
  `Description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `profile_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `ethnicity` varchar(255) DEFAULT NULL,
  `personality` varchar(255) DEFAULT NULL,
  `occupation` varchar(255) DEFAULT NULL,
  `hobbies` text DEFAULT NULL,
  `relationship_status` varchar(255) DEFAULT NULL,
  `body_description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`profile_id`, `name`, `description`, `age`, `gender`, `ethnicity`, `personality`, `occupation`, `hobbies`, `relationship_status`, `body_description`, `created_at`, `updated_at`) VALUES
(4, 'Cody Henderson', 'Aut cumque id dolor', 25, 'Female', 'Aliqua Ipsum enim e', 'Qui cillum dolore te', 'Aspernatur consectet', 'Placeat possimus s', 'Culpa eiusmod enim a', 'Illum est necessita', '2023-10-27 03:41:13', '2023-10-27 03:41:13'),
(5, 'Matthew Garner', 'Laudantium veniam', 96, 'Female', 'Ut dolore ad consequ', 'Dolores veniam ea v', 'Ut et qui possimus', 'Placeat possimus s', 'Id sed provident i', 'Illum est necessita', '2023-10-30 01:00:26', '2023-10-30 01:00:26');

-- --------------------------------------------------------

--
-- Table structure for table `profile_images`
--

CREATE TABLE `profile_images` (
  `image_id` bigint(20) UNSIGNED NOT NULL,
  `profile_id` bigint(20) UNSIGNED DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `is_primary` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profile_images`
--

INSERT INTO `profile_images` (`image_id`, `profile_id`, `image_path`, `is_primary`, `created_at`, `updated_at`) VALUES
(7, 4, 'images/pNNbDVp52pHofdwiHESAyT7Yk5OixGoNbVHDmyzP.webp', 0, '2023-10-27 03:41:13', '2023-10-27 03:41:13'),
(8, 4, 'images/ja6PL9FmYaAZHJjMJHwF1ZIlRKYqpM9SuBURGXcW.webp', 0, '2023-10-27 03:41:13', '2023-10-27 03:41:13'),
(9, 5, 'images/D7RmNLr2HjvrQioISMEYia62HHKhn3AgG78HllGC.webp', 0, '2023-10-30 01:00:27', '2023-10-30 01:00:27'),
(10, 5, 'images/DWv3URowsDjHa7tk2TbAX14FIXyDmyon1nUMXy5C.webp', 0, '2023-10-30 01:00:27', '2023-10-30 01:00:27');

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `subscription_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `plan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `subscription_level` enum('Free','Basic','Premium') NOT NULL,
  `trial_start_date` date DEFAULT NULL,
  `trial_end_date` date DEFAULT NULL,
  `subscription_start_date` date DEFAULT NULL,
  `subscription_end_date` date DEFAULT NULL,
  `subscription_cancel_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `gender` varchar(255) NOT NULL DEFAULT 'male',
  `email` varchar(255) NOT NULL,
  `email_verified` int(11) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `google_id` varchar(255) DEFAULT NULL,
  `user_avatar` varchar(500) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  `plans` enum('Free','premium') NOT NULL DEFAULT 'Free',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `avatar`, `gender`, `email`, `email_verified`, `email_verified_at`, `google_id`, `user_avatar`, `password`, `remember_token`, `role`, `plans`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'gaurtam', NULL, 'male', 'gautam@tec-sense.com', NULL, NULL, NULL, NULL, '$2y$10$8eb/dntv1Zk8gQWxFvCmbeVW36oGcf.ipT38PMTu2Kr2XnBtUmwMS', NULL, 'User', 'Free', '2023-10-25 02:08:26', '2023-10-27 07:58:50', NULL),
(2, 'admin', NULL, 'male', 'admin@tec-sense.com', NULL, NULL, NULL, NULL, '$2y$10$f3gyUUbb5qCTRNwqONbtYOsXeqDspefXoAQFwYIP1xAdNmNZ/j9/a', NULL, 'Admin', 'Free', '2023-10-25 02:08:26', '2023-10-25 02:08:26', NULL),
(3, 'Mark Walker', NULL, 'female', 'walkermark111989@gmail.com', 1, '2023-10-27 01:57:41', '107065462179627802773', 'https://lh3.googleusercontent.com/a/ACg8ocKIQqplSFGRXXfygXPUP87M91tTgNeNXlJIZKfqf-J9=s96-c', '$2y$10$gRedMvzSgrMxsVasspL8musmvS8FFBANgr7JoiRzOHg7AbOPKS6Le', NULL, 'User', 'Free', '2023-10-27 01:57:41', '2023-10-30 05:17:38', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `sender_id` (`sender_id`),
  ADD KEY `receiver_id` (`receiver_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`Plan_id`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`profile_id`);

--
-- Indexes for table `profile_images`
--
ALTER TABLE `profile_images`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `profile_images_profile_id_foreign` (`profile_id`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`subscription_id`),
  ADD KEY `subscriptions_user_id_foreign` (`user_id`);

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
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `Plan_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `profile_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `profile_images`
--
ALTER TABLE `profile_images`
  MODIFY `image_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `subscription_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `profile_images`
--
ALTER TABLE `profile_images`
  ADD CONSTRAINT `profile_images_profile_id_foreign` FOREIGN KEY (`profile_id`) REFERENCES `profiles` (`profile_id`) ON DELETE CASCADE;

--
-- Constraints for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD CONSTRAINT `subscriptions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
