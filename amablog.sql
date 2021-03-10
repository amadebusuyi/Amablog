-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 08, 2021 at 07:01 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `amablog`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Technology'),
(2, 'Lifestyle'),
(3, 'Fashion'),
(4, 'Art'),
(5, 'Food'),
(6, 'Adventure'),
(7, 'Sport'),
(8, 'Politics'),
(9, 'Religion'),
(10, 'Science');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `post` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `comment`, `post`, `user`, `created_at`, `deleted_at`) VALUES
(1, 'Hello World', 4, 2, '2021-03-08 04:14:55', NULL),
(2, 'Hello', 5, 3, '2021-03-08 05:13:34', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(191) NOT NULL,
  `slug` varchar(191) DEFAULT NULL,
  `post` text NOT NULL,
  `summary` mediumtext DEFAULT NULL,
  `image` text DEFAULT NULL,
  `category` varchar(191) DEFAULT NULL,
  `tags` text DEFAULT NULL,
  `views` int(11) NOT NULL DEFAULT 0,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `slug`, `post`, `summary`, `image`, `category`, `tags`, `views`, `created_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(4, 'Another one', 'another-one-UQXJYW', '<p>PROFESSIONAL SUMMARY\nWith over 2 years’ experience in Information Technology and an unflinching passion for learning and self-development, I\nhave honed my IT skills to the industry’s standard and can boast of expertise in different programming languages and\ndevelopment concepts. I am a full stack developer and cloud technology professional currently looking for an opportunity\nin a diverse and challenging work environment where the best standards are upheld and active learning is encouraged.\nSKILLS\n Programming languages – HTML5, CSS3, JavaScript, PHP, Node Js, Python\n Frameworks – Express Js, Laravel, Django, React Js, Vue Js, Framework 7\n Databases – SQL and NoSQL databases including MySQL, SQLite, MongoDB, Firestore, Realtime Database\n Cloud Technologies – Google Cloud Platform, Amazon Web Services, Microsoft Azure, Digital Ocean\n Template engines – Pug Js, EJS, Template7, Mustache\n Knowledge of C-Panel and WHM hosting\n Basic Knowledge of Docker and Kubernetes\n Good knowledge of API development\n Basic knowledge of UI/UX development\n Basic knowledge of CMS such as Wordpress, Joomla, Drupal\n Ability to quickly adapt and master a new programming language or concept\n Good understanding of web architecture, version control, continuous integrations and continuous development\n Ability to work effectively alone and with a team\n Possess excellent communication skills, both spoken and written\n Expertise with diverse collaboration tools\n Basic knowledge of graphics design\n Creative thinking and problem solving skills\n Highly organized with good time management skills\n Microsoft Office Suite – Excel, Word, PowerPoint, Outlook, Access\n Sound knowledge of project monitoring and evaluation<br></p>', 'PROFESSIONAL SUMMARY\nWith over 2 years’ experience in Information Technology and an unflinching passion for learning and self-development, I\nhave honed my IT skills to the industry’s standard and can boast of expertise in different...', 'https://preview.colorlib.com/theme/parason/img/blog/popular-post/post2.jpg', 'Lifestyle', NULL, 17, 3, '2021-03-08 02:34:24', '2021-03-08 05:11:39', NULL),
(5, 'The second one', 'another-one-PUJDAU', '<p>PROFESSIONAL SUMMARY\nWith over 2 years’ experience in Information Technology and an unflinching passion for learning and self-development, I\nhave honed my IT skills to the industry’s standard and can boast of expertise in different programming languages and\ndevelopment concepts. I am a full stack developer and cloud technology professional currently looking for an opportunity\nin a diverse and challenging work environment where the best standards are upheld and active learning is encouraged.\nSKILLS\n Programming languages – HTML5, CSS3, JavaScript, PHP, Node Js, Python\n Frameworks – Express Js, Laravel, Django, React Js, Vue Js, Framework 7\n Databases – SQL and NoSQL databases including MySQL, SQLite, MongoDB, Firestore, Realtime Database\n Cloud Technologies – Google Cloud Platform, Amazon Web Services, Microsoft Azure, Digital Ocean\n Template engines – Pug Js, EJS, Template7, Mustache\n Knowledge of C-Panel and WHM hosting\n Basic Knowledge of Docker and Kubernetes\n Good knowledge of API development\n Basic knowledge of UI/UX development\n Basic knowledge of CMS such as Wordpress, Joomla, Drupal\n Ability to quickly adapt and master a new programming language or concept\n Good understanding of web architecture, version control, continuous integrations and continuous development\n Ability to work effectively alone and with a team\n Possess excellent communication skills, both spoken and written\n Expertise with diverse collaboration tools\n Basic knowledge of graphics design\n Creative thinking and problem solving skills\n Highly organized with good time management skills\n Microsoft Office Suite – Excel, Word, PowerPoint, Outlook, Access\n Sound knowledge of project monitoring and evaluation<br></p>', 'PROFESSIONAL SUMMARY\nWith over 2 years’ experience in Information Technology and an unflinching passion for learning and self-development, I\nhave honed my IT skills to the industry’s standard and can boast of expertise in different...', 'https://preview.colorlib.com/theme/parason/img/blog/popular-post/post2.jpg', 'Lifestyle', NULL, 10, 3, '2021-03-08 02:36:30', '2021-03-08 05:30:29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(191) DEFAULT NULL,
  `lastname` varchar(191) DEFAULT NULL,
  `email` varchar(191) NOT NULL,
  `password` varchar(191) DEFAULT NULL,
  `image` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`, `image`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Adebowale', 'Adebusuyi', 'amadebusuyi@gmail.com', '$2y$10$hZJkb5WWXx8vajrBwr6wReF7foh/Iu0yRhQYNEQ.DOX034Ry7QnFu', NULL, '2021-03-07 19:29:37', '2021-03-07 21:02:46', NULL),
(2, 'Adebowale', 'Adebusuyi', 'heclassy@gmail.com', '$2y$10$40WZia11x6IrJZ7EegBELeX4dqJG80V7phSaaSLz9jRXYwjkwLcqG', NULL, '2021-03-07 20:38:58', '2021-03-07 20:58:09', NULL),
(3, 'Emmanuel', 'MoyinOluwa', 'adebowale@gmail.com', '$2y$10$bNTirv4tckcPcQYNMtKEvOyizaGahi2UsPkl7ikQSoALHrv7iBrQi', NULL, '2021-03-07 21:01:07', '2021-03-07 21:01:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `visits`
--

CREATE TABLE `visits` (
  `id` int(11) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `visits`
--

INSERT INTO `visits` (`id`, `token`, `created_at`, `deleted_at`) VALUES
(1, 'ybfqi50df6062isrvlga6ivo223jhyqtzfc8rug5m6vz9leigtmkidpvd77radvb', '2021-03-08 05:54:33', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visits`
--
ALTER TABLE `visits`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `visits`
--
ALTER TABLE `visits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
