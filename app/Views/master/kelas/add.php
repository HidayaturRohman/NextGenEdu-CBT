<?= $this->extend('layout/dashboard_template_bs5') ?>
<?= $this->section('content') ?>
<?php
$jumlahSiswa = $kelas->jumlah_siswa ?? [];
if (is_string($jumlahSiswa)) {
    $unserialized = @unserialize($jumlahSiswa);
    $jumlahSiswa = $unserialized !== false ? $unserialized : [];
}
$jjs = [];
foreach ($jumlahSiswa as $js) {
    $jjs[] = is_array($js) ? $js['id'] : (is_object($js) ? $js->id : $js);
}
if (!empty($siswakelas)) {
    foreach ($siswakelas as $sk) {
        $skId = is_object($sk) ? ($sk->id_siswa ?? null) : ($sk['id_siswa'] ?? null);
        if ($skId && !in_array($skId, $jjs)) {
            $jjs[] = $skId;
        }
    }
}
?>

    <div class="row">
  <div class="col-sm-12">
    <div class="card mb-4">
      <div class="card-body">
        <div class="d-flex align-items-center justify-content-between w-100">
            <div class="d-flex align-items-center">
              <div class="me-3 flex-shrink-0">
                <div class="rounded-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 60px; height: 60px; background: linear-gradient(135deg, #06b6d4 0%, #0e7490 100%); color: #ffffff;">
                  <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M14 22v-4a2 2 0 0 0-2-2v0a2 2 0 0 0-2 2v4"></path>
                    <path d="M18 22V6l-6-4-6 4v16"></path>
                    <line x1="12" y1="11" x2="12" y2="17"></line>
                    <line x1="9" y1="14" x2="15" y2="14"></line>
                  </svg>
                </div>
              </div>
              <div>
                <h4 class="card-title mb-1 fw-bold d-flex align-items-center">
                    <?= $subjudul ?>
                </h4>
                <p class="text-muted mb-0" style="font-size: 0.9rem;">Formulir penambahan data rombongan belajar (rombel) baru dan penentuan wali kelas.</p>
              </div>
            </div>
            <div>
                <a href="<?= base_url('datakelas') ?>" type="button" class="btn btn-secondary shadow-sm float-end"><svg class="icon-20 me-1" width="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg><span class="d-none d-sm-inline-block ms-1">Kembali</span>
                    </a>
            </div>
        </div>
      </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <?= form_open('', array('id' => 'create')) ?>
            <div class="card ">
                <div class="card-header">
                    <div class="card-title">
                        <h6>Tambah Kelas</h6>
                    </div>
                    <div class="card-tools">
                        <button type="submit" class="btn btn-primary btn-sm">
                            <svg class="icon-20 me-1" width="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>Simpan
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <?php
                                if (isset($id_kelas)) echo form_hidden('id_kelas', $id_kelas);
                                ?>
                                <label for="nama_kelas" class="col-md-3 col-form-label">Nama Kelas</label>
                                <div class="col-md-9">
                                    <?php
                                    $siswas = [];
                                    if (isset($siswa)) {
                                        foreach ($siswa as $key => $row) {
                                            if ($row->id_kelas == null || $row->id_kelas == 0) {
                                                $siswas [$row->id_siswa] = $row->nama .' - '.$row->nis;
                                            }
                                        }
                                    }
                                    if (isset($siswakelas)) {
                                        foreach ($siswakelas as $key => $row) {
                                            $siswas [$row->id_siswa] = $row->nama .' - '.$row->nis;
                                        }
                                    }

                                    echo form_input(
                                        array(
                                            'name' => 'nama_kelas',
                                            'value' => $kelas->nama_kelas,
                                            'id' => 'nama_kelas',
                                            'type' => 'text',
                                            'class' => 'form-control',
                                            'placeholder' => 'Nama Kelas',
                                            'required' => 'required'
                                        )
                                    );
                                    //var_dump($siswas);
                                    ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 control-label">Kode Kelas</label>
                                <div class="col-md-9">
                                    <input type='text' name='kode_kelas' class='form-control'
                                           value="<?= $kelas->kode_kelas ?>" required/>
                                </div>
                            </div>
                            <?php if ($setting->jenjang == '3') : ?>
                                <div class="form-group row">
                                    <label for="jurusan_id" class="col-md-3 control-label">Jurusan</label>
                                    <div class="col-md-9">
                                        <?php
                                        echo form_dropdown(
                                            'jurusan_id',
                                            $jurusan,
                                            $kelas->jurusan_id,
                                            'class="select2 form-control" id="jurusan_id" required'
                                        );
                                        ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="level_id" class="col-md-3 control-label">Level</label>
                                <div class="col-md-9">
                                    <?php
                                    echo form_dropdown(
                                        'level_id',
                                        $level,
                                        $kelas->level_id,
                                        'class="select2 form-control"  id="level_id" required'
                                    );
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card border">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="jumlah_siswa" class="col-md-12 control-label">Daftar Siswa</label>
                                        <div class="col-md-12">
                                            <select name="siswa[]" class="form-control" id="jumlah_siswa" multiple="multiple" style="position: absolute; left: -9999px;">
                                            <?php foreach ($siswas as $id=>$siswa) :?>
                                            <option value="<?= $id ?>" <?= in_array($id, $jjs) ? 'selected="selected"' : '';?>><?=$siswa?></option>
                                            <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card border">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="siswa_id" class="control-label">Ketua Kelas</label>
                                        <?php
                                        echo form_dropdown(
                                            'siswa_id',
                                            $siswas,
                                            $kelas->siswa_id,
                                            'class="select2 form-control" id="siswa_id"'
                                        );
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?= form_close() ?>
        </div>
    </section>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    const arrAllSiswa = JSON.parse(JSON.stringify(<?= json_encode($siswas)?>));
    const arrSelSiswa = JSON.parse(JSON.stringify(<?= json_encode($jjs)?>));
    $(document).ready(function () {
        $("#guru_id option:first").attr('disabled', 'disabled');
        $("#jurusan_id option:first").attr('disabled', 'disabled');
        $("#level_id option:first").attr('disabled', 'disabled');
    });
</script>
<script src="<?= base_url() ?>/assets/app/js/master/kelas/add.js?v=<?= time() ?>"></script>

<?= $this->endSection() ?>
