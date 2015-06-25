/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50612
Source Host           : localhost:3306
Source Database       : crm

Target Server Type    : MYSQL
Target Server Version : 50612
File Encoding         : 65001

Date: 2015-06-26 01:22:10
*/

SET FOREIGN_KEY_CHECKS=0;

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
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

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
INSERT INTO `c_menu_info` VALUES ('30', '分机号管理', '/User/extnumber/admin', '1');
INSERT INTO `c_menu_info` VALUES ('31', '成交师机会管理', '/TransChance/customerinfo/admin', '0');
INSERT INTO `c_menu_info` VALUES ('32', '安排联系机会', '/TransChance/customerinfo/admin', '31');
INSERT INTO `c_menu_info` VALUES ('33', '我的机会', '/TransChance/customerinfo/todaylist', '31');
INSERT INTO `c_menu_info` VALUES ('34', '我的机会', '/TransChance/customerinfo/oldList', '31');
