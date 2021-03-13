-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 13, 2021 at 09:34 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `userappregister`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `parent_id` int(32) NOT NULL DEFAULT 0,
  `name` varchar(32) NOT NULL,
  `status` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `name`, `status`) VALUES
(1, 0, 'Frontend', '1'),
(2, 0, 'Backend', '1'),
(3, 1, 'Angular', '1'),
(4, 3, 'AngularJS', '1'),
(5, 3, 'Angular2', '1'),
(6, 1, 'React', '1'),
(7, 6, 'ReactNative', '1'),
(8, 1, 'Vue', '1'),
(9, 2, 'PHP', '1'),
(10, 9, 'Symfony', '1'),
(11, 10, 'Silex', '1'),
(12, 9, 'Laravel', '1'),
(13, 12, 'Lumen', '1'),
(14, 9, 'NodeJs', '1'),
(15, 14, 'Express', '1'),
(16, 14, 'NestJS', '1');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `category_id`) VALUES
(6, 'pedza', 'test', '1234', 3),
(8, 'pedza', 'some@some.com', '$2y$10$aXiJGavNo0zxEZaOqA9G3.5fpDA2hdnuZAANztYpbpLFLcK8al7NW', 3),
(9, 'pedza2', 'some@som2e.com', '$2y$10$BnIxxqAc/oT.wSQseZ90NuPYJuo/dgoQNzX8f1RoSJs/cDTj5jmc6', 13),
(10, 'pedza23', 'somemail@mail.com', '$2y$10$GWynh4cCxgXwraOXnjF9J.7Kq9ZKK27387iytjJ/Mu/YSAEYnzKHG', 11);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Foreign Key` (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `Foreign Key` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
