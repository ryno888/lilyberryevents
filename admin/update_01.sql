-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.17 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Version:             9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table loc_lily_berry_events.album
DROP TABLE IF EXISTS `album`;
CREATE TABLE IF NOT EXISTS `album` (
  `alb_id` int(11) NOT NULL AUTO_INCREMENT,
  `alb_name` varchar(256) NOT NULL DEFAULT '',
  `alb_detail` text NOT NULL,
  `alb_date_created` datetime DEFAULT NULL,
  `alb_is_visible` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`alb_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table loc_lily_berry_events.album: ~0 rows (approximately)
/*!40000 ALTER TABLE `album` DISABLE KEYS */;
/*!40000 ALTER TABLE `album` ENABLE KEYS */;


-- Dumping structure for table loc_lily_berry_events.comm
DROP TABLE IF EXISTS `comm`;
CREATE TABLE IF NOT EXISTS `comm` (
  `com_id` int(11) NOT NULL AUTO_INCREMENT,
  `com_from` varchar(256) NOT NULL DEFAULT '',
  `com_sender_name` varchar(256) NOT NULL DEFAULT '',
  `com_sender_contactnr` varchar(256) NOT NULL DEFAULT '',
  `com_date_created` datetime DEFAULT NULL,
  `com_message` text,
  `com_status` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`com_id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=latin1;

-- Dumping data for table loc_lily_berry_events.comm: ~7 rows (approximately)
/*!40000 ALTER TABLE `comm` DISABLE KEYS */;
/*!40000 ALTER TABLE `comm` ENABLE KEYS */;


-- Dumping structure for table loc_lily_berry_events.image
DROP TABLE IF EXISTS `image`;
CREATE TABLE IF NOT EXISTS `image` (
  `img_id` int(11) NOT NULL AUTO_INCREMENT,
  `img_name` varchar(256) NOT NULL DEFAULT '',
  `img_ref_album` int(11) DEFAULT NULL,
  `img_date_created` datetime DEFAULT NULL,
  `img_is_main` tinyint(4) DEFAULT '0',
  `img_data` longtext,
  `img_type` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`img_id`),
  KEY `fk_img_ref_album` (`img_ref_album`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table loc_lily_berry_events.image: ~0 rows (approximately)
/*!40000 ALTER TABLE `image` DISABLE KEYS */;
/*!40000 ALTER TABLE `image` ENABLE KEYS */;


-- Dumping structure for table loc_lily_berry_events.person
DROP TABLE IF EXISTS `person`;
CREATE TABLE IF NOT EXISTS `person` (
  `per_id` int(11) NOT NULL AUTO_INCREMENT,
  `per_type` tinyint(4) NOT NULL DEFAULT '0',
  `per_firstname` varchar(256) NOT NULL DEFAULT '',
  `per_lastname` varchar(256) NOT NULL DEFAULT '',
  `per_email` varchar(256) NOT NULL DEFAULT '',
  `per_username` varchar(256) NOT NULL DEFAULT '',
  `per_password` varchar(256) NOT NULL DEFAULT '',
  `per_online` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`per_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table loc_lily_berry_events.person: ~2 rows (approximately)
/*!40000 ALTER TABLE `person` DISABLE KEYS */;
INSERT INTO `person` (`per_id`, `per_type`, `per_firstname`, `per_lastname`, `per_email`, `per_username`, `per_password`, `per_online`) VALUES
	(1, 1, 'Ryno', 'Van Zyl', 'ryno888@gmail.com', 'ryno888', 'admin1', 0),
	(3, 1, 'Leonelle', 'Van der Berg', 'info@lilyberryevents.com', 'info@lilyberryevents.com', 'L3on3ll3', 0);
/*!40000 ALTER TABLE `person` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
