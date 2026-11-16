<?= $this->extend('layout/dashboard_template_bs5') ?>
<?= $this->section('content') ?>
<div class="d-contents">
    <div class="card mb-4 shadow-sm border-0">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between w-100 flex-wrap gap-3">
                <div class="d-flex align-items-center">
                    <div class="me-3 flex-shrink-0">
                        <div class="rounded-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 60px; height: 60px; background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%); color: #ffffff;">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 20h9"></path>
                                <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h4 class="card-title mb-1 fw-bold d-flex align-items-center text-dark">
                            Tujuan Pembelajaran (TP) & Lingkup Materi
                        </h4>
                        <p class="text-muted mb-0" style="font-size: 0.9rem;">Kelola Tujuan Pembelajaran (TP) dan Lingkup Materi per Mata Pelajaran sebagai acuan deskripsi Capaian Kompetensi Kurikulum Merdeka.</p>
                    </div>
                </div>
                <div>
                    <span class="badge bg-soft-primary text-primary px-3 py-2 rounded-pill fw-bold">
                        <i class="fas fa-layer-group me-1"></i> Fase D / Kurikulum Merdeka
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center flex-wrap gap-2">
            <h6 class="card-title mb-0 fw-bold d-flex align-items-center text-primary">
                <i class="fas fa-list-check me-2"></i> Daftar Tujuan Pembelajaran (TP)
            </h6>
            <button type="button" class="btn btn-sm btn-primary rounded-pill shadow-sm" onclick="showAddModal()">
                <i class="fas fa-plus me-1"></i> Tambah TP Baru
            </button>
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
                    <button type="button" class="btn btn-outline-primary w-100 shadow-sm" onclick="loadTpList()">
                        <i class="fas fa-sync-alt me-1"></i> Muat Data TP
                    </button>
                </div>
            </div>

            <!-- Notice Kurmer -->
            <div class="alert alert-light-info border border-info border-opacity-25 rounded-3 mb-4 small" role="alert">
                <i class="fas fa-info-circle text-info me-1"></i>
                <b>Tips Deskripsi Kurikulum Merdeka:</b> Tuliskan TP dengan kata kerja operasional huruf kecil (contoh: <i>"memahami konsep dasar ekosistem dan interaksi antar makhluk hidup"</i>) agar tersusun otomatis menjadi kalimat yang runtut dalam rapor peserta didik.
            </div>

            <!-- Table of TP -->
            <div class="table-responsive rounded-3 border">
                <table class="table table-hover align-middle mb-0" id="table-tp">
                    <thead class="table-light">
                        <tr class="text-secondary small fw-bold text-uppercase">
                            <th style="width: 5%; text-align: center;">No</th>
                            <th style="width: 12%; text-align: center;">Kode TP</th>
                            <th style="width: 25%;">Lingkup Materi</th>
                            <th style="width: 43%;">Tujuan Pembelajaran (Kompetensi)</th>
                            <th style="width: 15%; text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tp-container">
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">
                                <i class="fas fa-spinner fa-spin me-2"></i> Memuat daftar Tujuan Pembelajaran...
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah/Edit TP -->
<div class="modal fade" id="modal-tp" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-primary text-white">
                <h6 class="modal-title fw-bold" id="modal-title">Tambah Tujuan Pembelajaran</h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?= form_open('', ['id' => 'form-tp']) ?>
            <input type="hidden" name="id_tp_mapel" id="input-id-tp">
            <input type="hidden" name="id_mapel" id="input-mapel-modal">
            <input type="hidden" name="id_kelas" id="input-kelas-modal">
            <div class="modal-body p-4">
                <div class="mb-3">
                    <label class="form-label fw-bold small text-secondary">Kode TP</label>
                    <input type="text" name="kode_tp" id="input-kode-tp" class="form-control shadow-sm" placeholder="Contoh: TP 1" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold small text-secondary">Lingkup Materi</label>
                    <input type="text" name="lingkup_materi" id="input-lingkup-materi" class="form-control shadow-sm" placeholder="Contoh: Al-Qur'an dan Hadis / Bilangan Pecahan" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold small text-secondary">Tujuan Pembelajaran</label>
                    <textarea name="tujuan_pembelajaran" id="input-tp-desc" class="form-control shadow-sm" rows="3" placeholder="Contoh: memahami bacaan surah ad-Duha dengan tartil dan benar" required></textarea>
                    <small class="text-muted">Awali dengan huruf kecil agar serasi dengan auto-deskripsi rapor.</small>
                </div>
            </div>
            <div class="modal-footer bg-light py-2">
                <button type="button" class="btn btn-secondary btn-sm rounded-pill" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary btn-sm rounded-pill px-3 shadow-sm">Simpan TP</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
<?= $this->section('scripts') ?>
<script>
    var kelasByMapel = <?= json_encode($kelas) ?>;
    var modalTp;

    $(document).ready(function () {
        ajaxcsrf();
        modalTp = new bootstrap.Modal(document.getElementById('modal-tp'));

        $('#select-mapel').on('change', function () {
            var mId = $(this).val();
            var options = '<option value="0">Semua Kelas (Umum)</option>';
            if (kelasByMapel[mId]) {
                kelasByMapel[mId].forEach(function (k) {
                    options += '<option value="' + k.id_kelas + '">' + k.nama_kelas + '</option>';
                });
            }
            $('#select-kelas').html(options);
            loadTpList();
        });

        $('#select-kelas').on('change', function () {
            loadTpList();
        });

        $('#form-tp').on('submit', function (e) {
            e.preventDefault();
            $('#input-mapel-modal').val($('#select-mapel').val());
            $('#input-kelas-modal').val($('#select-kelas').val());

            $.ajax({
                url: '<?= base_url('rapor/savetp') ?>',
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function (res) {
                    if (res.status) {
                        modalTp.hide();
                        Swal.fire({ title: 'Berhasil', text: 'Tujuan Pembelajaran berhasil disimpan', icon: 'success', timer: 1500, showConfirmButton: false });
                        loadTpList();
                    } else {
                        Swal.fire('Gagal', res.message || 'Gagal menyimpan TP', 'error');
                    }
                },
                error: function () {
                    Swal.fire('Error', 'Terjadi kesalahan sistem', 'error');
                }
            });
        });

        loadTpList();
    });

    function loadTpList() {
        var mapelId = $('#select-mapel').val();
        var kelasId = $('#select-kelas').val();
        if (!mapelId) return;

        $('#tp-container').html('<tr><td colspan="5" class="text-center py-4 text-muted"><i class="fas fa-spinner fa-spin me-2"></i> Memuat Tujuan Pembelajaran...</td></tr>');

        $.ajax({
            url: '<?= base_url('rapor/gettplist') ?>/' + mapelId + '/' + kelasId,
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                if (data && data.length > 0) {
                    var html = '';
                    data.forEach(function (item, idx) {
                        html += '<tr>' +
                            '<td class="text-center fw-bold text-secondary">' + (idx + 1) + '</td>' +
                            '<td class="text-center"><span class="badge bg-primary px-2 py-1">' + (item.kode_tp || ('TP ' + (idx + 1))) + '</span></td>' +
                            '<td><b>' + (item.lingkup_materi || '-') + '</b></td>' +
                            '<td>' + item.tujuan_pembelajaran + '</td>' +
                            '<td class="text-center">' +
                            '   <button class="btn btn-sm btn-outline-warning me-1" onclick=\'editTp(' + JSON.stringify(item) + ')\' title="Edit TP"><i class="fas fa-edit"></i></button>' +
                            '   <button class="btn btn-sm btn-outline-danger" onclick="deleteTp(' + item.id_tp_mapel + ')" title="Hapus TP"><i class="fas fa-trash"></i></button>' +
                            '</td>' +
                            '</tr>';
                    });
                    $('#tp-container').html(html);
                } else {
                    $('#tp-container').html('<tr><td colspan="5" class="text-center py-4 text-muted"><i class="fas fa-inbox me-2"></i> Belum ada Tujuan Pembelajaran untuk mata pelajaran ini. Silakan klik tombol <b>Tambah TP Baru</b>.</td></tr>');
                }
            },
            error: function () {
                $('#tp-container').html('<tr><td colspan="5" class="text-center py-4 text-danger"><i class="fas fa-exclamation-triangle me-2"></i> Gagal memuat data Tujuan Pembelajaran</td></tr>');
            }
        });
    }

    function showAddModal() {
        $('#modal-title').text('Tambah Tujuan Pembelajaran');
        $('#input-id-tp').val('');
        $('#input-kode-tp').val('TP ' + ($('#tp-container tr').length));
        $('#input-lingkup-materi').val('');
        $('#input-tp-desc').val('');
        modalTp.show();
    }

    function editTp(item) {
        $('#modal-title').text('Edit Tujuan Pembelajaran');
        $('#input-id-tp').val(item.id_tp_mapel);
        $('#input-kode-tp').val(item.kode_tp);
        $('#input-lingkup-materi').val(item.lingkup_materi);
        $('#input-tp-desc').val(item.tujuan_pembelajaran);
        modalTp.show();
    }

    function deleteTp(id) {
        Swal.fire({
            title: 'Hapus TP?',
            text: "Tujuan pembelajaran ini akan dihapus permanen.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= base_url('rapor/deletetp') ?>/' + id,
                    type: 'POST',
                    dataType: 'json',
                    success: function (res) {
                        if (res.status) {
                            Swal.fire({ title: 'Terhapus', text: 'Tujuan pembelajaran berhasil dihapus', icon: 'success', timer: 1200, showConfirmButton: false });
                            loadTpList();
                        } else {
                            Swal.fire('Gagal', res.message || 'Gagal menghapus TP', 'error');
                        }
                    }
                });
            }
        });
    }
</script>
<?= $this->endSection() ?>
