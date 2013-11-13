-- phpMyAdmin SQL Dump
-- version 3.3.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 10, 2012 at 06:19 PM
-- Server version: 5.1.60
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `crm`
--

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE IF NOT EXISTS `cities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `state_id` int(11) NOT NULL,
  `name` text COLLATE utf8_unicode_ci,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `cities`
--


-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE IF NOT EXISTS `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `prospect_id` int(11) NOT NULL,
  `subject` text COLLATE utf8_unicode_ci,
  `comments` text COLLATE utf8_unicode_ci,
  `date` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `events`
--


-- --------------------------------------------------------

--
-- Table structure for table `genders`
--

CREATE TABLE IF NOT EXISTS `genders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gender` varchar(15) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `genders`
--

INSERT INTO `genders` (`id`, `gender`) VALUES
(1, 'Hombre'),
(2, 'Mujer');

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE IF NOT EXISTS `media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `medium_category_id` int(11) NOT NULL,
  `name` text COLLATE utf8_unicode_ci,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `medium_category_id`, `name`, `created`, `updated`) VALUES
(1, 1, 'Desconocido', '2010-11-18 13:03:53', '2010-12-06 20:24:40'),
(2, 1, 'Sitio', '2010-11-18 13:04:03', '2010-11-18 13:04:03'),
(3, 1, 'Google', '2010-12-16 16:25:51', '2010-12-16 16:25:51');

-- --------------------------------------------------------

--
-- Table structure for table `medium_categories`
--

CREATE TABLE IF NOT EXISTS `medium_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8_unicode_ci,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `medium_categories`
--

INSERT INTO `medium_categories` (`id`, `name`, `created`, `updated`) VALUES
(1, 'Internet', '2010-11-18 13:03:42', '2010-11-18 13:03:42');

-- --------------------------------------------------------

--
-- Table structure for table `origins`
--

CREATE TABLE IF NOT EXISTS `origins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8_unicode_ci,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `origins`
--

INSERT INTO `origins` (`id`, `name`, `created`, `updated`) VALUES
(1, 'Medios', '2010-11-18 12:35:22', '2010-12-06 20:36:22'),
(2, 'Internet', '2010-12-06 20:36:30', '2010-12-06 20:36:30'),
(4, 'CRM', '2012-12-10 12:25:26', '2012-12-10 12:25:29');

-- --------------------------------------------------------

--
-- Table structure for table `places`
--

CREATE TABLE IF NOT EXISTS `places` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8_unicode_ci,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `places`
--

INSERT INTO `places` (`id`, `name`, `created`, `updated`) VALUES
(4, 'Marketing', '2011-09-21 17:59:03', '2012-11-05 18:07:14');

-- --------------------------------------------------------

--
-- Table structure for table `prospects`
--

CREATE TABLE IF NOT EXISTS `prospects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `place_id` int(11) DEFAULT NULL,
  `origin_id` int(11) DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `medium_id` int(11) DEFAULT NULL,
  `state_id` int(11) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `gender_id` int(11) DEFAULT NULL,
  `name` text COLLATE utf8_unicode_ci,
  `apellido_paterno` text COLLATE utf8_unicode_ci,
  `apellido_materno` text COLLATE utf8_unicode_ci,
  `email` text COLLATE utf8_unicode_ci,
  `area_code` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lada` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `phone_number` text COLLATE utf8_unicode_ci,
  `mobile_number` text COLLATE utf8_unicode_ci,
  `ip` text COLLATE utf8_unicode_ci,
  `referer` text COLLATE utf8_unicode_ci,
  `comments` text COLLATE utf8_unicode_ci,
  `fecha` date DEFAULT NULL,
  `assignation_date` datetime DEFAULT NULL,
  `first_contact_date` datetime DEFAULT NULL,
  `last_contact_date` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `prospects`
--


-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE IF NOT EXISTS `states` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8_unicode_ci,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `states`
--


-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

CREATE TABLE IF NOT EXISTS `statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status_category_id` int(11) NOT NULL,
  `name` text COLLATE utf8_unicode_ci,
  `priority` int(11) NOT NULL,
  `slack_days` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=29 ;

--
-- Dumping data for table `statuses`
--

INSERT INTO `statuses` (`id`, `status_category_id`, `name`, `priority`, `slack_days`, `created`, `updated`) VALUES
(1, 1, 'Interesado', 0, 0, '2010-11-18 11:56:05', '2010-11-18 11:56:05'),
(2, 1, 'No interesado', 0, 0, '2010-11-18 11:56:20', '2010-11-18 11:56:21'),
(3, 1, 'Hacer Nueva llamada', 0, 0, '2010-11-18 11:56:33', '2011-09-12 14:54:17'),
(4, 1, 'Interesado en visitar', 0, 0, '2010-11-18 11:56:59', '2010-12-16 01:58:56'),
(26, 5, 'Activada', 0, 0, '2012-10-31 17:40:20', '2012-10-31 17:40:20'),
(6, 2, 'Recado familiar', 0, 0, '2010-11-18 11:57:34', '2010-11-18 11:57:34'),
(7, 2, 'No se encuentra', 0, 0, '2010-11-18 11:57:45', '2010-11-18 11:57:45'),
(8, 3, 'No contestan', 0, 0, '2010-11-18 11:58:03', '2010-11-18 11:58:03'),
(9, 3, 'Teléfono ocupado', 0, 0, '2010-11-18 11:58:12', '2010-11-18 11:58:13'),
(10, 4, 'Datos falsos', 0, 0, '2010-11-18 11:58:23', '2010-11-18 11:58:23'),
(11, 4, 'Pruebas', 0, 0, '2010-11-18 11:58:40', '2012-11-13 10:07:28'),
(12, 4, 'Teléfono y mail no existen', 0, 0, '2010-11-18 11:58:54', '2010-11-18 11:58:54'),
(21, 1, 'Contactado por mail', 0, 0, '2011-11-15 12:20:51', '2011-11-15 12:20:51'),
(15, 4, 'Duplicado', 0, 0, '2011-01-20 04:08:12', '2012-11-13 10:05:27'),
(16, 3, 'Mail enviado', 0, 0, '2011-01-31 14:16:45', '2011-01-31 14:16:45'),
(17, 1, 'En cotización', 0, 0, '2011-08-09 15:15:09', '2011-08-09 15:15:09'),
(18, 1, 'Visita realizada', 0, 0, '2011-09-12 14:55:09', '2011-09-12 14:55:09'),
(27, 1, 'Sin cobertura', 0, 0, '2012-11-26 12:01:52', '2012-11-26 12:01:52'),
(20, 5, 'No se cerró cotización', 0, 0, '2011-09-12 14:57:10', '2011-09-12 15:07:47'),
(25, 5, 'Aprobada', 0, 0, '2012-10-31 17:40:03', '2012-10-31 17:40:03'),
(24, 5, 'Cita', 0, 0, '2012-10-31 17:39:32', '2012-10-31 17:39:32'),
(28, 3, 'Sin contacto alguno', 0, 0, '2012-11-26 12:06:01', '2012-11-26 12:06:01');

-- --------------------------------------------------------

--
-- Table structure for table `status_categories`
--

CREATE TABLE IF NOT EXISTS `status_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8_unicode_ci,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `status_categories`
--

INSERT INTO `status_categories` (`id`, `name`, `created`, `updated`) VALUES
(1, 'Contacto Establecido', '2010-11-18 11:46:06', '2010-11-18 11:46:07'),
(2, 'Contacto Recado', '2010-11-18 11:46:26', '2010-11-18 11:46:25'),
(3, 'Sin Contacto Aún', '2010-11-18 11:47:41', '2010-11-18 11:47:41'),
(4, 'Datos Falsos', '2010-11-18 11:47:55', '2012-11-13 10:04:37'),
(5, 'Venta', '2010-11-24 17:33:03', '2010-11-24 17:33:03');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `place_id` int(11) NOT NULL,
  `name` text COLLATE utf8_unicode_ci,
  `username` text COLLATE utf8_unicode_ci,
  `password` text COLLATE utf8_unicode_ci,
  `email` text COLLATE utf8_unicode_ci,
  `area_code` text COLLATE utf8_unicode_ci,
  `phone_number` text COLLATE utf8_unicode_ci,
  `active` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=37 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `place_id`, `name`, `username`, `password`, `email`, `area_code`, `phone_number`, `active`, `created`, `updated`, `level`) VALUES
(3, 1, 'admin', 'admin', 'd6f69fb5c4a37e5f305f46dc367a98ff47cd0e04', 'iram@clicker360.com', '55', '58070748', 1, '2011-11-15 15:59:25', '2012-06-12 23:46:08', 4);
