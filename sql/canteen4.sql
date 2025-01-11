-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 11, 2025 at 02:59 AM
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
-- Database: `canteen4`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `user_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `product_name` varchar(45) NOT NULL,
  `qty` int(11) NOT NULL,
  `User` varchar(45) NOT NULL,
  `restaurant_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `ID` int(12) NOT NULL,
  `User` varchar(60) NOT NULL,
  `Pass` varchar(50) NOT NULL,
  `Fname` varchar(100) NOT NULL,
  `Lname` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Phone` int(11) NOT NULL,
  `restaurant_name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`ID`, `User`, `Pass`, `Fname`, `Lname`, `Email`, `Phone`, `restaurant_name`) VALUES
(1, 'admin', 'admin', 'Administrator', 'Admin', 'admin@lpunetwork.edu.ph', 923456789, ''),
(2, 'admin2', 'admin2', 'Administrator 2', 'Admin2', 'admin2@lpunetwork.edu.ph', 986543434, ''),
(3, '2020-2-00179', 'password', 'Gionne', 'Abogado', 'gionne@lpunetwork.edu.ph', 916291241, ''),
(4, '2020-2-02003', 'password', 'Luis', 'Mayrina', 'Luis@lpunetwork.edu.ph', 916291421, ''),
(5, '2020-2-00658', 'password', 'Melvin', 'Vibar', 'melvin@lpunetwork.edu.ph', 964564532, ''),
(6, '2020-2-01524', 'password', 'Gelvin', 'Gozar', 'gelvin@lpunetwork.edu.ph', 942343242, ''),
(7, 'turksadmin', 'turksadmin', 'turksadmin', 'turksadmin', '', 0, 'Turks'),
(8, 'waffleadmin', 'waffleadmin', 'WaffleAdmin', 'WaffleAdmin', '', 0, 'Waffle Time');

-- --------------------------------------------------------

--
-- Table structure for table `order_list`
--

CREATE TABLE `order_list` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `payment_method` varchar(100) NOT NULL,
  `total_amount` float NOT NULL,
  `status` varchar(100) NOT NULL,
  `order_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `User` varchar(45) NOT NULL,
  `restaurant_name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_list`
--

INSERT INTO `order_list` (`order_id`, `user_id`, `payment_method`, `total_amount`, `status`, `order_time`, `User`, `restaurant_name`) VALUES
(218, 4, 'maya', 37, 'Claimed', '2023-05-01 20:53:30', '2020-2-02003', ''),
(219, 4, 'maya', 148.5, 'Claimable', '2023-05-06 07:53:32', '2020-2-02003', ''),
(220, 4, 'maya', 74.5, 'Claimable', '2023-05-06 12:00:23', '2020-2-02003', ''),
(227, 4, 'maya', 85.99, 'To Pay', '2023-04-30 08:46:18', '2020-2-02003', ''),
(232, 4, 'gcash', 85.99, 'Bruh', '2023-04-30 10:07:14', '2020-2-02003', ''),
(233, 4, 'gcash', 85.99, 'To Pay', '2023-04-30 10:19:34', '2020-2-02003', ''),
(234, 4, 'gcash', 37, 'To Pay', '2023-04-30 12:26:34', '2020-2-02003', ''),
(235, 4, 'gcash', 37.5, 'To Pay', '2023-04-30 12:32:50', '2020-2-02003', ''),
(236, 4, 'gcash', 37, 'To Pay', '2023-04-30 12:33:13', '2020-2-02003', ''),
(237, 4, 'gcash', 37, 'To Pay', '2023-04-30 12:33:25', '2020-2-02003', ''),
(243, 4, 'gcash', 74, 'To Pay', '2023-05-01 02:47:45', '2020-2-02003', ''),
(244, 4, 'gcash', 37, 'To Pay', '2023-05-01 03:25:41', '2020-2-02003', ''),
(245, 4, 'gcash', 37, 'To Pay', '2023-05-01 03:26:00', '2020-2-02003', ''),
(246, 4, 'gcash', 37.5, 'To Pay', '2023-05-01 03:26:29', '2020-2-02003', ''),
(247, 4, 'gcash', 37.5, 'To Pay', '2023-05-01 03:27:11', '2020-2-02003', ''),
(249, 4, 'gcash', 74, 'To Pay', '2023-05-01 06:36:06', '2020-2-02003', ''),
(252, 4, 'gcash', 37, 'To Pay', '2023-05-01 11:04:22', '2020-2-02003', ''),
(253, 4, 'gcash', 37, 'To Pay', '2023-05-01 14:12:04', '2020-2-02003', ''),
(254, 4, 'gcash', 85.99, 'To Pay', '2023-05-01 15:08:54', '2020-2-02003', ''),
(262, 1, 'gcash', 37.5, 'To Pay', '2023-05-05 10:45:59', 'admin', ''),
(263, 1, 'gcash', 37.5, 'To Pay', '2023-05-05 10:46:22', 'admin', ''),
(272, 4, 'gcash', 37.5, 'Paid', '2023-05-15 08:18:43', '2020-2-02003', ''),
(273, 4, 'gcash', 37.5, 'Pending', '2023-05-06 01:40:10', '2020-2-02003', ''),
(274, 4, 'gcash', 37.5, 'Pending', '2023-05-06 01:40:25', '2020-2-02003', ''),
(275, 4, 'gcash', 37.5, 'Pending', '2023-05-06 01:51:22', '2020-2-02003', ''),
(276, 4, 'gcash', 37.5, 'Pending', '2023-05-06 01:52:48', '2020-2-02003', ''),
(277, 4, 'gcash', 37.5, 'Pending', '2023-05-06 01:53:33', '2020-2-02003', ''),
(278, 4, 'gcash', 37.5, 'Pending', '2023-05-06 01:55:27', '2020-2-02003', ''),
(279, 4, 'gcash', 37.5, 'Pending', '2023-05-06 01:57:01', '2020-2-02003', ''),
(280, 4, 'gcash', 37.5, 'Pending', '2023-05-06 02:02:29', '2020-2-02003', ''),
(281, 4, 'gcash', 37.5, 'Pending', '2023-05-06 02:04:01', '2020-2-02003', ''),
(282, 4, 'gcash', 37.5, 'Pending', '2023-05-06 02:10:46', '2020-2-02003', ''),
(283, 4, 'gcash', 37.5, 'Pending', '2023-05-06 02:11:06', '2020-2-02003', ''),
(286, 4, 'gcash', 85.99, 'To Pay', '2023-05-06 11:34:54', '2020-2-02003', ''),
(287, 4, 'gcash', 85.99, 'To Pay', '2023-05-06 16:03:16', '2020-2-02003', ''),
(288, 4, 'gcash', 37.5, 'To Pay', '2023-05-06 16:08:22', '2020-2-02003', ''),
(289, 4, 'gcash', 37.5, 'To Pay', '2023-05-06 16:08:34', '2020-2-02003', ''),
(290, 4, 'gcash', 37.5, 'To Pay', '2023-05-06 16:14:39', '2020-2-02003', ''),
(291, 4, 'gcash', 37.5, 'Cancelled', '2023-05-06 16:16:24', '2020-2-02003', ''),
(292, 4, 'gcash', 37.5, 'Cancelled', '2023-05-06 16:16:51', '2020-2-02003', ''),
(293, 3, 'gcash', 85.99, 'Pending', '2023-05-08 08:09:19', '2020-2-00179', 'Turks'),
(294, 1, 'gcash', 80, 'Pending', '2023-05-22 09:26:53', 'admin', 'Turks'),
(295, 1, 'gcash', 160, 'Pending', '2023-05-22 09:27:57', 'admin', 'Turks'),
(296, 4, 'cash', 688.5, 'Pending', '2025-01-10 15:52:37', '2020-2-02003', 'Turks');

-- --------------------------------------------------------

--
-- Table structure for table `order_products`
--

CREATE TABLE `order_products` (
  `ID` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_name` varchar(45) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `product_price` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_products`
--

INSERT INTO `order_products` (`ID`, `order_id`, `product_name`, `product_id`, `qty`, `product_price`) VALUES
(0, 65, '', 1, 0, 0),
(0, 65, '', 2, 0, 0),
(0, 65, '', 5, 0, 0),
(0, 66, '', 1, 0, 0),
(0, 66, '', 2, 0, 0),
(0, 66, '', 5, 0, 0),
(0, 67, '', 1, 0, 0),
(0, 67, '', 2, 0, 0),
(0, 67, '', 5, 0, 0),
(0, 68, '', 1, 0, 0),
(0, 68, '', 2, 0, 0),
(0, 68, '', 5, 0, 0),
(0, 69, '', 0, 0, 0),
(0, 69, '', 0, 0, 0),
(0, 69, '', 0, 0, 0),
(0, 70, '', 1, 1, 0),
(0, 70, '', 2, 1, 0),
(0, 70, '', 5, 2, 0),
(0, 71, '', 1, 1, 0),
(0, 71, '', 2, 1, 0),
(0, 71, '', 5, 2, 0),
(0, 72, '', 1, 1, 0),
(0, 72, '', 2, 1, 0),
(0, 72, '', 5, 2, 0),
(0, 73, '', 1, 1, 0),
(0, 73, '', 2, 1, 0),
(0, 73, '', 5, 2, 0),
(0, 74, '', 1, 1, 0),
(0, 74, '', 2, 1, 0),
(0, 74, '', 5, 2, 0),
(0, 75, '', 1, 1, 0),
(0, 75, '', 2, 1, 0),
(0, 75, '', 5, 2, 0),
(0, 76, '', 1, 1, 0),
(0, 76, '', 2, 1, 0),
(0, 76, '', 5, 2, 0),
(0, 77, '', 1, 4, 0),
(0, 77, '', 2, 1, 0),
(0, 77, '', 5, 6, 0),
(0, 78, '', 1, 4, 0),
(0, 78, '', 2, 1, 0),
(0, 78, '', 5, 6, 0),
(0, 79, '', 5, 1, 0),
(0, 79, '', 2, 1, 0),
(0, 79, '', 1, 5, 0),
(0, 80, '', 1, 1, 0),
(0, 80, '', 2, 1, 0),
(0, 81, '', 2, 4, 0),
(0, 82, '', 1, 9, 0),
(0, 82, '', 5, 4, 0),
(0, 82, '', 2, 1, 0),
(0, 83, '', 2, 5, 0),
(0, 83, '', 1, 5, 0),
(0, 83, '', 5, 1, 0),
(0, 84, '', 5, 1, 0),
(0, 84, '', 2, 1, 0),
(0, 84, '', 1, 5, 0),
(0, 85, '', 1, 10, 0),
(0, 86, '', 1, 10, 0),
(0, 87, '', 2, 1, 0),
(0, 87, '', 1, 4, 0),
(0, 88, '', 1, 5, 0),
(0, 89, '', 1, 1, 0),
(0, 89, '', 2, 1, 0),
(0, 90, '', 1, 6, 0),
(0, 154, '', 2, 5, 0),
(0, 155, '', 5, 1, 0),
(0, 156, '', 1, 1, 0),
(0, 157, '', 1, 3, 0),
(0, 162, '', 2, 1, 0),
(0, 164, '', 5, 1, 0),
(0, 165, '', 1, 1, 0),
(0, 166, '', 2, 1, 0),
(0, 167, '', 5, 1, 0),
(0, 168, '', 1, 1, 0),
(0, 169, '', 5, 1, 0),
(0, 171, '', 1, 1, 0),
(0, 171, '', 5, 1, 0),
(0, 172, '', 2, 1, 0),
(0, 182, '', 1, 1, 0),
(0, 182, '', 2, 1, 0),
(0, 186, '', 2, 1, 0),
(0, 187, '', 2, 1, 0),
(0, 188, '', 5, 4, 0),
(0, 188, '', 2, 3, 0),
(0, 188, '', 1, 3, 0),
(0, 189, '', 2, 1, 0),
(0, 189, '', 1, 6, 0),
(0, 189, '', 5, 1, 0),
(0, 190, '', 2, 1, 0),
(0, 192, '', 2, 2, 0),
(0, 192, '', 5, 2, 0),
(0, 192, '', 1, 1, 0),
(0, 193, '', 2, 1, 0),
(0, 194, '', 2, 1, 0),
(0, 194, '', 5, 6, 0),
(0, 194, '', 1, 5, 0),
(0, 195, '', 5, 1, 0),
(0, 196, '', 2, 1, 0),
(0, 197, '', 1, 1, 0),
(0, 197, '', 2, 1, 0),
(0, 198, '', 1, 1, 0),
(0, 198, '', 2, 1, 0),
(0, 198, '', 5, 1, 0),
(0, 199, '', 1, 1, 0),
(0, 199, '', 2, 1, 0),
(0, 199, '', 5, 1, 0),
(0, 200, '', 1, 1, 0),
(0, 201, '', 1, 1, 0),
(0, 202, '', 1, 1, 0),
(0, 203, '', 1, 1, 0),
(0, 203, '', 2, 1, 0),
(0, 203, '', 5, 1, 0),
(0, 204, '', 2, 1, 0),
(0, 205, '', 1, 1, 0),
(0, 205, '', 2, 1, 0),
(0, 206, '', 1, 1, 0),
(0, 206, '', 2, 1, 0),
(0, 207, '', 1, 1, 0),
(0, 208, '', 1, 1, 0),
(0, 208, '', 2, 1, 0),
(0, 209, '', 1, 1, 0),
(0, 210, '', 1, 1, 0),
(0, 211, '', 1, 1, 0),
(0, 212, 'Belgian Waffle', 1, 1, 0),
(0, 212, 'Choco Waffle', 2, 1, 0),
(0, 213, 'Beef Pita', 8, 1, 0),
(0, 214, 'Beef Pita', 8, 1, 0),
(0, 215, 'Beef Pita', 8, 1, 0),
(0, 216, 'Beef Pita', 8, 1, 0),
(0, 217, 'H&C Waffle', 5, 10, 0),
(0, 217, 'Choco Waffle', 2, 10, 0),
(0, 217, 'Belgian Waffle', 1, 10, 0),
(0, 218, 'H&C Waffle', 5, 1, 0),
(0, 219, 'H&C Waffle', 5, 1, 0),
(0, 219, 'Belgian Waffle', 1, 1, 0),
(0, 219, 'Choco Waffle', 2, 2, 0),
(0, 222, 'Belgian Waffle', 1, 1, 0),
(0, 222, 'H&C Waffle', 5, 1, 0),
(0, 223, 'Belgian Waffle', 1, 1, 38),
(0, 223, 'H&C Waffle', 5, 1, 37),
(0, 224, 'Belgian Waffle', 1, 3, 38),
(0, 224, 'H&C Waffle', 5, 1, 37),
(0, 225, 'H&C Waffle', 5, 1, 37),
(0, 226, 'Beef Pita', 8, 1, 86),
(0, 227, 'Beef Pita', 8, 1, 86),
(0, 229, 'Beef Pita', 8, 1, 86),
(0, 230, 'Beef Pita', 8, 1, 86),
(0, 231, 'Beef Pita', 8, 1, 86),
(0, 232, 'Beef Pita', 8, 1, 86),
(0, 233, 'Beef Pita', 8, 1, 86),
(0, 234, 'Choco Waffle', 2, 1, 37),
(0, 235, 'Belgian Waffle', 1, 1, 38),
(0, 236, 'Choco Waffle', 2, 1, 37),
(0, 237, 'Choco Waffle', 2, 1, 37),
(0, 238, 'Choco Waffle', 2, 1, 37),
(0, 239, 'Choco Waffle', 2, 1, 37),
(0, 240, 'Choco Waffle', 2, 1, 37),
(0, 241, 'Choco Waffle', 2, 3, 37),
(0, 242, 'Choco Waffle', 2, 1, 37),
(0, 242, 'Belgian Waffle', 1, 1, 38),
(0, 242, 'H&C Waffle', 5, 1, 37),
(0, 243, 'Choco Waffle', 2, 2, 37),
(0, 244, 'H&C Waffle', 5, 1, 37),
(0, 245, 'Choco Waffle', 2, 1, 37),
(0, 246, 'Belgian Waffle', 1, 1, 38),
(0, 247, 'Belgian Waffle', 1, 1, 38),
(0, 248, 'Choco Waffle', 2, 1, 37),
(0, 249, 'Choco Waffle', 2, 2, 37),
(0, 250, 'Choco Waffle', 2, 61, 37),
(0, 251, 'Choco Waffle', 2, 93, 37),
(0, 252, 'H&C Waffle', 5, 1, 37),
(0, 253, 'H&C Waffle', 5, 1, 37),
(0, 254, 'Beef Pita', 8, 1, 86),
(0, 255, 'Belgian Waffle', 1, 1, 38),
(0, 256, 'Beef Pita', 8, 1, 86),
(0, 257, 'Belgian Waffle', 1, 1, 38),
(0, 258, 'Belgian Waffle', 1, 1, 38),
(0, 259, 'Belgian Waffle', 1, 1, 38),
(0, 259, 'H&C Waffle', 5, 1, 37),
(0, 260, 'Belgian Waffle', 1, 6, 38),
(0, 261, 'Belgian Waffle', 1, 1, 38),
(0, 262, 'Belgian Waffle', 1, 1, 38),
(0, 265, 'Belgian Waffle', 1, 1, 38),
(0, 266, 'Beef Pita', 8, 1, 86),
(0, 267, 'Beef Pita', 8, 1, 86),
(0, 268, 'Belgian Waffle', 1, 1, 38),
(0, 269, 'Belgian Waffle', 1, 1, 38),
(0, 270, 'Belgian Waffle', 1, 1, 38),
(0, 271, 'Belgian Waffle', 1, 1, 38),
(0, 272, 'Belgian Waffle', 1, 1, 38),
(0, 273, 'Belgian Waffle', 1, 1, 38),
(0, 274, 'Belgian Waffle', 1, 1, 38),
(0, 275, 'Belgian Waffle', 1, 1, 38),
(0, 276, 'Belgian Waffle', 1, 1, 38),
(0, 277, 'Belgian Waffle', 1, 1, 38),
(0, 278, 'Belgian Waffle', 1, 1, 38),
(0, 279, 'Belgian Waffle', 1, 1, 38),
(0, 280, 'Belgian Waffle', 1, 1, 38),
(0, 281, 'Belgian Waffle', 1, 1, 38),
(0, 282, 'Belgian Waffle', 1, 1, 38),
(0, 283, 'Belgian Waffle', 1, 1, 38),
(0, 284, 'Belgian Waffle', 1, 1, 38),
(0, 285, 'Belgian Waffle', 1, 1, 38),
(0, 286, 'Beef Pita', 8, 1, 86),
(0, 287, 'Beef Pita', 8, 1, 86),
(0, 288, 'Belgian Waffle', 1, 1, 38),
(0, 290, 'Belgian Waffle', 1, 1, 38),
(0, 292, 'Belgian Waffle', 1, 1, 38),
(0, 293, 'Beef Pita', 8, 1, 86),
(0, 294, 'Chicken Pita', 13, 1, 80),
(0, 295, 'Chicken Pita', 13, 2, 80),
(0, 296, 'Beef Pita', 14, 1, 80),
(0, 296, 'Beef Rice Bowl', 15, 1, 101),
(0, 296, 'Chicken Rice Bowl', 19, 5, 102);

-- --------------------------------------------------------

--
-- Table structure for table `product_list`
--

CREATE TABLE `product_list` (
  `product_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `product_desc` varchar(100) NOT NULL,
  `price` float NOT NULL,
  `restaurant` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `feature` tinyint(1) NOT NULL COMMENT '1 = featured, 0 = not',
  `img_path` text NOT NULL,
  `avl` tinyint(4) NOT NULL COMMENT '1 = Available, 0 = N.A.',
  `stock` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_list`
--

INSERT INTO `product_list` (`product_id`, `name`, `product_desc`, `price`, `restaurant`, `category`, `feature`, `img_path`, `avl`, `stock`) VALUES
(1, 'Belgian Waffle', 'Our classic aromatic waffle with a premium chocolate filling ', 37, 'Waffle Time', 'Waffle Dogs', 1, 'waffle.jpg', 1, 18),
(2, 'Choco Waffle', 'perfect & sweet chocolate filling! ', 37, 'Waffle Time', 'Drinks', 0, 'chocolatewaffle.jpg', 1, 0),
(5, 'H&C Waffle', 'perfectly delicious ham & cheese ', 37, 'Waffle Time', 'Waffle Dogs', 0, 'hamcheesewaffle.jpg', 1, 72),
(6, 'DBL CB', 'two 100% pure all beef patties seasoned with just a pinch of salt and pepper.', 65.75, 'Chowking', 'Burger', 1, 'burger.jpg', 0, 69),
(7, 'Japanese Siomai with Rice and Drinks', 'comes with rice and drinks', 55.5, 'House of Dimsum', 'Siomai & Drinks ', 1, 'siomai.jpg', 0, 30),
(13, 'Chicken Pita', 'Enjoy the irresistibly tender chicken and fresh ingredients in this wrap.', 80, 'Turks', 'Pita Doner Meals', 1, 'chicken-pita.jpg', 1, 17),
(14, 'Beef Pita', 'Juicy beef wrapped in warm pita bread with fresh vegetables and sauce.', 80, 'Turks', 'Pita Doner Meals', 1, 'beef-pita.jpg', 1, 29),
(15, 'Beef Rice Bowl', 'Beef rice bowl, a satisfying mix of rice and tender beef.', 101, 'Turks', 'Pita Doner Meals', 0, '678117e2307051.74753937.jpg', 1, 89),
(16, 'Beef Rice Box', 'This rice box meal features tender beef cooked to perfection, served with rice for a flavorful meal.', 154, 'Turks', 'Rice Box', 1, 'beef-rice-box.jpg', 1, 100),
(18, 'Bottled Water', '500 Grams', 30, 'Turks', 'Beverage', 0, 'bottled-water-turks.jpg', 1, 100),
(19, 'Chicken Rice Bowl', 'Elevate your mealtime with this chicken rice bowl.', 101.5, 'Turks', 'Pita Doner Meals', 0, 'chicken-rice-bowl.jpg', 1, 79),
(20, 'Chicken Rice Box', 'Convenient chicken rice box, ideal for a quick and hearty meal on the go.', 154, 'Turks', 'Rice Box', 0, 'chicken-rice-box.jpg', 1, 92);

-- --------------------------------------------------------

--
-- Table structure for table `restaurant_list`
--

CREATE TABLE `restaurant_list` (
  `ID` int(30) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `img_path` text NOT NULL,
  `img_path2` text NOT NULL,
  `target` text NOT NULL,
  `avl` tinyint(1) NOT NULL COMMENT '1 = Available, 0 = N.A.	',
  `opening_time` time NOT NULL,
  `closing_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `restaurant_list`
--

INSERT INTO `restaurant_list` (`ID`, `Name`, `img_path`, `img_path2`, `target`, `avl`, `opening_time`, `closing_time`) VALUES
(2, 'Turks', 'turks.png', 'turks-cover.jpg', 'Turks', 0, '06:00:00', '23:59:00'),
(3, 'Chowking', 'chowking.png', '', 'Chowking', 0, '09:00:00', '23:00:00'),
(14, 'Waffle Time', 'waffletime.png', '', 'Waffle Time', 0, '06:00:00', '23:00:00'),
(17, 'KIMPOP', 'default.png', 'defaultbg.png', 'KIMPOP', 0, '06:00:00', '23:00:00'),
(18, 'Ava Cakery', 'default.png', 'defaultbg.png', 'Ava Cakery', 0, '06:00:00', '23:00:00'),
(20, 'House of Dimsum', '6450301a096889.88775503.jpg', 'defaultbg.png', 'House of Dimsum', 0, '06:00:00', '23:00:00'),
(21, 'Kusina ni Tata Rod', 'default.png', '6450308985e5d8.26953357.jpg', 'Kusina ni Tata Rod', 0, '06:00:00', '23:00:00'),
(22, 'Warm Fuzzies', 'default.png', 'defaultbg.png', 'Warm Fuzzies', 0, '06:00:00', '23:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD UNIQUE KEY `user_id_3` (`user_id`,`product_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `user_id_4` (`user_id`,`product_id`),
  ADD KEY `product_id` (`product_id`) USING BTREE;

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `order_list`
--
ALTER TABLE `order_list`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `product_list`
--
ALTER TABLE `product_list`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `restaurant_list`
--
ALTER TABLE `restaurant_list`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `order_list`
--
ALTER TABLE `order_list`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=297;

--
-- AUTO_INCREMENT for table `product_list`
--
ALTER TABLE `product_list`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `restaurant_list`
--
ALTER TABLE `restaurant_list`
  MODIFY `ID` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
