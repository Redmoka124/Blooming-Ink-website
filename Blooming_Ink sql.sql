-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 25, 2026 at 02:34 PM
-- Server version: 11.8.3-MariaDB-log
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u349417773_redmon22_final`
--

-- --------------------------------------------------------

--
-- Table structure for table `blogposts`
--

CREATE TABLE `blogposts` (
  `blogpost_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `blogpost_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `blogpost_body` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `blogpost_timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blogposts`
--

INSERT INTO `blogposts` (`blogpost_id`, `user_id`, `blogpost_title`, `blogpost_body`, `blogpost_timestamp`) VALUES
(9, 1, 'Gravity', 'I have studied the orbits of planets,\r\nthe way they lean toward the sun\r\nwithout ever meaning to —\r\ndrawn not by choice\r\nbut by something older than choice.\r\nThat is how I found you.\r\nNot searching,\r\njust falling\r\nin the only direction that made sense.', '2026-03-11 12:57:27'),
(10, 3, 'Thresholds', 'I have always lived in doorways —\r\none foot in, one foot out,\r\nbelonging fully to neither side.\r\nIt used to feel like a flaw.\r\nNow I think it might be\r\nthe only honest way\r\nto exist in a world\r\nthis complicated.', '2026-03-11 13:15:15'),
(11, 4, 'Nine Lives', 'I have died in small ways\r\nmore times than I can count —\r\nburned through versions of myself\r\nlike cigarettes,\r\neach one lit from the last.\r\nAnd every time\r\nthey thought I was finished,\r\nI came back\r\nwearing something nicer\r\nand taking more than I came for.', '2026-03-11 13:15:15'),
(12, 11, 'Overgrowth', 'They called it overgrowth —\r\nlike the land was doing something wrong\r\nby reclaiming what was always hers.\r\nBut I have watched the way ivy\r\ntakes back a wall,\r\nslow and certain and without apology,\r\nand I have never once\r\nthought it was the ivy\'s fault.\r\nSome things are just\r\nreturning to where they belong.', '2026-03-11 13:15:15'),
(13, 9, 'To Do List', 'Wake up.\r\nLook incredible.\r\nCommit at least one act\r\nof mild chaos.\r\nLunch.\r\nReconsider everything.\r\nDon\'t.\r\nBed.\r\n\r\nTomorrow: repeat.', '2026-03-11 13:15:15'),
(14, 7, 'Resilience, Technically Speaking', 'I looked it up once —\r\nthe definition of resilience.\r\nThe ability of a substance\r\nto spring back\r\ninto shape after being bent,\r\ncompressed,\r\nor stretched.\r\nI thought about that for a long time.\r\nI do not think I sprang back.\r\nI think I was compressed\r\nfor so long\r\nthat I became something denser —\r\nsomething that does not bend\r\nquite as easily\r\nas it used to.\r\nI am not sure that is the same thing.\r\nI think it might be better.', '2026-03-11 13:20:50');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `blogpost_id` int(11) NOT NULL,
  `comment_body` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `comment_timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `user_id`, `blogpost_id`, `comment_body`, `comment_timestamp`) VALUES
(3, 10, 14, 'Such a beautiful poem!', '2026-03-11 21:51:39');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `fname` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `lname` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `email` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `pass` char(64) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `registration_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_admin` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `fname`, `lname`, `email`, `pass`, `registration_date`, `is_admin`) VALUES
(1, 'Kori', 'Anders', 'Starfire@gmail.com', 'starfire', '2026-03-07 18:06:30', 0),
(3, 'Rachel', 'Roth', 'Raven@gmail.com', 'Raven', '2026-03-07 18:09:42', 0),
(4, 'Selina', 'Kyle', 'Catwomen@gmail.com', 'Catwomen', '2026-03-07 18:09:42', 0),
(7, 'Barbara', 'Gordon', 'Batgirl@gmail.com', 'Batgirl', '2026-03-07 18:12:08', 0),
(9, 'Harleen', 'Quinzel', 'Harleyquinn@gmail.com', 'Harleyquinn', '2026-03-07 18:16:55', 0),
(10, 'Cassandra', 'Cain', 'Batgirl2@gmail.com', '8f377a7642a0fba9451e3e7c39d4cf9cf21958eb99a78f9f4a22503553c189c0', '2026-03-07 22:35:00', NULL),
(11, 'Pamela', 'Isley', 'PoisonIvy@gmail.com', 'fbf8336e9f01d3cac1eac038d63fa09e6678aaaa0420bf7e870b0647605e2a2e', '2026-03-09 12:58:59', NULL),
(12, 'Richard', 'Greyson', 'nightwing@gmail.com', '52edb8d8b047944fdf4d4b15df5d6a9160737910ee54a21ddf97d51c8bf3902c', '2026-03-09 16:35:33', NULL),
(13, 'Damian', 'Wayne', 'robin4@gmail.com', 'eda1d03ba12add2ae18822afd96e70bd7b33eaafa5745bf86b5d7e4b5677d457', '2026-03-09 16:44:35', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blogposts`
--
ALTER TABLE `blogposts`
  ADD PRIMARY KEY (`blogpost_id`),
  ADD KEY `fk_blogposts_user` (`user_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `comments_ibfk_2` (`blogpost_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blogposts`
--
ALTER TABLE `blogposts`
  MODIFY `blogpost_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blogposts`
--
ALTER TABLE `blogposts`
  ADD CONSTRAINT `fk_blogposts_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`blogpost_id`) REFERENCES `blogposts` (`blogpost_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
