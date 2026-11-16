<?= $this->extend('layout/dashboard_template_bs5') ?>
<?= $this->section('content') ?>
<div class="d-contents">
    <div class="d-contents">
    <div class="card mb-4">
      <div class="card-body">
        <div class="d-flex align-items-center">
          <div class="me-3 flex-shrink-0">
            <div class="rounded-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 60px; height: 60px; background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%); color: #ffffff;">
              <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"></circle>
                <polyline points="12 6 12 12 16 14"></polyline>
              </svg>
            </div>
          </div>
          <div>
            <h4 class="card-title mb-1 fw-bold d-flex align-items-center">
                <?= $judul ?> - Edit Sesi Ujian
            </h4>
            <p class="text-muted mb-0" style="font-size: 0.9rem;">Penyuntingan alokasi nama, waktu mulai, dan waktu selesai sesi pelaksanaan ujian.</p>
          </div>
        </div>
      </div>
    </div>
</div></div></div>


    <div>
        <div class="container-fluid">
            <div class="row">
                <?php
                var_dump($sesi->nama_sesi);
                ?>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

