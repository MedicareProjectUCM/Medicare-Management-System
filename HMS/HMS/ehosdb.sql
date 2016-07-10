-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2015 at 08:49 AM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `complaints`
--

INSERT INTO `complaints` (`cid`, `splid`, `did`, `pid`, `symptoms`, `mcareid`, `cdate`, `tests`, `medicines`) VALUES
(1, '', '1', '2', 'ram pbroblem', '2', '2015-04-29', 'lllll', 'xxx'),
(2, '', '2', '1', 'aaa to gopi', '1', '2015-04-29', 'ttt', 'mmm');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`did`, `dname`, `spl`, `qual`, `addr`, `dpno`, `email`) VALUES
(1, 'doctor', 'Physician', 'MD', 'hyd', 2147483647, 'gopivanamus@yahoo.com'),
(2, 'gopi', 'surgen', 'MD', 'cpuri', 2147483647, 'jayachandra02@gmail.com');

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
(1, 'mcare', 'X-Ray', 2147483647, 'jayachandra02@gmail.com'),
(2, 'nath', 'scan', 2147483647, 'gopivanam@gmail.com');

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
(1, 'patient', 'm', 20, 'hyd', 2147483647, 'crystalitetechnologies@gmail.com', '', ''),
(2, 'ram', 'm', 33, 'cpuri', 2147483647, 'deepikakonduru03@gmail.com', '', '');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tresults`
--

INSERT INTO `tresults` (`rid`, `cid`, `test_name`, `tdate`, `result`, `notes`, `tfilepath`) VALUES
(3, 2, 'ttt', '2015-04-29', '', '', 'hello1.txt'),
(4, 1, 'lllll', '2015-04-29', '', '', 'ehosdb.sql');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `pass_word`, `did`, `pid`, `mcareid`) VALUES
(1, 'doctor', 'doctor', 1, NULL, NULL),
(2, 'mcare', 'mcare', NULL, NULL, 1),
(3, 'patient', 'patient', NULL, 1, NULL),
(4, 'gopi', 'gopi', 2, NULL, NULL),
(5, 'nath', 'nath', NULL, NULL, 2),
(6, 'ram', 'ram', NULL, 2, NULL),
(7, 'admin', 'admin', NULL, NULL, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
