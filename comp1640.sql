-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th3 30, 2024 lúc 06:01 PM
-- Phiên bản máy phục vụ: 10.4.25-MariaDB
-- Phiên bản PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `comp1640`
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
  `status` int(11) DEFAULT 0,
  `authorId` int(11) DEFAULT NULL,
  `magazineId` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `showStatus` int(11) DEFAULT 0,
  `publicDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `articles`
--

INSERT INTO `articles` (`articleId`, `title`, `content`, `submitDate`, `status`, `authorId`, `magazineId`, `image`, `showStatus`, `publicDate`) VALUES
(45, 'Trung Article', '123123', '2024-03-25', 1, 9, 1, 'images_article/878503.jpg', 1, NULL),
(46, 'Trien Article', 'Good', '2024-03-25', 1, 9, 1, 'images_article/878503.jpg', 1, NULL),
(47, 'Luan Article', 'Nice', '2024-03-25', 1, 9, 1, 'images_article/878503.jpg', 1, NULL),
(50, 'Article one', '23112313123', '2024-03-25', 0, 10, 2, 'images_article/hinh-nen-gaming-4k-ao-dieu_509601-1280x720.jpg', 0, NULL);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `comments`
--

INSERT INTO `comments` (`commentId`, `content`, `commentDate`, `authorId`, `articleId`) VALUES
(14, 'I think it very good', '2024-03-25 02:16:07', 9, 45),
(15, 'well', '2024-03-25 02:16:44', 9, 46),
(16, 'Fall', '2024-03-25 02:16:52', 9, 47);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `faculties`
--

CREATE TABLE `faculties` (
  `facultyId` int(11) NOT NULL,
  `facultyName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `faculties`
--

INSERT INTO `faculties` (`facultyId`, `facultyName`) VALUES
(1, 'Information Technology'),
(2, 'Bussiness Management'),
(3, 'Design ');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `files`
--

CREATE TABLE `files` (
  `fileId` int(11) NOT NULL,
  `articleId` int(11) DEFAULT NULL,
  `fileName` varchar(255) DEFAULT NULL,
  `filePath` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `files`
--

INSERT INTO `files` (`fileId`, `articleId`, `fileName`, `filePath`) VALUES
(45, 45, 'Computing Final Report Template 2022-2023 (1).doc', 'files/Computing Final Report Template 2022-2023 (1).doc'),
(46, 46, 'GDM Final Report Template_2022-2023.docx', 'files/GDM Final Report Template_2022-2023.docx'),
(47, 47, 'CS -SWEng Report Structure.docx', 'files/CS -SWEng Report Structure.docx'),
(48, 48, 'COMP1682 UG Project Demo Checklist.doc', 'files/COMP1682 UG Project Demo Checklist.doc'),
(49, 49, 'COMP1640_Ver2.doc', 'files/COMP1640_Ver2.doc'),
(50, 50, 'COMP1640_Ver2.doc', 'files/COMP1640_Ver2.doc');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `magazine`
--

INSERT INTO `magazine` (`magazineId`, `magazineName`, `magazineDescription`, `closureDate`, `magazineYear`, `finalClosureDate`) VALUES
(1, 'Magazine IT', 'Information Technology', '2024-04-14', 2024, '2024-04-30'),
(2, 'Magazine BA', 'Business ', '2023-12-01', 2024, '2024-02-02'),
(3, 'Magazine DS', 'Design', '2024-03-14', 2024, '2024-03-31');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `roles`
--

CREATE TABLE `roles` (
  `roleId` int(11) NOT NULL,
  `roleName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `roles`
--

INSERT INTO `roles` (`roleId`, `roleName`) VALUES
(1, 'Administrator'),
(2, 'Student'),
(3, 'Marketing Coordinator'),
(4, 'Marketing Manager'),
(5, 'Guest');

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
  `facultyId` int(11) NOT NULL,
  `roleId` int(11) DEFAULT 2,
  `name` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`userId`, `username`, `password`, `email`, `address`, `aboutYou`, `facultyId`, `roleId`, `name`, `avatar`, `status`) VALUES
(9, 'admin', '$2y$10$SX/qOE8orTd7YhxEeTX2guD9GazaNUTYup.beQd5MVPDQzp5AQU3K', 'admin@gmail.com', 'Soc Trang', NULL, 1, 1, 'Tran Trung', NULL, 1),
(10, 'admin1', '$2y$10$S1f47otFW4VjK3V3t2AO3ObSKmmdspahUe7XBVeWeAjl3.JwNVhd2', 'admin1@gmail.com', 'Soc Trang', NULL, 2, 1, 'Tran Trung', NULL, 1),
(16, 'coordinatorIT', '$2y$10$A.5kZEazlt4vwYli/Yl8FO0VAe75PW4Y/1.FXV3PbuetXVhurnmrC', 'Marketing-coordinatorIT@a.com', NULL, NULL, 1, 3, 'Marketing Coordinator IT', NULL, 1),
(17, 'coordinatorBA', '$2y$10$q1fwWND5PeHampzcDIZPc.SD9Hooq9zDdSiOwrsyeCpvc3n8C2Rga', 'Marketing-coordinatorBA@a.com', NULL, NULL, 2, 3, 'Marketing Coordinator - Business', NULL, 1),
(18, 'coordinatorDS', '$2y$10$Ihd0NLB8XqtGqKFPWOd2aO0DR7CVR1lKVkDmmiJ2Rh3ujBP16/TXG', 'Marketing-coordinatorDS@a.com', NULL, NULL, 3, 3, 'Marketing Coordinator - DS', NULL, 1),
(19, 'studentIT', '$2y$10$VX1feKy2o2BF2gtlQfZVfOa8fcGP551mOYXtVuWyukZxVEdEj2.hq', 'studentIT@a.com', NULL, NULL, 1, 2, 'Student - IT', NULL, 1),
(20, 'studentBA', '$2y$10$jPWukMx3xBTN6AnOU2NV7OksT9M7Y7IneUuh/yyqqcXC6kHutM15u', 'studentBA@a.com', NULL, NULL, 2, 2, 'Student - Business', NULL, 1),
(21, 'studentDS', '$2y$10$q1B.t.FaaXyp6Eswq/jjdueNzfCXJa7FLKx06ntuwVB8D5bQAxA2C', 'studentDS@a.com', NULL, NULL, 2, 2, 'Student - Design', NULL, 1),
(22, 'guestIT', '$2y$10$9TRsAN.Sj76Tm0K1KELO2uubPLP9dDucfqO81rihoLl7SNoOAFIXm', 'guestIT@a.com', NULL, NULL, 1, 5, 'Guest - IT', NULL, 1),
(23, 'guestBA', '$2y$10$O8kHVSRpGy9D0jtKk2EpM.iBVzxsvZ9lejD/u1TfoBIAhe2BkkLny', 'guestBA@a.com', NULL, NULL, 2, 5, 'Guest - BA', NULL, 1),
(24, 'guestDS', '$2y$10$wczXxrQSTM4KuUcBpp05wOZPkVMBlYXlH15qb7FD3vQ3baPsycX8K', 'guestDS@a.com', NULL, NULL, 3, 5, 'Guest - DS', NULL, 1),
(25, 'manager', '$2y$10$DE8pat/9FM9C/21sGLN.we1tugqAaNe6dK4353vZv4z06M/iHyQ3a', 'Marketing-manager@a.com', NULL, NULL, 1, 2, 'Marketing Manager', NULL, 1);

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
  MODIFY `articleId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT cho bảng `comments`
--
ALTER TABLE `comments`
  MODIFY `commentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `faculties`
--
ALTER TABLE `faculties`
  MODIFY `facultyId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `files`
--
ALTER TABLE `files`
  MODIFY `fileId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT cho bảng `magazine`
--
ALTER TABLE `magazine`
  MODIFY `magazineId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `roles`
--
ALTER TABLE `roles`
  MODIFY `roleId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
