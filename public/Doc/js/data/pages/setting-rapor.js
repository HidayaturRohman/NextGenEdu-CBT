if (typeof pageContents === 'undefined') var pageContents = {};

pageContents['setting-rapor'] = {
    title: 'Pengaturan Rapor & Nomenklatur Jabatan',
    desc: 'Panduan konfigurasi parameter rapor, Kurikulum Merdeka & K13, logo ganda, titimangsa, dan aturan otomatis Kepala Madrasah vs Kepala Sekolah.',
    html: `
    <div class="content-card">
        <h2><i class="fas fa-sliders-h"></i> Pengaturan Rapor & Nomenklatur Jabatan</h2>
        <p>
            Menu <strong>Setting Rapor</strong> (<code class="inline">/rapor/setting</code>) digunakan oleh Administrator 
            untuk mengonfigurasi seluruh parameter administratif penerbitan buku rapor digital. 
            Pengaturan ini mencakup pemilihan format kurikulum (Kurikulum Merdeka atau Kurikulum 2013), 
            bobot penilaian, titimangsa tempat dan tanggal pembagian rapor, konfigurasi kop surat logo ganda, 
            serta tata kelola sebutan pimpinan instansi.
        </p>

        <div class="info-box tip">
            <i class="fas fa-balance-scale"></i>
            <div>
                <strong>Aturan Nomenklatur Otomatis (Dual Rule):</strong> NextGen Garuda CBT Versi 1.5 menerapkan aturan ketat: 
                jabatan <strong>Kepala Madrasah</strong> otomatis digunakan untuk jenjang Kementerian Agama (MI, MTs, MA), 
                dan jabatan <strong>Kepala Sekolah</strong> otomatis digunakan untuk jenjang Dinas Pendidikan (SD, SMP, SMA).
            </div>
        </div>

        <hr>
        <h3><i class="fas fa-id-card-alt text-primary"></i> Aturan Gelar Pimpinan (Madrasah vs Sekolah)</h3>
        <p>
            Di seluruh dokumen cetak yang dihasilkan sistem—seperti Lembar Rapor Siswa, Leger Nilai, Rekap Nilai Semester, 
            Kartu Peserta Ujian, dan Berita Acara—sebutan pimpinan instansi ditentukan secara otomatis:
        </p>

        <div class="table-responsive">
            <table class="table-custom">
                <thead>
                    <tr>
                        <th style="width: 25%;">Satuan Pendidikan</th>
                        <th style="width: 25%;">Nomenklatur Resmi</th>
                        <th style="width: 50%;">Implementasi Dokumen Sistem</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>MI, MTs, MA</strong><br><small class="text-muted">(Kemenag RI)</small></td>
                        <td><span class="badge badge-success font-weight-bold p-2">Kepala Madrasah</span></td>
                        <td>
                            Pada blok tanda tangan pengesahan tercetak otomatis:
                            <br><code>Mengetahui,</code>
                            <br><code>Kepala Madrasah</code>
                            <br><code>[Nama Lengkap Kepala Madrasah]</code>
                            <br><code>NIP / NUPTK: [...]</code>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>SD, SMP, SMA / SMK</strong><br><small class="text-muted">(Kemendikbudristek)</small></td>
                        <td><span class="badge badge-primary font-weight-bold p-2">Kepala Sekolah</span></td>
                        <td>
                            Pada blok tanda tangan pengesahan tercetak otomatis:
                            <br><code>Mengetahui,</code>
                            <br><code>Kepala Sekolah</code>
                            <br><code>[Nama Lengkap Kepala Sekolah]</code>
                            <br><code>NIP / NUPTK: [...]</code>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <hr>
        <h3><i class="fas fa-image text-success"></i> Konfigurasi Kop Surat & Logo Ganda</h3>
        <p>
            Rapor resmi wajib menggunakan Kop Surat standar dinas pendidikan. Di menu Setting Rapor, Administrator dapat mengunggah:
        </p>
        <ul class="step-list">
            <li>
                <strong>Logo Kiri (Logo Induk):</strong>
                <p>Logo Kementerian Agama RI (Ikhlas Beramal) untuk Madrasah, atau Logo Pemerintah Provinsi/Kabupaten/Kota / Tut Wuri Handayani untuk Sekolah.</p>
            </li>
            <li>
                <strong>Logo Kanan (Logo Lembaga):</strong>
                <p>Logo resmi sekolah atau madrasah setempat.</p>
            </li>
            <li>
                <strong>Teks Kepala Surat (Header Kop):</strong>
                <p>Nama Yayasan/Instansi Pembina, Nama Satuan Pendidikan, Alamat Kantor, Nomor Telepon, Email, dan Website resmi.</p>
            </li>
        </ul>

        <hr>
        <h3><i class="fas fa-calendar-day text-warning"></i> Titimangsa & Tanggal Penerbitan Rapor</h3>
        <p>
            Pengaturan tempat dan tanggal sangat penting agar titimangsa rapor tercetak seragam untuk seluruh rombel:
        </p>
        <ol class="step-list">
            <li><strong>Tempat Penerbitan:</strong> Nama Kabupaten/Kota tempat satuan pendidikan berdomisili (contoh: <code>Tuban</code>, <code>Konawe Selatan</code>).</li>
            <li><strong>Tanggal Pembagian Rapor Tengah Semester (PTS):</strong> Tanggal resmi penyerahan Laporan Hasil Belajar Penilaian Tengah Semester.</li>
            <li><strong>Tanggal Pembagian Rapor Akhir Semester (PAS/PAT):</strong> Tanggal resmi penyerahan Buku Rapor Semester Ganjil / Genap.</li>
        </ol>

        <hr>
        <h3><i class="fas fa-book-open text-info"></i> Dukungan Kurikulum Merdeka & Kurikulum 2013</h3>
        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="p-3 border rounded bg-light h-100">
                    <h6 class="font-weight-bold text-success"><i class="fas fa-feather"></i> Kurikulum Merdeka</h6>
                    <ul style="font-size: 13px; padding-left: 18px;">
                        <li>Penilaian Formatif (Awal & Proses Pembelajaran).</li>
                        <li>Penilaian Sumatif Lingkup Materi (TP) & Sumatif Akhir Semester (SAS).</li>
                        <li>Deskripsi otomatis berdasarkan Capaian Pembelajaran (CP) tertinggi dan terendah.</li>
                        <li>Buku Rapor Projek Penguatan Profil Pelajar Pancasila (P5) / P2RA.</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="p-3 border rounded bg-light h-100">
                    <h6 class="font-weight-bold text-primary"><i class="fas fa-archive"></i> Kurikulum 2013 (K13)</h6>
                    <ul style="font-size: 13px; padding-left: 18px;">
                        <li>Penilaian Kompetensi Inti 3 (Pengetahuan) per KD.</li>
                        <li>Penilaian Kompetensi Inti 4 (Keterampilan) per KD.</li>
                        <li>Penilaian Sikap Spiritual (KI-1) dan Sikap Sosial (KI-2).</li>
                        <li>Predikat nilai berbasis interval rentang KKM (A, B, C, D).</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>`
};
