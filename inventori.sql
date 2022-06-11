-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 11 Jun 2022 pada 05.51
-- Versi server: 10.4.8-MariaDB
-- Versi PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventori`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_keluar`
--

CREATE TABLE `barang_keluar` (
  `id` int(11) NOT NULL,
  `id_transaksi` varchar(100) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nomor_spk` varchar(100) NOT NULL,
  `jenis_gudang` varchar(100) NOT NULL,
  `tanggal` date NOT NULL,
  `kode_barang` varchar(100) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tujuan` varchar(100) NOT NULL,
  `satuan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_keluar_badstock`
--

CREATE TABLE `barang_keluar_badstock` (
  `id` int(11) NOT NULL,
  `id_transaksi` varchar(100) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nomor_spk` varchar(100) NOT NULL,
  `jenis_gudang` varchar(100) NOT NULL,
  `tanggal` date NOT NULL,
  `kode_barang` varchar(100) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `satuan` varchar(50) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_masuk`
--

CREATE TABLE `barang_masuk` (
  `id` int(11) NOT NULL,
  `id_transaksi` varchar(100) NOT NULL,
  `id_user` int(11) NOT NULL,
  `jenis_gudang` varchar(100) NOT NULL,
  `tanggal` date NOT NULL,
  `kode_barang` varchar(100) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `pengirim` varchar(100) NOT NULL,
  `jumlah` varchar(100) NOT NULL,
  `satuan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `gudang`
--

CREATE TABLE `gudang` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `kode_barang` varchar(100) NOT NULL,
  `jenis_gudang` varchar(100) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `jenis_barang` varchar(100) NOT NULL,
  `jumlah` varchar(250) NOT NULL,
  `satuan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `gudang`
--

INSERT INTO `gudang` (`id`, `id_user`, `kode_barang`, `jenis_gudang`, `nama_barang`, `jenis_barang`, `jumlah`, `satuan`) VALUES
(1, 26, 'BAR-0622001', 'Imarah Printing', 'Indomie Goreng', 'Makanan', '100', 'Pack'),
(2, 26, 'BAR-0622002', 'Imarah Printing', 'Sambal ABC', 'Makanan', '250', 'PCS'),
(3, 26, 'BAR-0622003', 'Imarah Printing', 'Yakult', 'Minuman', '150', 'Pack');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_barang`
--

CREATE TABLE `jenis_barang` (
  `id` int(11) NOT NULL,
  `jenis_barang` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jenis_barang`
--

INSERT INTO `jenis_barang` (`id`, `jenis_barang`) VALUES
(5, 'Makanan'),
(6, 'Minuman'),
(7, 'Obat');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_gudang`
--

CREATE TABLE `jenis_gudang` (
  `id` int(11) NOT NULL,
  `jenis_gudang` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jenis_gudang`
--

INSERT INTO `jenis_gudang` (`id`, `jenis_gudang`) VALUES
(5, 'Imarah Printing');

-- --------------------------------------------------------

--
-- Struktur dari tabel `satuan`
--

CREATE TABLE `satuan` (
  `id` int(11) NOT NULL,
  `satuan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `satuan`
--

INSERT INTO `satuan` (`id`, `satuan`) VALUES
(5, 'Unit'),
(7, 'PCS'),
(8, 'Pack'),
(9, 'Kg'),
(10, 'Butir');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_supplier`
--

CREATE TABLE `tb_supplier` (
  `id` int(100) NOT NULL,
  `kode_supplier` varchar(100) NOT NULL,
  `nama_supplier` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `telepon` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_supplier`
--

INSERT INTO `tb_supplier` (`id`, `kode_supplier`, `nama_supplier`, `alamat`, `telepon`) VALUES
(19, 'SUP-0322002', 'transmart', 'Simpang Sender, Buay Pematang Ribu Ranau Tengah, OKU Selatan', '085841361595'),
(20, 'SUP-0322003', 'indomaret', 'Simpang Sender, Buay Pematang Ribu Ranau Tengah, OKU Selatan', '085841361595'),
(21, 'SUP-0322004', 'supermarket', 'jl srijaya', '123'),
(22, 'SUP-0322005', 'Toko Palembang', 'Simpang Sender, Buay Pematang Ribu Ranau Tengah, OKU Selatan', '085841361595');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nik` varchar(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `telepon` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` varchar(25) NOT NULL DEFAULT 'member',
  `foto` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nik`, `nama`, `alamat`, `telepon`, `username`, `password`, `level`, `foto`) VALUES
(26, '1001', 'Superadmin', '', '08999444000', 'superadmin', '17c4520f6cfd1ab53d8745e84681eb49', 'superadmin', 'teacher4.png'),
(27, '10001', 'admin', '', '0986660000', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'w.jpg'),
(32, '1609054107', 'petugas', '', '12313', 'petugas', 'afb91ef692fd08c445e8cb1bab2ccf9c', 'petugas', 'teacher4.png'),
(33, '123', '123', '', '123', '123', '202cb962ac59075b964b07152d234b70', 'petugas', 'S6.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id_user_access_menu` int(100) NOT NULL,
  `level` varchar(100) NOT NULL,
  `id_menu` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_access_menu`
--

INSERT INTO `user_access_menu` (`id_user_access_menu`, `level`, `id_menu`) VALUES
(1, 'superadmin', 1),
(2, 'superadmin', 2),
(3, 'superadmin', 3),
(4, 'superadmin', 4),
(5, 'superadmin', 5),
(6, 'petugas', 1),
(7, 'petugas', 0),
(8, 'petugas', 3),
(9, 'petugas', 4),
(10, 'petugas', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_access_sub_menu_1`
--

CREATE TABLE `user_access_sub_menu_1` (
  `id_user_access_sub_menu_1` int(11) NOT NULL,
  `level` varchar(100) NOT NULL,
  `id_sub_menu_1` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_access_sub_menu_1`
--

INSERT INTO `user_access_sub_menu_1` (`id_user_access_sub_menu_1`, `level`, `id_sub_menu_1`) VALUES
(1, 'superadmin', 1),
(2, 'superadmin', 2),
(3, 'superadmin', 3),
(4, 'superadmin', 4),
(5, 'superadmin', 5),
(6, 'superadmin', 6),
(7, 'superadmin', 7),
(8, 'superadmin', 8),
(9, 'superadmin', 10),
(10, 'superadmin', 11),
(11, 'superadmin', 12),
(12, 'superadmin', 13),
(13, 'superadmin', 9),
(14, 'petugas', 1),
(15, 'petugas', 2),
(16, 'petugas', 3),
(17, 'petugas', 4),
(18, 'petugas', 5),
(19, 'petugas', 6),
(20, 'petugas', 7),
(21, 'petugas', 8),
(22, 'petugas', 10),
(23, 'petugas', 11),
(24, 'petugas', 12),
(25, 'petugas', 13),
(26, 'petugas', 9);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_access_sub_menu_2`
--

CREATE TABLE `user_access_sub_menu_2` (
  `id_user_access_sub_menu_2` int(100) NOT NULL,
  `level` varchar(100) NOT NULL,
  `id_sub_menu_2` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_access_sub_menu_3`
--

CREATE TABLE `user_access_sub_menu_3` (
  `id_user_access_sub_menu_3` int(100) NOT NULL,
  `level` varchar(100) NOT NULL,
  `id_sub_menu_3` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_level`
--

CREATE TABLE `user_level` (
  `id` int(50) NOT NULL,
  `level` varchar(50) NOT NULL,
  `keterangan` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_level`
--

INSERT INTO `user_level` (`id`, `level`, `keterangan`) VALUES
(1, 'superadmin', 'All Akses');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_menu`
--

CREATE TABLE `user_menu` (
  `id_menu` int(100) NOT NULL,
  `menu` varchar(100) NOT NULL,
  `urutan_menu` int(11) NOT NULL,
  `url` text NOT NULL,
  `id_badge` varchar(100) NOT NULL,
  `use_badge` varchar(20) NOT NULL,
  `icon_1` text NOT NULL,
  `icon_2` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_menu`
--

INSERT INTO `user_menu` (`id_menu`, `menu`, `urutan_menu`, `url`, `id_badge`, `use_badge`, `icon_1`, `icon_2`) VALUES
(1, 'Dashboard', 1, '?page=home&aksi=', '', '', 'fa fa-home', ''),
(2, 'Data Pengguna', 2, '?page=pengguna&aksi=', '', '', 'fa fa-users', ''),
(3, 'Data Master', 3, '', '', '', 'fa fa-database', ''),
(4, 'Transaksi', 4, '', '', '', 'fa fa-comments-dollar', ''),
(5, 'Laporan', 5, '', '', '', 'fa fa-folder', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_sub_menu_1`
--

CREATE TABLE `user_sub_menu_1` (
  `id_sub_menu_1` int(100) NOT NULL,
  `id_menu` int(100) NOT NULL,
  `nama_sub_menu` varchar(128) NOT NULL,
  `urutan_sub_menu_1` int(11) NOT NULL,
  `view_sub_menu_1` varchar(100) NOT NULL,
  `url_sub_menu_1` text NOT NULL,
  `icon` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_sub_menu_1`
--

INSERT INTO `user_sub_menu_1` (`id_sub_menu_1`, `id_menu`, `nama_sub_menu`, `urutan_sub_menu_1`, `view_sub_menu_1`, `url_sub_menu_1`, `icon`) VALUES
(1, 0, 'Jenis Gudang', 1, '', '?page=jenisgudang&aksi=', ''),
(2, 3, 'Jenis Barang', 3, '', '?page=jenisbarang&aksi=', ''),
(3, 3, 'Satuan Barang', 4, '', '?page=satuanbarang&aksi=', ''),
(4, 3, 'Data Supplier', 5, '', '?page=supplier&aksi=', ''),
(5, 4, 'Barang Masuk', 1, '', '?page=barangmasuk&aksi=', ''),
(6, 4, 'Barang Keluar', 2, '', '?page=barangkeluar&aksi=', ''),
(7, 4, 'Bad Stock', 3, '', '?page=barangkeluarbadstock&aksi=', ''),
(8, 3, 'Stok Barang Gudang', 2, '', '?page=gudang&aksi=', ''),
(9, 5, 'Supplier', 1, '', '?page=laporan_supplier&aksi=', ''),
(10, 5, 'Stok Gudang', 2, '', '?page=laporan_gudang&aksi=', ''),
(11, 5, 'Barang Masuk', 3, '', '?page=laporan_barangmasuk&aksi=', ''),
(12, 5, 'Barang Keluar', 4, '', '?page=laporan_barangkeluar&aksi=', ''),
(13, 5, 'Bad Stock', 5, '', '?page=laporan_barangkeluarbadstock&aksi=', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_sub_menu_2`
--

CREATE TABLE `user_sub_menu_2` (
  `id_sub_menu_2` int(100) NOT NULL,
  `id_sub_menu_1` int(100) NOT NULL,
  `nama_sub_menu` varchar(100) NOT NULL,
  `url` text NOT NULL,
  `icon` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_sub_menu_3`
--

CREATE TABLE `user_sub_menu_3` (
  `id_sub_menu_3` int(100) NOT NULL,
  `id_sub_menu_2` int(100) NOT NULL,
  `nama_sub_menu` varchar(100) NOT NULL,
  `url` text NOT NULL,
  `icon` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kode_barang` (`kode_barang`);

--
-- Indeks untuk tabel `barang_keluar_badstock`
--
ALTER TABLE `barang_keluar_badstock`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kode_barang` (`kode_barang`);

--
-- Indeks untuk tabel `gudang`
--
ALTER TABLE `gudang`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_barang` (`kode_barang`);

--
-- Indeks untuk tabel `jenis_barang`
--
ALTER TABLE `jenis_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jenis_gudang`
--
ALTER TABLE `jenis_gudang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `satuan`
--
ALTER TABLE `satuan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_supplier`
--
ALTER TABLE `tb_supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id_user_access_menu`),
  ADD KEY `Cn_menu` (`id_menu`),
  ADD KEY `Cn_level` (`level`);

--
-- Indeks untuk tabel `user_access_sub_menu_1`
--
ALTER TABLE `user_access_sub_menu_1`
  ADD PRIMARY KEY (`id_user_access_sub_menu_1`),
  ADD KEY `Cn_sub_menu_1` (`id_sub_menu_1`) USING BTREE,
  ADD KEY `Cn_level` (`level`);

--
-- Indeks untuk tabel `user_access_sub_menu_2`
--
ALTER TABLE `user_access_sub_menu_2`
  ADD PRIMARY KEY (`id_user_access_sub_menu_2`),
  ADD KEY `Cn_sub_menu_2` (`id_sub_menu_2`) USING BTREE,
  ADD KEY `Cn_level` (`level`);

--
-- Indeks untuk tabel `user_access_sub_menu_3`
--
ALTER TABLE `user_access_sub_menu_3`
  ADD PRIMARY KEY (`id_user_access_sub_menu_3`),
  ADD KEY `Cn_level` (`level`) USING BTREE,
  ADD KEY `Cn_sub_menu_3` (`id_sub_menu_3`);

--
-- Indeks untuk tabel `user_level`
--
ALTER TABLE `user_level`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indeks untuk tabel `user_sub_menu_1`
--
ALTER TABLE `user_sub_menu_1`
  ADD PRIMARY KEY (`id_sub_menu_1`),
  ADD KEY `Cn_menu` (`id_menu`);

--
-- Indeks untuk tabel `user_sub_menu_2`
--
ALTER TABLE `user_sub_menu_2`
  ADD PRIMARY KEY (`id_sub_menu_2`),
  ADD KEY `Cn_sub_menu_1` (`id_sub_menu_1`) USING BTREE;

--
-- Indeks untuk tabel `user_sub_menu_3`
--
ALTER TABLE `user_sub_menu_3`
  ADD PRIMARY KEY (`id_sub_menu_3`),
  ADD KEY `Cn_sub_menu_2` (`id_sub_menu_2`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang_keluar`
--
ALTER TABLE `barang_keluar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `barang_keluar_badstock`
--
ALTER TABLE `barang_keluar_badstock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `barang_masuk`
--
ALTER TABLE `barang_masuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `gudang`
--
ALTER TABLE `gudang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `jenis_barang`
--
ALTER TABLE `jenis_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `jenis_gudang`
--
ALTER TABLE `jenis_gudang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `satuan`
--
ALTER TABLE `satuan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `tb_supplier`
--
ALTER TABLE `tb_supplier`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id_user_access_menu` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `user_access_sub_menu_1`
--
ALTER TABLE `user_access_sub_menu_1`
  MODIFY `id_user_access_sub_menu_1` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `user_access_sub_menu_2`
--
ALTER TABLE `user_access_sub_menu_2`
  MODIFY `id_user_access_sub_menu_2` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `user_access_sub_menu_3`
--
ALTER TABLE `user_access_sub_menu_3`
  MODIFY `id_user_access_sub_menu_3` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `user_level`
--
ALTER TABLE `user_level`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id_menu` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `user_sub_menu_1`
--
ALTER TABLE `user_sub_menu_1`
  MODIFY `id_sub_menu_1` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `user_sub_menu_2`
--
ALTER TABLE `user_sub_menu_2`
  MODIFY `id_sub_menu_2` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `user_sub_menu_3`
--
ALTER TABLE `user_sub_menu_3`
  MODIFY `id_sub_menu_3` int(100) NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `user_access_sub_menu_1`
--
ALTER TABLE `user_access_sub_menu_1`
  ADD CONSTRAINT `user_access_sub_menu_1_ibfk_1` FOREIGN KEY (`id_sub_menu_1`) REFERENCES `user_sub_menu_1` (`id_sub_menu_1`);

--
-- Ketidakleluasaan untuk tabel `user_access_sub_menu_2`
--
ALTER TABLE `user_access_sub_menu_2`
  ADD CONSTRAINT `user_access_sub_menu_2_ibfk_1` FOREIGN KEY (`id_sub_menu_2`) REFERENCES `user_sub_menu_2` (`id_sub_menu_2`);

--
-- Ketidakleluasaan untuk tabel `user_sub_menu_2`
--
ALTER TABLE `user_sub_menu_2`
  ADD CONSTRAINT `user_sub_menu_2_ibfk_1` FOREIGN KEY (`id_sub_menu_1`) REFERENCES `user_sub_menu_1` (`id_sub_menu_1`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
