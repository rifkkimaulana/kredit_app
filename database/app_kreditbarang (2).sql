-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 31, 2023 at 11:46 AM
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
-- Database: `app_kreditbarang`
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
  `no_rekening3` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_appsetting`
--

INSERT INTO `tb_appsetting` (`id`, `nama_aplikasi`, `nama_perusahaan`, `alamat1`, `alamat2`, `kode_pos`, `email`, `telpon`, `logo`, `bank1`, `bank2`, `bank3`, `atas_nama1`, `atas_nama2`, `atas_nama3`, `no_rekening1`, `no_rekening2`, `no_rekening3`) VALUES
(1, 'RG ONLINE', 'CV. MITRA MANDIRI SKM', 'Darmaraja', 'Sumedang', '45372', 'rifkkimaulana@gmail.com', '083130649979', '1693246191_cdfc42780c870688e2d6.png', 'Bank Mandiri', 'Bank Mandiri', 'LINK AJA', 'RIFKI MAULANA', 'RUKMANA', 'RIFKI MAULANA', '1310016635064', '1310016161319', '083130649979');

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
(3, 'Handphone', 'Handphone', '2023-08-30 04:26:26', '2023-08-30 04:26:26');

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
-- Table structure for table `tb_penjualan`
--

CREATE TABLE `tb_penjualan` (
  `id` int(11) NOT NULL,
  `tanggal_penjualan` text,
  `id_users` int(11) DEFAULT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `harga_satuan` decimal(10,2) DEFAULT NULL,
  `total_harga` decimal(10,2) DEFAULT NULL,
  `metode_pembayaran` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_penjualan`
--

INSERT INTO `tb_penjualan` (`id`, `tanggal_penjualan`, `id_users`, `id_produk`, `jumlah`, `harga_satuan`, `total_harga`, `metode_pembayaran`, `status`, `created_at`, `updated_at`) VALUES
(12, '2023-08-31', 8, 8, 3, '1300000.00', '3900000.00', 'cash', 'pending', '2023-08-31 08:13:13', '2023-08-31 08:13:13'),
(13, '2023-08-31', 8, 8, 3, '1300000.00', '3900000.00', 'transfer_bank', 'pending', '2023-08-31 08:17:17', '2023-08-31 08:17:17'),
(14, '2023-08-31', 8, 9, 1, '1300000.00', '1300000.00', 'transfer_bank', 'pending', '2023-08-31 08:17:17', '2023-08-31 08:17:17');

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
(8, 'OPPO A3s', 'Spesifikasi Oppo A3s\r\nHP Snapdragon 450 dengan konfigurasi Chipset Qualcomm SDM450 Snapdragon 450 (14 nm), CPU Octa-core 1.8 GHz Cortex-A53 dan GPU Adreno 506\r\nHP RAM 2-4 GB dengan konfigurasi memori 16GB 2GB RAM, 32GB 3GB RAM, 64GB 4GB RAM\r\nHP Kamera 13 MP dengan konfigurasi sensor 13 MP, f/2.2, AF 2 MP, f/2.4, (depth)\r\nLayar IPS LCD, 6.2 inches, 95.9 cm2 (~81.2% screen-to-body ratio), 720 x 1520 pixels, 19:9 ratio (~271 ppi density)', '1300000.00', 5, '1693369442_737f045d80776af7011e.jpeg', 3, '2023-08-30 04:24:02', '2023-08-30 04:26:51'),
(9, 'SEWA', '123', '1300000.00', 1, '1693385201_7ce222780a447f333fa1.jpg', 3, '2023-08-30 08:46:42', '2023-08-30 08:46:42');

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
  `country` varchar(50) NOT NULL,
  `facebook` varchar(50) NOT NULL,
  `tweeter` varchar(50) NOT NULL,
  `instagram` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_users`
--

INSERT INTO `tb_users` (`user_id`, `user_nama`, `user_username`, `user_password`, `user_foto`, `user_level`, `email`, `no_wa`, `reset_token`, `reset_id`, `keterangan`, `country`, `facebook`, `tweeter`, `instagram`) VALUES
(4, 'Rifki Maulana', 'admin', '$2y$10$FWIR7MpBvlYjO.ocx1NZI.iFgb68KxmNWRxYGarVCbQD9kzr9LLC.', '', 'administrator', 'rifkkimaulana@gmail.com', '083130649979', '255195ff9863afc25f017044da4ffa68', '4ada0148-a11a-4240-8c4b-d04c54e0ba6b', 'Tidak Ada Information. ', 'Indonesia', 'a', 'b', 'c'),
(8, 'Abiel Jatnika', 'abiel', '$2y$10$9NhKmeQgPIKGZGR9CMUy.u9Yrm9bLJEj0KMf5bGyTwJfa0QZpS5.y', '1693238885_d61da9353a7a5932f662.png', 'member', 'rifkkimaulana@34.id', '234234234', '', '', '   null\r\n', 'Indonesia', 'a', 'v', 'e');

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
-- AUTO_INCREMENT for table `tb_kategoriproduk`
--
ALTER TABLE `tb_kategoriproduk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_keranjang`
--
ALTER TABLE `tb_keranjang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_penjualan`
--
ALTER TABLE `tb_penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tb_produk`
--
ALTER TABLE `tb_produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
