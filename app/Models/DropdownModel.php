<?php

namespace App\Models;

use CodeIgniter\Model;

class DropdownModel extends Model
{
    protected $table = 'dummy_table';

    public function getBulan()
    {
        $result = $this->db->table('bulan')->get()->getResult();
        $ret = [];
        if ($result) {
            foreach ($result as $row) {
                $ret[$row->id_bln] = $row->nama_bln;
            }
        }
        return $ret;
    }

    public function getAllKodePeminatan()
    {
        return $this->db->table('master_kelompok_mapel')
            ->where('kategori !=', 'WAJIB')
            ->where('kategori !=', 'PAI (Kemenag)')
            ->where('kategori !=', 'MULOK')
            ->get()->getResult();
    }

    public function getMapelPeminatan($arr_kelompok)
    {
        if (count($arr_kelompok) > 0) {
            $result = $this->db->table('master_mapel')
                ->whereIn('kelompok', $arr_kelompok)
                ->orderBy('urutan_tampil')
                ->get()->getResult();

            $ret = [];
            if ($result) {
                foreach ($result as $row) {
                    $ret[$row->kelompok][$row->id_mapel] = $row->nama_mapel;
                }
            }
            return $ret;
        } else {
            return [];
        }
    }

    public function getDataKelompokMapel()
    {
        $result = $this->db->table('master_kelompok_mapel')
            ->orderBy('kode_kel_mapel')
            ->get()->getResult();

        $ret = [];
        if ($result) {
            foreach ($result as $row) {
                $ret[$row->kode_kel_mapel] = $row->nama_kel_mapel;
            }
        }
        return $ret;
    }

    public function getAllEkskul()
    {
        $result = $this->db->table('master_ekstra')->get()->getResult();
        $ret = [];
        if ($result) {
            foreach ($result as $row) {
                $ret[$row->id_ekstra] = $row->nama_ekstra;
            }
        }
        return $ret;
    }

    public function getAllGuru()
    {
        $result = $this->db->table('master_guru a')
            ->select('a.id_guru, a.nama_guru')
            ->join('users e', 'a.username=e.username', 'left')
            ->get()->getResult();
            
        $ret[''] = 'Pilih Guru :';
        if ($result) {
            foreach ($result as $row) {
                $ret[$row->id_guru] = $row->nama_guru;
            }
        }
        return $ret;
    }

    public static function extractKelasRank($name, $level = null)
    {
        $str = trim((string)$name);
        if ($str === '') {
            return (int)($level ?? 9999);
        }

        // Strip common prefixes like "Kelas ", "Kls ", "Rombel "
        $clean = preg_replace('/^(?:kelas|kls|rombel)\s+/i', '', $str);

        // Check if starts with a number (e.g., "1", "1A", "10 IPA 1")
        if (preg_match('/^([0-9]+)/', $clean, $m)) {
            return (int)$m[1];
        }

        // Check if starts with Roman numerals (e.g., "VII A", "X MIPA")
        if (preg_match('/^(XII|XI|X|IX|VIII|VII|VI|V|IV|III|II|I)\b/i', $clean, $m)) {
            $roman = strtoupper($m[1]);
            $romanMap = [
                'I' => 1, 'II' => 2, 'III' => 3, 'IV' => 4, 'V' => 5, 'VI' => 6,
                'VII' => 7, 'VIII' => 8, 'IX' => 9, 'X' => 10, 'XI' => 11, 'XII' => 12
            ];
            if (isset($romanMap[$roman])) {
                return $romanMap[$roman];
            }
        }

        // Fallback: if $level is numeric and > 0
        if ($level !== null && is_numeric($level) && (int)$level > 0) {
            return (int)$level;
        }

        return 9999;
    }

    public static function sortKelasCompare($namaA, $namaB, $levelA = null, $levelB = null)
    {
        $rankA = self::extractKelasRank($namaA, $levelA);
        $rankB = self::extractKelasRank($namaB, $levelB);

        if ($rankA !== $rankB) {
            return $rankA <=> $rankB;
        }

        return strnatcasecmp(trim((string)$namaA), trim((string)$namaB));
    }

    public function getAllKelas($tp, $smt, $level = null)
    {
        $builder = $this->db->table('master_kelas')
            ->select('id_kelas, nama_kelas, level_id')
            ->where('id_tp', $tp)
            ->where('id_smt', $smt);
            
        if ($level != null) {
            if (strpos($level, '!=') === 0) {
                $builder->where('level_id !=', substr($level, 2));
            } else {
                $builder->where('level_id', $level);
            }
        }

        $result = $builder->get()->getResult();
        $ret = [];
        if ($result) {
            foreach ($result as $row) {
                $expected = self::extractKelasRank($row->nama_kelas, $row->level_id ?? null);
                if ($expected > 0 && $expected < 9999 && isset($row->level_id) && (int)$row->level_id !== $expected) {
                    $this->db->table('master_kelas')->where('id_kelas', $row->id_kelas)->update(['level_id' => (string)$expected]);
                    $row->level_id = (string)$expected;
                }
            }

            usort($result, function ($a, $b) {
                return self::sortKelasCompare($a->nama_kelas, $b->nama_kelas, $a->level_id ?? null, $b->level_id ?? null);
            });

            foreach ($result as $row) {
                $ret[$row->id_kelas] = $row->nama_kelas;
            }
        }
        return $ret;
    }

    public function getAllRuang()
    {
        $result = $this->db->table('cbt_ruang')->get()->getResult();
        $ret = [];
        if ($result) {
            foreach ($result as $row) {
                $ret[$row->id_ruang] = $row->kode_ruang;
            }
        }
        return $ret;
    }

    public function getAllSesi()
    {
        $result = $this->db->table('cbt_sesi')->get()->getResult();
        $ret = [];
        if ($result) {
            foreach ($result as $row) {
                $ret[$row->id_sesi] = $row->nama_sesi;
            }
        }
        return $ret;
    }

    public function getAllLevel($jenjang)
    {
        $db = $this->db;
        $builder = $db->table('level_guru');

        if ($jenjang == '1') {
            $builder->where('level', '1');
            $builder->orWhere('level', '2');
            $builder->orWhere('level', '3');
            $builder->orWhere('level', '4');
            $builder->orWhere('level', '5');
            $builder->orWhere('level', '6');
        } elseif ($jenjang == '2') {
            $builder->where('level', '7');
            $builder->orWhere('level', '8');
            $builder->orWhere('level', '9');
        } elseif ($jenjang == '3') {
            $builder->where('level', '10');
            $builder->orWhere('level', '11');
            $builder->orWhere('level', '12');
        }

        $result = $builder->get()->getResult();
        $ret = ['0' => 'Semua Level'];
        if ($result) {
            foreach ($result as $row) {
                $ret[$row->id_level] = $row->level;
            }
        }
        return $ret;
    }

    public function getAllMapel()
    {
        $result = $this->db->table('master_mapel')
            ->where('status', '1')
            ->orderBy('urutan_tampil')
            ->get()->getResult();
            
        $ret = [];
        if ($result) {
            foreach ($result as $row) {
                $ret[$row->id_mapel] = $row->nama_mapel;
            }
        }
        return $ret;
    }

    public function getAllJadwal($tp, $smt)
    {
        $db = $this->db;
        $builder = $db->table('cbt_jadwal a');
        $builder->join('cbt_bank_soal b', 'b.id_bank=a.id_bank');
        $builder->where('a.id_tp', $tp);
        $builder->where('a.id_smt', $smt);

        $result = $builder->get()->getResult();
        $ret = [];
        if ($result) {
            foreach ($result as $row) {
                $ret[$row->id_jadwal] = $row->bank_kode;
            }
        }
        return $ret;
    }

    public function getAllJenisUjian()
    {
        $db = $this->db;
        $result = $db->table('cbt_jenis')->get()->getResult();
        $ret[''] = 'Pilih Jenis Ujian :';
        if ($result) {
            foreach ($result as $row) {
                $ret[$row->id_jenis] = !empty($row->nama_jenis) ? $row->nama_jenis : $row->kode_jenis;
            }
        }
        return $ret;
    }

    public function getAllKodeKelas($tp=null, $smt=null) {
        $builder = $this->db->table('master_kelas');
        $builder->select('*');
        if ($tp!=null) {
            $builder->where('id_tp', $tp);
        }
        if ($smt!=null) {
            $builder->where('id_smt', $smt);
        }
        $result = $builder->get()->getResult();
        $ret = [];
        if ($result) {
            foreach ($result as $row) {
                $ret[$row->id_kelas] = $row->kode_kelas;
            }
        }
        return $ret;
    }

public function getAllJadwalMapel($tp, $smt) {
        $builder = $this->db->table('cbt_jadwal a');
        $builder->select('a.id_jadwal, b.bank_kode, d.nama_mapel');
        
        $builder->join('cbt_bank_soal b', 'b.id_bank=a.id_bank');
        $builder->join('master_mapel d', 'd.id_mapel=b.bank_mapel_id');
        $builder->where('a.id_tp', $tp);
        $builder->where('a.id_smt', $smt);

        $result = $builder->get()->getResult();
        $ret = [];
        if ($result) {
            foreach ($result as $key => $row) {
                $ret [$row->id_jadwal] = $row->nama_mapel;
            }
        }
        return array_unique($ret);
    }

public function getAllMapelJadwal($tp, $smt) {
        $builder = $this->db->table('cbt_jadwal a');
        $builder->select('a.id_jadwal, b.bank_kode, d.id_mapel, d.nama_mapel');
        
        $builder->join('cbt_bank_soal b', 'b.id_bank=a.id_bank');
        $builder->join('master_mapel d', 'd.id_mapel=b.bank_mapel_id');
        $builder = $this->db->table('cbt_jadwal a');
        $builder->select('a.id_jadwal, b.bank_kode, d.id_mapel, d.nama_mapel');
        
        $builder->join('cbt_bank_soal b', 'b.id_bank=a.id_bank');
        $builder->join('master_mapel d', 'd.id_mapel=b.bank_mapel_id');
        $builder->where('a.id_tp', $tp);
        $builder->where('a.id_smt', $smt);

        $result = $builder->get()->getResult();
        $ret = [];
        if ($result) {
            foreach ($result as $key => $row) {
                $ret [$row->id_mapel] = $row->nama_mapel;
            }
        }
        return array_unique($ret);
    }

    public function getNamaKelasById($tp, $smt, $id) {
        $builder = $this->db->table('master_kelas');
        $builder->select('nama_kelas');
        $builder->where('id_kelas', $id);
        $builder->where('id_tp', $tp);
        $builder->where('id_smt', $smt);
        $result = $builder->get()->getRow();
        if ($result!=null) {
            return $result->nama_kelas;
        }
        return null;
    }

    public function getNamaKelasByArrId($tp, $smt, $ids) {
        $builder = $this->db->table('master_kelas');
        $builder->select('id_kelas,nama_kelas');
        $builder->where('id_tp', $tp);
        $builder->where('id_smt', $smt);
        if ($ids && count($ids) > 0) {
            $builder->whereIn('id_kelas', $ids);
        }
        $result = $builder->get()->getResult();
        $ret = [];
        if ($result) {
            foreach ($result as $row) {
                $ret[$row->id_kelas] = $row->nama_kelas;
            }
        }
        return $ret;
    }

    public function getAllJadwalGuru($tp, $smt, $guru = null) {
        $builder = $this->db->table('cbt_jadwal a');
        if (!empty($guru)) {
            $builder->join('cbt_bank_soal b', 'b.id_bank=a.id_bank AND b.bank_guru_id=' . $this->db->escape($guru));
        } else {
            $builder->join('cbt_bank_soal b', 'b.id_bank=a.id_bank');
        }
        $builder->where('a.id_tp', $tp);
        $builder->where('a.id_smt', $smt);
        $result = $builder->get()->getResult();
        $ret = [];
        if ($result) {
            foreach ($result as $key => $row) {
                $ret[$row->id_jadwal] = $row->bank_kode;
            }
        }
        return $ret;
    }

public function getAllLevelGuru() {
        $result = $this->db->table('level_guru')->get()->getResult();
        $ret [''] = 'Pilih Jabatan :';
        if ($result) {
            foreach ($result as $key => $row) {
                $ret [$row->id_level] = $row->level;
            }
        }
        return $ret;
    }

    public function getAllJurusan() {
        $result = $this->db->table('master_jurusan')->get()->getResult();
        $ret = [];
        if ($result) {
            foreach ($result as $row) {
                $ret[$row->id_jurusan] = $row->kode_jurusan;
            }
        }
        return $ret;
    }

    /**
     * Ambil kelas berdasarkan array id_kelas (digunakan di addBank untuk guru non-admin)
     */
    public function getAllKelasByArrayId($tp, $smt, $arrId)
    {
        if (empty($arrId)) return [];
        $result = $this->db->table('master_kelas')
            ->select('id_kelas, nama_kelas, kode_kelas, level_id')
            ->where('id_tp', $tp)
            ->where('id_smt', $smt)
            ->whereIn('id_kelas', $arrId)
            ->get()->getResult();

        $ret = [];
        if ($result) {
            usort($result, function ($a, $b) {
                return self::sortKelasCompare($a->nama_kelas, $b->nama_kelas, $a->level_id ?? null, $b->level_id ?? null);
            });

            foreach ($result as $row) {
                $ret[$row->id_kelas] = $row->nama_kelas;
            }
        }
        return $ret;
    }

    /**
     * Migrasi dari Kelas_model CI3::getGuruMapelKelas()
     * Ambil data guru beserta mapel_kelas berdasarkan id_guru tertentu.
     * Hanya join jabatan_guru untuk menghindari duplikasi baris.
     */
    public function getGuruMapelKelas($id_guru, $tp, $smt)
    {
        $result = $this->db->table('master_guru a')
            ->select('a.id_guru, a.nama_guru, a.kode_guru, b.mapel_kelas')
            ->join('jabatan_guru b', 'a.id_guru = b.id_guru AND b.id_tp = ' . (int)$tp . ' AND b.id_smt = ' . (int)$smt, 'left')
            ->where('a.id_guru', $id_guru)
            ->get()->getRow();
        return $result;
    }

    /**
     * Migrasi dari Kelas_model CI3::getMapelGuruKelas()
     * Ambil semua guru beserta mapel_kelas mereka (untuk filter guru by mapel).
     * Hanya join jabatan_guru, GROUP BY id_guru agar 1 guru = 1 baris.
     */
    public function getMapelGuruKelas($tp, $smt)
    {
        $result = $this->db->table('master_guru a')
            ->select('a.id_guru, ANY_VALUE(a.nama_guru) AS nama_guru, ANY_VALUE(a.kode_guru) AS kode_guru, ANY_VALUE(b.mapel_kelas) AS mapel_kelas')
            ->join('jabatan_guru b', 'a.id_guru = b.id_guru AND b.id_tp = ' . (int)$tp . ' AND b.id_smt = ' . (int)$smt, 'left')
            ->groupBy('a.id_guru')
            ->get()->getResult();
        return $result;
    }
}
