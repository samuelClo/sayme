-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 28 mars 2019 à 06:06
-- Version du serveur :  5.7.24
-- Version de PHP :  7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `chat`
--

-- --------------------------------------------------------

--
-- Structure de la table `channel`
--

DROP TABLE IF EXISTS `channel`;
CREATE TABLE IF NOT EXISTS `channel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1007 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `channel`
--

INSERT INTO `channel` (`id`, `title`, `description`) VALUES
(1, 'mon premier channel', 'test 1'),
(2, 'mon deuxième channel', 'test 2'),
(1000, 'Channel global', ''),
(3, 'le Troisieme channel', 'the best one'),
(1002, 'test', 'test'),
(1003, 'test', 'test'),
(1004, 'mon premier channel', 'GANG BANG !!!!!'),
(1005, 'sam', 'prout'),
(1006, 'sam', 'pitouf');

-- --------------------------------------------------------

--
-- Structure de la table `channel_user`
--

DROP TABLE IF EXISTS `channel_user`;
CREATE TABLE IF NOT EXISTS `channel_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_channel` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `channel_user`
--

INSERT INTO `channel_user` (`id`, `id_user`, `id_channel`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 2),
(4, 2, 2),
(5, 6, 1),
(6, 6, 2),
(8, 1, 1000),
(9, 2, 1000),
(10, 3, 1000),
(11, 5, 1000),
(12, 5, 1000),
(13, 3, 1000),
(14, 2, 3),
(15, 2, 1001),
(16, 2, 1001),
(17, 1, 1003),
(19, 3, 1000),
(20, 2, 1000),
(21, 6, 1000),
(22, 7, 1000),
(23, 8, 1000),
(24, 10, 1000),
(25, 1, 1004),
(26, 14, 1000),
(27, 15, 1000),
(28, 15, 1000),
(29, 2, 1005),
(30, 3, 1005),
(31, 5, 1005),
(32, 1, 1006),
(33, 2, 1006),
(34, 3, 1006);

-- --------------------------------------------------------

--
-- Structure de la table `chat_user`
--

DROP TABLE IF EXISTS `chat_user`;
CREATE TABLE IF NOT EXISTS `chat_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `is_connected` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `chat_user`
--

INSERT INTO `chat_user` (`id`, `name`, `firstname`, `pseudo`, `password`, `email`, `color`, `is_connected`) VALUES
(1, 'Richard', 'Dupuis', 'RichardD', 'd41d8cd98f00b204e9800998ecf8427e', 'fffffff@ffff.ff', '#8a3172', 1),
(2, 'Giulia', 'Zimpa', 'GiuliaZ', 'd41d8cd98f00b204e9800998ecf8427e', 'bbbbbbbbb@bbbb.bb', '#cc9d73', 0),
(3, 'leo', 'leGrand', 'leoL', '25f9e794323b453885f5181f1b624d0b', 'leo.leGrand@gmail.com', 'green', 1),
(5, 'zoupati', 'clopain', 'zoupatiC', '25f9e794323b453885f5181f1b624d0b', 'zoupati.clopain@mail.fr', 'darkblue', 0),
(6, 'Sam', 'Caca', 'Prout', '25f9e794323b453885f5181f1b624d0b', 'samuel.cloarec@hotmail.fr', '#42be05', 0),
(13, 'sam', 'sam', 'sam', '25f9e794323b453885f5181f1b624d0b', 'sam@sdfsdfsdf', 'red', 0),
(7, 'CLOAREC', 'samuel', 'SamClo', '25f9e794323b453885f5181f1b624d0b', 'patatipatata@hotmail.fr', '#4691b9', 0),
(8, 'sam', 'sam', 'sam', '25f9e794323b453885f5181f1b624d0b', 'sam@sam', '#800080', 0),
(14, 'jkl', 'jkl', 'jkl', 'jkl', 'jkl', 'jkl', 0),
(15, 'io', 'piop', 'iop', 'iop', 'iop', 'iop', 0);

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text CHARACTER SET utf8mb4 NOT NULL,
  `user_id` int(11) NOT NULL,
  `time` datetime(3) DEFAULT NULL,
  `channel_id` int(11) NOT NULL DEFAULT '1000',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=539 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`id`, `content`, `user_id`, `time`, `channel_id`) VALUES
(489, 'eheh', 1, '2019-03-25 11:00:42.550', 1000),
(490, 'channel global', 1, '2019-03-25 11:07:16.271', 1000),
(491, 'channel ^partagé avec giu', 1, '2019-03-25 11:07:25.255', 1),
(488, 'prout', 1, '2019-03-25 10:59:45.353', 1),
(487, 'caca', 1, '2019-03-25 10:59:37.596', 1),
(485, 'caca', 1, '2019-03-25 10:56:47.637', 1000),
(498, 'ca fais longtemp', 2, '2019-03-25 11:30:38.689', 2),
(497, 'He leo', 2, '2019-03-25 11:30:34.998', 2),
(482, 'sam', 1, '2019-03-25 10:22:06.900', 1),
(500, 'je suis léo ', 3, '2019-03-25 11:31:32.372', 1000),
(499, 'hey giu ca vas et toi ?', 3, '2019-03-25 11:31:21.840', 2),
(493, 'blue my bitch', 5, '2019-03-25 11:28:54.613', 1000),
(492, 'waaa', 5, '2019-03-25 11:28:45.684', 1000),
(496, 'how are you ?', 2, '2019-03-25 11:30:27.710', 1),
(495, 'hey richard', 2, '2019-03-25 11:30:21.751', 1),
(494, 'wesh c\'est giu', 2, '2019-03-25 11:30:12.241', 1000),
(501, 'khjhkj', 1, '2019-03-25 11:44:42.550', 1000),
(502, 'date', 1, '2019-03-25 12:50:31.922', 1000),
(503, 's', 1, '2019-03-25 12:50:40.647', 1000),
(504, 's', 1, '2019-03-25 12:50:40.770', 1000),
(505, 's', 1, '2019-03-25 12:50:41.490', 1000),
(506, 's', 1, '2019-03-25 12:50:41.161', 1000),
(507, 's', 1, '2019-03-25 12:50:41.420', 1000),
(508, 's', 1, '2019-03-25 12:50:41.533', 1000),
(509, 'zzzzz', 1, '2019-03-25 13:27:16.930', 1000),
(510, 'sam', 1, '2019-03-25 13:48:47.860', 1000),
(511, 'sam', 6, '2019-03-25 15:53:45.346', 1000),
(512, 'sam', 6, '2019-03-25 15:53:49.994', 1000),
(513, 'sam', 6, '2019-03-25 15:53:56.310', 1000),
(514, 'sam', 6, '2019-03-25 15:54:26.655', 1000),
(515, 'sam', 2, '2019-03-25 16:03:07.966', 1),
(516, 'sam', 2, '2019-03-25 16:03:11.619', 2),
(517, 'iugiyg', 1, '2019-03-25 16:07:16.271', 1000),
(518, 'rzrezrer', 2, '2019-03-25 16:17:47.900', 1000),
(519, 'hey', 6, '2019-03-25 17:34:26.000', 1),
(520, 'sam', 2, '2019-03-26 01:40:00.440', 1000),
(521, 'sam', 7, '2019-03-26 15:02:16.223', 1000),
(522, 'w', 2, '2019-03-26 18:31:52.250', 1000),
(523, ' 😄 😆 😆 😆 😆', 2, '2019-03-26 22:51:18.918', 1000),
(524, 'eheh', 2, '2019-03-26 23:02:55.437', 1000),
(525, 'sam', 2, '2019-03-26 23:25:27.395', 1000),
(526, ' 😚', 8, '2019-03-27 12:17:59.790', 1000),
(527, 'saù', 8, '2019-03-27 14:09:02.569', 1000),
(528, ' 😱caca', 8, '2019-03-27 14:09:11.714', 1000),
(529, 'thfjnt', 8, '2019-03-27 14:09:18.920', 1000),
(530, 'sam', 1, '2019-03-27 21:29:57.678', 1000),
(531, ' 😩', 1, '2019-03-28 00:17:00.900', 1),
(532, 'sam', 1, '2019-03-28 04:27:41.930', 1000),
(533, 'walou', 1, '2019-03-28 04:57:27.213', 1006),
(534, 'giu', 2, '2019-03-28 05:05:42.550', 1000),
(535, 'rich', 1, '2019-03-28 05:05:45.550', 1000),
(536, 'rich', 1, '2019-03-28 05:06:45.550', 1000),
(537, 'rich', 1, '2019-03-28 05:08:45.550', 1000),
(538, 'sam', 6, '2019-03-28 05:36:32.833', 1000);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
