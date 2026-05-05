/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

DROP TABLE IF EXISTS `applicants`;
CREATE TABLE IF NOT EXISTS `applicants` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `registration_number` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `full_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `emergency_contact_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `emergency_contact_phone` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `place_of_birth` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `date_of_birth` date NOT NULL,
  `gender` enum('male','female') COLLATE utf8mb4_general_ci NOT NULL,
  `height` int DEFAULT NULL,
  `blood_type` enum('A','B','AB','O') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_number` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `home_address` text COLLATE utf8mb4_general_ci NOT NULL,
  `mailing_address` text COLLATE utf8mb4_general_ci NOT NULL,
  `country` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `program_level` enum('master','doctoral') COLLATE utf8mb4_general_ci NOT NULL,
  `study_program` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `available_days` json NOT NULL,
  `last_university` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `toefl_toafl_score` decimal(5,2) DEFAULT NULL,
  `occupation` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `marital_status` enum('single','married','widowed','divorced') COLLATE utf8mb4_general_ci NOT NULL,
  `documents_path` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `file_size_mb` decimal(5,2) NOT NULL,
  `payment_va` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `payment_status` enum('pending','paid','verified') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'pending',
  `application_status` enum('draft','submitted','reviewed','accepted','rejected') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'draft',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `registration_number` (`registration_number`),
  KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `applicants` (`id`, `registration_number`, `full_name`, `email`, `phone`, `emergency_contact_name`, `emergency_contact_phone`, `place_of_birth`, `date_of_birth`, `gender`, `height`, `blood_type`, `id_number`, `home_address`, `mailing_address`, `country`, `program_level`, `study_program`, `available_days`, `last_university`, `toefl_toafl_score`, `occupation`, `marital_status`, `documents_path`, `file_size_mb`, `payment_va`, `payment_status`, `application_status`, `created_at`, `updated_at`) VALUES
	(1, 'REG-TEST-001', 'John Doe Test', 'test@example.com', '+628123456789', 'Jane Doe', '+628987654321', 'Bandar Lampung', '1995-05-15', 'male', 175, 'O', '3371011234567890', 'Jl. ZA Pagar Alam No. 15, Bandar Lampung', 'Jl. ZA Pagar Alam No. 15, Bandar Lampung', 'Indonesia', 'master', 'Islamic Economics', '["Monday", "Wednesday", "Friday"]', 'UIN Raden Intan Lampung', 520.50, 'Private Employee', 'single', 'uploads/documents/test_docs.zip', 15.20, '88290112345678', 'pending', 'rejected', '2026-05-04 08:52:51', '2026-05-05 08:46:00'),
	(2, 'REG-2026-4D99B9CE', 'Anindito Yoga Respati', 'anindito@gmail.com', '08179836995', 'diyah', '08123456789', 'jakarta', '1976-12-19', 'male', 167, 'B', '3175081912760008', 'permat abogor residence 2 bogor', 'jl malaka ii jakarta barat', 'Afghanistan', 'master', 'Islamic Economics', '["Monday", "Saturday"]', 'UNIV GUNADARMA', 125.00, 'Private Employee', 'married', 'uploads/documents/1777888158_510a8f663e7ee337afb0.zip', 1.41, '88290168445483', 'pending', 'submitted', '2026-05-04 09:49:18', '2026-05-04 09:49:18');

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `version` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `class` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `group` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `namespace` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `time` int NOT NULL,
  `batch` int unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
	(1, '20240101000001', 'App\\Database\\Migrations\\CreateApplicantsTable', 'default', 'App', 1777884463, 1),
	(2, '2026-05-05-062158', 'App\\Database\\Migrations\\CreateUserAdminTable', 'default', 'App', 1777962203, 2);

DROP TABLE IF EXISTS `useradmin`;
CREATE TABLE IF NOT EXISTS `useradmin` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `useradmin` (`id`, `username`, `password`, `email`, `full_name`, `is_active`, `created_at`, `updated_at`) VALUES
	(1, 'admin', '$2y$10$qZqlBwPP01NmUqB.gXI4jezgQaP6g5ZIHrpUK474yXtLIolCbLqUy', 'admin@daftars2s3.com', 'Administrator', 1, '2026-05-05 06:24:03', '2026-05-05 06:24:03');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
