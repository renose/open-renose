-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 08. Februar 2011 um 21:29
-- Server Version: 5.5.8
-- PHP-Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `renose`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `cms_navi`
--

CREATE TABLE IF NOT EXISTS `cms_navi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `link` varchar(256) NOT NULL,
  `text` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Daten für Tabelle `cms_navi`
--

INSERT INTO `cms_navi` (`id`, `link`, `text`) VALUES
(1, 'index.php', 'Home'),
(2, 'index.php?module=about', 'Über das Projekt'),
(3, 'index.php?module=faq', 'FAQ'),
(4, 'index.php?module=help', 'Hilfe'),
(5, 'index.php?module=register', 'Registrieren');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `cms_pages`
--

CREATE TABLE IF NOT EXISTS `cms_pages` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `value` varchar(5000) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `cms_pages`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `cms_path`
--

CREATE TABLE IF NOT EXISTS `cms_path` (
  `module` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `dir` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'root',
  `path` varchar(512) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`module`,`dir`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `cms_path`
--

INSERT INTO `cms_path` (`module`, `dir`, `path`) VALUES
('cms', 'root', 'system/core/cms/'),
('cms', 'tpl', 'tpl/'),
('errorPage', 'root', 'system/core/error/'),
('errorPage', 'tpl', 'tpl/'),
('register', 'root', 'system/core/register/'),
('register', 'tpl', 'tpl/'),
('test', 'root', 'system/core/test/'),
('test', 'tpl', 'system/core/test/tpl/');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `cms_plugins`
--

CREATE TABLE IF NOT EXISTS `cms_plugins` (
  `module` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `classname` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `filename` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` enum('ON','OFF') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`module`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `cms_plugins`
--

INSERT INTO `cms_plugins` (`module`, `classname`, `filename`, `state`) VALUES
('errorPage', 'errorPage', 'error.php', 'ON'),
('register', 'register', NULL, 'ON'),
('test', 'trash_content', 'test.php', 'ON');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `cms_settings`
--

CREATE TABLE IF NOT EXISTS `cms_settings` (
  `module` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `property` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(512) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`module`,`property`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Hier werden Einstellungen der Module gespeichert.';

--
-- Daten für Tabelle `cms_settings`
--

INSERT INTO `cms_settings` (`module`, `property`, `value`) VALUES
('cms', 'site_title', 'open reNose'),
('cms', 'version', '0.0.0.1');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `cms_users`
--

CREATE TABLE IF NOT EXISTS `cms_users` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `mail` varchar(200) NOT NULL,
  `password` varchar(50) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`username`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Daten für Tabelle `cms_users`
--

INSERT INTO `cms_users` (`id`, `username`, `mail`, `password`) VALUES
(1, 'SWW13', 'Simon@renose.de', '5fc7e38bffe00ca46add89145464a2eaf759d5c2'),
(2, 'patstylez', 'patrick@renose.de', '634320de0c8cf37fa366e8c0df5faf57ad2ab2f8');
