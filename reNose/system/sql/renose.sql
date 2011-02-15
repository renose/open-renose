-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 15. Februar 2011 um 22:20
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
-- Tabellenstruktur für Tabelle `cms_companies`
--

CREATE TABLE IF NOT EXISTS `cms_companies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(400) NOT NULL,
  `street` varchar(400) NOT NULL,
  `number` varchar(10) NOT NULL,
  `plz` int(5) NOT NULL,
  `location` varchar(400) NOT NULL,
  `tel` varchar(400) DEFAULT NULL,
  `fax` varchar(400) DEFAULT NULL,
  `mail` varchar(400) DEFAULT NULL,
  `web` varchar(400) DEFAULT NULL,
  `trainername` varchar(400) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Daten für Tabelle `cms_companies`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `cms_jobname`
--

CREATE TABLE IF NOT EXISTS `cms_jobname` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(400) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Daten für Tabelle `cms_jobname`
--

INSERT INTO `cms_jobname` (`id`, `name`) VALUES
(1, 'Fachinformatiker: Anwendungsentwicklung'),
(2, 'Fachinformatiker: Systemintegration');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `cms_navi`
--

CREATE TABLE IF NOT EXISTS `cms_navi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `link` varchar(256) NOT NULL,
  `text` varchar(256) NOT NULL,
  `hide_notloggedin` tinyint(1) DEFAULT NULL,
  `hide_loggedin` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Daten für Tabelle `cms_navi`
--

INSERT INTO `cms_navi` (`id`, `link`, `text`, `hide_notloggedin`, `hide_loggedin`) VALUES
(1, 'viewPage?name=home', 'Home', 0, 0),
(2, 'viewPage?name=project', 'Über das Projekt', 0, 0),
(3, 'viewPage?name=faq', 'FAQ', 0, 0),
(4, 'help', 'Hilfe', 0, 0),
(5, 'register', 'Registrieren', 0, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `cms_pages`
--

CREATE TABLE IF NOT EXISTS `cms_pages` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `description` varchar(300) DEFAULT NULL,
  `value` text,
  `url` varchar(400) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Daten für Tabelle `cms_pages`
--

INSERT INTO `cms_pages` (`id`, `title`, `description`, `value`, `url`) VALUES
(1, 'Home', 'Kurzer ID 1', '&lt;p&gt;\r\n	Willkommen auf reNose.de&lt;/p&gt;\r\n&lt;p&gt;\r\n	&amp;nbsp;&lt;/p&gt;\r\n&lt;ul&gt;\r\n	&lt;li&gt;\r\n		Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. :D&lt;/li&gt;\r\n&lt;/ul&gt;\r\n', 'home'),
(2, 'FAQ', 'Häufig gestellte Fragen', '&lt;p&gt;\r\n	Seit wann macht ihr dieses Projekt?&lt;/p&gt;\r\n&lt;blockquote&gt;\r\n	&lt;p&gt;\r\n		Das Projekt ist seit dem 1. Februar 2011 in Google Code zu finden.&lt;/p&gt;\r\n	&lt;p&gt;\r\n		&amp;nbsp;&lt;/p&gt;\r\n&lt;/blockquote&gt;\r\n&lt;p&gt;\r\n	Und sonst?&lt;/p&gt;\r\n&lt;blockquote&gt;\r\n	&lt;p&gt;\r\n		Wei&amp;szlig; nicht&lt;/p&gt;\r\n&lt;/blockquote&gt;\r\n', 'faq'),
(3, 'Über das Projekt', 'test', '&lt;p&gt;\r\n	vk&lt;/p&gt;\r\n', 'project');

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
('editPage', 'root', 'admin/'),
('editPage', 'tpl', 'admin/tpl/'),
('errorPage', 'root', 'system/core/error/'),
('errorPage', 'tpl', 'system/core/error/tpl/'),
('IHKpdf', 'root', 'system/plugins/pdfgen/'),
('IHKpdf', 'tpl', 'system/plugins/pdfgen/tpl/'),
('login', 'root', 'system/core/login/'),
('login', 'tpl', 'system/core/login/tpl/'),
('logout', 'root', 'system/core/logout/'),
('logout', 'tpl', 'system/core/logout/tpl/'),
('page', 'root', 'admin/'),
('page', 'tpl', 'admin/tpl/'),
('register', 'root', 'system/core/register/'),
('register', 'tpl', 'system/core/register/tpl/'),
('test', 'root', 'system/core/test/'),
('test', 'tpl', 'system/core/test/tpl/'),
('viewPage', 'root', 'system/core/cms/'),
('viewPage', 'tpl', 'tpl/');

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
('editPage', 'editPage', 'editPage.php', 'ON'),
('errorPage', 'errorPage', 'error.php', 'ON'),
('IHKpdf', 'IHKpdf', 'IHKpdf.php', 'ON'),
('login', 'login', NULL, 'ON'),
('logout', 'logout', 'logout.php', 'ON'),
('page', 'page', NULL, 'ON'),
('register', 'register', NULL, 'ON'),
('test', 'trash_content', 'test.php', 'ON'),
('viewPage', 'viewPage', NULL, 'ON');

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
-- Tabellenstruktur für Tabelle `cms_userdata_bs`
--

CREATE TABLE IF NOT EXISTS `cms_userdata_bs` (
  `userid` int(11) NOT NULL,
  `time` date NOT NULL,
  `value` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `cms_userdata_bs`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `cms_users`
--

CREATE TABLE IF NOT EXISTS `cms_users` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `mail` varchar(200) NOT NULL,
  `password` varchar(50) CHARACTER SET latin1 NOT NULL,
  `isAdmin` tinyint(1) NOT NULL,
  `prename` varchar(400) NOT NULL,
  `name` varchar(400) NOT NULL,
  `birthdate` date NOT NULL,
  `jobid` int(11) NOT NULL,
  `companyid` int(11) NOT NULL,
  PRIMARY KEY (`username`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Daten für Tabelle `cms_users`
--

INSERT INTO `cms_users` (`id`, `username`, `mail`, `password`, `isAdmin`, `prename`, `name`, `birthdate`, `jobid`, `companyid`) VALUES
(1, 'renose', '', '5fc7e38bffe00ca46add89145464a2eaf759d5c2', 1, 'Max', 'Mustermann', '1994-12-24', 1, 0);
