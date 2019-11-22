-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 22, 2019 at 11:21 AM
-- Server version: 5.7.27-0ubuntu0.16.04.1
-- PHP Version: 7.2.23-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_kerjalancer`
--

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `id_applications` int(11) NOT NULL,
  `description` longtext NOT NULL,
  `document` varchar(512) NOT NULL,
  `apply_create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `apply_update_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_freelancer` int(11) NOT NULL,
  `id_job` int(11) NOT NULL,
  `accepted` tinyint(1) NOT NULL DEFAULT '0',
  `flag` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`id_applications`, `description`, `document`, `apply_create_date`, `apply_update_date`, `id_freelancer`, `id_job`, `accepted`, `flag`) VALUES
(1, 'Saya melamar pekerjaan ini.', 'uploads/documents/201220181318461741720031_Muhammad_Aliyul_Murtadlo_JS2.pdf', '2018-12-20 13:18:46', '2019-09-04 08:21:45', 3, 1, 0, 0),
(2, 'Saya ingin melamar.', 'uploads/documents/2012201817450320181003104342_Modul_4_-_Protokol_Lapisan_Aplikasi.pdf', '2018-12-20 17:45:03', '2018-12-20 19:04:23', 4, 1, 0, 0),
(3, 'Saya ingin melamar.', 'uploads/documents/201220181913171741720031_Muhammad_Aliyul_Murtadlo_JS2.pdf', '2018-12-20 19:13:17', '2018-12-20 19:13:20', 4, 1, 0, 0),
(4, 'Saya ingin melamar.', 'uploads/documents/201220181915161741720031_Muhammad_Aliyul_Murtadlo_JS2.pdf', '2018-12-20 19:15:16', '2018-12-20 19:15:28', 4, 1, 0, 0),
(5, 'Saya ingin melamar pekerjaan ini.', 'uploads/documents/20122018214702Basis_Data_Lanjut_JS8.pdf', '2018-12-20 21:47:02', '2018-12-20 21:47:02', 3, 1, 0, 1),
(6, 'Saya ingin melamar pekerjaan ini.', 'uploads/documents/2112201809081220181003104342_Modul_4_-_Protokol_Lapisan_Aplikasi.pdf', '2018-12-21 09:08:12', '2018-12-21 09:08:12', 4, 1, 0, 1),
(7, 'Ini lamaran saya', 'uploads/documents/2005201912453815.06.118_jurnal_eproc.pdf', '2019-05-20 12:45:38', '2019-05-20 12:45:38', 3, 2, 0, 1),
(8, 'gbgbgg', 'uploads/documents/2005201913314015.06.118_jurnal_eproc.pdf', '2019-05-20 13:31:40', '2019-05-20 13:31:40', 3, 3, 0, 1),
(9, 'asda', 'uploads/documents/16102019084432Komitmen.pdf', '2019-10-16 08:44:32', '2019-10-16 08:44:32', 3, 5, 0, 1),
(10, 'asndmbsa', 'uploads/documents/30102019074710[TI_3F]_DW_JS_04_17_1741720031.pdf', '2019-10-30 07:47:10', '2019-10-30 07:47:10', 3, 7, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id_category` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id_category`, `category_name`, `category_image`) VALUES
(1, 'Pengembangan Aplikasi Mobile', 'images/mobile.svg'),
(2, 'Pengembangan Website', 'images/web.svg'),
(3, 'Desain & Multimedia', 'images/desain.svg'),
(4, 'Entri Data', 'images/entri-data.svg'),
(5, 'Lainnya', 'images/lainnya.svg');

-- --------------------------------------------------------

--
-- Table structure for table `job`
--

CREATE TABLE `job` (
  `id_job` int(11) NOT NULL,
  `job_name` varchar(255) NOT NULL,
  `job_description` longtext NOT NULL,
  `job_salary` bigint(20) NOT NULL,
  `apply_expire_date` date NOT NULL,
  `job_create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `job_update_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_user` int(11) NOT NULL,
  `id_category` int(11) NOT NULL,
  `flag` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `job`
--

INSERT INTO `job` (`id_job`, `job_name`, `job_description`, `job_salary`, `apply_expire_date`, `job_create_date`, `job_update_date`, `id_user`, `id_category`, `flag`) VALUES
(1, 'Membuat Aplikasi Website Dinamis', 'Saya ingin aplikasi website seperti sebangsa.com yang mana itu adalah web media sosial.', 5000000, '2018-12-25', '2018-12-20 13:05:48', '2019-10-30 07:48:49', 2, 2, 0),
(2, 'Desain Poster Event', 'Membuat desain poster untuk event', 300000, '2019-05-31', '2019-05-20 12:44:24', '2019-10-30 07:48:52', 2, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `job_has_skills`
--

CREATE TABLE `job_has_skills` (
  `id_job` int(11) NOT NULL,
  `id_skill` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `job_has_skills`
--

INSERT INTO `job_has_skills` (`id_job`, `id_skill`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 5),
(1, 6),
(1, 15),
(1, 18),
(2, 8),
(2, 9),
(2, 10),
(3, 1),
(3, 2),
(4, 1),
(4, 2),
(4, 3),
(4, 4),
(4, 5),
(5, 6),
(6, 6),
(7, 1),
(7, 3);

-- --------------------------------------------------------

--
-- Table structure for table `portfolio`
--

CREATE TABLE `portfolio` (
  `id_portfolio` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `attachment` varchar(512) NOT NULL,
  `portfolio_create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `portfolio_update_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_user` int(11) NOT NULL,
  `flag` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `portfolio`
--

INSERT INTO `portfolio` (`id_portfolio`, `title`, `description`, `attachment`, `portfolio_create_date`, `portfolio_update_date`, `id_user`, `flag`) VALUES
(1, 'Desain Poster Event', 'Ini portfolio pertama saya', 'uploads/images/201220181341026c408f49-a3c5-4117-9577-bbb726f1bf4c.jpeg', '2018-12-20 13:41:02', '2018-12-21 05:06:39', 3, 1),
(2, 'Mock Up Web App', 'Mock Up Web App', 'uploads/images/20122018174702dribbble_shot_copy_2x.png', '2018-12-20 17:47:02', '2018-12-20 19:08:30', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `skill`
--

CREATE TABLE `skill` (
  `id_skill` int(11) NOT NULL,
  `nama_skill` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `skill`
--

INSERT INTO `skill` (`id_skill`, `nama_skill`) VALUES
(1, 'HTML'),
(2, 'PHP'),
(3, 'JavaScript'),
(4, 'Java'),
(5, 'Laravel'),
(6, 'NodeJS'),
(7, 'Menulis'),
(8, 'Adobe Photoshop'),
(9, 'Corel Draw'),
(10, 'Adobe Illustrator'),
(11, 'Data Sience'),
(12, 'Kotlin'),
(13, 'Mobile'),
(14, 'Microsoft Office'),
(15, 'NoSQL'),
(16, 'SQL'),
(17, 'MySQL'),
(18, 'MongoDB'),
(19, 'Lainnya');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(45) NOT NULL,
  `profile_picture` varchar(512) NOT NULL DEFAULT 'images/user.png',
  `user_create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_update_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `description` varchar(255) DEFAULT 'Belum ada bio.',
  `level` int(11) NOT NULL,
  `flag` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `name`, `email`, `username`, `password`, `phone`, `profile_picture`, `user_create_date`, `user_update_date`, `description`, `level`, `flag`) VALUES
(1, 'Administrator', 'admin@kerjalancer.id', 'admin', 'admin', '089877872645', 'images/user.png', '2018-12-20 12:57:53', '2018-12-21 09:05:10', '', 1, 1),
(2, 'Client Abadi', 'client@kerjalancer.id', 'client', 'client', '089877872645', 'images/user.png', '2018-12-20 12:58:40', '2019-10-16 10:06:28', '-', 2, 1),
(3, 'Freelancer Abadi', 'freelancer@kerjalancer.id', 'freelancer', 'freelancer', '089877872645', 'uploads/images/20122018131515python.png', '2018-12-20 12:59:18', '2018-12-21 10:28:30', 'Belum ada bio.', 3, 1),
(4, 'Muhammad Aliyul Murtadlo', 'muhammadaliyulm@gmail.com', 'mmdiyul', 'tahun2014', '089877872645', 'images/user.png', '2018-12-20 17:44:25', '2018-12-21 01:26:59', 'Belum ada bio.', 3, 1),
(5, 'John Doe', 'john@doe.id', 'johndoe', 'johndoe', '089877872645', 'images/user.png', '2018-12-21 00:42:38', '2018-12-21 01:28:08', 'Belum ada bio.', 1, 1),
(6, 'John Doe', 'john@does.id', 'johndoe2', '12345678', '0898998998', 'images/user.png', '2019-05-20 13:22:40', '2019-05-20 13:22:40', 'Belum ada bio.', 2, 1),
(7, 'hello', 'hello@hello.com', 'hello123', 'hello123', '1928712', 'images/user.png', '2019-10-16 10:09:19', '2019-10-16 10:09:19', 'Belum ada bio.', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_has_skills`
--

CREATE TABLE `user_has_skills` (
  `id_user` int(11) NOT NULL,
  `id_skill` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_has_skills`
--

INSERT INTO `user_has_skills` (`id_user`, `id_skill`) VALUES
(4, 1),
(4, 2),
(4, 3),
(4, 5),
(4, 6),
(4, 16),
(4, 17),
(3, 1),
(3, 2),
(3, 3),
(3, 4),
(3, 5),
(3, 6),
(3, 11),
(3, 13),
(3, 15),
(3, 16),
(3, 17),
(3, 18);

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `id_type` int(11) NOT NULL,
  `type` varchar(455) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`id_type`, `type`) VALUES
(1, 'admin'),
(2, 'client'),
(3, 'freelancer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`id_applications`),
  ADD KEY `fk_applications_user1_idx` (`id_freelancer`),
  ADD KEY `fk_applications_job1_idx` (`id_job`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id_category`);

--
-- Indexes for table `job`
--
ALTER TABLE `job`
  ADD PRIMARY KEY (`id_job`),
  ADD KEY `fk_job_user1_idx` (`id_user`),
  ADD KEY `fk_job_category1_idx` (`id_category`);

--
-- Indexes for table `job_has_skills`
--
ALTER TABLE `job_has_skills`
  ADD KEY `id_job` (`id_job`),
  ADD KEY `id_skill` (`id_skill`);

--
-- Indexes for table `portfolio`
--
ALTER TABLE `portfolio`
  ADD PRIMARY KEY (`id_portfolio`),
  ADD KEY `fk_portfolio_user1_idx` (`id_user`);

--
-- Indexes for table `skill`
--
ALTER TABLE `skill`
  ADD PRIMARY KEY (`id_skill`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `fk_user_user_type1_idx` (`level`);

--
-- Indexes for table `user_has_skills`
--
ALTER TABLE `user_has_skills`
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_skill` (`id_skill`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`id_type`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `id_applications` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `job`
--
ALTER TABLE `job`
  MODIFY `id_job` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `portfolio`
--
ALTER TABLE `portfolio`
  MODIFY `id_portfolio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `skill`
--
ALTER TABLE `skill`
  MODIFY `id_skill` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `id_type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `applications`
--
ALTER TABLE `applications`
  ADD CONSTRAINT `fk_applications_job1` FOREIGN KEY (`id_job`) REFERENCES `job` (`id_job`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_applications_user1` FOREIGN KEY (`id_freelancer`) REFERENCES `user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `job`
--
ALTER TABLE `job`
  ADD CONSTRAINT `fk_job_category1` FOREIGN KEY (`id_category`) REFERENCES `category` (`id_category`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_job_user1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `job_has_skills`
--
ALTER TABLE `job_has_skills`
  ADD CONSTRAINT `job_has_skills_ibfk_1` FOREIGN KEY (`id_job`) REFERENCES `job` (`id_job`),
  ADD CONSTRAINT `job_has_skills_ibfk_2` FOREIGN KEY (`id_skill`) REFERENCES `skill` (`id_skill`);

--
-- Constraints for table `portfolio`
--
ALTER TABLE `portfolio`
  ADD CONSTRAINT `fk_portfolio_user1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_user_type1` FOREIGN KEY (`level`) REFERENCES `user_type` (`id_type`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user_has_skills`
--
ALTER TABLE `user_has_skills`
  ADD CONSTRAINT `user_has_skills_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `user_has_skills_ibfk_2` FOREIGN KEY (`id_skill`) REFERENCES `skill` (`id_skill`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
