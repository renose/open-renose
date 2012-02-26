-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 05. Februar 2011 um 12:55
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
-- Tabellenstruktur für Tabelle `path`
--

CREATE TABLE IF NOT EXISTS `path` (
  `module` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dir` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'root',
  `path` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`module`,`dir`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `path`
--

INSERT INTO `path` (`module`, `dir`, `path`) VALUES
('cms', 'root', 'system/core/cms/'),
('cms', 'tpl', 'tpl/');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `module` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `property` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`module`,`property`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Hier werden Einstellungen der Module gespeichert.';

--
-- Daten für Tabelle `settings`
--

INSERT INTO `settings` (`module`, `property`, `value`) VALUES
('cms', 'site_title', 'open reNose'),
('cms', 'version', '0.0.0.1');
