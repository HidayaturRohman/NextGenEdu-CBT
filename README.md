# NextGenEdu-CBT 
<p align="center">
  <img src="docs/img/garuda_white.svg" alt="Garuda CBT Logo" width="90" height="90" style="background: linear-gradient(135deg, #00c9a7, #00a88c); border-radius: 20px; padding: 12px;">
</p>

<p align="center">
  <strong>Aplikasi Terpadu: Rapor, Ujian Berbasis Komputer (CBT), dan E-Learning Modern</strong><br>
  Dikembangkan berbasis <strong>CodeIgniter 4</strong> &amp; kompatibel dengan <strong>PHP 8.1 hingga PHP 8.4</strong>.
</p>

<p align="center">
  <a href="https://hidayaturrohman.github.io/NextGenEdu-CBT/"><img src="https://img.shields.io/badge/Dokumentasi-Online-00c9a7?style=for-the-badge&logo=gitbook&logoColor=white" alt="Dokumentasi Online"></a>
  <a href="https://t.me/+UbHStB31PjM2YzZl"><img src="https://img.shields.io/badge/Telegram-Komunitas-229ED9?style=for-the-badge&logo=telegram&logoColor=white" alt="Grup Telegram"></a>
  <a href="https://github.com/HidayaturRohman/NextGenEdu-CBT"><img src="https://img.shields.io/badge/GitHub-Repository-181717?style=for-the-badge&logo=github&logoColor=white" alt="GitHub Repo"></a>
  <img src="https://img.shields.io/badge/PHP-8.1_|_8.2_|_8.3_|_8.4-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP Version">
  <img src="https://img.shields.io/badge/Framework-CodeIgniter_4-EF4223?style=for-the-badge&logo=codeigniter&logoColor=white" alt="CodeIgniter 4">
</p>

---

## 📌 Apa itu NextGenEdu-CBT?

**NextGenEdu-CBT** (Garuda CBT Modern Edition) adalah platform manajemen pendidikan berbasis web yang dirancang khusus untuk kebutuhan sekolah dan madrasah di Indonesia. Mengintegrasikan berbagai modul krusial dalam satu sistem: mulai dari pelaksanaan **Asesmen/Ujian Berbasis Komputer (CBT)**, **Pembelajaran Daring (E-Learning)**, hingga **Pengolahan Rapor Digital (Kurikulum Merdeka & K13)**.

Dilengkapi dengan sistem cerdas **Dual Nomenklatur Otomatis** yang dapat mendeteksi entitas satuan pendidikan di bawah naungan **Kementerian Agama (Kemenag RI)** maupun **Kemendikbudristek** (`Kepala Madrasah` vs `Kepala Sekolah`).

---

## 🔗 Tautan Resmi & Komunitas

* 📖 **Dokumentasi Lengkap:** [https://hidayaturrohman.github.io/NextGenEdu-CBT/](https://hidayaturrohman.github.io/NextGenEdu-CBT/)
* 💬 **Grup Diskusi Telegram:** [https://t.me/+UbHStB31PjM2YzZl](https://t.me/+UbHStB31PjM2YzZl)
* 🚀 **Repository GitHub:** [https://github.com/HidayaturRohman/NextGenEdu-CBT](https://github.com/HidayaturRohman/NextGenEdu-CBT)
* 🐛 **Pelaporan Masalah (Issues):** [https://github.com/HidayaturRohman/NextGenEdu-CBT/issues](https://github.com/HidayaturRohman/NextGenEdu-CBT/issues)

---

## 🎯 Modul Utama Sistem

| Modul | Deskripsi Kapabilitas |
| :--- | :--- |
| 💻 **CBT (Ujian Online)** | Sistem ujian CBT modern dengan 5 tipe soal (PG, PG Kompleks, Menjodohkan, Isian, Uraian), bank soal, jadwal, sesi, ruang, nomor peserta, token dinamis 15 menit, pengawas, monitoring real-time, rekap & analisis butir soal interaktif. |
| 📖 **E-Learning & KBM** | Manajemen kelas online: jadwal pelajaran, distribusi materi ajar (dokumen/video/media WebP), penugasan berbatas waktu, dan absensi per mata pelajaran. |
| 📊 **Presensi & Absensi** | Presensi harian siswa dan **Presensi Leger Bulanan (1-31)** matriks otomatis berformula persentase kehadiran. |
| 🏆 **Buku Rapor Digital** | Pengolahan nilai rapor lengkap untuk **Kurikulum Merdeka** (Formatif, Sumatif Materi, SAS, P5/P2RA) dan **K13** dengan KKM dinamis, interval predikat, serta cetak massal satu rombel kelas. |
| 📚 **Buku Induk Digital** | Pencatatan data induk siswa secara lengkap, terstruktur, dan arsip riwayat mutasi/kelas. |
| 👥 **Data Master & Sekolah** | Kelola data siswa, guru & pegawai, kelas/rombel, mata pelajaran, jurusan, ekstrakurikuler, serta tahun ajaran & semester aktif. |
| 🎓 **Alumni & Kelulusan** | Modul purna studi dengan fitur **Kelulusan Massal (Bulk Graduation)** 1-klik tanpa merusak arsip nilai lama dan pelacakan lulusan (*Tracer Study*). |
| 👨‍🏫 **Portal Wali Kelas** | Fitur khusus wali kelas: daftar rekap siswa, catatan kepribadian/sikap wali kelas, dan bagan struktur organisasi kelas. |
| 📢 **Pengumuman & Komunikasi** | Distribusi pengumuman dan informasi resmi kepada siswa dan guru secara terpusat. |
| ⚙️ **Pengaturan & Database** | Profil sekolah/madrasah, kop dinas resmi, manajemen hak akses multi-role (Admin, Guru, Siswa), backup & restore database otomatis. |

---

## 💻 Kebutuhan Sistem (System Requirements)

* **Bahasa Pemrograman:** PHP 8.1, PHP 8.2, PHP 8.3, atau PHP 8.4 *(Direkomendasikan PHP 8.2/8.3)*
* **Web Server:** Apache 2.4+ (mod_rewrite wajib aktif) / Nginx / Laragon / XAMPP
* **Database Server:** MariaDB 10.4+ atau MySQL 8.0+
* **Ekstensi PHP Wajib:** `mysqli`, `curl`, `mbstring`, `intl`, `json`, `gd` (dukungan WebP), `xml`

---

## 🛠️ Panduan Instalasi Cepat (Web Installer)

Aplikasi ini sudah dilengkapi dengan **Visual Web Wizard 4 Langkah**, sehingga Anda **tidak perlu mengimpor file SQL manual lewat phpMyAdmin**:

1. **Unduh Source Code:**
   * Clone repository ini atau klik tombol hijau **Code > Download ZIP**:
     ```bash
     git clone https://github.com/HidayaturRohman/NextGenEdu-CBT.git
     ```
   * Letakkan folder proyek di web directory Anda (misal `C:\laragon\www\NextGenEdu-CBT` atau `/var/www/html/NextGenEdu-CBT`).

2. **Jalankan Web Server:**
   * Pastikan web server Apache dan MySQL di Laragon / XAMPP sudah aktif (*Running*).

3. **Buka Browser:**
   * Akses URL instalasi di browser:
     ```
     http://localhost/NextGenEdu-CBT
     ```
   * Sistem akan mendeteksi status belum terpasang dan langsung mengarahkan Anda ke halaman **Pemandu Instalasi Visual**.

4. **Selesaikan 4 Langkah Pemandu:**
   * **Langkah 1 (Database):** Masukkan Host (`localhost`), User Database (`root`), Password (jika ada), dan Nama Database yang diinginkan (misal: `cbt_db`). Klik **Tes & Buat Database**.
   * **Langkah 2 (Admin):** Buat username dan password untuk akun Administrator utama.
   * **Langkah 3 (Profil Lembaga):** Masukkan nama madrasah/sekolah dan informasi identitas instansi.
   * **Langkah 4 (Selesai):** Konfirmasi dan selesai! Anda dapat langsung login sebagai Administrator, Guru, maupun Siswa.

---

## 📱 Panduan Dokumentasi Offline & Online

* **Online (GitHub Pages):** Kunjungi [https://hidayaturrohman.github.io/NextGenEdu-CBT/](https://hidayaturrohman.github.io/NextGenEdu-CBT/)
* **Offline (Lokal Web Server):** Buka melalui browser di server lokal Anda pada URL:
  ```
  http://localhost/NextGenEdu-CBT/public/Doc/
  ```

---

## 🤝 Bergabung dengan Komunitas

Punya pertanyaan seputar instalasi, konfigurasi jaringan CBT, atau ingin berdiskusi dengan sesama proktor & teknisi madrasah/sekolah?

👉 **[Klik Disini untuk Gabung Grup Telegram Komunitas](https://t.me/+UbHStB31PjM2YzZl)**

---

## 📜 Lisensi & Atribusi

Dikembangkan untuk mempermudah kegiatan asesmen, pembelajaran, dan tata kelola administrasi pendidikan di Indonesia. Dilarang memperjualbelikan ulang tanpa izin pengembang resmi.
