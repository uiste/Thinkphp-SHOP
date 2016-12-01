
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

# 管理员表
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