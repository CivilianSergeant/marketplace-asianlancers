-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 25, 2014 at 02:25 PM
-- Server version: 5.5.36
-- PHP Version: 5.4.25

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `question_bank`
--

INSERT INTO `question_bank` (`id`, `question`, `question_type`, `level_id`, `group_id`, `skill_id`, `answers`, `answer_time`, `updated_at`, `created_at`) VALUES
(3, 'What does PHP stand for?', 'Radio', 1, 1, 11, '[{"answer":"Personal Home Page","correct":0},{"answer":"Private Home Page","correct":0},{"answer":"PHP: Hypertext Preprocessor","correct":"1"},{"answer":"Personal Hypertext Processor","correct":0}]', '00:01:00', '2014-08-25', '2014-08-25'),
(5, 'PHP server scripts are surrounded by delimiters, which?', 'Radio', 1, 1, 11, '[{"answer":"<?php\\ufffd?>","correct":"1"},{"answer":"<?php>...<\\/?>","correct":0},{"answer":"<&>...<\\/&>","correct":0},{"answer":"<script>...<\\/script>","correct":0}]', '00:01:00', '2014-08-25', '2014-08-25'),
(6, 'How do you write "Hello World" in PHP', 'Radio', 1, 1, 11, '[{"answer":"echo \\"Hello World\\";","correct":1},{"answer":"\\"Hello World\\";","correct":0},{"answer":"Document.Write(\\"Hello World\\");","correct":0}]', '00:01:00', '2014-08-25', '2014-08-25'),
(7, 'All variables in PHP start with which symbol?', 'Radio', 1, 1, 11, '[{"answer":"!","correct":0},{"answer":"$","correct":"1"},{"answer":"&","correct":0}]', '00:01:00', '2014-08-25', '2014-08-25'),
(8, 'The PHP syntax is most similar to:', 'Radio', 1, 1, 11, '[{"answer":"Perl and C","correct":"1"},{"answer":"VBScript","correct":0},{"answer":"JavaScript","correct":0}]', '00:01:00', '2014-08-25', '2014-08-25'),
(9, 'How do you get information from a form that is submitted using the "get" method?', 'Radio', 1, 1, 11, '[{"answer":"Request.QueryString;","correct":0},{"answer":"Request.Form;","correct":0},{"answer":"$_GET[];","correct":"1"}]', '00:01:00', '2014-08-25', '2014-08-25'),
(10, 'When using the POST method, variables are displayed in the URL:', 'Radio', 1, 1, 11, '[{"answer":"true","correct":0},{"answer":"false","correct":"1"}]', '00:01:00', '2014-08-25', '2014-08-25'),
(12, 'What is the correct way to create a function in PHP?', 'Radio', 4, 1, 11, '[{"answer":"create myFunction()","correct":0},{"answer":"new_function myFunction()","correct":0},{"answer":"function myFunction()","correct":"1"}]', '00:01:00', '2014-08-25', '2014-08-25'),
(13, 'What is the correct way to open the file "time.txt" as readable?', 'Radio', 4, 5, 11, '[{"answer":"open(\\"time.txt\\");","correct":0},{"answer":"fopen(\\"time.txt\\",\\"r\\");","correct":"1"},{"answer":"open(\\"time.txt\\",\\"read\\");","correct":0},{"answer":"fopen(\\"time.txt\\",\\"r+\\");","correct":0}]', '00:01:00', '2014-08-25', '2014-08-25'),
(14, 'PHP allows you to send emails directly from a script', 'Radio', 4, 5, 11, '[{"answer":"False","correct":0},{"answer":"True","correct":"1"}]', '00:01:00', '2014-08-25', '2014-08-25'),
(15, 'What is the correct way to connect to a MySQL database?', 'Radio', 4, 1, 11, '[{"answer":"mysqli_connect(host,username,password,dbname);","correct":"1"},{"answer":"mysqli_db(host,username,password,dbname);","correct":0},{"answer":"mysqli_open(host,username,password,dbname);","correct":0}]', '00:01:00', '2014-08-25', '2014-08-25'),
(16, 'What is the correct way to add 1 to the $count variable?', 'Radio', 1, 1, 11, '[{"answer":"count++;","correct":0},{"answer":"++count","correct":0},{"answer":"$count =+1","correct":"1"},{"answer":"$count++;","correct":"1"}]', '00:01:00', '2014-08-25', '2014-08-25'),
(17, 'What is a correct way to add a comment in PHP?', 'Radio', 1, 1, 11, '[{"answer":"<!--\\ufffd-->","correct":0},{"answer":"\\/*\\ufffd*\\/","correct":"1"},{"answer":"*\\\\..\\\\*","correct":0},{"answer":"<comment>\\ufffd<\\/comment>","correct":0}]', '00:01:00', '2014-08-25', '2014-08-25'),
(18, 'PHP can be run on Microsoft Windows IIS(Internet Information Server):', 'Radio', 6, 5, 11, '[{"answer":"True","correct":"1"},{"answer":"False","correct":0}]', '00:01:00', '2014-08-25', '2014-08-25');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `question_bank`
--
ALTER TABLE `question_bank`
  ADD CONSTRAINT `fk_questionbank_questiongroup_id` FOREIGN KEY (`group_id`) REFERENCES `question_group` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_questionbank_questionlevel_id` FOREIGN KEY (`level_id`) REFERENCES `question_level` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
