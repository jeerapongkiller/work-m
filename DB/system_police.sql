-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 15, 2020 at 04:09 PM
-- Server version: 5.7.15-log
-- PHP Version: 5.6.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `system_police`
--

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `permission` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `position` int(11) NOT NULL,
  `titlename` int(11) NOT NULL,
  `firstname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `photo` text COLLATE utf8_unicode_ci NOT NULL,
  `last_edit` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `status`, `permission`, `username`, `password`, `position`, `titlename`, `firstname`, `lastname`, `phone`, `address`, `photo`, `last_edit`) VALUES
(1, 1, 'Administrator', 'admin', '1234', 11, 1, 'John', 'Wick', '081-5462205', '', '1605187547_1.jpg', '2020-11-15 14:03:09'),
(3, 1, 'Member', 'Test3', '1234', 1, 1, 'วันศุกร์', 'หยุดงาน', '0945125152', 'test', '1605445280_1.jpg', '2020-11-15 14:03:13'),
(5, 1, 'Member', 'Test', '1234', 3, 1, 'มีดี', 'มากมาย', '0959563326', '', '1605448576_1.jpg', '2020-11-15 15:59:58');

-- --------------------------------------------------------

--
-- Table structure for table `material`
--

CREATE TABLE `material` (
  `id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `plaint` int(11) NOT NULL,
  `material_type` int(11) NOT NULL,
  `material_num` int(11) NOT NULL,
  `material_detail` text COLLATE utf8_unicode_ci NOT NULL,
  `photo1` text COLLATE utf8_unicode_ci NOT NULL,
  `photo2` text COLLATE utf8_unicode_ci NOT NULL,
  `photo3` text COLLATE utf8_unicode_ci NOT NULL,
  `last_edit` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `material`
--

INSERT INTO `material` (`id`, `status`, `plaint`, `material_type`, `material_num`, `material_detail`, `photo1`, `photo2`, `photo3`, `last_edit`) VALUES
(1, 1, 1, 1, 50000, 'การมีไว้ในครอบครอง เสพ และจำหน่ายสารเสพติดที่กฎหมายกำหนดห้ามไว้ เป็นความผิดตามกฎหมายไทย โดยความผิดดังกล่าวถือเป็นความผิดตามกฎหมายอาญาและจะเป็นคดีให้', '1605363583_1.jpg', '1605363583_2.jpg', '1605363583_3.jpg', '2020-11-14 14:19:43'),
(2, 1, 1, 2, 1, '', '1605363798_1.jpg', '1605363798_2.jpg', '1605363798_3.jpg', '2020-11-14 14:23:18');

-- --------------------------------------------------------

--
-- Table structure for table `material_type`
--

CREATE TABLE `material_type` (
  `id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `unit` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `detail` text COLLATE utf8_unicode_ci NOT NULL,
  `photo` text COLLATE utf8_unicode_ci NOT NULL,
  `last_edit` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `material_type`
--

INSERT INTO `material_type` (`id`, `status`, `name`, `unit`, `detail`, `photo`, `last_edit`) VALUES
(1, 1, 'ยาบ้า', 'เม็ด', 'ยาบ้า มีลักษณะเป็นยาเม็ดกลมแบนขนาดเล็ก เส้นผ่าศูนย์กลางประมาณ 6-8 มิลลิเมตร ความหนาประมาณ 3 มิลลิเมตร น้ำหนักเม็ดยาประมาณ 80-100 มิลลิกรัม มีสีต่างๆ กัน เช่น สีแดง สีส้ม สีน้ำตาล สีม่วง สีชมพู สีเทา สีเหลือง และสีเขียว เป็นต้น มีเครื่องหมายการค้า เป็นสัญลักษณ์หลายแบบ เช่น รูปหัวม้าและอักษร LONDON', '1605324155_1.jpg', '2020-11-14 03:22:59'),
(2, 1, 'ปืน 11 มม', 'กระบอก', '', '1605324493_1.jpg', '2020-11-14 03:28:13');

-- --------------------------------------------------------

--
-- Table structure for table `offender`
--

CREATE TABLE `offender` (
  `id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `titlename` int(11) NOT NULL,
  `id_card` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `sex` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `age` int(11) NOT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `place` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `date_offen` date NOT NULL,
  `time_offen` time NOT NULL,
  `photo1` text COLLATE utf8_unicode_ci NOT NULL,
  `photo2` text COLLATE utf8_unicode_ci NOT NULL,
  `photo3` text COLLATE utf8_unicode_ci NOT NULL,
  `last_edit` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `offender`
--

INSERT INTO `offender` (`id`, `status`, `titlename`, `id_card`, `firstname`, `lastname`, `sex`, `age`, `phone`, `address`, `place`, `date_offen`, `time_offen`, `photo1`, `photo2`, `photo3`, `last_edit`) VALUES
(1, 1, 1, '145216582210', 'สำนึก', 'คิดดี', 'ชาย', 23, '0893562256', '6/4 ม.1', '', '0000-00-00', '00:00:00', '1605102178_1.jpg', '1605102323_2.jpg', '1605102178_3.jpg', '2020-11-11 13:45:23'),
(2, 1, 2, '152063320152', 'จิตมี', 'ดีใจ', 'หญิง', 32, '0856251162', '88/7', '', '0000-00-00', '00:00:00', '1605102354_1.jpg', '1605102354_2.jpg', '1605102354_3.jpg', '2020-11-11 13:45:54');

-- --------------------------------------------------------

--
-- Table structure for table `plaint`
--

CREATE TABLE `plaint` (
  `id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `offender` int(11) NOT NULL,
  `plaint_type` int(11) NOT NULL,
  `plaint_date` date NOT NULL,
  `plaint_time` time NOT NULL,
  `plaint_address` text COLLATE utf8_unicode_ci NOT NULL,
  `last_edit` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `plaint`
--

INSERT INTO `plaint` (`id`, `status`, `offender`, `plaint_type`, `plaint_date`, `plaint_time`, `plaint_address`, `last_edit`) VALUES
(1, 1, 1, 1, '2020-11-11', '01:30:00', 'หน้าโรงเรียน', '2020-11-11 13:37:07'),
(2, 1, 1, 6, '2020-11-11', '00:00:00', 'ในซอย', '2020-11-12 13:19:28');

-- --------------------------------------------------------

--
-- Table structure for table `plaint_type`
--

CREATE TABLE `plaint_type` (
  `id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `detail` text COLLATE utf8_unicode_ci NOT NULL,
  `last_edit` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `plaint_type`
--

INSERT INTO `plaint_type` (`id`, `status`, `name`, `detail`, `last_edit`) VALUES
(1, 1, 'ค้ายา', '', '2020-10-12 08:43:22'),
(2, 1, 'ลักทรัพย์', '', '2020-10-12 08:43:56'),
(3, 1, 'ทำร้ายร่างกาย', '', '2020-10-12 08:44:15'),
(4, 1, 'ไม่สวมหมวกกันน็อค', '', '2020-10-12 08:44:39'),
(5, 1, 'ไม่มีใบอนุญาติขับขี่', '', '2020-10-12 08:45:06'),
(6, 1, 'เสพยา', '', '2020-11-12 13:16:11');

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

CREATE TABLE `position` (
  `id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `acronym` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `last_edit` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `position`
--

INSERT INTO `position` (`id`, `status`, `name`, `acronym`, `last_edit`) VALUES
(1, 1, 'นักเรียนนายร้อยตำรวจ', 'นรต.', '2020-10-06 09:03:39'),
(2, 1, 'พลตำรวจ', 'พล', '2020-10-06 09:03:39'),
(3, 1, 'สิบตำรวจตรี', 'ส.ต.ต.', '2020-10-06 09:03:39'),
(4, 1, 'สิบตำรวจโท', 'ส.ต.ท.', '2020-10-06 09:03:39'),
(5, 1, 'สิบตำรวจเอก', 'ส.ต.อ.', '2020-10-06 09:03:39'),
(6, 1, 'จ่าสิบตำรวจ', 'จ.ส.ต.', '2020-10-06 09:03:39'),
(7, 1, 'ดาบตำรวจ', 'ด.ต.', '2020-10-06 09:03:39'),
(8, 1, 'ร้อยตำรวจตรี', 'ร.ต.ต.', '2020-10-06 09:03:39'),
(9, 1, 'ร้อยตำรวจโท', 'ร.ต.ท.', '2020-10-06 09:03:52'),
(10, 1, 'ร้อยตำรวจเอก', 'ร.ต.อ.', '2020-10-06 09:03:52'),
(11, 1, 'administrator', 'Admin', '2020-10-23 06:42:43');

-- --------------------------------------------------------

--
-- Table structure for table `titlename`
--

CREATE TABLE `titlename` (
  `id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `last_edit` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `titlename`
--

INSERT INTO `titlename` (`id`, `status`, `name`, `last_edit`) VALUES
(1, 1, 'นาย', '2020-10-06 08:56:09'),
(2, 1, 'นาง', '2020-10-06 08:56:38'),
(3, 1, 'นางสาว', '2020-10-06 08:56:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `material_type`
--
ALTER TABLE `material_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offender`
--
ALTER TABLE `offender`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plaint`
--
ALTER TABLE `plaint`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plaint_type`
--
ALTER TABLE `plaint_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `position`
--
ALTER TABLE `position`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `titlename`
--
ALTER TABLE `titlename`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `material`
--
ALTER TABLE `material`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `material_type`
--
ALTER TABLE `material_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `offender`
--
ALTER TABLE `offender`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `plaint`
--
ALTER TABLE `plaint`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `plaint_type`
--
ALTER TABLE `plaint_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `position`
--
ALTER TABLE `position`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `titlename`
--
ALTER TABLE `titlename`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
