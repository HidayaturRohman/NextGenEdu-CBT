<?= $this->extend('layout/dashboard_template_bs5') ?>
<?= $this->section('content') ?>

    <div class="row">
  <div class="col-sm-12">
    <div class="card mb-4">
      <div class="card-body">
        <div class="d-flex align-items-center justify-content-between w-100">
            <div class="d-flex align-items-center">
              <div class="me-3 flex-shrink-0">
                <div class="rounded-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 60px; height: 60px; background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%); color: #ffffff;">
                  <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                    <line x1="16" y1="2" x2="16" y2="6"></line>
                    <line x1="8" y1="2" x2="8" y2="6"></line>
                    <line x1="3" y1="10" x2="21" y2="10"></line>
                    <path d="M8 14h.01"></path>
                    <path d="M12 14h.01"></path>
                    <path d="M16 14h.01"></path>
                    <path d="M8 18h.01"></path>
                    <path d="M12 18h.01"></path>
                    <path d="M16 18h.01"></path>
                  </svg>
                </div>
              </div>
              <div>
                <h4 class="card-title mb-1 fw-bold d-flex align-items-center">
                    <?= $judul ?>
                </h4>
                <p class="text-muted mb-0" style="font-size: 0.9rem;">Pengaturan tahun ajaran aktif, pergantian periode akademik, dan alokasi semester sekolah.</p>
              </div>
            </div>
            <div>
                
            </div>
        </div>
      </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card card-default  mb-4">
                <div class="card-header">
                    <div class="card-title d-flex align-items-center">
                        <iconify-icon icon="lucide:settings-2" class="me-2 text-primary" style="font-size: 1.4rem;"></iconify-icon>
                        <span style="font-size: 1.25rem; font-weight: 700; color: #232D42;"><?= $subjudul ?></span>
                    </div>
                    <div class="card-tools">
                        <button type="button" onclick="window.location.reload()" class="btn btn-sm btn-default">
                            <i class="fa fa-sync"></i> <span class="d-none d-sm-inline-block ms-1">Reload</span>
                        </button>
                        <button type="button" data-from="add" data-bs-toggle="modal" data-bs-target="#createTahunModal"
                                class="btn btn-sm bg-gradient-primary"><svg class="icon-20 me-1" width="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg><span class="d-none d-sm-inline-block ms-1">Tambah Tahun Pelajaran</span>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-7 mb-4 table-responsive">
                            <label class="d-flex align-items-center mb-3" style="font-size: 1.1rem; font-weight: 700; color: #3a57e8;">
                                <iconify-icon icon="lucide:calendar-days" class="me-2" style="font-size: 1.3rem;"></iconify-icon>
                                Tahun Pelajaran
                            </label>
                            <?= form_open('', array('id' => 'edittp')) ?>
                            <table id="tahun" class="table table-sm table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th class="d-none">id</th>
                                    <th height="50" class="text-center p-0 align-middle">No.</th>
                                    <th class="text-center p-0 align-middle">Tahun Pelajaran</th>
                                    <th class="text-center p-0 align-middle p-0">Status</th>
                                    <th class="text-center p-0 align-middle">Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($tp as $key => $value) : ?>
                                    <tr>
                                        <td class="d-none">
                                            <?= $value->id_tp ?>
                                        </td>
                                        <td class="text-center">
                                            <?= ($key + 1) ?>
                                        </td>
                                        <td class="text-center align-middle">
                                            <?= $value->tahun ?>
                                        </td>
                                        <td class="text-center align-middle">
                                            <?php if ($value->active) : ?>
                                                <span class="text-success"><i class="fa fa-check mr-2"></i>AKTIF</span>
                                            <?php else : ?>
                                                <button type="button" data-id="<?= $value->id_tp ?>"
                                                        class="btn btn-xs btn-primary btn-aktif">AKTIFKAN
                                                </button>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group btn-group-sm">
                                                <button type="button" data-id="<?= $value->id_tp ?>"
                                                        data-tahun="<?= $value->tahun ?>" data-from="edit"
                                                        data-bs-toggle="modal" data-bs-target="#createTahunModal"
                                                        class="btn btn-xs btn-warning btn-edit <?=$value->active ? 'btn-disabled': ''?>"
                                                    <?=$value->active ? 'disabled': ''?>>Edit
                                                </button>
                                                <button type="button" data-id="<?= $value->id_tp ?>"
                                                        class="btn btn-xs btn-danger btn-hapus <?=$value->active ? 'btn-disabled': ''?>" <?=$value->active ? 'disabled': ''?>>Hapus
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                            <?= form_close() ?>
                        </div>
                        <div class="col-md-5">
                            <label class="d-flex align-items-center mb-3" style="font-size: 1.1rem; font-weight: 700; color: #3a57e8;">
                                <iconify-icon icon="lucide:layers" class="me-2" style="font-size: 1.3rem;"></iconify-icon>
                                Semester
                            </label>
                            <?= form_open('', array('id' => 'editsmt')) ?>
                            <table id="semester" class="table table-sm table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th class="d-none">id</th>
                                    <th height="50" class="text-center p-0 align-middle">No.</th>
                                    <th class="text-center p-0 align-middle">Semester</th>
                                    <th class="text-center p-0 align-middle p-0">Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($smt as $key => $value) : ?>
                                    <tr>
                                        <td class="d-none">
                                            <?= $value->id_smt ?>
                                        </td>
                                        <td class="text-center">
                                            <?= ($key + 1) ?>
                                        </td>
                                        <td class="text-center">
                                            <?= $value->smt ?>
                                        </td>
                                        <td class="text-center">
                                            <?php if ($value->active) : ?>
                                                <span class="text-success"><i class="fa fa-check mr-2"></i>AKTIF</span>
                                            <?php else : ?>
                                                <button type="button" data-id="<?= $value->id_smt ?>"
                                                        class="btn btn-xs btn-primary btn-aktif">AKTIFKAN
                                                </button>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                            <?= form_close() ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?= form_open('', array('id' => 'create')) ?>
<div class="modal fade" id="createTahunModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Tambah Tahun</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">Tahun*</label>
                    <div class="col-md-10">
                        <input type="text" id="createtahun" name="tahun" class="form-control" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="editIdTahun" class="form-control">
                <input type="hidden" id="method" name="method" class="form-control">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary" id="submit-tp">
                    <svg class="icon-20 me-1" width="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg> Simpan
                </button>
            </div>
        </div>
    </div>
</div>
<?= form_close() ?>


<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script type="text/javascript"
        src="<?= base_url() ?>/assets/plugins/jquery-table2json/src/tabletojson-cell.js"></script>
<script type="text/javascript" src="<?= base_url() ?>/assets/plugins/jquery-table2json/src/tabletojson-row.js"></script>
<script type="text/javascript" src="<?= base_url() ?>/assets/plugins/jquery-table2json/src/tabletojson.js"></script>
<script>
    $(document).ready(function () {
        $("#tahun").on("click",".btn-aktif", function () {
            let id = $(this).data("id");
            var dataTahun = JSON.stringify($('#tahun').tableToJSON());
            var replaced = dataTahun.replace(/Tahun Pelajaran/g,"tp");

            //console.log($('#edittp').serialize() +"&active=" + id +"&tahun=" + replaced);
            swal.fire({
                text:"Silahkan tunggu....",
                allowEscapeKey: false,
                allowOutsideClick: false,
                onOpen: () => {
                    swal.showLoading();
                }
            });
            $.ajax({
                url: base_url +"datatahun/gantitahun",
                data: $('#edittp').serialize() +"&active=" + id +"&tahun=" + replaced,
                type:"POST",
                success: function (response) {
                    var title = response.status ?"Berhasil" :"Gagal";
                    var type = response.status ?"success" :"error";

                    swal.fire({
                        title: title,
                        text: response.msg,
                        icon: type
                    }).then((result) => {
                        if (result.value) {
                            if (response.status) {
                                window.location.href = base_url + 'datatahun';
                            }
                        }
                    });
                }, error: function (xhr, status, error) {
                    console.log("error", xhr.responseText);
                    const err = JSON.parse(xhr.responseText)
                    swal.fire({
                        title:"Error",
                        text: err.Message,
                        icon:"error"
                    });
                }
            });
        });

        $('#createTahunModal').on('show.bs.modal', function (e) {
            var method = $(e.relatedTarget).data('from');
            $(e.currentTarget).find('input[id="method"]').val(method);

            if (method === 'edit') {
                $('#createModalLabel').text('Edit Tahun');
                var id = $(e.relatedTarget).data('id');
                var tahun = $(e.relatedTarget).data('tahun');

                $(e.currentTarget).find('input[id="editIdTahun"]').val(id);
                $(e.currentTarget).find('input[id="createtahun"]').val(tahun);

                var attrId = document.getElementById("editIdTahun");
                attrId.setAttribute("name","id_tahun");
            } else {
                $('#createModalLabel').text('Tambah Tahun');
                $(e.currentTarget).find('input[id="editIdTahun"]').val('');
                $(e.currentTarget).find('input[id="createtahun"]').val('');
            }
        });

        $("#tahun").on("click",".btn-hapus", function () {
            let id = $(this).data("id");
            swal.fire({
                title: 'Hapus Tahun',
                text: 'Anda yakin akan menghapus Tahun Pelajaran? tindakan ini akan membuat data yang berhubungan tidak aktif',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor:"#d33",
                cancelButtonColor:"#3085d6",
                confirmButtonText:"Hapus"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: base_url +"datatahun/hapustahun",
                        data: $('#edittp').serialize() +"&hapus=" + id,
                        type:"POST",
                        success: function (response) {
                            var title = response.status ?"Berhasil" :"Gagal";
                            var type = response.status ?"success" :"error";

                            swal.fire({
                                title: title,
                                text: response.msg,
                                icon: type
                            }).then((result) => {
                                if (result.value) {
                                    if (response.status) {
                                        window.location.href = base_url + 'datatahun';
                                    }
                                }
                            });
                        }, error: function (xhr, status, error) {
                            console.log("error", xhr.responseText);
                            const err = JSON.parse(xhr.responseText)
                            swal.fire({
                                title:"Error",
                                text: err.Message,
                                icon:"error"
                            });
                        }
                    });
                }
            });
        });

        $("#semester").on("click",".btn-aktif", function () {
            let id = $(this).data("id");
            var dataSmt = JSON.stringify($('#semester').tableToJSON());
            //console.log($('#edittp').serialize() +"&active=" + id +"&tahun=" + replaced);
            $.ajax({
                url: base_url +"datatahun/gantisemester",
                data: $('#edittp').serialize() +"&active=" + id +"&semester=" + dataSmt,
                type:"POST",
                success: function (response) {
                    var title = response.status ?"Berhasil" :"Gagal";
                    var type = response.status ?"success" :"error";

                    swal.fire({
                        title: title,
                        text: response.msg,
                        icon: type
                    }).then((result) => {
                        if (result.value) {
                            if (response.status) {
                                window.location.href = base_url + 'datatahun';
                            }
                        }
                    });
                }, error: function (xhr, status, error) {
                    console.log("error", xhr.responseText);
                    const err = JSON.parse(xhr.responseText)
                    swal.fire({
                        title:"Error",
                        text: err.Message,
                        icon:"error"
                    });
                }
            });
        });

        $('#create').on('submit', function (e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            var form = new FormData($('#create')[0])
            console.log("data:", Object.fromEntries(form));

            $.ajax({
                url: base_url +"datatahun/add",
                type:"POST",
                data: form,
                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {
                    location.href = base_url + 'datatahun';
                }, error: function (xhr, status, error) {
                    $('#createTahunModal').modal('hide');
                    $('#createTahunModal').on('hidden', function () {
                        $(this).data('modal', null);  // destroys modal
                    });
                    showDangerToast('Gagal menambah tahun pelajaran');
                }
            });
            return false;
        });

        /*
        $('#hariefektif').submit('click', function (e) {
            e.stopPropagation();
            e.preventDefault();
            e.stopImmediatePropagation();
            console.log("data:", $(this).serialize());

            $.ajax({
                url: base_url +"datatahun/savehariefektif",
                type:"POST",
                dataType:"JSON",
                data: $(this).serialize(),
                success: function (data) {
                    if (data.status) {
                        swal.fire({
                            title:"Sukses",
                            text:"Jumlah Hari Efektif berhasi disimpan",
                            icon:"success"
                        }).then((result) => {
                            if (result.value) {
                                if (data.status) {
                                    window.location.href = base_url + 'datatahun';
                                }
                            }
                        });
                    } else {
                        swal.fire({
                            title:"Gagal",
                            text: 'Gagal menyimpan jumlah hari efektif',
                            icon:"error",
                        });
                    }
                }, error: function (xhr, status, error) {
                    const err = JSON.parse(xhr.responseText)
                    swal.fire({
                        title:"Error",
                        text: err.Message,
                        icon:"error"
                    });
                }
            });
        });
         */
    })
</script>

<?= $this->endSection() ?>
