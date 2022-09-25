-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 07, 2021 at 06:14 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `expensetracker`
--

-- --------------------------------------------------------

--
-- Table structure for table `finance`
--

CREATE TABLE `finance` (
  `id` int(11) NOT NULL,
  `uidUsers` tinytext NOT NULL,
  `transactionType` varchar(15) NOT NULL,
  `descriptionTag` varchar(15) NOT NULL,
  `amount` int(9) NOT NULL,
  `transactionDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `finance`
--

INSERT INTO `finance` (`id`, `uidUsers`, `transactionType`, `descriptionTag`, `amount`, `transactionDate`) VALUES
(42, 'OnePunchMan', 'EXPENSES', 'WATER BILLS', 3000, '2021-09-28'),
(45, 'OnePunchMan', 'INCOME', 'SALARY', 30000, '2021-09-28'),
(46, 'OnePunchMan', 'EXPENSES', 'SHOPPING', 400, '2021-09-28'),
(50, 'JohnDoe01', 'INCOME', 'SALARY', 5000, '2021-09-29'),
(51, 'JohnDoe01', 'INCOME', 'TIP', 400, '2021-09-29'),
(52, 'JohnDoe01', 'EXPENSES', 'TRANSPORTATION', 75, '2021-09-29'),
(67, 'OnePunchMan', 'INCOME', 'LOAN', 600, '2021-09-29'),
(68, 'OnePunchMan', 'EXPENSES', 'ELECTRICITY', 3000, '2021-09-29'),
(70, 'OnePunchMan', 'INCOME', 'SALARY', 250, '2021-09-29'),
(71, 'OnePunchMan', 'EXPENSES', 'FOOD', 500, '2021-09-29'),
(75, 'OnePunchMan', 'EXPENSES', 'FOOD', 1700, '2021-09-30'),
(89, 'OnePunchMan', 'INCOME', 'BAON', 300, '2021-09-30'),
(92, 'OnePunchMan', 'EXPENSES', 'TRANSPORTATION', 200, '2021-09-30'),
(95, 'OnePunchMan', 'EXPENSES', 'INTERNET', 1500, '2021-09-30'),
(96, 'OnePunchMan', 'INCOME', 'GAMBLING', 400, '2021-09-27'),
(98, 'OnePunchMan', 'EXPENSES', 'GAMBLING LOSS', 7500, '2021-09-30'),
(101, 'JohnDoe01', 'EXPENSES', 'TRANSPORTATION', 25, '2021-09-30'),
(102, 'JohnDoe01', 'EXPENSES', 'FOOD', 100, '2021-09-30'),
(103, 'OnePunchMan', 'EXPENSES', 'FOOD', 100, '2021-10-01'),
(104, 'OnePunchMan', 'EXPENSES', 'TRANSPORTATION', 75, '2021-10-01'),
(105, 'OnePunchMan', 'INCOME', 'SALARY', 1500, '2021-10-01'),
(106, 'OnePunchMan', 'INCOME', 'SALARY', 200, '2021-10-03'),
(107, 'OnePunchMan', 'EXPENSES', 'FOOD', 600, '2021-10-03');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `idUsers` int(11) NOT NULL,
  `uidUsers` tinytext NOT NULL,
  `firstNameUsers` tinytext NOT NULL,
  `lastNameUsers` tinytext NOT NULL,
  `pwdUsers` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`idUsers`, `uidUsers`, `firstNameUsers`, `lastNameUsers`, `pwdUsers`) VALUES
(1, 'OnePunchMan', 'Bruce', 'Lee', '$2y$10$l5Esi4.Ux.9J0DosXGUycOqKmn..0h2.xq32S1qsmMYiKUHTvS4MS'),
(2, 'JohnDoe01', 'John', 'Doe', '$2y$10$j1BIXuu04bnHKfSj9klyyex/oVcpdK8LCXQ2ego3zxIabDSUzz09i');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `finance`
--
ALTER TABLE `finance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idUsers`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `finance`
--
ALTER TABLE `finance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `idUsers` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
