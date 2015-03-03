-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 15, 2012 at 07:46 PM
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

--
-- Dumping data for table `shows`
--

INSERT INTO `shows` (`id`, `name`, `release_date`, `popularity`, `url`, `description`, `studio`, `type`, `avg_rating`, `genre`) VALUES
(1, 'The Grey', '2012-01-27', 5, 'img/thegrey.jpg', 'In Alaska, an oil drilling team struggle to survive after a plane crash strands them in the wild. Hunting the humans are a pack of wolves who see them as intruders. ', 'Mr. Studio', 'MOVIE', 3, 'Action'),
(2, 'The Girl with the Dragon Tattoo', '2011-12-20', 5, 'img/girldragontattoo.jpg', 'Journalist Mikael Blomkvist is aided in his search for a woman who has been missing for forty years by Lisbeth Salander, a young computer hacker. ', 'Mr. Studio', 'MOVIE', 0, ''),
(3, 'MovieA', '2012-01-27', 5, 'img/MovieA.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas eget purus est, quis ullamcorper urna. ', 'Mr. Studio', 'MOVIE', 0, 'Comedy'),
(4, 'MovieB', '2012-02-27', 3, 'img/MovieB.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas eget purus est, quis ullamcorper urna. ', 'Mr. Studio', 'MOVIE', 0, 'Horror'),
(5, 'MovieC', '2012-03-27', 5, 'img/MovieC.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas eget purus est, quis ullamcorper urna. ', 'Mr. Studio', 'MOVIE', 5, 'Romance'),
(6, 'MovieD', '2012-04-27', 5, 'img/MovieD.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas eget purus est, quis ullamcorper urna. ', 'Mr. Studio', 'MOVIE', 0, ''),
(7, 'MovieE', '2012-05-27', 5, 'img/MovieE.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas eget purus est, quis ullamcorper urna. ', 'Mr. Studio', 'MOVIE', 4, ''),
(8, 'MovieF', '2012-06-27', 5, 'img/MovieF.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas eget purus est, quis ullamcorper urna. ', 'Mr. Studio', 'MOVIE', 0, ''),
(9, 'MovieG', '2012-07-27', 3, 'img/MovieG.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas eget purus est, quis ullamcorper urna. ', 'Mr. Studio', 'MOVIE', 0, ''),
(10, 'MovieH', '2012-04-27', 5, 'img/MovieD.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas eget purus est, quis ullamcorper urna. ', 'Mr. Studio', 'MOVIE', 0, ''),
(11, 'MovieI', '2012-05-27', 5, 'img/MovieE.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas eget purus est, quis ullamcorper urna. ', 'Mr. Studio', 'MOVIE', 0, ''),
(12, 'MovieJ', '2012-06-27', 5, 'img/MovieF.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas eget purus est, quis ullamcorper urna. ', 'Mr. Studio', 'MOVIE', 0, ''),
(13, 'MovieK', '2012-07-27', 5, 'img/MovieG.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas eget purus est, quis ullamcorper urna. ', 'Mr. Studio', 'MOVIE', 0, ''),
(14, 'MovieL', '2012-02-27', 2, 'img/MovieB.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas eget purus est, quis ullamcorper urna. ', 'Mr. Studio', 'MOVIE', 0, ''),
(15, 'MovieM', '2012-03-27', 5, 'img/MovieC.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas eget purus est, quis ullamcorper urna. ', 'Mr. Studio', 'MOVIE', 0, ''),
(16, 'ShowA', '2012-01-27', 5, 'img/MovieA.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas eget purus est, quis ullamcorper urna. ', 'Mr. Studio', 'TV', 0, ''),
(17, 'ShowB', '2012-01-27', 5, 'img/MovieB.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas eget purus est, quis ullamcorper urna. ', 'Mr. Studio', 'TV', 0, ''),
(18, 'The IT Crowd', '2012-06-27', 5, 'img/MovieF.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas eget purus est, quis ullamcorper urna. ', 'Mr. Studio', 'TV', 0, ''),
(19, 'How I Met Your Mother', '2012-07-27', 5, 'img/MovieG.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas eget purus est, quis ullamcorper urna. ', 'Mr. Studio', 'TV', 0, ''),
(20, 'The Big Bang Theory', '2012-02-27', 2, 'img/MovieB.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas eget purus est, quis ullamcorper urna. ', 'Mr. Studio', 'TV', 0, ''),
(21, 'That 70s Show', '2012-03-27', 5, 'img/MovieC.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas eget purus est, quis ullamcorper urna. ', 'Mr. Studio', 'TV', 0, ''),
(22, 'Desperate Housewives', '2012-04-27', 5, 'img/MovieD.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas eget purus est, quis ullamcorper urna. ', 'Mr. Studio', 'TV', 0, ''),
(23, 'Arrested Development', '2012-05-27', 5, 'img/MovieE.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas eget purus est, quis ullamcorper urna. ', 'Mr. Studio', 'TV', 0, ''),
(40, 'Game of Thrones', '2011-04-17', 0, 'img/MovieA.png', 'Game of Thrones is an American medieval fantasy television series created for HBO by David Benioff and D. B. Weiss. ', 'HBO', 'TV', 5, ''),
(43, 'Bakemonogatari', '2009-07-03', 0, 'img/thegrey.jpg', 'Bakemonogatari centers on Koyomi Araragi, a third year high school student who is almost human again after briefly becoming a vampire.', 'SHAFT', 'TV', 5, '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
