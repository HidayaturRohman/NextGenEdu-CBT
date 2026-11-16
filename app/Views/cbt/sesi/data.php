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
            <div class="rounded-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 60px; height: 60px; background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: #ffffff;">
              <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"></circle>
                <polyline points="12 6 12 12 16 14"></polyline>
              </svg>
            </div>
          </div>
          <div>
            <h4 class="card-title mb-1 fw-bold d-flex align-items-center">
                <?= $judul ?>
            </h4>
            <p class="text-muted mb-0" style="font-size: 0.9rem;">Manajemen alokasi sesi pelaksanaan ujian, waktu mulai, dan pembagian gelombang tes.</p>
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
                        <button type="button" data-bs-toggle="modal" data-bs-target="#createSesiModal"
                                class="btn btn-sm btn-primary"><i
                                    class="fas fa-plus"></i><span class="d-none d-sm-inline-block ml-1">Tambah Sesi Ujian</span>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <?= form_open('cbtsesi/delete', array('id' => 'bulk')); ?>
                                        <!-- Custom Filter & Search UI -->
                    <div class="filter-container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="filter-label cari-label"><i class="fas fa-search"></i> Cari</div>
                                <div class="d-flex">
                                    <input id="custom-search-sesi" type="text" class="form-control form-control-sm" placeholder="Cari data...">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Custom Toolbar Aksi -->
                    <div class="toolbar-container">
                        <div class="dropdown">
                            <button id="custom-btn-aksi-sesi" class="btn btn-aksi shadow-sm" type="button" onclick="bulk_delete()" disabled="disabled">
                                <i class="fas fa-trash me-1"></i> Hapus Terpilih
                            </button>
                        </div>
                    </div>
                    
                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            // Wire up custom search
                            $('#custom-search-sesi').on('keyup', function() {
                                if (typeof table !== 'undefined') {
                                    table.search(this.value).draw();
                                }
                            });
                            
                            // Override the bulk delete check event listener to enable/disable our button
                            $(document).ajaxComplete(function() {
                                $('.select_all, .check').on('change', function() {
                                    setTimeout(function() {
                                        var checked = $("#sesi tbody tr .check:checked").length;
                                        if (checked === 0) {
                                            $('#custom-btn-aksi-sesi').prop('disabled', 'disabled');
                                        } else {
                                            $('#custom-btn-aksi-sesi').removeAttr('disabled');
                                        }
                                    }, 100);
                                });
                            });
                        });
                    </script>
                    
                    <div class="table-responsive">
                        <table id="sesi" class="w-100 table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th width="40" class="align-middle text-center p-0">
                                    <input class="select_all" type="checkbox">
                                </th>
                                <th width="40" class="align-middle text-center p-0">No.</th>
                                <th>Sesi</th>
                                <th>Kode</th>
                                <th>Waktu</th>
                                <th>Istirahat</th>
                                <th class="align-middle text-center p-0">Aksi</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    <?= form_open('create', array('id' => 'create')) ?>
<div class="modal fade" id="createSesiModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Tambah Sesi Ujian</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label for="nama_sesi" class="col-md-4 col-form-label">Sesi Ujian*</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="nama_sesi" placeholder="Nama Sesi" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="kode_sesi" class="col-md-4 col-form-label">Kode Sesi*</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="kode_sesi" placeholder="Kode Sesi Ujian" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4 col-form-label">Jam Mulai*</label>
                    <div class="col-md-8">
                        <input type="text" id="jamAwal" name="waktu_mulai" class="form-control" autocomplete="off"
                               required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4 col-form-label">Jam Berakhir*</label>
                    <div class="col-md-8">
                        <input type="text" id="jamAkhir" name="waktu_akhir" class="form-control" autocomplete="off"
                               required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4 col-form-label">Istirahat</label>
                    <div class="col-md-8">
                        <input type="number" id="istirahat" name="istirahat" class="form-control" autocomplete="off">
                        <span class="text-xs">Hanya berlaku untuk informasi cetak Daftar Hadir dan Berita Acara.</span>
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

<?= form_open('update', array('id' => 'update')) ?>
<div class="modal fade" id="editSesiModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Sesi Ujian</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label for="namaEdit" class="col-md-4 col-form-label">Sesi Ujian*</label>
                    <div class="col-md-8">
                        <input type="text" id="namaEdit" class="form-control" name="nama_sesi" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="kodeEdit" class="col-md-4 col-form-label">Kode Sesi*</label>
                    <div class="col-md-8">
                        <input type="text" id="kodeEdit" class="form-control" name="kode_sesi" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="jamAwalEdit" class="col-md-4 col-form-label">Waktu Mulai*</label>
                    <div class="col-md-8">
                        <input type="time" id="jamAwalEdit" class="form-control" name="waktu_mulai" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="jamAkhirEdit" class="col-md-4 col-form-label">Waktu Akhir*</label>
                    <div class="col-md-8">
                        <input type="time" id="jamAkhirEdit" class="form-control" name="waktu_akhir" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4 col-form-label">Istirahat</label>
                    <div class="col-md-8">
                        <input type="number" id="istirahatEdit" name="istirahat" class="form-control" autocomplete="off">
                        <span class="text-xs">Hanya berlaku untuk informasi cetak Daftar Hadir dan Berita Acara.</span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="editIdSesi" name="id_sesi">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary"><svg class="icon-20 me-1" width="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg><span class="d-none d-sm-inline-block ms-1">Simpan</span></button>
            </div>
        </div>
    </div>
</div>
<?= form_close() ?>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    var table;

    $(document).ready(function () {
        ajaxcsrf();

        table = $("#sesi").DataTable({
            initComplete: function () {
                var api = this.api();
                $("#sesi_filter input")
                    .off(".DT")
                    .on("keyup.DT", function (e) {
                        api.search(this.value).draw();
                    });
            },
            dom:
                "<'row'<'col-sm-6'l><'col-sm-6'f>>" +
                "<'row'<'toolbar'lfrtip>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            oLanguage: {
                sProcessing: "loading..."
            },
            processing: true,
            serverSide: true,
                        ajax: {
                url: base_url + "cbtsesi/data",
                type: "POST"
                //data: csrf
            },
            columns: [
                {
                    data: "id_sesi",
                    orderable: false,
                    searchable: false,
                    className: "text-center",
                    render: function (data, type, row, meta) {
                        return `<input name="checked[]" class="check" value="${data}" type="checkbox">`;
                    }
                },
                {
                    data: "id_sesi",
                    className: "text-center",
                    orderable: false,
                    searchable: false
                },
                {data: "nama_sesi"},
                {data: "kode_sesi"},
                {
                    data: null, 
                    render: function (data, type, row) {
                        return (row.waktu_mulai ? row.waktu_mulai : '') + ' s/d ' + (row.waktu_akhir ? row.waktu_akhir : '');
                    }
                },
                {
                    data: "istirahat",
                    render: function (data, type, row, meta) {
                        return `<div>${data && data !== '0' ? data + ' mnt' : 'Tidak ada'}</div>`;
                    }
                },
                {
                    data: "id_sesi",
                    orderable: false,
                    searchable: false,
                    render: function (data, type, row, meta) {
                        return `<div class="text-center">
									<a class="ms-1 me-2 btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editSesiModal"
									 data-id='${row.id_sesi}' data-nama='${row.nama_sesi}' data-kode='${row.kode_sesi}'
									 data-awal='${row.waktu_mulai}' data-akhir='${row.waktu_akhir}' data-istirahat='${row.istirahat}'>
										<i class="fa fa-pencil-alt"></i> Edit
									</a>
								</div>`;
                    }
                }
            ],
            order: [[4, "asc"]],
            rowId: function (a) {
                return a.id_sesi;
            },
            rowCallback: function (row, data, iDisplayIndex) {
                $("td:eq(1)", row).html(iDisplayIndex + 1);
            }
        });

        table
            .buttons()
            .container()
            .appendTo("#sesi_wrapper .col-md-6:eq(1)");

        $("div.toolbar").html(
            '<button id="hapusterpilih" onclick="bulk_delete()" type="button" class="btn btn-danger" data-bs-toggle="tooltip" title="Hapus Terpilh" disabled="disabled">' +
            '<i class="far fa-trash-alt"></i></button>'
        );

        $(".select_all").on("click", function () {
            if (this.checked) {
                $(".check").each(function () {
                    this.checked = true;
                    $(".select_all").prop("checked", true);
                    $('#custom-btn-aksi-sesi').removeAttr('disabled');
                });
            } else {
                $(".check").each(function () {
                    this.checked = false;
                    $(".select_all").prop("checked", false);
                    $('#custom-btn-aksi-sesi').prop('disabled','disabled');
                });
            }
        });

        $("#sesi tbody").on("click", "tr .check", function () {
            var check = $("#sesi tbody tr .check").length;
            var checked = $("#sesi tbody tr .check:checked").length;
            if (check === checked) {
                $(".select_all").prop("checked", true);
            } else {
                $(".select_all").prop("checked", false);
            }

            if (checked === 0) {
                $('#hapusterpilih').prop('disabled','disabled');
                $('#custom-btn-aksi-sesi').prop('disabled', 'disabled');
            } else {
                $('#hapusterpilih').removeAttr('disabled');
                $('#custom-btn-aksi-sesi').removeAttr('disabled');
            }
        });

        $('#create').on('submit', function (e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            $('#createSesiModal').modal('hide');

            $.ajax({
                url: base_url + "cbtsesi/add",
                type: "POST",
                dataType: "JSON",
                data: $(this).serialize(),
                success: function (data) {
                    showSuccessToast('Data berhasil disimpan.');
                    table.ajax.reload();
                }, 
                error: function (xhr, status, error) {
                    showDangerToast("Error");
                }
            });
        });

        $('#editSesiModal').on('show.bs.modal', function (e) {
            var btn = $(e.relatedTarget);
            var id = btn.data('id');
            var nama = btn.data('nama');
            var kode = btn.data('kode');
            var awal = btn.data('awal');
            var akhir = btn.data('akhir');
            var istirahat = btn.data('istirahat');

            if (awal && awal.length > 5) awal = awal.substring(0, 5);
            if (akhir && akhir.length > 5) akhir = akhir.substring(0, 5);

            var attrNama = document.getElementById("editIdSesi");
            if (attrNama) attrNama.setAttribute("name", "id_sesi");

            $(this).find('input[id="namaEdit"]').val(nama);
            $(this).find('input[id="kodeEdit"]').val(kode);
            $(this).find('input[id="editIdSesi"]').val(id);
            $(this).find('input[id="jamAwalEdit"]').val(awal);
            $(this).find('input[id="jamAkhirEdit"]').val(akhir);
            $(this).find('input[id="istirahatEdit"]').val(istirahat);
        });

        $('#update').on('submit', function (e) {
            e.preventDefault();
            e.stopImmediatePropagation();

            $.ajax({
                url: base_url + "cbtsesi/update",
                data: $(this).serialize(),
                method: 'POST',
                dataType: "JSON",
                success: function (data) {
                    $('#editSesiModal').modal('hide');
                    showSuccessToast('Data berhasil diupdate.');
                    table.ajax.reload();
                },
                error: function (xhr, status, error) {
                    $('#editSesiModal').modal('hide');
                    showDangerToast("Error");
                }
            });
        });

        $("#bulk").on("submit", function (e) {
            e.preventDefault();
            e.stopImmediatePropagation();

            $.ajax({
                url: $(this).attr("action"),
                data: $(this).serialize(),
                type: "POST",
                success: function (respon) {
                    $('#custom-btn-aksi-sesi').prop('disabled', 'disabled');
                    if (respon.status) {
                        swal.fire({
                            title: "Berhasil",
                            text: respon.total + " data berhasil dihapus",
                            icon: "success"
                        });
                    } else {
                        swal.fire({
                            title: "Gagal",
                            text: "Tidak ada data yang dipilih",
                            icon: "error"
                        });
                    }
                    table.ajax.reload();
                },
                error: function () {
                    $('#custom-btn-aksi-sesi').prop('disabled', 'disabled');
                    swal.fire({
                        title: "Gagal",
                        text: "Ada data yang sedang digunakan",
                        icon: "error"
                    });
                }
            });
        });

        $('#jamAwalEdit, #jamAkhirEdit, #jamAwal, #jamAkhir').datetimepicker({
            datepicker:false,
            format:'H:i',
            step: 30,
            minTime: '06:00',
            maxTime: '23:00'
        });

    });

    function bulk_delete() {
        if ($("#sesi tbody tr .check:checked").length == 0) {
            swal.fire({
                title: "Gagal",
                text: "Tidak ada data yang dipilih",
                icon: "error"
            });
        } else {
            swal.fire({
                title: "Anda yakin?",
                text: "Data akan dihapus!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Hapus!"
            }).then(result => {
                if (result.value) {
                    $("#bulk").submit();
                }
            });
        }
    }
</script>


<?= $this->endSection() ?>
