# ************************************************************
# Sequel Pro SQL dump
# Version 5446
#
# https://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 8.0.19)
# Database: fairwalter-project
# Generation Time: 2021-01-20 11:21:31 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table doctrine_migration_versions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `doctrine_migration_versions`;

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `doctrine_migration_versions` WRITE;
/*!40000 ALTER TABLE `doctrine_migration_versions` DISABLE KEYS */;

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`)
VALUES
	('DoctrineMigrations\\Version20210120051354','2021-01-20 05:13:57',67),
	('DoctrineMigrations\\Version20210120084727','2021-01-20 08:47:30',64);

/*!40000 ALTER TABLE `doctrine_migration_versions` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table rental_contract
# ------------------------------------------------------------

DROP TABLE IF EXISTS `rental_contract`;

CREATE TABLE `rental_contract` (
  `id` int NOT NULL AUTO_INCREMENT,
  `rental_object_id` int NOT NULL,
  `start_at` date NOT NULL,
  `finish_at` date NOT NULL,
  `residents` varchar(3000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parties` varchar(3000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D9E9316A9CCD5124` (`rental_object_id`),
  CONSTRAINT `FK_D9E9316A9CCD5124` FOREIGN KEY (`rental_object_id`) REFERENCES `rental_object` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `rental_contract` WRITE;
/*!40000 ALTER TABLE `rental_contract` DISABLE KEYS */;

INSERT INTO `rental_contract` (`id`, `rental_object_id`, `start_at`, `finish_at`, `residents`, `parties`)
VALUES
	(13,1,'2021-01-03','2021-01-07','[\"Danny Ocean\",\"Rusty Ryan\",\"Linus Caldwell\"]','[\"Reuben Tishkoff\"]'),
	(14,1,'2021-01-10','2021-01-14','[\"Saul Bloom\",\"Basher Tarr\",\"Frank Catton\"]','[\"Livingston Dell\"]');

/*!40000 ALTER TABLE `rental_contract` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table rental_object
# ------------------------------------------------------------

DROP TABLE IF EXISTS `rental_object`;

CREATE TABLE `rental_object` (
  `id` int NOT NULL AUTO_INCREMENT,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `rental_object` WRITE;
/*!40000 ALTER TABLE `rental_object` DISABLE KEYS */;

INSERT INTO `rental_object` (`id`, `country`, `city`, `address`, `name`)
VALUES
	(1,'USA.','Washington DC','1600 Pennsylvania Avenue','Small white apartments'),
	(2,'USA','New York','11 Wall Street','Introvert\'s best choice'),
	(3,'England','London','221B Baker Street','Few interesting neighboors here'),
	(4,'USA','Gotham City','Wayne Manor','Hero\'s apartments'),
	(5,'USA','Quahog','31 Spooner Street','Surfing Bird\'s apartment'),
	(6,'USA','Wilmington','420 Paper St','Jack\'s apartment');

/*!40000 ALTER TABLE `rental_object` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
