/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50536
Source Host           : localhost:3306
Source Database       : marketplace

Target Server Type    : MYSQL
Target Server Version : 50536
File Encoding         : 65001

Date: 2014-09-11 18:17:50
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for related_tags
-- ----------------------------
DROP TABLE IF EXISTS `related_tags`;
CREATE TABLE `related_tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `relatedentity_id` int(11) DEFAULT NULL,
  `relatedentity_type` enum('Freelancer','JobPost') DEFAULT NULL,
  `skill_tags_id` int(11) DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `created_at` date NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `display` tinyint(1) NOT NULL DEFAULT '1',
  `test_taken` tinyint(1) NOT NULL DEFAULT '0',
  `test_start_at` varchar(100) NOT NULL,
  `test_end_at` varchar(100) NOT NULL,
  `test_data` text NOT NULL,
  `last_question_index` int(11) DEFAULT NULL,
  `test_result` text NOT NULL,
  `last_question_set` int(11) NOT NULL,
  `retake_date` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_freelancercategory_category_id` (`skill_tags_id`),
  KEY `fk_freelancer_related_id` (`relatedentity_id`),
  CONSTRAINT `fk_freelancercategory_category_id` FOREIGN KEY (`skill_tags_id`) REFERENCES `skill_tags` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
