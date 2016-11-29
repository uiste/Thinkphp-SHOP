
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