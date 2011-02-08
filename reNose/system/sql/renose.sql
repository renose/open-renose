-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 08. Februar 2011 um 21:50
-- Server Version: 5.1.41
-- PHP-Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Datenbank: `renose`
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
  PRIMARY KEY (`username`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Daten für Tabelle `cms_users`
--

INSERT INTO `cms_users` (`id`, `username`, `mail`, `password`) VALUES
(1, 'SWW13', 'Simon@renose.de', '5fc7e38bffe00ca46add89145464a2eaf759d5c2'),
(2, 'patstylez', 'patrick@renose.de', '634320de0c8cf37fa366e8c0df5faf57ad2ab2f8');
