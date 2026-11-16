-- =====================================================================
-- NextGen Garuda CBT 2026 - Master Database Schema & Initial Data
-- Exported on: 2026-11-06 15:33:15
-- Total Tables: 100
-- =====================================================================

SET FOREIGN_KEY_CHECKS = 0;
SET SQL_MODE = 'NO_AUTO_VALUE_ON_ZERO';
SET NAMES utf8mb4;

-- --------------------------------------------------------
-- Table structure for `buku_digital`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `buku_digital`;
CREATE TABLE `buku_digital` (
  `id_buku` int NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) NOT NULL,
  `penulis` varchar(150) DEFAULT NULL,
  `penerbit` varchar(150) DEFAULT NULL,
  `tahun_terbit` varchar(10) DEFAULT NULL,
  `kategori` varchar(100) DEFAULT 'Umum',
  `tingkat_kelas` varchar(50) DEFAULT 'Semua',
  `deskripsi` text,
  `cover` varchar(255) DEFAULT NULL,
  `file_buku` varchar(255) DEFAULT NULL,
  `tipe_sumber` enum('file','url') DEFAULT 'file',
  `dibaca` int DEFAULT '0',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_buku`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for `buku_induk`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `buku_induk`;
CREATE TABLE `buku_induk` (
  `id_siswa` int NOT NULL AUTO_INCREMENT,
  `uid` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `rombel_awal` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nama_panggilan` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `bahasa` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jml_saudara_kandung` int NOT NULL DEFAULT '0',
  `jml_saudara_tiri` int NOT NULL DEFAULT '0',
  `jml_saudara_angkat` int NOT NULL DEFAULT '0',
  `yatim` int NOT NULL DEFAULT '0' COMMENT '0=ada orang-tua, 1=yatim, 2=yatim piatu',
  `tinggal_bersama` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '1' COMMENT '1=orang-tua, 2=saudara, 3=wali, 4=asrama/pesantren, 5=kost, 6=lainnya',
  `jarak` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `gol_darah` varchar(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `penyakit` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `kelainan_fisik` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kegemaran` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `beasiswa` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `no_ijazah_sebelumnya` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tahun_lulus_sebelumnya` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pindahan_dari` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `alasan_kepindahan` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `agama_ayah` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tempat_lahir_ayah` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `wn_ayah` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `penghasilan_ayah` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `hidup_meninggal_ayah` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `agama_ibu` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tempat_lahir_ibu` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `wn_ibu` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `penghasilan_ibu` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `hidup_meninggal_ibu` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tempat_lahir_wali` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `agama_wali` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `wn_wali` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `penghasilan_wali` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` int DEFAULT '1' COMMENT '1= aktif, 2=lulus, 3=pindah, 4=keluar',
  `tahun_lulus` int DEFAULT NULL,
  `no_ijazah` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kelas_akhir` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `lanjut_ke` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pindah_ke` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `alasan_pindah` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tgl_pindah` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `bekerja_di` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `catatan_penting` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  PRIMARY KEY (`id_siswa`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------
-- Table structure for `bulan`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `bulan`;
CREATE TABLE `bulan` (
  `id_bln` int NOT NULL AUTO_INCREMENT,
  `nama_bln` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_bln`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------
-- Table structure for `cbt_bank_soal`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `cbt_bank_soal`;
CREATE TABLE `cbt_bank_soal` (
  `id_bank` int NOT NULL AUTO_INCREMENT,
  `bank_jenis_id` int NOT NULL DEFAULT '0',
  `bank_kode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  `bank_level` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `bank_kelas` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `bank_mapel_id` int DEFAULT NULL,
  `bank_jurusan_id` int NOT NULL DEFAULT '0',
  `bank_guru_id` int DEFAULT NULL,
  `bank_nama` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `kkm` int DEFAULT '0',
  `jml_soal` int NOT NULL DEFAULT '0',
  `jml_esai` int NOT NULL DEFAULT '0',
  `tampil_pg` int NOT NULL DEFAULT '0',
  `tampil_esai` int NOT NULL DEFAULT '0',
  `bobot_pg` int NOT NULL DEFAULT '0',
  `bobot_esai` int NOT NULL DEFAULT '0',
  `opsi` int NOT NULL DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int NOT NULL DEFAULT '0',
  `soal_agama` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_tp` int NOT NULL,
  `id_smt` int NOT NULL,
  `deskripsi` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `jml_kompleks` int NOT NULL DEFAULT '0',
  `tampil_kompleks` int NOT NULL DEFAULT '0',
  `bobot_kompleks` int NOT NULL DEFAULT '0',
  `jml_jodohkan` int NOT NULL DEFAULT '0',
  `tampil_jodohkan` int NOT NULL DEFAULT '0',
  `bobot_jodohkan` int NOT NULL DEFAULT '0',
  `jml_isian` int NOT NULL DEFAULT '0',
  `tampil_isian` int NOT NULL DEFAULT '0',
  `bobot_isian` int NOT NULL DEFAULT '0',
  `status_soal` int NOT NULL DEFAULT '0' COMMENT '0=belum selesai, 1=sudah selesai',
  PRIMARY KEY (`id_bank`) USING BTREE,
  UNIQUE KEY `kode_bank_soal` (`bank_kode`(100))
) ENGINE=InnoDB AUTO_INCREMENT=191 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=COMPACT;

-- --------------------------------------------------------
-- Table structure for `cbt_banner`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `cbt_banner`;
CREATE TABLE `cbt_banner` (
  `id_banner` int unsigned NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) NOT NULL,
  `subjudul` varchar(255) DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `url_link` varchar(255) DEFAULT NULL,
  `tombol_teks` varchar(100) DEFAULT 'Lihat Detail',
  `urutan` int NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `warna_bg` varchar(100) DEFAULT 'linear-gradient(135deg, #1e3c72 0%, #2a5298 100%)',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_banner`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------
-- Table structure for `cbt_chat_pesan`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `cbt_chat_pesan`;
CREATE TABLE `cbt_chat_pesan` (
  `id_chat` int NOT NULL AUTO_INCREMENT,
  `tipe` varchar(20) NOT NULL DEFAULT 'personal',
  `id_kelas` int NOT NULL DEFAULT '0',
  `sender_uid` varchar(50) NOT NULL,
  `sender_name` varchar(150) NOT NULL,
  `sender_avatar` varchar(255) DEFAULT NULL,
  `sender_role` tinyint NOT NULL,
  `receiver_uid` varchar(50) NOT NULL,
  `pesan` text NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_chat`),
  KEY `idx_pair` (`sender_uid`,`receiver_uid`),
  KEY `idx_receiver` (`receiver_uid`,`is_read`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for `cbt_diskusi`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `cbt_diskusi`;
CREATE TABLE `cbt_diskusi` (
  `id_diskusi` int NOT NULL AUTO_INCREMENT,
  `ruang` varchar(20) NOT NULL DEFAULT 'sekolah',
  `id_kelas` int NOT NULL DEFAULT '0',
  `id_mapel` int NOT NULL DEFAULT '0',
  `nama_mapel` varchar(100) DEFAULT NULL,
  `id_user` int NOT NULL,
  `role` tinyint NOT NULL,
  `sender_name` varchar(150) NOT NULL,
  `sender_avatar` varchar(255) DEFAULT NULL,
  `kelas_nama` varchar(50) DEFAULT NULL,
  `pesan` text NOT NULL,
  `balas_id` int DEFAULT '0',
  `balas_nama` varchar(150) DEFAULT NULL,
  `balas_pesan` text,
  `is_pinned` tinyint(1) NOT NULL DEFAULT '0',
  `likes_count` int NOT NULL DEFAULT '0',
  `comments_count` int NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_diskusi`),
  KEY `ruang_kelas` (`ruang`,`id_kelas`),
  KEY `created_at` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for `cbt_diskusi_komentar`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `cbt_diskusi_komentar`;
CREATE TABLE `cbt_diskusi_komentar` (
  `id_komentar` int NOT NULL AUTO_INCREMENT,
  `id_diskusi` int NOT NULL,
  `id_user` int NOT NULL,
  `role` tinyint NOT NULL,
  `sender_name` varchar(150) NOT NULL,
  `sender_avatar` varchar(255) DEFAULT NULL,
  `role_badge` varchar(50) DEFAULT NULL,
  `komentar` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_komentar`),
  KEY `idx_diskusi` (`id_diskusi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for `cbt_diskusi_like`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `cbt_diskusi_like`;
CREATE TABLE `cbt_diskusi_like` (
  `id_like` int NOT NULL AUTO_INCREMENT,
  `id_diskusi` int NOT NULL,
  `id_user` int NOT NULL,
  `role` tinyint NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_like`),
  UNIQUE KEY `uniq_like` (`id_diskusi`,`id_user`,`role`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for `cbt_jadwal`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `cbt_jadwal`;
CREATE TABLE `cbt_jadwal` (
  `id_jadwal` int NOT NULL AUTO_INCREMENT,
  `id_tp` char(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_smt` char(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_bank` int DEFAULT NULL,
  `id_jenis` int DEFAULT NULL,
  `tgl_mulai` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tgl_selesai` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `durasi_ujian` int NOT NULL,
  `pelanggaran` char(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kamera` int NOT NULL DEFAULT '0',
  `acak_soal` int NOT NULL,
  `acak_opsi` int NOT NULL,
  `hasil_tampil` int NOT NULL,
  `token` int NOT NULL,
  `status` int NOT NULL,
  `ulang` int NOT NULL,
  `reset_login` int NOT NULL,
  `rekap` int NOT NULL DEFAULT '0',
  `jam_ke` int NOT NULL DEFAULT '0',
  `jarak` int NOT NULL DEFAULT '0',
  `time_create` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_jadwal`) USING BTREE,
  UNIQUE KEY `idjawal_relation` (`id_jadwal`) USING BTREE,
  UNIQUE KEY `id_bank_soal` (`id_bank`) USING BTREE,
  KEY `idx_jns_fc` (`id_jenis`) USING BTREE,
  CONSTRAINT `id_bank_soal` FOREIGN KEY (`id_bank`) REFERENCES `cbt_bank_soal` (`id_bank`),
  CONSTRAINT `id_jns_idx_ifc` FOREIGN KEY (`id_jenis`) REFERENCES `cbt_jenis` (`id_jenis`)
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=COMPACT;

-- --------------------------------------------------------
-- Table structure for `cbt_jenis`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `cbt_jenis`;
CREATE TABLE `cbt_jenis` (
  `id_jenis` int NOT NULL AUTO_INCREMENT,
  `nama_jenis` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `kode_jenis` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `kategori` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'lainnya',
  PRIMARY KEY (`id_jenis`) USING BTREE,
  UNIQUE KEY `idx_jns` (`id_jenis`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------
-- Table structure for `cbt_kamera_stream`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `cbt_kamera_stream`;
CREATE TABLE `cbt_kamera_stream` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_jadwal` int NOT NULL,
  `id_siswa` int NOT NULL,
  `status` varchar(20) DEFAULT 'standby',
  `sdp_offer` longtext,
  `sdp_answer` longtext,
  `last_frame` longtext,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_jadwal_siswa` (`id_jadwal`,`id_siswa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for `cbt_kop_absensi`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `cbt_kop_absensi`;
CREATE TABLE `cbt_kop_absensi` (
  `id_kop` int NOT NULL,
  `header_1` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `header_2` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `header_3` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `header_4` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `proktor` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pengawas_1` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pengawas_2` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_kop`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------
-- Table structure for `cbt_kop_berita`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `cbt_kop_berita`;
CREATE TABLE `cbt_kop_berita` (
  `id_kop` int NOT NULL,
  `header_1` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `header_2` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `header_3` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `header_4` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_kop`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------
-- Table structure for `cbt_kop_kartu`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `cbt_kop_kartu`;
CREATE TABLE `cbt_kop_kartu` (
  `id_set_kartu` int NOT NULL,
  `header_1` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `header_2` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `header_3` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `header_4` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tanggal` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_set_kartu`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------
-- Table structure for `cbt_nomor_peserta`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `cbt_nomor_peserta`;
CREATE TABLE `cbt_nomor_peserta` (
  `id_nomor` int NOT NULL AUTO_INCREMENT,
  `id_siswa` int DEFAULT NULL,
  `id_tp` int NOT NULL,
  `id_smt` int NOT NULL DEFAULT '1',
  `nomor_peserta` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_nomor`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------
-- Table structure for `cbt_patch_history`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `cbt_patch_history`;
CREATE TABLE `cbt_patch_history` (
  `id_patch` int NOT NULL AUTO_INCREMENT,
  `version` varchar(50) NOT NULL,
  `prev_version` varchar(50) DEFAULT NULL,
  `name` varchar(150) DEFAULT NULL,
  `description` text,
  `applied_at` datetime NOT NULL,
  `applied_by` varchar(100) DEFAULT NULL,
  `files_count` int DEFAULT '0',
  `has_sql` tinyint(1) DEFAULT '0',
  `backup_file` varchar(255) DEFAULT NULL,
  `manifest_data` longtext,
  `status` varchar(20) DEFAULT 'applied',
  PRIMARY KEY (`id_patch`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for `cbt_pengawas`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `cbt_pengawas`;
CREATE TABLE `cbt_pengawas` (
  `id_pengawas` int NOT NULL AUTO_INCREMENT,
  `id_jadwal` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_tp` int NOT NULL,
  `id_smt` int NOT NULL,
  `id_ruang` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_sesi` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `jam_ke` varchar(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_guru` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_pengawas`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------
-- Table structure for `cbt_rekap_jadwal`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `cbt_rekap_jadwal`;
CREATE TABLE `cbt_rekap_jadwal` (
  `id_rekap` int NOT NULL AUTO_INCREMENT,
  `id_tp` int NOT NULL,
  `tp` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_smt` int NOT NULL,
  `smt` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_jadwal` int NOT NULL,
  `jadwal` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `id_bank` int NOT NULL,
  `bank_soal` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `kode_bank` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `kelas_bank` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `level_bank` int NOT NULL,
  `id_jenis` int NOT NULL,
  `kode_jenis` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_mapel` int NOT NULL,
  `kode_mapel` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nama_mapel` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tgl_mulai` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tgl_selesai` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `soal_pg` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `soal_kompleks` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `soal_jodohkan` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `soal_isian` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `soal_esai` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `id_guru` int DEFAULT NULL,
  `nama_guru` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pengawas` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  PRIMARY KEY (`id_rekap`),
  KEY `id_jadwal_id_bank` (`id_jadwal`,`id_bank`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------
-- Table structure for `cbt_rekap_siswa`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `cbt_rekap_siswa`;
CREATE TABLE `cbt_rekap_siswa` (
  `id_rekap_siswa` int NOT NULL AUTO_INCREMENT,
  `id_siswa` int NOT NULL,
  `nama_siswa` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `agama` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `no_peserta` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `siswa` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `id_tp` int NOT NULL,
  `tp` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_smt` int NOT NULL,
  `smt` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_jadwal` int NOT NULL,
  `id_bank` int NOT NULL,
  `id_kelas` int NOT NULL,
  `kelas` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ruang_sesi` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `jawaban` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `nilai` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `nilai_input` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `status` int NOT NULL,
  `mulai` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `selesai` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `lama_ujian` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pelanggaran` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  PRIMARY KEY (`id_rekap_siswa`),
  KEY `id_siswa_id_jadwal_id_bank` (`id_siswa`,`id_jadwal`,`id_bank`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------
-- Table structure for `cbt_ruang`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `cbt_ruang`;
CREATE TABLE `cbt_ruang` (
  `id_ruang` int NOT NULL AUTO_INCREMENT,
  `nama_ruang` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `kode_ruang` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_ruang`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------
-- Table structure for `cbt_sesi`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `cbt_sesi`;
CREATE TABLE `cbt_sesi` (
  `id_sesi` int NOT NULL AUTO_INCREMENT,
  `nama_sesi` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `kode_sesi` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `waktu_mulai` time NOT NULL,
  `waktu_akhir` time NOT NULL,
  `istirahat` int DEFAULT NULL,
  `aktif` int NOT NULL,
  PRIMARY KEY (`id_sesi`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------
-- Table structure for `cbt_sesi_siswa`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `cbt_sesi_siswa`;
CREATE TABLE `cbt_sesi_siswa` (
  `id_sesi_siswa` int NOT NULL AUTO_INCREMENT,
  `siswa_id` int NOT NULL,
  `kelas_id` int DEFAULT NULL,
  `ruang_id` int NOT NULL,
  `sesi_id` int NOT NULL,
  `tp_id` int NOT NULL,
  `smt_id` int NOT NULL,
  PRIMARY KEY (`id_sesi_siswa`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------
-- Table structure for `cbt_siswa`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `cbt_siswa`;
CREATE TABLE `cbt_siswa` (
  `id_cbt_siswa` int NOT NULL AUTO_INCREMENT,
  `id_siswa` int NOT NULL,
  `id_jadwal` int NOT NULL,
  `id_bank` int NOT NULL,
  `jawaban` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `nilai` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `nilai_input` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `status` int NOT NULL,
  `mulai` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `selesai` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `lama_ujian` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `reset_waktu` int NOT NULL,
  `reset_izin` int NOT NULL,
  `pelanggaran` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  PRIMARY KEY (`id_cbt_siswa`),
  KEY `id_siswa_id_jadwal_id_bank` (`id_siswa`,`id_jadwal`,`id_bank`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------
-- Table structure for `cbt_soal`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `cbt_soal`;
CREATE TABLE `cbt_soal` (
  `id_soal` int NOT NULL AUTO_INCREMENT,
  `bank_id` int DEFAULT NULL,
  `mapel_id` int DEFAULT '0',
  `jenis` int NOT NULL COMMENT '1=ganda, 2=ganda kompleks, 3=menjodohkan, 4=isian singkat, 5=uraian',
  `nomor_soal` int DEFAULT '0',
  `file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `file1` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `tipe_file` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `soal` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `opsi_a` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `opsi_b` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `opsi_c` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `opsi_d` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `opsi_e` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `file_a` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `file_b` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `file_c` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `file_d` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `file_e` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jawaban` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `created_on` int DEFAULT NULL,
  `updated_on` int DEFAULT NULL,
  `tampilkan` int NOT NULL DEFAULT '0',
  `deskripsi` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `kesulitan` int NOT NULL DEFAULT '1' COMMENT 'tingkat kesulitan 1-10',
  `timer` int NOT NULL DEFAULT '0' COMMENT '0=tidak, 1=ya',
  `timer_menit` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_soal`) USING BTREE,
  UNIQUE KEY `id_soal_idx` (`id_soal`) USING BTREE,
  KEY `id_bank_idx` (`bank_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2231 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------
-- Table structure for `cbt_token`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `cbt_token`;
CREATE TABLE `cbt_token` (
  `token` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `auto` int NOT NULL,
  `id_token` int NOT NULL AUTO_INCREMENT,
  `jarak` int NOT NULL DEFAULT '0',
  `updated` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '',
  PRIMARY KEY (`id_token`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------
-- Table structure for `ci_sessions`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `ci_sessions`;
CREATE TABLE `ci_sessions` (
  `id` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `timestamp` int unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------
-- Table structure for `groups`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `groups`;
CREATE TABLE `groups` (
  `id` mediumint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------
-- Table structure for `hari`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `hari`;
CREATE TABLE `hari` (
  `id_hri` int NOT NULL AUTO_INCREMENT,
  `nama_hri` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_hri`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------
-- Table structure for `jabatan_guru`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `jabatan_guru`;
CREATE TABLE `jabatan_guru` (
  `id_jabatan_guru` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_guru` int DEFAULT NULL,
  `id_jabatan` int NOT NULL,
  `id_kelas` int DEFAULT '0',
  `mapel_kelas` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `ekstra_kelas` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `id_tp` int NOT NULL,
  `id_smt` int NOT NULL,
  `jabatan_tambahan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  PRIMARY KEY (`id_jabatan_guru`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------
-- Table structure for `kbm_jurnal_guru`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `kbm_jurnal_guru`;
CREATE TABLE `kbm_jurnal_guru` (
  `id_jurnal` int NOT NULL AUTO_INCREMENT,
  `id_tp` int NOT NULL,
  `id_smt` int NOT NULL,
  `id_guru` int NOT NULL,
  `id_kelas` int NOT NULL,
  `id_mapel` int NOT NULL,
  `id_jadwal` int DEFAULT NULL,
  `tanggal` date NOT NULL,
  `jam_ke` varchar(20) NOT NULL,
  `pertemuan_ke` int DEFAULT '1',
  `materi_pokok` varchar(255) NOT NULL,
  `tujuan_pembelajaran` text,
  `model_pembelajaran` varchar(100) DEFAULT NULL,
  `pendekatan_deep_learning` varchar(150) DEFAULT NULL,
  `dimensi_profil` varchar(255) DEFAULT NULL,
  `kegiatan_pembelajaran` text,
  `asesmen_formatif` varchar(255) DEFAULT NULL,
  `refleksi_kbm` text,
  `catatan` text,
  `status_kbm` enum('selesai','tugas','daring') NOT NULL DEFAULT 'selesai',
  `jml_hadir` int DEFAULT '0',
  `jml_sakit` int DEFAULT '0',
  `jml_izin` int DEFAULT '0',
  `jml_alpa` int DEFAULT '0',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_jurnal`),
  KEY `idx_jurnal_lookup` (`id_tp`,`id_smt`,`id_kelas`,`id_mapel`,`tanggal`),
  KEY `idx_jurnal_guru` (`id_guru`,`tanggal`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for `kelas_catatan_mapel`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `kelas_catatan_mapel`;
CREATE TABLE `kelas_catatan_mapel` (
  `id_catatan` int NOT NULL AUTO_INCREMENT,
  `id_tp` int NOT NULL,
  `id_smt` int NOT NULL,
  `type` int NOT NULL,
  `id_siswa` int DEFAULT NULL,
  `id_mapel` int DEFAULT NULL,
  `id_kelas` int DEFAULT NULL,
  `id_guru` int DEFAULT NULL,
  `level` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  `tgl` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `text` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `readed` varchar(22) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  `reading` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT 'array id_siswa yang membaca',
  `jml` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_catatan`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------
-- Table structure for `kelas_catatan_wali`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `kelas_catatan_wali`;
CREATE TABLE `kelas_catatan_wali` (
  `id_catatan` int NOT NULL AUTO_INCREMENT,
  `id_tp` int NOT NULL,
  `id_smt` int NOT NULL,
  `type` int NOT NULL COMMENT '1=semua siswa, 2=per siswa',
  `level` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '1=saran, 2=teguran, 3=peringatan, 4=sangsi',
  `tgl` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_siswa` int DEFAULT NULL,
  `id_kelas` int DEFAULT NULL,
  `text` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `readed` varchar(22) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  `reading` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `jml` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_catatan`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------
-- Table structure for `kelas_ekstra`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `kelas_ekstra`;
CREATE TABLE `kelas_ekstra` (
  `id_kelas_ekstra` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_tp` int NOT NULL,
  `id_smt` int NOT NULL,
  `id_kelas` int DEFAULT NULL,
  `ekstra` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_kelas_ekstra`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------
-- Table structure for `kelas_jadwal_kbm`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `kelas_jadwal_kbm`;
CREATE TABLE `kelas_jadwal_kbm` (
  `id_kbm` int NOT NULL AUTO_INCREMENT,
  `id_tp` int NOT NULL,
  `id_smt` int NOT NULL,
  `id_kelas` int DEFAULT NULL,
  `kbm_jam_pel` int NOT NULL,
  `kbm_jam_mulai` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `kbm_jam_selesai` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kbm_jml_mapel_hari` int NOT NULL,
  `istirahat` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `upacara` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `kbm_jumat` text COLLATE utf8mb4_general_ci,
  `libur` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_kbm`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------
-- Table structure for `kelas_jadwal_mapel`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `kelas_jadwal_mapel`;
CREATE TABLE `kelas_jadwal_mapel` (
  `id_jadwal` int NOT NULL AUTO_INCREMENT,
  `id_tp` int NOT NULL,
  `id_smt` int NOT NULL,
  `id_kelas` int DEFAULT NULL,
  `id_hari` int NOT NULL,
  `jam_ke` int NOT NULL,
  `id_mapel` int DEFAULT NULL,
  `dari` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sampai` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_jadwal`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=98 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------
-- Table structure for `kelas_jadwal_materi`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `kelas_jadwal_materi`;
CREATE TABLE `kelas_jadwal_materi` (
  `id_kjm` int NOT NULL AUTO_INCREMENT,
  `id_tp` int NOT NULL,
  `id_smt` int NOT NULL,
  `id_materi` int DEFAULT NULL,
  `id_mapel` int DEFAULT NULL,
  `id_kelas` int DEFAULT NULL,
  `jadwal_materi` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `jenis` int DEFAULT NULL COMMENT '1=materi, 2=tugas',
  PRIMARY KEY (`id_kjm`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------
-- Table structure for `kelas_libraries`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `kelas_libraries`;
CREATE TABLE `kelas_libraries` (
  `id` int NOT NULL AUTO_INCREMENT,
  `url` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `siteName` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `title` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `description` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `image` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------
-- Table structure for `kelas_materi`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `kelas_materi`;
CREATE TABLE `kelas_materi` (
  `id_materi` int NOT NULL AUTO_INCREMENT,
  `id_tp` int NOT NULL DEFAULT '1',
  `id_smt` int NOT NULL DEFAULT '1',
  `kode_materi` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_guru` int DEFAULT NULL,
  `materi_kelas` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_mapel` int DEFAULT '0',
  `kode_mapel` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `judul_materi` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `isi_materi` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `file` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `id_buku` int DEFAULT NULL,
  `catatan_buku` text COLLATE utf8mb4_general_ci,
  `link_file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tgl_mulai` datetime DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `updated_on` datetime DEFAULT CURRENT_TIMESTAMP,
  `status` int DEFAULT NULL,
  `youtube` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `jenis` int NOT NULL DEFAULT '1' COMMENT '1=materi, 2=tugas',
  PRIMARY KEY (`id_materi`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------
-- Table structure for `kelas_siswa`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `kelas_siswa`;
CREATE TABLE `kelas_siswa` (
  `id_kelas_siswa` int NOT NULL,
  `id_tp` int NOT NULL,
  `id_smt` int NOT NULL,
  `id_siswa` int DEFAULT NULL,
  `id_kelas` int DEFAULT NULL,
  PRIMARY KEY (`id_kelas_siswa`) USING BTREE,
  UNIQUE KEY `id_kelas_siswa_idx` (`id_kelas_siswa`) USING BTREE,
  KEY `id_siswa_idx` (`id_siswa`) USING BTREE,
  KEY `Id_kelas` (`id_kelas`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------
-- Table structure for `kelas_struktur`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `kelas_struktur`;
CREATE TABLE `kelas_struktur` (
  `id_kelas` int NOT NULL AUTO_INCREMENT,
  `ketua` int DEFAULT NULL,
  `wakil_ketua` int DEFAULT NULL,
  `sekretaris_1` int DEFAULT NULL,
  `sekretaris_2` int DEFAULT NULL,
  `bendahara_1` int DEFAULT NULL,
  `bendahara_2` int DEFAULT NULL,
  `sie_ekstrakurikuler` int DEFAULT NULL,
  `sie_upacara` int DEFAULT NULL,
  `sie_olahraga` int DEFAULT NULL,
  `sie_keagamaan` int DEFAULT NULL,
  `sie_keamanan` int DEFAULT NULL,
  `sie_ketertiban` int DEFAULT NULL,
  `sie_kebersihan` int DEFAULT NULL,
  `sie_keindahan` int DEFAULT NULL,
  `sie_kesehatan` int DEFAULT NULL,
  `sie_kekeluargaan` int DEFAULT NULL,
  `sie_humas` int DEFAULT NULL,
  PRIMARY KEY (`id_kelas`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------
-- Table structure for `level_guru`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `level_guru`;
CREATE TABLE `level_guru` (
  `id_level` int NOT NULL AUTO_INCREMENT,
  `level` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_level`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------
-- Table structure for `level_kelas`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `level_kelas`;
CREATE TABLE `level_kelas` (
  `id_level` int NOT NULL,
  `level` varchar(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_level`) USING BTREE,
  KEY `index_id_level` (`id_level`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------
-- Table structure for `log`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `log`;
CREATE TABLE `log` (
  `id_log` int NOT NULL AUTO_INCREMENT,
  `log_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_user` int NOT NULL,
  `id_group` int NOT NULL,
  `name_group` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `log_type` int NOT NULL,
  `log_desc` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `address` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `agent` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `device` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_log`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------
-- Table structure for `log_materi`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `log_materi`;
CREATE TABLE `log_materi` (
  `id_log` int NOT NULL AUTO_INCREMENT,
  `log_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_siswa` int DEFAULT NULL,
  `jam_ke` int NOT NULL,
  `id_materi` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_mapel` int DEFAULT NULL,
  `log_type` int NOT NULL,
  `log_desc` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `text` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `file` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `nilai` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `catatan` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `ulang` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '0',
  `address` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `agent` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `device` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `finish_time` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_log`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------
-- Table structure for `log_ujian`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `log_ujian`;
CREATE TABLE `log_ujian` (
  `id_log` int NOT NULL AUTO_INCREMENT,
  `log_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_siswa` int DEFAULT NULL,
  `id_jadwal` int DEFAULT NULL,
  `log_type` int NOT NULL,
  `log_desc` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `address` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `agent` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `device` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `reset` int NOT NULL COMMENT '0=tidak reset, 1=reset',
  `finish_time` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_log`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------
-- Table structure for `login_attempts`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `login_attempts`;
CREATE TABLE `login_attempts` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `login` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `time` int unsigned DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------
-- Table structure for `master_ekstra`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `master_ekstra`;
CREATE TABLE `master_ekstra` (
  `id_ekstra` int NOT NULL AUTO_INCREMENT,
  `nama_ekstra` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `kode_ekstra` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_ekstra`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------
-- Table structure for `master_guru`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `master_guru`;
CREATE TABLE `master_guru` (
  `id_guru` int NOT NULL AUTO_INCREMENT,
  `id_user` int DEFAULT NULL,
  `nip` char(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `jenis_nip` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'NIP',
  `nama_guru` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(254) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kode_guru` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `no_ktp` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tempat_lahir` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `jenis_kelamin` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `agama` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `no_hp` varchar(13) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `alamat_jalan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `rt_rw` varchar(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `dusun` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kelurahan` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kecamatan` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kabupaten` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `provinsi` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kode_pos` int DEFAULT NULL,
  `kewarganegaraan` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nuptk` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jenis_ptk` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tgs_tambahan` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status_pegawai` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status_aktif` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status_nikah` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tmt` date DEFAULT NULL,
  `keahlian_isyarat` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `npwp` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `foto` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `dokumen` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  PRIMARY KEY (`id_guru`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------
-- Table structure for `master_hari_efektif`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `master_hari_efektif`;
CREATE TABLE `master_hari_efektif` (
  `id_hari_efektif` int NOT NULL AUTO_INCREMENT,
  `jml_hari_efektif` int NOT NULL,
  PRIMARY KEY (`id_hari_efektif`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------
-- Table structure for `master_hari_libur`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `master_hari_libur`;
CREATE TABLE `master_hari_libur` (
  `id_libur` int NOT NULL AUTO_INCREMENT,
  `id_tp` int NOT NULL DEFAULT '0',
  `id_smt` int NOT NULL DEFAULT '0',
  `tanggal` date NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `sumber` varchar(50) NOT NULL DEFAULT 'manual',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_libur`),
  UNIQUE KEY `unique_tanggal_tp_smt` (`tanggal`,`id_tp`,`id_smt`),
  KEY `idx_tanggal` (`tanggal`)
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for `master_jurusan`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `master_jurusan`;
CREATE TABLE `master_jurusan` (
  `id_jurusan` int NOT NULL AUTO_INCREMENT,
  `nama_jurusan` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `kode_jurusan` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `mapel_peminatan` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `status` int NOT NULL DEFAULT '1',
  `deletable` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_jurusan`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------
-- Table structure for `master_kelas`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `master_kelas`;
CREATE TABLE `master_kelas` (
  `id_kelas` int NOT NULL AUTO_INCREMENT,
  `id_tp` int NOT NULL,
  `id_smt` int NOT NULL,
  `nama_kelas` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `kode_kelas` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jurusan_id` int DEFAULT NULL,
  `level_id` int NOT NULL,
  `guru_id` int DEFAULT NULL,
  `siswa_id` int DEFAULT NULL,
  `jumlah_siswa` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `set_siswa` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '0',
  PRIMARY KEY (`id_kelas`) USING BTREE,
  KEY `index_level_Id` (`level_id`) USING BTREE,
  CONSTRAINT `key_id_cek` FOREIGN KEY (`level_id`) REFERENCES `level_kelas` (`id_level`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------
-- Table structure for `master_kelompok_mapel`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `master_kelompok_mapel`;
CREATE TABLE `master_kelompok_mapel` (
  `id_kel_mapel` int NOT NULL AUTO_INCREMENT,
  `kode_kel_mapel` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nama_kel_mapel` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kategori` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_parent` int DEFAULT NULL,
  PRIMARY KEY (`id_kel_mapel`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------
-- Table structure for `master_mapel`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `master_mapel`;
CREATE TABLE `master_mapel` (
  `id_mapel` int NOT NULL AUTO_INCREMENT,
  `nama_mapel` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `kode` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kelompok` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '-',
  `bobot_p` int NOT NULL DEFAULT '0',
  `bobot_k` int NOT NULL DEFAULT '0',
  `jenjang` int NOT NULL DEFAULT '0',
  `urutan` int NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `deletable` int NOT NULL DEFAULT '1',
  `urutan_tampil` int DEFAULT NULL,
  PRIMARY KEY (`id_mapel`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------
-- Table structure for `master_siswa`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `master_siswa`;
CREATE TABLE `master_siswa` (
  `id_siswa` int NOT NULL AUTO_INCREMENT,
  `nisn` int(10) unsigned zerofill NOT NULL,
  `nis` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nama` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `jenis_kelamin` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `kelas_awal` int NOT NULL,
  `tahun_masuk` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sekolah_asal` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tempat_lahir` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tanggal_lahir` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `agama` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `hp` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(254) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'siswa.png',
  `anak_ke` int DEFAULT NULL,
  `status_keluarga` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `alamat` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `rt` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `rw` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kelurahan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kecamatan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kabupaten` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `provinsi` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kode_pos` int DEFAULT NULL,
  `nama_ayah` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tgl_lahir_ayah` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pendidikan_ayah` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pekerjaan_ayah` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nohp_ayah` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `alamat_ayah` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `nama_ibu` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tgl_lahir_ibu` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pendidikan_ibu` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pekerjaan_ibu` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nohp_ibu` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `alamat_ibu` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `nama_wali` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tgl_lahir_wali` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pendidikan_wali` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pekerjaan_wali` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nohp_wali` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `alamat_wali` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `nik` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `warga_negara` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `uid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_siswa`,`uid`,`nisn`,`nis`) USING BTREE,
  UNIQUE KEY `Id_siswa_idx` (`id_siswa`) USING BTREE,
  UNIQUE KEY `uid_idx` (`uid`) USING BTREE,
  UNIQUE KEY `nisn` (`nisn`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------
-- Table structure for `master_smt`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `master_smt`;
CREATE TABLE `master_smt` (
  `id_smt` int NOT NULL AUTO_INCREMENT,
  `smt` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nama_smt` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `active` int NOT NULL,
  PRIMARY KEY (`id_smt`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------
-- Table structure for `master_tp`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `master_tp`;
CREATE TABLE `master_tp` (
  `id_tp` int NOT NULL AUTO_INCREMENT,
  `tahun` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `active` int NOT NULL,
  PRIMARY KEY (`id_tp`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------
-- Table structure for `migrations`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `version` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------
-- Table structure for `post`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `post`;
CREATE TABLE `post` (
  `id_post` int NOT NULL AUTO_INCREMENT,
  `dari` int DEFAULT NULL,
  `dari_group` int DEFAULT NULL,
  `kepada` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'group',
  `text` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tanggal` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_post`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------
-- Table structure for `post_comments`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `post_comments`;
CREATE TABLE `post_comments` (
  `id_comment` int NOT NULL AUTO_INCREMENT,
  `id_post` int DEFAULT NULL,
  `dari` int DEFAULT NULL,
  `dari_group` int DEFAULT NULL,
  `text` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tanggal` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `type` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '1' COMMENT '1:pengumuman, 2:materi, 3:tugas',
  PRIMARY KEY (`id_comment`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------
-- Table structure for `post_reply`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `post_reply`;
CREATE TABLE `post_reply` (
  `id_reply` int NOT NULL AUTO_INCREMENT,
  `id_comment` int DEFAULT NULL,
  `dari` int DEFAULT NULL,
  `dari_group` int DEFAULT NULL,
  `text` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tanggal` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `type` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_reply`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------
-- Table structure for `ppdb_daftar`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `ppdb_daftar`;
CREATE TABLE `ppdb_daftar` (
  `id_daftar` int NOT NULL AUTO_INCREMENT,
  `no_daftar` varchar(50) NOT NULL,
  `tanggal_daftar` datetime NOT NULL,
  `id_tp` int DEFAULT NULL,
  `id_smt` int DEFAULT NULL,
  `id_jurusan` int DEFAULT NULL,
  `jurusan_pilihan` varchar(150) DEFAULT NULL,
  `nama_lengkap` varchar(150) NOT NULL,
  `nama_panggilan` varchar(100) DEFAULT NULL,
  `jenis_kelamin` varchar(5) NOT NULL DEFAULT 'L',
  `nisn` varchar(20) DEFAULT NULL,
  `nik` varchar(30) DEFAULT NULL,
  `no_kk` varchar(30) DEFAULT NULL,
  `no_akta` varchar(50) DEFAULT NULL,
  `tempat_lahir` varchar(100) DEFAULT NULL,
  `tanggal_lahir` varchar(30) DEFAULT NULL,
  `agama` varchar(20) DEFAULT 'Islam',
  `kewarganegaraan` varchar(30) DEFAULT 'WNI',
  `anak_ke` int DEFAULT '1',
  `jumlah_saudara` int DEFAULT '0',
  `bahasa` varchar(50) DEFAULT 'Indonesia',
  `alamat` text,
  `rt` varchar(10) DEFAULT NULL,
  `rw` varchar(10) DEFAULT NULL,
  `kelurahan` varchar(100) DEFAULT NULL,
  `kecamatan` varchar(100) DEFAULT NULL,
  `kabupaten` varchar(100) DEFAULT NULL,
  `kode_pos` varchar(10) DEFAULT NULL,
  `tinggal_bersama` varchar(50) DEFAULT 'Bersama orang tua',
  `transportasi` varchar(50) DEFAULT 'Sepeda Motor',
  `jarak_sekolah` varchar(20) DEFAULT NULL,
  `waktu_tempuh` varchar(50) DEFAULT NULL,
  `hp` varchar(25) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `gol_darah` varchar(5) DEFAULT NULL,
  `penyakit` text,
  `kelainan_jasmani` varchar(100) DEFAULT NULL,
  `tinggi_badan` int DEFAULT NULL,
  `berat_badan` int DEFAULT NULL,
  `no_kps` varchar(50) DEFAULT NULL,
  `no_kip` varchar(50) DEFAULT NULL,
  `layak_pip` varchar(20) DEFAULT 'Tidak',
  `alasan_pip` varchar(100) DEFAULT NULL,
  `nama_ayah` varchar(150) DEFAULT NULL,
  `nik_ayah` varchar(30) DEFAULT NULL,
  `tempat_lahir_ayah` varchar(100) DEFAULT NULL,
  `tanggal_lahir_ayah` varchar(30) DEFAULT NULL,
  `agama_ayah` varchar(20) DEFAULT 'Islam',
  `kewarganegaraan_ayah` varchar(30) DEFAULT 'WNI',
  `pendidikan_ayah` varchar(50) DEFAULT NULL,
  `pekerjaan_ayah` varchar(100) DEFAULT NULL,
  `penghasilan_ayah` varchar(50) DEFAULT NULL,
  `alamat_ayah` text,
  `hp_ayah` varchar(25) DEFAULT NULL,
  `status_ayah` varchar(50) DEFAULT 'Masih Hidup',
  `nama_ibu` varchar(150) DEFAULT NULL,
  `nik_ibu` varchar(30) DEFAULT NULL,
  `tempat_lahir_ibu` varchar(100) DEFAULT NULL,
  `tanggal_lahir_ibu` varchar(30) DEFAULT NULL,
  `agama_ibu` varchar(20) DEFAULT 'Islam',
  `kewarganegaraan_ibu` varchar(30) DEFAULT 'WNI',
  `pendidikan_ibu` varchar(50) DEFAULT NULL,
  `pekerjaan_ibu` varchar(100) DEFAULT NULL,
  `penghasilan_ibu` varchar(50) DEFAULT NULL,
  `alamat_ibu` text,
  `hp_ibu` varchar(25) DEFAULT NULL,
  `status_ibu` varchar(50) DEFAULT 'Masih Hidup',
  `nama_wali` varchar(150) DEFAULT NULL,
  `nik_wali` varchar(30) DEFAULT NULL,
  `tempat_lahir_wali` varchar(100) DEFAULT NULL,
  `tanggal_lahir_wali` varchar(30) DEFAULT NULL,
  `agama_wali` varchar(20) DEFAULT NULL,
  `kewarganegaraan_wali` varchar(30) DEFAULT NULL,
  `pendidikan_wali` varchar(50) DEFAULT NULL,
  `pekerjaan_wali` varchar(100) DEFAULT NULL,
  `penghasilan_wali` varchar(50) DEFAULT NULL,
  `alamat_wali` text,
  `hp_wali` varchar(25) DEFAULT NULL,
  `status_wali` varchar(50) DEFAULT NULL,
  `sekolah_asal` varchar(150) DEFAULT NULL,
  `is_pindahan` tinyint(1) DEFAULT '0',
  `pindahan_dari` varchar(150) DEFAULT NULL,
  `alasan_pindah` text,
  `hobi` varchar(100) DEFAULT NULL,
  `cita_cita` varchar(100) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `status_verifikasi` tinyint(1) NOT NULL DEFAULT '0',
  `catatan_verifikasi` text,
  `id_siswa` int DEFAULT NULL,
  `id_kelas_tujuan` int DEFAULT NULL,
  `nis_diberikan` varchar(30) DEFAULT NULL,
  `verified_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_daftar`),
  UNIQUE KEY `no_daftar` (`no_daftar`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for `ppdb_setting`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `ppdb_setting`;
CREATE TABLE `ppdb_setting` (
  `id_setting` int NOT NULL AUTO_INCREMENT,
  `aktif` tinyint(1) NOT NULL DEFAULT '1',
  `slug` varchar(50) NOT NULL DEFAULT 'ppdb',
  `judul` varchar(200) NOT NULL DEFAULT 'Penerimaan Peserta Didik Baru (PPDB) Online',
  `subjudul` varchar(255) NOT NULL DEFAULT 'Tahun Pelajaran 2027 / 2028',
  `banner` varchar(255) DEFAULT NULL,
  `banner_pengumuman` varchar(255) DEFAULT NULL,
  `pengumuman` longtext,
  `tata_cara` longtext,
  `kontak_hp` varchar(50) DEFAULT NULL,
  `tanggal_buka` date DEFAULT NULL,
  `tanggal_tutup` date DEFAULT NULL,
  `gelombang` varchar(50) DEFAULT 'Gelombang 1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_setting`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for `presensi_harian`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `presensi_harian`;
CREATE TABLE `presensi_harian` (
  `id_presensi` int NOT NULL AUTO_INCREMENT,
  `id_tp` int NOT NULL,
  `id_smt` int NOT NULL,
  `id_kelas` int NOT NULL,
  `id_siswa` int NOT NULL,
  `tanggal` date NOT NULL,
  `status` enum('H','S','I','A') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'H',
  `jam_masuk` time DEFAULT NULL,
  `jam_pulang` time DEFAULT NULL,
  `status_masuk` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT 'tepat',
  `status_pulang` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT 'tepat',
  `keterangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_presensi`),
  UNIQUE KEY `uniq_presensi_siswa_tgl` (`id_tp`,`id_smt`,`id_kelas`,`id_siswa`,`tanggal`),
  KEY `idx_presensi_tgl_kelas` (`tanggal`,`id_kelas`),
  KEY `idx_presensi_siswa` (`id_siswa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for `presensi_mapel`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `presensi_mapel`;
CREATE TABLE `presensi_mapel` (
  `id_presensi_mapel` int NOT NULL AUTO_INCREMENT,
  `id_jurnal` int DEFAULT NULL,
  `id_tp` int NOT NULL,
  `id_smt` int NOT NULL,
  `id_kelas` int NOT NULL,
  `id_mapel` int NOT NULL,
  `id_guru` int NOT NULL,
  `id_siswa` int NOT NULL,
  `tanggal` date NOT NULL,
  `jam_ke` varchar(20) NOT NULL,
  `status` enum('H','S','I','A') NOT NULL DEFAULT 'H',
  `keterangan` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_presensi_mapel`),
  KEY `idx_pm_lookup` (`id_tp`,`id_smt`,`id_kelas`,`id_mapel`,`tanggal`),
  KEY `idx_pm_siswa` (`id_siswa`,`tanggal`),
  KEY `idx_pm_jurnal` (`id_jurnal`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for `presensi_setting`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `presensi_setting`;
CREATE TABLE `presensi_setting` (
  `id_setting` int NOT NULL AUTO_INCREMENT,
  `id_tp` int DEFAULT '0',
  `id_smt` int DEFAULT '0',
  `mode_presensi` enum('sederhana','lengkap','per_mapel') NOT NULL DEFAULT 'sederhana',
  `kunci_jurnal_sebelum_jam` tinyint(1) NOT NULL DEFAULT '1',
  `jam_masuk_mulai` time DEFAULT '06:00:00',
  `jam_masuk_selesai` time DEFAULT '07:15:00',
  `jam_terlambat` time DEFAULT '07:15:00',
  `jam_pulang_mulai` time DEFAULT '13:00:00',
  `jam_pulang_selesai` time DEFAULT '17:00:00',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_setting`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for `rapor_admin_setting`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `rapor_admin_setting`;
CREATE TABLE `rapor_admin_setting` (
  `id_setting` int NOT NULL AUTO_INCREMENT,
  `id_tp` int NOT NULL DEFAULT '0',
  `id_smt` int NOT NULL DEFAULT '0',
  `kkm_tunggal` int NOT NULL DEFAULT '0',
  `kkm` int DEFAULT NULL,
  `bobot_ph` int DEFAULT NULL,
  `bobot_pts` int DEFAULT NULL,
  `bobot_pas` int DEFAULT NULL,
  `bobot_absen` int DEFAULT NULL,
  `tgl_rapor_akhir` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tgl_rapor_kelas_akhir` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tgl_rapor_pts` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nip_kepsek` int DEFAULT '0',
  `nip_walikelas` int DEFAULT '0',
  `kkm_setting` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  PRIMARY KEY (`id_setting`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------
-- Table structure for `rapor_catatan_wali`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `rapor_catatan_wali`;
CREATE TABLE `rapor_catatan_wali` (
  `id_catatan_wali` int NOT NULL AUTO_INCREMENT,
  `id_tp` int NOT NULL DEFAULT '0',
  `id_smt` int NOT NULL DEFAULT '0',
  `id_kelas` int DEFAULT NULL,
  `id_siswa` int DEFAULT NULL,
  `nilai` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `deskripsi` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  PRIMARY KEY (`id_catatan_wali`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------
-- Table structure for `rapor_data_catatan`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `rapor_data_catatan`;
CREATE TABLE `rapor_data_catatan` (
  `id_catatan` int NOT NULL AUTO_INCREMENT,
  `id_tp` int NOT NULL DEFAULT '0',
  `id_smt` int NOT NULL DEFAULT '0',
  `id_kelas` int DEFAULT NULL,
  `jenis` int NOT NULL COMMENT '1=desk absensi, 2=desk catatan, 3=desk ranking',
  `kode` int NOT NULL,
  `deskripsi` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `rank` varchar(7) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_catatan`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------
-- Table structure for `rapor_data_fisik`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `rapor_data_fisik`;
CREATE TABLE `rapor_data_fisik` (
  `id_fisik` int NOT NULL AUTO_INCREMENT,
  `id_tp` int NOT NULL DEFAULT '0',
  `id_smt` int NOT NULL DEFAULT '0',
  `id_kelas` int DEFAULT NULL,
  `jenis` int NOT NULL COMMENT '1=pendengaran, 2=penglihatan, 3=gigi, 4=lain-lain',
  `kode` int NOT NULL,
  `deskripsi` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_fisik`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------
-- Table structure for `rapor_data_sikap`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `rapor_data_sikap`;
CREATE TABLE `rapor_data_sikap` (
  `id_sikap` int NOT NULL AUTO_INCREMENT,
  `id_tp` int NOT NULL DEFAULT '0',
  `id_smt` int NOT NULL DEFAULT '0',
  `id_kelas` int DEFAULT NULL,
  `jenis` int NOT NULL COMMENT '1=spiritual, 2=sosial',
  `kode` int NOT NULL,
  `sikap` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_sikap`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------
-- Table structure for `rapor_diknas_kokurikuler_capaian`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `rapor_diknas_kokurikuler_capaian`;
CREATE TABLE `rapor_diknas_kokurikuler_capaian` (
  `id_capaian` int NOT NULL AUTO_INCREMENT,
  `id_kegiatan` int NOT NULL,
  `dimensi_id` int DEFAULT '1',
  `dimensi` varchar(150) NOT NULL,
  `capaian_akhir` text NOT NULL,
  `urutan` int DEFAULT '1',
  PRIMARY KEY (`id_capaian`),
  KEY `idx_kegiatan` (`id_kegiatan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for `rapor_diknas_kokurikuler_catatan`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `rapor_diknas_kokurikuler_catatan`;
CREATE TABLE `rapor_diknas_kokurikuler_catatan` (
  `id_catatan` int NOT NULL AUTO_INCREMENT,
  `id_kegiatan` int NOT NULL,
  `id_siswa` int NOT NULL,
  `deskripsi` text,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_catatan`),
  UNIQUE KEY `uq_keg_siswa` (`id_kegiatan`,`id_siswa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for `rapor_diknas_kokurikuler_kegiatan`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `rapor_diknas_kokurikuler_kegiatan`;
CREATE TABLE `rapor_diknas_kokurikuler_kegiatan` (
  `id_kegiatan` int NOT NULL AUTO_INCREMENT,
  `id_tp` int NOT NULL,
  `id_smt` int NOT NULL,
  `id_kelas` int NOT NULL,
  `nama_kelompok` varchar(100) DEFAULT 'Kelompok 1',
  `tema` varchar(150) DEFAULT 'Kearifan Lokal',
  `nama_kegiatan` varchar(200) NOT NULL,
  `deskripsi` text,
  `koordinator` varchar(150) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_kegiatan`),
  KEY `idx_tp_smt_kelas` (`id_tp`,`id_smt`,`id_kelas`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for `rapor_diknas_kokurikuler_nilai`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `rapor_diknas_kokurikuler_nilai`;
CREATE TABLE `rapor_diknas_kokurikuler_nilai` (
  `id_nilai` int NOT NULL AUTO_INCREMENT,
  `id_kegiatan` int NOT NULL,
  `id_capaian` int NOT NULL,
  `id_siswa` int NOT NULL,
  `predikat` varchar(10) DEFAULT 'B',
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_nilai`),
  UNIQUE KEY `uq_keg_cap_siswa` (`id_kegiatan`,`id_capaian`,`id_siswa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for `rapor_fisik`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `rapor_fisik`;
CREATE TABLE `rapor_fisik` (
  `id_fisik` int NOT NULL AUTO_INCREMENT,
  `id_kelas` int DEFAULT NULL,
  `id_siswa` int DEFAULT NULL,
  `id_tp` int NOT NULL,
  `id_smt` int NOT NULL,
  `kondisi` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tinggi` int NOT NULL,
  `berat` int NOT NULL,
  PRIMARY KEY (`id_fisik`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------
-- Table structure for `rapor_kemenag_kokurikuler`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `rapor_kemenag_kokurikuler`;
CREATE TABLE `rapor_kemenag_kokurikuler` (
  `id_kegiatan` int NOT NULL AUTO_INCREMENT,
  `id_tp` int NOT NULL,
  `id_smt` int NOT NULL,
  `id_kelas` int NOT NULL,
  `dpl_panca_cinta` varchar(150) NOT NULL,
  `deskripsi` text NOT NULL,
  `is_kirim` tinyint(1) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_kegiatan`),
  KEY `idx_tp_smt_kelas` (`id_tp`,`id_smt`,`id_kelas`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for `rapor_kemenag_kokurikuler_nilai`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `rapor_kemenag_kokurikuler_nilai`;
CREATE TABLE `rapor_kemenag_kokurikuler_nilai` (
  `id_nilai` int NOT NULL AUTO_INCREMENT,
  `id_kegiatan` int NOT NULL,
  `id_siswa` int NOT NULL,
  `nilai` varchar(10) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_nilai`),
  UNIQUE KEY `uq_kegiatan_siswa` (`id_kegiatan`,`id_siswa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for `rapor_kikd`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `rapor_kikd`;
CREATE TABLE `rapor_kikd` (
  `id_kikd` int NOT NULL AUTO_INCREMENT,
  `id_mapel_kelas` int DEFAULT NULL,
  `aspek` int NOT NULL,
  `id_tp` int NOT NULL,
  `id_smt` int NOT NULL,
  `materi_kikd` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_kikd`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------
-- Table structure for `rapor_kkm`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `rapor_kkm`;
CREATE TABLE `rapor_kkm` (
  `id_kkm` int NOT NULL AUTO_INCREMENT,
  `kkm` int DEFAULT '0',
  `bobot_ph` int DEFAULT '0',
  `bobot_pts` int DEFAULT '0',
  `bobot_pas` int DEFAULT '0',
  `bobot_absen` int DEFAULT '0',
  `beban_jam` int DEFAULT '0',
  `id_tp` int NOT NULL DEFAULT '0',
  `id_smt` int NOT NULL DEFAULT '0',
  `jenis` int NOT NULL,
  `id_kelas` int DEFAULT NULL,
  `id_mapel` int DEFAULT NULL,
  PRIMARY KEY (`id_kkm`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------
-- Table structure for `rapor_kurmer_ekstra`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `rapor_kurmer_ekstra`;
CREATE TABLE `rapor_kurmer_ekstra` (
  `id_ekstra` int NOT NULL AUTO_INCREMENT,
  `id_tp` int NOT NULL,
  `id_smt` int NOT NULL,
  `id_kelas` int NOT NULL,
  `id_siswa` int NOT NULL,
  `kegiatan` varchar(255) NOT NULL,
  `nilai` varchar(50) DEFAULT NULL,
  `keterangan` text,
  PRIMARY KEY (`id_ekstra`),
  KEY `id_tp_id_smt_id_kelas_id_siswa` (`id_tp`,`id_smt`,`id_kelas`,`id_siswa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------
-- Table structure for `rapor_kurmer_kehadiran`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `rapor_kurmer_kehadiran`;
CREATE TABLE `rapor_kurmer_kehadiran` (
  `id_kehadiran` int NOT NULL AUTO_INCREMENT,
  `id_tp` int NOT NULL,
  `id_smt` int NOT NULL,
  `id_kelas` int NOT NULL,
  `id_siswa` int NOT NULL,
  `sakit` int NOT NULL DEFAULT '0',
  `izin` int NOT NULL DEFAULT '0',
  `alpa` int NOT NULL DEFAULT '0',
  `catatan_wali` text,
  `tanggapan_ortu` text,
  `naik_status` varchar(100) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_kehadiran`),
  UNIQUE KEY `id_tp_id_smt_id_kelas_id_siswa` (`id_tp`,`id_smt`,`id_kelas`,`id_siswa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------
-- Table structure for `rapor_kurmer_kktp`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `rapor_kurmer_kktp`;
CREATE TABLE `rapor_kurmer_kktp` (
  `id_kktp` int NOT NULL AUTO_INCREMENT,
  `id_tp` int NOT NULL,
  `id_smt` int NOT NULL,
  `id_mapel` int NOT NULL,
  `id_kelas` int DEFAULT NULL,
  `kkm` int NOT NULL DEFAULT '75',
  `skala_1` int NOT NULL DEFAULT '60',
  `skala_2` int NOT NULL DEFAULT '70',
  `skala_3` int NOT NULL DEFAULT '85',
  `skala_4` int NOT NULL DEFAULT '100',
  PRIMARY KEY (`id_kktp`),
  KEY `id_tp_id_smt_id_mapel` (`id_tp`,`id_smt`,`id_mapel`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------
-- Table structure for `rapor_kurmer_nilai`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `rapor_kurmer_nilai`;
CREATE TABLE `rapor_kurmer_nilai` (
  `id_nilai` int NOT NULL AUTO_INCREMENT,
  `id_tp` int NOT NULL,
  `id_smt` int NOT NULL,
  `id_kelas` int NOT NULL,
  `id_mapel` int NOT NULL,
  `id_siswa` int NOT NULL,
  `nilai_sumatif` longtext,
  `rata_sumatif` decimal(5,2) DEFAULT NULL,
  `nilai_sts` decimal(5,2) DEFAULT NULL,
  `nilai_sas` decimal(5,2) DEFAULT NULL,
  `nilai_akhir` decimal(5,2) DEFAULT NULL,
  `tp_tertinggi` text,
  `deskripsi_tertinggi` text,
  `tp_terendah` text,
  `deskripsi_terendah` text,
  `deskripsi_capaian` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_nilai`),
  UNIQUE KEY `id_tp_id_smt_id_kelas_id_mapel_id_siswa` (`id_tp`,`id_smt`,`id_kelas`,`id_mapel`,`id_siswa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------
-- Table structure for `rapor_kurmer_p5`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `rapor_kurmer_p5`;
CREATE TABLE `rapor_kurmer_p5` (
  `id_p5` int NOT NULL AUTO_INCREMENT,
  `id_tp` int NOT NULL,
  `id_smt` int NOT NULL,
  `id_kelas` int NOT NULL,
  `id_siswa` int NOT NULL,
  `tema` text,
  `dimensi` varchar(150) DEFAULT NULL,
  `deskripsi` text,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_p5`),
  UNIQUE KEY `id_tp_id_smt_id_kelas_id_siswa` (`id_tp`,`id_smt`,`id_kelas`,`id_siswa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------
-- Table structure for `rapor_kurmer_prestasi`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `rapor_kurmer_prestasi`;
CREATE TABLE `rapor_kurmer_prestasi` (
  `id_prestasi` int NOT NULL AUTO_INCREMENT,
  `id_tp` int NOT NULL,
  `id_smt` int NOT NULL,
  `id_kelas` int NOT NULL,
  `id_siswa` int NOT NULL,
  `jenis_prestasi` varchar(255) NOT NULL,
  `keterangan` text,
  PRIMARY KEY (`id_prestasi`),
  KEY `id_tp_id_smt_id_kelas_id_siswa` (`id_tp`,`id_smt`,`id_kelas`,`id_siswa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------
-- Table structure for `rapor_kurmer_setting`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `rapor_kurmer_setting`;
CREATE TABLE `rapor_kurmer_setting` (
  `id_setting` int NOT NULL AUTO_INCREMENT,
  `id_tp` int NOT NULL,
  `id_smt` int NOT NULL,
  `fase` varchar(10) NOT NULL DEFAULT 'D',
  `tempat` varchar(100) NOT NULL DEFAULT 'Sumberagung',
  `tanggal_rapor` date DEFAULT NULL,
  `tanggal_pts` date DEFAULT NULL,
  `kkm_default` int NOT NULL DEFAULT '75',
  `bobot_sumatif` int NOT NULL DEFAULT '50',
  `bobot_sas` int NOT NULL DEFAULT '50',
  `nip_kepsek` int NOT NULL DEFAULT '0',
  `nip_walikelas` int NOT NULL DEFAULT '0',
  `watermark_teks` varchar(255) NOT NULL DEFAULT 'MTs Hidayatul Islamiyah',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `model_kop` int DEFAULT '1',
  `mode_rapor` varchar(20) DEFAULT 'semua',
  `mapel_rapor` longtext,
  `mode_mapel_rapor` varchar(20) DEFAULT 'otomatis',
  `cbt_convert_mode` varchar(20) DEFAULT 'katrol',
  `cbt_katrol_min` int DEFAULT '60',
  `cbt_katrol_max` int DEFAULT '100',
  `auto_fill_cbt` tinyint(1) DEFAULT '1',
  `id_jenis_sts` int DEFAULT NULL,
  `id_jenis_sas` int DEFAULT NULL,
  `ttd_rapor_ringkas` varchar(20) DEFAULT '3',
  PRIMARY KEY (`id_setting`),
  KEY `id_tp_id_smt` (`id_tp`,`id_smt`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------
-- Table structure for `rapor_kurmer_tp`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `rapor_kurmer_tp`;
CREATE TABLE `rapor_kurmer_tp` (
  `id_tp_mapel` int NOT NULL AUTO_INCREMENT,
  `id_tp` int NOT NULL,
  `id_smt` int NOT NULL,
  `id_mapel` int NOT NULL,
  `id_kelas` int DEFAULT NULL,
  `id_guru` int DEFAULT NULL,
  `kode_tp` varchar(20) NOT NULL,
  `lingkup_materi` text,
  `tujuan_pembelajaran` text NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_tp_mapel`),
  KEY `id_tp_id_smt_id_mapel` (`id_tp`,`id_smt`,`id_mapel`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------
-- Table structure for `rapor_naik`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `rapor_naik`;
CREATE TABLE `rapor_naik` (
  `id_naik` int NOT NULL,
  `id_tp` int NOT NULL,
  `id_smt` int NOT NULL,
  `id_siswa` int NOT NULL,
  `naik` int NOT NULL,
  PRIMARY KEY (`id_naik`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------
-- Table structure for `rapor_nilai_akhir`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `rapor_nilai_akhir`;
CREATE TABLE `rapor_nilai_akhir` (
  `id_nilai_akhir` int NOT NULL AUTO_INCREMENT,
  `id_mapel` int DEFAULT NULL,
  `id_kelas` int DEFAULT NULL,
  `id_siswa` int DEFAULT NULL,
  `id_tp` int NOT NULL,
  `id_smt` int NOT NULL,
  `nilai` int DEFAULT '0',
  `akhir` int DEFAULT NULL,
  `predikat` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_nilai_akhir`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------
-- Table structure for `rapor_nilai_ekstra`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `rapor_nilai_ekstra`;
CREATE TABLE `rapor_nilai_ekstra` (
  `id_nilai_ekstra` int NOT NULL AUTO_INCREMENT,
  `id_ekstra` int DEFAULT NULL,
  `id_kelas` int DEFAULT NULL,
  `id_siswa` int DEFAULT NULL,
  `id_tp` int NOT NULL,
  `id_smt` int NOT NULL,
  `nilai` int NOT NULL,
  `predikat` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `deskripsi` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  PRIMARY KEY (`id_nilai_ekstra`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------
-- Table structure for `rapor_nilai_harian`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `rapor_nilai_harian`;
CREATE TABLE `rapor_nilai_harian` (
  `id_nilai_harian` int NOT NULL AUTO_INCREMENT,
  `id_siswa` int DEFAULT NULL,
  `id_mapel` int DEFAULT NULL,
  `id_kelas` int DEFAULT NULL,
  `id_tp` int NOT NULL,
  `id_smt` int NOT NULL,
  `p1` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `p2` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `p3` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `p4` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `p5` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `p6` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `p7` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `p8` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `p_rata_rata` varchar(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `p_predikat` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `p_deskripsi` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `k1` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `k2` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `k3` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `k4` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `k5` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `k6` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `k7` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `k8` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `k_rata_rata` varchar(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `k_predikat` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `k_deskripsi` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `jml` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_nilai_harian`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------
-- Table structure for `rapor_nilai_pts`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `rapor_nilai_pts`;
CREATE TABLE `rapor_nilai_pts` (
  `id_nilai_pts` int NOT NULL AUTO_INCREMENT,
  `id_mapel` int DEFAULT NULL,
  `id_kelas` int DEFAULT NULL,
  `id_siswa` int DEFAULT NULL,
  `id_tp` int NOT NULL,
  `id_smt` int NOT NULL,
  `nilai` int DEFAULT '0',
  `predikat` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_nilai_pts`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------
-- Table structure for `rapor_nilai_sikap`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `rapor_nilai_sikap`;
CREATE TABLE `rapor_nilai_sikap` (
  `id_nilai_sikap` int NOT NULL AUTO_INCREMENT,
  `id_siswa` int DEFAULT NULL,
  `id_kelas` int DEFAULT NULL,
  `id_tp` int NOT NULL DEFAULT '0',
  `id_smt` int NOT NULL DEFAULT '0',
  `jenis` int DEFAULT NULL,
  `nilai` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `deskripsi` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  PRIMARY KEY (`id_nilai_sikap`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------
-- Table structure for `rapor_prestasi`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `rapor_prestasi`;
CREATE TABLE `rapor_prestasi` (
  `id_ranking` int NOT NULL AUTO_INCREMENT,
  `id_kelas` int DEFAULT NULL,
  `id_siswa` int DEFAULT NULL,
  `id_tp` int NOT NULL,
  `id_smt` int NOT NULL,
  `ranking` int NOT NULL,
  `deskripsi` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `p1` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `p1_desk` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `p2` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `p2_desk` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `p3` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `p3_desk` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_ranking`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------
-- Table structure for `running_text`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `running_text`;
CREATE TABLE `running_text` (
  `id_text` int NOT NULL AUTO_INCREMENT,
  `text` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_text`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------
-- Table structure for `setting`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `setting`;
CREATE TABLE `setting` (
  `id_setting` int NOT NULL AUTO_INCREMENT,
  `kode_sekolah` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sekolah` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `npsn` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nss` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jenjang` int DEFAULT NULL,
  `kepsek` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nip` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tanda_tangan` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `alamat` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `desa` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kecamatan` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kota` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `provinsi` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kode_pos` int DEFAULT NULL,
  `telp` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `fax` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `web` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nama_aplikasi` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `logo_kanan` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `logo_kiri` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `versi` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ip_server` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `waktu` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `server` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_server` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sekolah_id` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `db_versi` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `satuan_pendidikan` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `label_nip` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `fitur_jadwal` varchar(1) COLLATE utf8mb4_general_ci DEFAULT '1',
  `jadwal_di_materi` varchar(1) COLLATE utf8mb4_general_ci DEFAULT '1',
  `hari_aktif` varchar(2) COLLATE utf8mb4_general_ci DEFAULT '6',
  PRIMARY KEY (`id_setting`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=COMPACT;

-- --------------------------------------------------------
-- Table structure for `users`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(254) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `activation_selector` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `activation_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `forgotten_password_selector` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `forgotten_password_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `forgotten_password_time` int unsigned DEFAULT NULL,
  `remember_selector` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `remember_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_on` int unsigned NOT NULL,
  `last_login` int unsigned DEFAULT NULL,
  `active` tinyint unsigned DEFAULT NULL,
  `first_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `last_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `company` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `foto` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jabatan` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `id_user` (`id`) USING BTREE,
  UNIQUE KEY `username_idx` (`username`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------
-- Table structure for `users_groups`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `users_groups`;
CREATE TABLE `users_groups` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned NOT NULL,
  `group_id` mediumint unsigned NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`) USING BTREE,
  KEY `fk_users_groups_users1_idx` (`user_id`) USING BTREE,
  KEY `fk_users_groups_groups1_idx` (`group_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------
-- Dumping data for `groups`
-- --------------------------------------------------------
INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'guru', 'Pembuat Soal dan ujian'),
(3, 'siswa', 'Peserta Ujian');

-- --------------------------------------------------------
-- Dumping data for `users` (Default login: admin / admin)
-- --------------------------------------------------------
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `email`, `created_on`, `active`, `first_name`, `last_name`) VALUES
(1, '127.0.0.1', 'admin', '$2y$10$OMr/cjOVJW6TE4amZHiWp.9Hy9RhLpoTO4McL9M/r3ONLybFP4xdm', 'admin@garudacbt.com', 1793979196, 1, 'Administrator', 'CBT');

-- --------------------------------------------------------
-- Dumping data for `users_groups`
-- --------------------------------------------------------
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES (1, 1, 1);

-- --------------------------------------------------------
-- Dumping data for `setting`
-- --------------------------------------------------------
INSERT INTO `setting` (`id_setting`, `kode_sekolah`, `sekolah`, `npsn`, `nss`, `jenjang`, `kepsek`, `nip`, `tanda_tangan`, `alamat`, `desa`, `kecamatan`, `kota`, `provinsi`, `kode_pos`, `telp`, `fax`, `web`, `email`, `nama_aplikasi`, `logo_kanan`, `logo_kiri`, `versi`, `ip_server`, `waktu`, `server`, `id_server`, `sekolah_id`, `db_versi`, `satuan_pendidikan`, `label_nip`, `fitur_jadwal`, `jadwal_di_materi`, `hari_aktif`) VALUES
(1, '000', 'NextGen Garuda CBT', '', '', '2', 'Kepala Sekolah', '-', '', 'Jl. Pendidikan No. 1', 'Pendidikan', 'Kecamatan', 'Kota', 'Provinsi', '0', '', '', 'cbt.local', 'admin@cbt.local', 'NextGen Garuda CBT 2026', '', 'assets/img/garuda_icon.png', '2.1', '', '', '', '', '', '1.6.0', 2, 'NIP', 1, 1, 6);

-- --------------------------------------------------------
-- Dumping data for `bulan`
-- --------------------------------------------------------
INSERT INTO `bulan` (`id_bln`, `nama_bln`) VALUES
('1', 'Januari'),
('2', 'Februari'),
('3', 'Maret'),
('4', 'April'),
('5', 'Mei'),
('6', 'Juni'),
('7', 'Juli'),
('8', 'Agustus'),
('9', 'September'),
('10', 'Oktober'),
('11', 'November'),
('12', 'Desember');

-- --------------------------------------------------------
-- Dumping data for `hari`
-- --------------------------------------------------------
INSERT INTO `hari` (`id_hri`, `nama_hri`) VALUES
('1', 'Senin'),
('2', 'Selasa'),
('3', 'Rabu'),
('4', 'Kamis'),
('5', 'Jum\'at'),
('6', 'Sabtu'),
('7', 'Minggu');

-- --------------------------------------------------------
-- Dumping data for `cbt_jenis`
-- --------------------------------------------------------
INSERT INTO `cbt_jenis` (`id_jenis`, `nama_jenis`, `kode_jenis`, `kategori`) VALUES
('1', 'Penilaian Harian', 'PH', 'ph'),
('2', 'Penilaian Tengah Semester', 'PTS', 'sts'),
('3', 'Penilaian Akhir Semester', 'PAS', 'sas'),
('4', 'Penilaian Akhir Tahun', 'PAT', 'sas'),
('5', 'Ujian Madrasah Berbasis Komputer', 'UMBK', 'lainnya'),
('6', 'Try Out', 'TO', 'lainnya'),
('7', 'Simulasi', 'SIML', 'lainnya');

-- --------------------------------------------------------
-- Dumping data for `level_kelas`
-- --------------------------------------------------------
INSERT INTO `level_kelas` (`id_level`, `level`) VALUES
('1', '1'),
('2', '2'),
('3', '3'),
('4', '4'),
('5', '5'),
('6', '6'),
('7', '7'),
('8', '8'),
('9', '9'),
('10', '10'),
('11', '11'),
('12', '12');

-- --------------------------------------------------------
-- Dumping data for `level_guru`
-- --------------------------------------------------------
INSERT INTO `level_guru` (`id_level`, `level`) VALUES
('1', 'Kepala Sekolah'),
('2', 'Wakil Kepala Sekolah'),
('3', 'Bimbingan Konseling'),
('4', 'Walikelas'),
('5', 'Guru');

-- --------------------------------------------------------
-- Dumping data for `jabatan_guru`
-- --------------------------------------------------------
INSERT INTO `jabatan_guru` (`id_jabatan_guru`, `id_guru`, `id_jabatan`, `id_kelas`, `mapel_kelas`, `ekstra_kelas`, `id_tp`, `id_smt`, `jabatan_tambahan`) VALUES
('1271', '12', '5', '0', 'a:1:{i:0;a:3:{s:8:\"id_mapel\";s:1:\"5\";s:10:\"nama_mapel\";s:11:\"Bahasa Arab\";s:11:\"kelas_mapel\";a:2:{i:0;a:1:{s:5:\"kelas\";s:1:\"1\";}i:1;a:1:{s:5:\"kelas\";s:1:\"2\";}}}}', 'a:0:{}', '7', '1', ''),
('171', '1', '4', '1', 'a:1:{i:0;a:3:{s:8:\"id_mapel\";s:2:\"11\";s:10:\"nama_mapel\";s:40:\"Pendidikan Pancasila dan Kewarganegaraan\";s:11:\"kelas_mapel\";a:3:{i:0;a:1:{s:5:\"kelas\";s:1:\"1\";}i:1;a:1:{s:5:\"kelas\";s:1:\"2\";}i:2;a:1:{s:5:\"kelas\";N;}}}}', 'a:1:{i:0;a:3:{s:9:\"id_ekstra\";s:1:\"1\";s:11:\"nama_ekstra\";s:7:\"Pramuka\";s:12:\"kelas_ekstra\";a:3:{i:0;a:1:{s:5:\"kelas\";s:1:\"1\";}i:1;a:1:{s:5:\"kelas\";s:1:\"2\";}i:2;a:1:{s:5:\"kelas\";N;}}}}', '7', '1', '5');

-- --------------------------------------------------------
-- Dumping data for `master_tp`
-- --------------------------------------------------------
INSERT INTO `master_tp` (`id_tp`, `tahun`, `active`) VALUES
('1', '2020/2021', '0'),
('2', '2021/2022', '0'),
('3', '2022/2023', '0'),
('4', '2023/2024', '0'),
('5', '2024/2025', '0'),
('6', '2025/2026', '0'),
('7', '2026/2027', '1'),
('8', '2027/2028', '0');

-- --------------------------------------------------------
-- Dumping data for `master_smt`
-- --------------------------------------------------------
INSERT INTO `master_smt` (`id_smt`, `smt`, `nama_smt`, `active`) VALUES
('1', 'Ganjil', 'I (satu)', '1'),
('2', 'Genap', 'II (dua)', '0');

-- --------------------------------------------------------
-- Dumping data for `cbt_token`
-- --------------------------------------------------------
INSERT INTO `cbt_token` (`token`, `auto`, `id_token`, `jarak`, `updated`) VALUES
('PDRHZS', '1', '1', '15', '2026-10-29 13:10:29');

-- --------------------------------------------------------
-- Dumping data for `presensi_setting`
-- --------------------------------------------------------
INSERT INTO `presensi_setting` (`id_setting`, `id_tp`, `id_smt`, `mode_presensi`, `kunci_jurnal_sebelum_jam`, `jam_masuk_mulai`, `jam_masuk_selesai`, `jam_terlambat`, `jam_pulang_mulai`, `jam_pulang_selesai`, `created_at`, `updated_at`) VALUES
('1', '0', '0', 'per_mapel', '1', '06:00:00', '07:15:00', '07:15:00', '13:00:00', '17:00:00', '2026-10-20 15:51:34', '2026-10-20 22:30:38');

-- --------------------------------------------------------
-- Dumping data for `ppdb_setting`
-- --------------------------------------------------------
INSERT INTO `ppdb_setting` (`id_setting`, `aktif`, `slug`, `judul`, `subjudul`, `banner`, `banner_pengumuman`, `pengumuman`, `tata_cara`, `kontak_hp`, `tanggal_buka`, `tanggal_tutup`, `gelombang`, `created_at`, `updated_at`) VALUES
('1', '1', 'ppdb', 'Penerimaan Peserta Didik Baru (PPDB) Online', 'Tahun Pelajaran 2027 / 2028', NULL, NULL, 'Selamat datang di Portal Resmi Pendaftaran Peserta Didik Baru (PPDB) Online. Silakan isi formulir pendaftaran secara online, cetak formulir pendaftaran 2 lembar A4, dan serahkan ke panitia sekolah untuk verifikasi berkas.', '<ol><li>Mengisi Formulir Pendaftaran Online secara lengkap dan benar sesuai dokumen asli (KK, Akta Lahir, KIP/KPS jika ada).</li><li>Mencetak Formulir Bukti Pendaftaran (2 Lembar A4) yang telah diisi.</li><li>Menyerahkan Formulir Pendaftaran beserta pas foto 3x4 dan fotokopi KK/Akta ke panitia PPDB sekolah.</li><li>Menunggu verifikasi dan pengumuman hasil seleksi oleh panitia.</li></ol>', NULL, '2026-10-29', '2026-12-28', 'Gelombang 1', '2026-10-29 12:59:17', NULL);

-- --------------------------------------------------------
-- Dumping data for `migrations`
-- --------------------------------------------------------
INSERT INTO `migrations` (`version`) VALUES
('20250919000000');

-- --------------------------------------------------------
-- Dumping data for `running_text`
-- --------------------------------------------------------
INSERT INTO `running_text` (`id_text`, `text`) VALUES
(1, 'Selamat Datang di Portal Ujian dan Pembelajaran NextGen Garuda CBT 2026'),
(2, 'Gunakan Aplikasi CBT Exambro Resmi untuk keamanan dan kenyamanan ujian'),
(3, 'Kerjakan soal dengan jujur, teliti, dan penuh tanggung jawab.');

SET FOREIGN_KEY_CHECKS = 1;
