<?= $this->extend('layout/dashboard_template_bs5') ?>
<?= $this->section('content') ?>
<?php
/**
 * Created by IntelliJ IDEA.
 * User: BangRohman
 * Date: 14/06/2020
 * Time: 01.31
 */
?>

    <div class="row">
        <div class="col-sm-12">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between w-100">
                        <div class="d-flex align-items-center">
                            <div class="me-3 flex-shrink-0">
                                <div class="rounded-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 60px; height: 60px; background: linear-gradient(135deg, #0d9488 0%, #115e59 100%); color: #ffffff;">
                                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="9" cy="7" r="4"></circle>
                                        <polyline points="16 11 18 13 22 9"></polyline>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h4 class="card-title mb-1 fw-bold d-flex align-items-center">
                                    <?= $judul ?>
                                </h4>
                                <p class="text-muted mb-0" style="font-size: 0.9rem;">Manajemen data pendidik dan tenaga kependidikan (PTK), NIP, akun login guru, serta bidang pengajaran.</p>
                            </div>
                        </div>
                        <div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card card-default mb-4">
                <div class="card-header py-3">
                    <div class="card-title d-flex align-items-center">
                        <iconify-icon icon="lucide:settings-2" class="me-2 text-primary" style="font-size: 1.4rem;"></iconify-icon>
                        <span style="font-size: 1.25rem; font-weight: 700; color: #232D42;">Master <?= $subjudul ?></span>
                    </div>
                <div class="card-tools d-flex align-items-center gap-1 flex-wrap">
                    <button type="button" id="btn-hapus-terpilih" onclick="hapusTerpilih()" class="btn btn-sm btn-danger shadow-sm" style="display: none;">
                        <i class="fas fa-trash-alt me-1"></i> <span id="label-hapus-terpilih">Hapus Terpilih (0)</span>
                    </button>
                    <?php if (!empty($gurus)): ?>
                        <a href="<?= esc(base_url('dataguru/kartu/semua'), 'attr') ?>"
                           class="btn btn-sm btn-outline-primary" target="_blank" rel="noopener">
                            <i class="fas fa-print me-1" aria-hidden="true"></i> Cetak Semua Guru
                        </a>
                    <?php endif; ?>
                    <button type="button" onclick="window.location.reload()" class="btn btn-sm btn-default">
                        <i class="fa fa-sync"></i> <span class="d-none d-sm-inline-block ms-1">Reload</span>
                    </button>
                    <a href="<?= base_url('dataguru/import') ?>" class="btn btn-sm bg-gradient-primary"><i
                                class="fas fa-upload"></i><span class="d-none d-sm-inline-block ms-1">Tambah Guru / Import</span></a>
                    <a href="<?= base_url('dataguru/update') ?>" class="btn btn-sm bg-gradient-success"><i
                                class="fas fa-database"></i><span
                                class="d-none d-sm-inline-block ms-1">Update Data</span></a>
                </div>
            </div>
            <div class="card-body">
                <?php if (count($gurus) > 0) : ?>
                    <div class="table-responsive">
                        <table id="list-guru" class="table table-striped table-bordered table-hover w-100">
                            <thead>
                                <tr>
                                    <th class="text-center align-middle" style="width: 40px;">
                                        <input type="checkbox" id="check-all" class="form-check-input" title="Pilih Semua" style="transform: scale(1.2); cursor: pointer;">
                                    </th>
                                    <th class="text-center" style="width: 50px;">No</th>
                                    <th class="text-center" style="width: 80px;">Foto</th>
                                    <th>Detail Guru</th>
                                    <th>Pengampu</th>
                                    <th class="text-center" style="width: 100px;">Status</th>
                                    <th class="text-center" style="width: 180px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; foreach ($gurus as $guru):
                                    $mapels_guru = $guru->mapel_kelas;
                                    $ekstras_guru = $guru->ekstra_kelas; 
                                ?>
                                <tr>
                                    <td class="text-center align-middle">
                                        <input type="checkbox" name="checked[]" class="form-check-input check-guru" value="<?= $guru->id_guru ?>" style="transform: scale(1.2); cursor: pointer;">
                                    </td>
                                    <td class="text-center align-middle"><?= $no++ ?></td>
                                    <td class="text-center align-middle">
                                        <img class="rounded-circle img-thumbnail" style="width: 60px; height: 60px; object-fit: cover;"
                                             src="<?= isset($guru->foto) && file_exists($guru->foto) ? base_url().$guru->foto : base_url('assets/img/guru.png') ?>" alt="foto"/>
                                    </td>
                                    <td class="align-middle">
                                        <div class="fw-bold text-primary mb-1" style="font-size: 1.1rem;"><?= $guru->nama_guru ?></div>
                                        <div class="text-muted text-sm mb-1"><?php $lblNip = !empty($guru->jenis_nip) ? $guru->jenis_nip : 'NIP'; ?><iconify-icon icon="lucide:id-card" class="me-1"></iconify-icon><b><?= $lblNip ?>:</b> <?= $guru->nip ?></div>
                                        <?php if (!empty($guru->level)): ?>
                                            <span class="badge bg-soft-info text-info"><iconify-icon icon="lucide:star" class="me-1"></iconify-icon><?= $guru->level . ' ' . $guru->nama_kelas ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="align-middle">
                                        <?php if (!empty($mapels_guru) || !empty($ekstras_guru)): ?>
                                            <div class="d-flex flex-column gap-1">
                                                <?php foreach ($mapels_guru as $mapel) : 
                                                    $mapel = is_array($mapel) ? (object)$mapel : $mapel;
                                                    if (!isset($mapel->nama_mapel)) continue;
                                                ?>
                                                    <div class="text-sm">
                                                        <span class="fw-bold text-primary"><?= esc($mapel->nama_mapel) ?>:</span> 
                                                        <?php
                                                        $kls_guru_mapel = '';
                                                        if (!empty($mapel->kelas_mapel) && (is_array($mapel->kelas_mapel) || is_object($mapel->kelas_mapel))) {
                                                            foreach ($mapel->kelas_mapel as $kls_mpl) {
                                                                $kls_mpl = is_array($kls_mpl) ? (object)$kls_mpl : $kls_mpl;
                                                                $kId = $kls_mpl->kelas ?? ($kls_mpl->id_kelas ?? null);
                                                                if ($kId !== null && isset($kelass[$kId])) {
                                                                    $kls_guru_mapel .= '<span class="badge bg-light text-dark border me-1 px-1">' . esc($kelass[$kId]->nama_kelas) . '</span>';
                                                                }
                                                            }
                                                        }
                                                        echo $kls_guru_mapel ?: '<span class="text-muted small fst-italic">Semua Kelas</span>';
                                                        ?>
                                                    </div>
                                                <?php endforeach; ?>
                                                
                                                <?php foreach ($ekstras_guru as $ekstra) : 
                                                    $ekstra = is_array($ekstra) ? (object)$ekstra : $ekstra;
                                                    if (!isset($ekstra->nama_ekstra)) continue;
                                                ?>
                                                    <div class="text-sm">
                                                        <span class="fw-bold text-info"><?= esc($ekstra->nama_ekstra) ?> (Eks):</span> 
                                                        <?php
                                                        $kls_guru_ekstra = '';
                                                        if (!empty($ekstra->kelas_ekstra) && (is_array($ekstra->kelas_ekstra) || is_object($ekstra->kelas_ekstra))) {
                                                            foreach ($ekstra->kelas_ekstra as $kls_eks) {
                                                                $kls_eks = is_array($kls_eks) ? (object)$kls_eks : $kls_eks;
                                                                $kId = $kls_eks->kelas ?? ($kls_eks->id_kelas ?? null);
                                                                if ($kId !== null && isset($kelass[$kId])) {
                                                                    $kls_guru_ekstra .= '<span class="badge bg-light text-dark border me-1 px-1">' . esc($kelass[$kId]->nama_kelas) . '</span>';
                                                                }
                                                            }
                                                        }
                                                        echo $kls_guru_ekstra ?: '<span class="text-muted small fst-italic">-</span>';
                                                        ?>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        <?php else: ?>
                                            <span class="text-muted text-sm fst-italic">Belum ada pengampu</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center align-middle">
                                        <?php
                                        if ($guru->active === '1') {
                                            echo '<span class="badge bg-success text-white px-3 py-2 rounded-pill shadow-sm" style="font-size: 0.85rem;"><iconify-icon icon="lucide:check-circle" class="me-1"></iconify-icon>Aktif</span>';
                                        } else {
                                            echo '<span class="badge bg-danger text-white px-3 py-2 rounded-pill shadow-sm" style="font-size: 0.85rem;"><iconify-icon icon="lucide:x-circle" class="me-1"></iconify-icon>Nonaktif</span>';
                                        }
                                        ?>
                                    </td>
                                    <td class="text-center align-middle">
                                        <div class="d-flex justify-content-center gap-1">
                                            <a href="<?= base_url('dataguru/edit/' . $guru->id_guru) ?>" class="btn btn-sm btn-primary" title="Edit Profile">
                                                <iconify-icon icon="lucide:user" style="font-size: 1.1rem;"></iconify-icon>
                                            </a>
                                            <a href="<?= base_url('dataguru/editJabatan/' . $guru->id_guru) ?>" class="btn btn-sm btn-info" title="Edit Jabatan">
                                                <iconify-icon icon="lucide:briefcase" style="font-size: 1.1rem;"></iconify-icon>
                                            </a>
                                            <a href="<?= esc(base_url('dataguru/kartu/' . (int) $guru->id_guru), 'attr') ?>"
                                               class="btn btn-sm btn-outline-primary" title="Cetak Kartu Guru"
                                               target="_blank" rel="noopener">
                                                <i class="fas fa-print" aria-hidden="true"></i> Cetak Kartu Guru
                                            </a>
                                            <button onclick="hapus('<?= $guru->id_guru ?>')" class="btn btn-sm btn-danger" title="Hapus">
                                                <iconify-icon icon="lucide:trash-2" style="font-size: 1.1rem;"></iconify-icon>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="alert alert-default-warning align-content-center" role="alert">Belum ada data GURU</div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?= form_open('', array('id' => 'hapus-guru')) ?>
<?= form_close() ?>

<?= $this->endSection() ?>

<style>
.bg-soft-primary { background-color: rgba(58, 87, 232, 0.1) !important; }
.bg-soft-info { background-color: rgba(8, 130, 149, 0.1) !important; }
</style>

<?= $this->section('scripts') ?>
<script>
    $('.thumb-lg').css({'width': '6rem', 'height': '6rem'});

    function hapus(idGuru) {
        swal.fire({
            title:"Anda yakin?",
            text:"Data guru akan dihapus!",
            icon:"warning",
            showCancelButton: true,
            confirmButtonColor:"#3085d6",
            cancelButtonColor:"#d33",
            confirmButtonText:"Hapus!"
        }).then(result => {
            if (result.value) {
                swal.fire({
                    title: "Menghapus...",
                    text: "Silakan tunggu, sedang memproses...",
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    onOpen: () => {
                        swal.showLoading();
                    }
                });
                $.ajax({
                    url: base_url + 'dataguru/deleteguru',
                    data: $('#hapus-guru').serialize() + '&id_guru=' + idGuru,
                    type:"POST",
                    dataType: "JSON",
                    success: function (respon) {
                        console.log(respon);
                        if (respon.status) {
                            swal.fire({
                                title:"Berhasil",
                                text: respon.message || "Data guru berhasil dihapus",
                                icon:"success"
                            }).then(result => {
                                if (result.value) {
                                    window.location.reload(true);
                                }
                            });
                        } else {
                            swal.fire({
                                title:"Gagal Menghapus",
                                html: respon.message || "Data guru tidak dapat dihapus",
                                icon:"error"
                            });
                        }
                    },
                    error: function (xhr) {
                        console.error("error delete guru", xhr ? xhr.responseText : '');
                        let msg = "Terjadi kesalahan pada server saat menghapus data guru";
                        try {
                            let json = JSON.parse(xhr.responseText);
                            if (json && json.message) msg = json.message;
                        } catch (e) {}
                        swal.fire({
                            title:"Gagal",
                            html: msg,
                            icon:"error"
                        });
                    }
                });
            }
        });
    }

    function updateHapusTerpilihBtn() {
        var checked = $('input.check-guru:checked').length;
        if (checked > 0) {
            $('#btn-hapus-terpilih').show();
            $('#label-hapus-terpilih').text('Hapus Terpilih (' + checked + ')');
        } else {
            $('#btn-hapus-terpilih').hide();
            $('#check-all').prop('checked', false);
        }
    }

    function hapusTerpilih() {
        var checkedIds = [];
        $('input.check-guru:checked').each(function() {
            checkedIds.push($(this).val());
        });

        if (checkedIds.length === 0) {
            swal.fire({
                title: "Peringatan",
                text: "Pilih setidaknya satu guru yang ingin dihapus dengan mencentang kotak pilihan.",
                icon: "warning"
            });
            return;
        }

        swal.fire({
            title: "Hapus " + checkedIds.length + " Guru?",
            text: "Data guru yang dipilih akan dihapus secara permanen!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Ya, Hapus Semua!",
            cancelButtonText: "Batal"
        }).then(result => {
            if (result.value) {
                swal.fire({
                    title: "Menghapus Data...",
                    text: "Silakan tunggu, sedang memproses " + checkedIds.length + " data guru...",
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    onOpen: () => {
                        swal.showLoading();
                    }
                });

                $.ajax({
                    url: base_url + 'dataguru/hapus',
                    type: "POST",
                    dataType: "JSON",
                    data: $('#hapus-guru').serialize() + '&' + $.param({ checked: checkedIds }),
                    success: function(respon) {
                        if (respon.status) {
                            swal.fire({
                                title: "Berhasil",
                                html: respon.message || (respon.total + " data guru berhasil dihapus"),
                                icon: "success"
                            }).then(result => {
                                if (result.value) {
                                    window.location.reload(true);
                                }
                            });
                        } else {
                            swal.fire({
                                title: "Gagal Menghapus",
                                html: respon.message || "Gagal menghapus guru yang dipilih",
                                icon: "error"
                            });
                        }
                    },
                    error: function(xhr) {
                        console.error('Error batch delete:', xhr ? xhr.responseText : '');
                        let msg = "Terjadi kesalahan pada server saat menghapus data guru";
                        try {
                            let json = JSON.parse(xhr.responseText);
                            if (json && json.message) msg = json.message;
                        } catch (e) {}
                        swal.fire({
                            title: "Gagal",
                            html: msg,
                            icon: "error"
                        });
                    }
                });
            }
        });
    }

    $(document).ready(function () {
        var table = $("#list-guru").DataTable({
            paging: true,
            ordering: true,
            info: true,
            order: [[1, 'asc']],
            columnDefs: [
                { targets: [0, 2, 6], orderable: false }
            ]
        });

        // Pilih Semua checkbox
        $('#check-all').on('click change', function() {
            var isChecked = this.checked;
            var rows = table.rows({ 'search': 'applied' }).nodes();
            $('input.check-guru', rows).prop('checked', isChecked);
            updateHapusTerpilihBtn();
        });

        // Checkbox individual per baris
        $('#list-guru tbody').on('change', 'input.check-guru', function() {
            updateHapusTerpilihBtn();
            var total = $('input.check-guru').length;
            var checked = $('input.check-guru:checked').length;
            $('#check-all').prop('checked', total > 0 && total === checked);
        });

        // Sinkronisasi saat ganti halaman / paging DataTables
        table.on('draw', function() {
            var total = $('input.check-guru').length;
            var checked = $('input.check-guru:checked').length;
            $('#check-all').prop('checked', total > 0 && total === checked);
            updateHapusTerpilihBtn();
        });
    });
</script>
<?= $this->endSection() ?>

