-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 06, 2023 at 11:26 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kredit_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_appsetting`
--

CREATE TABLE `tb_appsetting` (
  `id` int(11) NOT NULL,
  `nama_aplikasi` varchar(20) NOT NULL,
  `nama_perusahaan` varchar(100) NOT NULL,
  `alamat1` varchar(200) NOT NULL,
  `alamat2` varchar(200) NOT NULL,
  `kode_pos` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telpon` varchar(15) NOT NULL,
  `logo` text NOT NULL,
  `bank1` varchar(50) NOT NULL,
  `bank2` varchar(50) NOT NULL,
  `bank3` varchar(50) NOT NULL,
  `atas_nama1` varchar(50) NOT NULL,
  `atas_nama2` varchar(50) NOT NULL,
  `atas_nama3` varchar(50) NOT NULL,
  `no_rekening1` varchar(50) NOT NULL,
  `no_rekening2` varchar(50) NOT NULL,
  `no_rekening3` varchar(50) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_appsetting`
--

INSERT INTO `tb_appsetting` (`id`, `nama_aplikasi`, `nama_perusahaan`, `alamat1`, `alamat2`, `kode_pos`, `email`, `telpon`, `logo`, `bank1`, `bank2`, `bank3`, `atas_nama1`, `atas_nama2`, `atas_nama3`, `no_rekening1`, `no_rekening2`, `no_rekening3`, `keterangan`) VALUES
(1, 'KREDIT APP', 'CV. MITRA MANDIRI SKM', 'Darmaraja', 'Sumedang', '45372', 'rifkkimaulana@gmail.com', '083130649979', '1693495288_f60c98d12ef86f8e8c24.png', 'Bank Mandiri', 'Bank Mandiri', 'LINK AJA', 'RIFKI MAULANA', 'RUKMANA', 'RIFKI MAULANA', '1310016635064', '1310016161319', '083130649979', 'Aplikasi Kredit Barang');

-- --------------------------------------------------------

--
-- Table structure for table `tb_google_api_login`
--

CREATE TABLE `tb_google_api_login` (
  `id` int(11) NOT NULL,
  `client_id` varchar(255) NOT NULL,
  `client_secret` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_google_api_login`
--

INSERT INTO `tb_google_api_login` (`id`, `client_id`, `client_secret`) VALUES
(1, '864273206547-ai0t5ucousroe6gguhc6a99sq3vag8c2.apps.googleusercontent.com', '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');

-- --------------------------------------------------------

--
-- Table structure for table `tb_identitas`
--

CREATE TABLE `tb_identitas` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nama_lengkap` varchar(255) DEFAULT NULL,
  `nomor_identitas` varchar(20) DEFAULT NULL,
  `tempat_lahir` varchar(100) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') DEFAULT NULL,
  `alamat` text,
  `agama` varchar(50) DEFAULT NULL,
  `status_pernikahan` enum('Belum Menikah','Menikah','Cerai') DEFAULT NULL,
  `pekerjaan` varchar(100) DEFAULT NULL,
  `foto_identitas` varchar(255) DEFAULT NULL,
  `foto_selvi_ktp` varchar(255) DEFAULT NULL,
  `status` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `nomor_alternatif_1` varchar(20) DEFAULT NULL,
  `nama_alternatif_1` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_identitas`
--

INSERT INTO `tb_identitas` (`id`, `user_id`, `nama_lengkap`, `nomor_identitas`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `alamat`, `agama`, `status_pernikahan`, `pekerjaan`, `foto_identitas`, `foto_selvi_ktp`, `status`, `created_at`, `updated_at`, `nomor_alternatif_1`, `nama_alternatif_1`) VALUES
(7, 4, 'Rifki Maulana', '32110303254158', 'Sumedang', '2023-09-07', 'Perempuan', 'op[huilo', 'ISLAM', 'Menikah', 'fftyu', 'ktp_1693989136_35d6301c533de1c54117.jpg', 'selvi_1693989136_c940f7388a12471160a2.jpg', 'Sedang Ditinjau', '2023-09-06 08:17:25', '2023-09-06 08:32:16', 'rtyu', 'rtyu');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategoriproduk`
--

CREATE TABLE `tb_kategoriproduk` (
  `id` int(11) NOT NULL,
  `nama_kategori` varchar(255) NOT NULL,
  `deskripsi` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kategoriproduk`
--

INSERT INTO `tb_kategoriproduk` (`id`, `nama_kategori`, `deskripsi`, `created_at`, `updated_at`) VALUES
(4, 'Handphone', 'Handphone', '2023-09-03 05:58:43', '2023-09-03 06:15:31');

-- --------------------------------------------------------

--
-- Table structure for table `tb_keranjang`
--

CREATE TABLE `tb_keranjang` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `produk_id` int(11) NOT NULL,
  `harga_satuan` decimal(10,2) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_kredit`
--

CREATE TABLE `tb_kredit` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `no_kontrak` varchar(50) DEFAULT NULL,
  `jangka_waktu` int(11) DEFAULT NULL,
  `total_kredit` varchar(100) DEFAULT NULL,
  `tanggal_cetak` int(11) DEFAULT NULL,
  `jatuh_tempo` int(11) DEFAULT NULL,
  `file_kontrak` text NOT NULL,
  `status` varchar(50) NOT NULL,
  `no_transaksi` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_log_aktifitas`
--

CREATE TABLE `tb_log_aktifitas` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `ip_address` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_pembayaran`
--

CREATE TABLE `tb_pembayaran` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `jenis_pembayaran` varchar(10) DEFAULT NULL,
  `kredit_id` int(11) DEFAULT NULL,
  `bukti_transfer` varchar(100) DEFAULT NULL,
  `no_kontrak` varchar(50) DEFAULT NULL,
  `jumlah_pembayaran` varchar(50) DEFAULT NULL,
  `no_referensi` varchar(50) DEFAULT NULL,
  `status` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_penjualan`
--

CREATE TABLE `tb_penjualan` (
  `id` int(11) NOT NULL,
  `no_transaksi` varchar(20) NOT NULL,
  `tanggal_penjualan` text,
  `id_users` int(11) DEFAULT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `harga_satuan` decimal(10,2) DEFAULT NULL,
  `total_harga` decimal(10,2) DEFAULT NULL,
  `metode_pembayaran` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `no_referensi` varchar(20) NOT NULL,
  `no_kontrak` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_produk`
--

CREATE TABLE `tb_produk` (
  `id` int(11) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `deskripsi` text,
  `harga` decimal(10,2) NOT NULL,
  `stok` int(11) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `kategori_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_produk`
--

INSERT INTO `tb_produk` (`id`, `nama_produk`, `deskripsi`, `harga`, `stok`, `gambar`, `kategori_id`, `created_at`, `updated_at`) VALUES
(10, 'Paket Mendak Studio', 'Paket Mendak Studio', '20000.00', 100, '1693720748_5e345c6609ad983083bb.jpg', 4, '2023-09-03 05:59:08', '2023-09-05 06:16:28');

-- --------------------------------------------------------

--
-- Table structure for table `tb_users`
--

CREATE TABLE `tb_users` (
  `user_id` int(11) NOT NULL,
  `user_nama` varchar(100) NOT NULL,
  `user_username` varchar(100) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  `user_foto` varchar(100) DEFAULT NULL,
  `user_level` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `no_wa` varchar(20) NOT NULL,
  `reset_token` varchar(100) NOT NULL,
  `reset_id` varchar(100) NOT NULL,
  `keterangan` text NOT NULL,
  `app_id` int(11) NOT NULL,
  `country` varchar(50) NOT NULL,
  `facebook` varchar(50) NOT NULL,
  `tweeter` varchar(50) NOT NULL,
  `instagram` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_users`
--

INSERT INTO `tb_users` (`user_id`, `user_nama`, `user_username`, `user_password`, `user_foto`, `user_level`, `email`, `no_wa`, `reset_token`, `reset_id`, `keterangan`, `app_id`, `country`, `facebook`, `tweeter`, `instagram`) VALUES
(4, 'Rifki Maulana', 'admin', '$2y$10$FWIR7MpBvlYjO.ocx1NZI.iFgb68KxmNWRxYGarVCbQD9kzr9LLC.', '1693988547_0078b59238b5f1c15c9f.webp', 'administrator', 'rifkkimaulana@gmail.com', '083130649979', '', '', '', 1, 'Indonesia', '', '', ''),
(9, 'asd', '', '$2y$10$9S3dY1DTAt/6v6XG9FwIv.zWnKM4wjysuvwzNAfisTv3pw.VNL.rO', NULL, 'member', 'asd@asd.asd', '', '', '', '', 0, '', '', '', ''),
(12, 'kiki', 'kiki', '$2y$10$17MErUlwytGwpynH6CIymuZbD0IWxn2ibJEQ8uT9rNMEOSnaaCFX.', NULL, 'member', 'rifki@gmail.com', '', '', '', '', 0, '', '', '', ''),
(13, 'asdf', 'asdf', '$2y$10$vXGr/Qx0d3baMzvvy1mg5.AL41V4euB/gSUBztpXvfKrXT1vOlRWi', NULL, 'member', '', '628989858782', '', '', '', 0, '', '', '', ''),
(14, 'asdfg', 'asdfg', '$2y$10$oEiNNyv49rZ3zlWCO8xVG.3iP/HwoD2jVvJzTXq.naG0dvxp9PtGe', NULL, 'member', '64f56fe9861c1_contoh@emailkamu.com', '082118844992', '', '', '', 0, '', '', '', ''),
(15, '', 'username_4e1094948e', '', NULL, '', '5f3b7c12d3sample@gmail.com', '088288284654', '', '', '', 0, '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_wablas`
--

CREATE TABLE `tb_wablas` (
  `id` int(11) NOT NULL,
  `domain` varchar(100) NOT NULL,
  `token_api` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_wablas`
--

INSERT INTO `tb_wablas` (`id`, `domain`, `token_api`) VALUES
(1, 'https://kudus.wablas.com/api/send-message', 'yb2BtD05MDyIadY9u0FJjztE37yJqmPcZnATxbQxES6st523xa85S0t1wvdWFnFT');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_appsetting`
--
ALTER TABLE `tb_appsetting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_google_api_login`
--
ALTER TABLE `tb_google_api_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_identitas`
--
ALTER TABLE `tb_identitas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nomor_identitas` (`nomor_identitas`);

--
-- Indexes for table `tb_kategoriproduk`
--
ALTER TABLE `tb_kategoriproduk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_keranjang`
--
ALTER TABLE `tb_keranjang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `produk_id` (`produk_id`);

--
-- Indexes for table `tb_kredit`
--
ALTER TABLE `tb_kredit`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `no_kontrak` (`no_kontrak`);

--
-- Indexes for table `tb_log_aktifitas`
--
ALTER TABLE `tb_log_aktifitas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_penjualan`
--
ALTER TABLE `tb_penjualan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_users` (`id_users`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indexes for table `tb_produk`
--
ALTER TABLE `tb_produk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kategori_id` (`kategori_id`);

--
-- Indexes for table `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`user_username`),
  ADD UNIQUE KEY `email & whatsapp` (`email`,`no_wa`);

--
-- Indexes for table `tb_wablas`
--
ALTER TABLE `tb_wablas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_appsetting`
--
ALTER TABLE `tb_appsetting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_google_api_login`
--
ALTER TABLE `tb_google_api_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_identitas`
--
ALTER TABLE `tb_identitas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_kategoriproduk`
--
ALTER TABLE `tb_kategoriproduk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_keranjang`
--
ALTER TABLE `tb_keranjang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_kredit`
--
ALTER TABLE `tb_kredit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_log_aktifitas`
--
ALTER TABLE `tb_log_aktifitas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_penjualan`
--
ALTER TABLE `tb_penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_produk`
--
ALTER TABLE `tb_produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tb_wablas`
--
ALTER TABLE `tb_wablas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_keranjang`
--
ALTER TABLE `tb_keranjang`
  ADD CONSTRAINT `tb_keranjang_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tb_users` (`user_id`),
  ADD CONSTRAINT `tb_keranjang_ibfk_2` FOREIGN KEY (`produk_id`) REFERENCES `tb_produk` (`id`);

--
-- Constraints for table `tb_penjualan`
--
ALTER TABLE `tb_penjualan`
  ADD CONSTRAINT `tb_penjualan_ibfk_1` FOREIGN KEY (`id_users`) REFERENCES `tb_users` (`user_id`),
  ADD CONSTRAINT `tb_penjualan_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `tb_produk` (`id`);

--
-- Constraints for table `tb_produk`
--
ALTER TABLE `tb_produk`
  ADD CONSTRAINT `tb_produk_ibfk_1` FOREIGN KEY (`kategori_id`) REFERENCES `tb_kategoriproduk` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
