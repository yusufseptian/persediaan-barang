-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 28 Jan 2024 pada 03.55
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `persediaan_barang`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `is_barang`
--

CREATE TABLE `is_barang` (
  `id_barang` varchar(7) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `id_jenis` int(11) NOT NULL,
  `id_satuan` int(11) NOT NULL,
  `stok` int(11) NOT NULL DEFAULT 0,
  `safety_stok` int(11) NOT NULL,
  `warning_stok` int(11) NOT NULL DEFAULT 0,
  `penjualan_harian` int(11) NOT NULL DEFAULT 0,
  `created_user` smallint(6) NOT NULL,
  `created_date` timestamp NULL DEFAULT NULL,
  `updated_user` smallint(6) NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_user` int(11) NOT NULL,
  `deleted_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `is_barang`
--

INSERT INTO `is_barang` (`id_barang`, `nama_barang`, `id_jenis`, `id_satuan`, `stok`, `safety_stok`, `warning_stok`, `penjualan_harian`, `created_user`, `created_date`, `updated_user`, `updated_date`, `deleted_user`, `deleted_date`) VALUES
('B000001', 'Aqua AQR D181', 4, 9, 120, 0, 20, 0, 1, '2023-06-27 15:36:13', 1, '2024-01-28 02:38:23', 0, NULL),
('B000002', 'Cosmos 16-SDA 3 in 1', 5, 9, 30, 0, 20, 0, 1, '2023-06-27 15:37:11', 1, '2024-01-28 02:38:29', 0, NULL),
('B000003', 'Cosmos CRJ-3201 Digital', 1, 10, 50, 0, 20, 0, 1, '2023-06-27 15:38:37', 1, '2023-06-27 15:43:29', 0, NULL),
('B000004', 'Miyako WD-189 H', 9, 10, 40, 0, 20, 0, 1, '2023-06-27 15:40:05', 1, '2023-07-05 14:19:24', 0, NULL),
('B000005', 'Panasonic Mesin Cuci Na-w7BBz', 7, 9, 50, 0, 20, 0, 1, '2023-06-27 15:40:46', 1, '2023-06-27 15:44:00', 0, NULL),
('B000006', 'Panasonic TV LED TH 24F305G', 6, 9, 50, 0, 20, 0, 1, '2023-06-27 15:41:42', 1, '2023-06-27 15:44:11', 0, NULL),
('B000007', 'Advance M10BT', 2, 10, 10, 0, 20, 0, 1, '2023-06-27 15:42:19', 1, '2023-07-17 03:18:14', 0, NULL),
('B000008', 'Kipas angin', 5, 9, 30, 0, 20, 0, 8, '2023-07-14 06:19:13', 8, '2023-07-14 06:20:13', 0, NULL),
('B000009', 'PMA 9310', 2, 9, 90, 10, 0, 0, 1, '2024-01-26 07:58:08', 1, '2024-01-27 06:21:17', 0, NULL),
('B000010', 'PMA', 2, 9, 100, 12, 0, 0, 1, '2024-01-26 08:04:20', 1, '2024-01-27 06:20:13', 0, NULL),
('B000011', 'Samsung', 6, 9, 100, 10, 0, 0, 1, '2024-01-26 08:11:23', 1, '2024-01-28 02:48:29', 1, '2024-01-28 09:48:29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `is_barang_keluar`
--

CREATE TABLE `is_barang_keluar` (
  `id_barang_keluar` varchar(15) NOT NULL,
  `tanggal_keluar` date NOT NULL,
  `id_barang` varchar(7) NOT NULL,
  `jumlah_keluar` int(11) NOT NULL,
  `status` enum('Proses','Approve','Reject') NOT NULL DEFAULT 'Proses',
  `created_user` smallint(6) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `is_barang_keluar`
--

INSERT INTO `is_barang_keluar` (`id_barang_keluar`, `tanggal_keluar`, `id_barang`, `jumlah_keluar`, `status`, `created_user`, `created_date`) VALUES
('TK-2023-0000001', '2023-06-27', 'B000001', 20, 'Approve', 1, '2023-06-27 15:45:06'),
('TK-2023-0000002', '2023-06-28', 'B000002', 20, 'Approve', 8, '2023-07-05 14:18:38'),
('TK-2023-0000003', '2023-07-05', 'B000004', 10, 'Approve', 8, '2023-07-05 14:19:24'),
('TK-2023-0000004', '2023-07-14', 'B000008', 20, 'Approve', 8, '2023-07-14 06:20:13'),
('TK-2023-0000005', '2023-07-17', 'B000007', 40, 'Approve', 8, '2023-07-17 03:18:14');

-- --------------------------------------------------------

--
-- Struktur dari tabel `is_barang_masuk`
--

CREATE TABLE `is_barang_masuk` (
  `id_barang_masuk` varchar(15) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `id_barang` varchar(7) NOT NULL,
  `jumlah_masuk` int(11) NOT NULL,
  `safety_stok` varchar(100) DEFAULT NULL,
  `created_user` smallint(6) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `is_barang_masuk`
--

INSERT INTO `is_barang_masuk` (`id_barang_masuk`, `tanggal_masuk`, `id_barang`, `jumlah_masuk`, `safety_stok`, `created_user`, `created_date`) VALUES
('TM-2023-0000001', '2023-06-27', 'B000001', 50, '20', 1, '2023-06-27 15:43:01'),
('TM-2023-0000002', '2023-06-27', 'B000002', 50, '20', 1, '2023-06-27 15:43:13'),
('TM-2023-0000003', '2023-06-27', 'B000003', 50, '20', 1, '2023-06-27 15:43:29'),
('TM-2023-0000004', '2023-06-27', 'B000004', 50, '20', 1, '2023-06-27 15:43:45'),
('TM-2023-0000005', '2023-06-27', 'B000005', 50, '20', 1, '2023-06-27 15:44:00'),
('TM-2023-0000006', '2023-06-27', 'B000006', 50, '20', 1, '2023-06-27 15:44:11'),
('TM-2023-0000007', '2023-06-27', 'B000007', 50, '20', 1, '2023-06-27 15:44:26'),
('TM-2023-0000008', '2023-07-14', 'B000008', 50, '20', 8, '2023-07-14 06:19:46'),
('TM-2024-0000009', '2024-01-27', 'B000001', 90, NULL, 1, '2024-01-27 06:08:27'),
('TM-2024-0000010', '2024-01-27', 'B000009', 90, NULL, 1, '2024-01-27 06:12:39'),
('TM-2024-0000011', '2024-01-27', 'B000010', 100, NULL, 1, '2024-01-27 06:20:13'),
('TM-2024-0000012', '2024-01-27', 'B000011', 100, NULL, 1, '2024-01-27 06:20:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `is_jenis_barang`
--

CREATE TABLE `is_jenis_barang` (
  `id_jenis` int(11) NOT NULL,
  `nama_jenis` varchar(50) NOT NULL,
  `created_user` smallint(6) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_user` smallint(6) NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_user` int(11) NOT NULL,
  `deleted_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `is_jenis_barang`
--

INSERT INTO `is_jenis_barang` (`id_jenis`, `nama_jenis`, `created_user`, `created_date`, `updated_user`, `updated_date`, `deleted_user`, `deleted_date`) VALUES
(1, 'Rice Cooker', 3, '2017-03-12 02:59:45', 1, '2023-06-27 15:34:37', 0, NULL),
(2, 'Speaker', 3, '2017-03-12 02:59:58', 1, '2023-06-27 15:33:39', 0, NULL),
(3, 'Kompor Listrik', 3, '2017-03-12 03:00:08', 1, '2023-06-27 15:33:24', 0, NULL),
(4, 'Kulkas', 3, '2017-03-12 03:00:19', 1, '2023-06-27 15:33:06', 0, NULL),
(5, 'Kipas angin', 3, '2017-03-12 03:00:29', 1, '2023-06-27 15:32:55', 0, NULL),
(6, 'Televisi', 3, '2017-03-12 03:00:39', 1, '2023-06-27 15:32:45', 0, NULL),
(7, 'Mesin Cuci', 3, '2017-03-12 03:00:49', 1, '2023-06-27 15:32:34', 0, NULL),
(9, 'Dispenser', 1, '2023-06-27 15:39:33', 1, '2023-06-27 15:39:33', 0, NULL),
(10, 'nganu aja', 1, '2024-01-27 05:47:15', 1, '2024-01-27 09:45:00', 0, '2024-01-01 16:44:56'),
(11, 'nganu hehe', 1, '2024-01-28 02:53:15', 1, '2024-01-28 02:53:34', 1, '2024-01-28 09:53:34');

-- --------------------------------------------------------

--
-- Struktur dari tabel `is_satuan`
--

CREATE TABLE `is_satuan` (
  `id_satuan` int(11) NOT NULL,
  `nama_satuan` varchar(30) NOT NULL,
  `created_user` smallint(6) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_user` smallint(6) NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_user` int(11) NOT NULL,
  `deleted_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `is_satuan`
--

INSERT INTO `is_satuan` (`id_satuan`, `nama_satuan`, `created_user`, `created_date`, `updated_user`, `updated_date`, `deleted_user`, `deleted_date`) VALUES
(1, 'Gram', 3, '2017-03-12 02:57:35', 3, '2017-03-12 02:57:45', 0, NULL),
(2, 'Kilogram', 3, '2017-03-12 02:58:07', 3, '2017-03-12 02:59:01', 0, NULL),
(3, 'Meter', 3, '2017-03-12 02:58:19', 3, '2017-03-12 02:59:04', 0, NULL),
(4, 'Liter', 3, '2017-03-12 02:58:25', 3, '2017-03-12 02:59:08', 0, NULL),
(5, 'Botol', 3, '2017-03-12 02:58:36', 3, '2017-03-12 02:59:10', 0, NULL),
(6, 'Lebar', 3, '2017-03-12 02:58:46', 3, '2017-03-12 02:59:13', 0, NULL),
(7, 'Tabung', 3, '2017-03-12 02:58:52', 1, '2023-03-27 03:24:14', 0, NULL),
(8, 'PCS', 1, '2023-06-27 15:34:56', 1, '2023-06-27 15:34:56', 0, NULL),
(9, 'Unit', 1, '2023-06-27 15:35:05', 1, '2023-06-27 15:35:05', 0, NULL),
(10, 'Buah', 1, '2023-06-27 15:35:13', 1, '2023-06-27 15:35:13', 0, NULL),
(11, 'ekorr', 1, '2024-01-27 05:50:02', 1, '2024-01-28 02:50:29', 1, '2024-01-28 09:50:29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `is_users`
--

CREATE TABLE `is_users` (
  `id_user` smallint(6) NOT NULL,
  `username` varchar(50) NOT NULL,
  `nama_user` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `telepon` varchar(13) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `hak_akses` enum('Super Admin','Manajer','Gudang') NOT NULL,
  `status` enum('aktif','blokir') NOT NULL DEFAULT 'aktif',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `is_users`
--

INSERT INTO `is_users` (`id_user`, `username`, `nama_user`, `password`, `email`, `telepon`, `foto`, `hak_akses`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Brian Musmardiko', '25d55ad283aa400af464c76d713c07ad', '', '', 'indrasatya.jpg', 'Super Admin', 'aktif', '2016-05-01 08:42:53', '2024-01-26 07:24:26'),
(2, 'manajer', 'David Sugiarto', '202cb962ac59075b964b07152d234b70', '', '', 'kadina.png', 'Manajer', 'aktif', '2016-08-01 08:42:53', '2023-07-06 06:41:52'),
(3, 'user', 'Danang Kesuma', '202cb962ac59075b964b07152d234b70', 'danang@gmail.com', '085758858851', '1469574162_users-15.png', 'Gudang', 'aktif', '2017-03-11 14:41:46', '2023-07-06 06:41:22'),
(7, 'manggar', 'Sukma Manggar Suci Putri', '76dc611d6ebaafc66cc0879c71b5db5c', '', '', NULL, 'Super Admin', 'aktif', '2023-03-29 22:50:52', '2023-04-11 14:56:17'),
(8, 'Dika', 'Pradika Teguh Y', '202cb962ac59075b964b07152d234b70', 'Pradika@gmail.com', '08512232342', NULL, 'Super Admin', 'aktif', '2023-06-27 15:49:30', '2023-07-17 03:12:43'),
(9, 'David', 'David Sugiarto', '202cb962ac59075b964b07152d234b70', NULL, NULL, NULL, 'Manajer', 'aktif', '2023-07-06 06:53:14', '2023-07-17 03:13:52'),
(10, 'yudi', 'wahyudi stira', 'd1a6f896a111b237d8ff8dc4ac623809', '', '', 'indrasatya.jpg', 'Manajer', 'aktif', '2024-01-27 06:27:23', '2024-01-27 06:29:45');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `is_barang`
--
ALTER TABLE `is_barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD KEY `id_jenis` (`id_jenis`),
  ADD KEY `id_satuan` (`id_satuan`),
  ADD KEY `created_user` (`created_user`),
  ADD KEY `updated_user` (`updated_user`);

--
-- Indeks untuk tabel `is_barang_keluar`
--
ALTER TABLE `is_barang_keluar`
  ADD PRIMARY KEY (`id_barang_keluar`),
  ADD KEY `id_barang` (`id_barang`),
  ADD KEY `created_user` (`created_user`);

--
-- Indeks untuk tabel `is_barang_masuk`
--
ALTER TABLE `is_barang_masuk`
  ADD PRIMARY KEY (`id_barang_masuk`),
  ADD KEY `id_barang` (`id_barang`),
  ADD KEY `created_user` (`created_user`);

--
-- Indeks untuk tabel `is_jenis_barang`
--
ALTER TABLE `is_jenis_barang`
  ADD PRIMARY KEY (`id_jenis`),
  ADD KEY `created_user` (`created_user`),
  ADD KEY `updated_user` (`updated_user`);

--
-- Indeks untuk tabel `is_satuan`
--
ALTER TABLE `is_satuan`
  ADD PRIMARY KEY (`id_satuan`),
  ADD KEY `created_user` (`created_user`),
  ADD KEY `updated_user` (`updated_user`);

--
-- Indeks untuk tabel `is_users`
--
ALTER TABLE `is_users`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `level` (`hak_akses`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `is_jenis_barang`
--
ALTER TABLE `is_jenis_barang`
  MODIFY `id_jenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `is_satuan`
--
ALTER TABLE `is_satuan`
  MODIFY `id_satuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `is_users`
--
ALTER TABLE `is_users`
  MODIFY `id_user` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `is_barang`
--
ALTER TABLE `is_barang`
  ADD CONSTRAINT `is_barang_ibfk_1` FOREIGN KEY (`created_user`) REFERENCES `is_users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `is_barang_ibfk_2` FOREIGN KEY (`updated_user`) REFERENCES `is_users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `is_barang_ibfk_3` FOREIGN KEY (`id_satuan`) REFERENCES `is_satuan` (`id_satuan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `is_barang_ibfk_4` FOREIGN KEY (`id_jenis`) REFERENCES `is_jenis_barang` (`id_jenis`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `is_barang_keluar`
--
ALTER TABLE `is_barang_keluar`
  ADD CONSTRAINT `is_barang_keluar_ibfk_1` FOREIGN KEY (`created_user`) REFERENCES `is_users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `is_barang_keluar_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `is_barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `is_barang_masuk`
--
ALTER TABLE `is_barang_masuk`
  ADD CONSTRAINT `is_barang_masuk_ibfk_1` FOREIGN KEY (`created_user`) REFERENCES `is_users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `is_barang_masuk_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `is_barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `is_jenis_barang`
--
ALTER TABLE `is_jenis_barang`
  ADD CONSTRAINT `is_jenis_barang_ibfk_1` FOREIGN KEY (`created_user`) REFERENCES `is_users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `is_jenis_barang_ibfk_2` FOREIGN KEY (`updated_user`) REFERENCES `is_users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `is_satuan`
--
ALTER TABLE `is_satuan`
  ADD CONSTRAINT `is_satuan_ibfk_1` FOREIGN KEY (`created_user`) REFERENCES `is_users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `is_satuan_ibfk_2` FOREIGN KEY (`updated_user`) REFERENCES `is_users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
