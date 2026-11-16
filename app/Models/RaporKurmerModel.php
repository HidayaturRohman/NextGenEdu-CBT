<?php
namespace App\Models;

use CodeIgniter\Model;

class RaporKurmerModel extends Model
{
    protected $db;

    public function __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
        $this->checkTables();
    }

    /**
     * Auto migrate tables for Kurikulum Merdeka (IKM)
     */
    public function checkTables()
    {
        $forge = \Config\Database::forge();

        // 1. Setting Rapor Kurikulum Merdeka
        if (!$this->db->tableExists('rapor_kurmer_setting')) {
            $fields = [
                'id_setting' => ['type' => 'INT', 'constraint' => 11, 'auto_increment' => true],
                'id_tp' => ['type' => 'INT', 'constraint' => 11, 'null' => false],
                'id_smt' => ['type' => 'INT', 'constraint' => 11, 'null' => false],
                'fase' => ['type' => 'VARCHAR', 'constraint' => 10, 'default' => 'D'],
                'tempat' => ['type' => 'VARCHAR', 'constraint' => 100, 'default' => 'Sumberagung'],
                'tanggal_rapor' => ['type' => 'DATE', 'null' => true],
                'tanggal_pts' => ['type' => 'DATE', 'null' => true],
                'kkm_default' => ['type' => 'INT', 'constraint' => 5, 'default' => 75],
                'bobot_sumatif' => ['type' => 'INT', 'constraint' => 5, 'default' => 50],
                'bobot_sas' => ['type' => 'INT', 'constraint' => 5, 'default' => 50],
                'nip_kepsek' => ['type' => 'INT', 'constraint' => 1, 'default' => 0], // 0: NIP, 1: NPK
                'nip_walikelas' => ['type' => 'INT', 'constraint' => 1, 'default' => 0],
                'watermark_teks' => ['type' => 'VARCHAR', 'constraint' => 255, 'default' => 'MTs Hidayatul Islamiyah'],
                'model_kop' => ['type' => 'INT', 'constraint' => 1, 'default' => 1], // 0: Tanpa Logo, 1: 1 Logo (Kiri), 2: 2 Logo (Kiri & Kanan)
                'mode_rapor' => ['type' => 'VARCHAR', 'constraint' => 20, 'default' => 'semua'], // semua: Keduanya, sts: Hanya STS, sas: Hanya SAS
                'created_at' => ['type' => 'DATETIME', 'null' => true],
                'updated_at' => ['type' => 'DATETIME', 'null' => true],
            ];
            $forge->addField($fields);
            $forge->addKey('id_setting', true);
            $forge->addKey(['id_tp', 'id_smt']);
            $forge->createTable('rapor_kurmer_setting', true);
        } else {
            if (!$this->db->fieldExists('model_kop', 'rapor_kurmer_setting')) {
                $forge->addColumn('rapor_kurmer_setting', [
                    'model_kop' => ['type' => 'INT', 'constraint' => 1, 'default' => 1]
                ]);
            }
            if (!$this->db->fieldExists('mode_rapor', 'rapor_kurmer_setting')) {
                $forge->addColumn('rapor_kurmer_setting', [
                    'mode_rapor' => ['type' => 'VARCHAR', 'constraint' => 20, 'default' => 'semua']
                ]);
            }
            if (!$this->db->fieldExists('mapel_rapor', 'rapor_kurmer_setting')) {
                $forge->addColumn('rapor_kurmer_setting', [
                    'mapel_rapor' => ['type' => 'LONGTEXT', 'null' => true]
                ]);
            }
            if (!$this->db->fieldExists('mode_mapel_rapor', 'rapor_kurmer_setting')) {
                $forge->addColumn('rapor_kurmer_setting', [
                    'mode_mapel_rapor' => ['type' => 'VARCHAR', 'constraint' => 20, 'default' => 'otomatis']
                ]);
            }
            if (!$this->db->fieldExists('cbt_convert_mode', 'rapor_kurmer_setting')) {
                $forge->addColumn('rapor_kurmer_setting', [
                    'cbt_convert_mode' => ['type' => 'VARCHAR', 'constraint' => 20, 'default' => 'katrol']
                ]);
            }
            if (!$this->db->fieldExists('cbt_katrol_min', 'rapor_kurmer_setting')) {
                $forge->addColumn('rapor_kurmer_setting', [
                    'cbt_katrol_min' => ['type' => 'INT', 'constraint' => 5, 'default' => 60]
                ]);
            }
            if (!$this->db->fieldExists('cbt_katrol_max', 'rapor_kurmer_setting')) {
                $forge->addColumn('rapor_kurmer_setting', [
                    'cbt_katrol_max' => ['type' => 'INT', 'constraint' => 5, 'default' => 100]
                ]);
            }
            if (!$this->db->fieldExists('auto_fill_cbt', 'rapor_kurmer_setting')) {
                $forge->addColumn('rapor_kurmer_setting', [
                    'auto_fill_cbt' => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 1]
                ]);
            }
        }

        // 2. Tujuan Pembelajaran (TP) & Lingkup Materi (LM)
        if (!$this->db->tableExists('rapor_kurmer_tp')) {
            $fields = [
                'id_tp_mapel' => ['type' => 'INT', 'constraint' => 11, 'auto_increment' => true],
                'id_tp' => ['type' => 'INT', 'constraint' => 11, 'null' => false],
                'id_smt' => ['type' => 'INT', 'constraint' => 11, 'null' => false],
                'id_mapel' => ['type' => 'INT', 'constraint' => 11, 'null' => false],
                'id_kelas' => ['type' => 'INT', 'constraint' => 11, 'null' => true],
                'id_guru' => ['type' => 'INT', 'constraint' => 11, 'null' => true],
                'kode_tp' => ['type' => 'VARCHAR', 'constraint' => 20, 'null' => false], // TP1, TP2, dst
                'lingkup_materi' => ['type' => 'TEXT', 'null' => true],
                'tujuan_pembelajaran' => ['type' => 'TEXT', 'null' => false],
                'is_active' => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 1],
                'created_at' => ['type' => 'DATETIME', 'null' => true],
            ];
            $forge->addField($fields);
            $forge->addKey('id_tp_mapel', true);
            $forge->addKey(['id_tp', 'id_smt', 'id_mapel']);
            $forge->createTable('rapor_kurmer_tp', true);
        }

        // 3. KKTP (Kriteria Ketercapaian Tujuan Pembelajaran)
        if (!$this->db->tableExists('rapor_kurmer_kktp')) {
            $fields = [
                'id_kktp' => ['type' => 'INT', 'constraint' => 11, 'auto_increment' => true],
                'id_tp' => ['type' => 'INT', 'constraint' => 11, 'null' => false],
                'id_smt' => ['type' => 'INT', 'constraint' => 11, 'null' => false],
                'id_mapel' => ['type' => 'INT', 'constraint' => 11, 'null' => false],
                'id_kelas' => ['type' => 'INT', 'constraint' => 11, 'null' => true],
                'kkm' => ['type' => 'INT', 'constraint' => 5, 'default' => 75],
                'skala_1' => ['type' => 'INT', 'constraint' => 5, 'default' => 60], // Perlu bimbingan (< 60)
                'skala_2' => ['type' => 'INT', 'constraint' => 5, 'default' => 70], // Cukup (60-70)
                'skala_3' => ['type' => 'INT', 'constraint' => 5, 'default' => 85], // Baik (71-85)
                'skala_4' => ['type' => 'INT', 'constraint' => 5, 'default' => 100], // Sangat Baik (86-100)
            ];
            $forge->addField($fields);
            $forge->addKey('id_kktp', true);
            $forge->addKey(['id_tp', 'id_smt', 'id_mapel']);
            $forge->createTable('rapor_kurmer_kktp', true);
        }

        // 4. Nilai Asesmen Kurikulum Merdeka (Sumatif LM, STS/SAS, Nilai Akhir, Deskripsi Capaian)
        if (!$this->db->tableExists('rapor_kurmer_nilai')) {
            $fields = [
                'id_nilai' => ['type' => 'INT', 'constraint' => 11, 'auto_increment' => true],
                'id_tp' => ['type' => 'INT', 'constraint' => 11, 'null' => false],
                'id_smt' => ['type' => 'INT', 'constraint' => 11, 'null' => false],
                'id_kelas' => ['type' => 'INT', 'constraint' => 11, 'null' => false],
                'id_mapel' => ['type' => 'INT', 'constraint' => 11, 'null' => false],
                'id_siswa' => ['type' => 'INT', 'constraint' => 11, 'null' => false],
                'nilai_sumatif' => ['type' => 'LONGTEXT', 'null' => true], // JSON: {"TP1": 80, "TP2": 75, ...}
                'rata_sumatif' => ['type' => 'DECIMAL', 'constraint' => '5,2', 'null' => true],
                'nilai_sts' => ['type' => 'DECIMAL', 'constraint' => '5,2', 'null' => true],
                'nilai_sas' => ['type' => 'DECIMAL', 'constraint' => '5,2', 'null' => true],
                'nilai_akhir' => ['type' => 'DECIMAL', 'constraint' => '5,2', 'null' => true],
                'tp_tertinggi' => ['type' => 'TEXT', 'null' => true],
                'deskripsi_tertinggi' => ['type' => 'TEXT', 'null' => true],
                'tp_terendah' => ['type' => 'TEXT', 'null' => true],
                'deskripsi_terendah' => ['type' => 'TEXT', 'null' => true],
                'deskripsi_capaian' => ['type' => 'TEXT', 'null' => true],
                'created_at' => ['type' => 'DATETIME', 'null' => true],
                'updated_at' => ['type' => 'DATETIME', 'null' => true],
            ];
            $forge->addField($fields);
            $forge->addKey('id_nilai', true);
            $forge->addKey(['id_tp', 'id_smt', 'id_kelas', 'id_mapel', 'id_siswa'], false, true); // unique
            $forge->createTable('rapor_kurmer_nilai', true);
        }

        // 5. Kokurikuler (P5 / P2RA - Projek Penguatan Profil Pelajar Pancasila & Rahmatan Lil Alamin)
        if (!$this->db->tableExists('rapor_kurmer_p5')) {
            $fields = [
                'id_p5' => ['type' => 'INT', 'constraint' => 11, 'auto_increment' => true],
                'id_tp' => ['type' => 'INT', 'constraint' => 11, 'null' => false],
                'id_smt' => ['type' => 'INT', 'constraint' => 11, 'null' => false],
                'id_kelas' => ['type' => 'INT', 'constraint' => 11, 'null' => false],
                'id_siswa' => ['type' => 'INT', 'constraint' => 11, 'null' => false],
                'tema' => ['type' => 'TEXT', 'null' => true],
                'dimensi' => ['type' => 'VARCHAR', 'constraint' => 150, 'null' => true],
                'deskripsi' => ['type' => 'TEXT', 'null' => true],
                'updated_at' => ['type' => 'DATETIME', 'null' => true],
            ];
            $forge->addField($fields);
            $forge->addKey('id_p5', true);
            $forge->addKey(['id_tp', 'id_smt', 'id_kelas', 'id_siswa'], false, true);
            $forge->createTable('rapor_kurmer_p5', true);
        }

        // 5b. Kokurikuler Kemenag (DPL / Panca Cinta - Sesuai RDM Kemenag)
        if (!$this->db->tableExists('rapor_kemenag_kokurikuler')) {
            $fields = [
                'id_kegiatan' => ['type' => 'INT', 'constraint' => 11, 'auto_increment' => true],
                'id_tp' => ['type' => 'INT', 'constraint' => 11, 'null' => false],
                'id_smt' => ['type' => 'INT', 'constraint' => 11, 'null' => false],
                'id_kelas' => ['type' => 'INT', 'constraint' => 11, 'null' => false],
                'dpl_panca_cinta' => ['type' => 'VARCHAR', 'constraint' => 150, 'null' => false],
                'deskripsi' => ['type' => 'TEXT', 'null' => false],
                'is_kirim' => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 0],
                'created_at' => ['type' => 'DATETIME', 'null' => true],
                'updated_at' => ['type' => 'DATETIME', 'null' => true],
            ];
            $forge->addField($fields);
            $forge->addKey('id_kegiatan', true);
            $forge->addKey(['id_tp', 'id_smt', 'id_kelas']);
            $forge->createTable('rapor_kemenag_kokurikuler', true);
        }

        if (!$this->db->tableExists('rapor_kemenag_kokurikuler_nilai')) {
            $fields = [
                'id_nilai' => ['type' => 'INT', 'constraint' => 11, 'auto_increment' => true],
                'id_kegiatan' => ['type' => 'INT', 'constraint' => 11, 'null' => false],
                'id_siswa' => ['type' => 'INT', 'constraint' => 11, 'null' => false],
                'nilai' => ['type' => 'VARCHAR', 'constraint' => 10, 'null' => false], // SB / B / C / K
                'updated_at' => ['type' => 'DATETIME', 'null' => true],
            ];
            $forge->addField($fields);
            $forge->addKey('id_nilai', true);
            $forge->addKey(['id_kegiatan', 'id_siswa'], false, true);
            $forge->createTable('rapor_kemenag_kokurikuler_nilai', true);
        }

        // 5c. Kokurikuler Kemendiknas (Deep Learning Kurmer P5)
        if (!$this->db->tableExists('rapor_diknas_kokurikuler_kegiatan')) {
            $fields = [
                'id_kegiatan' => ['type' => 'INT', 'constraint' => 11, 'auto_increment' => true],
                'id_tp' => ['type' => 'INT', 'constraint' => 11, 'null' => false],
                'id_smt' => ['type' => 'INT', 'constraint' => 11, 'null' => false],
                'id_kelas' => ['type' => 'INT', 'constraint' => 11, 'null' => false],
                'nama_kelompok' => ['type' => 'VARCHAR', 'constraint' => 100, 'default' => 'Kelompok 1'],
                'tema' => ['type' => 'VARCHAR', 'constraint' => 150, 'default' => 'Kearifan Lokal'],
                'nama_kegiatan' => ['type' => 'VARCHAR', 'constraint' => 200, 'null' => false],
                'deskripsi' => ['type' => 'TEXT', 'null' => true],
                'koordinator' => ['type' => 'VARCHAR', 'constraint' => 150, 'null' => true],
                'created_at' => ['type' => 'DATETIME', 'null' => true],
                'updated_at' => ['type' => 'DATETIME', 'null' => true],
            ];
            $forge->addField($fields);
            $forge->addKey('id_kegiatan', true);
            $forge->addKey(['id_tp', 'id_smt', 'id_kelas']);
            $forge->createTable('rapor_diknas_kokurikuler_kegiatan', true);
        }

        if (!$this->db->tableExists('rapor_diknas_kokurikuler_capaian')) {
            $fields = [
                'id_capaian' => ['type' => 'INT', 'constraint' => 11, 'auto_increment' => true],
                'id_kegiatan' => ['type' => 'INT', 'constraint' => 11, 'null' => false],
                'dimensi_id' => ['type' => 'INT', 'constraint' => 5, 'default' => 1],
                'dimensi' => ['type' => 'VARCHAR', 'constraint' => 150, 'null' => false],
                'capaian_akhir' => ['type' => 'TEXT', 'null' => false],
                'urutan' => ['type' => 'INT', 'constraint' => 3, 'default' => 1],
            ];
            $forge->addField($fields);
            $forge->addKey('id_capaian', true);
            $forge->addKey('id_kegiatan');
            $forge->createTable('rapor_diknas_kokurikuler_capaian', true);
        }

        if (!$this->db->tableExists('rapor_diknas_kokurikuler_nilai')) {
            $fields = [
                'id_nilai' => ['type' => 'INT', 'constraint' => 11, 'auto_increment' => true],
                'id_kegiatan' => ['type' => 'INT', 'constraint' => 11, 'null' => false],
                'id_capaian' => ['type' => 'INT', 'constraint' => 11, 'null' => false],
                'id_siswa' => ['type' => 'INT', 'constraint' => 11, 'null' => false],
                'predikat' => ['type' => 'VARCHAR', 'constraint' => 10, 'default' => 'B'], // SB, B, C, K
                'updated_at' => ['type' => 'DATETIME', 'null' => true],
            ];
            $forge->addField($fields);
            $forge->addKey('id_nilai', true);
            $forge->addKey(['id_kegiatan', 'id_capaian', 'id_siswa'], false, true);
            $forge->createTable('rapor_diknas_kokurikuler_nilai', true);
        }

        if (!$this->db->tableExists('rapor_diknas_kokurikuler_catatan')) {
            $fields = [
                'id_catatan' => ['type' => 'INT', 'constraint' => 11, 'auto_increment' => true],
                'id_kegiatan' => ['type' => 'INT', 'constraint' => 11, 'null' => false],
                'id_siswa' => ['type' => 'INT', 'constraint' => 11, 'null' => false],
                'deskripsi' => ['type' => 'TEXT', 'null' => true],
                'updated_at' => ['type' => 'DATETIME', 'null' => true],
            ];
            $forge->addField($fields);
            $forge->addKey('id_catatan', true);
            $forge->addKey(['id_kegiatan', 'id_siswa'], false, true);
            $forge->createTable('rapor_diknas_kokurikuler_catatan', true);
        }

        // 6. Ekstrakurikuler
        if (!$this->db->tableExists('rapor_kurmer_ekstra')) {
            $fields = [
                'id_ekstra' => ['type' => 'INT', 'constraint' => 11, 'auto_increment' => true],
                'id_tp' => ['type' => 'INT', 'constraint' => 11, 'null' => false],
                'id_smt' => ['type' => 'INT', 'constraint' => 11, 'null' => false],
                'id_kelas' => ['type' => 'INT', 'constraint' => 11, 'null' => false],
                'id_siswa' => ['type' => 'INT', 'constraint' => 11, 'null' => false],
                'kegiatan' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => false],
                'nilai' => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true], // A / B / Sangat Baik / Baik
                'keterangan' => ['type' => 'TEXT', 'null' => true],
            ];
            $forge->addField($fields);
            $forge->addKey('id_ekstra', true);
            $forge->addKey(['id_tp', 'id_smt', 'id_kelas', 'id_siswa']);
            $forge->createTable('rapor_kurmer_ekstra', true);
        }

        // 7. Prestasi
        if (!$this->db->tableExists('rapor_kurmer_prestasi')) {
            $fields = [
                'id_prestasi' => ['type' => 'INT', 'constraint' => 11, 'auto_increment' => true],
                'id_tp' => ['type' => 'INT', 'constraint' => 11, 'null' => false],
                'id_smt' => ['type' => 'INT', 'constraint' => 11, 'null' => false],
                'id_kelas' => ['type' => 'INT', 'constraint' => 11, 'null' => false],
                'id_siswa' => ['type' => 'INT', 'constraint' => 11, 'null' => false],
                'jenis_prestasi' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => false],
                'keterangan' => ['type' => 'TEXT', 'null' => true],
            ];
            $forge->addField($fields);
            $forge->addKey('id_prestasi', true);
            $forge->addKey(['id_tp', 'id_smt', 'id_kelas', 'id_siswa']);
            $forge->createTable('rapor_kurmer_prestasi', true);
        }

        // 8. Kehadiran & Catatan Wali Kelas
        if (!$this->db->tableExists('rapor_kurmer_kehadiran')) {
            $fields = [
                'id_kehadiran' => ['type' => 'INT', 'constraint' => 11, 'auto_increment' => true],
                'id_tp' => ['type' => 'INT', 'constraint' => 11, 'null' => false],
                'id_smt' => ['type' => 'INT', 'constraint' => 11, 'null' => false],
                'id_kelas' => ['type' => 'INT', 'constraint' => 11, 'null' => false],
                'id_siswa' => ['type' => 'INT', 'constraint' => 11, 'null' => false],
                'sakit' => ['type' => 'INT', 'constraint' => 5, 'default' => 0],
                'izin' => ['type' => 'INT', 'constraint' => 5, 'default' => 0],
                'alpa' => ['type' => 'INT', 'constraint' => 5, 'default' => 0],
                'catatan_wali' => ['type' => 'TEXT', 'null' => true],
                'tanggapan_ortu' => ['type' => 'TEXT', 'null' => true],
                'naik_status' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
                'updated_at' => ['type' => 'DATETIME', 'null' => true],
            ];
            $forge->addField($fields);
            $forge->addKey('id_kehadiran', true);
            $forge->addKey(['id_tp', 'id_smt', 'id_kelas', 'id_siswa'], false, true);
            $forge->createTable('rapor_kurmer_kehadiran', true);
        }

        // 9. Kolom kategori pengunci di cbt_jenis & auto-mapping
        if ($this->db->tableExists('cbt_jenis')) {
            if (!$this->db->fieldExists('kategori', 'cbt_jenis')) {
                $forge->addColumn('cbt_jenis', [
                    'kategori' => [
                        'type' => 'VARCHAR',
                        'constraint' => 20,
                        'default' => 'lainnya',
                        'after' => 'kode_jenis'
                    ]
                ]);
            }
            // Auto-classify jika ada yang masih null / kosong / lainnya
            $unmapped = $this->db->table('cbt_jenis')
                ->groupStart()
                    ->where('kategori', null)
                    ->orWhere('kategori', '')
                    ->orWhere('kategori', 'lainnya')
                ->groupEnd()
                ->get()->getResult();

            foreach ($unmapped as $j) {
                $kode = strtoupper(trim($j->kode_jenis ?? ''));
                $nama = strtolower(trim($j->nama_jenis ?? ''));
                $newKat = 'lainnya';
                if ($kode === 'PTS' || strpos($kode, 'STS') !== false || strpos($kode, 'ASTS') !== false || strpos($kode, 'UTS') !== false || strpos($nama, 'tengah') !== false || $j->id_jenis == 2) {
                    $newKat = 'sts';
                } elseif (in_array($kode, ['PAS', 'PAT', 'SAS', 'SAT', 'UAS', 'UKK']) || strpos($kode, 'SAS') !== false || strpos($kode, 'ASAS') !== false || strpos($kode, 'ASAT') !== false || strpos($nama, 'akhir') !== false || in_array($j->id_jenis, [3, 4])) {
                    $newKat = 'sas';
                } elseif ($kode === 'PH' || $kode === 'UH' || strpos($nama, 'harian') !== false || $j->id_jenis == 1) {
                    $newKat = 'ph';
                }
                if ($newKat !== 'lainnya' || empty($j->kategori)) {
                    $this->db->table('cbt_jenis')->where('id_jenis', $j->id_jenis)->update(['kategori' => $newKat]);
                }
            }
        }

        // 10. Kolom id_jenis_sts dan id_jenis_sas di rapor_kurmer_setting
        if ($this->db->tableExists('rapor_kurmer_setting')) {
            if (!$this->db->fieldExists('id_jenis_sts', 'rapor_kurmer_setting')) {
                $forge->addColumn('rapor_kurmer_setting', [
                    'id_jenis_sts' => ['type' => 'INT', 'constraint' => 11, 'null' => true, 'default' => null]
                ]);
            }
            if (!$this->db->fieldExists('id_jenis_sas', 'rapor_kurmer_setting')) {
                $forge->addColumn('rapor_kurmer_setting', [
                    'id_jenis_sas' => ['type' => 'INT', 'constraint' => 11, 'null' => true, 'default' => null]
                ]);
            }
        }
    }

    /**
     * Get or create default Kurmer settings
     */
    public function getSetting($id_tp, $id_smt)
    {
        $setting = $this->db->table('rapor_kurmer_setting')
            ->where('id_tp', $id_tp)
            ->where('id_smt', $id_smt)
            ->get()->getRow();

        if (!$setting) {
            // Check old setting to inherit default dates if possible
            $oldSetting = $this->db->table('rapor_admin_setting')
                ->where('id_tp', $id_tp)
                ->where('id_smt', $id_smt)
                ->get()->getRow();

            $insert = [
                'id_tp' => $id_tp,
                'id_smt' => $id_smt,
                'fase' => 'D',
                'tempat' => $oldSetting->tempat ?? 'Sumberagung',
                'tanggal_rapor' => $oldSetting->tgl_rapor_akhir ?? date('Y-m-d'),
                'tanggal_pts' => $oldSetting->tgl_rapor_pts ?? date('Y-m-d'),
                'kkm_default' => 75,
                'bobot_sumatif' => 50,
                'bobot_sas' => 50,
                'nip_kepsek' => $oldSetting->nip_kepsek ?? 0,
                'nip_walikelas' => $oldSetting->nip_walikelas ?? 0,
                'watermark_teks' => 'MTs Hidayatul Islamiyah',
                'model_kop' => 1,
                'mode_rapor' => 'semua',
                'ttd_rapor_ringkas' => '3',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
            $this->db->table('rapor_kurmer_setting')->insert($insert);
            $setting = $this->db->table('rapor_kurmer_setting')
                ->where('id_tp', $id_tp)
                ->where('id_smt', $id_smt)
                ->get()->getRow();
        }
        if ($setting && empty($setting->mode_rapor)) {
            $setting->mode_rapor = 'semua';
        }
        return $setting;
    }

    /**
     * Save Kurmer settings
     */
    public function saveSetting($data)
    {
        $exists = $this->db->table('rapor_kurmer_setting')
            ->where('id_tp', $data['id_tp'])
            ->where('id_smt', $data['id_smt'])
            ->get()->getRow();

        $data['updated_at'] = date('Y-m-d H:i:s');
        if ($exists) {
            return $this->db->table('rapor_kurmer_setting')
                ->where('id_tp', $data['id_tp'])
                ->where('id_smt', $data['id_smt'])
                ->update($data);
        } else {
            $data['created_at'] = date('Y-m-d H:i:s');
            return $this->db->table('rapor_kurmer_setting')->insert($data);
        }
    }

    /**
     * Get Tujuan Pembelajaran (TP) per Mapel
     */
    public function getListTp($id_mapel, $id_tp, $id_smt, $id_kelas = null)
    {
        $builder = $this->db->table('rapor_kurmer_tp')
            ->where('id_mapel', $id_mapel)
            ->where('id_tp', $id_tp)
            ->where('id_smt', $id_smt);

        if ($id_kelas) {
            $builder->groupStart()
                ->where('id_kelas', $id_kelas)
                ->orWhere('id_kelas IS NULL')
                ->orWhere('id_kelas', 0)
                ->groupEnd();
        }

        return $builder->orderBy('id_tp_mapel', 'ASC')->get()->getResult();
    }

    /**
     * Save or update Tujuan Pembelajaran
     */
    public function saveTp($data)
    {
        if (!empty($data['id_tp_mapel'])) {
            return $this->db->table('rapor_kurmer_tp')
                ->where('id_tp_mapel', $data['id_tp_mapel'])
                ->update($data);
        } else {
            $data['created_at'] = date('Y-m-d H:i:s');
            return $this->db->table('rapor_kurmer_tp')->insert($data);
        }
    }

    /**
     * Delete Tujuan Pembelajaran
     */
    public function deleteTp($id_tp_mapel)
    {
        return $this->db->table('rapor_kurmer_tp')->where('id_tp_mapel', $id_tp_mapel)->delete();
    }

    /**
     * Get KKTP per Mapel/Kelas
     */
    public function getKktp($id_mapel, $id_tp, $id_smt, $id_kelas = null)
    {
        $builder = $this->db->table('rapor_kurmer_kktp')
            ->where('id_mapel', $id_mapel)
            ->where('id_tp', $id_tp)
            ->where('id_smt', $id_smt);

        if ($id_kelas) {
            $builder->groupStart()
                ->where('id_kelas', $id_kelas)
                ->orWhere('id_kelas IS NULL')
                ->orWhere('id_kelas', 0)
                ->groupEnd();
        }

        $row = $builder->get()->getRow();
        if (!$row) {
            return (object)[
                'kkm' => 75,
                'skala_1' => 60,
                'skala_2' => 70,
                'skala_3' => 85,
                'skala_4' => 100
            ];
        }
        return $row;
    }

    /**
     * Save KKTP
     */
    public function saveKktp($data)
    {
        $exists = $this->db->table('rapor_kurmer_kktp')
            ->where('id_mapel', $data['id_mapel'])
            ->where('id_tp', $data['id_tp'])
            ->where('id_smt', $data['id_smt'])
            ->get()->getRow();

        if ($exists) {
            return $this->db->table('rapor_kurmer_kktp')
                ->where('id_mapel', $data['id_mapel'])
                ->where('id_tp', $data['id_tp'])
                ->where('id_smt', $data['id_smt'])
                ->update($data);
        } else {
            return $this->db->table('rapor_kurmer_kktp')->insert($data);
        }
    }

    /**
     * Get Nilai Asesmen Kelas per Mapel
     */
    public function getNilaiKelas($id_mapel, $id_kelas, $id_tp, $id_smt)
    {
        $rows = $this->db->table('rapor_kurmer_nilai')
            ->where('id_mapel', $id_mapel)
            ->where('id_kelas', $id_kelas)
            ->where('id_tp', $id_tp)
            ->where('id_smt', $id_smt)
            ->get()->getResult();

        $result = [];
        foreach ($rows as $row) {
            $row->sumatif_decoded = !empty($row->nilai_sumatif) ? json_decode($row->nilai_sumatif, true) : [];
            $result[$row->id_siswa] = $row;
        }
        return $result;
    }

    /**
     * Get Rekapitulasi Nilai Seluruh Siswa & Mapel untuk Legger
     * Menggabungkan nilai tersimpan di rapor_kurmer_nilai dan fallback otomatis CBT PTS/SAS
     */
    public function getNilaiLegerKelas($id_kelas, $id_tp, $id_smt, $mapels = [], $siswas = [], $overrideMode = null)
    {
        // 1. Ambil semua nilai yang sudah disimpan di rapor_kurmer_nilai untuk kelas ini
        $rows = $this->db->table('rapor_kurmer_nilai')
            ->where('id_kelas', $id_kelas)
            ->where('id_tp', $id_tp)
            ->where('id_smt', $id_smt)
            ->get()->getResult();

        $mapNilai = [];
        foreach ($rows as $row) {
            $mapNilai[$row->id_siswa][$row->id_mapel] = $row;
        }

        // 2. Setting konversi CBT jika diperlukan (default: ikuti pengaturan rapor / guru)
        $setting = $this->getSetting($id_tp, $id_smt);
        $modeKatrol = $overrideMode ?: ($setting->cbt_convert_mode ?? 'katrol');
        $minK = floatval($setting->cbt_katrol_min ?? 60);
        $maxK = floatval($setting->cbt_katrol_max ?? 100);

        // 3. Ambil jadwal CBT untuk kelas ini
        $cbtJadwals = $this->db->table('cbt_jadwal j')
            ->select('j.id_jadwal, j.id_bank, j.id_jenis, j.pelanggaran, b.bank_mapel_id, b.bank_kelas, b.jml_soal, b.tampil_pg, b.bobot_pg, b.jml_kompleks, b.tampil_kompleks, b.bobot_kompleks, b.jml_jodohkan, b.tampil_jodohkan, b.bobot_jodohkan, b.jml_isian, b.tampil_isian, b.bobot_isian, b.jml_esai, b.tampil_esai, b.bobot_esai, k.kode_jenis, k.nama_jenis, k.kategori')
            ->join('cbt_bank_soal b', 'j.id_bank = b.id_bank', 'inner')
            ->join('cbt_jenis k', 'j.id_jenis = k.id_jenis', 'left')
            ->where('j.id_tp', $id_tp)
            ->where('j.id_smt', $id_smt)
            ->get()->getResult();

        $cbtPtsByMapel = [];
        $cbtSasByMapel = [];
        $allJadwalIds = [];

        foreach ($cbtJadwals as $cj) {
            $bankKelas = !empty($cj->bank_kelas) ? (is_array($cj->bank_kelas) ? $cj->bank_kelas : @unserialize($cj->bank_kelas)) : [];
            if (!$bankKelas && !empty($cj->bank_kelas)) {
                $bankKelas = json_decode($cj->bank_kelas, true) ?: [];
            }
            $coversClass = false;
            if (is_array($bankKelas)) {
                foreach ($bankKelas as $bk) {
                    $bkId = is_array($bk) ? ($bk['kelas_id'] ?? $bk[0] ?? null) : (is_object($bk) ? ($bk->kelas_id ?? null) : $bk);
                    if ($bkId !== null && (string)$bkId === (string)$id_kelas) {
                        $coversClass = true;
                        break;
                    }
                }
            }
            if (!$coversClass) continue;

            $kat = strtolower(trim($cj->kategori ?? ''));
            $kode = strtoupper(trim($cj->kode_jenis ?? ''));
            $nama = strtolower(trim($cj->nama_jenis ?? ''));
            if ($kat === 'sts' || $kode === 'PTS' || strpos($kode, 'STS') !== false || strpos($nama, 'tengah') !== false || strpos($nama, 'sts') !== false || strpos($kode, 'ASTS') !== false || $cj->id_jenis == 2) {
                $cbtPtsByMapel[$cj->bank_mapel_id][] = $cj;
                $allJadwalIds[] = $cj->id_jadwal;
            } elseif ($kat === 'sas' || in_array($kode, ['PAS', 'PAT', 'SAS', 'SAT']) || strpos($nama, 'akhir') !== false || strpos($kode, 'SAS') !== false || strpos($kode, 'ASAS') !== false || in_array($cj->id_jenis, [3, 4])) {
                $cbtSasByMapel[$cj->bank_mapel_id][] = $cj;
                $allJadwalIds[] = $cj->id_jadwal;
            }
        }

        $cbtSiswaData = [];
        if (!empty($allJadwalIds)) {
            $rkpRows = $this->db->table('cbt_rekap_siswa')
                ->whereIn('id_jadwal', $allJadwalIds)
                ->get()->getResult();
            foreach ($rkpRows as $rk) {
                $cbtSiswaData[$rk->id_siswa][$rk->id_jadwal] = $rk;
            }

            $cbtRows = $this->db->table('cbt_siswa')
                ->whereIn('id_jadwal', $allJadwalIds)
                ->get()->getResult();
            foreach ($cbtRows as $cs) {
                if (!isset($cbtSiswaData[$cs->id_siswa][$cs->id_jadwal])) {
                    $cbtSiswaData[$cs->id_siswa][$cs->id_jadwal] = $cs;
                }
            }
        }

        $bankSoalKeys = [];
        $allBankIds = array_unique(array_filter(array_column($cbtJadwals, 'id_bank')));
        if (!empty($allBankIds)) {
            $soals = $this->db->table('cbt_soal')
                ->select('id_soal, bank_id, jenis, nomor_soal, jawaban')
                ->whereIn('bank_id', $allBankIds)
                ->where('tampilkan', '1')
                ->get()->getResult();
            foreach ($soals as $sRow) {
                $bankSoalKeys[$sRow->bank_id][$sRow->id_soal] = $sRow;
            }
        }

        $result = [];
        foreach ($siswas as $s) {
            $sId = $s->id_siswa;
            foreach ($mapels as $m) {
                $mId = $m->id_mapel;
                $n = $mapNilai[$sId][$mId] ?? null;

                $valSts = ($n && $n->nilai_sts !== null && $n->nilai_sts !== '') ? floatval($n->nilai_sts) : null;
                $valSas = ($n && $n->nilai_sas !== null && $n->nilai_sas !== '') ? floatval($n->nilai_sas) : null;
                $valNa = ($n && $n->nilai_akhir !== null && $n->nilai_akhir !== '') ? floatval($n->nilai_akhir) : null;
                $valRataSum = ($n && $n->rata_sumatif !== null && $n->rata_sumatif !== '') ? floatval($n->rata_sumatif) : null;

                // Hitung Skor CBT jika ada rekaman jadwal
                $cbtPtsCalc = null;
                if (!empty($cbtPtsByMapel[$mId])) {
                    foreach ($cbtPtsByMapel[$mId] as $jObj) {
                        $sRow = $cbtSiswaData[$sId][$jObj->id_jadwal] ?? null;
                        if ($sRow) {
                            $calc = $this->calculateCbtScoreItem($sRow, $jObj, $modeKatrol, $minK, $maxK, $bankSoalKeys[$jObj->id_bank] ?? []);
                            if ($calc && ($calc['asli'] > 0 || $calc['katrol'] > 0)) {
                                $cbtPtsCalc = $calc;
                                break;
                            }
                        }
                    }
                }

                $cbtSasCalc = null;
                if (!empty($cbtSasByMapel[$mId])) {
                    foreach ($cbtSasByMapel[$mId] as $jObj) {
                        $sRow = $cbtSiswaData[$sId][$jObj->id_jadwal] ?? null;
                        if ($sRow) {
                            $calc = $this->calculateCbtScoreItem($sRow, $jObj, $modeKatrol, $minK, $maxK, $bankSoalKeys[$jObj->id_bank] ?? []);
                            if ($calc && ($calc['asli'] > 0 || $calc['katrol'] > 0)) {
                                $cbtSasCalc = $calc;
                                break;
                            }
                        }
                    }
                }

                // Logika Penentuan Nilai:
                // 1. Jika pengguna secara eksplisit meminta ?mode=asli atau ?mode=katrol di Legger/Ranking
                if ($overrideMode !== null && ($cbtPtsCalc || $cbtSasCalc)) {
                    $activeCalc = $cbtSasCalc ?: $cbtPtsCalc;
                    $valNa = ($overrideMode === 'asli') ? $activeCalc['asli'] : $activeCalc['katrol'];
                    if ($cbtPtsCalc) {
                        $valSts = ($overrideMode === 'asli') ? $cbtPtsCalc['asli'] : $cbtPtsCalc['katrol'];
                    }
                    if ($cbtSasCalc) {
                        $valSas = ($overrideMode === 'asli') ? $cbtSasCalc['asli'] : $cbtSasCalc['katrol'];
                    }
                } else {
                    // 2. Default: Ikuti hasil nilai yang disimpan guru di rapor_kurmer_nilai
                    // Jika belum disimpan di rapor_kurmer_nilai, gunakan Fallback otomatis CBT (mengikuti mode katrol/asli setting guru)
                    if (($valSts === null || $valSts == 0) && $cbtPtsCalc && $cbtPtsCalc['final'] > 0) {
                        $valSts = $cbtPtsCalc['final'];
                        if ($valNa === null || $valNa == 0) {
                            $valNa = $cbtPtsCalc['final'];
                        }
                    }

                    if (($valSas === null || $valSas == 0) && $cbtSasCalc && $cbtSasCalc['final'] > 0) {
                        $valSas = $cbtSasCalc['final'];
                        if ($valNa === null || $valNa == 0) {
                            $valNa = $cbtSasCalc['final'];
                        }
                    }

                    // 3. Old K13 Fallback jika masih kosong
                    if ($valSts === null || $valSts == 0) {
                        $oldPts = $this->db->table('rapor_nilai_pts')
                            ->where('id_siswa', $sId)
                            ->where('id_mapel', $mId)
                            ->where('id_tp', $id_tp)
                            ->where('id_smt', $id_smt)
                            ->get()->getRow();
                        if ($oldPts && isset($oldPts->nilai) && is_numeric($oldPts->nilai) && floatval($oldPts->nilai) > 0) {
                            $valSts = floatval($oldPts->nilai);
                            if ($valNa === null || $valNa == 0) {
                                $valNa = $valSts;
                            }
                        }
                    }

                    // 4. Final Score selection jika valNa belum terpilih
                    if ($valNa === null || $valNa == 0) {
                        if ($valSas !== null && $valSas > 0) {
                            $valNa = $valSas;
                        } elseif ($valSts !== null && $valSts > 0) {
                            $valNa = $valSts;
                        } elseif ($valRataSum !== null && $valRataSum > 0) {
                            $valNa = $valRataSum;
                        }
                    }
                }

                $result[$sId][$mId] = (object)[
                    'nilai_akhir'  => $valNa !== null ? round($valNa) : null,
                    'nilai_sts'    => $valSts !== null ? round($valSts) : null,
                    'nilai_sas'    => $valSas !== null ? round($valSas) : null,
                    'rata_sumatif' => $valRataSum !== null ? round($valRataSum) : null,
                    'cbt_asli'     => ($cbtSasCalc['asli'] ?? ($cbtPtsCalc['asli'] ?? null)),
                    'cbt_katrol'   => ($cbtSasCalc['katrol'] ?? ($cbtPtsCalc['katrol'] ?? null)),
                ];
            }
        }

        return $result;
    }

    /**
     * Dapatkan riwayat nilai multi-semester siswa untuk keperluan Rekap Hasil Belajar
     */
    public function getRekapNilaiMultiSemester($id_siswa)
    {
        $rows = $this->db->table('rapor_kurmer_nilai r')
            ->select('r.id_mapel, r.nilai_akhir, r.nilai_sts, r.nilai_sas, r.rata_sumatif, k.level_id, smt.smt')
            ->join('master_kelas k', 'r.id_kelas = k.id_kelas', 'left')
            ->join('master_smt smt', 'r.id_smt = smt.id_smt', 'left')
            ->where('r.id_siswa', $id_siswa)
            ->get()->getResult();

        $result = [];
        foreach ($rows as $r) {
            $lvl = $r->level_id ?? 7;
            $smt = $r->smt ?? 1;
            $score = $r->nilai_akhir ?? ($r->nilai_sas ?? ($r->nilai_sts ?? $r->rata_sumatif));
            if ($score !== null && $score !== '' && is_numeric($score) && floatval($score) > 0) {
                $key = $lvl . '_' . $smt;
                $result[$r->id_mapel][$key] = round(floatval($score));
            }
        }
        return $result;
    }

    /**
     * Save Nilai Asesmen Siswa (with auto-description calculation)
     */
    public function saveNilaiSiswa($data, $tpList = [])
    {
        // Calculate Nilai Akhir (NA) if not explicitly set
        $rataSumatif = isset($data['rata_sumatif']) && is_numeric($data['rata_sumatif']) ? floatval($data['rata_sumatif']) : null;
        $nilaiSas = isset($data['nilai_sas']) && is_numeric($data['nilai_sas']) ? floatval($data['nilai_sas']) : null;
        $nilaiSts = isset($data['nilai_sts']) && is_numeric($data['nilai_sts']) ? floatval($data['nilai_sts']) : null;

        if ($rataSumatif !== null && $nilaiSas !== null) {
            $setting = $this->getSetting($data['id_tp'], $data['id_smt']);
            $bSum = $setting->bobot_sumatif ?? 50;
            $bSas = $setting->bobot_sas ?? 50;
            $na = (($rataSumatif * $bSum) + ($nilaiSas * $bSas)) / ($bSum + $bSas);
            $data['nilai_akhir'] = round($na);
        } elseif ($rataSumatif !== null) {
            $data['nilai_akhir'] = round($rataSumatif);
        } elseif ($nilaiSas !== null) {
            $data['nilai_akhir'] = round($nilaiSas);
        }

        // Auto Generate Deskripsi Capaian Kompetensi if not manually specified
        if (empty($data['deskripsi_capaian']) && !empty($data['nilai_sumatif']) && !empty($tpList)) {
            $sumatifScores = is_array($data['nilai_sumatif']) ? $data['nilai_sumatif'] : json_decode($data['nilai_sumatif'], true);
            if (!empty($sumatifScores)) {
                $maxScore = -1;
                $minScore = 999;
                $bestTpText = '';
                $lowestTpText = '';

                // Map TP texts
                $tpMap = [];
                foreach ($tpList as $t) {
                    $tpMap[$t->kode_tp] = $t->tujuan_pembelajaran;
                }

                foreach ($sumatifScores as $kode => $sc) {
                    if (is_numeric($sc)) {
                        $val = floatval($sc);
                        if ($val > $maxScore) {
                            $maxScore = $val;
                            $bestTpText = $tpMap[$kode] ?? '';
                        }
                        if ($val < $minScore) {
                            $minScore = $val;
                            $lowestTpText = $tpMap[$kode] ?? '';
                        }
                    }
                }

                $deskripsiParts = [];
                if (!empty($bestTpText)) {
                    $cleanTp = rtrim($bestTpText, '.');
                    $cleanTp = preg_replace('/^menunjukkan\s+penguasaan\s+(yang\s+)?(kurang\s+baik|cukup\s+baik|baik|sangat\s+baik)\s+dalam\s+/i', '', $cleanTp);
                    $cleanTp = preg_replace('/^dalam\s+/i', '', $cleanTp);

                    if ($maxScore >= 90) {
                        $deskripsiParts[] = "Menunjukkan penguasaan yang sangat baik dalam " . $cleanTp;
                    } elseif ($maxScore >= 80) {
                        $deskripsiParts[] = "Menunjukkan penguasaan yang baik dalam " . $cleanTp;
                    } elseif ($maxScore >= 65) {
                        $deskripsiParts[] = "Menunjukkan penguasaan yang cukup baik dalam " . $cleanTp;
                    } else {
                        $deskripsiParts[] = "Menunjukkan penguasaan yang kurang baik dalam " . $cleanTp;
                    }
                }

                $data['deskripsi_capaian'] = implode("\n", $deskripsiParts);
            }
        }

        if (is_array($data['nilai_sumatif'])) {
            $data['nilai_sumatif'] = json_encode($data['nilai_sumatif']);
        }

        $exists = $this->db->table('rapor_kurmer_nilai')
            ->where('id_tp', $data['id_tp'])
            ->where('id_smt', $data['id_smt'])
            ->where('id_kelas', $data['id_kelas'])
            ->where('id_mapel', $data['id_mapel'])
            ->where('id_siswa', $data['id_siswa'])
            ->get()->getRow();

        $data['updated_at'] = date('Y-m-d H:i:s');
        if ($exists) {
            return $this->db->table('rapor_kurmer_nilai')
                ->where('id_nilai', $exists->id_nilai)
                ->update($data);
        } else {
            $data['created_at'] = date('Y-m-d H:i:s');
            return $this->db->table('rapor_kurmer_nilai')->insert($data);
        }
    }

    /**
     * Save Nilai PTS (STS) Siswa
     */
    public function saveNilaiPts($data)
    {
        $exists = $this->db->table('rapor_kurmer_nilai')
            ->where('id_tp', $data['id_tp'])
            ->where('id_smt', $data['id_smt'])
            ->where('id_kelas', $data['id_kelas'])
            ->where('id_mapel', $data['id_mapel'])
            ->where('id_siswa', $data['id_siswa'])
            ->get()->getRow();

        $valSts = (!empty($data['nilai_sts']) && is_numeric($data['nilai_sts'])) ? floatval($data['nilai_sts']) : null;
        $valNa = (isset($data['nilai_akhir']) && is_numeric($data['nilai_akhir'])) ? floatval($data['nilai_akhir']) : $valSts;

        $updateData = [
            'nilai_sts' => $valSts,
            'nilai_akhir' => $valNa,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        if ($exists) {
            return $this->db->table('rapor_kurmer_nilai')
                ->where('id_nilai', $exists->id_nilai)
                ->update($updateData);
        } else {
            $insertData = array_merge($data, $updateData);
            $insertData['created_at'] = date('Y-m-d H:i:s');
            return $this->db->table('rapor_kurmer_nilai')->insert($insertData);
        }
    }

    /**
     * Save Nilai SAS Siswa
     */
    public function saveNilaiSas($data, $tpList = [])
    {
        $exists = $this->db->table('rapor_kurmer_nilai')
            ->where('id_tp', $data['id_tp'])
            ->where('id_smt', $data['id_smt'])
            ->where('id_kelas', $data['id_kelas'])
            ->where('id_mapel', $data['id_mapel'])
            ->where('id_siswa', $data['id_siswa'])
            ->get()->getRow();

        $rataSumatif = isset($data['rata_sumatif']) && is_numeric($data['rata_sumatif']) ? floatval($data['rata_sumatif']) : null;
        $nilaiSas = isset($data['nilai_sas']) && is_numeric($data['nilai_sas']) ? floatval($data['nilai_sas']) : null;

        if (isset($data['nilai_akhir']) && is_numeric($data['nilai_akhir'])) {
            $nilaiAkhir = floatval($data['nilai_akhir']);
        } elseif ($rataSumatif !== null && $nilaiSas !== null) {
            $setting = $this->getSetting($data['id_tp'], $data['id_smt']);
            $bSum = $setting->bobot_sumatif ?? 50;
            $bSas = $setting->bobot_sas ?? 50;
            $nilaiAkhir = round((($rataSumatif * $bSum) + ($nilaiSas * $bSas)) / ($bSum + $bSas));
        } elseif ($rataSumatif !== null) {
            $nilaiAkhir = round($rataSumatif);
        } elseif ($nilaiSas !== null) {
            $nilaiAkhir = round($nilaiSas);
        } else {
            $nilaiAkhir = null;
        }

        $sumatifVal = $data['nilai_sumatif'] ?? [];
        if (is_array($sumatifVal)) {
            $sumatifVal = json_encode($sumatifVal);
        }

        $updateData = [
            'nilai_sumatif' => $sumatifVal,
            'rata_sumatif' => $rataSumatif,
            'nilai_sas' => $nilaiSas,
            'nilai_akhir' => $nilaiAkhir,
            'deskripsi_capaian' => $data['deskripsi_capaian'] ?? null,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        if ($exists) {
            return $this->db->table('rapor_kurmer_nilai')
                ->where('id_nilai', $exists->id_nilai)
                ->update($updateData);
        } else {
            $insertData = array_merge($data, $updateData);
            $insertData['created_at'] = date('Y-m-d H:i:s');
            return $this->db->table('rapor_kurmer_nilai')->insert($insertData);
        }
    }

    /**
     * Get CBT Scores for class and subject (supporting Katrol or Asli)
     */
    public function getCbtScoresForClass($id_mapel, $id_kelas, $id_tp, $id_smt, $tipe = 'pts', $modeKatrol = 'katrol', $minK = 60, $maxK = 100)
    {
        $builder = $this->db->table('cbt_jadwal j')
            ->select('j.id_jadwal, j.id_bank, j.id_jenis, j.pelanggaran, b.bank_mapel_id, b.bank_kelas, b.jml_soal, b.tampil_pg, b.bobot_pg, b.jml_kompleks, b.tampil_kompleks, b.bobot_kompleks, b.jml_jodohkan, b.tampil_jodohkan, b.bobot_jodohkan, b.jml_isian, b.tampil_isian, b.bobot_isian, b.jml_esai, b.tampil_esai, b.bobot_esai, k.kode_jenis, k.nama_jenis, k.kategori')
            ->join('cbt_bank_soal b', 'j.id_bank = b.id_bank', 'inner')
            ->join('cbt_jenis k', 'j.id_jenis = k.id_jenis', 'left')
            ->where('j.id_tp', $id_tp)
            ->where('j.id_smt', $id_smt)
            ->where('b.bank_mapel_id', $id_mapel);

        $jadwals = $builder->get()->getResult();
        if (empty($jadwals)) {
            return [];
        }

        $matchedJadwal = null;
        foreach ($jadwals as $j) {
            $kat = strtolower(trim($j->kategori ?? ''));
            $kode = strtoupper(trim($j->kode_jenis ?? ''));
            $nama = strtolower(trim($j->nama_jenis ?? ''));
            $isMatch = false;
            if ($tipe === 'pts' || $tipe === 'sts') {
                if ($kat === 'sts' || $kode === 'PTS' || strpos($kode, 'STS') !== false || strpos($nama, 'tengah') !== false || strpos($nama, 'sts') !== false || strpos($kode, 'ASTS') !== false || $j->id_jenis == 2) {
                    $isMatch = true;
                }
            } else {
                if ($kat === 'sas' || in_array($kode, ['PAS', 'PAT', 'SAS', 'SAT']) || strpos($nama, 'akhir') !== false || strpos($kode, 'SAS') !== false || strpos($kode, 'ASAS') !== false || in_array($j->id_jenis, [3, 4])) {
                    $isMatch = true;
                }
            }

            if (!$isMatch) continue;

            $bankKelas = !empty($j->bank_kelas) ? (is_array($j->bank_kelas) ? $j->bank_kelas : @unserialize($j->bank_kelas)) : [];
            if (!$bankKelas && !empty($j->bank_kelas)) {
                $bankKelas = json_decode($j->bank_kelas, true) ?: [];
            }

            $coversClass = false;
            if (is_array($bankKelas)) {
                foreach ($bankKelas as $bk) {
                    $bkId = is_array($bk) ? ($bk['kelas_id'] ?? $bk[0] ?? null) : (is_object($bk) ? ($bk->kelas_id ?? null) : $bk);
                    if ($bkId !== null && (string)$bkId === (string)$id_kelas) {
                        $coversClass = true;
                        break;
                    }
                }
            }

            if ($coversClass) {
                $matchedJadwal = $j;
                break;
            }
        }

        if (!$matchedJadwal) {
            foreach ($jadwals as $j) {
                $kat = strtolower(trim($j->kategori ?? ''));
                $kode = strtoupper(trim($j->kode_jenis ?? ''));
                $nama = strtolower(trim($j->nama_jenis ?? ''));
                if (($tipe === 'pts' || $tipe === 'sts') && ($kat === 'sts' || $kode === 'PTS' || strpos($kode, 'STS') !== false || strpos($nama, 'tengah') !== false || strpos($nama, 'sts') !== false || strpos($kode, 'ASTS') !== false || $j->id_jenis == 2)) {
                    $matchedJadwal = $j;
                    break;
                } elseif (($tipe === 'sas' || $tipe === 'pas') && ($kat === 'sas' || in_array($kode, ['PAS', 'PAT', 'SAS', 'SAT']) || strpos($nama, 'akhir') !== false || strpos($kode, 'SAS') !== false || strpos($kode, 'ASAS') !== false || in_array($j->id_jenis, [3, 4]))) {
                    $matchedJadwal = $j;
                    break;
                }
            }
        }

        if (!$matchedJadwal) return [];

        $idJadwal = $matchedJadwal->id_jadwal;
        $scores = [];

        $bKeys = [];
        if (!empty($matchedJadwal->id_bank)) {
            $soals = $this->db->table('cbt_soal')
                ->select('id_soal, bank_id, jenis, nomor_soal, jawaban')
                ->where('bank_id', $matchedJadwal->id_bank)
                ->where('tampilkan', '1')
                ->get()->getResult();
            foreach ($soals as $sRow) {
                $bKeys[$sRow->id_soal] = $sRow;
            }
        }

        // Check cbt_rekap_siswa first
        $rekapSiswa = $this->db->table('cbt_rekap_siswa')
            ->where('id_jadwal', $idJadwal)
            ->get()->getResult();

        if (!empty($rekapSiswa)) {
            foreach ($rekapSiswa as $rs) {
                $calc = $this->calculateCbtScoreItem($rs, $matchedJadwal, $modeKatrol, $minK, $maxK, $bKeys);
                $scores[$rs->id_siswa] = array_merge(['id_siswa' => $rs->id_siswa], $calc);
            }
        } else {
            // Check cbt_siswa
            $cbtSiswa = $this->db->table('cbt_siswa')
                ->where('id_jadwal', $idJadwal)
                ->get()->getResult();

            foreach ($cbtSiswa as $cs) {
                $calc = $this->calculateCbtScoreItem($cs, $matchedJadwal, $modeKatrol, $minK, $maxK, $bKeys);
                $scores[$cs->id_siswa] = array_merge(['id_siswa' => $cs->id_siswa], $calc);
            }
        }

        return $scores;
    }

    /**
     * Parse & hitung skor dari nilai_input, nilai detail, dan jawaban
     */
    public function parseCbtStudentScore($nInputRaw, $nilaiRaw = null, $jawabanRaw = null, $bank = null, $bankSoalKeys = [])
    {
        $candSkorTotal = 0;
        $sumInput = 0;

        $nInput = !empty($nInputRaw) ? (is_array($nInputRaw) ? $nInputRaw : @unserialize($nInputRaw)) : null;
        if (!$nInput && !empty($nInputRaw)) {
            $nInput = json_decode($nInputRaw, true);
        }

        if (is_object($nInput)) {
            if (isset($nInput->skor_total) && is_numeric($nInput->skor_total)) {
                $candSkorTotal = floatval($nInput->skor_total);
            } elseif (isset($nInput->total_nilai) && is_numeric($nInput->total_nilai)) {
                $candSkorTotal = floatval($nInput->total_nilai);
            } elseif (isset($nInput->nilai_akhir->skor_total) && is_numeric($nInput->nilai_akhir->skor_total)) {
                $candSkorTotal = floatval($nInput->nilai_akhir->skor_total);
            }
            $sumInput = floatval($nInput->pg_nilai ?? 0)
                      + floatval($nInput->kompleks_nilai ?? 0)
                      + floatval($nInput->jodohkan_nilai ?? 0)
                      + floatval($nInput->isian_nilai ?? 0)
                      + floatval($nInput->essai_nilai ?? 0);
        } elseif (is_array($nInput)) {
            if (isset($nInput['skor_total']) && is_numeric($nInput['skor_total'])) {
                $candSkorTotal = floatval($nInput['skor_total']);
            } elseif (isset($nInput['total_nilai']) && is_numeric($nInput['total_nilai'])) {
                $candSkorTotal = floatval($nInput['total_nilai']);
            } elseif (isset($nInput['nilai_akhir']['skor_total']) && is_numeric($nInput['nilai_akhir']['skor_total'])) {
                $candSkorTotal = floatval($nInput['nilai_akhir']['skor_total']);
            }
            $sumInput = floatval($nInput['pg_nilai'] ?? 0)
                      + floatval($nInput['kompleks_nilai'] ?? 0)
                      + floatval($nInput['jodohkan_nilai'] ?? 0)
                      + floatval($nInput['isian_nilai'] ?? 0)
                      + floatval($nInput['essai_nilai'] ?? 0);
        }

        // Hitung skor dari detail penilaian guru jika ada
        $sumNilai = 0;
        if (!empty($nilaiRaw)) {
            $nList = is_array($nilaiRaw) ? $nilaiRaw : @unserialize($nilaiRaw);
            if (!$nList && !empty($nilaiRaw)) $nList = json_decode($nilaiRaw, true);
            if (is_array($nList) && !empty($nList)) {
                foreach ($nList as $nItem) {
                    if (is_array($nItem)) {
                        $sumNilai += floatval($nItem['nilai_koreksi'] ?? ($nItem['nilai_otomatis'] ?? 0));
                    } elseif (is_object($nItem)) {
                        $sumNilai += floatval($nItem->nilai_koreksi ?? ($nItem->nilai_otomatis ?? 0));
                    }
                }
            }
        }

        // Lazy load bank soal keys jika belum diberikan
        if (empty($bankSoalKeys) && !empty($bank->id_bank)) {
            $soals = $this->db->table('cbt_soal')
                ->select('id_soal, bank_id, jenis, nomor_soal, jawaban')
                ->where('bank_id', $bank->id_bank)
                ->where('tampilkan', '1')
                ->get()->getResult();
            foreach ($soals as $sr) {
                $bankSoalKeys[$sr->id_soal] = $sr;
            }
        }

        // Hitung skor langsung dari data jawaban siswa (PG + Kompleks + Jodohkan)
        $skorJawaban = 0;
        if (!empty($jawabanRaw)) {
            $jList = is_array($jawabanRaw) ? $jawabanRaw : @unserialize($jawabanRaw);
            if (!$jList && !empty($jawabanRaw)) $jList = json_decode($jawabanRaw, true);
            if (is_array($jList) && !empty($jList)) {
                $tampilPg = floatval($bank->tampil_pg ?? 0);
                $bobotPg = floatval($bank->bobot_pg ?? 0);
                $pointPg = ($tampilPg > 0 && $bobotPg > 0) ? ($bobotPg / $tampilPg) : 0;

                $tampilKomp = floatval($bank->tampil_kompleks ?? 0);
                $bobotKomp = floatval($bank->bobot_kompleks ?? 0);
                $pointKomp = ($tampilKomp > 0 && $bobotKomp > 0) ? ($bobotKomp / $tampilKomp) : 0;

                $tampilJodoh = floatval($bank->tampil_jodohkan ?? 0);
                $bobotJodoh = floatval($bank->bobot_jodohkan ?? 0);
                $pointJodoh = ($tampilJodoh > 0 && $bobotJodoh > 0) ? ($bobotJodoh / $tampilJodoh) : 0;

                $skorPg = 0;
                $skorKomp = 0;
                $skorJodoh = 0;

                // PG score: if nInput already has pg_nilai, prefer it (accurately pre-scored by CBT engine)
                $hasPgFromInput = is_array($nInput) ? isset($nInput['pg_nilai']) : (is_object($nInput) ? isset($nInput->pg_nilai) : false);
                $pgInputVal = is_array($nInput) ? floatval($nInput['pg_nilai'] ?? 0) : (is_object($nInput) ? floatval($nInput->pg_nilai ?? 0) : 0);

                foreach ($jList as $jItem) {
                    $item = is_object($jItem) ? (array)$jItem : $jItem;
                    $jenis = (string)($item['jenis'] ?? '');
                    $idSoal = $item['id_soal'] ?? null;
                    $soalObj = ($idSoal && isset($bankSoalKeys[$idSoal])) ? $bankSoalKeys[$idSoal] : null;

                    if ($jenis === '1') {
                        if (!$hasPgFromInput) {
                            $js = strtoupper(trim((string)($item['jawaban_siswa'] ?? '')));
                            $jb = strtoupper(trim((string)($item['jawaban_benar'] ?? '')));
                            if ($jb === '' && $soalObj) {
                                $kunci = $soalObj->jawaban;
                                if (is_string($kunci)) $jb = strtoupper(trim($kunci));
                            }
                            if ($js !== '' && $js === $jb) {
                                $skorPg += ($pointPg > 0) ? $pointPg : 1;
                            }
                        }
                    } elseif ($jenis === '2') {
                        $js = $item['jawaban_siswa'] ?? [];
                        if (is_string($js)) $js = json_decode($js, true) ?: [$js];
                        $js = array_values(array_map('strtoupper', array_filter((array)$js)));

                        $jb = $item['jawaban_benar'] ?? [];
                        if (empty($jb) && $soalObj) {
                            $kunci = $soalObj->jawaban;
                            if (is_string($kunci)) {
                                $dec = json_decode($kunci, true);
                                if ($dec !== null) $kunci = $dec;
                                else $kunci = @unserialize($kunci) ?: $kunci;
                            }
                            $jb = (array)$kunci;
                        }
                        if (is_string($jb)) $jb = json_decode($jb, true) ?: [$jb];
                        $jb = array_values(array_map('strtoupper', array_filter((array)$jb)));

                        if (!empty($js) && !empty($jb) && count($jb) > 0) {
                            $arrBenar = array_intersect($js, $jb);
                            $skorKomp += (count($arrBenar) / count($jb)) * ($pointKomp > 0 ? $pointKomp : 1);
                        }
                    } elseif ($jenis === '3') {
                        $js = $item['jawaban_siswa'] ?? [];
                        $jb = $item['jawaban_benar'] ?? [];
                        if (empty($jb) && $soalObj) {
                            $kunci = $soalObj->jawaban;
                            if (is_string($kunci)) {
                                $dec = json_decode($kunci, true);
                                if ($dec !== null) $kunci = $dec;
                                else $kunci = @unserialize($kunci) ?: $kunci;
                            }
                            $jb = $kunci;
                        }
                        $linksSiswa = is_object($js) ? ($js->links ?? []) : ($js['links'] ?? (is_array($js) ? $js : []));
                        $linksBenar = is_object($jb) ? ($jb->links ?? []) : ($jb['links'] ?? (is_array($jb) ? $jb : []));
                        $linksSiswa = json_decode(json_encode($linksSiswa), true) ?: [];
                        $linksBenar = json_decode(json_encode($linksBenar), true) ?: [];

                        if (!empty($linksBenar)) {
                            $totLinks = 0;
                            $benarLinks = 0;
                            foreach ($linksBenar as $k => $subBenar) {
                                $subBenarArr = (array)$subBenar;
                                $totLinks += count($subBenarArr);
                                if (isset($linksSiswa[$k])) {
                                    $subSiswaArr = (array)$linksSiswa[$k];
                                    $benarLinks += count(array_intersect($subSiswaArr, $subBenarArr));
                                }
                            }
                            if ($totLinks > 0) {
                                $skorJodoh += ($benarLinks / $totLinks) * ($pointJodoh > 0 ? $pointJodoh : 1);
                            }
                        }
                    }
                }

                if ($hasPgFromInput) {
                    $skorPg = $pgInputVal;
                }
                $skorJawaban = $skorPg + $skorKomp + $skorJodoh;
            }
        }

        // Ambil skor terbaik/terlengkap yang terdeteksi
        $skorFinalAsli = max($candSkorTotal, $sumInput, $sumNilai, $skorJawaban);
        return floatval($skorFinalAsli);
    }

    /**
     * Hitung Skor Akhir CBT (Asli & Katrol) untuk 1 siswa
     */
    public function calculateCbtScoreItem($row, $bank, $modeKatrol = 'katrol', $minK = 60, $maxK = 100, $bankSoalKeys = [])
    {
        if (!$row || !$bank) return ['asli' => 0, 'katrol' => 0, 'final' => 0];
        $skorAsli = $this->parseCbtStudentScore($row->nilai_input ?? null, $row->nilai ?? null, $row->jawaban ?? null, $bank, $bankSoalKeys);
        $pel = !empty($row->pelanggaran) ? (is_array($row->pelanggaran) ? $row->pelanggaran : @unserialize($row->pelanggaran)) : [];
        if (!$pel && !empty($row->pelanggaran)) $pel = json_decode($row->pelanggaran, true) ?: [];
        $totalMinus = 0;
        if (isset($bank->pelanggaran) && $bank->pelanggaran == '1') {
            $totalMinus = is_object($pel) ? ($pel->t_total ?? 0) : ($pel['t_total'] ?? 0);
        }
        $skorTotal = max(0, floatval($skorAsli) - floatval($totalMinus));

        $skorKatrol = $skorTotal;
        if ($skorTotal > 0 && $maxK > $minK) {
            $skorKatrol = ((($maxK - $minK) / 100) * $skorTotal) + $minK;
            if ($skorKatrol < $skorTotal) $skorKatrol = $skorTotal;
        }

        $finalScore = ($modeKatrol === 'katrol') ? round($skorKatrol) : round($skorTotal);
        return [
            'asli' => round($skorTotal),
            'katrol' => round($skorKatrol),
            'final' => $finalScore
        ];
    }

    /**
     * Get Kokurikuler (P5/P2RA) per Kelas
     */
    public function getP5Kelas($id_kelas, $id_tp, $id_smt)
    {
        $rows = $this->db->table('rapor_kurmer_p5')
            ->where('id_kelas', $id_kelas)
            ->where('id_tp', $id_tp)
            ->where('id_smt', $id_smt)
            ->get()->getResult();

        $res = [];
        foreach ($rows as $r) {
            $res[$r->id_siswa] = $r;
        }
        return $res;
    }

    /**
     * Save Kokurikuler (P5/P2RA)
     */
    public function saveP5($data)
    {
        $exists = $this->db->table('rapor_kurmer_p5')
            ->where('id_tp', $data['id_tp'])
            ->where('id_smt', $data['id_smt'])
            ->where('id_kelas', $data['id_kelas'])
            ->where('id_siswa', $data['id_siswa'])
            ->get()->getRow();

        $data['updated_at'] = date('Y-m-d H:i:s');
        if ($exists) {
            return $this->db->table('rapor_kurmer_p5')
                ->where('id_p5', $exists->id_p5)
                ->update($data);
        } else {
            return $this->db->table('rapor_kurmer_p5')->insert($data);
        }
    }

    /**
     * Get Kokurikuler Kemenag (DPL / Panca Cinta) per Kelas
     */
    public function getKemenagKokurikulerList($id_kelas, $id_tp, $id_smt)
    {
        $kegiatanList = $this->db->table('rapor_kemenag_kokurikuler')
            ->where('id_kelas', $id_kelas)
            ->where('id_tp', $id_tp)
            ->where('id_smt', $id_smt)
            ->orderBy('id_kegiatan', 'ASC')
            ->get()->getResult();

        // Jika belum ada sama sekali untuk kelas ini, buatkan 3 contoh default standar RDM
        if (empty($kegiatanList)) {
            $defaults = [
                [
                    'dpl' => 'Penalaran Kritis',
                    'desc' => 'Menganalisis interaksi antar komponen ekosistem dan pengaruhnya terhadap keseimbangan ekosistem ( mata pelajaran IPA) sebagai wujud lingkungan',
                ],
                [
                    'dpl' => 'Komunikasi',
                    'desc' => 'Mempresentasikan gagasan sebagai solusi pemecahan masalah secara kritis dan kreatif berlandaskan al-quran Hadits ( mata pelajaran Bahasa Indonesia dan Al-quran Hadits)',
                ],
                [
                    'dpl' => 'Cinta Lingkungan',
                    'desc' => 'Memahami alam semesta sebagai manifestasi cinta dan kebesaran Allah sehingga tumbuh rasa hormat dan kasih sayang terhadap lingkungan',
                ]
            ];
            foreach ($defaults as $def) {
                $this->db->table('rapor_kemenag_kokurikuler')->insert([
                    'id_tp' => $id_tp,
                    'id_smt' => $id_smt,
                    'id_kelas' => $id_kelas,
                    'dpl_panca_cinta' => $def['dpl'],
                    'deskripsi' => $def['desc'],
                    'is_kirim' => 0,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
            }
            $kegiatanList = $this->db->table('rapor_kemenag_kokurikuler')
                ->where('id_kelas', $id_kelas)
                ->where('id_tp', $id_tp)
                ->where('id_smt', $id_smt)
                ->orderBy('id_kegiatan', 'ASC')
                ->get()->getResult();
        }

        foreach ($kegiatanList as $k) {
            $count = $this->db->table('rapor_kemenag_kokurikuler_nilai')
                ->where('id_kegiatan', $k->id_kegiatan)
                ->countAllResults();
            $k->jumlah_dinilai = $count;
            $k->has_nilai = ($count > 0);
        }

        return $kegiatanList;
    }

    public function saveKemenagKegiatan($data)
    {
        $data['updated_at'] = date('Y-m-d H:i:s');
        if (!empty($data['id_kegiatan'])) {
            $id = $data['id_kegiatan'];
            unset($data['id_kegiatan']);
            $this->db->table('rapor_kemenag_kokurikuler')->where('id_kegiatan', $id)->update($data);
            return $id;
        } else {
            $data['created_at'] = date('Y-m-d H:i:s');
            $this->db->table('rapor_kemenag_kokurikuler')->insert($data);
            return $this->db->insertID();
        }
    }

    public function deleteKemenagKegiatan($id_kegiatan)
    {
        $this->db->table('rapor_kemenag_kokurikuler_nilai')->where('id_kegiatan', $id_kegiatan)->delete();
        return $this->db->table('rapor_kemenag_kokurikuler')->where('id_kegiatan', $id_kegiatan)->delete();
    }

    public function getKemenagNilaiMap($id_kegiatan)
    {
        $rows = $this->db->table('rapor_kemenag_kokurikuler_nilai')
            ->where('id_kegiatan', $id_kegiatan)
            ->get()->getResult();
        $map = [];
        foreach ($rows as $r) {
            $map[$r->id_siswa] = $r->nilai;
        }
        return $map;
    }

    public function saveKemenagNilaiMassal($id_kegiatan, $nilaiMap)
    {
        $now = date('Y-m-d H:i:s');
        foreach ($nilaiMap as $id_siswa => $nilai) {
            if (empty($nilai)) {
                $this->db->table('rapor_kemenag_kokurikuler_nilai')
                    ->where('id_kegiatan', $id_kegiatan)
                    ->where('id_siswa', $id_siswa)
                    ->delete();
                continue;
            }
            $exists = $this->db->table('rapor_kemenag_kokurikuler_nilai')
                ->where('id_kegiatan', $id_kegiatan)
                ->where('id_siswa', $id_siswa)
                ->get()->getRow();
            if ($exists) {
                $this->db->table('rapor_kemenag_kokurikuler_nilai')
                    ->where('id_nilai', $exists->id_nilai)
                    ->update(['nilai' => $nilai, 'updated_at' => $now]);
            } else {
                $this->db->table('rapor_kemenag_kokurikuler_nilai')->insert([
                    'id_kegiatan' => $id_kegiatan,
                    'id_siswa' => $id_siswa,
                    'nilai' => $nilai,
                    'updated_at' => $now
                ]);
            }
        }
        return true;
    }

    public function toggleKemenagKirim($id_kelas, $id_tp, $id_smt, $status)
    {
        return $this->db->table('rapor_kemenag_kokurikuler')
            ->where('id_kelas', $id_kelas)
            ->where('id_tp', $id_tp)
            ->where('id_smt', $id_smt)
            ->update(['is_kirim' => $status, 'updated_at' => date('Y-m-d H:i:s')]);
    }

    /**
     * =========================================================================
     * KOKURIKULER KEMENDIKNAS (DEEP LEARNING KURMER P5)
     * =========================================================================
     */
    public function getDiknasKokurikulerKegiatan($id_kelas, $id_tp, $id_smt)
    {
        $keg = $this->db->table('rapor_diknas_kokurikuler_kegiatan')
            ->where('id_kelas', $id_kelas)
            ->where('id_tp', $id_tp)
            ->where('id_smt', $id_smt)
            ->get()->getRow();

        if (!$keg) {
            $kelas = $this->db->table('master_kelas')->where('id_kelas', $id_kelas)->get()->getRow();
            $namaKelas = $kelas->nama_kelas ?? 'VII A';

            // Auto-create default kegiatan matching New folder sample
            $this->db->table('rapor_diknas_kokurikuler_kegiatan')->insert([
                'id_tp' => $id_tp,
                'id_smt' => $id_smt,
                'id_kelas' => $id_kelas,
                'nama_kelompok' => $namaKelas . ' - 1',
                'tema' => 'Kearifan Lokal',
                'nama_kegiatan' => 'Kajian dan Pembiasaan Ibadah',
                'deskripsi' => 'Penguatan karakter spiritual dan religius melalui pembiasaan ibadah harian.',
                'koordinator' => 'Guru Koordinator',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
            $kegId = $this->db->insertID();

            // Insert 2 standard capaian
            $this->db->table('rapor_diknas_kokurikuler_capaian')->insert([
                'id_kegiatan' => $kegId,
                'dimensi_id' => 1,
                'dimensi' => 'Keimanan dan Ketakwaan terhadap Tuhan YME',
                'capaian_akhir' => 'melaksanakan ibadah harian (salat, doa, membaca Al-Qur’an, dan adab dasar) secara mandiri dan benar.',
                'urutan' => 1
            ]);
            $this->db->table('rapor_diknas_kokurikuler_capaian')->insert([
                'id_kegiatan' => $kegId,
                'dimensi_id' => 1,
                'dimensi' => 'Keimanan dan Ketakwaan terhadap Tuhan YME',
                'capaian_akhir' => 'membiasakan sikap religius, seperti disiplin beribadah, menjaga kebersihan, sopan, jujur, dan bertanggung jawab.',
                'urutan' => 2
            ]);

            $keg = $this->db->table('rapor_diknas_kokurikuler_kegiatan')->where('id_kegiatan', $kegId)->get()->getRow();
        }

        return $keg;
    }

    public function saveDiknasKokurikulerKegiatan($data)
    {
        $data['updated_at'] = date('Y-m-d H:i:s');
        if (!empty($data['id_kegiatan'])) {
            $id = $data['id_kegiatan'];
            unset($data['id_kegiatan']);
            $this->db->table('rapor_diknas_kokurikuler_kegiatan')->where('id_kegiatan', $id)->update($data);
            return $id;
        } else {
            $data['created_at'] = date('Y-m-d H:i:s');
            $this->db->table('rapor_diknas_kokurikuler_kegiatan')->insert($data);
            return $this->db->insertID();
        }
    }

    public function getDiknasCapaianList($id_kegiatan)
    {
        return $this->db->table('rapor_diknas_kokurikuler_capaian')
            ->where('id_kegiatan', $id_kegiatan)
            ->orderBy('urutan', 'ASC')
            ->get()->getResult();
    }

    public function saveDiknasCapaian($data)
    {
        if (!empty($data['id_capaian'])) {
            $id = $data['id_capaian'];
            unset($data['id_capaian']);
            $this->db->table('rapor_diknas_kokurikuler_capaian')->where('id_capaian', $id)->update($data);
            return $id;
        } else {
            $this->db->table('rapor_diknas_kokurikuler_capaian')->insert($data);
            return $this->db->insertID();
        }
    }

    public function deleteDiknasCapaian($id_capaian)
    {
        $this->db->table('rapor_diknas_kokurikuler_nilai')->where('id_capaian', $id_capaian)->delete();
        return $this->db->table('rapor_diknas_kokurikuler_capaian')->where('id_capaian', $id_capaian)->delete();
    }

    public function getDiknasNilaiMap($id_kegiatan, $id_capaian)
    {
        $rows = $this->db->table('rapor_diknas_kokurikuler_nilai')
            ->where('id_kegiatan', $id_kegiatan)
            ->where('id_capaian', $id_capaian)
            ->get()->getResult();

        $map = [];
        foreach ($rows as $r) {
            $map[$r->id_siswa] = $r->predikat;
        }
        return $map;
    }

    public function saveDiknasNilaiMassal($id_kegiatan, $id_capaian, $nilaiData)
    {
        $now = date('Y-m-d H:i:s');
        foreach ($nilaiData as $id_siswa => $predikat) {
            $predikat = strtoupper(trim($predikat));
            if ($predikat === '') continue;

            $exists = $this->db->table('rapor_diknas_kokurikuler_nilai')
                ->where('id_kegiatan', $id_kegiatan)
                ->where('id_capaian', $id_capaian)
                ->where('id_siswa', $id_siswa)
                ->get()->getRow();

            if ($exists) {
                $this->db->table('rapor_diknas_kokurikuler_nilai')
                    ->where('id_nilai', $exists->id_nilai)
                    ->update(['predikat' => $predikat, 'updated_at' => $now]);
            } else {
                $this->db->table('rapor_diknas_kokurikuler_nilai')->insert([
                    'id_kegiatan' => $id_kegiatan,
                    'id_capaian' => $id_capaian,
                    'id_siswa' => $id_siswa,
                    'predikat' => $predikat,
                    'updated_at' => $now
                ]);
            }

            // Otomatis sinkronkan dan bangun narasi untuk siswa ini
            $this->syncDiknasNarasiSiswa($id_kegiatan, $id_siswa);
        }
        return true;
    }

    public function syncDiknasNarasiSiswa($id_kegiatan, $id_siswa)
    {
        $keg = $this->db->table('rapor_diknas_kokurikuler_kegiatan')->where('id_kegiatan', $id_kegiatan)->get()->getRow();
        if (!$keg) return;

        $siswa = $this->db->table('master_siswa')->where('id_siswa', $id_siswa)->get()->getRow();
        $namaSiswa = $siswa ? $siswa->nama : 'Peserta Didik';

        $capaianList = $this->db->table('rapor_diknas_kokurikuler_capaian')
            ->where('id_kegiatan', $id_kegiatan)
            ->orderBy('urutan', 'ASC')
            ->get()->getResult();

        $predMap1 = [
            'SB' => 'sangat baik',
            'B'  => 'baik',
            'C'  => 'cukup baik',
            'K'  => 'perlu bimbingan',
        ];
        $predMap2 = [
            'SB' => 'Sangat baik',
            'B'  => 'Sudah baik',
            'C'  => 'Cukup baik',
            'K'  => 'Perlu bimbingan',
        ];

        $narasi = '';
        if (count($capaianList) >= 2) {
            $c1 = $capaianList[0];
            $c2 = $capaianList[1];

            $n1 = $this->db->table('rapor_diknas_kokurikuler_nilai')
                ->where('id_kegiatan', $id_kegiatan)
                ->where('id_capaian', $c1->id_capaian)
                ->where('id_siswa', $id_siswa)
                ->get()->getRow();
            $n2 = $this->db->table('rapor_diknas_kokurikuler_nilai')
                ->where('id_kegiatan', $id_kegiatan)
                ->where('id_capaian', $c2->id_capaian)
                ->where('id_siswa', $id_siswa)
                ->get()->getRow();

            $p1 = $predMap1[strtoupper($n1->predikat ?? 'SB')] ?? 'sangat baik';
            $p2 = $predMap2[strtoupper($n2->predikat ?? 'B')] ?? 'Sudah baik';

            $t1 = rtrim(trim($c1->capaian_akhir), '.');
            $t2 = rtrim(trim($c2->capaian_akhir), '.');

            $narasi = "Dalam kegiatan " . $keg->nama_kegiatan . ", " . $namaSiswa . " " . $p1 . " dalam " . $t1 . ". " . $p2 . " dalam " . $t2 . ".";
        } elseif (count($capaianList) === 1) {
            $c1 = $capaianList[0];
            $n1 = $this->db->table('rapor_diknas_kokurikuler_nilai')
                ->where('id_kegiatan', $id_kegiatan)
                ->where('id_capaian', $c1->id_capaian)
                ->where('id_siswa', $id_siswa)
                ->get()->getRow();
            $p1 = $predMap1[strtoupper($n1->predikat ?? 'B')] ?? 'baik';
            $t1 = rtrim(trim($c1->capaian_akhir), '.');
            $narasi = "Dalam kegiatan " . $keg->nama_kegiatan . ", " . $namaSiswa . " " . $p1 . " dalam " . $t1 . ".";
        }

        if (!empty($narasi)) {
            // Update or insert ke rapor_diknas_kokurikuler_catatan
            $exists = $this->db->table('rapor_diknas_kokurikuler_catatan')
                ->where('id_kegiatan', $id_kegiatan)
                ->where('id_siswa', $id_siswa)
                ->get()->getRow();

            if ($exists) {
                $this->db->table('rapor_diknas_kokurikuler_catatan')
                    ->where('id_catatan', $exists->id_catatan)
                    ->update(['deskripsi' => $narasi, 'updated_at' => date('Y-m-d H:i:s')]);
            } else {
                $this->db->table('rapor_diknas_kokurikuler_catatan')->insert([
                    'id_kegiatan' => $id_kegiatan,
                    'id_siswa' => $id_siswa,
                    'deskripsi' => $narasi,
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
            }

            // Juga sinkronkan ke rapor_kurmer_p5 agar selalu selaras
            $this->saveP5([
                'id_tp' => $keg->id_tp,
                'id_smt' => $keg->id_smt,
                'id_kelas' => $keg->id_kelas,
                'id_siswa' => $id_siswa,
                'tema' => $keg->tema,
                'deskripsi' => $narasi
            ]);
        }
    }

    public function getDiknasCatatanList($id_kegiatan)
    {
        $rows = $this->db->table('rapor_diknas_kokurikuler_catatan')
            ->where('id_kegiatan', $id_kegiatan)
            ->get()->getResult();

        $map = [];
        foreach ($rows as $r) {
            $map[$r->id_siswa] = $r->deskripsi;
        }
        return $map;
    }

    public function saveDiknasCatatanMassal($id_kegiatan, $catatanData)
    {
        $keg = $this->db->table('rapor_diknas_kokurikuler_kegiatan')->where('id_kegiatan', $id_kegiatan)->get()->getRow();
        $now = date('Y-m-d H:i:s');
        foreach ($catatanData as $id_siswa => $deskripsi) {
            $deskripsi = trim($deskripsi);
            $exists = $this->db->table('rapor_diknas_kokurikuler_catatan')
                ->where('id_kegiatan', $id_kegiatan)
                ->where('id_siswa', $id_siswa)
                ->get()->getRow();

            if ($exists) {
                $this->db->table('rapor_diknas_kokurikuler_catatan')
                    ->where('id_catatan', $exists->id_catatan)
                    ->update(['deskripsi' => $deskripsi, 'updated_at' => $now]);
            } else {
                $this->db->table('rapor_diknas_kokurikuler_catatan')->insert([
                    'id_kegiatan' => $id_kegiatan,
                    'id_siswa' => $id_siswa,
                    'deskripsi' => $deskripsi,
                    'updated_at' => $now
                ]);
            }

            if ($keg) {
                $this->saveP5([
                    'id_tp' => $keg->id_tp,
                    'id_smt' => $keg->id_smt,
                    'id_kelas' => $keg->id_kelas,
                    'id_siswa' => $id_siswa,
                    'tema' => $keg->tema,
                    'deskripsi' => $deskripsi
                ]);
            }
        }
        return true;
    }

    /**
     * Get Ekstrakurikuler per Kelas
     */
    public function getEkstraKelas($id_kelas, $id_tp, $id_smt)
    {
        return $this->db->table('rapor_kurmer_ekstra')
            ->where('id_kelas', $id_kelas)
            ->where('id_tp', $id_tp)
            ->where('id_smt', $id_smt)
            ->get()->getResult();
    }

    /**
     * Save Ekstrakurikuler
     */
    public function saveEkstra($data)
    {
        return $this->db->table('rapor_kurmer_ekstra')->insert($data);
    }

    /**
     * Delete Ekstrakurikuler
     */
    public function deleteEkstra($id_ekstra)
    {
        return $this->db->table('rapor_kurmer_ekstra')->where('id_ekstra', $id_ekstra)->delete();
    }

    /**
     * Get Prestasi per Kelas
     */
    public function getPrestasiKelas($id_kelas, $id_tp, $id_smt)
    {
        return $this->db->table('rapor_kurmer_prestasi')
            ->where('id_kelas', $id_kelas)
            ->where('id_tp', $id_tp)
            ->where('id_smt', $id_smt)
            ->get()->getResult();
    }

    /**
     * Save Prestasi
     */
    public function savePrestasi($data)
    {
        return $this->db->table('rapor_kurmer_prestasi')->insert($data);
    }

    /**
     * Delete Prestasi
     */
    public function deletePrestasi($id_prestasi)
    {
        return $this->db->table('rapor_kurmer_prestasi')->where('id_prestasi', $id_prestasi)->delete();
    }

    /**
     * Get Kehadiran & Catatan per Kelas
     */
    public function getKehadiranKelas($id_kelas, $id_tp, $id_smt)
    {
        $rows = $this->db->table('rapor_kurmer_kehadiran')
            ->where('id_kelas', $id_kelas)
            ->where('id_tp', $id_tp)
            ->where('id_smt', $id_smt)
            ->get()->getResult();

        $res = [];
        foreach ($rows as $r) {
            $res[$r->id_siswa] = $r;
        }
        return $res;
    }

    /**
     * Save Kehadiran & Catatan
     */
    public function saveKehadiran($data)
    {
        $exists = $this->db->table('rapor_kurmer_kehadiran')
            ->where('id_tp', $data['id_tp'])
            ->where('id_smt', $data['id_smt'])
            ->where('id_kelas', $data['id_kelas'])
            ->where('id_siswa', $data['id_siswa'])
            ->get()->getRow();

        $data['updated_at'] = date('Y-m-d H:i:s');
        if ($exists) {
            return $this->db->table('rapor_kurmer_kehadiran')
                ->where('id_kehadiran', $exists->id_kehadiran)
                ->update($data);
        } else {
            return $this->db->table('rapor_kurmer_kehadiran')->insert($data);
        }
    }

    /**
     * Get Complete Rapor Data for a Student (used for Cetak Rapor Akhir, STS, Nilai)
     */
    public function getRaporSiswaLengkap($id_siswa, $id_kelas, $id_tp, $id_smt)
    {
        // 1. Student identity
        $siswa = $this->db->table('master_siswa a')
            ->select('a.*, b.id_kelas, c.nama_kelas, c.level_id')
            ->join('kelas_siswa b', 'a.id_siswa=b.id_siswa', 'left')
            ->join('master_kelas c', 'b.id_kelas=c.id_kelas', 'left')
            ->where('a.id_siswa', $id_siswa)
            ->where('b.id_tp', $id_tp)
            ->where('b.id_smt', $id_smt)
            ->get()->getRow();

        if (!$siswa) {
            $siswa = $this->db->table('master_siswa a')
                ->select('a.*, c.id_kelas, c.nama_kelas, c.level_id')
                ->join('master_kelas c', 'c.id_kelas = ' . $this->db->escape($id_kelas), 'left')
                ->where('a.id_siswa', $id_siswa)
                ->get()->getRow();
        }

        // Cek data kenaikan kelas dari tabel rapor_naik jika ada
        $isNaik = 1; // Default: 1 (Naik/Lulus)
        if ($this->db->tableExists('rapor_naik')) {
            $naikRow = $this->db->table('rapor_naik')
                ->where('id_siswa', $id_siswa)
                ->where('id_tp', $id_tp)
                ->where('id_smt', $id_smt)
                ->get()->getRow();
            if ($naikRow && $naikRow->naik !== null && $naikRow->naik !== '') {
                $isNaik = (int)$naikRow->naik;
            }
        }
        if ($siswa) {
            $siswa->naik = $isNaik;
        }

        // 2. Setting
        $setting = $this->getSetting($id_tp, $id_smt);

        // 3. Subjects & Grades: Disesuaikan secara otomatis dengan mapel yang diujikan/diajarkan pada kelas ini
        $mapelList = $this->getMapelRaporKelas($id_kelas, $id_tp, $id_smt);
        
        $nilaiDb = $this->db->table('rapor_kurmer_nilai')
            ->where('id_siswa', $id_siswa)
            ->where('id_kelas', $id_kelas)
            ->where('id_tp', $id_tp)
            ->where('id_smt', $id_smt)
            ->get()->getResult();

        $mapNilai = [];
        foreach ($nilaiDb as $n) {
            $mapNilai[$n->id_mapel] = $n;
        }

        // Pengaturan konversi nilai CBT
        $modeKatrol = $setting->cbt_convert_mode ?? 'katrol';
        $minK = floatval($setting->cbt_katrol_min ?? 60);
        $maxK = floatval($setting->cbt_katrol_max ?? 100);

        // Otomatis sinkronkan dengan ujian CBT yang telah diikuti siswa jika nilai di rapor_kurmer_nilai belum tersimpan
        $cbtJadwals = $this->db->table('cbt_jadwal j')
            ->select('j.id_jadwal, j.id_bank, j.id_jenis, j.pelanggaran, b.bank_mapel_id, b.bank_kelas, b.jml_soal, b.tampil_pg, b.bobot_pg, b.jml_kompleks, b.tampil_kompleks, b.bobot_kompleks, b.jml_jodohkan, b.tampil_jodohkan, b.bobot_jodohkan, b.jml_isian, b.tampil_isian, b.bobot_isian, b.jml_esai, b.tampil_esai, b.bobot_esai, k.kode_jenis, k.nama_jenis, k.kategori')
            ->join('cbt_bank_soal b', 'j.id_bank = b.id_bank', 'inner')
            ->join('cbt_jenis k', 'j.id_jenis = k.id_jenis', 'left')
            ->where('j.id_tp', $id_tp)
            ->where('j.id_smt', $id_smt)
            ->get()->getResult();

        $cbtPtsByMapel = [];
        $cbtSasByMapel = [];
        $allJadwalIds = [];

        foreach ($cbtJadwals as $cj) {
            $bankKelas = !empty($cj->bank_kelas) ? (is_array($cj->bank_kelas) ? $cj->bank_kelas : @unserialize($cj->bank_kelas)) : [];
            if (!$bankKelas && !empty($cj->bank_kelas)) {
                $bankKelas = json_decode($cj->bank_kelas, true) ?: [];
            }
            $coversClass = false;
            if (is_array($bankKelas)) {
                foreach ($bankKelas as $bk) {
                    $bkId = is_array($bk) ? ($bk['kelas_id'] ?? $bk[0] ?? null) : (is_object($bk) ? ($bk->kelas_id ?? null) : $bk);
                    if ($bkId !== null && (string)$bkId === (string)$id_kelas) {
                        $coversClass = true;
                        break;
                    }
                }
            }
            if (!$coversClass) continue;

            $kat = strtolower(trim($cj->kategori ?? ''));
            $kode = strtoupper(trim($cj->kode_jenis ?? ''));
            $nama = strtolower(trim($cj->nama_jenis ?? ''));
            if ($kat === 'sts' || $kode === 'PTS' || strpos($kode, 'STS') !== false || strpos($nama, 'tengah') !== false || strpos($nama, 'sts') !== false || strpos($kode, 'ASTS') !== false || $cj->id_jenis == 2) {
                $cbtPtsByMapel[$cj->bank_mapel_id] = $cj;
                $allJadwalIds[] = $cj->id_jadwal;
            } elseif ($kat === 'sas' || in_array($kode, ['PAS', 'PAT', 'SAS', 'SAT']) || strpos($nama, 'akhir') !== false || strpos($kode, 'SAS') !== false || strpos($kode, 'ASAS') !== false || in_array($cj->id_jenis, [3, 4])) {
                $cbtSasByMapel[$cj->bank_mapel_id] = $cj;
                $allJadwalIds[] = $cj->id_jadwal;
            }
        }

        $cbtSiswaData = [];
        if (!empty($allJadwalIds)) {
            $rkpRows = $this->db->table('cbt_rekap_siswa')
                ->whereIn('id_jadwal', $allJadwalIds)
                ->where('id_siswa', $id_siswa)
                ->get()->getResult();
            foreach ($rkpRows as $rk) {
                $cbtSiswaData[$rk->id_jadwal] = $rk;
            }

            $cbtRows = $this->db->table('cbt_siswa')
                ->whereIn('id_jadwal', $allJadwalIds)
                ->where('id_siswa', $id_siswa)
                ->get()->getResult();
            foreach ($cbtRows as $cs) {
                if (!isset($cbtSiswaData[$cs->id_jadwal])) {
                    $cbtSiswaData[$cs->id_jadwal] = $cs;
                }
            }
        }

        $nilaiRows = [];
        foreach ($mapelList as $m) {
            $n = $mapNilai[$m->id_mapel] ?? null;

            $valSts = ($n && $n->nilai_sts !== null && $n->nilai_sts !== '') ? floatval($n->nilai_sts) : null;
            $valSas = ($n && $n->nilai_sas !== null && $n->nilai_sas !== '') ? floatval($n->nilai_sas) : null;
            $valNa = ($n && $n->nilai_akhir !== null && $n->nilai_akhir !== '') ? floatval($n->nilai_akhir) : null;

            // Jika nilai PTS/STS belum diisi manual/disimpan, ambil otomatis dari CBT PTS
            if (($valSts === null || $valSts == 0) && isset($cbtPtsByMapel[$m->id_mapel])) {
                $jObj = $cbtPtsByMapel[$m->id_mapel];
                $sRow = $cbtSiswaData[$jObj->id_jadwal] ?? null;
                if ($sRow) {
                    $cCalc = $this->calculateCbtScoreItem($sRow, $jObj, $modeKatrol, $minK, $maxK);
                    if ($cCalc && $cCalc['final'] > 0) {
                        $valSts = $cCalc['final'];
                        if ($valNa === null || $valNa == 0) {
                            $valNa = $cCalc['final'];
                        }
                    }
                }
            }

            // Jika nilai SAS belum diisi manual/disimpan, ambil otomatis dari CBT SAS
            if (($valSas === null || $valSas == 0) && isset($cbtSasByMapel[$m->id_mapel])) {
                $jObj = $cbtSasByMapel[$m->id_mapel];
                $sRow = $cbtSiswaData[$jObj->id_jadwal] ?? null;
                if ($sRow) {
                    $cCalc = $this->calculateCbtScoreItem($sRow, $jObj, $modeKatrol, $minK, $maxK);
                    if ($cCalc && $cCalc['final'] > 0) {
                        $valSas = $cCalc['final'];
                        if ($valNa === null || $valNa == 0) {
                            $valNa = $cCalc['final'];
                        }
                    }
                }
            }

            // Fallback ke rapor_nilai_pts K13 lama jika masih kosong
            if ($valSts === null || $valSts == 0) {
                $oldPts = $this->db->table('rapor_nilai_pts')
                    ->where('id_siswa', $id_siswa)
                    ->where('id_mapel', $m->id_mapel)
                    ->where('id_tp', $id_tp)
                    ->where('id_smt', $id_smt)
                    ->get()->getRow();
                if ($oldPts && isset($oldPts->nilai) && is_numeric($oldPts->nilai) && floatval($oldPts->nilai) > 0) {
                    $valSts = floatval($oldPts->nilai);
                    if ($valNa === null || $valNa == 0) {
                        $valNa = $valSts;
                    }
                }
            }

            $nilaiRows[] = (object)[
                'id_mapel' => $m->id_mapel,
                'nama_mapel' => $m->nama_mapel,
                'kode_mapel' => $m->kode_mapel ?? ($m->kode ?? ''),
                'urutan_tampil' => $m->urutan_tampil ?? 0,
                'kelompok' => $m->kelompok ?? '',
                'kode_kel_mapel' => $m->kode_kel_mapel ?? '',
                'nama_kel_mapel' => $m->nama_kel_mapel ?? '',
                'kategori' => $m->kategori ?? '',
                'id_nilai' => $n ? $n->id_nilai : null,
                'nilai_sumatif' => $n ? $n->nilai_sumatif : null,
                'rata_sumatif' => $n ? $n->rata_sumatif : null,
                'nilai_sts' => $valSts,
                'nilai_sas' => $valSas,
                'nilai_akhir' => $valNa,
                'sts' => $valSts,
                'sas' => $valSas,
                'rerata_lm' => $n ? $n->rata_sumatif : null,
                'deskripsi_tertinggi' => $n ? $n->deskripsi_tertinggi : null,
                'deskripsi_terendah' => $n ? $n->deskripsi_terendah : null,
                'deskripsi_capaian' => $n ? $n->deskripsi_capaian : null,
                'capaian_tertinggi' => $n ? $n->deskripsi_tertinggi : null,
                'capaian_terendah' => $n ? $n->deskripsi_terendah : null,
            ];
        }

        // 4. Kokurikuler (Kemendiknas Deep Learning & Kemenag)

        // --- 4A. KOKURIKULER KEMENDIKNAS (DEEP LEARNING) ---
        $diknasCatatan = $this->db->table('rapor_diknas_kokurikuler_catatan a')
            ->select('a.deskripsi, b.nama_kegiatan, b.tema')
            ->join('rapor_diknas_kokurikuler_kegiatan b', 'a.id_kegiatan = b.id_kegiatan')
            ->where('a.id_siswa', $id_siswa)
            ->where('b.id_kelas', $id_kelas)
            ->where('b.id_tp', $id_tp)
            ->where('b.id_smt', $id_smt)
            ->get()->getRow();

        $kokurikulerDiknas = '';
        if ($diknasCatatan && !empty($diknasCatatan->deskripsi)) {
            $kokurikulerDiknas = trim($diknasCatatan->deskripsi);
        }

        // Jika belum ada catatan individual siswa, coba generate dari capaian kegiatan kelas
        if (empty($kokurikulerDiknas)) {
            $diknasKegiatan = $this->db->table('rapor_diknas_kokurikuler_kegiatan')
                ->where('id_kelas', $id_kelas)
                ->where('id_tp', $id_tp)
                ->where('id_smt', $id_smt)
                ->get()->getRow();

            if ($diknasKegiatan) {
                $capaianList = $this->db->table('rapor_diknas_kokurikuler_capaian')
                    ->where('id_kegiatan', $diknasKegiatan->id_kegiatan)
                    ->get()->getResult();
                if (!empty($capaianList)) {
                    $cParts = [];
                    foreach ($capaianList as $c) {
                        if (!empty($c->deskripsi_capaian)) {
                            $cParts[] = trim($c->deskripsi_capaian);
                        }
                    }
                    if (!empty($cParts)) {
                        $namaSiswa = $siswa ? $siswa->nama : 'Peserta Didik';
                        $namaKeg = !empty($diknasKegiatan->nama_kegiatan) ? $diknasKegiatan->nama_kegiatan : 'Kajian dan Pembiasaan Ibadah';
                        $kokurikulerDiknas = 'Dalam kegiatan ' . $namaKeg . ', ' . $namaSiswa . ' sangat baik dalam ' . implode(' Sudah baik dalam ', $cParts) . '.';
                    }
                }
            }
        }

        // Fallback default Diknas jika belum diinput sama sekali
        if (empty($kokurikulerDiknas)) {
            $namaSiswa = $siswa ? $siswa->nama : 'Peserta Didik';
            $kokurikulerDiknas = 'Dalam kegiatan Kajian dan Pembiasaan Ibadah, ' . $namaSiswa . ' sangat baik dalam melaksanakan ibadah harian (salat, doa, membaca Al-Qur\'an, dan adab dasar) secara mandiri dan benar. Sudah baik dalam membiasakan sikap religius, seperti disiplin beribadah, menjaga kebersihan, sopan, jujur, dan bertanggung jawab.';
        }

        // --- 4B. KOKURIKULER KEMENAG (DPL & PANCA CINTA / RDM) ---
        $kokurikulerKemenag = '';
        $kemenagNilai = $this->db->table('rapor_kemenag_kokurikuler_nilai a')
            ->select('a.nilai, b.dpl_panca_cinta, b.deskripsi')
            ->join('rapor_kemenag_kokurikuler b', 'a.id_kegiatan = b.id_kegiatan')
            ->where('a.id_siswa', $id_siswa)
            ->where('b.id_kelas', $id_kelas)
            ->where('b.id_tp', $id_tp)
            ->where('b.id_smt', $id_smt)
            ->orderBy('b.id_kegiatan', 'ASC')
            ->get()->getResult();

        if (!empty($kemenagNilai)) {
            $predMap = [
                'SB' => 'sangat baik',
                'B'  => 'baik',
                'C'  => 'cukup baik',
                'K'  => 'perlu bimbingan',
            ];
            $narrativeParts = [];
            foreach ($kemenagNilai as $kn) {
                $pVal = strtoupper(trim($kn->nilai ?? 'B'));
                $pText = $predMap[$pVal] ?? 'baik';
                $dText = trim($kn->deskripsi ?? '');
                if (!empty($dText)) {
                    $narrativeParts[] = $pText . ' dalam ' . $dText;
                }
            }
            if (!empty($narrativeParts)) {
                if (count($narrativeParts) === 1) {
                    $kokurikulerKemenag = 'Siswa ' . $narrativeParts[0];
                } elseif (count($narrativeParts) === 2) {
                    $kokurikulerKemenag = 'Siswa ' . $narrativeParts[0] . ' dan ' . $narrativeParts[1];
                } else {
                    $lastPart = array_pop($narrativeParts);
                    $kokurikulerKemenag = 'Siswa ' . implode(', ', $narrativeParts) . ' dan ' . $lastPart;
                }
            }
        }

        $p5 = $this->db->table('rapor_kurmer_p5')
            ->where('id_siswa', $id_siswa)
            ->where('id_kelas', $id_kelas)
            ->where('id_tp', $id_tp)
            ->where('id_smt', $id_smt)
            ->get()->getRow();

        // Jika belum ada nilai di tabel penilaian siswa:
        if (empty($kokurikulerKemenag)) {
            if ($p5 && !empty($p5->deskripsi)) {
                $kokurikulerKemenag = trim($p5->deskripsi);
            } else {
                // Ambil daftar kegiatan kokurikuler kelas jika ada
                $kegiatanKelas = $this->db->table('rapor_kemenag_kokurikuler')
                    ->where('id_kelas', $id_kelas)
                    ->where('id_tp', $id_tp)
                    ->where('id_smt', $id_smt)
                    ->orderBy('id_kegiatan', 'ASC')
                    ->get()->getResult();

                if (!empty($kegiatanKelas)) {
                    $narrativeParts = [];
                    foreach ($kegiatanKelas as $idx => $kk) {
                        $pText = ($idx === 0) ? 'cukup baik' : 'baik';
                        $dText = trim($kk->deskripsi ?? '');
                        if (!empty($dText)) {
                            $narrativeParts[] = $pText . ' dalam ' . $dText;
                        }
                    }
                    if (count($narrativeParts) === 1) {
                        $kokurikulerKemenag = 'Siswa ' . $narrativeParts[0];
                    } elseif (count($narrativeParts) === 2) {
                        $kokurikulerKemenag = 'Siswa ' . $narrativeParts[0] . ' dan ' . $narrativeParts[1];
                    } elseif (count($narrativeParts) > 2) {
                        $lastPart = array_pop($narrativeParts);
                        $kokurikulerKemenag = 'Siswa ' . implode(', ', $narrativeParts) . ' dan ' . $lastPart;
                    }
                }
            }
        }

        // Fallback default standar RDM Kemenag bila belum ada input sama sekali
        if (empty($kokurikulerKemenag)) {
            $kokurikulerKemenag = 'Siswa cukup baik dalam Menganalisis interaksi antar komponen ekosisitem dan pengaruhnya terhadap keseimbangan ekosistem ( mata pelajaran IPA) sebagai wujud lingkungan, baik dalam Mempresentasikan gagasan sebagai solusi pemecahan masalah secara kritis dan kreatif berlandasakan al-quran Hadits ( mata pelajaran Bahasa Indonesia dan Al-quran Hadits) dan baik dalam Memahami alam semesta sebagai manifestasi cinta dan kebesaran Allah sehingga tumbuh rasa hormat dan kasih sayang terhadap lingkungan';
        }

        // 5. Ekstra
        $ekstra = $this->db->table('rapor_kurmer_ekstra')
            ->where('id_siswa', $id_siswa)
            ->where('id_kelas', $id_kelas)
            ->where('id_tp', $id_tp)
            ->where('id_smt', $id_smt)
            ->get()->getResult();

        // 6. Prestasi
        $prestasi = $this->db->table('rapor_kurmer_prestasi')
            ->where('id_siswa', $id_siswa)
            ->where('id_kelas', $id_kelas)
            ->where('id_tp', $id_tp)
            ->where('id_smt', $id_smt)
            ->get()->getResult();

        // 7. Kehadiran
        $kehadiran = $this->db->table('rapor_kurmer_kehadiran')
            ->where('id_siswa', $id_siswa)
            ->where('id_kelas', $id_kelas)
            ->where('id_tp', $id_tp)
            ->where('id_smt', $id_smt)
            ->get()->getRow();

        // 8. Wali Kelas & Kepsek
        $kelas = $this->db->table('master_kelas')->where('id_kelas', $id_kelas)->get()->getRow();
        $wali = null;
        $guru_id = !empty($kelas->guru_id) ? $kelas->guru_id : 0;

        if (!$guru_id) {
            // Cek jabatan_guru dengan id_kelas, id_tp, id_smt
            $jabWali = $this->db->table('jabatan_guru')
                ->where('id_kelas', $id_kelas)
                ->where('id_tp', $id_tp)
                ->where('id_smt', $id_smt)
                ->get()->getRow();
            if ($jabWali && !empty($jabWali->id_guru)) {
                $guru_id = $jabWali->id_guru;
            } else {
                // Fallback: jabatan_guru untuk id_kelas ini
                $jabAny = $this->db->table('jabatan_guru')
                    ->where('id_kelas', $id_kelas)
                    ->get()->getRow();
                if ($jabAny && !empty($jabAny->id_guru)) {
                    $guru_id = $jabAny->id_guru;
                }
            }
        }

        if ($guru_id) {
            $wali = $this->db->table('master_guru')->where('id_guru', $guru_id)->get()->getRow();
        }

        // Jika masih belum ketemu, fallback ke Asrofiq
        if (!$wali) {
            $wali = $this->db->table('master_guru')->like('nama_guru', 'asrofiq')->get()->getRow();
        }

        $sekolah = $this->db->table('setting')->get()->getRow();

        $schInfo = detectSchoolType($sekolah);
        $satuanNama = $schInfo->satuan_nama;
        $isKemenag = $schInfo->is_kemenag;
        $schoolType = $schInfo->school_type;
        $isSd = $schInfo->is_sd ? 1 : 0;
        if ($sekolah) {
            $sekolah->satuan_nama = $satuanNama;
            $sekolah->tipe_sekolah = $schoolType;
            $sekolah->is_kemenag = $isKemenag ? 1 : 0;
            $sekolah->is_sd = $isSd;
        }

        return [
            'siswa' => $siswa,
            'setting' => $setting,
            'sekolah' => $sekolah,
            'kelas' => $kelas,
            'wali' => $wali,
            'nilai' => $nilaiRows,
            'p5' => $p5,
            'kokurikuler' => $kokurikulerKemenag,
            'kokurikuler_diknas' => $kokurikulerDiknas,
            'kokurikuler_kemenag' => $kokurikulerKemenag,
            'ekstra' => $ekstra,
            'prestasi' => $prestasi,
            'kehadiran' => $kehadiran,
            'naik' => $isNaik,
            'school_type' => $schoolType,
            'is_kemenag' => $isKemenag,
            'is_sd' => $isSd,
            'rekap_semester' => $this->getRekapNilaiMultiSemester($id_siswa)
        ];
    }

    /**
     * Dapatkan daftar mapel yang relevan untuk rapor suatu kelas (hanya yang diujikan / diajarkan)
     */
    public function getMapelRaporKelas($id_kelas, $id_tp, $id_smt)
    {
        $setting = $this->getSetting($id_tp, $id_smt);
        $mode = $setting->mode_mapel_rapor ?? 'otomatis';
        $configMapel = !empty($setting->mapel_rapor) ? (is_array($setting->mapel_rapor) ? $setting->mapel_rapor : json_decode($setting->mapel_rapor, true)) : [];

        $kelas = $this->db->table('master_kelas')->where('id_kelas', $id_kelas)->get()->getRow();
        $level_id = $kelas->level_id ?? null;

        $mapelIds = [];

        // 1. Prioritas Utama: Konfigurasi mapel khusus per kelas jika diset
        if (!empty($configMapel['mapel_per_kelas'][$id_kelas])) {
            $mapelIds = array_map('intval', (array)$configMapel['mapel_per_kelas'][$id_kelas]);
        } 
        // 2. Checklist aktif pilihan admin (baik mode kustom maupun otomatis)
        // Mapel yang dicentang admin (termasuk mapel ujian kertas/manual seperti Aqidatul Awwam, Mulok, dll.)
        // HARUS SELALU ditampilkan di rapor dan tidak boleh dihilangkan!
        elseif (!empty($configMapel['active_mapels'])) {
            $mapelIds = array_map('intval', (array)$configMapel['active_mapels']);

            // Jika mode otomatis dipilih oleh admin, sertakan juga mapel yang memiliki nilai tersimpan di kelas ini
            if ($mode === 'otomatis') {
                $qJadwal = $this->db->table('cbt_jadwal j')
                    ->select('b.bank_mapel_id, b.bank_kelas')
                    ->join('cbt_bank_soal b', 'j.id_bank = b.id_bank')
                    ->where('j.id_tp', $id_tp)
                    ->where('j.id_smt', $id_smt)
                    ->get()->getResult();

                $fromJadwal = [];
                foreach ($qJadwal as $qj) {
                    $bkls = !empty($qj->bank_kelas) ? (is_array($qj->bank_kelas) ? $qj->bank_kelas : @unserialize($qj->bank_kelas)) : [];
                    if (!$bkls && !empty($qj->bank_kelas)) $bkls = json_decode($qj->bank_kelas, true) ?: [];
                    $covers = false;
                    if (is_array($bkls)) {
                        foreach ($bkls as $bk) {
                            $bkId = is_array($bk) ? ($bk['kelas_id'] ?? $bk[0] ?? null) : (is_object($bk) ? ($bk->kelas_id ?? null) : $bk);
                            if ($bkId !== null && (string)$bkId === (string)$id_kelas) {
                                $covers = true;
                                break;
                            }
                        }
                    }
                    if ($covers && !empty($qj->bank_mapel_id)) {
                        $fromJadwal[] = (int)$qj->bank_mapel_id;
                    }
                }

                $fromNilai = array_column($this->db->table('rapor_kurmer_nilai')
                    ->select('id_mapel')
                    ->where('id_tp', $id_tp)
                    ->where('id_smt', $id_smt)
                    ->where('id_kelas', $id_kelas)
                    ->groupBy('id_mapel')
                    ->get()->getResultArray(), 'id_mapel');

                $extraIds = array_unique(array_filter(array_merge($fromJadwal, $fromNilai)));
                if (!empty($extraIds)) {
                    $mapelIds = array_values(array_unique(array_merge($mapelIds, array_map('intval', $extraIds))));
                }
            }
        } 
        // 3. Fallback jika admin belum pernah mengatur checklist mapel rapor
        else {
            // Mode OTOMATIS: sesuaikan dengan mapel yang diujikan / diajarkan di kelas ini
            $detectedIds = [];

            // A. Dari cbt_jadwal (ujian yang terjadwal khusus kelas ini)
            $qJadwal = $this->db->table('cbt_jadwal j')
                ->select('b.bank_mapel_id, b.bank_kelas')
                ->join('cbt_bank_soal b', 'j.id_bank = b.id_bank')
                ->where('j.id_tp', $id_tp)
                ->where('j.id_smt', $id_smt)
                ->get()->getResult();

            $fromJadwal = [];
            foreach ($qJadwal as $qj) {
                $bkls = !empty($qj->bank_kelas) ? (is_array($qj->bank_kelas) ? $qj->bank_kelas : @unserialize($qj->bank_kelas)) : [];
                if (!$bkls && !empty($qj->bank_kelas)) $bkls = json_decode($qj->bank_kelas, true) ?: [];
                $covers = false;
                if (is_array($bkls)) {
                    foreach ($bkls as $bk) {
                        $bkId = is_array($bk) ? ($bk['kelas_id'] ?? $bk[0] ?? null) : (is_object($bk) ? ($bk->kelas_id ?? null) : $bk);
                        if ($bkId !== null && (string)$bkId === (string)$id_kelas) {
                            $covers = true;
                            break;
                        }
                    }
                }
                if ($covers && !empty($qj->bank_mapel_id)) {
                    $fromJadwal[] = (int)$qj->bank_mapel_id;
                }
            }

            // B. Dari guru pengampu (jabatan_guru)
            $fromGuru = [];
            $jabs = $this->db->table('jabatan_guru')
                ->where('id_tp', $id_tp)
                ->where('id_smt', $id_smt)
                ->where('mapel_kelas IS NOT NULL')
                ->get()->getResult();
            foreach ($jabs as $jab) {
                $mk = !empty($jab->mapel_kelas) ? (is_array($jab->mapel_kelas) ? $jab->mapel_kelas : @unserialize($jab->mapel_kelas)) : [];
                if (is_array($mk)) {
                    foreach ($mk as $m) {
                        $idM = is_object($m) ? ($m->id_mapel ?? null) : ($m['id_mapel'] ?? null);
                        $km = is_object($m) ? ($m->kelas_mapel ?? []) : ($m['kelas_mapel'] ?? []);
                        if ($idM && is_array($km)) {
                            foreach ($km as $k) {
                                $kId = is_object($k) ? ($k->kelas ?? null) : ($k['kelas'] ?? null);
                                if ($kId == $id_kelas) {
                                    $fromGuru[] = $idM;
                                }
                            }
                        }
                    }
                }
            }

            // C. Dari nilai yang sudah tercatat di rapor_kurmer_nilai
            $fromNilai = array_column($this->db->table('rapor_kurmer_nilai')
                ->select('id_mapel')
                ->where('id_tp', $id_tp)
                ->where('id_smt', $id_smt)
                ->where('id_kelas', $id_kelas)
                ->groupBy('id_mapel')
                ->get()->getResultArray(), 'id_mapel');

            // Prioritaskan mapel yang benar-benar diujikan / ada nilai di kelas ini
            $ujianIds = array_unique(array_filter(array_merge($fromJadwal, $fromNilai)));
            if (!empty($ujianIds)) {
                $detectedIds = $ujianIds;
            } else {
                $detectedIds = array_unique(array_filter(array_merge($fromGuru, $fromNilai)));
            }

            $mapelIds = array_values(array_map('intval', $detectedIds));

            // Fallback: Jika belum ada jadwal ujian atau nilai sama sekali untuk kelas ini,
            // ambil hanya mapel aktif jenjang MTs / SMP (jenjang != 3), buang mapel SMA/MA!
            if (empty($mapelIds)) {
                $qMts = $this->db->table('master_mapel')
                    ->select('id_mapel')
                    ->where('status', '1')
                    ->where('jenjang !=', 3)
                    ->get()->getResultArray();
                $mapelIds = array_map('intval', array_column($qMts, 'id_mapel'));
            }
        }

        if (empty($mapelIds)) {
            return [];
        }

        // Ambil detail mapel dari master_mapel (pastikan m.kode terpilih bersama kode_mapel)
        $mapels = $this->db->table('master_mapel m')
            ->select('m.id_mapel, m.nama_mapel, m.kode, m.kode as kode_mapel, m.urutan_tampil, m.kelompok, m.jenjang,
                      km.kode_kel_mapel, km.nama_kel_mapel, km.kategori')
            ->join('master_kelompok_mapel km', 'm.kelompok=km.kode_kel_mapel OR m.kelompok=km.id_kel_mapel', 'left')
            ->whereIn('m.id_mapel', $mapelIds)
            ->orderBy('m.urutan_tampil', 'ASC')
            ->orderBy('m.id_mapel', 'ASC')
            ->get()->getResult();

        // Terapkan revisi nama & urutan dari pengaturan admin jika ada
        if (!empty($configMapel['custom_names']) || !empty($configMapel['custom_order'])) {
            foreach ($mapels as &$m) {
                if (!empty($configMapel['custom_names'][$m->id_mapel])) {
                    $m->nama_mapel = $configMapel['custom_names'][$m->id_mapel];
                }
                if (isset($configMapel['custom_order'][$m->id_mapel])) {
                    $m->urutan_tampil = (int)$configMapel['custom_order'][$m->id_mapel];
                }
            }
            usort($mapels, function ($a, $b) {
                return ($a->urutan_tampil <=> $b->urutan_tampil);
            });
        }

        return $mapels;
    }

    /**
     * Dapatkan semua mapel dan status keterkaitannya dengan ujian/rapor untuk halaman admin
     */
    public function getAllMapelStatusRapor($id_kelas = null, $id_tp = null, $id_smt = null)
    {
        if (!$id_tp) $id_tp = $this->db->table('master_tp')->where('active', 1)->get()->getRow()->id_tp ?? 1;
        if (!$id_smt) $id_smt = $this->db->table('master_smt')->where('active', 1)->get()->getRow()->id_smt ?? 1;

        $setting = $this->getSetting($id_tp, $id_smt);
        $configMapel = !empty($setting->mapel_rapor) ? (is_array($setting->mapel_rapor) ? $setting->mapel_rapor : json_decode($setting->mapel_rapor, true)) : [];
        $activeMapelIds = $configMapel['active_mapels'] ?? [];

        // 1. Mapel dari cbt_jadwal
        $fromJadwal = array_column($this->db->table('cbt_jadwal j')
            ->select('b.bank_mapel_id')
            ->join('cbt_bank_soal b', 'j.id_bank = b.id_bank')
            ->where('j.id_tp', $id_tp)
            ->where('j.id_smt', $id_smt)
            ->groupBy('b.bank_mapel_id')
            ->get()->getResultArray(), 'bank_mapel_id');

        // 2. Mapel dari cbt_bank_soal
        $fromBank = array_column($this->db->table('cbt_bank_soal')
            ->select('bank_mapel_id')
            ->where('id_tp', $id_tp)
            ->where('id_smt', $id_smt)
            ->groupBy('bank_mapel_id')
            ->get()->getResultArray(), 'bank_mapel_id');

        // 3. Mapel dari jabatan_guru
        $fromGuru = [];
        $jabs = $this->db->table('jabatan_guru')
            ->where('id_tp', $id_tp)
            ->where('id_smt', $id_smt)
            ->where('mapel_kelas IS NOT NULL')
            ->get()->getResult();
        foreach ($jabs as $jab) {
            $mk = !empty($jab->mapel_kelas) ? (is_array($jab->mapel_kelas) ? $jab->mapel_kelas : @unserialize($jab->mapel_kelas)) : [];
            if (is_array($mk)) {
                foreach ($mk as $m) {
                    $idM = is_object($m) ? ($m->id_mapel ?? null) : ($m['id_mapel'] ?? null);
                    if ($idM) $fromGuru[] = $idM;
                }
            }
        }

        // 4. Mapel dari nilai rapor
        $fromNilai = array_column($this->db->table('rapor_kurmer_nilai')
            ->select('id_mapel')
            ->where('id_tp', $id_tp)
            ->where('id_smt', $id_smt)
            ->groupBy('id_mapel')
            ->get()->getResultArray(), 'id_mapel');

        $ujianMapels = array_unique(array_filter(array_merge($fromJadwal, $fromBank)));
        $guruMapels = array_unique(array_filter($fromGuru));
        $nilaiMapels = array_unique(array_filter($fromNilai));

        $allMapels = $this->db->table('master_mapel m')
            ->select('m.*, km.kode_kel_mapel, km.nama_kel_mapel, km.kategori')
            ->join('master_kelompok_mapel km', 'm.kelompok=km.kode_kel_mapel OR m.kelompok=km.id_kel_mapel', 'left')
            ->orderBy('m.urutan_tampil', 'ASC')
            ->orderBy('m.id_mapel', 'ASC')
            ->get()->getResult();

        $result = [];
        foreach ($allMapels as $m) {
            $id = $m->id_mapel;
            $isUjian = in_array($id, $ujianMapels);
            $isDiajarkan = in_array($id, $guruMapels);
            $hasNilai = in_array($id, $nilaiMapels);

            // Tentukan status aktif di rapor
            if (!empty($activeMapelIds)) {
                $isActiveRapor = in_array($id, $activeMapelIds);
            } else {
                // Default: aktif jika jenjang MTs (bukan jenjang 3 MA) dan status aktif di master
                $isActiveRapor = ($m->status == 1 && $m->jenjang != 3);
            }

            $revisiNama = $configMapel['custom_names'][$id] ?? $m->nama_mapel;
            $revisiUrutan = $configMapel['custom_order'][$id] ?? $m->urutan_tampil;

            $result[] = (object)[
                'id_mapel' => $id,
                'nama_mapel' => $m->nama_mapel,
                'kode' => $m->kode,
                'kelompok' => $m->kelompok,
                'nama_kel_mapel' => $m->nama_kel_mapel,
                'kategori' => $m->kategori,
                'jenjang' => $m->jenjang,
                'urutan_tampil' => $m->urutan_tampil,
                'status_master' => $m->status,
                'is_diujikan' => $isUjian,
                'is_diajarkan' => $isDiajarkan,
                'has_nilai' => $hasNilai,
                'is_active_rapor' => $isActiveRapor,
                'revisi_nama' => $revisiNama,
                'revisi_urutan' => $revisiUrutan
            ];
        }

        return [
            'mode_mapel_rapor' => $setting->mode_mapel_rapor ?? 'otomatis',
            'mapel_list' => $result
        ];
    }

    /**
     * Simpan konfigurasi revisi mapel rapor dari admin
     */
    public function saveMapelRaporConfig($data, $id_tp, $id_smt)
    {
        $setting = $this->getSetting($id_tp, $id_smt);
        $currConfig = !empty($setting->mapel_rapor) ? (is_array($setting->mapel_rapor) ? $setting->mapel_rapor : json_decode($setting->mapel_rapor, true)) : [];

        $newConfig = array_merge($currConfig, $data);
        $update = [
            'mapel_rapor' => json_encode($newConfig),
            'mode_mapel_rapor' => $data['mode'] ?? ($setting->mode_mapel_rapor ?? 'otomatis'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        return $this->db->table('rapor_kurmer_setting')
            ->where('id_tp', $id_tp)
            ->where('id_smt', $id_smt)
            ->update($update);
    }

    /**
     * Sinkronkan otomatis checklist mapel rapor dengan mapel yang diujikan di semester ini
     */
    public function syncMapelUjianToRapor($id_tp, $id_smt, $id_kelas = null)
    {
        $fromJadwal = array_column($this->db->table('cbt_jadwal j')
            ->select('b.bank_mapel_id')
            ->join('cbt_bank_soal b', 'j.id_bank = b.id_bank')
            ->where('j.id_tp', $id_tp)
            ->where('j.id_smt', $id_smt)
            ->groupBy('b.bank_mapel_id')
            ->get()->getResultArray(), 'bank_mapel_id');

        $fromBank = array_column($this->db->table('cbt_bank_soal')
            ->select('bank_mapel_id')
            ->where('id_tp', $id_tp)
            ->where('id_smt', $id_smt)
            ->groupBy('bank_mapel_id')
            ->get()->getResultArray(), 'bank_mapel_id');

        $fromGuru = [];
        $jabs = $this->db->table('jabatan_guru')
            ->where('id_tp', $id_tp)
            ->where('id_smt', $id_smt)
            ->where('mapel_kelas IS NOT NULL')
            ->get()->getResult();
        foreach ($jabs as $jab) {
            $mk = !empty($jab->mapel_kelas) ? (is_array($jab->mapel_kelas) ? $jab->mapel_kelas : @unserialize($jab->mapel_kelas)) : [];
            if (is_array($mk)) {
                foreach ($mk as $m) {
                    $idM = is_object($m) ? ($m->id_mapel ?? null) : ($m['id_mapel'] ?? null);
                    if ($idM) $fromGuru[] = $idM;
                }
            }
        }

        $fromNilai = array_column($this->db->table('rapor_kurmer_nilai')
            ->select('id_mapel')
            ->where('id_tp', $id_tp)
            ->where('id_smt', $id_smt)
            ->groupBy('id_mapel')
            ->get()->getResultArray(), 'id_mapel');

        $ujianIds = array_values(array_unique(array_filter(array_merge($fromJadwal, $fromBank, $fromNilai))));
        $activeIds = !empty($ujianIds) ? $ujianIds : array_values(array_unique(array_filter(array_merge($fromGuru, $fromNilai))));

        if (empty($activeIds)) {
            // Jika belum ada ujian aktif sama sekali, gunakan standar MTs
            return $this->resetStandarMtsToRapor($id_tp, $id_smt);
        }

        return $this->saveMapelRaporConfig([
            'mode' => 'otomatis',
            'active_mapels' => array_map('intval', $activeIds)
        ], $id_tp, $id_smt);
    }

    /**
     * Terapkan 15 mapel standar MTs Kemenag dan nonaktifkan mapel SMA/MA
     */
    public function resetStandarMtsToRapor($id_tp, $id_smt)
    {
        // 15 mapel standar MTs Kemenag:
        // PAI: 1 (QH), 3 (AA), 2 (FQH), 4 (SKI)
        // Umum A: 11 (PPKn), 6 (BIND), 5 (BAR), 8 (MTK), 9 (IPA), 10 (IPS), 7 (BING)
        // Kel B: 13 (SB), 12 (PJOK), 14 (PRA), 40 (MULOK)
        $standarMtsIds = [1, 3, 2, 4, 11, 6, 5, 8, 9, 10, 7, 13, 12, 14, 40];

        return $this->saveMapelRaporConfig([
            'mode' => 'otomatis',
            'active_mapels' => $standarMtsIds
        ], $id_tp, $id_smt);
    }
}

