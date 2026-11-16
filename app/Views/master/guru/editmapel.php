<?= $this->extend('layout/dashboard_template_bs5') ?>
<?= $this->section('content') ?>
<div class="row">
  <div class="col-sm-12">
    <div class="card bg-white shadow-sm mb-4">
      <div class="card-body p-4 d-flex flex-column flex-sm-row justify-content-between align-items-center">
        <div class="d-flex align-items-center mb-3 mb-sm-0">
          <div class="bg-primary-subtle text-primary rounded p-3 me-3">
            <svg class="icon-32" width="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
              <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
            </svg>
          </div>
          <div>
            <h4 class="mb-1 fw-bold"><?= $judul ?></h4>
            <p class="mb-0 text-muted" style="font-size: 0.9rem;">Kelola dan perbarui data</p>
          </div>
        </div>
        <div>
          <a href="<?= base_url('dataguru') ?>" class="btn btn-danger shadow-sm">
            <svg class="icon-20 me-1" width="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5"></path><polyline points="12 19 5 12 12 5"></polyline></svg><span class="d-none d-md-inline">Kembali</span>
          </a>
        </div>
      </div>
    </div>
    <div class="row">
        <div class="col-12">
          <div class="alert border border-success alert-success">
            <div class="row">
              <span class="col-12 mb-2">
                Jika ada jabatan guru di semester sebelumnya, jabatan dan mata pelajaran yang diampu bisa dicopy ke semester sekarang, dengan catatan:
                <ul class="mb-1">
                  <li>
                    <b>Aksi ini akan mengganti jabatan dan mapel guru</b> yang sudah diatur di semester sekarang.
                  </li>
                  <li>
                    Pastikan <b>Kode Kelas sudah dibuat</b> dan sama seperti Kode Kelas sebelumnya.
                  </li>
                  <li>
                    Aksi ini tidak akan berjalan sempurna <b>jika nama kode kelas di semester sebelumnya berbeda dengan kode kelas di semestr sekarang.</b>
                  </li>
                  <li>
                    Kode kelas seperti <span class="badge text-sm">7.A</span>, <span class="badge text-sm">7-A</span>, <span class="badge text-sm">7 A</span>, <span class="badge text-sm">7_A</span> atau <span class="badge text-sm">7A</span> akan dianggap sama
                  </li>
                </ul>
              </span>
              <div class="col-12 text-end">
                <button type="button" data-bs-toggle="modal" data-bs-target="#beforeModal" class="btn btn-info shadow-sm me-2 text-white">
                    <svg class="icon-20 me-1" width="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg> Lihat Jabatan Sebelumnya
                </button>
                <button type="submit" form="editjabatan" id="submit" class="btn btn-primary shadow-sm"><svg class="icon-20 me-1" width="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg><span class="d-none d-sm-inline-block ms-1">Simpan</span></button>
              </div>
            </div>
          </div>
          <?= form_open('dataguru/saveJabatan', array('id' => 'editjabatan'), array('id_guru' => $guru->id_guru)) ?>
          <div class="card bg-white shadow-sm mb-4">
            <div class="card-body">
              <div class="row">
                <?php
                //var_dump($guru);
                $jmapelval = $guru->mapel_kelas;
                $jks = [];
                if ($jmapelval != null && (is_array($jmapelval) || is_object($jmapelval))) {
                  foreach ($jmapelval as $key => $val) {
                    $val = is_array($val) ? (object)$val : $val;
                    if (isset($val->id_mapel)) {
                      $jks[] = $val->id_mapel;
                    }
                  }
                }

                $jekstraval = $guru->ekstra_kelas;
                $jke = [];
                if ($jekstraval != null && (is_array($jekstraval) || is_object($jekstraval))) {
                  foreach ($jekstraval as $key => $val) {
                    $val = is_array($val) ? (object)$val : $val;
                    if (isset($val->id_ekstra)) {
                      $jke[] = $val->id_ekstra;
                    }
                  }
                }
                ?>
                <div class="col-md-6">
                  <div class="card card-light border border-light">
                    <div class="card-header d-flex justify-content-between align-items-center">
  <div class="header-title">
    <h5 class="card-title mb-0 fw-bold d-flex align-items-center">
    <svg class="icon-24 text-primary me-2" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
</h5>
  </div>
  <div class="card-tools d-flex gap-2"><span class="card-title text-bold">Mengajar</span></div>
</div>
                    <div class="card-body">
                      <div class="row mb-4">
                        <label>Mata Pelajaran:</label>
                        <?php
                        echo form_dropdown(
                          'mapel[]',
                          $mapels,
                          $jks,
                          'id="mapel" class="select2 form-control form-control-sm" multiple="multiple" data-placeholder="Pilih Mapel"'
                        ); ?>

                      </div>
                      <div class="row" id="input-ekstra">
                        <label>Ekstrakurikuler:</label>
                        <?php
                        echo form_dropdown(
                          'ekstra[]',
                          $ekskul,
                          $jke,
                          'id="ekstra" class="select2 form-control form-control-sm" multiple="multiple" data-placeholder="Pilih Ekstrakurikuler"'
                        ); ?>
                      </div>
                    </div>
                  </div>
                  <div class="card card-light border border-light">
                    <div class="card-header d-flex justify-content-between align-items-center">
  <div class="header-title">
    <h5 class="card-title mb-0 fw-bold d-flex align-items-center">
    <svg class="icon-24 text-primary me-2" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
</h5>
  </div>
  <div class="card-tools d-flex gap-2"><span id="keterangan"
                         class="card-title text-bold">Tentukan Kelas Mapel</span></div>
</div>
                    <div class="card-body" id="input-mapel"></div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="card card-light border border-light">
                    <div class="card-header d-flex justify-content-between align-items-center">
  <div class="header-title">
    <h5 class="card-title mb-0 fw-bold d-flex align-items-center">
    <svg class="icon-24 text-primary me-2" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
</h5>
  </div>
  <div class="card-tools d-flex gap-2"><span id="keterangan" class="card-title text-bold">Jabatan</span>
                      <button type="button" data-bs-toggle="modal" data-bs-target="#createJabatanModal"
                          class="btn btn-primary shadow-sm"><svg class="icon-20 me-1" width="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                      </button></div>
</div>
                    <div class="card-body" id="input-jabatan">
                      <div class="row mb-4">
                        <label>Jabatan Utama</label>
                        <?php
                        echo form_dropdown(
                          'level',
                          $levels,
                          $guru->id_level,
                          'id="level" class="form-control form-control-sm" required'
                        ); ?>
                      </div>
                      <?php if (\Config\Database::connect()->fieldExists('jabatan_tambahan', 'jabatan_guru')): ?>
                      <div class="row mb-4">
                        <label>Jabatan Tambahan</label>
                        <?php
                        // Parse jabatan_tambahan value (e.g. "1,4")
                        $jabTambahan = isset($guru->jabatan_tambahan) && $guru->jabatan_tambahan ? explode(',', $guru->jabatan_tambahan) : [];
                        echo form_dropdown(
                          'jabatan_tambahan[]',
                          $levels,
                          $jabTambahan,
                          'id="jabatan_tambahan" class="select2 form-control form-control-sm" multiple="multiple" data-placeholder="Pilih Jabatan Tambahan"'
                        ); ?>
                      </div>
                      <?php endif; ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?= form_close(); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?= form_open('dataguru/saveJabatan', array('id' => 'copyjabatan'), array('id_guru' => $guru->id_guru, 'copy' => 'copy')) ?>
<div class="modal fade" id="beforeModal" tabindex="-1" role="dialog" aria-labelledby="beforeModalLabel"
   aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="beforeModalLabel">Jabatan Sebelumnya</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div>
          <?php if (isset($before)) :
          $kls_lalu = $before['kelass'] ?? [];
          $guru2 = $before['guru'] ?? [];
          if ($guru2->mapel_kelas != null || $guru2->ekstra_kelas != null):
            $jks2 = [];
            $jke2 = [];
            ?>
            <div class="d-none">
              <?php
              foreach ($guru2->mapel_kelas as $val) {
                array_push($jks2, $val->id_mapel);

                $idklsm = [];
                foreach ($val->kelas_mapel as $ids) {
                  array_push($idklsm, $ids->kelas);
                }

                echo form_dropdown(
                  'kelasmapel' . $val->id_mapel . '[]',
                  $kls_lalu,
                  $idklsm,
                  'class="guru2 select2 form-control form-control-sm" multiple="multiple"'
                );
                echo '<input type="hidden" name="nama_mapel' . $val->id_mapel . '" value="' . $val->nama_mapel . '">';
              }
              foreach ($guru2->ekstra_kelas as $val) {
                array_push($jke2, $val->id_ekstra);

                $idklse = [];
                foreach ($val->kelas_ekstra as $ids) {
                  array_push($idklse, $ids->kelas);
                }

                echo form_dropdown(
                  'kelasekstra' . $val->id_ekstra . '[]',
                  $kls_lalu,
                  $idklse,
                  'class="guru2 select2 form-control form-control-sm" multiple="multiple"'
                );
                echo '<input type="hidden" name="nama_ekstra' . $val->id_ekstra . '" value="' . $val->nama_ekstra . '">';
              }
              echo form_dropdown(
                'mapel[]',
                $mapels,
                $jks2,
                'class="guru2 select2 form-control form-control-sm" multiple="multiple"'
              );
              echo form_dropdown(
                'ekstra[]',
                $ekskul,
                $jke2,
                'class="guru2 select2 form-control form-control-sm" multiple="multiple"'
              );
              echo form_dropdown(
                'level',
                $levels,
                $guru2->id_level,
                'class="guru2 select2 form-control form-control-sm"'
              );
              echo form_dropdown(
                'kelas_wali',
                $kls_lalu,
                $guru2->id_kelas,
                'class="guru2 select2 form-control form-control-sm"'
              );
              ?>
            </div>
            <span>Jabatan:</span>
            <br>
            <span class="text-lg"><?= $levels[$guru2->id_level] ?></span>
            <br>
            <br>
            <span>Pengampu:</span>
            <table class="table table-bordered table-bordered">
              <tr>
                <th class="text-center">No.</th>
                <th>Mata Pelajaran</th>
                <th class="text-center">Kelas</th>
              </tr>
              <?php
              $nn = 1;
              foreach ($guru2->mapel_kelas as $mapel) :
                $all_kelas_mapel = $mapel->kelas_mapel;
                $kls_guru_mapel = '';
                foreach ($all_kelas_mapel as $kls_mpl) {
                  if (isset($kls_lalu[$kls_mpl->kelas])) $kls_guru_mapel .= '<span class="badge text-bg-primary border">' . $kls_lalu[$kls_mpl->kelas] . '</span> ';
                }
                ?>
                <tr>
                  <td class="text-center"><?= $nn ?></td>
                  <td><?= $mapel->nama_mapel ?></td>
                  <td class="text-center">
                    <?= $kls_guru_mapel ?>
                  </td>
                </tr>
                <?php $nn++; endforeach; ?>
              <?php
              foreach ($guru2->ekstra_kelas as $ekstra) :
                $all_kelas_ekstra = $ekstra->kelas_ekstra;
                $kls_guru_ekstra = '';
                foreach ($all_kelas_ekstra as $kls_eks) {
                  if (isset($kls_lalu[$kls_eks->kelas])) $kls_guru_ekstra .= '<span class="badge text-bg-primary border">' . $kls_lalu[$kls_eks->kelas] . '</span> ';
                }
                ?>
                <tr>
                  <td class="text-center align-middle"><?= $nn ?></td>
                  <td class="align-middle"><?= $ekstra->nama_ekstra ?></td>
                  <td class="text-center align-middle">
                    <?= $kls_guru_ekstra ?>
                  </td>
                </tr>
                <?php $nn++; endforeach; ?>
            </table>
          <?php else: ?>
            <div class="alert alert-danger shadow" role="alert">
              Tidak ada jabatan sebelumnya
            </div>
          <?php endif; ?>
          <?php else: ?>
            <div class="alert alert-danger" role="alert">
              Tidak ada jabatan sebelumnya
            </div>
          <?php endif; ?>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary shadow-sm float-end" data-bs-dismiss="modal">Batal</button>
        <?php if ($guru2->mapel_kelas != null || $guru2->ekstra_kelas != null): ?>
        <button type="submit" class="btn btn-success shadow-sm float-end">
          <i class="fa fa-copy"></i> Copy
        </button>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>
<?= form_close(); ?>

<?= form_open('dataguru/addJabatan', array('id' => 'create')) ?>
<div class="modal fade" id="createJabatanModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
   aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createModalLabel">Level <b>Jabatan</b></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="alert border border-danger alert-warning">
          Nomor 1 sampai 5 <b>jangan diubah dan jangan diganti</b>.
        </div>
        <div class="row mb-2">
          <div class="col-12">
            <button type="button" class="btn btn-info shadow-sm add-new float-end"><svg class="icon-20 me-1" width="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg> Tambah</button>
          </div>
        </div>
        <div class="table-responsive" id="table-editable">
          <table class="table table-bordered w-100">
            <thead>
            <tr>
              <th class="text-center align-middle" style="width: 80px">No</th>
              <th class="align-middle">Jabatan</th>
              <th class="text-center align-middle">Aksi</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($levels as $id=>$level) :
              $btn_dis = $id <= 5 ? 'btn-disabled' : '';
              $dis = $id <= 5 ? 'disabled' : '';
              if ($id != ''):?>
                <tr>
                  <td class="text-center align-middle p-1 id-level"><?=$id?></td>
                  <td class="align-middle p-1"><?=$level?></td>
                  <td class="text-center align-middle p-1">
                    <button type="button" class="add btn <?=$btn_dis?>" title="Add" style="display: none;" <?=$dis?>><svg class="icon-20 me-1" width="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg></button>
                    <button type="button" class="edit btn <?=$btn_dis?>" title="Edit" <?=$dis?>><svg class="icon-20 me-1" width="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></button>
                    <button type="button" class="delete btn <?=$btn_dis?>" title="Delete" <?=$dis?>><svg class="icon-20 me-1" width="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg></button>
                  </td>
                </tr>
              <?php endif; endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary shadow-sm " data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
<?= form_close() ?>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script type="text/javascript">
  const guru_id = '<?=$guru->id_guru?>';
  const kelas_id = '<?=$guru->id_kelas?>';
  const level_id = '<?=$guru->id_level?>';
  const mapel_guru_raw = <?= !empty($guru->mapel_kelas) ? json_encode($guru->mapel_kelas) : '[]' ?>;
  const ekstra_guru_raw = <?= !empty($guru->ekstra_kelas) ? json_encode($guru->ekstra_kelas) : '[]' ?>;
  const guru_before = JSON.parse('<?= str_replace("'", "\'", json_encode($guru2 ?? '[]')) ?>');

  let kelas;
  const mapelObj = [];
  let mapelGuru;
  const ekstraObj = [];
  let ekstraGuru;
  let mapelTerisi, ekstraTerisi, jabatanTerisi;
  let changed = false;
  $(document).ready(function(){
    const actions = '<button type="button" class="add btn"><svg class="icon-20 me-1" width="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg></button>' +
      '<button type="button" class="edit btn"><svg class="icon-20 me-1" width="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></button>' +
      '<button type="button" class="delete btn"><svg class="icon-20 me-1" width="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg></button>';
    //$("#table-editable td:last-child").html();

    // Append table with add row form on add new button click
    $(".add-new").click(function(){
      $(this).attr("disabled", "disabled");
      const index = $("#table-editable table tbody tr:last-child").index();
      const valId = $("#table-editable table tbody tr").eq(index).find('.id-level').text();
      const newId = Number(valId) + 1;
      const row = '<tr>' +
        '<td class="text-center align-middle p-1 id-level">' +
        '<input type="number" class="form-control" name="id_level" value="' + newId + '" readonly>' +
        '</td>' +
        '<td class="align-middle p-1">' +
        '<input type="text" class="form-control" name="level">' +
        '</td>' +
        '<td class="text-center align-middle p-1">' + actions + '</td>' +
        '</tr>';
      $("#table-editable table").append(row);
      $("#table-editable table tbody tr").eq(index + 1).find(".edit").toggle();
    });
    // Add row on add button click
    $(document).on("click", ".add", function(){
      let empty = false;
      const input = $(this).parents("tr").find('input');
      input.each(function(){
        if(!$(this).val()){
          $(this).addClass("error");
          empty = true;
        } else{
          $(this).removeClass("error");
        }
      });
      $(this).parents("tr").find(".error").first().focus();
      if(!empty){
        let spost = '&mode=1';
        input.each(function(ind, v){
          if (ind === 0) {
            spost += '&id_level='+$(this).val();
          } else {
            spost += '&level='+$(this).val();
          }
          $(this).parent("td").html($(this).val());
        });
        $(this).parents("tr").find(".add, .edit").toggle();
        sendJabatan(spost);
      }
    });
    // Edit row on edit button click
    $(document).on("click", ".edit", function(){
      $(this).parents("tr").find("td:not(:last-child)").each(function(ind, v){
        if (ind === 0) {
          $(this).html('<input type="number" class="form-control" value="' + $(this).text() + '" readonly>');
        } else {
          $(this).html('<input type="text" class="form-control" value="' + $(this).text() + '">');
        }
      });
      $(this).parents("tr").find(".add, .edit").toggle();
      $(".add-new").attr("disabled", "disabled");
    });
    // Delete row on delete button click
    $(document).on("click", ".delete", function(){
      $(this).parents("tr").remove();
      const sid = $(this).parents("tr").eq(0).find('.id-level').text();
      sendJabatan('&mode=2&id_level='+sid);
    });

    $("#createJabatanModal").on("hidden.bs.modal", function () {
      if (changed) window.location.reload();
    });

    $('#mapel').select2();
    $('#level').select2();
    $('#jabatan_tambahan').select2();
    $('#ekstra').select2();
    $('.guru2').select2();

    $.ajax({
      url: base_url + "dataguru/getDataKelas",
      type: "GET",
      success: function (data) {
        console.log('kelas', data);
        mapelTerisi = data.mpl_terisi || {};
        ekstraTerisi = data.eks_terisi || {};
        jabatanTerisi = data.jabatan || {};
        kelas = data.kelas || [];
        kelas.sort(sortByKode);
        kelas.sort(sortByLevel);

        createDropdownKelasMapel();
        createDropdownKelasEkstra();
        createDropdownKelasWali();
      }, error: function (xhr, status, error) {
        console.log(xhr.responseText);
        showDangerToast('Data error.');
      }
    });

    $('form input, form select').on('change', function () {
      $(this).closest('.form-group').removeClass('has-error');
      $(this).nextAll('.help-block').eq(0).text('');
    });

    $('form#editjabatan').on('submit', function (e) {
      e.preventDefault();
      e.stopImmediatePropagation();

      let btn = $('#btn-jabatan');
      btn.attr('disabled', 'disabled').text('Process...');
      //console.log($(this).serialize());
      $.ajax({
        url: $(this).attr('action'),
        data: $(this).serialize(),
        type: 'POST',
        success: function (response) {
          console.log(response);
          swal.fire({
            "title": response.status ? "Berhasil" : "Gagal",
            "text": response.msg,
            "icon": response.status ? "success" : "error"
          }).then(result => {
            window.location.href = base_url+'dataguru';
          });
          btn.removeAttr('disabled').text('Simpan');
        },
        error: function (xhr, error, status) {
          console.log(xhr.responseText);
        }
      });
    });

    $('#mapel').on('select2:select', function (e) {
      const data = e.params.data;
      mapelObj.push(data);

      const inputgroup = $('#input-mapel');

      const div1 = $('<div>', {class: "row mb-4 addmapel", id: "mapel-box-" + data.id});
      const hiden = $('<input>', {type: "hidden", name: "nama_mapel" + data.id, value: data.text});
      hiden.appendTo(div1);

      const spangroup = $('<label>', {class: "fw-bold mb-1 text-primary", text: data.text});
      const sel = $('<select>', {
        id: "kelasmapel" + data.id, name: "kelasmapel" + data.id + "[]", "class": "select2 form-control selectmapel",
        multiple: 'multiple'
      });

      div1.append(spangroup);
      div1.append(sel);
      div1.appendTo(inputgroup);

      if (kelas.length === 0) {
        sel.append($('<option></option>')
          .attr('value', '')
          .attr('disabled', true)
          .text('Belum ada kelas'));
      }
      $.each(kelas, function (key, entry) {
        const terisi = [];
        if (mapelTerisi && mapelTerisi[data.id]) {
          $.each(mapelTerisi[data.id], function (idg, valg) {
            const ada = String(guru_id) !== String(idg) && inArrayKelas(entry.id_kelas, valg['kelas']);
            const mengisi = ada ? ' - - ( ' + valg['guru'] + ' )' : '';
            if (ada) {
              terisi.push({ada: ada, kelas: entry.id_kelas, guru: mengisi});
            }
          });
        }
        const adaGuru = terisi.length > 0 ? terisi[0].guru : '';
        sel.append($('<option></option>')
          .attr('value', entry.id_kelas)
          .attr('disabled', terisi.length > 0)
          .text(entry.nama_kelas + adaGuru));
      });

      const selectedMapel = [];
      $.each(mapelGuru, function (keym, entrym) {
        if (String(entrym.id_mapel) === String(data.id) && entrym.kelas_mapel) {
          $.each(entrym.kelas_mapel, function (k, en) {
            selectedMapel.push(en.kelas);
          });
        }
      });
      $('#kelasmapel' + data.id).val(selectedMapel);
      $('#kelasmapel' + data.id).select2({width: '100%', placeholder: 'Pilih Kelas'});
    });

    $('#mapel').on('select2:unselect', function (e) {
      const data = e.params.data;
      for (let i = 0; i < mapelObj.length; i++) {
        if (mapelObj[i].id && String(mapelObj[i].id) === String(data.id)) {
          mapelObj.splice(i, 1);
          break;
        }
      }
      $("#mapel-box-" + data.id).remove();
    });

    $('#ekstra').on('select2:select', function (e) {
      const data = e.params.data;
      ekstraObj.push(data);

      const inputgroup = $('#input-mapel');

      const div1 = $('<div>', {class: "row mb-4 addekstra", id: "ekstra-box-" + data.id});
      const hiden = $('<input>', {type: "hidden", name: "nama_ekstra" + data.id, value: data.text});
      hiden.appendTo(div1);

      const spangroup = $('<label>', {class: "fw-bold mb-1 text-info", text: data.text + ' (Ekstrakurikuler)'});
      const sel = $('<select>', {
        id: "kelasekstra" + data.id,
        name: "kelasekstra" + data.id + "[]",
        "class": "select2 form-control selectekstra",
        multiple: 'multiple'
      });

      div1.append(spangroup);
      div1.append(sel);
      div1.appendTo(inputgroup);

      if (kelas.length === 0) {
        sel.append($('<option></option>')
          .attr('value', '')
          .attr('disabled', true)
          .text('Belum ada kelas'));
      }
      $.each(kelas, function (key, entry) {
        const terisi = [];
        if (ekstraTerisi && ekstraTerisi[data.id]) {
          $.each(ekstraTerisi[data.id], function (idg, valg) {
            const ada = String(guru_id) !== String(idg) && inArrayKelas(entry.id_kelas, valg['kelas']);
            const mengisi = ada ? ' - - ( ' + valg['guru'] + ' )' : '';
            if (ada) {
              terisi.push({ada: ada, kelas: entry.id_kelas, guru: mengisi});
            }
          });
        }
        const adaGuru = terisi.length > 0 ? terisi[0].guru : '';
        sel.append($('<option></option>')
          .attr('disabled', terisi.length > 0)
          .attr('value', entry.id_kelas)
          .text(entry.nama_kelas + adaGuru));
      });

      const selectedEkstra = [];
      $.each(ekstraGuru, function (keym, entrym) {
        if (String(entrym.id_ekstra) === String(data.id) && entrym.kelas_ekstra) {
          $.each(entrym.kelas_ekstra, function (k, en) {
            selectedEkstra.push(en.kelas);
          });
        }
      });
      $('#kelasekstra' + data.id).val(selectedEkstra);
      $('#kelasekstra' + data.id).select2({width: '100%', placeholder: 'Pilih Kelas'});
    });

    $('#ekstra').on('select2:unselect', function (e) {
      const data = e.params.data;
      for (let i = 0; i < ekstraObj.length; i++) {
        if (ekstraObj[i].id && String(ekstraObj[i].id) === String(data.id)) {
          ekstraObj.splice(i, 1);
          break;
        }
      }
      $("#ekstra-box-" + data.id).remove();
    });

    $('#kelas-wali').select2({
      dropdownAutoWidth : true,
      width: 'auto'
    });

    $('#level').on('change select2:select', function (e) {
      createDropdownKelasWali();
    });

    $('#copyjabatan').on('submit', function (e) {
      e.preventDefault();
      e.stopImmediatePropagation();
      $('#beforeModal').modal('hide');

      console.log($(this).serialize());
      $.ajax({
        url: $(this).attr('action'),
        data: $(this).serialize(),
        type: 'POST',
        success: function (response) {
          console.log(response);
          swal.fire({
            "title": response.status ? "Berhasil" : "Gagal",
            "text": response.msg,
            "icon": response.status ? "success" : "error"
          }).then(result => {
            window.location.reload();
          });
        },
        error: function (xhr, error, status) {
          console.log(xhr.responseText);
        }
      });
    });

  });

  function inArrayKelas(val, array) {
    if (!array || !Array.isArray(array)) return false;
    return array.some(function(item) {
      return String(item) === String(val);
    });
  }

  function submitajax(url, data, msg, btn) {
    $.ajax({
      url: url,
      data: data,
      type: 'POST',
      success: function (response) {
        if (response.status) {
          swal.fire({
            "title": "Berhasil",
            "text": msg,
            "type": "success"
          });
        } else {
          if (response.errors) {
            $.each(response.errors, function (key, val) {
              $('[name="' + key + '"]').closest('.form-group').addClass('has-error');
              $('[name="' + key + '"]').nextAll('.help-block').eq(0).text(val);
              if (val === '') {
                $('[name="' + key + '"]').closest('.form-group').removeClass('has-error');
                $('[name="' + key + '"]').nextAll('.help-block').eq(0).text('');
              }
            });
          }
          if (response.msg) {
            swal.fire({
              "title": "Gagal",
              "text": "Password lama tidak benar",
              "type": "error"
            });
          }
        }
        btn.removeAttr('disabled').text('Ganti Password');
      }
    });
  }

  function createDropdownKelasWali() {
    const curLevel = $('#level').val() || level_id;
    if (String(curLevel) === "4") {
      $('#input-group-walikelas').remove();
      const inputgroup = $('#input-jabatan');

      const div1 = $('<div>', {class: "row mb-4 addkelas", id: "input-group-walikelas"});
      const spangroup = $('<label>', {class: "fw-bold mb-1 text-primary", text: "Kelas Binaan (Wali Kelas)"});
      const sel = $('<select>', {
        name: "kelas_wali",
        id: "kelas_wali",
        "class": "select2 form-control selectkelas"
      });
      div1.append(spangroup);
      div1.append(sel);
      div1.appendTo(inputgroup);

      sel.append($('<option value="" disabled ' + (!kelas_id || kelas_id === '0' ? 'selected' : '') + '>-- Pilih Kelas --</option>'));
      if (kelas && Array.isArray(kelas)) {
        $.each(kelas, function (key, entry) {
          let nguru = '';
          let isSelected = String(entry.id_kelas) === String(kelas_id);
          if (jabatanTerisi && jabatanTerisi[4] !== undefined && jabatanTerisi[4][entry.id_kelas] !== undefined) {
            const idg = jabatanTerisi[4][entry.id_kelas].id;
            if (String(guru_id) !== String(idg)) {
              nguru = ' - - ( ' + jabatanTerisi[4][entry.id_kelas].nama + ' )';
            }
          }
          const disabl = (nguru !== '' && !isSelected) ? 'disabled="disabled"' : '';
          const selAttr = isSelected ? 'selected="selected"' : '';
          sel.append($('<option value="' + entry.id_kelas + '" ' + selAttr + ' ' + disabl + '>' + entry.nama_kelas + nguru + '</option>'));
        });
      }

      $("#kelas_wali").select2({width: '100%'});
    } else {
      $("#input-group-walikelas").remove();
    }
  }

  function createDropdownKelasMapel() {
    mapelGuru = Array.isArray(mapel_guru_raw) ? mapel_guru_raw : (typeof mapel_guru_raw === 'string' ? JSON.parse(mapel_guru_raw || '[]') : []);

    const inputgroup = $('#input-mapel');

    console.log('mpl', mapelGuru);
    $.each(mapelGuru, function (keym, entrym) {
      const div1 = $('<div>', {class: "row mb-4 addmapel", id: "mapel-box-" + entrym.id_mapel});
      const hiden = $('<input>', {type: "hidden", name: "nama_mapel" + entrym.id_mapel, value: entrym.nama_mapel});
      hiden.appendTo(div1);

      const spangroup = $('<label>', {class: "fw-bold mb-1 text-primary", text: entrym.nama_mapel});
      const sel = $('<select>', {
        id: "kelasmapel" + entrym.id_mapel,
        name: "kelasmapel" + entrym.id_mapel + "[]",
        "class": "select2 form-control selectmapel",
        multiple: 'multiple'
      });

      div1.append(spangroup);
      div1.append(sel);
      div1.appendTo(inputgroup);

      if (kelas.length === 0) {
        sel.append($('<option></option>')
          .attr('value', '')
          .attr('disabled', true)
          .text('Belum ada kelas'));
      }
      $.each(kelas, function (key, entry) {
        const terisi = [];
        if (mapelTerisi && mapelTerisi[entrym.id_mapel]) {
          $.each(mapelTerisi[entrym.id_mapel], function (idg, valg) {
            const ada = String(guru_id) !== String(idg) && inArrayKelas(entry.id_kelas, valg['kelas']);
            const mengisi = ada ? ' - - ( ' + valg['guru'] + ' )' : '';
            if (ada) {
              terisi.push({ada: ada, kelas: entry.id_kelas, guru: mengisi});
            }
          });
        }
        const adaGuru = terisi.length > 0 ? terisi[0].guru : '';
        sel.append($('<option></option>')
          .attr('value', entry.id_kelas)
          .attr('disabled', terisi.length > 0)
          .text(entry.nama_kelas + adaGuru));
      });

      const item = {};
      item ["id"] = entrym.id_mapel;
      mapelObj.push(item);

      const selectedMapel = [];
      if (entrym.kelas_mapel && Array.isArray(entrym.kelas_mapel)) {
        $.each(entrym.kelas_mapel, function (k, en) {
          selectedMapel.push(en.kelas);
        });
      }
      $('#kelasmapel' + entrym.id_mapel).val(selectedMapel);
      $('#kelasmapel' + entrym.id_mapel).select2({width: '100%', placeholder: 'Pilih Kelas'});
    });
  }

  function createDropdownKelasEkstra() {
    ekstraGuru = Array.isArray(ekstra_guru_raw) ? ekstra_guru_raw : (typeof ekstra_guru_raw === 'string' ? JSON.parse(ekstra_guru_raw || '[]') : []);

    const inputgroup = $('#input-mapel');

    $.each(ekstraGuru, function (keym, entrym) {
      const div1 = $('<div>', {class: "row mb-4 addekstra", id: "ekstra-box-" + entrym.id_ekstra});
      const hiden = $('<input>', {type: "hidden", name: "nama_ekstra" + entrym.id_ekstra, value: entrym.nama_ekstra});
      hiden.appendTo(div1);

      const spangroup = $('<label>', {class: "fw-bold mb-1 text-info", text: entrym.nama_ekstra + ' (Ekstrakurikuler)'});
      const sel = $('<select>', {
        id: "kelasekstra" + entrym.id_ekstra,
        name: "kelasekstra" + entrym.id_ekstra + "[]",
        "class": "select2 form-control selectekstra",
        multiple: 'multiple'
      });

      div1.append(spangroup);
      div1.append(sel);
      div1.appendTo(inputgroup);

      if (kelas.length === 0) {
        sel.append($('<option></option>')
          .attr('value', '')
          .attr('disabled', true)
          .text('Belum ada kelas'));
      }
      $.each(kelas, function (key, entry) {
        const terisi = [];
        if (ekstraTerisi && ekstraTerisi[entrym.id_ekstra]) {
          $.each(ekstraTerisi[entrym.id_ekstra], function (idg, valg) {
            const ada = String(guru_id) !== String(idg) && inArrayKelas(entry.id_kelas, valg['kelas']);
            const mengisi = ada ? ' - - ( ' + valg['guru'] + ' )' : '';
            if (ada) {
              terisi.push({ada: ada, kelas: entry.id_kelas, guru: mengisi});
            }
          });
        }
        const adaGuru = terisi.length > 0 ? terisi[0].guru : '';
        sel.append($('<option></option>')
          .attr('disabled', terisi.length > 0)
          .attr('value', entry.id_kelas)
          .text(entry.nama_kelas + adaGuru));
      });

      const item = {};
      item ["id"] = entrym.id_ekstra;
      ekstraObj.push(item);

      const selectedEkstra = [];
      if (entrym.kelas_ekstra && Array.isArray(entrym.kelas_ekstra)) {
        $.each(entrym.kelas_ekstra, function (k, en) {
          selectedEkstra.push(en.kelas);
        });
      }
      $('#kelasekstra' + entrym.id_ekstra).val(selectedEkstra);
      $('#kelasekstra' + entrym.id_ekstra).select2({width: '100%', placeholder: 'Pilih Kelas'});
    });
  }

  function sortByLevel(a, b){
    const aID = a.level_id != null ? String(a.level_id).toLowerCase() : '';
    const bID = b.level_id != null ? String(b.level_id).toLowerCase() : '';
    return ((aID < bID) ? -1 : ((aID > bID) ? 1 : 0));
  }

  function sortByKode(a, b){
    const aID = a.nama_kelas != null ? String(a.nama_kelas).toLowerCase() : '';
    const bID = b.nama_kelas != null ? String(b.nama_kelas).toLowerCase() : '';
    return ((aID < bID) ? -1 : ((aID > bID) ? 1 : 0));
  }

  function sendJabatan(data) {
    $(".add-new").html('<i class="spinner-border spinner-border-sm"></i> Saving');
    console.log($('#create').serialize() + data);
    $.ajax({
      url: $('#create').attr('action'),
      data: $('#create').serialize() + data,
      type: 'POST',
      success: function (response) {
        console.log(response);
        $(".add-new").removeAttr("disabled");
        $(".add-new").html('<svg class="icon-20 me-1" width="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg> Tambah');
        if (response.success) {
          changed = true;
          showSuccessToast(response.msg);
        } else {
          showDangerToast(response.msg);
        }
      },
      error: function (xhr, error, status) {
        console.log(xhr.responseText);
        showDangerToast(xhr.responseText);
      }
    });
  }
</script>


<?= $this->endSection() ?>


