DROP TABLE IF EXISTS `c_users`;
CREATE TABLE `c_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `eno` varchar(10) NOT NULL DEFAULT '' COMMENT '工号',
  `pass` varchar(50) NOT NULL DEFAULT '' COMMENT '密码',
  `name` varchar(20) DEFAULT '' COMMENT '姓名',
  `username` varchar(30) NOT NULL COMMENT '用户名',
  `birth` date DEFAULT NULL COMMENT '生日',
  `sex` tinyint(2) NOT NULL DEFAULT '1' COMMENT '性别',
  `tel` varchar(20) NOT NULL DEFAULT '' COMMENT '电话号码',
  `qq` varchar(15) DEFAULT 0 COMMENT 'qq',
  `dept_id` mediumint(4) NOT NULL  DEFAULT 0 COMMENT '部门',
  `group_id` mediumint(5) DEFAULT 0 COMMENT '组别',
  `manager_id` int not null DEFAULT 0  COMMENT '主管id',
  `ismaster` tinyint(1) DEFAULT 2 COMMENT '是否精英',
  `status` tinyint(2) DEFAULT 1 COMMENT '状态',
  `cust_num` int NOT NULL DEFAULT 0 COMMENT '已分配资源数',
  `extend_no` int NOT NULL DEFAULT 0 COMMENT '分机号',
  `create_time` int NOT NULL DEFAULT 0 COMMENT '创建时间',
  `login_time` int NOT NULL DEFAULT 0 COMMENT '最后登录时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS `c_dept_group`;
CREATE TABLE `c_dept_group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `dept_id` int(11) DEFAULT NULL default 0 COMMENT '部门id',
  `group_id` int(11) DEFAULT NULL default 0 COMMENT '组别id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- ----------------------------
-- Table structure for c_dept_info
-- ----------------------------
DROP TABLE IF EXISTS `c_dept_info`;
CREATE TABLE `c_dept_info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(100) NOT NULL DEFAULT '' COMMENT '部门名称',
  `parent_id` int  NULL COMMENT '上级部门',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- ----------------------------
-- Table structure for c_group_info
-- ----------------------------
DROP TABLE IF EXISTS `c_group_info`;
CREATE TABLE `c_group_info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(100) NOT NULL DEFAULT '' COMMENT '组名',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- ----------------------------
-- Table structure for c_menu_info
-- ----------------------------
DROP TABLE IF EXISTS `c_menu_info`;
CREATE TABLE `c_menu_info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(100) NOT NULL default '' COMMENT '资源名称',
  `url` varchar(100) NOT NULL default '' COMMENT '资源url',
  `parent_id` int(11) DEFAULT NULL COMMENT '上级资源id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for c_privilege
-- ----------------------------
DROP TABLE IF EXISTS `c_privilege`;
CREATE TABLE `c_privilege` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `menu_id` int(11) NOT NULL default 0 COMMENT '资源id',
  `role_id` int(11) NOT NULL default 0 COMMENT '角色id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- ----------------------------
-- Table structure for c_role_info
-- ----------------------------
DROP TABLE IF EXISTS `c_role_info`;
CREATE TABLE `c_role_info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(100) DEFAULT '' COMMENT '角色名称',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- ----------------------------
-- Table structure for c_user_role
-- ----------------------------
DROP TABLE IF EXISTS `c_user_role`;
CREATE TABLE `c_user_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `user_id` int(11) NOT NULL default 0 COMMENT '用户id',
  `role_id` int(11) NOT NULL default 0 COMMENT '角色id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `c_cust_type`;
CREATE TABLE `c_cust_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `lib_type` int(11) NOT NULL default 0 COMMENT '库类型',
  `type_no` varchar(5) NOT NULL default '' COMMENT '类型编号',
  `type_name` varchar(100) NOT NULL default '' COMMENT '类型名称',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `c_customer_info`;
CREATE TABLE `c_customer_info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `cust_name` varchar(100) DEFAULT '' COMMENT '客户名称',
  `shop_name` varchar(100) DEFAULT '' COMMENT '店铺名称',
  `corp_name` varchar(100) DEFAULT '' COMMENT '公司名称',
  `shop_url` varchar(100) DEFAULT '' COMMENT '店铺网址',
  `shop_addr` varchar(100) DEFAULT '' COMMENT '店铺地址',
  `phone` varchar(20) DEFAULT '' COMMENT '电话',
  `phone2` varchar(20) DEFAULT '' COMMENT '电话2',
  `phone3` varchar(20) DEFAULT '' COMMENT '电话3',
  `phone4` varchar(20) DEFAULT '' COMMENT '电话4',
  `phone5` varchar(20) DEFAULT '' COMMENT '电话5',
  `qq` varchar(20) DEFAULT '' COMMENT 'QQ',
  `mail` varchar(50) DEFAULT '' COMMENT '邮箱',
  `datafrom` varchar(100) DEFAULT '' COMMENT '数据来源',
  `category` int(11) DEFAULT 0 COMMENT '所属类目',
  `cust_type` int(11) DEFAULT 0 COMMENT '客户分类',
  `eno` varchar(10) DEFAULT '' COMMENT '所属工号',
  `iskey` int(11) DEFAULT 0 COMMENT '是否重点',
  `visit_date` int(11) DEFAULT '0' COMMENT '到访时间',
  `abandon_reason` varchar(200) DEFAULT '' COMMENT '放弃原因',
  `assign_eno` varchar(10) DEFAULT '' COMMENT '分配人',
  `assign_time` int(11) DEFAULT 0 COMMENT '分配时间',
  `next_time` int(11) DEFAULT 0 COMMENT '下次联系时间',
  `last_time` int(11) default 0 COMMENT '最后联系时间',
  `memo` varchar(100) DEFAULT '' COMMENT '备注',
  `status` int(11) DEFAULT '0' COMMENT '状态',
  `create_time` int(11) NOT NULL default 0 COMMENT '创建时间',
  `update_time` int(11) NOT NULL default 0 COMMENT '修改时间',
  `creator` int(11) NOT NULL default 0 COMMENT '创建人',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `c_cust_convt_detail`;
CREATE TABLE `c_cust_convt_detail` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `lib_type` int(11) NOT NULL default 0 COMMENT '库类型',
  `cust_id` int(11) NOT NULL default 0 COMMENT '客户id',
  `cust_type_1` int(11) NOT NULL default 0 COMMENT '原始类别',
  `cust_type_2` int(11) NOT NULL default 0 COMMENT '转换类别',
  `convt_time` int(11) NOT NULL default 0 COMMENT '转换时间',
  `user_id` int(11) NOT NULL default 0 COMMENT '操作人',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `c_note_info`;
CREATE TABLE `c_note_info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `cust_id` int(11) NOT NULL COMMENT '客户id',
  `cust_info` varchar(1000) DEFAULT '' COMMENT '客户情况',
  `requirement` varchar(1000) DEFAULT '' COMMENT '挖需求',
  `service` varchar(1000) DEFAULT '' COMMENT '介绍服务',
  `dissent` varchar(1000) DEFAULT '' COMMENT '异议处理',
  `next_followup` varchar(1000) DEFAULT '' COMMENT '下次跟进处理',
  `memo` varchar(1000) DEFAULT '' COMMENT '备注',
  `isvalid` tinyint(1) DEFAULT 0 COMMENT '是否有效',
  `iskey` tinyint(1) DEFAULT 0 COMMENT '是否重点',
  `next_contact` int(11) DEFAULT 0 COMMENT '下次联系时间',
  `dial_id` int(11) DEFAULT '0' COMMENT '电话拔打记录',
  `message_id` int(11) default '0' COMMENT '短信发送记录',
  `eno` int(11) NOT NULL default 0 COMMENT '工号',
  `cust_type` varchar(5) NOT NULL default '' COMMENT '客户分类',
  `lib_type` int NOT NULL default 0 COMMENT '库类型',
  `create_time` int(11) NOT NULL default 0 COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `c_dial_detail`;
CREATE TABLE `c_dial_detail` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `eno` varchar(10) NOT NULL default '' COMMENT '工号',
  `cust_id` int NOT NULL default 0 COMMENT '客户id',
  `extend_no` varchar(10) NOT NULL default '' COMMENT '客户id',
  `phone` varchar(20) NOT NULL default '' COMMENT '电话',
  `dial_time` int(11) NOT NULL default 0 COMMENT '拔打时间',
  `dial_long` float NOT NULL default 0 COMMENT '拔打时长',
  `dial_num` int(11) NOT NULL DEFAULT '1' COMMENT '拔打次数',
  `record_path` varchar(200) DEFAULT '' COMMENT '录音路径',
  `isok` int(11) DEFAULT '0' COMMENT '是否成功',
  `uid` varchar(20) NOT NULL default '' COMMENT '接口id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `c_dic`;
CREATE TABLE `c_dic` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `code` varchar(10) NOT NULL default '' COMMENT '编号',
  `name` varchar(100) NOT NULL default '' COMMENT '名称',
  `ctype` varchar(20) NOT NULL default '' COMMENT '类型',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `c_finance`;
CREATE TABLE `c_finance` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `cust_id` int(11) NOT NULL default 0 COMMENT '客户id',
  `sale_user` int(11) NOT NULL default 0 COMMENT '销售人员',
  `trans_user` int(11) NOT NULL default 0 COMMENT '谈单师',
  `acct_number` int(11) NOT NULL default 0 COMMENT '到账单数',
  `acct_amount` float NOT NULL default 0.0 COMMENT '到账金额',
  `acct_time` int(11) NOT NULL default 0 COMMENT '到账时间',
  `creator` int(11) NOT NULL default 0 COMMENT '创建人',
  `create_time` int(11) NOT NULL default 0 COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `c_trans_cust_info`;
CREATE TABLE `c_trans_cust_info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `cust_id` int(11) NOT NULL COMMENT '客户id',
  `cust_type` int(11) NOT NULL default 0 COMMENT '客户分类',
  `eno` varchar(10) NOT NULL default '' COMMENT '所属工号',
  `assign_eno` varchar(10) NOT NULL default '' COMMENT '分配人',
  `assign_time` int(11) NOT NULL default 0 COMMENT '分配时间',
  `next_time` int(11) NOT NULL default 0 COMMENT '下次联系时间',
  `memo` varchar(200) default '' COMMENT '备注',
  `creator` int(11) NOT NULL default 0 COMMENT '创建人',
  `create_time` int(11) NOT NULL default 0 COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `c_aftermarket_cust_info`;
CREATE TABLE `c_aftermarket_cust_info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `cust_id` int(11) NOT NULL COMMENT '客户id',
  `cust_type` int(11) NOT NULL default 0 COMMENT '客户分类',
  `webchat` varchar(20) default '' COMMENT '微信',
  `ww` varchar(20) default '' COMMENT '旺旺',
  `eno` varchar(10) default '' COMMENT '所属工号',
  `assign_eno` varchar(10) NOT NULL default '' COMMENT '分配人',
  `assign_time` int(11) NOT NULL default 0 COMMENT '分配时间',
  `next_time` int(11) NOT NULL default 0 COMMENT '下次联系时间',
  `memo` varchar(200) default '' COMMENT '备注',
  `creator` int(11) NOT NULL default 0 COMMENT '创建人',
  `create_time` int(11) NOT NULL default 0 COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `c_contract_info`;
CREATE TABLE `c_contract_info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `cust_id` int(11) NOT NULL COMMENT '客户id',
  `service_limit` varchar(10) NOT NULL default '' COMMENT '服务期限',
  `total_money` int(11) NOT NULL default 0 COMMENT '合同总金额',
  `pay_type` int(11) NOT NULL default 0 COMMENT '支付方式',
  `pay_time` int(11) NOT NULL default 0 COMMENT '支付时间',
  `promise` varchar(200) NOT NULL default '' COMMENT '合同承诺',
  `first_pay` varchar(10) NOT NULL default '' COMMENT '第一次支付金额',
  `second_pay` varchar(10) NOT NULL default '' COMMENT '第二次支付金额',
  `third_pay` varchar(10) NOT NULL default '' COMMENT '第三次支付金额',
  `fourth_pay` int(11) NOT NULL default 0 COMMENT '第四次支付金额',
  `comm_royalty` int(11) NOT NULL default 0 COMMENT '佣金提成',
  `comm_pay_time` int(11) NOT NULL default 0 COMMENT '佣金支付时间',
  `creator` int(11) NOT NULL default 0 COMMENT '创建人',
  `create_time` int(11) NOT NULL default 0 COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `c_black_info`;
CREATE TABLE `c_black_info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `cust_id` int(11) NOT NULL COMMENT '客户id',
  `lib_type` int(11) NOT NULL default 0 COMMENT '来源库',
  `old_cust_type` int(11) NOT NULL default 0 COMMENT '原客户分类',
  `create_time` int(11) NOT NULL default 0 COMMENT '创建时间',
  `creator` int(11) NOT NULL default 0 COMMENT '创建人',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `c_message`;
CREATE TABLE `c_message` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `cust_id` int(11) NOT NULL default 0 COMMENT '客户id',
  `phone` varchar(20) NOT NULL default '' COMMENT '电话号码',
  `content` varchar(200) NOT NULL default '' COMMENT '短信内容',
  `status` int not null default 0 COMMENT '发送状态',
  `memo` varchar(200) not null default '' COMMENT '结果描述',
  `create_time` int(11) NOT NULL default 0 COMMENT '创建时间',
  `creator` int(11) NOT NULL default 0 COMMENT '创建人',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table `c_tip_info` (
  `id` int(11) not null comment '客户id',
  `eno` varchar(10) not null comment '所属工号'
) engine=innodb default charset=utf8;

CREATE TABLE c_note_template(
  `id` TINYINT UNSIGNED AUTO_INCREMENT ,
  `tname` VARCHAR(25) NOT NULL COMMENT '短信模板名称',
  `content` VARCHAR(200) NOT NULL COMMENT '短信内容',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `c_dial_detail_p` ( 
  `uid` varchar(20) NOT NULL DEFAULT '' COMMENT '接口id',
  `userid` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `cust_id` int(11) NOT NULL DEFAULT '0' COMMENT '客户id',
  `extend_no` varchar(10) NOT NULL DEFAULT '' COMMENT '分机号',
  `phone` varchar(20) NOT NULL DEFAULT '' COMMENT '电话',
  `dial_time` int(11) NOT NULL DEFAULT '0' COMMENT '拔打时间',
  `dial_long` int(11) NOT NULL DEFAULT '0' COMMENT '拔打时长', 
  `record_path` varchar(200) DEFAULT '' COMMENT '录音路径',  
  KEY `idx_dialdetailp_01` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8
/*!50100 PARTITION BY RANGE (dial_time)
(PARTITION p0 VALUES LESS THAN (UNIX_TIMESTAMP('2015-12-31 23:59:59')) ENGINE = MyISAM,
 PARTITION p1 VALUES LESS THAN (UNIX_TIMESTAMP('2016-12-31 23:59:59')) ENGINE = MyISAM,
 PARTITION p2 VALUES LESS THAN (UNIX_TIMESTAMP('2017-12-31 23:59:59')) ENGINE = MyISAM,
 PARTITION p3 VALUES LESS THAN MAXVALUE ENGINE = MyISAM) */; 
 
 
CREATE TABLE `c_sync_conf` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `sync_date` datetime NULL COMMENT '同步日期',
  `table` varchar(20) NULL COMMENT '同步表',
  `status` int DEFAULT 0 COMMENT '是否同步',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='同步跟踪表';

 CREATE TABLE `c_note_info_p` (
  `id` int(10) COMMENT '主键',
  `cust_id` int(11) NOT NULL COMMENT '客户id',  
  `isvalid` tinyint(1) DEFAULT '0' COMMENT '是否有效',
  `iskey` tinyint(1) DEFAULT '0' COMMENT '是否重点',
  `next_contact` int(11) DEFAULT '0' COMMENT '下次联系时间',
  `dial_id` int(11) DEFAULT '0' COMMENT '电话拔打记录',
  `message_id` int(11) NOT NULL DEFAULT '0',
  `userid` int(11) NOT NULL DEFAULT '0' COMMENT '用户id', 
  `lib_type` int(11) NOT NULL DEFAULT '0' COMMENT '库类型',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `cust_type` varchar(5) NOT NULL DEFAULT '' COMMENT '客户分类',
  `memo` varchar(2000) DEFAULT '' COMMENT '备注',
  KEY `idx_noteinfop_01` (`id`) USING BTREE,
  KEY `idx_noteinfop_02` (`cust_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8
/*!50100 PARTITION BY RANGE (id)
(PARTITION p0 VALUES LESS THAN (1000000) ENGINE = InnoDB,
 PARTITION p1 VALUES LESS THAN (2000000) ENGINE = InnoDB,
 PARTITION p2 VALUES LESS THAN (3000000) ENGINE = InnoDB,
 PARTITION p3 VALUES LESS THAN MAXVALUE ENGINE = InnoDB) */;

 CREATE TABLE `c_seq_note_id` (
  `seq` int(10) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

insert into c_note_info_p select id,cust_id,isvalid,iskey,next_contact,dial_id,message_id,eno,lib_type,create_time,cust_type,
  concat(cust_info,requirement,service,dissent,next_followup,memo) from c_note_info ;

insert into `c_seq_note_id` select max(id) from c_note_info;

create unique index idx_black_info_01 on c_black_info(cust_id);
create index idx_customerinfo_01 on c_customer_info(eno);
create index idx_dialdetail_01 on c_dial_detail(cust_id);
create index idx_dialdetail_02 on c_dial_detail(eno);
create index idx_dialdetail_03 on c_dial_detail(uid);

 