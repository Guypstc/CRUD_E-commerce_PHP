-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 09, 2024 at 06:28 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `pro_id` int(11) NOT NULL,
  `order_price` float NOT NULL,
  `quantity` int(11) NOT NULL,
  `total` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`id`, `order_id`, `pro_id`, `order_price`, `quantity`, `total`) VALUES
(1, 1, 5, 42000, 1, 42000),
(2, 2, 3, 24000, 1, 24000),
(3, 3, 4, 30000, 5, 150000),
(4, 4, 3, 24000, 1, 24000),
(5, 4, 7, 15900, 1, 15900),
(6, 5, 2, 19000, 3, 57000),
(7, 6, 2, 19000, 5, 95000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_answer`
--

CREATE TABLE `tb_answer` (
  `id` int(11) NOT NULL,
  `id_person` int(11) NOT NULL,
  `id_question` int(11) NOT NULL,
  `score` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_answer`
--

INSERT INTO `tb_answer` (`id`, `id_person`, `id_question`, `score`) VALUES
(1, 0, 1, ''),
(2, 0, 2, ''),
(3, 0, 3, ''),
(4, 0, 4, ''),
(5, 0, 5, ''),
(6, 1, 1, '5'),
(7, 1, 2, '4'),
(8, 1, 3, '5'),
(9, 1, 4, '3'),
(10, 1, 5, '3'),
(11, 2, 1, '3'),
(12, 2, 2, '3'),
(13, 2, 3, '3'),
(14, 2, 4, '3'),
(15, 2, 5, '3'),
(16, 3, 1, '3'),
(17, 3, 2, '3'),
(18, 3, 3, '3'),
(19, 3, 4, '3'),
(20, 3, 5, '3'),
(21, 4, 1, '3'),
(22, 4, 2, '3'),
(23, 4, 3, '3'),
(24, 4, 4, '3'),
(25, 4, 5, '3'),
(26, 5, 1, '3'),
(27, 5, 2, '3'),
(28, 5, 3, '3'),
(29, 5, 4, '3'),
(30, 5, 5, '3'),
(31, 0, 6, '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_board`
--

CREATE TABLE `tb_board` (
  `b_id` int(11) NOT NULL,
  `b_parent_id` int(11) NOT NULL,
  `b_topic` varchar(80) DEFAULT NULL,
  `b_detail` text NOT NULL,
  `b_views` varchar(80) NOT NULL,
  `b_replie` int(11) NOT NULL,
  `b_time_add` date NOT NULL DEFAULT current_timestamp(),
  `b_time_update` date NOT NULL DEFAULT current_timestamp(),
  `pro_id` int(11) NOT NULL,
  `m_id` int(11) NOT NULL,
  `read_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_board`
--

INSERT INTO `tb_board` (`b_id`, `b_parent_id`, `b_topic`, `b_detail`, `b_views`, `b_replie`, `b_time_add`, `b_time_update`, `pro_id`, `m_id`, `read_status`) VALUES
(3, 0, 'หวานจริงป่าว', 'ผมสงสัยครับ', '30', 0, '2023-12-08', '2024-02-06', 2, 2, 1),
(18, 0, 'ดีครับ', '123', '3', 0, '2024-02-07', '2024-02-07', 2, 1, 1),
(19, 3, NULL, 'ดีครับบ', '', 0, '2024-02-07', '2024-02-07', 0, 1, 0),
(20, 0, 'ดีมั้ย', 'อยากรู้คีับ', '5', 0, '2024-02-16', '2024-02-16', 3, 4, 1),
(22, 0, 'wf', 'waf', '', 0, '2024-03-06', '2024-03-06', 2, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_disease`
--

CREATE TABLE `tb_disease` (
  `d_id` int(11) NOT NULL,
  `d_name` text NOT NULL,
  `d_pack_name` text NOT NULL,
  `d_pack_1` text NOT NULL,
  `d_pack_2` text NOT NULL,
  `d_pack_3` text NOT NULL,
  `d_pack_4` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_disease`
--

INSERT INTO `tb_disease` (`d_id`, `d_name`, `d_pack_name`, `d_pack_1`, `d_pack_2`, `d_pack_3`, `d_pack_4`) VALUES
(1, 'โรคเบาหวาน', 'แพ็คเกจ ตรวจสุขภาพเบาหวาน', 'ตรวจระดับน้ำตาลในเลือด', 'ตรวจระดับน้ำตาลสะสม', 'ตรวจระดับไขมันในเลือด', 'ตรวจการทำงานของตับ'),
(2, 'โรคระบบประสาทและสมอง', 'แพ็คเกจ ตรวจคัดกรอกภาวะสมองเสื่อม', 'ตรวจร่างกายโดยแพทย์ทางด้านเฉพาะ', 'ตรวจทดสอบความจำตรวจการทำงานของต่อมไทรอยด์', 'ตรวจทดสอบความจำ', 'ตรวจระดับวิตามินบี 12'),
(3, 'โรคตา', 'แพ็คเกจ ตรวจสุขภาพ 10 รายการ', 'ตรวจตาด้วยกล้องจุลทรรศ์ชนิดพิเศษ', 'วัดระยะการมองเห็น', 'วัดความดันลูกตาด้วยเครื่อง iCare', 'วัดสายตาอย่างละเอียดโดยนักทัศนมาตรผู็ชำนาญการ'),
(4, 'โรคทางกระดูก', 'แพ็คเกจ ตรวจสุขภาพกรพดูกและตรวจกระดูกพรุน', 'ตรวจความหนาแน่นของมวลกระดูก ด้วยวิธีเอกซเรย์', 'การตรวจระดับแคลเซียมในเลือด', 'การตรวจระดับฟอสเฟตในเลือด', 'การตรวจระดับวิตามินดี'),
(5, 'โรคไต', 'แพ็ตเกจ ตรวจสุขภาพกระดูกและกระดูกพรุน', 'ตรวจหาค่าดัชนีมวลกายและวัดค่าสัญญาณชีพ', 'ตรวจการทำงานของไตอย่างระเอียด', 'ตรวจปัสสาวะทั่วไป', 'ตรวจค่าโปรตีน');

-- --------------------------------------------------------

--
-- Table structure for table `tb_member`
--

CREATE TABLE `tb_member` (
  `m_id` int(11) NOT NULL,
  `m_name` varchar(70) NOT NULL,
  `m_email` varchar(70) NOT NULL,
  `m_pass` int(20) NOT NULL,
  `m_tel` varchar(10) NOT NULL,
  `m_image` varchar(100) NOT NULL,
  `m_add` varchar(70) NOT NULL,
  `m_sub` varchar(40) NOT NULL,
  `m_dis` varchar(40) NOT NULL,
  `m_pro` varchar(40) NOT NULL,
  `m_zip` varchar(6) NOT NULL,
  `m_level` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tb_member`
--

INSERT INTO `tb_member` (`m_id`, `m_name`, `m_email`, `m_pass`, `m_tel`, `m_image`, `m_add`, `m_sub`, `m_dis`, `m_pro`, `m_zip`, `m_level`) VALUES
(1, 'guy', 'guy@gmail.com', 123, '0826404628', 'user.png', '89/145 ถนน สามัคคีชัย2', 'เมืองไทยนะจ๊ะ', 'ในเมือง', 'เพชรบูรณ์', '672400', '1'),
(2, 'ประสิทธิชัย เมืองไทย', 'guypstc@gmail.com', 123, '0826404628', 'user.png', '8123456', 'เมือง', 'ในเมือง', 'เพชรบูรณ์', '672400', '2'),
(3, 'คามิน อุดสี', 'kamin@gmail.com', 123, '0820371046', 'user.png', '', '', '', '', '', '2'),
(4, 'ทองดี', 'guy6@gmail.com', 123, '0826404628', 'user.png', '890', 'เมืองไทย', 'เมือง', 'เพชร', '67110', '2');

-- --------------------------------------------------------

--
-- Table structure for table `tb_order`
--

CREATE TABLE `tb_order` (
  `order_id` int(6) UNSIGNED ZEROFILL NOT NULL,
  `cus_name` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `subdistrict` varchar(30) NOT NULL,
  `district` varchar(30) NOT NULL,
  `province` varchar(30) NOT NULL,
  `zipcode` varchar(6) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `total_price` float NOT NULL,
  `slipe_image` varchar(70) NOT NULL,
  `order_status` varchar(1) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tb_order`
--

INSERT INTO `tb_order` (`order_id`, `cus_name`, `address`, `subdistrict`, `district`, `province`, `zipcode`, `phone`, `total_price`, `slipe_image`, `order_status`, `date`) VALUES
(000001, 'ประสิทธิชัย เมืองไทย', '89', 'เมือง', 'ในเมือง', 'เพชรบูรณ์', '672400', '0826404628', 42000, '1502242042370.jpg', '0', '2024-02-15 19:48:49'),
(000002, 'ประสิทธิชัย เมืองไทย', '89', 'เมือง', 'ในเมือง', 'เพชรบูรณ์', '672400', '0826404628', 24000, '1502242043060.jpg', '2', '2024-02-15 19:51:46'),
(000003, 'guy', '89/145 ถนน สามัคคีชัย2', 'เมืองไทย', 'ในเมือง', 'เพชรบูรณ์', '672400', '0826404628', 150000, '1502242051330.jpg', '2', '2024-02-16 06:42:10'),
(000004, 'guy', '89/145 ถนน สามัคคีชัย2', 'เมืองไทย', 'ในเมือง', 'เพชรบูรณ์', '672400', '0826404628', 39900, '', '0', '2024-02-16 04:32:00'),
(000005, 'ประสิทธิชัย เมืองไทย', '8123456', 'เมือง', 'ในเมือง', 'เพชรบูรณ์', '672400', '0826404628', 57000, '1602240531450.png', '1', '2024-02-16 04:31:45'),
(000006, 'ทองดี', '', '', '', '', '', '0826404628', 95000, '', '1', '2024-02-16 06:37:57');

-- --------------------------------------------------------

--
-- Table structure for table `tb_person`
--

CREATE TABLE `tb_person` (
  `id_person` int(11) NOT NULL,
  `age` varchar(50) NOT NULL,
  `created` date NOT NULL DEFAULT current_timestamp(),
  `education` varchar(80) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `status` varchar(80) NOT NULL,
  `m_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_person`
--

INSERT INTO `tb_person` (`id_person`, `age`, `created`, `education`, `gender`, `status`, `m_id`) VALUES
(1, 'อายุต่ำกว่า 20 ปี', '0000-00-00', 'รายได้ระหว่าง 20,000-30,000 บาท', 'ชาย', '-', 1),
(2, ' อายุสูงกว่า 60 ปี', '0000-00-00', ' รายได้ระหว่าง 40,000-50,000 บาท', 'ชาย', 'dasv', 1),
(3, 'อายุต่ำกว่า 20 ปี', '0000-00-00', ' รายได้สูงกว่า 50,000 บาท', 'หญิง', 'dwad', 1),
(4, 'อายุระหว่าง 30-40 ปี', '0000-00-00', ' รายได้ระหว่าง 10,000-20,000 บาท', 'ชาย', 'dw', 0),
(5, 'อายุระหว่าง 40-50 ปี', '0000-00-00', 'รายได้ระหว่าง 20,000-30,000 บาท', 'ชาย', 'dw', 0),
(6, 'อายุระหว่าง 20-30 ปี', '0000-00-00', ' รายได้ระหว่าง 10,000-20,000 บาท', 'ชาย', 'dw', 0),
(7, 'อายุระหว่าง 20-30 ปี', '0000-00-00', ' รายได้ระหว่าง 10,000-20,000 บาท', 'ชาย', 'dw', 2),
(8, 'อายุระหว่าง 20-30 ปี', '0000-00-00', ' รายได้ระหว่าง 10,000-20,000 บาท', 'ชาย', 'dw', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_product`
--

CREATE TABLE `tb_product` (
  `pro_id` int(11) NOT NULL,
  `pro_name` varchar(80) NOT NULL,
  `pro_image1` text NOT NULL,
  `pro_image2` text NOT NULL,
  `pro_image3` text NOT NULL,
  `pro_num` int(11) NOT NULL,
  `pro_price` int(11) NOT NULL,
  `pro_detail` text NOT NULL,
  `pro_topic_total` int(11) NOT NULL,
  `pro_replie_total` int(11) NOT NULL,
  `s_id` int(11) NOT NULL,
  `t_id` int(11) NOT NULL,
  `pro_s_1` text NOT NULL,
  `pro_s_2` text NOT NULL,
  `pro_s_3` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_product`
--

INSERT INTO `tb_product` (`pro_id`, `pro_name`, `pro_image1`, `pro_image2`, `pro_image3`, `pro_num`, `pro_price`, `pro_detail`, `pro_topic_total`, `pro_replie_total`, `s_id`, `t_id`, `pro_s_1`, `pro_s_2`, `pro_s_3`) VALUES
(2, 'Com Set #001', '1502242055300.PNG', '1502242055301.PNG', '1502242055302.PNG', 1, 19000, 'CPU	: INTEL CORE I3-10105 MB	: BIOSTAR B560MHP R2.0 DDR4 RAM	: 16GB (8GBx2) DDR4 3200MHz KINGSTON FURY BEAST SSD	: 500GB SSD M.2 PCIE 4.0 KINGSTON NV2 NVME CASE	: COLD COOL CASE SC1 (BLACK) PSU	: 600W VIKINGS VK 600FW (80 PLUS BRONZE) COOLING	: FAN CASE 8CM DEEPCOOL X FAN 80MM', 0, 0, 2, 1, '', '', ''),
(3, 'Com Set #002', '1502242055570.PNG', '1502242055571.PNG', '1502242055572.PNG', 9, 24000, 'CPU	: INTEL CORE I3-13100 MB	: ASROCK H610M-HDV/M.2+ (DDR5) RAM	: 16GB (8GBx2) DDR5 4800MHz KINGSTON FURY BEAST SSD	: 500GB SSD M.2 PCIE 4.0 KINGSTON NV2 NVME VGA	: INTEL ARC A750 / 8GB ASROCK CHALLENGER D OC CASE	: TSUNAMI UNLIMITED DEEPSPACE M211W-K TG ARGB (BLACK) PSU	: 550W ANTEC ATOM V550 (FULL WATT)', 0, 0, 1, 1, '', '', ''),
(4, 'Com Set #003', '1602240211580.PNG', '1602240211581.PNG', '1602240211582.PNG', 20, 30000, 'CPU	: INTEL CORE I9 - 14900K MB	: ASUS ROG STRIX Z790-A GAMING WIFI (DDR5) RAM	: 64GB (32GBx2) DDR5 6000MT/s G.SKILL TRIDENT Z5 RGB WHITE SSD	: 2TB SSD M.2 PCIE 4.0 SAMSUNG 980 PRO NVME VGA	: RTX 4090 / 24GB ASUS ROG STRIX O24G WHITE EDITION (OC/D6X) CASE	: G.SKILL MD1 (WHITE) PSU	: 1000W ASUS ROG STRIX AURA WHITE EDITION (80 PLUS GOLD) COOLING	: LIQUID COOLING G.SKILL ROYAL SHIELD 360 WHITE', 0, 0, 1, 1, '', '', ''),
(5, 'Com Set #004', '1602240211250.PNG', '1602240211251.PNG', '1602240211252.PNG', 12, 42000, 'CPU	: INTEL CORE I3-13100 MB	: ASROCK H610M-HDV/M.2+ (DDR5) RAM	: 16GB (8GBx2) DDR5 4800MHz KINGSTON FURY BEAST SSD	: 500GB SSD M.2 PCIE 4.0 KINGSTON NV2 NVME VGA	: INTEL ARC A750 / 8GB ASROCK CHALLENGER D OC CASE	: TSUNAMI UNLIMITED DEEPSPACE M211W-K TG ARGB (BLACK) PSU	: 550W ANTEC ATOM V550 (FULL WATT)', 0, 0, 1, 1, '', '', ''),
(6, 'Notebook Acer  (Steel Gray)', '1602240212260.PNG', '', '', 10, 19900, 'Brand	Acer Model	 Aspire Lite AL15-51M-5318/T004 (NX.KS5ST.004)  Processor	 Intel Core i5-1155G7 (2.5GHz Up to 4.5GHz, 8MB Intel Smart Cache)  Chipset	 Intel SoC Platform  Graphics	 Integrated Graphics  Display Screen	 15.6', 0, 0, 1, 2, '', '', ''),
(7, 'Notebook Acer Aspire Lite (Titanium Gray)', '1602240213090.png', '', '', 12, 15900, ' Brand	Acer Model	 Aspire Lite AL15-51M-5318/T004 (NX.KS5ST.004)  Processor	 Intel Core i5-1155G7 (2.5GHz Up to 4.5GHz, 8MB Intel Smart Cache)  Chipset	 Intel SoC Platform  Graphics	 Integrated Graphics  Display Screen	 15.6', 0, 0, 2, 2, '', '', ''),
(8, 'Notebook Acer TravelMate  (Black)', '1602240214240.PNG', '', '', 10, 12900, 'Brand	Acer Model	 TravelMate TMP214-53-520Z/T0BC (UN.VPNST.0BC)  Processor	 Intel Core i5-1135G7 (2.4GHz up to 4.2GHz, 8MB Intel Smart Cache)  Chipset	 Intel SoC Platform  Graphics	 Intel UHD Graphics (Integrated Graphics)  Display Screen	 14.0', 0, 0, 3, 2, '', '', ''),
(9, 'Notebook Asus Vivobook 16  (Indie Black)', '1602240214540.PNG', '', '', 10, 13990, 'Brand	ASUS Model	 Vivobook 16 (X1605ZA-MB332W)  Processor	 Intel Core i3-1215U (1.2GHz up to 4.4GHz, 10MB Intel Smart Cache)  Chipset	 Intel SoC Platform  Graphics	 Intel UHD Graphics (Integrated Graphics)  Display Screen	 16.0', 0, 0, 1, 2, '', '', ''),
(10, 'Notebook Asus Vivobook 16  (Indie Black)', '1602240215260.png', '1602240215261.png', '', 10, 22990, 'Brand	ASUS Model	  K3605ZF-N1529W  Processor	 Intel Core i5-12450H (2.0GHz up to 4.4GHz, 12MB Intel Smart Cache)  Chipset	 Intel SoC Platform  Graphics	 NVIDIA GeForce RTX 2050 (4GB GDDR6)  Display Screen	 16.0', 0, 0, 1, 2, '', '', ''),
(11, 'Notebook Asus Vivobook 15X OLED  (Indie Black)', '1602240218150.png', '1602240218151.png', '', 10, 25990, 'Brand	Asus Model	 Vivobook 15X OLED (D3504YA-L1707WS)  Processor	 AMD Ryzen 7 7730U (2.0GHz up to 4.5GHz, 4MB L2 / 16MB L3 Cache)  Chipset	 AMD SoC Platform  Graphics	 AMD Radeon Graphics (Integrated Graphics)  Display Screen	 15.6', 0, 0, 1, 2, '', '', ''),
(12, 'CPU AMD AM4 RYZEN 7 5800X', '1602240218520.png', '', '', 10, 8490, 'Brand	AMD Ryzen Model	 Ryzen 7 5800X  Socket	 AM4  # of Cores	 8  # of Threads	 16  Frequency	 3.8 GHz  Turbo Frequency	 4.7 GHz  Level 1 Cache	 N/A  Level 2 Cache	 4MB  Level 3 Cache	 32MB  Integrated graphics	 None  CPU Cooler	 None  Package Dimension	(W x D x H) : 13.20 x 7.10 x 13.50 cm Gross Weight	0.12 KG Volume	1,265.22 cm3', 0, 0, 1, 3, '', '', ''),
(13, 'CPU AMD AM4 RYZEN 9 5900X', '1602240219520.png', '1602240219521.png', '', 10, 12290, 'Brand	AMD Ryzen Model	 Ryzen 9 5900X  Socket	 AM4  # of Cores	 12  # of Threads	 24  Frequency	 3.7 GHz  Turbo Frequency	 4.8 GHz  Level 1 Cache	 N/A  Level 2 Cache	 6MB  Level 3 Cache	 64MB  Integrated graphics	 No Integrated Graphics  CPU Cooler	 None  Package Dimension	(W x D x H) : 13.20 x 7.10 x 13.50 cm Gross Weight	0.12 KG Volume	1,265.22 cm3', 0, 0, 2, 3, '', '', ''),
(14, 'CPU AMD AM5 RYZEN 9 7950X3D', '1602240426570.png', '', '', 10, 24700, ' Brand	AMD Ryzen Model	 Ryzen 9 7950X3D  Socket	 AM5  # of Cores	 16  # of Threads	 32  Frequency	 4.2 GHz  Turbo Frequency	 5.7 GHz  Level 1 Cache	 1MB  Level 2 Cache	 16MB  Level 3 Cache	 128MB  Integrated graphics	 AMD Radeon Graphics  CPU Cooler	 No  Package Dimension	(W x D x H) : 9.00 x 13.00 x 13.00 cm Gross Weight	0.30 KG Volume	1,521.00 cm3', 0, 0, 1, 3, '', '', ''),
(15, 'CPU INTEL CORE I3-13100 LGA 1700', '1602240221480.png', '', '', 10, 5290, 'Brand	Intel Model	 Core i3-13100  Socket	 1700  # of Cores	 4 Cores  # of Threads	 8 Threads  Frequency	 3.4 GHz  Turbo Frequency	 4.5 GHz  Cache	 12 MB Intel Smart Cache  Integrated Graphics	 Intel UHD Graphics 730  CPU Cooler	 Yes  Package Dimension	(W x D x H) : 10.00 x 12.00 x 8.00 cm Gross Weight	0.45 KG Volume	960.00 cm3', 0, 0, 3, 3, '', '', ''),
(16, 'CPU INTEL CORE I5-14600K LGA 1700', '1602240224030.png', '', '', 10, 12990, 'Brand	Intel Model	 CORE I5-14600K  Socket	 1700  # of Cores	 14  # of Threads	 20  Frequency	 3.5 GHz  Turbo Frequency	 5.3 GHz  Cache	 24 MB Intel Smart Cache  Integrated Graphics	 Intel UHD Graphics 770  CPU Cooler	 None  Package Dimension	(W x D x H) : 10.40 x 11.50 x 4.50 cm Gross Weight	0.09 KG Volume	538.20 cm3', 0, 0, 1, 3, '', '', ''),
(17, 'CPU INTEL CORE I7-12700F LGA 1700', '1602240224290.png', '', '', 10, 10500, 'Brand	Intel Model	 Core i7 - 12700F  Socket	 1700  # of Cores	 12  # of Threads	 20  Frequency	 2.1 GHz  Turbo Frequency	 4.9 GHz  Cache	 25 MB Intel Smart Cache  Integrated Graphics	 None  CPU Cooler	 Yes  Package Dimension	(W x D x H) : 10.60 x 7.90 x 12.00 cm Gross Weight	0.46 KG Volume	1,004.88 cm3', 0, 0, 1, 3, '', '', ''),
(18, 'MAINBOARD (AM4) ASUS PRIME ', '1602240330210.png', '', '', 5, 1899, 'A520M-K DDR4 Support CPU : AMD Ryzen 5000 Series / 5000 G-Series / 4000 G-Series / 3000 Series Desktop Processors From Factor : Micro ATX Memory Channel : Dual Channel DDR4 2DIMM Memory Support : up to 4866(O.C.) Memory MAX : 64GB M.2 Slot : 1 slot SATA III 6G : 4 ports PCIe 3.0x16 : 1 slot Lan Port : Realtek RTL8111H 1Gb Ethernet Comprehensive cooling : ระบบระบายความร้อนที่ดีเยี่ยมซึ่งประกอบไปด้วย PCH heatsink และ Fan Xpert Ultrafast connectivity : เชื่อมต่อได้อย่างรวดเร็วด้วยการรองรับ M.2 upport, 1 Gb Ethernet, USB 3.2 Gen 2 Type-A 5X Protection III : เทคโนโลยีที่ช่วยป้องกันอุปกรณ์ต่างๆ', 0, 0, 0, 4, '', '', ''),
(19, 'RAM DDR3(1066) 2GB BLACKBERRY 16 CHIP - A0033954', '1602240321080.png', '', '', 5, 130000, 'Memory Series : BLACKBERRY 16 CHIP Memory Type : DDR3 Memory Size : 2GB (2GBX1) Tested Latency : CL N/A Tested Voltage : N/A Tested Speed : 1066MHz LED Lighting : None Compatibility : Intel / AMD', 0, 0, 1, 5, '', '', ''),
(20, 'RAM DDR3(1600) 4GB BLACKBERRY MAXIMUS 8 CHIP', '1602240324580.png', '', '', 5, 130000, 'Memory Series : Blackberry MAXIMUS Memory Type : DDR3 Memory Size : 4GB (4GBX1) Tested Latency : CL N/A Tested Voltage : N/A Tested Speed : 1600MHz LED Lighting : None Compatibility : Intel / AMD', 0, 0, 1, 5, '', '', ''),
(21, 'RAM DDR3(1600)', '1602240326420.png', '', '', 20, 8999, ' 4GB APACER (DL.04G2K.HAM) Memory Series : APACER Memory Type : DDR3 Memory Size : 4GB Tested Latency : N/A Tested Voltage : 1.35V Tested Speed : 1600MHz LED Lighting : None Compatibility : Intel,AMD Performance Profile : None', 0, 0, 1, 5, '', '', ''),
(22, 'MAINBOARD (AM4) ', '1602240332410.png', '', '', 20, 19999, 'GIGABYTE A520M-K V2 DDR4 (REV. 1.1) Support CPU : AMD Ryzen 5000 / 4000 / 3000 Series Desktop Processors From Factor : Micro ATX Chipset : AMD A520 Chipset Memory Channel : Dual Channel DDR4 2DIMM Memory Support : up to 5100(O.C.) Memory MAX : 64GB M.2 Slot : 1 slot SATA III 6G : 4 ports PCIe 3.0x16 : 1 slot Lan Port : 1 Gigabit LAN 8-Channel HD Audio with High Quality Audio Capacitors? Rear HDMI and D-sub for Multi-display Support Smart Fan 5 Features Multiple Temperature Sensors, Hybrid Fan Headers with FAN STOP? GIGABYTE APP Center, Simple and Easy Use??', 0, 0, 1, 4, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_question`
--

CREATE TABLE `tb_question` (
  `id_question` int(11) NOT NULL,
  `question` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tb_question`
--

INSERT INTO `tb_question` (`id_question`, `question`) VALUES
(1, 'คำถาม1'),
(2, 'คำถาม2'),
(3, 'คำถาม3'),
(4, 'คำถาม4'),
(5, 'คำถาม5'),
(6, 'คำถาม6');

-- --------------------------------------------------------

--
-- Table structure for table `tb_slide`
--

CREATE TABLE `tb_slide` (
  `s_id` int(11) NOT NULL,
  `s_image_file` text NOT NULL,
  `s_time_add` timestamp NOT NULL DEFAULT current_timestamp(),
  `t_id` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_slide`
--

INSERT INTO `tb_slide` (`s_id`, `s_image_file`, `s_time_add`, `t_id`) VALUES
(1, '150224205643.png', '2023-12-02 07:29:57', 2),
(3, '120224044202.png', '2023-12-02 07:34:32', 0),
(5, '150224205634.png', '2023-12-09 08:24:01', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_type`
--

CREATE TABLE `tb_type` (
  `t_id` int(11) NOT NULL,
  `t_name` varchar(80) NOT NULL,
  `t_name_eng` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_type`
--

INSERT INTO `tb_type` (`t_id`, `t_name`, `t_name_eng`) VALUES
(1, 'คอมเซ็ท', 'Comset'),
(2, 'โน็ทบุ๊ค', 'Notebook'),
(3, 'ซีพียู', 'CPU'),
(4, 'เมนบอท', 'MAINBOARD'),
(5, 'แรม', 'Ram');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_answer`
--
ALTER TABLE `tb_answer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_board`
--
ALTER TABLE `tb_board`
  ADD PRIMARY KEY (`b_id`);

--
-- Indexes for table `tb_disease`
--
ALTER TABLE `tb_disease`
  ADD PRIMARY KEY (`d_id`);

--
-- Indexes for table `tb_member`
--
ALTER TABLE `tb_member`
  ADD PRIMARY KEY (`m_id`);

--
-- Indexes for table `tb_order`
--
ALTER TABLE `tb_order`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `tb_person`
--
ALTER TABLE `tb_person`
  ADD PRIMARY KEY (`id_person`),
  ADD KEY `m_id` (`m_id`);

--
-- Indexes for table `tb_product`
--
ALTER TABLE `tb_product`
  ADD PRIMARY KEY (`pro_id`);

--
-- Indexes for table `tb_question`
--
ALTER TABLE `tb_question`
  ADD PRIMARY KEY (`id_question`);

--
-- Indexes for table `tb_slide`
--
ALTER TABLE `tb_slide`
  ADD PRIMARY KEY (`s_id`);

--
-- Indexes for table `tb_type`
--
ALTER TABLE `tb_type`
  ADD PRIMARY KEY (`t_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_answer`
--
ALTER TABLE `tb_answer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `tb_board`
--
ALTER TABLE `tb_board`
  MODIFY `b_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tb_disease`
--
ALTER TABLE `tb_disease`
  MODIFY `d_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_member`
--
ALTER TABLE `tb_member`
  MODIFY `m_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_order`
--
ALTER TABLE `tb_order`
  MODIFY `order_id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_person`
--
ALTER TABLE `tb_person`
  MODIFY `id_person` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_product`
--
ALTER TABLE `tb_product`
  MODIFY `pro_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tb_slide`
--
ALTER TABLE `tb_slide`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_type`
--
ALTER TABLE `tb_type`
  MODIFY `t_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
