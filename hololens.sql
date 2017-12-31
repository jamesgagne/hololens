-- --------------------------------------------------------

--
-- Table structure for table `hl_access_levels`
--

DROP TABLE IF EXISTS `hl_access_levels`;
CREATE TABLE IF NOT EXISTS `hl_access_levels` (
  `access_level_id` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`access_level_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `hl_categories`
--

DROP TABLE IF EXISTS `hl_categories`;
CREATE TABLE IF NOT EXISTS `hl_categories` (
  `category_id` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `hl_categories`
--

INSERT INTO `hl_categories` (`category_id`, `name`) VALUES
(0000000001, 'Lamp'),
(0000000002, 'Table');

-- --------------------------------------------------------

--
-- Table structure for table `hl_colors`
--

DROP TABLE IF EXISTS `hl_colors`;
CREATE TABLE IF NOT EXISTS `hl_colors` (
  `color_id` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`color_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `hl_colors`
--

INSERT INTO `hl_colors` (`color_id`, `name`) VALUES
(0000000001, 'Yellow'),
(0000000002, 'Red');

-- --------------------------------------------------------

--
-- Table structure for table `hl_files`
--

DROP TABLE IF EXISTS `hl_models`;
CREATE TABLE IF NOT EXISTS `hl_models` (
  `model_id` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `picture_id` varchar(50) DEFAULT NULL,
  `category_id` int(10) DEFAULT NULL,
  `color_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`file_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `hl_files`
--

-- --------------------------------------------------------

--
-- Table structure for table `hl_pictures`
--

DROP TABLE IF EXISTS `hl_pictures`;
CREATE TABLE IF NOT EXISTS `hl_pictures` (
  `picture_id` int(10) unsigned zerofill NOT NULL,
  `description` varchar(500) NOT NULL,
  `link` varchar(150) NOT NULL,
  PRIMARY KEY (`picture_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `hl_space_file_lines`
--

DROP TABLE IF EXISTS `hl_space_file_lines`;
CREATE TABLE IF NOT EXISTS `hl_space_file_lines` (
  `space_file_id` int(10) NOT NULL AUTO_INCREMENT,
  `space_id` int(10) NOT NULL,
  `file_id` int(10) NOT NULL,
  PRIMARY KEY (`space_file_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `hl_users`
--

DROP TABLE IF EXISTS `hl_users`;
CREATE TABLE IF NOT EXISTS `hl_users` (
  `user_id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `enckey` varchar(255) NOT NULL,
  `access_level_id` int(10) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;