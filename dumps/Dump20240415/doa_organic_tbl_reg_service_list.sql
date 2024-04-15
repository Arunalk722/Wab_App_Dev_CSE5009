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
-- Table structure for table `tbl_reg_service_list`
--

DROP TABLE IF EXISTS `tbl_reg_service_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_reg_service_list` (
  `idtbl_reg_serviceList` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `location_name` varchar(45) NOT NULL,
  `sel_service` varchar(45) NOT NULL,
  `add_mg` varchar(500) NOT NULL,
  `reg_time` datetime NOT NULL,
  PRIMARY KEY (`idtbl_reg_serviceList`),
  KEY `loc_name_idx_idx` (`location_name`),
  CONSTRAINT `loc_name_idx` FOREIGN KEY (`location_name`) REFERENCES `tbl_location_list` (`location_name`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_reg_service_list`
--

LOCK TABLES `tbl_reg_service_list` WRITE;
/*!40000 ALTER TABLE `tbl_reg_service_list` DISABLE KEYS */;
INSERT INTO `tbl_reg_service_list` VALUES (20,2,'kegalla','consultation','SS','2024-04-15 01:53:38'),(22,2,'colombo','consultation','jhj','2024-04-15 02:51:29'),(23,2,'colombo','training_programs','gooodss','2024-04-15 03:19:17'),(24,2,'colombo','educational_resources','ss','2024-04-15 07:30:39'),(25,2,'kegalla','water_conservation','ss','2024-04-15 07:30:46'),(26,2,'nuwara_eliya','educational_resources','ss','2024-04-15 07:30:54');
/*!40000 ALTER TABLE `tbl_reg_service_list` ENABLE KEYS */;
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
