/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50616
Source Host           : localhost:3306
Source Database       : marketplace

Target Server Type    : MYSQL
Target Server Version : 50616
File Encoding         : 65001

Date: 2014-09-01 14:41:19
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for clients
-- ----------------------------
DROP TABLE IF EXISTS `clients`;
CREATE TABLE `clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `contact_number` varchar(100) DEFAULT NULL,
  `photos` varchar(255) DEFAULT NULL,
  `client_status` enum('Active','Suspend') DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `deleted_at` varchar(10) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of clients
-- ----------------------------
INSERT INTO `clients` VALUES ('2', 'tanvir', 'anowar', null, null, null, 'Active', '2014-08-31', '2014-08-31', null, 'tanvir@carbon51.com');

-- ----------------------------
-- Table structure for freelancers
-- ----------------------------
DROP TABLE IF EXISTS `freelancers`;
CREATE TABLE `freelancers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `agency_name` varchar(255) DEFAULT NULL,
  `profile_title` varchar(255) DEFAULT NULL,
  `freelancer_type` enum('Agency','Individual') DEFAULT NULL,
  `freelancer_price` varchar(45) DEFAULT NULL,
  `publish_status` tinyint(1) DEFAULT '0',
  `updated_at` date DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `years_of_experience` tinyint(4) DEFAULT NULL,
  `overview` text,
  `my_video` varchar(45) DEFAULT NULL,
  `contact_number` varchar(45) DEFAULT NULL,
  `photos` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `address_area` varchar(20) DEFAULT NULL,
  `address_city` varchar(20) DEFAULT NULL,
  `address_zip` int(5) DEFAULT NULL,
  `address_country` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of freelancers
-- ----------------------------
INSERT INTO `freelancers` VALUES ('2', 'ii', 'ii', '', null, 'Individual', '0', '1', '2014-08-28', '2014-08-28', 'i@ix.com', null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `freelancers` VALUES ('4', 'lkjlkjlkj', 'jlkjklj', 'jdslkf lkj', null, 'Agency', '0', '1', '2014-08-31', '2014-08-31', 'a@a.com', null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `freelancers` VALUES ('5', 'ind', 'ind', '', null, 'Individual', '0', '1', '2014-08-31', '2014-08-31', 'i@i.com', null, null, null, '10220', null, null, 'nik', 'gul', 'dhk', '1212', 'bd');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8_unicode_ci,
  `activated` tinyint(1) NOT NULL DEFAULT '0',
  `activation_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activated_at` timestamp NULL DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `persist_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reset_password_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `user_type` enum('Freelancer','Admin','Client') COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_activation_code_index` (`activation_code`),
  KEY `users_reset_password_code_index` (`reset_password_code`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('2', 'a@a2.com', '$2y$10$S3P8DPQaTUqYzOZXY4DB3OUSEOYWHL3./yhEPOi.wmh3t4YsoW.WW', null, '1', null, null, '2014-08-31 08:10:19', '$2y$10$uGnwPjTUaa9E5GGcwVPhOeoY59Dj/.NuQpLUO0BN4ZhjnMQo49t4C', null, 'Admin', 'Admin', '2014-08-23 13:15:23', '2014-08-31 08:10:19', null, 'Admin');
INSERT INTO `users` VALUES ('22', 'f@f.com', '$2y$10$Ja2dNKL94zNFweefh5h9G.gNM3ZPC4yxLSWZIIZBEFOLGtirft/sm', null, '1', null, '2014-08-25 09:00:00', '2014-08-31 08:17:14', '$2y$10$RmWjex4tLJ6Mp.Gat77rpeDTModuwAJcgzpB3iVISXpe4PtHg6.me', null, 'Free', 'First', '2014-08-25 08:58:38', '2014-08-31 08:17:14', null, 'Freelancer');
INSERT INTO `users` VALUES ('32', 'm@m.com', '$2y$10$xehM5eAJmUSM4nfT/nS3tevQLIpWfT1.7RxAlFExfm5G6cQl1f8KK', null, '1', null, '2014-08-27 12:49:29', null, null, null, 'max', 'well', '2014-08-27 12:48:39', '2014-08-27 12:49:29', null, 'Freelancer');
INSERT INTO `users` VALUES ('45', 'c@c.com', '$2y$10$Nik6I55NxLbGRTevZ2VO/e/suqvzKz6B76XlauuZmXia83p8mgQg.', null, '1', null, '2014-08-31 09:55:05', null, null, null, 'tanvir', 'anowar', '2014-08-31 09:54:26', '2014-08-31 09:55:05', null, 'Client');
INSERT INTO `users` VALUES ('47', 'a@a.com', '$2y$10$03gUHwmiUhQZqLSMVBg73O7rsEkgfjcbM6/58PvGz5iLA/YP64Yt.', null, '1', null, '2014-08-31 10:04:49', null, null, null, 'lkjlkjlkj', 'jlkjklj', '2014-08-31 10:04:34', '2014-08-31 10:04:49', null, 'Freelancer');
INSERT INTO `users` VALUES ('48', 'i@i.com', '$2y$10$GUSVREiVfK8jB2WbwIPerOJXXldRoS3LUBPhkM4xFpU0yKvUx941u', null, '1', null, '2014-08-31 10:32:02', '2014-08-31 10:56:01', '$2y$10$bR3MnDdM29w8Qknu4wDKEeEh8m84ML3hZu...djZztINeEbjeT8AK', null, 'ind', 'ind', '2014-08-31 10:31:49', '2014-08-31 10:56:01', null, 'Freelancer');
