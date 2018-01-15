-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.8-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for efg
CREATE DATABASE IF NOT EXISTS `efg` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `efg`;


-- Dumping structure for table efg.tbl_kategori
CREATE TABLE IF NOT EXISTS `tbl_kategori` (
  `kode_kategori` int(11) NOT NULL AUTO_INCREMENT,
  `kategori` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`kode_kategori`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table efg.tbl_kategori: ~5 rows (approximately)
DELETE FROM `tbl_kategori`;
/*!40000 ALTER TABLE `tbl_kategori` DISABLE KEYS */;
INSERT INTO `tbl_kategori` (`kode_kategori`, `kategori`) VALUES
	(1, 'shirt'),
	(2, 'topi'),
	(3, 'kemeja'),
	(4, 'cenakuy'),
	(5, 'tas');
/*!40000 ALTER TABLE `tbl_kategori` ENABLE KEYS */;


-- Dumping structure for table efg.tbl_pelanggan
CREATE TABLE IF NOT EXISTS `tbl_pelanggan` (
  `kode_pelanggan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_pelanggan` varchar(50) DEFAULT NULL,
  `alamat` varchar(50) DEFAULT NULL,
  `no_telp` int(11) DEFAULT NULL,
  `akun` varchar(50) DEFAULT NULL,
  UNIQUE KEY `kode_pelanggan` (`kode_pelanggan`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

-- Dumping data for table efg.tbl_pelanggan: ~5 rows (approximately)
DELETE FROM `tbl_pelanggan`;
/*!40000 ALTER TABLE `tbl_pelanggan` DISABLE KEYS */;
INSERT INTO `tbl_pelanggan` (`kode_pelanggan`, `nama_pelanggan`, `alamat`, `no_telp`, `akun`) VALUES
	(26, 'jihad', 'bintaro', 0, 'a'),
	(27, 'riki', 'perbanas', 123, 'rikiline'),
	(28, 'olen bau', 'pkp', 5555, '5555'),
	(29, 'olen marolen', 'pkp', 123321, 'olenmawow'),
	(30, 'rifka isnaeni', 'pondok kacang prima', 123123123, 'sikempil');
/*!40000 ALTER TABLE `tbl_pelanggan` ENABLE KEYS */;


-- Dumping structure for table efg.tbl_pengguna
CREATE TABLE IF NOT EXISTS `tbl_pengguna` (
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table efg.tbl_pengguna: ~0 rows (approximately)
DELETE FROM `tbl_pengguna`;
/*!40000 ALTER TABLE `tbl_pengguna` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_pengguna` ENABLE KEYS */;


-- Dumping structure for table efg.tbl_penjualan
CREATE TABLE IF NOT EXISTS `tbl_penjualan` (
  `kode_penjualan` varchar(50) NOT NULL,
  `tanggal` datetime DEFAULT CURRENT_TIMESTAMP,
  `nama_pelanggan` varchar(50) DEFAULT NULL,
  `nama_kasir` varchar(50) DEFAULT NULL,
  `total_item` int(11) DEFAULT NULL,
  `biaya_kirim` int(11) DEFAULT NULL,
  `bayar` int(11) DEFAULT NULL,
  `kembali` int(11) DEFAULT NULL,
  `pajak` float DEFAULT NULL,
  `total_harga` int(11) DEFAULT NULL,
  `profit` int(11) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `tipe` int(11) DEFAULT '0',
  PRIMARY KEY (`kode_penjualan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table efg.tbl_penjualan: ~13 rows (approximately)
DELETE FROM `tbl_penjualan`;
/*!40000 ALTER TABLE `tbl_penjualan` DISABLE KEYS */;
INSERT INTO `tbl_penjualan` (`kode_penjualan`, `tanggal`, `nama_pelanggan`, `nama_kasir`, `total_item`, `biaya_kirim`, `bayar`, `kembali`, `pajak`, `total_harga`, `profit`, `status`, `tipe`) VALUES
	('0096143', '2017-01-23 20:51:47', '', 'kasir', 12, 0, 222, 11, 0, 211, 101, 'complete', 0),
	('0580428', '2017-01-23 20:30:57', '', 'kasir', 3, 0, 30, 0, 0, 30, 15, 'complete', 0),
	('0939978', '2017-01-23 20:57:12', '', 'kasir', 1, 0, 10, 0, 0, 10, 5, 'complete', 0),
	('1194415', '2017-01-23 18:44:25', '', 'kasir', 1, 0, 11, 1, 0, 10, 5, 'complete', 0),
	('1691883', '2017-02-16 11:24:40', '', 'kasir', 1, 0, 11, 1, 0, 10, 5, 'complete', 0),
	('2277518', '2017-01-23 18:43:42', '', 'kasir', 1, 0, 11, 1, 0, 10, 5, 'complete', 0),
	('2340044', '2017-01-23 18:45:15', '', 'kasir', 1, 0, 11, 1, 0, 10, 5, 'complete', 0),
	('3378216', '2017-01-23 20:20:29', '', 'kasir', 1, 0, 10, 0, 0, 10, 5, 'complete', 0),
	('3869620', '2017-03-12 20:45:19', '', 'kasir', 1, 0, 10, 0, 0, 10, 5, 'complete', 0),
	('4010684', '2017-02-16 21:33:18', '', 'kasir', 2, 0, 22, 2, 0, 20, 10, 'complete', 0),
	('6958598', '2017-01-23 18:38:02', '', 'kasir', 1, 0, 10, 0, 0, 10, 5, 'complete', 0),
	('8621618', '2017-01-23 20:57:39', '', 'kasir', 1, 0, 22, 12, 0, 10, 5, 'complete', 0),
	('9885854', '2017-01-23 18:45:33', '', 'kasir', 1, 0, 11, 1, 0, 10, 5, 'complete', 0);
/*!40000 ALTER TABLE `tbl_penjualan` ENABLE KEYS */;


-- Dumping structure for table efg.tbl_penjualandetail
CREATE TABLE IF NOT EXISTS `tbl_penjualandetail` (
  `kode_penjualan` varchar(50) NOT NULL,
  `kode_produk` varchar(50) DEFAULT NULL,
  `nama_produk` varchar(50) DEFAULT NULL,
  `kuantitas` int(11) DEFAULT NULL,
  `harga_modal` int(11) DEFAULT NULL,
  `harga_jual` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `profit` int(11) DEFAULT NULL,
  KEY `FK_tbl_penjualandetail_tbl_produk` (`kode_produk`),
  CONSTRAINT `FK_tbl_penjualandetail_tbl_produk` FOREIGN KEY (`kode_produk`) REFERENCES `tbl_produk` (`kode_produk`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table efg.tbl_penjualandetail: ~14 rows (approximately)
DELETE FROM `tbl_penjualandetail`;
/*!40000 ALTER TABLE `tbl_penjualandetail` DISABLE KEYS */;
INSERT INTO `tbl_penjualandetail` (`kode_penjualan`, `kode_produk`, `nama_produk`, `kuantitas`, `harga_modal`, `harga_jual`, `total`, `profit`) VALUES
	('9885854', '14b', 'tes', 1, 5, 10, 10, 5),
	('0580428', '24b', 'tes', 1, 5, 10, 10, 5),
	('0580428', '20a', 'tes', 1, 5, 10, 10, 5),
	('0096143', '30b', 'tes', 1, 5, 10, 10, 5),
	('0096143', '40', 'tes', 1, 5, 10, 10, 5),
	('0096143', '12b', 'tes', 1, 5, 10, 10, 5),
	('0096143', '13b', 'tes', 1, 5, 10, 10, 5),
	('0096143', '5a', 'tes', 1, 5, 10, 10, 5),
	('0096143', '23a', 'tes', 1, 5, 10, 10, 5),
	('0096143', '26b', 'tes', 1, 5, 10, 10, 5),
	('0096143', '21axxx', 'tes', 1, 5, 10, 10, 5),
	('0096143', '22a', 'tes', 1, 5, 10, 10, 5),
	('0096143', '14b', 'tes', 1, 5, 10, 10, 5),
	('0096143', '17a', 'ow baby its triple', 1, 55, 101, 101, 46);
/*!40000 ALTER TABLE `tbl_penjualandetail` ENABLE KEYS */;


-- Dumping structure for table efg.tbl_produk
CREATE TABLE IF NOT EXISTS `tbl_produk` (
  `kode_produk` varchar(50) NOT NULL,
  `nama_produk` varchar(50) DEFAULT NULL,
  `size_produk` varchar(50) DEFAULT NULL,
  `kategori` varchar(50) DEFAULT NULL,
  `harga_modal` int(11) DEFAULT NULL,
  `harga_jual` int(11) DEFAULT NULL,
  `diskon` float DEFAULT NULL,
  `stok_produk` smallint(6) DEFAULT NULL,
  `deskripsi` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`kode_produk`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table efg.tbl_produk: ~38 rows (approximately)
DELETE FROM `tbl_produk`;
/*!40000 ALTER TABLE `tbl_produk` DISABLE KEYS */;
INSERT INTO `tbl_produk` (`kode_produk`, `nama_produk`, `size_produk`, `kategori`, `harga_modal`, `harga_jual`, `diskon`, `stok_produk`, `deskripsi`) VALUES
	('12b', 'tes', 's', 'shirt', 5, 10, 0, 93, 'shirt'),
	('13b', 'tes', 's', 'shirt', 5, 10, 0, 99, 'shirt'),
	('14b', 'tes', 's', 'shirt', 5, 10, 0, 98, 'shirt'),
	('15b', 'tes', 's', 'shirt', 5, 10, 0, 100, 'shirt'),
	('17a', 'baju mantap', 'yeah', 'kemeja', 55, 101, 0, -1, ''),
	('18a', 'tes', 's', 'kemeja', 5, 10, 0, 0, 'shirt'),
	('20a', 'tes edit ah', 's', 'kemeja', 5, 10, 0, 99, 'shirt'),
	('21axxx', 'tes', 's', 'kemeja', 5, 10, 0, 99, 'shirt'),
	('22a', 'tes', 's', 'kemeja', 5, 10, 0, 99, 'shirt'),
	('23a', 'tes', 's', 'kemeja', 5, 10, 0, 99, 'shirt'),
	('24b', 'tes', 's', 'kemeja', 5, 10, 0, 99, 'shirt'),
	('25b', 'tes', 's', 'kemeja', 5, 10, 0, 100, 'shirt'),
	('26b', 'tes', 's', 'kemeja', 5, 10, 0, 99, 'shirt'),
	('27b', 'tes', 's', 'kemeja', 5, 10, 0, 100, 'shirt'),
	('28b', 'tes', 's', 'kemeja', 5, 10, 0, 100, 'shirt'),
	('29b', 'tes', 's', 'kemeja', 5, 10, 0, 100, 'shirt'),
	('2a', 'tes', 's', 'shirt', 5, 10, 0, 100, 'shirt'),
	('30b', 'tes', 's', 'kemeja', 5, 10, 0, 99, 'shirt'),
	('31b', 'tes 31b', '3', 'kemeja', 3, 33, 0, 333, 'tes'),
	('32b', 'tes', 's', 'kemeja', 5, 10, 0, 100, 'shirt'),
	('33c', 'tes', 's', 'kemeja', 5, 10, 0, 100, 'shirt'),
	('34c', 'tes', 's', 'kemeja', 5, 10, 0, 100, 'shirt'),
	('35c', 'tes', 's', 'kemeja', 5, 10, 0, 100, 'shirt'),
	('36c', 'tes', 's', 'kemeja', 5, 10, 0, 100, 'shirt'),
	('37', 'tes', 's', 'kemeja', 5, 10, 0, 100, 'shirt'),
	('38', 'tes', 's', 'kemeja', 5, 10, 0, 100, 'shirt'),
	('39', 'tes', 's', 'kemeja', 5, 10, 0, 100, 'shirt'),
	('3a', 'tes', 's', 'shirt', 5, 10, 0, 100, 'shirt'),
	('40', 'tes', 's', 'kemeja', 5, 10, 0, 99, 'shirt'),
	('4a', 'tes', 's', 'shirt', 5, 10, 0, 100, 'shirt'),
	('5a', 'tes', 's', 'shirt', 5, 10, 0, 99, 'shirt'),
	('6a', 'tes', 's', 'shirt', 5, 10, 0, 100, 'shirt'),
	('7a', 'tes', 's', 'shirt', 5, 10, 0, 100, 'shirt'),
	('8a', 'tes', 's', 'shirt', 5, 10, 0, 100, 'shirt'),
	('9b', 'tes', 's', 'shirt', 5, 10, 0, 100, 'shirt'),
	('coba', 'coba', 'coba', 'cenakuy', 2, 2, 0.05, 13, ''),
	('pd5204522', 'a', 'a', 'shirt', 2, 2, 0.85, 1, 'aa'),
	('pd8849313', 'tes', 's', 'shirt', 80000, 150000, 0, 0, '');
/*!40000 ALTER TABLE `tbl_produk` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
