<?php

namespace App\Models;

use CodeIgniter\Model;

class KelasModel extends Model
{
    protected $table = 'master_kelas';

    public function getKelasSiswa($id_kelas, $id_tp = null, $id_smt = null)
    {
        $builder = $this->db->table('kelas_siswa a')
            ->select('a.*, b.nama, b.nis, b.nisn, b.username, b.jenis_kelamin, c.nama_kelas, c.level_id')
            ->join('master_siswa b', 'a.id_siswa=b.id_siswa')
            ->join('master_kelas c', 'a.id_kelas=c.id_kelas');

        if (is_array($id_kelas)) {
            $builder->whereIn("a.id_kelas", $id_kelas);
        } else {
            $builder->where("a.id_kelas", $id_kelas);
        }

        if ($id_tp != null) {
            $builder->where("a.id_tp", $id_tp);
            $builder->where("a.id_smt", $id_smt);
            $builder->orderBy('b.nama', 'ASC');
        }

        return $builder->get()->getResult();
    }


    public function getKelasEkskul($kelas, $tp, $smt)
    {
        return $this->db->table('kelas_ekstra')
            ->where("id_kelas", $kelas)
            ->where("id_tp", $tp)
            ->where("id_smt", $smt)
            ->get()->getResult();
    }

    public function getKelasList($tp, $smt) {
        $builder = $this->db->table('master_kelas a');
        $builder->select('a.*, b.nama_jurusan, d.nama_guru, e.nama, (SELECT COUNT(id_kelas_siswa) FROM kelas_siswa k WHERE a.id_kelas=k.id_kelas) AS jml_siswa');
        $builder->join('master_jurusan b', 'b.id_jurusan=a.jurusan_id', 'left');
        $builder->join('level_kelas c', 'c.id_level=a.level_id', 'left');
        $builder->join('jabatan_guru f', 'f.id_jabatan="4" AND f.id_kelas=a.id_kelas', 'left');
        $builder->join('master_guru d', 'd.id_guru=f.id_guru', 'left');
        $builder->join('master_siswa e', 'e.id_siswa=a.siswa_id', 'left');
        $builder->where('a.id_tp', $tp);
        $builder->where('a.id_smt', $smt);
        $result = $builder->get()->getResult();

        if ($result) {
            foreach ($result as $row) {
                $expected = \App\Models\DropdownModel::extractKelasRank($row->nama_kelas, $row->level_id ?? null);
                if ($expected > 0 && $expected < 9999 && isset($row->level_id) && (int)$row->level_id !== $expected) {
                    $this->db->table('master_kelas')->where('id_kelas', $row->id_kelas)->update(['level_id' => (string)$expected]);
                    $row->level_id = (string)$expected;
                }
            }

            usort($result, function ($a, $b) {
                return \App\Models\DropdownModel::sortKelasCompare($a->nama_kelas, $b->nama_kelas, $a->level_id ?? null, $b->level_id ?? null);
            });
        }
        return $result;
    }

    public function get_jurusan() {
        $result = $this->db->table('master_jurusan')->get()->getResult();
        $ret [''] = 'Pilih Jurusan :';
        if ($result) {
            foreach ($result as $row) {
                $ret [$row->id_jurusan] = $row->nama_jurusan;
            }
        }
        return $ret;
    }

    public function get_level() {
        $result = $this->db->table('level_kelas')->get()->getResult();
        $ret [''] = 'Pilih Level :';
        if ($result) {
            foreach ($result as $row) {
                $ret [$row->id_level] = $row->level;
            }
        }
        return $ret;
    }

    public function getLevel($jenjang) {
        $levels = [];
        if ($jenjang == "1") {
            $levels = ["" => "Pilih Level", "1" => "1", "2"=> "2", "3" => "3", "4"=>"4", "5"=>"5", "6"=>"6"];
        } elseif ($jenjang == "2") {
            $levels = ["" => "Pilih Level", "7" => "7", "8"=> "8", "9" => "9"];
        } elseif ($jenjang == "3") {
            $levels = ["" => "Pilih Level", "10" => "10", "11"=> "11", "12" => "12"];
        }
        return $levels;
    }

    public function get_guru() {
        $result = $this->db->table('master_guru')->get()->getResult();
        $ret [''] = 'Pilih Guru :';
        if ($result) {
            foreach ($result as $row) {
                $ret [$row->id_guru] = $row->nama_guru;
            }
        }
        return $ret;
    }

    public function getWaliKelas($tp, $smt) {
        $builder = $this->db->table('jabatan_guru a');
        $builder->select('a.id_guru, b.nama_guru');
        $builder->join('master_guru b', 'b.id_guru=a.id_guru', 'left');
        $builder->where('id_jabatan', '4')->where('id_tp', $tp)->where('id_smt', $smt);
        $result = $builder->get()->getResult();
        $ret [''] = 'Pilih Guru :';
        if ($result) {
            foreach ($result as $row) {
                $ret [$row->id_guru] = $row->nama_guru;
            }
        }
        return $ret;
    }

    public function getAllSiswa($tp, $smt) {
        $builder = $this->db->table('master_siswa a');
        $builder->select('a.id_siswa, a.nama, b.id_kelas, a.nis');
        $builder->join('kelas_siswa b', 'b.id_siswa=a.id_siswa AND b.id_tp='.$tp.' AND b.id_smt='.$smt, 'left');
        $builder->join('buku_induk c', 'c.id_siswa=a.id_siswa AND c.status="1"', 'left');
        $builder->orderBy('a.nama', 'ASC');
        return $builder->get()->getResult();
    }

    public function get_siswa_kelas($id, $tp, $smt) {
        $builder = $this->db->table('kelas_siswa a');
        $builder->select('a.id_siswa, a.id_kelas, b.nis, b.nama');
        $builder->join('master_siswa b', 'b.id_siswa=a.id_siswa');
        $builder->join('buku_induk i', 'i.id_siswa=a.id_siswa AND i.status="1"', 'left');
        if(is_array($id)){
            $builder->whereIn('a.id_kelas', $id);
        } else {
            $builder->where('a.id_kelas', $id);
        }
        $builder->where("a.id_tp", $tp);
        $builder->where("a.id_smt", $smt);
        $builder->orderBy('b.nama', 'ASC');
        return $builder->get()->getResult();
    }

    public function count_all() {
        return $this->db->table('master_kelas')->countAllResults();
    }

    public function get_one($id, $id_tp=null, $id_smt=null) {
        $builder = $this->db->table('master_kelas k');
        $builder->select('k.id_kelas, k.id_tp, k.id_smt, k.nama_kelas, k.kode_kelas, k.jurusan_id, k.level_id,'.
            ' k.guru_id, k.siswa_id, k.jumlah_siswa, k.set_siswa,'.
            ' j.id_jurusan, j.nama_jurusan, j.kode_jurusan,'.
            ' l.level, f.id_jabatan, f.mapel_kelas, f.ekstra_kelas,'.
            ' g.id_guru, g.nama_guru, si.nama as nama_siswa');
        $builder->join('master_jurusan j', 'j.id_jurusan=k.jurusan_id', 'left');
        $builder->join('level_kelas l', 'l.id_level=k.level_id', 'left');
        $builder->join('jabatan_guru f', 'f.id_kelas=k.id_kelas', 'left');
        $builder->join('master_guru g', 'g.id_guru=f.id_guru', 'left');
        $builder->join('master_siswa si', 'si.id_siswa=k.siswa_id', 'left');
        $builder->orderBy('nama_kelas', 'ASC');
        $builder->where('k.id_kelas', $id);
        if ($id_tp != null) $builder->where('k.id_tp', $id_tp);
        if ($id_smt != null) $builder->where('k.id_smt', $id_smt);
        return $builder->get()->getRow();
    }

    public function dummy() {
        return [
            'id_kelas' => '',
            'id_tp' => '',
            'id_smt' => '',
            'nama_kelas' => '',
            'kode_kelas' => '',
            'jurusan_id' => '',
            'level_id' => '',
            'guru_id' => '',
            'siswa_id' => '',
            'jumlah_siswa' => ''
        ];
    }


    public function getStrukturKelas($kelas){
        return $this->db->table('kelas_struktur')->where('id_kelas', $kelas)->get()->getRow();
    }

    public function dummyStruktur() {
        return (object)array(
            'id_kelas' => '',
            'kepsek' => '',
            'waka' => '',
            'wali' => '',
            'ketua' => '',
            'wakil_ketua' => '',
            'sekretaris_1' => '',
            'sekretaris_2' => '',
            'bendahara_1' => '',
            'bendahara_2' => '',
            'sie_ekstrakurikuler' => '',
            'sie_upacara' => '',
            'sie_olahraga' => '',
            'sie_keagamaan' => '',
            'sie_keamanan' => '',
            'sie_ketertiban' => '',
            'sie_kebersihan' => '',
            'sie_keindahan' => '',
            'sie_kesehatan' => '',
            'sie_kekeluargaan' => '',
            'sie_humas' => ''
        );
    }

public function getIdKelas($tp, $smt) {
        $this->db->select('id_kelas');
        $this->db->where('id_tp', $tp);
        $this->db->where('id_smt', $smt);
        $result = $this->db->table('master_kelas')->get()->getResult();

        $ret = [];
        if ($result) {
            foreach ($result as $key => $row) {
                $ret[] = $row->id_kelas;
            }
        }
        return $ret;
    }


public function getGuruMapelKelas($id_guru, $tp, $smt) {
        $builder = $this->db->table('master_guru a');
		$builder->select('a.id_guru, a.nama_guru, a.kode_guru, b.mapel_kelas, b.ekstra_kelas, d.nama_kelas');
		
		$builder->join('jabatan_guru b', 'a.id_guru=b.id_guru AND b.id_tp='.$tp.' AND b.id_smt='.$smt.'', 'left');
		$builder->join('level_guru c', 'b.id_jabatan=c.id_level', 'left');
		$builder->join('master_kelas d', 'b.id_kelas=d.id_kelas AND d.id_tp='.$tp.' AND d.id_smt='.$smt.'', 'left');
		$builder->where('a.id_guru', $id_guru);
        return $builder->get()->getRow();
	}

public function getNamaKelasByNama($id_tp, $id_smt) {
        $builder = $this->db->table('master_kelas');
        $builder->select('id_kelas, kode_kelas');
        
        $builder->where('id_tp', $id_tp);
        $builder->where('id_smt', $id_smt);
        $result = $builder->get()->getResult();
        $ret = [];
        if ($result) {
            foreach ($result as $row) {
                $ret [$row->kode_kelas] = $row->id_kelas;
            }
        }
        return $ret;
    }

    public function getAllKelas($id = null, $tp = null, $smt = null) {
        $builder = $this->db->table('master_kelas');
        if ($id !== null) {
            if (is_array($id)) {
                $builder->whereIn('id_kelas', $id);
            } else {
                $builder->where('id_kelas', $id);
            }
        }
        if ($tp !== null) {
            $builder->where('id_tp', $tp);
        }
        if ($smt !== null) {
            $builder->where('id_smt', $smt);
        }
        $result = $builder->get()->getResult();
        if ($result) {
            usort($result, function ($a, $b) {
                return \App\Models\DropdownModel::sortKelasCompare($a->nama_kelas, $b->nama_kelas, $a->level_id ?? null, $b->level_id ?? null);
            });
        }
        return $result;
    }

    public function getJurusanById($id) {
        return $this->db->table('master_jurusan')->where('id_jurusan', $id)->get()->getRow();
    }

    public function getEkskulById($id) {
        return $this->db->table('master_ekstra')->where('id_ekstra', $id)->get()->getRow();
    }

    public function getCatatanKelas($kelas, $id_tp, $id_smt) {
        $builder = $this->db->table('kelas_catatan_wali');
        $builder->where('id_kelas', $kelas);
        $builder->where('type', '1');
        $builder->where('id_tp', $id_tp);
        $builder->where('id_smt', $id_smt);
        return $builder->get()->getResult();
    }

    public function getCatatanSiswa($id_tp, $id_smt, $id_kelas) {
        $builder = $this->db->table('kelas_siswa a');
        $builder->select('b.id_siswa, b.nama, b.nis, b.nisn, b.foto, (SELECT COUNT(id_siswa) FROM kelas_catatan_wali c WHERE c.id_siswa = b.id_siswa AND c.type = \'2\') AS jml_catatan');
        $builder->join('master_siswa b', 'b.id_siswa=a.id_siswa');
        $builder->where('a.id_tp', $id_tp);
        $builder->where('a.id_smt', $id_smt);
        $builder->where('a.id_kelas', $id_kelas);
        return $builder->get()->getResult();
    }

    public function getAllCatatanSiswa($id_siswa, $id_tp, $id_smt) {
        $builder = $this->db->table('kelas_catatan_wali');
        $builder->where('id_siswa', $id_siswa);
        $builder->where('id_tp', $id_tp);
        $builder->where('id_smt', $id_smt);
        return $builder->get()->getResult();
    }

    public function getCatatanMapelKelas($kelas, $mapel, $id_tp, $id_smt){
        $builder = $this->db->table('kelas_catatan_mapel');
        $builder->where('id_kelas', $kelas);
        $builder->where('id_mapel', $mapel);
        $builder->where('type', '1');
        $builder->where('id_tp', $id_tp);
        $builder->where('id_smt', $id_smt);
        $builder->orderBy('tgl', 'DESC');
        return $builder->get()->getResult();
    }

    public function getCatatanMapelSiswa($id_tp, $id_smt, $id_kelas, $id_mapel) {
        $builder = $this->db->table('kelas_siswa a');
        $builder->select('b.id_siswa, b.nama, b.nis, b.nisn, b.foto, (SELECT COUNT(id_siswa) FROM kelas_catatan_mapel c WHERE c.id_siswa = b.id_siswa AND c.id_mapel = '.$id_mapel.' AND c.type = \'2\') AS jml_catatan');
        $builder->join('master_siswa b', 'b.id_siswa=a.id_siswa', 'left');
        $builder->where('a.id_tp', $id_tp);
        $builder->where('a.id_smt', $id_smt);
        $builder->where('a.id_kelas', $id_kelas);
        return $builder->get()->getResult();
    }

    public function getAllCatatanMapelSiswa($id_siswa, $id_mapel, $id_tp, $id_smt) {
        $builder = $this->db->table('kelas_catatan_mapel');
        $builder->where('id_siswa', $id_siswa);
        $builder->where('id_mapel', $id_mapel);
        $builder->where('id_tp', $id_tp);
        $builder->where('id_smt', $id_smt);
        $builder->orderBy('tgl', 'DESC');
        return $builder->get()->getResult();
    }


    public function get_status_siswa_kelas($id, $tp, $smt) {
        $builder = $this->db->table('kelas_siswa');
        $builder->select('id_siswa, id_kelas');
        if (is_array($id)) {
            $builder->whereIn('id_kelas', $id);
        } else {
            $builder->where('id_kelas', $id);
        }
        $builder->where('id_tp', $tp);
        $builder->where('id_smt', $smt);
        $result = $builder->get()->getResult();
        $ret = [];
        if ($result) {
            foreach ($result as $row) {
                $ret[$row->id_siswa] = $row;
            }
        }
        return $ret;
    }

    public function getAllKelasByArrId($arr_id) {
        if (empty($arr_id)) return [];
        $builder = $this->db->table('master_kelas');
        if (is_array($arr_id)) {
            $builder->whereIn('id_kelas', $arr_id);
        } else {
            $builder->where('id_kelas', $arr_id);
        }
        return $builder->get()->getResult();
    }

}
