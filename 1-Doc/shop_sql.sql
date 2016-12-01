
# 会员表
DROP TABLE IF EXISTS `jx_member`;
CREATE TABLE `jx_member` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `username` varchar(30) DEFAULT NULL,
  `password` char(32) DEFAULT NULL,
  `salt` char(20) DEFAULT NULL COMMENT 'salt使用uniqid函数生成一个随机字符串',
  `email` varchar(30) DEFAULT NULL,
  `phone` varchar(15) DEFAULT '' COMMENT '例如 (086)18620628729',
  `isactive` tinyint(3) unsigned DEFAULT '0' COMMENT '0代表没有激活 1代表已经激活',
  `registertime` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

# 创建后台管理员表
DROP TABLE IF EXISTS `jx_admin`;
CREATE TABLE `jx_admin` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(30) DEFAULT NULL,
  `role_id` tinyint(3) unsigned DEFAULT '0',
  `password` char(32) DEFAULT NULL,
  `salt` char(20) DEFAULT NULL,
  `register_time` int(10) unsigned DEFAULT NULL,
  `login_time` int(10) unsigned DEFAULT '0',
  `email` varchar(50) DEFAULT NULL,
  `login_ip` int(11) DEFAULT '0' COMMENT '保存IP地址的时候使用ip2long函数处理',
  `mark_up` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

#创建后台权限表
DROP TABLE IF EXISTS jx_auth;
CREATE TABLE jx_auth(
  auth_id SMALLINT UNSIGNED auto_increment PRIMARY KEY COMMENT 'auth_id' ,
  auth_name VARCHAR(50) NOT NULL COMMENT '权限名称' ,
  auth_pid SMALLINT UNSIGNED NOT NULL COMMENT '权限父级id' ,
  auth_c VARCHAR(50) NULL COMMENT '控制器名' ,
  auth_a VARCHAR(50) NULL COMMENT '方法名' ,
  #auth_path VARCHAR(50) NULL COMMENT '全路径,格式:父级id-子级id' ,
  is_show TINYINT NOT NULL DEFAULT 1 COMMENT '是否显示在导航栏上'
) ENGINE = INNODB charset = utf8 COMMENT '权限表';

#创建后台角色表
DROP TABLE IF EXISTS jx_role;
CREATE TABLE IF NOT EXISTS jx_role(
  role_id TINYINT UNSIGNED auto_increment PRIMARY KEY COMMENT 'role_id' ,
  role_name VARCHAR(50) NOT NULL COMMENT '角色名称' ,
  role_auth_ids VARCHAR(255) NOT NULL COMMENT '角色具有权限id的集合，格式1,2,5'
  #role_auth_ac text NOT NULL COMMENT '控制器和方法的组合，格式：控制器-方法名'
) ENGINE = INNODB charset = utf8 COMMENT '角色表';