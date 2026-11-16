<?= $this->extend('layout/dashboard_template_bs5') ?>
<?= $this->section('content') ?>

<div class="d-contents">
    <!-- Header Card -->
    <div class="card mb-4 border-0 shadow-sm" style="border-radius: 14px;">
        <div class="card-body p-4">
            <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
                <div class="d-flex align-items-center">
                    <div class="me-3 flex-shrink-0">
                        <div class="rounded-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 58px; height: 58px; background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%); color: #ffffff;">
                            <i class="fas fa-images fa-2x"></i>
                        </div>
                    </div>
                    <div>
                        <h4 class="card-title mb-1 fw-bold"><?= esc($judul) ?></h4>
                        <p class="text-muted mb-0 small"><?= esc($subjudul) ?></p>
                    </div>
                </div>
                <div class="flex-shrink-0">
                    <button type="button" class="btn btn-primary px-3 py-2 fw-semibold rounded-pill shadow-sm" onclick="openAddModal()">
                        <i class="fas fa-plus-circle me-1"></i> Tambah Banner
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Alert Flash Message -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 mb-4" role="alert" style="border-radius: 12px;">
            <i class="fas fa-check-circle me-2"></i><?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0 mb-4" role="alert" style="border-radius: 12px;">
            <i class="fas fa-exclamation-triangle me-2"></i><?= session()->getFlashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <!-- Info Guide Banner -->
    <div class="card border-0 shadow-sm mb-4" style="border-radius: 14px; background: #f0f9ff; border-left: 5px solid #0284c7 !important;">
        <div class="card-body p-3 p-md-4">
            <div class="d-flex align-items-start">
                <i class="fas fa-info-circle text-primary fa-lg me-3 mt-1"></i>
                <div class="small text-secondary">
                    <strong class="text-dark d-block mb-1">Informasi Mekanisme Carousel Banner Siswa:</strong>
                    <ul class="mb-0 ps-3">
                        <li><strong>Tampilan Desktop / Laptop (PC):</strong> Otomatis menampilkan <strong>2 banner</strong> berdampingan dengan animasi geser halus.</li>
                        <li><strong>Tampilan Mobile (HP / Tablet):</strong> Menampilkan <strong>1 banner utama</strong> di tengah dengan ujung banner samping kanan/kiri terlihat (peek slider) sehingga siswa dapat menggesernya dengan sentuhan jari.</li>
                        <li>Jika file gambar tidak diunggah, sistem akan secara otomatis membuatkan <em>Banner Card Grafis</em> dengan tema gradasi modern & tombol aksi interaktif.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Table of Banners -->
    <div class="card border-0 shadow-sm mb-4" style="border-radius: 14px; overflow: hidden;">
        <div class="card-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
            <h6 class="fw-bold mb-0 text-dark">
                <i class="fas fa-list-ul text-primary me-2"></i> Daftar Banner Aktif & Terjadwal
            </h6>
            <span class="badge bg-primary rounded-pill px-3 py-2"><?= count($banners) ?> Banner Terdaftar</span>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light text-uppercase small text-muted" style="letter-spacing: 0.05em;">
                        <tr>
                            <th class="ps-4" style="width: 60px;">Urutan</th>
                            <th style="width: 140px;">Pratinjau</th>
                            <th>Judul & Informasi</th>
                            <th>Tautan / Tombol</th>
                            <th style="width: 110px;" class="text-center">Status</th>
                            <th class="text-end pe-4" style="width: 140px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($banners)): ?>
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">
                                    <i class="fas fa-images fa-3x mb-3 text-secondary opacity-50"></i>
                                    <p class="mb-0">Belum ada banner yang dibuat. Klik tombol <strong>Tambah Banner</strong> untuk mulai menambahkan.</p>
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($banners as $b): 
                                $bArr = (array)$b;
                            ?>
                                <tr>
                                    <td class="ps-4">
                                        <span class="badge bg-light text-dark border fw-bold px-2 py-1 fs-6">
                                            #<?= esc($bArr['urutan'] ?? '1') ?>
                                        </span>
                                    </td>
                                    <td>
                                        <?php if (!empty($bArr['gambar']) && file_exists(FCPATH . $bArr['gambar'])): ?>
                                            <img src="<?= base_url($bArr['gambar']) ?>" alt="Banner" class="rounded shadow-sm object-fit-cover" style="width: 120px; height: 60px; object-fit: cover; border: 1px solid #e2e8f0;">
                                        <?php else: ?>
                                            <div class="rounded shadow-sm d-flex flex-column align-items-center justify-content-center text-white text-center p-1" style="width: 120px; height: 60px; background: <?= esc($bArr['warna_bg'] ?? 'linear-gradient(135deg, #1e3c72 0%, #2a5298 100%)') ?>; font-size: 0.65rem;">
                                                <i class="fas fa-layer-group mb-1"></i>
                                                <span class="text-truncate px-1 w-100 fw-bold"><?= esc($bArr['judul']) ?></span>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="fw-bold text-dark mb-1"><?= esc($bArr['judul']) ?></div>
                                        <div class="text-muted small text-truncate" style="max-width: 380px;">
                                            <?= !empty($bArr['subjudul']) ? esc($bArr['subjudul']) : '<span class="fst-italic opacity-50">Tidak ada deskripsi</span>' ?>
                                        </div>
                                    </td>
                                    <td>
                                        <?php if (!empty($bArr['url_link'])): ?>
                                            <div class="small fw-semibold text-primary mb-1">
                                                <i class="fas fa-link me-1"></i> <span class="text-break"><?= esc($bArr['url_link']) ?></span>
                                            </div>
                                            <span class="badge bg-secondary bg-opacity-10 text-secondary border px-2 py-1">
                                                Label: <?= esc($bArr['tombol_teks'] ?? 'Lihat Detail') ?>
                                            </span>
                                        <?php else: ?>
                                            <span class="text-muted small fst-italic">Tanpa tautan</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-sm <?= ($bArr['status'] == 1) ? 'btn-success' : 'btn-outline-secondary' ?> rounded-pill px-3 py-1 fw-semibold" onclick="toggleStatus(<?= (int)$bArr['id_banner'] ?>)">
                                            <?= ($bArr['status'] == 1) ? '<i class="fas fa-check me-1"></i> Aktif' : '<i class="fas fa-pause me-1"></i> Nonaktif' ?>
                                        </button>
                                    </td>
                                    <td class="text-end pe-4">
                                        <div class="btn-group shadow-sm" role="group">
                                            <button type="button" class="btn btn-sm btn-outline-primary" title="Edit Banner" onclick='openEditModal(<?= json_encode($bArr, JSON_HEX_APOS | JSON_HEX_QUOT) ?>)'>
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-outline-danger" title="Hapus Banner" onclick="deleteBanner(<?= (int)$bArr['id_banner'] ?>)">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah / Edit Banner -->
<div class="modal fade" id="modalBanner" tabindex="-1" aria-labelledby="modalBannerLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow" style="border-radius: 16px; overflow: hidden;">
            <form action="<?= base_url('banner/save') ?>" method="post" enctype="multipart/form-data" id="formBanner">
                <?= csrf_field() ?>
                <input type="hidden" name="id_banner" id="input_id_banner" value="">

                <div class="modal-header bg-primary text-white py-3">
                    <h5 class="modal-title fw-bold" id="modalBannerLabel">
                        <i class="fas fa-images me-2"></i> Tambah Banner Slider
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body p-4">
                    <div class="row g-3">
                        <!-- Judul -->
                        <div class="col-12">
                            <label for="input_judul" class="form-label fw-semibold text-dark">Judul Banner <span class="text-danger">*</span></label>
                            <input type="text" name="judul" id="input_judul" class="form-control rounded-3" placeholder="Contoh: Aplikasi Android CBT Resmi Telah Tersedia!" required>
                        </div>

                        <!-- Subjudul -->
                        <div class="col-12">
                            <label for="input_subjudul" class="form-label fw-semibold text-dark">Deskripsi / Subjudul</label>
                            <textarea name="subjudul" id="input_subjudul" rows="2" class="form-control rounded-3" placeholder="Keterangan singkat yang muncul di bawah judul..."></textarea>
                        </div>

                        <!-- Upload File Gambar -->
                        <div class="col-md-7">
                            <label for="input_gambar" class="form-label fw-semibold text-dark">
                                Upload Gambar Banner <small class="text-muted fw-normal">(Opsional jika pakai tema gradasi)</small>
                            </label>
                            <input type="file" name="gambar" id="input_gambar" class="form-control rounded-3" accept="image/*" onchange="previewImage(this)">
                            <div class="form-text small text-primary fw-medium"><i class="fas fa-info-circle me-1"></i> Rekomendasi Ukuran Desain: <b>20 cm × 10 cm</b> (atau <b>1200 × 600 px</b>, rasio 2:1). Format: JPG, PNG, WEBP.</div>
                            
                            <div id="imagePreviewContainer" class="mt-2 d-none">
                                <img id="imagePreview" src="" alt="Pratinjau" class="rounded shadow-sm w-100" style="max-height: 140px; object-fit: cover; border: 1px solid #cbd5e1;">
                            </div>
                        </div>

                        <!-- Warna Gradasi (Fallback jika tanpa gambar) -->
                        <div class="col-md-5">
                            <label for="input_warna_bg" class="form-label fw-semibold text-dark">Warna Tema / Gradasi</label>
                            <select name="warna_bg" id="input_warna_bg" class="form-select rounded-3">
                                <option value="linear-gradient(135deg, #1e3c72 0%, #2a5298 100%)">Biru Royal (Default CBT)</option>
                                <option value="linear-gradient(135deg, #0d9488 0%, #065f46 100%)">Hijau Zamrud (E-Learning)</option>
                                <option value="linear-gradient(135deg, #7c3aed 0%, #4c1d95 100%)">Ungu Modis (Akademik)</option>
                                <option value="linear-gradient(135deg, #ea580c 0%, #9a3412 100%)">Oranye Semangat (Pengumuman)</option>
                                <option value="linear-gradient(135deg, #0f172a 0%, #1e293b 100%)">Gelap Elegan (Dark Slate)</option>
                            </select>
                        </div>

                        <!-- URL Link Tujuan -->
                        <div class="col-md-8">
                            <label for="input_url_link" class="form-label fw-semibold text-dark">Tautan / Link Tujuan <small class="text-muted fw-normal">(Opsional)</small></label>
                            <input type="text" name="url_link" id="input_url_link" class="form-control rounded-3" placeholder="Contoh: downloads/CBT_Resmi.apk atau kbm/materi atau https://...">
                        </div>

                        <!-- Label Tombol -->
                        <div class="col-md-4">
                            <label for="input_tombol_teks" class="form-label fw-semibold text-dark">Label Tombol</label>
                            <input type="text" name="tombol_teks" id="input_tombol_teks" class="form-control rounded-3" value="Lihat Detail">
                        </div>

                        <!-- Urutan & Status -->
                        <div class="col-md-6">
                            <label for="input_urutan" class="form-label fw-semibold text-dark">Urutan Tampil</label>
                            <input type="number" name="urutan" id="input_urutan" class="form-control rounded-3" value="1" min="1" max="99">
                        </div>
                        <div class="col-md-6">
                            <label for="input_status" class="form-label fw-semibold text-dark">Status Publikasi</label>
                            <select name="status" id="input_status" class="form-select rounded-3">
                                <option value="1">Aktif (Tampil di Siswa)</option>
                                <option value="0">Nonaktif (Disembunyikan)</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="modal-footer bg-light py-3">
                    <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4 fw-semibold" id="btnSimpanBanner">
                        <i class="fas fa-save me-1"></i> Simpan Banner
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    var modalBannerEl = document.getElementById('modalBanner');
    var modalBanner = null;

    document.addEventListener('DOMContentLoaded', function () {
        if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
            modalBanner = new bootstrap.Modal(modalBannerEl);
        }
    });

    function openAddModal() {
        document.getElementById('formBanner').reset();
        document.getElementById('input_id_banner').value = '';
        document.getElementById('input_urutan').value = '1';
        document.getElementById('input_status').value = '1';
        document.getElementById('input_tombol_teks').value = 'Lihat Detail';
        document.getElementById('modalBannerLabel').innerHTML = '<i class="fas fa-plus-circle me-2"></i> Tambah Banner Baru';
        document.getElementById('imagePreviewContainer').classList.add('d-none');
        document.getElementById('imagePreview').src = '';
        if (modalBanner) modalBanner.show();
        else $('#modalBanner').modal('show');
    }

    function openEditModal(banner) {
        document.getElementById('formBanner').reset();
        document.getElementById('input_id_banner').value = banner.id_banner || '';
        document.getElementById('input_judul').value = banner.judul || '';
        document.getElementById('input_subjudul').value = banner.subjudul || '';
        document.getElementById('input_url_link').value = banner.url_link || '';
        document.getElementById('input_tombol_teks').value = banner.tombol_teks || 'Lihat Detail';
        document.getElementById('input_warna_bg').value = banner.warna_bg || 'linear-gradient(135deg, #1e3c72 0%, #2a5298 100%)';
        document.getElementById('input_urutan').value = banner.urutan || '1';
        document.getElementById('input_status').value = banner.status !== undefined ? banner.status : '1';
        document.getElementById('modalBannerLabel').innerHTML = '<i class="fas fa-edit me-2"></i> Edit Banner';

        var previewContainer = document.getElementById('imagePreviewContainer');
        var previewImg = document.getElementById('imagePreview');
        if (banner.gambar) {
            previewImg.src = '<?= base_url() ?>/' + banner.gambar;
            previewContainer.classList.remove('d-none');
        } else {
            previewContainer.classList.add('d-none');
            previewImg.src = '';
        }

        if (modalBanner) modalBanner.show();
        else $('#modalBanner').modal('show');
    }

    function previewImage(input) {
        var previewContainer = document.getElementById('imagePreviewContainer');
        var previewImg = document.getElementById('imagePreview');
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                previewImg.src = e.target.result;
                previewContainer.classList.remove('d-none');
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function deleteBanner(id) {
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                title: 'Hapus Banner?',
                text: "Banner yang dihapus tidak dapat dipulihkan kembali.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then(function (result) {
                if (result.isConfirmed) {
                    executeDelete(id);
                }
            });
        } else {
            if (confirm('Yakin ingin menghapus banner ini?')) {
                executeDelete(id);
            }
        }
    }

    function executeDelete(id) {
        $.ajax({
            url: '<?= base_url('banner/delete') ?>',
            type: 'POST',
            data: {
                id_banner: id,
                '<?= csrf_token() ?>': '<?= csrf_hash() ?>'
            },
            dataType: 'json',
            success: function (res) {
                if (res.status) {
                    location.reload();
                } else {
                    alert(res.message || 'Gagal menghapus banner.');
                }
            },
            error: function () {
                location.reload();
            }
        });
    }

    function toggleStatus(id) {
        $.ajax({
            url: '<?= base_url('banner/toggle') ?>',
            type: 'POST',
            data: {
                id_banner: id,
                '<?= csrf_token() ?>': '<?= csrf_hash() ?>'
            },
            dataType: 'json',
            success: function (res) {
                location.reload();
            },
            error: function () {
                location.reload();
            }
        });
    }
</script>
<?= $this->endSection() ?>
