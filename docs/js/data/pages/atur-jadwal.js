if (typeof pageContents === 'undefined') var pageContents = {};

pageContents['atur-jadwal'] = {
    title: 'Atur Jadwal Pelajaran',
    desc: 'Panduan lengkap mengatur jadwal pelajaran untuk E-Learning di NextGen CBT.',
    html: `
    <div class="content-card">
        <h2><i class="fas fa-calendar-alt"></i> Mengatur Jadwal Pelajaran</h2>
        <p>Jadwal pelajaran mengatur pembelajaran harian untuk setiap kelas dan mata pelajaran. Jadwal ini menjadi dasar untuk kegiatan KBM, absensi, dan manajemen materi pembelajaran. Administrator dan Guru memiliki akses ke menu ini.</p>

        <div class="screenshot-placeholder">
            <i class="fas fa-image"></i>
            <p>Screenshot akan ditambahkan di sini</p>
        </div>

        <hr>
        <h3>🠊 Mengakses Menu Jadwal Pelajaran</h3>
        <ol class="step-list">
            <li>Login sebagai Administrator atau Guru ke sistem</li>
            <li>Buka menu <code class="inline">E-Learning</code></li>
            <li>Klik submenu <code class="inline">Jadwal Pelajaran</code></li>
            <li>Halaman Jadwal Pelajaran akan ditampilkan dengan daftar jadwal yang ada</li>
        </ol>
        <div class="info-box tip">
            <i class="fas fa-info-circle"></i>
            <div><strong>Penting:</strong> Pastikan Setting KBM sudah diatur terlebih dahulu sebelum membuat jadwal pelajaran. Setting KBM mengatur jam pelajaran, istirahat, dan hari efektif.</div>
        </div>
        <hr>
        <h3>🠊 Membuat Jadwal Pelajaran Baru</h3>
        <ol class="step-list">
            <li>Pada halaman Jadwal Pelajaran, klik tombol <code class="inline">+ Tambah Jadwal</code> di pojok kanan atas</li>
            <li>Halaman Buat Jadwal akan ditampilkan dengan form input</li>
            <li>Pilih kelas yang ingin diatur jadwalnya dari dropdown</li>
            <li>Jadwal untuk kelas tersebut akan ditampilkan dalam bentuk tabel harian</li>
            <li>Untuk setiap sel jadwal (hari dan jam), klik untuk mengisi data:
                <ul class="step-list">
                    <li><strong>Hari:</strong> Kolom menunjukkan hari pelajaran (Senin s.d. Sabtu)</li>
                    <li><strong>Jam Ke:</strong> Baris menunjukkan urutan jam pelajaran sesuai Setting KBM</li>
                    <li><strong>Mapel:</strong> Pilih mata pelajaran dari dropdown</li>
                    <li><strong>Guru:</strong> Pilih guru pengajar (otomatis terisi sesuai mapel)</li>
                    <li><strong>Ruang:</strong> Pilih ruang kelas untuk pelajaran tersebut</li>
                </ul>
            </li>
            <li>Klik tombol <code class="inline">Simpan</code> setelah mengisi jadwal</li>
            <li>Jadwal pelajaran akan disimpan dan dapat dilihat di halaman utama</li>
        </ol>

        <div class="info-box tip">
            <i class="fas fa-lightbulb"></i>
            <div><strong>Tips:</strong> Gunakan fitur Copy Jadwal untuk menyalin jadwal dari kelas lain jika struktur jadwal sama. Ini akan menghemat waktu dalam pembuatan jadwal.</div>
        </div>
        <hr>
        <h3>🠊 Mengedit Jadwal Pelajaran</h3>
        <ol class="step-list">
            <li>Pada halaman Jadwal Pelajaran, pilih kelas yang ingin diedit jadwalnya</li>
            <li>Klik tombol <code class="inline">Edit</code> pada jadwal kelas tersebut</li>
            <li>Tabel jadwal akan ditampilkan</li>
            <li>Klik pada sel yang ingin diubah</li>
            <li>Ubah data jadwal sesuai kebutuhan</li>
            <li>Klik tombol <code class="inline">Simpan</code></li>
            <li>Jadwal akan diperbarui</li>
        </ol>

        <div class="info-box warning">
            <i class="fas fa-exclamation-triangle"></i>
            <div>
                <strong>Peringatan:</strong>
                <ul>
                    <li>Perubahan jadwal akan mempengaruhi absensi dan materi yang terkait</li>
                    <li>Pastikan untuk mengkomunikasikan perubahan jadwal kepada guru dan siswa</li>
                    <li>Jadwal yang sudah digunakan untuk absensi tidak dapat dihapus</li>
                </ul>
            </div>
        </div>
        <hr>
        <h3>🠊 Menghapus Jadwal Pelajaran</h3>
        <ol class="step-list">
            <li>Pada halaman Jadwal Pelajaran, pilih kelas yang ingin dihapus jadwalnya</li>
            <li>Klik tombol <code class="inline">Hapus</code> pada jadwal kelas tersebut</li>
            <li>Konfirmasi akan muncul</li>
            <li>Klik tombol konfirmasi untuk melanjutkan</li>
            <li>Jadwal akan dihapus beserta semua data terkait</li>
        </ol>

        <div class="info-box warning">
            <i class="fas fa-exclamation-triangle"></i>
            <div>
                <strong>Peringatan:</strong>
                <ul>
                    <li>Jadwal yang sudah digunakan untuk absensi tidak dapat dihapus</li>
                    <li>Tindakan ini akan menghapus semua jadwal pelajaran untuk kelas tersebut</li>
                    <li>Tindakan ini tidak dapat dibatalkan</li>
                </ul>
            </div>
        </div>
        <hr>
        <h3>🠊 Filter Jadwal Pelajaran</h3>
        <ol class="step-list">
            <li>Gunakan dropdown <code class="inline">Filter</code> untuk memfilter berdasarkan:
                <ul class="step-list">
                    <li>Semua: Menampilkan semua jadwal pelajaran</li>
                    <li>Kelas: Filter berdasarkan kelas</li>
                    <li>Hari: Filter berdasarkan hari tertentu</li>
                    <li>Mapel: Filter berdasarkan mata pelajaran</li>
                </ul>
            </li>
            <li>Pilih filter yang diinginkan</li>
            <li>Dropdown tambahan akan muncul sesuai filter yang dipilih</li>
            <li>Tabel akan menampilkan jadwal sesuai filter</li>
        </ol>

        <div class="info-box tip">
            <i class="fas fa-lightbulb"></i>
            <div><strong>Tips:</strong> Filter sangat berguna untuk menemukan jadwal tertentu dengan cepat, terutama jika jumlah kelas sangat banyak.</div>
        </div>
        <hr>
        <h3>🠊 Copy Jadwal Pelajaran</h3>
        <ol class="step-list">
            <li>Pada halaman Jadwal Pelajaran, klik tombol <code class="inline">Copy Jadwal</code></li>
            <li>Modal akan muncul dengan pilihan copy</li>
            <li>Pilih kelas sumber yang jadwalnya ingin disalin</li>
            <li>Pilih kelas tujuan yang akan menerima jadwal</li>
            <li>Pilih hari yang ingin disalin atau pilih semua hari</li>
            <li>Klik tombol <code class="inline">Proses</code></li>
            <li>Jadwal akan disalin ke kelas tujuan</li>
        </ol>

        <div class="info-box tip">
            <i class="fas fa-lightbulb"></i>
            <div><strong>Tips:</strong> Fitur Copy sangat berguna untuk kelas dengan struktur jadwal yang sama, misalnya kelas paralel. Pastikan guru pengampu sudah disesuaikan setelah copy.</div>
        </div>
        <hr>
        <h3>🠊 Tips & Best Practices</h3>
        <ol class="step-list">
            <li><strong>Setting KBM dulu:</strong> Atur Setting KBM sebelum membuat jadwal pelajaran</li>
            <li><strong>Copy untuk efisiensi:</strong> Gunakan Copy Jadwal untuk kelas dengan struktur sama</li>
            <li><strong>Konsistensi:</strong> Pastikan jadwal konsisten dengan kurikulum dan beban guru</li>
            <li><strong>Kapasitas ruang:</strong> Perhatikan kapasitas ruang saat menentukan jadwal</li>
            <li><strong>Komunikasi:</strong> Komunikasikan jadwal kepada guru dan siswa</li>
            <li><strong>Review:</strong> Review jadwal sebelum mengaktifkannya</li>
            <li><strong>Backup:</strong> Gunakan Copy untuk backup jadwal sebelum mengubah</li>
            <li><strong>Dokumentasi:</strong> Dokumentasikan format jadwal untuk referensi tim</li>
            <li><strong>Testing:</strong> Coba uji coba jadwal sebelum implementasi penuh</li>
            <li><strong>Update berkala:</strong> Review dan update jadwal secara berkala</li>
        </ol>
        <hr>
        <h3>🠊 Troubleshooting: Masalah Umum dan Solusi</h3>
        <div class="info-box danger">
            <i class="fas fa-times-circle"></i>
            <div class="d-flex flex-column">
                <strong>Tidak bisa membuat jadwal:</strong>
                <span>Pastikan Setting KBM sudah diatur. Pastikan kelas sudah dibuat untuk tahun pelajaran dan semester aktif. Pastikan mapel dan guru sudah ada di sistem.</span>
            </div>
        </div>
        <div class="info-box danger">
            <i class="fas fa-times-circle"></i>
            <div class="d-flex flex-column">
                <strong>Jam pelajaran tidak muncul:</strong>
                <span>Pastikan Setting KBM sudah diatur dengan jam pelajaran yang sesuai. Jam pelajaran di jadwal mengikuti konfigurasi di Setting KBM.</span>
            </div>
        </div>
        <div class="info-box danger">
            <i class="fas fa-times-circle"></i>
            <div class="d-flex flex-column">
                <strong>Guru tidak muncul di dropdown:</strong>
                <span>Pastikan guru sudah ditugaskan sebagai pengampu mapel di menu Jabatan Guru. Pastikan mapel sudah dipilih terlebih dahulu.</span>
            </div>
        </div>
        <div class="info-box danger">
            <i class="fas fa-times-circle"></i>
            <div class="d-flex flex-column">
                <strong>Tidak bisa mengedit jadwal:</strong>
                <span>Jadwal yang sudah digunakan untuk absensi tidak dapat diedit. Hapus atau pindahkan data absensi terlebih dahulu.</span>
            </div>
        </div>
        <div class="info-box danger">
            <i class="fas fa-times-circle"></i>
            <div class="d-flex flex-column">
                <strong>Copy jadwal gagal:</strong>
                <span>Pastikan kelas sumber dan tujuan sudah ada. Pastikan struktur jam pelajaran sama antara kelas sumber dan tujuan.</span>
            </div>
        </div>
        <hr>
        <h3>🠊 Catatan Penting</h3>
        <div class="info-box info">
            <i class="fas fa-info-circle"></i>
            <div>
                <strong>Data per tahun pelajaran:</strong> Jadwal pelajaran dibuat per tahun pelajaran dan semester. Data di tahun pelajaran berbeda adalah data yang terpisah.
            </div>
        </div>
        <div class="info-box info">
            <i class="fas fa-info-circle"></i>
            <div>
                <strong>Ketergantungan Setting KBM:</strong> Jadwal pelajaran mengikuti konfigurasi Setting KBM. Perubahan di Setting KBM akan mempengaruhi tampilan jadwal pelajaran.
            </div>
        </div>
        <div class="info-box info">
            <i class="fas fa-info-circle"></i>
            <div>
                <strong>Akses Guru:</strong> Guru hanya dapat melihat dan mengelola jadwal untuk kelas yang mereka ampu. Administrator memiliki akses penuh ke semua jadwal.
            </div>
        </div>
        <div class="info-box info">
            <i class="fas fa-info-circle"></i>
            <div>
                <strong>Integrasi dengan Absensi:</strong> Jadwal pelajaran digunakan sebagai dasar untuk sistem absensi. Pastikan jadwal akurat sebelum mulai menggunakan absensi.
            </div>
        </div>
    </div>`
};
