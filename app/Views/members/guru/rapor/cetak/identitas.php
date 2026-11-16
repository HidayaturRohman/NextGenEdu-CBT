<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Identitas Peserta Didik - <?= esc($siswa->nama ?? 'Siswa') ?></title>
    <style>
        @page {
            size: A4 portrait;
            margin: 15mm 15mm 15mm 20mm;
        }
        body {
            font-family: 'Times New Roman', serif;
            font-size: 10.5pt;
            line-height: 1.35;
            margin: 0;
            padding: 0;
            color: #000;
        }
        .page-identitas {
            width: 100%;
            box-sizing: border-box;
        }
        .title {
            text-align: center;
            font-size: 13pt;
            font-weight: bold;
            margin-bottom: 20px;
            letter-spacing: 0.5px;
        }
        table.tbl-data {
            width: 100%;
            border-collapse: collapse;
        }
        table.tbl-data td {
            padding: 3px 2px;
            vertical-align: top;
        }
        .photo-box {
            width: 30mm;
            height: 40mm;
            border: 1px solid #000;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            font-size: 9pt;
            color: #555;
            margin-top: 10px;
        }
        @media print {
            .no-print { display: none !important; }
        }
    </style>
</head>
<body>
    <div class="no-print" style="position: fixed; top: 10px; right: 10px; z-index: 9999;">
        <button onclick="window.print()" style="padding: 10px 20px; font-weight: bold; background: #2563eb; color: #fff; border: none; border-radius: 20px; cursor: pointer; box-shadow: 0 2px 8px rgba(0,0,0,0.3);">
            Cetak Identitas
        </button>
    </div>

    <?php
        $schName = $sekolah->sekolah ?? ($setting->sekolah ?? '');
        $schInfo = detectSchoolType($schName);
        $isKemenag = $schInfo->is_kemenag;
        $labelKepsek = $schInfo->kepsek_label;
    ?>
    <div class="page-identitas">
        <div class="title">IDENTITAS PESERTA DIDIK</div>

        <table class="tbl-data">
            <tr>
                <td style="width: 5%;">1.</td>
                <td style="width: 35%;">Nama Lengkap</td>
                <td style="width: 2%;">:</td>
                <td style="width: 58%;"><b><?= esc($siswa->nama ?? '-') ?></b></td>
            </tr>
            <tr>
                <td>2.</td>
                <td>Nomor Induk / NISN</td>
                <td>:</td>
                <td><?= esc($siswa->nis ?? '-') ?> / <?= esc($siswa->nisn ?? '-') ?></td>
            </tr>
            <tr>
                <td>3.</td>
                <td>Tempat, Tanggal Lahir</td>
                <td>:</td>
                <td><?= esc($siswa->tempat_lahir ?? '-') ?>, <?= !empty($siswa->tanggal_lahir) ? date('d F Y', strtotime($siswa->tanggal_lahir)) : '-' ?></td>
            </tr>
            <tr>
                <td>4.</td>
                <td>Jenis Kelamin</td>
                <td>:</td>
                <td><?= ($siswa->jenis_kelamin ?? 'L') === 'P' ? 'Perempuan' : 'Laki-laki' ?></td>
            </tr>
            <tr>
                <td>5.</td>
                <td>Agama</td>
                <td>:</td>
                <td><?= esc($siswa->agama ?? 'Islam') ?></td>
            </tr>
            <tr>
                <td>6.</td>
                <td>Status dalam Keluarga</td>
                <td>:</td>
                <td><?= esc($siswa->status_keluarga ?? 'Anak Kandung') ?></td>
            </tr>
            <tr>
                <td>7.</td>
                <td>Anak ke</td>
                <td>:</td>
                <td><?= esc($siswa->anak_ke ?? '1') ?></td>
            </tr>
            <tr>
                <td>8.</td>
                <td>Alamat Peserta Didik</td>
                <td>:</td>
                <td><?= esc($siswa->alamat ?? '-') ?> <?= esc($siswa->desa ?? '') ?> <?= esc($siswa->kecamatan ?? '') ?></td>
            </tr>
            <tr>
                <td>9.</td>
                <td>Nomor Telepon Rumah / HP</td>
                <td>:</td>
                <td><?= esc($siswa->hp ?? '-') ?></td>
            </tr>
            <tr>
                <td>10.</td>
                <td><?= $isKemenag ? 'Madrasah / Sekolah Asal (SD/MI)' : 'Sekolah Asal' ?></td>
                <td>:</td>
                <td><?= esc($siswa->sekolah_asal ?? '-') ?></td>
            </tr>
            <tr>
                <td>11.</td>
                <td><?= $isKemenag ? 'Diterima di Madrasah ini' : 'Diterima di Sekolah ini' ?></td>
                <td>:</td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td>a. Di kelas</td>
                <td>:</td>
                <td>VII (Tujuh)</td>
            </tr>
            <tr>
                <td></td>
                <td>b. Pada tanggal</td>
                <td>:</td>
                <td>14 Juli 2025</td>
            </tr>
            <tr>
                <td>12.</td>
                <td>Orang Tua</td>
                <td>:</td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td>a. Nama Ayah</td>
                <td>:</td>
                <td><?= esc($siswa->nama_ayah ?? '-') ?></td>
            </tr>
            <tr>
                <td></td>
                <td>b. Nama Ibu</td>
                <td>:</td>
                <td><?= esc($siswa->nama_ibu ?? '-') ?></td>
            </tr>
            <tr>
                <td></td>
                <td>c. Alamat Orang Tua</td>
                <td>:</td>
                <td><?= esc($siswa->alamat ?? '-') ?></td>
            </tr>
            <tr>
                <td></td>
                <td>d. Pekerjaan Ayah</td>
                <td>:</td>
                <td><?= esc($siswa->pekerjaan_ayah ?? '-') ?></td>
            </tr>
            <tr>
                <td></td>
                <td>e. Pekerjaan Ibu</td>
                <td>:</td>
                <td><?= esc($siswa->pekerjaan_ibu ?? '-') ?></td>
            </tr>
            <tr>
                <td>13.</td>
                <td>Wali Peserta Didik</td>
                <td>:</td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td>a. Nama Wali</td>
                <td>:</td>
                <td><?= esc($siswa->nama_wali ?? '-') ?></td>
            </tr>
            <tr>
                <td></td>
                <td>b. Pekerjaan Wali</td>
                <td>:</td>
                <td><?= esc($siswa->pekerjaan_wali ?? '-') ?></td>
            </tr>
            <tr>
                <td></td>
                <td>c. Alamat Wali</td>
                <td>:</td>
                <td><?= esc($siswa->alamat_wali ?? '-') ?></td>
            </tr>
        </table>

        <!-- Foto & Tanda Tangan -->
        <table style="width: 100%; margin-top: 25px;">
            <tr>
                <td style="width: 30%; text-align: center; vertical-align: top;">
                    <div class="photo-box" style="margin: 0 auto;">
                        <?php if (!empty($siswa->foto)): ?>
                            <img src="<?= base_url($siswa->foto) ?>" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.parentNode.innerHTML='Foto Siswa<br>3 x 4'">
                        <?php else: ?>
                            Foto Siswa<br>3 x 4
                        <?php endif; ?>
                    </div>
                </td>
                <td style="width: 30%;"></td>
                <td style="width: 40%; text-align: center; vertical-align: top;">
                    <?= esc($setting->tempat ?? 'Sumberagung') ?>, 14 Juli 2025<br>
                    <?= esc($labelKepsek) ?>
                    <br><br><br><br>
                    <b><u><?= esc($sekolah->kepsek ?? 'ABD. ROZAK, S.Pd.I.') ?></u></b><br>
                    <?= ($setting->nip_kepsek ?? 0) == 1 ? (esc($sekolah->npk ? 'NPK. ' . $sekolah->npk : 'NPK. -')) : (esc($sekolah->nip ? 'NIP. ' . $sekolah->nip : 'NIP. -')) ?>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
