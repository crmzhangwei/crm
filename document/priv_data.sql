INSERT INTO `c_users` VALUES 
(1,'U00005','a722c63db8ec8625af6cf71cb8c2d939','admin','admin',0,1,'12314141234','2561582',1,1,1,1,1,0,0,123,0),
(2,'U00006','a722c63db8ec8625af6cf71cb8c2d939','test2','test2',0,1,'12314141234','2561582',1,2,1,1,1,0,0,1,1),
(3,'U00001','a722c63db8ec8625af6cf71cb8c2d939','test1','test1',0,1,'13536580110','123123123',1,1,0,2,1,0,0,0,0),
(4,'U00011','a722c63db8ec8625af6cf71cb8c2d939','test10','test10',0,1,'12314141234','2561582',1,3,1,1,1,0,0,1,1),
(5,'U00012','a722c63db8ec8625af6cf71cb8c2d939','test11','test11',0,1,'12314141234','2561582',1,1,1,2,1,0,0,1,1),
(6,'U00007','a722c63db8ec8625af6cf71cb8c2d939','test3','test3',0,1,'12314141234','2561582',1,2,1,1,1,0,0,1,1),
(7,'U00002','a722c63db8ec8625af6cf71cb8c2d939','test4','test4',0,2,'12314141234','2561582',1,3,1,1,1,0,0,1,1),
(8,'U00003','a722c63db8ec8625af6cf71cb8c2d939','test5','test5',0,1,'12314141234','2561582',1,1,1,2,1,0,0,1,1),
(9,'U00004','a722c63db8ec8625af6cf71cb8c2d939','test6','test6',0,1,'12314141234','2561582',1,2,1,1,1,0,0,1,1),
(10,'U00008','a722c63db8ec8625af6cf71cb8c2d939','test7','test7',0,1,'12314141234','2561582',1,3,1,2,1,0,0,1,1),
(11,'U00009','a722c63db8ec8625af6cf71cb8c2d939','test8','test8',0,1,'12314141234','2561582',1,1,1,2,1,0,0,1,1),
(12,'U00010','a722c63db8ec8625af6cf71cb8c2d939','test9','test9',0,1,'12314141234','2561582',1,1,1,1,1,0,0,1,1);

INSERT INTO `c_dept_info` VALUES ('1', '销售一部');
INSERT INTO `c_dept_info` VALUES ('2', '销售二部');
INSERT INTO `c_dept_info` VALUES ('4', '销售三部');
INSERT INTO `c_dept_info` VALUES ('5', '售后一部');
INSERT INTO `c_dept_info` VALUES ('6', '售后二部');

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

INSERT INTO `c_group_info` VALUES ('1', '飞虎组');
INSERT INTO `c_group_info` VALUES ('2', '大地组');
INSERT INTO `c_group_info` VALUES ('3', '大海组');
INSERT INTO `c_group_info` VALUES ('4', '野狼组');
INSERT INTO `c_group_info` VALUES ('5', '红梅组');
INSERT INTO `c_group_info` VALUES ('6', '黄菊组');
INSERT INTO `c_group_info` VALUES ('7', '青兰组');
INSERT INTO `c_group_info` VALUES ('8', '绿竹组');

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

INSERT INTO `c_role_info` VALUES ('1', '客服人员');
INSERT INTO `c_role_info` VALUES ('2', '业务员');
INSERT INTO `c_role_info` VALUES ('4', '财务人员');
INSERT INTO `c_role_info` VALUES ('5', '部门主管');

INSERT INTO `c_user_role` VALUES ('1', '1', '1');
INSERT INTO `c_user_role` VALUES ('2', '3', '1');
INSERT INTO `c_user_role` VALUES ('3', '3', '2');
INSERT INTO `c_user_role` VALUES ('4', '4', '1');
INSERT INTO `c_user_role` VALUES ('6', '4', '4');
INSERT INTO `c_user_role` VALUES ('7', '5', '1');
INSERT INTO `c_user_role` VALUES ('8', '5', '2');
INSERT INTO `c_user_role` VALUES ('9', '5', '4');
INSERT INTO `c_user_role` VALUES ('10', '1', '5');