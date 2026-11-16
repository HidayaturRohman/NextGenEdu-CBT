<?= $this->extend('layout/dashboard_template_bs5') ?>
<?= $this->section('content') ?>

<div class="row">
    <div class="col-sm-12">
        <div class="card mb-4 border-0 shadow-sm" style="border-radius: 12px;">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between w-100">
                    <div class="d-flex align-items-center">
                        <div class="me-3 flex-shrink-0">
                            <div class="rounded-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 60px; height: 60px; background: linear-gradient(135deg, #ef4444 0%, #b91c1c 100%); color: #ffffff;">
                                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M6 9H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h2"></path>
                                    <path d="M18 9h2a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2h-2"></path>
                                    <path d="M4 22h16"></path>
                                    <path d="M10 14.66V17c0 .55-.47.98-.97 1.21C7.85 18.75 7 20.24 7 22"></path>
                                    <path d="M14 14.66V17c0 .55.47.98.97 1.21C16.15 18.75 17 20.24 17 22"></path>
                                    <path d="M18 2H6v7a6 6 0 0 0 12 0V2z"></path>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h4 class="card-title mb-1 fw-bold d-flex align-items-center" style="color: #232d42;">
                                <?= $judul ?>
                            </h4>
                            <p class="text-muted mb-0" style="font-size: 0.9rem;">Manajemen kegiatan ekstrakurikuler sekolah, penetapan pembina, serta alokasi kelas ekskul.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid p-0">
                <div class="card my-shadow mb-4">
                    <div class="card-body">
                        <div class="mb-3 d-flex justify-content-between align-items-center">
                            <div>
                                <button type="button" onclick="window.location.reload()" class="btn btn-sm btn-default border me-1"><i class="fa fa-sync me-1"></i> Reload</button>
                            </div>
                            <button type="button" data-bs-toggle="modal" data-bs-target="#createEkstraModal" class="btn btn-sm btn-primary"><svg class="icon-20 me-1" width="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg> Tambah Ekskul</button>
                        </div>
                        
                        <div class="row">
                            <!-- Kolom Kiri: Tabel Ekstrakurikuler -->
                            <div class="col-md-6 mb-4 table-responsive">
                                <label class="d-flex align-items-center mb-3" style="font-size: 1.1rem; font-weight: 700; color: #232D42;">
                                    <iconify-icon icon="lucide:list" class="me-2 text-primary" style="font-size: 1.3rem;"></iconify-icon>
                                    Daftar Ekstrakurikuler
                                </label>
                                <table id="tableEkstra" class="w-100 table table-striped table-bordered table-hover align-middle">
                                    <thead>
                                        <tr>
                                            <th class="text-center align-middle p-0" style="width: 40px">No.</th>
                                            <th class="align-middle">Ekstrakurikuler</th>
                                            <th class="align-middle text-center" style="width: 90px">Kode</th>
                                            <th class="text-center align-middle p-0" style="width: 90px"><span>Aksi</span></th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>

                            <!-- Kolom Kanan: Tentukan Kelas Ekskul -->
                            <div class="col-md-6 mb-4">
                                <label class="d-flex align-items-center mb-3" style="font-size: 1.1rem; font-weight: 700; color: #232D42;">
                                    <iconify-icon icon="lucide:check-square" class="me-2 text-primary" style="font-size: 1.3rem;"></iconify-icon>
                                    Tentukan Kelas Ekskul
                                </label>
                                <?= form_open('dataekstra/save', array('id' => 'save')) ?>
                                <div class="card border">
                                    <div class="card-header d-flex justify-content-between align-items-center bg-light">
                                        <span class="fw-bold" style="font-size: 0.95rem;">Alokasi Ekskul Per Kelas</span>
                                        <button type="submit" class="btn btn-primary btn-sm">
                                            <svg class="icon-20 me-1" width="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg>Simpan
                                        </button>
                                    </div>
                                    <div class="card-body">
                                        <?php if (count($kelas) > 0) :
                                            foreach ($kelas as $key => $kls) :
                                                $ids_selected = [];
                                                if (isset($ekskul_kelas[$key]) && !empty($ekskul_kelas[$key])) {
                                                    $ids = $ekskul_kelas[$key][0]->ekstra ?? [];
                                                    if (is_array($ids)) {
                                                        foreach ($ids as $id) {
                                                            $ids_selected[] = is_array($id) ? ($id['ekstra'] ?? '') : (is_object($id) ? ($id->ekstra ?? '') : $id);
                                                        }
                                                    }
                                                }
                                                ?>
                                                <div class="form-group mb-3">
                                                    <label class="fw-bold mb-1">Kelas <?= $kls ?></label>
                                                    <?php
                                                    echo form_dropdown(
                                                        'ekskul' . $key . '[]',
                                                        $ekskul,
                                                        $ids_selected,
                                                        'id="ekskul' . $key . '" class="select2 form-control form-control-sm" multiple="multiple" data-placeholder="Pilih Ekskul"'
                                                    ); ?>
                                                </div>
                                            <?php endforeach;
                                        else: ?>
                                            <div class="alert alert-warning" role="alert">Belum ada data kelas aktif pada semester ini.</div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <?= form_close() ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<!-- Modal Create -->
<?= form_open('dataekstra/create', array('id' => 'create')) ?>
<div class="modal fade" id="createEkstraModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Tambah Ekstrakurikuler</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group row mb-3">
                    <label class="col-md-3 col-form-label">Ekstrakurikuler*</label>
                    <div class="col-md-9">
                        <input type="text" id="createnama" name="nama_ekstra" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label class="col-md-3 col-form-label">Kode*</label>
                    <div class="col-md-9">
                        <input type="text" id="createkode" name="kode_ekstra" class="form-control" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">
                    <svg class="icon-20 me-1" width="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg> Simpan
                </button>
            </div>
        </div>
    </div>
</div>
<?= form_close() ?>

<!-- Modal Edit -->
<?= form_open('dataekstra/update', array('id' => 'update')) ?>
<div class="modal fade" id="editEkstraModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Ekstrakurikuler</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group row mb-3">
                    <label class="col-md-3 col-form-label">Ekstrakurikuler*</label>
                    <div class="col-md-9">
                        <input type="text" id="namaEdit" name="nama_ekstra" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label class="col-md-3 col-form-label">Kode*</label>
                    <div class="col-md-9">
                        <input type="text" id="kodeEdit" name="kode_ekstra" class="form-control" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="editIdEkstra" name="id_ekstra" class="form-control">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" id="submitUpdate" class="btn btn-primary">
                    <svg class="icon-20 me-1" width="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg> Simpan Perubahan
                </button>
            </div>
        </div>
    </div>
</div>
<?= form_close() ?>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    var kelases = JSON.parse('<?= json_encode($kelas) ?>');
    var table;

    function reload_ajax() {
        if (typeof table !== 'undefined' && table.ajax) {
            table.ajax.reload(null, false);
        } else {
            window.location.reload();
        }
    }

    function deleteItem(id) {
        swal.fire({
            title: "Anda yakin?",
            text: "Ekstrakurikuler ini akan dihapus!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Hapus!"
        }).then(result => {
            if (result.value || result.isConfirmed) {
                $.ajax({
                    url: base_url + "dataekstra/delete/" + id,
                    type: "POST",
                    dataType: "JSON",
                    success: function (data) {
                        if (data.status) {
                            if (typeof showSuccessToast === 'function') showSuccessToast(data.message);
                            reload_ajax();
                        } else {
                            swal.fire({
                                title: "Gagal",
                                html: data.message || data.total,
                                icon: "error"
                            });
                        }
                    }, error: function (xhr, status, error) {
                        console.log(xhr.responseText);
                        if (typeof showDangerToast === 'function') showDangerToast('Gagal menghapus data');
                    }
                });
            }
        });
    }

    $(document).ready(function () {
        if (typeof ajaxcsrf === 'function') ajaxcsrf();

        $('.select2').select2({ width: '100%' });

        var arrKelas = [];
        $.each(kelases, function (key, entry) {
            var item = {};
            item['kls_id'] = key;
            arrKelas.push(item);
        });

        table = $("#tableEkstra").DataTable({
            oLanguage: {
                sProcessing: "loading..."
            },
            searching: false,
            info: false,
            paging: false,
            ordering: false,
            processing: true,
            serverSide: true,
            ajax: {
                url: base_url + "dataekstra/read",
                dataType: "json",
                type: "POST"
            },
            columns: [
                {
                    data: "id_ekstra",
                    className: "text-center",
                    orderable: false,
                    searchable: false,
                    render: function (data, type, row, meta) {
                        return meta.row + 1;
                    }
                },
                {
                    data: "nama_ekstra",
                },
                {
                    data: "kode_ekstra",
                    className: "text-center"
                },
                {
                    data: "id_ekstra",
                    className: "text-center",
                    orderable: false,
                    searchable: false,
                    render: function (data, type, row, meta) {
                        return `<div class="btn-group btn-group-sm">
                            <a class="btn btn-xs btn-warning editRecord" data-bs-toggle="modal" data-bs-target="#editEkstraModal" data-id="${row.id_ekstra}" data-nama="${row.nama_ekstra}" data-kode="${row.kode_ekstra}">
                                <i class="fa fa-pencil-alt text-white"></i>
                            </a>
                            <a onclick="deleteItem(${row.id_ekstra})" class="btn btn-xs btn-danger deleteRecord ms-1">
                                <i class="fa fa-trash text-white"></i>
                            </a>
                        </div>`;
                    }
                }
            ]
        });

        $('#editEkstraModal').on('show.bs.modal', function (e) {
            var id = $(e.relatedTarget).data('id');
            var nama = $(e.relatedTarget).data('nama');
            var kode = $(e.relatedTarget).data('kode');

            $('#editIdEkstra').val(id);
            $('#namaEdit').val(nama);
            $('#kodeEdit').val(kode);
        });

        $('#createEkstraModal').on('show.bs.modal', function () {
            $('#createnama').val('');
            $('#createkode').val('');
        });

        $('#create').on('submit', function (e) {
            e.preventDefault();
            e.stopImmediatePropagation();

            $.ajax({
                url: base_url + "dataekstra/create",
                type: "POST",
                dataType: "JSON",
                data: $(this).serialize(),
                success: function (data) {
                    var modalEl = document.getElementById('createEkstraModal');
                    if (modalEl) {
                        var modalInst = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
                        modalInst.hide();
                    }
                    if (typeof showSuccessToast === 'function') showSuccessToast(data.message || 'Data berhasil disimpan.');
                    window.location.reload();
                }, error: function (xhr, status, error) {
                    console.log(xhr.responseText);
                    if (typeof showDangerToast === 'function') showDangerToast('Gagal menyimpan data');
                }
            });
            return false;
        });

        $('#update').on('submit', function (e) {
            e.preventDefault();
            e.stopImmediatePropagation();

            $.ajax({
                url: base_url + "dataekstra/update",
                type: "POST",
                dataType: "JSON",
                data: $(this).serialize(),
                success: function (data) {
                    var modalEl = document.getElementById('editEkstraModal');
                    if (modalEl) {
                        var modalInst = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
                        modalInst.hide();
                    }
                    if (typeof showSuccessToast === 'function') showSuccessToast(data.message || 'Data berhasil diupdate.');
                    window.location.reload();
                }, error: function (xhr, status, error) {
                    console.log(xhr.responseText);
                    if (typeof showDangerToast === 'function') showDangerToast('Gagal mengupdate data');
                }
            });
            return false;
        });

        $('#save').submit(function (e) {
            e.preventDefault();

            $.ajax({
                url: base_url + "dataekstra/save",
                type: "POST",
                dataType: "JSON",
                data: $(this).serialize() + '&kelas=' + JSON.stringify(arrKelas),
                success: function (data) {
                    if (data.status) {
                        if (typeof showSuccessToast === 'function') showSuccessToast('Kelas ekskul berhasil disimpan');
                        else swal.fire('Sukses', 'Kelas ekskul berhasil disimpan', 'success');
                    } else {
                        if (typeof showDangerToast === 'function') showDangerToast('Data tidak tersimpan.');
                    }
                }, error: function (xhr, status, error) {
                    console.log(xhr.responseText);
                    if (typeof showDangerToast === 'function') showDangerToast('Data tidak tersimpan.');
                }
            });
        });
    });
</script>
<?= $this->endSection() ?>