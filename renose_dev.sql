-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 17. April 2011 um 23:56
-- Server Version: 5.5.8
-- PHP-Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `renose_dev`
--
ALTER DATABASE CHARACTER SET utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(127) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Daten für Tabelle `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administratoren');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `groups_users`
--

CREATE TABLE IF NOT EXISTS `groups_users` (
  `id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `groups_users`
--

INSERT INTO `groups_users` (`id`, `group_id`, `user_id`) VALUES
(0, 1, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `group_permissions`
--

CREATE TABLE IF NOT EXISTS `group_permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `controller` varchar(127) NOT NULL,
  `action` varchar(127) NOT NULL,
  `type` bit(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permission` (`group_id`,`controller`,`action`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Daten für Tabelle `group_permissions`
--

INSERT INTO `group_permissions` (`id`, `group_id`, `controller`, `action`, `type`) VALUES
(1, 1, 'pages', 'display', '1'),
(2, 1, 'pages', 'add', '1'),
(3, 1, 'pages', 'edit', '1'),
(4, 1, 'pages', 'delete', '1');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `jobs`
--

CREATE TABLE IF NOT EXISTS `jobs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `specialization` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `job_name` (`name`,`specialization`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Daten für Tabelle `jobs`
--

INSERT INTO `jobs` (`id`, `name`, `specialization`) VALUES
(1, 'Fachinformatiker', 'Anwendungsentwicklung'),
(2, 'Fachinformatiker', 'Systemintegration');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `menus`
--

CREATE TABLE IF NOT EXISTS `menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(127) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `title` (`title`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Daten für Tabelle `menus`
--

INSERT INTO `menus` (`id`, `title`, `description`) VALUES
(1, 'main', 'Hauptmenü'),
(2, 'footer', 'Fußzeilen Menü'),
(3, 'dev', 'Menü für Entwicklungsoptionen');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `menu_items`
--

CREATE TABLE IF NOT EXISTS `menu_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `position` int(3) NOT NULL,
  `title` varchar(127) NOT NULL,
  `link` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Daten für Tabelle `menu_items`
--

INSERT INTO `menu_items` (`id`, `menu_id`, `position`, `title`, `link`) VALUES
(1, 1, 1, 'Home', '/'),
(2, 1, 2, 'Über das Projekt', '/page/about'),
(3, 1, 3, 'FAQ', '/page/faq'),
(4, 1, 4, 'Hilfe', '/page/help'),
(5, 2, 1, 'FAQ', '/page/faq'),
(6, 2, 2, 'Hilfe', '/page/help'),
(7, 2, 3, 'Kontakt', '/page/contact'),
(8, 2, 4, 'Impressum', '/page/imprint'),
(9, 3, 1, 'Admin-Panel - Pages', '/pages/display'),
(10, 3, 2, 'User - Login', '/users/login'),
(11, 3, 3, 'User - Logout', '/users/logout'),
(12, 3, 4, 'User - Test', '/users/test');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(55) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `body` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `title` (`title`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Daten für Tabelle `pages`
--

INSERT INTO `pages` (`id`, `title`, `description`, `body`, `created`, `modified`) VALUES
(1, 'home', 'Willkommen', '<h2>\r\n	Willkommen auf <cite>reNose.de</cite></h2>\r\n<p>\r\n	&nbsp;</p>\r\n<p style="text-align: justify; font-size: 11px; line-height: 14px; margin-top: 0px; margin-right: 0px; margin-bottom: 14px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; ">\r\n	Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc semper, massa molestie faucibus facilisis, neque dui rutrum quam, in venenatis felis velit vitae diam. Ut blandit, quam a cursus lacinia, justo nunc sollicitudin magna, ut pharetra purus felis vitae nisi. Phasellus facilisis semper nisl, vel faucibus ligula venenatis at. Suspendisse potenti. Phasellus vitae purus ac justo semper hendrerit. Quisque malesuada, sem ut congue fringilla, eros libero varius tortor, ac interdum sem velit vitae eros. Quisque et purus nunc. Pellentesque id suscipit eros. Mauris pulvinar nisi eu nisl facilisis non congue lacus dignissim. Donec placerat congue odio ac rhoncus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Phasellus et tempus felis. Duis sit amet eros dui. Nulla eget velit erat. Nullam vitae ultricies purus. Nulla a tristique ligula.</p>\r\n<blockquote>\r\n	<p style="text-align: justify; font-size: 11px; line-height: 14px; margin-top: 0px; margin-right: 0px; margin-bottom: 14px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; ">\r\n		<code>Morbi tristique purus et orci facilisis porttitor. Fusce scelerisque, ipsum vitae laoreet suscipit, tortor ipsum mattis risus, eu tempor est nibh in lectus. Nam consequat interdum pretium. Sed tempor egestas metus, ac venenatis sapien dapibus ut. Fusce enim libero, congue ac porttitor id, dapibus non velit. Donec vitae dolor dolor. Sed quis felis at turpis suscipit pulvinar commodo vitae augue. Quisque congue cursus felis, sit amet dictum lectus sagittis ac. Curabitur a bibendum turpis. Integer eu neque nec lorem cursus lacinia. Mauris sagittis venenatis adipiscing.</code></p>\r\n</blockquote>\r\n<p style="text-align: justify; font-size: 11px; line-height: 14px; margin-top: 0px; margin-right: 0px; margin-bottom: 14px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; ">\r\n	Aliquam laoreet venenatis metus, non feugiat metus feugiat in. Duis rhoncus quam ac nulla pellentesque scelerisque. Aliquam semper consequat dictum. Donec ac ipsum vel enim eleifend vehicula. Quisque laoreet magna in tellus commodo sodales. Integer ultricies malesuada placerat. Nunc facilisis ante non augue tincidunt interdum. Vivamus elit ipsum, ultrices ac consectetur eget, rhoncus iaculis turpis. Nullam porta ullamcorper ultricies. Integer dignissim suscipit libero sed semper. Nam in dui sed turpis dapibus consectetur. Nulla interdum, velit imperdiet imperdiet ultrices, urna felis bibendum urna, vitae dignissim libero libero pharetra nisi.</p>\r\n<p style="text-align: justify; font-size: 11px; line-height: 14px; margin-top: 0px; margin-right: 0px; margin-bottom: 14px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; ">\r\n	Nullam non nibh id nunc fermentum molestie elementum eu lacus. Fusce fringilla iaculis dui non consequat. Aliquam erat volutpat. Nulla ac mi et tortor ornare porta. Nam quam augue, faucibus eu accumsan at, bibendum consequat nibh. Vivamus aliquet sagittis diam et luctus. Curabitur egestas leo tincidunt sapien tempus non auctor tortor rhoncus. Aliquam tincidunt, tortor vel molestie dictum, lectus quam faucibus tortor, quis condimentum risus erat vel odio. Sed dignissim tortor in purus lacinia mollis. Nam quis orci et lacus aliquam fermentum. Donec mollis imperdiet dui, in accumsan elit ullamcorper in. Duis posuere purus eget lorem aliquam sed posuere ipsum imperdiet. Integer quis dui ac leo tristique bibendum a ac sapien. Curabitur auctor cursus nulla, id rhoncus libero feugiat et.</p>\r\n<p style="text-align: justify; font-size: 11px; line-height: 14px; margin-top: 0px; margin-right: 0px; margin-bottom: 14px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; ">\r\n	<samp>Curabitur sagittis ipsum faucibus metus gravida tempor. Aliquam erat volutpat. Duis nec sollicitudin justo. Phasellus molestie metus et magna tempus eget sagittis lorem suscipit. Aenean et aliquam ante. Phasellus orci nunc, sollicitudin id rhoncus sit amet, auctor non libero. Aliquam hendrerit porttitor neque, vitae pharetra magna commodo in. Nam tincidunt imperdiet nisl, sed vestibulum orci dapibus eget. Nam id metus sed dolor vehicula rhoncus eu sed est. Cras tortor magna, porta eget fermentum quis, consequat pellentesque dolor. Nulla facilisi. Quisque eget pretium turpis. Nulla facilisi. Integer lacus massa, pretium nec luctus sed, ornare sit amet nunc. Nunc vehicula enim id mauris mollis lobortis. Curabitur eu urna id urna accumsan aliquam non sit amet mauris. Pellentesque fringilla varius eros, sit amet scelerisque ante lobortis in. Duis ornare lacinia mattis.</samp></p>\r\n<p>\r\n	&nbsp;</p>\r\n', '2011-04-06 23:10:55', '2011-04-15 19:24:57'),
(2, 'about', 'Über das Projekt', '<p>\r\n    Simon und Patrick machen seit September 2010 eine Ausbildung zum Fachinformatiker: Anwendungsentwicklung.</p>\r\n<p>\r\n    &nbsp;</p>\r\n<p>\r\n    Da es in der Ausbildung eine Berichtsheftpflicht gibt, dachte sich Patrick, warum diese lokal auf dem PC nach einer Vorlage erstellen,<br />\r\n    wenn es die M&ouml;glichkeit gibt, von &uuml;berall darauf zugreifen zu k&ouml;nnen und am Ende aus den eingepflegten Daten eine PDF nach<br />\r\n    Standardanforderungen zu generieren, und diese dann auszudrucken.</p>\r\n', '2011-04-07 00:47:15', '2011-04-07 00:47:15'),
(3, 'faq', 'Häufig gestellte Fragen', '<p>\r\n	Seit wann macht ihr dieses Projekt?</p>\r\n<ul>\r\n	<li>\r\n		Das Projekt ist seit dem 1. Februar 2011 in Google Code zu finden.</li>\r\n</ul>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	Unter Welcher Lizenz habt ihr den Quellcode freigegeben?</p>\r\n<ul>\r\n	<li>\r\n		open reNose ist unter der GNU GPLv3 freigegeben</li>\r\n</ul>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	Darf ich das Copyright auf meiner eigenen Kopie &auml;ndern?</p>\r\n<ul>\r\n	<li>\r\n		Die Lizenz erlaubt es, den Quellcode beliebig zu &auml;ndern, allerdings w&uuml;rde der Vermerk ein Zeichen sein, dass ihr das Projekt unterst&uuml;tzt. Danke im Voraus!</li>\r\n</ul>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	Kann ich das Script auf eurem Server laufen lassen?</p>\r\n<ul>\r\n	<li>\r\n		Kurz und knapp: Nein, sorry!</li>\r\n</ul>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	Welche Anforderungen hat das Script an den Server?</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	<meta charset="utf-8" />\r\n</p>\r\n<ul>\r\n	<li>\r\n		PHP 5 und eine mit cakePHP kompatible Datenbank (z.B. MySQL) sind erforderlich.</li>\r\n</ul>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	Ich habe einen Bug entdeckt</p>\r\n<ul>\r\n	<li>\r\n		Dann sei so freundlich und schreibe diesen in den Bugtracker auf unserer Projektseite: renose.de oder sende eine Mail an info@renose.de</li>\r\n</ul>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	Der Quellcode ist schei&szlig;e, ich w&uuml;rde es besser machen</p>\r\n<ul>\r\n	<li>\r\n		Dann schreib ihn selber ;-)</li>\r\n</ul>\r\n', '2011-04-07 00:40:30', '2011-04-17 14:09:59'),
(4, 'help', 'Hilfe', '<p>Hilfe</p>', '2011-04-07 00:48:23', '2011-04-07 00:48:23'),
(5, 'test', 'My Test Page', '<p>\r\n	This<br />\r\n	is<br />\r\n	my<br />\r\n	<b>TEST</b>-Page! |2|</p>\r\n', '2011-04-07 23:04:14', '2011-04-15 18:58:11');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `profiles`
--

CREATE TABLE IF NOT EXISTS `profiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `job_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Daten für Tabelle `profiles`
--

INSERT INTO `profiles` (`id`, `user_id`, `first_name`, `last_name`, `job_id`) VALUES
(1, 1, 'Admin', 'reNose', NULL),
(2, 2, 'Simon', '', 1),
(3, 3, 'Patrick', '', NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(40) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `created`, `modified`) VALUES
(1, 'admin@renose.de', '67ef003adb4b7da80cf36e17fad6260b94dbcb16', '2011-04-15 23:17:20', '2011-04-15 23:17:20'),
(2, 'simon@renose.de', '492a4d8fbf9da1a0aa036b948ff5cef09ce6b6eb', '2011-04-16 11:45:53', '2011-04-16 11:45:53'),
(3, 'patrick@renose.de', 'ead2222b5def6d0223d8685f38cc3736be8887bf', '2011-04-16 11:45:53', '2011-04-16 11:45:53'),
(4, 'unknown@renose.de', 'a190da62efb76d5b0b740d291655b0d1a483c321', '2011-04-16 12:57:17', '2011-04-16 12:57:17');
