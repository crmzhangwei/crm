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
  `extend_no` int NOT NULL DEFAULT 0 COMMENT '分机号',
  `create_time` int NOT NULL COMMENT '创建时间',
  `login_time` int NOT NULL COMMENT '最后登录时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `c_dept_group`;
CREATE TABLE `c_dept_group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `dept_id` int(11) DEFAULT NULL COMMENT '部门id',
  `group_id` int(11) DEFAULT NULL COMMENT '组别id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of c_dept_group
-- ----------------------------
INSERT INTO `c_dept_group` VALUES ('1', '1', '2');
INSERT INTO `c_dept_group` VALUES ('2', '1', '4');
INSERT INTO `c_dept_group` VALUES ('3', '2', '1');
INSERT INTO `c_dept_group` VALUES ('4', '2', '2');
INSERT INTO `c_dept_group` VALUES ('5', '2', '4');
INSERT INTO `c_dept_group` VALUES ('6', '4', '1');
INSERT INTO `c_dept_group` VALUES ('7', '5', '6');
INSERT INTO `c_dept_group` VALUES ('8', '5', '7');
INSERT INTO `c_dept_group` VALUES ('9', '6', '7');
INSERT INTO `c_dept_group` VALUES ('10', '6', '8');

-- ----------------------------
-- Table structure for c_dept_info
-- ----------------------------
DROP TABLE IF EXISTS `c_dept_info`;
CREATE TABLE `c_dept_info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(100) NOT NULL DEFAULT '' COMMENT '部门名称',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of c_dept_info
-- ----------------------------
INSERT INTO `c_dept_info` VALUES ('1', '销售一部');
INSERT INTO `c_dept_info` VALUES ('2', '销售二部');
INSERT INTO `c_dept_info` VALUES ('4', '销售三部');
INSERT INTO `c_dept_info` VALUES ('5', '售后一部');
INSERT INTO `c_dept_info` VALUES ('6', '售后二部');

-- ----------------------------
-- Table structure for c_group_info
-- ----------------------------
DROP TABLE IF EXISTS `c_group_info`;
CREATE TABLE `c_group_info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(100) NOT NULL DEFAULT '' COMMENT '组名',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of c_group_info
-- ----------------------------
INSERT INTO `c_group_info` VALUES ('1', '飞虎组');
INSERT INTO `c_group_info` VALUES ('2', '大地组');
INSERT INTO `c_group_info` VALUES ('4', '野狼组');
INSERT INTO `c_group_info` VALUES ('5', '红梅组');
INSERT INTO `c_group_info` VALUES ('6', '黄菊组');
INSERT INTO `c_group_info` VALUES ('7', '青兰组');
INSERT INTO `c_group_info` VALUES ('8', '绿竹组');

-- ----------------------------
-- Table structure for c_menu_info
-- ----------------------------
DROP TABLE IF EXISTS `c_menu_info`;
CREATE TABLE `c_menu_info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(100) NOT NULL COMMENT '资源名称',
  `url` varchar(100) NOT NULL COMMENT '资源url',
  `parent_id` int(11) DEFAULT NULL COMMENT '上级资源id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of c_menu_info
-- ----------------------------
INSERT INTO `c_menu_info` VALUES ('1', '权限管理', '/User/', '0');
INSERT INTO `c_menu_info` VALUES ('2', '用户管理', '/User/users/admin', '1');
INSERT INTO `c_menu_info` VALUES ('3', '部门管理', '/User/deptinfo/admin', '1');
INSERT INTO `c_menu_info` VALUES ('5', '组别管理', '/User/groupinfo/admin', '1');
INSERT INTO `c_menu_info` VALUES ('6', '部门组别管理', '/User/deptgroup/admin', '1');
INSERT INTO `c_menu_info` VALUES ('7', '菜单资源管理', '/User/menuinfo/admin', '1');
INSERT INTO `c_menu_info` VALUES ('8', '角色管理', '/User/roleinfo/admin', '1');
INSERT INTO `c_menu_info` VALUES ('9', '权限配置', '/User/privilege/admin', '1');
INSERT INTO `c_menu_info` VALUES ('10', '财务数据', '/Finance/', '0');
INSERT INTO `c_menu_info` VALUES ('11', '财务数据录入', '/Finance/finance/create', '10');
INSERT INTO `c_menu_info` VALUES ('12', '财务数据查询', '/Finance/finance/admin', '10');
INSERT INTO `c_menu_info` VALUES ('13', '售后管理', '/Service/', '0');
INSERT INTO `c_menu_info` VALUES ('14', '新分客户', '/Service/service/newList', '13');
INSERT INTO `c_menu_info` VALUES ('15', '今日联系', '/Service/service/todayList', '13');
INSERT INTO `c_menu_info` VALUES ('16', '遗留数据', '/Service/service/oldList', '13');
INSERT INTO `c_menu_info` VALUES ('17', '查询分配', '/Service/service/admin', '13');
INSERT INTO `c_menu_info` VALUES ('18', '客户管理', '/Custom/', '0');
INSERT INTO `c_menu_info` VALUES ('19', '查询分配', '/Customer/customerinfo/admin', '18');
INSERT INTO `c_menu_info` VALUES ('20', '客户资源分配', '/Customer/customerass/admin', '18');
INSERT INTO `c_menu_info` VALUES ('21', '公海资源', '/Customer/customerblack/admin', '18');
INSERT INTO `c_menu_info` VALUES ('22', '机会管理', '/Chance/', '0');
INSERT INTO `c_menu_info` VALUES ('23', '安排联系机会', '/Chance/customerinfo/admin', '22');
INSERT INTO `c_menu_info` VALUES ('24', '我的机会', '/Chance/customerinfo/todaylist', '22');
INSERT INTO `c_menu_info` VALUES ('25', '未联系机会', '/Chance/customerinfo/oldList', '22');
INSERT INTO `c_menu_info` VALUES ('26', '基础数据管理', '/Custtype/', '0');
INSERT INTO `c_menu_info` VALUES ('27', '客户分类', '/Custtype/custtype/admin', '26');
INSERT INTO `c_menu_info` VALUES ('28', '字典数据', '/Dictionary/dic/admin', '26');
INSERT INTO `c_menu_info` VALUES ('29', '人员角色管理', '/User/userrole/admin', '1');

-- ----------------------------
-- Table structure for c_privilege
-- ----------------------------
DROP TABLE IF EXISTS `c_privilege`;
CREATE TABLE `c_privilege` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `menu_id` int(11) NOT NULL COMMENT '资源id',
  `role_id` int(11) NOT NULL COMMENT '角色id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of c_privilege
-- ----------------------------
INSERT INTO `c_privilege` VALUES ('3', '2', '1');
INSERT INTO `c_privilege` VALUES ('15', '7', '1');
INSERT INTO `c_privilege` VALUES ('16', '8', '1');
INSERT INTO `c_privilege` VALUES ('17', '9', '1');
INSERT INTO `c_privilege` VALUES ('18', '10', '1');
INSERT INTO `c_privilege` VALUES ('19', '11', '1');
INSERT INTO `c_privilege` VALUES ('20', '12', '1');
INSERT INTO `c_privilege` VALUES ('21', '13', '1');
INSERT INTO `c_privilege` VALUES ('22', '14', '1');
INSERT INTO `c_privilege` VALUES ('23', '15', '1');
INSERT INTO `c_privilege` VALUES ('24', '16', '1');
INSERT INTO `c_privilege` VALUES ('25', '17', '1');
INSERT INTO `c_privilege` VALUES ('30', '3', '1');
INSERT INTO `c_privilege` VALUES ('31', '5', '1');
INSERT INTO `c_privilege` VALUES ('34', '2', '2');
INSERT INTO `c_privilege` VALUES ('35', '7', '2');
INSERT INTO `c_privilege` VALUES ('36', '8', '2');
INSERT INTO `c_privilege` VALUES ('37', '9', '2');
INSERT INTO `c_privilege` VALUES ('38', '10', '2');
INSERT INTO `c_privilege` VALUES ('39', '11', '2');
INSERT INTO `c_privilege` VALUES ('40', '12', '2');
INSERT INTO `c_privilege` VALUES ('41', '13', '2');
INSERT INTO `c_privilege` VALUES ('42', '14', '2');
INSERT INTO `c_privilege` VALUES ('43', '15', '2');
INSERT INTO `c_privilege` VALUES ('44', '16', '2');
INSERT INTO `c_privilege` VALUES ('45', '17', '2');
INSERT INTO `c_privilege` VALUES ('46', '3', '2');
INSERT INTO `c_privilege` VALUES ('47', '5', '2');
INSERT INTO `c_privilege` VALUES ('48', '6', '2');
INSERT INTO `c_privilege` VALUES ('49', '1', '2');
INSERT INTO `c_privilege` VALUES ('50', '18', '2');
INSERT INTO `c_privilege` VALUES ('51', '19', '2');
INSERT INTO `c_privilege` VALUES ('52', '20', '2');
INSERT INTO `c_privilege` VALUES ('53', '21', '2');
INSERT INTO `c_privilege` VALUES ('54', '22', '2');
INSERT INTO `c_privilege` VALUES ('55', '23', '2');
INSERT INTO `c_privilege` VALUES ('56', '24', '2');
INSERT INTO `c_privilege` VALUES ('57', '25', '2');
INSERT INTO `c_privilege` VALUES ('58', '10', '4');
INSERT INTO `c_privilege` VALUES ('59', '11', '4');
INSERT INTO `c_privilege` VALUES ('60', '12', '4');
INSERT INTO `c_privilege` VALUES ('61', '1', '5');
INSERT INTO `c_privilege` VALUES ('62', '2', '5');
INSERT INTO `c_privilege` VALUES ('63', '3', '5');
INSERT INTO `c_privilege` VALUES ('64', '5', '5');
INSERT INTO `c_privilege` VALUES ('65', '6', '5');
INSERT INTO `c_privilege` VALUES ('66', '7', '5');
INSERT INTO `c_privilege` VALUES ('67', '8', '5');
INSERT INTO `c_privilege` VALUES ('68', '9', '5');
INSERT INTO `c_privilege` VALUES ('69', '10', '5');
INSERT INTO `c_privilege` VALUES ('70', '11', '5');
INSERT INTO `c_privilege` VALUES ('71', '12', '5');
INSERT INTO `c_privilege` VALUES ('72', '13', '5');
INSERT INTO `c_privilege` VALUES ('73', '14', '5');
INSERT INTO `c_privilege` VALUES ('74', '15', '5');
INSERT INTO `c_privilege` VALUES ('75', '16', '5');
INSERT INTO `c_privilege` VALUES ('76', '17', '5');
INSERT INTO `c_privilege` VALUES ('77', '18', '5');
INSERT INTO `c_privilege` VALUES ('78', '19', '5');
INSERT INTO `c_privilege` VALUES ('79', '20', '5');
INSERT INTO `c_privilege` VALUES ('80', '21', '5');
INSERT INTO `c_privilege` VALUES ('81', '22', '5');
INSERT INTO `c_privilege` VALUES ('82', '23', '5');
INSERT INTO `c_privilege` VALUES ('83', '24', '5');
INSERT INTO `c_privilege` VALUES ('84', '25', '5');
INSERT INTO `c_privilege` VALUES ('85', '26', '5');
INSERT INTO `c_privilege` VALUES ('86', '27', '5');
INSERT INTO `c_privilege` VALUES ('87', '28', '5');
INSERT INTO `c_privilege` VALUES ('88', '29', '5');

-- ----------------------------
-- Table structure for c_role_info
-- ----------------------------
DROP TABLE IF EXISTS `c_role_info`;
CREATE TABLE `c_role_info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(100) DEFAULT NULL COMMENT '角色名称',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of c_role_info
-- ----------------------------
INSERT INTO `c_role_info` VALUES ('1', '客服人员');
INSERT INTO `c_role_info` VALUES ('2', '业务员');
INSERT INTO `c_role_info` VALUES ('4', '财务人员');
INSERT INTO `c_role_info` VALUES ('5', '部门主管');

-- ----------------------------
-- Table structure for c_user_role
-- ----------------------------
DROP TABLE IF EXISTS `c_user_role`;
CREATE TABLE `c_user_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `user_id` int(11) NOT NULL COMMENT '用户id',
  `role_id` int(11) NOT NULL COMMENT '角色id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of c_user_role
-- ----------------------------
INSERT INTO `c_user_role` VALUES ('1', '1', '1');
INSERT INTO `c_user_role` VALUES ('2', '3', '1');
INSERT INTO `c_user_role` VALUES ('3', '3', '2');
INSERT INTO `c_user_role` VALUES ('4', '4', '1');
INSERT INTO `c_user_role` VALUES ('6', '4', '4');
INSERT INTO `c_user_role` VALUES ('7', '5', '1');
INSERT INTO `c_user_role` VALUES ('8', '5', '2');
INSERT INTO `c_user_role` VALUES ('9', '5', '4');
INSERT INTO `c_user_role` VALUES ('10', '1', '5');


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
  `eno` varchar(10) NULL COMMENT '所属工号',
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
  `eno` varchar(10) NULL COMMENT '所属工号',
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
  `old_cust_type` int NOT NULL COMMENT '原客户分类', 
  `create_time` int NOT NULL COMMENT '创建时间',
  `creator` int NOT NULL COMMENT '创建人',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `c_message` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键', 
  `cust_id` int NOT NULL COMMENT '客户id',
  `phone` varchar(20) NOT NULL COMMENT '电话号码',
  `content` varchar(200) NOT NULL COMMENT '短信内容', 
  `create_time` int NOT NULL COMMENT '创建时间',
  `creator` int NOT NULL COMMENT '创建人',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;