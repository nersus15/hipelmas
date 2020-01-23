-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 23, 2020 at 05:36 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hipelmas`
--

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE `anggota` (
  `id` int(11) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `alamat` varchar(250) NOT NULL,
  `jurusan` varchar(100) NOT NULL,
  `pt` varchar(150) NOT NULL,
  `angkatan` varchar(50) NOT NULL,
  `foto` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`id`, `nama`, `alamat`, `jurusan`, `pt`, `angkatan`, `foto`) VALUES
(1, 'Fathurrahman', 'Desa Sukarara, Kec. Sakra Barat, Kab. Lombok Timur', 'S1 Ilkom', 'Universitas Bumigora Mataram', '2017', '5e291351bf8d3.jpg'),
(2, 'dheo kukuh prakoso', 'babakan', 'S1 Ilkom', 'Universitas Bumigora Mataram', '2017', '5e291c7872e59.png'),
(3, 'Kisyfi Yusron', 'Lombok Timur', 'S1 Ilmu Komputer', 'Universitas Bumigora Mataram', '2017', '5e291ca542408.jpeg'),
(4, 'Dimas Trilanang Anggoro', 'Bandung', 'S1 Ilmu Komputer', 'Universitas Bumigora Mataram', '2017', '5e291ceb0ef97.png'),
(5, 'Hendri Jayadi', 'Lombok Timur', 'S1 Ilmu Komputer', 'Universitas Bumigora Mataram', '2017', '5e291d0a18dfe.png'),
(6, 'L. Galuh Haibar Aswandi', 'Lombok Timur', 'S1 Ilmu Komputer', 'Universitas Bumigora Mataram', '2017', '5e291d2bd4651.png');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` varchar(15) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`) VALUES
('5e29127925db8', 'dhio', '$2y$10$E8zJ5b4NEs.4yTopN3K96.56WZ/2PabuSemDjvuTZmys2PmljQGsO');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
