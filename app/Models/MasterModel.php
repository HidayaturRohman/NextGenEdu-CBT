<?php

namespace App\Models;

use CodeIgniter\Model;

class MasterModel extends Model
{
    protected $table = 'dummy_table';

    public function getTahunActive()
    {
        return (new DashboardModel())->getTahunActive();
    }

    public function getSemesterActive()
    {
        return (new DashboardModel())->getSemesterActive();
    }

    public function getAgamaSiswa()
    {
        return (new DashboardModel())->getAgamaSiswa();
    }

    public function getSiswaTotalPage($tp, $smt, $filter, $kelas=null, $search=null)
    {
        $builder = $this->db->table('master_siswa a');
        $builder->select('a.id_siswa, us.active');
        $builder->join('buku_induk u', 'u.id_siswa=a.id_siswa AND u.status="1"', 'left');

        if ($filter == "0") {
            $builder->join('kelas_siswa d', 'd.id_siswa=a.id_siswa AND d.id_tp = '.$this->db->escape($tp).' AND d.id_smt = '.$this->db->escape($smt), 'left');
            $builder->join('master_kelas f', 'f.id_kelas=d.id_kelas', 'left');
            $builder->join('users us', 'us.username=a.username', 'left');
        } elseif ($filter == "1") {
            $builder->join('kelas_siswa d', 'd.id_siswa=a.id_siswa AND d.id_tp = '.$this->db->escape($tp).' AND d.id_smt = '.$this->db->escape($smt), 'left');
            $builder->join('master_kelas f', 'f.id_kelas=d.id_kelas', 'left');
            $builder->join('users us', 'us.username=a.username AND us.active = "1"', 'left');
            $builder->where('(us.active = "1" OR us.active IS NULL)');
        } elseif ($filter == "3") {
            $builder->join('kelas_siswa d', 'd.id_siswa=a.id_siswa AND d.id_tp = '.$this->db->escape($tp).' AND d.id_smt = '.$this->db->escape($smt).' AND d.id_kelas = '.$this->db->escape($kelas));
            $builder->join('master_kelas f', 'f.id_kelas=d.id_kelas');
            $builder->join('users us', 'us.username=a.username AND us.active = "1"', 'left');
            $builder->where('(us.active = "1" OR us.active IS NULL)');
        } else {
            // Default: tampilkan SEMUA siswa (Semua status)
            $builder->join('kelas_siswa d', 'd.id_siswa=a.id_siswa AND d.id_tp = '.$this->db->escape($tp).' AND d.id_smt = '.$this->db->escape($smt), 'left');
            $builder->join('master_kelas f', 'f.id_kelas=d.id_kelas', 'left');
            $builder->join('users us', 'us.username=a.username', 'left');
        }

        if ($search != null) {
            $builder->groupStart()
                    ->like('a.nama', $search)
                    ->orLike('a.nis', $search)
                    ->orLike('a.nisn', $search)
                    ->groupEnd();
        }
        return $builder->countAllResults();
    }

    public function getSiswaPage($id_tp, $id_smt, $offset, $limit, $filter, $kelas, $search=null, $sort=null, $order=null) {
        $builder = $this->db->table('master_siswa a');
        $builder->select('a.id_siswa, a.foto, a.nama, a.nis, a.nisn, a.jenis_kelamin, a.username, a.password, d.id_kelas, a.agama, f.nama_kelas, us.active, u.status');
        $builder->join('buku_induk u', 'u.id_siswa=a.id_siswa AND u.status="1"', 'left');
        $builder->orderBy('LENGTH(a.nama), a.nama');
        $builder->limit($limit, $offset);

        if ($filter == "0") {
            $builder->join('kelas_siswa d', 'd.id_siswa=a.id_siswa AND d.id_tp = '.$this->db->escape($id_tp).' AND d.id_smt = '.$this->db->escape($id_smt), 'left');
            $builder->join('master_kelas f', 'f.id_kelas=d.id_kelas', 'left');
            $builder->join('users us', 'us.username=a.username', 'left');
        } elseif ($filter == "1") {
            $builder->join('kelas_siswa d', 'd.id_siswa=a.id_siswa AND d.id_tp = '.$this->db->escape($id_tp).' AND d.id_smt = '.$this->db->escape($id_smt), 'left');
            $builder->join('master_kelas f', 'f.id_kelas=d.id_kelas', 'left');
            $builder->join('users us', 'us.username=a.username AND us.active = "1"', 'left');
            $builder->where('(us.active = "1" OR us.active IS NULL)');
        } elseif ($filter == "3") {
            $builder->join('kelas_siswa d', 'd.id_siswa=a.id_siswa AND d.id_tp = '.$this->db->escape($id_tp).' AND d.id_smt = '.$this->db->escape($id_smt).' AND d.id_kelas = '.$this->db->escape($kelas));
            $builder->join('master_kelas f', 'f.id_kelas=d.id_kelas');
            $builder->join('users us', 'us.username=a.username AND us.active = "1"', 'left');
            $builder->where('(us.active = "1" OR us.active IS NULL)');
        } else {
            // Default: tampilkan SEMUA siswa (Semua status)
            $builder->join('kelas_siswa d', 'd.id_siswa=a.id_siswa AND d.id_tp = '.$this->db->escape($id_tp).' AND d.id_smt = '.$this->db->escape($id_smt), 'left');
            $builder->join('master_kelas f', 'f.id_kelas=d.id_kelas', 'left');
            $builder->join('users us', 'us.username=a.username', 'left');
        }

        if ($search != null) {
            $builder->groupStart()
                    ->like('a.nama', $search)
                    ->orLike('a.nis', $search)
                    ->orLike('a.nisn', $search)
                    ->groupEnd();
        }
        return $builder->get()->getResult();
    }

    public function getAllMapel($kel_mapel = null, $mapel_peminatan = null)
    {
        $builder = $this->db->table('master_mapel');

        if ($kel_mapel != null) {
            $builder->whereIn('kelompok', $kel_mapel);
        }

        $builder->where('status', '1');
        return $builder->get()->getResult();
    }

    public function getMapelById($id)
    {
        return $this->db->table('master_mapel')->where('id_mapel', $id)->get()->getRow();
    }

    public function getKodeKelompokMapel()
    {
        return $this->db->table('master_kelompok_mapel')->get()->getResult();
    }

    public function getKategoriKelompokMapel()
    {
        return $this->db->table('master_kelompok_mapel')
            ->select('kategori, kode_kel_mapel')
            ->groupBy('kategori, kode_kel_mapel')
            ->get()->getResult();
    }

    public function getDataJurusan()
    {
        return $this->db->table('master_jurusan')->get()->getResult();
    }

    public function getDataJurusanMapel($arrIds)
    {
        if (empty($arrIds) || $arrIds[0] == '') {
            return [];
        }

        $result = $this->db->table('master_mapel')
            ->select('id_mapel, nama_mapel')
            ->whereIn('id_mapel', $arrIds)
            ->get()->getResult();

        $ret = [];
        if ($result) {
            foreach ($result as $row) {
                $ret[$row->id_mapel] = $row->nama_mapel;
            }
        }
        return $ret;
    }

    public function getDataKelompokMapel()
    {
        $result = $this->db->table('master_kelompok_mapel')
            ->where('id_parent', '0')
            ->orderBy('kode_kel_mapel')
            ->get()->getResult();

        $ret = [];
        if ($result) {
            foreach ($result as $row) {
                $ret[$row->id_kel_mapel] = $row;
            }
        }
        return $ret;
    }

    public function getDataSubKelompokMapel()
    {
        $result = $this->db->table('master_kelompok_mapel')
            ->where('id_parent !=', '0')
            ->orderBy('kode_kel_mapel')
            ->get()->getResult();

        $ret = [];
        if ($result) {
            foreach ($result as $row) {
                $ret[$row->id_kel_mapel] = $row;
            }
        }
        return $ret;
    }

    public function getDataAgama()
    {
        return [
            ''          => 'Pilih Agama',
            'Islam'     => 'Islam',
            'Kristen'   => 'Kristen',
            'Katholik'  => 'Katholik',
            'Hindu'     => 'Hindu',
            'Budha'     => 'Budha',
            'Konghucu'  => 'Konghucu'
        ];
    }

    public function getAllDataGuru($tp, $smt) {
        $hasJabatanTambahan = $this->db->fieldExists('jabatan_tambahan', 'jabatan_guru');
        $colJabatanTambahan = $hasJabatanTambahan ? 'b.jabatan_tambahan, ' : "'' as jabatan_tambahan, ";

        $hasJenisNip = $this->db->fieldExists('jenis_nip', 'master_guru');
        $colJenisNip = $hasJenisNip ? 'a.jenis_nip, ' : "'' as jenis_nip, ";

        $builder = $this->db->table('master_guru a');
        $builder->select('a.id_guru, a.nama_guru, a.nip, ' . $colJenisNip . 'a.kode_guru, a.jenis_kelamin, a.foto, b.id_jabatan, ' . $colJabatanTambahan . 'b.id_kelas, b.mapel_kelas, b.ekstra_kelas, c.id_level, c.level, d.nama_kelas, e.tahun, f.nama_smt, g.active');
        $builder->join('jabatan_guru b', 'a.id_guru=b.id_guru AND b.id_tp='.$this->db->escape($tp).' AND b.id_smt='.$this->db->escape($smt), 'left');
        $builder->join('level_guru c', 'b.id_jabatan=c.id_level', 'left');
        $builder->join('master_kelas d', 'b.id_kelas=d.id_kelas AND d.id_tp='.$this->db->escape($tp).' AND d.id_smt='.$this->db->escape($smt), 'left');
        $builder->join('master_tp e', 'b.id_tp=e.id_tp', 'left');
        $builder->join('master_smt f', 'b.id_smt=f.id_smt', 'left');
        $builder->join('users g', 'a.username=g.username', 'left');
        $builder->orderBy('c.id_level', 'desc');
        $builder->orderBy('a.id_guru', 'asc');
        return $builder->get()->getResult();
    }

    public function check_data_by_id($tabel, $key, $val) {
        return $this->db->table($tabel)->where($key, $val)->countAllResults() > 0;
    }

    public function createData($table, $data, $batch = false) {
        if ($batch == false) {
            return $this->db->table($table)->insert($data);
        } else {
            return $this->db->table($table)->insertBatch($data);
        }
    }

    public function create($table, $data, $batch = false) {
        return $this->createData($table, $data, $batch);
    }

    public function updateData($table, $data, $pk, $id = null, $batch = false) {
        if ($batch == false) {
            return $this->db->table($table)->where($pk, $id)->update($data);
        } else {
            return $this->db->table($table)->updateBatch($data, $pk);
        }
    }

    public function deleteData($table, $data, $pk) {
        if (empty($data)) {
            return true;
        }
        if (!is_array($data)) {
            $data = [$data];
        }
        $this->db->query('SET FOREIGN_KEY_CHECKS=0');
        $deleted = $this->db->table($table)->whereIn($pk, $data)->delete();
        $this->db->query('SET FOREIGN_KEY_CHECKS=1');
        return $deleted ? true : false;
    }

    public function delete_not($table, $data, $pk, $col, $not) {
        return $this->db->table($table)->whereIn($pk, $data)->where($col . ' !=', $not)->delete();
    }

    public function getKelasById($id) {
        return $this->db->table('master_kelas')
            ->select('id_kelas, nama_kelas, level_id, jumlah_siswa')
            ->where('id_kelas', $id)
            ->orderBy('nama_kelas')
            ->get()->getRow();
    }

    public function getGuruByArrId($arr_id) {
        if (!is_array($arr_id)) {
            $arr_id = explode(',', (string)$arr_id);
        }
        $arr_id = array_filter(array_map('trim', $arr_id));
        if (empty($arr_id)) {
            return [];
        }
        $builder = $this->db->table('master_guru')
            ->select('id_guru, nama_guru, nip, jenis_nip')
            ->whereIn('id_guru', $arr_id);
        return $builder->get()->getResult();
    }

    public function getDetailJabatanGuru($id_guru) {
        $builder = $this->db->table('master_guru a');
        $this->db->query('SET SQL_BIG_SELECTS=1');
        $builder->select('a.id_guru, a.nama_guru, b.id_tp, b.id_smt, b.mapel_kelas, b.ekstra_kelas, c.id_level, c.level, d.id_kelas, d.nama_kelas');
        $builder->join('jabatan_guru b', 'a.id_guru=b.id_guru', 'left');
        $builder->join('level_guru c', 'b.id_jabatan=c.id_level', 'left');
        $builder->join('master_kelas d', 'b.id_kelas=d.id_kelas', 'left');
        $builder->where('a.id_guru', $id_guru);
        $result = $builder->get()->getResult();
        $ret = [];
        foreach ($result as $row) {
            $ret[$row->id_tp][$row->id_smt] = $row;
        }
        return $ret;
    }

    public function getJabatanGuru($id_guru, $tp, $smt) {
        $hasJabatanTambahan = $this->db->fieldExists('jabatan_tambahan', 'jabatan_guru');
        $colJabatanTambahan = $hasJabatanTambahan ? 'b.jabatan_tambahan, ' : "'' as jabatan_tambahan, ";

        $builder = $this->db->table('master_guru a');
        $this->db->query('SET SQL_BIG_SELECTS=1');
        $builder->select('a.id_guru, a.nama_guru, b.mapel_kelas, b.ekstra_kelas, ' . $colJabatanTambahan . 'c.id_level, c.level, d.id_kelas, d.nama_kelas');
        $builder->join('jabatan_guru b', 'a.id_guru=b.id_guru AND b.id_tp='.$tp.' AND b.id_smt='.$smt.'', 'left');
        $builder->join('level_guru c', 'b.id_jabatan=c.id_level', 'left');
        $builder->join('master_kelas d', 'b.id_kelas=d.id_kelas AND d.id_tp='.$tp.' AND d.id_smt='.$smt.'', 'left');
        $builder->where('a.id_guru', $id_guru);
        return $builder->get()->getRow();
    }

    public function getGuruMapel($tp, $smt, $ids_guru = null) {
        $builder = $this->db->table('jabatan_guru a');
        $builder->select('a.mapel_kelas, a.ekstra_kelas, a.id_jabatan, a.id_kelas, b.id_guru, b.nama_guru');
        $builder->join('master_guru b', 'a.id_guru=b.id_guru');
        $builder->where('a.id_tp', $tp);
        $builder->where('a.id_smt', $smt);
        if ($ids_guru) $builder->whereIn('a.id_guru', $ids_guru);
        return $builder->get()->getResult();
    }

    public function getSiswaById($id) {
        $builder = $this->db->table('master_siswa a');
        $builder->select('a.*, b.status');
        $builder->join('buku_induk b', 'a.id_siswa=b.id_siswa', 'left');
        $builder->where('a.id_siswa', $id);
        return $builder->get()->getRow();
    }

    public function getSiswaByArrId($ids) {
        $builder = $this->db->table('master_siswa a');
        $builder->select('a.id_siswa, f.nama_kelas');
        $builder->join('kelas_siswa b', 'b.id_siswa=a.id_siswa', 'left');
        $builder->join('master_kelas f', 'f.id_kelas=b.id_kelas');
        $builder->whereIn('a.id_siswa', $ids);
        $result = $builder->get()->getResult();
        $ret = [];
        if ($result) {
            foreach ($result as $row) {
                $ret[$row->id_siswa] = $row;
            }
        }
        return $ret;
    }

    public function getSiswaByKelas($id_tp, $id_smt, $id_kelas) {
        $builder = $this->db->table('kelas_siswa a');
        $builder->select('b.*');
        $builder->join('master_siswa b', 'b.id_siswa=a.id_siswa');
        $builder->where('a.id_tp', $id_tp);
        $builder->where('a.id_smt', $id_smt);
        $builder->where('a.id_siswa is NOT NULL', NULL, FALSE);
        $builder->where('b.id_siswa is NOT NULL', NULL, FALSE);
        $builder->where('a.id_kelas', $id_kelas);
        $builder->orderBy('b.nama', 'ASC');
        return $builder->get()->getResult();
    }

    public function getGuruById($id, $id_tp=null, $id_smt=null) {
        $hasJabatanTambahan = $this->db->fieldExists('jabatan_tambahan', 'jabatan_guru');
        $colJabatanTambahan = $hasJabatanTambahan ? 'b.jabatan_tambahan, ' : "'' as jabatan_tambahan, ";

        $builder = $this->db->table('master_guru a');
        $this->db->query('SET SQL_BIG_SELECTS=1');
        $select = 'a.*, b.id_jabatan, ' . $colJabatanTambahan . 'b.id_kelas, b.mapel_kelas, b.ekstra_kelas, c.*,';
        $builder->join('jabatan_guru b', 'a.id_guru=b.id_guru', 'left');
        $builder->join('level_guru c', 'b.id_jabatan=c.id_level', 'left');
        if ($id_tp != null && $id_smt != null) {
            $select .= ' d.*';
            $builder->join('master_kelas d', 'a.id_guru=d.guru_id AND d.id_tp='.$id_tp.' AND d.id_smt='.$id_smt, 'left');
        }
        $builder->select($select);
        $builder->where('a.id_guru', $id);
        return $builder->get()->getRow();
    }

    public function getAllKelas($tp = null, $smt = null) {
        $builder = $this->db->table('master_kelas a');
        $this->db->query('SET SQL_BIG_SELECTS=1');
        $builder->select('a.id_kelas, a.id_tp, a.id_smt, a.nama_kelas, a.kode_kelas, a.level_id, b.nama_jurusan, b.kode_jurusan, c.nama_guru');

        if ($tp != null && $smt != null) {
            $builder->where('a.id_tp', $tp)->where('a.id_smt', $smt);
        }
        $builder->join('jabatan_guru f', 'f.id_kelas=a.id_kelas', 'left');
        $builder->join('master_jurusan b', 'a.jurusan_id=b.id_jurusan', 'left');
        $builder->join('master_guru c', 'f.id_guru=c.id_guru', 'left');
        $result = $builder->get()->getResult();
        if ($result) {
            usort($result, function ($a, $b) {
                return \App\Models\DropdownModel::sortKelasCompare($a->nama_kelas, $b->nama_kelas, $a->level_id ?? null, $b->level_id ?? null);
            });
        }

        $ret = [];
        if ($tp != null && $smt != null) {
            if ($result) {
                foreach ($result as $row) {
                    $ret[$row->id_kelas] = $row;
                }
            }
        } else {
            if ($result) {
                foreach ($result as $row) {
                    $ret[$row->id_tp][$row->id_smt][$row->id_kelas] = $row;
                }
            }
        }
        return $ret;
    }

    public function getDistinctTahunLulus() {
        $result = $this->db->table('buku_induk')->select('tahun_lulus')->distinct()->get()->getResult();
        $ret = [];
        foreach ($result as $row) {
            if ($row->tahun_lulus != '') $ret[$row->tahun_lulus] = $row->tahun_lulus;
        }
        return $ret;
    }

    public function getDistinctKelasAkhir() {
        $result = $this->db->table('buku_induk')->select('kelas_akhir')->distinct()->get()->getResult();
        $ret = [];
        foreach ($result as $row) {
            if ($row->kelas_akhir != '') $ret[$row->kelas_akhir] = $row->kelas_akhir;
        }
        return $ret;
    }

    public function getAlumniByTahun($tahun, $kelas = null) {
        $builder = $this->db->table('buku_induk a')
            ->select('*')
            ->join('master_siswa b', 'a.id_siswa=b.id_siswa')
            ->where('a.tahun_lulus', $tahun);
        if ($kelas != null) $builder->where('a.kelas_akhir', $kelas);
        return $builder->get()->getResult();
    }

    public function getAlumniFilter($filter) {
        return $this->db->table('buku_induk a')
            ->select('*')
            ->join('master_siswa b', 'a.id_siswa=b.id_siswa')
            ->where('a.status', $filter)
            ->get()->getResult();
    }

    public function getAlumniById($id) {
        return $this->db->table('master_siswa a')
            ->select('*')
            ->join('buku_induk b', 'a.id_siswa=b.id_siswa')
            ->where('a.id_siswa', $id)
            ->get()->getRow();
    }

    public function getDataSiswaByKelas($id_tp, $id_smt, $id_kelas, $offset = 0, $limit = 0, $search=null, $sort=null, $order=null) {
        $builder = $this->db->table('kelas_siswa a');
        $builder->select('b.id_siswa, b.nama, b.nis, b.nisn, b.jenis_kelamin, b.username, b.password, b.foto, b.agama, b.hp, b.nama_ayah, b.nohp_ayah, b.nama_ibu, b.nohp_ibu, b.nama_wali, b.nohp_wali, f.nama_kelas, us.active');
        if ($limit > 0) {
            $builder->limit($limit, $offset);
        }
        $builder->join('master_siswa b', 'b.id_siswa=a.id_siswa', 'right');
        if ($search != null) {
            $builder->groupStart()
                    ->like('b.nama', $search)
                    ->orLike('b.nis', $search)
                    ->orLike('b.nisn', $search)
                    ->groupEnd();
        }
        $builder->join('master_kelas f', 'f.id_kelas=a.id_kelas');
        $builder->join('users us', 'us.username=b.username', 'left');
        $builder->where('a.id_tp', $id_tp);
        $builder->where('a.id_smt', $id_smt);
        $builder->where('a.id_kelas', $id_kelas);
        return $builder->get()->getResult();
    }

    public function getDataSiswaByKelasPage($id_tp, $id_smt, $id_kelas, $search=null) {
        $builder = $this->db->table('kelas_siswa a');
        $builder->select('a.id_siswa');
        $builder->where('a.id_tp', $id_tp);
        $builder->where('a.id_smt', $id_smt);
        $builder->where('a.id_kelas', $id_kelas);
        $builder->join('master_siswa b', 'b.id_siswa=a.id_siswa');
        if ($search != null) {
            $builder->groupStart()
                    ->like('b.nama', $search)
                    ->orLike('b.nis', $search)
                    ->orLike('b.nisn', $search)
                    ->groupEnd();
        }
        return $builder->countAllResults();
    }

    public function getAllJabatanGuru($id_guru)
    {
        return $this->db->table('jabatan_guru')->where('id_guru', $id_guru)->get()->getResult();
    }

    public function getSiswaKelasBaru($id_tp, $id_smt) {
        $this->db->query('SET SQL_BIG_SELECTS=1');
        $builder = $this->db->table('kelas_siswa a');
        $builder->select('b.id_siswa, b.nama, f.id_kelas, f.nama_kelas, f.kode_kelas');
        $builder->join('master_siswa b', 'b.id_siswa=a.id_siswa');
        $builder->join('master_kelas f', 'f.id_kelas=a.id_kelas');
        $builder->where('a.id_tp', $id_tp);
        $builder->where('a.id_smt', $id_smt);

        $result = $builder->get()->getResult();
        $ret = [];
        if ($result) {
            foreach ($result as $key => $row) {
                $ret [$row->id_siswa] = $row;
            }
        }
        return $ret;
    }

    public function getUserIdGuruByUsername($username) {
        return $this->db->table('master_guru')
            ->select('id_guru, username, id_user')
            ->where('username', $username)
            ->get()->getResult();
    }

}
