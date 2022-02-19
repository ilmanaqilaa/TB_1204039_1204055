-- Current Database: `bengrpl`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `bengrpl` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `bengrpl`;

--
-- Table structure for table `tb_petugas`
--

DROP TABLE IF EXISTS `tb_petugas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_petugas` (
  `id_petugas` char(3) NOT NULL,
  `nomor_petugas` char(20) DEFAULT NULL,
  `nama_petugas` varchar(40) DEFAULT NULL,
  `password` varchar(40) DEFAULT NULL,
  `jenis_user` enum('Admin','Petugas') DEFAULT NULL,
  PRIMARY KEY (`id_petugas`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_petugas`
--

LOCK TABLES `tb_petugas` WRITE;
/*!40000 ALTER TABLE `tb_petugas` DISABLE KEYS */;
INSERT INTO `tb_petugas` VALUES ('P01','140101010101','Aspiran','aspiran123','Admin');
/*!40000 ALTER TABLE `tb_petugas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_user`
--

DROP TABLE IF EXISTS `tb_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_user` (
  `nomor_user` char(20) NOT NULL,
  `nama_user` varchar(40) DEFAULT NULL,
  `jenis_user` enum('Murid','Guru') DEFAULT NULL,
  `password` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`nomor_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_user`
--

LOCK TABLES `tb_user` WRITE;
/*!40000 ALTER TABLE `tb_user` DISABLE KEYS */;
INSERT INTO `tb_user` VALUES ('171113232','Mawarni Ayu Lestari','Murid','mawar123'),('171113233','Muammar Alfien Zaidan','Murid','alfien123');
/*!40000 ALTER TABLE `tb_user` ENABLE KEYS */;
UNLOCK TABLES;


--
-- Table structure for table `tb_kategori_invetaris`
--

DROP TABLE IF EXISTS `tb_kategori_invetaris`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_kategori_invetaris` (
  `id_kategori` varchar(6) NOT NULL,
  `nama_kategori` varchar(40) NOT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_kategori_invetaris`
--

LOCK TABLES `tb_kategori_invetaris` WRITE;
/*!40000 ALTER TABLE `tb_kategori_invetaris` DISABLE KEYS */;
INSERT INTO `tb_kategori_invetaris` VALUES ('KP0001','Komputer'),('KP0002','Monitor');
/*!40000 ALTER TABLE `tb_kategori_invetaris` ENABLE KEYS */;
UNLOCK TABLES;


--
-- Table structure for table `tb_inventaris`
--

DROP TABLE IF EXISTS `tb_inventaris`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_inventaris` (
  `id_inventaris` char(6) NOT NULL,
  `nama_inventaris` varchar(40) NOT NULL,
  `kategori` varchar(6) NOT NULL,
  `satuan` enum('Unit','Set') NOT NULL,
  `jumlah` int(4) NOT NULL,
  `status` enum('Tersedia','Dipinjam','','') NOT NULL,
  PRIMARY KEY (`id_inventaris`),
  KEY `kategori` (`kategori`),
  CONSTRAINT `tb_inventaris_ibfk_1` FOREIGN KEY (`kategori`) REFERENCES `tb_kategori_invetaris` (`id_kategori`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_inventaris`
--

LOCK TABLES `tb_inventaris` WRITE;
/*!40000 ALTER TABLE `tb_inventaris` DISABLE KEYS */;
INSERT INTO `tb_inventaris` VALUES ('BR0001','Lenovo PC All in One Putih','KP0001','Unit',0,'Dipinjam'),('BR0002','Lenovo PC All in One Hitam','KP0001','Unit',1,'Tersedia'),('BR0003','LED Samsung 13 inc','KP0002','Unit',1,'Tersedia'),('BR0004','Laptop Asus X450JB','KP0001','Unit',1,'Tersedia'),('BR0005','Laptop Acer E552G','KP0001','Unit',1,'Tersedia'),('BR0006','LG G50 Ultra Wide Monitor','KP0002','Unit',5,'Tersedia');
/*!40000 ALTER TABLE `tb_inventaris` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_pembelian`
--

DROP TABLE IF EXISTS `tb_pembelian`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_pembelian` (
  `id_pembelian` char(6) NOT NULL,
  `id_inventaris` char(6) DEFAULT NULL,
  `id_petugas` char(3) DEFAULT NULL,
  `tgl_pembelian` date NOT NULL,
  `satuan` enum('Unit','Set') NOT NULL,
  `jumlah` int(4) NOT NULL,
  `harga` int(12) DEFAULT NULL,
  PRIMARY KEY (`id_pembelian`),
  KEY `id_inventaris` (`id_inventaris`),
  KEY `id_petugas` (`id_petugas`),
  CONSTRAINT `tb_pembelian_ibfk_1` FOREIGN KEY (`id_inventaris`) REFERENCES `tb_inventaris` (`id_inventaris`),
  CONSTRAINT `tb_pembelian_ibfk_2` FOREIGN KEY (`id_petugas`) REFERENCES `tb_petugas` (`id_petugas`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_pembelian`
--

LOCK TABLES `tb_pembelian` WRITE;
/*!40000 ALTER TABLE `tb_pembelian` DISABLE KEYS */;
INSERT INTO `tb_pembelian` VALUES ('BL0001','BR0006','P01','2020-01-31','Unit',5,5000000);
/*!40000 ALTER TABLE `tb_pembelian` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_peminjaman`
--

DROP TABLE IF EXISTS `tb_peminjaman`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_peminjaman` (
  `id_peminjaman` char(6) NOT NULL,
  `id_peminjam` varchar(20) NOT NULL,
  `barang_pinjaman` char(6) NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `keterangan` text NOT NULL,
  `status` enum('Kembali','Dipinjam','Diperiksa') DEFAULT NULL,
  PRIMARY KEY (`id_peminjaman`),
  KEY `id_peminjam` (`id_peminjam`),
  KEY `barang_pinjaman` (`barang_pinjaman`),
  CONSTRAINT `tb_peminjaman_ibfk_1` FOREIGN KEY (`id_peminjam`) REFERENCES `tb_user` (`nomor_user`),
  CONSTRAINT `tb_peminjaman_ibfk_2` FOREIGN KEY (`barang_pinjaman`) REFERENCES `tb_inventaris` (`id_inventaris`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_peminjaman`
--

LOCK TABLES `tb_peminjaman` WRITE;
/*!40000 ALTER TABLE `tb_peminjaman` DISABLE KEYS */;
INSERT INTO `tb_peminjaman` VALUES ('PM0001','171113232','BR0001','2019-12-28','dada','Kembali'),('PM0002','171113233','BR0001','2019-12-28','Gaming','Kembali'),('PM0003','171113233','BR0005','2019-12-29','Pameran OH','Kembali'),('PM0004','171113233','BR0005','2020-01-01','Konferensi Perwakilan Kelas','Kembali'),('PM0005','171113233','BR0004','2020-01-01','Operator Buku Tamu','Kembali'),('PM0006','171113232','BR0004','2020-01-01','Tugas Desgraf','Kembali'),('PM0007','171113233','BR0004','2020-01-01','Tugas Perpus','Kembali'),('PM0008','171113233','BR0005','2020-01-01','Tugas Desgraf','Kembali'),('PM0009','171113233','BR0004','2020-01-01','Operator Presentasi','Kembali'),('PM0010','171113233','BR0003','2020-01-07','Presentasi Sidang','Kembali'),('PM0011','171113233','BR0004','2020-01-07','Desain Poster','Diperiksa'),('PM0012','171113233','BR0001','2020-01-07','Tugas Web','Dipinjam');
/*!40000 ALTER TABLE `tb_peminjaman` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `ganti_status_barang` AFTER INSERT ON `tb_peminjaman` FOR EACH ROW UPDATE tb_inventaris SET status = IF(jumlah=1,'Dipinjam','Tersedia'), jumlah=jumlah-1 WHERE id_inventaris=new.barang_pinjaman */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `tb_pengembalian`
--

DROP TABLE IF EXISTS `tb_pengembalian`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_pengembalian` (
  `id_pengembalian` char(8) NOT NULL,
  `id_peminjaman` char(6) NOT NULL,
  `nomor_user` char(20) DEFAULT NULL,
  `id_inventaris` char(6) DEFAULT NULL,
  `id_petugas` char(3) DEFAULT NULL,
  `tgl_kembali` date DEFAULT NULL,
  PRIMARY KEY (`id_pengembalian`),
  KEY `nomor_user` (`nomor_user`),
  KEY `id_inventaris` (`id_inventaris`),
  KEY `id_petugas` (`id_petugas`),
  KEY `id_peminjaman` (`id_peminjaman`),
  CONSTRAINT `tb_pengembalian_ibfk_1` FOREIGN KEY (`nomor_user`) REFERENCES `tb_user` (`nomor_user`),
  CONSTRAINT `tb_pengembalian_ibfk_2` FOREIGN KEY (`id_inventaris`) REFERENCES `tb_inventaris` (`id_inventaris`),
  CONSTRAINT `tb_pengembalian_ibfk_3` FOREIGN KEY (`id_petugas`) REFERENCES `tb_petugas` (`id_petugas`),
  CONSTRAINT `tb_pengembalian_ibfk_4` FOREIGN KEY (`id_peminjaman`) REFERENCES `tb_peminjaman` (`id_peminjaman`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_pengembalian`
--

LOCK TABLES `tb_pengembalian` WRITE;
/*!40000 ALTER TABLE `tb_pengembalian` DISABLE KEYS */;
INSERT INTO `tb_pengembalian` VALUES ('PB0001','PM0001','171113232','BR0001','P01','2019-12-28'),('PB0002','PM0002','171113233','BR0001','P01','2019-12-28'),('PB0003','PM0003','171113233','BR0005','P01','2020-01-01'),('PB0004','PM0006','171113232','BR0004','P01','2020-01-01'),('PB0005','PM0005','171113233','BR0004','P01','2020-01-01'),('PB0006','PM0007','171113233','BR0004','P01','2020-01-01'),('PB0007','PM0004','171113233','BR0005','P01','2020-01-01'),('PB0008','PM0008','171113233','BR0005','P01','2020-01-01'),('PB0009','PM0009','171113233','BR0004','P01','2020-01-01'),('PB0010','PM0010','171113233','BR0003','P01','2020-01-07'),('PB0011','PM0011','171113233','BR0004',NULL,'2020-01-07');
/*!40000 ALTER TABLE `tb_pengembalian` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `ubah_status_peminjaman` AFTER INSERT ON `tb_pengembalian` FOR EACH ROW UPDATE tb_peminjaman SET status='Diperiksa' WHERE barang_pinjaman=new.id_inventaris AND id_peminjaman=new.id_peminjaman */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `update_status_tersedia` AFTER UPDATE ON `tb_pengembalian` FOR EACH ROW UPDATE tb_inventaris SET status='Tersedia', jumlah=jumlah+1 WHERE id_inventaris=new.id_inventaris */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
