-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 02, 2018 at 06:11 AM
-- Server version: 5.1.73
-- PHP Version: 5.5.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `000338052`
--

-- --------------------------------------------------------

--
-- Table structure for table `hl_access_levels`
--

DROP TABLE IF EXISTS `hl_access_levels`;
CREATE TABLE IF NOT EXISTS `hl_access_levels` (
  `access_level_id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`access_level_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `hl_access_levels`
--

INSERT INTO `hl_access_levels` (`access_level_id`, `name`) VALUES
(1, 'Admin'),
(2, 'Member');

-- --------------------------------------------------------

--
-- Table structure for table `hl_categories`
--

DROP TABLE IF EXISTS `hl_categories`;
CREATE TABLE IF NOT EXISTS `hl_categories` (
  `category_id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `hl_categories`
--

INSERT INTO `hl_categories` (`category_id`, `name`) VALUES
(1, 'Lamp'),
(2, 'Table');

-- --------------------------------------------------------

--
-- Table structure for table `hl_colors`
--

DROP TABLE IF EXISTS `hl_colors`;
CREATE TABLE IF NOT EXISTS `hl_colors` (
  `color_id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`color_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `hl_colors`
--

INSERT INTO `hl_colors` (`color_id`, `name`) VALUES
(1, 'Yellow'),
(2, 'Red');

-- --------------------------------------------------------

--
-- Table structure for table `hl_models`
--

DROP TABLE IF EXISTS `hl_models`;
CREATE TABLE IF NOT EXISTS `hl_models` (
  `model_id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `picture_id` varchar(50) DEFAULT NULL,
  `category_id` int(10) DEFAULT NULL,
  `color_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`model_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `hl_models`
--

INSERT INTO `hl_models` (`model_id`, `name`, `description`, `location`, `picture_id`, `category_id`, `color_id`) VALUES
(16, 'Koala', 'Model Picture', 'https://csunix.mohawkcollege.ca/~000338052/private/hololens3/application/assets/models/Koala.jpg', '4', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hl_pictures`
--

DROP TABLE IF EXISTS `hl_pictures`;
CREATE TABLE IF NOT EXISTS `hl_pictures` (
  `picture_id` int(10) NOT NULL AUTO_INCREMENT,
  `description` varchar(500) NOT NULL,
  `link` varchar(150) NOT NULL,
  PRIMARY KEY (`picture_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `hl_pictures`
--

INSERT INTO `hl_pictures` (`picture_id`, `description`, `link`) VALUES
(4, 'User profile picture', 'https://csunix.mohawkcollege.ca/~000338052/private/hololens3/application/assets/img/profile/5a49fcfb7fbdd.png'),
(5, 'User profile picture', 'https://csunix.mohawkcollege.ca/~000338052/private/hololens3/application/assets/img/profile/5a49fe85020dc.png');

-- --------------------------------------------------------

--
-- Table structure for table `hl_security_questions`
--

DROP TABLE IF EXISTS `hl_security_questions`;
CREATE TABLE IF NOT EXISTS `hl_security_questions` (
  `security_question_id` int(10) NOT NULL AUTO_INCREMENT,
  `question` varchar(255) NOT NULL,
  PRIMARY KEY (`security_question_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `hl_security_questions`
--

INSERT INTO `hl_security_questions` (`security_question_id`, `question`) VALUES
(1, 'What is your mothers maiden name?'),
(2, 'What if your favorite color?');

-- --------------------------------------------------------

--
-- Table structure for table `hl_spaces`
--

DROP TABLE IF EXISTS `hl_spaces`;
CREATE TABLE IF NOT EXISTS `hl_spaces` (
  `space_id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `user_id` int(10) NOT NULL,
  `created_date` date NOT NULL,
  PRIMARY KEY (`space_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `hl_spaces`
--

INSERT INTO `hl_spaces` (`space_id`, `name`, `description`, `user_id`, `created_date`) VALUES
(2, 'My Test Space', 'Filled with hope', 2, '2018-01-01');

-- --------------------------------------------------------

--
-- Table structure for table `hl_space_file_lines`
--

DROP TABLE IF EXISTS `hl_space_file_lines`;
CREATE TABLE IF NOT EXISTS `hl_space_file_lines` (
  `space_file_id` int(10) NOT NULL AUTO_INCREMENT,
  `space_id` int(10) NOT NULL,
  `model_id` int(10) NOT NULL,
  PRIMARY KEY (`space_file_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `hl_space_file_lines`
--

INSERT INTO `hl_space_file_lines` (`space_file_id`, `space_id`, `model_id`) VALUES
(1, 2, 17),
(2, 2, 17);

-- --------------------------------------------------------

--
-- Table structure for table `hl_users`
--

DROP TABLE IF EXISTS `hl_users`;
CREATE TABLE IF NOT EXISTS `hl_users` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `enckey` varchar(255) NOT NULL,
  `access_level_id` int(10) NOT NULL,
  `picture_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `hl_users`
--

INSERT INTO `hl_users` (`user_id`, `first_name`, `last_name`, `email`, `enckey`, `access_level_id`, `picture_id`) VALUES
(1, 'admin', 'admin', 'admin@admin.com', '$2y$10$9ExSc9bvJoYMj/Lrpm5ouuoZQCAG35eLQ64AgxUbCUw3M.ju8ePK.', 1, 0),
(2, 'member', 'member', 'member@member.com', '$2y$10$LseBfz5ajvnvj4tbU9DHFOT/tYO2lOQkmRTTl38H0tqaGtg5.gF/u', 2, 0),
(6, 'test', 'test', 'test@test.com', '$2y$10$Mhm18Kak8dojuhVMq2bmMeOBYJgbnslD9MJOdYcOBL1kte5yPoL0W', 2, 4),
(7, 'tate', 'tate', 'tate@tate.com', '$2y$10$YsnfQRGmfZt8/QIkdWNI4uNmtfcANlXFw9NgP7Z/.SbNJqEs3N0Tq', 2, 5);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
