<?= $this->extend('layout/dashboard_template_bs5') ?>
<?= $this->section('content') ?>
<div class="d-contents">
    <div class="card mb-4">
      <div class="card-body">
        <div class="d-flex align-items-center">
          <div class="me-3 flex-shrink-0">
            <div class="rounded-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 60px; height: 60px; background: linear-gradient(135deg, #4f46e5 0%, #3730a3 100%); color: #ffffff;">
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
            <p class="text-muted mb-0" style="font-size: 0.9rem;"><?= $subjudul ?? 'Struktur Organisasi Kelas' ?></p>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card shadow-sm border-0 mb-4">
                <?= form_open('', array('id' => 'create')) ?>
                <div class="card-header bg-primary text-white py-3 d-flex justify-content-between align-items-center">
                    <h6 class="card-title text-white mb-0 fw-bold"><i class="fas fa-sitemap me-2"></i><?= $subjudul ?></h6>
                    <button type="submit" class="btn btn-light text-primary px-3 py-1 shadow-sm fw-bold btn-sm">
                        <i class="fa fa-save me-1"></i>Simpan Struktur
                    </button>
                </div>
                <div class="card-body">
                    <div class="row">
                        <input type="hidden" name="id_kelas" value="<?= $id_kelas ?>">
                        <?php
                        $inputs = ['Ketua Kelas', 'Wakil Ketua', 'Sekretaris 1', 'Sekretaris 2',
                            'Bendahara 1', 'Bendahara 2', 'Sie Ekstrakurikuler', 'Sie Upacara', 'Sie Olahraga',
                            'Sie Keagamaan', 'Sie Keamanan', 'Sie Ketertiban', 'Sie Kebersihan', 'Sie Keindahan',
                            'Sie Kesehatan', 'Sie Kekeluargaan', 'Sie Humas'];
                        $ids = ['ketua', 'wakil_ketua', 'sekretaris_1', 'sekretaris_2', 'bendahara_1', 'bendahara_2', 'sie_ekstrakurikuler', 'sie_upacara', 'sie_olahraga', 'sie_keagamaan', 'sie_keamanan', 'sie_ketertiban', 'sie_kebersihan', 'sie_keindahan', 'sie_kesehatan', 'sie_kekeluargaan', 'sie_humas'];

                        //var_dump($struktur);
                        foreach ($ids as $key => $value) : ?>
                            <div class="col-md-6 mb-3">
                                <label><i class="far fa-user me-2"></i><?= $inputs[$key] ?></label>
                                <?php
                                echo form_dropdown(
                                    $value,
                                    $siswas,
                                    $struktur->$value,
                                    'id="' . $value . '" class="select2 form-control" data-placeholder="Pilih ' . $inputs[$key] . '" required'
                                ); ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?= form_close() ?>
            </div>
        </div>
    </section>
</div>

<?= $this->endSection() ?>
<?= $this->section('scripts') ?>
<script type="text/javascript">
    $(document).ready(function () {
        ajaxcsrf();

        $('.select2').select2({width: '100%', });

        $('#create').submit('click', function (e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            console.log("data:", $(this).serialize());
            $.ajax({
                url: base_url + "walistruktur/save",
                type: "POST",
                dataType: "JSON",
                data: $(this).serialize(),
                success: function (data) {
                    if (data) {
                        swal.fire({
                            title: "Sukses",
                            text: "Data berhasil disimpan",
                            icon: "success",
                            showCancelButton: false,
                        }).then(result => {
                            if (result.value) {
                                window.location.href = base_url + 'walistruktur';
                            }
                        });
                    } else {
                        swal.fire({
                            title: "ERROR",
                            text: "Data Tidak Tersimpan",
                            icon: "error",
                            showCancelButton: false,
                        });
                    }
                }, error: function (xhr, status, error) {
                    console.log("error", xhr.responseText);
                    swal.fire({
                        title: "ERROR",
                        text: "Data Tidak Tersimpan",
                        icon: "error",
                        showCancelButton: false,
                    });
                }
            });
        });

    });
</script>

<?= $this->endSection() ?>

