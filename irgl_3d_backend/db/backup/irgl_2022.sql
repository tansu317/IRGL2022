-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 23 Mar 2022 pada 17.27
-- Versi server: 10.4.20-MariaDB
-- Versi PHP: 8.0.9

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
-- Struktur dari tabel `2022_error_input`
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
-- Dumping data untuk tabel `2022_error_input`
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
-- Struktur dari tabel `2022_main_participants`
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
-- Dumping data untuk tabel `2022_main_participants`
--

INSERT INTO `2022_main_participants` (`id`, `team_id`, `name`, `date_of_birth`, `city_of_birth`, `school_grade`, `address`, `line_id`, `email`, `phone_number`, `studentid_filepath`, `date_of_registration`) VALUES
(6, 67, 'wrwr', '2022-03-04 00:00:00', 'dqwe', 0, 'edrfewd', 'wefrdew', 'dgsv@saff', '08124234', '002_Surat Undangan_BEM UBAYA.pdf', '2022-03-23 09:21:55'),
(7, 67, 'h', '2022-03-17 00:00:00', 'erdfwqr', 0, 'tyrer', 'wrete', 'da@sfdas', '0856845', '005_Surat Undangan_BEM Universitas Airlangga.docx.pdf', '2022-03-23 09:21:55'),
(8, 67, 'fs', '2022-03-03 00:00:00', 'wesfaewef', 0, 'rterwr', 'wdwd', 'efwa@dasd', '0897645', '003_Surat Undangan_BEM Ciputra.docx.pdf', '2022-03-23 09:21:55'),
(9, 68, 'wer', '2022-03-03 00:00:00', 'dqwe', 0, 'edrfewd', 'wefrdew', 'dgsv@saff', '08124234', '001-SKP Surat Undangan Pembicara Webinar Catur di Masa Pandemi.pdf', '2022-03-23 09:25:59'),
(10, 68, 'sfdwsfd', '2022-03-02 00:00:00', 'erdfwqr', 0, 'tyrer', 'wrete', 'efwe@faws', '0856845', '(no fix)Proposal Webinar Catur di Masa Pandemi.pdf', '2022-03-23 09:25:59'),
(11, 68, '', '2022-03-01 00:00:00', 'wesfaewef', 0, 'rterwr', 'wdwd', 'efwa@dasd', '0897645', '003_Surat Undangan_BEM Ciputra.docx.pdf', '2022-03-23 09:25:59');

-- --------------------------------------------------------

--
-- Struktur dari tabel `2022_main_teams`
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
-- Dumping data untuk tabel `2022_main_teams`
--

INSERT INTO `2022_main_teams` (`id`, `name`, `password`, `leader_id`, `leader_name`, `participant_count`, `school`, `status`, `verificator`, `date_of_verification`, `payment_filepath`, `date_of_registration`, `reset_password_code`, `date_of_reset_request`, `login_token`, `date_of_last_login`, `start_time`, `status_game_penyisihan`, `Poin`) VALUES
(29, 'awsfrdwrfdw', '62988ee5a2650cd3ed6f3d3920a5b05c', NULL, 'sutan', 3, 'waqsfafd', 0, NULL, NULL, '', '2022-03-23 08:49:22', NULL, NULL, NULL, NULL, '', 0, 0),
(31, 'etfgtfgr', '64eca2fd64f8ade47aedf8c98cf37f2a', NULL, 'wer', 3, 'ewsdfcwsefc', 0, NULL, NULL, '', '2022-03-23 08:51:54', NULL, NULL, NULL, NULL, '', 0, 0),
(32, 'etfgtfgr', '64eca2fd64f8ade47aedf8c98cf37f2a', NULL, 'wer', 3, 'ewsdfcwsefc', 0, NULL, NULL, '', '2022-03-23 08:51:54', NULL, NULL, NULL, NULL, '', 0, 0),
(33, 'gsedgfverdfwfwf', 'f7cdcbc050b8a5f9bbd3a6b8dc1f12f1', NULL, 'wrwr', 3, 'fesf', 0, NULL, NULL, '', '2022-03-23 08:54:27', NULL, NULL, NULL, NULL, '', 0, 0),
(34, 'gsedgfverdfwfwf', 'f7cdcbc050b8a5f9bbd3a6b8dc1f12f1', NULL, 'wrwr', 3, 'fesf', 0, NULL, NULL, '', '2022-03-23 08:54:27', NULL, NULL, NULL, NULL, '', 0, 0),
(35, 'ASDFASFD', '5e494133de4a5b0a4ed0e7eaf07ffe25', NULL, 'wrwr', 3, 'EASFSA', 0, NULL, NULL, '', '2022-03-23 08:56:34', NULL, NULL, NULL, NULL, '', 0, 0),
(36, 'ASDFASFD', '5e494133de4a5b0a4ed0e7eaf07ffe25', NULL, 'wrwr', 3, 'EASFSA', 0, NULL, NULL, '', '2022-03-23 08:56:34', NULL, NULL, NULL, NULL, '', 0, 0),
(37, 'ASDWDQAWGFTWERSG', '540a0acd52575d85c1eec06d1fa540c4', NULL, 'wer', 3, 'ESG', 0, NULL, NULL, '', '2022-03-23 08:57:31', NULL, NULL, NULL, NULL, '', 0, 0),
(38, 'ASDWDQAWGFTWERSG', '540a0acd52575d85c1eec06d1fa540c4', NULL, 'wer', 3, 'ESG', 0, NULL, NULL, '', '2022-03-23 08:57:31', NULL, NULL, NULL, NULL, '', 0, 0),
(39, 'DAWSFDWASFS', '4e17f7b4b76e597f76cd7ab1203941ce', NULL, 'wrwr', 3, 'wrf', 0, NULL, NULL, '', '2022-03-23 08:58:14', NULL, NULL, NULL, NULL, '', 0, 0),
(40, 'DAWSFDWASFS', '4e17f7b4b76e597f76cd7ab1203941ce', NULL, 'wrwr', 3, 'wrf', 0, NULL, NULL, '', '2022-03-23 08:58:14', NULL, NULL, NULL, NULL, '', 0, 0),
(41, 'adswadq2e2rdw', 'c51d8cfc0a74d8c57051fae88e70f217', NULL, 'wer', 3, 'jjfg', 0, NULL, NULL, '', '2022-03-23 09:00:35', NULL, NULL, NULL, NULL, '', 0, 0),
(42, 'adswadq2e2rdw', 'c51d8cfc0a74d8c57051fae88e70f217', NULL, 'wer', 3, 'jjfg', 0, NULL, NULL, '', '2022-03-23 09:00:35', NULL, NULL, NULL, NULL, '', 0, 0),
(43, 'awsfrdwrfdwfsaws', '73964cab9a4ff52dff0a565291f8513c', NULL, 'wrwr', 3, 'wrf', 0, NULL, NULL, '', '2022-03-23 09:02:06', NULL, NULL, NULL, NULL, '', 0, 0),
(44, 'awsfrdwrfdwfsaws', '73964cab9a4ff52dff0a565291f8513c', NULL, 'wrwr', 3, 'wrf', 0, NULL, NULL, '', '2022-03-23 09:02:06', NULL, NULL, NULL, NULL, '', 0, 0),
(45, 'wqatfrewsag', 'b02ec8c3f25f6277a045f538435256bb', NULL, 'wer', 3, 'wrf', 0, NULL, NULL, '', '2022-03-23 09:02:40', NULL, NULL, NULL, NULL, '', 0, 0),
(46, 'wqatfrewsag', 'b02ec8c3f25f6277a045f538435256bb', NULL, 'wer', 3, 'wrf', 0, NULL, NULL, '', '2022-03-23 09:02:40', NULL, NULL, NULL, NULL, '', 0, 0),
(47, 'wqatfrewsag', 'b02ec8c3f25f6277a045f538435256bb', NULL, 'wer', 3, 'wrf', 0, NULL, NULL, '', '2022-03-23 09:03:38', NULL, NULL, NULL, NULL, '', 0, 0),
(48, 'wqatfrewsag', 'b02ec8c3f25f6277a045f538435256bb', NULL, 'wer', 3, 'wrf', 0, NULL, NULL, '', '2022-03-23 09:03:38', NULL, NULL, NULL, NULL, '', 0, 0),
(49, 'wqatfrewsag', 'b02ec8c3f25f6277a045f538435256bb', NULL, 'wer', 3, 'wrf', 0, NULL, NULL, '', '2022-03-23 09:05:15', NULL, NULL, NULL, NULL, '', 0, 0),
(50, 'wqatfrewsag', 'b02ec8c3f25f6277a045f538435256bb', NULL, 'wer', 3, 'wrf', 0, NULL, NULL, '', '2022-03-23 09:05:15', NULL, NULL, NULL, NULL, '', 0, 0),
(51, 'wqatfrewsag', 'b02ec8c3f25f6277a045f538435256bb', NULL, 'wer', 3, 'wrf', 0, NULL, NULL, '', '2022-03-23 09:05:40', NULL, NULL, NULL, NULL, '', 0, 0),
(52, 'wqatfrewsag', 'b02ec8c3f25f6277a045f538435256bb', NULL, 'wer', 3, 'wrf', 0, NULL, NULL, '', '2022-03-23 09:05:40', NULL, NULL, NULL, NULL, '', 0, 0),
(53, 'wqatfrewsag', 'b02ec8c3f25f6277a045f538435256bb', NULL, 'wer', 3, 'wrf', 0, NULL, NULL, '', '2022-03-23 09:07:10', NULL, NULL, NULL, NULL, '', 0, 0),
(54, 'wqatfrewsag', 'b02ec8c3f25f6277a045f538435256bb', NULL, 'wer', 3, 'wrf', 0, NULL, NULL, '', '2022-03-23 09:07:10', NULL, NULL, NULL, NULL, '', 0, 0),
(55, 'wqatfrewsag', 'b02ec8c3f25f6277a045f538435256bb', NULL, 'wer', 3, 'wrf', 0, NULL, NULL, '', '2022-03-23 09:07:50', NULL, NULL, NULL, NULL, '', 0, 0),
(56, 'wqatfrewsag', 'b02ec8c3f25f6277a045f538435256bb', NULL, 'wer', 3, 'wrf', 0, NULL, NULL, '', '2022-03-23 09:08:02', NULL, NULL, NULL, NULL, '', 0, 0),
(57, 'awsfrdwrfdw', '667fb9a2ac9ca736899e44498bda2825', NULL, 'wer', 3, 'wrf', 0, NULL, NULL, '', '2022-03-23 09:10:16', NULL, NULL, NULL, NULL, '', 0, 0),
(58, 'awsfrdwrfdw', '667fb9a2ac9ca736899e44498bda2825', NULL, 'wer', 3, 'wrf', 0, NULL, NULL, '', '2022-03-23 09:10:33', NULL, NULL, NULL, NULL, '', 0, 0),
(59, 'awsfrdwrfdw', '667fb9a2ac9ca736899e44498bda2825', NULL, 'wer', 3, 'wrf', 0, NULL, NULL, '', '2022-03-23 09:11:34', NULL, NULL, NULL, NULL, '', 0, 0),
(60, 'awsfrdwrfdw', '667fb9a2ac9ca736899e44498bda2825', NULL, 'wer', 3, 'wrf', 0, NULL, NULL, '', '2022-03-23 09:12:04', NULL, NULL, NULL, NULL, '', 0, 0),
(61, 'angin', 'c2b851868d6732a682ba20a5a12e8eef', NULL, 'wer', 3, 'wrf', 0, NULL, NULL, '', '2022-03-23 09:12:41', NULL, NULL, NULL, NULL, '', 0, 0),
(62, 'nigga124124', 'f88102c789cf6781c6fd4ec5cb3b7260', NULL, 'wer', 3, 'rrwer', 0, NULL, NULL, '', '2022-03-23 09:14:28', NULL, NULL, NULL, NULL, '', 0, 0),
(63, 'nigga124124', 'f88102c789cf6781c6fd4ec5cb3b7260', NULL, 'wer', 3, 'rrwer', 0, NULL, NULL, '', '2022-03-23 09:17:18', NULL, NULL, NULL, NULL, '', 0, 0),
(64, 'tes12345', '27ac0a83022bc24f56fe2eb5fd5d9956', NULL, 'wrwr', 3, 'wef', 0, NULL, NULL, '', '2022-03-23 09:18:28', NULL, NULL, NULL, NULL, '', 0, 0),
(65, 'tes12345', '27ac0a83022bc24f56fe2eb5fd5d9956', NULL, 'wrwr', 3, 'wef', 0, NULL, NULL, '', '2022-03-23 09:21:12', NULL, NULL, NULL, NULL, '', 0, 0),
(66, 'tes12345', '27ac0a83022bc24f56fe2eb5fd5d9956', NULL, 'wrwr', 3, 'wef', 0, NULL, NULL, '', '2022-03-23 09:21:24', NULL, NULL, NULL, NULL, '', 0, 0),
(67, 'tes123455654756', 'a73ca5edf5835cdb1c2bba4f420d507a', NULL, 'wrwr', 3, 'wef', 0, NULL, NULL, '', '2022-03-23 09:21:55', NULL, NULL, NULL, NULL, '', 0, 0),
(68, 'ukyuiyuhjytgj', 'd69c626fb42d1a807050bc1946c83339', NULL, 'wer', 2, 'gedgvfrwesvf', 0, NULL, NULL, '', '2022-03-23 09:25:59', NULL, NULL, NULL, NULL, '', 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `nrp` varchar(9) NOT NULL,
  `password` text NOT NULL,
  `time_login` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `nrp`, `password`, `time_login`) VALUES
(1, 'c14200090', '14998a31d821724b918c38d9ca208a78', '2022-01-18 09:58:53');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `2022_error_input`
--
ALTER TABLE `2022_error_input`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `2022_main_participants`
--
ALTER TABLE `2022_main_participants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `team_id` (`team_id`);

--
-- Indeks untuk tabel `2022_main_teams`
--
ALTER TABLE `2022_main_teams`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `2022_error_input`
--
ALTER TABLE `2022_error_input`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT untuk tabel `2022_main_participants`
--
ALTER TABLE `2022_main_participants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `2022_main_teams`
--
ALTER TABLE `2022_main_teams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `2022_main_participants`
--
ALTER TABLE `2022_main_participants`
  ADD CONSTRAINT `team_id` FOREIGN KEY (`team_id`) REFERENCES `2022_main_teams` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
