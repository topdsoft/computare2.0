-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 17, 2014 at 06:11 PM
-- Server version: 5.5.35
-- PHP Version: 5.3.10-1ubuntu3.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `computare`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE IF NOT EXISTS `addresses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `created_id` int(10) unsigned NOT NULL,
  `name` varchar(20) NOT NULL,
  `vendor_id` int(10) unsigned zerofill DEFAULT NULL,
  `customer_id` int(10) unsigned zerofill DEFAULT NULL,
  `line1` varchar(50) NOT NULL,
  `line2` varchar(50) NOT NULL,
  `city` varchar(30) NOT NULL,
  `state` varchar(2) NOT NULL,
  `zip` varchar(10) NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `vendor_id` (`vendor_id`),
  KEY `customer_id` (`customer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `backups`
--

CREATE TABLE IF NOT EXISTS `backups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `created_id` int(10) unsigned NOT NULL,
  `filename` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `calendarPopUps`
--

CREATE TABLE IF NOT EXISTS `calendarPopUps` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `created` datetime NOT NULL,
  `x_pos` int(11) NOT NULL,
  `y_pos` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE IF NOT EXISTS `contacts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `created_id` int(10) unsigned NOT NULL,
  `removed` datetime DEFAULT NULL,
  `removed_id` int(10) unsigned DEFAULT NULL,
  `active` tinyint(1) NOT NULL,
  `field_name` varchar(32) NOT NULL,
  `value` varchar(256) NOT NULL,
  `customer_id` int(10) unsigned zerofill DEFAULT NULL,
  `vendor_id` int(10) unsigned zerofill DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `vendor_id` (`vendor_id`),
  KEY `customer_id` (`customer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `customerDetails`
--

CREATE TABLE IF NOT EXISTS `customerDetails` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` int(10) unsigned zerofill NOT NULL,
  `customerGroup_id` int(10) unsigned DEFAULT NULL,
  `created` datetime NOT NULL,
  `created_id` int(10) unsigned NOT NULL,
  `companyName` varchar(50) NOT NULL,
  `firstName` varchar(30) NOT NULL,
  `lastName` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `notes` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `customerGroups`
--

CREATE TABLE IF NOT EXISTS `customerGroups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `created_id` int(10) unsigned NOT NULL,
  `name` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `customerGroups_items`
--

CREATE TABLE IF NOT EXISTS `customerGroups_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `item_id` int(10) unsigned NOT NULL,
  `customerGroup_id` int(10) unsigned DEFAULT NULL,
  `created` datetime NOT NULL,
  `created_id` int(10) unsigned NOT NULL,
  `deleted` datetime DEFAULT NULL,
  `deleted_id` int(10) unsigned DEFAULT NULL,
  `active` tinyint(1) NOT NULL,
  `price` float(12,2) NOT NULL,
  `qty` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `qty` (`qty`),
  KEY `item_id` (`item_id`),
  KEY `customerGroup_id` (`customerGroup_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `customerGroups_services`
--

CREATE TABLE IF NOT EXISTS `customerGroups_services` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `service_id` int(10) unsigned NOT NULL,
  `customerGroup_id` int(10) unsigned DEFAULT NULL,
  `active` tinyint(1) NOT NULL,
  `price` float(12,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `service_id` (`service_id`),
  KEY `customerGroup_id` (`customerGroup_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `customerPopUps`
--

CREATE TABLE IF NOT EXISTS `customerPopUps` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `x_pos` int(11) NOT NULL,
  `y_pos` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `id` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `customerDetail_id` int(10) unsigned NOT NULL,
  `customerGroup_id` int(10) unsigned DEFAULT NULL,
  `active` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `created_id` int(10) unsigned NOT NULL,
  `modified` datetime NOT NULL,
  `deleted_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customerDetail_id` (`customerDetail_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `customers_items`
--

CREATE TABLE IF NOT EXISTS `customers_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `item_id` int(10) unsigned NOT NULL,
  `customer_id` int(10) unsigned zerofill NOT NULL,
  `active` tinyint(1) NOT NULL,
  `price` float(12,2) NOT NULL,
  `qty` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `qty` (`qty`),
  KEY `item_id` (`item_id`),
  KEY `customer_id` (`customer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `customers_services`
--

CREATE TABLE IF NOT EXISTS `customers_services` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `service_id` int(10) unsigned NOT NULL,
  `customer_id` int(10) unsigned NOT NULL,
  `active` tinyint(1) NOT NULL,
  `price` float(12,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `service_id` (`service_id`),
  KEY `customer_id` (`customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `errorevents`
--

CREATE TABLE IF NOT EXISTS `errorevents` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `message` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `formevents`
--

CREATE TABLE IF NOT EXISTS `formevents` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `controller` varchar(40) NOT NULL,
  `action` varchar(40) NOT NULL,
  `parameters` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `formGroups`
--

CREATE TABLE IF NOT EXISTS `formGroups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `created_id` int(10) unsigned NOT NULL,
  `name` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `forms`
--

CREATE TABLE IF NOT EXISTS `forms` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `created_id` int(10) unsigned NOT NULL,
  `formGroup_id` int(10) unsigned DEFAULT NULL,
  `add_menu` tinyint(1) NOT NULL,
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='1' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `forms_groups`
--

CREATE TABLE IF NOT EXISTS `forms_groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `form_id` int(10) unsigned NOT NULL,
  `group_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `form_id` (`form_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `forms_menus`
--

CREATE TABLE IF NOT EXISTS `forms_menus` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `form_id` int(10) unsigned NOT NULL,
  `menu_id` int(10) unsigned NOT NULL,
  `ordr` float(4,1) NOT NULL,
  `name` varchar(20) NOT NULL,
  `params` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `menu_id` (`menu_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `forms_users`
--

CREATE TABLE IF NOT EXISTS `forms_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `form_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created` datetime NOT NULL,
  `visits` int(10) unsigned NOT NULL,
  `modified` datetime NOT NULL,
  `last_url` varchar(256) NOT NULL,
  `default_url` varchar(256) NOT NULL,
  `last_click_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `form_id` (`form_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `glaccountDetails`
--

CREATE TABLE IF NOT EXISTS `glaccountDetails` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `created_id` int(10) unsigned NOT NULL,
  `glaccount_id` int(10) unsigned NOT NULL,
  `glgroup_id` int(10) unsigned NOT NULL,
  `name` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `glaccounts`
--

CREATE TABLE IF NOT EXISTS `glaccounts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `created_id` int(10) unsigned NOT NULL,
  `glaccountDetail_id` int(10) unsigned NOT NULL,
  `glgroup_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `glgroup_id` (`glgroup_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `glchecks`
--

CREATE TABLE IF NOT EXISTS `glchecks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `checkNumber` int(10) unsigned zerofill NOT NULL,
  `amount` decimal(12,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `glentries`
--

CREATE TABLE IF NOT EXISTS `glentries` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `glgroups`
--

CREATE TABLE IF NOT EXISTS `glgroups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `created_id` int(10) unsigned NOT NULL,
  `name` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `glnotes`
--

CREATE TABLE IF NOT EXISTS `glnotes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `text` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `glslots`
--

CREATE TABLE IF NOT EXISTS `glslots` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `created_id` int(10) unsigned NOT NULL,
  `removed` datetime DEFAULT NULL,
  `removed_id` int(10) unsigned DEFAULT NULL,
  `active` tinyint(1) NOT NULL,
  `slot` varchar(20) NOT NULL,
  `glaccount_id` int(10) unsigned NOT NULL,
  `debit` tinyint(1) NOT NULL,
  `credit` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `groups_items`
--

CREATE TABLE IF NOT EXISTS `groups_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `item_id` int(10) unsigned NOT NULL,
  `itemGroup_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `groups_users`
--

CREATE TABLE IF NOT EXISTS `groups_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `group_id` int(10) unsigned NOT NULL,
  `created` datetime NOT NULL,
  `created_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `htmlevents`
--

CREATE TABLE IF NOT EXISTS `htmlevents` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `html` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `created_id` int(10) unsigned NOT NULL,
  `filename` varchar(100) NOT NULL,
  `thumbnail` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `imageSettings`
--

CREATE TABLE IF NOT EXISTS `imageSettings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `created_id` int(10) unsigned NOT NULL,
  `removed` datetime DEFAULT NULL,
  `removed_id` int(10) unsigned DEFAULT NULL,
  `active` tinyint(1) NOT NULL,
  `image_dir` varchar(100) NOT NULL,
  `max_image_size` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `images_items`
--

CREATE TABLE IF NOT EXISTS `images_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `image_id` int(10) unsigned NOT NULL,
  `item_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `image_id` (`image_id`,`item_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `inventoryCounts`
--

CREATE TABLE IF NOT EXISTS `inventoryCounts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `created_id` int(10) unsigned NOT NULL,
  `finished` datetime DEFAULT NULL,
  `active` tinyint(1) NOT NULL,
  `notes` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `inventoryCounts_locations`
--

CREATE TABLE IF NOT EXISTS `inventoryCounts_locations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `inventoryCount_id` int(10) unsigned NOT NULL,
  `location_id` int(10) unsigned NOT NULL,
  `finished` datetime DEFAULT NULL,
  `finished_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `inventoryCount_id` (`inventoryCount_id`),
  KEY `location_id` (`location_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `inventoryLocks`
--

CREATE TABLE IF NOT EXISTS `inventoryLocks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `created_id` int(10) unsigned NOT NULL,
  `removed` datetime DEFAULT NULL,
  `removed_id` int(10) unsigned DEFAULT NULL,
  `active` tinyint(1) NOT NULL,
  `notes` text,
  `location_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `invoiceDetails`
--

CREATE TABLE IF NOT EXISTS `invoiceDetails` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `invoice_id` int(10) unsigned zerofill NOT NULL,
  `created` datetime NOT NULL,
  `created_id` int(10) unsigned NOT NULL,
  `removed` datetime DEFAULT NULL,
  `removed_id` int(10) unsigned DEFAULT NULL,
  `active` tinyint(1) NOT NULL,
  `text` varchar(100) NOT NULL,
  `amount` float(12,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `invoice_id` (`invoice_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE IF NOT EXISTS `invoices` (
  `id` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `number` varchar(20) NOT NULL,
  `created` datetime NOT NULL,
  `created_id` int(10) unsigned NOT NULL,
  `closed` datetime DEFAULT NULL,
  `closed_id` int(10) unsigned DEFAULT NULL,
  `due` date DEFAULT NULL,
  `status` varchar(1) NOT NULL,
  `identification` varchar(64) DEFAULT NULL,
  `customer_id` int(10) unsigned zerofill DEFAULT NULL,
  `vendor_id` int(10) unsigned zerofill DEFAULT NULL,
  `purchaseOrder_id` int(10) unsigned DEFAULT NULL,
  `salesOrder_id` int(10) unsigned DEFAULT NULL,
  `billing_address_id` int(10) unsigned DEFAULT NULL,
  `shipping_address_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_id` (`customer_id`),
  KEY `vendor_id` (`vendor_id`),
  KEY `purchaseOrder_id` (`purchaseOrder_id`),
  KEY `salesOrder_id` (`salesOrder_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `issueTypes`
--

CREATE TABLE IF NOT EXISTS `issueTypes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `created_id` int(10) unsigned NOT NULL,
  `removed` datetime DEFAULT NULL,
  `removed_id` int(10) unsigned DEFAULT NULL,
  `name` varchar(30) NOT NULL,
  `glAccount_id` int(10) unsigned NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `itemCategories`
--

CREATE TABLE IF NOT EXISTS `itemCategories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `created_id` int(10) unsigned NOT NULL,
  `name` varchar(30) NOT NULL,
  `parent_id` int(10) unsigned NOT NULL,
  `lft` int(10) unsigned NOT NULL,
  `rght` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `itemCosts`
--

CREATE TABLE IF NOT EXISTS `itemCosts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `created_id` int(10) unsigned NOT NULL,
  `item_id` int(10) unsigned NOT NULL,
  `vendor_id` int(10) unsigned zerofill NOT NULL,
  `cost` float(10,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `remain` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `itemCounts`
--

CREATE TABLE IF NOT EXISTS `itemCounts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `created_id` int(10) unsigned NOT NULL,
  `item_id` int(10) unsigned NOT NULL,
  `inventoryCount_id` int(10) unsigned NOT NULL,
  `location_id` int(10) unsigned NOT NULL,
  `qty` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `item_id` (`item_id`),
  KEY `inventoryCount_id` (`inventoryCount_id`),
  KEY `location_id` (`location_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `itemDetails`
--

CREATE TABLE IF NOT EXISTS `itemDetails` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `created_id` int(10) unsigned NOT NULL,
  `name` varchar(50) NOT NULL,
  `sku` varchar(30) NOT NULL,
  `upc` varchar(15) NOT NULL,
  `item_id` int(10) unsigned NOT NULL,
  `category_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `itemGroups`
--

CREATE TABLE IF NOT EXISTS `itemGroups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `created_id` int(10) unsigned NOT NULL,
  `name` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `itemPopUps`
--

CREATE TABLE IF NOT EXISTS `itemPopUps` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `x_pos` int(11) NOT NULL,
  `y_pos` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `itemDetail_id` int(10) unsigned NOT NULL,
  `category_id` int(10) unsigned DEFAULT NULL,
  `active` tinyint(1) NOT NULL,
  `serialized` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `itemSerialNumbers`
--

CREATE TABLE IF NOT EXISTS `itemSerialNumbers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `created_id` int(10) unsigned NOT NULL,
  `item_location_id` int(10) unsigned NOT NULL,
  `item_id` int(10) unsigned NOT NULL,
  `number` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `items_locations`
--

CREATE TABLE IF NOT EXISTS `items_locations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `created_id` int(10) unsigned NOT NULL,
  `item_id` int(10) unsigned NOT NULL,
  `location_id` int(10) unsigned NOT NULL,
  `qty` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `items_vendors`
--

CREATE TABLE IF NOT EXISTS `items_vendors` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `item_id` int(10) unsigned NOT NULL,
  `vendor_id` int(10) unsigned zerofill NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `itemTransactions`
--

CREATE TABLE IF NOT EXISTS `itemTransactions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `created_id` int(10) unsigned NOT NULL,
  `item_id` int(10) unsigned NOT NULL,
  `location_id` int(10) unsigned NOT NULL,
  `sale_id` int(10) unsigned NOT NULL,
  `receipt_id` int(10) unsigned NOT NULL,
  `qty` int(11) NOT NULL,
  `type` varchar(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `itemWorkRecords`
--

CREATE TABLE IF NOT EXISTS `itemWorkRecords` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `links`
--

CREATE TABLE IF NOT EXISTS `links` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `created_id` int(10) unsigned NOT NULL,
  `removed` datetime DEFAULT NULL,
  `removed_id` int(10) unsigned DEFAULT NULL,
  `active` tinyint(1) NOT NULL,
  `workflowChain_id` int(10) unsigned NOT NULL,
  `ordr` int(11) NOT NULL,
  `controller` varchar(32) NOT NULL,
  `action` varchar(32) NOT NULL,
  `params` varchar(128) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `workflowChain_id` (`workflowChain_id`),
  KEY `active` (`active`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `locationDetails`
--

CREATE TABLE IF NOT EXISTS `locationDetails` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `created_id` int(10) unsigned NOT NULL,
  `name` varchar(64) NOT NULL,
  `parent_id` int(10) unsigned NOT NULL,
  `location_id` int(10) unsigned NOT NULL,
  `locationType_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE IF NOT EXISTS `locations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `locationDetail_id` int(10) unsigned NOT NULL,
  `lft` int(10) unsigned NOT NULL,
  `rght` int(10) unsigned NOT NULL,
  `parent_id` int(10) unsigned NOT NULL,
  `name` varchar(64) NOT NULL,
  `locationType_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `locationTypes`
--

CREATE TABLE IF NOT EXISTS `locationTypes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `created_id` int(10) unsigned NOT NULL,
  `removed` datetime DEFAULT NULL,
  `removed_id` int(10) unsigned DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `name` varchar(64) NOT NULL,
  `location_id` int(10) unsigned DEFAULT NULL,
  `default_name` varchar(64) DEFAULT NULL,
  `next_number` int(11) DEFAULT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE IF NOT EXISTS `menus` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime DEFAULT NULL,
  `created_id` int(10) unsigned DEFAULT NULL,
  `name` varchar(20) DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `index` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `menus_users`
--

CREATE TABLE IF NOT EXISTS `menus_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `ordr` float(4,1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `paymentTypes`
--

CREATE TABLE IF NOT EXISTS `paymentTypes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `created_id` int(10) unsigned NOT NULL,
  `removed` datetime DEFAULT NULL,
  `removed_id` int(10) unsigned DEFAULT NULL,
  `active` tinyint(1) NOT NULL,
  `name` varchar(32) NOT NULL,
  `identification_label` varchar(64) DEFAULT NULL,
  `gl_expense_account_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `permissionEvents`
--

CREATE TABLE IF NOT EXISTS `permissionEvents` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `userGroup_id` int(10) unsigned DEFAULT NULL,
  `form_id` int(10) unsigned DEFAULT NULL,
  `formGroup_id` int(10) unsigned DEFAULT NULL,
  `note` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `permissionSets`
--

CREATE TABLE IF NOT EXISTS `permissionSets` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `userGroup_id` int(10) unsigned DEFAULT NULL,
  `form_id` int(10) unsigned DEFAULT NULL,
  `formGroup_id` int(10) unsigned DEFAULT NULL,
  `view` tinyint(1) NOT NULL,
  `submit` tinyint(1) NOT NULL,
  `setDefault` tinyint(1) NOT NULL,
  `setLogging` tinyint(1) NOT NULL,
  `undoOwn` tinyint(1) NOT NULL,
  `undoOthers` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `userGroup_id` (`userGroup_id`),
  KEY `form_id` (`form_id`),
  KEY `formGroup_id` (`formGroup_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `programsettings`
--

CREATE TABLE IF NOT EXISTS `programsettings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `created_id` int(10) unsigned NOT NULL,
  `dbschema` int(10) unsigned NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `cost_method` varchar(1) NOT NULL,
  `backup_file_dir` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE IF NOT EXISTS `projects` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `created_id` int(10) unsigned NOT NULL,
  `finished` datetime DEFAULT NULL,
  `finished_id` int(10) unsigned DEFAULT NULL,
  `name` varchar(64) NOT NULL,
  `deadline` datetime DEFAULT NULL,
  `customer_id` int(10) unsigned DEFAULT NULL,
  `notes` text,
  PRIMARY KEY (`id`),
  KEY `customer_id` (`customer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `purchaseOrderDetails`
--

CREATE TABLE IF NOT EXISTS `purchaseOrderDetails` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `created_id` int(10) unsigned NOT NULL,
  `removed` datetime NOT NULL,
  `removed_id` int(10) unsigned NOT NULL,
  `active` tinyint(1) NOT NULL,
  `purchaseOrder_id` int(10) unsigned zerofill NOT NULL,
  `item_id` int(10) unsigned NOT NULL,
  `qty` int(11) NOT NULL,
  `rec` int(11) NOT NULL,
  `cost` float(12,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `purchaseOrders`
--

CREATE TABLE IF NOT EXISTS `purchaseOrders` (
  `id` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `created_id` int(10) unsigned NOT NULL,
  `voided` datetime NOT NULL,
  `voided_id` int(10) unsigned NOT NULL,
  `closed` datetime NOT NULL,
  `closed_id` int(10) unsigned NOT NULL,
  `vendor_id` int(10) unsigned zerofill NOT NULL,
  `status` varchar(1) NOT NULL,
  `allowOpen` tinyint(1) NOT NULL,
  `onAccount` tinyint(1) NOT NULL,
  `shipping` float(8,2) NOT NULL,
  `tax` float(8,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `receipts`
--

CREATE TABLE IF NOT EXISTS `receipts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `created_id` int(10) unsigned NOT NULL,
  `item_id` int(10) unsigned NOT NULL,
  `purchaseOrder_id` int(10) unsigned zerofill NOT NULL,
  `vendor_id` int(10) unsigned zerofill NOT NULL,
  `qty` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `receiptTypes`
--

CREATE TABLE IF NOT EXISTS `receiptTypes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `created_id` int(10) unsigned NOT NULL,
  `removed` datetime DEFAULT NULL,
  `removed_id` int(10) unsigned DEFAULT NULL,
  `name` varchar(30) NOT NULL,
  `glAccount_id` int(10) unsigned NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE IF NOT EXISTS `sales` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `created_id` int(10) unsigned NOT NULL,
  `item_id` int(10) unsigned DEFAULT NULL,
  `service_id` int(10) unsigned DEFAULT NULL,
  `salesOrderDetail_id` int(10) unsigned zerofill NOT NULL,
  `customer_id` int(10) unsigned zerofill NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `salesOrderDetails`
--

CREATE TABLE IF NOT EXISTS `salesOrderDetails` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `created_id` int(10) unsigned NOT NULL,
  `removed` datetime NOT NULL,
  `removed_id` int(10) unsigned NOT NULL,
  `active` tinyint(1) NOT NULL,
  `salesOrder_id` int(10) unsigned zerofill NOT NULL,
  `item_id` int(10) unsigned NOT NULL,
  `service_id` int(10) unsigned NOT NULL,
  `qty` float(8,2) NOT NULL,
  `shipped` int(11) NOT NULL,
  `price` float(12,2) NOT NULL,
  `tax` float(8,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `salesOrderFees`
--

CREATE TABLE IF NOT EXISTS `salesOrderFees` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `created_id` int(10) unsigned NOT NULL,
  `salesOrderType_id` int(10) unsigned NOT NULL,
  `label` varchar(64) NOT NULL,
  `debitAccount_id` int(10) unsigned NOT NULL,
  `creditAccount_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `salesOrderMods`
--

CREATE TABLE IF NOT EXISTS `salesOrderMods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `created_id` int(10) unsigned NOT NULL,
  `salesOrder_id` int(10) unsigned zerofill NOT NULL,
  `invoiced` tinyint(1) NOT NULL,
  `label` varchar(64) NOT NULL,
  `amount` decimal(12,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `salesOrders`
--

CREATE TABLE IF NOT EXISTS `salesOrders` (
  `id` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `created_id` int(10) unsigned NOT NULL,
  `closed` datetime NOT NULL,
  `closed_id` int(10) unsigned NOT NULL,
  `voided` datetime NOT NULL,
  `voided_id` int(10) unsigned NOT NULL,
  `status` varchar(1) NOT NULL,
  `salesOrderType_id` int(10) unsigned NOT NULL,
  `customer_id` int(10) unsigned NOT NULL,
  `invoice_id` int(10) unsigned zerofill DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `salesOrderTypes`
--

CREATE TABLE IF NOT EXISTS `salesOrderTypes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `created_id` int(10) unsigned NOT NULL,
  `removed` datetime DEFAULT NULL,
  `removed_id` int(10) unsigned DEFAULT NULL,
  `active` tinyint(1) NOT NULL,
  `name` varchar(50) NOT NULL,
  `action` varchar(64) NOT NULL,
  `due_days` smallint(5) unsigned DEFAULT NULL,
  `shipping` tinyint(1) NOT NULL,
  `taxable` tinyint(1) NOT NULL,
  `on_account` tinyint(1) NOT NULL,
  `stock_required` tinyint(1) NOT NULL,
  `location_id` int(10) unsigned DEFAULT NULL,
  `itemTotalDebitAcct_id` int(10) unsigned DEFAULT NULL,
  `itemTotalCreditAcct_id` int(10) unsigned DEFAULT NULL,
  `serviceTotalDebitAcct_id` int(10) unsigned DEFAULT NULL,
  `serviceTotalCreditAcct_id` int(10) unsigned DEFAULT NULL,
  `shippingDebitAcct_id` int(10) unsigned DEFAULT NULL,
  `shippingCreditAcct_id` int(10) unsigned DEFAULT NULL,
  `taxDebitAcct_id` int(10) unsigned DEFAULT NULL,
  `taxCreditAcct_id` int(10) unsigned DEFAULT NULL,
  `grandTotalDebitAcct_id` int(10) unsigned DEFAULT NULL,
  `grandTotalCreditAcct_id` int(10) unsigned DEFAULT NULL,
  `description` text NOT NULL,
  `glaccount_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `scanCodes`
--

CREATE TABLE IF NOT EXISTS `scanCodes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `created_id` int(10) unsigned NOT NULL,
  `code` varchar(18) NOT NULL,
  `item_id` int(10) unsigned DEFAULT NULL,
  `location_id` int(10) unsigned DEFAULT NULL,
  `itemSerialNumber_id` int(10) unsigned DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `print` tinyint(1) NOT NULL,
  `internal` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `code` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE IF NOT EXISTS `services` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `created_id` int(10) unsigned NOT NULL,
  `name` varchar(50) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `pricing` varchar(1) NOT NULL,
  `rate` float(12,2) NOT NULL,
  `fixedRate` tinyint(1) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `stockLevels`
--

CREATE TABLE IF NOT EXISTS `stockLevels` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `created_id` int(10) unsigned NOT NULL,
  `removed` datetime DEFAULT NULL,
  `removed_id` int(10) unsigned DEFAULT NULL,
  `active` tinyint(1) NOT NULL,
  `location_id` int(10) unsigned NOT NULL,
  `item_id` int(10) unsigned NOT NULL,
  `qty` int(11) NOT NULL,
  `priority` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `location_id` (`location_id`),
  KEY `item_id` (`item_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sysevents`
--

CREATE TABLE IF NOT EXISTS `sysevents` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `created_id` int(10) unsigned DEFAULT NULL,
  `remoteaddr` varchar(20) NOT NULL,
  `event_type` smallint(6) NOT NULL,
  `title` varchar(15) NOT NULL,
  `permissionevent_id` int(10) unsigned DEFAULT NULL,
  `errorevent_id` int(10) unsigned DEFAULT NULL,
  `htmlevent_id` int(10) unsigned DEFAULT NULL,
  `formevent_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='1' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE IF NOT EXISTS `tasks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `created_id` int(10) unsigned NOT NULL,
  `finished` datetime DEFAULT NULL,
  `finished_id` int(10) unsigned DEFAULT NULL,
  `removed` datetime DEFAULT NULL,
  `removed_id` int(10) unsigned DEFAULT NULL,
  `active` tinyint(1) NOT NULL,
  `project_id` int(10) unsigned NOT NULL,
  `name` varchar(128) NOT NULL,
  `deadline` datetime DEFAULT NULL,
  `est_hours` float(8,2) DEFAULT NULL,
  `notes` text,
  PRIMARY KEY (`id`),
  KEY `project_id` (`project_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `timeRecords`
--

CREATE TABLE IF NOT EXISTS `timeRecords` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `finished` datetime DEFAULT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `task_id` int(10) unsigned NOT NULL,
  `duration` float(8,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `task_id` (`task_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `userGroups`
--

CREATE TABLE IF NOT EXISTS `userGroups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `created_id` int(10) unsigned NOT NULL,
  `name` varchar(30) NOT NULL,
  `log_level` smallint(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(40) NOT NULL,
  `email` varchar(60) NULL,
  `homepage` varchar(100) NULL,
  `active` tinyint(1) NOT NULL,
  `log_level` smallint(5) unsigned NOT NULL DEFAULT '0',
  `date_time_format` varchar(30) NOT NULL DEFAULT 'Y-m-d h:m:s',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users_tasks`
--

CREATE TABLE IF NOT EXISTS `users_tasks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `created_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `task_id` int(10) unsigned NOT NULL,
  `removed` datetime DEFAULT NULL,
  `removed_id` int(10) unsigned DEFAULT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `task_id` (`task_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `vendorDetails`
--

CREATE TABLE IF NOT EXISTS `vendorDetails` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `created_id` int(10) unsigned NOT NULL,
  `removed` datetime DEFAULT NULL,
  `removed_id` int(10) unsigned DEFAULT NULL,
  `active` tinyint(1) NOT NULL,
  `vendor_id` int(10) unsigned zerofill NOT NULL,
  `glAccount_id` int(10) unsigned DEFAULT NULL,
  `name` varchar(40) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `vendor_id` (`vendor_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE IF NOT EXISTS `vendors` (
  `id` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `created_id` int(10) unsigned NOT NULL,
  `active` tinyint(1) NOT NULL,
  `vendorDetail_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `workflowChains`
--

CREATE TABLE IF NOT EXISTS `workflowChains` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `created_id` int(10) unsigned NOT NULL,
  `removed` datetime DEFAULT NULL,
  `removed_id` int(10) unsigned DEFAULT NULL,
  `active` tinyint(1) NOT NULL,
  `name` varchar(64) NOT NULL,
  `return_form` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
