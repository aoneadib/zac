-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2018 at 10:53 AM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zac`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(50) NOT NULL,
  `customer_email` varchar(50) NOT NULL,
  `customer_phone` varchar(15) NOT NULL,
  `customer_address` varchar(100) NOT NULL,
  `item_names` varchar(200) NOT NULL,
  `item_ids` varchar(100) NOT NULL,
  `date` varchar(11) NOT NULL,
  `time` varchar(11) NOT NULL,
  `delivery_type` varchar(20) NOT NULL,
  `bill` int(6) NOT NULL,
  `status` varchar(8) NOT NULL DEFAULT 'PENDING'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_name`, `customer_email`, `customer_phone`, `customer_address`, `item_names`, `item_ids`, `date`, `time`, `delivery_type`, `bill`, `status`) VALUES
(14, 'Customer Guy', 'customer@customer.com', '01628265016', '13/8/1,Majar Road,asd', 'Blue Shirt,Red Flower Gown', '29,28', '18/09/2017', '06:08:15pm', 'Cash on Delivery', 13300, 'PENDING'),
(13, 'Customer Guy', 'customer@customer.com', '01628265016', '13/8/1,2,Gulshan', 'Blue Shirt,Tammy Shirt', '29,25', '18/09/2017', '06:07:00pm', 'Cash on Delivery', 3800, 'PENDING'),
(11, 'Some Guy', 'someguy@some.com', '0176512268', 'ASd,ASD,Da2', 'Some items', '1,2,3', '15/08/2017', '01:25:48PM', 'Cash', 1200, 'PAID'),
(12, 'Customer Guy', 'customer@customer.com', '01628265016', '21/A,2,Gulshan', 'Black and White Shirt', '5', '17/09/2017', '12:53:58pm', 'Cash on Delivery', 1100, 'UNPAID'),
(6, 'Another Guy', 'another@another.com', '01675098204', '13/8/1,2,Shyamoli', 'Blue Shirt 2,Cotton Blue Shirt', 'Blue Shirt 2,Cotton Blue Shirt', '05/09/2017', '05:00:14pm', 'Cash on Delivery', 0, 'PENDING'),
(7, 'Another Guy', 'another@another.com', '01675098204', '13/8/1,2,Shyamoli', 'Cotton Blue Shirt', 'Cotton Blue Shirt', '05/09/2017', '05:04:08pm', 'Bkash', 0, 'UNPAID'),
(8, 'Another Guy', 'another@another.com', '01628265016', '21/A,Tajmahal Road,Mohammadpur', 'Cotton Blue Shirt,Blue Shirt 3,Blue Shirt 2', 'Cotton Blue Shirt,Blue Shirt 3,2', '05/09/2017', '05:11:15pm', 'Bkash', 4070, 'UNPAID'),
(9, 'John Doe', 'doe@many.com', '01716285510', '32/A,Majar Road,Mohammadpur', 'Blue Shirt 3,Blue Shirt 2', '3,2', '05/09/2017', '05:13:20pm', 'Cash on Delivery', 2820, 'UNPAID'),
(10, 'Another Guy', 'another@another.com', '01628265016', '21-B,1,Gulshan', 'Blue Shirt 3,Blue Shirt 2,Cotton Blue Shirt,Blue Shirt 3,Cotton Blue Shirt', '3,2,1,3,1', '06/09/2017', '09:26:46am', 'Cash on Delivery', 6890, 'UNPAID');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `description` varchar(200) NOT NULL,
  `type` varchar(20) NOT NULL,
  `imageLocation` varchar(200) DEFAULT NULL,
  `color` varchar(20) NOT NULL,
  `price` int(6) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `type`, `imageLocation`, `color`, `price`) VALUES
(4, 'White Stripe Shirt', 'Half-sleeve shirt with black stripes on a nice white fabric. Add this to your summer wardrobe for fasion and comfort.', 'Women\'s Shirt', 'images/Product/4/', 'White', 990),
(29, 'Blue Shirt', 'Blue full sleeve cotton shirt ', 'Men\'s Shirt', 'images/Product/29/', 'Blue', 1300),
(30, 'Blue Tops', 'Blue soft gorgette tops for girls with unique design', 'Women\'s Shirt', 'images/Product/30/', 'Blue', 1500),
(25, 'Tammy Shirt', 'A new kind of shirt.', 'Women\'s Shirt', 'images/Product/25/', 'Blue', 2500),
(26, 'Red Panjabi', 'Red exclusive panjabi.', 'Men\'s Panjabi', 'images/Product/26/', 'Maroon', 2100),
(27, 'Black Punjabi', 'Black panjabi for your Eid collection.', 'Men\'s Panjabi', 'images/Product/27/', 'Black', 1500),
(28, 'Red Flower Gown', 'Red gown for exclusive party wear.', 'Women\'s Dress', 'images/Product/28/', 'Red', 12000),
(31, 'Pink Gown', 'Pink soft gorgette gown with heavy work for exclusive party wear', 'Women\'s Dress', 'images/Product/31/', 'Pink', 15000),
(32, 'Brown Three Piece', 'Brown frock with red gorgette stole for exlusive party wear', 'Women\'s Three-Piece', 'images/Product/32/', 'Brown', 10000),
(33, 'Congo Pink three piece', 'Congo pink soft gorgette three piece with simple work for women', 'Women\'s Three-Piece', 'images/Product/33/', 'Congo Pink', 10000),
(34, 'Navyblue Casual Shirt', 'Navyblue Casual cotton shirt for summer collection', 'Men\'s Shirt', 'images/Product/34/', 'Navyblue', 1250),
(35, 'Skyblue T shirt', 'Skyblue comfortable t-shirt for summer collection', 'Men\'s T-shirt', 'images/Product/35/', 'Skyblue', 850),
(36, 'Red T shirt', 'Red full sleeve comfortable t-shirt for winter collection', 'Men\'s T-shirt', 'images/Product/36/', 'Red', 950),
(37, 'White T shirt', 'White comfortable half sleeve t-shirt for girls', 'Women\'s T-shirt', 'images/Product/37/', 'White', 1050),
(38, 'Navyblue Trouser', 'Navyblue comfortable trouser with superman logo', 'Men\'s Pant', 'images/Product/38/', 'Navyblue', 500),
(39, 'Grey Pant', 'Grey comfortable explusive pant for men', 'Men\'s Pant', 'images/Product/39/', 'Grey', 1000),
(40, 'Black Pant', 'Black exclusive palazzo pant for girls', 'Women\'s Pant', 'images/Product/40/', 'Black', 1200),
(41, 'White Shirt', 'White full sleeve cotton shirt for women', 'Women\'s Shirt', 'images/Product/41/', 'White', 1250),
(42, 'Black converse Shoe', 'New black converse shoe for men', 'Men\'s Shoes', 'images/Product/42/', 'Black', 1500),
(43, 'Red Shoe', 'Red exclusive high stiletto ladies shoe for party wear', 'Women\'s Shoes', 'images/Product/43/', 'Red', 2500),
(44, 'Balck Belt', 'Exclusive black leather belt for men', 'Accessories', 'images/Product/44/', 'Black', 1200),
(45, 'Black Tie', 'Exclusive black tie for men', 'Accessories', 'images/Product/45/', 'Black', 850),
(46, 'Grey Socks', 'Grey comfortable socks', 'Accessories', 'images/Product/46/', 'Grey', 300),
(47, 'Black Sunglass', 'Exclusive sunglass for summer collection', 'Accessories', 'images/Product/47/', 'Black', 1200);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `dobday` varchar(3) NOT NULL,
  `dobmonth` varchar(3) NOT NULL,
  `dobyear` varchar(5) NOT NULL,
  `phoneno` int(11) DEFAULT NULL,
  `Type` varchar(20) DEFAULT NULL,
  `status` varchar(8) NOT NULL DEFAULT 'VALID'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `email`, `gender`, `dobday`, `dobmonth`, `dobyear`, `phoneno`, `Type`, `status`) VALUES
(16, 'Admin Guy', '3e4c47afdaa994bff2aecb22fb41429f', 'admin@admin.com', 'Male', '5', '6', '1994', NULL, 'Admin', 'VALID'),
(39, 'Sales Woman', '4705f7a5180f2eb38dd8d213e3c840e4', 'salesman@salesman.com', 'Female', '19', '12', '1984', NULL, 'Salesman', 'VALID'),
(38, 'Marketer Mam', '80c6c1426f0c5f0aef06bff08613adb4', 'marketer@marketer.com', 'Female', '13', '8', '1994', NULL, 'Marketer', 'VALID'),
(37, 'Accountant Guy', '4d4325e72599d400ea6a249474cd8bb6', 'accountant@accountant.com', 'Female', '14', '11', '2000', NULL, 'Accountant', 'VALID'),
(36, 'Customer Guy', '9515115bd6386dc163f55b2333f3a7ef', 'customer@customer.com', 'Male', '12', '10', '1990', NULL, 'Customer', 'VALID');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
