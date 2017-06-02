CREATE TABLE `adm` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户id',
  `name` varchar(255) COLLATE utf8_bin NOT NULL COMMENT '用户昵称',
  `email` varchar(255) COLLATE utf8_bin NOT NULL COMMENT '邮箱',
  `password` varchar(60) COLLATE utf8_bin NOT NULL COMMENT '用户密码',
  `auth` int(11) NOT NULL DEFAULT '0' COMMENT '用户权限',
  `group_id` int(11) NOT NULL DEFAULT '0' COMMENT '分组id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC COMMENT='导师表';

-- 	用户权限:
-- 		0----待审批
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