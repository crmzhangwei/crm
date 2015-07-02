-- MySQL dump 10.13  Distrib 5.6.25, for Win64 (x86_64)
--
-- Host: localhost    Database: crm
-- ------------------------------------------------------
-- Server version	5.6.25

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `c_aftermarket_cust_info`
--

DROP TABLE IF EXISTS `c_aftermarket_cust_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `c_aftermarket_cust_info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `cust_id` int(11) NOT NULL COMMENT '客户id',
  `cust_type` int(11) NOT NULL DEFAULT '0' COMMENT '客户分类',
  `webchat` varchar(20) DEFAULT '' COMMENT '微信',
  `ww` varchar(20) DEFAULT '' COMMENT '旺旺',
  `eno` varchar(10) DEFAULT '' COMMENT '所属工号',
  `assign_eno` varchar(10) NOT NULL DEFAULT '' COMMENT '分配人',
  `assign_time` int(11) NOT NULL DEFAULT '0' COMMENT '分配时间',
  `next_time` int(11) NOT NULL DEFAULT '0' COMMENT '下次联系时间',
  `memo` varchar(200) DEFAULT '' COMMENT '备注',
  `creator` int(11) NOT NULL DEFAULT '0' COMMENT '创建人',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `c_aftermarket_cust_info`
--

LOCK TABLES `c_aftermarket_cust_info` WRITE;
/*!40000 ALTER TABLE `c_aftermarket_cust_info` DISABLE KEYS */;
/*!40000 ALTER TABLE `c_aftermarket_cust_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `c_black_info`
--

DROP TABLE IF EXISTS `c_black_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `c_black_info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `cust_id` int(11) NOT NULL COMMENT '客户id',
  `lib_type` int(11) NOT NULL DEFAULT '0' COMMENT '来源库',
  `old_cust_type` int(11) NOT NULL DEFAULT '0' COMMENT '原客户分类',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `creator` int(11) NOT NULL DEFAULT '0' COMMENT '创建人',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `c_black_info`
--

LOCK TABLES `c_black_info` WRITE;
/*!40000 ALTER TABLE `c_black_info` DISABLE KEYS */;
/*!40000 ALTER TABLE `c_black_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `c_contract_info`
--

DROP TABLE IF EXISTS `c_contract_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `c_contract_info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `cust_id` int(11) NOT NULL COMMENT '客户id',
  `service_limit` varchar(10) NOT NULL DEFAULT '' COMMENT '服务期限',
  `total_money` int(11) NOT NULL DEFAULT '0' COMMENT '合同总金额',
  `pay_type` int(11) NOT NULL DEFAULT '0' COMMENT '支付方式',
  `pay_time` int(11) NOT NULL DEFAULT '0' COMMENT '支付时间',
  `promise` varchar(200) NOT NULL DEFAULT '' COMMENT '合同承诺',
  `first_pay` varchar(10) NOT NULL DEFAULT '' COMMENT '第一次支付金额',
  `second_pay` varchar(10) NOT NULL DEFAULT '' COMMENT '第二次支付金额',
  `third_pay` varchar(10) NOT NULL DEFAULT '' COMMENT '第三次支付金额',
  `fourth_pay` int(11) NOT NULL DEFAULT '0' COMMENT '第四次支付金额',
  `comm_royalty` int(11) NOT NULL DEFAULT '0' COMMENT '佣金提成',
  `comm_pay_time` int(11) NOT NULL DEFAULT '0' COMMENT '佣金支付时间',
  `creator` int(11) NOT NULL DEFAULT '0' COMMENT '创建人',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `c_contract_info`
--

LOCK TABLES `c_contract_info` WRITE;
/*!40000 ALTER TABLE `c_contract_info` DISABLE KEYS */;
/*!40000 ALTER TABLE `c_contract_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `c_cust_convt_detail`
--

DROP TABLE IF EXISTS `c_cust_convt_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `c_cust_convt_detail` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `lib_type` int(11) NOT NULL DEFAULT '0' COMMENT '库类型',
  `cust_id` int(11) NOT NULL DEFAULT '0' COMMENT '客户id',
  `cust_type_1` int(11) NOT NULL DEFAULT '0' COMMENT '原始类别',
  `cust_type_2` int(11) NOT NULL DEFAULT '0' COMMENT '转换类别',
  `convt_time` int(11) NOT NULL DEFAULT '0' COMMENT '转换时间',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '操作人',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `c_cust_convt_detail`
--

LOCK TABLES `c_cust_convt_detail` WRITE;
/*!40000 ALTER TABLE `c_cust_convt_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `c_cust_convt_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `c_cust_type`
--

DROP TABLE IF EXISTS `c_cust_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `c_cust_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `lib_type` int(11) NOT NULL DEFAULT '0' COMMENT '库类型',
  `type_no` varchar(5) NOT NULL DEFAULT '' COMMENT '类型编号',
  `type_name` varchar(100) NOT NULL DEFAULT '' COMMENT '类型名称',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `c_cust_type`
--

LOCK TABLES `c_cust_type` WRITE;
/*!40000 ALTER TABLE `c_cust_type` DISABLE KEYS */;
INSERT INTO `c_cust_type` VALUES (1,1,'0','新分资源，未接通'),(2,1,'1','未深入联系的'),(3,1,'2','有需求，了解服务'),(4,1,'3','认可服务，认可价格，有异议'),(5,1,'4','已邀约成功，未确定时间（1个星期）'),(6,1,'5','确认到店，3天内'),(7,1,'6','已到店'),(8,1,'7','已签合同或已交订金'),(9,1,'8','毁约客户'),(10,2,'10','新分资源'),(11,2,'11','电销需帮助的客户'),(12,2,'12','意向不大，需跟进'),(13,2,'13','有意向，需培养'),(14,2,'14','认可服务，有异议'),(15,2,'15','已签合同或已交订金'),(16,2,'16','毁约客户'),(17,2,'17','成交客户'),(18,3,'0','新分'),(19,3,'1','待定'),(20,3,'2','待定'),(21,3,'3','待定'),(22,3,'4','续费会员'),(23,3,'5','佣金支付'),(24,3,'6','投诉会员'),(25,3,'7','成交放弃会员'),(26,1,'9','放入公海'),(27,2,'18','公海资源'),(28,3,'8','公海资源');
/*!40000 ALTER TABLE `c_cust_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `c_customer_info`
--

DROP TABLE IF EXISTS `c_customer_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `c_customer_info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `cust_name` varchar(100) DEFAULT '' COMMENT '客户名称',
  `shop_name` varchar(100) DEFAULT '' COMMENT '店铺名称',
  `corp_name` varchar(100) DEFAULT '' COMMENT '公司名称',
  `shop_url` varchar(100) DEFAULT '' COMMENT '店铺网址',
  `shop_addr` varchar(100) DEFAULT '' COMMENT '店铺地址',
  `phone` varchar(20) DEFAULT '' COMMENT '电话',
  `qq` varchar(20) DEFAULT '' COMMENT 'QQ',
  `mail` varchar(50) DEFAULT '' COMMENT '邮箱',
  `datafrom` varchar(100) DEFAULT '' COMMENT '数据来源',
  `category` int(11) DEFAULT '0' COMMENT '所属类目',
  `cust_type` int(11) DEFAULT '0' COMMENT '客户分类',
  `eno` varchar(10) DEFAULT '' COMMENT '所属工号',
  `iskey` int(11) DEFAULT '0' COMMENT '是否重点',
  `visit_date` int(11) DEFAULT '0' COMMENT '到访时间',
  `abandon_reason` varchar(200) DEFAULT '' COMMENT '放弃原因',
  `assign_eno` varchar(10) DEFAULT '' COMMENT '分配人',
  `assign_time` int(11) DEFAULT '0' COMMENT '分配时间',
  `next_time` int(11) DEFAULT '0' COMMENT '下次联系时间',
  `last_time` int(11) NOT NULL DEFAULT '0',
  `memo` varchar(100) DEFAULT '' COMMENT '备注',
  `status` int(11) DEFAULT '0' COMMENT '状态',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `creator` int(11) NOT NULL DEFAULT '0' COMMENT '创建人',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `c_customer_info`
--

LOCK TABLES `c_customer_info` WRITE;
/*!40000 ALTER TABLE `c_customer_info` DISABLE KEYS */;
/*!40000 ALTER TABLE `c_customer_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `c_dept_group`
--

DROP TABLE IF EXISTS `c_dept_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `c_dept_group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `dept_id` int(11) DEFAULT '0' COMMENT '部门id',
  `group_id` int(11) DEFAULT '0' COMMENT '组别id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `c_dept_group`
--

LOCK TABLES `c_dept_group` WRITE;
/*!40000 ALTER TABLE `c_dept_group` DISABLE KEYS */;
INSERT INTO `c_dept_group` VALUES (1,1,1);
/*!40000 ALTER TABLE `c_dept_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `c_dept_info`
--

DROP TABLE IF EXISTS `c_dept_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `c_dept_info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(100) NOT NULL DEFAULT '' COMMENT '部门名称',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `c_dept_info`
--

LOCK TABLES `c_dept_info` WRITE;
/*!40000 ALTER TABLE `c_dept_info` DISABLE KEYS */;
INSERT INTO `c_dept_info` VALUES (1,'公司总部');
/*!40000 ALTER TABLE `c_dept_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `c_dept_role`
--

DROP TABLE IF EXISTS `c_dept_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `c_dept_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `dept_id` int(11) NOT NULL COMMENT '部门id',
  `role_id` int(11) NOT NULL COMMENT '角色id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `c_dept_role`
--

LOCK TABLES `c_dept_role` WRITE;
/*!40000 ALTER TABLE `c_dept_role` DISABLE KEYS */;
/*!40000 ALTER TABLE `c_dept_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `c_dial_detail`
--

DROP TABLE IF EXISTS `c_dial_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `c_dial_detail` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `eno` varchar(10) NOT NULL DEFAULT '' COMMENT '工号',
  `cust_id` int(11) NOT NULL DEFAULT '0',
  `extend_no` varchar(10) NOT NULL DEFAULT '',
  `phone` varchar(20) NOT NULL DEFAULT '',
  `dial_time` int(11) NOT NULL DEFAULT '0' COMMENT '拔打时间',
  `dial_long` float NOT NULL DEFAULT '0' COMMENT '拔打时长',
  `dial_num` int(11) NOT NULL DEFAULT '1' COMMENT '拔打次数',
  `record_path` varchar(200) DEFAULT '' COMMENT '录音路径',
  `isok` int(11) DEFAULT '0' COMMENT '是否成功',
  `uid` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `c_dial_detail`
--

LOCK TABLES `c_dial_detail` WRITE;
/*!40000 ALTER TABLE `c_dial_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `c_dial_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `c_dic`
--

DROP TABLE IF EXISTS `c_dic`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `c_dic` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `code` varchar(10) NOT NULL DEFAULT '' COMMENT '编号',
  `name` varchar(100) NOT NULL DEFAULT '' COMMENT '名称',
  `ctype` varchar(20) NOT NULL DEFAULT '' COMMENT '类型',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `c_dic`
--

LOCK TABLES `c_dic` WRITE;
/*!40000 ALTER TABLE `c_dic` DISABLE KEYS */;
INSERT INTO `c_dic` VALUES (1,'1','销售库','lib_type'),(2,'2','成交师库','lib_type'),(3,'3','售后库','lib_type'),(4,'1','男','sex_type'),(5,'2','女','sex_type'),(6,'0','有效','user_status'),(7,'1','无效','user_status'),(8,'100','女装男装','cust_category'),(9,'101','鞋类箱包','cust_category'),(10,'102','内衣配饰','cust_category'),(11,'103','运动户外','cust_category'),(12,'104','珠宝手表','cust_category'),(13,'105','数码','cust_category'),(14,'106','家电办公','cust_category'),(15,'107','护肤彩妆','cust_category'),(16,'108','母婴用品','cust_category'),(17,'109','家居建材','cust_category'),(18,'110','美食特产','cust_category'),(19,'111','日用百货','cust_category'),(20,'112','汽车摩托','cust_category'),(21,'113','文化玩乐','cust_category'),(22,'114','虚拟','cust_category');
/*!40000 ALTER TABLE `c_dic` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `c_finance`
--

DROP TABLE IF EXISTS `c_finance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `c_finance` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `cust_id` int(11) NOT NULL DEFAULT '0' COMMENT '客户id',
  `sale_user` int(11) NOT NULL DEFAULT '0' COMMENT '销售人员',
  `trans_user` int(11) NOT NULL DEFAULT '0' COMMENT '谈单师',
  `acct_number` int(11) NOT NULL DEFAULT '0' COMMENT '到账单数',
  `acct_amount` float NOT NULL DEFAULT '0' COMMENT '到账金额',
  `acct_time` int(11) NOT NULL DEFAULT '0' COMMENT '到账时间',
  `creator` int(11) NOT NULL DEFAULT '0' COMMENT '创建人',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `c_finance`
--

LOCK TABLES `c_finance` WRITE;
/*!40000 ALTER TABLE `c_finance` DISABLE KEYS */;
/*!40000 ALTER TABLE `c_finance` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `c_group_info`
--

DROP TABLE IF EXISTS `c_group_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `c_group_info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(100) NOT NULL DEFAULT '' COMMENT '组名',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `c_group_info`
--

LOCK TABLES `c_group_info` WRITE;
/*!40000 ALTER TABLE `c_group_info` DISABLE KEYS */;
INSERT INTO `c_group_info` VALUES (1,'超级管理员');
/*!40000 ALTER TABLE `c_group_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `c_menu_info`
--

DROP TABLE IF EXISTS `c_menu_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `c_menu_info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(100) NOT NULL DEFAULT '' COMMENT '资源名称',
  `url` varchar(100) NOT NULL DEFAULT '' COMMENT '资源url',
  `parent_id` int(11) DEFAULT NULL COMMENT '上级资源id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `c_menu_info`
--

LOCK TABLES `c_menu_info` WRITE;
/*!40000 ALTER TABLE `c_menu_info` DISABLE KEYS */;
INSERT INTO `c_menu_info` VALUES (1,'权限管理','/User/',0),(2,'用户管理','/User/users/admin',1),(3,'部门管理','/User/deptinfo/admin',1),(5,'组别管理','/User/groupinfo/admin',1),(6,'部门组别管理','/User/deptgroup/admin',1),(7,'菜单资源管理','/User/menuinfo/admin',1),(8,'角色管理','/User/roleinfo/admin',1),(9,'权限配置','/User/privilege/admin',1),(10,'财务数据','/Finance/',0),(11,'财务数据录入','/Finance/finance/create',10),(12,'财务数据查询','/Finance/finance/admin',10),(13,'售后管理','/Service/',0),(14,'新分客户','/Service/new/list',13),(15,'今日联系','/Service/today/list',13),(16,'遗留数据','/Service/old/list',13),(17,'查询分配','/Service/service/admin',13),(18,'客户管理','/Custom/',0),(19,'查询分配','/Customer/customerinfo/admin',18),(20,'客户资源分配','/Customer/customerass/admin',18),(21,'公海资源','/Customer/customerblack/admin',18),(22,'机会管理','/Chance/',0),(23,'安排联系机会','/Chance/customerinfo/admin',22),(24,'我的机会','/Chance/customerinfo/todaylist',22),(25,'未联系机会','/Chance/customerinfo/oldList',22),(26,'基础数据管理','/Custtype/',0),(27,'客户分类','/Custtype/custtype/admin',26),(28,'字典数据','/Dictionary/dic/admin',26),(29,'人员角色管理','/User/userrole/admin',1),(30,'成交师-机会管理','/TransChance/',0),(31,'安排联系机会','/TransChance/customerinfo/admin',30),(32,'我的机会','/TransChance/customerinfo/todaylist',30),(33,'未联系机会','/TransChance/customerinfo/oldList',30),(34,'分机号管理','/User/extnumber/admin',1);
/*!40000 ALTER TABLE `c_menu_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `c_message`
--

DROP TABLE IF EXISTS `c_message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `c_message` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `cust_id` int(11) NOT NULL DEFAULT '0' COMMENT '客户id',
  `phone` varchar(20) NOT NULL DEFAULT '' COMMENT '电话号码',
  `content` varchar(200) NOT NULL DEFAULT '' COMMENT '短信内容',
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '发送状态',
  `memo` varchar(200) NOT NULL DEFAULT '' COMMENT '结果描述',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `creator` int(11) NOT NULL DEFAULT '0' COMMENT '创建人',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `c_message`
--

LOCK TABLES `c_message` WRITE;
/*!40000 ALTER TABLE `c_message` DISABLE KEYS */;
/*!40000 ALTER TABLE `c_message` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `c_note_info`
--

DROP TABLE IF EXISTS `c_note_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `c_note_info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `cust_id` int(11) NOT NULL COMMENT '客户id',
  `cust_info` varchar(200) DEFAULT '' COMMENT '客户情况',
  `requirement` varchar(200) DEFAULT '' COMMENT '挖需求',
  `service` varchar(200) DEFAULT '' COMMENT '介绍服务',
  `dissent` varchar(200) DEFAULT '' COMMENT '异议处理',
  `next_followup` varchar(200) DEFAULT '' COMMENT '下次跟进处理',
  `memo` varchar(200) DEFAULT '' COMMENT '备注',
  `isvalid` tinyint(1) DEFAULT '0' COMMENT '是否有效',
  `iskey` tinyint(1) DEFAULT '0' COMMENT '是否重点',
  `next_contact` int(11) DEFAULT '0' COMMENT '下次联系时间',
  `dial_id` int(11) DEFAULT '0' COMMENT '电话拔打记录',
  `message_id` int(11) NOT NULL DEFAULT '0',
  `eno` int(11) NOT NULL DEFAULT '0' COMMENT '工号',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `c_note_info`
--

LOCK TABLES `c_note_info` WRITE;
/*!40000 ALTER TABLE `c_note_info` DISABLE KEYS */;
/*!40000 ALTER TABLE `c_note_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `c_privilege`
--

DROP TABLE IF EXISTS `c_privilege`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `c_privilege` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `menu_id` int(11) NOT NULL DEFAULT '0' COMMENT '资源id',
  `role_id` int(11) NOT NULL DEFAULT '0' COMMENT '角色id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=106 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `c_privilege`
--

LOCK TABLES `c_privilege` WRITE;
/*!40000 ALTER TABLE `c_privilege` DISABLE KEYS */;
INSERT INTO `c_privilege` VALUES (3,2,1),(22,17,1),(54,29,1),(55,30,1),(56,31,1),(57,32,1),(58,10,1),(59,11,1),(60,13,1),(61,1,1),(62,33,1),(63,3,1),(64,5,1),(65,6,1),(66,7,1),(67,8,1),(68,9,1),(69,34,1),(70,12,1),(71,14,1),(72,16,1),(73,18,1),(74,19,1),(75,22,1),(76,24,1),(77,25,1),(78,26,1),(79,27,1),(80,28,1),(102,20,1),(103,21,1),(104,23,1),(105,15,1);
/*!40000 ALTER TABLE `c_privilege` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `c_role_info`
--

DROP TABLE IF EXISTS `c_role_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `c_role_info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(100) DEFAULT '' COMMENT '角色名称',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `c_role_info`
--

LOCK TABLES `c_role_info` WRITE;
/*!40000 ALTER TABLE `c_role_info` DISABLE KEYS */;
INSERT INTO `c_role_info` VALUES (1,'管理员');
/*!40000 ALTER TABLE `c_role_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `c_trans_cust_info`
--

DROP TABLE IF EXISTS `c_trans_cust_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `c_trans_cust_info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `cust_id` int(11) NOT NULL COMMENT '客户id',
  `cust_type` int(11) NOT NULL DEFAULT '0' COMMENT '客户分类',
  `eno` varchar(10) NOT NULL DEFAULT '' COMMENT '所属工号',
  `assign_eno` varchar(10) NOT NULL DEFAULT '' COMMENT '分配人',
  `assign_time` int(11) NOT NULL DEFAULT '0' COMMENT '分配时间',
  `next_time` int(11) NOT NULL DEFAULT '0' COMMENT '下次联系时间',
  `memo` varchar(200) DEFAULT '' COMMENT '备注',
  `creator` int(11) NOT NULL DEFAULT '0' COMMENT '创建人',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `c_trans_cust_info`
--

LOCK TABLES `c_trans_cust_info` WRITE;
/*!40000 ALTER TABLE `c_trans_cust_info` DISABLE KEYS */;
/*!40000 ALTER TABLE `c_trans_cust_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `c_user_role`
--

DROP TABLE IF EXISTS `c_user_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `c_user_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `role_id` int(11) NOT NULL DEFAULT '0' COMMENT '角色id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `c_user_role`
--

LOCK TABLES `c_user_role` WRITE;
/*!40000 ALTER TABLE `c_user_role` DISABLE KEYS */;
INSERT INTO `c_user_role` VALUES (1,1,1);
/*!40000 ALTER TABLE `c_user_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `c_users`
--

DROP TABLE IF EXISTS `c_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `c_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `eno` varchar(10) NOT NULL DEFAULT '' COMMENT '工号',
  `pass` varchar(50) NOT NULL DEFAULT '' COMMENT '密码',
  `name` varchar(20) DEFAULT '' COMMENT '姓名',
  `username` varchar(30) NOT NULL COMMENT '用户名',
  `birth` date DEFAULT NULL COMMENT '生日',
  `sex` tinyint(2) NOT NULL DEFAULT '1' COMMENT '性别',
  `tel` varchar(20) NOT NULL DEFAULT '' COMMENT '电话号码',
  `qq` varchar(15) DEFAULT '0' COMMENT 'qq',
  `dept_id` mediumint(4) NOT NULL DEFAULT '0' COMMENT '部门',
  `group_id` mediumint(5) DEFAULT '0' COMMENT '组别',
  `manager_id` int(11) NOT NULL DEFAULT '0' COMMENT '主管id',
  `ismaster` tinyint(1) DEFAULT '2' COMMENT '是否精英',
  `status` tinyint(2) DEFAULT '1' COMMENT '状态',
  `cust_num` int(11) NOT NULL DEFAULT '0' COMMENT '已分配资源数',
  `extend_no` int(11) NOT NULL DEFAULT '0' COMMENT '分机号',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `login_time` int(11) NOT NULL DEFAULT '0' COMMENT '最后登录时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `c_users`
--

LOCK TABLES `c_users` WRITE;
/*!40000 ALTER TABLE `c_users` DISABLE KEYS */;
INSERT INTO `c_users` VALUES (1,'U00001','a722c63db8ec8625af6cf71cb8c2d939','admin','admin','0000-00-00',1,'12314141234','2561582',1,1,0,1,1,0,0,123,0);
/*!40000 ALTER TABLE `c_users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-07-01 16:35:54
