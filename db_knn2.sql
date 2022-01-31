-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 26, 2020 at 07:33 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 5.6.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_knn2`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_klasifikasi`
--

CREATE TABLE `tb_klasifikasi` (
  `id_klasifikasi` int(11) NOT NULL,
  `pendapatan` smallint(3) NOT NULL,
  `asset` smallint(3) NOT NULL,
  `pengeluaran` smallint(3) NOT NULL,
  `status` varchar(6) NOT NULL,
  `periode` varchar(4) NOT NULL,
  `kk` char(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_klasifikasi`
--

INSERT INTO `tb_klasifikasi` (`id_klasifikasi`, `pendapatan`, `asset`, `pengeluaran`, `status`, `periode`, `kk`) VALUES
(1, 9, 54, 9, 'Miskin', '2017', '3505006789200012'),
(3, 14, 41, 15, 'Miskin', '2017', '3505006789200032'),
(4, 9, 180, 9, 'Kaya', '2017', '3505006789200044'),
(6, 15, 103, 11, 'Kaya', '2020', '3505006789200132'),
(7, 0, 32, 8, 'Miskin', '2019', '3505006789200022'),
(8, 14, 41, 11, 'Miskin', '2016', '6789453200076200'),
(13, 9, 180, 9, 'Kaya', '2016', '3505006789200032'),
(14, 12, 1, 0, 'Miskin', '2020', '3505006789200012'),
(16, 14, 200, 9, 'Kaya', '2020', '3505006789200022');

-- --------------------------------------------------------

--
-- Table structure for table `tb_penduduk`
--

CREATE TABLE `tb_penduduk` (
  `kk` char(16) NOT NULL,
  `nama` varchar(25) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `tempat_lahir` varchar(20) NOT NULL,
  `jenkel` varchar(11) NOT NULL,
  `agama` varchar(10) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `pekerjaan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_penduduk`
--

INSERT INTO `tb_penduduk` (`kk`, `nama`, `tanggal_lahir`, `tempat_lahir`, `jenkel`, `agama`, `alamat`, `pekerjaan`) VALUES
('3505006789200012', 'Nardi', '1976-03-10', 'Jakarta', 'Laki - Laki', 'Islam', 'Jl. Padat Karya Komp. Herlina Perkasa Blok. Nusa Indah No.42 RT.2 RW.4', 'Wiraswasta'),
('3505006789200022', 'Mayang Sari', '1983-08-11', 'Banjarmasin', 'Perempuan', 'Kristen', 'Jl. Sungai Andai Komp. Herlina Perkasa Blok. C-D No.76 RT.4 RW.6', 'Ibu Rumah Tangga'),
('3505006789200032', 'Nur Said', '1978-02-09', 'Amuntai', 'Laki - Laki', 'Islam', 'Jl. Padat Karya Komp. Perdana Mandiri Blok. IV No.15 RT.1 RW.2', 'Swasta'),
('3505006789200044', 'Kardi', '1980-09-01', 'Banjarbaru', 'Laki - Laki', 'Hindu', 'Jl. Padat Karya Komp. Purnama Blok. 3 No.31 RT.5 RW.1', 'PNS'),
('3505006789200099', 'Mirna', '1986-05-03', 'Banjarmasin', 'Perempuan', 'Kristen', 'Jl. Padat Karya Komp. Herlina Perkasa Blok. Melati No.80 RT.1 RW.4', 'Wiraswasta'),
('3505006789200132', 'Bayu Setiawan', '1982-09-11', 'Kandangan', 'Laki - Laki', 'Islam', 'Jl. Padat Karya Komp. Herlina Perkasa Blok. Anggrek Raya No.39 RT.3 RW.6', 'PNS'),
('6789453200076113', 'Dimas Maulana', '1970-01-09', 'Banjarmasin', 'Laki - Laki', 'islam', 'Jl. Sungai Andai Komp. PWI no. 45 RT. 2 RW.5', 'Wiraswasta'),
('6789453200076200', 'Ita Susilowati', '1974-11-13', 'Bandung', 'Perempuan', 'Islam', 'Jl, Padat Karya Komp. Herlina Perkasa Blok. Berlian 1 No. 80 RT.5 RW.6', 'Ibu Rumah Tangga');

-- --------------------------------------------------------

--
-- Table structure for table `tb_sementara`
--

CREATE TABLE `tb_sementara` (
  `id_sementara` smallint(6) NOT NULL,
  `pendapatan` tinyint(2) NOT NULL,
  `asset` tinyint(2) NOT NULL,
  `pengeluaran` tinyint(2) NOT NULL,
  `jarak` decimal(5,2) NOT NULL,
  `status` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_urut`
--

CREATE TABLE `tb_urut` (
  `id_urut` int(11) NOT NULL,
  `jarak` decimal(5,2) NOT NULL,
  `status` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_klasifikasi`
--
ALTER TABLE `tb_klasifikasi`
  ADD PRIMARY KEY (`id_klasifikasi`),
  ADD KEY `id_status` (`status`),
  ADD KEY `id_periode` (`periode`),
  ADD KEY `kk` (`kk`);

--
-- Indexes for table `tb_penduduk`
--
ALTER TABLE `tb_penduduk`
  ADD PRIMARY KEY (`kk`),
  ADD KEY `id_pekerjaan` (`pekerjaan`),
  ADD KEY `id_desa` (`alamat`),
  ADD KEY `id_agama` (`agama`);

--
-- Indexes for table `tb_urut`
--
ALTER TABLE `tb_urut`
  ADD PRIMARY KEY (`id_urut`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_klasifikasi`
--
ALTER TABLE `tb_klasifikasi`
  MODIFY `id_klasifikasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_klasifikasi`
--
ALTER TABLE `tb_klasifikasi`
  ADD CONSTRAINT `tb_klasifikasi_ibfk_1` FOREIGN KEY (`kk`) REFERENCES `tb_penduduk` (`kk`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
