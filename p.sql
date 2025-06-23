-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 13, 2025 at 09:14 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `p`
--

-- --------------------------------------------------------

--
-- Table structure for table `arsip`
--

CREATE TABLE `arsip` (
  `id` int(11) NOT NULL,
  `judul_arsip` varchar(255) NOT NULL,
  `informasi` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `tahun` varchar(255) NOT NULL,
  `jenis_arsip` varchar(255) NOT NULL,
  `file_upload` varchar(255) NOT NULL,
  `created_at` varchar(30) NOT NULL,
  `updated_at` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `arsip`
--

INSERT INTO `arsip` (`id`, `judul_arsip`, `informasi`, `tanggal`, `tahun`, `jenis_arsip`, `file_upload`, `created_at`, `updated_at`) VALUES
(1, 'Upload Data Suara', 'Publik', '2025-01-15', '2025', 'Suara', 'paduansuara.mp3', '2025-06-14 01:56:32', '2025-06-14 01:56:32'),
(2, 'Upacara Hari Kemerdekaan', 'Private', '2024-08-17', '2024', 'Gambar', 'gambarupacara.jpg', '2025-06-14 01:56:32', '2025-06-14 01:56:32'),
(3, 'Lomba Agustusan', 'Publik', '2025-08-17', '2025', 'Video', 'lombamakankerupuk.mp4', '2025-06-14 01:56:32', '2025-06-14 01:56:32'),
(4, 'Surat Libur Idul Fitri', 'Private', '2024-04-01', '2024', 'Dokumen', 'liburhariraya.pdf', '2025-06-14 01:56:32', '2025-06-14 01:56:32'),
(5, 'Rekaman Rapat Desa', 'Publik', '2025-06-05', '2025', 'Suara', 'rapatdesa.mp3', '2025-06-14 01:56:32', '2025-06-14 01:56:32'),
(6, 'Foto Gotong Royong', 'Private', '2024-03-12', '2024', 'Gambar', 'gotongroyong.jpg', '2025-06-14 01:56:32', '2025-06-14 01:56:32'),
(7, 'Video Sosialisasi', 'Publik', '2025-02-20', '2025', 'Video', 'sosialisasi.mp4', '2025-06-14 01:56:32', '2025-06-14 01:56:32'),
(8, 'Surat Undangan RT', 'Private', '2024-05-10', '2024', 'Dokumen', 'undanganrt.pdf', '2025-06-14 01:56:32', '2025-06-14 01:56:32'),
(9, 'Rekaman Suara Ketua RW', 'Publik', '2024-07-19', '2024', 'Suara', 'ketuarw.mp3', '2025-06-14 01:56:32', '2025-06-14 01:56:32'),
(10, 'Foto Peringatan Hari Pahlawan', 'Private', '2025-11-10', '2025', 'Gambar', 'haripahlawan.jpg', '2025-06-14 01:56:32', '2025-06-14 01:56:32'),
(11, 'Video Dokumentasi RT', 'Publik', '2024-09-30', '2024', 'Video', 'dokumentasirt.mp4', '2025-06-14 01:56:32', '2025-06-14 01:56:32'),
(12, 'Surat Edaran Pemilu', 'Private', '2025-01-10', '2025', 'Dokumen', 'edaranpemilu.pdf', '2025-06-14 01:56:32', '2025-06-14 01:56:32'),
(13, 'Rekaman Ceramah Idul Adha', 'Publik', '2024-06-29', '2024', 'Suara', 'ceramahiduladha.mp3', '2025-06-14 01:56:32', '2025-06-14 01:56:32'),
(14, 'Foto Lomba Kebersihan', 'Private', '2025-05-20', '2025', 'Gambar', 'lombakebersihan.jpg', '2025-06-14 01:56:32', '2025-06-14 01:56:32'),
(15, 'Video Latihan Tari', 'Publik', '2025-03-11', '2025', 'Video', 'latihantari.mp4', '2025-06-14 01:56:32', '2025-06-14 01:56:32'),
(16, 'Surat Keterangan Domisili', 'Private', '2024-10-01', '2024', 'Dokumen', 'domisili.pdf', '2025-06-14 01:56:32', '2025-06-14 01:56:32'),
(17, 'Rekaman Suara Musyawarah', 'Publik', '2025-12-15', '2025', 'Suara', 'musyawarah.mp3', '2025-06-14 01:56:32', '2025-06-14 01:56:32'),
(18, 'Foto Peringatan Maulid', 'Private', '2024-10-28', '2024', 'Gambar', 'maulidnabi.jpg', '2025-06-14 01:56:32', '2025-06-14 01:56:32'),
(19, 'Video Pelatihan Linmas', 'Publik', '2025-04-15', '2025', 'Video', 'pelatihanlinmas.mp4', '2025-06-14 01:56:32', '2025-06-14 01:56:32'),
(20, 'Surat Permohonan Bantuan', 'Private', '2024-11-20', '2024', 'Dokumen', 'permohonanbantuan.pdf', '2025-06-14 01:56:32', '2025-06-14 01:56:32'),
(21, 'Foto Gotong Royong', 'Publik', '2025-02-05', '2025', 'Gambar', 'fotogotongroyong.jpeg', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `fonds_tahun`
--

CREATE TABLE `fonds_tahun` (
  `id` int(5) UNSIGNED NOT NULL,
  `tahun` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `fonds_tahun`
--

INSERT INTO `fonds_tahun` (`id`, `tahun`, `created_at`, `updated_at`) VALUES
(1, '2024', '2024-05-01 07:30:00', NULL),
(2, '2025', '2024-05-01 08:14:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(2, '2024-01-06-082014', 'App\\Database\\Migrations\\CreateTableUsers', 'default', 'App', 1704530959, 1),
(3, '2024-05-01-065542', 'App\\Database\\Migrations\\CreateTableFonds', 'default', 'App', 1714546910, 2),
(4, '2024-05-01-070915', 'App\\Database\\Migrations\\CreateTableFonds', 'default', 'App', 1714547363, 3),
(5, '2024-05-10-110210', 'App\\Database\\Migrations\\CreateTableSubFonds', 'default', 'App', 1715339421, 4),
(6, '2024-05-11-101815', 'App\\Database\\Migrations\\CreateTableSeri', 'default', 'App', 1715423445, 5),
(7, '2024-05-11-101827', 'App\\Database\\Migrations\\CreateTableSubSeri', 'default', 'App', 1715423445, 5),
(9, '2024-10-06-165632', 'App\\Database\\Migrations\\AddNewColumnToArsip', 'default', 'App', 1728234048, 6),
(10, '2024-10-06-170223', 'App\\Database\\Migrations\\RemoveSeriSubSeriFromArsip', 'default', 'App', 1728234281, 7);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(5) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `sex` varchar(1) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `role` varchar(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `reset_token` varchar(255) DEFAULT NULL,
  `reset_expires` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `username`, `password`, `address`, `sex`, `phone`, `role`, `created_at`, `updated_at`, `reset_token`, `reset_expires`) VALUES
(8, 'Wulan Hariyah', 'gaman32@hutagalung.mil.id', 'rahimah.opan', '$2y$10$D81/iCax2sINVuCIr8NAAueMyUi/DkU6LWmUvyUD3PBthNakBuwma', 'Kpg. Ekonomi No. 299, Sukabumi 15627, Sumbar', 'P', '0617 5948 6214', '2', '2024-01-06 09:15:36', NULL, NULL, NULL),
(10, 'Ozy Bakda Irawan S.H.', 'tantri.susanti@usada.in', 'xmandasari', '$2y$10$oc4zDjcAx8mTaNBIoAZqzeRguWYiP3FAlTHgNXWGpebOPCIBN9Lku', 'Jln. Ir. H. Juanda No. 845, Sukabumi 40938, Jateng', 'L', '0363 5377 3967', '0', '2024-01-06 09:15:36', NULL, NULL, NULL),
(11, 'Titi Agustina', 'winarsih.salimah@yahoo.com', 'hendra.zulaika', '$2y$10$rTOZlclCuTUaIMhWcI6bH.Sjj76sUIBwohIsSiWlyOM7IpXVuox0q', 'Kpg. Ujung No. 293, Samarinda 50465, Sultra', 'P', '0401 4393 8616', '0', '2024-01-06 09:15:36', NULL, NULL, NULL),
(12, 'Daruna Arta Pratama', 'irsad.firgantoro@wahyuni.tv', 'qzulkarnain', '$2y$10$C5MmYfyLLxBMIsO0ldokFOhdBhIGa76mHlxqwfiGB21MksqbVUvo6', 'Gg. Bhayangkara No. 166, Gorontalo 74344, Sultra', 'P', '(+62) 511 8783 9357', '0', '2024-01-06 09:15:37', NULL, NULL, NULL),
(13, 'Samsul Leo Saefullah', 'ajiman.budiyanto@yahoo.co.id', 'xramadan', '$2y$10$fFL8ZDyxgnqM6cQfVH2hvu/ew1issBo9meOMkIpWgL4soxno0pNBK', 'Ds. Flora No. 504, Depok 99134, Sultra', 'P', '(+62) 434 3510 9872', '0', '2024-01-06 09:15:37', NULL, NULL, NULL),
(14, 'Hadi Ganda Prasasta', 'suryatmi.darimin@sihombing.org', 'yance.mulyani', '$2y$10$zh044cUy3.onN53.PHPYcutA.IR9uKbqOllaEjZxz4RLh/Y5gmAlm', 'Dk. Yoga No. 951, Tasikmalaya 33717, Maluku', 'P', '0878 2212 4385', '0', '2024-01-06 09:15:37', NULL, NULL, NULL),
(15, 'Salwa Fujiati', 'irnanto19@firgantoro.name', 'puji.budiman', '$2y$10$Oscbv0XJ1ziKQpgP7SinwujJ65PKxKCF5A4dBrqQrkIpVEkMkvSie', 'Kpg. Bazuka Raya No. 573, Administrasi Jakarta Utara 48734, DKI', 'L', '0424 6097 404', '0', '2024-01-06 09:15:37', NULL, NULL, NULL),
(16, 'Harjasa Prayoga', 'ohutasoit@prasasta.web.id', 'iriana32', '$2y$10$BUujAtamDzSG1MJeIxU4WOBqnDbC2kiyvqn.ICpDj5txo9GCwrEvG', 'Ds. Gremet No. 80, Tangerang Selatan 47083, DIY', 'P', '0372 9646 152', '0', '2024-01-06 09:15:37', NULL, NULL, NULL),
(17, 'Kamal Wibowo', 'parman.novitasari@palastri.mil.id', 'kawaca.pudjiastuti', '$2y$10$t/lyDDzoN0Hngm11BslLyOftIj4nv97/C6BH2WxjeNEr32M8W9YBm', 'Jln. Samanhudi No. 773, Serang 11572, DKI', 'L', '(+62) 840 9233 2358', '0', '2024-01-06 09:15:37', NULL, NULL, NULL),
(18, 'Mujur Situmorang', 'pnarpati@gmail.co.id', 'unjani99', '$2y$10$.VAWLdUKHRRPBpLX4fXZE.G3shfM1VWSKf/36rPpSiV7aqJfrrXHy', 'Ki. Gotong Royong No. 133, Malang 90275, Sumut', 'L', '0509 9431 758', '0', '2024-01-06 09:15:38', NULL, NULL, NULL),
(19, 'Ihsan Situmorang', 'yuliana07@gmail.co.id', 'yuliarti.himawan', '$2y$10$nm/Y5h/4tRJdRGVw6ppfaOGTxxhWf4gN966XnrpKLIrqCrGjFiQiW', 'Gg. Eka No. 888, Lhokseumawe 56997, Bengkulu', 'P', '(+62) 22 3747 1631', '0', '2024-01-06 09:15:38', NULL, NULL, NULL),
(20, 'Najwa Nurdiyanti S.T.', 'mardhiyah.bella@hariyah.mil.id', 'saputra.zamira', '$2y$10$x8Ts7S3X.XI3DpTbtiBii.IOT3lTrDWn6119HW28mYvlNrHjGz1u6', 'Kpg. Badak No. 99, Sungai Penuh 51188, Maluku', 'L', '027 2743 3591', '0', '2024-01-06 09:15:38', NULL, NULL, NULL),
(21, 'Maya Wijayanti S.Kom', 'murti53@yahoo.co.id', 'npadmasari', '$2y$10$g4NR7lWcijsEWjPvu8r6EumQvrpUkNMC.RErUPl7GGlR90I8Y03ma', 'Ki. Yap Tjwan Bing No. 183, Administrasi Jakarta Barat 28735, Kepri', 'P', '(+62) 388 2170 686', '0', '2024-01-06 09:15:38', NULL, NULL, NULL),
(22, 'Parman Kenzie Suryono', 'ehartati@anggriawan.web.id', 'hharyanti', '$2y$10$dJx421zAcx6m34fBC/wayOa/5lrotJOyRIWfOEiIWxVcgP57L2AhC', 'Kpg. Jagakarsa No. 619, Metro 96272, Sulteng', 'L', '0983 9234 5904', '0', '2024-01-06 09:15:38', NULL, NULL, NULL),
(23, 'Rendy Natsir', 'januar.jumari@anggriawan.name', 'irawan.daru', '$2y$10$eEaEmNEFx5ZHF0tAkMmAJ.HjKxURAsjIbCGiS9y1sVlNh9LaTDSmq', 'Ds. Wora Wari No. 421, Serang 89178, Jambi', 'P', '0492 3564 452', '0', '2024-01-06 09:15:38', NULL, NULL, NULL),
(24, 'Janet Prastuti', 'dongoran.saadat@gmail.co.id', 'natalia.maulana', '$2y$10$r6s0xLBaJJw7AjZmK4tFk.YIzPUVatcI8yF3Yg/yIM6N.W1BVrxXK', 'Dk. Babadan No. 476, Subulussalam 15247, Pabar', 'P', '0698 1206 968', '0', '2024-01-06 09:15:39', NULL, NULL, NULL),
(25, 'Azalea Amalia Yulianti', 'cmahendra@yahoo.co.id', 'kadir40', '$2y$10$iNr/GQaEdzKvLaIE8KokjOakQLF20U9WdAL13IV2HSCiAyokKJQ02', 'Ki. Nakula No. 383, Binjai 93309, Riau', 'P', '(+62) 872 106 819', '0', '2024-01-06 09:15:39', NULL, NULL, NULL),
(26, 'Cici Usada M.Pd', 'rlatupono@mustofa.id', 'zalindra.hasanah', '$2y$10$1Fl.5YJju2fove6/HTK5g.jNUDdgWrf2wcjrIFQE0qPG38.ODrOn6', 'Psr. Bakit  No. 49, Kendari 96068, Papua', 'P', '0926 7074 0588', '0', '2024-01-06 09:15:39', NULL, NULL, NULL),
(27, 'Umaya Situmorang', 'ruyainah@yahoo.co.id', 'wahyuni.panji', '$2y$10$K1Uo0upeovO1FilL.cWeae4CapsJFTXDkMxcAu0IcLq3v.J8sIUR6', 'Jln. Bass No. 353, Madiun 58926, Kaltara', 'L', '(+62) 27 7125 895', '0', '2024-01-06 09:15:39', NULL, NULL, NULL),
(28, 'Halima Rahimah M.M.', 'isudiati@puspita.go.id', 'pratiwi.paiman', '$2y$10$N15156vEOEEzUTAQ1DymzOW5dOKBSGwYZm2XDVT6e9g6TxNc2Yqh.', 'Kpg. Yohanes No. 578, Padangsidempuan 87960, Kalsel', 'L', '(+62) 934 8251 4791', '0', '2024-01-06 09:15:39', NULL, NULL, NULL),
(29, 'Banawi Suwarno', 'waluyo.timbul@pudjiastuti.info', 'maulana.citra', '$2y$10$jgUPdpJxGe9VOZa.JJv9L.eQiihBS94CnwU71c9euw/8bgL0P3a7K', 'Dk. Babadak No. 428, Palopo 65174, Lampung', 'P', '(+62) 381 8382 841', '0', '2024-01-06 09:15:39', NULL, NULL, NULL),
(30, 'Ghaliyati Jasmin Wijayanti', 'putri.kusumo@yahoo.co.id', 'sadina.hardiansyah', '$2y$10$aohBTeDbYqIAK4LSrdNhnuwC.XSHxkA08ySrQQ2yipeje196yx85C', 'Gg. Raya Ujungberung No. 524, Padang 29454, Jambi', 'P', '(+62) 22 2061 168', '0', '2024-01-06 09:15:40', NULL, NULL, NULL),
(31, 'Ina Wahyuni S.Farm', 'hartaka75@gmail.com', 'lkuswandari', '$2y$10$txmEBoY95Xt.qWVgQ6ql6.dEiHUTQL7T.ZXUxkWKIwNHZkWOMaRLa', 'Jln. Baya Kali Bungur No. 606, Tanjungbalai 82596, Kaltara', 'L', '(+62) 693 1706 5437', '0', '2024-01-06 09:15:40', NULL, NULL, NULL),
(32, 'Banara Saptono', 'sitorus.ganjaran@saputra.asia', 'suwarno.zizi', '$2y$10$ThHIlYytynvjh5lpwV/ececOaHMj1JcLbY7o95iDvi12k1Hgtb2XW', 'Jln. Diponegoro No. 901, Tual 93785, Gorontalo', 'P', '0754 6370 386', '0', '2024-01-06 09:15:40', NULL, NULL, NULL),
(33, 'Gantar Ramadan S.Pt', 'anggabaya65@gmail.com', 'yolanda.karimah', '$2y$10$VHSXX.lc3Im3MOV0OY2tRuXxfCPqK4aOsKJWZlyGLFotlZPcRvjgu', 'Ds. Untung Suropati No. 423, Cirebon 75201, Bengkulu', 'L', '0729 9490 277', '0', '2024-01-06 09:15:40', NULL, NULL, NULL),
(34, 'Sarah Kuswandari', 'tiara.prastuti@kusmawati.co', 'mpradipta', '$2y$10$CmtVEyOoffLm6zcyLqplNOvHBWmd5VBLuWk.E3zYZ8iPtas5x/DTe', 'Psr. Abang No. 812, Mojokerto 33593, Maluku', 'L', '(+62) 611 5443 7087', '0', '2024-01-06 09:15:40', NULL, NULL, NULL),
(35, 'Dalimin Bajragin Simanjuntak S.E.I', 'gading.mandasari@yahoo.co.id', 'nurdiyanti.gabriella', '$2y$10$38WuUlt4JMgFrlyTXADRJ.pPMWX9/oBjmztqT9V38yrtvOMPE6w1S', 'Jr. Urip Sumoharjo No. 350, Padangsidempuan 86077, Sumsel', 'L', '0374 6970 170', '0', '2024-01-06 09:15:41', NULL, NULL, NULL),
(36, 'Michelle Hesti Wahyuni', 'qlazuardi@gmail.com', 'yuliana39', '$2y$10$SxPp6pgtP0mzqjQXhIPKEOJ8BS8hT4SkUTOd8oUEhfdQMDzC7xQNy', 'Ds. Baranangsiang No. 443, Tomohon 69724, Jateng', 'P', '(+62) 24 2499 614', '0', '2024-01-06 09:15:41', NULL, NULL, NULL),
(37, 'Maya Wahyuni', 'utama.adhiarja@yahoo.com', 'sadina18', '$2y$10$ghrJ6R1PXHcmyGxpKrzLEOQ3ifSwAvBCF1qTGmmj4vTgjlcQDxR3G', 'Gg. Cikapayang No. 431, Tebing Tinggi 51266, Kepri', 'L', '(+62) 892 0968 106', '0', '2024-01-06 09:15:41', NULL, NULL, NULL),
(38, 'Shania Haryanti', 'uutami@suryatmi.biz.id', 'diah.purwanti', '$2y$10$6hzOXjSbsj4TZcIoArWeYObp7eT4k4/B783roJdotYAEn8jHRb4gK', 'Ki. Salatiga No. 578, Bima 89772, Sulteng', 'L', '(+62) 308 6536 175', '0', '2024-01-06 09:15:41', NULL, NULL, NULL),
(39, 'Hilda Pudjiastuti', 'yharyanto@gmail.co.id', 'sudiati.betania', '$2y$10$yPHo2.Q9UDVI4.06QfipWOCARmtNJRwGsIa8tmFS8gvEJ4sEkWeqa', 'Ds. Kiaracondong No. 143, Gorontalo 22726, Sulsel', 'P', '0308 0670 620', '0', '2024-01-06 09:15:41', NULL, NULL, NULL),
(40, 'Mumpuni Irawan', 'sprakasa@tampubolon.biz.id', 'aurora.hutapea', '$2y$10$lW89t.I9Jj3YI9QMUFZfAupwh0dTAsVTWTd4F.Wub6qzUPuMVT2vi', 'Gg. Madrasah No. 601, Ternate 10179, Kepri', 'L', '0792 6719 752', '0', '2024-01-06 09:15:41', NULL, NULL, NULL),
(41, 'Warji Gunawan', 'kacung35@yahoo.co.id', 'rina.prayoga', '$2y$10$plJVSk0TAcVd8.brlGaNkeni.jolA2WCmRoNF5FfrJ1EIFhbHSxeq', 'Gg. Tambun No. 923, Banda Aceh 94292, Jambi', 'L', '(+62) 740 8950 0071', '0', '2024-01-06 09:15:42', NULL, NULL, NULL),
(42, 'Nyoman Ega Sihombing', 'calista.wahyuni@gmail.com', 'diana42', '$2y$10$Vquw2b5wceA.X72e14K/HuzBm3mfGaGrd2x49cbIx48KBGhg1Dnpy', 'Psr. Bagis Utama No. 836, Pasuruan 51796, Bengkulu', 'L', '0432 4722 8881', '0', '2024-01-06 09:15:42', NULL, NULL, NULL),
(43, 'Mursita Kuswoyo', 'ngunawan@gunarto.name', 'damar.jailani', '$2y$10$H84Am65OxHMjx0UokK0wpO0Wuw85R3iXa.bu9NAaRxz593V/stoZW', 'Jln. Basudewo No. 865, Bogor 17685, Papua', 'L', '0938 3205 6898', '0', '2024-01-06 09:15:42', NULL, NULL, NULL),
(44, 'Damar Permadi', 'ithamrin@simbolon.name', 'anom.megantara', '$2y$10$v7m7sw40/KsOrimPQizWXuwplV4KAYkzp8mumRZ5hIrUXvYvMxGh.', 'Ds. Dipenogoro No. 342, Probolinggo 22399, Gorontalo', 'P', '0868 1678 316', '0', '2024-01-06 09:15:42', NULL, NULL, NULL),
(45, 'Candra Firmansyah M.Pd', 'tina91@agustina.com', 'prastuti.daryani', '$2y$10$aImIzb4XLqG5wxSbQNYXVun83CUfaxCl5albD0WIGMAZGTNDkcz8S', 'Ki. Lumban Tobing No. 151, Serang 34327, Sulut', 'L', '0443 2018 9681', '0', '2024-01-06 09:15:42', NULL, NULL, NULL),
(46, 'Endah Gawati Mardhiyah M.M.', 'bahuraksa.sirait@permata.ac.id', 'kurniawan.juli', '$2y$10$jYsi.1jgF/fYvZlt277vgemGWUGvUlmnXnZNr1Vzx40m8DirI0tme', 'Kpg. Tubagus Ismail No. 18, Sukabumi 60560, Sumbar', 'L', '0284 9232 376', '0', '2024-01-06 09:15:42', NULL, NULL, NULL),
(47, 'Bakiman Hidayat', 'hilda.pangestu@maryati.com', 'widya39', '$2y$10$GyWVKxu41XXSiviLdXPtkeFwzjUPQd3oJNPo6pspUvGm1Okyw2fsW', 'Jr. Padma No. 841, Kupang 29726, Riau', 'P', '(+62) 921 4291 9019', '0', '2024-01-06 09:15:43', NULL, NULL, NULL),
(48, 'Eman Cengkir Nashiruddin', 'daliono89@gmail.co.id', 'megantara.luhung', '$2y$10$hSRjuo2NSJ99TLVtH4C4HuYJK.DB5gEKIx1Zh0maPEioR9YyO1VYa', 'Gg. Cemara No. 66, Banjarmasin 87726, DKI', 'P', '0217 8236 0003', '0', '2024-01-06 09:15:43', NULL, NULL, NULL),
(49, 'Galiono Lembah Kusumo', 'marsudi25@nainggolan.name', 'lanang.hariyah', '$2y$10$XnZJ/z23kepXARQfnKLW5uRjFxY17CHC6gqkw.t1fW18/n/GBXiYO', 'Psr. Gardujati No. 310, Cimahi 73969, NTT', 'P', '(+62) 385 6650 9425', '0', '2024-01-06 09:15:43', NULL, NULL, NULL),
(50, 'Kardi Manah Nainggolan S.T.', 'belinda.sirait@pradipta.id', 'hpratiwi', '$2y$10$JtGXMJnCc8/j10Qkcx52qeOZTxNQqW277ng87uudil6hxIZo0QO7i', 'Ds. Babadak No. 186, Manado 85015, Babel', 'P', '0554 7004 310', '0', '2024-01-06 09:15:43', NULL, NULL, NULL),
(51, 'Artawan Hutasoit', 'nashiruddin.syahrini@gmail.co.id', 'martana.nasyiah', '$2y$10$ht5ymvz4pQTe.V6qrFvWTelybFSO94WV1TFlWQRuT.Yxz4ns53RYG', 'Ds. Mahakam No. 515, Kendari 81985, Sumut', 'L', '026 4628 9815', '0', '2024-01-06 09:15:43', NULL, NULL, NULL),
(52, 'Tira Mardhiyah', 'saadat.astuti@riyanti.my.id', 'betania.prasasta', '$2y$10$h5HfXFuZ2iNrpm7NTUq4kepMGnLIAhjMkM/ZI3WsWPrJ2REh/KkSe', 'Gg. BKR No. 646, Tanjung Pinang 37882, Sumsel', 'L', '(+62) 831 833 389', '0', '2024-01-06 09:15:44', NULL, NULL, NULL),
(53, 'Mitra Hidayat', 'pharyanti@yahoo.com', 'hasanah.jais', '$2y$10$9L/kxq0GvlnHM45HI.7ydeyM2lclg91G4qzloiGZ1XN6QvYBbECFW', 'Gg. Ir. H. Juanda No. 237, Bontang 80454, Sumut', 'P', '(+62) 443 9530 784', '0', '2024-01-06 09:15:44', NULL, NULL, NULL),
(54, 'Cakrawala Aris Wahyudin', 'paulin80@yahoo.com', 'jais.hariyah', '$2y$10$YOizaQ8iHK1/a/OvQPYBQ.aXTVNvwRpUASLXZ0Env0irE49wxbQBe', 'Kpg. Asia Afrika No. 299, Bima 63867, Lampung', 'L', '(+62) 574 0062 972', '0', '2024-01-06 09:15:44', NULL, NULL, NULL),
(55, 'Ivan Sirait S.T.', 'uyainah.dewi@yahoo.com', 'pertiwi.asmadi', '$2y$10$peAJONHDVE/vSZ071aFcEOP2DWcpRpl4fOc/0c0wfIaV2MjpIoaXW', 'Ds. Banceng Pondok No. 976, Payakumbuh 22045, Kaltara', 'L', '0828 2796 4284', '0', '2024-01-06 09:15:44', NULL, NULL, NULL),
(56, 'Kenes Adriansyah M.M.', 'tantri.anggraini@habibi.org', 'nasyiah.elisa', '$2y$10$if/.XrHqXueMDaScFRSLQeF2v4FVK13HoK6JAz/I4HrkkLhgI.Jt.', 'Kpg. Achmad No. 114, Tual 63577, Babel', 'L', '(+62) 476 9879 3101', '0', '2024-01-06 09:15:44', NULL, NULL, NULL),
(57, 'Rachel Nuraini', 'okta.manullang@yahoo.com', 'jzulaika', '$2y$10$JP2Xy0pYyyoZ7asX8JrGNO.l4mGX9Ke6DZ7uGmTGYSEQNBsUdfFiO', 'Jln. Tambun No. 390, Palangka Raya 28643, Kaltim', 'P', '0457 2822 622', '0', '2024-01-06 09:15:44', NULL, NULL, NULL),
(58, 'Queen Nurdiyanti', 'rlailasari@yolanda.asia', 'vinsen.prayoga', '$2y$10$xUrF52PICmbNDrqtcd7CXOKaWSN.b9IrP2b0VcdALXidUSVXQLHIu', 'Jr. Bakhita No. 377, Yogyakarta 10929, Maluku', 'P', '(+62) 698 1356 860', '0', '2024-01-06 09:15:45', NULL, NULL, NULL),
(59, 'Maria Wulandari', 'calista69@laksmiwati.id', 'maya.habibi', '$2y$10$kk2mt9uSlNt4NOnDN2RiduuauZLpTEDhRIOpY.bobSbgPSy2/jKjW', 'Ds. Labu No. 944, Bekasi 60653, Jambi', 'L', '(+62) 579 3391 4400', '0', '2024-01-06 09:15:45', NULL, NULL, NULL),
(60, 'Gambira Lanang Budiyanto S.Gz', 'maria54@hastuti.desa.id', 'nwastuti', '$2y$10$KfCXs2543ZlJhf2KoXiSTee7qB5nrGUJuW3ZzP.Lau/yoiEac0DIK', 'Jln. Dipatiukur No. 202, Bengkulu 78598, DIY', 'P', '(+62) 20 9855 122', '0', '2024-01-06 09:15:45', NULL, NULL, NULL),
(61, 'Vanya Andriani', 'wmelani@maulana.co.id', 'frahayu', '$2y$10$PJQm.ockc2rp/P2g9AWkNup4r2fI6pkU.NSol3EKwlkgz6Ew.iwmO', 'Dk. Kali No. 159, Jambi 14499, Jatim', 'P', '(+62) 404 7533 869', '0', '2024-01-06 09:15:45', NULL, NULL, NULL),
(62, 'Bella Nadine Widiastuti', 'kenari.nuraini@gmail.co.id', 'tutami', '$2y$10$tpQF1Rix4fvp9eIhBOoJCOCiQAjNKlTpElj4Ca/wd4Kaj6.yORGpW', 'Jr. Surapati No. 184, Serang 37718, DKI', 'P', '(+62) 224 3305 3948', '0', '2024-01-06 09:15:45', NULL, NULL, NULL),
(63, 'Artawan Putra', 'zulfa84@yahoo.com', 'vmarpaung', '$2y$10$XAtJCN6tfWr7QZEReSXqv.2ZRvmZxvjRH/ERYnxCSMLmQiydNZjR2', 'Jr. Villa No. 559, Tanjungbalai 16966, DIY', 'P', '(+62) 753 1385 175', '0', '2024-01-06 09:15:45', NULL, NULL, NULL),
(64, 'Jamalia Yolanda', 'karma.halimah@yahoo.com', 'wulandari.elisa', '$2y$10$4AxoAGQb/PC90.B8hbIySOVjGz4ZwP9JTa1mcP.lYfPN0DH5RTuk.', 'Dk. Jamika No. 956, Palu 38734, Sulteng', 'P', '0733 1088 159', '0', '2024-01-06 09:15:46', NULL, NULL, NULL),
(65, 'Asirwada Daliman Anggriawan S.Farm', 'diana.rahayu@waluyo.tv', 'biswahyudi', '$2y$10$O2oO1JHJPIptCO.XPx9p0e9seAZ/E7nWoAUZUnZ3oJnhMLGUoEQ5G', 'Gg. Kyai Mojo No. 64, Cilegon 90915, Lampung', 'L', '(+62) 570 6091 020', '0', '2024-01-06 09:15:46', NULL, NULL, NULL),
(66, 'Catur Mangunsong', 'usada.belinda@susanti.id', 'lkusumo', '$2y$10$m6NUnDN3A0r1VhE.CFnfGuGKSehtwDIo2/iZTv0pw99gR1Byd0k2i', 'Kpg. Flora No. 387, Sorong 22273, Sulteng', 'L', '0498 3595 0972', '0', '2024-01-06 09:15:46', NULL, NULL, NULL),
(67, 'Zaenab Cici Wahyuni', 'fitriani82@gmail.com', 'vpratiwi', '$2y$10$q/OsTcMOoKc87fVugl7r6.IXc0v96.i7z5oODJ9ABQ6F2QoCQIBVy', 'Jr. Uluwatu No. 895, Padangsidempuan 83570, Babel', 'P', '0237 6791 2992', '0', '2024-01-06 09:15:46', NULL, NULL, NULL),
(68, 'Eli Puti Suartini', 'mansur.ida@yahoo.co.id', 'andriani.prasetya', '$2y$10$YtZQyX0p9uhkcx5XoO2lQukBB.qXm2Lzc4Jqkk74T/kJ0jD2OjdB2', 'Dk. Salatiga No. 281, Bandar Lampung 69995, Kepri', 'P', '(+62) 24 8720 5264', '0', '2024-01-06 09:15:46', NULL, NULL, NULL),
(69, 'Shania Purwanti', 'magustina@gmail.com', 'pradana.ellis', '$2y$10$fapVe3ckqpoPZU.F0LBlPekB/M8nyWHkQYBNq/RgBdd.YViZ.Xfk.', 'Dk. Sam Ratulangi No. 419, Kotamobagu 70735, Banten', 'L', '0406 3136 215', '0', '2024-01-06 09:15:46', NULL, NULL, NULL),
(70, 'Saadat Nainggolan', 'hesti.sirait@susanti.name', 'cwulandari', '$2y$10$A.KB5FZMypJKAdzgEoYOdelzAGYaYg1xwpyC.0X3lrrs7MJxK2d5.', 'Jln. Raya Ujungberung No. 822, Tanjung Pinang 21225, Sumbar', 'L', '0254 5347 950', '0', '2024-01-06 09:15:47', NULL, NULL, NULL),
(71, 'Admin', 'admin@admin.com', 'admin', '$2y$10$.yg/nqwe62FG.jH5UfVizOk8VpdFFpMK0uN2jkgCDf6rx2BjnFhIq', 'Jalan Mawar Adipala 532711', 'L', '0000111122221', '1', '2024-01-06 09:15:47', '2024-05-10 23:16:00', NULL, NULL),
(72, 'User1', 'user1@test.com', 'user1', '$2y$10$cGS8gi.eZwHk7Z4PFKjdSOVDxn.31PzIa9/Yl/.tbh3./B2hFmDHu', 'dasdsadas', 'P', '08123456789', 'U', '2024-03-21 07:54:40', '2024-03-21 07:54:40', NULL, NULL),
(73, 'hafif', 'hafif@gmail.com', 'hafif', '$2y$10$U0nHcwHYv5uZG7uznOe5neYUHx43O4cDri/FZC8SDCD.X3vCmapCC', 'jl', '', '', '0', '2024-06-06 07:48:45', NULL, NULL, NULL),
(74, 'Gantar Ramadan S.Pt', 'gentar@gmail.com', 'adminn', '$2y$10$90fvXI8O6TGkZvk3rStz/e6uVmta1s.BB6g.NvWl0ezQ4Hxe6Bzwq', 'Ds. Untung Suropati No. 423, Cirebon 75201, Bengkulu', 'L', '0693 1706 1137', '1', '2024-10-06 08:25:58', '2025-06-13 11:48:34', NULL, NULL),
(76, 'kontributor EDIT LAGI EEEEE', 'kontributor@gmail.com', 'kontributor', '$2y$10$Krm7TGAuLKCoUr3NDxARHey2eIwdzfd.kgwGna3QWrquxYFHUwqXG', 'asasasasa', 'L', '02830312312', '3', '2024-10-06 08:25:58', '2025-06-13 08:08:51', NULL, NULL),
(77, 'pengguna', 'pengguna@gmail.com', 'pengguna', '$2y$10$Krm7TGAuLKCoUr3NDxARHey2eIwdzfd.kgwGna3QWrquxYFHUwqXG', 'asasasasa', '', '432423423', '2', '2024-10-06 08:25:58', '2024-10-20 06:10:04', NULL, NULL),
(78, 'sss', 'sss@gmail.com', 'sss', '$2y$10$eOOCNxBOjP.rT8j52eVrD.auBpZsUVfSne93n3eDmJDcwNX0I9wZm', 'sss', 'L', '2124124', 'U', '2025-06-02 06:37:28', '2025-06-02 06:37:28', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `arsip`
--
ALTER TABLE `arsip`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fonds_tahun`
--
ALTER TABLE `fonds_tahun`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `arsip`
--
ALTER TABLE `arsip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `fonds_tahun`
--
ALTER TABLE `fonds_tahun`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
