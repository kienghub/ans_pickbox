-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 09, 2021 at 11:52 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pickbox`
--

-- --------------------------------------------------------

--
-- Table structure for table `ans_bills`
--

CREATE TABLE `ans_bills` (
  `bill_id` varchar(200) NOT NULL,
  `bill_no` varchar(200) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `bill_status` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ans_bills`
--

INSERT INTO `ans_bills` (`bill_id`, `bill_no`, `branch_id`, `bill_status`) VALUES
('1', '2107202002', 1, '1'),
('39a2531c8a7e6c3c5b7436022e687d51', '2107202004311', 1, '1'),
('9f1c6ce818208c1b7d889d91305f086b', '2107212110437', 1, '1'),
('a8f3e3ddaa295f48e99d6085768ded73', '2107202004224', 1, '1'),
('e3ef623cfea92b421aac28116e9b7479', '2108050510701', 1, '1'),
('eaa9bea9ebb8bec04fc175cc6e509e34', '2107202926', 1, '1');

-- --------------------------------------------------------

--
-- Table structure for table `ans_branch_stocks`
--

CREATE TABLE `ans_branch_stocks` (
  `_id` int(11) NOT NULL,
  `pro_id` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ans_branch_stocks`
--

INSERT INTO `ans_branch_stocks` (`_id`, `pro_id`, `qty`, `branch_id`) VALUES
(41, 5, 33, 1),
(42, 4, 49, 1),
(43, 7, 48, 1),
(44, 9, 8, 1),
(45, 10, 14, 3),
(46, 5, -2, 1),
(47, 4, 12, 1),
(48, 7, 38, 1),
(49, 7, 38, 1),
(50, 5, -7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ans_category_of_sale`
--

CREATE TABLE `ans_category_of_sale` (
  `cate_id` int(11) NOT NULL,
  `cate_title` varchar(255) DEFAULT NULL,
  `cate_createdAt` timestamp NULL DEFAULT NULL,
  `cate_createdBy` varchar(50) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ans_category_of_sale`
--

INSERT INTO `ans_category_of_sale` (`cate_id`, `cate_title`, `cate_createdAt`, `cate_createdBy`, `branch_id`) VALUES
(1, 'ແກັດ', '2021-05-12 09:10:45', 'kieng', 1),
(2, 'ເຄືອງທົ່ວໄປ', '2021-05-12 09:12:14', 'kieng', 1),
(3, 'ກ໋ອງ', '2021-05-13 08:47:15', 'kieng', 1),
(4, 'ກັບ', '2021-05-13 08:47:56', 'kieng', 1),
(5, 'ຖົງ', '2021-05-13 08:48:50', 'kieng', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ans_pricing`
--

CREATE TABLE `ans_pricing` (
  `_id` int(11) NOT NULL,
  `pro_id` int(11) DEFAULT NULL,
  `price_item` decimal(10,2) DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL,
  `createdBy` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ans_pricing`
--

INSERT INTO `ans_pricing` (`_id`, `pro_id`, `price_item`, `createdAt`, `createdBy`) VALUES
(30, 5, '4500.00', '2021-06-15 11:10:47', 'kieng ຮ້ານ'),
(31, 4, '4500.00', '2021-06-15 11:11:23', 'kieng ຮ້ານ'),
(32, 12, '5000.00', '2021-06-15 11:11:45', 'kieng ຮ້ານ'),
(33, 7, '6000.00', '2021-06-15 11:12:08', 'kieng ຮ້ານ'),
(34, 9, '6500.00', '2021-06-15 11:12:30', 'kieng ຮ້ານ'),
(35, 10, '6500.00', '2021-06-15 11:12:59', 'kieng ຮ້ານ'),
(36, 11, '7000.00', '2021-06-15 11:13:18', 'kieng ຮ້ານ'),
(37, 11, '5000.00', '2021-07-21 11:03:33', 'kieng ຮ້ານ'),
(38, 10, '4500.00', '2021-07-21 11:04:20', 'kieng ຮ້ານ'),
(39, 12, '4000.00', '2021-07-21 11:05:12', 'kieng ຮ້ານ');

-- --------------------------------------------------------

--
-- Table structure for table `ans_production_of_sale`
--

CREATE TABLE `ans_production_of_sale` (
  `pro_id` int(11) NOT NULL,
  `pro_number` varchar(25) DEFAULT NULL,
  `cate_id` int(11) DEFAULT NULL,
  `pro_title` varchar(255) DEFAULT NULL,
  `pro_unit` varchar(255) DEFAULT NULL,
  `pro_size` varchar(255) DEFAULT NULL,
  `pro_status` varchar(25) DEFAULT NULL,
  `pro_detail` varchar(255) DEFAULT NULL,
  `pro_img` varchar(255) DEFAULT NULL,
  `pro_createdAt` timestamp NULL DEFAULT NULL,
  `pro_createdBy` varchar(50) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ans_production_of_sale`
--

INSERT INTO `ans_production_of_sale` (`pro_id`, `pro_number`, `cate_id`, `pro_title`, `pro_unit`, `pro_size`, `pro_status`, `pro_detail`, `pro_img`, `pro_createdAt`, `pro_createdBy`, `branch_id`) VALUES
(4, '2106151520', 1, 'ແກ໋ດ', 'ແກ໋ດ', 'S', 'true', '', '657789.png', '2021-06-15 03:47:12', 'kieng', 1),
(5, '2106151520', 1, 'ແກ໋ດ', 'ແກ໋ດ', 'mini', 'true', '', '548244.jpg', '2021-06-15 03:47:28', 'kieng', 1),
(7, '2106151520', 1, 'ແກ໋ດ', 'ແກ໋ດ', 'L', 'true', '', '774251.jpg', '2021-06-15 03:46:53', 'kieng', 1),
(9, '2106151520', 1, 'ແກ໋ດ', 'ແກ໋ດ', 'XL', 'true', '', '958982.png', '2021-06-15 03:48:02', 'kieng', 1),
(10, '2106151521', 1, 'ແກ໋ດ', 'ແກ໋ດ', '2XL', 'true', '', '', '2021-06-15 04:02:40', 'kieng', 9),
(11, '2106151522', 1, 'ແກ໋ດ', 'ແກ໋ດ', '3XL', 'true', '', '', '2021-06-15 04:04:48', 'kieng', 9),
(12, '2106151523', 1, 'ແກ໋ດ', 'ແກ໋ດ', 'M', 'true', '', '', '2021-06-15 04:05:43', 'kieng', 9);

-- --------------------------------------------------------

--
-- Table structure for table `ans_receive_of_sale`
--

CREATE TABLE `ans_receive_of_sale` (
  `_id` int(11) NOT NULL,
  `pro_id` int(11) DEFAULT NULL,
  `rec_bprice` decimal(10,2) DEFAULT NULL,
  `rec_sprice` decimal(10,2) DEFAULT NULL,
  `rec_qty` int(11) DEFAULT NULL,
  `rec_date` date DEFAULT NULL,
  `rec_status` varchar(25) DEFAULT NULL,
  `rec_note` varchar(255) DEFAULT NULL,
  `rec_createdAt` datetime DEFAULT NULL,
  `rec_createdBy` varchar(255) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ans_receive_of_sale`
--

INSERT INTO `ans_receive_of_sale` (`_id`, `pro_id`, `rec_bprice`, `rec_sprice`, `rec_qty`, `rec_date`, `rec_status`, `rec_note`, `rec_createdAt`, `rec_createdBy`, `branch_id`) VALUES
(1, 5, '0.00', '4500.00', 225, '2021-06-15', 'true', '', '2021-06-15 11:10:47', 'kieng ຮ້ານ', 1),
(2, 4, '0.00', '4500.00', 219, '2021-06-15', 'true', '', '2021-06-15 11:11:23', 'kieng ຮ້ານ', 1),
(3, 12, '0.00', '5000.00', 254, '2021-06-15', 'true', '', '2021-06-15 11:11:45', 'kieng ຮ້ານ', 1),
(4, 7, '0.00', '6000.00', 156, '2021-06-15', 'true', '', '2021-06-15 11:12:08', 'kieng ຮ້ານ', 1),
(5, 9, '0.00', '6500.00', 186, '2021-07-14', 'true', '', '2021-06-15 11:12:30', 'kieng ຮ້ານ', 1),
(6, 10, '0.00', '6500.00', 127, '2021-06-15', 'true', '', '2021-06-15 11:12:59', 'kieng ຮ້ານ', 1),
(7, 11, '0.00', '7000.00', 61, '2021-07-19', 'true', '', '2021-06-15 11:13:18', 'kieng ຮ້ານ', 1),
(8, 11, '0.00', '5000.00', 200, '2021-07-21', 'true', '', '2021-07-21 11:03:33', 'kieng ຮ້ານ', 1),
(9, 10, '0.00', '4500.00', 300, '2021-07-21', 'true', '', '2021-07-21 11:04:20', 'kieng ຮ້ານ', 1),
(10, 12, '0.00', '4000.00', 500, '2021-07-21', 'true', '', '2021-07-21 11:05:12', 'kieng ຮ້ານ', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ans_requirements`
--

CREATE TABLE `ans_requirements` (
  `_id` int(11) NOT NULL,
  `pro_id` int(11) DEFAULT NULL,
  `req_qty` int(11) DEFAULT NULL,
  `req_date` date DEFAULT NULL,
  `req_status` varchar(25) DEFAULT NULL,
  `approv_date` date DEFAULT NULL,
  `req_user_consumer` varchar(255) DEFAULT NULL,
  `req_user_provider` varchar(255) DEFAULT NULL,
  `req_note` varchar(255) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ans_requirements`
--

INSERT INTO `ans_requirements` (`_id`, `pro_id`, `req_qty`, `req_date`, `req_status`, `approv_date`, `req_user_consumer`, `req_user_provider`, `req_note`, `branch_id`) VALUES
(63, 5, 35, '2021-06-15', 'DONE', '2021-06-15', 'kieng9 ສີລາວິລາວົງ', 'kieng ຮ້ານ', NULL, 3),
(64, 4, 37, '2021-06-15', 'DONE', '2021-06-15', 'kieng9 ສີລາວິລາວົງ', 'kieng ຮ້ານ', NULL, 3),
(65, 7, 10, '2021-06-15', 'DONE', '2021-06-15', 'kieng9 ສີລາວິລາວົງ', 'kieng ຮ້ານ', NULL, 3),
(66, 9, 12, '2021-06-15', 'DONE', '2021-06-15', 'kieng9 ສີລາວິລາວົງ', 'kieng ຮ້ານ', NULL, 3),
(67, 10, 14, '2021-06-15', 'DONE', '2021-06-15', 'kieng9 ສີລາວິລາວົງ', 'kieng ຮ້ານ', NULL, 3),
(68, 5, 10, '2021-06-15', 'DONE', '2021-06-15', 'kieng44 ແກ້ວມີໄຊ', 'kieng ຮ້ານ', NULL, 1),
(69, 4, 20, '2021-06-15', 'DONE', '2021-06-15', 'kieng44 ແກ້ວມີໄຊ', 'kieng ຮ້ານ', NULL, 1),
(70, 7, 30, '2021-06-15', 'DONE', '2021-06-15', 'kieng44 ແກ້ວມີໄຊ', 'kieng ຮ້ານ', NULL, 1),
(71, 7, 20, '2021-07-19', 'DONE', '2021-08-05', 'kieng ຮ້ານ', 'kieng ຮ້ານ', NULL, 1),
(72, 5, 20, '2021-08-05', 'REQUESTING', NULL, 'kieng ຮ້ານ', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ans_sale`
--

CREATE TABLE `ans_sale` (
  `_id` int(11) NOT NULL,
  `pro_id` int(11) DEFAULT NULL,
  `sprice` decimal(10,2) DEFAULT NULL,
  `s_qty` int(11) DEFAULT NULL,
  `s_date` date DEFAULT NULL,
  `s_status` int(11) DEFAULT NULL,
  `s_note` varchar(255) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `s_createdAt` datetime DEFAULT NULL,
  `s_createdBy` varchar(255) DEFAULT NULL,
  `bill_no` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ans_sale`
--

INSERT INTO `ans_sale` (`_id`, `pro_id`, `sprice`, `s_qty`, `s_date`, `s_status`, `s_note`, `branch_id`, `s_createdAt`, `s_createdBy`, `bill_no`) VALUES
(27, 5, '4500.00', 18, '2021-06-09', 0, '', 1, '2021-07-21 10:53:21', 'kieng ຮ້ານ', 2107202002),
(28, 4, '4500.00', 5, '2021-06-16', 0, '', 1, '2021-08-05 22:28:19', 'kieng ຮ້ານ', 2107202002),
(29, 5, '4500.00', 20, '2021-07-07', 0, '', 1, '2021-07-21 10:53:21', 'kieng ຮ້ານ', 2107202002),
(35, 7, '6000.00', 16, '2021-06-09', 0, '', 1, '2021-08-05 22:28:12', 'kieng ຮ້ານ', 2107202002),
(36, 5, '4500.00', 9, '2021-07-20', 0, '', 1, '2021-07-21 10:53:21', 'kieng ຮ້ານ', 2107202926),
(39, 7, '6000.00', 8, '2021-07-20', 0, '', 1, '2021-08-05 22:28:12', 'kieng ຮ້ານ', 2107202926),
(40, 5, '4500.00', 3, '2021-07-20', 0, '', 1, '2021-07-21 10:53:21', 'kieng ຮ້ານ', 2107202926),
(41, 9, '6500.00', 1, '2021-07-20', 0, '', 1, '2021-07-20 16:44:18', 'kieng ຮ້ານ', 2107202926),
(42, 7, '6000.00', 4, '2021-07-20', 0, '', 1, '2021-08-05 22:28:12', 'kieng ຮ້ານ', 2107202926),
(43, 4, '4500.00', 4, '2021-07-21', 0, '', 1, '2021-08-05 22:28:19', 'kieng ຮ້ານ', 2107202926),
(44, 4, '4500.00', 5, '2021-08-05', 0, '', 1, '2021-08-05 22:28:19', 'kieng ຮ້ານ', 2107202926),
(45, 7, '6000.00', 4, '2021-08-05', 0, '', 1, '2021-08-05 22:28:12', 'kieng ຮ້ານ', 2107202926),
(46, 9, '6500.00', 3, '2021-08-05', 0, '', 1, '2021-08-05 22:28:29', 'kieng ຮ້ານ', 2107202926),
(47, 5, '4500.00', 7, '2021-08-05', 1, '', 1, '2021-08-05 22:33:57', 'kieng ຮ້ານ', 2107202926),
(48, 7, '6000.00', 2, '2021-08-05', 1, '', 1, '2021-08-05 22:34:15', 'kieng ຮ້ານ', 2107202926);

-- --------------------------------------------------------

--
-- Table structure for table `ans_stock_of_sale`
--

CREATE TABLE `ans_stock_of_sale` (
  `st_id` int(11) NOT NULL,
  `pro_id` int(11) DEFAULT NULL,
  `st_qty` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ans_stock_of_sale`
--

INSERT INTO `ans_stock_of_sale` (`st_id`, `pro_id`, `st_qty`) VALUES
(40, 5, 180),
(41, 4, 162),
(42, 12, 254),
(43, 7, 96),
(44, 9, 174),
(45, 10, 113),
(46, 11, 61);

-- --------------------------------------------------------

--
-- Table structure for table `member_user`
--

CREATE TABLE `member_user` (
  `id_user` int(11) NOT NULL,
  `profile_picture` varchar(150) DEFAULT NULL,
  `first_name` varchar(20) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `phone_number` int(11) NOT NULL,
  `email` varchar(150) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `position` tinyint(2) DEFAULT NULL,
  `joined_time` int(14) DEFAULT NULL,
  `branch_id` tinyint(3) DEFAULT NULL,
  `carSign` varchar(15) DEFAULT NULL,
  `status_id` tinyint(1) NOT NULL DEFAULT 1,
  `bank_acc_number` varchar(80) DEFAULT NULL,
  `basic_salary` int(11) DEFAULT NULL,
  `cv_id` int(6) DEFAULT NULL,
  `app_id_user` varchar(50) DEFAULT NULL,
  `app_device_user` varchar(20) DEFAULT NULL,
  `work_type` tinyint(1) NOT NULL DEFAULT 0,
  `approve` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `member_user`
--

INSERT INTO `member_user` (`id_user`, `profile_picture`, `first_name`, `last_name`, `phone_number`, `email`, `password`, `position`, `joined_time`, `branch_id`, `carSign`, `status_id`, `bank_acc_number`, `basic_salary`, `cv_id`, `app_id_user`, `app_device_user`, `work_type`, `approve`) VALUES
(1, 'http://www.anousith.express/ans_admin/images/uploads/_26-09-2019_2225971589111125Asset%202-100.jpg', 'kieng', 'ຮ້ານ', 55355248, 'kieng', '202cb962ac59075b964b07152d234b70', 2, 1569477528, 1, '5', 1, '', NULL, 0, NULL, NULL, 0, 1),
(570, 'https://anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'kieng2', 'ໂພທິສາລາດ', 56661970, 'kieng2', '202cb962ac59075b964b07152d234b70', 2, 1569895420, 1, 'ດທ 7699', 0, '', NULL, 12001, NULL, NULL, 0, 1),
(138, 'https://anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'kieng3', 'ເເກ້ວວົງໄຊ', 93296009, 'kieng3', '202cb962ac59075b964b07152d234b70', 3, 1569895481, 1, 'ຍມ 5054', 0, '', NULL, 11999, NULL, NULL, 0, 1),
(22, 'https://anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'kieng4', 'ສິນສະຫວັນ', 97994236, 'kieng4', '202cb962ac59075b964b07152d234b70', 4, 1569895531, 1, 'ດຄ 9935', 0, '', NULL, 12002, 'ed3c369e-36f2-4621-b773-01b864b89990', 'android', 0, 1),
(140, 'https://anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'kieng9', 'ສີລາວິລາວົງ', 58584825, 'kieng9', '202cb962ac59075b964b07152d234b70', 9, 1569895590, 3, 'ດພ4718', 0, '', NULL, 11997, 'ace9f510-0f73-4074-b6a9-e93e6bc5ddf4?appandroid', 'android', 0, 1),
(501, 'https://anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'kieng44', 'ແກ້ວມີໄຊ', 76150110, 'kieng44', '202cb962ac59075b964b07152d234b70', 5, 1569895629, 1, 'ດກ 0099', 0, '160120001707018001 POPPY CHANTHADALA MS', NULL, 12000, 'f7fd95d6-9d42-4f48-bd2f-3e26831f9fb5', 'android', 1, 1),
(142, 'https://anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ສຸດໃຈ', 'ພົມມະຈັນ', 55242256, '55242256', '1e7b586792f0c30b0295ff736806348f', 3, 1569895719, 2, 'ຍພ 2293', 0, '', NULL, 12003, 'e221d617-a185-4357-b7a5-70e3aeb03996', 'android', 0, 1),
(143, 'https://www.anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ວົງເເສງ', 'ລັດທິດາ', 56883525, '56883525', '5f2e120aed774482a3b1433ce78d621a', 3, 1569896662, 1, 'ດລ 9963', 0, '010120000102247001 KHAMPHENG LATHIDA MR', NULL, 11998, '39008eb2-af01-4e51-8fea-49f8473ab382?appandroid', 'android', 1, 1),
(145, 'https://www.anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ສອນທະວີ', 'ຊະນະເລີດ', 98808098, 'ສເເ', '1ad108a72269caa03db045062f8fb512', 3, 1570239571, 2, 'ດມ0935', 0, '', NULL, 12033, 'f512211f-c6dd-4787-be19-c4bcca82fe3e?appandroid', 'android', 0, 1),
(146, 'https://www.anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ຂັນຕິ', 'ສຸວັນນະລາດ', 59706505, 'ສສ', '10ef14caaeddf18d1787271a3e137088', 3, 1570239638, 5, 'ດຕ3050', 0, '', NULL, 12034, NULL, NULL, 0, 1),
(147, 'https://www.anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ຈັນໂທ', 'ທອງສະຫມຸດ', 59201786, 'ຮຮ', 'c510185b17a68242381c4d0c53f62a79', 3, 1570671615, 1, '', 0, '', NULL, 12046, 'cdc6d1eb-ff02-4c2c-8cb0-27548ab0e683?appandroid', 'android', 1, 1),
(148, 'http://www.anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ນິນທະກອນ', 'ສິນທະລາດ', 54905097, 'ວສວສາ', '9f02ae6b01f9d5e7b71a86a08ff249b8', 3, 1570675066, 1, 'ດຄ 0964', 0, '', NULL, 12045, '25decc33-4129-4c84-a36d-d91978757a5d?appandroid', 'android', 1, 1),
(149, 'https://www.anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ສັກດາ', 'ແກ້ວບຸນທັກ', 97657102, 'ສແສແສ', '9cfbae0f5d810496d7957adbb814141a', 3, 1571454616, 1, 'ດດ1616', 0, '160120001809196001 CHINTANA SOUTTHIYA MRS', NULL, 12096, 'ff93249b-4429-418a-98be-6af63aa44c87', 'android', 1, 1),
(179, 'https://www.anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ນັດທະຄອນ', 'ວັນນະສະໝີ', 55201034, '55201034', '0b058ee83bf483b2f88e5967dbd3a7e8', 3, 1575343958, 2, 'ດວ8572', 0, '', NULL, 12720, 'f588329c-ea40-493d-ad02-25af3468fb35?appandroid', 'android', 0, 1),
(150, 'https://www.anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ດາລີ້ງ', 'ລັດຕະນະປະເສີດ', 56658859, 'ສວ', '16dc10a9a7daa47e5a5448fc2e70d522', 3, 1571625659, 14, 'ຍັງບໍມີປ້າຍ', 0, '160120001278894001', NULL, 12041, 'ba0ceca9-5647-4b99-aa91-489fd0bd21fb', 'android', 0, 1),
(151, 'https://www.anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ພູວົງ', 'ບຸນຈັນທະວົງ', 58880504, 'ສກສກ', '0bdb99ad71a531416c758d91261ccdb1', 3, 1571650641, 1, 'ຈຄ 4451', 0, '', NULL, 12112, NULL, NULL, 1, 1),
(152, 'https://www.anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ວົງໄຊ', 'ໄຊຍະວົງ', 92695182, 'ຫາຫ', '50247cf5f9c3ae7f436497d353817436', 3, 1571652140, 1, 'ດຫ 4090', 0, '', NULL, 12114, 'acaebd37-fd9f-4eae-aac4-f72abd26ba54?appandroid', 'android', 1, 1),
(153, 'https://www.anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ສົມພົງ', 'ດີທະວົງ', 78043645, 'ວສ', '7e06476d8e28e58cad404d55a658ba7b', 3, 1572253066, 1, 'ດຄ 6313', 0, '010120001465362001 somphong deethavong mr', NULL, 12173, '8ede3e50-162b-4c5e-bcfc-4346f285ddd1?appandroid', 'android', 0, 1),
(154, 'https://www.anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ວືລີ', 'ຈົງກົວ', 54300706, '54300706', 'cfdf96459e8437cc1e62e3b11da8d344', 3, 1572253385, 4, 'ຈນ 1316', 0, '160120001151811001 vuelee longkua mr', NULL, 12174, 'e4c47755-d05a-44ad-a418-41901f4c7e61?appandroid', 'android', 0, 1),
(155, 'https://anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ເເສງອາລຸນ', 'ຄຳວິໄລ', 55058057, '55058057', '7ee4459bfe347601a5eab5bdfb4cc41d', 3, 1572492581, 1, 'ດຂ 5316', 0, '092120001613261001 per soutthichuck ms', NULL, 12198, 'd21ae84f-3229-44e9-a91b-e3bed8c9ab45?appandroid', 'android', 0, 1),
(372, 'http://anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account_for_hr.php', 'ເຮີ່ກື', 'ແກ່ວລົມ', 77406137, '77406137', '0f70d4c01f461428ee3d38fd07016d31', 3, 1591243529, 1, 'ດລ0483', 0, NULL, NULL, 15973, '5f1fec12-135c-4678-a676-e0e7445c4d56?appandroid', 'android', 1, 1),
(156, 'https://www.anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ກິນ້ອຍ', 'ເຂັມມະລາດ', 95088061, 'ທວ', 'd73131d77f4d1eab6c1c22a93014f0b8', 3, 1573090601, 1, 'ດມ 3393', 0, '', NULL, 12266, '93d39b66-93e8-4ec9-8476-969d4a04949b?appandroid', 'android', 0, 1),
(157, 'https://www.anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ວິລະໄຊ', 'ສີສົມບັດ', 98272556, 'ວສ', '0b2c3336b412561f184239c36004ce56', 3, 1573178344, 1, 'ບໍ່ທັນມີປ້າຍ', 0, '160120001680057001 kingsouda maniseng ms', NULL, 12312, '770a039c-2e91-40d5-96a0-8d08e8fa8fc9', 'android', 0, 1),
(158, 'http://www.anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ສັນຕິ', 'ສາຍເເກ້ວ', 59572990, 'ກດ', 'cd4e837f2958b0c0c74a2d6a0b3f4cd8', 3, 1573696904, 3, 'ບໍ່ທັນມີປ້າຍ', 0, '222120001510591001 SANTI SAYKEO MR', NULL, 12373, '6546824e-969b-43b7-be9e-485946c76b70?appandroid', 'android', 0, 1),
(162, 'https://anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ບິນລີ້', 'ໂພທິສັດ', 22883635, '22883635', 'c1b477de3cbbaf51bb861b5361356722', 3, 1573905899, 1, 'ດທ 1133', 0, '160120001278215001 MR BINLY PHOTHISATH', NULL, 12396, '91b2eb5c-09a7-4ccb-8779-90ebf544c253', 'android', 1, 1),
(159, 'https://www.anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ສົມໃຈ', 'ໄຊຍະສານ', 95690221, 'ວດວ', '5526126935565aedf6be75918117d3d6', 3, 1573783895, 1, 'ຍຕ2847', 0, '', NULL, 12383, '9088b74f-8d51-4504-a90c-69f20fe57efa?appandroid', 'android', 1, 1),
(160, 'http://anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ສຸກ', 'ໜູນສະຫວ່າງ', 58488754, '58488754', '8e53c1ebe3d11483a11a4c0d98fac049', 3, 1573805926, 1, 'ດພ 5051', 0, '', NULL, 12386, NULL, NULL, 1, 1),
(161, 'http://anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ທັດສະພອນ', 'ທອງສຸຈິນ', 58507169, '58507169', 'ad0c227a86d2432a3828139edbcd5dd4', 3, 1573813912, 1, '12388', 0, '096120001137601001 yhatsaphone thongsoulin mr', NULL, 12388, '5d73a453-e447-4d4b-ae30-543adc53922d?appandroid', 'android', 1, 1),
(163, 'http://www.anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ວິໄລ', 'ວີລະກົງ', 91081264, '91081264', 'f70bbc2a7dfc37662e100f641b699f96', 3, 1574043230, 1, 'ດຣ7765', 0, '', NULL, 0, '8e13faf4-c615-42aa-8c4d-6eda5b444105?appandroid', 'android', 0, 1),
(164, 'http://anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ວິໄລ', 'ວິລະກໍ', 91081265, '91081265', 'f70bbc2a7dfc37662e100f641b699f96', 3, 1574050981, 1, 'ດຮ 7765', 0, '093120001473368001 vilai vilakor ms', NULL, 12404, '8e13faf4-c615-42aa-8c4d-6eda5b444105?appandroid', 'android', 1, 1),
(165, 'http://anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ຄຳຫຼ້າ', 'ທິບພາວັນ', 28262337, '28262337', 'b70fd88ca95e4c71a17a8ecaacb41601', 3, 1574051072, 1, 'ຕທ 5552', 0, '092120000970766001', NULL, 12405, NULL, NULL, 1, 1),
(167, 'https://www.anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ຄຳຫລ້າ', 'ທິບພາວັນ', 28262338, 'ສກກສ', '447e23df5e67ac9d54c68ba7f623ee29', 3, 1574132750, 1, 'ຕທ5552', 0, '092120000970766001 ', NULL, 12405, 'f5ed8c2c-f441-4d1b-ad08-2862724aeb09', 'android', 1, 1),
(171, 'https://www.anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ມະນີວົງ', 'ໄຊແສນຮັກ', 99558344, 'ມປມກມ', 'add44306bc33cc915c5e5c34e3fcf440', 3, 1574564277, 1, 'ດອ2765', 0, '', NULL, 11795, NULL, NULL, 1, 1),
(169, 'http://anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ຕົ້ນຕານ', 'ຕົ້ນຕານ', 54903701, '54903701', '596e1c0725933193f34bee73f2b7d022', 3, 1574481729, 1, 'ດບ 3982', 0, '090120000246802001 ngonkham mrs', NULL, 12451, 'b9ed230a-08b7-4958-a21a-e0c3e600236f', 'android', 1, 1),
(170, 'http://anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ສຸພາກິດ', 'ສຸພາກິດ', 93371504, '93371504', '42ed214594a6b4755803223cd1ab9790', 3, 1574481770, 1, 'ດຂ 6403', 0, '165120001786484001 ', NULL, 6403, '2972dd09-03b1-4d29-8826-18321e12ffd2', 'android', 1, 1),
(172, 'http://anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', ' ທິດາວັນ ', 'ແກ້ວອີນຕາ', 55121117, '55121117', 'f93853926f868adbc00c5f99385ca3c6', 2, 1574656772, 52, 'N/A', 1, '160120001174834001 THIDAVANH KEOINTA', NULL, 10790, NULL, NULL, 0, 1),
(173, 'http://anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ສຸພັນສາ ', 'ສຸພັນ', 97966741, '97966741', '6fc8c91ace7a067306fea9d0efd51059', 2, 1574656847, 1, 'None', 0, '', NULL, 12243, NULL, NULL, 0, 1),
(174, 'http://anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', ' ດາວັນ ', 'ອິນຖາວອນ', 54326678, '54326678', '6a204bd89f3c8348afd5c77c717a097a', 2, 1574656870, 1, 'NONE', 0, '142120000713364001 DAVANH INTHAVONE MS', NULL, 12429, NULL, NULL, 0, 1),
(175, 'http://anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ແກ້ວມະນີໄສ', 'ແກ້ວມະນີໄສ', 91341250, '91341250', '130bda54b7e6d602aa910bfa711af11f', 3, 1574671824, 1, 'ບຕ 0008', 0, '', NULL, 12562, 'da8f1b3e-7467-44ea-8bad-c7f34680135b', 'android', 1, 1),
(176, 'http://anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ສຸລິນທອງ', 'ສຸລິນທອງ', 56221015, '56221015', '963ae4d2fa343e1b36939f435917a6fd', 3, 1574753825, 1, 'ດຂ 8528', 0, '160120000986926001 ສຸລີນທອງ', NULL, 12514, '1b920900-ba88-4507-8daf-ebafe1f7edee?appandroid', 'android', 1, 1),
(177, 'http://anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ແອນຕີ້', 'ແອນຕີ້', 95421195, '95421195', '1952431526341b0b8d289c4439c9eb20', 3, 1574836168, 1, 'ດຂ 8325', 0, '', NULL, 12582, NULL, NULL, 1, 1),
(178, 'http://anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ພຸດສະຫວັນ', 'ພຸດສະຫວັນ', 96468196, '96468196', 'ed6396a4a89af91c32a925f3b76ab16e', 3, 1574932052, 1, 'ດຈ 8933', 0, '', NULL, 12670, NULL, NULL, 1, 1),
(182, 'http://anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ແມ່ບ້ານ', 'ແມ່ບ້ານ', 0, '00000000', 'f50c7286b540bb181db1d6e05a51a296', 2, 1575433983, 1, '00000000', 1, '151120000570409001', NULL, 0, NULL, NULL, 1, 1),
(181, 'https://anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ຄຳສອນ', 'ວັນນະສອນ', 97616329, '97616329', '180044857b0068e93095230573c960ab', 3, 1575367956, 1, 'ຍທ6329', 0, '', NULL, 12723, 'f7ea21af-8210-44f6-a2ec-848f7a27ab54?appandroid', 'android', 1, 1),
(183, 'http://anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ຈິດປະສົງ', 'ທຳມະຮັກ', 76001811, '76001811', 'd717a74efff1d0885d9556a37a0c48f2', 3, 1575447357, 1, 'ດທ 6029', 0, '221120001500028001 CHITPASONG THAMMARAK', NULL, 12591, '500716e1-37e2-4ba9-af79-5971c168c910?appandroid', 'android', 1, 1),
(184, 'https://www.anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ດາວັນ', 'ອິນຖາວອນ', 54326678, 'fgf', '612e5cac3675db2b9dc2edb717a621fc', 2, 1575454633, 1, '', 0, '', NULL, 0, NULL, NULL, 1, 1),
(185, 'http://anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ອຸ່ນເຮືອນ', 'ແກ້ວພົງເພັດ', 54785553, '54785553', '624fecd682fdde271c103c7c2a0c339a', 3, 1575520549, 1, 'ດນ 1073', 0, '160120001194060001 OUNHUEAN KEOPHONGPHET MR', NULL, 12594, 'b28f2727-1db3-4a0d-8b53-9213b2b6e929', 'android', 1, 1),
(187, 'http://anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ບຸນລັດ', 'ສີບຸນມີ', 97914688, '97914688', '63341ca93fc262a8558a3fb9d0b27ca6', 3, 1575541703, 1, 'None', 0, '090120001643470001 BOUNLATH SIBOUNMY MR', NULL, 12838, '43ac1925-ed84-4e54-9860-348b860fa983?appandroid', 'android', 1, 1),
(188, 'http://anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ຂັນທະລີ', 'ທຳມະວົງ', 93967262, '93967262', 'b381bc521ed2e3ba75246ffacbd80ba2', 3, 1575541785, 1, 'ຈຫ 9531', 0, '090120001421326001 KHANTHALY THAMMAVONG', NULL, 12622, '2e8f0ab9-c95f-4342-9eb4-d4fdca1a07f6?appandroid', 'android', 1, 1),
(189, 'http://www.anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'shipper', ' office', 96336943, 'bnbn', 'f7c48f6c8e101e7f93b026d69195c991', 3, 1575555855, 1, '', 1, NULL, NULL, 121212, '2678ea14-07e8-4026-8f68-2b4195956306?appandroid', 'android', 0, 1),
(191, 'http://anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ບຸນມີ', 'ລໍຄຳສາຍ', 55141350, '55141350', '7cd76d722d10154738b3dd7134d14bae', 3, 1575873618, 1, 'ດຫ 8526', 0, '', NULL, 12955, NULL, NULL, 0, 1),
(190, 'http://anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ທິນນະກອນ', 'ຊົມໄຊຜົນ', 55125291, '55125291', '75f2e3461ee72c7f71ab031ba063e599', 3, 1575605860, 2, 'ດລ 5859', 0, '', NULL, 12851, '1f4db50e-31ec-408e-9b12-bf4bcf638223?appandroid', 'android', 0, 1),
(192, 'http://anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ອ່ອນສີ', 'ມະນີວົງ', 58118095, '58118095', 'a89f406a4d0211cd460b0eecd3a49d06', 3, 1575873660, 4, 'ດທ 6591', 0, '096120001756160001PHOUTSADY SENGVIXAI MS', NULL, 12931, '175caec3-8249-490f-87d6-b4b5019ff96e', 'android', 0, 1),
(193, 'http://anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ບຸນປະເສີດ', 'ພິລາວົງ', 92822580, '92822580', 'bacd8661f0d5e0a2c69d5b99ee9929b6', 3, 1575876170, 3, 'ຍຫ 4782', 0, '010120000250808001 manochith khamxaykhay miss', NULL, 12836, 'a73cf276-f25f-4b08-8887-41d96290cc9f', 'android', 0, 1),
(194, 'http://anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ສຸກທະວີ', 'ມະນິວັນ', 59842963, '59842963', '274904a58539d0ea85f5e7858048f2bd', 3, 1575881639, 3, 'N/A', 0, '221120001730005001 SOUKTHAVY MANYVANH MR', NULL, 12952, 'f3cda4d5-7650-4fb6-a934-b9481b43444c?appandroid', 'android', 0, 1),
(195, 'http://anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ຈິລະເດດ', 'ຈັນເພັງ', 77881007, '77881007', '14f64fdf3c8360368774dab999f80dcf', 3, 1575943758, 1, 'ຕຂ 3838', 0, '101120001354644001 chanpheng chiladeth', NULL, 12863, '585db16c-cb67-4411-b76a-dcaba662e1be', 'android', 1, 1),
(196, 'http://anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ທອງເພັດ', 'ຄຳພູນວົງ', 56451695, '56451695', 'ed50e945d1165817429bbb5f8da5e555', 3, 1575943828, 1, 'ຈສ 0779', 0, '010120000958173001 ', NULL, 12975, 'b2116cb5-fbf3-417a-8524-52ee8398f142?appandroid', 'android', 1, 1),
(197, 'http://anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ໄພລິນ', 'ສີມາເຮືອງ', 56100105, '56100105', 'd9b0a9338dd39c5f5f3fa9b21e91ff5f', 2, 1575943876, 1, 'ບໍ່ລະບຸ', 0, '', NULL, 12829, NULL, NULL, 0, 1),
(198, 'http://anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ພຸດທະສິນ', 'ສິລິວັນ', 54511279, '54511279', '45caba3f6b4491b1b297a449cc2ffd79', 3, 1575958116, 1, 'ດຄ 0190', 0, '092120001133551001 PHATTHASONE VILAIVANH MR', NULL, 12540, 'b4545f2d-3d1d-4e12-b72c-b8adaeace4a5', 'android', 1, 1),
(199, 'https://www.anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ໄອເເສງ', 'ທະວີຫວາ', 52030010, 'ກສ', 'ddb32a85716ed3cdcaebc66a26b39bca', 3, 1576032928, 32, 'ຈຈ1585', 0, '096120001230758001', NULL, 12972, '7264e21b-d49b-4491-a013-9c607f3ce7f2', 'android', 0, 1),
(200, 'http://anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ກິກົງ', 'ພົມມະສີ', 55553290, '55553290', '99d606b03c5a08f92b4c7590a0e466ac', 3, 1576035315, 1, 'ກຍ 6162', 0, '016120001315656001 MR KIKONG', NULL, 12950, 'ffe854ab-4763-4604-862a-9bc62fb39cb3?appandroid', 'android', 1, 1),
(201, 'https://www.anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ສີວອນ', 'ນະຂຸນສີ', 54440440, 'ກາກ', '01b6650ab252fb0433161f031765ce81', 3, 1576050555, 1, 'ຈຈ4796', 0, '160120000219073001 SYVONE NAKHOUNSY', NULL, 13073, '5121b31d-9602-4329-a2aa-b50e13a70a0c?appandroid', 'android', 1, 1),
(202, 'https://www.anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ສຸວິນ', 'ໄຊສົມບັດ', 58422326, 'ງວ', '31c18a564d99263db8cda58c5bc55090', 3, 1576114238, 1, 'ທດ2225', 0, '', NULL, 13045, 'f6c4bb68-b82c-46b5-a421-156ba94d19d5?appandroid', 'android', 1, 1),
(203, 'https://www.anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ເເມັກກີ້', 'ສີລາວົງ', 92741495, '92741495', '20f150ab3a2e76101af0ef51756d0b27', 3, 1576114294, 1, 'ດມ9384', 0, '', NULL, 12532, 'a18e331f-fcdb-40c1-ae7e-05bd2ff98dd1', 'android', 1, 1),
(204, 'http://anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ວິສະນຸ', 'ທຳມະວົງສາ', 93749203, '93749203', '5943f2cd4e7a66ca1924d118488636ff', 3, 1576136619, 1, 'ຍຫ 8044', 0, '', NULL, 13022, '1043caae-f153-4c06-8742-db8e1eb60618?appandroid', 'android', 0, 1),
(205, 'http://anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ເພັດ', 'ມະນີວັນ', 54023898, '54023898', '8b78f1b59c4c734710db6c4ea240c6e8', 3, 1576136663, 4, 'ຈນ 7676', 1, '164120001303545001', NULL, 13042, '97755064-05c2-44d8-bdf1-42fcb8148b01?appandroid', 'android', 0, 1),
(206, 'http://anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ພຸດທະລີ', 'ສຸລິນທຳ', 97488984, '97488984', '05a6dda72b58a3a8fdfa4e944ed6e2f8', 4, 1576226187, 1, 'N/A', 1, '151120000570409001', NULL, 12695, NULL, NULL, 1, 1),
(207, 'http://anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ສຸກສາລີ', 'ມີສົມພານ', 59196620, '59196620', 'ef07f3787d90d45d2c74ebd7efa49727', 3, 1576474799, 3, 'ດອ 4258', 0, '', NULL, 12969, NULL, NULL, 0, 1),
(208, 'http://anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ຈັນທອງ', 'ວຽງວິໄຊ', 54333528, '54333528', 'f6c038cb3dce7d702e3a64a29a842e1c', 3, 1576474860, 1, 'ຍອ 9233', 0, '160120001548100001 CHANTHONG VIENGVIXAY', NULL, 12779, '780b7795-7593-4d89-91ed-b5c5def8ed58?appandroid', 'android', 1, 1),
(209, 'http://anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ລາໂດ່', 'ແກ້ວບຸນເຮືອງ', 52923158, '52923158', 'cb1d1a2584a7f7851ee0e7d00135c1ae', 3, 1576474950, 1, 'ດດ 9999', 0, '', NULL, 13183, '5be484fb-893b-46fe-ac3f-9a92220d7078', 'android', 1, 1),
(210, 'http://anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ສຸກທະວີໄຊ', 'ອິນທະລັງສີ', 55694848, '55694848', '3acdba10a91c0a595b1e8958e3a50110', 3, 1576560617, 1, 'ດຈ 5266', 0, '', NULL, 8854, '39573ddb-72ff-4b24-b1f8-2e3208760be0?appandroid', 'android', 1, 1),
(214, 'http://anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ວິລະພາບ', 'ອານຸລັກ', 77864878, '77864878', 'bc6e92118b5d03536d628ddfc5478238', 3, 1576673404, 1, 'ຈດ 5019', 0, '', NULL, 13197, NULL, NULL, 1, 1),
(213, 'http://anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ນຸດນາລິນ', 'ພັນສະຫວັດ', 59166699, '59166699', '770596b16d20934f123a33d11703ea3e', 2, 1576637923, 1, 'N/A', 0, '160120001077223001 NOUDNALIN PHANSAVATH', NULL, 12212, NULL, NULL, 0, 1),
(215, 'http://anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ພຸດທະວົງ', 'ຫຼວງລາດ', 54813599, '54813599', 'fad295c6b88f685d11a8de40d0fd20a1', 3, 1576673455, 1, 'ດຕ 7575', 0, '', NULL, 13182, NULL, NULL, 1, 1),
(216, 'http://anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ສຸກສະຫວັດ', 'ຈັນທະວີ', 58803821, '58803821', 'ac0c794fc15a5705dff6dd905946dcf6', 3, 1576673492, 1, 'ຍລ 9998', 0, '', NULL, 13158, NULL, NULL, 1, 1),
(217, 'http://anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ກິໂນ່', 'ມະໂນທຳ', 58977950, '58977950', 'ee64587bfd140c30d5546e0a7fb202c9', 3, 1576730418, 1, 'ດຄ 9887', 0, '160120001397573001 KINO MANOTHAM', NULL, 13213, '5039ffd4-dd31-4b7d-8250-4c167616bbdd?appandroid', 'android', 1, 1),
(218, 'http://anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ພຸດທະສອນ', 'ສຸດທະວົງ', 55775930, '55763377', '876f9deefc0e6c16589cd69508eb877b', 3, 1576809089, 1, 'ດຜ 2946', 0, '160120001418415001 MR PHOUTTHASONE STV', NULL, 13245, '9bc344d4-abff-4f51-b632-85c2c2ffefad?appandroid', 'android', 1, 1),
(219, 'http://anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ອານຸສອນ', 'ສີສຸນິນ', 78111919, '78111919', 'f0c4a2a8bcab0a6a21a57ab11e35e944', 3, 1577159892, 2, 'ດຂ 0516', 0, '093120001012104001 VILAISACK CHOUMPADITH MS', NULL, 13326, '5ad90063-2f5c-4ce7-bdbb-2c26b0d2a9fd?appandroid', 'android', 0, 1),
(220, 'https://www.anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'Shipper ', 'office SK', 96336942, '00', 'c0d9962d2c6600bf1217c22dddcaaf94', 3, 1577176515, 2, '', 1, '', NULL, 121213, '9c7d32d8-11ab-42ec-9e79-925ddd5b3ab6?appandroid', 'android', 0, 1),
(222, 'http://anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account_for_hr.php', 'ແສງຍາລິດ', 'ກິລິຍາພອນ', 59404426, '59404426', '0bfc09d4205f000cd4988cc8b703d872', 3, 1577254058, 1, 'ປ້າຍໃຫມ່', 0, '010120001692657001 PHOUNMIPHON NABANDIT', NULL, 13336, '0ed92d87-ea1a-4246-8e73-64b2f586c721?appandroid', 'android', 1, 1),
(223, 'http://anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account_for_hr.php', 'ສຸລິນທອນ', 'ດວງດາລາ', 98651328, '98651328', '31ea84ebe9545231c9ead4bd2facb853', 3, 1577323891, 1, 'ດກ4869', 0, '096120001756505001 ', NULL, 12942, '7509b3b6-5776-4b14-92de-9e827b74a1a0?appandroid', 'android', 1, 1),
(224, 'http://anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account_for_hr.php', 'ວິລັດດາ', 'ກິດຕິພອນ', 55006030, '55006030', 'ec32186511cab9e8cdc7b5aae93135d1', 3, 1577329764, 6, 'ດລ6562', 0, '010120000293537001 VILADA KITIPHONE', NULL, 13243, 'e61cda48-473c-4a24-a29d-8ac082e49578?appandroid', 'android', 0, 1),
(225, 'http://anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account_for_hr.php', 'ສຸກອຳໄພ', 'ແສນບຸດຕະລາດ', 76123445, '76123445', 'c0cd622121445ffc548338a15535e24b', 3, 1577337037, 1, 'ຍຕ1037', 0, '', NULL, 13281, NULL, NULL, 1, 1),
(226, 'http://anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account_for_hr.php', 'ດອກໂບລີ', 'ແສນທະວີສຸກ', 58808210, '58808210', 'bb57ad64e88034e575278172195fa378', 3, 1577436398, 3, 'ດມ8965', 0, '222120001738799001 DOKMALI SENTHAVISOUK MR', NULL, 13050, '40421016-f864-4127-9141-a3e1ab41571d', 'android', 0, 1),
(227, 'http://anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account_for_hr.php', 'ວາດສະໜາ', 'ສ້ອຍສຸວັນ', 54193994, '54193994', '6840d87bdd80a459e749c82060ed0830', 3, 1577436580, 1, 'ດຜ7644', 0, '090120001403745001 ', NULL, 13362, 'b849521e-201e-48e8-a118-2195a2bbef34?appandroid', 'android', 1, 1),
(228, 'http://anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account_for_hr.php', 'ແຄັບ', 'ໃບຄຳພູ', 91818016, '91818016', 'bd92e7777f6d8adada2bdefb85540c94', 3, 1577436786, 1, 'ຈຍ6290', 0, '220120001731704001', NULL, 13287, '087715e6-3b43-48a8-8931-5906538f9066?appandroid', 'android', 1, 1),
(230, 'http://anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account_for_hr.php', 'ສຸລິຍັນ', 'ປິຍະວົງ', 58657443, '58657443', '557334e3657a47247c5aad9420f24fe2', 3, 1577693525, 32, 'ຍດ5177', 1, '160120001508081001', NULL, 13437, '266d65c5-37f5-4c1d-a663-2a92ac9c661b', 'android', 0, 1),
(300, NULL, 'kieng', 'ctx', 56676624, 'kienggnet@gmail.com', '202cb962ac59075b964b07152d234b70', 4, NULL, 1, NULL, 1, NULL, NULL, NULL, NULL, NULL, 0, 1),
(20, 'http://anousith.express/ans_admin/images/uploads/_19-03-2019_147505515726748913600236_587109648134593_3238505962951368614_n.jpg', 'ເອກກະສິດ ', 'ວິລະດາ', 55355246, 'aek23@ans.la', 'b6979d01151250d84deb1873e5180ba7', 1, 1487908829, 1, 'ກກ 9999', 1, '094120000915132001', 800000, 10001, '92583808-4a46-4a4e-a13c-485651542479', 'android', 0, 1),
(34, 'http://anousith.express/ans_admin/images/uploads/_19-03-2019_8672966152210916site_login.jpg', 'ບຸນທະວີ', 'ບຸນທະວີ', 54818617, 'abc@', 'dba707bba4be488292bc8ade882ee4fd', 2, 1551698698, 23, '', 1, '221120001024360001', NULL, 11792, '0188eef0-5eb0-48e1-97b0-1b4f9a7b8b60?appandroid', 'android', 0, 1),
(33, 'https://anousith.express/ans_admin/images/uploads/_19-03-2019_872402030793352site_login.jpg', 'ຄຳຈັນ', 'ອິນທິບຸນຍະຮອງ', 59798444, 'abc', '15b148fe33a65c09163b5513c1e89af9', 3, 1551698636, 1, '', 0, '160120000957738001BOUNLA PANYACHITH MR', NULL, 11816, 'a6f2f625-ac9e-473a-a862-cc3bbb6df3c2?appandroid', 'android', 0, 1),
(32, 'https://anousith.express/ans_admin/images/uploads/_19-03-2019_5118670522894312site_login.jpg', 'ດອກຄູນ', 'ດວງພະຈັນ', 59361964, 'abc', 'f32866345459fa956a5b77ae5d604e0d', 2, 1551698499, 2, '', 0, '140120000901502001', 1600000, 11790, NULL, NULL, 0, 1),
(29, 'http://anousith.express/ans_admin/images/uploads/_19-03-2019_318623126655747117990865_437022736651019_4543699138829233534_n.jpg', 'Anousith', 'Director', 97285066, 'anousithexpress9999@gmail.com', '5d1b94e4d1d72caaa9021afda4d7644f', 1, 1551694620, 1, '', 1, '142120001087371001', 1200000, 1111, '3a80b1e5-24e7-437d-bd44-786a5eb4ea5a?appandroid', 'android', 0, 1),
(56, 'http://anousith.express/ans_admin/images/uploads/_19-03-2019_2863976890933403site_login.jpg', 'ວາດສະໜາ ', 'ອ່ອນນວນ', 54322555, 'ສວກຫສ', 'c788f0a4aebab7ca21c556eb38e0579f', 9, 1552621858, 1, '', 0, '160120001667249001 VARTSANAR ONNUAN', 1550000, 9289, NULL, NULL, 0, 1),
(31, 'http://anousith.express/ans_admin/images/uploads/_19-03-2019_4115798758860172site_login.jpg', 'ສອນເພັດ', 'ເເກ້ວດວງຈັນ', 96376919, 'abc', '305cfd6676fe6831dc9c7f0a288f88e1', 2, 1551698402, 3, 'AB1234', 0, NULL, NULL, NULL, NULL, NULL, 0, 1),
(35, 'http://anousith.express/ans_admin/images/uploads/_19-03-2019_1005137746381751site_login.jpg', 'ຄຳຫວັນ', 'ຄຳຫວັນ', 55242128, 'abc', '670b14728ad9902aecba32e22fa4f6bd', 3, 1551698783, 2, '', 0, NULL, NULL, NULL, NULL, NULL, 0, 1),
(36, 'http://anousith.express/ans_admin/images/uploads/_19-03-2019_8672966152210916site_login.jpg', 'ວັນໄຊ', 'ວັນໄຊ', 56347123, 'abc', '513be1ad8eb2506ad942746ad8e5fea3', 3, 1551698862, 4, 'ຍທ 7049', 0, '090120000898925001          VANHXAI LUTDAVAN MR', NULL, 11868, '570ec2da-70c0-47e2-b97f-aab7bffcfa49', 'android', 0, 1),
(37, 'https://anousith.express/ans_admin/images/uploads/_19-03-2019_8672966152210916site_login.jpg', 'ຂັນ', 'ຂັນ', 56062368, 'abc', '670b14728ad9902aecba32e22fa4f6bd', 3, 1551698916, 2, '', 0, '010120001373827001', NULL, NULL, NULL, NULL, 0, 1),
(38, 'http://anousith.express/ans_admin/images/uploads/_19-03-2019_8672966152210916site_login.jpg', 'ແພງ', 'ເເພງ', 54999672, 'abc', '441464d7f49abd1980e163ce6086f03c', 3, 1551698981, 3, 'ດລ 5753', 1, '010120000581547001', NULL, 10039, '5af1d82b-be8b-4e7e-b564-25db5e7d8964?appandroid', 'android', 0, 1),
(67, 'http://anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ບຸນທະຫນອມ', 'ອິນທິສາດ', 59434930, 'l', 'af91fa0bfb731f946acaceebe838f69f', 3, 1553224337, 1, 'ດຄ 1684', 0, '', NULL, NULL, NULL, NULL, 0, 1),
(40, 'http://anousith.express/ans_admin/images/uploads/_19-03-2019_8672966152210916site_login.jpg', 'ດາວັນ', 'ຈັນທະລັງສີ', 97067925, 'abc@', '60a9ddbdacdc72534bd7c489ff2d8cc3', 2, 1551862425, 1, '', 1, '096120001230758001', 1800000, 11778, '85baa602-106e-4037-afde-465160dbf7b1', 'android', 0, 1),
(41, 'http://anousith.express/ans_admin/images/uploads/_19-03-2019_8672966152210916site_login.jpg', 'ຈ່ອຍ', 'ບຸນນອງ', 56044667, 'abc', '3d6a968a7baca22ed7763c660bc844fd', 3, 1551930527, 3, 'ຕວ 9797', 0, '010120001146759001', NULL, NULL, NULL, NULL, 0, 1),
(42, 'http://anousith.express/ans_admin/images/uploads/_19-03-2019_8672966152210916site_login.jpg', 'ຈັບ', 'ຈັບ', 58595371, 'abc', '670b14728ad9902aecba32e22fa4f6bd', 3, 1551930811, 2, '', 0, NULL, NULL, NULL, NULL, NULL, 0, 1),
(43, 'http://anousith.express/ans_admin/images/uploads/_19-03-2019_8672966152210916site_login.jpg', 'ຕິກ', 'ຕິກ', 34, 'abc', '670b14728ad9902aecba32e22fa4f6bd', 3, 1551931241, 2, '', 0, NULL, NULL, NULL, NULL, NULL, 0, 1),
(45, 'https://anousith.express/ans_admin/images/uploads/_19-03-2019_8672966152210916site_login.jpg', 'ທອນ', 'ທອນ', 0, '0', '670b14728ad9902aecba32e22fa4f6bd', 3, 1551939480, 1, '', 0, NULL, NULL, NULL, NULL, NULL, 0, 1),
(46, 'http://anousith.express/ans_admin/images/uploads/_19-03-2019_8672966152210916site_login.jpg', 'ແບ້ງ', 'ແບ້ງ', 77703132, 'ມວຶ', 'd25b594b2f661f799a5ae681ee2f5f21', 3, 1551939510, 1, '', 1, '165120002002758001', NULL, 11782, '4216fbe5-4e46-450e-b83c-870f20e2ad99', 'android', 0, 1),
(47, 'http://anousith.express/ans_admin/images/uploads/_19-03-2019_8672966152210916site_login.jpg', 'ບຸນຜາ', 'ບຸນຜາ', 98866646, '98866646', 'f76747b61e1d6028419f697f7833309a', 3, 1551939549, 1, 'ຍດ 4368', 0, '163120001521186001 BOUNPHA PHOMMACHACK MR', NULL, 11804, '71a8a45d-717f-4563-9b99-25a65d202b26', 'android', 0, 1),
(48, 'http://anousith.express/ans_admin/images/uploads/_19-03-2019_8672966152210916site_login.jpg', 'ບຸນຫຼ້າ', 'ປັນຍາຈິດ', 55556780, '55556780', '0e23f4bba35ff18cc330c68d0b29dc2b', 3, 1551939584, 9, '', 1, '160120000957738001', NULL, 11822, '4d9d705c-d96a-4c56-86f5-a86b6365bd88?appandroid', 'android', 0, 1),
(49, 'http://anousith.express/ans_admin/images/uploads/_19-03-2019_8672966152210916site_login.jpg', 'test', 'test', 11111111, 'asdfasdf', '1bbd886460827015e5d605ed44252251', 3, 1551961419, 2, '', 0, NULL, NULL, NULL, NULL, NULL, 0, 1),
(50, 'http://anousith.express/ans_admin/images/uploads/_19-03-2019_8672966152210916site_login.jpg', 'ບຸນທຳ', 'ບຸນທຳ', 52976812, '52976812', 'c37ef32e5658f75bff894d9cb864ea51', 3, 1552016465, 4, '', 0, '164120001619446001 MR.BOUNTHAM ONHEUANGKEO', NULL, 11781, '39e15d72-cefe-40b8-a4f6-c96718a9cab1?appandroid', 'android', 0, 1),
(51, 'http://anousith.express/ans_admin/images/uploads/_19-03-2019_8672966152210916site_login.jpg', 'ພູທອງ', 'ພູທອງ', 59000955, '000', '1396dd91a293a5bbb37201798ea55e72', 3, 1552102028, 1, '3180', 0, '162120001362165001', NULL, NULL, NULL, NULL, 0, 1),
(73, 'http://anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ໄມ', 'ວັນເພັງ', 59770299, 'jh', '670b14728ad9902aecba32e22fa4f6bd', 3, 1554257930, 3, '', 0, NULL, NULL, NULL, NULL, NULL, 0, 1),
(53, 'https://anousith.express/ans_admin/images/uploads/_19-03-2019_664514065865095site_login.jpg', 'ບຸນກອນ', 'ສູນທອນ', 55479829, '55479829', '670b14728ad9902aecba32e22fa4f6bd', 3, 1552304901, 2, '', 0, '161120001495020001', NULL, NULL, NULL, NULL, 0, 1),
(54, 'http://anousith.express/ans_admin/images/uploads/_19-03-2019_4964346393493860site_login.jpg', 'ມະນີວົງ', 'ໄຊແສນຮັກ', 56668917, '99', '49262240e85f94ded341252a6b5f87fd', 3, 1552307131, 5, '', 0, '140120000901502001     Dokkhoun duangphachanh Ms', 3941000, 11795, '2678ea14-07e8-4026-8f68-2b4195956306?appandroid', 'android', 0, 1),
(57, 'http://anousith.express/ans_admin/images/uploads/_19-03-2019_7043607398121647site_login.jpg', 'ວິໄລ', 'ມີວົງສັກ', 55992750, '55992750', '670b14728ad9902aecba32e22fa4f6bd', 3, 1552879734, 3, '', 0, NULL, NULL, NULL, NULL, NULL, 0, 1),
(58, 'http://anousith.express/ans_admin/images/uploads/_19-03-2019_5975162903702226site_login.jpg', 'ຕົວຢ່າງ', 'ເນັ່ງວ່າງ', 22949413, '22949413', '670b14728ad9902aecba32e22fa4f6bd', 3, 1552879773, 1, '', 0, NULL, NULL, NULL, NULL, NULL, 0, 1),
(59, 'http://anousith.express/ans_admin/images/uploads/_19-03-2019_2208924316543119site_login.jpg', 'ຊູຫວ່າງ', 'ຊູຫວ່າງ', 59739494, '59739494', '670b14728ad9902aecba32e22fa4f6bd', 3, 1552879815, 1, '', 0, NULL, NULL, NULL, NULL, NULL, 0, 1),
(66, 'http://anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ນ້ອຍ', 'ທອງທະວີໄຊ', 59066624, ';', '670b14728ad9902aecba32e22fa4f6bd', 3, 1553224303, 1, '', 0, NULL, NULL, NULL, NULL, NULL, 0, 1),
(65, 'http://anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ວຽງສະຫວັນ', 'ຫນູໄພ', 97510308, '97510308', '670b14728ad9902aecba32e22fa4f6bd', 3, 1553224042, 3, '', 0, NULL, NULL, NULL, NULL, NULL, 0, 1),
(64, 'http://anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ຄຳໄມ (Member)', 'ພະວິໄຊ', 93617698, 'ແກດ', 'f72cb75eeda267096a1dbb5efc1f88d2', 3, 1553224004, 3, 'ຈຮ 9675', 0, '093120001435283001 khammay phavixay mr', NULL, 11799, '6481b686-d360-45ec-a249-e0d5674180f8?appandroid', 'android', 0, 1),
(63, 'http://anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ນ້ຳຝົນ', 'ວຽງໄຊຍະວົງ', 76169045, '0', '612e5cac3675db2b9dc2edb717a621fc', 4, 1553055370, 1, '', 0, '  010120001108191001  NAMFON VIENGXAIYAVONG ', 1800000, 10355, NULL, NULL, 0, 1),
(68, 'http://anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ສົນ', 'ຂຸນນະວົງ', 95981545, 'l', '670b14728ad9902aecba32e22fa4f6bd', 3, 1553482865, 2, '', 0, NULL, NULL, NULL, NULL, NULL, 0, 1),
(61, 'https://www.anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'anousith', 'express', 99999999, '2', 'ef775988943825d2871e1cfa75473ec0', 3, 1553039507, 1, '', 1, '', NULL, 1111, '92583808-4a46-4a4e-a13c-485651542479', 'android', 1, 1),
(69, 'http://anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ຄຳປັນຍາ', 'ພົມວິພັກ', 77598484, 'p', '670b14728ad9902aecba32e22fa4f6bd', 3, 1553482934, 2, '', 0, NULL, NULL, NULL, NULL, NULL, 0, 1),
(70, 'http://anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ວິໄລພອນ', 'ພົມມະຫາໄຊ', 56330781, ',', '00e52f065a669b6be2055537602dd3da', 3, 1553496503, 3, 'ກກ 2056', 0, '162120001442731001', NULL, NULL, NULL, NULL, 0, 1),
(71, 'https://anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ສອນຄິດ', 'ລໍ້ກ້ອງອີ້ງ', 54197240, '54197240', '670b14728ad9902aecba32e22fa4f6bd', 3, 1553661404, 1, '', 0, NULL, NULL, NULL, NULL, NULL, 0, 1),
(72, 'http://anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ຈິດປະສົງ', 'ໄຊຍະເເສງ', 58405788, '00', 'd0cb2b08d814f7c98f7898b8dc67698d', 3, 1553921120, 1, 'ຍຮ 0538', 0, '', NULL, NULL, NULL, NULL, 0, 1),
(74, 'http://anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ທອງພັນ', 'ເທບທິລາດ', 55177751, 'thongphan', '670b14728ad9902aecba32e22fa4f6bd', 3, 1554340440, 3, '', 0, NULL, NULL, NULL, NULL, NULL, 0, 1),
(75, 'http://anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ຄອນສະຫວັນ', 'ສີງມະຫາຊົນ', 97367949, '່້ີ່', 'f98f6ea99c6ed03ba833b47a06e919da', 3, 1554772298, 1, 'ຍຈ 3685', 0, '160120001416768001', NULL, NULL, NULL, NULL, 0, 1),
(76, 'http://anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ສິນໄຊ', 'ພີມມະຫາໄຊ', 56428083, 'kjk', 'b4bcb0e35c10dbee96db19f1a7319c1d', 3, 1554860419, 1, 'ດພ 0112', 0, NULL, NULL, NULL, NULL, NULL, 0, 1),
(77, 'http://anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ເພັດສະໝອນ', 'ຂຸນພານິດ', 95937615, 'lk', '670b14728ad9902aecba32e22fa4f6bd', 3, 1555810921, 1, 'ຄຕ 4477', 0, '', NULL, NULL, NULL, NULL, 0, 1),
(78, 'http://anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ເຊັ່ງສີຊົ່ງ', 'ເລ່ຍໂກ້', 95205388, 'ສສ', 'c0443298c5fe36c8c2a61abbc59755f7', 3, 1555816965, 1, 'ດສ 8933', 0, NULL, NULL, NULL, NULL, NULL, 0, 1),
(79, 'http://anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'thep', 'thep', 59595789, '59595789', '80ddbde305d04917c9015f0155705694', 3, 1555827391, 1, '', 0, '', NULL, NULL, NULL, NULL, 0, 1),
(80, 'http://anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ບຸນທະວີ', 'ບຸນທະວີ', 54818618, '54818618', 'c50dd3276002da9605b778542868a1fc', 2, 1556090717, 3, '', 0, '', 1650000, 0, '573cd5f8-a7fa-4cb7-8990-018c11ebdeca', 'android', 0, 1),
(81, 'http://anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ທ້າວ ພອນໄຊ', 'ບຸດດີ', 96961877, 'lkl', 'f2bf04f7727f5bb644c0fed1580f17d1', 3, 1556761156, 3, 'ດຄ 1297', 0, '', NULL, NULL, NULL, NULL, 0, 1),
(82, 'http://anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ນາງ ທິບພະຈັນ', 'ອິນທະວົງ', 55278539, 'fgf', 'f2b7d0630c8a9ed1d141bdb2988f96dc', 3, 1556761249, 2, 'ດພ 4814', 0, '', NULL, 11828, '5fbdea17-c173-4259-9282-91e0348fd3cf?appandroid', 'android', 0, 1),
(83, 'http://anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ທ້າວ ຈັນດີ', 'ສີປະເສີດ', 55379799, 'vcdvd', '598e1546136b4840a18f4aa186378411', 3, 1556761305, 3, 'ດຈ 3601', 0, '', NULL, NULL, NULL, NULL, 0, 1),
(84, 'http://anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ແຊມ', 'ທຳມະອອນ', 54682915, 'fgf', 'deec40d8e673dd0edfd25832b8ace96a', 3, 1556763974, 1, 'ດບ 5915', 1, '010120001118546001', NULL, 11827, 'b2ec16ce-95b7-4a57-a9fa-8a5ba3389d63', 'android', 0, 1),
(85, 'http://anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ທ້າວ ວັນ', 'ຄຸນນະຄຳ', 76719536, 'dfgf', '1486a4e1a79c8321be6e31cd37372aa7', 3, 1556766270, 1, 'ດພ 3914', 0, '', NULL, NULL, NULL, NULL, 0, 1),
(86, 'http://anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ສາຄອນ', 'ສິນທາ', 95497643, 'dfgf', 'b08e0af169f4bb57f1af417afd2d400e', 3, 1556935730, 1, '', 0, '', NULL, NULL, NULL, NULL, 0, 1),
(87, 'http://anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ທ້າວ ທະວີສັກ', 'ເເກ້ວບຸນເຮືອງ', 56287968, 'dfgd', '08a6d77b4aeb0a4c4497db116f98c9c5', 3, 1557106267, 2, '', 0, '', NULL, NULL, NULL, NULL, 0, 1),
(88, 'https://anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ສອນ', 'ນ້ອຍສະຫວັນ', 55569695, 'ດເດ', '507baa0f631f4b6e130e715efd5ca497', 3, 1557193413, 2, '', 0, '', NULL, NULL, NULL, NULL, 0, 1),
(89, 'https://anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ສອນ', 'ພິສະລາດ', 55052441, 'ກກດ', '37ac70d760c7b0823eec5bed313e860c', 3, 1557195398, 1, '', 0, '', NULL, 0, NULL, NULL, 0, 1),
(90, 'http://anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ໂກນາ', 'ສິດທິຮັກສາປັນຍາ', 55736446, 'fghfh', '6d5678a7dd76fb64c4d147e651c6a714', 3, 1557365744, 1, 'ດວ 2029', 0, '', NULL, NULL, NULL, NULL, 0, 1),
(95, 'http://anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ນາງຕຸກຕາ', 'ສຸວັນນະພິທີ', 99566875, 'ljkljk@', '612e5cac3675db2b9dc2edb717a621fc', 2, 1558147408, 32, '', 1, '160120001652537001', 1900000, 11780, '3310dc59-8b96-4dcd-ae60-ba35962f10bc?appandroid', 'android', 0, 1),
(92, 'http://anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ອາລົມມາ', 'ພັນມະຈັກ', 59418575, 'dfdf', 'dd4b21e9ef71e1291183a46b913ae6f2', 3, 1557538362, 1, 'ຍລ 9502', 0, '', NULL, NULL, NULL, NULL, 0, 1),
(93, 'http://anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ບຸນມີ', 'ພຸຍເເກ້ວ', 58054418, 'ghghgh', '5f3dfb3333e1cab825b3486464a6cee8', 3, 1557538414, 1, 'ຈຄ 5919', 0, '', NULL, NULL, NULL, NULL, 0, 1),
(94, 'http://anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ທ້າວບຸນປີງ', 'ເເກ້ວປະເສີດ', 97093052, '97093052', '670b14728ad9902aecba32e22fa4f6bd', 3, 1557710622, 3, 'ຍພ 4247', 0, '', NULL, NULL, NULL, NULL, 0, 1),
(96, 'http://anousith.express/ans_admin/images/uploads/_15-07-2019_2081062977444405logo%20final%20copy.jpg', 'ນ້ຳຝົນ', 'CVCONNECT', 55555555, 'asd', 'c4a33b11a8a00bcab9f1f7195ab1c4fa', 4, 1558340720, 1, '', 0, '', 0, 10355, NULL, NULL, 0, 1),
(97, 'http://anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ສະຖາພອນ', 'ສີຖີອຸມມານ', 99915176, 'ດເດ', 'afeacb285ae3b645a343c66ced3bbeda', 3, 1559960193, 2, 'ຍຕ 9920', 1, '093120001688678001', NULL, 11829, 'f3a203b8-186c-4f31-b38c-f09df4be6a11?appandroid', 'android', 0, 1),
(98, 'https://www.anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ນາງປັດສະລາ', 'ສຸນັນທາ', 56600186, 'fg', 'e3a17bb1819bef8c693d4069a27a21e6', 3, 1560562618, 1, '', 0, '', NULL, 11823, NULL, NULL, 0, 1),
(99, 'https://www.anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ພອນສະຫວັດ', 'ບຸນທົງ', 77477754, 'ກດກ', '9c87deaaffd51a2c0e99053d04f1e04d', 3, 1560741790, 1, 'ດຮ2875', 0, '  010120001207109001                   JULY BOUNTHONG MISS', NULL, 11844, NULL, NULL, 0, 1),
(100, 'https://www.anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ນາງ ສຸດາຈັນ', 'ໄຊຍະສັກ', 96397163, 'ສາາ', 'fc08ef3279b3a58158bc087d11a36fd3', 3, 1561947125, 1, '3986', 0, '', NULL, NULL, NULL, NULL, 0, 1),
(101, 'https://www.anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ສັນຕິ', 'ດຳລົງ', 56736144, 'ວສາສາ', '512969c56a80635091b18bc2c160b6fc', 2, 1561953050, 8, '', 1, '165120001807542001', NULL, 11788, 'c8fc0d29-7e53-4d99-a222-8c6e2ed91079?appandroid', 'android', 0, 1),
(102, 'https://www.anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ປັນຍາ', 'ວິໄລ', 56068805, 'າ່້່', '9d6d21636e042cce07aa3a0fd8e4c8ac', 3, 1561953094, 9, '4893', 1, '165120000880949001', NULL, 11865, 'fcbb8d08-be84-4811-881c-cb246139ac51?appandroid', 'android', 0, 1),
(103, 'https://www.anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ວັນທະຈັກ', 'ມະນີວົງ', 55537344, 'ເດເກດເ', '6e08b5c200a2e8d05ab9bef62e123924', 3, 1562383953, 4, 'ດວ 5638', 1, '165120001161155001', NULL, 11864, 'bfb0956f-c678-444c-9cd1-c4d7fba1e623', 'android', 0, 1),
(104, 'https://www.anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ຄຳຕຸ່ນ', 'ເເກ້ວປະເສີດ', 56204478, 'ດເກດກເ', '85c7bbd8ed763ad9049f6d9dafcd13b9', 2, 1562384000, 3, 'ດຄ 6776', 1, '183120000998820001', NULL, 11815, 'c6333d28-fdf6-42a8-9db6-b5de8cb14c00', 'android', 0, 1),
(105, 'https://www.anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ມະນີພອນ', 'ສິທິສາລີບຸດ', 52955460, 'ຶເ້ຶເ້', 'a2e04e37aaaa2bd8a45f3b1fdd7f6663', 3, 1562812068, 40, 'ຍມ0375', 0, '093120001244009001', NULL, 11787, '9c4bfb7f-06c8-47fd-8ddd-bc205c988262?appandroid', 'android', 0, 1),
(106, 'https://www.anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ດວງສະຫວັນ', 'ໄຊຊົມພູ', 77666747, '565', 'd645d1e63ebe0dc75454d2a81bfad3b7', 3, 1563328862, 1, 'ດຄ8157', 0, '', NULL, 11824, NULL, NULL, 0, 1),
(107, 'https://www.anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ເເຂກ', 'ຍົງໂພ', 78888514, 'ພດເດກ', '670b14728ad9902aecba32e22fa4f6bd', 3, 1563351990, 1, 'ດພ7664', 0, '', NULL, NULL, NULL, NULL, 0, 1),
(108, 'https://www.anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ນາງ ເເພວຄຳ', 'ພອນປະທານ', 98328647, '5465', '670b14728ad9902aecba32e22fa4f6bd', 3, 1564020228, 3, 'ດລ 3197', 0, '', NULL, NULL, NULL, NULL, 0, 1),
(109, 'https://www.anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ໂຕ້', 'ຈັນທະລັງສີ', 52304119, '52304119', 'f8c60107ddafeace6119b4484d25038a', 3, 1564456862, 4, 'ຍຜ 0726', 0, '160120001652537001 tookta Souvannaphity', NULL, 11796, 'dfc073f0-ed7b-4dd1-9ef0-0330f8433a4f?appandroid', 'android', 0, 1),
(110, 'https://www.anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ທ ພວງໄຊ', 'ບຸນພາວັນ', 98222072, '98222072', '22a73d6a63a67b7e226e00fd2ede1f05', 3, 1564624783, 3, 'ຍຣ 8722', 0, '', NULL, NULL, NULL, NULL, 0, 1),
(111, 'https://www.anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ສຸວິດ', 'ວົງວິໄລ', 55944409, 'ກ່ກທ', '49ed18c347be3bbb08f44e7f47b820f2', 3, 1564967797, 1, 'ຍຜ 0634', 0, '096120000009667001                           ນາງວິໄລສອນ ໄຊຊະນະ', NULL, 11869, 'c29572ec-b065-49b1-8266-b4eb8894f9ca?appandroid', 'android', 1, 1),
(258, 'http://anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account_for_hr.php', 'ອານຸໄຊ', 'ລາດສິມຄຳ', 92508323, '92508323', 'b1ee396fdea2f1ed256c97b274ad65f5', 3, 1579253213, 1, 'ດຫ5055', 0, '160120001729167001 ANOUXAY LATSIMKHAM MR', NULL, 13836, '63e29d70-e092-4477-85f3-a686091ce494?appandroid', 'android', 1, 1),
(112, 'https://www.anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ດອກຄູນ', 'ອີຊີ່ສະປີດ', 88888888, 'ເາຍ່ດ', '612e5cac3675db2b9dc2edb717a621fc', 2, 1564967937, 1, '', 0, '', NULL, 11790, NULL, NULL, 1, 1),
(113, 'https://www.anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ທ,ຈັນເພັງ', 'ພະກອນຄຳ', 99914304, 'ກດກດ', '5ed2c2f2606281f68b270af26c4be134', 3, 1565075833, 1, 'ຍມ 7774', 0, '', NULL, NULL, NULL, NULL, 0, 1),
(114, 'https://www.anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ພູທະວິ', 'ມະນີສີ', 97743235, 'ດ້ເດ', '7fcfeb8af70630227ac7218d8f219dc2', 3, 1565141285, 2, 'ດຈ0991', 0, '018120000585709001 phouthavy Mnysy MR', NULL, 11794, '9601fa14-56a2-4fd4-b09f-5d7e5410fca2?appandroid', 'android', 0, 1),
(115, 'https://www.anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ຄຳພັນ', 'ວົງຄຳດີ', 77045757, 'ເາສ້ດ', '8a5fee9ac1240c40bfac4ed1f40ea120', 3, 1565141417, 1, 'ດບ 2818', 0, '093120001700305001 JOHNNY VONGKHAMDY MR', NULL, 11858, '92583808-4a46-4a4e-a13c-485651542479', 'android', 1, 1),
(276, 'http://anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account_for_hr.php', 'ວິໄຊ ', 'ແສງສະວ່າງ (ES)', 78781901, '78781901', 'df45509540e1f52eb7f96d6f287e8003', 3, 1581325092, 1, 'ລົດໃຫມ່', 0, '093120000970934001 VILOUN SENGSAVANG', NULL, 11857, 'a9db83ec-8227-43ba-850f-25742fe6e107?appandroid', 'android', 1, 1),
(116, 'https://www.anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ທ.ຂຸ້ມ', 'ທັນຕະວອນ', 99449481, 'ສເພະ', '78570adec4696dde84405c833cc67f05', 3, 1565229430, 1, 'ຈຄ 9178', 0, '', NULL, NULL, NULL, NULL, 0, 1),
(117, 'https://www.anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ບົວໄລ', 'ຄຳມະນີ', 96243422, 'ກດກດ', '9e7f95e852f2b10ae814b2c815bb36cf', 3, 1565401943, 1, 'ກຂ 8879', 0, '   010120001015433001         BUALAI KHAMMALY MR  ', NULL, 11825, '4820a5fb-b954-4754-9e43-314c55c1de80?appandroid', 'android', 0, 1),
(118, 'https://www.anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ພຸດທະຈັນ', 'ເເສງນະວົງ', 52505725, 'ດເດ', '8fba137b8205e49af28972abdc1a70f9', 3, 1565401993, 1, 'ດກ 7365', 0, '', NULL, NULL, NULL, NULL, 0, 1),
(119, 'https://www.anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ວິໄຊ', 'ເເສງສະຫວ່າງ', 91010988, 'ເ້ເດ', '538ababd3adc60580dc08dad9b8f36d7', 2, 1565668005, 8, 'ຈຕ 2379', 0, '010120001113753001 VILAYKHAM XUENXOM', NULL, 11857, 'a9db83ec-8227-43ba-850f-25742fe6e107?appandroid', 'android', 0, 1),
(120, 'https://www.anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ສຸລິຍາ', 'ຈັນທະລາ', 52541922, '52541922', 'e59d54516acf9b7a9167803a779586ed', 3, 1566006453, 2, 'ດທ 6920', 0, '', NULL, NULL, NULL, NULL, 0, 1),
(121, 'https://www.anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ອູສັນ', 'ເເຊເຕິນ', 99430756, '99430756', '875757d93a0d0e580d379246c3e08428', 3, 1566006503, 3, '', 0, '', NULL, NULL, NULL, NULL, 0, 1);
INSERT INTO `member_user` (`id_user`, `profile_picture`, `first_name`, `last_name`, `phone_number`, `email`, `password`, `position`, `joined_time`, `branch_id`, `carSign`, `status_id`, `bank_acc_number`, `basic_salary`, `cv_id`, `app_id_user`, `app_device_user`, `work_type`, `approve`) VALUES
(122, 'https://www.anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ກີ້', 'ລາດຊະວົງ', 94409168, '94409168', 'e38920559720d8cf18d6aef0c120f831', 3, 1566352827, 32, 'ດບ 2414', 1, '221120001501580002', NULL, 11800, '3dcf3ba0-e0d9-45e7-a487-451f341f4ae6?appandroid', 'android', 0, 1),
(123, 'https://www.anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ພຸດທະເສນ', 'ອິນອຸດົມ', 29845030, '29845030', 'e24c03e4e71784f0fad44a19ca1119b6', 3, 1566621652, 14, 'ດຫ 8799', 1, '093120001691093001', NULL, 11821, '8f64d298-d88a-4d6a-859b-57d7ad0e48e0', 'android', 0, 1),
(124, 'https://www.anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ອານຸສິດ', 'ສິງບັນດິດ', 78060207, 'ດ່ຍວ', '7da55de03e0094a5fec343f9c9e57fc5', 3, 1566787981, 8, '6285', 1, '161120001634829001', NULL, 11798, 'df26c47e-bec2-4d42-831f-01597f977d7b?appandroid', 'android', 0, 1),
(125, 'https://www.anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ຄອນສະຫວັນ', 'ໄຊຍະສອນ', 55688819, 'ກາກສ', '09414104ed3363021871bfc6ce75cdcc', 3, 1567033884, 1, 'ດວ 2694', 0, '', NULL, 0, NULL, NULL, 0, 1),
(126, 'https://www.anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ສົມຫມາຍ', 'ສິນສັກດາ', 92703589, 'ກາກສກສ', '74e4fa0a3ed810f743c1a9acd2504059', 3, 1567043244, 2, 'ຈວ7970', 0, '', NULL, 0, NULL, NULL, 0, 1),
(127, 'https://www.anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ໄຊຍະສິດ', 'ຢຽມມາລາ', 58433488, 'ຮສ່', 'b3eb2ce586aa47ee46946497dddc22fe', 3, 1567215555, 3, 'ຍອ 3546', 0, '', NULL, 11797, 'f0023edb-076f-45a7-87dd-44642d1721ba', 'android', 0, 1),
(128, 'http://www.anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ອາເບັນ', 'ວິໄລບຸດ', 76736420, 'ຫາຫາ', 'b503e540cccacb0eadb714e7ffe61186', 3, 1567390039, 3, 'ດສ4582', 0, '22112 00016 64749 001 vongkham vilaibout mr', NULL, 11811, '94b67752-4078-4d1a-9a71-fd331b84445c?appandroid', 'android', 0, 1),
(129, 'http://www.anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ສຸມາລີ', 'ວຶນວິໄລ', 56595224, 'ກາກາກ', '19fc8a86ecdbd1f0b3046a94fe5b3f6d', 3, 1567390158, 1, 'ຈສ9126', 0, '', NULL, 0, NULL, NULL, 0, 1),
(130, 'https://www.anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ສຸດໃຈ', 'ໄຊຊະນະ', 77880266, 'ສກສກສ', '55f6d073740a5d1cdccc9afddf8934f3', 3, 1567820264, 1, 'ດຫ 3745', 0, '', NULL, 11861, '0105b0dc-926f-4d05-99c9-62f65913b79b', 'android', 0, 1),
(131, 'https://anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ສຸກສັນ', 'ວັນທະວົງ', 56306040, 'ສາສ', '7c26dcbb038a6ea851515ae6c933db3e', 3, 1567995381, 1, 'ຈອ 0793', 0, '221120001759553001 SOUKSAN VANHANOUVONG MR', NULL, 11863, '43cc6758-033e-494f-8cf3-14ef237bdbc2?appandroid', 'android', 0, 1),
(132, 'https://www.anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ຟິກພອນ', 'ສີພີມແກ້ວ', 97227122, 'ຫາຫາ', '3839f644ffc66ff7b39948ca7a1f391d', 3, 1568081449, 1, 'ຍຈ 2271', 0, '', NULL, 11843, 'dc8bddf3-1219-44a5-b977-52ba4874f79d?appandroid', 'android', 0, 1),
(134, 'http://anousith.express/ans_admin/images/uploads/_26-09-2019_9226074517417497easyspeed_logo.png', 'Soudsada', 'phakonekham', 78805522, '78805522', 'bdb662f765cd310f2a547cab1cfecef6', 2, 1569463376, 1, 'NONE', 0, '', NULL, 9740, NULL, NULL, 0, 1),
(144, 'https://www.anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ຊຽງ', 'ບຸນທະວີ', 98886144, 'ສ', 'd71ae00fa7538eea6b8fd22b5a7a917c', 3, 1570068700, 1, 'ດຜ5660', 0, '', NULL, 12015, NULL, NULL, 0, 1),
(133, 'http://www.anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ກາສິນ', 'ທຸມມະວົງ', 0, 'ກາກສກສ', '54067a72faef4ab884819ad3e9ecdf90', 3, 1568686392, 1, '', 0, '142120001564065001 AJIMPHENGKHAMDE', NULL, 11892, 'd75e9b04-34d8-45d3-b0e1-d3f977853568?appandroid', 'android', 1, 1),
(135, 'http://www.anousith.express/ans_admin/images/uploads/_26-09-2019_2225971589111125Asset%202-100.jpg', 'ທົດສອບ', 'ຮ້ານ', 55355248, '55355248', '827ccb0eea8a706c4c34a16891f84e7b', 2, 1569477528, 9, '5', 1, '', NULL, 0, NULL, NULL, 0, 1),
(137, 'https://anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ເພັດໄຊພອນ', 'ໂພທິສາລາດ', 56661970, '56661970', '8d733004eaef415a40f4dbaf7f15d008', 3, 1569895420, 1, 'ດທ 7699', 0, '', NULL, 12001, NULL, NULL, 0, 1),
(139, 'https://anousith.express/ans_admin/_main_control_content_job_vacancy_add_com_account.php', 'ສົມຄິດ', 'ສິນສະຫວັນ', 97994236, '97994236', '97d318eb04784cd35813230cc099b700', 3, 1569895531, 1, 'ດຄ 9935', 0, '', NULL, 12002, 'ed3c369e-36f2-4621-b773-01b864b89990', 'android', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `office_branches`
--

CREATE TABLE `office_branches` (
  `id_branch` int(11) NOT NULL,
  `branch_name` varchar(50) NOT NULL,
  `branch_address` varchar(50) NOT NULL,
  `branch_code` varchar(10) DEFAULT NULL,
  `map_lat` varchar(30) DEFAULT NULL,
  `map_lng` varchar(30) DEFAULT NULL,
  `address_info` varchar(200) DEFAULT NULL,
  `provinceID` tinyint(4) NOT NULL DEFAULT 0,
  `mainBranches` tinyint(4) NOT NULL DEFAULT 0,
  `districtName` varchar(30) DEFAULT NULL,
  `public` tinyint(4) NOT NULL DEFAULT 1,
  `sameday_public` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `office_branches`
--

INSERT INTO `office_branches` (`id_branch`, `branch_name`, `branch_address`, `branch_code`, `map_lat`, `map_lng`, `address_info`, `provinceID`, `mainBranches`, `districtName`, `public`, `sameday_public`) VALUES
(1, 'ສາຂາ ໂພນຕ້ອງສະຫວ່າງ', 'ບ້ານ ໂພນສະຫວ່າງ', 'PSV', '17.99646520515873', '102.62392149999998', 'ສູນກວດກາດເຕັກນິກລົດຍົນໂພນສະຫວ່າງ, ບ້ານ ໂພນສະຫວ່າງ, ເມືອງ ຈັນທະບູລີ, ນະຄອນຫຼວງວຽງຈັນ<br />ໂທ 020 93152102 ຫຼື 030 5472217', 1, 1, 'ເມືອງ ຈັນທະບູລີ', 1, 1),
(2, 'ສາຂາ ອາກາດ', 'ບ້ານ ອາກາດ', 'SK', '17.973847953450587', '102.5536337289917', 'ບ້ານ ອາກາດ, ເມືອງ ສີໂຄດຕະບອງ, ນະຄອນຫຼວງວຽງຈັນ<br />ໂທ 020 98606274', 1, 0, 'ເມືອງ ສີໂຄດຕະບອງ', 1, 1),
(3, 'ສາຂາ ໜອງໄຮ', 'ບ້ານ ໜອງໄຮ', 'NH', '17.91468509686437', '102.64942119193418', ' ສູນກວດກາດເຕັກນິກລົດຍົນໜອງໄຮ, ບ້ານ ໜອງໄຮ, ເມືອງ ໄຊເສດຖາ, ນະຄອນຫຼວງວຽງຈັນ<br />ໂທ 020 76665391 ຫຼື 030 5207709', 1, 0, 'ເມືອງ ໄຊເສດຖາ', 1, 1),
(4, 'ສາຂາ ໂນນສະອາດ', 'ບ້ານ ໂນນສະອາດ', 'NSA', '18.113988683094142', '102.65570636494539', 'ຕິດກັບຮ້ານ Mini Big C ບ້ານ ໂນນສະອາດ, ເມືອງ ໄຊທານີ, ນະຄອນຫຼວງວຽງຈັນ<br />ໂທ 030 5472100 ', 1, 0, 'ເມືອງ ໄຊທານີ', 1, 1),
(5, 'ສາຂາ ນາຊາຍ', 'ບ້ານ ນາຊາຍ', 'NXT', '18.070781', '102.534992', 'ຂ້າງຫ້ອງການບ້ານນາຊາຍ, ເມືອງ ນາຊາຍທອງ, ນະຄອນຫຼວງວຽງຈັນ<br />ໂທ 020 91006359 ຫຼື 030 5207839', 1, 0, 'ເມືອງ ນາຊາຍທອງ', 1, 1),
(6, 'ສາຂາ ສະພານທອງ', 'ບ້ານ ສະພານທອງ', 'SPT', '17.9574063360711', '102.6340286736801', 'ຂ້າງວົງວຽນອ່າງນ້ຳປະປາ, ບ້ານ ສະພານທອງ, ເມືອງ ສີສັດຕະນາກ, ນະຄອນຫຼວງວຽງຈັນ<br />ໂທ 020 95280191 ຫຼື 030 5207703', 1, 0, 'ເມືອງ ສີສັດຕະນາກ', 1, 1),
(7, 'ສາຂາ ດົງໂດກ', 'ບ້ານ ດົງໂດກ', 'DD', '18.0490032', '102.6384435', 'ຂ້າງຮ່ອມຫ້ອງການບ້ານໜອງວຽງຄຳ, ບ້ານ ດົງໂດກ, ເມືອງ ໄຊທານີ, ນະຄອນຫຼວງວຽງຈັນ<br />ໂທ 020 99110251 ຫຼື 030 5207819', 1, 0, 'ເມືອງ ໄຊທານີ', 1, 1),
(8, 'ສາຂາ ໜອງແຕ່ງ', 'ບ້ານ ໜອງແຕ່ງ', 'NT', '18.017222390226905', '102.54483899811981', 'ຕິດກັບໄຟແດງປ້ຳ PTT ບ້ານ ໜອງແຕ່ງ, ເມືອງ ສີໂຄດຕະບອງ, ນະຄອນຫຼວງວຽງຈັນ<br >ໂທ 030 5207803 ', 1, 0, 'ເມືອງ ສີໂຄດຕະບອງ', 1, 1),
(9, 'ສາຂາ ໂນນສະຫວ່າງ', 'ບ້ານ ໂນນສະຫວ່າງ', 'NSV', '17.9825336', '102.6564884', 'ຕໍ່ໜ້າສູນລົດຮອນດ້າ ບ້ານ ໂນນສະຫວ່າງ, ເມືອງ ໄຊເສດຖາ, ນະຄອນຫຼວງວຽງຈັນ<br />ໂທ 020 91943569 ຫຼື 030 5472088', 1, 0, 'ເມືອງ ໄຊເສດຖາ', 1, 1),
(12, 'ສາຂາ ນະຄອນປາກເຊ', 'ບ້ານ ຮ່ອງຂະຍອມ', 'PS', '15.116797801623587', '105.80590261078261', 'ຕິດກັບສູນອົບຮົມ ພາສາອັງກິດ ສຸກປະເສີດ ບ້ານ ຮ່ອງຄະຍອມ, ນະຄອນປາກເຊ, ແຂວງ ຈຳປາສັກ | ໂທ 020-9873-5469 ຫຼື 030 5472258', 5, 1, 'ນະຄອນປາກເຊ', 1, 1),
(13, 'ສາຂາ ນະຄອນໄກສອນ', 'ບ້ານ ສຸນັນທາ', 'NKS', '16.56214378240171', '104.74728261382423', 'ໃກ້ກັບທະນາຄານ BCEL ບ້ານ ສຸນັນທາ, ນະຄອນໄກສອນ, ແຂວງ ສະຫວັນນະເຂດ<br/> 020-9151-2416 ຫຼື 030 5472252', 3, 1, 'ນະຄອນໄກສອນ', 1, 1),
(14, 'ສາຂາ ໜອງດ້ວງ', 'ບ້ານ ໜອງດ້ວງ', 'ND', '17.978037446123455', '102.58863770687444', 'ກົງກັນຂ້າມກັບພັດຕະຄານພະນະຄອນ, ບ້ານ ໜອງດ້ວງ, ເມືອງ ສິໂຄດຕະບອງ, ນະຄອນຫຼວງວຽງຈັນ<br />020 99299091 ຫຼື 030 5207817', 1, 0, 'ເມືອງ ສີໂຄດຕະບອງ', 1, 1),
(15, 'ສາຂາ ທ່ານາແລ້ງ (ນາໄຮ່)', 'ບ້ານ ນາໄຮ່', 'TNL', '17.87349765348877', '102.68060575242299', 'ຕໍ່ໜ້າບໍລິສັດສີ TOA, ບ້ານ ນາໄຮ່, ເມືອງ ຫາດຊາຍຟອງ, ນະຄອນຫຼວງວຽງຈັນ<br /> 030 5472103', 1, 0, 'ເມືອງ ຫາດຊາຍຟອງ', 1, 1),
(16, 'ສາຂາ ຫຼັກ21', 'ບ້ານ ໂຄກສະອາດ', 'LUK21', '18.073617555991298', '102.74878173961869', 'ຕໍ່ໜ້າໂຮງໝໍເມືອງ, ບ້ານ ໂຄກສະອາດ, ເມືອງ ໄຊທານີ, ນະຄອນຫຼວງວຽງຈັນ<br />020 91544937 ຫຼື 030 5472089', 1, 0, 'ເມືອງ ໄຊທານີ', 1, 1),
(17, 'ສາຂາ ເຊໂນ', 'ບ້ານ ໄຊອຸດົມ', 'XN', '16.678538581846656', '104.96745077381895', 'ໃກ້ກັບປ້ຳນ້ຳມັນ ສາຍສະໝອນ ບ້ານ ໄຊອຸດົມ,  ເມືອງ ອຸທຸມພອນ, ແຂວງ ສະຫວັນນະເຂດ<br/>  020-9642-3554 ຫຼື 030 5472187', 3, 0, 'ເມືອງ ອຸທຸມພອນ (ເຊໂນ)', 1, 1),
(18, 'ສາຂາ ປາກຊັນ', 'ບ້ານ ໂພນໄຊເໜືອ', 'PX', '18.39249113996618', '103.64358616786042', 'ຕິດກັບທະນາຄານການຄ້າ ບ້ານ ໂພນໄຊເໜືອ, ເມືອງ ປາກຊັນ, ແຂວງບໍລິຄຳໄຊ | ໂທ 020-5496-6362 ຫຼື 030 5472250', 8, 1, 'ເມືອງ ປາກຊັນ', 1, 1),
(19, 'ສາຂາ ທ່າແຂກ', 'ບ້ານ ທ່າແຂກກາງ', 'THK', '17.394236476281492', '104.80452245561543', 'ບ້ານ ທ່າແຂກກາງ, ເມືອງ ທ່າແຂກ, ແຂວງ ຄຳມ່ວນ | ໂທ 020-9114-7667 ຫຼື 030 5472251', 9, 1, 'ເມືອງ ທ່າແຂກ', 1, 1),
(20, 'ສາຂາ ສາລະວັນ', 'ບ້ານ ນາເຫຼັກ', 'SLV1', '15.714795713841013', '106.42031615859831', 'ຕິດກັບທະນາຄານພົງສະຫວັນ, ບ້ານ ນາເຫຼັກ, ເມືອງ ສາລະວັນ, ແຂວງ ສາລະວັນ | ໂທ 020-9160-1295 ຫຼື 030 5472181', 10, 1, 'ເມືອງ ສາລະວັນ', 1, 1),
(21, 'ສາຂາ ທ່າແຕງ', 'ບ້ານ ຫ້ວຍຊາຍ', 'XK1', NULL, NULL, 'ບ້ານ ຫ້ວຍຊາຍ, ເມືອງ ທ່າແຕງ, ແຂວງ ເຊກອງ | ໂທ 020-7885-7290 ຫຼື 030 5472201', 11, 1, 'ເມືອງ ທ່າແຕງ', 1, 1),
(22, 'ສາຂາ ລະມາມ', 'ບ້ານ ວັດຫຼວງ', 'XK2', NULL, NULL, 'ບ້ານ ວັດຫຼວງ, ເມືອງ ລະມານ, ແຂວງ ເຊກອງ | ໂທ 020 9375 5786  ຫຼື 030 5472215', 11, 0, 'ເມືອງ ລະມາມ', 1, 1),
(23, 'ສາຂາ ອັດຕະປື', 'ບ້ານ ວັດຫຼວງ', 'ATP1', '14.806682400895959', '106.83279470026243', 'ບ້ານ ວັດຫຼວງ, ເມືອງ ສາມັກຄີໄຊ, ແຂວງ ອັດຕະປື | ໂທ 020 9556 9665 ຫຼື 030 5472265', 12, 1, 'ເມືອງ ສາມັກຄີໄຊ', 1, 1),
(24, 'ສາຂາ ເມືອງ ໂຂງ', 'ບ້ານ ຊຽງຫວາງ', 'MKH', NULL, NULL, 'ບ້ານ ຊຽງຫວາງ, ເມືອງ ໂຂງ, ແຂວງ ຈຳປາສັກ | ໂທ 020-5922-0305', 5, 0, 'ເມືອງ ໂຂງ', 1, 1),
(25, 'ສາຂາ ຂີ້ນາກ', 'ບ້ານ ຂີ້ນາກ', 'KHN', NULL, NULL, 'ບ້ານ ຂີ້ນາກ, ເມືອງ ໂຂງ, ແຂວງ ຈຳປາສັກ | ໂທ 020-9926-9277', 5, 0, 'ເມືອງ ໂຂງ', 1, 1),
(26, 'ສາຂາ ປາກຊ່ອງແດນໜາວ', 'ບ້ານ ປາກຊ່ອງ', 'PXB', NULL, NULL, 'ບ້ານ ປາກຊ່ອງ, ເມືອງ ປາກຊ່ອງ, ແຂວງ ຈຳປາສັກ | ໂທ 020-9689-1379 ຫຼື 030 5472206', 5, 0, 'ເມືອງ ປາກຊ່ອງ', 1, 1),
(27, 'ສາຂາ ດອນຕະຫຼາດ', 'ບ້ານ ດອນຕະຫຼາດ', 'DTL', NULL, NULL, 'ໃກ້ກັບ 4 ແຍກ ບ້ານ ດອນຕະຫຼາດ, ເມືອງ ຈຳປາສັກ, ແຂວງ ຈຳປາສັກ ໂທ 020-5510-2661', 5, 0, 'ເມືອງ ຈຳປາສັກ', 1, 1),
(28, 'ສາຂາ ມຈ ປາກເຊ', 'ບ້ານ ຈັດສັນ', 'PSE', '15.103911851405948', '105.8655534772461', 'ຕໍ່ໜ້າ CSC Complex, ບ້ານ ຈັດສັນ ຫຼັກ7, ນະຄອນປາກເຊ, ແຂວງ ຈຳປາສັກ | ໂທ 020-9829-6697 ຫຼື 030 5472185', 5, 0, 'ນະຄອນປາກເຊ', 1, 1),
(29, 'ສາຂາ ປາກຊ່ອງລະຫານ້ຳ', 'ບ້ານ ຫຼັກເມືອງ', 'SNK2', NULL, NULL, 'ບ້ານ ຫຼັກເມືືອງ, ເມືອງ ສອງຄອນ, ແຂວງ ສະຫວັນນະເຂດ<br /> 020-9853-6761 ຫຼື 030 5472190', 3, 0, 'ເມືອງ ສອງຄອນ', 1, 1),
(30, 'ສາຂາ ເລົ່າງາມ', 'ບ້ານ ເລົ່າງາມ', 'SLV2', NULL, NULL, 'ບ້ານ ເລົ່າງາມ, ເມືອງ ເລົ່າງາມ, ແຂວງ ສາລະວັນ | ໂທ 020-9240-0105 ຫຼື 030 5472202', 10, 0, 'ເມືອງ ເລົ່າງາມ', 1, 1),
(31, 'ສາຂາ ນາປົ່ງ', 'ບ້ານ ນາປົ່ງ', 'NPS', NULL, NULL, 'ບ້ານ ນາປົ່ງ, ເມືອງ ຄົງເຊໂດນ, ແຂວງ ສາລະວັນ | ໂທ 020-9375-7433 ຫຼື 030 5472183', 10, 0, 'ເມືອງ ຄົງເຊໂດນ', 1, 1),
(32, 'ສາຂາ ນາສ້ຽວ', 'ບ້ານ ນາສຽວ', 'NS', '18.028770349885754', '102.57167318701187', 'ບ້ານ ນາສ້ຽວ, ເມືອງ ໄຊທານີ, ນະຄອນຫຼວງວຽງຈັນ', 1, 0, 'ເມືອງ ໄຊທານີ', 1, 1),
(33, 'ສາຂາ ເມືອງນ່ານ', 'ບ້ານ ສີມຸງຄຸນ', 'MHN', NULL, NULL, 'ບ້ານ ສີມຸງຄຸນ, ເມືອງ ນ່ານ, ແຂວງ ຫຼວງພະບາງ ໂທ 020-5684-8247 ຫຼື 030 5472172 ', 13, 0, 'ເມືອງ ນ່ານ', 1, 1),
(34, 'ສາຂາ ນະຄອນຫຼວງພະບາງ', 'ບ້ານ ວຽງໃໝ່', 'LPB', NULL, NULL, 'ຂ້າງຮ້ານຂາຍຢາ ບ້ານ ວຽງໃໝ່, ນະຄອນຫຼວງພະບາງ, ແຂວງ ຫຼວງພະບາງ | ໂທ 020 5910 8513 ຫຼື  030 5472141', 13, 1, 'ນະຄອນຫຼວງພະບາງ', 1, 1),
(35, 'ສາຂາ ໄຊຍະບູລີ', 'ບ້ານ ສີເມືອງ', 'XBL', NULL, NULL, 'ໜ້າຫ້ອງວ່າການປົກຄອງແຂວງ ໄຊຍະບູລີ, ບ້ານ ສີເມືອງ, ເມືອງ ໄຊຍະບູລີ, ແຂວງ ໄຊຍະບູລີ | ໂທ 020 91296753 ຫຼື 030 5472105', 19, 1, 'ເມືອງ ໄຊຍະບູລີ', 1, 1),
(36, 'ສາຂາ ອຸດົມໄຊ', 'ບ້ານ ນາເລົ່າ', 'ODX', NULL, NULL, 'ໜ້າເດີນບານ ລັກກີ້, ບ້ານ ນາເລົ່າ, ເມືອງ ໄຊ, ແຂວງ ອຸດົມໄຊ | ໂທ 020 98726957 ຫຼື 030 5472146', 16, 1, 'ເມືອງ ໄຊ', 1, 1),
(37, 'ສາຂາ ຫຼວງນ້ຳທາ', 'ບ້ານ ໄຊສົມບູນ', 'LNT', NULL, NULL, 'ໜ້າພະແນກກະສິກຳ, ບ້ານ ໄຊສົມບູນ, ເມືອງ ຫຼວງນ້ຳທາ, ແຂວງ ຫຼວງນ້ຳທາ | ໂທ 020 95562573 ຫຼຶ 030 5472150', 14, 1, 'ເມືອງ ຫຼວງນ້ຳທາ', 1, 1),
(38, 'ສາຂາ ນ້ຳຖ້ວມ', 'ບ້ານ ນ້ຳຖ້ວມເໜືອ', 'NTH', NULL, NULL, 'ບ້ານ ນ້ຳຖ້ວມ, ເມືອງ ນ້ຳບາກ, ແຂວງ ຫຼວງພະບາງ ໂທ 020 95237107', 13, 0, 'ເມືອງ ນ້ຳບາກ', 1, 1),
(39, 'ສາຂາ ບໍ່ແກ້ວ', 'ບ້ານ ປ່າອ້ອຍ', 'HSH', NULL, NULL, '3ແຍກ ບ້ານ ປ່າອ້ອຍ, ເມືອງ ຫ້ວຍຊາຍ, ແຂວງ ບໍ່ແກ້ວ | ໂທ 020 97796056 ຫຼື 030 5472152', 17, 1, 'ເມືອງ ຫ້ວຍຊາຍ', 1, 1),
(40, 'ສາຂາ ທາດຂາວ', 'ບ້ານ ທາດຂາວ', 'TKH', '17.95467441495067', '102.61824810489351', 'ຕັ້ງຢູ່ຕິດກັບໄຟແດງທາດຂາວ ເບື້ອງເສັ້ນໄປວັດສີເມືອງ ບ້ານ ທາດຂາວ, ເມືອງ ສິສັດຕະນາກ, ນະຄອນຫຼວງວຽງຈັນ / ໂທ 030 5207693', 1, 0, 'ເມືອງ ສີສັດຕະນາກ', 1, 1),
(42, 'ສາຂາ ຊຽງເງິນ', 'ບ້ານ ຊຽງເງິນ', 'XNG', NULL, NULL, 'ບ້ານ ຊຽງເງິນ, ເມືອງ ຊຽງເງິນ, ແຂວງ ຫຼວງພະບາງ ໂທ 020 92931095', 13, 0, 'ເມືອງ ຊຽງເງິນ', 1, 1),
(43, 'ສາຂາ ຜົ້ງສາລີ', 'ບ້ານ ແສນສາລີ', 'PSL1', NULL, NULL, 'ໜ້າສຶກສາເມືອງ ບ້ານ ແສນສາລີ, ເມືອງ ຜົ້ງສາລີ, ແຂວງ ຜົ້ງສາລີ | ໂທ 020 93395408 ຫຼື 030 5472151', 22, 1, 'ເມືອງ ຜົ້ງສາລີ', 1, 1),
(44, 'ສາຂາ ຊຳເໜືອ', 'ບ້ານ ພັນໄຊ', 'XHN', NULL, NULL, 'ໜ້າໜ່ວຍແກ້ວຫຼັກເມືອງ, ບ້ານ ພັນໄຊ, ເມືອງ ຊຳເໜືອ, ແຂວງ ຊຳເໜືອ | ໂທ 020 98601058 ຫຼື  030 5472162', 15, 1, 'ເມືອງ ຊຳເໜືອ', 1, 1),
(45, 'ສາຂາ ໂພນໂຮງ', 'ບ້ານ ໂພນໂຮງ', 'PHH', NULL, NULL, 'ຕິດກັບຮ້ານແປງລົດ ບ້ານ ໂພນໂຮງ, ເມືອງ ໂພນໂຮງ, ແຂວງ ວຽງຈັນ | ໂທ 020 91592432 ຫຼື  030 5472119', 18, 1, 'ເມືອງ ໂພນໂຮງ', 1, 1),
(46, 'ສາຂາ ຫຼັກ52', 'ບ້ານ ນາເລົາ', 'LUK52', NULL, NULL, 'ຕິດກັບຫ້ອງການບ້ານ ນາເລົາ, ເມືອງ ໂພນໂຮງ, ແຂວງ ວຽງຈັນ ໂທ 020 97137743 ຫຼື 030 5472126', 18, 0, 'ເມືອງ ໂພນໂຮງ', 1, 1),
(47, 'ສາຂາ ວັງວຽງ', 'ບ້ານ ເມືອງຊອງ', 'VV', NULL, NULL, 'ບ້ານເມືອງຊອງ , ເມືອງ ວັງວຽງ, ແຂວງ ວຽງຈັນ (ໜ້າໂຮງແຮມທະວີສຸກ) / ເບີຕິດຕໍ່ 020-9788-9592  ຫຼື 030 5472104', 18, 0, 'ເມືອງ ວັງວຽງ', 1, 1),
(48, 'ສາຂາ ຊຽງຂວາງ', 'ບ້ານ ໂພນງາມ', 'XKH', NULL, NULL, 'ໜ້າຮ້ານແໜມ ບ້ານ ໂພນງາມໃຕ້, ເມືອງ ແປກ, ແຂວງ ຊຽງຂວາງ |  020-9603-2186 ຫຼື 030 5472165', 21, 1, 'ເມືອງ ແປກ', 1, 1),
(49, 'ສາຂາ ເມືອງຄຳ', 'ບ້ານ ຈອມທອງ', 'MKH', NULL, NULL, 'ຂ້າງຕະຫຼາດຈອມທອງ ບ້ານ ຈອມທອງ, ເມືອງ ຄຳ, ແຂວງ ຊຽງຂວາງ ໂທ 020 91910873  ຫຼື  030 5472168', 21, 0, 'ເມືອງ ຄຳ', 1, 1),
(50, 'ສາຂາ ຕົ້ນເຜີ້ງ', 'ບ້ານ ໃຫຍ່ຕົ້ນເຜິ້ງ', 'TPH', NULL, NULL, 'ບ້ານ ໃຫຍ່ຕົ້ນເຜິ້ງ, ເມືອງ ຕົ້ນເຜີ້ງ, ແຂວງ ບໍ່ແກ້ວ ໂທ 020 92037467', 17, 0, 'ເມືອງ ຕົ້ນເຜີ້ງ', 1, 1),
(51, 'ສາຂາ ກາສີ', 'ບ້ານ ພູຄຳ', 'KS', NULL, NULL, 'ໜ້າຫ້ອງວ່າການເມືອງກາສີ ບ້ານ ພູຄຳ, ເມືອງ ກາສີ, ແຂວງ ວຽງຈັນ ໂທ 020 78841542 ຫຼື 030 5472175', 18, 0, 'ເມືອງ ກາສີ', 1, 1),
(52, 'ສາຂາ ຕານມີໄຊ', 'ບ້ານ ຕານມີໄຊ', 'TMX', '18.034829635947222', '102.62796164987496', 'ຕິດກັບ 4 ແຍກໄຟແດງ ຂ້າງຮ້ານຊິ້ນດາດລັດສະໝີ ບ້ານ ຕານມີໄຊ, ເມືອງ ໄຊເສດຖາ, ນະຄອນຫຼວງວຽງຈັນ / ໂທ 030 5207826', 1, 0, 'ເມືອງ ໄຊທານີ', 1, 1),
(53, 'ສາຂາ ຫົງສາ', 'ບ້ານ ສີມຸງຄຸນ', 'HS', NULL, NULL, 'ໜ້າຕະຫຼາດເກົ່າຫົງສາ ບ້ານ ສີມຸງຄຸນ, ເມືອງ ຫົງສາ, ແຂວງ ໄຊຍະບູລີ / ເບີຕິດຕໍ່ 020-5516-5514 ຫຼື 030 5472118', 19, 0, 'ເມືອງ ຫົງສາ', 1, 1),
(54, 'ສາຂາ ເມືອງເງິນ', 'ບ້ານ ນ້ຳເງິນ', 'MNG', NULL, NULL, 'ໜ້າທະນາຄານສົ່ງເສີມກະສິກຳ ບ້ານ ນ້ຳເງິນ, ເມືອງ ເງິນ, ແຂວງ ໄຊຍະບູລີ / ເບີຕິດຕໍ່ 020-5543-4346 ຫຼື 030 5472243', 19, 0, 'ເມືອງ ເງິນ', 1, 1),
(55, 'ສາຂາ ເມືອງຂວາ', 'ບ້ານ ໂພນໄຊ(ເມືອງຂວາ)', 'MKH', NULL, NULL, 'ໃກ້ກັບ 3 ແຍກ ບ້ານ ໂພນໄຊ, ເມືອງ ຂວາ, ແຂວງ ຜົ້ງສາລີ ໂທ 020 91102227', 22, 0, 'ເມືອງ ຂວາ', 1, 1),
(56, 'ສາຂາ ແກ່ນທ້າວ', 'ບ້ານ ຈອມແກ້ວ', 'KT', NULL, NULL, 'ໜ້າຕະຫຼາດແກ່ນທ້າວ // ບ້ານ ຈອມແກ້ວ, ເມືອງ ແກ່ນທ້າວ, ແຂວງ ໄຊຍະບູລີ / ເບີຕິດຕໍ່ 020-9888-6021 ຫຼື 030 5472115 ', 19, 0, 'ເມືອງ ແກ່ນທ້າວ', 1, 1),
(57, 'ສາຂາ ປາກລາຍ', 'ບ້ານ ໄຊຍະມົງຄຸນ', 'PL', NULL, NULL, 'ບ້ານ ໄຊຍະມົງຄຸນ, ເມືອງ ປາກລາຍ, ແຂວງ ໄຊຍະບູລີ / ເບີຕິດຕໍ່ 020-9955-2851 ຫຼື 030 5472132', 19, 0, 'ເມືອງ ປາກລາຍ', 1, 1),
(58, 'ສາຂາ ຊະນະຄາມ', 'ບ້ານ ຊະນະຄາມ', 'SNK', NULL, NULL, 'ໜ້າວັດໃຫຍ່ຜາຫັດ ບ້ານ ຊະນະຄາມ, ເມືອງ ຊະນະຄາມ, ແຂວງ ວຽງຈັນ / ເບີຕິດຕໍ່ 020-5684-2966 ຫຼື 030 5472117', 18, 0, 'ເມືອງ ຊະນະຄາມ', 1, 1),
(59, 'ສາຂາ ເມືອງພຽງ', 'ບ້ານ ນ້ຳປຸ້ຍ', 'MPH', NULL, NULL, 'ຕິດກັບສູນ unitel ແລະ ກົງກັນຂ້າມກັບຫ້ອງການການເງິນ /// ບ້ານ ນ້ຳປຸ້ຍ, ເມືອງ ພຽງ, ແຂວງ ໄຊຍະບູລີ /// ເບີຕິດຕໍ່ 020-9198-6074 ', 19, 0, 'ເມືອງ ພຽງ', 1, 1),
(60, 'ສາຂາ ເມືອງຄຳເກີດ', 'ບ້ານ ຫ້ວຍແກ້ວ', 'L20-KK', NULL, NULL, 'ໜ້າສູນລາວໂທລະຄົມ ບ້ານ ຫ້ວຍແກ້ວ, ເມືອງ ຄຳເກີດ, ແຂວງ ບໍລິຄຳໄຊ ໂທ 020-9750-2935 ', 8, 0, 'ເມືອງ ຄຳເກີດ', 1, 1),
(61, 'ສາຂາ ລ້ອງຊານ', 'ບ້ານ ຄອນວັດ', 'LS', NULL, NULL, '3 ແຍກ ບ້ານ ຄອນວັດ, ເມືອງ ລ້ອງຊານ, ແຂວງ ໄຊສົມບູນ ຕິດຕໍ່ສາຂາໂທ 020 98636866 ຫຼື  030 5472226', 23, 1, 'ເມືອງ ລ້ອງຊານ', 1, 1),
(62, 'ສາຂາ ອານຸວົງ', 'ບ້ານ ພູຫົວຊ້າງ', 'ANV', NULL, NULL, '4 ແຍກ ບ້ານ ພູຫົວຊ້າງ, ເມືອງ ອານຸວົງ, ແຂວງ ໄຊສົມບູນ ຕິດຕໍ່ສາຂາໂທ020-9566-8020 ຫຼື  030 5472236', 23, 0, 'ເມືອງ ອານຸວົງ', 1, 1),
(63, 'ສາຂາ ເມືອງເຟືອງ', 'ບ້ານ ເລົາຄຳ', 'MFH', NULL, NULL, 'ໜ້າຫ້ອງການປົກຄອງເມືອງ ບ້ານ ເລົາຄຳ, ເມືອງ ເຟືອງ, ແຂວງ ວຽງຈັນ ໂທ 020 77323890 ຫຼື 030 5472140', 18, 0, 'ເມືອງ ເຟືອງ', 1, 1),
(64, 'ສາຂາ ເມືອງໝື່ນ', 'ບ້ານ ໂນນໄຮ', 'MM', NULL, NULL, 'ບ້ານ ໂນນໄຮ, ເມືອງ ໝື່ນ, ແຂວງ ວຽງຈັນ ໂທ 020-9887-9095 ຫຼື 030 5472139', 18, 0, 'ເມືອງ ໝື່ນ', 1, 1),
(65, 'ສາຂາ ເຊໂປນ', 'ບ້ານ ວົງວິໄລ', 'XP', NULL, NULL, 'ໜ້າຄິວລົດເຊໂປນ ບ້ານ ວົງວິໄລ, ເມືອງ ເຊໂປນ, ແຂວງ ສະຫວັນນະເຂດ ໂທ 020-5636-5546 ', 3, 0, 'ເມືອງ ເຊໂປນ', 1, 1),
(66, 'ສາຂາ ເມືອງພິນ', 'ບ້ານ ປະສົມໄຊ', 'MP', NULL, NULL, 'ໜ້າປ້ຳນ້ຳມັນຄອນປະເສີດ ບ້ານ ປະສົມໄຊ, ເມືອງ ພິນ, ແຂວງ ສະຫວັນນະເຂດ ໂທ 020-2224-9799', 3, 0, 'ເມືອງ ພິນ', 1, 1),
(67, 'ສາຂາ ບາຈຽງ', 'ບ້ານ ຫ້ວຍແຮ່', 'BJ', NULL, NULL, 'ຕິດກັບ 3 ແຍກບາຈຽງ ບ້ານ ຫ້ວຍແຮ່, ເມືອງ ບາຈຽງ, ແຂວງ ຈຳປາສັກ ໂທ 020-5845-7997 ', 5, 0, 'ເມືອງ ບາຈຽງ', 1, 1),
(68, 'ສາຂາ ໂພນທອງ', 'ບ້ານ ໂພນທອງ', 'PT', NULL, NULL, 'ໜ້າມສ ໂພນທອງ ບ້ານ ໂພນທອງ, ເມືອງ ໂພນທອງ, ແຂວງ ຈຳປາສັກ ໂທ 020-7694-9989 ຫຼື 030-4996794', 5, 0, 'ເມືອງ ໂພນທອງ', 1, 1),
(69, 'ສາຂາ ສຸຂຸມມາ', 'ບ້ານ ສຸຂຸມມາ', 'SKM', NULL, NULL, 'ບ້ານ ສຸຂຸມາ, ເມືອງ ສຸຂຸມາ, ແຂວງ ຈຳປາສັກ  | ໂທ 020-9883-3524 ', 5, 0, 'ເມືອງ ສຸຂຸມມາ', 1, 1),
(70, 'ສາຂາ ນາກາຍ', 'ບ້ານ ນາກາຍ', 'NK', NULL, NULL, 'ບ້ານ ອຸດົມສຸກ, ເມືອງ ນາກາຍ, ແຂວງ ຄຳມ່ວນ ໂທ 020-9593-8644', 9, 0, 'ເມືອງ ນາກາຍ', 1, 1),
(71, 'ສາຂາ ຍົມມະລາດ', 'ບ້ານ ໂນນຄຳ', 'YML', NULL, NULL, 'ຕິດກັບຮ້ານຄາລາໂອເກະ 369 ບ້ານ ໂນນຄຳ, ເມືອງ ຍົມມະລາດ, ແຂວງ ຄຳມ່ວນ ໂທ 020-9854-2346', 9, 0, 'ເມືອງ ຍົມມະລາດ', 1, 1),
(72, 'ສາຂາ ເມືອງມະຫາໄຊ', 'ບ້ານ ນາກອກ', 'MHX', NULL, NULL, 'ໜ້າຕະຫຼາດມະຫາໄຊ ບ້ານ ນາກອກ, ເມືອງ ມະຫາໄຊ, ແຂວງ ຄຳມ່ວນ ໂທ 020-9787-9748', 9, 0, 'ເມືອງ ມະຫາໄຊ', 1, 1),
(73, 'ສາຂາ ເມືອງຄູນຄຳ', 'ບ້ານ ນາຫີນ', 'KK', NULL, NULL, 'ຕິດກັບດ້ານຂ້າງບໍລິສັດ ເທີນຫີນບູນ ບ້ານ ນາຫີນ, ເມືອງ ຄູນຄຳ, ແຂວງ ຄຳມ່ວນ ໂທ 020-9422-5247 ຫຼື 030 9931251', 9, 0, 'ເມືອງ ຄູນຄຳ', 1, 1),
(74, 'ສາຂາ ຫີນບູນ', 'ບ້ານ ສີຊົມຊື່ນ', 'HB', NULL, NULL, 'ຕິດກັບສູນ Unitel ບ້ານ ສີຊົມຊື່ນ, ເມືອງ ຫີນບູນ, ແຂວງ ຄຳມ່ວນ ໂທ 020-9774-7456', 9, 0, 'ເມືອງ ຫີນບູນ', 1, 1),
(75, 'ສາຂາ ເມືອງທ່າໂທມ', 'ບ້ານ ນ້ຳພາງ', 'TT', NULL, NULL, 'ບ້ານ ນ້ຳພາງ, ເມືອງ ທ່າໂທມ, ແຂວງ ໄຊສົມບູນ ຕິດຕໍ່ສາຂາໂທ 020-9958-9582 ຫຼື 030 5472239', 23, 0, 'ເມືອງ ທ່າໂທມ', 1, 1),
(76, 'ສາຂາ ມຸນລະປະໂມກ', 'ບ້ານ ເວີນແຄນ', 'MLPM', NULL, NULL, 'ຕິດກັບຮ້ານຕົ້ນຕານ ບ້ານ ເວີນແຄນ, ເມືອງ ມຸນລະປະໂມກ, ແຂວງ ຈຳປາສັກ ໂທ 020-5775-5151', 5, 0, 'ເມືອງ ມຸນລະປະໂມກ', 1, 1),
(77, 'ສາຂາ ອາດສະພັງທອງ', 'ບ້ານ ດົງເຫັນ', 'ASPT', NULL, NULL, 'ໜ້າຫ້ອງການໄຟຟ້າລາວ ບ້ານ ດົງເຫັນ, ເມືອງ ອາດສະພັງທອງ, ແຂວງ ສະຫວັນນະເຂດ ໂທ 020-9917-6400', 3, 0, 'ເມືອງ ອາດສະພັງທອງ', 1, 1),
(78, 'ສາຂາ ເມືອງບຸນເໜືອ', 'ບ້ານ ໂພນໂຮມ', 'BN', NULL, NULL, 'ບ້ານ ໂພນໂຮມ, ເມືອງ ບຸນເໜືອ, ແຂວງ ຜົ້ງສາລີ / ເບີຕິດຕໍ່ 020-5232-7897', 22, 0, 'ເມືອງ ບຸນເໜືອ', 1, 1),
(79, 'ສາຂາ ທາງແບ່ງຫຼັກ20', 'ບ້ານ ວຽງຄຳ', 'TB', NULL, NULL, 'ຕະຫຼາດວຽງຄຳ ບ້ານ ວຽງຄຳ, ເມືອງ ປາກກະດິງ, ແຂວງ ບໍລິຄຳໄຊ ໂທ 020-9597-6181', 8, 0, 'ເມືອງ ປາກກະດິງ', 1, 1),
(80, 'ສາຂາ ວິລະບູລີ', 'ບ້ານ ນຸ່ງຄຳ', 'VLBL', NULL, NULL, 'ໜ້າຄຣິນິກ ດຣ ຄຳຜົົງ ບ້ານ ນຸ່ງຄຳ, ເມືອງ ວິລະບູລີ, ແຂວງ ສະຫວັນນະເຂດ ໂທ 020-9748-7737', 3, 0, 'ເມືອງ ວິລະບູລີ', 1, 1),
(81, 'ສາຂາ ຫີນເຫີບ', 'ບ້ານ ຫີນເຫີບໃຕ້', 'HH', NULL, NULL, 'ບ້ານ ຫີນເຫີບໃຕ້, ເມືອງ ຫີນເຫີບ, ແຂວງ ວຽງຈັນ ໂທ 020 55819555', 18, 0, 'ເມືອງ ຫີນເຫີບ', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `office_state_branches`
--

CREATE TABLE `office_state_branches` (
  `id_state` int(11) NOT NULL,
  `provinceName` varchar(30) DEFAULT NULL,
  `provinceCode` varchar(10) NOT NULL,
  `province_map_lat` varchar(30) DEFAULT NULL,
  `province_map_lng` varchar(30) DEFAULT NULL,
  `addressInfo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `office_state_branches`
--

INSERT INTO `office_state_branches` (`id_state`, `provinceName`, `provinceCode`, `province_map_lat`, `province_map_lng`, `addressInfo`) VALUES
(1, 'ນະຄອນຫຼວງວຽງຈັນ', 'VTE', '0', '0', 'ໂພນສະຫວ່າງ'),
(3, 'ແຂວງ ສະຫວັນນະເຂດ', 'SVK', NULL, NULL, 'ເມືຶອງ ໄກສອນ, ແຂວງ ສະຫວັນນະເຂດ'),
(5, 'ແຂວງ ຈຳປາສັກ', 'CPS', NULL, NULL, 'ເມືອງ ປາກເຊ, ແຂວງ ຈຳປາສັກ'),
(8, 'ແຂວງ ບໍລິຄຳໄຊ', 'BKS', NULL, NULL, 'ແຂວງ ບໍລິຄຳໄຊ'),
(9, 'ແຂວງ ຄຳມ່ວນ', 'KM', NULL, NULL, 'ແຂວງ ຄຳມ່ວນ'),
(10, 'ແຂວງ ສາລະວັນ', 'SLV', NULL, NULL, 'ແຂວງ ສາລະວັນ'),
(11, 'ແຂວງ ເຊກອງ', 'XK', NULL, NULL, 'ແຂວງ ເຊກອງ'),
(12, 'ແຂວງ ອັດຕະປື', 'ATP', NULL, NULL, 'ແຂວງ ອັດຕະປື'),
(13, 'ແຂວງ ຫຼວງພະບາງ', 'LPB', NULL, NULL, 'ແຂວງ ຫຼວງພະບາງ'),
(14, 'ແຂວງ ຫຼວງນ້ຳທາ', 'LNT', NULL, NULL, 'ແຂວງ ຫຼວງນ້ຳທາ'),
(15, 'ແຂວງ ຫົວພັນ', 'HP', NULL, NULL, 'ແຂວງ ຫົວພັນ'),
(16, 'ແຂວງ ອຸດົມໄຊ', 'ODX', NULL, NULL, 'ແຂວງ ອຸດົມໄຊ'),
(17, 'ແຂວງ ບໍ່ແກ້ວ', 'BOK', NULL, NULL, 'ແຂວງ ບໍ່ແກ້ວ'),
(18, 'ແຂວງ ວຽງຈັນ', 'VTN', NULL, NULL, 'ແຂວງ ວຽງຈັນ'),
(19, 'ແຂວງ ໄຊຍະບູລີ', 'XBL', NULL, NULL, 'ແຂວງ ໄຊຍະບູລີ'),
(21, 'ແຂວງ ຊຽງຂວາງ', 'XKH', NULL, NULL, 'ແຂວງ ຊຽງຂວາງ'),
(22, 'ແຂວງ ຜົ້ງສາລີ', 'PSL', NULL, NULL, 'ແຂວງ ຜົ້ງສາລີ'),
(23, 'ແຂວງ ໄຊສົມບູນ', 'XSB', NULL, NULL, 'ແຂວງ ໄຊສົມບູນ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ans_bills`
--
ALTER TABLE `ans_bills`
  ADD PRIMARY KEY (`bill_id`),
  ADD UNIQUE KEY `bill_id` (`bill_id`);

--
-- Indexes for table `ans_branch_stocks`
--
ALTER TABLE `ans_branch_stocks`
  ADD PRIMARY KEY (`_id`);

--
-- Indexes for table `ans_category_of_sale`
--
ALTER TABLE `ans_category_of_sale`
  ADD PRIMARY KEY (`cate_id`);

--
-- Indexes for table `ans_pricing`
--
ALTER TABLE `ans_pricing`
  ADD PRIMARY KEY (`_id`),
  ADD KEY `_id` (`_id`);

--
-- Indexes for table `ans_production_of_sale`
--
ALTER TABLE `ans_production_of_sale`
  ADD PRIMARY KEY (`pro_id`),
  ADD KEY `pro_id` (`pro_id`),
  ADD KEY `pro_number` (`pro_number`(1));

--
-- Indexes for table `ans_receive_of_sale`
--
ALTER TABLE `ans_receive_of_sale`
  ADD PRIMARY KEY (`_id`);

--
-- Indexes for table `ans_requirements`
--
ALTER TABLE `ans_requirements`
  ADD PRIMARY KEY (`_id`);

--
-- Indexes for table `ans_sale`
--
ALTER TABLE `ans_sale`
  ADD PRIMARY KEY (`_id`),
  ADD KEY `_id` (`_id`);

--
-- Indexes for table `ans_stock_of_sale`
--
ALTER TABLE `ans_stock_of_sale`
  ADD PRIMARY KEY (`st_id`),
  ADD KEY `st_id` (`st_id`);

--
-- Indexes for table `member_user`
--
ALTER TABLE `member_user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `branch_id` (`branch_id`),
  ADD KEY `position` (`position`),
  ADD KEY `status_id` (`status_id`);

--
-- Indexes for table `office_branches`
--
ALTER TABLE `office_branches`
  ADD PRIMARY KEY (`id_branch`) USING BTREE,
  ADD KEY `provinceID` (`provinceID`) USING BTREE,
  ADD KEY `id_branch` (`id_branch`) USING BTREE,
  ADD KEY `public` (`public`) USING BTREE,
  ADD KEY `districtName` (`districtName`) USING BTREE;

--
-- Indexes for table `office_state_branches`
--
ALTER TABLE `office_state_branches`
  ADD PRIMARY KEY (`id_state`) USING BTREE,
  ADD KEY `id_state` (`id_state`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ans_branch_stocks`
--
ALTER TABLE `ans_branch_stocks`
  MODIFY `_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `ans_category_of_sale`
--
ALTER TABLE `ans_category_of_sale`
  MODIFY `cate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `ans_pricing`
--
ALTER TABLE `ans_pricing`
  MODIFY `_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `ans_production_of_sale`
--
ALTER TABLE `ans_production_of_sale`
  MODIFY `pro_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `ans_requirements`
--
ALTER TABLE `ans_requirements`
  MODIFY `_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `ans_sale`
--
ALTER TABLE `ans_sale`
  MODIFY `_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `ans_stock_of_sale`
--
ALTER TABLE `ans_stock_of_sale`
  MODIFY `st_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `member_user`
--
ALTER TABLE `member_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22223;

--
-- AUTO_INCREMENT for table `office_branches`
--
ALTER TABLE `office_branches`
  MODIFY `id_branch` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `office_state_branches`
--
ALTER TABLE `office_state_branches`
  MODIFY `id_state` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
