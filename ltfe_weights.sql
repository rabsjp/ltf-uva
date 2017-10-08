-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 06, 2016 at 07:44 AM
-- Server version: 5.1.44
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ltfe_weights`
--

-- --------------------------------------------------------

--
-- Table structure for table `commonparameters`
--

CREATE TABLE IF NOT EXISTS `commonparameters` (
  `name` varchar(15) NOT NULL,
  `value` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `commonparameters`
--

INSERT INTO `commonparameters` (`name`, `value`) VALUES
('numbersubj', '6'),
('koers', '2600'),
('ronde', '10'),
('treatment', '1'),
('maxprice', '1000'),
('startexp', '0'),
('startquest', '0'),
('startinst', '0'),
('maxtijd1', '2'),
('interest_rate', '0.05'),
('dividend', '3.3'),
('maxtijd2', '1'),
('showup', '5'),
('test', '1'),
('expters', 'Kopanyi,Rabanal,Rud,Tuinstra'),
('expnummer', '999'),
('session', '1');

-- --------------------------------------------------------

--
-- Table structure for table `groepresults`
--

CREATE TABLE IF NOT EXISTS `groepresults` (
  `groep` int(4) NOT NULL,
  `round` int(4) NOT NULL,
  `prediction1` varchar(11) NOT NULL,
  `prediction2` varchar(11) NOT NULL,
  `prediction3` varchar(11) NOT NULL,
  `prediction4` varchar(11) NOT NULL,
  `prediction5` varchar(11) NOT NULL,
  `prediction6` varchar(11) NOT NULL,
  `marketprice` varchar(11) NOT NULL,
  `weight1` varchar(11) NOT NULL,
  `weight2` varchar(11) NOT NULL,
  `weight3` varchar(11) NOT NULL,
  `weight4` varchar(11) NOT NULL,
  `weight5` varchar(11) NOT NULL,
  `weight6` varchar(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



-- --------------------------------------------------------

--
-- Table structure for table `instructions`
--

CREATE TABLE IF NOT EXISTS `instructions` (
  `part` int(11) NOT NULL,
  `pagenumber` int(11) NOT NULL,
  `filename` varchar(100) NOT NULL,
  `nameinmenu` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `instructions`
--

INSERT INTO `instructions` (`part`, `pagenumber`, `filename`, `nameinmenu`) VALUES
(1, 0, 'instruction1.php', 'Instructions 1'),
(1, 1, 'instruction2.php', 'Instructions 2'),
(1, 2, 'instructionquestion1.php', 'Question 1'),
(1, 3, 'instructionquestion2.php', 'Question 2');
-- --------------------------------------------------------

--
-- Table structure for table `noise`
--

CREATE TABLE IF NOT EXISTS `noise` (
  `round` int(3) NOT NULL,
  `shock` decimal(11,3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `noise`
--

INSERT INTO `noise` (`round`, `shock`) VALUES
(1, -0.4318),
(2, 0.0387),
(3, -0.6071),
(4, -0.5568),
(5, -0.0034),
(6, 0.7663),
(7, -0.3848),
(8, 0.1857),
(9, -0.1128),
(10, 0.5587),
(11, -0.5445),
(12, 0.0163),
(13, 0.2763),
(14, 0.5503),
(15, 0.7721),
(16, 0.043),
(17, -0.7458),
(18, -0.3712),
(19, -0.5308),
(20, 1.1752),
(21, -0.3078),
(22, 0.374),
(23, -0.0962),
(24, 0.4443),
(25, -0.3824),
(26, -0.7011),
(27, -0.7112),
(28, 0.2441),
(29, -0.0887),
(30, -0.098),
(31, 0.7097),
(32, 0.1458),
(33, 0.0989),
(34, 0.7938),
(35, -0.4022),
(36, 0.3483),
(37, 0.4175),
(38, -0.1219),
(39, 0.1078),
(40, -0.5829),
(41, -0.574),
(42, 0.0524),
(43, 0.3611),
(44, 1.2927),
(45, -0.3334),
(46, 0.0937),
(47, -0.0412),
(48, -0.9665),
(49, -0.2195),
(50, -0.8973);



-- --------------------------------------------------------

--
-- Table structure for table `ppnummers`
--

CREATE TABLE IF NOT EXISTS `ppnummers` (
  `ppnr` varchar(11) NOT NULL,
  `tafelnummer` varchar(11) NOT NULL,
  `currentpage` varchar(160) NOT NULL,
  `neteuros` decimal(10,2) NOT NULL,
  `neteuros1` decimal(11,2) NOT NULL,
  `netearnings` int(11) NOT NULL,
  `round` int(11) NOT NULL,
  `sexe` varchar(11) NOT NULL,
  `vrijgemaakt1` int(11) NOT NULL,
  `vrijgemaakt2` int(11) NOT NULL,
  `prediction` decimal(10,2) NOT NULL,
  `timeout` int(2) NOT NULL,
  `leeftijd` int(11) NOT NULL,
  `fieldstudie` varchar(25) NOT NULL,
  `groep` varchar(11) NOT NULL,
  `pp2` int(6) NOT NULL,
  `pp3` int(6) NOT NULL,
  `counter` int(11) NOT NULL,
  `yearstudie` varchar(11) NOT NULL,
  `nationality` varchar(20) NOT NULL,
  `heardthis` varchar(11) NOT NULL,
  `partsimilar` varchar(11) NOT NULL,
  `vraag1` varchar(4) NOT NULL,
  `vraag2` varchar(4) NOT NULL,
  `vraag3` varchar(4) NOT NULL,
  `vraag4` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ppnummers`
--


-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE IF NOT EXISTS `results` (
  `ppnr` int(11) NOT NULL,
  `groep` varchar(11) NOT NULL,
  `round` int(11) NOT NULL,
  `roundearnings` varchar(11) NOT NULL,
  `marketprice` decimal(10,2) NOT NULL,
  `prediction` varchar(10) NOT NULL,
  `weight` decimal(10,5) NOT NULL,
  `timeout` int(2) NOT NULL,
  `netearnings` varchar(10) NOT NULL,
  `tijd` decimal(10,3) NOT NULL,
  `error` decimal(10,2) NOT NULL,
  `meanpred` decimal(10,5) NOT NULL,
  `boundary` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `results`
--


-- --------------------------------------------------------