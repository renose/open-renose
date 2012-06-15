/*
 Navicat MySQL Data Transfer

 Source Server         : mac.int
 Source Server Version : 50509
 Source Host           : localhost
 Source Database       : renose

 Target Server Version : 50509
 File Encoding         : utf-8

 Date: 05/29/2012 10:34:13 AM
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `calendar_entries`
-- ----------------------------
BEGIN;
INSERT INTO `calendar_entries` VALUES ('1', '1', '2011-12-24', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('2', '1', '2012-12-24', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('3', '1', '2012-05-01', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
COMMIT;

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `jobs`
-- ----------------------------
BEGIN;
INSERT INTO `jobs` VALUES ('1', 'Fachinformatiker - Anwendungsentwicklung', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
COMMIT;

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
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `profiles`
-- ----------------------------
BEGIN;
INSERT INTO `profiles` VALUES ('1', '1', 'Admin', 'reNose', null, null, null, null, '1999-01-01', '1', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', ''), ('2', '2', 'Simon', 'Wörner', null, null, null, null, null, null, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', ''), ('3', '3', 'Patrick', 'Hafner', 'Teststraße 1', '12345', 'Musterstadt', 'Musterort', '1992-01-01', '1', 'Example Ltd.', 'Web', '0000-00-00 00:00:00', '2012-05-29 10:33:33', '2010-01-01', '2013-01-01', '2010-01-01', '2010-01-01', 'Region Stuttgart');
COMMIT;

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `report_activities`
-- ----------------------------
BEGIN;
INSERT INTO `report_activities` VALUES ('1', '1', 'Report via Scaffolding getestet', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('3', '4', 'Hallo, <i>Welt</i><b>!</b><br><b>(:</b>', '2012-05-28 01:20:22', '2012-05-28 01:20:22');
COMMIT;

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `report_instructions`
-- ----------------------------
BEGIN;
INSERT INTO `report_instructions` VALUES ('1', '1', 'Prototyp mit cakePHP und Scaffolfing erstellen.', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
COMMIT;

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
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `report` (`user_id`,`year`,`week`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `reports`
-- ----------------------------
BEGIN;
INSERT INTO `reports` VALUES ('1', '1', '2010', '35', '1', '', '2011-05-03', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('2', '1', '2011', '33', '51', '', '2011-08-16', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('3', '1', '2012', '21', '87', '', '2012-05-25', '2012-05-25 10:48:57', '2012-05-25 10:48:57'), ('4', '1', '2012', '7', '73', '', '2012-05-25', '2012-05-25 11:03:57', '2012-05-25 11:03:57'), ('5', '1', '2012', '22', '88', '', '2012-05-28', '2012-05-28 13:44:44', '2012-05-28 13:44:44');
COMMIT;

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
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `schedule_lessons`
-- ----------------------------
BEGIN;
INSERT INTO `schedule_lessons` VALUES ('1', '1', '4', '0', 'BWL', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('2', '1', '4', '1', 'BWL', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('35', '1', '4', '3', 'SAE', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('36', '1', '4', '4', 'SAE', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('37', '1', '4', '5', 'SAE', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
COMMIT;

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `schedules`
-- ----------------------------
BEGIN;
INSERT INTO `schedules` VALUES ('1', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
COMMIT;

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `users`
-- ----------------------------
BEGIN;
INSERT INTO `users` VALUES ('1', 'admin@renose.de', '67ef003adb4b7da80cf36e17fad6260b94dbcb16', '1', null, '2011-04-15 23:17:20', '2011-04-15 23:17:20'), ('2', 'simon@renose.de', '492a4d8fbf9da1a0aa036b948ff5cef09ce6b6eb', '1', null, '2011-04-16 11:45:53', '2011-04-16 11:45:53'), ('3', 'patrick@renose.de', 'ead2222b5def6d0223d8685f38cc3736be8887bf', '1', null, '2011-04-16 11:45:53', '2011-04-16 11:45:53');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
