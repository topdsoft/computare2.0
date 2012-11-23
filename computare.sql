-- MySQL dump 10.13  Distrib 5.5.28, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: computare
-- ------------------------------------------------------
-- Server version	5.5.28-0ubuntu0.12.04.2

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
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `created_id` int(10) unsigned NOT NULL,
  `name` varchar(30) NOT NULL,
  `parent_id` int(10) unsigned NOT NULL,
  `lft` int(10) unsigned NOT NULL,
  `rght` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customerDetails`
--

DROP TABLE IF EXISTS `customerDetails`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customerDetails` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` int(10) unsigned NOT NULL,
  `created` datetime NOT NULL,
  `created_id` int(10) unsigned NOT NULL,
  `companyName` varchar(50) NOT NULL,
  `firstName` varchar(30) NOT NULL,
  `lastName` varchar(30) NOT NULL,
  `address1` varchar(50) NOT NULL,
  `address2` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(2) NOT NULL,
  `zip` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `notes` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customerDetails`
--

LOCK TABLES `customerDetails` WRITE;
/*!40000 ALTER TABLE `customerDetails` DISABLE KEYS */;
INSERT INTO `customerDetails` VALUES (1,1,'2012-10-31 17:43:18',1,'Top Drawer Software LLC','Kurt','Lakin','1705 56th st','unused','Des Moines','Io','50310','klakin2003@yahoo.com','5157701684','first attempt'),(2,1,'2012-10-31 18:00:03',1,'Top Drawer Software LLC','Kurt','Lakin','1705 56th st','unused','Des Moines','IA','50310','klakin2003@yahoo.com','5157701684','first attempt'),(3,2,'2012-10-31 18:09:58',1,'','Another','Customer','a1','a2','Des Moines','IA','50322','','',''),(4,3,'2012-10-31 18:13:36',1,'ABC Corp','','','','','','','','','',''),(5,4,'2012-10-31 18:26:11',1,'','New','Customer','','','','','','','',''),(6,2,'2012-11-01 13:36:15',1,'New Company','Another','Customer','a1','a2','Des Moines','IA','50322','','',''),(7,5,'2012-11-01 15:14:50',1,'new comp','Kurt','Lakin','2400 86th st Suite 14','','Des Moines','IA','50322','klakin2003@yahoo.com','5157701684',''),(8,5,'2012-11-01 16:15:35',1,'new comp','Kurt','Lakin','2400 86th st Suite 14','','Des Moines','IA','50322','klakin2003@yahoo.com','5157701684',''),(9,2,'2012-11-01 17:02:19',1,'New Company','Another','Customer','a1xxx','a2xxx','Des Moines','IA','50322','','','made some changes');
/*!40000 ALTER TABLE `customerDetails` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `customerDetail_id` int(10) unsigned NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `created_id` int(10) unsigned NOT NULL,
  `modified` datetime NOT NULL,
  `deleted_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customerDetail_id` (`customerDetail_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` VALUES (1,2,1,'0000-00-00 00:00:00',1,'0000-00-00 00:00:00',NULL),(2,9,1,'0000-00-00 00:00:00',1,'2012-11-01 17:02:20',NULL),(3,4,1,'0000-00-00 00:00:00',1,'0000-00-00 00:00:00',NULL),(4,5,0,'2012-10-31 18:26:11',1,'2012-10-31 18:26:11',1),(5,8,1,'2012-11-01 15:14:50',1,'2012-11-01 16:15:35',NULL);
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms`
--

DROP TABLE IF EXISTS `forms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `created_id` int(10) unsigned NOT NULL,
  `name` varchar(30) NOT NULL,
  `link` varchar(50) NOT NULL,
  `type` varchar(2) NOT NULL,
  `helplink` varchar(50) NOT NULL,
  `controller` varchar(30) NOT NULL,
  `action` varchar(30) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `controller` (`controller`),
  KEY `action` (`action`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms`
--

LOCK TABLES `forms` WRITE;
/*!40000 ALTER TABLE `forms` DISABLE KEYS */;
INSERT INTO `forms` VALUES (1,'2012-10-26 11:50:49',1,'View Forms','/forms','S','','forms','index',''),(2,'2012-10-26 11:51:38',1,'View Users','/users','S','','users','index',''),(3,'2012-10-26 11:53:32',1,'View Menus','/menus','S','','menus','index',''),(4,'2012-10-29 13:42:42',1,'Add User','/users/add','S','','users','add',''),(5,'2012-10-29 17:05:04',1,'Add Form','/forms/add','S','','forms','add',''),(6,'2012-10-31 19:06:43',1,'List Customers','/customers','AR','/pages/customers','customers','index',''),(7,'2012-10-31 19:07:11',1,'Add Customer','/customers/add','AR','','customers','add',''),(11,'2012-11-14 17:03:21',1,'Edit Form','','S','','forms','edit',''),(12,'2012-11-14 17:06:04',1,'View Customer','','AR','','customers','view',''),(13,'2012-11-14 17:06:40',1,'Edit Customer','','AR','','customers','edit',''),(15,'2012-11-14 17:46:43',1,'Edit Menu','','S','','menus','edit',''),(16,'2012-11-14 18:06:07',1,'Edit Menu Users','','S','','menus','editusers',''),(18,'2012-11-20 13:46:55',1,'List GL Account Groups','','GL','','glgroups','index',''),(19,'2012-11-20 13:53:29',1,'Add GL Account Group','','GL','','glgroups','add',''),(20,'2012-11-20 13:54:49',1,'Add Menu','','S','','menus','add',''),(21,'2012-11-20 14:03:39',1,'List GL Accounts','','GL','','glaccounts','index',''),(22,'2012-11-20 14:14:34',1,'Edit GL Account','','GL','','glaccounts','edit',''),(24,'2012-11-23 11:05:46',1,'GL Posting','','','','glaccounts','posting','');
/*!40000 ALTER TABLE `forms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_groups`
--

DROP TABLE IF EXISTS `forms_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `form_id` int(10) unsigned NOT NULL,
  `group_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `form_id` (`form_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_groups`
--

LOCK TABLES `forms_groups` WRITE;
/*!40000 ALTER TABLE `forms_groups` DISABLE KEYS */;
INSERT INTO `forms_groups` VALUES (1,1,1),(2,2,1),(3,3,1),(4,4,1);
/*!40000 ALTER TABLE `forms_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_menus`
--

DROP TABLE IF EXISTS `forms_menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_menus` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `form_id` int(10) unsigned NOT NULL,
  `menu_id` int(10) unsigned NOT NULL,
  `ordr` float(4,1) NOT NULL,
  `name` varchar(20) NOT NULL,
  `params` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `menu_id` (`menu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_menus`
--

LOCK TABLES `forms_menus` WRITE;
/*!40000 ALTER TABLE `forms_menus` DISABLE KEYS */;
INSERT INTO `forms_menus` VALUES (50,6,1,1.0,'List Customers',''),(51,7,1,2.0,'Add Customer',''),(53,0,2,1.0,'Users',''),(54,2,2,2.0,'List Users',''),(55,4,2,3.0,'Add User',''),(56,0,2,4.0,'Forms',''),(57,1,2,5.0,'List Forms',''),(58,0,2,6.0,'Menus',''),(59,3,2,7.0,'List Menus',''),(60,18,5,1.0,'List GL Groups','');
/*!40000 ALTER TABLE `forms_menus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_users`
--

DROP TABLE IF EXISTS `forms_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `form_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `form_id` (`form_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_users`
--

LOCK TABLES `forms_users` WRITE;
/*!40000 ALTER TABLE `forms_users` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `glaccountDetails`
--

DROP TABLE IF EXISTS `glaccountDetails`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `glaccountDetails` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `created_id` int(10) unsigned NOT NULL,
  `glaccount_id` int(10) unsigned NOT NULL,
  `glgroup_id` int(10) unsigned NOT NULL,
  `name` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `glaccountDetails`
--

LOCK TABLES `glaccountDetails` WRITE;
/*!40000 ALTER TABLE `glaccountDetails` DISABLE KEYS */;
INSERT INTO `glaccountDetails` VALUES (1,'2012-11-20 15:27:59',1,1,1,'test'),(2,'2012-11-20 15:56:54',1,4,1,'test2'),(4,'2012-11-20 16:05:03',1,4,3,'test2changed'),(5,'2012-11-20 16:52:57',1,1,1,'Cash'),(6,'2012-11-20 16:53:13',1,4,3,'Owner Equity'),(7,'2012-11-23 12:22:29',1,6,1,'Cash (savings)'),(8,'2012-11-23 12:23:23',1,7,1,'Inventory Assets'),(9,'2012-11-23 12:23:53',1,8,5,'Cost of Goods Sold'),(10,'2012-11-23 12:24:18',1,9,5,'Operating Expenses');
/*!40000 ALTER TABLE `glaccountDetails` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `glaccounts`
--

DROP TABLE IF EXISTS `glaccounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `glaccounts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `created_id` int(10) unsigned NOT NULL,
  `glaccountDetail_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `glaccounts`
--

LOCK TABLES `glaccounts` WRITE;
/*!40000 ALTER TABLE `glaccounts` DISABLE KEYS */;
INSERT INTO `glaccounts` VALUES (1,'2012-11-20 15:27:59',1,5),(4,'2012-11-20 15:56:54',1,6),(6,'2012-11-23 12:22:29',1,7),(7,'2012-11-23 12:23:23',1,8),(8,'2012-11-23 12:23:53',1,9),(9,'2012-11-23 12:24:18',1,10);
/*!40000 ALTER TABLE `glaccounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `glchecks`
--

DROP TABLE IF EXISTS `glchecks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `glchecks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `checkNumber` int(10) unsigned zerofill NOT NULL,
  `amount` decimal(12,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `glchecks`
--

LOCK TABLES `glchecks` WRITE;
/*!40000 ALTER TABLE `glchecks` DISABLE KEYS */;
/*!40000 ALTER TABLE `glchecks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `glentries`
--

DROP TABLE IF EXISTS `glentries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `glentries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `created_id` int(10) unsigned NOT NULL,
  `postDate` date NOT NULL,
  `glaccount_id` int(10) unsigned NOT NULL,
  `glcheck_id` int(10) unsigned NOT NULL,
  `glnote_id` int(10) unsigned NOT NULL,
  `debit` decimal(12,2) NOT NULL,
  `credit` decimal(12,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `glaccount_id` (`glaccount_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `glentries`
--

LOCK TABLES `glentries` WRITE;
/*!40000 ALTER TABLE `glentries` DISABLE KEYS */;
/*!40000 ALTER TABLE `glentries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `glgroups`
--

DROP TABLE IF EXISTS `glgroups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `glgroups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `created_id` int(10) unsigned NOT NULL,
  `name` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `glgroups`
--

LOCK TABLES `glgroups` WRITE;
/*!40000 ALTER TABLE `glgroups` DISABLE KEYS */;
INSERT INTO `glgroups` VALUES (1,'2012-11-08 15:53:57',1,'Assets'),(2,'2012-11-08 15:59:04',1,'Liabilities'),(3,'2012-11-20 13:53:42',1,'Owner Equity'),(4,'2012-11-20 13:53:51',1,'Revenue'),(5,'2012-11-20 13:53:59',1,'Expenses'),(6,'2012-11-20 13:54:05',1,'Gains'),(7,'2012-11-20 13:54:20',1,'Losses');
/*!40000 ALTER TABLE `glgroups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `glnotes`
--

DROP TABLE IF EXISTS `glnotes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `glnotes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `text` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `glnotes`
--

LOCK TABLES `glnotes` WRITE;
/*!40000 ALTER TABLE `glnotes` DISABLE KEYS */;
/*!40000 ALTER TABLE `glnotes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `created_id` int(10) unsigned NOT NULL,
  `name` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` VALUES (1,'2012-10-26 11:46:23',1,'Admin');
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groups_users`
--

DROP TABLE IF EXISTS `groups_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groups_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `group_id` int(10) unsigned NOT NULL,
  `created` datetime NOT NULL,
  `created_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups_users`
--

LOCK TABLES `groups_users` WRITE;
/*!40000 ALTER TABLE `groups_users` DISABLE KEYS */;
INSERT INTO `groups_users` VALUES (1,1,1,'0000-00-00 00:00:00',0);
/*!40000 ALTER TABLE `groups_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `images` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `created_id` int(10) unsigned NOT NULL,
  `filename` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `images`
--

LOCK TABLES `images` WRITE;
/*!40000 ALTER TABLE `images` DISABLE KEYS */;
/*!40000 ALTER TABLE `images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `images_items`
--

DROP TABLE IF EXISTS `images_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `images_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `image_id` int(10) unsigned NOT NULL,
  `item_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `image_id` (`image_id`,`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `images_items`
--

LOCK TABLES `images_items` WRITE;
/*!40000 ALTER TABLE `images_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `images_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `itemDetails`
--

DROP TABLE IF EXISTS `itemDetails`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `itemDetails` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `created_id` int(10) unsigned NOT NULL,
  `name` varchar(50) NOT NULL,
  `sku` varchar(30) NOT NULL,
  `upc` varchar(15) NOT NULL,
  `item_id` int(10) unsigned NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `itemDetails`
--

LOCK TABLES `itemDetails` WRITE;
/*!40000 ALTER TABLE `itemDetails` DISABLE KEYS */;
INSERT INTO `itemDetails` VALUES (1,'2012-10-24 14:41:36',0,'Test item 1','1','1234567890',1,0),(2,'2012-10-24 14:45:05',0,'test item 2','2','',2,0),(3,'2012-10-24 15:06:51',0,'Test item 1','1','',1,0),(4,'2012-10-24 15:15:11',0,'Test item 1 mod','1','',1,0),(5,'2012-10-25 11:49:24',0,'test item 2 changed','2','',2,0),(6,'2012-10-25 12:08:18',0,'test item 2 changed again','2','',2,0);
/*!40000 ALTER TABLE `itemDetails` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `item_ser_numbers`
--

DROP TABLE IF EXISTS `item_ser_numbers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `item_ser_numbers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `created_id` int(10) unsigned NOT NULL,
  `item_location_id` int(10) unsigned NOT NULL,
  `item_id` int(10) unsigned NOT NULL,
  `number` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `item_ser_numbers`
--

LOCK TABLES `item_ser_numbers` WRITE;
/*!40000 ALTER TABLE `item_ser_numbers` DISABLE KEYS */;
/*!40000 ALTER TABLE `item_ser_numbers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `item_transactions`
--

DROP TABLE IF EXISTS `item_transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `item_transactions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `created_id` int(10) unsigned NOT NULL,
  `item_id` int(10) unsigned NOT NULL,
  `location_id` int(10) unsigned NOT NULL,
  `qty` int(11) NOT NULL,
  `type` enum('I','R','T') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `item_transactions`
--

LOCK TABLES `item_transactions` WRITE;
/*!40000 ALTER TABLE `item_transactions` DISABLE KEYS */;
/*!40000 ALTER TABLE `item_transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `itemDetail_id` int(10) unsigned NOT NULL,
  `active` tinyint(1) NOT NULL,
  `searialized` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `items`
--

LOCK TABLES `items` WRITE;
/*!40000 ALTER TABLE `items` DISABLE KEYS */;
INSERT INTO `items` VALUES (1,4,1,0),(2,6,1,0);
/*!40000 ALTER TABLE `items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `items_locations`
--

DROP TABLE IF EXISTS `items_locations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `items_locations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `created_id` int(10) unsigned NOT NULL,
  `item_id` int(10) unsigned NOT NULL,
  `location_id` int(10) unsigned NOT NULL,
  `qty` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `items_locations`
--

LOCK TABLES `items_locations` WRITE;
/*!40000 ALTER TABLE `items_locations` DISABLE KEYS */;
/*!40000 ALTER TABLE `items_locations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `locationDetails`
--

DROP TABLE IF EXISTS `locationDetails`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `locationDetails` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `created_id` int(10) unsigned NOT NULL,
  `name` varchar(40) NOT NULL,
  `parent_id` int(10) unsigned NOT NULL,
  `lft` int(10) unsigned NOT NULL,
  `rght` int(10) unsigned NOT NULL,
  `location_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `locationDetails`
--

LOCK TABLES `locationDetails` WRITE;
/*!40000 ALTER TABLE `locationDetails` DISABLE KEYS */;
/*!40000 ALTER TABLE `locationDetails` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `locations`
--

DROP TABLE IF EXISTS `locations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `locations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `locationDetail_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `locations`
--

LOCK TABLES `locations` WRITE;
/*!40000 ALTER TABLE `locations` DISABLE KEYS */;
/*!40000 ALTER TABLE `locations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menus` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime DEFAULT NULL,
  `created_id` int(10) unsigned DEFAULT NULL,
  `name` varchar(20) DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menus`
--

LOCK TABLES `menus` WRITE;
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
INSERT INTO `menus` VALUES (1,'2012-10-26 12:00:34',1,'Customers',0),(2,'2012-10-26 12:02:48',1,'Setup',0),(3,'2012-10-26 12:04:20',1,'Menus',0),(4,'2012-10-26 15:59:51',1,'New Menu',1),(5,'2012-11-20 13:55:40',1,'General Ledger',0);
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menus_users`
--

DROP TABLE IF EXISTS `menus_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menus_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `ordr` float(4,1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menus_users`
--

LOCK TABLES `menus_users` WRITE;
/*!40000 ALTER TABLE `menus_users` DISABLE KEYS */;
INSERT INTO `menus_users` VALUES (1,1,1,2.0),(2,2,1,1.0),(5,2,2,0.0),(6,4,1,3.0),(7,5,1,0.0);
/*!40000 ALTER TABLE `menus_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(40) NOT NULL,
  `email` varchar(60) NOT NULL,
  `homepage` varchar(100) NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'2012-10-25 15:09:04','KURT','4205017a2d54144c1bb05f3ebbd2dd1a78862815','klakin2003@yahoo.com','',1),(2,'2012-10-26 15:08:07','JBOND','4205017a2d54144c1bb05f3ebbd2dd1a78862815','007@me.com','',1);
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

-- Dump completed on 2012-11-23 14:16:38
