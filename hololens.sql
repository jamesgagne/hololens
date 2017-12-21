-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 19, 2017 at 04:52 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

--

-- --------------------------------------------------------

--
-- Table structure for table `access_levels`
--
DROP TABLE IF EXISTS `hl_access_levels`;
CREATE TABLE `hl_access_levels` (
  `access_level_id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(50) NOT NULL
);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--
DROP TABLE IF EXISTS `hl_categories`;
CREATE TABLE `hl_categories` (
  `category_id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `short_name` varchar(10) NOT NULL
);

-- --------------------------------------------------------

--
-- Table structure for table `files`
--
DROP TABLE IF EXISTS `hl_files`;
CREATE TABLE `hl_files` (
  `file_id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255),
  `location` varchar(255) NOT NULL,
  `size` varchar(20),
  `category_id` int(10),
  `color_id` int(10)
);

-- --------------------------------------------------------

--
-- Table structure for table `files`
--
DROP TABLE IF EXISTS `hl_colors`;
CREATE TABLE `hl_colors` (
  `color_id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL
);

-- --------------------------------------------------------

--
-- Table structure for table `spaces`
--
DROP TABLE IF EXISTS `hl_spaces`;
CREATE TABLE `hl_spaces` (
  `space_id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `user_id` int(10) NOT NULL,
  `created_date` date NOT NULL
); 

-- --------------------------------------------------------

--
-- Table structure for table `space_file_lines`
--
DROP TABLE IF EXISTS `hl_space_file_lines`;
CREATE TABLE `hl_space_file_lines` (
  `space_file_id` int(10) NOT NULL,
  `space_id` int(10) NOT NULL,
  `file_id` int(10) NOT NULL
); 

-- --------------------------------------------------------

--
-- Table structure for table `users`
--
DROP TABLE IF EXISTS `hl_users`;
CREATE TABLE `hl_users` (
  `user_id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `salt` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `enckey` varchar(255) NOT NULL,
  `access_level_id` int(10) NOT NULL
); 

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access_levels`
--
ALTER TABLE `hl_access_levels`
  ADD PRIMARY KEY (`access_level_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `hl_categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `files`
--
ALTER TABLE `hl_files`
  ADD PRIMARY KEY (`file_id`);

--
-- Indexes for table `spaces`
--
ALTER TABLE `hl_spaces`
  ADD PRIMARY KEY (`space_id`);

--
-- Indexes for table `space_file_lines`
--
ALTER TABLE `hl_space_file_lines`
  ADD PRIMARY KEY (`space_file_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `hl_users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `access_levels`
--
ALTER TABLE `hl_access_levels`
  MODIFY `access_level_id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `hl_categories`
  MODIFY `category_id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `hl_files`
  MODIFY `file_id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `spaces`
--
ALTER TABLE `hl_spaces`
  MODIFY `space_id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `space_file_lines`
--
ALTER TABLE `hl_space_file_lines` 
  MODIFY `space_file_id` int(10) NOT NULL AUTO_INCREMENT;
