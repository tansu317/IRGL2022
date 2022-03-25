-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2022 at 09:44 AM
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
(1, 'c14200090', '14998a31d821724b918c38d9ca208a78', '2022-01-19 04:07:25', '', '', ''),
(2, 'c14210004', '$2y$10$XbKWd6F1rM89yyvi0cUmruEjkB8kvzjyS3jKTaJKMA5skqEFz5mbK', '2022-03-24 01:56:48', '', 'Andreas Pandu P', '');

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

--
-- Dumping data for table `2022_error_input`
--

INSERT INTO `2022_error_input` (`id`, `ip`, `ua`, `json`, `time`, `page`, `error`) VALUES
(1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36 OPR/84.0.4316.21', '{\n  \"ip\": \"127.0.0.1\",\n  \"bogon\": true\n}', '2022-03-07 06:27:48', 'page', 'test'),
(2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36 OPR/84.0.4316.21', '{\n  \"ip\": \"127.0.0.1\",\n  \"bogon\": true\n}', '2022-03-07 06:27:48', 'page', 'test'),
(3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36 OPR/84.0.4316.21', '{\n  \"ip\": \"127.0.0.1\",\n  \"bogon\": true\n}', '2022-03-07 06:28:07', 'page', 'test'),
(4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.109 Safari/537.36 OPR/84.0.4316.31', '{\n  \"ip\": \"127.0.0.1\",\n  \"bogon\": true\n}', '2022-03-12 12:59:29', 'page', 'test'),
(5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.109 Safari/537.36 OPR/84.0.4316.31', '{\n  \"ip\": \"127.0.0.1\",\n  \"bogon\": true\n}', '2022-03-12 12:59:39', 'page', 'test'),
(6, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.109 Safari/537.36 OPR/84.0.4316.31', '{\n  \"ip\": \"127.0.0.1\",\n  \"bogon\": true\n}', '2022-03-12 13:33:08', 'page', 'test'),
(7, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.109 Safari/537.36 OPR/84.0.4316.31', '{\n  \"ip\": \"127.0.0.1\",\n  \"bogon\": true\n}', '2022-03-12 14:04:23', 'page', 'test'),
(8, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.109 Safari/537.36 OPR/84.0.4316.31', '{\n  \"ip\": \"127.0.0.1\",\n  \"bogon\": true\n}', '2022-03-12 14:09:12', 'page', 'test'),
(9, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.109 Safari/537.36 OPR/84.0.4316.31', '{\n  \"ip\": \"127.0.0.1\",\n  \"bogon\": true\n}', '2022-03-12 14:09:18', 'page', 'test'),
(10, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.109 Safari/537.36 OPR/84.0.4316.31', '{\n  \"ip\": \"127.0.0.1\",\n  \"bogon\": true\n}', '2022-03-12 14:09:22', 'page', 'test'),
(11, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.109 Safari/537.36 OPR/84.0.4316.31', '{\n  \"ip\": \"127.0.0.1\",\n  \"bogon\": true\n}', '2022-03-12 15:01:34', 'page', 'test'),
(12, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.109 Safari/537.36 OPR/84.0.4316.31', '{\n  \"ip\": \"127.0.0.1\",\n  \"bogon\": true\n}', '2022-03-12 15:15:03', 'page', 'test'),
(13, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.109 Safari/537.36 OPR/84.0.4316.31', '{\n  \"ip\": \"127.0.0.1\",\n  \"bogon\": true\n}', '2022-03-12 15:25:24', 'page', 'test'),
(14, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.109 Safari/537.36 OPR/84.0.4316.31', '{\n  \"ip\": \"127.0.0.1\",\n  \"bogon\": true\n}', '2022-03-12 15:27:26', 'page', 'test'),
(15, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.51 Safari/537.36', '{\n  \"ip\": \"127.0.0.1\",\n  \"bogon\": true\n}', '2022-03-12 15:36:52', 'page', 'test'),
(16, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.109 Safari/537.36 OPR/84.0.4316.31', '{\n  \"ip\": \"127.0.0.1\",\n  \"bogon\": true\n}', '2022-03-12 15:39:16', 'page', 'test'),
(17, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.109 Safari/537.36 OPR/84.0.4316.31', '{\n  \"ip\": \"127.0.0.1\",\n  \"bogon\": true\n}', '2022-03-12 15:40:44', 'page', 'test'),
(18, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.109 Safari/537.36 OPR/84.0.4316.31', '{\n  \"ip\": \"127.0.0.1\",\n  \"bogon\": true\n}', '2022-03-12 16:17:27', 'page', 'test'),
(19, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.109 Safari/537.36 OPR/84.0.4316.31', '{\n  \"ip\": \"127.0.0.1\",\n  \"bogon\": true\n}', '2022-03-12 16:37:04', 'page', 'test'),
(20, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.109 Safari/537.36 OPR/84.0.4316.31', '{\n  \"ip\": \"127.0.0.1\",\n  \"bogon\": true\n}', '2022-03-12 16:44:14', 'page', 'test'),
(21, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.109 Safari/537.36 OPR/84.0.4316.31', '{\n  \"ip\": \"127.0.0.1\",\n  \"bogon\": true\n}', '2022-03-12 16:44:20', 'page', 'test'),
(22, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.109 Safari/537.36 OPR/84.0.4316.31', '{\n  \"ip\": \"127.0.0.1\",\n  \"bogon\": true\n}', '2022-03-12 16:46:49', 'page', 'test'),
(23, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.109 Safari/537.36 OPR/84.0.4316.31', '{\n  \"ip\": \"127.0.0.1\",\n  \"bogon\": true\n}', '2022-03-12 16:50:18', 'page', 'test'),
(24, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.109 Safari/537.36 OPR/84.0.4316.31', '{\n  \"ip\": \"127.0.0.1\",\n  \"bogon\": true\n}', '2022-03-12 16:50:26', 'page', 'test'),
(25, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.109 Safari/537.36 OPR/84.0.4316.31', '{\n  \"ip\": \"127.0.0.1\",\n  \"bogon\": true\n}', '2022-03-12 16:52:49', 'page', 'test'),
(26, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.109 Safari/537.36 OPR/84.0.4316.31', '{\n  \"ip\": \"127.0.0.1\",\n  \"bogon\": true\n}', '2022-03-12 16:53:45', 'page', 'test'),
(27, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.109 Safari/537.36 OPR/84.0.4316.31', '{\n  \"ip\": \"127.0.0.1\",\n  \"bogon\": true\n}', '2022-03-12 17:18:20', 'page', 'test'),
(28, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.109 Safari/537.36 OPR/84.0.4316.31', '{\n  \"ip\": \"127.0.0.1\",\n  \"bogon\": true\n}', '2022-03-12 17:18:57', 'page', 'test'),
(29, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.109 Safari/537.36 OPR/84.0.4316.31', '{\n  \"ip\": \"127.0.0.1\",\n  \"bogon\": true\n}', '2022-03-12 17:19:48', 'page', 'test'),
(30, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.109 Safari/537.36 OPR/84.0.4316.31', '{\n  \"ip\": \"127.0.0.1\",\n  \"bogon\": true\n}', '2022-03-12 17:40:15', 'page', 'test'),
(31, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.109 Safari/537.36 OPR/84.0.4316.31', '{\n  \"ip\": \"127.0.0.1\",\n  \"bogon\": true\n}', '2022-03-12 17:40:36', 'page', 'test'),
(32, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.109 Safari/537.36 OPR/84.0.4316.31', '{\n  \"ip\": \"127.0.0.1\",\n  \"bogon\": true\n}', '2022-03-12 17:43:48', 'page', 'test'),
(33, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.109 Safari/537.36 OPR/84.0.4316.31', '{\n  \"ip\": \"127.0.0.1\",\n  \"bogon\": true\n}', '2022-03-12 17:44:06', 'page', 'test'),
(34, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.109 Safari/537.36 OPR/84.0.4316.31', '{\n  \"ip\": \"127.0.0.1\",\n  \"bogon\": true\n}', '2022-03-13 05:29:51', 'page', 'test'),
(35, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.109 Safari/537.36 OPR/84.0.4316.31', '{\n  \"ip\": \"127.0.0.1\",\n  \"bogon\": true\n}', '2022-03-13 05:39:33', 'page', 'test'),
(36, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.109 Safari/537.36 OPR/84.0.4316.31', '{\n  \"ip\": \"127.0.0.1\",\n  \"bogon\": true\n}', '2022-03-13 05:41:22', 'page', 'test'),
(37, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.109 Safari/537.36 OPR/84.0.4316.31', '{\n  \"ip\": \"127.0.0.1\",\n  \"bogon\": true\n}', '2022-03-13 05:51:09', 'page', 'test'),
(38, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.109 Safari/537.36 OPR/84.0.4316.31', '{\n  \"ip\": \"127.0.0.1\",\n  \"bogon\": true\n}', '2022-03-13 07:33:38', 'page', 'test'),
(39, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.109 Safari/537.36 OPR/84.0.4316.31', '{\n  \"ip\": \"127.0.0.1\",\n  \"bogon\": true\n}', '2022-03-13 08:06:52', 'page', 'test'),
(40, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.109 Safari/537.36 OPR/84.0.4316.31', '{\n  \"ip\": \"127.0.0.1\",\n  \"bogon\": true\n}', '2022-03-13 08:07:28', 'page', 'test'),
(41, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.109 Safari/537.36 OPR/84.0.4316.31', '{\n  \"ip\": \"127.0.0.1\",\n  \"bogon\": true\n}', '2022-03-13 08:07:48', 'page', 'test'),
(42, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.109 Safari/537.36 OPR/84.0.4316.31', '{\n  \"ip\": \"127.0.0.1\",\n  \"bogon\": true\n}', '2022-03-13 08:07:48', 'page', 'test'),
(43, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.109 Safari/537.36 OPR/84.0.4316.31', '{\n  \"ip\": \"127.0.0.1\",\n  \"bogon\": true\n}', '2022-03-13 08:09:15', 'page', 'test'),
(44, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.109 Safari/537.36 OPR/84.0.4316.31', '{\n  \"ip\": \"127.0.0.1\",\n  \"bogon\": true\n}', '2022-03-13 08:09:49', 'page', 'test'),
(45, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.109 Safari/537.36 OPR/84.0.4316.31', '{\n  \"ip\": \"127.0.0.1\",\n  \"bogon\": true\n}', '2022-03-15 14:38:46', 'page', 'test'),
(46, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.109 Safari/537.36 OPR/84.0.4316.31', '{\n  \"ip\": \"127.0.0.1\",\n  \"bogon\": true\n}', '2022-03-15 14:40:01', 'page', 'test'),
(47, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.109 Safari/537.36 OPR/84.0.4316.31', '{\n  \"ip\": \"127.0.0.1\",\n  \"bogon\": true\n}', '2022-03-15 14:40:02', 'page', 'test'),
(48, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.109 Safari/537.36 OPR/84.0.4316.31', '{\n  \"ip\": \"127.0.0.1\",\n  \"bogon\": true\n}', '2022-03-15 14:40:15', 'page', 'test'),
(49, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.109 Safari/537.36 OPR/84.0.4316.31', '{\n  \"ip\": \"127.0.0.1\",\n  \"bogon\": true\n}', '2022-03-18 16:25:23', 'page', 'test'),
(50, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.109 Safari/537.36 OPR/84.0.4316.31', '{\n  \"ip\": \"127.0.0.1\",\n  \"bogon\": true\n}', '2022-03-19 10:59:27', 'page', 'test');

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
(1, 1, 'Andreas', '2002-01-01 00:00:00', 'Surabaya', 2, 'Test alamat rumah', 'test 1 line', 'andreas@gmail.com', '081234567890', 'Andreas_Team 1_cardmember_2022-03-24-09-28-45.jpeg', '2022-03-24 02:28:45'),
(2, 1, 'Edward', '2002-01-02 00:00:00', 'Surabaya', 2, 'Test alamat rumah', 'test 1 line', 'edward@gmail.com', '081234567890', 'Edward_Team 1_cardmember_2022-03-24-09-28-45.jpeg', '2022-03-24 02:28:45'),
(3, 2, 'Azarya', '2001-01-01 00:00:00', 'Surabaya', 3, 'Test alamat rumah', 'test id line', 'azarya@gmail.com', '081234567890', 'Azarya_Team 2_cardmember_2022-03-24-09-35-37.jpeg', '2022-03-24 02:35:37'),
(4, 2, 'Cheryl', '2001-01-02 00:00:00', 'Surabaya', 3, 'Test alamat rumah', 'test id line', 'azarya@gmail.com', '081234567890', 'Cheryl_Team 2_cardmember_2022-03-24-09-35-37.jpeg', '2022-03-24 02:35:37'),
(5, 2, 'Anthony', '2001-01-03 00:00:00', 'Surabaya', 3, 'Test alamat rumah', 'test id line', 'azarya@gmail.com', '081234567890', 'Anthony_Team 2_cardmember_2022-03-24-09-35-37.jpeg', '2022-03-24 02:35:37');

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
(1, 'Team 1', '$2y$10$VRM2aa0GWST62Zrh3T3KWunL/BbHgQW5VfKRlRdtN1x2K9EXc6LqO', NULL, 'Andreas', 2, 'Universitas Surabaya', 0, NULL, NULL, 'Team 1_buktitrf_2022-03-24-09-28-45.docx', '2022-03-24 02:28:45', NULL, NULL, NULL, NULL, '', 0, 0),
(2, 'Team 2', '$2y$10$BAkDPmUiER83nKEdC5NDkeVmDTgCVOw0jONoXb70GLlll5RUXtucS', NULL, 'Azarya', 3, 'Universitas Kristen Petra', 1, NULL, NULL, 'Team 2_buktitrf_2022-03-24-09-35-37.docx', '2022-03-24 02:35:37', NULL, NULL, NULL, '2022-03-24 02:42:12', '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `nrp` varchar(9) NOT NULL,
  `password` text NOT NULL,
  `time_login` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nrp`, `password`, `time_login`) VALUES
(1, 'c14200090', '14998a31d821724b918c38d9ca208a78', '2022-01-18 09:58:53');

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
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

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
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

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
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
