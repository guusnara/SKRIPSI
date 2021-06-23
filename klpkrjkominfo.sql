-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 30 Okt 2017 pada 05.37
-- Versi Server: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `klpkrjkominfo`
--
CREATE DATABASE IF NOT EXISTS `klpkrjkominfo` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `klpkrjkominfo`;

-- --------------------------------------------------------

--
-- Struktur dari tabel `dt_admin`
--

CREATE TABLE IF NOT EXISTS `dt_admin` (
  `id_admin` int(5) NOT NULL AUTO_INCREMENT,
  `nama_admin` varchar(30) NOT NULL,
  `no_telp` varchar(12) NOT NULL,
  `username` varchar(16) NOT NULL,
  `password` varchar(32) NOT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data untuk tabel `dt_admin`
--

INSERT INTO `dt_admin` (`id_admin`, `nama_admin`, `no_telp`, `username`, `password`) VALUES
(1, 'Administrator', '08123456789', 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dt_berkas`
--

CREATE TABLE IF NOT EXISTS `dt_berkas` (
  `id_berkas` int(7) NOT NULL AUTO_INCREMENT,
  `nama_berkas` varchar(30) NOT NULL,
  `tipe_berkas` varchar(4) NOT NULL,
  `ukuran_berkas` varchar(15) NOT NULL,
  `url_berkas` text NOT NULL,
  `NIP` bigint(18) NOT NULL,
  PRIMARY KEY (`id_berkas`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data untuk tabel `dt_berkas`
--

INSERT INTO `dt_berkas` (`id_berkas`, `nama_berkas`, `tipe_berkas`, `ukuran_berkas`, `url_berkas`, `NIP`) VALUES
(7, '2 of CxNUmeWUQAAD_uR.jpg', 'jpg', '0.02', '726235127312312334/dtberkas/726235127312312334_2 of CxNUmeWUQAAD_uR.jpg', 726235127312312334),
(8, 'bi.docx', 'docx', '0.02', '726235127312312334/dtberkas/726235127312312334_bi.docx', 726235127312312334),
(9, 'PADANG SAMBIAN KLOD (572).xlsx', 'xlsx', '0.74', '123456789101112132/dtberkas/123456789101112132_PADANG SAMBIAN KLOD (572).xlsx', 123456789101112132);

-- --------------------------------------------------------

--
-- Struktur dari tabel `dt_bidang`
--

CREATE TABLE IF NOT EXISTS `dt_bidang` (
  `id_bidang` int(11) NOT NULL AUTO_INCREMENT,
  `nama_bidang` varchar(50) NOT NULL,
  PRIMARY KEY (`id_bidang`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=44 ;

--
-- Dumping data untuk tabel `dt_bidang`
--

INSERT INTO `dt_bidang` (`id_bidang`, `nama_bidang`) VALUES
(39, 'Bidang Komunikasi dan Informasi Publik'),
(40, 'Bidang e-Goverment'),
(41, 'Bidang Pengelolaan Smart City'),
(42, 'Bidang Statistik dan Persandian'),
(43, '-');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dt_dtl_brks_krj`
--

CREATE TABLE IF NOT EXISTS `dt_dtl_brks_krj` (
  `id_dtl_brks_krj` int(5) NOT NULL AUTO_INCREMENT,
  `id_dtl_kerja` int(5) NOT NULL,
  `id_berkas` int(7) NOT NULL,
  PRIMARY KEY (`id_dtl_brks_krj`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data untuk tabel `dt_dtl_brks_krj`
--

INSERT INTO `dt_dtl_brks_krj` (`id_dtl_brks_krj`, `id_dtl_kerja`, `id_berkas`) VALUES
(4, 10, 5),
(6, 9, 7),
(7, 9, 8);

-- --------------------------------------------------------

--
-- Struktur dari tabel `dt_dtl_kerja`
--

CREATE TABLE IF NOT EXISTS `dt_dtl_kerja` (
  `id_dtl_kerja` int(5) NOT NULL AUTO_INCREMENT,
  `id_kerja` int(5) NOT NULL,
  `ket` text NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_target_selesai` date DEFAULT NULL,
  `tgl_selesai` date DEFAULT NULL,
  `persentase` varchar(3) NOT NULL,
  `status` enum('0','1','2','3') NOT NULL,
  PRIMARY KEY (`id_dtl_kerja`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `dt_dtl_pegawai_krj`
--

CREATE TABLE IF NOT EXISTS `dt_dtl_pegawai_krj` (
  `id_dtl_pegawai_krj` int(5) NOT NULL AUTO_INCREMENT,
  `id_dtl_kerja` int(5) NOT NULL,
  `NIP` bigint(18) NOT NULL,
  PRIMARY KEY (`id_dtl_pegawai_krj`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `dt_jabatan`
--

CREATE TABLE IF NOT EXISTS `dt_jabatan` (
  `id_jabatan` int(5) NOT NULL AUTO_INCREMENT,
  `nama_jabatan` varchar(70) NOT NULL,
  `role` enum('0','1') NOT NULL,
  PRIMARY KEY (`id_jabatan`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data untuk tabel `dt_jabatan`
--

INSERT INTO `dt_jabatan` (`id_jabatan`, `nama_jabatan`, `role`) VALUES
(1, 'Kepala Dinas', '1'),
(2, 'Sekretaris', '0'),
(3, 'Kepala Sub Bagian Perencanaan ', '0'),
(4, 'Kepala Sub Bagian Keuangan', '0'),
(5, 'Kepala Sub Bagian Umum & Kepegawaian', '0'),
(6, 'Kepala Bidang', '0'),
(7, 'Kepala Seksi Pengelolaan Komunikasi & Informasi Publik', '0'),
(8, 'Kepala Seksi Layanan Komunikasi & Informasi Publik', '0'),
(9, 'Kepala Seksi Kemitraan dan Media Komunikasi & Informasi Publik', '0'),
(10, 'Kepala Seksi Layanan Infrastruktur & Teknologi', '0'),
(11, 'Kepala Seksi Penyebaran Sistem Komunikasi', '0'),
(12, 'Kepala Seksi Tata Kelola e-Government', '0'),
(13, 'Kepala Seksi Pengelolaan Ekosistem Smart City', '0'),
(14, 'Kepala Seksi Pengelolaan Data & Interoperabilitas', '0'),
(15, 'Kepala Seksi Pengembangan Aplikasi', '0'),
(16, 'Kepala Seksi Pengelolaan Statistik Sektoral', '0'),
(17, 'Kepala Seksi Analisa Data Statistik', '0'),
(18, 'Kepala Seksi Keamanan Informasi & Persandian', '0'),
(19, 'Kepala Upt. Penyiaran Publik', '0'),
(20, 'Kepala Upt. Pusat Informasi Smart City', '0'),
(21, 'Staff Bidang', '0'),
(22, 'Staff Upt. Penyiaran Publik', '0'),
(23, 'Staff Upt. Pusat Informasi Smart City', '0'),
(24, 'Staff', '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dt_kerja`
--

CREATE TABLE IF NOT EXISTS `dt_kerja` (
  `id_kerja` int(5) NOT NULL AUTO_INCREMENT,
  `nama_kerja` varchar(50) NOT NULL,
  `NIP` bigint(18) NOT NULL,
  `ket` text NOT NULL,
  `id_berkas` int(7) DEFAULT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_target_selesai` date DEFAULT NULL,
  `tgl_selesai` date DEFAULT NULL,
  `status` enum('0','1') NOT NULL,
  PRIMARY KEY (`id_kerja`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `dt_pegawai`
--

CREATE TABLE IF NOT EXISTS `dt_pegawai` (
  `NIP` bigint(18) NOT NULL,
  `nama_pegawai` varchar(50) NOT NULL,
  `id_bidang` int(5) NOT NULL,
  `id_jabatan` int(5) NOT NULL,
  `jk` enum('L','P') NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(12) NOT NULL,
  `email` varchar(40) NOT NULL,
  `url_photo` text NOT NULL,
  `username` varchar(16) NOT NULL,
  `password` varchar(32) NOT NULL,
  PRIMARY KEY (`NIP`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `dt_pegawai`
--

INSERT INTO `dt_pegawai` (`NIP`, `nama_pegawai`, `id_bidang`, `id_jabatan`, `jk`, `alamat`, `no_telp`, `email`, `url_photo`, `username`, `password`) VALUES
(111111111111111111, 'Ayu Sri', 42, 21, 'P', 'Jalan Manja', '085738840078', 'ini@email.com', '111111111111111111/111111111111111111.jpg', 'userayu', '1bbd886460827015e5d605ed44252251'),
(123456789101112132, 'Made Nyoman', 39, 6, 'L', 'Jalan ini', '085738845567', 'tes@email.ini', '123456789101112132/123456789101112132.jpg', 'usermade', '1bbd886460827015e5d605ed44252251'),
(196605251993031010, 'I Dewa Made Agung, S.E., M.Si', 43, 1, 'L', 'Jalan Majapahit No.1 Graha Sewaka Dharma Lt.3', '081234567890', 'kadis@email.com', '196605251993031010/196605251993031010.jpg', 'kadis1', '1bbd886460827015e5d605ed44252251'),
(726235127312312334, 'Dogler', 43, 2, 'L', 'dimana', '089765435278', 'dekaz@ymail.com', '726235127312312334/726235127312312334.jpg', 'userdogler', '1bbd886460827015e5d605ed44252251');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dt_revisi_kerja`
--

CREATE TABLE IF NOT EXISTS `dt_revisi_kerja` (
  `id_revisi_kerja` int(5) NOT NULL AUTO_INCREMENT,
  `id_dtl_kerja` int(5) NOT NULL,
  `ket` text NOT NULL,
  `status` enum('0','1') NOT NULL,
  PRIMARY KEY (`id_revisi_kerja`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data untuk tabel `dt_revisi_kerja`
--

INSERT INTO `dt_revisi_kerja` (`id_revisi_kerja`, `id_dtl_kerja`, `ket`, `status`) VALUES
(11, 9, 'y', '1'),
(12, 9, 'asdsdadadsas', '1'),
(13, 10, 'xzx', '1');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
