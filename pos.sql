-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2024 at 05:05 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `brg_keluar`
--

CREATE TABLE `brg_keluar` (
  `id` int(11) NOT NULL,
  `tgl` timestamp NOT NULL DEFAULT current_timestamp(),
  `idbarang` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `penerima` varchar(35) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brg_keluar`
--

INSERT INTO `brg_keluar` (`id`, `tgl`, `idbarang`, `jumlah`, `penerima`) VALUES
(33, '2024-05-13 06:47:36', 249, 1, '11tnefNKVkMf6'),
(34, '2024-05-13 06:55:33', 250, 1, '11tnefNKVkMf6'),
(35, '2024-05-13 07:00:50', 250, 5, '12soCjxijsrDM');

-- --------------------------------------------------------

--
-- Table structure for table `brg_masuk`
--

CREATE TABLE `brg_masuk` (
  `id` int(11) NOT NULL,
  `tgl` date NOT NULL,
  `idbarang` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customerid` int(11) NOT NULL,
  `customername` varchar(50) NOT NULL,
  `customerphone` varchar(20) NOT NULL,
  `customeraddress` varchar(100) NOT NULL,
  `customeremail` varchar(30) NOT NULL,
  `customerjoin` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customerid`, `customername`, `customerphone`, `customeraddress`, `customeremail`, `customerjoin`) VALUES
(3, 'raga nugraha', '085566771122', 'perumahan gryan bukit jaya. blok s3. no1', 'raganugraha123@gmail.com', '2024-05-13 06:44:52'),
(4, 'Nias DK depok', '098765412345', 'citayam raya', 'nias@gmail.com', '2024-05-13 06:54:37'),
(5, 'RAGA SAMBO', '0812345678', 'cikeas', 'ragakece123@gmail.com', '2024-05-13 06:58:53');

-- --------------------------------------------------------

--
-- Table structure for table `detpo`
--

CREATE TABLE `detpo` (
  `detid` int(11) NOT NULL,
  `orderid` varchar(50) NOT NULL,
  `id` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detpo`
--

INSERT INTO `detpo` (`detid`, `orderid`, `id`, `qty`) VALUES
(10, '11tnefNKVkMf6', 249, 1),
(11, '11tnefNKVkMf6', 250, 1),
(12, '12soCjxijsrDM', 250, 5);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `staffid` int(11) NOT NULL,
  `username` varchar(35) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`staffid`, `username`, `password`) VALUES
(14, 'chepy', '$2y$10$AyneeoGsE.wMS9c2lHOQWOh2qZ39iQ/7Z61mE0G38i8t.hWrUFzGG'),
(15, 'bryan', '$2y$10$.0nx.ax3mBcYEjiuIEvG6u98z70QbE8lwqpn57EXUELZub6tBIDBi');

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` int(11) NOT NULL,
  `contents` text NOT NULL,
  `admin` varchar(20) NOT NULL,
  `status` varchar(8) NOT NULL DEFAULT 'aktif'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `po`
--

CREATE TABLE `po` (
  `idid` int(11) NOT NULL,
  `orderid` varchar(50) NOT NULL,
  `customerid` int(11) NOT NULL,
  `tglorder` timestamp NOT NULL DEFAULT current_timestamp(),
  `payment` varchar(25) NOT NULL DEFAULT 'Belum ditentukan',
  `status` varchar(20) NOT NULL,
  `notes` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `po`
--

INSERT INTO `po` (`idid`, `orderid`, `customerid`, `tglorder`, `payment`, `status`, `notes`) VALUES
(5, '11tnefNKVkMf6', 3, '2024-05-13 06:47:22', 'transfer', 'Completed', ''),
(6, '12soCjxijsrDM', 5, '2024-05-13 07:00:17', 'cash', 'Completed', '');

-- --------------------------------------------------------

--
-- Table structure for table `stock_brg`
--

CREATE TABLE `stock_brg` (
  `id` int(11) NOT NULL,
  `nama` varchar(55) NOT NULL,
  `jenis` varchar(30) NOT NULL,
  `stock` int(12) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock_brg`
--

INSERT INTO `stock_brg` (`id`, `nama`, `jenis`, `stock`, `harga`) VALUES
(249, 'plastik pp 60x100', 'plastik', 99, 15000),
(250, 'mayonaise mamayo 1kg', 'saus ', 19, 35000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brg_keluar`
--
ALTER TABLE `brg_keluar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brg_masuk`
--
ALTER TABLE `brg_masuk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customerid`);

--
-- Indexes for table `detpo`
--
ALTER TABLE `detpo`
  ADD PRIMARY KEY (`detid`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`staffid`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `po`
--
ALTER TABLE `po`
  ADD PRIMARY KEY (`idid`);

--
-- Indexes for table `stock_brg`
--
ALTER TABLE `stock_brg`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brg_keluar`
--
ALTER TABLE `brg_keluar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `brg_masuk`
--
ALTER TABLE `brg_masuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customerid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `detpo`
--
ALTER TABLE `detpo`
  MODIFY `detid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `staffid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `po`
--
ALTER TABLE `po`
  MODIFY `idid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `stock_brg`
--
ALTER TABLE `stock_brg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=251;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
