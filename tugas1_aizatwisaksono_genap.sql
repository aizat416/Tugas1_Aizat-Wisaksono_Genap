-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Bulan Mei 2022 pada 06.09
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tugas1_aizatwisaksono_genap`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_album`
--

CREATE TABLE `tb_album` (
  `alb_id` int(11) NOT NULL,
  `alb_id_artist` int(11) NOT NULL,
  `alb_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_album`
--

INSERT INTO `tb_album` (`alb_id`, `alb_id_artist`, `alb_name`) VALUES
(1, 0, 'Ada apa dengan cinta'),
(2, 0, 'Bintang di surga'),
(9, 0, 'serba salah');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_artist`
--

CREATE TABLE `tb_artist` (
  `art_id` int(11) NOT NULL,
  `art_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_artist`
--

INSERT INTO `tb_artist` (`art_id`, `art_name`) VALUES
(1, 'Melly Goeslaw'),
(7, 'Nazril Irham'),
(8, 'Melly Goeslaw'),
(10, 'Raisa Andriana');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_played`
--

CREATE TABLE `tb_played` (
  `ply_id` int(11) NOT NULL,
  `ply_id_track` int(11) NOT NULL,
  `ply_played` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_played`
--

INSERT INTO `tb_played` (`ply_id`, `ply_id_track`, `ply_played`) VALUES
(1, 1, '2022-05-01 01:23:41'),
(3, 3, '2022-05-01 01:23:49'),
(5, 5, '2022-05-01 01:23:55'),
(7, 7, '2022-05-01 01:24:01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_track`
--

CREATE TABLE `tb_track` (
  `trc_id` int(11) NOT NULL,
  `trc_name` varchar(100) NOT NULL,
  `trc_id_album` int(11) NOT NULL,
  `time` decimal(4,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_track`
--

INSERT INTO `tb_track` (`trc_id`, `trc_name`, `trc_id_album`, `time`) VALUES
(6, 'Dangdut', 5, '3'),
(7, 'Song', 2, '5'),
(8, 'Melody', 1, '2'),
(9, 'Action', 4, '4');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_album`
--
ALTER TABLE `tb_album`
  ADD PRIMARY KEY (`alb_id`);

--
-- Indeks untuk tabel `tb_artist`
--
ALTER TABLE `tb_artist`
  ADD PRIMARY KEY (`art_id`);

--
-- Indeks untuk tabel `tb_played`
--
ALTER TABLE `tb_played`
  ADD PRIMARY KEY (`ply_id`);

--
-- Indeks untuk tabel `tb_track`
--
ALTER TABLE `tb_track`
  ADD PRIMARY KEY (`trc_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_album`
--
ALTER TABLE `tb_album`
  MODIFY `alb_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tb_artist`
--
ALTER TABLE `tb_artist`
  MODIFY `art_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `tb_played`
--
ALTER TABLE `tb_played`
  MODIFY `ply_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `tb_track`
--
ALTER TABLE `tb_track`
  MODIFY `trc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
