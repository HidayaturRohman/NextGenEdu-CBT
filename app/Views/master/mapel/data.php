<?= $this->extend('layout/dashboard_template_bs5') ?>
<?= $this->section('content') ?>

    <div class="row">
  <div class="col-sm-12">
    <div class="card mb-4">
      <div class="card-body">
        <div class="d-flex align-items-center justify-content-between w-100">
            <div class="d-flex align-items-center">
              <div class="me-3 flex-shrink-0">
                <div class="rounded-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 60px; height: 60px; background: linear-gradient(135deg, #10b981 0%, #047857 100%); color: #ffffff;">
                  <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path>
                    <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path>
                  </svg>
                </div>
              </div>
              <div>
                <h4 class="card-title mb-1 fw-bold d-flex align-items-center">
                    <?= $judul ?>
                </h4>
                <p class="text-muted mb-0" style="font-size: 0.9rem;">Pengelolaan kurikulum mata pelajaran, kode mapel, kelompok bidang studi, serta pengampu mapel.</p>
              </div>
            </div>
            <div>
                
            </div>
        </div>
      </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card  mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="row mb-2">
                                <div class="col-6">
                                    <h6>Kelompok Utama</h6>
                                </div>
                                <div class="col-6">
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#editKelompokModal"
                                            class="btn btn-sm btn-primary float-end"><svg class="icon-20 me-1" width="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                    </button>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table id="tableKelompok" class="w-100 table table-sm table-striped table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th height="40" class="text-center align-middle">Kategori</th>
                                        <th class="text-center align-middle">Kode</th>
                                        <th class="align-middle">Nama</th>
                                        <th class="text-center align-middle p-0"><span>Aksi</span></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="row mb-2">
                                <div class="col-6">
                                    <h6>Sub Kelompok</h6>
                                </div>
                                <div class="col-6">
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#editSubKelompokModal"
                                            class="btn btn-xs btn-primary float-end"><svg class="icon-20 me-1" width="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                    </button>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table id="tableSubKelompok" class="table table-sm table-striped table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th height="40" class="text-center align-middle">Kode</th>
                                        <th class="align-middle">Nama</th>
                                        <th class="text-center align-middle">Kel. Utama</th>
                                        <th class="text-center align-middle p-0"><span>Aksi</span></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card  mb-4">
                <div class="card-header">
                    <div class="card-title d-flex align-items-center">
                        <iconify-icon icon="lucide:settings-2" class="me-2 text-primary" style="font-size: 1.4rem;"></iconify-icon>
                        <span style="font-size: 1.25rem; font-weight: 700; color: #232D42;"><?= $subjudul ?></span>
                    </div>
                    <div class="card-tools d-flex justify-content-end align-items-center gap-1">
                        <button id="hapusterpilih" onclick="bulk_delete()" type="button" class="btn btn-sm btn-danger d-none" data-toggle="tooltip" title="Hapus Terpilih"><i class="far fa-trash-alt"></i> Hapus Terpilih</button>
                        <button type="button" data-bs-toggle="modal" data-bs-target="#createMapelModal" class="btn btn-sm btn-primary"><svg class="icon-20 me-1" width="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg> Tambah Data</button>
                        <a href="<?= base_url('datamapel/import') ?>" class="btn btn-sm btn-success"><i class="fa fa-upload"></i> Import</a>
                        <button type="button" onclick="reload_ajax()" class="btn btn-sm btn-default"><i class="fa fa-sync"></i> Reload</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="alert alert-default-light border border-success align-content-center mb-3" role="alert">
                        <b>Nomor Urut Rapor</b> dan <b>Kelompok</b> diperlukan jika ingin mencetak rapor
                    </div>
                    <?= form_open('', array('id' => 'bulk')) ?>
                    <div class="table-responsive">
                        <table id="tableMapel" class="w-100 table table-sm table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th height="40" class="text-center align-middle p-0 w-auto">
                                    <input type="checkbox" class="select_all">
                                </th>
                                <th class="text-center align-middle p-0 w-auto">No.Urut Rapor</th>
                                <th class="align-middle">Mata Pelajaran</th>
                                <th class="text-center align-middle">Kode Mata Pelajaran</th>
                                <th class="text-center align-middle">Kelompok</th>
                                <th class="text-center align-middle">Status</th>
                                <th class="text-center align-middle p-0"><span>Aksi</span></th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </section>
</div>

<?= form_open('create', array('id' => 'create-kelompok')) ?>
<div class="modal fade" id="editKelompokModal" tabindex="-1" role="dialog" aria-labelledby="editKelompokModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editKelompokModalLabel">Kelompok Mata Pelajaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="id_kel_mapel" name="id_kel_mapel" class="form-control">
                <input type="hidden" name="id_parent" value="0" class="form-control" required>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Kode*</label>
                    <div class="col-md-9">
                        <input type="text" id="createkodekel" name="kode_kel_mapel" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Nama*</label>
                    <div class="col-md-9">
                        <input type="text" id="createnamakel" name="nama_kel_mapel" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Kategori*</label>
                    <div class="col-md-9">
                        <select id="kategori" name="kategori" class="form-control" required="">
                            <?php
                            foreach ($kategori as $kat) : ?>
                                <option value="<?= $kat ?>"><?= $kat ?></option>
                            <?php endforeach; ?>
                        </select>
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

<?= form_open('create', array('id' => 'create-sub-kelompok')) ?>
<div class="modal fade" id="editSubKelompokModal" tabindex="-1" role="dialog"
     aria-labelledby="editSubKelompokModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editSubKelompokModalLabel">Sub Kelompok Mata Pelajaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="id_kel_sub" name="id_kel_mapel" class="form-control">
                <input type="hidden" id="kategori_sub" name="kategori" class="form-control" required>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Kode*</label>
                    <div class="col-md-9">
                        <input type="text" id="createkodesub" name="kode_kel_mapel" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Nama*</label>
                    <div class="col-md-9">
                        <input type="text" id="createnamasub" name="nama_kel_mapel" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Kel. Utama*</label>
                    <div class="col-md-9">
                        <select id="id_parent_sub" name="id_parent" class="form-control" required>
                            <?php
                            foreach ($kelompok_mapel as $ky => $km) :
                                if ($km->id_parent == 0) :
                                    ?>
                                    <option value="<?= $ky ?>"><?= $km->nama_kel_mapel ?></option>
                                <?php endif; endforeach; ?>
                        </select>
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

<div class="modal fade" id="createMapelModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <?= form_open('datamapel/create', array('id' => 'create')) ?>
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Tambah Mapel</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">Mapel*</label>
                    <div class="col-md-10">
                        <input type="text" id="createnama" name="nama_mapel" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">Kode*</label>
                    <div class="col-md-10">
                        <input type="text" id="createkode" name="kode_mapel" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">Kelompok*</label>
                    <div class="col-md-10">
                        <?php echo form_dropdown(
                            'kelompok',
                            $kelompok,
                            '',
                            'class="form-control" required'
                        ); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">Status*</label>
                    <div class="col-md-10">
                        <?php
                        echo form_dropdown(
                            'status',
                            $status,
                            '1',
                            'class="form-control" required'
                        ); ?>
                    </div>
                </div>
                <div class="form-group row" id="formkode">
                    <label class="col-md-2 col-form-label">No. Urut Rapor*</label>
                    <div class="col-md-10">
                        <input type="number" name="urutan_tampil" class="form-control">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">
                    <svg class="icon-20 me-1" width="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg> Simpan
                </button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<div class="modal fade" id="editMapelModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <?= form_open('datamapel/update', array('id' => 'update')) ?>
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Mapel</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group row" id="formnama">
                    <label class="col-md-2 col-form-label">Mapel*</label>
                    <div class="col-md-10">
                        <input type="text" id="namaEdit" name="nama_mapel" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row" id="formkode">
                    <label class="col-md-2 col-form-label">Kode*</label>
                    <div class="col-md-10">
                        <input type="text" id="kodeEdit" name="kode_mapel" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row" id="formkelompok">
                    <label class="col-md-2 col-form-label">Kelompok*</label>
                    <div class="col-md-10">
                        <?php
                        echo form_dropdown(
                            'kelompok',
                            $kelompok,
                            '',
                            'id="kelompok" class="form-control" required'
                        ); ?>
                    </div>
                </div>
                <div class="form-group row" id="formstatus">
                    <label class="col-md-2 col-form-label">Status*</label>
                    <div class="col-md-10">
                        <?php
                        echo form_dropdown(
                            'status',
                            $status,
                            '1',
                            'id="status" class="form-control" required'
                        ); ?>
                    </div>
                </div>
                <div class="form-group row" id="formkode">
                    <label class="col-md-2 col-form-label">No. Urut Rapor*</label>
                    <div class="col-md-10">
                        <input type="number" id="kodeUrut" name="urutan_tampil" class="form-control">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="editIdMapel" name="id_mapel" class="form-control">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">
                    <svg class="icon-20 me-1" width="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg> Simpan Perubahan
                </button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<div class="modal fade" id="editDataMapelModal" tabindex="-1" role="dialog" aria-labelledby="editDataMapelModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editDataMapelModalLabel">Setting Mapel</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">
                    <svg class="icon-20 me-1" width="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg> Simpan Perubahan
                </button>
            </div>
        </div>
    </div>
</div>
<?= form_open('create', array('id' => 'hapus-kelompok')) ?>
<?= form_close() ?>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    var jsonkelompokMapel = JSON.parse(JSON.stringify(<?=json_encode($kelompok_mapel)?>));
    var kelompokMapel = Object.keys(jsonkelompokMapel).map(function (key) {
        return jsonkelompokMapel[key];
    });

    var save_label;
    var table;
    var tableKelompok;
    var tableSubKelompok;
    $(document).ready(function () {
        ajaxcsrf();
        tableKelompok = $("#tableKelompok").DataTable({
            initComplete: function () {
                var api = this.api();
                $("#tableMapel_filter input")
                    .off(".DT")
                    .on("keyup.DT", function (e) {
                        api.search(this.value).draw();
                    });
            },
            searching: false,
            oLanguage: {
                sProcessing:"loading..."
            },
            processing: true,
            serverSide: true,
            paging: false,
            ajax: {
                url: base_url +"datamapel/getdatakelompok",
                type:"POST"
            },
            columns: [
                {
                    data:"kategori",
                    className:"text-center",
                },
                {
                    data:"kode_kel_mapel",
                    className:"text-center",
                },
                {
                    data:"nama_kel_mapel",
                }
            ],
            columnDefs: [
                {
                    searchable: false,
                    targets: 3,
                    className:"text-center",
                    data: null,
                    render: function (data, type, row, meta) {
                        return `<div class="btn-group btn-group-sm">
									<a class="btn btn-warning btn-xs" data-bs-toggle="modal" data-bs-target="#editKelompokModal"
									 data-id="${row.id_kel_mapel}"
									 data-nama="${row.nama_kel_mapel}"
									  data-kode="${row.kode_kel_mapel}"
									  data-kategori="${row.kategori}">
										Edit
									</a>
                                    <button onclick="hapusKelompok(this)" class="btn btn-danger btn-xs deleteRecord"
									 data-id="${row.id_kel_mapel}"
									 data-utama="${row.id_parent}"
								  data-kode="${row.kode_kel_mapel}">
                                        Hapus
                                    </button>
								</div>`;
                    }
                }
            ],
            order: [[0,"asc"]],
            rowId: function (a) {
                return a;
            },
        });

        tableSubKelompok = $("#tableSubKelompok").DataTable({
            initComplete: function () {
                var api = this.api();
                $("#tableMapel_filter input")
                    .off(".DT")
                    .on("keyup.DT", function (e) {
                        api.search(this.value).draw();
                    });
            },
            searching: false,
            oLanguage: {
                sProcessing:"loading..."
            },
            processing: true,
            serverSide: true,
            paging: false,
            ajax: {
                url: base_url +"datamapel/getdatasubkelompok",
                type:"POST"
            },
            columns: [
                {
                    data:"kode_kel_mapel",
                    className:"text-center",
                },
                {
                    data:"nama_kel_mapel",
                },
                {
                    data:"kategori",
                    className:"text-center",
                }
            ],
            columnDefs: [
                {
                    searchable: false,
                    targets: 3,
                    className:"text-center",
                    data: null,
                    render: function (data, type, row, meta) {
                        return `<div class="btn-group btn-group-sm">
									<a class="btn btn-warning btn-xs" data-bs-toggle="modal" data-bs-target="#editSubKelompokModal"
									 data-id="${row.id_kel_mapel}"
									 data-nama="${row.nama_kel_mapel}"
									  data-kode="${row.kode_kel_mapel}"
									  data-utama="${row.id_parent}"
									  data-kategori="${row.kategori}">
									    Edit
									</a>
                                    <button onclick="hapusKelompok(this)" class="btn btn-danger btn-xs deleteRecord"
									 data-id="${row.id_kel_mapel}"
									 data-utama="${row.id_parent}"
								  data-kode="${row.kode_kel_mapel}">
                                        Hapus
                                    </button>
								</div>`;
                    }
                }
            ],
            order: [[0,"asc"]],
            rowId: function (a) {
                return a;
            },
        });

        var groupColumn = 4;
        table = $("#tableMapel").DataTable({
            initComplete: function () {
                var api = this.api();
                $("#tableMapel_filter input")
                    .off(".DT")
                    .on("keyup.DT", function (e) {
                        api.search(this.value).draw();
                    });
            },
            dom: "<'row'<'col-sm-6'l><'col-sm-6'f>>" + "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            oLanguage: {
                sProcessing:"loading..."
            },
            processing: true,
            serverSide: true,
            paging: false,
            ajax: {
                url: base_url +"datamapel/read",
                type:"POST"
            },
            columns: [
                {
                    data:"id_mapel",
                    className:"text-center",
                    orderable: false,
                    searchable: false
                },
                {
                    data:"urutan_tampil",
                    className:"text-center",
                    searchable: false
                },
                {
                    data:"nama_mapel",
                },
                {
                    data:"kode",
                    className:"text-center",
                },
                {
                    data:"kelompok",
                    className:"text-center",
                },
                {
                    data:"status",
                    className:"text-center",
                },
                {
                    data: "id_mapel",
                    className: "text-center",
                    orderable: false,
                    searchable: false
                }
            ],
            columnDefs: [
                //{"visible": false,"targets": groupColumn },
                {
                    targets: 0,
                    data: null,
                    render: function (data, type, row, meta) {
                        var disabled = row.deletable === '0' ? '' : '';
                        return `<div class="text-center">
									<input id="check${row.id_mapel}" name="checked[]" class="check ${disabled}" value="${row.id_mapel}" type="checkbox" ${disabled}>
								</div>`;
                    }
                },
                {
                    searchable: false,
                    targets: 6,
                    data: null,
                    render: function (data, type, row, meta) {
                        var disabled = row.deletable === '0' ? '' : '';
                        return `<div class="btn-group btn-group-sm d-flex justify-content-center">
									<a class="btn btn-xs btn-warning" data-bs-toggle="modal" data-bs-target="#editMapelModal"
									 data-deletable="${row.deletable}" data-status="${row.status}" data-id="${row.id_mapel}"
									  data-nama="${row.nama_mapel}" data-kode="${row.kode}" data-kelompok="${row.kelompok}"
									   data-urutan="${row.urutan_tampil}">
										Edit
									</a>
								</div>`;
                    }
                }
            ],
            order: [[ groupColumn, 'asc' ]],
            rowId: function (a) {
                return a;
            },
            drawCallback: function ( settings ) {
                var api = this.api();
                var rows = api.rows( {page:'current'} ).nodes();
                var last=null;

                api.column(groupColumn, {page:'current'} ).data().each( function ( group, i ) {
                    if ( last !== group ) {
                        $(rows).eq( i ).before(
                            '<tr class="group bg-gray"><td class="ps-2 text-bold" colspan="7">'+group+'</td></tr>'
                        );
                        last = group;
                    }
                } );
            },
            rowCallback: function (row, data, iDisplayIndex) {
                var st = data.status === '0' ?
                    '<span class="badge bg-danger text-white px-3 py-2 rounded-pill shadow-sm" style="font-size: 0.85rem;"><iconify-icon icon="lucide:x-circle" class="me-1"></iconify-icon>Nonaktif</span>' :
                    '<span class="badge bg-success text-white px-3 py-2 rounded-pill shadow-sm" style="font-size: 0.85rem;"><iconify-icon icon="lucide:check-circle" class="me-1"></iconify-icon>Aktif</span>';
                $("td:eq(5)", row).html(st);
            }
        });

        table
            .buttons()
            .container()
            .appendTo("#tableMapel_wrapper .col-md-6:eq(1)");
        $('#id_parent_sub').on('change', function () {
            var indexKelompok = kelompokMapel.map(function (kel) { return kel.id_kel_mapel; }).indexOf($(this).val());
            var kategori = kelompokMapel[indexKelompok].kategori;
            $('#kategori_sub').val(kategori);
        });

        $("#myModal").on("shown.modal.bs", function () {
            $(':input[name="banyak"]').select();
        });

        $('#editKelompokModal').on('show.bs.modal', function (e) {
            var rel = $(e.relatedTarget);
            var id = rel.data('id') || '';
            var nama = rel.data('nama') || '';
            var kode = rel.data('kode') || '';
            var kat = rel.data('kategori') || $('#kategori option:first').val();

            $('#createnamakel').val(nama);
            $('#createkodekel').val(kode);
            $('#id_kel_mapel').val(id);
            $('#kategori').val(kat);
        });

        $('#editSubKelompokModal').on('show.bs.modal', function (e) {
            var rel = $(e.relatedTarget);
            var id = rel.data('id') || '';
            var nama = rel.data('nama') || '';
            var kode = rel.data('kode') || '';
            var utama = rel.data('utama') || $('#id_parent_sub option:first').val();
            var kat = rel.data('kategori') || '';

            $('#createnamasub').val(nama);
            $('#createkodesub').val(kode);
            $('#id_kel_sub').val(id);
            $('#id_parent_sub').val(utama).trigger('change');
            if (kat) {
                $('#kategori_sub').val(kat);
            }
        });

        $('#create-kelompok').on('submit', function (e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            var $btn = $(this).find('button[type="submit"]');
            var originalBtnHtml = $btn.html();
            $btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span> Menyimpan...');

            $.ajax({
                url: base_url + "datamapel/addkelompokmapel",
                type: "POST",
                dataType: "JSON",
                data: $(this).serialize(),
                success: function (data) {
                    $btn.prop('disabled', false).html(originalBtnHtml);
                    var modalEl = document.getElementById('editKelompokModal');
                    if (modalEl) {
                        var modalInstance = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
                        modalInstance.hide();
                    } else {
                        $('#editKelompokModal').modal('hide');
                    }
                    if (typeof showSuccessToast === 'function') {
                        showSuccessToast('Data berhasil disimpan.');
                    }
                    setTimeout(function () {
                        window.location.reload(true);
                    }, 800);
                },
                error: function (xhr, status, error) {
                    $btn.prop('disabled', false).html(originalBtnHtml);
                    if (typeof showDangerToast === 'function') {
                        showDangerToast("Gagal menyimpan data");
                    }
                }
            });
            return false;
        });

        $('#create-sub-kelompok').on('submit', function (e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            var $btn = $(this).find('button[type="submit"]');
            var originalBtnHtml = $btn.html();
            $btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span> Menyimpan...');

            $.ajax({
                url: base_url + "datamapel/addkelompokmapel",
                type: "POST",
                dataType: "JSON",
                data: $(this).serialize(),
                success: function (data) {
                    $btn.prop('disabled', false).html(originalBtnHtml);
                    var modalEl = document.getElementById('editSubKelompokModal');
                    if (modalEl) {
                        var modalInstance = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
                        modalInstance.hide();
                    } else {
                        $('#editSubKelompokModal').modal('hide');
                    }
                    if (typeof showSuccessToast === 'function') {
                        showSuccessToast('Data berhasil disimpan.');
                    }
                    setTimeout(function () {
                        window.location.reload(true);
                    }, 800);
                },
                error: function (xhr, status, error) {
                    $btn.prop('disabled', false).html(originalBtnHtml);
                    if (typeof showDangerToast === 'function') {
                        showDangerToast("Gagal menyimpan data");
                    }
                }
            });
            return false;
        });

        $(".select_all").on("click", function () {
            if (this.checked) {
                $(".check").each(function () {
                    this.checked = true;
                    $(".select_all").prop("checked", true);
                    $('#hapusterpilih').removeClass('d-none');
                });
            } else {
                $(".check").each(function () {
                    this.checked = false;
                    $(".select_all").prop("checked", false);
                    $('#hapusterpilih').addClass('d-none');
                });
            }
        });

        $("#tableMapel tbody").on("click","tr .check", function () {
            var check = $("#tableMapel tbody tr .check").length;
            var checked = $("#tableMapel tbody tr .check:checked").length;
            if (check === checked) {
                $(".select_all").prop("checked", true);
            } else {
                $(".select_all").prop("checked", false);
            }

            if (checked === 0) {
                $('#hapusterpilih').addClass('d-none');
            } else {
                $('#hapusterpilih').removeClass('d-none');
            }
        });

        $('#create').on('submit', function (e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            var $btn = $(this).find('button[type="submit"]');
            var originalBtnHtml = $btn.html();
            $btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span> Menyimpan...');

            $.ajax({
                url: base_url + "datamapel/create",
                type: "POST",
                dataType: "JSON",
                data: $(this).serialize(),
                success: function (data) {
                    $btn.prop('disabled', false).html(originalBtnHtml);
                    var modalEl = document.getElementById('createMapelModal');
                    if (modalEl) {
                        var modalInstance = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
                        modalInstance.hide();
                    } else {
                        $('#createMapelModal').modal('hide');
                    }
                    if (typeof showSuccessToast === 'function') {
                        showSuccessToast('Data berhasil disimpan.');
                    }
                    if (typeof table !== 'undefined' && table.ajax) {
                        table.ajax.reload(null, false);
                    }
                    $('#create')[0].reset();
                },
                error: function (xhr, status, error) {
                    $btn.prop('disabled', false).html(originalBtnHtml);
                    var modalEl = document.getElementById('createMapelModal');
                    if (modalEl) {
                        var modalInstance = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
                        modalInstance.hide();
                    } else {
                        $('#createMapelModal').modal('hide');
                    }
                    if (typeof showDangerToast === 'function') {
                        showDangerToast("Gagal menyimpan data");
                    }
                }
            });
            return false;
        });

        $('#editMapelModal').on('show.bs.modal', function (e) {
            var id = $(e.relatedTarget).data('id');
            var nama = $(e.relatedTarget).data('nama');
            var kode = $(e.relatedTarget).data('kode');
            var kelompok = $(e.relatedTarget).data('kelompok');
            var status = $(e.relatedTarget).data('status');
            var deletable = $(e.relatedTarget).data('deletable');
            var urut = $(e.relatedTarget).data('urutan');

            $('#namaEdit').val(nama);
            $('#kodeEdit').val(kode);
            $('#editIdMapel').val(id);
            $('#kelompok').val(kelompok);
            $('#status').val(status);
            $('#kodeUrut').val(urut);
        });

        $('#update').on('submit', function (e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            var $btn = $(this).find('button[type="submit"]');
            var originalBtnHtml = $btn.html();
            $btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span> Menyimpan...');

            $.ajax({
                url: base_url + "datamapel/update",
                data: $(this).serialize(),
                method: 'POST',
                dataType: "JSON",
                success: function (data) {
                    $btn.prop('disabled', false).html(originalBtnHtml);
                    var modalEl = document.getElementById('editMapelModal');
                    if (modalEl) {
                        var modalInstance = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
                        modalInstance.hide();
                    } else {
                        $('#editMapelModal').modal('hide');
                    }

                    if (typeof showSuccessToast === 'function') {
                        showSuccessToast('Data berhasil diupdate.');
                    } else if (typeof swal !== 'undefined') {
                        swal.fire({
                            title: "Berhasil",
                            text: "Data berhasil diupdate.",
                            icon: "success",
                            timer: 1500,
                            showConfirmButton: false
                        });
                    }
                    if (typeof table !== 'undefined' && table.ajax) {
                        table.ajax.reload(null, false);
                    }
                },
                error: function (xhr, status, error) {
                    $btn.prop('disabled', false).html(originalBtnHtml);
                    var modalEl = document.getElementById('editMapelModal');
                    if (modalEl) {
                        var modalInstance = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
                        modalInstance.hide();
                    } else {
                        $('#editMapelModal').modal('hide');
                    }
                    if (typeof showDangerToast === 'function') {
                        showDangerToast('Gagal mengupdate data.');
                    } else if (typeof swal !== 'undefined') {
                        swal.fire({
                            title: "Gagal",
                            text: "Gagal mengupdate data.",
                            icon: "error"
                        });
                    }
                    console.error("Update error:", xhr, status, error);
                }
            });
            return false;
        });

        $("#bulk").on("submit", function (e) {
            if ($(this).attr("action") == base_url +"datamapel/delete") {
                e.preventDefault();
                e.stopImmediatePropagation();

                $.ajax({
                    url: $(this).attr("action"),
                    data: $(this).serialize(),
                    type:"POST",
                    success: function (respon) {
                        console.log('tables', respon);
                        if (respon.status) {
                            swal.fire({
                                title:"Berhasil",
                                text: respon.total +" data berhasil dihapus",
                                icon:"success"
                            });
                        } else {
                            swal.fire({
                                title:"Gagal",
                                html: respon.total,
                                icon:"error"
                            });
                        }
                        reload_ajax();
                    },
                    error: function () {
                        swal.fire({
                            title:"Gagal",
                            text:"Ada data yang sedang digunakan",
                            icon:"error"
                        });
                    }
                });
            }
        });
    });

    function aktifkan(e) {
        var id = $(e).data('id');
        console.log(id);

        $.ajax({
            url: base_url +"datamapel/aktifkan/"+id,
            type:"GET",
            success: function (data) {
                console.log("result", data);
                window.location.href = base_url + 'datamapel'
            }, error: function (xhr, status, error) {
                $('#mapelNonAktif').modal('hide');
                $('#mapelNonAktif').on('hidden', function () {
                    $(this).data('modal', null);  // destroys modal
                });
                showDangerToast();
            }
        });
    }

    function dismissEdit() {
        var count = $('#tableMapel tr').length;
        console.log("size","-->"+count);
        for (var i = 0; i<count; i++) {
            var inputs = document.getElementById('check'+i);
            if (inputs!=null) {
                inputs.checked = false;
                console.log("id","-->"+'check'+i);
            }
        }
    }

    function deleteItem(id) {
        dismissEdit();
        var checkBox = document.getElementById("check" + id);
        checkBox.checked = true;
        bulk_delete("check" + id);
    }

    function bulk_delete(id) {
        if ($("#tableMapel tbody tr .check:checked").length == 0) {
            swal.fire({
                title:"Gagal",
                text:"Tidak ada data yang dipilih",
                icon:"error"
            });
        } else {
            $("#bulk").attr("action", base_url +"datamapel/delete");
            swal.fire({
                title:"Anda yakin?",
                text:"Data akan dihapus!",
                icon:"warning",
                showCancelButton: true,
                confirmButtonColor:"#3085d6",
                cancelButtonColor:"#d33",
                confirmButtonText:"Hapus!"
            }).then(result => {
                if (result.value) {
                    $("#bulk").submit();
                } else {
                    var inputs = document.getElementById(id);
                    inputs.checked = false;
                }
            });
        }
    }

    function bulk_edit() {
        if ($("#tableMapel tbody tr .check:checked").length == 0) {
            swal.fire({
                title:"Gagal",
                text:"Tidak ada data yang dipilih",
                icon:"error"
            });
        } else {
            $("#bulk").attr("action", base_url +"datamapel/edit");
            $("#bulk").submit();
        }
    }

    function hapusKelompok(e) {
        var id = $(e).data('id');
        var kode = $(e).data('kode');
        var parent = $(e).data('utama');

        var dataPost = $('#hapus-kelompok').serialize() + '&id_kel='+id+'&id_parent='+parent+'&kode='+kode;
        console.log(dataPost);

        swal.fire({
            title:"Anda yakin?",
            text:"Data Kelompok Mapel akan dihapus!",
            icon:"warning",
            showCancelButton: true,
            confirmButtonColor:"#3085d6",
            cancelButtonColor:"#d33",
            confirmButtonText:"Hapus!"
        }).then(result => {
            if (result.value) {
                $.ajax({
                    url: base_url +"datamapel/hapuskelompok",
                    type:"POST",
                    data: dataPost,
                    success: function (data) {
                        console.log("result", data);
                        if (data.status) {
                            swal.fire({
                                title:"Berhasil",
                                text:"Data berhasil dihapus",
                                icon:"success"
                            }).then(result => {
                                if (result.value) {
                                    tableKelompok.ajax.reload();
                                    tableSubKelompok.ajax.reload();
                                }
                            });
                        } else {
                            swal.fire({
                                title:"Gagal",
                                html: data.message,
                                icon:"error"
                            });
                        }
                    }, error: function (xhr, status, error) {
                        showDangerToast();
                    }
                });
            }
        });
    }
</script>
<?= $this->endSection() ?>
