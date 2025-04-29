-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 27, 2025 lúc 09:43 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `thoitrangnam`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `feedback`
--

CREATE TABLE `feedback` (
  `id_feedback` int(11) NOT NULL,
  `tennguoidung` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `dienthoai` varchar(15) NOT NULL,
  `diachi` varchar(150) NOT NULL,
  `chude` mediumtext NOT NULL,
  `noidung` longtext NOT NULL,
  `time_lh` datetime DEFAULT NULL,
  `status_lh` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `feedback`
--

INSERT INTO `feedback` (`id_feedback`, `tennguoidung`, `email`, `dienthoai`, `diachi`, `chude`, `noidung`, `time_lh`, `status_lh`) VALUES
(38, 'Nguyễn Văn Duy', 'nvduy21@pdu.edu.vn', '0365790190', 'Hành Phước', 'Chất lượng ', 'Đồ đẹp', '2025-04-27 09:41:55', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_baiviet`
--

CREATE TABLE `tbl_baiviet` (
  `id` int(11) NOT NULL,
  `tenbaiviet` varchar(255) NOT NULL,
  `tomtat` mediumtext NOT NULL,
  `noidung` longtext NOT NULL,
  `id_danhmuc` int(11) NOT NULL,
  `tinhtrang` int(11) NOT NULL,
  `hinhanh` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_baiviet`
--

INSERT INTO `tbl_baiviet` (`id`, `tenbaiviet`, `tomtat`, `noidung`, `id_danhmuc`, `tinhtrang`, `hinhanh`) VALUES
(9, 'Khám Phá THDH Store: Thương Hiệu Thời Trang Nam Đẳng Cấp', '<strong>THDH Store</strong> là thương hiệu thời trang nam hàng đầu, nổi bật với <strong>sản phẩm chất lượng cao, thiết kế trẻ trung và phong cách hiện đại</strong>. Chúng tôi chuyên cung cấp <strong>áo thun, áo hoodie, áo khoác, quần jean, quần short và quần thể thao</strong>, cùng với các phụ kiện như <strong>đồng hồ và trang sức nam</strong>.', '<div class=\"article-con-item second-style\" style=\"margin: 0; padding: 0; color: #666; font-family: Muli, Arial, sans-serif; font-size: 14px;\">\r\n    <div class=\"article-con-item border-bottom\" style=\"margin: 0 0 60px; padding: 0;\">\r\n        <div class=\"item-t title-main\" style=\"margin: 0 0 20px; padding: 0; font-size: 20px; line-height: 1.5; font-weight: 700; color: #222;\">\r\n            <img src=\"https://boutiquestoredesign.com/wp-content/uploads/2018/09/mens-apparel-fashion-stores-interior-design-1-1334x834.jpg\" alt=\"Thời trang nam hiện đại\" style=\"width: 100%;\">\r\n        </div>\r\n        <div class=\"item-t title-main\" style=\"margin: 0 0 20px; padding: 0; font-size: 20px; line-height: 1.5; font-weight: 700; color: #222;\">\r\n            Về Chúng Tôi\r\n        </div>\r\n        <div class=\"item-p\" style=\"margin: 0; padding: 0;\">\r\n            <strong>THDH Store</strong> không chỉ là nơi mua sắm, mà còn là điểm đến cho những người đàn ông <strong>yêu thích sự đổi mới và phong cách</strong>. Chúng tôi cam kết mang đến những sản phẩm <strong>đẳng cấp và tinh tế</strong> với mức giá hợp lý, luôn cập nhật xu hướng mới nhất trong thời trang.\r\n        </div>\r\n    </div>\r\n</div>\r\n\r\n<div class=\"article-con-item second-style\" style=\"margin: 0; padding: 0; color: #666; font-family: Muli, Arial, sans-serif; font-size: 14px;\">\r\n    <div class=\"article-con-item border-bottom\" style=\"margin: 0 0 60px; padding: 0;\">\r\n        <div class=\"item-t title-main\" style=\"margin: 0 0 20px; padding: 0; font-size: 20px; line-height: 1.5; font-weight: 700; color: #222;\">\r\n            Sứ Mệnh Của Chúng Tôi\r\n        </div>\r\n        <div class=\"item-p\" style=\"margin: 0; padding: 0;\">\r\n            <strong>THDH Store</strong> cam kết mang đến trải nghiệm mua sắm <strong>đẳng cấp và tiện lợi</strong> với các tiêu chí:\r\n            <br><br>\r\n            ✅ <strong>Chất lượng cao</strong> – Từng sản phẩm được chọn lọc kỹ lưỡng, đảm bảo chất liệu bền bỉ và phù hợp với xu hướng thời trang.<br>\r\n            ✅ <strong>Thiết kế hiện đại</strong> – Phong cách trẻ trung, từ trang phục thể thao đến dạo phố và công sở.<br>\r\n            ✅ <strong>Giá cả hợp lý</strong> – Cung cấp sản phẩm chất lượng với mức giá tốt nhất.<br><br>\r\n            <strong>THDH Store</strong> không ngừng sáng tạo để mang đến <strong>giá trị và phong cách</strong> cho mỗi khách hàng!\r\n        </div>\r\n    </div>\r\n</div>\r\n\r\n<div class=\"article-con-item\" style=\"margin: 0 0 60px; padding: 0;\">\r\n    <div class=\"item-t title-main\" style=\"margin: 0 0 20px; padding: 0; font-size: 20px; line-height: 1.5; font-weight: 700; color: #222;\">\r\n        Tìm Thấy Chúng Tôi\r\n    </div>\r\n    <div class=\"item-p\" style=\"margin: 0; padding: 0;\">\r\n        <strong>THDH Store</strong> có mặt trên toàn quốc với dịch vụ <strong>giao hàng nhanh chóng và an toàn</strong>. Dù bạn ở <strong>Hà Nội, TP. Hồ Chí Minh hay bất kỳ tỉnh thành nào</strong>, chúng tôi luôn sẵn sàng phục vụ.\r\n        <br><br>\r\n        🚛 <strong>Giao hàng toàn quốc</strong> – Ship COD nhanh chóng, nhận hàng tại nhà.<br>\r\n        📦 <strong>Chính sách đổi trả linh hoạt</strong> – Hỗ trợ đổi size hoặc mẫu trong vòng 7 ngày.<br>\r\n        💬 <strong>Chăm sóc khách hàng 24/7</strong> – Sẵn sàng tư vấn mọi lúc, mọi nơi.\r\n    </div>\r\n    <div class=\"store-info\">\r\n        <span style=\"font-size: 16px; color: #666;\">Hệ thống cửa hàng THDH Store</span>\r\n    </div>\r\n</div>', 20, 1, '1639060166_logos.png');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `id_cart` int(11) NOT NULL,
  `id_khachhang` int(11) NOT NULL,
  `code_cart` varchar(10) NOT NULL,
  `cart_status` int(11) NOT NULL,
  `updata_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_cart`
--

INSERT INTO `tbl_cart` (`id_cart`, `id_khachhang`, `code_cart`, `cart_status`, `updata_time`) VALUES
(163, 111, '5976', 0, '2025-02-18 13:27:27'),
(164, 111, '9905', 0, '2025-02-18 13:27:55'),
(165, 111, '7906', 0, '2025-02-18 21:12:08'),
(166, 111, '9271', 1, '2025-02-18 21:12:36'),
(167, 111, '653', 1, '2025-02-18 21:18:06'),
(168, 111, '4672', 1, '2025-02-18 22:10:23'),
(169, 111, '1649', 1, '2025-02-18 22:17:24'),
(170, 111, '8510', 1, '2025-03-03 19:06:10'),
(171, 111, '5766', 1, '2025-03-03 19:15:35'),
(172, 111, '1844', 1, '2025-03-03 19:15:39'),
(173, 111, '8616', 1, '2025-03-03 22:40:34'),
(174, 111, '1794', 1, '2025-03-03 22:42:52'),
(175, 111, '3154', 1, '2025-03-03 22:43:09'),
(176, 111, '6667', 1, '2025-03-03 22:46:07'),
(177, 111, '5627', 1, '2025-03-04 09:04:24'),
(178, 111, '3609', 1, '2025-03-04 09:11:09'),
(179, 111, '1476', 0, '2025-03-04 09:11:36'),
(180, 111, '5513', 1, '2025-03-04 09:13:51'),
(181, 111, '7907', 1, '2025-03-04 09:13:55'),
(182, 111, '6764', 1, '2025-03-04 09:13:59'),
(183, 111, '4223', 1, '2025-03-04 09:14:03'),
(184, 111, '4020', 1, '2025-03-04 09:18:35'),
(185, 111, '9929', 1, '2025-03-04 09:21:01'),
(186, 111, '4540', 1, '2025-03-04 09:24:52'),
(187, 111, '9818', 0, '2025-03-04 09:25:19'),
(188, 111, '8940', 0, '2025-03-04 09:28:33'),
(189, 111, '2488', 0, '2025-03-04 09:31:31'),
(190, 111, '4560', 0, '2025-03-04 09:33:17'),
(191, 111, '2363', 0, '2025-03-04 09:42:33'),
(192, 111, '9778', 1, '2025-03-04 15:35:24'),
(193, 111, '3366', 1, '2025-03-04 16:38:22'),
(194, 111, '8862', 1, '2025-03-04 18:38:31'),
(195, 111, '4568', 1, '2025-03-04 18:43:32'),
(196, 111, '8222', 1, '2025-03-04 20:35:29'),
(197, 111, '7467', 1, '2025-03-04 20:57:52'),
(198, 111, '7451', 1, '2025-03-04 21:03:34'),
(199, 111, '7049', 1, '2025-03-04 21:33:44'),
(200, 111, '1541', 1, '2025-03-04 22:01:04'),
(201, 111, '1133', 1, '2025-03-04 22:25:26'),
(202, 111, '5593', 1, '2025-03-04 22:29:00'),
(203, 111, '7787', 1, '2025-03-04 22:30:33'),
(204, 111, '8133', 1, '2025-03-04 22:32:55'),
(205, 111, '2503', 1, '2025-03-04 22:34:18'),
(206, 111, '7017', 1, '2025-03-05 16:27:23'),
(207, 111, '2799', 1, '2025-03-05 16:40:31'),
(208, 111, '9372', 1, '2025-03-05 16:40:46'),
(209, 111, '2170', 1, '2025-04-03 08:08:16'),
(210, 111, '7703', 1, '2025-04-03 08:08:45'),
(211, 111, '7840', 0, '2025-04-03 15:14:54'),
(212, 111, '4773', 0, '2025-04-21 11:17:14'),
(213, 111, '6084', 1, '2025-04-21 11:18:05'),
(214, 111, '4256', 1, '2025-04-21 11:18:31'),
(215, 111, '7285', 1, '2025-04-21 11:49:13'),
(216, 111, '8187', 1, '2025-04-21 12:13:43'),
(217, 111, '3257', 1, '2025-04-21 12:16:37'),
(218, 111, '3928', 1, '2025-04-21 12:46:41'),
(219, 111, '3750', 1, '2025-04-21 12:49:55'),
(220, 111, '5870', 1, '2025-04-21 12:54:09'),
(221, 111, '9244', 1, '2025-04-21 12:58:51'),
(222, 111, '4322', 1, '2025-04-21 20:43:50'),
(223, 111, '5020', 1, '2025-04-23 07:25:49'),
(224, 111, '3093', 1, '2025-04-23 08:51:37'),
(225, 111, '9275', 0, '2025-04-23 09:20:53'),
(226, 111, '5738', 0, '2025-04-23 09:21:16'),
(227, 118, '4397', 0, '2025-04-23 21:39:44'),
(228, 118, '7331', 0, '2025-04-23 21:41:24'),
(229, 111, '9884', 1, '2025-04-23 21:42:54'),
(230, 111, '7553', 1, '2025-04-23 21:49:38'),
(231, 111, '3207', 1, '2025-04-23 21:51:15'),
(232, 111, '5215', 1, '2025-04-23 21:52:57'),
(233, 118, '4280', 1, '2025-04-23 21:53:27'),
(234, 118, '2855', 1, '2025-04-23 22:03:48'),
(235, 118, '5749', 1, '2025-04-23 22:04:30'),
(236, 118, '2906', 1, '2025-04-23 22:10:12'),
(237, 118, '3080', 1, '2025-04-23 22:13:45'),
(238, 118, '6684', 1, '2025-04-23 22:20:19'),
(239, 118, '1838', 1, '2025-04-23 22:22:55'),
(240, 118, '2365', 1, '2025-04-23 22:23:42'),
(241, 118, '9534', 1, '2025-04-23 22:26:10'),
(242, 111, '1422', 1, '2025-04-23 22:27:54'),
(243, 111, '7044', 1, '2025-04-23 22:28:37'),
(244, 111, '9900', 1, '2025-04-24 11:11:31'),
(245, 111, '2777', 1, '2025-04-24 11:29:31'),
(246, 111, '9578', 1, '2025-04-24 11:38:20'),
(247, 111, '7337', 1, '2025-04-24 11:41:15'),
(248, 111, '8264', 1, '2025-04-24 11:42:03'),
(258, 111, '3535', 1, '2025-04-24 12:26:46'),
(259, 111, '4735', 1, '2025-04-24 12:54:48'),
(260, 111, '3538', 1, '2025-04-25 22:23:18'),
(261, 111, '6772', 1, '2025-04-26 14:36:45'),
(262, 111, '1705', 1, '2025-04-26 14:38:19'),
(263, 111, '4181', 1, '2025-04-26 14:42:38'),
(264, 111, '8736', 1, '2025-04-26 14:45:46'),
(265, 111, '6487', 0, '2025-04-26 14:52:25'),
(266, 111, '1761', 1, '2025-04-26 14:54:57'),
(267, 111, '2393', 0, '2025-04-26 15:26:41'),
(268, 111, '7465', 1, '2025-04-26 22:26:34'),
(269, 111, '7872', 1, '2025-04-26 22:32:52');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_cart_details`
--

CREATE TABLE `tbl_cart_details` (
  `id_cart_details` int(11) NOT NULL,
  `code_cart` varchar(10) NOT NULL,
  `id_sanpham` int(11) NOT NULL,
  `soluongmua` int(11) NOT NULL,
  `size_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_cart_details`
--

INSERT INTO `tbl_cart_details` (`id_cart_details`, `code_cart`, `id_sanpham`, `soluongmua`, `size_id`) VALUES
(292, '469', 103, 1, 5),
(293, '4227', 104, 1, 2),
(294, '347', 97, 1, 4),
(295, '1506', 66, 2, 1),
(296, '1679', 104, 1, 1),
(337, '7999', 69, 1, 3),
(357, '336', 94, 3, 3),
(358, '7828', 69, 1, 4),
(359, '6030', 103, 1, 6),
(360, '4188', 111, 1, 2),
(361, '6398', 105, 1, 1),
(362, '4642', 110, 1, 1),
(363, '170', 108, 1, 1),
(364, '4664', 108, 1, 1),
(365, '58', 94, 1, 2),
(366, '5424', 112, 1, 1),
(367, '1680', 105, 1, 6),
(368, '4386', 111, 1, 6),
(369, '9829', 110, 1, 6),
(370, '5427', 111, 1, 6),
(371, '2017', 111, 1, 6),
(372, '7448', 111, 1, 6),
(373, '1998', 111, 1, 6),
(374, '5653', 111, 1, 6),
(375, '9385', 111, 1, 6),
(376, '3747', 108, 1, 1),
(377, '603', 112, 1, 6),
(378, '3981', 112, 1, 6),
(379, '2496', 112, 2, 6),
(380, '2784', 105, 1, 6),
(381, '7684', 109, 1, 6),
(382, '8631', 108, 1, 6),
(383, '7787', 110, 2, 6),
(384, '2973', 107, 1, 4),
(385, '8341', 111, 1, 1),
(386, '2506', 111, 1, 2),
(387, '6714', 108, 1, 2),
(388, '1270', 105, 2, 4),
(389, '5016', 103, 1, 6),
(390, '8327', 94, 3, 2),
(391, '8259', 107, 1, 1),
(392, '2012', 91, 1, 1),
(393, '6478', 112, 1, 1),
(394, '4067', 111, 1, 1),
(395, '5420', 111, 1, 1),
(396, '2934', 111, 1, 2),
(397, '3633', 110, 1, 4),
(398, '5365', 111, 1, 1),
(399, '1331', 105, 1, 1),
(401, '7939', 102, 1, 1),
(408, '5834', 111, 1, 3),
(417, '5758', 110, 1, 4),
(422, '5976', 106, 2, 2),
(423, '9905', 105, 1, 4),
(424, '7906', 110, 1, 3),
(425, '9271', 110, 1, 3),
(426, '653', 110, 1, 2),
(427, '4672', 111, 1, 2),
(428, '1649', 94, 1, 2),
(429, '8510', 111, 1, 2),
(430, '5766', 108, 1, 4),
(431, '8616', 111, 2, 2),
(432, '3154', 102, 1, 2),
(433, '6667', 111, 1, 3),
(434, '5627', 97, 1, 2),
(435, '3609', 110, 1, 3),
(436, '1476', 110, 1, 3),
(437, '5513', 107, 4, 1),
(438, '4020', 110, 1, 4),
(439, '9929', 111, 1, 4),
(440, '4540', 111, 1, 4),
(441, '9818', 110, 1, 4),
(442, '8940', 97, 1, 4),
(443, '2488', 111, 1, 2),
(444, '4560', 110, 1, 3),
(445, '2363', 111, 1, 3),
(446, '9778', 111, 1, 3),
(447, '3366', 111, 1, 2),
(448, '8862', 111, 1, 2),
(449, '8862', 105, 1, 2),
(450, '4568', 111, 1, 3),
(451, '8222', 111, 1, 2),
(452, '7467', 110, 2, 2),
(453, '7451', 110, 1, 5),
(454, '7049', 106, 1, 4),
(455, '1541', 91, 1, 3),
(456, '1133', 110, 1, 4),
(457, '5593', 101, 1, 3),
(458, '7787', 101, 1, 3),
(459, '8133', 101, 1, 2),
(460, '2503', 101, 1, 6),
(461, '2503', 69, 1, 6),
(462, '7017', 105, 1, 1),
(463, '7017', 111, 1, 1),
(464, '2799', 107, 1, 5),
(465, '9372', 109, 1, 4),
(466, '2170', 110, 2, 3),
(467, '7703', 109, 1, 5),
(468, '7840', 110, 1, 4),
(469, '4773', 110, 2, 0),
(470, '6084', 110, 1, 0),
(471, '4256', 111, 2, 0),
(472, '7285', 111, 1, 0),
(473, '8187', 110, 1, 0),
(474, '3257', 110, 1, 3),
(475, '3928', 105, 2, 5),
(476, '3750', 110, 1, 3),
(477, '5870', 110, 1, 5),
(478, '9244', 111, 1, 3),
(479, '4322', 111, 1, 4),
(480, '5020', 91, 1, 5),
(481, '3093', 111, 1, 3),
(482, '9275', 105, 1, 0),
(483, '5738', 109, 1, 6),
(484, '4397', 110, 1, 0),
(485, '7331', 110, 1, 0),
(486, '9884', 75, 1, 0),
(487, '7553', 111, 2, 0),
(488, '3207', 108, 1, 0),
(489, '5215', 110, 1, 0),
(490, '4280', 107, 1, 0),
(491, '2855', 94, 1, 0),
(492, '5749', 94, 1, 0),
(493, '2906', 94, 1, 0),
(494, '3080', 94, 1, 0),
(495, '6684', 111, 1, 0),
(496, '1838', 111, 1, 0),
(497, '2365', 111, 1, 0),
(498, '9534', 109, 1, 0),
(499, '1422', 104, 1, 0),
(500, '7044', 102, 1, 0),
(501, '9900', 107, 1, 0),
(502, '2777', 111, 1, 2),
(503, '9578', 102, 1, 4),
(504, '7337', 106, 1, 6),
(505, '8264', 111, 1, 5),
(506, '3535', 109, 1, 3),
(507, '3535', 110, 2, 2),
(508, '4735', 94, 1, 3),
(509, '3538', 110, 1, 4),
(510, '6772', 91, 1, 1),
(511, '1705', 103, 1, 2),
(512, '4181', 92, 1, 5),
(513, '8736', 109, 1, 3),
(514, '6487', 104, 1, 3),
(515, '1761', 73, 1, 3),
(516, '2393', 111, 1, 2),
(517, '7465', 110, 1, 3),
(518, '7872', 100, 1, 3),
(519, '7872', 106, 1, 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_dangky`
--

CREATE TABLE `tbl_dangky` (
  `id_dangky` int(11) NOT NULL,
  `tenkhachhang` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `diachi` varchar(100) NOT NULL,
  `matkhau` varchar(100) NOT NULL,
  `dienthoai` varchar(20) NOT NULL,
  `role_id` int(11) NOT NULL,
  `trangthai` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_dangky`
--

INSERT INTO `tbl_dangky` (`id_dangky`, `tenkhachhang`, `email`, `diachi`, `matkhau`, `dienthoai`, `role_id`, `trangthai`) VALUES
(120, 'Nguyễn Văn Duy', 'nvduy21@pdu.edu.vn', 'Hành Phước', 'e10adc3949ba59abbe56e057f20f883e', '0365790190', 1, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_danhmuc`
--

CREATE TABLE `tbl_danhmuc` (
  `id_danhmuc` int(11) NOT NULL,
  `tendanhmuc` varchar(100) NOT NULL,
  `thutu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_danhmuc`
--

INSERT INTO `tbl_danhmuc` (`id_danhmuc`, `tendanhmuc`, `thutu`) VALUES
(39, 'Nhẫn & dây chuyền', 1),
(40, 'Đồng hồ', 2),
(41, 'Quần thể thao', 3),
(42, 'Quần short', 4),
(43, 'Quần  jean & kaki', 5),
(44, 'Áo khoác', 6),
(45, 'Áo hoodie & áo len', 7),
(46, 'Áo thun', 8);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_danhmucbaiviet`
--

CREATE TABLE `tbl_danhmucbaiviet` (
  `id_baiviet` int(11) NOT NULL,
  `tendanhmuc_baiviet` varchar(255) NOT NULL,
  `thutu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_danhmucbaiviet`
--

INSERT INTO `tbl_danhmucbaiviet` (`id_baiviet`, `tendanhmuc_baiviet`, `thutu`) VALUES
(20, 'Thông tin của THDH Store', 4);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_giohang`
--

CREATE TABLE `tbl_giohang` (
  `id_giohang` int(11) NOT NULL,
  `id_khachhang` int(11) NOT NULL,
  `code_cart` varchar(10) NOT NULL,
  `cart_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_giohang`
--

INSERT INTO `tbl_giohang` (`id_giohang`, `id_khachhang`, `code_cart`, `cart_status`) VALUES
(19, 1, '754', 0),
(20, 1, '9283', 0),
(23, 1, '662', 0),
(26, 1, '2480', 0),
(29, 1, '3933', 0),
(30, 1, '6072', 1),
(31, 1, '1895', 1),
(32, 1, '3575', 1),
(33, 1, '7409', 1),
(34, 1, '7530', 1),
(35, 1, '8543', 1),
(36, 1, '978', 1),
(37, 1, '295', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_role`
--

CREATE TABLE `tbl_role` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `id_role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_role`
--

INSERT INTO `tbl_role` (`id`, `name`, `id_role`) VALUES
(1, 'Quản Lý', 2),
(2, 'Nhân viên', 3),
(5, 'Khách hàng', 4);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_sanpham`
--

CREATE TABLE `tbl_sanpham` (
  `id_sanpham` int(11) NOT NULL,
  `tensanpham` varchar(250) NOT NULL,
  `masp` varchar(100) NOT NULL,
  `gianhap` int(20) NOT NULL,
  `giasp` int(50) NOT NULL,
  `giamgia` int(11) NOT NULL,
  `soluong` int(11) NOT NULL,
  `size` varchar(11) NOT NULL,
  `hinhanh` varchar(50) NOT NULL,
  `tomtat` tinytext NOT NULL,
  `noidung` text NOT NULL,
  `tinhtrang` int(11) NOT NULL,
  `id_danhmuc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_sanpham`
--

INSERT INTO `tbl_sanpham` (`id_sanpham`, `tensanpham`, `masp`, `gianhap`, `giasp`, `giamgia`, `soluong`, `size`, `hinhanh`, `tomtat`, `noidung`, `tinhtrang`, `id_danhmuc`) VALUES
(66, 'Áo khoác phao', '004', 200000, 400000, 370000, 2, 'XL', '1739867564_ao-khoac-phao-nam-den-cao-cap.jpg', '', '<p style=\"background-color: rgb(245, 245, 245);\">Với chất liệu bên ngoài trơn trống thấm nước có thể đi ngoài trời mưa.</p><p style=\"background-color: rgb(245, 245, 245);\">Bên trong có lớp lông giữu nhiệt phù hợp cho các bạn đi xe.</p>', 0, 44),
(69, 'Áo giữ nhiệt', '004', 200000, 400000, 359000, 29, 'XL ', '1700820480_images (1).jpg', '', '<p>Chất liệu vải mềm mặc dễ chịu.</p><p>Thoáng khí cử động dễ dàng.</p><p>Với màu xanh nhám càng làm thêm sự ấm áp.</p><p>Thích hợp mặc vào màu đông.</p>', 0, 45),
(73, 'Nhẫn', '146', 50000, 150000, 120000, 4, 'X', '1639446096_nhan1.jpg', '', '<p>nhẹ nhàng phù hợp với giới trẻ để trang trí khi đi chơi.</p>', 0, 39),
(75, 'Nhẫn', '0147', 50000, 200000, 165000, 5, 'M ', '1639446107_nhan2.jpg', '', '<p>Nhẫn làm bằng bạc chi tiết tỉ mỉ với những hoa văn, ngoài ra có gắn những viên đá làm lấp lánh cho nhẫn.</p><p>Làm đồ trăng sức nổi bật.</p>', 0, 39),
(87, 'Áo phông nam', '26as', 100000, 350000, 300000, 30, 'L', '1700311142_aophong.jpg', '', '<p>Áo màu trắng đơn giản nhưng vẫn rất lịch sự.</p><p>Rất dễ phối đồ đi chơi hay đi học cho các bạn sinh viên.</p>', 0, 46),
(88, 'Áo Thun 2021', 'AZX', 50000, 150000, 100000, 15, 'X', '1640003199_aothun2.png', '', '<p>Áo kết hợp xọc kẻ làm cho đỡ sự nhàm chán của màu trắng.</p><p>Phù hợp với đi chơi hay đi làm.</p>', 0, 46),
(89, 'Áo màu loang xám', 'acc', 50000, 150000, 100000, 10, 'X', '1700895389_thunloang.jpg', '', '<p style=\"background-color: rgb(245, 245, 245);\">Áo màu trắng đơn giản nhưng vẫn rất lịch sự.</p><p style=\"background-color: rgb(245, 245, 245);\">Rất dễ phối đồ đi chơi hay đi học cho các bạn sinh viên.</p>', 0, 46),
(90, 'Áo hoodie', 'ACG', 200000, 350000, 299000, 6, 'XL ', '1700820305_hoodie.jpg', '', '<p>Áo có chất liệu mịn màng ấm áp.</p><p>Với những đường may chi tiết tỉ mỉ.</p><p>Kết hợp có mũ để giữ ấm.</p>', 0, 45),
(91, 'Áo hoodie', 'MLJ', 300000, 460000, 390000, 3, 'L', '1701533411_ao-hoodie-ni-ngoai-hien-dai.jpg', '', '<p style=\"background-color: rgb(245, 245, 245);\">Áo có chất liệu mịn màng ấm áp.</p><p style=\"background-color: rgb(245, 245, 245);\">Với những đường may chi tiết tỉ mỉ.</p><p style=\"background-color: rgb(245, 245, 245);\">Kết hợp có mũ để giữ ấm.</p>', 0, 45),
(92, 'Áo len', 'ACU', 200000, 400000, 399000, 8, 'XL ', '1701533267_aolen1.jpg', '', '<p style=\"background-color: rgb(245, 245, 245);\">Áo có chất liệu mịn màng ấm áp.</p><p style=\"background-color: rgb(245, 245, 245);\">Với những đường may chi tiết tỉ mỉ.</p><p style=\"background-color: rgb(245, 245, 245);\"><br></p>', 0, 45),
(93, 'Áo khoác', 'ACV', 300000, 499000, 450000, 6, 'M ', '1700310862_aokhoac.jpg', '', '<p style=\"background-color: rgb(245, 245, 245);\">Với chất liệu bên ngoài trơn trống thấm nước có thể đi ngoài trời mưa.</p><p style=\"background-color: rgb(245, 245, 245);\">Bên trong có lớp lông giữu nhiệt phù hợp cho các bạn đi xe.</p>', 0, 44),
(94, 'Quần jean xanh dài', 'Alh', 200000, 350000, 299000, 1, 'XL ', '1700310882_jeanxanh.jpg', '', '<p>Chiếc quần làm bằng vải mịn dễ chịu cho người sử dụng.</p><p>Với những chi tiết đơn giản nhưng vẫn làm lên sự lịch lẵm.</p><p>Chi tiết may rất gọn gàng tỉ mỉ.</p>', 0, 43),
(95, 'Quần jean đen', 'QAC', 100000, 299000, 180000, 12, 'M ', '1700310910_jeanden.jpg', '', '<p>Chiếc quần làm bằng vải mịn dễ chịu cho người sử dụng.</p><p>Với những chi tiết đơn giản nhưng vẫn làm lên sự lịch lẵm.</p><p>Chi tiết may rất gọn gàng tỉ mỉ.</p>', 0, 43),
(96, 'Quần short', 'SPI', 100000, 200000, 199000, 20, 'XXL', '1701533576_quan-short-nam-qs52-mau_1.jpg', '', '<p>Quần mặc dễ chịu, rất dễ thoải mái cho thể thao.</p><p>Với chất liệu co giãn không lo đến chất lượng của sản phẩm.</p><p>Với những đường may chi tiết tỉ mỉ giúp cho sản phẩm đẹp hơn.</p>', 0, 41),
(97, 'Quần thể thao', 'PLJ', 100000, 290000, 180000, 28, 'L', '1639446323_1.jpg', '', '<p>Quần mặc dễ chịu, rất dễ thoải mái cho thể thao.</p><p>Với chất liệu co giãn không lo đến chất lượng của sản phẩm.</p><p>Với những đường may chi tiết tỉ mỉ giúp cho sản phẩm đẹp hơn.</p>', 0, 41),
(99, 'Quần short', 'Pjo', 500000, 800000, 790000, 10, 'XXL', '1701533718_quan-short-nam.jpg', '', '<p>Quần mặc thoải mái dễ chịu, dễ hoạt động.</p><p>Phối đồ dễ dàng với các loại áo phông.</p><p>Với những đưởng máy gọn gàng làm cho sản phẩm trở lên bắt mắt.</p>', 0, 42),
(100, 'áo khoác nam', '001', 200000, 400000, 350000, 29, 'L', '1639460938_4.jpg', '', '', 0, 44),
(101, 'Đồng hồ ACCI', '4', 1500000, 2800000, 2600000, -2, 'freesize', '1639586270_đồng4.png', '', '', 0, 40),
(102, 'Vòng nam cao cấp', '1500000', 150000, 400000, 300000, 27, 'free size', '1639754740_dây1.png', '', '', 0, 39),
(103, 'Đồng hồ seess cao cấp', 'MT', 1500000, 4000000, 3000000, 29, 'freesize', '1639830869_đồng11.png', '', '<p><img src=\"data:image/jpeg;base64,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\" style=\"width: 225px;\"><br></p>', 0, 40),
(104, 'Đồng hồ', '004', 800000, 1500000, 1200000, 28, 'freesize', '1640436014_đồng7.png', '', '', 0, 40),
(105, 'Áo khoác da ', '002', 300000, 800000, 729000, 9, 'M L XL XXL', '1640488210_khoác18.png', '', '', 0, 44),
(106, 'Quần nike', '002', 100000, 250000, 200000, 25, 'M L XL XXL', '1640488281_3.png', '', '', 0, 41),
(107, 'Áo thun xám ', '001', 100000, 250000, 200000, 23, 'M L XL XXL', '1700820089_ao-thun.jpg', '', '', 0, 46),
(108, 'Ao polo nam', '002', 100000, 250000, 200000, 13, 'M L XL XXL', '1700310773_aopolo.jpg', '', '', 0, 46),
(109, 'Quần short adidas', '002', 200000, 400000, 359000, 24, 'M L XL XXL', '1700310746_adidas.jpg', '', '', 0, 42),
(110, 'Quần kaki', '004', 100000, 250000, 200000, 0, 'M L XL XXL', '1701533858_kaki.jpg', '', '', 0, 43),
(111, 'Đồng hồ LV', '005', 1500000, 4000000, 2000000, 85, 'freesize', '1640570777_đồng9.png', '', '                                                                                                                        ', 0, 40);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_size`
--

CREATE TABLE `tbl_size` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `size_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_size`
--

INSERT INTO `tbl_size` (`id`, `name`, `size_id`) VALUES
(1, 'S', 1),
(2, 'M', 2),
(3, 'L', 3),
(4, 'XL', 4),
(5, 'XXL', 5),
(6, 'Freesize', 6);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_thongke`
--

CREATE TABLE `tbl_thongke` (
  `id` int(11) NOT NULL,
  `ngaydat` varchar(30) NOT NULL,
  `donhang` int(11) NOT NULL,
  `doanhthu` varchar(100) NOT NULL,
  `gianhap` varchar(110) NOT NULL,
  `soluongban` int(11) NOT NULL,
  `loinhuan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id_feedback`);

--
-- Chỉ mục cho bảng `tbl_baiviet`
--
ALTER TABLE `tbl_baiviet`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`id_cart`),
  ADD UNIQUE KEY `code_cart` (`code_cart`),
  ADD UNIQUE KEY `code_cart_2` (`code_cart`),
  ADD UNIQUE KEY `code_cart_3` (`code_cart`),
  ADD KEY `fk_cart_khachhang` (`id_khachhang`);

--
-- Chỉ mục cho bảng `tbl_cart_details`
--
ALTER TABLE `tbl_cart_details`
  ADD PRIMARY KEY (`id_cart_details`);

--
-- Chỉ mục cho bảng `tbl_dangky`
--
ALTER TABLE `tbl_dangky`
  ADD PRIMARY KEY (`id_dangky`);

--
-- Chỉ mục cho bảng `tbl_danhmuc`
--
ALTER TABLE `tbl_danhmuc`
  ADD PRIMARY KEY (`id_danhmuc`);

--
-- Chỉ mục cho bảng `tbl_danhmucbaiviet`
--
ALTER TABLE `tbl_danhmucbaiviet`
  ADD PRIMARY KEY (`id_baiviet`);

--
-- Chỉ mục cho bảng `tbl_giohang`
--
ALTER TABLE `tbl_giohang`
  ADD PRIMARY KEY (`id_giohang`);

--
-- Chỉ mục cho bảng `tbl_role`
--
ALTER TABLE `tbl_role`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_sanpham`
--
ALTER TABLE `tbl_sanpham`
  ADD PRIMARY KEY (`id_sanpham`),
  ADD KEY `fk_sanpham_danhmuc` (`id_danhmuc`);

--
-- Chỉ mục cho bảng `tbl_size`
--
ALTER TABLE `tbl_size`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_thongke`
--
ALTER TABLE `tbl_thongke`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id_feedback` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT cho bảng `tbl_baiviet`
--
ALTER TABLE `tbl_baiviet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `id_cart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=270;

--
-- AUTO_INCREMENT cho bảng `tbl_cart_details`
--
ALTER TABLE `tbl_cart_details`
  MODIFY `id_cart_details` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=520;

--
-- AUTO_INCREMENT cho bảng `tbl_dangky`
--
ALTER TABLE `tbl_dangky`
  MODIFY `id_dangky` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT cho bảng `tbl_danhmuc`
--
ALTER TABLE `tbl_danhmuc`
  MODIFY `id_danhmuc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT cho bảng `tbl_danhmucbaiviet`
--
ALTER TABLE `tbl_danhmucbaiviet`
  MODIFY `id_baiviet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT cho bảng `tbl_giohang`
--
ALTER TABLE `tbl_giohang`
  MODIFY `id_giohang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT cho bảng `tbl_role`
--
ALTER TABLE `tbl_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `tbl_sanpham`
--
ALTER TABLE `tbl_sanpham`
  MODIFY `id_sanpham` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT cho bảng `tbl_size`
--
ALTER TABLE `tbl_size`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `tbl_thongke`
--
ALTER TABLE `tbl_thongke`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
