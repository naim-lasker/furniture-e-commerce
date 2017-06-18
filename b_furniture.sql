-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 23, 2014 at 08:54 PM
-- Server version: 5.5.38
-- PHP Version: 5.3.10-1ubuntu3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `b_furniture`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `c_id` int(5) NOT NULL AUTO_INCREMENT,
  `c_name` varchar(30) NOT NULL,
  PRIMARY KEY (`c_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`c_id`, `c_name`) VALUES
(1, 'Sofa'),
(2, 'Bed'),
(3, 'Table');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `c_id` int(5) NOT NULL,
  `name` varchar(30) NOT NULL,
  `price` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `c_id`, `name`, `price`) VALUES
(1, 1, 'Sofa (2+2+1)', 87000),
(2, 1, 'Sofa (2+2+1)', 82000),
(3, 1, 'Sofa (2+2+1)', 78000),
(4, 1, 'Sofa (2+2+1)', 85000),
(5, 3, 'Lotus Dining Table', 28000),
(6, 3, 'Unique Round Dining Table', 26000),
(7, 2, 'Butterfly Bed', 35000),
(8, 2, 'Daina Bed', 36000),
(9, 2, 'Dalia Bed', 33000),
(10, 2, 'Imperial Bed', 29000),
(11, 2, 'Jerin Bed', 43000),
(13, 2, 'Lotus Bed', 48000),
(14, 2, 'Magnolia Bed', 43000);

-- --------------------------------------------------------

--
-- Table structure for table `showroom`
--

CREATE TABLE IF NOT EXISTS `showroom` (
  `s_id` int(5) NOT NULL AUTO_INCREMENT,
  `district` varchar(30) NOT NULL,
  `location` varchar(200) NOT NULL,
  `contact_no` int(11) NOT NULL,
  PRIMARY KEY (`s_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `showroom`
--

INSERT INTO `showroom` (`s_id`, `district`, `location`, `contact_no`) VALUES
(1, 'Dhaka', '75, Kakrail Super Market (2nd floor), Kakrail, Dhaka.', 1711008855),
(2, 'Dhaka', '37, Rampura Market, Rampura, Dhaka.', 1844220055),
(3, 'Dhaka', '22, Sector 6, Uttara, Dhaka.', 1944882200),
(5, 'Dhaka', 'Y Market, Dhanmondi, Dhaka.', 1722885511);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `u_id` int(5) NOT NULL AUTO_INCREMENT,
  `uname` varchar(30) NOT NULL,
  `password` varchar(130) NOT NULL,
  PRIMARY KEY (`u_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`u_id`, `uname`, `password`) VALUES
(1, 'admin', 'd4047d3e56e6d6d63f7d16b85cd2fa88');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
