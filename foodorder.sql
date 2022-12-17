-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:4306
-- Generation Time: Jun 11, 2021 at 08:29 AM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.3.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `foodorder`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `full_name`, `username`, `password`) VALUES
(21, 'admin', 'sunny', '12345'),
(22, 'soltana nasser', 'soltana', '12345');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `title`, `image_name`, `featured`, `active`) VALUES
(19, 'Pizza', 'Food_Category_570.jpg', 'Yes', 'Yes'),
(20, 'dumplings', 'Food_Category_4.jpg', 'No', 'Yes'),
(21, 'Burger', 'Food_Category_398.jpg', 'Yes', 'Yes'),
(22, 'Spaghetti', 'Food_Category_86.jpg', 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `id` int(10) UNSIGNED NOT NULL,
  `customer_name` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `customer_contact` varchar(20) NOT NULL,
  `customer_email` varchar(150) NOT NULL,
  `customer_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`id`, `customer_name`, `password`, `customer_contact`, `customer_email`, `customer_address`) VALUES
(1, 'sunny1', '12345', '96108555444', 'hsunnyb2@gmail.com', '123 honey Road'),
(2, 'sunny', '12345', '96108555333', 'hsunny@gmail.com', '432 Honey Road'),
(3, 'sunny2', '12345', '363-852-0637', 'sunny@hotmail.com', '567 Honey Road'),
(4, 'Abagail Fadel', '12345', '924-965-6089', 'fakedata45779@gmail.com', '342 Honey Road'),
(5, 'sunny3', '12345', '774-489-0821', 'fakedata40717@gmail.com', '61009-HONEY Road'),
(6, 'Soltana', '12345', '280-562-9060', 'fakedata32629@gmail.com', '6789- Honey Road');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_food`
--

CREATE TABLE `tbl_food` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_food`
--

INSERT INTO `tbl_food` (`id`, `title`, `description`, `price`, `image_name`, `category_id`, `featured`, `active`) VALUES
(9, 'Best Burger', 'Burger with Ham and lots of cheese', '4.00', 'Food-Name743.jpg', 21, 'Yes', 'Yes'),
(10, 'Dumpling Special', 'Chicken Dumpling with herbs from Mountains', '5.00', 'Food-Name884.jpg', 20, 'Yes', 'Yes'),
(11, 'Smoky BBQ Pizza', 'Best Firewood Pizza in Town', '7.00', 'Food-Name125.jpg', 19, 'No', 'Yes'),
(12, 'Mixed Pizza', 'Pizza with chicken,Ham,Mushroom&vegetebales', '10.00', 'Food_Name_6657.jpg', 19, 'Yes', 'Yes'),
(13, 'Best Spaghetti', 'Spaghetti with meatBalls, mushrooms & tomato sauce', '13.00', 'Food_Name_4671.jpg', 22, 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_invoice`
--

CREATE TABLE `tbl_invoice` (
  `invoice_id` int(10) UNSIGNED NOT NULL,
  `customer_id` int(10) UNSIGNED NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `payment_type` varchar(255) NOT NULL,
  `invoice_date` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_invoice`
--

INSERT INTO `tbl_invoice` (`invoice_id`, `customer_id`, `total`, `payment_type`, `invoice_date`) VALUES
(91, 6, '160.00', 'Cash', '2021-03-03 01:02:24pm'),
(92, 4, '109.00', 'Cash', '2021-03-03 03'),
(93, 4, '109.00', 'Check', '2021-03-03 03'),
(94, 4, '109.00', 'Check', '2021-03-03 03'),
(95, 4, '109.00', 'Check', '2021-03-03 03'),
(96, 6, '170.00', 'Cash', '2021-03-03 03'),
(97, 4, '109.00', 'Check', '2021-03-03 03'),
(98, 2, '55.00', 'Check', '2021-03-03 03'),
(99, 2, '55.00', 'Check', '2021-03-03 03'),
(100, 3, '110.00', 'Check', '2021-03-03 03'),
(101, 2, '55.00', 'Cash', '2021-03-03 03'),
(102, 2, '115.00', 'Cash', '2021-03-03 03'),
(103, 6, '220.00', 'Check', '2021-03-03 03'),
(104, 6, '220.00', 'Cash', '2021-03-03 03'),
(105, 6, '220.00', 'Cash', '2021-03-03 03'),
(106, 6, '220.00', 'Check', '2021-03-03 03'),
(107, 2, '375.00', 'Check', '2021-03-03 03'),
(108, 2, '375.00', 'Cash', '2021-03-03 03'),
(109, 1, '130.00', 'Cash', '2021-03-03 03'),
(110, 6, '5.00', 'Cash', '2021-03-05 12:19'),
(111, 6, '205.00', 'Check', '2021-03-05 12:19'),
(112, 6, '421.00', 'Cash', '2021-03-06 09:46'),
(113, 6, '421.00', 'Check', '2021-03-06 09:46'),
(114, 6, '281.00', 'Cash', '2021-03-06 09:46'),
(115, 6, '281.00', 'Cash', '2021-03-06 09:46'),
(116, 6, '285.00', 'Check', '2021-03-06 09:46'),
(117, 6, '331.00', 'Cash', '2021-03-06 09:46'),
(118, 6, '331.00', 'Check', '2021-03-06 09:46'),
(119, 6, '331.00', 'Cash', '2021-03-06 09:46'),
(120, 6, '331.00', 'Cash', '2021-03-06 09:46'),
(121, 6, '331.00', 'Check', '2021-03-06 09:46'),
(122, 6, '331.00', 'Cash', '2021-03-06 09:46'),
(123, 6, '331.00', 'Check', '2021-03-06 09:46'),
(124, 6, '331.00', 'Check', '2021-03-06 09:46'),
(125, 6, '331.00', 'Cash', '2021-03-06 09:46'),
(126, 6, '331.00', 'Cash', '2021-03-06 09:46'),
(127, 6, '331.00', 'Cash', '2021-03-06 09:46'),
(128, 6, '331.00', 'Cash', '2021-03-06 09:46'),
(129, 6, '331.00', 'Check', '2021-03-06 09:46'),
(130, 6, '331.00', 'Cash', '2021-03-06 09:46'),
(131, 6, '341.00', 'Check', '2021-03-06 09:46'),
(132, 6, '201.00', 'Cash', '2021-03-06 09:46'),
(133, 6, '214.00', 'Check', '2021-03-06 09:46'),
(134, 6, '214.00', 'Cash', '2021-03-06 09:46'),
(135, 6, '214.00', 'Cash', '2021-03-06 09:46'),
(136, 6, '214.00', 'Check', '2021-03-06 09:46'),
(137, 6, '214.00', 'Cash', '2021-03-06 09:46'),
(138, 6, '214.00', 'Cash', '2021-03-06 09:46'),
(139, 6, '214.00', 'Cash', '2021-03-06 09:46'),
(140, 6, '214.00', 'Check', '2021-03-06 09:46'),
(141, 6, '214.00', 'Check', '2021-03-06 09:46'),
(142, 6, '214.00', 'Check', '2021-03-06 09:46'),
(143, 6, '214.00', 'Check', '2021-03-06 09:46'),
(144, 6, '214.00', 'Check', '2021-03-06 09:46'),
(145, 6, '214.00', 'Check', '2021-03-06 09:46'),
(146, 6, '214.00', 'Check', '2021-03-06 09:46'),
(147, 6, '214.00', 'Cash', '2021-03-06 09:46'),
(148, 6, '214.00', 'Check', '2021-03-06 09:46'),
(149, 6, '214.00', 'Cash', '2021-03-06 09:46'),
(150, 6, '214.00', 'Check', '2021-03-06 09:46'),
(151, 6, '214.00', 'Check', '2021-03-06 09:46'),
(152, 2, '4.00', 'Check', '2021-06-10 10:26'),
(153, 2, '4.00', 'Check', '2021-06-10 10:26'),
(154, 2, '4.00', 'Check', '2021-06-10 10:26'),
(155, 2, '4.00', 'Check', '2021-06-10 10:26'),
(156, 2, '4.00', 'Check', '2021-06-10 10:26'),
(157, 2, '4.00', 'Check', '2021-06-10 10:26'),
(158, 2, '134.00', 'Cash', '2021-06-10 10:26'),
(159, 2, '134.00', 'Cash', '2021-06-10 10:26'),
(160, 2, '138.00', 'Cash', '2021-06-10 10:26'),
(161, 2, '138.00', 'Check', '2021-06-10 10:26'),
(162, 2, '13.00', 'Cash', '2021-06-11 07:38'),
(163, 2, '40.00', 'Check', '2021-06-11 07:40'),
(164, 2, '73.00', 'Check', '2021-06-11 07:40'),
(165, 6, '41.00', 'Check', '2021-06-11 08:25'),
(166, 6, '41.00', 'Cash', '2021-06-11 08:25'),
(167, 6, '41.00', 'Cash', '2021-06-11 08:25'),
(168, 6, '51.00', 'Cash', '2021-06-11 08:25');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `order_id` int(10) UNSIGNED NOT NULL,
  `food_id` int(10) NOT NULL,
  `food` varchar(150) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int(10) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `order_date` datetime NOT NULL,
  `status` varchar(200) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`order_id`, `food_id`, `food`, `price`, `qty`, `total`, `order_date`, `status`, `customer_id`, `cart_id`) VALUES
(5, 9, 'Best Burger', '4.00', 2, '8.00', '2021-03-01 00:00:00', 'Delivered', 6, 1),
(6, 10, 'Dumpling Special', '5.00', 1, '5.00', '2021-03-01 00:00:00', 'Delivered', 6, 1),
(10, 12, 'Mixed Pizza', '10.00', 5, '50.00', '2021-03-01 00:00:00', 'Delivered', 6, 1),
(13, 13, 'Best Spaghetti', '13.00', 5, '65.00', '2021-03-02 00:00:00', 'Delivered', 6, 0),
(17, 10, 'Dumpling Special', '5.00', 7, '35.00', '2021-03-03 00:00:00', 'Delivered', 6, 0),
(19, 13, 'Best Spaghetti', '13.00', 1, '13.00', '2021-03-03 00:00:00', 'Delivered', 5, 0),
(20, 10, 'Dumpling Special', '5.00', 1, '5.00', '2021-03-03 00:00:00', 'Delivered', 2, 0),
(21, 10, 'Dumpling Special', '5.00', 6, '30.00', '2021-03-03 00:00:00', 'Delivered', 6, 0),
(22, 9, 'Best Burger', '4.00', 10, '40.00', '2021-03-03 00:00:00', 'Delivered', 6, 0),
(23, 12, 'Mixed Pizza', '10.00', 5, '50.00', '2021-03-03 00:00:00', 'Delivered', 6, 0),
(24, 9, 'Best Burger', '4.00', 5, '20.00', '2021-03-03 00:00:00', 'Delivered', 6, 0),
(25, 12, 'Mixed Pizza', '10.00', 3, '30.00', '2021-03-03 01:08:54', 'Delivered', 6, 0),
(26, 12, 'Mixed Pizza', '10.00', 1, '10.00', '2021-03-03 01:00:00', 'Delivered', 6, 0),
(27, 12, 'Mixed Pizza', '10.00', 1, '10.00', '2021-03-03 01:02:24', 'Delivered', 6, 0),
(28, 13, 'Best Spaghetti', '13.00', 10, '130.00', '2021-03-03 01:02:24', 'Delivered', 6, 0),
(29, 9, 'Best Burger', '4.00', 5, '20.00', '2021-03-03 01:02:24', 'Delivered', 6, 0),
(31, 9, 'Best Burger', '4.00', 5, '20.00', '2021-03-03 03:00:00', 'Delivered', 4, 0),
(33, 12, 'Mixed Pizza', '10.00', 2, '20.00', '2021-03-03 03:00:00', 'Delivered', 4, 0),
(34, 12, 'Mixed Pizza', '10.00', 3, '30.00', '2021-03-03 03:00:00', 'Delivered', 4, 0),
(35, 13, 'Best Spaghetti', '13.00', 3, '39.00', '2021-03-03 03:00:00', 'Delivered', 4, 0),
(36, 11, 'Smoky BBQ Pizza', '7.00', 10, '70.00', '2021-03-03 03:00:00', 'Delivered', 6, 0),
(37, 12, 'Mixed Pizza', '10.00', 10, '100.00', '2021-03-03 03:00:00', 'Delivered', 6, 0),
(38, 10, 'Dumpling Special', '5.00', 11, '55.00', '2021-03-03 03:00:00', 'Delivered', 2, 0),
(39, 11, 'Smoky BBQ Pizza', '7.00', 10, '70.00', '2021-03-03 03:00:00', 'Delivered', 3, 0),
(40, 9, 'Best Burger', '4.00', 10, '40.00', '2021-03-03 03:00:00', 'Cancelled', 3, 0),
(41, 9, 'Best Burger', '4.00', 10, '40.00', '2021-03-03 03:00:00', 'Delivered', 2, 0),
(42, 9, 'Best Burger', '4.00', 5, '20.00', '2021-03-03 03:00:00', 'Cancelled', 2, 0),
(43, 9, 'Best Burger', '4.00', 10, '40.00', '2021-03-03 03:00:00', 'Cancelled', 6, 0),
(44, 12, 'Mixed Pizza', '10.00', 1, '10.00', '2021-03-03 03:00:00', 'Delivered', 6, 0),
(45, 13, 'Best Spaghetti', '13.00', 20, '260.00', '2021-03-03 03:00:00', 'Delivered', 2, 0),
(46, 13, 'Best Spaghetti', '13.00', 10, '130.00', '2021-03-03 03:00:00', 'Delivered', 1, 0),
(47, 10, 'Dumpling Special', '5.00', 1, '5.00', '2021-03-05 12:19:00', 'ordered', 6, 0),
(48, 13, 'Best Spaghetti', '13.00', 10, '130.00', '2021-03-05 12:19:00', 'ordered', 6, 0),
(49, 11, 'Smoky BBQ Pizza', '7.00', 10, '70.00', '2021-03-05 12:19:00', 'ordered', 6, 0),
(50, 13, 'Best Spaghetti', '13.00', 1, '13.00', '2021-03-05 12:19:00', 'ordered', 6, 0),
(51, 9, 'Best Burger', '4.00', 1, '4.00', '2021-03-05 12:19:00', 'ordered', 6, 0),
(53, 9, 'Best Burger', '4.00', 15, '60.00', '2021-03-06 09:46:00', 'ordered', 6, 0),
(54, 11, 'Smoky BBQ Pizza', '7.00', 13, '91.00', '2021-03-06 09:46:00', 'ordered', 6, 0),
(57, 10, 'Dumpling Special', '5.00', 10, '50.00', '2021-03-06 09:46:00', 'ordered', 6, 0),
(59, 13, 'Best Spaghetti', '13.00', 1, '13.00', '2021-03-06 09:46:00', 'ordered', 6, 0),
(61, 9, 'Best Burger', '4.00', 1, '4.00', '2021-06-10 10:26:00', 'ordered', 2, 0),
(62, 13, 'Best Spaghetti', '13.00', 10, '130.00', '2021-06-10 10:26:00', 'ordered', 2, 0),
(63, 9, 'Best Burger', '4.00', 1, '4.00', '2021-06-10 10:26:00', 'ordered', 2, 0),
(64, 13, 'Best Spaghetti', '13.00', 1, '13.00', '2021-06-11 07:38:00', 'ordered', 2, 0),
(65, 9, 'Best Burger', '4.00', 10, '40.00', '2021-06-11 07:40:00', 'ordered', 2, 0),
(66, 12, 'Mixed Pizza', '10.00', 1, '10.00', '2021-06-11 07:40:00', 'ordered', 2, 0),
(67, 12, 'Mixed Pizza', '10.00', 1, '10.00', '2021-06-11 07:40:00', 'ordered', 2, 0),
(68, 13, 'Best Spaghetti', '13.00', 1, '13.00', '2021-06-11 07:40:00', 'ordered', 2, 0),
(69, 9, 'Best Burger', '4.00', 1, '4.00', '2021-06-11 08:25:00', 'ordered', 6, 0),
(70, 9, 'Best Burger', '4.00', 1, '4.00', '2021-06-11 08:25:00', 'ordered', 6, 0),
(71, 13, 'Best Spaghetti', '13.00', 1, '13.00', '2021-06-11 08:25:00', 'ordered', 6, 0),
(72, 13, 'Best Spaghetti', '13.00', 1, '13.00', '2021-06-11 08:25:00', 'ordered', 6, 0),
(73, 11, 'Smoky BBQ Pizza', '7.00', 1, '7.00', '2021-06-11 08:25:00', 'ordered', 6, 0),
(74, 12, 'Mixed Pizza', '10.00', 1, '10.00', '2021-06-11 08:25:00', 'ordered', 6, 0);

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
-- Indexes for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_food`
--
ALTER TABLE `tbl_food`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_invoice`
--
ALTER TABLE `tbl_invoice`
  ADD PRIMARY KEY (`invoice_id`),
  ADD KEY `tbl_invoice_ibfk_1` (`customer_id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`order_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_food`
--
ALTER TABLE `tbl_food`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_invoice`
--
ALTER TABLE `tbl_invoice`
  MODIFY `invoice_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=169;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `order_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_invoice`
--
ALTER TABLE `tbl_invoice`
  ADD CONSTRAINT `tbl_invoice_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `tbl_customer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
