-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 29 Mar 2022 pada 04.49
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rental_mobil`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_mobil`
--

CREATE TABLE `data_mobil` (
  `id_mobil` int(11) NOT NULL,
  `merek` varchar(100) NOT NULL,
  `no_pol` varchar(100) NOT NULL,
  `biaya` varchar(20) NOT NULL,
  `jumlah_kursi` int(11) NOT NULL,
  `gambar_mobil` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `data_mobil`
--

INSERT INTO `data_mobil` (`id_mobil`, `merek`, `no_pol`, `biaya`, `jumlah_kursi`, `gambar_mobil`, `created_at`, `updated_at`) VALUES
(3, 'XENIA', 'M 87787 DD', '150000', 4, 'default.jpg', '2022-03-09 16:17:25', '2022-03-09 16:17:25'),
(5, 'GRANDMAX', 'M 3532 HD', '200000', 6, '1648387520_339fb9176a24bfbcba55.jpg', NULL, NULL),
(6, 'MOBILIO', 'M 3532 HD', '100000', 6, '1648443186_af15c8dc29bc5850c89f.jpg', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_penyewa`
--

CREATE TABLE `data_penyewa` (
  `id_penyewa` int(11) NOT NULL,
  `nik` int(38) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `jenis_kelamin` varchar(50) NOT NULL,
  `gambar_penyewa` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `data_penyewa`
--

INSERT INTO `data_penyewa` (`id_penyewa`, `nik`, `nama`, `alamat`, `jenis_kelamin`, `gambar_penyewa`, `created_at`, `updated_at`) VALUES
(1, 2147483647, 'deddy armanda', 'pamekasan', 'Laki-laki', '1648465304_b297eed9edd059c9bf9b.jpg', '2022-03-08 12:47:20', '2022-03-08 12:47:20'),
(6, 2147483647, 'andrea dovisioso', 'pamekasan menggungan', 'Laki-laki', 'default.jpg', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal_sewa`
--

CREATE TABLE `jadwal_sewa` (
  `id_jadwal` int(11) NOT NULL,
  `J_penyewaID` int(11) NOT NULL,
  `J_mobilID` int(11) NOT NULL,
  `waktu_boking` time NOT NULL,
  `tutup_boking` time NOT NULL,
  `bayar_dp` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `selesai_sewa`
--

CREATE TABLE `selesai_sewa` (
  `id_selesai` int(11) NOT NULL,
  `S_mobilID` int(11) NOT NULL,
  `S_penyewaID` int(11) NOT NULL,
  `boking_waktu` time NOT NULL,
  `boking_tutup` time NOT NULL,
  `sewa` datetime NOT NULL,
  `kembali` datetime NOT NULL,
  `biaya_sewaMobil` int(11) NOT NULL,
  `total_hariSewa` int(11) NOT NULL,
  `total_biayaSewa` int(11) NOT NULL,
  `terlambat_sewa` int(11) NOT NULL,
  `total_denda` int(11) NOT NULL,
  `total_hariSemua` int(11) NOT NULL,
  `dp` int(11) NOT NULL,
  `total_keseluruhan` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `selesai_sewa`
--

INSERT INTO `selesai_sewa` (`id_selesai`, `S_mobilID`, `S_penyewaID`, `boking_waktu`, `boking_tutup`, `sewa`, `kembali`, `biaya_sewaMobil`, `total_hariSewa`, `total_biayaSewa`, `terlambat_sewa`, `total_denda`, `total_hariSemua`, `dp`, `total_keseluruhan`, `created_at`) VALUES
(2, 3, 1, '18:01:00', '18:03:00', '2022-03-27 00:00:00', '2022-03-29 00:00:00', 150000, 2, 300000, 0, 0, 2, 70000, 230000, '2022-03-28 18:51:50'),
(3, 5, 6, '18:53:00', '18:54:00', '2022-03-28 18:54:00', '2022-03-30 18:54:00', 200000, 2, 400000, 0, 0, 2, 25000, 375000, '2022-03-28 18:54:25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `mobil_id` int(11) NOT NULL,
  `penyewa_id` int(11) NOT NULL,
  `harga` varchar(50) NOT NULL,
  `tanggal_sewa` datetime NOT NULL,
  `tanggal_kembali` datetime NOT NULL,
  `dp_dibayar` int(11) NOT NULL,
  `status_jadwal` varchar(50) NOT NULL,
  `denda` int(11) NOT NULL,
  `terlambat` int(11) NOT NULL,
  `sewa_perhari` int(11) NOT NULL,
  `total_sewa` int(11) NOT NULL,
  `total_hari` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `user_image` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `full_name`, `user_image`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin', 'Imron Rosadi', 'default.jpg', '2022-03-27 12:47:48', '2022-03-27 12:47:48');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `data_mobil`
--
ALTER TABLE `data_mobil`
  ADD PRIMARY KEY (`id_mobil`);

--
-- Indeks untuk tabel `data_penyewa`
--
ALTER TABLE `data_penyewa`
  ADD PRIMARY KEY (`id_penyewa`);

--
-- Indeks untuk tabel `jadwal_sewa`
--
ALTER TABLE `jadwal_sewa`
  ADD PRIMARY KEY (`id_jadwal`);

--
-- Indeks untuk tabel `selesai_sewa`
--
ALTER TABLE `selesai_sewa`
  ADD PRIMARY KEY (`id_selesai`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `data_mobil`
--
ALTER TABLE `data_mobil`
  MODIFY `id_mobil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `data_penyewa`
--
ALTER TABLE `data_penyewa`
  MODIFY `id_penyewa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `jadwal_sewa`
--
ALTER TABLE `jadwal_sewa`
  MODIFY `id_jadwal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `selesai_sewa`
--
ALTER TABLE `selesai_sewa`
  MODIFY `id_selesai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
