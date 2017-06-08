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