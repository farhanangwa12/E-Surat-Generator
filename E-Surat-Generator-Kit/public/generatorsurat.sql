-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 08, 2023 at 02:34 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `generatorsurat`
--

-- --------------------------------------------------------

--
-- Table structure for table `bar_jas`
--

CREATE TABLE `bar_jas` (
  `id` bigint UNSIGNED NOT NULL,
  `id_jenis_kontrak` bigint UNSIGNED NOT NULL,
  `uraian` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `volume` decimal(10,2) NOT NULL,
  `satuan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bar_jas`
--

INSERT INTO `bar_jas` (`id`, `id_jenis_kontrak`, `uraian`, `volume`, `satuan`, `created_at`, `updated_at`) VALUES
(1, 1, 'Power meter unit EDMI Mk6E Class 0.2s, 3P 4W In 1A Vn', 5.00, ' unit ', '2023-06-08 01:32:27', '2023-06-08 01:32:27'),
(2, 1, 'Ethernet switch MOXA EDS-208', 1.00, ' unit ', '2023-06-08 01:32:27', '2023-06-08 01:32:27'),
(3, 1, 'Wiring and accessories', 1.00, ' lot ', '2023-06-08 01:32:27', '2023-06-08 01:32:27'),
(4, 1, 'Software SCADA for PMU (X Arrow) 300 tag with license', 1.00, ' lot ', '2023-06-08 01:32:27', '2023-06-08 01:32:27'),
(5, 2, 'Power meter installation and configuration', 5.00, ' set ', '2023-06-08 01:32:27', '2023-06-08 01:32:27'),
(6, 2, 'Software SCADA engineering and configuration', 1.00, ' lot ', '2023-06-08 01:32:27', '2023-06-08 01:32:27'),
(7, 2, 'Transport and Accomodation', 1.00, ' lot ', '2023-06-08 01:32:27', '2023-06-08 01:32:27'),
(8, 2, 'Kalibrasi', 5.00, ' set ', '2023-06-08 01:32:27', '2023-06-08 01:32:27');

-- --------------------------------------------------------

--
-- Table structure for table `bar_jas_b_o_q_s`
--

CREATE TABLE `bar_jas_b_o_q_s` (
  `id` bigint UNSIGNED NOT NULL,
  `id_boq` bigint UNSIGNED NOT NULL,
  `id_barjas` bigint UNSIGNED NOT NULL,
  `harga_satuan` decimal(10,2) NOT NULL,
  `jumlah` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bar_jas_b_o_q_s`
--

INSERT INTO `bar_jas_b_o_q_s` (`id`, `id_boq`, `id_barjas`, `harga_satuan`, `jumlah`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 0.00, 0.00, '2023-06-08 01:33:16', '2023-06-08 01:33:16'),
(2, 1, 2, 0.00, 0.00, '2023-06-08 01:33:16', '2023-06-08 01:33:16'),
(3, 1, 3, 0.00, 0.00, '2023-06-08 01:33:16', '2023-06-08 01:33:16'),
(4, 1, 4, 0.00, 0.00, '2023-06-08 01:33:16', '2023-06-08 01:33:16'),
(5, 1, 5, 0.00, 0.00, '2023-06-08 01:33:16', '2023-06-08 01:33:16'),
(6, 1, 6, 0.00, 0.00, '2023-06-08 01:33:16', '2023-06-08 01:33:16'),
(7, 1, 7, 0.00, 0.00, '2023-06-08 01:33:16', '2023-06-08 01:33:16'),
(8, 1, 8, 0.00, 0.00, '2023-06-08 01:33:16', '2023-06-08 01:33:16');

-- --------------------------------------------------------

--
-- Table structure for table `bar_jas_h_p_s`
--

CREATE TABLE `bar_jas_h_p_s` (
  `id` bigint UNSIGNED NOT NULL,
  `id_hps` bigint UNSIGNED NOT NULL,
  `id_barjas` bigint UNSIGNED NOT NULL,
  `harga_satuan` decimal(10,2) NOT NULL,
  `jumlah` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bar_jas_h_p_s`
--

INSERT INTO `bar_jas_h_p_s` (`id`, `id_hps`, `id_barjas`, `harga_satuan`, `jumlah`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 5000.00, 25000.00, '2023-06-08 01:32:36', '2023-06-08 01:32:56'),
(2, 1, 2, 5000.00, 5000.00, '2023-06-08 01:32:36', '2023-06-08 01:32:56'),
(3, 1, 3, 5000.00, 5000.00, '2023-06-08 01:32:36', '2023-06-08 01:32:56'),
(4, 1, 4, 5000.00, 5000.00, '2023-06-08 01:32:36', '2023-06-08 01:32:56'),
(5, 1, 5, 5000.00, 25000.00, '2023-06-08 01:32:36', '2023-06-08 01:32:56'),
(6, 1, 6, 5000.00, 5000.00, '2023-06-08 01:32:36', '2023-06-08 01:32:56'),
(7, 1, 7, 5000.00, 5000.00, '2023-06-08 01:32:36', '2023-06-08 01:32:56'),
(8, 1, 8, 5000.00, 25000.00, '2023-06-08 01:32:36', '2023-06-08 01:32:56');

-- --------------------------------------------------------

--
-- Table structure for table `b_a_negos`
--

CREATE TABLE `b_a_negos` (
  `id` bigint UNSIGNED NOT NULL,
  `id_kontrakkerja` bigint UNSIGNED NOT NULL,
  `tandatangan_pengadaan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_tandatanganpengadaan` date DEFAULT NULL,
  `tandatangan_manager` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_tandatanganmanager` date DEFAULT NULL,
  `tandatangan_direktur` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_tandatangan` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `b_a_negos`
--

INSERT INTO `b_a_negos` (`id`, `id_kontrakkerja`, `tandatangan_pengadaan`, `tanggal_tandatanganpengadaan`, `tandatangan_manager`, `tanggal_tandatanganmanager`, `tandatangan_direktur`, `tanggal_tandatangan`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-08 07:13:15', '2023-06-08 07:13:15');

-- --------------------------------------------------------

--
-- Table structure for table `b_o_q_s`
--

CREATE TABLE `b_o_q_s` (
  `id` bigint UNSIGNED NOT NULL,
  `id_kontrakkerja` bigint UNSIGNED NOT NULL,
  `total_jumlah` int NOT NULL DEFAULT '0',
  `dibulatkan` int NOT NULL DEFAULT '0',
  `ppn11` int NOT NULL DEFAULT '0',
  `total_harga` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tandatangan_direktur` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_tandatangan` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `b_o_q_s`
--

INSERT INTO `b_o_q_s` (`id`, `id_kontrakkerja`, `total_jumlah`, `dibulatkan`, `ppn11`, `total_harga`, `created_at`, `updated_at`, `tandatangan_direktur`, `tanggal_tandatangan`) VALUES
(1, 1, 0, 0, 0, 0, '2023-06-08 01:33:16', '2023-06-08 01:33:16', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `datapengalamen`
--

CREATE TABLE `datapengalamen` (
  `id` bigint UNSIGNED NOT NULL,
  `id_dokumen` bigint UNSIGNED NOT NULL,
  `id_vendor` bigint UNSIGNED NOT NULL,
  `kota_surat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_surat` date DEFAULT NULL,
  `nama_perusahaan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_jelas` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jabatan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `datapengalamen`
--

INSERT INTO `datapengalamen` (`id`, `id_dokumen`, `id_vendor`, `kota_surat`, `tanggal_surat`, `nama_perusahaan`, `nama_jelas`, `jabatan`, `created_at`, `updated_at`) VALUES
(1, 8, 1, NULL, NULL, NULL, NULL, NULL, '2023-06-08 07:01:45', '2023-06-08 07:01:45');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `form_penawaran_harga`
--

CREATE TABLE `form_penawaran_harga` (
  `id` bigint UNSIGNED NOT NULL,
  `id_dokumen` bigint UNSIGNED NOT NULL,
  `kopsurat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kopsuratpath` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'dokumenvendor/kopsurat',
  `nomor` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lampiran` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_kota` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_pembuatan_surat` date DEFAULT NULL,
  `nama_vendor` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jabatan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_perusahaan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `atas_nama` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat_perusahaan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telepon_fax` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_perusahaan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `harga_penawaran` decimal(10,2) DEFAULT NULL,
  `ppn11` decimal(10,2) DEFAULT NULL,
  `jumlah_harga` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `form_penawaran_harga`
--

INSERT INTO `form_penawaran_harga` (`id`, `id_dokumen`, `kopsurat`, `kopsuratpath`, `nomor`, `lampiran`, `nama_kota`, `tanggal_pembuatan_surat`, `nama_vendor`, `jabatan`, `nama_perusahaan`, `atas_nama`, `alamat_perusahaan`, `telepon_fax`, `email_perusahaan`, `harga_penawaran`, `ppn11`, `jumlah_harga`, `created_at`, `updated_at`) VALUES
(1, 2, '6481b859cbaba_20230608.png', 'dokumenvendor/kopsurat', 'Officia quibusdam re', 'Officiis nihil aliqu', 'In et quibusdam magn', '2010-06-09', 'Lorem molestiae duis', 'Officiis fugiat vol', 'Omnis sed architecto', 'Aliqua Commodi nece', 'Ut dolores incididun', '+1 (717) 661-8599', 'wicarete@mailinator.com', 5.00, 50.00, 50.00, '2023-06-08 01:51:54', '2023-06-08 04:15:37'),
(2, 3, NULL, 'dokumenvendor/kopsurat', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-08 04:39:18', '2023-06-08 04:39:18');

-- --------------------------------------------------------

--
-- Table structure for table `h_p_s`
--

CREATE TABLE `h_p_s` (
  `id` bigint UNSIGNED NOT NULL,
  `id_kontrakkerja` bigint UNSIGNED NOT NULL,
  `total_jumlah` int NOT NULL DEFAULT '0',
  `dibulatkan` int NOT NULL DEFAULT '0',
  `rok10` int NOT NULL DEFAULT '0',
  `ppn11` int NOT NULL DEFAULT '0',
  `total_harga` int NOT NULL DEFAULT '0',
  `tandatangan_pengadaan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_tandatangan_pengadaan` datetime DEFAULT NULL,
  `tandatangan_manager` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_tandatangan_manager` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `h_p_s`
--

INSERT INTO `h_p_s` (`id`, `id_kontrakkerja`, `total_jumlah`, `dibulatkan`, `rok10`, `ppn11`, `total_harga`, `tandatangan_pengadaan`, `tanggal_tandatangan_pengadaan`, `tandatangan_manager`, `tanggal_tandatangan_manager`, `created_at`, `updated_at`) VALUES
(1, 1, 100000, 100000, 10000, 12100, 122100, 'ABC123', '2023-06-08 08:33:29', NULL, NULL, '2023-06-08 01:32:36', '2023-06-08 01:33:29');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_dokumen_kelengkapans`
--

CREATE TABLE `jenis_dokumen_kelengkapans` (
  `id_jenis` bigint UNSIGNED NOT NULL,
  `nama_dokumen` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_dokumen` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dokumen_sistem` enum('ya','tidak') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'tidak',
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jenis_dokumen_kelengkapans`
--

INSERT INTO `jenis_dokumen_kelengkapans` (`id_jenis`, `nama_dokumen`, `no_dokumen`, `dokumen_sistem`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 'Nomor & Tanggal Surat Penawaran\n            ', 'nomor_tanggal_surat_penawaran_', 'ya', 'Dokumen Surat Penawaran', '2023-06-08 01:17:57', '2023-06-08 01:17:57'),
(2, 'Harga/Nilai Penawaran\n            ', 'harga_nilai_penawaran_', 'ya', 'Lampiran Surat Penawaran', '2023-06-08 01:17:57', '2023-06-08 01:17:57'),
(3, 'SIUP/SIUJK/SIUJPTL dengan kegiatan usaha yang sesuai untuk pengadaan ini dan masih berlaku\n            ', 'siup_siujk_siujptl_dengan_kegiatan_usaha_yang_sesuai_untuk_pengadaan_ini_dan_masih_berlaku_', 'tidak', NULL, '2023-06-08 01:17:57', '2023-06-08 01:17:57'),
(4, 'Akte Pendirian Perusahaan beserta perubahan terakhir\n            ', 'akte_pendirian_perusahaan_beserta_perubahan_terakhir_', 'tidak', NULL, '2023-06-08 01:17:57', '2023-06-08 01:17:57'),
(5, 'Keputusan MENKUMHAM \n            ', 'keputusan_menkumham_', 'tidak', NULL, '2023-06-08 01:17:57', '2023-06-08 01:17:57'),
(6, 'Nomor Pokok Wajib Pajak (NPWP) Perusahaan\n            ', 'nomor_pokok_wajib_pajak_npwp_perusahaan_', 'tidak', NULL, '2023-06-08 01:17:57', '2023-06-08 01:17:57'),
(7, 'Ijin Gangguan/SITU/Surat Domisili/Izin Lokasi\n            ', 'ijin_gangguan_situ_surat_domisili_izin_lokasi_', 'tidak', NULL, '2023-06-08 01:17:57', '2023-06-08 01:17:57'),
(8, 'Surat Tanda Daftar Perusahaan (TDP) atau Nomor Induk Berusaha (NIB)\n\n            ', 'surat_tanda_daftar_perusahaan_tdp_atau_nomor_induk_berusaha_nib_', 'tidak', NULL, '2023-06-08 01:17:57', '2023-06-08 01:17:57'),
(9, 'Pakta Integritas\n            ', 'pakta_integritas_', 'ya', NULL, '2023-06-08 01:17:57', '2023-06-08 01:17:57'),
(10, 'Surat Pernyataan Sanggup Menyelesaikan Pekerjaan Dengan Baik;', 'surat_pernyataan_sanggup_menyelesaikan_pekerjaan_dengan_baik_', 'ya', NULL, '2023-06-08 01:17:57', '2023-06-08 01:17:57'),
(11, 'Surat Pernyataan Garansi Pekerjaan\n            ', 'surat_pernyataan_garansi_pekerjaan_', 'ya', NULL, '2023-06-08 01:17:57', '2023-06-08 01:17:57'),
(12, 'Memiliki Pengalaman Pengadaan sejenis dibuktikan dengan Salinan Kontrak/SPK\n            ', 'memiliki_pengalaman_pengadaan_sejenis_dibuktikan_dengan_salinan_kontrak_spk_', 'ya', NULL, '2023-06-08 01:17:57', '2023-06-08 01:17:57'),
(13, 'Memiliki kemampuan menyediakan fasilitas berupa peralatan yang diperlukan untuk pelaksanaan pekerjaan\n            ', 'memiliki_kemampuan_menyediakan_fasilitas_berupa_peralatan_yang_diperlukan_untuk_pelaksanaan_pekerjaan_', 'tidak', NULL, '2023-06-08 01:17:57', '2023-06-08 01:17:57'),
(14, 'Dokumen HIRARC (Hazard Identification Risk Assessment And Risk Control) Dan JSA (Job Safety Analysist)\n            ', 'dokumen_hirarc_hazard_identification_risk_assessment_and_risk_control_dan_jsa_job_safety_analysist_', 'tidak', NULL, '2023-06-08 01:17:57', '2023-06-08 01:17:57'),
(15, 'Surat Pernyataan Penerapan K3L\n            ', 'surat_pernyataan_penerapan_k3l_', 'tidak', NULL, '2023-06-08 01:17:57', '2023-06-08 01:17:57'),
(16, 'Neraca/Laporan keuangan Perusahaan terakhir yang memuat laporan laba rugi\n            ', 'neraca_laporan_keuangan_perusahaan_terakhir_yang_memuat_laporan_laba_rugi_', 'ya', NULL, '2023-06-08 01:17:57', '2023-06-08 01:17:57'),
(17, 'Tanda Terima penyampaian Surat Pajak Tahunan (SPT) Pajak Penghasilan (PPh) tahun terkahir, dan Surat Setoran Pajak (SSP) PPh,    Pasal 21 atau Pajak Pertambahan Nilai (PPN) sekurang-kurangnya 3 (tiga) bulan terakhir\n            ', 'tanda_terima_penyampaian_surat_pajak_tahunan_spt_pajak_penghasilan_pph_tahun_terkahir_dan_surat_setoran_pajak_ssp_pph_pasal_21_atau_pajak_pertambahan_nilai_ppn_sekurang_kurangnya_3_tiga_bulan_terakhir_', 'tidak', NULL, '2023-06-08 01:17:57', '2023-06-08 01:17:57'),
(18, 'Dokumen penunjang lainnya \n            ', 'dokumen_penunjang_lainnya_', 'tidak', NULL, '2023-06-08 01:17:57', '2023-06-08 01:17:57');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_kontrak`
--

CREATE TABLE `jenis_kontrak` (
  `id` bigint UNSIGNED NOT NULL,
  `id_kontrak` bigint UNSIGNED NOT NULL,
  `nama_jenis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jenis_kontrak`
--

INSERT INTO `jenis_kontrak` (`id`, `id_kontrak`, `nama_jenis`, `created_at`, `updated_at`) VALUES
(1, 1, 'PENGADAAN MATERIAL', '2023-06-08 01:32:27', '2023-06-08 01:32:27'),
(2, 1, 'PEKERJAAN JASA', '2023-06-08 01:32:27', '2023-06-08 01:32:27');

-- --------------------------------------------------------

--
-- Table structure for table `kelengkapan_dokumen_vendors`
--

CREATE TABLE `kelengkapan_dokumen_vendors` (
  `id_dokumen` bigint UNSIGNED NOT NULL,
  `id_jenis_dokumen` bigint UNSIGNED NOT NULL,
  `id_vendor` bigint UNSIGNED NOT NULL,
  `id_kontrakkerja` bigint UNSIGNED DEFAULT NULL,
  `file_upload` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tandatangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `data_dokumen` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kelengkapan_dokumen_vendors`
--

INSERT INTO `kelengkapan_dokumen_vendors` (`id_dokumen`, `id_jenis_dokumen`, `id_vendor`, `id_kontrakkerja`, `file_upload`, `tandatangan`, `data_dokumen`, `created_at`, `updated_at`) VALUES
(2, 1, 1, 1, '1686232188_1686149785_LSPK_1683595789.pdf', 'GHI789', NULL, '2023-06-08 01:34:02', '2023-06-08 06:49:48'),
(3, 1, 1, NULL, NULL, NULL, NULL, '2023-06-08 04:39:18', '2023-06-08 04:39:18'),
(4, 2, 1, 1, '1686232708_Ekstensi-Batch-2-230321_compressed.pdf', 'GHI789', NULL, '2023-06-08 06:50:03', '2023-06-08 06:58:28'),
(5, 9, 1, 1, '1686232782_LSPK_1683595789.pdf', 'GHI789', NULL, '2023-06-08 06:59:21', '2023-06-08 06:59:42'),
(6, 11, 1, 1, NULL, NULL, NULL, '2023-06-08 07:01:12', '2023-06-08 07:01:12'),
(7, 10, 1, 1, NULL, NULL, NULL, '2023-06-08 07:01:39', '2023-06-08 07:01:39'),
(8, 12, 1, 1, NULL, NULL, NULL, '2023-06-08 07:01:45', '2023-06-08 07:01:45');

-- --------------------------------------------------------

--
-- Table structure for table `kontrak_kerjas`
--

CREATE TABLE `kontrak_kerjas` (
  `id_kontrakkerja` bigint UNSIGNED NOT NULL,
  `nama_kontrak` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_vendor` bigint UNSIGNED NOT NULL,
  `tanggal_spmk` date DEFAULT NULL,
  `no_spmk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_kontrak` date DEFAULT NULL,
  `tanggal_pekerjaan` date DEFAULT NULL,
  `tanggal_akhir_pekerjaan` date DEFAULT NULL,
  `lokasi_pekerjaan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_urut` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_masalah` enum('DAN.01.01','DAN.01.02','DAN.01.03') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Dokumen Input Pengadaan Tahap 1','Validasi Dokumen Pengadaan Tahap 1','Dokumen Input Vendor','Dokumen Input Pengadaan Tahap 2','Validasi Dokumen Pengadaan Tahap 2','Tanda Tangan Vendor','Kontrak dibatalkan','Kontrak disetujui','Tanda Tangan Manager','Kontrak Kerja Berjalan') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kontrak_kerjas`
--

INSERT INTO `kontrak_kerjas` (`id_kontrakkerja`, `nama_kontrak`, `id_vendor`, `tanggal_spmk`, `no_spmk`, `tanggal_kontrak`, `tanggal_pekerjaan`, `tanggal_akhir_pekerjaan`, `lokasi_pekerjaan`, `no_urut`, `tahun`, `kode_masalah`, `status`, `created_at`, `updated_at`) VALUES
(1, 'PEKERJAAN PENGADAAN DAN JASA INSTALASI KWH METER ENGINE PLTU JEMBER', 2, NULL, NULL, '2022-12-30', '2022-12-30', '2023-04-29', 'PLTU JEMBER', '111', '2022', 'DAN.01.03', 'Dokumen Input Pengadaan Tahap 2', '2023-06-08 01:32:27', '2023-06-08 07:08:17');

-- --------------------------------------------------------

--
-- Table structure for table `lampiranpenawaranhargas`
--

CREATE TABLE `lampiranpenawaranhargas` (
  `id` bigint UNSIGNED NOT NULL,
  `id_dokumen` bigint UNSIGNED NOT NULL,
  `kopsurat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kopsuratpath` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'dokumenvendor/kopsurat',
  `total_jumlah` int NOT NULL DEFAULT '0',
  `dibulatkan` int NOT NULL DEFAULT '0',
  `ppn11` int NOT NULL DEFAULT '0',
  `total_harga` int NOT NULL DEFAULT '0',
  `datalampiran` json DEFAULT NULL,
  `kota_surat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_surat` date DEFAULT NULL,
  `nama_perusahaan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `direktur` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lampiranpenawaranhargas`
--

INSERT INTO `lampiranpenawaranhargas` (`id`, `id_dokumen`, `kopsurat`, `kopsuratpath`, `total_jumlah`, `dibulatkan`, `ppn11`, `total_harga`, `datalampiran`, `kota_surat`, `tanggal_surat`, `nama_perusahaan`, `direktur`, `created_at`, `updated_at`) VALUES
(1, 4, NULL, 'dokumenvendor/kopsurat', 120000, 120000, 13200, 133200, '[{\"jumlah\": \"30000\", \"id_barjas\": 1, \"harga_satuan\": \"6000\"}, {\"jumlah\": \"6000\", \"id_barjas\": 2, \"harga_satuan\": \"6000\"}, {\"jumlah\": \"6000\", \"id_barjas\": 3, \"harga_satuan\": \"6000\"}, {\"jumlah\": \"6000\", \"id_barjas\": 4, \"harga_satuan\": \"6000\"}, {\"jumlah\": \"30000\", \"id_barjas\": 5, \"harga_satuan\": \"6000\"}, {\"jumlah\": \"6000\", \"id_barjas\": 6, \"harga_satuan\": \"6000\"}, {\"jumlah\": \"6000\", \"id_barjas\": 7, \"harga_satuan\": \"6000\"}, {\"jumlah\": \"30000\", \"id_barjas\": 8, \"harga_satuan\": \"6000\"}]', 'Madiun', '2022-12-12', NULL, NULL, '2023-06-08 06:57:20', '2023-06-08 06:58:07');

-- --------------------------------------------------------

--
-- Table structure for table `lamp_negos`
--

CREATE TABLE `lamp_negos` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `l_s_p_k_s`
--

CREATE TABLE `l_s_p_k_s` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(4, '2023_04_12_234156_create_pegawais_table', 1),
(5, '2023_04_12_234227_create_vendors_table', 1),
(6, '2023_04_13_000000_create_users_table', 1),
(7, '2023_04_15_071107_create_jenis_dokumen_kelengkapans_table', 1),
(8, '2023_04_18_035210_create_kontrak_kerjas_table', 1),
(9, '2023_04_18_035212_create_kelengkapan_dokumen_vendors_table', 1),
(10, '2023_04_18_043751_add_foreignkey_to_kontrak_kerjas_table', 1),
(11, '2023_04_25_132822_create_sumber_anggarans_table', 1),
(12, '2023_04_25_133341_create_penyelenggaras_table', 1),
(13, '2023_04_25_133403_create_pembuatan_surat_kontraks_table', 1),
(14, '2023_05_02_144115_create_tanda_tangans_table', 1),
(15, '2023_05_13_070203_create_jenis_kontraks_table', 1),
(16, '2023_05_13_070225_create_bar_jas_table', 1),
(17, '2023_05_13_070239_create_sub_barjas_table', 1),
(18, '2023_05_16_122243_create_h_p_s_table', 1),
(19, '2023_05_16_125302_create_bar_jas_h_p_s_table', 1),
(20, '2023_05_17_151830_create_b_o_q_s_table', 1),
(21, '2023_05_17_151939_create_bar_jas_b_o_q_s_table', 1),
(22, '2023_05_19_083211_create_u_n_d_s_table', 1),
(23, '2023_05_19_084845_create_r_k_s_table', 1),
(24, '2023_05_19_161255_create_lamp_negos_table', 1),
(25, '2023_05_19_161306_create_b_a_negos_table', 1),
(26, '2023_05_19_161329_create_l_s_p_k_s_table', 1),
(27, '2023_05_19_161335_create_s_p_k_b_j_s_table', 1),
(28, '2023_05_23_190606_create_form_penawaran_hargas_table', 1),
(29, '2023_06_05_135505_create_lampiranpenawaranhargas_table', 1),
(30, '2023_06_06_053338_create_paktavendors_table', 1),
(31, '2023_06_06_130047_create_pernyataan_kesanggupans_table', 1),
(32, '2023_06_06_133119_create_pernyataangaransis_table', 1),
(33, '2023_06_06_135046_create_neracas_table', 1),
(34, '2023_06_06_145201_create_datapengalamen_table', 1),
(35, '2023_06_07_014332_create_subdatapengalamen_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `neracas`
--

CREATE TABLE `neracas` (
  `id` bigint UNSIGNED NOT NULL,
  `id_dokumen` bigint UNSIGNED NOT NULL,
  `tanggal_neraca` date DEFAULT NULL,
  `aktiva_lancar` decimal(10,2) DEFAULT NULL,
  `utang_jangka_pendek` decimal(10,2) DEFAULT NULL,
  `kas` decimal(10,2) DEFAULT NULL,
  `utang_dagang` decimal(10,2) DEFAULT NULL,
  `utang_pajak` decimal(10,2) DEFAULT NULL,
  `piutang` decimal(10,2) DEFAULT NULL,
  `persediaan_barang` decimal(10,2) DEFAULT NULL,
  `pekerjaan_dalam_proses` decimal(10,2) DEFAULT NULL,
  `aktiva_tetap` decimal(10,2) DEFAULT NULL,
  `kekayaan_bersih` decimal(10,2) DEFAULT NULL,
  `peralatan_dan_mesin_1` decimal(10,2) DEFAULT NULL,
  `peralatan_dan_mesin_2` decimal(10,2) DEFAULT NULL,
  `inventaris` decimal(10,2) DEFAULT NULL,
  `gedung_gedung` decimal(10,2) DEFAULT NULL,
  `jumlah_a_b` decimal(10,2) DEFAULT NULL,
  `jumlah_d` decimal(10,2) DEFAULT NULL,
  `piutang_jangka_pendek_sampai_6_bulan` decimal(10,2) DEFAULT NULL,
  `piutang_jangka_pendek_lebih_dari_6_bulan` decimal(10,2) DEFAULT NULL,
  `jumlah` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `paktavendors`
--

CREATE TABLE `paktavendors` (
  `id` bigint UNSIGNED NOT NULL,
  `id_dokumen` bigint UNSIGNED NOT NULL,
  `pekerjaan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tahun_anggaran` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jabatan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_perusahaan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `atas_nama` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telepon_fax` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_perusahaan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kota_surat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_surat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `paktavendors`
--

INSERT INTO `paktavendors` (`id`, `id_dokumen`, `pekerjaan`, `tahun_anggaran`, `nama`, `jabatan`, `nama_perusahaan`, `atas_nama`, `alamat`, `telepon_fax`, `email_perusahaan`, `kota_surat`, `tanggal_surat`, `created_at`, `updated_at`) VALUES
(1, 5, 'Aspernatur culpa mo', 'Consequatur asperna', 'Sed omnis do volupta', 'Sit enim velit dict', 'Praesentium aliquip', 'Eos minim aut minima', 'Unde ea maiores qui', '+1 (944) 836-8472', 'zekawoc@mailinator.com', NULL, NULL, '2023-06-08 06:59:21', '2023-06-08 06:59:25');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pegawais`
--

CREATE TABLE `pegawais` (
  `id_pegawai` bigint UNSIGNED NOT NULL,
  `nama_pegawai` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomor_jabatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pegawais`
--

INSERT INTO `pegawais` (`id_pegawai`, `nama_pegawai`, `jabatan`, `nomor_jabatan`, `created_at`, `updated_at`) VALUES
(1, 'John Doe', 'Pengadaan', '12345', '2023-06-08 01:17:57', '2023-06-08 01:17:57'),
(2, 'Jane Doe', 'Manager', '67890', '2023-06-08 01:17:57', '2023-06-08 01:17:57');

-- --------------------------------------------------------

--
-- Table structure for table `pembuatan_surat_kontraks`
--

CREATE TABLE `pembuatan_surat_kontraks` (
  `id` bigint UNSIGNED NOT NULL,
  `id_kontrakkerja` bigint UNSIGNED NOT NULL,
  `nama_surat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_surat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_pembuatan` date NOT NULL,
  `datasurat` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pembuatan_surat_kontraks`
--

INSERT INTO `pembuatan_surat_kontraks` (`id`, `id_kontrakkerja`, `nama_surat`, `no_surat`, `tanggal_pembuatan`, `datasurat`, `created_at`, `updated_at`) VALUES
(1, 1, 'nomor_rks', '111.RKS/DAN.01.03/200900/2022', '2022-12-26', NULL, '2023-06-08 01:32:27', '2023-06-08 01:32:27'),
(2, 1, 'nomor_hps', '111.HPS/DAN.01.03/UPKTIMOR/2022', '2022-12-26', NULL, '2023-06-08 01:32:27', '2023-06-08 01:32:27'),
(3, 1, 'nomor_pakta_pejabat', '111.PI/DAN.01.03/UPKTIMOR/2022', '2022-12-26', NULL, '2023-06-08 01:32:27', '2023-06-08 01:32:27'),
(4, 1, 'nomor_pakta_pengguna', '111.UND/DAN.01.03/200900/2022', '2022-12-26', NULL, '2023-06-08 01:32:27', '2023-06-08 01:32:27'),
(5, 1, 'nomor_undangan', '111.PI/DAN.01.03/M-UPKTIMOR/2022', '2022-12-26', NULL, '2023-06-08 01:32:27', '2023-06-08 01:32:27'),
(6, 1, 'batas_akhir_dokumen_penawaran', NULL, '2022-12-28', NULL, '2023-06-08 01:32:27', '2023-06-08 01:32:27'),
(7, 1, 'nomor_ba_buka', '111.BA-PEMB/DAN.01.03/200900/2022', '2022-12-29', NULL, '2023-06-08 01:32:27', '2023-06-08 01:32:27'),
(8, 1, 'nomor_ba_evaluasi', '111.BA-EVA/DAN.01.03/200900/2022', '2022-12-29', NULL, '2023-06-08 01:32:27', '2023-06-08 01:32:27'),
(9, 1, 'nomor_ba_negosiasi', '111.BA-NEG/DAN.01.03/200900/2022', '2022-12-30', NULL, '2023-06-08 01:32:27', '2023-06-08 01:32:27'),
(10, 1, 'nomor_ba_hasil_pl', '111.BA-HPL/DAN.01.03/200900/2022', '2022-12-30', NULL, '2023-06-08 01:32:27', '2023-06-08 01:32:27'),
(11, 1, 'nomor_spk', '111.SPK/DAN.01.03/200900/2022', '2022-12-30', NULL, '2023-06-08 01:32:27', '2023-06-08 01:32:27');

-- --------------------------------------------------------

--
-- Table structure for table `penyelenggaras`
--

CREATE TABLE `penyelenggaras` (
  `id_penyelenggara` bigint UNSIGNED NOT NULL,
  `id_kontrakkerja` bigint UNSIGNED NOT NULL,
  `nama_jabatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_pengguna` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penyelenggaras`
--

INSERT INTO `penyelenggaras` (`id_penyelenggara`, `id_kontrakkerja`, `nama_jabatan`, `nama_pengguna`, `created_at`, `updated_at`) VALUES
(1, 1, 'manager', 'SELAMET DUNIA AKHIRAT', '2023-06-08 01:32:27', '2023-06-08 01:32:27'),
(2, 1, 'pejabat_pelaksana_pengadaan', 'UNTUNG DAN BERKAH', '2023-06-08 01:32:27', '2023-06-08 01:32:27'),
(3, 1, 'direksi', 'MANAGER BAGIAN OPERASI DAN PEMELIHARAAN PEMBANGKIT', '2023-06-08 01:32:27', '2023-06-08 01:32:27'),
(4, 1, 'pengawas_pekerjaan', 'SPV. RENDAL JOM PLTMG PANAF', '2023-06-08 01:32:27', '2023-06-08 01:32:27'),
(5, 1, 'pengawas_k3', 'PEJABAT PELAKSANA K3L & KEAMANAN UPK TIMOR', '2023-06-08 01:32:27', '2023-06-08 01:32:27'),
(6, 1, 'pengawas_lapangan', '..................................................................................................', '2023-06-08 01:32:27', '2023-06-08 01:32:27');

-- --------------------------------------------------------

--
-- Table structure for table `pernyataangaransis`
--

CREATE TABLE `pernyataangaransis` (
  `id_dokumen` bigint UNSIGNED NOT NULL,
  `pekerjaan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tahun_anggaran` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jabatan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_perusahaan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `atas_nama` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telepon_fax` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_perusahaan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_pekerjaan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_rks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_rks` date DEFAULT NULL,
  `kota_surat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_surat` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pernyataangaransis`
--

INSERT INTO `pernyataangaransis` (`id_dokumen`, `pekerjaan`, `tahun_anggaran`, `nama`, `jabatan`, `nama_perusahaan`, `atas_nama`, `alamat`, `telepon_fax`, `email_perusahaan`, `nama_pekerjaan`, `no_rks`, `tanggal_rks`, `kota_surat`, `tanggal_surat`, `created_at`, `updated_at`) VALUES
(6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-08 07:01:12', '2023-06-08 07:01:12');

-- --------------------------------------------------------

--
-- Table structure for table `pernyataan_kesanggupans`
--

CREATE TABLE `pernyataan_kesanggupans` (
  `id` bigint UNSIGNED NOT NULL,
  `id_dokumen` bigint UNSIGNED NOT NULL,
  `pekerjaan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tahun_anggaran` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jabatan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_perusahaan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `atas_nama` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telepon_fax` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_perusahaan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pernyataan_kesanggupans`
--

INSERT INTO `pernyataan_kesanggupans` (`id`, `id_dokumen`, `pekerjaan`, `tahun_anggaran`, `nama`, `jabatan`, `nama_perusahaan`, `atas_nama`, `alamat`, `telepon_fax`, `email_perusahaan`, `created_at`, `updated_at`) VALUES
(1, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-08 07:01:39', '2023-06-08 07:01:39');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `r_k_s`
--

CREATE TABLE `r_k_s` (
  `id` bigint UNSIGNED NOT NULL,
  `id_kontrakkerja` bigint UNSIGNED NOT NULL,
  `datarks` json DEFAULT NULL,
  `tandatangan_pengadaan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_tandatangan_pengadaan` datetime DEFAULT NULL,
  `tandatangan_manager` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_tandatangan_manager` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `r_k_s`
--

INSERT INTO `r_k_s` (`id`, `id_kontrakkerja`, `datarks`, `tandatangan_pengadaan`, `tanggal_tandatangan_pengadaan`, `tandatangan_manager`, `tanggal_tandatangan_manager`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'ABC123', '2023-06-08 15:33:33', NULL, NULL, '2023-06-08 01:33:06', '2023-06-08 01:33:33');

-- --------------------------------------------------------

--
-- Table structure for table `subdatapengalamen`
--

CREATE TABLE `subdatapengalamen` (
  `id` bigint UNSIGNED NOT NULL,
  `id_datapengalaman` bigint UNSIGNED NOT NULL,
  `bidang_pekerjaan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_bidang_pekerjaan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lokasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_pemberi_tugas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat_pemberi_tugas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_tanggal_kontrak` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nilai` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kontrak` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ba_serah_terima` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sub_barjas`
--

CREATE TABLE `sub_barjas` (
  `id` bigint UNSIGNED NOT NULL,
  `id_barjas` bigint UNSIGNED NOT NULL,
  `uraian` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `volume` double(10,2) NOT NULL,
  `satuan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_barjas`
--

INSERT INTO `sub_barjas` (`id`, `id_barjas`, `uraian`, `volume`, `satuan`, `created_at`, `updated_at`) VALUES
(1, 3, '- Cable NYAF 4 mm (150 m)', 150.00, ' m ', '2023-06-08 01:32:27', '2023-06-08 01:32:27'),
(2, 3, '- Cable NYAF 2.5 mm (150 m)', 150.00, ' m ', '2023-06-08 01:32:27', '2023-06-08 01:32:27'),
(3, 3, '- Cable lug cooper 4 mm', 100.00, ' pcs ', '2023-06-08 01:32:27', '2023-06-08 01:32:27'),
(4, 3, '- Cable lug cooper 2.5 mm', 50.00, ' pcs ', '2023-06-08 01:32:27', '2023-06-08 01:32:27');

-- --------------------------------------------------------

--
-- Table structure for table `sumber_anggarans`
--

CREATE TABLE `sumber_anggarans` (
  `id` bigint UNSIGNED NOT NULL,
  `id_kontrakkerja` bigint UNSIGNED NOT NULL,
  `skk_ao` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_anggaran` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sumber_anggarans`
--

INSERT INTO `sumber_anggarans` (`id`, `id_kontrakkerja`, `skk_ao`, `tanggal_anggaran`, `created_at`, `updated_at`) VALUES
(1, 1, '001/OPKIT/C20000000/2022', '2022-03-10', '2023-06-08 01:32:27', '2023-06-08 01:32:27');

-- --------------------------------------------------------

--
-- Table structure for table `s_p_k_b_j_s`
--

CREATE TABLE `s_p_k_b_j_s` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tanda_tangans`
--

CREATE TABLE `tanda_tangans` (
  `id` bigint UNSIGNED NOT NULL,
  `kode_unik` text COLLATE utf8mb4_unicode_ci,
  `id_akun` bigint UNSIGNED NOT NULL,
  `tandatangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.png',
  `save_file_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'tandatangan',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tanda_tangans`
--

INSERT INTO `tanda_tangans` (`id`, `kode_unik`, `id_akun`, `tandatangan`, `save_file_path`, `created_at`, `updated_at`) VALUES
(1, 'ABC123', 1, 'default.png', 'tandatangan', '2023-06-08 01:17:57', '2023-06-08 01:17:57'),
(2, 'DEF456', 2, 'default.png', 'tandatangan', '2023-06-08 01:17:57', '2023-06-08 01:17:57'),
(3, 'GHI789', 3, 'default.png', 'tandatangan', '2023-06-08 01:17:57', '2023-06-08 01:17:57');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendor_id` bigint UNSIGNED DEFAULT NULL,
  `pegawai_id` bigint UNSIGNED DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture_profile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.jpg',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `vendor_id`, `pegawai_id`, `email_verified_at`, `password`, `role`, `picture_profile`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'John Doe', 'pengadaan@example.com', NULL, 1, NULL, '$2y$10$SkSXoPnd3qi.oRHu0J3VA.hZinI2djNKG8dl.KvYwv4F5pwAhz5ge', 'pengadaan', 'default.jpg', NULL, '2023-06-08 01:17:57', '2023-06-08 01:17:57'),
(2, 'Jane Doe', 'manager@example.com', NULL, 2, NULL, '$2y$10$7wUyQnJWdnTA.htyQh9ymu79zl16YS.aJP8s/WZY9/H/0jCEBP70G', 'manager', 'default.jpg', NULL, '2023-06-08 01:17:57', '2023-06-08 01:17:57'),
(3, 'Bob Smith', 'vendor@example.com', 1, NULL, NULL, '$2y$10$7euDNLduMFzN.9mU6igRZunI2ko5P7zgGeCba6Y8J91EXzXBBIqCW', 'vendor', 'default.jpg', NULL, '2023-06-08 01:17:57', '2023-06-08 01:17:57');

-- --------------------------------------------------------

--
-- Table structure for table `u_n_d_s`
--

CREATE TABLE `u_n_d_s` (
  `id` bigint UNSIGNED NOT NULL,
  `id_kontrakkerja` bigint UNSIGNED NOT NULL,
  `tandatangan_pengadaan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_tandatangan_pengadaan` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `u_n_d_s`
--

INSERT INTO `u_n_d_s` (`id`, `id_kontrakkerja`, `tandatangan_pengadaan`, `tanggal_tandatangan_pengadaan`, `created_at`, `updated_at`) VALUES
(1, 1, 'ABC123', '2023-06-08 15:33:37', '2023-06-08 01:33:01', '2023-06-08 01:33:37');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `id_vendor` bigint UNSIGNED NOT NULL,
  `penyedia` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direktur` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat_jalan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat_kota` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat_provinsi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomor_rek` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telepon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `faksimili` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_perusahaan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`id_vendor`, `penyedia`, `direktur`, `alamat_jalan`, `alamat_kota`, `alamat_provinsi`, `bank`, `nomor_rek`, `telepon`, `website`, `faksimili`, `email_perusahaan`, `created_at`, `updated_at`) VALUES
(1, 'PT. ABC', 'John Doe', 'Jl. Sudirman No. 1', 'Jakarta', 'DKI Jakarta', 'Bank XYZ', '1234567890', '(021) 1234567', 'http://www.ptabc.com', '(021) 1234568', 'info@ptabc.com', '2023-06-08 01:17:57', '2023-06-08 01:17:57'),
(2, 'PT. MULTI INAR BANGUNAN', 'BUDI SUSANTI', 'Jalan Simpang kepuh No 199', 'Surabaya', 'Jawa Timur', 'BANK MANDIRI', '14211111111', NULL, NULL, NULL, NULL, '2023-06-08 01:32:27', '2023-06-08 01:32:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bar_jas`
--
ALTER TABLE `bar_jas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bar_jas_id_jenis_kontrak_foreign` (`id_jenis_kontrak`);

--
-- Indexes for table `bar_jas_b_o_q_s`
--
ALTER TABLE `bar_jas_b_o_q_s`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bar_jas_b_o_q_s_id_barjas_foreign` (`id_barjas`),
  ADD KEY `bar_jas_b_o_q_s_id_boq_foreign` (`id_boq`);

--
-- Indexes for table `bar_jas_h_p_s`
--
ALTER TABLE `bar_jas_h_p_s`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bar_jas_h_p_s_id_barjas_foreign` (`id_barjas`),
  ADD KEY `bar_jas_h_p_s_id_hps_foreign` (`id_hps`);

--
-- Indexes for table `b_a_negos`
--
ALTER TABLE `b_a_negos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `b_a_negos_id_kontrakkerja_foreign` (`id_kontrakkerja`);

--
-- Indexes for table `b_o_q_s`
--
ALTER TABLE `b_o_q_s`
  ADD PRIMARY KEY (`id`),
  ADD KEY `b_o_q_s_id_kontrakkerja_foreign` (`id_kontrakkerja`);

--
-- Indexes for table `datapengalamen`
--
ALTER TABLE `datapengalamen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `datapengalamen_id_dokumen_foreign` (`id_dokumen`),
  ADD KEY `datapengalamen_id_vendor_foreign` (`id_vendor`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `form_penawaran_harga`
--
ALTER TABLE `form_penawaran_harga`
  ADD PRIMARY KEY (`id`),
  ADD KEY `form_penawaran_harga_id_dokumen_foreign` (`id_dokumen`);

--
-- Indexes for table `h_p_s`
--
ALTER TABLE `h_p_s`
  ADD PRIMARY KEY (`id`),
  ADD KEY `h_p_s_id_kontrakkerja_foreign` (`id_kontrakkerja`);

--
-- Indexes for table `jenis_dokumen_kelengkapans`
--
ALTER TABLE `jenis_dokumen_kelengkapans`
  ADD PRIMARY KEY (`id_jenis`),
  ADD UNIQUE KEY `jenis_dokumen_kelengkapans_no_dokumen_unique` (`no_dokumen`);

--
-- Indexes for table `jenis_kontrak`
--
ALTER TABLE `jenis_kontrak`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jenis_kontrak_id_kontrak_foreign` (`id_kontrak`);

--
-- Indexes for table `kelengkapan_dokumen_vendors`
--
ALTER TABLE `kelengkapan_dokumen_vendors`
  ADD PRIMARY KEY (`id_dokumen`),
  ADD KEY `kelengkapan_dokumen_vendors_id_jenis_dokumen_foreign` (`id_jenis_dokumen`),
  ADD KEY `kelengkapan_dokumen_vendors_id_vendor_foreign` (`id_vendor`),
  ADD KEY `kelengkapan_dokumen_vendors_id_kontrakkerja_foreign` (`id_kontrakkerja`);

--
-- Indexes for table `kontrak_kerjas`
--
ALTER TABLE `kontrak_kerjas`
  ADD PRIMARY KEY (`id_kontrakkerja`),
  ADD KEY `kontrak_kerjas_id_vendor_foreign` (`id_vendor`);

--
-- Indexes for table `lampiranpenawaranhargas`
--
ALTER TABLE `lampiranpenawaranhargas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lampiranpenawaranhargas_id_dokumen_foreign` (`id_dokumen`);

--
-- Indexes for table `lamp_negos`
--
ALTER TABLE `lamp_negos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `l_s_p_k_s`
--
ALTER TABLE `l_s_p_k_s`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `neracas`
--
ALTER TABLE `neracas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `neracas_id_dokumen_unique` (`id_dokumen`);

--
-- Indexes for table `paktavendors`
--
ALTER TABLE `paktavendors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `paktavendors_id_dokumen_unique` (`id_dokumen`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pegawais`
--
ALTER TABLE `pegawais`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indexes for table `pembuatan_surat_kontraks`
--
ALTER TABLE `pembuatan_surat_kontraks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pembuatan_surat_kontraks_id_kontrakkerja_foreign` (`id_kontrakkerja`);

--
-- Indexes for table `penyelenggaras`
--
ALTER TABLE `penyelenggaras`
  ADD PRIMARY KEY (`id_penyelenggara`),
  ADD KEY `penyelenggaras_id_kontrakkerja_foreign` (`id_kontrakkerja`);

--
-- Indexes for table `pernyataangaransis`
--
ALTER TABLE `pernyataangaransis`
  ADD UNIQUE KEY `pernyataangaransis_id_dokumen_unique` (`id_dokumen`);

--
-- Indexes for table `pernyataan_kesanggupans`
--
ALTER TABLE `pernyataan_kesanggupans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pernyataan_kesanggupans_id_dokumen_unique` (`id_dokumen`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `r_k_s`
--
ALTER TABLE `r_k_s`
  ADD PRIMARY KEY (`id`),
  ADD KEY `r_k_s_id_kontrakkerja_foreign` (`id_kontrakkerja`);

--
-- Indexes for table `subdatapengalamen`
--
ALTER TABLE `subdatapengalamen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subdatapengalamen_id_datapengalaman_foreign` (`id_datapengalaman`);

--
-- Indexes for table `sub_barjas`
--
ALTER TABLE `sub_barjas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_barjas_id_barjas_foreign` (`id_barjas`);

--
-- Indexes for table `sumber_anggarans`
--
ALTER TABLE `sumber_anggarans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sumber_anggarans_id_kontrakkerja_foreign` (`id_kontrakkerja`);

--
-- Indexes for table `s_p_k_b_j_s`
--
ALTER TABLE `s_p_k_b_j_s`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tanda_tangans`
--
ALTER TABLE `tanda_tangans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tanda_tangans_id_akun_foreign` (`id_akun`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_vendor_id_foreign` (`vendor_id`),
  ADD KEY `users_pegawai_id_foreign` (`pegawai_id`);

--
-- Indexes for table `u_n_d_s`
--
ALTER TABLE `u_n_d_s`
  ADD PRIMARY KEY (`id`),
  ADD KEY `u_n_d_s_id_kontrakkerja_foreign` (`id_kontrakkerja`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`id_vendor`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bar_jas`
--
ALTER TABLE `bar_jas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `bar_jas_b_o_q_s`
--
ALTER TABLE `bar_jas_b_o_q_s`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `bar_jas_h_p_s`
--
ALTER TABLE `bar_jas_h_p_s`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `b_a_negos`
--
ALTER TABLE `b_a_negos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `b_o_q_s`
--
ALTER TABLE `b_o_q_s`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `datapengalamen`
--
ALTER TABLE `datapengalamen`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `form_penawaran_harga`
--
ALTER TABLE `form_penawaran_harga`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `h_p_s`
--
ALTER TABLE `h_p_s`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jenis_dokumen_kelengkapans`
--
ALTER TABLE `jenis_dokumen_kelengkapans`
  MODIFY `id_jenis` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `jenis_kontrak`
--
ALTER TABLE `jenis_kontrak`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kelengkapan_dokumen_vendors`
--
ALTER TABLE `kelengkapan_dokumen_vendors`
  MODIFY `id_dokumen` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `kontrak_kerjas`
--
ALTER TABLE `kontrak_kerjas`
  MODIFY `id_kontrakkerja` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `lampiranpenawaranhargas`
--
ALTER TABLE `lampiranpenawaranhargas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `lamp_negos`
--
ALTER TABLE `lamp_negos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `l_s_p_k_s`
--
ALTER TABLE `l_s_p_k_s`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `neracas`
--
ALTER TABLE `neracas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `paktavendors`
--
ALTER TABLE `paktavendors`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pegawais`
--
ALTER TABLE `pegawais`
  MODIFY `id_pegawai` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pembuatan_surat_kontraks`
--
ALTER TABLE `pembuatan_surat_kontraks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `penyelenggaras`
--
ALTER TABLE `penyelenggaras`
  MODIFY `id_penyelenggara` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pernyataan_kesanggupans`
--
ALTER TABLE `pernyataan_kesanggupans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `r_k_s`
--
ALTER TABLE `r_k_s`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subdatapengalamen`
--
ALTER TABLE `subdatapengalamen`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sub_barjas`
--
ALTER TABLE `sub_barjas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sumber_anggarans`
--
ALTER TABLE `sumber_anggarans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `s_p_k_b_j_s`
--
ALTER TABLE `s_p_k_b_j_s`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tanda_tangans`
--
ALTER TABLE `tanda_tangans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `u_n_d_s`
--
ALTER TABLE `u_n_d_s`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id_vendor` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bar_jas`
--
ALTER TABLE `bar_jas`
  ADD CONSTRAINT `bar_jas_id_jenis_kontrak_foreign` FOREIGN KEY (`id_jenis_kontrak`) REFERENCES `jenis_kontrak` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `bar_jas_b_o_q_s`
--
ALTER TABLE `bar_jas_b_o_q_s`
  ADD CONSTRAINT `bar_jas_b_o_q_s_id_barjas_foreign` FOREIGN KEY (`id_barjas`) REFERENCES `bar_jas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bar_jas_b_o_q_s_id_boq_foreign` FOREIGN KEY (`id_boq`) REFERENCES `b_o_q_s` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `bar_jas_h_p_s`
--
ALTER TABLE `bar_jas_h_p_s`
  ADD CONSTRAINT `bar_jas_h_p_s_id_barjas_foreign` FOREIGN KEY (`id_barjas`) REFERENCES `bar_jas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bar_jas_h_p_s_id_hps_foreign` FOREIGN KEY (`id_hps`) REFERENCES `h_p_s` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `b_a_negos`
--
ALTER TABLE `b_a_negos`
  ADD CONSTRAINT `b_a_negos_id_kontrakkerja_foreign` FOREIGN KEY (`id_kontrakkerja`) REFERENCES `kontrak_kerjas` (`id_kontrakkerja`);

--
-- Constraints for table `b_o_q_s`
--
ALTER TABLE `b_o_q_s`
  ADD CONSTRAINT `b_o_q_s_id_kontrakkerja_foreign` FOREIGN KEY (`id_kontrakkerja`) REFERENCES `kontrak_kerjas` (`id_kontrakkerja`) ON DELETE CASCADE;

--
-- Constraints for table `datapengalamen`
--
ALTER TABLE `datapengalamen`
  ADD CONSTRAINT `datapengalamen_id_dokumen_foreign` FOREIGN KEY (`id_dokumen`) REFERENCES `kelengkapan_dokumen_vendors` (`id_dokumen`) ON DELETE CASCADE,
  ADD CONSTRAINT `datapengalamen_id_vendor_foreign` FOREIGN KEY (`id_vendor`) REFERENCES `vendors` (`id_vendor`) ON DELETE CASCADE;

--
-- Constraints for table `form_penawaran_harga`
--
ALTER TABLE `form_penawaran_harga`
  ADD CONSTRAINT `form_penawaran_harga_id_dokumen_foreign` FOREIGN KEY (`id_dokumen`) REFERENCES `kelengkapan_dokumen_vendors` (`id_dokumen`) ON DELETE CASCADE;

--
-- Constraints for table `h_p_s`
--
ALTER TABLE `h_p_s`
  ADD CONSTRAINT `h_p_s_id_kontrakkerja_foreign` FOREIGN KEY (`id_kontrakkerja`) REFERENCES `kontrak_kerjas` (`id_kontrakkerja`) ON DELETE CASCADE;

--
-- Constraints for table `jenis_kontrak`
--
ALTER TABLE `jenis_kontrak`
  ADD CONSTRAINT `jenis_kontrak_id_kontrak_foreign` FOREIGN KEY (`id_kontrak`) REFERENCES `kontrak_kerjas` (`id_kontrakkerja`) ON DELETE CASCADE;

--
-- Constraints for table `kelengkapan_dokumen_vendors`
--
ALTER TABLE `kelengkapan_dokumen_vendors`
  ADD CONSTRAINT `kelengkapan_dokumen_vendors_id_jenis_dokumen_foreign` FOREIGN KEY (`id_jenis_dokumen`) REFERENCES `jenis_dokumen_kelengkapans` (`id_jenis`),
  ADD CONSTRAINT `kelengkapan_dokumen_vendors_id_kontrakkerja_foreign` FOREIGN KEY (`id_kontrakkerja`) REFERENCES `kontrak_kerjas` (`id_kontrakkerja`),
  ADD CONSTRAINT `kelengkapan_dokumen_vendors_id_vendor_foreign` FOREIGN KEY (`id_vendor`) REFERENCES `vendors` (`id_vendor`);

--
-- Constraints for table `kontrak_kerjas`
--
ALTER TABLE `kontrak_kerjas`
  ADD CONSTRAINT `kontrak_kerjas_id_vendor_foreign` FOREIGN KEY (`id_vendor`) REFERENCES `vendors` (`id_vendor`);

--
-- Constraints for table `lampiranpenawaranhargas`
--
ALTER TABLE `lampiranpenawaranhargas`
  ADD CONSTRAINT `lampiranpenawaranhargas_id_dokumen_foreign` FOREIGN KEY (`id_dokumen`) REFERENCES `kelengkapan_dokumen_vendors` (`id_dokumen`) ON DELETE CASCADE;

--
-- Constraints for table `neracas`
--
ALTER TABLE `neracas`
  ADD CONSTRAINT `neracas_id_dokumen_foreign` FOREIGN KEY (`id_dokumen`) REFERENCES `kelengkapan_dokumen_vendors` (`id_dokumen`) ON DELETE CASCADE;

--
-- Constraints for table `paktavendors`
--
ALTER TABLE `paktavendors`
  ADD CONSTRAINT `paktavendors_id_dokumen_foreign` FOREIGN KEY (`id_dokumen`) REFERENCES `kelengkapan_dokumen_vendors` (`id_dokumen`) ON DELETE CASCADE;

--
-- Constraints for table `pembuatan_surat_kontraks`
--
ALTER TABLE `pembuatan_surat_kontraks`
  ADD CONSTRAINT `pembuatan_surat_kontraks_id_kontrakkerja_foreign` FOREIGN KEY (`id_kontrakkerja`) REFERENCES `kontrak_kerjas` (`id_kontrakkerja`) ON DELETE CASCADE;

--
-- Constraints for table `penyelenggaras`
--
ALTER TABLE `penyelenggaras`
  ADD CONSTRAINT `penyelenggaras_id_kontrakkerja_foreign` FOREIGN KEY (`id_kontrakkerja`) REFERENCES `kontrak_kerjas` (`id_kontrakkerja`) ON DELETE CASCADE;

--
-- Constraints for table `pernyataangaransis`
--
ALTER TABLE `pernyataangaransis`
  ADD CONSTRAINT `pernyataangaransis_id_dokumen_foreign` FOREIGN KEY (`id_dokumen`) REFERENCES `kelengkapan_dokumen_vendors` (`id_dokumen`) ON DELETE CASCADE;

--
-- Constraints for table `pernyataan_kesanggupans`
--
ALTER TABLE `pernyataan_kesanggupans`
  ADD CONSTRAINT `pernyataan_kesanggupans_id_dokumen_foreign` FOREIGN KEY (`id_dokumen`) REFERENCES `kelengkapan_dokumen_vendors` (`id_dokumen`) ON DELETE CASCADE;

--
-- Constraints for table `r_k_s`
--
ALTER TABLE `r_k_s`
  ADD CONSTRAINT `r_k_s_id_kontrakkerja_foreign` FOREIGN KEY (`id_kontrakkerja`) REFERENCES `kontrak_kerjas` (`id_kontrakkerja`) ON DELETE CASCADE;

--
-- Constraints for table `subdatapengalamen`
--
ALTER TABLE `subdatapengalamen`
  ADD CONSTRAINT `subdatapengalamen_id_datapengalaman_foreign` FOREIGN KEY (`id_datapengalaman`) REFERENCES `datapengalamen` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sub_barjas`
--
ALTER TABLE `sub_barjas`
  ADD CONSTRAINT `sub_barjas_id_barjas_foreign` FOREIGN KEY (`id_barjas`) REFERENCES `bar_jas` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sumber_anggarans`
--
ALTER TABLE `sumber_anggarans`
  ADD CONSTRAINT `sumber_anggarans_id_kontrakkerja_foreign` FOREIGN KEY (`id_kontrakkerja`) REFERENCES `kontrak_kerjas` (`id_kontrakkerja`) ON DELETE CASCADE;

--
-- Constraints for table `tanda_tangans`
--
ALTER TABLE `tanda_tangans`
  ADD CONSTRAINT `tanda_tangans_id_akun_foreign` FOREIGN KEY (`id_akun`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_pegawai_id_foreign` FOREIGN KEY (`pegawai_id`) REFERENCES `pegawais` (`id_pegawai`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`id_vendor`) ON DELETE CASCADE;

--
-- Constraints for table `u_n_d_s`
--
ALTER TABLE `u_n_d_s`
  ADD CONSTRAINT `u_n_d_s_id_kontrakkerja_foreign` FOREIGN KEY (`id_kontrakkerja`) REFERENCES `kontrak_kerjas` (`id_kontrakkerja`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
