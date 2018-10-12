/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50536
Source Host           : localhost:3306
Source Database       : marketplace

Target Server Type    : MYSQL
Target Server Version : 50536
File Encoding         : 65001

Date: 2014-09-24 12:07:08
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for freelancer_agency
-- ----------------------------
DROP TABLE IF EXISTS `freelancer_agency`;
CREATE TABLE `freelancer_agency` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `freelancer_id` int(11) DEFAULT NULL COMMENT 'individual freelancer_id',
  `agency_id` int(11) DEFAULT NULL COMMENT 'individual freelancer_id as a owner of agency',
  `agency_join_dt` date DEFAULT NULL COMMENT '\n',
  `agency_leave_dt` date DEFAULT NULL,
  `status` enum('Accepted','Canceled','Requested','Inactivated') DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_freelancer_agency_member_id` (`freelancer_id`),
  KEY `fk_freelancer_agency_owner_id` (`agency_id`),
  CONSTRAINT `fk_freelancer_agency_member_id` FOREIGN KEY (`freelancer_id`) REFERENCES `freelancers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_freelancer_agency_owner_id` FOREIGN KEY (`agency_id`) REFERENCES `freelancers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of freelancer_agency
-- ----------------------------
INSERT INTO `freelancer_agency` VALUES ('19', '5', '9', null, null, 'Accepted', '2014-09-24', '2014-09-23');

-- ----------------------------
-- Table structure for notifications
-- ----------------------------
DROP TABLE IF EXISTS `notifications`;
CREATE TABLE `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `receiver_id` int(11) DEFAULT NULL,
  `subject` varchar(45) DEFAULT NULL,
  `message` text,
  `read_status` tinyint(1) DEFAULT NULL,
  `receiver_type` enum('Admin','Freelancer','Client') DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `url` varchar(255) NOT NULL,
  `notification_type` enum('Job Interview','Team Invitation') NOT NULL,
  `object_id` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notification_receiver_id` (`receiver_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of notifications
-- ----------------------------
INSERT INTO `notifications` VALUES ('8', '5', 'Agency Team invitation', 'You get an team invitation from agency <b>a j</b> <br/> Visit agency profile link <a target=\"_blank\" href=\"http://freelancer.marketplace/view/freelancer/wTR1TP\">http://freelancer.marketplace/view/freelancer/wTR1TP</a>', '0', 'Freelancer', '2014-09-23', '2014-09-23', 'freelancer/team-invitation/QTUtWP', 'Team Invitation', 'QTUtWP');
INSERT INTO `notifications` VALUES ('9', '9', 'Member Joined', '<strong>First Namesdf Last Namesdf joined to your agency', '0', 'Freelancer', '2014-09-24', '2014-09-24', '', 'Team Invitation', 'QTUtWP');
