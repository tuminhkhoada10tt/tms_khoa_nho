-- phpMyAdmin SQL Dump
-- version 4.0.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2014 at 09:50 AM
-- Server version: 5.5.31-log
-- PHP Version: 5.3.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `thgv`
--

-- --------------------------------------------------------

--
-- Table structure for table `attachments`
--

CREATE TABLE IF NOT EXISTS `attachments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `model` varchar(20) NOT NULL,
  `foreign_key` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `attachment` varchar(255) NOT NULL,
  `dir` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `size` int(11) DEFAULT '0',
  `active` tinyint(1) DEFAULT '1',
  `decription` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=44 ;

--
-- Dumping data for table `attachments`
--

INSERT INTO `attachments` (`id`, `model`, `foreign_key`, `name`, `attachment`, `dir`, `type`, `size`, `active`, `decription`) VALUES
(39, 'Chapter', 4, '', 'Muc ho tro C?V.xls', '39', 'application/vnd.ms-excel', 54272, 1, NULL),
(40, 'Chapter', 4, '', 'mylibrary.sql', '40', 'application/octet-stream', 387200, 1, NULL),
(42, 'Chapter', 6, '', 'Ke_hoach_thuc_hien_HTQL_PT_CTDT.docx', '42', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 42808, 1, NULL),
(43, 'Chapter', 6, '', 'admin_simlib.mdl', '43', 'application/octet-stream', 45057, 1, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
