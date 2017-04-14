# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.5.5-10.1.21-MariaDB)
# Database: electrop
# Generation Time: 2017-04-14 15:19:06 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table admin
# ------------------------------------------------------------

DROP TABLE IF EXISTS `admin`;

CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;

INSERT INTO `admin` (`id`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`)
VALUES
	(7,'DxKkH2hGDkUj5L2LnB8qrMVLkGFAT82M','$2y$13$D92/maDAYUX2W.25sYURRecRl4TvGpEPvgzqzQosMwiHJO6jymLji','jGCqlkpYD0UQNSodS-yMSvIoqyA5aF_p_1489764767','admin@admin.com',10,17,17),
	(11,'FHRGKaaqo4ZvDlZPPMmkIqxtdGZBziVF','$2y$13$c4TudIrJOXWkJ4xh57618OHd60g1CFcmv7f.iy8JCH4F2JJPPRfvi','NUHKloHkVlA29Y_xv5MQ0IVgu4Njkm7-_1491401476','mystery_Person@outlook.com',10,1491401476,1491401476),
	(12,'1S7DtEdLYr6nPAGhi6RF4Lh0uXcOcHP3','$2y$13$hM6YRXG7bVCXtqu1lHFVp.QXfS/5Smu5.zAue2p0cieOOR1FRnnLC','LMCl8U9Dg_NhU12X5r1YwhSipC4JCpjc_1491862929','bryan@lindo.edu',10,1491862929,1491878050);

/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table contains
# ------------------------------------------------------------

DROP TABLE IF EXISTS `contains`;

CREATE TABLE `contains` (
  `order_number` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `price_sold` decimal(4,2) NOT NULL,
  `quantity_in_order` int(11) NOT NULL,
  PRIMARY KEY (`order_number`,`item_id`),
  KEY `item_id` (`item_id`),
  CONSTRAINT `contains_ibfk_1` FOREIGN KEY (`order_number`) REFERENCES `order` (`order_number`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `contains_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `contains` WRITE;
/*!40000 ALTER TABLE `contains` DISABLE KEYS */;

INSERT INTO `contains` (`order_number`, `item_id`, `price_sold`, `quantity_in_order`)
VALUES
	(1,4,1.35,3),
	(2,5,2.00,10),
	(3,9,3.45,10);

/*!40000 ALTER TABLE `contains` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table customer
# ------------------------------------------------------------

DROP TABLE IF EXISTS `customer`;

CREATE TABLE `customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(18) COLLATE utf8_unicode_ci NOT NULL,
  `middle_name` varchar(18) COLLATE utf8_unicode_ci NOT NULL,
  `fathers_last_name` varchar(18) COLLATE utf8_unicode_ci NOT NULL,
  `mothers_last_name` varchar(18) COLLATE utf8_unicode_ci NOT NULL,
  `date_of_birth` int(8) NOT NULL,
  `age` int(2) DEFAULT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `active` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `customer` WRITE;
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;

INSERT INTO `customer` (`id`, `email`, `password_hash`, `first_name`, `middle_name`, `fathers_last_name`, `mothers_last_name`, `date_of_birth`, `age`, `auth_key`, `password_reset_token`, `status`, `created_at`, `updated_at`, `active`)
VALUES
	(11,'angel.santiago31@upr.edu','$2y$13$FRoVVuY51PeOSprQgXqxyOoT3a6uZdODj4uqmsAd0Y9WFzWrHnU/O','','Eduardo','Santiago','González',10,NULL,'i76U4HtSj5hRm19MRcV3zpXw9I0uFRhM',NULL,10,1491411798,1491411798,0),
	(13,'culo@nalguita.com','$2y$13$skvggkWhUoiLH8YhkoC5c.S/PXtJ1DdtM8uz6iqKwHITB7Hmdf5le','Nalguita','NegraLoca','Martinica','Rodriguez',11,NULL,'33Ym4-Yt9BJcYlFtJJgInpgcQxg2S_t0',NULL,10,1491862426,1491949514,0),
	(14,'bryan@otro.com','$2y$13$AOKj0c76KtSnhS7lXckGM.ywAkc7Rv3TT.jMZcCwayV6ns2G/DUR.','Bryan','Yomar','Hernandez','Cuevas',10,NULL,'g08t4duBKPt7gnv6qcdel9710eJhCZ01',NULL,10,1492125119,1492125119,0),
	(15,'ndknd@sklmc.com','$2y$13$hCxUMQsJI91P5QU2qurb1.daO6WQp0JFfBXd9me3w3h7OIAOnzwGW','lksdmv','dklmv','ldml','dlmkl',2,NULL,'mcvJKV5CJDZx38e4cE_PcijlZj7NnM7P',NULL,10,1492125228,1492125228,0),
	(16,'aaaa@hotmail.com','$2y$13$PZ5vai0G36h7BRwm/CjTMutoo5iHED.hDa/EpD3mYh.WyunF3Ax3W','kldsnklds','lskdnvlk','dlvlkdn','dlkvlks',92,NULL,'P0Jts_jnSthz7_h3DoBLfWpQ09Db7eGG',NULL,10,1492125471,1492125471,0);

/*!40000 ALTER TABLE `customer` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table item
# ------------------------------------------------------------

DROP TABLE IF EXISTS `item`;

CREATE TABLE `item` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `picture` varchar(256) NOT NULL,
  `quantity_remaining` int(11) NOT NULL,
  `size` varchar(32) NOT NULL,
  `gross_price` decimal(4,2) NOT NULL,
  `production_cost` decimal(4,2) NOT NULL,
  `description` varchar(32) NOT NULL,
  `item_category_id` int(11) NOT NULL,
  `item_sub_category_id` int(11) NOT NULL,
  `active` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`item_id`),
  KEY `item_category_id` (`item_category_id`),
  KEY `item_sub_category_id` (`item_sub_category_id`),
  CONSTRAINT `item_ibfk_1` FOREIGN KEY (`item_category_id`) REFERENCES `item_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `item_ibfk_2` FOREIGN KEY (`item_sub_category_id`) REFERENCES `item_sub_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `item` WRITE;
/*!40000 ALTER TABLE `item` DISABLE KEYS */;

INSERT INTO `item` (`item_id`, `name`, `picture`, `quantity_remaining`, `size`, `gross_price`, `production_cost`, `description`, `item_category_id`, `item_sub_category_id`, `active`)
VALUES
	(4,'Firebreathing King','uploads/Firebreathing King.jpg',10,'3 Inches',1.35,0.20,'A king with an unusual human app',1,4,1),
	(5,'To Breakfast!','uploads/To Breakfast!.jpg',10,'4 Inches',2.00,0.50,'Breakfast is a blast!',2,1,1),
	(6,'Blocked','uploads/Blocked.jpg',30,'10 Inches',7.00,2.67,'A beautiful labyrinth to admire.',2,4,0),
	(7,'Tree Love','uploads/Tree Love.jpg',12,'5 Inches',3.25,1.25,'Just hanging around.',2,3,1),
	(8,'High 5!','uploads/High 5!.jpg',17,'7 Inches',6.78,1.69,'Missing a finger there..',3,4,1),
	(9,'Pizza Lovers','uploads/Pizza Lover\'s.jpg',24,'6 Inches',3.45,0.78,'Pizza written in pizza.',1,4,1),
	(10,'Shady Owl','uploads/Shady Owl.jpg',15,'4 Inches',3.00,1.28,'An owl who loves to be in the pr',2,3,1);

/*!40000 ALTER TABLE `item` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table item_category
# ------------------------------------------------------------

DROP TABLE IF EXISTS `item_category`;

CREATE TABLE `item_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(32) NOT NULL,
  PRIMARY KEY (`id`,`category_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `item_category` WRITE;
/*!40000 ALTER TABLE `item_category` DISABLE KEYS */;

INSERT INTO `item_category` (`id`, `category_name`)
VALUES
	(1,'Decals'),
	(2,'Wall'),
	(3,'Floor');

/*!40000 ALTER TABLE `item_category` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table item_sub_category
# ------------------------------------------------------------

DROP TABLE IF EXISTS `item_sub_category`;

CREATE TABLE `item_sub_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sub_category_name` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `item_sub_category` WRITE;
/*!40000 ALTER TABLE `item_sub_category` DISABLE KEYS */;

INSERT INTO `item_sub_category` (`id`, `sub_category_name`)
VALUES
	(1,'Jokes'),
	(2,'Brands'),
	(3,'Animals'),
	(4,'Random');

/*!40000 ALTER TABLE `item_sub_category` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table order
# ------------------------------------------------------------

DROP TABLE IF EXISTS `order`;

CREATE TABLE `order` (
  `order_number` int(11) NOT NULL AUTO_INCREMENT,
  `order_date` date DEFAULT NULL,
  `amount_stickers` int(11) NOT NULL,
  `total_price` decimal(4,2) DEFAULT NULL,
  `order_status` int(1) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `shipper_company_name` varchar(18) DEFAULT NULL,
  `tracking_number` int(11) DEFAULT NULL,
  PRIMARY KEY (`order_number`),
  KEY `customer_id` (`customer_id`),
  KEY `shipper_company_name` (`shipper_company_name`),
  CONSTRAINT `order_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `order_ibfk_2` FOREIGN KEY (`shipper_company_name`) REFERENCES `shipper` (`shipper_name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `order` WRITE;
/*!40000 ALTER TABLE `order` DISABLE KEYS */;

INSERT INTO `order` (`order_number`, `order_date`, `amount_stickers`, `total_price`, `order_status`, `customer_id`, `shipper_company_name`, `tracking_number`)
VALUES
	(1,'2017-04-13',3,4.05,0,13,'UPS',123),
	(2,'2017-04-13',10,20.00,1,13,'UPS',1234),
	(3,'2017-04-13',10,34.50,1,13,'UPS',12345);

/*!40000 ALTER TABLE `order` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table payment_method
# ------------------------------------------------------------

DROP TABLE IF EXISTS `payment_method`;

CREATE TABLE `payment_method` (
  `customer_id` int(11) NOT NULL,
  `card_last_digits` int(4) NOT NULL,
  `exp_date` int(10) NOT NULL,
  `card_type` varchar(32) NOT NULL,
  PRIMARY KEY (`customer_id`),
  CONSTRAINT `payment_method_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table phone_number
# ------------------------------------------------------------

DROP TABLE IF EXISTS `phone_number`;

CREATE TABLE `phone_number` (
  `customer_id` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  PRIMARY KEY (`customer_id`),
  CONSTRAINT `phone_number_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `phone_number` WRITE;
/*!40000 ALTER TABLE `phone_number` DISABLE KEYS */;

INSERT INTO `phone_number` (`customer_id`, `number`)
VALUES
	(14,19918293),
	(15,19191919),
	(16,82828282);

/*!40000 ALTER TABLE `phone_number` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table report_type
# ------------------------------------------------------------

DROP TABLE IF EXISTS `report_type`;

CREATE TABLE `report_type` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `type_name` varchar(58) NOT NULL DEFAULT '',
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table reports
# ------------------------------------------------------------

DROP TABLE IF EXISTS `reports`;

CREATE TABLE `reports` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(250) NOT NULL DEFAULT '',
  `description` text,
  `type` varchar(11) NOT NULL DEFAULT '',
  `from_date` date DEFAULT NULL,
  `to_date` date DEFAULT NULL,
  `refers_to` varchar(58) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `reports` WRITE;
/*!40000 ALTER TABLE `reports` DISABLE KEYS */;

INSERT INTO `reports` (`id`, `title`, `description`, `type`, `from_date`, `to_date`, `refers_to`)
VALUES
	(1,'Reporte 1','Primer reporte','0','0000-00-00','0000-00-00','1'),
	(2,'Reporte 2','Otro reporte','1','0000-00-00','0000-00-00','2'),
	(3,'Reporte 3','Reporte de prueba numero 3','2','0000-00-00','0000-00-00','3'),
	(4,'Reporte 4','Prueba con Sales Reports','1','0000-00-00','0000-00-00','1'),
	(5,'Reporte 5','Aja','1','2017-04-19','2017-04-28','2'),
	(6,'Reporte 6','Reporte pa fechas','1','2017-04-12','2017-04-15','3'),
	(7,'Reporte 7','Reporte de la vida','Sales','2017-04-11','2017-04-17','3'),
	(8,'Reporte 8','Reporte nuevo','Sales','2017-04-14','2017-04-21','3');

/*!40000 ALTER TABLE `reports` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table shipper
# ------------------------------------------------------------

DROP TABLE IF EXISTS `shipper`;

CREATE TABLE `shipper` (
  `shipper_name` varchar(18) NOT NULL,
  `company_phone_num` int(10) NOT NULL,
  `company_address` text NOT NULL,
  PRIMARY KEY (`shipper_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `shipper` WRITE;
/*!40000 ALTER TABLE `shipper` DISABLE KEYS */;

INSERT INTO `shipper` (`shipper_name`, `company_phone_num`, `company_address`)
VALUES
	('UPS',2147483647,'Sector Lopez, Lares');

/*!40000 ALTER TABLE `shipper` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table shipping_address
# ------------------------------------------------------------

DROP TABLE IF EXISTS `shipping_address`;

CREATE TABLE `shipping_address` (
  `customer_id` int(11) NOT NULL,
  `street_name` varchar(32) NOT NULL,
  `apt_number` int(11) NOT NULL,
  `zipcode` int(5) NOT NULL,
  `state` varchar(2) NOT NULL,
  PRIMARY KEY (`customer_id`),
  CONSTRAINT `shipping_address_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `shipping_address` WRITE;
/*!40000 ALTER TABLE `shipping_address` DISABLE KEYS */;

INSERT INTO `shipping_address` (`customer_id`, `street_name`, `apt_number`, `zipcode`, `state`)
VALUES
	(14,'12uikso',111,627,'PR'),
	(15,'sjnckjen',181919,21029,'pr'),
	(16,'jkndjkwe',181,627,'PR');

/*!40000 ALTER TABLE `shipping_address` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
