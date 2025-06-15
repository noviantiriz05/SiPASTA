-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 15, 2025 at 04:07 PM
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
-- Database: `sipasta`
--

-- --------------------------------------------------------

--
-- Table structure for table `halaman`
--

CREATE TABLE `halaman` (
  `id` int(11) NOT NULL,
  `perihal` varchar(300) NOT NULL,
  `pengirim` varchar(300) NOT NULL,
  `penerima` varchar(300) NOT NULL,
  `jsurat` enum('Surat Masuk','Surat Keluar') NOT NULL,
  `isi` text NOT NULL,
  `tgl_isi` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `halaman`
--

INSERT INTO `halaman` (`id`, `perihal`, `pengirim`, `penerima`, `jsurat`, `isi`, `tgl_isi`) VALUES
(1, 'Laporan Keuangan', 'Departemen Keuangan', 'Departemen Manajemen', 'Surat Masuk', 'CEKKK', '2025-05-16 02:47:26'),
(12, 'Administrasi', 'Admin', 'Direktur', 'Surat Keluar', 'CEK ISI', '2025-05-17 06:09:06'),
(13, 'Selamat Datang di SiPASTA', 'SiPASTA #Aman #Tertata', 'user', 'Surat Masuk', '<p style=\"text-align: justify; \">Selamat datang di aplikasi E-Arsip SiPASTA. Aplikasi ini dirancang untuk memudahkan proses pengarsipan surat masuk secara digital. Fitur-fitur di dalamnya akan terus dikembangkan guna menunjang efisiensi kerja administrasi Anda.</p><p style=\"text-align: justify; \"><br>Silahkan gunakan menu yang tersedia untuk mengakses fitur aplikasi!</p><p><img src=\"../gambar/006f52e9102a8d3be2fe5614f42ba989.png\" style=\"width: 500px;\"><br></p>', '2025-06-07 05:19:43'),
(14, 'Surat Masuk', 'Silahkan Terima Surat Surat!', 'user', 'Surat Masuk', '<p style=\"text-align: justify; \">Selamat datang di layanan Surat Masuk. Di sini, Anda dapat mengakses, memantau, dan menelusuri seluruh dokumen surat masuk secara efisien dan terorganisir. Sistem ini dirancang untuk memudahkan pencatatan dan pelacakan korespondensi resmi secara digital, cepat, dan aman.</p><p><img src=\"../gambar/5ef059938ba799aaa845e1c2e8a762bd.png\" style=\"width: 50%;\"><br></p><p><br></p>', '2025-06-15 08:24:38'),
(15, 'Surat Keluar', 'Ayo Kirim Surat!', 'user', 'Surat Masuk', '<p></p><p style=\"text-align: justify;\"><span data-start=\"86\" data-end=\"129\">Selamat datang di layanan Surat Keluar.&nbsp;</span>Fasilitas ini membantu Anda dalam menyusun, mencatat, dan mengirim dokumen surat keluar dengan tertib dan profesional. Sistem ini dibuat untuk mempercepat proses administrasi korespondensi resmi, sekaligus memastikan keamanan dan ketelusuran data secara digital.</p><p style=\"text-align: justify;\"><img src=\"../gambar/38af86134b65d0f10fe33d30dd76442e.png\" style=\"width: 50%;\"><br></p>', '2025-06-15 08:24:55'),
(16, 'Arsip Surat', '#TataSurat', 'user', 'Surat Masuk', '<p><img src=\"../gambar/7ef605fc8dba5425d6965fbd4c8fbe1f.png\" style=\"width: 50%;\"></p><p><span data-start=\"262\" data-end=\"304\">Selamat datang di layanan Arsip Surat.&nbsp;</span>Fasilitas ini disediakan untuk menelusuri dan melihat surat-surat yang telah masuk dan keluar secara mudah dan cepat. Sistem ini membantu pengguna dalam menemukan kembali dokumen yang dibutuhkan, sekaligus menjaga keteraturan, keamanan, dan ketelusuran surat secara digital.</p>', '2025-06-15 08:25:13');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nama_lengkap` varchar(500) NOT NULL,
  `password` text NOT NULL,
  `status` text NOT NULL,
  `token_ganti_password` text NOT NULL,
  `tgl_isi` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `email`, `nama_lengkap`, `password`, `status`, `token_ganti_password`, `tgl_isi`) VALUES
(1, 'lunavia61@gmail.com', 'Lunavia', 'fb7d5e2b55869b1c5b20c4c1495582a1', '1', 'ccb1d45fb76f7c5a0bf619f979c6cf36', '2025-06-09 08:01:12'),
(4, 'noviantirizkika@gmail.com', 'Novianti Rizkika Amelia', '5d05a00b5cb14be487db584ebfdd0a8e', '1', '', '2025-06-14 13:34:16');

-- --------------------------------------------------------

--
-- Table structure for table `surat_keluar`
--

CREATE TABLE `surat_keluar` (
  `id` int(11) NOT NULL,
  `perihal` varchar(300) NOT NULL,
  `pengirim` varchar(300) NOT NULL,
  `penerima` varchar(300) NOT NULL,
  `jsurat` enum('Surat Keluar') NOT NULL,
  `isi` text NOT NULL,
  `delete_token` varchar(300) NOT NULL,
  `tgl_isi` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `surat_keluar`
--

INSERT INTO `surat_keluar` (`id`, `perihal`, `pengirim`, `penerima`, `jsurat`, `isi`, `delete_token`, `tgl_isi`) VALUES
(1, 'Pemesanan Barang', 'PT. Saudi', 'Direktur PT Maju Mundur Jaya', 'Surat Keluar', '<p><a href=\"uploads/6843e0387bd11_Pemesanan_Barang.docx\" target=\"_blank\">Pemesanan Barang.docx</a></p>', '', '2025-06-10 04:20:54'),
(2, 'Permohonan Izin Magang Siswa', 'Andi Prasetyo', 'Kepala SMK Negeri 3 Jakarta', 'Surat Keluar', '<p><a href=\"uploads/6843fb4e8f62b_Permohonan_Izin_Magang_Siswa.pdf\" target=\"_blank\">Permohonan Izin Magang Siswa.pdf</a></p><p data-start=\"0\" data-end=\"31\"><strong data-start=\"0\" data-end=\"31\">Ringkasan isi surat keluar:</strong></p><p data-start=\"33\" data-end=\"579\" data-is-last-node=\"\" data-is-only-node=\"\">Surat ini dikirim oleh <strong data-start=\"56\" data-end=\"78\">PT. Maju Sejahtera</strong> kepada <strong data-start=\"86\" data-end=\"117\">Kepala SMK Negeri 3 Jakarta</strong> untuk <strong data-start=\"124\" data-end=\"155\">memohon izin program magang</strong> bagi siswa-siswi dari sekolah tersebut. Program magang direncanakan berlangsung dari <strong data-start=\"241\" data-end=\"276\">1 Juli hingga 30 September 2025</strong> di kantor pusat PT. Maju Sejahtera, dengan bidang kerja <strong data-start=\"333\" data-end=\"397\">administrasi perkantoran, pemasaran, dan teknologi informasi</strong>. Perusahaan siap menerima maksimal <strong data-start=\"433\" data-end=\"444\">5 siswa</strong>, dan berharap pihak sekolah menunjuk peserta terbaik. Surat ini merupakan bagian dari program <strong data-start=\"539\" data-end=\"578\">CSR perusahaan di bidang pendidikan</strong>.</p><p>\r\n<br></p>', '', '2025-06-07 08:42:13'),
(3, 'Permohonan Data Alumni', 'Anisa Rahmawati, S.Sos.', 'Kepala Bagian Akademik', 'Surat Keluar', 'uploads/684e439158bfc.docx', '', '2025-06-15 03:52:49');

-- --------------------------------------------------------

--
-- Table structure for table `surat_masuk`
--

CREATE TABLE `surat_masuk` (
  `id` int(11) NOT NULL,
  `perihal` varchar(300) NOT NULL,
  `pengirim` varchar(300) NOT NULL,
  `penerima` varchar(300) NOT NULL,
  `jsurat` enum('Surat Masuk') NOT NULL,
  `isi` varchar(300) NOT NULL,
  `tgl_isi` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `surat_masuk`
--

INSERT INTO `surat_masuk` (`id`, `perihal`, `pengirim`, `penerima`, `jsurat`, `isi`, `tgl_isi`) VALUES
(1, 'Permohonan Penawaran Kerja Sama Jasa Logistik', 'PT. Cendana Abadi', 'Andi Nugroho', 'Surat Masuk', '<p><a href=\"uploads/6843eeda57aaf_Permohonan_Penawaran_Kerja_Sama_Jasa_Logistik.docx\" target=\"_blank\">Permohonan Penawaran Kerja Sama Jasa Logistik.docx</a></p>', '2025-06-15 04:48:47'),
(2, 'Permohonan Kerja Sama Rekrutmen Karyawan', 'PT. MAJU SEJAHTERA', 'Manajer SDM PT. Sinar Abadi', 'Surat Masuk', '<p><a href=\"uploads/6843f9b69c6d3_Permohonan_Kerja_Sama_Rekrutmen_Karyawan.pdf\" target=\"_blank\">Permohonan Kerja Sama Rekrutmen Karyawan.pdf</a></p><p data-start=\"0\" data-end=\"24\"><strong data-start=\"0\" data-end=\"24\">Ringkasan isi surat:</strong></p><p data-start=\"26\" data-end=\"492\" data-is-last-nod', '2025-06-15 04:16:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `halaman`
--
ALTER TABLE `halaman`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surat_keluar`
--
ALTER TABLE `surat_keluar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surat_masuk`
--
ALTER TABLE `surat_masuk`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `halaman`
--
ALTER TABLE `halaman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `surat_keluar`
--
ALTER TABLE `surat_keluar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `surat_masuk`
--
ALTER TABLE `surat_masuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
