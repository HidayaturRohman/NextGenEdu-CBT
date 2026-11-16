if (typeof pageContents === 'undefined') var pageContents = {};

pageContents['analisis'] = {
    title: 'Analisis Butir Soal Interaktif',
    desc: 'Panduan lengkap analisis psikometri butir soal, grafik Chart.js, daya pembeda, tingkat kesukaran, dan efektivitas pengecoh.',
    html: `
    <div class="content-card">
        <h2><i class="fas fa-chart-pie"></i> Analisis Butir Soal Interaktif</h2>
        <p>
            Menu <strong>Analisis Soal</strong> (<code class="inline">/cbtanalisis</code>) di NextGen Garuda CBT Versi 1.5 
            menyajikan evaluasi mendalam terhadap kualitas bank soal yang diujikan. 
            Modul ini menerapkan kaidah psikometri evaluasi instrumen tes standar nasional—mencakup 
            <strong>Tingkat Kesukaran (Facility Value)</strong>, <strong>Daya Pembeda (Discriminatory Power)</strong>, 
            serta <strong>Pola Sebaran Jawaban / Efektivitas Pengecoh (Distractor Efficiency)</strong>—yang 
            divisualisasikan dengan grafik interaktif berbasis <strong>Chart.js</strong>.
        </p>

        <div class="info-box tip">
            <i class="fas fa-lightbulb"></i>
            <div>
                <strong>Manfaat Guru & Madrasah/Sekolah:</strong> Membantu guru menyaring soal-soal berkualitas tinggi untuk disimpan 
                ke dalam Master Bank Soal jangka panjang, serta merevisi atau mengeliminasi soal yang membingungkan atau cacat konstruksi.
            </div>
        </div>

        <hr>
        <h3><i class="fas fa-chart-bar text-primary"></i> Grafik Distribusi & Statistik Interaktif (Chart.js)</h3>
        <p>Di bagian atas halaman analisis, sistem menyajikan panel visualisasi dinamis:</p>
        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="p-3 border rounded bg-white shadow-sm h-100">
                    <h6 class="font-weight-bold text-primary"><i class="fas fa-pie-chart"></i> Proporsi Tingkat Kesukaran</h6>
                    <p class="text-muted" style="font-size: 13px;">Diagram donat yang memperlihatkan komposisi proporsional soal berkategori <strong>Mudah</strong>, <strong>Sedang</strong>, dan <strong>Sukar</strong>.</p>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="p-3 border rounded bg-white shadow-sm h-100">
                    <h6 class="font-weight-bold text-success"><i class="fas fa-chart-line"></i> Kurva Sebaran Nilai Siswa</h6>
                    <p class="text-muted" style="font-size: 13px;">Grafik batang sebaran frekuensi nilai siswa untuk melihat apakah distribusi nilai berdistribusi normal (Bell Curve) atau condong ke kiri/kanan.</p>
                </div>
            </div>
        </div>

        <hr>
        <h3><i class="fas fa-brain text-success"></i> Parameter Psikometri yang Dianalisis</h3>
        <div class="table-responsive">
            <table class="table-custom">
                <thead>
                    <tr>
                        <th style="width: 25%;">Parameter</th>
                        <th style="width: 45%;">Rentang Nilai & Kategori</th>
                        <th style="width: 30%;">Rekomendasi Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Tingkat Kesukaran (P)</strong></td>
                        <td>
                            - <strong>Sukar:</strong> P &lt; 0.30 (hanya &lt; 30% siswa menjawab benar)<br>
                            - <strong>Sedang:</strong> 0.30 &le; P &le; 0.70 (ideal)<br>
                            - <strong>Mudah:</strong> P &gt; 0.70 (&gt; 70% siswa menjawab benar)
                        </td>
                        <td>Komposisi soal ideal adalah 20% Mudah, 60% Sedang, dan 20% Sukar.</td>
                    </tr>
                    <tr>
                        <td><strong>Daya Pembeda (D)</strong></td>
                        <td>
                            Membandingkan kelompok atas (27% siswa terpintar) vs kelompok bawah (27% siswa nilai terendah):<br>
                            - <strong>&ge; 0.40:</strong> Sangat Baik<br>
                            - <strong>0.30 - 0.39:</strong> Baik<br>
                            - <strong>0.20 - 0.29:</strong> Cukup / Revisi Ringan<br>
                            - <strong>&lt; 0.20 atau Negatif:</strong> Jelek (Buang / Revisi Total)
                        </td>
                        <td>Soal dengan DP negatif berarti siswa pandai justru memilih salah, indikasi kunci jawaban salah atau kalimat soal bermakna ganda.</td>
                    </tr>
                    <tr>
                        <td><strong>Efektivitas Pengecoh (Distraktor)</strong></td>
                        <td>
                            Setiap opsi jawaban yang salah (pengecoh) dianalisis frekuensi pemilihnya:<br>
                            - <strong>Berfungsi Baik:</strong> Dipilih oleh &ge; 5% peserta ujian.<br>
                            - <strong>Tidak Berfungsi:</strong> Dipilih oleh &lt; 5% peserta.
                        </td>
                        <td>Pengecoh yang tidak berfungsi perlu diganti dengan opsi jawaban yang lebih masuk akal (plausible).</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <hr>
        <h3><i class="fas fa-print text-danger"></i> Cetak Dokumen Analisis & Ekspor Excel</h3>
        <p>
            Hasil analisis butir soal dapat langsung dicetak sebagai laporan akreditasi madrasah/sekolah:
        </p>
        <ol class="step-list">
            <li>Klik tombol <code class="inline"><i class="fas fa-print"></i> Cetak Analisis Butir Soal</code> untuk format print preview Landscape A4 resmi lengkap dengan tabel daya pembeda dan kesukaran.</li>
            <li>Klik tombol <code class="inline"><i class="fas fa-file-excel"></i> Ekspor Analisis Excel</code> untuk menyimpan data mentah skor per butir dan persentase pilihan opsi jawaban A, B, C, D, E.</li>
        </ol>
    </div>`
};
