if (typeof pageContents === 'undefined') var pageContents = {};

pageContents['kenaikan-kelas'] = {
    title: 'Kenaikan Kelas & Kelulusan',
    desc: 'Panduan lengkap penentuan status kenaikan kelas atau kelulusan oleh Wali Kelas serta eksekusi migrasi rombel tahun ajaran baru oleh Administrator.',
    html: `
    <div class="content-card">
        <h2><i class="fas fa-graduation-cap text-primary"></i> Kenaikan Kelas &amp; Kelulusan</h2>
        <p>Penentuan <strong>Kenaikan Kelas dan Kelulusan</strong> di <strong>NextGen Garuda CBT Versi 1.5</strong> melibatkan sinergi dua peran penting: <strong>Wali Kelas</strong> yang menentukan keputusan akademik per siswa, serta <strong>Administrator</strong> yang mengeksekusi migrasi rombel massal ke tahun ajaran baru.</p>

        <div class="row g-3 mb-4">
            <div class="col-md-6">
                <div class="card h-100 border-info border-opacity-25 shadow-sm p-3 rounded-3 bg-light">
                    <h5 class="fw-bold text-info"><i class="fas fa-chalkboard-teacher me-2"></i> Peran Wali Kelas (Semester Genap)</h5>
                    <p class="small text-muted mb-0">Wali Kelas membuka menu <code class="inline">Penilaian</code> &gt; <code class="inline">Input Wali Kelas</code> &gt; <code class="inline">Kenaikan Kelas</code> (<code class="inline">/rapor/rapornaik</code>) untuk menetapkan status masing-masing siswa binaan:</p>
                    <ul class="small ps-3 mt-2 mb-0 text-muted">
                        <li><strong>Tingkat Menengah (Kelas 7, 8 / 10, 11):</strong> Pilihan: <em>Naik ke Kelas...</em> atau <em>Tinggal di Kelas...</em></li>
                        <li><strong>Tingkat Akhir (Kelas 9 / 12 / 6):</strong> Pilihan: <em>Lulus</em> atau <em>Tidak Lulus</em>.</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card h-100 border-primary border-opacity-25 shadow-sm p-3 rounded-3 bg-light">
                    <h5 class="fw-bold text-primary"><i class="fas fa-user-shield me-2"></i> Peran Administrator (Awal Tahun Baru)</h5>
                    <p class="small text-muted mb-0">Administrator membuka menu <code class="inline">Data Umum</code> &gt; <code class="inline">Kelas / Rombel</code> &gt; tab <code class="inline">Kenaikan Kelas</code> (<code class="inline">/datakelas/kenaikan</code>) untuk memproses perpindahan rombel secara otomatis:</p>
                    <ul class="small ps-3 mt-2 mb-0 text-muted">
                        <li>Memindahkan siswa naik kelas ke rombel jenjang di atasnya secara massal.</li>
                        <li>Mengarsipkan siswa lulus langsung ke database <strong>Data Alumni</strong>.</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="screenshot-placeholder">
            <i class="fas fa-user-graduate"></i>
            <p>Lembar Penetapan Kenaikan Kelas Siswa Wali Kelas (/rapor/rapornaik)</p>
        </div>

        <h3><i class="fas fa-list-ol text-warning"></i> Alur Kerja Lengkap Kenaikan Kelas</h3>
        <ol class="step-list">
            <li><strong>Lengkapi Seluruh Nilai Rapor Genap:</strong>
                <p>Pastikan seluruh guru mata pelajaran telah tuntas menginput nilai Sumatif Lingkup Materi dan Sumatif Akhir Semester (SAS/SAT), serta Wali Kelas telah mengisi rekap presensi dan catatan rapor.</p>
            </li>
            <li><strong>Musyawarah Dewan Guru &amp; Penetapan Kenaikan:</strong>
                <p>Berdasarkan rapat pleno dewan guru dan pertimbangan kriteria kelulusan/kenaikan satuan pendidikan, Wali Kelas membuka <code class="inline">/rapor/rapornaik</code>.</p>
            </li>
            <li><strong>Pilih Status Setiap Siswa:</strong>
                <p>Gunakan tombol dropdown atau radio button status:
                <br>&bull; <span class="badge bg-success">Naik Kelas</span> (Otomatis terisi untuk seluruh siswa secara default)
                <br>&bull; <span class="badge bg-danger">Tinggal Kelas</span> (Jika terdapat siswa yang belum memenuhi syarat)
                <br>&bull; <span class="badge bg-primary">Lulus</span> (Bagi rombel tingkat akhir yang telah menuntaskan kurikulum).
                </p>
            </li>
            <li><strong>Simpan Keputusan Kenaikan:</strong>
                <p>Klik tombol hijau <code class="inline"><i class="fas fa-save"></i> Simpan Status Kenaikan</code>. Status ini akan tercetak langsung pada lembar halaman terakhir Dokumen Rapor Siswa.</p>
            </li>
            <li><strong>Eksekusi Migrasi Rombel oleh Admin:</strong>
                <p>Saat Administrator mengaktifkan Tahun Pelajaran baru di menu <code class="inline">Tahun Pelajaran</code>, Admin masuk ke <code class="inline">/datakelas/kenaikan</code> dan memilih opsi <strong>Proses Kenaikan Kelas Massal</strong>. Sistem akan mendistribusikan siswa ke kelas baru sesuai keputusan wali kelas tanpa merusak riwayat nilai di tahun pelajaran sebelumnya.</p>
            </li>
        </ol>

        <div class="alert-box alert-warning mt-4">
            <div class="d-flex align-items-center">
                <i class="fas fa-shield-alt fa-2x me-3"></i>
                <div>
                    <strong>Integritas Data Terjamin:</strong>
                    <div>Proses kenaikan kelas tidak pernah menghapus data nilai, presensi, maupun riwayat ujian CBT siswa terdahulu. Riwayat siswa pada semester dan tahun ajaran lama tetap dapat dibuka kapan saja melalui menu <em>Kumpulan Rapor</em> dan <em>Buku Induk</em>.</div>
                </div>
            </div>
        </div>
    </div>
    `
};
