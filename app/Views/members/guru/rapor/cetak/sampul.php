<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sampul Rapor - <?= esc($siswa->nama ?? 'Siswa') ?></title>
    <style>
        @page {
            size: A4 portrait;
            margin: 15mm;
        }
        body {
            font-family: 'Times New Roman', serif;
            margin: 0;
            padding: 0;
            background: #fff;
            color: #000;
        }
        .cover-box {
            border: 3px double #000;
            height: 260mm;
            padding: 20mm 15mm;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            text-align: center;
        }
        .title-1 {
            font-size: 18pt;
            font-weight: bold;
            letter-spacing: 1px;
            margin-bottom: 6px;
        }
        .title-2 {
            font-size: 14pt;
            font-weight: bold;
            margin-bottom: 25px;
        }
        .logo-img {
            width: 120px;
            height: auto;
            margin: 20px auto;
            display: block;
        }
        .student-box {
            margin: 30px auto;
            width: 80%;
            border: 1px solid #000;
            padding: 15px;
            background: #fdfdfd;
        }
        .student-name {
            font-size: 14pt;
            font-weight: bold;
            margin-bottom: 8px;
            text-transform: uppercase;
        }
        .student-nis {
            font-size: 12pt;
        }
        .footer-org {
            font-size: 12pt;
            font-weight: bold;
            text-transform: uppercase;
            line-height: 1.4;
        }
        @media print {
            .no-print { display: none !important; }
        }
    </style>
</head>
<body>
    <div class="no-print" style="position: fixed; top: 10px; right: 10px; z-index: 9999;">
        <button onclick="window.print()" style="padding: 10px 20px; font-weight: bold; background: #2563eb; color: #fff; border: none; border-radius: 20px; cursor: pointer; box-shadow: 0 2px 8px rgba(0,0,0,0.3);">
            Cetak Sampul
        </button>
    </div>

    <?php
        $schInfo = detectSchoolType($sekolah ?? ($setting ?? null));
        $isKemenag = $schInfo->is_kemenag;
        $satuanLabel = $schInfo->satuan_label;
        $kementerianLabel = $schInfo->kementerian;
        $cover_logo = !empty($sekolah->logo_kiri) ? (strpos($sekolah->logo_kiri, 'http') === 0 ? $sekolah->logo_kiri : base_url(ltrim($sekolah->logo_kiri, '/'))) : $schInfo->logo_gov;

        $namaSekolah = ($sekolah->sekolah ?? '');
        $nmUpper = strtoupper($namaSekolah);
        $jenjangTitle = 'MADRASAH TSANAWIYAH (MTs)';
        if ($isKemenag) {
            if (strpos($nmUpper, 'MI ') !== false || strpos($nmUpper, 'MADRASAH IBTIDAIYAH') !== false) {
                $jenjangTitle = 'MADRASAH IBTIDAIYAH (MI)';
            } elseif (strpos($nmUpper, 'MA ') !== false || strpos($nmUpper, 'MADRASAH ALIYAH') !== false) {
                $jenjangTitle = 'MADRASAH ALIYAH (MA)';
            } else {
                $jenjangTitle = 'MADRASAH TSANAWIYAH (MTs)';
            }
        } else {
            if (strpos($nmUpper, 'SD') !== false || strpos($nmUpper, 'SEKOLAH DASAR') !== false) {
                $jenjangTitle = 'SEKOLAH DASAR (SD)';
            } elseif (strpos($nmUpper, 'SMA') !== false) {
                $jenjangTitle = 'SEKOLAH MENENGAH ATAS (SMA)';
            } elseif (strpos($nmUpper, 'SMK') !== false) {
                $jenjangTitle = 'SEKOLAH MENENGAH KEJURUAN (SMK)';
            } else {
                $jenjangTitle = 'SEKOLAH MENENGAH PERTAMA (SMP)';
            }
        }

        $barisDesa = strtoupper($sekolah->desa ?? 'SUMBERAGUNG');
        $kec = strtoupper($sekolah->kecamatan ?? 'PLUMPANG');
        $kab = strtoupper($sekolah->kota ?? 'TUBAN');
    ?>
    <div class="cover-box">
        <div>
            <div class="title-1">RAPOR</div>
            <div class="title-1">LAPORAN HASIL BELAJAR</div>
            <div class="title-2"><?= $jenjangTitle ?></div>
            <img src="<?= $cover_logo ?>" class="logo-img" alt="Logo <?= $satuanLabel ?>" onerror="this.src='<?= $schInfo->logo_gov ?>'">
        </div>

        <div>
            <div style="font-size: 11pt; margin-bottom: 10px;">Nama Peserta Didik:</div>
            <div class="student-box">
                <div class="student-name"><?= esc($siswa->nama ?? '-') ?></div>
                <div class="student-nis">NIS / NISN: <?= esc($siswa->nis ?? '-') ?> / <?= esc($siswa->nisn ?? '-') ?></div>
            </div>
        </div>

        <div class="footer-org">
            <?= $kementerianLabel ?><br>
            <?= esc($sekolah->sekolah ?? '') ?><br>
            <?= esc($barisDesa) ?> - <?= esc($kec) ?> - <?= esc($kab) ?><br>
            <span style="font-weight: normal; font-size: 11pt;"><?= esc($tp_active->tahun ?? '2026/2027') ?></span>
        </div>
    </div>
</body>
</html>
