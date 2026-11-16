const menuData = [
    {
        section: 'Mulai',
        items: [
            {
                id: 'pendahuluan',
                icon: 'fas fa-book-open',
                label: 'Pendahuluan',
                children: [
                    { id: 'tentang-aplikasi', label: 'Tentang NextGenEdu CBT', prev: null, next: 'persyaratan-sistem' },
                    { id: 'persyaratan-sistem', label: 'Persyaratan Sistem', prev: 'tentang-aplikasi', next: 'tentang-panduan' },
                    { id: 'tentang-panduan', label: 'Tentang Panduan', prev: 'persyaratan-sistem', next: 'instalasi' }
                ]
            },
            {
                id: 'memulai',
                icon: 'fas fa-rocket',
                label: 'Memulai',
                children: [
                    { id: 'instalasi', label: 'Instalasi & Hosting', prev: 'tentang-panduan', next: 'konfigurasi-awal' },
                    { id: 'konfigurasi-awal', label: 'Konfigurasi Awal', prev: 'instalasi', next: 'login-pertama' },
                    { id: 'login-pertama', label: 'Login & Autentikasi', prev: 'konfigurasi-awal', next: 'petunjuk-antarmuka' },
                    { id: 'petunjuk-antarmuka', label: 'Petunjuk Antarmuka', prev: 'login-pertama', next: 'alur-awal-tahun' }
                ]
            },
            {
                id: 'alur-kerja',
                icon: 'fas fa-project-diagram',
                label: 'Alur Kerja Utama',
                children: [
                    { id: 'alur-awal-tahun', label: 'Persiapan Awal Tahun Ajaran', prev: 'petunjuk-antarmuka', next: 'alur-ujian-cbt' },
                    { id: 'alur-ujian-cbt', label: 'Menyelenggarakan Ujian CBT', prev: 'alur-awal-tahun', next: 'alur-elearning' },
                    { id: 'alur-elearning', label: 'Pengelolaan E-Learning', prev: 'alur-ujian-cbt', next: 'alur-rapor' },
                    { id: 'alur-rapor', label: 'Penerbitan Rapor IKM', prev: 'alur-elearning', next: 'ringkasan-admin' }
                ]
            }
        ]
    },
    {
        section: 'Dashboard',
        items: [
            {
                id: 'dashboard-admin',
                icon: 'fas fa-user-shield',
                label: 'Dashboard Admin',
                children: [
                    { id: 'ringkasan-admin', label: 'Ringkasan Admin', prev: 'alur-rapor', next: 'info-box' },
                    { id: 'info-box', label: 'Info Box & Widget Statistik', prev: 'ringkasan-admin', next: 'ganti-tahun' },
                    { id: 'ganti-tahun', label: 'Ganti Tahun & Semester', prev: 'info-box', next: 'upload-banner' },
                    { id: 'upload-banner', label: 'Upload Banner Slider', prev: 'ganti-tahun', next: 'ringkasan-guru' }
                ]
            },
            {
                id: 'dashboard-guru',
                icon: 'fas fa-chalkboard-teacher',
                label: 'Dashboard Guru',
                children: [
                    { id: 'ringkasan-guru', label: 'Ringkasan Guru', prev: 'upload-banner', next: 'jadwal-harian' },
                    { id: 'jadwal-harian', label: 'Jadwal Mengajar Harian', prev: 'ringkasan-guru', next: 'ringkasan-siswa' }
                ]
            },
            {
                id: 'dashboard-siswa',
                icon: 'fas fa-user-graduate',
                label: 'Dashboard & Mobile Siswa',
                children: [
                    { id: 'ringkasan-siswa', label: 'Beranda Siswa', prev: 'jadwal-harian', next: 'menu-siswa' },
                    { id: 'menu-siswa', label: '9 Menu Utama Siswa', prev: 'ringkasan-siswa', next: 'siswa-bottom-nav' },
                    { id: 'siswa-bottom-nav', label: 'Navigasi Bawah & Scan QR', prev: 'menu-siswa', next: 'tahun-ajaran' }
                ]
            }
        ]
    },
    {
        section: 'Data Master (Admin)',
        items: [
            {
                id: 'data-umum',
                icon: 'fas fa-server',
                label: 'Data Umum',
                children: [
                    { id: 'tahun-ajaran', label: 'Tahun Pelajaran', prev: 'siswa-bottom-nav', next: 'mata-pelajaran' },
                    { id: 'mata-pelajaran', label: 'Mata Pelajaran', prev: 'tahun-ajaran', next: 'jurusan' },
                    { id: 'jurusan', label: 'Jurusan / Peminatan', prev: 'mata-pelajaran', next: 'kelas-rombel' },
                    { id: 'kelas-rombel', label: 'Kelas / Rombel & Kenaikan', prev: 'jurusan', next: 'data-siswa' },
                    { id: 'data-siswa', label: 'Data Siswa & Mutasi', prev: 'kelas-rombel', next: 'ekstrakurikuler' },
                    { id: 'ekstrakurikuler', label: 'Ekstrakurikuler', prev: 'data-siswa', next: 'data-guru' },
                    { id: 'data-guru', label: 'Data Guru & Pegawai', prev: 'ekstrakurikuler', next: 'jenis-ujian' }
                ]
            }
        ]
    },
    {
        section: 'Ujian CBT',
        items: [
            {
                id: 'data-ujian',
                icon: 'fas fa-project-diagram',
                label: 'Data Ujian & Sesi',
                children: [
                    { id: 'jenis-ujian', label: 'Jenis Ujian', prev: 'data-guru', next: 'sesi' },
                    { id: 'sesi', label: 'Sesi Ujian', prev: 'jenis-ujian', next: 'ruang' },
                    { id: 'ruang', label: 'Ruang Ujian', prev: 'sesi', next: 'nomor-peserta' },
                    { id: 'nomor-peserta', label: 'Nomor Peserta Ujian', prev: 'ruang', next: 'atur-ruang-sesi' },
                    { id: 'atur-ruang-sesi', label: 'Atur Ruang & Sesi Siswa', prev: 'nomor-peserta', next: 'buat-bank-soal' }
                ]
            },
            {
                id: 'bank-soal',
                icon: 'fas fa-folder-open',
                label: 'Bank Soal & Materi Uji',
                children: [
                    { id: 'buat-bank-soal', label: 'Buat Bank Soal', prev: 'atur-ruang-sesi', next: 'tambah-soal' },
                    { id: 'tambah-soal', label: 'Editor Soal & Multimedia', prev: 'buat-bank-soal', next: 'import-soal' },
                    { id: 'import-soal', label: 'Import Excel / Word', prev: 'tambah-soal', next: 'jenis-soal' },
                    { id: 'jenis-soal', label: '5 Tipe Soal AKM', prev: 'import-soal', next: 'buat-jadwal' }
                ]
            },
            {
                id: 'jadwal-cbt',
                icon: 'fas fa-calendar-alt',
                label: 'Jadwal & Pengawasan',
                children: [
                    { id: 'buat-jadwal', label: 'Atur Jadwal Ujian', prev: 'jenis-soal', next: 'alokasi-waktu' },
                    { id: 'alokasi-waktu', label: 'Alokasi Waktu Ujian', prev: 'buat-jadwal', next: 'pengawas' },
                    { id: 'pengawas', label: 'Jadwal Pengawas Ujian', prev: 'alokasi-waktu', next: 'token-cbt' }
                ]
            },
            {
                id: 'pelaksanaan-cbt',
                icon: 'fas fa-laptop-code',
                label: 'Pelaksanaan Ujian',
                children: [
                    { id: 'token-cbt', label: 'Rilis & Kelola Token', prev: 'pengawas', next: 'cetak-cbt' },
                    { id: 'cetak-cbt', label: 'Cetak Kartu, Daftar & Berita', prev: 'token-cbt', next: 'aktivasi-peserta' },
                    { id: 'aktivasi-peserta', label: 'Aktivasi & Reset Login Siswa', prev: 'cetak-cbt', next: 'status-siswa' },
                    { id: 'status-siswa', label: 'Status & Progres Siswa', prev: 'aktivasi-peserta', next: 'monitoring' },
                    { id: 'monitoring', label: 'Live Monitoring Pengawas', prev: 'status-siswa', next: 'exambro-app' },
                    { id: 'exambro-app', label: 'Aplikasi Exambro Android v1.5', prev: 'monitoring', next: 'hasil-ujian' }
                ]
            },
            {
                id: 'hasil-cbt',
                icon: 'fas fa-chart-line',
                label: 'Hasil & Rekap Nilai CBT',
                children: [
                    { id: 'hasil-ujian', label: 'Hasil Ujian Siswa', prev: 'exambro-app', next: 'koreksi' },
                    { id: 'koreksi', label: 'Koreksi Soal Kompleks & Esai', prev: 'hasil-ujian', next: 'rekap-nilai' },
                    { id: 'rekap-nilai', label: 'Rekap Nilai CBT', prev: 'koreksi', next: 'analisis' },
                    { id: 'analisis', label: 'Analisis Butir Soal & Daya Beda', prev: 'rekap-nilai', next: 'cetak-hasil' },
                    { id: 'cetak-hasil', label: 'Cetak Nilai & Berkas Ujian', prev: 'analisis', next: 'presensi-scan-qr' }
                ]
            }
        ]
    },
    {
        section: 'Presensi Siswa',
        items: [
            {
                id: 'presensi-portal',
                icon: 'fas fa-user-check',
                label: 'Presensi QR Siswa',
                children: [
                    { id: 'presensi-scan-qr', label: 'Presensi Scan QR & Kamera Siswa', prev: 'cetak-hasil', next: 'kehadiran-harian' },
                    { id: 'kehadiran-harian', label: 'Presensi Harian', prev: 'presensi-scan-qr', next: 'kehadiran-bulanan' },
                    { id: 'kehadiran-bulanan', label: 'Kehadiran Bulanan & Rekap', prev: 'kehadiran-harian', next: 'atur-jadwal' }
                ]
            }
        ]
    },
    {
        section: 'E-Learning & KBM',
        items: [
            {
                id: 'kbm-jadwal',
                icon: 'fas fa-calendar-day',
                label: 'Jadwal & Setting KBM',
                children: [
                    { id: 'atur-jadwal', label: 'Jadwal Pelajaran KBM', prev: 'kehadiran-bulanan', next: 'kbm-setting' },
                    { id: 'kbm-setting', label: 'Setting Jam Pelajaran KBM', prev: 'atur-jadwal', next: 'copy-jadwal' },
                    { id: 'copy-jadwal', label: 'Salin / Copy Jadwal KBM', prev: 'kbm-setting', next: 'tambah-materi' }
                ]
            },
            {
                id: 'kbm-materi',
                icon: 'fas fa-book-reader',
                label: 'Materi Pembelajaran',
                children: [
                    { id: 'tambah-materi', label: 'Buat & Kelola Materi', prev: 'copy-jadwal', next: 'upload-materi' },
                    { id: 'upload-materi', label: 'Upload Modul & Video', prev: 'tambah-materi', next: 'arsip-materi' },
                    { id: 'arsip-materi', label: 'Arsip Materi KBM', prev: 'upload-materi', next: 'buat-tugas' }
                ]
            },
            {
                id: 'kbm-tugas',
                icon: 'fas fa-tasks',
                label: 'Tugas Siswa',
                children: [
                    { id: 'buat-tugas', label: 'Buat Tugas Interaktif', prev: 'arsip-materi', next: 'nilai-tugas' },
                    { id: 'nilai-tugas', label: 'Pemeriksaan & Nilai Tugas', prev: 'buat-tugas', next: 'nilai-materi-tugas' },
                    { id: 'nilai-materi-tugas', label: 'Status & Nilai Harian KBM', prev: 'nilai-tugas', next: 'rekap-nilai-elearning' },
                    { id: 'rekap-nilai-elearning', label: 'Rekap Nilai Siswa Per Semester', prev: 'nilai-materi-tugas', next: 'perpustakaan' }
                ]
            },
            {
                id: 'kbm-perpus',
                icon: 'fas fa-book',
                label: 'Perpustakaan Digital',
                children: [
                    { id: 'perpustakaan', label: 'E-Perpus & Buku Digital', prev: 'rekap-nilai-elearning', next: 'wali-siswa' }
                ]
            }
        ]
    },
    {
        section: 'Portal Wali Kelas',
        items: [
            {
                id: 'wali-kelas-menu',
                icon: 'fas fa-users-cog',
                label: 'Manajemen Kelas Binaan',
                children: [
                    { id: 'wali-siswa', label: 'Daftar Siswa Binaan', prev: 'perpustakaan', next: 'wali-struktur' },
                    { id: 'wali-struktur', label: 'Struktur Organisasi Kelas', prev: 'wali-siswa', next: 'wali-catatan' },
                    { id: 'wali-catatan', label: 'Catatan Bimbingan & Guru', prev: 'wali-struktur', next: 'setting-rapor' }
                ]
            }
        ]
    },
    {
        section: 'Rapor Kurikulum Merdeka & K13',
        items: [
            {
                id: 'pengaturan-rapor',
                icon: 'fas fa-cogs',
                label: 'Pengaturan Rapor (Admin)',
                children: [
                    { id: 'setting-rapor', label: 'Setting Rapor & IKM', prev: 'wali-catatan', next: 'rapor-mapel' },
                    { id: 'rapor-mapel', label: 'Mata Pelajaran & Urutan Rapor', prev: 'setting-rapor', next: 'kktp-tp' }
                ]
            },
            {
                id: 'acuan-penilaian',
                icon: 'fas fa-balance-scale',
                label: 'Data Acuan Rapor (Guru)',
                children: [
                    { id: 'kktp-tp', label: 'Tujuan Pembelajaran (TP) & KKTP', prev: 'rapor-mapel', next: 'kkm' },
                    { id: 'kkm', label: 'KKM & Kriteria Ketuntasan', prev: 'kktp-tp', next: 'predikat' },
                    { id: 'predikat', label: 'Interval Predikat & Nilai', prev: 'kkm', next: 'bobot-nilai' },
                    { id: 'bobot-nilai', label: 'Bobot Penilaian Sumatif', prev: 'predikat', next: 'template-rapor' },
                    { id: 'template-rapor', label: 'Template Dokumen Rapor', prev: 'bobot-nilai', next: 'aturan-penilaian' },
                    { id: 'aturan-penilaian', label: 'Aturan & Panduan Asesmen', prev: 'template-rapor', next: 'nilai-pengetahuan' }
                ]
            },
            {
                id: 'input-nilai-rapor',
                icon: 'fas fa-pencil-alt',
                label: 'Input Nilai Guru Mapel',
                children: [
                    { id: 'nilai-pengetahuan', label: 'Nilai Sumatif Lingkup Materi / PTS', prev: 'aturan-penilaian', next: 'nilai-keterampilan' },
                    { id: 'nilai-keterampilan', label: 'Nilai Sumatif Akhir Semester (SAS)', prev: 'nilai-pengetahuan', next: 'tarik-nilai-cbt' },
                    { id: 'tarik-nilai-cbt', label: 'Tarik Nilai CBT ke Rapor', prev: 'nilai-keterampilan', next: 'ekstrakurikuler-rapor' },
                    { id: 'ekstrakurikuler-rapor', label: 'Nilai Ekstrakurikuler', prev: 'tarik-nilai-cbt', next: 'status-nilai' }
                ]
            },
            {
                id: 'input-wali-kelas-rapor',
                icon: 'fas fa-chalkboard-teacher',
                label: 'Input Wali Kelas',
                children: [
                    { id: 'status-nilai', label: 'Monitoring Status Nilai', prev: 'ekstrakurikuler-rapor', next: 'projek-p5-p2ra' },
                    { id: 'projek-p5-p2ra', label: 'Kokurikuler P5 & P2RA', prev: 'status-nilai', next: 'sikap' },
                    { id: 'sikap', label: 'Penilaian Sikap Spiritual & Sosial', prev: 'projek-p5-p2ra', next: 'catatan-rapor' },
                    { id: 'catatan-rapor', label: 'Kehadiran & Catatan Rapor', prev: 'sikap', next: 'kenaikan-kelas' },
                    { id: 'kenaikan-kelas', label: 'Kenaikan Kelas & Kelulusan', prev: 'catatan-rapor', next: 'cetak-rapor-siswa' }
                ]
            },
            {
                id: 'cetak-dokumen-rapor',
                icon: 'fas fa-print',
                label: 'Cetak Dokumen & Leger',
                children: [
                    { id: 'cetak-rapor-siswa', label: 'Cetak Rapor STS, SAS & Sampul', prev: 'kenaikan-kelas', next: 'cetak-legger' },
                    { id: 'cetak-legger', label: 'Cetak Legger Nilai Rapor', prev: 'cetak-rapor-siswa', next: 'ranking-dkn' },
                    { id: 'ranking-dkn', label: 'Ranking Kelas & DKN Kelulusan', prev: 'cetak-legger', next: 'kumpulan-rapor' },
                    { id: 'kumpulan-rapor', label: 'Kumpulan Rapor & Buku Induk', prev: 'ranking-dkn', next: 'data-alumni' }
                ]
            },
            {
                id: 'alumni-portal',
                icon: 'fas fa-user-graduate',
                label: 'Data Alumni',
                children: [
                    { id: 'data-alumni', label: 'Penelusuran & Manajemen Alumni', prev: 'kumpulan-rapor', next: 'pengumuman' }
                ]
            }
        ]
    },
    {
        section: 'Komunikasi & Pengaturan',
        items: [
            {
                id: 'informasi-sistem',
                icon: 'fas fa-bullhorn',
                label: 'Informasi & Log',
                children: [
                    { id: 'pengumuman', label: 'Pengumuman Madrasah / Sekolah', prev: 'data-alumni', next: 'log-aktivitas' },
                    { id: 'log-aktivitas', label: 'Log Aktivitas Sistem', prev: 'pengumuman', next: 'profil-sekolah' }
                ]
            },
            {
                id: 'pengaturan-institusi',
                icon: 'fas fa-university',
                label: 'Profil Sekolah / Madrasah',
                children: [
                    { id: 'profil-sekolah', label: 'Profil Institusi & Dual Terminology', prev: 'log-aktivitas', next: 'admin' }
                ]
            },
            {
                id: 'manajemen-user',
                icon: 'fas fa-users-cog',
                label: 'Manajemen Pengguna',
                children: [
                    { id: 'admin', label: 'Akun Administrator', prev: 'profil-sekolah', next: 'user-guru' },
                    { id: 'user-guru', label: 'Akun Guru & Penugasan Mapel', prev: 'admin', next: 'user-siswa' },
                    { id: 'user-siswa', label: 'Akun Siswa & Generate Password', prev: 'user-guru', next: 'backup-restore' }
                ]
            }
        ]
    },
    {
        section: 'Database & Sistem',
        items: [
            {
                id: 'database-util',
                icon: 'fas fa-database',
                label: 'Database Management',
                children: [
                    { id: 'backup-restore', label: 'Backup & Restore Database', prev: 'user-siswa', next: 'db-clear-cleanup' },
                    { id: 'db-clear-cleanup', label: 'Data Manager & Cleanup DB', prev: 'backup-restore', next: 'img-converter' },
                    { id: 'img-converter', label: 'Image Converter (Base64 to File)', prev: 'db-clear-cleanup', next: 'patch-version' },
                    { id: 'patch-version', label: 'Patch Database & Auto-Migrator', prev: 'img-converter', next: 'faq' }
                ]
            },
            {
                id: 'bantuan-panduan',
                icon: 'fas fa-life-ring',
                label: 'Bantuan & Versi',
                children: [
                    { id: 'faq', label: 'Tanya Jawab (FAQ)', prev: 'patch-version', next: 'tips' },
                    { id: 'tips', label: 'Tips & Trik Optimalisasi', prev: 'faq', next: 'changelog' },
                    { id: 'changelog', label: 'Changelog NextGen v1.5', prev: 'tips', next: null }
                ]
            }
        ]
    }
];
