-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 06, 2022 at 01:16 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kashif_project_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_email_otp`
--

CREATE TABLE `account_email_otp` (
  `id` int(11) NOT NULL,
  `code` varchar(10) DEFAULT NULL,
  `type` tinyint(4) DEFAULT NULL COMMENT '1 - customer && 2 - seller',
  `email` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(80) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `cnic` varchar(14) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(40) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `mobile`, `cnic`, `address`, `password`, `image`, `email`, `username`, `date`) VALUES
(3, 'Abdul Basit', '03322388002', '22023902389', 'Saddar Bazar Peshawar  ch# 30', '/3q0Hg==', 'admin_03322388002_aT45T3gnNPTPg8rK3puY.png', 'tcomprog@gmail.com', 'tcomprog@gmail.com', '2022-02-05 19:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `advertisement`
--

CREATE TABLE `advertisement` (
  `id` int(11) NOT NULL,
  `title` varchar(30) DEFAULT NULL,
  `sub_title` varchar(50) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `advertisement`
--

INSERT INTO `advertisement` (`id`, `title`, `sub_title`, `image`) VALUES
(3, 'Women Clothes', '50% discount on all the prd', 'ad_kDpZ9pueURgIrxELATxrFhzMs99pXC_1644864249.jpeg'),
(4, 'New Seasion', 'Women adidas clothes', 'ad_aua8jEel13wZyhGfkpmeFVw3vQhYRm_1644864293.jpeg'),
(5, 'Testing Text', 'Some testing types', 'ad_VFwLPg7zquo68RXn4kuh4KOMgzVrJd_1644864318.jpeg'),
(6, 'Lorem Ipsum is simply', 'Lorem Ipsum has been the ind', 'ad_478vAKFGkzha7H6XJfGU3B5JrZtLDN_1644864370.jpeg'),
(7, 'It is a long established fact', 'It is a long established fact that a reader will b', 'ad_4oEA5yT4Vk7eLVSeBM08bF28e8wjez_1644864479.jpeg'),
(9, 'will be distracted by the read', 'will be distracted by the readable content', 'ad_wb9RsWlHwATeD42Ernlzur8ewq50H3_1644864540.jpeg'),
(10, 'when an unknown printer took a', 'when an unknown printer took a galley of type and ', 'ad_3l2Gt9G56JzSSSA4tbXLDBCPGJcc0B_1644864556.jpeg'),
(12, 'Testing 8', 'Testing 88', 'ad_U1uweemilWk3cLoT4recp0UpSthYn9_1644868720.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `bank_account`
--

CREATE TABLE `bank_account` (
  `id` int(11) NOT NULL,
  `ac_no` varchar(20) DEFAULT NULL,
  `ac_title` varchar(50) DEFAULT NULL,
  `bank_name` varchar(40) DEFAULT NULL,
  `holder_id` int(11) DEFAULT NULL,
  `type` int(11) NOT NULL DEFAULT 0 COMMENT '1 => customer && 0 => investor && 2 investor'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bank_account`
--

INSERT INTO `bank_account` (`id`, `ac_no`, `ac_title`, `bank_name`, `holder_id`, `type`) VALUES
(1, '', '', '', 1, 0),
(2, '983498349834', 'Adnan', 'Faysal bank', 2, 0),
(3, '098349083409', 'Abdul Basit', 'HBL', 3, 0),
(4, '9083409834', '098340983409', 'United Bank', 4, 0),
(5, '0893409834', 'Testing', 'Testing', 5, 0),
(6, '0989089080', 'Abdul Basit', 'HBL', 6, 0),
(7, '980980980980', 'Kamran Khan', '0983490834', 7, 0),
(8, '21389712938', 'Kamran Khan', 'MCB', 12, 1),
(9, '21389712938', 'Kamran Khan', 'MCB', 12, 1),
(10, '9834983493', 'Abdul Basit', 'Faysal bank', 17, 2),
(11, '9083490384', 'Khan Construction', 'Al Faluya', 11, 2),
(12, '9083490384', 'Khan Construction', 'Al Faluya', 11, 2),
(13, '', '', '', 18, 2);

-- --------------------------------------------------------

--
-- Table structure for table `buy_now_product`
--

CREATE TABLE `buy_now_product` (
  `id` int(11) NOT NULL,
  `prdID` int(11) DEFAULT NULL,
  `cusID` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `discount` int(11) DEFAULT NULL,
  `date` datetime DEFAULT current_timestamp(),
  `status` tinyint(4) DEFAULT 0 COMMENT '0-pending && 1-done',
  `suppID` int(11) NOT NULL,
  `company_earning` int(11) NOT NULL DEFAULT 0,
  `customer_payable` int(11) NOT NULL DEFAULT 0,
  `saller_payable` int(11) NOT NULL DEFAULT 0,
  `color` varchar(100) DEFAULT NULL,
  `size` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `buy_now_product`
--

INSERT INTO `buy_now_product` (`id`, `prdID`, `cusID`, `qty`, `discount`, `date`, `status`, `suppID`, `company_earning`, `customer_payable`, `saller_payable`, `color`, `size`) VALUES
(9, 28, 12, 1, 0, '2022-03-24 02:51:00', 1, 18, 60, 300, 240, NULL, NULL),
(10, 28, 12, 1, 0, '2022-03-25 00:19:41', 1, 18, 60, 300, 240, NULL, NULL),
(11, 28, 12, 1, 0, '2022-03-25 00:19:42', 1, 18, 60, 300, 240, NULL, NULL),
(12, 27, 12, 1, 0, '2022-03-25 00:19:50', 0, 18, 30, 300, 270, NULL, NULL),
(13, 27, 12, 1, 0, '2022-03-25 00:19:53', 0, 18, 30, 300, 270, NULL, NULL),
(14, 27, 12, 1, 0, '2022-03-26 01:26:21', 0, 18, 30, 300, 270, NULL, NULL),
(15, 27, 12, 1, 0, '2022-03-26 01:26:41', 0, 18, 30, 300, 270, NULL, NULL),
(16, 28, 12, 1, 0, '2022-03-26 15:01:59', 0, 18, 60, 300, 240, NULL, NULL),
(17, 28, 12, 1, 0, '2022-03-26 15:02:34', 0, 18, 60, 300, 240, NULL, NULL),
(18, 28, 12, 1, 0, '2022-03-26 15:08:48', 0, 18, 60, 300, 240, 'blue', '44');

-- --------------------------------------------------------

--
-- Table structure for table `buy_now_saller_account`
--

CREATE TABLE `buy_now_saller_account` (
  `id` int(11) NOT NULL,
  `amount` bigint(20) DEFAULT 0 COMMENT 'This amount should be paid to company by seller',
  `sallID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `buy_now_saller_account`
--

INSERT INTO `buy_now_saller_account` (`id`, `amount`, `sallID`) VALUES
(2, 0, 18);

-- --------------------------------------------------------

--
-- Table structure for table `buy_now_saller_account_tran`
--

CREATE TABLE `buy_now_saller_account_tran` (
  `id` int(11) NOT NULL,
  `date` datetime DEFAULT current_timestamp(),
  `cmp_earning` int(11) DEFAULT NULL,
  `buy_now_id` int(11) DEFAULT NULL,
  `sellID` int(11) NOT NULL,
  `prdID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `buy_now_saller_account_tran`
--

INSERT INTO `buy_now_saller_account_tran` (`id`, `date`, `cmp_earning`, `buy_now_id`, `sellID`, `prdID`) VALUES
(3, '2022-03-25 01:26:25', 60, 10, 18, 28),
(4, '2022-03-26 17:22:48', 60, 11, 18, 28);

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `addedBy` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `name`, `addedBy`) VALUES
(1, 'nokia', 11),
(2, 'infinix', 0),
(3, 'samsung', 0),
(4, 'apple', 0),
(5, 'hp systems', 0),
(6, 'hair laptop', 0),
(7, 'honda', 0),
(8, 'testing', 11),
(9, 'demo', 11),
(10, 'testing 11122', 18);

-- --------------------------------------------------------

--
-- Table structure for table `fav_product`
--

CREATE TABLE `fav_product` (
  `id` int(11) NOT NULL,
  `cusID` int(11) DEFAULT NULL,
  `productID` int(11) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fav_product`
--

INSERT INTO `fav_product` (`id`, `cusID`, `productID`, `date`) VALUES
(13, 12, 8, '2022-02-16 19:28:05');

-- --------------------------------------------------------

--
-- Table structure for table `investor`
--

CREATE TABLE `investor` (
  `id` int(11) NOT NULL,
  `fname` varchar(50) DEFAULT NULL,
  `lname` varchar(50) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL COMMENT '1 - male && 2 - female && 3 - other',
  `age` int(11) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `mobile_account` varchar(14) DEFAULT NULL,
  `mobile_account_type` varchar(3) DEFAULT NULL COMMENT '1 - easy paisa && 2 - jazz cash && 3 - mobi cash',
  `cnic` varchar(14) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0 => active\r\n1 => block',
  `type` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0 => investor && 1 => master team',
  `image` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `investor`
--

INSERT INTO `investor` (`id`, `fname`, `lname`, `email`, `mobile`, `gender`, `age`, `address`, `mobile_account`, `mobile_account_type`, `cnic`, `date`, `status`, `type`, `image`) VALUES
(6, 'Abdul', 'Basit', 'tcomprog@gmail.com', '03059235079', '1', 22, 'Darra Adam Khel FR Kohat', '0893490384098', '1', '09834903849', '2022-02-07 19:00:00', 0, 0, ''),
(7, 'Kamran', 'Afridid', 'kamran@gmail.com', '0983490834', '1', 23, 'Lahore', '9080980980', '1', '0983409834', '2022-02-07 19:00:00', 0, 1, 'master_team_0983490834_ZwCpJOnmrPjHZhzdY5R9.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `json_data`
--

CREATE TABLE `json_data` (
  `id` int(11) NOT NULL,
  `content` text DEFAULT NULL,
  `status` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `json_data`
--

INSERT INTO `json_data` (`id`, `content`, `status`) VALUES
(1, '{\"name\":\"HWAY\",\"contact\":\"0922811711\",\"email\":\"hway@gmail.com\",\"address\":\"Saddar Bazar Peshawar  ch# 30\",\"page_heading\":\"Free shipping for standard order over $50\"}', 'cmp_info');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `subject` varchar(150) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `type` tinyint(4) DEFAULT NULL COMMENT '1 - customer & 2 - investor & 3 - master team',
  `senderID` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 - unread && 1 - read',
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `subject`, `message`, `type`, `senderID`, `status`, `date`) VALUES
(1, 'Login problem', 'I have problem in access the system', 1, 12, 1, '2022-02-11 19:00:00'),
(3, 'Login problem 11', 'I have problem in access the system', 1, 12, 0, '2022-02-11 19:00:00'),
(5, 'Order problem', 'I am not able to place order', 1, 12, 0, '2022-02-11 19:00:00'),
(6, 'Testing subject', 'Testing message', 1, 12, 0, '2022-02-11 19:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `orderlist`
--

CREATE TABLE `orderlist` (
  `id` int(11) NOT NULL,
  `prdID` int(11) DEFAULT NULL,
  `orderID` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `suppID` int(11) NOT NULL,
  `cusID` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '0 pending && 1 deliver && 2 order return && 3 receive by customer && 4 saller completed && 5 approved by admin',
  `date` timestamp NULL DEFAULT current_timestamp(),
  `paid_status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 - pending && 1 - paid',
  `customer_discount` int(11) NOT NULL DEFAULT 0,
  `company_earning` int(11) NOT NULL DEFAULT 0,
  `supplier_amont` int(11) NOT NULL,
  `color` varchar(100) DEFAULT NULL,
  `size` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orderlist`
--

INSERT INTO `orderlist` (`id`, `prdID`, `orderID`, `price`, `qty`, `suppID`, `cusID`, `status`, `date`, `paid_status`, `customer_discount`, `company_earning`, `supplier_amont`, `color`, `size`) VALUES
(142, 7, 110, 3000, 1, 11, 12, 5, '2022-03-26 20:15:18', 1, 20, 280, 2700, 'blue', '42'),
(143, 30, 110, 333, 1, 6, 12, 5, '2022-03-26 20:15:18', 1, 0, 0, 333, '', ''),
(144, 5, 110, 190, 1, 3, 12, 5, '2022-03-26 20:15:18', 1, 0, 0, 190, '', ''),
(145, 30, 111, 333, 1, 6, 12, 0, '2022-03-27 09:05:57', 0, 0, 0, 333, 'blue', '41'),
(146, 7, 112, 200, 1, 11, 12, 2, '2022-03-27 09:18:01', 0, 0, 100, 100, '', ''),
(147, 7, 113, 200, 1, 11, 12, 0, '2022-03-27 09:20:02', 0, 70, 30, 100, '', ''),
(148, 6, 114, 500, 1, 11, 12, 5, '2022-03-27 09:32:37', 1, 0, 100, 400, '', ''),
(149, 8, 114, 10000, 1, 11, 12, 5, '2022-03-27 09:32:37', 1, 0, 200, 9800, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `total` decimal(9,2) DEFAULT NULL,
  `disount` decimal(9,2) DEFAULT NULL,
  `total_with_disount` decimal(9,2) DEFAULT NULL,
  `date` datetime DEFAULT current_timestamp(),
  `cusID` int(11) DEFAULT NULL,
  `payment_Type` tinyint(4) DEFAULT NULL COMMENT '1 - jazzcash && 2 - cash on dev && 3 - easyPasia',
  `paymentStatus` tinyint(4) DEFAULT NULL COMMENT '99 - pending && 1 paid',
  `orderStatus` tinyint(4) DEFAULT NULL COMMENT '99 - pending && 1 - placed by customer || 2 - view by company || 3 - completed by saller || 4 - complete by admin && 5 Order return',
  `shipment_charges` int(11) NOT NULL,
  `del_address` text NOT NULL,
  `company_earning` int(11) NOT NULL DEFAULT 0,
  `prod_count` int(11) NOT NULL DEFAULT 0 COMMENT 'Number of products in the order'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `total`, `disount`, `total_with_disount`, `date`, `cusID`, `payment_Type`, `paymentStatus`, `orderStatus`, `shipment_charges`, `del_address`, `company_earning`, `prod_count`) VALUES
(110, '3523.00', '20.00', '3653.00', '2022-03-27 01:15:18', 12, 1, 99, 4, 150, 'Testing', 280, 3),
(111, '333.00', '0.00', '643.00', '2022-03-27 14:05:57', 12, 2, 99, 2, 310, 'dfsfsd', 0, 1),
(112, '200.00', '0.00', '510.00', '2022-03-27 14:18:01', 12, 2, 99, 5, 310, 'rtsss', 100, 1),
(113, '200.00', '70.00', '480.00', '2022-03-27 14:20:02', 12, 2, 99, 2, 350, 'ddd', 30, 1),
(114, '10500.00', '0.00', '10810.00', '2022-03-27 14:32:37', 12, 1, 99, 4, 310, 'ddd', 300, 2);

-- --------------------------------------------------------

--
-- Table structure for table `order_return`
--

CREATE TABLE `order_return` (
  `id` int(11) NOT NULL,
  `cusID` int(11) DEFAULT NULL,
  `orderID` int(11) DEFAULT NULL,
  `date` datetime DEFAULT current_timestamp(),
  `comment` text DEFAULT NULL,
  `company_response` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 pending && 1 view by company && 2 approve and respone'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_return`
--

INSERT INTO `order_return` (`id`, `cusID`, `orderID`, `date`, `comment`, `company_response`, `status`) VALUES
(1, 12, 92, '2022-03-15 01:54:47', 'This order contain irrelevent product', 'The task has been completed', 2),
(2, 12, 92, '2022-03-15 02:47:31', 'Testing', 'lkjsdfsdflk', 2),
(3, 12, 38, '2022-03-17 01:32:55', 'ckkdk', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `supplierID` int(11) DEFAULT NULL,
  `categoryID` int(11) DEFAULT NULL,
  `price` decimal(9,2) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `allow_wallet_per` int(11) NOT NULL COMMENT 'Supporting Bonus Adjustable',
  `wallet_amount_type` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1 percentage && 2 value',
  `wallet_amount_status` tinyint(4) DEFAULT NULL COMMENT '1 wallet amount can be &&& 0 can`t be used',
  `content` text DEFAULT NULL,
  `main_img` varchar(150) DEFAULT NULL,
  `other_images` text DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `cmpID` int(11) NOT NULL DEFAULT 0,
  `views` int(11) NOT NULL DEFAULT 0,
  `rating` int(11) NOT NULL DEFAULT 0,
  `order_no` int(11) NOT NULL DEFAULT 0,
  `addedBy` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 - admin && 1 seller',
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1 = approved && 99 = pending',
  `color` varchar(255) DEFAULT NULL,
  `size` varchar(255) DEFAULT NULL,
  `isdelete` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1 deleted'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `title`, `supplierID`, `categoryID`, `price`, `quantity`, `allow_wallet_per`, `wallet_amount_type`, `wallet_amount_status`, `content`, `main_img`, `other_images`, `date`, `cmpID`, `views`, `rating`, `order_no`, `addedBy`, `status`, `color`, `size`, `isdelete`) VALUES
(5, 'Testing Product 1', 11, 6, '190.00', 100, 10, 1, 0, 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 'bgyvShwcNUyDv3b_8_6_1644870604/main_mMgroTWbEwTQHmvRnpXM_1644870604.jpeg', '[\"bgyvShwcNUyDv3b_8_6_1644870604\\/other_img_ciEshRDLhtOmcdI4icr8wsD9b_.jpeg\",\"bgyvShwcNUyDv3b_8_6_1644870604\\/other_img_4EnduiX15RbFKKQb6qsdFjkbx_.jpeg\",\"bgyvShwcNUyDv3b_8_6_1644870604\\/other_img_JlWY1IB40aQjHN5rkqGa7lnXp_.jpeg\"]', '2022-02-14 20:30:04', 4, 104, 9, 14, 0, 1, NULL, NULL, 0),
(6, 'Testing Product 2', 11, 6, '500.00', 200, 20, 1, 1, '<p>Testing Product 2</p>', 'hFc0jLELb8RIiJ7_6_6_1644870649/main_nyZh4nUvXQRXc2W7pMKV_1644870649.jpeg', '[\"hFc0jLELb8RIiJ7_6_6_1644870649\\/other_img_oPsJv5Tzuiy8oiYtnhJ2pR6Up_.jpeg\",\"hFc0jLELb8RIiJ7_6_6_1644870649\\/other_img_ZtjBxUvliwb1sCiRQ8FAm5XcG_.jpeg\",\"hFc0jLELb8RIiJ7_6_6_1644870649\\/other_img_hgsRB3Il8YCwMzJVYH3RwWg0G_.jpeg\",\"hFc0jLELb8RIiJ7_6_6_1644870649\\/other_img_b8ZKScfQavrfJ8pupnDaxdMaF_.jpeg\",\"hFc0jLELb8RIiJ7_6_6_1644870649\\/other_img_soFZ7wteBBHHX9kT2u0hgY5Vp_.jpeg\",\"hFc0jLELb8RIiJ7_6_6_1644870649\\/other_img_Eq90sslFRDKc4diZY3Sn31eRw_.jpeg\",\"hFc0jLELb8RIiJ7_6_6_1644870649\\/other_img_KES9sdSLSGFR9XDj06DW7JZ9Y_.jpeg\",\"hFc0jLELb8RIiJ7_6_6_1644870649\\/other_img_Blwg6sBQQE7SrZeV2p6gwpj0W_.jpeg\"]', '2022-02-14 20:30:49', 7, 177, 0, 15, 0, 1, NULL, NULL, 0),
(7, 'Testing Product 3', 11, 1, '200.00', 40, 100, 2, 1, '<p>Testing Product 3</p>', 'euPHlXyobmxVQSh_6_1_1644870712/main_7lsqHr38zHu8RqPWoENJ_1644870712.jpeg', '[\"euPHlXyobmxVQSh_6_1_1644870712\\/other_img_CrN8IN368g4Pt5BC9pjwZTZC7_.jpeg\",\"euPHlXyobmxVQSh_6_1_1644870712\\/other_img_f0OTAwzMbmpPnvKz4WC2YzNyG_.jpeg\",\"euPHlXyobmxVQSh_6_1_1644870712\\/other_img_nA4MqCH4tg38jdT8Vsqjnsq4A_.jpeg\"]', '2022-02-14 20:31:52', 2, 50, 0, 10, 0, 1, NULL, NULL, 1),
(8, 'Testing Product 4', 11, 6, '10000.00', 30, 200, 2, 1, '<p>Testing Product 4</p>', 'yA1CjeALGOU7Vhq_3_6_1644870764/main_Xt6PdL1QWneidYTU1Jnu_1644870764.jpeg', '[\"yA1CjeALGOU7Vhq_3_6_1644870764\\/other_img_CBmns1ZGqkTYBPT3N2eepEW1V_.jpeg\",\"yA1CjeALGOU7Vhq_3_6_1644870764\\/other_img_qaK4tNIx7A6OW8DsgeYjAmLsi_.jpeg\",\"yA1CjeALGOU7Vhq_3_6_1644870764\\/other_img_TL24X9KifCdBmSZfhODxrJx12_.jpeg\"]', '2022-02-14 20:32:44', 1, 16, 0, 204, 0, 1, NULL, NULL, 0),
(9, 'Testing Product 5', 11, 9, '5000.00', 10, 12, 1, 0, '<p>Testing Product 5</p>', 'ShtrkpDRHGDbwPC_3_9_1644870804/main_vAMAVxkZC3xUyRlymlKp_1644870804.jpeg', '[\"ShtrkpDRHGDbwPC_3_9_1644870804\\/other_img_CQFdPvWu8rPWkLFS4psp2Ec12_.jpeg\",\"ShtrkpDRHGDbwPC_3_9_1644870804\\/other_img_4q8bIApu2d2CkPOb6Sn8mRngc_.jpeg\",\"ShtrkpDRHGDbwPC_3_9_1644870804\\/other_img_HLgpQKS955iCSMMW40cx1EMS5_.jpeg\",\"ShtrkpDRHGDbwPC_3_9_1644870804\\/other_img_bD51XBYShxd58HnTEfGpMX6VO_.jpeg\"]', '2022-02-14 20:33:24', 3, 3, 0, 0, 0, 1, NULL, NULL, 0),
(10, 'Testing Product 6', 11, 6, '500.00', 200, 20, 1, 0, '<p>Testing Product 6</p>', 'Rzzd2CJkk4iT3YJ_6_6_1644870853/main_2XChH21JRPijxCubEQ7l_1644870853.jpeg', '[\"Rzzd2CJkk4iT3YJ_6_6_1644870853\\/other_img_LJKtmY9EAzRkXaqioZ8T5oCV2_.jpeg\",\"Rzzd2CJkk4iT3YJ_6_6_1644870853\\/other_img_aXVE3u7DtjMvMJUbgzJeTUKMu_.jpeg\",\"Rzzd2CJkk4iT3YJ_6_6_1644870853\\/other_img_K8EtIpGVWlZjOr5jgKUKdL4Np_.avif\",\"Rzzd2CJkk4iT3YJ_6_6_1644870853\\/other_img_qEYNlbieAyMz798tyIcfZ7Uhx_.webp\"]', '2022-02-14 20:34:13', 2, 64, 0, 1, 0, 1, NULL, NULL, 0),
(11, 'Testing Product 7', 11, 11, '400.00', 2, 15, 1, 1, '<p>Testing Product 6</p>', 'wduPL6Cq8qenHON_8_11_1644870916/main_ujXdBXgdVnd9xle6s1kr_1644870916.jpeg', '[\"wduPL6Cq8qenHON_8_11_1644870916\\/other_img_9BYhLPaY26J02EJtLC7EwJktx_.jpeg\",\"wduPL6Cq8qenHON_8_11_1644870916\\/other_img_1Crc0SJwEkoaKHjsPQsLm28RN_.png\",\"wduPL6Cq8qenHON_8_11_1644870916\\/other_img_YzLJm7gGFRlwrGVs7YZZ1Py4y_.jpeg\",\"wduPL6Cq8qenHON_8_11_1644870916\\/other_img_wwyouT4U5TnaoZ3qgqFUcj7HF_.jpeg\"]', '2022-02-14 20:35:16', 7, 27, 0, 3, 1, 1, NULL, NULL, 0),
(12, 'Testing Product 8', 11, 11, '40000.00', 12, 30, 1, 0, '<p>Testing Product 8</p>', 'zOe7OTgdCo986M8_6_11_1644870956/main_R0F9rkCnOtcT29ucfJjg_1644870956.jpeg', '[\"zOe7OTgdCo986M8_6_11_1644870956\\/other_img_jDgVtVH1Hu3ZpAhjmwES0D53w_.jpeg\",\"zOe7OTgdCo986M8_6_11_1644870956\\/other_img_iev03iv5KsKcaNzv20JBwuXZL_.jpeg\",\"zOe7OTgdCo986M8_6_11_1644870956\\/other_img_Ag4ALEHUojdqfs9nCnFsvkyLj_.jpeg\"]', '2022-02-14 20:35:56', 7, 0, 0, 0, 1, 1, NULL, NULL, 0),
(15, 'Testing product by seller', 11, 8, '100.00', 10, 10, 1, 1, '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><h2>Why do we use it?</h2><p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>', 'PXcDDMZoTy3hhHn_11_8_1645301830/main_XyCgxSSc5Bw9vpaFytrr_1645301830.jpeg', '[\"PXcDDMZoTy3hhHn_11_8_1645301830\\/other_img_IF3wz8SncO8H9XFkOS92SSwnj_.jpeg\",\"PXcDDMZoTy3hhHn_11_8_1645301830\\/other_img_R02lFqe4UnKfNfUWR2INvqnOH_.jpeg\",\"PXcDDMZoTy3hhHn_11_8_1645301830\\/other_img_dlykRmfbMhT7qoqXFPcer4gqA_.jpeg\",\"PXcDDMZoTy3hhHn_11_8_1645301830\\/other_img_82WnIeJ6yUQlQhXio7xkszgTy_.jpeg\",\"PXcDDMZoTy3hhHn_11_8_1645301830\\/other_img_mY0YWuXQiibBRCoWcVSSayigS_.jpeg\"]', '2022-02-19 20:17:10', 6, 0, 0, 0, 1, 1, NULL, NULL, 0),
(25, 'Testing product by seller 1', 11, 7, '200.00', 12, 10, 1, 1, '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><h2>Why do we use it?</h2><p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>', 'EQT1muZbWZyyGi6_11_7_1645301907/main_BdsgovtrEHDBji9zYIv5_1645301907.jpeg', '[\"EQT1muZbWZyyGi6_11_7_1645301907\\/other_img_SYRrEqsqrQhc2CDOy9lEMrng0_.jpeg\",\"EQT1muZbWZyyGi6_11_7_1645301907\\/other_img_SPr7a5ER0D2VpHnLJBfzFq2yV_.jpeg\",\"EQT1muZbWZyyGi6_11_7_1645301907\\/other_img_5HDZb7Rk49MTpeWXYmRxlpBUA_.jpeg\"]', '2022-02-19 20:18:27', 4, 8, 50, 28, 1, 1, NULL, NULL, 0),
(27, 'Demo product', 18, 1, '300.00', 10, 10, 1, 1, '<ul><li>Testing 1</li><li>Testing 1</li><li>Testing 1</li><li>Testing 1</li><li>Testing 1</li><li>Testing 1</li><li>Testing 1</li></ul>', '1eS8QOnHAqGdyKO_18_1_1647457337/main_1z5FcignP2kuVJRxRKRw_1647457337.jpeg', '[\"1eS8QOnHAqGdyKO_18_1_1647457337\\/other_img_TGNZP7zepzAwXtcB0PRUvUFys_.jpeg\",\"1eS8QOnHAqGdyKO_18_1_1647457337\\/other_img_0hQY9970XeIsc3ewt6vsMT0h8_.jpeg\",\"1eS8QOnHAqGdyKO_18_1_1647457337\\/other_img_iE2Ljhx1boebaiYFiQpQwVlY7_.jpeg\"]', '2022-03-16 19:02:17', 4, 62, 0, 0, 1, 1, 'blue,pink,red,yellow,grey', '44,54,34,76', 0),
(28, 'Testing product', 18, 1, '300.00', 40, 20, 1, 1, '<p>Testing&nbsp;</p>', 'ihSNPkCVFrGOIFn_18_1_1647457382/main_uB5RBUSg7NrgZ1Qg7XSu_1647457382.jpeg', '[]', '2022-03-16 19:03:02', 7, 38, 0, 0, 1, 1, 'blue,pink,red,yellow,grey', '44,54,34,76', 0),
(29, 'Header shoulder', 11, 4, '590.00', 80, 40, 2, 1, '<p>welcome</p>', 'jseeSvtmmeXohll_11_4_1648241976/main_1IXaaZ6oK3bx9oQaX5D0_1648241976.jpeg', '[\"jseeSvtmmeXohll_11_4_1648241976\\/other_img_hpcoQ9Dh6KVHJatZITW0Ws4DL_.jpeg\",\"jseeSvtmmeXohll_11_4_1648241976\\/other_img_NSMZBtiNUb554F5CwStIcj11d_.jpeg\",\"jseeSvtmmeXohll_11_4_1648241976\\/other_img_l7gGk0WnlSbr6Jz0S3r1VAoLR_.jpeg\"]', '2022-03-25 20:59:36', 6, 1, 0, 1, 1, 1, 'blue,pink,red,yellow,grey', '44,54,34,76', 0),
(30, 'Demo product', 11, 4, '333.00', 33, 0, 0, 0, '<p>Testing</p>', 'JvpdxFYOHSojhMs_6_4_1648243683/main_JhldFu8YS0EbYy0caucS_1648243683.jpeg', '[\"JvpdxFYOHSojhMs_6_4_1648243683\\/other_img_4jHaY0QQgYyMMl77duZJVcGwV_.jpeg\"]', '2022-03-25 21:28:03', 6, 15, 0, 3, 0, 1, 'blue,green,red', '42,43,41', 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `addedBy` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`id`, `name`, `addedBy`) VALUES
(1, 'food', 11),
(2, 'sport', 11),
(3, 'electronic devices', 11),
(4, 'electronic accessories', 11),
(5, 'tv & home appliances', 0),
(6, 'health & beauty', 0),
(7, 'babies & toyes', 0),
(8, 'groceries & pets', 0),
(9, 'home & lifestyle', 0),
(10, 'women`s fashion', 0),
(11, 'men`s fashion', 0),
(12, 'sports & outdoor', 0),
(13, 'demo', 11),
(14, 'testing', 11);

-- --------------------------------------------------------

--
-- Table structure for table `product_review`
--

CREATE TABLE `product_review` (
  `id` int(11) NOT NULL,
  `rating` int(11) DEFAULT NULL,
  `review` varchar(255) DEFAULT NULL,
  `cusID` int(11) DEFAULT NULL,
  `prdID` int(11) DEFAULT NULL,
  `date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_review`
--

INSERT INTO `product_review` (`id`, `rating`, `review`, `cusID`, `prdID`, `date`) VALUES
(1, 3, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 10, 5, '2022-02-22 00:00:00'),
(2, 4, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 11, 5, '2022-02-22 00:00:00'),
(3, 5, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 16, 5, '2022-02-22 00:00:00'),
(4, 2, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 13, 5, '2022-02-22 00:00:00'),
(5, 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 14, 5, '2022-02-22 00:00:00'),
(6, 5, 'kjhkjh', 12, 5, '2022-02-22 00:00:00'),
(7, 5, 'kjhkjh', 12, 5, '2022-02-22 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `saller_account`
--

CREATE TABLE `saller_account` (
  `id` int(11) NOT NULL,
  `amount` bigint(20) DEFAULT 0,
  `sall_ID` int(11) NOT NULL,
  `type` tinyint(4) DEFAULT 0 COMMENT '0 - online && 1 - offline saller'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `saller_account`
--

INSERT INTO `saller_account` (`id`, `amount`, `sall_ID`, `type`) VALUES
(4, 13233, 11, 0),
(6, 480, 18, 1),
(7, 333, 6, 0),
(8, 190, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `saller_account_transaction`
--

CREATE TABLE `saller_account_transaction` (
  `id` int(11) NOT NULL,
  `amount` int(11) DEFAULT NULL,
  `prdID` int(11) DEFAULT NULL,
  `order_qty` int(11) DEFAULT NULL,
  `orderlist_ID` int(11) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `sall_ID` int(11) NOT NULL,
  `pay_type` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1 - added && 2 subtracted',
  `des` varchar(255) DEFAULT NULL COMMENT 'Supplier amount',
  `buy_now_id` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `saller_account_transaction`
--

INSERT INTO `saller_account_transaction` (`id`, `amount`, `prdID`, `order_qty`, `orderlist_ID`, `date`, `sall_ID`, `pay_type`, `des`, `buy_now_id`) VALUES
(11, 500, 6, 1, 60, '2022-03-01 21:22:03', 11, 0, NULL, 0),
(12, 500, 6, 1, 60, '2022-03-01 21:28:39', 11, 0, NULL, 0),
(13, 190, 5, 1, 109, '2022-03-07 18:28:20', 11, 0, NULL, 0),
(14, 500, 6, 1, 110, '2022-03-07 18:33:21', 11, 0, NULL, 0),
(15, 500, 6, 1, 111, '2022-03-07 18:35:22', 11, 0, NULL, 0),
(16, 500, 6, 1, 61, '2022-03-07 18:46:40', 11, 0, NULL, 0),
(17, 9800, 8, 1, 62, '2022-03-07 18:46:40', 11, 0, NULL, 0),
(18, 5400, 7, 2, 112, '2022-03-07 18:51:45', 11, 0, NULL, 0),
(19, 200, 0, 0, 0, '2022-03-09 19:45:39', 11, 1, NULL, 0),
(20, 200, 0, 0, 0, '2022-03-09 19:46:14', 11, 1, NULL, 0),
(21, 500, 0, 0, 0, '2022-03-09 19:47:10', 11, 2, NULL, 0),
(22, 210, 0, 0, 0, '2022-03-09 19:47:22', 11, 1, NULL, 0),
(23, 400, 6, 1, 59, '2022-03-16 20:48:30', 11, 0, NULL, 0),
(24, 1000, 0, 0, 0, '2022-03-16 20:53:13', 11, 2, NULL, 0),
(25, 1000, 0, 0, 0, '2022-03-16 20:53:34', 11, 1, NULL, 0),
(26, 200, 0, 0, 0, '2022-03-23 20:31:31', 11, 1, 'Testing amount', 0),
(27, 400, 6, 1, 130, '2022-03-23 20:57:10', 11, 0, NULL, 0),
(30, 240, 28, 1, 0, '2022-03-24 20:26:25', 18, 0, 'Supplier earning through buy now', 10),
(31, 20, 0, 0, 0, '2022-03-24 21:24:19', 18, 3, 'Received from saller', 0),
(32, 10, 0, 0, 0, '2022-03-24 21:24:55', 18, 3, 'Testing', 0),
(33, 240, 28, 1, 0, '2022-03-26 12:22:48', 18, 0, 'Supplier earning through buy now', 11),
(34, 19000, 0, 0, 0, '2022-03-26 19:35:51', 11, 2, 'Testing', 0),
(35, 333, 30, 1, 135, '2022-03-26 19:50:59', 11, 0, NULL, 0),
(36, 2700, 7, 1, 142, '2022-03-26 20:38:52', 11, 0, NULL, 0),
(37, 333, 30, 1, 143, '2022-03-26 20:38:52', 6, 0, NULL, 0),
(38, 190, 5, 1, 144, '2022-03-26 20:38:52', 3, 0, NULL, 0),
(39, 90, 0, 0, 0, '2022-03-27 09:26:54', 18, 3, 'paid', 0),
(40, 400, 6, 1, 148, '2022-03-27 09:35:12', 11, 0, NULL, 0),
(41, 9800, 8, 1, 149, '2022-03-27 09:35:12', 11, 0, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `seller_opt`
--

CREATE TABLE `seller_opt` (
  `id` int(11) NOT NULL,
  `code` varchar(8) DEFAULT NULL,
  `sellID` int(11) DEFAULT NULL,
  `date` smallint(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `shipment_charges`
--

CREATE TABLE `shipment_charges` (
  `id` int(11) NOT NULL,
  `city_name` varchar(255) DEFAULT NULL,
  `charges` int(11) DEFAULT NULL,
  `date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shipment_charges`
--

INSERT INTO `shipment_charges` (`id`, `city_name`, `charges`, `date`) VALUES
(1, 'lahore', 310, '2022-03-16 00:26:52'),
(2, 'kohat', 150, '2022-03-16 00:31:08'),
(3, 'multan', 350, '2022-03-16 00:31:17'),
(4, 'swat', 500, '2022-03-16 00:31:31'),
(6, 'peshware', 400, '2022-03-16 00:36:59');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `mobile` varchar(12) DEFAULT NULL,
  `cnic` varchar(14) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `username` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `image` varchar(150) NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '0 - added by admin && 1 - create by seller',
  `active` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 - active && 1 - not active yet',
  `shop_name` varchar(150) DEFAULT NULL,
  `shop_add` varchar(255) DEFAULT NULL,
  `mobile_account` varchar(13) DEFAULT NULL,
  `mobile_account_type` tinyint(4) DEFAULT NULL COMMENT '1 - easy paisa && 2 - jazz cash && 3 - mobi cash',
  `sallerType` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 online && 1 offline'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `name`, `email`, `mobile`, `cnic`, `date`, `username`, `password`, `image`, `status`, `active`, `shop_name`, `shop_add`, `mobile_account`, `mobile_account_type`, `sallerType`) VALUES
(3, 'Rafiullah', 'dd@gmail.com', '098348934', '0983490834', '2022-02-12 19:00:00', '', '/3q0Hg==', 'seller_098348934_PCt3m6U2GU2eNZNWGAEY.jpeg', 0, 0, NULL, 'Testing', NULL, NULL, 0),
(6, 'Adnan sami', 'sb@gmail.com', '09834834939', '0983903433', '2022-02-12 19:00:00', 'abs1234', '/3q0Hg==', '', 0, 0, NULL, 'Testing', NULL, NULL, 0),
(9, 'Abudl Ameen', 'testing@gmail.com', '04039939393', '90380934093', '2022-02-18 21:58:34', 'testing@gmail.com', '/3q0Hg==', '', 0, 0, NULL, NULL, NULL, NULL, 0),
(11, 'Abdullah Afridi', 'tcomprog2222@gmail.com', '03322388002', '93848884949', '2022-02-19 08:00:52', '', '/3q0Hg==', 'seller_0332848484_l5EFABP9n4pKoEVwLEPI.jpeg', 1, 1, 'Janan Shop 11', 'Johar Town Lahore', '0333245555', 3, 0),
(14, 'Kamran Khan', 'tcomprog1122@gmail.com', '0333244444', '98498498498', '2022-03-10 21:07:58', 'ab@wayio.dk', '/3q0Hg==', 'seller_0333244444_3OiXcZm1tcZ8IfhQdypC.jpeg', 1, 1, 'New Shop', 'Main road sadar bazar', NULL, NULL, 0),
(15, 'Basit', 'smmm@gmail.com', '09809809809', '098098098', '2022-03-10 21:21:35', 'smmm@gmail.com', '/3q0Hg==', 'seller_09809809809_BKDo268qEJcDN9o4sDnn.jpeg', 0, 0, 'Demo Shop', 'Mina road lahore', NULL, NULL, 0),
(16, 'Basit', 'smmm11@gmail.com', '09888888888', '999999999988', '2022-03-10 21:22:07', 'smmm11@gmail.com', '/3q0Hg==', 'seller_09888888888_xQ33IT8uBo1BBdUgCIbD.jpeg', 0, 0, 'Demo Shop', 'Mina road lahore', NULL, NULL, 0),
(17, 'Ali Zaman', 'smpt@gmail.com', '03323333238', '90494949494', '2022-03-13 19:45:49', 'testing', '/3q0Hg==', 'seller_03323333238_CPLwRRthxySkLLOjjtKE.jpeg', 0, 0, 'Testing shop', 'Lahore', '939393939', 2, 1),
(18, 'Testing', 'sm11s@gmail.com', '9993939339', '0983409384098', '2022-03-16 17:43:25', '', '/3q0Hg==', 'seller_9993939339_eVc0X8AuZIjM0fIeEoxK.jpeg', 0, 0, 'Testing Shop', 'Peshware', '098349083409', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_address`
--

CREATE TABLE `tbl_address` (
  `id` int(11) NOT NULL,
  `house_no` varchar(20) DEFAULT NULL,
  `street_no` varchar(20) DEFAULT NULL,
  `city` varchar(150) DEFAULT NULL,
  `tehsil` varchar(150) DEFAULT NULL,
  `district` varchar(200) DEFAULT NULL,
  `postal_code` varchar(10) DEFAULT NULL,
  `type` tinyint(1) DEFAULT NULL COMMENT '1 => customer && 2 => investor && 3=> master team',
  `status` tinyint(4) DEFAULT NULL COMMENT '1 => perment && 2 => present',
  `holderID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_address`
--

INSERT INTO `tbl_address` (`id`, `house_no`, `street_no`, `city`, `tehsil`, `district`, `postal_code`, `type`, `status`, `holderID`) VALUES
(1, '337', 'D1', 'Lahore', '', 'Johar Town', '232323', 1, 1, 12),
(2, '337', '', 'Johar Town', 'Johar Town', 'Johar Town', '232323', 1, 2, 12);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `id` int(11) NOT NULL,
  `username` varchar(20) DEFAULT NULL,
  `email` varchar(80) DEFAULT NULL,
  `password` varchar(150) DEFAULT NULL,
  `profile_status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = profile incomplete && 1 = complete',
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `name` varchar(100) NOT NULL,
  `mobile` varchar(12) DEFAULT NULL,
  `gender` int(4) DEFAULT NULL,
  `image` varchar(180) DEFAULT NULL,
  `jazz_easy_mobi_no` varchar(12) DEFAULT NULL,
  `jazz_easy_mobi_type` int(2) DEFAULT NULL,
  `referby_ID` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`id`, `username`, `email`, `password`, `profile_status`, `date`, `name`, `mobile`, `gender`, `image`, `jazz_easy_mobi_no`, `jazz_easy_mobi_type`, `referby_ID`) VALUES
(10, 'sm@gmail.com', 'sm@gmail.com', '/3q0Hg==', 0, '2022-02-07 19:00:00', 'Abdul Basit', '', 0, '', '', 0, 12),
(11, 'sami@gmail.com', 'sami@gmail.com', '/3q0Hg==', 0, '2022-02-07 19:00:00', 'SamiUllah', '', 0, '', '', 0, 0),
(12, 'tcomprog@gmail.com', 'tcomprog@gmail.com', '/3q0Hg==', 1, '2022-02-08 19:00:00', 'Ali muhammad', '03322388002', 1, 'master_team_03322388002_TmFx3xoYFyqLS1EUuZrH.png', '03322388002', 1, 13),
(13, 'test@gmail.com', 'test@gmail.com', '/3q0Hg==', 0, '2022-02-11 19:00:00', 'Testing', NULL, NULL, NULL, NULL, NULL, 0),
(14, 'st@gmail.com', 'st@gmail.com', '/3q0Hg==', 0, '2022-02-12 19:00:00', 'Salman Afridi', NULL, NULL, NULL, NULL, NULL, 0),
(15, 'sst@gmail.com', 'sst@gmail.com', '/3q0Hg==', 0, '2022-02-12 19:00:00', 'SS Technology', NULL, NULL, NULL, NULL, NULL, 0),
(16, 'tsp@gmail.com', 'tsp@gmail.com', '/3q0HsU=', 0, '2022-02-12 19:00:00', 'Testing account', NULL, NULL, NULL, NULL, NULL, 12),
(18, NULL, 'tug@gmail.com', '/3q0Hg==', 0, '2022-03-09 20:04:33', 'Tufiq', '09090909', NULL, NULL, NULL, NULL, 0),
(19, NULL, 'kamrsa@gmail.com', '/3q0Hg==', 0, '2022-03-09 20:34:48', 'Kamran Khan New', '033403333', NULL, NULL, NULL, NULL, 12),
(20, NULL, 'tcomprog1122@gmail.com', '/3q0Hg==', 0, '2022-03-10 19:46:43', 'Salman Khan', '89984984984', NULL, NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer_cart`
--

CREATE TABLE `tbl_customer_cart` (
  `id` int(11) NOT NULL,
  `prdID` int(11) DEFAULT NULL,
  `cusID` int(11) DEFAULT NULL,
  `date` timestamp NULL DEFAULT current_timestamp(),
  `qty` int(11) DEFAULT NULL,
  `type` tinyint(4) DEFAULT 0 COMMENT '0 for online && 1 for offline product',
  `color` varchar(100) DEFAULT NULL,
  `size` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer_credit_total`
--

CREATE TABLE `tbl_customer_credit_total` (
  `id` int(11) NOT NULL,
  `amount` bigint(20) DEFAULT NULL,
  `cusID` int(11) NOT NULL,
  `type` tinyint(1) NOT NULL COMMENT '1 => customer\r\n2 => investor\r\n3 => master team'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_customer_credit_total`
--

INSERT INTO `tbl_customer_credit_total` (`id`, `amount`, `cusID`, `type`) VALUES
(5, 30, 12, 1),
(6, 86, 10, 1),
(7, 20, 6, 2),
(8, 50, 7, 3),
(9, 150, 11, 1),
(11, 1558, 13, 1),
(12, 1000, 14, 1),
(13, 1000, 15, 1),
(14, 1000, 16, 1),
(15, 1000, 17, 1),
(16, 1000, 18, 1),
(17, 1000, 19, 1),
(18, 1000, 20, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer_credit_trans`
--

CREATE TABLE `tbl_customer_credit_trans` (
  `id` int(11) NOT NULL,
  `amount` int(11) NOT NULL DEFAULT 0,
  `cusID` int(11) DEFAULT NULL,
  `tran_type` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 => account creation credit  && 1=> refer credit &&\r\n2=> investor_or team member  ^^ 5 -> discount used in order && 6 shoping refer',
  `type` tinyint(4) NOT NULL COMMENT '1 => customer 2 => investor 3 => master team',
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_customer_credit_trans`
--

INSERT INTO `tbl_customer_credit_trans` (`id`, `amount`, `cusID`, `tran_type`, `type`, `date`) VALUES
(12, 150, 11, 0, 1, '2022-02-11 19:00:00'),
(14, 2, 6, 2, 2, '2022-02-11 19:00:00'),
(15, 5, 7, 2, 3, '2022-02-11 19:00:00'),
(17, 2, 6, 2, 2, '2022-02-11 19:00:00'),
(19, 150, 13, 0, 1, '2022-02-11 19:00:00'),
(20, 2, 6, 2, 2, '2022-02-11 19:00:00'),
(21, 5, 7, 2, 3, '2022-02-11 19:00:00'),
(22, 1000, 14, 0, 1, '2022-02-12 19:00:00'),
(24, 2, 6, 2, 2, '2022-02-12 19:00:00'),
(25, 5, 7, 2, 3, '2022-02-12 19:00:00'),
(26, 1000, 15, 0, 1, '2022-02-12 19:00:00'),
(27, 2, 6, 2, 2, '2022-02-12 19:00:00'),
(28, 5, 7, 2, 3, '2022-02-12 19:00:00'),
(29, 1000, 16, 0, 1, '2022-02-12 19:00:00'),
(31, 2, 6, 2, 2, '2022-02-12 19:00:00'),
(32, 5, 7, 2, 3, '2022-02-12 19:00:00'),
(33, 1000, 17, 0, 1, '2022-02-22 22:17:49'),
(34, 2, 6, 2, 2, '2022-02-22 22:17:49'),
(35, 5, 7, 2, 3, '2022-02-22 22:17:49'),
(41, 60, 13, 6, 1, '2022-03-07 18:35:22'),
(42, 523, 13, 6, 1, '2022-03-07 18:46:40'),
(44, 1000, 18, 0, 1, '2022-03-09 20:04:33'),
(45, 2, 6, 2, 2, '2022-03-09 20:04:33'),
(46, 5, 7, 2, 3, '2022-03-09 20:04:33'),
(47, 1000, 19, 0, 1, '2022-03-09 20:34:48'),
(49, 2, 6, 2, 2, '2022-03-09 20:34:48'),
(50, 5, 7, 2, 3, '2022-03-09 20:34:48'),
(51, 1000, 20, 0, 1, '2022-03-10 19:46:43'),
(52, 2, 6, 2, 2, '2022-03-10 19:46:43'),
(53, 5, 7, 2, 3, '2022-03-10 19:46:43'),
(54, 14, 10, 5, 1, '2022-03-13 17:19:30'),
(55, 210, 12, 5, 1, '2022-03-13 17:20:48'),
(56, 70, 12, 5, 1, '2022-03-15 20:12:15'),
(57, 70, 12, 5, 1, '2022-03-15 20:21:12'),
(58, 0, 12, 5, 1, '2022-03-21 18:36:23'),
(59, 0, 12, 5, 1, '2022-03-23 19:47:25'),
(60, 0, 12, 5, 1, '2022-03-23 20:17:41'),
(61, 0, 12, 5, 1, '2022-03-23 20:23:22'),
(62, 41, 13, 6, 1, '2022-03-23 20:57:10'),
(63, 0, 12, 5, 1, '2022-03-25 20:33:24'),
(64, 0, 12, 5, 1, '2022-03-25 20:37:35'),
(65, 28, 12, 5, 1, '2022-03-26 11:53:54'),
(66, 0, 12, 5, 1, '2022-03-26 11:58:23'),
(67, 0, 12, 5, 1, '2022-03-26 12:07:32'),
(68, 0, 12, 5, 1, '2022-03-26 13:51:19'),
(69, 60, 13, 6, 1, '2022-03-26 19:50:59'),
(70, 0, 12, 5, 1, '2022-03-26 20:15:22'),
(71, 183, 13, 6, 1, '2022-03-26 20:38:52'),
(72, 0, 12, 5, 1, '2022-03-27 09:06:01'),
(73, 0, 12, 5, 1, '2022-03-27 09:18:04'),
(74, 70, 12, 5, 1, '2022-03-27 09:20:04'),
(75, 0, 12, 5, 1, '2022-03-27 09:32:41'),
(76, 541, 13, 6, 1, '2022-03-27 09:35:12');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cus_verification_code`
--

CREATE TABLE `tbl_cus_verification_code` (
  `id` int(11) NOT NULL,
  `code` varchar(8) DEFAULT NULL,
  `cusID` int(11) DEFAULT NULL,
  `date` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_cus_verification_code`
--

INSERT INTO `tbl_cus_verification_code` (`id`, `code`, `cusID`, `date`) VALUES
(4, '311766', 12, '2022-02-19 12:39:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_email_otp`
--
ALTER TABLE `account_email_otp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `mobile` (`mobile`),
  ADD UNIQUE KEY `cnic` (`cnic`);

--
-- Indexes for table `advertisement`
--
ALTER TABLE `advertisement`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`);

--
-- Indexes for table `bank_account`
--
ALTER TABLE `bank_account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `buy_now_product`
--
ALTER TABLE `buy_now_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `buy_now_saller_account`
--
ALTER TABLE `buy_now_saller_account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `buy_now_saller_account_tran`
--
ALTER TABLE `buy_now_saller_account_tran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fav_product`
--
ALTER TABLE `fav_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `investor`
--
ALTER TABLE `investor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `json_data`
--
ALTER TABLE `json_data`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `status` (`status`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orderlist`
--
ALTER TABLE `orderlist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_return`
--
ALTER TABLE `order_return`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_review`
--
ALTER TABLE `product_review`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `saller_account`
--
ALTER TABLE `saller_account`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sall_ID` (`sall_ID`);

--
-- Indexes for table `saller_account_transaction`
--
ALTER TABLE `saller_account_transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seller_opt`
--
ALTER TABLE `seller_opt`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shipment_charges`
--
ALTER TABLE `shipment_charges`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `city_name` (`city_name`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`,`cnic`,`username`),
  ADD UNIQUE KEY `mobile` (`mobile`);

--
-- Indexes for table `tbl_address`
--
ALTER TABLE `tbl_address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `tbl_customer_cart`
--
ALTER TABLE `tbl_customer_cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_customer_credit_total`
--
ALTER TABLE `tbl_customer_credit_total`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_customer_credit_trans`
--
ALTER TABLE `tbl_customer_credit_trans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_cus_verification_code`
--
ALTER TABLE `tbl_cus_verification_code`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cusID` (`cusID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_email_otp`
--
ALTER TABLE `account_email_otp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `advertisement`
--
ALTER TABLE `advertisement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `bank_account`
--
ALTER TABLE `bank_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `buy_now_product`
--
ALTER TABLE `buy_now_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `buy_now_saller_account`
--
ALTER TABLE `buy_now_saller_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `buy_now_saller_account_tran`
--
ALTER TABLE `buy_now_saller_account_tran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `fav_product`
--
ALTER TABLE `fav_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `investor`
--
ALTER TABLE `investor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `json_data`
--
ALTER TABLE `json_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orderlist`
--
ALTER TABLE `orderlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT for table `order_return`
--
ALTER TABLE `order_return`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `product_review`
--
ALTER TABLE `product_review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `saller_account`
--
ALTER TABLE `saller_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `saller_account_transaction`
--
ALTER TABLE `saller_account_transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `seller_opt`
--
ALTER TABLE `seller_opt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `shipment_charges`
--
ALTER TABLE `shipment_charges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_address`
--
ALTER TABLE `tbl_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_customer_cart`
--
ALTER TABLE `tbl_customer_cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `tbl_customer_credit_total`
--
ALTER TABLE `tbl_customer_credit_total`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_customer_credit_trans`
--
ALTER TABLE `tbl_customer_credit_trans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `tbl_cus_verification_code`
--
ALTER TABLE `tbl_cus_verification_code`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_cus_verification_code`
--
ALTER TABLE `tbl_cus_verification_code`
  ADD CONSTRAINT `tbl_cus_verification_code_ibfk_1` FOREIGN KEY (`cusID`) REFERENCES `tbl_customer` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
