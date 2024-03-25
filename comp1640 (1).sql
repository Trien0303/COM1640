-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th3 19, 2024 lúc 06:51 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `web_comp1640`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `articles`
--

CREATE TABLE `articles` (
  `articleId` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `submitDate` date DEFAULT current_timestamp(),
  `status` varchar(50) NOT NULL DEFAULT '1',
  `authorId` int(11) DEFAULT NULL,
  `magazineId` int(11) DEFAULT NULL,
  `Image` blob DEFAULT NULL,
  `showStatus` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `articles`
--

INSERT INTO `articles` (`articleId`, `title`, `content`, `submitDate`, `status`, `authorId`, `magazineId`, `Image`, `showStatus`) VALUES
(9, 'New title', NULL, '2024-02-15', '1', NULL, NULL, NULL, 0),
(16, '123', NULL, '2024-03-01', '1', NULL, NULL, NULL, 1),
(17, '123', NULL, '2024-03-12', '1', NULL, NULL, NULL, 1),
(18, '123123', NULL, '2024-03-12', '1', NULL, NULL, NULL, 1),
(19, '123123', NULL, '2024-03-12', '1', NULL, NULL, NULL, 1),
(20, 'test', 'test', '2024-03-15', '2', NULL, 1, 0x696d616765735f61727469636c652f6f726967696e616c2d64363634373737353437383363623861366137633461313963663364626335642e706e67, 1),
(21, 'test', '123', '2024-03-15', '2', 11, 1, 0x696d616765735f61727469636c652f7a343834393033333838343536325f39373937343163386539386133646266616663356364323939353233366462652e6a7067, 1),
(22, 'test', '123', '2024-03-15', '2', 11, 1, 0x696d616765735f61727469636c652f7a343834393033333838343536325f39373937343163386539386133646266616663356364323939353233366462652e6a7067, 1),
(23, 'test', 'tesst', '2024-03-15', '2', 11, 1, 0x696d616765735f61727469636c652f7a343834393033333838343536325f39373937343163386539386133646266616663356364323939353233366462652e6a7067, 1),
(24, 'test', 'tesst', '2024-03-15', '2', 11, 1, 0x696d616765735f61727469636c652f7a343834393033333838343536325f39373937343163386539386133646266616663356364323939353233366462652e6a7067, 1),
(25, 'test', '123', '2024-03-15', '2', 11, 2, 0x696d616765735f61727469636c652f7a343834393033333838343536325f39373937343163386539386133646266616663356364323939353233366462652e6a7067, 1),
(26, 'test1', 'test', '2024-03-15', '2', 11, 2, 0x696d616765735f61727469636c652f6f726967696e616c2d64363634373737353437383363623861366137633461313963663364626335642e706e67, 1),
(27, 'test1', 'test', '2024-03-15', '2', 11, 2, 0x696d616765735f61727469636c652f6f726967696e616c2d64363634373737353437383363623861366137633461313963663364626335642e706e67, 1),
(28, 'test112', '1213123', '2024-03-15', '2', 11, 2, 0x696d616765735f61727469636c652f6f726967696e616c2d64363634373737353437383363623861366137633461313963663364626335642e706e67, 1),
(29, 'test123', '123123', '2024-03-15', '2', 11, 3, 0x696d616765735f61727469636c652f6f726967696e616c2d64363634373737353437383363623861366137633461313963663364626335642e706e67, 1),
(30, 'test123', '123123123', '2024-03-15', '2', 11, 3, 0x696d616765735f61727469636c652f6f726967696e616c2d64363634373737353437383363623861366137633461313963663364626335642e706e67, 1),
(31, 'Test', 'Test ', '2024-03-15', '2', 11, 2, 0x696d616765735f61727469636c652f6f726967696e616c2d64363634373737353437383363623861366137633461313963663364626335642e706e67, 1),
(32, '123123', '123123123', '2024-03-16', '2', 11, 1, 0x696d616765735f61727469636c652f66617669636f6e2e706e67, 1),
(33, '123123', '123123', '2024-03-18', '1', 11, 1, 0x696d616765735f61727469636c652f66617669636f6e2e706e67, 0),
(34, '123123', '123123', '2024-03-18', '1', 11, 1, 0x696d616765735f61727469636c652f66617669636f6e2e706e67, 0),
(35, '123123', '123123', '2024-03-18', '1', 11, 1, 0x696d616765735f61727469636c652f66617669636f6e2e706e67, 0),
(36, '123123', '123123', '2024-03-18', '1', 11, 1, 0x696d616765735f61727469636c652f66617669636f6e2e706e67, 0),
(37, '123123', '1231231', '2024-03-18', '1', 11, 2, 0x696d616765735f61727469636c652f66617669636f6e2e706e67, 0),
(38, '123123', '123123', '2024-03-18', '1', 11, 2, 0x696d616765735f61727469636c652f66617669636f6e2e706e67, 0),
(39, '123123123123', '12312312312', '2024-03-18', '1', 11, 2, 0x696d616765735f61727469636c652f66617669636f6e2e706e67, 0),
(40, 'test', '123123', '2024-03-18', '1', 11, 2, 0x696d616765735f61727469636c652f66617669636f6e2e706e67, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comments`
--

CREATE TABLE `comments` (
  `commentId` int(11) NOT NULL,
  `content` text DEFAULT NULL,
  `commentDate` datetime DEFAULT NULL,
  `authorId` int(11) DEFAULT NULL,
  `articleId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `comments`
--

INSERT INTO `comments` (`commentId`, `content`, `commentDate`, `authorId`, `articleId`) VALUES
(2, 'Chính đẹp trai', '2024-03-13 18:25:44', NULL, 16),
(3, 'trung cức', '2024-03-13 19:48:20', NULL, 16),
(7, 'test', '2024-03-15 10:40:24', NULL, 17),
(8, 'chinh nguyen', '2024-03-15 20:20:22', NULL, 17),
(11, '123', '2024-03-15 21:46:36', NULL, 17),
(12, '123123', '2024-03-15 21:46:47', NULL, 17),
(13, 'test112', '2024-03-18 21:26:11', NULL, 17);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `faculties`
--

CREATE TABLE `faculties` (
  `facultyId` int(11) NOT NULL,
  `facultyName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `faculties`
--

INSERT INTO `faculties` (`facultyId`, `facultyName`) VALUES
(1, 'Digital Design'),
(2, 'Bussiness Adminitration'),
(3, 'Information Technology');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `files`
--

CREATE TABLE `files` (
  `fileId` int(11) NOT NULL,
  `articleId` int(11) DEFAULT NULL,
  `fileName` varchar(255) DEFAULT NULL,
  `filePath` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `files`
--

INSERT INTO `files` (`fileId`, `articleId`, `fileName`, `filePath`) VALUES
(4, 9, NULL, 'files/COMP1640-Coursework.docx'),
(5, 19, NULL, 'files/Bài_Tập.docx'),
(6, 21, '07.07bmFGdtFE10 - Bao cao thuc tap OJT.doc', 'files/07.07bmFGdtFE10 - Bao cao thuc tap OJT.doc'),
(7, 21, 'ASM1RT-VOHUYHAU-GCC200224-GCC0903.docx', 'files/ASM1RT-VOHUYHAU-GCC200224-GCC0903.docx'),
(8, 22, 'KHTC_Predator-Fest-ĐH-Cần-Thơ_-GreenwichEsports.docx', 'files/KHTC_Predator-Fest-ĐH-Cần-Thơ_-GreenwichEsports.docx'),
(9, 22, 'Báo Cáo Thực Tập Tháng 6_GBC200278_TranLeNhutChinh.doc', 'files/Báo Cáo Thực Tập Tháng 6_GBC200278_TranLeNhutChinh.doc'),
(10, 23, 'KHTC_Predator-Fest-ĐH-Cần-Thơ_-GreenwichEsports.docx', 'files/KHTC_Predator-Fest-ĐH-Cần-Thơ_-GreenwichEsports.docx'),
(11, 23, 'Báo Cáo Thực Tập Tháng 6_GBC200278_TranLeNhutChinh.doc', 'files/Báo Cáo Thực Tập Tháng 6_GBC200278_TranLeNhutChinh.doc'),
(12, 24, 'KHTC_Predator-Fest-ĐH-Cần-Thơ_-GreenwichEsports.docx', 'files/KHTC_Predator-Fest-ĐH-Cần-Thơ_-GreenwichEsports.docx'),
(13, 24, 'Báo Cáo Thực Tập Tháng 6_GBC200278_TranLeNhutChinh.doc', 'files/Báo Cáo Thực Tập Tháng 6_GBC200278_TranLeNhutChinh.doc'),
(14, 25, 'KHTC_Predator-Fest-ĐH-Cần-Thơ_-GreenwichEsports.docx', 'files/KHTC_Predator-Fest-ĐH-Cần-Thơ_-GreenwichEsports.docx'),
(15, 25, 'Báo Cáo Thực Tập Tháng 6_GBC200278_TranLeNhutChinh.doc', 'files/Báo Cáo Thực Tập Tháng 6_GBC200278_TranLeNhutChinh.doc'),
(16, 26, 'KHTC_Predator-Fest-ĐH-Cần-Thơ_-GreenwichEsports.docx', 'files/KHTC_Predator-Fest-ĐH-Cần-Thơ_-GreenwichEsports.docx'),
(17, 26, 'Báo Cáo Thực Tập Tháng 6_GBC200278_TranLeNhutChinh.doc', 'files/Báo Cáo Thực Tập Tháng 6_GBC200278_TranLeNhutChinh.doc'),
(18, 27, 'KHTC_Predator-Fest-ĐH-Cần-Thơ_-GreenwichEsports.docx', 'files/KHTC_Predator-Fest-ĐH-Cần-Thơ_-GreenwichEsports.docx'),
(19, 27, 'Báo Cáo Thực Tập Tháng 6_GBC200278_TranLeNhutChinh.doc', 'files/Báo Cáo Thực Tập Tháng 6_GBC200278_TranLeNhutChinh.doc'),
(20, 28, 'KHTC_Predator-Fest-ĐH-Cần-Thơ_-GreenwichEsports.docx', 'files/KHTC_Predator-Fest-ĐH-Cần-Thơ_-GreenwichEsports.docx'),
(21, 28, 'Báo Cáo Thực Tập Tháng 6_GBC200278_TranLeNhutChinh.doc', 'files/Báo Cáo Thực Tập Tháng 6_GBC200278_TranLeNhutChinh.doc'),
(22, 29, 'KHTC_Predator-Fest-ĐH-Cần-Thơ_-GreenwichEsports.docx', 'files/KHTC_Predator-Fest-ĐH-Cần-Thơ_-GreenwichEsports.docx'),
(23, 30, 'KHTC_Predator-Fest-ĐH-Cần-Thơ_-GreenwichEsports.docx', 'files/KHTC_Predator-Fest-ĐH-Cần-Thơ_-GreenwichEsports.docx'),
(24, 31, 'KHTC_Predator-Fest-ĐH-Cần-Thơ_-GreenwichEsports.docx', 'files/KHTC_Predator-Fest-ĐH-Cần-Thơ_-GreenwichEsports.docx'),
(25, 31, 'Báo Cáo Thực Tập Tháng 6_GBC200278_TranLeNhutChinh.doc', 'files/Báo Cáo Thực Tập Tháng 6_GBC200278_TranLeNhutChinh.doc'),
(26, 32, 'COMP1640_Ver2.doc', 'files/COMP1640_Ver2.doc'),
(27, 33, 'COMP1640-Chức_Năng_và_Lưu_Ý.docx', 'files/COMP1640-Chức_Năng_và_Lưu_Ý.docx'),
(28, 34, 'COMP1640-Chức_Năng_và_Lưu_Ý.docx', 'files/COMP1640-Chức_Năng_và_Lưu_Ý.docx'),
(29, 35, 'COMP1640-Chức_Năng_và_Lưu_Ý.docx', 'files/COMP1640-Chức_Năng_và_Lưu_Ý.docx'),
(30, 36, 'COMP1640_Ver2.doc', 'files/COMP1640_Ver2.doc'),
(31, 37, 'COMP1640-Chức_Năng_và_Lưu_Ý.docx', 'files/COMP1640-Chức_Năng_và_Lưu_Ý.docx'),
(32, 38, 'COMP1640-Chức_Năng_và_Lưu_Ý.docx', 'files/COMP1640-Chức_Năng_và_Lưu_Ý.docx'),
(33, 39, 'Bài_Tập.docx', 'files/Bài_Tập.docx'),
(34, 40, 'COMP1640-Chức_Năng_và_Lưu_Ý.docx', 'files/COMP1640-Chức_Năng_và_Lưu_Ý.docx');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `magazine`
--

CREATE TABLE `magazine` (
  `magazineId` int(11) NOT NULL,
  `magazineName` varchar(255) DEFAULT NULL,
  `magazineDescription` text DEFAULT NULL,
  `closureDate` date DEFAULT NULL,
  `magazineYear` year(4) DEFAULT NULL,
  `finalClosureDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `magazine`
--

INSERT INTO `magazine` (`magazineId`, `magazineName`, `magazineDescription`, `closureDate`, `magazineYear`, `finalClosureDate`) VALUES
(1, 'Magazine 1', 'Description of magazine', '2024-04-14', '2024', '2024-04-30'),
(2, '123', '123 123 123', '1970-01-01', '2024', '1970-01-01'),
(3, 'Asm1', 'Dành cho game thủ chuyên nghiệp', '2024-03-14', '2024', '2024-03-31');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `roles`
--

CREATE TABLE `roles` (
  `roleId` int(11) NOT NULL,
  `roleName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `roles`
--

INSERT INTO `roles` (`roleId`, `roleName`) VALUES
(1, 'Administrator'),
(2, 'Student'),
(3, 'Marketing Coordinator'),
(4, 'University Marketing Manager');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `aboutYou` text DEFAULT NULL,
  `facultyId` int(11) DEFAULT NULL,
  `roleId` int(11) DEFAULT 2,
  `name` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`userId`, `username`, `password`, `email`, `address`, `aboutYou`, `facultyId`, `roleId`, `name`, `avatar`, `status`) VALUES
(8, 'chinh', '$2y$10$S1f47otFW4VjK3V3t2AO3ObSKmmdspahUe7XBVeWeAjl3.JwNVhd2', 'chinhnguyenabout@gmail.com', 'Thanh Binh, Dong Thap, Viet Nam', NULL, 1, 3, 'Nguyen Nhat Chinh', NULL, 0),
(9, 'admin', '$2y$10$S1f47otFW4VjK3V3t2AO3ObSKmmdspahUe7XBVeWeAjl3.JwNVhd2', 'chinh@gmail.com', 'Thanh Binh', NULL, NULL, 1, 'Nguyến Nhất Chính', NULL, 0),
(10, 'admin1', '$2y$10$1aAHlgODJYq7DY.qkoJ5We7bUoXxnjjde1is7mDjM2IPr3qliWEbW', 'chinh@gmail.com', 'Thanh Binh', NULL, NULL, 1, 'Nguyến Nhất Chính', NULL, 1),
(11, 'student', '$2y$10$UX1MgjJ7hThkV5bbCYYWyuLl/YaeBIDAGaY0jdE5fjmwwvf89AbcC', 'student@gmail.com', 'Thanh Binh', NULL, 1, 2, 'Nguyến Nhất Chính', NULL, 1),
(12, 'student1', '$2y$10$1LjyM3Yvy5wznDR3F9fIFeiVOIwJ/biKNvJp96zKe4clYxlrymvtm', '1@gmail.com', NULL, NULL, 1, 2, 'Nguyến Nhất Chính', NULL, 1),
(13, 'chinh123', '$2y$10$gdwNylGtfj67ajiBZps.heXjE9Xpzpmn7eRgTXoU.fnDTH1hezstW', '123123@gmail.com', NULL, NULL, 1, 2, '123123', NULL, 0),
(14, 'chinhcute', '$2y$10$1aAHlgODJYq7DY.qkoJ5We7bUoXxnjjde1is7mDjM2IPr3qliWEbW', 'chinhcute@gmail.com', NULL, NULL, 2, 2, 'Tran Le Nhut Chinh', NULL, 1);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`articleId`),
  ADD KEY `authorId` (`authorId`),
  ADD KEY `magazineId` (`magazineId`);

--
-- Chỉ mục cho bảng `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`commentId`),
  ADD KEY `authorId` (`authorId`),
  ADD KEY `articleId` (`articleId`);

--
-- Chỉ mục cho bảng `faculties`
--
ALTER TABLE `faculties`
  ADD PRIMARY KEY (`facultyId`);

--
-- Chỉ mục cho bảng `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`fileId`),
  ADD KEY `articleId` (`articleId`);

--
-- Chỉ mục cho bảng `magazine`
--
ALTER TABLE `magazine`
  ADD PRIMARY KEY (`magazineId`);

--
-- Chỉ mục cho bảng `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`roleId`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`),
  ADD KEY `facultyId` (`facultyId`),
  ADD KEY `fk_roleId` (`roleId`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `articles`
--
ALTER TABLE `articles`
  MODIFY `articleId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT cho bảng `comments`
--
ALTER TABLE `comments`
  MODIFY `commentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `faculties`
--
ALTER TABLE `faculties`
  MODIFY `facultyId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `files`
--
ALTER TABLE `files`
  MODIFY `fileId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT cho bảng `magazine`
--
ALTER TABLE `magazine`
  MODIFY `magazineId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `roles`
--
ALTER TABLE `roles`
  MODIFY `roleId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`authorId`) REFERENCES `users` (`userId`),
  ADD CONSTRAINT `articles_ibfk_2` FOREIGN KEY (`magazineId`) REFERENCES `magazine` (`magazineId`);

--
-- Các ràng buộc cho bảng `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`authorId`) REFERENCES `users` (`userId`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`articleId`) REFERENCES `articles` (`articleId`);

--
-- Các ràng buộc cho bảng `files`
--
ALTER TABLE `files`
  ADD CONSTRAINT `files_ibfk_1` FOREIGN KEY (`articleId`) REFERENCES `articles` (`articleId`);

--
-- Các ràng buộc cho bảng `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_roleId` FOREIGN KEY (`roleId`) REFERENCES `roles` (`roleId`),
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`facultyId`) REFERENCES `faculties` (`facultyId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
