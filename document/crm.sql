-- MySQL dump 10.13  Distrib 5.5.40, for Win64 (x86)
--
-- Host: localhost    Database: crm
-- ------------------------------------------------------
-- Server version	5.5.40

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
  `cust_type` int(11) NOT NULL COMMENT '客户分类',
  `webchat` varchar(20) NOT NULL COMMENT '微信',
  `ww` varchar(20) NOT NULL COMMENT '旺旺',
  `eno` varchar(10) NOT NULL COMMENT '所属工号',
  `assign_eno` varchar(10) NOT NULL COMMENT '分配人',
  `assign_time` int(11) NOT NULL COMMENT '分配时间',
  `next_time` int(11) NOT NULL COMMENT '下次联系时间',
  `memo` int(11) NOT NULL COMMENT '备注',
  `creator` int(11) NOT NULL COMMENT '创建时间',
  `create_time` int(11) NOT NULL COMMENT '创建人',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `c_aftermarket_cust_info`
--

LOCK TABLES `c_aftermarket_cust_info` WRITE;
/*!40000 ALTER TABLE `c_aftermarket_cust_info` DISABLE KEYS */;
INSERT INTO `c_aftermarket_cust_info` VALUES (1,1,0,'3414','1234','U00001','1',1,1,1,1,1),(2,2,0,'31341','13412','U00002','1',1,1,1,1,1);
/*!40000 ALTER TABLE `c_aftermarket_cust_info` ENABLE KEYS */;
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
  `service_limit` varchar(10) NOT NULL COMMENT '服务期限',
  `total_money` int(11) NOT NULL COMMENT '合同总金额',
  `pay_type` int(11) NOT NULL COMMENT '支付方式',
  `pay_time` int(11) NOT NULL COMMENT '支付时间',
  `promise` varchar(200) NOT NULL COMMENT '合同承诺',
  `first_pay` varchar(10) NOT NULL COMMENT '第一次支付金额',
  `second_pay` varchar(10) NOT NULL COMMENT '第二次支付金额',
  `third_pay` varchar(10) NOT NULL COMMENT '第三次支付金额',
  `fourth_pay` int(11) NOT NULL COMMENT '第四次支付金额',
  `comm_royalty` int(11) NOT NULL COMMENT '佣金提成',
  `comm_pay_time` int(11) NOT NULL COMMENT '佣金支付时间',
  `creator` int(11) NOT NULL COMMENT '创建人',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `c_contract_info`
--

LOCK TABLES `c_contract_info` WRITE;
/*!40000 ALTER TABLE `c_contract_info` DISABLE KEYS */;
INSERT INTO `c_contract_info` VALUES (1,1,'2',12,1,1,'1','1','11','1',1,1,1,1,1),(2,2,'1',123,1,1,'1','1','1','1',1,1,1,1,1);
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
  `lib_type` int(11) NOT NULL COMMENT '库类型',
  `cust_id` int(11) NOT NULL COMMENT '客户id',
  `cust_type_1` int(11) NOT NULL COMMENT '原始类别',
  `cust_type_2` int(11) NOT NULL COMMENT '转换类别',
  `convt_time` int(11) NOT NULL COMMENT '转换时间',
  `user_id` int(11) NOT NULL COMMENT '操作人',
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
  `lib_type` int(11) NOT NULL COMMENT '库类型',
  `type_no` varchar(5) NOT NULL COMMENT '类型编号',
  `type_name` varchar(100) NOT NULL COMMENT '类型名称',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `c_cust_type`
--

LOCK TABLES `c_cust_type` WRITE;
/*!40000 ALTER TABLE `c_cust_type` DISABLE KEYS */;
INSERT INTO `c_cust_type` VALUES (1,1,'0','新分资源，未接通'),(2,1,'1','未深入联系的'),(3,1,'2','有需求，了解服务'),(4,1,'3','认可服务，认可价格，有异议'),(5,1,'4','已邀约成功，未确定时间（1个星期）'),(6,1,'5','确认到店，3天内'),(7,1,'6','已到店'),(8,1,'7','已签合同或已交订金'),(9,1,'8','毁约客户'),(10,2,'10','新分资源'),(11,2,'11','电销需帮助的客户'),(12,2,'12','意向不大，需跟进'),(13,2,'13','有意向，需培养'),(14,2,'14','认可服务，有异议'),(15,2,'15','已签合同或已交订金'),(16,2,'16','毁约客户'),(17,2,'17','成交客户'),(18,3,'0','新分'),(19,3,'1','待定'),(20,3,'2','待定'),(21,3,'3','待定'),(22,3,'4','续费会员'),(23,3,'5','佣金支付'),(24,3,'6','投诉会员'),(25,3,'7','成交放弃会员');
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
  `cust_name` varchar(100) DEFAULT NULL COMMENT '客户名称',
  `shop_name` varchar(100) DEFAULT NULL COMMENT '店铺名称',
  `corp_name` varchar(100) DEFAULT NULL COMMENT '公司名称',
  `shop_url` varchar(100) DEFAULT NULL COMMENT '店铺网址',
  `shop_addr` varchar(100) DEFAULT NULL COMMENT '店铺地址',
  `phone` varchar(20) DEFAULT NULL COMMENT '电话',
  `qq` varchar(20) DEFAULT NULL COMMENT 'QQ',
  `mail` varchar(50) DEFAULT NULL COMMENT '邮箱',
  `datafrom` varchar(100) DEFAULT NULL COMMENT '数据来源',
  `category` int(11) DEFAULT NULL COMMENT '所属类目',
  `cust_type` int(11) DEFAULT NULL COMMENT '客户分类',
  `eno` varchar(10) DEFAULT NULL COMMENT '所属工号',
  `iskey` int(11) DEFAULT NULL COMMENT '是否重点',
  `visit_date` int(11) DEFAULT '0' COMMENT '到访时间',
  `abandon_reason` varchar(200) DEFAULT '' COMMENT '放弃原因',
  `assign_eno` varchar(10) DEFAULT NULL COMMENT '分配人',
  `assign_time` int(11) DEFAULT NULL COMMENT '分配时间',
  `next_time` int(11) DEFAULT NULL COMMENT '下次联系时间',
  `memo` varchar(100) DEFAULT NULL COMMENT '备注',
  `status` int(11) DEFAULT '0' COMMENT '状态',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `creator` int(11) NOT NULL COMMENT '创建人',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `c_customer_info`
--

LOCK TABLES `c_customer_info` WRITE;
/*!40000 ALTER TABLE `c_customer_info` DISABLE KEYS */;
INSERT INTO `c_customer_info` VALUES (1,'测试客户1','测试商店1','测试1','test1','test','2222222222','666','test@123.com','百度',100,1,'U0001',1,0,'','U00001',1,1,'k',0,1,1),(2,'aaa','测试商店','测试','test','test','121212','111','test@123.com','百度',101,1,'U0001',1,0,'','U00001',1,1,'k',0,1,1),(3,'测试客户3','测试商店','测试','test','test','3333333','222','test@123.com','百度',102,1,'U0001',1,0,'','U00001',1,1,'k',0,1,1),(4,'测试客户4','测试商店','测试','test','test','5555','333','test@123.com','百度',100,1,'U0001',1,0,'','U00001',1,1,'k',0,1,1),(5,'测试客户5','测试商店','测试','test','test','6666666','5555','test@123.com','百度',105,1,'U0001',1,0,'','U00001',1,1,'k',0,1,1),(6,'测试客户6','测试商店','测试','test','test','23','1235','test@123.com','百度',104,1,'U0001',1,0,'','U00001',1,1,'k',0,1,1),(7,'测试客户7','测试商店','测试','test','test','1235','123','test@123.com','百度',110,1,'U0001',1,0,'','U00001',1,1,'k',0,1,1),(8,'测试客户8','测试商店','测试','test','test','1235','123','test@123.com','百度',110,1,'U0001',1,0,'','U00001',1,1,'k',0,1,1),(9,'测试客户9','测试商店','测试','test','test','123','45135','test@123.com','百度',112,1,'U0001',1,0,'','U00001',1,1,'k',0,1,1),(10,'测试客户10','测试商店','测试','test','test','1235','213613','test@123.com','百度',100,1,'U0001',1,0,'','U00001',1,1,'k',0,1,1),(11,'测试客户11','测试商店','测试','test','test','1235','1235','test@123.com','百度',101,1,'U0001',1,0,'','U00001',1,1,'k',0,1,1),(12,'测试客户12','测试商店','测试','test','test','13546246','1235','test@123.com','百度',101,1,'U0001',1,0,'','U00001',1,1,'k',0,1,1);
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
  `dept_id` int(11) DEFAULT NULL COMMENT '部门id',
  `group_id` int(11) DEFAULT NULL COMMENT '组别id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `c_dept_group`
--

LOCK TABLES `c_dept_group` WRITE;
/*!40000 ALTER TABLE `c_dept_group` DISABLE KEYS */;
INSERT INTO `c_dept_group` VALUES (1,1,1),(2,1,2),(3,1,3),(4,2,2),(5,2,3);
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `c_dept_info`
--

LOCK TABLES `c_dept_info` WRITE;
/*!40000 ALTER TABLE `c_dept_info` DISABLE KEYS */;
INSERT INTO `c_dept_info` VALUES (1,'销售部'),(2,'技术部');
/*!40000 ALTER TABLE `c_dept_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `c_dial_detail`
--

DROP TABLE IF EXISTS `c_dial_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `c_dial_detail` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `eno` varchar(10) NOT NULL COMMENT '工号',
  `dial_time` int(11) NOT NULL COMMENT '拔打时间',
  `dial_long` float NOT NULL COMMENT '拔打时长',
  `dial_num` int(11) NOT NULL DEFAULT '1' COMMENT '拔打次数',
  `record_path` varchar(200) DEFAULT '' COMMENT '录音路径',
  `isok` int(11) DEFAULT '0' COMMENT '是否成功',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
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
  `code` varchar(10) NOT NULL COMMENT '编号',
  `name` varchar(100) NOT NULL COMMENT '名称',
  `ctype` varchar(20) NOT NULL COMMENT '类型',
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
  `cust_id` int(11) NOT NULL COMMENT '客户id',
  `sale_user` int(11) NOT NULL COMMENT '销售人员',
  `trans_user` int(11) NOT NULL COMMENT '谈单师',
  `acct_number` int(11) NOT NULL COMMENT '到账单数',
  `acct_amount` float NOT NULL COMMENT '到账金额',
  `acct_time` int(11) NOT NULL COMMENT '到账时间',
  `creator` int(11) NOT NULL COMMENT '创建人',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `c_finance`
--

LOCK TABLES `c_finance` WRITE;
/*!40000 ALTER TABLE `c_finance` DISABLE KEYS */;
INSERT INTO `c_finance` VALUES (1,1,1,1,1,2,1,1,1),(2,2,1,1,2,2,2,2,1),(3,3,2,2,2,2,1,1,1426058390),(4,1,2,3,3,3,3,1,1426058421),(5,3,1,2,1,2,1426003200,1,1426060218),(6,1,3,5,4,4,1426003200,1,1426060511),(7,1,1,1,1,1,1426003200,1,1426060523),(8,4,1,5,6,5,1426003200,1,1426060535),(9,2,1,1,1,2,1426003200,1,1426060547),(10,5,2,6,7,6,1426003200,1,1426060557),(11,6,2,6,6,7,1426003200,1,1426060566),(12,2,1,2,1,2,1426176000,1,1426237070),(13,1,1,1,1,1,1425312000,1,1427101001),(14,1,1,1,12,123,1427385600,1,1427441211);
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `c_group_info`
--

LOCK TABLES `c_group_info` WRITE;
/*!40000 ALTER TABLE `c_group_info` DISABLE KEYS */;
INSERT INTO `c_group_info` VALUES (1,'A组'),(2,'B组'),(3,'C组'),(4,'D组');
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
  `name` varchar(100) NOT NULL COMMENT '资源名称',
  `url` varchar(100) NOT NULL COMMENT '资源url',
  `parent_id` int(11) DEFAULT NULL COMMENT '上级资源id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `c_menu_info`
--

LOCK TABLES `c_menu_info` WRITE;
/*!40000 ALTER TABLE `c_menu_info` DISABLE KEYS */;
/*!40000 ALTER TABLE `c_menu_info` ENABLE KEYS */;
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
  `cust_info` varchar(200) DEFAULT NULL COMMENT '客户情况',
  `requirement` varchar(200) DEFAULT NULL COMMENT '挖需求',
  `service` varchar(200) DEFAULT NULL COMMENT '介绍服务',
  `dissent` varchar(200) DEFAULT NULL COMMENT '异议处理',
  `next_followup` varchar(200) DEFAULT NULL COMMENT '下次跟进处理',
  `memo` varchar(200) DEFAULT NULL COMMENT '备注',
  `isvalid` tinyint(1) DEFAULT NULL COMMENT '是否有效',
  `iskey` tinyint(1) DEFAULT NULL COMMENT '是否重点',
  `next_contact` int(11) DEFAULT NULL COMMENT '下次联系时间',
  `dial_id` int(11) DEFAULT '0' COMMENT '电话拔打记录',
  `eno` int(11) NOT NULL COMMENT '工号',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
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
  `menu_id` int(11) NOT NULL COMMENT '资源id',
  `role_id` int(11) NOT NULL COMMENT '角色id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `c_privilege`
--

LOCK TABLES `c_privilege` WRITE;
/*!40000 ALTER TABLE `c_privilege` DISABLE KEYS */;
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
  `name` varchar(100) DEFAULT NULL COMMENT '角色名称',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `c_role_info`
--

LOCK TABLES `c_role_info` WRITE;
/*!40000 ALTER TABLE `c_role_info` DISABLE KEYS */;
INSERT INTO `c_role_info` VALUES (1,'谈单师'),(2,'业务人员');
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
  `cust_type` int(11) NOT NULL COMMENT '客户分类',
  `eno` varchar(10) NOT NULL COMMENT '所属工号',
  `assign_eno` varchar(10) NOT NULL COMMENT '分配人',
  `assign_time` int(11) NOT NULL COMMENT '分配时间',
  `next_time` int(11) NOT NULL COMMENT '下次联系时间',
  `memo` int(11) NOT NULL COMMENT '备注',
  `creator` int(11) NOT NULL COMMENT '创建人',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
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
  `user_id` int(11) NOT NULL COMMENT '用户id',
  `role_id` int(11) NOT NULL COMMENT '角色id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `c_user_role`
--

LOCK TABLES `c_user_role` WRITE;
/*!40000 ALTER TABLE `c_user_role` DISABLE KEYS */;
INSERT INTO `c_user_role` VALUES (1,1,1),(2,2,1),(3,3,1);
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
  `pass` varchar(50) NOT NULL COMMENT '密码',
  `name` varchar(20) DEFAULT '' COMMENT '姓名',
  `username` varchar(30) NOT NULL COMMENT '用户名',
  `birth` int(11) DEFAULT '0' COMMENT '生日',
  `sex` tinyint(2) NOT NULL DEFAULT '1' COMMENT '性别',
  `tel` varchar(20) NOT NULL COMMENT '电话号码',
  `qq` varchar(15) DEFAULT NULL COMMENT 'qq',
  `dept_id` mediumint(4) NOT NULL COMMENT '部门',
  `group_id` mediumint(5) DEFAULT NULL COMMENT '组别',
  `manager_id` int(11) NOT NULL COMMENT '主管id',
  `ismaster` tinyint(1) DEFAULT NULL COMMENT '是否精英',
  `status` tinyint(2) DEFAULT NULL COMMENT '状态',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `login_time` int(11) NOT NULL COMMENT '最后登录时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `c_users`
--

LOCK TABLES `c_users` WRITE;
/*!40000 ALTER TABLE `c_users` DISABLE KEYS */;
INSERT INTO `c_users` VALUES (1,'U00005','a722c63db8ec8625af6cf71cb8c2d939','admin','admin',0,1,'12314141234','2561582',1,1,1,1,1,123,0),(2,'U00006','a722c63db8ec8625af6cf71cb8c2d939','test2','test2',0,1,'12314141234','2561582',1,2,1,1,1,1,1),(3,'U00001','a722c63db8ec8625af6cf71cb8c2d939','test1','test1',0,1,'13536580110','123123123',0,0,0,0,0,0,0),(4,'U00011','a722c63db8ec8625af6cf71cb8c2d939','test10','test10',0,1,'12314141234','2561582',1,3,1,1,1,1,1),(5,'U00012','a722c63db8ec8625af6cf71cb8c2d939','test11','test11',0,1,'12314141234','2561582',1,1,1,1,1,1,1),(6,'U00007','a722c63db8ec8625af6cf71cb8c2d939','test3','test3',0,1,'12314141234','2561582',1,2,1,1,1,1,1),(7,'U00002','a722c63db8ec8625af6cf71cb8c2d939','test4','test4',0,2,'12314141234','2561582',1,3,1,1,1,1,1),(8,'U00003','a722c63db8ec8625af6cf71cb8c2d939','test5','test5',0,1,'12314141234','2561582',1,1,1,1,1,1,1),(9,'U00004','a722c63db8ec8625af6cf71cb8c2d939','test6','test6',0,1,'12314141234','2561582',1,2,1,1,1,1,1),(10,'U00008','a722c63db8ec8625af6cf71cb8c2d939','test7','test7',0,1,'12314141234','2561582',1,3,1,1,1,1,1),(11,'U00009','a722c63db8ec8625af6cf71cb8c2d939','test8','test8',0,1,'12314141234','2561582',1,1,1,1,1,1,1),(12,'U00010','a722c63db8ec8625af6cf71cb8c2d939','test9','test9',0,1,'12314141234','2561582',1,1,1,1,1,1,1);
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

-- Dump completed on 2015-04-07 17:48:12
