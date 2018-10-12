-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 30, 2014 at 04:21 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `marketplace`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `contact_number` varchar(45) DEFAULT NULL,
  `photos` varchar(255) DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `certifications`
--

CREATE TABLE IF NOT EXISTS `certifications` (
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
  KEY `fk_freelancer_cert_id` (`freelancer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
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
  `updated_at` date DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `deleted_at` varchar(10) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `first_name`, `last_name`, `address`, `address2`, `profile_title`, `description`, `country`, `city`, `province`, `postal_code`, `contact_number`, `photos`, `client_status`, `updated_at`, `created_at`, `deleted_at`, `email`) VALUES
(2, 'tanvir', 'anowar', 'swrer ere re', 'et ertr trtr', 'sdsfs dfd fdgf fgfgf', 'dfhsj fsdjfhdjfhdjh fjdhfdjhfdjf djfdjfdj fhdjfshf skfh sfsjfhsjhf sjfsjdfhsjhfsj fjdssjdhfjdhfjdfdjfhd jdhfjfhjdhfj', 'UNITED KINGDOM', 'trtr trt rt', 'trt rtrt', '3553535', '3535353535', 'map_5422ee69f3363.png', 'Active', '2014-09-24', '2014-08-31', NULL, 'tanvir@carbon51.com'),
(3, 'Client', 'Client', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', '2014-09-07', '2014-09-07', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jobthread_id` int(11) DEFAULT NULL,
  `jobthread_type` enum('JobOffer','JobPhase') DEFAULT NULL,
  `message` text,
  `updated_at` date DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `index2` (`jobthread_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE IF NOT EXISTS `country` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iso` char(2) NOT NULL,
  `name` varchar(80) NOT NULL,
  `nicename` varchar(80) NOT NULL,
  `iso3` char(3) DEFAULT NULL,
  `numcode` smallint(6) DEFAULT NULL,
  `phonecode` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=240 ;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES
(1, 'AF', 'AFGHANISTAN', 'Afghanistan', 'AFG', 4, 93),
(2, 'AL', 'ALBANIA', 'Albania', 'ALB', 8, 355),
(3, 'DZ', 'ALGERIA', 'Algeria', 'DZA', 12, 213),
(4, 'AS', 'AMERICAN SAMOA', 'American Samoa', 'ASM', 16, 1684),
(5, 'AD', 'ANDORRA', 'Andorra', 'AND', 20, 376),
(6, 'AO', 'ANGOLA', 'Angola', 'AGO', 24, 244),
(7, 'AI', 'ANGUILLA', 'Anguilla', 'AIA', 660, 1264),
(8, 'AQ', 'ANTARCTICA', 'Antarctica', NULL, NULL, 0),
(9, 'AG', 'ANTIGUA AND BARBUDA', 'Antigua and Barbuda', 'ATG', 28, 1268),
(10, 'AR', 'ARGENTINA', 'Argentina', 'ARG', 32, 54),
(11, 'AM', 'ARMENIA', 'Armenia', 'ARM', 51, 374),
(12, 'AW', 'ARUBA', 'Aruba', 'ABW', 533, 297),
(13, 'AU', 'AUSTRALIA', 'Australia', 'AUS', 36, 61),
(14, 'AT', 'AUSTRIA', 'Austria', 'AUT', 40, 43),
(15, 'AZ', 'AZERBAIJAN', 'Azerbaijan', 'AZE', 31, 994),
(16, 'BS', 'BAHAMAS', 'Bahamas', 'BHS', 44, 1242),
(17, 'BH', 'BAHRAIN', 'Bahrain', 'BHR', 48, 973),
(18, 'BD', 'BANGLADESH', 'Bangladesh', 'BGD', 50, 880),
(19, 'BB', 'BARBADOS', 'Barbados', 'BRB', 52, 1246),
(20, 'BY', 'BELARUS', 'Belarus', 'BLR', 112, 375),
(21, 'BE', 'BELGIUM', 'Belgium', 'BEL', 56, 32),
(22, 'BZ', 'BELIZE', 'Belize', 'BLZ', 84, 501),
(23, 'BJ', 'BENIN', 'Benin', 'BEN', 204, 229),
(24, 'BM', 'BERMUDA', 'Bermuda', 'BMU', 60, 1441),
(25, 'BT', 'BHUTAN', 'Bhutan', 'BTN', 64, 975),
(26, 'BO', 'BOLIVIA', 'Bolivia', 'BOL', 68, 591),
(27, 'BA', 'BOSNIA AND HERZEGOVINA', 'Bosnia and Herzegovina', 'BIH', 70, 387),
(28, 'BW', 'BOTSWANA', 'Botswana', 'BWA', 72, 267),
(29, 'BV', 'BOUVET ISLAND', 'Bouvet Island', NULL, NULL, 0),
(30, 'BR', 'BRAZIL', 'Brazil', 'BRA', 76, 55),
(31, 'IO', 'BRITISH INDIAN OCEAN TERRITORY', 'British Indian Ocean Territory', NULL, NULL, 246),
(32, 'BN', 'BRUNEI DARUSSALAM', 'Brunei Darussalam', 'BRN', 96, 673),
(33, 'BG', 'BULGARIA', 'Bulgaria', 'BGR', 100, 359),
(34, 'BF', 'BURKINA FASO', 'Burkina Faso', 'BFA', 854, 226),
(35, 'BI', 'BURUNDI', 'Burundi', 'BDI', 108, 257),
(36, 'KH', 'CAMBODIA', 'Cambodia', 'KHM', 116, 855),
(37, 'CM', 'CAMEROON', 'Cameroon', 'CMR', 120, 237),
(38, 'CA', 'CANADA', 'Canada', 'CAN', 124, 1),
(39, 'CV', 'CAPE VERDE', 'Cape Verde', 'CPV', 132, 238),
(40, 'KY', 'CAYMAN ISLANDS', 'Cayman Islands', 'CYM', 136, 1345),
(41, 'CF', 'CENTRAL AFRICAN REPUBLIC', 'Central African Republic', 'CAF', 140, 236),
(42, 'TD', 'CHAD', 'Chad', 'TCD', 148, 235),
(43, 'CL', 'CHILE', 'Chile', 'CHL', 152, 56),
(44, 'CN', 'CHINA', 'China', 'CHN', 156, 86),
(45, 'CX', 'CHRISTMAS ISLAND', 'Christmas Island', NULL, NULL, 61),
(46, 'CC', 'COCOS (KEELING) ISLANDS', 'Cocos (Keeling) Islands', NULL, NULL, 672),
(47, 'CO', 'COLOMBIA', 'Colombia', 'COL', 170, 57),
(48, 'KM', 'COMOROS', 'Comoros', 'COM', 174, 269),
(49, 'CG', 'CONGO', 'Congo', 'COG', 178, 242),
(50, 'CD', 'CONGO, THE DEMOCRATIC REPUBLIC OF THE', 'Congo, the Democratic Republic of the', 'COD', 180, 242),
(51, 'CK', 'COOK ISLANDS', 'Cook Islands', 'COK', 184, 682),
(52, 'CR', 'COSTA RICA', 'Costa Rica', 'CRI', 188, 506),
(53, 'CI', 'COTE D''IVOIRE', 'Cote D''Ivoire', 'CIV', 384, 225),
(54, 'HR', 'CROATIA', 'Croatia', 'HRV', 191, 385),
(55, 'CU', 'CUBA', 'Cuba', 'CUB', 192, 53),
(56, 'CY', 'CYPRUS', 'Cyprus', 'CYP', 196, 357),
(57, 'CZ', 'CZECH REPUBLIC', 'Czech Republic', 'CZE', 203, 420),
(58, 'DK', 'DENMARK', 'Denmark', 'DNK', 208, 45),
(59, 'DJ', 'DJIBOUTI', 'Djibouti', 'DJI', 262, 253),
(60, 'DM', 'DOMINICA', 'Dominica', 'DMA', 212, 1767),
(61, 'DO', 'DOMINICAN REPUBLIC', 'Dominican Republic', 'DOM', 214, 1809),
(62, 'EC', 'ECUADOR', 'Ecuador', 'ECU', 218, 593),
(63, 'EG', 'EGYPT', 'Egypt', 'EGY', 818, 20),
(64, 'SV', 'EL SALVADOR', 'El Salvador', 'SLV', 222, 503),
(65, 'GQ', 'EQUATORIAL GUINEA', 'Equatorial Guinea', 'GNQ', 226, 240),
(66, 'ER', 'ERITREA', 'Eritrea', 'ERI', 232, 291),
(67, 'EE', 'ESTONIA', 'Estonia', 'EST', 233, 372),
(68, 'ET', 'ETHIOPIA', 'Ethiopia', 'ETH', 231, 251),
(69, 'FK', 'FALKLAND ISLANDS (MALVINAS)', 'Falkland Islands (Malvinas)', 'FLK', 238, 500),
(70, 'FO', 'FAROE ISLANDS', 'Faroe Islands', 'FRO', 234, 298),
(71, 'FJ', 'FIJI', 'Fiji', 'FJI', 242, 679),
(72, 'FI', 'FINLAND', 'Finland', 'FIN', 246, 358),
(73, 'FR', 'FRANCE', 'France', 'FRA', 250, 33),
(74, 'GF', 'FRENCH GUIANA', 'French Guiana', 'GUF', 254, 594),
(75, 'PF', 'FRENCH POLYNESIA', 'French Polynesia', 'PYF', 258, 689),
(76, 'TF', 'FRENCH SOUTHERN TERRITORIES', 'French Southern Territories', NULL, NULL, 0),
(77, 'GA', 'GABON', 'Gabon', 'GAB', 266, 241),
(78, 'GM', 'GAMBIA', 'Gambia', 'GMB', 270, 220),
(79, 'GE', 'GEORGIA', 'Georgia', 'GEO', 268, 995),
(80, 'DE', 'GERMANY', 'Germany', 'DEU', 276, 49),
(81, 'GH', 'GHANA', 'Ghana', 'GHA', 288, 233),
(82, 'GI', 'GIBRALTAR', 'Gibraltar', 'GIB', 292, 350),
(83, 'GR', 'GREECE', 'Greece', 'GRC', 300, 30),
(84, 'GL', 'GREENLAND', 'Greenland', 'GRL', 304, 299),
(85, 'GD', 'GRENADA', 'Grenada', 'GRD', 308, 1473),
(86, 'GP', 'GUADELOUPE', 'Guadeloupe', 'GLP', 312, 590),
(87, 'GU', 'GUAM', 'Guam', 'GUM', 316, 1671),
(88, 'GT', 'GUATEMALA', 'Guatemala', 'GTM', 320, 502),
(89, 'GN', 'GUINEA', 'Guinea', 'GIN', 324, 224),
(90, 'GW', 'GUINEA-BISSAU', 'Guinea-Bissau', 'GNB', 624, 245),
(91, 'GY', 'GUYANA', 'Guyana', 'GUY', 328, 592),
(92, 'HT', 'HAITI', 'Haiti', 'HTI', 332, 509),
(93, 'HM', 'HEARD ISLAND AND MCDONALD ISLANDS', 'Heard Island and Mcdonald Islands', NULL, NULL, 0),
(94, 'VA', 'HOLY SEE (VATICAN CITY STATE)', 'Holy See (Vatican City State)', 'VAT', 336, 39),
(95, 'HN', 'HONDURAS', 'Honduras', 'HND', 340, 504),
(96, 'HK', 'HONG KONG', 'Hong Kong', 'HKG', 344, 852),
(97, 'HU', 'HUNGARY', 'Hungary', 'HUN', 348, 36),
(98, 'IS', 'ICELAND', 'Iceland', 'ISL', 352, 354),
(99, 'IN', 'INDIA', 'India', 'IND', 356, 91),
(100, 'ID', 'INDONESIA', 'Indonesia', 'IDN', 360, 62),
(101, 'IR', 'IRAN, ISLAMIC REPUBLIC OF', 'Iran, Islamic Republic of', 'IRN', 364, 98),
(102, 'IQ', 'IRAQ', 'Iraq', 'IRQ', 368, 964),
(103, 'IE', 'IRELAND', 'Ireland', 'IRL', 372, 353),
(104, 'IL', 'ISRAEL', 'Israel', 'ISR', 376, 972),
(105, 'IT', 'ITALY', 'Italy', 'ITA', 380, 39),
(106, 'JM', 'JAMAICA', 'Jamaica', 'JAM', 388, 1876),
(107, 'JP', 'JAPAN', 'Japan', 'JPN', 392, 81),
(108, 'JO', 'JORDAN', 'Jordan', 'JOR', 400, 962),
(109, 'KZ', 'KAZAKHSTAN', 'Kazakhstan', 'KAZ', 398, 7),
(110, 'KE', 'KENYA', 'Kenya', 'KEN', 404, 254),
(111, 'KI', 'KIRIBATI', 'Kiribati', 'KIR', 296, 686),
(112, 'KP', 'KOREA, DEMOCRATIC PEOPLE''S REPUBLIC OF', 'Korea, Democratic People''s Republic of', 'PRK', 408, 850),
(113, 'KR', 'KOREA, REPUBLIC OF', 'Korea, Republic of', 'KOR', 410, 82),
(114, 'KW', 'KUWAIT', 'Kuwait', 'KWT', 414, 965),
(115, 'KG', 'KYRGYZSTAN', 'Kyrgyzstan', 'KGZ', 417, 996),
(116, 'LA', 'LAO PEOPLE''S DEMOCRATIC REPUBLIC', 'Lao People''s Democratic Republic', 'LAO', 418, 856),
(117, 'LV', 'LATVIA', 'Latvia', 'LVA', 428, 371),
(118, 'LB', 'LEBANON', 'Lebanon', 'LBN', 422, 961),
(119, 'LS', 'LESOTHO', 'Lesotho', 'LSO', 426, 266),
(120, 'LR', 'LIBERIA', 'Liberia', 'LBR', 430, 231),
(121, 'LY', 'LIBYAN ARAB JAMAHIRIYA', 'Libyan Arab Jamahiriya', 'LBY', 434, 218),
(122, 'LI', 'LIECHTENSTEIN', 'Liechtenstein', 'LIE', 438, 423),
(123, 'LT', 'LITHUANIA', 'Lithuania', 'LTU', 440, 370),
(124, 'LU', 'LUXEMBOURG', 'Luxembourg', 'LUX', 442, 352),
(125, 'MO', 'MACAO', 'Macao', 'MAC', 446, 853),
(126, 'MK', 'MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF', 'Macedonia, the Former Yugoslav Republic of', 'MKD', 807, 389),
(127, 'MG', 'MADAGASCAR', 'Madagascar', 'MDG', 450, 261),
(128, 'MW', 'MALAWI', 'Malawi', 'MWI', 454, 265),
(129, 'MY', 'MALAYSIA', 'Malaysia', 'MYS', 458, 60),
(130, 'MV', 'MALDIVES', 'Maldives', 'MDV', 462, 960),
(131, 'ML', 'MALI', 'Mali', 'MLI', 466, 223),
(132, 'MT', 'MALTA', 'Malta', 'MLT', 470, 356),
(133, 'MH', 'MARSHALL ISLANDS', 'Marshall Islands', 'MHL', 584, 692),
(134, 'MQ', 'MARTINIQUE', 'Martinique', 'MTQ', 474, 596),
(135, 'MR', 'MAURITANIA', 'Mauritania', 'MRT', 478, 222),
(136, 'MU', 'MAURITIUS', 'Mauritius', 'MUS', 480, 230),
(137, 'YT', 'MAYOTTE', 'Mayotte', NULL, NULL, 269),
(138, 'MX', 'MEXICO', 'Mexico', 'MEX', 484, 52),
(139, 'FM', 'MICRONESIA, FEDERATED STATES OF', 'Micronesia, Federated States of', 'FSM', 583, 691),
(140, 'MD', 'MOLDOVA, REPUBLIC OF', 'Moldova, Republic of', 'MDA', 498, 373),
(141, 'MC', 'MONACO', 'Monaco', 'MCO', 492, 377),
(142, 'MN', 'MONGOLIA', 'Mongolia', 'MNG', 496, 976),
(143, 'MS', 'MONTSERRAT', 'Montserrat', 'MSR', 500, 1664),
(144, 'MA', 'MOROCCO', 'Morocco', 'MAR', 504, 212),
(145, 'MZ', 'MOZAMBIQUE', 'Mozambique', 'MOZ', 508, 258),
(146, 'MM', 'MYANMAR', 'Myanmar', 'MMR', 104, 95),
(147, 'NA', 'NAMIBIA', 'Namibia', 'NAM', 516, 264),
(148, 'NR', 'NAURU', 'Nauru', 'NRU', 520, 674),
(149, 'NP', 'NEPAL', 'Nepal', 'NPL', 524, 977),
(150, 'NL', 'NETHERLANDS', 'Netherlands', 'NLD', 528, 31),
(151, 'AN', 'NETHERLANDS ANTILLES', 'Netherlands Antilles', 'ANT', 530, 599),
(152, 'NC', 'NEW CALEDONIA', 'New Caledonia', 'NCL', 540, 687),
(153, 'NZ', 'NEW ZEALAND', 'New Zealand', 'NZL', 554, 64),
(154, 'NI', 'NICARAGUA', 'Nicaragua', 'NIC', 558, 505),
(155, 'NE', 'NIGER', 'Niger', 'NER', 562, 227),
(156, 'NG', 'NIGERIA', 'Nigeria', 'NGA', 566, 234),
(157, 'NU', 'NIUE', 'Niue', 'NIU', 570, 683),
(158, 'NF', 'NORFOLK ISLAND', 'Norfolk Island', 'NFK', 574, 672),
(159, 'MP', 'NORTHERN MARIANA ISLANDS', 'Northern Mariana Islands', 'MNP', 580, 1670),
(160, 'NO', 'NORWAY', 'Norway', 'NOR', 578, 47),
(161, 'OM', 'OMAN', 'Oman', 'OMN', 512, 968),
(162, 'PK', 'PAKISTAN', 'Pakistan', 'PAK', 586, 92),
(163, 'PW', 'PALAU', 'Palau', 'PLW', 585, 680),
(164, 'PS', 'PALESTINIAN TERRITORY, OCCUPIED', 'Palestinian Territory, Occupied', NULL, NULL, 970),
(165, 'PA', 'PANAMA', 'Panama', 'PAN', 591, 507),
(166, 'PG', 'PAPUA NEW GUINEA', 'Papua New Guinea', 'PNG', 598, 675),
(167, 'PY', 'PARAGUAY', 'Paraguay', 'PRY', 600, 595),
(168, 'PE', 'PERU', 'Peru', 'PER', 604, 51),
(169, 'PH', 'PHILIPPINES', 'Philippines', 'PHL', 608, 63),
(170, 'PN', 'PITCAIRN', 'Pitcairn', 'PCN', 612, 0),
(171, 'PL', 'POLAND', 'Poland', 'POL', 616, 48),
(172, 'PT', 'PORTUGAL', 'Portugal', 'PRT', 620, 351),
(173, 'PR', 'PUERTO RICO', 'Puerto Rico', 'PRI', 630, 1787),
(174, 'QA', 'QATAR', 'Qatar', 'QAT', 634, 974),
(175, 'RE', 'REUNION', 'Reunion', 'REU', 638, 262),
(176, 'RO', 'ROMANIA', 'Romania', 'ROM', 642, 40),
(177, 'RU', 'RUSSIAN FEDERATION', 'Russian Federation', 'RUS', 643, 70),
(178, 'RW', 'RWANDA', 'Rwanda', 'RWA', 646, 250),
(179, 'SH', 'SAINT HELENA', 'Saint Helena', 'SHN', 654, 290),
(180, 'KN', 'SAINT KITTS AND NEVIS', 'Saint Kitts and Nevis', 'KNA', 659, 1869),
(181, 'LC', 'SAINT LUCIA', 'Saint Lucia', 'LCA', 662, 1758),
(182, 'PM', 'SAINT PIERRE AND MIQUELON', 'Saint Pierre and Miquelon', 'SPM', 666, 508),
(183, 'VC', 'SAINT VINCENT AND THE GRENADINES', 'Saint Vincent and the Grenadines', 'VCT', 670, 1784),
(184, 'WS', 'SAMOA', 'Samoa', 'WSM', 882, 684),
(185, 'SM', 'SAN MARINO', 'San Marino', 'SMR', 674, 378),
(186, 'ST', 'SAO TOME AND PRINCIPE', 'Sao Tome and Principe', 'STP', 678, 239),
(187, 'SA', 'SAUDI ARABIA', 'Saudi Arabia', 'SAU', 682, 966),
(188, 'SN', 'SENEGAL', 'Senegal', 'SEN', 686, 221),
(189, 'CS', 'SERBIA AND MONTENEGRO', 'Serbia and Montenegro', NULL, NULL, 381),
(190, 'SC', 'SEYCHELLES', 'Seychelles', 'SYC', 690, 248),
(191, 'SL', 'SIERRA LEONE', 'Sierra Leone', 'SLE', 694, 232),
(192, 'SG', 'SINGAPORE', 'Singapore', 'SGP', 702, 65),
(193, 'SK', 'SLOVAKIA', 'Slovakia', 'SVK', 703, 421),
(194, 'SI', 'SLOVENIA', 'Slovenia', 'SVN', 705, 386),
(195, 'SB', 'SOLOMON ISLANDS', 'Solomon Islands', 'SLB', 90, 677),
(196, 'SO', 'SOMALIA', 'Somalia', 'SOM', 706, 252),
(197, 'ZA', 'SOUTH AFRICA', 'South Africa', 'ZAF', 710, 27),
(198, 'GS', 'SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS', 'South Georgia and the South Sandwich Islands', NULL, NULL, 0),
(199, 'ES', 'SPAIN', 'Spain', 'ESP', 724, 34),
(200, 'LK', 'SRI LANKA', 'Sri Lanka', 'LKA', 144, 94),
(201, 'SD', 'SUDAN', 'Sudan', 'SDN', 736, 249),
(202, 'SR', 'SURINAME', 'Suriname', 'SUR', 740, 597),
(203, 'SJ', 'SVALBARD AND JAN MAYEN', 'Svalbard and Jan Mayen', 'SJM', 744, 47),
(204, 'SZ', 'SWAZILAND', 'Swaziland', 'SWZ', 748, 268),
(205, 'SE', 'SWEDEN', 'Sweden', 'SWE', 752, 46),
(206, 'CH', 'SWITZERLAND', 'Switzerland', 'CHE', 756, 41),
(207, 'SY', 'SYRIAN ARAB REPUBLIC', 'Syrian Arab Republic', 'SYR', 760, 963),
(208, 'TW', 'TAIWAN, PROVINCE OF CHINA', 'Taiwan, Province of China', 'TWN', 158, 886),
(209, 'TJ', 'TAJIKISTAN', 'Tajikistan', 'TJK', 762, 992),
(210, 'TZ', 'TANZANIA, UNITED REPUBLIC OF', 'Tanzania, United Republic of', 'TZA', 834, 255),
(211, 'TH', 'THAILAND', 'Thailand', 'THA', 764, 66),
(212, 'TL', 'TIMOR-LESTE', 'Timor-Leste', NULL, NULL, 670),
(213, 'TG', 'TOGO', 'Togo', 'TGO', 768, 228),
(214, 'TK', 'TOKELAU', 'Tokelau', 'TKL', 772, 690),
(215, 'TO', 'TONGA', 'Tonga', 'TON', 776, 676),
(216, 'TT', 'TRINIDAD AND TOBAGO', 'Trinidad and Tobago', 'TTO', 780, 1868),
(217, 'TN', 'TUNISIA', 'Tunisia', 'TUN', 788, 216),
(218, 'TR', 'TURKEY', 'Turkey', 'TUR', 792, 90),
(219, 'TM', 'TURKMENISTAN', 'Turkmenistan', 'TKM', 795, 7370),
(220, 'TC', 'TURKS AND CAICOS ISLANDS', 'Turks and Caicos Islands', 'TCA', 796, 1649),
(221, 'TV', 'TUVALU', 'Tuvalu', 'TUV', 798, 688),
(222, 'UG', 'UGANDA', 'Uganda', 'UGA', 800, 256),
(223, 'UA', 'UKRAINE', 'Ukraine', 'UKR', 804, 380),
(224, 'AE', 'UNITED ARAB EMIRATES', 'United Arab Emirates', 'ARE', 784, 971),
(225, 'GB', 'UNITED KINGDOM', 'United Kingdom', 'GBR', 826, 44),
(226, 'US', 'UNITED STATES', 'United States', 'USA', 840, 1),
(227, 'UM', 'UNITED STATES MINOR OUTLYING ISLANDS', 'United States Minor Outlying Islands', NULL, NULL, 1),
(228, 'UY', 'URUGUAY', 'Uruguay', 'URY', 858, 598),
(229, 'UZ', 'UZBEKISTAN', 'Uzbekistan', 'UZB', 860, 998),
(230, 'VU', 'VANUATU', 'Vanuatu', 'VUT', 548, 678),
(231, 'VE', 'VENEZUELA', 'Venezuela', 'VEN', 862, 58),
(232, 'VN', 'VIET NAM', 'Viet Nam', 'VNM', 704, 84),
(233, 'VG', 'VIRGIN ISLANDS, BRITISH', 'Virgin Islands, British', 'VGB', 92, 1284),
(234, 'VI', 'VIRGIN ISLANDS, U.S.', 'Virgin Islands, U.s.', 'VIR', 850, 1340),
(235, 'WF', 'WALLIS AND FUTUNA', 'Wallis and Futuna', 'WLF', 876, 681),
(236, 'EH', 'WESTERN SAHARA', 'Western Sahara', 'ESH', 732, 212),
(237, 'YE', 'YEMEN', 'Yemen', 'YEM', 887, 967),
(238, 'ZM', 'ZAMBIA', 'Zambia', 'ZMB', 894, 260),
(239, 'ZW', 'ZIMBABWE', 'Zimbabwe', 'ZWE', 716, 263);

-- --------------------------------------------------------

--
-- Table structure for table `educations`
--

CREATE TABLE IF NOT EXISTS `educations` (
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
  KEY `fk_freelancer_edu_id` (`freelancer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `feedbacks`
--

CREATE TABLE IF NOT EXISTS `feedbacks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `freelancer_id` int(11) DEFAULT NULL,
  `job_offer_id` int(11) DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_freelancer_feedback_id` (`freelancer_id`),
  KEY `fk_joboffer_feedback_id` (`job_offer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `freelancers`
--

CREATE TABLE IF NOT EXISTS `freelancers` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `freelancers`
--

INSERT INTO `freelancers` (`id`, `first_name`, `last_name`, `agency_name`, `profile_title`, `freelancer_type`, `freelancer_price`, `publish_status`, `updated_at`, `created_at`, `email`, `years_of_experience`, `mobile`, `contact_widget`, `exam_widget`, `overview`, `my_video`, `contact_number`, `photos`, `deleted_at`, `address`, `division`, `address_area`, `address_city`, `address_zip`, `address_country`, `available`, `pbs_widget`, `certificate_widget`, `earning_widget`, `review_widget`, `edu_widget`) VALUES
(2, 'ii', 'ii', '', 'Expert Php', 'Individual', '30', 1, '2014-08-28', '2014-08-28', 'i2@i2.com', NULL, NULL, 1, 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', NULL, NULL, '1409737495_(2)_Facebook_-_2014-04-17_09.23.42.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 1, 1, 1),
(4, 'lkjlkj', 'lkjlkj', 'jdslkf lkj', 'lkjlkjlkj', 'Agency', '30', 1, '2014-09-04', '2014-08-31', 'i3@i3.com', NULL, '988987', 1, 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n', NULL, '98787987', '1411292878_1.png', NULL, 'lkjlkjlkj', NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 1, 1, 1),
(5, 'First Namesdf', 'Last Namesdf', 'w', 'Demo', 'Individual', '15', 1, '2014-09-22', '2014-08-31', 'i@i.com', 4, '0711478523', 1, 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', NULL, '01714112912', '1410933470_(2)_Facebook_-_2014-04-17_09.23.42.png', NULL, 'Address', 'Dhaka', 'gul', 'Dhaka', 1212, 'BANGLADESH', 1, 1, 1, 0, 1, 1),
(6, 'Tanvir', 'Anowar', 'c51 comp', 'Expert Wordpress', 'Agency', '30', 1, '2014-09-03', '2014-09-03', 'i4@i4.com', NULL, NULL, 1, 1, NULL, NULL, NULL, '1409736454_(2)_Facebook_-_2014-04-17_09.23.42.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 1, 1, 1),
(7, 'Individual', 'Individual', 'carbon51 ltd', 'Expert Zend 2', 'Agency', '30', 1, '2014-09-07', '2014-09-07', 'i5@i5.com', NULL, NULL, 1, 1, NULL, NULL, NULL, 'leader-1.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 1, 1, 1),
(8, 'Individual', 'Individual', '', 'Expert CakePhp', 'Individual', '20', 1, '2014-09-07', '2014-09-07', 'i6@i6.com', NULL, NULL, 1, 1, NULL, NULL, NULL, 'leader-2.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 1, 1, 1),
(9, 'a', 'j', NULL, 'agency', 'Agency', '25', 1, '2014-09-22', '2014-09-21', 'aj@aj.com', 4, '01254788', 1, 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', NULL, '', 'leader-6.png', NULL, 'Agency address', NULL, NULL, NULL, NULL, NULL, 1, 1, 1, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `freelancer_agency`
--

CREATE TABLE IF NOT EXISTS `freelancer_agency` (
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
  KEY `fk_freelancer_agency_owner_id` (`agency_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `groups_name_unique` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `permissions`, `created_at`, `updated_at`) VALUES
(2, 'Admin', '{"Admin":1}', '2014-08-25 02:38:10', '2014-08-25 02:38:10'),
(3, 'Individual', '{"Individual":1}', '2014-08-25 02:38:23', '2014-08-25 02:38:23'),
(4, 'Client', '{"Client":1}', '2014-08-25 02:38:32', '2014-08-25 02:38:32'),
(5, 'Agency', '{"Agency":1}', '2014-09-07 04:03:02', '2014-09-07 04:03:02');

-- --------------------------------------------------------

--
-- Table structure for table `job_categories`
--

CREATE TABLE IF NOT EXISTS `job_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) DEFAULT NULL,
  `description` varchar(300) DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `created_at` date NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `display` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `job_categories`
--

INSERT INTO `job_categories` (`id`, `title`, `description`, `updated_at`, `created_at`, `deleted_at`, `display`) VALUES
(1, 'Web Design', 'Lorem Ipsum is simply dummy text of the printingry.', '2014-09-18', '2014-09-09', NULL, 1),
(2, 'Web Programing', 'Lorem Ipsum is simply dummy text of the printingry.', '2014-09-09', '2014-09-09', NULL, 1),
(3, 'Graphics Design', 'Lorem Ipsum is simply dummy text of the printingry.', '2014-09-09', '2014-09-09', NULL, 1),
(4, 'Mobile Apps', 'Lorem Ipsum is simply dummy text of the printingry.', '2014-09-09', '2014-09-09', NULL, 1),
(5, 'Ecommerce', 'Lorem Ipsum is simply dummy text of the printingry.', '2014-09-09', '2014-09-09', NULL, 1),
(6, 'SEO-Search Engine Optimization', 'Lorem Ipsum is simply dummy text of the printingry.', '2014-09-18', '2014-09-18', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `job_offers`
--

CREATE TABLE IF NOT EXISTS `job_offers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `freelancer_id` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `job_post_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `job_offer_status` enum('Pending','Apporve','Cancel','Accepte','Decline') DEFAULT NULL COMMENT 'Admin get Pending Job offer list\nAdmin can Approve or Cancel\nFreelancer can Accept or Decline',
  `job_offer_status_reason` varchar(255) DEFAULT NULL COMMENT 'only use when Decline a job offer',
  `job_offer_price` varchar(45) DEFAULT NULL,
  `job_offer_hour` varchar(50) DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_freelancer_joboffer_id` (`freelancer_id`),
  KEY `fk_joboffer_jobpost_id` (`job_post_id`),
  KEY `fk_job_offer_client_id` (`client_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `job_offers`
--

INSERT INTO `job_offers` (`id`, `freelancer_id`, `client_id`, `job_post_id`, `title`, `description`, `job_offer_status`, `job_offer_status_reason`, `job_offer_price`, `job_offer_hour`, `updated_at`, `created_at`, `deleted_at`) VALUES
(1, 7, 2, 19, 'wewe www', 'ewe wew ewe we wewe we', 'Pending', 'Client request you to accept his/her job offer', '600', '6', '2014-09-30', '2014-09-30', NULL),
(5, 6, 2, 19, 'Expert Python developer needed', 'fet t rtrt rtr', 'Pending', 'Client request you to accept his/her job offer', '300', '10', '2014-09-30', '2014-09-30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `job_phases`
--

CREATE TABLE IF NOT EXISTS `job_phases` (
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
  KEY `fk_joboffer_jobphase_id` (`job_offer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `job_phases`
--

INSERT INTO `job_phases` (`id`, `job_offer_id`, `phase_title`, `phase_price`, `phase_hour`, `phase_payment_status`, `phase_deadline`, `phase_details`, `updated_at`, `created_at`, `deleted_at`) VALUES
(1, 1, 'dfddfd', '120', '4', 'Pending', '2014-10-02', 'gd wgw wur wrwr wiiw wrwirh', '2014-09-30', '2014-09-30', NULL),
(2, 1, 'dfddfd', '120', '4', 'Pending', '2014-10-03', 'ade assrsf sfs fs', '2014-09-30', '2014-09-30', NULL),
(3, 5, 'dfddfd', '120', '4', 'Pending', '2014-10-03', 'dfnd kfdjod odgod', '2014-09-30', '2014-09-30', NULL),
(4, 1, 'sdfd fd f', '120', '4', 'Pending', '2014-09-01', 'dg dgd gd', '2014-09-30', '2014-09-30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `job_posts`
--

CREATE TABLE IF NOT EXISTS `job_posts` (
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
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_jobpost_client_id` (`client_id`),
  KEY `fk_jobcategory_jobpost_id` (`job_category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `job_posts`
--

INSERT INTO `job_posts` (`id`, `client_id`, `job_category_id`, `updated_at`, `created_at`, `title`, `description`, `attach_file`, `amount`, `job_status`, `deleted_at`) VALUES
(1, 2, 2, '2014-09-24', '2014-09-20', 'PhpDeveloper need', 'We need 4 PHP Deveopers', '{}', 500, 'Pending', NULL),
(2, 2, 2, '2014-09-20', '2014-09-20', 'Asp.net', 'Looking for dot net developers for long term', '{}', 700, 'Pending', NULL),
(3, 2, 1, '2014-09-27', '2014-09-21', 'HTML5/CSS expert', 'We need 2 Web designer', '{}', 1000, 'Approved', NULL),
(4, 2, 3, '2014-09-24', '2014-09-20', 'Photoshop Expert', 'Anyone who have 2 years of experience for working with photoshop', '{}', 300, 'Pending', NULL),
(5, 2, 1, '2014-09-24', '2014-09-19', 'Photoshop Expert2', 'Anyone who have 2 years of experience for workin', '{}', 200, 'Pending', NULL),
(11, 2, 1, '2014-09-24', '2014-09-19', 'Photoshop Expert3', 'fsdfsfsd', '{}', 500, 'Pending', NULL),
(12, 2, 1, '2014-09-19', '2014-09-19', 'Photoshop Expert4', 'fsdfd', '{}', 600, 'Pending', NULL),
(13, 2, 1, '2014-09-19', '2014-09-19', 'Photoshop Expert5', 'fsdfd', '{}', 750, 'Pending', NULL),
(14, 2, 1, '2014-09-19', '2014-09-19', 'Photoshop Expert6', 'sfsdf', '{}', 1500, 'Pending', NULL),
(15, 2, 1, '2014-09-19', '2014-09-19', 'Photoshop Expert7', 'fsdfd', '{}', 2000, 'Pending', NULL),
(16, 2, 1, '2014-09-19', '2014-09-19', 'Photoshop Expert9', 'sfsfsd', '{}', 4000, 'Pending', NULL),
(17, 2, 2, '2014-09-27', '2014-09-24', 'Test Job Title', 'it all depends on what the criteria for your amount is... does it have to be in a certain range? does it have a max, min? does it have to be a certain number of digits? does it have to be one of a specific set of values? There are built in rules for all o', '{}', 3500, 'Approved', NULL),
(18, 2, 2, '2014-09-27', '2014-09-25', 'Expert WordPress and PHP Developer', 'wjew wewe wwhwwurwuwurdbsds  sss hfshfsjhf wjew wewe wwhwwurwuwurdbsds  sss hfshfsjhf\n\nwjew wewe wwhwwurwuwurdbsds  sss hfshfsjhf wjew wewe wwhwwurwuwurdbsds  sss hfshfsjhf wjew wewe wwhw wurw uwurdbsds  sss hfshfsjhf\n\nwjew wewe wwhwwurwuwurdbsds  sss hfs', '{}', 1650, 'Approved', NULL),
(19, 2, 2, '2014-09-29', '2014-09-29', 'Expert Python developer needed', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.\n\n It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '{}', 1500, 'Pending', NULL),
(20, 2, 2, '2014-09-29', '2014-09-29', 'Expert Python developer needed', 'Yes, you can. However, this is strongly discouraged. SCE gives you a lot of security benefits for little coding overhead. It will be much harder to take an SCE disabled application and either secure it on your own or enable SCE at a later stage. It might make sense to disable SCE for cases where you have a lot of existing code that was written before SCE was introduced and you''re migrating them a module at a time.\n\nYes, you can. However, this is strongly discouraged. SCE gives you a lot of security benefits for little coding overhead. It will be much harder to take an SCE disabled application and either secure it on your own or enable SCE at a later stage. It might make sense to disable SCE for cases where you have a lot of existing code that was written before SCE was introduced and you''re migrating them a module at a time.', '{}', 1500, 'Pending', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `job_prices`
--

CREATE TABLE IF NOT EXISTS `job_prices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `created_at` date NOT NULL,
  `display` tinyint(1) NOT NULL DEFAULT '1',
  `deleted_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `job_prices`
--

INSERT INTO `job_prices` (`id`, `title`, `updated_at`, `created_at`, `display`, `deleted_at`) VALUES
(9, '30', '2014-09-14', '2014-09-14', 1, NULL),
(10, '25', '2014-09-14', '2014-09-14', 1, NULL),
(11, '20', '2014-09-14', '2014-09-14', 1, NULL),
(12, '15', '2014-09-14', '2014-09-14', 1, NULL),
(13, '10', '2014-09-14', '2014-09-14', 1, NULL),
(14, '5', '2014-09-14', '2014-09-14', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `job_requests`
--

CREATE TABLE IF NOT EXISTS `job_requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `job_id` int(11) DEFAULT NULL,
  `freelancer_id` int(11) DEFAULT NULL,
  `request_status` enum('Pending','Accepted','Decline') DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_jobrequested_jobpost_id` (`job_id`),
  KEY `fk_jobrequested_freelancer_id` (`freelancer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `job_requests`
--

INSERT INTO `job_requests` (`id`, `job_id`, `freelancer_id`, `request_status`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'Pending', '2014-09-25', NULL),
(2, 1, 4, 'Pending', '2014-09-25', NULL),
(3, 1, 5, 'Pending', '2014-09-25', NULL),
(4, 2, 7, 'Pending', '2014-09-25', NULL),
(5, 2, 8, 'Pending', '2014-09-25', NULL),
(6, 2, 9, 'Pending', '2014-09-25', NULL),
(7, 3, 2, 'Pending', '2014-09-25', NULL),
(8, 3, 5, 'Pending', '2014-09-25', NULL),
(9, 3, 6, 'Pending', '2014-09-25', NULL),
(10, 3, 8, 'Pending', '2014-09-25', NULL),
(11, 3, 9, 'Pending', '2014-09-25', NULL),
(12, 17, 2, 'Pending', '2014-09-25', NULL),
(13, 17, 4, 'Pending', '2014-09-25', NULL),
(14, 17, 5, 'Pending', '2014-09-25', NULL),
(15, 17, 6, 'Pending', '2014-09-25', NULL),
(16, 17, 7, 'Pending', '2014-09-25', NULL),
(17, 18, 2, 'Pending', '2014-09-25', '2014-09-25'),
(18, 18, 4, 'Pending', '2014-09-25', '2014-09-25'),
(19, 18, 5, 'Pending', '2014-09-25', '2014-09-25'),
(20, 18, 9, 'Pending', '2014-09-25', '2014-09-25'),
(21, 19, 7, 'Pending', '2014-09-29', '2014-09-29'),
(22, 19, 6, 'Pending', '2014-09-29', '2014-09-29'),
(23, 19, 2, 'Pending', '2014-09-29', '2014-09-29'),
(24, 20, 9, 'Pending', '2014-09-29', '2014-09-29'),
(25, 20, 8, 'Pending', '2014-09-29', '2014-09-29'),
(26, 20, 4, 'Pending', '2014-09-29', '2014-09-29');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `receiver_id`, `subject`, `message`, `read_status`, `receiver_type`, `updated_at`, `created_at`, `url`, `notification_type`, `object_id`) VALUES
(16, 5, 'Agency Team invitation', 'You get an team invitation from agency <b>a j</b> <br/> Visit agency profile link <a target="_blank" href="http://freelancer.marketplace/view/freelancer/wTR1TP">http://freelancer.marketplace/view/freelancer/wTR1TP</a>', 0, 'Freelancer', '2014-09-28', '2014-09-28', 'team-invitation', 'Team Invitation', 'QTqFVP'),
(17, 9, 'Member Joined', '<strong>First Namesdf Last Namesdf joined to your agency</strong>', 0, 'Freelancer', '2014-09-28', '2014-09-28', 'team-invitation', 'Team Invitation', 'QTqFVP');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE IF NOT EXISTS `payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `job_phase_id` int(11) DEFAULT NULL,
  `amount` varchar(45) DEFAULT NULL,
  `release_dt` date DEFAULT NULL,
  `paid_dt` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_payment_jobphase_id` (`job_phase_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `portfolios`
--

CREATE TABLE IF NOT EXISTS `portfolios` (
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
  KEY `fk_freelancer_portfolio_id` (`freelancer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `professional_backgrounds`
--

CREATE TABLE IF NOT EXISTS `professional_backgrounds` (
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
  KEY `fk_professional_freelancer_id` (`freelancer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `question_bank`
--

CREATE TABLE IF NOT EXISTS `question_bank` (
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
  KEY `fk_questionbank_questionlevel_id` (`level_id`),
  KEY `fk_questionbank_questiongroup_id` (`group_id`),
  KEY `skill_id` (`skill_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `question_bank`
--

INSERT INTO `question_bank` (`id`, `question`, `question_type`, `level_id`, `group_id`, `skill_id`, `answers`, `answer_time`, `updated_at`, `created_at`) VALUES
(5, 'PHP server scripts are surrounded by delimiters, which?', 'Radio', 1, 1, 1, '[{"answer":"&lt;?php echo ''hi''; ?&gt;","correct":"1"},{"answer":"&lt;?php&gt;...&lt;\\/?&gt;","correct":0},{"answer":"&lt;&amp;&gt;...&lt;\\/&amp;&gt;","correct":0},{"answer":"&lt;script&gt;...&lt;\\/script&gt;s","correct":0}]', '00:01:00', '2014-09-11', '2014-08-25'),
(6, 'How do you write "Hello World" in PHP', 'Radio', 1, 1, 1, '[{"answer":"echo \\"Hello World\\";","correct":1},{"answer":"\\"Hello World\\";","correct":0},{"answer":"Document.Write(\\"Hello World\\");","correct":0}]', '00:01:00', '2014-09-09', '2014-08-25'),
(7, 'All variables in PHP start with which symbol?', 'Radio', 1, 1, 1, '[{"answer":"!","correct":0},{"answer":"$","correct":"1"},{"answer":"&","correct":0}]', '00:01:00', '2014-09-09', '2014-08-25'),
(8, 'The PHP syntax is most similar to:', 'Radio', 1, 1, 1, '[{"answer":"Perl and C","correct":"1"},{"answer":"VBScript","correct":0},{"answer":"JavaScript","correct":0}]', '00:01:00', '2014-09-09', '2014-08-25'),
(9, 'How do you get information from a form that is submitted using the "get" method?', 'Radio', 1, 1, 1, '[{"answer":"Request.QueryString;","correct":0},{"answer":"Request.Form;","correct":0},{"answer":"$_GET[];","correct":"1"}]', '00:01:00', '2014-09-09', '2014-08-25'),
(10, 'When using the POST method, variables are displayed in the URL:', 'Radio', 1, 1, 1, '[{"answer":"true","correct":0},{"answer":"false","correct":"1"}]', '00:01:00', '2014-09-09', '2014-08-25'),
(12, 'What is the correct way to create a function in PHP?', 'Radio', 4, 1, 1, '[{"answer":"create myFunction()","correct":0},{"answer":"new_function myFunction()","correct":0},{"answer":"function myFunction()","correct":"1"}]', '00:01:00', '2014-09-09', '2014-08-25'),
(13, 'What is the correct way to open the file "time.txt" as readable?', 'Radio', 4, 5, 1, '[{"answer":"open(\\"time.txt\\");","correct":0},{"answer":"fopen(\\"time.txt\\",\\"r\\");","correct":"1"},{"answer":"open(\\"time.txt\\",\\"read\\");","correct":0},{"answer":"fopen(\\"time.txt\\",\\"r+\\");","correct":0}]', '00:01:00', '2014-09-09', '2014-08-25'),
(14, 'PHP allows you to send emails directly from a script', 'Radio', 4, 5, 1, '[{"answer":"False","correct":0},{"answer":"True","correct":"1"}]', '00:01:00', '2014-09-09', '2014-08-25'),
(15, 'What is the correct way to connect to a MySQL database?', 'Radio', 4, 1, 1, '[{"answer":"mysqli_connect(host,username,password,dbname);","correct":"1"},{"answer":"mysqli_db(host,username,password,dbname);","correct":0},{"answer":"mysqli_open(host,username,password,dbname);","correct":0}]', '00:01:00', '2014-09-09', '2014-08-25'),
(16, 'What is the correct way to add 1 to the $count variable?', 'Radio', 1, 1, 1, '[{"answer":"count++;","correct":0},{"answer":"++count","correct":0},{"answer":"$count =+1","correct":"1"},{"answer":"$count++;","correct":"1"}]', '00:01:00', '2014-09-09', '2014-08-25'),
(17, 'What is a correct way to add a comment in PHP?', 'Radio', 1, 1, 1, '[{"answer":"<!--\\ufffd-->","correct":0},{"answer":"\\/*\\ufffd*\\/","correct":"1"},{"answer":"*\\\\..\\\\*","correct":0},{"answer":"<comment>\\ufffd<\\/comment>","correct":0}]', '00:01:00', '2014-09-09', '2014-08-25'),
(18, 'PHP can be run on Microsoft Windows IIS(Internet Information Server):', 'Radio', 6, 5, 1, '[{"answer":"True","correct":"1"},{"answer":"False","correct":0}]', '00:01:00', '2014-09-09', '2014-08-25'),
(19, 'Possible way of reading file in php', 'Checkbox', 6, 4, 1, '[{"answer":"fopen(''filename.txt'')","correct":true},{"answer":"file_get_contents(''filename.txt'')","correct":true},{"answer":"file_open(''filename.txt'')","correct":0},{"answer":"getFile(''filename.txt'')","correct":0}]', '00:01:00', '2014-09-14', '2014-09-14'),
(20, 'What is the output of strrev(strtolower(trim(''Never odd or even'')))', 'Textbox', 6, 2, 1, '[{"answer":"neveroddoreven","correct":1}]', '00:02:00', '2014-09-14', '2014-09-14');

-- --------------------------------------------------------

--
-- Table structure for table `question_group`
--

CREATE TABLE IF NOT EXISTS `question_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) DEFAULT NULL,
  `updated_at` date NOT NULL,
  `created_at` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `question_group`
--

INSERT INTO `question_group` (`id`, `title`, `updated_at`, `created_at`) VALUES
(1, 'Introduction', '0000-00-00', '0000-00-00'),
(2, 'String Operation', '2014-08-25', '2014-08-25'),
(3, 'Array Manipulation', '2014-08-25', '2014-08-25'),
(4, 'File Operation', '2014-08-25', '2014-08-25'),
(5, 'I/O Operation', '2014-08-25', '2014-08-25'),
(6, 'Structure', '2014-08-25', '2014-08-25'),
(7, 'Data Modeling', '2014-08-25', '2014-08-25');

-- --------------------------------------------------------

--
-- Table structure for table `question_level`
--

CREATE TABLE IF NOT EXISTS `question_level` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) DEFAULT NULL,
  `updated_at` date NOT NULL,
  `created_at` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `question_level`
--

INSERT INTO `question_level` (`id`, `title`, `updated_at`, `created_at`) VALUES
(1, 'Beginner', '0000-00-00', '0000-00-00'),
(4, 'Intermediate', '2014-08-25', '2014-08-25'),
(6, 'Expert', '2014-08-25', '2014-08-25');

-- --------------------------------------------------------

--
-- Table structure for table `question_set`
--

CREATE TABLE IF NOT EXISTS `question_set` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `skill_id` int(11) DEFAULT NULL,
  `title` varchar(45) NOT NULL,
  `question_rule` varchar(2000) DEFAULT NULL,
  `test_time` varchar(100) NOT NULL,
  `updated_at` date DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `question_set`
--

INSERT INTO `question_set` (`id`, `skill_id`, `title`, `question_rule`, `test_time`, `updated_at`, `created_at`) VALUES
(4, 1, 'Qset 1', '[{"group_id":1,"questions":[{"level_id":1,"q_no":"8"}]},{"group_id":"5","questions":[{"level_id":"4","q_no":"2"}]}]', '10', '2014-09-09', '2014-09-09'),
(5, 1, 'Qset 2', '[{"group_id":"5","questions":[{"level_id":"4","q_no":"2"}]}]', '20', '2014-09-09', '2014-09-09'),
(6, 1, 'Qset 3', '[{"group_id":1,"questions":[{"level_id":1,"q_no":"8"}]}]', '4', '2014-09-09', '2014-09-09'),
(7, 1, 'Qset 4', '[{"group_id":1,"questions":[{"level_id":1,"q_no":"2"}]},{"group_id":"4","questions":[{"level_id":"6","q_no":1}]},{"group_id":"2","questions":[{"level_id":"6","q_no":1}]}]', '5', '2014-09-14', '2014-09-14');

-- --------------------------------------------------------

--
-- Table structure for table `related_tags`
--

CREATE TABLE IF NOT EXISTS `related_tags` (
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
  `retake_date` varchar(100) DEFAULT NULL,
  `test_percentage` varchar(20) DEFAULT NULL,
  `score` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_freelancercategory_category_id` (`skill_tags_id`),
  KEY `fk_freelancer_related_id` (`relatedentity_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `related_tags`
--

INSERT INTO `related_tags` (`id`, `relatedentity_id`, `relatedentity_type`, `skill_tags_id`, `updated_at`, `created_at`, `deleted_at`, `display`, `test_taken`, `test_start_at`, `test_end_at`, `test_data`, `last_question_index`, `test_result`, `last_question_set`, `retake_date`, `test_percentage`, `score`) VALUES
(4, 5, 'Freelancer', 5, '2014-09-23', '2014-09-18', NULL, 1, 0, '', '', '', NULL, '', 0, NULL, NULL, NULL),
(5, 1, 'JobPost', 1, '2014-09-20', '2014-09-18', NULL, 1, 0, '', '', '', NULL, '', 0, NULL, NULL, NULL),
(6, 2, 'JobPost', 6, '2014-09-20', '2014-09-20', NULL, 1, 0, '', '', '', NULL, '', 0, NULL, NULL, NULL),
(7, 3, 'JobPost', 2, '2014-09-20', '2014-09-20', NULL, 1, 0, '', '', '', NULL, '', 0, NULL, NULL, NULL),
(8, 3, 'JobPost', 3, '2014-09-20', '2014-09-20', NULL, 1, 0, '', '', '', NULL, '', 0, NULL, NULL, NULL),
(9, 4, 'JobPost', 9, '2014-09-20', '2014-09-20', NULL, 1, 0, '', '', '', NULL, '', 0, NULL, NULL, NULL),
(10, 9, 'Freelancer', 1, '2014-09-21', '2014-09-21', NULL, 1, 0, '', '', '', NULL, '', 0, NULL, NULL, NULL),
(11, 5, 'Freelancer', 1, '2014-09-24', '2014-09-24', NULL, 1, 1, '1411555799', '1411555826', '[{"id":6,"question":"How do you write \\"Hello World\\" in PHP","question_type":"Radio","level_id":1,"group_id":1,"skill_id":1,"answers":"[{\\"answer\\":\\"echo \\\\\\"Hello World\\\\\\";\\",\\"correct\\":1},{\\"answer\\":\\"\\\\\\"Hello World\\\\\\";\\",\\"correct\\":0},{\\"answer\\":\\"Document.Write(\\\\\\"Hello World\\\\\\");\\",\\"correct\\":0}]","answer_time":"00:01:00","updated_at":"2014-09-09 00:00:00","created_at":"2014-08-25 00:00:00"},{"id":5,"question":"PHP server scripts are surrounded by delimiters, which?","question_type":"Radio","level_id":1,"group_id":1,"skill_id":1,"answers":"[{\\"answer\\":\\"&lt;?php echo ''hi''; ?&gt;\\",\\"correct\\":\\"1\\"},{\\"answer\\":\\"&lt;?php&gt;...&lt;\\\\\\/?&gt;\\",\\"correct\\":0},{\\"answer\\":\\"&lt;&amp;&gt;...&lt;\\\\\\/&amp;&gt;\\",\\"correct\\":0},{\\"answer\\":\\"&lt;script&gt;...&lt;\\\\\\/script&gt;s\\",\\"correct\\":0}]","answer_time":"00:01:00","updated_at":"2014-09-11 00:00:00","created_at":"2014-08-25 00:00:00"},{"id":19,"question":"Possible way of reading file in php","question_type":"Checkbox","level_id":6,"group_id":4,"skill_id":1,"answers":"[{\\"answer\\":\\"fopen(''filename.txt'')\\",\\"correct\\":true},{\\"answer\\":\\"file_get_contents(''filename.txt'')\\",\\"correct\\":true},{\\"answer\\":\\"file_open(''filename.txt'')\\",\\"correct\\":0},{\\"answer\\":\\"getFile(''filename.txt'')\\",\\"correct\\":0}]","answer_time":"00:01:00","updated_at":"2014-09-14 00:00:00","created_at":"2014-09-14 00:00:00"},{"id":20,"question":"What is the output of strrev(strtolower(trim(''Never odd or even'')))","question_type":"Textbox","level_id":6,"group_id":2,"skill_id":1,"answers":"[{\\"answer\\":\\"neveroddoreven\\",\\"correct\\":1}]","answer_time":"00:02:00","updated_at":"2014-09-14 00:00:00","created_at":"2014-09-14 00:00:00"}]', 4, '[{"id":6,"question":"How do you write \\"Hello World\\" in PHP","question_type":"Radio","level_id":1,"group_id":1,"skill_id":1,"answers":"[{\\"answer\\":\\"echo \\\\\\"Hello World\\\\\\";\\",\\"correct\\":1},{\\"answer\\":\\"\\\\\\"Hello World\\\\\\";\\",\\"correct\\":0},{\\"answer\\":\\"Document.Write(\\\\\\"Hello World\\\\\\");\\",\\"correct\\":0}]","answer_time":"00:01:00","updated_at":"2014-09-09 00:00:00","created_at":"2014-08-25 00:00:00","selected_answer":"0"},{"id":5,"question":"PHP server scripts are surrounded by delimiters, which?","question_type":"Radio","level_id":1,"group_id":1,"skill_id":1,"answers":"[{\\"answer\\":\\"&lt;?php echo ''hi''; ?&gt;\\",\\"correct\\":\\"1\\"},{\\"answer\\":\\"&lt;?php&gt;...&lt;\\\\\\/?&gt;\\",\\"correct\\":0},{\\"answer\\":\\"&lt;&amp;&gt;...&lt;\\\\\\/&amp;&gt;\\",\\"correct\\":0},{\\"answer\\":\\"&lt;script&gt;...&lt;\\\\\\/script&gt;s\\",\\"correct\\":0}]","answer_time":"00:01:00","updated_at":"2014-09-11 00:00:00","created_at":"2014-08-25 00:00:00","selected_answer":"0"},{"id":19,"question":"Possible way of reading file in php","question_type":"Checkbox","level_id":6,"group_id":4,"skill_id":1,"answers":"[{\\"answer\\":\\"fopen(''filename.txt'')\\",\\"correct\\":true},{\\"answer\\":\\"file_get_contents(''filename.txt'')\\",\\"correct\\":true},{\\"answer\\":\\"file_open(''filename.txt'')\\",\\"correct\\":0},{\\"answer\\":\\"getFile(''filename.txt'')\\",\\"correct\\":0}]","answer_time":"00:01:00","updated_at":"2014-09-14 00:00:00","created_at":"2014-09-14 00:00:00","selected_answer":"[\\"0\\"]"},{"id":20,"question":"What is the output of strrev(strtolower(trim(''Never odd or even'')))","question_type":"Textbox","level_id":6,"group_id":2,"skill_id":1,"answers":"[{\\"answer\\":\\"neveroddoreven\\",\\"correct\\":1}]","answer_time":"00:02:00","updated_at":"2014-09-14 00:00:00","created_at":"2014-09-14 00:00:00","selected_answer":"sdasdasdas"}]', 7, '1414147826', '33', '2'),
(12, 19, 'JobPost', 6, '2014-09-29', '2014-09-29', NULL, 1, 0, '', '', '', NULL, '', 0, NULL, NULL, NULL),
(13, 2, 'Freelancer', 1, '2014-09-29', '2014-09-29', NULL, 1, 0, '', '', '', NULL, '', 0, NULL, NULL, NULL),
(14, 2, 'Freelancer', 9, '2014-09-29', '2014-09-29', NULL, 1, 0, '', '', '', NULL, '', 0, NULL, NULL, NULL),
(15, 2, 'Freelancer', 2, '2014-09-29', '2014-09-29', NULL, 1, 0, '', '', '', NULL, '', 0, NULL, NULL, NULL),
(16, 4, 'Freelancer', 7, '2014-09-29', '2014-09-29', NULL, 1, 0, '', '', '', NULL, '', 0, NULL, NULL, NULL),
(17, 4, 'Freelancer', 4, '2014-09-29', '2014-09-29', NULL, 1, 0, '', '', '', NULL, '', 0, NULL, NULL, NULL),
(18, 4, 'Freelancer', 6, '2014-09-29', '2014-09-29', NULL, 1, 0, '', '', '', NULL, '', 0, NULL, NULL, NULL),
(19, 6, 'Freelancer', 1, '2014-09-29', '2014-09-29', NULL, 1, 0, '', '', '', NULL, '', 0, NULL, NULL, NULL),
(20, 6, 'Freelancer', 2, '2014-09-29', '2014-09-29', NULL, 1, 0, '', '', '', NULL, '', 0, NULL, NULL, NULL),
(21, 6, 'Freelancer', 4, '2014-09-29', '2014-09-29', NULL, 1, 0, '', '', '', NULL, '', 0, NULL, NULL, NULL),
(22, 7, 'Freelancer', 1, '2014-09-29', '2014-09-29', NULL, 1, 0, '', '', '', NULL, '', 0, NULL, NULL, NULL),
(23, 7, 'Freelancer', 2, '2014-09-29', '2014-09-29', NULL, 1, 0, '', '', '', NULL, '', 0, NULL, NULL, NULL),
(24, 8, 'Freelancer', 9, '2014-09-29', '2014-09-29', NULL, 1, 0, '', '', '', NULL, '', 0, NULL, NULL, NULL),
(25, 20, 'JobPost', 1, '2014-09-29', '2014-09-29', NULL, 1, 0, '', '', '', NULL, '', 0, NULL, NULL, NULL),
(26, 20, 'JobPost', 9, '2014-09-29', '2014-09-29', NULL, 1, 0, '', '', '', NULL, '', 0, NULL, NULL, NULL),
(27, 20, 'JobPost', 7, '2014-09-29', '2014-09-29', NULL, 1, 0, '', '', '', NULL, '', 0, NULL, NULL, NULL),
(28, 20, 'JobPost', 4, '2014-09-29', '2014-09-29', NULL, 1, 0, '', '', '', NULL, '', 0, NULL, NULL, NULL),
(29, 20, 'JobPost', 6, '2014-09-29', '2014-09-29', NULL, 1, 0, '', '', '', NULL, '', 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `skill_tags`
--

CREATE TABLE IF NOT EXISTS `skill_tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(45) DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `display` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `skill_tags`
--

INSERT INTO `skill_tags` (`id`, `category_name`, `updated_at`, `created_at`, `deleted_at`, `display`) VALUES
(1, 'PHP', '2014-09-09', '2014-09-09', NULL, 1),
(2, 'HTML 5', '2014-09-09', '2014-09-09', NULL, 1),
(3, 'CSS', '2014-09-09', '2014-09-09', NULL, 1),
(4, 'CSS 3', '2014-09-09', '2014-09-09', NULL, 1),
(5, 'Java', '2014-09-09', '2014-09-09', NULL, 1),
(6, 'C#', '2014-09-09', '2014-09-09', NULL, 1),
(7, 'C++', '2014-09-09', '2014-09-09', NULL, 1),
(8, 'Asp.Net', '2014-09-09', '2014-09-09', NULL, 1),
(9, 'Photoshop', '2014-09-09', '2014-09-09', NULL, 1),
(10, 'Illustrator', '2014-09-09', '2014-09-09', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `slips`
--

CREATE TABLE IF NOT EXISTS `slips` (
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
  KEY `fk_slip_joboffer_id` (`job_offer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `test_taken`
--

CREATE TABLE IF NOT EXISTS `test_taken` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `participent_id` int(11) DEFAULT NULL,
  `answer` varchar(3000) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_test_participent_id` (`participent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `throttle`
--

CREATE TABLE IF NOT EXISTS `throttle` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=25 ;

--
-- Dumping data for table `throttle`
--

INSERT INTO `throttle` (`id`, `user_id`, `ip_address`, `attempts`, `suspended`, `banned`, `last_attempt_at`, `suspended_at`, `banned_at`) VALUES
(1, 1, '::1', 0, 0, 0, NULL, NULL, NULL),
(2, 2, '::1', 0, 0, 0, '2014-08-24 02:18:59', NULL, NULL),
(3, 10, '::1', 0, 0, 0, NULL, NULL, NULL),
(4, 11, '::1', 0, 0, 0, NULL, NULL, NULL),
(5, 21, '::1', 0, 0, 0, NULL, NULL, NULL),
(6, 22, '::1', 0, 0, 1, NULL, NULL, '2014-09-02 03:37:47'),
(7, 22, '127.0.0.1', 0, 0, 0, NULL, NULL, NULL),
(8, 21, '127.0.0.1', 0, 0, 0, NULL, NULL, NULL),
(9, 2, '127.0.0.1', 0, 0, 0, NULL, NULL, NULL),
(10, 48, '127.0.0.1', 0, 0, 1, NULL, NULL, '2014-09-02 03:38:00'),
(11, 47, NULL, 0, 0, 1, NULL, NULL, '2014-09-02 03:37:25'),
(12, 45, NULL, 0, 0, 1, NULL, NULL, '2014-09-02 03:37:58'),
(13, 32, '127.0.0.1', 0, 0, 0, NULL, NULL, NULL),
(14, 49, '127.0.0.1', 0, 0, 0, NULL, NULL, NULL),
(15, 64, '127.0.0.1', 0, 0, 0, NULL, NULL, NULL),
(16, 66, '127.0.0.1', 0, 0, 0, NULL, NULL, NULL),
(17, 65, '127.0.0.1', 0, 0, 0, NULL, NULL, NULL),
(18, 2, '192.168.1.13', 0, 0, 0, NULL, NULL, NULL),
(19, 66, '192.168.1.13', 0, 0, 0, NULL, NULL, NULL),
(20, 67, '127.0.0.1', 0, 0, 0, NULL, NULL, NULL),
(21, 68, '127.0.0.1', 0, 0, 0, NULL, NULL, NULL),
(22, 69, '127.0.0.1', 0, 0, 0, NULL, NULL, NULL),
(23, 70, '127.0.0.1', 0, 0, 0, NULL, NULL, NULL),
(24, 71, '127.0.0.1', 0, 0, 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
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
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_activation_code_index` (`activation_code`),
  KEY `users_reset_password_code_index` (`reset_password_code`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=72 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `permissions`, `activated`, `activation_code`, `activated_at`, `last_login`, `persist_code`, `reset_password_code`, `first_name`, `last_name`, `created_at`, `updated_at`, `user_id`, `user_type`, `is_agent`) VALUES
(2, 'a@a.com', '$2y$10$S3P8DPQaTUqYzOZXY4DB3OUSEOYWHL3./yhEPOi.wmh3t4YsoW.WW', NULL, 1, NULL, NULL, '2014-09-26 21:36:54', '$2y$10$H2wyuaAPxu5J3JkJjasu/Od8EhgiVGVEwpj5pKbrGa78eF.p6hwwC', NULL, 'Admin', 'Admin', '2014-08-23 01:15:23', '2014-09-26 21:36:54', NULL, 'Admin', NULL),
(64, 'c@c.com', '$2y$10$9n2ZBqBbsFBtm8xC1/cabObiSYoFXHd/fCLIXdeqQRgyrDiRCsV1u', NULL, 1, NULL, '2014-09-06 22:48:45', '2014-09-30 01:12:48', '$2y$10$Nalw65Q1ytXzWZmZVEl.8OPNKwu56TmkP5q9kkPLil2SYhogl6OaK', NULL, 'Client', 'Client', '2014-09-06 22:48:21', '2014-09-30 01:12:48', 2, 'Client', NULL),
(65, 'aj@aj.com', '$2y$10$vrmQqWrEBvQ9Dsda/6sKaOoGLpA.l3Yl5BSzTZcH5GrNtVZSPgZXy', NULL, 1, NULL, '2014-09-06 22:52:59', '2014-09-29 04:14:18', '$2y$10$hTo236wClmldu8Yc55ZInOOR/DkjmR3W4VUWO1YXq99HGpTgt/Bou', NULL, 'a', 'j', '2014-09-06 22:52:41', '2014-09-29 04:14:18', 9, 'Freelancer', 1),
(66, 'i@i.com', '$2y$10$uMPDUoEZyNzTDWZORxYmVec2I74XjvyTlVhJhSEBf5sk6BA9Yg61G', NULL, 1, NULL, '2014-09-06 22:55:42', '2014-09-29 04:14:46', '$2y$10$ZM6OqvtKMoeSW8PKeUpwPOKm2OEtEbopKb36l3SamDvrokBE45GPe', NULL, 'First Namesdf', 'Last Namesdf', '2014-09-06 22:54:43', '2014-09-29 04:14:46', 5, 'Freelancer', 0),
(67, 'i2@i2.com', '$2y$10$uMPDUoEZyNzTDWZORxYmVec2I74XjvyTlVhJhSEBf5sk6BA9Yg61G', NULL, 1, NULL, '2014-09-06 22:55:42', '2014-09-29 04:15:31', '$2y$10$uaseWlVTijIYMpVNM3JSFeReAmt8LdXZs5UPQD0VgUtpXBYbKXVqK', NULL, 'First Namesdf', 'Last Namesdf', '2014-09-06 22:54:43', '2014-09-29 04:15:31', 2, 'Freelancer', 0),
(68, 'i3@i3.com', '$2y$10$uMPDUoEZyNzTDWZORxYmVec2I74XjvyTlVhJhSEBf5sk6BA9Yg61G', NULL, 1, NULL, '2014-09-06 22:55:42', '2014-09-29 04:16:05', '$2y$10$kSgvrobknCLDFAMFhYBlduSG1uLdmRmEPqxNDKGUslywZ6NNwDUdK', NULL, 'First Namesdf', 'Last Namesdf', '2014-09-06 22:54:43', '2014-09-29 04:16:05', 4, 'Freelancer', 0),
(69, 'i4@i4.com', '$2y$10$uMPDUoEZyNzTDWZORxYmVec2I74XjvyTlVhJhSEBf5sk6BA9Yg61G', NULL, 1, NULL, '2014-09-06 22:55:42', '2014-09-29 04:16:51', '$2y$10$AJSxQ7IHp.S0gcGUlD43kuOru9B3BCnlvkztSfY5OlkuZl3zl1JsO', NULL, 'First Namesdf', 'Last Namesdf', '2014-09-06 22:54:43', '2014-09-29 04:16:51', 6, 'Freelancer', 0),
(70, 'i5@i5.com', '$2y$10$uMPDUoEZyNzTDWZORxYmVec2I74XjvyTlVhJhSEBf5sk6BA9Yg61G', NULL, 1, NULL, '2014-09-06 22:55:42', '2014-09-29 04:17:32', '$2y$10$rCr4ax.GxoNlyoDFyZf/JesdIUcd4.ylQr.J.euixkbjX1O1bFTgi', NULL, 'First Namesdf', 'Last Namesdf', '2014-09-06 22:54:43', '2014-09-29 04:17:32', 7, 'Freelancer', 0),
(71, 'i6@i6.com', '$2y$10$uMPDUoEZyNzTDWZORxYmVec2I74XjvyTlVhJhSEBf5sk6BA9Yg61G', NULL, 1, NULL, '2014-09-06 22:55:42', '2014-09-29 04:18:03', '$2y$10$owII8kazPiAAwHFf3tTWw.ZnTrwJemRsIinoyT/8L.CN45pLtQ2xu', NULL, 'First Namesdf', 'Last Namesdf', '2014-09-06 22:54:43', '2014-09-29 04:18:03', 8, 'Freelancer', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE IF NOT EXISTS `users_groups` (
  `user_id` int(10) unsigned NOT NULL,
  `group_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`user_id`, `group_id`) VALUES
(2, 2),
(64, 4),
(65, 5),
(66, 3),
(67, 3),
(68, 3),
(69, 3),
(70, 3),
(71, 3);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `certifications`
--
ALTER TABLE `certifications`
  ADD CONSTRAINT `fk_freelancer_cert_id` FOREIGN KEY (`freelancer_id`) REFERENCES `freelancers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `educations`
--
ALTER TABLE `educations`
  ADD CONSTRAINT `fk_freelancer_edu_id` FOREIGN KEY (`freelancer_id`) REFERENCES `freelancers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD CONSTRAINT `fk_freelancer_feedback_id` FOREIGN KEY (`freelancer_id`) REFERENCES `job_offers` (`freelancer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_joboffer_feedback_id` FOREIGN KEY (`job_offer_id`) REFERENCES `job_offers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `freelancer_agency`
--
ALTER TABLE `freelancer_agency`
  ADD CONSTRAINT `fk_freelancer_agency_member_id` FOREIGN KEY (`freelancer_id`) REFERENCES `freelancers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_freelancer_agency_owner_id` FOREIGN KEY (`agency_id`) REFERENCES `freelancers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `job_offers`
--
ALTER TABLE `job_offers`
  ADD CONSTRAINT `fk_freelancer_joboffer_id` FOREIGN KEY (`freelancer_id`) REFERENCES `freelancers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_joboffer_jobpost_id` FOREIGN KEY (`job_post_id`) REFERENCES `job_posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_job_offer_client_id` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `job_phases`
--
ALTER TABLE `job_phases`
  ADD CONSTRAINT `fk_joboffer_jobphase_id` FOREIGN KEY (`job_offer_id`) REFERENCES `job_offers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `job_posts`
--
ALTER TABLE `job_posts`
  ADD CONSTRAINT `fk_jobcategory_jobpost_id` FOREIGN KEY (`job_category_id`) REFERENCES `job_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_jobpost_client_id` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `job_requests`
--
ALTER TABLE `job_requests`
  ADD CONSTRAINT `job_requests_ibfk_1` FOREIGN KEY (`job_id`) REFERENCES `job_posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `job_requests_ibfk_2` FOREIGN KEY (`freelancer_id`) REFERENCES `freelancers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `fk_payment_jobphase_id` FOREIGN KEY (`job_phase_id`) REFERENCES `job_phases` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `portfolios`
--
ALTER TABLE `portfolios`
  ADD CONSTRAINT `fk_freelancer_portfolio_id` FOREIGN KEY (`freelancer_id`) REFERENCES `freelancers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `professional_backgrounds`
--
ALTER TABLE `professional_backgrounds`
  ADD CONSTRAINT `fk_professional_freelancer_id` FOREIGN KEY (`freelancer_id`) REFERENCES `freelancers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `question_bank`
--
ALTER TABLE `question_bank`
  ADD CONSTRAINT `fk_questionbank_questiongroup_id` FOREIGN KEY (`group_id`) REFERENCES `question_group` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_questionbank_questionlevel_id` FOREIGN KEY (`level_id`) REFERENCES `question_level` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `related_tags`
--
ALTER TABLE `related_tags`
  ADD CONSTRAINT `fk_freelancercategory_category_id` FOREIGN KEY (`skill_tags_id`) REFERENCES `skill_tags` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `slips`
--
ALTER TABLE `slips`
  ADD CONSTRAINT `fk_freelancer_slip_id` FOREIGN KEY (`freelance_id`) REFERENCES `freelancers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_slip_joboffer_id` FOREIGN KEY (`job_offer_id`) REFERENCES `job_offers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
