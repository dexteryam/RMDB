
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
  `weekday` enum('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday') NOT NULL,
  `day` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `listing`
--

INSERT INTO `listing` (`ch_id`, `show_id`, `hour`, `min`, `am_pm`, `weekday`, `day`, `month`, `year`) VALUES
(4, 3, 1, '30', 'am', 'Monday', 12, 2, 2012),
(4, 3, 1, '30', 'am', 'Monday', 12, 2, 2012),
(1, 23, 6, '00', 'pm', 'Friday', 16, 2, 2012),
(1, 23, 7, '00', 'pm', 'Friday', 16, 2, 2012),
(2, 20, 6, '00', 'pm', 'Friday', 16, 2, 2012),
(2, 21, 6, '30', 'pm', 'Friday', 16, 2, 2012),
(3, 16, 6, '00', 'pm', 'Friday', 16, 2, 2012),
(3, 17, 6, '30', 'pm', 'Friday', 16, 2, 2012),
(3, 19, 7, '00', 'pm', 'Friday', 16, 2, 2012),
(2, 22, 7, '00', 'pm', 'Friday', 16, 2, 2012),
(1, 23, 7, '30', 'pm', 'Friday', 16, 2, 2012),
(2, 22, 7, '30', 'pm', 'Friday', 16, 2, 2012),
(3, 16, 7, '30', 'pm', 'Friday', 16, 2, 2012),
(1, 18, 11, '30', 'pm', 'Friday', 16, 2, 2012),
(2, 22, 11, '00', 'pm', 'Friday', 16, 2, 2012),
(1, 20, 3, '00', 'pm', 'Saturday', 17, 2, 2012),
(3, 19, 3, '00', 'pm', 'Saturday', 17, 2, 2012),
(2, 18, 3, '00', 'pm', 'Saturday', 17, 2, 2012),
(2, 21, 10, '30', 'pm', 'Friday', 16, 2, 2012),
(2, 21, 11, '30', 'pm', 'Friday', 16, 2, 2012),
(3, 16, 11, '00', 'pm', 'Friday', 16, 2, 2012),
(3, 16, 11, '30', 'pm', 'Friday', 16, 2, 2012),
(2, 21, 11, '00', 'pm', 'Friday', 16, 2, 2012),
(3, 17, 10, '30', 'pm', 'Friday', 16, 2, 2012),
(1, 18, 11, '00', 'pm', 'Friday', 16, 2, 2012),
(1, 23, 10, '30', 'pm', 'Friday', 16, 2, 2012),
(1, 23, 9, '00', 'pm', 'Thursday', 15, 2, 2012),
(1, 23, 9, '30', 'pm', 'Thursday', 15, 2, 2012),
(2, 20, 9, '00', 'pm', 'Thursday', 15, 2, 2012),
(2, 43, 8, '00', 'pm', 'Friday', 16, 2, 2012),
(4, 3, 1, '30', 'am', 'Monday', 12, 2, 2012),
(4, 3, 1, '30', 'am', 'Monday', 12, 2, 2012),
(1, 23, 6, '00', 'pm', 'Friday', 16, 2, 2012),
(1, 23, 7, '00', 'pm', 'Friday', 16, 2, 2012),
(2, 20, 6, '00', 'pm', 'Friday', 16, 2, 2012),
(2, 21, 6, '30', 'pm', 'Friday', 16, 2, 2012),
(3, 16, 6, '00', 'pm', 'Friday', 16, 2, 2012),
(3, 17, 6, '30', 'pm', 'Friday', 16, 2, 2012),
(3, 19, 7, '00', 'pm', 'Friday', 16, 2, 2012),
(2, 22, 7, '00', 'pm', 'Friday', 16, 2, 2012),
(1, 23, 7, '30', 'pm', 'Friday', 16, 2, 2012),
(2, 22, 7, '30', 'pm', 'Friday', 16, 2, 2012),
(3, 16, 7, '30', 'pm', 'Friday', 16, 2, 2012),
(1, 18, 11, '30', 'pm', 'Friday', 16, 2, 2012),
(2, 22, 11, '00', 'pm', 'Friday', 2, 16, 2012),
(1, 20, 3, '00', 'pm', 'Friday', 17, 2, 2012),
(3, 19, 3, '00', 'pm', 'Wednesday', 14, 2, 2012),
(2, 18, 3, '00', 'pm', 'Wednesday', 14, 2, 2012),
(2, 21, 10, '30', 'pm', 'Tuesday', 13, 2, 2012),
(2, 21, 11, '30', 'pm', 'Friday', 16, 2, 2012),
(3, 16, 11, '00', 'pm', 'Friday', 16, 2, 2012),
(3, 16, 11, '30', 'pm', 'Friday', 16, 2, 2012),
(2, 21, 11, '00', 'pm', 'Friday', 16, 2, 2012),
(3, 17, 10, '30', 'pm', 'Friday', 16, 2, 2012),
(1, 18, 11, '00', 'pm', 'Friday', 16, 2, 2012),
(1, 23, 10, '30', 'pm', 'Friday', 16, 2, 2012),
(1, 23, 9, '00', 'pm', 'Thursday', 15, 2, 2012),
(1, 23, 9, '30', 'pm', 'Thursday', 15, 2, 2012),
(2, 20, 9, '00', 'pm', 'Thursday', 15, 2, 2012);

