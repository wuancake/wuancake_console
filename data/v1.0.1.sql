/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50717
Source Host           : localhost:3306
Source Database       : weekly

Target Server Type    : MYSQL
Target Server Version : 50717
File Encoding         : 65001

Date: 2017-06-08 19:55:21
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for user_group
-- ----------------------------
DROP TABLE IF EXISTS `user_group`;
CREATE TABLE `user_group` (
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `deleteFlg` int(1) NOT NULL,
  `create_time` datetime NOT NULL,
  `modify_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE `adm` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户id',
  `username` varchar(255) COLLATE utf8_bin NOT NULL COMMENT '用户昵称',
  `email` varchar(255) COLLATE utf8_bin NOT NULL COMMENT '邮箱',
  `password` varchar(60) COLLATE utf8_bin NOT NULL COMMENT '用户密码',
  `auth` int(11) NOT NULL DEFAULT '0' COMMENT '用户权限',
  `group_id` int(11) NOT NULL DEFAULT '0' COMMENT '分组id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC COMMENT='导师表';

-- 	用户权限:
-- 		1----导师
-- 		2----管理员
-- 		3----最高管理员

-- 	分组信息：
-- 		0----'管理员没有分组'
-- 		1----PHP组
-- 		2----Web前端组
-- 		3----UI设计组
-- 		4----Android组
-- 		5----产品经理组
-- 		6----软件测试组
-- 		7----Java组

INSERT INTO user_group (user_id,group_id) SELECT id,group_id FROM `user`;
ALTER TABLE `user` DROP 	group_id;
ALTER TABLE `user`
ADD COLUMN `deleteFlg`  int(1) NOT NULL AFTER `auth`,
ADD COLUMN `create_time`  datetime NOT NULL AFTER `deleteFlg`,
ADD COLUMN `modify_time`  datetime NOT NULL AFTER `create_time`;
ALTER TABLE `wa_group`
ADD COLUMN `deleteFlg`  int(1) NOT NULL AFTER `group_name`,
ADD COLUMN `create_time`  datetime NOT NULL AFTER `deleteFlg`,
ADD COLUMN `modify_time`  datetime NOT NULL AFTER `create_time`;
