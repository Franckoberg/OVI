-- MySQL dump 10.13  Distrib 5.7.22, for Linux (x86_64)
--
-- Host: localhost    Database: OVI
-- ------------------------------------------------------
-- Server version	5.7.22-0ubuntu0.16.04.1

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
-- Table structure for table `etudiants`
--

DROP TABLE IF EXISTS `etudiants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `etudiants` (
  `id_etudiant` int(11) NOT NULL AUTO_INCREMENT,
  `matricule` varchar(20) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `sexe` varchar(15) NOT NULL,
  `nationalite` varchar(25) NOT NULL,
  `date_naiss` date NOT NULL,
  `lieu_naiss` text NOT NULL,
  `adresse` text NOT NULL,
  `telephone` varchar(15) NOT NULL,
  `email` varchar(200) NOT NULL,
  `status_matrimonial` varchar(100) NOT NULL,
  `prob_sante` text NOT NULL,
  `group_sanguin` varchar(4) DEFAULT NULL,
  `persapp` varchar(50) DEFAULT NULL,
  `ugctelephone` varchar(15) DEFAULT NULL,
  `ugctelephone_a` varchar(15) DEFAULT NULL,
  `ugcadresse` text,
  `ugcemail` varchar(150) DEFAULT NULL,
  `raisonetude` text,
  `sondage` varchar(30) DEFAULT NULL,
  `entitenom` varchar(50) DEFAULT NULL,
  `date_create` datetime DEFAULT NULL,
  `id_question` int(11) NOT NULL,
  `reponse` varchar(50) NOT NULL,
  `active` int(11) NOT NULL,
  PRIMARY KEY (`id_etudiant`),
  UNIQUE KEY `matricule` (`matricule`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `etudiants`
--

LOCK TABLES `etudiants` WRITE;
/*!40000 ALTER TABLE `etudiants` DISABLE KEYS */;
INSERT INTO `etudiants` VALUES (1,'2018BF-1','','Bergele','Franck','Masculin','haitienne','2017-12-07','aux-cayes','Delmas','+509 4018-6048','franckoberg@gmail.com','Celibataire','lal',NULL,'Mimose','32767223','37944361','Tabarre','mimose@yahoo.fr',NULL,'llol',NULL,'2018-08-23 11:16:52',0,'Charles Loveslyne',1),(2,'2018BF-2','','Bergele','Franck','Masculin','haitienne','2017-12-07','aux-cayes','Delmas','+509 4018-6048','franckoberg@gmail.com','Celibataire','lal','A+','Mimose','32767223','37944361','Tabarre','mimose@yahoo.fr',NULL,'llol',NULL,'2018-08-23 11:39:00',0,'Charles Loveslyne',1);
/*!40000 ALTER TABLE `etudiants` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `etudiants_options`
--

DROP TABLE IF EXISTS `etudiants_options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `etudiants_options` (
  `id_etudiant` int(11) NOT NULL,
  `id_option` int(11) NOT NULL,
  KEY `fk_etu_opt` (`id_etudiant`),
  KEY `fk_opt_etu` (`id_option`),
  CONSTRAINT `fk_etu_opt` FOREIGN KEY (`id_etudiant`) REFERENCES `etudiants` (`id_etudiant`),
  CONSTRAINT `fk_opt_etu` FOREIGN KEY (`id_option`) REFERENCES `options` (`id_option`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `etudiants_options`
--

LOCK TABLES `etudiants_options` WRITE;
/*!40000 ALTER TABLE `etudiants_options` DISABLE KEYS */;
/*!40000 ALTER TABLE `etudiants_options` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `options`
--

DROP TABLE IF EXISTS `options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `options` (
  `id_option` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `dure` int(11) NOT NULL,
  `prix` int(11) NOT NULL,
  PRIMARY KEY (`id_option`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `options`
--

LOCK TABLES `options` WRITE;
/*!40000 ALTER TABLE `options` DISABLE KEYS */;
INSERT INTO `options` VALUES (1,'Anglais',6,0),(2,'Cosmetologie',3,0);
/*!40000 ALTER TABLE `options` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `question`
--

DROP TABLE IF EXISTS `question`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `question` (
  `id_question` int(11) NOT NULL AUTO_INCREMENT,
  `question` varchar(200) NOT NULL,
  PRIMARY KEY (`id_question`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `question`
--

LOCK TABLES `question` WRITE;
/*!40000 ALTER TABLE `question` DISABLE KEYS */;
INSERT INTO `question` VALUES (1,'Quel étais votre premier numéro de telephone'),(2,'Quel est le nom de ton (ta) premier(ére) copin(e)?'),(3,'Quel est votre livre préféré?'),(4,'Quel est la marque de votre premiére voiture?'),(5,'Quel est votre chanteur préféré?'),(6,'Quelle est votre école professionnelle préféré?');
/*!40000 ALTER TABLE `question` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id_role` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id_role`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (14,'DIRECTEUR','Directeur generals'),(15,'DIRECTEUR REMPLACANT','Directeur'),(16,'DBA',''),(17,'SECRETAIRE','Secretaire');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_roles`
--

DROP TABLE IF EXISTS `user_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_roles` (
  `id_user` int(11) NOT NULL,
  `id_role` int(11) NOT NULL,
  KEY `fk_user` (`id_user`),
  KEY `fk_role` (`id_role`),
  CONSTRAINT `fk_role` FOREIGN KEY (`id_role`) REFERENCES `roles` (`id_role`) ON DELETE CASCADE,
  CONSTRAINT `fk_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_roles`
--

LOCK TABLES `user_roles` WRITE;
/*!40000 ALTER TABLE `user_roles` DISABLE KEYS */;
INSERT INTO `user_roles` VALUES (97,14),(100,17),(101,17);
/*!40000 ALTER TABLE `user_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `matricule` varchar(50) NOT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `sexe` varchar(12) DEFAULT NULL,
  `date_naiss` date DEFAULT NULL,
  `cin` varchar(25) DEFAULT NULL,
  `adresse` text,
  `email` varchar(130) DEFAULT NULL,
  `mot_de_passe` varchar(50) NOT NULL,
  `telephone` varchar(15) DEFAULT NULL,
  `nationalite` varchar(30) DEFAULT NULL,
  `fonction` varchar(100) NOT NULL,
  `maladie` varchar(255) DEFAULT NULL,
  `groupe_sanguin` varchar(4) DEFAULT NULL,
  `status_matrimonial` varchar(30) DEFAULT NULL,
  `profession` text,
  `ugpersonne_nom` varchar(50) DEFAULT NULL,
  `ugtelephone_a` varchar(15) DEFAULT NULL,
  `ugtelephone_b` varchar(15) DEFAULT NULL,
  `ugadresse` text,
  `ugemail` varchar(200) DEFAULT NULL,
  `date_create` datetime NOT NULL,
  `active` int(11) NOT NULL DEFAULT '0',
  `id_question` int(11) DEFAULT NULL,
  `reponse` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `code_unique` (`matricule`),
  KEY `fk_question` (`id_question`),
  CONSTRAINT `fk_question` FOREIGN KEY (`id_question`) REFERENCES `question` (`id_question`)
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (97,'2018BF-97',NULL,'Bergele','Franck','Masculin','1993-07-16','07099920000001746','Delmas','franckoberg@gmail.com','franckoberg','40186048','haitienne','DIRECTEUR','rine','AB-','Celibataire','Developpeur web','Mimose','37944361','32767223','Tabarre','mimose@yahoo.fr','2018-08-01 10:15:08',1,NULL,'Hacking 2010'),(100,'2018JK-100',NULL,'Jean','Kevin','Masculin','1997-02-12','01019702331190','Duval30 ruelle nono prolonger #24','rhodsandkevin254@gmail.com','Stania1997',' 31860178','Haitienne','SECRETAIRE','rien','AB+','Celibataire','Benevole en PSCR','Marc Andre Cadostin',' 37281077',' 34110360','Marin 24 #8','Marcac123@gmail.com','2018-08-01 12:59:11',1,2,'Charles Loveslyne'),(101,'2018SP-101',NULL,'Sterline','Poteau','Masculin',NULL,NULL,NULL,NULL,'00000000',NULL,NULL,'SECRETAIRE',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2018-08-09 08:28:44',1,NULL,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-08-23 12:07:47
