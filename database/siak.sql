-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 16, 2018 at 06:07 PM
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
-- Table structure for table `jurnal`
--

CREATE TABLE IF NOT EXISTS `jurnal` (
  `no_transaksi` int(10) NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  `no_periode` int(11) NOT NULL,
  `no_akun` varchar(2) NOT NULL,
  `nama_akun` varchar(20) NOT NULL,
  `uraian` varchar(50) NOT NULL,
  `debet` float NOT NULL,
  `kredit` float NOT NULL,
  PRIMARY KEY (`no_transaksi`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `jurnal`
--

INSERT INTO `jurnal` (`no_transaksi`, `tanggal`, `no_periode`, `no_akun`, `nama_akun`, `uraian`, `debet`, `kredit`) VALUES
(1, '2018-01-14', 1, '31', 'Modal', 'Modal Awal', 0, 5000000000),
(2, '2018-01-14', 1, '11', 'Kas', '', 5000000000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `jurnal_penyesuaian`
--

CREATE TABLE IF NOT EXISTS `jurnal_penyesuaian` (
  `no_transaksi` int(10) NOT NULL,
  `tanggal` date NOT NULL,
  `no_periode` int(11) NOT NULL,
  `no_akun` int(11) NOT NULL,
  `nama_akun` varchar(20) NOT NULL,
  `uraian` varchar(50) NOT NULL,
  `debet` float NOT NULL,
  `kredit` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `periode`
--

INSERT INTO `periode` (`no_periode`, `tanggal_mulai`, `tanggal_selesai`, `status_closing`) VALUES
(1, '2018-01-01', '2019-01-01', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
