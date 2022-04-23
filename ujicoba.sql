-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2022 at 03:33 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ujicoba`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `password`) VALUES
(7, 'ilham', '$2y$10$4A8/Qb6.0vPB0S34FfDZpeKTYV..m8kCuFB6oDSbM4l0QOhOzUUey');

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `barang_id` int(11) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `harga_barang` int(6) NOT NULL,
  `jenis_barang_id` int(3) NOT NULL,
  `foto_barang` varchar(50) NOT NULL,
  `berat_barang` int(6) NOT NULL,
  `status_barang_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`barang_id`, `nama_barang`, `harga_barang`, `jenis_barang_id`, `foto_barang`, `berat_barang`, `status_barang_id`) VALUES
(36, 'cookies singkong cheese sago', 35000, 1, 'cookies_singkong_cheese_sago_225_gram.jpg', 225, 1),
(37, 'cookies singkong chocolate chip', 35000, 1, 'cookies_singkong_chocolate_chip_225_gram.jpg', 225, 1),
(38, 'cookies singkong chocostick', 50000, 1, 'cookies_singkong_chocostick_250_gram.jpg', 250, 1),
(39, 'cookies singkong edamame', 40000, 1, 'cookies_singkong_edamame 225 gram.jpg', 225, 1),
(40, 'cookies singkong nastar', 45000, 1, 'cookies_singkong_nastar_225_gram.jpg', 225, 1),
(41, 'cookies singkong palm cheese', 45000, 1, 'cookies_singkong_palm_cheese_225_gram.jpg', 225, 1),
(42, 'cookies singkong snowball', 38000, 1, 'cookies_singkong_snowball_225_gram.jpg', 225, 1);

-- --------------------------------------------------------

--
-- Table structure for table `detail_penjualan`
--

CREATE TABLE `detail_penjualan` (
  `detail_penjualan_id` int(11) NOT NULL,
  `penjualan_id` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `jumlah_barang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_penjualan`
--

INSERT INTO `detail_penjualan` (`detail_penjualan_id`, `penjualan_id`, `barang_id`, `jumlah_barang`) VALUES
(1, 1, 36, 2),
(2, 2, 36, 23),
(3, 2, 38, 4),
(4, 3, 42, 10),
(5, 4, 38, 3);

-- --------------------------------------------------------

--
-- Table structure for table `jenis_barang`
--

CREATE TABLE `jenis_barang` (
  `jenis_barang_id` int(11) NOT NULL,
  `nama_jenis_barang` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jenis_barang`
--

INSERT INTO `jenis_barang` (`jenis_barang_id`, `nama_jenis_barang`) VALUES
(1, 'cookies'),
(3, 'kopi');

-- --------------------------------------------------------

--
-- Table structure for table `pembeli`
--

CREATE TABLE `pembeli` (
  `pembeli_id` int(11) NOT NULL,
  `nama_pembeli` varchar(20) NOT NULL,
  `alamat_pembeli` varchar(100) NOT NULL,
  `no_telp_pembeli` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembeli`
--

INSERT INTO `pembeli` (`pembeli_id`, `nama_pembeli`, `alamat_pembeli`, `no_telp_pembeli`) VALUES
(1, 'pembeli pertama', 'Jl Otto Iskandardinata 588 B, Jawa Barat\r\nJawa Barat, Bandung, 40242', '08123456789'),
(2, 'pembeli kedua', 'Jl Jend A Yani 10, Dki Jakarta\r\nDki Jakarta, Jakarta, 13230', '08123456789'),
(12, '123123', '123132', '213'),
(13, 'qweew', '123123', '123213'),
(14, 'qeqe', 'e3q4', 'q3eqe'),
(15, 'bambang', '123', '123');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `penjualan_id` int(11) NOT NULL,
  `pembeli_id` int(11) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`penjualan_id`, `pembeli_id`, `tanggal`) VALUES
(1, 2, '2022-04-03'),
(2, 1, '2022-04-10'),
(3, 2, '2022-04-09'),
(4, 2, '2022-04-06');

-- --------------------------------------------------------

--
-- Table structure for table `status_barang`
--

CREATE TABLE `status_barang` (
  `status_barang_id` int(11) NOT NULL,
  `nama_status` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `status_barang`
--

INSERT INTO `status_barang` (`status_barang_id`, `nama_status`) VALUES
(1, 'normal'),
(2, 'rekomendasi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`barang_id`),
  ADD KEY `jenis_barang_id` (`jenis_barang_id`),
  ADD KEY `FK_status_id` (`status_barang_id`);

--
-- Indexes for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  ADD PRIMARY KEY (`detail_penjualan_id`),
  ADD KEY `FK_pembelian_id` (`penjualan_id`),
  ADD KEY `FK_barang_id` (`barang_id`);

--
-- Indexes for table `jenis_barang`
--
ALTER TABLE `jenis_barang`
  ADD PRIMARY KEY (`jenis_barang_id`);

--
-- Indexes for table `pembeli`
--
ALTER TABLE `pembeli`
  ADD PRIMARY KEY (`pembeli_id`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`penjualan_id`),
  ADD KEY `FK_pembeli_id` (`pembeli_id`);

--
-- Indexes for table `status_barang`
--
ALTER TABLE `status_barang`
  ADD PRIMARY KEY (`status_barang_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `barang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  MODIFY `detail_penjualan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `jenis_barang`
--
ALTER TABLE `jenis_barang`
  MODIFY `jenis_barang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pembeli`
--
ALTER TABLE `pembeli`
  MODIFY `pembeli_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `penjualan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `status_barang`
--
ALTER TABLE `status_barang`
  MODIFY `status_barang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `FK_status_id` FOREIGN KEY (`status_barang_id`) REFERENCES `status_barang` (`status_barang_id`),
  ADD CONSTRAINT `jenis_barang_id` FOREIGN KEY (`jenis_barang_id`) REFERENCES `jenis_barang` (`jenis_barang_id`);

--
-- Constraints for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  ADD CONSTRAINT `FK_barang_id` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`barang_id`),
  ADD CONSTRAINT `FK_pembelian_id` FOREIGN KEY (`penjualan_id`) REFERENCES `penjualan` (`penjualan_id`);

--
-- Constraints for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD CONSTRAINT `FK_pembeli_id` FOREIGN KEY (`pembeli_id`) REFERENCES `pembeli` (`pembeli_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
