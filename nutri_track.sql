-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 15, 2026 at 01:03 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nutri_track`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_info`
--

CREATE TABLE `admin_info` (
  `admin_name` varchar(50) NOT NULL,
  `admin_email` varchar(100) NOT NULL,
  `user_name` varchar(10) NOT NULL,
  `password` varchar(20) NOT NULL,
  `Mobile_Number` varchar(11) NOT NULL,
  `admin_id` varchar(7) NOT NULL,
  `Permanent_Address` varchar(100) NOT NULL,
  `profile_photo` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_info`
--

INSERT INTO `admin_info` (`admin_name`, `admin_email`, `user_name`, `password`, `Mobile_Number`, `admin_id`, `Permanent_Address`, `profile_photo`) VALUES
('Fayeza Afrah Hissan', 'f.a.hissan1311@gmail.com', 'Fayeza', 'adminfah', '01836504337', 'ADM001', 'Hajirpul, Chattogram', '67693fe18861c6.26559916.jpeg'),
('Akhi Moon Jahan', 'akhimoon6445@gmail.com', 'Akhi', 'adminamj', '01636101228', 'ADM002', 'New Market, Chattogram', ''),
('Israth Jahan Worthy', 'israthjahanworthy29@gmail.com', 'Israth', 'adminijw', '01884204514', 'ADM003', 'Kotowali , Chattogram', '6868c0030e5583.61515184.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `breakfast`
--

CREATE TABLE `breakfast` (
  `serial_no.` int(11) NOT NULL,
  `item_id` varchar(3) NOT NULL,
  `item_name` varchar(15) NOT NULL,
  `item_price` int(11) NOT NULL,
  `calorie` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `breakfast`
--

INSERT INTO `breakfast` (`serial_no.`, `item_id`, `item_name`, `item_price`, `calorie`) VALUES
(51, 'B01', 'Plain Paratha', 10, 180),
(52, 'B02', 'Egg Omelette', 20, 90),
(53, 'B03', 'Boiled Egg', 12, 75),
(54, 'B04', 'Plain Roti', 8, 70),
(55, 'B05', 'Jam', 15, 60),
(69, 'B06', 'Bread', 5, 70),
(70, 'B07', 'Mixed Vegetable', 25, 100),
(72, 'B08', 'Lentils Curry', 22, 180),
(74, 'B09', 'Khichuri', 30, 350);

-- --------------------------------------------------------

--
-- Table structure for table `drinks`
--

CREATE TABLE `drinks` (
  `serial_no` int(11) NOT NULL,
  `item_id` varchar(3) NOT NULL,
  `item_name` varchar(25) NOT NULL,
  `item_price` int(11) NOT NULL,
  `calorie` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `drinks`
--

INSERT INTO `drinks` (`serial_no`, `item_id`, `item_name`, `item_price`, `calorie`) VALUES
(1, 'D01', 'Milk', 10, 100),
(2, 'D02', 'Milk Tea', 10, 110),
(4, 'D03', 'Black Tea', 8, 5),
(5, 'D04', 'Coffee', 15, 130),
(6, 'D05', 'Lemon Juice', 15, 60),
(9, 'D06', 'Lassi', 20, 150),
(10, 'D07', 'Soft Drinks', 25, 150),
(13, 'D08', 'Bottled Water', 15, 0),
(14, 'D09', 'Green Coconut Water', 30, 60),
(15, 'D10', 'Seasonal Fruit Juice', 30, 120);

-- --------------------------------------------------------

--
-- Table structure for table `health_metrics`
--

CREATE TABLE `health_metrics` (
  `num` int(11) NOT NULL,
  `id` varchar(10) NOT NULL,
  `meal_cn` varchar(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `height` double NOT NULL,
  `weight` double NOT NULL,
  `age` int(5) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `activity` varchar(100) NOT NULL,
  `bmi` double NOT NULL,
  `bmr` double NOT NULL,
  `tdi` double NOT NULL,
  `calorie` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `health_metrics`
--

INSERT INTO `health_metrics` (`num`, `id`, `meal_cn`, `name`, `date`, `height`, `weight`, `age`, `gender`, `activity`, `bmi`, `bmr`, `tdi`, `calorie`) VALUES
(1, 'C223206', 'MC206113', 'Fayeza Afrah Hissan', '2025-08-06', 1.5, 38, 23, 'female', '1.55', 16.89, 1041.5, 1614.33, 2114.33),
(3, 'C223206', 'MC206113', 'Fayeza Afrah Hissan', '2025-08-06', 1.5, 38, 23, 'female', '1.55', 16.89, 1041.5, 1614.33, 2114.33),
(4, 'C223206', 'MC206113', 'Fayeza Afrah Hissan', '2025-08-06', 1.5, 38, 23, 'female', '1.55', 16.89, 1041.5, 1614.33, 2114.33),
(5, 'C223206', 'MC206113', 'Fayeza Afrah Hissan', '2025-08-06', 1.5, 38, 23, 'female', '1.55', 16.89, 1041.5, 1614.33, 2114.33),
(6, 'C223229', 'MC229229', 'Israth Jahan Worthy', '2025-08-06', 1.676, 72, 24, 'female', '1.55', 25.63, 1486.5, 2304.08, 2004.08),
(7, 'C223229', 'MC229229', 'Israth Jahan Worthy', '2025-08-06', 1, 82, 24, 'female', '1.2', 82, 1164, 1396.8, 896.8);

-- --------------------------------------------------------

--
-- Table structure for table `lunch`
--

CREATE TABLE `lunch` (
  `serial_no` int(11) NOT NULL,
  `item_id` varchar(3) NOT NULL,
  `item_name` varchar(25) NOT NULL,
  `item_price` int(11) NOT NULL,
  `calorie` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lunch`
--

INSERT INTO `lunch` (`serial_no`, `item_id`, `item_name`, `item_price`, `calorie`) VALUES
(1, 'L01', 'Plain Rice', 25, 200),
(2, 'L02', 'Fried Rice', 40, 300),
(13, 'L03', 'Biryani', 50, 350),
(4, 'L04', 'Chicken Curry', 40, 220),
(5, 'L05', 'Beef Biryani', 50, 300),
(20, 'L06', 'Fish Curry', 45, 250),
(21, 'L07', 'Mixed Vegetables', 25, 100),
(26, 'L08', 'Daal', 15, 150),
(27, 'L09', 'Fried Egg', 20, 90),
(28, 'L10', 'Salad', 20, 50);

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `order_id` varchar(10) NOT NULL,
  `item_id` varchar(3) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`order_id`, `item_id`, `item_name`, `item_price`, `quantity`, `id`) VALUES
('O040725672', 'S04', 'Vegetable Patties', 15, 1, 1),
('O040725672', 'S05', 'Seasonal Fruits', 20, 1, 2),
('O040725807', 'D05', 'Lemon Juice', 15, 1, 3),
('O040725807', 'D08', 'Bottled Water', 15, 2, 4),
('O050725644', 'B00', 'Plain Paratha', 10, 2, 5),
('O050725644', 'B06', 'Mixed Vegetable', 25, 1, 6),
('O050725694', 'D04', 'Coffee', 15, 1, 7),
('O050725694', 'D05', 'Lemon Juice', 15, 1, 8);

-- --------------------------------------------------------

--
-- Table structure for table `order_info`
--

CREATE TABLE `order_info` (
  `meal_cn` varchar(8) NOT NULL,
  `order_id` varchar(10) NOT NULL,
  `order_date` date NOT NULL,
  `total_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_info`
--

INSERT INTO `order_info` (`meal_cn`, `order_id`, `order_date`, `total_price`) VALUES
('MC204211', 'O040725672', '2025-07-04', 35),
('MC204211', 'O040725807', '2025-07-04', 45),
('MC206113', 'O050725644', '2025-07-05', 45),
('MC206113', 'O050725694', '2025-07-05', 30),
('MC202213', 'O050725076', '2025-07-05', 90),
('MC202213', 'O050725136', '2025-07-05', 70);

-- --------------------------------------------------------

--
-- Table structure for table `snacks`
--

CREATE TABLE `snacks` (
  `serial_no` int(11) NOT NULL,
  `item_id` varchar(3) NOT NULL,
  `item_name` varchar(25) NOT NULL,
  `item_price` int(11) NOT NULL,
  `calorie` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `snacks`
--

INSERT INTO `snacks` (`serial_no`, `item_id`, `item_name`, `item_price`, `calorie`) VALUES
(1, 'S01', 'Shingara', 10, 130),
(2, 'S02', 'Somucha', 10, 120),
(3, 'S03', 'Chicken Sandwich', 35, 300),
(4, 'S04', 'Vegetable Patties', 15, 150),
(13, 'S05', 'Seasonal Fruits', 20, 90),
(6, 'S06', 'Fried Chicken', 60, 250),
(7, 'S07', 'Burger', 60, 400),
(14, 'S08', 'Noodles', 30, 350),
(16, 'S09', 'Chotpoti', 35, 250),
(18, 'S10', 'Fuchka', 30, 220);

-- --------------------------------------------------------

--
-- Table structure for table `student_record`
--

CREATE TABLE `student_record` (
  `student_id` varchar(100) NOT NULL,
  `stu_name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `department` varchar(100) NOT NULL,
  `semester` int(11) NOT NULL,
  `varsity_pin` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_record`
--

INSERT INTO `student_record` (`student_id`, `stu_name`, `email`, `department`, `semester`, `varsity_pin`) VALUES
('C223202', 'Akhi Moon Jahan', 'c223202@ugrad.iiuc.ac.bd', 'CSE', 8, 'VP223213'),
('C223204', 'Ayesha Hasan', 'c223204@ugrad.iiuc.ac.bd', 'CSE', 8, 'VP223211'),
('C223206', 'Fayeza Afrah Hissan', 'c223206@ugrad.iiuc.ac.bd', 'CSE', 8, 'VP221113'),
('C223207', 'Zannatun Naima', 'c223207@ugrad.iiuc.ac.bd', 'CSE', 8, 'VP222601'),
('C223210', 'Fahmida Yasmin', 'c223210@ugrad.iiuc.ac.bd', 'CSE', 8, 'VP221010'),
('C223229', 'Israth Jahan Worthy', 'c223229@ugrad.iiuc.ac.bd', 'CSE', 8, 'VP223229');

-- --------------------------------------------------------

--
-- Table structure for table `stu_info`
--

CREATE TABLE `stu_info` (
  `student_id` varchar(100) NOT NULL,
  `stu_name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `department` varchar(100) NOT NULL,
  `semester` int(11) NOT NULL,
  `varsity_pin` varchar(12) NOT NULL,
  `meal_cn` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stu_info`
--

INSERT INTO `stu_info` (`student_id`, `stu_name`, `email`, `password`, `department`, `semester`, `varsity_pin`, `meal_cn`) VALUES
('C223202', 'Akhi Moon Jahan', 'c223202@ugrad.iiuc.ac.bd', '$2y$10$xjMXIsrdjYlfjUuzTbqKA.Lu.vnB/1KA5rRLt5xBc.ltlIwJJESX2', 'CSE', 8, 'VP223213', 'MC202213'),
('C223206', 'Fayeza Afrah Hissan', 'c223206@ugrad.iiuc.ac.bd', '$2y$10$76zSzv1/s5hLtkh1qqY2k.y.3l0xd8JAT9i9D0adgqv/BucXNj2Pm', 'CSE', 6, 'VP221113', 'MC206113'),
('C223229', 'Israth Jahan Worthy', 'c223229@ugrad.iiuc.ac.bd', '$2y$10$cAOIN44kX2jAw.H9LZWrveSKEp0tag6bBDqsjWdXTV0fg/f7wk5.e', 'CSE', 5, 'VP223229', 'MC229229');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_info`
--
ALTER TABLE `admin_info`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `Mobile no.` (`Mobile_Number`),
  ADD UNIQUE KEY `user_name` (`user_name`);

--
-- Indexes for table `breakfast`
--
ALTER TABLE `breakfast`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `serial_no.` (`serial_no.`);

--
-- Indexes for table `drinks`
--
ALTER TABLE `drinks`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `serial_no` (`serial_no`);

--
-- Indexes for table `health_metrics`
--
ALTER TABLE `health_metrics`
  ADD PRIMARY KEY (`num`),
  ADD KEY `ID` (`id`);

--
-- Indexes for table `lunch`
--
ALTER TABLE `lunch`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `serial_no` (`serial_no`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `snacks`
--
ALTER TABLE `snacks`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `serial_no` (`serial_no`);

--
-- Indexes for table `student_record`
--
ALTER TABLE `student_record`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `stu_info`
--
ALTER TABLE `stu_info`
  ADD PRIMARY KEY (`student_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `meal_cn` (`meal_cn`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `breakfast`
--
ALTER TABLE `breakfast`
  MODIFY `serial_no.` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `drinks`
--
ALTER TABLE `drinks`
  MODIFY `serial_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `health_metrics`
--
ALTER TABLE `health_metrics`
  MODIFY `num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `lunch`
--
ALTER TABLE `lunch`
  MODIFY `serial_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `snacks`
--
ALTER TABLE `snacks`
  MODIFY `serial_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `health_metrics`
--
ALTER TABLE `health_metrics`
  ADD CONSTRAINT `ID` FOREIGN KEY (`id`) REFERENCES `stu_info` (`student_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
