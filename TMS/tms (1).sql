-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 12, 2024 at 11:28 AM
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
-- Database: `tms`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `title`, `datetime`) VALUES
(1, 'Bug', '2024-10-28 07:35:10'),
(2, 'section', '2024-10-31 18:53:12');

-- --------------------------------------------------------

--
-- Table structure for table `designations`
--

CREATE TABLE `designations` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `designations`
--

INSERT INTO `designations` (`id`, `title`, `datetime`) VALUES
(2, 'Web_Developer', '2024-10-27 07:37:59'),
(3, 'AI_developer', '2024-10-31 18:51:01'),
(4, 'Python_developer', '2024-11-03 10:22:26'),
(5, 'DevOps_engineer', '2024-11-03 10:22:38'),
(6, '.net_developer', '2024-11-03 10:23:13'),
(8, 'Angular_developer', '2024-11-03 10:23:33');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `task_id` int(11) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  `files` varchar(200) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `task_id`, `project_id`, `files`, `datetime`) VALUES
(13, NULL, 4, 'uploads/1731158559_d06a0b1d32081c453755.docx', '2024-11-09 13:22:39'),
(14, 2, NULL, 'uploads/1731158629_7168e05cb579e0913337.docx', '2024-11-09 13:23:49'),
(15, 3, NULL, 'uploads/1731158694_9b3c43daf1c939f53d3f.docx', '2024-11-09 13:24:54');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `message` text NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `project_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `start_date` varchar(50) NOT NULL,
  `due_date` varchar(50) NOT NULL,
  `created_by` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `title`, `description`, `start_date`, `due_date`, `created_by`, `team_id`, `datetime`) VALUES
(4, 'RationShop', 'using python stock management project', '2024-11-10', '2024-11-20', 1, 19, '2024-11-09 13:22:39');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `start_date` varchar(50) NOT NULL,
  `due_date` varchar(50) NOT NULL,
  `priority` varchar(50) NOT NULL,
  `project_id` int(11) DEFAULT NULL,
  `category` varchar(50) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `team_id` int(11) DEFAULT NULL,
  `assigned_staff` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `parent_task` int(11) DEFAULT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `title`, `description`, `start_date`, `due_date`, `priority`, `project_id`, `category`, `status`, `team_id`, `assigned_staff`, `created_by`, `parent_task`, `datetime`) VALUES
(2, 'Registeration', 'create project and database and user table ', '2024-11-11', '2024-11-11', 'High', 4, 'section', 0, 19, 5, 1, NULL, '2024-11-09 13:23:49'),
(3, 'Login', ' Login user serverside code', '2024-11-12', '2024-11-12', 'High', 4, 'section', 0, 19, 5, 1, NULL, '2024-11-09 13:24:54');

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` int(11) NOT NULL,
  `team_name` varchar(50) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `team_name`, `datetime`) VALUES
(19, 'OneMan', '2024-11-09 13:21:32'),
(21, 'arawer', '2024-11-09 16:35:49');

-- --------------------------------------------------------

--
-- Table structure for table `team_members`
--

CREATE TABLE `team_members` (
  `id` int(11) NOT NULL,
  `team_id` int(11) DEFAULT NULL,
  `member_id` int(11) DEFAULT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `team_members`
--

INSERT INTO `team_members` (`id`, `team_id`, `member_id`, `datetime`) VALUES
(86, 19, 5, '2024-11-09 13:21:32'),
(89, 21, 6, '2024-11-09 16:35:49'),
(90, 21, 7, '2024-11-09 16:35:49');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `designation` varchar(50) NOT NULL,
  `user_type` int(10) NOT NULL,
  `password` varchar(300) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `contact`, `designation`, `user_type`, `password`, `datetime`) VALUES
(1, 'admin', 'admin@gmail.com', '3546564738', 'null', 1, '$2y$10$7Sj82yXAhwZ/dWx/l9.ane7lGhPbp.s/dRDgbwhuhk/iFUNhqJRfi', '2024-10-27 06:39:38'),
(5, 'sanalkr', 'tony@gmail.com', '2343434343', 'Web_Developer', 2, '$2y$10$o1caFQdHNPjhFucgRFr4f.1ODzLmd6KjDP9yJ6.1shOX2.ljiCi1i', '2024-10-27 07:11:52'),
(6, 'avengers', 'avengers@gmail.com', '3454545644', 'Web_Developer', 3, '$2y$10$9h5en6Yt3VqH5.OfgbHAp.F8wljUyKbwEsIq2QJ/vdexb61sPn8Ky', '2024-10-27 07:38:15'),
(7, 'killmonger', 'k@gmail.com', '2343434341', 'Python_developer', 3, '$2y$10$zL3opniX/oFvQseThAiW3uZhzXH/nBRPoiVhQEwKYU5jgE7NrP5pq', '2024-10-27 08:42:43'),
(8, 'killmonger1', 'k1@gmail.com', '2343434241', 'Web_Developer', 3, '$2y$10$N97wjobgJRebWF0EM0XfF.hvcH2/T0ukudOhI7S7IGGSGqKFyu8d6', '2024-10-27 08:43:03'),
(9, 'killmonger56', 'k671@gmail.com', '2343436741', 'Python_developer', 2, '$2y$10$kKV5kbJyWFwgwbp18V5e1ubPlj0J/vBHeGmcmefxVXjdOeINsvlfa', '2024-10-27 08:43:41'),
(10, 'leelamanimk', 'leela@gmail.com', '4536564758', 'Web_Developer', 3, '$2y$10$dIF59.n907e4UdFCJU2sROdyDK4QFBWRWR2dLD9jM5nF5kgMhlnYi', '2024-11-01 08:11:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `designations`
--
ALTER TABLE `designations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tasks` (`task_id`),
  ADD KEY `fk_projects` (`project_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_message_users` (`user_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_projectTeams` (`team_id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_projects_tasks` (`project_id`),
  ADD KEY `fk_teams_tasks` (`team_id`),
  ADD KEY `fk_assigned_users` (`assigned_staff`),
  ADD KEY `fk_created_users` (`created_by`),
  ADD KEY `fk_parent` (`parent_task`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `team_members`
--
ALTER TABLE `team_members`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_teams` (`team_id`),
  ADD KEY `fk_users` (`member_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `designations`
--
ALTER TABLE `designations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `team_members`
--
ALTER TABLE `team_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `files`
--
ALTER TABLE `files`
  ADD CONSTRAINT `fk_projects` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_tasks` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `fk_message_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `fk_projectTeams` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `fk_assigned_users` FOREIGN KEY (`assigned_staff`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_created_users` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_parent` FOREIGN KEY (`parent_task`) REFERENCES `tasks` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_projects_tasks` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_teams_tasks` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `team_members`
--
ALTER TABLE `team_members`
  ADD CONSTRAINT `fk_teams` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_users` FOREIGN KEY (`member_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
