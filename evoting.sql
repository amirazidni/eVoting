-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 12 Agu 2020 pada 03.15
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
-- Database: `evoting`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` int(10) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `nama`, `email`) VALUES
(1, 'admin', '90b9aa7e25f80cf4f64e990b78a9fc5ebd6cecad', 'Mimi', 'mimin@mail.com'),
(2, 'admin2', '90b9aa7e25f80cf4f64e990b78a9fc5ebd6cecad', 'Siapa', 'Siapa@mail.com');

-- --------------------------------------------------------

--
-- Struktur dari tabel `calon`
--

CREATE TABLE `calon` (
  `id` int(10) NOT NULL,
  `nomor_urut` int(2) NOT NULL,
  `nama1` varchar(255) NOT NULL,
  `nama2` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `visi_misi` text NOT NULL,
  `vote` int(10) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `calon`
--

INSERT INTO `calon` (`id`, `nomor_urut`, `nama1`, `nama2`, `foto`, `visi_misi`, `vote`) VALUES
(1, 1, 'Dino', 'Laela', 'calon-a.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 1),
(2, 2, 'Weldan', 'Mantio', 'calon-b.png', 'Sukses Spirit Kreatif', 3),
(6, 3, 'Santoso', 'Santi', 'calon-suroso-calon-santoso-los dol.png', 'INTINYA BEGITU', 2),
(7, 4, 'Hue', 'Hiya', 'calon-hue-penguins.jpg', 'Mamama', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemilih`
--

CREATE TABLE `pemilih` (
  `id` int(10) NOT NULL,
  `nim` varchar(20) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `kelas` varchar(7) NOT NULL,
  `nomor_urut` int(2) NOT NULL,
  `status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pemilih`
--

INSERT INTO `pemilih` (`id`, `nim`, `nama`, `kelas`, `nomor_urut`, `status`) VALUES
(1, '18110224', 'Zidni', 'IF 18 E', 0, 1),
(2, '18110223', 'Fauzi', 'IF 18 E', 0, 1),
(3, '18110244', 'Ali', 'IF 18 E', 0, 1),
(4, '18110253', 'Tegar', 'IF 18 E', 3, 1),
(11, '0220', 'Nagita', 'IF 18 E', 0, 1),
(12, '0218', 'Vania', 'IF 18 E', 0, 1),
(15, '18110239', 'Jali', 'IF 18 E', 0, 0),
(16, '18110007', 'Reska', 'IF 18 E', 0, 0),
(17, '18120001', 'Agus', 'SI 18 D', 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pilihan`
--

CREATE TABLE `pilihan` (
  `id` int(10) NOT NULL,
  `nim` varchar(20) NOT NULL,
  `nomor_urut` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pilihan`
--

INSERT INTO `pilihan` (`id`, `nim`, `nomor_urut`) VALUES
(1, '18110224', 1),
(2, '18110244', 2),
(3, '18110223', 2),
(4, '1822', 3),
(5, '18110007', 3),
(7, '18110253', 3);

--
-- Trigger `pilihan`
--
DELIMITER $$
CREATE TRIGGER `nomor_urut` AFTER INSERT ON `pilihan` FOR EACH ROW BEGIN
 UPDATE pemilih SET nomor_urut=nomor_urut+NEW.nomor_urut
 WHERE nim=NEW.nim;
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `calon`
--
ALTER TABLE `calon`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pemilih`
--
ALTER TABLE `pemilih`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pilihan`
--
ALTER TABLE `pilihan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `calon`
--
ALTER TABLE `calon`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `pemilih`
--
ALTER TABLE `pemilih`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `pilihan`
--
ALTER TABLE `pilihan`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
