<?php
namespace App\Models;

use CodeIgniter\Model;

class BannerModel extends Model
{
    protected $table = 'cbt_banner';
    protected $primaryKey = 'id_banner';
    protected $allowedFields = [
        'judul',
        'subjudul',
        'gambar',
        'url_link',
        'tombol_teks',
        'urutan',
        'status',
        'warna_bg',
        'created_at',
        'updated_at'
    ];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function __construct()
    {
        parent::__construct();
        $this->ensureTableExists();
    }

    /**
     * Pastikan tabel cbt_banner tersedia dan terisi data awal
     */
    public function ensureTableExists()
    {
        $db = \Config\Database::connect();
        if (!$db->tableExists($this->table)) {
            $forge = \Config\Database::forge();
            $forge->addField([
                'id_banner' => [
                    'type'           => 'INT',
                    'constraint'     => 11,
                    'unsigned'       => true,
                    'auto_increment' => true
                ],
                'judul' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 255
                ],
                'subjudul' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 255,
                    'null'       => true
                ],
                'gambar' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 255,
                    'null'       => true
                ],
                'url_link' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 255,
                    'null'       => true
                ],
                'tombol_teks' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 100,
                    'null'       => true,
                    'default'    => 'Lihat Detail'
                ],
                'urutan' => [
                    'type'       => 'INT',
                    'constraint' => 5,
                    'default'    => 1
                ],
                'status' => [
                    'type'       => 'TINYINT',
                    'constraint' => 1,
                    'default'    => 1
                ],
                'warna_bg' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 100,
                    'null'       => true,
                    'default'    => 'linear-gradient(135deg, #1e3c72 0%, #2a5298 100%)'
                ],
                'created_at' => [
                    'type' => 'DATETIME',
                    'null' => true
                ],
                'updated_at' => [
                    'type' => 'DATETIME',
                    'null' => true
                ],
            ]);
            $forge->addKey('id_banner', true);
            $forge->createTable($this->table, true);

            // Seed default initial banners
            $this->seedInitialBanners();
        } else {
            // Cek apakah tabel kosong
            $count = $db->table($this->table)->countAllResults();
            if ($count === 0) {
                $this->seedInitialBanners();
            }
        }
    }

    /**
     * Resolusi otomatis URL file APK sesuai domain sekolah dengan akhiran v.1.7.apk
     */
    public static function resolveSchoolApkLink(string $rawUrl = ''): string
    {
        $host = strtolower($_SERVER['HTTP_HOST'] ?? '');
        if (strpos($host, 'cbt.coffeepelangi') !== false || strpos($host, 'coffeepelangi.cloud') !== false) {
            return 'downloads/CBT-MADIN-ICT_v.1.7.apk';
        }
        if (strpos($host, 'ict') !== false || strpos($host, 'coffeepelangi') !== false) {
            return 'downloads/CBT_ICT_Tuban_v.1.7.apk';
        }
        if (strpos($host, 'sdn1puunokullo') !== false || strpos($host, 'puunokullo') !== false) {
            return 'downloads/CBT_SDN1_Puunokullo_v.1.7.apk';
        }
        if (!empty($rawUrl) && stripos($rawUrl, '.apk') !== false) {
            if (stripos($rawUrl, 'CBT_ICT_Tuban') !== false) {
                return 'downloads/CBT_ICT_Tuban_v.1.7.apk';
            }
            if (stripos($rawUrl, 'CBT_SDN1_Puunokullo') !== false) {
                return 'downloads/CBT_SDN1_Puunokullo_v.1.7.apk';
            }
            if (stripos($rawUrl, 'v.1.7.apk') === false) {
                return preg_replace('/(_v\.?\d+(\.\d+)*)?\.apk$/i', '_v.1.7.apk', $rawUrl);
            }
            return $rawUrl;
        }
        return 'downloads/CBT_Resmi_v.1.7.apk';
    }

    /**
     * Data starter default banner
     */
    public function seedInitialBanners()
    {
        $db = \Config\Database::connect();
        $defaults = [
            [
                'judul'       => 'Aplikasi Android CBT Resmi v.1.7 Telah Tersedia!',
                'subjudul'    => 'Download dan pasang APK v.1.7.APK ini di HP Anda untuk mengikuti ujian dengan aman dan nyaman tanpa kendala.',
                'gambar'      => null,
                'url_link'    => self::resolveSchoolApkLink('downloads/CBT_Resmi_v.1.7.apk'),
                'tombol_teks' => 'Download APK Siswa v.1.7.APK',
                'urutan'      => 1,
                'status'      => 1,
                'warna_bg'    => 'linear-gradient(135deg, #1e3c72 0%, #2a5298 100%)',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s')
            ],
            [
                'judul'       => 'E-Learning & Perpustakaan Digital Sekolah',
                'subjudul'    => 'Baca buku digital perpustakaan, materi ajar guru, dan kerjakan tugas interaktif secara langsung.',
                'gambar'      => null,
                'url_link'    => 'kbm/materi',
                'tombol_teks' => 'Buka Materi & Buku',
                'urutan'      => 2,
                'status'      => 1,
                'warna_bg'    => 'linear-gradient(135deg, #0d9488 0%, #065f46 100%)',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s')
            ],
            [
                'judul'       => 'Jadwal Pelajaran & Kalender Akademik',
                'subjudul'    => 'Pantau jadwal tatap muka kelas, alokasi waktu jam belajar, dan agenda ujian semester.',
                'gambar'      => null,
                'url_link'    => 'kbm/jadwal_pelajaran',
                'tombol_teks' => 'Lihat Jadwal Kelas',
                'urutan'      => 3,
                'status'      => 1,
                'warna_bg'    => 'linear-gradient(135deg, #7c3aed 0%, #4c1d95 100%)',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s')
            ]
        ];

        $db->table($this->table)->insertBatch($defaults);
    }

    /**
     * Ambil semua banner untuk admin (diurutkan berdasarkan urutan ASC)
     */
    public function getAllBanners()
    {
        return $this->orderBy('urutan', 'ASC')->orderBy('id_banner', 'DESC')->findAll();
    }

    /**
     * Ambil banner aktif untuk siswa (status = 1)
     */
    public function getActiveBanners()
    {
        $banners = $this->where('status', 1)
            ->orderBy('urutan', 'ASC')
            ->orderBy('id_banner', 'DESC')
            ->findAll();

        if (empty($banners)) {
            // Fallback starter banners
            return [
                (object)[
                    'id_banner'   => 1,
                    'judul'       => 'Aplikasi Android CBT Resmi v.1.7 Telah Tersedia!',
                    'subjudul'    => 'Download dan pasang APK v.1.7.APK ini di HP Anda untuk mengikuti ujian dengan aman dan nyaman tanpa kendala.',
                    'gambar'      => null,
                    'url_link'    => self::resolveSchoolApkLink('downloads/CBT_Resmi_v.1.7.apk'),
                    'tombol_teks' => 'Download APK Siswa v.1.7.APK',
                    'urutan'      => 1,
                    'status'      => 1,
                    'warna_bg'    => 'linear-gradient(135deg, #1e3c72 0%, #2a5298 100%)'
                ],
                (object)[
                    'id_banner'   => 2,
                    'judul'       => 'E-Learning & Perpustakaan Digital Sekolah',
                    'subjudul'    => 'Baca buku digital perpustakaan, materi ajar guru, dan kerjakan tugas interaktif secara langsung.',
                    'gambar'      => null,
                    'url_link'    => 'kbm/materi',
                    'tombol_teks' => 'Buka Materi & Buku',
                    'urutan'      => 2,
                    'status'      => 1,
                    'warna_bg'    => 'linear-gradient(135deg, #0d9488 0%, #065f46 100%)'
                ]
            ];
        }

        foreach ($banners as &$b) {
            $isArr = is_array($b);
            $urlLink  = $isArr ? ($b['url_link'] ?? '') : ($b->url_link ?? '');
            $judul    = $isArr ? ($b['judul'] ?? '') : ($b->judul ?? '');

            // Jika link masih kosong dan banner berkaitan dengan APK, berikan default link sekolah
            if (empty($urlLink) && (stripos($judul, 'apk') !== false || stripos($judul, 'android') !== false)) {
                $urlLink = self::resolveSchoolApkLink('');
                if ($isArr) {
                    $b['url_link'] = $urlLink;
                } else {
                    $b->url_link = $urlLink;
                }
            }
        }
        unset($b);

        return $banners;
    }
}
