-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 02, 2011 at 06:58 PM
-- Server version: 5.1.37
-- PHP Version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dbrepositorie`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminen`
--

CREATE TABLE IF NOT EXISTS `adminen` (
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `NotActive` enum('Y','N') NOT NULL DEFAULT 'N',
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `adminen`
--

INSERT INTO `adminen` (`username`, `password`, `NotActive`) VALUES
('owm', '06a99968554c63946fc078759271bdba', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `bantuan_en`
--

CREATE TABLE IF NOT EXISTS `bantuan_en` (
  `id_bantuan` int(11) NOT NULL AUTO_INCREMENT,
  `pertanyaan` varchar(100) NOT NULL,
  `jawaban` varchar(200) NOT NULL,
  PRIMARY KEY (`id_bantuan`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `bantuan_en`
--

INSERT INTO `bantuan_en` (`id_bantuan`, `pertanyaan`, `jawaban`) VALUES
(1, 'Bagaimana melihat daftar Tugas Akhir mahasiswa', 'Pilih Menu Tugas Akhir dibagian Menu Utama, kemudian isikan judul Tugas Akhir selanjutnya klik Cari. Jika ingin melihat semua, kosongkan form pencarian, klik cari.'),
(4, 'Bagaimana melihat daftar Jurnal?', 'Untuk melihat daftar Jurnal..');

-- --------------------------------------------------------

--
-- Table structure for table `jurnal`
--

CREATE TABLE IF NOT EXISTS `jurnal` (
  `id_jurnal` int(11) NOT NULL AUTO_INCREMENT,
  `nama_penulis` varchar(50) NOT NULL,
  `title_jurnal` varchar(255) NOT NULL,
  `name` varchar(50) NOT NULL,
  `type` varchar(30) NOT NULL,
  `size` int(11) NOT NULL,
  `path` varchar(60) NOT NULL,
  `NotActive` enum('Y','N') NOT NULL DEFAULT 'N',
  `tanggal` datetime NOT NULL,
  PRIMARY KEY (`id_jurnal`),
  UNIQUE KEY `nama_penulis` (`nama_penulis`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `jurnal`
--

INSERT INTO `jurnal` (`id_jurnal`, `nama_penulis`, `title_jurnal`, `name`, `type`, `size`, `path`, `NotActive`, `tanggal`) VALUES
(1, 'suendri phpbego', 'Jaringan Syarat Tiruan pada penjadwalan Kuliah AMIK Royal Kisaran', '11.txt', 'text/plain', 41, '../jurnal/73c53a9912b0be25a0609c44791f6faa..txt', 'N', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `menu_utama`
--

CREATE TABLE IF NOT EXISTS `menu_utama` (
  `utama_title` varchar(25) NOT NULL,
  `utama_link` varchar(50) NOT NULL,
  `NotActive` enum('Y','N') NOT NULL DEFAULT 'N',
  PRIMARY KEY (`utama_title`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu_utama`
--

INSERT INTO `menu_utama` (`utama_title`, `utama_link`, `NotActive`) VALUES
('Tugas Akhir', 'index.php?main=repo_ta', 'N'),
('Penelitian', 'index.php?main=repo_riset', 'N'),
('Jurnal', 'index.php?main=repo_jurnal', 'N'),
('Donasi', 'index.php?main=repo_donasi', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `owm_feedback`
--

CREATE TABLE IF NOT EXISTS `owm_feedback` (
  `feed_id` int(11) NOT NULL AUTO_INCREMENT,
  `feed_nama` varchar(50) NOT NULL,
  `feed_email` varchar(30) NOT NULL,
  `feed_pesan` text NOT NULL,
  `tanggal` datetime NOT NULL,
  `NotActive` enum('Y','N') NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`feed_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `owm_feedback`
--

INSERT INTO `owm_feedback` (`feed_id`, `feed_nama`, `feed_email`, `feed_pesan`, `tanggal`, `NotActive`) VALUES
(22, 'Claura Al Hafiz Geisya', 'clara@yahoo.com', 'Open Repository Campus 1.0 Cukup menarik. Terus dikembangkan ya...hehehe.. nanti tak kasih Donasi\r\n\r\nBank Bukopin cb Kisaran, an Suendri Norek. 103925830', '2011-07-01 15:39:00', 'N'),
(24, 'Clara El-Hafiz Geisya', 'clara@gmail.com', 'wah..mantab.. ijin download yach...', '2011-07-02 15:11:01', 'N'),
(25, 'asas', 'asas', 'asas', '2011-07-02 15:32:39', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `owm_news`
--

CREATE TABLE IF NOT EXISTS `owm_news` (
  `id_news` int(11) NOT NULL AUTO_INCREMENT,
  `judul` varchar(100) NOT NULL,
  `isi_pesan` text NOT NULL,
  `tanggal` datetime NOT NULL,
  `NotActive` enum('Y','N') NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id_news`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `owm_news`
--

INSERT INTO `owm_news` (`id_news`, `judul`, `isi_pesan`, `tanggal`, `NotActive`) VALUES
(5, 'Launching Perdana', 'Launching Perdana Open Repository Campus versi 1.0 Oleh phpbego. Kunjungi website http://openwebmurah.com untuk lebih lanjut. Ditunggu Kritik dan saran dari teman-teman. Open Repository campus dibawah Lisensi GNU/GPL, Selamanya Open Source', '2011-07-01 23:49:46', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `riset`
--

CREATE TABLE IF NOT EXISTS `riset` (
  `id_riset` int(11) NOT NULL AUTO_INCREMENT,
  `nama_peneliti` varchar(50) NOT NULL,
  `title_riset` varchar(255) NOT NULL,
  `name` varchar(50) NOT NULL,
  `type` varchar(30) NOT NULL,
  `size` int(11) NOT NULL,
  `path` varchar(60) NOT NULL,
  `NotActive` enum('Y','N') NOT NULL DEFAULT 'N',
  `tanggal` datetime NOT NULL,
  PRIMARY KEY (`id_riset`),
  UNIQUE KEY `nama_peneliti` (`nama_peneliti`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `riset`
--

INSERT INTO `riset` (`id_riset`, `nama_peneliti`, `title_riset`, `name`, `type`, `size`, `path`, `NotActive`, `tanggal`) VALUES
(1, 'suendri', 'Jaringan Syaraf Tiruan Sistem Pendukung Keputusan Penjadwalan Kuliah pada AMIK Royla Kisaran', '11.txt', 'text/plain', 41, '../riset/97598afeebc7fa1a9a2e630fa7af9cbe..txt', 'N', '0000-00-00 00:00:00'),
(3, 'Claura Al Hafiz Geisya', 'asa', '11.txt', 'text/plain', 41, '../riset/407959e08b1c31804bbbf5a0c85f03b2..txt', 'Y', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE IF NOT EXISTS `status` (
  `status_id` int(11) NOT NULL AUTO_INCREMENT,
  `status_nama` varchar(100) NOT NULL,
  `status_moto` varchar(100) NOT NULL,
  `status_kontak` varchar(255) NOT NULL,
  `status_kaki` varchar(255) NOT NULL,
  `status_type_file` text NOT NULL,
  `status_max_file` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  PRIMARY KEY (`status_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`status_id`, `status_nama`, `status_moto`, `status_kontak`, `status_kaki`, `status_type_file`, `status_max_file`, `tanggal`) VALUES
(1, 'Universitas Open Web Murah Sumatera Utara', 'Arsip Tugas Akhir, penelitian dan Jurnal', 'Pelayanan dan Pengembangan Open Repository Campus HP: 085263616901 atau email: endrie_159[at]yahoo.com, Kunjungi website kami http://openwebmurah.com', 'Hak Cipta 2011. Open Repository Campus versi 1.0 Under Licence GNU/GPL, visit our site http://openwebmurah.com', '.pdf,.doc,.ppt,.xls,.docx,.pptx,.xlsx,.txt', 10000000, '2011-06-12');

-- --------------------------------------------------------

--
-- Table structure for table `ta`
--

CREATE TABLE IF NOT EXISTS `ta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nim` varchar(15) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `judul` varchar(250) NOT NULL,
  `tahun` varchar(5) NOT NULL,
  `tanggal` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nim` (`nim`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `ta`
--

INSERT INTO `ta` (`id`, `nim`, `nama`, `judul`, `tahun`, `tanggal`) VALUES
(1, '0510115262159', 'Suendri', 'Perancangan dan Implementasi VoIP ( Voice Over Internet Protocol ) Pada Jaringan LAN UPI-YPTK Padang', '2009', '0000-00-00 00:00:00'),
(2, '10022010', 'El Muhammady', 'Jaringan Syaraf Tiruan pada Penjadwalan Kuliah AMIK Royal Kisaran', '2010', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tautan`
--

CREATE TABLE IF NOT EXISTS `tautan` (
  `tautan_title` varchar(25) NOT NULL,
  `tautan_link` varchar(50) NOT NULL,
  `NotActive` enum('Y','N') NOT NULL DEFAULT 'N',
  PRIMARY KEY (`tautan_title`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tautan`
--

INSERT INTO `tautan` (`tautan_title`, `tautan_link`, `NotActive`) VALUES
('Sisfo AMIK Royal', 'https://amikroyal.ac.id', 'N'),
('Perpustakaan', 'http://library.amikroyal.ac.id', 'N'),
('OWM', 'http://openwebmurah.com', 'N');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
