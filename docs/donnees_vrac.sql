-- Adminer 4.7.6 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `casting`;
CREATE TABLE `casting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `person_id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `role` varchar(100) NOT NULL,
  `credit_order` smallint(6) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D11BBA50217BBB47` (`person_id`),
  KEY `IDX_D11BBA508F93B6FC` (`movie_id`),
  CONSTRAINT `FK_D11BBA50217BBB47` FOREIGN KEY (`person_id`) REFERENCES `person` (`id`),
  CONSTRAINT `FK_D11BBA508F93B6FC` FOREIGN KEY (`movie_id`) REFERENCES `movie` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `casting` (`id`, `person_id`, `movie_id`, `role`, `credit_order`) VALUES
(1,	1,	7,	'Rocky Balboa',	1),
(2,	2,	7,	'Apollo Creed',	2),
(3,	3,	6,	'L\'ane',	2),
(4,	4,	6,	'Shrek',	1);

-- DROP TABLE IF EXISTS `doctrine_migration_versions`;
-- CREATE TABLE `doctrine_migration_versions` (
--   `version` varchar(191) NOT NULL,
--   `executed_at` datetime DEFAULT NULL,
--   `execution_time` int(11) DEFAULT NULL,
--   PRIMARY KEY (`version`)
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
-- ('DoctrineMigrations\\Version20230919115011',	'2023-09-19 13:57:19',	30),
-- ('DoctrineMigrations\\Version20230919121847',	'2023-09-19 14:18:57',	28),
-- ('DoctrineMigrations\\Version20230920092856',	'2023-09-20 11:29:07',	118),
-- ('DoctrineMigrations\\Version20230920111329',	'2023-09-20 13:13:33',	61),
-- ('DoctrineMigrations\\Version20230920113455',	'2023-09-20 13:34:59',	31),
-- ('DoctrineMigrations\\Version20230921111440',	'2023-09-21 13:14:48',	65),
-- ('DoctrineMigrations\\Version20230921120253',	'2023-09-21 14:03:00',	96);

DROP TABLE IF EXISTS `genre`;
CREATE TABLE `genre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `genre` (`id`, `name`) VALUES
(1,	'Drama de daronnes'),
(2,	'Drama de daronnes'),
(3,	'Aventure'),
(4,	'Animation'),
(5,	'Boxe'),
(6,	'Drame');

DROP TABLE IF EXISTS `genre_movie`;
CREATE TABLE `genre_movie` (
  `genre_id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  PRIMARY KEY (`genre_id`,`movie_id`),
  KEY `IDX_A058EDAA4296D31F` (`genre_id`),
  KEY `IDX_A058EDAA8F93B6FC` (`movie_id`),
  CONSTRAINT `FK_A058EDAA4296D31F` FOREIGN KEY (`genre_id`) REFERENCES `genre` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_A058EDAA8F93B6FC` FOREIGN KEY (`movie_id`) REFERENCES `movie` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `genre_movie` (`genre_id`, `movie_id`) VALUES
(1,	4),
(2,	5),
(3,	5),
(3,	6),
(4,	6),
(5,	7),
(6,	7);

DROP TABLE IF EXISTS `movie`;
CREATE TABLE `movie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `release_date` date NOT NULL,
  `duration` int(11) NOT NULL,
  `type` varchar(10) NOT NULL,
  `summary` varchar(200) NOT NULL,
  `synopsis` longtext NOT NULL,
  `poster` varchar(2083) DEFAULT NULL,
  `rating` decimal(2,1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `movie` (`id`, `title`, `release_date`, `duration`, `type`, `summary`, `synopsis`, `poster`, `rating`) VALUES
(4,	'Desperate housewives',	'2001-07-04',	94,	'Série',	'Wisteria Lane est un lieu paisible où les habitants semblent mener une vie heureuse...',	'Wisteria Lane est un lieu paisible où les habitants semblent mener une vie heureuse... en apparence seulement ! Car en y regardant de plus près, on découvre bien vite, dans l\'intimité de chacun, que le bonheur n\'est pas toujours au rendez-vous. Et peu à peu, les secrets remontent inévitablement à la surface, risquant de faire voler en éclat le vernis lisse de leur tranquille existence...',	'https://fr.web.img4.acsta.net/pictures/18/10/29/17/57/1200682.jpg',	2.5),
(5,	'Stranger Things',	'2001-07-04',	94,	'Série',	'Wisteria Lane est un lieu paisible où les habitants semblent mener une vie heureuse...',	'Wisteria Lane est un lieu paisible où les habitants semblent mener une vie heureuse... en apparence seulement ! Car en y regardant de plus près, on découvre bien vite, dans l\'intimité de chacun, que le bonheur n\'est pas toujours au rendez-vous. Et peu à peu, les secrets remontent inévitablement à la surface, risquant de faire voler en éclat le vernis lisse de leur tranquille existence...',	'https://fr.web.img4.acsta.net/pictures/22/05/18/14/31/5186184.jpg',	2.5),
(6,	'SHREK',	'2023-09-21',	93,	'Film',	'Shrek, un ogre verdâtre, cynique et malicieux.',	'Shrek, un ogre verdâtre, cynique et malicieux, a élu domicile dans un marécage qu\'il croit être un havre de paix. Un matin, alors qu\'il sort faire sa toilette, il découvre de petites créatures agaçantes qui errent dans son marais.\r\nShrek se rend alors au château du seigneur Lord Farquaad, qui aurait soit-disant expulsé ces êtres de son royaume. Ce dernier souhaite épouser la princesse Fiona, mais celle-ci est retenue prisonnière par un abominable dragon.\r\nIl lui faut un chevalier assez brave pour secourir la belle. Shrek accepte d\'accomplir cette mission. En échange, le seigneur devra débarrasser son marécage de ces créatures envahissantes.\r\nOr, la princesse Fiona cache un secret terrifiant qui va entraîner Shrek et son compagnon l\'âne dans une palpitante et périlleuse aventure.',	'https://fr.web.img2.acsta.net/medias/nmedia/00/00/00/66/69199338_af.jpg',	4.9),
(7,	'ROCKY',	'2023-09-21',	99,	'Film',	'Dans les quartiers populaires de Philadelphie, Rocky Balboa dispute de temps à autre,',	'Dans les quartiers populaires de Philadelphie, Rocky Balboa dispute de temps à autre, pour quelques dizaines de dollars, des combats de boxe sous l\'appellation de \"l\'étalon italien\". Cependant, Mickey, son vieil entraîneur, le laisse tomber. Pendant ce temps, Apollo Creed, le champion du monde de boxe catégorie poids lourd, recherche un nouvel adversaire pour remettre son titre en jeu. Son choix se portera sur Rocky.\r\n',	'https://images-na.ssl-images-amazon.com/images/S/pv-target-images/2596301d69a4d0ce86a41d4ef6fdb5e19eabe66ac45cab63eeb97dc45d840254._RI_TTW_.jpg',	4.9);

DROP TABLE IF EXISTS `person`;
CREATE TABLE `person` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `person` (`id`, `firstname`, `lastname`) VALUES
(1,	'Sylvester',	'Stallone'),
(2,	'Carl',	'Weathers'),
(3,	'Eddie',	'Murphy'),
(4,	'Alain',	'Chabat');

DROP TABLE IF EXISTS `season`;
CREATE TABLE `season` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `movie_id` int(11) NOT NULL,
  `number` smallint(6) NOT NULL,
  `episodes_number` smallint(6) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_F0E45BA98F93B6FC` (`movie_id`),
  CONSTRAINT `FK_F0E45BA98F93B6FC` FOREIGN KEY (`movie_id`) REFERENCES `movie` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `season` (`id`, `movie_id`, `number`, `episodes_number`) VALUES
(1,	4,	1,	8),
(2,	4,	2,	10),
(3,	4,	3,	7);

-- 2023-09-21 12:58:59