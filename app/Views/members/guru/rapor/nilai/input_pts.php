<?= $this->extend('layout/dashboard_template_bs5') ?>
<?= $this->section('content') ?>
<div class="d-contents">
    <div class="card mb-4 shadow-sm border-0">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                <div class="d-flex align-items-center">
                    <div class="me-3 flex-shrink-0">
                        <div class="rounded-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 60px; height: 60px; background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: #ffffff;">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 20h9"></path>
                                <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h4 class="card-title mb-1 fw-bold d-flex align-items-center text-dark">
                            Penilaian PTS: <?= esc($mapel['nama_mapel'] ?? '-') ?> - <?= esc($kelas['nama_kelas'] ?? '-') ?>
                        </h4>
                        <p class="text-muted mb-0" style="font-size: 0.9rem;">Input Nilai Sumatif Tengah Semester (PTS/STS) dan Nilai Akhir (NA) siswa.</p>
                    </div>
                </div>
                <div class="d-flex gap-2">
                    <a href="<?= base_url('rapor/rapornilai/pts') ?>" class="btn btn-secondary shadow-sm rounded-pill">
                        <i class="fas fa-arrow-left me-1"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Informasi Acuan & Tarik Nilai CBT -->
    <div class="card shadow-sm border-0 mb-4 border-start border-4 border-warning">
        <div class="card-body p-3 bg-light bg-opacity-50">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div class="d-flex align-items-center gap-3 flex-wrap">
                    <span class="badge bg-warning bg-opacity-10 text-dark border border-warning border-opacity-50 px-3 py-2 rounded-pill fw-semibold">
                        <i class="fas fa-check-circle text-warning me-1"></i> KKTP Mapel: <b><?= $kktp->kkm ?? 75 ?></b>
                    </span>
                    <?php if (!empty($cbt_scores)): ?>
                    <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-3 py-2 rounded-pill">
                        <i class="fas fa-bolt me-1"></i> Nilai CBT PTS Tersedia: <b><?= count($cbt_scores) ?> Siswa</b>
                    </span>
                    <?php else: ?>
                    <span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary border-opacity-25 px-3 py-2 rounded-pill">
                        <i class="fas fa-info-circle me-1"></i> Ujian CBT PTS belum ditemukan atau belum selesai
                    </span>
                    <?php endif; ?>
                </div>

                <div class="d-flex align-items-center gap-2">
                    <div class="btn-group">
                        <button type="button" class="btn btn-warning text-dark btn-sm rounded-pill shadow-sm px-3 dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-bolt me-1"></i> Tarik Nilai dari CBT PTS
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                            <li>
                                <a class="dropdown-item py-2" href="javascript:void(0)" onclick="tarikNilaiCbt('katrol')">
                                    <i class="fas fa-balance-scale text-warning me-2"></i> Tarik Nilai Katrol (Standar Rapor)
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item py-2" href="javascript:void(0)" onclick="tarikNilaiCbt('asli')">
                                    <i class="fas fa-file-alt text-primary me-2"></i> Tarik Nilai Asli / Murni CBT
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Input Nilai Siswa -->
    <?= form_open('', ['id' => 'form-nilai-pts']) ?>
    <input type="hidden" name="id_mapel" value="<?= $mapel['id_mapel'] ?>">
    <input type="hidden" name="id_kelas" value="<?= $kelas['id_kelas'] ?>">
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div class="d-flex align-items-center gap-2">
                <h6 class="card-title mb-0 fw-bold text-dark">
                    <i class="fas fa-table text-warning me-2"></i> Lembar Penilaian PTS Siswa
                </h6>
                <span class="badge bg-soft-warning text-dark rounded-pill"><?= count($siswas) ?> Siswa</span>
            </div>
            <div class="d-flex gap-2">
                <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill" onclick="samakanSemuaNa()">
                    <i class="fas fa-sync-alt me-1"></i> Samakan NA dengan Nilai PTS
                </button>
                <button type="submit" class="btn btn-sm btn-warning text-dark rounded-pill px-4 shadow-sm fw-bold">
                    <i class="fas fa-save me-1"></i> Simpan Nilai PTS
                </button>
            </div>
        </div>
        <div class="card-body p-0">
            <?php
            // Hitung distribusi agama siswa di rombel kelas ini
            $agamaSiswaList = [];
            foreach ($siswas as $st) {
                $rawAgm = trim($st->agama ?? '');
                if ($rawAgm === '' || $rawAgm === '0' || strtolower($rawAgm) === 'pilih') {
                    $rawAgm = 'Islam';
                }
                $keyAgm = strtolower($rawAgm);
                if (!isset($agamaSiswaList[$keyAgm])) {
                    $agamaSiswaList[$keyAgm] = [
                        'label' => ucfirst($rawAgm),
                        'count' => 0
                    ];
                }
                $agamaSiswaList[$keyAgm]['count']++;
            }
            ?>

            <?php if (count($agamaSiswaList) > 1): ?>
            <!-- Filter Siswa Berdasarkan Agama (Khusus Kelas Multi-Agama) -->
            <div class="px-3 py-2 bg-light border-bottom d-flex align-items-center gap-2 flex-wrap">
                <span class="small fw-bold text-secondary">
                    <i class="fas fa-filter text-warning me-1"></i> Filter Agama Siswa:
                </span>
                <button type="button" class="btn btn-sm btn-warning text-dark active btn-filter-agama rounded-pill px-3 py-1 shadow-xs fw-bold" onclick="filterSiswaAgama('all', this)">
                    Semua Siswa (<?= count($siswas) ?>)
                </button>
                <?php foreach ($agamaSiswaList as $agKey => $agData): 
                    $badgeCls = 'secondary';
                    if (strpos($agKey, 'islam') !== false) $badgeCls = 'success';
                    elseif (strpos($agKey, 'kristen') !== false || strpos($agKey, 'protestan') !== false) $badgeCls = 'info';
                    elseif (strpos($agKey, 'katolik') !== false) $badgeCls = 'primary';
                    elseif (strpos($agKey, 'hindu') !== false) $badgeCls = 'warning';
                    elseif (strpos($agKey, 'bud') !== false) $badgeCls = 'danger';
                ?>
                    <button type="button" class="btn btn-sm btn-outline-<?= $badgeCls ?> btn-filter-agama rounded-pill px-3 py-1" onclick="filterSiswaAgama('<?= $agKey ?>', this)">
                        <?= esc($agData['label']) ?> (<?= $agData['count'] ?>)
                    </button>
                <?php endforeach; ?>
                <small class="text-muted ms-auto fst-italic">
                    <i class="fas fa-info-circle me-1"></i> Klik filter agama untuk mempermudah penilaian tanpa mengganggu siswa agama lain.
                </small>
            </div>
            <?php endif; ?>

            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle mb-0" id="table-pts">
                    <thead class="table-light">
                        <tr class="text-center small fw-bold text-secondary">
                            <th style="width: 50px;">No</th>
                            <th style="min-width: 220px;" class="text-start">Nama Siswa</th>
                            <th style="width: 140px;" class="bg-soft-warning text-dark">Nilai PTS (STS)</th>
                            <th style="width: 140px;" class="bg-soft-success text-success">Nilai Akhir (NA)</th>
                            <th style="width: 120px;" class="text-center text-muted">Nilai CBT Asli</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($siswas as $idx => $s): 
                            $nRow = $nilai[$s->id_siswa] ?? null;
                            $cbtItem = $cbt_scores[$s->id_siswa] ?? null;
                            $rawAgm = trim($s->agama ?? '');
                            if ($rawAgm === '' || $rawAgm === '0' || strtolower($rawAgm) === 'pilih') {
                                $rawAgm = 'Islam';
                            }
                            $agKey = strtolower($rawAgm);
                            $badgeCls = 'success';
                            if (strpos($agKey, 'kristen') !== false || strpos($agKey, 'protestan') !== false) $badgeCls = 'info';
                            elseif (strpos($agKey, 'katolik') !== false) $badgeCls = 'primary';
                            elseif (strpos($agKey, 'hindu') !== false) $badgeCls = 'warning';
                            elseif (strpos($agKey, 'bud') !== false) $badgeCls = 'danger';
                        ?>
                            <tr id="row-<?= $s->id_siswa ?>" class="row-siswa" data-agama="<?= $agKey ?>">
                                <td class="text-center small fw-bold text-secondary col-no-siswa"><?= $idx + 1 ?></td>
                                <td>
                                    <div class="d-flex align-items-center gap-1 flex-wrap">
                                        <span class="fw-bold text-dark" style="font-size: 0.88rem;"><?= esc($s->nama) ?></span>
                                        <?php if (count($agamaSiswaList) > 1): ?>
                                        <span class="badge bg-soft-<?= $badgeCls ?> text-<?= $badgeCls ?> border border-<?= $badgeCls ?> border-opacity-25" style="font-size: 0.7rem; padding: 2px 6px;">
                                            <?= esc($rawAgm) ?>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                    <small class="text-muted">NISN: <?= esc($s->nisn ?: '-') ?></small>
                                    <input type="hidden" name="siswa[<?= $s->id_siswa ?>][id_siswa]" value="<?= $s->id_siswa ?>">
                                </td>
                                <td class="p-2 bg-soft-warning text-center">
                                    <input type="number" min="0" max="100" 
                                           class="form-control form-control-sm text-center fw-bold input-pts mx-auto" 
                                           style="max-width: 110px; font-size: 0.95rem;"
                                           id="pts-<?= $s->id_siswa ?>" 
                                           name="siswa[<?= $s->id_siswa ?>][nilai_sts]" 
                                           data-siswa="<?= $s->id_siswa ?>"
                                           value="<?= esc($nRow->nilai_sts ?? '') ?>"
                                           oninput="handlePtsChange(<?= $s->id_siswa ?>)">
                                </td>
                                <td class="p-2 bg-soft-success text-center">
                                    <input type="number" min="0" max="100" 
                                           class="form-control form-control-sm text-center fw-bold input-na text-success border-success mx-auto" 
                                           style="max-width: 110px; font-size: 0.95rem;"
                                           id="na-<?= $s->id_siswa ?>" 
                                           name="siswa[<?= $s->id_siswa ?>][nilai_akhir]" 
                                           data-siswa="<?= $s->id_siswa ?>"
                                           data-manual="0"
                                           value="<?= esc($nRow->nilai_akhir ?? '') ?>"
                                           oninput="handleNaChange(<?= $s->id_siswa ?>)">
                                </td>
                                <td class="text-center small text-muted">
                                    <?php if ($cbtItem): ?>
                                        <span class="badge bg-light text-secondary border" title="Nilai Asli: <?= $cbtItem['asli'] ?>, Katrol: <?= $cbtItem['katrol'] ?>">
                                            Asli: <?= $cbtItem['asli'] ?>
                                        </span>
                                    <?php else: ?>
                                        <span class="text-muted">-</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white py-3 text-end border-top">
            <button type="submit" class="btn btn-warning text-dark px-4 rounded-pill shadow-sm fw-bold">
                <i class="fas fa-save me-1"></i> Simpan Nilai PTS
            </button>
        </div>
    </div>
    <?= form_close() ?>
</div>

<script>
$(document).ready(function () {
    ajaxcsrf();

    // Auto-select filter agama jika mapel yang dinilai spesifik (misal PAI / Agama Kristen)
    var mapelNama = "<?= strtolower($mapel['nama_mapel'] ?? '') ?>";
    if (mapelNama.indexOf('islam') >= 0 || mapelNama.indexOf('pai') >= 0) {
        var btnIslam = $('.btn-filter-agama[onclick*="islam"]');
        if (btnIslam.length > 0) {
            btnIslam.trigger('click');
        }
    } else if (mapelNama.indexOf('kristen') >= 0 || mapelNama.indexOf('protestan') >= 0) {
        var btnKristen = $('.btn-filter-agama[onclick*="kristen"], .btn-filter-agama[onclick*="protestan"]');
        if (btnKristen.length > 0) {
            btnKristen.first().trigger('click');
        }
    } else if (mapelNama.indexOf('hindu') >= 0) {
        var btnHindu = $('.btn-filter-agama[onclick*="hindu"]');
        if (btnHindu.length > 0) {
            btnHindu.first().trigger('click');
        }
    }

    $('#form-nilai-pts').on('submit', function (e) {
        e.preventDefault();
        Swal.fire({
            title: 'Menyimpan Nilai PTS...',
            text: 'Silakan tunggu...',
            allowOutsideClick: false,
            didOpen: function () { Swal.showLoading(); }
        });

        $.ajax({
            url: '<?= base_url('rapor/savenilaipts') ?>',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function (res) {
                if (res.status) {
                    Swal.fire({ 
                        title: 'Tersimpan', 
                        text: 'Nilai PTS & Nilai Akhir berhasil disimpan', 
                        icon: 'success' 
                    }).then(function () { 
                        location.reload(); 
                    });
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

function handlePtsChange(sId) {
    var ptsVal = $('#pts-' + sId).val();
    var naInput = $('#na-' + sId);
    // Jika NA belum diisi atau user belum mengubah secara spesifik, otomatis samakan dengan PTS
    if (naInput.data('manual') != '1' || naInput.val() === '') {
        naInput.val(ptsVal);
    }
}

function handleNaChange(sId) {
    // Tandai bahwa user telah mengisi manual Nilai Akhir
    $('#na-' + sId).data('manual', '1');
}

function samakanSemuaNa() {
    $('.input-pts').each(function () {
        var sId = $(this).data('siswa');
        var val = $(this).val();
        if (val !== '') {
            $('#na-' + sId).val(val);
        }
    });
    Swal.fire('Selesai', 'Seluruh Nilai Akhir (NA) telah disamakan dengan Nilai PTS', 'info');
}

function tarikNilaiCbt(mode) {
    Swal.fire({
        title: 'Menarik Nilai dari CBT PTS...',
        text: 'Mengambil hasil ujian siswa dari CBT...',
        allowOutsideClick: false,
        didOpen: function () { Swal.showLoading(); }
    });

    $.ajax({
        url: '<?= base_url('rapor/tariknilaicbt') ?>',
        type: 'POST',
        data: {
            id_mapel: '<?= $mapel['id_mapel'] ?>',
            id_kelas: '<?= $kelas['id_kelas'] ?>',
            tipe: 'pts',
            mode: mode
        },
        dataType: 'json',
        success: function (res) {
            if (res.status && res.scores && Object.keys(res.scores).length > 0) {
                var filledCount = 0;
                $.each(res.scores, function (sId, item) {
                    var targetScore = (mode === 'asli') ? item.asli : (item.final || item.katrol);
                    var ptsInput = $('#pts-' + sId);
                    var naInput = $('#na-' + sId);
                    if (ptsInput.length > 0 && targetScore !== undefined && targetScore !== null) {
                        ptsInput.val(targetScore).css('background-color', '#fef3c7');
                        setTimeout(function () { ptsInput.css('background-color', ''); }, 1500);
                        naInput.val(targetScore).css('background-color', '#dcfce7');
                        setTimeout(function () { naInput.css('background-color', ''); }, 1500);
                        filledCount++;
                    }
                });

                Swal.fire({
                    title: 'Berhasil Ditarik!',
                    html: 'Nilai dari CBT PTS berhasil dimasukkan untuk <b>' + filledCount + ' siswa</b> (Mode: ' + (mode === 'asli' ? 'Nilai Asli' : 'Nilai Katrol') + ').<br><small class="text-muted">Nilai Akhir otomatis disamakan dan tetap dapat Anda edit manual per siswa sebelum disimpan.</small>',
                    icon: 'success'
                });
            } else {
                Swal.fire('Informasi', 'Tidak ditemukan data nilai ujian CBT PTS untuk mapel dan kelas ini.', 'warning');
            }
        },
        error: function () {
            Swal.fire('Error', 'Gagal menghubungi server untuk menarik nilai CBT.', 'error');
        }
    });
}

function filterSiswaAgama(agm, btn) {
    $('.btn-filter-agama').removeClass('btn-warning text-dark active');
    $(btn).addClass('btn-warning text-dark active');

    var visibleNo = 1;
    $('#table-pts tbody tr.row-siswa').each(function () {
        var rowAgm = $(this).attr('data-agama') || 'islam';
        if (agm === 'all' || rowAgm === agm) {
            $(this).show();
            $(this).find('.col-no-siswa').text(visibleNo++);
        } else {
            $(this).hide();
        }
    });
}
</script>
<?= $this->endSection() ?>
