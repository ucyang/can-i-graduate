-- MySQL dump 10.16  Distrib 10.1.40-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: can_i_graduate
-- ------------------------------------------------------
-- Server version	10.1.40-MariaDB-0ubuntu0.18.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `attended_lectures`
--

DROP TABLE IF EXISTS `attended_lectures`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `attended_lectures` (
  `member_srl` bigint(11) NOT NULL,
  `lecture_srl` bigint(11) NOT NULL,
  `grade` varchar(40) CHARACTER SET utf8 NOT NULL,
  `codeshare` char(1) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`member_srl`,`lecture_srl`),
  KEY `lecture_srl` (`lecture_srl`),
  CONSTRAINT `attended_lectures_ibfk_1` FOREIGN KEY (`member_srl`) REFERENCES `members` (`member_srl`),
  CONSTRAINT `attended_lectures_ibfk_2` FOREIGN KEY (`lecture_srl`) REFERENCES `lectures` (`lecture_srl`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attended_lectures`
--

LOCK TABLES `attended_lectures` WRITE;
/*!40000 ALTER TABLE `attended_lectures` DISABLE KEYS */;
/*!40000 ALTER TABLE `attended_lectures` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `graduation_status`
--

DROP TABLE IF EXISTS `graduation_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `graduation_status` (
  `member_srl` bigint(11) NOT NULL,
  `gpa` smallint(6) NOT NULL,
  `gpa_major` smallint(6) NOT NULL,
  `english` char(1) COLLATE utf8mb4_unicode_ci DEFAULT 'N',
  `korean_history` char(1) COLLATE utf8mb4_unicode_ci DEFAULT 'N',
  `chinese_char` char(1) COLLATE utf8mb4_unicode_ci DEFAULT 'N',
  `paper` char(1) COLLATE utf8mb4_unicode_ci DEFAULT 'N',
  `counseling` char(1) COLLATE utf8mb4_unicode_ci DEFAULT 'N',
  `portfolio` char(1) COLLATE utf8mb4_unicode_ci DEFAULT 'N',
  `coding_boot_camp` char(1) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `topcit` char(1) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `open_source` char(1) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`member_srl`),
  CONSTRAINT `graduation_status_ibfk_1` FOREIGN KEY (`member_srl`) REFERENCES `members` (`member_srl`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `graduation_status`
--

LOCK TABLES `graduation_status` WRITE;
/*!40000 ALTER TABLE `graduation_status` DISABLE KEYS */;
/*!40000 ALTER TABLE `graduation_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lectures`
--

DROP TABLE IF EXISTS `lectures`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lectures` (
  `lecture_srl` bigint(11) NOT NULL AUTO_INCREMENT,
  `course_no` bigint(11) NOT NULL,
  `class_no` smallint(6) NOT NULL,
  `year` smallint(6) NOT NULL,
  `semester` tinyint(4) NOT NULL,
  `campus` varchar(80) CHARACTER SET utf8 NOT NULL,
  `college` varchar(80) CHARACTER SET utf8 NOT NULL,
  `dept` varchar(80) CHARACTER SET utf8 NOT NULL,
  `title` varchar(180) CHARACTER SET utf8 NOT NULL,
  `inst_name` varchar(80) CHARACTER SET utf8 NOT NULL,
  `credit` tinyint(4) NOT NULL,
  `course_class` varchar(40) CHARACTER SET utf8 NOT NULL,
  `course_type` varchar(40) CHARACTER SET utf8 NOT NULL,
  `abeek_type` varchar(40) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`lecture_srl`),
  UNIQUE KEY `course_no` (`course_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lectures`
--

LOCK TABLES `lectures` WRITE;
/*!40000 ALTER TABLE `lectures` DISABLE KEYS */;
/*!40000 ALTER TABLE `lectures` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `majors`
--

DROP TABLE IF EXISTS `majors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `majors` (
  `major_srl` bigint(11) NOT NULL AUTO_INCREMENT,
  `campus` varchar(80) CHARACTER SET utf8 NOT NULL,
  `college` varchar(80) CHARACTER SET utf8 NOT NULL,
  `dept` varchar(80) CHARACTER SET utf8 NOT NULL,
  `name` varchar(80) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`major_srl`),
  UNIQUE KEY `campus` (`campus`,`college`,`dept`,`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `majors`
--

LOCK TABLES `majors` WRITE;
/*!40000 ALTER TABLE `majors` DISABLE KEYS */;
/*!40000 ALTER TABLE `majors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `members`
--

DROP TABLE IF EXISTS `members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `members` (
  `member_srl` bigint(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nickname` varchar(40) CHARACTER SET utf8 NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `major_srl` bigint(11) NOT NULL,
  `admission_year` smallint(6) NOT NULL,
  `abeek` char(1) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`member_srl`),
  UNIQUE KEY `user_id` (`user_id`),
  UNIQUE KEY `nickname` (`nickname`),
  UNIQUE KEY `email` (`email`),
  KEY `major_srl` (`major_srl`),
  CONSTRAINT `members_ibfk_1` FOREIGN KEY (`major_srl`) REFERENCES `majors` (`major_srl`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `members`
--

LOCK TABLES `members` WRITE;
/*!40000 ALTER TABLE `members` DISABLE KEYS */;
/*!40000 ALTER TABLE `members` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-06-09 21:09:56
