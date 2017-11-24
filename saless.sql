/*
Navicat MySQL Data Transfer

Source Server         : Localhost
Source Server Version : 50718
Source Host           : localhost:3306
Source Database       : saless

Target Server Type    : MYSQL
Target Server Version : 50718
File Encoding         : 65001

Date: 2017-11-22 11:18:52
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for borrow
-- ----------------------------
DROP TABLE IF EXISTS `borrow`;
CREATE TABLE `borrow` (
  `borrow_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(30) NOT NULL,
  `gal_qty` int(10) NOT NULL,
  `dateB` date NOT NULL,
  `daeR` date NOT NULL,
  `gal_name` varchar(30) NOT NULL,
  PRIMARY KEY (`borrow_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of borrow
-- ----------------------------

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of collection
-- ----------------------------
INSERT INTO `collection` VALUES ('1', '11/02/2017', 'AS-322230', 'IN-86042422', '200', 'test', '200', null);
INSERT INTO `collection` VALUES ('2', '11/02/2017', 'AS-322230', 'IN-22322', '500', 'sobra', '-300', null);

-- ----------------------------
-- Table structure for customer
-- ----------------------------
DROP TABLE IF EXISTS `customer`;
CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(100) NOT NULL,
  `customer_Fname` varchar(30) NOT NULL,
  `address` varchar(100) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `membership_number` varchar(100) NOT NULL,
  `order_qty` int(100) NOT NULL,
  `cdate` date NOT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of customer
-- ----------------------------
INSERT INTO `customer` VALUES ('2', 'Nelvin Bacoro', '', 'binugao toril, D.C.', '09480440325', '', '0', '0000-00-00');
INSERT INTO `customer` VALUES ('5', 'Sheena Mae Aragon', '', 'toril, davao city', '093434234234', '', '0', '0000-00-00');
INSERT INTO `customer` VALUES ('6', 'Toni Fowler (breezy)', '', 'manila, tarlac', '334343434', '', '0', '0000-00-00');
INSERT INTO `customer` VALUES ('7', 'Christian Alfred Jagape', '', 'Astorga, bay bay', '983837382', '', '0', '0000-00-00');
INSERT INTO `customer` VALUES ('8', 'miano', 'michelle', 'nabutas, manila city', '987979', '', '0', '0000-00-00');

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
  `meters` decimal(11,2) DEFAULT NULL,
  `free_meters` decimal(11,2) DEFAULT NULL,
  `rate` decimal(11,2) DEFAULT NULL,
  `fee` decimal(11,2) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of deliveries
-- ----------------------------
INSERT INTO `deliveries` VALUES ('1', '1', 'Crossing Bayabas, Davao City, Davao Region, Philippines', '7.0225062', '125.49599269999999', '1162.00', '1000.00', '30.00', '4.86', '0');
INSERT INTO `deliveries` VALUES ('2', '2', 'Crossing Bayabas, Davao City, Davao Region, Philippines', '7.0225062', '125.49599269999999', '1162.00', '1000.00', '30.00', '0.00', '0');
INSERT INTO `deliveries` VALUES ('3', '3', 'Sandawa Road, Davao City, Davao Region, Philippines', '7.060847499999999', '125.60139989999993', '14057.00', '1000.00', '30.00', '390.00', '0');
INSERT INTO `deliveries` VALUES ('4', '6', 'MERGRANDE OCEAN RESORT, Davao City, Philippines', '7.032309999999999', '125.52918599999998', '5737.00', '1000.00', '30.00', '120.00', '0');
INSERT INTO `deliveries` VALUES ('5', '7', 'Bago Elementary School, Davao City, Philippines', '7.19071', '125.45499999999993', '23789.00', '1000.00', '30.00', '660.00', '0');
INSERT INTO `deliveries` VALUES ('6', '8', 'Bago Gallera Elementary School, Libby Road, Davao City, Davao Region, Philippines', '7.054586499999999', '125.51122239999995', '7299.00', '1000.00', '30.00', '180.00', '0');
INSERT INTO `deliveries` VALUES ('7', '9', 'Bago Gallera Elementary School, Libby Road, Davao City, Davao Region, Philippines', '7.054586499999999', '125.51122239999995', '5533.00', '1000.00', '30.00', '120.00', '0');

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
INSERT INTO `products` VALUES ('16', '', 'Purified Water 5 galloons', '', '100', '', '-40', '2017-01-31');
INSERT INTO `products` VALUES ('17', '', 'Purified Water 350 ml', '', '15', '', '25', '2017-01-31');
INSERT INTO `products` VALUES ('18', '', 'Purified Water 500 ml', '', '20', '', '13', '2017-01-31');
INSERT INTO `products` VALUES ('19', '', 'Purified Water 1000 ml', '', '50', '', '16', '2017-01-31');

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

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
