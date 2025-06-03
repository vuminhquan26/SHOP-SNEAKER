-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 03, 2025 lúc 09:01 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `ql_tranggiay`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ct_hoadon`
--

CREATE TABLE `ct_hoadon` (
  `MA_CT` int(11) NOT NULL,
  `MA_HD` int(11) NOT NULL,
  `MA_SP` int(11) NOT NULL,
  `SO_LUONG` int(11) NOT NULL,
  `SIZE_SP` varchar(10) DEFAULT NULL,
  `GIA` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `ct_hoadon`
--

INSERT INTO `ct_hoadon` (`MA_CT`, `MA_HD`, `MA_SP`, `SO_LUONG`, `SIZE_SP`, `GIA`) VALUES
(14, 29, 1, 10, '36', 30000000),
(15, 29, 3, 1, '37', 2500000),
(17, 34, 14, 2, '36', 4000000),
(19, 36, 1, 2, '37', 4000000),
(20, 36, 2, 1, '38', 1500000),
(21, 36, 2, 1, '39', 1500000),
(22, 36, 2, 1, '39', 1500000),
(23, 37, 1, 2, '37', 4000000),
(24, 37, 3, 1, '38', 2100000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ct_sp`
--

CREATE TABLE `ct_sp` (
  `MA_CT_SP` int(11) NOT NULL,
  `SO_LUONG` int(11) NOT NULL,
  `MA_MS` int(11) DEFAULT NULL,
  `MA_KC` int(11) DEFAULT NULL,
  `MA_SP` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `feedback`
--

CREATE TABLE `feedback` (
  `MA_FB` int(11) NOT NULL,
  `NOIDUNG` text NOT NULL,
  `MA_KH` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `feedback`
--

INSERT INTO `feedback` (`MA_FB`, `NOIDUNG`, `MA_KH`) VALUES
(1, 'aaaaaa', 14),
(3, 'aaaaa', 21),
(4, 'test', 22);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `giohang`
--

CREATE TABLE `giohang` (
  `MA_GIOHANG` int(11) NOT NULL,
  `MA_SP` int(11) NOT NULL,
  `MA_KH` int(11) NOT NULL,
  `SO_LUONG` int(11) NOT NULL,
  `ma_kc` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `giohang`
--

INSERT INTO `giohang` (`MA_GIOHANG`, `MA_SP`, `MA_KH`, `SO_LUONG`, `ma_kc`) VALUES
(41, 1, 22, 2, 37);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hoadon`
--

CREATE TABLE `hoadon` (
  `MA_HD` int(11) NOT NULL,
  `NGAY_HD` date NOT NULL,
  `TEN_NN` varchar(50) NOT NULL,
  `DIACHI_NN` varchar(100) NOT NULL,
  `TRANGTHAI` int(11) DEFAULT 1,
  `MA_KH` int(11) DEFAULT NULL,
  `MA_PTVC` int(11) DEFAULT NULL,
  `MA_PTTT` int(11) DEFAULT NULL,
  `SDT_KH` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `hoadon`
--

INSERT INTO `hoadon` (`MA_HD`, `NGAY_HD`, `TEN_NN`, `DIACHI_NN`, `TRANGTHAI`, `MA_KH`, `MA_PTVC`, `MA_PTTT`, `SDT_KH`) VALUES
(29, '2025-05-29', 'Vũ Minh Quân', 'Hai Bà Trưng,Hà Nộinh', 3, 13, 1, 1, '0123456789'),
(34, '2025-05-29', 'Vũ Minh Quân', 'Long Biên', 0, 21, 1, 1, '0395791231'),
(36, '2025-05-30', 'Vũ Minh Quân', 'Hà Nội', 0, 22, 1, 1, '0395791231'),
(37, '2025-05-30', 'quan123', 'Hà Nội', 0, 13, 2, 1, '0123456789');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khachhang`
--

CREATE TABLE `khachhang` (
  `MA_KH` int(11) NOT NULL,
  `TEN_KH` varchar(100) NOT NULL,
  `DIACHI_KH` varchar(100) DEFAULT NULL,
  `SDT_KH` varchar(12) DEFAULT NULL,
  `GIOITINH` tinyint(4) DEFAULT NULL,
  `NGAYSINH` date DEFAULT NULL,
  `EMAIL` varchar(50) DEFAULT NULL,
  `TICHDIEM` int(11) DEFAULT 0,
  `PASS_KH` varchar(350) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `khachhang`
--

INSERT INTO `khachhang` (`MA_KH`, `TEN_KH`, `DIACHI_KH`, `SDT_KH`, `GIOITINH`, `NGAYSINH`, `EMAIL`, `TICHDIEM`, `PASS_KH`) VALUES
(13, 'quan123', 'Long Biên', '0123456789', 1, '0000-00-00', 'test@gmail.com', 0, '$2y$10$WN9mPbSd66gyPuUz2Sg52eOpPdf1363ong8IrHtjUoYKqVaHHfFgS'),
(14, 'Nguyễn Minh Nhất', 'Long Biên', '0123456789', 0, '2006-02-10', 'daylatest@gmail.com', 0, '$2y$10$mkxup2K25U/7Vo.UZaNfi.kt2MgeTzm9XYxjQFtVsoPq65ZkoR9xS'),
(21, 'Vũ Minh Quân', 'Long Biên, Hà Nội', '0395791231', 0, '0200-02-10', 'vuminhquan200@gmail.com', 0, '$2y$10$K6SXdFhB3QCFU0MKoNbq/uW9qOMrFnzlpfTeWnLp1M2sqk6WdkQKG'),
(22, 'Vũ Minh Quân', NULL, '0395791231', NULL, NULL, 'vuminhquan2006@gmail.com', 0, '$2y$10$sqRNLQauRvIxZO761KUSa.Oxd44P1FhXgOlHXQ7MTTUwZIfJDWkhi');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `kichco`
--

CREATE TABLE `kichco` (
  `MA_KC` int(11) NOT NULL,
  `TEN_KC` varchar(50) NOT NULL,
  `TRANGTHAI` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `kichco`
--

INSERT INTO `kichco` (`MA_KC`, `TEN_KC`, `TRANGTHAI`) VALUES
(1, '36', 1),
(2, '37', 1),
(3, '38', 1),
(4, '39', 1),
(5, '40', 1),
(6, '41', 1),
(7, '42', 1),
(8, '43', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lienhe`
--

CREATE TABLE `lienhe` (
  `MA_LH` int(11) NOT NULL,
  `TEN_LH` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `lienhe`
--

INSERT INTO `lienhe` (`MA_LH`, `TEN_LH`) VALUES
(2, 'ig'),
(8, 'Facebook');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loaisanpham`
--

CREATE TABLE `loaisanpham` (
  `MAL_SP` int(11) NOT NULL,
  `TEN_LOAISP` varchar(30) NOT NULL,
  `TRANGTHAI` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `loaisanpham`
--

INSERT INTO `loaisanpham` (`MAL_SP`, `TEN_LOAISP`, `TRANGTHAI`) VALUES
(4, 'Giày Cổ Thấp', 1),
(6, 'Giày Cổ Trung', 1),
(10, 'Giày Cổ Cao', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `mausac`
--

CREATE TABLE `mausac` (
  `MA_MS` int(11) NOT NULL,
  `TEN_MS` varchar(50) NOT NULL,
  `TRANGTHAI` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `mausac`
--

INSERT INTO `mausac` (`MA_MS`, `TEN_MS`, `TRANGTHAI`) VALUES
(1, 'Vàng', 1),
(3, 'màu đỏ', 1),
(4, 'màu đỏ', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhanhieu`
--

CREATE TABLE `nhanhieu` (
  `LOGO` varchar(350) NOT NULL,
  `MANH_SP` int(11) NOT NULL,
  `TEN_NH` varchar(50) NOT NULL,
  `TRANGTHAI` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `nhanhieu`
--

INSERT INTO `nhanhieu` (`LOGO`, `MANH_SP`, `TEN_NH`, `TRANGTHAI`) VALUES
('image/logo/brand_logo/ADIDAS.PNG', 30, 'Adidas', 1),
('image/logo/brand_logo/CONVERSE.PNG', 31, 'Converse', 1),
('image/logo/brand_logo/MLB.PNG', 32, 'MLB', 1),
('image/logo/brand_logo/NIKE.PNG', 34, 'Nike', 1),
('image/logo/brand_logo/VANS.PNG', 36, 'Vans', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phuongthuc_tt`
--

CREATE TABLE `phuongthuc_tt` (
  `MA_PTTT` int(11) NOT NULL,
  `TEN_PTTT` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `phuongthuc_tt`
--

INSERT INTO `phuongthuc_tt` (`MA_PTTT`, `TEN_PTTT`) VALUES
(1, 'Thanh toán khi nhận hàng (COD)');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `pt_vanchuyen`
--

CREATE TABLE `pt_vanchuyen` (
  `MA_PTVC` int(11) NOT NULL,
  `TEN_PTVC` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `pt_vanchuyen`
--

INSERT INTO `pt_vanchuyen` (`MA_PTVC`, `TEN_PTVC`) VALUES
(1, 'Giao hàng tiêu chuẩn'),
(2, 'Giao hàng nhanh'),
(3, 'Giao hàng tiết kiệm'),
(4, 'Giao hàng quốc tế');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `quantri`
--

CREATE TABLE `quantri` (
  `TAIKHOAN` varchar(50) NOT NULL,
  `MATKHAU` varchar(350) NOT NULL,
  `TRANGTHAI` int(11) DEFAULT 1,
  `VAITRO` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `quantri`
--

INSERT INTO `quantri` (`TAIKHOAN`, `MATKHAU`, `TRANGTHAI`, `VAITRO`) VALUES
('admin2@gmail.com', '$2y$10$wJ6LSCGmiuIO4aZBJ3olU.Dtk/aNUVJULSCE14IzdmSDGpStdeLkC', 1, 1),
('admin3@gmail.com', '123456789', 1, 1),
('admin@gmail.com', '123', 1, 1),
('ql_don@gmail.com', '12345', 1, 3),
('ql_kho@gmail.com', '1234', 1, 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sanpham`
--

CREATE TABLE `sanpham` (
  `MA_SP` int(11) NOT NULL,
  `TEN_SP` varchar(100) NOT NULL,
  `THONGTIN_SP` text DEFAULT NULL,
  `GIA_NHAP` float NOT NULL,
  `GIA_CU` float DEFAULT NULL,
  `GIA_MOI` float NOT NULL,
  `LUOT_BAN` int(11) DEFAULT 0,
  `NGAY_CAPNHAT` date DEFAULT NULL,
  `MAL_SP` int(11) DEFAULT NULL,
  `MANH_SP` int(11) DEFAULT NULL,
  `ANH_GIOI_THIEU` varchar(255) DEFAULT NULL,
  `ANH_HOVER` varchar(255) DEFAULT NULL,
  `ANH_CHI_TIET_1` varchar(255) DEFAULT NULL,
  `ANH_CHI_TIET_2` varchar(255) DEFAULT NULL,
  `ANH_CHI_TIET_3` varchar(100) NOT NULL,
  `ANH_CHI_TIET_4` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `sanpham`
--

INSERT INTO `sanpham` (`MA_SP`, `TEN_SP`, `THONGTIN_SP`, `GIA_NHAP`, `GIA_CU`, `GIA_MOI`, `LUOT_BAN`, `NGAY_CAPNHAT`, `MAL_SP`, `MANH_SP`, `ANH_GIOI_THIEU`, `ANH_HOVER`, `ANH_CHI_TIET_1`, `ANH_CHI_TIET_2`, `ANH_CHI_TIET_3`, `ANH_CHI_TIET_4`) VALUES
(1, 'Adidas Superstar II', 'Adidas Superstar II là phiên bản cải tiến của dòng giày huyền thoại Adidas Superstar, nổi bật với thiết kế vỏ sò đặc trưng ở mũi giày (shell toe), phần thân bằng da bền chắc, ba sọc đặc trưng hai bên và đế cao su chống trượt. Kiểu dáng cổ thấp, phù hợp cả thời trang và thể thao, mang phong cách cổ điển nhưng vẫn hiện đại.', 9999, 1700000, 2000000, 0, '2025-05-29', 4, 30, 'image/product/Giay_Superstar_II_DJen-Photoroom.png', 'image/product/Giay_Superstar_II_DJen_JH7033_04-Photoroom.png', 'image/product/Giay_Superstar_II_DJen_JH7033_02-Photoroom.png', 'image/product/Giay_Superstar_II_DJen_JH7033_05-Photoroom.png', 'image/product/Giay_Superstar_II_DJen_JH7033_06-Photoroom.png', 'image/product/Giay_Superstar_II_DJen_JH7033_03-Photoroom.png'),
(2, 'Nike Air Force One', 'Nike Air Force 1 dây đi (tức là bản có dây buộc) là mẫu giày sneaker cổ điển nổi tiếng của Nike, ra mắt lần đầu năm 1982. Giày có thiết kế đơn giản, phần upper thường bằng da, đế giữa dày với công nghệ đệm Air êm ái, giúp tạo cảm giác thoải mái khi mang. Dây giày giúp cố định chân chắc chắn, phù hợp cả đi chơi lẫn hoạt động hằng ngày. Mẫu này rất được ưa chuộng vì phong cách dễ phối đồ và vẻ ngoài cá tính.', 1100000, 1300000, 1500000, 0, '2025-05-29', 4, 34, 'image/product/W+AIR+FORCE+1+Photoroom.png', 'image/product/W+AIR+FORCE+1_HV.png', 'image/product/W+AIR+FORCE+1_1-Photoroom.png', 'image/product/W+AIR+FORCE+1+-Photoroom.png', 'image/product/W+AIR+FORCE+1+_2-Photoroom.png', 'image/product/W+AIR+FORCE+1+3-Photoroom.png'),
(3, 'Converse Run Star Hike Canvas Platform ', 'Converse Run Star Hike Canvas Platform là mẫu giày đế cao với thiết kế răng cưa cá tính, thân vải canvas nhẹ thoáng, kết hợp phong cách cổ điển và hiện đại.', 1400000, 1700000, 2100000, 0, '2025-05-29', 10, 31, 'image/product/Run_Star_Hike Canvas_Platform 1.png', 'image/product/Run_Star_Hike Canvas_Platform 2.png', 'image/product/Run_Star_Hike Canvas_Platform 3.png', 'image/product/Run_Star_Hike Canvas_Platform 4.png', 'image/product/Run_Star_Hike Canvas_Platform 5.png.png', 'image/product/Run_Star_Hike Canvas_Platform 6.png.png'),
(4, 'MLB Chunky Liner Classic Monogram', 'MLB Chunky Liner Classic Monogram là mẫu giày đế thô thời trang, nổi bật với họa tiết monogram logo đội bóng, form giày chunky cá tính, đế cao tôn dáng và phần upper bền bỉ, phù hợp phong cách streetwear.', 1900000, 2100000, 2500000, 0, '2025-05-29', 4, 32, 'image/product/Liner5-Photoroom.png', 'image/product/Liner2-Photoroom.png', 'image/product/Liner1-Photoroom.png', 'image/product/Liner3-Photoroom.png', 'image/product/Liner4-Photoroom.png', 'image/product/Liner6-Photoroom.png'),
(5, 'MLB Embo Mono Cooperstown', 'MLB Embo Mono Cooperstown là mẫu giày thời trang với thiết kế họa tiết logo đội bóng dập nổi (embo), kiểu dáng năng động, đế cao tôn dáng và chất liệu bền chắc, mang phong cách thể thao pha streetwear.', 3500000, 3600000, 4000000, 0, '2025-05-29', 4, 32, 'image/product/5-Photoroom.png', 'image/product/2-Photoroom.png', 'image/product/3-Photoroom.png', 'image/product/4-Photoroom.png', 'image/product/6-Photoroom.png', 'image/product/Giày sneakers unisex cổ thấp Embo Mono Cooperstown.png'),
(6, 'MLB Speed ​​Runner', 'MLB Speed Runner là mẫu giày thể thao năng động, thiết kế gọn nhẹ với đế êm, form ôm chân, logo đội bóng nổi bật, phù hợp cho cả vận động và phối đồ streetwear.', 1250000, 1300000, 1500000, 0, '2025-05-29', 4, 32, 'image/product/unisex5-Photoroom.png', 'image/product/unisex2-Photoroom.png', 'image/product/unisex3-Photoroom.png', 'image/product/unisex6-Photoroom.png', 'image/product/unisex1-Photoroom.png', 'image/product/unisex4-Photoroom.png'),
(7, 'Converse Cruise', 'Converse Cruise là mẫu giày sneaker mới lạ với thiết kế đế dày nổi bật, form giày low-top cổ điển pha chút hiện đại, phần upper vải canvas hoặc da lộn, mang phong cách đường phố cá tính và dễ phối đồ.', 1600000, 1750000, 1900000, 0, '2025-05-29', 10, 31, 'image/product/c2-Photoroom.png', 'image/product/c3-Photoroom.png', 'image/product/c4-Photoroom.png', 'image/product/c5-Photoroom.png', 'image/product/c6-Photoroom.png', 'image/product/c1-Photoroom.png'),
(8, 'Converse Large Emblem High Top Canvas ', 'Converse Large Emblem High Top Canvas là mẫu giày cổ cao với thân vải canvas truyền thống, nổi bật nhờ logo Converse kích thước lớn bên hông, mang phong cách cá tính, đậm chất đường phố và dễ phối đồ.', 900000, 1000000, 1230000, 0, '2025-05-29', 10, 31, 'image/product/converse1-Photoroom.png', 'image/product/converse2-Photoroom.png', 'image/product/converse3-Photoroom.png', 'image/product/converse4-Photoroom.png', 'image/product/converse5-Photoroom.png', 'image/product/converse6-Photoroom.png'),
(9, 'Converse Run Star Legacy CX', 'Converse Run Star Legacy CX là mẫu giày platform hiện đại với đế dày cải tiến, sử dụng công nghệ đệm CX êm nhẹ, thiết kế chunky cá tính, phần upper canvas cổ cao quen thuộc kết hợp đế răng cưa nổi bật, mang lại phong cách năng động và thời thượng.', 1700000, 1900000, 2100000, 0, '2025-05-29', 10, 31, 'image/product/m1-Photoroom.png', 'image/product/m3-Photoroom.png', 'image/product/m4-Photoroom.png', 'image/product/m2-Photoroom.png', 'image/product/m5-Photoroom.png', 'image/product/c6-Photoroom.png'),
(10, 'Adida Lite Racer Adapt 7.0', 'Adidas Lite Racer Adapt 7.0 là mẫu giày thể thao slip-on hiện đại, nổi bật với thiết kế ôm chân như tất, dây thun co giãn giúp mang vào dễ dàng, đệm Cloudfoam êm ái và phần upper vải dệt nhẹ thoáng. Phù hợp cho cả luyện tập và đi lại hằng ngày.', 1230000, 1300000, 1500000, 0, '2025-05-29', 4, 30, 'image/product/Lite_Racer_Adapt_7.0_Shoes_White_IE6330_01_standard-Photoroom.png', 'image/product/Lite_Racer_Adapt_7.0_Shoes_White_IE6330_04_standard-Photoroom.png', 'image/product/Lite_Racer_Adapt_7.0_Shoes_White_IE6330_02_standard_hover-Photoroom.png', 'image/product/Lite_Racer_Adapt_7.0_Shoes_White_IE6330_03_standard-Photoroom.png', 'image/product/Lite_Racer_Adapt_7.0_Shoes_White_IE6330_05_standard-Photoroom.png', 'image/product/Lite_Racer_Adapt_7.0_Shoes_White_IE6330_06_standard-Photoroom.png'),
(11, 'Adida Swift Run 1.0 ', 'Adidas Swift Run 1.0 là mẫu giày sneaker thể thao nhẹ nhàng và linh hoạt, được thiết kế để sử dụng hàng ngày. Phần upper bằng vải dệt (knit) mềm mại, tạo cảm giác ôm chân như tất, kết hợp với đệm EVA êm ái, mang lại sự thoải mái tối đa khi di chuyển. Thiết kế đơn giản với ba sọc đặc trưng của Adidas, phù hợp cho cả nam và nữ trong các hoạt động thường nhật hoặc đi bộ nhẹ nhàng.', 1450000, 1500000, 1600000, 0, '2025-05-29', 4, 30, 'image/product/Swift_Run_1.0_Shoes_Black_IF0569_01_standard-Photoroom.png', 'image/product/Swift_Run_1.0_Shoes_Black_IF0569_04_standard-Photoroom.png', 'image/product/Swift_Run_1.0_Shoes_Black_IF0569_02_standard_hover-Photoroom.png', 'image/product/Swift_Run_1.0_Shoes_Black_IF0569_03_standard-Photoroom.png', 'image/product/Swift_Run_1.0_Shoes_Black_IF0569_05_standard-Photoroom.png', 'image/product/Swift_Run_1.0_Shoes_Black_IF0569_06_standard-Photoroom.png'),
(12, 'Nike Vomero 18 Older ', 'Nike Vomero 18 là mẫu giày chạy bộ cao cấp của Nike, nổi bật với thiết kế tối ưu cho sự êm ái và hỗ trợ tối đa trong các buổi chạy dài hoặc luyện tập hàng ngày.', 4000000, 4300000, 4650000, 0, '2025-05-29', 4, 34, 'image/product/NIKE+VOMERO+18+(GS)(2)-Photoroom-Photoroom.png', 'image/product/NIKE+VOMERO+18+(GS)(4)-Photoroom-Photoroom.png', 'image/product/NIKE+VOMERO+18+(GS)(1)-Photoroom (1)-Photoroom.png', 'image/product/NIKE+VOMERO+18+(GS)(3)-Photoroom-Photoroom.png', 'image/product/NIKE+VOMERO+18+(GS)(6)-Photoroom-Photoroom.png', 'image/product/NIKE+VOMERO+18+(GS)(5)-Photoroom-Photoroom.png'),
(13, 'Nike Cortez', 'Nike Cortez là mẫu giày thể thao cổ điển, lần đầu ra mắt vào năm 1972, được thiết kế bởi Bill Bowerman – một trong những người sáng lập Nike. Là một trong những mẫu giày đầu tiên của Nike, Cortez được thiết kế để trở thành giày chạy đường dài nhẹ nhàng và thoải mái.', 1399000, 1400000, 2000000, 0, '2025-05-29', 4, 34, 'image/product/NIKE+KIDS+CORTEZ+(GS3)-Photoroom.png', 'image/product/NIKE+KIDS+CORTEZ+(GS4)-Photoroom.png', 'image/product/NIKE+KIDS+CORTEZ-Photoroom.png', 'image/product/NIKE+KIDS+CORTEZ+(GS5)-Photoroom.png', 'image/product/NIKE+KIDS+CORTEZ+(GS)-Photoroom.png', 'image/product/NIKE+KIDS+CORTEZ+(GS2)-Photoroom.png'),
(14, 'Jordan Courtside', 'Jordan Courtside 23 là mẫu giày lifestyle của Jordan Brand, lấy cảm hứng từ Air Jordan 3 với thiết kế cổ thấp, đế Air Max và chất liệu da cao cấp, phù hợp cho cả hoạt động thể thao nhẹ và phong cách đường phố.', 1790000, 1900000, 2000000, 0, '2025-05-29', 10, 34, 'image/product/JORDAN+COURTSIDE+23+(GS3)-Photoroom.png', 'image/product/JORDAN+COURTSIDE+23+(GS5)-Photoroom.png', 'image/product/JORDAN+COURTSIDE+23+(GS)-Photoroom.png', 'image/product/JORDAN+COURTSIDE+23+(GS4)-Photoroom.png', 'image/product/JORDAN+COURTSIDE+23+(GS6)-Photoroom.png', 'image/product/JORDAN+COURTSIDE+23+(GS1)-Photoroom.png'),
(15, 'Vans Old Skool ', 'Thiết kế cổ điển với tông đen trắng dễ phối đồ. Thân giày bằng vải canvas kết hợp da lộn bền bỉ, đế cao su waffle bám chắc. Phù hợp đi học, đi chơi, phong cách streetwear năng động.\r\n\r\n\r\n', 1650000, 1750000, 1950000, 0, '2025-05-30', 4, 36, 'image/product/van1.png', 'image/product/van2.png', 'image/product/van3.png', 'image/product/van4.png', 'image/product/van5.png', 'image/product/van6.png'),
(20, 'tét', 'mo  ta', 123, 424, 32432, 0, '2025-05-30', 4, 32, 'image/product/2-Photoroom.png', 'image/product/3-Photoroom.png', '', '', '', ''),
(5656, 'tét', 'mo  ta', 123, 424, 32432, 0, '2025-05-30', 4, 32, 'image/product/2-Photoroom.png', 'image/product/3-Photoroom.png', 'image/product/6-Photoroom.png', 'image/product/c6-Photoroom.png', 'image/product/c3-Photoroom.png', 'image/product/6-Photoroom.png');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `ct_hoadon`
--
ALTER TABLE `ct_hoadon`
  ADD PRIMARY KEY (`MA_CT`),
  ADD KEY `MA_HD` (`MA_HD`);

--
-- Chỉ mục cho bảng `ct_sp`
--
ALTER TABLE `ct_sp`
  ADD PRIMARY KEY (`MA_CT_SP`),
  ADD KEY `MA_MS` (`MA_MS`),
  ADD KEY `MA_KC` (`MA_KC`),
  ADD KEY `MA_SP` (`MA_SP`);

--
-- Chỉ mục cho bảng `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`MA_FB`),
  ADD KEY `FK_FEEDBACK` (`MA_KH`);

--
-- Chỉ mục cho bảng `giohang`
--
ALTER TABLE `giohang`
  ADD PRIMARY KEY (`MA_GIOHANG`),
  ADD KEY `FK_GIOHANG_SP` (`MA_SP`),
  ADD KEY `FK_GIOHANG_KHACHHANG` (`MA_KH`),
  ADD KEY `fk_giohang_kichco` (`ma_kc`);

--
-- Chỉ mục cho bảng `hoadon`
--
ALTER TABLE `hoadon`
  ADD PRIMARY KEY (`MA_HD`),
  ADD KEY `MA_KH` (`MA_KH`),
  ADD KEY `MA_PTVC` (`MA_PTVC`),
  ADD KEY `MA_PTTT` (`MA_PTTT`);

--
-- Chỉ mục cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`MA_KH`),
  ADD UNIQUE KEY `PASS_KH` (`PASS_KH`);

--
-- Chỉ mục cho bảng `kichco`
--
ALTER TABLE `kichco`
  ADD PRIMARY KEY (`MA_KC`);

--
-- Chỉ mục cho bảng `lienhe`
--
ALTER TABLE `lienhe`
  ADD PRIMARY KEY (`MA_LH`);

--
-- Chỉ mục cho bảng `loaisanpham`
--
ALTER TABLE `loaisanpham`
  ADD PRIMARY KEY (`MAL_SP`);

--
-- Chỉ mục cho bảng `mausac`
--
ALTER TABLE `mausac`
  ADD PRIMARY KEY (`MA_MS`);

--
-- Chỉ mục cho bảng `nhanhieu`
--
ALTER TABLE `nhanhieu`
  ADD PRIMARY KEY (`MANH_SP`);

--
-- Chỉ mục cho bảng `phuongthuc_tt`
--
ALTER TABLE `phuongthuc_tt`
  ADD PRIMARY KEY (`MA_PTTT`);

--
-- Chỉ mục cho bảng `pt_vanchuyen`
--
ALTER TABLE `pt_vanchuyen`
  ADD PRIMARY KEY (`MA_PTVC`);

--
-- Chỉ mục cho bảng `quantri`
--
ALTER TABLE `quantri`
  ADD PRIMARY KEY (`TAIKHOAN`),
  ADD UNIQUE KEY `MATKHAU` (`MATKHAU`),
  ADD UNIQUE KEY `unique_taikhoan` (`TAIKHOAN`);

--
-- Chỉ mục cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`MA_SP`),
  ADD KEY `MAL_SP` (`MAL_SP`),
  ADD KEY `MANH_SP` (`MANH_SP`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `ct_hoadon`
--
ALTER TABLE `ct_hoadon`
  MODIFY `MA_CT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT cho bảng `ct_sp`
--
ALTER TABLE `ct_sp`
  MODIFY `MA_CT_SP` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `feedback`
--
ALTER TABLE `feedback`
  MODIFY `MA_FB` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `giohang`
--
ALTER TABLE `giohang`
  MODIFY `MA_GIOHANG` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT cho bảng `hoadon`
--
ALTER TABLE `hoadon`
  MODIFY `MA_HD` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  MODIFY `MA_KH` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT cho bảng `kichco`
--
ALTER TABLE `kichco`
  MODIFY `MA_KC` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `lienhe`
--
ALTER TABLE `lienhe`
  MODIFY `MA_LH` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `loaisanpham`
--
ALTER TABLE `loaisanpham`
  MODIFY `MAL_SP` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `mausac`
--
ALTER TABLE `mausac`
  MODIFY `MA_MS` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `nhanhieu`
--
ALTER TABLE `nhanhieu`
  MODIFY `MANH_SP` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT cho bảng `phuongthuc_tt`
--
ALTER TABLE `phuongthuc_tt`
  MODIFY `MA_PTTT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `pt_vanchuyen`
--
ALTER TABLE `pt_vanchuyen`
  MODIFY `MA_PTVC` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `MA_SP` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12346;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `ct_hoadon`
--
ALTER TABLE `ct_hoadon`
  ADD CONSTRAINT `ct_hoadon_ibfk_1` FOREIGN KEY (`MA_HD`) REFERENCES `hoadon` (`MA_HD`);

--
-- Các ràng buộc cho bảng `ct_sp`
--
ALTER TABLE `ct_sp`
  ADD CONSTRAINT `ct_sp_ibfk_1` FOREIGN KEY (`MA_MS`) REFERENCES `mausac` (`MA_MS`),
  ADD CONSTRAINT `ct_sp_ibfk_2` FOREIGN KEY (`MA_KC`) REFERENCES `kichco` (`MA_KC`),
  ADD CONSTRAINT `ct_sp_ibfk_3` FOREIGN KEY (`MA_SP`) REFERENCES `sanpham` (`MA_SP`);

--
-- Các ràng buộc cho bảng `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `FK_FEEDBACK` FOREIGN KEY (`MA_KH`) REFERENCES `khachhang` (`MA_KH`);

--
-- Các ràng buộc cho bảng `giohang`
--
ALTER TABLE `giohang`
  ADD CONSTRAINT `FK_GIOHANG_KHACHHANG` FOREIGN KEY (`MA_KH`) REFERENCES `khachhang` (`MA_KH`),
  ADD CONSTRAINT `FK_GIOHANG_SP` FOREIGN KEY (`MA_SP`) REFERENCES `sanpham` (`MA_SP`);

--
-- Các ràng buộc cho bảng `hoadon`
--
ALTER TABLE `hoadon`
  ADD CONSTRAINT `hoadon_ibfk_1` FOREIGN KEY (`MA_KH`) REFERENCES `khachhang` (`MA_KH`),
  ADD CONSTRAINT `hoadon_ibfk_2` FOREIGN KEY (`MA_PTVC`) REFERENCES `pt_vanchuyen` (`MA_PTVC`),
  ADD CONSTRAINT `hoadon_ibfk_3` FOREIGN KEY (`MA_PTTT`) REFERENCES `phuongthuc_tt` (`MA_PTTT`);

--
-- Các ràng buộc cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD CONSTRAINT `sanpham_ibfk_1` FOREIGN KEY (`MAL_SP`) REFERENCES `loaisanpham` (`MAL_SP`),
  ADD CONSTRAINT `sanpham_ibfk_2` FOREIGN KEY (`MANH_SP`) REFERENCES `nhanhieu` (`MANH_SP`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
