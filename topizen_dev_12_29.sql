-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 29, 2011 at 10:53 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `topizen_dev`
--

-- --------------------------------------------------------

--
-- Table structure for table `feed`
--

CREATE TABLE IF NOT EXISTS `feed` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fromid` bigint(20) unsigned NOT NULL DEFAULT '0',
  `toid` bigint(20) unsigned NOT NULL DEFAULT '0',
  `type` int(10) unsigned NOT NULL DEFAULT '0',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `uid` (`fromid`),
  KEY `time` (`time`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=134 ;

--
-- Dumping data for table `feed`
--

INSERT INTO `feed` (`id`, `fromid`, `toid`, `type`, `time`) VALUES
(1, 10005, 10466300903932, 2, '2011-11-10 22:18:49'),
(2, 10000, 10466300903932, 2, '2011-11-10 22:20:54'),
(3, 10005, 10466300903932, 2, '2011-11-10 22:29:12'),
(4, 10005, 10466300903932, 2, '2011-11-10 22:29:20'),
(5, 10005, 10466300903932, 2, '2011-11-10 23:25:34'),
(6, 10005, 10466300903932, 2, '2011-11-10 23:26:15'),
(7, 10005, 10466300903932, 2, '2011-11-10 23:28:16'),
(8, 10005, 10466103771951, 2, '2011-11-10 23:44:51'),
(9, 10005, 10466103771951, 2, '2011-11-10 23:54:31'),
(10, 10005, 10465904992264, 2, '2011-11-12 03:37:32'),
(11, 10005, 11889947535717, 5, '2011-11-12 04:04:35'),
(12, 10466103771951, 11889947535717, 9, '2011-11-12 04:04:35'),
(13, 10005, 11889958477083, 5, '2011-11-12 04:06:24'),
(14, 10466103771951, 11889958477083, 9, '2011-11-12 04:06:24'),
(15, 10005, 11889964077627, 5, '2011-11-12 04:07:20'),
(16, 10466103771951, 11889964077627, 9, '2011-11-12 04:07:20'),
(17, 10005, 11889966085298, 5, '2011-11-12 04:07:40'),
(18, 10466103771951, 11889966085298, 9, '2011-11-12 04:07:40'),
(19, 10005, 11889971618155, 5, '2011-11-12 04:08:36'),
(20, 10466103771951, 11889971618155, 9, '2011-11-12 04:08:36'),
(21, 10005, 11889976636850, 5, '2011-11-12 04:09:26'),
(22, 10466103771951, 11889976636850, 9, '2011-11-12 04:09:26'),
(23, 10005, 11889977685975, 5, '2011-11-12 04:09:36'),
(24, 10466103771951, 11889977685975, 9, '2011-11-12 04:09:36'),
(25, 10005, 11890377064414, 5, '2011-11-12 05:16:10'),
(26, 10466103771951, 11890377064414, 9, '2011-11-12 05:16:10'),
(27, 10005, 11890554457494, 5, '2011-11-12 05:45:44'),
(28, 10466103771951, 11890554457494, 9, '2011-11-12 05:45:44'),
(29, 10005, 11890603445078, 5, '2011-11-12 05:53:54'),
(30, 10466103771951, 11890603445078, 9, '2011-11-12 05:53:54'),
(31, 10005, 11890680837610, 5, '2011-11-12 06:06:48'),
(32, 10466103771951, 11890680837610, 9, '2011-11-12 06:06:48'),
(33, 10005, 11890681590211, 5, '2011-11-12 06:06:55'),
(34, 10466103771951, 11890681590211, 9, '2011-11-12 06:06:55'),
(35, 10005, 11890691114919, 5, '2011-11-12 06:08:31'),
(36, 10466103771951, 11890691114919, 9, '2011-11-12 06:08:31'),
(37, 10005, 11890698675287, 5, '2011-11-12 06:09:46'),
(38, 10466103771951, 11890698675287, 9, '2011-11-12 06:09:46'),
(39, 10005, 11890700911450, 5, '2011-11-12 06:10:09'),
(40, 10466103771951, 11890700911450, 9, '2011-11-12 06:10:09'),
(41, 10005, 11890702871066, 5, '2011-11-12 06:10:28'),
(42, 10466103771951, 11890702871066, 9, '2011-11-12 06:10:28'),
(43, 10005, 11890707820864, 5, '2011-11-12 06:11:18'),
(44, 10466103771951, 11890707820864, 9, '2011-11-12 06:11:18'),
(45, 10005, 11890710984493, 5, '2011-11-12 06:11:49'),
(46, 10466103771951, 11890710984493, 9, '2011-11-12 06:11:49'),
(47, 10005, 11890723471438, 5, '2011-11-12 06:13:54'),
(48, 10466103771951, 11890723471438, 9, '2011-11-12 06:13:54'),
(49, 10005, 11890724240993, 5, '2011-11-12 06:14:02'),
(50, 10466103771951, 11890724240993, 9, '2011-11-12 06:14:02'),
(51, 10005, 11890724382988, 5, '2011-11-12 06:14:03'),
(52, 10466103771951, 11890724382988, 9, '2011-11-12 06:14:03'),
(53, 10005, 11890724689558, 5, '2011-11-12 06:14:06'),
(54, 10466103771951, 11890724689558, 9, '2011-11-12 06:14:06'),
(55, 10005, 11890727382512, 5, '2011-11-12 06:14:33'),
(56, 10466103771951, 11890727382512, 9, '2011-11-12 06:14:33'),
(57, 10005, 11890730308580, 5, '2011-11-12 06:15:03'),
(58, 10466103771951, 11890730308580, 9, '2011-11-12 06:15:03'),
(59, 10005, 11890752291724, 5, '2011-11-12 06:18:42'),
(60, 10466103771951, 11890752291724, 9, '2011-11-12 06:18:42'),
(61, 10005, 11890757889477, 5, '2011-11-12 06:19:38'),
(62, 10466103771951, 11890757889477, 9, '2011-11-12 06:19:38'),
(63, 10005, 11890929934093, 5, '2011-11-12 06:48:19'),
(64, 10465904992264, 11890929934093, 9, '2011-11-12 06:48:19'),
(65, 10005, 11890931499847, 5, '2011-11-12 06:48:35'),
(66, 10465904992264, 11890931499847, 9, '2011-11-12 06:48:35'),
(67, 10005, 10465904992264, 2, '2011-11-12 06:48:40'),
(68, 10000, 11890933807355, 5, '2011-11-12 06:48:58'),
(69, 10465904992264, 11890933807355, 9, '2011-11-12 06:48:58'),
(70, 10005, 10891136567494, 4, '2011-11-12 07:22:45'),
(71, 10005, 10891141802988, 4, '2011-11-12 07:23:38'),
(72, 10005, 10891163480939, 4, '2011-11-12 07:27:14'),
(73, 10005, 10891183428086, 4, '2011-11-12 07:30:34'),
(74, 10005, 10891200443185, 4, '2011-11-12 07:33:24'),
(75, 10005, 10891247899745, 4, '2011-11-12 07:41:18'),
(77, 10005, 10891256892711, 4, '2011-11-12 07:42:48'),
(79, 10005, 10891290763540, 4, '2011-11-12 07:48:27'),
(81, 10005, 10891292043761, 4, '2011-11-12 07:48:40'),
(82, 10891292043761, 0, 1, '2011-11-12 07:48:40'),
(83, 10005, 10891298747587, 4, '2011-11-12 07:49:47'),
(84, 10891298747587, 0, 1, '2011-11-12 07:49:47'),
(85, 10005, 10891298747587, 2, '2011-11-12 07:49:47'),
(86, 10005, 10891298747587, 2, '2011-11-12 07:50:42'),
(87, 10005, 10891298747587, 2, '2011-11-12 07:51:09'),
(88, 10000, 10891330653476, 4, '2011-11-12 07:55:06'),
(89, 10891330653476, 0, 1, '2011-11-12 07:55:06'),
(90, 10000, 10891330653476, 2, '2011-11-12 07:55:06'),
(91, 10000, 11891340841419, 5, '2011-11-12 07:56:48'),
(92, 10891330653476, 11891340841419, 9, '2011-11-12 07:56:48'),
(93, 10005, 11891346701322, 5, '2011-11-12 07:57:47'),
(94, 10891330653476, 11891346701322, 9, '2011-11-12 07:57:47'),
(95, 10005, 11891347737643, 5, '2011-11-12 07:57:57'),
(96, 10891330653476, 11891347737643, 9, '2011-11-12 07:57:57'),
(97, 10000, 11891348629689, 5, '2011-11-12 07:58:06'),
(98, 10891330653476, 11891348629689, 9, '2011-11-12 07:58:06'),
(99, 10000, 11891349418614, 5, '2011-11-12 07:58:14'),
(100, 10891330653476, 11891349418614, 9, '2011-11-12 07:58:14'),
(101, 10005, 10891330653476, 2, '2011-11-12 07:58:24'),
(102, 10000, 10466103771951, 2, '2011-12-26 15:14:49'),
(103, 10000, 10466103771951, 2, '2011-12-26 15:14:52'),
(104, 10000, 111276974649573, 5, '2011-12-26 23:09:06'),
(105, 10466103771951, 111276974649573, 9, '2011-12-26 23:09:06'),
(106, 10000, 111276986759724, 5, '2011-12-26 23:11:07'),
(107, 10466103771951, 111276986759724, 9, '2011-12-26 23:11:07'),
(108, 10000, 111276989735797, 5, '2011-12-26 23:11:37'),
(109, 10466103771951, 111276989735797, 9, '2011-12-26 23:11:37'),
(110, 10000, 111276991284642, 5, '2011-12-26 23:11:52'),
(111, 10466103771951, 111276991284642, 9, '2011-12-26 23:11:52'),
(112, 10000, 111277042093552, 5, '2011-12-26 23:20:20'),
(113, 10466103771951, 111277042093552, 9, '2011-12-26 23:20:20'),
(114, 10000, 111277054473356, 5, '2011-12-26 23:22:24'),
(115, 10466103771951, 111277054473356, 9, '2011-12-26 23:22:24'),
(116, 10000, 111277055705467, 5, '2011-12-26 23:22:37'),
(117, 10466103771951, 111277055705467, 9, '2011-12-26 23:22:37'),
(118, 10000, 111277063550061, 5, '2011-12-26 23:23:55'),
(119, 10466103771951, 111277063550061, 9, '2011-12-26 23:23:55'),
(120, 10000, 111277069570873, 5, '2011-12-26 23:24:55'),
(121, 10466103771951, 111277069570873, 9, '2011-12-26 23:24:55'),
(122, 10000, 111277075521296, 5, '2011-12-26 23:25:55'),
(123, 10466103771951, 111277075521296, 9, '2011-12-26 23:25:55'),
(124, 10000, 111277671821843, 5, '2011-12-27 01:05:18'),
(125, 10466300903932, 111277671821843, 9, '2011-12-27 01:05:18'),
(126, 10000, 111277676543837, 5, '2011-12-27 01:06:05'),
(127, 10466300903932, 111277676543837, 9, '2011-12-27 01:06:05'),
(128, 10000, 111278021364588, 5, '2011-12-27 02:03:33'),
(129, 10466103771951, 111278021364588, 9, '2011-12-27 02:03:33'),
(130, 10000, 111285282854787, 5, '2011-12-27 22:13:48'),
(131, 10466300903932, 111285282854787, 9, '2011-12-27 22:13:48'),
(132, 10000, 111285301691065, 5, '2011-12-27 22:16:56'),
(133, 10891330653476, 111285301691065, 9, '2011-12-27 22:16:56');

-- --------------------------------------------------------

--
-- Table structure for table `followed_info`
--

CREATE TABLE IF NOT EXISTS `followed_info` (
  `fuid` int(10) unsigned NOT NULL DEFAULT '0',
  `tuid` int(10) unsigned NOT NULL DEFAULT '0',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`fuid`,`tuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `followed_info`
--

INSERT INTO `followed_info` (`fuid`, `tuid`, `time`) VALUES
(10000, 10005, '2011-11-10 05:13:23'),
(10001, 10005, '2011-11-10 17:38:39'),
(10002, 10005, '2011-11-10 05:33:58'),
(10003, 10000, '2011-11-10 20:22:56'),
(10003, 10005, '2011-11-10 05:56:55'),
(10005, 10000, '2011-11-10 21:46:07');

-- --------------------------------------------------------

--
-- Table structure for table `followed_num`
--

CREATE TABLE IF NOT EXISTS `followed_num` (
  `uid` int(10) unsigned NOT NULL DEFAULT '0',
  `num` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `followed_num`
--

INSERT INTO `followed_num` (`uid`, `num`) VALUES
(10000, 1),
(10001, 1),
(10002, 1),
(10003, 2),
(10004, 0),
(10005, 1);

-- --------------------------------------------------------

--
-- Table structure for table `following_info`
--

CREATE TABLE IF NOT EXISTS `following_info` (
  `fuid` int(10) unsigned NOT NULL DEFAULT '0',
  `tuid` int(10) unsigned NOT NULL DEFAULT '0',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`fuid`,`tuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `following_info`
--

INSERT INTO `following_info` (`fuid`, `tuid`, `time`) VALUES
(10000, 10003, '2011-11-10 20:22:56'),
(10000, 10005, '2011-11-10 21:46:07'),
(10005, 10000, '2011-11-10 05:13:23'),
(10005, 10001, '2011-11-10 17:38:39'),
(10005, 10002, '2011-11-10 05:33:58'),
(10005, 10003, '2011-11-10 05:56:55');

-- --------------------------------------------------------

--
-- Table structure for table `following_num`
--

CREATE TABLE IF NOT EXISTS `following_num` (
  `uid` int(10) unsigned NOT NULL DEFAULT '0',
  `num` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `following_num`
--

INSERT INTO `following_num` (`uid`, `num`) VALUES
(10000, 2),
(10001, 0),
(10002, 0),
(10003, 0),
(10004, 0),
(10005, 4);

-- --------------------------------------------------------

--
-- Table structure for table `following_topic_num`
--

CREATE TABLE IF NOT EXISTS `following_topic_num` (
  `uid` int(10) unsigned NOT NULL DEFAULT '0',
  `num` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid`),
  KEY `num` (`num`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `following_topic_num`
--

INSERT INTO `following_topic_num` (`uid`, `num`) VALUES
(10001, 0),
(10002, 0),
(10003, 0),
(10004, 0),
(10000, 2),
(10005, 6);

-- --------------------------------------------------------

--
-- Table structure for table `login_info`
--

CREATE TABLE IF NOT EXISTS `login_info` (
  `email` varchar(50) NOT NULL,
  `pwd` varchar(32) NOT NULL,
  `uid` int(10) unsigned NOT NULL DEFAULT '0',
  `active` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`email`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `login_info`
--

INSERT INTO `login_info` (`email`, `pwd`, `uid`, `active`) VALUES
('1@topizen.com', '1bbd886460827015e5d605ed44252251', 10000, 2),
('2@topizen.com', '1bbd886460827015e5d605ed44252251', 10001, 2),
('3@topizen.com', '1bbd886460827015e5d605ed44252251', 10002, 2),
('4@topizen.com', '1bbd886460827015e5d605ed44252251', 10003, 2),
('5@topizen.com', '1bbd886460827015e5d605ed44252251', 10004, 2),
('6@topizen.com', '1bbd886460827015e5d605ed44252251', 10005, 2);

-- --------------------------------------------------------

--
-- Table structure for table `post_attitude`
--

CREATE TABLE IF NOT EXISTS `post_attitude` (
  `pid` bigint(20) unsigned NOT NULL,
  `uid` int(10) unsigned NOT NULL DEFAULT '0',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `flag` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`pid`,`uid`),
  KEY `time` (`time`),
  KEY `flag` (`flag`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `post_create`
--

CREATE TABLE IF NOT EXISTS `post_create` (
  `pid` bigint(20) unsigned NOT NULL,
  `uid` int(10) unsigned NOT NULL DEFAULT '0',
  `tid` bigint(20) unsigned NOT NULL,
  `ip` int(10) unsigned NOT NULL DEFAULT '0',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `title` varchar(1024) NOT NULL DEFAULT '',
  `content` varchar(4096) NOT NULL DEFAULT '',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`pid`),
  KEY `uid` (`uid`),
  KEY `tid` (`tid`),
  KEY `time` (`time`),
  KEY `type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `post_create`
--

INSERT INTO `post_create` (`pid`, `uid`, `tid`, `ip`, `time`, `title`, `content`, `type`) VALUES
(11890554457494, 10005, 10466103771951, 2130706433, '2011-11-12 05:45:44', 'untitled', 'I think so', 1),
(11890603445078, 10005, 10466103771951, 2130706433, '2011-11-12 05:53:54', 'untitled', 'I have lot to say about this topic', 1),
(11890680837610, 10005, 10466103771951, 2130706433, '2011-11-12 06:06:48', 'untitled', 'Great!', 1),
(11890681590211, 10005, 10466103771951, 2130706433, '2011-11-12 06:06:55', 'untitled', 'Great!', 1),
(11890691114919, 10005, 10466103771951, 2130706433, '2011-11-12 06:08:31', 'untitled', 'Great!', 1),
(11890698675287, 10005, 10466103771951, 2130706433, '2011-11-12 06:09:46', 'untitled', 'good', 1),
(11890700911450, 10005, 10466103771951, 2130706433, '2011-11-12 06:10:09', 'untitled', 'good', 1),
(11890702871066, 10005, 10466103771951, 2130706433, '2011-11-12 06:10:28', 'untitled', 'good', 1),
(11890707820864, 10005, 10466103771951, 2130706433, '2011-11-12 06:11:18', 'untitled', 'good', 1),
(11890710984493, 10005, 10466103771951, 2130706433, '2011-11-12 06:11:49', 'untitled', 'OMG', 1),
(11890723471438, 10005, 10466103771951, 2130706433, '2011-11-12 06:13:54', 'untitled', 'ASAP', 1),
(11890724240993, 10005, 10466103771951, 2130706433, '2011-11-12 06:14:02', 'untitled', 'ASAP', 1),
(11890724382988, 10005, 10466103771951, 2130706433, '2011-11-12 06:14:03', 'untitled', 'ASAP', 1),
(11890724689558, 10005, 10466103771951, 2130706433, '2011-11-12 06:14:06', 'untitled', 'ASAP', 1),
(11890727382512, 10005, 10466103771951, 2130706433, '2011-11-12 06:14:33', 'untitled', 'ASAP', 1),
(11890730308580, 10005, 10466103771951, 2130706433, '2011-11-12 06:15:03', 'untitled', 'asap\n', 1),
(11890752291724, 10005, 10466103771951, 2130706433, '2011-11-12 06:18:42', 'untitled', 'OMW', 1),
(11890757889477, 10005, 10466103771951, 2130706433, '2011-11-12 06:19:38', 'untitled', 'done', 1),
(11890929934093, 10005, 10465904992264, 2130706433, '2011-11-12 06:48:19', 'untitled', 'OMG', 1),
(11890931499847, 10005, 10465904992264, 2130706433, '2011-11-12 06:48:35', 'untitled', 'omg', 1),
(11890933807355, 10000, 10465904992264, 2130706433, '2011-11-12 06:48:58', 'untitled', 'hi', 1),
(11891340841419, 10000, 10891330653476, 2130706433, '2011-11-12 07:56:48', 'untitled', 'it''s done!', 1),
(11891346701322, 10005, 10891330653476, 2130706433, '2011-11-12 07:57:47', 'untitled', 'good', 1),
(11891347737643, 10005, 10891330653476, 2130706433, '2011-11-12 07:57:57', 'untitled', 'good', 1),
(11891348629689, 10000, 10891330653476, 2130706433, '2011-11-12 07:58:06', 'untitled', 'good', 1),
(11891349418614, 10000, 10891330653476, 2130706433, '2011-11-12 07:58:14', 'untitled', 'ok', 1),
(111276974649573, 10000, 10466103771951, 2130706433, '2011-12-26 23:09:06', 'untitled', 'good post', 1),
(111276986759724, 10000, 10466103771951, 2130706433, '2011-12-26 23:11:07', 'untitled', 'good post', 1),
(111276989735797, 10000, 10466103771951, 2130706433, '2011-12-26 23:11:37', 'untitled', 'development', 2),
(111276991284642, 10000, 10466103771951, 2130706433, '2011-12-26 23:11:52', 'untitled', 'future post', 3),
(111277042093552, 10000, 10466103771951, 2130706433, '2011-12-26 23:20:20', 'untitled', 'future post 2', 3),
(111277054473356, 10000, 10466103771951, 2130706433, '2011-12-26 23:22:24', 'untitled', 'deve post 2', 2),
(111277055705467, 10000, 10466103771951, 2130706433, '2011-12-26 23:22:37', 'untitled', 'deve post 3', 2),
(111277063550061, 10000, 10466103771951, 2130706433, '2011-12-26 23:23:55', 'untitled', 'deve post 4', 2),
(111277069570873, 10000, 10466103771951, 2130706433, '2011-12-26 23:24:55', 'untitled', 'deve post 4', 2),
(111277075521296, 10000, 10466103771951, 2130706433, '2011-12-26 23:25:55', 'untitled', 'begining', 1),
(111277671821843, 10000, 10466300903932, 2130706433, '2011-12-27 01:05:18', 'untitled', 'future 1\n', 3),
(111277676543837, 10000, 10466300903932, 2130706433, '2011-12-27 01:06:05', 'untitled', 'deve 1', 2),
(111278021364588, 10000, 10466103771951, 2130706433, '2011-12-27 02:03:33', 'untitled', 'future 5', 3),
(111285282854787, 10000, 10466300903932, 2130706433, '2011-12-27 22:13:48', 'untitled', 'begining 1', 1),
(111285301691065, 10000, 10891330653476, 2130706433, '2011-12-27 22:16:56', 'untitled', 'deve 1', 2);

-- --------------------------------------------------------

--
-- Table structure for table `post_num`
--

CREATE TABLE IF NOT EXISTS `post_num` (
  `pid` bigint(20) unsigned NOT NULL,
  `like` int(10) unsigned NOT NULL DEFAULT '0',
  `unlike` int(10) unsigned NOT NULL DEFAULT '0',
  `repost` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`pid`),
  KEY `like` (`like`),
  KEY `unlike` (`unlike`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `post_num`
--

INSERT INTO `post_num` (`pid`, `like`, `unlike`, `repost`) VALUES
(11890554457494, 0, 0, 1),
(11890603445078, 0, 0, 0),
(11890680837610, 0, 0, 0),
(11890681590211, 0, 0, 0),
(11890691114919, 0, 0, 0),
(11890698675287, 0, 0, 0),
(11890700911450, 0, 0, 0),
(11890702871066, 0, 0, 0),
(11890707820864, 0, 0, 0),
(11890710984493, 0, 0, 0),
(11890723471438, 0, 0, 0),
(11890724240993, 0, 0, 0),
(11890724382988, 0, 0, 0),
(11890724689558, 0, 0, 0),
(11890727382512, 0, 0, 0),
(11890730308580, 0, 0, 0),
(11890752291724, 0, 0, 0),
(11890757889477, 0, 0, 0),
(11890929934093, 0, 0, 0),
(11890931499847, 0, 0, 0),
(11890933807355, 0, 0, 0),
(11891340841419, 0, 0, 0),
(11891346701322, 0, 0, 0),
(11891347737643, 0, 0, 0),
(11891348629689, 0, 0, 0),
(11891349418614, 0, 0, 0),
(111276974649573, 0, 0, 0),
(111276986759724, 0, 0, 0),
(111276989735797, 0, 0, 0),
(111276991284642, 0, 0, 0),
(111277042093552, 0, 0, 7),
(111277054473356, 0, 0, 0),
(111277055705467, 0, 0, 0),
(111277063550061, 0, 0, 0),
(111277069570873, 0, 0, 0),
(111277075521296, 0, 0, 0),
(111277671821843, 0, 0, 0),
(111277676543837, 0, 0, 1),
(111278021364588, 0, 0, 0),
(111285282854787, 0, 0, 2),
(111285301691065, 0, 0, 3);

-- --------------------------------------------------------

--
-- Table structure for table `repost_attitude`
--

CREATE TABLE IF NOT EXISTS `repost_attitude` (
  `rpid` bigint(20) unsigned NOT NULL,
  `uid` int(10) unsigned NOT NULL DEFAULT '0',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `flag` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`rpid`,`uid`),
  KEY `time` (`time`),
  KEY `flag` (`flag`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `repost_create`
--

CREATE TABLE IF NOT EXISTS `repost_create` (
  `uid` int(10) unsigned NOT NULL DEFAULT '0',
  `rpid` bigint(20) unsigned NOT NULL,
  `pid` bigint(20) unsigned NOT NULL,
  `ip` int(10) unsigned NOT NULL DEFAULT '0',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `content` varchar(4096) NOT NULL DEFAULT '',
  PRIMARY KEY (`rpid`),
  KEY `uid` (`uid`),
  KEY `pid` (`pid`),
  KEY `time` (`time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `repost_create`
--

INSERT INTO `repost_create` (`uid`, `rpid`, `pid`, `ip`, `time`, `content`) VALUES
(10000, 141284729338480, 11890554457494, 2130706433, '2011-12-27 20:41:33', 'my repost 1'),
(10000, 141284737965641, 111277042093552, 2130706433, '2011-12-27 20:42:59', 'i am good!'),
(10000, 141284800620715, 111277042093552, 2130706433, '2011-12-27 20:53:26', 'repost 2'),
(10000, 141284801054919, 111277042093552, 2130706433, '2011-12-27 20:53:30', 'repost 2'),
(10000, 141284818790469, 111277042093552, 2130706433, '2011-12-27 20:56:27', 'repost 2'),
(10000, 141284825015595, 111277042093552, 2130706433, '2011-12-27 20:57:30', 'repost 3'),
(0, 141285277009022, 111277042093552, 2130706433, '2011-12-27 22:12:50', 'hello'),
(0, 141285280763610, 111277042093552, 2130706433, '2011-12-27 22:13:27', 'hello'),
(10000, 141285285457374, 111285282854787, 2130706433, '2011-12-27 22:14:14', 'beging reply 1'),
(10000, 141285287142957, 111285282854787, 2130706433, '2011-12-27 22:14:31', 'beging reply 2'),
(10000, 141285288371244, 111277676543837, 2130706433, '2011-12-27 22:14:43', 'deve 1'),
(10000, 141285302674755, 111285301691065, 2130706433, '2011-12-27 22:17:06', 'repost'),
(10000, 141285360668985, 111285301691065, 2130706433, '2011-12-27 22:26:46', 'great'),
(10000, 141285361625885, 111285301691065, 2130706433, '2011-12-27 22:26:56', 'it works!');

-- --------------------------------------------------------

--
-- Table structure for table `repost_num`
--

CREATE TABLE IF NOT EXISTS `repost_num` (
  `rpid` bigint(20) unsigned NOT NULL,
  `like` int(10) unsigned NOT NULL DEFAULT '0',
  `unlike` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`rpid`),
  KEY `like` (`like`),
  KEY `unlike` (`unlike`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `repost_num`
--

INSERT INTO `repost_num` (`rpid`, `like`, `unlike`) VALUES
(141284729338480, 0, 0),
(141284737965641, 0, 0),
(141284800620715, 0, 0),
(141284801054919, 0, 0),
(141284818790469, 0, 0),
(141284825015595, 0, 0),
(141285277009022, 0, 0),
(141285280763610, 0, 0),
(141285285457374, 0, 0),
(141285287142957, 0, 0),
(141285288371244, 0, 0),
(141285302674755, 0, 0),
(141285360668985, 0, 0),
(141285361625885, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE IF NOT EXISTS `session` (
  `session_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'hashed value',
  `ip_address` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ip address',
  `user_agent` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user_agent',
  `last_activity` int(11) NOT NULL COMMENT 'seconds past since 01.01.1970 00:00:00',
  `user_data` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'data stored in session'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `topic_create`
--

CREATE TABLE IF NOT EXISTS `topic_create` (
  `tid` bigint(20) unsigned NOT NULL,
  `uid` int(10) unsigned NOT NULL DEFAULT '0',
  `ip` int(10) unsigned NOT NULL DEFAULT '0',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `title` varchar(1024) NOT NULL DEFAULT '',
  `desc` varchar(4096) NOT NULL DEFAULT '',
  `bg_img` varchar(400) NOT NULL,
  `interestId` char(3) NOT NULL DEFAULT '000',
  `chosen_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `extra_desc` varchar(1024) NOT NULL,
  `best_post` bigint(20) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`tid`),
  KEY `time` (`create_time`),
  KEY `type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `topic_create`
--

INSERT INTO `topic_create` (`tid`, `uid`, `ip`, `create_time`, `title`, `desc`, `bg_img`, `interestId`, `chosen_time`, `status`, `type`, `extra_desc`, `best_post`) VALUES
(10465894240386, 10000, 2130706433, '2011-09-24 02:09:02', 'With ''real-time'' apps, Facebook is always watching', '(CNN) -- A couple years ago, a Microsoft researcher named Gordon Bell embarked on a personal experiment: He would wear a video camera around his neck all the time and keep this &quot;life recorder&quot; always turned on, so it would record everything he did.\nIt was like an external memory drive for his brain, he wrote in a book called &quot;Total Recall.&quot;\nSounds pretty sci-fi, right? Not so much. The &quot;real-time sharing&quot; updates Facebook announced Thursday aim to do something quite similar -- only for the Internet instead of in real life.\nBefore we get into the details and implications, here''s a &quot;real-time&quot; example of how the updates, which are rolling out in the coming weeks, will work: As I write this, I''m listening to the band LCD Soundsystem on an Internet music service called Spotify. Because I''ve updated my Facebook page (here''s a TechCrunch article on how to do that if you''re interested) and because I''ve logged in to Spotify with my Facebook identity, every song I listen to is automatically shared to Facebook.', '/includes/images/topic.png', '000', '0000-00-00 00:00:00', 1, 0, '', 0),
(10465904992264, 10000, 2130706433, '2011-09-24 02:10:49', 'Comment12  inShare 124  TechCrunch Founder Michael Arrington Launches A New Blog, Uncrunched', 'TechCrunch founder Michael Arrington, who recently left the company he founded over six years ago, is back in action. Or at least, he has proven that he still knows how to set up a WordPress blog.\n\nArrington just tweeted a link to Uncrunched, which will be his personal blog from here on out. There isn’t really much there yet, save for his first post titled, ‘Here I Am’. That’s it — the post consists of just the title — but presumably his later posts will be a little more content-heavy (fingers crossed that this new role as General Partner at CrunchFund is just a ploy to unearth all of Silicon Valley’s dark secrets).\n\nWhich brings us to the comments.\n\nArrington has apparently decided to use the basic WordPress commenting system. It’s a brave move (you may remember the TechCrunch comments of yore), but the trolls haven’t overwhelmed the blog just yet.\n\nIn keeping with time-honored Internet tradition, the first comment on the blog is “omg. first.” — congratulations to former TC developer and Cake Health cofounder Andy Brett for claiming the top spot. And an ‘A’ for effort to Philip Kaplan, who wrote “first” despite being the blog’s twelfth comment. The remainder of the comments are generally positive, though there are a few outliers, like the one embedded below.', '/includes/images/topic.png', '000', '0000-00-00 00:00:00', 1, 1, '', 0),
(10466103771951, 10000, 2130706433, '2011-09-24 02:43:57', 'magine K12′s 2011 Startup Class Aims To Invigorate Education With Technology', 'ne of my favorite bits from Disrupt SF was the set of rapid-fire presentations from Imagine K12, an incubator for education-related startups. We heard in June that some 200 applicants had been narrowed down to 10 companies, and those 10 made brief presentations in front of the audience at Disrupt. We couldn’t write them up at the time, so here is a belated rundown of these interesting new companies and services.\n\nI urge our readers to watch the video or at least skim our summaries and evaluations. Startups too seldom directly address social issues like this, and one of these services might be something that can really benefit you or your kids.\n\nI’ll go through these in the order they gave presentations, and I’ll give timecodes for each so you can skip directly to them if you like.', '/includes/images/topic.png', '000', '2011-10-15 04:00:00', 2, 1, '', 0),
(10466300903932, 10000, 2130706433, '2011-09-24 03:16:49', 'eal Decor To Launch A Groupon For Furniture', '’m not often the fan of startups that are “the this, for that,” but I think I could get into something like Deal Décor: it’s the Groupon for furniture. This San Francisco-based startup is using the group-buying model made popular by Groupon to connect customers with factory-direct deals from overseas furniture manufacturers.\n\nThe company is launching on Monday in San Francisco, which will serve as the pilot program for the service for 6 months. Afterwards, the plan is to launch in one new city every month, scaling up to reach the 20 largest metro areas in the U.S.', '/includes/images/topic.png', '000', '0000-00-00 00:00:00', 2, 1, '', 0),
(10891163480939, 10005, 2130706433, '2011-11-12 07:27:14', 'Greece swears in Papademos at head of unity government', 'Papademos, a former banker and European Central Bank vice president, becomes the country''s interim prime minister after several days of political wrangling.\nHis ministers were also sworn in at a ceremony attended by the president and the head of the Greek Orthodox Church.\nFinance Minister Evangelos Venizelos has retained his post in the new government, the prime minister''s office said.', '/includes/images/topic.png', '123', '0000-00-00 00:00:00', 1, 0, '', 0),
(10891183428086, 10005, 2130706433, '2011-11-12 07:30:34', 'Greece swears in Papademos at head of unity government', 'Papademos, a former banker and European Central Bank vice president, becomes the country''s interim prime minister after several days of political wrangling.\nHis ministers were also sworn in at a ceremony attended by the president and the head of the Greek Orthodox Church.\nFinance Minister Evangelos Venizelos has retained his post in the new government, the prime minister''s office said.', '/includes/images/topic.png', '123', '0000-00-00 00:00:00', 1, 0, '', 0),
(10891200443185, 10005, 2130706433, '2011-11-12 07:33:24', 'Greece swears in Papademos at head of unity government', 'Papademos, a former banker and European Central Bank vice president, becomes the country''s interim prime minister after several days of political wrangling.\nHis ministers were also sworn in at a ceremony attended by the president and the head of the Greek Orthodox Church.\nFinance Minister Evangelos Venizelos has retained his post in the new government, the prime minister''s office said.', '/includes/images/topic.png', '123', '0000-00-00 00:00:00', 1, 0, '', 0),
(10891247899745, 10005, 2130706433, '2011-11-12 07:41:18', 'Greece swears in Papademos at head of unity government', 'Papademos, a former banker and European Central Bank vice president, becomes the country''s interim prime minister after several days of political wrangling.\nHis ministers were also sworn in at a ceremony attended by the president and the head of the Greek Orthodox Church.\nFinance Minister Evangelos Venizelos has retained his post in the new government, the prime minister''s office said.', '/includes/images/topic.png', '123', '0000-00-00 00:00:00', 1, 0, '', 0),
(10891330653476, 10000, 2130706433, '2011-11-12 07:55:06', 'Greece swears in Papademos at head of unity government', 'Papademos, a former banker and European Central Bank vice president, becomes the country''s interim prime minister after several days of political wrangling.\nHis ministers were also sworn in at a ceremony attended by the president and the head of the Greek Orthodox Church.\nFinance Minister Evangelos Venizelos has retained his post in the new government, the prime minister''s office said.', '/includes/images/topic.png', '123', '2011-11-12 07:55:06', 1, 1, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `topic_num`
--

CREATE TABLE IF NOT EXISTS `topic_num` (
  `tid` bigint(20) unsigned NOT NULL,
  `f_num` int(10) unsigned NOT NULL DEFAULT '0',
  `p_num` int(10) unsigned NOT NULL DEFAULT '0',
  `q_num` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`tid`),
  KEY `f_num` (`f_num`),
  KEY `c_num` (`p_num`),
  KEY `q_num` (`q_num`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `topic_num`
--

INSERT INTO `topic_num` (`tid`, `f_num`, `p_num`, `q_num`) VALUES
(10466103771951, 2, 29, 0),
(10466300903932, 1, 3, 0),
(10891163480939, 0, 0, 0),
(10891183428086, 0, 0, 0),
(10891200443185, 0, 0, 0),
(10891247899745, 0, 0, 0),
(10891256892711, 0, 0, 0),
(10891290763540, 0, 0, 0),
(10891292043761, 1, 0, 0),
(10891298747587, 1, 0, 0),
(10891330653476, 2, 6, 0);

-- --------------------------------------------------------

--
-- Table structure for table `topic_user_info`
--

CREATE TABLE IF NOT EXISTS `topic_user_info` (
  `tid` bigint(20) unsigned NOT NULL,
  `uid` int(10) unsigned NOT NULL DEFAULT '0',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_type` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`tid`,`uid`),
  KEY `time` (`time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `topic_user_info`
--

INSERT INTO `topic_user_info` (`tid`, `uid`, `time`, `user_type`) VALUES
(10465904992264, 10005, '2011-11-12 06:48:40', 0),
(10466103771951, 10000, '2011-12-26 15:14:52', 0),
(10466103771951, 10005, '2011-11-10 23:54:31', 0),
(10466300903932, 10005, '2011-11-10 23:28:16', 0),
(10891330653476, 10000, '2011-11-12 07:55:06', 1),
(10891330653476, 10005, '2011-11-12 07:58:24', 0);

-- --------------------------------------------------------

--
-- Table structure for table `topic_vote_num`
--

CREATE TABLE IF NOT EXISTS `topic_vote_num` (
  `tid` bigint(20) unsigned NOT NULL,
  `v_num` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`tid`),
  KEY `v_num` (`v_num`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `topic_vote_num`
--

INSERT INTO `topic_vote_num` (`tid`, `v_num`) VALUES
(10465894240386, 0),
(10465904992264, 0),
(10465958777778, 0),
(10466103771951, 0),
(10466300903932, 0),
(10891136567494, 0),
(10891141802988, 0),
(10891163480939, 0),
(10891183428086, 0),
(10891200443185, 0),
(10891247899745, 0),
(10891256892711, 0),
(10891290763540, 0),
(10891292043761, 0),
(10891298747587, 0),
(10891330653476, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_autologin`
--

CREATE TABLE IF NOT EXISTS `user_autologin` (
  `key_id` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT 'key id',
  `user_id` int(11) NOT NULL COMMENT 'foreign key from user table',
  `user_agent` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user agent',
  `last_ip` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT 'last ip of the user',
  `last_login` datetime NOT NULL COMMENT 'last login time',
  PRIMARY KEY (`key_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_autologin`
--

INSERT INTO `user_autologin` (`key_id`, `user_id`, `user_agent`, `last_ip`, `last_login`) VALUES
('0ae38b8a375f52538b5739d27f343bd9', 10000, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/5', '127.0.0.1', '2011-11-05 22:29:46'),
('aa9a2091a661d2f76e6b4a9c09bf37aa', 10000, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; r', '127.0.0.1', '2011-11-03 16:10:19'),
('d40d6443dbd3744e10b077ebb30d2fe3', 10001, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/5', '127.0.0.1', '2011-11-05 22:31:14');

-- --------------------------------------------------------

--
-- Table structure for table `user_base`
--

CREATE TABLE IF NOT EXISTS `user_base` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL DEFAULT '0',
  `desc` varchar(1500) NOT NULL DEFAULT '',
  `image` varchar(400) NOT NULL,
  `interestId` int(10) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `domain` varchar(50) NOT NULL DEFAULT '',
  `active` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `user_base`
--

INSERT INTO `user_base` (`id`, `uid`, `desc`, `image`, `interestId`, `fullname`, `domain`, `active`) VALUES
(1, 10000, 'Focus on internet start-up!', '/includes/images/default_medium.png', 123, 'Bosai Chen', 'bosai', 2),
(2, 10001, 'Great!', '/includes/images/default_medium.png', 123, 'Qianxing Lu', 'Qianxing', 2),
(3, 10002, 'From newhouse', '/includes/images/default_medium.png', 123, 'Gyoung', 'Gyong', 2),
(4, 10003, 'Media study!', '/includes/images/default_medium.png', 123, 'Emily', 'emily', 2),
(5, 10004, 'Boss', '/includes/images/default_medium.png', 123, 'Frank', 'frank', 2),
(6, 10005, 'boss', '/includes/images/default_medium.png', 123, 'biocca', 'biocca', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_ext`
--

CREATE TABLE IF NOT EXISTS `user_ext` (
  `uid` int(10) unsigned NOT NULL DEFAULT '0',
  `reg_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `reg_ip` bigint(20) unsigned NOT NULL,
  `user_type` tinyint(4) NOT NULL DEFAULT '1',
  `reg_source` tinyint(4) NOT NULL DEFAULT '1',
  `active_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `crazy_topic` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`uid`),
  KEY `reg_time` (`reg_time`),
  KEY `reg_ip` (`reg_ip`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_ext`
--

INSERT INTO `user_ext` (`uid`, `reg_time`, `reg_ip`, `user_type`, `reg_source`, `active_time`, `crazy_topic`) VALUES
(10000, '2011-09-06 01:07:00', 2130706433, 1, 0, '2011-08-28 03:42:09', 0),
(10001, '2011-11-06 02:20:00', 2130706433, 1, 0, '2011-11-06 02:20:00', 0),
(10002, '2011-11-06 17:47:52', 2130706433, 1, 0, '2011-11-06 17:47:52', 0),
(10003, '2011-11-07 21:29:20', 2130706433, 1, 0, '2011-11-07 21:29:20', 0),
(10004, '2011-11-09 21:24:58', 2130706433, 1, 0, '2011-11-09 21:24:58', 0),
(10005, '2011-11-09 21:27:04', 2130706433, 1, 0, '2011-11-09 21:27:04', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_post_num`
--

CREATE TABLE IF NOT EXISTS `user_post_num` (
  `uid` int(10) unsigned NOT NULL DEFAULT '0',
  `num` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_post_num`
--

INSERT INTO `user_post_num` (`uid`, `num`) VALUES
(10002, 0),
(10003, 0),
(10004, 0),
(10005, 30);

-- --------------------------------------------------------

--
-- Table structure for table `user_repost_num`
--

CREATE TABLE IF NOT EXISTS `user_repost_num` (
  `uid` int(10) unsigned NOT NULL DEFAULT '0',
  `rpid` bigint(20) unsigned NOT NULL,
  `like` int(10) unsigned NOT NULL DEFAULT '0',
  `unlike` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`rpid`),
  KEY `like` (`like`),
  KEY `unlike` (`unlike`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_topic_info`
--

CREATE TABLE IF NOT EXISTS `user_topic_info` (
  `uid` int(10) unsigned NOT NULL DEFAULT '0',
  `tid` bigint(20) unsigned NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `topic_type` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid`,`tid`),
  KEY `time` (`time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_topic_info`
--

INSERT INTO `user_topic_info` (`uid`, `tid`, `time`, `topic_type`) VALUES
(10000, 10466103771951, '2011-12-26 15:14:52', 0),
(10000, 10891330653476, '2011-11-12 07:55:06', 1),
(10005, 10465904992264, '2011-11-12 06:48:40', 0),
(10005, 10466103771951, '2011-11-10 23:54:31', 0),
(10005, 10466300903932, '2011-11-10 23:28:16', 0),
(10005, 10891330653476, '2011-11-12 07:58:24', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_topic_num`
--

CREATE TABLE IF NOT EXISTS `user_topic_num` (
  `uid` int(10) unsigned NOT NULL DEFAULT '0',
  `tid` bigint(20) unsigned NOT NULL DEFAULT '0',
  `p_num` int(10) unsigned NOT NULL DEFAULT '0',
  `q_num` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid`,`tid`),
  KEY `q_num` (`q_num`),
  KEY `p_num` (`p_num`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_topic_num`
--

INSERT INTO `user_topic_num` (`uid`, `tid`, `p_num`, `q_num`) VALUES
(10000, 10466103771951, 11, 0),
(10000, 10466300903932, 3, 0),
(10000, 10891330653476, 4, 0),
(10005, 10465904992264, 2, 0),
(10005, 10466103771951, 18, 0),
(10005, 10466300903932, 0, 0),
(10005, 10891298747587, 0, 0),
(10005, 10891330653476, 0, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
