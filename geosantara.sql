-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 11, 2015 at 03:49 PM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `geosantara`
--

-- --------------------------------------------------------

--
-- Table structure for table `msclue`
--

CREATE TABLE IF NOT EXISTS `msclue` (
  `ClueID` char(5) NOT NULL,
  `Clue` varchar(500) NOT NULL,
  `Answer` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `msclue`
--

INSERT INTO `msclue` (`ClueID`, `Clue`, `Answer`) VALUES
('CL000', 'Monas', 'Gambir, Central Jakarta City'),
('CL001', 'Batam', 'Batam, Riau Islands');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `msclue`
--
ALTER TABLE `msclue`
 ADD PRIMARY KEY (`ClueID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
