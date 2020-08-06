-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Agu 2020 pada 15.21
-- Versi server: 10.1.36-MariaDB
-- Versi PHP: 7.2.10

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
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `nama`, `email`) VALUES
('1', 'admin', 'admin', 'admin', 'admin@gmail.com');

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
  `foto` varchar(50) NOT NULL,
  `vote` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `calon`
--

INSERT INTO `calon` (`id`, `nomorurut`, `nama1`, `nama2`, `visi`, `misi`, `foto`, `vote`) VALUES
('5f29607d9ad27', 1, 'Sukni', 'Sultan', 'Axis', 'Internet Murah', '5f29607d9ad27.jpg', 1),
('5f296095633ef', 2, 'Wahyu', 'Aldi', 'Berani', 'Jadi macan', '5f296095633ef.jpg', 0),
('5f2960c70a56e', 3, 'Ujang', 'Cecep', 'Jadi Pimpinan Sunda Empire', 'Kuasai Prindavan', '5f2960c70a56e.jpg', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `operator`
--

CREATE TABLE `operator` (
  `id` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `namapengawas` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `operator`
--

INSERT INTO `operator` (`id`, `username`, `password`, `namapengawas`) VALUES
('5f28f062871d8', 'operator', 'operator', 'operator');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemilih`
--

CREATE TABLE `pemilih` (
  `id` varchar(255) NOT NULL,
  `nim` varchar(11) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `kelas` varchar(20) NOT NULL,
  `suara` varchar(255) NOT NULL,
  `aktivasi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pemilih`
--

INSERT INTO `pemilih` (`id`, `nim`, `password`, `nama`, `kelas`, `suara`, `aktivasi`) VALUES
('5f2938c7142e2', '18.11.0224', 'a9ea96e1d699281472715bfdb86a06ad', 'Zidni', 'IF18E', '0', '5f2938c7142e2'),
('5f2938f46810b', '18.11.0244', '86318e52f5ed4801abe1d13d509443de', 'Ali', 'IF18E', '0', '5f2938f46810b'),
('5f29390d0549a', '18.11.0253', '1d31802d64bae29d88923d795fc73734', 'Tegar', 'IF18E', '5f2927428ab5e', '5f29390d0549a');

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
