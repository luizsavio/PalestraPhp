
-- MySQL dump 10.13  Distrib 5.7.9, for Win64 (x86_64)
--
-- Host: localhost    Database: faculdadepalestra
-- ------------------------------------------------------
-- Server version	5.7.12-log

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
-- Table structure for table `palestra`
--

DROP TABLE IF EXISTS `palestra`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `palestra` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `data` datetime NOT NULL,
  `palestrante` varchar(100) NOT NULL,
  `del` bit(1) DEFAULT b'0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `palestra`
--

LOCK TABLES `palestra` WRITE;
/*!40000 ALTER TABLE `palestra` DISABLE KEYS */;
INSERT INTO `palestra` VALUES (1,'Inspiração como ação para conduzir uma equipe de sucesso','2018-10-28 00:00:00','Simon Sinek','\0'),(2,'Um dos melhores palestrantes em atividade no Brasil','2018-10-29 00:00:00','Bernardinho','\0'),(3,'Testeq','2018-10-20 00:00:00','Savio',''),(4,'Teste25','2018-10-26 00:00:00','Bruno',''),(5,'hehe2','2018-10-20 00:00:00','Savio',''),(6,'222eeee','2018-10-27 00:00:00','Savim',''),(7,'Chato12','2018-10-27 00:00:00','Savim',''),(8,'gggggggggg2','2018-10-25 00:00:00','Savio','');
/*!40000 ALTER TABLE `palestra` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `participante`
--

DROP TABLE IF EXISTS `participante`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `participante` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `celular` varchar(11) DEFAULT NULL,
  `idpalestra` int(11) NOT NULL,
  `del` bit(1) DEFAULT b'0',
  PRIMARY KEY (`id`),
  KEY `fk-palestra_idx` (`idpalestra`),
  CONSTRAINT `fk-palestra` FOREIGN KEY (`idpalestra`) REFERENCES `palestra` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `participante`
--

LOCK TABLES `participante` WRITE;
/*!40000 ALTER TABLE `participante` DISABLE KEYS */;
INSERT INTO `participante` VALUES (1,'Luiz Savio','luizsavio2009@hotmail.com','28999555184',1,''),(2,'Edilaine Spilaris Pessin','edilaine.fje65@gmail.com','28999999999',1,''),(3,'Marcio Spilares Secate','luizsavio2009@hotmail.com','28999999999',1,''),(4,'Malta Spilares','malta.spil@gmail.com','28999999999',1,''),(5,'Luiz Savio Spilares de Moraes','luizsavio2009@hotmail.com','28999555184',8,'\0'),(6,'Edilaine Spilaris Pessin','edilaine.fje65@gmail.com','28999999999',8,''),(7,'Marcio Spilares Secate','luizsavio2009@hotmail.com','28999999999',8,''),(8,'Edilaine Spilaris Pessin','edilaine.fje65@gmail.com','28999555184',8,''),(9,'Marcio Spilares Secate','luizsavio2009@hotmail.com','28999999999',8,''),(10,'Marcio Spilares Secate','luizsavio2009@hotmail.com','28999999999',8,''),(11,'Marcio Spilares Secate','luizsavio2009@hotmail.com','28999999999',8,''),(12,'Marcio Spilares Secate','luizsavio2009@hotmail.com','28999999999',8,''),(13,'Marcio Spilares Secate','luizsavio2009@hotmail.com','28999999999',8,''),(14,'Marcio Spilares Secate','luizsavio2009@hotmail.com','28999999999',8,''),(15,'Marcio Spilares Secate','luizsavio2009@hotmail.com','28999999999',8,''),(16,'Marcio Spilares Secate','luizsavio2009@hotmail.com','28999999999',8,''),(17,'Marcio Spilares Secate','luizsavio2009@hotmail.com','28999999999',8,''),(18,'Marcio Spilares Secate','luizsavio2009@hotmail.com','28999999999',8,''),(19,'Marcio Spilares Secate','luizsavio2009@hotmail.com','28999999999',8,''),(20,'Marcio Spilares Secate','luizsavio2009@hotmail.com','28999999999',8,''),(21,'Marcio Spilares Secate','luizsavio2009@hotmail.com','28999999999',8,''),(22,'Marcio Spilares Secate','luizsavio2009@hotmail.com','28999999999',8,''),(23,'Marcio Spilares Secate','luizsavio2009@hotmail.com','28999999999',8,''),(24,'Marcio Spilares Secate','luizsavio2009@hotmail.com','28999999999',8,''),(25,'Marcio Spilares Secate','luizsavio2009@hotmail.com','28999999999',8,''),(26,'Marcio Spilares Secate','luizsavio2009@hotmail.com','28999999999',8,''),(27,'Marcio Spilares Secate','luizsavio2009@hotmail.com','28999999999',8,'\0'),(28,'Marcio Spilares Secate','luizsavio2009@hotmail.com','28999999999',8,''),(29,'Luiz Savio Spilares de Moraes','luizsavio2009@hotmail.com','28999555184',5,'\0'),(30,'Malta Spilares','luizsavio2009@hotmail.com','28999999999',5,'\0'),(31,'Marcio Spilares Secate','luizsavio2009@hotmail.com','28999555184',5,'\0'),(32,'Luiz Savio Spilares de Moraes','luizsavio2009@hotmail.com','28999999999',5,'\0'),(33,'Luiz Savio Spilares de Moraes','luizsavio2009@hotmail.com','28999555184',5,'\0'),(34,'Edilaine Spilaris Pessin','edilaine.fje65@gmail.com','28999999999',5,'\0');
/*!40000 ALTER TABLE `participante` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'faculdadepalestra'
--

--
-- Dumping routines for database 'faculdadepalestra'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-10-21  2:23:44
