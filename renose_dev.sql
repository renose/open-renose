-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 25. Mai 2012 um 11:12
-- Server Version: 5.5.16
-- PHP-Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Datenbank: `renose_dev`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `calendar_entries`
--

CREATE TABLE IF NOT EXISTS `calendar_entries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `day` date NOT NULL,
  `type` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Daten für Tabelle `calendar_entries`
--

INSERT INTO `calendar_entries` (`id`, `user_id`, `day`, `type`, `created`, `modified`) VALUES
(1, 1, '2011-12-24', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 1, '2012-12-24', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 1, '2012-05-01', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `jobs`
--

CREATE TABLE IF NOT EXISTS `jobs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Daten für Tabelle `jobs`
--

INSERT INTO `jobs` (`id`, `name`, `created`, `modified`) VALUES
(1, 'Fachinformatiker - Anwendungsentwicklung', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `profiles`
--

CREATE TABLE IF NOT EXISTS `profiles` (
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
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Daten für Tabelle `profiles`
--

INSERT INTO `profiles` (`id`, `user_id`, `first_name`, `last_name`, `street`, `zip_code`, `city`, `birthplace`, `birthday`, `job_id`, `company`, `branch`, `created`, `modified`) VALUES
(1, 1, 'Admin', 'reNose', NULL, NULL, NULL, NULL, '1999-01-01', 1, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 2, 'Simon', 'Wörner', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 3, 'Patrick', 'Hafner', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `reports`
--

CREATE TABLE IF NOT EXISTS `reports` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Daten für Tabelle `reports`
--

INSERT INTO `reports` (`id`, `user_id`, `year`, `week`, `number`, `department`, `date`, `created`, `modified`) VALUES
(1, 1, 2010, 35, 1, '', '2011-05-03', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 1, 2011, 33, 51, '', '2011-08-16', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 1, 2012, 21, 87, '', '2012-05-25', '2012-05-25 10:48:57', '2012-05-25 10:48:57'),
(4, 1, 2012, 7, 73, '', '2012-05-25', '2012-05-25 11:03:57', '2012-05-25 11:03:57');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `report_activities`
--

CREATE TABLE IF NOT EXISTS `report_activities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `report_id` int(11) NOT NULL,
  `text` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Daten für Tabelle `report_activities`
--

INSERT INTO `report_activities` (`id`, `report_id`, `text`, `created`, `modified`) VALUES
(1, 1, 'Report via Scaffolding getestet', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 1, 'Test³²', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `report_instructions`
--

CREATE TABLE IF NOT EXISTS `report_instructions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `report_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `text` text,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Daten für Tabelle `report_instructions`
--

INSERT INTO `report_instructions` (`id`, `report_id`, `title`, `text`, `created`, `modified`) VALUES
(1, 1, 'Webentwicklung mit cakePHP', 'Prototyp mit cakePHP und Scaffolfing erstellen.', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `report_schools`
--

CREATE TABLE IF NOT EXISTS `report_schools` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `report_id` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `schedules`
--

CREATE TABLE IF NOT EXISTS `schedules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Daten für Tabelle `schedules`
--

INSERT INTO `schedules` (`id`, `user_id`, `created`, `modified`) VALUES
(1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `schedule_lessons`
--

CREATE TABLE IF NOT EXISTS `schedule_lessons` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=46 ;

--
-- Daten für Tabelle `schedule_lessons`
--

INSERT INTO `schedule_lessons` (`id`, `schedule_id`, `day`, `number`, `subject`, `teacher`, `room`, `created`, `modified`) VALUES
(1, 1, 4, 0, 'BWL', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 1, 4, 1, 'BWL', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(35, 1, 4, 3, 'SAE', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(36, 1, 4, 4, 'SAE', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(37, 1, 4, 5, 'SAE', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(40) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `activationkey` varchar(40) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `is_active`, `activationkey`, `created`, `modified`) VALUES
(1, 'admin@renose.de', '67ef003adb4b7da80cf36e17fad6260b94dbcb16', 1, NULL, '2011-04-15 23:17:20', '2011-04-15 23:17:20'),
(2, 'simon@renose.de', '492a4d8fbf9da1a0aa036b948ff5cef09ce6b6eb', 1, NULL, '2011-04-16 11:45:53', '2011-04-16 11:45:53'),
(3, 'patrick@renose.de', 'ead2222b5def6d0223d8685f38cc3736be8887bf', 1, NULL, '2011-04-16 11:45:53', '2011-04-16 11:45:53');
