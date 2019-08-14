-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 10, 2019 at 01:47 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Blog_CMS`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) NOT NULL,
  `datetime` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(60) NOT NULL,
  `admin_name` varchar(30) NOT NULL,
  `added_by` varchar(30) NOT NULL,
  `admin_headline` varchar(30) NOT NULL,
  `admin_bio` varchar(500) NOT NULL,
  `admin_image` varchar(60) NOT NULL DEFAULT 'avatar.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `datetime`, `username`, `password`, `admin_name`, `added_by`, `admin_headline`, `admin_bio`, `admin_image`) VALUES
(7, '2019 June 10 - 12:55:48', 'Admin_Mate', 'asd123ASD', 'Mate', 'Mate', '', '', 'avatar.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(10) NOT NULL,
  `title` varchar(50) NOT NULL,
  `author` varchar(50) NOT NULL,
  `datetime` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `title`, `author`, `datetime`) VALUES
(18, 'UX Design', 'Admin_Mate', '2019 jÃºnius 10 - 12:58:45');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(10) NOT NULL,
  `datetime` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(60) NOT NULL,
  `comment` varchar(500) NOT NULL,
  `approved_by` varchar(50) NOT NULL,
  `status` varchar(3) NOT NULL,
  `post_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `datetime`, `name`, `email`, `comment`, `approved_by`, `status`, `post_id`) VALUES
(17, '2019 June 10 - 13:01:23', 'John Doe', 'john.doe@mail.com', 'This is awesome!', 'Mate', 'ON', 25),
(18, '2019 June 10 - 13:44:05', 'John Doe', 'john.doe@mail.com', 'Here we are going again!', 'Pending', 'OFF', 25);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(10) NOT NULL,
  `datetime` varchar(50) NOT NULL,
  `title` varchar(300) NOT NULL,
  `category` varchar(50) NOT NULL,
  `author` varchar(50) NOT NULL,
  `image` varchar(50) NOT NULL,
  `post` varchar(10000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `datetime`, `title`, `category`, `author`, `image`, `post`) VALUES
(25, '2019 June 10 - 12:59:59', 'The Power and Problems of Provisional Personas in UX design', 'UX Design', 'Admin_Mate', 'UX-phone-image.jpg', 'Personas are an oft used and highly touted communication and usability tool. They can help summarize what you know about the user, highlight pain points, and point out potential opportunities to customize your products for your users. In sum, they keep product development focused on your target market, rather than the world at large.\r\n\r\nUnfortunately, while they are super useful, personas can be misleading. Provisional personas, in particular, can be over-utilized and under-validated. Today weâ€™re going to discuss the proper way to construct provisional personas, their most useful attributes, and the biggest challenges that you face when relying on them.\r\n\r\nTraditional personas are big endeavors. They take a lot of time, research, effort, and dedication to validate. Unfortunately, many smaller organizations just donâ€™t have the resources to get this done, but they still want to prioritize the usability of their products. Thatâ€™s why provisional personas can be so useful. They take a lot less time to create, and can still offer some of the same benefits.\r\n\r\nHowever, thereâ€™s always a tradeoff. Getting something finished quickly means, of course, that it isnâ€™t done correctly. Or at least without as much accuracy. The problem with provisional personas, in particular, lies in how theyâ€™re created.\r\n\r\nThey represent the ideas of management. The executives in an organization engage in brainstorming sessions, practice empathy mapping, and examine what they think is important to their users. This obviously isnâ€™t ideal.\r\n\r\nExecutives are often insulated from user needs and it can be hard for them to really see things from a userâ€™s point of view. Thatâ€™s why itâ€™s so important to get someone at the table whoâ€™s championing the UX cause. Often thatâ€™s a product development lead, but more and more UX is getting its own department, or outside consultant to bring that perspective to the table.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `Foreign_Relation` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
