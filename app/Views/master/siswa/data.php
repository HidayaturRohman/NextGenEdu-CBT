<?= $this->extend('layout/dashboard_template_bs5') ?>
<?= $this->section('content') ?>

            <style>
        /* Keep only functional styles, remove layout hacks */
        .profil-img {
            border-radius: 8px;
            object-fit: cover;
            width: 50px;
            height: 50px;
        }
        .siswa-nama {
            font-weight: 700;
            color: #2c3e50;
            font-size: 0.95rem;
            margin-bottom: 5px;
        }
        .badge-kelas { background-color: #e3f2fd; color: #1976d2; }
        .badge-agama { background-color: #e0f7fa; color: #00838f; }
        .badge-gender { background-color: #fff3e0; color: #f57c00; }
        .badge-status { background-color: #e8f5e9; color: #2e7d32; }
        .badge-custom {
            border-radius: 20px;
            padding: 3px 8px;
            font-size: 0.7rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            margin-right: 5px;
            margin-bottom: 5px;
            border: 1px solid rgba(0,0,0,0.05);
        }
        .badge-custom i { margin-right: 4px; }
        
        /* Data Cards (NIS/NISN/Login) */
        .data-card {
            background-color: #f1f3f5;
            border-radius: 6px;
            text-align: center;
            font-size: 0.8rem;
            color: #495057;
            display: inline-flex;
            flex-direction: column;
            min-width: 110px;
            border: 1px solid #e9ecef;
        }
        .data-card-item {
            padding: 4px 8px;
        }
        .data-card-divider {
            height: 1px;
            background-color: #dee2e6;
            width: 90%;
            margin: 0 auto;
        }
        .data-card-icon {
            color: #448aff;
            margin-right: 5px;
        }
        .data-card-icon.key { color: #f57c00; }
    
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
        .filter-label i {
            margin-right: 6px;
            color: #448aff;
        }
        .filter-label.cari-label i {
            color: #00e676;
        }
        .filter-container .form-control, .filter-container .custom-select {
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
        .sort-container {
            display: flex;
            align-items: center;
        }
        .sort-label {
            color: #888;
            margin-right: 10px;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
        }
        .sort-label i {
            margin-right: 5px;
        }
    </style>
<div class="row">
  <div class="col-sm-12">
    <div class="card mb-4">
      <div class="card-body">
        <div class="d-flex align-items-center justify-content-between w-100">
            <div class="d-flex align-items-center">
              <div class="me-3 flex-shrink-0">
                <div class="rounded-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 60px; height: 60px; background: linear-gradient(135deg, #6366f1 0%, #4338ca 100%); color: #ffffff;">
                  <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                  </svg>
                </div>
              </div>
              <div>
                <h4 class="card-title mb-1 fw-bold d-flex align-items-center">
                    <?= $judul ?>
                </h4>
                <p class="text-muted mb-0" style="font-size: 0.9rem;">Pengelolaan data induk siswa, NISN, status keaktifan, akun login peserta didik, dan impor data.</p>
              </div>
            </div>
            <div>
            </div>
        </div>
      </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card card-default mb-4">
                <div class="card-header">
                    <div class="card-title d-flex align-items-center">
                        <iconify-icon icon="lucide:users" class="me-2 text-primary" style="font-size: 1.4rem;"></iconify-icon>
                        <span style="font-size: 1.25rem; font-weight: 700; color: #232D42;"><?= $subjudul ?></span>
                    </div>
                    <div class="card-tools d-flex align-items-center gap-1 flex-wrap">
                        <button type="button" class="btn btn-sm btn-outline-primary" onclick="cetakKartuSiswa(false)">
                            <i class="fas fa-print me-1"></i> <span class="d-none d-sm-inline-block">Cetak Semua Siswa</span>
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-success" onclick="downloadDataSiswa(false)">
                            <i class="fas fa-download me-1"></i> <span class="d-none d-sm-inline-block">Download Data</span>
                        </button>
                        <button type="button" class="btn btn-sm btn-default" onclick="loadSiswa()">
                            <i class="fa fa-sync"></i> <span class="d-none d-sm-inline-block ms-1">Reload</span>
                        </button>
                        <button type="button" data-bs-toggle="modal" data-bs-target="#createSiswaModal" class="btn btn-sm bg-gradient-primary">
                            <i class="fa fa-plus"></i> <span class="d-none d-sm-inline-block ms-1">Tambah Siswa</span>
                        </button>
                        <a href="<?= base_url('datasiswa/add') ?>" class="btn btn-sm bg-gradient-success">
                            <i class="fas fa-upload"></i> <span class="d-none d-sm-inline-block ms-1">Import</span>
                        </a>
                        <a href="<?= base_url('datasiswa/update') ?>" class="btn btn-sm bg-gradient-info text-white">
                            <i class="fas fa-database"></i> <span class="d-none d-sm-inline-block ms-1">Update Data</span>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="dataTables_wrapper dt-bootstrap4 no-footer">
                        
                                                <!-- Filter Section -->
                        <div class="filter-container">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="filter-label"><i class="fas fa-filter"></i> Filter</div>
                                    <div class="d-flex">
                                        <select id="users-filter" class="form-control form-control-sm mr-2 w-auto">
                                            <option value="0">Semua</option>
                                            <option value="1">Aktif</option>
                                            <option value="2">Nonaktif</option>
                                            <option value="3">Kelas</option>
                                        </select>
                                        <select id="kelas-filter" class="form-control form-control-sm w-auto" disabled style="display: none;">
                                            <?php foreach ($kelass as $k => $v): ?>
                                                <option value="<?= $k ?>"><?= $v ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="filter-label cari-label"><i class="fas fa-search"></i> Cari</div>
                                    <div class="d-flex">
                                        <input id="input-search" type="text" class="form-control form-control-sm" placeholder="Cari berdasarkan nama, nis, nisn, username">
                                        <button id="btn-search" class="btn btn-sm btn-light ml-2 d-none" onclick="applySearch()"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Toolbar Aksi & Urutkan -->
                        <div class="toolbar-container">
                            <div class="dropdown">
                                <button id="dropdown-btn" class="btn btn-aksi dropdown-toggle shadow-sm" type="button" data-toggle="dropdown" aria-expanded="false" disabled="disabled">
                                    <i class="fas fa-tools me-1"></i> Aksi
                                </button>
                                <div id="dropdown-action" class="dropdown-menu shadow">
                                    <a class="dropdown-item" id="cetak_kartu" href="#"><i class="fas fa-print me-2 text-primary"></i>Cetak Kartu Terpilih</a>
                                    <a class="dropdown-item" id="download_terpilih" href="#"><i class="fas fa-download me-2 text-success"></i>Download Data Terpilih</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" id="pindah" href="#"><i class="fas fa-share me-2 text-warning"></i>Set sebagai PINDAH</a>
                                    <a class="dropdown-item" id="keluar" href="#"><i class="fas fa-sign-out-alt me-2 text-danger"></i>Set sebagai KELUAR</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" id="hapus" href="#"><i class="fas fa-trash me-2 text-danger"></i>HAPUS</a>
                                </div>
                            </div>
                            
                            <div class="sort-container">
                                <span class="sort-label"><i class="fas fa-sort-amount-down"></i> Urutkan:</span>
                                <select id="users_length" class="form-control form-control-sm" style="width: 120px; border-radius: 4px;">
                                    <option value="10">Nama</option>
                                    <option value="25">25 Baris</option>
                                    <option value="50">50 Baris</option>
                                    <option value="100">100 Baris</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 mb-3">
                                <?= form_open('datasiswa/delete', array('id' => 'bulk')); ?>
                                <div class="table-responsive">
                                    <table id="table-siswa" class="table table-md table-striped table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th width="40" class="text-center align-middle">
                                                <input type="checkbox" class="select_all">
                                            </th>
                                            <th width="50" class="text-center align-middle">No.</th>
                                            <th class="align-middle">Nama & Kelas</th>
                                            <th class="text-center align-middle">NIS & NISN</th>
                                            <th class="text-center align-middle">Login</th>
                                            <th class="text-center align-middle">Aksi</th>
                                        </tr>
                                        </thead>
                                        <tbody id="table-body">
                                        </tbody>
                                    </table>
                                </div>
                                <?= form_close() ?>
                            </div>
                            <div class="col-12 d-flex justify-content-between align-items-center mt-2">
                                <div id="total-entri" class="text-muted" style="font-size: 0.9rem;"></div>
                                <nav aria-label="Page navigation">
                                    <ul class="pagination pagination-sm mb-0" id="pagination"></ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div><div class="overlay" id="loading">
                    <div class="spinner-grow"></div>
                </div>
            </div>
        </div>
    </section>
</div>

<?= form_open('', array('id' => 'formsiswa')); ?>
<div class="modal fade" id="createSiswaModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Tambah Siswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-md-4 col-sm-offset-4">
                        <label for="nama_siswa">Nama Siswa :</label>
                    </div>
                    <div class="col-md-8 col-sm-offset-8">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input id="nama_siswa" type="text" class="form-control" name="nama"
                                   placeholder="Nama Siswa" required>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4 col-sm-offset-4">
                        <label for="nis">NIS :</label>
                    </div>
                    <div class="col-md-8 col-sm-offset-8">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                            </div>
                            <input type="number" id="nis" class="form-control" name="nis" placeholder="NIS" required>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4 col-sm-offset-4">
                        <label for="nisn">NISN :</label>
                    </div>
                    <div class="col-md-8 col-sm-offset-8">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                            </div>
                            <input type="number" id="nisn" class="form-control" name="nisn" placeholder="NISN" required>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4 col-sm-offset-4">
                        <label for="jenis_kelamin" class="control-label">Jenis Kelamin :</label>
                    </div>
                    <div class="col-md-8 col-sm-offset-8">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-venus-mars"></i></span>
                            </div>
                            <select class="form-control" id="jenis_kelamin" data-placeholder="Jenis Kelamin"
                                    name="jenis_kelamin">
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4 col-sm-offset-4">
                        <label for="jenis_kelamin" class="control-label">Agama :</label>
                    </div>
                    <div class="col-md-8 col-sm-offset-8">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-user"></i></span>
                            </div>
                            <?php
                            $arrAgama = ["Islam","Kristen","Katolik","Protestan","Hindu","Budha","Konghucu","lainnya"];
                            ?>
                            <select class="form-control" id="agama" data-placeholder="Pilih Agama yang dianut" name="agama">
                                <option value="Pilih Agama yang dianut">Pilih Agama yang dianut</option>
                                <?php foreach ($arrAgama as $agama) : ?>
                                    <option value="<?= $agama ?>"><?= $agama ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4 col-sm-offset-4">
                        <label for="id_kelas_modal" class="control-label">Kelas Saat Ini :</label>
                    </div>
                    <div class="col-md-8 col-sm-offset-8">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-school"></i></span>
                            </div>
                            <select class="form-control" id="id_kelas_modal" name="id_kelas">
                                <option value="">-- Pilih Kelas Saat Ini (Opsional) --</option>
                                <?php foreach ($kelass as $k => $v) : ?>
                                    <option value="<?= $k ?>"><?= $v ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <small class="text-muted">Pilih kelas agar siswa langsung terdaftar di kelas TP aktif</small>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4 col-sm-offset-4">
                        <label for="kelas_awal">Kelas Awal :</label>
                    </div>
                    <div class="col-md-8 col-sm-offset-8">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-graduation-cap"></i></span>
                            </div>
                            <?php
                            if ($setting->jenjang == 1) {
                                $opsis ['1'] = '1';
                                $opsis ['2'] = '2';
                                $opsis ['3'] = '3';
                                $opsis ['4'] = '4';
                                $opsis ['5'] = '5';
                                $opsis ['6'] = '6';
                            } elseif ($setting->jenjang == 2) {
                                $opsis ['7'] = '7';
                                $opsis ['8'] = '8';
                                $opsis ['9'] = '9';
                            } else {
                                $opsis ['10'] = '10';
                                $opsis ['11'] = '11';
                                $opsis ['12'] = '12';
                            };
                            ?>
                            <select class="form-control" id="kelas_awal" data-placeholder="Pilih Kelas"
                                    name="kelas_awal">
                                <option value="">Pilih Kelas Awal</option>
                                <?php foreach ($opsis as $kelas) : ?>
                                    <option value="<?= $kelas ?>"><?= $kelas ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4 col-sm-offset-4">
                        <label for="tahun_masuk">Tanggal Diterima :</label>
                    </div>
                    <div class="col-md-8 col-sm-offset-8">
                        <div class="input-group">
                            <div class="input-group-prepend">
								<span class="input-group-text">
									<i class="fas fa-calendar-alt"></i></span>
                            </div>
                            <input type="text" name="tahun_masuk" id="tahunmasuk" class="form-control"
                                   autocomplete="off" placeholder="Tgl/Tahun Masuk" required>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4 col-sm-offset-4">
                        <label for="username">Username :</label>
                    </div>
                    <div class="col-md-8 col-sm-offset-8">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input id="username" type="text" class="form-control" name="username" placeholder="Username"
                                   required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-sm-offset-4">
                        <label for="password">Password :</label>
                    </div>
                    <div class="col-md-8 col-sm-offset-8">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                            </div>
                            <input id="password" class="form-control" name="password" placeholder="Password" required>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="reset" class="btn bg-warning text-white">
                    <i class="fa fa-sync me-1"></i> Reset
                </button>
                <button type="submit" class="btn btn-primary">
                    <svg class="icon-20 me-1" width="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg> Simpan
                </button>
            </div>
        </div>
    </div>
</div>
<?= form_close() ?>

<?= form_open('', array('id' => 'pager')); ?>
<input type="hidden" id="pager-page" name="page" value="1">
<input type="hidden" id="pager-limit" name="limit" value="10">
<?= form_close() ?>


<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="<?=base_url()?>/assets/app/js/jquery.twbsPagination.js" type="text/javascript"></script>
<script>
    let currentPage = 1;
    let perPage = 10;
    let $pagination, defaultOpts, query, actionBulk;

    $(document).ready(function () {
        ajaxcsrf();
        $pagination = $('#pagination');
        defaultOpts = {
            visiblePages: 5,
            initiateStartPageClick: false,
            onPageClick: function (event, page) {
                console.info(page + ' (from options)');
                currentPage = page;
                loadSiswa();
            }
        };
        $pagination.twbsPagination(defaultOpts);

        $('#users_length').change(function () {
            $('#pager-limit').val($(this).val());
            perPage = $(this).val();
            currentPage = 1;
            loadSiswa();
        });

        $('#users-filter').change(function () {
            if ($(this).val() ==="3") {
                $('#kelas-filter').removeAttr('disabled').show();
            } else {
                $('#kelas-filter').attr('disabled', 'disabled').hide();
                currentPage = 1;
                loadSiswa();
            }
        });

        $('#kelas-filter').prepend('<option value="" selected>Kelas</option>');
        $('#kelas-filter').change(function () {
            currentPage = 1;
            loadSiswa();
        });

        $('#input-search').on('change keyup', function () {
            var val = $(this).val();
            query = val ==="" ? null : val; applySearch();
            $('#btn-clear').attr('disabled', query == null)
            $('#btn-search').attr('disabled', query == null)
        });

        $('#btn-clear').on('click', function () {
            query = null;
            currentPage = 1;
            $(this).attr('disabled', query == null);
            $('#btn-search').attr('disabled', query == null);
            loadSiswa();
        });

        $(".select_all").on("click", function () {
            if (this.checked) {
                $(".check").each(function () {
                    this.checked = true;
                    $(".select_all").prop("checked", true);
                    $('#hapusterpilih').removeAttr('disabled');
                    $('#dropdown-btn').removeAttr('disabled');
                });
            } else {
                $(".check").each(function () {
                    this.checked = false;
                    $(".select_all").prop("checked", false);
                    $('#hapusterpilih').attr('disabled', 'disabled');
                    $('#dropdown-btn').attr('disabled', 'disabled');
                });
            }
        });

        $("#table-siswa tbody").on("click","tr .check", function () {
            var check = $("#table-siswa tbody tr .check").length;
            var checked = $("#table-siswa tbody tr .check:checked").length;
            if (check === checked) {
                $(".select_all").prop("checked", true);
            } else {
                $(".select_all").prop("checked", false);
            }

            if (checked === 0) {
                $('#hapusterpilih').attr('disabled', 'disabled');
                $('#dropdown-btn').attr('disabled', 'disabled');
            } else {
                $('#hapusterpilih').removeAttr('disabled');
                $('#dropdown-btn').removeAttr('disabled');
            }
        });

        $("#bulk").on("submit", function (e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            //console.log($(this).serialize() + '&aksi=' +actionBulk)
            $.ajax({
                url: $(this).attr("action"),
                data: $(this).serialize() + '&aksi=' +actionBulk,
                type:"POST",
                success: function (respon) {
                    console.log('res', respon)
                    if (respon.status) {
                        $(".select_all").prop("checked", false);
                        $('#hapusterpilih').attr('disabled', 'disabled');
                        $('#dropdown-btn').attr('disabled', 'disabled');
                        swal.fire({
                            title:"Berhasil",
                            text: respon.total +"" + respon.message,
                            icon:"success"
                        });
                        loadSiswa();
                    } else {
                        swal.fire({
                            title:"Gagal",
                            html: respon.message,
                            icon:"error"
                        });
                    }
                },
                error: function () {
                    swal.fire({
                        title:"Gagal",
                        text:"Ada data yang sedang digunakan",
                        icon:"error"
                    });
                }
            });
        });

        $('#tahunmasuk').datetimepicker({
            icons:
                {
                    next: 'fa fa-angle-right',
                    previous: 'fa fa-angle-left'
                },
            timepicker: false,
            format: 'Y-m-d',
            //disabledWeekDays: [0],
            widgetPositioning: {
                horizontal: 'left',
                vertical: 'bottom'
            }
        });

        $('#formsiswa').on('submit', function (e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            var form = $(this);
            var btn = form.find('button[type="submit"]');
            btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');

            $.ajax({
                url: base_url + 'datasiswa/create',
                data: form.serialize(),
                dataType: 'JSON',
                type: 'POST',
                success: function (response) {
                    btn.prop('disabled', false).html('<svg class="icon-20 me-1" width="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg> Simpan');
                    $('#createSiswaModal').modal('hide');

                    if (response.insert || response.status) {
                        showSuccessToast(response.text || response.message || 'Data siswa berhasil ditambahkan');
                        form[0].reset();
                        loadSiswa();
                    } else {
                        showDangerToast(response.text || response.message || 'Gagal menambahkan siswa');
                    }
                },
                error: function (xhr, status, error) {
                    btn.prop('disabled', false).html('<svg class="icon-20 me-1" width="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg> Simpan');
                    $('#createSiswaModal').modal('hide');
                    var err = 'Gagal disimpan';
                    if (xhr.responseJSON && xhr.responseJSON.message) err += ': ' + xhr.responseJSON.message;
                    showDangerToast(err);
                }
            });
        });

        $('#nis').on('input', function() {
            var val = $(this).val();
            if (val && !$('#username').val()) {
                $('#username').val(val);
            }
            if (val && !$('#password').val()) {
                $('#password').val(val);
            }
        });

        $("#dropdown-action").on("click", "#cetak_kartu", function (e) {
            e.preventDefault();
            cetakKartuSiswa(true);
        });
        $("#dropdown-action").on("click", "#download_terpilih", function (e) {
            e.preventDefault();
            downloadDataSiswa(true);
        });

        $("#dropdown-action a").click(function () {
            let x = $(this).attr('id');
            //alert(x);
            actionBulk = x;
            if (x ==="pindah") {
                bulk_pindah()
            } else if (x ==="keluar") {
                bulk_keluar()
            } else if (x ==="hapus") {
                bulk_delete()
            }
        });

        loadSiswa();
    });

    function loadSiswa() {
        $(".select_all").prop("checked", false);
        $('#pager-page').val(currentPage);
        $('#loading').removeClass('d-none');
        var cari = query != null ? '&search=' + query : ''
        var filter = '&filter=' + $('#users-filter').val();
        var kelas = '&kelas=' + $('#kelas-filter').val();
        var dataPost = $('#pager').serialize() + cari + filter + kelas;
        console.log('post', dataPost);
        $.ajax({
            url: base_url + 'datasiswa/list',
            data: dataPost,
            type: 'POST',
            success: function (data) {
                $('#input-search').val(data.search);
                if (data.pages > 0) {
                    $pagination.removeClass('d-none');
                    $pagination.twbsPagination('destroy');
                    $pagination.twbsPagination($.extend({}, defaultOpts, {
                        startPage: currentPage,
                        totalPages: data.pages,
                    }));
                } else {
                    $pagination.addClass('d-none');
                }
                console.log(data);
                previewData(data);
            }, error: function (xhr, status, error) {
                $('#loading').addClass('d-none')
                console.log("error", xhr.responseText);
                swal.fire({
                    title:"ERROR",
                    text:"Ada kesalahan",
                    icon:"error"
                });
            }
        });
    }

        async function previewData(data) {
        $('#input-search').val(data?.search ?? '');
        let html = '';

        if (Array.isArray(data?.lists) && data.lists.length > 0) {
            for (let idx = 0; idx < data.lists.length; idx++) {
                const siswa = data.lists[idx];
                const namaKelas = siswa?.nama_kelas ?? '';
                const kls = namaKelas !== '' ? '<span class="badge-custom badge-kelas"><i class="fas fa-chalkboard-teacher"></i>' + namaKelas + '</span>' : '';
                
                let statusText = 'Aktif', statusClass = 'badge-status';
                if(siswa?.active =="0" && siswa?.status =="1") {
                    statusText = 'Nonaktif'; statusClass = '';
                } else if(siswa.status == '2') {
                    statusText = 'Lulus'; statusClass = '';
                } else if(siswa.status == '3') {
                    statusText = 'Pindah'; statusClass = '';
                } else if(siswa.status == '4') {
                    statusText = 'Keluar'; statusClass = '';
                }
                const status = '<span class="badge-custom ' + statusClass + '"><i class="fas fa-check-circle"></i>' + statusText + '</span>';
                
                const agama = siswa?.agama ? '<span class="badge-custom badge-agama"><i class="fas fa-star-and-crescent"></i>' + siswa.agama + '</span>' : '';
                const gender = siswa?.jenis_kelamin ? '<span class="badge-custom badge-gender"><i class="fas fa-venus-mars"></i>' + siswa.jenis_kelamin + '</span>' : '';

                const fotoUrl = siswa?.foto || base_url + 'assets/img/siswa.png';
                
                // Login Data
                const uname = siswa?.username || 'Tidak ada';
                const rawPass = siswa?.password || '';
                const isEncrypted = rawPass.indexOf('$2y$') === 0;

                let passHtml = '';
                if (isEncrypted) {
                    passHtml = '<span class="text-muted" style="font-size:0.8rem;">(Terenkripsi - Impor ulang)</span>';
                } else if (!rawPass) {
                    passHtml = '<span class="text-muted">-</span>';
                } else {
                    const hiddenDots = '•'.repeat(Math.max(6, Math.min(rawPass.length, 12)));
                    const safePassAttr = $('<div>').text(rawPass).html().replace(/"/g, '&quot;');
                    passHtml = '<span id="pass-text-' + idx + '" data-hidden="true" data-pass="' + safePassAttr + '">' + hiddenDots + '</span>' +
                               '<button type="button" class="btn btn-xs text-secondary ms-1 p-0 border-0 bg-transparent align-middle" onclick="togglePass(' + idx + ')" title="Tampilkan/Sembunyikan Password">' +
                               '    <i id="pass-icon-' + idx + '" class="fa fa-eye"></i>' +
                               '</button>';
                }

                let btnAktif = '';
                if(siswa?.active == "1" || siswa?.active == null) {
                    btnAktif = '<button type="button" onclick="toggleAktif(\'' + (siswa?.id_siswa ?? '') + '\', \'' + encodeURIComponent(siswa?.username ?? '') + '\', \'' + encodeURIComponent(siswa?.nama ?? '') + '\', \'nonaktifkan\')" class="btn btn-xs btn-danger mt-1"><i class="fa fa-ban"></i> Nonaktifkan</button>';
                } else {
                    btnAktif = '<button type="button" onclick="toggleAktif(\'' + (siswa?.id_siswa ?? '') + '\', \'' + encodeURIComponent(siswa?.username ?? '') + '\', \'' + encodeURIComponent(siswa?.nama ?? '') + '\', \'aktifkan\')" class="btn btn-xs btn-success mt-1"><i class="fa fa-check"></i> Aktifkan</button>';
                }

                html += '<tr>' +
                    '   <td class="text-center">' +
                    '       <div class="custom-control custom-checkbox">' +
                    '           <input type="checkbox" class="custom-control-input check" id="chk' + idx + '" name="checked[]" value="' + (siswa?.id_siswa ?? '') + '">' +
                    '           <label class="custom-control-label" for="chk' + idx + '"></label>' +
                    '       </div>' +
                    '   </td>' +
                    '   <td class="text-center text-muted">' + Number((perPage * (currentPage - 1)) + (idx + 1)) + '</td>' +
                    '   <td>' +
                    '       <div class="d-flex align-items-center">' +
                    '           <img class="profil-img shadow-sm" src="' + fotoUrl + '" alt="Foto">' +
                    '           <div class="ms-3">' +
                    '               <div class="siswa-nama">' + (siswa?.nama ?? '') + '</div>' +
                    '               <div class="d-flex flex-wrap">' + kls + agama + gender + status + '</div>' +
                    '           </div>' +
                    '       </div>' +
                    '   </td>' +
                    '   <td class="text-center">' +
                    '       <div class="data-card">' +
                    '           <div class="data-card-item fw-bold">NIS <br><span class="fw-normal">' + (siswa?.nis ?? '-') + '</span></div>' +
                    '           <div class="data-card-divider"></div>' +
                    '           <div class="data-card-item fw-bold">NISN <br><span class="fw-normal">' + (siswa?.nisn ?? '-') + '</span></div>' +
                    '       </div>' +
                    '   </td>' +
                    '   <td class="text-center">' +
                    '       <div class="data-card">' +
                    '           <div class="data-card-item"><i class="fas fa-user-circle data-card-icon"></i>' + uname + '</div>' +
                    '           <div class="data-card-divider"></div>' +
                    '           <div class="data-card-item"><i class="fas fa-key data-card-icon key me-1"></i>' + passHtml + '</div>' +
                    '       </div>' +
                    '   </td>' +
                    '   <td class="text-center">' +
                    '       <div class="d-flex flex-column align-items-center gap-1">' +
                    '           <a href="' + base_url + 'datasiswa/edit/' + (siswa?.id_siswa ?? '') + '" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i> Edit</a>' +
                    '           <a href="' + base_url + 'datasiswa/kartu/' + (siswa?.id_siswa ?? '') + '" target="_blank" rel="noopener" class="btn btn-xs btn-outline-primary"><i class="fas fa-print"></i> Cetak Kartu Siswa</a>' +
                    '           ' + btnAktif +
                    '       </div>' +
                    '   </td>' +
                    '</tr>';
            }

            const loaded = Number(perPage * (currentPage - 1)) + 1;
            const to = loaded + data.lists.length - 1;
            $('#total-entri').html('Menampilkan <b>' + loaded + '</b> - <b>' + to + '</b> dari <b>' + data.total + '</b> total data');
        } else {
            $('#total-entri').html(`0 entri`);
            html += '<tr><td colspan="6" class="text-center py-5 text-muted"><i class="fas fa-inbox fa-3x mb-3 d-block text-light"></i>Tidak ada data siswa ditemukan</td></tr>';
        }

        $('#table-body').html(html);
        $('#loading').addClass('d-none');
    }

    function buildSiswaExportParams(onlySelected) {
        const params = new URLSearchParams();
        const filterVal = $('#users-filter').val() || '0';
        const kelasVal = $('#kelas-filter').val() || '';
        const searchVal = $('#input-search').val() || '';
        if (filterVal && filterVal !== '0') {
            params.set('filter', filterVal);
        }
        if (filterVal === '3' && kelasVal) {
            params.set('kelas', kelasVal);
        }
        if (searchVal.trim() !== '') {
            params.set('search', searchVal.trim());
        }
        if (onlySelected) {
            const checkedIds = [];
            $("#table-siswa tbody tr .check:checked").each(function () {
                checkedIds.push($(this).val());
            });
            if (checkedIds.length > 0) {
                params.set('ids', checkedIds.join(','));
            }
        }
        const qs = params.toString();
        return qs ? ('?' + qs) : '';
    }

    function cetakKartuSiswa(onlySelected = false) {
        window.open(base_url + 'datasiswa/kartu/semua' + buildSiswaExportParams(onlySelected), '_blank', 'noopener');
    }

    function downloadDataSiswa(onlySelected = false) {
        window.location.href = base_url + 'datasiswa/export_excel' + buildSiswaExportParams(onlySelected);
    }
function cekGambar(url) {
        return new Promise((resolve) => {
            const img = new Image();
            img.onload = () => resolve(url);
            img.onerror = () => resolve(base_url + 'assets/img/siswa.png');
            img.src = url;
        });
    }

    function applySearch() {
        query = $('#input-search').val();
        currentPage = 1;
        loadSiswa();
    }

    function toggleAktif(id, username, nama, action) {
        nama = decodeURIComponent(nama);
        username = decodeURIComponent(username);
        swal.fire({
            title: action === 'aktifkan' ? "Aktifkan siswa" : "Nonaktifkan siswa",
            text: action === 'aktifkan' ? "Akun login siswa akan diaktifkan!" : "Akun login siswa akan dinonaktifkan!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: action === 'aktifkan' ? "Aktifkan!" : "Nonaktifkan!"
        }).then(result => {
            if (result.value) {
                let formActivate = new FormData();
                formActivate.append('is_active', action);
                formActivate.append('id_siswa', id);
                formActivate.append('username', username);
                formActivate.append('nama', nama);
                
                $.ajax({
                    url: base_url + "usersiswa/activate",
                    type: "POST",
                    data: formActivate,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        if (data.status) {
                            swal.fire("Sukses", data.msg, "success");
                            loadSiswa();
                        } else {
                            swal.fire("Gagal", data.msg, "error");
                        }
                    },
                    error: function() {
                        swal.fire("Gagal", "Terjadi kesalahan pada server", "error");
                    }
                });
            }
        });
    }

    function bulk_delete() {
        if ($("#table-siswa tbody tr .check:checked").length == 0) {
            swal.fire({
                title:"Gagal",
                text:"Tidak ada data yang dipilih",
                icon:"error"
            });
        } else {
            swal.fire({
                title:"Anda yakin?",
                text:"Data terpilih akan dihapus!",
                icon:"warning",
                showCancelButton: true,
                confirmButtonColor:"#3085d6",
                cancelButtonColor:"#d33",
                confirmButtonText:"Hapus!"
            }).then(result => {
                if (result.value) {
                    $("#bulk").submit();
                }
            });
        }
    }

    function bulk_pindah() {
        if ($("#table-siswa tbody tr .check:checked").length == 0) {
            swal.fire({
                title:"Gagal",
                text:"Tidak ada data yang dipilih",
                icon:"error"
            });
        } else {
            swal.fire({
                title:"Anda yakin?",
                text:"Data terpilih akan diset sebagai siswa PINDAH",
                icon:"warning",
                showCancelButton: true,
                confirmButtonColor:"#3085d6",
                cancelButtonColor:"#d33",
                confirmButtonText:"YA!"
            }).then(result => {
                if (result.value) {
                    $("#bulk").submit();
                }
            });
        }
    }

    function bulk_keluar() {
        if ($("#table-siswa tbody tr .check:checked").length == 0) {
            swal.fire({
                title:"Gagal",
                text:"Tidak ada data yang dipilih",
                icon:"error"
            });
        } else {
            swal.fire({
                title:"Anda yakin?",
                text:"Data terpilih akan diset sebagai siswa KELUAR",
                icon:"warning",
                showCancelButton: true,
                confirmButtonColor:"#3085d6",
                cancelButtonColor:"#d33",
                confirmButtonText:"YA!"
            }).then(result => {
                if (result.value) {
                    $("#bulk").submit();
                }
            });
        }
    }

    function togglePass(idx) {
        const $el = $('#pass-text-' + idx);
        const $icon = $('#pass-icon-' + idx);
        if (!$el.length) return;
        
        const isHidden = $el.attr('data-hidden') === 'true';
        const rawPass = $el.attr('data-pass');
        
        if (isHidden) {
            $el.html(rawPass);
            $el.attr('data-hidden', 'false');
            $icon.removeClass('fa-eye').addClass('fa-eye-slash text-danger');
        } else {
            const rawText = $('<div>').html(rawPass).text();
            const hiddenDots = '•'.repeat(Math.max(6, Math.min(rawText.length, 12)));
            $el.text(hiddenDots);
            $el.attr('data-hidden', 'true');
            $icon.removeClass('fa-eye-slash text-danger').addClass('fa-eye');
        }
    }

</script>

<?= $this->endSection() ?>
