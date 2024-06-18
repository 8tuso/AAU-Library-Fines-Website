-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 18, 2024 at 05:35 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aaudatabase`
--

-- --------------------------------------------------------

--
-- Table structure for table `library`
--

CREATE TABLE `library` (
  `book_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `genre` varchar(255) NOT NULL,
  `owend_by` varchar(255) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `book_img` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `library`
--

INSERT INTO `library` (`book_id`, `name`, `genre`, `owend_by`, `start_date`, `end_date`, `book_img`) VALUES
(1, 'The Fairytale', 'Fantasy', '202020449', '2024-06-18', '2024-06-18', '51V+Bc7FTaL.jpg'),
(2, 'Harry Poter And The Deathly Hallows', 'Fantasy', NULL, NULL, NULL, '71Q1Iu4suSL._AC_UF894,1000_QL80_.jpg'),
(3, 'Harry Poter And The Deathly Hallows 2', 'Fantasy', '202020449', '2024-06-11', '2024-06-14', '9781408855713.jpg'),
(4, 'The Psychology of money', 'Economic', '202020449', '2024-06-11', '2024-06-14', 'psych-money-cover.jpeg'),
(5, 'BIG BOOK of SCIENCE experiments', 'Science', NULL, NULL, NULL, '1119590655.jpg'),
(6, 'WHAT\"S THE POINT OF MATH?', 'Math', NULL, NULL, NULL, '9781465481733.jpg'),
(7, '3ds Max 2018', 'Technology', NULL, NULL, NULL, '9781630571078.jpg'),
(8, 'C++ Programming in 7 Days', 'Technology', NULL, NULL, NULL, '61ILmaWMCsS._AC_UF1000,1000_QL80_.jpg'),
(9, 'Beginning PHP and MySQL', 'Technology', NULL, NULL, NULL, '978-1-4302-3115-8.jpg'),
(10, 'CUDA', 'Technology', NULL, NULL, NULL, '61THkXaHMbL._AC_UF1000,1000_QL80_.jpg'),
(11, 'Project Management', 'Technology', NULL, NULL, NULL, '1119702968.jpg'),
(12, 'The Arab History', 'History', NULL, NULL, NULL, 'concise_history_of_the_arabs.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` char(255) NOT NULL,
  `reg_date` datetime NOT NULL DEFAULT current_timestamp(),
  `name` varchar(40) NOT NULL,
  `Major` varchar(25) NOT NULL,
  `file_name` varchar(55) NOT NULL,
  `fines` int(11) NOT NULL DEFAULT 0,
  `last_update` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `reg_date`, `name`, `Major`, `file_name`, `fines`, `last_update`) VALUES
(202020449, 'talal@gmail.com', 'Bro123', '2024-06-07 17:17:55', 'Talal Waleed Ali Alhayek', 'Software Engineering', '8de291ea73d52db2238594c3cd3dc2b3.png', 40, '2024-06-18'),
(202020455, 'mutasem@yahoo.com', 'Lol123', '2024-06-07 23:10:30', 'Mutasem Ali Al-obidate', 'Computer Information Syst', 'Capture.PNG', 0, '2024-06-13');

-- --------------------------------------------------------

--
-- Table structure for table `user_books`
--

CREATE TABLE `user_books` (
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_books`
--

INSERT INTO `user_books` (`user_id`, `book_id`) VALUES
(202020449, 1),
(202020449, 3),
(202020449, 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `library`
--
ALTER TABLE `library`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_books`
--
ALTER TABLE `user_books`
  ADD PRIMARY KEY (`user_id`,`book_id`),
  ADD KEY `book_id` (`book_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `library`
--
ALTER TABLE `library`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=202020456;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_books`
--
ALTER TABLE `user_books`
  ADD CONSTRAINT `user_books_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `user_books_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `library` (`book_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
