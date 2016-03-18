-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 18, 2016 at 08:02 PM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `crud_tutorial`
--

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE IF NOT EXISTS `students` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `dept` varchar(100) NOT NULL,
  `roll` int(11) NOT NULL,
  `session` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` varchar(100) NOT NULL,
  `image` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `dept`, `roll`, `session`, `email`, `mobile`, `image`) VALUES
(7, 'rasel', 'asrf', 5423, 'sdfg', 'amirul@gmail.com', 'afdsga', 'Chrysanthemum.jpg'),
(8, 'amiru', 'asd', 1202124, '2345', 'amirul.csejust@gmail.com', '235563', 'Koala.jpg'),
(11, 'amirul', 'CSE', 121212, '1212121', 'sumapme@gmail.com', '1432166647', 'input.png'),
(12, 'rahim', 'cse', 12112, '2345', 'rahim@gamil.com', '+0172285858', 'Chrysanthemum.jpg');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
