-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 20, 2023 at 12:40 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.4.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `news-site`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `post` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `post`) VALUES
(43, 'BUSINESS', 1),
(45, 'anda', 0),
(38, 'POLITICS', 1),
(40, 'ENTERTAINMENT', 1),
(42, 'SPORTS', 1);

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `post_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `category` varchar(100) NOT NULL,
  `post_date` varchar(50) NOT NULL,
  `author` int(11) NOT NULL,
  `post_img` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`post_id`, `title`, `description`, `category`, `post_date`, `author`, `post_img`) VALUES
(75, 'Sheikh Hasina', 'SHEIKH HASINA, Sheikh Hasina, the Prime Minister of the People\'s Republic of Bangladesh, assumed the office on 12 January 2014 for the third time after', '38', '20 Jul,2023', 24, '1689841309-Sheikh.jpg'),
(43, 'Argentina', '                 Chile to the west, and is also bordered by Bolivia and Paraguay to the north, Brazil to the northeast, Uruguay and the South Atlantic Ocean to the east, and the Drake Passage to the south. Argentina is a federal state subdivided into twenty-three provinces, and one autonomous city, which is the federal capital and largest city of the nation, Buenos Aires. The provinces and the capital have their own constitutions, but exist under a federal system. Argentina claims sovereignty over the Falkland Islands, South Georgia and the South Sandwich Islands, and a part of Antarctica.                    ', '42', '21 Dec,2022', 24, '1689841108-argentina-song.jpeg'),
(51, 'MARKETING', '                                                                                                                                                                                                                                                                                Marketing is the process of exploring, creating, and delivering value to meet the needs of a target market in terms of goods and services;[1][2] potentially including selection of a target audiences; selection of certain attributes orr themes to emphasize in advertising; operation of advertising campaigns; attendance at trade shows and public events; design of products and packaging attractive to buyers; defining the terms of sale, such as price, discounts, warranty, and return policy; product placement in media or with people believed to influence the buying habits of others; agreements with retailers, wholesale distributors, or resellers; and attempts to create awareness of, loyalty to, and positive feelings about a brand. Marketing is typically done by the seller, typically a retailer or manufacturer. Sometimes tasks are contracted to a dedicated marketing firm or advertising agency. More rarely, a trade association or government agency (such as the Agricultural Marketing Service) advertises on behalf of an entire industry or locality, often a specific type of food (e.g. Got Milk?), food from a specific area, or a city or region as a tourism destination.                                                                                                                                                                                                                                                                                                                                                                                                                                 ', '43', '26 Dec,2022', 24, '4-things-no-one-tells-you-when-you-start-your-own-marketing-business.png'),
(52, 'AKHIL AKSHAY FLIM', 'The film starts with Akhil Lokhande (Akshay Kumar) getting paid for doing an ad, where he gets into a fight, as he wasn\'t paid the full amount of money that they had promised. This continues with a few other assignments, where Akhil constantly gets underpaid, resulting in a fight, ends the fight when he gets a phone call, and says he has to go somewhere. He then arrives on a shoot where Sakshi (Tamannaah) is shooting for her television series. After her shoot lets out, they go for a walk around the park, observing other couples. At the end of their walk, Akhil proposes Sakshi. Akhil and Saakshi go to her father\'s (Mithun Chakraborty) house, where they are told that until Akhil becomes rich, he can\'t marry Saksh', '40', '26 Dec,2022', 28, 'Its_Entertainment.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `web_name` varchar(50) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `footer_des` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`web_name`, `logo`, `footer_des`) VALUES
('G_NEWS', 'Screenshot_4.png', ' K-News | Powered by Ashraful islam \r\n');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(40) DEFAULT NULL,
  `role` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `first_name`, `last_name`, `username`, `password`, `role`) VALUES
(24, 'Ashraful', 'Islam', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 1),
(28, 'Arif', 'hossain', 'user', '12dea96fec20593566ab75692c9949596833adc9', 0),
(26, 'Bristy', 'Islam', 'bristy', 'fd2a1960f0c00c720cf41e02e6426b3386329cf7', 0),
(27, 'Rafat', 'Khan', 'Rafa', '9c0a101c7d0caba0837ffcf94bca0bafe32580fd', 0),
(29, 'Arif', 'Arif', 'Arif864', '7bb8fcea6dd64077b9a286118764aa0398ae2660', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`post_id`),
  ADD UNIQUE KEY `post_id` (`post_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
