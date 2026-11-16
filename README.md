# NextGenEdu-CBT

Aplikasi Sistem Ujian Berbasis Komputer (Computer Based Test - CBT) dan Manajemen Pembelajaran Modern berbasis **CodeIgniter 4** & **PHP 8.x**.

---

## 🚀 Fitur Unggulan

- **Computer Based Test (CBT):**
  - Pembuatan & pengelolaan bank soal lengkap (Pilihan Ganda, Essay, Menjodohkan, dsb).
  - Manajemen jadwal ujian, alokasi ruang, sesi, dan pengawas.
  - Token ujian dinamis & acak soal/opsi otomatis.
  - Analisis butir soal, rekapitulasi nilai otomatis, dan ekspor excel.
- **E-Learning & Manajemen Sekolah:**
  - Data Master: Siswa, Guru, Kelas, Jurusan, Mata Pelajaran, Tahun Ajaran & Semester.
  - Modul Buku Induk Digital & Buku Rapor.
  - Perpustakaan Buku Digital Terintegrasi.
  - Kartu Peserta Ujian & Kartu Guru siap cetak.
- **Instalasi Mudah (Web Wizard):**
  - Dilengkapi pemandu instalasi visual (*Step-by-Step Installer*) tanpa perlu import database manual lewat phpMyAdmin.

---

## 💻 Kebutuhan Sistem (System Requirements)

- **PHP:** Versi 8.1, 8.2, 8.3 atau yang lebih baru.
- **Ekstensi PHP:** `mysqli`, `curl`, `mbstring`, `intl`, `json`, `gd`.
- **Database:** MySQL 8.x atau MariaDB (10.4+).
- **Web Server:** Apache / Nginx / Laragon / XAMPP.

---

## 🛠️ Panduan Instalasi Cepat

1. **Download & Ekstrak:**
   - Clone repository ini atau klik **Code > Download ZIP**.
   - Ekstrak folder ke dalam direktori web server Anda (misal: `C:\laragon\www\NextGenEdu-CBT` atau `C:\xampp\htdocs\NextGenEdu-CBT`).

2. **Jalankan Web Server:**
   - Pastikan Apache dan MySQL di Laragon / XAMPP Anda sudah dalam status **Running**.

3. **Buka Browser:**
   - Akses URL berikut di browser Anda:
     ```
     http://localhost/NextGenEdu-CBT
     ```
   - Sistem akan otomatis mendeteksi instalasi baru dan mengarahkan Anda ke halaman **Pemandu Instalasi (Web Installer)**.

4. **Selesaikan Wizard:**
   - **Langkah 1 (Database):** Masukkan Host Name (`localhost`), Username (`root`), Password (kosongkan jika tidak ada), dan Nama Database yang diinginkan (misal `cbt_db`). Klik **Tes & Buat Database**.
   - **Langkah 2 (Admin):** Tentukan username dan password untuk akun Administrator.
   - **Langkah 3 (Sekolah):** Masukkan nama sekolah dan informasi profil instansi.
   - **Langkah 4 (Selesai):** Konfirmasi dan simpan. Aplikasi siap digunakan!

---

## 📜 Lisensi & Penggunaan

Aplikasi ini didistribusikan untuk mempermudah kegiatan penilaian dan evaluasi pembelajaran di sekolah/madrasah. Dilarang memperjualbelikan ulang atau menghapus atribusi hak cipta tanpa izin pengembang.
