-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: caspompier
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

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
-- Table structure for table `engin`
--

DROP TABLE IF EXISTS `engin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `engin` (
  `Numéro` int(11) NOT NULL,
  `Caserne_id` int(11) NOT NULL,
  `Type_Engin_id` varchar(255) NOT NULL,
  `Stock` int(11) DEFAULT 0,
  `Image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Numéro`,`Caserne_id`,`Type_Engin_id`),
  KEY `Caserne_id` (`Caserne_id`),
  KEY `Type_Engin_id` (`Type_Engin_id`),
  CONSTRAINT `engin_ibfk_1` FOREIGN KEY (`Caserne_id`) REFERENCES `caserne` (`id`),
  CONSTRAINT `engin_ibfk_2` FOREIGN KEY (`Type_Engin_id`) REFERENCES `type_engin` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `engin`
--

LOCK TABLES `engin` WRITE;
/*!40000 ALTER TABLE `engin` DISABLE KEYS */;
INSERT INTO `engin` VALUES (66666,1,'VMA',999,'../imageDesEngins/fourgon pompe-tonne.webp'),(659847,2,'VL',6,'../imageDesEngins/Véhicule Léger.JPG');
/*!40000 ALTER TABLE `engin` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-05-07 10:53:17
