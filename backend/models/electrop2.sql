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
(143438,15,10.41,1),
(143438,17,2.53,1);

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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `customer` */

insert  into `customer`(`id`,`email`,`password_hash`,`first_name`,`middle_name`,`fathers_last_name`,`mothers_last_name`,`date_of_birth`,`age`,`auth_key`,`password_reset_token`,`status`,`created_at`,`updated_at`,`active`) values 
(12,'erick.rivera6@upr.edu','$2y$13$M5UpksDkDlvgt/lUm1m/lOaQ7R97gkbNEZW.zl7ZGEhjSD0BNfPY.','Erick','','Rivera','Cruz','12',NULL,'DdZQQZEetFOXZcoL5LVzhOwOByIW07Xa',NULL,10,1491695547,1491695547,0),
(13,'huelga@upra.com','$2y$13$Qqdd5SXlZpcVuL1sCrVgXuyraBjHDI/l4IyG0fhiv/Ccvd2iTnBTa','Once','Recintos','Una','Upr','12',NULL,'CFnXDz1i7Xdu29AkGMAxcPAaVgRdN0qD',NULL,10,1491842106,1491842106,0),
(14,'bryan.hernandez5@upr.edu','$2y$13$kotQzJ5P/uEh.XOfM8dGpO9jt5cYkmbin6VfzpG96bbp1gfUdRsZu','Bryan','Yomar','Hernandez','Cuevas','1996',NULL,'1aJSZBWbJs6pp6ny1Q33-OeAKlSAZRO_',NULL,10,1492651670,1492651670,0),
(19,'angel.santiago31@upr.edu','$2y$13$nt0zcmBLbAFn598NDRCOauOcpQGb5VYA6NJXeh7djbRibrF54oS7C','Angel','Eduardo','Santiago','González','10-10-1996',NULL,'aXIqfWWFf17tuvpdcFfxoslLUXZWIZaI',NULL,10,1492660565,1492660951,0),
(20,'test@test.com','$2y$13$uQax1jJ7LTc7v5Fd4qBT6OEryM/89/Lt3.9Jk5MDeHhOYMrQaErk6','Test','Test','Test','Test','23-03-2017',NULL,'okRwZ_rAxhW9rGTXNIxeeVQvrhPhWndh',NULL,10,1492797446,1492797446,0);

/*Table structure for table `item` */

DROP TABLE IF EXISTS `item`;

CREATE TABLE `item` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `picture` varchar(256) NOT NULL,
  `quantity_remaining` int(11) NOT NULL,
  `size` int(11) NOT NULL,
  `gross_price` decimal(4,2) NOT NULL,
  `production_cost` decimal(4,2) NOT NULL,
  `description` varchar(256) NOT NULL,
  `item_category_id` int(11) NOT NULL,
  `item_sub_category_id` int(11) NOT NULL,
  `active` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`item_id`),
  KEY `item_category_id` (`item_category_id`),
  KEY `item_sub_category_id` (`item_sub_category_id`),
  CONSTRAINT `item_ibfk_1` FOREIGN KEY (`item_category_id`) REFERENCES `item_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `item_ibfk_2` FOREIGN KEY (`item_sub_category_id`) REFERENCES `item_sub_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8;

/*Data for the table `item` */

insert  into `item`(`item_id`,`name`,`picture`,`quantity_remaining`,`size`,`gross_price`,`production_cost`,`description`,`item_category_id`,`item_sub_category_id`,`active`) values 
(12,'Romaine Calm','uploads/Romaine Calm.jpg',30,3,10.00,1.75,'Romaine calm everybody!',1,1,1),
(13,'I Yam What I Yam','uploads/I Yam What I Yam.jpg',34,2,6.00,0.75,'I yam happy!',1,1,1),
(14,'Sarcasm','uploads/Sarcasm.jpg',17,1,2.56,0.11,'\"can i interest you in a sarcastic comment?\" Graphic',1,1,1),
(15,'[laughs microscopically]','uploads/[laughs microscopically].jpg',44,3,10.41,1.84,'Tiny laughs for all you\'ve got!',1,1,1),
(16,'Coach Logo','uploads/Coach Logo.jpg',36,1,4.64,0.45,'Original Coach Logo',1,2,1),
(17,'Samurai Cereal','uploads/Samurai Cereal.jpg',46,1,2.53,0.25,'Eat \'em with chopsticks or spoon!',1,2,1),
(18,'Volcom','uploads/Volcom.jpg',45,1,3.17,0.67,'Volcom Logo',1,2,1),
(19,'Sundrop - Sun drop','uploads/Sundrop - Sun drop.jpg',34,2,10.28,1.67,'Drop it like it\'s hot!',1,2,1),
(20,'Twinkies','uploads/Twinkies.jpg',17,1,2.32,0.21,'The favorite yellowish cream filled sponge!',1,2,1),
(21,'Friends Not Food - Animals','uploads/Friends Not Food - Animals.jpg',37,2,7.50,1.11,'We don\'t eat each other. We spread love.',1,3,1),
(22,'Sloth Life','uploads/Sloth Life.jpg',38,1,2.68,0.45,'Just hanging around!',1,3,1),
(23,'Desert animals','uploads/Desert animals.jpg',53,3,10.00,1.75,'Camel toe.',1,3,1),
(24,'Cat in Lotus Tattoo','uploads/Cat in Lotus Tattoo.jpg',25,1,2.53,0.55,'Pretty Kitty',1,3,1),
(25,'Nugget Dino','uploads/Nugget Dino.jpg',26,1,3.44,0.34,'It\'s you eating him! Mmmm...',1,4,1),
(26,'Shaggy This Isn\'t Weed','uploads/Shaggy This Isn\'t Weed.jpg',36,1,5.93,1.00,'Why Fred, why!?',1,4,1),
(27,'Issa Knife','uploads/Issa Knife.jpg',47,4,14.59,2.33,'Nigga gon get stabbed yo\'!',1,4,1),
(28,'Happy Pepe, The Frog','uploads/Happy Pepe, The Frog.jpg',26,1,6.00,0.67,'A happy Pepe is a good Pepe.',1,4,1),
(29,'Astro Sloth','uploads/Astro Sloth.jpg',26,3,10.00,1.75,'Captain Sloth reporting for duty.',1,4,1),
(30,'Heisenberg','uploads/Heisenberg.jpg',63,1,2.64,0.33,'Shades on, hat on.',1,4,1),
(31,'Geometric Rick Sanchez','uploads/Geometric Rick Sanchez.jpg',23,1,6.00,0.45,'Hey Morty.',1,4,1),
(32,'Fatty Acid','uploads/Fatty Acid.jpg',26,1,3.06,0.23,'I think I\'m fat too..',2,1,1),
(33,'Drop the Bass Chemistry Base','uploads/Drop the Bass Chemistry Base.jpg',64,2,5.74,1.21,'*Dubstep music plays*',2,1,1),
(34,'Keepin\' It Real','uploads/Keepin\' It Real.jpg',38,1,2.42,0.68,'Let\'s just be honest, let\'s just be real~',2,1,1),
(35,'Geek Tee - CSS Jokes - Ninja','uploads/Geek Tee - CSS Jokes - Ninja.jpg',47,1,6.00,1.28,'Ninja.css',2,1,1),
(36,'Anime Is Now Illegal ','uploads/Anime Is Now Illegal .jpg',38,1,2.32,0.34,'Otakus unite!',2,1,1),
(37,'Old Spice','uploads/Old Spice.jpg',27,1,6.00,1.28,'Yeahhh! Gimme sum!',2,2,1),
(38,'Chick-fil-A Cup','uploads/Chick-fil-A Cup.jpg',32,1,2.74,0.56,'Chicken n\' grillin\'!',2,2,1),
(39,'WTF Panda','uploads/WTF Panda.jpg',62,3,15.83,2.99,'WTF!?',2,2,1),
(40,'New Google Logo','uploads/New Google Logo.jpg',12,1,5.75,0.67,'Everyday I\'m Googlin\'!',2,2,1),
(41,'Starbuck\'s Coffee','uploads/Starbuck\'s Coffee.jpg',35,1,2.67,0.33,'An all hipster favorite!',2,2,1),
(42,'Vaping ','uploads/Vaping .jpg',25,1,2.67,0.88,'Since 2013',2,2,1),
(43,'Fk You Cat','uploads/Fk You Cat.jpg',53,1,2.53,0.33,'Fk off!',2,3,1),
(44,'Catlove','uploads/Catlove.jpg',27,1,6.00,0.99,'Love for every cat in the world!',2,3,1),
(45,'Peekaboo','uploads/Peekaboo.jpg',53,1,2.53,0.33,'Peekaboo cat.',2,3,1),
(46,'American Shorthair happy','uploads/American Shorthair happy.jpg',52,1,10.41,1.28,'Smile!',2,3,1),
(47,'Significant Otters ','uploads/Significant Otters .jpg',63,2,6.50,1.22,'Otters hold.',2,3,1),
(48,'Grandmother Using an Inhaler','uploads/Grandmother Using an Inhaler.jpg',25,1,2.53,0.33,'Inhale deep mamaw!',2,4,1),
(49,'Rainbow Dash Cutie Mark','uploads/Rainbow Dash Cutie Mark.jpg',56,1,2.53,0.56,'Bronnies will like.',2,4,1),
(50,'Yeah Boy','uploads/Yeah Boy.jpg',25,1,2.53,0.45,'*Shooting Stars Starts Playing* ',2,4,1),
(51,'GOAT','uploads/GOAT.jpg',65,1,7.00,1.45,'Goat milk?',2,4,1),
(52,'They Let Me Play with Chemicals','uploads/They Let Me Play with Chemicals.jpg',25,1,2.42,0.44,'Don\'t try this at home kids!',3,1,1),
(53,'You Are Being Monitored','uploads/You Are Being Monitored.jpg',42,2,5.74,1.11,'Be careful of what you do at work.',3,1,1),
(54,'Practice Safe Sax','uploads/Practice Safe Sax.jpg',15,1,9.56,3.11,'Remember, always use a saxophone.',3,1,1),
(55,'Yellow Banana Periodic Table','uploads/Yellow Banana Periodic Table.jpg',25,1,8.40,1.67,'Ba-na-na!',3,1,1),
(56,'Beats','uploads/Beats.jpg',36,1,3.38,0.67,'By Dr. Dre',3,2,1),
(57,'NVIDIA','uploads/NVIDIA.jpg',15,3,13.33,2.65,'For gaming.',3,2,1),
(58,'Gesture of Billabong','uploads/Gesture of Billabong.jpg',25,1,3.69,0.44,'Rock on.',3,2,1),
(59,'Seal of Approval','uploads/Seal of Approval.jpg',15,3,10.00,1.75,'I approve!',3,3,1),
(60,'Unicorn power','uploads/Unicorn power.jpg',26,4,14.00,3.00,'I am the unicorn wizard!~',3,3,1),
(63,'FK ANIMAL TESTING','uploads/FK ANIMAL TESTING.jpg',26,2,6.00,0.78,'It\'s a no no.',3,3,1),
(64,'Cosmocat','uploads/Cosmocat.jpg',36,1,2.53,0.33,'May the cosmos be with you.',3,3,1),
(65,'Code With Me Senpai','uploads/Code With Me Senpai.jpg',25,1,2.15,0.23,'Senpai notice me!',3,4,1),
(66,'Fk Her Right In The P','uploads/Fk Her Right In The P.jpg',11,1,2.74,0.45,'You\'ve seen it before..',3,4,1),
(67,'Pug Life','uploads/Pug Life.jpg',22,3,10.00,1.75,'Don\'t pug with me and I won\'t pug with you.',3,4,1),
(68,'Trippy Felix','uploads/Trippy Felix.jpg',13,1,2.85,0.34,'Felix be trippin\'',3,4,1);

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
) ENGINE=InnoDB AUTO_INCREMENT=143439 DEFAULT CHARSET=utf8;

/*Data for the table `order` */

insert  into `order`(`order_number`,`order_date`,`amount_stickers`,`total_price`,`order_status`,`customer_id`,`shipper_company_name`,`tracking_number`) values 
(143438,1492733047,2,12.94,1,19,'UPS',4733);

/*Table structure for table `payment_method` */

DROP TABLE IF EXISTS `payment_method`;

CREATE TABLE `payment_method` (
  `customer_id` int(11) NOT NULL,
  `card_last_digits` varchar(4) NOT NULL,
  `exp_date` varchar(5) NOT NULL,
  `card_type` varchar(32) NOT NULL,
  PRIMARY KEY (`customer_id`),
  CONSTRAINT `payment_method_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `payment_method` */

insert  into `payment_method`(`customer_id`,`card_last_digits`,`exp_date`,`card_type`) values 
(14,'1111','20/20','Visa'),
(19,'1234','12/12','Visa'),
(20,'1234','11/11','American Exppress');

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
(14,'787'),
(19,'939-246-8676'),
(20,'787-897-3922');

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
  `from_date` varchar(128) DEFAULT NULL,
  `to_date` varchar(128) DEFAULT NULL,
  `refers_to` varchar(58) DEFAULT NULL,
  `item_selected` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

/*Data for the table `reports` */

insert  into `reports`(`id`,`title`,`description`,`type`,`from_date`,`to_date`,`refers_to`,`item_selected`) values 
(6,'Reporte de todas las ventas en abril','Solo abril.','Sales','2017-04-01 00:00:00','2017-04-30 00:00:00','No Group',''),
(8,'Reporte de multiples cosas','Multiples cosas... si.','Sales','2017-04-01 00:00:00','2017-04-30 00:00:00','All',''),
(11,'Reporte de prueba dura','Die Hard.','Sales','2017-04-01 00:00:00','2017-04-30 00:00:00','4','9'),
(13,'Reporte de la tercera categoria','mjm','Sales','2017-04-01 00:00:00','2017-04-27 00:00:00','3',''),
(14,'Reporte de Pisos','Pisos.','Revenue','2017-03-15 00:00:00','2017-04-27 00:00:00','3',''),
(16,'Reporte de todas las ventas','Todas las ventas','Sales','2017-03-15 00:00:00','2017-04-27 00:00:00','All',''),
(17,'Reporte del Item ID 10','Solo eso.','Revenue','2017-03-16 00:00:00','2017-04-27 00:00:00','4','10'),
(18,'Item ID 4 Report','Para probar.','Revenue','2017-03-16 00:00:00','2017-04-27 00:00:00','4','4'),
(19,'Reporte por ID 8','Por ID 8','Sales','2017-03-03 00:00:00','2017-05-05 00:00:00','4','8'),
(20,'Reporte por ID 5','ID 5','Revenue','2017-03-23 00:00:00','2017-05-04 00:00:00','4','5'),
(21,'Test (Angel)','Test.','Revenue','16-11-2017','20-04-2017','1','');

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
(19,'Example Name',123,'00669','PR'),
(20,'wewg',234324,'00669','IL');

/*Table structure for table `sticker_size` */

DROP TABLE IF EXISTS `sticker_size`;

CREATE TABLE `sticker_size` (
  `id` int(11) NOT NULL,
  `size` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `sticker_size` */

insert  into `sticker_size`(`id`,`size`) values 
(1,'Small (2.7\" x 4.0\")'),
(2,'Medium (3.7\" x 5.5\")'),
(3,'Large (5.7\" x 8.5\")'),
(4,'Extra Large (9.4\" x 14.0\")');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
