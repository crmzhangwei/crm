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
  `dept_id` mediumint(4) NOT NULL COMMENT '部门',
  `group_id` mediumint(5) DEFAULT NULL COMMENT '组别',
  `manager_id` int not null COMMENT '主管id',
  `ismaster` tinyint(1) DEFAULT NULL COMMENT '是否精英',
  `status` tinyint(2) DEFAULT NULL COMMENT '状态',
  `cust_num` int NOT NULL DEFAULT 0 COMMENT '已分配资源数',
  `create_time` int NOT NULL COMMENT '创建时间',
  `login_time` int NOT NULL COMMENT '最后登录时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;


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

 
CREATE TABLE `c_user_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `user_id` int NOT NULL COMMENT '用户id',
  `role_id` int NOT NULL COMMENT '角色id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `c_menu_info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(100) NOT NULL COMMENT '资源名称',
  `url` varchar(100) NOT NULL COMMENT '资源url',
  `parent_id` int COMMENT '上级资源id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `c_privilege` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `menu_id` int NOT NULL COMMENT '资源id',
  `role_id` int NOT NULL COMMENT '角色id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `c_cust_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `lib_type` int NOT NULL COMMENT '库类型',
  `type_no` varchar(5) NOT NULL COMMENT '类型编号',
  `type_name` varchar(100) NOT NULL COMMENT '类型名称',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `c_customer_Info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键', 
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
  `cust_type` int NOT NULL DEFAULT 0 COMMENT '客户分类',
  `eno` varchar(10) COMMENT '所属工号',
  `iskey` int COMMENT '是否重点',
  `assign_eno` varchar(10) COMMENT '分配人',
  `assign_time` int COMMENT '分配时间',
  `next_time` int COMMENT '下次联系时间',
  `status` int COMMENT '状态',
  `memo` varchar(100) COMMENT '备注',
  `create_time` int NOT NULL COMMENT '创建时间',
  `creator` int NOT NULL COMMENT '创建人',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `c_cust_convt_detail` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `lib_type` int NOT NULL COMMENT '库类型',
  `cust_id` int NOT NULL COMMENT '客户id',
  `cust_type_1` int NOT NULL COMMENT '原始类别',
  `cust_type_2` int NOT NULL COMMENT '转换类别',
  `convt_time` int NOT NULL COMMENT '转换时间',
  `user_id`  int NOT NULL COMMENT '操作人',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `c_note_info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键', 
  `cust_id` int NOT NULL COMMENT '客户id',
  `cust_info` varchar(200) COMMENT '客户情况',
  `requirement` varchar(200) COMMENT '挖需求',
  `service` varchar(200) COMMENT '介绍服务',
  `dissent` varchar(200) COMMENT '异议处理',
  `next_followup` varchar(200) COMMENT '下次跟进处理',
  `memo` varchar(200) COMMENT '备注',
  `isvalid` boolean COMMENT '是否有效',
  `iskey` boolean COMMENT '是否重点',
  `next_contact` int COMMENT '下次联系时间',
  `dial_id` int COMMENT '电话拔打id',
  `eno` int NOT NULL COMMENT '工号',
  `create_time` int NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `c_dial_detail` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `eno` varchar(10) NOT NULL COMMENT '工号',
  `dial_time` int NOT NULL COMMENT '拔打时间',
  `dial_long` float NOT NULL COMMENT '拔打时长',
  `dial_num` int default 1 COMMENT '拔打次数',
  `record_path` varchar(200) default '' COMMENT '录音路径', 
  `isok` boolean default false COMMENT '是否成功',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `c_dic` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `code` varchar(10) NOT NULL COMMENT '编号',
  `name` varchar(100) NOT NULL COMMENT '名称',
  `ctype` varchar(20) NOT NULL COMMENT '类型', 
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `c_finance` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `cust_id` int NOT NULL COMMENT '客户id',
  `sale_user` int NOT NULL COMMENT '销售人员',
  `trans_user` int NOT NULL COMMENT '谈单师',
  `acct_number` int NOT NULL COMMENT '到账单数',
  `acct_amount` float NOT NULL COMMENT '到账金额',
  `acct_time` int NOT NULL COMMENT '到账时间',
  `creator` int NOT NULL COMMENT '创建人',
  `create_time` int NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `c_trans_cust_info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `cust_id` int NOT NULL COMMENT '客户id',
  `cust_type` int NOT NULL COMMENT '客户类型',
  `eno` varchar(10) NOT NULL COMMENT '所属工号',
  `assign_eno` varchar(10) NOT NULL COMMENT '分配人',
  `assign_time` int NOT NULL COMMENT '分配时间',
  `next_time` int NOT NULL COMMENT '下次联系时间',
  `memo` int NOT NULL COMMENT '备注',
  `creator` int NOT NULL COMMENT '创建人',
  `create_time` int NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `c_aftermarket_cust_Info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `cust_id` int NOT NULL COMMENT '客户id',
  `cust_type` int NOT NULL COMMENT '客户类型',
  `webchat` varchar(20) NOT NULL COMMENT '微信',
  `ww` varchar(20) NOT NULL COMMENT '旺旺',
  `eno` varchar(10) NOT NULL COMMENT '所属工号',
  `assign_eno` varchar(10) NOT NULL COMMENT '分配人',
  `assign_time` int NOT NULL COMMENT '分配时间',
  `next_time` int NOT NULL COMMENT '下次联系时间',
  `memo` int NOT NULL COMMENT '备注',
  `creator` int NOT NULL COMMENT '创建人',
  `create_time` int NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `c_contract_info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `cust_id` int NOT NULL COMMENT '客户id',
  `service_limit` varchar(10) NOT NULL COMMENT '服务期限',
  `total_money` int NOT NULL COMMENT '总金额',
  `pay_type` int NOT NULL COMMENT '支付方式',
  `pay_time` int NOT NULL COMMENT '支付时间',
  `promise` varchar(200) NOT NULL COMMENT '合同承诺',
  `first_pay` varchar(10) NOT NULL COMMENT '第一次支付金额',
  `second_pay` varchar(10) NOT NULL COMMENT '第二次支付金额',
  `third_pay` varchar(10) NOT NULL COMMENT '第三次支付金额',
  `fourth_pay` int NOT NULL COMMENT '第四次支付金额',
  `comm_royalty` int NOT NULL COMMENT '佣金提成',
  `comm_pay_time` int NOT NULL COMMENT '佣金支付时间',
  `creator` int NOT NULL COMMENT '创建人',
  `create_time` int NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `c_black_info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键', 
  `cust_id` int NOT NULL COMMENT '客户id',
  `lib_type` int NOT NULL COMMENT '来源库',
  `cust_type` int NOT NULL COMMENT '客户分类', 
  `create_time` int NOT NULL COMMENT '创建时间',
  `creator` int NOT NULL COMMENT '创建人',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

