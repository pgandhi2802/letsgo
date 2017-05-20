-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 23, 2013 at 05:24 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `letsgo`
--

-- --------------------------------------------------------

--
-- Table structure for table `available`
--

CREATE TABLE IF NOT EXISTS `available` (
  `bus_id` int(11) DEFAULT NULL,
  `route_id` int(11) DEFAULT NULL,
  `seat_available` int(3) DEFAULT NULL,
  `date` date DEFAULT NULL,
  UNIQUE KEY `bus_id` (`bus_id`,`route_id`,`date`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `available`
--

INSERT INTO `available` (`bus_id`, `route_id`, `seat_available`, `date`) VALUES
(1, 1, 45, '2013-11-25'),
(2, 2, 45, '2013-11-25'),
(1, 2, 45, '2013-11-26'),
(2, 1, 45, '2013-11-26'),
(3, 3, 45, '2013-11-25'),
(3, 4, 45, '2013-11-26'),
(4, 4, 45, '2013-11-25'),
(4, 3, 45, '2013-11-26'),
(5, 5, 40, '2013-11-26'),
(5, 6, 40, '2013-11-27'),
(6, 6, 40, '2013-11-26'),
(6, 5, 40, '2013-11-27');

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE IF NOT EXISTS `branch` (
  `branch_name` varchar(20) NOT NULL,
  `contact_no` varchar(15) DEFAULT NULL,
  `address1` varchar(30) DEFAULT NULL,
  `address2` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`branch_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`branch_name`, `contact_no`, `address1`, `address2`) VALUES
('Bhopal', '07556060606', '1, 1st Floor, Lahoti ', 'Complex, Zone 1, M P Nagar'),
('Gwalior', '0751-224588', 'topi bazar', 'maharaj bada'),
('Indore', '0731-2597799', 'G-3,Golden Palace, N', 'Bengali Square,Indor'),
('jabalpur', '094 25 412742', 'H-09, Krishi Nagar Colony', 'Adhartal, '),
('Kota', '0744-2471320', 'Near Tt Hospital Tal', 'Kota-6');

-- --------------------------------------------------------

--
-- Table structure for table `bus`
--

CREATE TABLE IF NOT EXISTS `bus` (
  `bus_id` int(11) NOT NULL AUTO_INCREMENT,
  `bus_no` varchar(15) DEFAULT NULL,
  `max_seat` int(3) DEFAULT NULL,
  PRIMARY KEY (`bus_id`),
  UNIQUE KEY `bus_no` (`bus_no`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `bus`
--

INSERT INTO `bus` (`bus_id`, `bus_no`, `max_seat`) VALUES
(1, 'MP07-5874', 45),
(2, 'MP07-4789', 45),
(3, 'MP07-4563', 45),
(4, 'MP07-8974', 45),
(5, 'MP07-0564', 40),
(6, 'MP07-7964', 40);

-- --------------------------------------------------------

--
-- Table structure for table `route`
--

CREATE TABLE IF NOT EXISTS `route` (
  `route_id` int(11) NOT NULL AUTO_INCREMENT,
  `city_from` varchar(20) DEFAULT NULL,
  `city_to` varchar(20) DEFAULT NULL,
  `departure_time` time DEFAULT NULL,
  `time_travel` time DEFAULT NULL,
  `fare` int(5) DEFAULT NULL,
  PRIMARY KEY (`route_id`),
  UNIQUE KEY `city_from` (`city_from`,`city_to`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `route`
--

INSERT INTO `route` (`route_id`, `city_from`, `city_to`, `departure_time`, `time_travel`, `fare`) VALUES
(1, 'kota', 'gwalior', '08:30:00', '08:50:00', 450),
(2, 'gwalior', 'kota', '08:30:00', '08:50:00', 450),
(3, 'gwalior', 'indore', '06:00:00', '12:00:00', 450),
(4, 'indore', 'gwalior', '06:00:00', '12:00:00', 450),
(5, 'gwalior', 'bhopal', '07:00:00', '15:00:00', 700),
(6, 'bhopal', 'gwalior', '07:00:00', '15:00:00', 700),
(7, 'gwalior', 'jabalpur', '17:00:00', '10:00:00', 600),
(8, 'jabalpur', 'gwalior', '17:00:00', '10:00:00', 600);

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE IF NOT EXISTS `ticket` (
  `ticket_id` int(11) NOT NULL AUTO_INCREMENT,
  `bill_no` int(10) NOT NULL,
  `route_id` int(11) DEFAULT NULL,
  `bus_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `city_from` varchar(20) DEFAULT NULL,
  `city_to` varchar(20) DEFAULT NULL,
  `bus_no` varchar(15) DEFAULT NULL,
  `fname` varchar(20) DEFAULT NULL,
  `lname` varchar(20) DEFAULT NULL,
  `gender` varchar(7) NOT NULL,
  `age` int(2) DEFAULT NULL,
  `date_travel` date DEFAULT NULL,
  `seat_no` int(3) DEFAULT NULL,
  `ammount` int(5) DEFAULT NULL,
  PRIMARY KEY (`ticket_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`ticket_id`, `bill_no`, `route_id`, `bus_id`, `user_id`, `city_from`, `city_to`, `bus_no`, `fname`, `lname`, `gender`, `age`, `date_travel`, `seat_no`, `ammount`) VALUES
(27, 1, 3, 4, 4, 'gwalior', 'indore', 'MP07-8974', 'piyush', 'gandhi', 'male', 19, '2013-11-26', 1, 450),
(28, 1, 3, 4, 4, 'gwalior', 'indore', 'MP07-8974', 'shubham', 'joshi', 'male', 20, '2013-11-26', 2, 450);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(20) DEFAULT NULL,
  `pass` varchar(20) DEFAULT NULL,
  `fname` varchar(15) DEFAULT NULL,
  `lname` varchar(15) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `contact` varchar(15) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user` (`user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user`, `pass`, `fname`, `lname`, `email`, `contact`) VALUES
(4, 'p.gandhi2802', '9098081893', 'piyush', 'gandhi', 'p.gandhi2802@yahoo.in', '9098081893');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
