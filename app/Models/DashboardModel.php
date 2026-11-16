<?php

namespace App\Models;

use CodeIgniter\Model;

class DashboardModel extends Model
{
    protected $table = 'dummy_table';

    /**
     * Hapus cache setting, tahun, dan semester aktif
     */
    public static function clearStaticCache()
    {
        try {
            $cache = \Config\Services::cache();
            $cache->delete('app_setting_row');
            $cache->delete('app_tp_active_row');
            $cache->delete('app_smt_active_row');
        } catch (\Throwable $e) {}
    }

    public function ensureJadwalSettings()
    {
        try {
            $fields = $this->db->getFieldNames('setting');
            $forge = \Config\Database::forge();
            $fieldsToAdd = [];
            if (!in_array('fitur_jadwal', $fields)) {
                $fieldsToAdd['fitur_jadwal'] = [
                    'type' => 'VARCHAR',
                    'constraint' => '1',
                    'default' => '1',
                    'null' => true
                ];
            }
            if (!in_array('jadwal_di_materi', $fields)) {
                $fieldsToAdd['jadwal_di_materi'] = [
                    'type' => 'VARCHAR',
                    'constraint' => '1',
                    'default' => '1',
                    'null' => true
                ];
            }
            if (!in_array('hari_aktif', $fields)) {
                $fieldsToAdd['hari_aktif'] = [
                    'type' => 'VARCHAR',
                    'constraint' => '2',
                    'default' => '6',
                    'null' => true
                ];
            }
            if (!in_array('guru_bisa_jadwal', $fields)) {
                $fieldsToAdd['guru_bisa_jadwal'] = [
                    'type' => 'VARCHAR',
                    'constraint' => '1',
                    'default' => '0',
                    'null' => true
                ];
            }
            if (!empty($fieldsToAdd)) {
                $forge->addColumn('setting', $fieldsToAdd);
                self::clearStaticCache();
            }
        } catch (\Throwable $e) {}
    }

    public function getSetting()
    {
        $this->ensureJadwalSettings();
        return $this->db->table('setting')->get()->getRow();
    }

    public function total($table, $where = '')
    {
        $builder = $this->db->table($table);
        if ($where != '') {
            $builder->where($where);
        }
        return $builder->countAllResults();
    }

    public function getTahunActive()
    {
        return $this->db->table('master_tp')->where('active', 1)->get()->getRow();
    }

    public function getSemesterActive()
    {
        return $this->db->table('master_smt')->where('active', 1)->get()->getRow();
    }
    
    public function getTahun()
    {
        return $this->db->table('master_tp')->get()->getResult();
    }
    
    public function getSemester()
    {
        return $this->db->table('master_smt')->get()->getResult();
    }

    public function getTahunByTahun($tahun)
    {
        return $this->db->table('master_tp')->where('tahun', $tahun)->get()->getRow();
    }

    public function getTpBefore($tahun)
    {
        $thns = explode('/', $tahun);
        $thn_before = ($thns[0] - 1) . '/' . $thns[0];
        return $this->getTahunByTahun($thn_before);
    }

    public function totalWaliKelas($tp, $smt)
    {
        try {
            // Auto-sync jabatan_guru -> master_kelas.guru_id jika master_kelas.guru_id masih kosong
            $this->db->query("
                UPDATE master_kelas a
                INNER JOIN jabatan_guru f ON (f.id_jabatan = '4' AND f.id_kelas = a.id_kelas AND f.id_guru > 0)
                SET a.guru_id = f.id_guru
                WHERE a.id_tp = ? AND a.id_smt = ? AND (a.guru_id IS NULL OR a.guru_id = '' OR a.guru_id = '0')
            ", [$tp, $smt]);

            // Auto-sync master_kelas.guru_id -> jabatan_guru jika jabatan_guru.id_kelas masih kosong/0
            $this->db->query("
                UPDATE jabatan_guru f
                INNER JOIN master_kelas a ON (a.guru_id = f.id_guru AND a.id_tp = f.id_tp AND a.id_smt = f.id_smt)
                SET f.id_kelas = a.id_kelas, f.id_jabatan = '4'
                WHERE a.id_tp = ? AND a.id_smt = ? AND a.guru_id > 0 AND (f.id_kelas IS NULL OR f.id_kelas = 0)
            ", [$tp, $smt]);
        } catch (\Throwable $e) {}

        // Hitung jumlah riil wali kelas aktif di semester ini
        // Menggunakan sumber ganda (jabatan_guru & master_kelas) yang terikat pada rombel aktif
        $query = $this->db->query("
            SELECT COUNT(DISTINCT 
                CASE 
                    WHEN f.id_guru IS NOT NULL AND f.id_guru != '0' AND f.id_guru != '' THEN f.id_guru
                    WHEN a.guru_id IS NOT NULL AND a.guru_id != '0' AND a.guru_id != '' THEN a.guru_id
                    ELSE NULL 
                END
            ) as total
            FROM master_kelas a
            LEFT JOIN jabatan_guru f ON (f.id_jabatan = '4' AND f.id_kelas = a.id_kelas)
            WHERE a.id_tp = ? AND a.id_smt = ?
              AND (
                  (f.id_guru IS NOT NULL AND f.id_guru != '0' AND f.id_guru != '')
                  OR
                  (a.guru_id IS NOT NULL AND a.guru_id != '0' AND a.guru_id != '')
              )
        ", [$tp, $smt]);

        $row = $query ? $query->getRow() : null;
        return (int)($row->total ?? 0);
    }

    public function totalJadwal($tp, $smt)
    {
        return $this->db->table('cbt_jadwal')
            ->where('id_tp', $tp)
            ->where('id_smt', $smt)
            ->countAllResults();
    }

    public function getDataGuruByUserId($id_user, $id_tp, $id_smt)
    {
        $hasJabatanTambahan = $this->db->fieldExists('jabatan_tambahan', 'jabatan_guru');
        $colJabatanTambahan = $hasJabatanTambahan ? 'b.jabatan_tambahan, ' : "'' as jabatan_tambahan, ";

        $this->db->query('SET SQL_BIG_SELECTS=1');
        return $this->db->table('master_guru a')
            ->select('a.id_guru, a.nama_guru, a.nip, a.id_user, a.foto, b.id_jabatan, ' . $colJabatanTambahan . 'b.id_kelas as wali_kelas, f.level_id, g.level')
            ->join('jabatan_guru b', 'a.id_guru=b.id_guru AND b.id_tp=' . $id_tp . ' AND b.id_smt=' . $id_smt, 'left')
            ->join('level_guru e', 'b.id_jabatan=e.id_level', 'left')
            ->join('master_kelas f', 'b.id_kelas=f.id_kelas AND f.id_tp=' . $id_tp . ' AND f.id_smt=' . $id_smt, 'left')
            ->join('level_kelas g', 'f.level_id=g.id_level', 'left')
            ->where('a.id_user', $id_user)
            ->get()->getRow();
    }

    public function getAgamaSiswa() {
        $builder = $this->db->table('master_siswa a');
        $builder->select('agama');
        $builder->distinct();
        $builder->where('a.agama IS NOT NULL');
        $builder->where('a.agama != "0"');
        $builder->notLike('a.agama', 'Pilih');
        $result = $builder->get()->getResult();
        $ret['-'] = 'Bukan Mapel Agama';
        foreach ($result as $row) {
            $ret[$row->agama] = $row->agama;
        }
        return $ret;
    }

public function getDataGuruByUsername($username, $id_tp, $id_smt) {
        $builder = $this->db->table('master_guru a');
        $this->db->query('SET SQL_BIG_SELECTS=1');
        $hasJabatanTambahan = $this->db->fieldExists('jabatan_tambahan', 'jabatan_guru');
        $colJabatanTambahan = $hasJabatanTambahan ? 'b.jabatan_tambahan, ' : "'' as jabatan_tambahan, ";
        $builder->select('a.*, b.id_jabatan, ' . $colJabatanTambahan . 'b.id_kelas as wali_kelas, f.level_id, g.level');
        
        $builder->join('jabatan_guru b', 'a.id_guru=b.id_guru AND b.id_tp='.$id_tp.' AND b.id_smt='.$id_smt, 'left');
        $builder->join('level_guru e', 'b.id_jabatan=e.id_level', 'left');
        $builder->join('master_kelas f', 'b.id_kelas=f.id_kelas AND f.id_tp='.$id_tp.' AND f.id_smt='.$id_smt, 'left');
        $builder->join('level_kelas g', 'f.level_id=g.id_level', 'left');
        $builder->where('a.username', $username);
        return $builder->get()->getRow();
    }


    public function getDataSiswa($username, $id_tp, $id_smt) {
        $this->db->query('SET SQL_BIG_SELECTS=1');
        $builder = $this->db->table('master_siswa a');
        $builder->select('a.*, c.*, d.*');
        $builder->join('kelas_siswa b', 'a.id_siswa=b.id_siswa AND b.id_tp='.$id_tp.' AND b.id_smt='.$id_smt, 'left');
        $builder->join('master_kelas c', 'b.id_kelas=c.id_kelas AND c.id_tp='.$id_tp.' AND c.id_smt='.$id_smt, 'left');
        $builder->join('cbt_sesi_siswa d', 'a.id_siswa=d.siswa_id AND b.id_tp = d.tp_id AND b.id_smt = d.smt_id', 'left');
        $builder->where('username', $username);
        return $builder->get()->getRow();
    }

public function checkUsernameSiswa($username) {
        $builder = $this->db->table('master_siswa');
        $builder->select('id_siswa,username');
        
        $builder->where('username', $username);
        return $builder->get()->getResult();
    }

public function getDetailGuruByUserId($id_user, $id_tp, $id_smt) {
        $builder = $this->db->table('master_guru a');
        $this->db->query('SET SQL_BIG_SELECTS=1');
		$hasJabatanTambahan = $this->db->fieldExists('jabatan_tambahan', 'jabatan_guru');
        $colJabatanTambahan = $hasJabatanTambahan ? 'b.jabatan_tambahan, ' : "'' as jabatan_tambahan, ";
        $builder->select('a.*,b.id_jabatan, ' . $colJabatanTambahan . 'b.id_kelas, b.mapel_kelas, b.ekstra_kelas, b.id_tp, b.id_smt,'.
            'e.*, f.id_kelas, f.nama_kelas, f.kode_kelas, f.jurusan_id, f.level_id, f.guru_id, f.siswa_id, f.jumlah_siswa, f.set_siswa');
		
		$builder->join('jabatan_guru b', 'a.id_guru=b.id_guru AND b.id_tp='.$id_tp.' AND b.id_smt='.$id_smt, 'left');
		$builder->join('level_guru e', 'b.id_jabatan=e.id_level', 'left');
        $builder->join('master_kelas f', 'b.id_kelas=f.id_kelas AND f.id_tp='.$id_tp.' AND f.id_smt='.$id_smt, 'left');
		$builder->where('a.id_user', $id_user);
        return $builder->get()->getRow();
	}

public function getRunningText() {
        return $this->db->table('running_text')->get()->getResult();
    }


    public function getTahunById($id_tp)
    {
        return $this->db->table('master_tp')->where('id_tp', $id_tp)->get()->getRow();
    }

    public function getSemesterById($id_smt)
    {
        return $this->db->table('master_smt')->where('id_smt', $id_smt)->get()->getRow();
    }
}
