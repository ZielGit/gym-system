-- MySQL dump 10.13  Distrib 8.0.32, for Win64 (x86_64)
--
-- Host: localhost    Database: gym_system
-- ------------------------------------------------------
-- Server version	8.3.0

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `attendances`
--

DROP TABLE IF EXISTS `attendances`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `attendances` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` bigint unsigned NOT NULL,
  `date` date NOT NULL,
  `check_in_time` datetime NOT NULL,
  `check_out_time` datetime DEFAULT NULL,
  `coach_id` bigint unsigned NOT NULL,
  `routine_id` bigint unsigned NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT 'Exit : 0, Entry : 1',
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `attendances_customer_id_foreign` (`customer_id`),
  KEY `attendances_coach_id_foreign` (`coach_id`),
  KEY `attendances_routine_id_foreign` (`routine_id`),
  KEY `attendances_user_id_foreign` (`user_id`),
  CONSTRAINT `attendances_coach_id_foreign` FOREIGN KEY (`coach_id`) REFERENCES `coaches` (`id`),
  CONSTRAINT `attendances_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  CONSTRAINT `attendances_routine_id_foreign` FOREIGN KEY (`routine_id`) REFERENCES `routines` (`id`),
  CONSTRAINT `attendances_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attendances`
--

LOCK TABLES `attendances` WRITE;
/*!40000 ALTER TABLE `attendances` DISABLE KEYS */;
/*!40000 ALTER TABLE `attendances` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coaches`
--

DROP TABLE IF EXISTS `coaches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `coaches` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `document_type` tinyint NOT NULL COMMENT 'DNI: 1, FOREIGNER CARD: 4, RUC: 6, PASSPORT: 7',
  `document_number` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `paternal_surname` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `maternal_surname` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT 'Disable : 0, Enable : 1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `coaches_document_number_unique` (`document_number`),
  UNIQUE KEY `coaches_email_unique` (`email`),
  UNIQUE KEY `coaches_phone_unique` (`phone`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coaches`
--

LOCK TABLES `coaches` WRITE;
/*!40000 ALTER TABLE `coaches` DISABLE KEYS */;
INSERT INTO `coaches` VALUES (1,1,'41865283','Haley Wood','Blake','Andrews','sulef@mailinator.com','369852369','jr. solar 123',1,'2024-09-28 07:26:00','2024-09-28 07:26:00'),(2,6,'8691452','Daphne Whitney','Mason','Rhodes','bonynejo@mailinator.com','94321548','Mollitia quas quasi ',1,'2024-09-30 08:06:48','2024-09-30 08:06:48'),(3,1,'55349856','Vadodara',' Airport','Callister','callister@mailinator.com','986352157','Ca. romeros 123',1,'2024-09-30 08:06:48','2024-09-30 08:06:48');
/*!40000 ALTER TABLE `coaches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `companies`
--

DROP TABLE IF EXISTS `companies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `companies` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `ruc` varchar(11) COLLATE utf8mb3_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `tax_domicile` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `logo_path` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `companies_email_unique` (`email`),
  UNIQUE KEY `companies_phone_unique` (`phone`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `companies`
--

LOCK TABLES `companies` WRITE;
/*!40000 ALTER TABLE `companies` DISABLE KEYS */;
INSERT INTO `companies` VALUES (1,'123456789','EMPRESA DEV edit','jr. pinos del solar edit','empresa.dev@gmail.com','123456789',NULL,'2024-10-11 19:21:49','2024-10-14 03:00:30');
/*!40000 ALTER TABLE `companies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `document_type` tinyint NOT NULL COMMENT 'DNI: 1, FOREIGNER CARD: 4, RUC: 6, PASSPORT: 7',
  `document_number` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT 'Disable : 0, Enable : 1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `customers_document_number_unique` (`document_number`),
  UNIQUE KEY `customers_email_unique` (`email`),
  UNIQUE KEY `customers_phone_unique` (`phone`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` VALUES (1,1,'32165428','Lympne','Airport','air95@gmail.com','321654987','jr. neptuno 123',1,'2024-09-30 08:07:51','2024-09-30 08:07:51'),(2,6,'53912356452','Chaim Hays','Lane','mipofynyk@mailinator.com','421452365','Esse occaecat deseru',1,'2024-09-30 08:07:51','2024-09-30 08:07:51'),(3,1,'65853524','Sawan','Noir','sawan@mailinator.com','986547281','Ca. venus 123',1,'2024-09-30 08:07:51','2024-09-30 08:07:51');
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `payments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `plan_detail_id` bigint unsigned NOT NULL,
  `customer_id` bigint unsigned NOT NULL,
  `plan_id` bigint unsigned NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `date` date NOT NULL,
  `hour` datetime NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT 'Disable : 0, Enable : 1',
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `payments_plan_detail_id_foreign` (`plan_detail_id`),
  KEY `payments_customer_id_foreign` (`customer_id`),
  KEY `payments_plan_id_foreign` (`plan_id`),
  KEY `payments_user_id_foreign` (`user_id`),
  CONSTRAINT `payments_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  CONSTRAINT `payments_plan_detail_id_foreign` FOREIGN KEY (`plan_detail_id`) REFERENCES `plan_details` (`id`),
  CONSTRAINT `payments_plan_id_foreign` FOREIGN KEY (`plan_id`) REFERENCES `plans` (`id`),
  CONSTRAINT `payments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payments`
--

LOCK TABLES `payments` WRITE;
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
INSERT INTO `payments` VALUES (1,1,1,1,50.00,'2024-10-04','2024-10-04 05:11:57',1,1,'2024-10-04 10:11:57','2024-10-04 10:11:57'),(2,1,1,1,50.00,'2024-10-07','2024-10-07 05:51:28',1,1,'2024-10-07 10:51:28','2024-10-07 10:51:28'),(3,1,1,1,50.00,'2024-10-09','2024-10-09 20:52:59',1,1,'2024-10-10 01:52:59','2024-10-10 01:52:59');
/*!40000 ALTER TABLE `payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `plan_details`
--

DROP TABLE IF EXISTS `plan_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `plan_details` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` bigint unsigned NOT NULL,
  `plan_id` bigint unsigned NOT NULL,
  `date` date NOT NULL,
  `hour` datetime NOT NULL,
  `due_date` date NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT 'Disable : 0, Enable : 1',
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `plan_details_customer_id_foreign` (`customer_id`),
  KEY `plan_details_plan_id_foreign` (`plan_id`),
  KEY `plan_details_user_id_foreign` (`user_id`),
  CONSTRAINT `plan_details_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  CONSTRAINT `plan_details_plan_id_foreign` FOREIGN KEY (`plan_id`) REFERENCES `plans` (`id`),
  CONSTRAINT `plan_details_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `plan_details`
--

LOCK TABLES `plan_details` WRITE;
/*!40000 ALTER TABLE `plan_details` DISABLE KEYS */;
INSERT INTO `plan_details` VALUES (1,1,1,'2024-10-03','2024-10-03 21:27:29','2025-01-03',1,1,'2024-10-04 02:27:29','2024-10-10 01:52:59'),(2,2,1,'2024-10-08','2024-10-08 03:11:02','2024-11-08',1,1,'2024-10-08 08:11:02','2024-10-08 08:11:02'),(3,1,1,'2024-10-09','2024-10-09 20:56:58','2024-11-09',1,1,'2024-10-10 01:56:58','2024-10-10 01:56:58');
/*!40000 ALTER TABLE `plan_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `plans`
--

DROP TABLE IF EXISTS `plans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `plans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `condition` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT 'Disable : 0, Enable : 1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `plans`
--

LOCK TABLES `plans` WRITE;
/*!40000 ALTER TABLE `plans` DISABLE KEYS */;
INSERT INTO `plans` VALUES (1,'Plan para adelgazar con Aerodance (8 semanas)','Plan para los que les gusta el aerobic y el baile y además quieren quitarse esos kilos de más',50.00,'MENSUAL','http://gymsystem.test//files/plans/image/plan-20240927221311.jpg',1,'2024-09-28 03:13:12','2024-09-28 03:13:12'),(2,'Plan para mantenerse en forma con actividades variadas (8 semanas)','Aerodance, pilates, yoga, GAP, todo vale con este plan!',20.00,'ANUAL',NULL,1,'2024-09-28 03:13:12','2024-09-28 03:13:12'),(3,'Plan para empezar (8 semanas)','Si quieres introducir el deporte en tu vida, que hasta ahora tenías un poco olvidado, ¡este es tu plan!',100.00,'MENSUAL',NULL,1,'2024-09-28 03:13:12','2024-09-28 03:13:12'),(4,'Reto 30 días','Apuntate al reto si quieres ponerte en forma en un tiempo record!',300.00,'MENSUAL',NULL,1,'2024-09-28 03:13:12','2024-09-28 03:13:12'),(5,'Quiero tonificar en 4 semanas','Plan de entrenamiento estructurado en 4 semanas con videotutoriales de rutinas de tonificacion.',145.00,'MENSUAL',NULL,1,'2024-09-28 03:13:12','2024-09-28 03:13:12');
/*!40000 ALTER TABLE `plans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `routines`
--

DROP TABLE IF EXISTS `routines`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `routines` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `day` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT 'Disable : 0, Enable : 1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `routines`
--

LOCK TABLES `routines` WRITE;
/*!40000 ALTER TABLE `routines` DISABLE KEYS */;
INSERT INTO `routines` VALUES (1,'DIA 01','Piernas / Abs edit',1,'2024-09-28 03:57:04','2024-09-30 08:08:27'),(2,'DIA 02','Pecho',1,'2024-09-30 08:08:23','2024-09-30 08:08:23'),(3,'DIA 03','Espalda/ Abs*',1,'2024-09-30 08:08:23','2024-09-30 08:08:23'),(4,'DIA 04','Hombro / Abs*',1,'2024-09-30 08:08:23','2024-09-30 08:08:23'),(5,'DIA 05','Brazos',1,'2024-09-30 08:08:23','2024-09-30 08:08:23'),(6,'DIA 06','HIIT de 20 minutos, correr, bici, elíptica: 30 seg. suave – moderado / 30 seg.',1,'2024-09-30 08:08:23','2024-09-30 08:08:23'),(7,'DIA 07','DESCANSO',1,'2024-09-30 08:08:23','2024-09-30 08:08:23');
/*!40000 ALTER TABLE `routines` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `document_type` tinyint NOT NULL COMMENT 'DNI: 1, FOREIGNER CARD: 4, RUC: 6, PASSPORT: 7',
  `document_number` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `paternal_surname` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `maternal_surname` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `profile_photo_url` text COLLATE utf8mb3_unicode_ci,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT 'Disable : 0, Enable : 1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_document_number_unique` (`document_number`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_phone_unique` (`phone`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,1,'48547813','Frans','Vilcahuamán','Rojas','frans@gmail.com','989606114','$2y$10$K3rSnFOLDeodPGU8urMywubZSQGJf3kYZN52yOKh7zeCKMsrTbIL2','http://gymsystem.test/files/users/image/user-20241012034351.jpg',1,'2024-10-12 06:34:47','2024-10-12 08:43:51');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'gym_system'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-10-22 23:13:15
