-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 11 Agu 2024 pada 12.33
-- Versi server: 11.4.2-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `parawisata`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id`, `nama`) VALUES
(1, 'bali'),
(2, 'Jawa'),
(18, 'Ntt');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesanan`
--

CREATE TABLE `pesanan` (
  `id` int(11) NOT NULL,
  `nama_pemesan` varchar(255) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `nama_wisata` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `durasi` int(11) NOT NULL,
  `jumlah_peserta` int(11) NOT NULL,
  `penginapan` int(11) DEFAULT NULL,
  `transportasi` int(11) DEFAULT NULL,
  `makanan` int(11) DEFAULT NULL,
  `total_tagihan` int(11) NOT NULL,
  `kategori_id` int(11) DEFAULT NULL,
  `total_layanan` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `pesanan`
--

INSERT INTO `pesanan` (`id`, `nama_pemesan`, `no_hp`, `nama_wisata`, `tanggal`, `durasi`, `jumlah_peserta`, `penginapan`, `transportasi`, `makanan`, `total_tagihan`, `kategori_id`, `total_layanan`) VALUES
(42, 'faris3333333', '0897435', 'Pantai Pandawa', '2024-07-13', 2, 2, 1000000, 1200000, 500000, 22800000, 1, 10800000),
(43, 'faris3333333', '0897435', 'Pantai Pandawa', '2024-07-13', 2, 2, 1000000, 1200000, 500000, 22800000, 1, 10800000),
(44, 'faris3333333', '0897435', 'Pantai Pandawa', '2024-07-13', 2, 2, 1000000, 1200000, 500000, 22800000, 1, 10800000),
(45, 'faris3333333', '0897435', 'Pantai Pandawa', '2024-07-13', 2, 2, 1000000, 1200000, 500000, 22800000, 1, 10800000),
(46, 'faris3333333', '0897435', 'Pantai Pandawa', '2024-07-13', 2, 2, 1000000, 1200000, 500000, 22800000, 1, 10800000),
(56, 'efr', '324', 'Candi Prambanan', '2024-07-19', 3, 3, 1000000, 0, 500000, 13650000, 2, 13500000),
(57, 'faris achmad ', '324', 'Candi Prambanan', '2024-07-19', 2, 2, 1000000, 1200000, 500000, 10900000, 2, 10800000),
(58, 'achmad', '123', 'Gunung Bromo Jawa timur', '2024-07-20', 1, 1, 1000000, 1200000, 500000, 3450000, 2, 2700000),
(59, 'achmad', '085774371712', 'Candi Borobudur', '2024-08-08', 2, 2, 1000000, 1200000, 500000, 34800000, 2, 10800000),
(60, 'achmad', '085774371712', 'Candi Borobudur', '2024-08-08', 2, 2, 1000000, 1200000, 500000, 34800000, 2, 10800000),
(61, 'febrian', '085774371712', 'Gunung Agung', '2024-07-24', 1, 1, 1000000, 1200000, 500000, 9700000, 1, 2700000),
(62, 'yogi', '0854387', 'Pantai Pandawa', '2024-07-13', 1, 1, 1000000, 1200000, 500000, 8700000, 1, 2700000),
(63, 'faris achmad ', '5445', 'Pantai Pandawa', '2024-07-13', 1, 1, 1000000, 1200000, 500000, 8700000, 1, 2700000),
(64, 'faris achmad ', '5445', 'Pantai Pandawa', '2024-07-13', 1, 1, 1000000, 1200000, 500000, 8700000, 1, 2700000),
(65, 'achmad', '0897435', 'Gunung Agung', '2024-07-24', 2, 2, 1000000, 1200000, 500000, 24800000, 1, 10800000),
(66, 'achmad', '0897435', 'Gunung Agung', '2024-07-24', 2, 2, 1000000, 1200000, 500000, 24800000, 1, 10800000),
(67, 'achmad', '0897435', 'Gunung Agung', '2024-07-24', 2, 2, 1000000, 1200000, 500000, 24800000, 1, 10800000),
(68, 'dfssd', '085774371712', 'Candi Prambanan', '2024-07-19', 1, 1, 1000000, 1200000, 500000, 2750000, 2, 2700000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2a$12$O0is.cVSFMZ8V4simgiJhOxuAA4L9214LBcxK4EMex4QLnilSmA66');

-- --------------------------------------------------------

--
-- Struktur dari tabel `wisata`
--

CREATE TABLE `wisata` (
  `id` int(11) NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `harga` double NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `video_url` varchar(255) NOT NULL,
  `detail` text DEFAULT NULL,
  `ketersedian_stok` enum('habis','tersedia') DEFAULT 'tersedia'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `wisata`
--

INSERT INTO `wisata` (`id`, `kategori_id`, `nama`, `tanggal`, `harga`, `foto`, `video_url`, `detail`, `ketersedian_stok`) VALUES
(8, 1, 'Pantai Pandawa', '2024-07-13', 6000000, '1wju42lzwidsbdraj3ig.jpg', 'https://www.youtube.com/embed/HKGpETY9288?si=WP6xEtAz-dBLjyZQ', '<p>Pantai Pandawa adalah salah satu tempat wisata di area Kuta selatan, Kabupaten Badung, Bali. Pantai ini terletak di balik perbukitan dan sering disebut sebagai Pantai Rahasia (Secret Beach). Di sekitar pantai ini terdapat dua tebing yang sangat besar yang pada salah satu sisinya dipahat lima patung Pandawa dan Kunti. Keenam patung tersebut secarara berurutan (dari posisi tertinggi) diberi penejasan nama Dewi Kunti, Dharma Wangsa, Bima, Arjuna, Nakula, dan Sadewa.<p>\r\n\r\n<p>Selain untuk tujuan wisata dan olahraga air, pantai ini juga dimanfaatkan untuk budidaya rumput laut karena kontur pantai yang landai dan ombak yang tidak sampai ke garis pantai. Cukup banyak wisatawan yang melakukan paralayang dari Bukit Timbis hingga ke Pantai Pandawa.<p>\r\n\r\n<p>Kawasan pantai ini juga sering digunakan sebagai lokasi pengambilan gambar untuk sinetron FTV.<p>       ', 'tersedia'),
(10, 1, 'Gunung Agung', '2024-07-24', 7000000, 'xye228subshfb98xq29e.jpg', 'https://www.youtube.com/embed/TAU4jOcBx64?si=y9947xdEn-1_bRry', '<p>Gunung Agung adalah gunung tertinggi di pulau Bali dengan ketinggian 3.142 mdpl. Gunung ini terletak di kecamatan Rendang, Kabupaten Karangasem, Bali, Indonesia. Pura Besakih, yang merupakan salah satu Pura terpenting di Bali, terletak di lereng gunung ini.<p>\r\n\r\n<p>Gunung Agung adalah gunung berapi tipe strato, gunung ini memiliki kawah yang sangat besar dan sangat dalam yang kadang-kadang mengeluarkan asap dan uap air. Dari Pura Besakih gunung ini tampak dengan kerucut runcing sempurna, tetapi sebenarnya puncak gunung ini memanjang dan berakhir pada kawah yang melingkar dan lebar.<p>\r\n\r\n<p>Dari puncak gunung Agung kita dapat melihat puncak Gunung Rinjani yang berada di pulau Lombok di sebelah timur, meskipun kedua gunung tertutup awan karena kedua puncak gunung tersebut berada di atas awan, kepulauan Nusa Penida di sebelah selatan beserta pantai-pantainya, termasuk pantai Sanur serta gunung dan danau Batur di sebelah barat laut.<p>', 'tersedia'),
(11, 2, 'Candi Prambanan', '2024-07-19', 50000, 'pi2daocia1woszuv4xl5.jpg', 'https://www.youtube.com/embed/MhifUwbQj6o?si=RS02Dn3rfhfNQs-X', '<p>Kompleks Candi Prambanan adalah sebutan Warisan Dunia dari sekumpulan kompleks candi Hindu dan Buddha yang terbentang di perbatasan antara Yogyakarta dan Jawa Tengah, Indonesia. Kompleks tersebut terdiri dari kompleks candi Prambanan, candi Lumbung, candi Bubrah dan candi Sewu, semuanya terletak di Taman Arkeologi Prambanan.<p>\r\n<p>kompleks candi Hindu terbesar di Indonesia yang dibangun pada abad ke-9 masehi. Candi ini dipersembahkan untuk Trimurti, tiga dewa utama Hindu yaitu Brahma sebagai dewa pencipta, Wishnu sebagai dewa pemelihara, dan Siwa sebagai dewa pemusnah.<p>\r\n<p>Nama Prambanan, berasal dari nama desa tempat candi ini berdiri, diduga merupakan perubahan nama dialek bahasa Jawa dari istilah teologi Hindu Para Brahman yang bermakna \"Brahman Agung\"<p>', 'tersedia'),
(12, 2, 'Gunung Bromo Jawa timur', '2024-07-20', 750000, '9kysvzy966sk15sr47no.jpg', 'https://www.youtube.com/embed/ruKqXQ2KtH4?si=2eMYnsuC5KMFU3rn', '<p>Gunung Bromo atau dalam bahasa Tengger dieja \"Brama\", juga disebut Kaldera Tengger, adalah sebuah gunung berapi aktif di Jawa Timur, Indonesia. Gunung ini memiliki ketinggian 2.614 meter di atas permukaan laut dan berada dalam empat wilayah kabupaten, yakni Kabupaten Probolinggo, Kabupaten Pasuruan, Kabupaten Lumajang, dan Kabupaten Malang. Gunung Bromo terkenal sebagai objek wisata utama di Jawa Timur. Sebagai sebuah objek wisata, Bromo menjadi menarik karena statusnya sebagai gunung berapi yang masih aktif. Gunung Bromo termasuk dalam kawasan Taman Nasional Bromo Tengger Semeru.<p>\r\n\r\n<p>Nama Bromo berasal dari nama dewa utama dalam agama Hindu, Brahma.<p>\r\n\r\n<p>Bentuk tubuh Gunung Bromo bertautan antara lembah dan ngarai dengan kaldera atau lautan pasir seluas sekitar 10 kilometer persegi, Ia mempunyai sebuah kawah dengan garis tengah ± 800 meter (utara-selatan) dan ± 600 meter (timur-barat). Sedangkan daerah bahayanya berupa lingkaran dengan jari-jari 4 km dari pusat kawah Bromo.<p>', 'tersedia'),
(13, 18, 'Pulau Komodo', '2024-07-26', 100000000, 'ajp9h2cvmpaqvgabwqsl.jpg', 'https://www.youtube.com/embed/RaTWq98hzF0?si=V56YTBWaJ4bW8yTn', '<p>Pulau Komodo adalah sebuah pulau yang terletak di Kepulauan Nusa Tenggara, berada di sebelah timur Pulau Sumbawa, yang dipisahkan oleh Selat Sape. Pulau Komodo dikenal sebagai habitat asli hewan komodo<p>\r\n<p>Pulau ini termasuk salah satu kawasan Taman Nasional Komodo yang dikelola oleh Pemerintah Pusat.<p>\r\n<p>Secara administratif, pulau ini termasuk wilayah Kabupaten Manggarai Barat, Kecamatan Komodo, Provinsi Nusa Tenggara Timur, Indonesia. Pulau Komodo merupakan ujung paling barat Provinsi Nusa Tenggara Timur, berbatasan dengan Provinsi Nusa Tenggara Barat.<p>', 'tersedia'),
(14, 18, 'Pantai Labuan Bajo', '2024-08-02', 50000000, 'vm7gy64rz4qgdql38udc.jpg', 'https://www.youtube.com/embed/kQIri35Yjds?si=tvx18IkKL0b0BRa-', '<p>Labuan Bajo terkenal akan pantai berwarna merah muda (pink). Ada dua pantai pasir pink yang bisa ditemukan yaitu Pink Beach di Pulau Komodo dan Long Beach di Pulau Padar, dikutip laman Kementerian Pariwisata dan Ekonomi Kreatif (Kemenparekraf). Laut dan pasir berwarna merah muda di kedua pantai ini menjadi spot Instagramable incaran para wisatawan. Selain itu, wisatawan juga <p>bisa snorkeling, melihat ekosistem bawah laut Labuan Bajo.<p>\r\n\r\n<p>Artikel ini telah tayang di Kompas.com dengan judul \"9 Wisata Pantai Labuan Bajo NTT, Ada Waecicu dan Long Beach\".<p>\r\n', 'tersedia'),
(17, 2, 'Candi Borobudur', '2024-08-08', 12000000, 'yre9flcbs4t17dog1i98.jpg', 'https://www.youtube.com/embed/tDuhIrzBjbQ?si=Gq4_TvTZVN4nyyq4', '<p>sebuah candi Buddha yang terletak di Borobudur, Magelang, Jawa Tengah, Indonesia. Candi ini terletak kurang lebih 100 km di sebelah barat daya Semarang, 86 km di sebelah barat Surakarta, dan 40 km di sebelah barat laut Yogyakarta. Candi dengan banyak stupa ini didirikan oleh para penganut agama Buddha Mahayana sekitar tahun 800-an Masehi pada masa pemerintahan wangsa Syailendra. Borobudur adalah candi atau kuil Buddha terbesar di dunia,[1][2] sekaligus salah satu monumen Buddha terbesar di dunia.[3]<p>', 'tersedia');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kategori_id` (`kategori_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `wisata`
--
ALTER TABLE `wisata`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nama` (`nama`),
  ADD KEY `kategori_produk` (`kategori_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `wisata`
--
ALTER TABLE `wisata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `pesanan_ibfk_1` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id`);

--
-- Ketidakleluasaan untuk tabel `wisata`
--
ALTER TABLE `wisata`
  ADD CONSTRAINT `kategori_produk` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
