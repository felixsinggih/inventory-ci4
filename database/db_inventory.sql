-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 28 Jun 2021 pada 04.14
-- Versi server: 10.4.6-MariaDB
-- Versi PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_inventory`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id_barang` varchar(11) NOT NULL,
  `nm_barang` varchar(250) NOT NULL,
  `spek` text NOT NULL,
  `satuan` varchar(10) NOT NULL,
  `stok` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id_barang`, `nm_barang`, `spek`, `satuan`, `stok`, `created_at`, `updated_at`) VALUES
('B-210627001', 'Router TP-Link Archer AX73', 'Wi-Fi 6\r\nIEEE 802.11ax/ac/n/a 5 GHz\r\nIEEE 802.11ax/n/b/g 2.4 GHz', 'Unit', 5, '2021-06-27 20:30:32', '2021-06-27 20:56:54'),
('B-210627002', 'Switch TP-Link LS105G', '5× Gigabit RJ45 Ports', 'Unit', 3, '2021-06-27 20:35:54', '2021-06-27 21:00:57'),
('B-210627003', 'PC A', 'Proc Intel i3\r\nRAM 4Gb', 'Unit', 4, '2021-06-27 20:47:36', '2021-06-27 21:02:33'),
('B-210627004', 'PC B', 'Proc Intel i5\r\nRAM 8Gb', 'Unit', 2, '2021-06-27 20:55:08', '2021-06-27 20:58:34'),
('B-210627005', 'Epson Printer L3110 Print Scan Copy - Hitam', '-Ukuran kertas : max A4 (copy, scan), up to quarto (print)\r\n-Maximum resolution print : 5760 x 1440 dpi\r\n-Maximum resolution scan : 600 x 1200 dpi\r\n-Maximum resolution copy : 300 x 300 dpi\r\n-konektivitas : USB.2-kapasitas kertas : 100 sheet\r\n-kecepatan print : 5760 x 1440 dpi', 'Unit', 1, '2021-06-27 21:11:16', '2021-06-27 21:13:25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `keluar`
--

CREATE TABLE `keluar` (
  `id_keluar` varchar(12) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` text NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `keluar`
--

INSERT INTO `keluar` (`id_keluar`, `tanggal`, `keterangan`, `created_at`, `updated_at`) VALUES
('BK-210603001', '2021-06-03', 'Bagian Keuangan', '2021-06-27 20:57:54', '2021-06-27 20:57:54'),
('BK-210604001', '2021-06-04', 'Bagian Kepegawaian', '2021-06-27 20:58:34', '2021-06-27 20:58:34'),
('BK-210616001', '2021-06-16', 'Bagian Kemahasiswaan', '2021-06-27 21:00:57', '2021-06-27 21:00:57'),
('BK-210623001', '2021-06-23', '', '2021-06-27 21:13:25', '2021-06-27 21:13:25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `keluar_detail`
--

CREATE TABLE `keluar_detail` (
  `id_keluar` varchar(12) NOT NULL,
  `id_barang` varchar(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `spek` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `keluar_detail`
--

INSERT INTO `keluar_detail` (`id_keluar`, `id_barang`, `jumlah`, `spek`) VALUES
('BK-210603001', 'B-210627002', 1, '5× Gigabit RJ45 Ports'),
('BK-210603001', 'B-210627003', 1, 'Proc Intel i3\r\nRAM 4Gb'),
('BK-210604001', 'B-210627004', 1, 'Proc Intel i5\r\nRAM 8Gb'),
('BK-210616001', 'B-210627002', 1, '5× Gigabit RJ45 Ports'),
('BK-210616001', 'B-210627003', 1, 'Proc Intel i3\r\nRAM 4Gb'),
('BK-210623001', 'B-210627005', 1, '-Ukuran kertas : max A4 (copy, scan), up to quarto (print)\r\n-Maximum resolution print : 5760 x 1440 dpi\r\n-Maximum resolution scan : 600 x 1200 dpi\r\n-Maximum resolution copy : 300 x 300 dpi\r\n-konektivitas : USB.2-kapasitas kertas : 100 sheet\r\n-kecepatan print : 5760 x 1440 dpi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `suplai`
--

CREATE TABLE `suplai` (
  `id_suplai` varchar(12) NOT NULL,
  `penyuplai` varchar(250) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` text NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `suplai`
--

INSERT INTO `suplai` (`id_suplai`, `penyuplai`, `tanggal`, `keterangan`, `created_at`, `updated_at`) VALUES
('BM-210601001', 'Stok Awal', '2021-06-01', 'Stok awal', '2021-06-27 20:56:54', '2021-06-27 20:56:54'),
('BM-210617001', 'Bagian Pengadaan Barang', '2021-06-17', '', '2021-06-27 21:12:04', '2021-06-27 21:12:04'),
('BM-210621001', 'Bagian Pengadaan Barang', '2021-06-21', 'Restock', '2021-06-27 21:02:33', '2021-06-27 21:02:33');

-- --------------------------------------------------------

--
-- Struktur dari tabel `suplai_detail`
--

CREATE TABLE `suplai_detail` (
  `id_suplai` varchar(12) NOT NULL,
  `id_barang` varchar(11) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `suplai_detail`
--

INSERT INTO `suplai_detail` (`id_suplai`, `id_barang`, `jumlah`) VALUES
('BM-210601001', 'B-210627001', 5),
('BM-210601001', 'B-210627003', 4),
('BM-210601001', 'B-210627004', 3),
('BM-210601001', 'B-210627002', 5),
('BM-210621001', 'B-210627003', 2),
('BM-210617001', 'B-210627005', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` varchar(5) NOT NULL,
  `nm_user` varchar(150) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `nm_user`, `username`, `password`, `level`, `status`, `created_at`, `updated_at`) VALUES
('AD001', 'Joko', 'admin', '$2y$10$Pf9g0gHgBXiTOoXvTVNTCuijDlpBbD6oWqIkgTUkcjUgAqDvpfR1W', 'Admin', 'Aktif', '2021-06-27 19:22:00', '2021-06-27 20:25:23'),
('AD002', 'Abang Roni', 'roni', '$2y$10$hwGAJTiW1KOE4llHt44zGuilh2MEy/suq3ld1RBTJSyFD.z7rGRfC', 'Operator', 'Non Aktif', '2021-06-27 20:27:38', '2021-06-27 20:27:38');

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `vhistory`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `vhistory` (
`id_barang` varchar(11)
,`nm_barang` varchar(250)
,`jumlah` int(11)
,`id` varchar(12)
,`satuan` varchar(10)
,`created_at` datetime
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `web`
--

CREATE TABLE `web` (
  `id_web` int(1) NOT NULL,
  `nm_web` varchar(250) NOT NULL,
  `alamat` text NOT NULL,
  `email` varchar(250) NOT NULL,
  `telp` varchar(15) NOT NULL,
  `min_stok` tinyint(4) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `web`
--

INSERT INTO `web` (`id_web`, `nm_web`, `alamat`, `email`, `telp`, `min_stok`, `created_at`, `updated_at`) VALUES
(1, 'InventoryKu', 'Jl. Gatot Subroto, Gunungsimping, Kec. Cilacap Tengah, Kabupaten Cilacap, Jawa Tengah', 'inventoryku@gmail.com', '085123456789', 3, '2021-06-22 22:44:00', '2021-06-27 20:27:16');

-- --------------------------------------------------------

--
-- Struktur untuk view `vhistory`
--
DROP TABLE IF EXISTS `vhistory`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vhistory`  AS  (select `barang`.`id_barang` AS `id_barang`,`barang`.`nm_barang` AS `nm_barang`,`suplai_detail`.`jumlah` AS `jumlah`,`suplai`.`id_suplai` AS `id`,`barang`.`satuan` AS `satuan`,`suplai`.`created_at` AS `created_at` from ((`suplai` join `suplai_detail`) join `barang`) where `suplai`.`id_suplai` = `suplai_detail`.`id_suplai` and `suplai_detail`.`id_barang` = `barang`.`id_barang`) union (select `barang`.`id_barang` AS `id_barang`,`barang`.`nm_barang` AS `nm_barang`,`keluar_detail`.`jumlah` AS `jumlah`,`keluar`.`id_keluar` AS `id`,`barang`.`satuan` AS `satuan`,`keluar`.`created_at` AS `created_at` from ((`keluar` join `keluar_detail`) join `barang`) where `keluar`.`id_keluar` = `keluar_detail`.`id_keluar` and `keluar_detail`.`id_barang` = `barang`.`id_barang`) ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indeks untuk tabel `keluar`
--
ALTER TABLE `keluar`
  ADD PRIMARY KEY (`id_keluar`);

--
-- Indeks untuk tabel `keluar_detail`
--
ALTER TABLE `keluar_detail`
  ADD KEY `id_keluar` (`id_keluar`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indeks untuk tabel `suplai`
--
ALTER TABLE `suplai`
  ADD PRIMARY KEY (`id_suplai`);

--
-- Indeks untuk tabel `suplai_detail`
--
ALTER TABLE `suplai_detail`
  ADD KEY `id_suplai` (`id_suplai`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- Indeks untuk tabel `web`
--
ALTER TABLE `web`
  ADD PRIMARY KEY (`id_web`);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `keluar_detail`
--
ALTER TABLE `keluar_detail`
  ADD CONSTRAINT `keluar_detail_ibfk_1` FOREIGN KEY (`id_keluar`) REFERENCES `keluar` (`id_keluar`),
  ADD CONSTRAINT `keluar_detail_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`);

--
-- Ketidakleluasaan untuk tabel `suplai_detail`
--
ALTER TABLE `suplai_detail`
  ADD CONSTRAINT `suplai_detail_ibfk_1` FOREIGN KEY (`id_suplai`) REFERENCES `suplai` (`id_suplai`),
  ADD CONSTRAINT `suplai_detail_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
