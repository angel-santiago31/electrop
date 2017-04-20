/*
SQLyog Community v12.4.1 (64 bit)
MySQL - 10.1.21-MariaDB : Database - electrop
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`electrop` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `electrop`;

/*Table structure for table `admin` */

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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `admin` */

insert  into `admin`(`id`,`auth_key`,`password_hash`,`password_reset_token`,`email`,`status`,`created_at`,`updated_at`) values 
(7,'DxKkH2hGDkUj5L2LnB8qrMVLkGFAT82M','$2y$13$D92/maDAYUX2W.25sYURRecRl4TvGpEPvgzqzQosMwiHJO6jymLji','jGCqlkpYD0UQNSodS-yMSvIoqyA5aF_p_1489764767','admin@admin.com',10,17,17),
(11,'FHRGKaaqo4ZvDlZPPMmkIqxtdGZBziVF','$2y$13$c4TudIrJOXWkJ4xh57618OHd60g1CFcmv7f.iy8JCH4F2JJPPRfvi','NUHKloHkVlA29Y_xv5MQ0IVgu4Njkm7-_1491401476','mystery_Person@outlook.com',10,1491401476,1491401476);

/*Table structure for table `contains` */

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

/*Data for the table `contains` */

insert  into `contains`(`order_number`,`item_id`,`price_sold`,`quantity_in_order`) values 
(7,4,1.35,1),
(7,5,2.00,1),
(7,7,3.25,1),
(9,7,3.25,1),
(10,4,1.35,1),
(11,9,3.45,1),
(12,10,3.00,1),
(13,8,6.78,1),
(14,7,3.25,1),
(15,8,6.78,1),
(16,5,2.00,1);

/*Table structure for table `customer` */

DROP TABLE IF EXISTS `customer`;

CREATE TABLE `customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(18) COLLATE utf8_unicode_ci NOT NULL,
  `middle_name` varchar(18) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fathers_last_name` varchar(18) COLLATE utf8_unicode_ci NOT NULL,
  `mothers_last_name` varchar(18) COLLATE utf8_unicode_ci NOT NULL,
  `date_of_birth` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `customer` */

insert  into `customer`(`id`,`email`,`password_hash`,`first_name`,`middle_name`,`fathers_last_name`,`mothers_last_name`,`date_of_birth`,`age`,`auth_key`,`password_reset_token`,`status`,`created_at`,`updated_at`,`active`) values 
(19,'angel.santiago31@upr.edu','$2y$13$nt0zcmBLbAFn598NDRCOauOcpQGb5VYA6NJXeh7djbRibrF54oS7C','Angel','Eduardo','Santiago','González','10-10-1996',NULL,'aXIqfWWFf17tuvpdcFfxoslLUXZWIZaI',NULL,10,1492660565,1492660951,0);

/*Table structure for table `item` */

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

/*Data for the table `item` */

insert  into `item`(`item_id`,`name`,`picture`,`quantity_remaining`,`size`,`gross_price`,`production_cost`,`description`,`item_category_id`,`item_sub_category_id`,`active`) values 
(4,'Firebreathing King','uploads/Firebreathing King.jpg',10,'3 Inches',1.35,0.20,'A king with an unusual human app',1,4,1),
(5,'To Breakfast!','uploads/To Breakfast!.jpg',10,'4 Inches',2.00,0.50,'Breakfast is a blast!',2,1,1),
(6,'Blocked','uploads/Blocked.jpg',30,'10 Inches',7.00,2.67,'A beautiful labyrinth to admire.',2,4,0),
(7,'Tree Love','uploads/Tree Love.jpg',12,'5 Inches',3.25,1.25,'Just hanging around.',2,3,1),
(8,'High 5!','uploads/High 5!.jpg',17,'7 Inches',6.78,1.69,'Missing a finger there..',3,4,1),
(9,'Pizza Lover\'s','uploads/Pizza Lover\'s.jpg',24,'6 Inches',3.45,0.78,'Pizza written in pizza.',1,4,1),
(10,'Shady Owl','uploads/Shady Owl.jpg',15,'4 Inches',3.00,1.28,'An owl who loves to be in the pr',2,3,1);

/*Table structure for table `item_category` */

DROP TABLE IF EXISTS `item_category`;

CREATE TABLE `item_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(32) NOT NULL,
  PRIMARY KEY (`id`,`category_name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `item_category` */

insert  into `item_category`(`id`,`category_name`) values 
(1,'Decals'),
(2,'Wall'),
(3,'Floor');

/*Table structure for table `item_sub_category` */

DROP TABLE IF EXISTS `item_sub_category`;

CREATE TABLE `item_sub_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sub_category_name` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `item_sub_category` */

insert  into `item_sub_category`(`id`,`sub_category_name`) values 
(1,'Jokes'),
(2,'Brands'),
(3,'Animals'),
(4,'Random');

/*Table structure for table `migration` */

DROP TABLE IF EXISTS `migration`;

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `migration` */

insert  into `migration`(`version`,`apply_time`) values 
('m000000_000000_base',1491936124),
('m160516_095943_init',1491936142),
('m161109_124936_rename_cart_table',1491936142),
('m161119_153348_alter_cart_data',1491936142);

/*Table structure for table `order` */

DROP TABLE IF EXISTS `order`;

CREATE TABLE `order` (
  `order_number` int(11) NOT NULL AUTO_INCREMENT,
  `order_date` int(11) DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

/*Data for the table `order` */

insert  into `order`(`order_number`,`order_date`,`amount_stickers`,`total_price`,`order_status`,`customer_id`,`shipper_company_name`,`tracking_number`) values 
(7,1492661373,3,6.60,1,19,'UPS',8624),
(9,1492661644,1,3.25,1,19,'UPS',1665),
(10,1492661648,1,1.35,1,19,'UPS',8650),
(11,1492661651,1,3.45,1,19,'UPS',8445),
(12,1492661654,1,3.00,1,19,'UPS',3733),
(13,1492661657,1,6.78,1,19,'UPS',6995),
(14,1492661683,1,3.25,1,19,'UPS',3103),
(15,1492661687,1,6.78,1,19,'UPS',4701),
(16,1492661689,1,2.00,1,19,'UPS',7953);

/*Table structure for table `payment_method` */

DROP TABLE IF EXISTS `payment_method`;

CREATE TABLE `payment_method` (
  `customer_id` int(11) NOT NULL,
  `card_last_digits` int(4) NOT NULL,
  `exp_date` varchar(6) NOT NULL,
  `card_type` varchar(32) NOT NULL,
  PRIMARY KEY (`customer_id`),
  CONSTRAINT `payment_method_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `payment_method` */

insert  into `payment_method`(`customer_id`,`card_last_digits`,`exp_date`,`card_type`) values 
(19,1234,'11/11','Visa');

/*Table structure for table `phone_number` */

DROP TABLE IF EXISTS `phone_number`;

CREATE TABLE `phone_number` (
  `customer_id` int(11) NOT NULL,
  `number` varchar(12) NOT NULL,
  PRIMARY KEY (`customer_id`),
  CONSTRAINT `phone_number_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `phone_number` */

insert  into `phone_number`(`customer_id`,`number`) values 
(19,'939-246-8676');

/*Table structure for table `report_type` */

DROP TABLE IF EXISTS `report_type`;

CREATE TABLE `report_type` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `type_name` varchar(58) NOT NULL DEFAULT '',
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `report_type` */

/*Table structure for table `reports` */

DROP TABLE IF EXISTS `reports`;

CREATE TABLE `reports` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(250) NOT NULL DEFAULT '',
  `description` text,
  `type` varchar(11) NOT NULL,
  `from_date` timestamp NULL DEFAULT NULL,
  `to_date` timestamp NULL DEFAULT NULL,
  `refers_to` varchar(58) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `reports` */

insert  into `reports`(`id`,`title`,`description`,`type`,`from_date`,`to_date`,`refers_to`) values 
(1,'Reporte 1','Hola Reporte','0','2017-01-01 00:00:00','2018-01-01 00:00:00','No Group'),
(2,'Reporte 2','Reporte segundo.','Revenue','2017-02-01 00:00:00','2017-09-29 00:00:00','No Group');

/*Table structure for table `shipper` */

DROP TABLE IF EXISTS `shipper`;

CREATE TABLE `shipper` (
  `shipper_name` varchar(18) NOT NULL,
  `company_phone_num` int(10) NOT NULL,
  `company_address` text NOT NULL,
  PRIMARY KEY (`shipper_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `shipper` */

insert  into `shipper`(`shipper_name`,`company_phone_num`,`company_address`) values 
('UPS',2147483647,'Sector Lopez, Lares');

/*Table structure for table `shipping_address` */

DROP TABLE IF EXISTS `shipping_address`;

CREATE TABLE `shipping_address` (
  `customer_id` int(11) NOT NULL,
  `street_name` varchar(32) NOT NULL,
  `apt_number` int(11) NOT NULL,
  `zipcode` varchar(5) NOT NULL,
  `state` varchar(2) NOT NULL,
  PRIMARY KEY (`customer_id`),
  CONSTRAINT `shipping_address_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `shipping_address` */

insert  into `shipping_address`(`customer_id`,`street_name`,`apt_number`,`zipcode`,`state`) values 
(19,'Example Name',123,'00669','PR');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
