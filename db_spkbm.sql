-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 21 Jul 2024 pada 17.24
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_spkbm`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `alternatif`
--

CREATE TABLE `alternatif` (
  `id` int(11) NOT NULL,
  `nama_alternatif` varchar(50) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `alternatif`
--

INSERT INTO `alternatif` (`id`, `nama_alternatif`, `keterangan`) VALUES
(1, 'Sistem Informasi', 'Fokus bidang Sistem Informasi adalah integrasi teknologi informasi dengan proses bisnis guna meningkatkan efisiensi, produktivitas, dan pengambilan keputusan. Sistem Informasi melibatkan pengembangan perangkat lunak, manajemen data, infrastruktur teknologi, keamanan informasi, dan dukungan pengambilan keputusan.\r\n\r\n'),
(2, 'Jaringan Komputer', 'Fokus bidang Jaringan Komputer adalah mencakup berbagai aspek teknis dan manajerial, seperti arsitektur jaringan, protokol komunikasi, keamanan jaringan, serta pemeliharaan dan optimasi kinerja jaringan. Jaringan komputer memungkinkan transfer data secara efisien dan andal antara perangkat dalam suatu organisasi atau antarorganisasi, memainkan peran penting dalam komunikasi modern, baik untuk keperluan pribadi maupun bisnis.'),
(3, 'Rekayasa Perangkat Lunak', 'Bidang Rekayasa Perangkat Lunak mencakup berbagai aspek seperti analisis kebutuhan, desain sistem, pengkodean, verifikasi dan validasi, serta manajemen proyek. Disiplin ini juga mengutamakan penggunaan praktik terbaik dan alat bantu yang memungkinkan pengembangan perangkat lunak secara kolaboratif dan iteratif. Berfokus pada  berfokus pada perancangan, pengembangan, pengujian, dan pemeliharaan perangkat lunak dengan metode yang sistematis dan terstruktur.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `hasil_rekomendasi`
--

CREATE TABLE `hasil_rekomendasi` (
  `id` int(11) NOT NULL,
  `nim` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `hasil` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `hasil_rekomendasi`
--

INSERT INTO `hasil_rekomendasi` (`id`, `nim`, `nama`, `hasil`) VALUES
(12, '2005903040096', 'Maulana Rafinda', 'Sistem Informasi'),
(14, '2005903040044', 'Ulia Saputra', 'Rekayasa Perangkat Lunak'),
(15, '2005903040023', 'Meli Riskina', 'Jaringan'),
(16, '2005903040013', 'Dewi Candra', 'Sistem Informasi'),
(17, '2005903040018', 'Karmila Damayanti', 'Sistem Informasi'),
(18, '2005903040019', 'Kartika', 'Sistem Informasi'),
(19, '2005903040055', 'Fadhila Annisa', 'Sistem Informasi'),
(20, '2105903040015', 'Nofrian Safutra ', 'Rekayasa Perangkat Lunak'),
(21, '2005903040109', 'Pevi Alpiyah Rami', 'Sistem Informasi'),
(22, '2005903040009', 'Citra Srikandi', 'Sistem Informasi'),
(23, '2005903040089', 'Aida Farina', 'Sistem Informasi'),
(25, '2105903040067', 'Febrianti', 'Sistem Informasi'),
(27, '2105903040113', 'Rosa Agustina', 'Sistem Informasi'),
(28, '2105903040108', 'Yanti', 'Sistem Informasi'),
(29, '2105903040020', 'Farid ', 'Sistem Informasi'),
(30, '2105903040111', 'Mizan Aulia', 'Rekayasa Perangkat Lunak'),
(31, '2005903040097', 'Ulfa Mahfuza', 'Sistem Informasi'),
(32, '2105903040117', 'Giva Marliana', 'Jaringan'),
(33, '2005903040103', 'Diana Sari Nasution', 'Sistem Informasi'),
(34, '2005903040008', 'Asmaul Husna Away ', 'Sistem Informasi'),
(35, '2005903040024', 'Mita Ramelia ', 'Sistem Informasi'),
(36, '2105903040023', 'Muhammad danil', 'Rekayasa Perangkat Lunak'),
(37, '2105903040046', 'Shaniza hisyam', 'Rekayasa Perangkat Lunak'),
(38, '2005903040090', 'Sofia', 'Sistem Informasi'),
(39, '2105903040084', 'Miya Amalia Putri', 'Sistem Informasi'),
(40, '2105903040037', 'Riski farmala', 'Sistem Informasi'),
(41, '2105903040050', 'Nur Bariah', 'Rekayasa Perangkat Lunak'),
(42, '2105903040008', 'Nawawi', 'Sistem Informasi'),
(43, '2105903040109', 'Melja Siska ', 'Rekayasa Perangkat Lunak'),
(44, '2005903040067', 'Agus Berutu', 'Sistem Informasi'),
(45, '2005903040106', 'Efendi', 'Sistem Informasi'),
(46, '2105903040114', 'Fitri khalisma ', 'Jaringan'),
(47, '2105903040076', 'nazly pramuditha', 'Sistem Informasi'),
(48, '2105903040066', 'SYAIKHUL MUANNAS ', 'Rekayasa Perangkat Lunak'),
(49, '2005903040063', 'ASEP NANANG SUPRIATNA', 'Sistem Informasi'),
(50, '2005903040105', 'Nurhalimah', 'Sistem Informasi'),
(51, '2005903040016', 'irawani', 'Sistem Informasi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai_mk`
--

CREATE TABLE `nilai_mk` (
  `id` int(11) NOT NULL,
  `nim` varchar(13) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `nilaiSI` float NOT NULL,
  `nilaiJ` float NOT NULL,
  `nilaiRPL` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `nilai_mk`
--

INSERT INTO `nilai_mk` (`id`, `nim`, `nama`, `nilaiSI`, `nilaiJ`, `nilaiRPL`) VALUES
(11, '2005903040019', 'Kartika', 9, 9, 9),
(19, '2005903040020', 'Kartika', 0, 0, 0),
(21, '2005903040011', 'riyana', 1.66667, 1.66667, 1.66667),
(24, '2005903040096', 'Maulana Rafinda', 10.6667, 7.5, 12),
(26, '2005903040044', 'Ulia Saputra', 9.33333, 6.66667, 10.5),
(27, '2005903040023', 'Meli Riskina', 9.83333, 6.66667, 10),
(28, '2005903040013', 'Dewi Candra', 9.33333, 7.33333, 10.5),
(31, '2005903040018', 'Karmila Damayanti', 8.83333, 7.5, 10),
(33, '2005903040055', 'Fadhila Annisa', 9.83333, 6.66667, 10.5),
(34, '2105903040015', 'Nofrian Safutra ', 5.66667, 7.66667, 9),
(35, '2005903040109', 'Pevi Alpiyah Rami', 8.33333, 7.5, 10),
(36, '2005903040009', 'Citra Srikandi', 9, 7.5, 10),
(37, '2005903040089', 'Aida Farina', 10.3333, 7.5, 10.5),
(38, '2105903040091', 'Ari Alfiandi', 11.5, 4, 6),
(39, '2005903040059', 'Ratih Sari Ayu', 11.5, 8, 10.5),
(40, '2105903040067', 'Febrianti', 11, 8, 12),
(41, '2105903040113', 'Rosa Agustina', 9.83333, 7.66667, 10),
(42, '2105903040108', 'Yanti', 10.0833, 7.66667, 3),
(43, '2105903040020', 'Farid ', 7.83333, 8, 6.75),
(44, '2105903040111', 'Mizan Aulia', 8, 7.5, 11.25),
(45, '2005903040097', 'Ulfa Mahfuza', 9.66667, 8, 9.5),
(46, '2105903040117', 'Giva Marliana', 5.66667, 8, 10.25),
(47, '2005903040103', 'Diana Sari Nasution', 10.1667, 7, 10.5),
(48, '2005903040008', 'Asmaul Husna Away ', 9.83333, 7.5, 11),
(49, '2005903040024', 'Mita Ramelia ', 10.1667, 7.5, 10),
(50, '2105903040023', 'Muhammad danil', 9.66667, 8, 11.5),
(51, '2105903040046', 'Shaniza hisyam', 7.16667, 7, 11),
(52, '2005903040090', 'Sofia', 10.6667, 8, 11.5),
(53, '2105903040084', 'Miya Amalia Putri', 10.6667, 7.66667, 11.25),
(54, '2105903040037', 'Riski farmala', 8.5, 7, 9),
(55, '2105903040050', 'Nur Bariah', 6.33333, 7.75, 10),
(56, '2105903040008', 'Nawawi', 8.16667, 8, 10),
(57, '2105903040109', 'Melja Siska ', 6.16667, 7.66667, 10.25),
(58, '2005903040067', 'Agus Berutu', 9.33333, 7, 11),
(59, '2005903040106', 'Efendi', 10, 36.6667, 9.5),
(60, '2105903040114', 'Fitri khalisma ', 7, 7.66667, 9.91667),
(61, '2105903040076', 'nazly pramuditha', 8.5, 8, 10),
(62, '2105903040066', 'SYAIKHUL MUANNAS ', 6.16667, 7.33333, 10.5),
(63, '2005903040063', 'ASEP NANANG SUPRIATNA', 7.33333, 7, 10),
(64, '2005903040105', 'Nurhalimah', 10.3333, 7, 10.5),
(65, '2005903040016', 'irawani', 10.1667, 7.83333, 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai_skill`
--

CREATE TABLE `nilai_skill` (
  `id` int(11) NOT NULL,
  `nim` varchar(13) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `namaSkill` varchar(500) NOT NULL,
  `nilaiSkill` varchar(25) NOT NULL,
  `nilaiSI` float NOT NULL,
  `nilaiJ` float NOT NULL,
  `nilaiRPL` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `nilai_skill`
--

INSERT INTO `nilai_skill` (`id`, `nim`, `nama`, `namaSkill`, `nilaiSkill`, `nilaiSI`, `nilaiJ`, `nilaiRPL`) VALUES
(1, '2005903040019', 'Kartika', 'Analisa Sistem, Manajemen Proyek Teknologi Informasi, Keamanan Jaringan dan Data, Pemrograman (Webphyton,Android), Pengembangan Perangkat Lunak Berbasis Proyek', '25, 25, 25, 25', 12.5, 6.25, 12.5),
(54, '2005903040011', 'riyana', 'Analisa Sistem, Trouble Shooting Jaringan, Local Area Network, Administrasi Jaringan, Keamanan Jaringan dan Data', '', 6.25, 25, 0),
(57, '2005903040096', 'Maulana Rafinda', 'Analisa Sistem, Pengembangan Perangkat Lunak, Pengelolaan Basis Data, Trouble Shooting Jaringan, Pemrograman (Webphyton,Android), Analisis dan Desain Perangkat Lunak, Pengembangan Perangkat Lunak', '', 18.75, 6.25, 18.75),
(59, '2005903040044', 'Ulia Saputra', 'Analisis dan Desain Perangkat Lunak', '', 0, 0, 6.25),
(60, '2005903040023', 'Meli Riskina', 'Trouble Shooting Jaringan, Local Area Network, Keamanan Jaringan dan Data', '', 0, 18.75, 0),
(61, '2005903040013', 'Dewi Candra', 'Analisis dan Desain Perangkat Lunak', '', 0, 0, 6.25),
(64, '2005903040018', 'Karmila Damayanti', 'Analisa Sistem', '', 6.25, 0, 0),
(66, '2005903040055', 'Fadhila Annisa', 'Manajemen Proyek Teknologi Informasi', '', 6.25, 0, 0),
(67, '2105903040015', 'Nofrian Safutra ', 'Analisis dan Desain Perangkat Lunak', '', 0, 0, 6.25),
(68, '2005903040109', 'Pevi Alpiyah Rami', 'Analisa Sistem', '', 6.25, 0, 0),
(69, '2005903040009', 'Citra Srikandi', 'Analisa Sistem, Pengembangan Perangkat Lunak Berbasis Proyek', '', 6.25, 0, 6.25),
(70, '2005903040089', 'Aida Farina', 'Manajemen Proyek Teknologi Informasi', '', 6.25, 0, 0),
(71, '2105903040091', 'Ari Alfiandi', 'Analisa Sistem, Pengembangan Perangkat Lunak, Pemrograman (Webphyton,Android), Analisis dan Desain Perangkat Lunak, Pengembangan Perangkat Lunak', '', 12.5, 0, 18.75),
(72, '2005903040059', 'Ratih Sari Ayu', 'Pemrograman (Webphyton,Android)', '', 0, 0, 6.25),
(73, '2105903040067', 'Febrianti', 'Analisa Sistem, Pengembangan Perangkat Lunak, Manajemen Proyek Teknologi Informasi, Pemrograman (Webphyton,Android), Analisis dan Desain Perangkat Lunak, Pengembangan Perangkat Lunak Berbasis Proyek, Pengembangan Perangkat Lunak', '', 18.75, 0, 25),
(74, '2105903040113', 'Rosa Agustina', 'Analisa Sistem, Pemrograman (Webphyton,Android)', '', 6.25, 0, 6.25),
(75, '2105903040108', 'Yanti', 'Pengembangan Perangkat Lunak, Manajemen Proyek Teknologi Informasi, Keamanan Jaringan dan Data, Analisis dan Desain Perangkat Lunak', '', 12.5, 6.25, 6.25),
(76, '2105903040020', 'Farid ', 'Analisa Sistem, Analisis dan Desain Perangkat Lunak, Pengembangan Perangkat Lunak', '', 6.25, 0, 12.5),
(77, '2105903040111', 'Mizan Aulia', 'Analisa Sistem, Analisis dan Desain Perangkat Lunak', '', 6.25, 0, 6.25),
(78, '2005903040097', 'Ulfa Mahfuza', 'Pengelolaan Basis Data', '', 6.25, 0, 0),
(79, '2105903040117', 'Giva Marliana', 'Keamanan Jaringan dan Data', '', 0, 6.25, 0),
(80, '2005903040103', 'Diana Sari Nasution', 'Local Area Network', '', 0, 6.25, 0),
(81, '2005903040008', 'Asmaul Husna Away ', 'Manajemen Proyek Teknologi Informasi, Pengelolaan Basis Data', '', 12.5, 0, 0),
(82, '2005903040024', 'Mita Ramelia ', 'Pengembangan Perangkat Lunak, Manajemen Proyek Teknologi Informasi, Analisis dan Desain Perangkat Lunak', '', 12.5, 0, 6.25),
(83, '2105903040023', 'Muhammad danil', 'Analisa Sistem, Pengembangan Perangkat Lunak, Pengelolaan Basis Data, Pemrograman (Webphyton,Android), Analisis dan Desain Perangkat Lunak, Pengembangan Perangkat Lunak', '', 18.75, 0, 18.75),
(84, '2105903040046', 'Shaniza hisyam', 'Pemrograman (Webphyton,Android)', '', 0, 0, 6.25),
(85, '2005903040090', 'Sofia', 'Analisa Sistem', '', 6.25, 0, 0),
(86, '2105903040084', 'Miya Amalia Putri', 'Analisis dan Desain Perangkat Lunak', '', 0, 0, 6.25),
(87, '2105903040037', 'Riski farmala', 'Manajemen Proyek Teknologi Informasi', '', 6.25, 0, 0),
(88, '2105903040050', 'Nur Bariah', 'Analisis dan Desain Perangkat Lunak', '', 0, 0, 6.25),
(89, '2105903040008', 'Nawawi', 'Analisa Sistem, Pengembangan Perangkat Lunak, Pengelolaan Basis Data', '', 18.75, 0, 0),
(90, '2105903040109', 'Melja Siska ', 'Pemrograman (Webphyton,Android), Analisis dan Desain Perangkat Lunak, Pengembangan Perangkat Lunak Berbasis Proyek, Pengembangan Perangkat Lunak', '', 0, 0, 25),
(91, '2005903040067', 'Agus Berutu', 'Pengelolaan Basis Data', '', 6.25, 0, 0),
(92, '2005903040106', 'Efendi', 'Analisa Sistem, Manajemen Proyek Teknologi Informasi, Keamanan Jaringan dan Data, Analisis dan Desain Perangkat Lunak, Pengembangan Perangkat Lunak Berbasis Proyek', '', 12.5, 6.25, 12.5),
(93, '2105903040114', 'Fitri khalisma ', 'Keamanan Jaringan dan Data', '', 0, 6.25, 0),
(94, '2105903040076', 'nazly pramuditha', 'Analisa Sistem, Manajemen Proyek Teknologi Informasi, Pengelolaan Basis Data, Analisis dan Desain Perangkat Lunak', '', 18.75, 0, 6.25),
(95, '2105903040066', 'SYAIKHUL MUANNAS ', 'Keamanan Jaringan dan Data', '', 0, 6.25, 0),
(96, '2005903040063', 'ASEP NANANG SUPRIATNA', 'Analisa Sistem, Manajemen Proyek Teknologi Informasi, Analisis dan Desain Perangkat Lunak, Pengembangan Perangkat Lunak', '', 12.5, 0, 12.5),
(97, '2005903040105', 'Nurhalimah', 'Keamanan Jaringan dan Data', '', 0, 6.25, 0),
(98, '2005903040016', 'irawani', 'Manajemen Proyek Teknologi Informasi', '', 6.25, 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tingkat_minat`
--

CREATE TABLE `tingkat_minat` (
  `id` int(11) NOT NULL,
  `nim` varchar(13) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `minatSI` float NOT NULL,
  `minatJ` float NOT NULL,
  `minatRPL` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tingkat_minat`
--

INSERT INTO `tingkat_minat` (`id`, `nim`, `nama`, `minatSI`, `minatJ`, `minatRPL`) VALUES
(1, '2005903040019', 'Kartika', 3, 2, 3),
(21, '2005903040011', 'riyana', 1, 5, 1),
(24, '2005903040096', 'Maulana Rafinda', 5, 2, 3),
(26, '2005903040044', 'Ulia Saputra', 3, 3, 4),
(27, '2005903040023', 'Meli Riskina', 4, 5, 3),
(28, '2005903040013', 'Dewi Candra', 4, 3, 3),
(32, '2005903040018', 'Karmila Damayanti', 3, 2, 3),
(34, '2005903040055', 'Fadhila Annisa', 3, 2, 2),
(35, '2105903040015', 'Nofrian Safutra ', 5, 4, 4),
(36, '2005903040109', 'Pevi Alpiyah Rami', 4, 4, 4),
(37, '2005903040009', 'Citra Srikandi', 5, 2, 2),
(38, '2005903040089', 'Aida Farina', 4, 2, 3),
(39, '2005903040059', 'Ratih Sari Ayu', 3, 2, 3),
(40, '2105903040067', 'Febrianti', 5, 2, 4),
(41, '2105903040113', 'Rosa Agustina', 5, 4, 3),
(42, '2105903040108', 'Yanti', 4, 2, 2),
(43, '2105903040020', 'Farid ', 4, 4, 3),
(44, '2105903040111', 'Mizan Aulia', 3, 3, 3),
(45, '2005903040097', 'Ulfa Mahfuza', 3, 2, 3),
(46, '2105903040117', 'Giva Marliana', 1, 3, 1),
(47, '2005903040103', 'Diana Sari Nasution', 3, 3, 2),
(48, '2005903040008', 'Asmaul Husna Away ', 3, 2, 2),
(49, '2005903040024', 'Mita Ramelia ', 3, 2, 2),
(50, '2105903040023', 'Muhammad danil', 3, 2, 5),
(51, '2105903040046', 'Shaniza hisyam', 3, 2, 4),
(52, '2005903040090', 'Sofia', 3, 3, 3),
(53, '2105903040084', 'Miya Amalia Putri', 5, 2, 3),
(54, '2105903040037', 'Riski farmala', 4, 2, 2),
(55, '2105903040050', 'Nur Bariah', 5, 3, 2),
(56, '2105903040008', 'Nawawi', 4, 2, 3),
(57, '2105903040109', 'Melja Siska ', 4, 2, 5),
(58, '2005903040067', 'Agus Berutu', 4, 2, 2),
(59, '2005903040106', 'Efendi', 4, 2, 3),
(60, '2105903040114', 'Fitri khalisma ', 3, 5, 3),
(61, '2105903040076', 'nazly pramuditha', 5, 2, 3),
(62, '2105903040066', 'SYAIKHUL MUANNAS ', 2, 1, 5),
(63, '2005903040063', 'ASEP NANANG SUPRIATNA', 5, 4, 3),
(64, '2005903040105', 'Nurhalimah', 4, 4, 3),
(65, '2005903040016', 'irawani', 5, 2, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `nim` varchar(13) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nama`, `nim`, `password`) VALUES
(16, 'Maulana Rafinda', '2005903040096', '$2y$10$cbWY8mbzb6ctmbardXkCmuLnKpyxbt4JN3yGvXD6TuTLQVYiZqNC2'),
(20, 'Ulia Saputra', '2005903040044', '$2y$10$tl/90aN.RydaAnlPtwDJjezeVZVm1ZxWYqzqeiTwKopGe6imaryo6'),
(21, 'Meli Riskina', '2005903040023', '$2y$10$Sm94PinwU5uuovffkKgogemieZQEqR6iScK.vSfbCUW3tFvoskT6W'),
(23, 'Dewi Candra', '2005903040013', '$2y$10$ffk5wUIly/24Wb0OxL8GyOFxZxfZLtANk7slIcNMcrVTgDDx0GI1y'),
(24, 'Karmila Damayanti', '2005903040018', '$2y$10$StjMetqlZ1.ArJobarpp6emBODhB6zESjIleilk6EWjtcwu3gqbmC'),
(26, 'Kartika', '2005903040019', '$2y$10$aYYvpRUMLfz8MLlsqGKmsO1GWDLM5ehJzfvgQzy7/6uLkkTzbVSkC'),
(27, 'Fadhila Annisa', '2005903040055', '$2y$10$mumqa/Pu6Ib9xm7iyFuCweW7MeWIAb4bu5wSC/b/2ZTPd6bVGcL7.'),
(28, 'Nofrian Safutra ', '2105903040015', '$2y$10$Qplmi0VcI/yG8ej1Oc03futFRyYI56ohulEhcBCKaSqfVOaOl8p16'),
(29, 'Pevi Alpiyah Rami', '2005903040109', '$2y$10$uFH60N5S4HTYAVMxxk16/.Y1XLkwnG.pMPV4DhnazFLAMyyYWccGS'),
(30, 'Citra Srikandi', '2005903040009', '$2y$10$VSHPKvhToA79QE.QCDaqjeldIfo8XtMsdxjbpj1D99vz7vjvtmAgm'),
(31, 'Aida Farina', '2005903040089', '$2y$10$locj8J9kZljN.6I6wz3DP.2VbN9lAaPbGfyw9iIWyKgqTCWUs7UUO'),
(32, 'Ari Alfiandi', '2105903040091', '$2y$10$bt6vm6Z0C3QXtdOlfxdMPuktn9gerPU2VZ/h5Eep0D.V6f0hZn8/y'),
(33, 'Ratih Sari Ayu', '2005903040059', '$2y$10$l8Ya7CTMpdRqBjrmgAl2YOB5QVgknoinZL6mJ/QANQdT16iyr.ywe'),
(34, 'Febrianti', '2105903040067', '$2y$10$KVV840rsLjZPCD78t6k4VePH2VHa9MmNxAat8iFIeZEwbJtNdUDnW'),
(35, 'Febrianti', '2105903040067', '$2y$10$ljZ51MqSmCoXocPQb8dk3OQn4ST14nZ0pfoGaVTQdCNvC2llEYeTm'),
(36, 'Rosa Agustina', '2105903040113', '$2y$10$Ieg200YW1LO7LOv5orlCWOLC9s6NdlZrHlvIa3UcESlD5uTfJqSXa'),
(37, 'Yanti', '2105903040108', '$2y$10$eEzRoFcp/cEEXE6sgU3K5.1gUU7JGficUibgyox4aend.IRwolpFa'),
(38, 'Farid ', '2105903040020', '$2y$10$BQ22sHoDBDnrqq56Uv.6vuAJ9ZCh7ZiYe1Xa88zywWDJolkYO4UWq'),
(40, 'Mizan Aulia', '2105903040111', '$2y$10$QcC0Gbi0FTAvJ5rk5rrROeL8xsazEncZkP2CC6ou6zncdIftqwT9y'),
(41, 'Ulfa Mahfuza', '2005903040097', '$2y$10$FpYPFZHg0K0zW.TERp0ey.PkbKHyw0ZfsI7ay/byvSM9bOI7xy58C'),
(42, 'Giva Marliana', '2105903040117', '$2y$10$hjo0mJG3fMcy381S.0entOSZHhCFK.3xq2WYKqKRh/71y1KgVly5u'),
(43, 'Diana Sari Nasution', '2005903040103', '$2y$10$RDEY6ew/rFozTjMov297ru9MkXVsw7p5n1ynm4rdoNbvxuMYEIp2m'),
(44, 'Asmaul Husna Away ', '2005903040008', '$2y$10$raLW468lVhM2FRyWd9DOFOrUO41A96GiBejpxji/x9uWlzFddC6zm'),
(45, 'Mita Ramelia ', '2005903040024', '$2y$10$0SE4ReGjcq08g7Z..L94X.n/sY/4eNiJT3E9fjMxZBNfzXaT8xG4C'),
(46, 'Muhammad danil', '2105903040023', '$2y$10$/0JznabyumxAsM8NHQUrOegP44opguzwOpLHzV3KWk2bVwPoSk2Ta'),
(47, 'Shaniza hisyam', '2105903040046', '$2y$10$lgdna.LfOu1OyOpZ0ve/VecCTrBUqU1PM9HP98PBCmFCE/VULJUVC'),
(48, 'Sofia', '2005903040090', '$2y$10$etcbeqI7WoquZAg0q9Bk/eFkwjxShAe0OwOOlYXC9zPWo9Q2.O4Xi'),
(49, 'Miya Amalia Putri', '2105903040084', '$2y$10$J9EaOFuAkuxLAGuJiWmwEOlDDBNLDPIfvy3hXaaE8tynYU1z0xBCS'),
(50, 'Riski farmala', '2105903040037', '$2y$10$rnZ/XOmWt349on3FtqFJp.9u4iZSK.ahtLZ2hHEiNdBznHKn5.udu'),
(51, 'Nur Bariah', '2105903040050', '$2y$10$o6s7JBoIKKmXZ7fSP1d8teYuDuFHs62pDHrdOD.eqeYL21vX7ivlO'),
(52, 'Nawawi', '2105903040008', '$2y$10$IQSEbUuA.tX5CEz0L9R/C.wVJfjr5PPXeHKCNrFfduAd4Lwv0aShG'),
(53, 'Melja Siska ', '2105903040109', '$2y$10$XA4baDtJjQqNbw/fynrUv.btt5Gg/scabYbi7sDZsYQQzd5TE/f4q'),
(54, 'Agus Berutu', '2005903040067', '$2y$10$AAIezK9m.DQw8Vm.86zySOEOeVPDxihPFghGd/aXkuqC8p/eV2R36'),
(55, 'Efendi', '2005903040106', '$2y$10$o5A0VVCLTlc1UDqrZ0ylCua5JEhoG.sZV/LJBKOCrdFF8BXLjThFi'),
(56, 'Fitri khalisma ', '2105903040114', '$2y$10$lyrBbvX/6LZ6bD1zGpuDIe1pf.6wtj6am9oHNThqtGu1xZAuuthVG'),
(57, 'nazly pramuditha', '2105903040076', '$2y$10$AuNz/oFr5lXplvY984ZAZOYOPoEpz.8CWr8pEy/oR8OdnSUAANmhi'),
(58, 'SYAIKHUL MUANNAS ', '2105903040066', '$2y$10$oymGFBr1iyENQYn0MV4Z3.ZOup2ZXCRWixCG..3zSaG9GJrDyQXl.'),
(59, 'ASEP NANANG SUPRIATNA', '2005903040063', '$2y$10$kOK7Z./Hd3dW9HKEWyEZ3uxlJB1TIe80ejbprNm7oqPlTyt5qtdWG'),
(60, 'Nurhalimah', '2005903040105', '$2y$10$OCb99FktehTpqASsgHlODeUd.MHvYNNg9f8N.iM7413h.xwo0xDfe'),
(61, 'irawani', '2005903040016', '$2y$10$s9hQqjOaFm8wmfzsezbP4OebpClDRCmqOskW0x1/cWluAo14FOThK');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `alternatif`
--
ALTER TABLE `alternatif`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `hasil_rekomendasi`
--
ALTER TABLE `hasil_rekomendasi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nim` (`nim`);

--
-- Indeks untuk tabel `nilai_mk`
--
ALTER TABLE `nilai_mk`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nim` (`nim`);

--
-- Indeks untuk tabel `nilai_skill`
--
ALTER TABLE `nilai_skill`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nim` (`nim`);

--
-- Indeks untuk tabel `tingkat_minat`
--
ALTER TABLE `tingkat_minat`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nim` (`nim`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `alternatif`
--
ALTER TABLE `alternatif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `hasil_rekomendasi`
--
ALTER TABLE `hasil_rekomendasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT untuk tabel `nilai_mk`
--
ALTER TABLE `nilai_mk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT untuk tabel `nilai_skill`
--
ALTER TABLE `nilai_skill`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT untuk tabel `tingkat_minat`
--
ALTER TABLE `tingkat_minat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
