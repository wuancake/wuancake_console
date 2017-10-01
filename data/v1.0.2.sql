ALTER TABLE user_group ADD id int PRIMARY KEY AUTO_INCREMENT FIRST;

ALTER TABLE user_group ADD headsman varchar(255) AFTER deleteFlg;

ALTER TABLE user MODIFY QQ varchar(255) NOT NULL;