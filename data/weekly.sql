/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50717
Source Host           : localhost:3306
Source Database       : weekly

Target Server Type    : MYSQL
Target Server Version : 50717
File Encoding         : 65001

Date: 2017-05-11 08:30:09
*/

SET FOREIGN_KEY_CHECKS=0;

--
-- Database: `weekly`
--
CREATE DATABASE IF NOT EXISTS `weekly` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `weekly`;


-- ----------------------------
-- Table structure for attend
-- ----------------------------
DROP TABLE IF EXISTS `attend`;
CREATE TABLE `attend` (
  `user_id` int(11) NOT NULL COMMENT '用户id',
  `group_id` int(11) NOT NULL COMMENT '分组id',
  `status` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`user_id`,`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='考勤表';

-- ----------------------------
-- Table structure for group
-- ----------------------------
DROP TABLE IF EXISTS `wa_group`;
CREATE TABLE `wa_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '分组id',
  `group_name` varchar(255) COLLATE utf8_bin NOT NULL COMMENT '分组名称',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='分组表';

-- ----------------------------
-- Table structure for report
-- ----------------------------
DROP TABLE IF EXISTS `report`;
CREATE TABLE `report` (
  `week_num` int(11) NOT NULL COMMENT '周报星期数',
  `user_id` int(11) NOT NULL COMMENT '用户id',
  `group_id` int(11) NOT NULL COMMENT '分组id',
  `text` varchar(255) COLLATE utf8_bin NOT NULL COMMENT '周报内容',
  `status` int(1) NOT NULL COMMENT '周报状态',
  `reply_time` datetime NOT NULL COMMENT '回复时间',
  PRIMARY KEY (`week_num`,`user_id`,`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='周报表';

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户id',
  `user_name` varchar(255) COLLATE utf8_bin NOT NULL COMMENT '用户昵称',
  `email` varchar(255) COLLATE utf8_bin NOT NULL COMMENT '邮箱',
  `wuan_name` varchar(255) COLLATE utf8_bin NOT NULL COMMENT '午安网昵称',
  `password` varchar(60) COLLATE utf8_bin NOT NULL COMMENT '用户密码',
  `QQ` int(11) NOT NULL COMMENT '用户QQ',
  `auth` int(11) NOT NULL COMMENT '用户权限',
  `group_id` int(11) NOT NULL DEFAULT '0' COMMENT '分组id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC COMMENT='用户表';

-- -----------------------------
-- 分组id和名称的对应关系
--    id      分组
--    1       PHP组
--    2       Web前端组
--    3       UI设计组
--    4       Android组
--    5       产品经理组
--    6       软件测试组
--    7       Java组
--  SQL：
INSERT INTO wa_group VALUE(1,'PHP组'),(2,'Web前端组'),
                          (3,'UI设计组'),(4,'Android组'),
                          (5,'产品经理组'),(6,'软件测试组'),
                          (7,'Java组');
-- -----------------------------