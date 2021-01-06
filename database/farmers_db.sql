-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2020 at 09:33 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `farmers_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_categories`
--

CREATE TABLE `tbl_categories` (
  `cid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_categories`
--

INSERT INTO `tbl_categories` (`cid`, `name`, `description`, `created_at`) VALUES
(3, 'Fruits', 'Fruits items contains 26 items', '2020-11-23 17:26:06'),
(4, 'Vegetables', 'Vegetables items contains 40 items', '2020-11-23 17:27:24'),
(5, 'Dairy', 'Dairy items contains 10 items', '2020-11-23 17:27:47');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_products`
--

CREATE TABLE `tbl_products` (
  `pid` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) NOT NULL,
  `cost_price` decimal(10,0) NOT NULL,
  `sell_price` decimal(10,0) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `total_qty` decimal(10,0) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_products`
--

INSERT INTO `tbl_products` (`pid`, `cid`, `type`, `name`, `description`, `cost_price`, `sell_price`, `unit`, `total_qty`, `created_at`, `updated_at`, `created_by`) VALUES
(1, 1, '2', 'Pumpkin', 'Sweet vegetable and preffered for halooween.', '250', '500', 'Kg', '10', '2020-11-23 04:54:07', '2020-11-23 10:32:01', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stocks`
--

CREATE TABLE `tbl_stocks` (
  `sid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `stock_in_dt` datetime NOT NULL,
  `stock_out_dt` datetime NOT NULL,
  `unit` varchar(100) NOT NULL,
  `qnty` double(10,2) NOT NULL,
  `remain_qty` decimal(10,2) NOT NULL,
  `total_qty` decimal(10,2) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_stocks`
--

INSERT INTO `tbl_stocks` (`sid`, `pid`, `stock_in_dt`, `stock_out_dt`, `unit`, `qnty`, `remain_qty`, `total_qty`, `created_at`, `created_by`) VALUES
(2, 1, '1991-05-15 10:30:21', '2015-08-21 15:15:45', 'Kg', 150.00, '15.00', '135.00', '2020-11-23 10:49:32', 0),
(3, 1, '1991-05-15 10:30:21', '2015-08-21 15:15:45', 'Kg', 150.00, '15.00', '135.00', '2020-11-23 10:50:26', 1),
(4, 1, '1991-05-15 10:30:21', '2015-08-21 15:15:45', 'Kg', 150.00, '15.00', '135.00', '2020-11-23 19:43:31', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `uid` int(11) NOT NULL,
  `user_type` int(1) NOT NULL COMMENT '1. Admin, 2. Farmer, 3. Customer, 4. Coordinator',
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `age` int(3) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `town` varchar(255) NOT NULL,
  `country` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`uid`, `user_type`, `username`, `password`, `name`, `age`, `gender`, `phone`, `address`, `town`, `country`, `created_at`, `created_by`) VALUES
(2, 1, 'alok999', 'daf5160445c6a2490c0bfb53b799f174e8d5d0c6', 'Alok Das', 15, 'Male', '8956235414', 'Village: Jeoldanga, Banipur, Habra, West Bengal, 743333', 'Kolkata', 'India', '2020-11-22 13:55:34', 1),
(4, 1, 'alokdas4all@gmail.com', 'daf5160445c6a2490c0bfb53b799f174e8d5d0c6', 'Alok Das', 15, 'Male', '8956235414', 'Village: Jeoldanga, Banipur, Habra, West Bengal, 743333', 'Habra', 'India', '2020-11-22 16:25:38', 1),
(5, 1, 'alokdas2all@gmail.com', '123', 'Alok Das', 29, 'Male', '8936896526', 'Banipur, 24 paragans(N)', 'Odivelas', 'Portugal', '2020-11-23 14:18:50', 0),
(6, 2, 'mithundas4all@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Mithun Das', 20, 'Male', '7897894562', 'jadavpur, 24pgs\r\nJadavpur', 'Vila Franca de Xira', 'Portugal', '2020-11-23 14:33:39', 0),
(7, 3, 'ramesh12@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Ramesh Kumar', 45, 'Male', '7897897890', 'Banipur, \r\nHabra', 'Odivelas', 'Portugal', '2020-11-23 15:08:26', 0),
(8, 2, 'alax@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Alax Dow', 45, 'Male', '7897895263', 'Cicilia, \r\nPortugal, 745126', 'Fornos de Algodres', 'Portugal', '2020-11-23 17:45:11', 0),
(9, 3, 'alok3@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Alok Das', 56, 'Male', '8978975685', 'Barasat, 24 parganas(N), West Bengal , India', 'Gondomar', 'Portugal', '2020-11-24 10:56:34', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_categories`
--
ALTER TABLE `tbl_categories`
  ADD PRIMARY KEY (`cid`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `tbl_products`
--
ALTER TABLE `tbl_products`
  ADD PRIMARY KEY (`pid`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `tbl_stocks`
--
ALTER TABLE `tbl_stocks`
  ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_categories`
--
ALTER TABLE `tbl_categories`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_products`
--
ALTER TABLE `tbl_products`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_stocks`
--
ALTER TABLE `tbl_stocks`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
