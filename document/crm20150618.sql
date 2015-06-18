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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `c_aftermarket_cust_info`
--

LOCK TABLES `c_aftermarket_cust_info` WRITE;
/*!40000 ALTER TABLE `c_aftermarket_cust_info` DISABLE KEYS */;
INSERT INTO `c_aftermarket_cust_info` VALUES (1,3,0,'3414','1234','U00001','1',1,1,'1',1,1),(2,4,4,'31341','13412','U00006','U00005',1431943954,1432224000,'kasdfaf',1,1),(5,2,0,'','','','U00012',1434522397,0,'',5,1434522397),(6,5,5,'','','U00006','U00006',1434528445,1434643200,'kadfaaa',5,1434528273);
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `c_black_info`
--

LOCK TABLES `c_black_info` WRITE;
/*!40000 ALTER TABLE `c_black_info` DISABLE KEYS */;
INSERT INTO `c_black_info` VALUES (1,1,1,11,1434520771,5);
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `c_contract_info`
--

LOCK TABLES `c_contract_info` WRITE;
/*!40000 ALTER TABLE `c_contract_info` DISABLE KEYS */;
INSERT INTO `c_contract_info` VALUES (1,3,'12',12,11,1434038400,'ddddddddffffff','12','13','13',12,1,1434038400,2,1434102916),(2,4,'1',123,1,1,'1','1','1','1',1,1,1,1,1),(3,5,'12',22556,1,1,'1','1','1','1',1,1,1,1,1);
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
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `c_cust_convt_detail`
--

LOCK TABLES `c_cust_convt_detail` WRITE;
/*!40000 ALTER TABLE `c_cust_convt_detail` DISABLE KEYS */;
INSERT INTO `c_cust_convt_detail` VALUES (1,3,4,0,4,1432112851,2),(2,1,1,1,6,1434015321,2),(3,1,1,1,6,1434015853,2),(4,1,1,1,6,1434015894,2),(5,1,3,6,7,1434076691,2),(6,1,1,1,6,1434508169,2),(7,1,1,2,6,1434509050,2),(8,1,2,1,3,1434510312,2),(9,2,3,11,14,1434511259,2),(10,2,3,11,14,1434511356,2),(11,2,3,11,14,1434519942,2),(13,2,1,11,18,1434520771,5),(14,1,2,3,6,1434521525,2),(16,2,2,11,17,1434521709,5),(17,1,2,2,6,1434521983,5),(18,2,2,10,17,1434522391,5),(19,1,5,1,6,1434523033,2),(20,2,5,10,17,1434528267,5),(21,3,5,0,4,1434613836,2),(22,3,5,0,4,1434613842,2),(23,3,5,0,4,1434613999,2),(24,3,5,0,4,1434614042,2),(25,3,5,0,4,1434614291,2),(26,3,5,4,5,1434614593,2);
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `c_customer_info`
--

LOCK TABLES `c_customer_info` WRITE;
/*!40000 ALTER TABLE `c_customer_info` DISABLE KEYS */;
INSERT INTO `c_customer_info` VALUES (1,'测试客户1','测试商店1','测试1','test1','test','2222222222','666','test@123.com','百度',100,6,'U00012',0,1434297600,'dafasdf','U00003',1,1434556800,0,'kdafadf',0,1,1),(2,'aaa','测试商店','测试','www.321.com','深圳南山','121212','111','test@123.com','百度',101,6,'U00012',1,1434470400,'','U00003',1,1434470400,0,'3333333',0,1,1),(3,'测试客户3','测试商店','测试asdf','www.123.com','testasdfas','13536580119','222','test@123.com','百度adf',102,7,'U00006',0,1970,'','U00003',1,1434556800,0,'ddff',0,1,1),(4,'测试客户4','测试商店','测试','test','test','13536580119','333','test@123.com','百度',103,1,'U00006',1,2232341,'','U00003',1,1434470400,0,'k',0,1,1),(5,'测试客户5','测试商店','测试','www.test.com','test','6666666','5555','test@123.com','百度',100,6,'U00012',0,2217600,'','U00003',1,1434556800,0,'kadfaaaafbbb',0,1,1),(6,'测试客户6','测试商店','测试','test','test','23','1235','test@123.com','百度',104,1,'U00006',1,2232341,'','U00003',1,1434556800,0,'k',0,1,1),(7,'测试客户7','测试商店','测试','test','test','1235','123','test@123.com','百度',110,1,'U00006',1,2232341,'','U00003',1,1434556800,0,'k',0,1,1),(8,'测试客户8','测试商店','测试','test','test','1235','123','test@123.com','百度',110,1,'U00006',1,2232341,'','U00003',1,1,0,'k',0,1,1),(9,'测试客户9','测试商店','测试','test','test','123','45135','test@123.com','百度',112,1,'U00006',1,2232341,'','U00003',1,1,0,'k',0,1,1),(10,'测试客户10','测试商店','测试','test','test','1235','213613','test@123.com','百度',100,1,'U00006',1,2232341,'','U00003',1,1,0,'k',0,1,1),(11,'测试客户11','测试商店','测试','test','test','1235','1235','test@123.com','百度',101,1,'U00006',1,2232341,'','U00003',1,1,0,'k',0,1,1),(12,'测试客户12','测试商店','测试','test','test','13546246','1235','test@123.com','百度',101,1,'U00006',1,2232341,'','U00003',1,1,0,'k',0,1,1);
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
INSERT INTO `c_dept_group` VALUES (1,1,2),(2,1,4),(3,2,1),(4,2,2),(5,2,4),(6,4,1),(7,5,6),(8,5,7),(9,6,7),(10,6,8);
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
INSERT INTO `c_dept_info` VALUES (1,'销售一部'),(2,'销售二部'),(4,'销售三部'),(5,'售后一部'),(6,'售后二部');
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
INSERT INTO `c_dial_detail` VALUES (1,'U00001',0,'','',1222,12,1,'/mp3/20150519/1.mp3',1,''),(2,'U00001',0,'','',112,12,1,'http://www.1ting.com/api/audio?/zzzzzmp3/2015fJun/12X/12b_Kuaizi/01.mp3',1,'');
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `c_group_info`
--

LOCK TABLES `c_group_info` WRITE;
/*!40000 ALTER TABLE `c_group_info` DISABLE KEYS */;
INSERT INTO `c_group_info` VALUES (1,'飞虎组'),(2,'大地组'),(3,'大海组'),(4,'野狼组'),(5,'红梅组'),(6,'黄菊组'),(7,'青兰组'),(8,'绿竹组');
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
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `c_menu_info`
--

LOCK TABLES `c_menu_info` WRITE;
/*!40000 ALTER TABLE `c_menu_info` DISABLE KEYS */;
INSERT INTO `c_menu_info` VALUES (1,'权限管理','/User/',0),(2,'用户管理','/User/users/admin',1),(3,'部门管理','/User/deptinfo/admin',1),(5,'组别管理','/User/groupinfo/admin',1),(6,'部门组别管理','/User/deptgroup/admin',1),(7,'菜单资源管理','/User/menuinfo/admin',1),(8,'角色管理','/User/roleinfo/admin',1),(9,'权限配置','/User/privilege/admin',1),(10,'财务数据','/Finance/',0),(11,'财务数据录入','/Finance/finance/create',10),(12,'财务数据查询','/Finance/finance/admin',10),(13,'售后管理','/Service/',0),(14,'新分客户','/Service/new/list',13),(15,'今日联系','/Service/today/todayList',13),(16,'遗留数据','/Service/old/oldList',13),(17,'查询分配','/Service/service/admin',13),(18,'客户管理','/Custom/',0),(19,'查询分配','/Customer/customerinfo/admin',18),(20,'客户资源分配','/Customer/customerass/admin',18),(21,'公海资源','/Customer/customerblack/admin',18),(22,'机会管理','/Chance/',0),(23,'安排联系机会','/Chance/customerinfo/admin',22),(24,'我的机会','/Chance/customerinfo/todaylist',22),(25,'未联系机会','/Chance/customerinfo/oldList',22),(26,'基础数据管理','/Custtype/',0),(27,'客户分类','/Custtype/custtype/admin',26),(28,'字典数据','/Dictionary/dic/admin',26),(29,'人员角色管理','/User/userrole/admin',1);
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
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `c_message`
--

LOCK TABLES `c_message` WRITE;
/*!40000 ALTER TABLE `c_message` DISABLE KEYS */;
INSERT INTO `c_message` VALUES (1,3,'13536580119','dafdasf',0,'',1431930059,1),(2,3,'13536580119','aasdfsdf',0,'',1431930210,1),(3,3,'13536580119','test sss',0,'',1431930239,1),(4,3,'13536580119','dafdadf',0,'',1431930305,1),(5,4,'5555','dafasd',2,'未检索到被叫号码',1432111821,2),(6,4,'5555','daf',2,'未检索到被叫号码',1432111865,2),(7,4,'5555','daffasdfasdf',2,'未检索到被叫号码',1432111959,2),(8,4,'5555','fasdfasdf',2,'未检索到被叫号码',1432112104,2),(9,4,'5555','fasdfasdf',2,'未检索到被叫号码',1432112345,2),(10,4,'5555','daffasdfasdf',2,'未检索到被叫号码',1432112350,2),(11,4,'5555','daffasdfasdf',2,'未检索到被叫号码',1432112394,2),(12,4,'5555','daffasdfasdf',2,'未检索到被叫号码',1432112436,2),(13,4,'5555','fasdfasdf',2,'未检索到被叫号码',1432112455,2),(14,4,'13536580119','adsfadfadf',1,'签权失败',1432112509,2),(15,4,'13536580119','test aassdd',1,'签权失败',1432112922,2),(16,4,'13536580119','你好，帅哥，这是。。',1,'签权失败',1432112970,2),(17,4,'13536580119','dfasdfasdf',1,'签权失败',1432113119,2),(18,3,'13536580119','test aaa',1,'签权失败',1432114218,2),(19,3,'13536580119','test aaa',1,'签权失败',1432114241,2),(20,1,'2222222222','asdfasdf',2,'未检索到被叫号码',1433835582,2),(21,1,'2222222222','afdasdf',2,'未检索到被叫号码',1434444723,2),(22,3,'13536580119','adsf',1,'签权失败',1434451142,2);
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
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `c_note_info`
--

LOCK TABLES `c_note_info` WRITE;
/*!40000 ALTER TABLE `c_note_info` DISABLE KEYS */;
INSERT INTO `c_note_info` VALUES (1,3,'aa','bbb','cc','dd','dfa','ddd',1,1,123,0,0,1,123),(2,4,'dd','cc','adf','dfa','adsf','asdf',1,1,431,1,0,1,122),(3,3,'aa2','bbb','cc','dd','dfa','ddd',1,1,123,0,0,1,123),(4,3,'dsf','bbb','cc','dd','dfa','ddd',1,1,123,0,0,1,123),(5,3,'asf','cd','cc','dd','dfa','ddd',1,1,123,0,0,1,123),(6,3,'asdf','adf','cc','dd','dfa','ddd',1,1,123,0,0,1,123),(7,3,'asdfasf','adf','cc','dd','dfa','ddd',1,1,123,0,0,1,123),(8,3,'asdfa','af','cc','dd','dfa','ddd',1,1,123,0,0,1,123),(9,3,'aa','bbb','cc','dd','dfa','ddd',1,1,123,0,0,1,123),(10,3,'aa','bbb','cc','dd','dfa','ddd',1,1,123,0,0,1,123),(11,3,'12se','12sae','sdaf','fasdf','asf','asd',1,1,21,0,0,1,123),(12,3,'12se','12sae','sdaf','fasdf','asf','asd',1,1,21,0,0,1,123),(13,4,'aaa','asdf','asdf','asdfasdf','asdfasdf','adfs',1,1,1432224000,2,0,2,1432113639),(14,1,'bbb','asdf','asdf','asdfasdf','asdfasdf','adfs',1,1,1432224000,2,0,2,1432113847),(15,1,'ccc','asdf','asdf','asdfasdf','asdfasdf','adfs',1,1,1432224000,0,0,2,1432113847),(16,1,'ss','asdf','asdf','asdfasdf','asdfasdf','adfs',1,1,1432224000,0,0,2,1432113847),(17,1,'dd','asdf','asdf','asdfasdf','asdfasdf','adfs',1,1,1432224000,0,0,2,1432113847),(18,1,'aa','asdf','asdf','asdfasdf','asdfasdf','adfs',1,1,1432224000,0,0,2,1432113847),(19,1,'aaa','asdf','asdf','asdfasdf','asdfasdf','adfs',1,1,1432224000,0,0,2,1432113847),(20,1,'aa1','asdf','asdf','asdfasdf','asdfasdf','adfs',1,1,1432224000,0,0,2,1432113847),(21,1,'aa2','asdf','asdf','asdfasdf','asdfasdf','adfs',1,1,1432224000,0,0,2,1432113847),(22,1,'bb1','asdf','asdf','asdfasdf','asdfasdf','adfs',1,1,1432224000,0,0,2,1432113847),(23,1,'bb2','asdf','asdf','asdfasdf','asdfasdf','adfs',1,1,1432224000,0,0,2,1432113847),(24,1,'cc2','asdf','asdf','asdfasdf','asdfasdf','adfs',1,1,1432224000,0,0,2,1432113847),(25,1,'dd1','asdf','asdf','asdfasdf','asdfasdf','adfs',1,1,1432224000,0,0,2,1432113847),(26,3,'asdf','aaa','asdfff','fff','ddd','ddf',0,0,1434038400,0,0,2,1434016612),(27,3,'333333333','455555555555555','44444444444','dddddd','dddddddd','gffffffffffff',0,0,1434038400,0,0,2,1434016663),(28,3,'','','','','','',0,0,1434038400,0,0,2,1434076691),(29,3,'','','','','','',0,0,1434038400,0,0,2,1434100679),(30,3,'','','','','','',0,0,1434038400,0,0,2,1434100774),(31,3,'','','','','','',0,0,1434038400,0,0,2,1434100853),(32,3,'','','','','','',0,0,1434038400,0,0,2,1434100960),(33,3,'','','','','','',0,0,1434038400,0,0,2,1434102916),(34,1,'','','','','','',0,0,1434470400,0,0,2,1434508169),(35,1,'daf','asdf','asd','asf','afs','',1,0,1434556800,0,0,2,1434508836),(36,1,'asd','as','fasdf','dfas','','dfasdf',1,0,1434556800,0,0,2,1434509050),(37,2,'dfg','adsg','asd','adg','gfasdg','adgsdg',1,1,1434470400,123,0,2,1434510312),(38,3,'asdf','asdf','asdfasdf','asdf','22','33',1,0,1434556800,0,0,2,1434511259),(39,5,'asdf','asdf','asdf','asdf','asdf','asfd',1,0,1434643200,0,0,2,1434614692);
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
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `c_privilege`
--

LOCK TABLES `c_privilege` WRITE;
/*!40000 ALTER TABLE `c_privilege` DISABLE KEYS */;
INSERT INTO `c_privilege` VALUES (3,2,1),(15,7,1),(16,8,1),(17,9,1),(18,10,1),(19,11,1),(20,12,1),(21,13,1),(22,14,1),(23,15,1),(24,16,1),(25,17,1),(30,3,1),(31,5,1),(34,2,2),(35,7,2),(36,8,2),(37,9,2),(38,10,2),(39,11,2),(40,12,2),(41,13,2),(42,14,2),(43,15,2),(44,16,2),(45,17,2),(46,3,2),(47,5,2),(48,6,2),(49,1,2),(50,18,2),(51,19,2),(52,20,2),(53,21,2),(54,22,2),(55,23,2),(56,24,2),(57,25,2),(58,10,4),(59,11,4),(60,12,4),(61,1,5),(62,2,5),(63,3,5),(64,5,5),(65,6,5),(66,7,5),(67,8,5),(68,9,5),(69,10,5),(70,11,5),(71,12,5),(72,13,5),(73,14,5),(74,15,5),(75,16,5),(76,17,5),(77,18,5),(78,19,5),(79,20,5),(80,21,5),(81,22,5),(82,23,5),(83,24,5),(84,25,5),(85,26,5),(86,27,5),(87,28,5),(88,29,5);
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `c_role_info`
--

LOCK TABLES `c_role_info` WRITE;
/*!40000 ALTER TABLE `c_role_info` DISABLE KEYS */;
INSERT INTO `c_role_info` VALUES (1,'客服人员'),(2,'业务员'),(4,'财务人员'),(5,'部门主管'),(6,'成交师');
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `c_trans_cust_info`
--

LOCK TABLES `c_trans_cust_info` WRITE;
/*!40000 ALTER TABLE `c_trans_cust_info` DISABLE KEYS */;
INSERT INTO `c_trans_cust_info` VALUES (2,3,17,'U00006','U00005',2341234,123,'sdfa',1,12341234),(4,1,18,'U00012','U00006',1434509050,0,'',2,1434509050),(6,2,17,'U00012','U00012',1434521983,0,'',5,1434521983),(7,5,17,'U00012','U00006',1434523033,0,'',2,1434523033);
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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `c_user_role`
--

LOCK TABLES `c_user_role` WRITE;
/*!40000 ALTER TABLE `c_user_role` DISABLE KEYS */;
INSERT INTO `c_user_role` VALUES (1,1,1),(2,3,1),(3,3,2),(4,4,1),(6,4,4),(7,5,1),(8,5,2),(9,5,4),(10,1,5),(12,2,2),(13,6,2),(14,2,6),(15,3,6),(16,5,6);
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `c_users`
--

LOCK TABLES `c_users` WRITE;
/*!40000 ALTER TABLE `c_users` DISABLE KEYS */;
INSERT INTO `c_users` VALUES (1,'U00005','a722c63db8ec8625af6cf71cb8c2d939','admin','admin','0000-00-00',1,'12314141234','2561582',1,1,0,1,1,0,0,123,0),(2,'U00006','a722c63db8ec8625af6cf71cb8c2d939','test2','test2','0000-00-00',1,'12314141234','2561582',1,2,1,1,1,2,0,1,1),(3,'U00001','a722c63db8ec8625af6cf71cb8c2d939','test1','test1','0000-00-00',1,'13536580110','123123123',1,1,0,2,1,12,0,0,0),(4,'U00011','a722c63db8ec8625af6cf71cb8c2d939','test10','test10','0000-00-00',1,'12314141234','2561582',1,3,2,1,1,0,0,1,1),(5,'U00012','a722c63db8ec8625af6cf71cb8c2d939','test11','test11','0000-00-00',1,'12314141234','2561582',1,1,2,2,1,0,0,1,1),(6,'U00007','a722c63db8ec8625af6cf71cb8c2d939','test3','test3','0000-00-00',1,'12314141234','2561582',1,2,1,1,1,0,0,1,1),(7,'U00002','a722c63db8ec8625af6cf71cb8c2d939','test4','test4','0000-00-00',2,'12314141234','2561582',1,3,1,1,1,0,0,1,1),(8,'U00003','a722c63db8ec8625af6cf71cb8c2d939','test5','test5','0000-00-00',1,'12314141234','2561582',1,1,4,2,1,0,0,1,1),(9,'U00004','a722c63db8ec8625af6cf71cb8c2d939','test6','test6','0000-00-00',1,'12314141234','2561582',1,2,4,1,1,0,0,1,1),(10,'U00008','a722c63db8ec8625af6cf71cb8c2d939','test7','test7','0000-00-00',1,'12314141234','2561582',1,3,5,2,1,0,0,1,1),(11,'U00009','a722c63db8ec8625af6cf71cb8c2d939','test8','test8','0000-00-00',1,'12314141234','2561582',1,1,5,2,1,0,0,1,1),(12,'U00010','a722c63db8ec8625af6cf71cb8c2d939','test9','test9','0000-00-00',1,'12314141234','2561582',1,1,10,1,1,0,0,1,1);
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

-- Dump completed on 2015-06-18 18:44:12
