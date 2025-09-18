-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 18, 2025 at 09:35 AM
-- Server version: 10.6.22-MariaDB-0ubuntu0.22.04.1
-- PHP Version: 8.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skywifi`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `internet_plans`
--

CREATE TABLE `internet_plans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `duration_minutes` int(11) NOT NULL,
  `speed_limit` int(11) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `internet_plans`
--

INSERT INTO `internet_plans` (`id`, `name`, `price`, `duration_minutes`, `speed_limit`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Masaa 2 - Unlimited', '500.00', 120, 10240, 'inactive', '2025-09-17 10:21:19', '2025-09-17 10:21:19', NULL),
(2, 'Siku 1 - Unlimited', '1000.00', 1440, 10240, 'inactive', '2025-09-17 10:21:19', '2025-09-17 10:21:19', NULL),
(3, 'Wiki 1 - Unlimited', '5000.00', 10080, 10240, 'inactive', '2025-09-17 10:21:19', '2025-09-17 10:21:19', NULL),
(4, 'Mwezi 1 - Unlimited', '25000.00', 43200, 10240, 'inactive', '2025-09-17 10:21:19', '2025-09-17 10:21:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
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
(4, '2025_09_01_191922_create_internet_plans_table', 1),
(5, '2025_09_01_192117_create_user_devices_table', 1),
(6, '2025_09_01_192310_create_subscriptions_table', 1),
(7, '2025_09_01_192339_create_payments_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `nas`
--

CREATE TABLE `nas` (
  `id` int(10) NOT NULL,
  `nasname` varchar(128) NOT NULL,
  `shortname` varchar(32) DEFAULT NULL,
  `type` varchar(30) DEFAULT 'other',
  `ports` int(5) DEFAULT NULL,
  `secret` varchar(60) NOT NULL DEFAULT 'secret',
  `server` varchar(64) DEFAULT NULL,
  `community` varchar(50) DEFAULT NULL,
  `description` varchar(200) DEFAULT 'RADIUS Client'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subscription_id` bigint(20) UNSIGNED NOT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `status` enum('pending','initiated','successful','failed') NOT NULL DEFAULT 'pending',
  `response` text DEFAULT NULL,
  `paid_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `subscription_id`, `transaction_id`, `amount`, `phone`, `status`, `response`, `paid_at`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, '44e2c368-9fd6-4a98-a62f-2a7b550f13a2', '25000.00', '0742177328', 'initiated', NULL, NULL, '2025-09-17 10:23:15', '2025-09-17 10:23:15', NULL),
(2, 2, '37c5bb77-c451-42f1-9306-1e8db7e2d091', '500.00', '0755467667', 'initiated', NULL, NULL, '2025-09-17 15:15:50', '2025-09-17 15:15:50', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `radacct`
--

CREATE TABLE `radacct` (
  `radacctid` bigint(21) NOT NULL,
  `acctsessionid` varchar(64) NOT NULL DEFAULT '',
  `acctuniqueid` varchar(32) NOT NULL DEFAULT '',
  `username` varchar(64) NOT NULL DEFAULT '',
  `realm` varchar(64) DEFAULT '',
  `nasipaddress` varchar(15) NOT NULL DEFAULT '',
  `nasportid` varchar(32) DEFAULT NULL,
  `nasporttype` varchar(32) DEFAULT NULL,
  `acctstarttime` datetime DEFAULT NULL,
  `acctupdatetime` datetime DEFAULT NULL,
  `acctstoptime` datetime DEFAULT NULL,
  `acctinterval` int(12) DEFAULT NULL,
  `acctsessiontime` int(12) UNSIGNED DEFAULT NULL,
  `acctauthentic` varchar(32) DEFAULT NULL,
  `connectinfo_start` varchar(128) DEFAULT NULL,
  `connectinfo_stop` varchar(128) DEFAULT NULL,
  `acctinputoctets` bigint(20) DEFAULT NULL,
  `acctoutputoctets` bigint(20) DEFAULT NULL,
  `calledstationid` varchar(50) NOT NULL DEFAULT '',
  `callingstationid` varchar(50) NOT NULL DEFAULT '',
  `acctterminatecause` varchar(32) NOT NULL DEFAULT '',
  `servicetype` varchar(32) DEFAULT NULL,
  `framedprotocol` varchar(32) DEFAULT NULL,
  `framedipaddress` varchar(15) NOT NULL DEFAULT '',
  `framedipv6address` varchar(45) NOT NULL DEFAULT '',
  `framedipv6prefix` varchar(45) NOT NULL DEFAULT '',
  `framedinterfaceid` varchar(44) NOT NULL DEFAULT '',
  `delegatedipv6prefix` varchar(45) NOT NULL DEFAULT '',
  `class` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `radcheck`
--

CREATE TABLE `radcheck` (
  `id` int(11) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL DEFAULT '',
  `attribute` varchar(64) NOT NULL DEFAULT '',
  `op` char(2) NOT NULL DEFAULT '==',
  `value` varchar(253) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `radgroupcheck`
--

CREATE TABLE `radgroupcheck` (
  `id` int(11) UNSIGNED NOT NULL,
  `groupname` varchar(64) NOT NULL DEFAULT '',
  `attribute` varchar(64) NOT NULL DEFAULT '',
  `op` char(2) NOT NULL DEFAULT '==',
  `value` varchar(253) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `radgroupreply`
--

CREATE TABLE `radgroupreply` (
  `id` int(11) UNSIGNED NOT NULL,
  `groupname` varchar(64) NOT NULL DEFAULT '',
  `attribute` varchar(64) NOT NULL DEFAULT '',
  `op` char(2) NOT NULL DEFAULT '=',
  `value` varchar(253) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `radpostauth`
--

CREATE TABLE `radpostauth` (
  `id` int(11) NOT NULL,
  `username` varchar(64) NOT NULL DEFAULT '',
  `pass` varchar(64) NOT NULL DEFAULT '',
  `reply` varchar(32) NOT NULL DEFAULT '',
  `authdate` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `class` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `radreply`
--

CREATE TABLE `radreply` (
  `id` int(11) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL DEFAULT '',
  `attribute` varchar(64) NOT NULL DEFAULT '',
  `op` char(2) NOT NULL DEFAULT '=',
  `value` varchar(253) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `radusergroup`
--

CREATE TABLE `radusergroup` (
  `id` int(11) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL DEFAULT '',
  `groupname` varchar(64) NOT NULL DEFAULT '',
  `priority` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
('5nB02tQhqEZWKKcls8AA8CiSmsY45eEyBw2lDNPr', NULL, '10.1.0.3', 'Android-device', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiT2EwdXp4SGVvTk1nTkRtZ2M1YnNWeXJGY1A3eHo3SXlsVnV5QnlEcyI7czo2OiJsb2NhbGUiO3M6Mjoic3ciO3M6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjMzMDoiaHR0cDovLzEwLjEuMC4xLz9sb2dpbnVybD1odHRwJTNBJTJGJTJGMTAuMS4wLjElMkYlM0ZyZXMlM0Rub3R5ZXQlMjZ1YW1pcCUzRDEwLjEuMC4xJTI2dWFtcG9ydCUzRDM5OTAlMjZjaGFsbGVuZ2UlM0QxMDhiMmQxODQ3YWRhNmU3NzE2OWMwZmI4YWZkZWIxMyUyNmNhbGxlZCUzRDcwLTE5LTg4LTczLTg4LThCJTI2bWFjJTNEMjAtMjYtODEtRjgtREYtMUElMjZpcCUzRDEwLjEuMC4zJTI2bmFzaWQlM0RteWhvdHNwb3QlMjZzZXNzaW9uaWQlM0QxNzU4MTIyMjk2MDAwMDAwMDMlMjZ1c2VydXJsJTNEaHR0cCUyNTNhJTI1MmYlMjUyZmNoZWNraXAuYW1hem9uYXdzLmNvbSUyNTJmIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1758122303),
('6SrvH3SFugrqQ6jsnSQuVCHFMAnImUpegcxHVY6e', NULL, '10.1.0.32', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/60.5 Safari/605.1.15', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiWXRwNkdYOVpjeEtaRUM4Z0laUWVXWHhVZk1zS2xockk4VjFMNVRXcCI7czo2OiJsb2NhbGUiO3M6Mjoic3ciO3M6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjMyNzoiaHR0cDovLzEwLjEuMC4xLz9sb2dpbnVybD1odHRwJTNBJTJGJTJGMTAuMS4wLjElMkYlM0ZyZXMlM0Rub3R5ZXQlMjZ1YW1pcCUzRDEwLjEuMC4xJTI2dWFtcG9ydCUzRDM5OTAlMjZjaGFsbGVuZ2UlM0QxYTliNDNjZWZhNGE5MmYxYzlmOWJmMmY0MzQzMjUzYyUyNmNhbGxlZCUzRDcwLTE5LTg4LTczLTg4LThCJTI2bWFjJTNENzQtRDgtM0UtOUYtMjItODQlMjZpcCUzRDEwLjEuMC4zMiUyNm5hc2lkJTNEbXlob3RzcG90JTI2c2Vzc2lvbmlkJTNEMTc1ODEyMTM4OTAwMDAwMDAyJTI2dXNlcnVybCUzRGh0dHAlMjUzYSUyNTJmJTI1MmZubWNoZWNrLmdub21lLm9yZyUyNTJmIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1758125019),
('akRzYzxalqrZkYxoFi9rcXXzJlowiBcQE7Q7OpMs', NULL, '10.1.0.32', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiN3p3cDJtOWlCRDVhRVp4VGpwZlRQbVZyZk5BdGMzbWpWTElSd1AwMSI7czo2OiJsb2NhbGUiO3M6Mjoic3ciO3M6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjQzMToiaHR0cDovLzEwLjEuMC4xLz9sb2dpbnVybD1odHRwJTNBJTJGJTJGMTAuMS4wLjElMkYlM0ZyZXMlM0Rub3R5ZXQlMjZ1YW1pcCUzRDEwLjEuMC4xJTI2dWFtcG9ydCUzRDM5OTAlMjZjaGFsbGVuZ2UlM0QxYTliNDNjZWZhNGE5MmYxYzlmOWJmMmY0MzQzMjUzYyUyNmNhbGxlZCUzRDcwLTE5LTg4LTczLTg4LThCJTI2bWFjJTNENzQtRDgtM0UtOUYtMjItODQlMjZpcCUzRDEwLjEuMC4zMiUyNm5hc2lkJTNEbXlob3RzcG90JTI2c2Vzc2lvbmlkJTNEMTc1ODEyMTM4OTAwMDAwMDAyJTI2dXNlcnVybCUzRGh0dHAlMjUzYSUyNTJmJTI1MmZjbGllbnRzZXJ2aWNlcy5nb29nbGVhcGlzLmNvbSUyNTJmY2hyb21lLXZhcmlhdGlvbnMlMjUyZnNlZWQlMjUzZm9zbmFtZSUyNTNkbGludXglMjUyNmNoYW5uZWwlMjUzZHN0YWJsZSUyNTI2bWlsZXN0b25lJTI1M2QxNDAiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1758124831),
('CdBE9Hnvsxd3wW7DS0qDgn78WnwCAYQv1LgaL0FZ', NULL, '10.1.0.3', 'Mozilla/5.0 (Linux; Android 14; TECNO CK7n Build/UP1A.231005.007; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/140.0.7339.51 Mobile Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiMFZJdVM4Um1aRndNb3BVYlZnQTJySmZMVTZ3V3B5U1UzSUdjUzFwcCI7czo2OiJsb2NhbGUiO3M6Mjoic3ciO3M6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjcwOiJodHRwOi8vMTAuMS4wLjEvcGF5bWVudHMvY2hlY2tvdXQvNDRlMmMzNjgtOWZkNi00YTk4LWE2MmYtMmE3YjU1MGYxM2EyIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1758104626),
('cwQKOM7j7k0XzryCcyFa4BBFvoRxR7nmWGJSCSmT', NULL, '10.1.0.32', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/60.5 Safari/605.1.15', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSGpKamZSdFhxT0lDTmNiaENoVE1Lb2s3NnlpV0NyOGE1ZDUzNFRsWSI7czo2OiJsb2NhbGUiO3M6Mjoic3ciO3M6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjcwOiJodHRwOi8vMTAuMS4wLjEvcGF5bWVudHMvY2hlY2tvdXQvMzdjNWJiNzctYzQ1MS00MmYxLTkzMDYtMWU4ZGI3ZTJkMDkxIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1758122332),
('HUDo0oCVgEWDCegfUntfcWTimMajYEFzeHkpsoLf', NULL, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibldYR1hzWU54UVAwT2h0TmYxZldOcnpIcFVBZHp6MDBQcnBSSnU0ZiI7czo2OiJsb2NhbGUiO3M6Mjoic3ciO3M6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1758187971),
('nOLfh8tv3IXjSnfVRfiO5bZzvCoUtXjaynbLx5FA', NULL, '10.1.0.32', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiUWNXQjkwZTJobVd0VUd6NnVOeGdSa1AwdE5FemlveTFCVElLSWNhSyI7czo2OiJsb2NhbGUiO3M6Mjoic3ciO3M6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjQzMToiaHR0cDovLzEwLjEuMC4xLz9sb2dpbnVybD1odHRwJTNBJTJGJTJGMTAuMS4wLjElMkYlM0ZyZXMlM0Rub3R5ZXQlMjZ1YW1pcCUzRDEwLjEuMC4xJTI2dWFtcG9ydCUzRDM5OTAlMjZjaGFsbGVuZ2UlM0Q1M2M1MmNhZTJkNWJjNTBiZGY4YTVkYjg2MTI5YmRlZiUyNmNhbGxlZCUzRDcwLTE5LTg4LTczLTg4LThCJTI2bWFjJTNENzQtRDgtM0UtOUYtMjItODQlMjZpcCUzRDEwLjEuMC4zMiUyNm5hc2lkJTNEbXlob3RzcG90JTI2c2Vzc2lvbmlkJTNEMTc1ODEyMTM4OTAwMDAwMDAyJTI2dXNlcnVybCUzRGh0dHAlMjUzYSUyNTJmJTI1MmZjbGllbnRzZXJ2aWNlcy5nb29nbGVhcGlzLmNvbSUyNTJmY2hyb21lLXZhcmlhdGlvbnMlMjUyZnNlZWQlMjUzZm9zbmFtZSUyNTNkbGludXglMjUyNmNoYW5uZWwlMjUzZHN0YWJsZSUyNTI2bWlsZXN0b25lJTI1M2QxNDAiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1758123097),
('piqX7Qf4la4ek1h5SLis4EEGKrR0uVWn3moYG5qB', NULL, '10.1.0.1', 'GuzzleHttp/7', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNHFud3RLMnVzQmZpdWRVTmF3ODlMYnZNTnJxR2xTelphUWN4TE53MCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6OTk6Imh0dHA6Ly8xMC4xLjAuMS9wYXk/YW1vdW50PTI1MDAwLjAwJnBob25lPTA3NDIxNzczMjgmcmVmZXJlbmNlPTQ0ZTJjMzY4LTlmZDYtNGE5OC1hNjJmLTJhN2I1NTBmMTNhMiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1758104605),
('W2N4U0f4QvD4wfkLS9vqfCrYdLX32j2Ymx7i4eDc', NULL, '10.1.0.32', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/60.5 Safari/605.1.15', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoia0JaMzR3RG9yeUlCYk90RTd4djA2OVlkUHIyRE00WGdKdHRacXZkcCI7czo2OiJsb2NhbGUiO3M6Mjoic3ciO3M6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjMyNzoiaHR0cDovLzEwLjEuMC4xLz9sb2dpbnVybD1odHRwJTNBJTJGJTJGMTAuMS4wLjElMkYlM0ZyZXMlM0Rub3R5ZXQlMjZ1YW1pcCUzRDEwLjEuMC4xJTI2dWFtcG9ydCUzRDM5OTAlMjZjaGFsbGVuZ2UlM0Q1M2M1MmNhZTJkNWJjNTBiZGY4YTVkYjg2MTI5YmRlZiUyNmNhbGxlZCUzRDcwLTE5LTg4LTczLTg4LThCJTI2bWFjJTNENzQtRDgtM0UtOUYtMjItODQlMjZpcCUzRDEwLjEuMC4zMiUyNm5hc2lkJTNEbXlob3RzcG90JTI2c2Vzc2lvbmlkJTNEMTc1ODEyMTM4OTAwMDAwMDAyJTI2dXNlcnVybCUzRGh0dHAlMjUzYSUyNTJmJTI1MmZubWNoZWNrLmdub21lLm9yZyUyNTJmIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1758123097),
('wJwBGYBIEqNB5Nqov0ciG6mlO1b6yQuW6csLbfT2', NULL, '10.1.0.3', 'Android-device', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoieWpBc1NDTDB0VnBIQkNxZHBZZENBZ0QwbHg1OUNoQlJiaUhRcUdXMyI7czo2OiJsb2NhbGUiO3M6Mjoic3ciO3M6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjMzMDoiaHR0cDovLzEwLjEuMC4xLz9sb2dpbnVybD1odHRwJTNBJTJGJTJGMTAuMS4wLjElMkYlM0ZyZXMlM0Rub3R5ZXQlMjZ1YW1pcCUzRDEwLjEuMC4xJTI2dWFtcG9ydCUzRDM5OTAlMjZjaGFsbGVuZ2UlM0QxMDhiMmQxODQ3YWRhNmU3NzE2OWMwZmI4YWZkZWIxMyUyNmNhbGxlZCUzRDcwLTE5LTg4LTczLTg4LThCJTI2bWFjJTNEMjAtMjYtODEtRjgtREYtMUElMjZpcCUzRDEwLjEuMC4zJTI2bmFzaWQlM0RteWhvdHNwb3QlMjZzZXNzaW9uaWQlM0QxNzU4MTIyMjk2MDAwMDAwMDMlMjZ1c2VydXJsJTNEaHR0cCUyNTNhJTI1MmYlMjUyZmNoZWNraXAuYW1hem9uYXdzLmNvbSUyNTJmIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1758122303);

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_device_id` bigint(20) UNSIGNED NOT NULL,
  `internet_plan_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('active','expired','pending','cancelled') NOT NULL DEFAULT 'pending',
  `start_time` timestamp NULL DEFAULT NULL,
  `end_time` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscriptions`
--

INSERT INTO `subscriptions` (`id`, `user_device_id`, `internet_plan_id`, `status`, `start_time`, `end_time`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 4, 'pending', '2025-09-17 10:23:15', '2025-10-17 10:23:15', '2025-09-17 10:23:15', '2025-09-17 10:23:15', NULL),
(2, 2, 1, 'pending', '2025-09-17 15:15:50', '2025-09-17 17:15:50', '2025-09-17 15:15:50', '2025-09-17 15:15:50', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
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

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Test User', 'test@example.com', '2025-09-17 10:21:18', '$2y$12$QCceqOJfsr1J80i8koZAt.LdbuoQ0gB1PfOuSkJ/Fak5mOiDMJEgC', '8u0ZoObGlA', '2025-09-17 10:21:19', '2025-09-17 10:21:19');

-- --------------------------------------------------------

--
-- Table structure for table `user_devices`
--

CREATE TABLE `user_devices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `mac_address` varchar(255) NOT NULL,
  `device_name` varchar(255) DEFAULT NULL,
  `status` enum('active','blocked') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_devices`
--

INSERT INTO `user_devices` (`id`, `user_id`, `mac_address`, `device_name`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, NULL, 'F2-4C-2D-60-F3-8C', NULL, 'active', '2025-09-17 10:23:15', '2025-09-17 10:23:15', NULL),
(2, NULL, '74-D8-3E-9F-22-84', NULL, 'active', '2025-09-17 15:15:49', '2025-09-17 15:15:49', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `internet_plans`
--
ALTER TABLE `internet_plans`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `nas`
--
ALTER TABLE `nas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nasname` (`nasname`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `payments_transaction_id_unique` (`transaction_id`),
  ADD KEY `payments_subscription_id_foreign` (`subscription_id`);

--
-- Indexes for table `radacct`
--
ALTER TABLE `radacct`
  ADD PRIMARY KEY (`radacctid`),
  ADD UNIQUE KEY `acctuniqueid` (`acctuniqueid`),
  ADD KEY `username` (`username`),
  ADD KEY `framedipaddress` (`framedipaddress`),
  ADD KEY `framedipv6address` (`framedipv6address`),
  ADD KEY `framedipv6prefix` (`framedipv6prefix`),
  ADD KEY `framedinterfaceid` (`framedinterfaceid`),
  ADD KEY `delegatedipv6prefix` (`delegatedipv6prefix`),
  ADD KEY `acctsessionid` (`acctsessionid`),
  ADD KEY `acctsessiontime` (`acctsessiontime`),
  ADD KEY `acctstarttime` (`acctstarttime`),
  ADD KEY `acctinterval` (`acctinterval`),
  ADD KEY `acctstoptime` (`acctstoptime`),
  ADD KEY `nasipaddress` (`nasipaddress`),
  ADD KEY `class` (`class`);

--
-- Indexes for table `radcheck`
--
ALTER TABLE `radcheck`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`(32));

--
-- Indexes for table `radgroupcheck`
--
ALTER TABLE `radgroupcheck`
  ADD PRIMARY KEY (`id`),
  ADD KEY `groupname` (`groupname`(32));

--
-- Indexes for table `radgroupreply`
--
ALTER TABLE `radgroupreply`
  ADD PRIMARY KEY (`id`),
  ADD KEY `groupname` (`groupname`(32));

--
-- Indexes for table `radpostauth`
--
ALTER TABLE `radpostauth`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`),
  ADD KEY `class` (`class`);

--
-- Indexes for table `radreply`
--
ALTER TABLE `radreply`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`(32));

--
-- Indexes for table `radusergroup`
--
ALTER TABLE `radusergroup`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`(32));

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subscriptions_user_device_id_foreign` (`user_device_id`),
  ADD KEY `subscriptions_internet_plan_id_foreign` (`internet_plan_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_devices`
--
ALTER TABLE `user_devices`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_devices_mac_address_unique` (`mac_address`),
  ADD KEY `user_devices_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `internet_plans`
--
ALTER TABLE `internet_plans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `nas`
--
ALTER TABLE `nas`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `radacct`
--
ALTER TABLE `radacct`
  MODIFY `radacctid` bigint(21) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `radcheck`
--
ALTER TABLE `radcheck`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `radgroupcheck`
--
ALTER TABLE `radgroupcheck`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `radgroupreply`
--
ALTER TABLE `radgroupreply`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `radpostauth`
--
ALTER TABLE `radpostauth`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `radreply`
--
ALTER TABLE `radreply`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `radusergroup`
--
ALTER TABLE `radusergroup`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_devices`
--
ALTER TABLE `user_devices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_subscription_id_foreign` FOREIGN KEY (`subscription_id`) REFERENCES `subscriptions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD CONSTRAINT `subscriptions_internet_plan_id_foreign` FOREIGN KEY (`internet_plan_id`) REFERENCES `internet_plans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `subscriptions_user_device_id_foreign` FOREIGN KEY (`user_device_id`) REFERENCES `user_devices` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_devices`
--
ALTER TABLE `user_devices`
  ADD CONSTRAINT `user_devices_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
