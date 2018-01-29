-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 29, 2018 at 12:22 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 5.6.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `siak`
--

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

CREATE TABLE `akun` (
  `no_akun` varchar(2) NOT NULL,
  `nama_akun` varchar(20) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`no_akun`, `nama_akun`, `keterangan`, `status`) VALUES
('11', 'Kas', 'Saldo tabungan', '1'),
('12', 'Piutang', 'Pinjaman uang dari luar ke perusahaan.', '1'),
('13', 'Perlengkapan', 'Perlengkapan dagangan.', '1'),
('14', 'Sewa dibayar dimuka.', 'Pembayaran sewa.', '1'),
('15', 'Peralatan', 'Rumah, Mobil, Alat Kantor, etc.', '1'),
('19', 'Akumulasi Penyusutan', '', '1'),
('21', 'Hutang Dagang', '', '1'),
('31', 'Modal', 'Modal usaha', '1'),
('32', 'Prive', '', '1'),
('41', 'Pendapatan', '', '1'),
('51', 'Beban Perlengkapan', '', '1'),
('52', 'Beban Gaji', '', '1'),
('53', 'Beban Sewa', '', '1'),
('54', 'Beban Listrik', '', '1'),
('55', 'Beban Telepon', '', '1'),
('56', 'Beban Air', '', '1'),
('57', 'Beban Penyusutan', '', '1'),
('58', 'Beban Rupa-rupa', '', '1');

-- --------------------------------------------------------

--
-- Table structure for table `buku_besar`
--

CREATE TABLE `buku_besar` (
  `no_index` int(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `no_akun` int(11) NOT NULL,
  `no_transaksi` int(11) NOT NULL,
  `no_periode` int(11) NOT NULL,
  `total` decimal(13,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Table structure for table `buku_penyesuaian`
--

CREATE TABLE `buku_penyesuaian` (
  `no_index` int(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `no_akun` int(11) NOT NULL,
  `no_transaksi` int(11) NOT NULL,
  `no_periode` int(11) NOT NULL,
  `total` decimal(13,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jurnal`
--

CREATE TABLE `jurnal` (
  `no_transaksi` int(10) NOT NULL,
  `tanggal` date NOT NULL,
  `no_periode` int(11) NOT NULL,
  `no_akun` varchar(2) NOT NULL,
  `nama_akun` varchar(20) NOT NULL,
  `uraian` varchar(50) NOT NULL,
  `debet` decimal(13,2) NOT NULL,
  `kredit` decimal(13,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `jurnal_penyesuaian` (
  `no_transaksi` int(10) NOT NULL,
  `tanggal` date NOT NULL,
  `no_periode` int(11) NOT NULL,
  `no_akun` int(11) NOT NULL,
  `nama_akun` varchar(20) NOT NULL,
  `uraian` varchar(50) NOT NULL,
  `debet` decimal(13,2) NOT NULL,
  `kredit` decimal(13,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `periode`
--

CREATE TABLE `periode` (
  `no_periode` int(11) NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `status_closing` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `periode`
--

INSERT INTO `periode` (`no_periode`, `tanggal_mulai`, `tanggal_selesai`, `status_closing`) VALUES
(1, '2018-01-01', '2018-08-01', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`no_akun`);

--
-- Indexes for table `buku_besar`
--
ALTER TABLE `buku_besar`
  ADD PRIMARY KEY (`no_index`);

--
-- Indexes for table `buku_penyesuaian`
--
ALTER TABLE `buku_penyesuaian`
  ADD PRIMARY KEY (`no_index`);

--
-- Indexes for table `jurnal`
--
ALTER TABLE `jurnal`
  ADD PRIMARY KEY (`no_transaksi`);

--
-- Indexes for table `jurnal_penyesuaian`
--
ALTER TABLE `jurnal_penyesuaian`
  ADD PRIMARY KEY (`no_transaksi`);

--
-- Indexes for table `periode`
--
ALTER TABLE `periode`
  ADD PRIMARY KEY (`no_periode`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buku_besar`
--
ALTER TABLE `buku_besar`
  MODIFY `no_index` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `buku_penyesuaian`
--
ALTER TABLE `buku_penyesuaian`
  MODIFY `no_index` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jurnal`
--
ALTER TABLE `jurnal`
  MODIFY `no_transaksi` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `jurnal_penyesuaian`
--
ALTER TABLE `jurnal_penyesuaian`
  MODIFY `no_transaksi` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `periode`
--
ALTER TABLE `periode`
  MODIFY `no_periode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
