<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kartu Login Siswa | <?= $bulk ? 'Semua Siswa' : esc($rows[0][0]['nama']) ?></title>
    <style>
        :root { color-scheme: light; font-family: system-ui, sans-serif; color: #17243b; }
        * { box-sizing: border-box; }
        body { margin: 0; padding: 24px; background: #edf2f8; }
        .actions, .notice { max-width: 105mm; margin: 0 auto 14px; }
        .bulk .actions, .bulk .notice, .bulk .cards { max-width: 190mm; }
        .cards { margin: 0 auto; }
        .card-row { display: flex; align-items: stretch; gap: 4mm; margin-bottom: 4mm; }
        .bulk .card { width: calc((100% - 4mm) / 2); margin: 0; }
        .actions { display: flex; gap: 8px; flex-wrap: wrap; align-items: center; }
        .actions a, button, .actions select { border: 1px solid #234d8a; border-radius: 7px; padding: 8px 12px; color: #234d8a; background: #fff; font: inherit; text-decoration: none; cursor: pointer; }
        button { background: #234d8a; color: #fff; }
        .btn-excel { border-color: #15803d !important; color: #15803d !important; }
        .notice { padding: 10px; background: #fff4dc; border-radius: 7px; font-size: .85rem; }
        .card { width: 105mm; max-width: 100%; margin: auto; border: 1px solid #9aaec8; border-radius: 3mm; overflow: hidden; background: #fff; overflow-wrap: anywhere; }
        .heading { display: flex; align-items: center; justify-content: space-between; gap: 3mm; padding: 3.5mm 5mm; background: #1e4275; color: #fff; }
        .heading-text { min-width: 0; flex: 1; }
        .heading h1 { margin: 1mm 0 0; font-size: 15pt; line-height: 1.2; }
        .school { font-size: 8pt; font-weight: 700; letter-spacing: .04em; }
        .school-logo { width: 11.5mm; height: 11.5mm; object-fit: contain; flex-shrink: 0; background: #fff; border-radius: 2mm; padding: 1mm; }
        .identity { display: grid; grid-template-columns: 17mm minmax(0, 1fr); gap: 4mm; padding: 4mm 5mm 3mm; align-items: start; }
        .photo { width: 17mm; height: 21mm; object-fit: cover; border-radius: 2mm; background: #edf2f8; }
        .name { font-weight: 700; font-size: 11pt; margin: 0 0 1mm; }
        .identity p { margin: 0 0 .5mm; font-size: 8pt; }
        .login { margin: 0 5mm; padding: 2.5mm 3mm; background: #edf3ff; border: 1px solid #d3dff3; border-radius: 2mm; font-size: 8.5pt; }
        .login dl { display: grid; grid-template-columns: 19mm minmax(0, 1fr); gap: 1mm 2mm; margin: 0; }
        .login dt { font-weight: 700; }
        .login dd { margin: 0; }
        .password { font-weight: 700; color: #0f172a; white-space: pre-wrap; }
        .footnote { margin: 2mm 5mm 3mm; color: #45556e; font-size: 7.5pt; }
        @media screen and (max-width: 640px) {
            .card-row { display: block; }
            .bulk .card { width: 100%; margin: 0 0 4mm; }
        }
        @page { size: A4 portrait; margin: 10mm; }
        @media print {
            body { padding: 0; background: #fff; }
            .actions, .notice { display: none; }
            .card-row { break-inside: avoid; page-break-inside: avoid; }
            .card { margin: 0; break-inside: avoid; print-color-adjust: exact; -webkit-print-color-adjust: exact; }
            .heading { background: #fff; color: #1e4275; border-bottom: 1px solid #9aaec8; }
            .school-logo { background: transparent; padding: 0; border-radius: 0; }
        }
    </style>
</head>
<body class="<?= $bulk ? 'bulk' : 'single' ?>">
    <nav class="actions" aria-label="Aksi kartu">
        <?php if ($total > 0): ?>
            <button type="button" onclick="window.print()">Cetak / Simpan PDF</button>
        <?php endif; ?>
        <?php if ($bulk && !empty($kelass)): ?>
            <select aria-label="Filter Kelas" onchange="window.location.href='<?= esc(base_url('datasiswa/kartu/semua'), 'attr') ?>' + (this.value ? '?kelas=' + encodeURIComponent(this.value) : '')">
                <option value="">Semua Kelas</option>
                <?php foreach ($kelass as $kId => $kNama): ?>
                    <option value="<?= esc((string) $kId, 'attr') ?>" <?= (string) $selectedKelas === (string) $kId ? 'selected' : '' ?>>
                        Kelas <?= esc((string) $kNama) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        <?php endif; ?>
        <?php if ($bulk): ?>
            <a class="btn-excel" href="<?= esc(base_url('datasiswa/export_excel' . ($selectedKelas !== '' ? '?kelas=' . rawurlencode((string) $selectedKelas) : '')), 'attr') ?>">Download Excel</a>
        <?php endif; ?>
        <a href="<?= esc(base_url('datasiswa'), 'attr') ?>">Kembali ke Data Siswa</a>
    </nav>
    <?php if ($total === 0): ?>
        <p class="notice">Belum ada data siswa untuk dicetak.</p>
    <?php elseif ($bulk): ?>
        <p class="notice">
            <?= $total ?> kartu siswa · A4 potret
            <?php if ($perluPeriksa > 0): ?>
                · <?= $perluPeriksa ?> akun perlu diperiksa sebelum kartu dibagikan.
            <?php endif; ?>
        </p>
    <?php elseif ($perluPeriksa > 0): ?>
        <p class="notice"><?= esc($rows[0][0]['status']) ?></p>
    <?php endif; ?>
    <main class="cards">
        <?php foreach ($rows as $row): ?>
            <div class="card-row">
                <?php foreach ($row as $card): ?>
                    <article class="card">
                        <header class="heading">
                            <div class="heading-text">
                                <div class="school"><?= esc($setting->sekolah ?? 'Sekolah') ?></div>
                                <h1>Kartu Login Siswa</h1>
                            </div>
                            <?php if (!empty($logoUrl)): ?>
                                <img class="school-logo" src="<?= esc($logoUrl, 'attr') ?>" alt="Logo Lembaga" onerror="this.style.display='none'">
                            <?php endif; ?>
                        </header>
                        <div class="identity">
                            <img class="photo" src="<?= esc($card['fotoUrl'], 'attr') ?>" alt="Foto siswa">
                            <div>
                                <h2 class="name"><?= esc($card['nama']) ?></h2>
                                <p>NIS · <?= esc($card['nis'] ?: '—') ?></p>
                                <p>NISN · <?= esc($card['nisn'] ?: '—') ?></p>
                                <p>Kelas · <?= esc($card['kelas'] ?: '—') ?></p>
                            </div>
                        </div>
                        <section class="login" aria-label="Data login">
                            <dl>
                                <dt>Alamat login</dt><dd><?= esc($loginUrl) ?></dd>
                                <dt>Username</dt><dd><?= esc($card['username'] !== '' ? $card['username'] : '—') ?></dd>
                                <dt>Password</dt><dd class="password"><?= esc($card['password'] !== '' ? $card['password'] : 'Hubungi admin') ?></dd>
                            </dl>
                        </section>
                        <p class="footnote">Untuk siswa yang bersangkutan. Simpan kartu ini secara pribadi.</p>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    </main>
    <?php if ($total > 0): ?>
        <script>
            window.addEventListener('load', function () {
                window.print();
            }, { once: true });
        </script>
    <?php endif; ?>
</body>
</html>
