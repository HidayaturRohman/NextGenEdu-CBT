<?= $this->extend('layout/dashboard_template_bs5') ?>
<?= $this->section('content') ?>
<div class="d-contents">
    <div class="card mb-4 shadow-sm border-0">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between w-100 flex-wrap gap-3">
                <div class="d-flex align-items-center">
                    <div class="me-3 flex-shrink-0">
                        <div class="rounded-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 60px; height: 60px; background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: #ffffff;">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 14"></polyline>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h4 class="card-title mb-1 fw-bold d-flex align-items-center text-dark">
                            KKTP & Interval Ketercapaian
                        </h4>
                        <p class="text-muted mb-0" style="font-size: 0.9rem;">Kriteria Ketercapaian Tujuan Pembelajaran (KKTP) dan Interval Predikat Capaian Pembelajaran Kurikulum Merdeka.</p>
                    </div>
                </div>
                <div>
                    <span class="badge bg-soft-warning text-dark px-3 py-2 rounded-pill fw-bold">
                        <i class="fas fa-balance-scale me-1"></i> KKTP Kurikulum Merdeka
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center flex-wrap gap-2">
            <h6 class="card-title mb-0 fw-bold d-flex align-items-center text-primary">
                <i class="fas fa-sliders-h me-2"></i> Penentuan Interval Nilai Ketercapaian
            </h6>
        </div>
        <div class="card-body p-4">
            <!-- Filter Mapel & Kelas -->
            <div class="row g-3 mb-4 align-items-end bg-light p-3 rounded-3 border">
                <div class="col-md-5">
                    <label class="form-label fw-bold text-secondary small">Mata Pelajaran:</label>
                    <select id="select-mapel" class="form-select shadow-sm">
                        <?php foreach ($mapel as $id_m => $nama_m): ?>
                            <option value="<?= $id_m ?>"><?= esc($nama_m) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold text-secondary small">Tingkat / Kelas:</label>
                    <select id="select-kelas" class="form-select shadow-sm">
                        <option value="0">Semua Kelas (Umum)</option>
                        <?php 
                        $firstKey = !empty($mapel) ? array_key_first($mapel) : null;
                        if ($firstKey && !empty($kelas[$firstKey])):
                            foreach ($kelas[$firstKey] as $kls): ?>
                                <option value="<?= $kls['id_kelas'] ?>"><?= esc($kls['nama_kelas']) ?></option>
                        <?php endforeach; endif; ?>
                    </select>
                </div>
                <div class="col-md-3 text-md-end">
                    <button type="button" class="btn btn-outline-primary w-100 shadow-sm" onclick="loadKktp()">
                        <i class="fas fa-sync-alt me-1"></i> Muat KKTP
                    </button>
                </div>
            </div>

            <!-- Form KKTP -->
            <?= form_open('', ['id' => 'form-kktp']) ?>
            <input type="hidden" name="id_mapel" id="kktp-mapel">
            <input type="hidden" name="id_kelas" id="kktp-kelas">
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card border rounded-3 p-3 bg-light h-100">
                        <h6 class="fw-bold text-dark border-bottom pb-2 mb-3"><i class="fas fa-bullseye text-primary me-2"></i>Batas Ketuntasan (KKTP)</h6>
                        <div class="mb-3">
                            <label class="form-label fw-bold small text-secondary">Nilai Minimum Ketercapaian</label>
                            <div class="input-group shadow-sm">
                                <input type="number" name="kkm" id="input-kkm" min="0" max="100" class="form-control" value="75" required>
                                <span class="input-group-text bg-white">Poin</span>
                            </div>
                            <small class="text-muted">Peserta didik yang nilainya di bawah angka ini memerlukan intervensi/bimbingan remedial.</small>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card border rounded-3 p-3 bg-light h-100">
                        <h6 class="fw-bold text-dark border-bottom pb-2 mb-3"><i class="fas fa-chart-line text-success me-2"></i>Interval & Kategori Capaian</h6>
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm align-middle bg-white mb-0">
                                <thead class="table-light">
                                    <tr class="text-center small fw-bold">
                                        <th style="width: 25%;">Rentang Nilai</th>
                                        <th style="width: 35%;">Kategori Capaian</th>
                                        <th style="width: 40%;">Tindak Lanjut / Deskripsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center fw-bold text-danger">0 - <span id="lbl-skala-1">69</span></td>
                                        <td><span class="badge bg-danger">Perlu Bimbingan</span></td>
                                        <td class="small text-muted">Belum mencapai ketuntasan, remedial di seluruh bagian</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center fw-bold text-warning"><span id="lbl-skala-1b">70</span> - <span id="lbl-skala-2">79</span></td>
                                        <td><span class="badge bg-warning text-dark">Cukup</span></td>
                                        <td class="small text-muted">Mencapai ketuntasan minimal, remedial pada bagian tertentu</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center fw-bold text-primary"><span id="lbl-skala-2b">80</span> - <span id="lbl-skala-3">89</span></td>
                                        <td><span class="badge bg-primary">Baik</span></td>
                                        <td class="small text-muted">Mencapai ketuntasan dengan baik, tidak perlu remedial</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center fw-bold text-success"><span id="lbl-skala-3b">90</span> - 100</td>
                                        <td><span class="badge bg-success">Sangat Baik</span></td>
                                        <td class="small text-muted">Mencapai ketuntasan melebihi target, perlu pengayaan</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="text-end mt-3">
                            <button type="submit" class="btn btn-primary btn-sm px-4 rounded-pill shadow-sm">
                                <i class="fas fa-save me-1"></i> Simpan KKTP
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
<?= $this->section('scripts') ?>
<script>
    var kelasByMapel = <?= json_encode($kelas) ?>;

    $(document).ready(function () {
        ajaxcsrf();

        $('#select-mapel').on('change', function () {
            var mId = $(this).val();
            var options = '<option value="0">Semua Kelas (Umum)</option>';
            if (kelasByMapel[mId]) {
                kelasByMapel[mId].forEach(function (k) {
                    options += '<option value="' + k.id_kelas + '">' + k.nama_kelas + '</option>';
                });
            }
            $('#select-kelas').html(options);
            loadKktp();
        });

        $('#select-kelas').on('change', function () {
            loadKktp();
        });

        $('#input-kkm').on('input', function () {
            updateIntervalLabels($(this).val());
        });

        $('#form-kktp').on('submit', function (e) {
            e.preventDefault();
            $('#kktp-mapel').val($('#select-mapel').val());
            $('#kktp-kelas').val($('#select-kelas').val());

            $.ajax({
                url: '<?= base_url('rapor/savekktp') ?>',
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function (res) {
                    if (res.status) {
                        Swal.fire({ title: 'Berhasil', text: 'KKTP berhasil disimpan', icon: 'success', timer: 1500, showConfirmButton: false });
                    } else {
                        Swal.fire('Gagal', res.message || 'Gagal menyimpan KKTP', 'error');
                    }
                },
                error: function () {
                    Swal.fire('Error', 'Terjadi kesalahan sistem', 'error');
                }
            });
        });

        loadKktp();
    });

    function updateIntervalLabels(kkmVal) {
        var k = parseInt(kkmVal) || 75;
        var s1 = k - 1;
        var s2 = k + Math.round((100 - k) / 3);
        var s3 = k + Math.round(((100 - k) / 3) * 2);

        $('#lbl-skala-1').text(s1);
        $('#lbl-skala-1b').text(k);
        $('#lbl-skala-2').text(s2);
        $('#lbl-skala-2b').text(s2 + 1);
        $('#lbl-skala-3').text(s3);
        $('#lbl-skala-3b').text(s3 + 1);
    }

    function loadKktp() {
        var mapelId = $('#select-mapel').val();
        var kelasId = $('#select-kelas').val();
        if (!mapelId) return;

        $.ajax({
            url: '<?= base_url('rapor/getkktp') ?>/' + mapelId + '/' + kelasId,
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                var kkm = data.kkm || 75;
                $('#input-kkm').val(kkm);
                updateIntervalLabels(kkm);
            }
        });
    }
</script>
<?= $this->endSection() ?>
