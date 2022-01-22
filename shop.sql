-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2022 at 02:12 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `district` varchar(100) NOT NULL,
  `subdistrict` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `address_card` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`district`, `subdistrict`, `city`, `address_card`) VALUES
('vnvn', 'ssddd', 'cvb', 1000000000000017),
('ddddd', 'ffff', 'wer', 1000000000000018),
('cox', 'ramu', 'palong', 1000000000000020),
('chittagong', 'hathazari', 'Jobra', 1000000000000021);

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(50) NOT NULL,
  `admin_email` varchar(50) NOT NULL,
  `admin_password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `admin_email`, `admin_password`) VALUES
(1, 'Monir', 'ahmad@gmail.com', 'a906449d5769fa7361d7ecc6aa3f6d28');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `brand_id` int(11) NOT NULL,
  `brand_title` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`brand_id`, `brand_title`) VALUES
(1, 'bata'),
(2, 'asus'),
(3, 'del'),
(4, 'samsung'),
(5, 'iphone'),
(6, 'oppo'),
(7, 'rich man');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_price` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(11) NOT NULL,
  `cat_title` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(2, 'laptop'),
(3, 'mobile'),
(4, 'mouse'),
(5, 'shirt'),
(7, 'Headphone'),
(8, 'xbox');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `order_info_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `p_id`, `qty`, `order_info_id`) VALUES
(1908, 3, 1, 1000000000000017),
(1909, 5, 2, 1000000000000018),
(1910, 6, 2, 1000000000000018),
(1911, 3, 2, 1000000000000019),
(1912, 5, 1, 1000000000000019),
(1913, 7, 2, 1000000000000020),
(1914, 24, 1, 1000000000000021),
(1915, 22, 1, 1000000000000021),
(1916, 6, 3, 1000000000000021);

-- --------------------------------------------------------

--
-- Table structure for table `order_info`
--

CREATE TABLE `order_info` (
  `cardnumber` bigint(17) NOT NULL,
  `user_id` int(11) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `pmode` varchar(100) NOT NULL,
  `date` varchar(15) NOT NULL,
  `status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_info`
--

INSERT INTO `order_info` (`cardnumber`, `user_id`, `phone`, `pmode`, `date`, `status`) VALUES
(1000000000000017, 1, '01690073333', 'cod', '2021-12-30', 'Done'),
(1000000000000018, 1, '01698827272', 'cod', '2021-12-30', 'Done'),
(1000000000000019, 1, '01698765432', 'cod', '2022-01-04', 'ordered'),
(1000000000000020, 1, '01690876542', 'cod', '2022-01-04', 'ordered'),
(1000000000000021, 1, '01690000234', 'Nagad', '2022-01-20', 'ordered');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `product_title` varchar(50) NOT NULL,
  `product_price` int(11) NOT NULL,
  `product_image` varchar(50) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `cat_id`, `brand_id`, `product_title`, `product_price`, `product_image`, `description`) VALUES
(1, 2, 2, 'laptop1', 30000, 'laptop1.png', 'dddddddddddd'),
(2, 3, 4, 'mobile1', 20000, 'mobile1.png', 'ddddddd'),
(3, 4, 3, 'mouse1', 300, 'mouse1.jpg', 'gggggg'),
(5, 7, 6, 'headphone1', 150, 'headphone1.png', 'fdertttttttt'),
(6, 8, 2, 'xbox1', 700, 'xbox1.jpg', 'fgjjjjj'),
(7, 8, 2, 'xbox1', 700, 'xbox1.jpg', 'fgjjjjj'),
(9, 2, 2, 'asus1', 55000, 'asus1.png', 'asdfg'),
(10, 5, 7, 'Shirt2', 1000, 'Shirt2.jpg', 'ghhhhh'),
(11, 5, 7, 'Shirt3', 1100, 'Shirt3.jpg', 'ggggggg'),
(12, 5, 7, 'Shirt4', 1200, 'Shirt4.jpg', 'cfrtt'),
(13, 5, 7, 'Shirt5', 1300, 'Shirt5.jpg', 'jgjfkfk'),
(14, 5, 7, 'Shirt6', 1500, 'Shirt6.jpeg', 'kgjjg'),
(15, 2, 2, 'Laptop10', 50000, 'Laptop10.jpg', 'fggggggg'),
(16, 2, 2, 'Laptop11', 60000, 'Laptop11.png', 'vnnn'),
(17, 4, 4, 'mouse10', 300, 'mouse10.png', 'hffffff'),
(18, 4, 4, 'mouse11', 250, 'mouse11.png', 'jgjgjg'),
(19, 4, 4, 'mouse12', 200, 'mouse12.png', 'hjiyt'),
(20, 8, 3, 'xbox10', 40000, 'xbox10.jpg', 'fhfhfh'),
(21, 8, 4, 'xbox11', 36000, 'xbox11.png', 'jgjgj'),
(22, 8, 4, 'xbox12', 38000, 'xbox12.png', 'kiutr'),
(23, 3, 4, 'phone10', 20000, 'phone10.png', 'hjkk'),
(24, 3, 4, 'phone11', 26000, 'phone11.png', 'jkiu'),
(25, 3, 4, 'phone12', 30000, 'phone12.jpg', 'sdddee'),
(26, 3, 5, 'phone13', 34000, 'phone13.png', 'fgg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `name`, `email`, `password`) VALUES
(1, 'Monir', 'ahhh@gmail.com', 'e8dc4081b13434b45189a720b77b6818');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD UNIQUE KEY `address_card` (`address_card`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_info`
--
ALTER TABLE `order_info`
  ADD PRIMARY KEY (`cardnumber`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1917;

--
-- AUTO_INCREMENT for table `order_info`
--
ALTER TABLE `order_info`
  MODIFY `cardnumber` bigint(17) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000000000000022;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
