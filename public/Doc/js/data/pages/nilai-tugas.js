if (typeof pageContents === 'undefined') var pageContents = {};

pageContents['nilai-tugas'] = {
    title: 'Nilai Tugas',
    desc: 'Panduan lengkap memberikan nilai pada tugas siswa di NextGen CBT.',
    html: `
    <div class="content-card">
        <h2><i class="fas fa-star"></i> Memberikan Nilai Tugas</h2>
        <p>Setelah siswa mengumpulkan tugas, guru dapat memberikan nilai dan feedback. Nilai tugas akan otomatis masuk ke perhitungan nilai rapor jika mapel terkait diatur untuk menyertakan nilai tugas. Guru memiliki akses ke menu ini untuk menilai tugas siswa.</p>

        <div class="screenshot-placeholder">
            <i class="fas fa-image"></i>
            <p>Screenshot akan ditambahkan di sini</p>
        </div>

        <hr>
        <h3>🠊 Mengakses Menu Nilai Tugas</h3>
        <ol class="step-list">
            <li>Login sebagai Guru ke sistem</li>
            <li>Buka menu <code class="inline">E-Learning</code></li>
            <li>Klik submenu <code class="inline">Tugas</code></li>
            <li>Klik tab <code class="inline">Nilai Tugas</code></li>
            <li>Halaman Nilai Tugas akan ditampilkan</li>
        </ol>
        <div class="info-box tip">
            <i class="fas fa-info-circle"></i>
            <div><strong>Penting:</strong> Pastikan tugas sudah dibuat dan siswa sudah mengumpulkan tugas sebelum melakukan penilaian. Nilai akan dihitung berdasarkan bobot yang ditentukan saat membuat tugas.</div>
        </div>
        <hr>
        <h3>🠊 Melakukan Penilaian</h3>
        <ol class="step-list">
            <li>Pada halaman Nilai Tugas, pilih tugas yang ingin dinilai dari dropdown</li>
            <li>Daftar siswa yang telah mengumpulkan tugas akan ditampilkan</li>
            <li>Klik pada nama siswa untuk melihat hasil tugas</li>
            <li>Halaman detail penilaian akan ditampilkan dengan:
                <ul class="step-list">
                    <li><strong>File Tugas:</strong> File yang diupload siswa</li>
                    <li><strong>Tanggal Pengumpulan:</strong> Waktu siswa mengumpulkan tugas</li>
                    <li><strong>Input Nilai:</strong> Input nilai (0 s.d. bobot maksimal)</li>
                    <li><strong>Feedback:</strong> Catatan atau feedback untuk siswa</li>
                </ul>
            </li>
            <li>Beri nilai sesuai kriteria penilaian</li>
            <li>Tambahkan catatan atau feedback jika diperlukan</li>
            <li>Klik tombol <code class="inline">Simpan</code></li>
            <li>Nilai akan disimpan dan dapat dilihat oleh siswa</li>
        </ol>

        <div class="info-box tip">
            <i class="fas fa-lightbulb"></i>
            <div><strong>Tips:</strong> Berikan feedback yang konstruktif untuk membantu siswa meningkatkan. Nilai yang diberikan tidak boleh melebihi bobot maksimal tugas.</div>
        </div>
        <hr>
        <h3>🠊 Fitur Penilaian</h3>
        <ol class="step-list">
            <li><strong>Lihat File Tugas:</strong> Download dan lihat file tugas yang diupload siswa</li>
            <li><strong>Beri Nilai:</strong> Input nilai sesuai bobot yang ditentukan</li>
            <li><strong>Tambah Feedback:</strong> Berikan catatan atau feedback untuk siswa</li>
            <li><strong>Rekap Nilai:</strong> Lihat rekap nilai otomatis untuk semua siswa</li>
            <li><strong>Export Nilai:</strong> Export nilai ke format Excel jika diperlukan</li>
            <li><strong>Status Penilaian:</strong> Lihat status penilaian (Sudah/Belum Dinilai)</li>
        </ol>

        <div class="info-box tip">
            <i class="fas fa-lightbulb"></i>
            <div><strong>Tips:</strong> Gunakan fitur rekap nilai untuk melihat overview penilaian seluruh siswa. Export nilai untuk dokumentasi atau laporan.</div>
        </div>
        <hr>
        <h3>🠊 Mengedit Nilai</h3>
        <ol class="step-list">
            <li>Pada halaman Nilai Tugas, cari siswa yang nilainya ingin diedit</li>
            <li>Klik tombol <code class="inline">Edit</code> pada nilai tersebut</li>
            <li>Ubah nilai dan feedback sesuai kebutuhan</li>
            <li>Klik tombol <code class="inline">Simpan</code></li>
            <li>Nilai akan diperbarui</li>
        </ol>

        <div class="info-box warning">
            <i class="fas fa-exclamation-triangle"></i>
            <div>
                <strong>Peringatan:</strong>
                <ul>
                    <li>Perubahan nilai akan langsung terlihat oleh siswa</li>
                    <li>Pastikan untuk mengkomunikasikan perubahan kepada siswa</li>
                    <li>Nilai yang sudah masuk ke rapor tidak dapat diubah</li>
                </ul>
            </div>
        </div>
        <hr>
        <h3>🠊 Rekap Nilai</h3>
        <ol class="step-list">
            <li>Pada halaman Nilai Tugas, klik tombol <code class="inline">Rekap Nilai</code></li>
            <li>Tabel rekap nilai akan ditampilkan dengan:
                <ul class="step-list">
                    <li><strong>Nama Siswa:</strong> Nama siswa</li>
                    <li><strong>Nilai:</strong> Nilai yang diberikan</li>
                    <li><strong>Feedback:</strong> Feedback yang diberikan</li>
                    <li><strong>Status:</strong> Status penilaian</li>
                </ul>
            </li>
            <li>Gunakan filter untuk mempersempit hasil</li>
            <li>Klik tombol <code class="inline">Export</code> untuk download rekap</li>
        </ol>

        <div class="info-box tip">
            <i class="fas fa-lightbulb"></i>
            <div><strong>Tips:</strong> Rekap nilai sangat berguna untuk melihat overview penilaian seluruh siswa dalam satu tugas. Export rekap untuk dokumentasi atau laporan.</div>
        </div>
        <hr>
        <h3>🠊 Tips & Best Practices</h3>
        <ol class="step-list">
            <li><strong>Penilaian objektif:</strong> Berikan nilai secara objektif berdasarkan kriteria</li>
            <li><strong>Feedback konstruktif:</strong> Berikan feedback yang membantu siswa meningkat</li>
            <li><strong>Konsistensi:</strong> Berikan nilai secara konsisten untuk semua siswa</li>
            <li><strong>Waktu penilaian:</strong> Nilai tugas segera setelah tenggat waktu</li>
            <li><strong>Dokumentasi:</strong> Gunakan rekap nilai untuk dokumentasi</li>
            <li><strong>Komunikasi:</strong> Komunikasikan nilai dan feedback kepada siswa</li>
            <li><strong>Review:</strong> Review nilai sebelum mempublikasikan</li>
            <li><strong>Backup:</strong> Export rekap nilai untuk backup</li>
            <li><strong>Transparansi:</strong> Jelaskan kriteria penilaian kepada siswa</li>
            <li><strong>Monitoring:</strong> Monitor progress penilaian secara berkala</li>
        </ol>
        <hr>
        <h3>🠊 Troubleshooting: Masalah Umum dan Solusi</h3>
        <div class="info-box danger">
            <i class="fas fa-times-circle"></i>
            <div class="d-flex flex-column">
                <strong>Tidak bisa memberikan nilai:</strong>
                <span>Pastikan siswa sudah mengumpulkan tugas. Pastikan nilai tidak melebihi bobot maksimal tugas. Periksa koneksi internet saat menyimpan.</span>
            </div>
        </div>
        <div class="info-box danger">
            <i class="fas fa-times-circle"></i>
            <div class="d-flex flex-column">
                <strong>File tugas tidak dapat dibuka:</strong>
                <span>Pastikan file masih ada di server. Periksa format file dan pastikan kompatibel dengan perangkat Anda. Coba download file terlebih dahulu.</span>
            </div>
        </div>
        <div class="info-box danger">
            <i class="fas fa-times-circle"></i>
            <div class="d-flex flex-column">
                <strong>Nilai tidak tersimpan:</strong>
                <span>Pastikan nilai tidak melebihi bobot maksimal. Periksa koneksi internet saat menyimpan. Coba lagi atau hubungi administrator.</span>
            </div>
        </div>
        <div class="info-box danger">
            <i class="fas fa-times-circle"></i>
            <div class="d-flex flex-column">
                <strong>Tidak bisa mengedit nilai:</strong>
                <span>Nilai yang sudah masuk ke perhitungan rapor tidak dapat diubah. Hubungi administrator jika perlu perubahan nilai.</span>
            </div>
        </div>
        <div class="info-box danger">
            <i class="fas fa-times-circle"></i>
            <div class="d-flex flex-column">
                <strong>Rekap nilai tidak muncul:</strong>
                <span>Pastikan tugas sudah dipilih dengan benar. Pastikan ada siswa yang sudah mengumpulkan tugas. Periksa filter yang digunakan.</span>
            </div>
        </div>
        <hr>
        <h3>🠊 Catatan Penting</h3>
        <div class="info-box info">
            <i class="fas fa-info-circle"></i>
            <div>
                <strong>Data per tahun pelajaran:</strong> Nilai tugas dibuat per tahun pelajaran dan semester. Data di tahun pelajaran berbeda adalah data yang terpisah.
            </div>
        </div>
        <div class="info-box info">
            <i class="fas fa-info-circle"></i>
            <div>
                <strong>Integrasi dengan Rapor:</strong> Nilai tugas akan otomatis masuk ke perhitungan nilai rapor jika mapel terkait diatur untuk menyertakan nilai tugas.
            </div>
        </div>
        <div class="info-box info">
            <i class="fas fa-info-circle"></i>
            <div>
                <strong>Akses Guru:</strong> Guru hanya dapat melihat dan menilai tugas untuk kelas yang mereka ampu. Administrator memiliki akses penuh ke semua nilai.
            </div>
        </div>
        <div class="info-box info">
            <i class="fas fa-info-circle"></i>
            <div>
                <strong>Bobot Nilai:</strong> Nilai yang diberikan tidak boleh melebihi bobot maksimal tugas. Bobot ditentukan saat membuat tugas.
            </div>
        </div>
    </div>`
};
