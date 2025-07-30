-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 11, 2024 at 05:42 AM
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

--
-- Dumping data for table `myclassteachers`
--

INSERT INTO `myclassteachers` (`id`, `myclass_id`, `section_id`, `teacher_id`, `subject_id`, `details`, `remark`, `status`, `session_id`, `school_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 15, NULL, NULL, NULL, NULL, 1, 1, NULL, '2024-09-09 05:39:10'),
(9, 1, 2, 17, NULL, NULL, NULL, NULL, NULL, NULL, '2024-09-09 05:39:17', '2024-09-09 05:39:25');

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

--
-- Dumping data for table `studentcrs`
--

INSERT INTO `studentcrs` (`id`, `studentdb_id`, `session_id`, `myclass_id`, `section_id`, `roll_no`, `result`, `description`, `crstatus`, `next_clss_id`, `next_section_id`, `school_id`, `created_at`, `updated_at`) VALUES
(1, 127, 1, 1, 1, 14, NULL, NULL, 'Pending', NULL, NULL, NULL, '2024-09-06 21:47:20', '2024-09-06 21:47:20'),
(4, 128, 1, 1, 1, 40, NULL, NULL, 'Pending', NULL, NULL, NULL, '2024-09-10 14:46:05', '2024-09-10 14:46:05');

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
(127, '05329021000075', 0, 0, '2024-01-01', '0', '0', 'ABDUL HAMID', NULL, 'ASIF ALI', NULL, 'AKTARA BIBI', NULL, '2013-07-21', NULL, NULL, NULL, NULL, NULL, '8670586915', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '14', NULL, NULL),
(128, '05839421000014', 0, 0, '2024-01-01', '0', '0', 'AL AMEEN', NULL, 'SOHRUL ISLAM', NULL, 'SIRINA BIBI', NULL, '2013-05-17', NULL, NULL, NULL, NULL, NULL, '9933632239', '', NULL, NULL, NULL, 'INDIAN', '5021010000552', 'PUNB0RRBBGB', NULL, NULL, NULL, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '40', NULL, NULL),
(129, '05313119000003', 0, 0, '2024-01-01', '0', '0', 'ALIF SK', NULL, 'JIABUL HQ', NULL, 'SARVINA BIBI', NULL, '2013-07-21', NULL, NULL, NULL, NULL, NULL, '9933443211', '', NULL, NULL, NULL, 'INDIAN', '1532101700112051', 'PUNB0153210', NULL, NULL, NULL, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '22', NULL, NULL),
(130, '05839421000016', 0, 0, '2024-01-01', '0', '0', 'ALISA KHATUN', NULL, 'REJAUL HOQUE', NULL, 'MST SAMSAD BEGAM', NULL, '2014-01-12', NULL, NULL, NULL, NULL, NULL, '7602711416', '', NULL, NULL, NULL, 'INDIAN', '5021019900425', 'PUNB0RRBBGB', NULL, NULL, NULL, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '36', NULL, NULL),
(131, '05313121000051', 0, 0, '2024-01-01', '0', '0', 'ANASH AHAMMED', NULL, 'NOJRUL ISLAM', NULL, 'AYESA SULTANA', NULL, '2013-07-27', NULL, NULL, NULL, NULL, NULL, '9134573040', '', NULL, NULL, NULL, 'INDIAN', '1532101700144926', 'PUNB0042020', NULL, NULL, NULL, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '20', NULL, NULL),
(132, '05313119000016', 0, 0, '2024-01-01', '0', '0', 'ANIK HASAN', NULL, 'MASUD ALI', NULL, 'KHADIJA BIBI', NULL, '2013-12-04', NULL, NULL, NULL, NULL, NULL, '8145967430', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6', NULL, NULL),
(133, '05313119000007', 0, 0, '2024-01-01', '0', '0', 'ANISA KHATUN', NULL, 'FAITULLAH SK', NULL, 'PARULA BIBI', NULL, '2013-08-19', NULL, NULL, NULL, NULL, NULL, '8967129760', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL),
(134, '05839721000045', 0, 0, '2024-01-01', '0', '0', 'ARIYAN SK', NULL, 'HASAN ALI', NULL, 'SAYEMA KHATUN', NULL, '2014-06-30', NULL, NULL, NULL, NULL, NULL, '7585003729', '', NULL, NULL, NULL, 'INDIAN', '33321304535', 'SBIN0008006', NULL, NULL, NULL, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '17', NULL, NULL),
(135, '05313119000006', 0, 0, '2024-01-01', '0', '0', 'ARUFA KHATUN', NULL, 'SOHEL SK', NULL, 'FATEMA BIBI', NULL, '2013-11-18', NULL, NULL, NULL, NULL, NULL, '9614496337', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', NULL, NULL),
(136, '05313119000018', 0, 0, '2024-01-01', '0', '0', 'HASINA KHATUN', NULL, 'ASRAFUL SK', NULL, 'PAKHIJA BIBI', NULL, '2013-10-22', NULL, NULL, NULL, NULL, NULL, '7872831321', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '24', NULL, NULL),
(137, '05313119000010', 0, 0, '2024-01-01', '0', '0', 'KHADIJA KHATUN', NULL, 'SELIM REJA', NULL, 'AMINA BIBI', NULL, '2013-10-08', NULL, NULL, NULL, NULL, NULL, '9547775402', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '27', NULL, NULL),
(138, '05313119000012', 0, 0, '2024-01-01', '0', '0', 'MD IJAD SK', NULL, 'ROFIK SK', NULL, 'JANNATUN BIBI', NULL, '2013-10-12', NULL, NULL, NULL, NULL, NULL, '8972558261', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '30', NULL, NULL),
(139, '05313119000021', 0, 0, '2024-01-01', '0', '0', 'MD NASIM AKTAR RAJA', NULL, 'MD SAMIM RAJA', NULL, 'SIMA BIBI', NULL, '2013-01-12', NULL, NULL, NULL, NULL, NULL, '8972412125', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '31', NULL, NULL),
(140, '05313119000015', 0, 0, '2024-01-01', '0', '0', 'MD ROHAN ISLAM', NULL, 'SAFIKUL ISLAM', NULL, 'BILKISH BEGAM', NULL, '2013-07-08', NULL, NULL, NULL, NULL, NULL, '8537044730', '', NULL, NULL, NULL, 'INDIAN', '1532101700112024', 'PUNB0153210', NULL, NULL, NULL, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '16', NULL, NULL),
(141, '01475519000069', 0, 0, '2024-01-01', '0', '0', 'MD ROHAN KORIM', NULL, 'MD REJAUL KORIM', NULL, 'HASIDA BIBI', NULL, '2013-01-25', NULL, NULL, NULL, NULL, NULL, '8116741046', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '37', NULL, NULL),
(142, '05839721000043', 0, 0, '2024-01-01', '0', '0', 'MD SAMIR ALI', NULL, 'SUKBAR ALI', NULL, 'HASINA BIBI', NULL, '2013-08-19', NULL, NULL, NULL, NULL, NULL, '9733877532', '', NULL, NULL, NULL, 'INDIAN', '5021010016700', 'PUNB0RRBBGB', NULL, NULL, NULL, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '25', NULL, NULL),
(143, '05839421000011', 0, 0, '2024-01-01', '0', '0', 'MD TUHIN SK', NULL, 'FAIJUL SK', NULL, 'ANJURA BIBI', NULL, '2012-11-09', NULL, NULL, NULL, NULL, NULL, '9635244703', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '35', NULL, NULL),
(144, '05839721000039', 0, 0, '2024-01-01', '0', '0', 'MEHENAJ KHATUN', NULL, 'MERAJUL HOQUE', NULL, 'RAHIMA BIBI', NULL, '2013-09-10', NULL, NULL, NULL, NULL, NULL, '9836542856', '', NULL, NULL, NULL, 'INDIAN', '20424425741', 'SBIN0015048', NULL, NULL, NULL, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '23', NULL, NULL),
(145, '05313119000002', 0, 0, '2024-01-01', '0', '0', 'NICE KHATUN', NULL, 'TUTUL SK', NULL, 'DILRUBA BIBI', NULL, '2013-08-25', NULL, NULL, NULL, NULL, NULL, '7074297840', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '28', NULL, NULL),
(146, '05313119000023', 0, 0, '2024-01-01', '0', '0', 'NIRAN', NULL, 'NASIRUDDIN SEIKH', NULL, 'MAMATA KHATUN', NULL, '2013-08-17', NULL, NULL, NULL, NULL, NULL, '7699080140', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '21', NULL, NULL),
(147, '05329021000085', 0, 0, '2024-01-01', '0', '0', 'NUR ISLAM', NULL, 'TIARUL HOQUE', NULL, 'SHILA KHATUN', NULL, '2013-12-09', NULL, NULL, NULL, NULL, NULL, '6297877098', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '18', NULL, NULL),
(148, '05839721000042', 0, 0, '2024-01-01', '0', '0', 'RIJIA KHATUN', NULL, 'REJAUL HAQUE', NULL, 'HASIBA BIBI', NULL, '2013-12-24', NULL, NULL, NULL, NULL, NULL, '9647081719', '', NULL, NULL, NULL, 'INDIAN', '35380523460', 'SBIN0008006', NULL, NULL, NULL, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '11', NULL, NULL),
(149, '05839721000035', 0, 0, '2024-01-01', '0', '0', 'RIYA KHATUN', NULL, 'AINAL HOQUE', NULL, 'NARGISH KHATUN', NULL, '2013-08-15', NULL, NULL, NULL, NULL, NULL, '9679316678', '', NULL, NULL, NULL, 'INDIAN', '5021021428357', 'PUNB0RRBBGB', NULL, NULL, NULL, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '26', NULL, NULL),
(150, '05313119000019', 0, 0, '2024-01-01', '0', '0', 'RIYA KHATUN', NULL, 'JAHIRUDDIN SK', NULL, 'SHILPI BIBI', NULL, '2013-11-30', NULL, NULL, NULL, NULL, NULL, '8346852598', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '29', NULL, NULL),
(151, '05313119000022', 0, 0, '2024-01-01', '0', '0', 'ROKI SK', NULL, 'SAMSUL HOQUE', NULL, 'SIMA BIBI', NULL, '2013-12-18', NULL, NULL, NULL, NULL, NULL, '8158838201', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '15', NULL, NULL),
(152, '05839421000013', 0, 0, '2024-01-01', '0', '0', 'RUBINA KHATUN', NULL, 'RABIUL ISLAM', NULL, 'RAHIMA BIBI', NULL, '2012-09-29', NULL, NULL, NULL, NULL, NULL, '8670111544', '', NULL, NULL, NULL, 'INDIAN', '42244805096', 'SBIN0008006', NULL, NULL, NULL, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '34', NULL, NULL),
(153, '05839423000007', 0, 0, '2024-01-01', '0', '0', 'SABARIA KHATUN', NULL, 'KALIMUDDIN', NULL, 'SIKHA BIBI', NULL, '2013-11-24', NULL, NULL, NULL, NULL, NULL, '7709926922', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '32', NULL, NULL),
(154, '05329021000086', 0, 0, '2024-01-01', '0', '0', 'SAMIMA AKHTAR', NULL, 'TIYARUL', NULL, 'SABINA KHATUN', NULL, '2013-10-25', NULL, NULL, NULL, NULL, NULL, '7797322518', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '13', NULL, NULL),
(155, '05839421000010', 0, 0, '2024-01-01', '0', '0', 'SAMSUNNEHAR KHATUN', NULL, 'HIRON SK', NULL, 'LAVLI BIBI', NULL, '2013-04-01', NULL, NULL, NULL, NULL, NULL, '8584860321', '', NULL, NULL, NULL, 'INDIAN', '35963992885', 'SBIN0008855', NULL, NULL, NULL, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '39', NULL, NULL),
(156, '05313119000005', 0, 0, '2024-01-01', '0', '0', 'SOHANA KHATUN', NULL, 'SAMAUN HOQUE', NULL, 'JOSTNA BIBI', NULL, '2013-11-11', NULL, NULL, NULL, NULL, NULL, '8346957680', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8', NULL, NULL),
(157, '05313119000001', 0, 0, '2024-01-01', '0', '0', 'SORIAT ALI', NULL, 'JAHANGIR ALAM', NULL, 'SONAVAN BIBI', NULL, '2013-02-11', NULL, NULL, NULL, NULL, NULL, '8346852598', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5', NULL, NULL),
(158, '05313119000008', 0, 0, '2024-01-01', '0', '0', 'SUHANA KHATUN', NULL, 'NAJIBUR RAHAMAN', NULL, 'RAKIBA KHATUN BIBI', NULL, '2013-03-31', NULL, NULL, NULL, NULL, NULL, '8972606715', '', NULL, NULL, NULL, 'INDIAN', '42244859075', 'SBIN0008006', NULL, NULL, NULL, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '7', NULL, NULL),
(159, '05839421000015', 0, 0, '2024-01-01', '0', '0', 'TAJMIRA KHATUN', NULL, 'TAJRUL HOQUE', NULL, 'CHANTARA BIBI', NULL, '2013-11-23', NULL, NULL, NULL, NULL, NULL, '7908240176', '', NULL, NULL, NULL, 'INDIAN', '5021010036023', 'PUNB0RRBBGB', NULL, NULL, NULL, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '38', NULL, NULL),
(160, '05313119000020', 0, 0, '2024-01-01', '0', '0', 'TAMIM ALI', NULL, 'MD RAKESH ALI', NULL, 'ANJURA BIBI', NULL, '2013-06-29', NULL, NULL, NULL, NULL, NULL, '8637366214', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '9', NULL, NULL),
(161, '05313119000004', 0, 0, '2024-01-01', '0', '0', 'TANIYA KHATUN', NULL, 'JAHARUL ISLAM', NULL, 'SUKLEMA BIBI', NULL, '2013-07-20', NULL, NULL, NULL, NULL, NULL, '8972487687', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '10', NULL, NULL),
(162, '05329021000087', 0, 0, '2024-01-01', '0', '0', 'TOHID SK', NULL, 'SELIM REJA', NULL, 'HABIBA KHATUN', NULL, '2013-08-08', NULL, NULL, NULL, NULL, NULL, '7699024780', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '12', NULL, NULL),
(163, '05839421000012', 0, 0, '2024-01-01', '0', '0', 'TOUFIK ALI', NULL, 'ALLAM SK', NULL, 'REBINA BIBI', NULL, '2013-03-29', NULL, NULL, NULL, NULL, NULL, '8670264272', '', NULL, NULL, NULL, 'INDIAN', '20424424431', 'SBIN0015048', NULL, NULL, NULL, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '33', NULL, NULL),
(164, '05313119000017', 0, 0, '2024-01-01', '0', '0', 'TOUFIK HASAN', NULL, 'TAJRUL ISLAM', NULL, 'SABINA BIBI', NULL, '2013-07-09', NULL, NULL, NULL, NULL, NULL, '6297821669', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4', NULL, NULL),
(165, '05329021000082', 0, 0, '2024-01-01', '0', '0', 'UMME KULSUN', NULL, 'HAZIKUL ALAM', NULL, 'MAHARAM BIBI', NULL, '2013-09-23', NULL, NULL, NULL, NULL, NULL, '9002141921', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '19', NULL, NULL),
(166, '05313120000013', 0, 0, '2024-01-01', '0', '0', 'YAARIYAN ISLAM', NULL, 'ABDUL HALIM', NULL, 'JESMIN BIBI', NULL, '2013-10-29', NULL, NULL, NULL, NULL, NULL, '8967164209', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '3', NULL, NULL),
(167, '01475519000053', 0, 0, '2024-01-01', '0', '0', 'ABU HASSAN ALI', NULL, 'ARFAN ALI', NULL, 'SABINA BIBI', NULL, '2013-01-10', NULL, NULL, NULL, NULL, NULL, '7584087993', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '13', NULL, NULL),
(168, '01475519000042', 0, 0, '2024-01-01', '0', '0', 'AKASH SK', NULL, 'AKIBUR ALI', NULL, 'SULEKHA BIBI', NULL, '2013-02-13', NULL, NULL, NULL, NULL, NULL, '8101296714', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '27', NULL, NULL),
(169, '01475520000041', 0, 0, '2024-01-01', '0', '0', 'AMINA KHATUN', NULL, 'AKBAR ALI', NULL, 'SANTONA BIBI', NULL, '2013-08-17', NULL, NULL, NULL, NULL, NULL, '7064719137', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '10', NULL, NULL),
(170, '01475520000042', 0, 0, '2024-01-01', '0', '0', 'AYESHA KHATUN', NULL, 'AKBAR ALI', NULL, 'SANTONA BIBI', NULL, '2013-08-17', NULL, NULL, NULL, NULL, NULL, '7064719137', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '11', NULL, NULL),
(171, '01475519000049', 0, 0, '2024-01-01', '0', '0', 'BINA KHATUN', NULL, 'BABOR ALI', NULL, 'MADHU BIBI', NULL, '2013-05-01', NULL, NULL, NULL, NULL, NULL, '9091197124', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL),
(172, '05839721000041', 0, 0, '2024-01-01', '0', '0', 'FIZA YASMIN', NULL, 'MD SALEKEEN', NULL, 'RIMA BIBI', NULL, '2013-08-06', NULL, NULL, NULL, NULL, NULL, '7872968430', '', NULL, NULL, NULL, 'INDIAN', '5021021697559', 'PUNB0RRBBGB', NULL, NULL, NULL, 1, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', NULL, NULL),
(173, '01475519000044', 0, 0, '2024-01-01', '0', '0', 'HADISHA KHATUN', NULL, 'HABIBUR RAHAMAN', NULL, 'MIRA BIBI', NULL, '2013-10-13', NULL, NULL, NULL, NULL, NULL, '8670472729', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8', NULL, NULL),
(174, '05759119000000', 0, 0, '2024-01-01', '0', '0', 'JAMILA KHATUN', NULL, 'TIARUL ISLAM', NULL, 'MST.TUSUBA BIBI', NULL, '2013-11-29', NULL, NULL, NULL, NULL, NULL, '8346811779', '', NULL, NULL, NULL, 'INDIAN', '32232780012', 'SBIN0008006', NULL, NULL, NULL, 1, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '23', NULL, NULL),
(175, '05839421000009', 0, 0, '2024-01-01', '0', '0', 'KIYA MUDDIN', NULL, 'SAJIBAR RAHAMAN', NULL, 'SAGORA BIBI', NULL, '2013-10-05', NULL, NULL, NULL, NULL, NULL, '9732455994', '', NULL, NULL, NULL, 'INDIAN', '34826805642', 'SBIN0008855', NULL, NULL, NULL, 1, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '20', NULL, NULL),
(176, '04596420000094', 0, 0, '2024-01-01', '0', '0', 'MAHIDA KHATUN', NULL, 'RUHUL AMIN', NULL, 'AMINA BIBI', NULL, '2013-06-03', NULL, NULL, NULL, NULL, NULL, '8167795095', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '14', NULL, NULL),
(177, '01475521000064', 0, 0, '2024-01-01', '0', '0', 'MAHIMA KHATUN', NULL, 'MAIN SK', NULL, 'RUBINA BIBI', NULL, '2013-01-22', NULL, NULL, NULL, NULL, NULL, '9093936963', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '3', NULL, NULL),
(178, '01475519000072', 0, 0, '2024-01-01', '0', '0', 'MANSURA KHATUN', NULL, 'AZAD SK', NULL, 'SADENUR BIBI', NULL, '2013-10-12', NULL, NULL, NULL, NULL, NULL, '9647038122', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5', NULL, NULL),
(179, '05759119000004', 0, 0, '2024-01-01', '0', '0', 'MANSURA KHATUN', NULL, 'RINKU ALI', NULL, 'SAMIMA BIBI', NULL, '2013-09-25', NULL, NULL, NULL, NULL, NULL, '7699619667', '', NULL, NULL, NULL, 'INDIAN', '34400461986', 'SBIN0008006', NULL, NULL, NULL, 1, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '22', NULL, NULL),
(180, '01475519000076', 0, 0, '2024-01-01', '0', '0', 'MARFIN ANSAREE', NULL, 'ROCKET SK', NULL, 'NICE BIBI', NULL, '2013-10-03', NULL, NULL, NULL, NULL, NULL, '9734253780', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '15', NULL, NULL),
(181, '05313119000014', 0, 0, '2024-01-01', '0', '0', 'MASRUF HOSSAIN', NULL, 'MD ANOWAR HOSSAIN', NULL, 'POLY BIBI', NULL, '2013-03-03', NULL, NULL, NULL, NULL, NULL, '6297738606', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '7', NULL, NULL),
(182, '01475519000056', 0, 0, '2024-01-01', '0', '0', 'MD HAFIJUR RAHAMAN', NULL, 'MD IYASIN SK', NULL, 'MST ADARA BIBI', NULL, '2013-07-07', NULL, NULL, NULL, NULL, NULL, '8016974255', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '21', NULL, NULL),
(183, '01475519000073', 0, 0, '2024-01-01', '0', '0', 'MD NUR ALAM SK', NULL, 'MD LAYEB SK', NULL, 'NASHIMA BIBI', NULL, '2013-03-17', NULL, NULL, NULL, NULL, NULL, '7797342736', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '28', NULL, NULL),
(184, '01475519000066', 0, 0, '2024-01-01', '0', '0', 'MST RAFIJA SULTANA', NULL, 'RASEL ALI', NULL, 'JOTSNA BIBI', NULL, '2013-10-29', NULL, NULL, NULL, NULL, NULL, '9775544763', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6', NULL, NULL),
(185, '01475519000054', 0, 0, '2024-01-01', '0', '0', 'NAZMA PARVIN', NULL, 'MD NAZMUL ISLAM', NULL, 'ROSNARA BIBI', NULL, '2013-06-01', NULL, NULL, NULL, NULL, NULL, '9733829744', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '9', NULL, NULL),
(186, '01475521000065', 0, 0, '2024-01-01', '0', '0', 'RAINA AKTAR', NULL, 'MD AKBAR ALI', NULL, 'RUBIYA BIBI', NULL, '2013-10-29', NULL, NULL, NULL, NULL, NULL, '7063414985', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '30', NULL, NULL),
(187, '01475519000081', 0, 0, '2024-01-01', '0', '0', 'RAJIA SULTANA', NULL, 'ROFIK', NULL, 'RESHMI BIBI', NULL, '2013-11-23', NULL, NULL, NULL, NULL, NULL, '7602042721', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '12', NULL, NULL),
(188, '01475519000047', 0, 0, '2024-01-01', '0', '0', 'RUJINA KHATUN', NULL, 'SAHIN SK', NULL, 'SULEKHA BIBI', NULL, '2013-07-23', NULL, NULL, NULL, NULL, NULL, '7319118109', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '29', NULL, NULL),
(189, '01475519000046', 0, 0, '2024-01-01', '0', '0', 'RUMAN SK', NULL, 'ALIMUDDIN SEKH', NULL, 'RUKSANA KHATUN', NULL, '2013-08-01', NULL, NULL, NULL, NULL, NULL, '9635043391', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '17', NULL, NULL),
(190, '01475520000043', 0, 0, '2024-01-01', '0', '0', 'SABATAJ FARHANA', NULL, 'MD JAMALUDDIN', NULL, 'HABIBA AKTAR', NULL, '2013-10-05', NULL, NULL, NULL, NULL, NULL, '8927391514', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '18', NULL, NULL),
(191, '01475519000082', 0, 0, '2024-01-01', '0', '0', 'SAHANAJ KHATUN', NULL, 'MD SAJIKUL ISLAM', NULL, 'TUMPA KHATUN BIBI', NULL, '2013-10-13', NULL, NULL, NULL, NULL, NULL, '7364972595', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '16', NULL, NULL),
(192, '01475519000061', 0, 0, '2024-01-01', '0', '0', 'SAHINA KHATUN', NULL, 'ABUL KHAYER', NULL, 'MST SAHERA BIBI', NULL, '2013-07-02', NULL, NULL, NULL, NULL, NULL, '7074023980', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '25', NULL, NULL),
(193, '01475519000055', 0, 0, '2024-01-01', '0', '0', 'SOHANA KHATUN', NULL, 'SABIRUL ISLAM', NULL, 'MST REKSONA KHATUN', NULL, '2013-10-04', NULL, NULL, NULL, NULL, NULL, '8597698424', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '24', NULL, NULL),
(194, '01475519000048', 0, 0, '2024-01-01', '0', '0', 'SUBARNA ANSARI', NULL, 'SABIR ANSARI', NULL, 'HABIBA BIBI', NULL, '2013-07-24', NULL, NULL, NULL, NULL, NULL, '7384559309', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4', NULL, NULL),
(195, '08895119000010', 0, 0, '2024-01-01', '0', '0', 'SUJAN MONDAL', NULL, 'SANJIT MONDAL', NULL, 'BABITA MONDAL', NULL, '2013-02-12', NULL, NULL, NULL, NULL, NULL, '9832439543', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '19', NULL, NULL),
(196, '05759119000002', 0, 0, '2024-01-01', '0', '0', 'TANISHA YEASMIN', NULL, 'ABU RUHUL AMIN', NULL, 'SIMA BIBI', NULL, '2013-01-26', NULL, NULL, NULL, NULL, NULL, '9564733173', '', NULL, NULL, NULL, 'INDIAN', '5021020000975', 'PUNB0RRBBGB', NULL, NULL, NULL, 1, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '26', NULL, NULL),
(223, '05839621000008', 0, 0, '2024-01-01', '0', '0', 'ALISA YASMIN', NULL, 'KUDDUS ALI', NULL, 'PAPIYA BIBI', NULL, '2013-12-09', NULL, NULL, NULL, NULL, NULL, '6370282984', '', NULL, NULL, NULL, 'INDIAN', '20461512244', 'SBIN0008006', NULL, NULL, NULL, 1, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '21', NULL, NULL),
(224, '01475519000052', 0, 0, '2024-01-01', '0', '0', 'ALSAD HASAN', NULL, 'MD SAJJAD ALI', NULL, 'MUKTARA KHATUN', NULL, '2013-08-22', NULL, NULL, NULL, NULL, NULL, '9732546578', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '27', NULL, NULL),
(225, '01475519000045', 0, 0, '2024-01-01', '0', '0', 'ANISHA KHATUN', NULL, 'ARIF SK', NULL, 'REXSONA BIBI', NULL, '2013-09-07', NULL, NULL, NULL, NULL, NULL, '9699717974', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '22', NULL, NULL),
(226, '08895119000016', 0, 0, '2024-01-01', '0', '0', 'ANSU SARKAR', NULL, 'MONOJIT SARKAR', NULL, 'SUMITRA SARKAR', NULL, '2013-11-03', NULL, NULL, NULL, NULL, NULL, '9933624543', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '7', NULL, NULL),
(227, '05312819000403', 0, 0, '2024-01-01', '0', '0', 'ARIYAN ALI', NULL, 'RIPAN SK', NULL, 'AKTARUNNESHA BIBI', NULL, '2013-05-14', NULL, NULL, NULL, NULL, NULL, '7699479863', '', NULL, NULL, NULL, 'INDIAN', '1314010189422', '', NULL, NULL, NULL, 1, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '26', NULL, NULL),
(228, '05312819000413', 0, 0, '2024-01-01', '0', '0', 'ARIYAN SK', NULL, 'FAJLUR RAHAMAN', NULL, 'ANUWARA BIBI', NULL, '2013-09-26', NULL, NULL, NULL, NULL, NULL, '8538815827', '', NULL, NULL, NULL, 'INDIAN', '35369003447', 'SBIN0008006', NULL, NULL, NULL, 1, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '18', NULL, NULL),
(229, '08895119000000', 0, 0, '2024-01-01', '0', '0', 'AYAN MONDAL', NULL, 'PRAKASH CH. MONDAL', NULL, 'JAMUNA MONDAL', NULL, '2013-11-17', NULL, NULL, NULL, NULL, NULL, '9679819671', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6', NULL, NULL),
(230, '01475519000057', 0, 0, '2024-01-01', '0', '0', 'CHANDRUL ISLAM', NULL, 'IMRAN ALI', NULL, 'MST RUKSENA KHATUN', NULL, '2013-08-08', NULL, NULL, NULL, NULL, NULL, '8001081869', '', NULL, NULL, NULL, 'INDIAN', '5021010048976', 'PUNB0RRBBGB', NULL, NULL, NULL, 1, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL),
(231, '01475519000077', 0, 0, '2024-01-01', '0', '0', 'GOLAB ROSUL MONDAL', NULL, 'MD RAFIKUL ISLAM', NULL, 'SOHAGI BIBI', NULL, '2013-10-09', NULL, NULL, NULL, NULL, NULL, '8972041071', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '23', NULL, NULL),
(232, '05839821000006', 0, 0, '2024-01-01', '0', '0', 'IFTIKAR AHMED', NULL, 'TAIJUL ALI', NULL, 'ROKIA BIBI', NULL, '2013-10-10', NULL, NULL, NULL, NULL, NULL, '9734968714', '', NULL, NULL, NULL, 'INDIAN', '35924775050', 'SBIN0008006', NULL, NULL, NULL, 1, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5', NULL, NULL),
(233, '05839821000003', 0, 0, '2024-01-01', '0', '0', 'IMTIAJ HOSSAIN', NULL, 'FIROJ HOSSAIN', NULL, 'ALIMUNNESA BIBI', NULL, '2013-03-07', NULL, NULL, NULL, NULL, NULL, '6296408441', '', NULL, NULL, NULL, 'INDIAN', '5021010003532', 'PUNB0RRBBGB', NULL, NULL, NULL, 1, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '14', NULL, NULL),
(234, '05313219000024', 0, 0, '2024-01-01', '0', '0', 'INJAMUL HOQUE', NULL, 'SABIRUL ISLAM', NULL, 'AMBIA BIBI', NULL, '2013-05-25', NULL, NULL, NULL, NULL, NULL, '7029866034', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '29', NULL, NULL),
(235, '05313219000011', 0, 0, '2024-01-01', '0', '0', 'MAHID SK', NULL, 'MALEK SK', NULL, 'HABIBA BIBI', NULL, '2013-02-17', NULL, NULL, NULL, NULL, NULL, '8942006602', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '10', NULL, NULL),
(236, '05839821000002', 0, 0, '2024-01-01', '0', '0', 'MD ATIK', NULL, 'SAKIR SK', NULL, 'RAKIBA BIBI', NULL, '2013-08-22', NULL, NULL, NULL, NULL, NULL, '7063500784', '', NULL, NULL, NULL, 'INDIAN', '5021010028486', 'PUNB0RRBBGB', NULL, NULL, NULL, 1, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4', NULL, NULL),
(237, '05313219000016', 0, 0, '2024-01-01', '0', '0', 'MD SAHABUR ISLAM', NULL, 'RAFIKUL ISLAM', NULL, 'MAMOTA BIBI', NULL, '2013-08-01', NULL, NULL, NULL, NULL, NULL, '8016534017', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '12', NULL, NULL),
(238, '05313219000006', 0, 0, '2024-01-01', '0', '0', 'MEHEDI HASAN', NULL, 'MEKAIL HAQUE', NULL, 'RINA KHATUN BIBI', NULL, '2013-12-03', NULL, NULL, NULL, NULL, NULL, '8582999626', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '19', NULL, NULL),
(239, '05313219000009', 0, 0, '2024-01-01', '0', '0', 'MST HAJERA KHATUN', NULL, 'ASRAF SK', NULL, 'CHANDSURA BIBI', NULL, '2013-04-20', NULL, NULL, NULL, NULL, NULL, '9932141003', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '15', NULL, NULL),
(240, '05313219000000', 0, 0, '2024-01-01', '0', '0', 'MST JESMIN KHATUN', NULL, 'MD KHAIRUL SK', NULL, 'TOSLEMA BIBI', NULL, '2013-08-14', NULL, NULL, NULL, NULL, NULL, '8820646096', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '11', NULL, NULL),
(241, '05313219000008', 0, 0, '2024-01-01', '0', '0', 'MST LIPI KHATUN', NULL, 'SAFIKUL ISLAM', NULL, 'KAKOLI BIBI', NULL, '2013-05-07', NULL, NULL, NULL, NULL, NULL, '8116341447', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '9', NULL, NULL),
(242, '05313219000031', 0, 0, '2024-01-01', '0', '0', 'MST TASRINA KHATUN', NULL, 'TAJIBUR RAHMAN', NULL, 'SAJINOOR BIBI', NULL, '2013-06-19', NULL, NULL, NULL, NULL, NULL, '9749899225', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '20', NULL, NULL),
(243, '05313220000028', 0, 0, '2024-01-01', '0', '0', 'SABNAM KHATUN', NULL, 'SELIM REJA', NULL, 'RUMA BIBI', NULL, '2013-11-17', NULL, NULL, NULL, NULL, NULL, '9933739485', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '16', NULL, NULL),
(244, '05313219000002', 0, 0, '2024-01-01', '0', '0', 'SAGIR SK', NULL, 'RAHIM SK', NULL, 'KAMELA BIBI', NULL, '2013-05-24', NULL, NULL, NULL, NULL, NULL, '9091588428', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '28', NULL, NULL),
(245, '05313219000026', 0, 0, '2024-01-01', '0', '0', 'SALMA KHATUN', NULL, 'AYUB SK', NULL, 'REKSONA BIBI', NULL, '2013-05-18', NULL, NULL, NULL, NULL, NULL, '8918518468', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '17', NULL, NULL),
(246, '05312819000420', 0, 0, '2024-01-01', '0', '0', 'SHUKTARA KHATUN', NULL, 'TASRUL HQ', NULL, 'SIRINA BIBI', NULL, '2013-09-01', NULL, NULL, NULL, NULL, NULL, '7699919118', '', NULL, NULL, NULL, 'INDIAN', '1314010194914', '', NULL, NULL, NULL, 1, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '25', NULL, NULL),
(247, '05313219000027', 0, 0, '2024-01-01', '0', '0', 'SONALI KHATUN', NULL, 'SAHEB SK', NULL, 'SUMERA BIBI', NULL, '2013-05-04', NULL, NULL, NULL, NULL, NULL, '7047160627', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '13', NULL, NULL),
(248, '05839621000012', 0, 0, '2024-01-01', '0', '0', 'SUBARNA KHATUN', NULL, 'SAIBUR RAHAMAN', NULL, 'LAILI BIBI', NULL, '2013-12-16', NULL, NULL, NULL, NULL, NULL, '9775334768', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '30', NULL, NULL),
(249, '05312819000408', 0, 0, '2024-01-01', '0', '0', 'SUSMITA GHOSH', NULL, 'MANIK GHOSH', NULL, 'JUTHIKA GHOSH', NULL, '2013-04-13', NULL, NULL, NULL, NULL, NULL, '9093407346', '', NULL, NULL, NULL, 'INDIAN', '5021010047375', 'PUNB0RRBBGB', NULL, NULL, NULL, 1, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '24', NULL, NULL),
(250, '01475519000060', 0, 0, '2024-01-01', '0', '0', 'TANIA KHATUN', NULL, 'NAJIBUR SK', NULL, 'PARULA KHATUN BIBI', NULL, '2013-12-31', NULL, NULL, NULL, NULL, NULL, '8609081034', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', NULL, NULL),
(251, '08895119000009', 0, 0, '2024-01-01', '0', '0', 'TANMAI MANDAL', NULL, 'TARUN KUMAR MANDAL', NULL, 'DIPALI MANDAL', NULL, '2013-04-08', NULL, NULL, NULL, NULL, NULL, '8116439414', '', NULL, NULL, NULL, 'INDIAN', '34827981650', 'SBIN0008006', NULL, NULL, NULL, 1, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8', NULL, NULL),
(252, '05313119000011', 0, 0, '2024-01-01', '0', '0', 'UMME SALMA', NULL, 'ISMAIL', NULL, 'JOSNA BIBI', NULL, '2013-11-17', NULL, NULL, NULL, NULL, NULL, '8514942064', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '3', NULL, NULL),
(253, '05313219000013', 0, 0, '2024-01-01', '0', '0', 'AFRIN PARVIN', NULL, 'JALI ALAM BADSHA', NULL, 'SABINA BIBI', NULL, '2013-01-20', NULL, NULL, NULL, NULL, NULL, '9933006054', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 4, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5', NULL, NULL),
(254, '05312819000416', 0, 0, '2024-01-01', '0', '0', 'AKTARUNNESHA', NULL, 'ALAM HOSSAIN', NULL, 'MARIYAM BIBI', NULL, '2013-02-06', NULL, NULL, NULL, NULL, NULL, '8372903206', '', NULL, NULL, NULL, 'INDIAN', '5520126550', 'CBIN0280122', NULL, NULL, NULL, 1, 4, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '10', NULL, NULL),
(255, '08895119000006', 0, 0, '2024-01-01', '0', '0', 'APU SINGHA', NULL, 'PROKASH SINGHA', NULL, 'GOJALI SINGHA', NULL, '2013-09-11', NULL, NULL, NULL, NULL, NULL, '9679819671', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 4, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '22', NULL, NULL),
(256, '01475519000041', 0, 0, '2024-01-01', '0', '0', 'ASMAYSUHANA', NULL, 'MD AJAHARUDDIN', NULL, 'BILKISH BIBI', NULL, '2013-10-13', NULL, NULL, NULL, NULL, NULL, '9564261405', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 4, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '12', NULL, NULL),
(257, '01475519000067', 0, 0, '2024-01-01', '0', '0', 'EYAMIN HOSSAIN', NULL, 'GONI MAHAMAD HOSSAIN', NULL, 'RAHALA BIBI', NULL, '2013-04-18', NULL, NULL, NULL, NULL, NULL, '6295334154', '', NULL, NULL, NULL, 'INDIAN', '32734078001', 'SBIN0008006', NULL, NULL, NULL, 1, 4, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '19', NULL, NULL),
(258, '01475619000005', 0, 0, '2024-01-01', '0', '0', 'GOLAM SARUAR', NULL, 'ROBIUL ISLAM', NULL, 'SARMINA BIBI', NULL, '2013-06-07', NULL, NULL, NULL, NULL, NULL, '7908778054', '', NULL, NULL, NULL, 'INDIAN', '35977427679', 'SBIN0008006', NULL, NULL, NULL, 1, 4, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '25', NULL, NULL),
(259, '01475619000006', 0, 0, '2024-01-01', '0', '0', 'HURMILA KHATUN', NULL, 'REJAUL KARIM', NULL, 'MARJINA BIBI', NULL, '2013-05-04', NULL, NULL, NULL, NULL, NULL, '9014138846', '', NULL, NULL, NULL, 'INDIAN', '35928951919', 'SBIN0008006', NULL, NULL, NULL, 1, 4, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '26', NULL, NULL),
(260, '05839621000009', 0, 0, '2024-01-01', '0', '0', 'IBRAHIM KHALIULLA', NULL, 'RABIUL ISLAM', NULL, 'SANWARA BIBI', NULL, '2013-05-29', NULL, NULL, NULL, NULL, NULL, '7074215362', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 4, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '17', NULL, NULL),
(261, '05312819000422', 0, 0, '2024-01-01', '0', '0', 'KAINAT YESMIN', NULL, 'ABDUR RAHIM', NULL, 'AMBIA BIBI', NULL, '2013-08-29', NULL, NULL, NULL, NULL, NULL, '7029846487', '', NULL, NULL, NULL, 'INDIAN', '5021010021915', '', NULL, NULL, NULL, 1, 4, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '28', NULL, NULL),
(262, '05312819000414', 0, 0, '2024-01-01', '0', '0', 'MAHABUBA KHATUN', NULL, 'JABIRUL ISLAM', NULL, 'MEHERUN KHATUN', NULL, '2013-09-10', NULL, NULL, NULL, NULL, NULL, '8250040135', '', NULL, NULL, NULL, 'INDIAN', '30920415586', 'SBIN0008006', NULL, NULL, NULL, 1, 4, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '9', NULL, NULL),
(263, '01475619000001', 0, 0, '2024-01-01', '0', '0', 'MARIYAM KHATUN', NULL, 'RUHUL AMIN', NULL, 'SARIFA BIBI', NULL, '2013-11-16', NULL, NULL, NULL, NULL, NULL, '9382286754', '', NULL, NULL, NULL, 'INDIAN', '5021010020280999', 'PUNB0070020', NULL, NULL, NULL, 1, 4, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '27', NULL, NULL),
(264, '05313219000010', 0, 0, '2024-01-01', '0', '0', 'MD ALIF', NULL, 'MIJANUR RAHAMAN', NULL, 'SARJINA BIBI', NULL, '2013-06-04', NULL, NULL, NULL, NULL, NULL, '8116509449', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 4, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8', NULL, NULL),
(265, '05313219000005', 0, 0, '2024-01-01', '0', '0', 'MD JUBAIL HOSSAIN', NULL, 'ABDUL ALIM', NULL, 'HIRA BIBI', NULL, '2013-05-25', NULL, NULL, NULL, NULL, NULL, '7478532002', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 4, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', NULL, NULL),
(266, '05313219000030', 0, 0, '2024-01-01', '0', '0', 'MST AMBIYA KHATUN', NULL, 'ABUL KALAM', NULL, 'MST MORJINA BIBI', NULL, '2013-08-31', NULL, NULL, NULL, NULL, NULL, '9093348529', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 4, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '30', NULL, NULL),
(267, '05839821000009', 0, 0, '2024-01-01', '0', '0', 'MURAD HOSSAIN', NULL, 'BAIJUR RAHAMAN', NULL, 'MOUSUMI BIBI', NULL, '2013-08-05', NULL, NULL, NULL, NULL, NULL, '8927105009', '', NULL, NULL, NULL, 'INDIAN', '34043294088', 'SBIN0015275', NULL, NULL, NULL, 1, 4, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '13', NULL, NULL),
(268, '05313219000014', 0, 0, '2024-01-01', '0', '0', 'NAJMA PARVIN', NULL, 'KAMAL HOSSAIN', NULL, 'SAMSAD BEGAM', NULL, '2013-12-08', NULL, NULL, NULL, NULL, NULL, '7363998622', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 4, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4', NULL, NULL),
(269, '05312819000415', 0, 0, '2024-01-01', '0', '0', 'NAJMIN AKTAR', NULL, 'NURUJJAMAN', NULL, 'DEJINA BIBI', NULL, '2013-12-23', NULL, NULL, NULL, NULL, NULL, '9635232908', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 4, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '29', NULL, NULL),
(270, '01475519000059', 0, 0, '2024-01-01', '0', '0', 'REHAN ANSARI', NULL, 'FIROJ HOSSAIN', NULL, 'RIMA BIBI', NULL, '2013-01-06', NULL, NULL, NULL, NULL, NULL, '6289121735', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 4, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '15', NULL, NULL),
(271, '05312819000421', 0, 0, '2024-01-01', '0', '0', 'RUMI KHATUN', NULL, 'ISMAIL HOQUE', NULL, 'SELINA BIBI', NULL, '2013-02-02', NULL, NULL, NULL, NULL, NULL, '8513934368', '', NULL, NULL, NULL, 'INDIAN', '35990124213', 'SBIN0008006', NULL, NULL, NULL, 1, 4, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '24', NULL, NULL),
(272, '05312819000411', 0, 0, '2024-01-01', '0', '0', 'SABINA YEASMIN', NULL, 'FORID SK', NULL, 'KHADIJA BIBI', NULL, '2013-09-24', NULL, NULL, NULL, NULL, NULL, '9735256536', '', NULL, NULL, NULL, 'INDIAN', '3652501855', 'CBIN0280122', NULL, NULL, NULL, 1, 4, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '11', NULL, NULL),
(273, '05839821000014', 0, 0, '2024-01-01', '0', '0', 'SABINUR KHATUN', NULL, 'SABIRUL SK', NULL, 'SAHANAJ BIBI', NULL, '2012-07-03', NULL, NULL, NULL, NULL, NULL, '9932180517', '', NULL, NULL, NULL, 'INDIAN', '0583982100001', 'PUNB0RRBBGB', NULL, NULL, NULL, 1, 4, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '16', NULL, NULL),
(274, '05839821000008', 0, 0, '2024-01-01', '0', '0', 'SAFIKUL ISLAM', NULL, 'MASADUL HOSSAIN', NULL, 'SAFINA BIBI', NULL, '2013-04-09', NULL, NULL, NULL, NULL, NULL, '8145358135', '', NULL, NULL, NULL, 'INDIAN', '34753455438', 'SBIN0008006', NULL, NULL, NULL, 1, 4, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '14', NULL, NULL),
(275, '05839821000001', 0, 0, '2024-01-01', '0', '0', 'SAKIL', NULL, 'BAKUL SK', NULL, 'SIMA KHATUN', NULL, '2013-08-26', NULL, NULL, NULL, NULL, NULL, '8597715510', '', NULL, NULL, NULL, 'INDIAN', '35277941668', 'SBIN0008006', NULL, NULL, NULL, 1, 4, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6', NULL, NULL),
(276, '01475519000062', 0, 0, '2024-01-01', '0', '0', 'SAMIMA KHATUN', NULL, 'MD ABU SAIN', NULL, 'NASIMA BIBI', NULL, '2013-02-20', NULL, NULL, NULL, NULL, NULL, '8116882013', '', NULL, NULL, NULL, 'INDIAN', '1532101700113458', 'PUNB0153210', NULL, NULL, NULL, 1, 4, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '20', NULL, NULL),
(277, '05839621000007', 0, 0, '2024-01-01', '0', '0', 'SAMIRUL SEKH', NULL, 'GOLAM MUSTAFA', NULL, 'GOLAPI BIBI', NULL, '2013-11-18', NULL, NULL, NULL, NULL, NULL, '9635443412', '', NULL, NULL, NULL, 'INDIAN', '33959590186', 'SBIN0008006', NULL, NULL, NULL, 1, 4, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '18', NULL, NULL),
(278, '05313219000007', 0, 0, '2024-01-01', '0', '0', 'SELINA KHATUN', NULL, 'SELIM SK', NULL, 'AYESHA BIBI', NULL, '2013-06-25', NULL, NULL, NULL, NULL, NULL, '9609235157', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 4, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '7', NULL, NULL),
(279, '05312720000013', 0, 0, '2024-01-01', '0', '0', 'SURAIYA REZA', NULL, 'SELIM REZA', NULL, 'RUNIARA BIBI', NULL, '2013-05-14', NULL, NULL, NULL, NULL, NULL, '8670932286', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 4, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '21', NULL, NULL),
(280, '08895119000001', 0, 0, '2024-01-01', '0', '0', 'SURJO MANDAL', NULL, 'RATAN MANDAL', NULL, 'DIPIKA BHASKAR MANDAL', NULL, '2013-06-29', NULL, NULL, NULL, NULL, NULL, '9679819671', '', NULL, NULL, NULL, 'INDIAN', '5021010048903', 'PUNB0RRBBGB', NULL, NULL, NULL, 1, 4, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '23', NULL, NULL),
(281, '05759119000001', 0, 0, '2024-01-01', '0', '0', 'SWEET SK', NULL, 'TOFIK ALI', NULL, 'RUHINA BIBI', NULL, '2013-01-04', NULL, NULL, NULL, NULL, NULL, '8944909431', '', NULL, NULL, NULL, 'INDIAN', '5575010037402', 'PUNB0RRBBGB', NULL, NULL, NULL, 1, 4, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL),
(282, '05839622000071', 0, 0, '2024-01-01', '0', '0', 'TINA KHATUN', NULL, 'MUSREF SK', NULL, 'CHANUARA BIBI', NULL, '2013-07-07', NULL, NULL, NULL, NULL, NULL, '8167012302', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 4, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '3', NULL, NULL),
(283, '05313719000007', 0, 0, '2024-01-01', '0', '0', 'AMINUL ISLAM', NULL, 'ASHADUL HAQUE', NULL, 'AYESHA BIBI', NULL, '2013-02-19', NULL, NULL, NULL, NULL, NULL, '7699080200', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 5, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '9', NULL, NULL),
(284, '08895119000004', 0, 0, '2024-01-01', '0', '0', 'ANUVA MANDAL', NULL, 'SANJAY MANDAL', NULL, 'MILAN MANDAL', NULL, '2013-09-08', NULL, NULL, NULL, NULL, NULL, '9679819671', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 5, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '25', NULL, NULL),
(285, '01719319002417', 0, 0, '2024-01-01', '0', '0', 'ARIYAN SK', NULL, 'MIJARUL HOQUE', NULL, 'RAJIFA KHATUN', NULL, '2013-07-23', NULL, NULL, NULL, NULL, NULL, '8945566482', '', NULL, NULL, NULL, 'INDIAN', '43015834464', 'SBIN0008006', NULL, NULL, NULL, 1, 5, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '23', NULL, NULL),
(286, '05759119000007', 0, 0, '2024-01-01', '0', '0', 'ASHIRUDDIN SK', NULL, 'MIJARUL ISLAM', NULL, 'ROHIMA BIBI', NULL, '2013-07-18', NULL, NULL, NULL, NULL, NULL, '7319118062', '', NULL, NULL, NULL, 'INDIAN', '5021021582887', 'PUNB0RRBBGB', NULL, NULL, NULL, 1, 5, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '29', NULL, NULL),
(287, '05839621000001', 0, 0, '2024-01-01', '0', '0', 'ASKAR ALI', NULL, 'SARIF JAMAL', NULL, 'TUTULA BIBI', NULL, '2014-02-22', NULL, NULL, NULL, NULL, NULL, '7029492270', '', NULL, NULL, NULL, 'INDIAN', '33806953001', 'SBIN0008006', NULL, NULL, NULL, 1, 5, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4', NULL, NULL),
(288, '01475619000013', 0, 0, '2024-01-01', '0', '0', 'EMTIHAN ALI', NULL, 'YEAN ALI', NULL, 'USATON BIBI', NULL, '2013-03-18', NULL, NULL, NULL, NULL, NULL, '8536072070', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 5, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '24', NULL, NULL),
(289, '01475619000017', 0, 0, '2024-01-01', '0', '0', 'HALIMA KHATUN', NULL, 'ALAMGIR HOSSAIN', NULL, 'RAHIMA BIBI', NULL, '2013-09-05', NULL, NULL, NULL, NULL, NULL, '9091975811', '', NULL, NULL, NULL, 'INDIAN', '5021010024505', 'PUNB0RRBBGB', NULL, NULL, NULL, 1, 5, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '18', NULL, NULL),
(290, '05759119000003', 0, 0, '2024-01-01', '0', '0', 'IBRAHIM SK', NULL, 'SALIM SK', NULL, 'RASHIDA BIBI', NULL, '2013-07-16', NULL, NULL, NULL, NULL, NULL, '7074602746', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 5, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '19', NULL, NULL),
(291, '05839621000004', 0, 0, '2024-01-01', '0', '0', 'JAHID SHAIKH', NULL, 'JAHANGIR ALAM', NULL, 'MARIYAM BIBI', NULL, '2013-05-22', NULL, NULL, NULL, NULL, NULL, '9163169862', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 5, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '11', NULL, NULL),
(292, '05839721000047', 0, 0, '2024-01-01', '0', '0', 'KHADIJA KHATUN', NULL, 'MD JOHAR ALI', NULL, 'ROSNA BIBI', NULL, '2013-05-14', NULL, NULL, NULL, NULL, NULL, '9002644501', '', NULL, NULL, NULL, 'INDIAN', '36421388805', 'SBIN0009463', NULL, NULL, NULL, 1, 5, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '13', NULL, NULL),
(293, '05839621000002', 0, 0, '2024-01-01', '0', '0', 'KISMAT SK', NULL, 'TINKU SK', NULL, 'RAFINA BIBI', NULL, '2014-02-15', NULL, NULL, NULL, NULL, NULL, '8945518767', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 5, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', NULL, NULL),
(294, '08895119000008', 0, 0, '2024-01-01', '0', '0', 'LAXMI MONDAL', NULL, 'RAJU MONDAL', NULL, 'RADHARANI MONDAL', NULL, '2013-11-14', NULL, NULL, NULL, NULL, NULL, '9144193447', '', NULL, NULL, NULL, 'INDIAN', '5021010048754', 'PUNB0RRBBGB', NULL, NULL, NULL, 1, 5, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '7', NULL, NULL),
(295, '05313720000009', 0, 0, '2024-01-01', '0', '0', 'MD ABU SUFIYAN SK', NULL, 'AWLAD HOSSAIN', NULL, 'SAKILA BIBI', NULL, '2013-10-11', NULL, NULL, NULL, NULL, NULL, '6295239823', '', NULL, NULL, NULL, 'INDIAN', '5575010040424', 'PUNB0RRBBGB', NULL, NULL, NULL, 1, 5, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '16', NULL, NULL),
(296, '05839621000010', 0, 0, '2024-01-01', '0', '0', 'MD HANIF SK', NULL, 'ASHIRUDDIN SK', NULL, 'TUHINA BIBI', NULL, '2014-01-30', NULL, NULL, NULL, NULL, NULL, '9735308401', '', NULL, NULL, NULL, 'INDIAN', '33384264111', 'SBIN0008006', NULL, NULL, NULL, 1, 5, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '17', NULL, NULL),
(297, '01475619000014', 0, 0, '2024-01-01', '0', '0', 'MD HASMOT ALI', NULL, 'MD KUDDUS ALI', NULL, 'NASHIBA BIBI', NULL, '2013-10-13', NULL, NULL, NULL, NULL, NULL, '7470136721', '', NULL, NULL, NULL, 'INDIAN', '5021019900120', 'PUNB0RRBBGB', NULL, NULL, NULL, 1, 5, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '30', NULL, NULL),
(298, '05839621000005', 0, 0, '2024-01-01', '0', '0', 'MD RIJUWAN', NULL, 'MD ABDUR RAJJAK', NULL, 'RUMI BIBI', NULL, '2013-06-16', NULL, NULL, NULL, NULL, NULL, '7890624492', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 5, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '27', NULL, NULL),
(299, '05313219000028', 0, 0, '2024-01-01', '0', '0', 'MD TANBIR HOSAN', NULL, 'MD ABDUR ROKIB', NULL, 'MST TUHINA BIBI', NULL, '2013-12-28', NULL, NULL, NULL, NULL, NULL, '8116529850', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 5, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '26', NULL, NULL),
(300, '05313219000035', 0, 0, '2024-01-01', '0', '0', 'MST KHADIJA KHATUN', NULL, 'HAZIKUL ISLAM', NULL, 'RUBINA BIBI', NULL, '2013-08-13', NULL, NULL, NULL, NULL, NULL, '9635121360', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 5, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '28', NULL, NULL),
(301, '01475619000027', 0, 0, '2024-01-01', '0', '0', 'OMAR FARUK', NULL, 'JAHANGIR ALOM', NULL, 'SIMA BIBI', NULL, '2013-12-24', NULL, NULL, NULL, NULL, NULL, '6289272311', '', NULL, NULL, NULL, 'INDIAN', '5021010026141', 'PUNB0RRBBGB', NULL, NULL, NULL, 1, 5, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '22', NULL, NULL),
(302, '01475619000011', 0, 0, '2024-01-01', '0', '0', 'RAJ SK', NULL, 'HOSEN ALI', NULL, 'SUKTARA BIBI', NULL, '2013-09-30', NULL, NULL, NULL, NULL, NULL, '7365997846', '', NULL, NULL, NULL, 'INDIAN', '5021010020280321', 'PUNB0070020', NULL, NULL, NULL, 1, 5, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '10', NULL, NULL),
(303, '04895821000018', 0, 0, '2024-01-01', '0', '0', 'RAMIZ RAZA', NULL, 'MAHAFUZ ALAM', NULL, 'REKSONA KHATUN', NULL, '2014-03-05', NULL, NULL, NULL, NULL, NULL, '7477426138', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 5, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8', NULL, NULL),
(304, '01475619000003', 0, 0, '2024-01-01', '0', '0', 'ROHID SAIKH', NULL, 'MD MUKUL SAIKH', NULL, 'RASIDA BIBI', NULL, '2013-04-22', NULL, NULL, NULL, NULL, NULL, '8536026712', '', NULL, NULL, NULL, 'INDIAN', '0977010106488', 'PUNB0097720', NULL, NULL, NULL, 1, 5, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '21', NULL, NULL),
(305, '05839621000013', 0, 0, '2024-01-01', '0', '0', 'SAYEMA KHATUN', NULL, 'NEKBOR ALI', NULL, 'SUNDORI BIBI', NULL, '2013-05-25', NULL, NULL, NULL, NULL, NULL, '8116279128', '', NULL, NULL, NULL, 'INDIAN', '32670742996', 'SBIN0008006', NULL, NULL, NULL, 1, 5, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6', NULL, NULL),
(306, '01475619000012', 0, 0, '2024-01-01', '0', '0', 'SHAKIL SK', NULL, 'SEKHBAR SK', NULL, 'SARMINA KHATUN', NULL, '2013-04-22', NULL, NULL, NULL, NULL, NULL, '9635216732', '', NULL, NULL, NULL, 'INDIAN', '5021010027724', 'PUNB0RRBBGB', NULL, NULL, NULL, 1, 5, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL),
(307, '01475619000000', 0, 0, '2024-01-01', '0', '0', 'SONIYA PARVIN', NULL, 'SOFIKUL ISLAM', NULL, 'HABIBA BIBI', NULL, '2013-07-24', NULL, NULL, NULL, NULL, NULL, '7384559313', '', NULL, NULL, NULL, 'INDIAN', '5021019900047', 'PUNB0RRBBGB', NULL, NULL, NULL, 1, 5, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '15', NULL, NULL),
(308, '05839621000011', 0, 0, '2024-01-01', '0', '0', 'SWEET SK', NULL, 'SANARUL HOQUE', NULL, 'JERBANU BIBI', NULL, '2013-10-04', NULL, NULL, NULL, NULL, NULL, '6299461498', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 5, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '12', NULL, NULL),
(309, '05312820000025', 0, 0, '2024-01-01', '0', '0', 'TAMIM IKBAL', NULL, 'BAIDUL SK', NULL, 'REJINA BIBI', NULL, '2013-07-02', NULL, NULL, NULL, NULL, NULL, '8759395243', '', NULL, NULL, NULL, 'INDIAN', '5021010002181', 'PUNB0RRBBGB', NULL, NULL, NULL, 1, 5, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '31', NULL, NULL),
(310, '05759119000006', 0, 0, '2024-01-01', '0', '0', 'TAMIM ISLAM', NULL, 'KAMRUJJAMAN', NULL, 'MST. JHARNA KHATUN', NULL, '2013-07-24', NULL, NULL, NULL, NULL, NULL, '7074596613', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 5, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '14', NULL, NULL);
INSERT INTO `studentdbs` (`id`, `studentid`, `admBookNo`, `admSlNo`, `admDate`, `prCls`, `prSch`, `name`, `adhaar`, `fname`, `fadhaar`, `mname`, `madhaar`, `dob`, `vill`, `post`, `pstn`, `dist`, `pin`, `mobl`, `ssex`, `phch`, `relg`, `cste`, `natn`, `accNo`, `ifsc`, `micr`, `bnnm`, `brnm`, `stclass_id`, `stsection_id`, `session_id`, `school_id`, `streason`, `enclass_id`, `ensection_id`, `ensession_id`, `enreason`, `crstatus`, `remarks`, `created_at`, `updated_at`) VALUES
(311, '01475619000016', 0, 0, '2024-01-01', '0', '0', 'TANIS AHAMMED', NULL, 'TANBIR AHAMED', NULL, 'TAJMAHAL BIBI', NULL, '2013-02-23', NULL, NULL, NULL, NULL, NULL, '8944962594', '', NULL, NULL, NULL, 'INDIAN', '5021010020280776', 'PUNB0070020', NULL, NULL, NULL, 1, 5, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '20', NULL, NULL),
(312, '05759119000005', 0, 0, '2024-01-01', '0', '0', 'TASMIRA KHATUN', NULL, 'ABDUL HALIM', NULL, 'NASIMA BIBI', NULL, '2013-04-24', NULL, NULL, NULL, NULL, NULL, '7318847623', '', NULL, NULL, NULL, 'INDIAN', '5575010011255', 'PUNB0RRBBGB', NULL, NULL, NULL, 1, 5, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '3', NULL, NULL),
(313, '01475519000070', 0, 0, '2024-01-01', '0', '0', 'TOHIDUR SK', NULL, 'AZRAUL HAQUE', NULL, 'RUPALI BIBI', NULL, '2013-10-16', NULL, NULL, NULL, NULL, NULL, '8609714235', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 5, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5', NULL, NULL),
(314, '05313019000033', 0, 0, '2024-01-01', '0', '0', 'ALI HOSSAIN', NULL, 'LALU SK', NULL, 'MARJINA BIBI', NULL, '2014-01-06', NULL, NULL, NULL, NULL, NULL, '9178375703', '', NULL, NULL, NULL, 'INDIAN', '33862801290', 'SBIN0008006', NULL, NULL, NULL, 1, 6, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '15', NULL, NULL),
(315, '05313719000006', 0, 0, '2024-01-01', '0', '0', 'AMINA KHATUN', NULL, 'FITU SK', NULL, 'SIMA BIBI', NULL, '2013-01-03', NULL, NULL, NULL, NULL, NULL, '7890179897', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 6, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '25', NULL, NULL),
(316, '05313019000018', 0, 0, '2024-01-01', '0', '0', 'AZAD SK', NULL, 'MD SAFIKUL ISLAM', NULL, 'SHILA BIBI', NULL, '2013-11-24', NULL, NULL, NULL, NULL, NULL, '7319207198', '', NULL, NULL, NULL, 'INDIAN', '5021019900108', 'PUNB0RRBBGB', NULL, NULL, NULL, 1, 6, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '9', NULL, NULL),
(317, '08895119000002', 0, 0, '2024-01-01', '0', '0', 'BALORAM MONDAL', NULL, 'MODHU SUDAN MONDAL', NULL, 'BANDONA MONDAL', NULL, '2013-04-13', NULL, NULL, NULL, NULL, NULL, '9679819671', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 6, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8', NULL, NULL),
(318, '08895119000003', 0, 0, '2024-01-01', '0', '0', 'BRISTI MONDAL', NULL, 'BIKASH MONDAL', NULL, 'MOLLIKA MONDAL', NULL, '2013-12-12', NULL, NULL, NULL, NULL, NULL, '9679819671', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 6, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '18', NULL, NULL),
(319, '01631820000006', 0, 0, '2024-01-01', '0', '0', 'GANESH ROBI DAS', NULL, 'BAPPI ROBI DAS', NULL, 'ANJALI ROBI DAS', NULL, '2013-09-15', NULL, NULL, NULL, NULL, NULL, '9134562770', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 6, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '13', NULL, NULL),
(320, '05312919000007', 0, 0, '2024-01-01', '0', '0', 'GOLAM ROSUL', NULL, 'TARIKUL ISLAM', NULL, 'RAKIBA KHATUN', NULL, '2013-08-02', NULL, NULL, NULL, NULL, NULL, '8346953943', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 6, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '17', NULL, NULL),
(321, '05313719000029', 0, 0, '2024-01-01', '0', '0', 'IKBAL ISLAM', NULL, 'ROFIKUL ISLAM', NULL, 'TANJILA BIBI', NULL, '2013-07-16', NULL, NULL, NULL, NULL, NULL, '8016613352', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 6, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '23', NULL, NULL),
(322, '05839821000013', 0, 0, '2024-01-01', '0', '0', 'KHADIJA KHATUN', NULL, 'HASIBUR RAHAMAN', NULL, 'RINA BIBI', NULL, '2013-04-15', NULL, NULL, NULL, NULL, NULL, '9091095087', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 6, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '12', NULL, NULL),
(323, '05197219000160', 0, 0, '2024-01-01', '0', '0', 'KHAIRUNNESHA KHATUN', NULL, 'SONARUL SK', NULL, 'TUKTUKI BIBI', NULL, '2013-09-09', NULL, NULL, NULL, NULL, NULL, '8582812815', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 6, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '30', NULL, NULL),
(324, '05313719000015', 0, 0, '2024-01-01', '0', '0', 'MASURA KHATUN', NULL, 'RAKIBUR RAHAMAN', NULL, 'SHILPI BIBI', NULL, '2013-06-14', NULL, NULL, NULL, NULL, NULL, '8838121680', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 6, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '28', NULL, NULL),
(325, '04340919000219', 0, 0, '2024-01-01', '0', '0', 'MD JAYED ALI', NULL, 'MD ANIKUL ISLAM', NULL, 'MST PARVINA KHATUN', NULL, '2013-01-16', NULL, NULL, NULL, NULL, NULL, '7384613025', '', NULL, NULL, NULL, 'INDIAN', '33576086761', 'SBIN0008006', NULL, NULL, NULL, 1, 6, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '27', NULL, NULL),
(326, '05312719000011', 0, 0, '2024-01-01', '0', '0', 'MD. JUNAID SK', NULL, 'AJARUL HOQUE', NULL, 'JELEKHA BIBI', NULL, '2013-09-14', NULL, NULL, NULL, NULL, NULL, '9932421034', '', NULL, NULL, NULL, 'INDIAN', '5021010007352', 'PUNB0RRBBGB', NULL, NULL, NULL, 1, 6, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6', NULL, NULL),
(327, '05313719000017', 0, 0, '2024-01-01', '0', '0', 'MD JUNIYED HOSSAIN', NULL, 'MD SAFIKUL ISLAM', NULL, 'SETARA BIBI', NULL, '2013-06-06', NULL, NULL, NULL, NULL, NULL, '9800584619', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 6, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '26', NULL, NULL),
(328, '05312819000418', 0, 0, '2024-01-01', '0', '0', 'MD MEHEDI HASAN', NULL, 'RABIUL ISLAM', NULL, 'MERINA BIBI', NULL, '2013-05-30', NULL, NULL, NULL, NULL, NULL, '9564241928', '', NULL, NULL, NULL, 'INDIAN', '35643247891', 'SBIN0008006', NULL, NULL, NULL, 1, 6, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4', NULL, NULL),
(329, '05313019000030', 0, 0, '2024-01-01', '0', '0', 'MST SALMA KHATUN', NULL, 'AJMAL HOQUE', NULL, 'MOMOTAJ KAHTUN', NULL, '2014-01-05', NULL, NULL, NULL, NULL, NULL, '8017062356', '', NULL, NULL, NULL, 'INDIAN', '5021021276100', 'PUNB0RRBBGB', NULL, NULL, NULL, 1, 6, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '14', NULL, NULL),
(330, '05312919000008', 0, 0, '2024-01-01', '0', '0', 'OHIDUL SK', NULL, 'BASIR SK', NULL, 'DILRUBA BIBI', NULL, '2013-11-15', NULL, NULL, NULL, NULL, NULL, '8348675179', '', NULL, NULL, NULL, 'INDIAN', '5021010049081', 'PUNB0RRBBGB', NULL, NULL, NULL, 1, 6, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '16', NULL, NULL),
(331, '05839721000036', 0, 0, '2024-01-01', '0', '0', 'PAPAY CHOUDHURY', NULL, 'PRAKASH CHOUDHURY', NULL, 'RUMKI SINGHA CHOUDHURY', NULL, '2014-02-03', NULL, NULL, NULL, NULL, NULL, '9647427601', '', NULL, NULL, NULL, 'INDIAN', '5021010031842', 'PUNB0RRBBGB', NULL, NULL, NULL, 1, 6, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5', NULL, NULL),
(332, '05839821000005', 0, 0, '2024-01-01', '0', '0', 'RABIA KHATUN', NULL, 'RAFIK SK', NULL, 'MASURA BIBI', NULL, '2013-03-06', NULL, NULL, NULL, NULL, NULL, '7363937818', '', NULL, NULL, NULL, 'INDIAN', '37991784061', 'SBIN0008006', NULL, NULL, NULL, 1, 6, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '7', NULL, NULL),
(333, '05312919000001', 0, 0, '2024-01-01', '0', '0', 'RAHAD SK', NULL, 'DULAL', NULL, 'RIMA BIBI', NULL, '2013-04-23', NULL, NULL, NULL, NULL, NULL, '9002057616', '', NULL, NULL, NULL, 'INDIAN', '32436569361', 'SBIN0008006', NULL, NULL, NULL, 1, 6, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '21', NULL, NULL),
(334, '01475619000004', 0, 0, '2024-01-01', '0', '0', 'RAHUL SK', NULL, 'AJIBUR RAHAMAN', NULL, 'SEFALI BIBI', NULL, '2013-11-23', NULL, NULL, NULL, NULL, NULL, '8350080419', '', NULL, NULL, NULL, 'INDIAN', '20383192060', 'SBIN0015048', NULL, NULL, NULL, 1, 6, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', NULL, NULL),
(335, '05313719000003', 0, 0, '2024-01-01', '0', '0', 'RAMIJ SK', NULL, 'NAJMUL HAQUE', NULL, 'RUBIA BIBI', NULL, '2013-04-26', NULL, NULL, NULL, NULL, NULL, '9144063398', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 6, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '19', NULL, NULL),
(336, '05312819000406', 0, 0, '2024-01-01', '0', '0', 'REJUWAN SK', NULL, 'SARIFUL ISLAM', NULL, 'LUTFUNNESHA BIBI', NULL, '2013-08-11', NULL, NULL, NULL, NULL, NULL, '9134732504', '', NULL, NULL, NULL, 'INDIAN', '33671700640', 'SBIN0008006', NULL, NULL, NULL, 1, 6, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '29', NULL, NULL),
(337, '01475519000074', 0, 0, '2024-01-01', '0', '0', 'ROBIUL ISLAM', NULL, 'MARUAL HOQUE', NULL, 'ROKIYA BIBI', NULL, '2013-02-01', NULL, NULL, NULL, NULL, NULL, '9932370266', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 6, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL),
(338, '05313719000016', 0, 0, '2024-01-01', '0', '0', 'SAHANAJ PARVIN', NULL, 'EKBAR ALI', NULL, 'MERINA KHATUN BIBI', NULL, '2013-01-27', NULL, NULL, NULL, NULL, NULL, '8172059537', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 6, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '11', NULL, NULL),
(339, '01475519000050', 0, 0, '2024-01-01', '0', '0', 'SALMA AKTAR', NULL, 'SAINUL ISLAM', NULL, 'MST REJINA KHATUN', NULL, '2013-03-22', NULL, NULL, NULL, NULL, NULL, '9732726733', '', NULL, NULL, NULL, 'INDIAN', '33778932819', 'SBIN0008006', NULL, NULL, NULL, 1, 6, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '10', NULL, NULL),
(340, '01475519000063', 0, 0, '2024-01-01', '0', '0', 'SAMIM AKTAR', NULL, 'MASIUR RAHAMAN', NULL, 'SEBINA BIBI', NULL, '2013-01-14', NULL, NULL, NULL, NULL, NULL, '7319118884', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 6, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '32', NULL, NULL),
(341, '05839821000004', 0, 0, '2024-01-01', '0', '0', 'SIMRAN KHATUN', NULL, 'MD KARIF SHAIKH', NULL, 'JANNATUN BIBI', NULL, '2013-02-14', NULL, NULL, NULL, NULL, NULL, '8481895081', '', NULL, NULL, NULL, 'INDIAN', '34365244984', 'SBIN0008006', NULL, NULL, NULL, 1, 6, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '3', NULL, NULL),
(342, '05313719000013', 0, 0, '2024-01-01', '0', '0', 'SOHIDUL ISLAM', NULL, 'KAMRUJJAMAN', NULL, 'TUHINA BIBI', NULL, '2013-11-15', NULL, NULL, NULL, NULL, NULL, '6825992724', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 6, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '31', NULL, NULL),
(343, '05313719000026', 0, 0, '2024-01-01', '0', '0', 'SOLEMAN SK', NULL, 'JAHANGIR HOSSAIN', NULL, 'MURSHIDA BIBI', NULL, '2013-11-26', NULL, NULL, NULL, NULL, NULL, '9134730732', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 6, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '22', NULL, NULL),
(344, '05312919000003', 0, 0, '2024-01-01', '0', '0', 'TAHERA KHATUN', NULL, 'MD FARUK HOSSAIN', NULL, 'SABINA BIBI', NULL, '2013-01-24', NULL, NULL, NULL, NULL, NULL, '9134486506', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 1, 6, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '20', NULL, NULL),
(345, '05312820000026', 0, 0, '2024-01-01', '0', '0', 'YAMIN SK', NULL, 'ROFIKUL ISLAM', NULL, 'FARIDA BIBI', NULL, '2013-11-28', NULL, NULL, NULL, NULL, NULL, '9647673407', '', NULL, NULL, NULL, 'INDIAN', '1314010183154', '', NULL, NULL, NULL, 1, 6, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '24', NULL, NULL),
(346, '05313019000049', 0, 0, '2024-01-01', '0', '0', 'ABDUL KADIR', NULL, 'PINTU SK', NULL, 'SAYERA BIBI', NULL, '2012-06-15', NULL, NULL, NULL, NULL, NULL, '6297624509', '', NULL, NULL, NULL, 'INDIAN', '5021020000049', 'PUNB0RRBBGB', NULL, NULL, NULL, 2, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '30', NULL, NULL),
(347, '01475619000050', 0, 0, '2024-01-01', '0', '0', 'ABDUR RAHMAN', NULL, 'RABIUL ISLAM', NULL, 'SABINA KHATUN', NULL, '2012-10-10', NULL, NULL, NULL, NULL, NULL, '9932092734', '', NULL, NULL, NULL, 'INDIAN', '1532101700054072', 'PUNB0042020', NULL, NULL, NULL, 2, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '46', NULL, NULL),
(348, '01475519000100', 0, 0, '2024-01-01', '0', '0', 'ABU KALAS', NULL, 'MD SAFIKUL ISLAM', NULL, 'TUSI BIBI', NULL, '2012-07-02', NULL, NULL, NULL, NULL, NULL, '9832267979', '', NULL, NULL, NULL, 'INDIAN', '5021010043582', 'PUNB0RRBBGB', NULL, NULL, NULL, 2, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '14', NULL, NULL),
(349, '01475619000040', 0, 0, '2024-01-01', '0', '0', 'ADITYA SAHA', NULL, 'JOY KUMAR SAHA', NULL, 'RUMA SINGHA SAHA', NULL, '2012-12-28', NULL, NULL, NULL, NULL, NULL, '9851251719', '', NULL, NULL, NULL, 'INDIAN', '5021010044174', 'PUNB0RRBBGB', NULL, NULL, NULL, 2, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '18', NULL, NULL),
(350, '01475519000101', 0, 0, '2024-01-01', '0', '0', 'AL AMIN', NULL, 'ANOWAR ALI', NULL, 'MST. CHAMPA BIBI', NULL, '2012-01-18', NULL, NULL, NULL, NULL, NULL, '7872048429', '', NULL, NULL, NULL, 'INDIAN', '5021010044299', 'PUNB0RRBBGB', NULL, NULL, NULL, 2, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '50', NULL, NULL),
(351, '05311919000099', 0, 0, '2024-01-01', '0', '0', 'ARIAN SK', NULL, 'AMINUL ISLAM', NULL, 'RIMA BIBI', NULL, '2012-07-25', NULL, NULL, NULL, NULL, NULL, '9091154198', '', NULL, NULL, NULL, 'INDIAN', '5332245733', 'CBIN0280122', NULL, NULL, NULL, 2, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '12', NULL, NULL),
(352, '05313119000063', 0, 0, '2024-01-01', '0', '0', 'ARIYAN AKHTAR', NULL, 'MD HYDAR ALI', NULL, 'MST RITA KHATUN', NULL, '2012-07-20', NULL, NULL, NULL, NULL, NULL, '8016720886', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 2, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '19', NULL, NULL),
(353, '05313719000041', 0, 0, '2024-01-01', '0', '0', 'ASMA PARVIN', NULL, 'AWLAD HOSSAIN', NULL, 'SAKILA BIBI', NULL, '2012-03-19', NULL, NULL, NULL, NULL, NULL, '6295239823', '', NULL, NULL, NULL, 'INDIAN', '5575010036722', 'PUNB0RRBBGB', NULL, NULL, NULL, 2, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '47', NULL, NULL),
(354, '05839421000020', 0, 0, '2024-01-01', '0', '0', 'EKATA YEASMIN', NULL, 'ERFAN ALI', NULL, 'SUKTARA BIBI', NULL, '2012-09-17', NULL, NULL, NULL, NULL, NULL, '6296793629', '', NULL, NULL, NULL, 'INDIAN', '35866951349', 'SBIN0008006', NULL, NULL, NULL, 2, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '33', NULL, NULL),
(355, '05313019000036', 0, 0, '2024-01-01', '0', '0', 'FATEMA KHATUN', NULL, 'MD KAMRUZZAMAN', NULL, 'HASINA BIBI', NULL, '2012-08-25', NULL, NULL, NULL, NULL, NULL, '7602044663', '', NULL, NULL, NULL, 'INDIAN', '1532101700054364', 'PUNB0042020', NULL, NULL, NULL, 2, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '45', NULL, NULL),
(356, '05313719000048', 0, 0, '2024-01-01', '0', '0', 'HALIMA AKTAR', NULL, 'MUKLASUR RAHAMAN', NULL, 'NURESA KHATUN BIBI', NULL, '2012-09-28', NULL, NULL, NULL, NULL, NULL, '8609686226', '', NULL, NULL, NULL, 'INDIAN', '557501005019', '', NULL, NULL, NULL, 2, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '40', NULL, NULL),
(357, '01475519000112', 0, 0, '2024-01-01', '0', '0', 'IFTIKAR KHAN', NULL, 'MD ISMAIL HOQUE', NULL, 'MAMONI KHATUN', NULL, '2012-04-08', NULL, NULL, NULL, NULL, NULL, '6297635131', '', NULL, NULL, NULL, 'INDIAN', '5235398224', 'CBIN0280122', NULL, NULL, NULL, 2, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6', NULL, NULL),
(358, '08895121000049', 0, 0, '2024-01-01', '0', '0', 'INDROJIT MONDAL', NULL, 'JAYCHAND MONDAL', NULL, 'MIRA MONDAL', NULL, '2012-11-02', NULL, NULL, NULL, NULL, NULL, '7584965661', '', NULL, NULL, NULL, 'INDIAN', '1532101700061948', 'PUNB0153210', NULL, NULL, NULL, 2, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '55', NULL, NULL),
(359, '05313219000061', 0, 0, '2024-01-01', '0', '0', 'ISMAIL SK', NULL, 'SARIKUL ISLAM', NULL, 'SAIMA BIBI', NULL, '2012-05-06', NULL, NULL, NULL, NULL, NULL, '8766991218', '', NULL, NULL, NULL, 'INDIAN', '5021030000765', 'PUNB0RRBBGB', NULL, NULL, NULL, 2, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '54', NULL, NULL),
(360, '05312819000448', 0, 0, '2024-01-01', '0', '0', 'JHILIK NUNIA', NULL, 'PABAN NUNIA', NULL, 'SITA NUNIA', NULL, '2012-03-15', NULL, NULL, NULL, NULL, NULL, '7699927573', '', NULL, NULL, NULL, 'INDIAN', '2063667320', 'CBIN0280122', NULL, NULL, NULL, 2, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '37', NULL, NULL),
(361, '05313119000050', 0, 0, '2024-01-01', '0', '0', 'JIBONNESHA KHATUN', NULL, 'JAHIRUDDIN', NULL, 'MOYNA BIBI', NULL, '2012-05-16', NULL, NULL, NULL, NULL, NULL, '8348705214', '', NULL, NULL, NULL, 'INDIAN', '5296019041', 'CBIN0280122', NULL, NULL, NULL, 2, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '16', NULL, NULL),
(362, '01475519000119', 0, 0, '2024-01-01', '0', '0', 'JIGARUL SK', NULL, 'SAJAB SK', NULL, 'RAKIBA BIBI', NULL, '2012-01-10', NULL, NULL, NULL, NULL, NULL, '8945819302', '', NULL, NULL, NULL, 'INDIAN', '5021010044325', 'PUNB0RRBBGB', NULL, NULL, NULL, 2, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '51', NULL, NULL),
(363, '05311919000083', 0, 0, '2024-01-01', '0', '0', 'JONAIDE', NULL, 'BADIUJJAMAN', NULL, 'NASIMA BIBI', NULL, '2012-12-29', NULL, NULL, NULL, NULL, NULL, '9091885805', '', NULL, NULL, NULL, 'INDIAN', '5521369748', 'CBIN0280122', NULL, NULL, NULL, 2, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '66', NULL, NULL),
(364, '05313219000056', 0, 0, '2024-01-01', '0', '0', 'LAMIA TASMIN', NULL, 'AMINUL ISLAM', NULL, 'KHADIJA BIBI', NULL, '2012-07-27', NULL, NULL, NULL, NULL, NULL, '9933745572', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 2, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '59', NULL, NULL),
(365, '01475519000129', 0, 0, '2024-01-01', '0', '0', 'MARIA KIBTIA', NULL, 'MD RABIUL ISLAM', NULL, 'RUBINA KHATUN', NULL, '2012-11-12', NULL, NULL, NULL, NULL, NULL, '9647261529', '', NULL, NULL, NULL, 'INDIAN', '1532101700052694', 'PUNB0153210', NULL, NULL, NULL, 2, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4', NULL, NULL),
(366, '01475519000115', 0, 0, '2024-01-01', '0', '0', 'MD IMRAN HASAN', NULL, 'MD SAFIKUZZAMAN', NULL, 'MST KARISHMA BEGAM', NULL, '2012-11-24', NULL, NULL, NULL, NULL, NULL, '9932423168', '', NULL, NULL, NULL, 'INDIAN', '0977010137942', 'PUNB0097720', NULL, NULL, NULL, 2, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '15', NULL, NULL),
(367, '01475519000114', 0, 0, '2024-01-01', '0', '0', 'MD KAMAL', NULL, 'MD SAIFUJJAMAN', NULL, 'NIRALA KHATUN', NULL, '2012-06-15', NULL, NULL, NULL, NULL, NULL, '7047432199', '', NULL, NULL, NULL, 'INDIAN', '5021010000336', 'PUNB0RRBBGB', NULL, NULL, NULL, 2, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '58', NULL, NULL),
(368, '05839821000015', 0, 0, '2024-01-01', '0', '0', 'MD SAMIM SK', NULL, 'AMIRUL SK', NULL, 'MARJINA BIBI', NULL, '2012-11-30', NULL, NULL, NULL, NULL, NULL, '9093582189', '', NULL, NULL, NULL, 'INDIAN', '33692952796', 'SBIN0008006', NULL, NULL, NULL, 2, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '48', NULL, NULL),
(369, '05839721000003', 0, 0, '2024-01-01', '0', '0', 'MEGHNA KHATUN', NULL, 'MERAJUL ISLAM', NULL, 'HASINA KHATUN', NULL, '2013-10-06', NULL, NULL, NULL, NULL, NULL, '6297469454', '', NULL, NULL, NULL, 'INDIAN', '1532101700115119', 'PUNB0153210', NULL, NULL, NULL, 2, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '49', NULL, NULL),
(370, '01475619000037', 0, 0, '2024-01-01', '0', '0', 'MIJAN ISLAM', NULL, 'MAJRUL ISLAM', NULL, 'MILI BIBI', NULL, '2012-05-03', NULL, NULL, NULL, NULL, NULL, '9647891351', '', NULL, NULL, NULL, 'INDIAN', '1532101700050696', 'PUNB0153210', NULL, NULL, NULL, 2, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '38', NULL, NULL),
(371, '01475519000102', 0, 0, '2024-01-01', '0', '0', 'MIJAN SK', NULL, 'MILON SK', NULL, 'NASIMA BIBI', NULL, '2012-04-16', NULL, NULL, NULL, NULL, NULL, '9800121222', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 2, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '22', NULL, NULL),
(372, '05312719000040', 0, 0, '2024-01-01', '0', '0', 'MINHAJUL ISLAM', NULL, 'TARIKUL ISLAM', NULL, 'MST MURSEDA KHATUN', NULL, '2012-02-18', NULL, NULL, NULL, NULL, NULL, '8159896604', '', NULL, NULL, NULL, 'INDIAN', '0977010278478', 'PUNB0097720', NULL, NULL, NULL, 2, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '60', NULL, NULL),
(373, '08895119000019', 0, 0, '2024-01-01', '0', '0', 'MITHI MONDAL', NULL, 'AJIT MONDAL', NULL, 'SEBIKA MONDAL', NULL, '2013-01-29', NULL, NULL, NULL, NULL, NULL, '6296481369', '', NULL, NULL, NULL, 'INDIAN', '5021010044369', 'PUNB0RRBBGB', NULL, NULL, NULL, 2, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '32', NULL, NULL),
(374, '05759119000036', 0, 0, '2024-01-01', '0', '0', 'MST KHADIJA KHATUN', NULL, 'SAFIKUL ISLAM', NULL, 'RAFIKA BIBI', NULL, '2012-07-30', NULL, NULL, NULL, NULL, NULL, '9091898255', '', NULL, NULL, NULL, 'INDIAN', '5575010036980', 'PUNB0RRBBGB', NULL, NULL, NULL, 2, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '52', NULL, NULL),
(375, '05313119000057', 0, 0, '2024-01-01', '0', '0', 'MST. NAHIDA AKTAR', NULL, 'ILTUTMIS', NULL, 'MERINA BIBI', NULL, '2012-02-28', NULL, NULL, NULL, NULL, NULL, '9547276771', '', NULL, NULL, NULL, 'INDIAN', '32635821214', 'SBIN0008006', NULL, NULL, NULL, 2, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '25', NULL, NULL),
(376, '05313219000052', 0, 0, '2024-01-01', '0', '0', 'MST ROKIYA SULTANA', NULL, 'MD ALIUJJAMAN', NULL, 'AJIBUN NESHA BIBI', NULL, '2012-09-06', NULL, NULL, NULL, NULL, NULL, '9609921023', '', NULL, NULL, NULL, 'INDIAN', '1532101700049788', 'PUNB0042020', NULL, NULL, NULL, 2, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '39', NULL, NULL),
(377, '05313119000054', 0, 0, '2024-01-01', '0', '0', 'MUFSIDA RIJIA', NULL, 'SAFIKUL ISLAM', NULL, 'BIJOLA KHATUN', NULL, '2012-09-07', NULL, NULL, NULL, NULL, NULL, '9932790274', '', NULL, NULL, NULL, 'INDIAN', '1532101700049858', 'PUNB0153210', NULL, NULL, NULL, 2, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '29', NULL, NULL),
(378, '01475519000083', 0, 0, '2024-01-01', '0', '0', 'NABLIN SULTANA', NULL, 'MD GOLAM MOUSTOFA', NULL, 'SAIMA KHATUN', NULL, '2012-03-21', NULL, NULL, NULL, NULL, NULL, '9732640802', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 2, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', NULL, NULL),
(379, '05313119000068', 0, 0, '2024-01-01', '0', '0', 'NAIF HASAN', NULL, 'FAITULLA SK', NULL, 'PARULA BIBI', NULL, '2012-01-10', NULL, NULL, NULL, NULL, NULL, '8967129760', '', NULL, NULL, NULL, 'INDIAN', '5213278027', 'CBIN0280122', NULL, NULL, NULL, 2, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '21', NULL, NULL),
(380, '05313219000041', 0, 0, '2024-01-01', '0', '0', 'NATASA KHATUN', NULL, 'BABAR SK', NULL, 'SAKILA BIBI', NULL, '2012-06-02', NULL, NULL, NULL, NULL, NULL, '9733812203', '', NULL, NULL, NULL, 'INDIAN', '5299686727', 'CBIN0280122', NULL, NULL, NULL, 2, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '13', NULL, NULL),
(381, '01475619000049', 0, 0, '2024-01-01', '0', '0', 'NUR MOHAMMED', NULL, 'ABU HENA', NULL, 'MERINA BIBI', NULL, '2012-12-10', NULL, NULL, NULL, NULL, NULL, '9641673838', '', NULL, NULL, NULL, 'INDIAN', '1532101700049690', 'PUNB0153210', NULL, NULL, NULL, 2, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '56', NULL, NULL),
(382, '01475221000063', 0, 0, '2024-01-01', '0', '0', 'PRATYUSHA SWASTYANEEK', NULL, 'MD.ABDUR ROUF', NULL, 'BINOTA KAMAL', NULL, '2012-02-02', NULL, NULL, NULL, NULL, NULL, '9735771008', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 2, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8', NULL, NULL),
(383, '01475519000113', 0, 0, '2024-01-01', '0', '0', 'PRIYANGSHU SAHA', NULL, 'UTTAM KUMAR SAHA', NULL, 'PIYALI SAHA', NULL, '2012-09-16', NULL, NULL, NULL, NULL, NULL, '8509138097', '', NULL, NULL, NULL, 'INDIAN', '1532101700050951', 'PUNB0153210', NULL, NULL, NULL, 2, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '63', NULL, NULL),
(384, '05312819000440', 0, 0, '2024-01-01', '0', '0', 'RABIA KHATUN', NULL, 'ABDUR RAJJAK', NULL, 'PARVIN BIBI', NULL, '2012-04-17', NULL, NULL, NULL, NULL, NULL, '8116854936', '', NULL, NULL, NULL, 'INDIAN', '4027536509', 'CBIN0280122', NULL, NULL, NULL, 2, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '57', NULL, NULL),
(385, '05311919000072', 0, 0, '2024-01-01', '0', '0', 'RAHIMA KHATUN', NULL, 'MD REJAUL HOQUE', NULL, 'HIRA BIBI', NULL, '2012-01-22', NULL, NULL, NULL, NULL, NULL, '9734051423', '', NULL, NULL, NULL, 'INDIAN', '5198183014', 'CBIN0280122', NULL, NULL, NULL, 2, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '65', NULL, NULL),
(386, '05839721000002', 0, 0, '2024-01-01', '0', '0', 'RAHIM RAJA', NULL, 'IBRAHIM ALI', NULL, 'RIPA KHATUN', NULL, '2013-03-10', NULL, NULL, NULL, NULL, NULL, '7407301373', '', NULL, NULL, NULL, 'INDIAN', '5021021434217', 'PUNB0RRBBGB', NULL, NULL, NULL, 2, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '44', NULL, NULL),
(387, '08895119000024', 0, 0, '2024-01-01', '0', '0', 'RAJ MANDAL', NULL, 'RABI MANDAL', NULL, 'SANTWANA MANDAL', NULL, '2012-11-28', NULL, NULL, NULL, NULL, NULL, '8388918927', '', NULL, NULL, NULL, 'INDIAN', '5021010043722', 'PUNB0RRBBGB', NULL, NULL, NULL, 2, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '26', NULL, NULL),
(388, '05312819000444', 0, 0, '2024-01-01', '0', '0', 'RAKHI SINGHA', NULL, 'KRISHNA SINGHA', NULL, 'AROTI SINGHA', NULL, '2012-05-10', NULL, NULL, NULL, NULL, NULL, '9093191434', '', NULL, NULL, NULL, 'INDIAN', '5333902493', 'CBIN0280122', NULL, NULL, NULL, 2, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '35', NULL, NULL),
(389, '05313219000066', 0, 0, '2024-01-01', '0', '0', 'RAMIJ HOSSAIN', NULL, 'ANIKUL ISLAM', NULL, 'GOLAPI BIBI', NULL, '2012-01-27', NULL, NULL, NULL, NULL, NULL, '7595810374', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 2, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '62', NULL, NULL),
(390, '05312819000443', 0, 0, '2024-01-01', '0', '0', 'RIMI SINGHA', NULL, 'RAKESH CH. SINGHA', NULL, 'KASTURI SINGHA', NULL, '2012-08-20', NULL, NULL, NULL, NULL, NULL, '9002154760', '', NULL, NULL, NULL, 'INDIAN', '5021010043193', 'PUNB0RRBBGB', NULL, NULL, NULL, 2, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '28', NULL, NULL),
(391, '05312819000437', 0, 0, '2024-01-01', '0', '0', 'RINA KHATUN', NULL, 'PIYARUL SK', NULL, 'MAMATA BIBI', NULL, '2012-03-11', NULL, NULL, NULL, NULL, NULL, '9144841675', '', NULL, NULL, NULL, 'INDIAN', '38377988908', 'SBIN0008006', NULL, NULL, NULL, 2, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '53', NULL, NULL),
(392, '05313119000053', 0, 0, '2024-01-01', '0', '0', 'RIYA KHATUN', NULL, 'MURSHID ALI', NULL, 'KULSONARA KHATUN', NULL, '2012-03-05', NULL, NULL, NULL, NULL, NULL, '7699928547', '', NULL, NULL, NULL, 'INDIAN', '5021070043980', 'PUNB0RRBBGB', NULL, NULL, NULL, 2, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '24', NULL, NULL),
(393, '01475519000087', 0, 0, '2024-01-01', '0', '0', 'RONI MANDAL', NULL, 'BIKASH MANDAL', NULL, 'JOMUNA MANDAL', NULL, '2012-04-25', NULL, NULL, NULL, NULL, NULL, '7074895003', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 2, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '34', NULL, NULL),
(394, '05839821000020', 0, 0, '2024-01-01', '0', '0', 'SABNUR KHATUN', NULL, 'SANUYAR HOSSAIN', NULL, 'HASINA BIBI', NULL, '2012-03-27', NULL, NULL, NULL, NULL, NULL, '7501368524', '', NULL, NULL, NULL, 'INDIAN', '5021010044271', 'PUNB0RRBBGB', NULL, NULL, NULL, 2, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '17', NULL, NULL),
(395, '05313119000051', 0, 0, '2024-01-01', '0', '0', 'SABNUR KHATUN', NULL, 'SABIRUL ISLAM', NULL, 'MAFRUJA BIBI', NULL, '2012-05-27', NULL, NULL, NULL, NULL, NULL, '9091851423', '', NULL, NULL, NULL, 'INDIAN', '1314200100004673', 'PUNB0131420', NULL, NULL, NULL, 2, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5', NULL, NULL),
(396, '05313119000049', 0, 0, '2024-01-01', '0', '0', 'SABNUR KHATUN', NULL, 'GOLAM RASUL', NULL, 'AKLEMA BIBI', NULL, '2012-04-29', NULL, NULL, NULL, NULL, NULL, '7585938486', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 2, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '9', NULL, NULL),
(397, '01475619000047', 0, 0, '2024-01-01', '0', '0', 'SADIA SARKAR', NULL, 'MD SELIM HOQUE', NULL, 'AYESHA KHATUN', NULL, '2012-09-16', NULL, NULL, NULL, NULL, NULL, '7586843244', '', NULL, NULL, NULL, 'INDIAN', '5021010043157', 'PUNB0RRBBGB', NULL, NULL, NULL, 2, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '43', NULL, NULL),
(398, '05759119000032', 0, 0, '2024-01-01', '0', '0', 'SAHID HOSSAIN', NULL, 'JIARUL ISLAM', NULL, 'SUMMA BIBI', NULL, '2012-07-29', NULL, NULL, NULL, NULL, NULL, '8609374700', '', NULL, NULL, NULL, 'INDIAN', '38392584145', 'SBIN0008006', NULL, NULL, NULL, 2, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '61', NULL, NULL),
(399, '01475519000105', 0, 0, '2024-01-01', '0', '0', 'SAMIUL HOQUE', NULL, 'TOFAJUL HOQUE', NULL, 'FAJILATUN NESHA', NULL, '2012-11-06', NULL, NULL, NULL, NULL, NULL, '9932982464', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 2, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '3', NULL, NULL),
(400, '06138121000051', 0, 0, '2024-01-01', '0', '0', 'SARIFA KHATUN', NULL, 'SARIFUL ISLAM', NULL, 'JARINA BIBI', NULL, '2012-06-20', NULL, NULL, NULL, NULL, NULL, '8583924767', '', NULL, NULL, NULL, 'INDIAN', '0977010332026', 'PUNB0097720', NULL, NULL, NULL, 2, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '20', NULL, NULL),
(401, '01475519000089', 0, 0, '2024-01-01', '0', '0', 'SARIKA KHATUN', NULL, 'JOYNAL ABEDIN', NULL, 'ARUNA BIBI', NULL, '2012-02-13', NULL, NULL, NULL, NULL, NULL, '7384036489', '', NULL, NULL, NULL, 'INDIAN', '1532101700090728', 'PUNB0153210', NULL, NULL, NULL, 2, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '27', NULL, NULL),
(402, '05839721000008', 0, 0, '2024-01-01', '0', '0', 'SUHANA KHATUN', NULL, 'SELIM SK', NULL, 'LAILA KHATUN', NULL, '2012-11-06', NULL, NULL, NULL, NULL, NULL, '8972393859', '', NULL, NULL, NULL, 'INDIAN', '39115669258', 'SBIN0008006', NULL, NULL, NULL, 2, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '36', NULL, NULL),
(403, '01475519000097', 0, 0, '2024-01-01', '0', '0', 'SUHANA SULTANA', NULL, 'MD KAMRUL ISLAM', NULL, 'RIMA BIBI', NULL, '2012-08-01', NULL, NULL, NULL, NULL, NULL, '9733423016', '', NULL, NULL, NULL, 'INDIAN', '5021010026895', 'PUNB0RRBBGB', NULL, NULL, NULL, 2, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '41', NULL, NULL),
(404, '05313219000069', 0, 0, '2024-01-01', '0', '0', 'SUHINA KHATUN', NULL, 'SOHEL RANA', NULL, 'NARGISH BIBI', NULL, '2012-09-26', NULL, NULL, NULL, NULL, NULL, '8825479026', '', NULL, NULL, NULL, 'INDIAN', '5350892186', 'CBIN0280122', NULL, NULL, NULL, 2, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '31', NULL, NULL),
(405, '01475519000094', 0, 0, '2024-01-01', '0', '0', 'SURAIYA KHATUN', NULL, 'SAMAUN ALI', NULL, 'TARJINA BIBI', NULL, '2012-08-17', NULL, NULL, NULL, NULL, NULL, '9734252904', '', NULL, NULL, NULL, 'INDIAN', '100155722090', 'INDB0000396', NULL, NULL, NULL, 2, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '23', NULL, NULL),
(406, '01475519000109', 0, 0, '2024-01-01', '0', '0', 'TAMIM SK', NULL, 'FARUK SK', NULL, 'SHILA BIBI', NULL, '2012-03-17', NULL, NULL, NULL, NULL, NULL, '8149999214', '', NULL, NULL, NULL, 'INDIAN', '36391241400', 'SBIN0008006', NULL, NULL, NULL, 2, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '42', NULL, NULL),
(407, '01475519000088', 0, 0, '2024-01-01', '0', '0', 'TANBIR ALAM', NULL, 'KABIR SK', NULL, 'TARALA BIBI', NULL, '2012-04-02', NULL, NULL, NULL, NULL, NULL, '7478116931', '', NULL, NULL, NULL, 'INDIAN', '1314201700007927', 'PUNB0131420', NULL, NULL, NULL, 2, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '10', NULL, NULL),
(408, '08895019000080', 0, 0, '2024-01-01', '0', '0', 'TOUSIBA KHATUN', NULL, 'TOZAMMEL HAQUE', NULL, 'MST. HASINA KHATUN', NULL, '2012-07-21', NULL, NULL, NULL, NULL, NULL, '8670996400', '', NULL, NULL, NULL, 'INDIAN', '1314010184519', 'PUNB0131420', NULL, NULL, NULL, 2, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL),
(409, '05313019000054', 0, 0, '2024-01-01', '0', '0', 'ABDUS SAMAD', NULL, 'GOLAM SABIR', NULL, 'SIMA KHATUN', NULL, '2012-11-07', NULL, NULL, NULL, NULL, NULL, '7797066512', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 2, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '60', NULL, NULL),
(410, '01475619000028', 0, 0, '2024-01-01', '0', '0', 'AL AMIN', NULL, 'JALAL SK', NULL, 'SUFERA BIBI', NULL, '2012-08-13', NULL, NULL, NULL, NULL, NULL, '9093620279', '', NULL, NULL, NULL, 'INDIAN', '5021010030685', 'PUNB0RRBBGB', NULL, NULL, NULL, 2, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '49', NULL, NULL),
(411, '05839621000025', 0, 0, '2024-01-01', '0', '0', 'ALAMIN SK', NULL, 'ABDUR RAHIM SK', NULL, 'HASINA KHATUN', NULL, '2013-02-07', NULL, NULL, NULL, NULL, NULL, '6289837214', '', NULL, NULL, NULL, 'INDIAN', '37878024134', 'SBIN0008006', NULL, NULL, NULL, 2, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '43', NULL, NULL),
(412, '01475519000095', 0, 0, '2024-01-01', '0', '0', 'ALFIDA KHATUN', NULL, 'AYNAL HOQUE', NULL, 'JHUMA BIBI', NULL, '2012-01-08', NULL, NULL, NULL, NULL, NULL, '8116869024', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 2, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '42', NULL, NULL),
(413, '05313119000055', 0, 0, '2024-01-01', '0', '0', 'AMRINA KHATUN', NULL, 'ABDUS ALI', NULL, 'AMBIYA BIBI', NULL, '2012-01-19', NULL, NULL, NULL, NULL, NULL, '9932186335', '', NULL, NULL, NULL, 'INDIAN', '5021020000621', 'PUNB0RRBBGB', NULL, NULL, NULL, 2, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '47', NULL, NULL),
(414, '05312819000441', 0, 0, '2024-01-01', '0', '0', 'ARKA GHOSH', NULL, 'AMIT GHOSH', NULL, 'RIYA GHOSH', NULL, '2012-05-28', NULL, NULL, NULL, NULL, NULL, '9735279456', '', NULL, NULL, NULL, 'INDIAN', '31538852359', 'SBIN0008006', NULL, NULL, NULL, 2, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '10', NULL, NULL),
(415, '01475519000124', 0, 0, '2024-01-01', '0', '0', 'ASHA KHATUN', NULL, 'ASIKUL SK', NULL, 'TUHINA BIBI', NULL, '2012-06-25', NULL, NULL, NULL, NULL, NULL, '7584039408', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 2, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '36', NULL, NULL),
(416, '05312819000450', 0, 0, '2024-01-01', '0', '0', 'AYESHA KHATUN', NULL, 'AWAL HOSSAIN', NULL, 'MST RUKSONA BIBI', NULL, '2012-11-09', NULL, NULL, NULL, NULL, NULL, '7679746265', '', NULL, NULL, NULL, 'INDIAN', '20276547641', 'SBIN0015048', NULL, NULL, NULL, 2, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4', NULL, NULL),
(417, '01475619000034', 0, 0, '2024-01-01', '0', '0', 'AZGAR ALI', NULL, 'FARAJ SK', NULL, 'NASHIMA BIBI', NULL, '2012-06-04', NULL, NULL, NULL, NULL, NULL, '9932620057', '', NULL, NULL, NULL, 'INDIAN', '1532101700047762', 'PUNB0153210', NULL, NULL, NULL, 2, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5', NULL, NULL),
(418, '05312719000041', 0, 0, '2024-01-01', '0', '0', 'EASIN SK', NULL, 'HAKIM SK', NULL, 'RIMA BIBI', NULL, '2012-12-15', NULL, NULL, NULL, NULL, NULL, '9609467710', '', NULL, NULL, NULL, 'INDIAN', '5021010024675', 'PUNB0RRBBGB', NULL, NULL, NULL, 2, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '30', NULL, NULL),
(419, '05759119000038', 0, 0, '2024-01-01', '0', '0', 'EMRAN HASAN', NULL, 'JOBIUR RAHAMAN', NULL, 'FULSURA BIBI', NULL, '2012-11-21', NULL, NULL, NULL, NULL, NULL, '8972445562', '', NULL, NULL, NULL, 'INDIAN', '34423884816', 'SBIN0009463', NULL, NULL, NULL, 2, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '63', NULL, NULL),
(420, '01475619000029', 0, 0, '2024-01-01', '0', '0', 'FATEMA KHATUN', NULL, 'HAJIKUL ISLAM', NULL, 'JOSNARA BIBI', NULL, '2012-10-15', NULL, NULL, NULL, NULL, NULL, '9679215372', '', NULL, NULL, NULL, 'INDIAN', '41524847912', 'SBIN0008006', NULL, NULL, NULL, 2, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '40', NULL, NULL),
(421, '05312719000023', 0, 0, '2024-01-01', '0', '0', 'HABIBA KHATUN', NULL, 'HASIM SK', NULL, 'JHARNA BIBI', NULL, '2012-04-14', NULL, NULL, NULL, NULL, NULL, '9382973968', '', NULL, NULL, NULL, 'INDIAN', '5021021422343', 'PUNB0RRBBGB', NULL, NULL, NULL, 2, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '32', NULL, NULL),
(422, '05839721000010', 0, 0, '2024-01-01', '0', '0', 'HANIFA KHATUN', NULL, 'HAJEKUL ISLAM', NULL, 'JAMINA BIBI', NULL, '2011-11-26', NULL, NULL, NULL, NULL, NULL, '8514975928', '', NULL, NULL, NULL, 'INDIAN', '5021021531116', 'PUNB0RRBBGB', NULL, NULL, NULL, 2, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '57', NULL, NULL),
(423, '01475619000041', 0, 0, '2024-01-01', '0', '0', 'HENA KHATUN', NULL, 'RUBEL SK', NULL, 'AKHTARUNNESHA BIBI', NULL, '2012-10-16', NULL, NULL, NULL, NULL, NULL, '9134530180', '', NULL, NULL, NULL, 'INDIAN', '1532101700049247', 'PUNB0153210', NULL, NULL, NULL, 2, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6', NULL, NULL),
(424, '05839621000026', 0, 0, '2024-01-01', '0', '0', 'ISAN ALI', NULL, 'MAJIBUR RAHAMAN', NULL, 'SHAKINA BIBI', NULL, '2013-04-03', NULL, NULL, NULL, NULL, NULL, '8927008075', '', NULL, NULL, NULL, 'INDIAN', '20483342706', 'SBIN0008006', NULL, NULL, NULL, 2, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '58', NULL, NULL),
(425, '05312819000438', 0, 0, '2024-01-01', '0', '0', 'ISMAIL SK', NULL, 'ASRAUL HQ', NULL, 'SABINA BIBI', NULL, '2012-12-16', NULL, NULL, NULL, NULL, NULL, '6297324930', '', NULL, NULL, NULL, 'INDIAN', '35953619653', 'SBIN0008006', NULL, NULL, NULL, 2, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '59', NULL, NULL),
(426, '01475519000122', 0, 0, '2024-01-01', '0', '0', 'ISMAIL SK', NULL, 'BULET', NULL, 'ANJURA BIBI', NULL, '2012-04-26', NULL, NULL, NULL, NULL, NULL, '7602040992', '', NULL, NULL, NULL, 'INDIAN', '5021010029999', 'PUNB0RRBBGB', NULL, NULL, NULL, 2, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '34', NULL, NULL),
(427, '05313219000045', 0, 0, '2024-01-01', '0', '0', 'ISMITA KHATUN', NULL, 'YOUSUF SK', NULL, 'RAHELA BIBI', NULL, '2012-05-06', NULL, NULL, NULL, NULL, NULL, '9062027040', '', NULL, NULL, NULL, 'INDIAN', '33862765330', 'SBIN0008006', NULL, NULL, NULL, 2, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '50', NULL, NULL),
(428, '05313219000051', 0, 0, '2024-01-01', '0', '0', 'IZAZ SARKAR', NULL, 'KABIR RAHAMAN', NULL, 'ROJINA BIBI', NULL, '2012-05-15', NULL, NULL, NULL, NULL, NULL, '8145284258', '', NULL, NULL, NULL, 'INDIAN', '5021030000302', 'PUNB0RRBBGB', NULL, NULL, NULL, 2, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '3', NULL, NULL),
(429, '01475519000128', 0, 0, '2024-01-01', '0', '0', 'JESMINA', NULL, 'SENTU SK', NULL, 'TAHAMINA KHATUN BIBI', NULL, '2012-11-21', NULL, NULL, NULL, NULL, NULL, '8371897778', '', NULL, NULL, NULL, 'INDIAN', '1532101700050137', 'PUNB0153210', NULL, NULL, NULL, 2, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '48', NULL, NULL),
(430, '05313219000053', 0, 0, '2024-01-01', '0', '0', 'JUBAIL SK', NULL, 'MAJRUL', NULL, 'REKSONA BIBI', NULL, '2012-04-23', NULL, NULL, NULL, NULL, NULL, '9091179859', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 2, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '23', NULL, NULL),
(431, '05313719000049', 0, 0, '2024-01-01', '0', '0', 'MAMONI', NULL, 'NURUL ISLAM', NULL, 'SARBOTI BIBI', NULL, '2012-08-01', NULL, NULL, NULL, NULL, NULL, '7063235619', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 2, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '9', NULL, NULL),
(432, '05313019000044', 0, 0, '2024-01-01', '0', '0', 'MD ATIK HASAN', NULL, 'SABIRUL ISLAM', NULL, 'MOUSUI BIBI', NULL, '2012-01-17', NULL, NULL, NULL, NULL, NULL, '9933766825', '', NULL, NULL, NULL, 'INDIAN', '5021010021997', 'PUNB0RRBBGB', NULL, NULL, NULL, 2, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '54', NULL, NULL),
(433, '05759119000037', 0, 0, '2024-01-01', '0', '0', 'MD MISBAUL HAQUE', NULL, 'MD TAJMAL HAQUE', NULL, 'CHANDMIRA BIBI', NULL, '2012-05-19', NULL, NULL, NULL, NULL, NULL, '9875641687', '', NULL, NULL, NULL, 'INDIAN', '5021010000269', 'PUNB0RRBBGB', NULL, NULL, NULL, 2, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '29', NULL, NULL),
(434, '05312819000425', 0, 0, '2024-01-01', '0', '0', 'MD MOMINUL ISLAM', NULL, 'SOFIKUL ISLAM', NULL, 'MERINA BIBI', NULL, '2012-08-22', NULL, NULL, NULL, NULL, NULL, '8609090078', '', NULL, NULL, NULL, 'INDIAN', '1314201700010187', 'PUNB0042020', NULL, NULL, NULL, 2, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '31', NULL, NULL),
(435, '05313119000058', 0, 0, '2024-01-01', '0', '0', 'MD NASIM ALAM', NULL, 'JAHANGIR ALAM', NULL, 'RASHIDA BIBI', NULL, '2012-01-23', NULL, NULL, NULL, NULL, NULL, '7699160101', '', NULL, NULL, NULL, 'INDIAN', '35866955763', 'SBIN0008006', NULL, NULL, NULL, 2, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '11', NULL, NULL),
(436, '01475519000103', 0, 0, '2024-01-01', '0', '0', 'MD RAFIBILLAH', NULL, 'MD BAKIBILLAH', NULL, 'MST ROSNARA KHATUN BIBI', NULL, '2012-06-11', NULL, NULL, NULL, NULL, NULL, '9641057752', '', NULL, NULL, NULL, 'INDIAN', '1532101700054197', 'PUNB0153210', NULL, NULL, NULL, 2, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', NULL, NULL),
(437, '05839821000019', 0, 0, '2024-01-01', '0', '0', 'MEHERUNNESHA KHATUN', NULL, 'TAIYAB ALI', NULL, 'SHILA BIBI', NULL, '2012-12-25', NULL, NULL, NULL, NULL, NULL, '8597744269', '', NULL, NULL, NULL, 'INDIAN', '33367823047', 'SBIN0008006', NULL, NULL, NULL, 2, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '39', NULL, NULL),
(438, '05312719000026', 0, 0, '2024-01-01', '0', '0', 'MST ANISHA KHATUN', NULL, 'MD ANIKUL HOQUE', NULL, 'DHANUFA BIBI', NULL, '2012-12-20', NULL, NULL, NULL, NULL, NULL, '8116728177', '', NULL, NULL, NULL, 'INDIAN', '33671699351', 'SBIN0008006', NULL, NULL, NULL, 2, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '41', NULL, NULL),
(439, '05839421000022', 0, 0, '2024-01-01', '0', '0', 'MST ROHIDA KHATUN', NULL, 'OSMAN ALI', NULL, 'RAHIMA BIBI', NULL, '2012-08-29', NULL, NULL, NULL, NULL, NULL, '8343080447', '', NULL, NULL, NULL, 'INDIAN', '20461511987', 'SBIN0015048', NULL, NULL, NULL, 2, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '18', NULL, NULL),
(440, '05759119000025', 0, 0, '2024-01-01', '0', '0', 'MUTTAKIN SK', NULL, 'ALIMUDDIN SK', NULL, 'MINARA BIBI', NULL, '2012-01-18', NULL, NULL, NULL, NULL, NULL, '7699246708', '', NULL, NULL, NULL, 'INDIAN', '34975299281', 'SBIN0008006', NULL, NULL, NULL, 2, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '13', NULL, NULL),
(441, '05312819000428', 0, 0, '2024-01-01', '0', '0', 'NANDINI GHOSH', NULL, 'POSANTO GHOSH', NULL, 'SUMITRA GHOSH', NULL, '2011-11-25', NULL, NULL, NULL, NULL, NULL, '7501103400', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 2, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '20', NULL, NULL),
(442, '01475519000086', 0, 0, '2024-01-01', '0', '0', 'NOUREEN ARIFA', NULL, 'MD SARFARAJ NAWAJ', NULL, 'MST ROSNARA KHATUN', NULL, '2012-12-08', NULL, NULL, NULL, NULL, NULL, '9732687709', '', NULL, NULL, NULL, 'INDIAN', '1314200100004114', 'PUNB0131420', NULL, NULL, NULL, 2, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL),
(443, '05839821000024', 0, 0, '2024-01-01', '0', '0', 'NURESHA KHATUN', NULL, 'MANUAR HOSSAIN', NULL, 'REJINA BIBI', NULL, '2012-03-30', NULL, NULL, NULL, NULL, NULL, '7602080514', '', NULL, NULL, NULL, 'INDIAN', '35259831340', 'SBIN0008006', NULL, NULL, NULL, 2, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '19', NULL, NULL),
(444, '05313019000040', 0, 0, '2024-01-01', '0', '0', 'OSIM AKRAM', NULL, 'MOYDUL SK', NULL, 'SUNDARI BIBI', NULL, '2012-01-17', NULL, NULL, NULL, NULL, NULL, '8373875429', '', NULL, NULL, NULL, 'INDIAN', '33726534445', 'SBIN0008006', NULL, NULL, NULL, 2, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '46', NULL, NULL),
(445, '01475519000131', 0, 0, '2024-01-01', '0', '0', 'RAHUL SK', NULL, 'ABDUL HANNAN', NULL, 'MST ALEKA BIBI', NULL, '2012-12-22', NULL, NULL, NULL, NULL, NULL, '9093796434', '', NULL, NULL, NULL, 'INDIAN', '5021019900119', 'PUNB0RRBBGB', NULL, NULL, NULL, 2, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '24', NULL, NULL),
(446, '05839821000023', 0, 0, '2024-01-01', '0', '0', 'RAHUL SK', NULL, 'HAZRAT ALI', NULL, 'TARA BIBI', NULL, '2012-12-08', NULL, NULL, NULL, NULL, NULL, '7074939717', '', NULL, NULL, NULL, 'INDIAN', '5021021278471', 'PUNB0RRBBGB', NULL, NULL, NULL, 2, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '14', NULL, NULL),
(447, '01475519000085', 0, 0, '2024-01-01', '0', '0', 'RAZIA SULTANA', NULL, 'MD JAHANGIR HOSSAIN', NULL, 'MOUSUMI BIBI', NULL, '2012-01-30', NULL, NULL, NULL, NULL, NULL, '9002529071', '', NULL, NULL, NULL, 'INDIAN', '1532101700050599', 'PUNB0153210', NULL, NULL, NULL, 2, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '28', NULL, NULL),
(448, '05313119000056', 0, 0, '2024-01-01', '0', '0', 'RIVANA YEASMIN', NULL, 'HABIBUR RAHMAN', NULL, 'KHADIJA KHATUN BIBI', NULL, '2012-12-25', NULL, NULL, NULL, NULL, NULL, '8609727760', '', NULL, NULL, NULL, 'INDIAN', '5021010040947', 'PUNB0RRBBGB', NULL, NULL, NULL, 2, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '15', NULL, NULL),
(449, '05313719000036', 0, 0, '2024-01-01', '0', '0', 'RIYA', NULL, 'MUSTAKIN', NULL, 'ROHIDA BIBI', NULL, '2012-04-20', NULL, NULL, NULL, NULL, NULL, '8001641230', '', NULL, NULL, NULL, 'INDIAN', '0977010295628', 'PUNB0097720', NULL, NULL, NULL, 2, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8', NULL, NULL),
(450, '05313219000078', 0, 0, '2024-01-01', '0', '0', 'ROHIT SK', NULL, 'LOTIF SK', NULL, 'BARSONA BIBI', NULL, '2012-10-09', NULL, NULL, NULL, NULL, NULL, '8345048522', '', NULL, NULL, NULL, 'INDIAN', '36391241692', 'SBIN0008006', NULL, NULL, NULL, 2, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '44', NULL, NULL),
(451, '05312819000439', 0, 0, '2024-01-01', '0', '0', 'RUMI KHATUN', NULL, 'ALAUDDIN SK', NULL, 'NAGIRA BIBI', NULL, '2012-12-26', NULL, NULL, NULL, NULL, NULL, '7063416074', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 2, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '33', NULL, NULL),
(452, '05313219000046', 0, 0, '2024-01-01', '0', '0', 'RUMI KHATUN', NULL, 'ATTAR SEKH', NULL, 'JANNATUN BIBI', NULL, '2012-02-28', NULL, NULL, NULL, NULL, NULL, '8597309023', '', NULL, NULL, NULL, 'INDIAN', '41524899018', 'SBIN0008006', NULL, NULL, NULL, 2, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '27', NULL, NULL),
(453, '05839821000017', 0, 0, '2024-01-01', '0', '0', 'SABIR', NULL, 'BAKUL SK', NULL, 'SIMA BIBI', NULL, '2012-05-22', NULL, NULL, NULL, NULL, NULL, '8597715510', '', NULL, NULL, NULL, 'INDIAN', '5021010043209', 'PUNB0RRBBGB', NULL, NULL, NULL, 2, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '55', NULL, NULL),
(454, '05313219000038', 0, 0, '2024-01-01', '0', '0', 'SAKIL AHAMED', NULL, 'RUSTAM ALI', NULL, 'MATUARA BIBI', NULL, '2012-05-27', NULL, NULL, NULL, NULL, NULL, '8609406031', '', NULL, NULL, NULL, 'INDIAN', '5351471361', '', NULL, NULL, NULL, 2, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '16', NULL, NULL),
(455, '05312819000442', 0, 0, '2024-01-01', '0', '0', 'SANGITA GHOSH', NULL, 'BANU GHOSH', NULL, 'SUMITRA GHOSH', NULL, '2012-12-05', NULL, NULL, NULL, NULL, NULL, '7699554879', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 2, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '35', NULL, NULL),
(456, '01475519000099', 0, 0, '2024-01-01', '0', '0', 'SHAWON HOSSAIN', NULL, 'MD HAIDAR ALI', NULL, 'MST SAHANAJ PARVIN', NULL, '2012-11-25', NULL, NULL, NULL, NULL, NULL, '7735211424', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 2, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '25', NULL, NULL),
(457, '01475519000132', 0, 0, '2024-01-01', '0', '0', 'SK KUL HASAN', NULL, 'ASADUL ISLAM', NULL, 'AMINA BIBI', NULL, '2012-11-11', NULL, NULL, NULL, NULL, NULL, '8345912276', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 2, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '61', NULL, NULL),
(458, '05312819000445', 0, 0, '2024-01-01', '0', '0', 'SOHEL RANA', NULL, 'TIARUL SK', NULL, 'SUMIJA BIBI', NULL, '2012-03-11', NULL, NULL, NULL, NULL, NULL, '9337908768', '', NULL, NULL, NULL, 'INDIAN', '33982087322', 'SBIN0008006', NULL, NULL, NULL, 2, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '53', NULL, NULL),
(459, '08895119000021', 0, 0, '2024-01-01', '0', '0', 'SUCHITRA MANDAL', NULL, 'SWAPAN MANDAL', NULL, 'AROTI MANDAL', NULL, '2012-02-18', NULL, NULL, NULL, NULL, NULL, '8172076126', '', NULL, NULL, NULL, 'INDIAN', '5021021680199', 'PUNB0RRBBGB', NULL, NULL, NULL, 2, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '37', NULL, NULL),
(460, '05313119000067', 0, 0, '2024-01-01', '0', '0', 'SUHANA PARVIN', NULL, 'REJAUL', NULL, 'SABERA BIBI', NULL, '2012-11-02', NULL, NULL, NULL, NULL, NULL, '9832263067', '', NULL, NULL, NULL, 'INDIAN', '5021021293318', 'PUNB0RRBBGB', NULL, NULL, NULL, 2, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '38', NULL, NULL),
(461, '05839421000025', 0, 0, '2024-01-01', '0', '0', 'SULTANA KHATUN', NULL, 'ANOWAR HOSSAIN', NULL, 'SONALI BIBI', NULL, '2012-03-08', NULL, NULL, NULL, NULL, NULL, '8597703983', '', NULL, NULL, NULL, 'INDIAN', '5021010032735', 'PUNB0RRBBGB', NULL, NULL, NULL, 2, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '26', NULL, NULL),
(462, '05313219000064', 0, 0, '2024-01-01', '0', '0', 'SURAIYA HASAN', NULL, 'SELIM REJA', NULL, 'RUMA BIBI', NULL, '2012-05-07', NULL, NULL, NULL, NULL, NULL, '9933739485', '', NULL, NULL, NULL, 'INDIAN', '5021030001240', 'PUNB0RRBBGB', NULL, NULL, NULL, 2, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '7', NULL, NULL),
(463, '05312819000435', 0, 0, '2024-01-01', '0', '0', 'TAPUR GHOSH', NULL, 'DILIP GHOSH', NULL, 'MAMONI GHOSH', NULL, '2012-05-10', NULL, NULL, NULL, NULL, NULL, '7063416070', '', NULL, NULL, NULL, 'INDIAN', '5351474872', 'CBIN0280122', NULL, NULL, NULL, 2, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '12', NULL, NULL);
INSERT INTO `studentdbs` (`id`, `studentid`, `admBookNo`, `admSlNo`, `admDate`, `prCls`, `prSch`, `name`, `adhaar`, `fname`, `fadhaar`, `mname`, `madhaar`, `dob`, `vill`, `post`, `pstn`, `dist`, `pin`, `mobl`, `ssex`, `phch`, `relg`, `cste`, `natn`, `accNo`, `ifsc`, `micr`, `bnnm`, `brnm`, `stclass_id`, `stsection_id`, `session_id`, `school_id`, `streason`, `enclass_id`, `ensection_id`, `ensession_id`, `enreason`, `crstatus`, `remarks`, `created_at`, `updated_at`) VALUES
(464, '08895119000026', 0, 0, '2024-01-01', '0', '0', 'TITHI MONDAL', NULL, 'SUNIL MONDAL', NULL, 'PARUL MONDAL', NULL, '2012-12-22', NULL, NULL, NULL, NULL, NULL, '8670472516', '', NULL, NULL, NULL, 'INDIAN', '5021010043333', 'PUNB0RRBBGB', NULL, NULL, NULL, 2, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '51', NULL, NULL),
(465, '05313219000048', 0, 0, '2024-01-01', '0', '0', 'TUHINA KHATUN', NULL, 'TOHIJUL HOQUE', NULL, 'ROJINA BIBI', NULL, '2012-07-19', NULL, NULL, NULL, NULL, NULL, '9933665582', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 2, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '21', NULL, NULL),
(466, '05759119000027', 0, 0, '2024-01-01', '0', '0', 'TUJAMMEL HOQUE', NULL, 'ENARUL HOQUE', NULL, 'SUDANA BIBI', NULL, '2012-01-19', NULL, NULL, NULL, NULL, NULL, '8670921086', '', NULL, NULL, NULL, 'INDIAN', '5575010036935', 'PUNB0RRBBGB', NULL, NULL, NULL, 2, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '62', NULL, NULL),
(467, '01475519000130', 0, 0, '2024-01-01', '0', '0', 'UNUS SK', NULL, 'IMAM HOSSAIN', NULL, 'PARUL BIBI', NULL, '2012-08-26', NULL, NULL, NULL, NULL, NULL, '8768010116', '', NULL, NULL, NULL, 'INDIAN', '5021010044280', 'PUNB0RRBBGB', NULL, NULL, NULL, 2, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '45', NULL, NULL),
(468, '05839721000007', 0, 0, '2024-01-01', '0', '0', 'YEAMIN SK', NULL, 'NAIBUR RAHAMAN', NULL, 'MAHARUNNESHA BIBI', NULL, '2012-01-08', NULL, NULL, NULL, NULL, NULL, '9732771008', '', NULL, NULL, NULL, 'INDIAN', '5021010029865', 'PUNB0RRBBGB', NULL, NULL, NULL, 2, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '52', NULL, NULL),
(469, '01475519000091', 0, 0, '2024-01-01', '0', '0', 'YEASMINA KHATUN', NULL, 'ISMAIL', NULL, 'MALINA KHATUN', NULL, '2012-09-27', NULL, NULL, NULL, NULL, NULL, '8609955601', '', NULL, NULL, NULL, 'INDIAN', '1532101700060116', 'PUNB0153210', NULL, NULL, NULL, 2, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '22', NULL, NULL),
(470, '05312819000449', 0, 0, '2024-01-01', '0', '0', 'YEASMIN KHATUN', NULL, 'MAJIBUR RAHAMAN', NULL, 'AFROJA BIBI', NULL, '2011-09-25', NULL, NULL, NULL, NULL, NULL, '8420927562', '', NULL, NULL, NULL, 'INDIAN', '3613950875', 'CBIN0280122', NULL, NULL, NULL, 2, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '17', NULL, NULL),
(471, '01475519000084', 0, 0, '2024-01-01', '0', '0', 'YOUSUF ALI', NULL, 'TARIKUL ISLAM', NULL, 'ANGURA BIBI', NULL, '2012-08-16', NULL, NULL, NULL, NULL, NULL, '7319168710', '', NULL, NULL, NULL, 'INDIAN', '33692953664', 'SBIN0008006', NULL, NULL, NULL, 2, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '56', NULL, NULL),
(472, '05312819000429', 0, 0, '2024-01-01', '0', '0', 'ABU SAFIAN', NULL, 'SARIFUL ISLAM', NULL, 'LUTFUNNESA BIBI', NULL, '2011-12-19', NULL, NULL, NULL, NULL, NULL, '7365021498', '', NULL, NULL, NULL, 'INDIAN', '33671700640', 'SBIN0008006', NULL, NULL, NULL, 2, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '39', NULL, NULL),
(473, '05313719000053', 0, 0, '2024-01-01', '0', '0', 'AMIR HASAN', NULL, 'DURUL ISLAM', NULL, 'BEHULA BIBI', NULL, '2012-12-09', NULL, NULL, NULL, NULL, NULL, '6296535474', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 2, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '23', NULL, NULL),
(474, '05759119000035', 0, 0, '2024-01-01', '0', '0', 'AMIR HASAN', NULL, 'MD KAISAR ALI', NULL, 'SAHIDA BIBI', NULL, '2012-09-29', NULL, NULL, NULL, NULL, NULL, '8512972622', '', NULL, NULL, NULL, 'INDIAN', '35005218500', 'SBIN0008855', NULL, NULL, NULL, 2, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '42', NULL, NULL),
(475, '08895119000031', 0, 0, '2024-01-01', '0', '0', 'ARPITA MANDAL', NULL, 'ARJUN MANDAL', NULL, 'MADHABI MANDAL', NULL, '2012-10-18', NULL, NULL, NULL, NULL, NULL, '9064748278', '', NULL, NULL, NULL, 'INDIAN', '5021010044439', 'PUNB0RRBBGB', NULL, NULL, NULL, 2, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '33', NULL, NULL),
(476, '05839621000023', 0, 0, '2024-01-01', '0', '0', 'AZIZA KHATUN', NULL, 'JIARUL SK', NULL, 'KAMELA BIBI', NULL, '2012-05-25', NULL, NULL, NULL, NULL, NULL, '8001563524', '', NULL, NULL, NULL, 'INDIAN', '20399318995', 'SBIN0008006', NULL, NULL, NULL, 2, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '57', NULL, NULL),
(477, '05313219000050', 0, 0, '2024-01-01', '0', '0', 'CHANDNI KHATUN', NULL, 'SAFIKUL ISLAM', NULL, 'LAILY BIBI', NULL, '2012-12-05', NULL, NULL, NULL, NULL, NULL, '7585955127', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 2, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '54', NULL, NULL),
(478, '05759119000033', 0, 0, '2024-01-01', '0', '0', 'DISHAN SK', NULL, 'KUTUBUDDIN SK', NULL, 'SELINA BIBI', NULL, '2012-12-13', NULL, NULL, NULL, NULL, NULL, '8918789211', '', NULL, NULL, NULL, 'INDIAN', '34782540374', 'SBIN0008855', NULL, NULL, NULL, 2, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '43', NULL, NULL),
(479, '05312819000433', 0, 0, '2024-01-01', '0', '0', 'INJAMUL HOQUE', NULL, 'SAMAUN HOQUE', NULL, 'MUKLESHA BIBI', NULL, '2012-12-24', NULL, NULL, NULL, NULL, NULL, '9734075775', '', NULL, NULL, NULL, 'INDIAN', '36715779022', 'SBIN0008006', NULL, NULL, NULL, 2, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '30', NULL, NULL),
(480, '05312819000427', 0, 0, '2024-01-01', '0', '0', 'ISMAIL SK', NULL, 'SHARIF SK', NULL, 'MONIRA BIBI', NULL, '2012-05-13', NULL, NULL, NULL, NULL, NULL, '9002507416', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 2, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '64', NULL, NULL),
(481, '05312819000430', 0, 0, '2024-01-01', '0', '0', 'JAKIR HOSSAIN', NULL, 'JAMAL SK', NULL, 'JARINA BIBI', NULL, '2012-05-09', NULL, NULL, NULL, NULL, NULL, '8670111542', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 2, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '40', NULL, NULL),
(482, '05313019000035', 0, 0, '2024-01-01', '0', '0', 'JAKIR HOSSAIN', NULL, 'AKBAR ALI', NULL, 'CHHABI BIBI', NULL, '2012-07-24', NULL, NULL, NULL, NULL, NULL, '7074603086', '', NULL, NULL, NULL, 'INDIAN', '38429631166', 'SBIN0015048', NULL, NULL, NULL, 2, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8', NULL, NULL),
(483, '01475519000111', 0, 0, '2024-01-01', '0', '0', 'JIBON HASAN', NULL, 'HAJIKUL ISLAM', NULL, 'ANGURA BIBI', NULL, '2012-07-09', NULL, NULL, NULL, NULL, NULL, '6296847477', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 2, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '36', NULL, NULL),
(484, '05759119000023', 0, 0, '2024-01-01', '0', '0', 'JISAN AHAMED', NULL, 'NUBAN SK', NULL, 'SIMA BIBI', NULL, '2012-02-05', NULL, NULL, NULL, NULL, NULL, '9091896716', '', NULL, NULL, NULL, 'INDIAN', '5021010006207', 'PUNB0RRBBGB', NULL, NULL, NULL, 2, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '41', NULL, NULL),
(485, '05313719000054', 0, 0, '2024-01-01', '0', '0', 'KAIP HOSSAIN', NULL, 'MEHEDI HASSAN', NULL, 'RINA BIBI', NULL, '2012-12-02', NULL, NULL, NULL, NULL, NULL, '9064840538', '', NULL, NULL, NULL, 'INDIAN', '36158612893', 'SBIN0008006', NULL, NULL, NULL, 2, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '18', NULL, NULL),
(486, '05313119000052', 0, 0, '2024-01-01', '0', '0', 'KHAIRUNNESHA', NULL, 'JIABUR SK', NULL, 'SARMINA BIBI', NULL, '2012-02-21', NULL, NULL, NULL, NULL, NULL, '9933443211', '', NULL, NULL, NULL, 'INDIAN', '1532101700049308', 'PUNB0153210', NULL, NULL, NULL, 2, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '27', NULL, NULL),
(487, '05759119000031', 0, 0, '2024-01-01', '0', '0', 'MARIA SULTANA', NULL, 'MAINUDDIN', NULL, 'MANUARA BIBI', NULL, '2012-01-20', NULL, NULL, NULL, NULL, NULL, '9134570032', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 2, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '26', NULL, NULL),
(488, '05839421000021', 0, 0, '2024-01-01', '0', '0', 'MD SAHID SK', NULL, 'ATIKUL SK', NULL, 'HALIMA BIBI', NULL, '2012-01-07', NULL, NULL, NULL, NULL, NULL, '8172076243', '', NULL, NULL, NULL, 'INDIAN', '20390313097', 'SBIN0015048', NULL, NULL, NULL, 2, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '16', NULL, NULL),
(489, '05312819000432', 0, 0, '2024-01-01', '0', '0', 'MD SAINUL ISLAM', NULL, 'ROHIM SK', NULL, 'MARGINA BIBI', NULL, '2012-06-25', NULL, NULL, NULL, NULL, NULL, '8538821731', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 2, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '15', NULL, NULL),
(490, '01475519000127', 0, 0, '2024-01-01', '0', '0', 'MD SAMIM AKTAR', NULL, 'ASLAM SK', NULL, 'REJENA BIBI', NULL, '2012-03-10', NULL, NULL, NULL, NULL, NULL, '9382121853', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 2, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '20', NULL, NULL),
(491, '05311919000108', 0, 0, '2024-01-01', '0', '0', 'MD SAYEED ALI', NULL, 'JIARUL KARIM', NULL, 'SAKHINA BIBI', NULL, '2012-07-11', NULL, NULL, NULL, NULL, NULL, '9382794264', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 2, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '65', NULL, NULL),
(492, '05313119000061', 0, 0, '2024-01-01', '0', '0', 'MIR HASAN AKTAR', NULL, 'SELIM SK', NULL, 'SULTANA BIBI', NULL, '2012-01-29', NULL, NULL, NULL, NULL, NULL, '9647906497', '', NULL, NULL, NULL, 'INDIAN', '33737936050', 'SBIN0008006', NULL, NULL, NULL, 2, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '11', NULL, NULL),
(493, '05313719000050', 0, 0, '2024-01-01', '0', '0', 'MORIOM KHATUN', NULL, 'MD MAHATAB ALI', NULL, 'RUMA BIBI', NULL, '2012-12-19', NULL, NULL, NULL, NULL, NULL, '9093308229', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 2, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '22', NULL, NULL),
(494, '01475519000110', 0, 0, '2024-01-01', '0', '0', 'MST JANNATUNNESA', NULL, 'CHANDRUL SK', NULL, 'MARJINA BIBI', NULL, '2012-03-22', NULL, NULL, NULL, NULL, NULL, '7547959721', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 2, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '60', NULL, NULL),
(495, '09536819002419', 0, 0, '2024-01-01', '0', '0', 'MST MIMI KHATUN', NULL, 'MD MILON SK', NULL, 'AMENA BIBI', NULL, '2013-11-04', NULL, NULL, NULL, NULL, NULL, '6296351183', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 2, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '61', NULL, NULL),
(496, '01475519000118', 0, 0, '2024-01-01', '0', '0', 'MST SOMAIYA YEASMIN', NULL, 'MD SALLAM SK', NULL, 'MST MANUARA BIBI', NULL, '2012-05-24', NULL, NULL, NULL, NULL, NULL, '8478009851', '', NULL, NULL, NULL, 'INDIAN', '1532101700052931', 'PUNB0015320', NULL, NULL, NULL, 2, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6', NULL, NULL),
(497, '02001919000100', 0, 0, '2024-01-01', '0', '0', 'MUBARAK HOSSAIN', NULL, 'ANOWAR HOSSAIN', NULL, 'RUPALI BIBI', NULL, '2012-08-14', NULL, NULL, NULL, NULL, NULL, '9800633920', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 2, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '34', NULL, NULL),
(498, '05312819000447', 0, 0, '2024-01-01', '0', '0', 'MUBARAK SK', NULL, 'JAHANGIR ALAM', NULL, 'SELINA BIBI', NULL, '2012-08-07', NULL, NULL, NULL, NULL, NULL, '9775057726', '', NULL, NULL, NULL, 'INDIAN', '5352018137', 'CBIN0280122', NULL, NULL, NULL, 2, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '9', NULL, NULL),
(499, '05313119000048', 0, 0, '2024-01-01', '0', '0', 'MURSHALIM', NULL, 'AKBAR ALI', NULL, 'SHOBHA BIBI', NULL, '2012-09-28', NULL, NULL, NULL, NULL, NULL, '9333254969', '', NULL, NULL, NULL, 'INDIAN', '38846610219', 'SBIN0015048', NULL, NULL, NULL, 2, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '13', NULL, NULL),
(500, '05312819000424', 0, 0, '2024-01-01', '0', '0', 'NICE SK', NULL, 'MURSALIM SK', NULL, 'PAKHI BIBI', NULL, '2012-09-27', NULL, NULL, NULL, NULL, NULL, '9903400435', '', NULL, NULL, NULL, 'INDIAN', '35277948620', 'SBIN0008006', NULL, NULL, NULL, 2, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '47', NULL, NULL),
(501, '05312819000426', 0, 0, '2024-01-01', '0', '0', 'NISHA GHOSH', NULL, 'JIBON GHOSH', NULL, 'TUKTUKI GHOSH', NULL, '2012-06-20', NULL, NULL, NULL, NULL, NULL, '9647106341', '', NULL, NULL, NULL, 'INDIAN', '35891325026', 'SBIN0008006', NULL, NULL, NULL, 2, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '56', NULL, NULL),
(502, '01475519000133', 0, 0, '2024-01-01', '0', '0', 'NUR AMIN', NULL, 'DILUAR HOSSAIN', NULL, 'RIMA BIBI', NULL, '2012-11-01', NULL, NULL, NULL, NULL, NULL, '8597620908', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 2, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '50', NULL, NULL),
(503, '01475519000104', 0, 0, '2024-01-01', '0', '0', 'NURAMIN SK', NULL, 'HASIBUL ISLAM', NULL, 'SULEKHA BIBI', NULL, '2012-06-29', NULL, NULL, NULL, NULL, NULL, '7319118112', '', NULL, NULL, NULL, 'INDIAN', '1532101700050632', 'PUNB0153210', NULL, NULL, NULL, 2, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '10', NULL, NULL),
(504, '05839621000027', 0, 0, '2024-01-01', '0', '0', 'PARVIN KHATUN', NULL, 'TUZAMMEL HOQUE', NULL, 'KASMIRA BIBI', NULL, '2012-11-07', NULL, NULL, NULL, NULL, NULL, '8391077292', '', NULL, NULL, NULL, 'INDIAN', '35186713408', 'SBIN0008006', NULL, NULL, NULL, 2, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '38', NULL, NULL),
(505, '05311919000084', 0, 0, '2024-01-01', '0', '0', 'PAYEL', NULL, 'JINARUL ISLAM', NULL, 'SUKLEMA BIBI', NULL, '2012-11-20', NULL, NULL, NULL, NULL, NULL, '7595036180', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 2, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '55', NULL, NULL),
(506, '05839821000016', 0, 0, '2024-01-01', '0', '0', 'PAYEL KHATUN', NULL, 'ALAMIN SK', NULL, 'SULTANA BIBI', NULL, '2012-02-28', NULL, NULL, NULL, NULL, NULL, '7501258840', '', NULL, NULL, NULL, 'INDIAN', '41524886418', 'SBIN0008006', NULL, NULL, NULL, 2, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '14', NULL, NULL),
(507, '08895119000022', 0, 0, '2024-01-01', '0', '0', 'PURNIMA MANDAL', NULL, 'SASTHI MANDAL', NULL, 'PABITRA MONDAL', NULL, '2012-03-09', NULL, NULL, NULL, NULL, NULL, '9382415756', '', NULL, NULL, NULL, 'INDIAN', '5021010044396', 'PUNB0RRBBGB', NULL, NULL, NULL, 2, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '28', NULL, NULL),
(508, '05839421000019', 0, 0, '2024-01-01', '0', '0', 'RABIUL ISLAM', NULL, 'JIARUL SEKH', NULL, 'SAMIMA KHATUN', NULL, '2012-12-14', NULL, NULL, NULL, NULL, NULL, '6296793629', '', NULL, NULL, NULL, 'INDIAN', '38615217631', 'SBIN0015048', NULL, NULL, NULL, 2, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '32', NULL, NULL),
(509, '05313119000060', 0, 0, '2024-01-01', '0', '0', 'RAHIMA KHATUN', NULL, 'RABIUL ISLAM', NULL, 'RAKIBA BIBI', NULL, '2012-11-27', NULL, NULL, NULL, NULL, NULL, '7872471552', '', NULL, NULL, NULL, 'INDIAN', '35603033931', 'SBIN0008006', NULL, NULL, NULL, 2, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', NULL, NULL),
(510, '01475519000126', 0, 0, '2024-01-01', '0', '0', 'RAJA MONDAL', NULL, 'CHANDU MONDAL', NULL, 'KALPANA MONDAL', NULL, '2012-09-02', NULL, NULL, NULL, NULL, NULL, '8016006021', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 2, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '52', NULL, NULL),
(511, '08895119000033', 0, 0, '2024-01-01', '0', '0', 'RAJDIP SARKAR', NULL, 'RATAN SARKAR', NULL, 'DAYAMANTI SARKAR', NULL, '2012-11-04', NULL, NULL, NULL, NULL, NULL, '7074286815', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 2, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '25', NULL, NULL),
(512, '01475519000090', 0, 0, '2024-01-01', '0', '0', 'RAKIB SK', NULL, 'SARIFUL ISLAM', NULL, 'FAYEMA BIBI', NULL, '2012-07-30', NULL, NULL, NULL, NULL, NULL, '8343049320', '', NULL, NULL, NULL, 'INDIAN', '5021021632521', 'PUNB0RRBBGB', NULL, NULL, NULL, 2, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '17', NULL, NULL),
(513, '01475519000108', 0, 0, '2024-01-01', '0', '0', 'RAMIJ SK', NULL, 'SELIM SK', NULL, 'LISA BIBI', NULL, '2012-12-25', NULL, NULL, NULL, NULL, NULL, '7384144966', '', NULL, NULL, NULL, 'INDIAN', '1532101700090214', 'PUNB0153210', NULL, NULL, NULL, 2, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL),
(514, '05313219000074', 0, 0, '2024-01-01', '0', '0', 'RAMJAN SK', NULL, 'TARIKUL ISLAM', NULL, 'ISMATARA BIBI', NULL, '2012-08-09', NULL, NULL, NULL, NULL, NULL, '9932379433', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 2, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '37', NULL, NULL),
(515, '08895119000028', 0, 0, '2024-01-01', '0', '0', 'RIJU MONDAL', NULL, 'RAJ KR. MONDAL', NULL, 'FULTUSHI MONDAL', NULL, '2012-09-29', NULL, NULL, NULL, NULL, NULL, '9083404993', '', NULL, NULL, NULL, 'INDIAN', '5021010003546', 'PUNB0RRBBGB', NULL, NULL, NULL, 2, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '7', NULL, NULL),
(516, '05313119000066', 0, 0, '2024-01-01', '0', '0', 'RIMON SK', NULL, 'ALAMIN SK', NULL, 'REXONA BIBI', NULL, '2012-10-11', NULL, NULL, NULL, NULL, NULL, '9382459742', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 2, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '53', NULL, NULL),
(517, '05839821000018', 0, 0, '2024-01-01', '0', '0', 'RITU KHATUN', NULL, 'KADIR ALI', NULL, 'RAKIBA BIBI', NULL, '2012-11-19', NULL, NULL, NULL, NULL, NULL, '9832999429', '', NULL, NULL, NULL, 'INDIAN', '33982162119', 'SBIN0008006', NULL, NULL, NULL, 2, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5', NULL, NULL),
(518, '01475519000098', 0, 0, '2024-01-01', '0', '0', 'ROHIT MANDAL', NULL, 'HIRA MANDAL', NULL, 'RADHA MANDAL', NULL, '2012-11-09', NULL, NULL, NULL, NULL, NULL, '9091907032', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 2, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '49', NULL, NULL),
(519, '05839421000024', 0, 0, '2024-01-01', '0', '0', 'ROJA KHATUN', NULL, 'MUSTAKIM SK', NULL, 'JAHANARA KHATUN', NULL, '2012-01-27', NULL, NULL, NULL, NULL, NULL, '8597703983', '', NULL, NULL, NULL, 'INDIAN', '5021010030922', 'PUNB0RRBBGB', NULL, NULL, NULL, 2, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '12', NULL, NULL),
(520, '01475619000039', 0, 0, '2024-01-01', '0', '0', 'RUBINA KHATUN', NULL, 'RABIUL ISLAM', NULL, 'DILRUBA BIBI', NULL, '2012-03-18', NULL, NULL, NULL, NULL, NULL, '6291516910', '', NULL, NULL, NULL, 'INDIAN', '1532101700054124', 'PUNB0153210', NULL, NULL, NULL, 2, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '31', NULL, NULL),
(521, '05759119000029', 0, 0, '2024-01-01', '0', '0', 'SABNAM YASMIN', NULL, 'ISRAFIL SK', NULL, 'RUNA KHATUN BIBI', NULL, '2012-12-18', NULL, NULL, NULL, NULL, NULL, '6294431032', '', NULL, NULL, NULL, 'INDIAN', '35320066399', 'SBIN0008006', NULL, NULL, NULL, 2, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '21', NULL, NULL),
(522, '05839621000021', 0, 0, '2024-01-01', '0', '0', 'SAFIK SK', NULL, 'DABIRUDDIN SK', NULL, 'AFROJA BIBI', NULL, '2012-12-29', NULL, NULL, NULL, NULL, NULL, '8397876524', '', NULL, NULL, NULL, 'INDIAN', '38619870857', 'SBIN0008006', NULL, NULL, NULL, 2, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4', NULL, NULL),
(523, '05312719000031', 0, 0, '2024-01-01', '0', '0', 'SAJEMA KHATUN', NULL, 'JAHANGIR', NULL, 'JORINA BIBI', NULL, '2012-05-26', NULL, NULL, NULL, NULL, NULL, '8944962428', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 2, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '45', NULL, NULL),
(524, '05839421000023', 0, 0, '2024-01-01', '0', '0', 'SAKIL ANSARI', NULL, 'ABDUL QAYES', NULL, 'MINURA BIBI', NULL, '2011-02-20', NULL, NULL, NULL, NULL, NULL, '8972514072', '', NULL, NULL, NULL, 'INDIAN', '1532101700050979', 'PUNB0153210', NULL, NULL, NULL, 2, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '35', NULL, NULL),
(525, '05313019000056', 0, 0, '2024-01-01', '0', '0', 'SALMA AKTAR', NULL, 'HAQUEDAR SK', NULL, 'FATEMA BIBI', NULL, '2012-11-21', NULL, NULL, NULL, NULL, NULL, '9735483376', '', NULL, NULL, NULL, 'INDIAN', '35663506354', 'SBIN0008856', NULL, NULL, NULL, 2, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '63', NULL, NULL),
(526, '01475519000106', 0, 0, '2024-01-01', '0', '0', 'SALMA KHATUN', NULL, 'SABIRUL ISLAM', NULL, 'MINIARA KHATUN BIBI', NULL, '2012-11-09', NULL, NULL, NULL, NULL, NULL, '8016183955', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 2, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '3', NULL, NULL),
(527, '05329021000056', 0, 0, '2024-01-01', '0', '0', 'SUHANA', NULL, 'SAHIN ALI', NULL, 'SABINA BIBI', NULL, '2012-08-10', NULL, NULL, NULL, NULL, NULL, '6297193146', '', NULL, NULL, NULL, 'INDIAN', '37304373113', 'SBIN0008006', NULL, NULL, NULL, 2, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '24', NULL, NULL),
(528, '08895119000029', 0, 0, '2024-01-01', '0', '0', 'SUJAN MANDAL', NULL, 'SUKUMAR MANDAL', NULL, 'SENOKA MANDAL', NULL, '2012-03-22', NULL, NULL, NULL, NULL, NULL, '7585874731', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 2, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '44', NULL, NULL),
(529, '05311921000133', 0, 0, '2024-01-01', '0', '0', 'SUMAIYA SULTANA', NULL, 'MD SURAJ ISLAM', NULL, 'MAMONI BIBI', NULL, '2012-09-21', NULL, NULL, NULL, NULL, NULL, '7547901761', '', NULL, NULL, NULL, 'INDIAN', '5351992373', 'CBIN0280122', NULL, NULL, NULL, 2, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '62', NULL, NULL),
(530, '05313719000047', 0, 0, '2024-01-01', '0', '0', 'SUMA KHATUN', NULL, 'TARIKUL SK', NULL, 'SARIFA BIBI', NULL, '2012-01-09', NULL, NULL, NULL, NULL, NULL, '8345907300', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 2, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '58', NULL, NULL),
(531, '05313719000044', 0, 0, '2024-01-01', '0', '0', 'SUMAN SK', NULL, 'TARIKUL SK', NULL, 'SARIFA BIBI', NULL, '2012-02-09', NULL, NULL, NULL, NULL, NULL, '8345907300', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 2, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '59', NULL, NULL),
(532, '05313719000032', 0, 0, '2024-01-01', '0', '0', 'TABIAR SK', NULL, 'ROFIKUL ISLAM', NULL, 'TANJILA BIBI', NULL, '2012-01-25', NULL, NULL, NULL, NULL, NULL, '9134575889', '', NULL, NULL, NULL, 'INDIAN', '1532101700055512', 'PUNB0153210', NULL, NULL, NULL, 2, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '46', NULL, NULL),
(533, '05313219000071', 0, 0, '2024-01-01', '0', '0', 'TAHIR HOSSAIN', NULL, 'ALLAM SK', NULL, 'ROJINA BIBI', NULL, '2012-06-03', NULL, NULL, NULL, NULL, NULL, '9933556680', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 2, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '48', NULL, NULL),
(534, '01475519000123', 0, 0, '2024-01-01', '0', '0', 'YUSUF KHAN', NULL, 'FIROJ HOSSAIN', NULL, 'KADBANU BIBI', NULL, '2012-06-26', NULL, NULL, NULL, NULL, NULL, '7699044949', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 2, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '51', NULL, NULL),
(535, '01475519000146', 0, 0, '2024-01-01', '0', '0', 'ABBAS HOSSAIN', NULL, 'SENTU SK', NULL, 'TAHAMINA KHATUN BIBI', NULL, '2011-06-07', NULL, NULL, NULL, NULL, NULL, '8371897787', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 3, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '34', NULL, NULL),
(536, '05313119000069', 0, 0, '2024-01-01', '0', '0', 'AFRIN SULTANA', NULL, 'NABI SK', NULL, 'TASMIRA BIBI', NULL, '2011-04-17', NULL, NULL, NULL, NULL, NULL, '9800415477', '', NULL, NULL, NULL, 'INDIAN', '5238693805', 'CBIN0280122', NULL, NULL, NULL, 3, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '3', NULL, NULL),
(537, '01475519000142', 0, 0, '2024-01-01', '0', '0', 'AFSANA KHATUN', NULL, 'ANSARUL SK', NULL, 'TAMESHA BIBI', NULL, '2011-06-08', NULL, NULL, NULL, NULL, NULL, '9735859297', '', NULL, NULL, NULL, 'INDIAN', '41478436469', 'SBIN0008006', NULL, NULL, NULL, 3, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '49', NULL, NULL),
(538, '05313019000085', 0, 0, '2024-01-01', '0', '0', 'ALAMIN', NULL, 'JAMALUDDIN', NULL, 'AMENA BIBI', NULL, '2011-05-25', NULL, NULL, NULL, NULL, NULL, '7063254544', '', NULL, NULL, NULL, 'INDIAN', '5021020928501', 'PUNB0RRBBGB', NULL, NULL, NULL, 3, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '22', NULL, NULL),
(539, '01475519000136', 0, 0, '2024-01-01', '0', '0', 'ALFIDA KHATUN', NULL, 'MD WAHIDUL ISLAM', NULL, 'MST ROUSANARA KHATUN', NULL, '2011-06-13', NULL, NULL, NULL, NULL, NULL, '7872239114', '', NULL, NULL, NULL, 'INDIAN', '5021030001198', 'PUNB0RRBBGB', NULL, NULL, NULL, 3, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '7', NULL, NULL),
(540, '05839621000042', 0, 0, '2024-01-01', '0', '0', 'ALIARA KHATUN', NULL, 'RABIUL ISLAM', NULL, 'HIRA BIBI', NULL, '2011-08-03', NULL, NULL, NULL, NULL, NULL, '7365911883', '', NULL, NULL, NULL, 'INDIAN', '36385224528', 'SBIN0008006', NULL, NULL, NULL, 3, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '66', NULL, NULL),
(541, '05313119000082', 0, 0, '2024-01-01', '0', '0', 'ARIFA KHATUN', NULL, 'JAHURUL ISLAM', NULL, 'MAMTAJ KHATUN', NULL, '2011-07-26', NULL, NULL, NULL, NULL, NULL, '8670083079', '', NULL, NULL, NULL, 'INDIAN', '1344200100001071', 'PUNB0131420', NULL, NULL, NULL, 3, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '56', NULL, NULL),
(542, '05312719000057', 0, 0, '2024-01-01', '0', '0', 'ARIFUL SK', NULL, 'ASRAFUL SK', NULL, 'SAFATAN BIBI', NULL, '2011-06-20', NULL, NULL, NULL, NULL, NULL, '8972094785', '', NULL, NULL, NULL, 'INDIAN', '5021030000706', 'PUNB0RRBBGB', NULL, NULL, NULL, 3, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '32', NULL, NULL),
(543, '01475519000166', 0, 0, '2024-01-01', '0', '0', 'ARJINA KHATUN', NULL, 'AL AMIN SK', NULL, 'RIPA BIBI', NULL, '2011-08-07', NULL, NULL, NULL, NULL, NULL, '7584994346', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 3, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '77', NULL, NULL),
(544, '05313119000085', 0, 0, '2024-01-01', '0', '0', 'ASARUL ISLAM', NULL, 'HASIBUL ISLAM', NULL, 'DILRUBA BIBI', NULL, '2011-02-24', NULL, NULL, NULL, NULL, NULL, '9093663354', '', NULL, NULL, NULL, 'INDIAN', '1314200100002888', 'PUNB0131420', NULL, NULL, NULL, 3, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '33', NULL, NULL),
(545, '05313019000090', 0, 0, '2024-01-01', '0', '0', 'HASIBA KHATUN', NULL, 'IBRAHIM SK', NULL, 'KHALIDA BIBI', NULL, '2011-03-21', NULL, NULL, NULL, NULL, NULL, '9080987207', '', NULL, NULL, NULL, 'INDIAN', '5021019900399', 'PUNB0RRBBGB', NULL, NULL, NULL, 3, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '19', NULL, NULL),
(546, '01475519000174', 0, 0, '2024-01-01', '0', '0', 'ISMAIL SK', NULL, 'NAJIBUR SK', NULL, 'PARULA BIBI', NULL, '2011-02-18', NULL, NULL, NULL, NULL, NULL, '8609081034', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 3, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '76', NULL, NULL),
(547, '01475519000147', 0, 0, '2024-01-01', '0', '0', 'JESMIN KHATUN', NULL, 'MD BABAR ALI', NULL, 'FARIDA BIBI', NULL, '2011-08-11', NULL, NULL, NULL, NULL, NULL, '8145955549', '', NULL, NULL, NULL, 'INDIAN', '5284647366', 'CBIN0280122', NULL, NULL, NULL, 3, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '25', NULL, NULL),
(548, '05313119000075', 0, 0, '2024-01-01', '0', '0', 'JINNATUNNESHA', NULL, 'JAHIRUDDIN', NULL, 'MOINA BIBI', NULL, '2011-02-10', NULL, NULL, NULL, NULL, NULL, '8116746460', '', NULL, NULL, NULL, 'INDIAN', '5021030000653', 'PUNB0RRBBGB', NULL, NULL, NULL, 3, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '9', NULL, NULL),
(549, '05313119000092', 0, 0, '2024-01-01', '0', '0', 'JONI .', NULL, 'RAJ BAHADUR SK', NULL, 'AMBIA KHATUN BIBI', NULL, '2011-04-28', NULL, NULL, NULL, NULL, NULL, '8167065382', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 3, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '23', NULL, NULL),
(550, '05839821000026', 0, 0, '2024-01-01', '0', '0', 'JULI KHATUN', NULL, 'KAMRUL SK', NULL, 'HOSNARA BIBI', NULL, '2011-10-22', NULL, NULL, NULL, NULL, NULL, '7797120290', '', NULL, NULL, NULL, 'INDIAN', '5021021271478', 'PUNB0RRBBGB', NULL, NULL, NULL, 3, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8', NULL, NULL),
(551, '05313119000081', 0, 0, '2024-01-01', '0', '0', 'KHALIDA KHATUN', NULL, 'NEHERUL', NULL, 'MAYDA BIBI', NULL, '2011-01-27', NULL, NULL, NULL, NULL, NULL, '9635787040', '', NULL, NULL, NULL, 'INDIAN', '5290271528', 'CBIN0280122', NULL, NULL, NULL, 3, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '14', NULL, NULL),
(552, '05313019000083', 0, 0, '2024-01-01', '0', '0', 'KHATIJA KHATUN', NULL, 'NUR ALAM', NULL, 'SARIFA BIBI', NULL, '2011-05-29', NULL, NULL, NULL, NULL, NULL, '7602748767', '', NULL, NULL, NULL, 'INDIAN', '5575010035918', 'PUNB0RRBBGB', NULL, NULL, NULL, 3, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '16', NULL, NULL),
(553, '05313019000092', 0, 0, '2024-01-01', '0', '0', 'MAMONI KHATUN', NULL, 'NAJRUL ISLAM', NULL, 'JHUMA BIBI', NULL, '2011-07-06', NULL, NULL, NULL, NULL, NULL, '8918771147', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 3, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '58', NULL, NULL),
(554, '01475519000167', 0, 0, '2024-01-01', '0', '0', 'MAMUNI KHATUN', NULL, 'SAHIN SK', NULL, 'SULEKHA BIBI', NULL, '2011-10-30', NULL, NULL, NULL, NULL, NULL, '7319118109', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 3, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '73', NULL, NULL),
(555, '05312719000046', 0, 0, '2024-01-01', '0', '0', 'MD. ALAM SK', NULL, 'GOLAM MURTUJA', NULL, 'JHUMA BIBI', NULL, '2011-09-10', NULL, NULL, NULL, NULL, NULL, '7602277610', '', NULL, NULL, NULL, 'INDIAN', '5021010044378', 'PUNB0RRBBGB', NULL, NULL, NULL, 3, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '48', NULL, NULL),
(556, '01475519000153', 0, 0, '2024-01-01', '0', '0', 'MD RAWAN HOSSAIN', NULL, 'ANUWAR HOSSAIN', NULL, 'REHENA BIBI', NULL, '2011-11-07', NULL, NULL, NULL, NULL, NULL, '8371836272', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 3, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '45', NULL, NULL),
(557, '05313119000093', 0, 0, '2024-01-01', '0', '0', 'MD SOHEL RANA', NULL, 'MD SELIM REJA', NULL, 'AMINA BIBI', NULL, '2011-01-15', NULL, NULL, NULL, NULL, NULL, '9163439577', '', NULL, NULL, NULL, 'INDIAN', '5021030000267', 'PUNB0RRBBGB', NULL, NULL, NULL, 3, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '54', NULL, NULL),
(558, '01475519000145', 0, 0, '2024-01-01', '0', '0', 'MD TUSHAR', NULL, 'MD SAMAUN', NULL, 'TUHINA BIBI', NULL, '2011-08-02', NULL, NULL, NULL, NULL, NULL, '9832275720', '', NULL, NULL, NULL, 'INDIAN', '1314201700007811', 'PUNB0131420', NULL, NULL, NULL, 3, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '10', NULL, NULL),
(559, '05839821000028', 0, 0, '2024-01-01', '0', '0', 'MEHEDI HOSSAIN', NULL, 'SAHEB ALI', NULL, 'NAYANTARA BIBI', NULL, '2011-09-09', NULL, NULL, NULL, NULL, NULL, '9593913411', '', NULL, NULL, NULL, 'INDIAN', '32131735111', 'SBIN0008006', NULL, NULL, NULL, 3, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '38', NULL, NULL),
(560, '05313019000081', 0, 0, '2024-01-01', '0', '0', 'MOHAIMINA KHATUN', NULL, 'MIJANUR RAHAMAN', NULL, 'SHIKHA ARBI', NULL, '2011-07-11', NULL, NULL, NULL, NULL, NULL, '8670920969', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 3, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6', NULL, NULL),
(561, '05313219000130', 0, 0, '2024-01-01', '0', '0', 'MONIRUL ISLAM', NULL, 'RAFIKUL ISLAM', NULL, 'MAYNA BIBI', NULL, '2011-08-22', NULL, NULL, NULL, NULL, NULL, '8001166807', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 3, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '41', NULL, NULL),
(562, '01475519000144', 0, 0, '2024-01-01', '0', '0', 'MORSALIM SK', NULL, 'SAHAJAMAL SK', NULL, 'MAINA BIBI', NULL, '2011-11-29', NULL, NULL, NULL, NULL, NULL, '9091325674', '', NULL, NULL, NULL, 'INDIAN', '1532101700041476', 'PUNB0153210', NULL, NULL, NULL, 3, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '15', NULL, NULL),
(563, '05313119000087', 0, 0, '2024-01-01', '0', '0', 'MST ANU KHATUN', NULL, 'MASUD ALI', NULL, 'KADIJA KHATUN', NULL, '2011-11-08', NULL, NULL, NULL, NULL, NULL, '8145967430', '', NULL, NULL, NULL, 'INDIAN', '1532101700100542', 'PUNB0153210', NULL, NULL, NULL, 3, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '57', NULL, NULL),
(564, '01783522002035', 0, 0, '2024-01-01', '0', '0', 'MST FIHA NAZMIN', NULL, 'MD MOMIN', NULL, 'MST NASIMA KHATUN', NULL, '2012-01-31', NULL, NULL, NULL, NULL, NULL, '9733839155', '', NULL, NULL, NULL, 'INDIAN', '5021021412604', 'PUNB0RRBBGB', NULL, NULL, NULL, 3, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '20', NULL, NULL),
(565, '01475519000185', 0, 0, '2024-01-01', '0', '0', 'MST HAZERA KHATUN', NULL, 'SALAUDDIN', NULL, 'MERINA BIBI', NULL, '2011-06-28', NULL, NULL, NULL, NULL, NULL, '6291056271', '', NULL, NULL, NULL, 'INDIAN', '5021010044192', 'PUNB0RRBBGB', NULL, NULL, NULL, 3, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '30', NULL, NULL),
(566, '05839721000017', 0, 0, '2024-01-01', '0', '0', 'MST SAMA AFRIN', NULL, 'JAHIRUDDIN SK', NULL, 'TARJINA BIBI', NULL, '2011-08-10', NULL, NULL, NULL, NULL, NULL, '9091212506', '', NULL, NULL, NULL, 'INDIAN', '5021010017930', 'PUNB0RRBBGB', NULL, NULL, NULL, 3, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '60', NULL, NULL),
(567, '01475519000164', 0, 0, '2024-01-01', '0', '0', 'MST SONIA KHATUN', NULL, 'TARAJUL ISLAM', NULL, 'LILA BIBI', NULL, '2011-02-01', NULL, NULL, NULL, NULL, NULL, '9547174456', '', NULL, NULL, NULL, 'INDIAN', '5021010048082', 'PUNB0RRBBGB', NULL, NULL, NULL, 3, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '69', NULL, NULL),
(568, '05313219000122', 0, 0, '2024-01-01', '0', '0', 'MST TANJILA KHATUN', NULL, 'RAHIM SK', NULL, 'KAMELA BIBI', NULL, '2011-01-04', NULL, NULL, NULL, NULL, NULL, '9091588428', '', NULL, NULL, NULL, 'INDIAN', '5021010039127', 'PUNB0RRBBGB', NULL, NULL, NULL, 3, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '28', NULL, NULL),
(569, '05313219000128', 0, 0, '2024-01-01', '0', '0', 'MURAD', NULL, 'ABDUL HALIM', NULL, 'SARJINA BIBI', NULL, '2011-08-25', NULL, NULL, NULL, NULL, NULL, '8420145541', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 3, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '62', NULL, NULL),
(570, '05839621000045', 0, 0, '2024-01-01', '0', '0', 'NAJMA SULTANA', NULL, 'NAJMOL HAQUE', NULL, 'RUPSONA BIBI', NULL, '2011-12-25', NULL, NULL, NULL, NULL, NULL, '9641782277', '', NULL, NULL, NULL, 'INDIAN', '2021021697046', 'PUNB0RRBBGB', NULL, NULL, NULL, 3, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '39', NULL, NULL),
(571, '05839521000061', 0, 0, '2024-01-01', '0', '0', 'NASRIN KHATUN', NULL, 'NASIR SK', NULL, 'SHILA BIBI', NULL, '2011-08-23', NULL, NULL, NULL, NULL, NULL, '6290054508', '', NULL, NULL, NULL, 'INDIAN', '5021020000052', 'PUNB0RRBBGB', NULL, NULL, NULL, 3, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '42', NULL, NULL),
(572, '05839621000035', 0, 0, '2024-01-01', '0', '0', 'NAYEEM SK', NULL, 'HAJIKUL ISLAM', NULL, 'RUBINA BIBI', NULL, '2011-08-27', NULL, NULL, NULL, NULL, NULL, '9635121360', '', NULL, NULL, NULL, 'INDIAN', '5161696483', 'CBIN0280122', NULL, NULL, NULL, 3, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '59', NULL, NULL),
(573, '05839721000021', 0, 0, '2024-01-01', '0', '0', 'NUR AMIN', NULL, 'NAJIBUR RAHAMAN', NULL, 'JINNATUN NESHA', NULL, '2011-08-23', NULL, NULL, NULL, NULL, NULL, '7384743903', '', NULL, NULL, NULL, 'INDIAN', '33671699918', 'SBIN0008006', NULL, NULL, NULL, 3, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '71', NULL, NULL),
(574, '01475519000163', 0, 0, '2024-01-01', '0', '0', 'PRIYA KHATUN', NULL, 'TIARUL ISLAM', NULL, 'JHARNA BIBI', NULL, '2011-02-04', NULL, NULL, NULL, NULL, NULL, '9734330915', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 3, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '68', NULL, NULL),
(575, '01475519000165', 0, 0, '2024-01-01', '0', '0', 'RABIUL AWAL', NULL, 'HABIBUR RAHAMAN', NULL, 'MIRA BIBI', NULL, '2011-02-22', NULL, NULL, NULL, NULL, NULL, '8670472729', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 3, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '50', NULL, NULL),
(576, '05312919000049', 0, 0, '2024-01-01', '0', '0', 'RAFIKA KHATUN', NULL, 'MD ROFIQUL ISLAM', NULL, 'SADHANA BIBI', NULL, '2011-11-09', NULL, NULL, NULL, NULL, NULL, '8972644504', '', NULL, NULL, NULL, 'INDIAN', '5021010012759', 'PUNB0RRBBGB', NULL, NULL, NULL, 3, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '81', NULL, NULL),
(577, '01475519000155', 0, 0, '2024-01-01', '0', '0', 'RAFINA YEASMIN', NULL, 'SAKIMUDDIN', NULL, 'RUBA BIBI', NULL, '2011-10-10', NULL, NULL, NULL, NULL, NULL, '9679815609', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 3, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '37', NULL, NULL),
(578, '01475519000141', 0, 0, '2024-01-01', '0', '0', 'RAHID SHAIKH', NULL, 'MANNAN SK', NULL, 'RUNA BIBI', NULL, '2011-05-11', NULL, NULL, NULL, NULL, NULL, '9064086965', '', NULL, NULL, NULL, 'INDIAN', '0977010328845', 'PUNB0097720', NULL, NULL, NULL, 3, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '26', NULL, NULL),
(579, '05839621000038', 0, 0, '2024-01-01', '0', '0', 'RAJIA SULTANA', NULL, 'BASIR SK', NULL, 'RINA BIBI', NULL, '2011-06-03', NULL, NULL, NULL, NULL, NULL, '6294812256', '', NULL, NULL, NULL, 'INDIAN', '5150862465', 'CBIN0280122', NULL, NULL, NULL, 3, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '64', NULL, NULL),
(580, '05313019000101', 0, 0, '2024-01-01', '0', '0', 'RAJIYA SULTANA', NULL, 'MD. BABAR ALI', NULL, 'RIMA KHATUN', NULL, '2011-04-28', NULL, NULL, NULL, NULL, NULL, '9733675825', '', NULL, NULL, NULL, 'INDIAN', '5021021692218', 'PUNB0RRBBGB', NULL, NULL, NULL, 3, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '12', NULL, NULL),
(581, '05313119000095', 0, 0, '2024-01-01', '0', '0', 'RIPAN SK', NULL, 'NAZRUL ISLAM', NULL, 'ADARA BIBI', NULL, '2011-12-21', NULL, NULL, NULL, NULL, NULL, '7866041446', '', NULL, NULL, NULL, 'INDIAN', '5266832474', 'CBIN0280122', NULL, NULL, NULL, 3, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '72', NULL, NULL),
(582, '05313119000079', 0, 0, '2024-01-01', '0', '0', 'RISTA KHATUN', NULL, 'SAMIM SK', NULL, 'RAKIBA BIBI', NULL, '2011-11-10', NULL, NULL, NULL, NULL, NULL, '9933542425', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 3, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '43', NULL, NULL),
(583, '05313119000077', 0, 0, '2024-01-01', '0', '0', 'ROHIT ISLAM', NULL, 'ISMILE', NULL, 'DIPALI BIBI', NULL, '2011-02-06', NULL, NULL, NULL, NULL, NULL, '8116913989', '', NULL, NULL, NULL, 'INDIAN', '5021010034593', 'PUNB0RRBBGB', NULL, NULL, NULL, 3, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '29', NULL, NULL),
(584, '05312919000045', 0, 0, '2024-01-01', '0', '0', 'ROJONI KHATUN', NULL, 'MD ALAMGIR SK', NULL, 'AMINA BIBI', NULL, '2011-09-14', NULL, NULL, NULL, NULL, NULL, '9932075192', '', NULL, NULL, NULL, 'INDIAN', '20434470112', 'SBIN0015048', NULL, NULL, NULL, 3, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '80', NULL, NULL),
(585, '05313119000080', 0, 0, '2024-01-01', '0', '0', 'SABNAM AKTAR', NULL, 'SAMSUL HOQUE', NULL, 'HASHINA BIBI', NULL, '2011-12-15', NULL, NULL, NULL, NULL, NULL, '9647027343', '', NULL, NULL, NULL, 'INDIAN', '1314200100002772', 'PUNB0042020', NULL, NULL, NULL, 3, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '17', NULL, NULL),
(586, '05839721000020', 0, 0, '2024-01-01', '0', '0', 'SADIYA KHATUN', NULL, 'TIARUL ISLAM', NULL, 'JENIFA BIBI', NULL, '2011-11-15', NULL, NULL, NULL, NULL, NULL, '8343050801', '', NULL, NULL, NULL, 'INDIAN', '41387941241', 'SBIN0015048', NULL, NULL, NULL, 3, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5', NULL, NULL),
(587, '05313119000074', 0, 0, '2024-01-01', '0', '0', 'SAGIR', NULL, 'SAMSUL HOQUE', NULL, 'TARJIMA BIBI', NULL, '2011-01-07', NULL, NULL, NULL, NULL, NULL, '8346922610', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 3, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '74', NULL, NULL),
(588, '05839621000028', 0, 0, '2024-01-01', '0', '0', 'SAGIR HOSSAIN', NULL, 'MILTON SK', NULL, 'RABIA BIBI', NULL, '2011-11-14', NULL, NULL, NULL, NULL, NULL, '8116857219', '', NULL, NULL, NULL, 'INDIAN', '34625111121', 'SBIN0008006', NULL, NULL, NULL, 3, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '75', NULL, NULL),
(589, '01475519000143', 0, 0, '2024-01-01', '0', '0', 'SAH ALAM', NULL, 'AMIRUL ISLAM', NULL, 'SAYERA BIBI', NULL, '2011-12-29', NULL, NULL, NULL, NULL, NULL, '7076950812', '', NULL, NULL, NULL, 'INDIAN', '5236162683', 'CBIN0280122', NULL, NULL, NULL, 3, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '11', NULL, NULL),
(590, '05311919000247', 0, 0, '2024-01-01', '0', '0', 'SAHIDA PARVIN', NULL, 'MAINUL HAQUE', NULL, 'NURJAHAN BIBI', NULL, '2011-11-06', NULL, NULL, NULL, NULL, NULL, '7407348229', '', NULL, NULL, NULL, 'INDIAN', '1314010101418', 'PUNB0131420', NULL, NULL, NULL, 3, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '82', NULL, NULL),
(591, '01475519000179', 0, 0, '2024-01-01', '0', '0', 'SAHID SK', NULL, 'EKBAR ALI', NULL, 'SANTONA BIBI', NULL, '2011-09-15', NULL, NULL, NULL, NULL, NULL, '7331894621', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 3, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '79', NULL, NULL),
(592, '05759119000052', 0, 0, '2024-01-01', '0', '0', 'SAHINA AKHTAR', NULL, 'SADDAM HOSSAIN', NULL, 'JINNATUN BIBI', NULL, '2011-11-21', NULL, NULL, NULL, NULL, NULL, '6610126870', '', NULL, NULL, NULL, 'INDIAN', '421318210003112', 'BKID0004213', NULL, NULL, NULL, 3, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '61', NULL, NULL),
(593, '05313219000157', 0, 0, '2024-01-01', '0', '0', 'SAHINA KHATUN', NULL, 'SARIFUL ISLAM', NULL, 'MAYNA BIBI', NULL, '2011-02-19', NULL, NULL, NULL, NULL, NULL, '9732517183', '', NULL, NULL, NULL, 'INDIAN', '5291237757', 'CBIN0280122', NULL, NULL, NULL, 3, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '65', NULL, NULL),
(594, '05313019000086', 0, 0, '2024-01-01', '0', '0', 'SAKIB SEKH', NULL, 'SAIDUL ISLAM', NULL, 'CHANSURA BIBI', NULL, '2011-02-19', NULL, NULL, NULL, NULL, NULL, '8016518034', '', NULL, NULL, NULL, 'INDIAN', '33591604695', 'SBIN0008006', NULL, NULL, NULL, 3, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '31', NULL, NULL),
(595, '01475519000169', 0, 0, '2024-01-01', '0', '0', 'SAMIMA KHATUN', NULL, 'ABDUS SALAM', NULL, 'AOWLIA BIBI', NULL, '2011-11-02', NULL, NULL, NULL, NULL, NULL, '7063362010', '', NULL, NULL, NULL, 'INDIAN', '1532101700043137', 'PUNB0153210', NULL, NULL, NULL, 3, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '36', NULL, NULL),
(596, '05313119000073', 0, 0, '2024-01-01', '0', '0', 'SANIYA KHATUN', NULL, 'JAHARUL ISLAM', NULL, 'SUKLEMA BIBI', NULL, '2011-02-07', NULL, NULL, NULL, NULL, NULL, '8972487687', '', NULL, NULL, NULL, 'INDIAN', '5021019900544', 'PUNB0RRBBGB', NULL, NULL, NULL, 3, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '18', NULL, NULL),
(597, '05313019000089', 0, 0, '2024-01-01', '0', '0', 'SATHI  KHATUN', NULL, 'SAJAHAN SK', NULL, 'SUMA BIBI', NULL, '2011-03-09', NULL, NULL, NULL, NULL, NULL, '8967917823', '', NULL, NULL, NULL, 'INDIAN', '1532101700042086', 'PUNB0153210', NULL, NULL, NULL, 3, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '24', NULL, NULL),
(598, '01475519000170', 0, 0, '2024-01-01', '0', '0', 'SAYAN MONDAL', NULL, 'GANESH CHANDRA MONDAL', NULL, 'SARATHI MONDAL', NULL, '2011-07-30', NULL, NULL, NULL, NULL, NULL, '7872189766', '', NULL, NULL, NULL, 'INDIAN', '5291626743', 'CBIN0280122', NULL, NULL, NULL, 3, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '40', NULL, NULL),
(599, '01475519000160', 0, 0, '2024-01-01', '0', '0', 'SEJJEMA KHATUN', NULL, 'SEKBAR ALI', NULL, 'KHAIRUNNESA BIBI', NULL, '2011-06-08', NULL, NULL, NULL, NULL, NULL, '9093819867', '', NULL, NULL, NULL, 'INDIAN', '5290272838', 'CBIN0280122', NULL, NULL, NULL, 3, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '55', NULL, NULL),
(600, '05839721000019', 0, 0, '2024-01-01', '0', '0', 'SIMRAN AKTAR', NULL, 'MD SAMSUZZOHA', NULL, 'TUHINA KHATUN', NULL, '2011-06-14', NULL, NULL, NULL, NULL, NULL, '9800414465', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 3, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', NULL, NULL),
(601, '01475519000159', 0, 0, '2024-01-01', '0', '0', 'SOKHINA KHATUN', NULL, 'MILTON SK', NULL, 'SHILPI BIBI', NULL, '2011-07-11', NULL, NULL, NULL, NULL, NULL, '8538802980', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 3, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '35', NULL, NULL),
(602, '05313119000086', 0, 0, '2024-01-01', '0', '0', 'SONALI KHATUN', NULL, 'HASIBUL ISLAM', NULL, 'JORINA BIBI', NULL, '2011-09-15', NULL, NULL, NULL, NULL, NULL, '8597892379', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 3, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '44', NULL, NULL),
(603, '01475519000137', 0, 0, '2024-01-01', '0', '0', 'SONALI SHIL', NULL, 'PALASH KUMAR SHIL', NULL, 'DIPIKA SHIL', NULL, '2011-11-10', NULL, NULL, NULL, NULL, NULL, '9775540860', '', NULL, NULL, NULL, 'INDIAN', '5021010042006', 'PUNB0RRBBGB', NULL, NULL, NULL, 3, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4', NULL, NULL),
(604, '05313219000146', 0, 0, '2024-01-01', '0', '0', 'SONIA KHATUN', NULL, 'SAHEB SK', NULL, 'SUMERA BIBI', NULL, '2011-09-10', NULL, NULL, NULL, NULL, NULL, '7636998739', '', NULL, NULL, NULL, 'INDIAN', '5021010030612', 'PUNB0RRBBGB', NULL, NULL, NULL, 3, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '78', NULL, NULL),
(605, '05313019000093', 0, 0, '2024-01-01', '0', '0', 'SRABANI KHATUN', NULL, 'SEKBAR ALI', NULL, 'KHAIRUNNESA BIBI', NULL, '2011-12-28', NULL, NULL, NULL, NULL, NULL, '8145180459', '', NULL, NULL, NULL, 'INDIAN', '5021020000962', 'PUNB0RRBBGB', NULL, NULL, NULL, 3, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '63', NULL, NULL),
(606, '08895119000052', 0, 0, '2024-01-01', '0', '0', 'SUBAL MONDAL', NULL, 'MODHU SUDAN MONDAL', NULL, 'BANDONA MONDAL', NULL, '2011-11-24', NULL, NULL, NULL, NULL, NULL, '7319126303', '', NULL, NULL, NULL, 'INDIAN', '5021010044341', 'PUNB0RRBBGB', NULL, NULL, NULL, 3, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '67', NULL, NULL),
(607, '05313119000071', 0, 0, '2024-01-01', '0', '0', 'SUHANA ALAM', NULL, 'HAJEKUL ALAM', NULL, 'CHAMPA BIBI', NULL, '2011-06-08', NULL, NULL, NULL, NULL, NULL, '6297738606', '', NULL, NULL, NULL, 'INDIAN', '41212933850', 'SBIN0015048', NULL, NULL, NULL, 3, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '21', NULL, NULL),
(608, '05313119000078', 0, 0, '2024-01-01', '0', '0', 'SUMA KHATUN', NULL, 'MAHATAB SK', NULL, 'JABA BIBI', NULL, '2011-01-13', NULL, NULL, NULL, NULL, NULL, '9734241906', '', NULL, NULL, NULL, 'INDIAN', '5021030000703', 'PUNB0RRBBGB', NULL, NULL, NULL, 3, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '47', NULL, NULL),
(609, '05313019000100', 0, 0, '2024-01-01', '0', '0', 'TAJMIRA KHATUN', NULL, 'TAJRUL SK', NULL, 'SARJINA BIBI', NULL, '2011-08-20', NULL, NULL, NULL, NULL, NULL, '8145518983', '', NULL, NULL, NULL, 'INDIAN', '5021010018230', 'PUNB0RRBBGB', NULL, NULL, NULL, 3, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '46', NULL, NULL),
(610, '05313219000135', 0, 0, '2024-01-01', '0', '0', 'TITHI KHATUN', NULL, 'ABDUL HAMID', NULL, 'JESHMIN BIBI', NULL, '2011-06-06', NULL, NULL, NULL, NULL, NULL, '8967553809', '', NULL, NULL, NULL, 'INDIAN', '5351472354', 'CBIN0280122', NULL, NULL, NULL, 3, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '51', NULL, NULL),
(611, '05313219000145', 0, 0, '2024-01-01', '0', '0', 'TUHIN SK', NULL, 'TOHIJUL SK', NULL, 'ROJINA BIBI', NULL, '2011-05-24', NULL, NULL, NULL, NULL, NULL, '7047158431', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 3, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '70', NULL, NULL),
(612, '01475519000161', 0, 0, '2024-01-01', '0', '0', 'YOUSAF NOBI', NULL, 'DILBAR SK', NULL, 'JYOSTNA BIBI', NULL, '2011-12-28', NULL, NULL, NULL, NULL, NULL, '7365005577', '', NULL, NULL, NULL, 'INDIAN', '5290795188', 'CBIN0280122', NULL, NULL, NULL, 3, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '53', NULL, NULL),
(613, '05839721000016', 0, 0, '2024-01-01', '0', '0', 'ABDUL KADIR', NULL, 'JOYNAL ABEDIN', NULL, 'SIRINA BIBI', NULL, '2012-07-07', NULL, NULL, NULL, NULL, NULL, '8513958320', '', NULL, NULL, NULL, 'INDIAN', '5021010029360', 'PUNB0RRBBGB', NULL, NULL, NULL, 3, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '32', NULL, NULL),
(614, '01475519000150', 0, 0, '2024-01-01', '0', '0', 'ABDULLA .', NULL, 'JUEL HOSSAIN', NULL, 'LAILA BIBI', NULL, '2011-12-24', NULL, NULL, NULL, NULL, NULL, '9163591533', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 3, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '73', NULL, NULL),
(615, '05839621000031', 0, 0, '2024-01-01', '0', '0', 'ABULAK SK', NULL, 'MOSTAKIM SK', NULL, 'SAKHINA BIBI', NULL, '2011-03-08', NULL, NULL, NULL, NULL, NULL, '7797486766', '', NULL, NULL, NULL, 'INDIAN', '5021020000935', 'PUNB0RRBBGB', NULL, NULL, NULL, 3, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '58', NULL, NULL),
(616, '05839421000034', 0, 0, '2024-01-01', '0', '0', 'ABU SURAJ', NULL, 'MD ABDUL LATIF', NULL, 'JINNATUN BIBI', NULL, '2011-12-15', NULL, NULL, NULL, NULL, NULL, '8001072621', '', NULL, NULL, NULL, 'INDIAN', '5575010029351', 'PUNB0RRBBGB', NULL, NULL, NULL, 3, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '13', NULL, NULL),
(617, '01475619000054', 0, 0, '2024-01-01', '0', '0', 'AFSARIA AMIN', NULL, 'RUHUL AMIN', NULL, 'SARIFA BIBI', NULL, '2011-05-23', NULL, NULL, NULL, NULL, NULL, '9382286754', '', NULL, NULL, NULL, 'INDIAN', '5021030000804', 'PUNB0RRBBGB', NULL, NULL, NULL, 3, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '65', NULL, NULL),
(618, '05311919000240', 0, 0, '2024-01-01', '0', '0', 'AKIL HASSAN', NULL, 'MOSTAFA SAIKH', NULL, 'RAHELA BIBI', NULL, '2011-06-28', NULL, NULL, NULL, NULL, NULL, '7477477534', '', NULL, NULL, NULL, 'INDIAN', '1314010103980', 'PUNB0131420', NULL, NULL, NULL, 3, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '81', NULL, NULL);
INSERT INTO `studentdbs` (`id`, `studentid`, `admBookNo`, `admSlNo`, `admDate`, `prCls`, `prSch`, `name`, `adhaar`, `fname`, `fadhaar`, `mname`, `madhaar`, `dob`, `vill`, `post`, `pstn`, `dist`, `pin`, `mobl`, `ssex`, `phch`, `relg`, `cste`, `natn`, `accNo`, `ifsc`, `micr`, `bnnm`, `brnm`, `stclass_id`, `stsection_id`, `session_id`, `school_id`, `streason`, `enclass_id`, `ensection_id`, `ensession_id`, `enreason`, `crstatus`, `remarks`, `created_at`, `updated_at`) VALUES
(619, '05313219000136', 0, 0, '2024-01-01', '0', '0', 'ALO KHATUN', NULL, 'JAHANGIR SK', NULL, 'TANJERA BIBI', NULL, '2011-04-12', NULL, NULL, NULL, NULL, NULL, '8391849130', '', NULL, NULL, NULL, 'INDIAN', '35044334331', 'SBIN0008006', NULL, NULL, NULL, 3, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '30', NULL, NULL),
(620, '05312819000453', 0, 0, '2024-01-01', '0', '0', 'AMENA KHATUN', NULL, 'ROBIUL HOQUE', NULL, 'HAJERA BIBI', NULL, '2011-06-20', NULL, NULL, NULL, NULL, NULL, '9382772377', '', NULL, NULL, NULL, 'INDIAN', '2998269086', 'CBIN0280122', NULL, NULL, NULL, 3, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '71', NULL, NULL),
(621, '05313019000098', 0, 0, '2024-01-01', '0', '0', 'AMINA KHATUN', NULL, 'MOMIN SK', NULL, 'ARINA KHATUN BIBI', NULL, '2011-09-05', NULL, NULL, NULL, NULL, NULL, '7384187923', '', NULL, NULL, NULL, 'INDIAN', '20461834920', 'SBIN0009463', NULL, NULL, NULL, 3, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '62', NULL, NULL),
(622, '05839721000024', 0, 0, '2024-01-01', '0', '0', 'ARJIA KHATUN', NULL, 'ATTAJUL SK', NULL, 'MST DILRUBA KHATUN', NULL, '2011-10-29', NULL, NULL, NULL, NULL, NULL, '9730281643', '', NULL, NULL, NULL, 'INDIAN', '5021019900145', 'PUNB0RRBBGB', NULL, NULL, NULL, 3, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '56', NULL, NULL),
(623, '01783522002031', 0, 0, '2024-01-01', '0', '0', 'BELAL SK', NULL, 'ATIBUR BASAR', NULL, 'MOYNA BIBI', NULL, '2011-04-08', NULL, NULL, NULL, NULL, NULL, '7547962285', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 3, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '45', NULL, NULL),
(624, '05313219000133', 0, 0, '2024-01-01', '0', '0', 'DOLLY KHATUN', NULL, 'DALIM SK', NULL, 'JAYEDA BIBI', NULL, '2011-09-24', NULL, NULL, NULL, NULL, NULL, '9134587701', '', NULL, NULL, NULL, 'INDIAN', '40798874405', 'SBIN0015048', NULL, NULL, NULL, 3, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '18', NULL, NULL),
(625, '05839621000037', 0, 0, '2024-01-01', '0', '0', 'EBADUL SK', NULL, 'ABDUS SALAM', NULL, 'NASURA BIBI', NULL, '2011-04-04', NULL, NULL, NULL, NULL, NULL, '8509890228', '', NULL, NULL, NULL, 'INDIAN', '5290855661', 'CBIN0280122', NULL, NULL, NULL, 3, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '66', NULL, NULL),
(626, '05839621000030', 0, 0, '2024-01-01', '0', '0', 'EBRAHIM SHAIKH', NULL, 'SARIF SK', NULL, 'TULTULI BIBI', NULL, '2012-01-07', NULL, NULL, NULL, NULL, NULL, '7029492270', '', NULL, NULL, NULL, 'INDIAN', '33806953001', 'SBIN0008006', NULL, NULL, NULL, 3, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '59', NULL, NULL),
(627, '01475619000056', 0, 0, '2024-01-01', '0', '0', 'FAHINA KHATUN', NULL, 'FITU SK', NULL, 'JYOSNA BIBI', NULL, '2011-11-19', NULL, NULL, NULL, NULL, NULL, '8967918285', '', NULL, NULL, NULL, 'INDIAN', '5291248793', 'CBIN0280122', NULL, NULL, NULL, 3, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '55', NULL, NULL),
(628, '01475619000059', 0, 0, '2024-01-01', '0', '0', 'FARHAD YEASMIN', NULL, 'NURAMIN SK', NULL, 'JESMIN BIBI', NULL, '2011-09-22', NULL, NULL, NULL, NULL, NULL, '9093224652', '', NULL, NULL, NULL, 'INDIAN', '5021010044183', 'PUNB0RRBBGB', NULL, NULL, NULL, 3, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '28', NULL, NULL),
(629, '05313019000099', 0, 0, '2024-01-01', '0', '0', 'HALIMA KHATUN', NULL, 'AJMAL HOQUE', NULL, 'MAMOTAJ BIBI', NULL, '2011-07-23', NULL, NULL, NULL, NULL, NULL, '7601810264', '', NULL, NULL, NULL, 'INDIAN', '5021021276100', 'PUNB0RRBBGB', NULL, NULL, NULL, 3, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '61', NULL, NULL),
(630, '05839821000031', 0, 0, '2024-01-01', '0', '0', 'HASINA KHATUN', NULL, 'TARIKUL ISLAM', NULL, 'RINA BIBI', NULL, '2011-08-22', NULL, NULL, NULL, NULL, NULL, '8918132014', '', NULL, NULL, NULL, 'INDIAN', '35761747253', 'SBIN0008006', NULL, NULL, NULL, 3, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '25', NULL, NULL),
(631, '01475519000175', 0, 0, '2024-01-01', '0', '0', 'JAMRUL', NULL, 'KAMRUL ISLAM', NULL, 'MINARA BIBI', NULL, '2011-02-26', NULL, NULL, NULL, NULL, NULL, '9732450246', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 3, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '34', NULL, NULL),
(632, '05312719000052', 0, 0, '2024-01-01', '0', '0', 'JANNATUN NESHA', NULL, 'HASAN SK', NULL, 'TARABANU KHATUN', NULL, '2011-06-14', NULL, NULL, NULL, NULL, NULL, '9091961876', '', NULL, NULL, NULL, 'INDIAN', '5021010044156', 'PUNB0RRBBGB', NULL, NULL, NULL, 3, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '42', NULL, NULL),
(633, '05312819000454', 0, 0, '2024-01-01', '0', '0', 'JINNATUNNESHA', NULL, 'ABDUR RAHIM', NULL, 'SUFIA BIBI', NULL, '2011-12-23', NULL, NULL, NULL, NULL, NULL, '9062549967', '', NULL, NULL, NULL, 'INDIAN', '1314010183192', 'PUNB0131420', NULL, NULL, NULL, 3, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '20', NULL, NULL),
(634, '08895119000041', 0, 0, '2024-01-01', '0', '0', 'JYOTI MONDAL', NULL, 'ARJUN MONDAL', NULL, 'BANDANA MONDAL', NULL, '2011-11-26', NULL, NULL, NULL, NULL, NULL, '8670669006', '', NULL, NULL, NULL, 'INDIAN', '1532101700060897', 'PUNB0153210', NULL, NULL, NULL, 3, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '53', NULL, NULL),
(635, '05313519000089', 0, 0, '2024-01-01', '0', '0', 'KHABIR HOSSAIN', NULL, 'LATE SARIFUL', NULL, 'MADHUMALA BIBI', NULL, '2011-03-08', NULL, NULL, NULL, NULL, NULL, '7699229086', '', NULL, NULL, NULL, 'INDIAN', '5575010023649', 'PUNB0021820', NULL, NULL, NULL, 3, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '67', NULL, NULL),
(636, '05329021000049', 0, 0, '2024-01-01', '0', '0', 'KHADIJA KHATUN', NULL, 'HAJIKUL ALAM', NULL, 'MOHARAM BIBI', NULL, '2011-07-29', NULL, NULL, NULL, NULL, NULL, '9002141921', '', NULL, NULL, NULL, 'INDIAN', '0977010286671', 'PUNB0097720', NULL, NULL, NULL, 3, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '27', NULL, NULL),
(637, '08895119000045', 0, 0, '2024-01-01', '0', '0', 'KIRAN SARKAR', NULL, 'SAPTAM SARKAR', NULL, 'SABITA SARKAR', NULL, '2011-10-19', NULL, NULL, NULL, NULL, NULL, '9002313057', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 3, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '84', NULL, NULL),
(638, '05839821000033', 0, 0, '2024-01-01', '0', '0', 'LIZA KHATUN', NULL, 'NEMASUDDIN', NULL, 'KAMELA BIBI', NULL, '2011-06-30', NULL, NULL, NULL, NULL, NULL, '9641047266', '', NULL, NULL, NULL, 'INDIAN', '5021020000709', 'PUNB0RRBBGB', NULL, NULL, NULL, 3, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '74', NULL, NULL),
(639, '05312719000043', 0, 0, '2024-01-01', '0', '0', 'MASTURA KHATUN', NULL, 'ISMAIL SK', NULL, 'SAMENA BIBI', NULL, '2011-10-20', NULL, NULL, NULL, NULL, NULL, '9093140216', '', NULL, NULL, NULL, 'INDIAN', '5021010044165', 'PUNB0RRBBGB', NULL, NULL, NULL, 3, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '43', NULL, NULL),
(640, '05839721000015', 0, 0, '2024-01-01', '0', '0', 'MD ISRAIL ISLAM', NULL, 'MD HAFIJUL ISLAM', NULL, 'KAMALA BIBI', NULL, '2011-08-21', NULL, NULL, NULL, NULL, NULL, '8670060015', '', NULL, NULL, NULL, 'INDIAN', '0583972100001', 'PUNB0RRBBGB', NULL, NULL, NULL, 3, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '31', NULL, NULL),
(641, '01475519000134', 0, 0, '2024-01-01', '0', '0', 'MD MURSALIN HOSSAIN', NULL, 'ALI HOSSAIN', NULL, 'SAMSUNNAHAR BIBI', NULL, '2011-03-20', NULL, NULL, NULL, NULL, NULL, '7407226804', '', NULL, NULL, NULL, 'INDIAN', '5021010043412', 'PUNB0RRBBGB', NULL, NULL, NULL, 3, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL),
(642, '01475519000168', 0, 0, '2024-01-01', '0', '0', 'MD SIRAJUM MONIR', NULL, 'JHATU SK', NULL, 'DULEB BIBI', NULL, '2011-11-11', NULL, NULL, NULL, NULL, NULL, '9874344858', '', NULL, NULL, NULL, 'INDIAN', '5287475551', 'CBIN0280122', NULL, NULL, NULL, 3, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '33', NULL, NULL),
(643, '01475519000171', 0, 0, '2024-01-01', '0', '0', 'MEHEDI HASAN', NULL, 'SADIKUL ISLAM', NULL, 'AMINA BIBI', NULL, '2011-01-01', NULL, NULL, NULL, NULL, NULL, '8436644702', '', NULL, NULL, NULL, 'INDIAN', '0977010327633', '', NULL, NULL, NULL, 3, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '72', NULL, NULL),
(644, '05312719000064', 0, 0, '2024-01-01', '0', '0', 'MEHEDI HASAN', NULL, 'HABIBUR ALI', NULL, 'RUKSENA BIBI', NULL, '2011-12-05', NULL, NULL, NULL, NULL, NULL, '8972535601', '', NULL, NULL, NULL, 'INDIAN', '1532101700060435', 'PUNB0153210', NULL, NULL, NULL, 3, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '37', NULL, NULL),
(645, '05312719000044', 0, 0, '2024-01-01', '0', '0', 'MEHERUNNESHA KHATUN', NULL, 'MAKKEL SK', NULL, 'PIYARA BIBI', NULL, '2011-07-26', NULL, NULL, NULL, NULL, NULL, '9609470836', '', NULL, NULL, NULL, 'INDIAN', '41386039578', 'SBIN0015048', NULL, NULL, NULL, 3, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '14', NULL, NULL),
(646, '05839821000030', 0, 0, '2024-01-01', '0', '0', 'MINA KHATUN', NULL, 'ESRAFIL HOQUE', NULL, 'SIMA BIBI', NULL, '2011-10-04', NULL, NULL, NULL, NULL, NULL, '8945518680', '', NULL, NULL, NULL, 'INDIAN', '5021010022950', 'PUNB0RRBBGB', NULL, NULL, NULL, 3, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '29', NULL, NULL),
(647, '05313119000091', 0, 0, '2024-01-01', '0', '0', 'MONISHA GHOSH', NULL, 'SANDIP GHOSH', NULL, 'PARTHANA GHOSH', NULL, '2011-11-26', NULL, NULL, NULL, NULL, NULL, '8509183338', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 3, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '46', NULL, NULL),
(648, '05313119000083', 0, 0, '2024-01-01', '0', '0', 'MST HALIMA KHATUN', NULL, 'AZIMUDDIN', NULL, 'MST ANUARA KHATUN', NULL, '2011-06-01', NULL, NULL, NULL, NULL, NULL, '7890985322', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 3, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '48', NULL, NULL),
(649, '05839621000044', 0, 0, '2024-01-01', '0', '0', 'MST KAMRUNNESHA KHATUN', NULL, 'MD KABAJUDDIN', NULL, 'MST HASINA KHATUN', NULL, '2011-03-04', NULL, NULL, NULL, NULL, NULL, '7384559459', '', NULL, NULL, NULL, 'INDIAN', '5021030000762', 'PUNB0RRBBGB', NULL, NULL, NULL, 3, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5', NULL, NULL),
(650, '01783522002040', 0, 0, '2024-01-01', '0', '0', 'MST SUHANA KHATUN', NULL, 'NABAB ALI', NULL, 'SUKLEMA BIBI', NULL, '2012-01-28', NULL, NULL, NULL, NULL, NULL, '7224994213', '', NULL, NULL, NULL, 'INDIAN', '0977010321983', 'PUNB0097720', NULL, NULL, NULL, 3, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '19', NULL, NULL),
(651, '05839621000032', 0, 0, '2024-01-01', '0', '0', 'NASRIN PARVIN', NULL, 'DULAL SK', NULL, 'JYOTSNA BIBI', NULL, '2011-07-18', NULL, NULL, NULL, NULL, NULL, '9635120785', '', NULL, NULL, NULL, 'INDIAN', '36391241965', 'SBIN0008006', NULL, NULL, NULL, 3, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '68', NULL, NULL),
(652, '05839621000041', 0, 0, '2024-01-01', '0', '0', 'NURALAM SEIKH', NULL, 'KAMAL SK', NULL, 'JYATSNA BIBI', NULL, '2011-04-10', NULL, NULL, NULL, NULL, NULL, '9002507337', '', NULL, NULL, NULL, 'INDIAN', '5021010029704', 'PUNB0RRBBGB', NULL, NULL, NULL, 3, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '69', NULL, NULL),
(653, '05312819000452', 0, 0, '2024-01-01', '0', '0', 'PARVIN KHATUN', NULL, 'FARID SEKH', NULL, 'KHADIJA BIBI', NULL, '2011-06-07', NULL, NULL, NULL, NULL, NULL, '7407151973', '', NULL, NULL, NULL, 'INDIAN', '5351472081', 'CBIN0280122', NULL, NULL, NULL, 3, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '26', NULL, NULL),
(654, '05839421000035', 0, 0, '2024-01-01', '0', '0', 'RABIYA KHATUN', NULL, 'MUSTAKIM SK', NULL, 'JAHANARA KHATUN', NULL, '2009-11-10', NULL, NULL, NULL, NULL, NULL, '9746852136', '', NULL, NULL, NULL, 'INDIAN', '5021010030922', 'PUNB0RRBBGB', NULL, NULL, NULL, 3, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '35', NULL, NULL),
(655, '05839721000013', 0, 0, '2024-01-01', '0', '0', 'RAHAMAT ALI', NULL, 'ABDUL HALIM', NULL, 'BEDANA BIBI', NULL, '2012-01-25', NULL, NULL, NULL, NULL, NULL, '6294326566', '', NULL, NULL, NULL, 'INDIAN', '1532101700048886', 'PUNB0153210', NULL, NULL, NULL, 3, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '63', NULL, NULL),
(656, '05312819000451', 0, 0, '2024-01-01', '0', '0', 'RAJ SK', NULL, 'ALAUDDIN SK', NULL, 'KHAIRUNNESHA BIBI', NULL, '2011-10-31', NULL, NULL, NULL, NULL, NULL, '8967216379', '', NULL, NULL, NULL, 'INDIAN', '32912385518', 'SBIN0008006', NULL, NULL, NULL, 3, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', NULL, NULL),
(657, '05839621000033', 0, 0, '2024-01-01', '0', '0', 'RIKTA KHATUN', NULL, 'KUDDUS ALI', NULL, 'PAPIA BIBI', NULL, '2011-12-09', NULL, NULL, NULL, NULL, NULL, '7547962298', '', NULL, NULL, NULL, 'INDIAN', '5288570475', 'CBIN0280122', NULL, NULL, NULL, 3, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '47', NULL, NULL),
(658, '08895119000040', 0, 0, '2024-01-01', '0', '0', 'RIMPA MANDAL', NULL, 'AMIT MANDAL', NULL, 'REKHA MANDAL', NULL, '2012-02-29', NULL, NULL, NULL, NULL, NULL, '8001769311', '', NULL, NULL, NULL, 'INDIAN', '37663163515', 'SBIN0008006', NULL, NULL, NULL, 3, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '17', NULL, NULL),
(659, '05759119000042', 0, 0, '2024-01-01', '0', '0', 'ROJIYA KHATUN', NULL, 'AINAL HAQUE', NULL, 'PERVINA BIBI', NULL, '2011-08-23', NULL, NULL, NULL, NULL, NULL, '7872966133', '', NULL, NULL, NULL, 'INDIAN', '35165594610', 'SBIN0008006', NULL, NULL, NULL, 3, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '40', NULL, NULL),
(660, '05313119000076', 0, 0, '2024-01-01', '0', '0', 'SABIR SK', NULL, 'SARIKUL ISLAM', NULL, 'SARJINA BIBI', NULL, '2011-02-08', NULL, NULL, NULL, NULL, NULL, '8372903047', '', NULL, NULL, NULL, 'INDIAN', '1532101700060408', 'PUNB0153210', NULL, NULL, NULL, 3, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '51', NULL, NULL),
(661, '05839821000039', 0, 0, '2024-01-01', '0', '0', 'SABIRUL SK', NULL, 'TAIYAB ALI', NULL, 'SHILA BIBI', NULL, '2010-08-19', NULL, NULL, NULL, NULL, NULL, '8597744269', '', NULL, NULL, NULL, 'INDIAN', '5021010035167', 'PUNB0RRBBGB', NULL, NULL, NULL, 3, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '44', NULL, NULL),
(662, '05313219000126', 0, 0, '2024-01-01', '0', '0', 'SABNAM KHATUN', NULL, 'JALI ALAM BADSHA', NULL, 'SABINA BIBI', NULL, '2011-05-05', NULL, NULL, NULL, NULL, NULL, '9933006054', '', NULL, NULL, NULL, 'INDIAN', '5266986821', 'CBIN0280122', NULL, NULL, NULL, 3, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '12', NULL, NULL),
(663, '05839721000012', 0, 0, '2024-01-01', '0', '0', 'SABNUR KHATUN', NULL, 'HALIM SK', NULL, 'JANNATUNESHA', NULL, '2012-04-21', NULL, NULL, NULL, NULL, NULL, '7585003729', '', NULL, NULL, NULL, 'INDIAN', '36471962089', 'SBIN0008006', NULL, NULL, NULL, 3, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '23', NULL, NULL),
(664, '05312719000050', 0, 0, '2024-01-01', '0', '0', 'SAHANAJ KHATUN', NULL, 'ISMAIL SK', NULL, 'MUSLIMA BIBI', NULL, '2011-03-10', NULL, NULL, NULL, NULL, NULL, '8515836654', '', NULL, NULL, NULL, 'INDIAN', '5021030000159', 'PUNB0RRBBGB', NULL, NULL, NULL, 3, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '39', NULL, NULL),
(665, '05839821000035', 0, 0, '2024-01-01', '0', '0', 'SAHARA KHATUN', NULL, 'SARIKUL ISLAM', NULL, 'ADORA BIBI', NULL, '2010-01-09', NULL, NULL, NULL, NULL, NULL, '7029442496', '', NULL, NULL, NULL, 'INDIAN', '5021010007366', 'PUNB0RRBBGB', NULL, NULL, NULL, 3, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '24', NULL, NULL),
(666, '05313219000124', 0, 0, '2024-01-01', '0', '0', 'SAHINA KHATUN', NULL, 'SAHIDUL ISLAM', NULL, 'REBA BIBI', NULL, '2011-12-25', NULL, NULL, NULL, NULL, NULL, '7407211655', '', NULL, NULL, NULL, 'INDIAN', '41293468127', 'SBIN0015048', NULL, NULL, NULL, 3, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '9', NULL, NULL),
(667, '05311919000231', 0, 0, '2024-01-01', '0', '0', 'SAHIN SK', NULL, 'HUMAYAN KABIR', NULL, 'KHALIDA BIBI', NULL, '2011-05-26', NULL, NULL, NULL, NULL, NULL, '7699229083', '', NULL, NULL, NULL, 'INDIAN', '5331263173', 'CBIN0280122', NULL, NULL, NULL, 3, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '80', NULL, NULL),
(668, '01475519000152', 0, 0, '2024-01-01', '0', '0', 'SAIF HASAN', NULL, 'SELIM REJA', NULL, 'SAJEMA BIBI', NULL, '2011-04-23', NULL, NULL, NULL, NULL, NULL, '9851902700', '', NULL, NULL, NULL, 'INDIAN', '5290863127', 'CBIN0280122', NULL, NULL, NULL, 3, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '36', NULL, NULL),
(669, '05311919000225', 0, 0, '2024-01-01', '0', '0', 'SAKIL SK', NULL, 'SANAULLA', NULL, 'SABINA YEASMIN', NULL, '2011-09-18', NULL, NULL, NULL, NULL, NULL, '8768102394', '', NULL, NULL, NULL, 'INDIAN', '5329219989', 'CBIN0280122', NULL, NULL, NULL, 3, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '78', NULL, NULL),
(670, '01475519000172', 0, 0, '2024-01-01', '0', '0', 'SAMIM HOSSAIN', NULL, 'JOYDUL SK', NULL, 'ADINA BIBI', NULL, '2011-02-21', NULL, NULL, NULL, NULL, NULL, '8537032430', '', NULL, NULL, NULL, 'INDIAN', '5021010043500', 'PUNB0RRBBGB', NULL, NULL, NULL, 3, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '49', NULL, NULL),
(671, '05839621000034', 0, 0, '2024-01-01', '0', '0', 'SAMIRUL HOQUE', NULL, 'SANARUL HOQUE', NULL, 'JERBANU BIBI', NULL, '2011-05-18', NULL, NULL, NULL, NULL, NULL, '6299461498', '', NULL, NULL, NULL, 'INDIAN', '3836146971', 'CBIN0280122', NULL, NULL, NULL, 3, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '77', NULL, NULL),
(672, '05313019000082', 0, 0, '2024-01-01', '0', '0', 'SARIFUL ISLAM', NULL, 'SANARUL ISLAM', NULL, 'SONALI BIBI', NULL, '2011-06-17', NULL, NULL, NULL, NULL, NULL, '8670993129', '', NULL, NULL, NULL, 'INDIAN', '5021010033381', 'PUNB0RRBBGB', NULL, NULL, NULL, 3, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '16', NULL, NULL),
(673, '05313219000147', 0, 0, '2024-01-01', '0', '0', 'SEWLI KHATUN', NULL, 'TINKU SK', NULL, 'ARSINA BIBI', NULL, '2011-01-15', NULL, NULL, NULL, NULL, NULL, '8967172693', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 3, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '52', NULL, NULL),
(674, '08895119000057', 0, 0, '2024-01-01', '0', '0', 'SHIB SARKAR', NULL, 'CHADU SARKAR', NULL, 'BASANTI SARKAR', NULL, '2011-02-28', NULL, NULL, NULL, NULL, NULL, '7872471578', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 3, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '82', NULL, NULL),
(675, '05311919000254', 0, 0, '2024-01-01', '0', '0', 'SHIBU MANDAL', NULL, 'JOGESH MANDAL', NULL, 'ASTAMI MANDAL', NULL, '2011-03-03', NULL, NULL, NULL, NULL, NULL, '9093635491', '', NULL, NULL, NULL, 'INDIAN', '5333900905', 'CBIN0280122', NULL, NULL, NULL, 3, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '83', NULL, NULL),
(676, '05839421000030', 0, 0, '2024-01-01', '0', '0', 'SHRABANI KHATUN', NULL, 'HAFIJUL SK', NULL, 'ARUNA BIBI', NULL, '2011-08-13', NULL, NULL, NULL, NULL, NULL, '7063705312', '', NULL, NULL, NULL, 'INDIAN', '33620109179', 'SBIN0008006', NULL, NULL, NULL, 3, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '15', NULL, NULL),
(677, '05313519000093', 0, 0, '2024-01-01', '0', '0', 'SOHELI KHATUN', NULL, 'MAJRUL SK', NULL, 'HASIBA BIBI', NULL, '2011-05-28', NULL, NULL, NULL, NULL, NULL, '9002354693', '', NULL, NULL, NULL, 'INDIAN', '5575010032434', 'PUNB0046420', NULL, NULL, NULL, 3, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '54', NULL, NULL),
(678, '05313219000134', 0, 0, '2024-01-01', '0', '0', 'SOHEL SK', NULL, 'KAMAL HOSSAIN', NULL, 'SAMSAD BEGAM', NULL, '2011-08-08', NULL, NULL, NULL, NULL, NULL, '7363998622', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 3, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '75', NULL, NULL),
(679, '08895119000055', 0, 0, '2024-01-01', '0', '0', 'SUDARSAN MANDAL', NULL, 'AJIT MANDAL', NULL, 'TUMPA MANDAL', NULL, '2011-12-14', NULL, NULL, NULL, NULL, NULL, '8670319997', '', NULL, NULL, NULL, 'INDIAN', '5021010052664', 'PUNB0RRBBGB', NULL, NULL, NULL, 3, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '76', NULL, NULL),
(680, '05311919000268', 0, 0, '2024-01-01', '0', '0', 'SUHANA PARVIN', NULL, 'SERTAJ ALI', NULL, 'SAYEMA BIBI', NULL, '2011-07-28', NULL, NULL, NULL, NULL, NULL, '9850201454', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 3, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '21', NULL, NULL),
(681, '05839621000029', 0, 0, '2024-01-01', '0', '0', 'SUJAN SK', NULL, 'TUTUL SK', NULL, 'AMBIA BIBI', NULL, '2011-06-18', NULL, NULL, NULL, NULL, NULL, '9134644315', '', NULL, NULL, NULL, 'INDIAN', '5162124617', 'CBIN0280122', NULL, NULL, NULL, 3, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '60', NULL, NULL),
(682, '05839621000040', 0, 0, '2024-01-01', '0', '0', 'SUKLEMA KHATUN', NULL, 'KAMAL SK', NULL, 'DOLY BIBI', NULL, '2012-02-24', NULL, NULL, NULL, NULL, NULL, '8348105689', '', NULL, NULL, NULL, 'INDIAN', '50150011538806', 'BDBL0001165', NULL, NULL, NULL, 3, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '70', NULL, NULL),
(683, '05311919000234', 0, 0, '2024-01-01', '0', '0', 'SUNAM KHATUN', NULL, 'MILAN SK', NULL, 'MAHABUBA BIBI', NULL, '2011-09-13', NULL, NULL, NULL, NULL, NULL, '8670321771', '', NULL, NULL, NULL, 'INDIAN', '5330257193', 'CBIN0280122', NULL, NULL, NULL, 3, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '79', NULL, NULL),
(684, '05839921000033', 0, 0, '2024-01-01', '0', '0', 'SURAIYA KHATUN', NULL, 'HABIBUR ALI', NULL, 'ALIFA BIBI', NULL, '2011-10-03', NULL, NULL, NULL, NULL, NULL, '9088117539', '', NULL, NULL, NULL, 'INDIAN', '1532101700060453', 'PUNB0015320', NULL, NULL, NULL, 3, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '41', NULL, NULL),
(685, '05313219000150', 0, 0, '2024-01-01', '0', '0', 'SURAIYA YEASMIN', NULL, 'HAMEDUL ISLAM', NULL, 'PARVINNESHA BIBI', NULL, '2011-09-19', NULL, NULL, NULL, NULL, NULL, '8972590002', '', NULL, NULL, NULL, 'INDIAN', '5290194109', 'CBIN0280122', NULL, NULL, NULL, 3, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '3', NULL, NULL),
(686, '05313219000148', 0, 0, '2024-01-01', '0', '0', 'SURAJ SK', NULL, 'AYUB ALI', NULL, 'REXONA BIBI', NULL, '2011-07-10', NULL, NULL, NULL, NULL, NULL, '8918518468', '', NULL, NULL, NULL, 'INDIAN', '35311570901', 'SBIN0008855', NULL, NULL, NULL, 3, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '57', NULL, NULL),
(687, '05313219000132', 0, 0, '2024-01-01', '0', '0', 'SURMANUL .', NULL, 'SUJAUDDIN', NULL, 'TUMPA BIBI', NULL, '2011-06-08', NULL, NULL, NULL, NULL, NULL, '8116509275', '', NULL, NULL, NULL, 'INDIAN', '5021030001200', 'PUNB0RRBBGB', NULL, NULL, NULL, 3, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '50', NULL, NULL),
(688, '05312819000459', 0, 0, '2024-01-01', '0', '0', 'SUSMITA KHATUN', NULL, 'ESRAFIL HAQUE', NULL, 'MST TAHERA KHATUN BIBI', NULL, '2011-09-28', NULL, NULL, NULL, NULL, NULL, '9635758685', '', NULL, NULL, NULL, 'INDIAN', '35946210719', 'SBIN0008006', NULL, NULL, NULL, 3, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '22', NULL, NULL),
(689, '05312719000060', 0, 0, '2024-01-01', '0', '0', 'SWEET SK', NULL, 'SURUJJAMAN', NULL, 'RUMA BIBI', NULL, '2011-12-03', NULL, NULL, NULL, NULL, NULL, '9800369516', '', NULL, NULL, NULL, 'INDIAN', '1532101700038144', 'PUNB0153210', NULL, NULL, NULL, 3, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '64', NULL, NULL),
(690, '05313219000127', 0, 0, '2024-01-01', '0', '0', 'TANIA KHATUN', NULL, 'KURBAN SK', NULL, 'MEHENAGAR BIBI', NULL, '2011-06-29', NULL, NULL, NULL, NULL, NULL, '8116897039', '', NULL, NULL, NULL, 'INDIAN', '5021030001207', 'PUNB0RRBBGB', NULL, NULL, NULL, 3, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '11', NULL, NULL),
(691, '05313119000089', 0, 0, '2024-01-01', '0', '0', 'TANIYA KHATUN', NULL, 'JAHANGIR', NULL, 'SONAVAN BIBI', NULL, '2011-04-26', NULL, NULL, NULL, NULL, NULL, '8016013611', '', NULL, NULL, NULL, 'INDIAN', '5266831673', 'CBIN0280122', NULL, NULL, NULL, 3, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '10', NULL, NULL),
(692, '05312719000062', 0, 0, '2024-01-01', '0', '0', 'TOHIDUL ISLAM', NULL, 'NEKSAD ALI', NULL, 'MILUYARA BIBI', NULL, '2011-07-20', NULL, NULL, NULL, NULL, NULL, '7074616710', '', NULL, NULL, NULL, 'INDIAN', '1532101700060532', 'PUNB0153210', NULL, NULL, NULL, 3, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '38', NULL, NULL),
(693, '05312719000042', 0, 0, '2024-01-01', '0', '0', 'YEAMINA KHATUN', NULL, 'AJARUL HOQUE', NULL, 'JELEKHA BIBI', NULL, '2011-05-23', NULL, NULL, NULL, NULL, NULL, '9932421034', '', NULL, NULL, NULL, 'INDIAN', '5021010044332', 'PUNB0RRBBGB', NULL, NULL, NULL, 3, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4', NULL, NULL),
(694, '05759119000041', 0, 0, '2024-01-01', '0', '0', 'ABBAS ALI', NULL, 'RAJAB ALI', NULL, 'AWLIA BIBI', NULL, '2011-01-16', NULL, NULL, NULL, NULL, NULL, '9091494808', '', NULL, NULL, NULL, 'INDIAN', '0977010311922', 'PUNB0097720', NULL, NULL, NULL, 3, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6', NULL, NULL),
(695, '01475619000055', 0, 0, '2024-01-01', '0', '0', 'ABDUR RAHIM', NULL, 'MEHEBUB ALI', NULL, 'RUNA BIBI', NULL, '2011-03-24', NULL, NULL, NULL, NULL, NULL, '8609295193', '', NULL, NULL, NULL, 'INDIAN', '5021010006592', 'PUNB0RRBBGB', NULL, NULL, NULL, 3, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '83', NULL, NULL),
(696, '05839621000036', 0, 0, '2024-01-01', '0', '0', 'AKIL SK', NULL, 'GOLAM MUSTAFA', NULL, 'RABIYA BIBI', NULL, '2011-04-11', NULL, NULL, NULL, NULL, NULL, '9735773915', '', NULL, NULL, NULL, 'INDIAN', '50150011530801', 'BDBL0001165', NULL, NULL, NULL, 3, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '50', NULL, NULL),
(697, '08895219000090', 0, 0, '2024-01-01', '0', '0', 'ALLAREKHA', NULL, 'MD ANSAR ALI', NULL, 'SAYERA BIBI', NULL, '2011-01-29', NULL, NULL, NULL, NULL, NULL, '9733969657', '', NULL, NULL, NULL, 'INDIAN', '5021030000731', 'PUNB0RRBBGB', NULL, NULL, NULL, 3, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '53', NULL, NULL),
(698, '05313719000073', 0, 0, '2024-01-01', '0', '0', 'ALMASUR', NULL, 'ALAMGIR HOSSAIN', NULL, 'SELINA BIBI', NULL, '2011-09-28', NULL, NULL, NULL, NULL, NULL, '7074714946', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 3, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '62', NULL, NULL),
(699, '01475619000058', 0, 0, '2024-01-01', '0', '0', 'AMBIA KHATUN', NULL, 'ASRAUL ALI', NULL, 'JAMILA BIBI', NULL, '2011-09-30', NULL, NULL, NULL, NULL, NULL, '8348512172', '', NULL, NULL, NULL, 'INDIAN', '5021010010070', 'PUNB0RRBBGB', NULL, NULL, NULL, 3, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '26', NULL, NULL),
(700, '08895119000050', 0, 0, '2024-01-01', '0', '0', 'AMIT MONDAL', NULL, 'NITAI MONDAL', NULL, 'ANJALI MONDAL', NULL, '2011-03-07', NULL, NULL, NULL, NULL, NULL, '6291772826', '', NULL, NULL, NULL, 'INDIAN', '5021010037350', 'PUNB0RRBBGB', NULL, NULL, NULL, 3, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '47', NULL, NULL),
(701, '08895219000179', 0, 0, '2024-01-01', '0', '0', 'ANIS HASAN', NULL, 'MD SHAHINUL HASAN', NULL, 'NARGIS PARVIN', NULL, '2011-05-01', NULL, NULL, NULL, NULL, NULL, '7384575987', '', NULL, NULL, NULL, 'INDIAN', '1351201700028637', 'PUNB0135120', NULL, NULL, NULL, 3, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '92', NULL, NULL),
(702, '05313719000068', 0, 0, '2024-01-01', '0', '0', 'ASRAFUNNESHA', NULL, 'NURSALIM', NULL, 'RUPA BIBI', NULL, '2011-08-18', NULL, NULL, NULL, NULL, NULL, '8609752153', '', NULL, NULL, NULL, 'INDIAN', '36577400314', 'SBIN0008006', NULL, NULL, NULL, 3, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '64', NULL, NULL),
(703, '05311919000251', 0, 0, '2024-01-01', '0', '0', 'DALIYA KHATUN', NULL, 'MOMIN SK', NULL, 'PRIYANKA BIBI', NULL, '2011-12-06', NULL, NULL, NULL, NULL, NULL, '9002510925', '', NULL, NULL, NULL, 'INDIAN', '35597288055', 'SBIN0008006', NULL, NULL, NULL, 3, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '81', NULL, NULL),
(704, '08895119000053', 0, 0, '2024-01-01', '0', '0', 'DEBASIS MANDAL', NULL, 'ASIT MANDAL', NULL, 'PURNIMA MANDAL', NULL, '2011-01-20', NULL, NULL, NULL, NULL, NULL, '7679462141', '', NULL, NULL, NULL, 'INDIAN', '0501010006610', 'PUNB0RRBBGB', NULL, NULL, NULL, 3, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8', NULL, NULL),
(705, '08895119000051', 0, 0, '2024-01-01', '0', '0', 'DEBJIT MANDAL', NULL, 'KRISHNA MANDAL', NULL, 'TARULATA MANDAL', NULL, '2011-07-27', NULL, NULL, NULL, NULL, NULL, '9609096136', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 3, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '33', NULL, NULL),
(706, '05313219000125', 0, 0, '2024-01-01', '0', '0', 'FAMIDA KHATUN', NULL, 'ISMAIL RAHAMAN', NULL, 'KALPONA BIBI', NULL, '2011-12-20', NULL, NULL, NULL, NULL, NULL, '7699220829', '', NULL, NULL, NULL, 'INDIAN', '41272100191', 'SBIN0015048', NULL, NULL, NULL, 3, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '17', NULL, NULL),
(707, '05312919000053', 0, 0, '2024-01-01', '0', '0', 'FORIDA KHATUN', NULL, 'MD ISMAIL', NULL, 'MEHERUNNESA BIBI', NULL, '2011-09-10', NULL, NULL, NULL, NULL, NULL, '7364950580', '', NULL, NULL, NULL, 'INDIAN', '36039254784', 'SBIN0008006', NULL, NULL, NULL, 3, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '78', NULL, NULL),
(708, '06138021000076', 0, 0, '2024-01-01', '0', '0', 'GOLAM AUSH', NULL, 'MAYDUL', NULL, 'REJINA BIBI', NULL, '2011-01-12', NULL, NULL, NULL, NULL, NULL, '7699863508', '', NULL, NULL, NULL, 'INDIAN', '5575010022552', 'PUNB0RRBBGB', NULL, NULL, NULL, 3, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '52', NULL, NULL),
(709, '01475519000148', 0, 0, '2024-01-01', '0', '0', 'HASIBUL SK', NULL, 'ARIF SK', NULL, 'REXONA BIBI', NULL, '2011-09-10', NULL, NULL, NULL, NULL, NULL, '7699737274', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 3, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '86', NULL, NULL),
(710, '05759119000044', 0, 0, '2024-01-01', '0', '0', 'HASINA KHATUN', NULL, 'FIROJ HOSSAIN', NULL, 'ZOHORA BIBI', NULL, '2011-07-31', NULL, NULL, NULL, NULL, NULL, '7063826045', '', NULL, NULL, NULL, 'INDIAN', '1532101700040750', 'PUNB0153210', NULL, NULL, NULL, 3, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '10', NULL, NULL),
(711, '05839821000034', 0, 0, '2024-01-01', '0', '0', 'INJAMUL SK', NULL, 'ARIFUL ISLAM', NULL, 'FERDOSA BIBI', NULL, '2014-10-12', NULL, NULL, NULL, NULL, NULL, '7585030505', '', NULL, NULL, NULL, 'INDIAN', '34860347893', 'SBIN0008006', NULL, NULL, NULL, 3, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '20', NULL, NULL),
(712, '01475619000060', 0, 0, '2024-01-01', '0', '0', 'ISAN SK', NULL, 'MINARUL SK', NULL, 'RINA BIBI', NULL, '2011-02-24', NULL, NULL, NULL, NULL, NULL, '9062245971', '', NULL, NULL, NULL, 'INDIAN', '0977010304238', 'PUNB0097720', NULL, NULL, NULL, 3, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '35', NULL, NULL),
(713, '05839421000028', 0, 0, '2024-01-01', '0', '0', 'JANNATUNNESHA KHATUN', NULL, 'SAJIBAR RAHAMAN', NULL, 'MST SAGRA BIBI', NULL, '2011-12-14', NULL, NULL, NULL, NULL, NULL, '9635989665', '', NULL, NULL, NULL, 'INDIAN', '33620050871', 'SBIN0008006', NULL, NULL, NULL, 3, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '11', NULL, NULL),
(714, '05313719000082', 0, 0, '2024-01-01', '0', '0', 'JULKAR NAYEEM', NULL, 'SARIF AHAMMAD', NULL, 'ANJUMANARA BIBI', NULL, '2011-05-10', NULL, NULL, NULL, NULL, NULL, '9091212438', '', NULL, NULL, NULL, 'INDIAN', '5575010034405', 'PUNB0RRBBGB', NULL, NULL, NULL, 3, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '46', NULL, NULL),
(715, '05313219000154', 0, 0, '2024-01-01', '0', '0', 'JUNAID HOSSAIN', NULL, 'ABUL HOSSAIN', NULL, 'SELINA BIBI', NULL, '2011-02-21', NULL, NULL, NULL, NULL, NULL, '7699176262', '', NULL, NULL, NULL, 'INDIAN', '34645458217', 'SBIN0008006', NULL, NULL, NULL, 3, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '70', NULL, NULL),
(716, '05839721000014', 0, 0, '2024-01-01', '0', '0', 'KABITA KHATUN', NULL, 'KABIRUL ISLAM', NULL, 'MAHABUBA BIBI', NULL, '2011-07-29', NULL, NULL, NULL, NULL, NULL, '6369360283', '', NULL, NULL, NULL, 'INDIAN', '37792316394', 'SBIN0008006', NULL, NULL, NULL, 3, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '57', NULL, NULL),
(717, '05313519000074', 0, 0, '2024-01-01', '0', '0', 'KHADIJA KHATUN', NULL, 'MD MAJHARUL ISLAM', NULL, 'KHAIRUNNESHA BIBI', NULL, '2011-01-05', NULL, NULL, NULL, NULL, NULL, '8609764253', '', NULL, NULL, NULL, 'INDIAN', '5575010036485', 'PUNB0RRBBGB', NULL, NULL, NULL, 3, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '34', NULL, NULL),
(718, '05312819000461', 0, 0, '2024-01-01', '0', '0', 'KHUSI GHOSH', NULL, 'SAKHA GHOSH', NULL, 'RUMA GHOSH', NULL, '2011-03-16', NULL, NULL, NULL, NULL, NULL, '8967061959', '', NULL, NULL, NULL, 'INDIAN', '5181981125', 'CBIN0280122', NULL, NULL, NULL, 3, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '36', NULL, NULL),
(719, '08895119000049', 0, 0, '2024-01-01', '0', '0', 'LAXMI MONDAL', NULL, 'DIPU MONDAL', NULL, 'SANDHYA MONDAL', NULL, '2011-12-08', NULL, NULL, NULL, NULL, NULL, '8967608267', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 3, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '37', NULL, NULL),
(720, '01475619000053', 0, 0, '2024-01-01', '0', '0', 'LIUJA AKTAR', NULL, 'MD MOMIRUL ISLAM', NULL, 'JULI BIBI', NULL, '2011-02-26', NULL, NULL, NULL, NULL, NULL, '6371425405', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 3, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '49', NULL, NULL),
(721, '05313719000078', 0, 0, '2024-01-01', '0', '0', 'MAMUN HASAN', NULL, 'MONIRUZZAMAN', NULL, 'TARJINA BIBI', NULL, '2011-12-27', NULL, NULL, NULL, NULL, NULL, '7074874598', '', NULL, NULL, NULL, 'INDIAN', '5575010044518', 'PUNB0RRBBGB', NULL, NULL, NULL, 3, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '45', NULL, NULL),
(722, '05313719000077', 0, 0, '2024-01-01', '0', '0', 'MASUM RAHAMAN', NULL, 'RAKIBUR RAHAMAN', NULL, 'SILPI BIBI', NULL, '2011-11-19', NULL, NULL, NULL, NULL, NULL, '9144307412', '', NULL, NULL, NULL, 'INDIAN', '0977010311489', 'PUNB0097720', NULL, NULL, NULL, 3, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '25', NULL, NULL),
(723, '05312719000065', 0, 0, '2024-01-01', '0', '0', 'MD. AHANAF MURSHED', NULL, 'MD. GOLAM MURSHED', NULL, 'PINKY BEGAM', NULL, '2011-04-04', NULL, NULL, NULL, NULL, NULL, '9735257675', '', NULL, NULL, NULL, 'INDIAN', '33726534365', 'SBIN0008006', NULL, NULL, NULL, 3, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '51', NULL, NULL),
(724, '05313119000088', 0, 0, '2024-01-01', '0', '0', 'MD GOLAM MUSTOFA', NULL, 'NOUSAD ALI', NULL, 'SINARA KHATUN', NULL, '2011-04-09', NULL, NULL, NULL, NULL, NULL, '9547276771', '', NULL, NULL, NULL, 'INDIAN', '32288450001', 'SBIN0008006', NULL, NULL, NULL, 3, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '48', NULL, NULL),
(725, '05839821000027', 0, 0, '2024-01-01', '0', '0', 'MD IJAJ HOSSAIN', NULL, 'MD FIROJ HOSSAIN', NULL, 'MST ALIMUNNESA', NULL, '2011-11-06', NULL, NULL, NULL, NULL, NULL, '6296408441', '', NULL, NULL, NULL, 'INDIAN', '5021010003532', 'PUNB0RRBBGB', NULL, NULL, NULL, 3, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '460', NULL, NULL),
(726, '01475519000154', 0, 0, '2024-01-01', '0', '0', 'MD NUR ALI', NULL, 'BOKUL HOQUE', NULL, 'RAJIA SULTANA', NULL, '2012-01-01', NULL, NULL, NULL, NULL, NULL, '8116291209', '', NULL, NULL, NULL, 'INDIAN', '1532101700103202', 'PUNB0153210', NULL, NULL, NULL, 3, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '89', NULL, NULL),
(727, '01475519000156', 0, 0, '2024-01-01', '0', '0', 'MD RAMJAN ALI', NULL, 'SADDAM HOSSAIN', NULL, 'MUNIYARA BIBI', NULL, '2011-08-03', NULL, NULL, NULL, NULL, NULL, '7047167831', '', NULL, NULL, NULL, 'INDIAN', '1532101700041564', 'PUNB0153210', NULL, NULL, NULL, 3, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '88', NULL, NULL),
(728, '05839421000033', 0, 0, '2024-01-01', '0', '0', 'MD RIDUYAN SK', NULL, 'NAUSAD ALI', NULL, 'FARIDA BIBI', NULL, '2011-12-27', NULL, NULL, NULL, NULL, NULL, '8016443279', '', NULL, NULL, NULL, 'INDIAN', '5021010030515', 'PUNB0RRBBGB', NULL, NULL, NULL, 3, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '29', NULL, NULL),
(729, '05313019000094', 0, 0, '2024-01-01', '0', '0', 'MD. SAHAJAMAL', NULL, 'AINUL HOQUE', NULL, 'LALMUN BIBI', NULL, '2011-06-07', NULL, NULL, NULL, NULL, NULL, '7501369065', '', NULL, NULL, NULL, 'INDIAN', '33535944049', 'SBIN0008006', NULL, NULL, NULL, 3, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '12', NULL, NULL),
(730, '05313219000121', 0, 0, '2024-01-01', '0', '0', 'MEHEBUB ALAM', NULL, 'JAMALUDDIN SK', NULL, 'RASHIDA BIBI', NULL, '2011-01-14', NULL, NULL, NULL, NULL, NULL, '9635021585', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 3, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '14', NULL, NULL),
(731, '05759119000051', 0, 0, '2024-01-01', '0', '0', 'MEHEDI HOSSAIN', NULL, 'MD HAZRAT BELLAL HOQUE', NULL, 'TANJURA BIBI', NULL, '2011-12-25', NULL, NULL, NULL, NULL, NULL, '6918435702', '', NULL, NULL, NULL, 'INDIAN', '1532101700040617', 'PUNB0153210', NULL, NULL, NULL, 3, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '85', NULL, NULL),
(732, '01475519000135', 0, 0, '2024-01-01', '0', '0', 'MISBAHUL HOQUE', NULL, 'TOFAJUL HOQUE', NULL, 'FAJILA TUNNESHA', NULL, '2011-04-08', NULL, NULL, NULL, NULL, NULL, '9932982464', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 3, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', NULL, NULL),
(733, '05312819000455', 0, 0, '2024-01-01', '0', '0', 'MITA PRAMANIK', NULL, 'SAHADEV PRAMANIK', NULL, 'MADHABI PRAMANIK', NULL, '2011-09-28', NULL, NULL, NULL, NULL, NULL, '9775450781', '', NULL, NULL, NULL, 'INDIAN', '5352004848', 'CBIN0280122', NULL, NULL, NULL, 3, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '63', NULL, NULL),
(734, '06160321000266', 0, 0, '2024-01-01', '0', '0', 'MORJINA KHATUN', NULL, 'SAYEDUR RAHAMAN', NULL, 'TUJLEMA BIBI', NULL, '2011-12-23', NULL, NULL, NULL, NULL, NULL, '7718227878', '', NULL, NULL, NULL, 'INDIAN', '1163201700087293', 'PUNB0116320', NULL, NULL, NULL, 3, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91', NULL, NULL),
(735, '05759119000053', 0, 0, '2024-01-01', '0', '0', 'MST BEAUTY KHATUN', NULL, 'TARIKUL ISLAM', NULL, 'RAJFIYA BIBI', NULL, '2011-09-18', NULL, NULL, NULL, NULL, NULL, '6301818038', '', NULL, NULL, NULL, 'INDIAN', '39494545919', 'SBIN0015048', NULL, NULL, NULL, 3, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '56', NULL, NULL),
(736, '05839421000029', 0, 0, '2024-01-01', '0', '0', 'MST SOHANA KHATUN', NULL, 'REJAUL HOQUE', NULL, 'SAMSAD BEGUM', NULL, '2011-12-03', NULL, NULL, NULL, NULL, NULL, '7602711416', '', NULL, NULL, NULL, 'INDIAN', '36193343360', 'SBIN0008006', NULL, NULL, NULL, 3, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '24', NULL, NULL),
(737, '05313219000151', 0, 0, '2024-01-01', '0', '0', 'MUNIMUL SK', NULL, 'ISLAM SK', NULL, 'SELINA BIBI', NULL, '2011-12-05', NULL, NULL, NULL, NULL, NULL, '8972624449', '', NULL, NULL, NULL, 'INDIAN', '20348858997', 'SBIN0015048', NULL, NULL, NULL, 3, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '72', NULL, NULL),
(738, '05839421000031', 0, 0, '2024-01-01', '0', '0', 'NAJERA KHATUN', NULL, 'NAJIBUR RAHAMAN', NULL, 'ROJINA BIBI', NULL, '2010-01-03', NULL, NULL, NULL, NULL, NULL, '6372582110', '', NULL, NULL, NULL, 'INDIAN', '34086553033', 'SBIN0008006', NULL, NULL, NULL, 3, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '74', NULL, NULL),
(739, '05759119000049', 0, 0, '2024-01-01', '0', '0', 'NAYEEM SK', NULL, 'RUBEL SK', NULL, 'NASRIN BIBI', NULL, '2010-11-13', NULL, NULL, NULL, NULL, NULL, '9800900509', '', NULL, NULL, NULL, 'INDIAN', '33120749196', 'SBIN0008006', NULL, NULL, NULL, 3, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4', NULL, NULL),
(740, '05759119000050', 0, 0, '2024-01-01', '0', '0', 'NIHAR ISLAM', NULL, 'KABIRUL ISLAM', NULL, 'HASINA BIBI', NULL, '2011-05-07', NULL, NULL, NULL, NULL, NULL, '6294431032', '', NULL, NULL, NULL, 'INDIAN', '5290884716', 'CBIN0280122', NULL, NULL, NULL, 3, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '42', NULL, NULL),
(741, '05313019000087', 0, 0, '2024-01-01', '0', '0', 'NURAMIN SK', NULL, 'AJOB ALI', NULL, 'AMBIA BIBI', NULL, '2011-02-17', NULL, NULL, NULL, NULL, NULL, '8972161561', '', NULL, NULL, NULL, 'INDIAN', '5021019900317', 'PUNB0RRBBGB', NULL, NULL, NULL, 3, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '44', NULL, NULL),
(742, '05313519000081', 0, 0, '2024-01-01', '0', '0', 'PAPIA', NULL, 'KALU SK', NULL, 'ISMETARA BIBI', NULL, '2011-11-27', NULL, NULL, NULL, NULL, NULL, '6296303877', '', NULL, NULL, NULL, 'INDIAN', '5575010035769', 'PUNB0RRBBGB', NULL, NULL, NULL, 3, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '30', NULL, NULL),
(743, '01475519000176', 0, 0, '2024-01-01', '0', '0', 'PAPPU MONDAL', NULL, 'MITHUN MONDAL', NULL, 'SANTANA MONDAL', NULL, '2011-10-22', NULL, NULL, NULL, NULL, NULL, '9083421694', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 3, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '68', NULL, NULL),
(744, '05312819000463', 0, 0, '2024-01-01', '0', '0', 'PARTHA GHOSH', NULL, 'TARUN GHOSH', NULL, 'BISAKHA GHOSH', NULL, '2011-08-05', NULL, NULL, NULL, NULL, NULL, '7029128589', '', NULL, NULL, NULL, 'INDIAN', '50150011529654', 'BDBL0001682', NULL, NULL, NULL, 3, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '32', NULL, NULL),
(745, '05312819000462', 0, 0, '2024-01-01', '0', '0', 'PRIYA GHOSH', NULL, 'SUKDEB GHOSH', NULL, 'JHARNA GHOSH', NULL, '2011-12-07', NULL, NULL, NULL, NULL, NULL, '9098129611', '', NULL, NULL, NULL, 'INDIAN', '5180865041', 'CBIN0280122', NULL, NULL, NULL, 3, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '69', NULL, NULL),
(746, '08895119000042', 0, 0, '2024-01-01', '0', '0', 'PRODIP MANDAL', NULL, 'PRAKAS MANDAL', NULL, 'SUMONA MANDAL', NULL, '2012-01-21', NULL, NULL, NULL, NULL, NULL, '9679819671', '', NULL, NULL, NULL, 'INDIAN', '5021010037086', 'PUNB0RRBBGB', NULL, NULL, NULL, 3, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '7', NULL, NULL),
(747, '01475519000181', 0, 0, '2024-01-01', '0', '0', 'PUSPO', NULL, 'JAMERUL ISLAM', NULL, 'SELINA BIBI', NULL, '2011-12-29', NULL, NULL, NULL, NULL, NULL, '7074289117', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 3, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '67', NULL, NULL),
(748, '05311919000253', 0, 0, '2024-01-01', '0', '0', 'RAFIKUL ISLAM', NULL, 'ALTAB HOSSAIN', NULL, 'DALI BIBI', NULL, '2011-09-04', NULL, NULL, NULL, NULL, NULL, '9647047453', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 3, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '82', NULL, NULL),
(749, '05759119000047', 0, 0, '2024-01-01', '0', '0', 'RAHIMA KHATUN', NULL, 'RENTU SK', NULL, 'CHANDSURA BIBI', NULL, '2011-06-26', NULL, NULL, NULL, NULL, NULL, '9547276771', '', NULL, NULL, NULL, 'INDIAN', '1532101706093', 'PUNB0153210', NULL, NULL, NULL, 3, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '16', NULL, NULL),
(750, '01475519000162', 0, 0, '2024-01-01', '0', '0', 'RAJ MONDAL', NULL, 'GOLAP MONDAL', NULL, 'UTTARA MONDAL', NULL, '2011-12-26', NULL, NULL, NULL, NULL, NULL, '7602656447', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 3, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '28', NULL, NULL),
(751, '05312819000465', 0, 0, '2024-01-01', '0', '0', 'RAJU ALI', NULL, 'SAIBUR RAHAMAN', NULL, 'TANJURA BIBI', NULL, '2011-09-26', NULL, NULL, NULL, NULL, NULL, '9091805596', '', NULL, NULL, NULL, 'INDIAN', '37879335547', 'SBIN0008006', NULL, NULL, NULL, 3, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '23', NULL, NULL),
(752, '05312719000061', 0, 0, '2024-01-01', '0', '0', 'RAMJAN SK', NULL, 'MILAN SK', NULL, 'RINA BIBI', NULL, '2011-08-03', NULL, NULL, NULL, NULL, NULL, '9733829537', '', NULL, NULL, NULL, 'INDIAN', '32635820594', 'SBIN0008006', NULL, NULL, NULL, 3, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '40', NULL, NULL),
(753, '05311919000227', 0, 0, '2024-01-01', '0', '0', 'RIJUWANUR RAHAMAN', NULL, 'ALMAMUN', NULL, 'REJINA BIBI', NULL, '2011-05-31', NULL, NULL, NULL, NULL, NULL, '9733843830', '', NULL, NULL, NULL, 'INDIAN', '5182014076', 'CBIN0280122', NULL, NULL, NULL, 3, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '41', NULL, NULL),
(754, '05312819000460', 0, 0, '2024-01-01', '0', '0', 'RIYA KHATUN', NULL, 'SAIBUR RAHAMAN', NULL, 'TANJURA BIBI', NULL, '2011-09-26', NULL, NULL, NULL, NULL, NULL, '9091805596', '', NULL, NULL, NULL, 'INDIAN', '37879335547', 'SBIN0008006', NULL, NULL, NULL, 3, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '22', NULL, NULL),
(755, '05312919000050', 0, 0, '2024-01-01', '0', '0', 'RIYA KHATUN', NULL, 'AJIJUR SK', NULL, 'JHARNA BIBI', NULL, '2011-07-22', NULL, NULL, NULL, NULL, NULL, '9932236541', '', NULL, NULL, NULL, 'INDIAN', '35100403643', 'SBIN0008855', NULL, NULL, NULL, 3, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '79', NULL, NULL),
(756, '01475519000180', 0, 0, '2024-01-01', '0', '0', 'ROBIUL', NULL, 'MAIDUL ISLAM', NULL, 'ROHIMA BIBI', NULL, '2011-06-12', NULL, NULL, NULL, NULL, NULL, '9093296972', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 3, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '15', NULL, NULL),
(757, '05313719000083', 0, 0, '2024-01-01', '0', '0', 'ROJINA KHATUN', NULL, 'TAHIR ALI', NULL, 'HASENBANU BIBI', NULL, '2011-08-21', NULL, NULL, NULL, NULL, NULL, '7699948514', '', NULL, NULL, NULL, 'INDIAN', '0977010309905', 'PUNB0097720', NULL, NULL, NULL, 3, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '39', NULL, NULL),
(758, '05313019000097', 0, 0, '2024-01-01', '0', '0', 'ROKTIA KHATUN', NULL, 'SAGAR ALI', NULL, 'AFROJA BIBI', NULL, '2011-02-01', NULL, NULL, NULL, NULL, NULL, '8972889919', '', NULL, NULL, NULL, 'INDIAN', '5021030000324', 'PUNB0RRBBGB', NULL, NULL, NULL, 3, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL),
(759, '01783524000001', 0, 0, '2024-01-01', '0', '0', 'ROYEL SK', NULL, 'TUNU SK', NULL, 'ELINA BIBI', NULL, '2011-02-25', NULL, NULL, NULL, NULL, NULL, '8097177150', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 3, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '90', NULL, NULL),
(760, '01475519000178', 0, 0, '2024-01-01', '0', '0', 'RUHAN SK', NULL, 'AYNAL HOQUE', NULL, 'NARGIS BIBI', NULL, '2011-12-14', NULL, NULL, NULL, NULL, NULL, '7699060208', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 3, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '73', NULL, NULL),
(761, '01475519000183', 0, 0, '2024-01-01', '0', '0', 'SAGIR HOSSEN', NULL, 'SAIBUR RAHAMAN', NULL, 'MITALI BIBI', NULL, '2011-04-06', NULL, NULL, NULL, NULL, NULL, '9933059411', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 3, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '43', NULL, NULL),
(762, '01783522002048', 0, 0, '2024-01-01', '0', '0', 'SAINA KHATUN', NULL, 'MD HAJIKUL ALOM', NULL, 'HAZER BIBI', NULL, '2011-06-02', NULL, NULL, NULL, NULL, NULL, '7074026172', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 3, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '9', NULL, NULL),
(763, '05313719000074', 0, 0, '2024-01-01', '0', '0', 'SAKIBUL HASAN', NULL, 'SELIM REJA', NULL, 'GOLAPI BIBI', NULL, '2011-09-01', NULL, NULL, NULL, NULL, NULL, '8515916742', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 3, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '54', NULL, NULL),
(764, '05313219000131', 0, 0, '2024-01-01', '0', '0', 'SAKILA AKTAR', NULL, 'MUSARAF HOSSAIN', NULL, 'RINA BIBI', NULL, '2011-09-29', NULL, NULL, NULL, NULL, NULL, '9088376653', '', NULL, NULL, NULL, 'INDIAN', '33934855768', 'SBIN0008006', NULL, NULL, NULL, 3, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '31', NULL, NULL),
(765, '08896720000002', 0, 0, '2024-01-01', '0', '0', 'SAKILA KHATUN', NULL, 'MD SAKIMUDDIN', NULL, 'SAHANA BIBI', NULL, '2012-01-13', NULL, NULL, NULL, NULL, NULL, '7601877664', '', NULL, NULL, NULL, 'INDIAN', '5021010043120', 'PUNB0RRBBGB', NULL, NULL, NULL, 3, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '76', NULL, NULL),
(766, '08895119000058', 0, 0, '2024-01-01', '0', '0', 'SANKAR MONDAL', NULL, 'LALCHAND MONDAL', NULL, 'DROPOTI MONDAL', NULL, '2011-06-08', NULL, NULL, NULL, NULL, NULL, '9735775963', '', NULL, NULL, NULL, 'INDIAN', '5021010027308', 'PUNB0RRBBGB', NULL, NULL, NULL, 3, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '84', NULL, NULL),
(767, '05313119000084', 0, 0, '2024-01-01', '0', '0', 'SAYAN SK', NULL, 'HABIL SK', NULL, 'JIBANNESHA BIBI', NULL, '2011-12-18', NULL, NULL, NULL, NULL, NULL, '8918374207', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 3, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '13', NULL, NULL),
(768, '05312719000055', 0, 0, '2024-01-01', '0', '0', 'SAYEEDA AFRIN', NULL, 'MD SORIFUL ISLAM', NULL, 'ADORA BIBI', NULL, '2011-09-05', NULL, NULL, NULL, NULL, NULL, '9378205239', '', NULL, NULL, NULL, 'INDIAN', '0977010145305', 'PUNB0097720', NULL, NULL, NULL, 3, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '19', NULL, NULL),
(769, '05839421000032', 0, 0, '2024-01-01', '0', '0', 'SEJARUL SK', NULL, 'NAJIBUR RAHAMAN', NULL, 'ROJINA BIBI', NULL, '2011-09-11', NULL, NULL, NULL, NULL, NULL, '6372582110', '', NULL, NULL, NULL, 'INDIAN', '34721646099', 'SBIN0008006', NULL, NULL, NULL, 3, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '75', NULL, NULL),
(770, '08895119000043', 0, 0, '2024-01-01', '0', '0', 'SHIBA SARKAR', NULL, 'PABAN SARKAR', NULL, 'SUMITA SARKAR', NULL, '2011-01-05', NULL, NULL, NULL, NULL, NULL, '8972427319', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 3, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '65', NULL, NULL),
(771, '05313719000072', 0, 0, '2024-01-01', '0', '0', 'SOHIDUL HOQUE', NULL, 'AINAL HOQUE', NULL, 'MOKLEMA BIBI', NULL, '2011-01-07', NULL, NULL, NULL, NULL, NULL, '8343080442', '', NULL, NULL, NULL, 'INDIAN', '0977010314855', 'PUNB0097720', NULL, NULL, NULL, 3, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '71', NULL, NULL);
INSERT INTO `studentdbs` (`id`, `studentid`, `admBookNo`, `admSlNo`, `admDate`, `prCls`, `prSch`, `name`, `adhaar`, `fname`, `fadhaar`, `mname`, `madhaar`, `dob`, `vill`, `post`, `pstn`, `dist`, `pin`, `mobl`, `ssex`, `phch`, `relg`, `cste`, `natn`, `accNo`, `ifsc`, `micr`, `bnnm`, `brnm`, `stclass_id`, `stsection_id`, `session_id`, `school_id`, `streason`, `enclass_id`, `ensection_id`, `ensession_id`, `enreason`, `crstatus`, `remarks`, `created_at`, `updated_at`) VALUES
(772, '06138021000062', 0, 0, '2024-01-01', '0', '0', 'SOVA KHATUN', NULL, 'SUBHAN SK', NULL, 'MORJINA KHATUN BIBI', NULL, '2011-08-29', NULL, NULL, NULL, NULL, NULL, '9593383448', '', NULL, NULL, NULL, 'INDIAN', '5575010033327', 'PUNB0RRBBGB', NULL, NULL, NULL, 3, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '60', NULL, NULL),
(773, '08895119000056', 0, 0, '2024-01-01', '0', '0', 'SUDEB SARKAR', NULL, 'SUSANTA SARKAR', NULL, 'NABANITA SARKAR', NULL, '2012-02-16', NULL, NULL, NULL, NULL, NULL, '9733893370', '', NULL, NULL, NULL, 'INDIAN', '34498455925', 'SBIN0001870', NULL, NULL, NULL, 3, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '66', NULL, NULL),
(774, '05311919000220', 0, 0, '2024-01-01', '0', '0', 'SUMI KHATUN', NULL, 'RAFIKUL ISLAM', NULL, 'SAHANAJ BEGAM', NULL, '2011-10-18', NULL, NULL, NULL, NULL, NULL, '8537949481', '', NULL, NULL, NULL, 'INDIAN', '5285633486', 'CBIN0280122', NULL, NULL, NULL, 3, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '55', NULL, NULL),
(775, '05313219000141', 0, 0, '2024-01-01', '0', '0', 'SURMILA KHATUN', NULL, 'MUSARAF SK', NULL, 'CHANUARA BIBI', NULL, '2011-08-15', NULL, NULL, NULL, NULL, NULL, '9635879646', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 3, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '61', NULL, NULL),
(776, '08895119000048', 0, 0, '2024-01-01', '0', '0', 'SUSMITA MONDAL', NULL, 'ANANDA MONDAL', NULL, 'HASI MONDAL', NULL, '2011-03-01', NULL, NULL, NULL, NULL, NULL, '7602172753', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 3, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '38', NULL, NULL),
(777, '08895119000039', 0, 0, '2024-01-01', '0', '0', 'SWEET MANDAL', NULL, 'UTTAM MANDAL', NULL, 'UMA MANDAL', NULL, '2011-07-06', NULL, NULL, NULL, NULL, NULL, '6200747399', '', NULL, NULL, NULL, 'INDIAN', '550210100259', '', NULL, NULL, NULL, 3, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '3', NULL, NULL),
(778, '08895119000038', 0, 0, '2024-01-01', '0', '0', 'SWETA MANDAL', NULL, 'BIKASH MANDAL', NULL, 'DOLY MANDAL', NULL, '2011-06-15', NULL, NULL, NULL, NULL, NULL, '6294430619', '', NULL, NULL, NULL, 'INDIAN', '34790874883', 'SBIN0001870', NULL, NULL, NULL, 3, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '27', NULL, NULL),
(779, '05312719000053', 0, 0, '2024-01-01', '0', '0', 'TAJMIRA KHATUN', NULL, 'TAJIBUR RAHAMAN', NULL, 'SHILA BIBI', NULL, '2011-09-11', NULL, NULL, NULL, NULL, NULL, '7699322948', '', NULL, NULL, NULL, 'INDIAN', '41478397224', 'SBIN0008006', NULL, NULL, NULL, 3, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '18', NULL, NULL),
(780, '05313119000070', 0, 0, '2024-01-01', '0', '0', 'TAMANNA YEASMIN', NULL, 'JUEL HOSSAIN', NULL, 'MST REBINA BIBI', NULL, '2011-06-08', NULL, NULL, NULL, NULL, NULL, '9547280877', '', NULL, NULL, NULL, 'INDIAN', '5180318860', 'CBIN0280122', NULL, NULL, NULL, 3, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '21', NULL, NULL),
(781, '05311919000274', 0, 0, '2024-01-01', '0', '0', 'TANIA SULTANA', NULL, 'ROBIUL ISLAM', NULL, 'RINA BIBI', NULL, '2011-11-12', NULL, NULL, NULL, NULL, NULL, '8609539207', '', NULL, NULL, NULL, 'INDIAN', '5351991200', 'CBIN0280122', NULL, NULL, NULL, 3, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '77', NULL, NULL),
(782, '01475519000157', 0, 0, '2024-01-01', '0', '0', 'TASMIRA KHATUN', NULL, 'TARIKUL ISLAM', NULL, 'MOMOTAJ BIBI', NULL, '2011-10-16', NULL, NULL, NULL, NULL, NULL, '9679649406', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 3, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '87', NULL, NULL),
(783, '05311919000230', 0, 0, '2024-01-01', '0', '0', 'UMAIYA KHATUN', NULL, 'NAJIBUR HOSSAIN', NULL, 'JUBEDA BIBI', NULL, '2011-07-11', NULL, NULL, NULL, NULL, NULL, '7586897390', '', NULL, NULL, NULL, 'INDIAN', '36391241603', 'SBIN0008006', NULL, NULL, NULL, 3, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '80', NULL, NULL),
(784, '05313219000129', 0, 0, '2024-01-01', '0', '0', 'YEASMIN KHATUN', NULL, 'ISMAIL SK', NULL, 'ROKIA BIBI', NULL, '2011-11-09', NULL, NULL, NULL, NULL, NULL, '8050285581', '', NULL, NULL, NULL, 'INDIAN', '5021010006025', 'PUNB0RRBBGB', NULL, NULL, NULL, 3, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5', NULL, NULL),
(785, '08895119000070', 0, 0, '2024-01-01', '0', '0', 'ABHIK MANDAL', NULL, 'ARJUN MANDAL', NULL, 'MADHABI MANDAL', NULL, '2010-11-06', NULL, NULL, NULL, NULL, NULL, '9064748278', '', NULL, NULL, NULL, 'INDIAN', '5021010041247', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '38', NULL, NULL),
(786, '05313219000200', 0, 0, '2024-01-01', '0', '0', 'ABUL AKHER', NULL, 'ABDUL AWAL', NULL, 'MUHUBA BIBI', NULL, '2010-11-09', NULL, NULL, NULL, NULL, NULL, '7074461329', '', NULL, NULL, NULL, 'INDIAN', '5287999187', 'CBIN0280122', NULL, NULL, NULL, 4, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '81', NULL, NULL),
(787, '05759119000056', 0, 0, '2024-01-01', '0', '0', 'ABU OBIDE', NULL, 'SAMAUN SK', NULL, 'TARJEMA BIBI', NULL, '2010-09-20', NULL, NULL, NULL, NULL, NULL, '7584088255', '', NULL, NULL, NULL, 'INDIAN', '5575010031602', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '25', NULL, NULL),
(788, '05759119000054', 0, 0, '2024-01-01', '0', '0', 'AJIJA SULTANA', NULL, 'AOYAL HOSSAIN', NULL, 'SOMA BIBI', NULL, '2010-03-22', NULL, NULL, NULL, NULL, NULL, '9734644962', '', NULL, NULL, NULL, 'INDIAN', '5575010035158', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL),
(789, '05313219000201', 0, 0, '2024-01-01', '0', '0', 'AJMIRA KHATUN', NULL, 'ASHADUL HOQUE', NULL, 'FERDOSY BIBI', NULL, '2010-10-29', NULL, NULL, NULL, NULL, NULL, '8942896178', '', NULL, NULL, NULL, 'INDIAN', '1532101700026936', 'PUNB0153210', NULL, NULL, NULL, 4, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '44', NULL, NULL),
(790, '05313119000098', 0, 0, '2024-01-01', '0', '0', 'AKTARA KHATUN', NULL, 'AKBAR ALI', NULL, 'SOVA BIBI', NULL, '2010-09-22', NULL, NULL, NULL, NULL, NULL, '9144224361', '', NULL, NULL, NULL, 'INDIAN', '36169478036', 'SBIN0008006', NULL, NULL, NULL, 4, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '41', NULL, NULL),
(791, '05311919000399', 0, 0, '2024-01-01', '0', '0', 'AKTARUNNESHA .', NULL, 'RAKESH ALI', NULL, 'MORIUM BIBI', NULL, '2010-06-26', NULL, NULL, NULL, NULL, NULL, '7063361048', '', NULL, NULL, NULL, 'INDIAN', '5021020001129', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '84', NULL, NULL),
(792, '05313219000172', 0, 0, '2024-01-01', '0', '0', 'ALIUL SK', NULL, 'LATIB SK', NULL, 'RASIDA BIBI', NULL, '2010-10-27', NULL, NULL, NULL, NULL, NULL, '9093636749', '', NULL, NULL, NULL, 'INDIAN', '5021030001083', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '47', NULL, NULL),
(793, '05313119000109', 0, 0, '2024-01-01', '0', '0', 'ALLAREKHA', NULL, 'AYOAL HOSSAIN', NULL, 'SABINA BIBI', NULL, '2010-06-06', NULL, NULL, NULL, NULL, NULL, '8116869314', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 4, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '67', NULL, NULL),
(794, '05313019000124', 0, 0, '2024-01-01', '0', '0', 'ALO KHATUN', NULL, 'SAIDUL HOQUE', NULL, 'NABIJA BIBI', NULL, '2010-06-05', NULL, NULL, NULL, NULL, NULL, '9002653148', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 4, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '62', NULL, NULL),
(795, '05313219000170', 0, 0, '2024-01-01', '0', '0', 'AMINA KHATUN', NULL, 'KADERI KIBRIA', NULL, 'MAMATAZ BEGAM', NULL, '2010-08-20', NULL, NULL, NULL, NULL, NULL, '8670255450', '', NULL, NULL, NULL, 'INDIAN', '5021030000718', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '14', NULL, NULL),
(796, '01475519000222', 0, 0, '2024-01-01', '0', '0', 'ASIF SK', NULL, 'HAZIKUL ISLAM', NULL, 'ANGURA BIBI', NULL, '2010-02-16', NULL, NULL, NULL, NULL, NULL, '7557085549', '', NULL, NULL, NULL, 'INDIAN', '5021020001140', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '68', NULL, NULL),
(797, '05313119000116', 0, 0, '2024-01-01', '0', '0', 'AWAL HOSSAIN', NULL, 'ABUL KALAM', NULL, 'MAMATAJ BIBI', NULL, '2010-09-18', NULL, NULL, NULL, NULL, NULL, '8172087387', '', NULL, NULL, NULL, 'INDIAN', '33726534467', 'SBIN0008006', NULL, NULL, NULL, 4, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '80', NULL, NULL),
(798, '05313119000099', 0, 0, '2024-01-01', '0', '0', 'AYESHA KHATUN', NULL, 'KUTUBUDDIN SK', NULL, 'MANSURA BIBI', NULL, '2010-08-23', NULL, NULL, NULL, NULL, NULL, '7407226419', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 4, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '3', NULL, NULL),
(799, '05313119000146', 0, 0, '2024-01-01', '0', '0', 'BENJIR HOQUE', NULL, 'MD SENTOO HAQUE', NULL, 'NAJEMA BIBI', NULL, '2010-06-15', NULL, NULL, NULL, NULL, NULL, '9564748399', '', NULL, NULL, NULL, 'INDIAN', '5021010041229', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '11', NULL, NULL),
(800, '01475519000220', 0, 0, '2024-01-01', '0', '0', 'CHIRANJIT MONDAL', NULL, 'KHUDU MONDAL', NULL, 'SRILATA MONDAL', NULL, '2010-04-18', NULL, NULL, NULL, NULL, NULL, '7364926379', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 4, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '85', NULL, NULL),
(801, '08895119000072', 0, 0, '2024-01-01', '0', '0', 'DOLON MANDAL', NULL, 'SASTHI MANDAL', NULL, 'PROBITRA MANDAL', NULL, '2010-03-03', NULL, NULL, NULL, NULL, NULL, '7932804570', '', NULL, NULL, NULL, 'INDIAN', '5021030000129', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '19', NULL, NULL),
(802, '01475519000204', 0, 0, '2024-01-01', '0', '0', 'FIZA KHATUN', NULL, 'FIROJ HOSSAIN', NULL, 'RIMA BIBI', NULL, '2010-05-15', NULL, NULL, NULL, NULL, NULL, '7047026250', '', NULL, NULL, NULL, 'INDIAN', '5021030000094', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '42', NULL, NULL),
(803, '05313719000089', 0, 0, '2024-01-01', '0', '0', 'HAMIDA KHATUN', NULL, 'ASADUL HOQUE', NULL, 'AYESHA BIBI', NULL, '2010-02-06', NULL, NULL, NULL, NULL, NULL, '7699080200', '', NULL, NULL, NULL, 'INDIAN', '5575010030773', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '21', NULL, NULL),
(804, '05313219000182', 0, 0, '2024-01-01', '0', '0', 'HASINA KHATUN', NULL, 'MASUD SK', NULL, 'SAKHINA BIBI', NULL, '2010-10-02', NULL, NULL, NULL, NULL, NULL, '6297635131', '', NULL, NULL, NULL, 'INDIAN', '36938669731', 'SBIN0008006', NULL, NULL, NULL, 4, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '43', NULL, NULL),
(805, '05311919000357', 0, 0, '2024-01-01', '0', '0', 'IBRAHIM SK', NULL, 'SADIKUL ISLAM', NULL, 'RASIDA BIBI', NULL, '2010-08-28', NULL, NULL, NULL, NULL, NULL, '9134572294', '', NULL, NULL, NULL, 'INDIAN', '37164453020', 'SBIN0015048', NULL, NULL, NULL, 4, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '77', NULL, NULL),
(806, '05759119000070', 0, 0, '2024-01-01', '0', '0', 'IDRISH SK', NULL, 'ISLAM SK', NULL, 'ASURA BIBI', NULL, '2010-09-12', NULL, NULL, NULL, NULL, NULL, '9547500334', '', NULL, NULL, NULL, 'INDIAN', '5575010050458', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '71', NULL, NULL),
(807, '05313519000143', 0, 0, '2024-01-01', '0', '0', 'IKBAL HASAN', NULL, 'KAYES ALI', NULL, 'RAKIBA BIBI', NULL, '2010-06-01', NULL, NULL, NULL, NULL, NULL, '7679562103', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 4, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '65', NULL, NULL),
(808, '05313119000104', 0, 0, '2024-01-01', '0', '0', 'ITIKA KHATUN', NULL, 'ISLAM SK', NULL, 'UMESHA BIBI', NULL, '2010-07-10', NULL, NULL, NULL, NULL, NULL, '7602091354', '', NULL, NULL, NULL, 'INDIAN', '5021010033716', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '51', NULL, NULL),
(809, '05312819000484', 0, 0, '2024-01-01', '0', '0', 'JESMIN BEGAM', NULL, 'SORIF SK', NULL, 'MONIRA BIBI', NULL, '2010-11-06', NULL, NULL, NULL, NULL, NULL, '9002507416', '', NULL, NULL, NULL, 'INDIAN', '5352989256', 'CBIN0280122', NULL, NULL, NULL, 4, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '69', NULL, NULL),
(810, '05312719000078', 0, 0, '2024-01-01', '0', '0', 'JISAN SK', NULL, 'KHOSBUR ALI', NULL, 'MARSINA BIBI', NULL, '2010-10-18', NULL, NULL, NULL, NULL, NULL, '8001392987', '', NULL, NULL, NULL, 'INDIAN', '1532101700058713', 'PUNB0153210', NULL, NULL, NULL, 4, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '20', NULL, NULL),
(811, '05313219000174', 0, 0, '2024-01-01', '0', '0', 'LAKSMI SONAR', NULL, 'HIRALAL SONAR', NULL, 'PUSPO SONAR', NULL, '2010-08-08', NULL, NULL, NULL, NULL, NULL, '9593022189', '', NULL, NULL, NULL, 'INDIAN', '5274030000566', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '54', NULL, NULL),
(812, '04366019000324', 0, 0, '2024-01-01', '0', '0', 'MAFIKUL ISLAM', NULL, 'SABIRUL ISLAM', NULL, 'MAFRUJA BIBI', NULL, '2010-11-08', NULL, NULL, NULL, NULL, NULL, '9735268227', '', NULL, NULL, NULL, 'INDIAN', '1314200100002462', 'PUNB0131420', NULL, NULL, NULL, 4, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '72', NULL, NULL),
(813, '05312719000084', 0, 0, '2024-01-01', '0', '0', 'MD AMIR AJMER', NULL, 'MUSARAF HOSSAIN', NULL, 'RINA BIBI', NULL, '2010-08-30', NULL, NULL, NULL, NULL, NULL, '9733829116', '', NULL, NULL, NULL, 'INDIAN', '5021030000121', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '27', NULL, NULL),
(814, '05313719000110', 0, 0, '2024-01-01', '0', '0', 'MD ARYAN ISLAM', NULL, 'MD SAIFUL ISLAM', NULL, 'BILKISH BIBI', NULL, '2010-09-18', NULL, NULL, NULL, NULL, NULL, '7699086185', '', NULL, NULL, NULL, 'INDIAN', '5575010044022', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '60', NULL, NULL),
(815, '10487722000028', 0, 0, '2024-01-01', '0', '0', 'MD ASIF IKBAL', NULL, 'MEKAIL HOQUE', NULL, 'RUMA BIBI', NULL, '2012-02-08', NULL, NULL, NULL, NULL, NULL, '7797359912', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 4, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '63', NULL, NULL),
(816, '01475519000201', 0, 0, '2024-01-01', '0', '0', 'MD HABIB NABI', NULL, 'ENAMUL HOQUE', NULL, 'RAJBANU BIBI', NULL, '2010-12-24', NULL, NULL, NULL, NULL, NULL, '8372941522', '', NULL, NULL, NULL, 'INDIAN', '5021030000850', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '75', NULL, NULL),
(817, '05313119000107', 0, 0, '2024-01-01', '0', '0', 'MD MINAR SK', NULL, 'MD ASRAF ALI', NULL, 'NIPA BIBI', NULL, '2010-04-24', NULL, NULL, NULL, NULL, NULL, '9679005100', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 4, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '49', NULL, NULL),
(818, '05312719000072', 0, 0, '2024-01-01', '0', '0', 'MD NAHID HOSSAIN', NULL, 'MD NABIRUL ISLAM', NULL, 'HASIBA BIBI', NULL, '2010-07-06', NULL, NULL, NULL, NULL, NULL, '7407123141', '', NULL, NULL, NULL, 'INDIAN', '5021010032319', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '13', NULL, NULL),
(819, '01475519000226', 0, 0, '2024-01-01', '0', '0', 'MD RAKIB SK', NULL, 'HABIBUR SK', NULL, 'CHAMPA BIBI', NULL, '2011-01-14', NULL, NULL, NULL, NULL, NULL, '6289326310', '', NULL, NULL, NULL, 'INDIAN', '5165335716', 'CBIN0280122', NULL, NULL, NULL, 4, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '73', NULL, NULL),
(820, '05313719000091', 0, 0, '2024-01-01', '0', '0', 'MD SONY SAIKH', NULL, 'BADAL SAIKH', NULL, 'MST SAMPA BIBI', NULL, '2010-04-03', NULL, NULL, NULL, NULL, NULL, '8514977968', '', NULL, NULL, NULL, 'INDIAN', '1532101700045612', 'PUNB0153210', NULL, NULL, NULL, 4, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '56', NULL, NULL),
(821, '05312719000086', 0, 0, '2024-01-01', '0', '0', 'MD TAMIM IKBAL', NULL, 'MD PIYARUL SK', NULL, 'MST ALMIRA BIBI', NULL, '2010-10-13', NULL, NULL, NULL, NULL, NULL, '9088485403', '', NULL, NULL, NULL, 'INDIAN', '5021030001057', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '28', NULL, NULL),
(822, '05313219000185', 0, 0, '2024-01-01', '0', '0', 'MEHEDI HASAN', NULL, 'SARIKUL ISLAM', NULL, 'SAIMA BIBI', NULL, '2010-06-14', NULL, NULL, NULL, NULL, NULL, '8766991218', '', NULL, NULL, NULL, 'INDIAN', '5021030000710', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '40', NULL, NULL),
(823, '05313119000108', 0, 0, '2024-01-01', '0', '0', 'MEHEDI HASAN', NULL, 'AZAD ALI', NULL, 'ARJINA BIBI', NULL, '2010-08-26', NULL, NULL, NULL, NULL, NULL, '8514961562', '', NULL, NULL, NULL, 'INDIAN', '5021010033451', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '37', NULL, NULL),
(824, '01475519000188', 0, 0, '2024-01-01', '0', '0', 'MIRAJ SULTAN', NULL, 'TIPU SULTAN', NULL, 'MINARA KHATUN', NULL, '2010-06-30', NULL, NULL, NULL, NULL, NULL, '7074756083', '', NULL, NULL, NULL, 'INDIAN', '5179548683', 'CBIN0280122', NULL, NULL, NULL, 4, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', NULL, NULL),
(825, '05759119000074', 0, 0, '2024-01-01', '0', '0', 'MOHIBBULLAH', NULL, 'MOTAHAR ALI', NULL, 'RINA KHATUN', NULL, '2010-12-31', NULL, NULL, NULL, NULL, NULL, '9800334545', '', NULL, NULL, NULL, 'INDIAN', '5021030001005', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '17', NULL, NULL),
(826, '05313119000112', 0, 0, '2024-01-01', '0', '0', 'MONI HASAN', NULL, 'TAHASEN ALI', NULL, 'MOINA BIBI', NULL, '2010-03-14', NULL, NULL, NULL, NULL, NULL, '9635710941', '', NULL, NULL, NULL, 'INDIAN', '33934855633', 'SBIN0008006', NULL, NULL, NULL, 4, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '39', NULL, NULL),
(827, '05312719000067', 0, 0, '2024-01-01', '0', '0', 'MST. HALIMA KHATUN', NULL, 'HAIDAR ALI', NULL, 'AMBIA BIBI', NULL, '2010-08-04', NULL, NULL, NULL, NULL, NULL, '9002154295', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 4, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '15', NULL, NULL),
(828, '05313019000108', 0, 0, '2024-01-01', '0', '0', 'MST RUBINA KHATUN', NULL, 'CHAND MOHAMMAD', NULL, 'RUNA BIBI', NULL, '2010-12-09', NULL, NULL, NULL, NULL, NULL, '7602722310', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 4, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '53', NULL, NULL),
(829, '05311919000389', 0, 0, '2024-01-01', '0', '0', 'MST RUKHSATH RAHMAN', NULL, 'MD ATIKUR RAHAMAN', NULL, 'SANIA RAHAMAN', NULL, '2010-10-11', NULL, NULL, NULL, NULL, NULL, '8145229173', '', NULL, NULL, NULL, 'INDIAN', '5293494780', 'CBIN0280122', NULL, NULL, NULL, 4, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8', NULL, NULL),
(830, '05313219000162', 0, 0, '2024-01-01', '0', '0', 'MURSALIM SK', NULL, 'MURTUJA', NULL, 'HASINA BIBI', NULL, '2010-02-06', NULL, NULL, NULL, NULL, NULL, '7047157905', '', NULL, NULL, NULL, 'INDIAN', '5021030001047', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '46', NULL, NULL),
(831, '05312819000469', 0, 0, '2024-01-01', '0', '0', 'NASRIN KHATUN', NULL, 'RABIUL HOQUE', NULL, 'HAJERA BIBI', NULL, '2010-02-05', NULL, NULL, NULL, NULL, NULL, '9382772377', '', NULL, NULL, NULL, 'INDIAN', '2998269086', 'CBIN0280122', NULL, NULL, NULL, 4, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '59', NULL, NULL),
(832, '01475519000205', 0, 0, '2024-01-01', '0', '0', 'NASRIN PARVIN', NULL, 'ABDUL MOMIN SK', NULL, 'SABINA BIBI', NULL, '2010-12-21', NULL, NULL, NULL, NULL, NULL, '9734618853', '', NULL, NULL, NULL, 'INDIAN', '41287648142', 'SBIN0008006', NULL, NULL, NULL, 4, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '57', NULL, NULL),
(833, '05313219000183', 0, 0, '2024-01-01', '0', '0', 'NICE KHATUN', NULL, 'NUR HOSSAIN', NULL, 'SABINA BIBI', NULL, '2010-09-26', NULL, NULL, NULL, NULL, NULL, '6201831051', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 4, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '45', NULL, NULL),
(834, '05312719000081', 0, 0, '2024-01-01', '0', '0', 'NISA KHATUN', NULL, 'MD ROKIBUR RAHAMAN', NULL, 'HASINA BIBI', NULL, '2010-12-06', NULL, NULL, NULL, NULL, NULL, '7364001827', '', NULL, NULL, NULL, 'INDIAN', '5021030000108', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '35', NULL, NULL),
(835, '05759119000063', 0, 0, '2024-01-01', '0', '0', 'NURAMIN SK', NULL, 'HAKIM SK', NULL, 'NURESHA BIBI', NULL, '2010-06-12', NULL, NULL, NULL, NULL, NULL, '9609252324', '', NULL, NULL, NULL, 'INDIAN', '5575010037101', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '74', NULL, NULL),
(836, '05313519000160', 0, 0, '2024-01-01', '0', '0', 'NUR HABIB', NULL, 'NAJIBUR SK', NULL, 'MUR MAHAL BIBI', NULL, '2010-12-10', NULL, NULL, NULL, NULL, NULL, '7699556747', '', NULL, NULL, NULL, 'INDIAN', '5575010032090', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '48', NULL, NULL),
(837, '05759119000058', 0, 0, '2024-01-01', '0', '0', 'NUR ISLAM', NULL, 'TIARUL ISLAM', NULL, 'MST TUSUBA BIBI', NULL, '2010-10-05', NULL, NULL, NULL, NULL, NULL, '8346811779', '', NULL, NULL, NULL, 'INDIAN', '5575010044697', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '26', NULL, NULL),
(838, '05759119000055', 0, 0, '2024-01-01', '0', '0', 'NURJAHAN KHATUN', NULL, 'NAJIMUDDIN', NULL, 'REJINA BIBI', NULL, '2010-04-03', NULL, NULL, NULL, NULL, NULL, '8116870108', '', NULL, NULL, NULL, 'INDIAN', '5575010031596', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '29', NULL, NULL),
(839, '05312719000082', 0, 0, '2024-01-01', '0', '0', 'PARUL KHATUN', NULL, 'KAMAL SK', NULL, 'MENOKA BIBI', NULL, '2010-11-24', NULL, NULL, NULL, NULL, NULL, '7384227449', '', NULL, NULL, NULL, 'INDIAN', '1726010111041', 'PUNB0172620', NULL, NULL, NULL, 4, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '61', NULL, NULL),
(840, '05313219000167', 0, 0, '2024-01-01', '0', '0', 'PAYEL KHATUN', NULL, 'MAJRUL ISLAM', NULL, 'REKSONA BIBI', NULL, '2010-01-30', NULL, NULL, NULL, NULL, NULL, '9091179859', '', NULL, NULL, NULL, 'INDIAN', '1532101700038171', 'PUNB0153210', NULL, NULL, NULL, 4, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '30', NULL, NULL),
(841, '05312719000087', 0, 0, '2024-01-01', '0', '0', 'RAHUL SK', NULL, 'ABDUS SALAM', NULL, 'BULBULI', NULL, '2010-09-14', NULL, NULL, NULL, NULL, NULL, '8116851249', '', NULL, NULL, NULL, 'INDIAN', '5021030000040', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '79', NULL, NULL),
(842, '05313119000101', 0, 0, '2024-01-01', '0', '0', 'RAJIFA KHATUN', NULL, 'RASEL MAMUD', NULL, 'HANIFA BIBI', NULL, '2010-01-27', NULL, NULL, NULL, NULL, NULL, '9679400584', '', NULL, NULL, NULL, 'INDIAN', '5021010033859', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '31', NULL, NULL),
(843, '05313219000175', 0, 0, '2024-01-01', '0', '0', 'RAJ SK', NULL, 'SAFIKUL ISLAM', NULL, 'KAKALI BIBI', NULL, '2010-06-24', NULL, NULL, NULL, NULL, NULL, '8116341447', '', NULL, NULL, NULL, 'INDIAN', '5021010031150', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '64', NULL, NULL),
(844, '05312719000077', 0, 0, '2024-01-01', '0', '0', ' RASHIDA KHATUN', NULL, 'BELAL SK', NULL, 'MOYNA BIBI', NULL, '2010-11-14', NULL, NULL, NULL, NULL, NULL, '7872742836', '', NULL, NULL, NULL, 'INDIAN', '5021030000746', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '58', NULL, NULL),
(845, '05313219000173', 0, 0, '2024-01-01', '0', '0', 'RIKTA KHATUN', NULL, 'MIJANUR RAHAMAN', NULL, 'RUMA BIBI', NULL, '2010-08-11', NULL, NULL, NULL, NULL, NULL, '8116509276', '', NULL, NULL, NULL, 'INDIAN', '5021030000717', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '23', NULL, NULL),
(846, '05313119000113', 0, 0, '2024-01-01', '0', '0', 'ROHAN SK', NULL, 'SAID ALI', NULL, 'KHADIJA BIBI', NULL, '2010-08-22', NULL, NULL, NULL, NULL, NULL, '6295103976', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 4, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '66', NULL, NULL),
(847, '05313119000119', 0, 0, '2024-01-01', '0', '0', 'ROHIT SK', NULL, 'NASIRUDDIN SEIKH', NULL, 'MAMATA KHATUN', NULL, '2010-12-26', NULL, NULL, NULL, NULL, NULL, '7699080141', '', NULL, NULL, NULL, 'INDIAN', '5021010033442', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '70', NULL, NULL),
(848, '05313019000105', 0, 0, '2024-01-01', '0', '0', 'RUBINA KHATUN', NULL, 'BELAL HOSSAIN', NULL, 'BAKU SARA BIBI', NULL, '2010-05-23', NULL, NULL, NULL, NULL, NULL, '9735268298', '', NULL, NULL, NULL, 'INDIAN', '5021020000932', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5', NULL, NULL),
(849, '05313219000181', 0, 0, '2024-01-01', '0', '0', 'SABANI ANSARI', NULL, 'SELIM REJA', NULL, 'RUMA BIBI', NULL, '2010-05-18', NULL, NULL, NULL, NULL, NULL, '9933739485', '', NULL, NULL, NULL, 'INDIAN', '5021030001246', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '18', NULL, NULL),
(850, '05313719000107', 0, 0, '2024-01-01', '0', '0', 'SAHIN SK', NULL, 'JAHANGIR HOSSAIN', NULL, 'MURSHIDA BIBI', NULL, '2010-05-03', NULL, NULL, NULL, NULL, NULL, '9134730732', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 4, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '36', NULL, NULL),
(851, '05313119000111', 0, 0, '2024-01-01', '0', '0', 'SAID HOQUE', NULL, 'SARIFUL ISLAM', NULL, 'AKLEMA BIBI', NULL, '2010-09-30', NULL, NULL, NULL, NULL, NULL, '7063377920', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 4, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '50', NULL, NULL),
(852, '05312919000089', 0, 0, '2024-01-01', '0', '0', 'SAINA KHATUN', NULL, 'MD BELAL HOSSAIN', NULL, 'MST SIMA KHATUN', NULL, '2010-10-21', NULL, NULL, NULL, NULL, NULL, '9679815313', '', NULL, NULL, NULL, 'INDIAN', '0977010306782', 'PUNB0097720', NULL, NULL, NULL, 4, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '82', NULL, NULL),
(853, '01783521000017', 0, 0, '2024-01-01', '0', '0', 'SAMIMA KHATUN', NULL, 'SELIM SK', NULL, 'RAHIMA BIBI', NULL, '2011-03-30', NULL, NULL, NULL, NULL, NULL, '7430872080', '', NULL, NULL, NULL, 'INDIAN', '5575010043670', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '34', NULL, NULL),
(854, '05312719000071', 0, 0, '2024-01-01', '0', '0', 'SANJIDA YEASMIN', NULL, 'MD RABIUL AWAL', NULL, 'DILRUBA BIBI', NULL, '2010-03-16', NULL, NULL, NULL, NULL, NULL, '9641294537', '', NULL, NULL, NULL, 'INDIAN', '5575010037907', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4', NULL, NULL),
(855, '05312719000075', 0, 0, '2024-01-01', '0', '0', 'SNEHA REZA', NULL, 'SELIM REZA', NULL, 'RUMIARA BIBI', NULL, '2010-07-03', NULL, NULL, NULL, NULL, NULL, '8670932286', '', NULL, NULL, NULL, 'INDIAN', '5021030000332', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '16', NULL, NULL),
(856, '05312719000068', 0, 0, '2024-01-01', '0', '0', 'SOHANA AKHTAR', NULL, 'MD AWAL HOSSAIN', NULL, 'MST RUBINA BIBI', NULL, '2010-09-20', NULL, NULL, NULL, NULL, NULL, '9564357233', '', NULL, NULL, NULL, 'INDIAN', '5021010033831', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '12', NULL, NULL),
(857, '05313719000104', 0, 0, '2024-01-01', '0', '0', 'SONALI KHATUN', NULL, 'KAMRUJJAMAN', NULL, 'TUHINA BIBI', NULL, '2010-02-18', NULL, NULL, NULL, NULL, NULL, '7074734465', '', NULL, NULL, NULL, 'INDIAN', '5575010028149', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '83', NULL, NULL),
(858, '05313119000100', 0, 0, '2024-01-01', '0', '0', 'SUHANA YEASMIN', NULL, 'HABIBUR RAHAMAN', NULL, 'KHADIJA KHATUN BIBI', NULL, '2010-11-18', NULL, NULL, NULL, NULL, NULL, '8609727760', '', NULL, NULL, NULL, 'INDIAN', '5021030000132', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '22', NULL, NULL),
(859, '05313219000189', 0, 0, '2024-01-01', '0', '0', 'SUHITA SULTANA', NULL, 'MAINUL SK', NULL, 'JAMILA BIBI', NULL, '2010-12-04', NULL, NULL, NULL, NULL, NULL, '7699578254', '', NULL, NULL, NULL, 'INDIAN', '1532101700026954', 'PUNB0153210', NULL, NULL, NULL, 4, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '32', NULL, NULL),
(860, '05313719000100', 0, 0, '2024-01-01', '0', '0', 'SULTANA KHATUN', NULL, 'AMIRUL ISLAM', NULL, 'SAYERA BIBI', NULL, '2010-12-09', NULL, NULL, NULL, NULL, NULL, '8343026273', '', NULL, NULL, NULL, 'INDIAN', '5575010031781', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '24', NULL, NULL),
(861, '01475519000193', 0, 0, '2024-01-01', '0', '0', 'TABASSUM FARJANA', NULL, 'MD SARFARAJ NAWAJ', NULL, 'MST ROSNARA KHATUN', NULL, '2010-06-08', NULL, NULL, NULL, NULL, NULL, '9732687709', '', NULL, NULL, NULL, 'INDIAN', '5021030000042', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6', NULL, NULL),
(862, '05311919000359', 0, 0, '2024-01-01', '0', '0', 'TAJMIRA KHATUN', NULL, 'HAZRAT BELLAL', NULL, 'NAJEMA BIBI', NULL, '2010-03-20', NULL, NULL, NULL, NULL, NULL, '6297906937', '', NULL, NULL, NULL, 'INDIAN', '5177665297', 'CBIN0280122', NULL, NULL, NULL, 4, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '76', NULL, NULL),
(863, '01475519000191', 0, 0, '2024-01-01', '0', '0', 'TAMANNA AZMI', NULL, 'MD BABAR ALI', NULL, 'MST MONIRA KHATUN', NULL, '2010-05-30', NULL, NULL, NULL, NULL, NULL, '7384856338', '', NULL, NULL, NULL, 'INDIAN', '5021010033804', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '7', NULL, NULL),
(864, '05313119000102', 0, 0, '2024-01-01', '0', '0', 'TAMANNA YEASMIN', NULL, 'TARIKUL ISLAM', NULL, 'FERDOSA BIBI', NULL, '2010-11-15', NULL, NULL, NULL, NULL, NULL, '7872189853', '', NULL, NULL, NULL, 'INDIAN', '5021030000112', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '52', NULL, NULL),
(865, '05311919000382', 0, 0, '2024-01-01', '0', '0', 'TARAK MANDAL', NULL, 'SUDHAN MANDAL', NULL, 'MAHARANI MANDAL', NULL, '2010-07-15', NULL, NULL, NULL, NULL, NULL, '8670993204', '', NULL, NULL, NULL, 'INDIAN', '33947854204', 'SBIN0008006', NULL, NULL, NULL, 4, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '78', NULL, NULL),
(866, '01475519000196', 0, 0, '2024-01-01', '0', '0', 'TARANNUM FARHANA', NULL, 'MD SARFARAJ NAWAJ', NULL, 'MST ROSNARA KHATUN', NULL, '2010-06-08', NULL, NULL, NULL, NULL, NULL, '9732687709', '', NULL, NULL, NULL, 'INDIAN', '5021030000037', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '10', NULL, NULL),
(867, '05313519000151', 0, 0, '2024-01-01', '0', '0', 'TINA KHATUN', NULL, 'RAJU SK', NULL, 'MAMOTAJ BIBI', NULL, '2010-01-27', NULL, NULL, NULL, NULL, NULL, '8101195023', '', NULL, NULL, NULL, 'INDIAN', '5575010031578', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '33', NULL, NULL),
(868, '08895119000069', 0, 0, '2024-01-01', '0', '0', 'TINA SARKAR', NULL, 'JAGADIS SARKAR', NULL, 'SARMILA SARKAR', NULL, '2010-11-28', NULL, NULL, NULL, NULL, NULL, '7074537788', '', NULL, NULL, NULL, 'INDIAN', '5021030000151', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '55', NULL, NULL),
(869, '05313119000105', 0, 0, '2024-01-01', '0', '0', 'UMMEHANI KHATUN', NULL, 'FATIK SK', NULL, 'MST NASIMA BIBI', NULL, '2010-11-29', NULL, NULL, NULL, NULL, NULL, '9635641528', '', NULL, NULL, NULL, 'INDIAN', '5021030000558', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '9', NULL, NULL),
(870, '05313019000119', 0, 0, '2024-01-01', '0', '0', 'ABU RUMMAN SK', NULL, 'KAMAL HOSSAIN', NULL, 'RUKSENA BIBI', NULL, '2010-10-24', NULL, NULL, NULL, NULL, NULL, '9635791550', '', NULL, NULL, NULL, 'INDIAN', '36725354202', 'SBIN0008006', NULL, NULL, NULL, 4, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '57', NULL, NULL),
(871, '01475519000217', 0, 0, '2024-01-01', '0', '0', 'AFRIN BEGAM', NULL, 'MD OLI AHAD SK', NULL, 'MAIDA KHATUN', NULL, '2010-12-18', NULL, NULL, NULL, NULL, NULL, '7797154706', '', NULL, NULL, NULL, 'INDIAN', '5021030000135', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '72', NULL, NULL),
(872, '05759119000071', 0, 0, '2024-01-01', '0', '0', 'AJIM SK', NULL, 'RENTU SK', NULL, 'KOLPONA BIBI', NULL, '2010-04-02', NULL, NULL, NULL, NULL, NULL, '9382498301', '', NULL, NULL, NULL, 'INDIAN', '0977010311090', 'PUNB0097720', NULL, NULL, NULL, 4, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '66', NULL, NULL),
(873, '01475519000221', 0, 0, '2024-01-01', '0', '0', 'ALIA KHATUN', NULL, 'AL AMIN SK', NULL, 'RIPA BIBI', NULL, '2010-04-24', NULL, NULL, NULL, NULL, NULL, '7584994346', '', NULL, NULL, NULL, 'INDIAN', '5021020000693', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '11', NULL, NULL),
(874, '01475519000229', 0, 0, '2024-01-01', '0', '0', 'AMANU HOSSAIN', NULL, 'SIDDIQUE SK', NULL, 'SOHAGI BIBI', NULL, '2010-11-01', NULL, NULL, NULL, NULL, NULL, '8016183955', '', NULL, NULL, NULL, 'INDIAN', '5021010003901', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '46', NULL, NULL),
(875, '01783521000022', 0, 0, '2024-01-01', '0', '0', 'ASHIK SK', NULL, 'ATIKUL SK', NULL, 'HALIMA BIBI', NULL, '2009-07-12', NULL, NULL, NULL, NULL, NULL, '8172596243', '', NULL, NULL, NULL, 'INDIAN', '5021020001075', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '40', NULL, NULL),
(876, '05759119000073', 0, 0, '2024-01-01', '0', '0', 'ASIK HAQUE', NULL, 'AINAL HAQUE', NULL, 'PARVINA BIBI', NULL, '2009-03-27', NULL, NULL, NULL, NULL, NULL, '7872866133', '', NULL, NULL, NULL, 'INDIAN', '35165594610', 'SBIN0008006', NULL, NULL, NULL, 4, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '34', NULL, NULL),
(877, '05759119000057', 0, 0, '2024-01-01', '0', '0', 'AUB ALI', NULL, 'APEL', NULL, 'AKLEMA BIBI', NULL, '2010-09-28', NULL, NULL, NULL, NULL, NULL, '8348506668', '', NULL, NULL, NULL, 'INDIAN', '5575010031709', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '85', NULL, NULL),
(878, '05759119000059', 0, 0, '2024-01-01', '0', '0', 'BABY YEASMIN', NULL, 'ISMAIL HOQUE', NULL, 'ULEMA BIBI', NULL, '2010-11-07', NULL, NULL, NULL, NULL, NULL, '6994641338', '', NULL, NULL, NULL, 'INDIAN', '5575010043935', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '16', NULL, NULL),
(879, '05312819000477', 0, 0, '2024-01-01', '0', '0', 'BARSHA GHOSH', NULL, 'DILIP GHOSH', NULL, 'MAMONI GHOSH', NULL, '2010-07-28', NULL, NULL, NULL, NULL, NULL, '7063416070', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 4, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '54', NULL, NULL),
(880, '08895119000076', 0, 0, '2024-01-01', '0', '0', 'DEBIKA MANDAL', NULL, 'LALCHAND MANDAL', NULL, 'DIPALI MANDAL', NULL, '2010-11-29', NULL, NULL, NULL, NULL, NULL, '8100862517', '', NULL, NULL, NULL, 'INDIAN', '5021010037785', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '61', NULL, NULL),
(881, '05759119000062', 0, 0, '2024-01-01', '0', '0', 'DINA KHATUN', NULL, 'ASRAUL HAQUE', NULL, 'GOLAPI BIBI', NULL, '2010-11-23', NULL, NULL, NULL, NULL, NULL, '7319207227', '', NULL, NULL, NULL, 'INDIAN', '5575010043591', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '30', NULL, NULL),
(882, '05312819000474', 0, 0, '2024-01-01', '0', '0', 'DISHA GHOSH', NULL, 'SWADESH GHOSH', NULL, 'SHANTILATA GHOSH', NULL, '2010-10-17', NULL, NULL, NULL, NULL, NULL, '9002472100', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 4, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '58', NULL, NULL),
(883, '01475519000218', 0, 0, '2024-01-01', '0', '0', 'ELMA KHATUN', NULL, 'MD HABIBULLAH', NULL, 'SHILA KHATUN', NULL, '2010-03-06', NULL, NULL, NULL, NULL, NULL, '7584813040', '', NULL, NULL, NULL, 'INDIAN', '5021030000434', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '83', NULL, NULL),
(884, '01783521000024', 0, 0, '2024-01-01', '0', '0', 'FARUK ISLAM', NULL, 'OSMAN ALI', NULL, 'RAHIMA BIBI', NULL, '2010-09-24', NULL, NULL, NULL, NULL, NULL, '8343080447', '', NULL, NULL, NULL, 'INDIAN', '5021010001517', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '42', NULL, NULL),
(885, '05759119000064', 0, 0, '2024-01-01', '0', '0', 'HALIMA KHATUN', NULL, 'HAJIKUL ISLAM', NULL, 'RUPALI BIBI', NULL, '2010-08-03', NULL, NULL, NULL, NULL, NULL, '9547876805', '', NULL, NULL, NULL, 'INDIAN', '33113049886', 'SBIN0008006', NULL, NULL, NULL, 4, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '38', NULL, NULL),
(886, '01783521000015', 0, 0, '2024-01-01', '0', '0', 'HASIDA KHATUN', NULL, 'OLIAR HASSAN', NULL, 'MST MAFRUJA BIBI', NULL, '2010-02-27', NULL, NULL, NULL, NULL, NULL, '7363801739', '', NULL, NULL, NULL, 'INDIAN', '5021030000133', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '9', NULL, NULL),
(887, '01475619000077', 0, 0, '2024-01-01', '0', '0', 'IBRAHIM SK', NULL, 'SORIFUL ISLAM', NULL, 'RAKHA BIBI', NULL, '2010-10-05', NULL, NULL, NULL, NULL, NULL, '7602935684', '', NULL, NULL, NULL, 'INDIAN', '5021010035282', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '63', NULL, NULL),
(888, '05759119000065', 0, 0, '2024-01-01', '0', '0', 'ISRAR AHAMAD', NULL, 'MAHARAM', NULL, 'SIMA BIBI', NULL, '2010-05-14', NULL, NULL, NULL, NULL, NULL, '8515863152', '', NULL, NULL, NULL, 'INDIAN', '5021010031277', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '31', NULL, NULL),
(889, '05313119000103', 0, 0, '2024-01-01', '0', '0', 'JAMILA PARVIN', NULL, 'JAHANGIR ALAM', NULL, 'RASIDDA BIBI', NULL, '2010-08-16', NULL, NULL, NULL, NULL, NULL, '7699160101', '', NULL, NULL, NULL, 'INDIAN', '5021030000118', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '18', NULL, NULL),
(890, '05759119000069', 0, 0, '2024-01-01', '0', '0', 'JANNATUN NASHA', NULL, 'NAZRUL ISLAM', NULL, 'RINA BIBI', NULL, '2010-07-16', NULL, NULL, NULL, NULL, NULL, '8116851191', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 4, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '19', NULL, NULL),
(891, '01783521000009', 0, 0, '2024-01-01', '0', '0', 'JULI KHATUN', NULL, 'JAMAL SK', NULL, 'JYOSNA BIBI', NULL, '2011-01-10', NULL, NULL, NULL, NULL, NULL, '8348105689', '', NULL, NULL, NULL, 'INDIAN', '5290861244', 'CBIN0280122', NULL, NULL, NULL, 4, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '27', NULL, NULL),
(892, '01783521000014', 0, 0, '2024-01-01', '0', '0', 'KABITA KHATUN', NULL, 'MD JULFIKAR ALI', NULL, 'REHENA BIBI', NULL, '2010-02-06', NULL, NULL, NULL, NULL, NULL, '8016554619', '', NULL, NULL, NULL, 'INDIAN', '5021021687526', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '10', NULL, NULL),
(893, '05313719000086', 0, 0, '2024-01-01', '0', '0', 'MAHABUBA KHATUN', NULL, 'MD MAHATAB ALI', NULL, 'RUMA BIBI', NULL, '2010-06-09', NULL, NULL, NULL, NULL, NULL, '9093308229', '', NULL, NULL, NULL, 'INDIAN', '5575010033637', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '33', NULL, NULL),
(894, '01475619000079', 0, 0, '2024-01-01', '0', '0', 'MAHIDA KHATUN', NULL, 'ANIKUL ISLAM', NULL, 'LILA BIBI', NULL, '2011-03-10', NULL, NULL, NULL, NULL, NULL, '8116851232', '', NULL, NULL, NULL, 'INDIAN', '20450993164', 'SBIN0015048', NULL, NULL, NULL, 4, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '62', NULL, NULL),
(895, '01783521000029', 0, 0, '2024-01-01', '0', '0', 'MAMONI KHATUN', NULL, 'ENAMUL ALI', NULL, 'TANJILA BIBI', NULL, '2011-01-21', NULL, NULL, NULL, NULL, NULL, '8145110036', '', NULL, NULL, NULL, 'INDIAN', '5021010000842', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '73', NULL, NULL),
(896, '05313019000113', 0, 0, '2024-01-01', '0', '0', 'MASUMA KHATUN', NULL, 'SABIRUL ISLAM', NULL, 'MOUSUMI BIBI', NULL, '2010-03-01', NULL, NULL, NULL, NULL, NULL, '9933766825', '', NULL, NULL, NULL, 'INDIAN', '38664057388', 'SBIN0008855', NULL, NULL, NULL, 4, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '13', NULL, NULL),
(897, '05313119000115', 0, 0, '2024-01-01', '0', '0', 'MASUM SK', NULL, 'SAMSUL SK', NULL, 'SIMA BIBI', NULL, '2010-10-26', NULL, NULL, NULL, NULL, NULL, '8158838201', '', NULL, NULL, NULL, 'INDIAN', '37915925114', 'SBIN0008006', NULL, NULL, NULL, 4, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '7', NULL, NULL),
(898, '01783521000012', 0, 0, '2024-01-01', '0', '0', 'MD FIROJ SK', NULL, 'ABU HOSSAIN', NULL, 'MST ANISHA BIBI', NULL, '2011-06-24', NULL, NULL, NULL, NULL, NULL, '8972382762', '', NULL, NULL, NULL, 'INDIAN', '5575010044457', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '39', NULL, NULL),
(899, '01475519000206', 0, 0, '2024-01-01', '0', '0', 'MD ISHAN ALI', NULL, 'JAINAL ABEDIN', NULL, 'ARUNA BIBI', NULL, '2010-05-01', NULL, NULL, NULL, NULL, NULL, '7384036489', '', NULL, NULL, NULL, 'INDIAN', '5021030000044', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '48', NULL, NULL),
(900, '05313119000118', 0, 0, '2024-01-01', '0', '0', 'MD NUR ALI', NULL, 'BANU SK', NULL, 'AFROJA BIBI', NULL, '2010-10-26', NULL, NULL, NULL, NULL, NULL, '6297420471', '', NULL, NULL, NULL, 'INDIAN', '35643246773', 'SBIN0008006', NULL, NULL, NULL, 4, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '80', NULL, NULL),
(901, '01475519000199', 0, 0, '2024-01-01', '0', '0', 'MD ROFIK HASAN', NULL, 'ASRAFUL HOSSAIN', NULL, 'RABIA BIBI', NULL, '2011-01-06', NULL, NULL, NULL, NULL, NULL, '9002119903', '', NULL, NULL, NULL, 'INDIAN', '0977010329842', 'PUNB0097720', NULL, NULL, NULL, 4, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '3', NULL, NULL),
(902, '05311919000355', 0, 0, '2024-01-01', '0', '0', 'MEHEBOOB ALAM', NULL, 'JINARUL SK', NULL, 'SUKLEMA BIBI', NULL, '2010-05-06', NULL, NULL, NULL, NULL, NULL, '7595036180', '', NULL, NULL, NULL, 'INDIAN', '34234377333', 'SBIN0015048', NULL, NULL, NULL, 4, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '76', NULL, NULL),
(903, '03643720000036', 0, 0, '2024-01-01', '0', '0', 'MEHEDI  HASAN', NULL, 'AJIM  SK', NULL, 'FORIDA  BIBI', NULL, '2010-07-09', NULL, NULL, NULL, NULL, NULL, '7029840596', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 4, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '79', NULL, NULL),
(904, '05311919000377', 0, 0, '2024-01-01', '0', '0', 'MEHEDI HASAN', NULL, 'AKTER ALI', NULL, 'CHAMPA BIBI', NULL, '2010-05-06', NULL, NULL, NULL, NULL, NULL, '7797631210', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 4, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '84', NULL, NULL),
(905, '05313119000117', 0, 0, '2024-01-01', '0', '0', 'MIMRAN HOSSAIN', NULL, 'ANWAR HOSSAIN', NULL, 'ROHIMA BIBI', NULL, '2010-11-04', NULL, NULL, NULL, NULL, NULL, '9567182409', '', NULL, NULL, NULL, 'INDIAN', '5021019990032', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '28', NULL, NULL),
(906, '05312719000069', 0, 0, '2024-01-01', '0', '0', 'MST HASIBA KHATUN', NULL, 'HASIM SK', NULL, 'JHARNA BIBI', NULL, '2010-02-01', NULL, NULL, NULL, NULL, NULL, '9800367951', '', NULL, NULL, NULL, 'INDIAN', '5021020000953', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL),
(907, '01475519000202', 0, 0, '2024-01-01', '0', '0', 'MUSARAF HOSSAIN', NULL, 'MANUYAR HOSSAIN', NULL, 'RINA KHATUN BIBI', NULL, '2010-08-21', NULL, NULL, NULL, NULL, NULL, '9002030395', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 4, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '74', NULL, NULL),
(908, '01783521000028', 0, 0, '2024-01-01', '0', '0', 'MUSKAN HABIB', NULL, 'AKBAR ALI', NULL, 'MERINA BIBI', NULL, '2010-12-10', NULL, NULL, NULL, NULL, NULL, '6298968636', '', NULL, NULL, NULL, 'INDIAN', '5575010043661', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '47', NULL, NULL),
(909, '05759119000060', 0, 0, '2024-01-01', '0', '0', 'MUSLIMA KHATUN', NULL, 'MD MUKTAR ALI', NULL, 'HASINA BIBI', NULL, '2010-07-12', NULL, NULL, NULL, NULL, NULL, '7074535541', '', NULL, NULL, NULL, 'INDIAN', '0977010327657', 'PUNB0097720', NULL, NULL, NULL, 4, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '23', NULL, NULL),
(910, '05313019000123', 0, 0, '2024-01-01', '0', '0', 'NASIMA KHATUN', NULL, 'SAIBUR', NULL, 'SELINA BIBI', NULL, '2010-01-29', NULL, NULL, NULL, NULL, NULL, '9134623678', '', NULL, NULL, NULL, 'INDIAN', '5021020001130', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '17', NULL, NULL),
(911, '05311919000386', 0, 0, '2024-01-01', '0', '0', 'NEHA KHATUN', NULL, 'HAJIKUL ISLAM', NULL, 'KHADIZA BIBI', NULL, '2010-09-05', NULL, NULL, NULL, NULL, NULL, '8768687488', '', NULL, NULL, NULL, 'INDIAN', '34315971587', 'SBIN0008006', NULL, NULL, NULL, 4, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '78', NULL, NULL),
(912, '05313219000176', 0, 0, '2024-01-01', '0', '0', 'NUR HASNARA', NULL, 'SELIM SK', NULL, 'AYESHA BIBI', NULL, '2010-06-28', NULL, NULL, NULL, NULL, NULL, '9002510935', '', NULL, NULL, NULL, 'INDIAN', '5021030000164', '', NULL, NULL, NULL, 4, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '12', NULL, NULL),
(913, '01783521000011', 0, 0, '2024-01-01', '0', '0', 'NUR HASSAN', NULL, 'AYUB ALI', NULL, 'CHAMPA KHATUN', NULL, '2010-12-14', NULL, NULL, NULL, NULL, NULL, '9733776174', '', NULL, NULL, NULL, 'INDIAN', '5021010042510', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '37', NULL, NULL),
(914, '08895119000065', 0, 0, '2024-01-01', '0', '0', 'POSURAM MONDAL', NULL, 'BHIKU MONDAL', NULL, 'ANIMA MONDAL', NULL, '2010-12-18', NULL, NULL, NULL, NULL, NULL, '7074613189', '', NULL, NULL, NULL, 'INDIAN', '5021030000106', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '25', NULL, NULL),
(915, '08895119000064', 0, 0, '2024-01-01', '0', '0', 'RAJKUMAR MONDAL', NULL, 'RAJU MONDAL', NULL, 'RADHARANI MONDAL', NULL, '2010-09-15', NULL, NULL, NULL, NULL, NULL, '7074298063', '', NULL, NULL, NULL, 'INDIAN', '5021030000165', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '22', NULL, NULL),
(916, '08895119000067', 0, 0, '2024-01-01', '0', '0', 'RAJ MANDAL', NULL, 'JOYDEV MANDAL', NULL, 'ITI MANDAL', NULL, '2010-06-29', NULL, NULL, NULL, NULL, NULL, '6297803541', '', NULL, NULL, NULL, 'INDIAN', '5021010038641', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6', NULL, NULL),
(917, '01475519000227', 0, 0, '2024-01-01', '0', '0', 'RAKIB SK', NULL, 'PIARUL ISLAM', NULL, 'SORIFA BIBI', NULL, '2010-06-11', NULL, NULL, NULL, NULL, NULL, '8016792947', '', NULL, NULL, NULL, 'INDIAN', '5021030000041', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '45', NULL, NULL),
(918, '08895119000061', 0, 0, '2024-01-01', '0', '0', 'RANADIP MONDAL', NULL, 'HIRU MONDAL', NULL, 'REKHA MONDAL', NULL, '2010-05-17', NULL, NULL, NULL, NULL, NULL, '8388952926', '', NULL, NULL, NULL, 'INDIAN', '37663163515', 'SBIN0008006', NULL, NULL, NULL, 4, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '56', NULL, NULL),
(919, '05311919000356', 0, 0, '2024-01-01', '0', '0', 'RAWJATUNNESHA', NULL, 'ALAM HOSSAIN', NULL, 'MORIAM BIBI', NULL, '2010-06-30', NULL, NULL, NULL, NULL, NULL, '8536966016', '', NULL, NULL, NULL, 'INDIAN', '5177666074', 'CBIN0280122', NULL, NULL, NULL, 4, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '77', NULL, NULL),
(920, '05311919000358', 0, 0, '2024-01-01', '0', '0', 'ROHAN HOQUE', NULL, 'NURUL HAQUE', NULL, 'NASIMA BIBI', NULL, '2010-04-30', NULL, NULL, NULL, NULL, NULL, '8609331602', '', NULL, NULL, NULL, 'INDIAN', '35043256192', 'SBIN0015048', NULL, NULL, NULL, 4, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '69', NULL, NULL),
(921, '05313019000111', 0, 0, '2024-01-01', '0', '0', 'ROHIMA KHATUN', NULL, 'AKBAR ALI', NULL, 'CHHABI BIBI', NULL, '2010-08-19', NULL, NULL, NULL, NULL, NULL, '7074603086', '', NULL, NULL, NULL, 'INDIAN', '5021030000542', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '15', NULL, NULL),
(922, '05759119000061', 0, 0, '2024-01-01', '0', '0', 'RONY SK', NULL, 'MIJARUL ISLAM', NULL, 'ROHIMA BIBI', NULL, '2010-06-03', NULL, NULL, NULL, NULL, NULL, '7319118062', '', NULL, NULL, NULL, 'INDIAN', '5021020000556', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '32', NULL, NULL),
(923, '01783521000016', 0, 0, '2024-01-01', '0', '0', 'SAFINA KHATUN', NULL, 'MD GOLAM KIBRIA', NULL, 'SERINA BIBI', NULL, '2009-11-03', NULL, NULL, NULL, NULL, NULL, '7890241453', '', NULL, NULL, NULL, 'INDIAN', '5021030000122', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8', NULL, NULL),
(924, '01475519000216', 0, 0, '2024-01-01', '0', '0', 'SAHINA KHATUN', NULL, 'MD ABU SAIN', NULL, 'NASIMA BIBI', NULL, '2011-02-02', NULL, NULL, NULL, NULL, NULL, '8116882013', '', NULL, NULL, NULL, 'INDIAN', '5287448710', 'CBIN0280122', NULL, NULL, NULL, 4, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '49', NULL, NULL);
INSERT INTO `studentdbs` (`id`, `studentid`, `admBookNo`, `admSlNo`, `admDate`, `prCls`, `prSch`, `name`, `adhaar`, `fname`, `fadhaar`, `mname`, `madhaar`, `dob`, `vill`, `post`, `pstn`, `dist`, `pin`, `mobl`, `ssex`, `phch`, `relg`, `cste`, `natn`, `accNo`, `ifsc`, `micr`, `bnnm`, `brnm`, `stclass_id`, `stsection_id`, `session_id`, `school_id`, `streason`, `enclass_id`, `ensection_id`, `ensession_id`, `enreason`, `crstatus`, `remarks`, `created_at`, `updated_at`) VALUES
(925, '01475619000078', 0, 0, '2024-01-01', '0', '0', 'SAHIN SK', NULL, 'KUDDUS ALI', NULL, 'NASEBA BIBI', NULL, '2010-08-25', NULL, NULL, NULL, NULL, NULL, '7470136721', '', NULL, NULL, NULL, 'INDIAN', '5021010004153', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '29', NULL, NULL),
(926, '05312819000479', 0, 0, '2024-01-01', '0', '0', 'SAIM SK', NULL, 'ISRAIL SK', NULL, 'SABINA BIBI', NULL, '2010-10-03', NULL, NULL, NULL, NULL, NULL, '6297324930', '', NULL, NULL, NULL, 'INDIAN', '41521737082', 'SBIN0015048', NULL, NULL, NULL, 4, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '71', NULL, NULL),
(927, '05313219000180', 0, 0, '2024-01-01', '0', '0', 'SAMIM AKTAR', NULL, 'JAMAL SK', NULL, 'SABINA BIBI', NULL, '2010-07-03', NULL, NULL, NULL, NULL, NULL, '9093359815', '', NULL, NULL, NULL, 'INDIAN', '1532101700038913', 'PUNB0153210', NULL, NULL, NULL, 4, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '20', NULL, NULL),
(928, '01475519000230', 0, 0, '2024-01-01', '0', '0', 'SAMIM SK', NULL, 'FARUK SK', NULL, 'LILA BIBI', NULL, '2010-07-18', NULL, NULL, NULL, NULL, NULL, '8159999214', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 4, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '67', NULL, NULL),
(929, '05759119000068', 0, 0, '2024-01-01', '0', '0', 'SAMINA AKTAR', NULL, 'RUHUL AMIN', NULL, 'TUKTUKI BIBI', NULL, '2010-12-05', NULL, NULL, NULL, NULL, NULL, '8515879219', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 4, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '36', NULL, NULL),
(930, '01783521000027', 0, 0, '2024-01-01', '0', '0', 'SANIUL SK', NULL, 'ISMAIL SK', NULL, 'CHANTARA BIBI', NULL, '2010-10-13', NULL, NULL, NULL, NULL, NULL, '9002385834', '', NULL, NULL, NULL, 'INDIAN', '1532101700060471', 'PUNB0153210', NULL, NULL, NULL, 4, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '44', NULL, NULL),
(931, '01783522002037', 0, 0, '2024-01-01', '0', '0', 'SAROWAR JAHAN', NULL, 'SARIKUL ISLAM', NULL, 'MANJURA BIBI', NULL, '2010-11-11', NULL, NULL, NULL, NULL, NULL, '9679638469', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 4, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '68', NULL, NULL),
(932, '01783522002036', 0, 0, '2024-01-01', '0', '0', 'SAWAL HOSSAIN', NULL, 'AOYAL HOSSAIN', NULL, 'NARGIS BIBI', NULL, '2010-06-11', NULL, NULL, NULL, NULL, NULL, '9932209029', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 4, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5', NULL, NULL),
(933, '05313019000120', 0, 0, '2024-01-01', '0', '0', 'SHILA KHATUN', NULL, 'SAIDUL ISLAM', NULL, 'OYAJBANU BIBI', NULL, '2010-02-15', NULL, NULL, NULL, NULL, NULL, '8116872309', '', NULL, NULL, NULL, 'INDIAN', '15322160276134', 'PUNB0153210', NULL, NULL, NULL, 4, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '64', NULL, NULL),
(934, '05312819000472', 0, 0, '2024-01-01', '0', '0', 'SHRABANTI GHOSH', NULL, 'SANJOY GHOSH', NULL, 'SAGORI GHOSH', NULL, '2010-06-13', NULL, NULL, NULL, NULL, NULL, '6297910998', '', NULL, NULL, NULL, 'INDIAN', '5163153874', 'CBIN0280122', NULL, NULL, NULL, 4, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '35', NULL, NULL),
(935, '05313219000190', 0, 0, '2024-01-01', '0', '0', 'SNEHA KHATUN', NULL, 'MAMUN HASAN', NULL, 'SIULY BIBI', NULL, '2010-04-06', NULL, NULL, NULL, NULL, NULL, '8637375158', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 4, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '60', NULL, NULL),
(936, '01783521000025', 0, 0, '2024-01-01', '0', '0', 'SOHON', NULL, 'KAMAL', NULL, 'SARMINA BIBI', NULL, '2011-01-10', NULL, NULL, NULL, NULL, NULL, '9399674487', '', NULL, NULL, NULL, 'INDIAN', '5575010043962', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '43', NULL, NULL),
(937, '05312819000482', 0, 0, '2024-01-01', '0', '0', 'SOMIT GHOSH', NULL, 'JHABU GHOSH', NULL, 'ASHA GHOSH', NULL, '2010-09-30', NULL, NULL, NULL, NULL, NULL, '8670844571', '', NULL, NULL, NULL, 'INDIAN', '34987935086', 'SBIN0008006', NULL, NULL, NULL, 4, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '81', NULL, NULL),
(938, '05313019000121', 0, 0, '2024-01-01', '0', '0', 'SRABONY KHATUN', NULL, 'GOLAB RASUL', NULL, 'MABIA BIBI', NULL, '2010-05-31', NULL, NULL, NULL, NULL, NULL, '8350012327', '', NULL, NULL, NULL, 'INDIAN', '5021020000776', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '24', NULL, NULL),
(939, '05311919000371', 0, 0, '2024-01-01', '0', '0', 'SUBHAJIT MONDAL', NULL, 'PABAN MONDAL', NULL, 'JUMUNA MONDAL', NULL, '2010-11-08', NULL, NULL, NULL, NULL, NULL, '8001136628', '', NULL, NULL, NULL, 'INDIAN', '35056077559', 'SBIN0015048', NULL, NULL, NULL, 4, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '70', NULL, NULL),
(940, '01783521000010', 0, 0, '2024-01-01', '0', '0', 'SUHIN SK', NULL, 'MAJIBUR RAHAMAN', NULL, 'SAKHINA KHATUN', NULL, '2010-09-01', NULL, NULL, NULL, NULL, NULL, '8972428618', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 4, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '65', NULL, NULL),
(941, '01783521000023', 0, 0, '2024-01-01', '0', '0', 'SULTANA KHATUN', NULL, 'HIRON HOQUE', NULL, 'LAVLI BIBI', NULL, '2010-04-28', NULL, NULL, NULL, NULL, NULL, '8584807321', '', NULL, NULL, NULL, 'INDIAN', '5021020001067', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '41', NULL, NULL),
(942, '05312919000077', 0, 0, '2024-01-01', '0', '0', 'SUMITRA RABIDAS', NULL, 'SANJOY RABIDAS', NULL, 'ANITA RABIDAS', NULL, '2010-02-28', NULL, NULL, NULL, NULL, NULL, '8536063062', '', NULL, NULL, NULL, 'INDIAN', '5021010043652', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '52', NULL, NULL),
(943, '01783521000008', 0, 0, '2024-01-01', '0', '0', 'SURAIYA KHATUN', NULL, 'SAKIR SK', NULL, 'RAKIBA BIBI', NULL, '2010-09-12', NULL, NULL, NULL, NULL, NULL, '7063500784', '', NULL, NULL, NULL, 'INDIAN', '5021010040576', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', NULL, NULL),
(944, '05311919000369', 0, 0, '2024-01-01', '0', '0', 'SURAIYA KHATUN', NULL, 'FATIK SK', NULL, 'ROHIMA BIBI', NULL, '2010-10-01', NULL, NULL, NULL, NULL, NULL, '8597621140', '', NULL, NULL, NULL, 'INDIAN', '5137900487', 'CBIN0280122', NULL, NULL, NULL, 4, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '75', NULL, NULL),
(945, '01783521000038', 0, 0, '2024-01-01', '0', '0', 'SUSMITA PARVIN', NULL, 'NEKBOR ALI', NULL, 'SUNDORI BIBI', NULL, '2010-08-15', NULL, NULL, NULL, NULL, NULL, '8116279128', '', NULL, NULL, NULL, 'INDIAN', '5021030000493', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '51', NULL, NULL),
(946, '01475519000192', 0, 0, '2024-01-01', '0', '0', 'TANBIR AHAMED', NULL, 'RUHUL AMIN', NULL, 'NARGIS BIBI', NULL, '2010-07-25', NULL, NULL, NULL, NULL, NULL, '9609044326', '', NULL, NULL, NULL, 'INDIAN', '1532101700057884', 'PUNB0153210', NULL, NULL, NULL, 4, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4', NULL, NULL),
(947, '01475619000075', 0, 0, '2024-01-01', '0', '0', 'TANIA KHATUN', NULL, 'SOFIKUL ISLAM', NULL, 'HABIBA BIBI', NULL, '2011-03-06', NULL, NULL, NULL, NULL, NULL, '7384559313', '', NULL, NULL, NULL, 'INDIAN', '5021030000664', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '21', NULL, NULL),
(948, '05312819000483', 0, 0, '2024-01-01', '0', '0', 'TANJILA KHATUN', NULL, 'MD KHODABOX', NULL, 'HASINA BIBI', NULL, '2010-08-01', NULL, NULL, NULL, NULL, NULL, '7407705983', '', NULL, NULL, NULL, 'INDIAN', '36158602919', 'SBIN0008006', NULL, NULL, NULL, 4, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '26', NULL, NULL),
(949, '05312819000481', 0, 0, '2024-01-01', '0', '0', 'TARAK GHOSH', NULL, 'BAGHU GHOSH', NULL, 'ASIMA GHOSH', NULL, '2010-03-20', NULL, NULL, NULL, NULL, NULL, '7233867265', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 4, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '82', NULL, NULL),
(950, '05313219000197', 0, 0, '2024-01-01', '0', '0', 'TARIJA KHATUN', NULL, 'ISLAM SK', NULL, 'SELINA BIBI', NULL, '2010-01-26', NULL, NULL, NULL, NULL, NULL, '8116487542', '', NULL, NULL, NULL, 'INDIAN', '20348858997', 'SBIN0015048', NULL, NULL, NULL, 4, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '53', NULL, NULL),
(951, '01783521000026', 0, 0, '2024-01-01', '0', '0', 'TOUFIK AHAMMED', NULL, 'SELIM REJA', NULL, 'HABIBA KHATUN', NULL, '2010-07-09', NULL, NULL, NULL, NULL, NULL, '7699024780', '', NULL, NULL, NULL, 'INDIAN', '5575010043971', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '50', NULL, NULL),
(952, '01475519000203', 0, 0, '2024-01-01', '0', '0', 'ABU TAHER', NULL, 'SANUYAR HOSSAIN', NULL, 'REJINA BIBI', NULL, '2010-12-14', NULL, NULL, NULL, NULL, NULL, '8537950354', '', NULL, NULL, NULL, 'INDIAN', '5021030000441', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '72', NULL, NULL),
(953, '01783521000034', 0, 0, '2024-01-01', '0', '0', 'ADUD SEKH', NULL, 'TOHIDUL ISLAM', NULL, 'AMENA BIBI', NULL, '2011-01-06', NULL, NULL, NULL, NULL, NULL, '9932207286', '', NULL, NULL, NULL, 'INDIAN', '5021010043485', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '25', NULL, NULL),
(954, '01783521000037', 0, 0, '2024-01-01', '0', '0', 'AJOY CHOWDHURY', NULL, 'PANNALAL CHOWDHURY', NULL, 'SAKUNTALA CHOWDHURY', NULL, '2011-02-19', NULL, NULL, NULL, NULL, NULL, '9635063552', '', NULL, NULL, NULL, 'INDIAN', '41386024142', 'SBIN0015048', NULL, NULL, NULL, 4, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '18', NULL, NULL),
(955, '05312819000468', 0, 0, '2024-01-01', '0', '0', 'ALFAJ ALI', NULL, 'RIPAN SK', NULL, 'AKTARUNNESHA', NULL, '2010-06-19', NULL, NULL, NULL, NULL, NULL, '8609398762', '', NULL, NULL, NULL, 'INDIAN', '1314200100004804', 'PUNB0131420', NULL, NULL, NULL, 4, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '41', NULL, NULL),
(956, '01475519000207', 0, 0, '2024-01-01', '0', '0', 'ALIUL HOQUE', NULL, 'MAJIBUR SEKH', NULL, 'KAMRUNESA', NULL, '2010-06-25', NULL, NULL, NULL, NULL, NULL, '8350088029', '', NULL, NULL, NULL, 'INDIAN', '0977010346665', 'PUNB0097720', NULL, NULL, NULL, 4, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '22', NULL, NULL),
(957, '05313019000106', 0, 0, '2024-01-01', '0', '0', 'ARIFA KHATUN', NULL, 'KUDDUS ALI', NULL, 'SHARIFA BIBI', NULL, '2010-07-23', NULL, NULL, NULL, NULL, NULL, '9062438512', '', NULL, NULL, NULL, 'INDIAN', '5021020000968', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8', NULL, NULL),
(958, '01475519000224', 0, 0, '2024-01-01', '0', '0', 'ASHA KHATUN', NULL, 'HAZRAT ALI', NULL, 'MERINA BIBI', NULL, '2010-12-07', NULL, NULL, NULL, NULL, NULL, '8345972779', '', NULL, NULL, NULL, 'INDIAN', '5021030000592', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '80', NULL, NULL),
(959, '05313219000159', 0, 0, '2024-01-01', '0', '0', 'ASIKUL ISLAM', NULL, 'HANIF SK', NULL, 'MURSHIDA BIBI', NULL, '2010-08-30', NULL, NULL, NULL, NULL, NULL, '9091322147', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 4, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '24', NULL, NULL),
(960, '01475519000213', 0, 0, '2024-01-01', '0', '0', 'ASMA KHATUN', NULL, 'JAIDUL SK', NULL, 'ADINA BIBI', NULL, '2009-03-04', NULL, NULL, NULL, NULL, NULL, '8016974255', '', NULL, NULL, NULL, 'INDIAN', '5021020000652', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '16', NULL, NULL),
(961, '01475519000215', 0, 0, '2024-01-01', '0', '0', 'AWOLIYA KHATUN', NULL, 'ISMAIL HOQUE', NULL, 'SUKTARA BIBI', NULL, '2010-09-06', NULL, NULL, NULL, NULL, NULL, '8343044864', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 4, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '10', NULL, NULL),
(962, '05312819000485', 0, 0, '2024-01-01', '0', '0', 'CHIRONJIT GHOSH', NULL, 'SUKDEB GHOSH', NULL, 'JHARNA GHOSH', NULL, '2010-06-11', NULL, NULL, NULL, NULL, NULL, '9098129611', '', NULL, NULL, NULL, 'INDIAN', '5180878684', 'CBIN0280122', NULL, NULL, NULL, 4, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '55', NULL, NULL),
(963, '08895119000059', 0, 0, '2024-01-01', '0', '0', 'DIPAK MANDAL', NULL, 'NIKHIL MANDAL', NULL, 'PARBATI MANDAL', NULL, '2010-12-04', NULL, NULL, NULL, NULL, NULL, '9635085165', '', NULL, NULL, NULL, 'INDIAN', '5021030000887', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4', NULL, NULL),
(964, '08895119000066', 0, 0, '2024-01-01', '0', '0', 'DIP MANDAL', NULL, 'SHAKTI MANDAL', NULL, 'PARBATI MANDAL', NULL, '2009-11-30', NULL, NULL, NULL, NULL, NULL, '8942041305', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 4, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '60', NULL, NULL),
(965, '08895119000074', 0, 0, '2024-01-01', '0', '0', 'GANESH MANDAL', NULL, 'HEMANTO MANDAL', NULL, 'KANCHAN MANDAL', NULL, '2009-03-19', NULL, NULL, NULL, NULL, NULL, '8942041305', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 4, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '59', NULL, NULL),
(966, '01783521000035', 0, 0, '2024-01-01', '0', '0', 'HALIMA KHATUN', NULL, 'SABIR SK', NULL, 'RINA BIBI', NULL, '2009-05-13', NULL, NULL, NULL, NULL, NULL, '7501369093', '', NULL, NULL, NULL, 'INDIAN', '1532101700036827', 'PUNB0153210', NULL, NULL, NULL, 4, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '21', NULL, NULL),
(967, '01475519000210', 0, 0, '2024-01-01', '0', '0', 'HAMID SK', NULL, 'SADEKUL ISLAM', NULL, 'JYOTSNARA BIBI', NULL, '2010-08-18', NULL, NULL, NULL, NULL, NULL, '8597702262', '', NULL, NULL, NULL, 'INDIAN', '5021030000434', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '11', NULL, NULL),
(968, '01475519000214', 0, 0, '2024-01-01', '0', '0', 'HAPIJA KHATUN', NULL, 'EYASIN SK', NULL, 'ADORA BIBI', NULL, '2011-02-22', NULL, NULL, NULL, NULL, NULL, '8016974255', '', NULL, NULL, NULL, 'INDIAN', '5165339131', 'CBIN0280122', NULL, NULL, NULL, 4, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '14', NULL, NULL),
(969, '01475619000067', 0, 0, '2024-01-01', '0', '0', 'ILIYAS SK', NULL, 'RUBEL SK', NULL, 'AKTARUNNESHA', NULL, '2010-11-23', NULL, NULL, NULL, NULL, NULL, '9134530180', '', NULL, NULL, NULL, 'INDIAN', '1532101700049007', 'PUNB0153210', NULL, NULL, NULL, 4, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '47', NULL, NULL),
(970, '05311919000350', 0, 0, '2024-01-01', '0', '0', 'INJAMUL HOSSAIN', NULL, 'FARHAD HOSSAIN', NULL, 'RAJINA BIBI', NULL, '2010-01-30', NULL, NULL, NULL, NULL, NULL, '9733201236', '', NULL, NULL, NULL, 'INDIAN', '3838770078', 'CBIN0280122', NULL, NULL, NULL, 4, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6', NULL, NULL),
(971, '01475619000071', 0, 0, '2024-01-01', '0', '0', 'ISMAIL HOQUE', NULL, 'AJIBUR RAHAMAN', NULL, 'SEFALI BIBI', NULL, '2010-08-10', NULL, NULL, NULL, NULL, NULL, '8350080419', '', NULL, NULL, NULL, 'INDIAN', '1532101700040927', 'PUNB0153210', NULL, NULL, NULL, 4, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '33', NULL, NULL),
(972, '05313119000110', 0, 0, '2024-01-01', '0', '0', 'JISA KHATUN', NULL, 'MAINUL HOQUE', NULL, 'SARJINA BIBI', NULL, '2010-03-05', NULL, NULL, NULL, NULL, NULL, '7063360794', '', NULL, NULL, NULL, 'INDIAN', '5021020000724', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '27', NULL, NULL),
(973, '01475519000219', 0, 0, '2024-01-01', '0', '0', 'JOYATI MANDAL', NULL, 'SAMBHU MANDAL', NULL, 'ANIMA MANDAL', NULL, '2010-09-26', NULL, NULL, NULL, NULL, NULL, '8170080644', '', NULL, NULL, NULL, 'INDIAN', '5291243841', 'CBIN0280122', NULL, NULL, NULL, 4, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '37', NULL, NULL),
(974, '01783521000021', 0, 0, '2024-01-01', '0', '0', 'KAYNAT KHATUN', NULL, 'TINKU SK', NULL, 'OFINA BIBI.', NULL, '2010-09-24', NULL, NULL, NULL, NULL, NULL, '8945518767', '', NULL, NULL, NULL, 'INDIAN', '5140688884', 'CBIN0283988', NULL, NULL, NULL, 4, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '48', NULL, NULL),
(975, '01475519000231', 0, 0, '2024-01-01', '0', '0', 'KOYEL MONDAL', NULL, 'CHANDU MONDAL', NULL, 'KALPONA MONDAL', NULL, '2010-04-25', NULL, NULL, NULL, NULL, NULL, '8016006021', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 4, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '63', NULL, NULL),
(976, '01783521000033', 0, 0, '2024-01-01', '0', '0', 'MANIK SK', NULL, 'KOBIR SK', NULL, 'FERDOSE BIBI', NULL, '2010-11-02', NULL, NULL, NULL, NULL, NULL, '7369051180', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 4, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '64', NULL, NULL),
(977, '05312819000478', 0, 0, '2024-01-01', '0', '0', 'MANOJIT PRAMANIK', NULL, 'SAHADEB PRAMANIK', NULL, 'MADHURI PRAMANIK', NULL, '2010-10-20', NULL, NULL, NULL, NULL, NULL, '9775450781', '', NULL, NULL, NULL, 'INDIAN', '5161677313', 'CBIN0280122', NULL, NULL, NULL, 4, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '15', NULL, NULL),
(978, '01783521000036', 0, 0, '2024-01-01', '0', '0', 'MD AMIN SK', NULL, 'MD AMIRUL SK', NULL, 'MORJINA BIBI', NULL, '2010-08-01', NULL, NULL, NULL, NULL, NULL, '6206351334', '', NULL, NULL, NULL, 'INDIAN', '41535572861', 'SBIN0008855', NULL, NULL, NULL, 4, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '19', NULL, NULL),
(979, '01475519000198', 0, 0, '2024-01-01', '0', '0', 'MD SARWAN', NULL, 'MUSRAF HOSSAIN', NULL, 'SIMA BIBI', NULL, '2010-10-31', NULL, NULL, NULL, NULL, NULL, '8536823571', '', NULL, NULL, NULL, 'INDIAN', '5294055297', 'CBIN0280122', NULL, NULL, NULL, 4, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', NULL, NULL),
(980, '05313219000188', 0, 0, '2024-01-01', '0', '0', 'MD SUFIYAN', NULL, 'MATLEB SK', NULL, 'SIRINA BIBI', NULL, '2010-04-19', NULL, NULL, NULL, NULL, NULL, '9093341151', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 4, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '54', NULL, NULL),
(981, '05313219000194', 0, 0, '2024-01-01', '0', '0', 'MD SURAJ SK', NULL, 'ASRAF SK', NULL, 'CHANSURA BIBI', NULL, '2010-12-11', NULL, NULL, NULL, NULL, NULL, '9932141003', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 4, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '12', NULL, NULL),
(982, '01783521000040', 0, 0, '2024-01-01', '0', '0', 'MD TAMIM ISLAM', NULL, 'TARIKUL ISLAM', NULL, 'ROJINA BIBI', NULL, '2009-08-04', NULL, NULL, NULL, NULL, NULL, '6294969180', '', NULL, NULL, NULL, 'INDIAN', '39949195913', 'SBIN0015048', NULL, NULL, NULL, 4, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '62', NULL, NULL),
(983, '01783521000007', 0, 0, '2024-01-01', '0', '0', 'MEHERUL HOSSAIN', NULL, 'BARI SK', NULL, 'FURKON BIBI', NULL, '2011-03-15', NULL, NULL, NULL, NULL, NULL, '9746812365', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 4, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '67', NULL, NULL),
(984, '01783521000039', 0, 0, '2024-01-01', '0', '0', 'MIRON SHAIKH', NULL, 'JAHANGIR ALAM', NULL, 'MARIYAM BIBI', NULL, '2010-08-20', NULL, NULL, NULL, NULL, NULL, '9163169862', '', NULL, NULL, NULL, 'INDIAN', '3878398737', 'CBIN0280122', NULL, NULL, NULL, 4, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '57', NULL, NULL),
(985, '01475519000209', 0, 0, '2024-01-01', '0', '0', 'MST ISMITA KHATUN', NULL, 'ISMAIL HOQUE', NULL, 'SABINA BIBI', NULL, '2010-11-03', NULL, NULL, NULL, NULL, NULL, '7797449439', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 4, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '79', NULL, NULL),
(986, '01783521000030', 0, 0, '2024-01-01', '0', '0', 'MUSKAN KHATUN', NULL, 'HASIBUL ISLAM', NULL, 'DOLY BIBI', NULL, '2010-03-13', NULL, NULL, NULL, NULL, NULL, '9749471927', '', NULL, NULL, NULL, 'INDIAN', '5161683021', 'CBIN0280122', NULL, NULL, NULL, 4, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '82', NULL, NULL),
(987, '01475519000189', 0, 0, '2024-01-01', '0', '0', 'NURAMIN SK', NULL, 'EKBAR SK', NULL, 'JHARNA BIBI', NULL, '2010-04-24', NULL, NULL, NULL, NULL, NULL, '7602641504', '', NULL, NULL, NULL, 'INDIAN', '5252565762', 'CBIN0280122', NULL, NULL, NULL, 4, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '3', NULL, NULL),
(988, '05312819000475', 0, 0, '2024-01-01', '0', '0', 'NUR HOSSAIN', NULL, 'ABDUR RAJJAK', NULL, 'PARVIN BIBI', NULL, '2010-07-08', NULL, NULL, NULL, NULL, NULL, '8116854936', '', NULL, NULL, NULL, 'INDIAN', '5147295263', 'CBIN0280122', NULL, NULL, NULL, 4, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '40', NULL, NULL),
(989, '07477319000100', 0, 0, '2024-01-01', '0', '0', 'PALLAVI MANDAL', NULL, 'PACHU MANDAL', NULL, 'BABITA MANDAL', NULL, '2009-10-30', NULL, NULL, NULL, NULL, NULL, '8609239113', '', NULL, NULL, NULL, 'INDIAN', '122006192885', 'WBSC0MCCB15', NULL, NULL, NULL, 4, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '56', NULL, NULL),
(990, '01783521000031', 0, 0, '2024-01-01', '0', '0', 'RAFIK SK', NULL, 'DABIRUDDIN SK', NULL, 'AFROJA BIBI', NULL, '2011-01-06', NULL, NULL, NULL, NULL, NULL, '8397876524', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 4, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '52', NULL, NULL),
(991, '05759119000066', 0, 0, '2024-01-01', '0', '0', 'RAJANI KHATUN', NULL, 'RAFIKUL ISLAM', NULL, 'FATEMA BIBI', NULL, '2010-09-14', NULL, NULL, NULL, NULL, NULL, '8016975977', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 4, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '81', NULL, NULL),
(992, '01783521000032', 0, 0, '2024-01-01', '0', '0', 'RAJESH SK', NULL, 'ESARUK SK', NULL, 'ROWSHENARA BIBI', NULL, '2010-08-03', NULL, NULL, NULL, NULL, NULL, '7679799286', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 4, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '65', NULL, NULL),
(993, '01475619000076', 0, 0, '2024-01-01', '0', '0', 'RAKIB SK', NULL, 'AROB SK', NULL, 'HAFIJA BIBI', NULL, '2011-03-01', NULL, NULL, NULL, NULL, NULL, '9635204625', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 4, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '43', NULL, NULL),
(994, '01783521000020', 0, 0, '2024-01-01', '0', '0', 'RIMAN SK', NULL, 'GULSON ALI', NULL, 'REJINA BIBI', NULL, '2010-08-28', NULL, NULL, NULL, NULL, NULL, '9110901927', '', NULL, NULL, NULL, 'INDIAN', '5161248997', 'CBIN0280122', NULL, NULL, NULL, 4, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '51', NULL, NULL),
(995, '01783521000002', 0, 0, '2024-01-01', '0', '0', 'ROHIT SK', NULL, 'ISMAIL ALI', NULL, 'RUBINA BIBI', NULL, '2011-02-24', NULL, NULL, NULL, NULL, NULL, '7047158317', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 4, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '7', NULL, NULL),
(996, '01783521000018', 0, 0, '2024-01-01', '0', '0', 'ROHON', NULL, 'ABU HENA', NULL, 'MAHIDA BIBI', NULL, '2010-10-19', NULL, NULL, NULL, NULL, NULL, '9679055077', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 4, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '66', NULL, NULL),
(997, '01783521000013', 0, 0, '2024-01-01', '0', '0', 'ROJINA KHATUN', NULL, 'AZIZUL SK', NULL, 'SAKHINA BIBI', NULL, '2010-08-17', NULL, NULL, NULL, NULL, NULL, '9547775821', '', NULL, NULL, NULL, 'INDIAN', '5292834956', 'CBIN0280122', NULL, NULL, NULL, 4, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '32', NULL, NULL),
(998, '05313119000114', 0, 0, '2024-01-01', '0', '0', 'ROKI SK', NULL, 'MIJARUL SK', NULL, 'SABINA BIBI', NULL, '2010-11-05', NULL, NULL, NULL, NULL, NULL, '7063234366', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 4, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '26', NULL, NULL),
(999, '05312819000493', 0, 0, '2024-01-01', '0', '0', 'RONI SK', NULL, 'ARIF ALI', NULL, 'RUMELA BIBI', NULL, '2010-03-21', NULL, NULL, NULL, NULL, NULL, '9547925700', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 4, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '13', NULL, NULL),
(1000, '01783523000003', 0, 0, '2024-01-01', '0', '0', 'RONI SK.', NULL, 'RAFIKUL ISLAM', NULL, 'TARALA BIBI', NULL, '2010-02-13', NULL, NULL, NULL, NULL, NULL, '9658713254', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 4, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '69', NULL, NULL),
(1001, '05311919000381', 0, 0, '2024-01-01', '0', '0', 'SABINA KHATUN', NULL, 'SAWAL SK', NULL, 'RUMA BIBI', NULL, '2010-02-01', NULL, NULL, NULL, NULL, NULL, '9083468891', '', NULL, NULL, NULL, 'INDIAN', '35044334444', 'SBIN0008006', NULL, NULL, NULL, 4, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '74', NULL, NULL),
(1002, '01783522002063', 0, 0, '2024-01-01', '0', '0', 'SAFIKUL ISLAM', NULL, 'CHAND MAHAMMAD', NULL, 'SIRIFA BIBI', NULL, '2007-07-17', NULL, NULL, NULL, NULL, NULL, '7029642117', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 4, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '49', NULL, NULL),
(1003, '05312719000085', 0, 0, '2024-01-01', '0', '0', 'SAGAR SK', NULL, 'SELIM SK', NULL, 'JESMIN BIBI', NULL, '2010-08-05', NULL, NULL, NULL, NULL, NULL, '9635441766', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 4, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '61', NULL, NULL),
(1004, '05312819000480', 0, 0, '2024-01-01', '0', '0', 'SAHEDUL ISLAM', NULL, 'RAHIM SK', NULL, 'MARJINA BIBI', NULL, '2010-10-28', NULL, NULL, NULL, NULL, NULL, '8538821731', '', NULL, NULL, NULL, 'INDIAN', '5278041273', 'CBIN0280122', NULL, NULL, NULL, 4, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '45', NULL, NULL),
(1005, '05313719000092', 0, 0, '2024-01-01', '0', '0', 'SAHELI KHATUN', NULL, 'MOJAMMEL HOQUE', NULL, 'MIRA BIBI', NULL, '2010-11-13', NULL, NULL, NULL, NULL, NULL, '7478377407', '', NULL, NULL, NULL, 'INDIAN', '41499687667', 'SBIN0015048', NULL, NULL, NULL, 4, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '9', NULL, NULL),
(1006, '01475519000200', 0, 0, '2024-01-01', '0', '0', 'SAID AFRIDI', NULL, 'MD JAHANGIR ALAM', NULL, 'MAMATAJ BEGUM', NULL, '2010-05-24', NULL, NULL, NULL, NULL, NULL, '8967014212', '', NULL, NULL, NULL, 'INDIAN', '5235406791', 'CBIN0280122', NULL, NULL, NULL, 4, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '23', NULL, NULL),
(1007, '01475619000074', 0, 0, '2024-01-01', '0', '0', 'SAIMA BEGAM', NULL, 'FORAJ ALI', NULL, 'NASIMA BIBI', NULL, '2010-09-06', NULL, NULL, NULL, NULL, NULL, '9932620057', '', NULL, NULL, NULL, 'INDIAN', '1532101700047753', 'PUNB0153210', NULL, NULL, NULL, 4, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '17', NULL, NULL),
(1008, '05313019000107', 0, 0, '2024-01-01', '0', '0', 'SAIN KADIR', NULL, 'MD AMINUL ISLAM', NULL, 'SAMSUNNEHAR BIBI', NULL, '2010-10-03', NULL, NULL, NULL, NULL, NULL, '8016424757', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 4, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5', NULL, NULL),
(1009, '01783521000003', 0, 0, '2024-01-01', '0', '0', 'SAKIBUR HASAN', NULL, 'SAKIRUL', NULL, 'TOHAMINA KHATUN', NULL, '2010-09-10', NULL, NULL, NULL, NULL, NULL, '7001909734', '', NULL, NULL, NULL, 'INDIAN', '5021030000890', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '42', NULL, NULL),
(1010, '01475519000195', 0, 0, '2024-01-01', '0', '0', 'SALMA SULTANA', NULL, 'ABU HENA', NULL, 'MERINA BIBI', NULL, '2010-10-05', NULL, NULL, NULL, NULL, NULL, '9641673834', '', NULL, NULL, NULL, 'INDIAN', '5021030001241', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '71', NULL, NULL),
(1011, '05313519000159', 0, 0, '2024-01-01', '0', '0', 'SAMIMA KHATUN', NULL, 'ABDUL KAYEM', NULL, 'SABINA BIBI', NULL, '2010-12-15', NULL, NULL, NULL, NULL, NULL, '9093767116', '', NULL, NULL, NULL, 'INDIAN', '5575010024693', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '34', NULL, NULL),
(1012, '05313719000114', 0, 0, '2024-01-01', '0', '0', 'SAMIM HOSSAIN.', NULL, 'TIYARUL ISLAM', NULL, 'REKSONA BIBI', NULL, '2011-01-10', NULL, NULL, NULL, NULL, NULL, '8392071648', '', NULL, NULL, NULL, 'INDIAN', '36069464901', 'SBIN0008006', NULL, NULL, NULL, 4, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '76', NULL, NULL),
(1013, '01475519000197', 0, 0, '2024-01-01', '0', '0', 'SAMIR AHAMED', NULL, 'YEAD ALI', NULL, 'AMENA BIBI', NULL, '2010-01-10', NULL, NULL, NULL, NULL, NULL, '9732700645', '', NULL, NULL, NULL, 'INDIAN', '5021020001137', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '73', NULL, NULL),
(1014, '08895119000073', 0, 0, '2024-01-01', '0', '0', 'SANJIT MANDAL', NULL, 'AMIRCHAND MANDAL', NULL, 'RUPALI MANDAL', NULL, '2010-12-10', NULL, NULL, NULL, NULL, NULL, '9091804588', '', NULL, NULL, NULL, 'INDIAN', '5021010037077', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '75', NULL, NULL),
(1015, '05313719000087', 0, 0, '2024-01-01', '0', '0', 'SARJINA YESMIN', NULL, 'YEKUB ALI', NULL, 'AMBIA BIBI', NULL, '2010-01-19', NULL, NULL, NULL, NULL, NULL, '8514925019', '', NULL, NULL, NULL, 'INDIAN', '41386090400', 'SBIN0015048', NULL, NULL, NULL, 4, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '46', NULL, NULL),
(1016, '05078219000236', 0, 0, '2024-01-01', '0', '0', 'SARMIN KHATUN', NULL, 'RAFIK SK', NULL, 'SASURA BIBI', NULL, '2010-08-25', NULL, NULL, NULL, NULL, NULL, '7363937818', '', NULL, NULL, NULL, 'INDIAN', '5021030000333', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '39', NULL, NULL),
(1017, '05312819000470', 0, 0, '2024-01-01', '0', '0', 'SOFIKUL ISLAM', NULL, 'SAMIM SK', NULL, 'SARJINA BIBI', NULL, '2010-01-07', NULL, NULL, NULL, NULL, NULL, '7602815065', '', NULL, NULL, NULL, 'INDIAN', '5137898819', 'CBIN0280122', NULL, NULL, NULL, 4, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '44', NULL, NULL),
(1018, '01475519000208', 0, 0, '2024-01-01', '0', '0', 'SOHONA KHATUN', NULL, 'MD MONIRUL ISLAM', NULL, 'NURJAHAN BIBI', NULL, '2011-02-06', NULL, NULL, NULL, NULL, NULL, '7384559295', '', NULL, NULL, NULL, 'INDIAN', '5021030000438', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '70', NULL, NULL),
(1019, '01475519000225', 0, 0, '2024-01-01', '0', '0', 'SUBHANKAR MONDAL', NULL, 'BABLU MONDAL', NULL, 'USHARANI MONDAL', NULL, '2010-03-03', NULL, NULL, NULL, NULL, NULL, '9382649826', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 4, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '77', NULL, NULL),
(1020, '05311919000397', 0, 0, '2024-01-01', '0', '0', 'SUBHO SK', NULL, 'KAMAL SK', NULL, 'SUMITA BIBI', NULL, '2010-07-28', NULL, NULL, NULL, NULL, NULL, '7679574420', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 4, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '68', NULL, NULL),
(1021, '05759119000067', 0, 0, '2024-01-01', '0', '0', 'SUHANA PARVIN', NULL, 'TOFIKUL ISLAM', NULL, 'CHEHERA BIBI', NULL, '2010-06-15', NULL, NULL, NULL, NULL, NULL, '9074948008', '', NULL, NULL, NULL, 'INDIAN', '1532101700042855', 'PUNB0153210', NULL, NULL, NULL, 4, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '30', NULL, NULL),
(1022, '01475519000228', 0, 0, '2024-01-01', '0', '0', 'SUJAN MONDAL', NULL, 'RANJIT MONDAL', NULL, 'MADHABI MONDAL', NULL, '2011-01-20', NULL, NULL, NULL, NULL, NULL, '8145929173', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 4, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '78', NULL, NULL),
(1023, '01475519000232', 0, 0, '2024-01-01', '0', '0', 'SUPARNA MONDAL', NULL, 'AMIRCHAND MONDAL', NULL, 'TUSI MONDAL', NULL, '2010-11-20', NULL, NULL, NULL, NULL, NULL, '8016321328', '', NULL, NULL, NULL, 'INDIAN', '5021010044350', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '38', NULL, NULL),
(1024, '01475619000072', 0, 0, '2024-01-01', '0', '0', 'SURAJ ALI', NULL, 'PANJAB ALI', NULL, 'SABERA BIBI', NULL, '2010-10-12', NULL, NULL, NULL, NULL, NULL, '9093796166', '', NULL, NULL, NULL, 'INDIAN', '5021030000406', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '35', NULL, NULL),
(1025, '01783521000019', 0, 0, '2024-01-01', '0', '0', 'SUREBA KHATUN', NULL, 'SAIDUL SK', NULL, 'MINARA BIBI', NULL, '2009-12-12', NULL, NULL, NULL, NULL, NULL, '9635660438', '', NULL, NULL, NULL, 'INDIAN', '21028100029539', 'BARB0KHARIB', NULL, NULL, NULL, 4, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '28', NULL, NULL),
(1026, '08895119000075', 0, 0, '2024-01-01', '0', '0', 'SURJYA MANDAL', NULL, 'JITEN MANDAL', NULL, 'SANGITA MANDAL', NULL, '2009-11-09', NULL, NULL, NULL, NULL, NULL, '9382345078', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 4, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '58', NULL, NULL),
(1027, '05312819000476', 0, 0, '2024-01-01', '0', '0', 'SWASTIKA GHOSH', NULL, 'KHOKAN GHOSH', NULL, 'PAMPA GHOSH', NULL, '2010-11-01', NULL, NULL, NULL, NULL, NULL, '9144810879', '', NULL, NULL, NULL, 'INDIAN', '5021030001178', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '31', NULL, NULL),
(1028, '05312819000473', 0, 0, '2024-01-01', '0', '0', 'TINA GHOSH', NULL, 'BANU GHOSH', NULL, 'SUMITRA GHOSH', NULL, '2010-06-08', NULL, NULL, NULL, NULL, NULL, '7699554879', '', NULL, NULL, NULL, 'INDIAN', '5291519469', 'CBIN0280122', NULL, NULL, NULL, 4, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '29', NULL, NULL),
(1029, '01783521000005', 0, 0, '2024-01-01', '0', '0', 'TOUFIK HASAN', NULL, 'HASANUJJAMAN', NULL, 'UJALA BIBI', NULL, '2010-12-30', NULL, NULL, NULL, NULL, NULL, '7501597997', '', NULL, NULL, NULL, 'INDIAN', '5575010023278', 'PUNB0RRBBGB', NULL, NULL, NULL, 4, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '50', NULL, NULL),
(1030, '01783521000001', 0, 0, '2024-01-01', '0', '0', 'TOUFIK SK', NULL, 'SENTU SK', NULL, 'SABINA BIBI', NULL, '2009-11-12', NULL, NULL, NULL, NULL, NULL, '9641707037', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 4, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '36', NULL, NULL),
(1031, '01783521001365', 0, 0, '2024-01-01', '0', '0', 'AJMIR SARIF', NULL, 'ASADUL HOQUE', NULL, 'FERDOUSI BIBI', NULL, '2009-02-04', NULL, NULL, NULL, NULL, NULL, '8942896178', '', NULL, NULL, NULL, 'INDIAN', '1532101700026945', 'PUNB0153210', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '78', NULL, NULL),
(1032, '01783521001720', 0, 0, '2024-01-01', '0', '0', 'ALAMIN SK', NULL, 'TARIKUL ISLAM', NULL, 'NABIJA BIBI', NULL, '2009-05-05', NULL, NULL, NULL, NULL, NULL, '8101168822', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '40', NULL, NULL),
(1033, '01783521001885', 0, 0, '2024-01-01', '0', '0', 'ALIMA KHATUN', NULL, 'AINAL HAQUE', NULL, 'NARGIS BIBI', NULL, '2009-10-07', NULL, NULL, NULL, NULL, NULL, '8597940310', '', NULL, NULL, NULL, 'INDIAN', '37915824880', 'SBIN0008006', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '74', NULL, NULL),
(1034, '01783521000221', 0, 0, '2024-01-01', '0', '0', 'ANSI KHATUN', NULL, 'JAHANGIR ..', NULL, 'SONAVAN BIBI', NULL, '2008-02-02', NULL, NULL, NULL, NULL, NULL, '8016013611', '', NULL, NULL, NULL, 'INDIAN', '36118169855', 'SBIN0008006', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '86', NULL, NULL),
(1035, '01783521000123', 0, 0, '2024-01-01', '0', '0', 'ARIF SK', NULL, 'ISLAM SK', NULL, 'LALBANU BIBI', NULL, '2009-09-10', NULL, NULL, NULL, NULL, NULL, '9593312174', '', NULL, NULL, NULL, 'INDIAN', '5021020000436', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '57', NULL, NULL),
(1036, '05313119000139', 0, 0, '2024-01-01', '0', '0', 'ASHADUL HAQUE', NULL, 'MASADUL HAQUE', NULL, 'SABINA BIBI', NULL, '2009-05-04', NULL, NULL, NULL, NULL, NULL, '9932682807', '', NULL, NULL, NULL, 'INDIAN', '38594822591', 'SBIN0008006', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '32', NULL, NULL),
(1037, '05313519000182', 0, 0, '2024-01-01', '0', '0', 'ASHA KHATUN', NULL, 'KALU SK', NULL, 'ISMETARA BIBI', NULL, '2009-11-18', NULL, NULL, NULL, NULL, NULL, '7810875824', '', NULL, NULL, NULL, 'INDIAN', '5575010021386', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '114', NULL, NULL),
(1038, '05374721000011', 0, 0, '2024-01-01', '0', '0', 'ASHA KHATUN', NULL, 'HALIM ALI', NULL, 'KHADIJA BIBI', NULL, '2008-09-17', NULL, NULL, NULL, NULL, NULL, '9733625926', '', NULL, NULL, NULL, 'INDIAN', '1532101700039666', 'PUNB0153210', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '108', NULL, NULL),
(1039, '05374721000020', 0, 0, '2024-01-01', '0', '0', 'ASIF SK', NULL, 'ASRAF ALI', NULL, 'REGINA BIBI', NULL, '2009-08-20', NULL, NULL, NULL, NULL, NULL, '9854751230', '', NULL, NULL, NULL, 'INDIAN', '0977010108761', 'PUNB0097720', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '107', NULL, NULL),
(1040, '01783521000184', 0, 0, '2024-01-01', '0', '0', 'ASMA KHATUN', NULL, 'ASIF ALI', NULL, 'AKTARA BIBI', NULL, '2010-01-19', NULL, NULL, NULL, NULL, NULL, '8670586915', '', NULL, NULL, NULL, 'INDIAN', '5021020000226', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '51', NULL, NULL),
(1041, '01783521000117', 0, 0, '2024-01-01', '0', '0', 'ASRAFUN NESHA', NULL, 'MD ASRAFUL HOSSAIN', NULL, 'RABIA BIBI', NULL, '2009-09-18', NULL, NULL, NULL, NULL, NULL, '9002119903', '', NULL, NULL, NULL, 'INDIAN', '5021010032805', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL),
(1042, '01783521001307', 0, 0, '2024-01-01', '0', '0', 'CHUMKI KHATUN', NULL, 'SAJAB ALI', NULL, 'RAKIBA BIBI.', NULL, '2009-08-16', NULL, NULL, NULL, NULL, NULL, '8945819302', '', NULL, NULL, NULL, 'INDIAN', '35983831573', 'SBIN0008855', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '33', NULL, NULL),
(1043, '08895119000078', 0, 0, '2024-01-01', '0', '0', 'DEBASISH SARKAR', NULL, 'JAGADISH SARKAR', NULL, 'SARMILA SARKAR', NULL, '2009-02-15', NULL, NULL, NULL, NULL, NULL, '7074537788', '', NULL, NULL, NULL, 'INDIAN', '5021021687508', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', NULL, NULL),
(1044, '05312819000489', 0, 0, '2024-01-01', '0', '0', 'DURGA GHOSH', NULL, 'SAGHA GHOSH', NULL, 'RUMA GHOSH', NULL, '2009-11-16', NULL, NULL, NULL, NULL, NULL, '8967061959', '', NULL, NULL, NULL, 'INDIAN', '50150011542498', 'BDBL0001682', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '60', NULL, NULL),
(1045, '01783521000119', 0, 0, '2024-01-01', '0', '0', 'HUMAYUN SK', NULL, 'BABAR SK', NULL, 'SAKILA BIBI', NULL, '2010-02-15', NULL, NULL, NULL, NULL, NULL, '8777088482', '', NULL, NULL, NULL, 'INDIAN', '5115830695', 'CBIN0280122', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '54', NULL, NULL),
(1046, '05374721000014', 0, 0, '2024-01-01', '0', '0', 'IBRAHIM SHAIKH', NULL, 'SERAJUL SK', NULL, 'SOHAGI BIBI', NULL, '2009-09-25', NULL, NULL, NULL, NULL, NULL, '8967559293', '', NULL, NULL, NULL, 'INDIAN', '5021020000273', 'PUNB0153210', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '121', NULL, NULL),
(1047, '01783521001732', 0, 0, '2024-01-01', '0', '0', 'IBRAHIM SK', NULL, 'REHEL SK', NULL, 'ROHIMA BIBI', NULL, '2009-09-04', NULL, NULL, NULL, NULL, NULL, '8509712510', '', NULL, NULL, NULL, 'INDIAN', '5575010023986', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '64', NULL, NULL),
(1048, '01783521002005', 0, 0, '2024-01-01', '0', '0', 'IMRAN ALI', NULL, 'HABIBUR SK', NULL, 'CHAMPA BIBI', NULL, '2007-03-29', NULL, NULL, NULL, NULL, NULL, '6289326310', '', NULL, NULL, NULL, 'INDIAN', '34782544981', 'SBIN0008855', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '81', NULL, NULL),
(1049, '01783521000907', 0, 0, '2024-01-01', '0', '0', 'ISMAIL SK', NULL, 'DOSTMAHAMMAD', NULL, 'MERINA BIBI', NULL, '2007-05-06', NULL, NULL, NULL, NULL, NULL, '7584921597', '', NULL, NULL, NULL, 'INDIAN', '1532101700047799', 'PUNB0153210', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '82', NULL, NULL),
(1050, '06989122000289', 0, 0, '2024-01-01', '0', '0', 'JAKIR', NULL, 'SARIFUL ISLAM', NULL, 'RAKIBA BIBI', NULL, '2009-10-23', NULL, NULL, NULL, NULL, NULL, '6381110688', '', NULL, NULL, NULL, 'INDIAN', '1726010114257', 'PUNB0172620', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '15', NULL, NULL),
(1051, '08895119000084', 0, 0, '2024-01-01', '0', '0', 'JOYA SARKAR', NULL, 'SAPTAM SARKAR', NULL, 'SOBITA SARKAR', NULL, '2009-08-06', NULL, NULL, NULL, NULL, NULL, '9002313057', '', NULL, NULL, NULL, 'INDIAN', '5021020000947', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '110', NULL, NULL),
(1052, '08896719000030', 0, 0, '2024-01-01', '0', '0', 'KASIM HOSSEN', NULL, 'MD SAKIM HOSSEN', NULL, 'SAHANAJ BIBI', NULL, '2008-11-28', NULL, NULL, NULL, NULL, NULL, '7601877664', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '65', NULL, NULL),
(1053, '05313219000211', 0, 0, '2024-01-01', '0', '0', 'KHADIJA KHATUN', NULL, 'HASIBUL ISLAM', NULL, 'ARJINA BIBI', NULL, '2009-03-24', NULL, NULL, NULL, NULL, NULL, '8116897217', '', NULL, NULL, NULL, 'INDIAN', '5021020001005', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '93', NULL, NULL),
(1054, '05375121000015', 0, 0, '2024-01-01', '0', '0', 'KISHAN SINGHA', NULL, 'NIKHIL SINGHA', NULL, 'KRISHNA SINGHA', NULL, '2008-04-14', NULL, NULL, NULL, NULL, NULL, '7077119907', '', NULL, NULL, NULL, 'INDIAN', '5575010041344', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '119', NULL, NULL),
(1055, '05313119000141', 0, 0, '2024-01-01', '0', '0', 'KOBIRUL ISLAM', NULL, 'HASIBUL ISLAM', NULL, 'JORINA BIBI', NULL, '2009-06-18', NULL, NULL, NULL, NULL, NULL, '9333254969', '', NULL, NULL, NULL, 'INDIAN', '38619737724', 'SBIN0008006', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '31', NULL, NULL),
(1056, '01783521000179', 0, 0, '2024-01-01', '0', '0', 'LIJA KHATUN', NULL, 'HOSSAIN ALI', NULL, 'SUKTARA BIBI', NULL, '2010-08-15', NULL, NULL, NULL, NULL, NULL, '7365997846', '', NULL, NULL, NULL, 'INDIAN', '5021030001244', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '24', NULL, NULL),
(1057, '01783521000132', 0, 0, '2024-01-01', '0', '0', 'MARJINA KHATUN', NULL, 'MAHATAB SK', NULL, 'JABA BIBI', NULL, '2009-09-28', NULL, NULL, NULL, NULL, NULL, '9734241906', '', NULL, NULL, NULL, 'INDIAN', '36118170021', 'SBIN0008006', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '27', NULL, NULL),
(1058, '05375121000013', 0, 0, '2024-01-01', '0', '0', 'MASUDA KHATUN', NULL, 'MARFAT ALI', NULL, 'BELUARA BIBI', NULL, '2009-02-07', NULL, NULL, NULL, NULL, NULL, '8535806994', '', NULL, NULL, NULL, 'INDIAN', '5575010034104', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '115', NULL, NULL),
(1059, '01783521001319', 0, 0, '2024-01-01', '0', '0', 'MD ABU RAIHAN HOQUE', NULL, 'MD SAIFUDDIN SK', NULL, 'MST RENUKA BIBI', NULL, '2008-12-23', NULL, NULL, NULL, NULL, NULL, '8101905708', '', NULL, NULL, NULL, 'INDIAN', '0977010307666', 'PUNB0097720', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '85', NULL, NULL),
(1060, '01783521000914', 0, 0, '2024-01-01', '0', '0', 'MD ALIM SK', NULL, 'RENTU SK', NULL, 'KALPONA BIBI', NULL, '2008-03-10', NULL, NULL, NULL, NULL, NULL, '9382249831', '', NULL, NULL, NULL, 'INDIAN', '33747934448', 'SBIN0008006', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '88', NULL, NULL),
(1061, '01783521001731', 0, 0, '2024-01-01', '0', '0', 'MD ASIK', NULL, 'ABU HENA', NULL, 'MAHIDA BIBI', NULL, '2008-08-02', NULL, NULL, NULL, NULL, NULL, '8918148840', '', NULL, NULL, NULL, 'INDIAN', '5021030000452', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '62', NULL, NULL),
(1062, '01783521000350', 0, 0, '2024-01-01', '0', '0', 'MD RAHUN SK', NULL, 'REJAUL SK', NULL, 'BILKIS BIBI', NULL, '2009-10-23', NULL, NULL, NULL, NULL, NULL, '6295452054', '', NULL, NULL, NULL, 'INDIAN', '5021020000970', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '29', NULL, NULL),
(1063, '01783521000950', 0, 0, '2024-01-01', '0', '0', 'MD RANA ISLAM', NULL, 'SAFIKUL ISLAM', NULL, 'EDULA BIBI', NULL, '2008-12-13', NULL, NULL, NULL, NULL, NULL, '7384093721', '', NULL, NULL, NULL, 'INDIAN', '5575010027131', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '87', NULL, NULL),
(1064, '05374721000019', 0, 0, '2024-01-01', '0', '0', 'MD SARIFUL ISLAM', NULL, 'MD.AKALI SK', NULL, 'SULEKHA BIBI', NULL, '2008-09-27', NULL, NULL, NULL, NULL, NULL, '9999999942', '', NULL, NULL, NULL, 'INDIAN', '5021020000699', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '106', NULL, NULL),
(1065, '01783521000130', 0, 0, '2024-01-01', '0', '0', 'MD YASIN SK', NULL, 'AHASAN ALI', NULL, 'JELEKHA BIBI', NULL, '2008-12-19', NULL, NULL, NULL, NULL, NULL, '8967339310', '', NULL, NULL, NULL, 'INDIAN', '36128412006', 'SBIN0008006', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '44', NULL, NULL),
(1066, '01783521001298', 0, 0, '2024-01-01', '0', '0', 'MEHEBUB HASAN', NULL, 'MD HAZRAT BELLAL HOQUE', NULL, 'TANJURA BIBI.', NULL, '2009-12-01', NULL, NULL, NULL, NULL, NULL, '9134439328', '', NULL, NULL, NULL, 'INDIAN', '5021010032799', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '52', NULL, NULL),
(1067, '05374721000015', 0, 0, '2024-01-01', '0', '0', 'MEHEDI HASAN', NULL, 'SUKURUDDIN SK', NULL, 'KHALIDA BIBI', NULL, '2009-09-11', NULL, NULL, NULL, NULL, NULL, '9091164658', '', NULL, NULL, NULL, 'INDIAN', '5021020000547', 'PUNB0153210', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '109', NULL, NULL),
(1068, '01783523000013', 0, 0, '2024-01-01', '0', '0', 'MEHEDI HASAN', NULL, 'TAJRUL ISLAM', NULL, 'DILRUBA BIBI', NULL, '2009-12-04', NULL, NULL, NULL, NULL, NULL, '9547708392', '', NULL, NULL, NULL, 'INDIAN', '5021010036476', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '26', NULL, NULL),
(1069, '01783521001366', 0, 0, '2024-01-01', '0', '0', 'MERINA KHATUN', NULL, 'ALAMGIR HOSSAIN', NULL, 'SELNA BIBI', NULL, '2009-08-29', NULL, NULL, NULL, NULL, NULL, '9134202012', '', NULL, NULL, NULL, 'INDIAN', '5575010027937', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '21', NULL, NULL),
(1070, '01783521000346', 0, 0, '2024-01-01', '0', '0', 'MESMAUL HOQUE', NULL, 'BOJLUR RAHAMAN', NULL, 'MOUSUMI BIBI', NULL, '2009-08-15', NULL, NULL, NULL, NULL, NULL, '8116851226', '', NULL, NULL, NULL, 'INDIAN', '5021020000393', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '13', NULL, NULL),
(1071, '01783521000127', 0, 0, '2024-01-01', '0', '0', 'MINAR HOSSAIN', NULL, 'JOYNAL ABEDIN', NULL, 'SERINA BIBI', NULL, '2009-10-02', NULL, NULL, NULL, NULL, NULL, '8513958320', '', NULL, NULL, NULL, 'INDIAN', '5021010032294', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '53', NULL, NULL),
(1072, '05313219000229', 0, 0, '2024-01-01', '0', '0', 'MIZANUR RAHAMAN', NULL, 'JAMALUDDIN', NULL, 'MUJLEMA BIBI', NULL, '2009-08-11', NULL, NULL, NULL, NULL, NULL, '9733984182', '', NULL, NULL, NULL, 'INDIAN', '1532101700041494', 'PUNB0153210', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '103', NULL, NULL),
(1073, '01783521000135', 0, 0, '2024-01-01', '0', '0', 'MOMINA KHATUN', NULL, 'SAIBUR RAHAMAN', NULL, 'SUDANA BIBI', NULL, '2010-01-12', NULL, NULL, NULL, NULL, NULL, '8348374910', '', NULL, NULL, NULL, 'INDIAN', '5021010031666', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '48', NULL, NULL),
(1074, '01783521000160', 0, 0, '2024-01-01', '0', '0', 'MONIRUL ISLAM', NULL, 'SAMIM SK', NULL, 'RAKIBA BIBI', NULL, '2009-03-12', NULL, NULL, NULL, NULL, NULL, '9933542425', '', NULL, NULL, NULL, 'INDIAN', '5021020000656', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '37', NULL, NULL),
(1075, '01783521001306', 0, 0, '2024-01-01', '0', '0', 'MST RAFINA YESMIN', NULL, 'KUDDUS ALI', NULL, 'PAPIA KHATUN', NULL, '2009-12-04', NULL, NULL, NULL, NULL, NULL, '7547962298', '', NULL, NULL, NULL, 'INDIAN', '5298025315', 'CBIN0280122', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '46', NULL, NULL),
(1076, '01783521000306', 0, 0, '2024-01-01', '0', '0', 'MST RESMIRA KHATUN', NULL, 'SADDAM HOSSAIN', NULL, 'MUNIYARA BIBI', NULL, '2008-07-21', NULL, NULL, NULL, NULL, NULL, '6289538091', '', NULL, NULL, NULL, 'INDIAN', '1532101700041546', 'PUNB0153210', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '89', NULL, NULL),
(1077, '01783521001301', 0, 0, '2024-01-01', '0', '0', 'MUKTA KHATUN', NULL, 'MATIUR RAHAMAN', NULL, 'BENUARA BIBI', NULL, '2009-03-12', NULL, NULL, NULL, NULL, NULL, '9732454520', '', NULL, NULL, NULL, 'INDIAN', '5021030000576', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '30', NULL, NULL),
(1078, '05374721000060', 0, 0, '2024-01-01', '0', '0', 'NABIRUL ISLAM', NULL, 'ISMAIL SK', NULL, 'MASERA BIBI', NULL, '2009-11-17', NULL, NULL, NULL, NULL, NULL, '9932682807', '', NULL, NULL, NULL, 'INDIAN', '5302796105', 'CBIN0280122', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '104', NULL, NULL);
INSERT INTO `studentdbs` (`id`, `studentid`, `admBookNo`, `admSlNo`, `admDate`, `prCls`, `prSch`, `name`, `adhaar`, `fname`, `fadhaar`, `mname`, `madhaar`, `dob`, `vill`, `post`, `pstn`, `dist`, `pin`, `mobl`, `ssex`, `phch`, `relg`, `cste`, `natn`, `accNo`, `ifsc`, `micr`, `bnnm`, `brnm`, `stclass_id`, `stsection_id`, `session_id`, `school_id`, `streason`, `enclass_id`, `ensection_id`, `ensession_id`, `enreason`, `crstatus`, `remarks`, `created_at`, `updated_at`) VALUES
(1079, '05313119000142', 0, 0, '2024-01-01', '0', '0', 'NAIMA KHATUN', NULL, 'ENAMUL HOQUE', NULL, 'SABINA BIBI', NULL, '2009-07-22', NULL, NULL, NULL, NULL, NULL, '8346852587', '', NULL, NULL, NULL, 'INDIAN', '5021020000980', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '123', NULL, NULL),
(1080, '05313519000185', 0, 0, '2024-01-01', '0', '0', 'NASIM', NULL, 'ABDUL HAKIM', NULL, 'KAJOLA BIBI', NULL, '2009-03-17', NULL, NULL, NULL, NULL, NULL, '7029618930', '', NULL, NULL, NULL, 'INDIAN', '50150011550183', 'BDBL0001165', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '100', NULL, NULL),
(1081, '05375121000014', 0, 0, '2024-01-01', '0', '0', 'NIKITA SINGHA', NULL, 'NIKHIL SINGHA', NULL, 'KRISHNA SINGH', NULL, '2009-07-24', NULL, NULL, NULL, NULL, NULL, '7077119907', '', NULL, NULL, NULL, 'INDIAN', '5575010041292', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '118', NULL, NULL),
(1082, '01783521000128', 0, 0, '2024-01-01', '0', '0', 'NURJAHAN KHATUN', NULL, 'TUMURUDDIN SK', NULL, 'NASIRA BIBI', NULL, '2009-09-19', NULL, NULL, NULL, NULL, NULL, '6295911703', '', NULL, NULL, NULL, 'INDIAN', '5575010033992', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '83', NULL, NULL),
(1083, '01783521001318', 0, 0, '2024-01-01', '0', '0', 'NUR MOHAL KHATUN', NULL, 'ABDUR SALAM', NULL, 'NASURA BIBI', NULL, '2009-04-22', NULL, NULL, NULL, NULL, NULL, '8116756485', '', NULL, NULL, NULL, 'INDIAN', '5290856926', 'CBIN0280122', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '72', NULL, NULL),
(1084, '05313219000216', 0, 0, '2024-01-01', '0', '0', 'PABAN MONDAL', NULL, 'PINTU MONDAL', NULL, 'RADHA MONDAL', NULL, '2009-04-07', NULL, NULL, NULL, NULL, NULL, '9775252230', '', NULL, NULL, NULL, 'INDIAN', '36212711372', 'SBIN0008006', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '105', NULL, NULL),
(1085, '08895119000092', 0, 0, '2024-01-01', '0', '0', 'PIJUS SINGHA', NULL, 'NITAI SINGHA', NULL, 'JUTHIKA SINGHA', NULL, '2009-07-09', NULL, NULL, NULL, NULL, NULL, '9775012330', '', NULL, NULL, NULL, 'INDIAN', '5021010007002', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '28', NULL, NULL),
(1086, '01783521000347', 0, 0, '2024-01-01', '0', '0', 'POMPA MANDAL', NULL, 'KRISHNA MANDAL', NULL, 'RADHA RANI MANDAL', NULL, '2006-06-02', NULL, NULL, NULL, NULL, NULL, '8016006021', '', NULL, NULL, NULL, 'INDIAN', '5021030000138', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '70', NULL, NULL),
(1087, '05375121000017', 0, 0, '2024-01-01', '0', '0', 'PRITY SHIL', NULL, 'MANOJ SHIL', NULL, 'RITA SHIL', NULL, '2010-06-06', NULL, NULL, NULL, NULL, NULL, '9370897126', '', NULL, NULL, NULL, 'INDIAN', '5575010041496', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '116', NULL, NULL),
(1088, '01783521001316', 0, 0, '2024-01-01', '0', '0', 'PRIYA KHATUN', NULL, 'SOHEL RANA', NULL, 'NARGIS BIBI', NULL, '2009-11-22', NULL, NULL, NULL, NULL, NULL, '8653132024', '', NULL, NULL, NULL, 'INDIAN', '5021020000778', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '71', NULL, NULL),
(1089, '01783521000133', 0, 0, '2024-01-01', '0', '0', 'PURNIMA KHATUN', NULL, 'TUTUL SK', NULL, 'AMBIA BIBI', NULL, '2009-09-14', NULL, NULL, NULL, NULL, NULL, '9134644315', '', NULL, NULL, NULL, 'INDIAN', '5021020000509', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '36', NULL, NULL),
(1090, '01783521000120', 0, 0, '2024-01-01', '0', '0', 'RAHIDUL ISLAM', NULL, 'NAJMOL HAQUE', NULL, 'RUPSONA BIBI', NULL, '2009-10-05', NULL, NULL, NULL, NULL, NULL, '7029385944', '', NULL, NULL, NULL, 'INDIAN', '5115833652', 'CBIN0280122', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '55', NULL, NULL),
(1091, '01475519000254', 0, 0, '2024-01-01', '0', '0', 'RAJIA SULTANA', NULL, 'ANOWAR ALI', NULL, 'CHAMPA BIBI', NULL, '2010-03-11', NULL, NULL, NULL, NULL, NULL, '9836453489', '', NULL, NULL, NULL, 'INDIAN', '5021020001094', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '16', NULL, NULL),
(1092, '01783521000125', 0, 0, '2024-01-01', '0', '0', 'RAJ SK', NULL, 'TITU SK', NULL, 'KAMRUNNESHA BIBI', NULL, '2010-02-17', NULL, NULL, NULL, NULL, NULL, '9933468041', '', NULL, NULL, NULL, 'INDIAN', '5021020000536', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '19', NULL, NULL),
(1093, '05313119000127', 0, 0, '2024-01-01', '0', '0', 'RAMIJ HASAN', NULL, 'EBADUL HOQUE', NULL, 'ANGURA BIBI', NULL, '2009-04-23', NULL, NULL, NULL, NULL, NULL, '7384757374', '', NULL, NULL, NULL, 'INDIAN', '5021020000517', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '61', NULL, NULL),
(1094, '01475519000288', 0, 0, '2024-01-01', '0', '0', 'RAMIJ RAJA', NULL, 'BABOR ALI', NULL, 'MODHU BIBI', NULL, '2009-04-16', NULL, NULL, NULL, NULL, NULL, '9091197124', '', NULL, NULL, NULL, 'INDIAN', '5021020000381', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '67', NULL, NULL),
(1095, '01783521000952', 0, 0, '2024-01-01', '0', '0', 'RANI KHATUN', NULL, 'NEMASUDDIN SK', NULL, 'KAMELA BIBI', NULL, '2008-01-27', NULL, NULL, NULL, NULL, NULL, '9641047266', '', NULL, NULL, NULL, 'INDIAN', '36196849033', 'SBIN0008006', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91', NULL, NULL),
(1096, '01783521001299', 0, 0, '2024-01-01', '0', '0', 'RESHMI KHATUN', NULL, 'REJAUL KARIM', NULL, 'REJINA BIBI', NULL, '2009-11-08', NULL, NULL, NULL, NULL, NULL, '9735771008', '', NULL, NULL, NULL, 'INDIAN', '5021010033789', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '9', NULL, NULL),
(1097, '05313519000181', 0, 0, '2024-01-01', '0', '0', 'RIMI', NULL, 'NAJIM SK', NULL, 'MASUDA BIBI', NULL, '2009-10-19', NULL, NULL, NULL, NULL, NULL, '7089855168', '', NULL, NULL, NULL, 'INDIAN', '5575010032531', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '113', NULL, NULL),
(1098, '01783521000122', 0, 0, '2024-01-01', '0', '0', 'RINKI KHATUN', NULL, 'ABU SOYEL SK', NULL, 'AMENA BIBI', NULL, '2009-08-13', NULL, NULL, NULL, NULL, NULL, '8509880644', '', NULL, NULL, NULL, 'INDIAN', '5021020000387', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '34', NULL, NULL),
(1099, '01783521000911', 0, 0, '2024-01-01', '0', '0', 'ROHIT HASAN', NULL, 'RABIUL', NULL, 'HADESA BIBI', NULL, '2008-12-12', NULL, NULL, NULL, NULL, NULL, '8617235907', '', NULL, NULL, NULL, 'INDIAN', '35866951532', 'SBIN0008006', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '90', NULL, NULL),
(1100, '01783522002050', 0, 0, '2024-01-01', '0', '0', 'ROHIT ISLAM', NULL, 'HUMAYUN SK', NULL, 'JOHARA BIBI', NULL, '2008-06-01', NULL, NULL, NULL, NULL, NULL, '7029985575', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '66', NULL, NULL),
(1101, '01783521001742', 0, 0, '2024-01-01', '0', '0', 'ROHIT ISLAM', NULL, 'ASRAFUL SK', NULL, 'ASHA BIBI', NULL, '2009-08-18', NULL, NULL, NULL, NULL, NULL, '7864839563', '', NULL, NULL, NULL, 'INDIAN', '5021030000961', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '45', NULL, NULL),
(1102, '05374721000013', 0, 0, '2024-01-01', '0', '0', 'ROHIT SK', NULL, 'ANISUR RAHAMAN', NULL, 'RUBIYA BIBI', NULL, '2009-09-24', NULL, NULL, NULL, NULL, NULL, '9547903342', '', NULL, NULL, NULL, 'INDIAN', '15322160224389', 'PUNB0153210', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '92', NULL, NULL),
(1103, '01783521000185', 0, 0, '2024-01-01', '0', '0', 'ROHIT SK', NULL, 'KHAIRUL SK', NULL, 'ASEBA BIBI.', NULL, '2009-08-14', NULL, NULL, NULL, NULL, NULL, '6297755278', '', NULL, NULL, NULL, 'INDIAN', '5021010033965', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '49', NULL, NULL),
(1104, '05313219000221', 0, 0, '2024-01-01', '0', '0', 'ROKIA KHATUN', NULL, 'AZAD SEKH', NULL, 'ADORA BIBI', NULL, '2009-07-12', NULL, NULL, NULL, NULL, NULL, '7063826377', '', NULL, NULL, NULL, 'INDIAN', '5021010032373', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '73', NULL, NULL),
(1105, '05313519000180', 0, 0, '2024-01-01', '0', '0', 'RONI', NULL, 'NAJIM SK', NULL, 'MASUDA BIBI', NULL, '2009-10-19', NULL, NULL, NULL, NULL, NULL, '8609996513', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '120', NULL, NULL),
(1106, '05313019000140', 0, 0, '2024-01-01', '0', '0', 'ROUSANARA KHATUN', NULL, 'LUTFAR RAHAMAN', NULL, 'SHILPI BIBI', NULL, '2009-07-12', NULL, NULL, NULL, NULL, NULL, '8016354087', '', NULL, NULL, NULL, 'INDIAN', '0977010307932', 'PUNB0097720', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '41', NULL, NULL),
(1107, '01783521000191', 0, 0, '2024-01-01', '0', '0', 'RUHINA KHATUN', NULL, 'ALLAREKHA', NULL, 'REKSONA BIBI', NULL, '2009-12-23', NULL, NULL, NULL, NULL, NULL, '8918274372', '', NULL, NULL, NULL, 'INDIAN', '5575010033239', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '50', NULL, NULL),
(1108, '05313019000128', 0, 0, '2024-01-01', '0', '0', 'SABIA AKTAR', NULL, 'MD HANIF SK', NULL, 'MEHERUNNESHA BIBI', NULL, '2009-09-07', NULL, NULL, NULL, NULL, NULL, '8597703994', '', NULL, NULL, NULL, 'INDIAN', '5021010031860', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '11', NULL, NULL),
(1109, '01783521000189', 0, 0, '2024-01-01', '0', '0', 'SABNAM MEHEDI', NULL, 'SEBADUL HOQUE', NULL, 'BASIRUL BIBI', NULL, '2009-02-08', NULL, NULL, NULL, NULL, NULL, '8116423275', '', NULL, NULL, NULL, 'INDIAN', '5021020000535', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '35', NULL, NULL),
(1110, '01783521001315', 0, 0, '2024-01-01', '0', '0', 'SADIYA SULTANA', NULL, 'MD GOLAM MURSHED', NULL, 'MST CEAUTY BIBI', NULL, '2010-03-10', NULL, NULL, NULL, NULL, NULL, '9775688149', '', NULL, NULL, NULL, 'INDIAN', '35180892505', 'SBIN0008006', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '18', NULL, NULL),
(1111, '01783521001367', 0, 0, '2024-01-01', '0', '0', 'SAFIKUL SK', NULL, 'RAFIKUL ISLAM', NULL, 'SELINA BIBI', NULL, '2008-12-17', NULL, NULL, NULL, NULL, NULL, '8536823574', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '80', NULL, NULL),
(1112, '01783521000157', 0, 0, '2024-01-01', '0', '0', 'SAGAR SK', NULL, 'JAHIRUDDIN SK', NULL, 'TARJINA BIBI', NULL, '2009-02-19', NULL, NULL, NULL, NULL, NULL, '9091212506', '', NULL, NULL, NULL, 'INDIAN', '5021020000065', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '25', NULL, NULL),
(1113, '05759119000079', 0, 0, '2024-01-01', '0', '0', 'SAHANAJ SARKAR', NULL, 'SAHIN SK', NULL, 'TAHERA BIBI', NULL, '2009-05-12', NULL, NULL, NULL, NULL, NULL, '8972796775', '', NULL, NULL, NULL, 'INDIAN', '0977010222211', 'PUNB0097720', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '22', NULL, NULL),
(1114, '05313119000129', 0, 0, '2024-01-01', '0', '0', 'SAHINA KHATUN', NULL, 'FATIK SK', NULL, 'MST NASIMA BIBI', NULL, '2009-02-01', NULL, NULL, NULL, NULL, NULL, '9635641528', '', NULL, NULL, NULL, 'INDIAN', '5021020000418', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '39', NULL, NULL),
(1115, '01783521001728', 0, 0, '2024-01-01', '0', '0', 'SAHINA PARVIN', NULL, 'HAJIKUL ISLAM', NULL, 'RUBINA BIBI', NULL, '2009-03-31', NULL, NULL, NULL, NULL, NULL, '9635121360', '', NULL, NULL, NULL, 'INDIAN', '35825906467', 'SBIN0015048', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '47', NULL, NULL),
(1116, '01783521001305', 0, 0, '2024-01-01', '0', '0', 'SAIDUL ISLAM', NULL, 'GOLAM ROSUL', NULL, 'AKLEMA BIBI', NULL, '2009-07-12', NULL, NULL, NULL, NULL, NULL, '7585938486', '', NULL, NULL, NULL, 'INDIAN', '5021020000521', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '56', NULL, NULL),
(1117, '01783521000348', 0, 0, '2024-01-01', '0', '0', 'SAIMA KHATUN', NULL, 'MAIDUL SK', NULL, 'SUNDARI BIBI', NULL, '2009-04-14', NULL, NULL, NULL, NULL, NULL, '8373875429', '', NULL, NULL, NULL, 'INDIAN', '5021020000872', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '75', NULL, NULL),
(1118, '01783521001718', 0, 0, '2024-01-01', '0', '0', 'SAKILA KHATUN', NULL, 'LUTFAR RAHAMAN', NULL, 'SALMA BIBI', NULL, '2008-05-04', NULL, NULL, NULL, NULL, NULL, '7319347474', '', NULL, NULL, NULL, 'INDIAN', '36003929646', 'SBIN0008006', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '84', NULL, NULL),
(1119, '01783521001302', 0, 0, '2024-01-01', '0', '0', 'SANIA KHATUN', NULL, 'JAMIRUL ISLAM', NULL, 'SELINA BIBI', NULL, '2009-03-16', NULL, NULL, NULL, NULL, NULL, '7074289117', '', NULL, NULL, NULL, 'INDIAN', '5021010036616', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '23', NULL, NULL),
(1120, '01783521000188', 0, 0, '2024-01-01', '0', '0', 'SANTONA KHATUN', NULL, 'SAIBUR RAHAMAN', NULL, 'LAILI IBI', NULL, '2009-07-21', NULL, NULL, NULL, NULL, NULL, '9775334768', '', NULL, NULL, NULL, 'INDIAN', '36128411636', 'SBIN0008006', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '20', NULL, NULL),
(1121, '01783521001314', 0, 0, '2024-01-01', '0', '0', 'SAREJUL ISLAM', NULL, 'ABUL KHAIR', NULL, 'MST SAHERA BIBI', NULL, '2009-10-17', NULL, NULL, NULL, NULL, NULL, '7074023980', '', NULL, NULL, NULL, 'INDIAN', '0977010309288', 'PUNB0097720', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '69', NULL, NULL),
(1122, '01783522002055', 0, 0, '2024-01-01', '0', '0', 'SARJINA KHATUN', NULL, 'SANUYAR ALI', NULL, 'HASINA BIBI', NULL, '2009-04-24', NULL, NULL, NULL, NULL, NULL, '9734968714', '', NULL, NULL, NULL, 'INDIAN', '5021030000450', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '14', NULL, NULL),
(1123, '01783521001300', 0, 0, '2024-01-01', '0', '0', 'SARWAR HOSSAIN', NULL, 'ALAM SK', NULL, 'ABEDA BIBI', NULL, '2010-03-02', NULL, NULL, NULL, NULL, NULL, '7074295975', '', NULL, NULL, NULL, 'INDIAN', '5021030000747', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '125', NULL, NULL),
(1124, '04398319000406', 0, 0, '2024-01-01', '0', '0', 'SEFALI KHATUN', NULL, 'SAKIBUR SK', NULL, 'MASTURA BIBI', NULL, '2009-10-15', NULL, NULL, NULL, NULL, NULL, '8768598009', '', NULL, NULL, NULL, 'INDIAN', '1683001700055396', 'PUNB0168300', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '94', NULL, NULL),
(1125, '01783521001362', 0, 0, '2024-01-01', '0', '0', 'SHANTANA KHATUN', NULL, 'MD SAFIKUL ISLAM', NULL, 'NURJAHAN BIBI', NULL, '2009-11-17', NULL, NULL, NULL, NULL, NULL, '8016583550', '', NULL, NULL, NULL, 'INDIAN', '5021030000604', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '77', NULL, NULL),
(1126, '05374721000016', 0, 0, '2024-01-01', '0', '0', 'SHIRINA KHATUN', NULL, 'AINUL SK', NULL, 'MENOKA BIBI', NULL, '2008-10-02', NULL, NULL, NULL, NULL, NULL, '8670527899', '', NULL, NULL, NULL, 'INDIAN', '38608409558', 'SBIN0008006', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '99', NULL, NULL),
(1127, '05374721000017', 0, 0, '2024-01-01', '0', '0', 'SHYAMALI KHATUN', NULL, 'TINKU SK', NULL, 'ARSINA BIBI', NULL, '2008-08-23', NULL, NULL, NULL, NULL, NULL, '8967172693', '', NULL, NULL, NULL, 'INDIAN', '5021010000928', 'PUNB0068820', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '98', NULL, NULL),
(1128, '05312919000101', 0, 0, '2024-01-01', '0', '0', 'SILA KHATUN', NULL, 'BASIR SEKH', NULL, 'DILRUBA BIBI', NULL, '2009-08-30', NULL, NULL, NULL, NULL, NULL, '8348675179', '', NULL, NULL, NULL, 'INDIAN', '5021010032203', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '17', NULL, NULL),
(1129, '01475619000101', 0, 0, '2024-01-01', '0', '0', 'SIRIN SABA', NULL, 'TAJRULSK', NULL, 'JORINA BIBI', NULL, '2009-05-23', NULL, NULL, NULL, NULL, NULL, '7699875078', '', NULL, NULL, NULL, 'INDIAN', '5021010033479', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '10', NULL, NULL),
(1130, '05375121000010', 0, 0, '2024-01-01', '0', '0', 'SNIGDHA SINGHA', NULL, 'SUBRATA SINGHA', NULL, 'KOBITA SINGHA', NULL, '2009-03-03', NULL, NULL, NULL, NULL, NULL, '9134625667', '', NULL, NULL, NULL, 'INDIAN', '5575010040266', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '117', NULL, NULL),
(1131, '01783521000186', 0, 0, '2024-01-01', '0', '0', 'SOHEL TANBIR', NULL, 'MD SENTOO HAQUE', NULL, 'NAJEMA BIBI', NULL, '2009-01-23', NULL, NULL, NULL, NULL, NULL, '9564748399', '', NULL, NULL, NULL, 'INDIAN', '38289373266', 'SBIN0015048', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '43', NULL, NULL),
(1132, '01783521001815', 0, 0, '2024-01-01', '0', '0', 'SOHON', NULL, 'NIJAMUDDIN SK', NULL, 'TAHARA BIBI', NULL, '2009-10-12', NULL, NULL, NULL, NULL, NULL, '7602318948', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '122', NULL, NULL),
(1133, '08895119000087', 0, 0, '2024-01-01', '0', '0', 'SOMA MONDAL', NULL, 'JOGESH MONDAL', NULL, 'RUPALI MONDAL', NULL, '2009-06-15', NULL, NULL, NULL, NULL, NULL, '6200658246', '', NULL, NULL, NULL, 'INDIAN', '5021010042130', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '97', NULL, NULL),
(1134, '05375121000038', 0, 0, '2024-01-01', '0', '0', 'SOYEED AFRIDI', NULL, 'RABIUL ISLAM', NULL, 'RUNALAILA BIBI', NULL, '2009-10-03', NULL, NULL, NULL, NULL, NULL, '8436097898', '', NULL, NULL, NULL, 'INDIAN', '1532101700031363', 'PUNB0153210', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '102', NULL, NULL),
(1135, '01783521000126', 0, 0, '2024-01-01', '0', '0', 'SUMAIYA KHATUN', NULL, 'SUKBOR ALI', NULL, 'HASINA BIBI', NULL, '2010-02-15', NULL, NULL, NULL, NULL, NULL, '9733877532', '', NULL, NULL, NULL, 'INDIAN', '5021020000504', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5', NULL, NULL),
(1136, '01783521001724', 0, 0, '2024-01-01', '0', '0', 'SUMI KHATUN', NULL, 'AYNAL HAQUE', NULL, 'JHUMA BIBI', NULL, '2009-09-20', NULL, NULL, NULL, NULL, NULL, '8972407209', '', NULL, NULL, NULL, 'INDIAN', '5021030000515', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8', NULL, NULL),
(1137, '05375121000040', 0, 0, '2024-01-01', '0', '0', 'SURAJ SINGHA', NULL, 'UJJAL SINGHA', NULL, 'KOBITA SINGHA', NULL, '2008-12-13', NULL, NULL, NULL, NULL, NULL, '6297940466', '', NULL, NULL, NULL, 'INDIAN', '5575010041478', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '101', NULL, NULL),
(1138, '08895119000083', 0, 0, '2024-01-01', '0', '0', 'SUSMITA MONDAL', NULL, 'RAJKUMAR MONDAL', NULL, 'REKHA MONDAL', NULL, '2009-11-28', NULL, NULL, NULL, NULL, NULL, '6261657131', '', NULL, NULL, NULL, 'INDIAN', '5021020001113', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '111', NULL, NULL),
(1139, '01783521001729', 0, 0, '2024-01-01', '0', '0', 'SWEET', NULL, 'TUHIN SK', NULL, 'TUHINA BIBI', NULL, '2009-08-29', NULL, NULL, NULL, NULL, NULL, '9876433257', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '58', NULL, NULL),
(1140, '05759119000080', 0, 0, '2024-01-01', '0', '0', 'SWEETY KHATUN', NULL, 'HAJIKUL ISLAM', NULL, 'RUPALI BIBI', NULL, '2009-01-31', NULL, NULL, NULL, NULL, NULL, '9747846805', '', NULL, NULL, NULL, 'INDIAN', '33113049886', 'SBIN0008006', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '38', NULL, NULL),
(1141, '05375121000020', 0, 0, '2024-01-01', '0', '0', 'TAHAMINA KHATUN', NULL, 'MOYDUL', NULL, 'REJINA BIBI', NULL, '2009-03-05', NULL, NULL, NULL, NULL, NULL, '9091528405', '', NULL, NULL, NULL, 'INDIAN', '5575010033248', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '112', NULL, NULL),
(1142, '01783521001813', 0, 0, '2024-01-01', '0', '0', 'TAMIM HASAN', NULL, 'SARIKUL ISLAM', NULL, 'ARJINA', NULL, '2009-07-04', NULL, NULL, NULL, NULL, NULL, '9932982218', '', NULL, NULL, NULL, 'INDIAN', '5021019900124', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '79', NULL, NULL),
(1143, '01783521000134', 0, 0, '2024-01-01', '0', '0', 'TANESHA KHATUN', NULL, 'LALMAHAMMAD', NULL, 'JOSTNA BIBI', NULL, '2009-08-11', NULL, NULL, NULL, NULL, NULL, '9641911584', '', NULL, NULL, NULL, 'INDIAN', '1532216023877', 'PUNB0153210', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '42', NULL, NULL),
(1144, '01783524000003', 0, 0, '2024-01-01', '0', '0', 'TANUSHREE GHOSH', NULL, 'NIRANJAN KUMAR GHOSH.', NULL, 'ROBITA GHOSH.', NULL, '2008-07-16', NULL, NULL, NULL, NULL, NULL, '9733526642', '', NULL, NULL, NULL, 'INDIAN', '5021010049993', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '146', NULL, NULL),
(1145, '05374721000038', 0, 0, '2024-01-01', '0', '0', 'TANUSHREE GHOSH', NULL, 'NIRANJAN KUMAR GHOSH', NULL, 'ROBITA GHOSH', NULL, '2008-07-16', NULL, NULL, NULL, NULL, NULL, '9733526642', '', NULL, NULL, NULL, 'INDIAN', '5021010049993', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '126', NULL, NULL),
(1146, '01783521000118', 0, 0, '2024-01-01', '0', '0', 'TAYEMA AKTAR', NULL, 'NABIRUL ISLAM', NULL, 'FATEMA BIBI', NULL, '2009-01-01', NULL, NULL, NULL, NULL, NULL, '8145924810', '', NULL, NULL, NULL, 'INDIAN', '5021010033372', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '12', NULL, NULL),
(1147, '01783521000121', 0, 0, '2024-01-01', '0', '0', 'TOHIMINA KHATUN', NULL, 'MD TAJMAL HAQUE', NULL, 'CHANDMIRA BIBI', NULL, '2009-08-30', NULL, NULL, NULL, NULL, NULL, '9088901406', '', NULL, NULL, NULL, 'INDIAN', '5021010030904', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4', NULL, NULL),
(1148, '05313019000127', 0, 0, '2024-01-01', '0', '0', 'TOUHIDA KHATUN', NULL, 'ABDUR RAJJAK', NULL, 'UMME AYESHA KHATUN', NULL, '2009-10-30', NULL, NULL, NULL, NULL, NULL, '8944941630', '', NULL, NULL, NULL, 'INDIAN', '5021010033761', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '3', NULL, NULL),
(1149, '01475519000260', 0, 0, '2024-01-01', '0', '0', 'TUHINA KHATUN', NULL, 'SAFIKUL ISLAM', NULL, 'TARJINA BIBI', NULL, '2009-07-14', NULL, NULL, NULL, NULL, NULL, '8350069436', '', NULL, NULL, NULL, 'INDIAN', '5021020000544', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '68', NULL, NULL),
(1150, '01783521000129', 0, 0, '2024-01-01', '0', '0', 'WALIULLAH HOQUE', NULL, 'ISMAIL HOQUE', NULL, 'SELINA BIBI', NULL, '2009-06-21', NULL, NULL, NULL, NULL, NULL, '9091182269', '', NULL, NULL, NULL, 'INDIAN', '1314010189842', 'PUNB0131420', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '63', NULL, NULL),
(1151, '05759119000085', 0, 0, '2024-01-01', '0', '0', 'YEADUL SK', NULL, 'ISLAM SK', NULL, 'ASURA BIBI', NULL, '2009-02-12', NULL, NULL, NULL, NULL, NULL, '9547503496', '', NULL, NULL, NULL, 'INDIAN', '5575010034487', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '59', NULL, NULL),
(1152, '05311919000452', 0, 0, '2024-01-01', '0', '0', 'ABHIJIT MANDAL', NULL, 'PABAN MANDAL', NULL, 'JAMUNA MANDAL', NULL, '2008-12-27', NULL, NULL, NULL, NULL, NULL, '8001136628', '', NULL, NULL, NULL, 'INDIAN', '35056077559', 'SBIN0015048', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '78', NULL, NULL),
(1153, '05312919000117', 0, 0, '2024-01-01', '0', '0', 'AKSHAI RABI DAS', NULL, 'UTTAM DAS', NULL, 'TUKTUKI DAS', NULL, '2009-11-10', NULL, NULL, NULL, NULL, NULL, '9874665222', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '57', NULL, NULL),
(1154, '01783521001269', 0, 0, '2024-01-01', '0', '0', 'AKTARUNNESHA', NULL, 'SAIDUL SK', NULL, 'NAJERA BIBI', NULL, '2009-03-12', NULL, NULL, NULL, NULL, NULL, '9679216476', '', NULL, NULL, NULL, 'INDIAN', '5021030000829', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '19', NULL, NULL),
(1155, '05313119000143', 0, 0, '2024-01-01', '0', '0', 'ALAMIN', NULL, 'SELIM SK', NULL, 'FATEMA BIBI', NULL, '2009-07-06', NULL, NULL, NULL, NULL, NULL, '9333254969', '', NULL, NULL, NULL, 'INDIAN', '39094457550', 'SBIN0015048', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '44', NULL, NULL),
(1156, '01783521001285', 0, 0, '2024-01-01', '0', '0', 'ALAMIN SK', NULL, 'MISSON SK', NULL, 'SARJINA BIBI', NULL, '2009-12-24', NULL, NULL, NULL, NULL, NULL, '9134530515', '', NULL, NULL, NULL, 'INDIAN', '0977010288144', 'PUNB0097720', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '16', NULL, NULL),
(1157, '05313019000145', 0, 0, '2024-01-01', '0', '0', 'ASGAR ALI', NULL, 'EKBAR SK', NULL, 'FIROJA BIBI', NULL, '2007-08-21', NULL, NULL, NULL, NULL, NULL, '9088290122', '', NULL, NULL, NULL, 'INDIAN', '32659963931', 'SBIN0008855', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '38', NULL, NULL),
(1158, '01783521000887', 0, 0, '2024-01-01', '0', '0', 'ASIK KR SAHA', NULL, 'ASHOK KUMAR SAHA', NULL, 'MAMPI SAHA', NULL, '2009-12-23', NULL, NULL, NULL, NULL, NULL, '9641614139', '', NULL, NULL, NULL, 'INDIAN', '5021010032878', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '59', NULL, NULL),
(1159, '01783521001270', 0, 0, '2024-01-01', '0', '0', 'ASMIR HOSSAIN', NULL, 'NAJIBUR RAHAMAN', NULL, 'SALEMA BIBI', NULL, '2009-05-01', NULL, NULL, NULL, NULL, NULL, '9635865665', '', NULL, NULL, NULL, 'INDIAN', '33714686426', 'SBIN0008006', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '39', NULL, NULL),
(1160, '01783521001286', 0, 0, '2024-01-01', '0', '0', 'AYAN SK', NULL, 'MINARUL ISLAM', NULL, 'RUNA KHATUN', NULL, '2009-09-06', NULL, NULL, NULL, NULL, NULL, '9635875456', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '32', NULL, NULL),
(1161, '01783521001045', 0, 0, '2024-01-01', '0', '0', 'AYESHA KHATUN', NULL, 'SIDDIK SK', NULL, 'SOHAGI BIBI', NULL, '2006-12-02', NULL, NULL, NULL, NULL, NULL, '7501729501', '', NULL, NULL, NULL, 'INDIAN', '34744865207', 'SBIN0008855', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '112', NULL, NULL),
(1162, '01783521000978', 0, 0, '2024-01-01', '0', '0', 'BEAUTY MONDAL', NULL, 'SENTU MONDAL', NULL, 'LATIKA MONDAL', NULL, '2008-07-25', NULL, NULL, NULL, NULL, NULL, '9609428774', '', NULL, NULL, NULL, 'INDIAN', '38301719910', 'SBIN0008006', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '110', NULL, NULL),
(1163, '01783521001979', 0, 0, '2024-01-01', '0', '0', 'DEBRAJ MANDAL', NULL, 'KRISHNA MONDAL', NULL, 'TARULATA MANDAL', NULL, '2008-03-26', NULL, NULL, NULL, NULL, NULL, '9635899875', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '98', NULL, NULL),
(1164, '08895119000090', 0, 0, '2024-01-01', '0', '0', 'DIPANKAR MANDAL', NULL, 'LALCHAND MANDAL', NULL, 'DIPALI MANDAL', NULL, '2009-11-22', NULL, NULL, NULL, NULL, NULL, '8100862517', '', NULL, NULL, NULL, 'INDIAN', '5021010037785', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '30', NULL, NULL),
(1165, '05312719000091', 0, 0, '2024-01-01', '0', '0', 'EJAJUL SK', NULL, 'MOKKEL SK', NULL, 'PIYARA BIBI', NULL, '2009-06-12', NULL, NULL, NULL, NULL, NULL, '9609470836', '', NULL, NULL, NULL, 'INDIAN', '5021010031569', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '13', NULL, NULL),
(1166, '05311919000461', 0, 0, '2024-01-01', '0', '0', 'FIKULLIL OMOR', NULL, 'BABULAL', NULL, 'ARJINA BIBI', NULL, '2009-01-24', NULL, NULL, NULL, NULL, NULL, '8513881971', '', NULL, NULL, NULL, 'INDIAN', '5237738168', 'CBIN0280122', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '73', NULL, NULL),
(1167, '01783521001290', 0, 0, '2024-01-01', '0', '0', 'GOLAM SAROWAR', NULL, 'MD MIJAUL HOQUE', NULL, 'MST GOLAPI BIBI', NULL, '2008-11-14', NULL, NULL, NULL, NULL, NULL, '8240012845', '', NULL, NULL, NULL, 'INDIAN', '1532101700040848', 'PUNB0153210', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '35', NULL, NULL),
(1168, '01475519000266', 0, 0, '2024-01-01', '0', '0', 'GOLAP SHA', NULL, 'KAMRUL ISLAM', NULL, 'MINARA BIBI', NULL, '2009-04-17', NULL, NULL, NULL, NULL, NULL, '9732450246', '', NULL, NULL, NULL, 'INDIAN', '5021020000379', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '29', NULL, NULL),
(1169, '08895119000081', 0, 0, '2024-01-01', '0', '0', 'GOPAL MANDAL', NULL, 'MADHUSUDAN MANDAL', NULL, 'BANDANA MANDAL', NULL, '2009-11-29', NULL, NULL, NULL, NULL, NULL, '7319126303', '', NULL, NULL, NULL, 'INDIAN', '5021010024772', 'UTBI0RRBBGB', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '51', NULL, NULL),
(1170, '01783521000904', 0, 0, '2024-01-01', '0', '0', 'GOURAB MONDAL', NULL, 'RANJIT MANDAL', NULL, 'BISHAKKHA MANDLA', NULL, '2009-07-31', NULL, NULL, NULL, NULL, NULL, '9679321661', '', NULL, NULL, NULL, 'INDIAN', '5021010039808', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4', NULL, NULL),
(1171, '05311919000439', 0, 0, '2024-01-01', '0', '0', 'HAYAT ALI', NULL, 'BADIUJJAMAN', NULL, 'NASIMA BIBI', NULL, '2009-05-18', NULL, NULL, NULL, NULL, NULL, '9091885805', '', NULL, NULL, NULL, 'INDIAN', '5132330272', 'CBIN0280122', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '74', NULL, NULL),
(1172, '05313119000134', 0, 0, '2024-01-01', '0', '0', 'HOSAIN', NULL, 'TUTUL SK', NULL, 'DILRUBA BIBI.', NULL, '2009-06-23', NULL, NULL, NULL, NULL, NULL, '9593312174', '', NULL, NULL, NULL, 'INDIAN', '5021020000486', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '36', NULL, NULL),
(1173, '01783521001950', 0, 0, '2024-01-01', '0', '0', 'HRITWIEK SK', NULL, 'AKBAR SK', NULL, 'SAGARA BIBI', NULL, '2008-03-25', NULL, NULL, NULL, NULL, NULL, '8967555134', '', NULL, NULL, NULL, 'INDIAN', '36159477973', 'SBIN0008006', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '109', NULL, NULL),
(1174, '01783521001266', 0, 0, '2024-01-01', '0', '0', 'IBRAHIM ALI', NULL, 'AAUL HAQUE', NULL, 'KHOSBANU BIBI', NULL, '2008-03-13', NULL, NULL, NULL, NULL, NULL, '8509866676', '', NULL, NULL, NULL, 'INDIAN', '38584454753', 'SBIN0008006', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '54', NULL, NULL),
(1175, '01783521001279', 0, 0, '2024-01-01', '0', '0', 'IMRAN ALI', NULL, 'RAKIBUL ISLAM', NULL, 'SELINA BIBI', NULL, '2008-03-21', NULL, NULL, NULL, NULL, NULL, '6290397924', '', NULL, NULL, NULL, 'INDIAN', '36196849419', 'SBIN0008006', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '43', NULL, NULL),
(1176, '09326921000140', 0, 0, '2024-01-01', '0', '0', 'IMROJ ALI', NULL, 'AMINUL ISLAM', NULL, 'MST SAYERA BIBI', NULL, '2010-01-26', NULL, NULL, NULL, NULL, NULL, '7699378305', '', NULL, NULL, NULL, 'INDIAN', '5021010033248', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '11', NULL, NULL),
(1177, '05313219000209', 0, 0, '2024-01-01', '0', '0', 'ISRAIL', NULL, 'ISMAIL', NULL, 'KALPANA BIBI', NULL, '2009-05-06', NULL, NULL, NULL, NULL, NULL, '7699220829', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '10', NULL, NULL),
(1178, '01475519000291', 0, 0, '2024-01-01', '0', '0', 'ISTAK AHAMED', NULL, 'SAMAUN ALI', NULL, 'TARJINA BIBI', NULL, '2009-09-04', NULL, NULL, NULL, NULL, NULL, '9734252904', '', NULL, NULL, NULL, 'INDIAN', '5291201935', 'CBIN0280122', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '58', NULL, NULL),
(1179, '01783521001190', 0, 0, '2024-01-01', '0', '0', 'ISTAK AHMED', NULL, 'ISMAIL SK', NULL, 'CHENTARA BIBI', NULL, '2009-11-18', NULL, NULL, NULL, NULL, NULL, '9002385834', '', NULL, NULL, NULL, 'INDIAN', '5021010036625', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '12', NULL, NULL),
(1180, '01783521001739', 0, 0, '2024-01-01', '0', '0', 'JESMIN KHATUN', NULL, 'JAMAL SK', NULL, 'JOSHNA BIBI', NULL, '2009-03-18', NULL, NULL, NULL, NULL, NULL, '9907477372', '', NULL, NULL, NULL, 'INDIAN', '5021030000608', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '68', NULL, NULL),
(1181, '01783521001777', 0, 0, '2024-01-01', '0', '0', 'JINNATUNNESA KHATUN', NULL, 'ASRAF ALI', NULL, 'AMINA BIBI', NULL, '2008-11-28', NULL, NULL, NULL, NULL, NULL, '8159998978', '', NULL, NULL, NULL, 'INDIAN', '36128411160', 'SBIN0008006', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '89', NULL, NULL),
(1182, '01783521001205', 0, 0, '2024-01-01', '0', '0', 'JISAN SK', NULL, 'HAJEKUL SEIKH', NULL, 'JOLY BIBI', NULL, '2009-10-26', NULL, NULL, NULL, NULL, NULL, '8116636824', '', NULL, NULL, NULL, 'INDIAN', '5021030000429', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '20', NULL, NULL),
(1183, '01783521001975', 0, 0, '2024-01-01', '0', '0', 'JONAB', NULL, 'TIARUL SK', NULL, 'FENCY BIBI', NULL, '2008-06-01', NULL, NULL, NULL, NULL, NULL, '9689999878', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '106', NULL, NULL),
(1184, '01783521000853', 0, 0, '2024-01-01', '0', '0', 'KARIMA KHATUN', NULL, 'MD KAMRUL ISLAM', NULL, 'RIMA BIBI', NULL, '2009-10-30', NULL, NULL, NULL, NULL, NULL, '9733423016', '', NULL, NULL, NULL, 'INDIAN', '5021010032197', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5', NULL, NULL),
(1185, '01783521001310', 0, 0, '2024-01-01', '0', '0', 'KHADIJA KHATUN', NULL, 'HABIBUR ALI', NULL, 'REKHA BIBI', NULL, '2009-04-08', NULL, NULL, NULL, NULL, NULL, '8972311692', '', NULL, NULL, NULL, 'INDIAN', '5021010033071', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '67', NULL, NULL),
(1186, '05312819000487', 0, 0, '2024-01-01', '0', '0', 'KONIKA GHOSH', NULL, 'KALACHAND GHOSH', NULL, 'BANDANA GHOSH', NULL, '2009-09-12', NULL, NULL, NULL, NULL, NULL, '8535846821', '', NULL, NULL, NULL, 'INDIAN', '5021020000532', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '28', NULL, NULL),
(1187, '05313519000175', 0, 0, '2024-01-01', '0', '0', 'KOYEL KHATUN', NULL, 'SAHARAB SK', NULL, 'MUSIA BIBI', NULL, '2009-11-12', NULL, NULL, NULL, NULL, NULL, '9002869582', '', NULL, NULL, NULL, 'INDIAN', '5575010021234', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '27', NULL, NULL),
(1188, '01783521001010', 0, 0, '2024-01-01', '0', '0', 'MAMUN', NULL, 'TALIMUDDIN', NULL, 'JORINA BIBI', NULL, '2008-07-05', NULL, NULL, NULL, NULL, NULL, '9732662036', '', NULL, NULL, NULL, 'INDIAN', '34670051277', 'SBIN0008006', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '105', NULL, NULL),
(1189, '01666321000465', 0, 0, '2024-01-01', '0', '0', 'MANOJ KUMAR MANDAL', NULL, 'AMIR CHAND MANDAL', NULL, 'TUSI MANDAL', NULL, '2008-01-06', NULL, NULL, NULL, NULL, NULL, '8016321328', '', NULL, NULL, NULL, 'INDIAN', '38667280624', 'SBIN0008855', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '61', NULL, NULL),
(1190, '01475519000284', 0, 0, '2024-01-01', '0', '0', 'MANOSI MONDAL', NULL, 'GOLAP MONDAL', NULL, 'UTTARA MONDAL', NULL, '2010-01-27', NULL, NULL, NULL, NULL, NULL, '7602656447', '', NULL, NULL, NULL, 'INDIAN', '5021020000684', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '46', NULL, NULL),
(1191, '01783521000852', 0, 0, '2024-01-01', '0', '0', 'MASIUR RAHAMAN', NULL, 'KAMRUJJAMAN', NULL, 'MASURA BIBI', NULL, '2009-07-04', NULL, NULL, NULL, NULL, NULL, '9932336157', '', NULL, NULL, NULL, 'INDIAN', '5021020001027', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', NULL, NULL),
(1192, '05311919000447', 0, 0, '2024-01-01', '0', '0', 'MD ABDUL HAMID', NULL, 'MD MAINUL ISLAM', NULL, 'NEBIJA BIBI', NULL, '2009-08-09', NULL, NULL, NULL, NULL, NULL, '7797981685', '', NULL, NULL, NULL, 'INDIAN', '5021030000417', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '56', NULL, NULL),
(1193, '01783521001954', 0, 0, '2024-01-01', '0', '0', 'MD AZIZUR RAHAMAN', NULL, 'MILAN SK', NULL, 'RINA BIBI', NULL, '2008-02-11', NULL, NULL, NULL, NULL, NULL, '9655566585', '', NULL, NULL, NULL, 'INDIAN', '37915824926', 'SBIN0008006', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '114', NULL, NULL),
(1194, '01783521001276', 0, 0, '2024-01-01', '0', '0', 'MD ERAK HOSSAIN', NULL, 'RAKIBAR RAHAMAN', NULL, 'ANJURA BIBI', NULL, '2009-05-03', NULL, NULL, NULL, NULL, NULL, '8017327356', '', NULL, NULL, NULL, 'INDIAN', '5021020000747', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '41', NULL, NULL),
(1195, '01783521001278', 0, 0, '2024-01-01', '0', '0', 'MD ERAN HOSSAIN', NULL, 'ROKIBAR RAHAMAN', NULL, 'ANJURA BIBI', NULL, '2009-05-03', NULL, NULL, NULL, NULL, NULL, '8017327356', '', NULL, NULL, NULL, 'INDIAN', '5021021371503', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '40', NULL, NULL),
(1196, '05311919000463', 0, 0, '2024-01-01', '0', '0', 'MD NABAB SK', NULL, 'MD MURSALIM SK', NULL, 'PAKHI BIBI', NULL, '2009-06-26', NULL, NULL, NULL, NULL, NULL, '9903450435', '', NULL, NULL, NULL, 'INDIAN', '5290276990', 'CBIN0280122', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '79', NULL, NULL),
(1197, '05311919000451', 0, 0, '2024-01-01', '0', '0', 'MD RAKIB SK', NULL, 'SELIM SK', NULL, 'RAKIBA BIBI', NULL, '2009-09-25', NULL, NULL, NULL, NULL, NULL, '6383679178', '', NULL, NULL, NULL, 'INDIAN', '5021030000530', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '76', NULL, NULL),
(1198, '05311919000468', 0, 0, '2024-01-01', '0', '0', 'MD SAHIN ALI', NULL, 'MD SERTAJ ALI', NULL, 'SAYEMA BIBI', NULL, '2009-09-28', NULL, NULL, NULL, NULL, NULL, '9593373117', '', NULL, NULL, NULL, 'INDIAN', '5249768665', 'CBIN0280122', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '77', NULL, NULL),
(1199, '05312719000108', 0, 0, '2024-01-01', '0', '0', 'MD SUIT SK', NULL, 'TASARUL ISLAM', NULL, 'REJINA BIBI', NULL, '2009-10-27', NULL, NULL, NULL, NULL, NULL, '8972395395', '', NULL, NULL, NULL, 'INDIAN', '35649871813', 'SBIN0008006', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '24', NULL, NULL),
(1200, '01783521002015', 0, 0, '2024-01-01', '0', '0', 'MEMSAN KHATUN', NULL, 'BELLAL HOSSAIN', NULL, 'NAJIMA BIBI', NULL, '2009-02-27', NULL, NULL, NULL, NULL, NULL, '9635118892', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '111', NULL, NULL),
(1201, '05313019000135', 0, 0, '2024-01-01', '0', '0', 'MILON SK', NULL, 'AINUL SK', NULL, 'LALMUN BIBI', NULL, '2009-07-12', NULL, NULL, NULL, NULL, NULL, '8538033540', '', NULL, NULL, NULL, 'INDIAN', '15322160287286', 'PUNB0153210', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '37', NULL, NULL),
(1202, '01783521001737', 0, 0, '2024-01-01', '0', '0', 'MIZANUR RAHAMAN', NULL, 'NAJRUL ISLAM', NULL, 'NAJEMA BIBI', NULL, '2009-03-06', NULL, NULL, NULL, NULL, NULL, '9647889589', '', NULL, NULL, NULL, 'INDIAN', '5021010044305', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '70', NULL, NULL),
(1203, '01783521001970', 0, 0, '2024-01-01', '0', '0', 'MOINA KHATUN', NULL, 'SELIM SK', NULL, 'RAKIBA BIBI', NULL, '2008-05-14', NULL, NULL, NULL, NULL, NULL, '9635874556', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '92', NULL, NULL),
(1204, '05311919000448', 0, 0, '2024-01-01', '0', '0', 'MST REHENA KHATUN', NULL, 'MOMIN SK', NULL, 'PRIYANKA BIBI', NULL, '2009-09-12', NULL, NULL, NULL, NULL, NULL, '9749162612', '', NULL, NULL, NULL, 'INDIAN', '5242206125', 'CBIN0280122', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '72', NULL, NULL),
(1205, '01783521000180', 0, 0, '2024-01-01', '0', '0', 'MUSKAN KHATUN', NULL, 'FAIJUL SK', NULL, 'ANJURA BIBI', NULL, '2009-08-28', NULL, NULL, NULL, NULL, NULL, '9635244703', '', NULL, NULL, NULL, 'INDIAN', '37127125117', 'SBIN0009463', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '69', NULL, NULL),
(1206, '05313119000138', 0, 0, '2024-01-01', '0', '0', 'NILA KHATUN', NULL, 'RAFIKUL ISLAM', NULL, 'HASNARA BIBI', NULL, '2009-06-12', NULL, NULL, NULL, NULL, NULL, '8597892379', '', NULL, NULL, NULL, 'INDIAN', '35918974734', 'SBIN0008006', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '82', NULL, NULL),
(1207, '01783521001722', 0, 0, '2024-01-01', '0', '0', 'NISHA YEASMIN', NULL, 'NASTAR HOSSAIN', NULL, 'SELINA BIBI', NULL, '2009-02-18', NULL, NULL, NULL, NULL, NULL, '9732364578', '', NULL, NULL, NULL, 'INDIAN', '5290247802', 'CBIN0280122', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '80', NULL, NULL),
(1208, '05313019000129', 0, 0, '2024-01-01', '0', '0', 'NURESHA KHATUN', NULL, 'NURAMIN', NULL, 'JHUMA BIBI', NULL, '2009-09-30', NULL, NULL, NULL, NULL, NULL, '8016518565', '', NULL, NULL, NULL, 'INDIAN', '5021020032036', 'UTBI0RRBBGB', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '21', NULL, NULL),
(1209, '01783521001312', 0, 0, '2024-01-01', '0', '0', 'PIYA KHATUN', NULL, 'SAFIKUL ISLAM', NULL, 'LAILY BIBI', NULL, '2009-10-29', NULL, NULL, NULL, NULL, NULL, '9749174975', '', NULL, NULL, NULL, 'INDIAN', '36128411193', 'SBIN0008006', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '65', NULL, NULL),
(1210, '01783521001275', 0, 0, '2024-01-01', '0', '0', 'PRIYANKA MANDAL', NULL, 'SUJIT MANDAL', NULL, 'FULKALI MANDAL', NULL, '2009-10-10', NULL, NULL, NULL, NULL, NULL, '9932367802', '', NULL, NULL, NULL, 'INDIAN', '5021010041195', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '14', NULL, NULL),
(1211, '01475519000244', 0, 0, '2024-01-01', '0', '0', 'PURNIMA KHATUN', NULL, 'MD SAIFUDDIN', NULL, 'REJINA BIBI', NULL, '2009-02-09', NULL, NULL, NULL, NULL, NULL, '9134640912', '', NULL, NULL, NULL, 'INDIAN', '5021030000455', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8', NULL, NULL),
(1212, '01783521001974', 0, 0, '2024-01-01', '0', '0', 'RAJJAK ALI', NULL, 'JAHANGIR ALI', NULL, 'MANSURA BIBI', NULL, '2007-08-04', NULL, NULL, NULL, NULL, NULL, '8293778098', '', NULL, NULL, NULL, 'INDIAN', '35926150309', 'SBIN0008855', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '102', NULL, NULL),
(1213, '01783521001978', 0, 0, '2024-01-01', '0', '0', 'RAKESH MONDAL', NULL, 'RAMESH MONDAL', NULL, 'KALPANA MONDAL', NULL, '2008-08-02', NULL, NULL, NULL, NULL, NULL, '7685955543', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '103', NULL, NULL),
(1214, '01783521001287', 0, 0, '2024-01-01', '0', '0', 'RAMIZ RAJA', NULL, 'NAJEDUL', NULL, 'NAIMA BIBI', NULL, '2008-07-23', NULL, NULL, NULL, NULL, NULL, '7074596035', '', NULL, NULL, NULL, 'INDIAN', '39494549776', 'SBIN0015048', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '42', NULL, NULL),
(1215, '05312819000492', 0, 0, '2024-01-01', '0', '0', 'RANI KHATUN', NULL, 'SORIF SK', NULL, 'MONIRA BIBI', NULL, '2009-08-27', NULL, NULL, NULL, NULL, NULL, '9002507416', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '60', NULL, NULL),
(1216, '01783521001700', 0, 0, '2024-01-01', '0', '0', 'REJUAN SK', NULL, 'SELIM SK', NULL, 'ROHIMA BIBI', NULL, '2008-05-12', NULL, NULL, NULL, NULL, NULL, '9635435393', '', NULL, NULL, NULL, 'INDIAN', '5575010025018', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '86', NULL, NULL),
(1217, '01783521001774', 0, 0, '2024-01-01', '0', '0', 'RINKU SK', NULL, 'SAMSUL HOQUE', NULL, 'SABINA BIBI', NULL, '2008-11-19', NULL, NULL, NULL, NULL, NULL, '9965565566', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '100', NULL, NULL),
(1218, '01783521001005', 0, 0, '2024-01-01', '0', '0', 'ROHIDUL ISLAM', NULL, 'NEKSAD ALI', NULL, 'MILUARA BIBI', NULL, '2008-07-08', NULL, NULL, NULL, NULL, NULL, '7074626720', '', NULL, NULL, NULL, 'INDIAN', '5021010030834', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '95', NULL, NULL),
(1219, '01783521001043', 0, 0, '2024-01-01', '0', '0', 'ROHIT SK', NULL, 'MAIDUL ISLAM', NULL, 'ROHIMA BIBI', NULL, '2008-11-18', NULL, NULL, NULL, NULL, NULL, '9088869846', '', NULL, NULL, NULL, 'INDIAN', '38858934705', 'SBIN0015048', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '108', NULL, NULL),
(1220, '01475019000157', 0, 0, '2024-01-01', '0', '0', 'ROJA KHATUN', NULL, 'MD JAKARIYA ALI', NULL, 'SHAMPA BIBI', NULL, '2007-10-07', NULL, NULL, NULL, NULL, NULL, '7029062124', '', NULL, NULL, NULL, 'INDIAN', '5575010040576', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '62', NULL, NULL),
(1221, '05313519000169', 0, 0, '2024-01-01', '0', '0', 'ROMIO SK', NULL, 'MASUD SK', NULL, 'RAKIBA BIBI', NULL, '2009-08-25', NULL, NULL, NULL, NULL, NULL, '7449730945', '', NULL, NULL, NULL, 'INDIAN', '5575010021456', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '26', NULL, NULL),
(1222, '09326921000183', 0, 0, '2024-01-01', '0', '0', 'RUBAIYATH E HAFIZ', NULL, 'RAFIK JUMEDIN', NULL, 'DALIYA BIBI', NULL, '2009-05-02', NULL, NULL, NULL, NULL, NULL, '7872927299', '', NULL, NULL, NULL, 'INDIAN', '41524841921', 'SBIN0008006', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '121', NULL, NULL),
(1223, '01783521000905', 0, 0, '2024-01-01', '0', '0', 'RUPA KHATUN', NULL, 'RABKUL SK', NULL, 'NASIMA BIBI', NULL, '2009-03-29', NULL, NULL, NULL, NULL, NULL, '8509162299', '', NULL, NULL, NULL, 'INDIAN', '5021020000376', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '53', NULL, NULL),
(1224, '01783521001158', 0, 0, '2024-01-01', '0', '0', 'SABIR ALI', NULL, 'ERFAN ALI', NULL, 'SABINA BIBI', NULL, '2009-11-15', NULL, NULL, NULL, NULL, NULL, '7584087993', '', NULL, NULL, NULL, 'INDIAN', '5021020000476', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '81', NULL, NULL),
(1225, '01783521000900', 0, 0, '2024-01-01', '0', '0', 'SADIYA KHATUN', NULL, 'KARIM SK', NULL, 'SAKHINA BIBI', NULL, '2009-11-16', NULL, NULL, NULL, NULL, NULL, '8343809806', '', NULL, NULL, NULL, 'INDIAN', '35165593796', 'SBIN0008006', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '50', NULL, NULL),
(1226, '01783521001980', 0, 0, '2024-01-01', '0', '0', 'SAFIKUL ISLAM', NULL, 'HAJIKUL ISLAM', NULL, 'ANGURA BIBI', NULL, '2008-01-30', NULL, NULL, NULL, NULL, NULL, '9896655752', '', NULL, NULL, NULL, 'INDIAN', '1532101700041926', 'PUNB0153210', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '94', NULL, NULL),
(1227, '01783521001159', 0, 0, '2024-01-01', '0', '0', 'SAFIKUL ISLAM', NULL, 'PANCHU SK', NULL, 'NABIJA BIBI', NULL, '2009-12-16', NULL, NULL, NULL, NULL, NULL, '8101168822', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '83', NULL, NULL),
(1228, '05312719000096', 0, 0, '2024-01-01', '0', '0', 'SAHANAJ PARVIN', NULL, 'ESMAIL SK', NULL, 'SAMINA BIBI', NULL, '2009-08-16', NULL, NULL, NULL, NULL, NULL, '9093140216', '', NULL, NULL, NULL, 'INDIAN', '5021010031930', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '23', NULL, NULL),
(1229, '01783521001984', 0, 0, '2024-01-01', '0', '0', 'SAHINA PARVIN', NULL, 'HASIBUL ISLAM', NULL, 'DILRUBA BIBI', NULL, '2007-07-13', NULL, NULL, NULL, NULL, NULL, '9330696002', '', NULL, NULL, NULL, 'INDIAN', '38255070179', 'SBIN0008006', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '93', NULL, NULL),
(1230, '01783521001983', 0, 0, '2024-01-01', '0', '0', 'SAIHAN SK', NULL, 'FAJLUR RAHAMAN', NULL, 'RAKIBA BIBI', NULL, '2008-05-30', NULL, NULL, NULL, NULL, NULL, '8016608333', '', NULL, NULL, NULL, 'INDIAN', '5021020000629', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '88', NULL, NULL);
INSERT INTO `studentdbs` (`id`, `studentid`, `admBookNo`, `admSlNo`, `admDate`, `prCls`, `prSch`, `name`, `adhaar`, `fname`, `fadhaar`, `mname`, `madhaar`, `dob`, `vill`, `post`, `pstn`, `dist`, `pin`, `mobl`, `ssex`, `phch`, `relg`, `cste`, `natn`, `accNo`, `ifsc`, `micr`, `bnnm`, `brnm`, `stclass_id`, `stsection_id`, `session_id`, `school_id`, `streason`, `enclass_id`, `ensection_id`, `ensession_id`, `enreason`, `crstatus`, `remarks`, `created_at`, `updated_at`) VALUES
(1231, '05312719000102', 0, 0, '2024-01-01', '0', '0', 'SAIRA BANU', NULL, 'SAROWAR HOSSAIN', NULL, 'DILRUBA BIBI', NULL, '2009-02-16', NULL, NULL, NULL, NULL, NULL, '9800122148', '', NULL, NULL, NULL, 'INDIAN', '5021010031329', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '18', NULL, NULL),
(1232, '01783521001292', 0, 0, '2024-01-01', '0', '0', 'SAIRIN KHATUN', NULL, 'NILTAN ALI', NULL, 'MARUFA BIBI', NULL, '2009-03-22', NULL, NULL, NULL, NULL, NULL, '9163830400', '', NULL, NULL, NULL, 'INDIAN', '5021010030898', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6', NULL, NULL),
(1233, '01783521000906', 0, 0, '2024-01-01', '0', '0', 'SAKHINA KHATUN', NULL, 'ESARUL SK', NULL, 'RAKHA BIBI', NULL, '2009-04-24', NULL, NULL, NULL, NULL, NULL, '7407302105', '', NULL, NULL, NULL, 'INDIAN', '15322160241361', 'PUNB0153210', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '33', NULL, NULL),
(1234, '01783521001772', 0, 0, '2024-01-01', '0', '0', 'SAKIB HASAN', NULL, 'TAHASEN ALI', NULL, 'MAYNA BIBI', NULL, '2007-09-17', NULL, NULL, NULL, NULL, NULL, '9635710941', '', NULL, NULL, NULL, 'INDIAN', '36128411692', 'SBIN0008006', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '107', NULL, NULL),
(1235, '01783521001191', 0, 0, '2024-01-01', '0', '0', 'SAKILA KHATUN', NULL, 'NIUTAN SEKH', NULL, 'REKHA BIBI', NULL, '2009-02-24', NULL, NULL, NULL, NULL, NULL, '9143171362', '', NULL, NULL, NULL, 'INDIAN', '1532101700007421', 'PUNB0015320', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '9', NULL, NULL),
(1236, '01783521001291', 0, 0, '2024-01-01', '0', '0', 'SAMIM SK', NULL, 'SARIFUL ISLAM', NULL, 'FAYEMA BIBI.', NULL, '2009-02-04', NULL, NULL, NULL, NULL, NULL, '7548048196', '', NULL, NULL, NULL, 'INDIAN', '5021020000573', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '49', NULL, NULL),
(1237, '01783521001773', 0, 0, '2024-01-01', '0', '0', 'SAMIM SK', NULL, 'RAJAB ALI', NULL, 'CHAMPA BIBI', NULL, '2008-10-26', NULL, NULL, NULL, NULL, NULL, '8945078556', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '99', NULL, NULL),
(1238, '01783521000197', 0, 0, '2024-01-01', '0', '0', 'SAMIM SK', NULL, 'MAYJUL', NULL, 'SIMA BIBI', NULL, '2008-10-28', NULL, NULL, NULL, NULL, NULL, '9933805081', '', NULL, NULL, NULL, 'INDIAN', '0977010298285', 'PUNB0097720', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '115', NULL, NULL),
(1239, '01783521001982', 0, 0, '2024-01-01', '0', '0', 'SANIA KHATUN', NULL, 'SAMSUL SK', NULL, 'SIMA BIBI', NULL, '2008-12-13', NULL, NULL, NULL, NULL, NULL, '7635987644', '', NULL, NULL, NULL, 'INDIAN', '35866955729', 'SBIN0008006', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '96', NULL, NULL),
(1240, '01783521001284', 0, 0, '2024-01-01', '0', '0', 'SANJIT MONDAL', NULL, 'DIPU MONDAL', NULL, 'DIPALI MONDAL', NULL, '2009-01-14', NULL, NULL, NULL, NULL, NULL, '9635875654', '', NULL, NULL, NULL, 'INDIAN', '37685448143', 'SBIN0008006', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '31', NULL, NULL),
(1241, '01783521001189', 0, 0, '2024-01-01', '0', '0', 'SARABAN TOHORA', NULL, 'KURBAN SK', NULL, 'MEHENNGAR BIBI', NULL, '2009-08-20', NULL, NULL, NULL, NULL, NULL, '7865987732', '', NULL, NULL, NULL, 'INDIAN', '5021010033673', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '85', NULL, NULL),
(1242, '01783521001293', 0, 0, '2024-01-01', '0', '0', 'SARMINA KHATUN', NULL, 'NILTAN ALI', NULL, 'MARUFA BIBI', NULL, '2009-03-22', NULL, NULL, NULL, NULL, NULL, '9163830400', '', NULL, NULL, NULL, 'INDIAN', '5021010030889', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '7', NULL, NULL),
(1243, '01783521001277', 0, 0, '2024-01-01', '0', '0', 'SAYEMA KHATUN', NULL, 'ATABUR SK', NULL, 'SARJINA BIBI', NULL, '2007-06-18', NULL, NULL, NULL, NULL, NULL, '6296425580', '', NULL, NULL, NULL, 'INDIAN', '1532101700042305', 'PUNB0153210', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '52', NULL, NULL),
(1244, '01783521001201', 0, 0, '2024-01-01', '0', '0', 'SAYENA KHATUN', NULL, 'BADIUJJAMAN', NULL, 'SAYERA BIBI', NULL, '2009-08-18', NULL, NULL, NULL, NULL, NULL, '8967475412', '', NULL, NULL, NULL, 'INDIAN', '5021010031082', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '15', NULL, NULL),
(1245, '01783521001977', 0, 0, '2024-01-01', '0', '0', 'SOHELRANA', NULL, 'TARIKUL ISLAM', NULL, 'SIRINA BIBI', NULL, '2008-06-25', NULL, NULL, NULL, NULL, NULL, '9686588955', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '97', NULL, NULL),
(1246, '05313219000207', 0, 0, '2024-01-01', '0', '0', 'SONIA KHATUN', NULL, 'SALAM SK', NULL, 'LAILA BIBI', NULL, '2009-11-27', NULL, NULL, NULL, NULL, NULL, '7872134119', '', NULL, NULL, NULL, 'INDIAN', '5351473320', 'CBIN0280122', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '17', NULL, NULL),
(1247, '01783521001274', 0, 0, '2024-01-01', '0', '0', 'SUJAN MANDAL', NULL, 'SANJAY MONDAL', NULL, 'SHIKHA MONDAL', NULL, '2009-04-06', NULL, NULL, NULL, NULL, NULL, '9134725721', '', NULL, NULL, NULL, 'INDIAN', '20476988055', 'SBIN0015048', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '45', NULL, NULL),
(1248, '01783521000196', 0, 0, '2024-01-01', '0', '0', 'SUKURUDDIN', NULL, 'PIARUL ISLAM', NULL, 'MAMATAJ BIBI', NULL, '2008-10-17', NULL, NULL, NULL, NULL, NULL, '8967061801', '', NULL, NULL, NULL, 'INDIAN', '5021010034812', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '87', NULL, NULL),
(1249, '01783521001311', 0, 0, '2024-01-01', '0', '0', 'SUMAIYA AZMI', NULL, 'MD MAINUDDIN', NULL, 'JARINA BIBI', NULL, '2010-01-17', NULL, NULL, NULL, NULL, NULL, '7384271546', '', NULL, NULL, NULL, 'INDIAN', '0977010307680', 'PUNB0097720', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '64', NULL, NULL),
(1250, '01783521000796', 0, 0, '2024-01-01', '0', '0', 'SUNDORI KHATUN', NULL, 'JAHANGIR ..', NULL, 'ROJINA BIBI', NULL, '2008-04-20', NULL, NULL, NULL, NULL, NULL, '9547705911', '', NULL, NULL, NULL, 'INDIAN', '38608843128', 'SBIN0008006', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91', NULL, NULL),
(1251, '01783521001957', 0, 0, '2024-01-01', '0', '0', 'SUNIA KHATUN', NULL, 'ENADUL HOQUE', NULL, 'FULI BIBI', NULL, '2008-07-30', NULL, NULL, NULL, NULL, NULL, '9635875545', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '104', NULL, NULL),
(1252, '01783521001735', 0, 0, '2024-01-01', '0', '0', 'SURAIY MANDAL', NULL, 'BISWANATH MONDAL', NULL, 'BINA MANDAL', NULL, '2009-10-21', NULL, NULL, NULL, NULL, NULL, '8653325654', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '71', NULL, NULL),
(1253, '01783521000198', 0, 0, '2024-01-01', '0', '0', 'SURAJ SK', NULL, 'FATIK SK', NULL, 'RAHIMA BIBI', NULL, '2008-08-17', NULL, NULL, NULL, NULL, NULL, '9851932075', '', NULL, NULL, NULL, 'INDIAN', '35951945384', 'SBIN0008855', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '113', NULL, NULL),
(1254, '01783521000847', 0, 0, '2024-01-01', '0', '0', 'SURAJ SK', NULL, 'RENTU SK', NULL, 'MORGINA BIBI', NULL, '2009-09-15', NULL, NULL, NULL, NULL, NULL, '7586073785', '', NULL, NULL, NULL, 'INDIAN', '15322160241361', 'PUNB0153210', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '34', NULL, NULL),
(1255, '01783521000891', 0, 0, '2024-01-01', '0', '0', 'SURMILA KHATUN', NULL, 'SARIFUL ISLAM', NULL, 'LUTFUN NESHA BIIB', NULL, '2009-09-18', NULL, NULL, NULL, NULL, NULL, '7365021498', '', NULL, NULL, NULL, 'INDIAN', '1532101700043094', 'PUNB0153210', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '22', NULL, NULL),
(1256, '01783521001296', 0, 0, '2024-01-01', '0', '0', 'SWASTIKA GHOSH', NULL, 'TARUN GHOSH', NULL, 'BISHAKA GHOSH', NULL, '2010-01-01', NULL, NULL, NULL, NULL, NULL, '7029128589', '', NULL, NULL, NULL, 'INDIAN', '5021030001272', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '47', NULL, NULL),
(1257, '01783521001289', 0, 0, '2024-01-01', '0', '0', 'SWEET', NULL, 'SAHIN ALI', NULL, 'SABINA BIBI', NULL, '2010-03-18', NULL, NULL, NULL, NULL, NULL, '6297193146', '', NULL, NULL, NULL, 'INDIAN', '5575010050689', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '48', NULL, NULL),
(1258, '01783521001313', 0, 0, '2024-01-01', '0', '0', 'SWEET ALI', NULL, 'KAMAL HOSSAIN', NULL, 'SAMSAD BEGUM', NULL, '2009-01-18', NULL, NULL, NULL, NULL, NULL, '8509805845', '', NULL, NULL, NULL, 'INDIAN', '5021030000102', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '66', NULL, NULL),
(1259, '01783521000843', 0, 0, '2024-01-01', '0', '0', 'TAJMIRA KHATUN', NULL, 'ABUL KALAM', NULL, 'MAMTAJ BIBI', NULL, '2008-07-06', NULL, NULL, NULL, NULL, NULL, '9890449734', '', NULL, NULL, NULL, 'INDIAN', '36178518784', 'SBIN0008006', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '90', NULL, NULL),
(1260, '05312919000111', 0, 0, '2024-01-01', '0', '0', 'TANIA KHATUN', NULL, 'ARMAN ALI', NULL, 'MST KAJALA BIBI', NULL, '2009-08-24', NULL, NULL, NULL, NULL, NULL, '9987520080', '', NULL, NULL, NULL, 'INDIAN', '5021010032823', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '55', NULL, NULL),
(1261, '01783521000333', 0, 0, '2024-01-01', '0', '0', 'TUHIDA KHATUN', NULL, 'MD MILTON SK', NULL, 'SHILPI BIBI', NULL, '2009-11-08', NULL, NULL, NULL, NULL, NULL, '8538802980', '', NULL, NULL, NULL, 'INDIAN', '5021030000413', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL),
(1262, '01783521001160', 0, 0, '2024-01-01', '0', '0', 'YEAMIN SK', NULL, 'DILUAR HOSSAIN', NULL, 'RIMA BIBI', NULL, '2009-10-20', NULL, NULL, NULL, NULL, NULL, '9883435840', '', NULL, NULL, NULL, 'INDIAN', '5021030000422', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '84', NULL, NULL),
(1263, '01783521001213', 0, 0, '2024-01-01', '0', '0', 'AKTAR SK', NULL, 'RABIUL SK', NULL, 'MILOA BIBI', NULL, '2009-11-25', NULL, NULL, NULL, NULL, NULL, '7074538136', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 5, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '60', NULL, NULL),
(1264, '01475619000100', 0, 0, '2024-01-01', '0', '0', 'ALIMA KHATUN', NULL, 'ALAMGIR HOSSAIN', NULL, 'RAHIMA KHATUN', NULL, '2010-12-06', NULL, NULL, NULL, NULL, NULL, '9091975811', '', NULL, NULL, NULL, 'INDIAN', '5021010032647', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '37', NULL, NULL),
(1265, '01783521001203', 0, 0, '2024-01-01', '0', '0', 'ARYAN ANSARI', NULL, 'LITON', NULL, 'AYSHA BIBI', NULL, '2010-01-06', NULL, NULL, NULL, NULL, NULL, '9091584076', '', NULL, NULL, NULL, 'INDIAN', '5021010004088', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '53', NULL, NULL),
(1266, '01783521000334', 0, 0, '2024-01-01', '0', '0', 'ASHIF SK', NULL, 'RAFIKUL SK', NULL, 'RESHMA BIBI', NULL, '2010-10-23', NULL, NULL, NULL, NULL, NULL, '8101403474', '', NULL, NULL, NULL, 'INDIAN', '36196849340', 'SBIN0008006', NULL, NULL, NULL, 5, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '78', NULL, NULL),
(1267, '01783521001345', 0, 0, '2024-01-01', '0', '0', 'ASMINA KHATUN', NULL, 'NAJIBUR HOSSAIN', NULL, 'JUBEDA BIBI', NULL, '2009-09-25', NULL, NULL, NULL, NULL, NULL, '9732611182', '', NULL, NULL, NULL, 'INDIAN', '1314010184533', 'PUNB0131420', NULL, NULL, NULL, 5, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '10', NULL, NULL),
(1268, '01783521000211', 0, 0, '2024-01-01', '0', '0', 'BARSHA KHATUN', NULL, 'SELIM SK', NULL, 'MAHABUBA BIBI', NULL, '2008-08-27', NULL, NULL, NULL, NULL, NULL, '9635213327', '', NULL, NULL, NULL, 'INDIAN', '5303824510', 'CBIN0280122', NULL, NULL, NULL, 5, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '84', NULL, NULL),
(1269, '01783521001212', 0, 0, '2024-01-01', '0', '0', 'BILKISH KHATUN', NULL, 'RAFIKUL ISLAM', NULL, 'MOINA BIBI', NULL, '2009-09-22', NULL, NULL, NULL, NULL, NULL, '8001166860', '', NULL, NULL, NULL, 'INDIAN', '5021030000428', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '59', NULL, NULL),
(1270, '01783522002062', 0, 0, '2024-01-01', '0', '0', 'BISHAL SARKAR', NULL, 'RATAN SARKAR', NULL, 'SUMITRA SARKAR', NULL, '2007-03-28', NULL, NULL, NULL, NULL, NULL, '7483549764', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 5, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '69', NULL, NULL),
(1271, '01783521000210', 0, 0, '2024-01-01', '0', '0', 'BRISTI KHATUN', NULL, 'SELIM SK', NULL, 'MAHABUBA BIBI', NULL, '2008-08-27', NULL, NULL, NULL, NULL, NULL, '9635213327', '', NULL, NULL, NULL, 'INDIAN', '5303825014', 'CBIN0280122', NULL, NULL, NULL, 5, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '68', NULL, NULL),
(1272, '01783521001273', 0, 0, '2024-01-01', '0', '0', 'CHAND MAHAMMOD', NULL, 'CHANDRUL ISLAM', NULL, 'RAKIBA BIBI', NULL, '2009-02-19', NULL, NULL, NULL, NULL, NULL, '8670939642', '', NULL, NULL, NULL, 'INDIAN', '5575010042307', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '19', NULL, NULL),
(1273, '01783521001295', 0, 0, '2024-01-01', '0', '0', 'CHANDNI KHATUN', NULL, 'ANSAR ALI', NULL, 'SUFIA BIBI.', NULL, '2009-12-12', NULL, NULL, NULL, NULL, NULL, '9903267292', '', NULL, NULL, NULL, 'INDIAN', '5021020000370', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '27', NULL, NULL),
(1274, '05313219000240', 0, 0, '2024-01-01', '0', '0', 'CHUMKI KHATUN', NULL, 'MUSREF SK', NULL, 'CHANUYRA', NULL, '2009-08-31', NULL, NULL, NULL, NULL, NULL, '7047158820', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 5, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6', NULL, NULL),
(1275, '05362119000004', 0, 0, '2024-01-01', '0', '0', 'DIPJALI SARKAR', NULL, 'SWAPAN SARKAR', NULL, 'BASANTI SARKAR', NULL, '2008-08-23', NULL, NULL, NULL, NULL, NULL, '7872471578', '', NULL, NULL, NULL, 'INDIAN', '5246165739', 'CBIN0280122', NULL, NULL, NULL, 5, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '39', NULL, NULL),
(1276, '01475619000105', 0, 0, '2024-01-01', '0', '0', 'EBRAHIM SK', NULL, 'NAJIMUDDIN', NULL, 'ROHIMA BIBI', NULL, '2009-11-13', NULL, NULL, NULL, NULL, NULL, '8944962598', '', NULL, NULL, NULL, 'INDIAN', '5021010033284', 'UTBI0RRBBGB', NULL, NULL, NULL, 5, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '15', NULL, NULL),
(1277, '01783523000002', 0, 0, '2024-01-01', '0', '0', 'EZAZUL HOQUE.', NULL, 'KOYESH SK', NULL, 'MINUARA BIBI', NULL, '2007-11-01', NULL, NULL, NULL, NULL, NULL, '8972514072', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 5, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '92', NULL, NULL),
(1278, '01475619000114', 0, 0, '2024-01-01', '0', '0', 'HALIMA KHATUN', NULL, 'SALAM SK', NULL, 'TOSLEMA BIBI', NULL, '2009-05-25', NULL, NULL, NULL, NULL, NULL, '8972709955', '', NULL, NULL, NULL, 'INDIAN', '5021010032939', 'UTBI0RRBBGB', NULL, NULL, NULL, 5, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '22', NULL, NULL),
(1279, '01783521000329', 0, 0, '2024-01-01', '0', '0', 'HALIMA KHATUN', NULL, 'DILBAR SK', NULL, 'JYOSTNA BIBI', NULL, '2010-03-05', NULL, NULL, NULL, NULL, NULL, '7547914522', '', NULL, NULL, NULL, 'INDIAN', '5021030000131', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '41', NULL, NULL),
(1280, '01783521001281', 0, 0, '2024-01-01', '0', '0', 'HALIMA KHATUN', NULL, 'ALIM SK', NULL, 'FATEMA BIBI', NULL, '2009-12-22', NULL, NULL, NULL, NULL, NULL, '7206761284', '', NULL, NULL, NULL, 'INDIAN', '35574577304', 'SBIN0008006', NULL, NULL, NULL, 5, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '25', NULL, NULL),
(1281, '05312919000098', 0, 0, '2024-01-01', '0', '0', 'HAPIJA KHATUN', NULL, 'HANIF SK', NULL, 'SERINA BIBI', NULL, '2009-11-20', NULL, NULL, NULL, NULL, NULL, '8250953469', '', NULL, NULL, NULL, 'INDIAN', '15322160235236', 'PUNB0153210', NULL, NULL, NULL, 5, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '80', NULL, NULL),
(1282, '01783521000208', 0, 0, '2024-01-01', '0', '0', 'HAZERA KHATUN', NULL, 'ISMAIL HOQUE', NULL, 'SUKTARA BIBI', NULL, '2008-10-07', NULL, NULL, NULL, NULL, NULL, '8343044864', '', NULL, NULL, NULL, 'INDIAN', '38619799736', 'SBIN0008006', NULL, NULL, NULL, 5, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '58', NULL, NULL),
(1283, '05313219000217', 0, 0, '2024-01-01', '0', '0', 'ILIAS ALI', NULL, 'ISMAIL SK', NULL, 'HABIBA BIBI', NULL, '2009-07-06', NULL, NULL, NULL, NULL, NULL, '9002868145', '', NULL, NULL, NULL, 'INDIAN', '5021020000844', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '13', NULL, NULL),
(1284, '05312919000110', 0, 0, '2024-01-01', '0', '0', 'JANNATUN KHATUN', NULL, 'HALIM SK', NULL, 'JORINA BIBI', NULL, '2009-09-10', NULL, NULL, NULL, NULL, NULL, '8016793196', '', NULL, NULL, NULL, 'INDIAN', '5021010032018', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL),
(1285, '01783521001725', 0, 0, '2024-01-01', '0', '0', 'JIBAN SK', NULL, 'MURSELIM', NULL, 'TOTAN BIBI', NULL, '2008-12-10', NULL, NULL, NULL, NULL, NULL, '9635700028', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 5, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '73', NULL, NULL),
(1286, '05313219000235', 0, 0, '2024-01-01', '0', '0', 'JUEL SK', NULL, 'HAZRAT ALI', NULL, 'SEHENA BIBI', NULL, '2009-10-06', NULL, NULL, NULL, NULL, NULL, '7407700141', '', NULL, NULL, NULL, 'INDIAN', '5289154524', 'CBIN0280122', NULL, NULL, NULL, 5, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '61', NULL, NULL),
(1287, '05311919000460', 0, 0, '2024-01-01', '0', '0', 'JUMANA KHATUN', NULL, 'MD HAJEKUL ISLAM', NULL, 'KHADIZA BIBI', NULL, '2009-03-22', NULL, NULL, NULL, NULL, NULL, '8768687488', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 5, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '74', NULL, NULL),
(1288, '01783521000212', 0, 0, '2024-01-01', '0', '0', 'KABITA MONDAL', NULL, 'ANANDA MANDAL', NULL, 'HANSIRANI MONDAL', NULL, '2008-10-27', NULL, NULL, NULL, NULL, NULL, '7602172753', '', NULL, NULL, NULL, 'INDIAN', '38608487265', 'SBIN0008006', NULL, NULL, NULL, 5, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '55', NULL, NULL),
(1289, '01783521000851', 0, 0, '2024-01-01', '0', '0', 'KHADIJA KHATUN', NULL, 'AMIRUL ISLAM', NULL, 'MUKTI BIBI', NULL, '2009-06-01', NULL, NULL, NULL, NULL, NULL, '7031815043', '', NULL, NULL, NULL, 'INDIAN', '5021019900174', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '23', NULL, NULL),
(1290, '01783521000890', 0, 0, '2024-01-01', '0', '0', 'MAHATAB SK', NULL, 'SAHAJAMAL SK', NULL, 'MAINA BIBI.', NULL, '2009-06-22', NULL, NULL, NULL, NULL, NULL, '9091325674', '', NULL, NULL, NULL, 'INDIAN', '5021020001064', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '17', NULL, NULL),
(1291, '01475519000247', 0, 0, '2024-01-01', '0', '0', 'MAMONI KHATUN', NULL, 'SABIYAR RAHAMAN', NULL, 'AMENA BIBI', NULL, '2009-08-22', NULL, NULL, NULL, NULL, NULL, '9091597078', '', NULL, NULL, NULL, 'INDIAN', '5021020000965', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '21', NULL, NULL),
(1292, '05311919000454', 0, 0, '2024-01-01', '0', '0', 'MARIAM KHATUN', NULL, 'RAFIKUL ISLAM', NULL, 'FARIDA BIBI', NULL, '2009-05-04', NULL, NULL, NULL, NULL, NULL, '9647673407', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 5, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '9', NULL, NULL),
(1293, '05311919000466', 0, 0, '2024-01-01', '0', '0', 'MD ANWAR SEIKH', NULL, 'MD MUSTOFA', NULL, 'MST RAHELA BIBI', NULL, '2009-04-15', NULL, NULL, NULL, NULL, NULL, '9734398027', '', NULL, NULL, NULL, 'INDIAN', '3869582477', 'CBIN0280122', NULL, NULL, NULL, 5, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8', NULL, NULL),
(1294, '01783521001197', 0, 0, '2024-01-01', '0', '0', 'MD ASHIF SEIKH', NULL, 'MD ABDUL HANIF', NULL, 'ALIARA KHATUN', NULL, '2009-11-11', NULL, NULL, NULL, NULL, NULL, '9547047072', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 5, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '48', NULL, NULL),
(1295, '01783521001786', 0, 0, '2024-01-01', '0', '0', 'MD GOLAM HOSSAIN', NULL, 'MD KHODA BOX', NULL, 'KHADIJA BIBI', NULL, '2008-01-23', NULL, NULL, NULL, NULL, NULL, '7865020513', '', NULL, NULL, NULL, 'INDIAN', '36104069822', 'SBIN0008006', NULL, NULL, NULL, 5, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91', NULL, NULL),
(1296, '01783521001204', 0, 0, '2024-01-01', '0', '0', 'MD HASANUJJAMAN', NULL, 'MANUAR HOSSAIN', NULL, 'REJINA BIBI', NULL, '2009-09-02', NULL, NULL, NULL, NULL, NULL, '7602080514', '', NULL, NULL, NULL, 'INDIAN', '5021030000827', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '54', NULL, NULL),
(1297, '01783521001195', 0, 0, '2024-01-01', '0', '0', 'MD IBRAHIM ALI', NULL, 'AZIMUDDIN', NULL, 'MST. ANUARA KHATUN', NULL, '2009-08-13', NULL, NULL, NULL, NULL, NULL, '7890985322', '', NULL, NULL, NULL, 'INDIAN', '32997137284', 'SBIN0008006', NULL, NULL, NULL, 5, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '45', NULL, NULL),
(1298, '01783523000014', 0, 0, '2024-01-01', '0', '0', 'MD JILHAZ', NULL, 'MD NIYAJUL HAQUE', NULL, 'MABIA KHATUN', NULL, '2009-12-09', NULL, NULL, NULL, NULL, NULL, '8345912391', '', NULL, NULL, NULL, 'INDIAN', '5021010031888', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '36', NULL, NULL),
(1299, '01783521001787', 0, 0, '2024-01-01', '0', '0', 'MD MEHEDI HASAN', NULL, 'MD NURAMIN', NULL, 'NURBANU BIBI', NULL, '2008-12-03', NULL, NULL, NULL, NULL, NULL, '9635445529', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 5, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '51', NULL, NULL),
(1300, '07966819000036', 0, 0, '2024-01-01', '0', '0', 'MD MEHEFUJ ALOM', NULL, 'MOSARAF HOSSAIN', NULL, 'SADIKA BIBI', NULL, '2008-10-14', NULL, NULL, NULL, NULL, NULL, '9876665554', '', NULL, NULL, NULL, 'INDIAN', '15322160285017', 'PUNB0153210', NULL, NULL, NULL, 5, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '89', NULL, NULL),
(1301, '01783521001346', 0, 0, '2024-01-01', '0', '0', 'MD MOMIN SK', NULL, 'MASADUL ISLAM', NULL, 'CHAN BANU BIBI', NULL, '2009-02-10', NULL, NULL, NULL, NULL, NULL, '9732930850', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 5, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '11', NULL, NULL),
(1302, '07858419000022', 0, 0, '2024-01-01', '0', '0', 'MD.MUTAALI HOSSAIN', NULL, 'MONIRUJJAMAN', NULL, 'TARJINA BIBI', NULL, '2008-10-24', NULL, NULL, NULL, NULL, NULL, '7074874598', '', NULL, NULL, NULL, 'INDIAN', '35977427012', 'SBIN0008006', NULL, NULL, NULL, 5, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '52', NULL, NULL),
(1303, '01783521001192', 0, 0, '2024-01-01', '0', '0', 'MD RAJIB SK', NULL, 'RAFIKUL ISLAM', NULL, 'BEDANA BIBI', NULL, '2010-08-31', NULL, NULL, NULL, NULL, NULL, '9932068623', '', NULL, NULL, NULL, 'INDIAN', '5021030000733', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '42', NULL, NULL),
(1304, '01475519000262', 0, 0, '2024-01-01', '0', '0', 'MD RANA SK', NULL, 'MD REJAUL KARIM', NULL, 'ROJINA BIBI', NULL, '2009-04-25', NULL, NULL, NULL, NULL, NULL, '8509794165', '', NULL, NULL, NULL, 'INDIAN', '5021010031648', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '75', NULL, NULL),
(1305, '05313219000224', 0, 0, '2024-01-01', '0', '0', 'MD SURAJ SK', NULL, 'MD SUJAUDDIN', NULL, 'TUMPA BIBI', NULL, '2009-03-02', NULL, NULL, NULL, NULL, NULL, '8116509276', '', NULL, NULL, NULL, 'INDIAN', '5021010033901', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '57', NULL, NULL),
(1306, '05312719000110', 0, 0, '2024-01-01', '0', '0', 'MEHER SK', NULL, 'GOLAM MURTUJA', NULL, 'AFRUJA BIBI', NULL, '2009-09-14', NULL, NULL, NULL, NULL, NULL, '9134625534', '', NULL, NULL, NULL, 'INDIAN', '5021010031899', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '71', NULL, NULL),
(1307, '06989122000282', 0, 0, '2024-01-01', '0', '0', 'MIJAN BISWAS', NULL, 'ANARUL BISWAS', NULL, 'SHEFALI BIBI', NULL, '2005-08-18', NULL, NULL, NULL, NULL, NULL, '9734245623', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 5, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '88', NULL, NULL),
(1308, '05375121000028', 0, 0, '2024-01-01', '0', '0', 'MILAN SK', NULL, 'SARIFUL ISLAM', NULL, 'JINARA BIBI', NULL, '2008-07-08', NULL, NULL, NULL, NULL, NULL, '8101724561', '', NULL, NULL, NULL, 'INDIAN', '36088216229', 'SBIN0008006', NULL, NULL, NULL, 5, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '38', NULL, NULL),
(1309, '05374721000033', 0, 0, '2024-01-01', '0', '0', 'MOBARAK SK', NULL, 'KAMAL HOSSAIN', NULL, 'JOTSNA BIBI', NULL, '2008-09-30', NULL, NULL, NULL, NULL, NULL, '9002507337', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 5, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '96', NULL, NULL),
(1310, '01783521001782', 0, 0, '2024-01-01', '0', '0', 'MOMINUL ISLAM', NULL, 'GOLAM MUSTOFA', NULL, 'GOLAMA BIBI', NULL, '2006-12-31', NULL, NULL, NULL, NULL, NULL, '7432007450', '', NULL, NULL, NULL, 'INDIAN', '36128411320', 'SBIN0008006', NULL, NULL, NULL, 5, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '87', NULL, NULL),
(1311, '01357520000081', 0, 0, '2024-01-01', '0', '0', 'MST ANUARA MARIUM', NULL, 'MD ANWARUL HAQ', NULL, 'MST TAJKURA KHATUN', NULL, '2010-02-18', NULL, NULL, NULL, NULL, NULL, '9002389003', '', NULL, NULL, NULL, 'INDIAN', '5575010033220', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '97', NULL, NULL),
(1312, '05374721000026', 0, 0, '2024-01-01', '0', '0', 'MST NILUFA KHATUN', NULL, 'JOYDUL SEKH', NULL, 'SAMSUNNEHER BIBI', NULL, '2008-10-25', NULL, NULL, NULL, NULL, NULL, '8479031019', '', NULL, NULL, NULL, 'INDIAN', '1532101700041883', 'PUNB0153210', NULL, NULL, NULL, 5, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '86', NULL, NULL),
(1313, '01475519000248', 0, 0, '2024-01-01', '0', '0', 'MST RITA KHATUN', NULL, 'MD REJAUL KARIM', NULL, 'ROJINA BIBI', NULL, '2009-04-25', NULL, NULL, NULL, NULL, NULL, '8509794165', '', NULL, NULL, NULL, 'INDIAN', '5021010031657', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '20', NULL, NULL),
(1314, '05311919000450', 0, 0, '2024-01-01', '0', '0', 'MURAD SK', NULL, 'AINUL SK', NULL, 'FULJHARA BIBI', NULL, '2009-08-19', NULL, NULL, NULL, NULL, NULL, '7602212618', '', NULL, NULL, NULL, 'INDIAN', '41446602185', 'SBIN0008006', NULL, NULL, NULL, 5, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '12', NULL, NULL),
(1315, '01783521001193', 0, 0, '2024-01-01', '0', '0', 'NASIM SK', NULL, 'ROFIQUE SK', NULL, 'JANNATUNNESHA', NULL, '2009-01-23', NULL, NULL, NULL, NULL, NULL, '8972558261', '', NULL, NULL, NULL, 'INDIAN', '5021030001078', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '43', NULL, NULL),
(1316, '05313119000122', 0, 0, '2024-01-01', '0', '0', 'NASRIN AKTAR', NULL, 'SARIKUL', NULL, 'HABIBA BIBI', NULL, '2009-08-25', NULL, NULL, NULL, NULL, NULL, '9635641528', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 5, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '67', NULL, NULL),
(1317, '01783521000892', 0, 0, '2024-01-01', '0', '0', 'NIRASA PARVIN', NULL, 'NURUL ISLAM', NULL, 'CHHABI BIBI', NULL, '2009-06-22', NULL, NULL, NULL, NULL, NULL, '9749436377', '', NULL, NULL, NULL, 'INDIAN', '1314010101081', 'PUNB0131420', NULL, NULL, NULL, 5, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '26', NULL, NULL),
(1318, '01783521001304', 0, 0, '2024-01-01', '0', '0', 'NISHA KHATUN', NULL, 'NAJRUL ISLAM', NULL, 'REBA KHATUN', NULL, '2009-08-18', NULL, NULL, NULL, NULL, NULL, '7364001804', '', NULL, NULL, NULL, 'INDIAN', '5021020000496', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '70', NULL, NULL),
(1319, '01783521001652', 0, 0, '2024-01-01', '0', '0', 'NUR AMIN', NULL, 'BABUL HAQUE', NULL, 'NAJIRA BIBI', NULL, '2008-09-15', NULL, NULL, NULL, NULL, NULL, '9339712410', '', NULL, NULL, NULL, 'INDIAN', '0977010265393', 'PUNB0097720', NULL, NULL, NULL, 5, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '93', NULL, NULL),
(1320, '01783521001368', 0, 0, '2024-01-01', '0', '0', 'PAPAI MONDAL', NULL, 'MITHUN MONDAL', NULL, 'SANTANA MONDAL', NULL, '2009-04-16', NULL, NULL, NULL, NULL, NULL, '7029908887', '', NULL, NULL, NULL, 'INDIAN', '5021030000091', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '83', NULL, NULL),
(1321, '05374721000031', 0, 0, '2024-01-01', '0', '0', 'RACHANA KHATUN', NULL, 'ANSAR ALI', NULL, 'RUPALI BIBI', NULL, '2007-04-30', NULL, NULL, NULL, NULL, NULL, '6295453350', '', NULL, NULL, NULL, 'INDIAN', '0977010177563', 'UTBI0DLRC99', NULL, NULL, NULL, 5, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '95', NULL, NULL),
(1322, '08895119000091', 0, 0, '2024-01-01', '0', '0', 'RAKESH MONDAL', NULL, 'BASUDEB MONDAL', NULL, 'RAJKUMARI MONDAL', NULL, '2009-07-17', NULL, NULL, NULL, NULL, NULL, '7029067310', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 5, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '81', NULL, NULL),
(1323, '01783521001206', 0, 0, '2024-01-01', '0', '0', 'RAKESH SK', NULL, 'ASIKUL', NULL, 'SARJINA BIBI', NULL, '2009-10-20', NULL, NULL, NULL, NULL, NULL, '8509214984', '', NULL, NULL, NULL, 'INDIAN', '5021020000375', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '56', NULL, NULL),
(1324, '01783523000001', 0, 0, '2024-01-01', '0', '0', 'RASHIDA KHATUN', NULL, 'TUNU SHEKH', NULL, 'ELINA BIBI', NULL, '2009-08-22', NULL, NULL, NULL, NULL, NULL, '8097177150', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 5, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '32', NULL, NULL),
(1325, '05312919000112', 0, 0, '2024-01-01', '0', '0', 'RASIDA KHATUN', NULL, 'TARIKUL ISLAM', NULL, 'RAKIBA BIBI', NULL, '2009-12-18', NULL, NULL, NULL, NULL, NULL, '8346953943', '', NULL, NULL, NULL, 'INDIAN', '5021010035671', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '3', NULL, NULL),
(1326, '05375121000025', 0, 0, '2024-01-01', '0', '0', 'REKHA KHATUN', NULL, 'JARMAN SK', NULL, 'GOLBANU BIBI', NULL, '2008-07-08', NULL, NULL, NULL, NULL, NULL, '8391986964', '', NULL, NULL, NULL, 'INDIAN', '5575010021261', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '65', NULL, NULL),
(1327, '01783521000202', 0, 0, '2024-01-01', '0', '0', 'RINA KHATUN', NULL, 'ASARUL HOK', NULL, 'ROWSANARA BIBI', NULL, '2008-07-16', NULL, NULL, NULL, NULL, NULL, '7047025092', '', NULL, NULL, NULL, 'INDIAN', '36128411386', 'SBIN0008006', NULL, NULL, NULL, 5, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '49', NULL, NULL),
(1328, '01783521000330', 0, 0, '2024-01-01', '0', '0', 'RIYA KHATUN', NULL, 'HABIBUR SEIKH', NULL, 'CHAMPA BIBI', NULL, '2009-04-05', NULL, NULL, NULL, NULL, NULL, '8609881778', '', NULL, NULL, NULL, 'INDIAN', '5021030000426', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '47', NULL, NULL),
(1329, '01783521001308', 0, 0, '2024-01-01', '0', '0', 'RIYA KHATUN', NULL, 'ATIBUR BASAR', NULL, 'MAYNA BIBI', NULL, '2009-07-09', NULL, NULL, NULL, NULL, NULL, '6297704163', '', NULL, NULL, NULL, 'INDIAN', '5021030000707', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '62', NULL, NULL),
(1330, '01783521000158', 0, 0, '2024-01-01', '0', '0', 'ROHIT SK', NULL, 'RENTU SK', NULL, 'CHANSURA BIBI', NULL, '2009-03-09', NULL, NULL, NULL, NULL, NULL, '9933118163', '', NULL, NULL, NULL, 'INDIAN', '5575010040831', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '64', NULL, NULL),
(1331, '01783521001271', 0, 0, '2024-01-01', '0', '0', 'RONI SK', NULL, 'RAFIKUL ISLAM', NULL, 'TARALA BIBI', NULL, '2010-02-13', NULL, NULL, NULL, NULL, NULL, '8972818691', '', NULL, NULL, NULL, 'INDIAN', '36730736362', 'SBIN0008006', NULL, NULL, NULL, 5, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '72', NULL, NULL),
(1332, '05312919000109', 0, 0, '2024-01-01', '0', '0', 'RUKSANA KHATUN', NULL, 'DULAL SK', NULL, 'RIMA BIBI', NULL, '2009-10-09', NULL, NULL, NULL, NULL, NULL, '9609441736', '', NULL, NULL, NULL, 'INDIAN', '15322160233528', 'PUNB0015320', NULL, NULL, NULL, 5, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', NULL, NULL),
(1333, '07858419000023', 0, 0, '2024-01-01', '0', '0', 'SABBIR ISLAM', NULL, 'KALU SK', NULL, 'SERINA BIBI', NULL, '2008-03-02', NULL, NULL, NULL, NULL, NULL, '8116809053', '', NULL, NULL, NULL, 'INDIAN', '0977010284851', 'PUNB0097720', NULL, NULL, NULL, 5, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '94', NULL, NULL),
(1334, '01475519000273', 0, 0, '2024-01-01', '0', '0', 'SAFA SULTANA', NULL, 'TAJRUL ISLAM', NULL, 'JESMIN BIBI', NULL, '2009-03-11', NULL, NULL, NULL, NULL, NULL, '7699146731', '', NULL, NULL, NULL, 'INDIAN', '5301775743', 'CBIN0280122', NULL, NULL, NULL, 5, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '40', NULL, NULL),
(1335, '05374721000025', 0, 0, '2024-01-01', '0', '0', 'SAGIR HOSSAIN', NULL, 'ANISUR RAHAMAN', NULL, 'MASUDA BIBI', NULL, '2008-02-18', NULL, NULL, NULL, NULL, NULL, '8967092795', '', NULL, NULL, NULL, 'INDIAN', '38600842452', 'SBIN0008006', NULL, NULL, NULL, 5, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '90', NULL, NULL),
(1336, '01783521000846', 0, 0, '2024-01-01', '0', '0', 'SAHANAJ PARVIN', NULL, 'SANUYAR HOSSAIN', NULL, 'REJINA BIBI', NULL, '2009-06-05', NULL, NULL, NULL, NULL, NULL, '9970119756', '', NULL, NULL, NULL, 'INDIAN', '5021030000439', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '18', NULL, NULL),
(1337, '01783521001331', 0, 0, '2024-01-01', '0', '0', 'SAHEB SK', NULL, 'JAHANGIR ALOM', NULL, 'TANJURA BIBI', NULL, '2007-06-10', NULL, NULL, NULL, NULL, NULL, '7679013721', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 5, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4', NULL, NULL),
(1338, '01783521001196', 0, 0, '2024-01-01', '0', '0', 'SAHINA KHATUN', NULL, 'ABU SIDDIK', NULL, 'NURJAHAN BIBI.', NULL, '2009-05-25', NULL, NULL, NULL, NULL, NULL, '9635438800', '', NULL, NULL, NULL, 'INDIAN', '1532101700041731', 'PUNB0153210', NULL, NULL, NULL, 5, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '46', NULL, NULL),
(1339, '05313019000139', 0, 0, '2024-01-01', '0', '0', 'SAIMA KHATUN', NULL, 'SAIDUL ISLAM', NULL, 'CHANDSURA BIBI', NULL, '2009-09-05', NULL, NULL, NULL, NULL, NULL, '8016518034', '', NULL, NULL, NULL, 'INDIAN', '5021010025610', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '35', NULL, NULL),
(1340, '01783521001330', 0, 0, '2024-01-01', '0', '0', 'SAKILA KHATUN', NULL, 'JAIDUL ISLAM', NULL, 'FENSURA', NULL, '2009-08-14', NULL, NULL, NULL, NULL, NULL, '9963578965', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 5, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '82', NULL, NULL),
(1341, '01783521000889', 0, 0, '2024-01-01', '0', '0', 'SALMA SULTANA', NULL, 'ALLARAKHA', NULL, 'SAIRA BIBI', NULL, '2009-09-14', NULL, NULL, NULL, NULL, NULL, '9733951555', '', NULL, NULL, NULL, 'INDIAN', '5021010033415', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '16', NULL, NULL),
(1342, '01783521001202', 0, 0, '2024-01-01', '0', '0', 'SANARUL HQ', NULL, 'MASUD HOSSAIN', NULL, 'SAKHINA BIBI', NULL, '2009-01-15', NULL, NULL, NULL, NULL, NULL, '9002917126', '', NULL, NULL, NULL, 'INDIAN', '', '', NULL, NULL, NULL, 5, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '76', NULL, NULL),
(1343, '05312719000101', 0, 0, '2024-01-01', '0', '0', 'SANJIDA KHATUN', NULL, 'ANUAR HOSSAIN', NULL, 'AMBIA KHATUN', NULL, '2009-03-01', NULL, NULL, NULL, NULL, NULL, '6294581233', '', NULL, NULL, NULL, 'INDIAN', '1532101700038135', 'PUNB0153210', NULL, NULL, NULL, 5, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '30', NULL, NULL),
(1344, '01783521000332', 0, 0, '2024-01-01', '0', '0', 'SANTAHAR SK', NULL, 'SAIDUL SK', NULL, 'MINARA BIBI', NULL, '2007-12-17', NULL, NULL, NULL, NULL, NULL, '9091262026', '', NULL, NULL, NULL, 'INDIAN', '36027678934', 'SBIN0008006', NULL, NULL, NULL, 5, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '77', NULL, NULL),
(1345, '01783521001199', 0, 0, '2024-01-01', '0', '0', 'SAYAN SK', NULL, 'SAMIUL ISLAM', NULL, 'CHHABI BIBI', NULL, '2009-07-18', NULL, NULL, NULL, NULL, NULL, '9832271276', '', NULL, NULL, NULL, 'INDIAN', '5021030000453', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '50', NULL, NULL),
(1346, '01783521001309', 0, 0, '2024-01-01', '0', '0', 'SELINA KHATUN', NULL, 'BABLU SK', NULL, 'JEBONESHA BIBI', NULL, '2008-08-12', NULL, NULL, NULL, NULL, NULL, '9635704451', '', NULL, NULL, NULL, 'INDIAN', '37956173825', 'SBIN0008006', NULL, NULL, NULL, 5, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '66', NULL, NULL),
(1347, '05313219000218', 0, 0, '2024-01-01', '0', '0', 'SONALI KHATUN', NULL, 'LAL MAHAMMAD SK', NULL, 'SEFALI BIBI', NULL, '2009-05-26', NULL, NULL, NULL, NULL, NULL, '8116831016', '', NULL, NULL, NULL, 'INDIAN', '38608521740', 'SBIN0008006', NULL, NULL, NULL, 5, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '63', NULL, NULL),
(1348, '05311919000446', 0, 0, '2024-01-01', '0', '0', 'SUFERA KHATUN', NULL, 'ALTAF HOSSAIN', NULL, 'DOLY BIBI', NULL, '2009-05-26', NULL, NULL, NULL, NULL, NULL, '8016868532', '', NULL, NULL, NULL, 'INDIAN', '36150440964', 'SBIN0008006', NULL, NULL, NULL, 5, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5', NULL, NULL),
(1349, '01783521000901', 0, 0, '2024-01-01', '0', '0', 'SUKUDA KHATUN', NULL, 'AJMAL SK', NULL, 'MAMTAJ BIBI', NULL, '2009-07-03', NULL, NULL, NULL, NULL, NULL, '8116869025', '', NULL, NULL, NULL, 'INDIAN', '100153234182', 'INDB0000396', NULL, NULL, NULL, 5, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '29', NULL, NULL),
(1350, '05312919000114', 0, 0, '2024-01-01', '0', '0', 'SUMA KHATUN', NULL, 'HUMAYUN SK', NULL, 'KHUSHI BIBI', NULL, '2009-07-16', NULL, NULL, NULL, NULL, NULL, '7585015297', '', NULL, NULL, NULL, 'INDIAN', '5021010034265', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '79', NULL, NULL),
(1351, '05375121000023', 0, 0, '2024-01-01', '0', '0', 'SUMANTA SINGHA', NULL, 'MANOJ SINGHA', NULL, 'RAKHI SINGHA', NULL, '2007-09-21', NULL, NULL, NULL, NULL, NULL, '9679102258', '', NULL, NULL, NULL, 'INDIAN', '5575010037864', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '34', NULL, NULL),
(1352, '05312719000103', 0, 0, '2024-01-01', '0', '0', 'SURAIA KHATUN', NULL, 'SURUJJAMAN', NULL, 'RUMA BIBI', NULL, '2009-11-10', NULL, NULL, NULL, NULL, NULL, '9800369516', '', NULL, NULL, NULL, 'INDIAN', '5021010031745', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '31', NULL, NULL),
(1353, '04006619000817', 0, 0, '2024-01-01', '0', '0', 'SURYA SARDAR', NULL, 'SURAJIT SARDAR', NULL, 'SAMPA SARDAR', NULL, '2009-11-14', NULL, NULL, NULL, NULL, NULL, '7719268463', '', NULL, NULL, NULL, 'INDIAN', '520101057948004', 'UBIN0929409', NULL, NULL, NULL, 5, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '33', NULL, NULL),
(1354, '01783521001194', 0, 0, '2024-01-01', '0', '0', 'TANIA KHATUN', NULL, 'MD. TARAJUL ISLAM', NULL, 'LILA BIBI', NULL, '2009-03-01', NULL, NULL, NULL, NULL, NULL, '9547174456', '', NULL, NULL, NULL, 'INDIAN', '5021030001188', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '44', NULL, NULL),
(1355, '01783521000205', 0, 0, '2024-01-01', '0', '0', 'TATAN SK', NULL, 'KALAM SK', NULL, 'RUPALI BIBI', NULL, '2008-08-22', NULL, NULL, NULL, NULL, NULL, '7699265476', '', NULL, NULL, NULL, 'INDIAN', '5021020000732', 'PUNB0RRBBGB', NULL, NULL, NULL, 5, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '85', NULL, NULL);

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
(2, 'Sub Admin', 'subadmin@gmail.com', NULL, '$2y$10$xWBR2C70wr16W8fafFcJyubTs67NqEhWLKGjeycBmuONYzegtw59e', NULL, 2, 5, '2024-06-25 12:26:13', '2024-06-25 12:26:13'),
(3, 'Admin', 'admin@gmail.com', NULL, '$2y$10$wH6hlgukMPC6EaIgdvJQ3ONDW5.3IhJFtXDo8EMBdFIj440lRpfoC', 'K7vk0DlE2nwcLqdp0ORuO1J8aqvZlbX5VqcLVrZ0kiF9D0iGykoTcsF9fJNr', 3, 1, '2024-06-25 12:26:49', '2024-06-25 12:26:49'),
(4, 'Super Admin', 'supadmin@gmail.com', NULL, '$2y$10$RyE2pp17XVshwHlqHzJSN.jiHAFqrX1aqIydx2zaW/7eYrdGDwoxy', 'tf3H58vUkA3u0ldC6IhPoHDGQpsidhgGJRVVbkS123gdA7tspw0bl8mVPbjP', 4, 6, '2024-06-25 12:27:21', '2024-06-25 12:27:21');

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `studentdbs`
--
ALTER TABLE `studentdbs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1356;

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
