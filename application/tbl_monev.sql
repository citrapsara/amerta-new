-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 04, 2021 at 12:42 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `emandalika`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_monev`
--

CREATE TABLE `tbl_monev` (
  `id_monev` int(10) NOT NULL,
  `lamp_scan_kuesioner` text DEFAULT NULL,
  `lamp_ttd` text DEFAULT NULL,
  `lamp_foto1` text DEFAULT NULL,
  `lamp_foto2` text DEFAULT NULL,
  `lamp_foto3` text DEFAULT NULL,
  `notaris` int(10) DEFAULT NULL,
  `status` enum('proses','konfirmasi','selesai') DEFAULT NULL,
  `pesan_petugas` text DEFAULT NULL,
  `file_petugas` text DEFAULT NULL,
  `tgl_laporan` datetime DEFAULT NULL,
  `tgl_konfirmasi` datetime DEFAULT NULL,
  `tgl_selesai` datetime DEFAULT NULL,
  `no_permohonan` text DEFAULT NULL,
  `nama_client` text DEFAULT NULL,
  `tgl_kegiatan` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_monev`
--

INSERT INTO `tbl_monev` (`id_monev`, `lamp_scan_kuesioner`, `lamp_ttd`, `lamp_foto1`, `lamp_foto2`, `lamp_foto3`, `notaris`, `status`, `pesan_petugas`, `file_petugas`, `tgl_laporan`, `tgl_konfirmasi`, `tgl_selesai`, `no_permohonan`, `nama_client`, `tgl_kegiatan`) VALUES
(160, 'file/monev/Jadwal_Piket_Gerbang_Kota_Mataram_Juli_2021.pdf', 'file/monev/004-safari-browser-navigator-presentation-screen-web-psd9.jpg', 'file/monev/004-safari-browser-navigator-presentation-screen-web-psd10.jpg', 'file/monev/004-safari-browser-navigator-presentation-screen-web-psd11.jpg', 'file/monev/004-safari-browser-navigator-presentation-screen-web-psd12.jpg', 368, 'konfirmasi', 'Sedang diperiksa', NULL, '2021-07-14 08:10:03', NULL, '2021-07-14 08:10:54', '123456789', 'Budi', '2021-07-12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_monev`
--
ALTER TABLE `tbl_monev`
  ADD PRIMARY KEY (`id_monev`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_monev`
--
ALTER TABLE `tbl_monev`
  MODIFY `id_monev` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=161;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
