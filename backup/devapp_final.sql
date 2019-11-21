-- MySQL dump 10.13  Distrib 5.7.12, for Win64 (x86_64)
--
-- Host: localhost    Database: devapp_final
-- ------------------------------------------------------
-- Server version	5.7.15-log

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
-- Table structure for table `customer_purchase_order`
--

DROP TABLE IF EXISTS `customer_purchase_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer_purchase_order` (
  `purchase_order_id` int(11) NOT NULL AUTO_INCREMENT,
  `po_customer_name` varchar(45) NOT NULL,
  `po_address` varchar(45) NOT NULL,
  `po_contactNum` varchar(11) NOT NULL,
  `po_date_issued` date NOT NULL,
  `po_trackID` int(6) NOT NULL,
  `po_manustatus` varchar(45) DEFAULT NULL,
  `po_packstatus` varchar(45) DEFAULT NULL,
  `po_delstatus` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`purchase_order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer_purchase_order`
--

LOCK TABLES `customer_purchase_order` WRITE;
/*!40000 ALTER TABLE `customer_purchase_order` DISABLE KEYS */;
INSERT INTO `customer_purchase_order` VALUES (48,'Don','Taguig','09123456789','2017-07-29',178494,'Success','Under Packaging','Delivery: Pending'),(49,'Jessica','Taft','09876523456','2017-07-30',734224,'Success','Success','Delivered');
/*!40000 ALTER TABLE `customer_purchase_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `discrepancy`
--

DROP TABLE IF EXISTS `discrepancy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `discrepancy` (
  `discrepancy_id` int(11) NOT NULL,
  `discrepancy_quantity` int(11) NOT NULL,
  `discrepancy_product_id` varchar(15) NOT NULL,
  `discrepancy_unitPrice` decimal(10,5) NOT NULL,
  `discrepancy_totalAmount` decimal(10,5) NOT NULL,
  `products_product_id` int(11) NOT NULL,
  `rawmats_rawmats_id` int(11) NOT NULL,
  PRIMARY KEY (`discrepancy_id`),
  KEY `fk_discrepancy_products1_idx` (`products_product_id`),
  KEY `fk_discrepancy_rawmats1_idx` (`rawmats_rawmats_id`),
  CONSTRAINT `fk_discrepancy_products1` FOREIGN KEY (`products_product_id`) REFERENCES `products` (`product_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_discrepancy_rawmats1` FOREIGN KEY (`rawmats_rawmats_id`) REFERENCES `rawmats` (`rawmats_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `discrepancy`
--

LOCK TABLES `discrepancy` WRITE;
/*!40000 ALTER TABLE `discrepancy` DISABLE KEYS */;
/*!40000 ALTER TABLE `discrepancy` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ingredient`
--

DROP TABLE IF EXISTS `ingredient`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ingredient` (
  `ingredient_id` int(11) NOT NULL AUTO_INCREMENT,
  `ingredient_name` varchar(50) NOT NULL,
  `ingredient_price` decimal(10,5) NOT NULL,
  PRIMARY KEY (`ingredient_id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ingredient`
--

LOCK TABLES `ingredient` WRITE;
/*!40000 ALTER TABLE `ingredient` DISABLE KEYS */;
INSERT INTO `ingredient` VALUES (22,'Coconut Oil',120.00000),(23,'Gugo Root',100.00000),(24,'Petals',80.00000),(25,'Essential Oils',110.00000),(26,'Pump Bottles',50.00000);
/*!40000 ALTER TABLE `ingredient` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ingredients_supplied`
--

DROP TABLE IF EXISTS `ingredients_supplied`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ingredients_supplied` (
  `ingredient_supplied_id` int(11) NOT NULL AUTO_INCREMENT,
  `ingredient_accessed_date` date NOT NULL,
  `ingredient_supplier_id` int(11) NOT NULL,
  `ingredient_id` int(11) NOT NULL,
  PRIMARY KEY (`ingredient_supplied_id`),
  KEY `fk_ingredients_supplied_suppliers1_idx` (`ingredient_supplier_id`),
  KEY `fk_ingredients_supplied_ingredient1_idx` (`ingredient_id`),
  CONSTRAINT `fk_ingredients_supplied_ingredient1` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredient` (`ingredient_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_ingredients_supplied_suppliers1` FOREIGN KEY (`ingredient_supplier_id`) REFERENCES `suppliers` (`supplier_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ingredients_supplied`
--

LOCK TABLES `ingredients_supplied` WRITE;
/*!40000 ALTER TABLE `ingredients_supplied` DISABLE KEYS */;
INSERT INTO `ingredients_supplied` VALUES (5,'2017-07-29',5,22),(6,'2017-07-29',6,23),(7,'2017-07-29',7,24),(8,'2017-07-29',8,25),(9,'2017-07-29',9,26);
/*!40000 ALTER TABLE `ingredients_supplied` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_order`
--

DROP TABLE IF EXISTS `job_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `job_order` (
  `job_order_id` int(11) NOT NULL AUTO_INCREMENT,
  `jo_date_issued` date NOT NULL,
  `jo_requested_by` varchar(30) NOT NULL,
  `jo_trackID` int(6) NOT NULL,
  `jo_manustatus` varchar(45) DEFAULT NULL,
  `jo_packstatus` varchar(45) DEFAULT NULL,
  `jo_delstatus` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`job_order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_order`
--

LOCK TABLES `job_order` WRITE;
/*!40000 ALTER TABLE `job_order` DISABLE KEYS */;
INSERT INTO `job_order` VALUES (64,'2017-07-29','dlsu',350591,'Under Manufacturing','Packaging: Pending','Delivery: Pending');
/*!40000 ALTER TABLE `job_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_details`
--

DROP TABLE IF EXISTS `order_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_details` (
  `order_details_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_purchaseorder_id` int(11) DEFAULT NULL,
  `order_joborder_id` int(11) DEFAULT NULL,
  `order_walkinorder_id` int(11) DEFAULT NULL,
  `order_purchaseorder_qty` int(11) NOT NULL,
  `order_unit` varchar(45) NOT NULL,
  `order_prod_detail` int(11) NOT NULL,
  PRIMARY KEY (`order_details_id`),
  KEY `purchase_order_id_idx` (`order_purchaseorder_id`),
  KEY `walkinorder_id_idx` (`order_walkinorder_id`),
  KEY `job_order_id_idx` (`order_joborder_id`),
  CONSTRAINT `job_order_id` FOREIGN KEY (`order_joborder_id`) REFERENCES `job_order` (`job_order_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `purchase_order_id` FOREIGN KEY (`order_purchaseorder_id`) REFERENCES `customer_purchase_order` (`purchase_order_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `walkinorder_id` FOREIGN KEY (`order_walkinorder_id`) REFERENCES `walkin_order` (`walkinorder_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_details`
--

LOCK TABLES `order_details` WRITE;
/*!40000 ALTER TABLE `order_details` DISABLE KEYS */;
INSERT INTO `order_details` VALUES (73,NULL,64,NULL,50,'bottle',13),(74,NULL,NULL,12,30,'bottle',13),(75,48,NULL,NULL,50,'bottle',13),(76,49,NULL,NULL,500,'box',11);
/*!40000 ALTER TABLE `order_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_quantity` int(11) NOT NULL,
  `product_accessed_by` varchar(30) NOT NULL,
  `product_accessed_date` date NOT NULL,
  `product_joid` int(11) NOT NULL,
  `product_detailid` int(11) NOT NULL,
  PRIMARY KEY (`product_id`),
  KEY `product_joid_idx` (`product_joid`),
  KEY `product_detailid_idx` (`product_detailid`),
  CONSTRAINT `product_detailid` FOREIGN KEY (`product_detailid`) REFERENCES `products_detail` (`product_detail_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `product_joid` FOREIGN KEY (`product_joid`) REFERENCES `job_order` (`job_order_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=30073 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (30072,100,'dlsu','2017-07-29',64,13);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products_detail`
--

DROP TABLE IF EXISTS `products_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products_detail` (
  `product_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(45) NOT NULL,
  `product_price` decimal(10,5) NOT NULL,
  `product_ingredient_id` int(11) NOT NULL,
  PRIMARY KEY (`product_detail_id`),
  KEY `product_ingredient_id_idx` (`product_ingredient_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products_detail`
--

LOCK TABLES `products_detail` WRITE;
/*!40000 ALTER TABLE `products_detail` DISABLE KEYS */;
INSERT INTO `products_detail` VALUES (9,'VIctoria Laundry Soap',75.00000,22),(10,'Gugo Shampoo',175.00000,23),(11,'Coco Loco',20.00000,22),(12,'Petal Extract Lotion',125.00000,24),(13,'Back Massage Oil',45.00000,25),(14,'Gugo Shampoo',175.00000,26);
/*!40000 ALTER TABLE `products_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rawmats`
--

DROP TABLE IF EXISTS `rawmats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rawmats` (
  `rawmats_id` int(11) NOT NULL AUTO_INCREMENT,
  `rawmats_quantity` int(11) NOT NULL,
  `rawmats_unit` varchar(50) NOT NULL,
  `rawmats_ingredient_id` int(11) NOT NULL,
  `rawmats_supplierpurchaseorder_id` int(11) NOT NULL,
  PRIMARY KEY (`rawmats_id`),
  KEY `fk_rawmats_ingredient1_idx` (`rawmats_ingredient_id`),
  KEY `supplier_purchaseorder_id_idx` (`rawmats_supplierpurchaseorder_id`),
  CONSTRAINT `fk_rawmats_ingredient1` FOREIGN KEY (`rawmats_ingredient_id`) REFERENCES `ingredient` (`ingredient_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `rawmats_supplierpurchaseorder_id` FOREIGN KEY (`rawmats_supplierpurchaseorder_id`) REFERENCES `suppliers_purchase_order` (`supplier_purchaseorder_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=20015 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rawmats`
--

LOCK TABLES `rawmats` WRITE;
/*!40000 ALTER TABLE `rawmats` DISABLE KEYS */;
INSERT INTO `rawmats` VALUES (20011,20,'bottle',26,40017),(20012,50,'bottle',26,40018),(20013,15,'bottle',22,40019),(20014,45,'bottle',22,40020);
/*!40000 ALTER TABLE `rawmats` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `suppliers`
--

DROP TABLE IF EXISTS `suppliers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `suppliers` (
  `supplier_id` int(11) NOT NULL AUTO_INCREMENT,
  `supplier_name` varchar(50) NOT NULL,
  `supplier_contactperson` varchar(50) NOT NULL,
  `supplier_contactNum` varchar(11) NOT NULL,
  PRIMARY KEY (`supplier_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `suppliers`
--

LOCK TABLES `suppliers` WRITE;
/*!40000 ALTER TABLE `suppliers` DISABLE KEYS */;
INSERT INTO `suppliers` VALUES (5,'Laguna Coconut Plant','Juan Dela Cruz','09168871568'),(6,'Gugo Farms','Pedro San Juan','09271249521'),(7,'Flower Shop','Bella Gumamela','09327563245'),(8,'Fragrance Corp.','Rodrigo Pillar','09274567221'),(9,'Bottle Inc.','Andrew Fernandez','09265532908');
/*!40000 ALTER TABLE `suppliers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `suppliers_purchase_order`
--

DROP TABLE IF EXISTS `suppliers_purchase_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `suppliers_purchase_order` (
  `supplier_purchaseorder_id` int(11) NOT NULL AUTO_INCREMENT,
  `supplier_id` int(11) NOT NULL,
  `supplier_accessed_by` varchar(30) NOT NULL,
  `supplier_accessed_date` date NOT NULL,
  `supplier_trackID` int(6) NOT NULL,
  PRIMARY KEY (`supplier_purchaseorder_id`),
  KEY `fk_suppliers_purchase order_suppliers1_idx` (`supplier_id`),
  CONSTRAINT `fk_suppliers_purchase order_suppliers1` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`supplier_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=40021 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `suppliers_purchase_order`
--

LOCK TABLES `suppliers_purchase_order` WRITE;
/*!40000 ALTER TABLE `suppliers_purchase_order` DISABLE KEYS */;
INSERT INTO `suppliers_purchase_order` VALUES (40017,9,'dlsu','2017-07-29',467812),(40018,9,'dlsu','2017-07-29',754930),(40019,5,'dlsu','2017-07-29',590973),(40020,5,'dlsu','2017-07-29',155754);
/*!40000 ALTER TABLE `suppliers_purchase_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `usertype` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` text NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,102,'admin','caf1a3dfb505ffed0d024130f58c5cfa'),(2,101,'dlsu','202cb962ac59075b964b07152d234b70'),(3,101,'employee','5f4dcc3b5aa765d61d8327deb882cf99');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `walkin_order`
--

DROP TABLE IF EXISTS `walkin_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `walkin_order` (
  `walkinorder_id` int(11) NOT NULL AUTO_INCREMENT,
  `walkin_date_accessed` date NOT NULL,
  `walkin_accessed_by` varchar(45) NOT NULL,
  `walkin_trackID` int(6) NOT NULL,
  PRIMARY KEY (`walkinorder_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `walkin_order`
--

LOCK TABLES `walkin_order` WRITE;
/*!40000 ALTER TABLE `walkin_order` DISABLE KEYS */;
INSERT INTO `walkin_order` VALUES (8,'2017-07-29','dlsu',812474),(9,'2017-07-29','dlsu',665782),(10,'2017-07-29','dlsu',269749),(11,'2017-07-29','dlsu',797465),(12,'2017-07-29','dlsu',456986);
/*!40000 ALTER TABLE `walkin_order` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-07-31 10:41:33
