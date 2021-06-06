-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 05, 2021 at 06:08 PM
-- Server version: 8.0.21
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+07:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment_post`
--

DROP TABLE IF EXISTS `comment_post`;
CREATE TABLE IF NOT EXISTS `comment_post` (
  `com_id` int NOT NULL AUTO_INCREMENT,
  `post_id` int NOT NULL,
  `com_parent` int NOT NULL DEFAULT '0',
  `user_com` int NOT NULL,
  `body` text NOT NULL,
  `date_com` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`com_id`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `liked_post`
--

DROP TABLE IF EXISTS `liked_post`;
CREATE TABLE IF NOT EXISTS `liked_post` (
  `id_post` int NOT NULL,
  `id_user` int NOT NULL,
  `date_like` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
)   ;

--
-- Dumping data for table `liked_post`

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

DROP TABLE IF EXISTS `post`;
CREATE TABLE IF NOT EXISTS `post` (
  `id` int NOT NULL AUTO_INCREMENT,
  `img` varchar(255) NOT NULL,
  `title` text NOT NULL,
  `body` text NOT NULL,
  `author` int NOT NULL,
  `date_create` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modifly` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
)     ;

--
-- Dumping data for table `post`
--



-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` char(255) NOT NULL,
  `pwhash` varchar(255)   NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `role` varchar(255)   DEFAULT '1',
  `img` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
)  ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `pwhash`, `date_created`, `role`, `img`) VALUES
(1, 'admin', 'admin@admin.com', '$2y$10$vddgsfAz8/OPmrW4hfjDaO/DET6TtOrugdug3ZURP75w6h8AxqP7e', '2021-05-26 11:53:38', '2', './assets/images/avatar_default.jpg');

COMMIT;


