-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Jan 14, 2025 at 05:16 AM
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
-- Database: `food-order`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `full_name`, `username`, `password`) VALUES
(26, 'Team5', 'T5', '827ccb0eea8a706c4c34a16891f84e7b'),
(27, 'Super Admin', 'Super Admin', '202cb962ac59075b964b07152d234b70'),
(28, 'Tong SreyLeak', 'tongsreyleak', '827ccb0eea8a706c4c34a16891f84e7b'),
(29, 'Chhorn SreyProek', 'chhornsreyproek', '827ccb0eea8a706c4c34a16891f84e7b'),
(30, 'Nham ChamNes', 'nhamchamnes', '827ccb0eea8a706c4c34a16891f84e7b');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `title`, `image_name`, `featured`, `active`) VALUES
(10, 'Sweet', 'Food_Category_639.jpg    ', 'Yes', 'Yes'),
(13, 'Spicy Food', 'Food_Category_597.jpg ', 'Yes', 'Yes'),
(14, 'Drink', 'Food_Category_430.jpg', 'Yes', 'Yes'),
(20, 'Thai Food', 'Food_Category_8.jpg', 'Yes', 'Yes'),
(21, 'Korea Food', 'Food_Category_938.jpg', 'Yes', 'Yes'),
(22, 'Khmer Food', 'Food_Category_903.jpg', 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_food`
--

CREATE TABLE `tbl_food` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_food`
--

INSERT INTO `tbl_food` (`id`, `title`, `description`, `price`, `image_name`, `category_id`, `featured`, `active`) VALUES
(10, 'Amok', 'National Khmer Food', 8.00, 'Food-Name-7292.jpg', 17, 'Yes', 'Yes'),
(11, 'Samlor Mju Krerng', 'Top', 5.00, 'Food-Name-9886.jpg', 17, 'Yes', 'Yes'),
(12, 'Buk lhong', 'Top', 6.00, 'Food-Name-2370.jpg', 20, 'Yes', 'Yes'),
(13, 'Toboki', 'Top', 7.00, 'Food-Name-3040.jpg', 21, 'Yes', 'Yes'),
(14, 'Oreo MilkShark', 'Top', 4.00, 'Food-Name-6591.jpg', 14, 'Yes', 'Yes'),
(15, 'Sweet Cake', 'Top', 4.00, 'Food-Name-6696.jpg', 10, 'Yes', 'Yes'),
(16, 'Noodle Spicy', 'Top', 8.00, 'Food-Name-5669.jpg', 13, 'Yes', 'Yes'),
(17, 'Amok', 'Top', 4.00, 'Food-Name-8138.jpg', 22, 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` int(10) UNSIGNED NOT NULL,
  `food` varchar(150) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `order_date` datetime NOT NULL,
  `status` varchar(50) NOT NULL,
  `customer_name` varchar(150) NOT NULL,
  `customer_contact` varchar(20) NOT NULL,
  `customer_email` varchar(150) NOT NULL,
  `customer_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `food`, `price`, `qty`, `total`, `order_date`, `status`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`) VALUES
(8, 'we', 9.00, 1, 9.00, '2024-12-27 04:03:53', 'Cancelled', 'A', '8888665', 'sunshineaccessories@gmail.com', 'pp'),
(9, 'we', 9.00, 1, 9.00, '2024-12-27 04:10:04', 'Delivered', 'A', '8888665', 'sunshineaccessories@gmail.com', 'pp'),
(10, 'we', 9.00, 3, 27.00, '2024-12-27 04:10:59', 'On Delivery', 'Agghgfty', '8888665g67', 'sunshineaccessories@gmail.com', 'ppa'),
(11, 'Amok', 8.00, 1, 8.00, '2024-12-27 12:50:58', 'Ordered', 'apple', '8888665', 'sunshineaccessories@gmail.com', 'pp'),
(12, 'Samlor Mju Krerng', 5.00, 2, 10.00, '2024-12-28 09:09:26', 'Delivered', 'Tong SreyLeak', '0888500518', 'sunshineaccessories@gmail.com', 'pp');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_food`
--
ALTER TABLE `tbl_food`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tbl_food`
--
ALTER TABLE `tbl_food`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
