-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 07. Februar 2011 um 22:52
-- Server Version: 5.1.44
-- PHP-Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Datenbank: `renose`
--

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
  `module` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dir` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'root',
  `path` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`module`,`dir`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `module` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `classname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `filename` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` enum('ON','OFF') COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`module`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `cms_plugins`
--

INSERT INTO `cms_plugins` (`module`, `classname`, `filename`, `state`) VALUES
('test', 'trash_content', 'test.php', 'ON');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `cms_settings`
--

CREATE TABLE IF NOT EXISTS `cms_settings` (
  `module` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `property` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`module`,`property`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Hier werden Einstellungen der Module gespeichert.';

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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `cms_users`
--

