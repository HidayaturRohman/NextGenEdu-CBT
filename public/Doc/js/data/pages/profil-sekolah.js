if (typeof pageContents === 'undefined') var pageContents = {};

pageContents['profil-sekolah'] = {
    title: 'Profil Satuan Pendidikan (Sekolah / Madrasah)',
    desc: 'Panduan konfigurasi data identitas lembaga, logo ganda, dan nama pimpinan (Kepala Sekolah / Kepala Madrasah).',
    html: `
    <div class="content-card">
        <h2><i class="fas fa-school"></i> Profil Satuan Pendidikan</h2>
        <p>
            Menu <strong>Profil Sekolah / Madrasah</strong> (<code class="inline">/setting/sekolah</code>) 
            berfungsi mengelola seluruh identitas legalitas lembaga yang akan menjadi rujukan utama pada 
            seluruh cetak kop surat, kartu peserta ujian CBT, berita acara, buku rapor, serta leger nilai.
        </p>

        <div class="info-box tip">
            <i class="fas fa-check-circle"></i>
            <div>
                <strong>Deteksi Otomatis Sebutan Pimpinan:</strong> 
                Sistem NextGen Garuda CBT Versi 1.5 secara otomatis mengenali jenjang pendidikan Anda:
                <ul class="mb-0 mt-1 pl-3">
                    <li>Jenjang <strong>MI, MTs, MA</strong> otomatis menggunakan label dan gelar <strong>Kepala Madrasah</strong>.</li>
                    <li>Jenjang <strong>SD, SMP, SMA, SMK</strong> otomatis menggunakan label dan gelar <strong>Kepala Sekolah</strong>.</li>
                </ul>
            </div>
        </div>

        <hr>
        <h3><i class="fas fa-edit text-primary"></i> Mengisi Data Profil Lembaga</h3>
        <ol class="step-list">
            <li>Buka menu <code class="inline">Pengaturan > Data Sekolah > Profil Sekolah</code>.</li>
            <li>Lengkapi formulir identitas lembaga:
                <ul class="step-list">
                    <li><strong>Jenjang Satuan Pendidikan:</strong> Pilih jenjang (SD, MI, SMP, MTs, SMA, MA, atau SMK).</li>
                    <li><strong>Nama Sekolah / Madrasah:</strong> Nama resmi lembaga sesuai SK Izin Operasional (contoh: <code>MTs Darul Hislah</code> atau <code>SDN 1 Puunokullo</code>).</li>
                    <li><strong>NPSN / NSM:</strong> Nomor Pokok Sekolah Nasional atau Nomor Statistik Madrasah.</li>
                    <li><strong>Alamat Lengkap & Kode Pos:</strong> Alamat domisili kampus.</li>
                    <li><strong>Kabupaten / Kota & Provinsi:</strong> Menentukan titimangsa cetak dokumen resmi.</li>
                    <li><strong>Kontak & Media:</strong> Nomor Telepon/WhatsApp, Email resmi, dan Website lembaga.</li>
                    <li><strong>Nama Pimpinan:</strong> Nama lengkap Kepala Madrasah atau Kepala Sekolah beserta gelar akademik (contoh: <code>Drs. H. Ahmad Fauzi, M.Pd.I</code>).</li>
                    <li><strong>NIP / NUPTK:</strong> Nomor Induk Pegawai pimpinan (jika PNS/PPPK) atau NUPTK/Kemenag ID.</li>
                </ul>
            </li>
            <li>
                <strong>Unggah Logo Resmi:</strong>
                <ul class="step-list">
                    <li><strong>Logo Kiri:</strong> Logo Kemenag RI atau Logo Pemerintah Daerah/Dinas Pendidikan (format PNG/WebP transparan).</li>
                    <li><strong>Logo Kanan:</strong> Logo resmi Sekolah atau Madrasah.</li>
                </ul>
            </li>
            <li>Klik tombol <code class="inline btn-success"><i class="fas fa-save"></i> Simpan Perubahan</code>.</li>
        </ol>

        <div class="info-box info">
            <i class="fas fa-info-circle"></i>
            <div>
                Seluruh data identitas dan logo yang disimpan akan langsung terhubung ke sistem cetak rapor, leger kehadiran bulanan, rekap nilai semester, dan kartu ujian secara otomatis.
            </div>
        </div>
    </div>`
};
