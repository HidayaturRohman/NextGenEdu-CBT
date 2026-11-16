if (typeof pageContents === 'undefined') var pageContents = {};

pageContents['buat-tugas'] = {
    title: 'Buat Tugas',
    desc: 'Panduan lengkap membuat tugas baru untuk siswa di NextGen CBT.',
    html: `
    <div class="content-card">
        <h2><i class="fas fa-tasks"></i> Membuat Tugas Baru</h2>
        <p>Tugas adalah pekerjaan yang diberikan guru kepada siswa untuk dikerjakan di luar jam pelajaran. Tugas dapat berupa tugas tertulis, proyek, atau pekerjaan rumah lainnya. Guru memiliki akses ke menu ini untuk mengelola tugas pembelajaran.</p>

        <div class="screenshot-placeholder">
            <i class="fas fa-image"></i>
            <p>Screenshot akan ditambahkan di sini</p>
        </div>

        <hr>
        <h3>🠊 Mengakses Menu Tugas</h3>
        <ol class="step-list">
            <li>Login sebagai Guru ke sistem</li>
            <li>Buka menu <code class="inline">E-Learning</code></li>
            <li>Klik submenu <code class="inline">Tugas</code></li>
            <li>Halaman Tugas akan ditampilkan dengan daftar tugas yang ada</li>
        </ol>
        <div class="info-box tip">
            <i class="fas fa-info-circle"></i>
            <div><strong>Penting:</strong> Pastikan mata pelajaran dan kelas sudah diatur sebelum membuat tugas. Tugas akan dapat diakses oleh siswa sesuai kelas yang ditentukan.</div>
        </div>
        <hr>
        <h3>🠊 Membuat Tugas Baru</h3>
        <ol class="step-list">
            <li>Pada halaman Tugas, klik tombol <code class="inline">+ Buat Tugas</code> di pojok kanan atas</li>
            <li>Halaman Buat Tugas akan ditampilkan dengan form input</li>
            <li>Isi formulir tugas:
                <ul class="step-list">
                    <li><strong>Judul Tugas:</strong> Judul tugas (wajib diisi, maksimal 100 karakter)</li>
                    <li><strong>Mata Pelajaran:</strong> Pilih mata pelajaran dari dropdown</li>
                    <li><strong>Kelas:</strong> Pilih kelas yang dituju (bisa multiple)</li>
                    <li><strong>Deskripsi:</strong> Deskripsi tugas (wajib diisi, maksimal 1000 karakter)</li>
                    <li><strong>File Lampiran:</strong> Upload file tugas (opsional, maksimal 10MB)</li>
                    <li><strong>Tenggat Waktu:</strong> Batas waktu pengumpulan tugas (wajib diisi)</li>
                    <li><strong>Bobot Nilai:</strong> Nilai maksimal tugas (wajib diisi, default 100)</li>
                    <li><strong>Status:</strong> Pilih status tugas (Aktif atau Non Aktif)</li>
                </ul>
            </li>
            <li>Periksa ringkasan informasi yang ditampilkan</li>
            <li>Klik tombol <code class="inline">Simpan</code></li>
            <li>Tugas baru akan dibuat dan dapat diakses oleh siswa</li>
        </ol>

        <div class="info-box tip">
            <i class="fas fa-lightbulb"></i>
            <div><strong>Tips:</strong> Gunakan judul yang deskriptif dan mudah dipahami. Set tenggat waktu yang realistis dan berikan deskripsi yang jelas agar siswa memahami apa yang harus dikerjakan.</div>
        </div>
        <hr>
        <h3>🠊 Format File Lampiran</h3>
        <ol class="step-list">
            <li><strong>PDF (.pdf):</strong> Dokumen PDF, cocok untuk instruksi tugas</li>
            <li><strong>Microsoft Word (.doc, .docx):</strong> Dokumen Word, dapat diedit</li>
            <li><strong>Microsoft PowerPoint (.ppt, .pptx):</strong> Presentasi PowerPoint</li>
            <li><strong>Excel (.xls, .xlsx):</strong> Spreadsheet Excel</li>
            <li><strong>Image (.jpg, .png, .gif):</strong> File gambar</li>
        </ol>

        <div class="info-box warning">
            <i class="fas fa-exclamation-triangle"></i>
            <div>
                <strong>Peringatan:</strong>
                <ul>
                    <li>Batasi ukuran file maksimal 10MB per file</li>
                    <li>Pastikan file tidak mengandung virus atau malware</li>
                    <li>Gunakan format yang kompatibel dengan perangkat siswa</li>
                </ul>
            </div>
        </div>
        <hr>
        <h3>🠊 Mengedit Tugas</h3>
        <ol class="step-list">
            <li>Pada halaman Tugas, cari tugas yang ingin diedit</li>
            <li>Klik tombol <code class="inline">Edit</code> pada tugas tersebut</li>
            <li>Ubah data tugas sesuai kebutuhan</li>
            <li>Klik tombol <code class="inline">Simpan</code></li>
            <li>Tugas akan diperbarui</li>
        </ol>

        <div class="info-box warning">
            <i class="fas fa-exclamation-triangle"></i>
            <div>
                <strong>Peringatan:</strong>
                <ul>
                    <li>Perubahan tugas akan langsung terlihat oleh siswa</li>
                    <li>Pastikan untuk mengkomunikasikan perubahan kepada siswa</li>
                    <li>Tenggat waktu tidak dapat diubah jika siswa sudah mulai mengumpulkan</li>
                </ul>
            </div>
        </div>
        <hr>
        <h3>🠊 Menghapus Tugas</h3>
        <ol class="step-list">
            <li>Pada halaman Tugas, cari tugas yang ingin dihapus</li>
            <li>Klik tombol <code class="inline">Hapus</code> pada tugas tersebut</li>
            <li>Konfirmasi akan muncul</li>
            <li>Klik tombol konfirmasi untuk melanjutkan</li>
            <li>Tugas akan dihapus dan tidak dapat diakses oleh siswa</li>
        </ol>

        <div class="info-box warning">
            <i class="fas fa-exclamation-triangle"></i>
            <div>
                <strong>Peringatan:</strong>
                <ul>
                    <li>Tugas yang sudah diakses oleh siswa tidak dapat dihapus</li>
                    <li>Tugas yang sudah memiliki nilai tidak dapat dihapus</li>
                    <li>Tindakan ini tidak dapat dibatalkan</li>
                </ul>
            </div>
        </div>
        <hr>
        <h3>🠊 Filter Tugas</h3>
        <ol class="step-list">
            <li>Gunakan dropdown <code class="inline">Filter</code> untuk memfilter berdasarkan:
                <ul class="step-list">
                    <li>Semua: Menampilkan semua tugas</li>
                    <li>Mapel: Filter berdasarkan mata pelajaran</li>
                    <li>Kelas: Filter berdasarkan kelas</li>
                    <li>Status: Filter berdasarkan status tugas</li>
                </ul>
            </li>
            <li>Pilih filter yang diinginkan</li>
            <li>Dropdown tambahan akan muncul sesuai filter yang dipilih</li>
            <li>Tabel akan menampilkan tugas sesuai filter</li>
        </ol>

        <div class="info-box tip">
            <i class="fas fa-lightbulb"></i>
            <div><strong>Tips:</strong> Filter sangat berguna untuk menemukan tugas tertentu dengan cepat, terutama jika jumlah tugas sangat banyak.</div>
        </div>
        <hr>
        <h3>🠊 Tips & Best Practices</h3>
        <ol class="step-list">
            <li><strong>Judul deskriptif:</strong> Gunakan judul yang jelas dan deskriptif</li>
            <li><strong>Deskripsi lengkap:</strong> Berikan deskripsi yang informatif dan jelas</li>
            <li><strong>Tenggat realistis:</strong> Set tenggat waktu yang realistis</li>
            <li><strong>Bobot nilai:</strong> Sesuaikan bobot nilai dengan kompleksitas tugas</li>
            <li><strong>File lampiran:</strong> Gunakan file lampiran untuk instruksi lengkap</li>
            <li><strong>Status aktif:</strong> Set status ke Non Aktif jika tugas tidak digunakan</li>
            <li><strong>Komunikasi:</strong> Komunikasikan tugas baru kepada siswa</li>
            <li><strong>Review:</strong> Review tugas sebelum mempublikasikan</li>
            <li><strong>Backup:</strong> Selalu backup tugas sebelum menghapus</li>
            <li><strong>Monitoring:</strong> Monitor pengumpulan tugas secara berkala</li>
        </ol>
        <hr>
        <h3>🠊 Troubleshooting: Masalah Umum dan Solusi</h3>
        <div class="info-box danger">
            <i class="fas fa-times-circle"></i>
            <div class="d-flex flex-column">
                <strong>Tidak bisa membuat tugas:</strong>
                <span>Pastikan semua field wajib sudah terisi. Pastikan file lampiran tidak melebihi 10MB. Periksa koneksi internet saat menyimpan.</span>
            </div>
        </div>
        <div class="info-box danger">
            <i class="fas fa-times-circle"></i>
            <div class="d-flex flex-column">
                <strong>Upload file gagal:</strong>
                <span>Pastikan ukuran file tidak melebihi 10MB. Pastikan format file didukung. Periksa koneksi internet dan coba lagi.</span>
            </div>
        </div>
        <div class="info-box danger">
            <i class="fas fa-times-circle"></i>
            <div class="d-flex flex-column">
                <strong>Kelas tidak muncul di dropdown:</strong>
                <span>Pastikan kelas sudah dibuat untuk tahun pelajaran dan semester aktif. Pastikan guru sudah ditugaskan ke kelas dan mapel yang sesuai.</span>
            </div>
        </div>
        <div class="info-box danger">
            <i class="fas fa-times-circle"></i>
            <div class="d-flex flex-column">
                <strong>Tidak bisa mengedit tugas:</strong>
                <span>Tugas yang sudah diakses oleh siswa atau sudah memiliki nilai tidak dapat diedit. Hapus atau arsipkan tugas terlebih dahulu jika perlu perubahan.</span>
            </div>
        </div>
        <div class="info-box danger">
            <i class="fas fa-times-circle"></i>
            <div class="d-flex flex-column">
                <strong>Tugas tidak muncul untuk siswa:</strong>
                <span>Pastikan status tugas Aktif. Pastikan kelas siswa sesuai dengan kelas yang ditentukan saat membuat tugas.</span>
            </div>
        </div>
        <hr>
        <h3>🠊 Catatan Penting</h3>
        <div class="info-box info">
            <i class="fas fa-info-circle"></i>
            <div>
                <strong>Data per tahun pelajaran:</strong> Tugas dibuat per tahun pelajaran dan semester. Data di tahun pelajaran berbeda adalah data yang terpisah.
            </div>
        </div>
        <div class="info-box info">
            <i class="fas fa-info-circle"></i>
            <div>
                <strong>Status Tugas:</strong> Tugas dengan status Non Aktif tidak akan muncul untuk siswa. Gunakan status ini untuk tugas yang sedang dalam proses atau tidak digunakan sementara.
            </div>
        </div>
        <div class="info-box info">
            <i class="fas fa-info-circle"></i>
            <div>
                <strong>Akses Siswa:</strong> Siswa hanya dapat melihat tugas untuk kelas mereka sendiri. Guru dapat melihat semua tugas yang mereka buat.
            </div>
        </div>
        <div class="info-box info">
            <i class="fas fa-info-circle"></i>
            <div>
                <strong>Integrasi dengan Nilai:</strong> Nilai tugas akan otomatis masuk ke perhitungan nilai rapor jika mapel terkait diatur untuk menyertakan nilai tugas.
            </div>
        </div>
    </div>`
};
