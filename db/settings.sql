/*
Navicat MySQL Data Transfer

Source Server         : Localhost
Source Server Version : 50718
Source Host           : localhost:3306
Source Database       : saless

Target Server Type    : MYSQL
Target Server Version : 50718
File Encoding         : 65001

Date: 2017-11-24 11:30:03
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for settings
-- ----------------------------
DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `label` text,
  `value` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of settings
-- ----------------------------
INSERT INTO `settings` VALUES ('1', 'site_name', 'Site Name', 'AQR');
INSERT INTO `settings` VALUES ('2', 'free_distance', 'Free Distance', '1000');
INSERT INTO `settings` VALUES ('3', 'delivery_rate', 'Delivery Rate', '30');
