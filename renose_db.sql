/*
 Navicat MySQL Data Transfer

 Source Server         : mac.int
 Source Server Version : 50509
 Source Host           : localhost
 Source Database       : renose

 Target Server Version : 50509
 File Encoding         : utf-8

 Date: 06/17/2012 03:45:02 AM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `calendar_entries`
-- ----------------------------
DROP TABLE IF EXISTS `calendar_entries`;
CREATE TABLE `calendar_entries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `day` date NOT NULL,
  `type` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


-- ----------------------------
--  Table structure for `jobs`
-- ----------------------------
DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `profiles`
-- ----------------------------
DROP TABLE IF EXISTS `profiles`;
CREATE TABLE `profiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `street` varchar(255) DEFAULT NULL,
  `zip_code` int(5) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `birthplace` varchar(255) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `job_id` int(11) DEFAULT NULL,
  `company` varchar(255) NOT NULL,
  `branch` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `start_training_period` date NOT NULL,
  `end_training_period` date NOT NULL,
  `contract_registered` date NOT NULL,
  `contract_signed` date NOT NULL,
  `assigned_board_of_trade` varchar(255) NOT NULL COMMENT 'zuständige ihk',
  `past` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `report_activities`
-- ----------------------------
DROP TABLE IF EXISTS `report_activities`;
CREATE TABLE `report_activities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `report_id` int(11) NOT NULL,
  `text` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `report_id` (`report_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `report_instructions`
-- ----------------------------
DROP TABLE IF EXISTS `report_instructions`;
CREATE TABLE `report_instructions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `report_id` int(11) NOT NULL,
  `text` text,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `report_id` (`report_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `report_schools`
-- ----------------------------
DROP TABLE IF EXISTS `report_schools`;
CREATE TABLE IF NOT EXISTS `report_schools` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `report_id` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `report_subject` (`report_id`,`subject`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `reports`
-- ----------------------------
DROP TABLE IF EXISTS `reports`;
CREATE TABLE `reports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `year` year(4) NOT NULL,
  `week` int(2) NOT NULL,
  `number` int(11) NOT NULL,
  `department` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `holiday` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `report` (`user_id`,`year`,`week`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `resumes`
-- ----------------------------
DROP TABLE IF EXISTS `resumes`;
CREATE TABLE `resumes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `sorting` int(11) DEFAULT NULL,
  `from` date NOT NULL,
  `to` date NOT NULL,
  `description` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `schedule_lessons`
-- ----------------------------
DROP TABLE IF EXISTS `schedule_lessons`;
CREATE TABLE `schedule_lessons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `schedule_id` int(11) NOT NULL,
  `day` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `teacher` varchar(255) NOT NULL,
  `room` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `schedules`
-- ----------------------------
DROP TABLE IF EXISTS `schedules`;
CREATE TABLE `schedules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(40) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `activationkey` varchar(40) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


SET FOREIGN_KEY_CHECKS = 1;
