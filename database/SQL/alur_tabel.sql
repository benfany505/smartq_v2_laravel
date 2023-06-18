-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.33 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table smartq_v2.alurs
DROP TABLE IF EXISTS `alurs`;
CREATE TABLE IF NOT EXISTS `alurs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `list_loket` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `list_layanan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `list_transfer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table smartq_v2.alurs: ~8 rows (approximately)
/*!40000 ALTER TABLE `alurs` DISABLE KEYS */;
INSERT INTO `alurs` (`id`, `nama`, `list_loket`, `list_layanan`, `list_transfer`, `keterangan`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_by`, `deleted_at`) VALUES
	(14, '1', '1', 'A', '3,4,5,6,7,8,99', 'AWAL', 1, 'etn', 'etn', '2023-04-08 14:41:18', '2023-04-08 14:44:57', NULL, NULL),
	(15, '1', '2', 'B', '3,4,5,6,7,8,99', 'AWAL', 1, 'etn', NULL, '2023-04-08 14:45:14', '2023-04-08 14:45:14', NULL, NULL),
	(16, '2', '3', 'A', '5,6,7,8,99', 'TENGAH', 1, 'etn', NULL, '2023-04-08 14:45:48', '2023-04-08 14:45:48', NULL, NULL),
	(17, '2', '4', 'B', '5,6,7,8,99', 'TENGAH', 1, 'etn', NULL, '2023-04-08 14:46:07', '2023-04-08 14:46:07', NULL, NULL),
	(18, '2', '5', 'A,B', '7,8,99', 'TENGAH', 1, 'etn', NULL, '2023-04-08 14:46:46', '2023-04-08 14:46:46', NULL, NULL),
	(19, '2', '6', 'A,B', '7,8,99', 'TENGAH', 1, 'etn', NULL, '2023-04-08 14:47:04', '2023-04-08 14:47:04', NULL, NULL),
	(20, '2', '7', 'A,B', '3,4,5,6,7,8,99', 'TENGAH', 1, 'etn', NULL, '2023-04-08 14:47:39', '2023-04-08 14:47:39', NULL, NULL),
	(22, '3', '8', 'A,B', '99', 'AKHIR', 1, 'etn', NULL, '2023-04-08 15:15:34', '2023-04-08 15:15:34', NULL, NULL);
/*!40000 ALTER TABLE `alurs` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
