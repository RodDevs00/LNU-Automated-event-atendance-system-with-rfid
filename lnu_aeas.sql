-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 21, 2022 at 12:42 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lnu_aeas`
--

-- --------------------------------------------------------

--
-- Table structure for table `4ps_beneficiaries`
--

CREATE TABLE `4ps_beneficiaries` (
  `attendance_no` int(10) NOT NULL,
  `rfid_no` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `student_no` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `organization` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_in` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_out` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `4ps_beneficiaries`
--

INSERT INTO `4ps_beneficiaries` (`attendance_no`, `rfid_no`, `student_no`, `name`, `organization`, `course`, `time_in`, `time_out`) VALUES
(1, 'BB6FFB27', ' 1800123', 'Miguel Gyro Madaoi', 'Developmental Integrated Group Of Information Technology Students (DIGITS)', 'BSIT', '10:48:59:A', '10:50:27:A'),
(2, '9B06BA28', ' 1803425', 'Seaenah Olive Penachos', 'Senior Class Organization (SenCO)', 'BSTM', '10:49:09:A', '10:50:19:A'),
(3, 'DB3FFE27', ' 1806785', 'Claire Valen', 'Hoteliers & Restaurateurs', 'BSHM', '10:49:18:A', '10:50:07:A'),
(4, '8BB4FC27', ' 1802456', 'Loel Jay De leon', 'Developmental Integrated Group Of Information Technology Students (DIGITS)', 'BSIT', '10:49:27:A', '10:49:59:A'),
(5, 'ABE8EE27', ' 1800717', 'Karl Dave Almeria', 'Developmental Integrated Group Of Information Technology Students (DIGITS)', 'BSIT', '10:49:33:A', '10:49:37:A');

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `organization` varchar(100) NOT NULL,
  `role` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `username`, `password`, `organization`, `role`, `created_at`) VALUES
(90, 'Santiago Pangan Jr', 'superadmin', '$2y$10$yV9HbPQ8Ls/i/MXlrcJFG.r7e71Pq/gf4dkfiflIVJlg1bhgVovdC', 'Developmental Integrated Group Of Information Technology Students (DIGITS)', 'Super admin', '2022-05-31 02:11:51'),
(94, 'Queenie Jean Urena', 'SSC', '$2y$10$Jzw20JgDRQLCTWYINrkuDuMTq0Txw2Y7LquzoWmFUJ6HaMaXzYI6W', 'Supreme Student Council (SSC)', 'Super admin', '2022-05-31 22:38:30'),
(95, 'Roderick Gula', 'Digits101', '$2y$10$CdESNNRMh1moWYLs7qHDqe8zb1nsKdPcL38VMbYWwsD6o/NCI7Y/W', 'Developmental Integrated Group Of Information Technology Students (DIGITS)', 'Admin', '2022-05-31 22:40:03'),
(96, 'Rex Shalyn Lagarto', 'ASTG', '$2y$10$KgoL0S0krYWCOU2PDmWP..rzj5YH6XruUTaCTTo8UjlymmEor.JKu', 'Association of Student Tour Guides (ASTG)', 'Admin', '2022-06-01 00:46:11');

-- --------------------------------------------------------

--
-- Table structure for table `bday_party`
--

CREATE TABLE `bday_party` (
  `attendance_no` int(10) NOT NULL,
  `rfid_no` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `student_no` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `organization` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_in` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_out` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bday_party`
--

INSERT INTO `bday_party` (`attendance_no`, `rfid_no`, `student_no`, `name`, `organization`, `course`, `time_in`, `time_out`) VALUES
(1, 'BBEAF527', ' 1800679', 'Vanessa Mae Lucero', 'JSWAP LNU Chapter', 'BSSW', '10:25:09:A', '10:25:15:A'),
(2, 'EB64EF27', ' 1802431', 'Shamalca Marie Lopez', 'Tourism Circle', 'BSTM', '10:25:27:A', '10:25:34:A'),
(3, 'BB6FFB27', ' 1800123', 'Miguel Gyro Madaoi', 'Developmental Integrated Group Of Information Technology Students (DIGITS)', 'BSIT', '10:25:45:A', '10:25:49:A'),
(4, '9B06BA28', ' 1803425', 'Seaenah Olive Penachos', 'Senior Class Organization (SenCO)', 'BSTM', '10:26:01:A', '10:26:05:A'),
(5, '8BB4FC27', ' 1802456', 'Loel Jay De leon', 'Developmental Integrated Group Of Information Technology Students (DIGITS)', 'BSIT', '10:26:16:A', '10:26:19:A');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_Id` int(10) NOT NULL,
  `course` varchar(100) NOT NULL,
  `organization` varchar(100) NOT NULL,
  `College` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_Id`, `course`, `organization`, `College`) VALUES
(27, 'BSSW', 'JSWAP LNU Chapter', 'College of Arts and Sciences (CAS)'),
(28, 'BSHM', 'Hoteliers & Restaurateurs\' Circle', 'College of Management and Entrepreneurship (CME)'),
(29, 'BECED', 'Early Childhood Educators\' Organization', 'College of Education (COE)'),
(30, 'BPED', 'BPED Movers Organization', 'College of Education (COE)'),
(31, 'BTLED', 'Technologist and Livelihood Educators Guild (TLE GUILD)', 'College of Education (COE)'),
(32, 'BSED', 'Math Students\' Society', 'College of Education (COE)'),
(33, 'BSIT', 'Developmental Integrated Group Of Information Technology Students (DIGITS)', 'College of Arts and Sciences (CAS)'),
(34, 'BSBIO', 'Science Questers Unlimited', 'College of Arts and Sciences (CAS)'),
(35, 'BACOMM', 'BACommUNITY', 'College of Arts and Sciences (CAS)'),
(36, 'BSTM', 'Association of Student Tour Guides (ASTG)', 'College of Management and Entrepreneurship (CME)'),
(37, 'BSED', 'Interact Society', 'College of Education (COE)'),
(38, 'BLIS', 'Book Enthusiasts', 'College of Arts and Sciences (CAS)'),
(39, 'BSED', 'English Circle', 'College of Education (COE)'),
(40, 'BSED', 'Kapisanang Maka-Filipino', 'College of Education (COE)'),
(41, 'BSTM', 'Tourism Circle', 'College of Management and Entrepreneurship (CME)'),
(42, 'BEED', 'COFED', 'College of Education (COE)'),
(43, 'BSED', 'Association of Values Educators', 'College of Education (COE)'),
(44, 'BAPOS', 'Freshmen Class Organization', 'College of Arts and Sciences (CAS)'),
(45, 'BAEL', 'Sophomore Class Organization', 'College of Education (COE)'),
(46, 'BSE', 'Junior Class Organization', 'College of Education (COE)'),
(47, 'BSTM', 'Senior Class Organization (SenCO)', 'College of Management and Entrepreneurship (CME)'),
(48, 'Others', 'Supreme Student Council (SSC)', 'Others');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_id` int(10) NOT NULL,
  `event_title` varchar(100) NOT NULL,
  `organizers` varchar(100) NOT NULL,
  `num_males` int(10) NOT NULL,
  `num_females` int(10) NOT NULL,
  `yrlvl1` int(10) NOT NULL,
  `yrlvl2` int(10) NOT NULL,
  `yrlvl3` int(10) NOT NULL,
  `yrlvl4` int(10) NOT NULL,
  `date` date NOT NULL,
  `total_attendance` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`event_id`, `event_title`, `organizers`, `num_males`, `num_females`, `yrlvl1`, `yrlvl2`, `yrlvl3`, `yrlvl4`, `date`, `total_attendance`) VALUES
(124, 'IT Road Show', 'Developmental Integrated Group Of Information Technology Students (DIGITS)', 5, 3, 1, 1, 2, 4, '2022-06-16', 8),
(125, 'Foundation Day', 'Developmental Integrated Group Of Information Technology Students (DIGITS)', 5, 5, 1, 2, 3, 4, '2022-06-30', 10),
(126, 'Bday Party', 'English Circle', 2, 3, 0, 1, 1, 3, '2022-07-30', 5),
(127, 'IT Days', 'Developmental Integrated Group Of Information Technology Students (DIGITS)', 4, 3, 0, 1, 2, 4, '2022-08-27', 7),
(128, '4ps beneficiaries', 'JSWAP LNU Chapter', 4, 1, 0, 0, 2, 3, '2022-08-31', 5);

-- --------------------------------------------------------

--
-- Table structure for table `foundation_day`
--

CREATE TABLE `foundation_day` (
  `attendance_no` int(10) NOT NULL,
  `rfid_no` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `student_no` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `organization` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_in` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_out` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `foundation_day`
--

INSERT INTO `foundation_day` (`attendance_no`, `rfid_no`, `student_no`, `name`, `organization`, `course`, `time_in`, `time_out`) VALUES
(1, '8BB4FC27', ' 1802456', 'Loel Jay De leon', 'Developmental Integrated Group Of Information Technology Students (DIGITS)', 'BSIT', '10:17:00:A', '10:21:23:A'),
(2, '9B06BA28', ' 1803425', 'Seaenah Olive Penachos', 'Senior Class Organization (SenCO)', 'BSTM', '10:17:20:A', '10:21:13:A'),
(3, 'BB6FFB27', ' 1800123', 'Miguel Gyro Madaoi', 'Developmental Integrated Group Of Information Technology Students (DIGITS)', 'BSIT', '10:17:28:A', '10:20:52:A'),
(4, 'EB64EF27', ' 1802431', 'Shamalca Marie Lopez', 'Tourism Circle', 'BSTM', '10:17:35:A', '10:20:43:A'),
(5, 'DBB08B25', ' 1806794', 'Sherene Rivilla', 'Technologist and Livelihood Educators Guild (TLE GUILD)', 'BTLED', '10:18:39:A', ''),
(6, '3B1FF927', ' 1804532', 'Aldwin Tano', 'BPED Movers Organization', 'BPED', '10:19:40:A', ''),
(7, 'BBEAF527', ' 1800679', 'Vanessa Mae Lucero', 'JSWAP LNU Chapter', 'BSSW', '10:19:46:A', '10:20:35:A'),
(8, 'DB3FFE27', ' 1806785', 'Claire Valen', 'Hoteliers & Restaurateurs', 'BSHM', '10:19:55:A', '10:20:13:A'),
(9, 'ABE8EE27', ' 1800717', 'Karl Dave Almeria', 'Developmental Integrated Group Of Information Technology Students (DIGITS)', 'BSIT', '10:23:29:A', '10:23:34:A'),
(10, 'FB2CF127', ' 1802257', 'Shane Astillero', 'Hoteliers & Restaurateurs', 'BSHM', '10:24:02:A', '10:24:07:A');

-- --------------------------------------------------------

--
-- Table structure for table `it_days`
--

CREATE TABLE `it_days` (
  `attendance_no` int(10) NOT NULL,
  `rfid_no` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `student_no` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `organization` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_in` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_out` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `it_days`
--

INSERT INTO `it_days` (`attendance_no`, `rfid_no`, `student_no`, `name`, `organization`, `course`, `time_in`, `time_out`) VALUES
(1, 'FB2CF127', ' 1802257', 'Shane Astillero', 'Hoteliers & Restaurateurs', 'BSHM', '10:29:33:A', '10:31:17:A'),
(2, 'ABE8EE27', ' 1800717', 'Karl Dave Almeria', 'Developmental Integrated Group Of Information Technology Students (DIGITS)', 'BSIT', '10:29:43:A', '10:31:10:A'),
(3, 'DB3FFE27', ' 1806785', 'Claire Valen', 'Hoteliers & Restaurateurs', 'BSHM', '10:29:49:A', '10:31:04:A'),
(4, '8BB4FC27', ' 1802456', 'Loel Jay De leon', 'Developmental Integrated Group Of Information Technology Students (DIGITS)', 'BSIT', '10:29:56:A', '10:30:58:A'),
(5, '9B06BA28', ' 1803425', 'Seaenah Olive Penachos', 'Senior Class Organization (SenCO)', 'BSTM', '10:30:02:A', '10:30:49:A'),
(6, 'BB6FFB27', ' 1800123', 'Miguel Gyro Madaoi', 'Developmental Integrated Group Of Information Technology Students (DIGITS)', 'BSIT', '10:30:08:A', '10:30:39:A'),
(7, 'EB64EF27', ' 1802431', 'Shamalca Marie Lopez', 'Tourism Circle', 'BSTM', '10:30:16:A', '10:30:18:A');

-- --------------------------------------------------------

--
-- Table structure for table `it_road_show`
--

CREATE TABLE `it_road_show` (
  `attendance_no` int(10) NOT NULL,
  `rfid_no` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `student_no` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `organization` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_in` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_out` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `it_road_show`
--

INSERT INTO `it_road_show` (`attendance_no`, `rfid_no`, `student_no`, `name`, `organization`, `course`, `time_in`, `time_out`) VALUES
(1, 'EBCFF627', ' 1801832', 'Ma Criselda Santillan', 'Association of Values Educators', 'BSED', '2:03:27:AM', ''),
(2, 'DBB08B25', ' 1806794', 'Sherene Rivilla', 'Technologist and Livelihood Educators Guild (TLE GUILD)', 'BTLED', '2:03:45:AM', ''),
(3, 'FB2CF127', ' 1802257', 'Shane Astillero', 'Hoteliers & Restaurateurs', 'BSHM', '2:04:06:AM', ''),
(4, 'BB3A8525', ' 1805674', 'Patrick Odtuhan', 'Developmental Integrated Group Of Information Technology Students (DIGITS)', 'BSIT', '2:04:15:AM', ''),
(5, '3B1FF927', ' 1804532', 'Aldwin Tano', 'BPED Movers Organization', 'BPED', '2:04:24:AM', ''),
(6, 'ABE8EE27', ' 1800717', 'Karl Dave Almeria', 'Developmental Integrated Group Of Information Technology Students (DIGITS)', 'BSIT', '10:15:34:A', ''),
(7, '3BD0EE27', ' 1800567', 'Eduard Canares', 'JSWAP LNU Chapter', 'BSSW', '10:15:42:A', ''),
(8, '8BB4FC27', ' 1802456', 'Loel Jay De leon', 'Developmental Integrated Group Of Information Technology Students (DIGITS)', 'BSIT', '10:16:16:A', '');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `stud_id` int(10) NOT NULL,
  `rfid_no` varchar(50) NOT NULL,
  `student_no` varchar(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `yrLevel` varchar(10) NOT NULL,
  `course` varchar(100) NOT NULL,
  `organization` varchar(100) NOT NULL,
  `section` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`stud_id`, `rfid_no`, `student_no`, `name`, `gender`, `yrLevel`, `course`, `organization`, `section`) VALUES
(63, '9A345A3C', ' 1800915', 'Santiago Pangan Jr', 'Male', '4th year', 'BSIT', 'Developmental Integrated Group Of Information Technology Students (DIGITS)', 'AI42'),
(64, 'EBCFF627', ' 1801832', 'Ma Criselda Santillan', 'Female', '4th year', 'BSED', 'Association of Values Educators', 'SV-42'),
(65, 'EB64EF27', ' 1802431', 'Shamalca Marie Lopez', 'Female', '4th year', 'BSTM', 'Tourism Circle', 'TM42'),
(66, '7B93F627', ' 1800742', 'Rodolfo Puyat III', 'Male', '4th year', 'BSIT', 'Developmental Integrated Group Of Information Technology Students (DIGITS)', 'AI41'),
(67, 'BB6FFB27', ' 1800123', 'Miguel Gyro Madaoi', 'Male', '4th year', 'BSIT', 'Developmental Integrated Group Of Information Technology Students (DIGITS)', 'AI43'),
(68, 'ABE8EE27', ' 1800717', 'Karl Dave Almeria', 'Male', '4th year', 'BSIT', 'Developmental Integrated Group Of Information Technology Students (DIGITS)', 'AI42'),
(69, '8BB4FC27', ' 1802456', 'Loel Jay De leon', 'Male', '4th year', 'BSIT', 'Developmental Integrated Group Of Information Technology Students (DIGITS)', 'AI42'),
(70, 'BB3A8525', ' 1805674', 'Patrick Odtuhan', 'Male', '4th year', 'BSIT', 'Developmental Integrated Group Of Information Technology Students (DIGITS)', 'AI41'),
(71, '8B34F227', ' 1803241', 'Uarymel Remitilla', 'Male', '4th year', 'BSIT', 'Developmental Integrated Group Of Information Technology Students (DIGITS)', 'AI43'),
(72, '8BB5F827', ' 1800326', 'Roshel Abaloyan', 'Male', '4th year', 'BSED', 'Science Questers Unlimited', 'SC42'),
(73, '3BD0EE27', ' 1800567', 'Eduard Canares', 'Male', '3rd year', 'BSSW', 'JSWAP LNU Chapter', 'SS42'),
(74, 'BBEAF527', ' 1800679', 'Vanessa Mae Lucero', 'Female', '2nd year', 'BSSW', 'JSWAP LNU Chapter', 'SS43'),
(75, 'DB3FFE27', ' 1806785', 'Claire Valen', 'Male', '3rd year', 'BSHM', 'Hoteliers & Restaurateurs', 'HM43'),
(76, 'FB2CF127', ' 1802257', 'Shane Astillero', 'Female', '2nd year', 'BSHM', 'Hoteliers & Restaurateurs', 'HM41'),
(77, '1B010128', ' 1800671', 'Alexa Raphael Sabuco', 'Female', '1st year', 'BECED', 'Early Childhood Educators', 'CD42'),
(78, '3B1FF927', ' 1804532', 'Aldwin Tano', 'Male', '3rd year', 'BPED', 'BPED Movers Organization', 'PE43'),
(79, 'DBB08B25', ' 1806794', 'Sherene Rivilla', 'Female', '1st year', 'BTLED', 'Technologist and Livelihood Educators Guild (TLE GUILD)', 'TL42'),
(80, '9B06BA28', ' 1803425', 'Seaenah Olive Penachos', 'Female', '3rd year', 'BSTM', 'Senior Class Organization (SenCO)', 'TM42'),
(81, '33B8D31A', ' 1809456', 'lester Vista', 'Male', '4th year', 'BSIT', 'Developmental Integrated Group Of Information Technology Students (DIGITS)', 'AI42'),
(82, '32423432r', ' 1803487', 'Justine Macalinao', 'Female', '3rd year', 'BACOMM', 'BACommUNITY', 'AB31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `4ps_beneficiaries`
--
ALTER TABLE `4ps_beneficiaries`
  ADD PRIMARY KEY (`attendance_no`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bday_party`
--
ALTER TABLE `bday_party`
  ADD PRIMARY KEY (`attendance_no`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_Id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `foundation_day`
--
ALTER TABLE `foundation_day`
  ADD PRIMARY KEY (`attendance_no`);

--
-- Indexes for table `it_days`
--
ALTER TABLE `it_days`
  ADD PRIMARY KEY (`attendance_no`);

--
-- Indexes for table `it_road_show`
--
ALTER TABLE `it_road_show`
  ADD PRIMARY KEY (`attendance_no`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`stud_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `4ps_beneficiaries`
--
ALTER TABLE `4ps_beneficiaries`
  MODIFY `attendance_no` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `bday_party`
--
ALTER TABLE `bday_party`
  MODIFY `attendance_no` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `event_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT for table `foundation_day`
--
ALTER TABLE `foundation_day`
  MODIFY `attendance_no` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `it_days`
--
ALTER TABLE `it_days`
  MODIFY `attendance_no` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `it_road_show`
--
ALTER TABLE `it_road_show`
  MODIFY `attendance_no` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `stud_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
