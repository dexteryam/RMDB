-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 09, 2012 at 02:13 AM
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
-- Table structure for table `cast`
--

DROP TABLE IF EXISTS `cast`;
CREATE TABLE IF NOT EXISTS `cast` (
  `actor_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `show_id` int(11) NOT NULL,
  `birth_date` date NOT NULL,
  UNIQUE KEY `actor_id` (`actor_id`,`show_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cast`
--

INSERT INTO `cast` (`actor_id`, `name`, `show_id`, `birth_date`) VALUES
(1, 'Paul Newman', 3, '0000-00-00'),
(2, 'Denzel Washington', 4, '0000-00-00'),
(3, 'Will Smith', 4, '1968-03-08'),
(4, 'Zoe Saldana', 4, '0000-00-00'),
(5, 'Betty White', 5, '0000-00-00'),
(6, 'Ashton Kutcher', 5, '0000-00-00'),
(7, 'Rooney Mara', 2, '0000-00-00'),
(8, 'Daniel Craig', 2, '0000-00-00'),
(9, 'Christopher Plummer', 2, '0000-00-00'),
(10, 'Stellan Skarsgard', 2, '0000-00-00'),
(11, 'Steven Berkoff', 2, '0000-00-00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
