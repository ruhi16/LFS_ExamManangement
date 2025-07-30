-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 28, 2024 at 05:45 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mhmwebserver`
--

-- --------------------------------------------------------

--
-- Table structure for table `answerscriptdistributions`
--

CREATE TABLE `answerscriptdistributions` (
  `id` int(10) UNSIGNED NOT NULL,
  `school_id` int(11) DEFAULT NULL,
  `session_id` int(11) DEFAULT NULL,
  `exam_id` int(11) DEFAULT NULL,
  `examtype_id` int(11) DEFAULT NULL,
  `exammode_id` int(11) DEFAULT NULL,
  `myclass_id` int(11) DEFAULT NULL,
  `section_id` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  `noscripted_rec` int(11) DEFAULT NULL,
  `nostudent_pre` int(11) DEFAULT NULL,
  `issue_dt` date DEFAULT NULL,
  `submit_dt` date DEFAULT NULL,
  `finalize_dt` date DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `session_id` int(11) DEFAULT NULL,
  `school_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `details`, `code`, `status`, `remark`, `session_id`, `school_id`, `created_at`, `updated_at`) VALUES
(1, 'Upper Primary', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'Secondary', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'Higher Secondary', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `examdetails`
--

CREATE TABLE `examdetails` (
  `id` int(10) UNSIGNED NOT NULL,
  `exam_id` int(11) NOT NULL,
  `examtype_id` int(11) NOT NULL,
  `exammode_id` int(11) NOT NULL,
  `myclass_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `full_mark` int(11) NOT NULL,
  `pass_mark` int(11) NOT NULL,
  `time_alloted` int(11) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `session_id` int(11) DEFAULT NULL,
  `school_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `examdetails`
--

INSERT INTO `examdetails` (`id`, `exam_id`, `examtype_id`, `exammode_id`, `myclass_id`, `subject_id`, `full_mark`, `pass_mark`, `time_alloted`, `status`, `remark`, `session_id`, `school_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, 16, 10, 4, 20, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 1, 1, 1, 1, 17, 10, 4, 20, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 1, 1, 1, 1, 18, 10, 4, 20, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 1, 1, 1, 1, 19, 10, 4, 20, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 1, 1, 1, 1, 20, 10, 4, 20, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 1, 2, 2, 1, 1, 10, 4, 20, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 1, 2, 2, 1, 2, 10, 4, 20, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 1, 2, 2, 1, 3, 10, 4, 20, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 1, 2, 2, 1, 4, 10, 4, 20, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 1, 2, 2, 1, 5, 10, 4, 20, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 1, 2, 2, 1, 9, 5, 2, 10, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 1, 2, 2, 1, 10, 5, 2, 10, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 1, 2, 2, 1, 15, 10, 4, 20, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 1, 1, 1, 2, 16, 20, 8, 40, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 1, 1, 1, 2, 17, 20, 8, 40, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 1, 1, 1, 2, 18, 20, 8, 40, NULL, NULL, NULL, NULL, NULL, NULL),
(17, 1, 1, 1, 2, 19, 20, 8, 40, NULL, NULL, NULL, NULL, NULL, NULL),
(18, 1, 1, 1, 2, 20, 20, 8, 40, NULL, NULL, NULL, NULL, NULL, NULL),
(19, 1, 2, 2, 2, 1, 15, 8, 40, NULL, NULL, NULL, NULL, NULL, NULL),
(20, 1, 2, 2, 2, 2, 15, 8, 40, NULL, NULL, NULL, NULL, NULL, NULL),
(21, 1, 2, 2, 2, 3, 15, 8, 40, NULL, NULL, NULL, NULL, NULL, NULL),
(22, 1, 2, 2, 2, 4, 15, 8, 40, NULL, NULL, NULL, NULL, NULL, NULL),
(23, 1, 2, 2, 2, 5, 15, 8, 40, NULL, NULL, NULL, NULL, NULL, NULL),
(24, 1, 2, 2, 2, 6, 15, 8, 40, NULL, NULL, NULL, NULL, NULL, NULL),
(25, 1, 2, 2, 2, 7, 15, 8, 40, NULL, NULL, NULL, NULL, NULL, NULL),
(26, 1, 2, 2, 2, 8, 15, 8, 40, NULL, NULL, NULL, NULL, NULL, NULL),
(27, 1, 1, 1, 2, 9, 10, 4, 20, NULL, NULL, NULL, NULL, NULL, NULL),
(28, 1, 1, 1, 2, 10, 10, 4, 20, NULL, NULL, NULL, NULL, NULL, NULL),
(29, 1, 1, 1, 2, 15, 20, 8, 40, NULL, NULL, NULL, NULL, NULL, NULL),
(30, 1, 1, 1, 3, 16, 20, 8, 40, NULL, NULL, NULL, NULL, NULL, NULL),
(31, 1, 1, 1, 3, 17, 20, 8, 40, NULL, NULL, NULL, NULL, NULL, NULL),
(32, 1, 1, 1, 3, 18, 20, 8, 40, NULL, NULL, NULL, NULL, NULL, NULL),
(33, 1, 1, 1, 3, 19, 20, 8, 40, NULL, NULL, NULL, NULL, NULL, NULL),
(34, 1, 1, 1, 3, 20, 20, 8, 40, NULL, NULL, NULL, NULL, NULL, NULL),
(35, 1, 2, 2, 3, 1, 15, 8, 40, NULL, NULL, NULL, NULL, NULL, NULL),
(36, 1, 2, 2, 3, 2, 15, 8, 40, NULL, NULL, NULL, NULL, NULL, NULL),
(37, 1, 2, 2, 3, 3, 15, 8, 40, NULL, NULL, NULL, NULL, NULL, NULL),
(38, 1, 2, 2, 3, 4, 15, 8, 40, NULL, NULL, NULL, NULL, NULL, NULL),
(39, 1, 2, 2, 3, 5, 15, 8, 40, NULL, NULL, NULL, NULL, NULL, NULL),
(40, 1, 2, 2, 3, 6, 15, 8, 40, NULL, NULL, NULL, NULL, NULL, NULL),
(41, 1, 2, 2, 3, 7, 15, 8, 40, NULL, NULL, NULL, NULL, NULL, NULL),
(42, 1, 2, 2, 3, 8, 15, 8, 40, NULL, NULL, NULL, NULL, NULL, NULL),
(43, 1, 1, 1, 3, 9, 10, 4, 20, NULL, NULL, NULL, NULL, NULL, NULL),
(44, 1, 1, 1, 3, 10, 10, 4, 20, NULL, NULL, NULL, NULL, NULL, NULL),
(45, 1, 1, 1, 3, 15, 20, 8, 40, NULL, NULL, NULL, NULL, NULL, NULL),
(46, 1, 1, 1, 4, 16, 20, 8, 40, NULL, NULL, NULL, NULL, NULL, NULL),
(47, 1, 1, 1, 4, 17, 20, 8, 40, NULL, NULL, NULL, NULL, NULL, NULL),
(48, 1, 1, 1, 4, 18, 20, 8, 40, NULL, NULL, NULL, NULL, NULL, NULL),
(49, 1, 1, 1, 4, 19, 20, 8, 40, NULL, NULL, NULL, NULL, NULL, NULL),
(50, 1, 1, 1, 4, 20, 20, 8, 40, NULL, NULL, NULL, NULL, NULL, NULL),
(51, 1, 2, 2, 4, 1, 15, 8, 40, NULL, NULL, NULL, NULL, NULL, NULL),
(52, 1, 2, 2, 4, 2, 15, 8, 40, NULL, NULL, NULL, NULL, NULL, NULL),
(53, 1, 2, 2, 4, 3, 15, 8, 40, NULL, NULL, NULL, NULL, NULL, NULL),
(54, 1, 2, 2, 4, 4, 15, 8, 40, NULL, NULL, NULL, NULL, NULL, NULL),
(55, 1, 2, 2, 4, 5, 15, 8, 40, NULL, NULL, NULL, NULL, NULL, NULL),
(56, 1, 2, 2, 4, 6, 15, 8, 40, NULL, NULL, NULL, NULL, NULL, NULL),
(57, 1, 2, 2, 4, 7, 15, 8, 40, NULL, NULL, NULL, NULL, NULL, NULL),
(58, 1, 2, 2, 4, 8, 15, 8, 40, NULL, NULL, NULL, NULL, NULL, NULL),
(59, 1, 1, 1, 4, 9, 10, 4, 20, NULL, NULL, NULL, NULL, NULL, NULL),
(60, 1, 1, 1, 4, 10, 10, 4, 20, NULL, NULL, NULL, NULL, NULL, NULL),
(61, 1, 1, 1, 4, 15, 20, 8, 40, NULL, NULL, NULL, NULL, NULL, NULL),
(62, 1, 2, 1, 5, 1, 10, 4, 5, NULL, NULL, NULL, NULL, NULL, NULL),
(63, 1, 2, 2, 5, 1, 40, 16, 80, NULL, NULL, NULL, NULL, NULL, NULL),
(64, 1, 2, 1, 5, 2, 10, 4, 5, NULL, NULL, NULL, NULL, NULL, NULL),
(65, 1, 2, 2, 5, 2, 40, 16, 80, NULL, NULL, NULL, NULL, NULL, NULL),
(66, 1, 2, 1, 5, 3, 10, 4, 5, NULL, NULL, NULL, NULL, NULL, NULL),
(67, 1, 2, 2, 5, 3, 40, 16, 80, NULL, NULL, NULL, NULL, NULL, NULL),
(68, 1, 2, 1, 5, 4, 10, 4, 5, NULL, NULL, NULL, NULL, NULL, NULL),
(69, 1, 2, 2, 5, 4, 40, 16, 80, NULL, NULL, NULL, NULL, NULL, NULL),
(70, 1, 2, 1, 5, 5, 10, 4, 5, NULL, NULL, NULL, NULL, NULL, NULL),
(71, 1, 2, 2, 5, 5, 40, 16, 80, NULL, NULL, NULL, NULL, NULL, NULL),
(72, 1, 2, 1, 5, 6, 10, 4, 5, NULL, NULL, NULL, NULL, NULL, NULL),
(73, 1, 2, 2, 5, 6, 40, 16, 80, NULL, NULL, NULL, NULL, NULL, NULL),
(74, 1, 2, 1, 5, 7, 10, 4, 5, NULL, NULL, NULL, NULL, NULL, NULL),
(75, 1, 2, 2, 5, 7, 40, 16, 80, NULL, NULL, NULL, NULL, NULL, NULL),
(76, 1, 2, 1, 5, 8, 10, 4, 5, NULL, NULL, NULL, NULL, NULL, NULL),
(77, 1, 2, 2, 5, 8, 40, 16, 80, NULL, NULL, NULL, NULL, NULL, NULL),
(78, 1, 2, 1, 5, 9, 5, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(79, 1, 2, 2, 5, 9, 20, 8, 40, NULL, NULL, NULL, NULL, NULL, NULL),
(80, 1, 2, 1, 5, 10, 5, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(81, 1, 2, 2, 5, 19, 20, 8, 40, NULL, NULL, NULL, NULL, NULL, NULL),
(82, 1, 2, 1, 5, 15, 10, 4, 5, NULL, NULL, NULL, NULL, NULL, NULL),
(83, 1, 2, 2, 5, 15, 40, 16, 80, NULL, NULL, NULL, NULL, NULL, NULL),
(84, 1, 2, 1, 6, 1, 10, 4, 5, NULL, NULL, NULL, NULL, NULL, NULL),
(85, 1, 2, 2, 6, 1, 40, 16, 80, NULL, NULL, NULL, NULL, NULL, NULL),
(86, 1, 2, 1, 6, 2, 10, 4, 5, NULL, NULL, NULL, NULL, NULL, NULL),
(87, 1, 2, 2, 6, 2, 40, 16, 80, NULL, NULL, NULL, NULL, NULL, NULL),
(88, 1, 2, 1, 6, 3, 10, 4, 5, NULL, NULL, NULL, NULL, NULL, NULL),
(89, 1, 2, 2, 6, 3, 40, 16, 80, NULL, NULL, NULL, NULL, NULL, NULL),
(90, 1, 2, 1, 6, 4, 10, 4, 5, NULL, NULL, NULL, NULL, NULL, NULL),
(91, 1, 2, 2, 6, 4, 40, 16, 80, NULL, NULL, NULL, NULL, NULL, NULL),
(92, 1, 2, 1, 6, 5, 10, 4, 5, NULL, NULL, NULL, NULL, NULL, NULL),
(93, 1, 2, 2, 6, 5, 40, 16, 80, NULL, NULL, NULL, NULL, NULL, NULL),
(94, 1, 2, 1, 6, 6, 10, 4, 5, NULL, NULL, NULL, NULL, NULL, NULL),
(95, 1, 2, 2, 6, 6, 40, 16, 80, NULL, NULL, NULL, NULL, NULL, NULL),
(96, 1, 2, 1, 6, 7, 10, 4, 5, NULL, NULL, NULL, NULL, NULL, NULL),
(97, 1, 2, 2, 6, 7, 40, 16, 80, NULL, NULL, NULL, NULL, NULL, NULL),
(98, 1, 2, 1, 6, 8, 10, 4, 5, NULL, NULL, NULL, NULL, NULL, NULL),
(99, 1, 2, 2, 6, 8, 40, 16, 80, NULL, NULL, NULL, NULL, NULL, NULL),
(100, 1, 2, 1, 6, 9, 5, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(101, 1, 2, 2, 6, 9, 20, 8, 40, NULL, NULL, NULL, NULL, NULL, NULL),
(102, 1, 2, 1, 6, 10, 5, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(103, 1, 2, 2, 6, 19, 20, 8, 40, NULL, NULL, NULL, NULL, NULL, NULL),
(104, 1, 2, 1, 6, 15, 10, 4, 5, NULL, NULL, NULL, NULL, NULL, NULL),
(105, 1, 2, 2, 6, 15, 40, 16, 80, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `exammodes`
--

CREATE TABLE `exammodes` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `session_id` int(11) DEFAULT NULL,
  `school_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exammodes`
--

INSERT INTO `exammodes` (`id`, `name`, `details`, `status`, `remarks`, `session_id`, `school_id`, `created_at`, `updated_at`) VALUES
(1, 'Oral', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'Written', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'Project', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'Assignment', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'Practical', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `session_id` int(11) DEFAULT NULL,
  `school_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exams`
--

INSERT INTO `exams` (`id`, `name`, `details`, `status`, `remark`, `session_id`, `school_id`, `created_at`, `updated_at`) VALUES
(1, 'FIRST TERM', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'SECOND TERM', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'THIRD TERM', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `examtypes`
--

CREATE TABLE `examtypes` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `session_id` int(11) NOT NULL,
  `school_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `examtypes`
--

INSERT INTO `examtypes` (`id`, `name`, `details`, `status`, `remark`, `session_id`, `school_id`, `created_at`, `updated_at`) VALUES
(1, 'Formative', NULL, NULL, NULL, 0, 0, NULL, NULL),
(2, 'Summative', NULL, NULL, NULL, 0, 0, NULL, NULL);

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
-- Table structure for table `gradedescriptions`
--

CREATE TABLE `gradedescriptions` (
  `id` int(10) UNSIGNED NOT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `grade_id` int(11) DEFAULT NULL,
  `details` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `session_id` int(11) DEFAULT NULL,
  `school_id` int(11) DEFAULT NULL,
  `prev_session_pk` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gradeparticulars`
--

CREATE TABLE `gradeparticulars` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `session_id` int(11) DEFAULT NULL,
  `school_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `id` int(10) UNSIGNED NOT NULL,
  `examtype_id` int(11) NOT NULL,
  `gradeparticular_id` int(11) NOT NULL,
  `stpercentage` double(8,2) NOT NULL,
  `enpercentage` double(8,2) NOT NULL,
  `details` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `session_id` int(11) DEFAULT NULL,
  `school_id` int(11) DEFAULT NULL,
  `prev_session_pk` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `marksentries`
--

CREATE TABLE `marksentries` (
  `id` int(10) UNSIGNED NOT NULL,
  `examdetail_id` int(11) NOT NULL,
  `myclasssection_id` int(11) NOT NULL,
  `myclasssubject_id` int(11) NOT NULL,
  `studentcr_id` int(11) NOT NULL,
  `marks` double NOT NULL,
  `remark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `session_id` int(11) DEFAULT NULL,
  `school_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
(7, '2014_10_12_000000_create_users_table', 1),
(8, '2014_10_12_100000_create_password_resets_table', 1),
(9, '2019_08_19_000000_create_failed_jobs_table', 1),
(10, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(11, '2024_06_22_151005_create_notices_table', 1),
(12, '2024_06_25_133932_create_roles_table', 1),
(13, '2024_08_18_131554_create_teachers_table', 2),
(14, '2024_08_19_043016_create_schools_table', 3),
(15, '2024_08_19_043104_create_sessions_table', 3),
(16, '2024_08_19_043131_create_categories_table', 3),
(17, '2024_08_19_043306_create_subjects_table', 3),
(18, '2024_08_19_043331_create_myclasses_table', 3),
(19, '2024_08_19_043359_create_studentdbs_table', 3),
(20, '2024_08_19_043410_create_studentcrs_table', 3),
(21, '2024_08_19_043447_create_exams_table', 3),
(22, '2024_08_19_043506_create_examtypes_table', 3),
(23, '2024_08_19_043523_create_exammodes_table', 3),
(24, '2024_08_19_043627_create_myclasssections_table', 3),
(25, '2024_08_19_043654_create_myclasssubjects_table', 3),
(26, '2024_08_19_043717_create_myclassteachers_table', 3),
(27, '2024_08_19_043749_create_subjectteachers_table', 4),
(28, '2024_08_19_060806_create_sections_table', 4),
(29, '2024_08_19_064941_create_gradeparticulars_table', 4),
(30, '2024_08_19_065412_create_grades_table', 4),
(31, '2024_08_19_065425_create_gradedescriptions_table', 4),
(33, '2024_08_19_065933_create_marksentries_table', 4),
(34, '2024_08_19_070427_create_answerscriptdistributions_table', 4),
(35, '2024_08_19_070857_create_questionpaperliabilities_table', 4),
(36, '2024_08_19_155934_create_rooms_table', 4),
(37, '2024_08_19_160334_create_promotionalrules_table', 5),
(38, '2024_08_19_065757_create_examdetails_table', 6);

-- --------------------------------------------------------

--
-- Table structure for table `myclasses`
--

CREATE TABLE `myclasses` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `next_class_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prev_session_pk` int(11) DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `session_id` int(11) DEFAULT NULL,
  `school_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `myclasses`
--

INSERT INTO `myclasses` (`id`, `name`, `details`, `next_class_id`, `prev_session_pk`, `status`, `remark`, `session_id`, `school_id`, `created_at`, `updated_at`) VALUES
(1, 'V', 'FIVE', '2', 0, 'active', NULL, 1, 1, NULL, NULL),
(2, 'VI', 'SIX', '3', 1, 'active', NULL, 1, 1, NULL, NULL),
(3, 'VII', 'SEVEN', '4', 2, 'active', NULL, 1, 1, NULL, NULL),
(4, 'VIII', 'EIGHT', '5', 3, 'active', NULL, 1, 1, NULL, NULL),
(5, 'IX', 'NITE', '6', 4, 'active', NULL, 1, 1, NULL, NULL),
(6, 'X', 'TEN', '7', 5, 'active', NULL, 1, 1, NULL, NULL),
(7, 'XI', 'ELEVEL', '8', 6, 'active', NULL, 1, 1, NULL, NULL),
(8, 'XII', 'TWELVE', '9', 7, 'active', NULL, 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `myclasssections`
--

CREATE TABLE `myclasssections` (
  `id` int(10) UNSIGNED NOT NULL,
  `myclass_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `details` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `session_id` int(11) DEFAULT NULL,
  `school_id` int(11) DEFAULT NULL,
  `prev_session_pk` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `myclasssections`
--

INSERT INTO `myclasssections` (`id`, `myclass_id`, `section_id`, `details`, `status`, `remark`, `session_id`, `school_id`, `prev_session_pk`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 1, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 1, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 1, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 1, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 2, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 2, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 3, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 4, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 4, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, 4, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(18, 4, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, 5, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(20, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(21, 5, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(22, 6, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(23, 6, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(24, 6, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `myclasssubjects`
--

CREATE TABLE `myclasssubjects` (
  `id` int(10) UNSIGNED NOT NULL,
  `myclass_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `examtype_id` int(11) NOT NULL,
  `is_additional` int(11) NOT NULL,
  `subject_order` int(11) NOT NULL,
  `combination_no` int(11) NOT NULL DEFAULT 0,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `session_id` int(11) DEFAULT NULL,
  `school_id` int(11) DEFAULT NULL,
  `prev_session_pk` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `myclasssubjects`
--

INSERT INTO `myclasssubjects` (`id`, `myclass_id`, `subject_id`, `examtype_id`, `is_additional`, `subject_order`, `combination_no`, `status`, `remark`, `session_id`, `school_id`, `prev_session_pk`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 2, 0, 1, 0, NULL, NULL, 1, 1, 0, NULL, NULL),
(2, 1, 16, 1, 0, 1, 0, NULL, NULL, 1, 1, 0, NULL, NULL),
(3, 1, 17, 1, 0, 2, 0, NULL, NULL, 1, 1, 0, NULL, NULL),
(4, 1, 18, 1, 0, 3, 0, NULL, NULL, 1, 1, 0, NULL, NULL),
(5, 1, 19, 1, 0, 4, 0, NULL, NULL, 1, 1, 0, NULL, NULL),
(6, 1, 20, 1, 0, 5, 0, NULL, NULL, 1, 1, 0, NULL, NULL),
(7, 1, 2, 2, 0, 2, 0, NULL, NULL, 1, 1, 0, NULL, NULL),
(8, 1, 3, 2, 0, 3, 0, NULL, NULL, 1, 1, 0, NULL, NULL),
(9, 1, 4, 2, 0, 4, 0, NULL, NULL, 1, 1, 0, NULL, NULL),
(10, 1, 5, 2, 0, 5, 0, NULL, NULL, 1, 1, 0, NULL, NULL),
(11, 1, 9, 2, 1, 6, 7, NULL, NULL, 1, 1, 0, NULL, NULL),
(12, 1, 10, 2, 1, 7, 7, NULL, NULL, 1, 1, 0, NULL, NULL),
(13, 1, 15, 2, 1, 7, -7, NULL, NULL, 1, 1, 0, NULL, NULL),
(14, 2, 16, 1, 0, 1, 0, NULL, NULL, 1, 1, 0, NULL, NULL),
(15, 2, 17, 1, 0, 2, 0, NULL, NULL, 1, 1, 0, NULL, NULL),
(16, 2, 18, 1, 0, 3, 0, NULL, NULL, 1, 1, 0, NULL, NULL),
(17, 2, 19, 1, 0, 4, 0, NULL, NULL, 1, 1, 0, NULL, NULL),
(18, 2, 20, 1, 0, 5, 0, NULL, NULL, 1, 1, 0, NULL, NULL),
(19, 2, 1, 2, 0, 1, 0, NULL, NULL, 1, 1, 0, NULL, NULL),
(20, 2, 2, 2, 0, 2, 0, NULL, NULL, 1, 1, 0, NULL, NULL),
(21, 2, 3, 2, 0, 3, 0, NULL, NULL, 1, 1, 0, NULL, NULL),
(22, 2, 4, 2, 0, 4, 0, NULL, NULL, 1, 1, 0, NULL, NULL),
(23, 2, 5, 2, 0, 5, 0, NULL, NULL, 1, 1, 0, NULL, NULL),
(24, 2, 6, 2, 0, 6, 0, NULL, NULL, 1, 1, 0, NULL, NULL),
(25, 2, 7, 2, 0, 7, 0, NULL, NULL, 1, 1, 0, NULL, NULL),
(26, 2, 8, 2, 0, 8, 0, NULL, NULL, 1, 1, 0, NULL, NULL),
(27, 2, 9, 2, 1, 9, 8, NULL, NULL, 1, 1, 0, NULL, NULL),
(28, 2, 10, 2, 1, 10, 8, NULL, NULL, 1, 1, 0, NULL, NULL),
(29, 2, 15, 2, 1, 11, -8, NULL, NULL, 1, 1, 0, NULL, NULL),
(30, 3, 16, 1, 0, 1, 0, NULL, NULL, 1, 1, 0, NULL, NULL),
(31, 3, 17, 1, 0, 2, 0, NULL, NULL, 1, 1, 0, NULL, NULL),
(32, 3, 18, 1, 0, 3, 0, NULL, NULL, 1, 1, 0, NULL, NULL),
(33, 3, 19, 1, 0, 4, 0, NULL, NULL, 1, 1, 0, NULL, NULL),
(34, 3, 20, 1, 0, 5, 0, NULL, NULL, 1, 1, 0, NULL, NULL),
(35, 3, 1, 2, 0, 1, 0, NULL, NULL, 1, 1, 0, NULL, NULL),
(36, 3, 2, 2, 0, 2, 0, NULL, NULL, 1, 1, 0, NULL, NULL),
(37, 3, 3, 2, 0, 3, 0, NULL, NULL, 1, 1, 0, NULL, NULL),
(38, 3, 4, 2, 0, 4, 0, NULL, NULL, 1, 1, 0, NULL, NULL),
(39, 3, 5, 2, 0, 5, 0, NULL, NULL, 1, 1, 0, NULL, NULL),
(40, 3, 6, 2, 0, 6, 0, NULL, NULL, 1, 1, 0, NULL, NULL),
(41, 3, 7, 2, 0, 7, 0, NULL, NULL, 1, 1, 0, NULL, NULL),
(42, 3, 8, 2, 0, 8, 0, NULL, NULL, 1, 1, 0, NULL, NULL),
(43, 3, 9, 2, 1, 9, 9, NULL, NULL, 1, 1, 0, NULL, NULL),
(44, 3, 10, 2, 1, 10, 9, NULL, NULL, 1, 1, 0, NULL, NULL),
(45, 3, 15, 2, 1, 11, -9, NULL, NULL, 1, 1, 0, NULL, NULL),
(46, 4, 16, 1, 0, 1, 0, NULL, NULL, 1, 1, 0, NULL, NULL),
(47, 4, 17, 1, 0, 2, 0, NULL, NULL, 1, 1, 0, NULL, NULL),
(48, 4, 18, 1, 0, 3, 0, NULL, NULL, 1, 1, 0, NULL, NULL),
(49, 4, 19, 1, 0, 4, 0, NULL, NULL, 1, 1, 0, NULL, NULL),
(50, 4, 20, 1, 0, 5, 0, NULL, NULL, 1, 1, 0, NULL, NULL),
(51, 4, 1, 2, 0, 1, 0, NULL, NULL, 1, 1, 0, NULL, NULL),
(52, 4, 2, 2, 0, 2, 0, NULL, NULL, 1, 1, 0, NULL, NULL),
(53, 4, 3, 2, 0, 3, 0, NULL, NULL, 1, 1, 0, NULL, NULL),
(54, 4, 4, 2, 0, 4, 0, NULL, NULL, 1, 1, 0, NULL, NULL),
(55, 4, 5, 2, 0, 5, 0, NULL, NULL, 1, 1, 0, NULL, NULL),
(56, 4, 6, 2, 0, 6, 0, NULL, NULL, 1, 1, 0, NULL, NULL),
(57, 4, 7, 2, 0, 7, 0, NULL, NULL, 1, 1, 0, NULL, NULL),
(58, 4, 8, 2, 0, 8, 0, NULL, NULL, 1, 1, 0, NULL, NULL),
(59, 4, 9, 2, 1, 9, 10, NULL, NULL, 1, 1, 0, NULL, NULL),
(60, 4, 10, 2, 1, 10, 10, NULL, NULL, 1, 1, 0, NULL, NULL),
(61, 4, 15, 2, 1, 11, -10, NULL, NULL, 1, 1, 0, NULL, NULL),
(62, 4, 16, 1, 0, 1, 0, NULL, NULL, 1, 1, 0, NULL, NULL),
(63, 4, 17, 1, 0, 2, 0, NULL, NULL, 1, 1, 0, NULL, NULL),
(64, 4, 18, 1, 0, 3, 0, NULL, NULL, 1, 1, 0, NULL, NULL),
(65, 4, 19, 1, 0, 4, 0, NULL, NULL, 1, 1, 0, NULL, NULL),
(66, 4, 20, 1, 0, 5, 0, NULL, NULL, 1, 1, 0, NULL, NULL),
(67, 4, 1, 2, 0, 1, 0, NULL, NULL, 1, 1, 0, NULL, NULL),
(68, 4, 2, 2, 0, 2, 0, NULL, NULL, 1, 1, 0, NULL, NULL),
(69, 4, 3, 2, 0, 3, 0, NULL, NULL, 1, 1, 0, NULL, NULL),
(70, 4, 4, 2, 0, 4, 0, NULL, NULL, 1, 1, 0, NULL, NULL),
(71, 4, 5, 2, 0, 5, 0, NULL, NULL, 1, 1, 0, NULL, NULL),
(72, 4, 6, 2, 0, 6, 0, NULL, NULL, 1, 1, 0, NULL, NULL),
(73, 4, 7, 2, 0, 7, 0, NULL, NULL, 1, 1, 0, NULL, NULL),
(74, 4, 8, 2, 0, 8, 0, NULL, NULL, 1, 1, 0, NULL, NULL),
(75, 4, 9, 2, 1, 9, 10, NULL, NULL, 1, 1, 0, NULL, NULL),
(76, 4, 10, 2, 1, 10, 10, NULL, NULL, 1, 1, 0, NULL, NULL),
(77, 4, 15, 2, 1, 11, -10, NULL, NULL, 1, 1, 0, NULL, NULL),
(78, 5, 1, 2, 0, 1, 0, NULL, NULL, 1, 1, 0, NULL, NULL),
(79, 5, 2, 2, 0, 2, 0, NULL, NULL, 1, 1, 0, NULL, NULL),
(80, 5, 3, 2, 1, 3, 0, NULL, NULL, 1, 1, 0, NULL, NULL),
(81, 5, 4, 2, 0, 4, 0, NULL, NULL, 1, 1, 0, NULL, NULL),
(82, 5, 8, 2, 0, 5, 0, NULL, NULL, 1, 1, 0, NULL, NULL),
(83, 5, 9, 2, 1, 6, 11, NULL, NULL, 1, 1, 0, NULL, NULL),
(84, 5, 10, 2, 1, 7, 11, NULL, NULL, 1, 1, 0, NULL, NULL),
(85, 5, 11, 2, 0, 8, 0, NULL, NULL, 1, 1, 0, NULL, NULL),
(86, 5, 12, 2, 0, 9, 0, NULL, NULL, 1, 1, 0, NULL, NULL),
(87, 5, 13, 2, 0, 10, 0, NULL, NULL, 1, 1, 0, NULL, NULL),
(88, 5, 14, 2, 0, 11, 0, NULL, NULL, 1, 1, 0, NULL, NULL),
(89, 5, 15, 2, 1, 12, -11, NULL, NULL, 1, 1, 0, NULL, NULL),
(90, 6, 1, 2, 0, 1, 0, NULL, NULL, 1, 1, 0, NULL, NULL),
(91, 6, 2, 2, 0, 2, 0, NULL, NULL, 1, 1, 0, NULL, NULL),
(92, 6, 3, 2, 1, 3, 0, NULL, NULL, 1, 1, 0, NULL, NULL),
(93, 6, 4, 2, 0, 4, 0, NULL, NULL, 1, 1, 0, NULL, NULL),
(94, 6, 8, 2, 0, 5, 0, NULL, NULL, 1, 1, 0, NULL, NULL),
(95, 6, 9, 2, 1, 6, 11, NULL, NULL, 1, 1, 0, NULL, NULL),
(96, 6, 10, 2, 1, 7, 11, NULL, NULL, 1, 1, 0, NULL, NULL),
(97, 6, 11, 2, 0, 8, 0, NULL, NULL, 1, 1, 0, NULL, NULL),
(98, 6, 12, 2, 0, 9, 0, NULL, NULL, 1, 1, 0, NULL, NULL),
(99, 6, 13, 2, 0, 10, 0, NULL, NULL, 1, 1, 0, NULL, NULL),
(100, 6, 14, 2, 0, 11, 0, NULL, NULL, 1, 1, 0, NULL, NULL),
(101, 6, 15, 2, 1, 12, -11, NULL, NULL, 1, 1, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `myclassteachers`
--

CREATE TABLE `myclassteachers` (
  `id` int(10) UNSIGNED NOT NULL,
  `myclass_id` int(11) DEFAULT NULL,
  `section_id` int(11) DEFAULT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `details` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `session_id` int(11) DEFAULT NULL,
  `school_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notices`
--

CREATE TABLE `notices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dop` date NOT NULL,
  `doe` date NOT NULL,
  `fileaddr` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notices`
--

INSERT INTO `notices` (`id`, `title`, `desc`, `dop`, `doe`, `fileaddr`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Hello', 'Hello Hello', '2024-06-25', '2024-06-29', 'upload/notices/1719339215.jpg', 1, '2024-06-25 12:43:35', '2024-06-25 12:43:35'),
(2, 'Second', 'Second Description', '2024-08-15', '2024-08-28', 'upload/notices/1722476388.png', 1, '2024-07-31 20:09:48', '2024-07-31 20:09:48');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('sa@gmail.com', '$2y$10$FM4hZ0wIAJ23ekepEJEsAu04pB5kWPEAm4M1ddYt32L704VPsPvp6', '2024-08-21 21:02:37');

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pma__bookmark`
--

CREATE TABLE `pma__bookmark` (
  `id` int(10) UNSIGNED NOT NULL,
  `dbase` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `label` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `query` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Bookmarks';

-- --------------------------------------------------------

--
-- Table structure for table `pma__central_columns`
--

CREATE TABLE `pma__central_columns` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_type` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_length` text COLLATE utf8_bin DEFAULT NULL,
  `col_collation` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_isNull` tinyint(1) NOT NULL,
  `col_extra` varchar(255) COLLATE utf8_bin DEFAULT '',
  `col_default` text COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Central list of columns';

-- --------------------------------------------------------

--
-- Table structure for table `pma__column_info`
--

CREATE TABLE `pma__column_info` (
  `id` int(5) UNSIGNED NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `column_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `comment` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `mimetype` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `transformation` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `transformation_options` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `input_transformation` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `input_transformation_options` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Column information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__designer_settings`
--

CREATE TABLE `pma__designer_settings` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `settings_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Settings related to Designer';

-- --------------------------------------------------------

--
-- Table structure for table `pma__export_templates`
--

CREATE TABLE `pma__export_templates` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `export_type` varchar(10) COLLATE utf8_bin NOT NULL,
  `template_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `template_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved export templates';

-- --------------------------------------------------------

--
-- Table structure for table `pma__favorite`
--

CREATE TABLE `pma__favorite` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `tables` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Favorite tables';

-- --------------------------------------------------------

--
-- Table structure for table `pma__history`
--

CREATE TABLE `pma__history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp(),
  `sqlquery` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='SQL history for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__navigationhiding`
--

CREATE TABLE `pma__navigationhiding` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `item_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `item_type` varchar(64) COLLATE utf8_bin NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Hidden items of navigation tree';

-- --------------------------------------------------------

--
-- Table structure for table `pma__pdf_pages`
--

CREATE TABLE `pma__pdf_pages` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `page_nr` int(10) UNSIGNED NOT NULL,
  `page_descr` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='PDF relation pages for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__recent`
--

CREATE TABLE `pma__recent` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `tables` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Recently accessed tables';

-- --------------------------------------------------------

--
-- Table structure for table `pma__relation`
--

CREATE TABLE `pma__relation` (
  `master_db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `master_table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `master_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Relation table';

-- --------------------------------------------------------

--
-- Table structure for table `pma__savedsearches`
--

CREATE TABLE `pma__savedsearches` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `search_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `search_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved searches';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_coords`
--

CREATE TABLE `pma__table_coords` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `pdf_page_number` int(11) NOT NULL DEFAULT 0,
  `x` float UNSIGNED NOT NULL DEFAULT 0,
  `y` float UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table coordinates for phpMyAdmin PDF output';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_info`
--

CREATE TABLE `pma__table_info` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `display_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_uiprefs`
--

CREATE TABLE `pma__table_uiprefs` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `prefs` text COLLATE utf8_bin NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tables'' UI preferences';

-- --------------------------------------------------------

--
-- Table structure for table `pma__tracking`
--

CREATE TABLE `pma__tracking` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `version` int(10) UNSIGNED NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `schema_snapshot` text COLLATE utf8_bin NOT NULL,
  `schema_sql` text COLLATE utf8_bin DEFAULT NULL,
  `data_sql` longtext COLLATE utf8_bin DEFAULT NULL,
  `tracking` set('UPDATE','REPLACE','INSERT','DELETE','TRUNCATE','CREATE DATABASE','ALTER DATABASE','DROP DATABASE','CREATE TABLE','ALTER TABLE','RENAME TABLE','DROP TABLE','CREATE INDEX','DROP INDEX','CREATE VIEW','ALTER VIEW','DROP VIEW') COLLATE utf8_bin DEFAULT NULL,
  `tracking_active` int(1) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Database changes tracking for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__userconfig`
--

CREATE TABLE `pma__userconfig` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `config_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User preferences storage for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__usergroups`
--

CREATE TABLE `pma__usergroups` (
  `usergroup` varchar(64) COLLATE utf8_bin NOT NULL,
  `tab` varchar(64) COLLATE utf8_bin NOT NULL,
  `allowed` enum('Y','N') COLLATE utf8_bin NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User groups with configured menu items';

-- --------------------------------------------------------

--
-- Table structure for table `pma__users`
--

CREATE TABLE `pma__users` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `usergroup` varchar(64) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Users and their assignments to user groups';

-- --------------------------------------------------------

--
-- Table structure for table `promotionalrules`
--

CREATE TABLE `promotionalrules` (
  `id` int(10) UNSIGNED NOT NULL,
  `myclass_id` int(11) NOT NULL,
  `examtype_id` int(11) NOT NULL,
  `noofsubjects` int(11) NOT NULL,
  `allowableds` int(11) NOT NULL,
  `details` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passmarks` int(11) DEFAULT NULL,
  `fullmarks` int(11) DEFAULT NULL,
  `remark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `session_id` int(11) DEFAULT NULL,
  `school_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questionpaperliabilities`
--

CREATE TABLE `questionpaperliabilities` (
  `id` int(10) UNSIGNED NOT NULL,
  `school_id` int(11) DEFAULT NULL,
  `session_id` int(11) DEFAULT NULL,
  `exam_id` int(11) DEFAULT NULL,
  `examtype_id` int(11) DEFAULT NULL,
  `exammode_id` int(11) DEFAULT NULL,
  `myclass_id` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  `issue_dt` date DEFAULT NULL,
  `submit_dt` date DEFAULT NULL,
  `finalize_dt` date DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'User', 'Students', NULL, NULL),
(2, 'Sub Admin', 'Teacher', NULL, NULL),
(3, 'Admin', 'Headmaster', NULL, NULL),
(4, 'Super Admin', 'Sw Owner', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(10) UNSIGNED NOT NULL,
  `no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `floor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `noofbenchs` int(11) NOT NULL,
  `capacity` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  `remark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `session_id` int(11) DEFAULT NULL,
  `school_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `schools`
--

CREATE TABLE `schools` (
  `id` int(10) UNSIGNED NOT NULL,
  `session_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vill` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `po` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ps` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dist` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `index` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hscode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `disecode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estd` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `schools`
--

INSERT INTO `schools` (`id`, `session_id`, `name`, `details`, `vill`, `po`, `ps`, `pin`, `dist`, `index`, `hscode`, `disecode`, `estd`, `status`, `remark`, `created_at`, `updated_at`) VALUES
(1, 1, 'Manikchak High Madrasah(H.S)', 'Eseted 1921 by the founder Abdul Bari Saheb', 'Kaharpara', 'Manikchak', 'Lalgola', '742148', 'Murshidabad', '116126', 'abcd', '19071515802', '1921', 'active', 'nothing', '2024-08-18 18:30:00', '2024-08-18 18:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `session_id` int(11) DEFAULT NULL,
  `school_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `name`, `details`, `remark`, `status`, `session_id`, `school_id`, `created_at`, `updated_at`) VALUES
(1, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'B', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'C', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'D', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'E', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'F', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stdate` date NOT NULL,
  `entdate` date NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prev_session_id` int(11) DEFAULT NULL,
  `next_session_id` int(11) DEFAULT NULL,
  `school_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `name`, `details`, `stdate`, `entdate`, `status`, `remark`, `prev_session_id`, `next_session_id`, `school_id`, `created_at`, `updated_at`) VALUES
(1, '2024', 'First Online Session', '2024-01-01', '2024-12-31', 'active', 'nothing special', 0, 2, 1, '2024-08-14 18:30:00', '2024-08-14 18:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `studentcrs`
--

CREATE TABLE `studentcrs` (
  `id` int(10) UNSIGNED NOT NULL,
  `studentdb_id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `myclass_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `roll_no` int(11) NOT NULL,
  `result` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `crstatus` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `next_clss_id` int(11) DEFAULT NULL,
  `next_section_id` int(11) DEFAULT NULL,
  `school_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `studentdbs`
--

CREATE TABLE `studentdbs` (
  `id` int(10) UNSIGNED NOT NULL,
  `studentid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admBookNo` int(10) UNSIGNED NOT NULL,
  `admSlNo` int(10) UNSIGNED NOT NULL,
  `admDate` date NOT NULL,
  `prCls` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prSch` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adhaar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fadhaar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `madhaar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `vill` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `post` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pstn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dist` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobl` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ssex` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phch` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `relg` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cste` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `natn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `accNo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ifsc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `micr` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bnnm` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `brnm` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stclass_id` int(11) DEFAULT NULL,
  `stsection_id` int(11) DEFAULT NULL,
  `session_id` int(11) DEFAULT NULL,
  `school_id` int(11) DEFAULT NULL,
  `streason` int(11) DEFAULT NULL,
  `enclass_id` int(11) DEFAULT NULL,
  `ensection_id` int(11) DEFAULT NULL,
  `ensession_id` int(11) DEFAULT NULL,
  `enreason` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `crstatus` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `studentdbs`
--

INSERT INTO `studentdbs` (`id`, `studentid`, `admBookNo`, `admSlNo`, `admDate`, `prCls`, `prSch`, `name`, `adhaar`, `fname`, `fadhaar`, `mname`, `madhaar`, `dob`, `vill`, `post`, `pstn`, `dist`, `pin`, `mobl`, `ssex`, `phch`, `relg`, `cste`, `natn`, `accNo`, `ifsc`, `micr`, `bnnm`, `brnm`, `stclass_id`, `stsection_id`, `session_id`, `school_id`, `streason`, `enclass_id`, `ensection_id`, `ensession_id`, `enreason`, `crstatus`, `remarks`, `created_at`, `updated_at`) VALUES
(1, '01783521001136', 0, 0, '0000-00-00', '', '', 'abul', NULL, 'rahul', '123', 'minu', NULL, '2024-07-03', NULL, NULL, NULL, NULL, NULL, '123', 'female', NULL, NULL, NULL, 'indian', '3456', 'fd3fd', NULL, NULL, NULL, 6, 3, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, '12345678', 0, 0, '2024-08-01', 'Five', 'ABCD', 'Ratan Das', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, '01783521001136', 0, 0, '0000-00-00', '', '', 'ABUL KASEM', NULL, 'REJUAN ALI', NULL, 'REBA BIBI', NULL, '0000-00-00', NULL, NULL, NULL, NULL, NULL, '7365090540', 'Female', NULL, NULL, NULL, 'INDIAN', '5021021376570', 'PUNB0RRBBGB', NULL, NULL, NULL, 6, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '10', NULL, NULL),
(4, '01783521001136', 0, 0, '2024-01-01', '0', '0', 'ABUL KASEM', NULL, 'REJUAN ALI', NULL, 'REBA BIBI', NULL, '2008-08-15', NULL, NULL, NULL, NULL, NULL, '7365090540', 'Female', NULL, NULL, NULL, 'INDIAN', '5021021376570', 'PUNB0RRBBGB', NULL, NULL, NULL, 6, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '10', NULL, NULL),
(5, '01783521001136', 0, 0, '2024-01-01', '0', '0', 'ABUL KASEM', NULL, 'REJUAN ALI', NULL, 'REBA BIBI', NULL, '0000-00-00', NULL, NULL, NULL, NULL, NULL, '7365090540', 'Female', NULL, NULL, NULL, 'INDIAN', '5021021376570', 'PUNB0RRBBGB', NULL, NULL, NULL, 6, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '10', NULL, NULL),
(6, '05329021000075', 0, 0, '2024-01-01', '0', '0', 'ABDUL HAMID', NULL, 'ASIF ALI', NULL, 'AKTARA BIBI', NULL, '0000-00-00', NULL, NULL, NULL, NULL, NULL, '8670586915', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 6, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '14', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `examtype_id` int(11) DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `session_id` int(11) DEFAULT NULL,
  `school_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `name`, `details`, `code`, `category_id`, `examtype_id`, `status`, `remark`, `session_id`, `school_id`, `created_at`, `updated_at`) VALUES
(1, 'Bengali', NULL, 'BENG', NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'English', NULL, 'ENGL', NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'Arabic', NULL, 'ARBC', NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'Mathematics', NULL, 'MATM', NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'Environment and Science', NULL, 'ENSC', NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'Environment and History', NULL, 'ENHS', NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'Environment and Geography', NULL, 'ENGR', NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'Islam Parichay', NULL, 'ISPR', NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 'Health & Physical Education', NULL, 'HLPH', NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 'Art & Work Education', NULL, 'ARWR', NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 'Physical Science', NULL, 'PHSC', NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 'Life Science', NULL, 'LFSC', NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 'History', NULL, 'HIST', NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 'Geography', NULL, 'GEGR', NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 'Computer Application', NULL, 'COMA', NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 'Participation', NULL, 'PRCP', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(17, 'Questioning and Experimentation', NULL, 'QUEX', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(18, 'Interpretation and Application', NULL, 'INAP', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(19, 'Empathy and Co-operation', NULL, 'EMCO', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(20, 'Aesthetic and Creative Expression', NULL, 'ASCE', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subjectteachers`
--

CREATE TABLE `subjectteachers` (
  `id` int(10) UNSIGNED NOT NULL,
  `subject_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `details` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `session_id` int(11) DEFAULT NULL,
  `school_id` int(11) DEFAULT NULL,
  `prev_session_pk` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `session_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nickName` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobno` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desig` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hqual` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `train_qual` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `extra_qual` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `main_subject_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prev_session_pk` int(11) DEFAULT NULL,
  `img_ref` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `session_id`, `name`, `nickName`, `mobno`, `desig`, `hqual`, `train_qual`, `extra_qual`, `main_subject_id`, `status`, `notes`, `prev_session_pk`, `img_ref`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'Md Abdur Rouf', 'AR', '9735771008', 'HM/TIC', 'Masters with B.Ed', '', '', '17', 'OKey', 'NA', 0, 'img reference', 1, '2018-03-22 08:34:13', '2024-08-21 21:13:50'),
(2, 1, 'Rafina Yeasmin', 'RY', NULL, 'AHM', 'Masters with B.Ed', '', '', '2', 'OKey', 'NA', 0, 'img reference', 2, '2018-03-22 08:34:42', '2023-09-11 03:29:44'),
(3, 1, 'Narayan Barman', 'NB', '9732530964', 'Asst. Teacher', 'Masters with B.Ed', '', '', '5', 'OKey', 'NA', 0, 'img reference', 0, '2018-03-22 08:35:26', '2018-08-05 01:31:08'),
(4, 1, 'Ganesh Chandra Mondal', 'GCM', '9733812253', 'Asst. Teacher', 'Masters with B.Ed', '', '', '10', 'OKey', 'NA', 0, 'img reference', 0, '2018-03-27 12:11:08', '2018-09-25 02:10:37'),
(5, 1, 'Md Abdul Momen', 'AM', '9735357312', 'Asst. Teacher', 'Masters with B.Ed', '', '', '19', 'OKey', 'NA', 0, 'img reference', 3, '2018-03-27 12:11:39', '2018-08-28 05:10:30'),
(6, 1, 'Navid Anjum', 'NA', NULL, 'Asst. Teacher', 'Masters with B.Ed', '', '', '4', 'OKey', 'NA', 0, 'img reference', 0, '2018-03-27 12:12:17', '2018-03-27 12:12:17'),
(7, 1, 'Soumen Mondal', 'SM', NULL, 'Asst. Teacher', 'Bachallors with BEd', '', '', '16', 'OKey', 'NA', 0, 'img reference', 0, '2018-03-27 12:13:27', '2018-03-27 12:13:27'),
(8, 1, 'Md Mukhlesur Rahaman', 'MR', NULL, 'Asst. Teacher', 'Masters with B.Ed', '', '', '19', 'OKey', 'NA', 0, 'img reference', 0, '2018-03-27 12:16:11', '2018-03-27 12:16:11'),
(9, 1, 'Md Sarifuzzaman', 'SZ', '9733265856', 'Asst. Teacher', 'Masters with B.Ed', '', '', '3', 'OKey', 'NA', 0, 'img reference', 0, '2018-03-27 12:16:38', '2018-09-13 04:49:32'),
(10, 1, 'Rajesh Upadhyay', 'RU', NULL, 'Asst. Teacher', 'Bachallors with BEd', '', '', '16', 'OKey', 'NA', 0, 'img reference', 0, '2018-03-27 12:17:19', '2018-03-27 12:17:19'),
(11, 1, 'Koushik Goswami', 'KG', NULL, 'Asst. Teacher', 'Bachallors with BEd', '', '', '19', 'OKey', 'NA', 0, 'img reference', 0, '2018-03-27 12:18:11', '2018-03-27 12:18:11'),
(12, 1, 'Hari Narayan  Das', 'HND', '9635212811', 'Asst. Teacher', 'Masters with B.Ed', '', '', '4', 'OKey', 'NA', 0, 'img reference', 4, '2018-03-27 12:20:02', '2018-03-27 12:20:02'),
(13, 1, 'Debasis Roy', 'DR', NULL, 'Asst. Teacher', 'Masters with B.Ed', '', '', '2', 'OKey', 'NA', 0, 'img reference', 0, '2018-03-27 12:20:28', '2018-03-27 12:20:28'),
(14, 1, 'Md Abul Fazal', 'AF', NULL, 'Asst. Teacher', 'Masters with B.Ed', '', '', '3', 'OKey', 'NA', 0, 'img reference', 0, '2018-03-27 12:22:08', '2018-03-27 12:22:08'),
(15, 1, 'Dola Rani Dey', 'DRD', NULL, 'Asst. Teacher', 'Bachallors with BEd', '', '', '17', 'OKey', 'NA', 0, 'img reference', 0, '2018-03-27 12:24:44', '2018-03-27 12:24:44'),
(16, 1, 'Md Sabir Ahamed', 'SA', NULL, 'Asst. Teacher', 'Bachallors with BEd', '', '', '9', 'OKey', 'NA', 0, 'img reference', 0, '2018-03-27 12:22:40', '2018-03-27 12:22:40'),
(17, 1, 'Sk Abdul Aziz', 'SAA', NULL, 'Asst. Teacher', 'Masters with B.Ed', '', '', '1', 'OKey', 'NA', 0, 'img reference', 0, '2018-03-27 12:27:42', '2018-03-27 12:27:42'),
(18, 1, 'Md Akramul Hoque', 'AH', NULL, 'Asst. Teacher', 'Masters with B.Ed', '', '', '3', 'OKey', 'NA', 0, 'img reference', 0, '2018-08-27 03:58:43', '2018-08-27 03:58:43'),
(19, 1, 'Md Golam Mozaddid', 'GM', NULL, 'Asst. Teacher', 'Masters with B.Ed', '', '', '1', 'OKey', 'NA', 0, 'img reference', 0, '2018-08-27 03:59:24', '2018-08-27 03:59:24'),
(20, 1, 'Gajikul Islam', 'GI', NULL, 'Asst. Teacher', 'Masters with B.Ed', '', '', '1', 'OKey', 'NA', 0, 'img reference', 0, '2018-08-27 03:59:59', '2018-08-27 03:59:59'),
(21, 1, 'Arjina Khatun', 'AKh', NULL, 'Asst. Teacher', 'Masters with B.Ed', '', '', '1', 'OKey', 'NA', 0, 'img reference', 0, '2018-08-27 04:00:04', '2018-08-27 04:01:20'),
(22, 1, 'Subhankar Bhattacharya', 'SB', NULL, 'Asst. Teacher', 'Masters with B.Ed', '', '', '19', 'OKey', 'NA', 0, 'img reference', 0, '2018-08-27 04:00:39', '2018-08-27 04:02:26'),
(23, 1, 'Samsad Hossain', 'SH', NULL, 'Asst. Teacher', 'Masters with B.Ed', '', '', '2', 'OKey', 'NA', 0, 'img reference', 0, '2018-08-27 04:03:06', '2018-08-27 04:03:06'),
(24, 1, 'Md Hajekul Sk', 'HjS', NULL, 'Asst. Teacher', 'Masters with B.Ed', '', '', '18', 'OKey', 'NA', 0, 'img reference', 0, '2018-08-27 04:03:43', '2018-08-27 04:03:43'),
(25, 1, 'Md Masum Reja', 'MRj', NULL, 'Asst. Teacher', 'Masters with B.Ed', '', '', '4', 'OKey', 'NA', 0, 'img reference', 0, '2018-08-27 04:04:26', '2018-08-27 04:04:26'),
(26, 1, 'Md Ansarul Haque', 'AnH', '9563807273', 'Asst. Teacher', 'Masters with B.Ed', '', '', '16', 'OKey', 'NA', 0, 'img reference', 0, '2018-08-27 04:05:12', '2018-12-15 01:15:24'),
(27, 1, 'Md Bani Israil', 'BI', NULL, 'Asst. Teacher', 'Masters with B.Ed', '', '', '18', 'OKey', 'NA', 0, 'img reference', 0, '2018-03-27 12:24:17', '2018-03-27 12:24:17'),
(28, 1, 'Md Aynal Hoque', 'AH', NULL, 'Asst. Teacher', 'Bachallors with BEd', '', '', '2', 'OKey', 'NA', 0, 'img reference', 0, '2018-03-27 12:25:03', '2018-03-27 12:25:03'),
(29, 1, 'MD Jamaluddin', 'JU', NULL, 'Asst. Teacher', 'Bachallors', '', '', '20', 'OKey', 'NA', 0, 'img reference', 0, '2018-08-27 04:19:42', '2018-08-27 04:19:42'),
(30, 1, 'Md Sahabuddin', 'Sh', NULL, 'Asst. Teacher', 'Bachallors with BEd', '', '', '2', 'OKey', 'NA', 0, 'img reference', 0, '2018-03-27 12:28:04', '2018-03-27 12:28:04'),
(31, 1, 'Samima Khatun', 'SK', NULL, 'Asst. Teacher', 'Bachallors', '', '', '3', 'OKey', 'NA', 0, 'img reference', 0, '2018-05-15 10:14:06', '2018-05-16 08:54:39'),
(32, 1, 'Rafikul Islam', 'RI', NULL, 'Asst. Teacher', 'Masters with B.Ed', '', '', '2', 'OKey', 'NA', 0, 'img reference', 0, '2018-03-27 12:27:23', '2018-03-27 12:27:23'),
(33, 1, 'Md Rafiqul Hasan', 'RH', NULL, 'Asst. Teacher', 'Masters with B.Ed', '', '', '4', 'OKey', 'NA', 0, 'img reference', 0, '2018-03-27 12:29:26', '2018-03-27 12:29:26'),
(34, 1, 'Md Ismail Hoque', 'IHq', NULL, 'Para Teacher', 'Bachallors', '', '', '2', 'OKey', 'NA', 0, 'img reference', 0, '2018-03-27 12:31:02', '2018-03-27 12:31:02'),
(35, 1, 'Ziaul Hoque', 'ZHq', NULL, 'Para Teacher', 'Bachallors', '', '', '19', 'OKey', 'NA', 0, 'img reference', 0, '2018-03-27 12:31:30', '2018-03-27 12:31:30'),
(36, 1, 'Rakhi Khatun', 'RKh', NULL, 'Para Teacher', 'Bachallors', '', '', '1', 'OKey', 'NA', 0, 'img reference', 0, '2018-03-27 12:36:38', '2018-03-27 12:36:38'),
(37, 1, 'Ziarul Golder', 'ZG', NULL, 'Asst. Teacher', 'Masters with B.Ed', '', '', '1', 'OKey', 'NA', 0, 'img reference', 0, '2018-03-27 12:28:56', '2018-03-27 12:28:56'),
(38, 1, 'Rajibul Sk', 'DS', NULL, 'Asst. Teacher', 'Masters with B.Ed', '', '', '1', 'OKey', 'NA', 0, 'img reference', 0, '2018-03-27 12:28:56', '2018-03-27 12:28:56');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` int(11) NOT NULL DEFAULT 0,
  `teacher_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `role_id`, `teacher_id`, `created_at`, `updated_at`) VALUES
(1, 'User', 'user@gmail.com', NULL, '$2y$10$4I/GqH1X6xaHOsaz6IaFSOQWGD1Z3rdIR9SVmFgcV43Y4UNqwaSuq', NULL, 1, 2, '2024-06-25 12:25:42', '2024-06-25 12:25:42'),
(2, 'Sub Admin', 'subad@gmail.com', NULL, '$2y$10$xWBR2C70wr16W8fafFcJyubTs67NqEhWLKGjeycBmuONYzegtw59e', NULL, 2, 5, '2024-06-25 12:26:13', '2024-06-25 12:26:13'),
(3, 'Admin', 'adm@gmail.com', NULL, '$2y$10$wH6hlgukMPC6EaIgdvJQ3ONDW5.3IhJFtXDo8EMBdFIj440lRpfoC', NULL, 3, 1, '2024-06-25 12:26:49', '2024-06-25 12:26:49'),
(4, 'Super Admin', 'sa@gmail.com', NULL, '$2y$10$RyE2pp17XVshwHlqHzJSN.jiHAFqrX1aqIydx2zaW/7eYrdGDwoxy', NULL, 4, 6, '2024-06-25 12:27:21', '2024-06-25 12:27:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answerscriptdistributions`
--
ALTER TABLE `answerscriptdistributions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `examdetails`
--
ALTER TABLE `examdetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exammodes`
--
ALTER TABLE `exammodes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `examtypes`
--
ALTER TABLE `examtypes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `gradedescriptions`
--
ALTER TABLE `gradedescriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gradeparticulars`
--
ALTER TABLE `gradeparticulars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `marksentries`
--
ALTER TABLE `marksentries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `myclasses`
--
ALTER TABLE `myclasses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `myclasssections`
--
ALTER TABLE `myclasssections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `myclasssubjects`
--
ALTER TABLE `myclasssubjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `myclassteachers`
--
ALTER TABLE `myclassteachers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notices`
--
ALTER TABLE `notices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pma__central_columns`
--
ALTER TABLE `pma__central_columns`
  ADD PRIMARY KEY (`db_name`,`col_name`);

--
-- Indexes for table `pma__column_info`
--
ALTER TABLE `pma__column_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `db_name` (`db_name`,`table_name`,`column_name`);

--
-- Indexes for table `pma__designer_settings`
--
ALTER TABLE `pma__designer_settings`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_user_type_template` (`username`,`export_type`,`template_name`);

--
-- Indexes for table `pma__favorite`
--
ALTER TABLE `pma__favorite`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__history`
--
ALTER TABLE `pma__history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`,`db`,`table`,`timevalue`);

--
-- Indexes for table `pma__navigationhiding`
--
ALTER TABLE `pma__navigationhiding`
  ADD PRIMARY KEY (`username`,`item_name`,`item_type`,`db_name`,`table_name`);

--
-- Indexes for table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  ADD PRIMARY KEY (`page_nr`),
  ADD KEY `db_name` (`db_name`);

--
-- Indexes for table `pma__recent`
--
ALTER TABLE `pma__recent`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__relation`
--
ALTER TABLE `pma__relation`
  ADD PRIMARY KEY (`master_db`,`master_table`,`master_field`),
  ADD KEY `foreign_field` (`foreign_db`,`foreign_table`);

--
-- Indexes for table `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_savedsearches_username_dbname` (`username`,`db_name`,`search_name`);

--
-- Indexes for table `pma__table_coords`
--
ALTER TABLE `pma__table_coords`
  ADD PRIMARY KEY (`db_name`,`table_name`,`pdf_page_number`);

--
-- Indexes for table `pma__table_info`
--
ALTER TABLE `pma__table_info`
  ADD PRIMARY KEY (`db_name`,`table_name`);

--
-- Indexes for table `pma__table_uiprefs`
--
ALTER TABLE `pma__table_uiprefs`
  ADD PRIMARY KEY (`username`,`db_name`,`table_name`);

--
-- Indexes for table `pma__tracking`
--
ALTER TABLE `pma__tracking`
  ADD PRIMARY KEY (`db_name`,`table_name`,`version`);

--
-- Indexes for table `pma__userconfig`
--
ALTER TABLE `pma__userconfig`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__usergroups`
--
ALTER TABLE `pma__usergroups`
  ADD PRIMARY KEY (`usergroup`,`tab`,`allowed`);

--
-- Indexes for table `pma__users`
--
ALTER TABLE `pma__users`
  ADD PRIMARY KEY (`username`,`usergroup`);

--
-- Indexes for table `promotionalrules`
--
ALTER TABLE `promotionalrules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questionpaperliabilities`
--
ALTER TABLE `questionpaperliabilities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schools`
--
ALTER TABLE `schools`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `studentcrs`
--
ALTER TABLE `studentcrs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `studentdbs`
--
ALTER TABLE `studentdbs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjectteachers`
--
ALTER TABLE `subjectteachers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
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
-- AUTO_INCREMENT for table `answerscriptdistributions`
--
ALTER TABLE `answerscriptdistributions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `examdetails`
--
ALTER TABLE `examdetails`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `exammodes`
--
ALTER TABLE `exammodes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `examtypes`
--
ALTER TABLE `examtypes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gradedescriptions`
--
ALTER TABLE `gradedescriptions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gradeparticulars`
--
ALTER TABLE `gradeparticulars`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `marksentries`
--
ALTER TABLE `marksentries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `myclasses`
--
ALTER TABLE `myclasses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `myclasssections`
--
ALTER TABLE `myclasssections`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `myclasssubjects`
--
ALTER TABLE `myclasssubjects`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `myclassteachers`
--
ALTER TABLE `myclassteachers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notices`
--
ALTER TABLE `notices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__column_info`
--
ALTER TABLE `pma__column_info`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__history`
--
ALTER TABLE `pma__history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  MODIFY `page_nr` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `promotionalrules`
--
ALTER TABLE `promotionalrules`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questionpaperliabilities`
--
ALTER TABLE `questionpaperliabilities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `schools`
--
ALTER TABLE `schools`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `studentcrs`
--
ALTER TABLE `studentcrs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `studentdbs`
--
ALTER TABLE `studentdbs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `subjectteachers`
--
ALTER TABLE `subjectteachers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
