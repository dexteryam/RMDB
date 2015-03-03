-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 15, 2012 at 09:15 AM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `rmdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `listing`
--

DROP TABLE IF EXISTS `listing`;
CREATE TABLE IF NOT EXISTS `listing` (
  `ch_id` int(11) NOT NULL,
  `show_id` int(11) NOT NULL,
  `hour` int(11) NOT NULL,
  `min` varchar(2) NOT NULL,
  `am_pm` varchar(2) NOT NULL,
  `day` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `listing`
--

INSERT INTO `listing` (`ch_id`, `show_id`, `hour`, `min`, `am_pm`, `day`, `month`, `year`) VALUES
(4, 3, 1, '30', 'am', 12, 3, 2012),
(4, 3, 1, '30', 'am', 12, 3, 2012),
(1, 23, 6, '00', 'pm', 16, 2, 2012),
(1, 23, 7, '00', 'pm', 16, 2, 2012),
(2, 20, 6, '00', 'pm', 16, 2, 2012),
(2, 21, 6, '30', 'pm', 16, 2, 2012),
(3, 16, 6, '00', 'pm', 16, 2, 2012),
(3, 17, 6, '30', 'pm', 16, 2, 2012),
(3, 19, 7, '00', 'pm', 16, 2, 2012),
(2, 22, 7, '00', 'pm', 16, 2, 2012),
(1, 23, 7, '30', 'pm', 16, 2, 2012),
(2, 22, 7, '30', 'pm', 16, 2, 2012),
(3, 16, 7, '30', 'pm', 16, 2, 2012),
(1, 18, 11, '30', 'pm', 16, 2, 2012),
(2, 22, 11, '00', 'pm', 2, 16, 2012),
(1, 20, 3, '00', 'pm', 17, 2, 2012),
(3, 19, 3, '00', 'pm', 17, 2, 2012),
(2, 18, 3, '00', 'pm', 17, 2, 2012),
(2, 21, 10, '30', 'pm', 16, 2, 2012),
(2, 21, 11, '30', 'pm', 16, 2, 2012),
(3, 16, 11, '00', 'pm', 16, 2, 2012),
(3, 16, 11, '30', 'pm', 16, 2, 2012),
(2, 21, 11, '00', 'pm', 16, 2, 2012),
(3, 17, 10, '30', 'pm', 16, 2, 2012),
(1, 18, 11, '00', 'pm', 16, 2, 2012),
(1, 23, 10, '30', 'pm', 16, 2, 2012),
(1, 23, 9, '00', 'pm', 15, 2, 2012),
(1, 23, 9, '30', 'pm', 15, 2, 2012),
(2, 20, 9, '00', 'pm', 15, 2, 2012),
(2, 43, 8, '00', 'pm', 16, 2, 2012),
(4, 3, 1, '30', 'am', 12, 2, 2012),
(4, 3, 1, '30', 'am', 12, 2, 2012),
(1, 23, 6, '00', 'pm', 16, 2, 2012),
(1, 23, 7, '00', 'pm', 16, 2, 2012),
(2, 20, 6, '00', 'pm', 16, 2, 2012),
(2, 21, 6, '30', 'pm', 16, 2, 2012),
(3, 16, 6, '00', 'pm', 16, 2, 2012),
(3, 17, 6, '30', 'pm', 16, 2, 2012),
(3, 19, 7, '00', 'pm', 16, 2, 2012),
(2, 22, 7, '00', 'pm', 16, 2, 2012),
(1, 23, 7, '30', 'pm', 16, 2, 2012),
(2, 22, 7, '30', 'pm', 16, 2, 2012),
(3, 16, 7, '30', 'pm', 16, 2, 2012),
(1, 18, 11, '30', 'pm', 16, 2, 2012),
(2, 22, 11, '00', 'pm', 2, 16, 2012),
(1, 20, 3, '00', 'pm', 17, 2, 2012),
(3, 19, 3, '00', 'pm', 17, 2, 2012),
(2, 18, 3, '00', 'pm', 17, 2, 2012),
(2, 21, 10, '30', 'pm', 16, 2, 2012),
(2, 21, 11, '30', 'pm', 16, 2, 2012),
(3, 16, 11, '00', 'pm', 16, 2, 2012),
(3, 16, 11, '30', 'pm', 16, 2, 2012),
(2, 21, 11, '00', 'pm', 16, 2, 2012),
(3, 17, 10, '30', 'pm', 16, 2, 2012),
(1, 18, 11, '00', 'pm', 16, 2, 2012),
(1, 23, 10, '30', 'pm', 16, 2, 2012),
(1, 23, 9, '00', 'pm', 15, 2, 2012),
(1, 23, 9, '30', 'pm', 15, 2, 2012),
(2, 20, 9, '00', 'pm', 15, 2, 2012),
(1, 23, 2, '00', 'pm', 15, 3, 2012),
(1, 23, 2, '30', 'pm', 15, 3, 2012),
(1, 19, 3, '00', 'pm', 15, 3, 2012),
(1, 18, 3, '30', 'pm', 15, 3, 2012),
(2, 21, 2, '00', 'pm', 15, 3, 2012),
(2, 21, 2, '30', 'pm', 15, 3, 2012),
(2, 22, 3, '00', 'pm', 15, 3, 2012),
(3, 16, 2, '30', 'pm', 15, 3, 2012),
(3, 17, 3, '00', 'pm', 15, 3, 2012),
(1, 18, 4, '00', 'pm', 15, 3, 2012),
(1, 16, 4, '30', 'pm', 15, 3, 2012),
(2, 16, 3, '30', 'pm', 15, 3, 2012),
(2, 19, 4, '00', 'pm', 15, 3, 2012),
(3, 22, 3, '30', 'pm', 15, 3, 2012),
(1, 16, 1, '00', 'pm', 16, 3, 2012),
(2, 17, 2, '30', 'pm', 14, 3, 2012);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
