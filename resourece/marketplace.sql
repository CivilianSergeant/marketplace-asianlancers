/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50536
Source Host           : localhost:3306
Source Database       : marketplace

Target Server Type    : MYSQL
Target Server Version : 50536
File Encoding         : 65001

Date: 2014-08-19 13:32:44
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for admins
-- ----------------------------
DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `contact_number` varchar(45) DEFAULT NULL,
  `photos` varchar(255) DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for certifications
-- ----------------------------
DROP TABLE IF EXISTS `certifications`;
CREATE TABLE `certifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `freelancer_id` int(11) DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `provider` varchar(100) DEFAULT NULL,
  `description` text,
  `date_earned` timestamp NULL DEFAULT NULL,
  `submission_code_or_link` varchar(100) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_freelancer_cert_id` (`freelancer_id`),
  CONSTRAINT `fk_freelancer_cert_id` FOREIGN KEY (`freelancer_id`) REFERENCES `freelancers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for clients
-- ----------------------------
DROP TABLE IF EXISTS `clients`;
CREATE TABLE `clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_status` enum('Active','Suspend') DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `deleted_at` varchar(10) DEFAULT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `contact_number` varchar(100) DEFAULT NULL,
  `photos` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for comments
-- ----------------------------
DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jobthread_id` int(11) DEFAULT NULL,
  `jobthread_type` enum('JobOffer','JobPhase') DEFAULT NULL,
  `message` text,
  `updated_at` date DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `index2` (`jobthread_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for educations
-- ----------------------------
DROP TABLE IF EXISTS `educations`;
CREATE TABLE `educations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `freelancer_id` int(11) DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  `start_yr` int(4) DEFAULT NULL,
  `end_yr` int(4) DEFAULT NULL,
  `degree` varchar(100) DEFAULT NULL,
  `area_of_study` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_freelancer_edu_id` (`freelancer_id`),
  CONSTRAINT `fk_freelancer_edu_id` FOREIGN KEY (`freelancer_id`) REFERENCES `freelancers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for feedbacks
-- ----------------------------
DROP TABLE IF EXISTS `feedbacks`;
CREATE TABLE `feedbacks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `freelancer_id` int(11) DEFAULT NULL,
  `job_offer_id` int(11) DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_freelancer_feedback_id` (`freelancer_id`),
  KEY `fk_joboffer_feedback_id` (`job_offer_id`),
  CONSTRAINT `fk_freelancer_feedback_id` FOREIGN KEY (`freelancer_id`) REFERENCES `job_offers` (`freelancer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_joboffer_feedback_id` FOREIGN KEY (`job_offer_id`) REFERENCES `job_offers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for freelancers
-- ----------------------------
DROP TABLE IF EXISTS `freelancers`;
CREATE TABLE `freelancers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
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
  `address` varchar(200) DEFAULT NULL,
  `contact_number` varchar(45) DEFAULT NULL,
  `photos` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `status` enum('Active','Deactive') DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_freelancer_agency_member_id` (`freelancer_id`),
  KEY `fk_freelancer_agency_owner_id` (`agency_id`),
  CONSTRAINT `fk_freelancer_agency_member_id` FOREIGN KEY (`freelancer_id`) REFERENCES `freelancers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_freelancer_agency_owner_id` FOREIGN KEY (`agency_id`) REFERENCES `freelancers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for groups
-- ----------------------------
DROP TABLE IF EXISTS `groups`;
CREATE TABLE `groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `groups_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for job_categories
-- ----------------------------
DROP TABLE IF EXISTS `job_categories`;
CREATE TABLE `job_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) DEFAULT NULL,
  `description` varchar(300) DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for job_offers
-- ----------------------------
DROP TABLE IF EXISTS `job_offers`;
CREATE TABLE `job_offers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `freelancer_id` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `job_post_id` int(11) DEFAULT NULL,
  `job_offer_status` enum('Pending','Apporve','Cancel','Accepte','Decline') DEFAULT NULL COMMENT 'Admin get Pending Job offer list\nAdmin can Approve or Cancel\nFreelancer can Accept or Decline',
  `job_offer_status_reason` varchar(255) DEFAULT NULL COMMENT 'only use when Decline a job offer',
  `job_offer_price` varchar(45) DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_freelancer_joboffer_id` (`freelancer_id`),
  KEY `fk_joboffer_jobpost_id` (`job_post_id`),
  KEY `fk_job_offer_client_id` (`client_id`),
  CONSTRAINT `fk_freelancer_joboffer_id` FOREIGN KEY (`freelancer_id`) REFERENCES `freelancers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_joboffer_jobpost_id` FOREIGN KEY (`job_post_id`) REFERENCES `job_posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_job_offer_client_id` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for job_phases
-- ----------------------------
DROP TABLE IF EXISTS `job_phases`;
CREATE TABLE `job_phases` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `job_offer_id` int(11) DEFAULT NULL,
  `phase_title` varchar(45) DEFAULT NULL,
  `phase_price` varchar(45) DEFAULT NULL,
  `phase_hour` varchar(45) DEFAULT NULL,
  `phase_payment_status` enum('Done','Hold','Pending') DEFAULT NULL,
  `phase_deadline` date DEFAULT NULL,
  `phase_details` text,
  `updated_at` date DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_joboffer_jobphase_id` (`job_offer_id`),
  CONSTRAINT `fk_joboffer_jobphase_id` FOREIGN KEY (`job_offer_id`) REFERENCES `job_offers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for job_posts
-- ----------------------------
DROP TABLE IF EXISTS `job_posts`;
CREATE TABLE `job_posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) DEFAULT NULL,
  `job_category_id` int(11) DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` varchar(0) DEFAULT NULL,
  `attach_file` varchar(100) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_jobpost_client_id` (`client_id`),
  KEY `fk_jobcategory_jobpost_id` (`job_category_id`),
  CONSTRAINT `fk_jobpost_client_id` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_jobcategory_jobpost_id` FOREIGN KEY (`job_category_id`) REFERENCES `job_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for job_prices
-- ----------------------------
DROP TABLE IF EXISTS `job_prices`;
CREATE TABLE `job_prices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  PRIMARY KEY (`id`),
  KEY `notification_receiver_id` (`receiver_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for payments
-- ----------------------------
DROP TABLE IF EXISTS `payments`;
CREATE TABLE `payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `job_phase_id` int(11) DEFAULT NULL,
  `amount` varchar(45) DEFAULT NULL,
  `release_dt` date DEFAULT NULL,
  `paid_dt` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_payment_jobphase_id` (`job_phase_id`),
  CONSTRAINT `fk_payment_jobphase_id` FOREIGN KEY (`job_phase_id`) REFERENCES `job_phases` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for portfolios
-- ----------------------------
DROP TABLE IF EXISTS `portfolios`;
CREATE TABLE `portfolios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `freelancer_id` int(11) DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `image` varchar(100) DEFAULT NULL,
  `url` varchar(100) DEFAULT NULL,
  `completed_date` timestamp NULL DEFAULT NULL,
  `category_name` varchar(100) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_freelancer_portfolio_id` (`freelancer_id`),
  CONSTRAINT `fk_freelancer_portfolio_id` FOREIGN KEY (`freelancer_id`) REFERENCES `freelancers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for professional_backgrounds
-- ----------------------------
DROP TABLE IF EXISTS `professional_backgrounds`;
CREATE TABLE `professional_backgrounds` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `freelancer_id` int(11) DEFAULT NULL,
  `org_name` varchar(45) DEFAULT NULL,
  `org_type` varchar(45) DEFAULT NULL,
  `start_dt` varchar(45) DEFAULT NULL,
  `end_dt` varchar(45) DEFAULT NULL,
  `current_status` tinyint(1) DEFAULT '0',
  `responsibility` varchar(45) DEFAULT NULL,
  `designation` varchar(100) DEFAULT NULL,
  `url` varchar(45) DEFAULT NULL,
  `address` varchar(45) DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_professional_freelancer_id` (`freelancer_id`),
  CONSTRAINT `fk_professional_freelancer_id` FOREIGN KEY (`freelancer_id`) REFERENCES `freelancers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for question_bank
-- ----------------------------
DROP TABLE IF EXISTS `question_bank`;
CREATE TABLE `question_bank` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` varchar(45) DEFAULT NULL,
  `question_type` enum('Textbox','Checkbox','Radio') DEFAULT NULL,
  `question_set_id` int(11) DEFAULT NULL,
  `level_id` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `answers` varchar(2000) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_questionbank_questionlevel_id` (`level_id`),
  KEY `fk_questionbank_questiongroup_id` (`group_id`),
  KEY `fk_questionbank_questionset_id` (`question_set_id`),
  CONSTRAINT `fk_questionbank_questionlevel_id` FOREIGN KEY (`level_id`) REFERENCES `question_level` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_questionbank_questiongroup_id` FOREIGN KEY (`group_id`) REFERENCES `question_group` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_questionbank_questionset_id` FOREIGN KEY (`question_set_id`) REFERENCES `question_set` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for question_group
-- ----------------------------
DROP TABLE IF EXISTS `question_group`;
CREATE TABLE `question_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for question_level
-- ----------------------------
DROP TABLE IF EXISTS `question_level`;
CREATE TABLE `question_level` (
  `id` int(11) NOT NULL,
  `title` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for question_set
-- ----------------------------
DROP TABLE IF EXISTS `question_set`;
CREATE TABLE `question_set` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `technology` varchar(45) DEFAULT NULL,
  `title` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `created_at` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_freelancercategory_category_id` (`skill_tags_id`),
  KEY `fk_freelancer_related_id` (`relatedentity_id`),
  CONSTRAINT `fk_freelancercategory_category_id` FOREIGN KEY (`skill_tags_id`) REFERENCES `skill_tags` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for skill_tags
-- ----------------------------
DROP TABLE IF EXISTS `skill_tags`;
CREATE TABLE `skill_tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(45) DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for slips
-- ----------------------------
DROP TABLE IF EXISTS `slips`;
CREATE TABLE `slips` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `freelance_id` int(11) DEFAULT NULL,
  `job_offer_id` int(11) DEFAULT NULL,
  `amount` varchar(45) DEFAULT NULL,
  `slip_status` enum('Pending','Done') DEFAULT NULL COMMENT 'By default one entry will inser as pending \n\nWhen admin verified that slip amount is delivered then admin can change this record status',
  `updated_at` date DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `transaction_code` varchar(45) DEFAULT NULL,
  `transaction_type` enum('Cheque','Paypal') DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_freelancer_slip_id` (`freelance_id`),
  KEY `fk_slip_joboffer_id` (`job_offer_id`),
  CONSTRAINT `fk_freelancer_slip_id` FOREIGN KEY (`freelance_id`) REFERENCES `freelancers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_slip_joboffer_id` FOREIGN KEY (`job_offer_id`) REFERENCES `job_offers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for test_taken
-- ----------------------------
DROP TABLE IF EXISTS `test_taken`;
CREATE TABLE `test_taken` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `participent_id` int(11) DEFAULT NULL,
  `answer` varchar(3000) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_test_participent_id` (`participent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for throttle
-- ----------------------------
DROP TABLE IF EXISTS `throttle`;
CREATE TABLE `throttle` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `ip_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `attempts` int(11) NOT NULL DEFAULT '0',
  `suspended` tinyint(1) NOT NULL DEFAULT '0',
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  `last_attempt_at` timestamp NULL DEFAULT NULL,
  `suspended_at` timestamp NULL DEFAULT NULL,
  `banned_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `throttle_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for users_groups
-- ----------------------------
DROP TABLE IF EXISTS `users_groups`;
CREATE TABLE `users_groups` (
  `user_id` int(10) unsigned NOT NULL,
  `group_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
