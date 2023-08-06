-- MySQL dump 10.13  Distrib 5.1.73, for redhat-linux-gnu (x86_64)
--
-- Host: localhost    Database: db_otikrd
-- ------------------------------------------------------
-- Server version	5.1.73

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `tbl_master_administrator`
--

DROP TABLE IF EXISTS `tbl_master_administrator`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_master_administrator` (
  `uID` int(11) NOT NULL AUTO_INCREMENT,
  `uUserName` varchar(100) NOT NULL,
  `uPasswd` varchar(100) NOT NULL,
  `uFullName` varchar(100) NOT NULL,
  `uGrpID` int(10) DEFAULT NULL,
  `uPersProfile` int(1) NOT NULL,
  `uPersAccount` int(1) NOT NULL,
  `uPersReports` int(1) NOT NULL,
  `uPersOnline` int(1) NOT NULL,
  `uStatus` int(1) NOT NULL,
  `uCrtDate` datetime NOT NULL,
  `uUpdDate` datetime NOT NULL,
  `uDep` varchar(100) DEFAULT NULL,
  `uPicture` varchar(100) DEFAULT NULL,
  `uEmail` varchar(50) DEFAULT NULL,
  `uAddress` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`uID`)
) ENGINE=MyISAM AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_master_administrator`
--

LOCK TABLES `tbl_master_administrator` WRITE;
/*!40000 ALTER TABLE `tbl_master_administrator` DISABLE KEYS */;
INSERT INTO `tbl_master_administrator` VALUES (1,'amnuay','ee10d403452291ec7d888b0c0d8b5a8d','อำนวย ปิ่นทอง',1,0,0,0,0,1,'2017-09-06 00:00:00','2017-11-05 16:18:32','IT',NULL,'amnuay@otiknetwork.com','Bangkok Thailand'),(44,'sysadmin','a2a7a4c693c482d56511e3544dc8ea26','SystemAdministrator',NULL,1,1,1,1,1,'2017-11-05 15:31:48','2017-11-05 15:49:42','AUTO','','sysadmin@gmail.com','');
/*!40000 ALTER TABLE `tbl_master_administrator` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_master_cui`
--

DROP TABLE IF EXISTS `tbl_master_cui`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_master_cui` (
  `clientipaddress` varchar(15) NOT NULL DEFAULT '',
  `callingstationid` varchar(50) NOT NULL DEFAULT '',
  `username` varchar(64) NOT NULL DEFAULT '',
  `cui` varchar(32) NOT NULL DEFAULT '',
  `creationdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lastaccounting` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`username`,`clientipaddress`,`callingstationid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_master_cui`
--

LOCK TABLES `tbl_master_cui` WRITE;
/*!40000 ALTER TABLE `tbl_master_cui` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_master_cui` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_master_nas`
--

DROP TABLE IF EXISTS `tbl_master_nas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_master_nas` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nasname` varchar(128) NOT NULL,
  `shortname` varchar(32) DEFAULT NULL,
  `type` varchar(30) DEFAULT 'other',
  `ports` int(5) DEFAULT NULL,
  `secret` varchar(60) NOT NULL DEFAULT 'secret',
  `server` varchar(64) DEFAULT NULL,
  `community` varchar(50) DEFAULT NULL,
  `description` varchar(200) DEFAULT 'RADIUS Client',
  `SiteName` varchar(10) DEFAULT NULL,
  `Nasidentity` varchar(100) DEFAULT NULL,
  `HotSpotName` varchar(100) DEFAULT NULL,
  `CheckKickInterval` int(10) DEFAULT NULL,
  `GPS1` varchar(20) DEFAULT NULL,
  `GPS2` varchar(20) DEFAULT NULL,
  `Contact` varchar(100) DEFAULT NULL,
  `Phone` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `nasname` (`nasname`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_master_nas`
--

LOCK TABLES `tbl_master_nas` WRITE;
/*!40000 ALTER TABLE `tbl_master_nas` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_master_nas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_master_profiles`
--

DROP TABLE IF EXISTS `tbl_master_profiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_master_profiles` (
  `pfID` int(20) NOT NULL AUTO_INCREMENT,
  `pfName` varchar(100) NOT NULL,
  `pfSpeedLimitUp` varchar(20) DEFAULT NULL,
  `pfSpeedLimitDown` varchar(20) DEFAULT NULL,
  `pfAddressList` varchar(50) DEFAULT NULL,
  `pfUrlRedirect` varchar(100) DEFAULT NULL,
  `pfShareUsers` varchar(50) NOT NULL,
  `pfSessionTimout` varchar(50) DEFAULT NULL,
  `pfIdleTimeout` varchar(50) DEFAULT NULL,
  `pfUptime` varchar(50) DEFAULT NULL,
  `pfValidity` varchar(50) DEFAULT NULL,
  `pfStatus` varchar(50) NOT NULL,
  `WhoCreate` varchar(50) DEFAULT NULL,
  `DateCreate` datetime DEFAULT NULL,
  `WhoUpdate` varchar(50) DEFAULT NULL,
  `DateUpdate` datetime DEFAULT NULL,
  `pfPriority` int(1) NOT NULL,
  `pfPrice` float DEFAULT NULL,
  PRIMARY KEY (`pfID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_master_profiles`
--

LOCK TABLES `tbl_master_profiles` WRITE;
/*!40000 ALTER TABLE `tbl_master_profiles` DISABLE KEYS */;
INSERT INTO `tbl_master_profiles` VALUES (1,'public','4m','15m','public','http://www.bigcoworking.space/en','2','','900','28800','86400','1','npintong','2017-10-10 19:32:06','gorapin','2017-11-01 19:16:16',8,199),(2,'admin','','','admin','http://www.bigcoworking.space/en','2','','','','0','1','npintong','2017-11-01 17:31:03','gorapin','2017-11-01 19:17:14',8,0),(3,'room','30m','30m','room','http://www.bigcoworking.space/en','2','','','','0','1','npintong','2017-11-01 17:31:38','gorapin','2017-11-01 19:17:25',8,0),(4,'teaning','10m','15m','teaning','http://www.bigcoworking.space/en','2','','','','604800','1','npintong','2017-11-01 17:32:13','gorapin','2017-11-01 19:17:00',8,0);
/*!40000 ALTER TABLE `tbl_master_profiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_master_radacct`
--

DROP TABLE IF EXISTS `tbl_master_radacct`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_master_radacct` (
  `radacctid` bigint(21) NOT NULL AUTO_INCREMENT,
  `acctsessionid` varchar(64) NOT NULL DEFAULT '',
  `acctuniqueid` varchar(32) NOT NULL DEFAULT '',
  `username` varchar(64) NOT NULL DEFAULT '',
  `groupname` varchar(64) NOT NULL DEFAULT '',
  `realm` varchar(64) DEFAULT '',
  `nasipaddress` varchar(15) NOT NULL DEFAULT '',
  `nasportid` varchar(15) DEFAULT NULL,
  `nasporttype` varchar(32) DEFAULT NULL,
  `acctstarttime` datetime DEFAULT NULL,
  `acctstoptime` datetime DEFAULT NULL,
  `acctsessiontime` int(12) unsigned DEFAULT NULL,
  `acctauthentic` varchar(32) DEFAULT NULL,
  `connectinfo_start` varchar(50) DEFAULT NULL,
  `connectinfo_stop` varchar(50) DEFAULT NULL,
  `acctinputoctets` bigint(20) DEFAULT NULL,
  `acctoutputoctets` bigint(20) DEFAULT NULL,
  `calledstationid` varchar(50) NOT NULL DEFAULT '',
  `callingstationid` varchar(50) NOT NULL DEFAULT '',
  `acctterminatecause` varchar(32) NOT NULL DEFAULT '',
  `servicetype` varchar(32) DEFAULT NULL,
  `framedprotocol` varchar(32) DEFAULT NULL,
  `framedipaddress` varchar(15) NOT NULL DEFAULT '',
  `acctstartdelay` int(12) unsigned DEFAULT NULL,
  `acctstopdelay` int(12) unsigned DEFAULT NULL,
  `xascendsessionsvrkey` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`radacctid`),
  UNIQUE KEY `acctuniqueid` (`acctuniqueid`),
  KEY `username` (`username`),
  KEY `framedipaddress` (`framedipaddress`),
  KEY `acctsessionid` (`acctsessionid`),
  KEY `acctsessiontime` (`acctsessiontime`),
  KEY `acctstarttime` (`acctstarttime`),
  KEY `acctstoptime` (`acctstoptime`),
  KEY `nasipaddress` (`nasipaddress`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_master_radacct`
--

LOCK TABLES `tbl_master_radacct` WRITE;
/*!40000 ALTER TABLE `tbl_master_radacct` DISABLE KEYS */;
INSERT INTO `tbl_master_radacct` VALUES (1,'803001a4','852c5dd4938d6ed3','amnuay','','','172.16.18.5','2150629796','Wireless-802.11','2017-10-10 19:54:32','2017-10-10 19:56:50',138,'','','',612123,5470090,'hotspot-Wifi','8C:70:5A:88:C1:C8','User-Request','','','10.8.17.130',0,0,''),(2,'803001a5','1bb5f21dc0dc1db5','amnuay','','','172.16.18.5','2150629797','Wireless-802.11','2017-10-10 19:56:51','2017-10-10 19:57:51',59,'','','',145380,3405166,'hotspot-Wifi','8C:70:5A:88:C1:C8','Admin-Reset','','','10.8.17.130',0,0,''),(3,'803001a6','e0b5e1e31389a1b7','amnuay','','','172.16.18.5','2150629798','Wireless-802.11','2017-10-10 20:02:07','2017-10-10 20:06:16',249,'','','',1920061,78783966,'hotspot-Wifi','8C:70:5A:88:C1:C8','User-Request','','','10.8.17.130',0,0,''),(4,'803001a8','1cf754fcf06adb06','amnuay','','','172.16.18.5','2150629800','Wireless-802.11','2017-10-10 20:06:23','2017-10-10 20:06:28',6,'','','',785,180,'hotspot-Wifi','8C:70:5A:88:C1:C8','User-Request','','','10.8.17.130',0,0,''),(5,'803001a9','6a311bcb5cf7911e','amnuay','','','172.16.18.5','2150629801','Wireless-802.11','2017-10-10 20:06:32','2017-10-10 20:06:34',2,'','','',0,0,'hotspot-Wifi','8C:70:5A:88:C1:C8','User-Request','','','10.8.17.130',0,0,''),(6,'803001ac','8e3734d034185971','amnuay','','','172.16.18.5','2150629804','Wireless-802.11','2017-10-10 20:22:47','2017-10-10 21:04:03',2476,'','','',0,0,'hotspot-Wifi','8C:70:5A:88:C1:C8','','','','10.8.17.130',0,0,''),(7,'80400001','1b3e97a832734c78','amnuay','','','172.16.18.5','2151677953','Wireless-802.11','2017-10-10 21:08:14','2017-10-10 21:08:40',26,'','','',104335,187631,'hotspot-Wifi','8C:70:5A:88:C1:C8','User-Request','','','10.8.17.130',0,0,''),(8,'80400002','f7190bcbf9bcba1b','amnuay','','','172.16.18.5','2151677954','Wireless-802.11','2017-10-10 21:10:34','2017-10-10 21:16:50',376,'','','',84646,159027,'hotspot-Wifi','8C:70:5A:88:C1:C8','Lost-Carrier','','','10.8.17.130',0,0,''),(9,'80400011','5b559f0669fa8f58','amnuay','','','172.16.18.5','2151677969','Wireless-802.11','2017-10-10 21:16:59','2017-10-10 21:23:47',407,'','','',203799,5508807,'hotspot-Wifi','8C:70:5A:88:C1:C8','Lost-Service','','','10.8.17.130',0,0,''),(10,'8050000c','068c26939c900df5','BiQ8KxdhHr','','','172.16.18.5','2152726540','Wireless-802.11','2017-11-01 17:49:44','2017-11-01 17:54:14',270,'','','',83816,888106,'hotspot-Wifi','00:15:5D:0C:CE:04','Admin-Reset','','','10.8.17.10',0,0,''),(11,'8050000d','6c1a810a7a4bf958','P-mWGk','','','172.16.18.5','2152726541','Wireless-802.11','2017-11-01 19:20:39','2017-11-01 19:27:02',383,'','','',95000,2452101,'hotspot-Wifi','00:15:5D:0C:CE:04','Admin-Reset','','','10.8.17.10',0,0,''),(12,'8050000e','8f828bb9e8ec16cb','P-mWGk','','','172.16.18.5','2152726542','Wireless-802.11','2017-11-01 19:29:05','2017-11-01 19:29:27',22,'','','',23691,577503,'hotspot-Wifi','00:15:5D:0C:CE:04','User-Request','','','10.8.17.10',0,0,''),(13,'8050000f','32d58a80b4606fa1','P-mWGk','','','172.16.18.5','2152726543','Wireless-802.11','2017-11-01 19:37:00','2017-11-02 03:30:14',28395,'','','',696910,13190678,'hotspot-Wifi','00:15:5D:0C:CE:04','Session-Timeout','','','10.8.17.10',0,0,''),(14,'80600065','ac896607416f0370','B-W1xwBsgz','','','172.16.18.5','2153775205','Wireless-802.11','2017-12-24 14:36:07','2017-12-24 15:31:42',3336,'','','',2845295,35039080,'hotspot-Wifi','F0:DB:E2:90:7B:68','Lost-Service','','','10.8.18.132',0,0,''),(15,'8060006c','19ca9a63edb7af89','B-W1xwBsgz','','','172.16.18.5','2153775212','Wireless-802.11','2017-12-24 15:31:57','2017-12-24 15:34:34',157,'','','',1693,1984,'hotspot-Wifi','F0:DB:E2:90:7B:68','Lost-Service','','','10.8.18.132',0,0,''),(16,'8060006d','0900690606705459','B-W1xwBsgz','','','172.16.18.5','2153775213','Wireless-802.11','2017-12-24 15:34:47','2017-12-24 16:37:59',3792,'','','',2325138,17479063,'hotspot-Wifi','F0:DB:E2:90:7B:68','Lost-Service','','','10.8.18.132',0,0,''),(17,'80600075','b62e565903d4228d','B-W1xwBsgz','','','172.16.18.5','2153775221','Wireless-802.11','2017-12-24 16:40:44','2017-12-24 16:45:00',256,'','','',3027,3649,'hotspot-Wifi','F0:DB:E2:90:7B:68','Lost-Service','','','10.8.18.132',0,0,''),(18,'80600076','f60773abf47c6197','B-W1xwBsgz','','','172.16.18.5','2153775222','Wireless-802.11','2017-12-24 16:46:38','2017-12-24 16:50:16',218,'','','',1545,1724,'hotspot-Wifi','F0:DB:E2:90:7B:68','Lost-Service','','','10.8.18.132',0,0,''),(19,'80600078','297c0f2aa5710a8b','B-W1xwBsgz','','','172.16.18.5','2153775224','Wireless-802.11','2017-12-24 16:53:12','2017-12-24 16:57:06',234,'','','',3161,10516,'hotspot-Wifi','F0:DB:E2:90:7B:68','Lost-Service','','','10.8.18.132',0,0,''),(20,'8060007c','c0fbcb3f14466b6b','B-ORQps1hI','','','172.16.18.5','2153775228','Wireless-802.11','2017-12-24 16:56:18','2017-12-24 17:51:17',3299,'','','',1027125,59865833,'hotspot-Wifi','3C:FA:43:A8:F0:0D','Lost-Service','','','10.8.18.169',0,0,''),(21,'8060007d','7f4f075b22bc6bc5','B-W1xwBsgz','','','172.16.18.5','2153775229','Wireless-802.11','2017-12-24 16:57:14','2017-12-24 16:59:27',133,'','','',484,0,'hotspot-Wifi','F0:DB:E2:90:7B:68','Lost-Service','','','10.8.18.132',0,0,''),(22,'8060007e','c15fd4dc7fa8e25a','B-W1xwBsgz','','','172.16.18.5','2153775230','Wireless-802.11','2017-12-24 17:00:35','2017-12-24 17:02:49',133,'','','',4762,18743,'hotspot-Wifi','F0:DB:E2:90:7B:68','Lost-Service','','','10.8.18.132',0,0,''),(23,'8060007f','0034a517ad90fafe','B-W1xwBsgz','','','172.16.18.5','2153775231','Wireless-802.11','2017-12-24 17:03:38','2017-12-24 17:10:02',384,'','','',4651,5693,'hotspot-Wifi','F0:DB:E2:90:7B:68','Lost-Service','','','10.8.18.132',0,0,''),(24,'80600081','59093523d029096b','B-W1xwBsgz','','','172.16.18.5','2153775233','Wireless-802.11','2017-12-24 17:11:06','2017-12-24 17:13:20',134,'','','',439,0,'hotspot-Wifi','F0:DB:E2:90:7B:68','Lost-Service','','','10.8.18.132',0,0,''),(25,'80600082','6cd1f4b31ed2cc94','B-W1xwBsgz','','','172.16.18.5','2153775234','Wireless-802.11','2017-12-24 17:18:24','2017-12-24 17:23:48',324,'','','',126405,242883,'hotspot-Wifi','F0:DB:E2:90:7B:68','Lost-Service','','','10.8.18.132',0,0,''),(26,'80600084','5323e3f6d1a2685c','B-W1xwBsgz','','','172.16.18.5','2153775236','Wireless-802.11','2017-12-24 17:24:34','2017-12-24 17:28:13',219,'','','',81021,702099,'hotspot-Wifi','F0:DB:E2:90:7B:68','Lost-Service','','','10.8.18.132',0,0,''),(27,'80600085','7f0992d6a87194f6','B-W1xwBsgz','','','172.16.18.5','2153775237','Wireless-802.11','2017-12-24 17:29:35','2017-12-24 17:34:19',283,'','','',1733,1983,'hotspot-Wifi','F0:DB:E2:90:7B:68','Lost-Service','','','10.8.18.132',0,0,''),(28,'80600086','9c40be1a046b332b','B-W1xwBsgz','','','172.16.18.5','2153775238','Wireless-802.11','2017-12-24 17:36:18','2017-12-24 17:39:00',162,'','','',624,0,'hotspot-Wifi','F0:DB:E2:90:7B:68','Lost-Service','','','10.8.18.132',0,0,''),(29,'80600088','85d108320e7548ab','B-W1xwBsgz','','','172.16.18.5','2153775240','Wireless-802.11','2017-12-24 17:39:45','2017-12-24 17:42:19',154,'','','',1585,1983,'hotspot-Wifi','F0:DB:E2:90:7B:68','Lost-Service','','','10.8.18.132',0,0,''),(30,'80600089','4fb0ddc4a8d54c8f','B-W1xwBsgz','','','172.16.18.5','2153775241','Wireless-802.11','2017-12-24 17:44:34','2017-12-24 17:46:35',121,'','','',140,0,'hotspot-Wifi','F0:DB:E2:90:7B:68','Lost-Service','','','10.8.18.132',0,0,''),(31,'8060008a','34c9745a312def23','B-W1xwBsgz','','','172.16.18.5','2153775242','Wireless-802.11','2017-12-24 17:46:54','2017-12-24 17:50:02',188,'','','',1273,1107,'hotspot-Wifi','F0:DB:E2:90:7B:68','Lost-Service','','','10.8.18.132',0,0,''),(32,'8060008c','d4039b6be9a22f27','B-W1xwBsgz','','','172.16.18.5','2153775244','Wireless-802.11','2017-12-24 17:50:41','2017-12-24 17:52:54',133,'','','',592,0,'hotspot-Wifi','F0:DB:E2:90:7B:68','Lost-Service','','','10.8.18.132',0,0,''),(33,'8060008d','58910e52dfc0362d','B-W1xwBsgz','','','172.16.18.5','2153775245','Wireless-802.11','2017-12-24 17:53:43','2017-12-24 17:59:41',358,'','','',8074,18552,'hotspot-Wifi','F0:DB:E2:90:7B:68','Lost-Service','','','10.8.18.132',0,0,''),(34,'8060008e','2c39887e6d0dd17e','B-ORQps1hI','','','172.16.18.5','2153775246','Wireless-802.11','2017-12-24 17:54:40','2017-12-24 18:27:22',1962,'','','',925245,43073220,'hotspot-Wifi','3C:FA:43:A8:F0:0D','Lost-Service','','','10.8.18.169',0,0,''),(35,'8060008f','9afba5832abc7ce8','B-W1xwBsgz','','','172.16.18.5','2153775247','Wireless-802.11','2017-12-24 18:01:56','2017-12-24 18:05:31',215,'','','',4287,5692,'hotspot-Wifi','F0:DB:E2:90:7B:68','Lost-Service','','','10.8.18.132',0,0,''),(36,'80600091','0a024a693b2ca306','B-W1xwBsgz','','','172.16.18.5','2153775249','Wireless-802.11','2017-12-24 18:06:13','2017-12-24 18:10:21',247,'','','',4971,8242,'hotspot-Wifi','F0:DB:E2:90:7B:68','Lost-Service','','','10.8.18.132',0,0,''),(37,'80600092','54b7b96f94558b5d','B-W1xwBsgz','','','172.16.18.5','2153775250','Wireless-802.11','2017-12-24 18:14:09','2017-12-24 18:16:50',160,'','','',624,0,'hotspot-Wifi','F0:DB:E2:90:7B:68','Lost-Service','','','10.8.18.132',0,0,''),(38,'80600094','bb3b6b49bdf0f140','B-W1xwBsgz','','','172.16.18.5','2153775252','Wireless-802.11','2017-12-24 18:17:35','2017-12-24 18:22:36',301,'','','',133239,261053,'hotspot-Wifi','F0:DB:E2:90:7B:68','Lost-Service','','','10.8.18.132',0,0,''),(39,'80600095','fdaa5309e1f6f03a','B-W1xwBsgz','','','172.16.18.5','2153775253','Wireless-802.11','2017-12-24 18:22:51','2017-12-24 18:27:51',300,'','','',5488,7416,'hotspot-Wifi','F0:DB:E2:90:7B:68','Lost-Service','','','10.8.18.132',0,0,''),(40,'80600098','2b197d16da9c6fd7','B-W1xwBsgz','','','172.16.18.5','2153775256','Wireless-802.11','2017-12-24 18:29:16','2017-12-24 18:50:30',1274,'','','',583014,12732594,'hotspot-Wifi','F0:DB:E2:90:7B:68','Lost-Service','','','10.8.18.132',0,0,''),(41,'80600099','798a48a53d635032','B-ORQps1hI','','','172.16.18.5','2153775257','Wireless-802.11','2017-12-24 18:30:14','2017-12-24 18:37:20',426,'','','',23033,92500,'hotspot-Wifi','3C:FA:43:A8:F0:0D','Lost-Service','','','10.8.18.169',0,0,''),(42,'8060009c','59259ed6d6da10fa','B-W1xwBsgz','','','172.16.18.5','2153775260','Wireless-802.11','2017-12-24 18:50:38','2017-12-24 18:58:01',443,'','','',9651,24147,'hotspot-Wifi','F0:DB:E2:90:7B:68','Lost-Service','','','10.8.18.132',0,0,''),(43,'8060009e','e9c5ceadccabfb4c','B-W1xwBsgz','','','172.16.18.5','2153775262','Wireless-802.11','2017-12-24 18:59:10','2017-12-24 19:01:14',124,'','','',344,260,'hotspot-Wifi','F0:DB:E2:90:7B:68','Lost-Service','','','10.8.18.132',0,0,''),(44,'8060009f','13b96c53cb1a9a9f','B-W1xwBsgz','','','172.16.18.5','2153775263','Wireless-802.11','2017-12-24 19:06:38','2017-12-24 19:14:19',461,'','','',11986,85116,'hotspot-Wifi','F0:DB:E2:90:7B:68','Lost-Service','','','10.8.18.132',0,0,''),(45,'806000a2','15579baa24ae9b4b','B-W1xwBsgz','','','172.16.18.5','2153775266','Wireless-802.11','2017-12-24 19:35:09','2017-12-24 19:42:31',442,'','','',273359,1773407,'hotspot-Wifi','F0:DB:E2:90:7B:68','Lost-Service','','','10.8.18.132',0,0,'');
/*!40000 ALTER TABLE `tbl_master_radacct` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_master_radcheck`
--

DROP TABLE IF EXISTS `tbl_master_radcheck`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_master_radcheck` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(64) NOT NULL DEFAULT '',
  `attribute` varchar(64) NOT NULL DEFAULT '',
  `op` char(2) NOT NULL DEFAULT '==',
  `value` varchar(253) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `username` (`username`(32))
) ENGINE=InnoDB AUTO_INCREMENT=137 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_master_radcheck`
--

LOCK TABLES `tbl_master_radcheck` WRITE;
/*!40000 ALTER TABLE `tbl_master_radcheck` DISABLE KEYS */;
INSERT INTO `tbl_master_radcheck` VALUES (1,'yt0yccga','Cleartext-Password',':=','dn4me474'),(2,'amnuay','Cleartext-Password',':=','pintong'),(3,'seelawut','Cleartext-Password',':=','seelawut'),(4,'TQROkKgV','Cleartext-Password',':=','37608913'),(5,'VQgynGD0','Cleartext-Password',':=','90635338'),(6,'kjCKvjgD','Cleartext-Password',':=','21010244'),(7,'fAPJHSAD','Cleartext-Password',':=','36489765'),(8,'UrvERRIj','Cleartext-Password',':=','42754199'),(10,'Z5s3rCHp','Cleartext-Password',':=','69765834'),(11,'kPGWrITX','Cleartext-Password',':=','61201065'),(12,'AXdsYkZF','Cleartext-Password',':=','41700156'),(13,'YpAGyTdc','Cleartext-Password',':=','47567128'),(14,'fpg4R59v','Cleartext-Password',':=','17819373'),(15,'Dwa1F3Ui','Cleartext-Password',':=','68149425'),(16,'FuZXpZHz','Cleartext-Password',':=','19903743'),(17,'fxQlrjKU','Cleartext-Password',':=','43747998'),(18,'pVMXuUI4','Cleartext-Password',':=','21058493'),(19,'OP76xIQQ','Cleartext-Password',':=','49629616'),(20,'999999999','Cleartext-Password',':=','999999999'),(21,'p2iT0cz9','Cleartext-Password',':=','43915407'),(22,'3MTs2kg5','Cleartext-Password',':=','81587764'),(23,'lKrcnecH','Cleartext-Password',':=','74239218'),(24,'eegWECS4','Cleartext-Password',':=','27795331'),(25,'jCkMgDVU','Cleartext-Password',':=','56748923'),(26,'ZuuezBY9','Cleartext-Password',':=','81935251'),(27,'SGXxJqIo','Cleartext-Password',':=','28017251'),(28,'CSnxUCxJ','Cleartext-Password',':=','27570092'),(29,'HSHR9Q5R','Cleartext-Password',':=','10483003'),(30,'SoKmr9w5','Cleartext-Password',':=','72773604'),(31,'u0m1pyuw','Cleartext-Password',':=','zm94mw8j'),(33,'BiEvJP0A7B','Cleartext-Password',':=','40047448'),(34,'BiGS3WCQUa','Cleartext-Password',':=','57536287'),(35,'Bi8B7xB41g','Cleartext-Password',':=','98973454'),(36,'BiwcwyrFPQ','Cleartext-Password',':=','87659529'),(37,'BigLziGoEC','Cleartext-Password',':=','50785323'),(38,'BiUBZOImu7','Cleartext-Password',':=','77716403'),(39,'Bi3wpi9G22','Cleartext-Password',':=','45122255'),(40,'BiQ6vZjfXT','Cleartext-Password',':=','20495524'),(41,'BiS5ARC2Jf','Cleartext-Password',':=','42765327'),(42,'BiQ8KxdhHr','Cleartext-Password',':=','66611863'),(43,'P53IV','Cleartext-Password',':=','13916039'),(44,'PV8B7','Cleartext-Password',':=','58271571'),(45,'PCJJ3','Cleartext-Password',':=','06695826'),(46,'PISzz','Cleartext-Password',':=','31770866'),(47,'Pp4a0','Cleartext-Password',':=','42943134'),(48,'P-mWGk','Cleartext-Password',':=','5651'),(50,'P-nvPO','Cleartext-Password',':=','9127'),(51,'P-52Jb','Cleartext-Password',':=','1781'),(52,'P-bBDc','Cleartext-Password',':=','6073'),(53,'P-Dz0B','Cleartext-Password',':=','5411'),(54,'P-OZZI','Cleartext-Password',':=','5684'),(55,'P-gB6q','Cleartext-Password',':=','7782'),(56,'P-y3qa','Cleartext-Password',':=','8479'),(57,'P-Rm9x','Cleartext-Password',':=','0103'),(58,'P-jacI','Cleartext-Password',':=','0366'),(59,'P-VjTH','Cleartext-Password',':=','3131'),(60,'P-BCk5','Cleartext-Password',':=','5388'),(61,'P-92nE','Cleartext-Password',':=','0646'),(62,'P-F1vK','Cleartext-Password',':=','1375'),(63,'P-7GnT','Cleartext-Password',':=','2942'),(64,'P-CDLj','Cleartext-Password',':=','4034'),(65,'P-7Ce9','Cleartext-Password',':=','7967'),(66,'P-vX86','Cleartext-Password',':=','7747'),(67,'P-2FBH','Cleartext-Password',':=','0431'),(68,'P-iks9','Cleartext-Password',':=','6146'),(69,'P-J4m1','Cleartext-Password',':=','8265'),(70,'P-pmp8','Cleartext-Password',':=','9505'),(71,'P-3iUb','Cleartext-Password',':=','7425'),(72,'P-f4bk','Cleartext-Password',':=','1265'),(73,'P-5uFb','Cleartext-Password',':=','3680'),(74,'P-TiAO','Cleartext-Password',':=','1080'),(75,'P-oHdb','Cleartext-Password',':=','5700'),(76,'P-qcp1','Cleartext-Password',':=','6245'),(77,'P-AgCW','Cleartext-Password',':=','2945'),(78,'P-ebun','Cleartext-Password',':=','5561'),(79,'P-pJnP','Cleartext-Password',':=','9636'),(80,'P-dgXD','Cleartext-Password',':=','3285'),(81,'P-QqG4','Cleartext-Password',':=','6278'),(82,'P-1vlu','Cleartext-Password',':=','1349'),(83,'P-CLwi','Cleartext-Password',':=','1856'),(84,'P-U2sn','Cleartext-Password',':=','1524'),(85,'P-SVU8','Cleartext-Password',':=','5074'),(86,'vxoVIoqM','Cleartext-Password',':=','47066964'),(87,'beJY6S9G','Cleartext-Password',':=','71222419'),(88,'UxTddAq3','Cleartext-Password',':=','77547182'),(89,'o9llSkrE','Cleartext-Password',':=','79394497'),(90,'TQMwR3pE','Cleartext-Password',':=','62443360'),(91,'TPnk0Xpl','Cleartext-Password',':=','29564547'),(92,'ynhEhMJM','Cleartext-Password',':=','46689282'),(93,'gf1W1g9H','Cleartext-Password',':=','55891279'),(94,'2RAZdJl4','Cleartext-Password',':=','72775500'),(95,'F1Z6WZD3','Cleartext-Password',':=','98810509'),(96,'1DWUO8PB','Cleartext-Password',':=','29775776'),(97,'mLkAkn4j','Cleartext-Password',':=','57663751'),(98,'z6gA5wCH','Cleartext-Password',':=','78825692'),(99,'xgOZJH8p','Cleartext-Password',':=','86223841'),(100,'y7LssO1c','Cleartext-Password',':=','07763681'),(101,'MCjWJiDD','Cleartext-Password',':=','23261770'),(102,'p8sZMk2O','Cleartext-Password',':=','26863685'),(103,'qY41674K','Cleartext-Password',':=','22749546'),(104,'iOAvy39G','Cleartext-Password',':=','58784531'),(105,'7SB4Q6Ei','Cleartext-Password',':=','18004569'),(106,'0955499819','Cleartext-Password',':=','1234567890'),(107,'S-SAYme43Z','Cleartext-Password',':=','36146588'),(108,'S-fbUfKmHs','Cleartext-Password',':=','13315298'),(109,'S-OUbrOUHl','Cleartext-Password',':=','92067943'),(110,'S-Xxyhb5Rl','Cleartext-Password',':=','26788660'),(111,'S-9FzMa4xa','Cleartext-Password',':=','18097521'),(112,'S-VDqz88ZQ','Cleartext-Password',':=','61048758'),(113,'S-yUBOP0nY','Cleartext-Password',':=','76352565'),(114,'S-lYVkXu17','Cleartext-Password',':=','89476954'),(115,'S-TiqhZU5I','Cleartext-Password',':=','02628374'),(116,'S-uFAF01Ds','Cleartext-Password',':=','74444997'),(117,'B-5bDPYK3v','Cleartext-Password',':=','79354859'),(118,'B-qRJ0cbl1','Cleartext-Password',':=','46136985'),(119,'B-W1xwBsgz','Cleartext-Password',':=','68317914'),(120,'B-ORQps1hI','Cleartext-Password',':=','57426270'),(121,'B-GmxIVV58','Cleartext-Password',':=','23192234'),(122,'B-fkKObrW8','Cleartext-Password',':=','48110911'),(123,'B-j9T4VP3j','Cleartext-Password',':=','59582837'),(124,'B-ad71LUxn','Cleartext-Password',':=','19729935'),(125,'B-5rbR7V0f','Cleartext-Password',':=','33351636'),(126,'B-GQcTkR6s','Cleartext-Password',':=','26926375'),(127,'B-CMx9iof3','Cleartext-Password',':=','08414775'),(128,'B-BP1lgzVy','Cleartext-Password',':=','42016766'),(129,'B-AdpiIKcI','Cleartext-Password',':=','99346107'),(130,'B-W2V3pprK','Cleartext-Password',':=','97255925'),(131,'B-Z6FiGiqG','Cleartext-Password',':=','40511595'),(132,'B-bPaH5HS3','Cleartext-Password',':=','85435799'),(133,'B-rBcyjJ5D','Cleartext-Password',':=','14230185'),(134,'B-WTnSa5LR','Cleartext-Password',':=','46694591'),(135,'B-kW7Kh3Pu','Cleartext-Password',':=','34046999'),(136,'B-RkSqgd8A','Cleartext-Password',':=','16062978');
/*!40000 ALTER TABLE `tbl_master_radcheck` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_master_radgroupcheck`
--

DROP TABLE IF EXISTS `tbl_master_radgroupcheck`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_master_radgroupcheck` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `groupname` varchar(64) NOT NULL DEFAULT '',
  `attribute` varchar(64) NOT NULL DEFAULT '',
  `op` char(2) NOT NULL DEFAULT '==',
  `value` varchar(253) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `groupname` (`groupname`(32))
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_master_radgroupcheck`
--

LOCK TABLES `tbl_master_radgroupcheck` WRITE;
/*!40000 ALTER TABLE `tbl_master_radgroupcheck` DISABLE KEYS */;
INSERT INTO `tbl_master_radgroupcheck` VALUES (15,'1','Max-All-Session',':=','28800'),(16,'1','Expire-After',':=','86400'),(20,'4','Expire-After',':=','604800'),(21,'2','Expire-After',':=','0'),(22,'3','Expire-After',':=','0');
/*!40000 ALTER TABLE `tbl_master_radgroupcheck` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_master_radgroupreply`
--

DROP TABLE IF EXISTS `tbl_master_radgroupreply`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_master_radgroupreply` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `groupname` varchar(64) NOT NULL DEFAULT '',
  `attribute` varchar(64) NOT NULL DEFAULT '',
  `op` char(2) NOT NULL DEFAULT '=',
  `value` varchar(253) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `groupname` (`groupname`(32))
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_master_radgroupreply`
--

LOCK TABLES `tbl_master_radgroupreply` WRITE;
/*!40000 ALTER TABLE `tbl_master_radgroupreply` DISABLE KEYS */;
INSERT INTO `tbl_master_radgroupreply` VALUES (30,'1','Mikrotik-Rate-Limit',':=','4m/15m'),(31,'1','Mikrotik-Address-List',':=','public'),(32,'1','WISPr-Redirection-URL',':=','http://www.bigcoworking.space/en'),(33,'1','Port-Limit',':=','2'),(34,'1','Idle-Timeout',':=','900'),(41,'4','Mikrotik-Rate-Limit',':=','10m/15m'),(42,'4','Mikrotik-Address-List',':=','teaning'),(43,'4','WISPr-Redirection-URL',':=','http://www.bigcoworking.space/en'),(44,'4','Port-Limit',':=','2'),(45,'2','Mikrotik-Address-List',':=','admin'),(46,'2','WISPr-Redirection-URL',':=','http://www.bigcoworking.space/en'),(47,'2','Port-Limit',':=','2'),(48,'3','Mikrotik-Rate-Limit',':=','30m/30m'),(49,'3','Mikrotik-Address-List',':=','room'),(50,'3','WISPr-Redirection-URL',':=','http://www.bigcoworking.space/en'),(51,'3','Port-Limit',':=','2');
/*!40000 ALTER TABLE `tbl_master_radgroupreply` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_master_radippool`
--

DROP TABLE IF EXISTS `tbl_master_radippool`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_master_radippool` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pool_name` varchar(30) NOT NULL,
  `framedipaddress` varchar(15) NOT NULL DEFAULT '',
  `nasipaddress` varchar(15) NOT NULL DEFAULT '',
  `calledstationid` varchar(30) NOT NULL,
  `callingstationid` varchar(30) NOT NULL,
  `expiry_time` datetime DEFAULT NULL,
  `username` varchar(64) NOT NULL DEFAULT '',
  `pool_key` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `radippool_poolname_expire` (`pool_name`,`expiry_time`),
  KEY `framedipaddress` (`framedipaddress`),
  KEY `radippool_nasip_poolkey_ipaddress` (`nasipaddress`,`pool_key`,`framedipaddress`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_master_radippool`
--

LOCK TABLES `tbl_master_radippool` WRITE;
/*!40000 ALTER TABLE `tbl_master_radippool` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_master_radippool` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_master_radpostauth`
--

DROP TABLE IF EXISTS `tbl_master_radpostauth`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_master_radpostauth` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(64) NOT NULL DEFAULT '',
  `pass` varchar(64) NOT NULL DEFAULT '',
  `reply` varchar(32) NOT NULL DEFAULT '',
  `authdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_master_radpostauth`
--

LOCK TABLES `tbl_master_radpostauth` WRITE;
/*!40000 ALTER TABLE `tbl_master_radpostauth` DISABLE KEYS */;
INSERT INTO `tbl_master_radpostauth` VALUES (1,'amnuay','pintong','Access-Accept','2017-10-10 12:54:32'),(2,'amnuay','pintong','Access-Accept','2017-10-10 12:56:51'),(3,'amnuay','pintong','Access-Accept','2017-10-10 13:02:07'),(4,'amnuay','pintong','Access-Accept','2017-10-10 13:06:22'),(5,'amnuay','pintong','Access-Accept','2017-10-10 13:06:32'),(6,'amnuay','pintong','Access-Accept','2017-10-10 13:22:47'),(7,'amnuay','pintong','Access-Accept','2017-10-10 14:08:14'),(8,'amnuay','pintong','Access-Accept','2017-10-10 14:10:34'),(9,'amnuay','pintong','Access-Accept','2017-10-10 14:13:52'),(10,'amnuay','pintong','Access-Accept','2017-10-10 14:16:59'),(11,'BiQ8KxdhHr','0xa3a08546379761e1a6916e72377e6ae6e9','Access-Accept','2017-11-01 10:49:44'),(12,'P-mWGk','0xf4764e227abf72d91a318f079bc0c0d2cd','Access-Accept','2017-11-01 12:20:38'),(13,'P-mWGk','0x43f70aff989a28dcf1b963010626f32251','Access-Accept','2017-11-01 12:29:05'),(14,'P-mWGk','0x0729e495d42cf70c0d7cc4944b7a1dddc9','Access-Accept','2017-11-01 12:37:00'),(15,'B-W1xwBsgz','0xfee487c89d42c0bc4b912f78e455090b9b','Access-Accept','2017-12-24 07:36:06'),(16,'B-W1xwBsgz','0xfee487c89d42c0bc4b912f78e455090b9b','Access-Accept','2017-12-24 08:31:57'),(17,'B-W1xwBsgz','0xfee487c89d42c0bc4b912f78e455090b9b','Access-Accept','2017-12-24 08:34:47'),(18,'B-W1xwBsgz','0xfee487c89d42c0bc4b912f78e455090b9b','Access-Accept','2017-12-24 09:40:44'),(19,'B-W1xwBsgz','0xfee487c89d42c0bc4b912f78e455090b9b','Access-Accept','2017-12-24 09:46:38'),(20,'B-W1xwBsgz','0xfee487c89d42c0bc4b912f78e455090b9b','Access-Accept','2017-12-24 09:53:12'),(21,'B-ORQps1hI','0xd0d9b65865e2443c620bb292fef322da69','Access-Accept','2017-12-24 09:56:18'),(22,'B-W1xwBsgz','0xfee487c89d42c0bc4b912f78e455090b9b','Access-Accept','2017-12-24 09:57:14'),(23,'B-W1xwBsgz','0xfee487c89d42c0bc4b912f78e455090b9b','Access-Accept','2017-12-24 10:00:35'),(24,'B-W1xwBsgz','0xfee487c89d42c0bc4b912f78e455090b9b','Access-Accept','2017-12-24 10:03:38'),(25,'B-W1xwBsgz','0xfee487c89d42c0bc4b912f78e455090b9b','Access-Accept','2017-12-24 10:11:06'),(26,'B-W1xwBsgz','0xfee487c89d42c0bc4b912f78e455090b9b','Access-Accept','2017-12-24 10:18:24'),(27,'B-W1xwBsgz','0xfee487c89d42c0bc4b912f78e455090b9b','Access-Accept','2017-12-24 10:24:34'),(28,'B-W1xwBsgz','0xfee487c89d42c0bc4b912f78e455090b9b','Access-Accept','2017-12-24 10:29:34'),(29,'B-W1xwBsgz','0xfee487c89d42c0bc4b912f78e455090b9b','Access-Accept','2017-12-24 10:36:18'),(30,'B-W1xwBsgz','0xfee487c89d42c0bc4b912f78e455090b9b','Access-Accept','2017-12-24 10:39:45'),(31,'B-W1xwBsgz','0xfee487c89d42c0bc4b912f78e455090b9b','Access-Accept','2017-12-24 10:44:34'),(32,'B-W1xwBsgz','0xfee487c89d42c0bc4b912f78e455090b9b','Access-Accept','2017-12-24 10:46:54'),(33,'B-W1xwBsgz','0xfee487c89d42c0bc4b912f78e455090b9b','Access-Accept','2017-12-24 10:50:40'),(34,'B-W1xwBsgz','0xfee487c89d42c0bc4b912f78e455090b9b','Access-Accept','2017-12-24 10:53:42'),(35,'B-ORQps1hI','0xd0d9b65865e2443c620bb292fef322da69','Access-Accept','2017-12-24 10:54:40'),(36,'B-W1xwBsgz','0xfee487c89d42c0bc4b912f78e455090b9b','Access-Accept','2017-12-24 11:01:56'),(37,'B-W1xwBsgz','0xfee487c89d42c0bc4b912f78e455090b9b','Access-Accept','2017-12-24 11:06:13'),(38,'B-W1xwBsgz','0xfee487c89d42c0bc4b912f78e455090b9b','Access-Accept','2017-12-24 11:14:09'),(39,'B-W1xwBsgz','0xfee487c89d42c0bc4b912f78e455090b9b','Access-Accept','2017-12-24 11:17:34'),(40,'B-W1xwBsgz','0xfee487c89d42c0bc4b912f78e455090b9b','Access-Accept','2017-12-24 11:22:51'),(41,'B-W1xwBsgz','0xfee487c89d42c0bc4b912f78e455090b9b','Access-Accept','2017-12-24 11:29:15'),(42,'B-ORQps1hI','0xd0d9b65865e2443c620bb292fef322da69','Access-Accept','2017-12-24 11:30:14'),(43,'B-W1xwBsgz','0xfee487c89d42c0bc4b912f78e455090b9b','Access-Accept','2017-12-24 11:50:37'),(44,'B-W1xwBsgz','0xfee487c89d42c0bc4b912f78e455090b9b','Access-Accept','2017-12-24 11:59:09'),(45,'B-W1xwBsgz','0xfee487c89d42c0bc4b912f78e455090b9b','Access-Accept','2017-12-24 12:06:37'),(46,'B-W1xwBsgz','0xfee487c89d42c0bc4b912f78e455090b9b','Access-Accept','2017-12-24 12:35:09');
/*!40000 ALTER TABLE `tbl_master_radpostauth` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_master_radreply`
--

DROP TABLE IF EXISTS `tbl_master_radreply`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_master_radreply` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(64) NOT NULL DEFAULT '',
  `attribute` varchar(64) NOT NULL DEFAULT '',
  `op` char(2) NOT NULL DEFAULT '=',
  `value` varchar(253) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `username` (`username`(32))
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_master_radreply`
--

LOCK TABLES `tbl_master_radreply` WRITE;
/*!40000 ALTER TABLE `tbl_master_radreply` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_master_radreply` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_master_radusergroup`
--

DROP TABLE IF EXISTS `tbl_master_radusergroup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_master_radusergroup` (
  `username` varchar(64) NOT NULL DEFAULT '',
  `groupname` varchar(64) NOT NULL DEFAULT '',
  `priority` int(11) NOT NULL DEFAULT '1',
  KEY `username` (`username`(32))
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_master_radusergroup`
--

LOCK TABLES `tbl_master_radusergroup` WRITE;
/*!40000 ALTER TABLE `tbl_master_radusergroup` DISABLE KEYS */;
INSERT INTO `tbl_master_radusergroup` VALUES ('yt0yccga','1',8),('amnuay','1',8),('seelawut','1',8),('TQROkKgV','1',8),('VQgynGD0','1',8),('kjCKvjgD','1',8),('fAPJHSAD','1',8),('UrvERRIj','1',8),('Z5s3rCHp','1',8),('kPGWrITX','1',8),('AXdsYkZF','1',8),('YpAGyTdc','1',8),('fpg4R59v','1',8),('Dwa1F3Ui','1',8),('FuZXpZHz','1',8),('fxQlrjKU','1',8),('pVMXuUI4','1',8),('OP76xIQQ','1',8),('999999999','1',8),('p2iT0cz9','1',8),('3MTs2kg5','1',8),('lKrcnecH','1',8),('eegWECS4','1',8),('jCkMgDVU','1',8),('ZuuezBY9','1',8),('SGXxJqIo','1',8),('CSnxUCxJ','1',8),('HSHR9Q5R','1',8),('SoKmr9w5','1',8),('P-mWGk','1',8),('P-nvPO','1',8),('P-52Jb','1',8),('P-bBDc','1',8),('P-Dz0B','1',8),('P-OZZI','1',8),('P-gB6q','1',8),('P-y3qa','1',8),('P-Rm9x','1',8),('P-jacI','1',8),('P-VjTH','1',8),('P-BCk5','1',8),('P-92nE','1',8),('P-F1vK','1',8),('P-7GnT','1',8),('P-CDLj','1',8),('P-7Ce9','1',8),('P-vX86','1',8),('P-2FBH','1',8),('P-iks9','1',8),('P-J4m1','1',8),('P-pmp8','1',8),('P-3iUb','1',8),('P-f4bk','1',8),('P-5uFb','1',8),('P-TiAO','1',8),('P-oHdb','1',8),('P-qcp1','1',8),('P-AgCW','1',8),('P-ebun','1',8),('P-pJnP','1',8),('P-dgXD','1',8),('P-QqG4','1',8),('P-1vlu','1',8),('P-CLwi','1',8),('P-U2sn','1',8),('P-SVU8','1',8),('B-5bDPYK3v','1',8),('B-qRJ0cbl1','1',8),('B-W1xwBsgz','1',8),('B-ORQps1hI','1',8),('B-GmxIVV58','1',8),('B-fkKObrW8','1',8),('B-j9T4VP3j','1',8),('B-ad71LUxn','1',8),('B-5rbR7V0f','1',8),('B-GQcTkR6s','1',8),('B-CMx9iof3','1',8),('B-BP1lgzVy','1',8),('B-AdpiIKcI','1',8),('B-W2V3pprK','1',8),('B-Z6FiGiqG','1',8),('B-bPaH5HS3','1',8),('B-rBcyjJ5D','1',8),('B-WTnSa5LR','1',8),('B-kW7Kh3Pu','1',8),('B-RkSqgd8A','1',8);
/*!40000 ALTER TABLE `tbl_master_radusergroup` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_master_wimax`
--

DROP TABLE IF EXISTS `tbl_master_wimax`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_master_wimax` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(64) NOT NULL DEFAULT '',
  `authdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `spi` varchar(16) NOT NULL DEFAULT '',
  `mipkey` varchar(400) NOT NULL DEFAULT '',
  `lifetime` int(12) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `username` (`username`),
  KEY `spi` (`spi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_master_wimax`
--

LOCK TABLES `tbl_master_wimax` WRITE;
/*!40000 ALTER TABLE `tbl_master_wimax` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_master_wimax` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_trans_account`
--

DROP TABLE IF EXISTS `tbl_trans_account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_trans_account` (
  `acID` int(20) NOT NULL AUTO_INCREMENT,
  `pfID` int(20) NOT NULL,
  `acUser` varchar(13) NOT NULL,
  `acPassWd` varchar(13) NOT NULL,
  `acStatus` int(1) NOT NULL,
  `WhoCreate` varchar(50) NOT NULL,
  `DateCreate` datetime DEFAULT NULL,
  `WhoUpdate` varchar(50) DEFAULT NULL,
  `DateUpdate` datetime DEFAULT NULL,
  PRIMARY KEY (`acID`)
) ENGINE=InnoDB AUTO_INCREMENT=134 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_trans_account`
--

LOCK TABLES `tbl_trans_account` WRITE;
/*!40000 ALTER TABLE `tbl_trans_account` DISABLE KEYS */;
INSERT INTO `tbl_trans_account` VALUES (1,1,'yt0yccga','dn4me474',1,'npintong','2017-10-10 19:32:14','npintong','2017-10-10 19:32:14'),(2,1,'amnuay','pintong',1,'npintong','2017-10-10 19:32:32','npintong','2017-10-10 19:32:32'),(3,1,'seelawut','seelawut',1,'npintong','2017-10-10 19:32:51','npintong','2017-10-10 19:32:51'),(4,1,'TQROkKgV','37608913',1,'1','2017-10-10 19:33:02','1','2017-10-10 19:33:02'),(5,1,'VQgynGD0','90635338',1,'1','2017-10-10 19:33:02','1','2017-10-10 19:33:02'),(6,1,'kjCKvjgD','21010244',1,'1','2017-10-10 19:33:02','1','2017-10-10 19:33:02'),(7,1,'fAPJHSAD','36489765',1,'1','2017-10-10 19:33:02','1','2017-10-10 19:33:02'),(8,1,'UrvERRIj','42754199',1,'1','2017-10-10 19:33:02','1','2017-10-10 19:33:02'),(9,1,'Z5s3rCHp','69765834',1,'1','2017-10-10 20:23:46','1','2017-10-10 20:23:46'),(10,1,'kPGWrITX','61201065',1,'1','2017-10-10 20:23:46','1','2017-10-10 20:23:46'),(11,1,'AXdsYkZF','41700156',1,'1','2017-10-10 20:23:46','1','2017-10-10 20:23:46'),(12,1,'YpAGyTdc','47567128',1,'1','2017-10-10 20:23:46','1','2017-10-10 20:23:46'),(13,1,'fpg4R59v','17819373',1,'1','2017-10-10 20:23:46','1','2017-10-10 20:23:46'),(14,1,'Dwa1F3Ui','68149425',1,'1','2017-10-10 20:23:46','1','2017-10-10 20:23:46'),(15,1,'FuZXpZHz','19903743',1,'1','2017-10-10 20:23:46','1','2017-10-10 20:23:46'),(16,1,'fxQlrjKU','43747998',1,'1','2017-10-10 20:23:46','1','2017-10-10 20:23:46'),(17,1,'pVMXuUI4','21058493',1,'1','2017-10-10 20:23:46','1','2017-10-10 20:23:46'),(18,1,'OP76xIQQ','49629616',1,'1','2017-10-10 20:23:46','1','2017-10-10 20:23:46'),(19,1,'999999999','999999999',1,'npintong','2017-10-10 20:35:27','npintong','2017-10-10 20:35:27'),(20,1,'p2iT0cz9','43915407',1,'1','2017-10-10 20:35:43','1','2017-10-10 20:35:43'),(21,1,'3MTs2kg5','81587764',1,'1','2017-10-10 20:35:43','1','2017-10-10 20:35:43'),(22,1,'lKrcnecH','74239218',1,'1','2017-10-10 20:35:43','1','2017-10-10 20:35:43'),(23,1,'eegWECS4','27795331',1,'1','2017-10-10 20:35:43','1','2017-10-10 20:35:43'),(24,1,'jCkMgDVU','56748923',1,'1','2017-10-10 20:35:43','1','2017-10-10 20:35:43'),(25,1,'ZuuezBY9','81935251',1,'1','2017-10-10 20:35:43','1','2017-10-10 20:35:43'),(26,1,'SGXxJqIo','28017251',1,'1','2017-10-10 20:35:43','1','2017-10-10 20:35:43'),(27,1,'CSnxUCxJ','27570092',1,'1','2017-10-10 20:35:43','1','2017-10-10 20:35:43'),(28,1,'HSHR9Q5R','10483003',1,'1','2017-10-10 20:35:43','1','2017-10-10 20:35:43'),(29,1,'SoKmr9w5','72773604',1,'1','2017-10-10 20:35:43','1','2017-10-10 20:35:43'),(46,1,'P-mWGk','5651',1,'1','2017-11-01 17:53:21','1','2017-11-01 17:53:21'),(47,1,'P-nvPO','9127',1,'1','2017-11-02 16:13:05','1','2017-11-02 16:13:05'),(48,1,'P-52Jb','1781',1,'1','2017-11-02 16:13:05','1','2017-11-02 16:13:05'),(49,1,'P-bBDc','6073',1,'1','2017-11-02 16:13:05','1','2017-11-02 16:13:05'),(50,1,'P-Dz0B','5411',1,'1','2017-11-02 16:13:05','1','2017-11-02 16:13:05'),(51,1,'P-OZZI','5684',1,'1','2017-11-02 16:13:05','1','2017-11-02 16:13:05'),(52,1,'P-gB6q','7782',1,'1','2017-11-02 16:13:05','1','2017-11-02 16:13:05'),(53,1,'P-y3qa','8479',1,'1','2017-11-02 16:13:05','1','2017-11-02 16:13:05'),(54,1,'P-Rm9x','0103',1,'1','2017-11-02 16:13:05','1','2017-11-02 16:13:05'),(55,1,'P-jacI','0366',1,'1','2017-11-02 16:13:05','1','2017-11-02 16:13:05'),(56,1,'P-VjTH','3131',1,'1','2017-11-02 16:13:05','1','2017-11-02 16:13:05'),(57,1,'P-BCk5','5388',1,'1','2017-11-02 16:13:05','1','2017-11-02 16:13:05'),(58,1,'P-92nE','0646',1,'1','2017-11-02 16:13:05','1','2017-11-02 16:13:05'),(59,1,'P-F1vK','1375',1,'1','2017-11-02 16:13:05','1','2017-11-02 16:13:05'),(60,1,'P-7GnT','2942',1,'1','2017-11-02 16:13:05','1','2017-11-02 16:13:05'),(61,1,'P-CDLj','4034',1,'1','2017-11-02 16:13:05','1','2017-11-02 16:13:05'),(62,1,'P-7Ce9','7967',1,'1','2017-11-02 16:13:05','1','2017-11-02 16:13:05'),(63,1,'P-vX86','7747',1,'1','2017-11-02 16:13:05','1','2017-11-02 16:13:05'),(64,1,'P-2FBH','0431',1,'1','2017-11-02 16:13:05','1','2017-11-02 16:13:05'),(65,1,'P-iks9','6146',1,'1','2017-11-02 16:13:05','1','2017-11-02 16:13:05'),(66,1,'P-J4m1','8265',1,'1','2017-11-02 16:13:05','1','2017-11-02 16:13:05'),(67,1,'P-pmp8','9505',1,'1','2017-11-02 16:23:15','1','2017-11-02 16:23:15'),(68,1,'P-3iUb','7425',1,'1','2017-11-02 16:23:15','1','2017-11-02 16:23:15'),(69,1,'P-f4bk','1265',1,'1','2017-11-02 16:23:15','1','2017-11-02 16:23:15'),(70,1,'P-5uFb','3680',1,'1','2017-11-02 16:23:15','1','2017-11-02 16:23:15'),(71,1,'P-TiAO','1080',1,'1','2017-11-02 16:23:15','1','2017-11-02 16:23:15'),(72,1,'P-oHdb','5700',1,'1','2017-11-02 16:23:15','1','2017-11-02 16:23:15'),(73,1,'P-qcp1','6245',1,'1','2017-11-02 16:23:15','1','2017-11-02 16:23:15'),(74,1,'P-AgCW','2945',1,'1','2017-11-02 16:23:15','1','2017-11-02 16:23:15'),(75,1,'P-ebun','5561',1,'1','2017-11-02 16:23:15','1','2017-11-02 16:23:15'),(76,1,'P-pJnP','9636',1,'1','2017-11-02 16:23:15','1','2017-11-02 16:23:15'),(77,1,'P-dgXD','3285',1,'1','2017-11-02 16:24:28','1','2017-11-02 16:24:28'),(78,1,'P-QqG4','6278',1,'1','2017-11-02 16:24:28','1','2017-11-02 16:24:28'),(79,1,'P-1vlu','1349',1,'1','2017-11-02 16:24:28','1','2017-11-02 16:24:28'),(80,1,'P-CLwi','1856',1,'1','2017-11-02 16:24:28','1','2017-11-02 16:24:28'),(81,1,'P-U2sn','1524',1,'1','2017-11-02 16:24:28','1','2017-11-02 16:24:28'),(82,1,'P-SVU8','5074',1,'1','2017-11-02 16:24:28','1','2017-11-02 16:24:28'),(114,1,'B-5bDPYK3v','79354859',1,'1','2017-12-24 00:32:15','1','2017-12-24 00:32:15'),(115,1,'B-qRJ0cbl1','46136985',1,'1','2017-12-24 00:32:15','1','2017-12-24 00:32:15'),(116,1,'B-W1xwBsgz','68317914',1,'1','2017-12-24 00:32:15','1','2017-12-24 00:32:15'),(117,1,'B-ORQps1hI','57426270',1,'1','2017-12-24 00:32:15','1','2017-12-24 00:32:15'),(118,1,'B-GmxIVV58','23192234',1,'1','2017-12-24 00:32:15','1','2017-12-24 00:32:15'),(119,1,'B-fkKObrW8','48110911',1,'1','2017-12-24 00:32:15','1','2017-12-24 00:32:15'),(120,1,'B-j9T4VP3j','59582837',1,'1','2017-12-24 00:32:15','1','2017-12-24 00:32:15'),(121,1,'B-ad71LUxn','19729935',1,'1','2017-12-24 00:32:15','1','2017-12-24 00:32:15'),(122,1,'B-5rbR7V0f','33351636',1,'1','2017-12-24 00:32:15','1','2017-12-24 00:32:15'),(123,1,'B-GQcTkR6s','26926375',1,'1','2017-12-24 00:32:15','1','2017-12-24 00:32:15'),(124,1,'B-CMx9iof3','08414775',1,'1','2017-12-24 00:32:15','1','2017-12-24 00:32:15'),(125,1,'B-BP1lgzVy','42016766',1,'1','2017-12-24 00:32:15','1','2017-12-24 00:32:15'),(126,1,'B-AdpiIKcI','99346107',1,'1','2017-12-24 00:32:15','1','2017-12-24 00:32:15'),(127,1,'B-W2V3pprK','97255925',1,'1','2017-12-24 00:32:15','1','2017-12-24 00:32:15'),(128,1,'B-Z6FiGiqG','40511595',1,'1','2017-12-24 00:32:15','1','2017-12-24 00:32:15'),(129,1,'B-bPaH5HS3','85435799',1,'1','2017-12-24 00:32:15','1','2017-12-24 00:32:15'),(130,1,'B-rBcyjJ5D','14230185',1,'1','2017-12-24 00:32:15','1','2017-12-24 00:32:15'),(131,1,'B-WTnSa5LR','46694591',1,'1','2017-12-24 00:32:15','1','2017-12-24 00:32:15'),(132,1,'B-kW7Kh3Pu','34046999',1,'1','2017-12-24 00:32:15','1','2017-12-24 00:32:15'),(133,1,'B-RkSqgd8A','16062978',1,'1','2017-12-24 00:32:15','1','2017-12-24 00:32:15');
/*!40000 ALTER TABLE `tbl_trans_account` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-06-29 11:07:18
