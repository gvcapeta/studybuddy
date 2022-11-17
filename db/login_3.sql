-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 01, 2022 at 02:21 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `login_3`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

CREATE TABLE `activity` (
  `ts` int(50) NOT NULL,
  `id` int(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `activity` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `activity`
--

INSERT INTO `activity` (`ts`, `id`, `email`, `activity`) VALUES
(1655173199, 3, 'admin', 'admin has logged in'),
(1655173680, 3, 'admin', 'admin added a student record'),
(1655173829, 3, 'admin', 'admin deleted a student record'),
(1655249059, 3, 'admin', 'admin has logged in'),
(1655249096, 3, 'admin', 'admin has logged in'),
(1655249109, 3, 'admin', 'admin has logged in'),
(1655249119, 3, 'admin', 'admin has logged in'),
(1656463380, 3, 'admin', 'admin has logged in'),
(1656463420, 3, 'admin', 'admin added a student record'),
(1656576870, 3, 'admin', 'admin has logged in'),
(1656576929, 3, 'admin', 'admin has logged in'),
(1656577144, 3, 'admin', 'admin has logged in'),
(1656577206, 3, 'admin', 'admin added a student record'),
(1656677769, 3, 'admin', 'admin has logged in');

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `firstname`, `lastname`, `email`, `password`) VALUES
(3, 'admin', 'admin', 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `admin_forstudent`
--

CREATE TABLE `admin_forstudent` (
  `id` int(11) NOT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `slast` varchar(50) DEFAULT NULL,
  `sfirst` varchar(50) DEFAULT NULL,
  `subject_code` varchar(10) NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  `Year_lvl_and_block` varchar(20) NOT NULL,
  `teacher` varchar(100) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_forstudent`
--

INSERT INTO `admin_forstudent` (`id`, `teacher_id`, `student_id`, `slast`, `sfirst`, `subject_code`, `description`, `Year_lvl_and_block`, `teacher`, `created_at`) VALUES
(44, 49, 11, '', '', '4', '', '1st Year - BLK 1', 'MISS JAMES', '2022-04-02 12:46:36'),
(45, 49, 12, '', '', '4', '', '1st Year - BLK 1', 'MISS JAMES', '2022-04-02 12:46:36'),
(46, 49, 38, '', '', '4', '', '1st Year - BLK 1', 'MISS JAMES', '2022-04-02 12:46:36'),
(47, 49, 39, '', '', '4', '', '1st Year - BLK 1', 'MISS JAMES', '2022-04-02 12:46:36'),
(48, 49, 40, '', '', '4', '', '1st Year - BLK 1', 'MISS JAMES', '2022-04-02 12:46:36'),
(49, 49, 41, '', '', '4', '', '1st Year - BLK 1', 'MISS JAMES', '2022-04-02 12:46:36'),
(50, 49, 43, '', '', '5', '', '1st Year - BLK 1', 'MISS JAMES', '2022-04-02 12:46:36');

-- --------------------------------------------------------

--
-- Table structure for table `chat_room`
--

CREATE TABLE `chat_room` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `student_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `chat_room_messages`
--

CREATE TABLE `chat_room_messages` (
  `id` int(11) NOT NULL,
  `chat_room_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `message` longtext NOT NULL,
  `message_type` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `chat_room_students`
--

CREATE TABLE `chat_room_students` (
  `id` int(11) NOT NULL,
  `chat_room_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `collab_files`
--

CREATE TABLE `collab_files` (
  `fileID` int(11) NOT NULL,
  `groupID` int(11) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `uploadByID` varchar(11) NOT NULL,
  `uploadBy` varchar(255) NOT NULL,
  `uploadAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `collab_group`
--

CREATE TABLE `collab_group` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `createdBy` int(11) NOT NULL,
  `collaborators` varchar(255) DEFAULT NULL,
  `requests` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `student_id` varchar(255) DEFAULT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `middlename` varchar(255) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `yearlvl` varchar(11) NOT NULL,
  `nationality` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `student_id`, `firstname`, `lastname`, `middlename`, `birth_date`, `yearlvl`, `nationality`, `gender`, `phone`, `email`, `password`) VALUES
(39, '03-1920-64597', 'Stacy Sue', 'Bautista', 'David', '2000-01-21', '', 'Filipino', 'Female', '09195556786', 'sta.bautista@gmail.com', '03-1920-64597'),
(40, '03-1920-89216', 'Jayme', 'Castro', 'Ferrer', '2001-08-17', '', 'Filipino', 'Male', '09928258376', 'jay.castro@gmail.com', '03-1920-89216'),
(41, '03-1920-00023', 'Benjie', 'Esteban', 'Dela Cruz', '1998-11-21', '', 'Filipino', 'Male', '093355568259', 'ben.esteban@gmail.com', '03-1920-00023'),
(43, '03-1920-21022', 'Diwa', 'Galvez', 'Tolentino', '2000-06-28', '', 'Filipino', 'Female', '093355523494', 'diw.galvez@gmail.com', '03-1920-21022'),
(44, '03-1920-93425', 'Chrystal', 'Gomez', 'Pascual', '1900-01-01', '', 'Filipino', 'Female', '09632145101', 'chr.gomez@gmail.com', '03-1920-93425'),
(45, '03-1920-23648', 'Patrick', 'Lopez', 'Velasco', '1900-01-06', '', 'Filipino', 'Male', '09335557267', 'pat.lopez@gmail.com', '03-1920-23648'),
(46, '03-1920-53481', 'Dennis', 'Mendel', 'Gutierrez', '1900-01-11', '', 'Filipino', 'Male', '09225552301', 'den.mendel@gmail.com', '03-1920-53481'),
(47, '03-1920-78561', 'Thea Marianne', 'Mendoza', 'Salazar', '1999-12-07', '', 'Filipino', 'Female', '09325550355', 'the.mendoza@gmail.com', '03-1920-78561'),
(48, '03-1920-02323', 'Tan', 'Miranda', 'Aguilar', '1900-01-08', '', 'Filipino', 'Male', '09195557108', 'all.miranda@gmail.com', '03-1920-02323'),
(49, '03-1920-09994', 'Rutchell', 'Munoz', 'Tan', '1900-01-06', '', 'Filipino', 'Female', '09325551750', 'rut.munoz@gmail.com', '03-1920-09994'),
(50, '03-1920-18276', 'Princess', 'Nicolas', 'Valdez', '1900-01-03', '', 'Filipino', 'Female', '09215550957', 'pri.nicolas@gmail.com', '03-1920-18276'),
(51, '03-1920-61028', 'Efren', 'Pangilinan', 'Navarro', '2000-01-20', '', 'Filipino', 'Male', '09195552398', 'efr.pangilinan@gmail.com', '03-1920-61028'),
(52, '03-1920-19576', 'Paula', 'Reyes', 'Javier', '1900-01-10', '', 'Filipino', 'Female', '09235554583', 'pau.reyes@gmail.com', '03-1920-19576'),
(53, '03-1920-61297', 'Nicke Elierly', 'Sanchez', 'Lim', '1900-01-11', '', 'Filipino', 'Female', '09527618788', 'nic.sanchez@gmail.com', '03-1920-61297'),
(54, '03-1920-17396', 'Aubree Shenna', 'Santos', 'Corpuz', '1900-01-09', '', 'Filipino', 'Female', '09085553019', 'aub.santos@gmail.com', '03-1920-17396'),
(55, '03-1920-14836', 'Joriz', 'Suarez', 'Mercado', '1900-01-08', '', 'Filipino', 'Male', '09195551476', 'jor.suarez@gmail.com', '03-1920-14836'),
(56, '03-1920-29143', 'Carlie Teddy', 'Torres', 'Manalo', '1900-01-08', '', 'Filipino', 'Male', '09521103412', 'car.torres@gmail.com', '03-1920-29143'),
(57, '03-1920-42835', 'Stella Erin', 'Francisco', 'Dizon', '1999-11-03', '', 'Filipino', 'Female', '09533952209', 'ste.francisco@gmail.com', '03-1920-42835'),
(60, '03-1920-00011', 'Divyang', 'R', 'Chauhan', '1990-11-28', '', 'Indian', NULL, '8306270820', 'divyangchauhan.cmpica@gmail.com', '03-1920-00011'),
(61, '03-1920-00012', 'Abc', 'R', 'PQR', '2000-12-12', '', 'Indian', NULL, '8306270820', 'abc@gmail.com', '03-1920-00012'),
(62, '03-1920-00013', 'ASDASDSAD', 'SAD', 'ADAS', '1992-11-28', '', 'INDIAN', 'MALE', '8306270820', 'ABC123@GMAIL.COM', '03-1920-00013'),
(63, '12-1212-1212', 'ABC', 'ASDFG', 'QWERTY', '2000-12-12', '3', 'FILIPINO', 'MALE', '1234567890', 'qwerty@gmail.com', '12-1212-1212'),
(64, '03-1718-00187', 'AL EVAN', 'CACHO', 'CASTILLO', '2001-08-04', '4', 'FILIPINO', 'MALE', '09065446860', 'alca.castillo.up@phinmaed.com', '03-1718-00187'),
(65, '03-1920-12345', 'JOSHUA', 'BAUTISTA', 'AFICIAL', '2000-01-01', '1', 'FILIPINO', 'MALE', '09123456789', 'joshuaficial@gmail.com', '03-1920-12345');

-- --------------------------------------------------------

--
-- Table structure for table `student_answer`
--

CREATE TABLE `student_answer` (
  `id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `answer` longtext NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `student_questions`
--

CREATE TABLE `student_questions` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `question` text NOT NULL,
  `tag` text NOT NULL,
  `image` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL,
  `isAnonymous` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_forstudent`
--
ALTER TABLE `admin_forstudent`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat_room`
--
ALTER TABLE `chat_room`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat_room_messages`
--
ALTER TABLE `chat_room_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat_room_students`
--
ALTER TABLE `chat_room_students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `collab_files`
--
ALTER TABLE `collab_files`
  ADD PRIMARY KEY (`fileID`);

--
-- Indexes for table `collab_group`
--
ALTER TABLE `collab_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_answer`
--
ALTER TABLE `student_answer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_questions`
--
ALTER TABLE `student_questions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `admin_forstudent`
--
ALTER TABLE `admin_forstudent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `chat_room`
--
ALTER TABLE `chat_room`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `chat_room_messages`
--
ALTER TABLE `chat_room_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `chat_room_students`
--
ALTER TABLE `chat_room_students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `collab_files`
--
ALTER TABLE `collab_files`
  MODIFY `fileID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `collab_group`
--
ALTER TABLE `collab_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `student_answer`
--
ALTER TABLE `student_answer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `student_questions`
--
ALTER TABLE `student_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
