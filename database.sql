-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 29, 2020 at 08:29 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id11443912_policedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(16) NOT NULL,
  `Name` text NOT NULL,
  `AADHAR` int(16) NOT NULL,
  `password` text NOT NULL,
  `email` varchar(30) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` varchar(60) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `access` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `Name`, `AADHAR`, `password`, `email`, `phone`, `address`, `gender`, `access`) VALUES
(28, 'man_prakash', 11, '09285a3cbd35099ce25e96d69267b6c8', NULL, NULL, NULL, NULL, 0),
(30, 'asd', 12, '7c22269ed7cbf2b86affc154678bbed2', NULL, NULL, NULL, NULL, 0),
(32, 'user', 13, 'ac0ce377f82cc71234aee4b24e0e7681', NULL, NULL, NULL, NULL, 0),
(33, 'user2', 14, '023f79b12d5093e181e3abaebfc1442d', NULL, NULL, NULL, NULL, 1),
(29, 'Amit gowda', 22, '2ea4f185a7912df20eb8cff935835eef', 'namanprakash5@gmail.com', '456-423-9986', 'Room no. 322, sjbit hostel block 2, SJBIT, bgs road, kengeri', 'Male', 1),
(36, 'nitya', 23, 'd7b0c130955157bd8ff1f8ca84c621fa', NULL, NULL, NULL, NULL, 0),
(34, 'Aman Prakash', 31, 'd474bbcef61a1894483e24c2748d02c8', 'aman30865@gmail.com', '234-554-5443', 'Room no. 217, sjbit hostel block 1, SJBIT, bgs road, kengeri', 'Male', 2),
(43, 'asdfjllkj', 98, '99ebd8f1daf1fde27a788d5d4f7e5c00', NULL, NULL, NULL, NULL, 0),
(41, 'Aman Prakash', 99, '299a364fd2f871dee784ed39670cab9f', 'aman30865@gmail.com', '234-554-5443', 'dfgjkjj', 'Male', 1),
(38, 'adarsh', 111, '9522efdc9520ce4b9042b9ae768a941b', NULL, NULL, NULL, NULL, 0),
(40, 'Amn Prakash', 123, 'd0d682cef5031c0519fdc51ece558ac6', NULL, NULL, NULL, NULL, 0),
(44, 'Amn Prakash', 156, 'febf5218d9298ea97e2635593aa337eb', NULL, NULL, NULL, NULL, 0),
(45, 'Aman Prakash', 313, '269b5689ea5aefd50b2d96f052413c53', NULL, NULL, NULL, NULL, 1),
(42, 'teja', 1233, '103b765950e8c6486cfbd3e3081e77e0', NULL, NULL, NULL, NULL, 0),
(39, 'asdfjkl;', 231223, '0712d3395254381f64490a486599bd5e', NULL, NULL, NULL, NULL, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`AADHAR`) USING BTREE,
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
