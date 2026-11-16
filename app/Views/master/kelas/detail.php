<?= $this->extend('layout/dashboard_template_bs5') ?>
<?= $this->section('content') ?>

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
                    <path d="M6 12h12"></path>
                    <path d="M6 16h12"></path>
                  </svg>
                </div>
              </div>
              <div>
                <h4 class="card-title mb-1 fw-bold d-flex align-items-center">
                    <?= $subjudul ?>
                </h4>
                <p class="text-muted mb-0" style="font-size: 0.9rem;">Rincian anggota rombongan belajar (rombel), wali kelas pengampu, dan daftar siswa terdaftar.</p>
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
            <div class="card ">
                <div class="card-header">
                    <div class="card-title">
                        <h6><?= $subjudul . ' ' . $kelas->nama_kelas ?></h6>
                    </div>
                    <div class="card-tools">
                        <button type="submit" class="btn btn-primary btn-sm">
                            <svg class="icon-20 me-1" width="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>Reload
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <td style="width: 160px">
                                Nama Kelas
                            </td>
                            <td>
                                <?= $kelas->nama_kelas ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Kode Kelas
                            </td>
                            <td>
                                <?= $kelas->kode_kelas ?>
                            </td>
                        </tr>
                        <?php if ($setting->jenjang == '3') : ?>
                            <tr>
                                <td>
                                    Jurusan
                                </td>
                                <td>
                                    <?= $kelas->nama_jurusan ?>
                                </td>
                            </tr>
                        <?php endif; ?>
                        <tr>
                            <td>
                                Level Kelas
                            </td>
                            <td>
                                <?= $kelas->level ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Wali Kelas
                            </td>
                            <td>
                                <?= $kelas->nama_guru ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Jumlah Siswa
                            </td>
                            <td>
                                <?= count($siswas) ?>
                            </td>
                        </tr>
                    </table>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Siswa Kelas <?= $kelas->nama_kelas ?></h6>
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <th class="text-center align-middle">No</th>
                                    <th class="text-center align-middle">N I S</th>
                                    <th class="text-center align-middle">Nama</th>
                                </tr>
                                <?php
                                $no = 1;
                                foreach ($siswas as $siswa) : ?>
                                    <tr>
                                        <td class="text-center">
                                            <?= $no ?>
                                        </td>
                                        <td class="text-center">
                                            <?= $siswa->nis ?>
                                        </td>
                                        <td>
                                            <?= $siswa->nama ?>
                                        </td>
                                    </tr>
                                    <?php $no++; endforeach; ?>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h6>Struktur Organisasi Kelas <?= $kelas->nama_kelas ?></h6> (Diisi oleh wali kelas)
                            <?php
                            //echo '<pre>';
                            //var_dump(array_search('119', array_column($siswas, 'id_siswa')));
                            //var_dump($struktur);
                            //echo '</pre>';
                            $arrJabatan = [
                                'Wali Kelas', 'Ketua Kelas', 'Wakil Ketua',
                                'Sekretaris I', 'Sekretaris II', 'Bendahara I',
                                'Bendahara II', 'Sie Upacara', 'Sie Ekstrakurikuler',
                                'Sie Olahraga', 'Sie Keagamaan', 'Sie Keamanan',
                                'Sie Ketertiban', 'Sie Kebersihan', 'Sie Keindahan',
                                'Sie Kesehatan', 'Sie Kekeluargaan', 'Sie Humas'
                            ];
                            $arrSiswa = [
                                '', $struktur->ketua, $struktur->wakil_ketua,
                                $struktur->sekretaris_1, $struktur->sekretaris_2, $struktur->bendahara_1,
                                $struktur->bendahara_2, $struktur->sie_upacara, $struktur->sie_ekstrakurikuler,
                                $struktur->sie_olahraga, $struktur->sie_keagamaan, $struktur->sie_keamanan,
                                $struktur->sie_ketertiban, $struktur->sie_kebersihan, $struktur->sie_keindahan,
                                $struktur->sie_kesehatan, $struktur->sie_kekeluargaan, $struktur->sie_humas
                            ];
                            ?>
                            <table class="table table-bordered">
                                <tr class="bg-light">
                                    <th class="text-center align-middle">No</th>
                                    <th class="text-center align-middle">Jabatan</th>
                                    <th class="text-center align-middle">Nama Siswa</th>
                                </tr>
                                <?php
                                $no = 0;
                                foreach ($arrJabatan as $j) :
                                    $key = array_search($arrSiswa[$no], array_column($siswas, 'id_siswa'));
                                    ?>
                                    <tr>
                                        <td class="text-center"><?= $no + 1 ?></td>
                                        <td>
                                            <?= $j ?>
                                        </td>
                                        <td>
                                            <?= $key !== false ? $siswas[$key]->nama : ($no === 0 ? $kelas->nama_guru : '') ?>
                                        </td>
                                    </tr>
                                    <?php $no++; endforeach; ?>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?= $this->endSection() ?>
