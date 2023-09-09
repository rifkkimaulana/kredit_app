-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 09 Sep 2023 pada 20.38
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
  `keterangan` text NOT NULL,
  `slug` text NOT NULL,
  `wablasapi_id` int(11) NOT NULL,
  `googleapi_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_appsetting`
--

INSERT INTO `tb_appsetting` (`id`, `nama_aplikasi`, `nama_perusahaan`, `alamat1`, `alamat2`, `kode_pos`, `email`, `telpon`, `logo`, `bank1`, `bank2`, `bank3`, `atas_nama1`, `atas_nama2`, `atas_nama3`, `no_rekening1`, `no_rekening2`, `no_rekening3`, `keterangan`, `slug`, `wablasapi_id`, `googleapi_id`) VALUES
(1, 'KREDIT APP', 'CV. MITRA MANDIRI SKM', 'Darmaraja', 'Sumedang', '45372', 'rifkkimaulana@gmail.com', '083130649979', '1693495288_f60c98d12ef86f8e8c24.png', 'Bank Mandiri', 'Bank Mandiri', 'LINK AJA', 'RIFKI MAULANA', 'RUKMANA', 'RIFKI MAULANA', '1310016635064', '1310016161319', '083130649979', 'Aplikasi Kredit Barang', 'ka-dashboard', 1, 1);

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
-- Struktur dari tabel `tb_identitas`
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
-- Dumping data untuk tabel `tb_identitas`
--

INSERT INTO `tb_identitas` (`id`, `user_id`, `nama_lengkap`, `nomor_identitas`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `alamat`, `agama`, `status_pernikahan`, `pekerjaan`, `foto_identitas`, `foto_selvi_ktp`, `status`, `created_at`, `updated_at`, `nomor_alternatif_1`, `nama_alternatif_1`) VALUES
(8, 16, 'Dian Witura', '3211030313210032', 'Sumedang', '1997-02-09', 'Laki-laki', 'Sumedang', 'Islam', 'Cerai', 'Wiraswasta', 'ktp_1694089038_d8e94dff168c31aa4d80.jpg', 'selvi_1694089038_6023125f53c02bf7c30c.jpg', 'Disetujui', '2023-09-07 12:16:30', '2023-09-07 12:17:41', '-', '-');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_ims_customer`
--

CREATE TABLE `tb_ims_customer` (
  `id` int(11) NOT NULL,
  `id_pelanggan` varchar(255) NOT NULL,
  `nama_pelanggan` varchar(255) NOT NULL,
  `alamat` text,
  `telpon` varchar(20) DEFAULT NULL,
  `latitude` varchar(100) DEFAULT NULL,
  `longitude` varchar(100) DEFAULT NULL,
  `status` int(11) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_ims_customer`
--

INSERT INTO `tb_ims_customer` (`id`, `id_pelanggan`, `nama_pelanggan`, `alamat`, `telpon`, `latitude`, `longitude`, `status`, `created_at`, `updated_at`) VALUES
(2, '123455qasdf', 'kiki', 'sumednag', '081231234124', '2134234', '34235345', 0, '2023-09-09 18:33:01', '2023-09-09 18:37:24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_im_inventori`
--

CREATE TABLE `tb_im_inventori` (
  `id` int(11) NOT NULL,
  `location_id` int(11) DEFAULT NULL,
  `suppliers_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `categories_id` int(11) DEFAULT NULL,
  `nama_barang` varchar(255) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  `satuan` varchar(50) DEFAULT NULL,
  `harga_satuan` varchar(200) DEFAULT NULL,
  `keterangan` text,
  `foto` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_im_inventori`
--

INSERT INTO `tb_im_inventori` (`id`, `location_id`, `suppliers_id`, `customer_id`, `categories_id`, `nama_barang`, `stok`, `satuan`, `harga_satuan`, `keterangan`, `foto`, `created_at`, `updated_at`) VALUES
(4, 2, NULL, NULL, 4, 'asdf', 3, 'bh', '33333.00', '', '1694258420_3c8780f7299a92acd4fc.jpg', '2023-09-09 11:20:20', '2023-09-09 11:20:20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_im_inv_categories`
--

CREATE TABLE `tb_im_inv_categories` (
  `id` int(11) NOT NULL,
  `nama_kategori` varchar(255) DEFAULT NULL,
  `keterangan` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_im_inv_categories`
--

INSERT INTO `tb_im_inv_categories` (`id`, `nama_kategori`, `keterangan`, `created_at`, `updated_at`) VALUES
(4, 'as', 'dff435', '2023-09-09 09:59:49', '2023-09-09 10:03:39');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_im_inv_customers`
--

CREATE TABLE `tb_im_inv_customers` (
  `id` int(11) NOT NULL,
  `nama_lengkap` varchar(255) DEFAULT NULL,
  `telpon` varchar(20) DEFAULT NULL,
  `alamat` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_im_inv_customers`
--

INSERT INTO `tb_im_inv_customers` (`id`, `nama_lengkap`, `telpon`, `alamat`, `created_at`, `updated_at`) VALUES
(5, 'Rifki Maulana', '081231234124', '123', '2023-09-09 10:09:51', '2023-09-09 10:11:02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_im_inv_history`
--

CREATE TABLE `tb_im_inv_history` (
  `id` int(11) NOT NULL,
  `keterangan` text,
  `jenis` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_im_inv_history`
--

INSERT INTO `tb_im_inv_history` (`id`, `keterangan`, `jenis`, `created_at`, `updated_at`) VALUES
(2, 'tanpa keterangan', '23452354324', '2023-09-09 10:13:18', '2023-09-09 10:13:28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_im_inv_location`
--

CREATE TABLE `tb_im_inv_location` (
  `id` int(11) NOT NULL,
  `nama_lokasi` varchar(255) DEFAULT NULL,
  `penanggung_jawab` varchar(255) DEFAULT NULL,
  `telpon` varchar(20) DEFAULT NULL,
  `alamat` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_im_inv_location`
--

INSERT INTO `tb_im_inv_location` (`id`, `nama_lokasi`, `penanggung_jawab`, `telpon`, `alamat`, `created_at`, `updated_at`) VALUES
(2, 'avdfvadfv', 'vsd', '234234', '', '2023-09-09 10:16:07', '2023-09-09 10:16:12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_im_inv_suppliers`
--

CREATE TABLE `tb_im_inv_suppliers` (
  `id` int(11) NOT NULL,
  `nama_lengkap` varchar(255) DEFAULT NULL,
  `telpon` varchar(20) DEFAULT NULL,
  `no_rek` varchar(20) DEFAULT NULL,
  `nama_no_rek` varchar(255) DEFAULT NULL,
  `nama_toko` varchar(255) DEFAULT NULL,
  `alamat` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_im_inv_suppliers`
--

INSERT INTO `tb_im_inv_suppliers` (`id`, `nama_lengkap`, `telpon`, `no_rek`, `nama_no_rek`, `nama_toko`, `alamat`, `created_at`, `updated_at`) VALUES
(2, 'Ikbal', '081231234124', '131241324', 'asfdasdf', '32adsf325sadf', '  sumednagdsssfasdf', '2023-09-09 10:19:02', '2023-09-09 10:26:22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_im_inv_transaction`
--

CREATE TABLE `tb_im_inv_transaction` (
  `id` int(11) NOT NULL,
  `keterangan` text,
  `supliers_id` int(11) DEFAULT NULL,
  `customers_id` int(11) DEFAULT NULL,
  `inventory_id` int(11) DEFAULT NULL,
  `biaya` varchar(100) DEFAULT NULL,
  `jumlah` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_im_inv_transaction`
--

INSERT INTO `tb_im_inv_transaction` (`id`, `keterangan`, `supliers_id`, `customers_id`, `inventory_id`, `biaya`, `jumlah`, `created_at`, `updated_at`) VALUES
(2, 'Pembelian', 2, 5, 4, '30000', 3, '2023-09-09 10:37:01', '2023-09-09 11:51:59');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_im_server`
--

CREATE TABLE `tb_im_server` (
  `id` int(11) NOT NULL,
  `kode_server` varchar(255) DEFAULT NULL,
  `nama_server` varchar(255) DEFAULT NULL,
  `alamat_server` varchar(255) DEFAULT NULL,
  `latitude` varchar(100) DEFAULT NULL,
  `longitude` varchar(100) DEFAULT NULL,
  `pengelola_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_im_srv_pengelola`
--

CREATE TABLE `tb_im_srv_pengelola` (
  `id` int(11) NOT NULL,
  `nama_lengkap` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `telpon` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_im_srv_pengelola`
--

INSERT INTO `tb_im_srv_pengelola` (`id`, `nama_lengkap`, `alamat`, `telpon`, `created_at`, `updated_at`) VALUES
(2, 'Rifki Maulana', 'sumednag', '081231234124', '2023-09-09 17:55:30', '2023-09-09 17:55:30');

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
  `file_kontrak` text NOT NULL,
  `status` varchar(50) NOT NULL,
  `no_transaksi` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `no_kontrak` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(4, 'Rifki Maulana', 'admin', '$2y$10$guzfxMCl3tZSo/Qgfo7OnO05iMmzN7Pfos/xF8TumqhI/qh.zJUma', '1693988547_0078b59238b5f1c15c9f.webp', 'administrator', 'rifkkimaulana@gmail.com', '083130649979', '', 'ecdaa0e0-3e87-4368-be77-92ddd3a57081', '', 1, 'Indonesia', '', '', ''),
(16, 'Dian Witura', 'dian', '$2y$10$MTHn9EWgER0HkqQpxifyYOkMmOYTh7FzE0kgrUNvo6.o7/xp8LsF.', NULL, 'member', '64f9be690a6ac_contoh@emailkamu.com', '082118844992', '', '', '', 1, '', '', '', '');

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
-- Indeks untuk tabel `tb_identitas`
--
ALTER TABLE `tb_identitas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nomor_identitas` (`nomor_identitas`);

--
-- Indeks untuk tabel `tb_ims_customer`
--
ALTER TABLE `tb_ims_customer`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_im_inventori`
--
ALTER TABLE `tb_im_inventori`
  ADD PRIMARY KEY (`id`),
  ADD KEY `location_id` (`location_id`),
  ADD KEY `suppliers_id` (`suppliers_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indeks untuk tabel `tb_im_inv_categories`
--
ALTER TABLE `tb_im_inv_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_im_inv_customers`
--
ALTER TABLE `tb_im_inv_customers`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_im_inv_history`
--
ALTER TABLE `tb_im_inv_history`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_im_inv_location`
--
ALTER TABLE `tb_im_inv_location`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_im_inv_suppliers`
--
ALTER TABLE `tb_im_inv_suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_im_inv_transaction`
--
ALTER TABLE `tb_im_inv_transaction`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supliers_id` (`supliers_id`),
  ADD KEY `customers_id` (`customers_id`),
  ADD KEY `inventory_id` (`inventory_id`);

--
-- Indeks untuk tabel `tb_im_server`
--
ALTER TABLE `tb_im_server`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tb_im_server_pengelola` (`pengelola_id`);

--
-- Indeks untuk tabel `tb_im_srv_pengelola`
--
ALTER TABLE `tb_im_srv_pengelola`
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
-- AUTO_INCREMENT untuk tabel `tb_identitas`
--
ALTER TABLE `tb_identitas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tb_ims_customer`
--
ALTER TABLE `tb_ims_customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_im_inventori`
--
ALTER TABLE `tb_im_inventori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_im_inv_categories`
--
ALTER TABLE `tb_im_inv_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_im_inv_customers`
--
ALTER TABLE `tb_im_inv_customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tb_im_inv_history`
--
ALTER TABLE `tb_im_inv_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_im_inv_location`
--
ALTER TABLE `tb_im_inv_location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_im_inv_suppliers`
--
ALTER TABLE `tb_im_inv_suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_im_inv_transaction`
--
ALTER TABLE `tb_im_inv_transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_im_server`
--
ALTER TABLE `tb_im_server`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_im_srv_pengelola`
--
ALTER TABLE `tb_im_srv_pengelola`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_kategoriproduk`
--
ALTER TABLE `tb_kategoriproduk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_keranjang`
--
ALTER TABLE `tb_keranjang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_kredit`
--
ALTER TABLE `tb_kredit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_log_aktifitas`
--
ALTER TABLE `tb_log_aktifitas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_penjualan`
--
ALTER TABLE `tb_penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_produk`
--
ALTER TABLE `tb_produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `tb_wablas`
--
ALTER TABLE `tb_wablas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_im_inventori`
--
ALTER TABLE `tb_im_inventori`
  ADD CONSTRAINT `tb_im_inventori_ibfk_1` FOREIGN KEY (`location_id`) REFERENCES `tb_im_inv_location` (`id`),
  ADD CONSTRAINT `tb_im_inventori_ibfk_2` FOREIGN KEY (`suppliers_id`) REFERENCES `tb_im_inv_suppliers` (`id`),
  ADD CONSTRAINT `tb_im_inventori_ibfk_3` FOREIGN KEY (`customer_id`) REFERENCES `tb_im_inv_customers` (`id`);

--
-- Ketidakleluasaan untuk tabel `tb_im_inv_transaction`
--
ALTER TABLE `tb_im_inv_transaction`
  ADD CONSTRAINT `tb_im_inv_transaction_ibfk_1` FOREIGN KEY (`supliers_id`) REFERENCES `tb_im_inv_suppliers` (`id`),
  ADD CONSTRAINT `tb_im_inv_transaction_ibfk_2` FOREIGN KEY (`customers_id`) REFERENCES `tb_im_inv_customers` (`id`),
  ADD CONSTRAINT `tb_im_inv_transaction_ibfk_3` FOREIGN KEY (`supliers_id`) REFERENCES `tb_im_inv_suppliers` (`id`),
  ADD CONSTRAINT `tb_im_inv_transaction_ibfk_4` FOREIGN KEY (`customers_id`) REFERENCES `tb_im_inv_customers` (`id`),
  ADD CONSTRAINT `tb_im_inv_transaction_ibfk_5` FOREIGN KEY (`inventory_id`) REFERENCES `tb_im_inventori` (`id`);

--
-- Ketidakleluasaan untuk tabel `tb_im_server`
--
ALTER TABLE `tb_im_server`
  ADD CONSTRAINT `fk_tb_im_server_pengelola` FOREIGN KEY (`pengelola_id`) REFERENCES `tb_im_srv_pengelola` (`id`);

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
