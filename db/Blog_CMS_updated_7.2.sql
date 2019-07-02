-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 02, 2019 at 12:54 PM
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
  `datetime` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `added_by` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_headline` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_bio` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_image` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'avatar.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `datetime`, `username`, `password`, `admin_name`, `added_by`, `admin_headline`, `admin_bio`, `admin_image`) VALUES
(7, '2019 June 10 - 12:55:48', 'Admin_Mate', 'asd123ASD', 'Mate Molnar', 'Mate', 'Web developer at DevCorner Community', 'Ã¡Ã¡Ã¡Ã¡Ã¡Ã¡Ã¡Ã¡Ã¡Ã¡Ã¡Ã¡', 'mate_dev.jpg'),
(8, '2019 jÃºnius 13 - 19:47:37', 'John_Doe', 'asd123asd', 'John_Doe', 'Admin_Mate', 'Test subject', 'Nothing to show', 'company_logo.png');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(10) NOT NULL,
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `datetime` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `title`, `author`, `datetime`) VALUES
(18, 'UX Design', 'Admin_Mate', '2019 jÃºnius 10 - 12:58:45'),
(19, 'Assembly', 'Admin_Mate', '2019 jÃºnius 14 - 12:58:17'),
(20, 'Mechanics', 'Admin_Mate', '2019 jÃºnius 14 - 12:58:24'),
(21, 'Information technology', 'Admin_Mate', '2019 jÃºnius 14 - 12:58:43'),
(22, 'Fitness', 'Admin_Mate', '2019 jÃºnius 14 - 12:59:03'),
(23, 'Fly', 'Admin_Mate', '2019 jÃºnius 14 - 12:59:10'),
(24, 'Life', 'Admin_Mate', '2019 jÃºnius 14 - 12:59:14'),
(25, 'This is the longest category title so far ', 'Admin_Mate', '2019 jÃºlius 01 - 16:37:24');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(10) NOT NULL,
  `datetime` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `approved_by` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `post_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `datetime`, `name`, `email`, `comment`, `approved_by`, `status`, `post_id`) VALUES
(1, '2019 jÃºlius 01 - 18:39:09', 'Test', 'test@mail.com', 'Nobody moves!', 'Pending', 0, 34),
(2, '2019 jÃºlius 01 - 18:39:24', 'Test', 'test@mail.com', 'Yo this is fun!', 'Mate', 1, 34),
(3, '2019 jÃºlius 01 - 18:39:43', 'Test', 'test@mail.com', 'Maybe next time!', 'Mate', 1, 34);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(10) NOT NULL,
  `datetime` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `author` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `post` varchar(10000) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `datetime`, `title`, `category_id`, `author`, `image`, `post`) VALUES
(26, '2019 jÃºnius 13 - 17:36:39', 'Articles by Topic: Search Engine Optimization', 22, 'Admin_Mate', 'seo.jpg', 'Sales begin with lead generation: identifying potential customers for the product or service youâ€™re trying to sell. The goal is twofold: You want to raise general awareness of your brand in order to encourage customers to come to you, and you want to go to the market with targeted messaging to get customers who arenâ€™t aware or connected to you.\r\n\r\nFor small and lightly funded companies, networking and viral marketing are the most cost-effective means to generate leads. Most of us who have developed a new product or company have ample personal and extended networks that can help us get the word out. In order to properly leverage these networks, we need to be thoughtful about our messaging and what we are trying to communicate. Be very systematic in how you approach your contacts, clearly spelling out why what you offer has value and suggesting some simple ways they can help get the word out.\r\n\r\nIn order to achieve viral effects, consider the practice of Web 2.0 software companies: along with clear-and-simple messaging, the best ones typically have an attractive and even fun package of goodies that creates interest and intrigue around their company and offering. IconBuffetâ€™s Free Delivery program is a terrific example of generating buzz around a product, and leveraging your customers (and even potential customers) to push your company and message forward.\r\n\r\nTargeted direct-mail marketing is another potential route to consider, although up-front printing and per-piece postage costs can pretty quickly make this an expensive proposition. Sending a small run of high-quality pieces to people whom you already know can provide a strong impression, communicating the quality and seriousness of what you are offering.\r\n\r\nFor those with more money or who need to generate a large number of leads quickly, consider using a public relations firm. The right public relations firm is worth its weight in gold, as they will not only help broadcast your message to large numbers of people in the appropriate industries or geographic areas, they also have strong networks within the news mediaâ€”and with other clientsâ€”that can generate considerable unpaid press opportunities for you. The reason that many new businesspeople are showing up in major newspapers or trade publications is likely the legwork of their public relations firms. If youâ€™re ready for the big time, this outlet can provide you with a lot of exposure. While the cost can vary wildly based on how much work they do for you, expect to spend in the neighborhood of a few thousand dollars a month for good, consistent support and coverage, or even up to $10,000 for a heavier, more short-term blitz. As with all marketing efforts, long-term success will be more the product of consistency over a long period of time than making a big splash.\r\n\r\nAdvertising is generally the most expensive way to generate leads, and most mass advertising is not worth the moneyâ€”at least not for a small company. However, online advertising can provide some effective opportunities. Services such as Google AdWords provide you with a relatively high percentage of good, qualified leads that are very targeted to exactly what you are trying to sell. However, you probably need to be specific: The biggest and most general terms are now quite expensive. If you can get more specific than just web design, or even include a precise geographic location, you can both reduce your costs and increase the quality of the leads you earn.\r\n\r\nFinally, thereâ€™s always cold calling. In this day and age, between the people that we know and the information publicly available on the internet, we can get in personal contact with just about anyone we really want, if weâ€™re determined enough. For a software company, this might mean a key influencer in a specific industry; for a services company this might mean the VPs of product development at all of the companies in a particular vertical market. Most of us donâ€™t like cold-calling, but if we can get over our fear or dislike of doing it, the results can be powerful and surprising.'),
(28, '2019 jÃºnius 14 - 13:00:16', 'How to make a carcicasss', 19, 'Admin_Mate', 'city_skyline.jpeg', 'Pariatur sunt lacus corrupti sollicitudin sit, hendrerit vehicula consequatur consequuntur quibusdam ea, quibusdam eleifend aperiam, quam felis itaque taciti distinctio adipisci exercitation nisl ante, ut, commodi at fugit, possimus? Similique sociosqu mollit accusamus? Modi perspiciatis cumque. Excepturi purus, laoreet tortor, lectus dignissimos! Aliquip, similique consectetur lectus, inceptos porta sagittis, animi.\r\n\r\nIure fuga quibusdam aliquam aute laboriosam maecenas sociosqu commodi consectetuer, nulla? Cumque quisquam sapien tempor quas voluptates qui, sapien, architecto, provident, mi sociosqu cillum? Inventore? Mus optio debitis iusto nisi, excepturi, nesciunt nec voluptatibus reiciendis, aspernatur? Proident montes magni morbi. Elit. Minima aliquet nonummy inceptos lectus vivamus, exercitation quis, a.\r\n\r\nQuidem, autem dolorum lobortis explicabo cubilia saepe dictumst? Nesciunt, iaculis debitis aute eos malesuada, magnam proident penatibus distinctio! Auctor voluptate autem parturient placeat harum vulputate parturient pulvinar vulputate tenetur egestas amet hymenaeos officiis, hendrerit ante, dignissim! Eius vehicula id debitis, aliquam nam sagittis duis fugiat unde! Consequuntur nam! Facere netus.'),
(29, '2019 jÃºnius 14 - 13:00:48', 'People can fly. but why?', 23, 'Admin_Mate', 'writting_letter.jpg', 'Officiis, ornare voluptatem mollis nobis nihil commodi curabitur, exercitationem turpis mus hic sagittis dis? Eligendi? Asperiores eiusmod arcu, soluta ad! Mus. Tempora volutpat adipisci debitis nihil litora commodi? Molestias curae fugit ex? Feugiat, excepturi proin molestie! Inventore unde quisque dolore. Vivamus bibendum, voluptatem? Enim malesuada, quo eveniet in, nostra inventore.\r\n\r\nIn eros voluptas sapiente soluta? Fuga nisl incidunt mauris consequuntur blanditiis nostrud nonummy parturient itaque cillum! Optio fuga officia eget tempor, veritatis magna minima! Praesentium. Dolores aperiam pellentesque, quo veritatis, lectus dis. Iaculis exercitationem quod minim? Fugiat lorem primis. Sodales, tempor do, sed venenatis, ridiculus porta parturient ullamcorper, soluta quisque.\r\n\r\nAssumenda minus reiciendis arcu consectetur earum class ab tellus nisi laborum culpa blandit aut tristique euismod netus labore vel maiores? In, sapien ridiculus blandit cumque fames, netus eveniet iste consequat, sunt facilisi pede duis consequat! Libero ut per maiores tenetur? Augue lacinia. Tristique lorem, congue, vestibulum, nonummy ipsum, rem mollit.'),
(30, '2019 jÃºnius 14 - 13:05:29', 'Test subject article', 20, 'John_Doe', 'taking_picture.jpeg', 'Dolor eu, sequi aliquid fuga nec nam, fermentum, fugiat conubia illo occaecati. Asperiores fugiat facilisi sociis omnis praesent? Perferendis, penatibus. Unde inceptos. Atque urna mollit architecto mollitia sapien, accusamus proident praesentium bibendum elementum beatae, rutrum ullamcorper porttitor integer, condimentum porro totam unde iusto eiusmod, suscipit dolor. Metus laboris, ultrices totam.\r\n\r\nEnim exercitationem ultrices do at duis, similique molestie, montes viverra voluptatum! Expedita, cumque nibh cum ex aspernatur bibendum tempus eu, dui sociosqu, architecto quia. Interdum eveniet pede aspernatur beatae class quae lobortis tincidunt integer adipiscing maxime, rutrum harum aliquam! Facere non turpis, nemo platea, molestie dictum nostrud? Impedit, nulla hac.\r\n\r\nRhoncus, elementum error ad nihil cursus facere luctus nibh? Expedita eligendi? Veritatis dolorem euismod praesent! Dolorem quo lacinia quidem lectus tempora platea mus volutpat? Iste cupidatat semper fermentum sociis pede omnis incididunt! Sint eum risus. Viverra dolorum ex magnam orci, habitant augue asperiores molestiae nam cras, doloremque nemo, lobortis dolorem.'),
(32, '2019 jÃºnius 26 - 22:07:19', 'Mustafa rules', 18, 'Admin_Mate', 'pexels-photo-1574184.jpeg', 'Arcu ultricies semper. Lobortis earum nostra numquam ullamco lobortis, etiam ullam nec? Etiam, non delectus deleniti, harum sequi nobis debitis! Sem magna minus maiores? Hendrerit justo! Incididunt! Arcu, consequat eveniet, egestas facilis. Posuere aliquid diamlorem ipsam, earum officia litora lacinia, nulla tempor arcu aliquet rem. Rutrum corporis itaque aspernatur mauris.\r\n\r\nEst adipiscing pede excepteur, minim, minima, penatibus? Numquam autem adipisicing repudiandae dapibus pretium minus vel venenatis assumenda eos mi perferendis habitant excepturi magni luctus! Similique sodales posuere excepturi iste cumque fermentum dolorem curae sed tempora netus? Vero officiis porro lacinia repellendus iste cras alias tincidunt, pellentesque, ullam volutpat eum sociis.\r\n\r\nA irure doloremque conubia nec aliquip soluta quaerat, veritatis inventore? Anim turpis? Lobortis senectus! Quod, eum repellendus, laboris wisi risus! Nunc tenetur odit porttitor ante eiusmod, dolor. Aute mus vestibulum duis odio, turpis! Iure sagittis, expedita, mus voluptatum, consectetur quod doloribus leo erat wisi purus purus etiam blanditiis, vehicula rem.'),
(33, '2019 jÃºlius 01 - 16:28:08', 'This is the next test to make it better to be a better web developer. Means this line of text is to represent the longest sentence to make it better', 25, 'Admin_Mate', 'alexandr-bormotin-571811-unsplash.jpg', 'Deleniti facilisi rutrum! Tempore cubilia. Donec, netus eius! Quo cras, mauris, nostrum mattis arcu? Curabitur pede, tellus ducimus nihil dolorem accusantium accusantium do semper, porttitor, non saepe hymenaeos rerum. Curae.\r\n\r\nQuos deserunt diamlorem mattis pariatur cillum suscipit irure. Hymenaeos litora, beatae fames doloremque leo? Pulvinar vitae harum urna maiores. Reprehenderit, aspernatur! Bibendum nascetur laudantium quasi, ipsa dapibus nostra! Impedit doloribus.\r\n\r\nHymenaeos laoreet cras ante aenean tempor dis suspendisse laudantium et fugit voluptatibus risus, ultricies aut adipisicing, viverra hic, magni nihil! Vero ultricies hendrerit accusamus consequat. Fugiat officiis justo porta non.'),
(34, '2019 jÃºlius 01 - 16:38:01', 'This is the new post of the longest category title within', 24, 'Admin_Mate', 'pexels-photo-671557.jpeg', 'Maxime aute fuga, explicabo, sed dictum est per, tempor cras voluptates molestias eius architecto, voluptates, itaque, venenatis ligula! Vel ante pulvinar arcu, praesent numquam? Voluptate tempus consequat exercitation illo tempore.\r\n\r\nPlaceat tortor eius voluptatibus enim? Adipiscing aliquid dictumst quisquam, cumque unde nec, laborum maiores, harum? Mollit occaecati fermentum? Dis facilisi! Voluptas itaque esse minim consequuntur cumque fuga cubilia quibusdam ultricies.\r\n\r\nSem assumenda perspiciatis tempore eu integer ex voluptate neque, minim ligula saepe? Eros adipiscing, eos a nisi debitis, occaecati eros. Ad! Architecto! Senectus autem. Pariatur adipiscing dolor interdum! Tortor nonummy.');

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

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
