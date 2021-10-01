-- MySQL dump 10.19  Distrib 10.3.29-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: tasks
-- ------------------------------------------------------
-- Server version	10.3.29-MariaDB-0+deb10u1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `assignment_log`
--

DROP TABLE IF EXISTS `assignment_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `assignment_log` (
  `assignment_log_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `duration` decimal(10,1) NOT NULL,
  `timestamp_created` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`assignment_log_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assignment_log`
--

LOCK TABLES `assignment_log` WRITE;
/*!40000 ALTER TABLE `assignment_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `assignment_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `attachments`
--

DROP TABLE IF EXISTS `attachments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `attachments` (
  `attachment_id` int(11) NOT NULL AUTO_INCREMENT,
  `task_id` int(11) NOT NULL,
  `attachment` varchar(200) NOT NULL,
  `file_path` varchar(500) NOT NULL,
  `timestamp_created` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`attachment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attachments`
--

LOCK TABLES `attachments` WRITE;
/*!40000 ALTER TABLE `attachments` DISABLE KEYS */;
INSERT INTO `attachments` VALUES (1,1,'000-versions-commits.png','../../upload/20210930/86112.0037-3701.png','2021-10-01 06:55:12');
/*!40000 ALTER TABLE `attachments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bug`
--

DROP TABLE IF EXISTS `bug`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bug` (
  `bug_id` int(11) NOT NULL AUTO_INCREMENT,
  `priority` int(11) NOT NULL DEFAULT 2,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `state` tinyint(4) NOT NULL DEFAULT 1,
  `created_by` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`bug_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bug`
--

LOCK TABLES `bug` WRITE;
/*!40000 ALTER TABLE `bug` DISABLE KEYS */;
/*!40000 ALTER TABLE `bug` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cell_carriers`
--

DROP TABLE IF EXISTS `cell_carriers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cell_carriers` (
  `cell_carrier_id` int(11) NOT NULL AUTO_INCREMENT,
  `cell_carrier` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `timestamp_created` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`cell_carrier_id`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cell_carriers`
--

LOCK TABLES `cell_carriers` WRITE;
/*!40000 ALTER TABLE `cell_carriers` DISABLE KEYS */;
INSERT INTO `cell_carriers` VALUES (1,'Airfire Mobile','@sms.airfiremobile.com','2013-01-22 21:27:36'),(2,'Alaska Communications','@msg.acsalaska.com','2013-01-22 21:27:36'),(3,'Alltel','@sms.alltelwireless.com','2013-01-22 21:28:28'),(4,'Verizon Wireless','@text.wireless.alltel.com','2013-01-22 21:28:28'),(5,'Ameritech','@paging.acswireless.com','2013-01-22 21:29:15'),(6,'AT&T Wireless','@txt.att.net','2013-01-22 21:29:15'),(7,'BellSouth','@bellsouth.cl','2013-01-22 21:30:13'),(8,'Bluegrass Cellular','@sms.bluecell.com','2013-01-22 21:30:13'),(9,'Boost Mobile','@myboostmobile.com','2013-01-22 21:30:43'),(10,'Cellcom','@cellcom.quiktxt.com','2013-01-22 21:30:43'),(11,'Cellurar South','@csouth1.com','2013-01-22 21:33:04'),(12,'Centennial Wireless','@cwemail.com','2013-01-22 21:33:04'),(13,'Chariton Valley Wireless','@sms.cvalley.net','2013-01-22 21:33:28'),(14,'Cincinnati Bell','@gocbw.com','2013-01-22 21:33:28'),(15,'Cingular','@cingular.com','2013-01-22 21:34:09'),(16,'GoPhone','@cingulartext.com','2013-01-22 21:34:09'),(17,'Cleartalk','@sms.cleartalk.us','2013-01-22 21:34:31'),(18,'Cricket','@sms.mycricket.com','2013-01-22 21:34:31'),(19,'C Spire Wireless','@cspire1.com','2013-01-22 21:34:52'),(20,'Edge Wireless','@sms.edgewireless.com','2013-01-22 21:34:52'),(21,'Element Mobile','@SMS.elementmobile.net','2013-01-22 21:35:13'),(22,'Esendex','@echoemail.net','2013-01-22 21:35:13'),(23,'General Communications Inc.','@mobile.gci.net','2013-01-22 21:35:37'),(24,'Golden State Cellular','@gscsms.com','2013-01-22 21:35:37'),(25,'Hawaiian Telcom Wireless','@hawaii.sprintpcs.com','2013-01-22 21:36:01'),(26,'Helio','@myhelio.com','2013-01-22 21:36:01'),(27,'i wireless (T-Mobile)','.iws@iwspcs.net','2013-01-22 21:36:42'),(28,'i-wireless (Sprint PCS)','@iwirelesshometext.com','2013-01-22 21:36:42'),(29,'Kajeet','@mobile.kajeet.net','2013-01-22 21:37:01'),(30,'LongLines','@text.longlines.com','2013-01-22 21:37:01'),(31,'MetroPCS','@mymetropcs.com','2013-01-22 21:37:27'),(32,'Nextech','@sms.nextechwireless.com','2013-01-22 21:37:27'),(33,'Nextel','@messaging.nextel.com','2013-01-22 21:37:50'),(34,'Page Plus Cellular','@vtext.com','2013-01-22 21:37:50'),(35,'Pioneer Cellular','@zsend.com','2013-01-22 21:38:15'),(36,'Pocket Wireless','@sms.pocket.com','2013-01-22 21:38:15'),(37,'Qwest Wireless','@qwestmp.com','2013-01-22 21:39:08'),(38,'Red Pocket Mobile','@txt.att.net','2013-01-22 21:39:08'),(39,'Simple Mobile','@smtext.com','2013-01-22 21:39:31'),(40,'Southernlinc','@page.southernlinc.com','2013-01-22 21:39:31'),(41,'South Central Communications','@rinasms.com','2013-01-22 21:40:05'),(42,'Sprint','@messaging.sprintpcs.com','2013-01-22 21:40:05'),(43,'Sprint Nextel','@messaging.nextel.com','2013-01-22 21:40:38'),(44,'Straight Talk','@vtext.com','2013-01-22 21:40:38'),(45,'Syringa Wireless','@rinasms.com','2013-01-22 21:41:18'),(46,'T-Mobile','@tmomail.net','2013-01-22 21:41:18'),(47,'Teleflip','@teleflip.com','2013-01-22 21:41:42'),(48,'Telus Mobility','@msg.telus.com','2013-01-22 21:41:42'),(49,'TracFone','@mmst5.tracfone.com','2013-01-22 21:42:12'),(50,'Unicel','@utext.com','2013-01-22 21:42:12'),(51,'US Cellular','@email.uscc.net','2013-01-22 21:42:30'),(52,'USA Mobility','@usamobility.net','2013-01-22 21:42:30'),(53,'Verizon Wireless','@vtext.com','2013-01-22 21:42:51'),(54,'Viaero','@viaerosms.com','2013-01-22 21:42:51'),(55,'Virgin Mobile','@vmobl.com','2013-01-22 21:43:16'),(56,'West Central Wireless','@sms.wcc.net','2013-01-22 21:43:16'),(57,'XIT Communications','@sms.xit.net','2013-01-22 21:43:27');
/*!40000 ALTER TABLE `cell_carriers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `task_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `project_id_snapshot` int(11) NOT NULL,
  `priority_id_snapshot` int(11) NOT NULL,
  `status_id_snapshot` int(11) NOT NULL,
  `assigned_to_snapshot` int(11) NOT NULL,
  `time_estimated_snapshot` decimal(10,1) NOT NULL,
  `time_actual_snapshot` decimal(10,1) NOT NULL,
  `timestamp_created` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`comment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (1,1,1,'Task created. (Add versioning system)',1,3,1,1,0.0,0.0,'2021-10-01 06:18:22'),(2,2,1,'Task created. (test)',1,5,1,1,0.0,0.0,'2021-10-01 06:20:33'),(3,3,1,'Task created. (test)',1,5,1,1,0.0,0.0,'2021-10-01 06:22:27'),(4,1,1,'Task updated. (Add versioning system)',1,3,2,1,0.0,0.0,'2021-10-01 06:46:09'),(5,4,1,'Task created. (Update look and feel)',1,3,1,1,0.0,0.0,'2021-10-01 06:47:13'),(6,1,1,'Add methods for assigning versions to tasks and add features for version tracking.',1,3,2,1,0.0,0.0,'2021-10-01 06:47:49'),(7,4,1,'Change round buttons and text fields to square and change background color and button color or add color options in settings.',1,3,1,1,0.0,0.0,'2021-10-01 06:49:02'),(8,5,1,'Task created. (Fix dont show filter option)',1,4,1,1,0.0,0.0,'2021-10-01 06:51:50'),(9,5,1,'the dont_show filter option isn\'t working.',1,4,1,1,0.0,0.0,'2021-10-01 06:52:04'),(10,5,1,'Temporarily hid dont show filter options.',1,4,1,1,0.0,0.0,'2021-10-01 06:53:14'),(11,1,1,'Attachments uploaded.<br><br><a href=\'../../upload/20210930/86112.0037-3701.png\'>000-versions-commits.png</a>',1,3,2,1,0.0,0.0,'2021-10-01 06:55:12'),(12,1,1,'Task updated. (Add versioning system)',1,3,3,1,0.0,0.0,'2021-10-01 06:55:41'),(13,4,1,'Task updated. (Update look and feel)',1,3,2,1,0.0,0.0,'2021-10-01 06:55:58');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contacts` (
  `contact_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `email` varchar(200) NOT NULL,
  `timestamp_created` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`contact_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contacts`
--

LOCK TABLES `contacts` WRITE;
/*!40000 ALTER TABLE `contacts` DISABLE KEYS */;
/*!40000 ALTER TABLE `contacts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `priorities`
--

DROP TABLE IF EXISTS `priorities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `priorities` (
  `priority_id` int(11) NOT NULL AUTO_INCREMENT,
  `priority` varchar(20) NOT NULL,
  `order_by` int(3) NOT NULL,
  `timestamp_created` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`priority_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `priorities`
--

LOCK TABLES `priorities` WRITE;
/*!40000 ALTER TABLE `priorities` DISABLE KEYS */;
INSERT INTO `priorities` VALUES (1,'Catastrophic',5,'0000-00-00 00:00:00'),(2,'Critical',4,'0000-00-00 00:00:00'),(3,'Major',3,'0000-00-00 00:00:00'),(4,'Minor',2,'0000-00-00 00:00:00'),(5,'Trivial',1,'0000-00-00 00:00:00');
/*!40000 ALTER TABLE `priorities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `projects` (
  `project_id` int(11) NOT NULL AUTO_INCREMENT,
  `project` varchar(20) NOT NULL,
  `order_by` int(3) NOT NULL,
  `timestamp_created` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`project_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects`
--

LOCK TABLES `projects` WRITE;
/*!40000 ALTER TABLE `projects` DISABLE KEYS */;
INSERT INTO `projects` VALUES (1,'Task Tracker Updates',1,'2021-09-28 21:26:03');
/*!40000 ALTER TABLE `projects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_user_link`
--

DROP TABLE IF EXISTS `role_user_link`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_user_link` (
  `link_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `timestamp_created` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`link_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_user_link`
--

LOCK TABLES `role_user_link` WRITE;
/*!40000 ALTER TABLE `role_user_link` DISABLE KEYS */;
/*!40000 ALTER TABLE `role_user_link` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(20) NOT NULL,
  `order_by` int(3) NOT NULL,
  `timestamp_created` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Administrator',1,'2013-01-22 17:10:40'),(2,'Developer',2,'2013-01-22 17:10:40'),(3,'Tester',3,'2013-01-22 17:10:59'),(4,'Production',4,'2013-01-22 17:10:59');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `status`
--

DROP TABLE IF EXISTS `status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `status` (
  `status_id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(20) NOT NULL,
  `order_by` int(3) NOT NULL,
  `timestamp_created` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `status`
--

LOCK TABLES `status` WRITE;
/*!40000 ALTER TABLE `status` DISABLE KEYS */;
INSERT INTO `status` VALUES (1,'Not Started',1,'2013-01-22 17:04:43'),(2,'In Development',2,'2013-01-22 17:04:43'),(3,'In Staging',3,'2013-01-22 17:04:59'),(4,'Staging Verified',4,'2013-01-22 17:04:59'),(5,'In Production',5,'2013-01-22 17:05:17'),(6,'Production Verified',6,'2013-01-22 17:05:17');
/*!40000 ALTER TABLE `status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `status_colors`
--

DROP TABLE IF EXISTS `status_colors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `status_colors` (
  `status_color_id` int(11) NOT NULL AUTO_INCREMENT,
  `status_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `color` varchar(6) NOT NULL,
  `timestamp_created` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`status_color_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `status_colors`
--

LOCK TABLES `status_colors` WRITE;
/*!40000 ALTER TABLE `status_colors` DISABLE KEYS */;
INSERT INTO `status_colors` VALUES (7,1,1,'B0B0B0','2021-09-28 21:39:59'),(8,2,1,'93D68B','2021-09-28 21:39:59'),(9,3,1,'FF9191','2021-09-28 21:39:59'),(10,4,1,'FFE9A1','2021-09-28 21:39:59'),(11,5,1,'B0F2FF','2021-09-28 21:39:59'),(12,6,1,'F2B3FF','2021-09-28 21:39:59');
/*!40000 ALTER TABLE `status_colors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tasks`
--

DROP TABLE IF EXISTS `tasks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tasks` (
  `task_id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `priority_id` int(11) NOT NULL DEFAULT 2,
  `status_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `assigned_to` int(11) NOT NULL,
  `time_estimated` decimal(10,1) NOT NULL,
  `time_actual` decimal(10,1) NOT NULL,
  `idle_time` decimal(10,1) DEFAULT NULL,
  `timestamp_created` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`task_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tasks`
--

LOCK TABLES `tasks` WRITE;
/*!40000 ALTER TABLE `tasks` DISABLE KEYS */;
INSERT INTO `tasks` VALUES (1,1,3,3,'Add versioning system',1,1,0.0,0.0,0.0,'2021-10-01 06:18:22'),(4,1,3,2,'Update look and feel',1,1,0.0,0.0,0.0,'2021-10-01 06:47:13'),(5,1,4,1,'Fix dont show filter option',1,1,0.0,0.0,NULL,'2021-10-01 06:51:50');
/*!40000 ALTER TABLE `tasks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `email` varchar(200) DEFAULT NULL,
  `cell_carrier_id` int(11) DEFAULT NULL,
  `cell` varchar(50) DEFAULT NULL,
  `timezone_offset` varchar(20) DEFAULT NULL,
  `search_where` varchar(20) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  `priority_id` int(11) DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `assigned_to` int(11) DEFAULT NULL,
  `order_tasks_by` varchar(40) DEFAULT NULL,
  `dont_show` int(11) DEFAULT NULL,
  `notification_task_created` int(1) DEFAULT 0,
  `notification_my_task_changed` int(1) DEFAULT 1,
  `notification_my_task_commented` int(1) DEFAULT 1,
  `notification_task_changed` int(1) DEFAULT 0,
  `notification_task_commented` int(1) DEFAULT 0,
  `notification_by_email` int(1) DEFAULT 1,
  `notification_by_cell` int(1) DEFAULT 0,
  `timestamp_created` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'testuser','5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8','test@test.com',NULL,NULL,NULL,'title_comments',0,0,0,0,0,'',0,0,0,0,0,0,0,0,'2021-09-28 21:34:41');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-09-30 23:58:48
