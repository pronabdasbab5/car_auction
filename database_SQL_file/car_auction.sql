-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 16, 2019 at 07:50 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.1.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `car_auction`
--

-- --------------------------------------------------------

--
-- Table structure for table `api_key`
--

CREATE TABLE `api_key` (
  `userId` int(11) NOT NULL,
  `api_token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `api_key`
--

INSERT INTO `api_key` (`userId`, `api_token`, `created_at`, `updated_at`) VALUES
(1, 'api5d9098bce1cd1', '2019-09-29 06:12:16', '2019-09-29 06:12:52');

-- --------------------------------------------------------

--
-- Table structure for table `auction_group_name`
--

CREATE TABLE `auction_group_name` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `auction_group_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1 = Active, 0 = De-Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `auction_group_name`
--

INSERT INTO `auction_group_name` (`id`, `category_id`, `auction_group_name`, `start_date`, `end_date`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'New North Auction', '2019-10-10', '2019-10-16', 1, '2019-10-08 03:13:19', '2019-10-09 21:41:18'),
(2, 2, 'East Auction', '2019-10-07', '2019-10-13', 1, '2019-10-08 03:13:43', '2019-10-08 03:13:43');

-- --------------------------------------------------------

--
-- Table structure for table `bid`
--

CREATE TABLE `bid` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `current_bid_amount` int(11) NOT NULL,
  `total_bid_amount` int(11) NOT NULL,
  `status` int(11) DEFAULT '0' COMMENT '1 = Winner, 0 = Loser',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bid`
--

INSERT INTO `bid` (`id`, `vehicle_id`, `user_id`, `current_bid_amount`, `total_bid_amount`, `status`, `created_at`, `updated_at`) VALUES
(10, 1, 1, 11000, 11000, 0, '2019-10-14 22:45:05', '2019-10-14 22:45:46');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category`, `created_at`, `updated_at`) VALUES
(1, 'North', '2019-09-29 15:18:40', '2019-09-29 15:18:40'),
(2, 'East', '2019-09-29 15:23:12', '2019-09-29 15:45:00'),
(3, 'South', '2019-09-29 15:23:23', '2019-09-29 15:23:23'),
(4, 'West', '2019-09-29 15:23:31', '2019-09-29 15:23:31');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `userName` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobileNo` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `addressProof` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idProof` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isVerified` int(11) NOT NULL DEFAULT '0' COMMENT '1 = Verified, 0 = None',
  `deposit` int(11) DEFAULT NULL,
  `buyingLimit` int(11) DEFAULT NULL,
  `availableLimit` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1 = Active, 0 = De-Active',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `category_id`, `userName`, `email`, `mobileNo`, `address`, `password`, `addressProof`, `idProof`, `isVerified`, `deposit`, `buyingLimit`, `availableLimit`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 'Pronab Das', 'pronabdasbaba5@gmail.com', '863874695', 'Sivasagar', '$2y$10$wgiBb1QDDAWcnZgE1wrOH.rkGH2JVksTEvlCIb3W.bfR1Sj3Dymle', '1570510431.jpg', '1570510438.jpg', 1, 10000, 984000, 973000, 1, NULL, '2019-10-07 23:23:58', '2019-10-14 22:45:46');

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
(4, '2019_07_19_085125_create_api_key_table', 2),
(5, '2019_09_29_202848_create_category_table', 3),
(7, '2019_10_04_035244_create_vehicle_info_table', 5),
(8, '2019_10_06_175859_create_vehicle_images_table', 6),
(9, '2019_07_17_115952_create_members_table', 7),
(10, '2019_10_03_034654_create_auction_group_name_table', 8),
(11, '2019_10_09_155509_create_bid_table', 9),
(12, '2019_10_13_182348_create_notification_table', 10);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `title`, `desc`, `created_at`, `updated_at`) VALUES
(1, 'New Notification 1', '<p><strong><em>Lorem ipsum</em>, or&nbsp;<em>lipsum</em></strong>&nbsp;as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero&#39;s De Finibus Bonorum et Malorum for use in a type specimen book.</p>', '2019-10-13 13:30:01', '2019-10-13 14:09:52'),
(2, 'New Notification 2', '<p><strong>Lorem ipsum</strong>&nbsp;dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>', '2019-10-13 13:30:44', '2019-10-13 13:30:44');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Car Aution', 'admin@gmail.com', NULL, '$2y$10$4XJSXAl3O5v8aywpqSgBXusY0mbpTLi8WbBpDXq70c5K1QGOdbJA.', NULL, '2019-09-28 14:16:49', '2019-09-28 14:16:49');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_images`
--

CREATE TABLE `vehicle_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `img_path` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vehicle_images`
--

INSERT INTO `vehicle_images` (`id`, `vehicle_id`, `img_path`, `created_at`, `updated_at`) VALUES
(1, 1, '15706067670.jpg', '2019-10-09 02:09:27', '2019-10-09 02:09:27'),
(2, 1, '15706067671.jpg', '2019-10-09 02:09:27', '2019-10-09 02:09:27'),
(3, 2, '15706068140.jpg', '2019-10-09 02:10:14', '2019-10-09 02:10:14'),
(4, 2, '15706068141.jpg', '2019-10-09 02:10:14', '2019-10-09 02:10:14'),
(7, 3, '15709905590.jpg', '2019-10-13 12:45:59', '2019-10-13 12:45:59'),
(8, 3, '15709905591.jpg', '2019-10-13 12:45:59', '2019-10-13 12:45:59');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_info`
--

CREATE TABLE `vehicle_info` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `auction_id` int(11) NOT NULL,
  `auction_amount` int(11) NOT NULL,
  `vehicle_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bc_mfg_month_year` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bc_color` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bc_engine_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bc_chasis_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bc_transmission_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bc_fuel_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bc_owner_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bc_vehicle_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bc_ownership` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rc_rc_available` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rc_registration_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rc_registration_date` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rc_reg_as` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tx_road_text_expiray_date` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tx_permit_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tx_permit_expiray_date` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tx_fitness_expiray_date` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tx_road_taxt_validity` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hi_car_under_hypothecation` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hi_financer_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hi_noc_available` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hi_repo_date` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hi_loan_paid_off` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `li_zone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `li_state` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `li_city` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `li_yard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `li_yard_location` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avi_superdari_status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avi_tax_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avi_theft_recover` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avi_keys_available` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `summary` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vehicle_info`
--

INSERT INTO `vehicle_info` (`id`, `auction_id`, `auction_amount`, `vehicle_name`, `bc_mfg_month_year`, `bc_color`, `bc_engine_no`, `bc_chasis_no`, `bc_transmission_type`, `bc_fuel_type`, `bc_owner_type`, `bc_vehicle_type`, `bc_ownership`, `rc_rc_available`, `rc_registration_no`, `rc_registration_date`, `rc_reg_as`, `tx_road_text_expiray_date`, `tx_permit_type`, `tx_permit_expiray_date`, `tx_fitness_expiray_date`, `tx_road_taxt_validity`, `hi_car_under_hypothecation`, `hi_financer_name`, `hi_noc_available`, `hi_repo_date`, `hi_loan_paid_off`, `li_zone`, `li_state`, `li_city`, `li_yard_name`, `li_yard_location`, `avi_superdari_status`, `avi_tax_type`, `avi_theft_recover`, `avi_keys_available`, `summary`, `created_at`, `updated_at`) VALUES
(1, 1, 12000, 'Werwerq', 'werr', 'ewr', 'ewr', 'ewrew', 'wer', 'werwe', 'ewr', 'rewrewr', 'ewr', 'ewrew', 'wer', 'were', 'wer', 'werew', 'wer', 'wer', 'werewr', 'werewr', 'erew', 'werewr', 'werew', 'ewrewr', 'werewr', '1', 'werew', 'werwe', 'werewr', 'werwer', 'ewrew', 'ewrewr', 'wer', 'werew', '<p>werwer</p>', '2019-10-09 02:09:27', '2019-10-09 02:09:27'),
(2, 2, 10000, 'Werew', 'ertre', 'tert', 'ert', 'ert', 'ertret', 'ertret', 'er', 'ertret', 'tretert', 'ertre', 'ertret', 'ert', 'ertret', 'ertret', 'ertert', 'ertret', 'ertret', 'retret', 'ertret', 'ertret', 'ertert', 'ertret', 'ertret', '2', 'ertret', 'retret', 'ertret', 'ertret', 'tret', 'ertret', 'ertret', 'ertret', '<p>ertretret</p>', '2019-10-09 02:10:14', '2019-10-09 02:10:14'),
(3, 1, 15000, 'Maruti Suzuki', '4th Dec. 2017', 'Red', 'sadsa', 'sadsa', 'sdsa', 'sadsad', 'sads', 'sdsad', 'sadsad', 'sadsa', 'sadsad', 'sadsad', 'sadsad', 'sadsa', 'sadsa', 'sadsa', 'dsadsa', 'sadsad', 'sadsa', 'sadsad', 'sdsad', 'sadsad', 'asdsad', '1', 'asdsa', 'sadsad', 'dsadsa', 'sadsad', 'sadsad', 'sadsadsad', 'sadsadsad', 'sadsadsa', '<p>dsadsadsad</p>', '2019-10-09 02:14:13', '2019-10-13 12:47:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `api_key`
--
ALTER TABLE `api_key`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `auction_group_name`
--
ALTER TABLE `auction_group_name`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bid`
--
ALTER TABLE `bid`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `members_mobileno_unique` (`mobileNo`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `vehicle_images`
--
ALTER TABLE `vehicle_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicle_info`
--
ALTER TABLE `vehicle_info`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auction_group_name`
--
ALTER TABLE `auction_group_name`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bid`
--
ALTER TABLE `bid`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vehicle_images`
--
ALTER TABLE `vehicle_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `vehicle_info`
--
ALTER TABLE `vehicle_info`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
