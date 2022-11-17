-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 29, 2022 at 07:41 AM
-- Server version: 5.7.32
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
(1, '', '', 'adminclara@gmail.com', '12345'),
(2, 'Anthony', 'Farnacio', 'adminanthony@pu.ocls.com', '12345');

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
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
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
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `announcement` longtext,
  `s_code` int(11) DEFAULT NULL,
  `subject_code` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `year_lvl_and_block` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `teacher_id`, `announcement`, `s_code`, `subject_code`, `description`, `year_lvl_and_block`, `status`, `created_at`) VALUES
(3, 2, 'There will be no classes today.', NULL, 'ITE 289', 'Introduction to Computing', '1st Year - BLK 2', 1, '2022-02-16 21:29:30'),
(4, 2, 'There will be no classes today.', NULL, 'ITE 288', 'Computer Programming 1', '1st Year - BLK 3', 1, '2022-02-16 21:29:48'),
(5, 3, 'There is no classes today', NULL, 'ITE 048', 'Human Computer Interaction', '2nd Year - BLK 1', 1, '2022-02-17 10:45:06'),
(13, 3, 'test announcement', NULL, 'ITE 186', 'Computer Programming 2', '1st Year - BLK 4', 1, '2022-03-25 12:12:15'),
(14, 3, 'test announcement', NULL, 'ITE 291', 'Human Computer Interaction', '1st Year - BLK 4', 1, '2022-03-25 12:40:06'),
(15, 3, 'Test announcement done with cron', NULL, 'ITE 289', 'Computer Programming 1', '1st Year - BLK 3', 1, '2022-03-25 12:51:00'),
(16, 3, 'Test announcement done with cron', NULL, 'ITE 186', 'Computer Programming 2', '1st Year - BLK 3', 1, '2022-03-25 12:51:00'),
(17, 3, 'Test announcement done with cron', NULL, 'ITE 291', 'Human Computer Interaction', '1st Year - BLK 3', 1, '2022-03-25 12:51:00'),
(18, 3, 'test', 4, 'ITE 289', 'Computer Programming 1', '1st Year - BLK 4', 1, '2022-03-25 00:20:00'),
(19, 3, 'test', 6, 'ITE 186', 'Computer Programming 2', '1st Year - BLK 4', 1, '2022-03-25 00:20:00'),
(20, 3, 'test', 7, 'ITE 291', 'Human Computer Interaction', '1st Year - BLK 4', 1, '2022-03-25 00:20:00'),
(21, 49, 'Test announcement', 4, 'ITE 289', 'Computer Programming 1', '1st Year - BLK 1', 1, '2022-04-01 12:18:00'),
(22, 49, 'Test announcement 2', 4, 'ITE 289', 'Computer Programming 1', '3rd Year - BLK 1', 1, '2022-04-01 12:20:00'),
(23, 49, 'Test announcement for multiple classes', 4, 'ITE 289', 'Computer Programming 1', '1st Year - BLK 1', 1, '2022-04-01 13:14:00'),
(24, 49, 'Test announcement for multiple classes', 5, 'ITE 288', 'Introduction to Computing', '1st Year - BLK 1', 1, '2022-04-01 13:14:00'),
(25, 49, 'Test announcement for multiple classes', 7, 'ITE 291', 'Human Computer Interaction', '1st Year - BLK 1', 1, '2022-04-01 13:14:00'),
(26, 49, 'test', 7, 'ITE 291', 'Human Computer Interaction', '1st Year - BLK 1', 1, '2022-04-02 00:00:00'),
(27, 49, 'test for divy', 4, 'ITE 289', 'Computer Programming 1', '1st Year - BLK 1', 1, '2022-04-02 00:00:00'),
(28, 49, 'test on 3rd april', 4, 'ITE 289', 'Computer Programming 1', '1st Year - BLK 1', 1, '2022-04-03 09:34:30');

-- --------------------------------------------------------

--
-- Table structure for table `chat_room`
--

CREATE TABLE `chat_room` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `student_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `chat_room`
--

INSERT INTO `chat_room` (`id`, `name`, `student_id`, `created_at`) VALUES
(5, 'Test Class group', 12, '2022-04-01 18:16:06');

-- --------------------------------------------------------

--
-- Table structure for table `chat_room_messages`
--

CREATE TABLE `chat_room_messages` (
  `id` int(11) NOT NULL,
  `chat_room_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `message` longtext NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `chat_room_messages`
--

INSERT INTO `chat_room_messages` (`id`, `chat_room_id`, `student_id`, `message`, `created_at`) VALUES
(24, 5, 12, 'Hi', '2022-04-01 18:16:16');

-- --------------------------------------------------------

--
-- Table structure for table `chat_room_students`
--

CREATE TABLE `chat_room_students` (
  `id` int(11) NOT NULL,
  `chat_room_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `chat_room_students`
--

INSERT INTO `chat_room_students` (`id`, `chat_room_id`, `student_id`, `created_at`) VALUES
(22, 5, 12, '2022-04-01 18:16:11');

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
  `nationality` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `student_id`, `firstname`, `lastname`, `middlename`, `birth_date`, `nationality`, `gender`, `phone`, `email`, `password`) VALUES
(11, '03-1920-0001123', 'THALIA', 'HARISSON', 'R', '1190-12-12', 'INDIAN', 'female', '1234567890', 'th.harisson@pu.ocls.com', '03-1920-0001123'),
(12, NULL, 'Divyang', 'Chauhan', NULL, NULL, NULL, NULL, NULL, 'divyangchauhan.cmpica@gmail.com', 'asd123'),
(37, '', '', '', '', '1899-12-30', '', '', '', '', ''),
(38, '03-1920-00010', 'Romel', 'Baltazar', 'Ramirez', '2001-05-09', 'Filipino', 'Male', '09835559177', 'rom.baltazar@gmail.com', '03-1920-00010'),
(39, '03-1920-64597', 'Stacy Sue', 'Bautista', 'David', '2000-01-21', 'Filipino', 'Female', '09195556786', 'sta.bautista@gmail.com', '03-1920-64597'),
(40, '03-1920-89216', 'Jayme', 'Castro', 'Ferrer', '2001-08-17', 'Filipino', 'Male', '09928258376', 'jay.castro@gmail.com', '03-1920-89216'),
(41, '03-1920-00023', 'Benjie', 'Esteban', 'Dela Cruz', '1998-11-21', 'Filipino', 'Male', '093355568259', 'ben.esteban@gmail.com', '03-1920-00023'),
(43, '03-1920-21022', 'Diwa', 'Galvez', 'Tolentino', '2000-06-28', 'Filipino', 'Female', '093355523494', 'diw.galvez@gmail.com', '03-1920-21022'),
(44, '03-1920-93425', 'Chrystal', 'Gomez', 'Pascual', '1900-01-01', 'Filipino', 'Female', '09632145101', 'chr.gomez@gmail.com', '03-1920-93425'),
(45, '03-1920-23648', 'Patrick', 'Lopez', 'Velasco', '1900-01-06', 'Filipino', 'Male', '09335557267', 'pat.lopez@gmail.com', '03-1920-23648'),
(46, '03-1920-53481', 'Dennis', 'Mendel', 'Gutierrez', '1900-01-11', 'Filipino', 'Male', '09225552301', 'den.mendel@gmail.com', '03-1920-53481'),
(47, '03-1920-78561', 'Thea Marianne', 'Mendoza', 'Salazar', '1999-12-07', 'Filipino', 'Female', '09325550355', 'the.mendoza@gmail.com', '03-1920-78561'),
(48, '03-1920-02323', 'Tan', 'Miranda', 'Aguilar', '1900-01-08', 'Filipino', 'Male', '09195557108', 'all.miranda@gmail.com', '03-1920-02323'),
(49, '03-1920-09994', 'Rutchell', 'Munoz', 'Tan', '1900-01-06', 'Filipino', 'Female', '09325551750', 'rut.munoz@gmail.com', '03-1920-09994'),
(50, '03-1920-18276', 'Princess', 'Nicolas', 'Valdez', '1900-01-03', 'Filipino', 'Female', '09215550957', 'pri.nicolas@gmail.com', '03-1920-18276'),
(51, '03-1920-61028', 'Efren', 'Pangilinan', 'Navarro', '2000-01-20', 'Filipino', 'Male', '09195552398', 'efr.pangilinan@gmail.com', '03-1920-61028'),
(52, '03-1920-19576', 'Paula', 'Reyes', 'Javier', '1900-01-10', 'Filipino', 'Female', '09235554583', 'pau.reyes@gmail.com', '03-1920-19576'),
(53, '03-1920-61297', 'Nicke Elierly', 'Sanchez', 'Lim', '1900-01-11', 'Filipino', 'Female', '09527618788', 'nic.sanchez@gmail.com', '03-1920-61297'),
(54, '03-1920-17396', 'Aubree Shenna', 'Santos', 'Corpuz', '1900-01-09', 'Filipino', 'Female', '09085553019', 'aub.santos@gmail.com', '03-1920-17396'),
(55, '03-1920-14836', 'Joriz', 'Suarez', 'Mercado', '1900-01-08', 'Filipino', 'Male', '09195551476', 'jor.suarez@gmail.com', '03-1920-14836'),
(56, '03-1920-29143', 'Carlie Teddy', 'Torres', 'Manalo', '1900-01-08', 'Filipino', 'Male', '09521103412', 'car.torres@gmail.com', '03-1920-29143'),
(57, '03-1920-42835', 'Stella Erin', 'Francisco', 'Dizon', '1999-11-03', 'Filipino', 'Female', '09533952209', 'ste.francisco@gmail.com', '03-1920-42835'),
(60, '03-1920-00011', 'Divyang', 'R', 'Chauhan', '1990-11-28', 'Indian', NULL, '8306270820', 'divyangchauhan.cmpica@gmail.com', '03-1920-00011'),
(61, '03-1920-00012', 'Abc', 'R', 'PQR', '2000-12-12', 'Indian', NULL, '8306270820', 'abc@gmail.com', '03-1920-00012'),
(62, '03-1920-00013', 'ASDASDSAD', 'SAD', 'ADAS', '1992-11-28', 'INDIAN', 'MALE', '8306270820', 'ABC123@GMAIL.COM', '03-1920-00013');

-- --------------------------------------------------------

--
-- Table structure for table `student_answer`
--

CREATE TABLE `student_answer` (
  `id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `answer` longtext NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student_answer`
--

INSERT INTO `student_answer` (`id`, `question_id`, `student_id`, `answer`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 38, 'Hey brother Laravel is best framework now a days in market.', '2022-04-15 17:03:59', '2022-04-15 17:03:59', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `student_questions`
--

CREATE TABLE `student_questions` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `question` text NOT NULL,
  `tag` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student_questions`
--

INSERT INTO `student_questions` (`id`, `student_id`, `question`, `tag`, `status`, `created_date`, `updated_at`, `deleted_at`) VALUES
(1, 12, 'Which is best framework in php now a days in a market?', 'php,framework', 0, '2022-04-15 17:02:21', '2022-04-15 17:02:21', NULL),
(3, 12, 'What is latest version of php now?', 'php,version', 1, '2022-04-15 18:11:28', '2022-04-15 18:11:28', NULL),
(4, 12, 'Hello guys use below link to check google\r\n\r\nhttp://google.com', 'google', 1, '2022-04-29 12:10:23', '2022-04-29 12:10:23', NULL),
(5, 12, 'you can learn php from this website https://www.php.net/', 'php,learn', 1, '2022-04-29 12:33:51', '2022-04-29 12:33:51', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `sub_year` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `code`, `sub_year`, `name`, `created_at`) VALUES
(4, 'ITE 289', NULL, 'Computer Programming 1', '2022-03-21 18:39:26'),
(5, 'ITE 288', NULL, 'Introduction to Computing', '2022-03-21 18:39:26'),
(6, 'ITE 186', NULL, 'Computer Programming 2', '2022-03-21 18:39:26'),
(7, 'ITE 291', NULL, 'Human Computer Interaction', '2022-03-21 18:39:26'),
(8, 'ITE 031', NULL, 'Data Structures and Algorithms', '2022-03-21 18:39:26'),
(9, 'ITE 048', NULL, 'Discrete Structures', '2022-03-21 18:39:26'),
(10, 'ITE 299', NULL, 'Ethics for IT (Including Social and Professional Issues)', '2022-03-21 18:39:26'),
(11, 'ITE 292', NULL, 'Networking 1', '2022-03-21 18:39:26'),
(12, 'ITE 300', NULL, 'Object-Oriented Programming', '2022-03-21 18:39:26'),
(13, 'ITE 232', NULL, 'Advanced Web Development 1', '2022-03-21 18:39:26'),
(14, 'ITE 302', NULL, 'Information Assurance and Security 1', '2022-03-21 18:39:26'),
(15, 'ITE 298', NULL, 'Information Management (Including Fundamentals of Database Systems)', '2022-03-21 18:39:26'),
(16, 'ITE 304', NULL, 'Networking 2', '2022-03-21 18:39:26'),
(17, 'ITE 303', NULL, 'Systems Integration and Architecture 1', '2022-03-21 18:39:26'),
(18, 'ITE 115', NULL, 'Advanced Programming (OOP)', '2022-03-21 18:39:26'),
(19, 'SSP 005', NULL, 'Student Success Program 1', '2022-03-21 18:39:26'),
(20, 'SSP 006', NULL, 'Student Success Program 2', '2022-03-21 18:39:26'),
(21, 'ITE 314', NULL, 'Advanced Database Systems', '2022-03-21 18:39:26'),
(22, 'ITE 233', NULL, 'Advanced Web Development 2', '2022-03-21 18:39:26'),
(23, 'ITE 301', NULL, 'Application Development and Emerging Technologies', '2022-03-21 18:39:26'),
(24, 'ITE 309', NULL, 'Capstone Project and Research 1', '2022-03-21 18:39:26'),
(25, 'ITE 306', NULL, 'Integrative Programming and Technologies', '2022-03-21 18:39:26'),
(26, 'ITE 307', NULL, 'Quantitative Methods (including Modeling and Simulation)', '2022-03-21 18:39:26'),
(27, 'ITE 308', NULL, 'Web System and Technologies', '2022-03-21 18:39:26'),
(28, 'ITE 310', NULL, 'Capstone Project and Research 2', '2022-03-21 18:39:26'),
(29, 'ITE 305', NULL, 'Information Assurance and Security 2', '2022-03-21 18:39:26'),
(30, 'ITE 333', NULL, 'Intelligent Systems', '2022-03-21 18:39:26'),
(31, 'ITE 335', NULL, 'Platform Technologies', '2022-03-21 18:39:26'),
(32, 'ITE 293', NULL, 'Systems Administration and Maintenance', '2022-03-21 18:39:26'),
(33, 'ITE 336', NULL, 'Freehand and Digital Drawing', '2022-03-21 18:39:26'),
(34, 'ITE 150', NULL, 'Free Elective 2 (3D Animation)', '2022-03-21 18:39:26'),
(35, 'ITE 214', NULL, 'Clean-Up and In-Between Drawing', '2022-03-21 18:39:26'),
(36, 'SSP 007', NULL, 'Student Success Program 3', '2022-03-21 18:39:26'),
(37, 'SSP 008', NULL, 'Student Success Program 4', '2022-03-21 18:39:26'),
(38, 'ITE 322', NULL, 'Managing IT Resouces', '2022-03-21 18:39:26'),
(39, 'ITE 351', NULL, 'New Venture Creation (4 units)', '2022-03-21 18:39:26'),
(40, 'ITE 311', NULL, 'IT Practicum', '2022-03-21 18:39:26'),
(41, 'SSP 009', NULL, 'Student Success Program 5', '2022-03-21 18:39:26'),
(42, '', NULL, '', '2022-03-23 15:42:50'),
(43, '', NULL, 'Chat Room 1', '2022-03-26 15:03:17');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(11) NOT NULL,
  `teacher_id` varchar(255) DEFAULT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `middlename` varchar(255) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `nationality` varchar(255) DEFAULT NULL,
  `gender` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `teacher_id`, `firstname`, `lastname`, `middlename`, `birth_date`, `nationality`, `gender`, `phone`, `email`, `password`) VALUES
(38, '03-1920-03451', 'CHESTER', 'BAUTISTA', 'A', '1899-12-30', 'INDIAN', 'male', '09252345678', 'CHE.BAUTISTA@GMAIL.COM', '03-1920-03451'),
(39, '03-1920-23331', 'NERIZA', 'BUSTILLO', 'VILLACORTA', '1899-12-30', 'FILIPINO', 'FEMALE', '09252233445', 'NER.BUSTILLO@GMAIL.COM', '03-1920-23331'),
(40, '03-1920-99023', 'VERONICA', 'CANLAS', 'LAGERA', '1899-12-30', 'FILIPINO', 'FEMALE', '09258632134', 'VER.CANLAS@GMAIL.COM', '03-1920-99023'),
(41, '03-1718-02194', 'MA. GRACE', 'CARPIZO', '', '1899-12-30', 'FILIPINO', 'FEMALE', '09263523142', 'GRA.CARPIZO@GMAIL.COM', '03-1718-02194'),
(42, '03-1718-92143', 'DESIREE', 'CENDANA', 'IDIO', '1899-12-30', 'FILIPINO', 'FEMALE', '09264546762', 'DES.CENDANA@GMAIL.COM', '03-1718-92143'),
(43, '03-1819-00321', 'COMADRE', 'ENGILBERT ', 'CERALDE', '1899-12-30', 'FILIPINO', 'MALE', '09262611732', 'ENG.COMDARE@GMAIL.COM', '03-1819-00321'),
(44, '03-1718-16657', 'FRANCIS', 'GONZALES', 'MAMARIL', '1899-12-30', 'FILIPINO', 'MALE', '09256621233', 'FRA.GONZALES@GMAIL.COM', '03-1718-16657'),
(45, '03-1920-32042', 'ARIS', 'LIWANAG', '', '1899-12-30', 'FILIPINO', 'MALE', '09457263662', 'ARI.LIWANAG@GMAIL.COM', '03-1920-32042'),
(46, '03-1920-55890', 'ROLLY', 'MANIQUEZ', 'GARAY', '1899-12-30', 'FILIPINO', 'MALE', '09454728154', 'ROL.MANIQUEZ@GMAIL.COM', '03-1920-55890'),
(48, '03-1920-03299', 'ANGELICA', 'VIDAL', 'FERNANDEZ', '1899-12-30', 'FILIPINO', 'FEMALE', '09452281090', 'ang.vidal@gmail.com', '03-1920-03299'),
(49, '03-1920-1234', 'MISS', 'JAMES', 'KERRY', '1989-11-28', 'INDIAN', 'female', '0912345678', 'kery@gmail.com', '03-1920-1234'),
(50, '01-2300-123', 'RIDHDHI', 'CHAUHAN', 'D', '1991-10-09', 'INDIAN', 'female', '8306270820', 'ridhi@gmail.com', '01-2300-123'),
(51, '03-1920-0345123', 'KRISHNA', 'CHAUHAN', 'C', '1990-01-12', 'INDIAN', 'female', '1234567890', 'krishna@gmail.com', '03-1920-0345123');

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
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
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
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `admin_forstudent`
--
ALTER TABLE `admin_forstudent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `chat_room`
--
ALTER TABLE `chat_room`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `chat_room_messages`
--
ALTER TABLE `chat_room_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `chat_room_students`
--
ALTER TABLE `chat_room_students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `student_answer`
--
ALTER TABLE `student_answer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `student_questions`
--
ALTER TABLE `student_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
