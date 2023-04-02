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

-- Dumping structure for table etn_invoice_laravel.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table etn_invoice_laravel.failed_jobs: ~0 rows (approximately)
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

-- Dumping structure for table etn_invoice_laravel.invoices
CREATE TABLE IF NOT EXISTS `invoices` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `invoice_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `due_date` date DEFAULT NULL,
  `date_paid` datetime DEFAULT NULL,
  `discount` decimal(3,2) DEFAULT '0.00',
  `discount_value` decimal(3,2) DEFAULT '0.00',
  `tax` decimal(3,2) DEFAULT '0.00',
  `subtotal` decimal(16,2) DEFAULT '0.00',
  `total` decimal(16,2) DEFAULT '0.00',
  `credit` decimal(16,2) DEFAULT '0.00',
  `discount_type` enum('p','t') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vtoken` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ptoken` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('p','t') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `header` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `footer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table etn_invoice_laravel.invoices: ~9 rows (approximately)
/*!40000 ALTER TABLE `invoices` DISABLE KEYS */;
INSERT INTO `invoices` (`id`, `invoice_number`, `title`, `account`, `date`, `due_date`, `date_paid`, `discount`, `discount_value`, `tax`, `subtotal`, `total`, `credit`, `discount_type`, `vtoken`, `ptoken`, `status`, `header`, `footer`, `notes`, `user_id`, `created_at`, `updated_at`) VALUES
	(1, 'INV-202206-UNIKU-0001', 'PENGADAAN BARANG DAN JASA INSTALASI LISTRIK', 'UNIKU', '2022-06-01', '2022-06-07', NULL, 0.00, 0.00, 0.00, 1250000.00, 1250000.00, NULL, 'p', 'FQBNx0kWq', 'goujOn1wU', 'p', 'Ini adalah header', 'Ini Adalah footer', 'Ini Adalah Notes', 'benfany@gmail.com', '2022-06-01 07:09:30', '2022-06-01 07:09:30'),
	(3, 'INV-202206-RAMA-0001', 'PENGADAAN BARANG DAN JASA INSTALASI LISTRIK', 'RAMA', '2022-06-01', '2022-06-07', NULL, 0.00, 0.00, 0.00, 1250000.00, 1250000.00, NULL, 'p', 'thiK56wLa', 'p7ogah15d', 'p', 'Ini adalah header', 'Ini Adalah footer', 'Ini Adalah Notes', 'benfany@gmail.com', '2022-06-01 07:13:18', '2022-06-01 07:13:18'),
	(4, 'INV-202206-UNIKU-0002', 'PENGADAAN BARANG DAN JASA INSTALASI LISTRIK', 'UNIKU', '2022-06-01', '2022-06-07', NULL, 0.00, 0.00, 0.00, 1250000.00, 1250000.00, NULL, 'p', 'bu0NSAlev', 'PpSR5Chsk', 'p', 'Ini adalah header', 'Ini Adalah footer', 'Ini Adalah Notes', 'benfany@gmail.com', '2022-06-01 07:13:47', '2022-06-01 07:13:47'),
	(5, 'INV-202206-UNIKU-0003', 'PENGADAAN BARANG DAN JASA INSTALASI LISTRIK', 'UNIKU', '2022-06-01', '2022-06-07', NULL, 0.00, 0.00, 0.00, 1250000.00, 1250000.00, NULL, 'p', 'nAHsegoLi', '1AOeyYN36', 'p', 'Ini adalah header', 'Ini Adalah footer', 'Ini Adalah Notes', 'benfany@gmail.com', '2022-06-01 07:13:58', '2022-06-01 07:13:58'),
	(6, 'INV-202206-UNIKU-0004', 'PENGADAAN BARANG DAN JASA INSTALASI LISTRIK', 'UNIKU', '2022-06-01', '2022-06-07', NULL, 0.00, 0.00, 0.00, 1250000.00, 1250000.00, NULL, 'p', 'aBjNW3G5N', '1OVuZQwQt', 'p', 'Ini adalah header', 'Ini Adalah footer', 'Ini Adalah Notes', 'benfany@gmail.com', '2022-06-01 07:13:59', '2022-06-01 07:13:59'),
	(7, 'INV-202206-RAMA-0002', 'PENGADAAN BARANG DAN JASA INSTALASI LISTRIK', 'RAMA', '2022-06-01', '2022-06-07', NULL, 0.00, 0.00, 0.00, 1250000.00, 1250000.00, NULL, 'p', 'YEDeIKezr', '5ofEnpEcW', 'p', 'Ini adalah header', 'Ini Adalah footer', 'Ini Adalah Notes', 'benfany@gmail.com', '2022-06-01 07:14:08', '2022-06-01 07:14:08'),
	(9, 'INV-202206-RAMA-0004', 'PENGADAAN BARANG DAN JASA INSTALASI LISTRIK', 'RAMA', '2022-06-01', '2022-06-07', NULL, 0.00, 0.00, 0.00, 1250000.00, 1250000.00, NULL, 'p', 'Vg5J64pfu', 'wPCEJwg54', 'p', 'Ini adalah header', 'Ini Adalah footer', 'Ini Adalah Notes', 'benfany@gmail.com', '2022-06-01 07:14:32', '2022-06-01 07:14:32'),
	(10, 'INV-202206-RAMA-0005', 'PENGADAAN BARANG DAN JASA INSTALASI LISTRIK', 'RAMA', '2022-06-01', '2022-06-07', NULL, 0.00, 0.00, 0.00, 1250000.00, 1250000.00, NULL, 'p', 'ssfKsZWTl', 'LyTXQgrvq', 'p', 'Ini adalah header', 'Ini Adalah footer', 'Ini Adalah Notes', 'benfany@gmail.com', '2022-06-01 07:15:01', '2022-06-01 07:15:01'),
	(11, 'INV-202206-RAMA-0006', 'PENGADAAN BARANG DAN JASA INSTALASI INTERNET', 'RAMA', '2022-06-01', '2022-06-07', NULL, 0.00, 0.00, 0.00, 1250000.00, 1250000.00, 0.00, 'p', '2WP7vjIMR', 'wstP63WOw', 'p', 'Ini adalah header', 'Ini Adalah footer', 'Ini Adalah Notes', 'benfany@gmail.com', '2022-06-01 07:24:03', '2022-06-01 07:46:32');
/*!40000 ALTER TABLE `invoices` ENABLE KEYS */;

-- Dumping structure for table etn_invoice_laravel.invoice_details
CREATE TABLE IF NOT EXISTS `invoice_details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `invoice_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_item` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` decimal(4,2) DEFAULT '0.00',
  `price` decimal(16,2) DEFAULT '0.00',
  `unit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'pcs',
  `ammount` decimal(16,2) DEFAULT '0.00',
  `is_tax` tinyint(1) DEFAULT '0',
  `tax_ammount` decimal(16,2) DEFAULT '0.00',
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table etn_invoice_laravel.invoice_details: ~4 rows (approximately)
/*!40000 ALTER TABLE `invoice_details` DISABLE KEYS */;
INSERT INTO `invoice_details` (`id`, `invoice_number`, `type`, `subid`, `sub_title`, `id_item`, `desc`, `name`, `brand`, `qty`, `price`, `unit`, `ammount`, `is_tax`, `tax_ammount`, `user_id`, `created_at`, `updated_at`) VALUES
	(1, 'INV-202206-UNIKU-0001', '3x1.5 mm²', '1', 'Material', 'B-0001', 'Kabel Eterna Roll', 'NYM 3x1.5 mm²', 'ETERNA', 1.00, 685000.00, 'roll', 685000.00, 0, 0.00, 'benfany@gmail.com', '2022-06-01 14:50:13', '2022-06-01 14:50:13'),
	(2, 'INV-202206-UNIKU-0001', '2x10 mm²', '1', 'Material', 'B-0001', 'Kabel Twist SR 2x10 mm² SUPREME SNI', 'TWIST SR 2x10 mm²', 'SUPREME', 1.00, 685000.00, 'roll', 685000.00, 0, 0.00, 'benfany@gmail.com', '2022-06-01 14:50:13', '2022-06-01 14:50:13'),
	(3, 'INV-202206-UNIKU-0001', '<1PK', '1', 'Jasa', 'B-0002', 'Instalasi AC Dibawah 1 PK Std', 'Instalasi AC <1PK std', 'ETN', 1.00, 350000.00, 'roll', 350000.00, 0, 0.00, 'benfany@gmail.com', '2022-06-01 14:53:16', '2022-06-01 14:53:16'),
	(4, 'INV-202206-UNIKU-0001', 'Non Lem', '1', 'Material', 'B-0002', 'Daktip AC Non Lem', 'Daktip AC', 'ARTIC', 2.00, 25000.00, 'roll', 50000.00, 0, 0.00, 'benfany@gmail.com', '2022-06-01 14:53:16', '2022-06-01 14:53:16');
/*!40000 ALTER TABLE `invoice_details` ENABLE KEYS */;

-- Dumping structure for table etn_invoice_laravel.items
CREATE TABLE IF NOT EXISTS `items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_item` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(16,2) DEFAULT '0.00',
  `unit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table etn_invoice_laravel.items: ~22 rows (approximately)
/*!40000 ALTER TABLE `items` DISABLE KEYS */;
INSERT INTO `items` (`id`, `id_item`, `desc`, `name`, `type`, `brand`, `price`, `unit`, `category`, `status`, `user_id`, `created_at`, `updated_at`) VALUES
	(1, 'B-0001', 'Kabel Eterna Roll', 'NYM 3x1.5 mm²', '3x1.5 mm²', 'ETERNA', 685000.00, 'roll', 'Kabel NYM SNI', '1', 'benfany@gmail.com', '2022-06-01 04:22:57', '2022-06-01 04:39:27'),
	(7, 'B-0002', 'Kabel Eterna Roll', 'NYM 3x2.5 mm²', '3x2.5 mm²', 'ETERNA', 975000.00, 'roll', 'Kabel NYM SNI', '1', 'benfany@gmail.com', '2022-06-01 04:39:50', '2022-06-01 04:39:50'),
	(8, 'B-0003', 'Kabel Twist SR 2x10 mm² SUPREME SNI', 'TWIST SR 2x10 mm²', '2x10 mm²', 'SUPREME', 10000.00, 'mtr', 'Kabel TWIST SNI', '1', 'benfany@gmail.com', '2022-06-01 06:04:38', '2022-06-01 06:04:38'),
	(9, 'B-0004', 'Instalasi AC Dibawah 1 PK Std', 'Instalasi AC <1PK std', '<1PK', 'ETN', 350000.00, 'unit', 'INSTALASI', '1', 'benfany@gmail.com', '2022-06-01 06:10:48', '2022-06-01 06:10:48'),
	(10, 'B-0005', 'Instalasi AC Dibawah 1 PK Std', 'Instalasi AC <1PK std', '<1PK', 'ETN', 350000.00, 'unit', 'INSTALASI', '1', 'benfany@gmail.com', '2022-06-01 06:11:44', '2022-06-01 06:11:44'),
	(11, 'B-0006', 'sdasdas', 'sadsdas', '54313151315', 'ETERNA', 13456789.00, 'pcs', 'sdasdas', '1', 'benfany.aditia@gmail.com', '2022-06-05 06:27:58', '2022-06-05 06:27:58'),
	(12, 'B-0007', 'sdasdas', 'sadsdas', '54313151315', 'ETERNA', 13456789.00, 'pcs', 'sdasdas', '1', 'benfany.aditia@gmail.com', '2022-06-05 06:28:15', '2022-06-05 06:28:15'),
	(13, 'B-0008', 'sdasdas', 'sadsdas', '54313151315', 'ETERNA', 13456789.00, 'pcs', 'sdasdas', '1', 'benfany.aditia@gmail.com', '2022-06-05 06:29:02', '2022-06-05 06:29:02'),
	(14, 'B-0009', 'sdasdas', 'sadsdas', '54313151315', 'ETERNA', 13456789.00, 'pcs', 'sdasdas', '1', 'benfany.aditia@gmail.com', '2022-06-05 06:29:15', '2022-06-05 06:29:15'),
	(15, 'B-0010', 'Kabel Lan CAT-6 Belden', 'Kabel LAN CAT-6 Belden', 'Kabel LAN CAT-6', 'BELDEN', 8000.00, 'mtr', 'KABEL JARINGAN', '1', 'benfany.aditia@gmail.com', '2022-06-05 06:30:25', '2022-06-05 06:30:25'),
	(16, 'B-0011', 'sasdsd', 'sadsdas', 'sdfd', 'ETERNA', 454824.00, 'pcs', 'asdsds', '1', 'benfany.aditia@gmail.com', '2022-06-05 06:38:29', '2022-06-05 06:38:29'),
	(17, 'B-0012', 'fdsgfd', 'sdffds', '54313151315', 'ETERNA', 78945.00, 'pcs', 'dfgfdg', '1', 'benfany.aditia@gmail.com', '2022-06-05 06:43:37', '2022-06-05 06:43:37'),
	(18, 'B-0013', 'sdasdas', 'sadsdas', '54313151315', 'SUPREME', 54654.00, 'pcs', 'sdasd', '1', 'benfany.aditia@gmail.com', '2022-06-05 06:46:11', '2022-06-05 06:46:11'),
	(19, 'B-0014', 'sdasdas', 'sadsdas', '54313151315', 'ETERNA', 454545.00, 'mtr', 'sdasdas', '1', 'benfany.aditia@gmail.com', '2022-06-05 06:46:54', '2022-06-05 06:46:54'),
	(20, 'B-0015', 'sdasd', 'sadsdas', '54313151315', 'ETERNA', 456454.00, 'pcs', 'sdasdas', '1', 'benfany.aditia@gmail.com', '2022-06-05 06:48:03', '2022-06-05 06:48:03'),
	(21, 'B-0016', 'sdads', 'sdasd', 'asdasd', 'ETERNA', 45654.00, 'pcs', 'sdasd', '1', 'benfany.aditia@gmail.com', '2022-06-05 07:00:24', '2022-06-05 07:00:24'),
	(22, 'B-0017', 'fdsfd', 'sdasda', '54313151315', 'ETERNA', 564564.00, 'pcs', 'sdfsdf', '1', 'benfany.aditia@gmail.com', '2022-06-05 07:03:20', '2022-06-05 07:03:20'),
	(23, 'B-0018', 'sdasd', 'sadsdas', '54313151315', 'ETERNA', 16354564.00, 'pcs', 'sdasdas', '1', 'benfany.aditia@gmail.com', '2022-06-05 07:12:36', '2022-06-05 07:12:36'),
	(24, 'B-0019', 'sdasd', 'sadsdas', '54313151315', 'ETERNA', 5616541.00, 'mtr', 'sdasdas', '1', 'benfany.aditia@gmail.com', '2022-06-05 07:16:49', '2022-06-05 07:16:49'),
	(25, 'B-0020', 'sdasd', 'sadsdas', '54313151315', 'ETERNA', 588285.00, 'pcs', 'gdfgdfgd', '1', 'benfany.aditia@gmail.com', '2022-06-05 07:19:21', '2022-06-05 07:19:21'),
	(26, 'B-0021', 'sdasdas', 'sadsdas', '54313151315', 'ETERNA', 78974.00, 'pcs', '45464', '1', 'benfany.aditia@gmail.com', '2022-06-05 07:26:43', '2022-06-05 07:26:43'),
	(27, 'B-0022', 'asdasd', 'sdasd', '54313151315', 'ETERNA', 523453.00, 'pcs', '453453453', '1', 'benfany.aditia@gmail.com', '2022-06-05 07:27:27', '2022-06-05 07:27:27'),
	(28, 'B-0023', 'sadafds', 'sdasda', '54313151315', 'ETERNA', 453453.00, 'pcs', '456456', '1', 'benfany.aditia@gmail.com', '2022-06-05 07:28:01', '2022-06-05 07:28:01'),
	(29, 'B-0024', 'fdsfd', 'sadsads', 'gfdgfh', 'ETERNA', 864151.00, 'pcs', 'sdasdas', '1', 'benfany.aditia@gmail.com', '2022-06-05 07:28:40', '2022-06-05 07:28:40'),
	(30, 'B-0025', 'gfdgfh', 'dfsdf', 'ghgfjh', 'ETERNA', 3423423.00, 'pcs', 'sdfsdf', '1', 'benfany.aditia@gmail.com', '2022-06-05 07:29:10', '2022-06-05 07:29:10');
/*!40000 ALTER TABLE `items` ENABLE KEYS */;

-- Dumping structure for table etn_invoice_laravel.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table etn_invoice_laravel.migrations: ~8 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(5, '2022_05_30_063844_create_items_table', 1),
	(6, '2022_05_30_064016_create_services_table', 1),
	(7, '2022_05_30_064251_create_invoices_table', 1),
	(8, '2022_05_30_072255_create_invoice_details_table', 1),
	(9, '2022_06_01_071855_delete_id_invoice_to_invoices_table', 2),
	(10, '2022_06_01_075159_rename_id_invoice_to_invoice_number_in_invoice_table', 3);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table etn_invoice_laravel.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table etn_invoice_laravel.password_resets: ~0 rows (approximately)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Dumping structure for table etn_invoice_laravel.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table etn_invoice_laravel.personal_access_tokens: ~2 rows (approximately)
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `created_at`, `updated_at`) VALUES
	(1, 'App\\Models\\User', 1, 'MyApp', 'dbfdec1e692b40ffaf2c9fc413eb429d9b5f6ef7287af088391dbae87810ae5c', '["*"]', NULL, '2022-05-31 15:58:50', '2022-05-31 15:58:50'),
	(2, 'App\\Models\\User', 1, 'MyApp', 'b509d5adb6688d808a53b1535fe7e23b345a90eb02616b34edcac2c283bda86f', '["*"]', NULL, '2022-05-31 15:59:23', '2022-05-31 15:59:23');
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;

-- Dumping structure for table etn_invoice_laravel.services
CREATE TABLE IF NOT EXISTS `services` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_service` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(16,2) DEFAULT '0.00',
  `unit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table etn_invoice_laravel.services: ~2 rows (approximately)
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
INSERT INTO `services` (`id`, `id_service`, `desc`, `name`, `type`, `brand`, `price`, `unit`, `category`, `status`, `user_id`, `created_at`, `updated_at`) VALUES
	(1, 'S-0001', 'Instalasi AC Dibawah 1 PK Std', 'Instalasi AC <1PK std', '<1PK', 'ETN', 350000.00, 'unit', 'INSTALASI', '1', 'benfany@gmail.com', '2022-06-01 06:15:08', '2022-06-01 06:15:08'),
	(2, 'S-0002', 'Instalasi AC Dibawah 1 PK Lt2', 'Instalasi AC <1PK Lt2', '<1PK Lt2', 'ETN', 450000.00, 'unit', 'INSTALASI', '1', 'benfany@gmail.com', '2022-06-01 06:15:51', '2022-06-01 06:20:19'),
	(4, 'S-0003', 'Instalasi AC Dibawah 1 PK Lt2', 'Instalasi AC <1PK Lt2', '<1PK', 'ETN', 450000.00, 'unit', 'INSTALASI', '1', 'benfany@gmail.com', '2022-06-01 07:13:13', '2022-06-01 07:13:13');
/*!40000 ALTER TABLE `services` ENABLE KEYS */;

-- Dumping structure for table etn_invoice_laravel.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table etn_invoice_laravel.users: ~6 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Benfany', 'benfany@gmail.com', 'administrator', NULL, '$2y$10$XJrtNFaodW0YXRpHhfDW5eJqvsvKr4A2LDUK253YpUJ6dDp/dQ.3a', NULL, '2022-05-31 14:03:16', '2022-05-31 14:03:16'),
	(2, 'reechele', 'benfany.aditia@gmail.com', 'administrator', NULL, '$2y$10$t4w0T/qh1REm3IrYc5fLfOKA2Sz6rGxQt2Gp1rgzL5cXz/xON1FvG', NULL, '2022-05-31 14:17:15', '2022-06-01 03:56:27'),
	(3, 'benfany', 'benfany.aditiaa@gmail.com', 'administrator', NULL, '$2y$10$BPreGZMHsYtiuZklXhM6zehURUZ6WJF7F2R20J7lYytxzpQwYzU4i', NULL, '2022-05-31 14:18:24', '2022-05-31 14:18:24'),
	(4, 'rayyan', 'benfany.aditiaasss@gmail.com', 'user', NULL, '$2y$10$NTWJs4AsYYcWovCiXsU9XeXQ4CBiWVjiJnKCLksxi2auvgnfgezDS', NULL, '2022-05-31 15:50:12', '2022-05-31 15:50:12'),
	(5, 'sss', 'benfany.ssdsddsdsd@gmail.com', 'user', NULL, '$2y$10$FhW4lBo3pTMgTHZihzJYrOeq1ZVekxUOlQ5yws.kTUyvqvDS0kgWC', NULL, '2022-06-01 03:51:52', '2022-06-01 03:51:52');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
