/*
Navicat MySQL Data Transfer

Source Server         : LOCALHOST
Source Server Version : 100108
Source Host           : localhost:3306
Source Database       : dbpaketsetiawati

Target Server Type    : MYSQL
Target Server Version : 100108
File Encoding         : 65001

Date: 2016-05-20 20:11:30
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tb_angsuran
-- ----------------------------
DROP TABLE IF EXISTS `tb_angsuran`;
CREATE TABLE `tb_angsuran` (
  `no_ang` int(100) NOT NULL AUTO_INCREMENT,
  `id_user` int(14) NOT NULL,
  `id_pemesanan` varchar(4) NOT NULL,
  `id_pelanggan` varchar(4) NOT NULL,
  `tgl_awal` date NOT NULL,
  `tgl_akhir` date NOT NULL,
  `jml_hari` varchar(15) NOT NULL,
  `item_id` int(100) NOT NULL,
  `tgl_angsuran` date NOT NULL,
  `create_at` datetime NOT NULL,
  `update_at` datetime NOT NULL,
  PRIMARY KEY (`no_ang`,`id_pemesanan`,`item_id`)
) ENGINE=MyISAM AUTO_INCREMENT=579 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for tb_kelompok
-- ----------------------------
DROP TABLE IF EXISTS `tb_kelompok`;
CREATE TABLE `tb_kelompok` (
  `id_kelompok` int(14) NOT NULL AUTO_INCREMENT,
  `nama_kelompok` varchar(60) NOT NULL,
  `status_cd` enum('normal','duplicated','nullified') DEFAULT 'normal',
  `create_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `create_id_user` int(14) DEFAULT NULL,
  `update_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `update_id_user` int(14) DEFAULT NULL,
  `nullified_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `nullified_id_user` int(14) DEFAULT NULL,
  PRIMARY KEY (`id_kelompok`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for tb_paket
-- ----------------------------
DROP TABLE IF EXISTS `tb_paket`;
CREATE TABLE `tb_paket` (
  `id_paket` int(14) NOT NULL AUTO_INCREMENT,
  `nama_paket` varchar(15) NOT NULL,
  `harga_paket` varchar(15) NOT NULL,
  `administrasi` varchar(15) NOT NULL,
  PRIMARY KEY (`id_paket`)
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for tb_paket_detail
-- ----------------------------
DROP TABLE IF EXISTS `tb_paket_detail`;
CREATE TABLE `tb_paket_detail` (
  `id_paket_detail` int(14) NOT NULL AUTO_INCREMENT,
  `id_paket` varchar(14) DEFAULT NULL,
  `nama_paket_detail` varchar(70) DEFAULT NULL,
  `isi` varchar(70) DEFAULT NULL,
  PRIMARY KEY (`id_paket_detail`)
) ENGINE=MyISAM AUTO_INCREMENT=74 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for tb_pelanggan
-- ----------------------------
DROP TABLE IF EXISTS `tb_pelanggan`;
CREATE TABLE `tb_pelanggan` (
  `id_pelanggan` varchar(4) NOT NULL,
  `id_kelompok` int(14) DEFAULT NULL,
  `nama` varchar(70) NOT NULL,
  `alamat` text NOT NULL,
  `telepon` varchar(20) NOT NULL,
  `tgl_daftar` datetime NOT NULL,
  `status_cd` enum('normal','duplicated','nullified') DEFAULT 'normal',
  `create_at` datetime NOT NULL,
  `create_id_user` int(14) DEFAULT NULL,
  `update_at` datetime NOT NULL,
  `update_id_user` int(11) DEFAULT NULL,
  `nullified_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `nullified_id_user` int(14) DEFAULT NULL,
  PRIMARY KEY (`id_pelanggan`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for tb_pemesanan
-- ----------------------------
DROP TABLE IF EXISTS `tb_pemesanan`;
CREATE TABLE `tb_pemesanan` (
  `id_pemesanan` varchar(4) NOT NULL,
  `id_pelanggan` varchar(4) NOT NULL,
  `id_paket` int(14) NOT NULL,
  `id_kelompok` int(14) NOT NULL,
  `kd_buku` varchar(6) NOT NULL,
  `adm` varchar(15) NOT NULL,
  `harga` varchar(15) NOT NULL,
  `keterangan` text NOT NULL,
  `tgl_pesan` datetime NOT NULL,
  `status` enum('LUNAS','BELUM','TIDAK AKTIF') NOT NULL DEFAULT 'BELUM',
  `status_cd` enum('normal','duplicated','nullified') DEFAULT 'normal',
  `create_at` datetime NOT NULL,
  `create_id_user` int(14) DEFAULT NULL,
  `update_at` datetime NOT NULL,
  `update_id_user` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_pemesanan`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for tb_user
-- ----------------------------
DROP TABLE IF EXISTS `tb_user`;
CREATE TABLE `tb_user` (
  `id_user` int(14) NOT NULL AUTO_INCREMENT,
  `id_kelompok` int(14) DEFAULT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_user` varchar(50) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `status_cd` enum('normal','duplicated','nullified') DEFAULT 'normal',
  `create_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `create_id_user` int(14) DEFAULT NULL,
  `update_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `update_id_user` int(14) DEFAULT NULL,
  `level` enum('admin','pegawai','subadmin') DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
