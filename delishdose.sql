/*
SQLyog Ultimate v8.61 
MySQL - 5.5.5-10.4.32-MariaDB : Database - delishdose
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`delishdose` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `delishdose`;

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`version`,`class`,`group`,`namespace`,`time`,`batch`) values (1,'2025-06-10-130940','App\\Database\\Migrations\\User','default','App',1751545290,1),(2,'2025-06-10-130942','App\\Database\\Migrations\\Product','default','App',1751545290,1),(3,'2025-06-10-130942','App\\Database\\Migrations\\Transaction','default','App',1751545291,1),(4,'2025-06-10-130943','App\\Database\\Migrations\\TransactionDetail','default','App',1751545291,1),(5,'2025-07-03-140646','App\\Database\\Migrations\\ProductVariant','default','App',1751551704,2);

/*Table structure for table `product` */

DROP TABLE IF EXISTS `product`;

CREATE TABLE `product` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `harga` double NOT NULL,
  `jumlah` int(5) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `product` */

insert  into `product`(`id`,`nama`,`harga`,`jumlah`,`foto`,`created_at`,`updated_at`) values (1,'Stiky Milk Chocolate',13000,30,'1751556853_6f27c4130856bee0ab08.jpg','2025-07-03 13:19:41','2025-07-03 15:34:13'),(2,'Browkies',25000,10,'1751548832_99b93fc8b6eca374de0c.jpg','2025-07-03 13:20:32',NULL),(3,'Es Teh',3000,200,'1751549036_d7fd6ad4891943d929f9.jpg','2025-07-03 13:23:56',NULL),(4,'Stiky Milk Red Velvet',13000,30,'1751556901_8de8e270b40f5e371039.jpg','2025-07-03 15:35:01',NULL),(5,'Stiky Milk Bubble Gum',13000,30,'1751556940_a987c1a64a82c55765d2.jpg','2025-07-03 15:35:40',NULL),(6,'Stiky Milk Taro',13000,30,'1751556961_5369a9b5b2d1d564fd52.jpg','2025-07-03 15:36:01',NULL),(7,'Es Teh Tarik',7000,30,'1751556992_adeceddee14fcfe9a888.jpg','2025-07-03 15:36:32',NULL),(8,'Cookies',15000,50,'1751557041_b83d8e76dd25ccb585bb.jpg','2025-07-03 15:37:21',NULL),(9,'Brownies',70000,50,'1751557066_6301c520694cc4fb1781.jpg','2025-07-03 15:37:46',NULL);

/*Table structure for table `transaction` */

DROP TABLE IF EXISTS `transaction`;

CREATE TABLE `transaction` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `total_harga` double NOT NULL,
  `alamat` text NOT NULL,
  `ongkir` double DEFAULT NULL,
  `status` int(1) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `transaction` */

insert  into `transaction`(`id`,`username`,`total_harga`,`alamat`,`ongkir`,`status`,`created_at`,`updated_at`) values (1,'Delishdose',85000,'Gayamsari',25000,0,'2025-07-03 13:50:28','2025-07-03 13:50:28'),(2,'Delishdose',75000,'Pandanaran',40000,0,'2025-07-03 13:51:14','2025-07-03 13:51:14'),(3,'Delishdose',31000,'Dempel',21000,0,'2025-07-03 13:51:54','2025-07-03 13:51:54'),(4,'Delishdose',10000,'Dimana',0,0,'2025-07-03 13:52:50','2025-07-03 13:52:50'),(5,'Delishdose',10000,'Dempel',0,0,'2025-07-03 13:53:21','2025-07-03 13:53:21');

/*Table structure for table `transaction_detail` */

DROP TABLE IF EXISTS `transaction_detail`;

CREATE TABLE `transaction_detail` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `transaction_id` int(11) unsigned NOT NULL,
  `product_id` int(11) unsigned NOT NULL,
  `jumlah` int(5) NOT NULL,
  `diskon` double DEFAULT NULL,
  `subtotal_harga` double NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `transaction_detail` */

insert  into `transaction_detail`(`id`,`transaction_id`,`product_id`,`jumlah`,`diskon`,`subtotal_harga`,`created_at`,`updated_at`) values (1,1,1,6,0,60000,'2025-07-03 13:50:29','2025-07-03 13:50:29'),(2,2,1,1,0,10000,'2025-07-03 13:51:14','2025-07-03 13:51:14'),(3,2,2,1,0,25000,'2025-07-03 13:51:14','2025-07-03 13:51:14'),(4,3,1,1,0,10000,'2025-07-03 13:51:54','2025-07-03 13:51:54'),(5,4,1,1,0,10000,'2025-07-03 13:52:50','2025-07-03 13:52:50'),(6,5,1,1,0,10000,'2025-07-03 13:53:21','2025-07-03 13:53:21');

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `user` */

insert  into `user`(`id`,`username`,`email`,`password`,`role`,`created_at`,`updated_at`) values (1,'Delishdose','delishdose@gmail.com','$2y$12$Y3cQTy5U3m6LFL6HpXN1Iuw4H3YPKF1vVxbIj9tpGK8R6gwEJRYsa','admin',NULL,NULL),(2,'violetaco','violetaco@gmail.com','$2y$12$AjvaAGSL.xsltJmsF62kquFw7TukTgipKPmgw.dP3/LRNvZ2aLVEW','admin',NULL,NULL),(3,'cobacobasaja','coba@gmail.com','$2y$12$bgsicLU6sW2VNb6udlRaKebcBdSR3tv70gWmx7sez4Mb.qVf5LfCy','guest',NULL,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
