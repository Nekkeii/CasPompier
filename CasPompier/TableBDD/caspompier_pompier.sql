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
-- Table structure for table `pompier`
--

DROP TABLE IF EXISTS `pompier`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pompier` (
  `Matricule` int(11) NOT NULL,
  `Nom` varchar(255) DEFAULT NULL,
  `Prenom` varchar(255) DEFAULT NULL,
  `DateNaiss` varchar(255) DEFAULT NULL,
  `Tel` varchar(20) DEFAULT NULL,
  `Sexe` varchar(10) DEFAULT NULL,
  `grade_id` int(11) DEFAULT NULL,
  `caserne` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Matricule`),
  KEY `id` (`grade_id`),
  CONSTRAINT `pompier_ibfk_1` FOREIGN KEY (`grade_id`) REFERENCES `grade` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pompier`
--

LOCK TABLES `pompier` WRITE;
/*!40000 ALTER TABLE `pompier` DISABLE KEYS */;
INSERT INTO `pompier` VALUES (10001,'Navas','KeyloRT','1986-12-15','0123456789','M',1,'1'),(10002,'Marquinhos','Marcos','1994-05-14','0123456798','M',2,'1'),(10003,'Mbappé','Kylian','1998-12-20','0123456797','M',3,'1'),(10011,'Griezmann','Antoine','1991-03-21','0605040302','M',1,'1'),(10012,'Griezmann','Antoine','1991-03-21','0605040302','M',1,'1'),(10013,'Pogba','Paul','1993-03-15','0607080910','M',1,'1'),(20001,'Verratti','patrick','1992-11-05','0123456796','M',1,'2'),(20002,'Hakimi','Achraf','1998-11-04','0123456795','M',2,'2'),(20003,'Neymar','Jr','1992-02-05','0123456794','M',3,'2'),(20011,'Lloris','Hugo','1986-12-26','0708091011','M',1,'2'),(20012,'Varane','Raphael','1993-04-25','0712131415','M',1,'2'),(20013,'Kante','N’Golo','1991-03-29','0816191718','M',1,'2'),(30001,'Messi','Lionel','1987-06-24','0123456798','M',1,'3'),(30002,'Di María','Ángel','1988-02-14','0123456792','M',2,'3'),(30003,'Ramos','Sergio','1986-03-30','0123456791','M',3,'3'),(30011,'Messi','Lionel','1987-06-24','0123456793','M',1,'3'),(30012,'Giroud','Olivier','1986-09-30','1011121314','M',1,'3'),(30013,'Coman','Kingsley','1996-06-13','1314151617','M',1,'3'),(124815,'Siala','Juan','2017-01-05','0725653562','homme',13,NULL),(125456,'ezafag','Khamzat','2024-03-01','0725653562','homme',11,NULL),(125478,'ANAs','barca','1999-09-15','0663623505','M',13,'3'),(145236,'BENZEMA','karim','1997-09-15','0663623500','M',12,'1'),(145638,'SIALO','jâd','2004-09-15','0636254111','M',6,'1'),(147896,'RONALDO','cristiano','2000-09-15','0663623500','M',12,'2'),(654352,'Clette','lara','1987-03-11','642786352','féminin',3,NULL),(782312,'Esur','janette','1982-02-11','627371273','féminin',3,NULL),(786572,'Abri','gauthier','1972-05-12','676542532','masculin',10,NULL),(789654,'siala','jad','2004-09-15','066326530','M',13,NULL),(876543,'TEST','TEST','2022-10-18','872615253','masculin',2,NULL),(887769,'Etaitsur','syLVain','2022-09-30','676256352','masculin',11,NULL),(887799,'Inion','sébastien','2022-09-30','676256352','masculin',11,NULL),(898989,'Douard','JEAN','1986-09-15','676256352','masculin',9,NULL),(920372,'Lutin','Michel','2022-09-30','676256352','masculin',1,NULL),(920379,'Quenouille','Marc','2022-09-30','676256352','masculin',1,NULL),(963963,'caca','pipi','2004-09-15','066326530','M',13,NULL),(982726,'Milou','Tintin','1970-10-10','99878998','masculin',10,NULL),(986995,'Dumontel','Robert','1969-10-10','298568542','masculin',11,NULL),(992312,'Balle','Jean','1982-07-12','678652354','masculin',2,NULL),(1254565,'ezafag','Khamzat','2024-03-01','0725653562','homme',11,NULL),(1458956,'veratti','phillipe','2004-09-15','0663623500','M',13,'3'),(2646594,'herheri','zerrzet','2023-11-30','0725653562','homme',4,NULL),(2147483647,'ezafag','Juan','2023-09-07','0725653562','homme',13,NULL);
/*!40000 ALTER TABLE `pompier` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=``*/ /*!50003 TRIGGER AfterPompierDelete
AFTER DELETE ON pompier
FOR EACH ROW
BEGIN
    INSERT INTO pompiersupprime (Matricule, Nom, Prenom, DateNaiss, Tel, Sexe, grade_id, caserne, dateSuppression)
    VALUES (OLD.Matricule, OLD.Nom, OLD.Prenom, OLD.DateNaiss, OLD.Tel, OLD.Sexe, OLD.grade_id, OLD.caserne, NOW());
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-05-07 10:53:17
