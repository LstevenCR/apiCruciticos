CREATE DATABASE  IF NOT EXISTS `cruciticos` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;
USE `cruciticos`;
-- MySQL dump 10.13  Distrib 8.0.41, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: cruciticos
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
-- Table structure for table `addon`
--

DROP TABLE IF EXISTS `addon`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `addon` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `addonType` enum('cabin','guest') NOT NULL,
  `state` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `addon`
--

LOCK TABLES `addon` WRITE;
/*!40000 ALTER TABLE `addon` DISABLE KEYS */;
INSERT INTO `addon` VALUES (1,'Cena gourmet','Experiencia gastronómica con chef exclusivo.',120.00,'guest',1),(2,'Mini bar en cabina','Incluye bebidas y snacks premium en la cabina.',75.00,'cabin',1),(3,'Excursión VIP','Tour exclusivo en cada puerto con guía privado.',200.00,'guest',1),(4,'Cena gourmet','Experiencia gastronómica con chef exclusivo.',120.00,'guest',1),(5,'Mini bar en cabina','Incluye bebidas y snacks premium en la cabina.',75.00,'cabin',1),(6,'Excursión VIP','Tour exclusivo en cada puerto con guía privado.',200.00,'guest',1),(7,'Comidas gratis','Todo lo que desee comer.',655555.00,'guest',1),(8,'Cofgdfgfdgdfge','Todfgfdgdfgfdger.',99999999.99,'guest',1);
/*!40000 ALTER TABLE `addon` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cruise`
--

DROP TABLE IF EXISTS `cruise`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cruise` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `dayCount` int(11) NOT NULL,
  `destinationId` int(11) NOT NULL,
  `shipId` int(11) NOT NULL,
  `startDate1` date DEFAULT NULL,
  `startDate2` varchar(45) DEFAULT NULL,
  `paymentDeadline` date DEFAULT NULL,
  `state` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `fk_cruise_destination1_idx` (`destinationId`),
  KEY `fk_cruise_ship1_idx` (`shipId`),
  CONSTRAINT `fk_cruise_destination1` FOREIGN KEY (`destinationId`) REFERENCES `destination` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_cruise_ship1` FOREIGN KEY (`shipId`) REFERENCES `ship` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cruise`
--

LOCK TABLES `cruise` WRITE;
/*!40000 ALTER TABLE `cruise` DISABLE KEYS */;
INSERT INTO `cruise` VALUES (1,'Disney Magic at Sea','Australia.jpg',4,3,1,'2025-06-01','2025-06-15','2025-05-15',1),(2,'Caribbean adventure','Caribe.jpg',3,4,3,'2025-07-01','2025-07-15','2025-06-15',1),(3,'Te sientes aventurero','Mexico.jpg',7,6,2,'2025-08-01','2025-08-15','2025-07-15',1),(4,'Aventura por el Mediterráneo','Mediterraneo.jpg',13,10,4,'2025-09-01','2025-09-15','2025-05-15',1);
/*!40000 ALTER TABLE `cruise` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cruise_ports`
--

DROP TABLE IF EXISTS `cruise_ports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cruise_ports` (
  `cruise_id` int(11) NOT NULL,
  `port_id` int(11) NOT NULL,
  PRIMARY KEY (`cruise_id`,`port_id`),
  KEY `port_id` (`port_id`),
  CONSTRAINT `cruise_ports_ibfk_1` FOREIGN KEY (`cruise_id`) REFERENCES `cruise` (`id`),
  CONSTRAINT `cruise_ports_ibfk_2` FOREIGN KEY (`port_id`) REFERENCES `port` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cruise_ports`
--

LOCK TABLES `cruise_ports` WRITE;
/*!40000 ALTER TABLE `cruise_ports` DISABLE KEYS */;
INSERT INTO `cruise_ports` VALUES (1,1),(1,2),(1,3),(2,4),(2,5),(3,6),(3,7),(3,8),(3,9),(4,10),(4,11),(4,12),(4,13),(4,14),(4,15),(4,16),(4,17),(4,18);
/*!40000 ALTER TABLE `cruise_ports` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cruise_room`
--

DROP TABLE IF EXISTS `cruise_room`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cruise_room` (
  `cruise_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  PRIMARY KEY (`cruise_id`,`room_id`),
  KEY `room_id` (`room_id`),
  CONSTRAINT `cruise_room_ibfk_1` FOREIGN KEY (`cruise_id`) REFERENCES `cruise` (`id`),
  CONSTRAINT `cruise_room_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `room` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cruise_room`
--

LOCK TABLES `cruise_room` WRITE;
/*!40000 ALTER TABLE `cruise_room` DISABLE KEYS */;
INSERT INTO `cruise_room` VALUES (1,1),(1,2),(1,3),(2,1),(2,2),(2,3),(3,1),(3,2),(3,3),(4,1),(4,2),(4,3);
/*!40000 ALTER TABLE `cruise_room` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `destination`
--

DROP TABLE IF EXISTS `destination`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `destination` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `state` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `destination`
--

LOCK TABLES `destination` WRITE;
/*!40000 ALTER TABLE `destination` DISABLE KEYS */;
INSERT INTO `destination` VALUES (1,'Melbourne',1),(2,'Hobart',1),(3,'Sídney',1),(4,'Puerto Fort Lauderdale',1),(5,'Cayo CastaWay',1),(6,'Galveston',1),(7,'Roatán',1),(8,'Costa Maya',1),(9,'Cozumel',1),(10,'Civitavecchia',1),(11,'Nápoles',1),(12,'Capri',1),(13,'Santorini',1),(14,'Éfeso',1),(15,'Rodas',1),(16,'Limassol',1),(17,'Mykonos',1),(18,'Atenas',1),(19,'Chania',1);
/*!40000 ALTER TABLE `destination` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `amount` decimal(10,2) NOT NULL,
  `paymentDate` datetime NOT NULL,
  `paymentMethod` enum('tarjeta_de_crédito','paypal') NOT NULL,
  `reservationId` int(11) NOT NULL,
  `state` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `fk_payment_reservation1_idx` (`reservationId`),
  CONSTRAINT `fk_payment_reservation1` FOREIGN KEY (`reservationId`) REFERENCES `reservation` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment`
--

LOCK TABLES `payment` WRITE;
/*!40000 ALTER TABLE `payment` DISABLE KEYS */;
INSERT INTO `payment` VALUES (1,1500.00,'2025-05-01 14:30:00','tarjeta_de_crédito',1,1),(2,2000.00,'2025-06-15 10:00:00','paypal',2,1),(3,1200.00,'2025-07-10 16:45:00','tarjeta_de_crédito',3,1),(4,99999999.99,'1995-05-15 14:30:00','tarjeta_de_crédito',1,1);
/*!40000 ALTER TABLE `payment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `port`
--

DROP TABLE IF EXISTS `port`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `port` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `country` varchar(50) NOT NULL,
  `destinationId` int(11) NOT NULL,
  `horaSalida` varchar(45) DEFAULT NULL,
  `horaLlegada` varchar(45) DEFAULT NULL,
  `state` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `fk_port_destination1_idx` (`destinationId`),
  CONSTRAINT `fk_port_destination1` FOREIGN KEY (`destinationId`) REFERENCES `destination` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `port`
--

LOCK TABLES `port` WRITE;
/*!40000 ALTER TABLE `port` DISABLE KEYS */;
INSERT INTO `port` VALUES (1,'Puerto Melbourne','Australia',1,'7:00','12:00',1),(2,'Puerto Hobart','Australia',2,'7:00','12:00',1),(3,'Puerto de Sídney','Australia',3,'7:00','12:00',1),(4,'Puerto Fort Lauderdale','Estados Unidos',1,'7:00','12:00',1),(5,'Puerto Cayo CastaWay','Las Bahamas',2,'7:00','12:00',1),(6,'Puerto Galveston','Estados Unidos',3,'7:00','12:00',1),(7,'Puerto Roatán','Honduras',2,'7:00','12:00',1),(8,'Puerto Costa Maya','México',2,'7:00','12:00',1),(9,'Puerto Cozumel','México',2,'7:00','12:00',1),(10,'Puerto Civitavecchia','Italia',1,'7:00','12:00',1),(11,'Puerto Nápoles/Capri','Italia',2,'7:00','12:00',1),(12,'Puerto Santorini','Grecia',2,'7:00','12:00',1),(13,'Puerto Éfeso','Turquía',2,'7:00','12:00',1),(14,'Puerto Rodas','Grecia',2,'7:00','12:00',1),(15,'Puerto Limassol','Chipre',2,'7:00','12:00',1),(16,'Puerto Mykonos','Grecia',2,'7:00','12:00',1),(17,'Puerto Atenas','Grecia',2,'7:00','12:00',1),(18,'Puerto Chania','Creta',2,'7:00','12:00',1);
/*!40000 ALTER TABLE `port` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reservation`
--

DROP TABLE IF EXISTS `reservation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reservation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `totalAmount` decimal(10,2) NOT NULL,
  `status` enum('pending','confirmed','canceled') NOT NULL DEFAULT 'pending',
  `reservationDate` date DEFAULT NULL,
  `userId` int(11) NOT NULL,
  `cruiseId` int(11) NOT NULL,
  `state` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `fk_reservation_user1_idx` (`userId`),
  KEY `fk_reservation_cruise1_idx` (`cruiseId`),
  CONSTRAINT `fk_reservation_cruise1` FOREIGN KEY (`cruiseId`) REFERENCES `cruise` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_reservation_user1` FOREIGN KEY (`userId`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservation`
--

LOCK TABLES `reservation` WRITE;
/*!40000 ALTER TABLE `reservation` DISABLE KEYS */;
INSERT INTO `reservation` VALUES (1,1500.00,'pending','2025-05-01',1,1,1),(2,2000.00,'confirmed','2025-06-15',2,2,1),(3,1200.00,'canceled','2025-07-10',3,3,1),(4,500000.00,'pending','2025-11-10',2,2,1);
/*!40000 ALTER TABLE `reservation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `room`
--

DROP TABLE IF EXISTS `room`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `room` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `minGuests` int(11) NOT NULL,
  `maxGuests` int(11) NOT NULL,
  `size` varchar(50) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `shipId` int(11) NOT NULL,
  `state` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `fk_room_ship1_idx` (`shipId`),
  CONSTRAINT `fk_room_ship1` FOREIGN KEY (`shipId`) REFERENCES `ship` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `room`
--

LOCK TABLES `room` WRITE;
/*!40000 ALTER TABLE `room` DISABLE KEYS */;
INSERT INTO `room` VALUES (1,'Suite con Vista al Mar','Una lujosa suite con una impresionante vista al mar.',2,4,'50 m²',500.00,1,1),(2,'Habitación Familiar con Balcón','Habitación espaciosa con balcón, perfecta para familias.',4,6,'70 m²',350.00,2,1),(3,'Cabina Interior','Habitación compacta y económica sin ventanas.',1,2,'20 m²',150.00,3,1);
/*!40000 ALTER TABLE `room` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ship`
--

DROP TABLE IF EXISTS `ship`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ship` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `guestCapacity` int(11) NOT NULL,
  `availableRoomCount` int(11) DEFAULT NULL,
  `state` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ship`
--

LOCK TABLES `ship` WRITE;
/*!40000 ALTER TABLE `ship` DISABLE KEYS */;
INSERT INTO `ship` VALUES (1,'Australia SS','Uno de los cruceros más grandes del mundo con múltiples atracciones.',3000,250,1),(2,'USA SS','Crucero de lujo de la flota de Cunard.',1800,150,1),(3,'Caribe SS','Crucero con entretenimiento de primera y vistas panorámicas.',3600,300,1),(4,'Mediterráneo SS','Uno de los cruceros más grandes del mundo con múltiples atracciones.',6000,500,1);
/*!40000 ALTER TABLE `ship` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ship_room`
--

DROP TABLE IF EXISTS `ship_room`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ship_room` (
  `ship_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  PRIMARY KEY (`ship_id`,`room_id`),
  KEY `room_id` (`room_id`),
  CONSTRAINT `ship_room_ibfk_1` FOREIGN KEY (`ship_id`) REFERENCES `ship` (`id`),
  CONSTRAINT `ship_room_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `room` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ship_room`
--

LOCK TABLES `ship_room` WRITE;
/*!40000 ALTER TABLE `ship_room` DISABLE KEYS */;
INSERT INTO `ship_room` VALUES (1,1),(1,2),(1,3),(2,1),(2,2),(2,3),(3,1),(3,2),(3,3),(4,1),(4,2),(4,3);
/*!40000 ALTER TABLE `ship_room` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `birthDate` date DEFAULT NULL,
  `role` int(2) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `state` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'Juan Pérez','1234567890','juan.perez@email.com','password123','1990-05-15',1,'México',1),(2,'Ana García','0987654321','ana.garcia@email.com','password456','1985-08-22',2,'España',1),(3,'Carlos López','1122334455','carlos.lopez@email.com','password789','1992-11-10',3,'Argentina',1),(4,'TestdesdePostman','555555555','TestdesdePostman@example.com','$2y$10$F2oWBL9ioXFODb630JCWyuzpZ.5LUyQLvqv/z3JsHf1a/Eq34SA7y','1992-11-10',1,'USA',0),(5,'Zacarias Piedras del Rio','8888888','zaca@123456','Zacapassword','1992-11-10',2,'USA',0),(6,'Zacarias Piedras del Rio','888888878888','zaca@56123456','$2y$10$xayuO3C77fD1uM1MvVlFrOkNyEzK0FnX8eownpVsl1iYYuld.8ZpO','1992-11-10',2,'Butan',1);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-03-07 15:11:44
