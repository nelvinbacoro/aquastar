/*
Navicat MySQL Data Transfer

Source Server         : Localhost
Source Server Version : 50718
Source Host           : localhost:3306
Source Database       : saless

Target Server Type    : MYSQL
Target Server Version : 50718
File Encoding         : 65001

Date: 2018-01-12 16:49:04
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for borrow
-- ----------------------------
DROP TABLE IF EXISTS `borrow`;
CREATE TABLE `borrow` (
  `borrow_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `gal_qty` int(10) NOT NULL,
  `dateB` date NOT NULL,
  `daeR` date DEFAULT NULL,
  `gal_name` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`borrow_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of borrow
-- ----------------------------
INSERT INTO `borrow` VALUES ('1', '2', '1', '2017-12-14', null, null);
INSERT INTO `borrow` VALUES ('2', '5', '2', '2017-12-14', '2017-12-25', null);

-- ----------------------------
-- Table structure for collection
-- ----------------------------
DROP TABLE IF EXISTS `collection`;
CREATE TABLE `collection` (
  `transaction_id` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `invoice` varchar(100) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `remarks` varchar(100) NOT NULL,
  `balance` int(11) NOT NULL,
  `credit` int(20) DEFAULT NULL,
  PRIMARY KEY (`transaction_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of collection
-- ----------------------------
INSERT INTO `collection` VALUES ('1', '11/02/2017', 'AS-322230', 'IN-86042422', '200', 'test', '200', null);
INSERT INTO `collection` VALUES ('2', '11/02/2017', 'AS-322230', 'IN-22322', '500', 'sobra', '-300', null);
INSERT INTO `collection` VALUES ('3', '01/12/2018', 'AS-0022322', 'IN-7334206', '10', '', '10', null);

-- ----------------------------
-- Table structure for customer
-- ----------------------------
DROP TABLE IF EXISTS `customer`;
CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(100) NOT NULL,
  `customer_Fname` varchar(30) NOT NULL,
  `address` varchar(100) NOT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `contact` varchar(100) NOT NULL,
  `membership_number` varchar(100) DEFAULT NULL,
  `order_qty` int(100) DEFAULT NULL,
  `cdate` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of customer
-- ----------------------------
INSERT INTO `customer` VALUES ('2', 'Nelvin Bacoro', '', 'binugao toril, D.C.', '', '09480440325', null, null, '0000-00-00', '1');
INSERT INTO `customer` VALUES ('5', 'Sheena Mae Aragon', '', 'toril, davao city', '', '093434234234', null, null, '0000-00-00', '0');
INSERT INTO `customer` VALUES ('6', 'Toni Fowler (breezy)', '', 'manila, tarlac', '', '334343434', null, null, '0000-00-00', '0');
INSERT INTO `customer` VALUES ('7', 'Christian Alfred Jagape', '', 'Astorga, bay bay', '', '983837382', null, null, '0000-00-00', '1');
INSERT INTO `customer` VALUES ('8', 'miano', 'michelle', 'nabutas, manila city', '', '987979', null, null, '0000-00-00', '1');

-- ----------------------------
-- Table structure for deliveries
-- ----------------------------
DROP TABLE IF EXISTS `deliveries`;
CREATE TABLE `deliveries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sales_id` int(11) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `lat` varchar(255) DEFAULT NULL,
  `lng` varchar(255) DEFAULT NULL,
  `office_lat` varchar(255) DEFAULT NULL,
  `office_lng` varchar(255) DEFAULT NULL,
  `meters` decimal(11,2) DEFAULT NULL,
  `free_meters` decimal(11,2) DEFAULT NULL,
  `rate` decimal(11,2) DEFAULT NULL,
  `fee` decimal(11,2) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of deliveries
-- ----------------------------
INSERT INTO `deliveries` VALUES ('1', '29', 'Bago Gallera Elementary School, Libby Road, Davao City, Davao Region, Philippines', '7.054586499999999', '125.51122239999995', '7.0147022', '125.4973114', '5474.00', '1000.00', '10.00', '40.00', '0');
INSERT INTO `deliveries` VALUES ('2', '30', 'Bago Gallera Health Center, Davao City, Davao Region, Philippines', '7.054498', '125.51195519999999', '7.0147022', '125.4973114', '7164.00', '3000.00', '30.00', '120.00', '0');
INSERT INTO `deliveries` VALUES ('4', '33', 'Bago Gallera Elementary School, Libby Road, Davao City, Davao Region, Philippines', '7.054586499999999', '125.51122239999995', '7.013093', '125.490490', '5943.00', '1000.00', '10.00', '40.00', '0');
INSERT INTO `deliveries` VALUES ('5', '34', 'Bago Gallera Elementary School, Libby Road, Davao City, Davao Region, Philippines', '7.054586499999999', '125.51122239999995', '7.01506289', '125.49776226', '5474.00', '1000.00', '10.00', '40.00', '0');
INSERT INTO `deliveries` VALUES ('6', '35', 'Bago Gallera Health Center, Davao City, Davao Region, Philippines', '7.054498', '125.51195519999999', '7.01506289', '125.49776226', '7164.00', '2000.00', '30.00', '150.00', '0');
INSERT INTO `deliveries` VALUES ('7', '36', 'Puan Barangay Health Center, Davao City, Philippines', '7.083198', '125.54497700000002', '7.01506289', '125.49776226', '11351.00', '2000.00', '20.00', '180.00', '0');
INSERT INTO `deliveries` VALUES ('8', '37', 'BINUGAO CENTRAL ELEMENTARY SCHOOL, Philippines', '6.974461', '125.47827600000005', '7.01506289', '125.49776226', '5668.00', '2000.00', '20.00', '60.00', '0');
INSERT INTO `deliveries` VALUES ('9', '38', 'Bago Gallera Elementary School, Libby Road, Davao City, Davao Region, Philippines', '7.054586499999999', '125.51122239999995', '6.973568', '125.475454', '11278.00', '2000.00', '20.00', '180.00', '0');
INSERT INTO `deliveries` VALUES ('10', '39', 'BINUGAO CENTRAL ELEMENTARY SCHOOL, Philippines', '6.974461', '125.47827600000005', '6.973568', '125.475454', '591.00', '2000.00', '20.00', '0.00', '0');

-- ----------------------------
-- Table structure for products
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_code` varchar(50) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `cost` varchar(100) NOT NULL,
  `price` varchar(100) NOT NULL,
  `supplier` varchar(100) NOT NULL,
  `qty` int(10) NOT NULL,
  `date_loaded` date NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of products
-- ----------------------------
INSERT INTO `products` VALUES ('16', '', 'Purified Water 5 galloons', '', '100', '', '0', '2017-01-31');
INSERT INTO `products` VALUES ('17', '', 'Purified Water 350 ml', '', '15', '', '10', '2017-01-31');
INSERT INTO `products` VALUES ('18', '', 'Purified Water 500 ml', '', '20', '', '5', '2017-01-31');
INSERT INTO `products` VALUES ('19', '', 'Purified Water 1000 ml', '', '50', '', '3', '2017-01-31');

-- ----------------------------
-- Table structure for sales
-- ----------------------------
DROP TABLE IF EXISTS `sales`;
CREATE TABLE `sales` (
  `transaction_id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_number` varchar(100) NOT NULL,
  `cashier` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `due_date` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `balance` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`transaction_id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sales
-- ----------------------------
INSERT INTO `sales` VALUES ('1', 'AS-22232030', 'Argie', '11/02/2017', 'cash', '100', '122', 'Nelvin Bacoro', null);
INSERT INTO `sales` VALUES ('2', 'AS-032202', 'Argie', '11/02/2017', 'cash', '100', '122', 'Nelvin Bacoro', null);
INSERT INTO `sales` VALUES ('3', 'AS-032269', 'Argie', '11/02/2017', 'cash', '200', '150', 'Toni Fowler (breezy)', null);
INSERT INTO `sales` VALUES ('4', 'AS-2422032', 'Argie', '11/02/2017', 'credit', '300', '25', 'miano', null);
INSERT INTO `sales` VALUES ('5', 'AS-322230', 'Argie', '11/02/2017', 'credit', '400', 'sobra', 'Nelvin Bacoro', '-300');
INSERT INTO `sales` VALUES ('6', 'AS-33309', 'Argie', '11/02/2017', 'cash', '100', '500', 'miano', null);
INSERT INTO `sales` VALUES ('7', 'AS-2222030', 'Argie', '11/03/2017', 'cash', '100', '500', 'Toni Fowler (breezy)', null);
INSERT INTO `sales` VALUES ('8', 'AS-23638340', 'Argie', '11/03/2017', 'cash', '50', '100', 'Christian Alfred Jagape', null);
INSERT INTO `sales` VALUES ('9', 'AS-3224027', 'Argie', '11/22/2017', 'cash', '500', '700', 'Sheena Mae Aragon', null);
INSERT INTO `sales` VALUES ('10', 'AS-230633', 'Argie', '11/24/2017', 'cash', '500', '1234', 'Sheena Mae Aragon', null);
INSERT INTO `sales` VALUES ('11', 'AS-03232920', 'Argie', '12/10/2017', 'cash', '100', '100', 'Nelvin Bacoro', null);
INSERT INTO `sales` VALUES ('12', 'AS-30332322', 'Argie', '12/10/2017', 'cash', '100', '100', 'Nelvin Bacoro', null);
INSERT INTO `sales` VALUES ('13', 'AS-83332230', 'Argie', '12/10/2017', 'cash', '100', '100', 'Sheena Mae Aragon', null);
INSERT INTO `sales` VALUES ('14', 'AS-89360008', 'Argie', '12/10/2017', 'cash', '100', '100', 'Nelvin Bacoro', null);
INSERT INTO `sales` VALUES ('15', 'AS-2983', 'Argie', '12/10/2017', 'cash', '30', '100', 'Nelvin Bacoro', null);
INSERT INTO `sales` VALUES ('16', 'AS-0233242', 'Argie', '12/14/2017', 'cash', '100', '600', 'Toni Fowler (breezy)', null);
INSERT INTO `sales` VALUES ('17', 'AS-3295223', 'Argie', '12/14/2017', 'cash', '100', '5', 'Nelvin Bacoro', null);
INSERT INTO `sales` VALUES ('18', 'AS-30230', 'Argie', '12/14/2017', 'cash', '100', '500', 'Nelvin Bacoro', null);
INSERT INTO `sales` VALUES ('19', 'AS-39032203', 'Argie', '12/14/2017', 'cash', '100', '500', 'Sheena Mae Aragon', null);
INSERT INTO `sales` VALUES ('20', 'AS-30033223', 'Argie', '12/14/2017', 'cash', '100', '111', 'Toni Fowler (breezy)', null);
INSERT INTO `sales` VALUES ('21', 'AS-30033223', 'Argie', '12/14/2017', 'cash', '100', '111', 'Christian Alfred Jagape', null);
INSERT INTO `sales` VALUES ('22', 'AS-223230', 'Argie', '12/14/2017', 'cash', '15', '1111', 'Nelvin Bacoro', null);
INSERT INTO `sales` VALUES ('23', 'AS-223230', 'Argie', '12/14/2017', 'cash', '15', '1111', 'Nelvin Bacoro', null);
INSERT INTO `sales` VALUES ('24', 'AS-223230', 'Argie', '12/14/2017', 'cash', '15', '1111', 'Nelvin Bacoro', null);
INSERT INTO `sales` VALUES ('25', 'AS-223230', 'Argie', '12/14/2017', 'cash', '15', '1111', 'Nelvin Bacoro', null);
INSERT INTO `sales` VALUES ('26', 'AS-3032332', 'Argie', '12/14/2017', 'cash', '20', '1111', 'Nelvin Bacoro', null);
INSERT INTO `sales` VALUES ('27', 'AS-22233', 'Argie', '12/14/2017', 'cash', '15', '1111', 'Toni Fowler (breezy)', null);
INSERT INTO `sales` VALUES ('28', 'AS-302337', 'Argie', '12/24/2017', 'cash', '40', '200', 'Nelvin Bacoro', null);
INSERT INTO `sales` VALUES ('29', 'AS-323757', 'Argie', '12/24/2017', 'cash', '30', '100', 'Nelvin Bacoro', null);
INSERT INTO `sales` VALUES ('30', 'AS-333822', 'Argie', '12/24/2017', 'cash', '45', '100', 'Sheena Mae Aragon', null);
INSERT INTO `sales` VALUES ('31', 'AS-2002033', 'Argie', '12/24/2017', 'cash', '15', '1000', 'Nelvin Bacoro', null);
INSERT INTO `sales` VALUES ('32', 'AS-24329', 'Argie', '12/24/2017', 'cash', '15', '1111', 'Nelvin Bacoro', null);
INSERT INTO `sales` VALUES ('33', 'AS-24329', 'Argie', '12/24/2017', 'cash', '15', '1111', 'Nelvin Bacoro', null);
INSERT INTO `sales` VALUES ('34', 'AS-32023483', 'Argie', '12/24/2017', 'cash', '30', '100', 'Christian Alfred Jagape', null);
INSERT INTO `sales` VALUES ('35', 'AS-30320232', 'Argie', '12/24/2017', 'cash', '40', '200', 'Sheena Mae Aragon', null);
INSERT INTO `sales` VALUES ('36', 'AS-2833302', 'Argie', '01/12/2018', 'cash', '20', '100', 'Nelvin Bacoro', null);
INSERT INTO `sales` VALUES ('37', 'AS-2027363', 'Argie', '01/12/2018', 'cash', '50', '500', 'Christian Alfred Jagape', null);
INSERT INTO `sales` VALUES ('38', 'AS-2023037', 'Argie', '01/12/2018', 'cash', '230', '5000', 'Nelvin Bacoro', null);
INSERT INTO `sales` VALUES ('39', 'AS-0022322', 'Argie', '01/12/2018', 'credit', '20', '', 'Nelvin Bacoro', '10');

-- ----------------------------
-- Table structure for sales_order
-- ----------------------------
DROP TABLE IF EXISTS `sales_order`;
CREATE TABLE `sales_order` (
  `transaction_id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice` varchar(100) NOT NULL,
  `product` varchar(100) NOT NULL,
  `qty` varchar(100) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` varchar(100) NOT NULL,
  `discount` varchar(100) NOT NULL,
  PRIMARY KEY (`transaction_id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sales_order
-- ----------------------------
INSERT INTO `sales_order` VALUES ('1', 'AS-22232030', 'Purified Water 5 galloons', '1', '100', 'Purified Water 5 galloons', '100', '0');
INSERT INTO `sales_order` VALUES ('2', 'AS-032202', 'Purified Water 5 galloons', '1', '100', 'Purified Water 5 galloons', '100', '0');
INSERT INTO `sales_order` VALUES ('3', 'AS-032269', 'Purified Water 5 galloons', '2', '200', 'Purified Water 5 galloons', '100', '0');
INSERT INTO `sales_order` VALUES ('4', 'AS-6223020', 'Purified Water 5 galloons', '3', '300', 'Purified Water 5 galloons', '100', '0');
INSERT INTO `sales_order` VALUES ('5', 'AS-2422032', 'Purified Water 5 galloons', '3', '300', 'Purified Water 5 galloons', '100', '0');
INSERT INTO `sales_order` VALUES ('6', 'AS-322230', 'Purified Water 5 galloons', '4', '400', 'Purified Water 5 galloons', '100', '0');
INSERT INTO `sales_order` VALUES ('7', 'AS-33309', 'Purified Water 5 galloons', '1', '100', 'Purified Water 5 galloons', '100', '0');
INSERT INTO `sales_order` VALUES ('8', 'AS-2222030', 'Purified Water 5 galloons', '1', '100', 'Purified Water 5 galloons', '100', '0');
INSERT INTO `sales_order` VALUES ('9', 'AS-23638340', 'Purified Water 1000 ml', '1', '50', 'Purified Water 1000 ml', '50', '0');
INSERT INTO `sales_order` VALUES ('10', 'AS-3224027', 'Purified Water 5 galloons', '5', '500', 'Purified Water 5 galloons', '100', '0');
INSERT INTO `sales_order` VALUES ('12', 'AS-03233559', 'Purified Water 5 galloons', '23', '2300', 'Purified Water 5 galloons', '100', '0');
INSERT INTO `sales_order` VALUES ('13', 'AS-230633', 'Purified Water 5 galloons', '5', '500', 'Purified Water 5 galloons', '100', '0');
INSERT INTO `sales_order` VALUES ('14', 'AS-03232920', 'Purified Water 1000 ml', '2', '100', 'Purified Water 1000 ml', '50', '0');
INSERT INTO `sales_order` VALUES ('15', 'AS-30332322', 'Purified Water 1000 ml', '2', '100', 'Purified Water 1000 ml', '50', '0');
INSERT INTO `sales_order` VALUES ('16', 'AS-83332230', 'Purified Water 1000 ml', '2', '100', 'Purified Water 1000 ml', '50', '0');
INSERT INTO `sales_order` VALUES ('17', 'AS-89360008', 'Purified Water 1000 ml', '2', '100', 'Purified Water 1000 ml', '50', '0');
INSERT INTO `sales_order` VALUES ('18', 'AS-2983', 'Purified Water 350 ml', '2', '30', 'Purified Water 350 ml', '15', '0');
INSERT INTO `sales_order` VALUES ('19', 'AS-0233242', 'Purified Water 5 galloons', '1', '100', 'Purified Water 5 galloons', '100', '');
INSERT INTO `sales_order` VALUES ('20', 'AS-3295223', 'Purified Water 5 galloons', '1', '100', 'Purified Water 5 galloons', '100', '');
INSERT INTO `sales_order` VALUES ('21', 'AS-30230', 'Purified Water 5 galloons', '1', '100', 'Purified Water 5 galloons', '100', '');
INSERT INTO `sales_order` VALUES ('22', 'AS-39032203', 'Purified Water 5 galloons', '1', '100', 'Purified Water 5 galloons', '100', '');
INSERT INTO `sales_order` VALUES ('23', 'AS-30033223', 'Purified Water 5 galloons', '1', '100', 'Purified Water 5 galloons', '100', '');
INSERT INTO `sales_order` VALUES ('24', 'AS-223230', 'Purified Water 350 ml', '1', '15', 'Purified Water 350 ml', '15', '');
INSERT INTO `sales_order` VALUES ('25', 'AS-3032332', 'Purified Water 500 ml', '1', '20', 'Purified Water 500 ml', '20', '');
INSERT INTO `sales_order` VALUES ('26', 'AS-22233', 'Purified Water 350 ml', '1', '15', 'Purified Water 350 ml', '15', '');
INSERT INTO `sales_order` VALUES ('27', 'AS-302337', 'Purified Water 500 ml', '2', '40', 'Purified Water 500 ml', '20', '');
INSERT INTO `sales_order` VALUES ('28', 'AS-323757', 'Purified Water 350 ml', '2', '30', 'Purified Water 350 ml', '15', '');
INSERT INTO `sales_order` VALUES ('29', 'AS-333822', 'Purified Water 350 ml', '3', '45', 'Purified Water 350 ml', '15', '');
INSERT INTO `sales_order` VALUES ('30', 'AS-2002033', 'Purified Water 350 ml', '1', '15', 'Purified Water 350 ml', '15', '');
INSERT INTO `sales_order` VALUES ('31', 'AS-24329', 'Purified Water 350 ml', '1', '15', 'Purified Water 350 ml', '15', '');
INSERT INTO `sales_order` VALUES ('32', 'AS-32023483', 'Purified Water 350 ml', '2', '30', 'Purified Water 350 ml', '15', '');
INSERT INTO `sales_order` VALUES ('33', 'AS-30320232', 'Purified Water 500 ml', '2', '40', 'Purified Water 500 ml', '20', '');
INSERT INTO `sales_order` VALUES ('35', 'AS-2833302', 'Purified Water 500 ml', '1', '20', 'Purified Water 500 ml', '20', '');
INSERT INTO `sales_order` VALUES ('36', 'AS-2027363', 'Purified Water 1000 ml', '1', '50', 'Purified Water 1000 ml', '50', '');
INSERT INTO `sales_order` VALUES ('37', 'AS-2023037', 'Purified Water 350 ml', '2', '30', 'Purified Water 350 ml', '15', '');
INSERT INTO `sales_order` VALUES ('38', 'AS-2023037', 'Purified Water 1000 ml', '4', '200', 'Purified Water 1000 ml', '50', '');
INSERT INTO `sales_order` VALUES ('39', 'AS-0022322', 'Purified Water 500 ml', '1', '20', 'Purified Water 500 ml', '20', '');

-- ----------------------------
-- Table structure for settings
-- ----------------------------
DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `label` text,
  `value` varchar(255) DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of settings
-- ----------------------------
INSERT INTO `settings` VALUES ('1', 'site_name', 'Site Name', 'AQR', '0');
INSERT INTO `settings` VALUES ('2', 'free_distance', 'Free Distance', '2000', '0');
INSERT INTO `settings` VALUES ('3', 'delivery_rate', 'Delivery Rate', '20.00', '0');
INSERT INTO `settings` VALUES ('4', 'office_location_lat', 'Office Location Latitude', '6.973568', '0');
INSERT INTO `settings` VALUES ('5', 'office_location_lng', 'Office Location Longitude', '125.475454', '0');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `position` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'admin', 'admin', 'Argie', 'admin');
INSERT INTO `user` VALUES ('2', 'febe', 'febe', 'Febe', 'cashier');
INSERT INTO `user` VALUES ('3', 'keven', 'prince', 'nelvin bacoro', 'Cashier');

-- ----------------------------
-- Table structure for user2
-- ----------------------------
DROP TABLE IF EXISTS `user2`;
CREATE TABLE `user2` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of user2
-- ----------------------------
INSERT INTO `user2` VALUES ('1', 'admin', 'admin');
