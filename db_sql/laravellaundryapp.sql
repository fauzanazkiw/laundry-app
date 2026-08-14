-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table laravellaundryapp.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table laravellaundryapp.cache: ~0 rows (approximately)
DELETE FROM `cache`;

-- Dumping structure for table laravellaundryapp.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table laravellaundryapp.cache_locks: ~0 rows (approximately)
DELETE FROM `cache_locks`;

-- Dumping structure for table laravellaundryapp.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table laravellaundryapp.jobs: ~0 rows (approximately)
DELETE FROM `jobs`;

-- Dumping structure for table laravellaundryapp.job_batches
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table laravellaundryapp.job_batches: ~0 rows (approximately)
DELETE FROM `job_batches`;

-- Dumping structure for table laravellaundryapp.layanan
CREATE TABLE IF NOT EXISTS `layanan` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `harga` decimal(12,2) NOT NULL DEFAULT '0.00',
  `satuan` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'kg',
  `estimasi_hari` int DEFAULT NULL,
  `keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `aktif` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table laravellaundryapp.layanan: ~3 rows (approximately)
DELETE FROM `layanan`;
INSERT INTO `layanan` (`id`, `nama`, `harga`, `satuan`, `estimasi_hari`, `keterangan`, `aktif`, `created_at`, `updated_at`) VALUES
	(1, 'Cuci Kering Lipat', 7000.00, 'kg', 2, 'Cuci, kering, dan dilipat rapi.', 1, '2026-08-10 10:05:30', '2026-08-10 10:05:30'),
	(2, 'Cuci Setrika', 9000.00, 'kg', 3, 'Cuci, kering, dan disetrika.', 1, '2026-08-10 10:05:30', '2026-08-10 10:05:30'),
	(3, 'Setrika Saja', 5000.00, 'kg', 1, 'Khusus setrika tanpa cuci.', 1, '2026-08-10 10:05:30', '2026-08-10 10:05:30');

-- Dumping structure for table laravellaundryapp.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table laravellaundryapp.sessions: ~0 rows (approximately)
DELETE FROM `sessions`;
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('0AWB0SCufcVrYecTCXGNQZkjgN58Qxy0yH5IcA6m', NULL, '127.0.0.1', 'curl/8.18.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTkpkamdhYkltN0o5Ymx4RUZaU3hzczlDandIOVZMbExXalNLOVBnbyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODEyMyI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1786332046),
	('5mlDwYKpmyncxv2PyMwxDUlOmriOqqwaVisOqoDI', 1, '127.0.0.1', 'curl/8.18.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiRHl6QW9zdGF2cXZ0UGcwRjBYQlU1Ym84NjQ1WE1vb1Rhb09LbExscSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly8xMjcuMC4wLjE6ODEyMy9wYW5lbC9sYXlhbmFuIjtzOjU6InJvdXRlIjtOO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YToxOntpOjA7czo3OiJzdWNjZXNzIjt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6Nzoic3VjY2VzcyI7czoyODoiTGF5YW5hbiBiZXJoYXNpbCBkaXRhbWJhaGthbiI7fQ==', 1786332916),
	('61bD0eFgW4vEDwt3Q4dG0NSXthKxwXm3w9QZqquS', NULL, '127.0.0.1', 'Mozilla/5.0 (Linux; Android 15; Pixel 9) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Mobile Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoieE5XM2RGb2xoZ3d0S2ZNdkRuTXRiYVdweE1sQjJlRXR5ODNGTUdqUyI7czo1OiJlcnJvciI7czozMjoiQW5kYSBoYXJ1cyBsb2dpbiB0ZXJsZWJpaCBkYWh1bHUiO3M6NjoiX2ZsYXNoIjthOjI6e3M6MzoibmV3IjthOjA6e31zOjM6Im9sZCI7YToxOntpOjA7czo1OiJlcnJvciI7fX1zOjk6Il9wcmV2aW91cyI7YToyOntzOjM6InVybCI7czozNzoiaHR0cDovL2xvY2FsaG9zdDo4MDAwL3BhbmVsL3RyYW5zYWtzaSI7czo1OiJyb3V0ZSI7Tjt9fQ==', 1786351369),
	('a0b9OXGqNemLIFtOkcv6j62sSminjP3SPrr4QspV', 1, '127.0.0.1', 'curl/8.18.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiU3BDdEtPOUk5M1FFRExUcWNjdGliOHJjNzdWMGVYeDFWbEVVTVdzSyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODEyMy9wYW5lbC9sYXlhbmFuLzEvc3RhdHVzIjtzOjU6InJvdXRlIjtOO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YToxOntpOjA7czo1OiJlcnJvciI7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjU6ImVycm9yIjtzOjUxOiJTdGF0dXMgZGVmYXVsdCAiRGl0ZXJpbWEiIHRpZGFrIGJpc2EgZGl1YmFoIG5hbWFueWEiO30=', 1786333657),
	('atxEBr3lYm8gVtcC0KnuqRuMXFh693ty1soz7WRU', 5, '127.0.0.1', 'curl/8.18.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiTHBUcHNOZ3gyZ3lOS0tPa3Z4bDR0aHZKZHNtOUlhTEpzdTZCeDZlaCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODEyMyI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NTt9', 1786332233),
	('egMTk5AFJ9klyBV6JDFPF0LZMBz0nZQh9nnGXpaS', NULL, '127.0.0.1', 'curl/8.18.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiYkVyUTdyUENLdUZDNmlsNk5iTHYyNTdmVG40RENxNTZvdFRkY2JBNSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODEyMy9sb2dpbiI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MTp7aTowO3M6NToiZXJyb3IiO31zOjM6Im5ldyI7YTowOnt9fXM6NToiZXJyb3IiO3M6MjU6IkVtYWlsIGF0YXUgcGFzc3dvcmQgc2FsYWgiO30=', 1786332086),
	('FeXyUmZNIGnOnxu9lgom5scc8hqdToxyjqzixryh', 1, '127.0.0.1', 'curl/8.18.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiQm01bWliMnlzbkUxbUw1RG9rRDhzVmpaY2s1dWE2ekc2ZEpwZDZBZSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly8xMjcuMC4wLjE6ODEyMy9wYW5lbC9sYXlhbmFuIjtzOjU6InJvdXRlIjtOO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1786333397),
	('fmmKnOqTD7BK2UPjFRFU40gV4cF4vBGqw1F1mTk8', 4, '127.0.0.1', 'curl/8.18.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiWDRGdTFpSVlwUWhhQmVFcUE0RTloWHU3cFVHWkpQM1NxOXFQVWdabiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODEyMy9wYW5lbC90cmFuc2Frc2ktdGFtYmFoIjtzOjU6InJvdXRlIjtOO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YToxOntpOjA7czo3OiJzdWNjZXNzIjt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo0O3M6Nzoic3VjY2VzcyI7czoyNzoiVHJhbnNha3NpIGJlcmhhc2lsIGRpc2ltcGFuIjt9', 1786332233),
	('IkOUYGXwIK7eCKcTFHvHt2Jmx7EMZF06bU2xPHH1', 8, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVjJLcVNNZjlROHlYTEdxaUxsNkZjVHVuUzFqem9TZVo2SU1TTlg5YiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7czo1OiJyb3V0ZSI7Tjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6ODt9', 1786356898),
	('n4i03pdKjlKgb3N0DjdVp60BwUW6w73fuHFnKSfY', 7, '127.0.0.1', 'curl/8.18.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiWmxtTzNqaTJ1REU2bjhrdGFzUEZZcGhsdGREV2NlWTNIVGFPNDV5SiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly8xMjcuMC4wLjE6ODEyMy9wYW5lbC9sYXlhbmFuIjtzOjU6InJvdXRlIjtOO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YToxOntpOjA7czo1OiJlcnJvciI7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NztzOjU6ImVycm9yIjtzOjQwOiJBbmRhIHRpZGFrIG1lbWlsaWtpIGFrc2VzIGtlIGhhbGFtYW4gaW5pIjt9', 1786333413),
	('NFVPRvFIWhE4GS9xeHZgRTWQX3ePPUcPCh8qrGBn', 6, '127.0.0.1', 'curl/8.18.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiMUFZUUFGWEpZZVQ2Rk5BcWdXd0E1NDBJd2ZacEVOa2JRbkNrSGtRbCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTM6Imh0dHA6Ly8xMjcuMC4wLjE6ODEyMy9wYW5lbC9sYXBvcmFuLWtldWFuZ2FuLWRvd25sb2FkIjtzOjU6InJvdXRlIjtOO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo2O30=', 1786332130),
	('NHYng9GN6U74hux1GQqR5VsQOXWYh8q0RxwmujF8', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicTYyMFFkOXJoRkZpalZtMWZNTnJWWlQzWEI3MHlVUmp0TTFydHczeiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1786335935),
	('Oa4s6mpmtmz0JEH7kqLBBO1JeEl5JDyRfVUt54hm', NULL, '127.0.0.1', 'curl/8.18.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiU1Z5UnJjNmUyc2dZeEdRMFhTQ1VQMVpUOUhwSVdkZkdiRVRsZks0RCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODEyMy9sb2dpbiI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1786332047),
	('OBY4twyvlms0KqGUnaatJEZaCnVbOqn5tOJ7r7RG', 7, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRXgzWXRMY2RQUzJkSHd6bU9Lb0hIanlWd2Q3U1E4bEhUTTFUY2s0diI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9wYW5lbC90cmFuc2Frc2kiO3M6NToicm91dGUiO047fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjc7fQ==', 1786339288),
	('ozKVTPeYBb9afoDgb1aJib9despDtmpgvPd6F7xB', NULL, '127.0.0.1', 'curl/8.18.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYzF1MUs0VmUyNElEbzBRWTIxQTlMVjM4VEdGZlRLR1hEUkdQNWxxMSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODEyMy90ZW50YW5nIjtzOjU6InJvdXRlIjtOO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1786332046),
	('pxVg3k3F0Wd1Ia1unyHfCsR2XkKb8byWsSJSTBdu', NULL, '127.0.0.1', 'Mozilla/5.0 (Linux; Android 15; Pixel 9) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Mobile Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiV3pmcmh4N0pEaTRHQnhZRnZOQ1k1eDJUZllJTVhobVcwd0FhSzZPQSI7czo1OiJlcnJvciI7czozMjoiQW5kYSBoYXJ1cyBsb2dpbiB0ZXJsZWJpaCBkYWh1bHUiO3M6NjoiX2ZsYXNoIjthOjI6e3M6MzoibmV3IjthOjA6e31zOjM6Im9sZCI7YToxOntpOjA7czo1OiJlcnJvciI7fX1zOjk6Il9wcmV2aW91cyI7YToyOntzOjM6InVybCI7czozNzoiaHR0cDovL2xvY2FsaG9zdDo4MDAwL3BhbmVsL3RyYW5zYWtzaSI7czo1OiJyb3V0ZSI7Tjt9fQ==', 1786351370),
	('qshvZylxKvEs1106DKFWszV7obFj1nVMg4xlBOdl', 7, '127.0.0.1', 'curl/8.18.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoieGVlMGhtMVZOeHJHZFRjcGJlOUJ1bHJ5TXpseUY3RkFYNmdzSTk2ZSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODEyMy9sb2dpbiI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MTp7aTowO3M6Nzoic3VjY2VzcyI7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NztzOjc6InN1Y2Nlc3MiO3M6MTk6IkFuZGEgYmVyaGFzaWwgbG9naW4iO30=', 1786332888),
	('T13OKp8NiiDXoF5wSk0GcPxOt4epAlSo03uNCrMO', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibWxpN1JrZHQ3TDdDZmZIbmZKcWdkcTFFOEN6RkRnYkFkYzBBV0kybiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1786330760),
	('vtFggl70irQjVROCaOOEo8GZFZQzKzmNldkK9Nl0', NULL, '127.0.0.1', 'curl/8.18.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidGhkQW93Q3ZBalBuejk0MFJDNjFwQTlReEw1N0RWb3pRVzBraGNsTyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODEyMy90ZW50YW5nIjtzOjU6InJvdXRlIjtOO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1786333395),
	('X0XB5XPjq29qhrD3PEwTplF6y4vEa5ZU0tfmCkdd', 8, '127.0.0.1', 'curl/8.18.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiZm1UTXVQblc3eVltRWhZQUMzT1RTeDJxVVBIRmdRdnFhOGtrclR3WCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODEyMy9sb2dpbiI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MTp7aTowO3M6Nzoic3VjY2VzcyI7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6ODtzOjc6InN1Y2Nlc3MiO3M6MTk6IkFuZGEgYmVyaGFzaWwgbG9naW4iO30=', 1786332889),
	('YzuxOJDEvJlOUD1irJPaznL4yu9sHx8E6NbcnD2A', NULL, '127.0.0.1', 'curl/8.18.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNmg2clF3cUlYb2pWOENKcWpOYXZtUmxFQUtEN0c2c29tOUZnclQ1eSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODEyMyI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1786333394);

-- Dumping structure for table laravellaundryapp.status_layanan
CREATE TABLE IF NOT EXISTS `status_layanan` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `layanan_id` bigint NOT NULL,
  `nama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `urutan` int NOT NULL DEFAULT '0',
  `is_default` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table laravellaundryapp.status_layanan: ~12 rows (approximately)
DELETE FROM `status_layanan`;
INSERT INTO `status_layanan` (`id`, `layanan_id`, `nama`, `urutan`, `is_default`, `created_at`, `updated_at`) VALUES
	(1, 1, 'Diterima', 0, 1, '2026-08-10 10:05:30', '2026-08-10 10:05:30'),
	(2, 2, 'Diterima', 0, 1, '2026-08-10 10:05:30', '2026-08-10 10:05:30'),
	(3, 3, 'Diterima', 0, 1, '2026-08-10 10:05:30', '2026-08-10 10:05:30'),
	(4, 1, 'Proses Cuci', 1, 0, '2026-08-10 10:05:30', '2026-08-10 10:47:36'),
	(5, 2, 'Proses Cuci', 1, 0, '2026-08-10 10:05:30', '2026-08-10 10:05:30'),
	(6, 3, 'Proses Cuci', 1, 0, '2026-08-10 10:05:30', '2026-08-10 10:05:30'),
	(7, 1, 'Selesai', 2, 0, '2026-08-10 10:05:30', '2026-08-10 10:47:37'),
	(8, 2, 'Selesai', 2, 0, '2026-08-10 10:05:30', '2026-08-10 10:05:30'),
	(9, 3, 'Selesai', 2, 0, '2026-08-10 10:05:30', '2026-08-10 10:05:30'),
	(10, 1, 'Sudah Diambil', 3, 0, '2026-08-10 10:05:30', '2026-08-10 10:05:30'),
	(11, 2, 'Sudah Diambil', 3, 0, '2026-08-10 10:05:30', '2026-08-10 10:05:30'),
	(12, 3, 'Sudah Diambil', 3, 0, '2026-08-10 10:05:30', '2026-08-10 10:05:30');

-- Dumping structure for table laravellaundryapp.transaksi
CREATE TABLE IF NOT EXISTS `transaksi` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kode_invoice` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `user_id` bigint DEFAULT NULL,
  `nama_pelanggan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `no_hp` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `layanan_id` bigint NOT NULL,
  `nama_layanan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `harga_satuan` decimal(12,2) NOT NULL DEFAULT '0.00',
  `satuan` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'kg',
  `qty` decimal(10,2) NOT NULL DEFAULT '0.00',
  `total` decimal(12,2) NOT NULL DEFAULT '0.00',
  `status_layanan_id` bigint DEFAULT NULL,
  `tanggal_masuk` datetime DEFAULT NULL,
  `estimasi_selesai` date DEFAULT NULL,
  `catatan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `created_by` bigint DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `transaksi_kode_invoice_unique` (`kode_invoice`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table laravellaundryapp.transaksi: ~0 rows (approximately)
DELETE FROM `transaksi`;
INSERT INTO `transaksi` (`id`, `kode_invoice`, `user_id`, `nama_pelanggan`, `no_hp`, `layanan_id`, `nama_layanan`, `harga_satuan`, `satuan`, `qty`, `total`, `status_layanan_id`, `tanggal_masuk`, `estimasi_selesai`, `catatan`, `created_by`, `created_at`, `updated_at`) VALUES
	(4, 'INV6A794ABC64475', 8, 'Fahrul Adib', '089530195148', 2, 'Cuci Setrika', 9000.00, 'kg', 12.00, 108000.00, 5, '2026-08-10 10:51:24', '2026-08-13', NULL, 7, '2026-08-10 10:51:24', '2026-08-10 11:31:08');

-- Dumping structure for table laravellaundryapp.transaksi_status_log
CREATE TABLE IF NOT EXISTS `transaksi_status_log` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `transaksi_id` bigint NOT NULL,
  `status_layanan_id` bigint DEFAULT NULL,
  `nama_status` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `catatan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_by` bigint DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table laravellaundryapp.transaksi_status_log: ~0 rows (approximately)
DELETE FROM `transaksi_status_log`;
INSERT INTO `transaksi_status_log` (`id`, `transaksi_id`, `status_layanan_id`, `nama_status`, `catatan`, `created_by`, `created_at`) VALUES
	(6, 4, 2, 'Diterima', NULL, 7, '2026-08-10 10:51:24'),
	(7, 4, 5, 'Proses Cuci', NULL, 7, '2026-08-10 11:31:08');

-- Dumping structure for table laravellaundryapp.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `role` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Pelanggan',
  `no_wa` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table laravellaundryapp.users: ~0 rows (approximately)
DELETE FROM `users`;
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `role`, `no_wa`, `foto`, `created_at`, `updated_at`) VALUES
	(1, 'Administrator', 'pemilik@gmail.com', NULL, '$2y$12$087bX.nQs87c4Wp5z9uXJeL4OllMwDu.VTtVkBIKIBJJxOnEbVDYe', NULL, 'Pemilik', '082212345678', NULL, '2026-08-03 11:06:08', '2026-08-10 03:25:57'),
	(7, 'Karyawan', 'karyawan@gmail.com', NULL, '$2y$12$7wsue3IHasmn.LoyknVb9uSTnJpfdSI2s6rU/w0wvlPg6C4urp4.S', NULL, 'Karyawan', '082212345679', NULL, '2026-08-10 03:25:57', '2026-08-10 03:25:57'),
	(8, 'Fahrul Adib', 'fahruladib9@gmail.com', NULL, '$2y$12$aNh2bpc1WOERxBNzS.nhHuG7Uoesf12v.5Q4RP1Yj7Jngh1e5qn86', NULL, 'Pelanggan', '089530195148', NULL, '2026-08-10 03:25:58', '2026-08-10 05:17:18');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

curl -s https://co.agentrouter.org/v1/models \
  -H "Authorization: Bearer "
curl -s https://co.agentrouter.org/v1/models \
  -H "Authorization: Bearer sk-T4ID5lthRk1XluBxi4JBR5WBAd099TYDGoZPHS1WKjXaXhlp" \
  | jq -r '.data[].id'
