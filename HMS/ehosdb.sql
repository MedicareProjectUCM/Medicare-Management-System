-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 17, 2015 at 03:24 PM
-- Server version: 5.5.36
-- PHP Version: 5.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ehosdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE IF NOT EXISTS `complaints` (
  `cid` int(10) NOT NULL AUTO_INCREMENT,
  `splid` varchar(10) NOT NULL,
  `did` varchar(10) NOT NULL,
  `pid` varchar(10) NOT NULL,
  `symptoms` varchar(100) NOT NULL,
  `mcareid` varchar(10) NOT NULL,
  `cdate` date NOT NULL,
  `tests` varchar(60) DEFAULT NULL,
  `medicines` varchar(100) NOT NULL,
  PRIMARY KEY (`cid`),
  KEY `did_cid` (`did`),
  KEY `splid_cid` (`splid`),
  KEY `pid_cid` (`pid`),
  KEY `mid_cid` (`mcareid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `complaints`
--

INSERT INTO `complaints` (`cid`, `splid`, `did`, `pid`, `symptoms`, `mcareid`, `cdate`, `tests`, `medicines`) VALUES
(1, '', '1', '2', 'aa pain', '1', '2015-04-14', '', ''),
(2, '', '2', '2', 'aaaa', '', '2015-04-15', NULL, ''),
(4, '', '1', '2', 'zxvz', '1', '2015-04-15', 'vvvv', 'xxx'),
(5, '', '1', '2', 'dddd', '1', '2015-04-17', 'vvvv', 'xxx'),
(6, '', '3', '2', 'head ache', '1', '2015-04-17', '', 'paracetamol'),
(7, '', '1', '2', 'aaaaaaaaaaaa', '', '2015-04-17', NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE IF NOT EXISTS `doctor` (
  `did` int(10) NOT NULL AUTO_INCREMENT,
  `dname` varchar(60) NOT NULL,
  `spl` varchar(20) NOT NULL,
  `qual` varchar(20) NOT NULL,
  `addr` varchar(60) NOT NULL,
  `dpno` int(12) NOT NULL,
  `email` varchar(60) NOT NULL,
  PRIMARY KEY (`did`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`did`, `dname`, `spl`, `qual`, `addr`, `dpno`, `email`) VALUES
(1, 'doctor', 'surgen', 'MD', 'AAA', 2147483647, 'gopivanam@gmail.com'),
(3, 'doc', 'phy', 'MD', 'hyd', 2147483647, 'doct@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `medicare`
--

CREATE TABLE IF NOT EXISTS `medicare` (
  `mcareid` int(10) NOT NULL AUTO_INCREMENT,
  `mname` varchar(20) NOT NULL,
  `spl` varchar(20) NOT NULL,
  `mpno` int(12) NOT NULL,
  `mmail` varchar(60) NOT NULL,
  PRIMARY KEY (`mcareid`),
  KEY `splid_fk` (`spl`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `medicare`
--

INSERT INTO `medicare` (`mcareid`, `mname`, `spl`, `mpno`, `mmail`) VALUES
(1, 'med', 'scan', 2147483647, 'jayachandra02@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE IF NOT EXISTS `patient` (
  `pid` int(10) NOT NULL AUTO_INCREMENT,
  `pname` varchar(20) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `age` int(3) NOT NULL,
  `addr` varchar(60) NOT NULL,
  `ppno` int(12) NOT NULL,
  `pmail` varchar(60) NOT NULL,
  `ptype` varchar(1) NOT NULL,
  `did` varchar(10) NOT NULL,
  PRIMARY KEY (`pid`),
  KEY `did_pid_fk` (`did`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`pid`, `pname`, `gender`, `age`, `addr`, `ppno`, `pmail`, `ptype`, `did`) VALUES
(1, 'ram', 'm', 20, 'SSS', 2147483647, 'crystalitetechnologies@gmail.com', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tresults`
--

CREATE TABLE IF NOT EXISTS `tresults` (
  `rid` int(10) NOT NULL AUTO_INCREMENT,
  `cid` int(10) NOT NULL,
  `test_name` varchar(60) NOT NULL,
  `tdate` date NOT NULL,
  `result` varchar(60) NOT NULL,
  `notes` varchar(10) NOT NULL,
  `tfilepath` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`rid`),
  KEY `cid_r` (`cid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tresults`
--

INSERT INTO `tresults` (`rid`, `cid`, `test_name`, `tdate`, `result`, `notes`, `tfilepath`) VALUES
(1, 1, '', '0000-00-00', '', '', 'hello1.txt'),
(2, 4, 'vvvv', '2015-04-17', '', '', 'sample.txt'),
(3, 5, 'vvvv', '2015-04-17', '', '', 'Advanced.pdf'),
(5, 6, '', '0000-00-00', '', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(20) NOT NULL,
  `pass_word` varchar(16) NOT NULL,
  `did` int(10) DEFAULT NULL,
  `pid` int(10) DEFAULT NULL,
  `mcareid` int(10) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_name` (`user_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `pass_word`, `did`, `pid`, `mcareid`) VALUES
(1, 'doctor', 'doctor', 1, NULL, NULL),
(2, 'ram', 'ram', NULL, 1, NULL),
(3, 'med', 'med', NULL, NULL, 1),
(4, 'admin', 'admin', NULL, NULL, NULL),
(9, 'doc', 'doc', 3, NULL, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
