<?= $this->extend('layout/dashboard_template_bs5') ?>
<?= $this->section('content') ?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">
                    <i class="fas fa-chart-pie mr-2 text-primary"></i><?= $judul ?>
                </h1>
                <p class="text-muted mt-1"><?= $subjudul ?></p>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Ujian</a></li>
                    <li class="breadcrumb-item active">Analisis Soal</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <!-- Custom CSS for NextGen UI -->
        <style>
            .glass-card {
                background: rgba(255, 255, 255, 0.95);
                backdrop-filter: blur(10px);
                border: 1px solid rgba(0,0,0,0.05);
                box-shadow: 0 8px 32px rgba(0, 0, 0, 0.05);
                border-radius: 12px;
            }
            .filter-card {
                background: linear-gradient(135deg, #fdfbfb 0%, #ebedee 100%);
                border-left: 4px solid #007bff;
            }
            .stat-box {
                border-radius: 12px;
                padding: 20px;
                color: white;
                position: relative;
                overflow: hidden;
                box-shadow: 0 4px 15px rgba(0,0,0,0.1);
                transition: transform 0.3s;
            }
            .stat-box:hover {
                transform: translateY(-5px);
            }
            .stat-box.bg-primary-grad { background: linear-gradient(135deg, #007bff, #0056b3); }
            .stat-box.bg-success-grad { background: linear-gradient(135deg, #28a745, #1e7e34); }
            .stat-box.bg-warning-grad { background: linear-gradient(135deg, #ffc107, #d39e00); }
            .stat-box.bg-danger-grad { background: linear-gradient(135deg, #dc3545, #bd2130); }
            
            .stat-box i {
                position: absolute;
                right: 15px;
                bottom: 10px;
                font-size: 3rem;
                opacity: 0.2;
            }
            
            .stat-title {
                font-size: 0.9rem;
                font-weight: 600;
                text-transform: uppercase;
                letter-spacing: 1px;
                opacity: 0.9;
            }
            .stat-value {
                font-size: 2.2rem;
                font-weight: 700;
                margin: 5px 0;
            }
            
            .table-nextgen {
                border-collapse: separate;
                border-spacing: 0;
                width: 100%;
            }
            .table-nextgen thead th {
                background: #f8f9fa;
                color: #495057;
                font-weight: 600;
                border: none;
                padding: 15px;
                text-transform: uppercase;
                font-size: 0.85rem;
                letter-spacing: 0.5px;
            }
            .table-nextgen tbody td {
                padding: 15px;
                vertical-align: middle;
                border-bottom: 1px solid #f0f0f0;
                font-size: 0.95rem;
            }
            .table-nextgen tbody tr:hover {
                background: #fdfdfd;
                box-shadow: 0 2px 10px rgba(0,0,0,0.02);
                transform: scale(1.002);
                transition: all 0.2s;
            }
            
            .dist-bar {
                height: 8px;
                border-radius: 4px;
                background: #e9ecef;
                margin-top: 4px;
                overflow: hidden;
                display: flex;
            }
            .dist-fill {
                height: 100%;
            }
            
            .badge-custom {
                padding: 6px 12px;
                border-radius: 20px;
                font-weight: 600;
                font-size: 0.8rem;
            }
        </style>

        <!-- Filter Section -->
        <div class="card glass-card filter-card mb-4">
            <div class="card-body">
                <form id="filterForm">
                    <div class="row align-items-end">
                        <div class="col-md-3 mb-3 mb-md-0">
                            <label class="text-sm text-muted">Jadwal Ujian</label>
                            <select class="form-control select2" style="width: 100%;">
                                <option>PTS Ganjil 2026 - Matematika</option>
                                <option>PAS Ganjil 2026 - Bahasa Indonesia</option>
                            </select>
                        </div>
                        <div class="col-md-3 mb-3 mb-md-0">
                            <label class="text-sm text-muted">Kelas</label>
                            <select class="form-control select2" style="width: 100%;">
                                <option>Semua Kelas</option>
                                <option>X MIPA 1</option>
                                <option>X MIPA 2</option>
                            </select>
                        </div>
                        <div class="col-md-3 mb-3 mb-md-0">
                            <label class="text-sm text-muted">Sesi</label>
                            <select class="form-control select2" style="width: 100%;">
                                <option>Semua Sesi</option>
                                <option>Sesi 1</option>
                                <option>Sesi 2</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <button type="button" class="btn btn-primary btn-block rounded-pill">
                                <i class="fas fa-sync-alt mr-2"></i> Proses Analisis
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Summary Stats -->
        <div class="row mb-4">
            <div class="col-md-3 col-sm-6 mb-3">
                <div class="stat-box bg-primary-grad">
                    <div class="stat-title">Total Peserta</div>
                    <div class="stat-value">124</div>
                    <div class="text-sm opacity-75">Siswa hadir ujian</div>
                    <i class="fas fa-users"></i>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-3">
                <div class="stat-box bg-success-grad">
                    <div class="stat-title">Rata-Rata Nilai</div>
                    <div class="stat-value">78.5</div>
                    <div class="text-sm opacity-75">KKM: 75.0</div>
                    <i class="fas fa-chart-line"></i>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-3">
                <div class="stat-box bg-warning-grad">
                    <div class="stat-title">Reliabilitas</div>
                    <div class="stat-value">0.82</div>
                    <div class="text-sm opacity-75">Kategori: Sangat Baik</div>
                    <i class="fas fa-check-double"></i>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-3">
                <div class="stat-box bg-danger-grad">
                    <div class="stat-title">Soal Perlu Revisi</div>
                    <div class="stat-value">4</div>
                    <div class="text-sm opacity-75">Dari 40 total soal</div>
                    <i class="fas fa-tools"></i>
                </div>
            </div>
        </div>

        <!-- Main Table -->
        <div class="card glass-card">
            <div class="card-header bg-white border-0 pt-4 pb-0 d-flex justify-content-between align-items-center">
                <h3 class="card-title font-weight-bold text-dark">
                    <i class="fas fa-list-ol mr-2 text-primary"></i> Tabel Analisis Butir Soal
                </h3>
                <div class="card-tools">
                    <button class="btn btn-outline-success btn-sm rounded-pill mr-2">
                        <i class="fas fa-file-excel mr-1"></i> Export Excel
                    </button>
                    <button class="btn btn-outline-danger btn-sm rounded-pill">
                        <i class="fas fa-file-pdf mr-1"></i> Print PDF
                    </button>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-nextgen" id="tableAnalisis">
                    <thead>
                        <tr>
                            <th width="5%" class="text-center">No</th>
                            <th width="10%">Tipe</th>
                            <th width="10%" class="text-center">Kunci</th>
                            <th width="15%">Kesukaran</th>
                            <th width="15%">Daya Beda</th>
                            <th width="25%">Distribusi Jawaban</th>
                            <th width="12%" class="text-center">Status</th>
                            <th width="8%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Soal 1 -->
                        <tr>
                            <td class="text-center font-weight-bold">1</td>
                            <td>Pilihan Ganda</td>
                            <td class="text-center font-weight-bold text-success">C</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <span class="badge bg-success badge-custom mr-2">Mudah</span>
                                    <small class="text-muted">P = 0.85</small>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <span class="badge bg-primary badge-custom mr-2">Baik</span>
                                    <small class="text-muted">D = 0.45</small>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex justify-content-between text-xs mb-1">
                                    <span>A(5%)</span><span>B(10%)</span><span class="text-success font-weight-bold">C(85%)</span><span>D(0%)</span><span>E(0%)</span>
                                </div>
                                <div class="dist-bar">
                                    <div class="dist-fill bg-secondary" style="width: 5%"></div>
                                    <div class="dist-fill bg-secondary opacity-75" style="width: 10%"></div>
                                    <div class="dist-fill bg-success" style="width: 85%"></div>
                                </div>
                            </td>
                            <td class="text-center">
                                <span class="text-success font-weight-bold"><i class="fas fa-check-circle mr-1"></i>Diterima</span>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-info btn-circle shadow-sm" title="Lihat Detail Soal"><i class="fas fa-search"></i></button>
                            </td>
                        </tr>
                        
                        <!-- Soal 2 -->
                        <tr>
                            <td class="text-center font-weight-bold">2</td>
                            <td>Pilihan Ganda</td>
                            <td class="text-center font-weight-bold text-success">A</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <span class="badge bg-warning badge-custom mr-2">Sedang</span>
                                    <small class="text-muted">P = 0.50</small>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <span class="badge bg-success badge-custom mr-2">S. Baik</span>
                                    <small class="text-muted">D = 0.65</small>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex justify-content-between text-xs mb-1">
                                    <span class="text-success font-weight-bold">A(50%)</span><span>B(20%)</span><span>C(10%)</span><span>D(15%)</span><span>E(5%)</span>
                                </div>
                                <div class="dist-bar">
                                    <div class="dist-fill bg-success" style="width: 50%"></div>
                                    <div class="dist-fill bg-secondary" style="width: 20%"></div>
                                    <div class="dist-fill bg-secondary opacity-75" style="width: 10%"></div>
                                    <div class="dist-fill bg-secondary opacity-50" style="width: 15%"></div>
                                    <div class="dist-fill bg-secondary opacity-25" style="width: 5%"></div>
                                </div>
                            </td>
                            <td class="text-center">
                                <span class="text-success font-weight-bold"><i class="fas fa-check-circle mr-1"></i>Diterima</span>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-info btn-circle shadow-sm" title="Lihat Detail Soal"><i class="fas fa-search"></i></button>
                            </td>
                        </tr>
                        
                        <!-- Soal 3 (Revisi) -->
                        <tr>
                            <td class="text-center font-weight-bold">3</td>
                            <td>Pilihan Ganda</td>
                            <td class="text-center font-weight-bold text-success">E</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <span class="badge bg-danger badge-custom mr-2">Sukar</span>
                                    <small class="text-muted">P = 0.15</small>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <span class="badge bg-warning badge-custom mr-2">Cukup</span>
                                    <small class="text-muted">D = 0.25</small>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex justify-content-between text-xs mb-1">
                                    <span>A(30%)</span><span class="text-danger font-weight-bold">B(40%)</span><span>C(10%)</span><span>D(5%)</span><span class="text-success font-weight-bold">E(15%)</span>
                                </div>
                                <div class="dist-bar">
                                    <div class="dist-fill bg-secondary" style="width: 30%"></div>
                                    <div class="dist-fill bg-danger" style="width: 40%" title="Pengecoh Terlalu Kuat"></div>
                                    <div class="dist-fill bg-secondary opacity-50" style="width: 10%"></div>
                                    <div class="dist-fill bg-secondary opacity-25" style="width: 5%"></div>
                                    <div class="dist-fill bg-success" style="width: 15%"></div>
                                </div>
                                <small class="text-danger mt-1 d-block"><i class="fas fa-exclamation-triangle"></i> Pengecoh B dominan</small>
                            </td>
                            <td class="text-center">
                                <span class="text-warning font-weight-bold"><i class="fas fa-edit mr-1"></i>Revisi</span>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-info btn-circle shadow-sm" title="Lihat Detail Soal"><i class="fas fa-search"></i></button>
                            </td>
                        </tr>

                        <!-- Soal 4 (Ditolak) -->
                        <tr>
                            <td class="text-center font-weight-bold">4</td>
                            <td>Pilihan Ganda</td>
                            <td class="text-center font-weight-bold text-success">B</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <span class="badge bg-danger badge-custom mr-2">Sukar</span>
                                    <small class="text-muted">P = 0.10</small>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <span class="badge bg-danger badge-custom mr-2">Jelek</span>
                                    <small class="text-muted">D = -0.15</small>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex justify-content-between text-xs mb-1">
                                    <span>A(25%)</span><span class="text-success font-weight-bold">B(10%)</span><span>C(25%)</span><span>D(20%)</span><span>E(20%)</span>
                                </div>
                                <div class="dist-bar">
                                    <div class="dist-fill bg-secondary" style="width: 25%"></div>
                                    <div class="dist-fill bg-success" style="width: 10%"></div>
                                    <div class="dist-fill bg-secondary opacity-75" style="width: 25%"></div>
                                    <div class="dist-fill bg-secondary opacity-50" style="width: 20%"></div>
                                    <div class="dist-fill bg-secondary opacity-25" style="width: 20%"></div>
                                </div>
                                <small class="text-danger mt-1 d-block"><i class="fas fa-exclamation-triangle"></i> Daya beda negatif</small>
                            </td>
                            <td class="text-center">
                                <span class="text-danger font-weight-bold"><i class="fas fa-times-circle mr-1"></i>Ditolak</span>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-info btn-circle shadow-sm" title="Lihat Detail Soal"><i class="fas fa-search"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
