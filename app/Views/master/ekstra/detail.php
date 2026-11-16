<?= $this->extend('layout/dashboard_template_bs5') ?>
<?= $this->section('content') ?>

<div class="row">
    <div class="col-sm-12">
        <div class="card mb-4">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between w-100">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <a href="<?= base_url('dataekstra') ?>" class="btn btn-outline-secondary btn-sm me-2"><i class="fa fa-arrow-left"></i> Kembali</a>
                        </div>
                        <div>
                            <h4 class="card-title mb-1 fw-bold">
                                <?= $judul ?> - <?= esc($ekstra->nama_ekstra ?? '') ?>
                            </h4>
                            <p class="text-muted mb-0" style="font-size: 0.9rem;">Kode: <?= esc($ekstra->kode_ekstra ?? '') ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid p-0">
                <div class="card my-shadow mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-bordered">
                                    <tr>
                                        <th style="width: 200px;">Nama Ekstrakurikuler</th>
                                        <td><?= esc($ekstra->nama_ekstra ?? '-') ?></td>
                                    </tr>
                                    <tr>
                                        <th>Kode</th>
                                        <td><?= esc($ekstra->kode_ekstra ?? '-') ?></td>
                                    </tr>
                                    <tr>
                                        <th>Mapel Agama</th>
                                        <td><?= ($ekstra->mapel_agama ?? '0') === '1' ? '<span class="badge bg-info">Ya</span>' : '<span class="badge bg-secondary">Bukan</span>' ?></td>
                                    </tr>
                                    <tr>
                                        <th>Kelas Gabungan</th>
                                        <td><?= ($ekstra->mapel_gabungan ?? '0') === '1' ? '<span class="badge bg-primary">Ya</span>' : '<span class="badge bg-secondary">Tidak</span>' ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<?= $this->endSection() ?>
