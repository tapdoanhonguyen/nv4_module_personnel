-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 07, 2023 at 09:35 AM
-- Server version: 10.6.12-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sml_home`
--

-- --------------------------------------------------------

--
-- Table structure for table `nv4_vi_personnel_allowances`
--

CREATE TABLE `nv4_vi_personnel_allowances` (
  `allowances_id` mediumint(8) UNSIGNED NOT NULL,
  `personnel_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `allow_id` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  `money` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nv4_vi_personnel_data`
--

CREATE TABLE `nv4_vi_personnel_data` (
  `data_id` mediumint(8) UNSIGNED NOT NULL,
  `title` varchar(235) NOT NULL DEFAULT '',
  `group_name` varchar(15) NOT NULL DEFAULT '',
  `weight` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `date_added` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `date_modified` int(10) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nv4_vi_personnel_data`
--

INSERT INTO `nv4_vi_personnel_data` (`data_id`, `title`, `group_name`, `weight`, `status`, `date_added`, `date_modified`) VALUES
(1, 'Bố', 'family', 1, 1, 1604819946, 0),
(2, 'Mẹ', 'family', 2, 1, 1604819961, 0),
(3, 'Vợ', 'family', 3, 1, 1604819983, 0),
(4, 'Chồng', 'family', 4, 1, 1604819989, 0),
(5, 'Con', 'family', 5, 1, 1604819992, 0),
(6, 'Anh', 'family', 6, 1, 1604819995, 0),
(7, 'Chị', 'family', 7, 1, 1604819999, 0),
(8, 'Em', 'family', 8, 1, 1604820006, 0),
(9, 'Ông', 'family', 9, 1, 1604820012, 0),
(10, 'Bà', 'family', 10, 1, 1604820015, 0),
(11, 'Sơ cấp', 'deg_level', 1, 1, 1604824528, 0),
(12, 'Trung cấp', 'deg_level', 2, 1, 1604824535, 0),
(13, 'Cao đẳng', 'deg_level', 3, 1, 1604824541, 0),
(14, 'Thạc sỹ', 'deg_level', 4, 1, 1604824550, 0),
(15, 'Tiến sỹ', 'deg_level', 5, 1, 1604824562, 0),
(16, 'Cử nhân', 'deg_level', 6, 1, 1604824569, 0),
(17, 'Kỹ sư', 'deg_level', 7, 1, 1604824583, 0),
(18, 'Đại học', 'deg_level', 8, 1, 1604824587, 0),
(19, 'Trung cấp nghề', 'deg_level', 9, 1, 1604824592, 0),
(20, 'Tại chức', 'deg_level', 10, 1, 1604824596, 0),
(21, 'Trung học phổ thông', 'deg_level', 11, 1, 1604824610, 0),
(22, 'Trung cấp chuyên nghiệp', 'deg_level', 12, 1, 1604824615, 0),
(23, 'Sơ cấp nghề', 'deg_level', 13, 1, 1604824628, 0),
(24, 'Trung học cơ sở', 'deg_level', 14, 1, 1604824635, 0),
(25, 'Chính quy', 'type', 1, 1, 1604825305, 0),
(26, 'Tại chức', 'type', 2, 1, 1604825314, 0),
(27, 'Chuyên nghiệp', 'type', 3, 1, 1604825327, 0),
(28, 'Bán chuyên nghiệp', 'type', 4, 1, 1604825331, 0),
(29, 'Văn bằng 2', 'deg_level', 5, 1, 1604825345, 0),
(30, 'Phật giáo', 'religious', 2, 1, 1604847013, 0),
(31, 'Thiên chúa giáo', 'religious', 3, 1, 1604847017, 0),
(32, 'Kinh', 'people', 1, 1, 1604847029, 0),
(33, 'Tày', 'people', 2, 1, 1604847032, 0),
(34, 'Bana', 'people', 3, 1, 1604847044, 0),
(35, 'Bố Y', 'people', 4, 1, 1604847054, 0),
(36, 'Brâu', 'people', 5, 1, 1604847061, 0),
(37, 'Cơ đốc giáo', 'religious', 4, 1, 1604847228, 0),
(38, 'Hồi giáo', 'religious', 5, 1, 1604847233, 0),
(39, 'Tin lành', 'religious', 6, 1, 1604847251, 0),
(40, 'Hòa hảo', 'religious', 7, 1, 1604847255, 0),
(41, 'Cao đài', 'religious', 8, 1, 1604847277, 0),
(42, 'Không', 'religious', 1, 1, 1604848705, 0),
(43, 'Khác', 'religious', 9, 1, 1604849454, 0),
(44, 'Ngân hàng Vietcombank', 'job_bank', 1, 1, 1604850702, 0),
(45, 'Ngân hàng Techcombank', 'job_bank', 2, 1, 1604850708, 0),
(46, 'Ngân hàng Agribank', 'job_bank', 3, 1, 1604850717, 0),
(47, 'Ngân hàng Đông Á', 'job_bank', 4, 1, 1604850726, 0),
(54, 'Hợp đồng thử việc', 'contract', 3, 1, 1604925837, 0),
(53, 'Nhân viên', 'level', 4, 1, 1604851674, 0),
(50, 'Trưởng Phòng nhân sự', 'level', 1, 1, 1604851631, 0),
(51, 'Trưởng phòng kinh doanh', 'level', 2, 1, 1604851643, 0),
(52, 'Trưởng phòng lập trình', 'level', 3, 1, 1604851656, 0),
(55, 'Hợp đồng học việc', 'contract', 4, 1, 1604925877, 0),
(56, 'Hợp đồng 6 tháng lần 1', 'contract', 5, 1, 1604925885, 0),
(57, 'Hợp đồng 6 tháng lần 2', 'contract', 6, 1, 1604925898, 0),
(58, 'Hợp đồng 1 năm', 'contract', 7, 1, 1604925906, 0),
(59, 'Hợp Đồng 2 năm', 'contract', 8, 1, 1604925913, 0),
(60, 'Hợp đồng thực tập', 'contract', 2, 1, 1604925921, 0),
(61, 'Hợp đồng thời vụ', 'contract', 9, 1, 1604925943, 0),
(62, 'Hợp đồng vô thời hạn', 'contract', 10, 1, 1604925952, 0),
(63, 'Hợp đồng', 'contract', 1, 1, 1604925962, 0),
(64, 'Bán hàng', 'position', 1, 1, 1604927870, 0),
(65, 'Nhân viên seo', 'position', 2, 1, 1604927879, 0),
(66, 'Nhân viên kinh doanh', 'position', 3, 1, 1604927886, 0),
(67, 'Cố vấn cao cấp', 'position', 4, 1, 1604927897, 0),
(68, 'Cán bộ kỹ thuật', 'job_title', 1, 1, 1604942519, 0),
(69, 'Nhân viên kinh doanh', 'job_title', 2, 1, 1604942526, 0),
(70, 'Giám đốc', 'job_title', 3, 1, 1604942537, 0),
(71, 'Giám đốc chi nhánh', 'job_title', 4, 1, 1604942543, 0),
(72, 'Công ty Smartline', 'work_place', 1, 1, 1604943129, 0),
(112, 'Công ty Panoval', 'work_place', 7, 1, 1685953900, 0),
(73, 'Công ty Delta', 'work_place', 2, 1, 1604943159, 0),
(108, 'Côgn ty TravelPlus', 'work_place', 3, 1, 1682998535, 0),
(74, 'Lương sản phẩm', 'salarymethod', 1, 1, 1604949511, 0),
(75, 'Lương kinh doanh', 'salarymethod', 2, 1, 1604949517, 0),
(76, 'Lương ngày công', 'salarymethod', 3, 1, 1604949522, 0),
(77, 'Lương cộng tác viên', 'salarymethod', 4, 1, 1604949545, 0),
(78, 'Lương theo giờ', 'salarymethod', 5, 1, 1604949550, 0),
(79, 'Lương cơ bản net', 'salarymethod', 6, 1, 1604949871, 0),
(80, 'Gửi xe', 'allowances', 1, 1, 1604952111, 0),
(81, 'Phụ cấp ăn trưa', 'allowances', 2, 1, 1604952119, 0),
(82, 'Phụ cấp chi nhánh', 'allowances', 3, 1, 1604952124, 0),
(83, 'Phụ cấp cơm trưa', 'allowances', 4, 1, 1604952130, 0),
(84, 'Phụ cấp điện thoại', 'allowances', 5, 1, 1604952135, 0),
(85, 'Phụ cấp độc hại', 'allowances', 6, 1, 1604952144, 0),
(86, 'Phụ cấp gửi xe', 'allowances', 7, 1, 1604952148, 0),
(87, 'Phụ cấp xa nhà', 'allowances', 8, 1, 1604952154, 0),
(88, 'Phụ cấp xăng xe', 'allowances', 9, 1, 1604952161, 0),
(89, 'Trách nhiệm', 'allowances', 10, 1, 1604952167, 0),
(90, 'Trả', 'bookstatus', 1, 1, 1604954651, 0),
(91, 'Sửa', 'bookstatus', 2, 1, 1604954654, 0),
(92, 'Chốt', 'bookstatus', 3, 1, 1604954670, 0),
(93, 'Xin cấp', 'bookstatus', 4, 1, 1604954674, 0),
(94, 'Gộp', 'bookstatus', 5, 1, 1604954678, 0),
(95, 'Công ty giữ sổ', 'bookstatus', 6, 1, 1604954693, 0),
(96, 'Người lao động giữ sổ', 'bookstatus', 7, 1, 1604954701, 0),
(97, 'Nghỉ việc', 'reason', 1, 1, 1604998311, 0),
(98, 'Nghỉ thai sản', 'reason', 2, 1, 1604998324, 0),
(99, 'Thay đổi mức đóng', 'reason', 3, 1, 1604998337, 0),
(100, 'Nghỉ ốm', 'reason', 4, 1, 1604998346, 0),
(101, 'Nghỉ không lương', 'reason', 5, 1, 1604998352, 0),
(102, 'Thay đổi chức danh', 'reason', 6, 1, 1604998361, 0),
(103, 'Chế độ thai sản', 'historysolves', 1, 1, 1604999857, 0),
(104, 'Chế độ ốm đau', 'historysolves', 2, 1, 1604999866, 0),
(105, 'Chế độ tai nạn lao động', 'historysolves', 3, 1, 1604999871, 0),
(106, 'Chế độ hưu trí', 'historysolves', 4, 1, 1604999879, 0),
(107, 'Chế độ tử tuất', 'historysolves', 5, 1, 1604999884, 0),
(109, 'Côgn ty LevelOne', 'work_place', 4, 1, 1682998547, 0),
(110, 'Công ty Empire', 'work_place', 5, 1, 1682998622, 0),
(111, 'Công ty Amore', 'work_place', 6, 1, 1682998639, 0),
(113, 'Công ty Set Education', 'work_place', 8, 1, 1686015271, 0),
(114, 'Công ty Ursin', 'work_place', 9, 1, 1686121337, 0),
(115, 'Công ty Smarttech', 'work_place', 10, 1, 1686121377, 0),
(116, 'Công ty Tân Khải Hoàn', 'work_place', 11, 1, 1686121399, 0),
(117, 'Công ty Wine Embassy', 'work_place', 12, 1, 1686121462, 0),
(118, 'Khách hàng khác', 'work_place', 14, 1, 1686121493, 0),
(119, 'Công ty Aviation', 'work_place', 13, 1, 1686125056, 0);

-- --------------------------------------------------------

--
-- Table structure for table `nv4_vi_personnel_degrees`
--

CREATE TABLE `nv4_vi_personnel_degrees` (
  `degrees_id` mediumint(8) UNSIGNED NOT NULL,
  `personnel_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `type_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `level_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `date_from` varchar(11) NOT NULL,
  `date_to` varchar(11) NOT NULL,
  `specialization` varchar(255) NOT NULL,
  `place` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nv4_vi_personnel_degrees`
--

INSERT INTO `nv4_vi_personnel_degrees` (`degrees_id`, `personnel_id`, `type_id`, `level_id`, `date_from`, `date_to`, `specialization`, `place`) VALUES
(1, 1, 0, 0, '', '', '', ''),
(2, 1, 0, 0, '', '', '', ''),
(3, 2, 0, 0, '', '', '', ''),
(4, 2, 0, 0, '', '', '', ''),
(5, 3, 0, 0, '', '', '', ''),
(6, 3, 0, 0, '', '', '', ''),
(36, 4, 0, 0, '', '', '', ''),
(35, 4, 0, 0, '', '', '', ''),
(9, 9, 0, 0, '', '', '', ''),
(10, 10, 0, 0, '', '', '', ''),
(11, 11, 0, 0, '', '', '', ''),
(12, 11, 0, 0, '', '', '', ''),
(13, 12, 0, 0, '', '', '', ''),
(14, 12, 0, 0, '', '', '', ''),
(15, 13, 0, 0, '', '', '', ''),
(16, 13, 0, 0, '', '', '', ''),
(17, 14, 0, 0, '', '', '', ''),
(18, 14, 0, 0, '', '', '', ''),
(42, 15, 0, 0, '', '', '', ''),
(41, 15, 0, 0, '', '', '', ''),
(21, 16, 0, 0, '', '', '', ''),
(22, 16, 0, 0, '', '', '', ''),
(23, 17, 0, 0, '', '', '', ''),
(24, 17, 0, 0, '', '', '', ''),
(25, 18, 0, 0, '', '', '', ''),
(26, 18, 0, 0, '', '', '', ''),
(27, 19, 0, 0, '', '', '', ''),
(28, 19, 0, 0, '', '', '', ''),
(29, 20, 0, 0, '', '', '', ''),
(30, 20, 0, 0, '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `nv4_vi_personnel_experience`
--

CREATE TABLE `nv4_vi_personnel_experience` (
  `experience_id` mediumint(8) UNSIGNED NOT NULL,
  `personnel_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `position_id` varchar(255) NOT NULL DEFAULT '',
  `date_from` varchar(11) NOT NULL,
  `date_to` varchar(11) NOT NULL,
  `company_title` varchar(255) NOT NULL,
  `contact_info` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `work_desc` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nv4_vi_personnel_experience`
--

INSERT INTO `nv4_vi_personnel_experience` (`experience_id`, `personnel_id`, `position_id`, `date_from`, `date_to`, `company_title`, `contact_info`, `phone`, `work_desc`) VALUES
(1, 1, '', '', '', '', '', '', ''),
(2, 1, '', '', '', '', '', '', ''),
(3, 2, '', '', '', '', '', '', ''),
(4, 2, '', '', '', '', '', '', ''),
(5, 3, '', '', '', '', '', '', ''),
(6, 3, '', '', '', '', '', '', ''),
(26, 4, '', '', '', '', '', '', ''),
(8, 12, '', '', '', '', '', '', ''),
(9, 12, '', '', '', '', '', '', ''),
(10, 13, '', '', '', '', '', '', ''),
(11, 13, '', '', '', '', '', '', ''),
(12, 14, '', '', '', '', '', '', ''),
(13, 14, '', '', '', '', '', '', ''),
(32, 15, '', '', '', '', '', '', ''),
(31, 15, '', '', '', '', '', '', ''),
(16, 16, '', '', '', '', '', '', ''),
(17, 16, '', '', '', '', '', '', ''),
(18, 17, '', '', '', '', '', '', ''),
(19, 17, '', '', '', '', '', '', ''),
(20, 18, '', '', '', '', '', '', ''),
(21, 18, '', '', '', '', '', '', ''),
(22, 19, '', '', '', '', '', '', ''),
(23, 20, '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `nv4_vi_personnel_family`
--

CREATE TABLE `nv4_vi_personnel_family` (
  `family_id` mediumint(8) UNSIGNED NOT NULL,
  `personnel_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `relative_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `is_dependent` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `full_name` varchar(255) NOT NULL,
  `birthday` varchar(11) NOT NULL,
  `job` varchar(255) NOT NULL,
  `origin_state_address` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nv4_vi_personnel_family`
--

INSERT INTO `nv4_vi_personnel_family` (`family_id`, `personnel_id`, `relative_id`, `is_dependent`, `full_name`, `birthday`, `job`, `origin_state_address`, `phone`) VALUES
(1, 1, 0, 0, '', '', '', '', ''),
(2, 1, 0, 0, '', '', '', '', ''),
(3, 2, 0, 0, '', '', '', '', ''),
(4, 2, 0, 0, '', '', '', '', ''),
(5, 3, 0, 0, '', '', '', '', ''),
(6, 3, 0, 0, '', '', '', '', ''),
(42, 4, 0, 0, '', '', '', '', ''),
(41, 4, 0, 0, '', '', '', '', ''),
(9, 5, 0, 0, '', '', '', '', ''),
(10, 6, 0, 0, '', '', '', '', ''),
(11, 7, 0, 0, '', '', '', '', ''),
(12, 8, 0, 0, '', '', '', '', ''),
(13, 9, 0, 0, '', '', '', '', ''),
(14, 9, 0, 0, '', '', '', '', ''),
(15, 10, 0, 0, '', '', '', '', ''),
(16, 10, 0, 0, '', '', '', '', ''),
(17, 11, 0, 0, '', '', '', '', ''),
(18, 11, 0, 0, '', '', '', '', ''),
(19, 12, 0, 0, '', '', '', '', ''),
(20, 12, 0, 0, '', '', '', '', ''),
(21, 13, 0, 0, '', '', '', '', ''),
(22, 13, 0, 0, '', '', '', '', ''),
(23, 14, 0, 0, '', '', '', '', ''),
(24, 14, 0, 0, '', '', '', '', ''),
(48, 15, 0, 0, '', '', '', '', ''),
(47, 15, 0, 0, '', '', '', '', ''),
(27, 16, 0, 0, '', '', '', '', ''),
(28, 16, 0, 0, '', '', '', '', ''),
(29, 17, 0, 0, '', '', '', '', ''),
(30, 17, 0, 0, '', '', '', '', ''),
(31, 18, 0, 0, '', '', '', '', ''),
(32, 18, 0, 0, '', '', '', '', ''),
(33, 19, 0, 0, '', '', '', '', ''),
(34, 19, 0, 0, '', '', '', '', ''),
(35, 20, 0, 0, '', '', '', '', ''),
(36, 20, 0, 0, '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `nv4_vi_personnel_history_insurances`
--

CREATE TABLE `nv4_vi_personnel_history_insurances` (
  `history_insurances_id` mediumint(8) UNSIGNED NOT NULL,
  `personnel_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `date_from` varchar(10) NOT NULL,
  `type` varchar(10) NOT NULL,
  `reason` varchar(100) NOT NULL,
  `salary_premium_base` varchar(14) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nv4_vi_personnel_history_insurances`
--

INSERT INTO `nv4_vi_personnel_history_insurances` (`history_insurances_id`, `personnel_id`, `date_from`, `type`, `reason`, `salary_premium_base`) VALUES
(1, 1, '', '0', '0', '0'),
(2, 1, '', '1', '1', '0'),
(3, 2, '', '0', '0', '0'),
(4, 2, '', '1', '1', '0'),
(5, 3, '', '0', '0', '0'),
(6, 3, '', '1', '1', '0'),
(26, 4, '', '-1', '-1', '0'),
(8, 12, '', '0', '0', '0'),
(9, 12, '', '1', '1', '0'),
(10, 13, '', '0', '0', '0'),
(11, 13, '', '1', '1', '0'),
(12, 14, '', '0', '0', '0'),
(13, 14, '', '1', '1', '0'),
(32, 15, '', '-1', '-1', '0'),
(31, 15, '', '-1', '-1', '0'),
(16, 16, '', '0', '0', '0'),
(17, 16, '', '1', '1', '0'),
(18, 17, '', '0', '0', '0'),
(19, 17, '', '1', '1', '0'),
(20, 18, '', '0', '0', '0'),
(21, 18, '', '1', '1', '0'),
(22, 19, '', '-1', '-1', '0'),
(23, 20, '', '-1', '-1', '0');

-- --------------------------------------------------------

--
-- Table structure for table `nv4_vi_personnel_history_solves`
--

CREATE TABLE `nv4_vi_personnel_history_solves` (
  `history_solves_id` mediumint(8) UNSIGNED NOT NULL,
  `personnel_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `model` varchar(250) NOT NULL DEFAULT '',
  `premium_date_get` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `premium_date_complete` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `premium_date_close` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `premium_date_return` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `price` varchar(14) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nv4_vi_personnel_history_solves`
--

INSERT INTO `nv4_vi_personnel_history_solves` (`history_solves_id`, `personnel_id`, `model`, `premium_date_get`, `premium_date_complete`, `premium_date_close`, `premium_date_return`, `price`) VALUES
(1, 1, '', 0, 0, 0, 0, '0'),
(2, 1, '', 0, 0, 0, 0, '0'),
(3, 2, '', 0, 0, 0, 0, '0'),
(4, 2, '', 0, 0, 0, 0, '0'),
(5, 3, '', 0, 0, 0, 0, '0'),
(6, 3, '', 0, 0, 0, 0, '0'),
(26, 4, '', 0, 0, 0, 0, '0'),
(8, 12, '', 0, 0, 0, 0, '0'),
(9, 12, '', 0, 0, 0, 0, '0'),
(10, 13, '', 0, 0, 0, 0, '0'),
(11, 13, '', 0, 0, 0, 0, '0'),
(12, 14, '', 0, 0, 0, 0, '0'),
(13, 14, '', 0, 0, 0, 0, '0'),
(32, 15, '', 0, 0, 0, 0, '0'),
(31, 15, '', 0, 0, 0, 0, '0'),
(16, 16, '', 0, 0, 0, 0, '0'),
(17, 16, '', 0, 0, 0, 0, '0'),
(18, 17, '', 0, 0, 0, 0, '0'),
(19, 17, '', 0, 0, 0, 0, '0'),
(20, 18, '', 0, 0, 0, 0, '0'),
(21, 18, '', 0, 0, 0, 0, '0'),
(22, 19, '', 0, 0, 0, 0, '0'),
(23, 20, '', 0, 0, 0, 0, '0');

-- --------------------------------------------------------

--
-- Table structure for table `nv4_vi_personnel_personnel`
--

CREATE TABLE `nv4_vi_personnel_personnel` (
  `personnel_id` mediumint(9) NOT NULL,
  `userid` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `personnel_code` varchar(50) NOT NULL DEFAULT '' COMMENT 'Mã nhân viên',
  `timekeeping_code` varchar(50) NOT NULL DEFAULT '' COMMENT 'Mã chấm công',
  `profile_code` varchar(50) NOT NULL DEFAULT '' COMMENT 'Mã hồ sơ',
  `full_name` varchar(100) NOT NULL DEFAULT '' COMMENT 'Họ và tên',
  `gender` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT 'Giới tính',
  `birthday` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Ngày sinh',
  `place_of_birth` varchar(250) NOT NULL DEFAULT '' COMMENT 'Nơi sinh',
  `origin_state` varchar(255) NOT NULL DEFAULT '' COMMENT 'Nguyên quán',
  `private_code` varchar(50) NOT NULL DEFAULT '' COMMENT 'CMT/Căn cước/Hộ Chiếu',
  `private_code_date` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Ngày cấp CMT',
  `private_code_place` varchar(255) NOT NULL DEFAULT '' COMMENT 'Nơi cấp',
  `marital_status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT 'Tình trạng hôn nhân',
  `nationality` smallint(5) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Quốc tịch',
  `people` smallint(5) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Dân tộc: Kinh...',
  `religious` smallint(5) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Tôn giáo',
  `job_bank_account` varchar(50) NOT NULL DEFAULT '' COMMENT 'Số tài khoản BANK',
  `job_bank_account_name` varchar(250) NOT NULL DEFAULT '' COMMENT 'Tên tài khoản BANK',
  `job_bank_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'ID ngân hàng',
  `job_bank_desc` varchar(100) NOT NULL DEFAULT '' COMMENT 'Chi nhánh',
  `job_tax` varchar(100) NOT NULL DEFAULT '' COMMENT 'Mã số thuế cá nhân',
  `level_id` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Cấp bậc',
  `level_school` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Trình độ phổ thông',
  `level_academic` smallint(5) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Trình độ chuyên môn cao nhất',
  `mobile` varchar(100) NOT NULL DEFAULT '' COMMENT 'Điện thoại',
  `email` varchar(100) NOT NULL DEFAULT '' COMMENT 'Email',
  `home_address` varchar(100) NOT NULL DEFAULT '' COMMENT 'Địa chỉ nhà',
  `place_home` mediumint(8) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Nơi ở thường trú',
  `current_address` varchar(100) NOT NULL DEFAULT '' COMMENT 'Địa chỉ hiện tại',
  `place_current` mediumint(8) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'ID nơi ở hiện tại',
  `photo` varchar(250) NOT NULL DEFAULT '' COMMENT 'Ảnh đại diện',
  `description` text NOT NULL DEFAULT '' COMMENT 'Ghi chú',
  `contract_code` varchar(50) NOT NULL DEFAULT '' COMMENT 'Mã hợp đồng',
  `contract_type` smallint(5) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Loại hợp đồng',
  `department_id` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Phòng ban',
  `work_type` smallint(5) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Hình thức làm việc',
  `position_id` smallint(5) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Vị trí làm việc',
  `job_title` smallint(5) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Chức vụ',
  `work_place` mediumint(8) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'ID nơi làm việc',
  `date_start` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Ngày hiệu lực',
  `date_finish` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Ngày kết thúc hợp đồng',
  `date_reg` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Ngày ký',
  `signer_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'ID người ký',
  `salary_date_from` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Ngày đầu lương',
  `salary_method_id` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  `salary_money` varchar(20) NOT NULL DEFAULT '',
  `premium_number` varchar(50) NOT NULL DEFAULT '' COMMENT 'Số sổ bảo hiểm',
  `premium_insurance_status` smallint(5) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Trạng thái sổ',
  `premium_personnel` mediumint(8) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Pháp nhân đóng',
  `premium_card` varchar(50) NOT NULL DEFAULT '' COMMENT 'Số thẻ BHYT',
  `premium_code` smallint(5) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'ĐK khám chữa bệnh',
  `premium_place` mediumint(8) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'ĐK khám chữa bệnh',
  `insup_date_get` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'NV hoàn thiện HS',
  `insup_date_complete` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'NS hoàn thiện HS',
  `insup_date_receive` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Ngày nhận thẻ BHYT',
  `insup_date_return` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Ngày trả thẻ BHYT',
  `insdown_date_get` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Ngày nhận sổ BH từ NLĐ',
  `insdown_date_complete` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'NS hoàn thiện HS',
  `insdown_date_apply` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Ngày nhận sổ BH đã chốt',
  `insdown_date_return` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Ngày trả số cho NLĐ',
  `status_email` tinyint(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Tạo tài khoản email',
  `status_profile` tinyint(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Sơ yếu lý lịch',
  `status_document` tinyint(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Bằng cấp, trình độ chuyên môn',
  `status_photo` tinyint(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Ảnh cá nhân',
  `files` mediumtext NOT NULL DEFAULT '' COMMENT 'Lịch sử giải quyết chế độ',
  `status_identity_card` varchar(255) NOT NULL DEFAULT '',
  `resign_to_bill` varchar(255) NOT NULL DEFAULT '',
  `attachment` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  `date_added` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `date_modified` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `userid_create` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `work_status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1: đang làm việc, 2: thai sản, 3: Nghỉ việc'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nv4_vi_personnel_personnel`
--

INSERT INTO `nv4_vi_personnel_personnel` (`personnel_id`, `userid`, `personnel_code`, `timekeeping_code`, `profile_code`, `full_name`, `gender`, `birthday`, `place_of_birth`, `origin_state`, `private_code`, `private_code_date`, `private_code_place`, `marital_status`, `nationality`, `people`, `religious`, `job_bank_account`, `job_bank_account_name`, `job_bank_id`, `job_bank_desc`, `job_tax`, `level_id`, `level_school`, `level_academic`, `mobile`, `email`, `home_address`, `place_home`, `current_address`, `place_current`, `photo`, `description`, `contract_code`, `contract_type`, `department_id`, `work_type`, `position_id`, `job_title`, `work_place`, `date_start`, `date_finish`, `date_reg`, `signer_id`, `salary_date_from`, `salary_method_id`, `salary_money`, `premium_number`, `premium_insurance_status`, `premium_personnel`, `premium_card`, `premium_code`, `premium_place`, `insup_date_get`, `insup_date_complete`, `insup_date_receive`, `insup_date_return`, `insdown_date_get`, `insdown_date_complete`, `insdown_date_apply`, `insdown_date_return`, `status_email`, `status_profile`, `status_document`, `status_photo`, `files`, `status_identity_card`, `resign_to_bill`, `attachment`, `date_added`, `date_modified`, `userid_create`, `work_status`) VALUES

-- --------------------------------------------------------

--
-- Table structure for table `nv4_vi_personnel_premium`
--

CREATE TABLE `nv4_vi_personnel_premium` (
  `premium_id` smallint(5) UNSIGNED NOT NULL,
  `parent_id` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  `title` varchar(250) NOT NULL,
  `alias` varchar(250) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `numlinks` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  `weight` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  `sort` smallint(5) NOT NULL DEFAULT 0,
  `lev` smallint(5) NOT NULL DEFAULT 0,
  `numsubcat` smallint(5) NOT NULL DEFAULT 0,
  `subcatid` varchar(250) DEFAULT '',
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `date_added` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `date_modified` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nv4_vi_personnel_registermedical`
--

CREATE TABLE `nv4_vi_personnel_registermedical` (
  `registermedical_id` mediumint(8) UNSIGNED NOT NULL,
  `province_id` mediumint(8) NOT NULL DEFAULT 0,
  `title` varchar(250) NOT NULL DEFAULT '',
  `weight` smallint(5) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `date_added` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nv4_vi_personnel_setting`
--

CREATE TABLE `nv4_vi_personnel_setting` (
  `config_name` varchar(50) NOT NULL DEFAULT '',
  `config_value` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nv4_vi_personnel_setting`
--

INSERT INTO `nv4_vi_personnel_setting` (`config_name`, `config_value`) VALUES
('perpage', '100'),
('employer_group', '13'),
('appapi', 'AIzaSyBo_OjoLMPrhglOd5ly_SkMkRt5sPt-Cx0');

-- --------------------------------------------------------

--
-- Table structure for table `nv4_vi_personnel_timekeeper`
--

CREATE TABLE `nv4_vi_personnel_timekeeper` (
  `id` int(11) NOT NULL,
  `parentid` int(11) NOT NULL DEFAULT 0,
  `userid` int(11) NOT NULL DEFAULT 0,
  `locationid` int(11) NOT NULL DEFAULT 0,
  `date_login` int(11) NOT NULL DEFAULT 0,
  `time_login` varchar(250) NOT NULL DEFAULT '',
  `type_login` tinyint(4) NOT NULL DEFAULT 0,
  `image_file` varchar(250) NOT NULL DEFAULT '',
  `image_data` longblob NOT NULL,
  `note` text NOT NULL DEFAULT '',
  `lat` varchar(250) NOT NULL DEFAULT '0',
  `lng` varchar(250) NOT NULL DEFAULT '0',
  `distance` varchar(250) NOT NULL DEFAULT '',
  `address` varchar(250) NOT NULL DEFAULT '',
  `ip` varchar(250) NOT NULL DEFAULT '',
  `browse` varchar(250) NOT NULL DEFAULT '',
  `edit_time` int(11) NOT NULL DEFAULT 0,
  `adminid` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nv4_vi_personnel_timekeeper`
--

--
-- Indexes for dumped tables
--

--
-- Indexes for table `nv4_vi_personnel_allowances`
--
ALTER TABLE `nv4_vi_personnel_allowances`
  ADD PRIMARY KEY (`allowances_id`);

--
-- Indexes for table `nv4_vi_personnel_data`
--
ALTER TABLE `nv4_vi_personnel_data`
  ADD PRIMARY KEY (`data_id`),
  ADD UNIQUE KEY `title_group` (`title`,`group_name`);

--
-- Indexes for table `nv4_vi_personnel_degrees`
--
ALTER TABLE `nv4_vi_personnel_degrees`
  ADD PRIMARY KEY (`degrees_id`);

--
-- Indexes for table `nv4_vi_personnel_experience`
--
ALTER TABLE `nv4_vi_personnel_experience`
  ADD PRIMARY KEY (`experience_id`);

--
-- Indexes for table `nv4_vi_personnel_family`
--
ALTER TABLE `nv4_vi_personnel_family`
  ADD PRIMARY KEY (`family_id`);

--
-- Indexes for table `nv4_vi_personnel_history_insurances`
--
ALTER TABLE `nv4_vi_personnel_history_insurances`
  ADD PRIMARY KEY (`history_insurances_id`);

--
-- Indexes for table `nv4_vi_personnel_history_solves`
--
ALTER TABLE `nv4_vi_personnel_history_solves`
  ADD PRIMARY KEY (`history_solves_id`);

--
-- Indexes for table `nv4_vi_personnel_personnel`
--
ALTER TABLE `nv4_vi_personnel_personnel`
  ADD PRIMARY KEY (`personnel_id`) USING BTREE,
  ADD UNIQUE KEY `userid` (`userid`),
  ADD KEY `userid_create` (`userid_create`),
  ADD KEY `group_id` (`department_id`),
  ADD KEY `date_added` (`date_added`),
  ADD KEY `date_modified` (`date_modified`);

--
-- Indexes for table `nv4_vi_personnel_premium`
--
ALTER TABLE `nv4_vi_personnel_premium`
  ADD PRIMARY KEY (`premium_id`),
  ADD UNIQUE KEY `alias` (`alias`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Indexes for table `nv4_vi_personnel_registermedical`
--
ALTER TABLE `nv4_vi_personnel_registermedical`
  ADD PRIMARY KEY (`registermedical_id`),
  ADD UNIQUE KEY `title` (`title`);

--
-- Indexes for table `nv4_vi_personnel_setting`
--
ALTER TABLE `nv4_vi_personnel_setting`
  ADD UNIQUE KEY `config_name` (`config_name`);

--
-- Indexes for table `nv4_vi_personnel_timekeeper`
--
ALTER TABLE `nv4_vi_personnel_timekeeper`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `nv4_vi_personnel_allowances`
--
ALTER TABLE `nv4_vi_personnel_allowances`
  MODIFY `allowances_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nv4_vi_personnel_data`
--
ALTER TABLE `nv4_vi_personnel_data`
  MODIFY `data_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT for table `nv4_vi_personnel_degrees`
--
ALTER TABLE `nv4_vi_personnel_degrees`
  MODIFY `degrees_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `nv4_vi_personnel_experience`
--
ALTER TABLE `nv4_vi_personnel_experience`
  MODIFY `experience_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `nv4_vi_personnel_family`
--
ALTER TABLE `nv4_vi_personnel_family`
  MODIFY `family_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `nv4_vi_personnel_history_insurances`
--
ALTER TABLE `nv4_vi_personnel_history_insurances`
  MODIFY `history_insurances_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `nv4_vi_personnel_history_solves`
--
ALTER TABLE `nv4_vi_personnel_history_solves`
  MODIFY `history_solves_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `nv4_vi_personnel_personnel`
--
ALTER TABLE `nv4_vi_personnel_personnel`
  MODIFY `personnel_id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `nv4_vi_personnel_premium`
--
ALTER TABLE `nv4_vi_personnel_premium`
  MODIFY `premium_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nv4_vi_personnel_registermedical`
--
ALTER TABLE `nv4_vi_personnel_registermedical`
  MODIFY `registermedical_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nv4_vi_personnel_timekeeper`
--
ALTER TABLE `nv4_vi_personnel_timekeeper`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
