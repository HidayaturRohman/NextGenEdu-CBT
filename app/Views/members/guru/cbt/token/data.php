<?= $this->extend('layout/dashboard_template_bs5') ?>
<?= $this->section('content') ?>
<div class="d-contents">
    <div class="card mb-4">
      <div class="card-body">
        <div class="d-flex align-items-center justify-content-between w-100">
            <div class="d-flex align-items-center">
              <div class="me-3">
                <svg class="icon-32 text-primary" width="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 2l-2 2m-7.61 7.61a5.5 5.5 0 1 1-7.778 7.778 5.5 5.5 0 0 1 7.777-7.777zm0 0L15.5 7.5m0 0l3 3L22 7l-3-3m-3.5 3.5L19 4"></path>
                </svg>
              </div>
              <div>
                <h4 class="card-title mb-1 fw-bold d-flex align-items-center">
                    <?= $judul ?>
                </h4>
                <p class="text-muted mb-0" style="font-size: 0.9rem;"><?= $subjudul ?? 'Token Ujian CBT' ?></p>
              </div>
            </div>
        </div>
      </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card shadow-sm mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="card-title mb-0"><?= $subjudul ?></h6>
                    <button class="btn btn-sm btn-default d-none card-tools" id="refresh-token"><i class="fa fa-refresh"></i> Refresh Token</button>
                </div>
                <div class="card-body">
                    <h6 class="text-center">TOKEN SAAT INI</h6>
                    <h1 class="text-center" id="token-view"><?= $token->token ?? '------' ?></h1>
                </div>
            </div>
        </div>
    </section>
</div>

<?= $this->endSection() ?>
<?= $this->section('scripts') ?>
<script>
    let timerTokenView;
    $(document).ready(function () {
        getToken(function (result) {
            getGlobalToken();
        });

        $('#refresh-token').click(function () {
            getToken(function (result) {
                getGlobalToken();
            });
        });
    });

    function getGlobalToken() {
        if (globalToken != null) {
            const viewToken = $('#token-view');
            if (viewToken.length) viewToken.text(globalToken.token);
            if (globalToken.auto == '1' && adaJadwalUjian > 0) {
                $('#refresh-token').removeClass('d-none')
            }
        }
    }

</script>

<?= $this->endSection() ?>

