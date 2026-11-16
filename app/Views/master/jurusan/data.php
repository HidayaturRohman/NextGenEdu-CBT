<?= $this->extend('layout/dashboard_template_bs5') ?>
<?= $this->section('content') ?>

    <div class="row">
  <div class="col-sm-12">
    <div class="card mb-4">
      <div class="card-body">
        <div class="d-flex align-items-center justify-content-between w-100">
            <div class="d-flex align-items-center">
              <div class="me-3 flex-shrink-0">
                <div class="rounded-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 60px; height: 60px; background: linear-gradient(135deg, #f59e0b 0%, #b45309 100%); color: #ffffff;">
                  <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 10v6M2 10l10-5 10 5-10 5z"></path>
                    <path d="M6 12v5c3 3 9 3 12 0v-5"></path>
                  </svg>
                </div>
              </div>
              <div>
                <h4 class="card-title mb-1 fw-bold d-flex align-items-center">
                    <?= $judul ?>
                </h4>
                <p class="text-muted mb-0" style="font-size: 0.9rem;">Manajemen data program keahlian, konsentrasi jurusan, serta pemetaan kualifikasi akademik siswa.</p>
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
                <div class="card-header py-3">
                    <div class="card-title">
                        <h6><?= $subjudul ?></h6>
                    </div>
                    <div class="card-tools">
                        <button type="button" onclick="window.location.reload()" class="btn btn-sm btn-default"><i
                                    class="fa fa-sync"></i> <span class="d-none d-sm-inline-block ms-1">Reload</span>
                        </button>
                        <button type="button" data-bs-toggle="modal" data-bs-target="#createJurusanModal"
                                class="btn btn-sm btn-primary shadow-sm"><svg class="icon-20 me-1" width="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg><span class="ms-1">Tambah Data</span></button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="alert alert-default-light border border-success align-content-center mb-3" role="alert">
                        Abaikan halaman ini jika sekolah tidak ada jurusan (jenjang SMP/MTs atau SD/MI)
                    </div>
                    <?= form_open('', array('id' => 'bulk')) ?>
                    <div class="table-responsive">
                        <table id="jurusan" class="w-100 table table-sm table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th height="40" class="text-center align-middle p-0" style="width: 40px">
                                    <input type="checkbox" id="select_all">
                                </th>
                                <th style="width: 40px" class="text-center align-middle p-0">No.</th>
                                <th class="align-middle">Kode</th>
                                <th class="align-middle">Jurusan</th>
                                <th class="align-middle">Mapel Peminatan</th>
                                <th class="text-center align-middle p-0" style="width: 100px"><span>Aksi</span></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $no = 1;
                            foreach ($jurusans as $row) :
                                $badges = '';
                                foreach (explode(',', $row->mapel_peminatan ?? '') as $mid) {
                                    if ($mid != '' && isset($jurusan_mapels[$row->id_jurusan][$mid]))
                                        $badges .= '<div class="badge badge-btn badge-success me-1">' . $jurusan_mapels[$row->id_jurusan][$mid] . '</div>';
                                }
                                ?>
                                <tr>
                                    <td class="text-center">
                                        <div>
                                            <input id="check<?= $row->id_jurusan ?>" name="checked[]" class="check"
                                                   value="<?= $row->id_jurusan ?>" type="checkbox">
                                        </div>
                                    </td>
                                    <td class="text-center"><?= $no ?></td>
                                    <td><?= $row->kode_jurusan ?></td>
                                    <td><?= $row->nama_jurusan ?></td>
                                    <td><?= $badges ?></td>
                                    <td>
                                        <div class="text-center">
                                            <a class="btn btn-xs btn-warning editRecord" data-bs-toggle="modal"
                                               data-bs-target="#editJurusanModal" data-deletable="<?= $row->deletable ?>"
                                               data-mapel="<?= $row->mapel_peminatan ?>"
                                               data-id='<?= $row->id_jurusan ?>'
                                               data-nama='<?= $row->nama_jurusan ?>'
                                               data-kode='<?= $row->kode_jurusan ?>'>
                                                <i class="fa fa-pencil-alt text-white"></i>
                                            </a>
                                            <!--
                                            <button onclick="deleteItem(${data.id_jurusan})" class="btn btn-xs btn-danger deleteRecord" data-id="${data.id_jurusan}" ${disabled}>
                                        <i class="fa fa-trash text-white"></i>
                                    </button>
                                            -->
                                        </div>
                                    </td>
                                </tr>
                                <?php $no++; endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </section>
</div>

<?= form_open('datajurusan/save', array('id' => 'create')) ?>
<input type="hidden" name="mode" value="add">
<div class="modal fade" id="createJurusanModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Tambah Jurusan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Jurusan*</label>
                    <div class="col-md-9">
                        <input type="text" id="createnama" name="nama_jurusan" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Kode*</label>
                    <div class="col-md-9">
                        <input type="text" id="createkode" name="kode_jurusan" class="form-control" required>
                    </div>
                </div>

                <?php foreach ($kode_peminatan as $kode) :?>
                    <div class="form-group row">
                        <?php if (isset($mapel_peminatan[$kode->kode_kel_mapel])) : ?>
                            <label class="col-md-3 col-form-label"><?= $kode->nama_kel_mapel ?></label>
                            <div class="col-md-9">
                                <?php if (count($mapel_peminatan) === 0) : ?>
                                    <select class="form-control">
                                        <option value="0" selected disabled>Belum ada mapel <?= $kode->nama_kel_mapel ?></option>
                                    </select>
                                <?php else:
                                    foreach ($mapel_peminatan as $k_mpl=>$mapels) :
                                        if ($k_mpl === $kode->kode_kel_mapel) : ?>
                                            <select name="mapel[]" id="create_mapel_peminatan<?= $kode->kode_kel_mapel ?>"
                                                    class="form-control mapel_peminatan select2" multiple="">
                                                <?php foreach ($mapels as $kd_mpl=>$mapel) :?>
                                                    <option class="opt-mapel" value="<?= $kd_mpl ?>"><?= $mapel ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        <?php endif; endforeach; endif; ?>
                            </div>
                        <?php else: ?>
                        <label class="col-md-3 col-form-label">Mapel Peminatan</label>
                        <div class="col-md-9">
                            <select class="form-control">
                                <option value="0" selected disabled>Belum ada mapel peminatan</option>
                            </select>
                        </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
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

<?= form_open('datajurusan/save', array('id' => 'update')) ?>
<input type="hidden" name="mode" value="edit">
<div class="modal fade" id="editJurusanModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Jurusan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group row" id="formnama">
                    <label class="col-md-3 col-form-label">Jurusan*</label>
                    <div class="col-md-9">
                        <input type="text" id="namaEdit" name="nama_jurusan" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row" id="formkode">
                    <label class="col-md-3 col-form-label">Kode*</label>
                    <div class="col-md-9">
                        <input type="text" id="kodeEdit" name="kode_jurusan" class="form-control" required>
                    </div>
                </div>
                <?php
                foreach ($kode_peminatan as $kode) : ?>
                    <div class="form-group row">
                        <?php if (isset($mapel_peminatan[$kode->kode_kel_mapel])) : ?>
                            <label class="col-md-3 col-form-label"><?= $kode->nama_kel_mapel ?></label>
                            <div class="col-md-9">
                                <?php if (count($mapel_peminatan) === 0) : ?>
                                    <select class="form-control">
                                        <option value="0" selected disabled>Belum ada mapel <?= $kode->nama_kel_mapel ?></option>
                                    </select>
                                <?php else:
                                    foreach ($mapel_peminatan as $k_mpl=>$mapels) :
                                        if ($k_mpl === $kode->kode_kel_mapel) : ?>
                                            <select name="mapel[]" id="mapel_peminatan<?= $kode->kode_kel_mapel ?>"
                                                    class="form-control mapel_peminatan select2" multiple="">
                                                <!--
                                                <?php foreach ($mapels as $kd_mpl=>$mapel) : ?>
                                                    <option class="opt-mapel" value="<?= $kd_mpl ?>"><?= $mapel ?></option>
                                                <?php endforeach; ?>
                                                -->
                                            </select>
                                        <?php endif; endforeach; endif; ?>
                            </div>

                        <?php else: ?>
                            <label class="col-md-3 col-form-label"><?= $kode->nama_kel_mapel ?></label>
                            <div class="col-md-9">
                                <select class="form-control">
                                    <option value="0" selected disabled>Belum ada mapel peminatan</option>
                                </select>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="editIdJurusan" name="id_jurusan" class="form-control">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">
                    <svg class="icon-20 me-1" width="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg> Simpan Perubahan
                </button>
            </div>
        </div>
    </div>
</div>
<?= form_close() ?>

<!--
<div class="template-demo d-flex justify-content-between flex-wrap">
    <button type="button" class="btn btn-success btn-fw" onclick="showSuccessToast()">Success</button>
    <button type="button" class="btn btn-info btn-fw" onclick="showInfoToast()">Info</button>
    <button type="button" class="btn btn-warning btn-fw" onclick="showWarningToast()">Warning</button>
    <button type="button" class="btn btn-danger btn-fw" onclick="showDangerToast()">Danger</button>
</div>
-->

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    var mapels = JSON.parse('<?= json_encode($mapel_peminatan) ?>');
</script>
<script src="<?= base_url() ?>/assets/app/js/master/jurusan/crud.js"></script>

<?= $this->endSection() ?>
