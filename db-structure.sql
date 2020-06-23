-- Adminer 4.2.5 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP DATABASE IF EXISTS `test`;
CREATE DATABASE `test` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `test`;

DROP TABLE IF EXISTS `contacts`;
CREATE TABLE `contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `lastName` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `userId` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `contacts` (`id`, `name`, `lastName`, `email`, `phone`, `image`, `userId`) VALUES
(1,	'Николай',	'Ксендзык',	'test-student-on-line2@mail.ru',	'89241958392',	'',	2),
(15,	'Дмитрий',	'Мусяченко',	'test-student-on-line2@mail.ru',	'55555',	'uploads/2/60547.jpg',	3);

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `users` (`id`, `login`, `email`, `password`) VALUES
(1,	'F273',	'test-student-on-line2@mail.ru',	'3de0f17a8ad53005c1ac787abe570823'),
(2,	'F274',	'test-student-on-line3@mail.ru',	'e120ea280aa50693d5568d0071456460'),
(3,	'F696',	'dimati9@yandex.ru',	'e120ea280aa50693d5568d0071456460');

-- 2020-06-23 17:08:40
