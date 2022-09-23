-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 23, 2022 at 07:04 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nurserysystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `children`
--

CREATE TABLE `children` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `age` int(11) NOT NULL,
  `fees` double NOT NULL,
  `accepted` tinyint(1) NOT NULL,
  `nur_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `children`
--

INSERT INTO `children` (`id`, `name`, `age`, `fees`, `accepted`, `nur_id`, `parent_id`) VALUES
(30, 'Musa', 3, 0, 1, 34, 42);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `notf_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `nur_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `child_id` int(11) DEFAULT NULL,
  `notf_of` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`notf_id`, `description`, `nur_id`, `user_id`, `child_id`, `notf_of`) VALUES
(110, 'You Are Accepted at Child Hold, Will Call You Letter', 34, 40, NULL, 'Baby Sitter'),
(112, 'Ibrahim Need You For His Children', NULL, 40, NULL, 'Baby Sitter');

-- --------------------------------------------------------

--
-- Table structure for table `nursery`
--

CREATE TABLE `nursery` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `address` varchar(30) DEFAULT NULL,
  `need_babysitter` tinyint(1) DEFAULT NULL,
  `num_of_children` int(11) DEFAULT NULL,
  `maximum` int(11) DEFAULT NULL,
  `time_of_work` varchar(40) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `raiting` int(11) DEFAULT NULL,
  `manager_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nursery`
--

INSERT INTO `nursery` (`id`, `name`, `image`, `address`, `need_babysitter`, `num_of_children`, `maximum`, `time_of_work`, `price`, `raiting`, `manager_id`) VALUES
(34, 'Child Hold', '6059b217514b38.23483229.jpg', 'Jada', 1, 21, 30, '07:00am - 01:30am', 3000, NULL, 44),
(38, 'khosmo kinder', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 34);

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `report_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `read_it` tinyint(1) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `nursery_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `isVerified` tinyint(1) NOT NULL,
  `rule` varchar(15) NOT NULL,
  `address` varchar(30) DEFAULT NULL,
  `work_hours` varchar(30) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `certif` varchar(100) DEFAULT NULL,
  `img` varchar(100) DEFAULT NULL,
  `accepted` tinyint(1) DEFAULT NULL,
  `nur_id` int(10) DEFAULT NULL,
  `sitter_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `pass`, `phone`, `isVerified`, `rule`, `address`, `work_hours`, `price`, `certif`, `img`, `accepted`, `nur_id`, `sitter_id`) VALUES
(29, 'Alaa', 'Ø×œ]À†äscpè$‡', 'io¾øtþA‚ä\"bYÂ;OÓ', 'O‹ÜÜUÔú?êK‡¾J¬à6', 1, 'Admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(34, 'Mazin', 'G}ôVKS›+:\r›üï¡—Ò', '„ Y¡¨OGãw O<CŠU', 'Ë\nBkø¸\\ß·m×Baô6', 1, 'Nursery Manager', NULL, NULL, NULL, NULL, NULL, NULL, 38, NULL),
(38, 'Sami', 'RPÇ&“np¹ª6¾\\hà¶·', '/wÿ¶»ÕawŽfGjËX£', '“ñsÝû—Ãˆ¥6u×ÜK', 1, 'Nursery Manager', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(40, 'Sara', '.Dß\\Þ…~ÎJe™\0\"P', 'û´·™\0\"2æˆæ§ô>', 'a²6òUr•;îx	­Ç', 1, 'Baby Sitter', 'Maka', '08:05am - 04:30pm', 2000, '605ed0c78c6fd8.26930957.pdf', NULL, NULL, NULL, NULL),
(42, 'Ibrahim', '7có\n‹¾òi)<+ßC]Þ4ê þ…¹¥‚¶ÿmÞ', '§˜R=IÇúŒ?Ë²–Ÿœ9', '`R\r÷\nîÎGˆÛ”8\"', 1, 'Parent', 'Jada', NULL, NULL, NULL, '', 0, NULL, 40),
(43, 'Ibrahim', ']ÄßÃÍ(&Ž£ÍÅ‘@²', ' í+AÁ>¨zÙr1h³†žÚ', 'ªfÒzEP]:ÑÔ¶€ò', 0, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(44, 'Ahmed', ' ‰3°¢Š\0±=ÅÓ8\nXå', '_:OáÆçS2¦ýª®', '3Þd3É™ØÕ\"ù¬', 1, 'Nursery Manager', NULL, NULL, NULL, NULL, '6059b1ec0bd9d9.54048462.jpg', NULL, 34, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_rating`
--

CREATE TABLE `user_rating` (
  `id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `nur_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `children`
--
ALTER TABLE `children`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_children_nur_id` (`nur_id`),
  ADD KEY `fk_children_parent_id` (`parent_id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`notf_id`),
  ADD KEY `fk_notf_parent_id` (`user_id`),
  ADD KEY `FK_notif_nur_id` (`nur_id`),
  ADD KEY `child_id` (`child_id`);

--
-- Indexes for table `nursery`
--
ALTER TABLE `nursery`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_nursery_manage` (`manager_id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`report_id`),
  ADD KEY `parent_id` (`parent_id`),
  ADD KEY `nursery_id` (`nursery_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD KEY `fk_users_nur_id` (`nur_id`),
  ADD KEY `fk_users_parent_id` (`sitter_id`);

--
-- Indexes for table `user_rating`
--
ALTER TABLE `user_rating`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nur_rating_FK` (`nur_id`),
  ADD KEY `parent_rating_FK` (`parent_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `children`
--
ALTER TABLE `children`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `notf_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `nursery`
--
ALTER TABLE `nursery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `user_rating`
--
ALTER TABLE `user_rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `children`
--
ALTER TABLE `children`
  ADD CONSTRAINT `fk_children_nur_id` FOREIGN KEY (`nur_id`) REFERENCES `nursery` (`id`),
  ADD CONSTRAINT `fk_children_parent_id` FOREIGN KEY (`parent_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `FK_notif_nur_id` FOREIGN KEY (`nur_id`) REFERENCES `nursery` (`id`),
  ADD CONSTRAINT `fk_notf_parent_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`child_id`) REFERENCES `children` (`id`);

--
-- Constraints for table `nursery`
--
ALTER TABLE `nursery`
  ADD CONSTRAINT `fk_nursery_manage` FOREIGN KEY (`manager_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `reports_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `reports_ibfk_2` FOREIGN KEY (`nursery_id`) REFERENCES `nursery` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_nur_id` FOREIGN KEY (`nur_id`) REFERENCES `nursery` (`id`),
  ADD CONSTRAINT `fk_users_parent_id` FOREIGN KEY (`sitter_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `user_rating`
--
ALTER TABLE `user_rating`
  ADD CONSTRAINT `nur_rating_FK` FOREIGN KEY (`nur_id`) REFERENCES `nursery` (`id`),
  ADD CONSTRAINT `parent_rating_FK` FOREIGN KEY (`parent_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
