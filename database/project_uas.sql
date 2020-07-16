-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Jul 2020 pada 11.48
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_uas`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_alokasi`
--

CREATE TABLE `jenis_alokasi` (
  `id_jenis` int(10) NOT NULL,
  `jenis_alokasi` varchar(70) NOT NULL,
  `harga` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jenis_alokasi`
--

INSERT INTO `jenis_alokasi` (`id_jenis`, `jenis_alokasi`, `harga`) VALUES
(1, 'Alat Pelindung Diri', 150000),
(2, 'Logistik Mahasiswa', 75000),
(3, 'Bantuan kuota Mahasiswa', 50000),
(4, 'Hand Sanitizer', 20000),
(5, 'Sembako masyarakat', 100000),
(7, 'Masker N95', 500000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(10) NOT NULL,
  `no_nota` varchar(10) NOT NULL,
  `id_jenis` int(10) NOT NULL,
  `jumlah_transaksi` int(20) NOT NULL,
  `bayar` int(10) NOT NULL,
  `kembali` int(10) NOT NULL,
  `jumlah_dana` int(20) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `no_hp` varchar(17) NOT NULL,
  `email` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `id_user` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `no_nota`, `id_jenis`, `jumlah_transaksi`, `bayar`, `kembali`, `jumlah_dana`, `nama`, `no_hp`, `email`, `tanggal`, `id_user`) VALUES
(65, 'C001', 150000, 2, 500000, 200000, 300000, 'Rizky Ardiansyah', '085721243456', 'rizky@mail.com', '2020-07-15', 1),
(66, 'C002', 50000, 5, 255000, 5000, 250000, 'Rizky Fajar', '085721243488', 'rizkyfajar@mail.com', '2020-07-15', 1),
(67, 'C003', 75000, 5, 375000, 0, 375000, 'Ibnu Kurniawan', '085789219012', 'ibnukurniawan12@gmail.com', '2020-07-16', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` tinyint(2) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(35) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(150) NOT NULL,
  `hp` varchar(20) NOT NULL,
  `level` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama`, `alamat`, `hp`, `level`) VALUES
(1, 'rivaldo', '99e22263c8ec1baf849abc7c70b080ee', 'Rivaldo Galuh Prihandono', 'Jln. Siliwangi Pondok Benda Pamulang Tangsel', '085710158090', 1),
(12, 'rizkyfajar', '3f8afa119a51363baea7cfc88bc22783', 'Rizky Fajar', 'Pondok Cabe Tiga', '081234567999', 2),
(23, 'rudi', 'bfcd3eee9746714ca4fcba684344bbc0', 'rudi', 'Jl. Mawar III, RT.9/RW.5, Bintaro, Kec. Pesanggrahan', '081234567891', 1),
(24, 'riad', '100321a39a313816638e8e64e670ee37', 'Riad Pandega', 'Ciputat Tangerang Selatan', '081234567892', 2),
(25, 'rizkyard', '3f8afa119a51363baea7cfc88bc22783', 'Rizky Ardiansah', 'Cipondoh Tangerang', '081234567893', 2);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `jenis_alokasi`
--
ALTER TABLE `jenis_alokasi`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_jenis` (`id_jenis`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `jenis_alokasi`
--
ALTER TABLE `jenis_alokasi`
  MODIFY `id_jenis` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` tinyint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
