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
-- Table structure for table `pompiersupprime`
--

DROP TABLE IF EXISTS `pompiersupprime`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pompiersupprime` (
  `Matricule` int(11) NOT NULL,
  `Nom` varchar(255) DEFAULT NULL,
  `Prenom` varchar(255) DEFAULT NULL,
  `DateNaiss` varchar(255) DEFAULT NULL,
  `Tel` varchar(20) DEFAULT NULL,
  `Sexe` varchar(10) DEFAULT NULL,
  `grade_id` int(11) DEFAULT NULL,
  `caserne` varchar(255) DEFAULT NULL,
  `dateSuppression` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`Matricule`),
  KEY `id` (`grade_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pompiersupprime`
--

LOCK TABLES `pompiersupprime` WRITE;
/*!40000 ALTER TABLE `pompiersupprime` DISABLE KEYS */;
INSERT INTO `pompiersupprime` VALUES (145568,'kakakakooo','lololaa','2000-09-15','06663625214','F',13,'1','2024-04-30 11:57:00'),(145698,'TEST','tets','2004-09-15','789658478','M',12,'2','2024-04-29 23:43:30'),(145879,'LOPMO','vava','2004-09-15','11111111111','F',10,'1','2024-04-29 23:43:26'),(145963,'siala','yakidine','2004-09-15','066325478','M',11,'1','2024-04-30 00:03:23'),(147832,'SIALA','jad','2004-09-15','0663623500','M',11,'3','2024-05-01 18:55:16'),(147896,'OOOOOO','44','2004-09-15','0663623500','M',13,'2','2024-04-29 23:43:34'),(569823,'VITINHA','koklo','2004-09-15','0663625369','M',13,'1','2024-04-29 23:43:27'),(4587963,'SIALA','jad','2004-09-15','0663623500','M',9,'3','2024-04-30 01:27:58');
/*!40000 ALTER TABLE `pompiersupprime` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-05-07 10:53:18
