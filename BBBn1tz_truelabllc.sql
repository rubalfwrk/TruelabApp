-- phpMyAdmin SQL Dump
-- version 4.0.10.15
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2017 at 02:28 AM
-- Server version: 5.1.69-community-log
-- PHP Version: 5.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `BBBn1tz_truelabllc`
--

-- --------------------------------------------------------

--
-- Table structure for table `agencies`
--

CREATE TABLE IF NOT EXISTS `agencies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `agencyname` varchar(32) DEFAULT NULL,
  `agencyemail` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `agencyphonenumber` varchar(32) DEFAULT NULL,
  `agencyfax` varchar(32) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `address2` varchar(50) DEFAULT NULL,
  `city` varchar(32) DEFAULT NULL,
  `state` varchar(32) DEFAULT NULL,
  `zipcode` varchar(32) DEFAULT NULL,
  `simpass` varchar(50) DEFAULT NULL,
  `active` int(12) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `agencies`
--

INSERT INTO `agencies` (`id`, `agencyname`, `agencyemail`, `password`, `agencyphonenumber`, `agencyfax`, `address`, `address2`, `city`, `state`, `zipcode`, `simpass`, `active`) VALUES
(16, 'Trueagency', 'neha+1@avainfotech.com', '594ad4a5890e552e159139ab66a8d97c155c640a', '9787648798649', '9784642187986', 'Hfjcjdjx', 'Jsbxjsnx', 'Chd', 'Chd', '160013', '111111', 1),
(13, 'neha', 'neha@avainfotech.com', '4904ff3c0516d4702615e2f66e70ffaabb530429', '1234566888', 'gthrgtfjhty', 'rtyj', 'rt6yj', 'ytjtyj', 'ryjhyt', 'ytjtyj', '123456', 1),
(14, 'truelab', 'bahayko2@gmail.com', '4904ff3c0516d4702615e2f66e70ffaabb530429', '987654321', '123456789', '4 Bahay St', 'Apt 123', 'Pasig City', 'IL', '60452', '123456', 1),
(15, 'super admin agency', 'rubal@avainfotech.com', '4904ff3c0516d4702615e2f66e70ffaabb530429', '2134556667', '2e2344', 'awe', 'ferf', 'rwfr', 'fvfe', 'fvfev', '123456', 1);

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE IF NOT EXISTS `patients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trackingid` varchar(255) DEFAULT NULL,
  `doctorid` int(11) DEFAULT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(32) DEFAULT NULL,
  `address` text,
  `address2` varchar(32) NOT NULL,
  `city` varchar(32) DEFAULT NULL,
  `state` varchar(32) DEFAULT NULL,
  `zipcode` varchar(32) DEFAULT NULL,
  `phonenumber` varchar(255) DEFAULT NULL,
  `sex` varchar(32) DEFAULT NULL,
  `dob` varchar(255) DEFAULT NULL,
  `insurancename` varchar(255) DEFAULT NULL,
  `insurancenumber` varchar(255) DEFAULT NULL,
  `diagnosis` varchar(232) DEFAULT NULL,
  `doctorname` varchar(255) DEFAULT NULL,
  `enable` int(11) NOT NULL DEFAULT '0',
  `doctornumber` varchar(255) DEFAULT NULL,
  `doctorfaxnumber` varchar(255) DEFAULT NULL,
  `doctornpi` varchar(50) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `history` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`id`, `trackingid`, `doctorid`, `firstname`, `lastname`, `address`, `address2`, `city`, `state`, `zipcode`, `phonenumber`, `sex`, `dob`, `insurancename`, `insurancenumber`, `diagnosis`, `doctorname`, `enable`, `doctornumber`, `doctorfaxnumber`, `doctornpi`, `created`, `history`) VALUES
(8, 'KIrv07251973', 25, 'Kyrie', 'Irving', '2 Cavalier St', '', 'Cleveland', 'OH', '654987', '4567891234', 'male', '1973-07-25', 'Medicare', '123456789', '2016 Champions', 'superadmin ', 0, '7084567890', '(708) 789-1234', '1000000001', '2017-07-29 21:12:06', 0),
(25, 'snam03032010', 25, 'super admin patient', 'name', 'it park', 'chandigarh', 'chandigarh', 'chandigarh', '160101', '09899888878', 'male', '2010-03-03', 'insurance name', '566556565665', 'test', 'superadmin ', 0, '345466', 'f5454554', '443545', '2017-08-16 03:14:57', 0),
(10, 'AiOs06101973', 29, 'Apple', 'iOsTest', '321 Admin Added St', 'Apt 123', 'Admin Added', 'IL', '654987', '4567891234', 'male', '1973-06-10', 'Medicare', '123456789', 'Apple Test Patient', 'Dr. True', 0, '7084567890', '(708) 789-1234', '1000000001', '2017-07-31 10:17:28', 0),
(12, 'TCan05141970', 29, 'Test', 'Cancel', '321 Admin Added St', 'Apt 321', 'Admin Added', 'AD', '321654', '123456789', 'male', '1970-05-14', 'Medicare', '12345678900', 'Admin Added for TrueLAb', 'Dr. True  ', 0, '7084567890', '(708) 789-1234', '1000000001', '2017-08-02 18:38:36', 0),
(27, 'rnam02261998', 25, 'rubal admin patient', 'name', 'it park', 'chandigarh', 'chandigarh', 'chandigarh', '160101', '09899888878', 'female', '1998-02-26', 'insurance name', '566556565665', 'test', 'superadmin ', 0, '345466', 'f5454554', '443545', '2017-08-16 06:13:17', 0);

-- --------------------------------------------------------

--
-- Table structure for table `patient_tests`
--

CREATE TABLE IF NOT EXISTS `patient_tests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `doctorid` int(11) DEFAULT NULL,
  `patientid` int(11) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  `testid` int(11) DEFAULT NULL,
  `fasting` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT '0' COMMENT '0 => unscheduled,1 => scheduled,2=>accept,3=>decline,4=>cancel',
  `testdiagnosis` varchar(255) DEFAULT NULL,
  `report` text,
  `flag` varchar(255) DEFAULT NULL,
  `reportpdf` text,
  `reportdate` datetime DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `reason` text,
  `schdueleddate` datetime DEFAULT NULL,
  `declinedate` datetime DEFAULT NULL,
  `patientreason` text,
  `userreason` text,
  `canceldate` datetime DEFAULT NULL,
  `reschduleddate` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `conclusion` text,
  `patientsignature` text,
  `clientsignature` text,
  `paidreport` text,
  `signature` varchar(5000) DEFAULT NULL,
  `reportstatus` int(11) DEFAULT '0',
  `reportdownloadstatus` int(11) NOT NULL DEFAULT '0',
  `reportdownloadstatus_date` datetime DEFAULT NULL,
  `paidreportdownloadstatus` int(11) NOT NULL DEFAULT '0',
  `paidreportdownloadstatus_date` datetime DEFAULT NULL,
  `appclientdownloadreport` int(11) NOT NULL DEFAULT '0',
  `appclientdownloadreport_date` datetime DEFAULT NULL,
  `request_date` datetime DEFAULT NULL,
  `cronreportstatus` int(11) DEFAULT '0',
  `reporttime` varchar(255) DEFAULT NULL,
  `reportday` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=43 ;

-- --------------------------------------------------------

--
-- Table structure for table `socials`
--

CREATE TABLE IF NOT EXISTS `socials` (
  `id` int(11) NOT NULL,
  `created` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `staticpages`
--

CREATE TABLE IF NOT EXISTS `staticpages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `position` varchar(250) DEFAULT NULL,
  `title` varchar(250) DEFAULT NULL,
  `description` text,
  `image` varchar(250) NOT NULL DEFAULT '0',
  `status` tinyint(4) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  `category` varchar(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `status_accepts`
--

CREATE TABLE IF NOT EXISTS `status_accepts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patienttestid` int(12) DEFAULT NULL,
  `patientid` int(11) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  `testid` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '0 => unscheduled,1 => scheduled,2=>accept,3=>decline,4=>cancel',
  `report` text,
  `date` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `status_cancels`
--

CREATE TABLE IF NOT EXISTS `status_cancels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patienttestid` int(12) DEFAULT NULL,
  `doctorid` int(11) DEFAULT NULL,
  `patientid` int(11) DEFAULT NULL,
  `userid` int(32) DEFAULT NULL,
  `testid` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '0 => unscheduled,1 => scheduled,2=>accept,3=>decline,4=>cancel',
  `admin_reason` varchar(232) DEFAULT NULL,
  `report` text,
  `date` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `status_declines`
--

CREATE TABLE IF NOT EXISTS `status_declines` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patienttestid` int(12) DEFAULT NULL,
  `patientid` int(11) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  `testid` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '0 => unscheduled,1 => scheduled,2=>accept,3=>decline,4=>cancel',
  `reason` varchar(232) DEFAULT NULL,
  `admin_reason` varchar(232) DEFAULT NULL,
  `report` text,
  `date` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `status_historys`
--

CREATE TABLE IF NOT EXISTS `status_historys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `doctorid` int(11) DEFAULT NULL,
  `patientid` int(11) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  `testid` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '0 => unscheduled,1 => scheduled,2=>accept,3=>decline,4=>cancel',
  `date` datetime DEFAULT NULL,
  `report` text,
  `reportdate` datetime NOT NULL,
  `created_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `status_reschedules`
--

CREATE TABLE IF NOT EXISTS `status_reschedules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patienttestid` int(12) DEFAULT NULL,
  `patientid` int(11) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  `testid` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '0 => unscheduled,1 => scheduled,2=>accept,3=>decline,4=>cancel',
  `reason` varchar(232) DEFAULT NULL,
  `admin_reason` varchar(232) DEFAULT NULL,
  `report` text,
  `date` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE IF NOT EXISTS `tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patientid` int(12) NOT NULL,
  `userid` int(12) NOT NULL,
  `taskid` int(11) NOT NULL,
  `status` int(12) NOT NULL COMMENT '0 => noresponse,1 => accept,2 => decline',
  `date` datetime NOT NULL,
  `reason` text NOT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tests`
--

CREATE TABLE IF NOT EXISTS `tests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `test` text NOT NULL,
  `units` text,
  `referencerange` text,
  `freetext` varchar(500) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `tests`
--

INSERT INTO `tests` (`id`, `test`, `units`, `referencerange`, `freetext`, `created`) VALUES
(1, 'PT/INR', 'SEC/', '9.4 - 12.9/2-3', 'Recommended therapeutic ranges using INR for routing anticoagulant therapy is 2 -3. Oral anticoagulant therapy for recurrent systemic embolism and mechanical prosthetic heart valves is 2 – 3.5. Patients who are not on anticoagulants and no heart valve is 0.8 – 1.2', '2017-04-24 08:05:26'),
(2, 'AIC', 'mg', '6-8', '', '2017-07-07 06:30:57');

-- --------------------------------------------------------

--
-- Table structure for table `userpermissions`
--

CREATE TABLE IF NOT EXISTS `userpermissions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tokenid` text COLLATE utf8_unicode_ci,
  `image` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `firstname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phonenumber` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reset_url` text COLLATE utf8_unicode_ci,
  `active` int(11) DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  `fax` text COLLATE utf8_unicode_ci,
  `address` text COLLATE utf8_unicode_ci,
  `address2` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zipcode` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `agencyid` int(50) DEFAULT NULL,
  `agencyname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `agencyphonenumber` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `agencyfax` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `npi` text COLLATE utf8_unicode_ci,
  `phlebotomistadddate` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `passworddate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT AUTO_INCREMENT=50 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role`, `tokenid`, `image`, `firstname`, `lastname`, `username`, `email`, `password`, `phonenumber`, `reset_url`, `active`, `created`, `modified`, `fax`, `address`, `address2`, `city`, `state`, `zipcode`, `agencyid`, `agencyname`, `agencyphonenumber`, `agencyfax`, `npi`, `phlebotomistadddate`, `passworddate`) VALUES
(1, 'admin', NULL, '014516Tulips.jpg', 'ryan', NULL, 'notification@truelabllc.com', 'notification@truelabllc.com', '4904ff3c0516d4702615e2f66e70ffaabb530429', '', NULL, 1, NULL, '2017-11-27 14:00:36', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(26, 'client', NULL, NULL, 'neha', NULL, 'neha@avainfotech.com', 'neha@avainfotech.com', '5241be845f2487541705d9274d50204c7fb93f14', '245467989', NULL, 1, '2017-07-27 07:26:09', '2017-08-17 11:59:20', '6965696', 'rtyj', 'rt6yj', 'ytjtyj', 'ryjhyt', 'ytjtyj', 13, 'neha', '1234566888', 'gthrgtfjhty', 'wetr', NULL, '2017-09-20 04:57:41'),
(27, 'user', 'fBkyj1ucrUk:APA91bHcr3y2S4q5pf4AP7LYT460NW-UMcykk7sDWeoliLLk4Q6swOvKm7W_qcOPqOZoDCupq6JlPwGht7hBcrqfnWupLgISvS2GR7y2mX809SqLkd5ze3vDdICr7I5GuUEDPGUHDZN2', NULL, 'Ryan', 'Manguerra', 'ryan@truelabllc.com', 'ryan@truelabllc.com', '4904ff3c0516d4702615e2f66e70ffaabb530429', '7082623130', NULL, 1, '2017-07-27 20:06:27', '2017-08-12 05:24:09', NULL, '6956 155th Pl', '', 'Oak Forest', 'IL', '60452', NULL, NULL, NULL, NULL, NULL, '2017-07-27', NULL),
(28, 'user', NULL, NULL, 'Dave', 'Manguerra', 'dave@truelabllc.com', 'dave@truelabllc.com', '4904ff3c0516d4702615e2f66e70ffaabb530429', '7083235960', NULL, 1, '2017-07-27 20:08:28', '2017-08-12 09:48:41', NULL, '15618 Bramblewood Rd', '', 'Oak Forest', 'IL', '60452', NULL, NULL, NULL, NULL, NULL, '', NULL),
(39, 'user', 'fKkLrGcmEUE:APA91bFLz71umQKUMlclyA9ydrrExCJJdv-QbbNMHzDG4Tk1eZ65cFvshc5scTYh9QtHM3rU45X-9YUk2xZX4KiVmwR56FdYENPiax4soPLCO2wInUnx73E5CRIsHerQbykRvIH5N2Yo', NULL, 'neha', 'khanna', 'neha+90@avainfotech.com', 'neha+90@avainfotech.com', '4904ff3c0516d4702615e2f66e70ffaabb530429', '123456789', NULL, 1, '2017-08-16 06:34:20', '2017-08-16 10:35:53', NULL, 'a1', 'a2', 'fvgtt', 'vrtfv', 'ev', NULL, NULL, NULL, NULL, NULL, '2017-08-09', NULL),
(45, 'user', 'eYLfCGhoLJs:APA91bHvMgZfU9bvEy3AUMNRwKYd3VWZGSwrmW_YPZnK1vygavbEi0iTqsLY3al9w8SgpUng9TgaLfXoG4x-3u2bqClK2WrOiGeW3HwvodMHaIdM7ey5dEY8VnZcqwQrIeCgH_UXmppu', '', 'Hunny', 'Kumar', '', 'honeyfwrk@gmail.com', 'ae20ca4939138c65f695ba9d8a10b3e0c98e07fc', '9808768978', NULL, 1, '2017-08-17 06:16:07', '2017-08-23 06:28:00', NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, '', NULL, '2017-08-23 02:28:00'),
(46, 'client', 'cWyFHglmrXI:APA91bEH09DVADYpPikIfuSYtoYU6Am7_w-tM3ejb2EC3hDycYWJ9ZHsu41i5Y1fAmUtqT8gjmH-3d1kNHNyyjJ7ErC4zcyTpB6xnMdTxfGYNl1wZsYXS05SrJdmhHxh98eEY8GCQizn', '11504258445.png', NULL, NULL, 'neha+1@avainfotech.com', 'neha+1@avainfotech.com', '594ad4a5890e552e159139ab66a8d97c155c640a', NULL, NULL, 1, '2017-08-17 08:00:30', '2017-08-17 12:00:30', NULL, 'Hfjcjdjx', 'Jsbxjsnx', 'Chd', 'Chd', '160013', 16, 'Trueagency', '9787648798649', '9784642187986', NULL, NULL, '2017-08-17 08:00:30'),
(47, 'user', 'fkuaJAJiqeo:APA91bHjpskRGkhxkhAm29dl514kHTMYV_XruvhxAAS-Ib2p-lK791NGaO1S5lLJPcpTPE06i-hXgtrE1Uwf-itypqUT4I-ZyoCwLalMP0Why-MTd8m5r8Jkf8tWZKJr33jp_ZppPpvL', NULL, 'Ashley', 'Re', 'ashley.n.re@gmail.com', 'ashley.n.re@gmail.com', 'e031d286cd7e31f2fda0e2e13be2670febcdefbd', '5852053858', NULL, 0, '2017-10-04 10:40:30', '2017-10-04 14:40:30', NULL, '5005 losee rd', NULL, 'North las Vegas ', 'NV ', '89081', NULL, NULL, NULL, NULL, NULL, NULL, '2017-10-04 10:40:30'),
(48, 'user', 'f2ZkqML3CtY:APA91bE9jeFVE9JA9yXdLDFe0fX66QgMbVR7yAM8IeKuGY84wylhOjLn8k7Ck8Srl62TJE_5ZN9OWWM_evE4tPq0wBimcfcvnQrYMsV6pXKT8BUFoVOHCVj4Fy5YjVWNvVMZSBbww0W6', NULL, 'Gregory', 'Keller', 'anywherelabsexpress@gmail.com', 'anywherelabsexpress@gmail.com', 'fd36d075ad2942f94aec811b4bcee9dd9776c3e4', '9852170584', 'cd8056eab892ace65dfadfd8a14508b8cdf7be464ef4c06c43822eca97888a165dd09ef2f4b685c22384d27284ae6b9ea49481da5416dc1877282f9392c38613', 0, '2017-10-22 21:01:30', '2017-10-23 01:04:49', NULL, 'P.O. Box 3197', '', 'Harvey', 'La', '70059', NULL, NULL, NULL, NULL, NULL, NULL, '2017-10-22 09:01:30'),
(49, 'client', 'e4xH3tyezOw:APA91bHt4vUEIFfLoyhm7ycVhnE9zGebcspuhkofp2x1HI4-6nI7XVkJx0Ybnba43_XFEADUbI0xolKrqhecBTmsHroHT64cRAvTo1iKmzAw1wXs-ZWIyt6Il_ae_7QbP2sI8Wi2GAlM', NULL, 'sachin', NULL, 'harmaninsonix@gmail.com', 'harmaninsonix@gmail.com', '4904ff3c0516d4702615e2f66e70ffaabb530429', '9876512345', NULL, 0, '2017-11-15 01:32:06', '2017-11-15 06:32:06', '123456', 'mohali', 'mohali', 'mohali', 'chandigarh', '123456', NULL, NULL, NULL, NULL, '123456', NULL, '2017-11-15 01:32:06');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
