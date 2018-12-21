/*
SQLyog Community v13.1.1 (32 bit)
MySQL - 5.5.61-cll : Database - psindex_core_account
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`psindex_core_account` /*!40100 DEFAULT CHARACTER SET latin1 */;

/*Table structure for table `blog` */

DROP TABLE IF EXISTS `blog`;

CREATE TABLE `blog` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` text COLLATE utf8_unicode_ci,
  `content` blob,
  `author_id` int(10) DEFAULT NULL,
  `category_id` int(10) DEFAULT NULL,
  `tags` text COLLATE utf8_unicode_ci,
  `publish` enum('no','yes') COLLATE utf8_unicode_ci DEFAULT 'no',
  `frontpage` enum('no','yes') COLLATE utf8_unicode_ci DEFAULT 'no',
  `slug` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `order_column` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `blog` */

/*Table structure for table `category` */

DROP TABLE IF EXISTS `category`;

CREATE TABLE `category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8_unicode_ci,
  `slug` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `category` */

insert  into `category`(`id`,`name`,`slug`,`created_at`,`updated_at`) values 
(18,'Server Administration ','server-administration','2018-12-13 21:54:14','2018-12-13 21:54:14'),
(9,'Tutorial',NULL,'2018-12-13 01:08:30','2018-12-13 01:08:30'),
(10,'Snippets',NULL,'2018-12-13 01:08:42','2018-12-13 01:08:42'),
(11,'Designs',NULL,'2018-12-13 03:36:55','2018-12-13 03:36:55'),
(12,'Internet',NULL,'2018-12-13 03:37:04','2018-12-13 03:37:04'),
(13,'Photography',NULL,'2018-12-13 03:37:14','2018-12-13 03:37:14'),
(14,'Web Development',NULL,'2018-12-13 03:37:22','2018-12-13 03:37:22'),
(15,'Projects',NULL,'2018-12-13 03:37:30','2018-12-13 03:37:30'),
(16,'Electronics',NULL,'2018-12-13 03:37:36','2018-12-13 03:37:36');

/*Table structure for table `documents` */

DROP TABLE IF EXISTS `documents`;

CREATE TABLE `documents` (
  `id` double NOT NULL AUTO_INCREMENT,
  `uid` char(100) DEFAULT NULL,
  `file_name` text,
  `doc_name` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `mime_type` char(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `documents` */

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`migration`,`batch`) values 
('2014_10_12_000000_create_users_table',1),
('2014_10_12_100000_create_password_resets_table',1),
('2018_10_06_184524_create_roles_table',2),
('2018_10_16_111442_create_permission_tables',3);

/*Table structure for table `organization_team` */

DROP TABLE IF EXISTS `organization_team`;

CREATE TABLE `organization_team` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_uid` char(255) DEFAULT NULL,
  `user_uid` char(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `organization_team` */

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `permissions` */

DROP TABLE IF EXISTS `permissions`;

CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_unique` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `permissions` */

insert  into `permissions`(`id`,`name`,`created_at`,`updated_at`) values 
(1,'edit','2018-10-17 00:25:05','2018-10-17 00:25:05'),
(2,'download','2018-10-17 00:39:49','2018-10-17 00:39:49'),
(3,'print','2018-10-17 01:07:04','2018-10-17 02:50:22'),
(4,'delete','2018-10-17 01:14:12','2018-10-17 01:14:12'),
(10,'upload','2018-10-17 02:54:28','2018-10-17 02:54:28');

/*Table structure for table `role_has_permissions` */

DROP TABLE IF EXISTS `role_has_permissions`;

CREATE TABLE `role_has_permissions` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `role_has_permissions` */

insert  into `role_has_permissions`(`permission_id`,`role_id`) values 
(1,1),
(1,4),
(2,1),
(2,4),
(2,8),
(3,1),
(3,4),
(3,8),
(4,1),
(4,4),
(5,1),
(5,4),
(7,1),
(7,4),
(8,1),
(8,4),
(9,1),
(10,1),
(10,4),
(10,8);

/*Table structure for table `roles` */

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `published` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `roles` */

insert  into `roles`(`id`,`uid`,`name`,`description`,`published`,`created_at`,`updated_at`) values 
(1,'RL20181014171423','super_admin','System and general administrator','0','2018-10-14 17:14:23','2018-10-17 12:01:01'),
(4,'RL20181014183903','company_admin','Company Administrator/Document Controller','0','2018-10-14 18:39:03','2018-10-14 18:39:03'),
(6,'RL20181014184021','guest','Default system user, this roles can be updated by Company admin','0','2018-10-14 18:40:21','2018-10-14 18:40:21'),
(8,'RL20181016063352','document_controller','Company Document Controller','0','2018-10-16 06:33:52','2018-10-16 06:33:52');

/*Table structure for table `settings` */

DROP TABLE IF EXISTS `settings`;

CREATE TABLE `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` text,
  `value` text,
  `default` text,
  `context` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `settings` */

/*Table structure for table `tags` */

DROP TABLE IF EXISTS `tags`;

CREATE TABLE `tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8_unicode_ci,
  `slug` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tags` */

insert  into `tags`(`id`,`name`,`slug`,`created_at`,`updated_at`) values 
(1,'Php','php','2018-12-13 13:06:03','2018-12-13 13:06:03'),
(2,'Laravel','laravel','2018-12-13 13:06:12','2018-12-13 13:06:12'),
(3,'Python','python','2018-12-13 13:06:19','2018-12-13 13:06:19'),
(4,'C++','c','2018-12-13 13:06:25','2018-12-13 13:06:25'),
(5,'NodeJS','nodejs','2018-12-13 13:06:41','2018-12-13 13:06:41'),
(6,'JQuery','jquery','2018-12-13 13:06:55','2018-12-13 13:06:55'),
(7,'Arduino','arduino','2018-12-13 13:07:16','2018-12-13 13:07:16'),
(8,'Raspberry Pi','raspberry-pi','2018-12-13 13:07:27','2018-12-13 13:07:27'),
(9,'Electronics','electronics','2018-12-13 13:08:03','2018-12-13 13:08:03'),
(10,'JavaScript','javascript','2018-12-13 13:08:13','2018-12-13 13:08:13'),
(11,'Linux','linux','2018-12-13 13:08:19','2018-12-13 13:08:19'),
(12,'Bash','bash','2018-12-13 13:08:26','2018-12-13 13:08:26'),
(13,'Internet','internet','2018-12-15 23:53:19','2018-12-15 23:53:19'),
(14,'Ai','ai','2018-12-16 06:39:36','2018-12-16 06:39:36'),
(16,'Photography','photography','2018-12-16 06:42:08','2018-12-16 06:42:08'),
(17,'Video','video','2018-12-16 06:43:08','2018-12-16 06:43:08'),
(18,'3D','3d','2018-12-16 06:44:25','2018-12-16 06:44:25');

/*Table structure for table `user_has_permissions` */

DROP TABLE IF EXISTS `user_has_permissions`;

CREATE TABLE `user_has_permissions` (
  `user_id` int(10) unsigned NOT NULL,
  `permission_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`permission_id`),
  KEY `user_has_permissions_permission_id_foreign` (`permission_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `user_has_permissions` */

/*Table structure for table `user_has_roles` */

DROP TABLE IF EXISTS `user_has_roles`;

CREATE TABLE `user_has_roles` (
  `role_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`user_id`),
  KEY `user_has_roles_user_id_foreign` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `user_has_roles` */

insert  into `user_has_roles`(`role_id`,`user_id`) values 
(1,16),
(4,16),
(4,23),
(5,15),
(5,16),
(7,16),
(8,15),
(8,16),
(8,23);

/*Table structure for table `user_roles` */

DROP TABLE IF EXISTS `user_roles`;

CREATE TABLE `user_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varchar(255) DEFAULT NULL,
  `user_uid` varchar(255) DEFAULT NULL,
  `role_uid` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `user_roles` */

/*Table structure for table `user_verify` */

DROP TABLE IF EXISTS `user_verify`;

CREATE TABLE `user_verify` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) DEFAULT NULL,
  `key` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `expired_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `user_verify` */

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `account_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `designation` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8_unicode_ci,
  `gender` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` enum('pending','approve','block') COLLATE utf8_unicode_ci DEFAULT 'pending',
  `role` varchar(100) COLLATE utf8_unicode_ci DEFAULT 'guest',
  `action` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mail_notify` enum('yes','no') COLLATE utf8_unicode_ci DEFAULT 'yes',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `users` */

/*Table structure for table `visitor` */

DROP TABLE IF EXISTS `visitor`;

CREATE TABLE `visitor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `query` text,
  `ip` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `country` char(250) DEFAULT NULL,
  `category` char(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `visitor` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
