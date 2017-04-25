/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50717
Source Host           : localhost:3306
Source Database       : user

Target Server Type    : MYSQL
Target Server Version : 50717
File Encoding         : 65001

Date: 2017-04-25 11:35:23
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for userinfo
-- ----------------------------
DROP TABLE IF EXISTS `userinfo`;
CREATE TABLE `userinfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `userpass` varchar(20) NOT NULL,
  `userstatus` int(1) NOT NULL,
  `uniqid` varchar(32) NOT NULL,
  `useremaill` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of userinfo
-- ----------------------------
INSERT INTO `userinfo` VALUES ('2', 'hao', 'hao', '1', '8714f779046682315b664c2eccc3eb3a', '');
INSERT INTO `userinfo` VALUES ('3', 'liwenwei', 'hao', '1', '', '');
INSERT INTO `userinfo` VALUES ('4', 'lijichang', 'hao', '0', '', '');
SET FOREIGN_KEY_CHECKS=1;
