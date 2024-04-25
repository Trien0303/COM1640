-- phpMyAdmin SQL Dump
<<<<<<< HEAD
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 25, 2024 lúc 04:56 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12
=======
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th3 30, 2024 lúc 06:01 PM
-- Phiên bản máy phục vụ: 10.4.25-MariaDB
-- Phiên bản PHP: 7.4.30
>>>>>>> b39f62423b78a1b2a83dce1792d1fa4584f91fd7

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
<<<<<<< HEAD
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
=======
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
>>>>>>> b39f62423b78a1b2a83dce1792d1fa4584f91fd7

--
-- Đang đổ dữ liệu cho bảng `articles`
--

INSERT INTO `articles` (`articleId`, `title`, `content`, `submitDate`, `status`, `authorId`, `magazineId`, `image`, `showStatus`, `publicDate`) VALUES
<<<<<<< HEAD
(62, 'Article IT1', 'aaaaaaaaaaaaaaaaaaaaaaa', '2024-03-27', 1, 19, 2, 'images_article/screen-2.jpg', 1, NULL),
(63, 'Article IT2', '159753', '2024-04-11', 1, 19, 2, 'images_article/phổi.PNG', 1, NULL),
(65, 'Article IT3', '1111111111111111111111111111111111111', '2024-04-11', 1, 19, 2, 'images_article/screen-2.jpg', 1, NULL),
(66, 'Trung Article today', '111111111111111', '2024-04-11', 2, 20, 2, 'images_article/Trung.PNG', 1, NULL),
(67, 'Article IT4', '22222222222222222', '2024-04-11', 1, 19, 2, 'images_article/screen-2.jpg', 1, NULL),
(68, 'Article Trung', '111111111111111', '2024-04-11', 1, 19, 2, 'images_article/screen-2.jpg', 1, NULL),
(69, 'Article 1', 'Nice', '2024-04-21', 1, 9, 2, 'images_article/screen-2.jpg', 1, NULL),
(71, 'Book Cover Design', 'The Book Cover Design of Greenwich', '2024-04-24', 1, 29, 5, 'images_article/greenwich.jpg', 1, NULL);
=======
(45, 'Trung Article', '123123', '2024-03-25', 1, 9, 1, 'images_article/878503.jpg', 1, NULL),
(46, 'Trien Article', 'Good', '2024-03-25', 1, 9, 1, 'images_article/878503.jpg', 1, NULL),
(47, 'Luan Article', 'Nice', '2024-03-25', 1, 9, 1, 'images_article/878503.jpg', 1, NULL),
(50, 'Article one', '23112313123', '2024-03-25', 0, 10, 2, 'images_article/hinh-nen-gaming-4k-ao-dieu_509601-1280x720.jpg', 0, NULL);
>>>>>>> b39f62423b78a1b2a83dce1792d1fa4584f91fd7

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
<<<<<<< HEAD
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
=======
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
>>>>>>> b39f62423b78a1b2a83dce1792d1fa4584f91fd7

--
-- Đang đổ dữ liệu cho bảng `comments`
--

INSERT INTO `comments` (`commentId`, `content`, `commentDate`, `authorId`, `articleId`) VALUES
<<<<<<< HEAD
(18, 'Triển', '2024-04-11 04:18:13', 16, 62),
(19, 'Good Job', '2024-04-24 08:27:29', 16, 63);
=======
(14, 'I think it very good', '2024-03-25 02:16:07', 9, 45),
(15, 'well', '2024-03-25 02:16:44', 9, 46),
(16, 'Fall', '2024-03-25 02:16:52', 9, 47);
>>>>>>> b39f62423b78a1b2a83dce1792d1fa4584f91fd7

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `faculties`
--

CREATE TABLE `faculties` (
  `facultyId` int(11) NOT NULL,
  `facultyName` varchar(100) NOT NULL
<<<<<<< HEAD
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
=======
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
>>>>>>> b39f62423b78a1b2a83dce1792d1fa4584f91fd7

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
<<<<<<< HEAD
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
=======
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
>>>>>>> b39f62423b78a1b2a83dce1792d1fa4584f91fd7

--
-- Đang đổ dữ liệu cho bảng `files`
--

INSERT INTO `files` (`fileId`, `articleId`, `fileName`, `filePath`) VALUES
(45, 45, 'Computing Final Report Template 2022-2023 (1).doc', 'files/Computing Final Report Template 2022-2023 (1).doc'),
(46, 46, 'GDM Final Report Template_2022-2023.docx', 'files/GDM Final Report Template_2022-2023.docx'),
(47, 47, 'CS -SWEng Report Structure.docx', 'files/CS -SWEng Report Structure.docx'),
(48, 48, 'COMP1682 UG Project Demo Checklist.doc', 'files/COMP1682 UG Project Demo Checklist.doc'),
(49, 49, 'COMP1640_Ver2.doc', 'files/COMP1640_Ver2.doc'),
<<<<<<< HEAD
(50, 50, 'COMP1640_Ver2.doc', 'files/COMP1640_Ver2.doc'),
(51, 51, 'Project Proposal Template (CS) (1).docx', 'files/Project Proposal Template (CS) (1).docx'),
(52, 52, 'COMP1649 Annotated TOC CW 2023-2024 Partnerships.docx', 'files/COMP1649 Annotated TOC CW 2023-2024 Partnerships.docx'),
(53, 53, '2022-23-GDM-Proposal-Template (1).docx', 'files/2022-23-GDM-Proposal-Template (1).docx'),
(54, 54, 'Project Proposal Template (CS).docx', 'files/Project Proposal Template (CS).docx'),
(55, 55, '2022-23-GDM-Proposal-Template (1) (1).docx', 'files/2022-23-GDM-Proposal-Template (1) (1).docx'),
(56, 56, 'Project Proposal Template (CS) (1) (1).docx', 'files/Project Proposal Template (CS) (1) (1).docx'),
(57, 57, 'Project Proposal Template (CS) (1) (1).docx', 'files/Project Proposal Template (CS) (1) (1).docx'),
(58, 58, 'Project Proposal Template (CS) (1) (1).docx', 'files/Project Proposal Template (CS) (1) (1).docx'),
(59, 59, '2022-23-GDM-Proposal-Template.docx', 'files/2022-23-GDM-Proposal-Template.docx'),
(60, 60, 'Project Proposal Template (CS) (1) (1).docx', 'files/Project Proposal Template (CS) (1) (1).docx'),
(61, 61, 'COMP1649 Annotated TOC CW 2023-2024 Partnerships.docx', 'files/COMP1649 Annotated TOC CW 2023-2024 Partnerships.docx'),
(62, 62, 'COMP1640_Ver2.doc', 'files/COMP1640_Ver2.doc'),
(63, 63, 'COMP1640_IndividualReport_TranThaoTrung.pdf', 'files/COMP1640_IndividualReport_TranThaoTrung.pdf'),
(64, 64, 'COMP 1787 Coursework 23-24 T2.docx', 'files/COMP 1787 Coursework 23-24 T2.docx'),
(66, 65, 'COMP1640_IndividualReport_TranThaoTrung.docx', 'files/COMP1640_IndividualReport_TranThaoTrung.docx'),
(67, 66, 'COMP1640_IndividualReport_TranThaoTrung.docx', 'files/COMP1640_IndividualReport_TranThaoTrung.docx'),
(68, 67, 'COMP1640_IndividualReport_TranThaoTrung.docx', 'files/COMP1640_IndividualReport_TranThaoTrung.docx'),
(69, 68, 'COMP1640_IndividualReport_TranThaoTrung.docx', 'files/COMP1640_IndividualReport_TranThaoTrung.docx'),
(70, 69, 'COMP1640_Ver2.doc', 'files/COMP1640_Ver2.doc'),
(71, 70, 'COMP1649 Annotated TOC CW 2023-2024 Partnerships.docx', 'files/COMP1649 Annotated TOC CW 2023-2024 Partnerships.docx'),
(72, 71, '2022-23-GDM-Proposal-Template (1) (1).docx', 'files/2022-23-GDM-Proposal-Template (1) (1).docx');
=======
(50, 50, 'COMP1640_Ver2.doc', 'files/COMP1640_Ver2.doc');
>>>>>>> b39f62423b78a1b2a83dce1792d1fa4584f91fd7

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
<<<<<<< HEAD
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
=======
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
>>>>>>> b39f62423b78a1b2a83dce1792d1fa4584f91fd7

--
-- Đang đổ dữ liệu cho bảng `magazine`
--

INSERT INTO `magazine` (`magazineId`, `magazineName`, `magazineDescription`, `closureDate`, `magazineYear`, `finalClosureDate`) VALUES
<<<<<<< HEAD
(1, 'Magazine 2023', 'Information Technology', '2023-12-01', '2023', '2023-11-30'),
(2, 'Magazine 2024', 'Business ', '2024-04-21', '2024', '2024-04-30'),
(5, 'Magazine 2024', 'Magazine Information Technology in 2024', '2024-04-25', '2024', '2024-05-09');
=======
(1, 'Magazine IT', 'Information Technology', '2024-04-14', 2024, '2024-04-30'),
(2, 'Magazine BA', 'Business ', '2023-12-01', 2024, '2024-02-02'),
(3, 'Magazine DS', 'Design', '2024-03-14', 2024, '2024-03-31');
>>>>>>> b39f62423b78a1b2a83dce1792d1fa4584f91fd7

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `roles`
--

CREATE TABLE `roles` (
  `roleId` int(11) NOT NULL,
  `roleName` varchar(50) NOT NULL
<<<<<<< HEAD
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
=======
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
>>>>>>> b39f62423b78a1b2a83dce1792d1fa4584f91fd7

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
<<<<<<< HEAD
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
=======
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
>>>>>>> b39f62423b78a1b2a83dce1792d1fa4584f91fd7

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`userId`, `username`, `password`, `email`, `address`, `aboutYou`, `facultyId`, `roleId`, `name`, `avatar`, `status`) VALUES
<<<<<<< HEAD
(9, 'admin', '$2y$10$SX/qOE8orTd7YhxEeTX2guD9GazaNUTYup.beQd5MVPDQzp5AQU3K', 'admin@gmail.com', NULL, '', 1, 1, NULL, NULL, 1),
(10, 'admin1', '$2y$10$S1f47otFW4VjK3V3t2AO3ObSKmmdspahUe7XBVeWeAjl3.JwNVhd2', 'admin1@gmail.com', 'Soc Trang', NULL, 2, 1, 'Tran Trung', NULL, 1),
(16, 'coordinatorIT', '$2y$10$A.5kZEazlt4vwYli/Yl8FO0VAe75PW4Y/1.FXV3PbuetXVhurnmrC', 'luanngau1357@gmail.com', NULL, NULL, 1, 3, 'Marketing Coordinator IT', NULL, 1),
(17, 'coordinatorBA', '$2y$10$q1fwWND5PeHampzcDIZPc.SD9Hooq9zDdSiOwrsyeCpvc3n8C2Rga', 'trungttgcc200091@fpt.edu.vn', NULL, NULL, 2, 3, 'Marketing Coordinator - Business', NULL, 1),
(19, 'studentIT', '$2y$10$VX1feKy2o2BF2gtlQfZVfOa8fcGP551mOYXtVuWyukZxVEdEj2.hq', 'studentIT@a.com', NULL, NULL, 1, 2, 'Student - IT', NULL, 1),
(20, 'studentBA', '$2y$10$jPWukMx3xBTN6AnOU2NV7OksT9M7Y7IneUuh/yyqqcXC6kHutM15u', 'studentBA@a.com', NULL, NULL, 2, 2, 'Student - Business', NULL, 1),
(22, 'guestIT', '$2y$10$9TRsAN.Sj76Tm0K1KELO2uubPLP9dDucfqO81rihoLl7SNoOAFIXm', 'guestIT@a.com', NULL, NULL, 1, 5, 'Guest - IT', NULL, 1),
(23, 'guestBA', '$2y$10$O8kHVSRpGy9D0jtKk2EpM.iBVzxsvZ9lejD/u1TfoBIAhe2BkkLny', 'guestBA@a.com', NULL, NULL, 2, 5, 'Guest - BA', NULL, 1),
(25, 'manager', '$2y$10$DE8pat/9FM9C/21sGLN.we1tugqAaNe6dK4353vZv4z06M/iHyQ3a', 'Marketing-manager@a.com', NULL, NULL, 1, 4, 'Marketing Manager', NULL, 1),
(29, 'LuanGCC', '$2y$10$0OECJ4sKccrJ5RbM4nB4.ObY4Dm38W2q3ElLvBP/.JTRpcK8gHVAy', 'luanncgcc200222@fpt.edu.vn', NULL, NULL, 1, 2, 'LuanNC', NULL, 1);
=======
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
>>>>>>> b39f62423b78a1b2a83dce1792d1fa4584f91fd7

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
<<<<<<< HEAD
  MODIFY `articleId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;
=======
  MODIFY `articleId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
>>>>>>> b39f62423b78a1b2a83dce1792d1fa4584f91fd7

--
-- AUTO_INCREMENT cho bảng `comments`
--
ALTER TABLE `comments`
<<<<<<< HEAD
  MODIFY `commentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
=======
  MODIFY `commentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
>>>>>>> b39f62423b78a1b2a83dce1792d1fa4584f91fd7

--
-- AUTO_INCREMENT cho bảng `faculties`
--
ALTER TABLE `faculties`
<<<<<<< HEAD
  MODIFY `facultyId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
=======
  MODIFY `facultyId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
>>>>>>> b39f62423b78a1b2a83dce1792d1fa4584f91fd7

--
-- AUTO_INCREMENT cho bảng `files`
--
ALTER TABLE `files`
<<<<<<< HEAD
  MODIFY `fileId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;
=======
  MODIFY `fileId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
>>>>>>> b39f62423b78a1b2a83dce1792d1fa4584f91fd7

--
-- AUTO_INCREMENT cho bảng `magazine`
--
ALTER TABLE `magazine`
<<<<<<< HEAD
  MODIFY `magazineId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
=======
  MODIFY `magazineId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
>>>>>>> b39f62423b78a1b2a83dce1792d1fa4584f91fd7

--
-- AUTO_INCREMENT cho bảng `roles`
--
ALTER TABLE `roles`
<<<<<<< HEAD
  MODIFY `roleId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
=======
  MODIFY `roleId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
>>>>>>> b39f62423b78a1b2a83dce1792d1fa4584f91fd7

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
<<<<<<< HEAD
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
=======
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
>>>>>>> b39f62423b78a1b2a83dce1792d1fa4584f91fd7

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
