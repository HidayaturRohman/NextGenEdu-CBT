<?= $this->extend('layout/dashboard_template_bs5') ?>
<?= $this->section('content') ?>

<div class="d-contents">
    <div class="card mb-4 shadow-sm border-0">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="me-3 flex-shrink-0">
                    <div class="rounded-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 60px; height: 60px; background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: #ffffff;">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                            <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                        </svg>
                    </div>
                </div>
                <div>
                    <h4 class="card-title mb-1 fw-bold d-flex align-items-center text-dark">
                        Pengaturan Rapor Kurikulum Merdeka (IKM)
                    </h4>
                    <p class="text-muted mb-0" style="font-size: 0.9rem;">Konfigurasi fase kurikulum, titimangsa, tanggal bagi rapor, bobot nilai asesmen (Sumatif LM & SAS), serta identitas penandatangan.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center flex-wrap gap-2">
            <h6 class="card-title mb-0 fw-bold d-flex align-items-center text-primary">
                <i class="fas fa-sliders-h me-2"></i> Konfigurasi Dokumen Rapor
            </h6>
            <div class="d-flex align-items-center gap-2">
                <a href="<?= base_url('rapor/mapel') ?>" class="btn btn-primary btn-sm rounded-pill fw-semibold shadow-sm">
                    <i class="fas fa-book-open me-1"></i> Kelola & Revisi Mapel Rapor
                </a>
                <span class="badge bg-success px-3 py-2 rounded-pill"><i class="fas fa-check-circle me-1"></i> Kurikulum Merdeka</span>
            </div>
        </div>
        <div class="card-body p-4">
            <div class="alert alert-light-success alert-dismissible fade show border border-success border-opacity-25 rounded-3 mb-4" role="alert">
                <h6 class="alert-heading fw-bold d-flex align-items-center mb-1 text-success">
                    <i class="fas fa-info-circle me-2"></i> Panduan Konfigurasi Asesmen Kurikulum Merdeka
                </h6>
                <ul class="mb-0 ps-3 small text-muted">
                    <li><b>Fase Belajar</b>: Secara umum jenjang MTs/SMP menggunakan <b>Fase D</b> (Kelas VII, VIII, IX).</li>
                    <li><b>Pembobotan Nilai Akhir (NA)</b>: Nilai Akhir dihitung dari gabungan Rata-rata Sumatif Lingkup Materi (LM) dan Sumatif Akhir Semester (SAS).</li>
                    <li><b>Deskripsi Capaian Kompetensi</b>: Sistem secara otomatis menghasilkan narasi capaian tertinggi (TP yang paling dikuasai) dan capaian terendah (TP yang perlu peningkatan).</li>
                </ul>
            </div>

            <?= form_open('', ['id' => 'editsetting']) ?>
            <div class="row g-4">
                <!-- Kolom Kiri: Tanggal & Tempat -->
                <div class="col-md-6">
                    <div class="card border rounded-3 p-3 bg-light bg-opacity-50 h-100">
                        <h6 class="fw-bold text-dark border-bottom pb-2 mb-3"><i class="far fa-calendar-alt text-primary me-2"></i>Titimangsa & Tanggal Dokumen</h6>
                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-secondary">Fase Pembelajaran</label>
                            <select name="fase" class="form-select shadow-sm" required>
                                <option value="D" <?= ($rapor->fase ?? 'D') === 'D' ? 'selected' : '' ?>>Fase D (MTs / SMP - Kelas VII, VIII, IX)</option>
                                <option value="A" <?= ($rapor->fase ?? '') === 'A' ? 'selected' : '' ?>>Fase A (MI / SD - Kelas I, II)</option>
                                <option value="B" <?= ($rapor->fase ?? '') === 'B' ? 'selected' : '' ?>>Fase B (MI / SD - Kelas III, IV)</option>
                                <option value="C" <?= ($rapor->fase ?? '') === 'C' ? 'selected' : '' ?>>Fase C (MI / SD - Kelas V, VI)</option>
                                <option value="E" <?= ($rapor->fase ?? '') === 'E' ? 'selected' : '' ?>>Fase E (MA / SMA - Kelas X)</option>
                                <option value="F" <?= ($rapor->fase ?? '') === 'F' ? 'selected' : '' ?>>Fase F (MA / SMA - Kelas XI, XII)</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold text-secondary">Tempat / Titimangsa Pembagian Rapor</label>
                            <input type="text" name="tempat" value="<?= esc($rapor->tempat ?? 'Sumberagung') ?>" class="form-control shadow-sm" placeholder="Contoh: Sumberagung" required>
                            <small class="text-muted">Nama kota/kecamatan yang tertera pada titimangsa tanda tangan rapor.</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold text-secondary">Tanggal Rapor Tengah Semester (STS / PTS)</label>
                            <input type="text" name="tanggal_pts" value="<?= esc($rapor->tanggal_pts ?? $rapor->tgl_rapor_pts ?? date('Y-m-d')) ?>" class="form-control tgl shadow-sm" autocomplete="off" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold text-secondary">Tanggal Rapor Akhir Semester (SAS / Akhir)</label>
                            <input type="text" name="tanggal_rapor" value="<?= esc($rapor->tanggal_rapor ?? $rapor->tgl_rapor_akhir ?? date('Y-m-d')) ?>" class="form-control tgl shadow-sm" autocomplete="off" required>
                        </div>

                        <div class="mb-0">
                            <label class="form-label fw-semibold text-secondary">Watermark Cetak Dokumen</label>
                            <input type="text" name="watermark_teks" value="<?= esc($rapor->watermark_teks ?? 'MTs Hidayatul Islamiyah') ?>" class="form-control shadow-sm" placeholder="Contoh: MTs Hidayatul Islamiyah">
                            <small class="text-muted">Teks watermark halus di latar belakang halaman cetak rapor.</small>
                        </div>
                    </div>
                </div>

                <!-- Kolom Kanan: Bobot & Penandatangan -->
                <div class="col-md-6">
                    <div class="card border rounded-3 p-3 bg-light bg-opacity-50 h-100">
                        <h6 class="fw-bold text-dark border-bottom pb-2 mb-3"><i class="fas fa-calculator text-primary me-2"></i>Bobot Asesmen & Penandatangan</h6>

                        <div class="mb-3">
                            <label class="form-label fw-semibold text-secondary">KKTP Standar (Kriteria Ketercapaian)</label>
                            <div class="input-group shadow-sm">
                                <input type="number" name="kkm_default" min="0" max="100" value="<?= esc($rapor->kkm_default ?? $rapor->kkm ?? 75) ?>" class="form-control" required>
                                <span class="input-group-text bg-white">Poin</span>
                            </div>
                            <small class="text-muted">Nilai ketuntasan acuan standar sebelum diatur spesifik per mapel.</small>
                        </div>

                        <div class="row g-2 mb-3">
                            <div class="col-6">
                                <label class="form-label fw-semibold text-secondary">Bobot Sumatif LM</label>
                                <div class="input-group shadow-sm">
                                    <input type="number" name="bobot_sumatif" min="0" max="100" value="<?= esc($rapor->bobot_sumatif ?? 50) ?>" class="form-control" required>
                                    <span class="input-group-text bg-white">%</span>
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="form-label fw-semibold text-secondary">Bobot Sumatif Akhir (SAS)</label>
                                <div class="input-group shadow-sm">
                                    <input type="number" name="bobot_sas" min="0" max="100" value="<?= esc($rapor->bobot_sas ?? 50) ?>" class="form-control" required>
                                    <span class="input-group-text bg-white">%</span>
                                </div>
                            </div>
                            <small class="text-muted">Formula NA = ((Rata-rata LM &times; Bobot LM) + (Nilai SAS &times; Bobot SAS)) / 100.</small>
                        </div>

                        <?php $schInfoRapor = detectSchoolType($setting ?? null); ?>
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-secondary">Identitas <?= esc($schInfoRapor->kepsek_label) ?></label>
                            <select name="nip_kepsek" class="form-select shadow-sm" required>
                                <option value="0" <?= ($rapor->nip_kepsek ?? 0) == 0 ? 'selected' : '' ?>>Tampilkan NIP</option>
                                <option value="1" <?= ($rapor->nip_kepsek ?? 0) == 1 ? 'selected' : '' ?>>Tampilkan NPK</option>
                                <option value="2" <?= ($rapor->nip_kepsek ?? 0) == 2 ? 'selected' : '' ?>>Tanpa NIP / NPK</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold text-secondary">Identitas Wali Kelas</label>
                            <select name="nip_walikelas" class="form-select shadow-sm" required>
                                <option value="0" <?= ($rapor->nip_walikelas ?? 0) == 0 ? 'selected' : '' ?>>Tampilkan NIP</option>
                                <option value="1" <?= ($rapor->nip_walikelas ?? 0) == 1 ? 'selected' : '' ?>>Tampilkan NPK</option>
                                <option value="2" <?= ($rapor->nip_walikelas ?? 0) == 2 ? 'selected' : '' ?>>Tanpa NIP / NPK</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold text-secondary">Susunan Tanda Tangan Rapor Singkat / Ringkas</label>
                            <select name="ttd_rapor_ringkas" class="form-select shadow-sm" required>
                                <option value="3" <?= ($rapor->ttd_rapor_ringkas ?? '3') == '3' ? 'selected' : '' ?>>3 Tanda Tangan: Orang Tua/Wali Murid, Kepala, Wali Kelas (Sejajar - Rekomendasi)</option>
                                <option value="3_tingkat" <?= ($rapor->ttd_rapor_ringkas ?? '3') == '3_tingkat' ? 'selected' : '' ?>>3 Tanda Tangan: Model Bertingkat (Orang Tua & Wali di Atas, Kepala di Bawah)</option>
                                <option value="2" <?= ($rapor->ttd_rapor_ringkas ?? '3') == '2' ? 'selected' : '' ?>>2 Tanda Tangan: Hanya Kepala & Wali Kelas (Format Lama)</option>
                            </select>
                            <small class="text-muted">Pilihan susunan tanda tangan pada lembar cetak Rapor Singkat / Ringkas (1 Halaman).</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold text-secondary">Pilihan Logo Kop Surat Rapor</label>
                            <select name="model_kop" class="form-select shadow-sm" required>
                                <option value="1" <?= ($rapor->model_kop ?? 1) == 1 ? 'selected' : '' ?>>1. Kiri Kemenag (Satu Logo)</option>
                                <option value="2" <?= ($rapor->model_kop ?? 1) == 2 ? 'selected' : '' ?>>2. Kiri Kemenag, Kanan Lembaga (Dua Logo)</option>
                                <option value="0" <?= ($rapor->model_kop ?? 1) == 0 ? 'selected' : '' ?>>Tanpa Logo (Hanya Teks Kop)</option>
                            </select>
                            <small class="text-muted">Pilihan model logo kop dokumen rapor (1 logo Kemenag atau 2 logo Kemenag & Lembaga).</small>
                        </div>
                    </div>
                </div>

                <!-- Kontrol Mode Publikasi Rapor -->
                <div class="col-12">
                    <div class="card border rounded-3 p-3 bg-white shadow-sm border-start border-4 border-primary">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h6 class="fw-bold text-dark mb-0">
                                <i class="fas fa-toggle-on text-primary me-2"></i>Status & Mode Publikasi Rapor (STS / SAS-SAT)
                            </h6>
                            <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 px-2 py-1">Kontrol Akses Guru</span>
                        </div>
                        <p class="text-muted small mb-3">Tentukan fitur rapor mana yang dibuka atau ditutup untuk Wali Kelas dan Guru pada semester aktif ini:</p>
                        
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="card h-100 p-3 border rounded-3 shadow-none mode-card <?= ($rapor->mode_rapor ?? 'semua') === 'semua' ? 'border-primary bg-primary bg-opacity-10 shadow-sm' : 'bg-light' ?>" style="cursor: pointer;">
                                    <div class="d-flex align-items-start">
                                        <input type="radio" name="mode_rapor" value="semua" class="form-check-input me-3 mt-1" <?= ($rapor->mode_rapor ?? 'semua') === 'semua' ? 'checked' : '' ?>>
                                        <div>
                                            <div class="fw-bold text-dark mb-1">
                                                <i class="fas fa-check-double text-success me-1"></i> Aktifkan Keduanya
                                            </div>
                                            <div class="text-muted small">Rapor Tengah Semester (STS) dan Rapor Akhir Semester (SAS/SAT) <b>keduanya AKTIF</b> dan dapat dicetak oleh Wali Kelas.</div>
                                        </div>
                                    </div>
                                </label>
                            </div>
                            <div class="col-md-4">
                                <label class="card h-100 p-3 border rounded-3 shadow-none mode-card <?= ($rapor->mode_rapor ?? '') === 'sts' ? 'border-warning bg-warning bg-opacity-10 shadow-sm' : 'bg-light' ?>" style="cursor: pointer;">
                                    <div class="d-flex align-items-start">
                                        <input type="radio" name="mode_rapor" value="sts" class="form-check-input me-3 mt-1" <?= ($rapor->mode_rapor ?? '') === 'sts' ? 'checked' : '' ?>>
                                        <div>
                                            <div class="fw-bold text-dark mb-1">
                                                <i class="fas fa-certificate text-warning me-1"></i> Hanya Rapor STS Aktif
                                            </div>
                                            <div class="text-muted small">Hanya lembar <b>Rapor STS (Tengah Semester)</b> yang aktif. Menu Rapor Akhir (SAS/SAT) otomatis dinonaktifkan/disembunyikan.</div>
                                        </div>
                                    </div>
                                </label>
                            </div>
                            <div class="col-md-4">
                                <label class="card h-100 p-3 border rounded-3 shadow-none mode-card <?= ($rapor->mode_rapor ?? '') === 'sas' ? 'border-info bg-info bg-opacity-10 shadow-sm' : 'bg-light' ?>" style="cursor: pointer;">
                                    <div class="d-flex align-items-start">
                                        <input type="radio" name="mode_rapor" value="sas" class="form-check-input me-3 mt-1" <?= ($rapor->mode_rapor ?? '') === 'sas' ? 'checked' : '' ?>>
                                        <div>
                                            <div class="fw-bold text-dark mb-1">
                                                <i class="fas fa-book text-info me-1"></i> Hanya Rapor SAS/SAT Aktif
                                            </div>
                                            <div class="text-muted small">Hanya dokumen <b>Rapor Lengkap SAS/SAT</b> yang aktif. Menu Rapor STS otomatis dinonaktifkan/disembunyikan.</div>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pengaturan Tarik Nilai CBT ke Rapor -->
                <div class="col-12">
                    <div class="card border rounded-3 p-3 bg-white shadow-sm border-start border-4 border-success">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h6 class="fw-bold text-dark mb-0">
                                <i class="fas fa-bolt text-success me-2"></i>Integrasi & Pengambilan Nilai Ujian CBT ke Rapor
                            </h6>
                            <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-2 py-1">Auto Fill Nilai</span>
                        </div>
                        <p class="text-muted small mb-3">Tentukan sumber nilai ujian CBT (Nilai Murni atau Nilai Katrol) saat guru membuka lembar nilai PTS & SAS atau saat tombol Tarik Nilai digunakan:</p>
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-secondary">Sumber Nilai CBT yang Ditarik</label>
                                <select name="cbt_convert_mode" class="form-select shadow-sm">
                                    <option value="katrol" <?= ($rapor->cbt_convert_mode ?? 'katrol') === 'katrol' ? 'selected' : '' ?>>Nilai Katrol CBT (Jika dikatrol di CBT, otomatis pakai nilai katrol)</option>
                                    <option value="asli" <?= ($rapor->cbt_convert_mode ?? '') === 'asli' ? 'selected' : '' ?>>Nilai Murni / Asli (Tanpa Katrol)</option>
                                </select>
                                <small class="text-muted">Jika memilih Nilai Katrol, nilai ujian CBT akan dikonversi mengikuti rentang batas bawah & batas atas di bawah ini jika katrol di CBT belum tersimpan.</small>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-secondary">Rentang Standar Nilai Katrol (Batas Bawah & Atas)</label>
                                <div class="row g-2">
                                    <div class="col-6">
                                        <div class="input-group shadow-sm">
                                            <span class="input-group-text bg-white small">Min:</span>
                                            <input type="number" name="cbt_katrol_min" min="0" max="100" value="<?= esc($rapor->cbt_katrol_min ?? 60) ?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="input-group shadow-sm">
                                            <span class="input-group-text bg-white small">Max:</span>
                                            <input type="number" name="cbt_katrol_max" min="0" max="100" value="<?= esc($rapor->cbt_katrol_max ?? 100) ?>" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <small class="text-muted">Standar konversi katrol: Nilai terkecil dinaikkan menuju batas Min, nilai tertinggi menuju batas Max.</small>
                            </div>
                            <div class="col-12">
                                <div class="form-check form-switch mt-1">
                                    <input class="form-check-input" type="checkbox" name="auto_fill_cbt" id="auto_fill_cbt" value="1" <?= (!isset($rapor->auto_fill_cbt) || $rapor->auto_fill_cbt == 1) ? 'checked' : '' ?>>
                                    <label class="form-check-label fw-semibold text-dark" for="auto_fill_cbt">
                                        Otomatis isi (Auto-Fill) Nilai PTS dan Nilai SAS dari ujian CBT saat guru membuka lembar penilaian jika nilai rapor masih kosong
                                    </label>
                                    <div class="text-muted small ps-0">Guru tetap dapat mengedit / merevisi nilai PTS, SAS, maupun Nilai Akhir (NA) secara manual per siswa kapan saja.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 mt-4 text-end">
                    <button type="submit" class="btn btn-primary px-4 py-2 shadow-sm rounded-pill">
                        <i class="fas fa-save me-1"></i> Simpan Pengaturan Rapor
                    </button>
                </div>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<script>
$(document).ready(function () {
    ajaxcsrf();

    $('.tgl').datetimepicker({
        icons: {
            next: 'fa fa-angle-right',
            previous: 'fa fa-angle-left'
        },
        timepicker: false,
        scrollInput: false,
        scrollMonth: false,
        format: 'Y-m-d',
        formatDate: 'Y-m-d'
    });

    $('input[name="mode_rapor"]').on('change', function () {
        $('.mode-card').removeClass('border-primary bg-primary border-warning bg-warning border-info bg-info bg-opacity-10 shadow-sm').addClass('bg-light');
        var val = $(this).val();
        var card = $(this).closest('.mode-card');
        card.removeClass('bg-light').addClass('bg-opacity-10 shadow-sm');
        if (val === 'semua') {
            card.addClass('border-primary bg-primary');
        } else if (val === 'sts') {
            card.addClass('border-warning bg-warning');
        } else if (val === 'sas') {
            card.addClass('border-info bg-info');
        }
    });

    $('#editsetting').on('submit', function (e) {
        e.preventDefault();
        Swal.fire({
            title: 'Menyimpan...',
            text: 'Silakan tunggu...',
            allowOutsideClick: false,
            didOpen: function () { Swal.showLoading(); }
        });

        $.ajax({
            url: '<?= base_url('rapor/saveraporadmin') ?>',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function (res) {
                if (res.status) {
                    Swal.fire({
                        title: 'Berhasil',
                        text: 'Pengaturan Rapor Kurikulum Merdeka berhasil disimpan',
                        icon: 'success'
                    }).then(function () {
                        location.reload();
                    });
                } else {
                    Swal.fire('Gagal', res.message || 'Gagal menyimpan pengaturan', 'error');
                }
            },
            error: function (xhr) {
                Swal.fire('Error', 'Terjadi kesalahan sistem', 'error');
            }
        });
    });
});
</script>
<?= $this->endSection() ?>
