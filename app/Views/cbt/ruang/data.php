<?= $this->extend('layout/dashboard_template_bs5') ?>

<?= $this->section('content') ?>
<div class="d-contents">
    <style>
        /* Filter Section */
        .filter-container {
            background-color: #e9ecef;
            border-radius: 6px;
            padding: 15px 20px;
            margin-bottom: 20px;
            box-shadow: inset 0 1px 2px rgba(0,0,0,0.05);
        }
        .filter-label {
            font-weight: 600;
            color: #555;
            margin-bottom: 5px;
            display: flex;
            align-items: center;
            font-size: 0.9rem;
        }
        .filter-label.cari-label i {
            color: #00e676;
        }
        .filter-container .form-control {
            border-radius: 4px;
            border: 1px solid #ced4da;
            box-shadow: none;
            padding: 6px 12px;
        }
        
        /* Toolbar */
        .toolbar-container {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 15px;
        }
        .btn-aksi {
            background-color: #ff8a80;
            color: #fff;
            border-radius: 6px;
            border: none;
            font-weight: 600;
            padding: 6px 16px;
            font-size: 0.9rem;
        }
        .btn-aksi:hover {
            background-color: #ff5252;
            color: #fff;
        }
        
        /* Hide Default DataTables Search and Toolbar */
        .dataTables_filter, div.toolbar {
            display: none !important;
        }
    </style>
    <div class="card mb-4">
      <div class="card-body">
        <div class="d-flex align-items-center">
          <div class="me-3 flex-shrink-0">
            <div class="rounded-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 60px; height: 60px; background: linear-gradient(135deg, #06b6d4 0%, #0e7490 100%); color: #ffffff;">
              <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M14 22v-4a2 2 0 0 0-2-2v0a2 2 0 0 0-2 2v4"></path>
                <path d="M18 22V6l-6-4-6 4v16"></path>
                <path d="M6 12h12"></path>
                <path d="M6 16h12"></path>
              </svg>
            </div>
          </div>
          <div>
            <h4 class="card-title mb-1 fw-bold d-flex align-items-center">
                <?= $judul ?>
            </h4>
            <p class="text-muted mb-0" style="font-size: 0.9rem;">Pengelolaan data ruang laboratorium komputasi, kelas ujian, serta kapasitas tempat duduk tes.</p>
          </div>
        </div>
      </div>
    </div>
    
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <div class="header-title">
            <h4 class="card-title d-flex align-items-center">
                <svg class="icon-24 text-primary me-2" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> <?= isset($subjudul) ? $subjudul : $judul ?>
            </h4>
          </div>
          <div class="card-tools d-flex gap-2">
                        <button type="button" onclick="reload_ajax()" class="btn btn-sm btn-default">
                            <i class="fa fa-sync"></i> <span class="d-none d-sm-inline-block ml-1">Reload</span>
                        </button>
                        <button type="button" data-bs-toggle="modal" data-bs-target="#createRuangModal"
                                class="btn btn-sm btn-primary"><i
                                    class="fas fa-plus"></i><span class="d-none d-sm-inline-block ml-1">Tambah Ruang Ujian</span>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <?= form_open('cbtruang/delete', ['id' => 'bulk']) ?>
                                        <!-- Custom Filter & Search UI -->
                    <div class="filter-container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="filter-label cari-label"><i class="fas fa-search"></i> Cari</div>
                                <div class="d-flex">
                                    <input id="custom-search-ruang" type="text" class="form-control form-control-sm" placeholder="Cari data...">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Custom Toolbar Aksi -->
                    <div class="toolbar-container">
                        <div class="dropdown">
                            <button id="custom-btn-aksi-ruang" class="btn btn-aksi shadow-sm" type="button" onclick="bulk_delete()" disabled="disabled">
                                <i class="fas fa-trash me-1"></i> Hapus Terpilih
                            </button>
                        </div>
                    </div>
                    
                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            // Wire up custom search
                            $('#custom-search-ruang').on('keyup', function() {
                                if (typeof table !== 'undefined') {
                                    table.search(this.value).draw();
                                }
                            });
                            
                            // Override the bulk delete check event listener to enable/disable our button
                            $(document).ajaxComplete(function() {
                                $('.select_all, .check').on('change', function() {
                                    setTimeout(function() {
                                        var checked = $("#ruang tbody tr .check:checked").length;
                                        if (checked === 0) {
                                            $('#custom-btn-aksi-ruang').prop('disabled', 'disabled');
                                        } else {
                                            $('#custom-btn-aksi-ruang').removeAttr('disabled');
                                        }
                                    }, 100);
                                });
                            });
                        });
                    </script>
                    
                    <div class="table-responsive">
                        <table id="ruang" class="w-100 table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th width="40" class="align-middle text-center p-0">
                                    <input class="select_all" type="checkbox">
                                </th>
                                <th width="40" class="align-middle text-center p-0">No.</th>
                                <th>Kelompok/Ruang Ujian</th>
                                <th>Kode Ruang</th>
                                <th>Jum. Sesi</th>
                                <th width="100" class="align-middle text-center p-0">Aksi</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    <?= form_open('cbtruang/add', ['id' => 'create']) ?>
<div class="modal fade" id="createRuangModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Tambah Ruang Ujian</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label for="nama_ruang" class="col-md-4 col-form-label">Ruang Ujian*</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="nama_ruang" placeholder="Nama Ruang" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="kode_ruang" class="col-md-4 col-form-label">Kode Ruang*</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="kode_ruang" placeholder="Kode Ruang Ujian"
                               required>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="reset" class="btn bg-warning text-white">
                    <i class="fa fa-sync mr-1"></i> Reset
                </button>
                <button type="submit" class="btn btn-primary shadow-sm"><svg class="icon-20 me-1" width="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg><span class="d-none d-sm-inline-block ms-1">Simpan</span></button>
            </div>
        </div>
    </div>
</div>
<?= form_close() ?>

<?= form_open('cbtruang/update', ['id' => 'update']) ?>
<div class="modal fade" id="editRuangModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Ruang Ujian</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label for="namaEdit" class="col-md-4 col-form-label">Ruang Ujian*</label>
                    <div class="col-md-8">
                        <input type="text" id="namaEdit" class="form-control" name="nama_ruang" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="kodeEdit" class="col-md-4 col-form-label">Kode Ruang*</label>
                    <div class="col-md-8">
                        <input type="text" id="kodeEdit" class="form-control" name="kode_ruang" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="editIdRuang" name="id_ruang">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary"><svg class="icon-20 me-1" width="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg><span class="d-none d-sm-inline-block ms-1">Simpan</span></button>
            </div>
        </div>
    </div>
</div>
<?= form_close() ?>

<script>

</script>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="<?= base_url('assets/app/js/cbt/ruang/crud.js?v=<?php echo time(); ?>') ?>"></script>

<?= $this->endSection() ?>
