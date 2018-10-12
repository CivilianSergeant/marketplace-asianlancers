/*
Navicat MySQL Data Transfer

Source Server         : gameshader.net_3306
Source Server Version : 50540
Source Host           : gameshader.net:3306
Source Database       : gameshad_marketplace

Target Server Type    : MYSQL
Target Server Version : 50540
File Encoding         : 65001

Date: 2014-11-09 16:53:49
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for discussion_comments
-- ----------------------------
DROP TABLE IF EXISTS `discussion_comments`;
CREATE TABLE `discussion_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `discussion_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `sender_type` enum('Admin','Client','Freelancer') DEFAULT NULL,
  `receiver_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `read_status` tinyint(1) NOT NULL,
  `attachment` text,
  `type` enum('Comment','Notification') NOT NULL,
  `updated_at` date NOT NULL,
  `created_at` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `discussion_id` (`discussion_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for discussions
-- ----------------------------
DROP TABLE IF EXISTS `discussions`;
CREATE TABLE `discussions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(100) NOT NULL,
  `details` text NOT NULL,
  `sender_id` int(11) NOT NULL,
  `sender_type` enum('Admin','Client','Freelancer') DEFAULT NULL,
  `receivers` varchar(1000) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL,
  `attachment` text,
  `updated_at` date NOT NULL,
  `created_at` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
