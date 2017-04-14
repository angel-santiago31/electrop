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

/*Table structure for table `customer` */

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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `customer` */

insert  into `customer`(`id`,`email`,`password_hash`,`first_name`,`middle_name`,`fathers_last_name`,`mothers_last_name`,`date_of_birth`,`age`,`auth_key`,`password_reset_token`,`status`,`created_at`,`updated_at`,`active`) values 
(11,'angel.santiago31@upr.edu','$2y$13$FRoVVuY51PeOSprQgXqxyOoT3a6uZdODj4uqmsAd0Y9WFzWrHnU/O','Angel','Eduardo','Santiago','González',10,NULL,'i76U4HtSj5hRm19MRcV3zpXw9I0uFRhM',NULL,10,1491411798,1492117672,0);

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
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

/*Data for the table `item` */

insert  into `item`(`item_id`,`name`,`picture`,`quantity_remaining`,`size`,`gross_price`,`production_cost`,`description`,`item_category_id`,`item_sub_category_id`,`active`) values 
(4,'Firebreathing King','uploads/Firebreathing King.jpg',10,'3 Inches',1.35,0.20,'A king with an unusual human app',1,4,1),
(5,'To Breakfast!','uploads/To Breakfast!.jpg',10,'4 Inches',2.00,0.50,'Breakfast is a blast!',2,1,1),
(6,'Blocked','uploads/Blocked.jpg',30,'10 Inches',7.00,2.67,'A beautiful labyrinth to admire.',2,4,0),
(7,'Tree Love','uploads/Tree Love.jpg',12,'5 Inches',3.25,1.25,'Just hanging around.',2,3,1),
(8,'High 5!','uploads/High 5!.jpg',17,'7 Inches',6.78,1.69,'Missing a finger there..',3,4,1),
(9,'Pizza Lovers','uploads/Pizza Lover\'s.jpg',24,'6 Inches',3.45,0.78,'Pizza written in pizza.',1,4,1),
(10,'Shady Owl','uploads/Shady Owl.jpg',15,'4 Inches',3.00,1.28,'An owl who loves to be in the pr',2,3,1),
(11,'Trump Bans Anime','uploads/Trump Bans Anime.jpg',15,'3 Inches',3.50,1.25,'Anime fans will rage about this.',1,1,1),
(12,'Chick-fil-A','uploads/Chick-fil-A.jpg',10,'4 Inhes',4.00,0.59,'Chicken at its finest.',1,2,1),
(13,'Bee','uploads/Bee.jpg',13,'2 Inches',2.00,0.20,'Bee your self.',1,3,1),
(14,'Beautify','uploads/Beautify.jpg',20,'3 Inches',2.37,0.34,'Stare in deep into nature.',1,4,1),
(15,'Doge','uploads/Doge.jpg',34,'4 Inches',4.56,1.27,'You\'re safe when riding a Doge.',2,1,1),
(16,'Google','uploads/Google.jpg',17,'5 Inches',5.00,0.89,'Bringing people together.',2,2,1),
(17,'Nightmare Wolf','uploads/Nightmare Wolf.jpg',5,'4 Inches',3.45,1.28,'Don\'t open your eyes.',2,3,1),
(18,'Hypnotizing','uploads/Hypnotizing.jpg',12,'5 Inches',3.89,0.56,'Biggie Biggie why can\'t you see.',2,4,1),
(19,'Micro','uploads/Micro.jpg',21,'3 Inches',4.55,2.34,'Gotta laugh at the little things',3,1,1),
(20,'DC','uploads/DC.jpg',30,'7 Inches',5.76,2.67,'Skate on!',3,2,1),
(21,'Gyaku Gire Panda','uploads/Gyaku Gire Panda.jpg',23,'4 Inches',3.57,0.99,'Panda-desu.',3,3,1),
(22,'In Another Dimmension','uploads/In Another Dimmension.jpg',26,'6 Inches',4.78,1.99,'This is what I see.',3,4,1),
(23,'Ninja CSS','uploads/Ninja CSS.jpg',24,'5 Inches',4.69,2.34,'Who would\'ve guessed.',1,1,1),
(24,'MATH','uploads/MATH.jpg',19,'6 Inches',5.12,2.39,'Indeed.',3,1,1),
(25,'Sarcasm','uploads/Sarcasm.jpg',9,'4 Inches',3.54,2.00,'The irony.',3,1,1),
(26,'Real G','uploads/Real G.jpg',4,'3 Inches',2.68,0.76,'Let\'s just be real.',2,1,1),
(27,'Hurley X','uploads/Hurley X.jpg',16,'5 Inches',5.56,2.38,'Skate or die.',1,2,1),
(28,'Clorox','uploads/Clorox.jpg',11,'4 Inches',3.89,1.34,'A shot a day keeps the doctor aw',2,2,1),
(29,'Harmonicat','uploads/Harmonicat.jpg',23,'5 Inches',6.87,3.00,'Soothe your soul with tunes from',3,3,1),
(30,'That\'s what she said!','uploads/That\'s what she said!.jpg',6,'7 Inches',6.78,3.45,'All the time.',2,1,1),
(31,'Heart Monkey','uploads/Heart Monkey.jpg',17,'5 Inches',4.45,1.24,'Love for all!',1,3,1),
(32,'Just Do It','uploads/Just Do It.jpg',28,'4 Inches',6.55,2.33,'NIKE Co.',3,2,1),
(33,'MLD','uploads/MLD.jpg',25,'6 Inches',5.55,1.12,'Mayor League Drinking',1,2,1),
(34,'Fiesty','uploads/Fiesty.jpg',25,'5 Inches',5.56,1.00,'Latina Babe',1,4,1);

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
  `order_date` int(8) DEFAULT NULL,
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

/*Data for the table `order` */

/*Table structure for table `payment_method` */

DROP TABLE IF EXISTS `payment_method`;

CREATE TABLE `payment_method` (
  `customer_id` int(11) NOT NULL,
  `card_last_digits` int(4) NOT NULL,
  `exp_date` int(10) NOT NULL,
  `card_type` varchar(32) NOT NULL,
  PRIMARY KEY (`customer_id`),
  CONSTRAINT `payment_method_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `payment_method` */

/*Table structure for table `phone_number` */

DROP TABLE IF EXISTS `phone_number`;

CREATE TABLE `phone_number` (
  `customer_id` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  PRIMARY KEY (`customer_id`),
  CONSTRAINT `phone_number_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `phone_number` */

/*Table structure for table `shipper` */

DROP TABLE IF EXISTS `shipper`;

CREATE TABLE `shipper` (
  `shipper_name` varchar(18) NOT NULL,
  `company_phone_num` int(10) NOT NULL,
  `company_address` text NOT NULL,
  PRIMARY KEY (`shipper_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `shipper` */

/*Table structure for table `shipping_address` */

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

/*Data for the table `shipping_address` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
