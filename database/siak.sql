-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2018 at 11:54 AM
-- Server version: 5.6.14
-- PHP Version: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `siak`
--

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

CREATE TABLE IF NOT EXISTS `akun` (
  `no_akun` varchar(2) NOT NULL,
  `nama_akun` varchar(20) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`no_akun`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`no_akun`, `nama_akun`, `keterangan`, `status`) VALUES
('11', 'Kas', 'Saldo', '1'),
('12', 'Piutang', 'Pinjaman uang dari luar ke perusahaan.', '1'),
('13', 'Perlengkapan', 'Perlengkapan dagangan.', '1'),
('14', 'Sewa dibayar dimuka.', 'Pembayaran sewa.', '1'),
('15', 'Peralatan', 'Rumah, Mobil, Alat Kantor, etc.', '1'),
('19', 'Akumulasi Penyusutan', '', '1'),
('21', 'Hutang Dagang', '', '1'),
('31', 'Modal', 'Modal usaha', '1'),
('32', 'Prive', '', '1'),
('41', 'Pendapatan', '', '1');

-- --------------------------------------------------------

--
-- Table structure for table `buku_besar`
--

CREATE TABLE IF NOT EXISTS `buku_besar` (
  `no_index` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` datetime NOT NULL,
  `no_akun` int(11) NOT NULL,
  `no_transaksi` int(11) NOT NULL,
  `no_periode` int(11) NOT NULL,
  `total` decimal(13,2) NOT NULL,
  PRIMARY KEY (`no_index`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `buku_besar`
--

INSERT INTO `buku_besar` (`no_index`, `tanggal`, `no_akun`, `no_transaksi`, `no_periode`, `total`) VALUES
(19, '2018-01-20 12:42:11', 11, 27, 1, '50000000.00'),
(20, '2018-01-20 12:42:40', 31, 28, 1, '-50000000.00'),
(21, '2018-01-20 12:45:56', 11, 29, 1, '52500000.00'),
(22, '2018-01-20 12:46:44', 41, 30, 1, '-2500000.00');

-- --------------------------------------------------------

--
-- Table structure for table `jurnal`
--

CREATE TABLE IF NOT EXISTS `jurnal` (
  `no_transaksi` int(10) NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  `no_periode` int(11) NOT NULL,
  `no_akun` varchar(2) NOT NULL,
  `nama_akun` varchar(20) NOT NULL,
  `uraian` varchar(50) NOT NULL,
  `debet` decimal(13,2) NOT NULL,
  `kredit` decimal(13,2) NOT NULL,
  PRIMARY KEY (`no_transaksi`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `jurnal`
--

INSERT INTO `jurnal` (`no_transaksi`, `tanggal`, `no_periode`, `no_akun`, `nama_akun`, `uraian`, `debet`, `kredit`) VALUES
(27, '2018-01-20', 1, '11', 'Kas', 'Modal Awal', '50000000.00', '0.00'),
(28, '2018-01-20', 1, '31', 'Modal', 'Modal Awal', '0.00', '50000000.00'),
(29, '2018-01-20', 1, '11', 'Kas', 'Pemasukan Awal', '2500000.00', '0.00'),
(30, '2018-01-20', 1, '41', 'Pendapatan', 'Pemasukan Awal', '0.00', '2500000.00');

-- --------------------------------------------------------

--
-- Table structure for table `jurnal_penyesuaian`
--

CREATE TABLE IF NOT EXISTS `jurnal_penyesuaian` (
  `no_transaksi` int(10) NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  `no_periode` int(11) NOT NULL,
  `no_akun` int(11) NOT NULL,
  `nama_akun` varchar(20) NOT NULL,
  `uraian` varchar(50) NOT NULL,
  `debet` decimal(13,2) NOT NULL,
  `kredit` decimal(13,2) NOT NULL,
  PRIMARY KEY (`no_transaksi`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `periode`
--

CREATE TABLE IF NOT EXISTS `periode` (
  `no_periode` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `status_closing` tinyint(4) NOT NULL,
  PRIMARY KEY (`no_periode`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `periode`
--

INSERT INTO `periode` (`no_periode`, `tanggal_mulai`, `tanggal_selesai`, `status_closing`) VALUES
(1, '2018-01-01', '2018-08-01', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
