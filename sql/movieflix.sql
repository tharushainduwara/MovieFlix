-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 04, 2025 at 10:25 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `movieflix`
--
CREATE DATABASE IF NOT EXISTS `movieflix` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `movieflix`;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`) VALUES
(1, 'Action', 'Exciting action-packed movies'),
(2, 'Comedy', 'Funny and entertaining movies'),
(3, 'Drama', 'Emotional and serious movies'),
(4, 'Sci-Fi', 'Science fiction movies'),
(5, 'Horror', 'Scary and thrilling movies');

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE IF NOT EXISTS `movies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `rating` decimal(3,1) DEFAULT NULL,
  `poster_url` varchar(500) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`id`, `title`, `description`, `year`, `category_id`, `rating`, `poster_url`, `created_at`) VALUES
(1, 'The Matrix Resurrections', 'Return to the reality-bending universe', 2021, 4, 7.5, 'images\\matrix.jpg', '2025-10-22 21:44:51'),
(2, 'Spider-Man: No Way Home', 'The multiverse breaks open', 2021, 1, 8.3, 'https://m.media-amazon.com/images/M/MV5BZWMyYzFjYTYtNTRjYi00OGExLWE2YzgtOGRmYjAxZTU3NzBiXkEyXkFqcGdeQXVyMzQ0MzA0NTM@._V1_FMjpg_UX1000_.jpg', '2025-10-22 21:44:51'),
(3, 'Dune', 'Epic adaptation of the sci-fi classic', 2021, 4, 8.1, 'https://m.media-amazon.com/images/M/MV5BN2FjNmEyNWMtYzM0ZS00NjIyLTg5YzYtYThlMGVjNzE1OGViXkEyXkFqcGdeQXVyMTkxNjUyNQ@@._V1_FMjpg_UX1000_.jpg', '2025-10-22 21:44:51'),
(4, 'No Time To Die', 'James Bond returns for his final mission', 2021, 1, 7.4, 'images\\no time to die.jpeg', '2025-10-22 21:44:51'),
(5, 'The Batman', 'Dark knight returns to protect Gotham', 2022, 1, 8.2, 'https://m.media-amazon.com/images/M/MV5BMDdmMTBiNTYtMDIzNi00NGVlLWIzMDYtZTk3MTQ3NGQxZGEwXkEyXkFqcGdeQXVyMzMwOTU5MDk@._V1_FMjpg_UX1000_.jpg', '2025-10-22 21:44:51'),
(6, 'Black Widow', 'Natasha Romanoff confronts her past', 2021, 1, 6.8, 'https://m.media-amazon.com/images/M/MV5BNjRmNDI5MjMtMmFhZi00YzcwLWI4ZGItMGI2MjI0N2Q3YmIwXkEyXkFqcGdeQXVyMTkxNjUyNQ@@._V1_FMjpg_UX1000_.jpg', '2025-10-22 21:44:51'),
(7, 'Shang-Chi', 'Master of martial arts confronts his past', 2021, 1, 7.5, 'https://m.media-amazon.com/images/M/MV5BNTliYjlkNDQtMjFlNS00NjgzLWFmMWEtYmM2Mzc2Zjg3ZjEyXkEyXkFqcGdeQXVyMTkxNjUyNQ@@._V1_FMjpg_UX1000_.jpg', '2025-10-22 21:44:51'),
(8, 'Eternals', 'Ancient aliens emerge from shadows', 2021, 1, 6.4, 'https://m.media-amazon.com/images/M/MV5BMTExZmVjY2ItYTAzYi00MDdlLWFlOWItNTJhMDRjMzQ5ZGY0XkEyXkFqcGdeQXVyODIyOTEyMzY@._V1_FMjpg_UX1000_.jpg', '2025-10-22 21:44:51'),
(9, 'Avengers: Endgame', 'The epic conclusion to the Infinity Saga', 2019, 1, 8.4, 'https://m.media-amazon.com/images/M/MV5BMTc5MDE2ODcwNV5BMl5BanBnXkFtZTgwMzI2NzQ2NzM@._V1_FMjpg_UX1000_.jpg', '2025-10-22 21:44:51'),
(10, 'The Super Mario Bros. Movie', 'Mario and Luigi adventure in the Mushroom Kingdom', 2023, 2, 7.1, 'https://m.media-amazon.com/images/M/MV5BOTJhNzlmNzctNTU5Yy00N2YwLThhMjQtZDM0YjEzN2Y0ZjNhXkEyXkFqcGdeQXVyMTEwMTQ4MzU5._V1_FMjpg_UX1000_.jpg', '2025-10-22 21:44:51'),
(11, 'The Shawshank Redemption', 'Two imprisoned men bond over a number of years', 1994, 3, 9.3, 'https://m.media-amazon.com/images/M/MV5BNDE3ODcxYzMtY2YzZC00NmNlLWJiNDMtZDViZWM2MzIxZDYwXkEyXkFqcGdeQXVyNjAwNDUxODI@._V1_FMjpg_UX1000_.jpg', '2025-10-22 21:44:51'),
(12, 'Interstellar', 'A team of explorers travel through a wormhole in space', 2014, 4, 8.6, 'https://m.media-amazon.com/images/M/MV5BZjdkOTU3MDktN2IxOS00OGEyLWFmMjktY2FiMmZkNWIyODZiXkEyXkFqcGdeQXVyMTMxODk2OTU@._V1_FMjpg_UX1000_.jpg', '2025-10-22 21:44:51'),
(13, 'The Conjuring', 'Paranormal investigators help a family terrorized by a dark presence', 2013, 5, 7.5, 'https://m.media-amazon.com/images/M/MV5BMTM3NjA1NDMyMV5BMl5BanBnXkFtZTcwMDQzNDMzOQ@@._V1_FMjpg_UX1000_.jpg', '2025-10-22 21:44:51'),
(14, 'John Wick: Chapter 4', 'John Wick uncovers a path to defeating The High Table', 2023, 1, 7.7, 'images\\john wick 4.jpg', '2025-10-22 21:44:51'),
(15, 'Guardians of the Galaxy Vol. 3', 'The Guardians protect one of their own', 2023, 4, 7.9, 'https://m.media-amazon.com/images/M/MV5BMDgxOTdjMzYtZGQxMS00ZTAzLWI4Y2UtMTQzN2VlYjYyZWRiXkEyXkFqcGdeQXVyMTkxNjUyNQ@@._V1_FMjpg_UX1000_.jpg', '2025-10-22 21:44:51'),
(16, 'Inception', 'A thief who steals corporate secrets through dream-sharing technology', 2010, 4, 8.8, 'https://m.media-amazon.com/images/M/MV5BMjAxMzY3NjcxNF5BMl5BanBnXkFtZTcwNTI5OTM0Mw@@._V1_FMjpg_UX1000_.jpg', '2025-10-22 21:44:51'),
(17, 'The Dark Knight', 'Batman faces the Joker in Gotham City', 2008, 1, 9.0, 'https://m.media-amazon.com/images/M/MV5BMTMxNTMwODM0NF5BMl5BanBnXkFtZTcwODAyMTk2Mw@@._V1_FMjpg_UX1000_.jpg', '2025-10-22 21:44:51'),
(18, 'Pulp Fiction', 'The lives of two mob hitmen, a boxer, and a pair of diner bandits', 1994, 3, 8.9, 'images\\pulp_fiction.jpg', '2025-10-22 21:44:51'),
(19, 'Forrest Gump', 'The presidencies of Kennedy and Johnson through the eyes of an Alabama man', 1994, 3, 8.8, 'https://m.media-amazon.com/images/M/MV5BNWIwODRlZTUtY2U3ZS00Yzg1LWJhNzYtMmZiYmEyNmU1NjMzXkEyXkFqcGdeQXVyMTQxNzMzNDI@._V1_FMjpg_UX1000_.jpg', '2025-10-22 21:44:51'),
(20, 'The Godfather', 'The aging patriarch of an organized crime dynasty transfers control to his son', 1972, 3, 9.2, 'https://m.media-amazon.com/images/M/MV5BM2MyNjYxNmUtYTAwNi00MTYxLWJmNWYtYzZlODY3ZTk3OTFlXkEyXkFqcGdeQXVyNzkwMjQ5NzM@._V1_FMjpg_UX1000_.jpg', '2025-10-22 21:44:51');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'admin', 'admin@movieflix.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', '2025-10-22 21:44:51'),
(4, 'user', 'user@gmail.com', '$2y$10$wDiaUVN..AoRRBbtfWbfhe4WbNm1ls6WFbHJ2gxoWBU4SWoKEr4EO', 'user', '2025-11-04 20:29:42');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `movies`
--
ALTER TABLE `movies`
  ADD CONSTRAINT `movies_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
