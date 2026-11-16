<?= $this->extend('layout/dashboard_template_bs5') ?>
<?= $this->section('content') ?>
<div class="d-contents">
    <div class="card mb-4">
      <div class="card-body">
        <div class="d-flex align-items-center justify-content-between w-100">
            <div class="d-flex align-items-center">
              <div class="me-3">
                <svg class="icon-32 text-primary" width="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle>
                </svg>
              </div>
              <div>
                <h4 class="card-title mb-1 fw-bold d-flex align-items-center">
                    <?= esc($judul) ?>
                </h4>
                <p class="text-muted mb-0" style="font-size: 0.9rem;"><?= esc($subjudul) ?></p>
              </div>
            </div>
        </div>
      </div>
    </div>

    <section class="content">
        <div class="container-fluid p-0">
            <div class="row g-4">
                <!-- ================= LEFT PROFILE CARD ================= -->
                <div class="col-xl-3 col-lg-4">
                    <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px;">
                        <div class="card-body text-center p-4">
                            <div class="position-relative d-inline-block mb-3">
                                <?php 
                                    $foto = (!empty($guru->foto) && file_exists(FCPATH . ltrim($guru->foto, '/'))) 
                                        ? base_url(ltrim($guru->foto, '/')) 
                                        : base_url('assets/img/guru.png'); 
                                ?>
                                <img id="foto-guru" src="<?= $foto ?>" class="rounded-circle shadow border border-3 border-light" 
                                     style="width: 130px; height: 130px; object-fit: cover;" alt="Avatar Guru">
                                <button type="button" class="btn btn-sm btn-primary position-absolute bottom-0 end-0 rounded-circle p-2 shadow" 
                                        data-bs-toggle="modal" data-bs-target="#editFotoModal" title="Ganti Pas Foto">
                                    <i class="fas fa-camera"></i>
                                </button>
                            </div>
                            <h5 class="fw-bold text-dark mb-1"><?= esc($guru->nama_guru) ?></h5>
                            <p class="text-muted small mb-3"><?= esc($guru->jenis_ptk ?? 'Guru Mapel') ?> &bull; <?= esc($guru->status_pegawai ?? 'GTY/PTY') ?></p>
                            
                            <div class="d-grid gap-2 mb-3">
                                <button type="button" class="btn btn-outline-primary btn-sm fw-bold" data-bs-toggle="modal" data-bs-target="#editFotoModal">
                                    <i class="fas fa-image me-1"></i> Ganti Pas Foto
                                </button>
                                <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#editLoginModal">
                                    <i class="fas fa-key me-1"></i> Ubah Password
                                </button>
                                <?php if (!empty($guru->foto)): ?>
                                <button type="button" class="btn btn-outline-danger btn-sm" onclick="deleteImage(true)">
                                    <i class="fas fa-trash me-1"></i> Hapus Foto
                                </button>
                                <?php endif; ?>
                            </div>

                            <hr class="my-3">

                            <div class="text-start small">
                                <div class="d-flex justify-content-between py-1 border-bottom">
                                    <span class="text-muted">NIP:</span>
                                    <span class="fw-bold font-monospace"><?= esc($guru->nip ?: '-') ?></span>
                                </div>
                                <div class="d-flex justify-content-between py-1 border-bottom">
                                    <span class="text-muted">NUPTK:</span>
                                    <span class="fw-bold font-monospace"><?= esc($guru->nuptk ?: '-') ?></span>
                                </div>
                                <div class="d-flex justify-content-between py-1 border-bottom">
                                    <span class="text-muted">Kode Guru:</span>
                                    <span class="fw-bold"><?= esc($guru->kode_guru ?: '-') ?></span>
                                </div>
                                <div class="d-flex justify-content-between py-1 border-bottom">
                                    <span class="text-muted">Golongan:</span>
                                    <span class="fw-bold text-success"><?= esc($guru->pangkat_golongan ?: '-') ?></span>
                                </div>
                                <div class="d-flex justify-content-between py-1">
                                    <span class="text-muted">Buku Induk:</span>
                                    <span class="badge bg-success-subtle text-success fw-bold">Sinkron Dapodik</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm" style="border-radius: 12px; background: #f8fafc;">
                        <div class="card-body p-3">
                            <h6 class="fw-bold text-dark mb-2"><i class="fas fa-info-circle text-primary me-2"></i>Petunjuk Pengisian</h6>
                            <p class="text-muted small mb-0" style="font-size: 0.8rem; line-height: 1.45;">
                                Lengkapi setiap tab formulir di sebelah kanan sesuai data riil. Data yang tersimpan otomatis menjadi master cetak <b>Buku Induk GTK</b> sekolah format resmi Dapodik Ditjen Dikdasmen.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- ================= RIGHT FORM TABS ================= -->
                <div class="col-xl-9 col-lg-8">
                    <div class="card border-0 shadow-sm" style="border-radius: 12px;">
                        <div class="card-header bg-white border-bottom p-3">
                            <ul class="nav nav-pills card-header-pills flex-nowrap overflow-auto pb-1" id="guruProfileTabs" role="tablist">
                                <li class="nav-item">
                                    <button class="nav-link active fw-bold text-nowrap py-2 px-3" id="tab-guru-1" data-bs-toggle="pill" data-bs-target="#pane-guru-1" type="button">
                                        <i class="fas fa-user-circle me-1"></i> 1. Identitas & Penugasan
                                    </button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link fw-bold text-nowrap py-2 px-3" id="tab-guru-2" data-bs-toggle="pill" data-bs-target="#pane-guru-2" type="button">
                                        <i class="fas fa-map-marker-alt me-1"></i> 2. Domisili & Kontak
                                    </button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link fw-bold text-nowrap py-2 px-3" id="tab-guru-3" data-bs-toggle="pill" data-bs-target="#pane-guru-3" type="button">
                                        <i class="fas fa-briefcase me-1"></i> 3. Kepegawaian & SK
                                    </button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link fw-bold text-nowrap py-2 px-3" id="tab-guru-4" data-bs-toggle="pill" data-bs-target="#pane-guru-4" type="button">
                                        <i class="fas fa-graduation-cap me-1"></i> 4. Pendidikan & Beban Jam
                                    </button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link fw-bold text-nowrap py-2 px-3 text-success" id="tab-guru-5" data-bs-toggle="pill" data-bs-target="#pane-guru-5" type="button">
                                        <i class="fas fa-money-bill-wave me-1"></i> 5. Riwayat KGB
                                    </button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link fw-bold text-nowrap py-2 px-3 text-primary" id="tab-guru-6" data-bs-toggle="pill" data-bs-target="#pane-guru-6" type="button">
                                        <i class="fas fa-award me-1"></i> 6. Riwayat Kepangkatan
                                    </button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link fw-bold text-nowrap py-2 px-3 text-dark" id="tab-guru-7" data-bs-toggle="pill" data-bs-target="#pane-guru-7" type="button">
                                        <i class="fas fa-chalkboard-teacher me-1"></i> 7. Jadwal Pembelajaran
                                    </button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link fw-bold text-nowrap py-2 px-3 text-danger" id="tab-guru-8" data-bs-toggle="pill" data-bs-target="#pane-guru-8" type="button">
                                        <i class="fas fa-folder-open me-1"></i> 8. Berkas Dokumen
                                    </button>
                                </li>
                            </ul>
                        </div>

                        <?= form_open_multipart('', array('id' => 'formguru'), array('method' => 'edit', 'id_guru' => $guru->id_guru)); ?>
                        <!-- Hidden Inputs for dynamic tables -->
                        <input type="hidden" name="riwayat_kgb" id="hidden_riwayat_kgb">
                        <input type="hidden" name="riwayat_kepangkatan" id="hidden_riwayat_kepangkatan">
                        <input type="hidden" name="lampiran_pembelajaran" id="hidden_lampiran_pembelajaran">

                        <div class="card-body p-4">
                            <div class="tab-content" id="guruProfileTabsContent">
                                
                                <!-- ================= PANE 1: IDENTITAS & PENUGASAN ================= -->
                                <div class="tab-pane fade show active" id="pane-guru-1" role="tabpanel">
                                    <div class="p-3 bg-light rounded-3 border mb-4">
                                        <h6 class="fw-bold text-primary mb-3"><i class="fas fa-envelope-open-text me-2"></i>Informasi Penugasan & Sekolah Induk</h6>
                                        <div class="row g-3">
                                            <div class="col-md-4">
                                                <label class="form-label small fw-bold">Nomor Surat Tugas</label>
                                                <input type="text" name="no_surat_tugas" class="form-control" value="<?= esc($guru->no_surat_tugas ?? '') ?>" placeholder="Contoh: 800/123/101.6.2.2/2026">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label small fw-bold">Tanggal Surat Tugas</label>
                                                <input type="text" name="tgl_surat_tugas" class="form-control" value="<?= esc($guru->tgl_surat_tugas ?? '') ?>" placeholder="Contoh: 15 Juli 2026">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label small fw-bold">Tahun Ajaran</label>
                                                <input type="text" name="tahun_ajaran" class="form-control" value="<?= esc($guru->tahun_ajaran ?? ($tp_active->tahun ?? '2026/2027')) ?>" placeholder="2026/2027">
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-label small fw-bold">Sekolah Induk</label>
                                                <select name="sekolah_induk" class="form-select">
                                                    <option value="Ya" <?= ($guru->sekolah_induk ?? 'Ya') === 'Ya' ? 'selected' : '' ?>>Ya</option>
                                                    <option value="Tidak" <?= ($guru->sekolah_induk ?? '') === 'Tidak' ? 'selected' : '' ?>>Tidak</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <h6 class="fw-bold text-dark border-bottom pb-2 mb-3"><i class="fas fa-user me-2"></i>Identitas Diri Pribadi & Keluarga</h6>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold">Nama Lengkap & Gelar <span class="text-danger">*</span></label>
                                            <input type="text" name="nama_guru" class="form-control" value="<?= esc($guru->nama_guru ?? '') ?>" required>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label fw-bold">Kode Guru</label>
                                            <input type="text" name="kode_guru" class="form-control" value="<?= esc($guru->kode_guru ?? '') ?>" placeholder="Contoh: 01">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label fw-bold">Jenis Kelamin</label>
                                            <select name="jenis_kelamin" class="form-select" required>
                                                <option value="L" <?= ($guru->jenis_kelamin ?? 'L') === 'L' ? 'selected' : '' ?>>Laki-laki (L)</option>
                                                <option value="P" <?= ($guru->jenis_kelamin ?? '') === 'P' ? 'selected' : '' ?>>Perempuan (P)</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label fw-bold">NIK / No. KTP</label>
                                            <input type="text" name="no_ktp" class="form-control" value="<?= esc($guru->no_ktp ?? ($guru->nik ?? '')) ?>" placeholder="16 digit NIK">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label fw-bold">Tempat Lahir</label>
                                            <input type="text" name="tempat_lahir" class="form-control" value="<?= esc($guru->tempat_lahir ?? '') ?>">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label fw-bold">Tanggal Lahir</label>
                                            <input type="date" name="tgl_lahir" class="form-control" value="<?= esc($guru->tgl_lahir ?? '') ?>">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label fw-bold">Nama Ibu Kandung</label>
                                            <input type="text" name="nama_ibu" class="form-control" value="<?= esc($guru->nama_ibu ?? '') ?>">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label fw-bold">Agama</label>
                                            <select name="agama" class="form-select">
                                                <?php foreach (["Islam", "Kristen", "Katolik", "Hindu", "Buddha", "Konghucu"] as $ag): ?>
                                                    <option value="<?= $ag ?>" <?= (strcasecmp($guru->agama ?? 'Islam', $ag) === 0) ? 'selected' : '' ?>><?= $ag ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label fw-bold">Status Pernikahan</label>
                                            <select name="status_nikah" class="form-select">
                                                <option value="Kawin" <?= in_array($guru->status_nikah ?? '', ['Kawin', 'Menikah']) ? 'selected' : '' ?>>Kawin / Menikah</option>
                                                <option value="Belum Kawin" <?= in_array($guru->status_nikah ?? '', ['Belum Kawin', 'Belum Menikah']) ? 'selected' : '' ?>>Belum Kawin</option>
                                                <option value="Duda/Janda" <?= ($guru->status_nikah ?? '') === 'Duda/Janda' ? 'selected' : '' ?>>Duda / Janda</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold">Nama Suami / Istri</label>
                                            <input type="text" name="nama_suami_istri" class="form-control" value="<?= esc($guru->nama_suami_istri ?? '') ?>">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold">Pekerjaan Suami / Istri</label>
                                            <input type="text" name="pekerjaan_suami_istri" class="form-control" value="<?= esc($guru->pekerjaan_suami_istri ?? '') ?>">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label fw-bold">Kewarganegaraan</label>
                                            <input type="text" name="kewarganegaraan" class="form-control" value="<?= esc($guru->kewarganegaraan ?? 'WNI') ?>">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label fw-bold">Nomor NPWP</label>
                                            <input type="text" name="npwp" class="form-control" value="<?= esc($guru->npwp ?? '') ?>">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label fw-bold">Nama Wajib Pajak</label>
                                            <input type="text" name="nama_wajib_pajak" class="form-control" value="<?= esc($guru->nama_wajib_pajak ?? ($guru->nama_guru ?? '')) ?>">
                                        </div>
                                    </div>
                                </div>

                                <!-- ================= PANE 2: DOMISILI & KONTAK ================= -->
                                <div class="tab-pane fade" id="pane-guru-2" role="tabpanel">
                                    <h6 class="fw-bold text-dark border-bottom pb-2 mb-3"><i class="fas fa-phone-alt me-2"></i>Kontak & Nomor Telepon</h6>
                                    <div class="row g-3 mb-4">
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold">No. Handphone / WhatsApp</label>
                                            <input type="text" name="no_hp" class="form-control" value="<?= esc($guru->no_hp ?? '') ?>" placeholder="08xxxxxxxxxx">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold">Alamat Email Aktif</label>
                                            <input type="email" name="email" class="form-control" value="<?= esc($guru->email ?? '') ?>" placeholder="nama@guru.sch.id">
                                        </div>
                                    </div>

                                    <h6 class="fw-bold text-dark border-bottom pb-2 mb-3"><i class="fas fa-home me-2"></i>Alamat Domisili Tempat Tinggal</h6>
                                    <div class="row g-3">
                                        <div class="col-md-8">
                                            <label class="form-label fw-bold">Alamat Jalan / No. Rumah</label>
                                            <input type="text" name="alamat_jalan" class="form-control" value="<?= esc($guru->alamat_jalan ?? '') ?>">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label fw-bold">RT / RW</label>
                                            <input type="text" name="rt_rw" class="form-control" value="<?= esc($guru->rt_rw ?? '') ?>" placeholder="Contoh: 002 / 005">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label fw-bold">Dusun</label>
                                            <input type="text" name="dusun" class="form-control" value="<?= esc($guru->dusun ?? '') ?>">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label fw-bold">Kelurahan / Desa</label>
                                            <input type="text" name="kelurahan" class="form-control" value="<?= esc($guru->kelurahan ?? '') ?>">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label fw-bold">Kecamatan</label>
                                            <input type="text" name="kecamatan" class="form-control" value="<?= esc($guru->kecamatan ?? '') ?>">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label fw-bold">Kota / Kabupaten</label>
                                            <input type="text" name="kabupaten" class="form-control" value="<?= esc($guru->kabupaten ?? '') ?>">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold">Provinsi</label>
                                            <input type="text" name="provinsi" class="form-control" value="<?= esc($guru->provinsi ?? 'Jawa Timur') ?>">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold">Kode Pos</label>
                                            <input type="text" name="kode_pos" class="form-control" value="<?= esc($guru->kode_pos ?? '') ?>">
                                        </div>
                                    </div>
                                </div>

                                <!-- ================= PANE 3: KEPEGAWAIAN & SK ================= -->
                                <div class="tab-pane fade" id="pane-guru-3" role="tabpanel">
                                    <h6 class="fw-bold text-dark border-bottom pb-2 mb-3"><i class="fas fa-briefcase me-2"></i>Status Kepegawaian & SK Pengangkatan</h6>
                                    <div class="row g-3">
                                        <div class="col-md-4">
                                            <label class="form-label fw-bold">NIP</label>
                                            <input type="text" name="nip" class="form-control" value="<?= esc($guru->nip ?? '') ?>" placeholder="18 digit angka atau -">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label fw-bold">Jenis NIP</label>
                                            <input type="text" name="jenis_nip" class="form-control" value="<?= esc($guru->jenis_nip ?? 'NIP') ?>" placeholder="PNS / PPPK / Non-NIP">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label fw-bold">NUPTK</label>
                                            <input type="text" name="nuptk" class="form-control" value="<?= esc($guru->nuptk ?? '') ?>">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label fw-bold">Jenis GTK</label>
                                            <input type="text" name="jenis_ptk" class="form-control" value="<?= esc($guru->jenis_ptk ?? 'Guru Mapel') ?>">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label fw-bold">Status Kepegawaian</label>
                                            <input type="text" name="status_pegawai" class="form-control" value="<?= esc($guru->status_pegawai ?? 'PNS') ?>" placeholder="PNS / PPPK / GTY / Honorer">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label fw-bold">Status Keaktifan</label>
                                            <select name="status_aktif" class="form-select">
                                                <option value="Aktif" <?= ($guru->status_aktif ?? 'Aktif') === 'Aktif' ? 'selected' : '' ?>>Aktif</option>
                                                <option value="Cuti" <?= ($guru->status_aktif ?? '') === 'Cuti' ? 'selected' : '' ?>>Cuti</option>
                                                <option value="Pensiun" <?= ($guru->status_aktif ?? '') === 'Pensiun' ? 'selected' : '' ?>>Pensiun</option>
                                                <option value="Mutasi" <?= ($guru->status_aktif ?? '') === 'Mutasi' ? 'selected' : '' ?>>Mutasi / Pindah</option>
                                                <option value="Nonaktif" <?= ($guru->status_aktif ?? '') === 'Nonaktif' ? 'selected' : '' ?>>Nonaktif</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label fw-bold">Sumber Gaji</label>
                                            <input type="text" name="sumber_gaji" class="form-control" value="<?= esc($guru->sumber_gaji ?? 'APBD Provinsi') ?>">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label fw-bold">SK CPNS</label>
                                            <input type="text" name="sk_cpns" class="form-control" value="<?= esc($guru->sk_cpns ?? '') ?>">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label fw-bold">TMT CPNS</label>
                                            <input type="text" name="tmt_cpns" class="form-control" value="<?= esc($guru->tmt_cpns ?? '') ?>" placeholder="01 Maret 2010">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label fw-bold">SK Pengangkatan</label>
                                            <input type="text" name="sk_pengangkatan" class="form-control" value="<?= esc($guru->sk_pengangkatan ?? '') ?>">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label fw-bold">TMT Pengangkatan</label>
                                            <input type="text" name="tmt_pengangkatan" class="form-control" value="<?= esc($guru->tmt_pengangkatan ?? '') ?>" placeholder="01 April 2011">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label fw-bold">TMT SK Pengangkatan</label>
                                            <input type="text" name="tmt_sk_pengangkatan" class="form-control" value="<?= esc($guru->tmt_sk_pengangkatan ?? '') ?>">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold">Lembaga Pengangkat</label>
                                            <input type="text" name="lembaga_pengangkat" class="form-control" value="<?= esc($guru->lembaga_pengangkat ?? 'Pemerintah Kab/Kota') ?>" placeholder="Gubernur Jawa Timur / Kepala Sekolah">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label fw-bold">Pangkat / Golongan</label>
                                            <input type="text" name="pangkat_golongan" class="form-control" value="<?= esc($guru->pangkat_golongan ?? '') ?>" placeholder="Penata Muda / III/a">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label fw-bold">TMT Pangkat Golongan</label>
                                            <input type="text" name="tmt_pangkat_golongan" class="form-control" value="<?= esc($guru->tmt_pangkat_golongan ?? '') ?>">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label fw-bold">Masa Kerja (Thn/Bln)</label>
                                            <input type="text" name="masa_kerja" class="form-control" value="<?= esc($guru->masa_kerja ?? '') ?>" placeholder="12 Tahun 4 Bulan">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label fw-bold">No. Karpeg (Kartu Pegawai)</label>
                                            <input type="text" name="karpeg" class="form-control" value="<?= esc($guru->karpeg ?? '') ?>">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label fw-bold">No. Karis / Karsu</label>
                                            <input type="text" name="karis_karsu" class="form-control" value="<?= esc($guru->karis_karsu ?? '') ?>">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label fw-bold">Tahun Pensiun</label>
                                            <input type="text" name="tahun_pensiun" class="form-control" value="<?= esc($guru->tahun_pensiun ?? '') ?>" placeholder="2034">
                                        </div>
                                    </div>
                                </div>

                                <!-- ================= PANE 4: PENDIDIKAN & BEBAN JAM ================= -->
                                <div class="tab-pane fade" id="pane-guru-4" role="tabpanel">
                                    <h6 class="fw-bold text-dark border-bottom pb-2 mb-3"><i class="fas fa-graduation-cap me-2"></i>Pendidikan & Kualifikasi Guru</h6>
                                    <div class="row g-3 mb-4">
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold">Kompetensi yang Dimiliki</label>
                                            <input type="text" name="kompetensi" class="form-control" value="<?= esc($guru->kompetensi ?? '') ?>" placeholder="Contoh: Teknik Otomotif, Matematika, IPA">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold">Pendidikan Terakhir</label>
                                            <input type="text" name="pendidikan_terakhir" class="form-control" value="<?= esc($guru->pendidikan_terakhir ?? '') ?>" placeholder="Contoh: S1 Pendidikan Teknik Otomotif">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label fw-bold">Status Kuliah Lanjutan</label>
                                            <input type="text" name="status_kuliah" class="form-control" value="<?= esc($guru->status_kuliah ?? 'Tidak') ?>">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label fw-bold">Keahlian Bahasa Isyarat</label>
                                            <select name="keahlian_isyarat" class="form-select">
                                                <option value="Tidak" <?= ($guru->keahlian_isyarat ?? 'Tidak') === 'Tidak' ? 'selected' : '' ?>>Tidak</option>
                                                <option value="Ya" <?= ($guru->keahlian_isyarat ?? '') === 'Ya' ? 'selected' : '' ?>>Ya</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label fw-bold">Tugas Tambahan</label>
                                            <input type="text" name="tgs_tambahan" class="form-control" value="<?= esc($guru->tgs_tambahan ?? ($guru->tugas_tambahan ?? '')) ?>" placeholder="Kepala Bengkel / Waka / Pembina">
                                        </div>
                                    </div>

                                    <h6 class="fw-bold text-dark border-bottom pb-2 mb-3"><i class="fas fa-clock me-2"></i>Beban Mengajar & Tugas Tambahan (Jam/Minggu)</h6>
                                    <div class="row g-3">
                                        <div class="col-md-3">
                                            <label class="form-label fw-bold">TMT Tugas Tambahan</label>
                                            <input type="text" name="tmt_tambahan" class="form-control" value="<?= esc($guru->tmt_tambahan ?? '') ?>">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label fw-bold">TST Tugas Tambahan</label>
                                            <input type="text" name="tst_tambahan" class="form-control" value="<?= esc($guru->tst_tambahan ?? '') ?>">
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label fw-bold">Jam Tgs Tambahan</label>
                                            <input type="number" name="jam_tugas_tambahan" id="input_jam_tambahan" class="form-control" value="<?= esc($guru->jam_tugas_tambahan ?? '0') ?>" oninput="recalcTotalJam()">
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label fw-bold">Jam Tatap Muka</label>
                                            <input type="number" name="jam_mengajar" id="input_jam_mengajar" class="form-control" value="<?= esc($guru->jam_mengajar ?? '0') ?>" oninput="recalcTotalJam()">
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label fw-bold">Total Jam/Minggu</label>
                                            <input type="number" name="total_jam" id="input_total_jam" class="form-control bg-light fw-bold text-primary" value="<?= esc($guru->total_jam ?? '0') ?>" readonly>
                                        </div>
                                    </div>
                                </div>

                                <!-- ================= PANE 5: RIWAYAT KGB ================= -->
                                <div class="tab-pane fade" id="pane-guru-5" role="tabpanel">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <div>
                                            <h6 class="fw-bold text-success mb-1"><i class="fas fa-money-bill-wave me-2"></i>Riwayat Kenaikan Gaji Berkala (KGB)</h6>
                                            <small class="text-muted">Data ini akan tercetak pada lampiran Buku Induk GTK (Halaman 5)</small>
                                        </div>
                                        <button type="button" class="btn btn-sm btn-success fw-bold" onclick="addGuruKgbRow()">
                                            <i class="fas fa-plus me-1"></i> Tambah Baris KGB
                                        </button>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-sm table-striped align-middle" id="tableGuruKgb">
                                            <thead class="table-light">
                                                <tr>
                                                    <th style="width: 40px;" class="text-center">No</th>
                                                    <th>Pangkat/Golongan</th>
                                                    <th>Nomor SK</th>
                                                    <th>Tanggal SK</th>
                                                    <th>TMT KGB</th>
                                                    <th>Masa Kerja</th>
                                                    <th>Gaji Pokok Baru</th>
                                                    <th>Penerbit SK</th>
                                                    <th style="width: 50px;" class="text-center">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbodyGuruKgb">
                                                <!-- Dynamic KGB Rows -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- ================= PANE 6: RIWAYAT KEPANGKATAN ================= -->
                                <div class="tab-pane fade" id="pane-guru-6" role="tabpanel">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <div>
                                            <h6 class="fw-bold text-primary mb-1"><i class="fas fa-award me-2"></i>Riwayat Kepangkatan & Golongan</h6>
                                            <small class="text-muted">Data ini akan tercetak pada lampiran Buku Induk GTK (Halaman 5)</small>
                                        </div>
                                        <button type="button" class="btn btn-sm btn-primary fw-bold" onclick="addGuruKepangkatanRow()">
                                            <i class="fas fa-plus me-1"></i> Tambah Baris Kepangkatan
                                        </button>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-sm table-striped align-middle" id="tableGuruKepangkatan">
                                            <thead class="table-light">
                                                <tr>
                                                    <th style="width: 40px;" class="text-center">No</th>
                                                    <th>Pangkat / Golongan</th>
                                                    <th>Nomor SK</th>
                                                    <th>Tanggal SK</th>
                                                    <th>TMT Pangkat</th>
                                                    <th>Masa Kerja</th>
                                                    <th style="width: 50px;" class="text-center">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbodyGuruKepangkatan">
                                                <!-- Dynamic Kepangkatan Rows -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- ================= PANE 7: LAMPIRAN PEMBELAJARAN ================= -->
                                <div class="tab-pane fade" id="pane-guru-7" role="tabpanel">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <div>
                                            <h6 class="fw-bold text-dark mb-1"><i class="fas fa-chalkboard-teacher text-success me-2"></i>Lampiran Rombel & Jadwal Pembelajaran</h6>
                                            <small class="text-muted">Data ini tercetak pada Lampiran Rekapitulasi Pembelajaran (Halaman 3)</small>
                                        </div>
                                        <button type="button" class="btn btn-sm btn-outline-success fw-bold" onclick="addGuruPembelajaranRow()">
                                            <i class="fas fa-plus me-1"></i> Tambah Rombel & Mapel
                                        </button>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-sm table-striped align-middle" id="tableGuruPembelajaran">
                                            <thead class="table-light">
                                                <tr>
                                                    <th style="width: 40px;" class="text-center">No</th>
                                                    <th>Informasi Rombel (Tingkat / Rombel / Kurikulum)</th>
                                                    <th>Mata Pelajaran</th>
                                                    <th style="width: 140px;">Jam / Minggu</th>
                                                    <th style="width: 50px;" class="text-center">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbodyGuruPembelajaran">
                                                <!-- Dynamic Pembelajaran Rows -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- ================= PANE 8: BERKAS DOKUMEN ================= -->
                                <div class="tab-pane fade" id="pane-guru-8" role="tabpanel">
                                    <h6 class="fw-bold text-dark border-bottom pb-2 mb-3"><i class="fas fa-paperclip me-2"></i>Upload Berkas & Dokumen Guru</h6>
                                    <div class="row g-4">
                                        <div class="col-md-4">
                                            <div class="p-3 border rounded-3 bg-light text-center h-100">
                                                <span class="fw-bold d-block mb-2"><i class="fas fa-id-card text-primary me-1"></i> Scan KTP</span>
                                                <input type="file" class="d-none" id="ktp_id" name="ktp_id" accept="image/*">
                                                <div class="thumbnail-preview d-flex justify-content-center align-items-center" id="thumbnail_ktp_id">
                                                    <div class="add-photo-button" id="add_ktp_id" title="Upload KTP">+</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="p-3 border rounded-3 bg-light text-center h-100">
                                                <span class="fw-bold d-block mb-2"><i class="fas fa-users text-success me-1"></i> Scan Kartu Keluarga</span>
                                                <input type="file" class="d-none" id="kk_id" name="kk_id" accept="image/*">
                                                <div class="thumbnail-preview d-flex justify-content-center align-items-center" id="thumbnail_kk_id">
                                                    <div class="add-photo-button" id="add_kk_id" title="Upload KK">+</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="p-3 border rounded-3 bg-light text-center h-100">
                                                <span class="fw-bold d-block mb-2"><i class="fas fa-certificate text-warning me-1"></i> Ijazah / Sertifikat</span>
                                                <input type="file" class="d-none" id="sertifikat" name="serti[]" accept="image/*" multiple>
                                                <div class="thumbnail-preview d-flex justify-content-center align-items-center" id="thumbnail_sertifikat">
                                                    <div class="add-photo-button" id="add_sertifikat" title="Tambah Sertifikat">+</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="card-footer bg-light p-3 d-flex justify-content-between align-items-center flex-wrap gap-2">
                            <div class="d-flex align-items-center text-muted small">
                                <i class="fas fa-check-circle text-success me-2 fa-lg"></i>
                                <span>Data form langsung terhubung & tersinkronkan otomatis dengan Buku Induk Sekolah.</span>
                            </div>
                            <div>
                                <button type="button" id="submit-profil" class="btn btn-primary fw-bold px-4 shadow-sm">
                                    <i class="fas fa-save me-1"></i> Simpan Profil
                                </button>
                            </div>
                        </div>
                        <?= form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- ================= MODAL GANTI FOTO ================= -->
<div class="modal fade" id="editFotoModal" tabindex="-1" role="dialog" aria-labelledby="editFotoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="editFotoLabel"><i class="fas fa-camera me-2 text-primary"></i> Ganti Pas Foto Guru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?= form_open_multipart('', array('id' => 'set-foto-profile')) ?>
                <div class="form-group pb-2">
                    <label class="form-label small fw-bold">Pilih File Foto (JPG / JPEG / PNG, Maks 2MB):</label>
                    <input type="file" id="foto-profile" name="foto" class="dropify"
                           data-max-file-size-preview="2M"
                           data-allowed-file-extensions="jpg jpeg png"
                           data-default-file="<?= $foto ?>"/>
                </div>
                <?= form_close() ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- ================= MODAL EDIT LOGIN ================= -->
<?= form_open('', array('id' => 'updatelogin'), array('id_guru' => $guru->id_guru)) ?>
<div class="modal fade" id="editLoginModal" tabindex="-1" role="dialog" aria-labelledby="editLoginLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="editLoginLabel"><i class="fas fa-key me-2 text-warning"></i> Ubah Password / Username</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label small fw-bold">Username</label>
                    <input type="text" class="form-control" name="username" value="<?= esc($guru->username ?? '') ?>" placeholder="Username Akun">
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-bold">Password Saat Ini</label>
                    <input class="form-control" name="old" value="<?= esc($guru->password ?? '') ?>" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-bold">Password Baru</label>
                    <input type="password" name="new" class="form-control" placeholder="Masukkan Password Baru">
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-bold">Konfirmasi Password Baru</label>
                    <input type="password" name="new_confirm" class="form-control" placeholder="Ketik Ulang Password Baru" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-warning fw-bold">Perbarui Password</button>
            </div>
        </div>
    </div>
</div>
<?= form_close() ?>

<!-- Fullscreen Preview Modal Structure -->
<div class="fullscreen-overlay" id="fullscreenPreviewOverlay">
    <div class="fullscreen-content">
        <img id="fullscreenImage" src="" alt="Full-size preview">
        <div class="fullscreen-button-group">
            <button class="btn fullscreen-close-button" id="fullscreenCloseButton"><i class="fa fa-times"></i></button>
            <a href="#" id="fullscreenDownloadButton" class="fullscreen-close-button btn" download><i class="fas fa-download"></i></a>
            <button class="btn fullscreen-close-button" id="fullscreenDeleteButton"><i class="fa fa-trash-o"></i></button>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
<?= $this->section('scripts') ?>
<script>
    var fotoProfile = '';
    var idGuru = '<?= $guru->id_guru ?>';
    var src = '<?= $guru->foto ?>';
    var dokumen = JSON.parse('<?= json_encode(json_decode($guru->dokumen ?? "{}")) ?>');

    // Pre-populate Data Arrays
    var kgbData = <?= json_encode($guru->riwayat_kgb ?? []) ?>;
    var kepangkatanData = <?= json_encode($guru->riwayat_kepangkatan ?? []) ?>;
    var pembelajaranData = <?= json_encode($guru->lampiran_pembelajaran ?? []) ?>;

    // Recalculate Total Jam
    function recalcTotalJam() {
        var tgs = parseFloat($('#input_jam_tambahan').val()) || 0;
        var pbm = parseFloat($('#input_jam_mengajar').val()) || 0;
        $('#input_total_jam').val(tgs + pbm);
    }

    // Dynamic Row Functions for KGB
    function addGuruKgbRow(item = {}) {
        var idx = $('#tbodyGuruKgb tr').length + 1;
        var html = `
            <tr>
                <td class="text-center fw-bold">${idx}</td>
                <td><input type="text" class="form-control form-control-sm kgb-pangkat" value="${item.pangkat_golongan || item.pangkat || ''}" placeholder="Penata Muda / III/a"></td>
                <td><input type="text" class="form-control form-control-sm kgb-no-sk" value="${item.nomor_sk || item.no_sk || ''}" placeholder="800.1.11.13/..."></td>
                <td><input type="date" class="form-control form-control-sm kgb-tgl-sk" value="${item.tanggal_sk || item.tgl_sk || ''}"></td>
                <td><input type="date" class="form-control form-control-sm kgb-tmt" value="${item.tmt_kgb || ''}"></td>
                <td><input type="text" class="form-control form-control-sm kgb-mk" value="${item.masa_kerja || ''}" placeholder="18 Tahun 0 Bulan"></td>
                <td><input type="text" class="form-control form-control-sm kgb-gaji" value="${item.gaji_pokok || ''}" placeholder="3.861.000"></td>
                <td><input type="text" class="form-control form-control-sm kgb-penerbit" value="${item.penerbit || item.penerbit_sk || ''}" placeholder="Gubernur / Kadisdik"></td>
                <td class="text-center">
                    <button type="button" class="btn btn-outline-danger btn-sm p-1" onclick="$(this).closest('tr').remove(); reindexKgb();">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </td>
            </tr>`;
        $('#tbodyGuruKgb').append(html);
    }

    function reindexKgb() {
        $('#tbodyGuruKgb tr').each(function(i) {
            $(this).find('td:first').text(i + 1);
        });
    }

    // Dynamic Row Functions for Kepangkatan
    function addGuruKepangkatanRow(item = {}) {
        var idx = $('#tbodyGuruKepangkatan tr').length + 1;
        var html = `
            <tr>
                <td class="text-center fw-bold">${idx}</td>
                <td><input type="text" class="form-control form-control-sm pkt-pangkat" value="${item.pangkat_golongan || item.pangkat || ''}" placeholder="Penata / III/c"></td>
                <td><input type="text" class="form-control form-control-sm pkt-no-sk" value="${item.nomor_sk || item.no_sk || ''}" placeholder="823.3/139/..."></td>
                <td><input type="date" class="form-control form-control-sm pkt-tgl-sk" value="${item.tanggal_sk || item.tgl_sk || ''}"></td>
                <td><input type="date" class="form-control form-control-sm pkt-tmt" value="${item.tmt_pangkat || ''}"></td>
                <td><input type="text" class="form-control form-control-sm pkt-mk" value="${item.masa_kerja || ''}" placeholder="6 Tahun 3 Bulan"></td>
                <td class="text-center">
                    <button type="button" class="btn btn-outline-danger btn-sm p-1" onclick="$(this).closest('tr').remove(); reindexKepangkatan();">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </td>
            </tr>`;
        $('#tbodyGuruKepangkatan').append(html);
    }

    function reindexKepangkatan() {
        $('#tbodyGuruKepangkatan tr').each(function(i) {
            $(this).find('td:first').text(i + 1);
        });
    }

    // Dynamic Row Functions for Pembelajaran
    function addGuruPembelajaranRow(item = {}) {
        var idx = $('#tbodyGuruPembelajaran tr').length + 1;
        var rombelVal = item.rombel || (item.rombel_kelas ? `Tingkat: ${item.rombel_tingkat || '10'}\nNama: ${item.rombel_kelas}\nKurikulum: ${item.rombel_kurikulum || 'Merdeka'}` : '');
        var mapelVal = item.mapel || (item.mapel_nama ? `${item.mapel_kode || ''} - ${item.mapel_nama}\n${item.mapel_kelompok || ''}` : '');
        var jamVal = item.jam || item.jam_minggu || '2';

        var html = `
            <tr>
                <td class="text-center fw-bold">${idx}</td>
                <td><textarea class="form-control form-control-sm pbm-rombel" rows="2" placeholder="Nama Rombel / Kelas">${rombelVal}</textarea></td>
                <td><textarea class="form-control form-control-sm pbm-mapel" rows="2" placeholder="Mata Pelajaran">${mapelVal}</textarea></td>
                <td><input type="number" class="form-control form-control-sm pbm-jam" value="${jamVal}"></td>
                <td class="text-center">
                    <button type="button" class="btn btn-outline-danger btn-sm p-1" onclick="$(this).closest('tr').remove(); reindexPembelajaran();">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </td>
            </tr>`;
        $('#tbodyGuruPembelajaran').append(html);
    }

    function reindexPembelajaran() {
        $('#tbodyGuruPembelajaran tr').each(function(i) {
            $(this).find('td:first').text(i + 1);
        });
    }

    $(document).ready(function () {
        // Populate initial table rows
        if (Array.isArray(kgbData) && kgbData.length > 0) {
            kgbData.forEach(row => addGuruKgbRow(row));
        } else {
            addGuruKgbRow();
        }

        if (Array.isArray(kepangkatanData) && kepangkatanData.length > 0) {
            kepangkatanData.forEach(row => addGuruKepangkatanRow(row));
        } else {
            addGuruKepangkatanRow();
        }

        if (Array.isArray(pembelajaranData) && pembelajaranData.length > 0) {
            pembelajaranData.forEach(row => addGuruPembelajaranRow(row));
        } else {
            addGuruPembelajaranRow();
        }

        recalcTotalJam();

        // Dropify Setup
        $('#foto-profile').attr("data-default-file", base_url + src);
        var drEvent = $('.dropify').dropify({
            messages: {
                'default': 'Seret foto ke sini atau klik',
                'replace': 'Seret atau klik untuk mengganti foto',
                'remove': 'Hapus',
                'error': 'Terjadi kesalahan pada file.'
            }
        });

        drEvent.on('dropify.afterClear', function (event, element) {
            src = $(event.currentTarget).data('default-file');
            deleteImage(false);
            fotoProfile = '';
        });

        $('#editFotoModal').on('hidden.bs.modal', function (e) {
            window.location.reload();
        });

        // Dokumen Arrays & Thumbnails
        let selectedKtp = [];
        let selectedKk = [];
        let selectedSert = [];
        function pecahDokumen() {
            selectedKtp = [];
            selectedKk = [];
            selectedSert = [];

            for (const category in dokumen) {
                if (dokumen.hasOwnProperty(category)) {
                    if (category === 'ktp' && dokumen.ktp) {
                        const url = base_url + dokumen.ktp;
                        selectedKtp.push({
                            id: crypto.randomUUID(),
                            type: 'url',
                            url: url,
                            name: url.substring(url.lastIndexOf('/') + 1),
                            category: category
                        });
                    } else if (category === 'kk' && dokumen.kk) {
                        const url = base_url + dokumen.kk;
                        selectedKk.push({
                            id: crypto.randomUUID(),
                            type: 'url',
                            url: url,
                            name: url.substring(url.lastIndexOf('/') + 1),
                            category: category
                        });
                    } else if (category === 'sertifikat' && Array.isArray(dokumen.sertifikat)) {
                        dokumen.sertifikat.forEach(url => {
                            if (url) {
                                selectedSert.push({
                                    id: crypto.randomUUID(),
                                    type: 'url',
                                    url: base_url + url,
                                    name: url.substring(url.lastIndexOf('/') + 1),
                                    category: category
                                });
                            }
                        });
                    }
                }
            }
        }
        pecahDokumen();

        // SUBMIT FORM PROFIL & BUKU INDUK
        $('#submit-profil').click(function (e) {
            e.preventDefault();

            // 1. Serialize KGB
            var kgbArr = [];
            $('#tbodyGuruKgb tr').each(function() {
                var pangkat = $(this).find('.kgb-pangkat').val();
                var noSk = $(this).find('.kgb-no-sk').val();
                if ((pangkat && pangkat.trim() !== '') || (noSk && noSk.trim() !== '')) {
                    kgbArr.push({
                        pangkat_golongan: pangkat ? pangkat.trim() : '',
                        nomor_sk: noSk ? noSk.trim() : '',
                        tanggal_sk: $(this).find('.kgb-tgl-sk').val() || '',
                        tmt_kgb: $(this).find('.kgb-tmt').val() || '',
                        masa_kerja: $(this).find('.kgb-mk').val() || '',
                        gaji_pokok: $(this).find('.kgb-gaji').val() || '',
                        penerbit: $(this).find('.kgb-penerbit').val() || ''
                    });
                }
            });
            $('#hidden_riwayat_kgb').val(JSON.stringify(kgbArr));

            // 2. Serialize Kepangkatan
            var pktArr = [];
            $('#tbodyGuruKepangkatan tr').each(function() {
                var pangkat = $(this).find('.pkt-pangkat').val();
                var noSk = $(this).find('.pkt-no-sk').val();
                if ((pangkat && pangkat.trim() !== '') || (noSk && noSk.trim() !== '')) {
                    pktArr.push({
                        pangkat_golongan: pangkat ? pangkat.trim() : '',
                        nomor_sk: noSk ? noSk.trim() : '',
                        tanggal_sk: $(this).find('.pkt-tgl-sk').val() || '',
                        tmt_pangkat: $(this).find('.pkt-tmt').val() || '',
                        masa_kerja: $(this).find('.pkt-mk').val() || ''
                    });
                }
            });
            $('#hidden_riwayat_kepangkatan').val(JSON.stringify(pktArr));

            // 3. Serialize Pembelajaran
            var pbmArr = [];
            $('#tbodyGuruPembelajaran tr').each(function() {
                var rombel = $(this).find('.pbm-rombel').val();
                var mapel = $(this).find('.pbm-mapel').val();
                if ((rombel && rombel.trim() !== '') || (mapel && mapel.trim() !== '')) {
                    pbmArr.push({
                        rombel: rombel ? rombel.trim() : '',
                        mapel: mapel ? mapel.trim() : '',
                        jam: $(this).find('.pbm-jam').val() || 0
                    });
                }
            });
            $('#hidden_lampiran_pembelajaran').val(JSON.stringify(pbmArr));

            const formData = new FormData($('#formguru')[0]);

            // Append File Blobs if selected
            if (selectedSert.length > 0) {
                selectedSert.forEach((item) => {
                    if (item.type === 'file') {
                        formData.append(`serti[]`, item.file, item.name);
                    }
                });
            }
            if (selectedKtp.length > 0 && selectedKtp[0].type === 'file') {
                formData.append(`ktp_id`, selectedKtp[0].file, selectedKtp[0].name);
            }
            if (selectedKk.length > 0 && selectedKk[0].type === 'file') {
                formData.append(`kk_id`, selectedKk[0].file, selectedKk[0].name);
            }

            var btn = $('#submit-profil');
            btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-1"></i> Menyimpan...');

            $.ajax({
                url: base_url + "guru/save",
                type: "POST",
                dataType: "JSON",
                processData: false,
                contentType: false,
                data: formData,
                success: function (data) {
                    btn.prop('disabled', false).html('<i class="fas fa-save me-1"></i> Simpan Profil');
                    if (data.status) {
                        Swal.fire({
                            title: "Sukses!",
                            text: "Profil Guru & Buku Induk Dapodik berhasil diperbarui dan disinkronkan!",
                            icon: "success",
                            confirmButtonText: "OK"
                        }).then(result => {
                            if (data.dokumen) {
                                dokumen = data.dokumen;
                                pecahDokumen();
                                renderThumbnails(thumbnailKtp, selectedKtp, addKtp, 1);
                                renderThumbnails(thumbnailKk, selectedKk, addKk, 2);
                                renderThumbnails(thumbnailSert, selectedSert, addSert, 3);
                            }
                        });
                    } else {
                        var errMsg = data.message || "Validasi gagal";
                        if (data.errors && Object.keys(data.errors).length > 0) {
                            errMsg += "<br><small>" + Object.values(data.errors).filter(Boolean).join("<br>") + "</small>";
                        }
                        Swal.fire({
                            title: "Perhatian",
                            html: errMsg,
                            icon: "error"
                        });
                    }
                }, 
                error: function (xhr, status, error) {
                    btn.prop('disabled', false).html('<i class="fas fa-save me-1"></i> Simpan Profil');
                    Swal.fire({
                        title: "Error",
                        text: "Terjadi kesalahan sistem saat menyimpan profil.",
                        icon: "error"
                    });
                }
            });
        });

        // UPDATE LOGIN (PASSWORD & USERNAME)
        $('#updatelogin').on('submit', function (e) {
            e.preventDefault();
            var dataPost = $(this).serialize();
            $('#editLoginModal').modal('hide');

            $.ajax({
                url: base_url + "userguru/editlogin",
                type: "POST",
                dataType: "JSON",
                data: dataPost,
                success: function (data) {
                    if (data.status) {
                        Swal.fire({
                            title: "Sukses",
                            html: data.text,
                            icon: "success"
                        }).then(() => {
                            window.location.reload();
                        });
                    } else {
                        Swal.fire({
                            title: "Gagal",
                            html: data.text || "Gagal memperbarui login.",
                            icon: "error"
                        });
                    }
                }, 
                error: function () {
                    Swal.fire("Error", "Gagal menghubungi server", "error");
                }
            });
        });

        // PHOTO UPLOAD ATTACH
        function uploadAttach(action, data) {
            $.ajax({
                type: "POST",
                enctype: 'multipart/form-data',
                url: action,
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {
                    fotoProfile = data.src;
                    if (data.status) {
                        $('#foto-guru').attr('src', data.src);
                    }
                }
            });
        }

        $("#foto-profile").change(function () {
            var input = $(this)[0];
            if (input.files && input.files[0]) {
                var form = new FormData($('#set-foto-profile')[0]);
                uploadAttach(base_url + 'guru/uploadfile/' + idGuru, form);
            }
        });

        // THUMBNAIL DOCUMENTS SETUP
        const ktpInput = document.getElementById('ktp_id');
        const kkInput = document.getElementById('kk_id');
        const sertInput = document.getElementById('sertifikat');

        const thumbnailKtp = document.getElementById('thumbnail_ktp_id');
        const thumbnailKk = document.getElementById('thumbnail_kk_id');
        const thumbnailSert = document.getElementById('thumbnail_sertifikat');

        const addKtp = document.getElementById('add_ktp_id');
        const addKk = document.getElementById('add_kk_id');
        const addSert = document.getElementById('add_sertifikat');

        const fullscreenPreviewOverlay = document.getElementById('fullscreenPreviewOverlay');
        const fullscreenImage = document.getElementById('fullscreenImage');
        const fullscreenCloseButton = document.getElementById('fullscreenCloseButton');
        const fullscreenDownloadButton = document.getElementById('fullscreenDownloadButton');
        const fullscreenDeleteButton = document.getElementById('fullscreenDeleteButton');

        $('.add-photo-button').on('click', function() {
            const id = (this.id).replace('add_', '');
            $(`#${id}`).click();
        });

        if (ktpInput) {
            ktpInput.addEventListener('change', function() {
                for (const file of this.files) {
                    selectedKtp.push({ id: crypto.randomUUID(), type: 'file', file: file, name: file.name });
                }
                renderThumbnails(thumbnailKtp, selectedKtp, addKtp, 1);
            });
        }

        if (kkInput) {
            kkInput.addEventListener('change', function() {
                for (const file of this.files) {
                    selectedKk.push({ id: crypto.randomUUID(), type: 'file', file: file, name: file.name });
                }
                renderThumbnails(thumbnailKk, selectedKk, addKk, 2);
            });
        }

        if (sertInput) {
            sertInput.addEventListener('change', function() {
                for (const file of this.files) {
                    selectedSert.push({ id: crypto.randomUUID(), type: 'file', file: file, name: file.name });
                }
                renderThumbnails(thumbnailSert, selectedSert, addSert, 3);
            });
        }

        function renderThumbnails(thumbnail, files, btn, type) {
            if (!thumbnail) return;
            const currentElements = Array.from(thumbnail.children);
            currentElements.forEach(el => {
                if (!el.classList.contains('add-photo-button')) {
                    thumbnail.removeChild(el);
                }
            });

            if (type < 3) {
                if (files.length === 0) {
                    btn.classList.remove('d-none');
                } else {
                    btn.classList.add('d-none');
                }
            }

            if (files.length === 0) return;

            files.forEach((item) => {
                const thumbnailItem = document.createElement('div');
                thumbnailItem.className = 'thumbnail-item position-relative m-1 d-inline-block';
                thumbnailItem.dataset.id = item.id;
                const img = document.createElement('img');
                img.style.width = '90px';
                img.style.height = '90px';
                img.style.objectFit = 'cover';
                img.className = 'rounded-3 shadow-sm border';

                let previewSrc = '';
                if (item.type === 'file') {
                    previewSrc = URL.createObjectURL(item.file);
                    img.alt = item.name;
                    img.onload = () => URL.revokeObjectURL(previewSrc);
                } else if (item.type === 'url') {
                    previewSrc = item.url;
                    img.alt = item.name;
                }
                img.src = previewSrc;
                img.addEventListener('click', () => openFullscreenPreview(item));

                const thumbBtnGroup = document.createElement('div');
                thumbBtnGroup.className = 'position-absolute top-0 end-0 m-1 d-flex gap-1';

                const deleteButton = document.createElement('button');
                deleteButton.type = 'button';
                deleteButton.className = 'btn btn-sm btn-danger p-0 px-1';
                deleteButton.innerHTML = '&times;';
                deleteButton.title = 'Hapus';
                deleteButton.addEventListener('click', (event) => {
                    event.stopPropagation();
                    const idToDelete = thumbnailItem.dataset.id;
                    const actualIndex = files.findIndex(f => f.id === idToDelete);
                    if (actualIndex !== -1) {
                        removeFile(actualIndex, type);
                    }
                });

                thumbBtnGroup.appendChild(deleteButton);
                thumbnailItem.appendChild(img);
                thumbnailItem.appendChild(thumbBtnGroup);

                if (type === 3) {
                    thumbnail.insertBefore(thumbnailItem, btn);
                } else {
                    thumbnail.appendChild(thumbnailItem);
                }
            });
            thumbnail.appendChild(btn);
        }

        function openFullscreenPreview(item) {
            let displaySrc = item.type === 'file' ? URL.createObjectURL(item.file) : item.url;
            fullscreenImage.src = displaySrc;
            fullscreenDownloadButton.href = displaySrc;
            fullscreenDownloadButton.download = item.name || 'document';
            fullscreenDeleteButton.dataset.src = displaySrc;
            fullscreenPreviewOverlay.classList.add('visible');
        }

        function closeFullscreenPreview() {
            fullscreenPreviewOverlay.classList.remove('visible');
            fullscreenImage.src = '';
        }

        if (fullscreenCloseButton) {
            fullscreenCloseButton.addEventListener('click', closeFullscreenPreview);
        }
        if (fullscreenPreviewOverlay) {
            fullscreenPreviewOverlay.addEventListener('click', (event) => {
                if (event.target === fullscreenPreviewOverlay) closeFullscreenPreview();
            });
        }

        renderThumbnails(thumbnailKtp, selectedKtp, addKtp, 1);
        renderThumbnails(thumbnailKk, selectedKk, addKk, 2);
        renderThumbnails(thumbnailSert, selectedSert, addSert, 3);

        function removeFile(indexToRemove, type) {
            Swal.fire({
                title: "Hapus dokumen?",
                text: "Dokumen ini akan dihapus dari sistem",
                showCancelButton: true,
                confirmButtonText: "Ya, Hapus!",
                cancelButtonText: "Batal",
                icon: "warning"
            }).then(result => {
                if (result.value) {
                    if (type === 1) {
                        if (selectedKtp[indexToRemove].type === 'file') {
                            selectedKtp.splice(indexToRemove, 1);
                            renderThumbnails(thumbnailKtp, selectedKtp, addKtp, type);
                        } else {
                            deleteDokumen(selectedKtp[indexToRemove].url);
                        }
                    } else if (type === 2) {
                        if (selectedKk[indexToRemove].type === 'file') {
                            selectedKk.splice(indexToRemove, 1);
                            renderThumbnails(thumbnailKk, selectedKk, addKk, type);
                        } else {
                            deleteDokumen(selectedKk[indexToRemove].url);
                        }
                    } else if (type === 3) {
                        if (selectedSert[indexToRemove].type === 'file') {
                            selectedSert.splice(indexToRemove, 1);
                            renderThumbnails(thumbnailSert, selectedSert, addSert, type);
                        } else {
                            deleteDokumen(selectedSert[indexToRemove].url);
                        }
                    }
                }
            });
        }

        function deleteDokumen(src) {
            $.ajax({
                data: {src: src},
                type: "GET",
                url: base_url + "guru/delete_dokumen/" + idGuru,
                success: function (response) {
                    closeFullscreenPreview();
                    dokumen = response.dokumen;
                    pecahDokumen();
                    renderThumbnails(thumbnailKtp, selectedKtp, addKtp, 1);
                    renderThumbnails(thumbnailKk, selectedKk, addKk, 2);
                    renderThumbnails(thumbnailSert, selectedSert, addSert, 3);
                }
            });
        }
    });

    function deleteImage(fromBtn) {
        $.ajax({
            data: {src: src},
            type: "GET",
            url: base_url + "guru/deletefile/" + idGuru,
            success: function () {
                if (fromBtn) window.location.reload();
            }
        });
    }
</script>
<?= $this->endSection() ?>
