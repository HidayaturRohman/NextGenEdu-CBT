if (typeof pageContents === 'undefined') var pageContents = {};

pageContents['tambah-materi'] = {
    title: 'Tambah Materi',
    desc: 'Panduan lengkap menambahkan materi pembelajaran baru di NextGen CBT.',
    html: `
    <div class="content-card">
        <h2><i class="fas fa-file-alt"></i> Menambah Materi Pembelajaran</h2>
        <p>Materi pembelajaran adalah dokumen atau file yang digunakan guru untuk menyampaikan materi kepada siswa. Materi dapat berupa PDF, dokumen, presentasi, atau file lain yang relevan dengan pembelajaran. Guru memiliki akses ke menu ini untuk mengelola materi pembelajaran.</p>

        <div class="screenshot-placeholder">
            <i class="fas fa-image"></i>
            <p>Screenshot akan ditambahkan di sini</p>
        </div>

        <hr>
        <h3>🠊 Mengakses Menu Materi</h3>
        <ol class="step-list">
            <li>Login sebagai Guru ke sistem</li>
            <li>Buka menu <code class="inline">E-Learning</code></li>
            <li>Klik submenu <code class="inline">Materi</code></li>
            <li>Halaman Materi akan ditampilkan dengan daftar materi yang ada</li>
        </ol>
        <div class="info-box tip">
            <i class="fas fa-info-circle"></i>
            <div><strong>Penting:</strong> Pastikan mata pelajaran dan kelas sudah diatur sebelum menambah materi. Materi akan dapat diakses oleh siswa sesuai kelas yang ditentukan.</div>
        </div>
        <hr>
        <h3>🠊 Menambah Materi Baru</h3>
        <ol class="step-list">
            <li>Pada halaman Materi, klik tombol <code class="inline">+ Tambah Materi</code> di pojok kanan atas</li>
            <li>Halaman Tambah Materi akan ditampilkan dengan form input</li>
            <li>Isi formulir materi:
                <ul class="step-list">
                    <li><strong>Judul Materi:</strong> Judul materi (wajib diisi, maksimal 100 karakter)</li>
                    <li><strong>Mata Pelajaran:</strong> Pilih mata pelajaran dari dropdown</li>
                    <li><strong>Kelas:</strong> Pilih kelas yang dituju (bisa multiple)</li>
                    <li><strong>Deskripsi:</strong> Deskripsi materi (opsional, maksimal 500 karakter)</li>
                    <li><strong>File:</strong> Upload file materi (wajib diisi)</li>
                    <li><strong>Status:</strong> Pilih status materi (Aktif atau Non Aktif)</li>
                </ul>
            </li>
            <li>Klik tombol <code class="inline">Simpan</code></li>
            <li>Materi baru akan ditambahkan dan dapat diakses oleh siswa</li>
        </ol>

        <div class="info-box tip">
            <i class="fas fa-lightbulb"></i>
            <div><strong>Tips:</strong> Gunakan judul yang deskriptif dan mudah dipahami. Format yang konsisten seperti "Bab 1 - [Topik]" akan memudahkan manajemen materi.</div>
        </div>
        <hr>
        <h3>🠊 Format File yang Didukung</h3>
        <ol class="step-list">
            <li><strong>PDF (.pdf):</strong> Dokumen PDF, cocok untuk materi teks dan gambar</li>
            <li><strong>Microsoft Word (.doc, .docx):</strong> Dokumen Word, dapat diedit</li>
            <li><strong>Microsoft PowerPoint (.ppt, .pptx):</strong> Presentasi PowerPoint</li>
            <li><strong>Excel (.xls, .xlsx):</strong> Spreadsheet Excel</li>
            <li><strong>Image (.jpg, .png, .gif):</strong> File gambar</li>
            <li><strong>Video (.mp4, .avi):</strong> File video (tergantung konfigurasi server)</li>
        </ol>

        <div class="info-box warning">
            <i class="fas fa-exclamation-triangle"></i>
            <div>
                <strong>Peringatan:</strong>
                <ul>
                    <li>Batasi ukuran file maksimal 10MB per file untuk menghindari masalah upload</li>
                    <li>Pastikan file tidak mengandung virus atau malware</li>
                    <li>Gunakan format yang kompatibel dengan perangkat siswa</li>
                </ul>
            </div>
        </div>
        <hr>
        <h3>🠊 Mengedit Materi</h3>
        <ol class="step-list">
            <li>Pada halaman Materi, cari materi yang ingin diedit</li>
            <li>Klik tombol <code class="inline">Edit</code> pada materi tersebut</li>
            <li>Ubah data materi sesuai kebutuhan</li>
            <li>Klik tombol <code class="inline">Simpan</code></li>
            <li>Materi akan diperbarui</li>
        </ol>

        <div class="info-box warning">
            <i class="fas fa-exclamation-triangle"></i>
            <div>
                <strong>Peringatan:</strong>
                <ul>
                    <li>Perubahan materi akan langsung terlihat oleh siswa</li>
                    <li>Pastikan untuk mengkomunikasikan perubahan kepada siswa</li>
                    <li>File yang sudah diupload tidak dapat diubah, perlu upload ulang</li>
                </ul>
            </div>
        </div>
        <hr>
        <h3>🠊 Menghapus Materi</h3>
        <ol class="step-list">
            <li>Pada halaman Materi, cari materi yang ingin dihapus</li>
            <li>Klik tombol <code class="inline">Hapus</code> pada materi tersebut</li>
            <li>Konfirmasi akan muncul</li>
            <li>Klik tombol konfirmasi untuk melanjutkan</li>
            <li>Materi akan dihapus dan tidak dapat diakses oleh siswa</li>
        </ol>

        <div class="info-box warning">
            <i class="fas fa-exclamation-triangle"></i>
            <div>
                <strong>Peringatan:</strong>
                <ul>
                    <li>Materi yang sudah diakses oleh siswa tidak dapat dihapus</li>
                    <li>Tindakan ini tidak dapat dibatalkan</li>
                    <li>File fisik akan dihapus dari server</li>
                </ul>
            </div>
        </div>
        <hr>
        <h3>🠊 Filter Materi</h3>
        <ol class="step-list">
            <li>Gunakan dropdown <code class="inline">Filter</code> untuk memfilter berdasarkan:
                <ul class="step-list">
                    <li>Semua: Menampilkan semua materi</li>
                    <li>Mapel: Filter berdasarkan mata pelajaran</li>
                    <li>Kelas: Filter berdasarkan kelas</li>
                    <li>Status: Filter berdasarkan status materi</li>
                </ul>
            </li>
            <li>Pilih filter yang diinginkan</li>
            <li>Dropdown tambahan akan muncul sesuai filter yang dipilih</li>
            <li>Tabel akan menampilkan materi sesuai filter</li>
        </ol>

        <div class="info-box tip">
            <i class="fas fa-lightbulb"></i>
            <div><strong>Tips:</strong> Filter sangat berguna untuk menemukan materi tertentu dengan cepat, terutama jika jumlah materi sangat banyak.</div>
        </div>
        <hr>
        <h3>🠊 Tips & Best Practices</h3>
        <ol class="step-list">
            <li><strong>Judul deskriptif:</strong> Gunakan judul yang jelas dan deskriptif</li>
            <li><strong>Format konsisten:</strong> Gunakan format judul yang konsisten</li>
            <li><strong>Ukuran file:</strong> Kompres file jika ukuran terlalu besar</li>
            <li><strong>Format kompatibel:</strong> Gunakan format yang kompatibel dengan perangkat siswa</li>
            <li><strong>Organisasi:</strong> Kelompokkan materi berdasarkan bab atau topik</li>
            <li><strong>Deskripsi lengkap:</strong> Berikan deskripsi yang informatif</li>
            <li><strong>Status aktif:</strong> Set status ke Non Aktif jika materi tidak digunakan</li>
            <li><strong>Backup:</strong> Selalu backup materi sebelum menghapus</li>
            <li><strong>Review:</strong> Review materi sebelum mempublikasikan</li>
            <li><strong>Komunikasi:</strong> Komunikasikan materi baru kepada siswa</li>
        </ol>
        <hr>
        <h3>🠊 Troubleshooting: Masalah Umum dan Solusi</h3>
        <div class="info-box danger">
            <i class="fas fa-times-circle"></i>
            <div class="d-flex flex-column">
                <strong>Tidak bisa menambah materi:</strong>
                <span>Pastikan semua field wajib sudah terisi. Pastikan file sudah dipilih dan ukurannya tidak melebihi batas. Periksa koneksi internet saat upload.</span>
            </div>
        </div>
        <div class="info-box danger">
            <i class="fas fa-times-circle"></i>
            <div class="d-flex flex-column">
                <strong>Upload gagal:</strong>
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
                <strong>Tidak bisa mengedit materi:</strong>
                <span>Materi yang sudah diakses oleh siswa tidak dapat diedit. Hapus atau arsipkan materi terlebih dahulu jika perlu perubahan.</span>
            </div>
        </div>
        <div class="info-box danger">
            <i class="fas fa-times-circle"></i>
            <div class="d-flex flex-column">
                <strong>Materi tidak muncul untuk siswa:</strong>
                <span>Pastikan status materi Aktif. Pastikan kelas siswa sesuai dengan kelas yang ditentukan saat menambah materi.</span>
            </div>
        </div>
        <hr>
        <h3>🠊 Catatan Penting</h3>
        <div class="info-box info">
            <i class="fas fa-info-circle"></i>
            <div>
                <strong>Data per tahun pelajaran:</strong> Materi dibuat per tahun pelajaran dan semester. Data di tahun pelajaran berbeda adalah data yang terpisah.
            </div>
        </div>
        <div class="info-box info">
            <i class="fas fa-info-circle"></i>
            <div>
                <strong>Status Materi:</strong> Materi dengan status Non Aktif tidak akan muncul untuk siswa. Gunakan status ini untuk materi yang sedang dalam proses atau tidak digunakan sementara.
            </div>
        </div>
        <div class="info-box info">
            <i class="fas fa-info-circle"></i>
            <div>
                <strong>Akses Siswa:</strong> Siswa hanya dapat melihat materi untuk kelas mereka sendiri. Guru dapat melihat semua materi yang mereka buat.
            </div>
        </div>
        <div class="info-box info">
            <i class="fas fa-info-circle"></i>
            <div>
                <strong>Upload Massal:</strong> Untuk upload banyak file sekaligus, gunakan fitur Upload Materi yang tersedia di menu Materi.
            </div>
        </div>
    </div>`
};
