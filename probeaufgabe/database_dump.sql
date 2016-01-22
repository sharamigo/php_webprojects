-- Adminer 4.0.3 MySQL dump

SET NAMES utf8;
SET foreign_key_checks = 0;
SET time_zone = '+01:00';
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `files`;
CREATE TABLE `files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) NOT NULL,
  `ftype` varchar(50) NOT NULL,
  `filesize` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `files` (`id`, `filename`, `ftype`, `filesize`, `created_at`) VALUES
(1,	'textdatei01.txt',	'text/plain',	41,	'2016-01-20 14:05:36'),
(2,	'textdatei03.txt',	'text/plain',	41,	'2016-01-20 14:07:10'),
(3,	'testdatei.rtf',	'application/msword',	40507,	'2016-01-20 15:00:59'),
(4,	'testdatei.rtf',	'application/msword',	40507,	'2016-01-20 15:03:52'),
(6,	'test.txt',	'text/plain',	24,	'2016-01-20 15:16:57'),
(7,	'test.txt',	'text/plain',	24,	'2016-01-20 15:18:16'),
(8,	'test.txt',	'text/plain',	24,	'2016-01-20 15:20:21'),
(9,	'testdatei.rtf',	'application/msword',	40507,	'2016-01-20 15:21:41'),
(10,	'textdatei01.txt',	'text/plain',	41,	'2016-01-20 15:30:20'),
(11,	'testdatei.rtf',	'application/msword',	40507,	'2016-01-20 15:32:11'),
(12,	'test.txt',	'text/plain',	24,	'2016-01-20 15:33:16'),
(13,	'test.txt',	'text/plain',	24,	'2016-01-20 15:39:55'),
(14,	'testdatei.rtf',	'application/msword',	40507,	'2016-01-20 15:48:06'),
(15,	'testdatei.rtf',	'application/msword',	40507,	'2016-01-20 15:49:40'),
(16,	'testfile03.txt',	'application/msword',	40507,	'2016-01-20 16:09:09'),
(18,	'testdatei.rtf',	'application/msword',	40507,	'2016-01-20 17:22:26'),
(19,	'textdatei01.txt',	'text/plain',	41,	'2016-01-20 17:23:59'),
(20,	'',	'',	0,	'2016-01-20 17:42:30'),
(21,	'worksheet1.xlsx',	'application/vnd.openxmlformats-officedocument.spre',	6318,	'2016-01-20 17:42:38');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `user_files`;
CREATE TABLE `user_files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `fileid` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fileid` (`fileid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- 2016-01-20 17:44:39