-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 19, 2022 at 10:55 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bengrpl`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_inventaris`
--

CREATE TABLE `tb_inventaris` (
  `id_inventaris` char(6) NOT NULL,
  `nama_inventaris` varchar(40) NOT NULL,
  `kategori` varchar(6) NOT NULL,
  `satuan` enum('Unit','Set') NOT NULL,
  `jumlah` int(4) NOT NULL,
  `status` enum('Tersedia','Dipinjam','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_inventaris`
--

INSERT INTO `tb_inventaris` (`id_inventaris`, `nama_inventaris`, `kategori`, `satuan`, `jumlah`, `status`) VALUES
('BR0001', 'Lenovo PC All in One Putih', 'KP0001', 'Unit', 0, 'Dipinjam'),
('BR0002', 'Lenovo PC All in One Hitam', 'KP0001', 'Unit', 0, 'Dipinjam'),
('BR0003', 'LED Samsung 13 inc', 'KP0002', 'Unit', 1, 'Tersedia'),
('BR0004', 'Laptop Asus X450JB', 'KP0001', 'Unit', 2, 'Tersedia'),
('BR0005', 'Laptop Acer E552G', 'KP0001', 'Unit', 0, 'Dipinjam'),
('BR0006', 'LG G50 Ultra Wide Monitor', 'KP0002', 'Unit', 4, 'Tersedia'),
('BR0007', 'Acer E-14', 'KP0001', 'Unit', 0, 'Dipinjam'),
('BR0008', 'Acer ClearVision', 'KP0002', 'Set', 22, 'Tersedia'),
('BR0009', 'Asus X450', 'KP0001', 'Unit', 1, 'Tersedia'),
('BR0010', 'MSI Gaming Laptop 14', 'KP0001', 'Unit', 1, 'Tersedia'),
('BR0011', 'Lenovo Ideapad 410', 'KP0001', 'Unit', 1, 'Tersedia');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategori_invetaris`
--

CREATE TABLE `tb_kategori_invetaris` (
  `id_kategori` varchar(6) NOT NULL,
  `nama_kategori` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kategori_invetaris`
--

INSERT INTO `tb_kategori_invetaris` (`id_kategori`, `nama_kategori`) VALUES
('KP0001', 'Komputer'),
('KP0002', 'Monitor');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pembelian`
--

CREATE TABLE `tb_pembelian` (
  `id_pembelian` char(6) NOT NULL,
  `id_inventaris` char(6) DEFAULT NULL,
  `id_petugas` char(3) DEFAULT NULL,
  `tgl_pembelian` date NOT NULL,
  `satuan` enum('Unit','Set') NOT NULL,
  `jumlah` int(4) NOT NULL,
  `harga` int(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pembelian`
--

INSERT INTO `tb_pembelian` (`id_pembelian`, `id_inventaris`, `id_petugas`, `tgl_pembelian`, `satuan`, `jumlah`, `harga`) VALUES
('BL0001', 'BR0006', 'P01', '2020-01-31', 'Unit', 5, 5000000),
('BL0002', 'BR0007', 'P01', '2022-02-10', 'Unit', 1, 50000),
('BL0003', 'BR0008', 'P01', '2022-02-12', 'Set', 23, 200000),
('BL0004', 'BR0009', 'P01', '2022-02-12', 'Unit', 1, 5000000),
('BL0005', 'BR0010', 'P01', '2022-02-19', 'Unit', 1, 20000000),
('BL0006', 'BR0011', 'P01', '2022-02-19', 'Unit', 1, 5000000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_peminjaman`
--

CREATE TABLE `tb_peminjaman` (
  `id_peminjaman` char(6) NOT NULL,
  `id_peminjam` varchar(20) NOT NULL,
  `barang_pinjaman` char(6) NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `keterangan` text NOT NULL,
  `status` enum('Kembali','Dipinjam','Diperiksa') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_peminjaman`
--

INSERT INTO `tb_peminjaman` (`id_peminjaman`, `id_peminjam`, `barang_pinjaman`, `tanggal_pinjam`, `keterangan`, `status`) VALUES
('PM0001', '171113232', 'BR0001', '2019-12-28', 'dada', 'Kembali'),
('PM0002', '171113233', 'BR0001', '2019-12-28', 'Gaming', 'Kembali'),
('PM0003', '171113233', 'BR0005', '2019-12-29', 'Pameran OH', 'Kembali'),
('PM0004', '171113233', 'BR0005', '2020-01-01', 'Konferensi Perwakilan Kelas', 'Kembali'),
('PM0005', '171113233', 'BR0004', '2020-01-01', 'Operator Buku Tamu', 'Kembali'),
('PM0006', '171113232', 'BR0004', '2020-01-01', 'Tugas Desgraf', 'Kembali'),
('PM0007', '171113233', 'BR0004', '2020-01-01', 'Tugas Perpus', 'Kembali'),
('PM0008', '171113233', 'BR0005', '2020-01-01', 'Tugas Desgraf', 'Kembali'),
('PM0009', '171113233', 'BR0004', '2020-01-01', 'Operator Presentasi', 'Kembali'),
('PM0010', '171113233', 'BR0003', '2020-01-07', 'Presentasi Sidang', 'Kembali'),
('PM0011', '171113233', 'BR0004', '2020-01-07', 'Desain Poster', 'Kembali'),
('PM0012', '171113233', 'BR0001', '2020-01-07', 'Tugas Web', 'Kembali'),
('PM0013', '171113233', 'BR0001', '2022-01-10', 'buat belajar hari senin', 'Kembali'),
('PM0014', '171113233', 'BR0005', '2022-01-28', 'Belajar', 'Kembali'),
('PM0015', '171113233', 'BR0007', '2022-02-11', 'Buat ngerjain jarkom di kampus', 'Kembali'),
('PM0016', '171113232', 'BR0006', '2022-02-11', 'Buat ngoding', 'Dipinjam'),
('PM0017', '787210', 'BR0008', '2022-02-13', 'Minjem besok buat kelas', 'Dipinjam'),
('PM0018', '171113233', 'BR0005', '2022-02-12', 'Buat mabar', 'Dipinjam'),
('PM0019', '787210', 'BR0002', '2022-02-12', 'Untuk belajar', 'Dipinjam'),
('PM0020', '787210', 'BR0001', '2022-02-12', 'Untuk pemrog', 'Dipinjam'),
('PM0021', '171113233', 'BR0003', '2022-02-12', 'Untuk belajar pemrograman', 'Kembali'),
('PM0022', '171113233', 'BR0007', '2022-02-12', 'Untuk belajar', 'Dipinjam');

--
-- Triggers `tb_peminjaman`
--
DELIMITER $$
CREATE TRIGGER `ganti_status_barang` AFTER INSERT ON `tb_peminjaman` FOR EACH ROW UPDATE tb_inventaris SET status = IF(jumlah=1,'Dipinjam','Tersedia'), jumlah=jumlah-1 WHERE id_inventaris=new.barang_pinjaman
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengembalian`
--

CREATE TABLE `tb_pengembalian` (
  `id_pengembalian` char(8) NOT NULL,
  `id_peminjaman` char(6) NOT NULL,
  `nomor_user` char(20) DEFAULT NULL,
  `id_inventaris` char(6) DEFAULT NULL,
  `id_petugas` char(3) DEFAULT NULL,
  `tgl_kembali` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pengembalian`
--

INSERT INTO `tb_pengembalian` (`id_pengembalian`, `id_peminjaman`, `nomor_user`, `id_inventaris`, `id_petugas`, `tgl_kembali`) VALUES
('PB0001', 'PM0001', '171113232', 'BR0001', 'P01', '2019-12-28'),
('PB0002', 'PM0002', '171113233', 'BR0001', 'P01', '2019-12-28'),
('PB0003', 'PM0003', '171113233', 'BR0005', 'P01', '2020-01-01'),
('PB0004', 'PM0006', '171113232', 'BR0004', 'P01', '2020-01-01'),
('PB0005', 'PM0005', '171113233', 'BR0004', 'P01', '2020-01-01'),
('PB0006', 'PM0007', '171113233', 'BR0004', 'P01', '2020-01-01'),
('PB0007', 'PM0004', '171113233', 'BR0005', 'P01', '2020-01-01'),
('PB0008', 'PM0008', '171113233', 'BR0005', 'P01', '2020-01-01'),
('PB0009', 'PM0009', '171113233', 'BR0004', 'P01', '2020-01-01'),
('PB0010', 'PM0010', '171113233', 'BR0003', 'P01', '2020-01-07'),
('PB0011', 'PM0011', '171113233', 'BR0004', 'P01', '2020-01-07'),
('PB0012', 'PM0012', '171113233', 'BR0001', 'P01', '2021-03-09'),
('PB0013', 'PM0013', '171113233', 'BR0001', 'P01', '2022-01-10'),
('PB0014', 'PM0014', '171113233', 'BR0005', 'P01', '2022-01-28'),
('PB0015', 'PM0015', '171113233', 'BR0007', 'P01', '2022-02-11'),
('PB0016', 'PM0021', '171113233', 'BR0003', 'P01', '2022-02-12');

--
-- Triggers `tb_pengembalian`
--
DELIMITER $$
CREATE TRIGGER `ubah_status_peminjaman` AFTER INSERT ON `tb_pengembalian` FOR EACH ROW UPDATE tb_peminjaman SET status='Diperiksa' WHERE barang_pinjaman=new.id_inventaris AND id_peminjaman=new.id_peminjaman
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_status_tersedia` AFTER UPDATE ON `tb_pengembalian` FOR EACH ROW UPDATE tb_inventaris SET status='Tersedia', jumlah=jumlah+1 WHERE id_inventaris=new.id_inventaris
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_petugas`
--

CREATE TABLE `tb_petugas` (
  `id_petugas` char(3) NOT NULL,
  `nomor_petugas` char(20) DEFAULT NULL,
  `nama_petugas` varchar(40) DEFAULT NULL,
  `password` varchar(40) DEFAULT NULL,
  `jenis_user` enum('Admin','Petugas') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_petugas`
--

INSERT INTO `tb_petugas` (`id_petugas`, `nomor_petugas`, `nama_petugas`, `password`, `jenis_user`) VALUES
('P01', '140101010101', 'Aspiran', 'aspiran123', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `nomor_user` char(20) NOT NULL,
  `nama_user` varchar(40) DEFAULT NULL,
  `jenis_user` enum('Murid','Guru','Mahasiswa','Dosen') DEFAULT NULL,
  `password` varchar(40) DEFAULT NULL,
  `email` varchar(60) NOT NULL,
  `telpon` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`nomor_user`, `nama_user`, `jenis_user`, `password`, `email`, `telpon`) VALUES
('171113232', 'Mawarni Ayu Lestari', 'Murid', 'mawar123', 'mawar@gmail.com', '082746284512'),
('171113233', 'Muammar Alfien Zaidan', 'Mahasiswa', 'alfien123', 'alfien@gmail.com', '0823020482627'),
('787210', 'Ilman Aqilaa', 'Mahasiswa', 'ilman123', 'ilman@gmail.com', '0827264822'),
('996619', 'Daffa', 'Mahasiswa', 'daffa123', 'daffa@gmail.com', '08241532523');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_inventaris`
--
ALTER TABLE `tb_inventaris`
  ADD PRIMARY KEY (`id_inventaris`),
  ADD KEY `kategori` (`kategori`);

--
-- Indexes for table `tb_kategori_invetaris`
--
ALTER TABLE `tb_kategori_invetaris`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `tb_pembelian`
--
ALTER TABLE `tb_pembelian`
  ADD PRIMARY KEY (`id_pembelian`),
  ADD KEY `id_inventaris` (`id_inventaris`),
  ADD KEY `id_petugas` (`id_petugas`);

--
-- Indexes for table `tb_peminjaman`
--
ALTER TABLE `tb_peminjaman`
  ADD PRIMARY KEY (`id_peminjaman`),
  ADD KEY `id_peminjam` (`id_peminjam`),
  ADD KEY `barang_pinjaman` (`barang_pinjaman`);

--
-- Indexes for table `tb_pengembalian`
--
ALTER TABLE `tb_pengembalian`
  ADD PRIMARY KEY (`id_pengembalian`),
  ADD KEY `nomor_user` (`nomor_user`),
  ADD KEY `id_inventaris` (`id_inventaris`),
  ADD KEY `id_petugas` (`id_petugas`),
  ADD KEY `id_peminjaman` (`id_peminjaman`);

--
-- Indexes for table `tb_petugas`
--
ALTER TABLE `tb_petugas`
  ADD PRIMARY KEY (`id_petugas`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`nomor_user`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_inventaris`
--
ALTER TABLE `tb_inventaris`
  ADD CONSTRAINT `tb_inventaris_ibfk_1` FOREIGN KEY (`kategori`) REFERENCES `tb_kategori_invetaris` (`id_kategori`);

--
-- Constraints for table `tb_pembelian`
--
ALTER TABLE `tb_pembelian`
  ADD CONSTRAINT `tb_pembelian_ibfk_1` FOREIGN KEY (`id_inventaris`) REFERENCES `tb_inventaris` (`id_inventaris`),
  ADD CONSTRAINT `tb_pembelian_ibfk_2` FOREIGN KEY (`id_petugas`) REFERENCES `tb_petugas` (`id_petugas`);

--
-- Constraints for table `tb_peminjaman`
--
ALTER TABLE `tb_peminjaman`
  ADD CONSTRAINT `tb_peminjaman_ibfk_1` FOREIGN KEY (`id_peminjam`) REFERENCES `tb_user` (`nomor_user`),
  ADD CONSTRAINT `tb_peminjaman_ibfk_2` FOREIGN KEY (`barang_pinjaman`) REFERENCES `tb_inventaris` (`id_inventaris`);

--
-- Constraints for table `tb_pengembalian`
--
ALTER TABLE `tb_pengembalian`
  ADD CONSTRAINT `tb_pengembalian_ibfk_1` FOREIGN KEY (`nomor_user`) REFERENCES `tb_user` (`nomor_user`),
  ADD CONSTRAINT `tb_pengembalian_ibfk_2` FOREIGN KEY (`id_inventaris`) REFERENCES `tb_inventaris` (`id_inventaris`),
  ADD CONSTRAINT `tb_pengembalian_ibfk_3` FOREIGN KEY (`id_petugas`) REFERENCES `tb_petugas` (`id_petugas`),
  ADD CONSTRAINT `tb_pengembalian_ibfk_4` FOREIGN KEY (`id_peminjaman`) REFERENCES `tb_peminjaman` (`id_peminjaman`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
