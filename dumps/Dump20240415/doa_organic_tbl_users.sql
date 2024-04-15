-- MySQL dump 10.13  Distrib 8.0.29, for Win64 (x86_64)
--
-- Host: localhost    Database: doa_organic
-- ------------------------------------------------------
-- Server version	8.0.29

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `tbl_users`
--

DROP TABLE IF EXISTS `tbl_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_users` (
  `idtbl_users` int NOT NULL AUTO_INCREMENT,
  `full_name` varchar(80) NOT NULL,
  `email_address` varchar(45) NOT NULL,
  `phone_no` varchar(10) NOT NULL,
  `farmer_address` varchar(100) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  `locations` varchar(45) NOT NULL,
  `user_type` int DEFAULT '0',
  PRIMARY KEY (`idtbl_users`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_users`
--

LOCK TABLES `tbl_users` WRITE;
/*!40000 ALTER TABLE `tbl_users` DISABLE KEYS */;
INSERT INTO `tbl_users` VALUES (1,'Aruna Shantha','aruna@gmail.com','0701779440','_na','$2y$10$xUOe08WDXz4PsBL4.jeQ9Ou7I/bpHx.dj6Tp4qvMebSfc.H8k62vm','nuwara_eliya',2),(2,'Farmar 01','aa@gmail.com','0701779440','0701779440','$2y$10$fonExBhxc52I.RHvmJg6d.aY0ASK9V49c3hgs7omEdPOJvTzLNPR6','colombo',0),(3,'Aruna Shantha','aaa@gmail.com','0701779440','Kegalla Rd.\r\nkegalla','$2y$10$uqlBBleZ5n4YwgrFZZE1me64smVNuPROEX6vQ3G60AHaXoHDNyZeG','kegalla',0),(4,'0701779440','0701779440@gmail.com','0701779440','0701779440','$2y$10$qKMQIHVI66hWJZbYOo3MruqZWI8tLH/eaUzvfq5EHOGY6KWsewou.','colombo',0),(5,'Aruna Shantha','aaa@gmail.com','0701779440','aaa','$2y$10$wvsoWXg.FAbnYmprNu0UkeCp.D8YQz4dvxYUosGwAK5eE3ErK6msy','colombo',0),(6,'Aruna Shantha','aasaa@gmail.com','0701779440','asd','$2y$10$pLZliFdlryph85ev7jEs1OyemfIs6JgZ4mYNt1dUQ6nj7PCg7uiLS','colombo',0);
/*!40000 ALTER TABLE `tbl_users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-04-15 13:46:33
