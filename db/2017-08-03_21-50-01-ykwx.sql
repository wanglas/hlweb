-- MySQL dump 10.13  Distrib 5.5.40, for Win64 (x86)
--
-- Host: localhost    Database: ykwx
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
-- Table structure for table `wx_admin`
--

DROP TABLE IF EXISTS `wx_admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wx_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `pwd` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='后台管理员表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wx_admin`
--

LOCK TABLES `wx_admin` WRITE;
/*!40000 ALTER TABLE `wx_admin` DISABLE KEYS */;
INSERT INTO `wx_admin` VALUES (1,'admin','admin');
/*!40000 ALTER TABLE `wx_admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wx_adv`
--

DROP TABLE IF EXISTS `wx_adv`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wx_adv` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL COMMENT '名字',
  `url` varchar(1000) NOT NULL COMMENT '图片路径',
  `status` int(11) NOT NULL,
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wx_adv`
--

LOCK TABLES `wx_adv` WRITE;
/*!40000 ALTER TABLE `wx_adv` DISABLE KEYS */;
/*!40000 ALTER TABLE `wx_adv` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wx_brand`
--

DROP TABLE IF EXISTS `wx_brand`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wx_brand` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL COMMENT '品牌名称',
  `series_name` varchar(100) DEFAULT NULL COMMENT '品牌下系列名字',
  `status` int(11) NOT NULL COMMENT '状态',
  `create_time` int(11) DEFAULT NULL COMMENT '创建时间',
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='品牌表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wx_brand`
--

LOCK TABLES `wx_brand` WRITE;
/*!40000 ALTER TABLE `wx_brand` DISABLE KEYS */;
INSERT INTO `wx_brand` VALUES (1,'苹果',NULL,0,1501492989,1501557550),(2,'华为',NULL,1,1501492995,0),(3,'小米',NULL,1,1501493018,0),(4,'锤子',NULL,1,1501493589,0),(6,'三星',NULL,1,1501493755,0),(7,'魅族',NULL,1,1501555899,0),(8,'oppo',NULL,1,1501558212,0);
/*!40000 ALTER TABLE `wx_brand` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wx_comment`
--

DROP TABLE IF EXISTS `wx_comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wx_comment` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL COMMENT '用户id',
  `parent_id` int(11) NOT NULL COMMENT '父id',
  `order_id` int(11) NOT NULL COMMENT '相应订单id',
  `dz_num` int(11) NOT NULL COMMENT '点赞数量',
  `pl_num` int(11) NOT NULL COMMENT '评论数量',
  `create_time` varchar(255) NOT NULL COMMENT '创建时间',
  `update_time` int(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='评论表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wx_comment`
--

LOCK TABLES `wx_comment` WRITE;
/*!40000 ALTER TABLE `wx_comment` DISABLE KEYS */;
/*!40000 ALTER TABLE `wx_comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wx_goods`
--

DROP TABLE IF EXISTS `wx_goods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wx_goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `bid` int(11) NOT NULL COMMENT '品牌id',
  `img` varchar(1000) NOT NULL COMMENT '缩率图路径',
  `status` int(11) NOT NULL COMMENT '状态',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='商品表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wx_goods`
--

LOCK TABLES `wx_goods` WRITE;
/*!40000 ALTER TABLE `wx_goods` DISABLE KEYS */;
INSERT INTO `wx_goods` VALUES (8,'iphone7',3,'/yikuai/Uploads/2017-08-01/59802c5dee718.jpg',1,1501569249,1501572189),(9,'iphone4',1,'/yikuai/Uploads/2017-08-01/598027a8ce432.jpg',1,1501570984,0),(10,'华为mate10',2,'/yikuai/Uploads/2017-08-01/59802cda37c94.jpg',1,1501572314,0);
/*!40000 ALTER TABLE `wx_goods` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wx_goods_property`
--

DROP TABLE IF EXISTS `wx_goods_property`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wx_goods_property` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL COMMENT '属性名',
  `gid` int(11) NOT NULL COMMENT '商品id',
  `gname` varchar(255) NOT NULL COMMENT '手机名称',
  `bid` int(11) NOT NULL COMMENT '品牌id',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `update_time` int(11) NOT NULL COMMENT '更新时间',
  `status` int(11) NOT NULL COMMENT '状态',
  `pid` int(11) NOT NULL COMMENT '父分类',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='商品属性表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wx_goods_property`
--

LOCK TABLES `wx_goods_property` WRITE;
/*!40000 ALTER TABLE `wx_goods_property` DISABLE KEYS */;
INSERT INTO `wx_goods_property` VALUES (2,'内存',8,'',0,1501577578,0,1,0),(3,'128G',8,'',0,1501577718,0,1,2);
/*!40000 ALTER TABLE `wx_goods_property` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wx_question`
--

DROP TABLE IF EXISTS `wx_question`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wx_question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='故障表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wx_question`
--

LOCK TABLES `wx_question` WRITE;
/*!40000 ALTER TABLE `wx_question` DISABLE KEYS */;
/*!40000 ALTER TABLE `wx_question` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wx_recoverorder`
--

DROP TABLE IF EXISTS `wx_recoverorder`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wx_recoverorder` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `sn` int(100) NOT NULL COMMENT '订单编号',
  `tel_name` varchar(100) NOT NULL COMMENT '手机名字',
  `user_name` varchar(100) NOT NULL COMMENT '下单人姓名',
  `user_tel` int(100) NOT NULL COMMENT '下单人电话',
  `price` int(100) NOT NULL COMMENT '回收价格',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '订单状态',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='回收订单表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wx_recoverorder`
--

LOCK TABLES `wx_recoverorder` WRITE;
/*!40000 ALTER TABLE `wx_recoverorder` DISABLE KEYS */;
/*!40000 ALTER TABLE `wx_recoverorder` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wx_recoverprice`
--

DROP TABLE IF EXISTS `wx_recoverprice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wx_recoverprice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gid` int(100) NOT NULL COMMENT '手机id',
  `name` varchar(100) NOT NULL COMMENT '手机名字',
  `price` int(100) NOT NULL COMMENT '回收价格',
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='手机回收价目表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wx_recoverprice`
--

LOCK TABLES `wx_recoverprice` WRITE;
/*!40000 ALTER TABLE `wx_recoverprice` DISABLE KEYS */;
/*!40000 ALTER TABLE `wx_recoverprice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wx_repairorder`
--

DROP TABLE IF EXISTS `wx_repairorder`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wx_repairorder` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sn` int(255) NOT NULL COMMENT '订单编号',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `update_time` int(11) NOT NULL COMMENT '修改时间',
  `user_id` int(11) NOT NULL COMMENT '用户id',
  `remark` text NOT NULL COMMENT '备注',
  `status` int(11) NOT NULL COMMENT '状态',
  `tel` int(255) NOT NULL COMMENT '联系电话',
  `service_time` int(11) NOT NULL COMMENT '服务时间',
  `service_address` int(11) NOT NULL COMMENT '服务地址',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='维修订单表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wx_repairorder`
--

LOCK TABLES `wx_repairorder` WRITE;
/*!40000 ALTER TABLE `wx_repairorder` DISABLE KEYS */;
/*!40000 ALTER TABLE `wx_repairorder` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wx_repairprice`
--

DROP TABLE IF EXISTS `wx_repairprice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wx_repairprice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gid` int(11) NOT NULL COMMENT '商品id',
  `question_name` varchar(100) NOT NULL COMMENT '故障',
  `repair_price` int(199) NOT NULL COMMENT '维修报价',
  `status` int(11) NOT NULL COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='维修报价表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wx_repairprice`
--

LOCK TABLES `wx_repairprice` WRITE;
/*!40000 ALTER TABLE `wx_repairprice` DISABLE KEYS */;
/*!40000 ALTER TABLE `wx_repairprice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wx_user`
--

DROP TABLE IF EXISTS `wx_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wx_user` (
  `id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL COMMENT '姓名',
  `user_pwd` varchar(255) NOT NULL COMMENT '密码',
  `user_tel` int(11) NOT NULL COMMENT '电话',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `updata_time` int(11) NOT NULL COMMENT '更新时间',
  `user_address` varchar(255) NOT NULL COMMENT '会员地址',
  `user_money` varchar(255) NOT NULL COMMENT '用户余额',
  `real_name` varchar(255) NOT NULL COMMENT '真实姓名',
  `idcard` varchar(255) NOT NULL COMMENT '身份证',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wx_user`
--

LOCK TABLES `wx_user` WRITE;
/*!40000 ALTER TABLE `wx_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `wx_user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-08-03 21:50:02
