-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 25, 2022 at 08:04 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `irgl_2022`
--

-- --------------------------------------------------------

--
-- Table structure for table `2022_admin`
--

CREATE TABLE `2022_admin` (
  `id_admin` int(11) NOT NULL,
  `nrp` varchar(9) NOT NULL,
  `password` varchar(255) NOT NULL,
  `last_time_login` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `login_cookie` varchar(32) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `division` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `2022_admin`
--

INSERT INTO `2022_admin` (`id_admin`, `nrp`, `password`, `last_time_login`, `login_cookie`, `nama`, `division`) VALUES
(1, 'c14200090', '14998a31d821724b918c38d9ca208a78', '2022-03-25 07:03:38', '', 'Azarya K.S.P Dami', 'IT'),
(2, 'c14210004', '$2y$10$XbKWd6F1rM89yyvi0cUmruEjkB8kvzjyS3jKTaJKMA5skqEFz5mbK', '2022-03-25 07:03:46', '', 'Andreas Pandu P', 'IT');

-- --------------------------------------------------------

--
-- Table structure for table `2022_error_input`
--

CREATE TABLE `2022_error_input` (
  `id` int(10) NOT NULL,
  `ip` varchar(150) NOT NULL,
  `ua` varchar(500) NOT NULL,
  `json` varchar(500) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp(),
  `page` varchar(255) NOT NULL,
  `error` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `2022_main_participants`
--

CREATE TABLE `2022_main_participants` (
  `id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `date_of_birth` datetime NOT NULL,
  `city_of_birth` text NOT NULL,
  `school_grade` int(11) NOT NULL,
  `address` text NOT NULL,
  `line_id` text NOT NULL,
  `email` text NOT NULL,
  `phone_number` text NOT NULL,
  `studentid_filepath` text NOT NULL,
  `date_of_registration` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `2022_main_participants`
--

INSERT INTO `2022_main_participants` (`id`, `team_id`, `name`, `date_of_birth`, `city_of_birth`, `school_grade`, `address`, `line_id`, `email`, `phone_number`, `studentid_filepath`, `date_of_registration`) VALUES
(1, 1, 'Andreas', '2002-01-01 00:00:00', 'Sidoarjo', 0, 'Test alamat rumah', 'Test ID line', 'andreas@gmail.com', '081234567890', 'Andreas_Team 1_cardmember_2022-03-25-07-56-26.jpeg', '2022-03-25 00:56:26'),
(2, 1, 'Edward', '2002-01-02 00:00:00', 'Surabaya', 0, 'Test alamat rumah', 'Test ID line', 'edward@gmail.com', '081234567890', 'Edward_Team 1_cardmember_2022-03-25-07-56-26.jpeg', '2022-03-25 00:56:26'),
(3, 2, 'Sutan', '2001-01-01 00:00:00', 'Surabaya', 0, 'Test Alamat Rumah', 'Test ID Line', 'sutan@gmail.com', '08123456789', 'Sutan_Team 2_cardmember_2022-03-25-08-00-18.jpeg', '2022-03-25 01:00:18'),
(4, 2, 'Cheryl', '2001-01-02 00:00:00', 'Surabaya', 0, 'Test Alamat Rumah', 'Test ID Line', 'sutan@gmail.com', '08123456789', 'Cheryl_Team 2_cardmember_2022-03-25-08-00-18.jpeg', '2022-03-25 01:00:18'),
(5, 2, 'Anthony', '2002-01-03 00:00:00', 'Surabaya', 0, 'Test Alamat Rumah', 'Test ID Line', 'sutan@gmail.com', '08123456789', 'Anthony_Team 2_cardmember_2022-03-25-08-00-18.jpeg', '2022-03-25 01:00:18');

-- --------------------------------------------------------

--
-- Table structure for table `2022_main_teams`
--

CREATE TABLE `2022_main_teams` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `password` text NOT NULL,
  `leader_id` int(11) DEFAULT NULL,
  `leader_name` text NOT NULL,
  `participant_count` int(11) NOT NULL,
  `school` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `verificator` text DEFAULT NULL,
  `date_of_verification` datetime DEFAULT NULL,
  `payment_filepath` text NOT NULL,
  `date_of_registration` timestamp NOT NULL DEFAULT current_timestamp(),
  `reset_password_code` text DEFAULT NULL,
  `date_of_reset_request` timestamp NULL DEFAULT NULL,
  `login_token` text DEFAULT NULL,
  `date_of_last_login` timestamp NULL DEFAULT NULL,
  `start_time` text NOT NULL,
  `status_game_penyisihan` int(11) NOT NULL,
  `Poin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `2022_main_teams`
--

INSERT INTO `2022_main_teams` (`id`, `name`, `password`, `leader_id`, `leader_name`, `participant_count`, `school`, `status`, `verificator`, `date_of_verification`, `payment_filepath`, `date_of_registration`, `reset_password_code`, `date_of_reset_request`, `login_token`, `date_of_last_login`, `start_time`, `status_game_penyisihan`, `Poin`) VALUES
(1, 'Team 1', '$2y$10$GQkSb8DKGnlY9KbJ.YMpmOAuwJaQ0eJOxZgc2UkzS6yOMTXbDh6MG', NULL, 'Andreas', 2, 'Universitas Surabaya', 0, NULL, NULL, 'Team 1_buktitrf_2022-03-25-07-56-26.pdf', '2022-03-25 00:56:26', NULL, NULL, NULL, NULL, '', 0, 0),
(2, 'Team 2', '$2y$10$UvJnWrJeFfaswHheBEhRzup4NH/s2UksvMqug/.hNUP2YChe2Z7p.', NULL, 'Sutan', 3, 'Universitas Kristen Petra', 1, NULL, NULL, 'Team 2_buktitrf_2022-03-25-08-00-18.pdf', '2022-03-25 01:00:18', NULL, NULL, NULL, '2022-03-25 01:02:21', '', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `2022_admin`
--
ALTER TABLE `2022_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `2022_error_input`
--
ALTER TABLE `2022_error_input`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `2022_main_participants`
--
ALTER TABLE `2022_main_participants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `team_id` (`team_id`);

--
-- Indexes for table `2022_main_teams`
--
ALTER TABLE `2022_main_teams`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `2022_admin`
--
ALTER TABLE `2022_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `2022_error_input`
--
ALTER TABLE `2022_error_input`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `2022_main_participants`
--
ALTER TABLE `2022_main_participants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `2022_main_teams`
--
ALTER TABLE `2022_main_teams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `2022_main_participants`
--
ALTER TABLE `2022_main_participants`
  ADD CONSTRAINT `team_id` FOREIGN KEY (`team_id`) REFERENCES `2022_main_teams` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
