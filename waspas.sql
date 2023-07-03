-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 03 Jul 2023 pada 21.39
-- Versi server: 10.5.20-MariaDB-1:10.5.20+maria~ubu1804
-- Versi PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `waspas`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `akun`
--

CREATE TABLE `akun` (
  `idakun` bigint(20) UNSIGNED NOT NULL,
  `namaakun` varchar(255) NOT NULL,
  `tanggallahir` date NOT NULL,
  `jk` enum('p','l') NOT NULL,
  `password` varchar(255) NOT NULL,
  `hp` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `posisi` enum('user','superadmin') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `akun`
--

INSERT INTO `akun` (`idakun`, `namaakun`, `tanggallahir`, `jk`, `password`, `hp`, `email`, `posisi`, `created_at`, `updated_at`) VALUES
(1, 'superadmin', '2023-05-02', 'l', '$2y$10$KcE8G8rNgj9WkY5R.MuGEuaZWQixd604S9553StLu/pjl3amWGeLW', '081268293603', 'superadmin@gmail.com', 'superadmin', '2023-05-07 14:39:09', '2023-05-07 14:39:09');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detailkriteria`
--

CREATE TABLE `detailkriteria` (
  `iddetailkriteria` bigint(20) UNSIGNED NOT NULL,
  `idkriteria` int(11) NOT NULL,
  `min` int(11) DEFAULT NULL,
  `max` int(11) DEFAULT NULL,
  `juduldetailkriteria` varchar(255) DEFAULT NULL,
  `bobot` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `detailkriteria`
--

INSERT INTO `detailkriteria` (`iddetailkriteria`, `idkriteria`, `min`, `max`, `juduldetailkriteria`, `bobot`, `created_at`, `updated_at`) VALUES
(1, 1, 0, 20, NULL, 2, '2023-05-14 09:22:14', '2023-05-14 09:22:38'),
(2, 1, 21, 40, NULL, 2, '2023-05-14 09:22:14', '2023-05-14 12:25:58'),
(3, 1, 41, 60, NULL, 4, '2023-05-14 09:22:14', '2023-05-14 09:22:44'),
(4, 1, 61, 80, NULL, 5, '2023-05-14 09:22:14', '2023-05-14 09:22:46'),
(5, 1, 81, 100, NULL, 6, '2023-05-14 09:22:15', '2023-05-14 09:22:48'),
(6, 2, NULL, NULL, 'SD', 2, '2023-05-14 09:22:22', '2023-05-14 09:22:56'),
(7, 2, NULL, NULL, 'SMP', 3, '2023-05-14 09:22:22', '2023-05-14 09:22:59'),
(8, 2, NULL, NULL, 'SMA/SMK', 4, '2023-05-14 09:22:22', '2023-05-14 09:23:03'),
(9, 2, NULL, NULL, 'S1', 5, '2023-05-14 09:22:22', '2023-05-14 09:23:05'),
(10, 3, NULL, NULL, 'Tidak Baik', 1, '2023-05-14 13:04:38', '2023-05-14 13:05:09'),
(11, 3, NULL, NULL, 'Kurang Baik', 2, '2023-05-14 13:04:38', '2023-05-14 13:05:11'),
(12, 3, NULL, NULL, 'Cukup', 3, '2023-05-14 13:04:38', '2023-05-14 13:05:12'),
(13, 3, NULL, NULL, 'Baik', 4, '2023-05-14 13:04:38', '2023-05-14 13:05:14'),
(14, 3, NULL, NULL, 'Sangat Baik', 5, '2023-05-14 13:04:38', '2023-05-14 13:05:16'),
(15, 4, NULL, NULL, 'Tidak Baik', 1, '2023-05-14 13:05:37', '2023-05-14 13:05:43'),
(16, 4, NULL, NULL, 'Kurang Baik', 2, '2023-05-14 13:05:37', '2023-05-14 13:05:45'),
(17, 4, NULL, NULL, 'Cukup', 3, '2023-05-14 13:05:37', '2023-05-14 13:05:46'),
(18, 4, NULL, NULL, 'Baik', 4, '2023-05-14 13:05:37', '2023-05-14 13:05:47'),
(19, 4, NULL, NULL, 'Sangat Baik', 5, '2023-05-14 13:05:37', '2023-05-14 13:05:48'),
(20, 5, NULL, NULL, 'Tidak Ada', 1, '2023-05-14 13:06:23', '2023-05-14 13:07:03'),
(21, 5, NULL, NULL, '1-3 Bulan', 2, '2023-05-14 13:06:23', '2023-05-14 13:07:04'),
(22, 5, NULL, NULL, '1-2 Tahun', 3, '2023-05-14 13:06:23', '2023-05-14 13:07:05'),
(23, 5, NULL, NULL, '3-5 Tahun', 4, '2023-05-14 13:06:23', '2023-05-14 13:07:07'),
(24, 5, NULL, NULL, '>5 Tahun', 5, '2023-05-14 13:06:23', '2023-05-14 13:07:08'),
(30, 7, NULL, NULL, '< 3 jt', 5, '2023-07-03 13:25:35', '2023-07-03 13:29:36'),
(31, 7, NULL, NULL, '3 - 4jt', 4, '2023-07-03 13:25:35', '2023-07-03 13:29:34'),
(32, 7, NULL, NULL, '4-5 jt', 3, '2023-07-03 13:25:36', '2023-07-03 13:29:30'),
(33, 7, NULL, NULL, '5 - 6jt', 2, '2023-07-03 13:25:36', '2023-07-03 13:29:26'),
(34, 7, NULL, NULL, '6-7jt', 1, '2023-07-03 13:25:36', '2023-07-03 13:29:21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteria`
--

CREATE TABLE `kriteria` (
  `idkriteria` bigint(20) UNSIGNED NOT NULL,
  `judulkriteria` varchar(255) NOT NULL,
  `typedata` enum('angka','pendidikan','manual') NOT NULL,
  `bobot` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kriteria`
--

INSERT INTO `kriteria` (`idkriteria`, `judulkriteria`, `typedata`, `bobot`, `created_at`, `updated_at`) VALUES
(1, 'Psikotes', 'angka', 3, '2023-05-14 09:22:14', '2023-05-14 09:22:14'),
(2, 'Pendidikan', 'pendidikan', 2, '2023-05-14 09:22:22', '2023-05-14 15:15:37'),
(3, 'Wawancara', 'manual', 4, '2023-05-14 13:04:37', '2023-05-14 13:04:37'),
(4, 'Keahlian', 'manual', 2, '2023-05-14 13:05:37', '2023-05-14 13:05:37'),
(5, 'Pengalaman Kerja', 'manual', 1, '2023-05-14 13:06:23', '2023-05-14 13:06:23'),
(7, 'Rentang Gaji Yang di Harapkan', 'manual', 6, '2023-07-03 13:25:35', '2023-07-03 13:25:35');

-- --------------------------------------------------------

--
-- Struktur dari tabel `lowongan`
--

CREATE TABLE `lowongan` (
  `idlowongan` bigint(20) UNSIGNED NOT NULL,
  `judullowongan` varchar(255) NOT NULL,
  `tanggalbuka` date NOT NULL,
  `tanggaltutup` date NOT NULL,
  `ket` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `lowongan`
--

INSERT INTO `lowongan` (`idlowongan`, `judullowongan`, `tanggalbuka`, `tanggaltutup`, `ket`, `created_at`, `updated_at`) VALUES
(1, 'Software Developer', '2023-05-08', '2023-05-26', 1, '2023-05-07 13:28:49', '2023-07-03 14:22:23'),
(2, 'Accounting', '2023-06-28', '2023-07-03', 1, '2023-07-03 13:04:14', '2023-07-03 13:04:14');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(6, '2014_10_12_000000_create_users_table', 1),
(7, '2014_10_12_100000_create_password_resets_table', 1),
(8, '2019_08_19_000000_create_failed_jobs_table', 1),
(9, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai`
--

CREATE TABLE `nilai` (
  `idnilai` bigint(20) NOT NULL,
  `idpelamar` bigint(20) DEFAULT NULL,
  `idkriteria` bigint(20) DEFAULT NULL,
  `iddetailkriteria` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nilai` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelamar`
--

CREATE TABLE `pelamar` (
  `idpelamar` bigint(20) UNSIGNED NOT NULL,
  `idakun` int(11) NOT NULL,
  `idlowongan` int(11) NOT NULL,
  `ket` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelamarupload`
--

CREATE TABLE `pelamarupload` (
  `idpelamarupload` bigint(20) UNSIGNED NOT NULL,
  `idpelamar` int(11) NOT NULL,
  `idupload` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `namaberkas` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pelamarupload`
--

INSERT INTO `pelamarupload` (`idpelamarupload`, `idpelamar`, `idupload`, `created_at`, `updated_at`, `namaberkas`) VALUES
(1, 1, '1', '2023-05-07 15:51:48', '2023-05-07 15:51:48', 'WhatsApp Image 2023-05-05 at 18.00.41_1683474708.jpeg'),
(3, 1, '2', '2023-05-07 16:33:56', '2023-05-07 16:33:56', 'KK_1683477236.pdf'),
(4, 2, '1', '2023-05-14 11:55:48', '2023-05-14 11:55:48', 'WhatsApp Image 2023-05-02 at 07.52.07_1684065348.jpeg'),
(5, 2, '2', '2023-05-14 11:55:54', '2023-05-14 11:55:54', 'WhatsApp Image 2023-05-02 at 07.52.07_1684065354.jpeg'),
(6, 5, '3', '2023-07-03 13:07:46', '2023-07-03 13:07:46', 'pendaftaran seminar_1688389666.jpg'),
(7, 4, '3', '2023-07-03 13:07:46', '2023-07-03 13:07:46', 'g1_1688389666.JPG');

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `upload`
--

CREATE TABLE `upload` (
  `idupload` bigint(20) UNSIGNED NOT NULL,
  `idlowongan` int(11) NOT NULL,
  `judulupload` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `upload`
--

INSERT INTO `upload` (`idupload`, `idlowongan`, `judulupload`, `created_at`, `updated_at`) VALUES
(1, 1, 'cv', '2023-05-07 13:28:49', '2023-05-07 13:28:49'),
(2, 1, 'surat lamaran', '2023-05-07 13:28:49', '2023-05-07 13:28:49'),
(3, 2, 'cv', '2023-07-03 13:04:14', '2023-07-03 13:04:14');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`idakun`),
  ADD UNIQUE KEY `akun_email_unique` (`email`);

--
-- Indeks untuk tabel `detailkriteria`
--
ALTER TABLE `detailkriteria`
  ADD PRIMARY KEY (`iddetailkriteria`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`idkriteria`),
  ADD UNIQUE KEY `kriteria_judulkriteria_unique` (`judulkriteria`);

--
-- Indeks untuk tabel `lowongan`
--
ALTER TABLE `lowongan`
  ADD PRIMARY KEY (`idlowongan`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`idnilai`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `pelamar`
--
ALTER TABLE `pelamar`
  ADD PRIMARY KEY (`idpelamar`);

--
-- Indeks untuk tabel `pelamarupload`
--
ALTER TABLE `pelamarupload`
  ADD PRIMARY KEY (`idpelamarupload`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `upload`
--
ALTER TABLE `upload`
  ADD PRIMARY KEY (`idupload`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `akun`
--
ALTER TABLE `akun`
  MODIFY `idakun` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `detailkriteria`
--
ALTER TABLE `detailkriteria`
  MODIFY `iddetailkriteria` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `idkriteria` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `lowongan`
--
ALTER TABLE `lowongan`
  MODIFY `idlowongan` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `nilai`
--
ALTER TABLE `nilai`
  MODIFY `idnilai` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT untuk tabel `pelamar`
--
ALTER TABLE `pelamar`
  MODIFY `idpelamar` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `pelamarupload`
--
ALTER TABLE `pelamarupload`
  MODIFY `idpelamarupload` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `upload`
--
ALTER TABLE `upload`
  MODIFY `idupload` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
