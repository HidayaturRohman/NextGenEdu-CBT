<?= $this->extend('layout/dashboard_template_bs5') ?>
<?= $this->section('content') ?>

<div class="d-contents">
    <div class="card mb-4 shadow-sm border-0 no-print">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                <div class="d-flex align-items-center">
                    <div class="me-3 flex-shrink-0">
                        <div class="rounded-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 50px; height: 50px; background: linear-gradient(135deg, #198754 0%, #157347 100%); color: #ffffff;">
                            <i class="fas fa-table fs-4"></i>
                        </div>
                    </div>
                    <div>
                        <h4 class="card-title mb-1 fw-bold text-dark d-flex align-items-center flex-wrap gap-2">
                            <span>Legger Kelas <?= esc($kelases->nama_kelas ?? '-') ?></span>
                            <span class="badge bg-<?= ($current_mode ?? 'katrol') === 'katrol' ? 'warning text-dark' : 'secondary' ?> fs-6 fw-normal px-2 py-1">
                                <i class="fas fa-<?= ($current_mode ?? 'katrol') === 'katrol' ? 'balance-scale' : 'file-alt' ?> me-1"></i>
                                <?= ($current_mode ?? 'katrol') === 'katrol' ? 'Mode: Nilai Katrol' : 'Mode: Nilai Asli (Murni)' ?>
                            </span>
                        </h4>
                        <p class="text-muted mb-0" style="font-size: 0.9rem;">
                            Rekapitulasi Nilai Akhir Peserta Didik Semester <?= (strpos(strtolower($smt_active->smt ?? ''), '2') !== false || strpos(strtolower($smt_active->smt ?? ''), 'genap') !== false) ? 'Genap' : 'Ganjil' ?> Tahun Pelajaran <?= esc($tp_active->tahun ?? '2025/2026') ?>.
                        </p>
                    </div>
                </div>
                <div class="d-flex gap-2 flex-wrap align-items-center">
                    <?php if (($current_mode ?? 'katrol') === 'katrol'): ?>
                        <a href="<?= base_url('rapor/cetakleger/' . ($kelases->id_kelas ?? '') . '?mode=asli') ?>" class="btn btn-outline-secondary shadow-sm rounded-pill px-3 fw-bold" title="Klik untuk menampilkan Nilai Asli / Murni CBT">
                            <i class="fas fa-undo me-1"></i> Lihat Nilai Asli
                        </a>
                    <?php else: ?>
                        <a href="<?= base_url('rapor/cetakleger/' . ($kelases->id_kelas ?? '') . '?mode=katrol') ?>" class="btn btn-outline-warning text-dark shadow-sm rounded-pill px-3 fw-bold" title="Klik untuk menampilkan Nilai Katrol CBT">
                            <i class="fas fa-balance-scale-right me-1"></i> Lihat Nilai Katrol
                        </a>
                    <?php endif; ?>
                    <a href="<?= base_url('rapor/cetakranking/' . ($kelases->id_kelas ?? '') . (!empty($_GET['mode']) ? '?mode=' . esc($_GET['mode']) : '')) ?>" class="btn btn-warning shadow-sm rounded-pill px-4 fw-bold text-dark">
                        <i class="fas fa-trophy me-1"></i> Ranking Nilai
                    </a>
                    <button type="button" id="btn-export-excel" class="btn btn-success shadow-sm rounded-pill px-4 fw-bold">
                        <i class="fas fa-file-excel me-1"></i> Export ke Excel
                    </button>
                    <button type="button" onclick="window.print()" class="btn btn-primary shadow-sm rounded-pill px-4 fw-bold">
                        <i class="fas fa-print me-1"></i> Cetak Legger
                    </button>
                </div>
            </div>
        </div>
    </div>

    <?php
    // ==========================================
    // KLASIFIKASI MATA PELAJARAN SESUAI STANDAR RDM
    // ==========================================
    $paiSlots = [];
    $umumSlots = [];
    $mulokSlots = [];

    function categorizeMapel($m) {
        $nm = strtolower(trim($m->nama_mapel ?? ''));
        $kd = strtoupper(trim($m->kode ?? ($m->kode_mapel ?? '')));

        // PAI
        if (strpos($nm, "qur'an") !== false || strpos($nm, "quran") !== false || strpos($nm, "hadis") !== false || strpos($nm, "hadits") !== false || $kd === 'QH') {
            return ['group' => 'PAI', 'code' => 'QH', 'order' => 1];
        }
        if (strpos($nm, "akidah") !== false || strpos($nm, "aqidah") !== false || strpos($nm, "akhlak") !== false || $kd === 'AA') {
            return ['group' => 'PAI', 'code' => 'AA', 'order' => 2];
        }
        if (strpos($nm, "fikih") !== false || strpos($nm, "fiqih") !== false || $kd === 'FIK') {
            return ['group' => 'PAI', 'code' => 'FIK', 'order' => 3];
        }
        if (strpos($nm, "sejarah") !== false || strpos($nm, "kebudayaan") !== false || strpos($nm, "ski") !== false || $kd === 'SKI') {
            return ['group' => 'PAI', 'code' => 'SKI', 'order' => 4];
        }

        // UMUM
        if (strpos($nm, "arab") !== false || $kd === 'BAR' || $kd === 'ARB') {
            return ['group' => 'UMUM', 'code' => 'BAR', 'order' => 5];
        }
        if (strpos($nm, "pancasila") !== false || strpos($nm, "pkn") !== false || $kd === 'PP') {
            return ['group' => 'UMUM', 'code' => 'PP', 'order' => 6];
        }
        if (strpos($nm, "indonesia") !== false || $kd === 'BINDO' || $kd === 'IND') {
            return ['group' => 'UMUM', 'code' => 'BINDO', 'order' => 7];
        }
        if (strpos($nm, "matematika") !== false || $kd === 'MTK' || $kd === 'MAT') {
            return ['group' => 'UMUM', 'code' => 'MTK', 'order' => 8];
        }
        if ((strpos($nm, "alam") !== false || strpos($nm, "ipa") !== false) && strpos($nm, "sosial") === false || $kd === 'IPA') {
            return ['group' => 'UMUM', 'code' => 'IPA', 'order' => 9];
        }
        if (strpos($nm, "sosial") !== false || strpos($nm, "ips") !== false || $kd === 'IPS') {
            return ['group' => 'UMUM', 'code' => 'IPS', 'order' => 10];
        }
        if (strpos($nm, "inggris") !== false || $kd === 'BING' || $kd === 'ING') {
            return ['group' => 'UMUM', 'code' => 'BING', 'order' => 11];
        }
        if (strpos($nm, "jasmani") !== false || strpos($nm, "olahraga") !== false || strpos($nm, "pjok") !== false || strpos($nm, "penjas") !== false || $kd === 'PJOK') {
            return ['group' => 'UMUM', 'code' => 'PJOK', 'order' => 12];
        }
        if (strpos($nm, "informatika") !== false || strpos($nm, "tik") !== false || strpos($nm, "komputer") !== false || $kd === 'INFO') {
            return ['group' => 'UMUM', 'code' => 'INFO', 'order' => 13];
        }
        // PENDIDIKAN SENI (Kurikulum Merdeka: PS) / SENI BUDAYA
        if (strpos($nm, "seni") !== false || strpos($nm, "budaya") !== false || strpos($nm, "sbdp") !== false || $kd === 'PS' || $kd === 'SB' || $kd === 'SBK' || $kd === 'SBP' || $kd === 'SBDP') {
            return ['group' => 'UMUM', 'code' => 'PS', 'order' => 14];
        }
        // PRAKARYA
        if (strpos($nm, "prakarya") !== false || $kd === 'PRA' || $kd === 'PKR' || $kd === 'PK') {
            return ['group' => 'UMUM', 'code' => 'PRA', 'order' => 15];
        }

        // MULOK
        if (strpos($nm, "jawa") !== false || $kd === 'B. JA' || $kd === 'JAWA') {
            return ['group' => 'MULOK', 'code' => 'B. Ja', 'order' => 16];
        }
        if (strpos($nm, "aswaja") !== false || strpos($nm, "nu") !== false || $kd === 'AS') {
            return ['group' => 'MULOK', 'code' => 'AS', 'order' => 17];
        }
        if (strpos($nm, "aqidatul") !== false || strpos($nm, "awwam") !== false || $kd === 'AW') {
            return ['group' => 'MULOK', 'code' => 'AW', 'order' => 18];
        }

        if (($m->kelompok ?? '') === 'MULOK' || (isset($m->kategori) && strtolower($m->kategori) === 'mulok')) {
            $short = !empty($m->kode) ? $m->kode : (!empty($m->kode_mapel) ? $m->kode_mapel : substr($m->nama_mapel, 0, 4));
            return ['group' => 'MULOK', 'code' => strtoupper($short), 'order' => 19];
        }

        $short = !empty($m->kode) ? $m->kode : (!empty($m->kode_mapel) ? $m->kode_mapel : substr($m->nama_mapel, 0, 4));
        return ['group' => 'UMUM', 'code' => strtoupper($short), 'order' => 20];
    }

    foreach ($mapels as $m) {
        $cat = categorizeMapel($m);
        $entry = [
            'id_mapel' => $m->id_mapel,
            'nama_mapel' => $m->nama_mapel,
            'code' => $cat['code'],
            'group' => $cat['group'],
            'order' => $cat['order']
        ];
        if ($cat['group'] === 'PAI') {
            $paiSlots[] = $entry;
        } elseif ($cat['group'] === 'MULOK') {
            $mulokSlots[] = $entry;
        } else {
            $umumSlots[] = $entry;
        }
    }

    $allActiveSlots = array_merge($paiSlots, $umumSlots, $mulokSlots);

    // Hilangkan slot duplikat dengan kode yang sama (misal PS ganda dari Seni Budaya lama vs Pendidikan Seni baru)
    // Utamakan mapel yang memiliki nilai siswa
    $dedupedSlots = [];
    foreach ($allActiveSlots as $slot) {
        $code = $slot['code'];
        if (!isset($dedupedSlots[$code])) {
            $dedupedSlots[$code] = $slot;
        } else {
            $scoreCntExisting = 0;
            $scoreCntNew = 0;
            foreach ($siswas as $sw) {
                $r1 = $nilai[$sw->id_siswa][$dedupedSlots[$code]['id_mapel']] ?? null;
                if ($r1 && (!empty($r1->nilai_akhir) || !empty($r1->nilai_sts) || !empty($r1->nilai_sas))) $scoreCntExisting++;
                $r2 = $nilai[$sw->id_siswa][$slot['id_mapel']] ?? null;
                if ($r2 && (!empty($r2->nilai_akhir) || !empty($r2->nilai_sts) || !empty($r2->nilai_sas))) $scoreCntNew++;
            }
            if ($scoreCntNew > $scoreCntExisting) {
                $dedupedSlots[$code] = $slot;
            }
        }
    }

    // Rebuild paiSlots, umumSlots, mulokSlots dari dedupedSlots agar tabel dan export konsisten
    $paiSlots = [];
    $umumSlots = [];
    $mulokSlots = [];
    foreach ($dedupedSlots as $slot) {
        if ($slot['group'] === 'PAI') {
            $paiSlots[] = $slot;
        } elseif ($slot['group'] === 'MULOK') {
            $mulokSlots[] = $slot;
        } else {
            $umumSlots[] = $slot;
        }
    }
    usort($paiSlots, function($a, $b) { return $a['order'] <=> $b['order']; });
    usort($umumSlots, function($a, $b) { return $a['order'] <=> $b['order']; });
    usort($mulokSlots, function($a, $b) { return $a['order'] <=> $b['order']; });

    $allActiveSlots = array_merge($paiSlots, $umumSlots, $mulokSlots);

    // Hitung total nilai per siswa
    $rekapSiswa = [];
    foreach ($siswas as $s) {
        $tot = 0;
        $scores = [];
        foreach ($allActiveSlots as $slot) {
            $mId = $slot['id_mapel'];
            $row = $nilai[$s->id_siswa][$mId] ?? null;
            $na = null;
            if ($row) {
                if (isset($row->nilai_akhir) && $row->nilai_akhir !== '' && $row->nilai_akhir !== null) {
                    $na = intval(round(floatval($row->nilai_akhir)));
                } elseif (isset($row->nilai_sas) && $row->nilai_sas !== '' && $row->nilai_sas !== null) {
                    $na = intval(round(floatval($row->nilai_sas)));
                } elseif (isset($row->nilai_sts) && $row->nilai_sts !== '' && $row->nilai_sts !== null) {
                    $na = intval(round(floatval($row->nilai_sts)));
                } elseif (isset($row->rata_sumatif) && $row->rata_sumatif !== '' && $row->rata_sumatif !== null) {
                    $na = intval(round(floatval($row->rata_sumatif)));
                }
            }
            $scores[$mId] = $na;
            if ($na !== null && $na > 0) {
                $tot += $na;
            }
        }
        $rekapSiswa[] = [
            'siswa' => $s,
            'scores' => $scores,
            'total' => $tot
        ];
    }

    // ==========================================
    // PAGINASI MULTI-HALAMAN PERSIS RDM
    // ==========================================
    // Halaman 1: KOP + Data + 12 Siswa (No 1 - 12) + Footer Halaman 1
    // Halaman 2+: Data + Siswa berikutnya + Tanda Tangan + Footer Halaman 2
    $pageSizePage1 = 12;
    $pageSizeOther = 12;

    $pages = [];
    $totalSiswa = count($rekapSiswa);

    if ($totalSiswa <= 10) {
        // Jika siswa sedikit (<= 10), muat semua di halaman 1 bersama tanda tangan
        $pages[] = [
            'page_num' => 1,
            'is_first' => true,
            'is_last' => true,
            'students' => $rekapSiswa,
            'start_idx' => 0
        ];
    } else {
        // Halaman 1: 12 siswa
        $pages[] = [
            'page_num' => 1,
            'is_first' => true,
            'is_last' => false,
            'students' => array_slice($rekapSiswa, 0, $pageSizePage1),
            'start_idx' => 0
        ];
        $remaining = array_slice($rekapSiswa, $pageSizePage1);
        $pageIdx = 2;
        $currStart = $pageSizePage1;
        $remChunks = array_chunk($remaining, $pageSizeOther);
        foreach ($remChunks as $cIdx => $chunk) {
            $isLast = ($cIdx === count($remChunks) - 1);
            $pages[] = [
                'page_num' => $pageIdx++,
                'is_first' => false,
                'is_last' => $isLast,
                'students' => $chunk,
                'start_idx' => $currStart
            ];
            $currStart += count($chunk);
        }
    }

    $smtLabel = (strpos(strtolower($smt_active->smt ?? ''), '2') !== false || strpos(strtolower($smt_active->smt ?? ''), 'genap') !== false) ? 'Genap' : 'Ganjil';
    
    // Deteksi cerdas Kemenag vs Kemendikdasmen
    $schInfo = detectSchoolType($setting);
    $isKemenag = $schInfo->is_kemenag;
    $satuanLabel = $schInfo->satuan_label;
    $kepsekLabel = $schInfo->kepsek_label;
    $kementerianLabel = $schInfo->kementerian;
    $logoGovUrl = $schInfo->logo_gov;

    $barisDesa = strtoupper($setting->desa ?? 'SUMBERAGUNG');
    $kec = $setting->kecamatan ?? 'Plumpang';
    $kab = $setting->kota ?? 'Tuban';
    $prov = $setting->provinsi ?? 'Jawa Timur';
    $namaWali = $guru->nama_guru ?? ($kelases->nama_guru ?? 'H. ASROFIQ, S. Pd.');
    // Aturan Guru: H. Asrofiq selalu NIP, jika guru lain ikuti jenis_nip guru
    $isAsrofiq = (stripos($namaWali, 'asrofiq') !== false);
    if ($isAsrofiq) {
        $jenisNipWali = 'NIP';
    } elseif (!empty($guru->jenis_nip)) {
        $jenisNipWali = strtoupper($guru->jenis_nip);
    } elseif (isset($rapor_setting->nip_walikelas) && $rapor_setting->nip_walikelas == 1) {
        $jenisNipWali = 'NPK';
    } else {
        $jenisNipWali = 'NIP';
    }
    $numWali = !empty($guru->nip) ? $guru->nip : (!empty($guru->nuptk) ? $guru->nuptk : (!empty($guru->npk) ? $guru->npk : '-'));
    $nipWali = (isset($rapor_setting->nip_walikelas) && $rapor_setting->nip_walikelas == 2) ? '' : ($jenisNipWali . '. ' . $numWali);

    $namaKepsek = $setting->kepsek ?? 'ABD. ROZAK, S.Pd.I.';
    // Aturan Kepala Madrasah: Abd. Rozak selalu NUPTK
    $isRozak = (stripos($namaKepsek, 'rozak') !== false);
    if ($isRozak) {
        $labelKepsek = 'NUPTK';
    } elseif (!empty($setting->label_nip)) {
        $labelKepsek = strtoupper($setting->label_nip);
    } elseif (isset($rapor_setting->nip_kepsek) && $rapor_setting->nip_kepsek == 1) {
        $labelKepsek = 'NPK';
    } else {
        $labelKepsek = 'NUPTK';
    }
    $numKepsek = !empty($setting->nuptk) ? $setting->nuptk : (!empty($guru_kepsek->nuptk) ? $guru_kepsek->nuptk : (!empty($setting->nip) ? $setting->nip : (!empty($setting->nip_kepsek) ? $setting->nip_kepsek : '-')));
    $nipKepsek = (isset($rapor_setting->nip_kepsek) && $rapor_setting->nip_kepsek == 2) ? '' : ($labelKepsek . '. ' . $numKepsek);
    $tglRapor = !empty($rapor_setting->tanggal_rapor) ? date('d F Y', strtotime($rapor_setting->tanggal_rapor)) : '20 Desember 2025';
    ?>

    <!-- CONTAINER TAMPILAN / CETAK MULTI-HALAMAN -->
    <div id="area-leger-container">
        <?php foreach ($pages as $pIdx => $p): ?>
            <div class="page-leger bg-white shadow mb-4 mx-auto <?= ($pIdx < count($pages) - 1) ? 'page-break' : '' ?>">
                <div class="page-leger-content">
                <?php if ($p['is_first']): ?>
                    <!-- ==================== HALAMAN 1 (DENGAN KOP LENGKAP & JUDUL) ==================== -->
                    <!-- 1. KOP SURAT RESMI (KEMENAG / KEMENDIKDASMEN) -->
                    <table style="width: 100%; border-collapse: collapse; margin-bottom: 2px;">
                        <tr>
                            <td style="width: 14%; text-align: center; vertical-align: middle;">
                                <img src="<?= $logoGovUrl ?>" alt="Logo <?= $satuanLabel ?>" style="max-height: 65px; max-width: 65px; height: auto; width: auto; object-fit: contain; margin-top: 2px;" onerror="this.src='<?= $logoGovUrl ?>'">
                            </td>
                            <td style="width: 86%; text-align: center; vertical-align: middle; padding-right: 7%;">
                                <div style="font-size: 11pt; font-weight: bold; letter-spacing: 0.5px; text-transform: uppercase;"><?= $kementerianLabel ?></div>
                                <div style="font-size: 14pt; font-weight: bold; letter-spacing: 0.5px; margin-top: 1px; text-transform: uppercase;"><?= esc($setting->sekolah ?? 'SEKOLAH') ?></div>
                                <div style="font-size: 11pt; font-weight: bold; margin-top: 1px; text-transform: uppercase;"><?= esc($barisDesa) ?></div>
                                <div style="font-size: 9.5pt; font-style: italic; margin-top: 1px;">Kecamatan <?= esc($kec) ?>, Kabupaten <?= esc($kab) ?> - <?= esc($prov) ?></div>
                            </td>
                        </tr>
                    </table>
                    <div style="border-top: 2.5px solid #000; margin: 4px 0 5px 0;"></div>

                    <!-- 2. DATA METADATA -->
                    <table style="width: 100%; font-size: 9.5pt; font-weight: normal; margin-bottom: 2px;">
                        <tr>
                            <td style="width: 12%;">Kelas</td>
                            <td style="width: 2%;">:</td>
                            <td style="width: 50%;"><b><?= esc($kelases->nama_kelas ?? 'VII') ?></b></td>
                            <td style="width: 18%;">Tahun Pelajaran</td>
                            <td style="width: 2%;">:</td>
                            <td style="width: 16%;"><?= esc($tp_active->tahun ?? '2025/2026') ?></td>
                        </tr>
                        <tr>
                            <td><?= $satuanLabel ?></td>
                            <td>:</td>
                            <td><?= esc($setting->sekolah ?? '-') ?></td>
                            <td>Semester</td>
                            <td>:</td>
                            <td><?= esc($smtLabel) ?></td>
                        </tr>
                    </table>
                    <div style="border-top: 2.5px solid #000; margin: 4px 0 8px 0;"></div>

                    <!-- 3. JUDUL DOKUMEN -->
                    <div style="text-align: center; font-size: 13pt; font-weight: bold; letter-spacing: 0.5px; margin-bottom: 2px;">
                        LEGGER KELAS
                    </div>
                    <div style="font-size: 9pt; font-weight: bold; margin-bottom: 6px;">
                        KKTP = (x)
                    </div>

                <?php else: ?>
                    <!-- ==================== HALAMAN 2 & SETERUSNYA (HEADER COMPACT TANPA KOP) ==================== -->
                    <div style="border-top: 2.5px solid #000; margin: 0 0 5px 0;"></div>
                    <table style="width: 100%; font-size: 9.5pt; font-weight: normal; margin-bottom: 2px;">
                        <tr>
                            <td style="width: 12%;">Kelas</td>
                            <td style="width: 2%;">:</td>
                            <td style="width: 50%;"><b><?= esc($kelases->nama_kelas ?? 'VII') ?></b></td>
                            <td style="width: 18%;">Tahun Pelajaran</td>
                            <td style="width: 2%;">:</td>
                            <td style="width: 16%;"><?= esc($tp_active->tahun ?? '2025/2026') ?></td>
                        </tr>
                        <tr>
                            <td><?= $satuanLabel ?></td>
                            <td>:</td>
                            <td><?= esc($setting->sekolah ?? '-') ?></td>
                            <td>Semester</td>
                            <td>:</td>
                            <td><?= esc($smtLabel) ?></td>
                        </tr>
                    </table>
                    <div style="border-top: 2.5px solid #000; margin: 4px 0 8px 0;"></div>
                <?php endif; ?>

                <!-- TABEL DATA NILAI SISWA PER HALAMAN -->
                <div class="table-responsive">
                    <table class="tbl-legger-rdm" style="width: 100%; border-collapse: collapse; font-family: Arial, Helvetica, sans-serif; font-size: 8.5pt; border: 1px solid #000; margin-bottom: 0;">
                        <thead>
                            <tr style="background-color: #d1d5db; -webkit-print-color-adjust: exact; print-color-adjust: exact;">
                                <th rowspan="2" style="border: 1px solid #000; padding: 4px 2px; text-align: center; vertical-align: middle; width: 30px;">No</th>
                                <th rowspan="2" style="border: 1px solid #000; padding: 4px 6px; text-align: center; vertical-align: middle; min-width: 180px;">Nama</th>
                                
                                <?php if (!empty($paiSlots)): ?>
                                    <th colspan="<?= count($paiSlots) ?>" style="border: 1px solid #000; padding: 3px 2px; text-align: center; vertical-align: middle;">PAI</th>
                                <?php endif; ?>

                                <?php foreach ($umumSlots as $u): ?>
                                    <th rowspan="2" style="border: 1px solid #000; padding: 3px 2px; text-align: center; vertical-align: middle; width: 34px;" title="<?= esc($u['nama_mapel']) ?>"><?= esc($u['code']) ?></th>
                                <?php endforeach; ?>

                                <?php if (!empty($mulokSlots)): ?>
                                    <th colspan="<?= count($mulokSlots) ?>" style="border: 1px solid #000; padding: 3px 2px; text-align: center; vertical-align: middle;">MULOK</th>
                                <?php endif; ?>

                                <th rowspan="2" style="border: 1px solid #000; padding: 4px 3px; text-align: center; vertical-align: middle; width: 48px;">TOTAL</th>
                            </tr>
                            <tr style="background-color: #d1d5db; -webkit-print-color-adjust: exact; print-color-adjust: exact;">
                                <?php foreach ($paiSlots as $pSlot): ?>
                                    <th style="border: 1px solid #000; padding: 3px 2px; text-align: center; width: 28px;" title="<?= esc($pSlot['nama_mapel']) ?>"><?= esc($pSlot['code']) ?></th>
                                <?php endforeach; ?>
                                <?php foreach ($mulokSlots as $mSlot): ?>
                                    <th style="border: 1px solid #000; padding: 3px 2px; text-align: center; width: 30px;" title="<?= esc($mSlot['nama_mapel']) ?>"><?= esc($mSlot['code']) ?></th>
                                <?php endforeach; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($p['students'] as $idx => $r): 
                                $sw = $r['siswa'];
                                $rowNo = $p['start_idx'] + $idx + 1;
                            ?>
                                <tr>
                                    <td style="border: 1px solid #000; padding: 3px 2px; text-align: center;"><?= $rowNo ?></td>
                                    <td style="border: 1px solid #000; padding: 3px 6px; white-space: nowrap;"><?= esc(strtoupper($sw->nama)) ?></td>
                                    
                                    <?php foreach ($paiSlots as $pSlot): ?>
                                        <td style="border: 1px solid #000; padding: 3px 2px; text-align: center;"><?= !empty($r['scores'][$pSlot['id_mapel']]) ? $r['scores'][$pSlot['id_mapel']] : '' ?></td>
                                    <?php endforeach; ?>

                                    <?php foreach ($umumSlots as $u): ?>
                                        <td style="border: 1px solid #000; padding: 3px 2px; text-align: center;"><?= !empty($r['scores'][$u['id_mapel']]) ? $r['scores'][$u['id_mapel']] : '' ?></td>
                                    <?php endforeach; ?>

                                    <?php foreach ($mulokSlots as $mSlot): ?>
                                        <td style="border: 1px solid #000; padding: 3px 2px; text-align: center;"><?= !empty($r['scores'][$mSlot['id_mapel']]) ? $r['scores'][$mSlot['id_mapel']] : '' ?></td>
                                    <?php endforeach; ?>

                                    <td style="border: 1px solid #000; padding: 3px 2px; text-align: center; font-weight: bold;"><?= $r['total'] > 0 ? $r['total'] : '0' ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <?php if ($p['is_last']): ?>
                    <!-- TANDA TANGAN (HANYA MUNCUL DI HALAMAN TERAKHIR) -->
                    <table style="width: 100%; margin-top: 15px; margin-bottom: 0; font-size: 10pt; font-family: 'Times New Roman', serif; page-break-inside: avoid;">
                        <tr>
                            <td style="width: 50%; text-align: left; vertical-align: top; padding-left: 10px;">
                                Mengetahui<br>
                                <?= $kepsekLabel ?>
                                <br><br><br><br>
                                <b><u><?= esc($namaKepsek) ?></u></b><br>
                                <?= esc($nipKepsek) ?>
                            </td>
                            <td style="width: 50%; text-align: right; vertical-align: top; padding-right: 10px;">
                                <div style="display: inline-block; text-align: left;">
                                    <?= esc(ucwords(strtolower($setting->desa ?? 'Sumberagung'))) ?>, <?= esc($tglRapor) ?><br>
                                    Wali Kelas:
                                    <br><br><br><br>
                                    <b><u><?= esc($namaWali) ?></u></b><br>
                                    <?= esc($nipWali) ?>
                                </div>
                            </td>
                        </tr>
                    </table>
                <?php endif; ?>
                </div>

                <!-- FOOTER HALAMAN PERSIS RDM -->
                <div class="page-leger-footer">
                    <div>LEGGER KELAS <?= esc($kelases->nama_kelas ?? 'VII') ?></div>
                    <div>Halaman <?= $p['page_num'] ?></div>
                </div>

            </div>
        <?php endforeach; ?>
    </div>

    <!-- TABEL LENGKAP TERSEMBUNYI UNTUK EXPORT KE EXCEL (SEMUA SISWA DALAM 1 SHEET) -->
    <div style="display: none;">
        <table id="table-leger-export">
            <thead>
                <tr>
                    <th colspan="<?= 3 + count($paiSlots) + count($umumSlots) + count($mulokSlots) ?>">
                        LEGGER KELAS <?= esc($kelases->nama_kelas ?? 'VII') ?> - <?= esc($setting->sekolah ?? 'MTsS HIDAYATUL ISLAMIYAH') ?>
                    </th>
                </tr>
                <tr>
                    <th rowspan="2">No</th>
                    <th rowspan="2">Nama</th>
                    <?php if (!empty($paiSlots)): ?>
                        <th colspan="<?= count($paiSlots) ?>">PAI</th>
                    <?php endif; ?>
                    <?php foreach ($umumSlots as $u): ?>
                        <th rowspan="2"><?= esc($u['code']) ?></th>
                    <?php endforeach; ?>
                    <?php if (!empty($mulokSlots)): ?>
                        <th colspan="<?= count($mulokSlots) ?>">MULOK</th>
                    <?php endif; ?>
                    <th rowspan="2">TOTAL</th>
                </tr>
                <tr>
                    <?php foreach ($paiSlots as $pSlot): ?>
                        <th><?= esc($pSlot['code']) ?></th>
                    <?php endforeach; ?>
                    <?php foreach ($mulokSlots as $mSlot): ?>
                        <th><?= esc($mSlot['code']) ?></th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rekapSiswa as $idx => $r): 
                    $sw = $r['siswa'];
                ?>
                    <tr>
                        <td><?= $idx + 1 ?></td>
                        <td><?= esc(strtoupper($sw->nama)) ?></td>
                        <?php foreach ($paiSlots as $pSlot): ?>
                            <td><?= !empty($r['scores'][$pSlot['id_mapel']]) ? $r['scores'][$pSlot['id_mapel']] : '' ?></td>
                        <?php endforeach; ?>
                        <?php foreach ($umumSlots as $u): ?>
                            <td><?= !empty($r['scores'][$u['id_mapel']]) ? $r['scores'][$u['id_mapel']] : '' ?></td>
                        <?php endforeach; ?>
                        <?php foreach ($mulokSlots as $mSlot): ?>
                            <td><?= !empty($r['scores'][$mSlot['id_mapel']]) ? $r['scores'][$mSlot['id_mapel']] : '' ?></td>
                        <?php endforeach; ?>
                        <td><?= $r['total'] > 0 ? $r['total'] : '0' ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<style>
.page-leger {
    width: 297mm;
    min-height: 205mm;
    padding: 8mm 12mm 12mm 12mm;
    margin: 0 auto 25px auto;
    background-color: #ffffff;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    box-sizing: border-box;
    font-family: 'Times New Roman', serif;
    color: #000;
    position: relative;
}

.page-leger-content {
    /* Normal document flow - compact, tight, and neat */
}

/* TABLE STYLE RDM TEGAS & HITAM JELAS */
.tbl-legger-rdm {
    width: 100% !important;
    border-collapse: collapse !important;
    font-family: Arial, Helvetica, sans-serif !important;
    font-size: 8.5pt !important;
    border: 1px solid #000000 !important;
    margin-bottom: 0 !important;
}

.tbl-legger-rdm th,
.tbl-legger-rdm td {
    border: 1px solid #000000 !important;
    border-color: #000000 !important;
    color: #000000 !important;
}

.tbl-legger-rdm thead th {
    background-color: #d1d5db !important;
    color: #000000 !important;
    font-weight: bold !important;
    border: 1px solid #000000 !important;
    border-color: #000000 !important;
    -webkit-print-color-adjust: exact !important;
    print-color-adjust: exact !important;
}

.tbl-legger-rdm tbody tr td {
    border: 1px solid #000000 !important;
    border-color: #000000 !important;
}

.page-leger-footer {
    position: absolute;
    bottom: 6mm;
    left: 12mm;
    right: 12mm;
    display: flex;
    justify-content: space-between;
    font-size: 9pt;
    font-family: 'Times New Roman', serif;
}

@page {
    size: A4 landscape;
    margin: 10mm 12mm 8mm 12mm;
}

.page-break {
    page-break-after: always;
    break-after: page;
}

@media print {
    body, html {
        background: #ffffff !important;
        margin: 0 !important;
        padding: 0 !important;
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
    }

    .main-content,
    .content-inner,
    .container-fluid.content-inner,
    .container-fluid,
    .row,
    .col-sm-12 {
        margin: 0 !important;
        padding: 0 !important;
        margin-top: 0 !important;
        padding-top: 0 !important;
    }

    .no-print,
    .iq-top-navbar,
    .iq-sidebar,
    .navbar,
    .sidebar,
    .footer,
    footer,
    button {
        display: none !important;
    }

    .card {
        border: none !important;
        box-shadow: none !important;
        margin: 0 !important;
        padding: 0 !important;
        background: transparent !important;
    }

    .card-body {
        padding: 0 !important;
    }

    .page-leger {
        width: 100% !important;
        height: 190mm !important;
        min-height: 190mm !important;
        max-height: 190mm !important;
        box-shadow: none !important;
        padding: 3mm 2mm 0 2mm !important;
        margin: 0 !important;
        position: relative !important;
        page-break-after: always !important;
        break-after: page !important;
    }

    .page-leger:last-child {
        page-break-after: avoid !important;
        break-after: avoid !important;
    }

    .page-leger-footer {
        position: absolute !important;
        bottom: 0 !important;
        left: 0 !important;
        right: 0 !important;
        display: flex !important;
        justify-content: space-between !important;
        font-size: 9pt !important;
    }

    .tbl-legger-rdm {
        width: 100% !important;
        font-size: 8.5pt !important;
        margin-bottom: 0 !important;
        border: 1px solid #000000 !important;
        border-collapse: collapse !important;
    }

    .tbl-legger-rdm th,
    .tbl-legger-rdm td {
        border: 1px solid #000000 !important;
        border-color: #000000 !important;
        color: #000000 !important;
    }

    .tbl-legger-rdm thead th {
        background-color: #d1d5db !important;
        border: 1px solid #000000 !important;
        border-color: #000000 !important;
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
    }

    .tbl-legger-rdm td {
        padding: 2.5px 3px !important;
        border: 1px solid #000000 !important;
        border-color: #000000 !important;
    }

    .table-responsive {
        overflow: visible !important;
        margin-bottom: 0 !important;
    }
}
</style>

<script src="<?= base_url('assets/app/js/tableToExcel.js') ?>"></script>
<script>
    $(document).ready(function () {
        ajaxcsrf();

        $('#btn-export-excel').on('click', function () {
            var table = document.getElementById("table-leger-export");
            TableToExcel.convert(table, {
                name: "LEGGER_NILAI_KELAS_<?= esc($kelases->nama_kelas ?? 'VII') ?>.xlsx",
                sheet: {
                    name: "Leger Nilai"
                }
            });
        });

        <?php if (!empty($_GET['autodownload'])): ?>
        setTimeout(function () {
            $('#btn-export-excel').trigger('click');
        }, 300);
        <?php endif; ?>
    });
</script>
<?= $this->endSection() ?>
