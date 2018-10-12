/*
Navicat MySQL Data Transfer

Source Server         : gameshader.net_3306
Source Server Version : 50540
Source Host           : gameshader.net:3306
Source Database       : gameshad_marketplace

Target Server Type    : MYSQL
Target Server Version : 50540
File Encoding         : 65001

Date: 2014-11-09 17:50:56
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of admins
-- ----------------------------
INSERT INTO `admins` VALUES ('1', 'superadmin', 'superadmin@mail.com', null, null, null, null);
INSERT INTO `admins` VALUES ('2', 'a', 'a@a.com', null, null, null, null);

-- ----------------------------
-- Table structure for certifications
-- ----------------------------
DROP TABLE IF EXISTS `certifications`;
CREATE TABLE `certifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `freelancer_id` int(11) DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `provider` varchar(100) DEFAULT NULL,
  `description` text,
  `date_earned` timestamp NULL DEFAULT NULL,
  `submission_code_or_link` varchar(100) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_freelancer_cert_id` (`freelancer_id`) USING BTREE,
  CONSTRAINT `certifications_ibfk_1` FOREIGN KEY (`freelancer_id`) REFERENCES `freelancers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of certifications
-- ----------------------------
INSERT INTO `certifications` VALUES ('1', '5', '2014-10-27', '2014-10-22', 'Certification Titles', 'Zend Framework', 'Some Descriptions', '2002-02-15 14:00:00', 'carbon51.com', null);

-- ----------------------------
-- Table structure for clients
-- ----------------------------
DROP TABLE IF EXISTS `clients`;
CREATE TABLE `clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `profile_title` varchar(255) DEFAULT NULL,
  `description` text,
  `country` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `province` varchar(50) DEFAULT NULL,
  `postal_code` varchar(40) DEFAULT NULL,
  `contact_number` varchar(100) DEFAULT NULL,
  `photos` varchar(255) DEFAULT NULL,
  `client_status` enum('Active','Suspend') DEFAULT NULL,
  `picture_widget` tinyint(4) NOT NULL DEFAULT '1',
  `address_widget` tinyint(4) NOT NULL DEFAULT '1',
  `country_widget` tinyint(4) NOT NULL DEFAULT '1',
  `phone_widget` tinyint(4) NOT NULL DEFAULT '0',
  `updated_at` date DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `deleted_at` varchar(10) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of clients
-- ----------------------------
INSERT INTO `clients` VALUES ('5', 'Tahmina', 'Akter', 'Mohakhali', 'Mohakhali', 'a', 'bb', 'BANGLADESH', 'Dhaka', 'Dhaka', '2121', '+881234569', '1_544de5eb59ddd.png', 'Active', '1', '1', '1', '1', '2014-10-28', '2014-10-23', null, null);
INSERT INTO `clients` VALUES ('6', 'johir', 'uddin', null, null, null, null, null, null, null, null, null, null, 'Active', '1', '1', '1', '1', '2014-10-23', '2014-10-23', null, null);
INSERT INTO `clients` VALUES ('7', 'Carbon', 'carbon', null, null, null, null, null, null, null, null, null, null, 'Active', '1', '1', '1', '1', '2014-10-27', '2014-10-27', null, null);
INSERT INTO `clients` VALUES ('9', 'Sanaul', 'Ishaque', null, null, null, null, null, null, null, null, null, null, null, '1', '1', '1', '0', '2014-11-04', '2014-11-04', null, null);
INSERT INTO `clients` VALUES ('10', 'Tanvirs', 'Anowars', '19/c', 'NEW DOHS', 'Freelance recruiter', 'Hire freelancer.', 'BANGLADESH', 'dhak', 'dhaka', '1212', '017654546', '2inc_545f05dd256a1.jpg', 'Active', '1', '1', '1', '0', '2014-11-09', '2014-11-09', null, null);
INSERT INTO `clients` VALUES ('11', 'Tanvir', 'Anowar', 'New DOHS', 'mohakhali', 'Hire freelancer', 'PHP and ASP.NET developer searching', 'BANGLADESH', 'Dhaka', 'Dhaka', '1212', '017551632132', '2inc_545f49f54f3f6.jpg', null, '1', '1', '1', '0', '2014-11-09', '2014-11-09', null, null);

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
  `deleted_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `honour_id` int(11) DEFAULT NULL,
  `honour_type` enum('Freelancer','Client','Admin') DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `index2` (`jobthread_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of comments
-- ----------------------------
INSERT INTO `comments` VALUES ('1', '13', 'JobOffer', 'Thanks for your participation', '2014-10-29', '2014-10-29', null, '2', 'Client');
INSERT INTO `comments` VALUES ('2', '16', 'JobOffer', 'himel what is the progress of the project ?', '2014-11-09', '2014-11-09', null, '10', 'Client');
INSERT INTO `comments` VALUES ('3', '16', 'JobOffer', 'Hello', '2014-11-09', '2014-11-09', null, '22', 'Freelancer');
INSERT INTO `comments` VALUES ('4', '17', 'JobOffer', 'do you know angular js ?', '2014-11-09', '2014-11-09', null, '11', 'Client');
INSERT INTO `comments` VALUES ('5', '17', 'JobOffer', 'Yes I know how to work with angularJs', '2014-11-09', '2014-11-09', null, '22', 'Freelancer');

-- ----------------------------
-- Table structure for country
-- ----------------------------
DROP TABLE IF EXISTS `country`;
CREATE TABLE `country` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iso` char(2) NOT NULL,
  `name` varchar(80) NOT NULL,
  `nicename` varchar(80) NOT NULL,
  `iso3` char(3) DEFAULT NULL,
  `numcode` smallint(6) DEFAULT NULL,
  `phonecode` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=240 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of country
-- ----------------------------
INSERT INTO `country` VALUES ('1', 'AF', 'AFGHANISTAN', 'Afghanistan', 'AFG', '4', '93');
INSERT INTO `country` VALUES ('2', 'AL', 'ALBANIA', 'Albania', 'ALB', '8', '355');
INSERT INTO `country` VALUES ('3', 'DZ', 'ALGERIA', 'Algeria', 'DZA', '12', '213');
INSERT INTO `country` VALUES ('4', 'AS', 'AMERICAN SAMOA', 'American Samoa', 'ASM', '16', '1684');
INSERT INTO `country` VALUES ('5', 'AD', 'ANDORRA', 'Andorra', 'AND', '20', '376');
INSERT INTO `country` VALUES ('6', 'AO', 'ANGOLA', 'Angola', 'AGO', '24', '244');
INSERT INTO `country` VALUES ('7', 'AI', 'ANGUILLA', 'Anguilla', 'AIA', '660', '1264');
INSERT INTO `country` VALUES ('8', 'AQ', 'ANTARCTICA', 'Antarctica', null, null, '0');
INSERT INTO `country` VALUES ('9', 'AG', 'ANTIGUA AND BARBUDA', 'Antigua and Barbuda', 'ATG', '28', '1268');
INSERT INTO `country` VALUES ('10', 'AR', 'ARGENTINA', 'Argentina', 'ARG', '32', '54');
INSERT INTO `country` VALUES ('11', 'AM', 'ARMENIA', 'Armenia', 'ARM', '51', '374');
INSERT INTO `country` VALUES ('12', 'AW', 'ARUBA', 'Aruba', 'ABW', '533', '297');
INSERT INTO `country` VALUES ('13', 'AU', 'AUSTRALIA', 'Australia', 'AUS', '36', '61');
INSERT INTO `country` VALUES ('14', 'AT', 'AUSTRIA', 'Austria', 'AUT', '40', '43');
INSERT INTO `country` VALUES ('15', 'AZ', 'AZERBAIJAN', 'Azerbaijan', 'AZE', '31', '994');
INSERT INTO `country` VALUES ('16', 'BS', 'BAHAMAS', 'Bahamas', 'BHS', '44', '1242');
INSERT INTO `country` VALUES ('17', 'BH', 'BAHRAIN', 'Bahrain', 'BHR', '48', '973');
INSERT INTO `country` VALUES ('18', 'BD', 'BANGLADESH', 'Bangladesh', 'BGD', '50', '880');
INSERT INTO `country` VALUES ('19', 'BB', 'BARBADOS', 'Barbados', 'BRB', '52', '1246');
INSERT INTO `country` VALUES ('20', 'BY', 'BELARUS', 'Belarus', 'BLR', '112', '375');
INSERT INTO `country` VALUES ('21', 'BE', 'BELGIUM', 'Belgium', 'BEL', '56', '32');
INSERT INTO `country` VALUES ('22', 'BZ', 'BELIZE', 'Belize', 'BLZ', '84', '501');
INSERT INTO `country` VALUES ('23', 'BJ', 'BENIN', 'Benin', 'BEN', '204', '229');
INSERT INTO `country` VALUES ('24', 'BM', 'BERMUDA', 'Bermuda', 'BMU', '60', '1441');
INSERT INTO `country` VALUES ('25', 'BT', 'BHUTAN', 'Bhutan', 'BTN', '64', '975');
INSERT INTO `country` VALUES ('26', 'BO', 'BOLIVIA', 'Bolivia', 'BOL', '68', '591');
INSERT INTO `country` VALUES ('27', 'BA', 'BOSNIA AND HERZEGOVINA', 'Bosnia and Herzegovina', 'BIH', '70', '387');
INSERT INTO `country` VALUES ('28', 'BW', 'BOTSWANA', 'Botswana', 'BWA', '72', '267');
INSERT INTO `country` VALUES ('29', 'BV', 'BOUVET ISLAND', 'Bouvet Island', null, null, '0');
INSERT INTO `country` VALUES ('30', 'BR', 'BRAZIL', 'Brazil', 'BRA', '76', '55');
INSERT INTO `country` VALUES ('31', 'IO', 'BRITISH INDIAN OCEAN TERRITORY', 'British Indian Ocean Territory', null, null, '246');
INSERT INTO `country` VALUES ('32', 'BN', 'BRUNEI DARUSSALAM', 'Brunei Darussalam', 'BRN', '96', '673');
INSERT INTO `country` VALUES ('33', 'BG', 'BULGARIA', 'Bulgaria', 'BGR', '100', '359');
INSERT INTO `country` VALUES ('34', 'BF', 'BURKINA FASO', 'Burkina Faso', 'BFA', '854', '226');
INSERT INTO `country` VALUES ('35', 'BI', 'BURUNDI', 'Burundi', 'BDI', '108', '257');
INSERT INTO `country` VALUES ('36', 'KH', 'CAMBODIA', 'Cambodia', 'KHM', '116', '855');
INSERT INTO `country` VALUES ('37', 'CM', 'CAMEROON', 'Cameroon', 'CMR', '120', '237');
INSERT INTO `country` VALUES ('38', 'CA', 'CANADA', 'Canada', 'CAN', '124', '1');
INSERT INTO `country` VALUES ('39', 'CV', 'CAPE VERDE', 'Cape Verde', 'CPV', '132', '238');
INSERT INTO `country` VALUES ('40', 'KY', 'CAYMAN ISLANDS', 'Cayman Islands', 'CYM', '136', '1345');
INSERT INTO `country` VALUES ('41', 'CF', 'CENTRAL AFRICAN REPUBLIC', 'Central African Republic', 'CAF', '140', '236');
INSERT INTO `country` VALUES ('42', 'TD', 'CHAD', 'Chad', 'TCD', '148', '235');
INSERT INTO `country` VALUES ('43', 'CL', 'CHILE', 'Chile', 'CHL', '152', '56');
INSERT INTO `country` VALUES ('44', 'CN', 'CHINA', 'China', 'CHN', '156', '86');
INSERT INTO `country` VALUES ('45', 'CX', 'CHRISTMAS ISLAND', 'Christmas Island', null, null, '61');
INSERT INTO `country` VALUES ('46', 'CC', 'COCOS (KEELING) ISLANDS', 'Cocos (Keeling) Islands', null, null, '672');
INSERT INTO `country` VALUES ('47', 'CO', 'COLOMBIA', 'Colombia', 'COL', '170', '57');
INSERT INTO `country` VALUES ('48', 'KM', 'COMOROS', 'Comoros', 'COM', '174', '269');
INSERT INTO `country` VALUES ('49', 'CG', 'CONGO', 'Congo', 'COG', '178', '242');
INSERT INTO `country` VALUES ('50', 'CD', 'CONGO, THE DEMOCRATIC REPUBLIC OF THE', 'Congo, the Democratic Republic of the', 'COD', '180', '242');
INSERT INTO `country` VALUES ('51', 'CK', 'COOK ISLANDS', 'Cook Islands', 'COK', '184', '682');
INSERT INTO `country` VALUES ('52', 'CR', 'COSTA RICA', 'Costa Rica', 'CRI', '188', '506');
INSERT INTO `country` VALUES ('53', 'CI', 'COTE D\'IVOIRE', 'Cote D\'Ivoire', 'CIV', '384', '225');
INSERT INTO `country` VALUES ('54', 'HR', 'CROATIA', 'Croatia', 'HRV', '191', '385');
INSERT INTO `country` VALUES ('55', 'CU', 'CUBA', 'Cuba', 'CUB', '192', '53');
INSERT INTO `country` VALUES ('56', 'CY', 'CYPRUS', 'Cyprus', 'CYP', '196', '357');
INSERT INTO `country` VALUES ('57', 'CZ', 'CZECH REPUBLIC', 'Czech Republic', 'CZE', '203', '420');
INSERT INTO `country` VALUES ('58', 'DK', 'DENMARK', 'Denmark', 'DNK', '208', '45');
INSERT INTO `country` VALUES ('59', 'DJ', 'DJIBOUTI', 'Djibouti', 'DJI', '262', '253');
INSERT INTO `country` VALUES ('60', 'DM', 'DOMINICA', 'Dominica', 'DMA', '212', '1767');
INSERT INTO `country` VALUES ('61', 'DO', 'DOMINICAN REPUBLIC', 'Dominican Republic', 'DOM', '214', '1809');
INSERT INTO `country` VALUES ('62', 'EC', 'ECUADOR', 'Ecuador', 'ECU', '218', '593');
INSERT INTO `country` VALUES ('63', 'EG', 'EGYPT', 'Egypt', 'EGY', '818', '20');
INSERT INTO `country` VALUES ('64', 'SV', 'EL SALVADOR', 'El Salvador', 'SLV', '222', '503');
INSERT INTO `country` VALUES ('65', 'GQ', 'EQUATORIAL GUINEA', 'Equatorial Guinea', 'GNQ', '226', '240');
INSERT INTO `country` VALUES ('66', 'ER', 'ERITREA', 'Eritrea', 'ERI', '232', '291');
INSERT INTO `country` VALUES ('67', 'EE', 'ESTONIA', 'Estonia', 'EST', '233', '372');
INSERT INTO `country` VALUES ('68', 'ET', 'ETHIOPIA', 'Ethiopia', 'ETH', '231', '251');
INSERT INTO `country` VALUES ('69', 'FK', 'FALKLAND ISLANDS (MALVINAS)', 'Falkland Islands (Malvinas)', 'FLK', '238', '500');
INSERT INTO `country` VALUES ('70', 'FO', 'FAROE ISLANDS', 'Faroe Islands', 'FRO', '234', '298');
INSERT INTO `country` VALUES ('71', 'FJ', 'FIJI', 'Fiji', 'FJI', '242', '679');
INSERT INTO `country` VALUES ('72', 'FI', 'FINLAND', 'Finland', 'FIN', '246', '358');
INSERT INTO `country` VALUES ('73', 'FR', 'FRANCE', 'France', 'FRA', '250', '33');
INSERT INTO `country` VALUES ('74', 'GF', 'FRENCH GUIANA', 'French Guiana', 'GUF', '254', '594');
INSERT INTO `country` VALUES ('75', 'PF', 'FRENCH POLYNESIA', 'French Polynesia', 'PYF', '258', '689');
INSERT INTO `country` VALUES ('76', 'TF', 'FRENCH SOUTHERN TERRITORIES', 'French Southern Territories', null, null, '0');
INSERT INTO `country` VALUES ('77', 'GA', 'GABON', 'Gabon', 'GAB', '266', '241');
INSERT INTO `country` VALUES ('78', 'GM', 'GAMBIA', 'Gambia', 'GMB', '270', '220');
INSERT INTO `country` VALUES ('79', 'GE', 'GEORGIA', 'Georgia', 'GEO', '268', '995');
INSERT INTO `country` VALUES ('80', 'DE', 'GERMANY', 'Germany', 'DEU', '276', '49');
INSERT INTO `country` VALUES ('81', 'GH', 'GHANA', 'Ghana', 'GHA', '288', '233');
INSERT INTO `country` VALUES ('82', 'GI', 'GIBRALTAR', 'Gibraltar', 'GIB', '292', '350');
INSERT INTO `country` VALUES ('83', 'GR', 'GREECE', 'Greece', 'GRC', '300', '30');
INSERT INTO `country` VALUES ('84', 'GL', 'GREENLAND', 'Greenland', 'GRL', '304', '299');
INSERT INTO `country` VALUES ('85', 'GD', 'GRENADA', 'Grenada', 'GRD', '308', '1473');
INSERT INTO `country` VALUES ('86', 'GP', 'GUADELOUPE', 'Guadeloupe', 'GLP', '312', '590');
INSERT INTO `country` VALUES ('87', 'GU', 'GUAM', 'Guam', 'GUM', '316', '1671');
INSERT INTO `country` VALUES ('88', 'GT', 'GUATEMALA', 'Guatemala', 'GTM', '320', '502');
INSERT INTO `country` VALUES ('89', 'GN', 'GUINEA', 'Guinea', 'GIN', '324', '224');
INSERT INTO `country` VALUES ('90', 'GW', 'GUINEA-BISSAU', 'Guinea-Bissau', 'GNB', '624', '245');
INSERT INTO `country` VALUES ('91', 'GY', 'GUYANA', 'Guyana', 'GUY', '328', '592');
INSERT INTO `country` VALUES ('92', 'HT', 'HAITI', 'Haiti', 'HTI', '332', '509');
INSERT INTO `country` VALUES ('93', 'HM', 'HEARD ISLAND AND MCDONALD ISLANDS', 'Heard Island and Mcdonald Islands', null, null, '0');
INSERT INTO `country` VALUES ('94', 'VA', 'HOLY SEE (VATICAN CITY STATE)', 'Holy See (Vatican City State)', 'VAT', '336', '39');
INSERT INTO `country` VALUES ('95', 'HN', 'HONDURAS', 'Honduras', 'HND', '340', '504');
INSERT INTO `country` VALUES ('96', 'HK', 'HONG KONG', 'Hong Kong', 'HKG', '344', '852');
INSERT INTO `country` VALUES ('97', 'HU', 'HUNGARY', 'Hungary', 'HUN', '348', '36');
INSERT INTO `country` VALUES ('98', 'IS', 'ICELAND', 'Iceland', 'ISL', '352', '354');
INSERT INTO `country` VALUES ('99', 'IN', 'INDIA', 'India', 'IND', '356', '91');
INSERT INTO `country` VALUES ('100', 'ID', 'INDONESIA', 'Indonesia', 'IDN', '360', '62');
INSERT INTO `country` VALUES ('101', 'IR', 'IRAN, ISLAMIC REPUBLIC OF', 'Iran, Islamic Republic of', 'IRN', '364', '98');
INSERT INTO `country` VALUES ('102', 'IQ', 'IRAQ', 'Iraq', 'IRQ', '368', '964');
INSERT INTO `country` VALUES ('103', 'IE', 'IRELAND', 'Ireland', 'IRL', '372', '353');
INSERT INTO `country` VALUES ('104', 'IL', 'ISRAEL', 'Israel', 'ISR', '376', '972');
INSERT INTO `country` VALUES ('105', 'IT', 'ITALY', 'Italy', 'ITA', '380', '39');
INSERT INTO `country` VALUES ('106', 'JM', 'JAMAICA', 'Jamaica', 'JAM', '388', '1876');
INSERT INTO `country` VALUES ('107', 'JP', 'JAPAN', 'Japan', 'JPN', '392', '81');
INSERT INTO `country` VALUES ('108', 'JO', 'JORDAN', 'Jordan', 'JOR', '400', '962');
INSERT INTO `country` VALUES ('109', 'KZ', 'KAZAKHSTAN', 'Kazakhstan', 'KAZ', '398', '7');
INSERT INTO `country` VALUES ('110', 'KE', 'KENYA', 'Kenya', 'KEN', '404', '254');
INSERT INTO `country` VALUES ('111', 'KI', 'KIRIBATI', 'Kiribati', 'KIR', '296', '686');
INSERT INTO `country` VALUES ('112', 'KP', 'KOREA, DEMOCRATIC PEOPLE\'S REPUBLIC OF', 'Korea, Democratic People\'s Republic of', 'PRK', '408', '850');
INSERT INTO `country` VALUES ('113', 'KR', 'KOREA, REPUBLIC OF', 'Korea, Republic of', 'KOR', '410', '82');
INSERT INTO `country` VALUES ('114', 'KW', 'KUWAIT', 'Kuwait', 'KWT', '414', '965');
INSERT INTO `country` VALUES ('115', 'KG', 'KYRGYZSTAN', 'Kyrgyzstan', 'KGZ', '417', '996');
INSERT INTO `country` VALUES ('116', 'LA', 'LAO PEOPLE\'S DEMOCRATIC REPUBLIC', 'Lao People\'s Democratic Republic', 'LAO', '418', '856');
INSERT INTO `country` VALUES ('117', 'LV', 'LATVIA', 'Latvia', 'LVA', '428', '371');
INSERT INTO `country` VALUES ('118', 'LB', 'LEBANON', 'Lebanon', 'LBN', '422', '961');
INSERT INTO `country` VALUES ('119', 'LS', 'LESOTHO', 'Lesotho', 'LSO', '426', '266');
INSERT INTO `country` VALUES ('120', 'LR', 'LIBERIA', 'Liberia', 'LBR', '430', '231');
INSERT INTO `country` VALUES ('121', 'LY', 'LIBYAN ARAB JAMAHIRIYA', 'Libyan Arab Jamahiriya', 'LBY', '434', '218');
INSERT INTO `country` VALUES ('122', 'LI', 'LIECHTENSTEIN', 'Liechtenstein', 'LIE', '438', '423');
INSERT INTO `country` VALUES ('123', 'LT', 'LITHUANIA', 'Lithuania', 'LTU', '440', '370');
INSERT INTO `country` VALUES ('124', 'LU', 'LUXEMBOURG', 'Luxembourg', 'LUX', '442', '352');
INSERT INTO `country` VALUES ('125', 'MO', 'MACAO', 'Macao', 'MAC', '446', '853');
INSERT INTO `country` VALUES ('126', 'MK', 'MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF', 'Macedonia, the Former Yugoslav Republic of', 'MKD', '807', '389');
INSERT INTO `country` VALUES ('127', 'MG', 'MADAGASCAR', 'Madagascar', 'MDG', '450', '261');
INSERT INTO `country` VALUES ('128', 'MW', 'MALAWI', 'Malawi', 'MWI', '454', '265');
INSERT INTO `country` VALUES ('129', 'MY', 'MALAYSIA', 'Malaysia', 'MYS', '458', '60');
INSERT INTO `country` VALUES ('130', 'MV', 'MALDIVES', 'Maldives', 'MDV', '462', '960');
INSERT INTO `country` VALUES ('131', 'ML', 'MALI', 'Mali', 'MLI', '466', '223');
INSERT INTO `country` VALUES ('132', 'MT', 'MALTA', 'Malta', 'MLT', '470', '356');
INSERT INTO `country` VALUES ('133', 'MH', 'MARSHALL ISLANDS', 'Marshall Islands', 'MHL', '584', '692');
INSERT INTO `country` VALUES ('134', 'MQ', 'MARTINIQUE', 'Martinique', 'MTQ', '474', '596');
INSERT INTO `country` VALUES ('135', 'MR', 'MAURITANIA', 'Mauritania', 'MRT', '478', '222');
INSERT INTO `country` VALUES ('136', 'MU', 'MAURITIUS', 'Mauritius', 'MUS', '480', '230');
INSERT INTO `country` VALUES ('137', 'YT', 'MAYOTTE', 'Mayotte', null, null, '269');
INSERT INTO `country` VALUES ('138', 'MX', 'MEXICO', 'Mexico', 'MEX', '484', '52');
INSERT INTO `country` VALUES ('139', 'FM', 'MICRONESIA, FEDERATED STATES OF', 'Micronesia, Federated States of', 'FSM', '583', '691');
INSERT INTO `country` VALUES ('140', 'MD', 'MOLDOVA, REPUBLIC OF', 'Moldova, Republic of', 'MDA', '498', '373');
INSERT INTO `country` VALUES ('141', 'MC', 'MONACO', 'Monaco', 'MCO', '492', '377');
INSERT INTO `country` VALUES ('142', 'MN', 'MONGOLIA', 'Mongolia', 'MNG', '496', '976');
INSERT INTO `country` VALUES ('143', 'MS', 'MONTSERRAT', 'Montserrat', 'MSR', '500', '1664');
INSERT INTO `country` VALUES ('144', 'MA', 'MOROCCO', 'Morocco', 'MAR', '504', '212');
INSERT INTO `country` VALUES ('145', 'MZ', 'MOZAMBIQUE', 'Mozambique', 'MOZ', '508', '258');
INSERT INTO `country` VALUES ('146', 'MM', 'MYANMAR', 'Myanmar', 'MMR', '104', '95');
INSERT INTO `country` VALUES ('147', 'NA', 'NAMIBIA', 'Namibia', 'NAM', '516', '264');
INSERT INTO `country` VALUES ('148', 'NR', 'NAURU', 'Nauru', 'NRU', '520', '674');
INSERT INTO `country` VALUES ('149', 'NP', 'NEPAL', 'Nepal', 'NPL', '524', '977');
INSERT INTO `country` VALUES ('150', 'NL', 'NETHERLANDS', 'Netherlands', 'NLD', '528', '31');
INSERT INTO `country` VALUES ('151', 'AN', 'NETHERLANDS ANTILLES', 'Netherlands Antilles', 'ANT', '530', '599');
INSERT INTO `country` VALUES ('152', 'NC', 'NEW CALEDONIA', 'New Caledonia', 'NCL', '540', '687');
INSERT INTO `country` VALUES ('153', 'NZ', 'NEW ZEALAND', 'New Zealand', 'NZL', '554', '64');
INSERT INTO `country` VALUES ('154', 'NI', 'NICARAGUA', 'Nicaragua', 'NIC', '558', '505');
INSERT INTO `country` VALUES ('155', 'NE', 'NIGER', 'Niger', 'NER', '562', '227');
INSERT INTO `country` VALUES ('156', 'NG', 'NIGERIA', 'Nigeria', 'NGA', '566', '234');
INSERT INTO `country` VALUES ('157', 'NU', 'NIUE', 'Niue', 'NIU', '570', '683');
INSERT INTO `country` VALUES ('158', 'NF', 'NORFOLK ISLAND', 'Norfolk Island', 'NFK', '574', '672');
INSERT INTO `country` VALUES ('159', 'MP', 'NORTHERN MARIANA ISLANDS', 'Northern Mariana Islands', 'MNP', '580', '1670');
INSERT INTO `country` VALUES ('160', 'NO', 'NORWAY', 'Norway', 'NOR', '578', '47');
INSERT INTO `country` VALUES ('161', 'OM', 'OMAN', 'Oman', 'OMN', '512', '968');
INSERT INTO `country` VALUES ('162', 'PK', 'PAKISTAN', 'Pakistan', 'PAK', '586', '92');
INSERT INTO `country` VALUES ('163', 'PW', 'PALAU', 'Palau', 'PLW', '585', '680');
INSERT INTO `country` VALUES ('164', 'PS', 'PALESTINIAN TERRITORY, OCCUPIED', 'Palestinian Territory, Occupied', null, null, '970');
INSERT INTO `country` VALUES ('165', 'PA', 'PANAMA', 'Panama', 'PAN', '591', '507');
INSERT INTO `country` VALUES ('166', 'PG', 'PAPUA NEW GUINEA', 'Papua New Guinea', 'PNG', '598', '675');
INSERT INTO `country` VALUES ('167', 'PY', 'PARAGUAY', 'Paraguay', 'PRY', '600', '595');
INSERT INTO `country` VALUES ('168', 'PE', 'PERU', 'Peru', 'PER', '604', '51');
INSERT INTO `country` VALUES ('169', 'PH', 'PHILIPPINES', 'Philippines', 'PHL', '608', '63');
INSERT INTO `country` VALUES ('170', 'PN', 'PITCAIRN', 'Pitcairn', 'PCN', '612', '0');
INSERT INTO `country` VALUES ('171', 'PL', 'POLAND', 'Poland', 'POL', '616', '48');
INSERT INTO `country` VALUES ('172', 'PT', 'PORTUGAL', 'Portugal', 'PRT', '620', '351');
INSERT INTO `country` VALUES ('173', 'PR', 'PUERTO RICO', 'Puerto Rico', 'PRI', '630', '1787');
INSERT INTO `country` VALUES ('174', 'QA', 'QATAR', 'Qatar', 'QAT', '634', '974');
INSERT INTO `country` VALUES ('175', 'RE', 'REUNION', 'Reunion', 'REU', '638', '262');
INSERT INTO `country` VALUES ('176', 'RO', 'ROMANIA', 'Romania', 'ROM', '642', '40');
INSERT INTO `country` VALUES ('177', 'RU', 'RUSSIAN FEDERATION', 'Russian Federation', 'RUS', '643', '70');
INSERT INTO `country` VALUES ('178', 'RW', 'RWANDA', 'Rwanda', 'RWA', '646', '250');
INSERT INTO `country` VALUES ('179', 'SH', 'SAINT HELENA', 'Saint Helena', 'SHN', '654', '290');
INSERT INTO `country` VALUES ('180', 'KN', 'SAINT KITTS AND NEVIS', 'Saint Kitts and Nevis', 'KNA', '659', '1869');
INSERT INTO `country` VALUES ('181', 'LC', 'SAINT LUCIA', 'Saint Lucia', 'LCA', '662', '1758');
INSERT INTO `country` VALUES ('182', 'PM', 'SAINT PIERRE AND MIQUELON', 'Saint Pierre and Miquelon', 'SPM', '666', '508');
INSERT INTO `country` VALUES ('183', 'VC', 'SAINT VINCENT AND THE GRENADINES', 'Saint Vincent and the Grenadines', 'VCT', '670', '1784');
INSERT INTO `country` VALUES ('184', 'WS', 'SAMOA', 'Samoa', 'WSM', '882', '684');
INSERT INTO `country` VALUES ('185', 'SM', 'SAN MARINO', 'San Marino', 'SMR', '674', '378');
INSERT INTO `country` VALUES ('186', 'ST', 'SAO TOME AND PRINCIPE', 'Sao Tome and Principe', 'STP', '678', '239');
INSERT INTO `country` VALUES ('187', 'SA', 'SAUDI ARABIA', 'Saudi Arabia', 'SAU', '682', '966');
INSERT INTO `country` VALUES ('188', 'SN', 'SENEGAL', 'Senegal', 'SEN', '686', '221');
INSERT INTO `country` VALUES ('189', 'CS', 'SERBIA AND MONTENEGRO', 'Serbia and Montenegro', null, null, '381');
INSERT INTO `country` VALUES ('190', 'SC', 'SEYCHELLES', 'Seychelles', 'SYC', '690', '248');
INSERT INTO `country` VALUES ('191', 'SL', 'SIERRA LEONE', 'Sierra Leone', 'SLE', '694', '232');
INSERT INTO `country` VALUES ('192', 'SG', 'SINGAPORE', 'Singapore', 'SGP', '702', '65');
INSERT INTO `country` VALUES ('193', 'SK', 'SLOVAKIA', 'Slovakia', 'SVK', '703', '421');
INSERT INTO `country` VALUES ('194', 'SI', 'SLOVENIA', 'Slovenia', 'SVN', '705', '386');
INSERT INTO `country` VALUES ('195', 'SB', 'SOLOMON ISLANDS', 'Solomon Islands', 'SLB', '90', '677');
INSERT INTO `country` VALUES ('196', 'SO', 'SOMALIA', 'Somalia', 'SOM', '706', '252');
INSERT INTO `country` VALUES ('197', 'ZA', 'SOUTH AFRICA', 'South Africa', 'ZAF', '710', '27');
INSERT INTO `country` VALUES ('198', 'GS', 'SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS', 'South Georgia and the South Sandwich Islands', null, null, '0');
INSERT INTO `country` VALUES ('199', 'ES', 'SPAIN', 'Spain', 'ESP', '724', '34');
INSERT INTO `country` VALUES ('200', 'LK', 'SRI LANKA', 'Sri Lanka', 'LKA', '144', '94');
INSERT INTO `country` VALUES ('201', 'SD', 'SUDAN', 'Sudan', 'SDN', '736', '249');
INSERT INTO `country` VALUES ('202', 'SR', 'SURINAME', 'Suriname', 'SUR', '740', '597');
INSERT INTO `country` VALUES ('203', 'SJ', 'SVALBARD AND JAN MAYEN', 'Svalbard and Jan Mayen', 'SJM', '744', '47');
INSERT INTO `country` VALUES ('204', 'SZ', 'SWAZILAND', 'Swaziland', 'SWZ', '748', '268');
INSERT INTO `country` VALUES ('205', 'SE', 'SWEDEN', 'Sweden', 'SWE', '752', '46');
INSERT INTO `country` VALUES ('206', 'CH', 'SWITZERLAND', 'Switzerland', 'CHE', '756', '41');
INSERT INTO `country` VALUES ('207', 'SY', 'SYRIAN ARAB REPUBLIC', 'Syrian Arab Republic', 'SYR', '760', '963');
INSERT INTO `country` VALUES ('208', 'TW', 'TAIWAN, PROVINCE OF CHINA', 'Taiwan, Province of China', 'TWN', '158', '886');
INSERT INTO `country` VALUES ('209', 'TJ', 'TAJIKISTAN', 'Tajikistan', 'TJK', '762', '992');
INSERT INTO `country` VALUES ('210', 'TZ', 'TANZANIA, UNITED REPUBLIC OF', 'Tanzania, United Republic of', 'TZA', '834', '255');
INSERT INTO `country` VALUES ('211', 'TH', 'THAILAND', 'Thailand', 'THA', '764', '66');
INSERT INTO `country` VALUES ('212', 'TL', 'TIMOR-LESTE', 'Timor-Leste', null, null, '670');
INSERT INTO `country` VALUES ('213', 'TG', 'TOGO', 'Togo', 'TGO', '768', '228');
INSERT INTO `country` VALUES ('214', 'TK', 'TOKELAU', 'Tokelau', 'TKL', '772', '690');
INSERT INTO `country` VALUES ('215', 'TO', 'TONGA', 'Tonga', 'TON', '776', '676');
INSERT INTO `country` VALUES ('216', 'TT', 'TRINIDAD AND TOBAGO', 'Trinidad and Tobago', 'TTO', '780', '1868');
INSERT INTO `country` VALUES ('217', 'TN', 'TUNISIA', 'Tunisia', 'TUN', '788', '216');
INSERT INTO `country` VALUES ('218', 'TR', 'TURKEY', 'Turkey', 'TUR', '792', '90');
INSERT INTO `country` VALUES ('219', 'TM', 'TURKMENISTAN', 'Turkmenistan', 'TKM', '795', '7370');
INSERT INTO `country` VALUES ('220', 'TC', 'TURKS AND CAICOS ISLANDS', 'Turks and Caicos Islands', 'TCA', '796', '1649');
INSERT INTO `country` VALUES ('221', 'TV', 'TUVALU', 'Tuvalu', 'TUV', '798', '688');
INSERT INTO `country` VALUES ('222', 'UG', 'UGANDA', 'Uganda', 'UGA', '800', '256');
INSERT INTO `country` VALUES ('223', 'UA', 'UKRAINE', 'Ukraine', 'UKR', '804', '380');
INSERT INTO `country` VALUES ('224', 'AE', 'UNITED ARAB EMIRATES', 'United Arab Emirates', 'ARE', '784', '971');
INSERT INTO `country` VALUES ('225', 'GB', 'UNITED KINGDOM', 'United Kingdom', 'GBR', '826', '44');
INSERT INTO `country` VALUES ('226', 'US', 'UNITED STATES', 'United States', 'USA', '840', '1');
INSERT INTO `country` VALUES ('227', 'UM', 'UNITED STATES MINOR OUTLYING ISLANDS', 'United States Minor Outlying Islands', null, null, '1');
INSERT INTO `country` VALUES ('228', 'UY', 'URUGUAY', 'Uruguay', 'URY', '858', '598');
INSERT INTO `country` VALUES ('229', 'UZ', 'UZBEKISTAN', 'Uzbekistan', 'UZB', '860', '998');
INSERT INTO `country` VALUES ('230', 'VU', 'VANUATU', 'Vanuatu', 'VUT', '548', '678');
INSERT INTO `country` VALUES ('231', 'VE', 'VENEZUELA', 'Venezuela', 'VEN', '862', '58');
INSERT INTO `country` VALUES ('232', 'VN', 'VIET NAM', 'Viet Nam', 'VNM', '704', '84');
INSERT INTO `country` VALUES ('233', 'VG', 'VIRGIN ISLANDS, BRITISH', 'Virgin Islands, British', 'VGB', '92', '1284');
INSERT INTO `country` VALUES ('234', 'VI', 'VIRGIN ISLANDS, U.S.', 'Virgin Islands, U.s.', 'VIR', '850', '1340');
INSERT INTO `country` VALUES ('235', 'WF', 'WALLIS AND FUTUNA', 'Wallis and Futuna', 'WLF', '876', '681');
INSERT INTO `country` VALUES ('236', 'EH', 'WESTERN SAHARA', 'Western Sahara', 'ESH', '732', '212');
INSERT INTO `country` VALUES ('237', 'YE', 'YEMEN', 'Yemen', 'YEM', '887', '967');
INSERT INTO `country` VALUES ('238', 'ZM', 'ZAMBIA', 'Zambia', 'ZMB', '894', '260');
INSERT INTO `country` VALUES ('239', 'ZW', 'ZIMBABWE', 'Zimbabwe', 'ZWE', '716', '263');

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
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of discussion_comments
-- ----------------------------
INSERT INTO `discussion_comments` VALUES ('91', '1', '2', 'Admin', '22', 'update.', '1', null, 'Notification', '2014-11-09', '2014-11-09');
INSERT INTO `discussion_comments` VALUES ('92', '1', '22', 'Freelancer', '2', 'Hello', '1', '', 'Comment', '2014-11-09', '2014-11-09');
INSERT INTO `discussion_comments` VALUES ('93', '1', '22', 'Freelancer', '2', 'M Himel commented on update.', '0', null, 'Notification', '2014-11-09', '2014-11-09');
INSERT INTO `discussion_comments` VALUES ('94', '2', '11', 'Client', '2', 'having problem with developer.', '1', null, 'Notification', '2014-11-09', '2014-11-09');
INSERT INTO `discussion_comments` VALUES ('95', '2', '2', 'Admin', '11', 'ok we will see. ', '1', '', 'Comment', '2014-11-09', '2014-11-09');
INSERT INTO `discussion_comments` VALUES ('96', '2', '2', 'Admin', '11', 'a Admin commented on having problem with developer.', '1', null, 'Notification', '2014-11-09', '2014-11-09');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of discussions
-- ----------------------------
INSERT INTO `discussions` VALUES ('1', 'update.', 'hi.', '2', 'Admin', '22', '1', '', '2014-11-09', '2014-11-09');
INSERT INTO `discussions` VALUES ('2', 'having problem with developer.', 'Himel is taking more time than expected.', '11', 'Client', '2', '1', '', '2014-11-09', '2014-11-09');

-- ----------------------------
-- Table structure for educations
-- ----------------------------
DROP TABLE IF EXISTS `educations`;
CREATE TABLE `educations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `freelancer_id` int(11) DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `institute_name` varchar(200) DEFAULT NULL,
  `start_year` int(4) DEFAULT NULL,
  `end_year` int(4) DEFAULT NULL,
  `degree` varchar(100) DEFAULT NULL,
  `area_of_study` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_freelancer_edu_id` (`freelancer_id`) USING BTREE,
  CONSTRAINT `educations_ibfk_1` FOREIGN KEY (`freelancer_id`) REFERENCES `freelancers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of educations
-- ----------------------------
INSERT INTO `educations` VALUES ('1', '5', '2014-10-27', '2014-10-22', 'DIU', '2008', '2011', '3.7', 'CSE', 'Puts Some Educational Description here', null);

-- ----------------------------
-- Table structure for feedbacks
-- ----------------------------
DROP TABLE IF EXISTS `feedbacks`;
CREATE TABLE `feedbacks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `feedbacks_id` int(11) DEFAULT NULL,
  `feedbacks_type` enum('Client','Freelancer') DEFAULT NULL,
  `job_offer_id` int(11) DEFAULT NULL,
  `feedback_status` enum('Locked','Open') DEFAULT NULL,
  `feedback_score` varchar(255) DEFAULT NULL,
  `comment` text,
  `feedback_visibility` tinyint(1) DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_freelancer_feedback_id` (`feedbacks_id`) USING BTREE,
  KEY `fk_joboffer_feedback_id` (`job_offer_id`) USING BTREE,
  CONSTRAINT `feedbacks_ibfk_1` FOREIGN KEY (`feedbacks_id`) REFERENCES `job_offers` (`freelancer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `feedbacks_ibfk_2` FOREIGN KEY (`job_offer_id`) REFERENCES `job_offers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of feedbacks
-- ----------------------------

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
  KEY `fk_freelancer_agency_member_id` (`freelancer_id`) USING BTREE,
  KEY `fk_freelancer_agency_owner_id` (`agency_id`) USING BTREE,
  CONSTRAINT `freelancer_agency_ibfk_1` FOREIGN KEY (`freelancer_id`) REFERENCES `freelancers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `freelancer_agency_ibfk_2` FOREIGN KEY (`agency_id`) REFERENCES `freelancers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of freelancer_agency
-- ----------------------------
INSERT INTO `freelancer_agency` VALUES ('2', '5', '9', null, null, 'Requested', '2014-10-13', '2014-10-13');

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
  `mobile` varchar(45) DEFAULT NULL,
  `contact_widget` tinyint(1) DEFAULT '1',
  `exam_widget` tinyint(1) DEFAULT '1',
  `overview` text,
  `my_video` varchar(45) DEFAULT NULL,
  `contact_number` varchar(45) DEFAULT NULL,
  `photos` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `division` varchar(20) DEFAULT NULL,
  `address_area` varchar(20) DEFAULT NULL,
  `address_city` varchar(20) DEFAULT NULL,
  `address_zip` int(5) DEFAULT NULL,
  `address_country` varchar(20) DEFAULT NULL,
  `available` tinyint(4) DEFAULT NULL,
  `pbs_widget` tinyint(1) NOT NULL DEFAULT '1',
  `certificate_widget` tinyint(1) NOT NULL DEFAULT '1',
  `earning_widget` tinyint(1) NOT NULL DEFAULT '1',
  `review_widget` tinyint(1) NOT NULL DEFAULT '1',
  `edu_widget` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of freelancers
-- ----------------------------
INSERT INTO `freelancers` VALUES ('12', 'TAHMINA', 'AKTER', '', 'aa', 'Individual', '5', '1', '2014-10-27', '2014-10-23', 'tahminaaiub@gmail.com', '1', '01680110144', '1', '1', 'OLL', null, '+88019091065', '1414056256_4248-woman-sitting-by-a-pond-facebook-cover.jpg', null, 'gp ja167,wireless gate,Mohakhali,Dhaka 1212', 'Dhaka', null, 'Dhaka', '1212', 'BANGLADESH', '1', '1', '1', '1', '1', '1');
INSERT INTO `freelancers` VALUES ('13', 'Md. Johir', ' Uddin', 'Carbon51 ltd', null, 'Agency', '25', '1', '2014-10-23', '2014-10-23', 'johir@carbon51.com', null, null, '1', '1', null, null, null, null, null, null, null, null, null, null, null, null, '1', '1', '1', '1', '1');
INSERT INTO `freelancers` VALUES ('15', 'Carbon', 'carbon', '', null, 'Individual', '0', '1', '2014-10-27', '2014-10-27', 'carbon51user1@gmail.com', null, '9899898', '1', '1', null, null, '0908', null, null, 'aa', 'Dhaka', null, 'dhaka', '9909', 'BANGLADESH', null, '1', '1', '1', '1', '1');
INSERT INTO `freelancers` VALUES ('16', 'Carbon', 'carbon', '', null, 'Individual', '0', '1', '2014-10-27', '2014-10-27', 'carbon51user2@gmail.com', null, null, '1', '1', null, null, null, null, null, null, null, null, null, null, null, null, '1', '1', '1', '1', '1');
INSERT INTO `freelancers` VALUES ('17', 'Carbon', 'carbon', '', null, 'Individual', '0', '1', '2014-10-27', '2014-10-27', 'carbon51user33@gmail.com', null, null, '1', '1', null, null, null, null, null, null, null, null, null, null, null, null, '1', '1', '1', '1', '1');
INSERT INTO `freelancers` VALUES ('18', 'Carbon', 'carbon', 'abc', null, 'Agency', '0', '1', '2014-10-27', '2014-10-27', 'carbon51user4@gmail.com', null, null, '1', '1', null, null, null, null, null, null, null, null, null, null, null, null, '1', '1', '1', '1', '1');
INSERT INTO `freelancers` VALUES ('19', 'Carbon', 'carbon', '', null, 'Individual', '0', '1', '2014-10-27', '2014-10-27', 'carbon51user5@gmail.com', null, null, '1', '1', null, null, null, null, null, null, null, null, null, null, null, null, '1', '1', '1', '1', '1');
INSERT INTO `freelancers` VALUES ('20', 'Tanvir ', 'Freelancer', '', 'ASP.NET and PHP developer', 'Individual', '20', '1', '2014-11-03', '2014-11-03', 'tanvir.net@gmail.com', '6', '018465489779', '1', '1', 'Working on architecture development from last 4 years.', null, '028854687', '1415004765_2inc.jpg', null, 'Niketan Gulshan.', 'Dhaka', null, 'Dhaka', '1212', 'BANGLADESH', '1', '1', '1', '1', '1', '1');
INSERT INTO `freelancers` VALUES ('22', 'Ms', 'Himels', '', 'PHP Developer', 'Individual', '10', '1', '2014-11-09', '2014-11-09', 'himel@carbon51.com', '4', '01714112912', '1', '1', 'Here my profile overview', null, '01714112912', '1415530569_Himel_pp.jpg', null, 'Dhaka', 'Dhaka', null, 'Dhaka', '1000', 'BANGLADESH', '1', '1', '1', '1', '1', '1');

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
  UNIQUE KEY `groups_name_unique` (`name`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of groups
-- ----------------------------
INSERT INTO `groups` VALUES ('2', 'Admin', '{\"Admin\":1}', '2014-08-25 08:38:10', '2014-08-25 08:38:10');
INSERT INTO `groups` VALUES ('3', 'Individual', '{\"Individual\":1}', '2014-08-25 08:38:23', '2014-08-25 08:38:23');
INSERT INTO `groups` VALUES ('4', 'Client', '{\"Client\":1}', '2014-08-25 08:38:32', '2014-08-25 08:38:32');
INSERT INTO `groups` VALUES ('5', 'Agency', '{\"Agency\":1}', '2014-09-07 10:03:02', '2014-09-07 10:03:02');

-- ----------------------------
-- Table structure for job_categories
-- ----------------------------
DROP TABLE IF EXISTS `job_categories`;
CREATE TABLE `job_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) DEFAULT NULL,
  `description` varchar(300) DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `created_at` date NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `display` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of job_categories
-- ----------------------------
INSERT INTO `job_categories` VALUES ('1', 'Web Design', 'Lorem Ipsum is simply dummy text of the printingry.', '2014-09-18', '2014-09-09', null, '1');
INSERT INTO `job_categories` VALUES ('2', 'Web Programing', 'Lorem Ipsum is simply dummy text of the printingry.', '2014-09-09', '2014-09-09', null, '1');
INSERT INTO `job_categories` VALUES ('3', 'Graphics Design', 'Lorem Ipsum is simply dummy text of the printingry.', '2014-09-09', '2014-09-09', null, '1');
INSERT INTO `job_categories` VALUES ('4', 'Mobile Apps', 'Lorem Ipsum is simply dummy text of the printingry.', '2014-09-09', '2014-09-09', null, '1');
INSERT INTO `job_categories` VALUES ('5', 'Ecommerce', 'Lorem Ipsum is simply dummy text of the printingry.', '2014-09-09', '2014-09-09', null, '1');
INSERT INTO `job_categories` VALUES ('6', 'SEO-Search Engine Optimization', 'Lorem Ipsum is simply dummy text of the printingry.', '2014-09-18', '2014-09-18', null, '1');

-- ----------------------------
-- Table structure for job_offers
-- ----------------------------
DROP TABLE IF EXISTS `job_offers`;
CREATE TABLE `job_offers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `freelancer_id` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `job_post_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `job_offer_status` enum('Pending','Approved','Canceled','Accepted','Paused','Completed','Progress','Decline') DEFAULT NULL COMMENT 'Admin get Pending Job offer listAdmin can Approve or CancelFreelancer can Accept or Decline',
  `job_offer_status_reason` varchar(255) DEFAULT NULL COMMENT 'only use when Decline a job offer',
  `job_offer_price` varchar(45) DEFAULT NULL,
  `job_offer_hour` varchar(50) DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_freelancer_joboffer_id` (`freelancer_id`) USING BTREE,
  KEY `fk_joboffer_jobpost_id` (`job_post_id`) USING BTREE,
  KEY `fk_job_offer_client_id` (`client_id`) USING BTREE,
  CONSTRAINT `job_offers_ibfk_1` FOREIGN KEY (`freelancer_id`) REFERENCES `freelancers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `job_offers_ibfk_2` FOREIGN KEY (`job_post_id`) REFERENCES `job_posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `job_offers_ibfk_3` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of job_offers
-- ----------------------------
INSERT INTO `job_offers` VALUES ('16', '22', '10', '37', 'offer to himel.', 'done.', 'Progress', 'Job offer has been accepted by M Himel', '50', '5', '2014-11-09', '2014-11-09', null);
INSERT INTO `job_offers` VALUES ('17', '22', '11', '38', 'PHP laravel', 'Laravel job.', 'Progress', 'Job offer has been accepted by Ms Himels', '500', '50', '2014-11-09', '2014-11-09', null);

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
  `phase_payment_status` enum('Done','Hold','Waiting','Progress','Pending') DEFAULT NULL,
  `phase_start` date DEFAULT NULL,
  `phase_deadline` date DEFAULT NULL,
  `phase_details` text,
  `updated_at` date DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_joboffer_jobphase_id` (`job_offer_id`) USING BTREE,
  CONSTRAINT `job_phases_ibfk_1` FOREIGN KEY (`job_offer_id`) REFERENCES `job_offers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of job_phases
-- ----------------------------
INSERT INTO `job_phases` VALUES ('16', '16', '1', '10', '1', 'Done', '2014-11-09', '2014-11-10', 'lkj', '2014-11-09', '2014-11-09', null);
INSERT INTO `job_phases` VALUES ('17', '16', '2', '20', '2', 'Pending', '2014-11-09', '2014-11-11', 'ljlkj', '2014-11-09', '2014-11-09', null);
INSERT INTO `job_phases` VALUES ('18', '17', 'Phase 1', '500', '50', 'Done', '2014-11-10', '2014-11-15', 'design.', '2014-11-09', '2014-11-09', null);

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
  `description` mediumtext,
  `attach_file` text,
  `amount` float DEFAULT NULL,
  `job_status` enum('Pending','Approved','Canceled','Progress','Completed') NOT NULL DEFAULT 'Pending',
  `hour` varchar(20) DEFAULT NULL,
  `job_price_range` varchar(255) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_jobpost_client_id` (`client_id`) USING BTREE,
  KEY `fk_jobcategory_jobpost_id` (`job_category_id`) USING BTREE,
  CONSTRAINT `job_posts_ibfk_1` FOREIGN KEY (`job_category_id`) REFERENCES `job_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `job_posts_ibfk_2` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of job_posts
-- ----------------------------
INSERT INTO `job_posts` VALUES ('36', '10', '2', '2014-11-09', '2014-11-09', 'new xxx', 'new post.', '{}', null, 'Canceled', '55', '10', null);
INSERT INTO `job_posts` VALUES ('37', '10', '2', '2014-11-09', '2014-11-09', 'wwwwwwwwww', 'wwwwwwwww', '{}', null, 'Progress', '10', '10', null);
INSERT INTO `job_posts` VALUES ('38', '11', '2', '2014-11-09', '2014-11-09', 'PHP laravel', 'Laravel job.', '{}', '500', 'Progress', '50', '10', null);

-- ----------------------------
-- Table structure for job_prices
-- ----------------------------
DROP TABLE IF EXISTS `job_prices`;
CREATE TABLE `job_prices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `created_at` date NOT NULL,
  `display` tinyint(1) NOT NULL DEFAULT '1',
  `deleted_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of job_prices
-- ----------------------------
INSERT INTO `job_prices` VALUES ('9', '30', '2014-09-14', '2014-09-14', '1', null);
INSERT INTO `job_prices` VALUES ('10', '25', '2014-09-14', '2014-09-14', '1', null);
INSERT INTO `job_prices` VALUES ('11', '20', '2014-09-14', '2014-09-14', '1', null);
INSERT INTO `job_prices` VALUES ('12', '15', '2014-09-14', '2014-09-14', '1', null);
INSERT INTO `job_prices` VALUES ('13', '10', '2014-09-14', '2014-09-14', '1', null);
INSERT INTO `job_prices` VALUES ('14', '5', '2014-09-14', '2014-09-14', '1', null);

-- ----------------------------
-- Table structure for job_requests
-- ----------------------------
DROP TABLE IF EXISTS `job_requests`;
CREATE TABLE `job_requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `job_id` int(11) DEFAULT NULL,
  `freelancer_id` int(11) DEFAULT NULL,
  `request_status` enum('Approved','Accepted','Requested','Canceled','Declined') DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_jobrequested_jobpost_id` (`job_id`) USING BTREE,
  KEY `fk_jobrequested_freelancer_id` (`freelancer_id`) USING BTREE,
  CONSTRAINT `job_requests_ibfk_1` FOREIGN KEY (`job_id`) REFERENCES `job_posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `job_requests_ibfk_2` FOREIGN KEY (`freelancer_id`) REFERENCES `freelancers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of job_requests
-- ----------------------------

-- ----------------------------
-- Table structure for job_statuses
-- ----------------------------
DROP TABLE IF EXISTS `job_statuses`;
CREATE TABLE `job_statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `job_offer_id` int(11) NOT NULL,
  `status_changer_id` int(11) NOT NULL,
  `status_changer_type` enum('Client','Freelancer','Admin') COLLATE latin1_general_ci NOT NULL,
  `status_name` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `status_reason` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  `deleted_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_jobstatus_job_offer_id` (`job_offer_id`) USING BTREE,
  CONSTRAINT `job_statuses_ibfk_1` FOREIGN KEY (`job_offer_id`) REFERENCES `job_offers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- ----------------------------
-- Records of job_statuses
-- ----------------------------
INSERT INTO `job_statuses` VALUES ('9', '16', '10', 'Client', 'Pending', 'Client request you to accept his/her job offer', '2014-11-09', '2014-11-09', '2014-11-09 01:08:31');
INSERT INTO `job_statuses` VALUES ('10', '16', '2', 'Admin', 'Approved', 'Job offer has been approved by admin', '2014-11-09', '2014-11-09', '2014-11-09 01:09:21');
INSERT INTO `job_statuses` VALUES ('11', '16', '22', 'Freelancer', 'Accepted', 'Job offer has been accepted by M Himel', '2014-11-09', '2014-11-09', '2014-11-09 01:10:51');
INSERT INTO `job_statuses` VALUES ('12', '16', '22', 'Freelancer', 'Progress', 'Job offer has been accepted by M Himel', '2014-11-09', '2014-11-09', '2014-11-09 01:30:43');
INSERT INTO `job_statuses` VALUES ('13', '17', '11', 'Client', 'Pending', 'New job has been created', '2014-11-09', '2014-11-09', '2014-11-09 05:05:48');
INSERT INTO `job_statuses` VALUES ('14', '17', '2', 'Admin', 'Approved', 'Job offer has been approved by admin', '2014-11-09', '2014-11-09', '2014-11-09 05:06:34');
INSERT INTO `job_statuses` VALUES ('15', '17', '22', 'Freelancer', 'Accepted', 'Job offer has been accepted by Ms Himels', '2014-11-09', '2014-11-09', '2014-11-09 05:07:21');
INSERT INTO `job_statuses` VALUES ('16', '17', '22', 'Freelancer', 'Progress', 'Job offer has been accepted by Ms Himels', '2014-11-09', '2014-11-09', '2014-11-09 05:18:10');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------

-- ----------------------------
-- Table structure for notifications
-- ----------------------------
DROP TABLE IF EXISTS `notifications`;
CREATE TABLE `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_id` int(11) DEFAULT NULL,
  `sender_type` enum('Admin','Client','Freelancer') DEFAULT NULL,
  `receiver_id` int(11) DEFAULT NULL,
  `subject` varchar(45) DEFAULT NULL,
  `message` text,
  `read_status` tinyint(1) DEFAULT NULL,
  `receiver_type` enum('Admin','Freelancer','Client') DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `url` varchar(255) NOT NULL,
  `notification_type` enum('Job Invitation','Job Request','Feedback','Payment','New Job Offer','Job Post','New Job','Comment','JobOffer','Phase','Team Invitation') NOT NULL,
  `object_id` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notification_receiver_id` (`receiver_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of notifications
-- ----------------------------
INSERT INTO `notifications` VALUES ('5', '10', 'Client', '1', 'New Job', '<strong><a target=\"_blank\" href=\"http://gameshader.net/view/client/QTUFUP\">Tanvir Anowar</a> has been created a new job.\r\n                            </strong><br/>Please click following link to read job details and approve job:<br/>\r\n                        <a target=\"_blank\" href=\"http://gameshader.net/view/job/QTn1TP/QT6lVP\">xxxxxxxxxxxxxxxxxxxxxx</a>', '0', 'Admin', '2014-11-09', '2014-11-09', 'admin/new-job', 'Job Post', 'QT6lVP');
INSERT INTO `notifications` VALUES ('6', '10', 'Client', '2', 'New Job', '<strong><a target=\"_blank\" href=\"http://gameshader.net/view/client/QTUFUP\">Tanvir Anowar</a> has been created a new job.\r\n                            </strong><br/>Please click following link to read job details and approve job:<br/>\r\n                        <a target=\"_blank\" href=\"http://gameshader.net/view/job/QTn1TP/QT6lVP\">xxxxxxxxxxxxxxxxxxxxxx</a>', '1', 'Admin', '2014-11-09', '2014-11-09', 'admin/new-job', 'Job Post', 'QT6lVP');
INSERT INTO `notifications` VALUES ('7', '2', 'Admin', '10', 'Job Canceled', '<strong>Your job has been canceled.</strong><br/>Please click following link to see job details:<br/>\r\n                <a target=\"_blank\" href=\"http://gameshader.net/jobPost/view/QT6lVP\">xxxxxxxxxxxxxxxxxxxxxx</a><br/><br/>\r\n                If you need any query then please contact with support team.', '1', 'Client', '2014-11-09', '2014-11-09', 'notification/view', 'Job Post', 'QT6lVP');
INSERT INTO `notifications` VALUES ('8', '10', 'Client', '1', 'New Job', '<strong><a target=\"_blank\" href=\"http://gameshader.net/view/client/QTUFUP\">Tanvir Anowar</a> has been created a new job.\r\n                            </strong><br/>Please click following link to read job details and approve job:<br/>\r\n                        <a target=\"_blank\" href=\"http://gameshader.net/view/job/QTn1TP/QT6NWP\">wwwwwwwwww</a>', '0', 'Admin', '2014-11-09', '2014-11-09', 'admin/new-job', 'Job Post', 'QT6NWP');
INSERT INTO `notifications` VALUES ('9', '10', 'Client', '2', 'New Job', '<strong><a target=\"_blank\" href=\"http://gameshader.net/view/client/QTUFUP\">Tanvir Anowar</a> has been created a new job.\r\n                            </strong><br/>Please click following link to read job details and approve job:<br/>\r\n                        <a target=\"_blank\" href=\"http://gameshader.net/view/job/QTn1TP/QT6NWP\">wwwwwwwwww</a>', '0', 'Admin', '2014-11-09', '2014-11-09', 'admin/new-job', 'Job Post', 'QT6NWP');
INSERT INTO `notifications` VALUES ('10', '10', 'Client', '1', 'New Job Offer', '<strong><a target=\"_blank\" href=\"http://gameshader.net/view/client/QTUFUP\">Tanvir Anowar</a> has been invited to\r\n                            <a target=\"_blank\" href=\"http://gameshader.net/view/freelancer/QTqlUP\">M Himel</a>.\r\n                            </strong><br/>Please click following link to read job details and approve job invitation:<br/>\r\n                        <a target=\"_blank\" href=\"http://gameshader.net/view/job/QTn1TP/QT6NWP\">offer to himel.</a>', '0', 'Admin', '2014-11-09', '2014-11-09', 'admin/job-invitation', 'New Job Offer', 'QTUlVP');
INSERT INTO `notifications` VALUES ('11', '10', 'Client', '2', 'New Job Offer', '<strong><a target=\"_blank\" href=\"http://gameshader.net/view/client/QTUFUP\">Tanvir Anowar</a> has been invited to\r\n                            <a target=\"_blank\" href=\"http://gameshader.net/view/freelancer/QTqlUP\">M Himel</a>.\r\n                            </strong><br/>Please click following link to read job details and approve job invitation:<br/>\r\n                        <a target=\"_blank\" href=\"http://gameshader.net/view/job/QTn1TP/QT6NWP\">offer to himel.</a>', '1', 'Admin', '2014-11-09', '2014-11-09', 'admin/job-invitation', 'New Job Offer', 'QTUlVP');
INSERT INTO `notifications` VALUES ('12', '2', 'Admin', '22', 'Job Invitation', '<strong><a target=\"_blank\" href=\"http://ctgbetterhome.com/view/client/QTUFUP\">Tanvir Anowar</a>\r\n                has been invited to you.</strong><br/>Please click following link to read job details and accept job invitation:<br/>\r\n                <a target=\"_blank\" href=\"http://ctgbetterhome.com/view/job/QTn1TP/QT6NWP\">offer to himel.</a>', '1', 'Freelancer', '2014-11-09', '2014-11-09', 'job-invitation', 'Job Invitation', 'QTUlVP');
INSERT INTO `notifications` VALUES ('13', '2', 'Admin', '10', 'Job Approved', '<strong>Your job offer has been approved.</strong><br/>Please click following link to see job details:<br/>\r\n                <a target=\"_blank\" href=\"http://gameshader.net/jobPost/view/QT6NWP\">offer to himel.</a>', '0', 'Client', '2014-11-09', '2014-11-09', 'notification/view', 'JobOffer', 'QTUlVP');
INSERT INTO `notifications` VALUES ('14', '2', 'Admin', '10', 'Job Approved', '<strong><a href=\"#\">a</a> has been assigned a job on you.</strong><br/>Please click following link to see job details:<br/>\r\n                    <a target=\"_blank\" href=\"http://gameshader.net/jobPost/view/QT6NWP\">wwwwwwwwww</a>', '0', 'Client', '2014-11-09', '2014-11-09', 'notification/view', 'Job Post', 'QT6NWP');
INSERT INTO `notifications` VALUES ('15', '22', 'Freelancer', '10', 'Job Accepted', '<strong>Your job offer has been accepted by <a target=\"_blank\" href=\"http://gameshader.net/view/freelancer/QTqlUP\">M Himel</a>\r\n                    .</strong><br/>Please click following link to see job details:<br/>\r\n                <a target=\"_blank\" href=\"http://gameshader.net/jobPost/view/QT6NWP\">offer to himel.</a><br/><br/>\r\n                ', '1', 'Client', '2014-11-09', '2014-11-09', 'notification/view', 'JobOffer', 'QTUlVP');
INSERT INTO `notifications` VALUES ('16', '10', 'Client', '22', 'New Phase', '<strong><a target=\"_blank\" href=\"http://ctgbetterhome.com/view/client/QTUFUP\">Tanvir Anowar</a>\r\n                has been created phase.</strong><br/>Please click following link to read job details:<br/>\r\n                <a target=\"_blank\" href=\"http://ctgbetterhome.com/view/job/QTn1TP/QT6NWP\">offer to himel.</a>', '1', 'Freelancer', '2014-11-09', '2014-11-09', 'notification', 'Phase', 'QTUlVP');
INSERT INTO `notifications` VALUES ('17', '10', 'Client', '22', 'New Comment', '<p>\"himel what is the progress of the project ?\"</p><strong>Tanvir Anowar</strong> has been created above comment on following job:<br/>\r\n                <a target=\"_blank\" href=\"http://ctgbetterhome.com/view/job/QTn1TP/QT6NWP\">wwwwwwwwww</a><br/><br/>', '1', 'Freelancer', '2014-11-09', '2014-11-09', 'notification', 'Comment', 'QTn1TP');
INSERT INTO `notifications` VALUES ('18', '22', 'Freelancer', '10', 'New Comment', '<p>\"Hello\"</p><strong>M Himel</strong> has been created above comment on following job:<br/>\r\n                <a target=\"_blank\" href=\"http://gameshader.net/jobPost/view/QT6NWP\">wwwwwwwwww</a><br/><br/>', '1', 'Client', '2014-11-09', '2014-11-09', 'client/notification', 'Comment', 'QT31TP');
INSERT INTO `notifications` VALUES ('19', '22', 'Freelancer', '10', 'Phase Progress', '<strong><a target=\"_blank\" href=\"http://gameshader.net/view/freelancer/QTqlUP\">M Himel</a>\r\n                has been started your phase.</strong>Please click following link to read job details:<br/>\r\n                <a target=\"_blank\" href=\"http://gameshader.net/view/job/QTn1TP/QT6NWP\">offer to himel.</a>', '0', 'Client', '2014-11-09', '2014-11-09', 'client/phase-progress', 'Phase', 'QTUlVP');
INSERT INTO `notifications` VALUES ('20', '10', 'Client', '10', 'Phase Progress', '<strong><a target=\"_blank\" href=\"http://gameshader.net/view/freelancer/QTqlUP\">M Himel</a>\r\n                has been started your phase.</strong>Please click following link to read job details:<br/>\r\n                <a target=\"_blank\" href=\"http://gameshader.net/view/job/QTn1TP/QT6NWP\">offer to himel.</a>', '0', 'Client', '2014-11-09', '2014-11-09', 'client/phase-progress', 'Phase', 'QTUlVP');
INSERT INTO `notifications` VALUES ('21', '22', 'Freelancer', '10', 'Payment Process', '', '1', 'Client', '2014-11-09', '2014-11-09', 'client/payment-process', 'Payment', 'QTUlVP');
INSERT INTO `notifications` VALUES ('22', '10', 'Client', '22', 'Payment Process Hold', 'Your payment process hold by <a target=\"_blank\" href=\"http://ctgbetterhome.com/view/client/QTUFUP\">Tanvir Anowar</a>', '1', 'Freelancer', '2014-11-09', '2014-11-09', 'notification', 'Payment', 'QTUlVP');
INSERT INTO `notifications` VALUES ('23', '10', 'Client', '22', 'New Phase', '<strong><a target=\"_blank\" href=\"http://ctgbetterhome.com/view/client/QTUFUP\">Tanvir Anowar</a>\r\n                has been created phase.</strong><br/>Please click following link to read job details:<br/>\r\n                <a target=\"_blank\" href=\"http://ctgbetterhome.com/view/job/QTn1TP/QT6NWP\">offer to himel.</a>', '1', 'Freelancer', '2014-11-09', '2014-11-09', 'notification', 'Phase', 'QTUNWP');
INSERT INTO `notifications` VALUES ('24', '22', 'Freelancer', '10', 'Payment Process', '', '1', 'Client', '2014-11-09', '2014-11-09', 'client/payment-process', 'Payment', 'QTUlVP');
INSERT INTO `notifications` VALUES ('25', '10', 'Client', '1', 'Payment made by client', 'A Payment made by Client <b>Tanvir Anowar</b>', '0', 'Admin', '2014-11-09', '2014-11-09', 'admin/payment', 'Payment', 'wTB1TP');
INSERT INTO `notifications` VALUES ('26', '10', 'Client', '2', 'Payment made by client', 'A Payment made by Client <b>Tanvir Anowar</b>', '1', 'Admin', '2014-11-09', '2014-11-09', 'admin/payment', 'Payment', 'wTB1TP');
INSERT INTO `notifications` VALUES ('27', '10', 'Client', '22', 'Payment made by client', 'A Payment made by Client <b>Tanvir Anowar</b>', '0', 'Freelancer', '2014-11-09', '2014-11-09', ' payment', 'Payment', 'wTB1TP');
INSERT INTO `notifications` VALUES ('28', '11', 'Client', '1', 'New Job', '<strong><a target=\"_blank\" href=\"http://gameshader.net/view/client/QTUVUP\">Tanvir Anowar</a> has been created a new job.\r\n                            </strong><br/>Please click following link to read job details and approve job:<br/>\r\n                        <a target=\"_blank\" href=\"http://gameshader.net/view/job/QTn1TP/QT6dWP\">PHP laravel</a>', '0', 'Admin', '2014-11-09', '2014-11-09', 'admin/new-job', 'Job Post', 'QT6dWP');
INSERT INTO `notifications` VALUES ('29', '11', 'Client', '2', 'New Job', '<strong><a target=\"_blank\" href=\"http://gameshader.net/view/client/QTUVUP\">Tanvir Anowar</a> has been created a new job.\r\n                            </strong><br/>Please click following link to read job details and approve job:<br/>\r\n                        <a target=\"_blank\" href=\"http://gameshader.net/view/job/QTn1TP/QT6dWP\">PHP laravel</a>', '0', 'Admin', '2014-11-09', '2014-11-09', 'admin/new-job', 'Job Post', 'QT6dWP');
INSERT INTO `notifications` VALUES ('30', '11', 'Client', '1', 'New Job Offer', '<strong><a target=\"_blank\" href=\"http://gameshader.net/view/client/QTUVUP\">Tanvir Anowar</a> has been invited to\r\n                            <a target=\"_blank\" href=\"http://gameshader.net/view/freelancer/QTqlUP\">Ms Himels</a>.\r\n                            </strong><br/>Please click following link to read job details and approve job invitation:<br/>\r\n                        <a target=\"_blank\" href=\"http://gameshader.net/view/job/QTn1TP/QT6dWP\">PHP laravel</a>', '0', 'Admin', '2014-11-09', '2014-11-09', 'admin/job-invitation', 'New Job Offer', 'QTUNWP');
INSERT INTO `notifications` VALUES ('31', '11', 'Client', '2', 'New Job Offer', '<strong><a target=\"_blank\" href=\"http://gameshader.net/view/client/QTUVUP\">Tanvir Anowar</a> has been invited to\r\n                            <a target=\"_blank\" href=\"http://gameshader.net/view/freelancer/QTqlUP\">Ms Himels</a>.\r\n                            </strong><br/>Please click following link to read job details and approve job invitation:<br/>\r\n                        <a target=\"_blank\" href=\"http://gameshader.net/view/job/QTn1TP/QT6dWP\">PHP laravel</a>', '1', 'Admin', '2014-11-09', '2014-11-09', 'admin/job-invitation', 'New Job Offer', 'QTUNWP');
INSERT INTO `notifications` VALUES ('32', '2', 'Admin', '22', 'Job Invitation', '<strong><a target=\"_blank\" href=\"http://ctgbetterhome.com/view/client/QTUVUP\">Tanvir Anowar</a>\r\n                has been invited to you.</strong><br/>Please click following link to read job details and accept job invitation:<br/>\r\n                <a target=\"_blank\" href=\"http://ctgbetterhome.com/view/job/QTn1TP/QT6dWP\">PHP laravel</a>', '1', 'Freelancer', '2014-11-09', '2014-11-09', 'job-invitation', 'Job Invitation', 'QTUNWP');
INSERT INTO `notifications` VALUES ('33', '2', 'Admin', '11', 'Job Approved', '<strong>Your job offer has been approved.</strong><br/>Please click following link to see job details:<br/>\r\n                <a target=\"_blank\" href=\"http://gameshader.net/jobPost/view/QT6dWP\">PHP laravel</a>', '0', 'Client', '2014-11-09', '2014-11-09', 'notification/view', 'JobOffer', 'QTUNWP');
INSERT INTO `notifications` VALUES ('34', '2', 'Admin', '11', 'Job Approved', '<strong><a href=\"#\">a</a> has been assigned a job on you.</strong><br/>Please click following link to see job details:<br/>\r\n                    <a target=\"_blank\" href=\"http://gameshader.net/jobPost/view/QT6dWP\">PHP laravel</a>', '0', 'Client', '2014-11-09', '2014-11-09', 'notification/view', 'Job Post', 'QT6dWP');
INSERT INTO `notifications` VALUES ('35', '22', 'Freelancer', '11', 'Job Accepted', '<strong>Your job offer has been accepted by <a target=\"_blank\" href=\"http://gameshader.net/view/freelancer/QTqlUP\">Ms Himels</a>\r\n                    .</strong><br/>Please click following link to see job details:<br/>\r\n                <a target=\"_blank\" href=\"http://gameshader.net/jobPost/view/QT6dWP\">PHP laravel</a><br/><br/>\r\n                ', '0', 'Client', '2014-11-09', '2014-11-09', 'notification/view', 'JobOffer', 'QTUNWP');
INSERT INTO `notifications` VALUES ('36', '11', 'Client', '22', 'New Comment', '<p>\"do you know angular js ?\"</p><strong>Tanvir Anowar</strong> has been created above comment on following job:<br/>\r\n                <a target=\"_blank\" href=\"http://ctgbetterhome.com/view/job/QTn1TP/QT6dWP\">PHP laravel</a><br/><br/>', '1', 'Freelancer', '2014-11-09', '2014-11-09', 'notification', 'Comment', 'gTB1TP');
INSERT INTO `notifications` VALUES ('37', '22', 'Freelancer', '11', 'New Comment', '<p>\"Yes I know how to work with angularJs\"</p><strong>Ms Himels</strong> has been created above comment on following job:<br/>\r\n                <a target=\"_blank\" href=\"http://gameshader.net/jobPost/view/QT6dWP\">PHP laravel</a><br/><br/>', '0', 'Client', '2014-11-09', '2014-11-09', 'client/notification', 'Comment', 'gTR1TP');
INSERT INTO `notifications` VALUES ('38', '11', 'Client', '22', 'New Phase', '<strong><a target=\"_blank\" href=\"http://ctgbetterhome.com/view/client/QTUVUP\">Tanvir Anowar</a>\r\n                has been created phase.</strong><br/>Please click following link to read job details:<br/>\r\n                <a target=\"_blank\" href=\"http://ctgbetterhome.com/view/job/QTn1TP/QT6dWP\">PHP laravel</a>', '1', 'Freelancer', '2014-11-09', '2014-11-09', 'notification', 'Phase', 'QTUdWP');
INSERT INTO `notifications` VALUES ('39', '22', 'Freelancer', '11', 'Phase Progress', '<strong><a target=\"_blank\" href=\"http://gameshader.net/view/freelancer/QTqlUP\">Ms Himels</a>\r\n                has been started your phase.</strong>Please click following link to read job details:<br/>\r\n                <a target=\"_blank\" href=\"http://gameshader.net/view/job/QTn1TP/QT6dWP\">PHP laravel</a>', '1', 'Client', '2014-11-09', '2014-11-09', 'client/phase-progress', 'Phase', 'QTUdWP');
INSERT INTO `notifications` VALUES ('40', '22', 'Freelancer', '11', 'Payment Process', 'This freelancer has been completed phase.', '1', 'Client', '2014-11-09', '2014-11-09', 'client/payment-process', 'Payment', 'QTUdWP');
INSERT INTO `notifications` VALUES ('41', '11', 'Client', '1', 'Payment made by client', 'A Payment made by Client <b>Tanvir Anowar</b>', '0', 'Admin', '2014-11-09', '2014-11-09', 'admin/payment', 'Payment', 'wTR1TP');
INSERT INTO `notifications` VALUES ('42', '11', 'Client', '2', 'Payment made by client', 'A Payment made by Client <b>Tanvir Anowar</b>', '1', 'Admin', '2014-11-09', '2014-11-09', 'admin/payment', 'Payment', 'wTR1TP');
INSERT INTO `notifications` VALUES ('43', '11', 'Client', '22', 'Payment made by client', 'A Payment made by Client <b>Tanvir Anowar</b>', '0', 'Freelancer', '2014-11-09', '2014-11-09', ' payment', 'Payment', 'wTR1TP');

-- ----------------------------
-- Table structure for page
-- ----------------------------
DROP TABLE IF EXISTS `page`;
CREATE TABLE `page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_title` varchar(40) DEFAULT NULL,
  `custom_field` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `us` text CHARACTER SET latin1,
  `jpn` text CHARACTER SET utf8 COLLATE utf8_bin,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=big5;

-- ----------------------------
-- Records of page
-- ----------------------------
INSERT INTO `page` VALUES ('1', null, 'hello', 'Hello', 0xE682A8E5A5BD);
INSERT INTO `page` VALUES ('2', null, 'home', 'Home', 0xE3839BE383BCE383A0);
INSERT INTO `page` VALUES ('3', null, null, null, 0xE382ABE38386E382B4E383AAE383BCE38292E38396E383A9E382A6E382BA);
INSERT INTO `page` VALUES ('4', null, null, null, 0xE3839BE383BCE383A0);

-- ----------------------------
-- Table structure for payments
-- ----------------------------
DROP TABLE IF EXISTS `payments`;
CREATE TABLE `payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) DEFAULT NULL,
  `freelancer_id` int(11) DEFAULT NULL,
  `job_offer_id` int(11) DEFAULT NULL,
  `amount` varchar(45) DEFAULT NULL,
  `payment_id` varchar(255) DEFAULT NULL,
  `payment_status` enum('Pending','Processing','Paid') DEFAULT NULL,
  `release_dt` varchar(10) DEFAULT NULL,
  `paid_dt` varchar(10) DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_payment_jobphase_id` (`job_offer_id`) USING BTREE,
  CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`job_offer_id`) REFERENCES `job_offers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of payments
-- ----------------------------
INSERT INTO `payments` VALUES ('5', '10', '22', '16', '10', 'PAY-4X322312HE9195415KRPRXPY', 'Processing', '2014-11-09', null, '2014-11-09', '2014-11-09');
INSERT INTO `payments` VALUES ('6', '10', '22', '16', '10', 'PAY-36F03441X27931616KRPR37I', 'Processing', '2014-11-09', null, '2014-11-09', '2014-11-09');
INSERT INTO `payments` VALUES ('7', '10', '22', '16', '10', 'PAY-9Y615849L4057962YKRPR6NQ', 'Processing', '2014-11-09', null, '2014-11-09', '2014-11-09');
INSERT INTO `payments` VALUES ('8', '10', '22', '16', '10', 'PAY-5TE113536R953921MKRPTU2Q', 'Paid', '2014-11-09', '2014-11-09', '2014-11-09', '2014-11-09');
INSERT INTO `payments` VALUES ('9', '11', '22', '17', '500', 'PAY-4WA784371Y473750UKRPU46Q', 'Paid', '2014-11-09', '2014-11-09', '2014-11-09', '2014-11-09');

-- ----------------------------
-- Table structure for portfolios
-- ----------------------------
DROP TABLE IF EXISTS `portfolios`;
CREATE TABLE `portfolios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `freelancer_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `category_name` varchar(100) DEFAULT NULL,
  `description` text,
  `image` varchar(100) DEFAULT NULL,
  `url` varchar(100) DEFAULT NULL,
  `completed_date` timestamp NULL DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_freelancer_portfolio_id` (`freelancer_id`) USING BTREE,
  CONSTRAINT `portfolios_ibfk_1` FOREIGN KEY (`freelancer_id`) REFERENCES `freelancers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of portfolios
-- ----------------------------
INSERT INTO `portfolios` VALUES ('1', '5', 'Demo Project', 'Web development', 'Some Project Description', '1415073450_Overview_-_Market_Place_-_2014-10-15_17.14.06.png', 'http://carbon51.com', null, '2014-11-04', '2014-11-04', null);

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
  KEY `fk_professional_freelancer_id` (`freelancer_id`) USING BTREE,
  CONSTRAINT `professional_backgrounds_ibfk_1` FOREIGN KEY (`freelancer_id`) REFERENCES `freelancers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of professional_backgrounds
-- ----------------------------
INSERT INTO `professional_backgrounds` VALUES ('1', '5', 'Org nam', 'Org type', '2014-10-6', '2014-10-7', '1', 'sfsf', 'sfsf', '', 'sfser', '2014-10-27', '2014-10-27', null);
INSERT INTO `professional_backgrounds` VALUES ('4', '5', 'a', 'b', '2014-11-4', '', '1', 'c', '', '', 'd', '2014-11-04', '2014-11-04', null);

-- ----------------------------
-- Table structure for question_bank
-- ----------------------------
DROP TABLE IF EXISTS `question_bank`;
CREATE TABLE `question_bank` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` varchar(1000) DEFAULT NULL,
  `question_type` enum('Textbox','Checkbox','Radio') DEFAULT NULL,
  `level_id` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `skill_id` int(11) NOT NULL,
  `answers` varchar(2000) DEFAULT NULL,
  `answer_time` time DEFAULT NULL,
  `updated_at` date NOT NULL,
  `created_at` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_questionbank_questionlevel_id` (`level_id`) USING BTREE,
  KEY `fk_questionbank_questiongroup_id` (`group_id`) USING BTREE,
  KEY `skill_id` (`skill_id`) USING BTREE,
  CONSTRAINT `question_bank_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `question_group` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `question_bank_ibfk_2` FOREIGN KEY (`level_id`) REFERENCES `question_level` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of question_bank
-- ----------------------------
INSERT INTO `question_bank` VALUES ('5', 'PHP server scripts are surrounded by delimiters, which?', 'Radio', '1', '1', '1', '[{\"answer\":\"&lt;?php echo \'hi\'; ?&gt;\",\"correct\":\"1\"},{\"answer\":\"&lt;?php&gt;...&lt;\\/?&gt;\",\"correct\":0},{\"answer\":\"&lt;&amp;&gt;...&lt;\\/&amp;&gt;\",\"correct\":0},{\"answer\":\"&lt;script&gt;...&lt;\\/script&gt;s\",\"correct\":0}]', '00:01:00', '2014-09-11', '2014-08-25');
INSERT INTO `question_bank` VALUES ('6', 'How do you write \"Hello World\" in PHP', 'Radio', '1', '1', '1', '[{\"answer\":\"echo \\\"Hello World\\\";\",\"correct\":1},{\"answer\":\"\\\"Hello World\\\";\",\"correct\":0},{\"answer\":\"Document.Write(\\\"Hello World\\\");\",\"correct\":0}]', '00:01:00', '2014-09-09', '2014-08-25');
INSERT INTO `question_bank` VALUES ('7', 'All variables in PHP start with which symbol?', 'Radio', '1', '1', '1', '[{\"answer\":\"!\",\"correct\":0},{\"answer\":\"$\",\"correct\":\"1\"},{\"answer\":\"&\",\"correct\":0}]', '00:01:00', '2014-09-09', '2014-08-25');
INSERT INTO `question_bank` VALUES ('8', 'The PHP syntax is most similar to:', 'Radio', '1', '1', '1', '[{\"answer\":\"Perl and C\",\"correct\":\"1\"},{\"answer\":\"VBScript\",\"correct\":0},{\"answer\":\"JavaScript\",\"correct\":0}]', '00:01:00', '2014-09-09', '2014-08-25');
INSERT INTO `question_bank` VALUES ('9', 'How do you get information from a form that is submitted using the \"get\" method?', 'Radio', '1', '1', '1', '[{\"answer\":\"Request.QueryString;\",\"correct\":0},{\"answer\":\"Request.Form;\",\"correct\":0},{\"answer\":\"$_GET[];\",\"correct\":\"1\"}]', '00:01:00', '2014-09-09', '2014-08-25');
INSERT INTO `question_bank` VALUES ('10', 'When using the POST method, variables are displayed in the URL:', 'Radio', '1', '1', '1', '[{\"answer\":\"true\",\"correct\":0},{\"answer\":\"false\",\"correct\":\"1\"}]', '00:01:00', '2014-09-09', '2014-08-25');
INSERT INTO `question_bank` VALUES ('12', 'What is the correct way to create a function in PHP?', 'Radio', '4', '1', '1', '[{\"answer\":\"create myFunction()\",\"correct\":0},{\"answer\":\"new_function myFunction()\",\"correct\":0},{\"answer\":\"function myFunction()\",\"correct\":\"1\"}]', '00:01:00', '2014-09-09', '2014-08-25');
INSERT INTO `question_bank` VALUES ('13', 'What is the correct way to open the file \"time.txt\" as readable?', 'Radio', '4', '5', '1', '[{\"answer\":\"open(\\\"time.txt\\\");\",\"correct\":0},{\"answer\":\"fopen(\\\"time.txt\\\",\\\"r\\\");\",\"correct\":\"1\"},{\"answer\":\"open(\\\"time.txt\\\",\\\"read\\\");\",\"correct\":0},{\"answer\":\"fopen(\\\"time.txt\\\",\\\"r+\\\");\",\"correct\":0}]', '00:01:00', '2014-09-09', '2014-08-25');
INSERT INTO `question_bank` VALUES ('14', 'PHP allows you to send emails directly from a script', 'Radio', '4', '5', '1', '[{\"answer\":\"False\",\"correct\":0},{\"answer\":\"True\",\"correct\":\"1\"}]', '00:01:00', '2014-09-09', '2014-08-25');
INSERT INTO `question_bank` VALUES ('15', 'What is the correct way to connect to a MySQL database?', 'Radio', '4', '1', '1', '[{\"answer\":\"mysqli_connect(host,username,password,dbname);\",\"correct\":\"1\"},{\"answer\":\"mysqli_db(host,username,password,dbname);\",\"correct\":0},{\"answer\":\"mysqli_open(host,username,password,dbname);\",\"correct\":0}]', '00:01:00', '2014-09-09', '2014-08-25');
INSERT INTO `question_bank` VALUES ('16', 'What is the correct way to add 1 to the $count variable?', 'Radio', '1', '1', '1', '[{\"answer\":\"count++;\",\"correct\":0},{\"answer\":\"++count\",\"correct\":0},{\"answer\":\"$count =+1\",\"correct\":\"1\"},{\"answer\":\"$count++;\",\"correct\":\"1\"}]', '00:01:00', '2014-09-09', '2014-08-25');
INSERT INTO `question_bank` VALUES ('17', 'What is a correct way to add a comment in PHP?', 'Radio', '1', '1', '1', '[{\"answer\":\"<!--\\ufffd-->\",\"correct\":0},{\"answer\":\"\\/*\\ufffd*\\/\",\"correct\":\"1\"},{\"answer\":\"*\\\\..\\\\*\",\"correct\":0},{\"answer\":\"<comment>\\ufffd<\\/comment>\",\"correct\":0}]', '00:01:00', '2014-09-09', '2014-08-25');
INSERT INTO `question_bank` VALUES ('18', 'PHP can be run on Microsoft Windows IIS(Internet Information Server):', 'Radio', '6', '5', '1', '[{\"answer\":\"True\",\"correct\":\"1\"},{\"answer\":\"False\",\"correct\":0}]', '00:01:00', '2014-09-09', '2014-08-25');
INSERT INTO `question_bank` VALUES ('19', 'Possible way of reading file in php', 'Checkbox', '6', '4', '1', '[{\"answer\":\"fopen(\'filename.txt\')\",\"correct\":true},{\"answer\":\"file_get_contents(\'filename.txt\')\",\"correct\":true},{\"answer\":\"file_open(\'filename.txt\')\",\"correct\":0},{\"answer\":\"getFile(\'filename.txt\')\",\"correct\":0}]', '00:01:00', '2014-09-14', '2014-09-14');
INSERT INTO `question_bank` VALUES ('20', 'What is the output of strrev(strtolower(trim(\'Never odd or even\')))', 'Textbox', '6', '2', '1', '[{\"answer\":\"neveroddoreven\",\"correct\":1}]', '00:02:00', '2014-09-14', '2014-09-14');

-- ----------------------------
-- Table structure for question_group
-- ----------------------------
DROP TABLE IF EXISTS `question_group`;
CREATE TABLE `question_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) DEFAULT NULL,
  `updated_at` date NOT NULL,
  `created_at` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of question_group
-- ----------------------------
INSERT INTO `question_group` VALUES ('1', 'Introduction', '0000-00-00', '0000-00-00');
INSERT INTO `question_group` VALUES ('2', 'String Operation', '2014-08-25', '2014-08-25');
INSERT INTO `question_group` VALUES ('3', 'Array Manipulation', '2014-08-25', '2014-08-25');
INSERT INTO `question_group` VALUES ('4', 'File Operation', '2014-08-25', '2014-08-25');
INSERT INTO `question_group` VALUES ('5', 'I/O Operation', '2014-08-25', '2014-08-25');
INSERT INTO `question_group` VALUES ('6', 'Structure', '2014-08-25', '2014-08-25');
INSERT INTO `question_group` VALUES ('7', 'Data Modeling', '2014-08-25', '2014-08-25');

-- ----------------------------
-- Table structure for question_level
-- ----------------------------
DROP TABLE IF EXISTS `question_level`;
CREATE TABLE `question_level` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) DEFAULT NULL,
  `updated_at` date NOT NULL,
  `created_at` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of question_level
-- ----------------------------
INSERT INTO `question_level` VALUES ('1', 'Beginner', '0000-00-00', '0000-00-00');
INSERT INTO `question_level` VALUES ('4', 'Intermediate', '2014-08-25', '2014-08-25');
INSERT INTO `question_level` VALUES ('6', 'Expert', '2014-08-25', '2014-08-25');

-- ----------------------------
-- Table structure for question_set
-- ----------------------------
DROP TABLE IF EXISTS `question_set`;
CREATE TABLE `question_set` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `skill_id` int(11) DEFAULT NULL,
  `title` varchar(45) NOT NULL,
  `question_rule` varchar(2000) DEFAULT NULL,
  `test_time` varchar(100) NOT NULL,
  `updated_at` date DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of question_set
-- ----------------------------
INSERT INTO `question_set` VALUES ('4', '1', 'Qset 1', '[{\"group_id\":1,\"questions\":[{\"level_id\":1,\"q_no\":\"8\"}]},{\"group_id\":\"5\",\"questions\":[{\"level_id\":\"4\",\"q_no\":\"2\"}]}]', '10', '2014-09-09', '2014-09-09');
INSERT INTO `question_set` VALUES ('5', '1', 'Qset 2', '[{\"group_id\":\"5\",\"questions\":[{\"level_id\":\"4\",\"q_no\":\"2\"}]}]', '20', '2014-09-09', '2014-09-09');
INSERT INTO `question_set` VALUES ('6', '1', 'Qset 3', '[{\"group_id\":1,\"questions\":[{\"level_id\":1,\"q_no\":\"8\"}]}]', '4', '2014-09-09', '2014-09-09');
INSERT INTO `question_set` VALUES ('7', '1', 'Qset 4', '[{\"group_id\":1,\"questions\":[{\"level_id\":1,\"q_no\":\"2\"}]},{\"group_id\":\"4\",\"questions\":[{\"level_id\":\"6\",\"q_no\":1}]},{\"group_id\":\"2\",\"questions\":[{\"level_id\":\"6\",\"q_no\":1}]}]', '5', '2014-09-14', '2014-09-14');

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
  `deleted_at` timestamp NULL DEFAULT NULL,
  `display` tinyint(1) NOT NULL DEFAULT '1',
  `test_taken` tinyint(1) NOT NULL DEFAULT '0',
  `test_start_at` varchar(100) NOT NULL,
  `test_end_at` varchar(100) NOT NULL,
  `test_data` text NOT NULL,
  `last_question_index` int(11) DEFAULT NULL,
  `test_result` text NOT NULL,
  `last_question_set` int(11) NOT NULL,
  `retake_date` varchar(100) DEFAULT NULL,
  `test_percentage` varchar(20) DEFAULT NULL,
  `score` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_freelancercategory_category_id` (`skill_tags_id`) USING BTREE,
  KEY `fk_freelancer_related_id` (`relatedentity_id`) USING BTREE,
  CONSTRAINT `related_tags_ibfk_1` FOREIGN KEY (`skill_tags_id`) REFERENCES `skill_tags` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=128 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of related_tags
-- ----------------------------
INSERT INTO `related_tags` VALUES ('4', '5', 'Freelancer', '5', '2014-11-04', '2014-09-18', null, '1', '0', '', '', '', null, '', '0', null, null, null);
INSERT INTO `related_tags` VALUES ('5', '1', 'JobPost', '1', '2014-09-20', '2014-09-18', null, '1', '0', '', '', '', null, '', '0', null, null, null);
INSERT INTO `related_tags` VALUES ('6', '2', 'JobPost', '6', '2014-09-20', '2014-09-20', null, '1', '0', '', '', '', null, '', '0', null, null, null);
INSERT INTO `related_tags` VALUES ('7', '3', 'JobPost', '2', '2014-09-20', '2014-09-20', null, '1', '0', '', '', '', null, '', '0', null, null, null);
INSERT INTO `related_tags` VALUES ('8', '3', 'JobPost', '3', '2014-09-20', '2014-09-20', null, '1', '0', '', '', '', null, '', '0', null, null, null);
INSERT INTO `related_tags` VALUES ('9', '4', 'JobPost', '9', '2014-09-20', '2014-09-20', null, '1', '0', '', '', '', null, '', '0', null, null, null);
INSERT INTO `related_tags` VALUES ('10', '9', 'Freelancer', '1', '2014-09-21', '2014-09-21', null, '1', '0', '', '', '', null, '', '0', null, null, null);
INSERT INTO `related_tags` VALUES ('11', '5', 'Freelancer', '1', '2014-11-04', '2014-09-24', null, '0', '0', '', '', '', null, '', '0', null, null, null);
INSERT INTO `related_tags` VALUES ('12', '19', 'JobPost', '6', '2014-09-29', '2014-09-29', null, '1', '0', '', '', '', null, '', '0', null, null, null);
INSERT INTO `related_tags` VALUES ('13', '2', 'Freelancer', '1', '2014-09-29', '2014-09-29', null, '1', '0', '', '', '', null, '', '0', null, null, null);
INSERT INTO `related_tags` VALUES ('14', '2', 'Freelancer', '9', '2014-09-29', '2014-09-29', null, '1', '0', '', '', '', null, '', '0', null, null, null);
INSERT INTO `related_tags` VALUES ('15', '2', 'Freelancer', '2', '2014-09-29', '2014-09-29', null, '1', '0', '', '', '', null, '', '0', null, null, null);
INSERT INTO `related_tags` VALUES ('16', '4', 'Freelancer', '7', '2014-09-29', '2014-09-29', null, '1', '0', '', '', '', null, '', '0', null, null, null);
INSERT INTO `related_tags` VALUES ('17', '4', 'Freelancer', '4', '2014-09-29', '2014-09-29', null, '1', '0', '', '', '', null, '', '0', null, null, null);
INSERT INTO `related_tags` VALUES ('18', '4', 'Freelancer', '6', '2014-09-29', '2014-09-29', null, '1', '0', '', '', '', null, '', '0', null, null, null);
INSERT INTO `related_tags` VALUES ('19', '6', 'Freelancer', '1', '2014-09-29', '2014-09-29', null, '1', '0', '', '', '', null, '', '0', null, null, null);
INSERT INTO `related_tags` VALUES ('20', '6', 'Freelancer', '2', '2014-09-29', '2014-09-29', null, '1', '0', '', '', '', null, '', '0', null, null, null);
INSERT INTO `related_tags` VALUES ('21', '6', 'Freelancer', '4', '2014-09-29', '2014-09-29', null, '1', '0', '', '', '', null, '', '0', null, null, null);
INSERT INTO `related_tags` VALUES ('22', '7', 'Freelancer', '1', '2014-09-29', '2014-09-29', null, '1', '0', '', '', '', null, '', '0', null, null, null);
INSERT INTO `related_tags` VALUES ('23', '7', 'Freelancer', '2', '2014-09-29', '2014-09-29', null, '1', '0', '', '', '', null, '', '0', null, null, null);
INSERT INTO `related_tags` VALUES ('24', '8', 'Freelancer', '9', '2014-09-29', '2014-09-29', null, '1', '0', '', '', '', null, '', '0', null, null, null);
INSERT INTO `related_tags` VALUES ('25', '20', 'JobPost', '1', '2014-09-29', '2014-09-29', null, '1', '0', '', '', '', null, '', '0', null, null, null);
INSERT INTO `related_tags` VALUES ('26', '20', 'JobPost', '9', '2014-09-29', '2014-09-29', null, '1', '0', '', '', '', null, '', '0', null, null, null);
INSERT INTO `related_tags` VALUES ('27', '20', 'JobPost', '7', '2014-09-29', '2014-09-29', null, '1', '0', '', '', '', null, '', '0', null, null, null);
INSERT INTO `related_tags` VALUES ('28', '20', 'JobPost', '4', '2014-09-29', '2014-09-29', null, '1', '0', '', '', '', null, '', '0', null, null, null);
INSERT INTO `related_tags` VALUES ('29', '20', 'JobPost', '6', '2014-09-29', '2014-09-29', null, '1', '0', '', '', '', null, '', '0', null, null, null);
INSERT INTO `related_tags` VALUES ('30', '21', 'JobPost', '6', '2014-10-01', '2014-10-01', null, '1', '0', '', '', '', null, '', '0', null, null, null);
INSERT INTO `related_tags` VALUES ('31', '21', 'JobPost', '1', '2014-10-01', '2014-10-01', null, '1', '0', '', '', '', null, '', '0', null, null, null);
INSERT INTO `related_tags` VALUES ('32', '21', 'JobPost', '9', '2014-10-01', '2014-10-01', null, '1', '0', '', '', '', null, '', '0', null, null, null);
INSERT INTO `related_tags` VALUES ('33', '21', 'JobPost', '2', '2014-10-01', '2014-10-01', null, '1', '0', '', '', '', null, '', '0', null, null, null);
INSERT INTO `related_tags` VALUES ('34', '21', 'JobPost', '7', '2014-10-01', '2014-10-01', null, '1', '0', '', '', '', null, '', '0', null, null, null);
INSERT INTO `related_tags` VALUES ('35', '21', 'JobPost', '4', '2014-10-01', '2014-10-01', null, '1', '0', '', '', '', null, '', '0', null, null, null);
INSERT INTO `related_tags` VALUES ('36', '22', 'JobPost', '6', '2014-10-01', '2014-10-01', null, '1', '0', '', '', '', null, '', '0', null, null, null);
INSERT INTO `related_tags` VALUES ('37', '22', 'JobPost', '1', '2014-10-01', '2014-10-01', null, '1', '0', '', '', '', null, '', '0', null, null, null);
INSERT INTO `related_tags` VALUES ('38', '22', 'JobPost', '9', '2014-10-01', '2014-10-01', null, '1', '0', '', '', '', null, '', '0', null, null, null);
INSERT INTO `related_tags` VALUES ('39', '22', 'JobPost', '2', '2014-10-01', '2014-10-01', null, '1', '0', '', '', '', null, '', '0', null, null, null);
INSERT INTO `related_tags` VALUES ('40', '22', 'JobPost', '7', '2014-10-01', '2014-10-01', null, '1', '0', '', '', '', null, '', '0', null, null, null);
INSERT INTO `related_tags` VALUES ('41', '22', 'JobPost', '4', '2014-10-01', '2014-10-01', null, '1', '0', '', '', '', null, '', '0', null, null, null);
INSERT INTO `related_tags` VALUES ('42', '23', 'JobPost', '6', '2014-10-01', '2014-10-01', null, '1', '0', '', '', '', null, '', '0', null, null, null);
INSERT INTO `related_tags` VALUES ('43', '23', 'JobPost', '1', '2014-10-01', '2014-10-01', null, '1', '0', '', '', '', null, '', '0', null, null, null);
INSERT INTO `related_tags` VALUES ('44', '23', 'JobPost', '9', '2014-10-01', '2014-10-01', null, '1', '0', '', '', '', null, '', '0', null, null, null);
INSERT INTO `related_tags` VALUES ('45', '23', 'JobPost', '2', '2014-10-01', '2014-10-01', null, '1', '0', '', '', '', null, '', '0', null, null, null);
INSERT INTO `related_tags` VALUES ('46', '23', 'JobPost', '7', '2014-10-01', '2014-10-01', null, '1', '0', '', '', '', null, '', '0', null, null, null);
INSERT INTO `related_tags` VALUES ('47', '23', 'JobPost', '4', '2014-10-01', '2014-10-01', null, '1', '0', '', '', '', null, '', '0', null, null, null);
INSERT INTO `related_tags` VALUES ('48', '24', 'JobPost', '6', '2014-10-01', '2014-10-01', null, '1', '0', '', '', '', null, '', '0', null, null, null);
INSERT INTO `related_tags` VALUES ('49', '24', 'JobPost', '1', '2014-10-01', '2014-10-01', null, '1', '0', '', '', '', null, '', '0', null, null, null);
INSERT INTO `related_tags` VALUES ('50', '24', 'JobPost', '9', '2014-10-01', '2014-10-01', null, '1', '0', '', '', '', null, '', '0', null, null, null);
INSERT INTO `related_tags` VALUES ('51', '24', 'JobPost', '2', '2014-10-01', '2014-10-01', null, '1', '0', '', '', '', null, '', '0', null, null, null);
INSERT INTO `related_tags` VALUES ('52', '24', 'JobPost', '7', '2014-10-01', '2014-10-01', null, '1', '0', '', '', '', null, '', '0', null, null, null);
INSERT INTO `related_tags` VALUES ('53', '24', 'JobPost', '4', '2014-10-01', '2014-10-01', null, '1', '0', '', '', '', null, '', '0', null, null, null);
INSERT INTO `related_tags` VALUES ('54', '25', 'JobPost', '6', '2014-10-01', '2014-10-01', null, '1', '0', '', '', '', null, '', '0', null, null, null);
INSERT INTO `related_tags` VALUES ('55', '25', 'JobPost', '1', '2014-10-01', '2014-10-01', null, '1', '0', '', '', '', null, '', '0', null, null, null);
INSERT INTO `related_tags` VALUES ('56', '25', 'JobPost', '9', '2014-10-01', '2014-10-01', null, '1', '0', '', '', '', null, '', '0', null, null, null);
INSERT INTO `related_tags` VALUES ('57', '25', 'JobPost', '2', '2014-10-01', '2014-10-01', null, '1', '0', '', '', '', null, '', '0', null, null, null);
INSERT INTO `related_tags` VALUES ('58', '25', 'JobPost', '4', '2014-10-01', '2014-10-01', null, '1', '0', '', '', '', null, '', '0', null, null, null);
INSERT INTO `related_tags` VALUES ('64', '27', 'JobPost', '6', '2014-10-02', '2014-10-02', null, '1', '0', '', '', '', null, '', '0', null, null, null);
INSERT INTO `related_tags` VALUES ('65', '27', 'JobPost', '1', '2014-10-02', '2014-10-02', null, '1', '0', '', '', '', null, '', '0', null, null, null);
INSERT INTO `related_tags` VALUES ('66', '27', 'JobPost', '9', '2014-10-02', '2014-10-02', null, '1', '0', '', '', '', null, '', '0', null, null, null);
INSERT INTO `related_tags` VALUES ('67', '27', 'JobPost', '2', '2014-10-02', '2014-10-02', null, '1', '0', '', '', '', null, '', '0', null, null, null);
INSERT INTO `related_tags` VALUES ('68', '27', 'JobPost', '7', '2014-10-02', '2014-10-02', null, '1', '0', '', '', '', null, '', '0', null, null, null);
INSERT INTO `related_tags` VALUES ('69', '27', 'JobPost', '4', '2014-10-02', '2014-10-02', null, '1', '0', '', '', '', null, '', '0', null, null, null);
INSERT INTO `related_tags` VALUES ('70', '28', 'JobPost', '1', '2014-10-12', '2014-10-12', null, '1', '0', '', '', '', null, '', '0', null, null, null);
INSERT INTO `related_tags` VALUES ('71', '29', 'JobPost', '5', '2014-10-12', '2014-10-12', null, '1', '0', '', '', '', null, '', '0', null, null, null);
INSERT INTO `related_tags` VALUES ('72', '29', 'JobPost', '1', '2014-10-12', '2014-10-12', null, '1', '0', '', '', '', null, '', '0', null, null, null);
INSERT INTO `related_tags` VALUES ('73', '30', 'JobPost', '5', '2014-10-13', '2014-10-13', null, '1', '0', '', '', '', null, '', '0', null, null, null);
INSERT INTO `related_tags` VALUES ('74', '30', 'JobPost', '1', '2014-10-13', '2014-10-13', null, '1', '0', '', '', '', null, '', '0', null, null, null);
INSERT INTO `related_tags` VALUES ('75', '31', 'JobPost', '1', '2014-10-13', '2014-10-13', null, '1', '0', '', '', '', null, '', '0', null, null, null);
INSERT INTO `related_tags` VALUES ('76', '31', 'JobPost', '5', '2014-10-13', '2014-10-13', null, '1', '0', '', '', '', null, '', '0', null, null, null);
INSERT INTO `related_tags` VALUES ('77', '32', 'JobPost', '6', '2014-10-15', '2014-10-15', null, '1', '0', '', '', '', null, '', '0', null, null, null);
INSERT INTO `related_tags` VALUES ('78', '32', 'JobPost', '1', '2014-10-15', '2014-10-15', null, '1', '0', '', '', '', null, '', '0', null, null, null);
INSERT INTO `related_tags` VALUES ('79', '32', 'JobPost', '9', '2014-10-15', '2014-10-15', null, '1', '0', '', '', '', null, '', '0', null, null, null);
INSERT INTO `related_tags` VALUES ('80', '32', 'JobPost', '2', '2014-10-15', '2014-10-15', null, '1', '0', '', '', '', null, '', '0', null, null, null);
INSERT INTO `related_tags` VALUES ('81', '33', 'JobPost', '1', '2014-10-22', '2014-10-22', null, '1', '0', '', '', '', null, '', '0', null, null, null);
INSERT INTO `related_tags` VALUES ('82', '34', 'JobPost', '1', '2014-10-22', '2014-10-22', null, '1', '0', '', '', '', null, '', '0', null, null, null);
INSERT INTO `related_tags` VALUES ('119', '5', 'Freelancer', '4', '2014-11-04', '2014-11-04', null, '1', '0', '', '', '', null, '', '0', null, null, null);
INSERT INTO `related_tags` VALUES ('120', '5', 'Freelancer', '2', '2014-11-04', '2014-11-04', null, '1', '0', '', '', '', null, '', '0', null, null, null);
INSERT INTO `related_tags` VALUES ('121', '35', 'JobPost', '1', '2014-11-09', '2014-11-09', null, '1', '0', '', '', '', null, '', '0', null, null, null);
INSERT INTO `related_tags` VALUES ('122', '36', 'JobPost', '1', '2014-11-09', '2014-11-09', null, '1', '0', '', '', '', null, '', '0', null, null, null);
INSERT INTO `related_tags` VALUES ('123', '37', 'JobPost', '1', '2014-11-09', '2014-11-09', null, '1', '0', '', '', '', null, '', '0', null, null, null);
INSERT INTO `related_tags` VALUES ('124', '22', 'Freelancer', '1', '2014-11-09', '2014-11-09', null, '1', '0', '', '', '', null, '', '0', null, null, null);
INSERT INTO `related_tags` VALUES ('125', '22', 'Freelancer', '2', '2014-11-09', '2014-11-09', null, '1', '0', '', '', '', null, '', '0', null, null, null);
INSERT INTO `related_tags` VALUES ('126', '22', 'Freelancer', '4', '2014-11-09', '2014-11-09', null, '1', '0', '', '', '', null, '', '0', null, null, null);
INSERT INTO `related_tags` VALUES ('127', '38', 'JobPost', '1', '2014-11-09', '2014-11-09', null, '1', '0', '', '', '', null, '', '0', null, null, null);

-- ----------------------------
-- Table structure for skill_tags
-- ----------------------------
DROP TABLE IF EXISTS `skill_tags`;
CREATE TABLE `skill_tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(45) DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `display` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of skill_tags
-- ----------------------------
INSERT INTO `skill_tags` VALUES ('1', 'PHP', '2014-09-09', '2014-09-09', null, '1');
INSERT INTO `skill_tags` VALUES ('2', 'HTML 5', '2014-09-09', '2014-09-09', null, '1');
INSERT INTO `skill_tags` VALUES ('3', 'CSS', '2014-09-09', '2014-09-09', null, '1');
INSERT INTO `skill_tags` VALUES ('4', 'CSS 3', '2014-09-09', '2014-09-09', null, '1');
INSERT INTO `skill_tags` VALUES ('5', 'Java', '2014-09-09', '2014-09-09', null, '1');
INSERT INTO `skill_tags` VALUES ('6', 'C#', '2014-09-09', '2014-09-09', null, '1');
INSERT INTO `skill_tags` VALUES ('7', 'C++', '2014-09-09', '2014-09-09', null, '1');
INSERT INTO `skill_tags` VALUES ('8', 'Asp.Net', '2014-09-09', '2014-09-09', null, '1');
INSERT INTO `skill_tags` VALUES ('9', 'Photoshop', '2014-09-09', '2014-09-09', null, '1');
INSERT INTO `skill_tags` VALUES ('10', 'Illustrator', '2014-09-09', '2014-09-09', null, '1');

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
  KEY `fk_freelancer_slip_id` (`freelance_id`) USING BTREE,
  KEY `fk_slip_joboffer_id` (`job_offer_id`) USING BTREE,
  CONSTRAINT `slips_ibfk_1` FOREIGN KEY (`freelance_id`) REFERENCES `freelancers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `slips_ibfk_2` FOREIGN KEY (`job_offer_id`) REFERENCES `job_offers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of slips
-- ----------------------------

-- ----------------------------
-- Table structure for test_taken
-- ----------------------------
DROP TABLE IF EXISTS `test_taken`;
CREATE TABLE `test_taken` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `participent_id` int(11) DEFAULT NULL,
  `answer` varchar(3000) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_test_participent_id` (`participent_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of test_taken
-- ----------------------------

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
  KEY `throttle_user_id_index` (`user_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of throttle
-- ----------------------------
INSERT INTO `throttle` VALUES ('26', '0', '127.0.0.1', '0', '0', '0', null, null, null);
INSERT INTO `throttle` VALUES ('27', '66', '127.0.0.1', '0', '0', '0', null, null, null);
INSERT INTO `throttle` VALUES ('28', '64', '127.0.0.1', '0', '0', '0', null, null, null);
INSERT INTO `throttle` VALUES ('29', '67', '127.0.0.1', '0', '0', '0', null, null, null);
INSERT INTO `throttle` VALUES ('30', '73', '180.234.210.214', '0', '0', '0', null, null, null);
INSERT INTO `throttle` VALUES ('31', '74', '180.234.210.214', '0', '0', '0', null, null, null);
INSERT INTO `throttle` VALUES ('32', '75', '180.234.210.214', '0', '0', '0', null, null, null);
INSERT INTO `throttle` VALUES ('33', '77', '180.234.210.214', '0', '0', '0', null, null, null);
INSERT INTO `throttle` VALUES ('34', '78', '180.234.210.214', '0', '0', '0', null, null, null);
INSERT INTO `throttle` VALUES ('35', '79', '180.234.210.214', '0', '0', '0', null, null, null);
INSERT INTO `throttle` VALUES ('36', '80', '180.234.210.214', '1', '0', '0', '2014-10-30 06:19:56', null, null);
INSERT INTO `throttle` VALUES ('37', '81', '180.234.53.225', '0', '0', '0', null, null, null);
INSERT INTO `throttle` VALUES ('38', '81', '180.234.210.214', '0', '0', '0', null, null, null);
INSERT INTO `throttle` VALUES ('39', '72', '180.234.210.214', '0', '0', '0', null, null, null);
INSERT INTO `throttle` VALUES ('40', '82', '180.234.210.214', '0', '0', '0', null, null, null);
INSERT INTO `throttle` VALUES ('41', '84', '180.234.210.214', '0', '0', '0', null, null, null);
INSERT INTO `throttle` VALUES ('42', '85', '180.234.210.214', '0', '0', '0', null, null, null);
INSERT INTO `throttle` VALUES ('43', '2', '180.234.210.214', '0', '0', '0', null, null, null);
INSERT INTO `throttle` VALUES ('44', '89', '180.234.210.214', '0', '0', '0', null, null, null);
INSERT INTO `throttle` VALUES ('45', '90', '180.234.210.214', '0', '0', '0', null, null, null);
INSERT INTO `throttle` VALUES ('46', '92', '103.245.207.5', '0', '0', '0', null, null, null);
INSERT INTO `throttle` VALUES ('47', '93', '180.234.210.214', '0', '0', '0', null, null, null);
INSERT INTO `throttle` VALUES ('48', '94', '180.234.210.214', '0', '0', '0', null, null, null);
INSERT INTO `throttle` VALUES ('49', '95', '180.234.210.214', '0', '0', '0', null, null, null);
INSERT INTO `throttle` VALUES ('50', '96', '180.234.210.214', '0', '0', '0', null, null, null);

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
  `is_agent` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`) USING BTREE,
  KEY `users_activation_code_index` (`activation_code`) USING BTREE,
  KEY `users_reset_password_code_index` (`reset_password_code`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=98 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('2', 'a@a.com', '$2y$10$S3P8DPQaTUqYzOZXY4DB3OUSEOYWHL3./yhEPOi.wmh3t4YsoW.WW', null, '1', null, null, '2014-11-09 11:20:12', '$2y$10$9YIprvxiD8kEe0.y2OVK1Oz8Hq1Oef.Nz34.hyg/YIw5CDG1m7RMG', null, 'a', 'Admin', '2014-08-22 18:15:23', '2014-11-09 11:20:12', '2', 'Admin', null);
INSERT INTO `users` VALUES ('72', 'superadmin@mail.com', '$2y$10$S3P8DPQaTUqYzOZXY4DB3OUSEOYWHL3./yhEPOi.wmh3t4YsoW.WW', null, '1', null, null, '2014-10-27 05:47:41', '$2y$10$mAcEaXk0fyDyEDe5brySre1DyPpquQ7qjBbNOSsG.Rwyp6AtL/A4S', null, 'Admin', 'Admin', '2014-08-22 18:15:23', '2014-10-27 05:47:41', '1', 'Admin', null);
INSERT INTO `users` VALUES ('76', 'ema.aiub@gmail.com', '$2y$10$xVaaiRSSjRzdfeMcHjPIfuTznOiOSbwXtORGhfDCTibXlYP0dSxEC', null, '0', 'EwWVWD5GmDDgPhuC7o7Oksg57H5qoTCnD2FMIFwuQR', null, null, null, null, 'Tahmina', 'Akter', '2014-10-23 04:59:27', '2014-10-23 04:59:27', null, 'Freelancer', '0');
INSERT INTO `users` VALUES ('77', 'tahminaaiub@gmail.com', '$2y$10$50YQEaFCtQQx75WZgVzxcOTtGZQ4y5g88/MwTmVOocuPQGFcBh4Jm', null, '1', null, '2014-10-23 05:03:18', '2014-11-09 06:22:07', '$2y$10$0ea6me/.0BMzVEO5kVdY4e0HJIdmfFEq.l3gX3qCmMl9O/eDC0nWu', null, 'TAHMINA', 'AKTER', '2014-10-23 05:00:33', '2014-11-09 06:22:07', '12', 'Freelancer', '0');
INSERT INTO `users` VALUES ('78', 'moutusi49@gmail.com', '$2y$10$.k84CgnD4e4AWFYASvWqae2HYATVhKTykaDHSpRUtvWhAGYaahbXO', null, '1', null, '2014-10-23 09:01:41', '2014-11-09 05:50:38', '$2y$10$tw.EBJxu0mhfvEb.0yu7vewdneegfszHGS9ECoTzfmB1wpZiOSFKy', null, 'Tahmina', 'Akter', '2014-10-23 08:59:11', '2014-11-09 05:50:38', '5', 'Client', null);
INSERT INTO `users` VALUES ('79', 'johir@carbon51.com', '$2y$10$G4mrjqzOrMTXEb8KsJI7J.7YeT9xww0EYOX5EGJR8o2Y8Do4oSqZq', null, '1', null, '2014-10-23 09:45:24', '2014-10-23 09:46:19', '$2y$10$Z7zoE1b3E239PQvXQGi63.e2h7Kz8ma7pyxS/06RI2jleovzbCWYm', null, 'Md. Johir', ' Uddin', '2014-10-23 09:41:30', '2014-10-23 09:46:19', '13', 'Freelancer', '1');
INSERT INTO `users` VALUES ('80', 'support@carbon51.com', '$2y$10$B9XryCWUhsiu7qCWy.P0Re36sSimX5sMjSh8a/3tl/1DY7yljHaZm', null, '1', null, '2014-10-23 09:58:09', '2014-10-23 09:58:35', '$2y$10$CP9uV7FZaJmfrKkPUNlhj.0zZBj8HEfdNW90r/4VuhnyOSXRjl3Em', null, 'johir', 'uddin', '2014-10-23 09:57:00', '2014-10-23 09:58:35', '6', 'Client', null);
INSERT INTO `users` VALUES ('82', 'carbon51user1@gmail.com', '$2y$10$KEh6pSLXHqaCqcO4N3rz7eiGrYLbcag8p/c3H8jdBEil4Q/ijyW6a', null, '1', null, '2014-10-27 09:40:52', '2014-10-27 10:45:12', '$2y$10$1qZziYKdlhrNN8OdRp9ycupX9z0z3qXkgziV.4Ze5PdDLYSkq98yu', null, 'Carbon', 'carbon', '2014-10-27 09:38:43', '2014-10-27 10:45:12', '15', 'Freelancer', '0');
INSERT INTO `users` VALUES ('83', 'carbon51user2@gmail.com', '$2y$10$YLsAHEZSeB6tRzR2eptE6.L.uc8PwSBJI4QQSI2VeT3MKxzYYaVsK', null, '1', null, '2014-10-27 09:45:28', null, null, null, 'Carbon', 'carbon', '2014-10-27 09:44:10', '2014-10-27 09:45:28', '16', 'Freelancer', '0');
INSERT INTO `users` VALUES ('84', 'carbon51user33@gmail.com', '$2y$10$OH7M01Hi7hA1oU3XFuPum.Y30u.5T1zRC7bYPgebBoG40lcbVjZR6', null, '1', null, '2014-10-27 10:25:41', '2014-10-27 10:26:09', '$2y$10$fkPr9eJ2T972sWJjVBFUWOq7fcIwshgXYPR0sC5w9sAl/Vn6lvJLa', null, 'Carbon', 'carbon', '2014-10-27 09:47:24', '2014-10-27 10:26:09', '17', 'Freelancer', '0');
INSERT INTO `users` VALUES ('85', 'carbon51user4@gmail.com', '$2y$10$xTXmg8RiM.fVNgFjePpnv./AGu8aXIrsmWWg3xN0Iv9xxm6OXdID6', null, '1', null, '2014-10-27 10:31:12', '2014-10-27 11:04:30', '$2y$10$XvLcRSbiWixZsFXD7BXcguVixrP2eBPH6x/aQp/shGNVIVwCi6RzO', null, 'Carbon', 'carbon', '2014-10-27 10:30:02', '2014-10-27 11:04:30', '18', 'Freelancer', '1');
INSERT INTO `users` VALUES ('86', 'carbon51user5@gmail.com', '$2y$10$2Nw.bXuy8PdNK.iEogomNOCiTVaUjx.0rp3P6RcCbDBKqdx4puvb2', null, '1', null, '2014-10-27 10:33:34', null, null, null, 'Carbon', 'carbon', '2014-10-27 10:32:22', '2014-10-27 10:33:34', '19', 'Freelancer', '0');
INSERT INTO `users` VALUES ('87', 'carbon51user6@gmail.com', '$2y$10$Q.Lunouq1OSLm5Ztm5vPaeH7L.ifEXiajGzZunxD47OWV.bdKys/S', null, '1', null, '2014-10-27 10:37:40', null, null, null, 'Carbon', 'carbon', '2014-10-27 10:35:11', '2014-10-27 10:37:40', '7', 'Client', null);
INSERT INTO `users` VALUES ('88', 'carbon51user7@gmail.com', '$2y$10$6wPfEt85ty5KZO9SUnrBze6lZ9VAe2NsNc9/efXfEkheo7wfj8sgC', null, '0', '6Qi8BqG6IdN3CWlZt8hYe6eHCfiBf6alfnmElszzDI', null, null, null, null, 'Carbon', 'carbon', '2014-10-27 10:40:45', '2014-10-27 10:40:45', null, 'Freelancer', '0');
INSERT INTO `users` VALUES ('89', 'tanvir.net@gmail.com', '$2y$10$ekcOTDe0kba5PE/abZU2fukxz2PreH9yujqH6xjs95teX0Vlcin5q', null, '1', null, '2014-11-03 08:49:24', '2014-11-03 08:51:10', '$2y$10$m336Oeos1hjzaOABpyNloOz.sL6HLh9lDNWppVH9e1JBsM.95WYJa', null, 'Tanvir ', 'Freelancer', '2014-11-03 08:47:21', '2014-11-03 08:51:10', '20', 'Freelancer', '0');
INSERT INTO `users` VALUES ('91', 'rokon01bd@yahoo.com', '$2y$10$.wPt7g.tmu1WPpKy25hdTuc5sDJok24six4.jV2Ajt.xi8Dtk1Je.', null, '0', 'UZSqYc6LRHSeLWmDsbTxdoCjUWoeZtUMDp9uqnaVbh', null, null, null, null, 'Sanaul', 'Ishaque', '2014-11-04 06:46:40', '2014-11-04 06:46:40', null, 'Freelancer', '0');
INSERT INTO `users` VALUES ('92', 'rokon01bd@gmail.com', '$2y$10$EzupodwgALDGfexrlS/tzu5IiEKlxpQWy4ib1pr5cbUtwRt279HQ.', null, '1', null, '2014-11-04 13:21:34', '2014-11-04 13:26:23', '$2y$10$KK9xMgjlC66gzKnBRlvMuunWUnUGv4TIKnWSKOmHRSA7fYGWINx8e', null, 'Sanaul', 'Ishaque', '2014-11-04 06:48:07', '2014-11-04 13:26:23', '9', 'Client', null);
INSERT INTO `users` VALUES ('93', 'tanvir@carbon51s.com', '$2y$10$Gbk.2P3lZLpxZI/jLql.eeIU2ZG/JqqvI4xBEZzHG.R8u5hZnJEIq', null, '1', null, '2014-11-09 06:11:35', '2014-11-09 10:12:40', '$2y$10$kIaMsBvUMdd5h2jcrduCa.E8crjp8SlsjUFmyZ2WOffgUgJrO1OXS', null, 'Tanvirs', 'Anowars', '2014-11-09 06:10:58', '2014-11-09 10:12:40', '10', 'Client', null);
INSERT INTO `users` VALUES ('95', 'himel@carbon51s.com', '$2y$10$LPvmjQoJxFymRLxjr.KNMuKZeZgss33KtR6uMEBAI0ds48/izxdEy', null, '1', null, '2014-11-09 06:17:40', '2014-11-09 11:17:38', '$2y$10$AwvZ1CTHAa2Y9D8N3Q6ycOrU6Lj93pAwDHaBkdTfjRKFx0q49CGW2', null, 'Ms', 'Himels', '2014-11-09 06:17:29', '2014-11-09 11:17:38', '22', 'Freelancer', '0');
INSERT INTO `users` VALUES ('96', 'tanvir@carbon51.com', '$2y$10$InLFg3F9rFGgi4ixsEqmwu1gKhA8JKzqli6ohpSo4fy6L/ZzysWES', null, '1', null, '2014-11-09 11:01:22', '2014-11-09 11:15:49', '$2y$10$8iGMci6vZoulS0MnuuMN3uVmhUeag5fbklJ9df32SP3W9Gl8vIfSK', null, 'Tanvir', 'Anowar', '2014-11-09 11:01:00', '2014-11-09 11:15:49', '11', 'Client', null);
INSERT INTO `users` VALUES ('97', 'himel@carbon51.com', '$2y$10$d4JD7J9vK9OnGznADUynqOln5qhfwJWXjYhx70HDonynLRecEoP2O', null, '0', 'RtDvvIezl8zAWU5RzYBBgzoWL2J9YA4SMITqZum1rZ', null, null, null, null, 'Mehearaz', 'Himel', '2014-11-09 11:01:04', '2014-11-09 11:01:04', null, 'Freelancer', '0');

-- ----------------------------
-- Table structure for users_groups
-- ----------------------------
DROP TABLE IF EXISTS `users_groups`;
CREATE TABLE `users_groups` (
  `user_id` int(10) unsigned NOT NULL,
  `group_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of users_groups
-- ----------------------------
INSERT INTO `users_groups` VALUES ('0', '2');
INSERT INTO `users_groups` VALUES ('2', '2');
INSERT INTO `users_groups` VALUES ('64', '4');
INSERT INTO `users_groups` VALUES ('65', '5');
INSERT INTO `users_groups` VALUES ('66', '3');
INSERT INTO `users_groups` VALUES ('67', '3');
INSERT INTO `users_groups` VALUES ('68', '3');
INSERT INTO `users_groups` VALUES ('69', '3');
INSERT INTO `users_groups` VALUES ('70', '3');
INSERT INTO `users_groups` VALUES ('71', '3');
INSERT INTO `users_groups` VALUES ('73', '3');
INSERT INTO `users_groups` VALUES ('74', '4');
INSERT INTO `users_groups` VALUES ('75', '3');
INSERT INTO `users_groups` VALUES ('76', '3');
INSERT INTO `users_groups` VALUES ('77', '3');
INSERT INTO `users_groups` VALUES ('78', '4');
INSERT INTO `users_groups` VALUES ('79', '5');
INSERT INTO `users_groups` VALUES ('80', '4');
INSERT INTO `users_groups` VALUES ('81', '3');
INSERT INTO `users_groups` VALUES ('82', '3');
INSERT INTO `users_groups` VALUES ('83', '3');
INSERT INTO `users_groups` VALUES ('84', '3');
INSERT INTO `users_groups` VALUES ('85', '5');
INSERT INTO `users_groups` VALUES ('86', '3');
INSERT INTO `users_groups` VALUES ('87', '4');
INSERT INTO `users_groups` VALUES ('88', '3');
INSERT INTO `users_groups` VALUES ('89', '3');
INSERT INTO `users_groups` VALUES ('90', '4');
INSERT INTO `users_groups` VALUES ('91', '3');
INSERT INTO `users_groups` VALUES ('92', '4');
INSERT INTO `users_groups` VALUES ('93', '4');
INSERT INTO `users_groups` VALUES ('94', '3');
INSERT INTO `users_groups` VALUES ('95', '3');
INSERT INTO `users_groups` VALUES ('96', '4');
INSERT INTO `users_groups` VALUES ('97', '3');
