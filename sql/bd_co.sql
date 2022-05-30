CREATE DATABASE  IF NOT EXISTS `bd_co` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `bd_co`;
-- MySQL dump 10.13  Distrib 5.5.16, for Win32 (x86)
--
-- Host: localhost    Database: bd_co
-- ------------------------------------------------------
-- Server version	5.5.27

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
-- Table structure for table `ambiente`
--

DROP TABLE IF EXISTS `ambiente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ambiente` (
  `idamb` int(3) NOT NULL AUTO_INCREMENT,
  `nome` varchar(15) NOT NULL,
  `descricao` varchar(30) NOT NULL,
  PRIMARY KEY (`idamb`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ambiente`
--

LOCK TABLES `ambiente` WRITE;
/*!40000 ALTER TABLE `ambiente` DISABLE KEYS */;
INSERT INTO `ambiente` VALUES (1,'coberto','ambiente coberto para determin'),(2,'descoberto','ambiente descoberto');
/*!40000 ALTER TABLE `ambiente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `centro_endereco`
--

DROP TABLE IF EXISTS `centro_endereco`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `centro_endereco` (
  `id_cen` int(3) NOT NULL,
  `id_end` int(3) NOT NULL,
  PRIMARY KEY (`id_cen`,`id_end`),
  KEY `id_end` (`id_end`),
  CONSTRAINT `centro_endereco_ibfk_1` FOREIGN KEY (`id_cen`) REFERENCES `centroesportivo` (`idcen`),
  CONSTRAINT `centro_endereco_ibfk_2` FOREIGN KEY (`id_end`) REFERENCES `endereco` (`idEnd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `centro_endereco`
--

LOCK TABLES `centro_endereco` WRITE;
/*!40000 ALTER TABLE `centro_endereco` DISABLE KEYS */;
/*!40000 ALTER TABLE `centro_endereco` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `centro_telefone`
--

DROP TABLE IF EXISTS `centro_telefone`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `centro_telefone` (
  `id_cen` int(3) NOT NULL,
  `id_tel` int(3) NOT NULL,
  PRIMARY KEY (`id_cen`,`id_tel`),
  KEY `id_tel` (`id_tel`),
  CONSTRAINT `centro_telefone_ibfk_1` FOREIGN KEY (`id_cen`) REFERENCES `centroesportivo` (`idcen`),
  CONSTRAINT `centro_telefone_ibfk_2` FOREIGN KEY (`id_tel`) REFERENCES `telefone` (`idtel`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `centro_telefone`
--

LOCK TABLES `centro_telefone` WRITE;
/*!40000 ALTER TABLE `centro_telefone` DISABLE KEYS */;
/*!40000 ALTER TABLE `centro_telefone` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `centroesportivo`
--

DROP TABLE IF EXISTS `centroesportivo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `centroesportivo` (
  `idCen` int(3) NOT NULL AUTO_INCREMENT,
  `cidade` varchar(20) NOT NULL,
  `diretor` varchar(20) NOT NULL,
  `telefone` varchar(14) NOT NULL,
  `email` varchar(25) NOT NULL,
  PRIMARY KEY (`idCen`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `centroesportivo`
--

LOCK TABLES `centroesportivo` WRITE;
/*!40000 ALTER TABLE `centroesportivo` DISABLE KEYS */;
INSERT INTO `centroesportivo` VALUES (1,'Ceilandia','Andre','1233123','centrocei@gmail.com'),(2,'Setor O','Elaine','4351312','centroo@gmail.com'),(3,'Riacho Fundo 1','Thiago','1232133','centrori@gmail.com'),(4,'Samambaia Sul','Felipe','1231232','centrosamb@gmail.com'),(5,'Recanto das Emas','Amanda','3233232','centrorec@gmail.com');
/*!40000 ALTER TABLE `centroesportivo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `endereco`
--

DROP TABLE IF EXISTS `endereco`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `endereco` (
  `idEnd` int(3) NOT NULL AUTO_INCREMENT,
  `cep` varchar(10) NOT NULL,
  `rua` varchar(45) NOT NULL,
  `bairro` varchar(40) NOT NULL,
  `cidade` varchar(10) NOT NULL,
  `casa` int(5) NOT NULL,
  PRIMARY KEY (`idEnd`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `endereco`
--

LOCK TABLES `endereco` WRITE;
/*!40000 ALTER TABLE `endereco` DISABLE KEYS */;
INSERT INTO `endereco` VALUES (18,'72.215-197','QNM 19 Conjunto G','Ceilândia Sul (Ceilândia)','Brasília',85),(19,'72.220-203','QNN 20 Conjunto C','Ceilândia Sul (Ceilândia)','Brasília',25);
/*!40000 ALTER TABLE `endereco` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inscricao`
--

DROP TABLE IF EXISTS `inscricao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inscricao` (
  `idins` int(3) NOT NULL AUTO_INCREMENT,
  `id_usu` int(3) DEFAULT NULL,
  `id_tur` int(3) DEFAULT NULL,
  `dataIns` timestamp NULL DEFAULT NULL,
  `horaIns` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idins`),
  KEY `id_usu` (`id_usu`),
  KEY `id_tur` (`id_tur`),
  CONSTRAINT `inscricao_ibfk_1` FOREIGN KEY (`id_usu`) REFERENCES `usuario` (`id`),
  CONSTRAINT `inscricao_ibfk_2` FOREIGN KEY (`id_tur`) REFERENCES `turma` (`idtur`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inscricao`
--

LOCK TABLES `inscricao` WRITE;
/*!40000 ALTER TABLE `inscricao` DISABLE KEYS */;
INSERT INTO `inscricao` VALUES (1,NULL,1,'2018-06-08 20:59:17','2018-06-08 20:59:17'),(2,23,9,'2018-06-08 21:00:00','2018-06-08 21:00:00');
/*!40000 ALTER TABLE `inscricao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `modalidade`
--

DROP TABLE IF EXISTS `modalidade`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `modalidade` (
  `idMod` int(3) NOT NULL AUTO_INCREMENT,
  `nome` varchar(26) NOT NULL,
  `descricao` varchar(40) NOT NULL,
  `id_amb` int(3) DEFAULT NULL,
  PRIMARY KEY (`idMod`),
  KEY `id_amb` (`id_amb`),
  CONSTRAINT `modalidade_ibfk_1` FOREIGN KEY (`id_amb`) REFERENCES `ambiente` (`idamb`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `modalidade`
--

LOCK TABLES `modalidade` WRITE;
/*!40000 ALTER TABLE `modalidade` DISABLE KEYS */;
INSERT INTO `modalidade` VALUES (4,'Futsal','',NULL),(5,'Vôlei','',NULL),(6,'Karatê','',NULL),(7,'Atletismo','',NULL),(8,'Natação','',NULL),(9,'Basquetebol','',NULL),(10,'Futebol Society','',NULL),(11,'Futebol de Areia','',NULL),(12,'Handebol','',NULL),(13,'Ginastica Local','',NULL),(14,'Hidroginástica','',NULL),(15,'Atividade Física Orientada','',NULL),(16,'Jiu-Jitsu','',NULL),(17,'Ginástica Ritmica','',NULL),(18,'Tênis','',NULL),(19,'Judô','',NULL),(20,'Ginástica Acrobática','',NULL),(21,'Ginástica Artistica','',NULL),(22,'Pilates','',NULL),(23,'Boxe','',NULL),(24,'Saltos Ornamentais','',NULL),(25,'Dança','',NULL),(26,'Capoterapia','',NULL),(27,'Capoeira','',NULL),(28,'Corrida/Caminhada','',NULL);
/*!40000 ALTER TABLE `modalidade` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `telefone`
--

DROP TABLE IF EXISTS `telefone`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `telefone` (
  `idtel` int(3) NOT NULL AUTO_INCREMENT,
  `celular` varchar(15) DEFAULT NULL,
  `telefone` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`idtel`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `telefone`
--

LOCK TABLES `telefone` WRITE;
/*!40000 ALTER TABLE `telefone` DISABLE KEYS */;
/*!40000 ALTER TABLE `telefone` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `turma`
--

DROP TABLE IF EXISTS `turma`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `turma` (
  `idtur` int(3) NOT NULL AUTO_INCREMENT,
  `dias` varchar(20) NOT NULL,
  `turno` varchar(20) NOT NULL,
  `faixaEtaria` varchar(10) NOT NULL,
  `horario` varchar(30) NOT NULL,
  `id_mod` int(3) DEFAULT NULL,
  `id_cen` int(3) DEFAULT NULL,
  PRIMARY KEY (`idtur`),
  KEY `id_mod` (`id_mod`),
  KEY `id_cen` (`id_cen`),
  CONSTRAINT `turma_ibfk_1` FOREIGN KEY (`id_mod`) REFERENCES `modalidade` (`idMod`),
  CONSTRAINT `turma_ibfk_2` FOREIGN KEY (`id_cen`) REFERENCES `centroesportivo` (`idCen`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `turma`
--

LOCK TABLES `turma` WRITE;
/*!40000 ALTER TABLE `turma` DISABLE KEYS */;
INSERT INTO `turma` VALUES (1,'Segunda e Quinta','Vespertino','12 aos 18','14:00 as 16:00',4,1),(2,'Terça e Sexta','Matutino','06 aos 10','09:00 as 11:00',6,2),(3,'Segunda e Terça','Noturno','12 aos 18','19:00 as 21:00',12,4),(4,'Segunda e Quinta','Vespertino','12 aos 18','14:00 as 16:00',4,2),(5,'Segunda e Quinta','Vespertino','12 aos 18','14:00 as 16:00',4,4),(6,'Segunda e Quinta','Vespertino','12 aos 18','14:00 as 16:00',4,5),(7,'Segunda e Quinta','Vespertino','12 aos 18','14:00 as 16:00',4,3),(8,'Terça e Sexta','Matutino','12 aos 18','09:00 as 11:00',5,1),(9,'Terça e Sexta','Matutino','12 aos 18','09:00 as 11:00',5,2),(10,'Terça e Sexta','Matutino','12 aos 18','09:00 as 11:00',5,3),(11,'Terça e Sexta','Matutino','12 aos 18','09:00 as 11:00',5,4),(12,'Terça e Sexta','Matutino','12 aos 18','09:00 as 11:00',5,5);
/*!40000 ALTER TABLE `turma` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) NOT NULL,
  `login` varchar(15) NOT NULL,
  `senha` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `telefone` varchar(15) DEFAULT NULL,
  `dataNasc` varchar(10) NOT NULL,
  `cpf` varchar(15) NOT NULL,
  `genero` varchar(1) NOT NULL,
  `perfil` varchar(15) NOT NULL,
  `celular` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (22,'Administrador','adm','123','adm@gmail.com','(61) 3463-3689','1991-02-05','654.926.154-69','m','administrador','(61) 94564-8156'),(23,'Aluno','aluno','123','aluno@gmail.com','(31) 5816-5416','2000-10-23','186.651.651-56','m','usuario','(61) 94546-1516');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario_ambiente`
--

DROP TABLE IF EXISTS `usuario_ambiente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario_ambiente` (
  `id_usu` int(3) NOT NULL,
  `id_amb` int(3) NOT NULL,
  PRIMARY KEY (`id_usu`,`id_amb`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario_ambiente`
--

LOCK TABLES `usuario_ambiente` WRITE;
/*!40000 ALTER TABLE `usuario_ambiente` DISABLE KEYS */;
/*!40000 ALTER TABLE `usuario_ambiente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario_centro`
--

DROP TABLE IF EXISTS `usuario_centro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario_centro` (
  `id_usu` int(3) NOT NULL,
  `id_cen` int(3) NOT NULL,
  PRIMARY KEY (`id_usu`,`id_cen`),
  KEY `id_cen` (`id_cen`),
  CONSTRAINT `usuario_centro_ibfk_1` FOREIGN KEY (`id_usu`) REFERENCES `usuario` (`id`),
  CONSTRAINT `usuario_centro_ibfk_2` FOREIGN KEY (`id_cen`) REFERENCES `centroesportivo` (`idCen`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario_centro`
--

LOCK TABLES `usuario_centro` WRITE;
/*!40000 ALTER TABLE `usuario_centro` DISABLE KEYS */;
/*!40000 ALTER TABLE `usuario_centro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario_endereco`
--

DROP TABLE IF EXISTS `usuario_endereco`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario_endereco` (
  `id_usuario` int(3) NOT NULL,
  `id_ende` int(3) NOT NULL,
  PRIMARY KEY (`id_usuario`,`id_ende`),
  KEY `fk_usuario_has_endereco_endereco1_idx` (`id_ende`),
  KEY `fk_usuario_has_endereco_usuario_idx` (`id_usuario`),
  CONSTRAINT `fk_usuario_has_endereco_endereco1` FOREIGN KEY (`id_ende`) REFERENCES `endereco` (`idEnd`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario_endereco`
--

LOCK TABLES `usuario_endereco` WRITE;
/*!40000 ALTER TABLE `usuario_endereco` DISABLE KEYS */;
INSERT INTO `usuario_endereco` VALUES (22,18),(23,19);
/*!40000 ALTER TABLE `usuario_endereco` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario_telefone`
--

DROP TABLE IF EXISTS `usuario_telefone`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario_telefone` (
  `id_usu` int(3) NOT NULL,
  `id_tel` int(3) NOT NULL,
  PRIMARY KEY (`id_usu`,`id_tel`),
  KEY `id_tel` (`id_tel`),
  CONSTRAINT `usuario_telefone_ibfk_1` FOREIGN KEY (`id_usu`) REFERENCES `usuario` (`id`),
  CONSTRAINT `usuario_telefone_ibfk_2` FOREIGN KEY (`id_tel`) REFERENCES `telefone` (`idtel`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario_telefone`
--

LOCK TABLES `usuario_telefone` WRITE;
/*!40000 ALTER TABLE `usuario_telefone` DISABLE KEYS */;
/*!40000 ALTER TABLE `usuario_telefone` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-06-08 18:04:35
