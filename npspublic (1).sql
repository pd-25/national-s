-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 07, 2025 at 02:44 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `npspublic`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `usertype` tinyint(4) NOT NULL COMMENT '0=teacher, 1=admin 2=staff',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `usertype`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'Admin@gmail.com', 1, NULL, '$2y$12$keP1v4apV3hHsxMIIKwmMe556h7OdPNR6YjYydZGisGUF3x5PnWca', NULL, '2025-03-04 06:01:34', '2025-03-04 06:01:34'),
(5, 'Sudip Pal', 'sudip@gmail.com', 0, NULL, '$2y$12$Tr3OXOC6GcMLEwmQUfJAWusys17mUtaYcmQFy245wR1ivCLjYNX2S', NULL, '2025-03-09 00:56:21', '2025-03-09 00:56:21'),
(6, 'Teacher 01', 'teacher01@gmail.com', 0, NULL, '$2y$12$tFd5aR9Bsp1wzAEj3B9mJOP4HEHNLvVLPdTni1LINuHMfBV6NS72C', NULL, '2025-03-09 01:55:13', '2025-03-09 01:55:13'),
(7, 'Teacher 02', 'teacher02@gmail.com', 0, NULL, '$2y$12$IDu3TgovzA0/E6XJHco/C.ob6cBBUisbkXqMKZCY4IBi4Em71apZm', NULL, '2025-03-09 01:56:33', '2025-03-09 01:56:33'),
(8, 'Staff', 'staff@gmail.com', 2, NULL, '$2y$12$keP1v4apV3hHsxMIIKwmMe556h7OdPNR6YjYydZGisGUF3x5PnWca', NULL, '2025-03-04 06:01:34', '2025-03-04 06:01:34');

-- --------------------------------------------------------

--
-- Table structure for table `admission_notices`
--

CREATE TABLE `admission_notices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admi_notice_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admi_notice_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=approved, 0=pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admission_notices`
--

INSERT INTO `admission_notices` (`id`, `admi_notice_name`, `admi_notice_date`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', '2025-03-02 18:30:00', NULL, 1, '2025-03-03 13:18:35', '2025-03-03 13:18:35'),
(2, 'Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s.', '2025-03-02 18:30:00', NULL, 1, '2025-03-03 13:18:48', '2025-03-03 13:18:48'),
(3, 'Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', '2025-01-14 18:30:00', NULL, 1, '2025-03-03 13:19:05', '2025-03-03 13:19:05');

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `teacher_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `session_id` bigint(20) UNSIGNED NOT NULL,
  `class_id` bigint(20) UNSIGNED NOT NULL,
  `section_id` bigint(20) UNSIGNED NOT NULL,
  `date_taken` date DEFAULT NULL,
  `time_taken` time DEFAULT NULL,
  `late` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attendances`
--

INSERT INTO `attendances` (`id`, `teacher_id`, `user_id`, `session_id`, `class_id`, `section_id`, `date_taken`, `time_taken`, `late`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 395, 9, 28, 31, '2025-03-23', '14:10:00', 0, 1, '2025-03-24 08:40:41', '2025-03-24 08:40:41'),
(2, 1, 396, 9, 28, 31, '2025-03-23', '14:10:00', 0, 1, '2025-03-24 08:40:43', '2025-03-24 08:40:43'),
(3, 1, 397, 9, 28, 31, '2025-03-23', '14:10:00', 0, 1, '2025-03-24 08:40:45', '2025-03-24 08:40:45'),
(4, 1, 398, 9, 28, 31, '2025-03-23', '14:10:00', 0, 0, '2025-03-24 08:40:48', '2025-03-24 08:40:48'),
(5, 1, 399, 9, 28, 31, '2025-03-23', '14:10:00', 0, 1, '2025-03-24 08:40:50', '2025-03-24 08:40:50'),
(6, 1, 400, 9, 28, 31, '2025-03-23', '14:10:00', 0, 1, '2025-03-24 08:40:52', '2025-03-24 08:40:52'),
(7, 1, 401, 9, 28, 31, '2025-03-23', '14:10:00', 0, 1, '2025-03-24 08:40:54', '2025-03-24 08:40:54'),
(8, 1, 402, 9, 28, 31, '2025-03-23', '14:10:00', 1, 1, '2025-03-24 08:40:56', '2025-03-24 08:40:56'),
(9, 1, 403, 9, 28, 31, '2025-03-23', '14:11:00', 1, 1, '2025-03-24 08:41:00', '2025-03-24 08:41:00'),
(10, 1, 404, 9, 28, 31, '2025-03-23', '14:11:00', 0, 1, '2025-03-24 08:41:02', '2025-03-24 08:41:02'),
(11, 1, 405, 9, 28, 31, '2025-03-23', '14:11:00', 0, 1, '2025-03-24 08:41:04', '2025-03-24 08:41:04'),
(12, 1, 406, 9, 28, 31, '2025-03-23', '14:11:00', 0, 1, '2025-03-24 08:41:06', '2025-03-24 08:41:06'),
(13, 1, 407, 9, 28, 31, '2025-03-23', '14:11:00', 0, 1, '2025-03-24 08:41:08', '2025-03-24 08:41:08'),
(14, 1, 408, 9, 28, 31, '2025-03-23', '14:11:00', 0, 1, '2025-03-24 08:41:10', '2025-03-24 08:41:10'),
(15, 1, 410, 9, 28, 31, '2025-03-23', '14:11:00', 0, 1, '2025-03-24 08:41:12', '2025-03-24 08:41:12'),
(16, 1, 409, 9, 28, 31, '2025-03-23', '14:11:00', 0, 1, '2025-03-24 08:41:13', '2025-03-24 08:41:13'),
(17, 1, 411, 9, 28, 31, '2025-03-23', '14:11:00', 0, 1, '2025-03-24 08:41:15', '2025-03-24 08:41:15'),
(18, 1, 412, 9, 28, 31, '2025-03-23', '14:11:00', 0, 0, '2025-03-24 08:41:17', '2025-03-24 08:41:17'),
(19, 1, 413, 9, 28, 31, '2025-03-23', '14:11:00', 0, 0, '2025-03-24 08:41:19', '2025-03-24 08:41:19'),
(20, 1, 414, 9, 28, 31, '2025-03-23', '14:11:00', 0, 1, '2025-03-24 08:41:23', '2025-03-24 08:41:23'),
(21, 1, 415, 9, 28, 31, '2025-03-23', '14:11:00', 0, 1, '2025-03-24 08:41:25', '2025-03-24 08:41:25'),
(22, 1, 416, 9, 28, 31, '2025-03-23', '14:11:00', 1, 1, '2025-03-24 08:41:27', '2025-03-24 08:41:27'),
(23, 1, 417, 9, 28, 31, '2025-03-23', '14:11:00', 0, 1, '2025-03-24 08:41:28', '2025-03-24 08:41:28'),
(24, 7, 395, 9, 28, 31, '2025-04-02', '17:49:00', 0, 1, '2025-04-02 12:19:06', '2025-04-02 12:19:06'),
(25, 7, 396, 9, 28, 31, '2025-04-02', '17:49:00', 0, 0, '2025-04-02 12:19:06', '2025-04-02 12:19:06'),
(26, 7, 397, 9, 28, 31, '2025-04-02', '17:49:00', 0, 0, '2025-04-02 12:19:07', '2025-04-02 12:19:07'),
(27, 7, 398, 9, 28, 31, '2025-04-02', '17:49:00', 0, 1, '2025-04-02 12:19:09', '2025-04-02 12:19:09'),
(28, 7, 399, 9, 28, 31, '2025-04-02', '17:49:00', 0, 1, '2025-04-02 12:19:10', '2025-04-02 12:19:10'),
(29, 7, 400, 9, 28, 31, '2025-04-02', '17:49:00', 1, 1, '2025-04-02 12:19:12', '2025-04-02 12:19:12'),
(30, 7, 401, 9, 28, 31, '2025-04-02', '17:49:00', 1, 1, '2025-04-02 12:19:12', '2025-04-02 12:19:12'),
(31, 7, 402, 9, 28, 31, '2025-04-02', '17:49:00', 0, 1, '2025-04-02 12:19:13', '2025-04-02 12:19:13'),
(32, 7, 403, 9, 28, 31, '2025-04-02', '17:49:00', 0, 1, '2025-04-02 12:19:14', '2025-04-02 12:19:14'),
(33, 7, 404, 9, 28, 31, '2025-04-02', '17:49:00', 1, 1, '2025-04-02 12:19:16', '2025-04-02 12:19:16'),
(34, 7, 405, 9, 28, 31, '2025-04-02', '17:49:00', 0, 1, '2025-04-02 12:19:16', '2025-04-02 12:19:16'),
(35, 7, 406, 9, 28, 31, '2025-04-02', '17:49:00', 1, 1, '2025-04-02 12:19:18', '2025-04-02 12:19:18'),
(36, 7, 407, 9, 28, 31, '2025-04-02', '17:49:00', 0, 0, '2025-04-02 12:19:20', '2025-04-02 12:19:20'),
(37, 7, 408, 9, 28, 31, '2025-04-02', '17:49:00', 0, 0, '2025-04-02 12:19:22', '2025-04-02 12:19:22'),
(38, 7, 410, 9, 28, 31, '2025-04-02', '17:49:00', 1, 1, '2025-04-02 12:19:24', '2025-04-02 12:19:24'),
(39, 7, 411, 9, 28, 31, '2025-04-02', '17:49:00', 0, 0, '2025-04-02 12:19:26', '2025-04-02 12:19:26'),
(40, 7, 412, 9, 28, 31, '2025-04-02', '17:49:00', 0, 0, '2025-04-02 12:19:28', '2025-04-02 12:19:28'),
(41, 7, 414, 9, 28, 31, '2025-04-02', '17:49:00', 0, 0, '2025-04-02 12:19:28', '2025-04-02 12:19:28'),
(42, 7, 413, 9, 28, 31, '2025-04-02', '17:49:00', 0, 1, '2025-04-02 12:19:30', '2025-04-02 12:19:30'),
(43, 7, 415, 9, 28, 31, '2025-04-02', '17:49:00', 0, 1, '2025-04-02 12:19:31', '2025-04-02 12:19:31'),
(44, 7, 416, 9, 28, 31, '2025-04-02', '17:49:00', 0, 1, '2025-04-02 12:19:31', '2025-04-02 12:19:31'),
(46, 7, 417, 9, 28, 31, '2025-04-02', '17:50:00', 1, 1, '2025-04-02 12:20:23', '2025-04-02 12:20:23'),
(47, 1, 231, 9, 17, 21, '2025-04-08', '18:55:00', 0, 1, '2025-04-08 13:25:47', '2025-04-08 13:25:47'),
(48, 1, 232, 9, 17, 21, '2025-04-08', '18:55:00', 0, 1, '2025-04-08 13:25:47', '2025-04-08 13:25:47'),
(49, 1, 233, 9, 17, 21, '2025-04-08', '18:55:00', 0, 1, '2025-04-08 13:25:48', '2025-04-08 13:25:48'),
(50, 1, 234, 9, 17, 21, '2025-04-08', '18:55:00', 0, 1, '2025-04-08 13:25:49', '2025-04-08 13:25:49'),
(51, 1, 235, 9, 17, 21, '2025-04-08', '18:55:00', 0, 1, '2025-04-08 13:25:50', '2025-04-08 13:25:50'),
(52, 1, 236, 9, 17, 21, '2025-04-08', '18:55:00', 0, 1, '2025-04-08 13:25:51', '2025-04-08 13:25:51'),
(53, 1, 237, 9, 17, 21, '2025-04-08', '18:55:00', 0, 1, '2025-04-08 13:25:52', '2025-04-08 13:25:52'),
(66, 7, 231, 9, 17, 21, '2025-04-25', '15:30:00', 0, 1, '2025-04-25 10:00:41', '2025-04-25 10:00:41'),
(67, 7, 233, 9, 17, 21, '2025-04-25', '15:30:00', 0, 0, '2025-04-25 10:00:42', '2025-04-25 10:00:42'),
(68, 7, 234, 9, 17, 21, '2025-04-25', '15:30:00', 1, 1, '2025-04-25 10:00:44', '2025-04-25 10:00:44'),
(69, 7, 235, 9, 17, 21, '2025-04-25', '15:30:00', 0, 0, '2025-04-25 10:00:45', '2025-04-25 10:00:45'),
(70, 7, 236, 9, 17, 21, '2025-04-25', '15:30:00', 0, 1, '2025-04-25 10:00:46', '2025-04-25 10:00:46'),
(71, 7, 237, 9, 17, 21, '2025-04-25', '15:30:00', 0, 1, '2025-04-25 10:00:47', '2025-04-25 10:00:47'),
(72, 7, 232, 9, 17, 21, '2025-04-25', '15:30:00', 0, 0, '2025-04-25 10:00:50', '2025-04-25 10:00:50');

-- --------------------------------------------------------

--
-- Table structure for table `campus_galaries`
--

CREATE TABLE `campus_galaries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `program_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `campus_galaries`
--

INSERT INTO `campus_galaries` (`id`, `program_name`, `image`, `created_at`, `updated_at`) VALUES
(1, 'test', '/storage/campusGalary/2025-03-04-07_14_56_gal-pic1.jpg', '2025-03-04 01:44:56', '2025-03-04 01:44:56'),
(2, 'test', '/storage/campusGalary/2025-03-04-07_14_56_gal-pic2.jpg', '2025-03-04 01:44:56', '2025-03-04 01:44:56'),
(3, 'test', '/storage/campusGalary/2025-03-04-07_14_56_gal-pic3.jpg', '2025-03-04 01:44:56', '2025-03-04 01:44:56'),
(4, 'test', '/storage/campusGalary/2025-03-04-07_14_56_gal-pic4.jpg', '2025-03-04 01:44:56', '2025-03-04 01:44:56'),
(6, 'test', '/storage/campusGalary/2025-03-04-07_15_36_gal-pic5.jpg', '2025-03-04 01:45:36', '2025-03-04 01:45:36');

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `class_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `class_name`, `created_at`, `updated_at`) VALUES
(14, 'L.KG', '2025-03-21 05:44:44', '2025-03-21 05:44:44'),
(15, 'U.KG', '2025-03-21 05:44:53', '2025-03-21 05:44:53'),
(16, 'One', '2025-03-21 05:45:10', '2025-03-21 05:45:10'),
(17, 'Two', '2025-03-21 05:45:15', '2025-03-21 05:45:15'),
(18, 'Three', '2025-03-21 05:45:20', '2025-03-21 05:45:20'),
(19, 'Four', '2025-03-21 05:45:24', '2025-03-21 05:45:24'),
(20, 'Five', '2025-03-21 05:46:02', '2025-03-21 05:46:02'),
(21, 'Six', '2025-03-21 05:46:08', '2025-03-21 05:46:08'),
(22, 'Seven', '2025-03-21 05:46:37', '2025-03-21 05:46:37'),
(23, 'Eight', '2025-03-21 05:46:41', '2025-03-21 05:46:41'),
(24, 'Nine', '2025-03-21 05:46:58', '2025-03-21 05:46:58'),
(25, 'Ten', '2025-03-21 05:47:03', '2025-03-21 05:47:03'),
(27, 'Eleven', '2025-03-21 05:47:09', '2025-03-21 05:47:09'),
(28, 'Twelve', '2025-03-21 05:47:14', '2025-03-21 05:47:14');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1=approved, 0=pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `first_name`, `last_name`, `email`, `phone_no`, `message`, `ip_address`, `status`, `created_at`, `updated_at`) VALUES
(5, 'Emon', NULL, 'emon.nath71@gmail.com', NULL, 'adasdad  adbshasjdna a sdaskdna', '127.0.0.1', 0, '2025-04-25 13:41:27', '2025-04-25 13:41:27');

-- --------------------------------------------------------

--
-- Table structure for table `deposites`
--

CREATE TABLE `deposites` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `payment_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `student_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parents_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `session_id` bigint(20) UNSIGNED NOT NULL,
  `class_id` bigint(20) UNSIGNED NOT NULL,
  `section_id` bigint(20) UNSIGNED NOT NULL,
  `month` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admission_charges` decimal(10,2) DEFAULT NULL,
  `enrolment_fee` decimal(10,2) DEFAULT NULL,
  `tuition_fee` decimal(10,2) DEFAULT NULL,
  `terminal_fee` decimal(10,2) DEFAULT NULL,
  `sports` decimal(10,2) DEFAULT NULL,
  `sports_comments` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `misc_charges` decimal(10,2) DEFAULT NULL,
  `misc_charges_comments` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `identity_card` decimal(10,2) DEFAULT NULL,
  `scholarship_concession` decimal(10,2) DEFAULT NULL,
  `scholarship_concession_comments` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total` decimal(18,2) NOT NULL,
  `payment_mode` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cheque_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cheque_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_ref_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_getway_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `deposites`
--

INSERT INTO `deposites` (`id`, `payment_number`, `user_id`, `student_name`, `parents_name`, `address`, `mobile_no`, `session_id`, `class_id`, `section_id`, `month`, `year`, `admission_charges`, `enrolment_fee`, `tuition_fee`, `terminal_fee`, `sports`, `sports_comments`, `misc_charges`, `misc_charges_comments`, `identity_card`, `scholarship_concession`, `scholarship_concession_comments`, `total`, `payment_mode`, `transaction_id`, `cheque_no`, `cheque_date`, `bank_name`, `branch`, `payment_ref_no`, `payment_getway_id`, `status`, `created_at`, `updated_at`) VALUES
(7, '250425001', 231, 'NYRA SINGH', 'RANDHIR SINGH', '128 TARAMONI GHAT  ROAD PASCHIM PUTIARY KOL-41, ', '9063567455', 11, 18, 22, 'April', '2025', NULL, '200.00', '400.00', '0.00', NULL, NULL, '0.00', NULL, '100.00', NULL, NULL, '700.00', 'Cash', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Completed', '2025-04-25 10:56:12', '2025-04-25 10:56:12'),
(8, '250504001', 418, 'Emon Debnath', 'Test data', 'Debnath house, Nabapally, Near Jogendranath school, 700126', '6291648982', 11, 18, 22, 'January', '2025', NULL, '1000.00', '800.00', '700.00', NULL, NULL, '400.00', NULL, '300.00', NULL, NULL, '5500.00', 'Cash', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Completed', '2025-05-04 18:06:12', '2025-05-04 18:06:12'),
(9, '250504002', 418, 'Emon Debnath', 'Test data', 'Debnath house, Nabapally, Near Jogendranath school, 700126', '6291648982', 11, 18, 22, 'February', '2025', NULL, '200.00', '300.00', '400.00', NULL, NULL, '598.00', NULL, '700.00', NULL, NULL, '2398.00', 'Cash', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Completed', '2025-05-04 18:09:25', '2025-05-04 18:09:25'),
(10, '250504003', 418, 'Emon Debnath', 'Test data', 'Debnath house, Nabapally, Near Jogendranath school, 700126', '6291648982', 11, 18, 22, 'March', '2025', NULL, '46.00', '445.00', '43.00', NULL, NULL, '4564.00', NULL, '34.00', NULL, NULL, '5788.00', 'Cash', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Completed', '2025-05-04 18:11:15', '2025-05-04 18:11:15'),
(11, '250504004', 418, 'Emon Debnath', 'Test data', 'Debnath house, Nabapally, Near Jogendranath school, 700126', '6291648982', 11, 18, 22, 'May', '2025', '3123.00', '123.00', '312.00', '123.00', '123.00', NULL, '123.00', NULL, '12.00', '121.00', NULL, '3818.00', 'Cash', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Completed', '2025-05-04 18:14:28', '2025-05-04 18:14:28'),
(16, '250507001', 223, 'AAYANSH SHARMA', 'PARESH SHARMA', '937A OSTAD AMIR KHAN SARANI KOL-82, ', '8777480239', 11, 17, 21, 'May', '2025', '2000.00', NULL, '800.00', '550.00', '300.00', 'test', NULL, 'test 2', NULL, '200.00', 'test 3', '3450.00', 'Cash', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Completed', '2025-05-07 10:56:11', '2025-05-07 10:56:11');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `event_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `event_desc` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `event_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=approved, 0=pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `event_name`, `event_slug`, `event_date`, `event_desc`, `event_image`, `status`, `created_at`, `updated_at`) VALUES
(2, 'School Games & Sports', 'school-games-sports', '2025-03-04 10:17:09', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', '/storage/event_images/2025-03-04-10_17_09_event-pic2.jpg', 1, '2025-03-04 04:47:09', '2025-03-04 04:47:09'),
(3, '76th Independence Day', '76th-independence-day', '2025-03-04 10:18:31', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras at vestibulum nunc. Lorem ipsum dolor sit amet.', '/storage/event_images/2025-03-04-10_18_31_event-pic3.jpg', 1, '2025-03-04 04:48:31', '2025-03-04 04:48:31'),
(4, 'Ganesh Chaturthi', 'ganesh-chaturthi', '2025-03-04 10:19:05', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras at vestibulum nunc. Lorem ipsum dolor sit amet.', '/storage/event_images/2025-03-04-10_19_05_event-pic.jpg', 1, '2025-03-04 04:49:05', '2025-03-04 04:49:05');

-- --------------------------------------------------------

--
-- Table structure for table `event_registers`
--

CREATE TABLE `event_registers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `event_id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `school_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `class` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `father_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `contact_number_ii` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=approved, 0=pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `event_registers`
--

INSERT INTO `event_registers` (`id`, `event_id`, `email`, `name`, `date`, `school_name`, `class`, `father_name`, `contact_number`, `amount`, `contact_number_ii`, `status`, `created_at`, `updated_at`) VALUES
(1, 4, 'emon.nath71@gmail.com', 'Emon Debnath', '2025-03-03 18:30:00', 'test', 'sc', 'sadasd', '06291648982', '100.00', NULL, 1, '2025-03-04 07:28:56', '2025-03-04 07:28:56'),
(2, 4, 'emon.nath71@gmail.com', 'Emon Debnath', '2025-03-03 18:30:00', 'test', 'sc', 'sadasd', '06291648982', '233.00', NULL, 0, '2025-03-04 07:30:29', '2025-03-04 07:30:29');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
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
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_02_28_103113_create_contact_us_table', 1),
(6, '2025_03_02_172041_create_news_table', 2),
(8, '2025_03_03_162051_create_notices_table', 3),
(9, '2025_03_03_183424_create_admission_notices_table', 4),
(10, '2025_03_04_055006_create_admins_table', 5),
(11, '2025_03_04_064614_create_campus_galaries_table', 6),
(12, '2025_03_04_094036_create_events_table', 7),
(13, '2025_03_04_112033_create_event_registers_table', 8),
(14, '2025_03_05_080513_create_classes_table', 9),
(15, '2025_03_05_080705_create_sections_table', 9),
(16, '2025_03_06_062408_create_sessions_table', 10),
(21, '2025_03_07_063809_create_student_class_mappings_table', 11),
(22, '2025_03_09_055547_create_teacher_class_mappings_table', 12),
(24, '2014_10_12_000000_create_users_table', 13),
(26, '2025_03_10_094808_create_attendances_table', 14),
(27, '2025_03_13_164221_create_deposites_table', 15),
(30, '2025_05_01_223504_create_payment_settings_table', 16);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `news_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `news_slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `news_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `news_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `news_desc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `news_status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `news_title`, `news_slug`, `news_image`, `news_date`, `news_desc`, `news_status`, `created_at`, `updated_at`) VALUES
(1, 'Lorem ipsum dolor lobortis lorem consectetur elit', 'lorem-ipsum-dolor-lobortis-lorem-consectetur-elit', '2025-03-03-10_50_00_news-pic.jpg', '2025-01-26 18:30:00', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><h3>Why do we use it?</h3><p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p><h3>Where does it come from?</h3><p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.</p><h3>Where can I get some?</h3><p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>', 1, '2025-03-03 05:20:00', '2025-03-03 05:20:00'),
(2, 'Lorem ipsum dolor lobortis lorem consectetur elit', 'lorem-ipsum-dolor-lobortis-lorem-consectetur-elit-ii', '2025-03-03-11_30_47_news-pic.jpg', '2025-03-02 18:30:00', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><h3>Why do we use it?</h3><p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p><h3>Where does it come from?</h3><p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.</p><h3>Where can I get some?</h3><p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>', 1, '2025-03-03 06:00:47', '2025-03-03 06:00:47'),
(7, 'Lorem ipsum dolor lobortis lorem consectetur elit', 'lorem-ipsum-dolor-lobortis-lorem-consectetur-elit-poas', '2025-03-03-10_50_00_news-pic.jpg', '2025-02-17 18:30:00', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><h3>Why do we use it?</h3><p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p><h3>Where does it come from?</h3><p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.</p><h3>Where can I get some?</h3><p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>', 1, '2025-03-03 05:20:00', '2025-03-03 05:20:00');

-- --------------------------------------------------------

--
-- Table structure for table `notices`
--

CREATE TABLE `notices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `notice_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `notice_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(2) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notices`
--

INSERT INTO `notices` (`id`, `notice_name`, `notice_date`, `image`, `status`, `created_at`, `updated_at`) VALUES
(3, 'Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', '2025-01-07 18:30:00', NULL, 1, '2025-03-03 11:55:42', '2025-03-03 11:55:42'),
(4, 'Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', '2025-03-02 18:30:00', NULL, 1, '2025-03-03 12:02:24', '2025-03-03 12:02:24'),
(5, 'Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s.', '2025-02-12 18:30:00', NULL, 1, '2025-03-03 12:02:39', '2025-03-03 12:02:39'),
(6, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit lorean epsonm iplosa sadkja hsdkha loaena', '2025-03-02 18:30:00', '/storage/notice/2025-03-03-19_15_19_scholastic-pic1.jpg', 1, '2025-03-03 13:45:19', '2025-03-03 13:45:19'),
(8, 'Where can I get some?\r\nThere are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator', '2025-04-24 18:30:00', '/storage/notice/2025-04-25-18_56_40_school-timings-img.jpg', 1, '2025-04-25 13:26:40', '2025-04-25 13:26:40');

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
-- Table structure for table `payment_settings`
--

CREATE TABLE `payment_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `session_id` bigint(20) UNSIGNED NOT NULL,
  `class_id` bigint(20) UNSIGNED NOT NULL,
  `section_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `apply_to_all` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admission_charges` decimal(10,2) DEFAULT NULL,
  `admission_charges_months_validation` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `enrolment_fee` decimal(10,2) DEFAULT NULL,
  `enrolment_fee_months_validation` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tuition_fee` decimal(10,2) DEFAULT NULL,
  `tuition_fee_months_validation` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `terminal_fee` decimal(10,2) DEFAULT NULL,
  `terminal_fee_months_validation` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sports` decimal(10,2) DEFAULT NULL,
  `sports_months_validation` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `misc_charges` decimal(10,2) DEFAULT NULL,
  `misc_charges_months_validation` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scholarship_concession` decimal(10,2) DEFAULT NULL,
  `scholarship_concession_validation` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_settings`
--

INSERT INTO `payment_settings` (`id`, `session_id`, `class_id`, `section_id`, `user_id`, `apply_to_all`, `admission_charges`, `admission_charges_months_validation`, `enrolment_fee`, `enrolment_fee_months_validation`, `tuition_fee`, `tuition_fee_months_validation`, `terminal_fee`, `terminal_fee_months_validation`, `sports`, `sports_months_validation`, `misc_charges`, `misc_charges_months_validation`, `scholarship_concession`, `scholarship_concession_validation`, `status`, `created_at`, `updated_at`) VALUES
(1, 11, 18, 22, 231, 'applyallstudent', '2000.00', '[\"February\",\"April\",\"June\",\"August\",\"November\"]', '1000.00', '[\"March\",\"June\",\"September\",\"December\"]', '500.00', '[\"January\",\"March\",\"May\",\"July\",\"September\",\"November\"]', '100.00', '[\"January\",\"March\",\"May\",\"July\",\"September\",\"November\"]', '500.00', '[\"April\",\"May\",\"June\",\"July\"]', '300.00', '[\"March\",\"April\",\"May\"]', NULL, 'null', 1, '2025-05-06 10:40:46', '2025-05-06 10:40:46'),
(2, 11, 18, 22, 418, 'applyallstudent', '2000.00', '[\"February\",\"April\",\"June\",\"August\",\"November\"]', '1000.00', '[\"March\",\"June\",\"September\",\"December\"]', '500.00', '[\"January\",\"March\",\"May\",\"July\",\"September\",\"November\"]', '100.00', '[\"January\",\"March\",\"May\",\"July\",\"September\",\"November\"]', '500.00', '[\"April\",\"May\",\"June\",\"July\"]', '300.00', '[\"March\",\"April\",\"May\"]', NULL, 'null', 1, '2025-05-06 10:40:46', '2025-05-06 10:40:46'),
(3, 11, 17, 21, 223, 'applyallstudent', '2000.00', '[\"February\",\"March\",\"April\",\"May\",\"September\",\"December\"]', '1000.00', '[\"February\",\"April\",\"June\",\"November\",\"December\"]', '800.00', '[\"January\",\"February\",\"March\",\"April\",\"May\",\"June\",\"July\",\"August\",\"September\",\"October\",\"November\",\"December\"]', '550.00', '[\"February\",\"May\",\"July\",\"September\",\"November\"]', '300.00', '[\"January\",\"February\",\"March\",\"April\",\"May\",\"June\",\"July\",\"August\",\"September\",\"October\",\"November\",\"December\"]', '200.00', '[\"February\",\"April\",\"June\",\"July\",\"November\",\"December\"]', '200.00', '[\"February\",\"March\",\"May\",\"June\",\"July\",\"November\",\"December\"]', 1, '2025-05-06 12:53:07', '2025-05-06 13:20:24'),
(4, 11, 17, 21, 224, 'applyallstudent', '2000.00', '[\"February\",\"March\",\"April\",\"May\",\"September\",\"December\"]', '800.00', '[\"February\",\"April\",\"June\",\"November\",\"December\"]', '1000.00', '[\"January\",\"February\",\"March\",\"April\",\"May\",\"June\",\"July\",\"August\",\"September\",\"October\",\"November\",\"December\"]', '500.00', '[\"February\",\"May\",\"July\",\"September\",\"November\"]', '300.00', '[\"February\",\"April\",\"June\",\"August\",\"September\",\"November\",\"December\"]', '200.00', '[\"February\",\"April\",\"June\",\"July\",\"November\",\"December\"]', '200.00', '[\"February\",\"March\",\"May\",\"June\",\"July\",\"November\",\"December\"]', 1, '2025-05-06 12:53:07', '2025-05-06 12:53:07'),
(5, 11, 17, 21, 225, 'applyallstudent', '2000.00', '[\"February\",\"March\",\"April\",\"May\",\"September\",\"December\"]', '800.00', '[\"February\",\"April\",\"June\",\"November\",\"December\"]', '1000.00', '[\"January\",\"February\",\"March\",\"April\",\"May\",\"June\",\"July\",\"August\",\"September\",\"October\",\"November\",\"December\"]', '500.00', '[\"February\",\"May\",\"July\",\"September\",\"November\"]', '300.00', '[\"February\",\"April\",\"June\",\"August\",\"September\",\"November\",\"December\"]', '200.00', '[\"February\",\"April\",\"June\",\"July\",\"November\",\"December\"]', '200.00', '[\"February\",\"March\",\"May\",\"June\",\"July\",\"November\",\"December\"]', 1, '2025-05-06 12:53:07', '2025-05-06 12:53:07'),
(7, 11, 17, 21, 226, 'applyallstudent', '3000.00', '[\"January\",\"February\",\"March\",\"April\",\"May\"]', '2000.00', '[\"April\",\"May\",\"June\",\"July\"]', '1000.00', '[\"September\",\"October\",\"November\",\"December\"]', '500.00', '[\"February\",\"April\",\"July\",\"November\"]', '400.00', '[\"March\",\"July\",\"November\",\"December\"]', '300.00', '[\"March\",\"May\",\"July\",\"September\",\"December\"]', '200.00', '[\"February\",\"April\",\"May\",\"June\",\"November\",\"December\"]', 1, '2025-05-06 13:01:10', '2025-05-06 13:01:10');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `class_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `section_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=approved, 0=pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `class_id`, `section_name`, `status`, `created_at`, `updated_at`) VALUES
(17, '14', 'S1', 1, '2025-03-21 05:47:56', '2025-03-21 05:47:56'),
(18, '15', 'S1', 1, '2025-03-21 05:48:02', '2025-03-21 05:48:02'),
(20, '16', 'S1', 1, '2025-03-21 05:48:07', '2025-03-21 05:48:07'),
(21, '17', 'S1', 1, '2025-03-21 05:48:23', '2025-03-21 05:48:23'),
(22, '18', 'S1', 1, '2025-03-21 05:48:30', '2025-03-21 05:48:30'),
(23, '19', 'S1', 1, '2025-03-21 05:48:38', '2025-03-21 05:48:38'),
(24, '20', 'S1', 1, '2025-03-21 05:48:44', '2025-03-21 05:48:44'),
(25, '21', 'S1', 1, '2025-03-21 05:48:56', '2025-03-21 05:48:56'),
(26, '22', 'S1', 1, '2025-03-21 05:49:18', '2025-03-21 05:49:18'),
(27, '23', 'S1', 1, '2025-03-21 05:49:25', '2025-03-21 05:49:25'),
(28, '24', 'S1', 1, '2025-03-21 05:49:32', '2025-03-21 05:49:32'),
(29, '25', 'S1', 1, '2025-03-21 05:50:11', '2025-03-21 05:50:11'),
(30, '27', 'S1', 1, '2025-03-21 05:50:27', '2025-03-21 05:50:27'),
(31, '28', 'Science', 1, '2025-03-21 05:50:35', '2025-04-09 08:02:08'),
(32, '28', 'Commerce', 1, '2025-04-09 08:02:18', '2025-04-09 08:02:18'),
(33, '28', 'Arts', 1, '2025-04-09 08:02:47', '2025-04-09 08:02:47');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sessions_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `section_valid_from` date NOT NULL,
  `section_valid_to` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=active, 0=pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `sessions_name`, `section_valid_from`, `section_valid_to`, `status`, `created_at`, `updated_at`) VALUES
(9, '2024/2025', '2024-03-01', '2025-03-31', 0, '2025-03-21 05:53:01', '2025-05-01 06:12:01'),
(11, '2025/2026', '2025-04-01', '2026-02-28', 1, '2025-04-25 06:29:30', '2025-05-01 06:12:01'),
(12, '2026/2027', '2026-03-01', '2027-12-31', 0, '2025-05-01 06:11:50', '2025-05-01 06:12:01');

-- --------------------------------------------------------

--
-- Table structure for table `student_class_mappings`
--

CREATE TABLE `student_class_mappings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `session_id` bigint(20) UNSIGNED NOT NULL,
  `class_id` bigint(20) UNSIGNED NOT NULL,
  `section_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_class_mappings`
--

INSERT INTO `student_class_mappings` (`id`, `user_id`, `session_id`, `class_id`, `section_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 6, 9, 14, 17, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(2, 7, 9, 14, 17, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(3, 8, 9, 14, 17, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(4, 9, 9, 14, 17, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(5, 10, 9, 14, 17, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(6, 11, 9, 14, 17, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(7, 12, 9, 14, 17, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(8, 13, 9, 14, 17, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(9, 14, 9, 14, 17, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(10, 15, 9, 14, 17, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(15, 221, 9, 15, 18, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(17, 223, 9, 16, 20, 0, '2025-03-20 18:30:00', '2025-05-06 12:36:31'),
(18, 224, 9, 16, 20, 0, '2025-03-20 18:30:00', '2025-05-06 12:37:03'),
(19, 225, 9, 16, 20, 0, '2025-03-20 18:30:00', '2025-05-06 12:37:27'),
(20, 226, 9, 16, 20, 0, '2025-03-20 18:30:00', '2025-05-06 12:38:14'),
(21, 227, 9, 16, 20, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(22, 228, 9, 16, 20, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(23, 229, 9, 16, 20, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(24, 230, 9, 16, 20, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(25, 231, 9, 17, 21, 0, '2025-03-20 18:30:00', '2025-04-25 10:56:12'),
(26, 232, 9, 17, 21, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(27, 233, 9, 17, 21, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(28, 234, 9, 17, 21, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(29, 235, 9, 17, 21, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(30, 236, 9, 17, 21, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(31, 237, 9, 17, 21, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(32, 238, 9, 18, 22, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(33, 239, 9, 18, 22, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(34, 240, 9, 18, 22, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(35, 241, 9, 18, 22, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(36, 242, 9, 18, 22, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(37, 243, 9, 18, 22, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(38, 244, 9, 18, 22, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(39, 245, 9, 18, 22, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(40, 246, 9, 18, 22, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(41, 247, 9, 18, 22, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(42, 248, 9, 18, 22, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(43, 249, 9, 18, 22, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(44, 250, 9, 18, 22, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(45, 251, 9, 18, 22, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(46, 252, 9, 18, 22, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(47, 253, 9, 18, 22, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(48, 254, 9, 18, 22, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(49, 255, 9, 18, 22, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(50, 256, 9, 18, 22, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(51, 257, 9, 18, 22, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(52, 258, 9, 18, 22, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(53, 259, 9, 18, 22, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(54, 260, 9, 19, 23, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(55, 261, 9, 19, 23, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(56, 262, 9, 19, 23, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(57, 263, 9, 19, 23, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(58, 264, 9, 19, 23, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(59, 265, 9, 19, 23, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(60, 266, 9, 19, 23, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(61, 267, 9, 19, 23, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(62, 268, 9, 20, 24, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(63, 269, 9, 20, 24, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(64, 270, 9, 20, 24, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(65, 271, 9, 20, 24, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(66, 272, 9, 20, 24, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(67, 273, 9, 20, 24, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(68, 274, 9, 20, 24, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(69, 275, 9, 20, 24, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(70, 276, 9, 20, 24, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(71, 277, 9, 20, 24, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(72, 278, 9, 20, 24, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(73, 279, 9, 21, 25, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(74, 280, 9, 21, 25, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(75, 281, 9, 21, 25, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(76, 282, 9, 21, 25, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(77, 283, 9, 21, 25, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(78, 284, 9, 21, 25, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(79, 285, 9, 21, 25, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(80, 286, 9, 21, 25, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(81, 287, 9, 21, 25, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(82, 288, 9, 21, 25, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(83, 289, 9, 21, 25, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(84, 290, 9, 21, 25, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(85, 291, 9, 21, 25, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(86, 292, 9, 21, 25, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(87, 293, 9, 21, 25, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(88, 294, 9, 21, 25, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(89, 295, 9, 21, 25, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(90, 296, 9, 22, 26, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(91, 297, 9, 22, 26, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(92, 298, 9, 22, 26, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(93, 299, 9, 22, 26, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(94, 300, 9, 22, 26, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(95, 301, 9, 22, 26, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(96, 302, 9, 22, 26, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(97, 303, 9, 22, 26, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(98, 304, 9, 22, 26, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(99, 305, 9, 22, 26, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(100, 306, 9, 22, 26, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(101, 307, 9, 22, 26, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(102, 308, 9, 22, 26, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(103, 309, 9, 22, 26, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(104, 310, 9, 22, 26, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(105, 311, 9, 22, 26, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(106, 312, 9, 22, 26, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(107, 313, 9, 22, 26, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(108, 314, 9, 22, 26, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(109, 315, 9, 22, 26, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(110, 316, 9, 23, 27, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(111, 317, 9, 23, 27, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(112, 318, 9, 23, 27, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(113, 319, 9, 23, 27, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(114, 320, 9, 23, 27, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(115, 321, 9, 23, 27, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(116, 322, 9, 23, 27, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(117, 323, 9, 23, 27, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(118, 324, 9, 23, 27, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(119, 325, 9, 23, 27, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(120, 326, 9, 23, 27, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(121, 327, 9, 23, 27, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(122, 328, 9, 23, 27, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(123, 329, 9, 23, 27, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(124, 330, 9, 23, 27, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(125, 331, 9, 23, 27, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(126, 332, 9, 23, 27, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(127, 333, 9, 23, 27, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(128, 334, 9, 23, 27, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(129, 335, 9, 23, 27, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(130, 336, 9, 23, 27, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(131, 337, 9, 23, 27, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(132, 338, 9, 23, 27, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(133, 339, 9, 23, 27, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(134, 340, 9, 23, 27, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(135, 341, 9, 23, 27, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(136, 342, 9, 24, 28, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(137, 343, 9, 24, 28, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(138, 344, 9, 24, 28, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(139, 345, 9, 24, 28, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(140, 346, 9, 24, 28, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(141, 347, 9, 24, 28, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(142, 348, 9, 24, 28, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(143, 349, 9, 24, 28, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(144, 350, 9, 24, 28, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(145, 351, 9, 24, 28, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(146, 352, 9, 24, 28, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(147, 353, 9, 24, 28, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(148, 354, 9, 24, 28, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(149, 355, 9, 24, 28, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(150, 356, 9, 24, 28, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(151, 357, 9, 24, 28, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(152, 358, 9, 24, 28, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(153, 359, 9, 24, 28, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(154, 360, 9, 24, 28, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(155, 361, 9, 24, 28, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(156, 362, 9, 24, 28, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(157, 363, 9, 24, 28, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(158, 364, 9, 24, 28, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(159, 365, 9, 24, 28, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(160, 366, 9, 24, 28, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(161, 367, 9, 24, 28, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(162, 368, 9, 24, 28, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(163, 369, 9, 24, 28, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(164, 370, 9, 24, 28, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(165, 371, 9, 25, 29, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(166, 372, 9, 25, 29, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(167, 373, 9, 25, 29, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(168, 374, 9, 25, 29, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(169, 375, 9, 25, 29, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(170, 376, 9, 25, 29, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(171, 377, 9, 25, 29, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(172, 378, 9, 25, 29, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(173, 379, 9, 25, 29, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(174, 380, 9, 25, 29, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(175, 381, 9, 25, 29, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(176, 382, 9, 25, 29, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(177, 383, 9, 25, 29, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(178, 384, 9, 25, 29, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(179, 385, 9, 25, 29, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(180, 386, 9, 25, 29, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(181, 387, 9, 25, 29, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(182, 388, 9, 25, 29, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(183, 389, 9, 25, 29, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(184, 390, 9, 25, 29, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(185, 391, 9, 25, 29, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(186, 392, 9, 25, 29, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(187, 393, 9, 25, 29, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(188, 394, 9, 25, 29, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(189, 395, 9, 28, 31, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(190, 396, 9, 28, 31, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(191, 397, 9, 28, 31, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(192, 398, 9, 28, 31, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(193, 399, 9, 28, 31, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(194, 400, 9, 28, 31, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(195, 401, 9, 28, 31, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(196, 402, 9, 28, 31, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(197, 403, 9, 28, 31, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(198, 404, 9, 28, 31, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(199, 405, 9, 28, 31, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(200, 406, 9, 28, 31, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(201, 407, 9, 28, 31, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(202, 408, 9, 28, 31, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(203, 409, 9, 28, 31, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(204, 410, 9, 28, 31, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(205, 411, 9, 28, 31, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(206, 412, 9, 28, 31, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(207, 413, 9, 28, 31, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(208, 414, 9, 28, 31, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(209, 415, 9, 28, 31, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(210, 416, 9, 28, 31, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(211, 417, 9, 28, 31, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(217, 231, 11, 18, 22, 1, '2025-04-25 10:56:12', '2025-04-25 10:56:12'),
(218, 418, 11, 18, 22, 1, '2025-04-25 10:59:08', '2025-04-25 10:59:08'),
(219, 223, 11, 17, 21, 1, '2025-05-06 12:36:31', '2025-05-06 12:36:31'),
(220, 224, 11, 17, 21, 1, '2025-05-06 12:37:03', '2025-05-06 12:37:03'),
(221, 225, 11, 17, 21, 1, '2025-05-06 12:37:27', '2025-05-06 12:37:27'),
(222, 226, 11, 17, 21, 1, '2025-05-06 12:38:14', '2025-05-06 12:38:14');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_class_mappings`
--

CREATE TABLE `teacher_class_mappings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `teacher_id` bigint(20) UNSIGNED NOT NULL,
  `class_id` bigint(20) UNSIGNED NOT NULL,
  `section_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teacher_class_mappings`
--

INSERT INTO `teacher_class_mappings` (`id`, `teacher_id`, `class_id`, `section_id`, `created_at`, `updated_at`) VALUES
(1, 7, 17, 21, '2025-03-24 08:59:18', '2025-04-25 10:00:00'),
(2, 6, 15, 18, '2025-04-25 09:52:32', '2025-04-25 09:52:32'),
(3, 5, 18, 22, '2025-04-25 09:52:51', '2025-04-25 09:59:46');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admission_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `student_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `aadhar_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nationality` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `religion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `caste` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `pin_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mother_tongue` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `blood_group` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stream` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `combination_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `school_name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `academic_session` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `class` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `second_language` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `achievements` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `previous_school_info` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_relation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qualification` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `occupation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `organization` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `designation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_aadhar_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `annual_income` decimal(10,2) DEFAULT NULL,
  `office_contact_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mention_relationship` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transport_facility` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `route` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=approved, 0=pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `admission_number`, `image`, `student_name`, `date_of_birth`, `aadhar_no`, `nationality`, `religion`, `gender`, `caste`, `address`, `pin_code`, `mother_tongue`, `blood_group`, `stream`, `combination_text`, `school_name`, `academic_session`, `class`, `second_language`, `achievements`, `previous_school_info`, `parent_name`, `parent_relation`, `qualification`, `occupation`, `organization`, `designation`, `mobile_no`, `parent_aadhar_number`, `annual_income`, `office_contact_number`, `mention_relationship`, `transport_facility`, `route`, `email`, `password`, `status`, `created_at`, `updated_at`) VALUES
(6, 'NPS2025001', NULL, 'SRIJAN SHAI', NULL, NULL, '', NULL, NULL, NULL, '17 NABAPALLY P.B ROAD KOL-34', NULL, NULL, 'O-', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'MR. AMIT SHAI', NULL, NULL, NULL, NULL, NULL, '9874014461', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(7, 'NPS2025002', NULL, 'ARCHISMAN DAS', NULL, NULL, '', NULL, NULL, NULL, '102/B P.N. MITRA BRICK FIELD ROAD,SOUTHCITY GARDEN,TARAPARK PUMPHOUSE KOL-53', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ARUN KR. DAS', NULL, NULL, NULL, NULL, NULL, '8910284162', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(8, 'NPS2025003', NULL, 'ARNA METIA', NULL, NULL, '', NULL, NULL, NULL, '91/22 B.C SAHA ROAD KOL-53 ', NULL, NULL, 'B+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ANJAN METIA', NULL, NULL, NULL, NULL, NULL, '8274930950', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(9, 'NPS2025004', NULL, 'ARNA BAGCHI', NULL, NULL, '', NULL, NULL, NULL, 'B.L. SAHA ROAD 265G KOL--53', NULL, NULL, 'AB+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ARGHA BAGCHI', NULL, NULL, NULL, NULL, NULL, '8013295852', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(10, 'NPS2025005', NULL, 'ARNA GUCHAIT', NULL, NULL, '', NULL, NULL, NULL, '265 D, B.L. SAHA ROAD KOL-53', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ANIRBAN GUCHAIT', NULL, NULL, NULL, NULL, NULL, '7017317484', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(11, 'NPS2025006', NULL, 'AYUSHMAAN GHOSH', NULL, NULL, '', NULL, NULL, NULL, 'D/1 JAYSREE PARK KOL-34', NULL, NULL, 'O+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BISWAJIT GHOSH', NULL, NULL, NULL, NULL, NULL, '9831906261', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(12, 'NPS2025007', NULL, 'SUPROVAT DAS', NULL, NULL, '', NULL, NULL, NULL, '325 JUDGE BAGAN NASKAR PARA ROAD KOLKATA-82', NULL, NULL, 'O+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'PARITOSH DAS', NULL, NULL, NULL, NULL, NULL, '9330718245', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(13, 'NPS2025008', NULL, 'ABHRA ROY', NULL, NULL, '', NULL, NULL, NULL, '14/C RAJANI BHATTACHARJEE LANE KOL-26', NULL, NULL, 'B+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SANTANU ROY', NULL, NULL, NULL, NULL, NULL, '7439984915', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(14, 'NPS2025009', NULL, 'MIVAAN NAYAK', NULL, NULL, '', NULL, NULL, NULL, '63 D . R.R. ROY ROAD KOL-82', NULL, NULL, 'AB+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'PURANJAYA NAYAK', NULL, NULL, NULL, NULL, NULL, '8777568483', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(15, 'NPS2025010', NULL, 'MIVAN AUDDY', NULL, NULL, '', NULL, NULL, NULL, '62/A, J.M. LANE KOL-27', NULL, NULL, 'A+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ANIRBAN AUDDY', NULL, NULL, NULL, NULL, NULL, '9831680314', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(221, 'NPS2025015', NULL, 'PARIDHI JHA', NULL, NULL, NULL, NULL, NULL, NULL, 'KULDARI, P.O-NEPALGUNJ,DIST-24PGS(S) KOL-700103', NULL, NULL, 'O+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SHUBH CHANDRA JHA', NULL, NULL, NULL, NULL, NULL, '7827270322', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(223, 'NPS2025017', NULL, 'AAYANSH SHARMA', NULL, NULL, NULL, NULL, NULL, NULL, '937A OSTAD AMIR KHAN SARANI KOL-82', NULL, NULL, 'O+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'PARESH SHARMA', NULL, NULL, NULL, NULL, NULL, '8777480239', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(224, 'NPS2025018', NULL, 'AVYAANSH TIWARI', NULL, NULL, NULL, NULL, NULL, NULL, '36B/4 CHANDITALA MAIN ROAD KOL-700053', NULL, NULL, 'B+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ANITA TIWARI', NULL, NULL, NULL, NULL, NULL, '8820931541', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(225, 'NPS2025019', NULL, 'RISHAN MONDAL', NULL, NULL, NULL, NULL, NULL, NULL, '36/1 B P.N. MITRA BRICK FIELD ROAD KOL-41', NULL, NULL, 'AB+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SURATH MONDAL', NULL, NULL, NULL, NULL, NULL, '7003503668', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(226, 'NPS2025020', NULL, 'ABHAY PRATAP SINGH', NULL, NULL, NULL, NULL, NULL, NULL, '34 T.C ROAD KOL-700053', NULL, NULL, 'B+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ASHA DAS SINGH', NULL, NULL, NULL, NULL, NULL, '9903537407', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(227, 'NPS2025021', NULL, 'ANAMIKA SINGH', NULL, NULL, NULL, NULL, NULL, NULL, '34 T.C ROAD KOL-700053', NULL, NULL, 'B+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ASHA DAS SINGH', NULL, NULL, NULL, NULL, NULL, '9903537407', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(228, 'NPS2025022', NULL, 'PRIYANGSHU MONDAL', NULL, NULL, NULL, NULL, NULL, NULL, '1180B OSTAD AMIR KHAN SARANI KOL-82', NULL, NULL, 'B+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'RAJU MONDAL', NULL, NULL, NULL, NULL, NULL, '6289280231', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(229, 'NPS2025023', NULL, 'RAYANSH PRASAD', NULL, NULL, NULL, NULL, NULL, NULL, '93/32 MAJLISH ARA ROAD KOL-41', NULL, NULL, 'B+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'KUNDAN PRASAD', NULL, NULL, NULL, NULL, NULL, '9628608777', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(230, 'NPS2025024', NULL, 'ANKUSH YADAV', NULL, NULL, NULL, NULL, NULL, NULL, '3NO. TARPAN GHAT ROAD KOL-53', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'MR. RANJIT YADAV', NULL, NULL, NULL, NULL, NULL, '8583061972', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(231, 'NPS2025025', NULL, 'NYRA SINGH', NULL, NULL, NULL, NULL, NULL, NULL, '128 TARAMONI GHAT  ROAD PASCHIM PUTIARY KOL-41', NULL, NULL, 'B+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'RANDHIR SINGH', NULL, NULL, NULL, NULL, NULL, '9063567455', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(232, 'NPS2025026', NULL, 'RONAK SHARMA', NULL, NULL, NULL, NULL, NULL, NULL, '787 R.K.NAGAR DOLLY VILLA KOL-82', NULL, NULL, 'A+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NITESH SHARMA', NULL, NULL, NULL, NULL, NULL, '8240574377', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(233, 'NPS2025027', NULL, 'AYUSH KR. JHA', NULL, NULL, NULL, NULL, NULL, NULL, '177/18A B.L.SAHA ROAD KOL-53', NULL, NULL, 'A+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ASHUTOSH KR. JHA', NULL, NULL, NULL, NULL, NULL, '9836424867', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(234, 'NPS2025028', NULL, 'MOUMITA CHOUDHURY', NULL, NULL, NULL, NULL, NULL, NULL, '229 ABHINASH MONDAL ROAD KOL-93', NULL, NULL, 'B+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'MANIK CHOUDHURY', NULL, NULL, NULL, NULL, NULL, '9007922440', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(235, 'NPS2025029', NULL, 'AARY OJHA', NULL, NULL, NULL, NULL, NULL, NULL, '56/2 P.B. ROAD BEHALA KOL-41', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ASHWANI KR. OJHA', NULL, NULL, NULL, NULL, NULL, '9649055204', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(236, 'NPS2025030', NULL, 'RIDDHIMAN HAZRA', NULL, NULL, NULL, NULL, NULL, NULL, '119/15/1 RAJA RAMMOHAN ROY ROAD KOL-41', NULL, NULL, 'B+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'RESHMI HAZRA', NULL, NULL, NULL, NULL, NULL, '6289688228', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(237, 'NPS2025031', NULL, 'ABHIGYAN MULLICK', NULL, NULL, NULL, NULL, NULL, NULL, '197A MOTILAL GUPTA ROAD KOL-82', NULL, NULL, 'O+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'AVIJIT MALLICK', NULL, NULL, NULL, NULL, NULL, '9830662140', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(238, 'NPS2025032', NULL, 'DEBANJAN SAHOO', NULL, NULL, NULL, NULL, NULL, NULL, '84/1A KAILASH GHOSH ROAD BARISHA KOL-8', NULL, NULL, 'O+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'DIPANKAR SAHOO', NULL, NULL, NULL, NULL, NULL, '9748474947', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(239, 'NPS2025033', NULL, 'DEVANSH YADAV', NULL, NULL, NULL, NULL, NULL, NULL, '102B P.N. MITRA LANE KOL-53', NULL, NULL, 'O+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'MR. MANISH YADAV', NULL, NULL, NULL, NULL, NULL, '7449759534', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(240, 'NPS2025034', NULL, 'PRITISH GUHA', NULL, NULL, NULL, NULL, NULL, NULL, '174 M.G. ROAD KOL-82', NULL, NULL, 'O-', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SAMAR GUHA', NULL, NULL, NULL, NULL, NULL, '9051901398', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(241, 'NPS2025035', NULL, 'ARYAN SAH', NULL, NULL, NULL, NULL, NULL, NULL, '45/4 P.B ROAD KOL-41', NULL, NULL, 'O+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'RAJU SAH', NULL, NULL, NULL, NULL, NULL, '6291117642', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(242, 'NPS2025036', NULL, 'SURVI SRIVASTAVA', NULL, NULL, NULL, NULL, NULL, NULL, '63D RAJA RAMMOHAN ROY ROAD KOL-8', NULL, NULL, 'A+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SANDEEP SRIVASTAVA', NULL, NULL, NULL, NULL, NULL, '9337196762', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(243, 'NPS2025037', NULL, 'KANAK GUPTA', NULL, NULL, NULL, NULL, NULL, NULL, '7F TOWER 2, SOUTH CITY GARDEN, B.L.SAHA ROAD KOLKATA-700043', NULL, NULL, 'O+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'INDU SINGH GUPTA', NULL, NULL, NULL, NULL, NULL, '9703054604', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(244, 'NPS2025038', NULL, ' NIDHI ROY', NULL, NULL, NULL, NULL, NULL, NULL, '3/155AZADGAR POULTRY FARM BAZAR KOL-40', NULL, NULL, 'B+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SHIKHA PAUL', NULL, NULL, NULL, NULL, NULL, '9647802978', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(245, 'NPS2025039', NULL, 'SOURAV GUPTA', NULL, NULL, NULL, NULL, NULL, NULL, '265/A B.L. SAHA ROAD KOL-53', NULL, NULL, 'A+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SAHEB LAL GUPTA', NULL, NULL, NULL, NULL, NULL, '7439667640', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(246, 'NPS2025040', NULL, 'HRIHAAN SINHA ROY', NULL, NULL, NULL, NULL, NULL, NULL, '88/6 ROY BAHADUR ROAD BEHALA KOL-34', NULL, NULL, 'O+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'PARTHA SINHA ROY', NULL, NULL, NULL, NULL, NULL, '9674573752', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(247, 'NPS2025041', NULL, ' ALISA PARVIN', NULL, NULL, NULL, NULL, NULL, NULL, 'SODEPUR BRICK FIELD ROAD KOL-82', NULL, NULL, 'A+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SK. ALIUDDIN', NULL, NULL, NULL, NULL, NULL, '8777018946', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(248, 'NPS2025042', NULL, 'SARTHAK RAJ SHARMA', NULL, NULL, NULL, NULL, NULL, NULL, '75/5 RAJA RAM MOHAN ROY ROAD KOL-700008', NULL, NULL, 'B+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SATISH KUMAR SHARMA', NULL, NULL, NULL, NULL, NULL, '9674167008', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(249, 'NPS2025043', NULL, 'APURV KUMAR ROY', NULL, NULL, NULL, NULL, NULL, NULL, '248 MOTILAL GUPTA ROAD KOL-82', NULL, NULL, 'O+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ABINASH KUMAR ROY', NULL, NULL, NULL, NULL, NULL, '9523653074', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(250, 'NPS2025044', NULL, 'DHRITIRAJ DAS', NULL, NULL, NULL, NULL, NULL, NULL, '387A BANSDRONI PARK KOL-70', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'PAPAN DAS', NULL, NULL, NULL, NULL, NULL, '9903345617', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(251, 'NPS2025045', NULL, 'ADYA SHARMA', NULL, NULL, NULL, NULL, NULL, NULL, '59/1A SODEPUR 2ND LANE KOL-82', NULL, NULL, 'B+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'AJAY SHARMA', NULL, NULL, NULL, NULL, NULL, '9123717330', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(252, 'NPS2025046', NULL, 'VAIBHAV SHARMA', NULL, NULL, NULL, NULL, NULL, NULL, '59/1A SODEPUR 2ND LANE KOL-82', NULL, NULL, 'AB+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'AJAY SHARMA', NULL, NULL, NULL, NULL, NULL, '9123717330', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(253, 'NPS2025047', NULL, 'DEVIKA SHARMA', NULL, NULL, NULL, NULL, NULL, NULL, '59/1 SODEPUR 2ND LANE KOL-82', NULL, NULL, 'B+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SWETA SHARMA', NULL, NULL, NULL, NULL, NULL, '9836587611', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(254, 'NPS2025048', NULL, 'G.YASHIKA RAO', NULL, NULL, NULL, NULL, NULL, NULL, '350/1 HARIDEBPUR, KOL-82', NULL, NULL, 'A+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'G. RAJ SHEKER RAO', NULL, NULL, NULL, NULL, NULL, '9945353096', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(255, 'NPS2025049', NULL, 'AUGUSTA BISWAS', NULL, NULL, NULL, NULL, NULL, NULL, '3/2 CHANDITALA BRANCH ROAD KOL-53', NULL, NULL, 'A+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'RAJ BISWAS', NULL, NULL, NULL, NULL, NULL, '8620914831', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(256, 'NPS2025050', NULL, 'ANIKET KEWAT', NULL, NULL, NULL, NULL, NULL, NULL, '23/1 B.L. SAHA ROAD KOL-53', NULL, NULL, 'A+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NARBIND KUMAR KEWAT', NULL, NULL, NULL, NULL, NULL, '9038841243', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(257, 'NPS2025051', NULL, 'SAYANI CHAKRABORTY', NULL, NULL, NULL, NULL, NULL, NULL, '96 SATYEN ROY ROAD KOL-34', NULL, NULL, 'A+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'MOUSUMI CHAKRABORTY', NULL, NULL, NULL, NULL, NULL, '8981849687', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(258, 'NPS2025052', NULL, 'VANSH SHARMA', NULL, NULL, NULL, NULL, NULL, NULL, '787 R.K. NAGAR, DOLLY VILLA KOL-82', NULL, NULL, 'A+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NITESH SHARMA', NULL, NULL, NULL, NULL, NULL, '9903718769', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(259, 'NPS2025053', NULL, 'ADITRI ROY CHOUDHURY', NULL, NULL, NULL, NULL, NULL, NULL, '369 BANERJEE PARA ROAD KOL-41', NULL, NULL, 'B-', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'KAMALIKA ROY CHOUDHURY', NULL, NULL, NULL, NULL, NULL, '6292322065', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(260, 'NPS2025054', NULL, 'SHRI MADHAV SHARMA', NULL, NULL, NULL, NULL, NULL, NULL, '59/1A SODEPUR 2ND LANE KOL-82', NULL, NULL, 'B+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SWETA SHARMA', NULL, NULL, NULL, NULL, NULL, '9836587611', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(261, 'NPS2025055', NULL, 'KUNTAL HALDER', NULL, NULL, NULL, NULL, NULL, NULL, '174/10 B.L. SAHA ROAD KOL-53', NULL, NULL, 'B+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'KARTICK HALDER', NULL, NULL, NULL, NULL, NULL, '9831238870', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(262, 'NPS2025056', NULL, 'SIDDHANTA SINGH', NULL, NULL, NULL, NULL, NULL, NULL, '91A/109 B.L.SAHA ROAD KOL-53', NULL, NULL, 'O+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SUNITA SINGH', NULL, NULL, NULL, NULL, NULL, '9874973399', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(263, 'NPS2025057', NULL, 'ANISHA SHARMA', NULL, NULL, NULL, NULL, NULL, NULL, '787 R.K. NAGAR, DOLLY VILLA KOL-82', NULL, NULL, 'O+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'MUKESH SHARMA', NULL, NULL, NULL, NULL, NULL, '8910029992', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(264, 'NPS2025058', NULL, 'NISHAT ALAM', NULL, NULL, NULL, NULL, NULL, NULL, '60/12 P.B. ROAD, Fl-2A , KOL-41', NULL, NULL, 'O+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NAUSAD ALAM', NULL, NULL, NULL, NULL, NULL, '8017077435', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(265, 'NPS2025059', NULL, 'SK.SAQIBUR RAHAMAN', NULL, NULL, NULL, NULL, NULL, NULL, '34, SODEPUR, BRICK FIELD ROAD, KOL-82', NULL, NULL, 'A+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SK. ATAUR RAHAMAN', NULL, NULL, NULL, NULL, NULL, '9330942717', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(266, 'NPS2025060', NULL, 'MAHASWETA DAS', NULL, NULL, NULL, NULL, NULL, NULL, '69/8 M.G. ROAD KOL-82', NULL, NULL, 'O+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'PARTHA SARATHI DAS', NULL, NULL, NULL, NULL, NULL, '9933972697', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(267, 'NPS2025061', NULL, 'SIBAM BISWAS', NULL, NULL, NULL, NULL, NULL, NULL, '119/13 RAJA RAM MOHON ROY ROAD, MAITY PARA, KOL-41', NULL, NULL, 'A+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NIRMAL KUMAR BISWAS', NULL, NULL, NULL, NULL, NULL, '8336887398', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(268, 'NPS2025062', NULL, 'PRINCE MISHRA', NULL, NULL, NULL, NULL, NULL, NULL, '37A MAZLISH ARA ROAD KOL-41', NULL, NULL, 'B+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'RAGHBENDRA KUMAR MISHRA', NULL, NULL, NULL, NULL, NULL, '8210901613', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(269, 'NPS2025063', NULL, 'AARAV JHA', NULL, NULL, NULL, NULL, NULL, NULL, '1111 USTAD AMIR KHAN SARANI KOL-82', NULL, NULL, 'B+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BIJAY KR. JHA', NULL, NULL, NULL, NULL, NULL, '7278900802', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(270, 'NPS2025064', NULL, 'DIVYANANA BHUNRE', NULL, NULL, NULL, NULL, NULL, NULL, '519 MOTILAL GUPTA ROAD KOL-700008', NULL, NULL, 'O+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'PIYUSH KANTI BHUNRE', NULL, NULL, NULL, NULL, NULL, '8599830642', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(271, 'NPS2025065', NULL, 'DIBYANSHU NAYAK', NULL, NULL, NULL, NULL, NULL, NULL, '27/39 RAJA RAM MOHAN ROY ROAD KOLKATA - 8', NULL, NULL, 'A+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SATYA  RANJAN NAYAK', NULL, NULL, NULL, NULL, NULL, '9830390048', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(272, 'NPS2025066', NULL, 'VANI SHARMA', NULL, NULL, NULL, NULL, NULL, NULL, '59/1A SODEPUR 2ND LANE KOL-82', NULL, NULL, 'B+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'AJAY SHARMA', NULL, NULL, NULL, NULL, NULL, '9123717330', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(273, 'NPS2025067', NULL, 'AJITESH SHUKLA', NULL, NULL, NULL, NULL, NULL, NULL, '1362 , M.G. ROAD  HARIDEVPUR  KOL-82', NULL, NULL, 'AB+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'AWANENDRA KR. SHUKLA', NULL, NULL, NULL, NULL, NULL, '9433986395', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(274, 'NPS2025068', NULL, 'SK. HASSANUR RAHAMAN', NULL, NULL, NULL, NULL, NULL, NULL, '34 SODEPUR BRICK FIELD ROAD KOL-82', NULL, NULL, 'A+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SK. ATAUR RAHAMAN', NULL, NULL, NULL, NULL, NULL, '9330942717', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(275, 'NPS2025069', NULL, 'RYAN MITRA', NULL, NULL, NULL, NULL, NULL, NULL, '6, HAFEEZ MD.ISHAQUE ROAD KOL-82', NULL, NULL, 'O+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'AYAN MITRA', NULL, NULL, NULL, NULL, NULL, '9674114981', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(276, 'NPS2025070', NULL, 'SIDDHARTH SINGH', NULL, NULL, NULL, NULL, NULL, NULL, '1399, OSTAD AMIR KHAN SARANI KOL-82', NULL, NULL, 'O+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'CHANDRA SHEKHAR SINGH', NULL, NULL, NULL, NULL, NULL, '9831051315', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(277, 'NPS2025071', NULL, 'ADRIYA SARKAR', NULL, NULL, NULL, NULL, NULL, NULL, '1165/12 OSTAD AMIR KHAN SARANI KOL-82', NULL, NULL, 'B+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SANTU SARKAR', NULL, NULL, NULL, NULL, NULL, '9830974929', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(278, 'NPS2025072', NULL, 'AKSHAT SHAW', NULL, NULL, NULL, NULL, NULL, NULL, '3A, BAMACHARAN ROY ROAD KOL-34', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'PRAVIHD SHAW', NULL, NULL, NULL, NULL, NULL, '9339799620', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(279, 'NPS2025073', NULL, 'SUPRIYA MAHAPATRA', NULL, NULL, NULL, NULL, NULL, NULL, '538 RAJA RAM MOHAN ROY ROAD KOL-78', NULL, NULL, 'B+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SOMNATH MAHAPATRA', NULL, NULL, NULL, NULL, NULL, '9748741481', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(280, 'NPS2025074', NULL, 'SHIVAM KR. JHA', NULL, NULL, NULL, NULL, NULL, NULL, '177/18A B.L.SAHA ROAD KOL-53', NULL, NULL, 'A+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ASHUTOSH JHA', NULL, NULL, NULL, NULL, NULL, '7980696508', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(281, 'NPS2025075', NULL, 'DEBOSHRUTI DUTTA', NULL, NULL, NULL, NULL, NULL, NULL, '1 SUBHAS PARK, BANAMALI BANERJEE ROAD, HARIDEBPUR, KOL-82', NULL, NULL, 'O+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'MUNMUN PAUL CHATTERJEE', NULL, NULL, NULL, NULL, NULL, '7003658521', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(282, 'NPS2025076', NULL, 'PIYALI NAHA', NULL, NULL, NULL, NULL, NULL, NULL, '142/1 SODEPUR ROAD KOL-82', NULL, NULL, 'AB+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'PRADIP NAHA', NULL, NULL, NULL, NULL, NULL, '8918762432', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(283, 'NPS2025077', NULL, 'DIPAYAN SINHA', NULL, NULL, NULL, NULL, NULL, NULL, 'P.A. SAHA ROAD KOL-45', NULL, NULL, 'B+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'JYOSTNA SINHA', NULL, NULL, NULL, NULL, NULL, '9007220334', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(284, 'NPS2025078', NULL, 'ZUWAYRIA ANAYA HAQUE', NULL, NULL, NULL, NULL, NULL, NULL, '150/13 M.G. ROAD SUKANTA PALLY, B-24, KOL-82', NULL, NULL, 'B+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SK. MOHINUL HAQUE', NULL, NULL, NULL, NULL, NULL, '9830124715', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(285, 'NPS2025079', NULL, 'ADARSH KEWAT', NULL, NULL, NULL, NULL, NULL, NULL, '23/1 B.L. SAHA ROAD KOL-53', NULL, NULL, 'B+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NARBIND KUMAR KEWAT', NULL, NULL, NULL, NULL, NULL, '9038841243', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(286, 'NPS2025080', NULL, 'MAHI MISHRA', NULL, NULL, NULL, NULL, NULL, NULL, 'MAZLISH ARA ROAD KOL-41', NULL, NULL, 'B+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'RAGHABENDRA MISHRA', NULL, NULL, NULL, NULL, NULL, '8420296051', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(287, 'NPS2025081', NULL, 'MAYUKH PANDIT', NULL, NULL, NULL, NULL, NULL, NULL, '6/A BANERJEE PARA ROAD KOL-41', NULL, NULL, 'A+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'RUDRA KUMAR PANDIT', NULL, NULL, NULL, NULL, NULL, '8583005474', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(288, 'NPS2025082', NULL, 'AARUSH NANDY', NULL, NULL, NULL, NULL, NULL, NULL, 'P/779  P.C.SEN COLONY P.B. ROAD KOL-41', NULL, NULL, 'O+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BALARAM NANDY', NULL, NULL, NULL, NULL, NULL, '8777200987', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(289, 'NPS2025083', NULL, 'DIVYA GUPTA', NULL, NULL, NULL, NULL, NULL, NULL, '265/A B.L. SAHA ROAD KOL-53', NULL, NULL, 'A+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SAHEB LAL GUPTA', NULL, NULL, NULL, NULL, NULL, '7439667640', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(290, 'NPS2025084', NULL, 'AKANKHA MONDAL', NULL, NULL, NULL, NULL, NULL, NULL, '267 B.L. SAHA ROAD KOL-53', NULL, NULL, 'AB+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'MOU DUTTA', NULL, NULL, NULL, NULL, NULL, '9831673467', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(291, 'NPS2025085', NULL, 'MRINMAY JANA', NULL, NULL, NULL, NULL, NULL, NULL, '249/4 P.N. MITRA BRICK FIELD ROAD KOL-41', NULL, NULL, 'B+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'MADHUSUDAN JANA', NULL, NULL, NULL, NULL, NULL, '9123750796', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(292, 'NPS2025086', NULL, 'PRIYAM DAS', NULL, NULL, NULL, NULL, NULL, NULL, '10/2 P.B. ROAD BEHALA KOL-34', NULL, NULL, 'O-', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'PRIYANKA DAS', NULL, NULL, NULL, NULL, NULL, '9674065671', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(293, 'NPS2025087', NULL, 'JOYDEEP ROY CHOUDHURY', NULL, NULL, NULL, NULL, NULL, NULL, 'SAURAV APARTMENT, 150 CHANDER VILLAGE, HARIDEBPUR, KOL- 700082', NULL, NULL, 'O+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'S.N. ROY CHOUDHURY', NULL, NULL, NULL, NULL, NULL, '7980325396', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(294, 'NPS2025088', NULL, 'ANUSHREE CHAKRABORTY', NULL, NULL, NULL, NULL, NULL, NULL, 'A-85 SUKANTA PALLY HARIDEBPUR KOL-82', NULL, NULL, 'B+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ASHIS CHAKRABORTY', NULL, NULL, NULL, NULL, NULL, '7044371575', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(295, 'NPS2025089', NULL, 'SAMRIDDHI SINGH', NULL, NULL, NULL, NULL, NULL, NULL, '128 TARAMONI GHAT ROAD PASCHIM PUTIARY KOL-41', NULL, NULL, 'B+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'RANDHIR SINGH', NULL, NULL, NULL, NULL, NULL, '6281812022', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(296, 'NPS2025090', NULL, 'RAVYA KHANNA', NULL, NULL, NULL, NULL, NULL, NULL, '629 D.H.ROAD BEHALA KOL-34', NULL, NULL, 'B+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GAURAV KHANNA', NULL, NULL, NULL, NULL, NULL, '9330626772', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(297, 'NPS2025091', NULL, 'ABIR HALDER', NULL, NULL, NULL, NULL, NULL, NULL, '59 NABA PALLY PASHUPATI BHATTACHARJEE RD KOL-34', NULL, NULL, 'B+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SUBHAS HALDER', NULL, NULL, NULL, NULL, NULL, '9836819386', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(298, 'NPS2025092', NULL, 'KUNAL DUTTA', NULL, NULL, NULL, NULL, NULL, NULL, '1001 USTAD AAMIR KHAN SARANI KOL-82', NULL, NULL, 'AB+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'RANA DUTTA', NULL, NULL, NULL, NULL, NULL, '9123065583', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(299, 'NPS2025093', NULL, 'DEBMALLYA DEY', NULL, NULL, NULL, NULL, NULL, NULL, 'KAILASH GHOSH ROAD KOL-8', NULL, NULL, 'O+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'TINKU DEY', NULL, NULL, NULL, NULL, NULL, '8697151846', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(300, 'NPS2025094', NULL, 'ISHAN ROY', NULL, NULL, NULL, NULL, NULL, NULL, '22/7 RAMCHANDRAPUR, KABARDANGA,BRICK FIELD ROAD KOL-104', NULL, NULL, 'AB-', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'PRABHA ROY', NULL, NULL, NULL, NULL, NULL, '9903609994', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(301, 'NPS2025095', NULL, 'SURAJ PRASAD', NULL, NULL, NULL, NULL, NULL, NULL, '139A/1 HAFIZ MD. ISHAQUE ROAD KOL-82', NULL, NULL, 'B+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ' RANJAN PRASAD', NULL, NULL, NULL, NULL, NULL, '9432824446', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(302, 'NPS2025096', NULL, 'JINIA SENGUPTA', NULL, NULL, NULL, NULL, NULL, NULL, '53/1 BIREN ROY ROAD,EAST, KOL-8', NULL, NULL, 'O+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'DEBARSHI SENGUPTA', NULL, NULL, NULL, NULL, NULL, '8100602086', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(303, 'NPS2025097', NULL, 'SUVHAMOY GUHA', NULL, NULL, NULL, NULL, NULL, NULL, '238 P.B. ROAD KOL-41', NULL, NULL, 'A+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SOMENATH GUHA', NULL, NULL, NULL, NULL, NULL, '9903160916', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(304, 'NPS2025098', NULL, 'AMOLIKA BANERJEE', NULL, NULL, NULL, NULL, NULL, NULL, '91/A/102 B.L. SAHA ROAD KOL-53', NULL, NULL, 'A+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'RAJA BANERJEE', NULL, NULL, NULL, NULL, NULL, '9903508627', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(305, 'NPS2025099', NULL, 'MEET YADAV', NULL, NULL, NULL, NULL, NULL, NULL, '7 P.K. CHANDRA ROAD KOL-53', NULL, NULL, 'O+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'MUNNA SINGH YADAV', NULL, NULL, NULL, NULL, NULL, '9804158045', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(306, 'NPS2025100', NULL, 'SYED HAMZA UDDIN', NULL, NULL, NULL, NULL, NULL, NULL, '265 D/1 B.L. SAHA ROAD KOL-53', NULL, NULL, 'O+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SYED MASIH UDDIN', NULL, NULL, NULL, NULL, NULL, '8479092071', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(307, 'NPS2025101', NULL, 'PUJA MAITY', NULL, NULL, NULL, NULL, NULL, NULL, '412, RADHIKA APARTMENT, MOTILAL GUPTA ROAD, KOL-82', NULL, NULL, 'B+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SWAPAN KUMAR MALLICK', NULL, NULL, NULL, NULL, NULL, '8621077221', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(308, 'NPS2025102', NULL, 'ANGEL MANDAL', NULL, NULL, NULL, NULL, NULL, NULL, '411, KALIPUR ROAD KOL-82', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'MINA MANDAL', NULL, NULL, NULL, NULL, NULL, '9088099940', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(309, 'NPS2025103', NULL, 'KUSHAN DAS', NULL, NULL, NULL, NULL, NULL, NULL, '814/A MOTILAL GUPTA ROAD KOL-82', NULL, NULL, 'A+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BISHU DAS', NULL, NULL, NULL, NULL, NULL, '9051056397', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(310, 'NPS2025104', NULL, 'RUPANJALI SAH', NULL, NULL, NULL, NULL, NULL, NULL, '45/4 P.B.ROAD KOL-41', NULL, NULL, 'A+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'RAJU SAH', NULL, NULL, NULL, NULL, NULL, '6291117642', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(311, 'NPS2025105', NULL, 'SOUMILI GAYEN', NULL, NULL, NULL, NULL, NULL, NULL, '249/6 P.N. MITRA LANE KOL-41', NULL, NULL, 'A+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SHUBHADIP GAYEN', NULL, NULL, NULL, NULL, NULL, '9875304349', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(312, 'NPS2025106', NULL, 'KAVYA YADAV', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, 'O+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'MANISH YADAV', NULL, NULL, NULL, NULL, NULL, '7449759534', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(313, 'NPS2025107', NULL, 'ANURAG BOSE', NULL, NULL, NULL, NULL, NULL, NULL, 'PURBA PUTIARY TALBAGAN KOL-93', NULL, NULL, 'A-', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ARINDAM BOSE', NULL, NULL, NULL, NULL, NULL, '9038556441', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(314, 'NPS2025108', NULL, 'ANSHU KUMARI', NULL, NULL, NULL, NULL, NULL, NULL, '75 P.N. MITRA BRICK FIELD ROAD, KOL-53', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SHIV CHANDRA SHAW', NULL, NULL, NULL, NULL, NULL, '9836515846', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(315, 'NPS2025109', NULL, 'ARGHODEEP GURUNG ', NULL, NULL, NULL, NULL, NULL, NULL, '5A RAJA RAM MOHON ROY ROAD KOL-8', NULL, NULL, 'A+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'KIRAN KUMAR GURUNG', NULL, NULL, NULL, NULL, NULL, '9830946945', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(316, 'NPS2025110', NULL, 'SRIJA MUKHERJEE', NULL, NULL, NULL, NULL, NULL, NULL, '132/2, HARIDEBPUR,NONAMATH KOL-82', NULL, NULL, 'A+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'AMIT MUKHERJEE', NULL, NULL, NULL, NULL, NULL, '8777709746', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(317, 'NPS2025111', NULL, 'ADARSH KR. AGARWAL', NULL, NULL, NULL, NULL, NULL, NULL, '41/1, SARAT PALLY K.M.G ROAD KOL-82', NULL, NULL, 'O+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'DHIRENDRA KR. AGARWAL', NULL, NULL, NULL, NULL, NULL, '9508837778', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(318, 'NPS2025112', NULL, 'SOUVIK BANERJEE', NULL, NULL, NULL, NULL, NULL, NULL, 'P-10, P.C SEN COLONY, P.B. ROAD KOL-41', NULL, NULL, 'A+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BISWANATH BANERJEE', NULL, NULL, NULL, NULL, NULL, '7003165133', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(319, 'NPS2025113', NULL, 'RISHIT DAS', NULL, NULL, NULL, NULL, NULL, NULL, '2A, MAJLISH ARA ROAD KOL-41', NULL, NULL, 'O+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SUTAPA DAS', NULL, NULL, NULL, NULL, NULL, '9831448634', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(320, 'NPS2025114', NULL, 'KUNAL RAJ SHARMA', NULL, NULL, NULL, NULL, NULL, NULL, '75/5, RAJA RAM MOHAN ROY ROAD KOL-8', NULL, NULL, 'AB+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SATISH KUMAR SHARMA', NULL, NULL, NULL, NULL, NULL, '7980321465', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(321, 'NPS2025115', NULL, 'LAXMI GUPTA', NULL, NULL, NULL, NULL, NULL, NULL, '265/A, B.L.SAHA ROAD KOL-53', NULL, NULL, 'B+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SAHEB LAL GUPTA', NULL, NULL, NULL, NULL, NULL, '8910644106', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(322, 'NPS2025116', NULL, 'SHREYAN DAS', NULL, NULL, NULL, NULL, NULL, NULL, '360F, P.T. ROAD KOL-41', NULL, NULL, 'O+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SANTOSH DAS', NULL, NULL, NULL, NULL, NULL, '7980808198', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(323, 'NPS2025117', NULL, 'UTSAV JANA', NULL, NULL, NULL, NULL, NULL, NULL, '1104, P.B. ROAD KOL-41', NULL, NULL, 'O+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'TINKU JANA', NULL, NULL, NULL, NULL, NULL, '8116435118', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(324, 'NPS2025118', NULL, 'ISHAN RAY CHOUDHURY', NULL, NULL, NULL, NULL, NULL, NULL, '369, BANERJEE PARA ROAD. PUTIARY, KOL-41', NULL, NULL, 'B+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'KAMALIKA RAY CHOUDHURY', NULL, NULL, NULL, NULL, NULL, '6292322065', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(325, 'NPS2025119', NULL, 'ARNAV SHAW', NULL, NULL, NULL, NULL, NULL, NULL, '47, SURYA SEN PALLY, KOL-82', NULL, NULL, 'O+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'AJIT KR. SHAW', NULL, NULL, NULL, NULL, NULL, '9804136950', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(326, 'NPS2025120', NULL, 'OISHI MITRA', NULL, NULL, NULL, NULL, NULL, NULL, '68/L SODEPUR ROAD KOL-82', NULL, NULL, 'O+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'TUSHAR MITRA', NULL, NULL, NULL, NULL, NULL, '9674874557', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(327, 'NPS2025121', NULL, 'OLIVIA CHOWDHURY', NULL, NULL, NULL, NULL, NULL, NULL, '2, SODEPUR 1ST LANE KOL-82', NULL, NULL, 'A+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'DEBABRATA CHOWDHURY', NULL, NULL, NULL, NULL, NULL, '9051466307', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(328, 'NPS2025122', NULL, 'APURAV MISHRA', NULL, NULL, NULL, NULL, NULL, NULL, '154/A KALIPUR KANCHA ROAD KOL-82', NULL, NULL, 'B+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SURAJ MISHRA', NULL, NULL, NULL, NULL, NULL, '9903536627', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(329, 'NPS2025123', NULL, 'NAVYA KUMARI RAI', NULL, NULL, NULL, NULL, NULL, NULL, '315 PASHUPATI BHATTACHARYA ROAD KOL-41', NULL, NULL, 'B+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BIRESH KUMAR RAI', NULL, NULL, NULL, NULL, NULL, '9830721555', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(330, 'NPS2025124', NULL, 'RAJARSHI BHATTACHARYA', NULL, NULL, NULL, NULL, NULL, NULL, '105 BANERJEE PARA ROAD KOL-41', NULL, NULL, 'A-', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BHASKAR BHATTACHARYA', NULL, NULL, NULL, NULL, NULL, '9830071241', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(331, 'NPS2025125', NULL, 'MANASWITA DAS', NULL, NULL, NULL, NULL, NULL, NULL, '6918 M.G. ROAD KOL-82', NULL, NULL, 'O+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'PARTHA SARATHI DAS', NULL, NULL, NULL, NULL, NULL, '9933972697', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(332, 'NPS2025126', NULL, 'SUBHOJIT DAS', NULL, NULL, NULL, NULL, NULL, NULL, 'OSTAD AMIR KHAN SARANI KOL-82', NULL, NULL, 'B+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BIBHUTI BUSHAN DAS', NULL, NULL, NULL, NULL, NULL, '7003037003', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(333, 'NPS2025127', NULL, 'KRISHNENDU PURKAIT', NULL, NULL, NULL, NULL, NULL, NULL, '30 OSTAD AMIR KHAN SARANI KOL-82', NULL, NULL, 'O-', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'AMIT PURKAIT', NULL, NULL, NULL, NULL, NULL, '8335949636', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(334, 'NPS2025128', NULL, 'RIYANSHI KUMARI', NULL, NULL, NULL, NULL, NULL, NULL, 'PASHUPATI BHATTACHARYA ROAD KOL-41', NULL, NULL, 'A+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'JAYA TIWARY', NULL, NULL, NULL, NULL, NULL, '6205555343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(335, 'NPS2025129', NULL, 'DEBANJAN MONDAL', NULL, NULL, NULL, NULL, NULL, NULL, '300/G, B.B.ROAD KOL-82', NULL, NULL, 'AB+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ISWAR CH. MONDAL', NULL, NULL, NULL, NULL, NULL, '9874094208', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(336, 'NPS2025130', NULL, 'AMAN SINGH', NULL, NULL, NULL, NULL, NULL, NULL, '206 P.N. MITRA LANE BRICK FIELD ROAD KOL-53', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SUMAN SINGH', NULL, NULL, NULL, NULL, NULL, '6290793158', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(337, 'NPS2025131', NULL, 'ANKAN JANA', NULL, NULL, NULL, NULL, NULL, NULL, '198A KALIPUR ROAD KOL-82', NULL, NULL, 'A+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SANJAY JANA', NULL, NULL, NULL, NULL, NULL, '9007794995', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(338, 'NPS2025132', NULL, 'RITWIK SHAW', NULL, NULL, NULL, NULL, NULL, NULL, '31/D1/C BEHALA DALIPARA KOL-60', NULL, NULL, 'B+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'MAHESH SHAW', NULL, NULL, NULL, NULL, NULL, '8100331831', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(339, 'NPS2025133', NULL, 'ANUSHKA THAKUR', NULL, NULL, NULL, NULL, NULL, NULL, '3/3, MAHRANI APARTMENT, BANAMALI BANERJEE ROAD , HARIDEBPUR, KOL-82', NULL, NULL, 'A+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'APURBA KUMAR THAKUR', NULL, NULL, NULL, NULL, NULL, '9674874544', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(340, 'NPS2025134', NULL, 'MAANVI KUMARI', NULL, NULL, NULL, NULL, NULL, NULL, '265N B.L. SAHA ROAD KOL-53', NULL, NULL, 'B+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'RAJKISHOR KUMAR', NULL, NULL, NULL, NULL, NULL, '7980711743', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(341, 'NPS2025135', NULL, 'ADITRI JANA', NULL, NULL, NULL, NULL, NULL, NULL, '174/28A, B.L.SAHA ROAD KOL-53', NULL, NULL, 'B+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ASHIS JANA', NULL, NULL, NULL, NULL, NULL, '9007024081', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(342, 'NPS2025136', NULL, 'SATARUPA DAS', NULL, NULL, NULL, NULL, NULL, NULL, '102, NASKAR PARA ROAD KOL-41', NULL, NULL, 'B+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'PANKAJ DAS', NULL, NULL, NULL, NULL, NULL, '7003977671', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(343, 'NPS2025137', NULL, 'ASHMIT JAISWAL', NULL, NULL, NULL, NULL, NULL, NULL, '344/A ROY BAHADUR ROAD KOL-53', NULL, NULL, 'O+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'AMIT JAISWAL', NULL, NULL, NULL, NULL, NULL, '7003009582', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(344, 'NPS2025138', NULL, 'SHLOKE PANDAY', NULL, NULL, NULL, NULL, NULL, NULL, '184,KURUNAMOYEE GHAT ROAD KOL-82', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'MUKESH PANDEY', NULL, NULL, NULL, NULL, NULL, '9630324636', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(345, 'NPS2025139', NULL, 'SK. ASFAQ', NULL, NULL, NULL, NULL, NULL, NULL, '3NO. BAMACHARAN ROAD KOL-34', NULL, NULL, 'AB+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SK. MUNNA', NULL, NULL, NULL, NULL, NULL, '9331727279', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(346, 'NPS2025140', NULL, 'TAMOJIT SAHA', NULL, NULL, NULL, NULL, NULL, NULL, 'KUSHUM PARK HARIDEVPUR KOL-82', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'MITALI SAHA', NULL, NULL, NULL, NULL, NULL, '9831990141', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(347, 'NPS2025141', NULL, 'TIU ROY', NULL, NULL, NULL, NULL, NULL, NULL, '36/10/A SARAT CHANDRA BOSE ROAD KOL-8', NULL, NULL, 'A+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'UTTAM ROY', NULL, NULL, NULL, NULL, NULL, '8697356062', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(348, 'NPS2025142', NULL, 'PUJA YADAV', NULL, NULL, NULL, NULL, NULL, NULL, '106/A MOTILAL GUPTA ROAD KOL-8', NULL, NULL, 'O+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ANANDI LAL YADAV', NULL, NULL, NULL, NULL, NULL, '9163122788', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(349, 'NPS2025143', NULL, 'SAMADRITA DAS', NULL, NULL, NULL, NULL, NULL, NULL, '54/2 K.P.M. ROAD', NULL, NULL, 'B+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SUJIT DAS', NULL, NULL, NULL, NULL, NULL, '8910361478', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(350, 'NPS2025144', NULL, 'PRIYAM BHATTACHARJEE', NULL, NULL, NULL, NULL, NULL, NULL, '145 PANCHANANTALA, PURBA PUTIYARI KOL-93', NULL, NULL, 'B+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'MR.PRASENJIT BHATTACHARJEE', NULL, NULL, NULL, NULL, NULL, '9831164720', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(351, 'NPS2025145', NULL, 'AMAN KUMAR PANDEY', NULL, NULL, NULL, NULL, NULL, NULL, '322, P.N. MITRA BRICK FIELD ROAD KOL-53', NULL, NULL, 'A+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NAVIN KUMAR PANDEY', NULL, NULL, NULL, NULL, NULL, '6289354588', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(352, 'NPS2025146', NULL, 'TARANA SABNAM', NULL, NULL, NULL, NULL, NULL, NULL, '60/12 P.B ROAD KOL-41', NULL, NULL, 'O+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NAUSAD ALAM', NULL, NULL, NULL, NULL, NULL, '8017077435', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(353, 'NPS2025147', NULL, 'AYESHA PARVIN', NULL, NULL, NULL, NULL, NULL, NULL, 'SODEPUR BRICK FIELD ROAD KOL-82', NULL, NULL, 'A+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SK. ALIUDDIN', NULL, NULL, NULL, NULL, NULL, '9064824279', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(354, 'NPS2025148', NULL, 'SUBHAM MONDAL', NULL, NULL, NULL, NULL, NULL, NULL, '10/1A CHANDITALA BRANCH ROAD', NULL, NULL, 'A+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'MANASHI MONDAL', NULL, NULL, NULL, NULL, NULL, '9007985499', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(355, 'NPS2025149', NULL, 'ADITYA KUMAR DAS', NULL, NULL, NULL, NULL, NULL, NULL, '265/1/H.L B.L SAHA ROAD KOL-53', NULL, NULL, 'B+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'MR. RAJIV KUMAR DAS', NULL, NULL, NULL, NULL, NULL, '6291880967', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(356, 'NPS2025150', NULL, 'ADITYA KUMAR LAL', NULL, NULL, NULL, NULL, NULL, NULL, '34 P.B. ROAD KOL-41', NULL, NULL, 'B+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SUJIT KUMAR LAL', NULL, NULL, NULL, NULL, NULL, '6290807499', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00');
INSERT INTO `users` (`id`, `admission_number`, `image`, `student_name`, `date_of_birth`, `aadhar_no`, `nationality`, `religion`, `gender`, `caste`, `address`, `pin_code`, `mother_tongue`, `blood_group`, `stream`, `combination_text`, `school_name`, `academic_session`, `class`, `second_language`, `achievements`, `previous_school_info`, `parent_name`, `parent_relation`, `qualification`, `occupation`, `organization`, `designation`, `mobile_no`, `parent_aadhar_number`, `annual_income`, `office_contact_number`, `mention_relationship`, `transport_facility`, `route`, `email`, `password`, `status`, `created_at`, `updated_at`) VALUES
(357, 'NPS2025151', NULL, 'ISHAN KAYAL', NULL, NULL, NULL, NULL, NULL, NULL, '3/2 CHANDITALA BRANCH ROAD KOL-53', NULL, NULL, 'A+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SUDIPTOKAYAL', NULL, NULL, NULL, NULL, NULL, '9831154605', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(358, 'NPS2025152', NULL, 'AYUSH MISHRA', NULL, NULL, NULL, NULL, NULL, NULL, '154/A KALIPUR KANCHA ROAD KOL-82', NULL, NULL, 'AB+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SURAJ MISHRA', NULL, NULL, NULL, NULL, NULL, '9903536627', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(359, 'NPS2025153', NULL, 'RANGAN  CHEL', NULL, NULL, NULL, NULL, NULL, NULL, '119 KARUNAMOYEE GHAT ROAD KOL-82', NULL, NULL, 'AB+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'RANJIT CHEL', NULL, NULL, NULL, NULL, NULL, '9830027710', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(360, 'NPS2025154', NULL, 'DEEPSIKHA CHOWDHURY', NULL, NULL, NULL, NULL, NULL, NULL, 'DTC SOUTHERN HEIGHTS,BLOCK-7,FLAT-12C KOL-104', NULL, NULL, 'A+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'KANCHAN PRASAD', NULL, NULL, NULL, NULL, NULL, '9432333706', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(361, 'NPS2025155', NULL, 'SHREYASHI NANDI', NULL, NULL, NULL, NULL, NULL, NULL, 'SODEPUR BRICK FIELD ROAD KOL-82', NULL, NULL, 'O+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'AMIT NANDI', NULL, NULL, NULL, NULL, NULL, '9038287961', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(362, 'NPS2025156', NULL, 'SNEHA MONDAL', NULL, NULL, NULL, NULL, NULL, NULL, 'H/7, 13A ANANDA NAGAR KOL-61', NULL, NULL, 'AB+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SITAL MONDAL', NULL, NULL, NULL, NULL, NULL, '9874968122', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(363, 'NPS2025157', NULL, 'YASHIKA KANOJIA', NULL, NULL, NULL, NULL, NULL, NULL, '3/D CHETTA ROAD, NEW ALIPORE KOL-53', NULL, NULL, 'O+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'DEBASISH JOSEPH', NULL, NULL, NULL, NULL, NULL, '8910155709', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(364, 'NPS2025158', NULL, 'SUROJIT NASKAR', NULL, NULL, NULL, NULL, NULL, NULL, '206/A P.N. MITRALANE KOL-53', NULL, NULL, 'B+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SUKUMAR NASKAR', NULL, NULL, NULL, NULL, NULL, '8910969608', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(365, 'NPS2025159', NULL, 'SUNAINA KUMARI JADAV', NULL, NULL, NULL, NULL, NULL, NULL, '137/2 RAJA RAM MOHAN ROY ROAD KOL-82', NULL, NULL, 'O+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ASOKE JADAV', NULL, NULL, NULL, NULL, NULL, '8420959940', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(366, 'NPS2025160', NULL, 'SHREYA KHATICK', NULL, NULL, NULL, NULL, NULL, NULL, '20/B IZZATULLA LANE KOL-33', NULL, NULL, 'O+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BABLU KHATICK', NULL, NULL, NULL, NULL, NULL, '7003183676', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(367, 'NPS2025161', NULL, 'ARGHA MANNA', NULL, NULL, NULL, NULL, NULL, NULL, '84B CHANDI GHOSH ROAD KOL-40', NULL, NULL, 'B+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'MADHUMITA MANNA', NULL, NULL, NULL, NULL, NULL, '9826070268', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(368, 'NPS2025162', NULL, 'SANJAY SINGH', NULL, NULL, NULL, NULL, NULL, NULL, '182 MOTILAL GUPTA ROAD KOL-82', NULL, NULL, 'A+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'RAJU SINGH', NULL, NULL, NULL, NULL, NULL, '9836994730', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(369, 'NPS2025163', NULL, 'SHUVA DUTTA', NULL, NULL, NULL, NULL, NULL, NULL, 'SATH BIGHA PURBO PUTIARY BAGAN PARA SONI MANDIR', NULL, NULL, 'B+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GOUR DUTTA', NULL, NULL, NULL, NULL, NULL, '7908442935', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(370, 'NPS2025164', NULL, 'SONAKSHI TIWARI', NULL, NULL, NULL, NULL, NULL, NULL, '91A/99, B.L. SAHA ROAD KOL-53', NULL, NULL, 'A-', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'VIJAY KUMAR GUPTA', NULL, NULL, NULL, NULL, NULL, '8724005450', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(371, 'NPS2025165', NULL, 'AARUSH KHANNA', NULL, NULL, NULL, NULL, NULL, NULL, '629 D.H.ROAD BEHALA KOL-34', NULL, NULL, 'B+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GAURAV KHANNA', NULL, NULL, NULL, NULL, NULL, '9330626772', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(372, 'NPS2025166', NULL, 'MADHUMITA SINGH', NULL, NULL, NULL, NULL, NULL, NULL, '13 MAJLISH ARA ROAD KOL-41', NULL, NULL, 'AB+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'JITENDRA SINGH', NULL, NULL, NULL, NULL, NULL, '9007452621', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(373, 'NPS2025167', NULL, 'OM RAJ SINGH', NULL, NULL, NULL, NULL, NULL, NULL, '752 PASHUPATI BHATTACHARYA ROAD KOL-41', NULL, NULL, 'O+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'RAHUL KUMAR', NULL, NULL, NULL, NULL, NULL, '8013911072', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(374, 'NPS2025168', NULL, 'MANIS SINGH', NULL, NULL, NULL, NULL, NULL, NULL, '13 MAJLISH ARA ROAD KOL-41', NULL, NULL, 'B+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'JITENDRA SINGH', NULL, NULL, NULL, NULL, NULL, '9007452621', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(375, 'NPS2025169', NULL, 'OM PRAKASH MUKHIYA', NULL, NULL, NULL, NULL, NULL, NULL, '59/1 P.B. ROAD KOL-41', NULL, NULL, 'B+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SRI RAM MUKHIYA', NULL, NULL, NULL, NULL, NULL, '9330931961', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(376, 'NPS2025170', NULL, 'RIDDHIMA BANERJEE', NULL, NULL, NULL, NULL, NULL, NULL, 'P-5 UNIQUE PARK BEHALA KOL-34', NULL, NULL, 'A+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'DEBJANI BANERJEE', NULL, NULL, NULL, NULL, NULL, '9051291937', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(377, 'NPS2025171', NULL, 'AAHANA CHATTERJEE', NULL, NULL, NULL, NULL, NULL, NULL, '91A/64 B.L. SAHA ROAD KOL-53', NULL, NULL, 'A-', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'JYOTIRMOY CHATTERJEE', NULL, NULL, NULL, NULL, NULL, '9875627014', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(378, 'NPS2025172', NULL, 'SHRUTI ROY', NULL, NULL, NULL, NULL, NULL, NULL, '74/11 SATYEN ROY ROAD KOL-34', NULL, NULL, 'O+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SANDIP ROY', NULL, NULL, NULL, NULL, NULL, '7044857675', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(379, 'NPS2025173', NULL, 'SYED FASIH UDDIN', NULL, NULL, NULL, NULL, NULL, NULL, '265 D/1 B.L. SAHA ROAD KOL-53', NULL, NULL, 'O+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SYED MASIH UDDIN', NULL, NULL, NULL, NULL, NULL, '8479092071', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(380, 'NPS2025174', NULL, 'JUNAID FAIZ HAQUE', NULL, NULL, NULL, NULL, NULL, NULL, '150/13 M.G. ROAD SUKANTA PALLY, B-24, KOL-82', NULL, NULL, 'B+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SK. MOHINUL HAQUE', NULL, NULL, NULL, NULL, NULL, '9830124715', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(381, 'NPS2025175', NULL, 'SK SUHANI', NULL, NULL, NULL, NULL, NULL, NULL, '18/1 MAJLISH ARA ROAD KOL-41', NULL, NULL, 'O+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SK RAHAMAT ALI', NULL, NULL, NULL, NULL, NULL, '9123964362', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(382, 'NPS2025176', NULL, 'NILANJAN SINGHA', NULL, NULL, NULL, NULL, NULL, NULL, '55 BHUPEN ROY ROAD KOL- 34', NULL, NULL, 'B+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SHIB SANKAR SINGHA', NULL, NULL, NULL, NULL, NULL, '9007259626', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(383, 'NPS2025177', NULL, 'BARNADEEP CHAKRABORTY', NULL, NULL, NULL, NULL, NULL, NULL, '23/1/A, B.B. ROAD P.O: HARIDEVPUR, KOL-82', NULL, NULL, 'B+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BARNALI CHAKRABORTY', NULL, NULL, NULL, NULL, NULL, '7439772474', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(384, 'NPS2025178', NULL, 'SHARMILA GUHA', NULL, NULL, NULL, NULL, NULL, NULL, 'SOUTH CITY VILLA 61/2 B.L. SAHA ROAD KOL-53', NULL, NULL, 'B+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SUTIRTHA GUHA', NULL, NULL, NULL, NULL, NULL, '9007618830', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(385, 'NPS2025179', NULL, '    SNIGDHA DAS', NULL, NULL, NULL, NULL, NULL, NULL, '357 ROY BAHADUR ROAD KOL-53', NULL, NULL, 'O+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BISWANATH DAS', NULL, NULL, NULL, NULL, NULL, '9831146566', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(386, 'NPS2025180', NULL, 'SHRENI SHUKLA', NULL, NULL, NULL, NULL, NULL, NULL, '91A/57 B.L. SAHA ROAD KOL-53', NULL, NULL, 'A+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'CHAKRAPANI SHUKLA', NULL, NULL, NULL, NULL, NULL, '9903406983', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(387, 'NPS2025181', NULL, 'SUBHOJEET BANERJEE', NULL, NULL, NULL, NULL, NULL, NULL, '122/7 ISHAN GHOSH ROAD KOL-8', NULL, NULL, 'A+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SUBRATA BANERJEE', NULL, NULL, NULL, NULL, NULL, '9051638660', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(388, 'NPS2025182', NULL, 'ANANYA HALDER', NULL, NULL, NULL, NULL, NULL, NULL, '52/2 CHAKRAM NAGAR KOL-104', NULL, NULL, 'O+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SANTU HALDER', NULL, NULL, NULL, NULL, NULL, '8100526986', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(389, 'NPS2025183', NULL, 'SAPTAK DAS', NULL, NULL, NULL, NULL, NULL, NULL, '35, DURGAPUR COLONY KOL-53', NULL, NULL, 'B+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SAMBHU DAS', NULL, NULL, NULL, NULL, NULL, '6290664092', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(390, 'NPS2025184', NULL, 'AARAV MISHRA', NULL, NULL, NULL, NULL, NULL, NULL, '292 RISHI RAJ NARAYAN ROAD  BRAHMAPUR BADAMTALA KOL-96', NULL, NULL, 'B+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'RAVI MISHRA', NULL, NULL, NULL, NULL, NULL, '8910482292', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(391, 'NPS2025185', NULL, 'ANUSUYA ROY CHOUDHURY', NULL, NULL, NULL, NULL, NULL, NULL, '150 CHANDER VILLAGE HARIDEVPUR KOL-82', NULL, NULL, 'O+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SHAMBHUNATH ROY CHOUDHURY', NULL, NULL, NULL, NULL, NULL, '7980325396', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(392, 'NPS2025186', NULL, 'SAKSHI MISHRA', NULL, NULL, NULL, NULL, NULL, NULL, '874 MOTILAL GUPTA ROAD SODEPUR KALITALA, KOL-82', NULL, NULL, 'AB+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'JITENDRA MISHRA', NULL, NULL, NULL, NULL, NULL, '6291346927', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(393, 'NPS2025187', NULL, 'ISHAN NATH', NULL, NULL, NULL, NULL, NULL, NULL, '172 A/1 P.N. MITRA BRICK FIELD ROAD KOL-41', NULL, NULL, 'O+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SUBHASISH NATH', NULL, NULL, NULL, NULL, NULL, '7439865796', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(394, 'NPS2025188', NULL, 'SPARSHO HAQUE', NULL, NULL, NULL, NULL, NULL, NULL, '161 BECHARAM CHATTERJEE KOL-61', NULL, NULL, 'A+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SAMADUL HAQUE', NULL, NULL, NULL, NULL, NULL, '9836872109', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(395, 'NPS2025189', NULL, 'ANIK NANDY', NULL, NULL, NULL, NULL, NULL, NULL, 'P/119,  P.C SEN COLONY KOL-41', NULL, NULL, 'B+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SREEMOYEE NANDY', NULL, NULL, NULL, NULL, NULL, '8777206987', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(396, 'NPS2025190', NULL, 'SARTHAK MUKHERJEE', NULL, NULL, NULL, NULL, NULL, NULL, '1180 A OSTAD AMIR KHAN SARANI KOL-82', NULL, NULL, 'B+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'MRS. PAMPA MUKHERJEE', NULL, NULL, NULL, NULL, NULL, '8910131138', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(397, 'NPS2025191', NULL, 'SOUMYASIS DEBRAY', NULL, NULL, NULL, NULL, NULL, NULL, '37/417, RAJA RAM MOHAN ROY ROAD KOL-41', NULL, NULL, 'A+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'KAKOLI DEBRAY', NULL, NULL, NULL, NULL, NULL, '9073105485', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(398, 'NPS2025192', NULL, 'ANGANA NAIYA', NULL, NULL, NULL, NULL, NULL, NULL, '91/1/3 MOTILAL GUPTA ROAD KOL-82', NULL, NULL, 'O+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'AMIT KUMAR NAIYA', NULL, NULL, NULL, NULL, NULL, '9830943809', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(399, 'NPS2025193', NULL, 'ANKIT MUKHERJEE', NULL, NULL, NULL, NULL, NULL, NULL, '246 OSTAD AMIR KHAN SARANI KOL-82', NULL, NULL, 'O+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'AMAL KR. MUKHERJEE', NULL, NULL, NULL, NULL, NULL, '8585047375', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(400, 'NPS2025194', NULL, 'ROUNAK DUTTA', NULL, NULL, NULL, NULL, NULL, NULL, '268A PRASANTA ROY ROAD KOL-8', NULL, NULL, 'B+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'PINAKI DUTTA', NULL, NULL, NULL, NULL, NULL, '6289072494', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(401, 'NPS2025195', NULL, 'DWAIPAYAN SAHA PODDAR', NULL, NULL, NULL, NULL, NULL, NULL, '26/1N KAILASH GHOSH ROAD KOL-8', NULL, NULL, 'O+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'RANJAN SAHA PODDAR', NULL, NULL, NULL, NULL, NULL, '9874061533', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(402, 'NPS2025196', NULL, 'DEVANSH AGARWAL', NULL, NULL, NULL, NULL, NULL, NULL, 'P-62/60 SENHATI CO-OP COLONY, KOL-34', NULL, NULL, 'A+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SANJEEV KR AGARWAL', NULL, NULL, NULL, NULL, NULL, '9830093568', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(403, 'NPS2025197', NULL, 'SOUMYOJYOTI SEN', NULL, NULL, NULL, NULL, NULL, NULL, '32/9 P.B. ROAD KOL-41', NULL, NULL, 'B+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'TAPASH SEN', NULL, NULL, NULL, NULL, NULL, '8420564249', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(404, 'NPS2025198', NULL, 'RAKTIM GURUNG', NULL, NULL, NULL, NULL, NULL, NULL, '747 D.H. ROAD KOL-8', NULL, NULL, 'A+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'KIRAN GURUNG', NULL, NULL, NULL, NULL, NULL, '8777527207', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(405, 'NPS2025199', NULL, 'RITU MANDAL', NULL, NULL, NULL, NULL, NULL, NULL, '47/N/1 NIVEDITA SARANI KOL-60', NULL, NULL, 'O+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BINAY KR. MANDAL', NULL, NULL, NULL, NULL, NULL, '6291697289', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(406, 'NPS2025200', NULL, 'DAMANJEET SINGH', NULL, NULL, NULL, NULL, NULL, NULL, '25/2, BIREN ROY ROAD (EAST) KOL-8', NULL, NULL, 'O-', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'HARDEEP KAUR', NULL, NULL, NULL, NULL, NULL, '9679654626', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(407, 'NPS2025201', NULL, 'MANASI CHATTERJEE', NULL, NULL, NULL, NULL, NULL, NULL, '97A B.L. SAHA ROAD KOL-53', NULL, NULL, 'B+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BARUN CHATTERJEE', NULL, NULL, NULL, NULL, NULL, '8017247256', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(408, 'NPS2025202', NULL, 'ABHIRUP GHOSH', NULL, NULL, NULL, NULL, NULL, NULL, '412, MOTILAL GUPTA ROAD KOL-82', NULL, NULL, 'B+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'DIPANKAR GHOSH', NULL, NULL, NULL, NULL, NULL, '9123793360', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(409, 'NPS2025203', NULL, 'RADHIKA ROY', NULL, NULL, NULL, NULL, NULL, NULL, '49 CHANDITALA MAIN ROAD KOL-53', NULL, NULL, 'O+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SHATRUGHAN ROY', NULL, NULL, NULL, NULL, NULL, '9875512589', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(410, 'NPS2025204', NULL, 'ANKUSH SAHA', NULL, NULL, NULL, NULL, NULL, NULL, 'P-139, P.C. SEN COLONY KOL-41', NULL, NULL, 'O+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'PAPIA BOSE', NULL, NULL, NULL, NULL, NULL, '9330331037', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(411, 'NPS2025205', NULL, 'AVIRAN DAS', NULL, NULL, NULL, NULL, NULL, NULL, '2/1 K.K. ROAD P.O- HARIDEVPUR KOL-82', NULL, NULL, 'B+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ABHISHEK DAS', NULL, NULL, NULL, NULL, NULL, '7859858543', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(412, 'NPS2025206', NULL, 'TANMOY SAHA', NULL, NULL, NULL, NULL, NULL, NULL, 'PURBA PUTIARY DAKSHIN PARA KOL-93', NULL, NULL, 'O+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'JOLY SAHA', NULL, NULL, NULL, NULL, NULL, '9330948013', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(413, 'NPS2025207', NULL, 'ANUP YADAV', NULL, NULL, NULL, NULL, NULL, NULL, '24, TOLLYGUNGE CIRCULAR ROAD KOL-53', NULL, NULL, 'B+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'VIJAY YADAV', NULL, NULL, NULL, NULL, NULL, '9007487381', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(414, 'NPS2025208', NULL, 'TRIDIP BASU', NULL, NULL, NULL, NULL, NULL, NULL, '7 SABJI BAGAN LANE KOL-27', NULL, NULL, 'B-', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BABUYA BOSE', NULL, NULL, NULL, NULL, NULL, '7439044828', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(415, 'NPS2025209', NULL, 'SOHAM MAITY', NULL, NULL, NULL, NULL, NULL, NULL, '89/1 RAJA RAMMOHAN ROY ROAD, KOL-8', NULL, NULL, 'O+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'MANASH MAITY', NULL, NULL, NULL, NULL, NULL, '9330820324', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(416, 'NPS2025210', NULL, 'ABHRANIL DAS', NULL, NULL, NULL, NULL, NULL, NULL, '6/2 T.C. ROAD KOL-53', NULL, NULL, 'O+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SUSANTA DAS', NULL, NULL, NULL, NULL, NULL, '9903954933', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(417, 'NPS2025211', NULL, 'RISHAV GUPTA', NULL, NULL, NULL, NULL, NULL, NULL, '181/16B RAJA RAM MOHAN ROY ROAD-41', NULL, NULL, 'O+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BHOLA PRASAD GUPTA', NULL, NULL, NULL, NULL, NULL, '9123763754', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-20 18:30:00', '2025-03-20 18:30:00'),
(418, 'NPS2025212', '/storage/student_images/2025-04-25-16_30_08_logo.jpg', 'Emon Debnath', '2025-04-25', '21312312312131', 'Indian', 'Hindu', 'Male', 'General', 'Debnath house, Nabapally, Near Jogendranath school', '700126', 'Bengali', 'A+', 'Science', NULL, '[\"test\"]', '[\"2025\"]', '[\"one\"]', '[\"Bengali\"]', 'Achievements', 'mention', 'Test data', 'Brother', 'Masters', 'Developer', 'Gwambo', 'Software developer', '6291648982', '1212121212', '12323.00', '06291648982', NULL, NULL, NULL, 'teso@mail.com', '$2y$12$36Q.Biqbm6Y/2F2Puhw2XOd66emJdklyD3xaJI3t9maorqOpeNjna', 1, '2025-04-25 10:59:08', '2025-04-25 11:00:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `admission_notices`
--
ALTER TABLE `admission_notices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attendances_teacher_id_foreign` (`teacher_id`),
  ADD KEY `attendances_user_id_foreign` (`user_id`),
  ADD KEY `attendances_session_id_foreign` (`session_id`),
  ADD KEY `attendances_class_id_foreign` (`class_id`),
  ADD KEY `attendances_section_id_foreign` (`section_id`);

--
-- Indexes for table `campus_galaries`
--
ALTER TABLE `campus_galaries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deposites`
--
ALTER TABLE `deposites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `deposites_user_id_foreign` (`user_id`),
  ADD KEY `deposites_session_id_foreign` (`session_id`),
  ADD KEY `deposites_class_id_foreign` (`class_id`),
  ADD KEY `deposites_section_id_foreign` (`section_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_registers`
--
ALTER TABLE `event_registers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_registers_event_id_foreign` (`event_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `news_slug` (`news_slug`);

--
-- Indexes for table `notices`
--
ALTER TABLE `notices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payment_settings`
--
ALTER TABLE `payment_settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_settings_session_id_foreign` (`session_id`),
  ADD KEY `payment_settings_class_id_foreign` (`class_id`),
  ADD KEY `payment_settings_section_id_foreign` (`section_id`),
  ADD KEY `payment_settings_user_id_foreign` (`user_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_class_mappings`
--
ALTER TABLE `student_class_mappings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_class_mappings_user_id_foreign` (`user_id`),
  ADD KEY `student_class_mappings_session_id_foreign` (`session_id`),
  ADD KEY `student_class_mappings_class_id_foreign` (`class_id`),
  ADD KEY `student_class_mappings_section_id_foreign` (`section_id`);

--
-- Indexes for table `teacher_class_mappings`
--
ALTER TABLE `teacher_class_mappings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teacher_class_mappings_teacher_id_foreign` (`teacher_id`),
  ADD KEY `teacher_class_mappings_class_id_foreign` (`class_id`),
  ADD KEY `teacher_class_mappings_section_id_foreign` (`section_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_admission_number_unique` (`admission_number`),
  ADD UNIQUE KEY `users_aadhar_no_unique` (`aadhar_no`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `admission_notices`
--
ALTER TABLE `admission_notices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `campus_galaries`
--
ALTER TABLE `campus_galaries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `deposites`
--
ALTER TABLE `deposites`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `event_registers`
--
ALTER TABLE `event_registers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `notices`
--
ALTER TABLE `notices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `payment_settings`
--
ALTER TABLE `payment_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `student_class_mappings`
--
ALTER TABLE `student_class_mappings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=223;

--
-- AUTO_INCREMENT for table `teacher_class_mappings`
--
ALTER TABLE `teacher_class_mappings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=419;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendances`
--
ALTER TABLE `attendances`
  ADD CONSTRAINT `attendances_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`),
  ADD CONSTRAINT `attendances_section_id_foreign` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`),
  ADD CONSTRAINT `attendances_session_id_foreign` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`),
  ADD CONSTRAINT `attendances_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `admins` (`id`),
  ADD CONSTRAINT `attendances_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `deposites`
--
ALTER TABLE `deposites`
  ADD CONSTRAINT `deposites_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`),
  ADD CONSTRAINT `deposites_section_id_foreign` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`),
  ADD CONSTRAINT `deposites_session_id_foreign` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`),
  ADD CONSTRAINT `deposites_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `event_registers`
--
ALTER TABLE `event_registers`
  ADD CONSTRAINT `event_registers_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payment_settings`
--
ALTER TABLE `payment_settings`
  ADD CONSTRAINT `payment_settings_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`),
  ADD CONSTRAINT `payment_settings_section_id_foreign` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`),
  ADD CONSTRAINT `payment_settings_session_id_foreign` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`),
  ADD CONSTRAINT `payment_settings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `student_class_mappings`
--
ALTER TABLE `student_class_mappings`
  ADD CONSTRAINT `student_class_mappings_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`),
  ADD CONSTRAINT `student_class_mappings_section_id_foreign` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`),
  ADD CONSTRAINT `student_class_mappings_session_id_foreign` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`),
  ADD CONSTRAINT `student_class_mappings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `teacher_class_mappings`
--
ALTER TABLE `teacher_class_mappings`
  ADD CONSTRAINT `teacher_class_mappings_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`),
  ADD CONSTRAINT `teacher_class_mappings_section_id_foreign` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`),
  ADD CONSTRAINT `teacher_class_mappings_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `admins` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
