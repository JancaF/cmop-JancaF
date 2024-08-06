-- Adminer 4.8.1 MySQL 8.0.30 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP DATABASE IF EXISTS `quickstart_database`;
CREATE DATABASE `quickstart_database` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `quickstart_database`;

DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `post_id` int NOT NULL,
  `name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `post_id` (`post_id`),
  KEY `fk_comments_user` (`user_id`),
  CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`),
  CONSTRAINT `fk_comments_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `comments` (`id`, `post_id`, `name`, `email`, `content`, `created_at`, `user_id`) VALUES
(1,	1,	'VydiracTankista',	'pavlik67@seznam.cz',	'Tohle není L-10\nTohle má bejt pokud vím obojživelný BTčko',	'2024-07-09 09:55:57',	7),
(2,	2,	'VydiracTankista',	'pavlik67@seznam.cz',	'Jako otvírač konzerv ? XD',	'2024-07-09 09:56:18',	7);

DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `content` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `views` int NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `image` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `status` enum('OPEN','ARCHIVED','CLOSED') CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT 'OPEN',
  `user_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_posts_user` (`user_id`),
  CONSTRAINT `fk_posts_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `posts` (`id`, `title`, `content`, `views`, `created_at`, `image`, `status`, `user_id`) VALUES
(1,	'Skvělý L-10',	'Tento italský zázrak je možná z nejlepších mýtů v Italském inženýrství.',	4,	'2024-07-09 09:44:40',	'upload/WarThunder-WTFMOMENT2.jpeg',	'OPEN',	1),
(2,	'T-55, Sovětský Otvírač',	'Tanky T-54 a T-55 jsou řadou sovětských hlavních bojových tanků zavedených do služby v letech po druhé světové válce. První prototyp T-54 byl dokončen v Nižním Tagilu koncem roku 1945',	4,	'2024-07-09 09:50:12',	'upload/stahovani-1.jpeg',	'OPEN',	5),
(3,	'T-60 / Aka divoch sovětských tanků',	'T-60 byl sovětský lehký tank produkovaný v letech 1941–1942. Celkem bylo vyrobeno asi 6 728 těchto strojů. Jako průzkumný stroj mohl být relativně dobrý, byl však nasazován spolu s tanky T-34 do bojů proti německým tankům, na které nestačil pancéřováním ani výzbrojí.',	3,	'2024-07-09 09:51:04',	'upload/stahovani-2.jpeg',	'OPEN',	5),
(4,	'Jsem tu nový...',	'Co mám tady vůbec dělat ?',	6,	'2024-07-09 09:54:34',	'upload/iqhQ-Fh4ubE.jpeg',	'OPEN',	7),
(5,	'Jo aha tohle je blog pro tankisty',	'Pardon',	5,	'2024-07-09 09:55:19',	'upload/Flag-of-the-Japan-Self-Defense-Forces.svg.png',	'OPEN',	7);

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `surname` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `lastname` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` enum('admin','uzivatel') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'uzivatel',
  `created_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `users` (`id`, `username`, `surname`, `lastname`, `password`, `email`, `role`, `created_at`) VALUES
(1,	'Protosune',	'Filip',	'Janča',	'd5eb45c38c16fb1fb394e7e839e3986a',	'filip.janca@student.ossp.cz',	'uzivatel',	'2024-08-06 11:12:11'),
(2,	'Janoš',	'David',	'Sládka',	'$2y$10$tZt0GidtOceui52rlUR0TuzcH0nPC9tnOAPFXHC/ZU0jLlTVld3lG',	'milin@seznam.cz',	'uzivatel',	'2024-07-09 09:52:46'),
(5,	'EngieerTanker',	'David',	'Kinoš',	'$2y$10$DcSQWedlNnilUXVCY2bzz.BTsmEMQQ6Ki7grGLjJTaPOYEgAhUKfm',	'david5421@gmail.com',	'uzivatel',	'2024-07-09 11:48:38'),
(7,	'VydiracTankista',	'Karel',	'Pilař',	'$2y$10$LNL1aLcMC4TS5I489FsExelfJSEkgAQIpl.1Cy1JmPzby4mc.Wo9m',	'pavlik67@seznam.cz',	'uzivatel',	'2024-07-09 11:53:44'),
(9,	'Crozwell',	'Radim',	'Janča',	'$2y$10$puuCWX4JbrUS5cmPxBfuJO9O1Lzb9xmGdWAOryw0DYz0wXHvkwemK',	'filip.janca2005@seznam.cz',	'admin',	'2024-08-06 11:13:46');

-- 2024-08-06 11:15:06
