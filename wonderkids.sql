-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 28, 2024 at 06:59 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wonderkids`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact_form`
--

CREATE TABLE `contact_form` (
  `id` int(6) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` varchar(25) NOT NULL,
  `message` text NOT NULL,
  `class` varchar(50) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_form`
--

INSERT INTO `contact_form` (`id`, `name`, `email`, `mobile`, `message`, `class`, `reg_date`) VALUES
(49, 'T.s.v.n Pavansai', 't.s.v.n.pavansai26@gmail.com', '8712249910', 'aa', 'class 3', '2024-10-12 15:06:06');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image_data` longblob NOT NULL,
  `category` enum('playing','other','learning') NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `title`, `image_data`, `category`, `description`) VALUES
(11, 'logo', 0x75706c6f6164732f696d616765732f696d675f36373134643364653139323933392e37343537303731352e706e67, 'other', 'school logo'),
(12, 'Abacus & Vedic maths', 0x75706c6f6164732f696d616765732f696d675f36373134626462643262613235362e35353937303937362e6a706567, 'learning', 'Abacus & Vedic maths'),
(13, 'D.B.H.P Sabha Learning', 0x75706c6f6164732f696d616765732f696d675f36373134626464396239333534382e35343335353132302e6a706567, 'learning', 'D.B.H.P Sabha Learning'),
(14, 'science lab', 0x75706c6f6164732f696d616765732f696d675f36373134633432623030363965332e30393433363035372e6a706567, 'learning', 'science lab'),
(15, 'solar system', 0x75706c6f6164732f696d616765732f696d675f36373134633766363832653962342e32303238363636372e706e67, 'learning', 'digital class about solar system'),
(16, 'computer labs', 0x75706c6f6164732f696d616765732f696d675f36373134636638303432336537302e37373430363236332e6a706567, 'playing', 'computer labs'),
(17, 'playschool', 0x75706c6f6164732f696d616765732f696d675f36373134636138633063383562302e31363530333138352e6a706567, 'playing', 'playschool'),
(18, 'playschool', 0x75706c6f6164732f696d616765732f696d675f36373134636162333332626133392e30303334353533382e6a706567, 'playing', 'playschool'),
(19, 'playschool', 0x75706c6f6164732f696d616765732f696d675f36373134636163313634643332362e31383935303737332e6a706567, 'playing', 'playschool'),
(20, 'computer lab', 0x75706c6f6164732f696d616765732f696d675f36373134636639636337636133392e39303638363835352e6a706567, 'learning', 'computer lab'),
(23, 'library', 0x75706c6f6164732f696d616765732f696d675f36373134643938613261383330322e35363734363830302e6a706567, 'learning', 'library'),
(24, 'science lab', 0x75706c6f6164732f696d616765732f696d675f36373134643939633162626431302e38343030363533332e6a706567, 'other', 'science lab'),
(25, 'meditation', 0x75706c6f6164732f696d616765732f696d675f36373134646166646433383864342e36353731323938332e6a706567, 'other', 'meditation');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('super_admin','general_admin') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `created_at`) VALUES
(1, 'superadmin', 'd1e576b71ccef5978d221fadf4f0e289', 'super_admin', '2024-10-06 17:19:08'),
(2, 'generaladmin', '9e0cea71b6212aff2b96ba74a6042fb9', 'general_admin', '2024-10-06 17:19:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact_form`
--
ALTER TABLE `contact_form`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact_form`
--
ALTER TABLE `contact_form`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
