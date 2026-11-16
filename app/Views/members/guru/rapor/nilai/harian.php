<?= $this->extend('layout/dashboard_template_bs5') ?>
<?= $this->section('content') ?>
<div class="d-contents">
    <div class="card mb-4 shadow-sm border-0">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                <div class="d-flex align-items-center">
                    <div class="me-3 flex-shrink-0">
                        <div class="rounded-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 60px; height: 60px; background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%); color: #ffffff;">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                <polyline points="14 2 14 8 20 8"></polyline>
                                <line x1="16" y1="13" x2="8" y2="13"></line>
                                <line x1="16" y1="17" x2="8" y2="17"></line>
                                <polyline points="10 9 9 9 8 9"></polyline>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h4 class="card-title mb-1 fw-bold d-flex align-items-center text-dark">
                            Asesmen Sumatif: <?= esc($mapel['nama_mapel'] ?? '-') ?> - <?= esc($kelas['nama_kelas'] ?? '-') ?>
                        </h4>
                        <p class="text-muted mb-0" style="font-size: 0.9rem;">Input Nilai Sumatif Lingkup Materi (LM), SAS/STS, Nilai Akhir (NA), dan Generate Capaian Kompetensi Kurikulum Merdeka.</p>
                    </div>
                </div>
                <div class="d-flex gap-2">
                    <a href="<?= base_url('rapor/rapornilai') ?>" class="btn btn-secondary shadow-sm rounded-pill">
                        <i class="fas fa-arrow-left me-1"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>

<style>
/* Hilangkan tombol spinner bawaan browser pada input nilai bertipe number */
input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button { 
    -webkit-appearance: none !important; 
    margin: 0 !important; 
}
input[type=number] {
    -moz-appearance: textfield !important;
}

/* Penyesuaian Input Nilai Sumatif Lingkup Materi (LM), SAS, STS, & NA */
.input-lm, .input-sas, .input-na, .rata-lm, .input-sts, .input-pts {
    color: #0f172a !important; /* Hitam pekat kontras tinggi */
    font-weight: 700 !important;
    font-size: 0.95rem !important;
    padding: 4px 2px !important; /* Hilangkan padding tebal Hope UI agar teks tidak terpotong */
    text-align: center !important;
    background-color: #ffffff !important;
    border: 1px solid #cbd5e1 !important;
    border-radius: 6px !important;
    width: 100% !important;
    min-width: 46px !important;
    height: 38px !important;
    line-height: 1.2 !important;
    box-sizing: border-box !important;
}
.input-lm:focus, .input-sas:focus, .input-sts:focus, .input-pts:focus {
    border-color: #2563eb !important;
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.2) !important;
    outline: none !important;
    background-color: #eff6ff !important;
    color: #0f172a !important;
}
.input-na {
    background-color: #f0fdf4 !important;
    border-color: #22c55e !important;
    color: #15803d !important;
}
.input-na:focus {
    border-color: #16a34a !important;
    box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.25) !important;
    background-color: #dcfce7 !important;
    color: #166534 !important;
}
.input-sas {
    background-color: #fffbeb !important;
    border-color: #f59e0b !important;
    color: #b45309 !important;
}
.rata-lm {
    background-color: #f1f5f9 !important;
    border: none !important;
    color: #334155 !important;
    font-weight: 800 !important;
}

.badge-capaian {
    background-color: #8cc63f;
    color: #ffffff;
    font-weight: 500;
    font-size: 0.83rem;
    padding: 6px 10px;
    border-radius: 6px;
    margin-bottom: 4px;
    line-height: 1.35;
    box-shadow: 0 1px 2px rgba(0,0,0,0.06);
    border: 1px solid #7cb342;
    text-align: left;
    display: block;
}
.badge-capaian.bimbingan {
    background-color: #f59e0b;
    border-color: #d97706;
}
.preview-desk-box:empty {
    display: none;
}
</style>

    <!-- Informasi Acuan TP & Generator Capaian Otomatis -->
    <div class="card shadow-sm border-0 mb-4 border-start border-4 border-success">
        <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div>
                <h6 class="card-title mb-0 fw-bold d-flex align-items-center text-success">
                    <i class="fas fa-magic me-2"></i> Acuan Capaian Kompetensi (Generator Otomatis Sesuai KKTP)
                </h6>
                <small class="text-muted">Cukup tulis 1 materi/tujuan di bawah ini, lalu klik tombol terapkan. Deskripsi seluruh siswa otomatis tersusun mengikuti interval KKTP masing-masing!</small>
            </div>
            <div class="d-flex align-items-center gap-2">
                <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-3 py-2 rounded-pill">
                    <i class="fas fa-check-circle me-1"></i> KKTP Mapel: <b id="kktp-display"><?= $kktp->kkm ?? 75 ?></b>
                </span>
                <a href="<?= base_url('rapor/raporkikd') ?>" class="btn btn-sm btn-outline-primary rounded-pill">
                    <i class="fas fa-cog me-1"></i> Kelola TP
                </a>
            </div>
        </div>
        <div class="card-body p-3 bg-light bg-opacity-25">
            <!-- Alert Banner Template Otomatis -->
            <div class="alert alert-success bg-opacity-10 border border-success border-opacity-25 py-2 px-3 small mb-3 rounded-3 text-dark">
                <div class="d-flex align-items-center gap-2">
                    <i class="fas fa-info-circle text-success fs-5"></i>
                    <div>
                        <strong>Format Template Otomatis:</strong><br>
                        <code>Menunjukkan penguasaan yang <strong>[kurang baik / cukup baik / baik / sangat baik]</strong> dalam <strong>[Template Materi]</strong></code>
                        <div class="text-muted" style="font-size: 0.8rem;">
                            Predikat (<span class="badge bg-danger">kurang baik</span>, <span class="badge bg-warning text-dark">cukup baik</span>, <span class="badge bg-primary">baik</span>, <span class="badge bg-success">sangat baik</span>) otomatis disesuaikan dengan nilai masing-masing siswa terhadap KKTP.
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-bold text-dark small mb-1">
                        <i class="fas fa-book-reader text-primary me-1"></i> Template Materi / Capaian Utama (Materi 1) <span class="text-danger">*</span>
                    </label>
                    <div class="input-group input-group-sm">
                        <input type="text" id="materi_capaian_1" class="form-control" 
                               placeholder="Contoh: Mengenali dan Mengidentifikasi Unsur Puisi Rakyat"
                               value="<?= !empty($tps[0]->tujuan_pembelajaran) ? esc($tps[0]->tujuan_pembelajaran) : '' ?>">
                        <?php if (!empty($tps)): ?>
                        <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown" title="Pilih dari TP yang sudah ada">Pilih TP</button>
                        <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                            <?php foreach ($tps as $t): ?>
                                <li><a class="dropdown-item small" href="javascript:void(0)" onclick="$('#materi_capaian_1').val('<?= esc(addslashes($t->tujuan_pembelajaran)) ?>')"><?= esc($t->kode_tp . ' - ' . $t->tujuan_pembelajaran) ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                        <?php endif; ?>
                    </div>
                    <small class="text-muted" style="font-size: 0.78rem;">Tulis materinya saja (contoh: <em>Mengenali dan Mengidentifikasi Unsur Puisi Rakyat</em>). Sistem otomatis menambahkan awalan sesuai nilai siswa.</small>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold text-dark small mb-1">
                        <i class="fas fa-book-reader text-info me-1"></i> Template Materi / Capaian Tambahan (Materi 2 - Opsional)
                    </label>
                    <div class="input-group input-group-sm">
                        <input type="text" id="materi_capaian_2" class="form-control" 
                               placeholder="Contoh: Mengenali Gaya Penulisan pada Teks Deskripsi di Media"
                               value="<?= !empty($tps[1]->tujuan_pembelajaran) ? esc($tps[1]->tujuan_pembelajaran) : '' ?>">
                        <?php if (!empty($tps) && count($tps) > 1): ?>
                        <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown" title="Pilih dari TP yang sudah ada">Pilih TP</button>
                        <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                            <?php foreach ($tps as $t): ?>
                                <li><a class="dropdown-item small" href="javascript:void(0)" onclick="$('#materi_capaian_2').val('<?= esc(addslashes($t->tujuan_pembelajaran)) ?>')"><?= esc($t->kode_tp . ' - ' . $t->tujuan_pembelajaran) ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                        <?php endif; ?>
                    </div>
                    <small class="text-muted" style="font-size: 0.78rem;">Opsional: Jika diisi, sistem akan membuat capaian materi kedua untuk siswa.</small>
                </div>
                <div class="col-12 text-end pt-1">
                    <button type="button" class="btn btn-success btn-sm px-4 rounded-pill shadow-sm" onclick="terapkanCapaianKeSemua()">
                        <i class="fas fa-magic me-1"></i> Terapkan ke Seluruh Siswa Sesuai KKTP
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Input Nilai Siswa -->
    <?= form_open('', ['id' => 'form-nilai-asesmen']) ?>
    <input type="hidden" name="id_mapel" value="<?= $mapel['id_mapel'] ?>">
    <input type="hidden" name="id_kelas" value="<?= $kelas['id_kelas'] ?>">
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div class="d-flex align-items-center gap-2">
                <h6 class="card-title mb-0 fw-bold text-dark">
                    <i class="fas fa-table text-primary me-2"></i> Lembar Penilaian Siswa
                </h6>
                <span class="badge bg-soft-info text-info rounded-pill"><?= count($siswas) ?> Siswa</span>
            </div>
            <div class="d-flex gap-2">
                <button type="button" class="btn btn-sm btn-outline-info rounded-pill" onclick="autoCalculateAll()">
                    <i class="fas fa-calculator me-1"></i> Hitung Ulang NA & Deskripsi
                </button>
                <button type="submit" class="btn btn-sm btn-primary rounded-pill px-4 shadow-sm">
                    <i class="fas fa-save me-1"></i> Simpan Semua Nilai
                </button>
            </div>
        </div>
        <div class="card-body p-0">
            <?php
            $jmlLm = !empty($tps) ? count($tps) : 4;
            $bobotLm = (isset($rapor_setting) && isset($rapor_setting->bobot_sumatif)) ? $rapor_setting->bobot_sumatif : ($setting->bobot_sumatif ?? 50);
            $bobotSas = (isset($rapor_setting) && isset($rapor_setting->bobot_sas)) ? $rapor_setting->bobot_sas : ($setting->bobot_sas ?? 50);
            ?>
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle mb-0" id="table-penilaian">
                    <thead class="table-light">
                        <tr class="text-center small fw-bold text-secondary">
                            <th rowspan="2" style="width: 40px;" class="align-middle">No</th>
                            <th rowspan="2" style="min-width: 170px;" class="align-middle text-start">Nama Siswa</th>
                            <th colspan="<?= $jmlLm ?>" class="bg-soft-primary text-primary">Sumatif Lingkup Materi (LM)</th>
                            <th rowspan="2" style="width: 80px;" class="align-middle bg-light">Rata LM</th>
                            <th rowspan="2" style="width: 80px;" class="align-middle">STS</th>
                            <th rowspan="2" style="width: 80px;" class="align-middle bg-soft-warning text-dark">SAS</th>
                            <th rowspan="2" style="width: 80px;" class="align-middle bg-soft-success text-success">Nilai Akhir (NA)</th>
                            <th rowspan="2" style="min-width: 280px;" class="align-middle">Capaian Kompetensi (Deskripsi Rapor)</th>
                        </tr>
                        <tr class="text-center small fw-bold">
                            <?php for ($i = 1; $i <= $jmlLm; $i++): ?>
                                <th style="width: 72px; min-width: 65px;" class="bg-soft-primary">
                                    <?= !empty($tps[$i-1]->kode_tp) ? esc($tps[$i-1]->kode_tp) : 'LM ' . $i ?>
                                </th>
                            <?php endfor; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($siswas as $idx => $s): 
                            $nRow = $nilai[$s->id_siswa] ?? null;
                            $sumScores = $nRow->sumatif_decoded ?? [];
                        ?>
                            <tr id="row-<?= $s->id_siswa ?>">
                                <td class="text-center small fw-bold text-secondary"><?= $idx + 1 ?></td>
                                <td>
                                    <div class="fw-bold text-dark" style="font-size: 0.88rem;"><?= esc($s->nama) ?></div>
                                    <small class="text-muted">NISN: <?= esc($s->nisn ?: '-') ?></small>
                                    <input type="hidden" name="siswa[<?= $s->id_siswa ?>][id_siswa]" value="<?= $s->id_siswa ?>">
                                </td>
                                <?php for ($i = 1; $i <= $jmlLm; $i++): 
                                    $kodeTp = !empty($tps[$i-1]->kode_tp) ? $tps[$i-1]->kode_tp : 'LM' . $i;
                                    $valLm = $sumScores[$kodeTp] ?? ($sumScores['LM' . $i] ?? ($sumScores[$i] ?? ''));
                                ?>
                                    <td class="p-1">
                                        <input type="number" min="0" max="100" 
                                               class="form-control form-control-sm text-center input-lm fw-bold text-dark lm-siswa-<?= $s->id_siswa ?>" 
                                               name="siswa[<?= $s->id_siswa ?>][sumatif][<?= $kodeTp ?>]" 
                                               data-siswa="<?= $s->id_siswa ?>"
                                               data-kodetp="<?= $kodeTp ?>"
                                               value="<?= esc($valLm) ?>"
                                               oninput="calcSiswaRow(<?= $s->id_siswa ?>)">
                                    </td>
                                <?php endfor; ?>
                                <td class="p-1 text-center bg-light">
                                    <input type="text" readonly 
                                           class="form-control form-control-sm text-center fw-bold bg-transparent border-0 rata-lm" 
                                           id="rata-<?= $s->id_siswa ?>" 
                                           name="siswa[<?= $s->id_siswa ?>][rata_sumatif]" 
                                           value="<?= esc($nRow->rata_sumatif ?? '') ?>">
                                </td>
                                <td class="p-1">
                                    <input type="number" min="0" max="100" 
                                           class="form-control form-control-sm text-center input-sts" 
                                           id="sts-<?= $s->id_siswa ?>" 
                                           name="siswa[<?= $s->id_siswa ?>][nilai_sts]" 
                                           data-siswa="<?= $s->id_siswa ?>"
                                           value="<?= esc($nRow->nilai_sts ?? '') ?>">
                                </td>
                                <td class="p-1 bg-soft-warning">
                                    <input type="number" min="0" max="100" 
                                           class="form-control form-control-sm text-center input-sas fw-bold" 
                                           id="sas-<?= $s->id_siswa ?>" 
                                           name="siswa[<?= $s->id_siswa ?>][nilai_sas]" 
                                           data-siswa="<?= $s->id_siswa ?>"
                                           value="<?= esc($nRow->nilai_sas ?? '') ?>"
                                           oninput="calcSiswaRow(<?= $s->id_siswa ?>)">
                                </td>
                                <td class="p-1 bg-soft-success">
                                    <input type="number" min="0" max="100" 
                                           class="form-control form-control-sm text-center input-na fw-bold text-success border-success" 
                                           id="na-<?= $s->id_siswa ?>" 
                                           name="siswa[<?= $s->id_siswa ?>][nilai_akhir]" 
                                           value="<?= esc($nRow->nilai_akhir ?? '') ?>">
                                </td>
                                <td class="p-2" style="min-width: 300px;">
                                    <div id="preview-desk-<?= $s->id_siswa ?>" class="preview-desk-box mb-1">
                                        <?php 
                                        $dText = trim($nRow->deskripsi_capaian ?? '');
                                        if (!empty($dText)):
                                            $lines = explode("\n", $dText);
                                            foreach ($lines as $line):
                                                $line = trim($line);
                                                if (empty($line)) continue;
                                                $isBimbingan = stripos($line, 'perlu bimbingan') !== false || stripos($line, 'perlu peningkatan') !== false;
                                        ?>
                                            <div class="badge-capaian <?= $isBimbingan ? 'bimbingan' : '' ?>"><?= esc($line) ?></div>
                                        <?php 
                                            endforeach;
                                        endif; 
                                        ?>
                                    </div>
                                    <textarea rows="2" class="form-control form-control-sm text-deskripsi" 
                                              id="desk-<?= $s->id_siswa ?>" 
                                              name="siswa[<?= $s->id_siswa ?>][deskripsi_capaian]" 
                                              placeholder="Narasi capaian kompetensi siswa..."
                                              oninput="renderPreviewDeskripsi(<?= $s->id_siswa ?>)"><?= esc($nRow->deskripsi_capaian ?? '') ?></textarea>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white py-3 text-end border-top">
            <button type="submit" class="btn btn-primary px-4 rounded-pill shadow-sm">
                <i class="fas fa-save me-1"></i> Simpan Semua Nilai Asesmen
            </button>
        </div>
    </div>
    <?= form_close() ?>
</div>

<?= $this->endSection() ?>
<?= $this->section('scripts') ?>
<script>
    var tpList = <?= json_encode($tps) ?>;
    var bobotLm = <?= json_encode($bobotLm) ?>;
    var bobotSas = <?= json_encode($bobotSas) ?>;
    var kktpNilai = <?= json_encode($kktp->kkm ?? 75) ?>;

    $(document).ready(function () {
        ajaxcsrf();

        // Render preview awal
        <?php foreach ($siswas as $s): ?>
            renderPreviewDeskripsi(<?= $s->id_siswa ?>);
        <?php endforeach; ?>

        $('#form-nilai-asesmen').on('submit', function (e) {
            e.preventDefault();
            Swal.fire({
                title: 'Menyimpan Nilai...',
                text: 'Silakan tunggu...',
                allowOutsideClick: false,
                didOpen: function () { Swal.showLoading(); }
            });

            $.ajax({
                url: '<?= base_url('rapor/savenilaiasesmen') ?>',
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function (res) {
                    if (res.status) {
                        Swal.fire({ title: 'Tersimpan', text: 'Nilai asesmen & Capaian Kompetensi berhasil disimpan', icon: 'success' })
                            .then(function () { location.reload(); });
                    } else {
                        Swal.fire('Gagal', res.message || 'Gagal menyimpan nilai', 'error');
                    }
                },
                error: function () {
                    Swal.fire('Error', 'Terjadi kesalahan saat menyimpan data', 'error');
                }
            });
        });
    });

    function getPredikatCapaian(nilai, kktp) {
        kktp = parseFloat(kktp) || 75;
        var n = parseFloat(nilai);
        if (isNaN(n) || n === 0) return 'cukup baik';

        var span = (100 - kktp) / 3;
        var batasSangat = Math.round(kktp + (span * 2)); // misal 75 + 16.7 = 92
        var batasBaik = Math.round(kktp + span);        // misal 75 + 8.3 = 83
        var batasCukup = Math.round(kktp - 10);         // misal 65

        if (n >= batasSangat) {
            return 'sangat baik';
        } else if (n >= batasBaik) {
            return 'baik';
        } else if (n >= batasCukup) {
            return 'cukup baik';
        } else {
            return 'kurang baik';
        }
    }

    function buatKalimatCapaian(predikat, materi) {
        if (!materi || materi.trim() === '') return '';
        var m = materi.trim().replace(/\.$/, '');
        // Bersihkan jika guru tidak sengaja menulis awalan "Menunjukkan..." di input
        m = m.replace(/^menunjukkan\s+penguasaan\s+(yang\s+)?(kurang\s+baik|cukup\s+baik|baik|sangat\s+baik)\s+dalam\s+/i, '');
        m = m.replace(/^dalam\s+/i, '');
        return 'Menunjukkan penguasaan yang ' + predikat + ' dalam ' + m;
    }

    function renderPreviewDeskripsi(sId) {
        var text = $('#desk-' + sId).val().trim();
        var box = $('#preview-desk-' + sId);
        box.empty();
        if (!text) return;

        var lines = text.split('\n');
        lines.forEach(function (l) {
            l = l.trim();
            if (l !== '') {
                var isKurang = l.toLowerCase().indexOf('kurang baik') >= 0 || l.toLowerCase().indexOf('perlu bimbingan') >= 0;
                var cls = isKurang ? 'badge-capaian bimbingan' : 'badge-capaian';
                box.append('<div class="' + cls + '">' + l + '</div>');
            }
        });
    }

    function generateDeskripsiSiswa(sId) {
        var m1 = $('#materi_capaian_1').val().trim();
        var m2 = $('#materi_capaian_2').val().trim();
        if (!m1 && !m2) return;

        var naVal = $('#na-' + sId).val();
        if (naVal === '' || isNaN(naVal)) {
            naVal = $('#rata-' + sId).val();
        }
        var nilaiNum = parseFloat(naVal) || 75;

        var p1 = getPredikatCapaian(nilaiNum, kktpNilai);
        var kalimat1 = buatKalimatCapaian(p1, m1);

        var lines = [];
        if (kalimat1) lines.push(kalimat1);

        if (m2) {
            var lm2Val = $('.lm-siswa-' + sId).eq(1).val();
            var nilaiM2 = (lm2Val !== '' && !isNaN(lm2Val)) ? parseFloat(lm2Val) : nilaiNum;
            var p2 = getPredikatCapaian(nilaiM2, kktpNilai);
            var kalimat2 = buatKalimatCapaian(p2, m2);
            if (kalimat2) lines.push(kalimat2);
        }

        var hasil = lines.join('\n');
        $('#desk-' + sId).val(hasil);
        renderPreviewDeskripsi(sId);
    }

    function terapkanCapaianKeSemua() {
        var m1 = $('#materi_capaian_1').val().trim();
        if (!m1) {
            Swal.fire('Perhatian', 'Silakan tulis Materi / Capaian Kompetensi Utama (Materi 1) terlebih dahulu!', 'warning');
            return;
        }

        <?php foreach ($siswas as $s): ?>
            generateDeskripsiSiswa(<?= $s->id_siswa ?>);
        <?php endforeach; ?>

        Swal.fire({
            title: 'Berhasil Diterapkan!',
            html: 'Deskripsi Capaian Kompetensi untuk <b><?= count($siswas) ?> siswa</b> telah otomatis disesuaikan dengan nilai dan batas KKTP (' + kktpNilai + ').<br><small class="text-muted">Jangan lupa klik tombol <b>Simpan Semua Nilai</b> untuk menyimpan ke rapor.</small>',
            icon: 'success'
        });
    }

    function calcSiswaRow(sId) {
        var lmInputs = $('.lm-siswa-' + sId);
        var total = 0;
        var count = 0;

        lmInputs.each(function () {
            var v = $(this).val();
            if (v !== '' && !isNaN(v)) {
                total += parseFloat(v);
                count++;
            }
        });

        var rata = count > 0 ? (total / count).toFixed(1) : '';
        $('#rata-' + sId).val(rata);

        var sasVal = $('#sas-' + sId).val();
        var na = '';
        if (rata !== '' && sasVal !== '' && !isNaN(sasVal)) {
            var sNum = parseFloat(sasVal);
            var rNum = parseFloat(rata);
            na = Math.round(((rNum * bobotLm) + (sNum * bobotSas)) / (bobotLm + bobotSas));
        } else if (rata !== '') {
            na = Math.round(parseFloat(rata));
        } else if (sasVal !== '' && !isNaN(sasVal)) {
            na = Math.round(parseFloat(sasVal));
        }
        $('#na-' + sId).val(na);

        // Auto update deskripsi jika materi acuan di atas sudah diisi
        var m1 = $('#materi_capaian_1').val().trim();
        if (m1) {
            generateDeskripsiSiswa(sId);
        }
    }

    function autoCalculateAll() {
        <?php foreach ($siswas as $s): ?>
            calcSiswaRow(<?= $s->id_siswa ?>);
        <?php endforeach; ?>

        var m1 = $('#materi_capaian_1').val().trim();
        if (m1) {
            terapkanCapaianKeSemua();
        } else {
            Swal.fire({
                title: 'Perhitungan Selesai',
                text: 'Perhitungan Nilai Akhir (NA) telah selesai diperbarui untuk semua siswa.',
                icon: 'info'
            });
        }
    }
</script>
<?= $this->endSection() ?>
