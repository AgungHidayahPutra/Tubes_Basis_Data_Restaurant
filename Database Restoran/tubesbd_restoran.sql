-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2023 at 11:30 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tubesbd_restoran`
--

-- --------------------------------------------------------

--
-- Table structure for table `meja`
--

CREATE TABLE `meja` (
  `id_meja` varchar(5) NOT NULL,
  `jenis` varchar(10) NOT NULL,
  `kapasitas` int(3) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `meja`
--

INSERT INTO `meja` (`id_meja`, `jenis`, `kapasitas`, `status`) VALUES
('T01', 'VVIP', 16, 'Dipesan'),
('T02', 'VVIP', 16, 'Tersedia'),
('T03', 'VIP', 8, 'Terisi'),
('T04', 'VIP', 8, 'Tersedia'),
('T05', 'Reguler+', 4, 'Terisi'),
('T06', 'Reguler+', 4, 'Terisi'),
('T07', 'Reguler+', 4, 'Dipesan'),
('T08', 'Reguler+', 4, 'Terisi'),
('T09', 'Reguler', 2, 'Terisi'),
('T10', 'Reguler', 2, 'Terisi'),
('T11', 'Reguler', 2, 'Terisi'),
('T12', 'Reguler', 2, 'Terisi');

-- --------------------------------------------------------

--
-- Table structure for table `memesan`
--

CREATE TABLE `memesan` (
  `id_pembeli` varchar(5) NOT NULL,
  `id_meja` varchar(5) NOT NULL,
  `id_pelayan` varchar(6) NOT NULL,
  `id_menu` varchar(6) NOT NULL,
  `jml_pesanan` int(3) NOT NULL,
  `total_harga` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `memesan`
--

INSERT INTO `memesan` (`id_pembeli`, `id_meja`, `id_pelayan`, `id_menu`, `jml_pesanan`, `total_harga`) VALUES
('IP004', 'T09', 'ID001', 'IM001', 2, 80000),
('IP003', 'T09', 'ID001', 'IM008', 1, 20000),
('IP003', 'T09', 'ID001', 'IM012', 2, 24000),
('IP001', 'T05', 'ID004', 'IM003', 2, 110000),
('IP001', 'T05', 'ID004', 'IM007', 2, 40000),
('IP001', 'T05', 'ID004', 'IM001', 2, 80000),
('IP001', 'T05', 'ID004', 'IM014', 2, 30000),
('IP001', 'T05', 'ID004', 'IM015', 1, 18000),
('IP009', 'T11', 'ID007', 'IM001', 2, 80000),
('IP009', 'T11', 'ID007', 'IM013', 2, 24000),
('IP004', 'T10', 'ID003', 'IM002', 1, 75000),
('IP004', 'T10', 'ID003', 'IM003', 1, 55000),
('IP004', 'T10', 'ID003', 'IM016', 2, 36000),
('IP007', 'T06', 'ID009', 'IM001', 1, 40000),
('IP007', 'T06', 'ID009', 'IM002', 3, 225000),
('IP007', 'T06', 'ID009', 'IM010', 4, 120000),
('IP007', 'T06', 'ID009', 'IM016', 3, 54000),
('IP007', 'T06', 'ID009', 'IM014', 1, 15000),
('IP006', 'T12', 'ID002', 'IM001', 2, 80000),
('IP006', 'T12', 'ID002', 'IM005', 1, 30000),
('IP006', 'T12', 'ID002', 'IM013', 2, 24000),
('IP005', 'T08', 'ID010', 'IM002', 4, 300000),
('IP005', 'T08', 'ID010', 'IM005', 3, 90000),
('IP005', 'T08', 'ID010', 'IM009', 4, 100000),
('IP005', 'T08', 'ID010', 'IM016', 4, 72000),
('IP010', 'T03', 'ID005', 'IM003', 2, 110000),
('IP010', 'T03', 'ID005', 'IM002', 4, 300000),
('IP010', 'T03', 'ID005', 'IM007', 3, 60000),
('IP010', 'T03', 'ID005', 'IM010', 6, 180000),
('IP010', 'T03', 'ID005', 'IM014', 6, 90000);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id_menu` varchar(6) NOT NULL,
  `nama_menu` varchar(20) NOT NULL,
  `harga` int(10) NOT NULL,
  `kategori` varchar(15) NOT NULL,
  `ketersediaan` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id_menu`, `nama_menu`, `harga`, `kategori`, `ketersediaan`) VALUES
('IM001', 'Nasi Goreng', 40000, 'Makanan Utama', 'Tersedia'),
('IM002', 'Wagyu Steak', 75000, 'Makanan Utama', 'Tersedia'),
('IM003', 'Spaghetti', 55000, 'Makanan Utama', 'Tersedia'),
('IM004', 'Duck Peking', 70000, 'Makanan Utama', 'Habis'),
('IM005', 'Salad', 30000, 'Makanan pembuka', 'Tersedia'),
('IM006', 'Canape', 35000, 'Makanan pembuka', 'Tersedia'),
('IM007', 'Spring Roll', 20000, 'Makanan pembuka', 'Tersedia'),
('IM008', 'Batagor', 20000, 'Makanan pembuka', 'Tersedia'),
('IM009', 'Tiramisu', 25000, 'Makanan Penutup', 'Tersedia'),
('IM010', 'Cheseecake', 30000, 'Makanan Penutup', 'Tersedia'),
('IM011', 'Creme Brulee', 25000, 'Makanan Penutup', 'Habis'),
('IM012', 'Ice Cream', 20000, 'Makanan Penutup', 'Tersedia'),
('IM013', 'Ice Tea', 12000, 'Minuman', 'Tersedia'),
('IM014', 'Jus Buah', 15000, 'Minuman', 'Tersedia'),
('IM015', 'Milkshake', 18000, 'Minuman', 'Tersedia'),
('IM016', 'Mocktail', 18000, 'Minuman', 'Tersedia');

-- --------------------------------------------------------

--
-- Table structure for table `pelayan`
--

CREATE TABLE `pelayan` (
  `id_pelayan` varchar(6) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `jns_kelamin` varchar(10) NOT NULL,
  `jadwal_kerja` varchar(15) NOT NULL,
  `no_hp` varchar(13) NOT NULL,
  `gaji` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelayan`
--

INSERT INTO `pelayan` (`id_pelayan`, `nama`, `jns_kelamin`, `jadwal_kerja`, `no_hp`, `gaji`) VALUES
('ID001', 'Siti', 'Perempuan', 'Shift Siang', '081271627543', 4500000),
('ID002', 'Budi', 'Laki-Laki', 'Shift Malam', '087721261621', 5000000),
('ID003', 'Robi', 'Laki-Laki', 'Shift Malam', '089518182971', 5500000),
('ID004', 'Alif', 'Laki-Laki', 'Shift Siang', '083127617261', 4000000),
('ID005', 'Rahmat', 'Laki-Laki', 'Shift Malam', '089812188187', 5000000),
('ID006', 'Bunga', 'Perempuan', 'Shift Siang', '089619837981', 4000000),
('ID007', 'Rizka', 'Perempuan', 'Shift Siang', '081245834985', 4500000),
('ID008', 'Indah', 'Perempuan', 'Shift Siang', '085637219791', 4000000),
('ID009', 'Anisa', 'Perempuan', 'Shift Malam', '085831298910', 5500000),
('ID010', 'Angel', 'Perempuan', 'Shift Malam', '087889912091', 5500000);

-- --------------------------------------------------------

--
-- Table structure for table `pembeli`
--

CREATE TABLE `pembeli` (
  `id_pembeli` varchar(5) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `jns_kelamin` varchar(10) NOT NULL,
  `alamat` varchar(40) NOT NULL,
  `no_hp` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembeli`
--

INSERT INTO `pembeli` (`id_pembeli`, `nama`, `jns_kelamin`, `alamat`, `no_hp`) VALUES
('IP001', 'Bayu', 'Laki-Laki', 'Jl. Mawar', '089781973110'),
('IP002', 'Andi', 'Laki-Laki', 'Jl. Anggrek', '085632789011'),
('IP003', 'Susi', 'Perempuan', 'Jl. Tulip', '087624135980'),
('IP004', 'Dedi', 'Laki-Laki', 'Jl. teratai', '087715609089'),
('IP005', 'Alex', 'Laki-Laki', 'Jl. Gandus', '088927121829'),
('IP006', 'Iben', 'Laki-Laki', 'Jl. Buntu', '089816216211'),
('IP007', 'Ratna', 'Perempuan', 'Jl. Nusantara', '087890291021'),
('IP008', 'Suci', 'Perempuan', 'Jl. Minang', '081246889991'),
('IP009', 'Melati', 'Perempuan', 'Jl. Sudirman', '087987189712'),
('IP010', 'Bela', 'Perempuan', 'Jl. Garuda', '083127321781'),
('IP011', 'Ade iriani Sapitri', 'Perempuan', 'Jakabaring', '087782120923');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `meja`
--
ALTER TABLE `meja`
  ADD PRIMARY KEY (`id_meja`);

--
-- Indexes for table `memesan`
--
ALTER TABLE `memesan`
  ADD KEY `id_pembeli` (`id_pembeli`),
  ADD KEY `id_meja` (`id_meja`),
  ADD KEY `id_pelayan` (`id_pelayan`),
  ADD KEY `id_menu` (`id_menu`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `pelayan`
--
ALTER TABLE `pelayan`
  ADD PRIMARY KEY (`id_pelayan`);

--
-- Indexes for table `pembeli`
--
ALTER TABLE `pembeli`
  ADD PRIMARY KEY (`id_pembeli`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `memesan`
--
ALTER TABLE `memesan`
  ADD CONSTRAINT `memesan_ibfk_1` FOREIGN KEY (`id_pembeli`) REFERENCES `pembeli` (`id_pembeli`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `memesan_ibfk_2` FOREIGN KEY (`id_meja`) REFERENCES `meja` (`id_meja`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `memesan_ibfk_3` FOREIGN KEY (`id_pelayan`) REFERENCES `pelayan` (`id_pelayan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `memesan_ibfk_4` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id_menu`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
