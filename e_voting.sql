-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 23 Nov 2020 pada 10.47
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.3.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e_voting`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `delete_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `nama`, `email`, `delete_at`) VALUES
('1', 'admin', 'clALBUVendAzBn8MRrfbIw%3D%3D', 'admin', 'admin@gmail.com', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `calon`
--

CREATE TABLE `calon` (
  `id` varchar(50) NOT NULL,
  `nomorurut` int(2) NOT NULL,
  `nama1` varchar(50) NOT NULL,
  `nama2` varchar(50) NOT NULL,
  `visi` varchar(100) NOT NULL,
  `misi` varchar(200) NOT NULL,
  `foto` text NOT NULL,
  `vote` int(11) NOT NULL,
  `delete_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `calon`
--

INSERT INTO `calon` (`id`, `nomorurut`, `nama1`, `nama2`, `visi`, `misi`, `foto`, `vote`, `delete_at`) VALUES
('20201119094635', 1, 'Michael', 'Anantya', 'Google', 'Youtube', '20201119094635.png', 0, NULL),
('20201119094747', 2, 'Rezza Anantya', 'Arya', 'Youtube', 'Google', '20201119094747.jpg', -1, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `operator`
--

CREATE TABLE `operator` (
  `id` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `namapengawas` varchar(255) NOT NULL,
  `level` enum('operator','pengawas') NOT NULL,
  `delete_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `operator`
--

INSERT INTO `operator` (`id`, `username`, `password`, `namapengawas`, `level`, `delete_at`) VALUES
('20201122121916', 'pengawas', '0pNVtQ7aEpYJhtBarMCEVQ%3D%3D', 'Pengawas', 'pengawas', NULL),
('20202020OctOct2020070710105656', 'pegawai', 'INCPPcs9vxBJ9T1FsluRVA%3D%3D', 'Pegawai', 'pengawas', NULL),
('5f28f062871d8', 'operator', 'OkBsgcU6o4Nx037gaP1J5Q%3D%3D', 'Operator', 'operator', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemilih`
--

CREATE TABLE `pemilih` (
  `id` varchar(255) NOT NULL,
  `nim` varchar(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `kelas` varchar(20) NOT NULL,
  `suara` varchar(255) NOT NULL,
  `aktivasi` varchar(255) NOT NULL,
  `delete_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indeks untuk tabel `calon`
--
ALTER TABLE `calon`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `operator`
--
ALTER TABLE `operator`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pemilih`
--
ALTER TABLE `pemilih`
  ADD PRIMARY KEY (`id`),
  ADD KEY `suara` (`suara`,`aktivasi`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
