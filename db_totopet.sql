-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 24 Jul 2023 pada 15.29
-- Versi server: 10.4.25-MariaDB
-- Versi PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_totopet`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `brand`
--

CREATE TABLE `brand` (
  `id` int(11) NOT NULL,
  `img` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `brand`
--

INSERT INTO `brand` (`id`, `img`, `name`) VALUES
(4, 'Wonderfurr.png', 'Wonderfurr'),
(5, 'MimiPetCarrier.png', 'MimiPetCarrier'),
(6, 'Purrfection.png', 'Purrfection'),
(7, 'Felsabd.png', 'Felsand'),
(8, 'LuckyCat.png', 'LuckyCat'),
(10, 'maximum.png', 'Maximum');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id` int(11) NOT NULL,
  `id_transaksi` varchar(10) NOT NULL,
  `id_produk` varchar(10) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `jumlah` varchar(10) NOT NULL,
  `harga` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`id`, `id_transaksi`, `id_produk`, `nama_produk`, `jumlah`, `harga`) VALUES
(1, '1', '25', 'Furrclean 250 mL', '2', '30000'),
(2, '1', '33', 'Pet Cargo S', '2', '19000'),
(3, '1', '31', 'Mimi Petware', '1', '13000'),
(4, '1', '34', 'Pet Cargo M', '1', '30000'),
(5, '2', '25', 'Furrclean 250 mL', '2', '30000'),
(6, '2', '33', 'Pet Cargo S', '2', '19000'),
(7, '2', '31', 'Mimi Petware', '1', '13000'),
(8, '2', '34', 'Pet Cargo M', '1', '30000'),
(9, '3', '29', 'Mimi Pet 1000', '2', '30000'),
(10, '3', '31', 'Mimi Petware', '1', '13000'),
(11, '3', '33', 'Pet Cargo S', '2', '19000'),
(12, '4', '27', 'Purrfection 60 ML', '30', '34000'),
(13, '4', '32', 'Mimi Petware', '4', '30000'),
(14, '4', '15', 'Wonderfurr Cat 400gr', '4', '25000'),
(15, '5', '41', 'Wonderfull Cat 19', '2', '20000'),
(16, '5', '29', 'Mimi Pet 1000', '2', '30000'),
(17, '5', '31', 'Mimi Petware', '2', '13000'),
(18, '6', '29', 'Mimi Pet 1000', '1', '30000'),
(19, '6', '31', 'Mimi Petware', '1', '13000'),
(20, '6', '33', 'Pet Cargo S', '1', '19000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `product`
--

CREATE TABLE `product` (
  `id` bigint(20) NOT NULL,
  `img` varchar(65) NOT NULL,
  `name` varchar(65) NOT NULL,
  `description` varchar(65) NOT NULL,
  `price` varchar(50) DEFAULT NULL,
  `category` varchar(65) NOT NULL,
  `animal_category` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `product`
--

INSERT INTO `product` (`id`, `img`, `name`, `description`, `price`, `category`, `animal_category`) VALUES
(15, '2.png', 'Wonderfurr Cat 400gr', 'Adult Tuna', '25000', 'Makanan Kucing', 'Cat'),
(17, '4.png', 'Wonderfurr Cat 400gr', 'Adult Chicken & Herring', '200000', 'Makanan Kucing', 'Cat'),
(25, 'furrclean-3.png', 'Furrclean 250 mL', 'Kitten Salmon', '30000', 'Shampoo Kucing', 'Cat'),
(27, '1a.png', 'Purrfection 60 ML', 'Bambino', '34000', 'Parfum', 'Dog'),
(28, '2a.png', 'Purrfection 60 ML', 'Black Pearl', '19000', 'Parfum', 'Dog'),
(29, '1.png', 'Mimi Pet 1000', '30 x 23 x 39 CM', '30000', 'Kandang Besi', 'Bird'),
(31, '14.png', 'Mimi Petware', 'Suitcase', '13000', 'Astronot Bag', 'Others'),
(32, '1.png', 'Mimi Petware', 'Astronaut', '30000', 'Astronot Bag', 'Others'),
(33, '1.png', 'Pet Cargo S', '48 x 30 x 32CM', '19000', 'Pet Cargo', 'Others'),
(34, '1.png', 'Pet Cargo M', '58 x 37 x 37CM', '30000', 'Pet Cargo', 'Others'),
(41, '1689938011_Asset 1.png', 'Wonderfull Cat 19', 'nice', '20000', 'Tes', 'Cat');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_keranjang`
--

CREATE TABLE `tb_keranjang` (
  `id` int(11) NOT NULL,
  `user_id` varchar(10) NOT NULL,
  `produk_id` varchar(10) NOT NULL,
  `jumlah` int(10) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kontak`
--

CREATE TABLE `tb_kontak` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `no_telepon` varchar(100) NOT NULL,
  `pesan` varchar(1000) NOT NULL,
  `status` varchar(10) NOT NULL,
  `tanggal` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_kontak`
--

INSERT INTO `tb_kontak` (`id`, `nama`, `no_telepon`, `pesan`, `status`, `tanggal`) VALUES
(3, 'Jiro', '09090909090', 'Saya mau nanya harga untuk kuantiti banyak', 'sudah_baca', '2023-07-10 18:06:33'),
(4, 'jiro', '9009090', 'jkjkjkjk\r\n', 'sudah_baca', '2023-07-10 18:08:05'),
(5, 'ijijijij', 'j090909', 'jjkjkjkj', 'sudah_baca', '2023-07-10 18:11:19');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_rekening`
--

CREATE TABLE `tb_rekening` (
  `id` int(11) NOT NULL,
  `rekening` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_rekening`
--

INSERT INTO `tb_rekening` (`id`, `rekening`) VALUES
(1, 'BCA 18929929 Tototpet Indo'),
(2, '  T[pembayaran]'),
(3, 'BCA 18929929 Tototpet Indom'),
(4, 'Permata 80033530 TotoIndo');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `id` int(11) NOT NULL,
  `tanggal` varchar(20) NOT NULL,
  `waktu` varchar(30) NOT NULL,
  `user_id` varchar(10) NOT NULL,
  `nama_pembeli` varchar(100) NOT NULL,
  `total` varchar(15) NOT NULL,
  `alamat_pengiriman` varchar(200) NOT NULL,
  `nomor_telepon` varchar(50) NOT NULL,
  `bukti_pembayaran` varchar(200) NOT NULL,
  `status_pengiriman` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`id`, `tanggal`, `waktu`, `user_id`, `nama_pembeli`, `total`, `alamat_pengiriman`, `nomor_telepon`, `bukti_pembayaran`, `status_pengiriman`, `status`) VALUES
(1, '2023-07-20', '20:39:26', '8', '', '141000', 'Jl Cemara NO 19. Indonesia Raya', '082163697808', '64ba1186b9759.png', 'dibatalkan-penjual', ''),
(2, '2023-07-20', '20:40:08', '8', 'Jiro Donovan', '141000', 'Jl Cemara NO 19. Indonesia Raya', '082163697808', '64ba11718515d.jpeg', 'selesai', ''),
(3, '2023-07-21', '17:19:52', '8', 'Jiro Donovan', '111000', 'Jl Cemara no 19', '08216679', '64ba5c5874cde.jpeg', 'selesai', ''),
(4, '2023-07-21', '21:41:04', '25', 'Christ Vieri', '1240000', 'Jl Cemra No 19', '0909090909', '64ba995ef2f56.jpeg', 'sedang-dikirim', ''),
(5, '2023-07-23', '13:04:32', '8', 'Jiro', '126000', 'Jl Cemara No 19', '0821898', '64bd29d09540d.jpeg', 'dibatalkan-penjual', ''),
(6, '2023-07-23', '19:56:25', '8', 'jiro donovan', '62000', 'Jl cemamra no 19', '909090', '', 'menunggu-konfirmasi', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `email` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `id` int(11) NOT NULL,
  `role` varchar(255) NOT NULL,
  `tanggal_otp` varchar(30) NOT NULL,
  `kode_otp` varchar(32) NOT NULL,
  `verifikasi` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`email`, `username`, `password`, `id`, `role`, `tanggal_otp`, `kode_otp`, `verifikasi`) VALUES
('admin@gmail.com', 'admin', 'admin', 4, 'admin', '', '', 'Y'),
('halo@gmail.com', 'halo', 'halo', 7, '', '', '', ''),
('ayam@gmail.com', 'ayam', 'ayam', 8, 'user', '', '005276', 'Y'),
('ikan@gmail.com', 'ikan', 'ikan123', 10, 'user', '2023-07-19 20:32:14', '396528', 'N'),
('babi@gmail.com', 'babi', 'babi123', 13, 'user', '2023-07-19 20:40:25', '964834', 'N'),
('tim@gmail.com', 'aaa', 'bbb', 14, 'user', '2023-07-19 20:42:41', '255512', 'N'),
('ama@gmail.com', 'ama', 'ama123', 25, 'user', '2023-07-21 21:35:53', '009490', 'Y'),
('jirodonovan5@gmail.com', 'jiro1', 'jiro17', 42, 'user', '2023-07-23 15:16:55', '182317', 'N'),
('nathantjendra67@gmail.com', 'Nathan', 'Nathan06092003', 45, 'user', '2023-07-24 06:58:59', 'e2c1e9dd8ebde0a088d1bef2cbf60e0c', 'N');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_keranjang`
--
ALTER TABLE `tb_keranjang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_kontak`
--
ALTER TABLE `tb_kontak`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_rekening`
--
ALTER TABLE `tb_rekening`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `product`
--
ALTER TABLE `product`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT untuk tabel `tb_keranjang`
--
ALTER TABLE `tb_keranjang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT untuk tabel `tb_kontak`
--
ALTER TABLE `tb_kontak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tb_rekening`
--
ALTER TABLE `tb_rekening`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
