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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `c_group_info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(100) NOT NULL DEFAULT '' COMMENT '组名',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `c_dept_info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(100) NOT NULL DEFAULT '' COMMENT '部门名称', 
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `c_dept_group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `dept_id` int COMMENT '部门id',
  `group_id` int COMMENT '组别id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `c_role_info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(100) COMMENT '角色名称',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

##################
CREATE TABLE `c_user_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `user_id` int COMMENT '用户id',
  `role_id` int COMMENT '角色id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `c_menu_info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(100) COMMENT '资源名称',
  `url` varchar(100) COMMENT '资源url',
  `parent_id` int COMMENT '上级资源id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `c_privilege` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `menu_id` int COMMENT '资源id',
  `role_id` int COMMENT '角色id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `c_cust_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `type_no` varchar(5) COMMENT '类型编号',
  `type_name` varchar(100) COMMENT '类型名称',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `c_customer_Info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `cust_no` varchar(10) COMMENT '客户编号',
  `cust_name` varchar(100) COMMENT '客户名称',
  `shop_name` varchar(100) COMMENT '店铺名称',
  `corp_name` varchar(100) COMMENT '公司名称',
  `shop_url` varchar(100) COMMENT '店铺网址',
  `shop_addr` varchar(100) COMMENT '店铺地称',
  `phone` varchar(20) COMMENT '电话',
  `qq` varchar(20) COMMENT 'QQ',
  `mail` varchar(50) COMMENT '邮箱',
  `datafrom` varchar(100) COMMENT '数据来源',
  `category` int COMMENT '所属类目',
  `cust_type` int COMMENT '客户分类',
  `eno` varchar(10) COMMENT '所属工号',
  `assign_eno` varchar(10) COMMENT '分配人',
  `assign_time` DATETIME COMMENT '分配时间',
  `next_time` DATETIME COMMENT '下次联系时间',
  `memo` varchar(100) COMMENT '备注',
  `create_time` datetime COMMENT '创建时间',
  `creator` int COMMENT '创建人',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `c_cust_convt_detail` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `lib_type` int COMMENT '库类型',
  `cust_id` int COMMENT '客户id',
  `cust_type_1` int COMMENT '原始类别',
  `cust_type_2` int COMMENT '转换类别',
  `convt_time` datetime COMMENT '转换时间',
  `user_id`  int COMMENT '操作人',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `c_note_info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键', 
  `cust_id` int COMMENT '客户id',
  `cust_info` varchar(200) COMMENT '客户情况',
  `requirement` varchar(200) COMMENT '挖需求',
  `service` varchar(200) COMMENT '介绍服务',
  `dissent` varchar(200) COMMENT '异议处理',
  `next_followup` varchar(200) COMMENT '下次跟进处理',
  `memo` varchar(200) COMMENT '备注',
  `isvalid` boolean COMMENT '是否有效',
  `iskey` boolean COMMENT '是否重点',
  `next_contact` datetime COMMENT '下次联系时间',
  `record_path` varchar(200) COMMENT '录音路径',
  `eno` int COMMENT '工号',
  `create_time` datetime COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `c_dial_detail` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `eno` varchar(10) COMMENT '工号',
  `dial_time` datetime COMMENT '拔打时间',
  `dial_long` float COMMENT '拔打时长',
  `dial_num` int COMMENT '拔打次数',
  `order` int COMMENT '转换时间', 
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `c_dic` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `code` varchar(10) COMMENT '编号',
  `name` varchar(100) COMMENT '名称',
  `ctype` varchar(20) COMMENT '类型', 
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `c_finance` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `cust_id` int COMMENT '客户id',
  `sale_user` int COMMENT '销售人员',
  `trans_user` int COMMENT '谈单师',
  `acct_number` int COMMENT '到账单数',
  `acct_amount` float COMMENT '到账金额',
  `acct_time` datetime COMMENT '到账时间',
  `creator` int COMMENT '创建人',
  `create_time` datetime COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;