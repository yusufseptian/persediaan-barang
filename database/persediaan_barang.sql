/*
Navicat MySQL Data Transfer

Source Server         : xampp-localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : persediaan_barang

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2023-04-02 14:35:19
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `is_barang`
-- ----------------------------
DROP TABLE IF EXISTS `is_barang`;
CREATE TABLE `is_barang` (
  `id_barang` varchar(7) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `id_jenis` int(11) NOT NULL,
  `id_satuan` int(11) NOT NULL,
  `stok` int(11) NOT NULL DEFAULT 0,
  `safety_stok` int(11) NOT NULL,
  `created_user` smallint(6) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_user` smallint(6) NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_barang`),
  KEY `id_jenis` (`id_jenis`),
  KEY `id_satuan` (`id_satuan`),
  KEY `created_user` (`created_user`),
  KEY `updated_user` (`updated_user`),
  CONSTRAINT `is_barang_ibfk_1` FOREIGN KEY (`created_user`) REFERENCES `is_users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `is_barang_ibfk_2` FOREIGN KEY (`updated_user`) REFERENCES `is_users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `is_barang_ibfk_3` FOREIGN KEY (`id_satuan`) REFERENCES `is_satuan` (`id_satuan`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `is_barang_ibfk_4` FOREIGN KEY (`id_jenis`) REFERENCES `is_jenis_barang` (`id_jenis`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of is_barang
-- ----------------------------
INSERT INTO `is_barang` VALUES ('B000001', 'Pupuk Pulkalet', '1', '2', '200', '50', '3', '2017-03-12 23:31:31', '3', '2023-03-30 06:32:54');
INSERT INTO `is_barang` VALUES ('B000002', 'Pupuk Dolomite', '1', '2', '130', '50', '3', '2017-03-12 23:31:48', '3', '2023-03-30 06:32:58');
INSERT INTO `is_barang` VALUES ('B000003', 'Pupuk KCL/MOP', '1', '2', '100', '50', '3', '2017-03-12 23:32:04', '3', '2023-03-30 06:33:00');
INSERT INTO `is_barang` VALUES ('B000004', 'Gesapax 500 PW', '3', '4', '10', '20', '3', '2017-03-12 23:32:24', '3', '2023-03-30 06:33:13');
INSERT INTO `is_barang` VALUES ('B000005', 'Amonia Cair', '7', '4', '10', '20', '3', '2017-03-12 23:32:42', '3', '2023-03-30 06:33:15');
INSERT INTO `is_barang` VALUES ('B000006', 'Asam Sulfate PA 731', '7', '4', '10', '40', '3', '2017-03-12 23:32:59', '3', '2023-03-30 06:33:16');
INSERT INTO `is_barang` VALUES ('B000007', 'Vitamin Karet Plus Kemasan 1 Kg.', '2', '2', '10', '50', '3', '2017-03-12 23:33:15', '1', '2023-03-30 06:33:17');
INSERT INTO `is_barang` VALUES ('B000008', 'Srintil Kambing', '2', '2', '10', '40', '1', '2023-03-27 04:35:35', '1', '2023-03-30 06:45:39');
INSERT INTO `is_barang` VALUES ('B000009', 'Urea', '2', '2', '10', '25', '1', '2023-03-27 05:06:55', '1', '2023-03-30 06:45:27');

-- ----------------------------
-- Table structure for `is_barang_keluar`
-- ----------------------------
DROP TABLE IF EXISTS `is_barang_keluar`;
CREATE TABLE `is_barang_keluar` (
  `id_barang_keluar` varchar(15) NOT NULL,
  `tanggal_keluar` date NOT NULL,
  `id_barang` varchar(7) NOT NULL,
  `jumlah_keluar` int(11) NOT NULL,
  `status` enum('Proses','Approve','Reject') NOT NULL DEFAULT 'Proses',
  `created_user` smallint(6) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_barang_keluar`),
  KEY `id_barang` (`id_barang`),
  KEY `created_user` (`created_user`),
  CONSTRAINT `is_barang_keluar_ibfk_1` FOREIGN KEY (`created_user`) REFERENCES `is_users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `is_barang_keluar_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `is_barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of is_barang_keluar
-- ----------------------------
INSERT INTO `is_barang_keluar` VALUES ('TK-2018-0000001', '2018-07-17', 'B000001', '500', 'Approve', '3', '2018-07-17 19:17:24');
INSERT INTO `is_barang_keluar` VALUES ('TK-2018-0000002', '2018-07-17', 'B000002', '100', 'Reject', '3', '2018-07-17 19:17:01');
INSERT INTO `is_barang_keluar` VALUES ('TK-2023-0000003', '2023-03-21', 'B000002', '490', 'Approve', '3', '2023-03-21 22:35:17');
INSERT INTO `is_barang_keluar` VALUES ('TK-2023-0000004', '2023-03-27', 'B000001', '200', 'Reject', '1', '2023-03-27 23:28:22');
INSERT INTO `is_barang_keluar` VALUES ('TK-2023-0000005', '2023-03-27', 'B000001', '300', 'Approve', '1', '2023-03-27 23:27:40');

-- ----------------------------
-- Table structure for `is_barang_masuk`
-- ----------------------------
DROP TABLE IF EXISTS `is_barang_masuk`;
CREATE TABLE `is_barang_masuk` (
  `id_barang_masuk` varchar(15) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `id_barang` varchar(7) NOT NULL,
  `jumlah_masuk` int(11) NOT NULL,
  `created_user` smallint(6) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_barang_masuk`),
  KEY `id_barang` (`id_barang`),
  KEY `created_user` (`created_user`),
  CONSTRAINT `is_barang_masuk_ibfk_1` FOREIGN KEY (`created_user`) REFERENCES `is_users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `is_barang_masuk_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `is_barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of is_barang_masuk
-- ----------------------------
INSERT INTO `is_barang_masuk` VALUES ('TM-2018-0000001', '2018-07-17', 'B000001', '1000', '3', '2018-07-17 19:06:31');
INSERT INTO `is_barang_masuk` VALUES ('TM-2018-0000002', '2018-07-17', 'B000002', '500', '3', '2018-07-17 19:06:39');
INSERT INTO `is_barang_masuk` VALUES ('TM-2018-0000003', '2018-07-17', 'B000003', '100', '3', '2018-07-17 19:06:56');
INSERT INTO `is_barang_masuk` VALUES ('TM-2023-0000004', '2023-03-27', 'B000002', '100', '1', '2023-03-27 22:16:47');
INSERT INTO `is_barang_masuk` VALUES ('TM-2023-0000005', '2023-03-27', 'B000002', '20', '1', '2023-03-27 22:17:49');

-- ----------------------------
-- Table structure for `is_jenis_barang`
-- ----------------------------
DROP TABLE IF EXISTS `is_jenis_barang`;
CREATE TABLE `is_jenis_barang` (
  `id_jenis` int(11) NOT NULL AUTO_INCREMENT,
  `nama_jenis` varchar(50) NOT NULL,
  `created_user` smallint(6) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_user` smallint(6) NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_jenis`),
  KEY `created_user` (`created_user`),
  KEY `updated_user` (`updated_user`),
  CONSTRAINT `is_jenis_barang_ibfk_1` FOREIGN KEY (`created_user`) REFERENCES `is_users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `is_jenis_barang_ibfk_2` FOREIGN KEY (`updated_user`) REFERENCES `is_users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of is_jenis_barang
-- ----------------------------
INSERT INTO `is_jenis_barang` VALUES ('1', 'Pupuk Kimia Alam', '3', '2017-03-12 09:59:45', '3', '2017-03-12 10:01:03');
INSERT INTO `is_jenis_barang` VALUES ('2', 'Pupuk Hijau', '3', '2017-03-12 09:59:58', '3', '2017-03-12 10:01:06');
INSERT INTO `is_jenis_barang` VALUES ('3', 'Herbisida', '3', '2017-03-12 10:00:08', '3', '2017-03-12 10:01:10');
INSERT INTO `is_jenis_barang` VALUES ('4', 'Fungisida', '3', '2017-03-12 10:00:19', '3', '2017-03-12 10:01:13');
INSERT INTO `is_jenis_barang` VALUES ('5', 'Insektisida', '3', '2017-03-12 10:00:29', '3', '2017-03-12 10:01:16');
INSERT INTO `is_jenis_barang` VALUES ('6', 'Bahan Stimulasi', '3', '2017-03-12 10:00:39', '3', '2017-03-12 10:01:19');
INSERT INTO `is_jenis_barang` VALUES ('7', 'Bahan Kimia Pengolahan', '3', '2017-03-12 10:00:49', '3', '2017-03-12 10:01:22');
INSERT INTO `is_jenis_barang` VALUES ('8', 'test 2', '1', '2023-03-27 05:12:08', '1', '2023-03-27 05:12:23');

-- ----------------------------
-- Table structure for `is_satuan`
-- ----------------------------
DROP TABLE IF EXISTS `is_satuan`;
CREATE TABLE `is_satuan` (
  `id_satuan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_satuan` varchar(30) NOT NULL,
  `created_user` smallint(6) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_user` smallint(6) NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_satuan`),
  KEY `created_user` (`created_user`),
  KEY `updated_user` (`updated_user`),
  CONSTRAINT `is_satuan_ibfk_1` FOREIGN KEY (`created_user`) REFERENCES `is_users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `is_satuan_ibfk_2` FOREIGN KEY (`updated_user`) REFERENCES `is_users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of is_satuan
-- ----------------------------
INSERT INTO `is_satuan` VALUES ('1', 'Gram', '3', '2017-03-12 09:57:35', '3', '2017-03-12 09:57:45');
INSERT INTO `is_satuan` VALUES ('2', 'Kilogram', '3', '2017-03-12 09:58:07', '3', '2017-03-12 09:59:01');
INSERT INTO `is_satuan` VALUES ('3', 'Meter', '3', '2017-03-12 09:58:19', '3', '2017-03-12 09:59:04');
INSERT INTO `is_satuan` VALUES ('4', 'Liter', '3', '2017-03-12 09:58:25', '3', '2017-03-12 09:59:08');
INSERT INTO `is_satuan` VALUES ('5', 'Botol', '3', '2017-03-12 09:58:36', '3', '2017-03-12 09:59:10');
INSERT INTO `is_satuan` VALUES ('6', 'Lebar', '3', '2017-03-12 09:58:46', '3', '2017-03-12 09:59:13');
INSERT INTO `is_satuan` VALUES ('7', 'Tabung', '3', '2017-03-12 09:58:52', '1', '2023-03-27 10:24:14');

-- ----------------------------
-- Table structure for `is_users`
-- ----------------------------
DROP TABLE IF EXISTS `is_users`;
CREATE TABLE `is_users` (
  `id_user` smallint(6) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `nama_user` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `telepon` varchar(13) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `hak_akses` enum('Super Admin','Manajer','Gudang') NOT NULL,
  `status` enum('aktif','blokir') NOT NULL DEFAULT 'aktif',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_user`),
  KEY `level` (`hak_akses`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of is_users
-- ----------------------------
INSERT INTO `is_users` VALUES ('1', 'admin', 'Brian Musmardiko', '202cb962ac59075b964b07152d234b70', 'brian.musmardiko@senkatech.id', '0987564738219', 'indrasatya.jpg', 'Super Admin', 'aktif', '2016-05-01 15:42:53', '2023-03-30 05:45:31');
INSERT INTO `is_users` VALUES ('2', 'manajer', 'Kadina Putri', '202cb962ac59075b964b07152d234b70', 'kadinaputri@gmail.com', '085680892909', 'kadina.png', 'Manajer', 'aktif', '2016-08-01 15:42:53', '2018-07-17 19:03:28');
INSERT INTO `is_users` VALUES ('3', 'user', 'Danang Kesuma', '202cb962ac59075b964b07152d234b70', 'danang@gmail.com', '085758858851', '1469574162_users-15.png', 'Gudang', 'aktif', '2017-03-11 21:41:46', '2023-03-30 05:36:21');
INSERT INTO `is_users` VALUES ('7', 'manggar', 'Sukma Manggar Suci Putri', '8b9ecb405234fcea52154975b16fe6d6', null, null, null, 'Super Admin', 'aktif', '2023-03-30 05:50:52', '2023-03-30 05:50:52');
