-- MySQL dump 10.15  Distrib 10.0.30-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: test.texas.com
-- ------------------------------------------------------
-- Server version	10.0.30-MariaDB-0+deb8u1

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
-- Current Database: `test.texas.com`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `test.texas.com` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `test.texas.com`;

--
-- Table structure for table `offer`
--

DROP TABLE IF EXISTS `offer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `offer` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(1024) NOT NULL,
  `description` char(30) NOT NULL,
  `price` decimal(5,2) NOT NULL DEFAULT '0.00',
  `image` varchar(64) NOT NULL,
  `rating` tinyint(4) NOT NULL DEFAULT '0',
  `vote_count` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2956 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `offer`
--

LOCK TABLES `offer` WRITE;
/*!40000 ALTER TABLE `offer` DISABLE KEYS */;
INSERT INTO `offer` VALUES (2756,'Course #1 0',' pariatur. Excepteur sint occa',72.62,'docker_logo.png',5,1),(2757,'Course #7 1','si ut aliquip ex ea commodo co',59.76,'diploma-courses-250x250.jpg',3,1),(2758,'Course #14 2','epteur sint occaecat cupidatat',76.86,'cpe-sponrs.jpg',0,0),(2759,'Course #1 3','ecat cupidatat non proident, s',65.97,'2342341.png',0,0),(2760,'Course #3 4','a qui officia deserunt mollit',54.38,'2342341.png',0,0),(2761,'Course #2 5','ecat cupidatat non proident, s',99.27,'zxcqqw.jpg',0,0),(2762,'Course #9 6','et, consectetur adipiscing eli',85.13,'asd.png',0,0),(2763,'Course #13 7','cillum dolore eu fugiat nulla',63.97,'sddgdffg.jpg',4,1),(2764,'Course #5 8','g elit, sed do eiusmod tempor',75.94,'free-training-course.jpg',0,0),(2765,'Course #7 9','etur adipiscing elit, sed do e',88.11,'free-training-course.jpg',0,0),(2766,'Course #8 10','im veniam, quis nostrud exerci',83.48,'free-training-course.jpg',0,0),(2767,'Course #7 11','a. Ut enim ad minim veniam, qu',91.53,'free-training-course.jpg',0,0),(2768,'Course #11 12','usmod tempor incididunt ut lab',90.87,'CachedImage.png',0,0),(2769,'Course #9 13','culpa qui officia deserunt mol',65.97,'tlogo-1493706800.png',0,0),(2770,'Course #6 14','in culpa qui officia deserunt',65.97,'04.jpg',0,0),(2771,'Course #14 15','culpa qui officia deserunt mol',82.07,'diploma-courses-250x250.jpg',0,0),(2772,'Course #8 16','tat non proident, sunt in culp',51.85,'cpe-sponrs.jpg',0,0),(2773,'Course #4 17','n proident, sunt in culpa qui',65.97,'tlogo-1493706800.png',0,0),(2774,'Course #9 18','or sit amet, consectetur adipi',68.30,'cpe-sponrs.jpg',0,0),(2775,'Course #10 19','n culpa qui officia deserunt m',63.97,'diploma-courses-250x250.jpg',0,0),(2776,'Course #8 20','im veniam, quis nostrud exerci',93.61,'diploma-courses-250x250.jpg',0,0),(2777,'Course #9 21','ea commodo consequat. Duis aut',73.83,'123123.png',0,0),(2778,'Course #3 22','aliquip ex ea commodo consequa',95.42,'sddgdffg.jpg',0,0),(2779,'Course #14 23','g elit, sed do eiusmod tempor',98.52,'2342341.png',0,0),(2780,'Course #1 24','sunt in culpa qui officia dese',97.64,'2342341.png',0,0),(2781,'Course #1 25','m veniam, quis nostrud exercit',67.66,'2342341.png',0,0),(2782,'Course #7 26','equat. Duis aute irure dolor i',100.78,'tlogo-1493706800.png',0,0),(2783,'Course #11 27','n culpa qui officia deserunt m',100.78,'tlogo-1493706800.png',0,0),(2784,'Course #1 28','runt mollit anim id est laboru',54.38,'diploma-courses-250x250.jpg',0,0),(2785,'Course #2 29','henderit in voluptate velit es',78.84,'asd.png',0,0),(2786,'Course #11 30','a. Ut enim ad minim veniam, qu',64.66,'123123.png',0,0),(2787,'Course #10 31','olor in reprehenderit in volup',64.66,'free-training-course.jpg',0,0),(2788,'Course #10 32','sunt in culpa qui officia dese',96.03,'CachedImage.png',0,0),(2789,'Course #6 33','ea commodo consequat. Duis aut',72.62,'2342341.png',0,0),(2790,'Course #12 34','cia deserunt mollit anim id es',62.58,'zxcqqw.jpg',0,0),(2791,'Course #7 35','nisi ut aliquip ex ea commodo',65.97,'sddgdffg.jpg',0,0),(2792,'Course #8 36','aliquip ex ea commodo consequa',62.58,'diploma-courses-250x250.jpg',0,0),(2793,'Course #2 37','co laboris nisi ut aliquip ex',53.57,'zxcqqw.jpg',0,0),(2794,'Course #8 38','usmod tempor incididunt ut lab',76.86,'2342341.png',0,0),(2795,'Course #11 39','prehenderit in voluptate velit',77.74,'zxcqqw.jpg',0,0),(2796,'Course #1 40',' dolore eu fugiat nulla pariat',88.11,'diploma-courses-250x250.jpg',0,0),(2797,'Course #8 41','or sit amet, consectetur adipi',64.66,'docker_logo.png',0,0),(2798,'Course #13 42','in culpa qui officia deserunt',51.85,'sddgdffg.jpg',0,0),(2799,'Course #12 43',' dolore eu fugiat nulla pariat',67.66,'cpe-sponrs.jpg',0,0),(2800,'Course #11 44','culpa qui officia deserunt mol',98.52,'2342341.png',0,0),(2801,'Course #13 45','lpa qui officia deserunt molli',88.11,'04.jpg',0,0),(2802,'Course #5 46','cia deserunt mollit anim id es',68.30,'sddgdffg.jpg',0,0),(2803,'Course #7 47','idatat non proident, sunt in c',69.54,'sddgdffg.jpg',0,0),(2804,'Course #2 48','s aute irure dolor in reprehen',81.84,'CachedImage.png',0,0),(2805,'Course #5 49','aliquip ex ea commodo consequa',57.12,'sddgdffg.jpg',0,0),(2806,'Course #8 0','d exercitation ullamco laboris',63.51,'diploma-courses-250x250.jpg',0,0),(2807,'Course #15 1','ia deserunt mollit anim id est',84.28,'free-training-course.jpg',0,0),(2808,'Course #5 2','e et dolore magna aliqua. Ut e',93.10,'tlogo-1493706800.png',0,0),(2809,'Course #14 3',' in culpa qui officia deserunt',96.08,'asd.png',0,0),(2810,'Course #12 4','trud exercitation ullamco labo',72.25,'sddgdffg.jpg',0,0),(2811,'Course #12 5','xcepteur sint occaecat cupidat',89.35,'zxcqqw.jpg',0,0),(2812,'Course #15 6','agna aliqua. Ut enim ad minim',71.16,'123123.png',0,0),(2813,'Course #15 7','cupidatat non proident, sunt i',66.22,'free-training-course.jpg',0,0),(2814,'Course #15 8',' non proident, sunt in culpa q',74.34,'docker_logo.png',0,0),(2815,'Course #3 9',' nulla pariatur. Excepteur sin',75.05,'diploma-courses-250x250.jpg',0,0),(2816,'Course #14 10','ia deserunt mollit anim id est',72.25,'diploma-courses-250x250.jpg',0,0),(2817,'Course #3 11',' dolor in reprehenderit in vol',59.02,'free-training-course.jpg',0,0),(2818,'Course #8 12','ehenderit in voluptate velit e',82.10,'docker_logo.png',0,0),(2819,'Course #14 13','xcepteur sint occaecat cupidat',80.25,'04.jpg',0,0),(2820,'Course #9 14','n reprehenderit in voluptate v',91.58,'2342341.png',0,0),(2821,'Course #2 15','reprehenderit in voluptate vel',93.10,'cpe-sponrs.jpg',0,0),(2822,'Course #14 16','x ea commodo consequat. Duis a',65.68,'zxcqqw.jpg',0,0),(2823,'Course #11 17','dolor in reprehenderit in volu',57.51,'cpe-sponrs.jpg',0,0),(2824,'Course #4 18','lpa qui officia deserunt molli',68.50,'docker_logo.png',0,0),(2825,'Course #4 19','cupidatat non proident, sunt i',100.08,'04.jpg',0,0),(2826,'Course #7 20','orem ipsum dolor sit amet, con',97.84,'04.jpg',0,0),(2827,'Course #7 21','laboris nisi ut aliquip ex ea',55.68,'asd.png',0,0),(2828,'Course #5 22','mco laboris nisi ut aliquip ex',79.76,'04.jpg',0,0),(2829,'Course #4 23','lore eu fugiat nulla pariatur.',90.50,'tlogo-1493706800.png',0,0),(2830,'Course #9 24','xcepteur sint occaecat cupidat',78.62,'zxcqqw.jpg',0,0),(2831,'Course #8 25','orem ipsum dolor sit amet, con',72.25,'sddgdffg.jpg',0,0),(2832,'Course #14 26','ehenderit in voluptate velit e',87.95,'tlogo-1493706800.png',0,0),(2833,'Course #4 27','xcepteur sint occaecat cupidat',82.10,'asd.png',0,0),(2834,'Course #9 28','. Ut enim ad minim veniam, qui',89.35,'CachedImage.png',0,0),(2835,'Course #2 29','xcepteur sint occaecat cupidat',74.34,'free-training-course.jpg',0,0),(2836,'Course #9 30','xcepteur sint occaecat cupidat',87.95,'zxcqqw.jpg',0,0),(2837,'Course #6 31','uip ex ea commodo consequat. D',87.95,'tlogo-1493706800.png',0,0),(2838,'Course #6 32','n reprehenderit in voluptate v',65.68,'diploma-courses-250x250.jpg',0,0),(2839,'Course #7 33','mco laboris nisi ut aliquip ex',60.78,'diploma-courses-250x250.jpg',0,0),(2840,'Course #10 34','t nulla pariatur. Excepteur si',96.08,'docker_logo.png',0,0),(2841,'Course #1 35','ident, sunt in culpa qui offic',97.84,'2342341.png',0,0),(2842,'Course #3 36','oluptate velit esse cillum dol',84.28,'tlogo-1493706800.png',0,0),(2843,'Course #9 37','erit in voluptate velit esse c',90.50,'asd.png',0,0),(2844,'Course #4 38','uip ex ea commodo consequat. D',96.08,'free-training-course.jpg',0,0),(2845,'Course #7 39','cia deserunt mollit anim id es',74.34,'docker_logo.png',0,0),(2846,'Course #14 40','trud exercitation ullamco labo',62.17,'asd.png',0,0),(2847,'Course #4 41','enim ad minim veniam, quis nos',69.98,'free-training-course.jpg',0,0),(2848,'Course #2 42','oluptate velit esse cillum dol',51.34,'123123.png',0,0),(2849,'Course #4 43','dolor in reprehenderit in volu',76.82,'tlogo-1493706800.png',0,0),(2850,'Course #10 44','d exercitation ullamco laboris',61.54,'cpe-sponrs.jpg',0,0),(2851,'Course #13 45','prehenderit in voluptate velit',81.33,'2342341.png',0,0),(2852,'Course #12 46','x ea commodo consequat. Duis a',91.58,'sddgdffg.jpg',0,0),(2853,'Course #3 47','reprehenderit in voluptate vel',91.58,'asd.png',0,0),(2854,'Course #11 48','idatat non proident, sunt in c',100.08,'2342341.png',0,0),(2855,'Course #2 49','cia deserunt mollit anim id es',52.83,'cpe-sponrs.jpg',0,0),(2856,'Course #5 0','it amet, consectetur adipiscin',60.79,'2342341.png',0,0),(2857,'Course #10 1',' qui officia deserunt mollit a',87.82,'123123.png',0,0),(2858,'Course #2 2',' sit amet, consectetur adipisc',78.08,'asd.png',0,0),(2859,'Course #13 3','t dolore magna aliqua. Ut enim',66.39,'zxcqqw.jpg',0,0),(2860,'Course #15 4',' eu fugiat nulla pariatur. Exc',60.79,'diploma-courses-250x250.jpg',0,0),(2861,'Course #10 5',' exercitation ullamco laboris',96.62,'tlogo-1493706800.png',0,0),(2862,'Course #13 6','i officia deserunt mollit anim',89.92,'2342341.png',0,0),(2863,'Course #15 7','olor sit amet, consectetur adi',67.36,'docker_logo.png',0,0),(2864,'Course #15 8','t dolore magna aliqua. Ut enim',89.92,'04.jpg',0,0),(2865,'Course #10 9','t dolore magna aliqua. Ut enim',56.58,'cpe-sponrs.jpg',0,0),(2866,'Course #1 10','i officia deserunt mollit anim',84.24,'diploma-courses-250x250.jpg',0,0),(2867,'Course #8 11','. Excepteur sint occaecat cupi',82.04,'123123.png',0,0),(2868,'Course #7 12','it amet, consectetur adipiscin',81.51,'CachedImage.png',0,0),(2869,'Course #10 13',' tempor incididunt ut labore e',85.47,'123123.png',0,0),(2870,'Course #10 14','olor sit amet, consectetur adi',69.75,'2342341.png',0,0),(2871,'Course #14 15','m dolor sit amet, consectetur',58.53,'04.jpg',0,0),(2872,'Course #4 16','is nisi ut aliquip ex ea commo',72.28,'diploma-courses-250x250.jpg',0,0),(2873,'Course #4 17','cat cupidatat non proident, su',65.96,'sddgdffg.jpg',0,0),(2874,'Course #3 18','ficia deserunt mollit anim id',94.71,'sddgdffg.jpg',0,0),(2875,'Course #2 19','iscing elit, sed do eiusmod te',77.09,'sddgdffg.jpg',0,0),(2876,'Course #5 20','ur. Excepteur sint occaecat cu',63.74,'docker_logo.png',0,0),(2877,'Course #10 21','o laboris nisi ut aliquip ex e',52.62,'asd.png',0,0),(2878,'Course #8 22','epteur sint occaecat cupidatat',81.51,'123123.png',0,0),(2879,'Course #15 23','olor sit amet, consectetur adi',100.23,'CachedImage.png',0,0),(2880,'Course #15 24','te irure dolor in reprehenderi',99.60,'2342341.png',0,0),(2881,'Course #7 25','ur. Excepteur sint occaecat cu',84.24,'2342341.png',0,0),(2882,'Course #15 26',' qui officia deserunt mollit a',51.13,'diploma-courses-250x250.jpg',0,0),(2883,'Course #5 27','llamco laboris nisi ut aliquip',59.39,'CachedImage.png',0,0),(2884,'Course #15 28','rure dolor in reprehenderit in',95.96,'2342341.png',0,0),(2885,'Course #5 29',' eu fugiat nulla pariatur. Exc',92.91,'free-training-course.jpg',0,0),(2886,'Course #11 30','ur. Excepteur sint occaecat cu',84.24,'asd.png',0,0),(2887,'Course #7 31','ore et dolore magna aliqua. Ut',78.08,'free-training-course.jpg',0,0),(2888,'Course #15 32','aboris nisi ut aliquip ex ea c',59.39,'04.jpg',0,0),(2889,'Course #12 33','it esse cillum dolore eu fugia',76.06,'free-training-course.jpg',0,0),(2890,'Course #15 34','ore et dolore magna aliqua. Ut',61.39,'diploma-courses-250x250.jpg',0,0),(2891,'Course #7 35',' sint occaecat cupidatat non p',68.04,'123123.png',0,0),(2892,'Course #1 36','is nisi ut aliquip ex ea commo',68.04,'docker_logo.png',0,0),(2893,'Course #1 37','rure dolor in reprehenderit in',64.97,'asd.png',0,0),(2894,'Course #13 38','n voluptate velit esse cillum',64.97,'docker_logo.png',0,0),(2895,'Course #1 39','modo consequat. Duis aute irur',100.23,'sddgdffg.jpg',0,0),(2896,'Course #14 40',' qui officia deserunt mollit a',89.92,'tlogo-1493706800.png',0,0),(2897,'Course #15 41','rure dolor in reprehenderit in',75.17,'sddgdffg.jpg',0,0),(2898,'Course #11 42','aboris nisi ut aliquip ex ea c',61.39,'CachedImage.png',0,0),(2899,'Course #8 43','eu fugiat nulla pariatur. Exce',85.47,'CachedImage.png',0,0),(2900,'Course #6 44','ficia deserunt mollit anim id',76.06,'sddgdffg.jpg',0,0),(2901,'Course #5 45','o laboris nisi ut aliquip ex e',93.81,'CachedImage.png',0,0),(2902,'Course #11 46','o laboris nisi ut aliquip ex e',100.23,'docker_logo.png',0,0),(2903,'Course #2 47',' dolor sit amet, consectetur a',65.96,'asd.png',0,0),(2904,'Course #13 48',' nulla pariatur. Excepteur sin',97.99,'free-training-course.jpg',0,0),(2905,'Course #3 49','ipsum dolor sit amet, consecte',90.20,'04.jpg',0,0),(2906,'Course #15 0','co laboris nisi ut aliquip ex',87.64,'tlogo-1493706800.png',0,0),(2907,'Course #2 1','por incididunt ut labore et do',74.88,'docker_logo.png',0,0),(2908,'Course #4 2','d exercitation ullamco laboris',100.75,'tlogo-1493706800.png',0,0),(2909,'Course #3 3','iqua. Ut enim ad minim veniam,',96.78,'tlogo-1493706800.png',0,0),(2910,'Course #2 4','re magna aliqua. Ut enim ad mi',53.91,'cpe-sponrs.jpg',0,0),(2911,'Course #7 5','consequat. Duis aute irure dol',95.65,'CachedImage.png',0,0),(2912,'Course #1 6','ip ex ea commodo consequat. Du',89.16,'tlogo-1493706800.png',0,0),(2913,'Course #6 7','la pariatur. Excepteur sint oc',88.63,'asd.png',0,0),(2914,'Course #11 8','cillum dolore eu fugiat nulla',55.32,'123123.png',0,0),(2915,'Course #4 9','cididunt ut labore et dolore m',65.04,'cpe-sponrs.jpg',0,0),(2916,'Course #15 10','re magna aliqua. Ut enim ad mi',97.30,'free-training-course.jpg',0,0),(2917,'Course #11 11','adipiscing elit, sed do eiusmo',70.45,'tlogo-1493706800.png',0,0),(2918,'Course #2 12','ecat cupidatat non proident, s',88.63,'zxcqqw.jpg',0,0),(2919,'Course #2 13','co laboris nisi ut aliquip ex',66.24,'zxcqqw.jpg',0,0),(2920,'Course #7 14',' consectetur adipiscing elit,',66.24,'04.jpg',0,0),(2921,'Course #11 15','consequat. Duis aute irure dol',83.47,'04.jpg',0,0),(2922,'Course #5 16','in voluptate velit esse cillum',61.23,'free-training-course.jpg',0,0),(2923,'Course #2 17',' pariatur. Excepteur sint occa',99.04,'diploma-courses-250x250.jpg',0,0),(2924,'Course #10 18',', quis nostrud exercitation ul',80.57,'zxcqqw.jpg',0,0),(2925,'Course #6 19','scing elit, sed do eiusmod tem',79.66,'asd.png',0,0),(2926,'Course #8 20','re magna aliqua. Ut enim ad mi',73.76,'04.jpg',0,0),(2927,'Course #4 21','d exercitation ullamco laboris',97.30,'cpe-sponrs.jpg',0,0),(2928,'Course #7 22','re magna aliqua. Ut enim ad mi',57.56,'zxcqqw.jpg',0,0),(2929,'Course #12 23','ariatur. Excepteur sint occaec',76.42,'docker_logo.png',0,0),(2930,'Course #8 24',', quis nostrud exercitation ul',81.03,'CachedImage.png',0,0),(2931,'Course #5 25','is nostrud exercitation ullamc',95.65,'2342341.png',0,0),(2932,'Course #7 26','ut labore et dolore magna aliq',51.14,'2342341.png',0,0),(2933,'Course #12 27','iqua. Ut enim ad minim veniam,',60.44,'zxcqqw.jpg',0,0),(2934,'Course #7 28','re magna aliqua. Ut enim ad mi',69.13,'sddgdffg.jpg',0,0),(2935,'Course #15 29','d exercitation ullamco laboris',54.03,'2342341.png',0,0),(2936,'Course #7 30','co laboris nisi ut aliquip ex',73.76,'cpe-sponrs.jpg',0,0),(2937,'Course #5 31',' consectetur adipiscing elit,',83.47,'free-training-course.jpg',0,0),(2938,'Course #11 32','in voluptate velit esse cillum',57.56,'cpe-sponrs.jpg',0,0),(2939,'Course #14 33','consectetur adipiscing elit, s',75.02,'2342341.png',0,0),(2940,'Course #9 34',', quis nostrud exercitation ul',65.04,'tlogo-1493706800.png',0,0),(2941,'Course #12 35','por incididunt ut labore et do',87.64,'2342341.png',0,0),(2942,'Course #14 36','ore eu fugiat nulla pariatur.',61.23,'2342341.png',0,0),(2943,'Course #5 37','atur. Excepteur sint occaecat',74.88,'asd.png',0,0),(2944,'Course #2 38',' consectetur adipiscing elit,',54.03,'sddgdffg.jpg',0,0),(2945,'Course #5 39','ur adipiscing elit, sed do eiu',73.76,'free-training-course.jpg',0,0),(2946,'Course #15 40','iqua. Ut enim ad minim veniam,',89.16,'docker_logo.png',0,0),(2947,'Course #8 41','adipiscing elit, sed do eiusmo',90.25,'asd.png',0,0),(2948,'Course #1 42',' proident, sunt in culpa qui o',54.03,'asd.png',0,0),(2949,'Course #5 43','consequat. Duis aute irure dol',71.60,'docker_logo.png',0,0),(2950,'Course #12 44','cillum dolore eu fugiat nulla',78.87,'free-training-course.jpg',0,0),(2951,'Course #10 45','ariatur. Excepteur sint occaec',62.86,'zxcqqw.jpg',0,0),(2952,'Course #4 46','t esse cillum dolore eu fugiat',59.00,'diploma-courses-250x250.jpg',0,0),(2953,'Course #7 47',' esse cillum dolore eu fugiat',79.66,'CachedImage.png',0,0),(2954,'Course #12 48','tetur adipiscing elit, sed do',65.04,'free-training-course.jpg',0,0),(2955,'Course #5 49','nt in culpa qui officia deseru',79.66,'123123.png',0,0);
/*!40000 ALTER TABLE `offer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `offer_datetime`
--

DROP TABLE IF EXISTS `offer_datetime`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `offer_datetime` (
  `offer_id` int(11) unsigned NOT NULL,
  `datetime` datetime NOT NULL,
  `duration` tinyint(2) unsigned NOT NULL,
  PRIMARY KEY (`offer_id`,`datetime`),
  CONSTRAINT `offer_datetime_ibfk_1` FOREIGN KEY (`offer_id`) REFERENCES `offer` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `offer_datetime`
--

LOCK TABLES `offer_datetime` WRITE;
/*!40000 ALTER TABLE `offer_datetime` DISABLE KEYS */;
INSERT INTO `offer_datetime` VALUES (2756,'2017-06-07 20:00:00',75),(2756,'2017-07-08 12:11:00',61),(2756,'2017-10-16 12:11:00',120),(2757,'2017-06-01 14:00:00',90),(2757,'2017-06-11 12:11:00',65),(2758,'2017-06-02 15:00:00',77),(2758,'2017-06-06 19:45:00',90),(2758,'2017-06-11 12:11:00',68),(2759,'2017-06-05 18:00:00',68),(2759,'2017-06-07 20:00:00',113),(2759,'2017-08-15 17:34:00',64),(2759,'2017-09-08 12:11:00',74),(2760,'2017-06-05 18:00:00',103),(2761,'2017-06-05 18:00:00',96),(2761,'2017-08-15 17:34:00',74),(2764,'2017-06-03 16:30:00',81),(2765,'2017-06-01 14:00:00',115),(2765,'2017-07-08 12:11:00',104),(2765,'2017-09-08 12:11:00',84),(2766,'2017-06-05 18:00:00',72),(2766,'2017-10-16 12:11:00',93),(2767,'2017-06-03 16:30:00',66),(2767,'2017-10-16 12:11:00',66),(2768,'2017-06-03 16:30:00',85),(2768,'2017-06-06 19:45:00',109),(2768,'2017-06-11 12:11:00',62),(2769,'2017-06-02 15:00:00',120),(2769,'2017-06-05 18:00:00',65),(2770,'2017-06-03 16:30:00',109),(2770,'2017-06-06 19:45:00',88),(2771,'2017-06-03 16:30:00',107),(2772,'2017-06-01 14:00:00',115),(2772,'2017-09-08 12:11:00',114),(2774,'2017-06-01 14:00:00',99),(2774,'2017-06-04 17:00:00',106),(2774,'2017-06-07 20:00:00',113),(2774,'2017-06-11 12:11:00',96),(2775,'2017-06-05 18:00:00',103),(2776,'2017-06-04 17:00:00',102),(2776,'2017-06-05 18:00:00',94),(2777,'2017-06-05 18:00:00',75),(2778,'2017-06-07 20:00:00',66),(2779,'2017-08-15 17:34:00',93),(2780,'2017-06-02 15:00:00',116),(2780,'2017-06-04 17:00:00',86),(2782,'2017-06-03 16:30:00',118),(2782,'2017-06-06 19:45:00',93),(2782,'2017-07-08 12:11:00',70),(2782,'2017-10-16 12:11:00',82),(2783,'2017-06-02 15:00:00',80),(2783,'2017-06-07 20:00:00',74),(2783,'2017-06-11 12:11:00',73),(2784,'2017-06-01 14:00:00',103),(2784,'2017-06-02 15:00:00',74),(2785,'2017-06-11 12:11:00',82),(2786,'2017-06-02 15:00:00',66),(2786,'2017-07-08 12:11:00',98),(2787,'2017-06-03 16:30:00',111),(2787,'2017-06-04 17:00:00',66),(2787,'2017-06-07 20:00:00',77),(2788,'2017-06-03 16:30:00',62),(2789,'2017-06-04 17:00:00',88),(2789,'2017-07-08 12:11:00',81),(2790,'2017-06-07 20:00:00',77),(2790,'2017-07-08 12:11:00',86),(2793,'2017-06-01 14:00:00',101),(2794,'2017-06-11 12:11:00',80),(2794,'2017-08-15 17:34:00',67),(2794,'2017-09-08 12:11:00',79),(2794,'2017-10-16 12:11:00',69),(2795,'2017-06-01 14:00:00',106),(2795,'2017-06-03 16:30:00',85),(2795,'2017-08-15 17:34:00',80),(2795,'2017-09-08 12:11:00',85),(2796,'2017-07-08 12:11:00',98),(2796,'2017-09-08 12:11:00',110),(2797,'2017-06-02 15:00:00',95),(2797,'2017-06-06 19:45:00',108),(2798,'2017-06-11 12:11:00',81),(2798,'2017-09-08 12:11:00',96),(2798,'2017-10-16 12:11:00',81),(2799,'2017-06-07 20:00:00',85),(2799,'2017-07-08 12:11:00',89),(2800,'2017-06-11 12:11:00',92),(2800,'2017-10-16 12:11:00',111),(2801,'2017-06-02 15:00:00',99),(2801,'2017-06-07 20:00:00',75),(2801,'2017-06-11 12:11:00',109),(2802,'2017-06-03 16:30:00',64),(2803,'2017-06-03 16:30:00',74),(2803,'2017-07-08 12:11:00',73),(2803,'2017-10-16 12:11:00',86),(2804,'2017-06-02 15:00:00',119),(2804,'2017-06-04 17:00:00',96),(2808,'2017-06-02 15:00:00',92),(2808,'2017-06-05 18:00:00',86),(2809,'2017-06-02 15:00:00',100),(2809,'2017-08-15 17:34:00',107),(2810,'2017-06-07 20:00:00',120),(2811,'2017-06-04 17:00:00',66),(2811,'2017-06-07 20:00:00',72),(2814,'2017-09-08 12:11:00',89),(2814,'2017-10-16 12:11:00',114),(2815,'2017-06-11 12:11:00',79),(2815,'2017-10-16 12:11:00',70),(2817,'2017-06-07 20:00:00',118),(2817,'2017-10-16 12:11:00',79),(2818,'2017-06-03 16:30:00',65),(2818,'2017-06-06 19:45:00',96),(2818,'2017-09-08 12:11:00',61),(2819,'2017-06-11 12:11:00',90),(2821,'2017-09-08 12:11:00',108),(2822,'2017-10-16 12:11:00',118),(2824,'2017-06-05 18:00:00',62),(2825,'2017-06-02 15:00:00',106),(2827,'2017-06-02 15:00:00',93),(2827,'2017-06-07 20:00:00',115),(2828,'2017-06-04 17:00:00',93),(2829,'2017-06-07 20:00:00',103),(2831,'2017-06-01 14:00:00',108),(2831,'2017-06-04 17:00:00',97),(2832,'2017-06-02 15:00:00',60),(2832,'2017-08-15 17:34:00',105),(2834,'2017-06-06 19:45:00',66),(2838,'2017-06-04 17:00:00',66),(2840,'2017-06-01 14:00:00',84),(2841,'2017-06-01 14:00:00',66),(2845,'2017-06-03 16:30:00',66),(2846,'2017-06-07 20:00:00',108),(2848,'2017-07-08 12:11:00',86),(2849,'2017-08-15 17:34:00',103),(2850,'2017-06-04 17:00:00',81),(2851,'2017-06-01 14:00:00',117),(2851,'2017-06-02 15:00:00',60),(2851,'2017-06-05 18:00:00',66),(2851,'2017-09-08 12:11:00',63),(2852,'2017-07-08 12:11:00',104),(2853,'2017-06-03 16:30:00',71),(2853,'2017-06-05 18:00:00',80),(2853,'2017-07-08 12:11:00',109),(2855,'2017-06-07 20:00:00',88),(2856,'2017-06-06 19:45:00',74),(2857,'2017-06-01 14:00:00',80),(2857,'2017-06-07 20:00:00',120),(2857,'2017-08-15 17:34:00',93),(2858,'2017-06-07 20:00:00',71),(2858,'2017-10-16 12:11:00',81),(2862,'2017-06-01 14:00:00',90),(2862,'2017-06-07 20:00:00',88),(2865,'2017-10-16 12:11:00',100),(2866,'2017-08-15 17:34:00',118),(2868,'2017-06-07 20:00:00',103),(2869,'2017-06-11 12:11:00',116),(2873,'2017-06-02 15:00:00',116),(2873,'2017-06-05 18:00:00',107),(2875,'2017-06-11 12:11:00',85),(2876,'2017-08-15 17:34:00',113),(2877,'2017-08-15 17:34:00',116),(2878,'2017-10-16 12:11:00',70),(2883,'2017-06-03 16:30:00',112),(2883,'2017-09-08 12:11:00',75),(2885,'2017-06-04 17:00:00',84),(2886,'2017-06-07 20:00:00',82),(2887,'2017-06-02 15:00:00',69),(2891,'2017-06-03 16:30:00',117),(2893,'2017-09-08 12:11:00',84),(2894,'2017-06-07 20:00:00',75),(2897,'2017-08-15 17:34:00',71),(2899,'2017-06-06 19:45:00',73),(2902,'2017-10-16 12:11:00',81),(2904,'2017-06-05 18:00:00',72),(2905,'2017-06-04 17:00:00',113),(2905,'2017-06-05 18:00:00',78),(2907,'2017-06-03 16:30:00',115),(2908,'2017-06-11 12:11:00',81),(2912,'2017-09-08 12:11:00',103),(2921,'2017-09-08 12:11:00',67),(2923,'2017-06-07 20:00:00',102),(2923,'2017-09-08 12:11:00',89),(2936,'2017-10-16 12:11:00',109),(2942,'2017-10-16 12:11:00',84),(2943,'2017-06-04 17:00:00',89),(2944,'2017-06-06 19:45:00',96),(2947,'2017-06-05 18:00:00',61),(2951,'2017-06-07 20:00:00',72),(2951,'2017-07-08 12:11:00',98);
/*!40000 ALTER TABLE `offer_datetime` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `offer_professor`
--

DROP TABLE IF EXISTS `offer_professor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `offer_professor` (
  `offer_id` int(11) unsigned NOT NULL,
  `professor_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`offer_id`,`professor_id`),
  CONSTRAINT `offer_professor_ibfk_1` FOREIGN KEY (`offer_id`) REFERENCES `offer` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `offer_professor`
--

LOCK TABLES `offer_professor` WRITE;
/*!40000 ALTER TABLE `offer_professor` DISABLE KEYS */;
INSERT INTO `offer_professor` VALUES (2756,2358),(2757,2364),(2757,2367),(2758,2361),(2758,2390),(2758,2401),(2758,2448),(2759,2415),(2759,2431),(2761,2380),(2761,2398),(2761,2441),(2763,2368),(2764,2450),(2765,2404),(2765,2451),(2766,2358),(2767,2453),(2768,2396),(2769,2378),(2769,2408),(2770,2362),(2772,2376),(2773,2381),(2774,2404),(2775,2397),(2775,2448),(2776,2362),(2776,2374),(2776,2418),(2777,2362),(2777,2368),(2777,2398),(2777,2553),(2778,2357),(2779,2364),(2779,2380),(2779,2399),(2779,2403),(2779,2433),(2780,2385),(2780,2445),(2780,2469),(2783,2380),(2784,2371),(2785,2382),(2785,2405),(2787,2365),(2787,2390),(2787,2502),(2788,2361),(2788,2400),(2789,2433),(2790,2359),(2790,2360),(2790,2371),(2790,2397),(2791,2367),(2791,2377),(2792,2362),(2792,2383),(2792,2393),(2792,2415),(2794,2387),(2796,2356),(2796,2397),(2796,2416),(2797,2369),(2797,2398),(2798,2401),(2798,2442),(2799,2418),(2799,2463),(2800,2395),(2800,2403),(2800,2406),(2801,2389),(2801,2396),(2801,2412),(2801,2466),(2802,2371),(2803,2356),(2803,2360),(2803,2379),(2803,2478),(2804,2395),(2805,2396),(2805,2441),(2805,2531),(2806,2383),(2806,2436),(2807,2393),(2808,2365),(2808,2417),(2809,2387),(2809,2389),(2809,2444),(2812,2387),(2812,2413),(2813,2503),(2813,2530),(2814,2385),(2814,2449),(2815,2432),(2816,2381),(2817,2427),(2818,2447),(2820,2418),(2821,2453),(2822,2402),(2823,2455),(2823,2538),(2824,2455),(2824,2521),(2825,2441),(2825,2444),(2825,2464),(2826,2379),(2826,2515),(2827,2402),(2827,2437),(2828,2389),(2829,2386),(2829,2413),(2829,2433),(2831,2445),(2832,2497),(2833,2357),(2833,2383),(2833,2385),(2833,2416),(2835,2398),(2836,2383),(2836,2446),(2837,2409),(2837,2492),(2838,2356),(2842,2373),(2842,2386),(2842,2407),(2843,2430),(2844,2496),(2844,2514),(2845,2389),(2848,2456),(2849,2434),(2849,2445),(2851,2356),(2853,2375),(2853,2465),(2854,2418),(2854,2490),(2859,2364),(2859,2470),(2862,2388),(2862,2538),(2864,2399),(2866,2405),(2868,2358),(2869,2429),(2870,2479),(2870,2488),(2872,2372),(2872,2483),(2876,2459),(2878,2519),(2880,2375),(2880,2400),(2881,2518),(2882,2542),(2883,2438),(2887,2532),(2888,2483),(2890,2503),(2892,2492),(2895,2429),(2895,2456),(2896,2444),(2900,2426),(2901,2475),(2904,2433),(2905,2396),(2905,2409),(2907,2528),(2911,2366),(2911,2546),(2914,2394),(2917,2432),(2921,2365),(2922,2536),(2923,2415),(2934,2421),(2934,2494),(2951,2408),(2954,2465),(2955,2459),(2955,2494),(2955,2498);
/*!40000 ALTER TABLE `offer_professor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `offer_rating`
--

DROP TABLE IF EXISTS `offer_rating`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `offer_rating` (
  `offer_id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `mark` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`offer_id`,`user_id`),
  KEY `offer_id` (`offer_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `offer_rating_ibfk_1` FOREIGN KEY (`offer_id`) REFERENCES `offer` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `offer_rating`
--

LOCK TABLES `offer_rating` WRITE;
/*!40000 ALTER TABLE `offer_rating` DISABLE KEYS */;
INSERT INTO `offer_rating` VALUES (2756,74,5),(2757,74,3),(2763,74,4);
/*!40000 ALTER TABLE `offer_rating` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order`
--

DROP TABLE IF EXISTS `order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `order_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order`
--

LOCK TABLES `order` WRITE;
/*!40000 ALTER TABLE `order` DISABLE KEYS */;
/*!40000 ALTER TABLE `order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_offer`
--

DROP TABLE IF EXISTS `order_offer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_offer` (
  `order_id` int(11) unsigned NOT NULL,
  `offer_id` int(11) unsigned NOT NULL,
  `quantity` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`order_id`,`offer_id`),
  KEY `order_id` (`order_id`),
  KEY `offer_id` (`offer_id`),
  CONSTRAINT `order_offer_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`),
  CONSTRAINT `order_offer_ibfk_2` FOREIGN KEY (`offer_id`) REFERENCES `offer` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_offer`
--

LOCK TABLES `order_offer` WRITE;
/*!40000 ALTER TABLE `order_offer` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_offer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `professor`
--

DROP TABLE IF EXISTS `professor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `professor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2556 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `professor`
--

LOCK TABLES `professor` WRITE;
/*!40000 ALTER TABLE `professor` DISABLE KEYS */;
INSERT INTO `professor` VALUES (2356,'Ernest Hemingway 0'),(2357,'Elvis Presley 1'),(2358,'Humphrey Bogart 2'),(2359,'Ernest Hemingway 3'),(2360,'Ernest Hemingway 4'),(2361,'Martin Luther King 5'),(2362,'Henry Ford 6'),(2363,'Marilyn Monroe 7'),(2364,'George Washington 8'),(2365,'Neil Armstrong 9'),(2366,'Ernest Hemingway 10'),(2367,'Abraham Lincoln 11'),(2368,'Elvis Presley 12'),(2369,'Neil Armstrong 13'),(2370,'Elvis Presley 14'),(2371,'Henry Ford 15'),(2372,'Muhammad Ali 16'),(2373,'Martin Luther King 17'),(2374,'Jimi Hendrix 18'),(2375,'Elvis Presley 19'),(2376,'Billie Holiday 20'),(2377,'Bob Dylan 21'),(2378,'Muhammad Ali 22'),(2379,'Jimi Hendrix 23'),(2380,'Mark Twain 24'),(2381,'Marilyn Monroe 25'),(2382,'Abraham Lincoln 26'),(2383,'Billie Holiday 27'),(2384,'Humphrey Bogart 28'),(2385,'Elvis Presley 29'),(2386,'Ernest Hemingway 30'),(2387,'Humphrey Bogart 31'),(2388,'Humphrey Bogart 32'),(2389,'Billie Holiday 33'),(2390,'Martin Luther King 34'),(2391,'Henry Ford 35'),(2392,'John F Kennedy 36'),(2393,'Humphrey Bogart 37'),(2394,'George Washington 38'),(2395,'Abraham Lincoln 39'),(2396,'Abraham Lincoln 40'),(2397,'Henry Ford 41'),(2398,'Muhammad Ali 42'),(2399,'Neil Armstrong 43'),(2400,'Neil Armstrong 44'),(2401,'Mark Twain 45'),(2402,'Ernest Hemingway 46'),(2403,'Bob Dylan 47'),(2404,'Elvis Presley 48'),(2405,'Elvis Presley 49'),(2406,'Bob Dylan 0'),(2407,'George Washington 1'),(2408,'Henry Ford 2'),(2409,'Henry Ford 3'),(2410,'Humphrey Bogart 4'),(2411,'Neil Armstrong 5'),(2412,'Jimi Hendrix 6'),(2413,'Jimi Hendrix 7'),(2414,'George Washington 8'),(2415,'Jimi Hendrix 9'),(2416,'Jimi Hendrix 10'),(2417,'Henry Ford 11'),(2418,'Neil Armstrong 12'),(2419,'Billie Holiday 13'),(2420,'Marilyn Monroe 14'),(2421,'Bob Dylan 15'),(2422,'Mark Twain 16'),(2423,'Elvis Presley 17'),(2424,'Humphrey Bogart 18'),(2425,'Billie Holiday 19'),(2426,'Neil Armstrong 20'),(2427,'Humphrey Bogart 21'),(2428,'Mark Twain 22'),(2429,'George Washington 23'),(2430,'Henry Ford 24'),(2431,'Muhammad Ali 25'),(2432,'Marilyn Monroe 26'),(2433,'Billie Holiday 27'),(2434,'George Washington 28'),(2435,'George Washington 29'),(2436,'John F Kennedy 30'),(2437,'Abraham Lincoln 31'),(2438,'Bob Dylan 32'),(2439,'Jimi Hendrix 33'),(2440,'Marilyn Monroe 34'),(2441,'Elvis Presley 35'),(2442,'Bob Dylan 36'),(2443,'Henry Ford 37'),(2444,'Jimi Hendrix 38'),(2445,'Neil Armstrong 39'),(2446,'Mark Twain 40'),(2447,'Humphrey Bogart 41'),(2448,'John F Kennedy 42'),(2449,'Billie Holiday 43'),(2450,'Marilyn Monroe 44'),(2451,'Elvis Presley 45'),(2452,'Marilyn Monroe 46'),(2453,'John F Kennedy 47'),(2454,'Mark Twain 48'),(2455,'Elvis Presley 49'),(2456,'Elvis Presley 0'),(2457,'Henry Ford 1'),(2458,'Billie Holiday 2'),(2459,'Martin Luther King 3'),(2460,'Marilyn Monroe 4'),(2461,'John F Kennedy 5'),(2462,'Bob Dylan 6'),(2463,'Bob Dylan 7'),(2464,'Muhammad Ali 8'),(2465,'Mark Twain 9'),(2466,'Jimi Hendrix 10'),(2467,'Henry Ford 11'),(2468,'John F Kennedy 12'),(2469,'Marilyn Monroe 13'),(2470,'John F Kennedy 14'),(2471,'Bob Dylan 15'),(2472,'Marilyn Monroe 16'),(2473,'Elvis Presley 17'),(2474,'Ernest Hemingway 18'),(2475,'Abraham Lincoln 19'),(2476,'Marilyn Monroe 20'),(2477,'Elvis Presley 21'),(2478,'Martin Luther King 22'),(2479,'Henry Ford 23'),(2480,'Henry Ford 24'),(2481,'Muhammad Ali 25'),(2482,'John F Kennedy 26'),(2483,'Abraham Lincoln 27'),(2484,'Marilyn Monroe 28'),(2485,'Neil Armstrong 29'),(2486,'Billie Holiday 30'),(2487,'Neil Armstrong 31'),(2488,'Mark Twain 32'),(2489,'Mark Twain 33'),(2490,'Neil Armstrong 34'),(2491,'Humphrey Bogart 35'),(2492,'Humphrey Bogart 36'),(2493,'John F Kennedy 37'),(2494,'Neil Armstrong 38'),(2495,'Martin Luther King 39'),(2496,'Billie Holiday 40'),(2497,'Billie Holiday 41'),(2498,'Ernest Hemingway 42'),(2499,'Ernest Hemingway 43'),(2500,'Martin Luther King 44'),(2501,'Martin Luther King 45'),(2502,'Elvis Presley 46'),(2503,'John F Kennedy 47'),(2504,'Billie Holiday 48'),(2505,'George Washington 49'),(2506,'Martin Luther King 0'),(2507,'Muhammad Ali 1'),(2508,'Muhammad Ali 2'),(2509,'John F Kennedy 3'),(2510,'Muhammad Ali 4'),(2511,'Martin Luther King 5'),(2512,'John F Kennedy 6'),(2513,'Neil Armstrong 7'),(2514,'Bob Dylan 8'),(2515,'George Washington 9'),(2516,'Ernest Hemingway 10'),(2517,'Bob Dylan 11'),(2518,'Muhammad Ali 12'),(2519,'Mark Twain 13'),(2520,'John F Kennedy 14'),(2521,'John F Kennedy 15'),(2522,'Neil Armstrong 16'),(2523,'Mark Twain 17'),(2524,'Ernest Hemingway 18'),(2525,'Jimi Hendrix 19'),(2526,'Abraham Lincoln 20'),(2527,'Marilyn Monroe 21'),(2528,'Abraham Lincoln 22'),(2529,'Muhammad Ali 23'),(2530,'Humphrey Bogart 24'),(2531,'Muhammad Ali 25'),(2532,'Jimi Hendrix 26'),(2533,'Marilyn Monroe 27'),(2534,'Neil Armstrong 28'),(2535,'Billie Holiday 29'),(2536,'Mark Twain 30'),(2537,'Humphrey Bogart 31'),(2538,'Marilyn Monroe 32'),(2539,'John F Kennedy 33'),(2540,'Henry Ford 34'),(2541,'Muhammad Ali 35'),(2542,'Abraham Lincoln 36'),(2543,'Abraham Lincoln 37'),(2544,'Abraham Lincoln 38'),(2545,'Jimi Hendrix 39'),(2546,'Neil Armstrong 40'),(2547,'Billie Holiday 41'),(2548,'Humphrey Bogart 42'),(2549,'Marilyn Monroe 43'),(2550,'Martin Luther King 44'),(2551,'Elvis Presley 45'),(2552,'Billie Holiday 46'),(2553,'Henry Ford 47'),(2554,'Jimi Hendrix 48'),(2555,'George Washington 49');
/*!40000 ALTER TABLE `professor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` tinytext NOT NULL,
  `balance` decimal(7,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'Customer #1496161959',100.00),(2,'Customer #1496161959',100.00),(3,'Customer #1496162477',100.00),(4,'Customer #1496162480',100.00),(5,'Customer #1496162524',100.00),(6,'Customer #1496162524',100.00),(7,'Customer #1496162584',100.00),(8,'Customer #1496162624',100.00),(9,'Customer #1496162648',100.00),(10,'Customer #1496162659',100.00),(11,'Customer #1496162936',100.00),(12,'Customer #1496162936',100.00),(13,'Customer #1496162936',100.00),(14,'Customer #1496162936',100.00),(15,'Customer #1496162936',100.00),(16,'Customer #1496162936',100.00),(17,'Customer #1496162936',100.00),(18,'Customer #1496162936',100.00),(19,'Customer #1496162936',100.00),(20,'Customer #1496162936',100.00),(21,'Customer #1496162936',100.00),(22,'Customer #1496162936',100.00),(23,'Customer #1496162936',100.00),(24,'Customer #1496162936',100.00),(25,'Customer #1496162936',100.00),(26,'Customer #1496162936',100.00),(27,'Customer #1496162936',100.00),(28,'Customer #1496162936',100.00),(29,'Customer #1496162936',100.00),(30,'Customer #1496162936',100.00),(31,'Customer #1496162936',100.00),(32,'Customer #1496162936',100.00),(33,'Customer #1496162936',100.00),(34,'Customer #1496162936',100.00),(35,'Customer #1496162936',100.00),(36,'Customer #1496162936',100.00),(37,'Customer #1496162936',100.00),(38,'Customer #1496162936',100.00),(39,'Customer #1496162936',100.00),(40,'Customer #1496162936',100.00),(41,'Customer #1496164387',100.00),(42,'Customer #1496164387',100.00),(43,'Customer #1496164576',100.00),(44,'Customer #1496164778',100.00),(45,'Customer #1496164951',100.00),(46,'Customer #1496165005',100.00),(47,'Customer #1496165030',100.00),(48,'Customer #1496165070',100.00),(49,'Customer #1496165109',100.00),(50,'Customer #1496165212',100.00),(51,'Customer #1496165215',100.00),(52,'Customer #1496165304',100.00),(53,'Customer #1496165366',100.00),(54,'Customer #1496170410',100.00),(55,'Customer #1496175098',100.00),(56,'Customer #1496177932',999.99),(57,'Customer #1496179605',999.99),(58,'Customer #1496180157',999.99),(59,'Customer #1496181841',999.99),(60,'Customer #1496186113',999.99),(61,'Customer #1496188649',801.41),(62,'Customer #1496189216',999.99),(63,'Customer #1496190684',999.99),(64,'Customer #1496192393',999.99),(65,'Customer #1496192401',33.88),(66,'Customer #1496193350',999.99),(67,'asd',999.99),(68,'Customer #1496193669',999.99),(69,'Customer #1496193681',999.99),(70,'aleksandr_33044',999.99),(71,'asd',66666.00),(72,'Customer #1496193846',1000.00),(73,'Customer #1496194056',1000.00),(74,'Customer #1496194130',1000.00);
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

-- Dump completed on 2017-05-31  5:32:14
