 CREATE TABLE `c_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `eno` varchar(10) NOT NULL DEFAULT '' COMMENT '工号',
  `pass` varchar(50) NOT NULL COMMENT '密码',
  `name` varchar(20) DEFAULT '' COMMENT '姓名',
  `username` varchar(30) NOT NULL COMMENT '用户名',
  `birth` date DEFAULT NULL COMMENT '生日',
  `sex` tinyint(2) NOT NULL DEFAULT '1' COMMENT '性别',
  `tel` varchar(20) NOT NULL COMMENT '电话号码',
  `qq` varchar(15) DEFAULT NULL COMMENT 'qq',
  `dept` mediumint(4) NOT NULL COMMENT '部门',
  `group` mediumint(5) DEFAULT NULL COMMENT '组别',
  `ismaster` tinyint(1) DEFAULT NULL COMMENT '是否精英',
  `status` tinyint(2) DEFAULT NULL COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8