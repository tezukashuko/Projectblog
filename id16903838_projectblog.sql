-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 21, 2022 at 06:10 AM
-- Server version: 10.5.12-MariaDB
-- PHP Version: 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id16903838_projectblog`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment_post`
--

CREATE TABLE `comment_post` (
  `com_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `com_parent` int(11) NOT NULL DEFAULT 0,
  `user_com` int(11) NOT NULL,
  `body` text COLLATE utf8_unicode_ci NOT NULL,
  `date_com` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `comment_post`
--

INSERT INTO `comment_post` (`com_id`, `post_id`, `com_parent`, `user_com`, `body`, `date_com`) VALUES
(1, 1, 0, 1, 'jnjnjnj', '2021-06-05 18:46:49'),
(2, 1, 0, 2, ' v vvgvg', '2021-06-05 18:48:45'),
(3, 2, 0, 1, 'asdasd', '2021-06-05 18:49:43'),
(4, 1, 0, 1, 'cfcf', '2021-06-05 18:50:01'),
(5, 2, 0, 2, 'asdasd', '2021-06-05 18:50:22'),
(7, 2, 0, 3, '123123', '2021-06-06 03:05:08'),
(8, 4, 0, 4, 'dang cai gi nhu con cac\n', '2021-06-06 08:46:56'),
(9, 5, 0, 1, 'Wao, right man', '2021-06-06 09:43:49'),
(11, 5, 0, 10, 'cool\n', '2021-07-16 04:55:40');

-- --------------------------------------------------------

--
-- Table structure for table `liked_post`
--

CREATE TABLE `liked_post` (
  `id_post` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `date_like` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `liked_post`
--

INSERT INTO `liked_post` (`id_post`, `id_user`, `date_like`) VALUES
(1, 2, '2021-06-05 18:48:51'),
(2, 2, '2021-06-05 18:49:13'),
(2, 1, '2021-06-05 18:49:38'),
(3, 3, '2021-06-06 03:17:04'),
(2, 3, '2021-06-06 03:17:05'),
(4, 3, '2021-06-06 03:48:15'),
(4, 4, '2021-06-06 08:46:45'),
(5, 4, '2021-06-06 09:40:15'),
(6, 1, '2021-06-06 14:09:01'),
(8, 1, '2021-06-06 15:53:23'),
(9, 8, '2021-06-06 17:35:00'),
(5, 10, '2021-07-16 04:55:32'),
(5, 1, '2021-11-29 03:25:53'),
(10, 1, '2021-11-29 03:25:58');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `img` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` text COLLATE utf8_unicode_ci NOT NULL,
  `body` text COLLATE utf8_unicode_ci NOT NULL,
  `author` int(11) NOT NULL,
  `date_create` datetime NOT NULL DEFAULT current_timestamp(),
  `date_modifly` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `img`, `title`, `body`, `author`, `date_create`, `date_modifly`) VALUES
(1, './assets/post_img/60bbc691ac79e.jpeg', 'test1', 'test1', 1, '2021-06-05 18:46:41', '2021-06-05 18:47:56'),
(2, './assets/post_img/post_default.png', 'hehe', 'hehe', 2, '2021-06-05 18:49:00', '2021-06-05 18:49:00'),
(3, './assets/post_img/60bbcacee70ec.jpeg', 'Tks to create post ', 'Luv you so much ', 1, '2021-06-05 19:04:46', '2021-06-05 19:04:46'),
(4, './assets/post_img/post_default.png', 'aaaaaa', 'bbbbbbbbbb', 3, '2021-06-06 03:48:11', '2021-06-06 03:48:11'),
(5, './assets/post_img/60bc8b62b1c01.jpeg', '[PIN] How to speak Quảng Nôm accent? ', 'Just replace &#34;a&#34; with &#34;ô&#34;.\r\nEx : số 8 - số tám - số tốm', 4, '2022-06-06 08:46:26', '2021-06-06 08:46:26'),
(6, './assets/post_img/60bc9a71e01f5.jpeg', 'This is exercises I do in Physical Chemistry II', 'Too hard to pass :)))', 5, '2021-06-06 06:48:31', '2021-06-06 10:55:58'),
(7, './assets/post_img/60bcd35510bb8.jpeg', 'Test Free', 'nice web bro :)))', 7, '2021-06-05 13:53:25', '2021-06-06 13:53:25'),
(8, './assets/post_img/60bcd5dac181c.jpeg', 'testtimezone again ', 'minor bug :(( ', 1, '2021-06-05 14:04:10', '2021-06-06 14:04:10'),
(9, './assets/post_img/60bd04bf93557.gif', 'Beautiful blog', 'This blog&#39;s owner maybe the next CEO of Facebook or Google', 8, '2021-06-06 17:24:15', '2021-06-06 17:24:15'),
(10, './assets/post_img/60bd0549f3b2b.jpeg', 'Boring', 'Bớt dịch ik để tui ik chơi nựa', 9, '2021-06-06 17:26:34', '2021-06-06 17:26:34');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` char(255) COLLATE utf8_unicode_ci NOT NULL,
  `pwhash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `role` varchar(255) COLLATE utf8_unicode_ci DEFAULT '1',
  `img` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `pwhash`, `date_created`, `role`, `img`) VALUES
(1, 'admin', 'admin@admin.com', '$2y$10$vddgsfAz8/OPmrW4hfjDaO/DET6TtOrugdug3ZURP75w6h8AxqP7e', '2021-05-26 11:53:38', '2', './assets/images/avatar_default.jpg'),
(2, 'test1', 'tezukashuko@gmail.com', '$2y$10$ghuigwtxMdSkIjaM44c6/ueRUqL7c9u/jidFhNEa3lv2H2Zzc7zdW', '2021-06-05 18:48:31', '1', './assets/images/avatar_default.jpg'),
(3, 'qweasdzxc', 'dasdsafsljdfkh@gmail.com', '$2y$10$CmoQQSsp5Q1AAQ9iwL5ez.qhV0PIRIwrgnfIkmPPqy4aGHs7kDgcW', '2021-06-06 03:04:41', '1', './assets/images/avatar_default.jpg'),
(4, 'congduy1', 'tonyvu1289@gmail.com', '$2y$10$hH5AFTmSFc4YZZjPzBh9veLqHTJiTqfs1MsCC/Uhbxf3PNcnWHGF6', '2021-06-06 08:45:02', '1', './assets/images/60bc8b0e06fde.jpeg'),
(5, 'cqeqwezc', 'manhtran240100@gmail.com', '$2y$10$N7JYT83TdH55PGddTa2wauJJ5Ui98IDFr6YhJC13tcbycqsrLq5mm', '2021-06-06 09:45:12', '1', './assets/images/60bc99284a47d.jpeg'),
(6, 'fuckyoubitch:>', 'thacker06042631@gmail.com', '$2y$10$TB0sq4QMCoVSx13ZHPL1cOQ3j873hyKlTpaU3j1xc.jWtxvbISHle', '2021-06-06 13:45:07', '1', './assets/images/avatar_default.jpg'),
(7, 'TienTrung', 'thacker06042631@gmail.com', '$2y$10$xePtNI3ov1Bv7fWavgeke.0yILJGI5WVbJOojP5hgSmle36PtXIr.', '2021-06-06 13:52:02', '1', './assets/images/avatar_default.jpg'),
(8, 'JustTory', 'johnnynathany@gmail.com', '$2y$10$d2EbutDwG8MzJHDoOoY85OE100VQFsNtaQZ.SqmKFqOZutamLPt4u', '2021-06-06 17:23:22', '1', './assets/images/60bd0489ed020.jpeg'),
(9, 'hihello', '123vyvy@gmail.com', '$2y$10$OBePE.4mK8tVHwNosSRxeObNHHh2zzOaEwcDPMkSDc2H8giCY2J2e', '2021-06-06 17:25:30', '1', './assets/images/avatar_default.jpg'),
(10, 'itec2021', 'austinma@hawaii.edu', '$2y$10$AS.1QXjPPZSBihOVha30heapVY7zXF9tFzOrySeXaHKD.6AfzhiNq', '2021-07-16 04:55:23', '1', './assets/images/60f1113b462ba.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment_post`
--
ALTER TABLE `comment_post`
  ADD PRIMARY KEY (`com_id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment_post`
--
ALTER TABLE `comment_post`
  MODIFY `com_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
