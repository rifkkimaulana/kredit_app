-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Sep 2023 pada 05.05
-- Versi server: 10.1.37-MariaDB
-- Versi PHP: 7.3.0

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
-- Struktur dari tabel `tb_appsetting`
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
-- Dumping data untuk tabel `tb_appsetting`
--

INSERT INTO `tb_appsetting` (`id`, `nama_aplikasi`, `nama_perusahaan`, `alamat1`, `alamat2`, `kode_pos`, `email`, `telpon`, `logo`, `bank1`, `bank2`, `bank3`, `atas_nama1`, `atas_nama2`, `atas_nama3`, `no_rekening1`, `no_rekening2`, `no_rekening3`, `keterangan`) VALUES
(1, 'RG PRODUCTION', 'CV. MITRA MANDIRI SKM', 'Darmaraja', 'Sumedang', '45372', 'rifkkimaulana@gmail.com', '083130649979', '1693495288_f60c98d12ef86f8e8c24.png', 'Bank Mandiri', 'Bank Mandiri', 'LINK AJA', 'RIFKI MAULANA', 'RUKMANA', 'RIFKI MAULANA', '1310016635064', '1310016161319', '083130649979', 'Aplikasi Kredit Barang');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_google_api_login`
--

CREATE TABLE `tb_google_api_login` (
  `id` int(11) NOT NULL,
  `client_id` varchar(255) NOT NULL,
  `client_secret` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_google_api_login`
--

INSERT INTO `tb_google_api_login` (`id`, `client_id`, `client_secret`) VALUES
(1, '864273206547-ai0t5ucousroe6gguhc6a99sq3vag8c2.apps.googleusercontent.com', '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');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kategoriproduk`
--

CREATE TABLE `tb_kategoriproduk` (
  `id` int(11) NOT NULL,
  `nama_kategori` varchar(255) NOT NULL,
  `deskripsi` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_kategoriproduk`
--

INSERT INTO `tb_kategoriproduk` (`id`, `nama_kategori`, `deskripsi`, `created_at`, `updated_at`) VALUES
(4, 'Handphone', 'Handphone', '2023-09-03 05:58:43', '2023-09-03 06:15:31');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_keranjang`
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

--
-- Dumping data untuk tabel `tb_keranjang`
--

INSERT INTO `tb_keranjang` (`id`, `user_id`, `produk_id`, `harga_satuan`, `jumlah`, `created_at`, `updated_at`) VALUES
(4, 9, 10, '20000.00', 1, '2023-09-04 06:34:18', '2023-09-04 06:34:18'),
(5, 14, 10, '20000.00', 1, '2023-09-04 06:39:43', '2023-09-04 06:39:43'),
(23, 4, 10, '20000.00', 1, '2023-09-04 15:29:03', '2023-09-04 15:29:03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kredit`
--

CREATE TABLE `tb_kredit` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `no_kontrak` varchar(50) DEFAULT NULL,
  `jangka_waktu` int(11) DEFAULT NULL,
  `total_kredit` varchar(100) DEFAULT NULL,
  `tanggal_cetak` int(11) DEFAULT NULL,
  `jatuh_tempo` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_kredit`
--

INSERT INTO `tb_kredit` (`id`, `user_id`, `no_kontrak`, `jangka_waktu`, `total_kredit`, `tanggal_cetak`, `jatuh_tempo`, `created_at`) VALUES
(1, 4, '3544576223', 10, '2300000', 15, 5, '2023-09-04 17:27:51');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_log_aktifitas`
--

CREATE TABLE `tb_log_aktifitas` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `ip_address` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pembayaran`
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

--
-- Dumping data untuk tabel `tb_pembayaran`
--

INSERT INTO `tb_pembayaran` (`id`, `user_id`, `jenis_pembayaran`, `kredit_id`, `bukti_transfer`, `no_kontrak`, `jumlah_pembayaran`, `no_referensi`, `status`, `created_at`) VALUES
(3, 4, 'Transfer', 1, '1693850229_47e1309a329867d69db6.jpg', '3544576223', '230000', 'REF.9025515260', 'Berhasil Diterima', '2023-09-04 18:10:34'),
(4, 4, 'Transfer', 1, '1693851293_bc1c36c2640747f3f694.jpg', '3544576223', '230000', 'REF.3391314979', 'Menunggu Konfirmasi', '2023-09-04 18:14:53');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_penjualan`
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
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_penjualan`
--

INSERT INTO `tb_penjualan` (`id`, `no_transaksi`, `tanggal_penjualan`, `id_users`, `id_produk`, `jumlah`, `harga_satuan`, `total_harga`, `metode_pembayaran`, `status`, `no_referensi`, `created_at`, `updated_at`) VALUES
(5, '', '2023-09-03', 9, 10, 1, '20000.00', '20000.00', 'tunai', 'Lunas', '', '2023-09-03 08:08:02', '2023-09-03 08:08:33'),
(6, '', '2023-09-03', 9, 10, 1, '20000.00', '20000.00', 'transfer_bank', 'Lunas', '', '2023-09-03 08:11:54', '2023-09-03 08:14:37'),
(7, '', '2023-09-03', 9, 10, 2, '20000.00', '40000.00', 'tunai', 'Lunas', '', '2023-09-03 08:15:29', '2023-09-03 08:15:38'),
(8, '20230903032009', '2023-09-03', 9, 10, 2, '20000.00', '40000.00', 'transfer_bank', 'Lunas', '2023090303200980IEO4', '2023-09-03 08:20:09', '2023-09-03 08:23:27'),
(9, '20230904000010', '2023-09-04', 9, 10, 1, '20000.00', '20000.00', 'transfer_bank', 'Lunas', '20230904000010Z52NSJ', '2023-09-04 05:00:10', '2023-09-04 05:19:14'),
(10, '20230904004008', '2023-09-04', 12, 10, 1, '20000.00', '20000.00', 'Transfer', 'pending', '2023090400400816UMAS', '2023-09-04 05:40:08', '2023-09-04 05:40:08'),
(11, '20230904021622', '2023-09-04', 9, 10, 1, '20000.00', '20000.00', 'Tunai', 'pending', '20230904021622WCEZQY', '2023-09-04 07:16:22', '2023-09-04 07:16:22'),
(13, '20230904023627', '2023-09-04', 9, 10, 1, '20000.00', '20000.00', 'Tunai', 'Lunas', '202309040236271F3MYN', '2023-09-04 07:36:27', '2023-09-04 07:37:31');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_produk`
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
-- Dumping data untuk tabel `tb_produk`
--

INSERT INTO `tb_produk` (`id`, `nama_produk`, `deskripsi`, `harga`, `stok`, `gambar`, `kategori_id`, `created_at`, `updated_at`) VALUES
(10, 'Paket Mendak Studio', 'Paket Mendak Studio', '20000.00', 1, '1693720748_5e345c6609ad983083bb.jpg', 4, '2023-09-03 05:59:08', '2023-09-04 07:37:31');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_users`
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
-- Dumping data untuk tabel `tb_users`
--

INSERT INTO `tb_users` (`user_id`, `user_nama`, `user_username`, `user_password`, `user_foto`, `user_level`, `email`, `no_wa`, `reset_token`, `reset_id`, `keterangan`, `app_id`, `country`, `facebook`, `tweeter`, `instagram`) VALUES
(4, 'Rifki Maulana', 'admin', '$2y$10$FWIR7MpBvlYjO.ocx1NZI.iFgb68KxmNWRxYGarVCbQD9kzr9LLC.', '', 'administrator', 'rifkkimaulana@gmail.com', '083130649979', '', '', '-', 0, 'Indonesia', '-', '-', '-'),
(9, 'asd', '', '$2y$10$9S3dY1DTAt/6v6XG9FwIv.zWnKM4wjysuvwzNAfisTv3pw.VNL.rO', NULL, 'member', 'asd@asd.asd', '', '', '', '', 0, '', '', '', ''),
(12, 'kiki', 'kiki', '$2y$10$17MErUlwytGwpynH6CIymuZbD0IWxn2ibJEQ8uT9rNMEOSnaaCFX.', NULL, 'member', 'rifki@gmail.com', '', '', '', '', 0, '', '', '', ''),
(13, 'asdf', 'asdf', '$2y$10$vXGr/Qx0d3baMzvvy1mg5.AL41V4euB/gSUBztpXvfKrXT1vOlRWi', NULL, 'member', '', '628989858782', '', '', '', 0, '', '', '', ''),
(14, 'asdfg', 'asdfg', '$2y$10$oEiNNyv49rZ3zlWCO8xVG.3iP/HwoD2jVvJzTXq.naG0dvxp9PtGe', NULL, 'member', '64f56fe9861c1_contoh@emailkamu.com', '082118844992', '', '', '', 0, '', '', '', ''),
(15, '', 'username_4e1094948e', '', NULL, '', '5f3b7c12d3sample@gmail.com', '088288284654', '', '', '', 0, '', '', '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_wablas`
--

CREATE TABLE `tb_wablas` (
  `id` int(11) NOT NULL,
  `domain` varchar(100) NOT NULL,
  `token_api` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_wablas`
--

INSERT INTO `tb_wablas` (`id`, `domain`, `token_api`) VALUES
(1, 'https://kudus.wablas.com/api/send-message', 'yb2BtD05MDyIadY9u0FJjztE37yJqmPcZnATxbQxES6st523xa85S0t1wvdWFnFT');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_appsetting`
--
ALTER TABLE `tb_appsetting`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_google_api_login`
--
ALTER TABLE `tb_google_api_login`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_kategoriproduk`
--
ALTER TABLE `tb_kategoriproduk`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_keranjang`
--
ALTER TABLE `tb_keranjang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `produk_id` (`produk_id`);

--
-- Indeks untuk tabel `tb_kredit`
--
ALTER TABLE `tb_kredit`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `no_kontrak` (`no_kontrak`);

--
-- Indeks untuk tabel `tb_log_aktifitas`
--
ALTER TABLE `tb_log_aktifitas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_penjualan`
--
ALTER TABLE `tb_penjualan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_users` (`id_users`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indeks untuk tabel `tb_produk`
--
ALTER TABLE `tb_produk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kategori_id` (`kategori_id`);

--
-- Indeks untuk tabel `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`user_username`),
  ADD UNIQUE KEY `email & whatsapp` (`email`,`no_wa`);

--
-- Indeks untuk tabel `tb_wablas`
--
ALTER TABLE `tb_wablas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_appsetting`
--
ALTER TABLE `tb_appsetting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_google_api_login`
--
ALTER TABLE `tb_google_api_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_kategoriproduk`
--
ALTER TABLE `tb_kategoriproduk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_keranjang`
--
ALTER TABLE `tb_keranjang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `tb_kredit`
--
ALTER TABLE `tb_kredit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_log_aktifitas`
--
ALTER TABLE `tb_log_aktifitas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_penjualan`
--
ALTER TABLE `tb_penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `tb_produk`
--
ALTER TABLE `tb_produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `tb_wablas`
--
ALTER TABLE `tb_wablas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_keranjang`
--
ALTER TABLE `tb_keranjang`
  ADD CONSTRAINT `tb_keranjang_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tb_users` (`user_id`),
  ADD CONSTRAINT `tb_keranjang_ibfk_2` FOREIGN KEY (`produk_id`) REFERENCES `tb_produk` (`id`);

--
-- Ketidakleluasaan untuk tabel `tb_penjualan`
--
ALTER TABLE `tb_penjualan`
  ADD CONSTRAINT `tb_penjualan_ibfk_1` FOREIGN KEY (`id_users`) REFERENCES `tb_users` (`user_id`),
  ADD CONSTRAINT `tb_penjualan_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `tb_produk` (`id`);

--
-- Ketidakleluasaan untuk tabel `tb_produk`
--
ALTER TABLE `tb_produk`
  ADD CONSTRAINT `tb_produk_ibfk_1` FOREIGN KEY (`kategori_id`) REFERENCES `tb_kategoriproduk` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
