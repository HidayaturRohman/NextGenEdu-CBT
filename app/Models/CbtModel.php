<?php

namespace App\Models;

use CodeIgniter\Model;

class CbtModel extends Model
{
    protected $table = 'cbt_jadwal';
    private static $cbtSchemaChecked = false;

    public function __construct()
    {
        parent::__construct();
        if (!self::$cbtSchemaChecked) {
            try {
                if (!$this->db->fieldExists('kategori', 'cbt_jenis')) {
                    $this->db->query("ALTER TABLE cbt_jenis ADD COLUMN kategori VARCHAR(20) DEFAULT 'lainnya' AFTER kode_jenis");
                    $this->db->query("UPDATE cbt_jenis SET kategori = 'sts' WHERE LOWER(kode_jenis) IN ('pts','sts') OR LOWER(nama_jenis) LIKE '%tengah%'");
                    $this->db->query("UPDATE cbt_jenis SET kategori = 'sas' WHERE LOWER(kode_jenis) IN ('pas','sas','pat','sat') OR LOWER(nama_jenis) LIKE '%akhir%'");
                    $this->db->query("UPDATE cbt_jenis SET kategori = 'ph' WHERE LOWER(kode_jenis) IN ('ph','uh') OR LOWER(nama_jenis) LIKE '%harian%'");
                }
            } catch (\Throwable $e) {
                // Silently ignore
            }
            self::$cbtSchemaChecked = true;
        }
    }

    // ==========================================
    // JENIS UJIAN
    // ==========================================
    public function getJenis()
    {
        return $this->db->table('cbt_jenis')->get()->getResult();
    }

    public function getJenisById($id)
    {
        return $this->db->table('cbt_jenis')
            ->select('id_jenis, nama_jenis, kode_jenis, kategori')
            ->where('id_jenis', $id)
            ->get()->getRow();
    }

    public function updateJenis($id, $name, $kode, $kategori = 'lainnya')
    {
        $update = [
            'nama_jenis' => $name,
            'kode_jenis' => $kode
        ];
        if ($this->db->fieldExists('kategori', 'cbt_jenis')) {
            $update['kategori'] = $kategori ?: 'lainnya';
        }
        return $this->db->table('cbt_jenis')
            ->where('id_jenis', $id)
            ->update($update);
    }

    // ==========================================
    // RUANG UJIAN
    // ==========================================
    public function getRuang()
    {
        return $this->db->table('cbt_ruang')
            ->select('cbt_ruang.*, (SELECT COUNT(id_sesi) FROM cbt_sesi) AS jum_sesi')
            ->get()->getResult();
    }

    public function getRuangById($id)
    {
        return $this->db->table('cbt_ruang')
            ->select('id_ruang, nama_ruang, kode_ruang')
            ->where('id_ruang', $id)
            ->get()->getRow();
    }

    public function updateRuang($id, $name, $kode)
    {
        $db = $this->db;
        $db->table('cbt_ruang')->where('id_ruang', $id)->update([
            'nama_ruang' => $name,
            'kode_ruang' => $kode
        ]);
        return true;
    }

    public function getAllNomorPeserta($id_tp, $id_smt, $ids_siswa)
    {
        $db = $this->db;
        $builder = $db->table('cbt_nomor_peserta');
        $builder->where('id_tp', $id_tp);
        $builder->where('id_smt', $id_smt);
        $builder->whereIn('id_siswa', $ids_siswa);
        $result = $builder->get()->getResult();
        $ret = [];
        foreach ($result as $row) {
            $ret[$row->id_siswa] = $row;
        }
        return $ret;
    }

    public function hapus_duplikat_nomor_peserta()
    {
        $db = $this->db;
        $sql = "DELETE t1 FROM `cbt_nomor_peserta` t1
        INNER JOIN `cbt_nomor_peserta` t2 
            ON t1.id_siswa = t2.id_siswa
            AND t1.id_tp = t2.id_tp
            AND t1.id_smt = t2.id_smt
            AND t1.nomor_peserta = t2.nomor_peserta
        WHERE t1.id_nomor < t2.id_nomor;";

        $db->query($sql);
        return $db->affectedRows();
    }

    public function getSiswaByKelasArray($id_tp, $id_smt, $arr_kelas)
    {
        $db = $this->db;
        $builder = $db->table('kelas_siswa a');
        $builder->select('a.id_siswa, a.id_kelas, b.nama, b.nis, b.nisn, b.username, b.password, b.agama, f.nama_kelas, f.kode_kelas, l.level, g.nomor_peserta');
        $builder->join('master_siswa b', 'b.id_siswa=a.id_siswa', 'left');
        $builder->join('master_kelas f', 'f.id_kelas=a.id_kelas', 'left');
        $builder->join('level_kelas l', 'l.id_level=f.level_id', 'left');
        $builder->join('cbt_nomor_peserta g', 'g.id_siswa=a.id_siswa AND g.id_tp='.$id_tp. ' AND g.id_smt='.$id_smt, 'left');
        
        if (!in_array('Semua', $arr_kelas)) {
            $builder->whereIn('a.id_kelas', $arr_kelas);
        }
        
        $builder->where('a.id_tp', $id_tp);
        $builder->where('a.id_smt', $id_smt);
        $builder->orderBy('l.level', 'ASC');
        $builder->orderBy('f.kode_kelas', 'ASC');
        $builder->orderBy('b.nama', 'ASC');

        $results = $builder->get()->getResult();
        foreach ($results as $r) {
            if (empty($r->level) || $r->level == '0') {
                $kls = strtoupper(trim(($r->nama_kelas ?? '') . ' ' . ($r->kode_kelas ?? '')));
                if (preg_match('/\b(XII|XI|VIII|VII|III|IV|IX|VI|II|X|V|I)\b/', $kls, $mRoman)) {
                    $romanMap = [
                        'I' => '1', 'II' => '2', 'III' => '3', 'IV' => '4', 'V' => '5', 'VI' => '6',
                        'VII' => '7', 'VIII' => '8', 'IX' => '9', 'X' => '10', 'XI' => '11', 'XII' => '12'
                    ];
                    $r->level = $romanMap[$mRoman[1]] ?? $mRoman[1];
                } elseif (preg_match('/\b(1[0-2]|[1-9])\b/', $kls, $mNum)) {
                    $r->level = $mNum[1];
                } elseif (preg_match('/^([0-9]{1,2})/', $kls, $mLead)) {
                    $r->level = (string)(int)$mLead[1];
                }
            }
        }
        return $results;
    }

    // ==========================================
    // SESI UJIAN
    // ==========================================
    public function getSesi()
    {
        return $this->db->table('cbt_sesi')->get()->getResult();
    }

    public function getSesiById($id)
    {
        return $this->db->table('cbt_sesi')
            ->select('id_sesi, nama_sesi, kode_sesi, waktu_mulai, waktu_akhir, istirahat')
            ->where('id_sesi', $id)
            ->get()->getRow();
    }

    public function updateSesi($id, $name, $kode, $mulai, $akhir, $istirahat)
    {
        return $this->db->table('cbt_sesi')
            ->where('id_sesi', $id)
            ->update([
                'nama_sesi' => $name,
                'kode_sesi' => $kode,
                'waktu_mulai' => $mulai,
                'waktu_akhir' => $akhir,
                'istirahat' => $istirahat,
                'aktif' => 1
            ]);
    }
    public function getRuangSesiSiswa($id_kelas, $id_tp, $id_smt)
    {
        $db = $this->db;
        $builder = $db->table('kelas_siswa a');
        $builder->select('a.id_siswa, a.id_kelas, b.nama, b.nis, b.username, c.nama_kelas, c.kode_kelas, e.id_sesi_siswa, e.siswa_id, e.sesi_id, e.ruang_id, rk.id_ruang, rk.kode_ruang, sk.id_sesi, sk.kode_sesi');
        $builder->join('master_siswa b', 'a.id_siswa=b.id_siswa', 'left');
        $builder->join('master_kelas c', 'a.id_kelas=c.id_kelas', 'left');
        $builder->join('cbt_sesi_siswa e', 'a.id_siswa=e.siswa_id AND a.id_tp = e.tp_id AND a.id_smt = e.smt_id', 'left');
        $builder->join('cbt_ruang rk', 'e.ruang_id=rk.id_ruang', 'left');
        $builder->join('cbt_sesi sk', 'e.sesi_id=sk.id_sesi', 'left');
        
        $builder->where('a.id_kelas', $id_kelas);
        $builder->where('a.id_tp', $id_tp);
        $builder->where('a.id_smt', $id_smt);
        $builder->orderBy('b.nama', 'ASC');

        $results = $builder->get()->getResult();
        foreach ($results as $r) {
            if (empty($r->level) || $r->level == '0') {
                $kls = strtoupper(trim(($r->nama_kelas ?? '') . ' ' . ($r->kode_kelas ?? '')));
                if (preg_match('/\b(XII|XI|VIII|VII|III|IV|IX|VI|II|X|V|I)\b/', $kls, $mRoman)) {
                    $romanMap = [
                        'I' => '1', 'II' => '2', 'III' => '3', 'IV' => '4', 'V' => '5', 'VI' => '6',
                        'VII' => '7', 'VIII' => '8', 'IX' => '9', 'X' => '10', 'XI' => '11', 'XII' => '12'
                    ];
                    $r->level = $romanMap[$mRoman[1]] ?? $mRoman[1];
                } elseif (preg_match('/\b(1[0-2]|[1-9])\b/', $kls, $mNum)) {
                    $r->level = $mNum[1];
                } elseif (preg_match('/^([0-9]{1,2})/', $kls, $mLead)) {
                    $r->level = (string)(int)$mLead[1];
                }
            }
        }
        return $results;
    }

    public function getDataBank($guru = null, $mapel = null, $level = null)
    {
        $db = $this->db;
        $builder = $db->table('cbt_bank_soal a');
        $builder->select('a.id_bank, a.id_tp, a.id_smt, a.bank_kode, a.bank_level, a.bank_kelas, a.date, a.status, ' .
            'a.tampil_pg, a.tampil_kompleks, a.tampil_jodohkan, a.tampil_isian, a.tampil_esai, a.bank_guru_id, a.soal_agama, ' .
            'b.nama_mapel, c.id_guru, c.nama_guru, ' .
            '(SELECT COUNT(id_soal) FROM cbt_soal WHERE cbt_soal.bank_id = a.id_bank) AS total_soal, ' .
            '(SELECT COUNT(id_jadwal) FROM cbt_jadwal WHERE cbt_jadwal.id_bank = a.id_bank AND cbt_jadwal.status="1") AS digunakan');
        $builder->join('master_mapel b', 'b.id_mapel=a.bank_mapel_id', 'left');
        $builder->join('master_guru c', 'c.id_guru=a.bank_guru_id', 'left');

        if ($guru !== null) {
            $builder->where('a.bank_guru_id', $guru);
        }
        if ($mapel !== null) {
            $builder->where('a.bank_mapel_id', $mapel);
        }
        if ($level !== null) {
            $builder->where('a.bank_level', $level);
        }
        $builder->orderBy('a.bank_level', 'ASC');

        $result = $builder->get()->getResult();
        $ret = [];
        foreach ($result as $row) {
            $ret[$row->id_tp][$row->id_smt][] = $row;
        }
        return $ret;
    }
    
    // ==========================================
    // JADWAL UJIAN
    // ==========================================
    public function dummyJadwal()
    {
        return (object)[
            'id_bank' => '',
            'id_jadwal' => '',
            'id_jenis' => '',
            'tgl_mulai' => '',
            'tgl_selesai' => '',
            'durasi_ujian' => '',
            'bank_kelas' => json_encode([]),
            'acak_soal' => '1',
            'acak_opsi' => '1',
            'hasil_tampil' => '',
            'token' => '',
            'status' => '',
            'ulang' => '',
            'jarak' => '',
            'reset_login' => '',
            'pelanggaran' => '',
            'kamera' => '0',
            'lock_browser' => '0',
        ];
    }

    public function getDistinctJenisJadwal($tp, $smt)
    {
        $db = $this->db;
        $builder = $db->table('cbt_jadwal');
        $builder->distinct();
        $builder->select('id_jenis');
        $builder->where('id_tp', $tp);
        $builder->where('id_smt', $smt);
        return $builder->get()->getResult();
    }

    public function getKelas($tp = null, $smt = null)
    {
        $db = $this->db;
        $builder = $db->table('master_kelas a');
        $builder->select('a.id_kelas, a.nama_kelas, a.kode_kelas, b.level');
        $builder->join('level_kelas b', 'b.id_level=a.level_id', 'left');

        if ($tp != null) $builder->where('a.id_tp', $tp);
        if ($smt != null) $builder->where('a.id_smt', $smt);
        $builder->orderBy('a.nama_kelas', 'ASC');
        return $builder->get()->getResult();
    }

    /**
     * Migrasi dari Cbt_model CI3::getKelasByLevel()
     * Filter kelas berdasarkan level_id dan array id_kelas yang diajar guru
     */
    public function getKelasByLevel($level, $arrKelas)
    {
        $db = $this->db;
        $builder = $db->table('master_kelas');
        $builder->select('id_kelas, kode_kelas, nama_kelas, level_id');
        if (!empty($level)) {
            $builder->where('level_id', $level);
        }
        if (!empty($arrKelas)) {
            $builder->whereIn('id_kelas', $arrKelas);
        }
        return $builder->get()->getResult();
    }

    public function getAllDataJadwal($tp, $smt, $guru = null, $mapel = null, $level = null)
    {
        $db = $this->db;
        $builder = $db->table('cbt_jadwal a');
        $builder->select('a.id_jadwal, a.tgl_mulai, a.tgl_selesai, a.status, a.durasi_ujian, a.acak_soal,' .
            ' a.acak_opsi,a.id_bank,a.id_jenis,a.hasil_tampil,a.ulang,a.reset_login,a.rekap,a.pelanggaran,a.kamera,' .
            ' a.jam_ke, a.token, e.tahun, f.nama_smt, g.level, b.bank_kode, b.bank_level, b.bank_kelas, c.kode_jenis, d.kode, d.nama_mapel,' .
            ' b.tampil_pg, b.tampil_kompleks, b.tampil_jodohkan, b.tampil_isian, b.tampil_esai, b.bank_guru_id, b.soal_agama,' .
            ' (SELECT COUNT(id_soal) FROM cbt_soal WHERE cbt_soal.bank_id = a.id_bank) AS total_soal');
        $builder->join('cbt_bank_soal b', 'b.id_bank=a.id_bank');
        $builder->join('cbt_jenis c', 'c.id_jenis=a.id_jenis', "left");
        $builder->join('master_mapel d', 'd.id_mapel=b.bank_mapel_id', "left");
        $builder->join('master_tp e', 'a.id_tp=e.id_tp');
        $builder->join('master_smt f', 'a.id_smt=f.id_smt');
        $builder->join('level_kelas g', 'b.bank_level=g.id_level', 'left');
        $builder->where('a.id_tp', $tp);
        $builder->where('a.id_smt', $smt);

        if ($guru !== null) {
            $builder->where('b.bank_guru_id', $guru);
        }
        if ($mapel !== null) {
            $builder->where('b.bank_mapel_id', $mapel);
        }
        if ($level !== null) {
            $builder->where('b.bank_level', $level);
        }
        $builder->orderBy('b.bank_level', 'ASC');
        $builder->orderBy('a.id_tp', 'DESC');
        $builder->orderBy('a.id_smt', 'DESC');
        $builder->orderBy('a.tgl_mulai', 'ASC');
        $query = $builder->get()->getResult();
        $ret = [];
        foreach ($query as $key => $row) {
            $levelName = !empty($row->level) ? $row->level : ($row->bank_level == '0' ? 'Semua Level' : $row->bank_level);
            $ret['<b>' . $row->kode_jenis . '</b>  ' . $row->tahun . ' smt ' . $row->nama_smt][$levelName][] = $row;
        }
        return $ret;
    }

    public function getJadwalById($id_jadwal, $sesi = null)
    {
        $db = $this->db;
        $builder = $db->table('cbt_jadwal a');
        $builder->select('a.*, b.opsi, b.bank_kode, b.bank_level, b.bank_kelas,'
            . ' b.tampil_pg, b.tampil_kompleks, b.tampil_jodohkan, b.tampil_isian, b.tampil_esai,'
            . ' b.bobot_pg, b.bobot_kompleks, b.bobot_jodohkan, b.bobot_isian, b.bobot_esai,'
            . ' b.id_bank, b.bank_guru_id, b.soal_agama, c.kode_jenis, c.nama_jenis,'
            . ' d.id_mapel, d.kode, d.nama_mapel, f.id_guru, f.nama_guru');
        $builder->join('cbt_bank_soal b', 'b.id_bank=a.id_bank', "left");
        $builder->join('cbt_jenis c', 'c.id_jenis=a.id_jenis', "left");
        $builder->join('master_mapel d', 'd.id_mapel=b.bank_mapel_id', "left");
        if ($sesi != null) {
            $builder->join('cbt_sesi e', 'e.id_sesi=' . $sesi, "left");
        }
        $builder->join('master_guru f', 'f.id_guru=b.bank_guru_id', "left");
        $builder->where('a.id_jadwal', $id_jadwal);

        return $builder->get()->getRow();
    }

    public function getDataJadwalByTgl($tgl)
    {
        $db = $this->db;
        $builder = $db->table('cbt_jadwal');
        $builder->distinct();
        $builder->select('tgl_mulai, tgl_selesai');
        $builder->where("tgl_mulai <= '$tgl' AND tgl_selesai >= '$tgl'");
        return $builder->get()->getResult();
    }

    public function getJumlahJenisSoal($id_bank)
    {
        $builder = $this->db->table('cbt_soal');
        $builder->select('id_soal, jenis');
        $builder->where('bank_id', $id_bank);
        $builder->where('tampilkan', '1');
        $result = $builder->get()->getResult();
        $ret = [];
        if ($result) {
            foreach ($result as $row) {
                $ret[$row->jenis][] = $row;
            }
        }
        return $ret;
    }

    public function cekJadwalBankSoal($id_bank)
    {
        $db = $this->db;
        $builder = $db->table('cbt_jadwal');
        $builder->select('id_bank');
        if (is_array($id_bank)) {
            $builder->whereIn('id_bank', $id_bank);
        } else {
            $builder->where('id_bank', $id_bank);
        }
        return $builder->countAllResults();
    }

    public function getDistinctRuang($tp, $smt, $arrKelas)
    {
        $db = $this->db;
        $builder = $db->table('cbt_sesi_siswa a');
        $builder->distinct();
        $builder->select('a.ruang_id, a.sesi_id, b.kode_ruang, b.nama_ruang, c.kode_sesi, c.nama_sesi');
        $builder->join('cbt_ruang b', 'b.id_ruang=a.ruang_id');
        $builder->join('cbt_sesi c', 'c.id_sesi=a.sesi_id');
        $builder->join('kelas_siswa ks', 'ks.id_siswa=a.siswa_id AND ks.id_tp='.$tp.' AND ks.id_smt='.$smt, 'left');
        $builder->where("a.tp_id", $tp);
        $builder->where("a.smt_id", $smt);
        
        if (count($arrKelas) > 0) {
            $builder->whereIn('COALESCE(NULLIF(a.kelas_id, 0), ks.id_kelas)', $arrKelas);
        }
        $builder->orderBy('b.nama_ruang', 'ASC');
        $builder->orderBy('c.nama_sesi', 'ASC');
        $result = $builder->get()->getResult();
        $ret = [];
        if ($result) {
            foreach ($result as $key => $row) {
                $ret[$row->ruang_id][$row->sesi_id] = $row;
            }
        }
        return $ret;
    }

    public function getKelasUjian($tp, $smt, $kelas_id)
    {
        $db = $this->db;
        $builder = $db->table('cbt_sesi_siswa a');
        $builder->select('b.id_kelas as kelas_id, a.ruang_id, a.sesi_id');
        $builder->join('kelas_siswa b', 'a.siswa_id=b.id_siswa AND b.id_tp='.$tp.' AND b.id_smt='.$smt);
        $builder->where('a.tp_id', $tp);
        $builder->where('a.smt_id', $smt);
        if (is_array($kelas_id)) {
            $builder->whereIn('b.id_kelas', $kelas_id);
        } else {
            $builder->where('b.id_kelas', $kelas_id);
        }
        $result = $builder->get()->getResult();
        $ret = [];
        if ($result) {
            foreach ($result as $key => $row) {
                $ret[$row->kelas_id][$row->ruang_id][$row->sesi_id][] = $row->kelas_id;
            }
        }
        return $ret;
    }

    public function getRuangSesi($tp, $smt)
    {
        $db = $this->db;
        $builder = $db->table('cbt_sesi_siswa a');
        $builder->select('b.id_kelas as kelas_id, a.ruang_id, a.sesi_id');
        $builder->join('kelas_siswa b', 'a.siswa_id=b.id_siswa AND b.id_tp='.$tp.' AND b.id_smt='.$smt);
        $builder->where('a.tp_id', $tp);
        $builder->where('a.smt_id', $smt);
        
        $result = $builder->get()->getResult();
        $ret = [];
        if ($result) {
            foreach ($result as $row) {
                $ret[$row->sesi_id][$row->ruang_id][$row->kelas_id] = $row->kelas_id;
            }
        }
        return $ret;
    }

    public function getPengawas($id_pengawas)
    {
        $db = $this->db;
        $builder = $db->table('cbt_pengawas');
        $builder->where('id_pengawas', $id_pengawas);
        return $builder->get()->getRow();
    }

    public function saveJadwalUjian($data, $id_jadwal = null)
    {
        $db = $this->db;
        $builder = $db->table('cbt_jadwal');
        if ($id_jadwal) {
            $builder->where('id_jadwal', $id_jadwal);
            $builder->update($data);
            return [
                'success' => true,
                'errors' => []
            ];
        } else {
            // Check unique bank_id manually
            $exist = $builder->where('id_bank', $data['id_bank'])->countAllResults();
            if ($exist > 0) {
                return [
                    'success' => false,
                    'errors' => 'Bank Soal sudah digunakan di jadwal lain.'
                ];
            }
            $builder->insert($data);
            $insert_id = $db->insertID();
            return [
                'insert_id' => $insert_id,
                'success' => true,
                'errors' => []
            ];
        }
    }

    public function getAllPengawas($tp, $smt, $ruang=null, $sesi=null) {
        $db = $this->db;
        $builder = $db->table('cbt_pengawas');
        $builder->select('id_pengawas, id_jadwal, id_ruang, id_sesi, id_guru, jam_ke');
        $builder->where('id_tp', $tp);
        $builder->where('id_smt', $smt);
        if ($ruang!=null) $builder->where('id_ruang', $ruang);
        if ($sesi!=null) $builder->where('id_sesi', $sesi);
        $builder->orderBy('jam_ke', 'ASC');
		$result = $builder->get()->getResult();
		$ret = [];
		if ($result) {
			foreach ($result as $key => $row) {
				$ret[$row->id_jadwal][$row->id_ruang][$row->id_sesi] = $row;
			}
		}
		return $ret;
	}

    public function getDistinctSesi($tp, $smt, $ids_kelas) {
        $db = $this->db;
        $builder = $db->table('cbt_sesi_siswa a');
        $builder->select('a.siswa_id, a.ruang_id, a.sesi_id, COALESCE(NULLIF(a.kelas_id, 0), ks.id_kelas) as kelas_id, b.kode_ruang, b.nama_ruang, c.kode_sesi, c.nama_sesi, c.waktu_mulai, c.waktu_akhir, c.istirahat, d.nama_kelas');
        $builder->join('cbt_ruang b', 'b.id_ruang=a.ruang_id');
        $builder->join('cbt_sesi c', 'c.id_sesi=a.sesi_id');
        $builder->join('kelas_siswa ks', 'ks.id_siswa=a.siswa_id AND ks.id_tp='.$tp.' AND ks.id_smt='.$smt, 'left');
        $builder->join('master_kelas d', 'd.id_kelas=COALESCE(NULLIF(a.kelas_id, 0), ks.id_kelas)', 'left');
        $builder->where('a.tp_id', $tp);
        $builder->where('a.smt_id', $smt);
        if (!empty($ids_kelas)) {
            if (is_array($ids_kelas)) {
                $builder->whereIn('COALESCE(NULLIF(a.kelas_id, 0), ks.id_kelas)', $ids_kelas);
            } else {
                $builder->where('COALESCE(NULLIF(a.kelas_id, 0), ks.id_kelas)', $ids_kelas);
            }
        }
        $builder->orderBy('b.nama_ruang', 'ASC');
        $builder->orderBy('c.nama_sesi', 'ASC');
        $result = $builder->get()->getResult();
        $sesis = [];
        if ($result) {
            foreach ($result as $row) {
                $key = $row->sesi_id.'-'.$row->ruang_id;
                if (!isset($sesis[$key])) {
                    $sesis[$key] = (object)[
                        'sesi_id' => $row->sesi_id,
                        'kode_sesi' => $row->kode_sesi,
                        'nama_sesi' => $row->nama_sesi,
                        'waktu_mulai' => $row->waktu_mulai,
                        'waktu_akhir' => $row->waktu_akhir,
                        'ruang_id' => $row->ruang_id,
                        'kode_ruang' => $row->kode_ruang,
                        'nama_ruang' => $row->nama_ruang,
                        'istirahat' => $row->istirahat,
                        'kelas_id' => [],
                        'nama_kelas' => [],
                        'ids_siswa' => [],
                        'peserta' => 0
                    ];
                }
                if (!isset($sesis[$key]->nama_kelas[$row->kelas_id])) {
                    $sesis[$key]->nama_kelas[$row->kelas_id] = $row->nama_kelas;
                    $sesis[$key]->kelas_id[] = $row->kelas_id;
                }
                $sesis[$key]->ids_siswa[] = $row->siswa_id;
                $sesis[$key]->peserta += 1;
            }
        }
        return array_values($sesis); // Return array instead of keyed array for CI3 compatibility with array_values where expected
    }

    public function getAllJadwalByTanggal($tp, $smt, $jenis, $id_guru = null, $tanggal = null) {
        $db = $this->db;
        $builder = $db->table('cbt_jadwal a');
        $builder->select('a.id_jadwal, a.id_bank, a.id_jenis, a.tgl_mulai, a.tgl_selesai, a.jam_ke, '.
            'c.bank_kode, c.bank_level, c.bank_kelas, c.bank_guru_id, c.soal_agama, b.kode_jenis, b.nama_jenis, d.id_mapel, d.kode, d.nama_mapel');
        $builder->join('cbt_jenis b', 'b.id_jenis=a.id_jenis');
        $builder->join('cbt_bank_soal c', 'c.id_bank=a.id_bank');
        $builder->join('master_mapel d', 'd.id_mapel=c.bank_mapel_id');
        if ($id_guru != null) $builder->where('c.bank_guru_id', $id_guru);
        $builder->where('a.id_tp', $tp);
        $builder->where('a.id_smt', $smt);
        $builder->where('a.id_jenis', $jenis);
        if ($tanggal != null) $builder->where('a.tgl_mulai', $tanggal);
        $builder->orderBy('a.tgl_mulai', 'ASC');
        $builder->orderBy('c.bank_level', 'ASC');

        return $builder->get()->getResult();
    }
    public function saveBankSoal($tp, $smt) {
        $request = \Config\Services::request();
        $id = $request->getPost('id_bank');
        $kelas_post = $request->getPost('kelas');
        $rows = $kelas_post ? count($kelas_post) : 0;

        $kelas = [];
        $hasZero = false;
        if ($kelas_post && is_array($kelas_post)) {
            foreach ($kelas_post as $kVal) {
                if ($kVal === '0' || $kVal === 0 || $kVal === 'all') {
                    $hasZero = true;
                } else {
                    $kelas[] = ['kelas_id' => (string)$kVal];
                }
            }
        }
        $bank_level = strip_tags($request->getPost('level') ?? '');
        if ($hasZero || $bank_level === '0') {
            $allKelasDb = $this->db->table('master_kelas')->where('id_tp', $tp)->where('id_smt', $smt)->get()->getResult();
            foreach ($allKelasDb as $ak) {
                $exists = false;
                foreach ($kelas as $kItem) {
                    if ($kItem['kelas_id'] == $ak->id_kelas) {
                        $exists = true;
                        break;
                    }
                }
                if (!$exists) {
                    $kelas[] = ['kelas_id' => (string)$ak->id_kelas];
                }
            }
        }
        $jumlah = json_encode($kelas);
        
        $data = array(
            'id_tp' => $tp,
            'id_smt' => $smt,
            'bank_kode' => strip_tags($request->getPost('kode') ?? ''),
            'bank_jenis_id' => strip_tags($request->getPost('jenis') ?? ''),
            'bank_mapel_id' => strip_tags($request->getPost('mapel') ?? ''),
            'bank_kelas' => $jumlah,
            'bank_level' => strip_tags($request->getPost('level') ?? ''),
            'bank_guru_id' => strip_tags($request->getPost('guru') ?? ''),
            'jml_soal' => strip_tags($request->getPost('tampil_pg') ?? ''),
            'tampil_pg' => strip_tags($request->getPost('tampil_pg') ?? ''),
            'bobot_pg' => strip_tags($request->getPost('bobot_pg') ?? ''),
            'opsi' => strip_tags($request->getPost('opsi') ?? ''),

            'jml_kompleks' => strip_tags($request->getPost('tampil_kompleks') ?? ''),
            'tampil_kompleks' => strip_tags($request->getPost('tampil_kompleks') ?? ''),
            'bobot_kompleks' => strip_tags($request->getPost('bobot_kompleks') ?? ''),

            'jml_jodohkan' => strip_tags($request->getPost('tampil_jodohkan') ?? ''),
            'tampil_jodohkan' => strip_tags($request->getPost('tampil_jodohkan') ?? ''),
            'bobot_jodohkan' => strip_tags($request->getPost('bobot_jodohkan') ?? ''),

            'jml_isian' => strip_tags($request->getPost('tampil_isian') ?? ''),
            'tampil_isian' => strip_tags($request->getPost('tampil_isian') ?? ''),
            'bobot_isian' => strip_tags($request->getPost('bobot_isian') ?? ''),

            'jml_esai' => strip_tags($request->getPost('bobot_esai') ?? ''),
            'bobot_esai' => strip_tags($request->getPost('bobot_esai') ?? ''),
            'tampil_esai' => strip_tags($request->getPost('tampil_esai') ?? ''),
            'status' => strip_tags($request->getPost('status') ?? ''),
            'soal_agama' => strip_tags($request->getPost('soal_agama') ?? ''),
        );

        if (!$id) {
            $this->db->table('cbt_bank_soal')->insert($data);
            return $this->db->insertID();
        }

        $this->db->table('cbt_bank_soal')->where('id_bank', $id)->update($data);
        return $id;
    }

    public function getDataBankById($id) {
        $builder = $this->db->table('cbt_bank_soal a');
        $builder->select('a.*, b.nama_mapel, b.kode, c.nama_guru, d.nama_jurusan, d.kode_jurusan,'.
            ' (SELECT COUNT(id_jadwal) FROM cbt_jadwal WHERE cbt_jadwal.id_bank = a.id_bank AND cbt_jadwal.status="1") AS digunakan');
        $builder->join('master_mapel b', 'b.id_mapel=a.bank_mapel_id', 'left');
        $builder->join('master_guru c', 'c.id_guru=a.bank_guru_id', 'left');
        $builder->join('master_jurusan d', 'd.id_jurusan=a.bank_jurusan_id', 'left');
        $builder->where('a.id_bank', $id);
        return $builder->get()->getRow();
    }

    /**
     * Memastikan kolom is_hots tersedia pada tabel cbt_soal (auto-migration aman).
     */
    public function ensureHotsSchema(): void
    {
        static $verified = [];
        $dbKey = ($this->db->database ?? '') . '#' . spl_object_id($this->db);
        if (isset($verified[$dbKey])) {
            return;
        }
        try {
            if (!$this->db->fieldExists('is_hots', 'cbt_soal')) {
                $this->db->query("ALTER TABLE `cbt_soal` ADD COLUMN `is_hots` TINYINT(1) NOT NULL DEFAULT 0 AFTER `tampilkan`");
            }
            $verified[$dbKey] = true;
        } catch (\Throwable $e) {
            if ($this->db->fieldExists('is_hots', 'cbt_soal')) {
                $verified[$dbKey] = true;
            }
        }
    }

    public function getAllSoalByBank($id_bank, $jenis = null) {
        $builder = $this->db->table('cbt_soal');
        $this->ensureHotsSchema();
        $builder->select('id_soal, bank_id, mapel_id, jenis, nomor_soal, soal, opsi_a, opsi_b, opsi_c, opsi_d, opsi_e, jawaban, tampilkan, is_hots');
        $builder->where('bank_id', $id_bank);
        if ($jenis != null) {
            $builder->where('jenis', $jenis);
        }
        $builder->orderBy('nomor_soal', 'ASC');
        return $builder->get()->getResult();
    }

    public function cekSoalAda($id_bank, $jenis) {
        $builder = $this->db->table('cbt_soal');
        $builder->select('id_soal, bank_id, jenis, nomor_soal');
        $builder->where('bank_id', $id_bank);
        $builder->where('jenis', $jenis);
        return $builder->get()->getResult();
    }

    public function cekSoalBelumKomplit($jenis, $opsi_ganda) {
        $builder = $this->db->table('cbt_soal');
        $builder->select('id_soal, bank_id, jenis, nomor_soal, mapel_id');
        $builder->where('jenis', $jenis);
        $builder->groupStart()
                ->where('soal IS NULL', null, false)
                ->orWhere('soal', "")
                ->groupEnd();

        if ($jenis == "1") {
            $builder->groupStart()
                    ->where('opsi_a IS NULL', null, false)
                    ->orWhere('opsi_a', "")
                    ->groupEnd();
            $builder->groupStart()
                    ->where('opsi_b IS NULL', null, false)
                    ->orWhere('opsi_b', "")
                    ->groupEnd();
            $builder->groupStart()
                    ->where('opsi_c IS NULL', null, false)
                    ->orWhere('opsi_c', "")
                    ->groupEnd();
            if ($opsi_ganda == '4') {
                $builder->groupStart()
                        ->where('opsi_d IS NULL', null, false)
                        ->orWhere('opsi_d', "")
                        ->groupEnd();
            }
            if ($opsi_ganda == '5') {
                $builder->groupStart()
                        ->where('opsi_d IS NULL', null, false)
                        ->orWhere('opsi_d', "")
                        ->groupEnd();
                $builder->groupStart()
                        ->where('opsi_e IS NULL', null, false)
                        ->orWhere('opsi_e', "")
                        ->groupEnd();
            }
        }

        if ($jenis == "2") {
            $builder->groupStart()
                    ->where('opsi_a IS NULL', null, false)
                    ->orWhere('opsi_a', "")
                    ->groupEnd();
        }

        $builder->groupStart()
                ->where('jawaban IS NULL', null, false)
                ->orWhere('jawaban', "")
                ->groupEnd();
                
        $ret = [];
        $result = $builder->get()->getResult();
        foreach ($result as $key => $row) {
            $ret[$row->bank_id][] = $row;
        }
        return $ret;
    }

    public function getNomorSoalTerbesar($id_bank, $jenis) {
        $builder = $this->db->table('cbt_soal');
        $builder->select('nomor_soal');
        $builder->where('bank_id', $id_bank)->where('jenis', $jenis);
        $builder->orderBy('nomor_soal', 'DESC');
        return $builder->get()->getRow();
    }

    public function getNomorSoalById($id_soal) {
        $builder = $this->db->table('cbt_soal');
        $builder->select('nomor_soal, jenis, bank_id');
        $builder->where('id_soal', $id_soal);
        return $builder->get()->getRow();
    }

    public function getNomorSoalByBankJenis($id_bank, $jenis) {
        $builder = $this->db->table('cbt_soal');
        $builder->select('id_soal, jenis, nomor_soal');
        $builder->where('bank_id', $id_bank);
        $builder->where('jenis', $jenis);
        $result = $builder->get()->getResult();
        $ret = [];
        foreach ($result as $key => $row) {
            $ret[$row->nomor_soal] = $row;
        }
        return $ret;
    }

    public function getSoalByNomor($bank_id, $nomor, $jenis)
    {
        $builder = $this->db->table('cbt_soal');
        $builder->where('bank_id', $bank_id);
        $this->ensureHotsSchema();
        $builder->where('nomor_soal', $nomor);
        if ($jenis != null) {
            $builder->where('jenis', $jenis);
        }
        return $builder->get()->getRow();
    }

    public function getFileSoalById($id_soal)
    {
        $builder = $this->db->table('cbt_soal');
        $builder->select('file');
        $builder->where('id_soal', $id_soal);
        return $builder->get()->getRow();
    }

    public function dummy($jenjang) {
        $data = array(
            'id_bank' => '',
            'bank_jenis_id' => '',
            'bank_kode' => '',
            'bank_mapel_id' => '',
            'bank_level' => '',
            'bank_kelas' => [],
            'bank_guru_id' => '',
            'jml_soal' => '0',
            'bobot_pg' => '0',
            'tampil_pg' => '0',
            'opsi' => $jenjang == '1' ? '3' : ($jenjang == '2' ? '4' : ($jenjang == '3' ? '5' : '')),

            'jml_kompleks' => '0',
            'tampil_kompleks' => '0',
            'bobot_kompleks' => '0',

            'jml_jodohkan' => '0',
            'tampil_jodohkan' => '0',
            'bobot_jodohkan' => '0',

            'jml_isian' => '0',
            'tampil_isian' => '0',
            'bobot_isian' => '0',

            'jml_esai' => '0',
            'bobot_esai' => '0',
            'tampil_esai' => '0',
            'kkm' => '',
            'soal_agama' => '-',
            'status' => '1'
        );
        return $data;
    }

    public function getAllJenisUjian() {
        $builder = $this->db->table('cbt_jenis');
        $builder->select('id_jenis, nama_jenis, kode_jenis');
        $result = $builder->get()->getResult();
        $ret [''] = 'Pilih Jenis Ujian :';
        if ($result) {
            foreach ($result as $row) {
                $ret[$row->id_jenis] = !empty($row->nama_jenis) ? $row->nama_jenis : $row->kode_jenis;
            }
        }
        return $ret;
    }

    public function getAllJenisUjianByArrJenis($arrJenis) {
        $builder = $this->db->table('cbt_jenis');
        $builder->whereIn('id_jenis', $arrJenis);
        $result = $builder->get()->getResult();
        $ret [''] = 'Pilih Jenis Ujian :';
        if ($result) {
            foreach ($result as $row) {
                $ret[$row->id_jenis] = !empty($row->nama_jenis) ? $row->nama_jenis : $row->kode_jenis;
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

public function getSettingKopAbsensi() {
        $builder = $this->db->table('cbt_kop_absensi a');
		$builder->select('a.*, b.logo_kanan, b.logo_kiri, b.kepsek, b.tanda_tangan');
		
		$builder->join('setting b', 'b.id_setting=1', 'left');
		return $builder->get()->getRow();
	}

    public function getPengawasHariIni($tgl) {
        $builder = $this->db->table('cbt_jadwal a');
        $builder->where("a.tgl_mulai <= '$tgl' AND a.tgl_selesai >= '$tgl'");
        $builder->join('cbt_pengawas b', 'b.id_jadwal=a.id_jadwal');
        $builder->where('a.status', '1');
        return $builder->get()->getResult();
    }

    public function getSettingKartu() {
        $builder = $this->db->table('cbt_kop_kartu');
        $builder->select('*');
        return $builder->get()->getRow();
    }

    public function getJadwalByTanggal($tgl_mulai=null) {
        $builder = $this->db->table('cbt_jadwal a');
        $builder->select('a.id_jadwal,a.tgl_mulai,a.tgl_selesai,a.jam_ke,b.soal_agama,b.bank_mapel_id,b.bank_kelas');
        $builder->join('cbt_bank_soal b', 'b.id_bank=a.id_bank', "left");
        if ($tgl_mulai != null) {
            if (is_array($tgl_mulai)) {
                $builder->whereIn('a.tgl_mulai', $tgl_mulai);
            } else {
                $builder->where('a.tgl_mulai', $tgl_mulai);
            }
        }
        return $builder->get()->getResult();
    }

    public function getPengawasByJadwal($tp, $smt, $id_jadwal, $sesi=null, $ruang=null) {
        $builder = $this->db->table('cbt_pengawas');
        $builder->select('id_pengawas, id_guru, id_jadwal, id_ruang, id_sesi, jam_ke');
        
        $builder->where('id_tp', $tp);
        $builder->where('id_smt', $smt);
        if (is_array($id_jadwal)) {
            if (empty($id_jadwal)) return [];
            $builder->whereIn('id_jadwal', $id_jadwal);
        } else {
            $builder->where('id_jadwal', $id_jadwal);
        }
        if ($sesi != null) {
            $builder->where('id_sesi', $sesi);
        }
        if ($ruang != null) {
            $builder->where('id_ruang', $ruang);
        }
        return $builder->get()->getResult();
    }

    public function getRuangSiswaByKelas($id_tp, $id_smt, $kelas, $sesi = null) {
        if (empty($kelas)) {
            return [];
        }

        $builder = $this->db->table('kelas_siswa c');
        $builder->select('a.ruang_id, a.sesi_id, b.id_siswa, b.nama, b.nis, b.nisn, b.username, b.password, b.foto,'.
            ' f.id_kelas, f.nama_kelas, f.kode_kelas, f.set_siswa,'.
            ' d.nama_ruang, d.kode_ruang,'.
            ' e.kode_sesi, e.nama_sesi, e.istirahat,'.
            ' g.nomor_peserta');

        $builder->where('c.id_tp', $id_tp);
        $builder->where('c.id_smt', $id_smt);

        $builder->join('master_siswa b', 'b.id_siswa=c.id_siswa', 'left');
        $builder->join('master_kelas f', 'f.id_kelas=c.id_kelas', 'left');
        $builder->join('cbt_sesi_siswa a', 'a.siswa_id=b.id_siswa AND a.tp_id='.$id_tp.' AND a.smt_id='.$id_smt, 'left');
        $builder->join('cbt_ruang d', 'd.id_ruang=a.ruang_id', 'left');
        $builder->join('cbt_sesi e', 'e.id_sesi=a.sesi_id', 'left');
        $builder->join('cbt_nomor_peserta g', 'g.id_siswa=b.id_siswa AND g.id_tp='.$id_tp.' AND g.id_smt='.$id_smt, 'left');

        if (is_array($kelas)) {
            $builder->whereIn('c.id_kelas', $kelas);
        } else {
            $builder->where('c.id_kelas', $kelas);
        }
        if (!empty($sesi)) {
            $builder->where('a.sesi_id', $sesi);
        }
        $builder->orderBy('b.nama', 'ASC');

        return $builder->get()->getResult();
	}

    public function getSiswaByRuang($id_tp, $id_smt, $id_ruang, $sesi = null, $level = null) {
        $builder = $this->db->table('cbt_sesi_siswa a');
        $builder->select('a.ruang_id, a.sesi_id, b.id_siswa, b.nama, b.nis, b.nisn, b.username, b.password, b.foto, b.agama,'.
            ' f.id_kelas, f.nama_kelas, f.kode_kelas,'.
            ' d.nama_ruang, d.kode_ruang,'.
            ' e.kode_sesi, e.nama_sesi,'.
            ' us.active,'.
            ' (SELECT COUNT(login) FROM login_attempts WHERE login_attempts.login = b.username) AS reset,'.
            ' g.nomor_peserta');

        $builder->where('a.tp_id', $id_tp);
        $builder->where('a.smt_id', $id_smt);
        $builder->where('a.ruang_id', $id_ruang);

        if (!empty($sesi)) {
            $builder->where('a.sesi_id', $sesi);
        }

        $builder->join('master_siswa b', 'b.id_siswa=a.siswa_id', 'left');
        $builder->join('cbt_ruang d', 'd.id_ruang=a.ruang_id', 'left');
        $builder->join('cbt_sesi e', 'e.id_sesi=a.sesi_id', 'left');
        $builder->join('cbt_nomor_peserta g', 'g.id_siswa=a.siswa_id AND g.id_tp='.$id_tp. ' AND g.id_smt='.$id_smt, 'left');
        $builder->join('users us', 'us.username=b.username', 'left');

        $builder->join('kelas_siswa c', 'c.id_siswa=b.id_siswa AND c.id_tp='.$id_tp.' AND c.id_smt='.$id_smt.'', 'left');
        $builder->join('master_kelas f', 'f.id_kelas=c.id_kelas', 'left');
        if ($level != null) {
            $builder->where('f.level_id', $level);
        }
        $builder->join('buku_induk i', 'i.id_siswa=b.id_siswa AND i.status="1"', 'left');

        $builder->orderBy('b.nama', 'ASC');

        $results = $builder->get()->getResult();
        foreach ($results as $r) {
            if (empty($r->level) || $r->level == '0') {
                $kls = strtoupper(trim(($r->nama_kelas ?? '') . ' ' . ($r->kode_kelas ?? '')));
                if (preg_match('/\b(XII|XI|VIII|VII|III|IV|IX|VI|II|X|V|I)\b/', $kls, $mRoman)) {
                    $romanMap = [
                        'I' => '1', 'II' => '2', 'III' => '3', 'IV' => '4', 'V' => '5', 'VI' => '6',
                        'VII' => '7', 'VIII' => '8', 'IX' => '9', 'X' => '10', 'XI' => '11', 'XII' => '12'
                    ];
                    $r->level = $romanMap[$mRoman[1]] ?? $mRoman[1];
                } elseif (preg_match('/\b(1[0-2]|[1-9])\b/', $kls, $mNum)) {
                    $r->level = $mNum[1];
                } elseif (preg_match('/^([0-9]{1,2})/', $kls, $mLead)) {
                    $r->level = (string)(int)$mLead[1];
                }
            }
        }
        return $results;
    }

    public function getDataJadwalByMapel($tp, $smt, $mapel = null) {
        $builder = $this->db->table('cbt_bank_soal a');
        $builder->select('b.id_jadwal, b.jam_ke, b.tgl_mulai, b.tgl_selesai,'
            .' a.bank_kode, a.bank_level, a.bank_kelas,'
            .' a.id_bank, a.bank_guru_id, a.soal_agama, c.kode_jenis, c.nama_jenis,'
            .' d.id_mapel, d.kode, d.nama_mapel, f.id_guru, f.nama_guru');
        
        if ($mapel != null) $builder->where('a.bank_mapel_id', $mapel);
        $builder->where('a.id_tp', $tp);
        $builder->where('a.id_smt', $smt);
        $builder->join('cbt_jadwal b', 'a.id_bank=b.id_bank', "left");
        $builder->join('cbt_jenis c', 'c.id_jenis=b.id_jenis', "left");
        $builder->join('master_mapel d', 'd.id_mapel=a.bank_mapel_id', "left");
        $builder->join('master_guru f', 'f.id_guru=a.bank_guru_id', "left");
        $query = $builder->get();
        return $query->getResult();
    }

    public function getSettingKopBeritaAcara() {
        $builder = $this->db->table('cbt_kop_berita a');
        $builder->select('a.*, d.logo_kanan, d.logo_kiri, d.kepsek, d.nip, d.tanda_tangan, d.sekolah');
        $builder->join('setting d', 'd.id_setting=1', 'left');
        return $builder->get()->getRow();
    }

    public function getAllKodeSesi() {
        $builder = $this->db->table('cbt_sesi');
        $builder->select('id_sesi, nama_sesi, kode_sesi, waktu_mulai, waktu_akhir');
        $result = $builder->get()->getResult();
        $ret = [];
        if ($result) {
            foreach ($result as $row) {
                $ret[$row->kode_sesi] = $row;
            }
        }
        return $ret;
    }

    public function getAllPesertaByRuang($id_tp, $id_smt) {
        $builder = $this->db->table('cbt_sesi_siswa a');
        $builder->select('b.id_siswa, b.nama, b.nis, b.nisn, b.username, b.password, b.foto, f.level_id,'.
            ' f.nama_kelas, f.kode_kelas, f.id_kelas,'.
            ' d.nama_ruang, d.kode_ruang, d.id_ruang,'.
            ' e.kode_sesi, e.nama_sesi, a.sesi_id as id_sesi,'.
            ' g.nomor_peserta');

        $builder->where('a.tp_id', $id_tp);
        $builder->where('a.smt_id', $id_smt);

        $builder->join('master_siswa b', 'b.id_siswa=a.siswa_id', 'left');
        $builder->join('cbt_ruang d', 'd.id_ruang=a.ruang_id', 'left');
        $builder->join('cbt_nomor_peserta g', 'g.id_siswa=a.siswa_id AND g.id_tp='.$id_tp. ' AND g.id_smt='.$id_smt, 'left');
        $builder->join('cbt_sesi e', 'e.id_sesi=a.sesi_id', 'left');

        $builder->join('kelas_siswa c', 'c.id_siswa=b.id_siswa AND c.id_tp='.$id_tp.' AND c.id_smt='.$id_smt, 'left');
        $builder->join('master_kelas f', 'f.id_kelas=c.id_kelas', 'left');

        $builder->orderBy('d.kode_ruang', 'ASC');
        $builder->orderBy('e.kode_sesi', 'ASC');
        $builder->orderBy('f.level_id', 'ASC');
        $builder->orderBy('f.kode_kelas', 'ASC');
        $builder->orderBy('b.nama', 'ASC');

        $result = $builder->get()->getResult();
        $ret = [];
        $unassigned = [];

        foreach ($result as $row) {
            if (!empty($row->id_ruang) && !empty($row->kode_ruang)) {
                $ruangKey = $row->kode_ruang;
                $sesiKey  = !empty($row->kode_sesi) ? $row->kode_sesi : (!empty($row->nama_sesi) ? $row->nama_sesi : 'Sesi 1');
                $ret[$ruangKey][$sesiKey][] = $row;
            } else {
                $sesiKey = !empty($row->kode_sesi) ? $row->kode_sesi : (!empty($row->nama_sesi) ? $row->nama_sesi : '-');
                $unassigned['Belum Diatur'][$sesiKey][] = $row;
            }
        }

        if (!empty($ret)) {
            ksort($ret, SORT_NATURAL);
            foreach ($ret as &$sesis) {
                ksort($sesis, SORT_NATURAL);
                foreach ($sesis as &$students) {
                    usort($students, function($a, $b) {
                        if (!empty($a->nomor_peserta) && !empty($b->nomor_peserta)) {
                            return strnatcasecmp($a->nomor_peserta, $b->nomor_peserta);
                        }
                        if (!empty($a->nomor_peserta)) return -1;
                        if (!empty($b->nomor_peserta)) return 1;
                        return strnatcasecmp($a->nama ?? '', $b->nama ?? '');
                    });
                }
            }
            unset($sesis, $students);
        }

        if (!empty($unassigned)) {
            foreach ($unassigned as $k => $sesis) {
                foreach ($sesis as &$students) {
                    usort($students, function($a, $b) {
                        if (!empty($a->nomor_peserta) && !empty($b->nomor_peserta)) {
                            return strnatcasecmp($a->nomor_peserta, $b->nomor_peserta);
                        }
                        if (!empty($a->nomor_peserta)) return -1;
                        if (!empty($b->nomor_peserta)) return 1;
                        return strnatcasecmp($a->nama ?? '', $b->nama ?? '');
                    });
                }
                unset($students);
                $ret[$k] = $sesis;
            }
        }

        return $ret;
    }

    public function getAllPesertaByKelas($id_tp, $id_smt) {
        $builder = $this->db->table('kelas_siswa c');
        $builder->select('b.id_siswa, b.nama, b.nis, b.nisn, b.username, b.password, b.foto,'.
            ' f.nama_kelas, f.kode_kelas,'.
            ' d.nama_ruang, d.kode_ruang,'.
            ' e.kode_sesi, e.nama_sesi,'.
            ' g.nomor_peserta');

        $builder->where('c.id_tp', $id_tp);
        $builder->where('c.id_smt', $id_smt);
        $builder->join('master_siswa b', 'b.id_siswa=c.id_siswa', 'left');
        $builder->join('master_kelas f', 'f.id_kelas=c.id_kelas', 'left');
        $builder->join('cbt_sesi_siswa a', 'a.siswa_id=b.id_siswa AND a.tp_id='.$id_tp.' AND a.smt_id='.$id_smt, 'left');
        $builder->join('cbt_ruang d', 'd.id_ruang=a.ruang_id', 'left');
        $builder->join('cbt_nomor_peserta g', 'g.id_siswa=b.id_siswa AND g.id_tp='.$id_tp.' AND g.id_smt='.$id_smt, 'left');
        $builder->join('cbt_sesi e', 'e.id_sesi=a.sesi_id', 'left');

        $builder->orderBy('f.level_id', 'ASC');
        $builder->orderBy('f.kode_kelas', 'ASC');
        $builder->orderBy('b.nama', 'ASC');

        $result = $builder->get()->getResult();
        $ret = [];
        foreach ($result as $row) {
            $ret[$row->kode_kelas ?? '-'][] = $row;
        }
        foreach ($ret as &$students) {
            usort($students, function($a, $b) {
                if (!empty($a->nomor_peserta) && !empty($b->nomor_peserta)) {
                    return strnatcasecmp($a->nomor_peserta, $b->nomor_peserta);
                }
                if (!empty($a->nomor_peserta)) return -1;
                if (!empty($b->nomor_peserta)) return 1;
                return strnatcasecmp($a->nama ?? '', $b->nama ?? '');
            });
        }
        unset($students);

        return $ret;
    }

public function getJadwalByJenis($tp, $smt, $jenis, $dari = null, $sampai = null, $level = null) {
        $builder = $this->db->table('cbt_jadwal a');
        $builder->select('a.id_jadwal, a.id_bank, a.id_jenis, a.tgl_mulai, a.tgl_selesai, a.jam_ke,'.
            ' c.bank_kode, c.bank_level, c.bank_kelas, b.kode_jenis, b.nama_jenis, d.kode, d.nama_mapel');
        
        $builder->join('cbt_jenis b', 'b.id_jenis=a.id_jenis');
        $builder->join('cbt_bank_soal c', 'c.id_bank=a.id_bank');
        $builder->join('master_mapel d', 'd.id_mapel=c.bank_mapel_id');
        $builder->where('a.id_tp', $tp);
        $builder->where('a.id_smt', $smt);
        $builder->where('a.id_jenis', $jenis);
        if ($level != null) $builder->where('c.bank_level', $level);
        if (!empty($dari)) $builder->where('a.tgl_mulai >=', $dari);
        if (!empty($sampai)) $builder->where('a.tgl_mulai <=', $sampai);
        $builder->orderBy('a.tgl_mulai', 'ASC');
        $builder->orderBy('a.jam_ke', 'ASC');

        return $builder->get()->getResult();
    }


public function getJadwalKelas($tp, $smt) {
        $builder = $this->db->table('cbt_jadwal a');
        $builder->select('a.id_jadwal, a.tgl_mulai, b.bank_kode, b.bank_kelas');
        
        $builder->join('cbt_bank_soal b', 'b.id_bank=a.id_bank');
        $builder->where('a.id_tp', $tp);
        $builder = $this->db->table('cbt_jadwal a');
        $builder->select('a.id_jadwal, a.tgl_mulai, b.bank_kode, b.bank_kelas');
        
        $builder->join('cbt_bank_soal b', 'b.id_bank=a.id_bank');
        $builder->where('a.id_tp', $tp);
        $builder->where('a.id_smt', $smt);
        return $builder->get()->getResult();
    }

public function getPengawasByGuru($tp, $smt, $id_guru) {
        $builder = $this->db->table('cbt_pengawas a');
        $builder->select('a.id_pengawas, a.id_jadwal, a.id_tp, a.id_smt, a.id_ruang, a.id_sesi, a.id_guru, a.jam_ke,'.
            ' b.id_jadwal, b.tgl_mulai, b.tgl_selesai, c.bank_kode, d.kode_jenis');
        $builder->where('a.id_tp', $tp);
        $builder->where('a.id_smt', $smt);
        $builder->like('a.id_guru', $id_guru);
        $builder->join('cbt_jadwal b', 'b.id_jadwal=a.id_jadwal');
        $builder->join('cbt_bank_soal c', 'b.id_bank=c.id_bank');
        $builder->join('cbt_jenis d', 'd.id_jenis=b.id_jenis', "left");
        return $builder->get()->getResult();
    }

public function getJadwalGuru($tp, $smt, $guru) {
        $builder = $this->db->table('cbt_jadwal a');
        $builder->select('a.id_jadwal, a.tgl_mulai, b.bank_kode, b.bank_kelas');
        if ($guru !== null && $guru !== '') {
            $builder->join('cbt_bank_soal b', 'b.id_bank=a.id_bank AND b.bank_guru_id=' . intval($guru));
        } else {
            $builder->join('cbt_bank_soal b', 'b.id_bank=a.id_bank');
        }
        $builder->where('a.id_tp', $tp);
        $builder->where('a.id_smt', $smt);
        return $builder->get()->getResult();
    }

    public function saveLog($id_siswa, $id_jadwal, $type, $desc) {
        $request = \Config\Services::request();
        $userAgent = $request->getUserAgent();

        if ($userAgent->isBrowser()){
            $agent = $userAgent->getBrowser().' '.$userAgent->getVersion();
        } elseif ($userAgent->isMobile()){
            $agent = $userAgent->getMobile();
        } else {
            $agent = $userAgent->getAgentString() ?: 'Unknown';
        }

        $os = $userAgent->getPlatform() ?: 'Unknown';
        $ip = $request->getIPAddress();
        return $this->insertLog($id_siswa, $id_jadwal, $type, $desc, $agent, $os, $ip);
    }

    private function insertLog($id_siswa, $id_jadwal, $type, $desc, $agent, $os, $ip)
    {
        $db = $this->db;
        $data = [
            'log_time'  => date('Y-m-d H:i:s'),
            'id_siswa'  => $id_siswa,
            'id_jadwal' => $id_jadwal,
            'log_type'  => $type,
            'log_desc'  => $desc,
            'address'   => $ip,
            'agent'     => $agent,
            'device'    => $os,
            'reset'     => '0'
        ];
        return $db->table('log_ujian')->insert($data);
    }

    public function getDataGuru()
    {
        $db = $this->db;
        $builder = $db->table('master_guru a');
        $builder->select('a.id_guru, a.nama_guru, b.id_pengawas, b.id_jadwal, b.jam_ke');
        $builder->join('cbt_pengawas b', 'b.id_guru = a.id_guru', 'left');
        return $builder->get()->getResult();
    }

    public function getToken()
    {
        $db = $this->db;
        return $db->table('cbt_token')->orderBy('id_token', 'ASC')->get()->getRow();
    }

    public function saveToken($data)
    {
        $db = $this->db;
        $dataArr = json_decode(json_encode($data), true);
        $allowed = ['token', 'auto', 'jarak', 'updated'];
        $clean = array_intersect_key($dataArr, array_flip($allowed)); if (isset($clean['token'])) { $clean['token'] = strtoupper(preg_replace('/[\s\x{200B}-\x{200D}\x{FEFF}]+/u', '', (string)$clean['token'])); } $firstTokenRow = $db->table('cbt_token')->orderBy('id_token', 'ASC')->get()->getRow();
        if ($firstTokenRow) {
            $tb = $db->table('cbt_token'); if (isset($firstTokenRow->id_token)) { $tb->where('id_token', $firstTokenRow->id_token); } return $tb->update($clean);
        } else {
            return $db->table('cbt_token')->insert($clean);
        }
    }

    public function getSiswaCbtInfo($id_siswa, $id_tp, $id_smt)
    {
        $db = $this->db;
        $builder = $db->table('kelas_siswa a');
        $builder->select('a.id_kelas_siswa, a.id_tp, a.id_smt, a.id_siswa, a.id_kelas, ' .
            'b.siswa_id, b.kelas_id, b.ruang_id, b.sesi_id, ' .
            'rk.id_ruang, rk.nama_ruang, rk.kode_ruang, ' .
            'sk.id_sesi, sk.nama_sesi, sk.kode_sesi, sk.waktu_mulai, sk.waktu_akhir');
        $builder->join('cbt_sesi_siswa b', 'a.id_siswa=b.siswa_id AND a.id_tp = b.tp_id AND a.id_smt = b.smt_id', 'left');
        $builder->join('cbt_ruang rk', 'b.ruang_id=rk.id_ruang', 'left');
        $builder->join('cbt_sesi sk', 'b.sesi_id=sk.id_sesi', 'left');
        $builder->where('a.id_siswa', $id_siswa);
        $builder->where('a.id_tp', $id_tp);
        $builder->where('a.id_smt', $id_smt);

        return $builder->get()->getRow();
    }

public function getDurasiSiswaByJadwal($id_jadwal, $id_siswa = null) {
        $builder = $this->db->table('cbt_durasi_siswa');
        $builder->select('id_durasi, id_siswa, id_jadwal, status, lama_ujian, mulai, selesai, reset');
        $builder->where('id_jadwal', $id_jadwal);
        if ($id_siswa != null) $builder->where('id_siswa', $id_siswa);
        return $builder->get()->getResult();
    }

public function getLogUjianByJadwal($id_jadwal) {
        $builder = $this->db->table('log_ujian');
        $builder->select('id_log, log_time, id_siswa, id_jadwal, log_type, log_desc, address, agent, device, reset');
        $builder->where('id_jadwal', $id_jadwal);
        return $builder->get()->getResult();
    }

public function getDurasiSiswa($id) {
		return $this->db->table('cbt_durasi_siswa')->where('id_durasi', $id)->get()->getRow();
	}

public function getDataSiswa($username, $id_tp = null, $id_smt = null) {
        $db = $this->db;
        $id_tp = (int)($id_tp ?? 0);
        $id_smt = (int)($id_smt ?? 0);
        $cleanUsername = trim((string)$username);

        $builder = $db->table('master_siswa a');
        $builder->select('a.id_siswa, a.nisn, a.nis, a.nama, a.jenis_kelamin, a.username, a.password, a.agama, a.foto,'.
            ' b.id_kelas_siswa, b.id_tp, b.id_smt, b.id_siswa, b.id_kelas,'.
            ' c.nama_kelas, c.kode_kelas, c.level_id, '.
            ' COALESCE(NULLIF(d.kelas_id, 0), b.id_kelas) as kelas_id, d.ruang_id, d.sesi_id,'.
            ' np.nomor_peserta');

        $builder->join('kelas_siswa b', 'a.id_siswa=b.id_siswa AND b.id_tp='.$id_tp.' AND b.id_smt='.$id_smt, 'left');
        $builder->join('master_kelas c', 'b.id_kelas=c.id_kelas', 'left');
        $builder->join('cbt_sesi_siswa d', 'a.id_siswa=d.siswa_id AND d.tp_id='.$id_tp.' AND d.smt_id='.$id_smt, 'left');
        $builder->join('cbt_nomor_peserta np', 'a.id_siswa=np.id_siswa AND np.id_tp='.$id_tp.' AND np.id_smt='.$id_smt, 'left');
        $builder->groupStart()
            ->where('a.username', $cleanUsername)
            ->orWhere('a.nis', $cleanUsername)
            ->orWhere('a.nisn', $cleanUsername)
        ->groupEnd();

        $result = $builder->get()->getRow();
        if ($result) {
            return $result;
        }

        // Fallback: cari ke master_siswa tanpa syarat kelas/sesi jika siswa belum di-mapping
        $fallback = $db->table('master_siswa a')
            ->select('a.id_siswa, a.nisn, a.nis, a.nama, a.jenis_kelamin, a.username, a.password, a.agama, a.foto')
            ->groupStart()
                ->where('a.username', $cleanUsername)
                ->orWhere('a.nis', $cleanUsername)
                ->orWhere('a.nisn', $cleanUsername)
            ->groupEnd()
            ->get()->getRow();

        if ($fallback) {
            $fallback->id_kelas_siswa = null;
            $fallback->id_tp = $id_tp;
            $fallback->id_smt = $id_smt;
            $fallback->id_kelas = null;
            $fallback->nama_kelas = '-';
            $fallback->kode_kelas = '-';
            $fallback->level_id = null;
            $fallback->kelas_id = null;
            $fallback->ruang_id = null;
            $fallback->sesi_id = null;
            $fallback->nomor_peserta = null;
            return $fallback;
        }

        return null;
    }


public function getDistinctKelasLevel($tp, $smt, $arrLevel) {
        $builder = $this->db->table('master_kelas');
        $builder->select('id_kelas, level_id');
        $builder->distinct();
        
        $builder->where('id_tp', $tp);
        $builder->where('id_smt', $smt);
        $builder->whereIn('level_id', $arrLevel);
        return $builder->get()->getResult();
    }

    public function getAllBankSoalByMapel($id_tp, $id_smt, $mapel, $guru = null) {
        $builder = $this->db->table('cbt_bank_soal a');
        $builder->select('a.id_bank, a.bank_kode, a.bank_kelas, a.bank_mapel_id, a.tampil_pg, a.tampil_kompleks,'.
            ' a.tampil_jodohkan, a.tampil_isian, a.tampil_esai, a.status, b.id_jadwal');
        $builder->join('cbt_jadwal b', 'b.id_bank=a.id_bank', 'left');
        $builder->where('a.id_tp', $id_tp);
        $builder->where('a.id_smt', $id_smt);
        $builder->where('a.bank_mapel_id', $mapel);
        $builder->where('a.status', '1');
        if ($guru) {
            $builder->where('a.bank_guru_id', $guru);
        }
        $result = $builder->get()->getResult();
        $ret = [];
        if ($result) {
            foreach ($result as $key => $row) {
                $ret[$row->id_bank] = $row;
            }
        }
        return $ret;
    }

    public function getJawabanByBank($id_bank, $id_siswa = null) {
        $builder = $this->db->table('cbt_siswa');
        $builder->where('id_bank', $id_bank);
        if ($id_siswa != null) {
            $builder->where('id_siswa', $id_siswa);
        }
        $cbt_siswa = $builder->get()->getResult();

        if (empty($cbt_siswa)) {
            $builder2 = $this->db->table('cbt_rekap_siswa');
            $builder2->where('id_bank', $id_bank);
            if ($id_siswa != null) {
                $builder2->where('id_siswa', $id_siswa);
            }
            $cbt_siswa = $builder2->get()->getResult();
        }

        $all_jawaban = [];
        foreach ($cbt_siswa as $row) {
            $idSiswa = $row->id_siswa;
            $jawabanArr = [];
            if (!empty($row->jawaban)) {
                $jawabanArr = is_string($row->jawaban) ? (json_decode($row->jawaban) ?? @unserialize($row->jawaban)) : $row->jawaban;
            }
            if (is_array($jawabanArr) || is_object($jawabanArr)) {
                foreach ($jawabanArr as $jwb) {
                    $jwbObj = (object)$jwb;
                    $jwbObj->id_siswa = $idSiswa;
                    $jwbObj->jenis_soal = $jwbObj->jenis ?? $jwbObj->jenis_soal ?? '1';
                    $jwbObj->nomor_soal = $jwbObj->no_soal_alias ?? $jwbObj->nomor_soal ?? 1;
                    $all_jawaban[] = $jwbObj;
                }
            }
        }
        return $all_jawaban;
    }

    public function getSoalByBank($id_bank) {
        $builder = $this->db->table('cbt_soal');
        $builder->select('id_soal, bank_id as id_bank, mapel_id, jenis, nomor_soal, soal, opsi_a, opsi_b, opsi_c, opsi_d, opsi_e, jawaban');
        $builder->where('bank_id', $id_bank);
        $builder->orderBy('jenis', 'ASC');
        $builder->orderBy('nomor_soal', 'ASC');
        $result = $builder->get()->getResult();

        $ret = [];
        foreach ($result as $row) {
            $ret[$row->jenis][$row->nomor_soal] = $row;
        }
        return $ret;
    }

    public function getAllNilaiSiswa($id_jadwal) {
        $builder = $this->db->table('cbt_siswa');
        $builder->where('id_jadwal', $id_jadwal);
        $result = $builder->get()->getResult();

        if (empty($result)) {
            $builder2 = $this->db->table('cbt_rekap_siswa');
            $builder2->where('id_jadwal', $id_jadwal);
            $result = $builder2->get()->getResult();
        }

        $retur = [];
        foreach ($result as $row) {
            $nilaiInput = [];
            if (!empty($row->nilai_input)) {
                $nilaiInput = is_string($row->nilai_input) ? (json_decode($row->nilai_input) ?? @unserialize($row->nilai_input)) : $row->nilai_input;
            }
            $nilaiObj = (object)$nilaiInput;
            $nilaiObj->id_siswa = $row->id_siswa;
            $nilaiObj->id_jadwal = $row->id_jadwal;

            if (!isset($nilaiObj->pg_benar)) {
                $jawabanArr = is_string($row->jawaban) ? (json_decode($row->jawaban) ?? @unserialize($row->jawaban)) : $row->jawaban;
                $pgBenar = 0;
                if (is_array($jawabanArr) || is_object($jawabanArr)) {
                    foreach ($jawabanArr as $jw) {
                        $jObj = (object)$jw;
                        if (($jObj->jenis ?? $jObj->jenis_soal ?? '1') == '1') {
                            if (strtoupper($jObj->jawaban_siswa ?? '') == strtoupper($jObj->jawaban_benar ?? '')) {
                                $pgBenar++;
                            }
                        }
                    }
                }
                $nilaiObj->pg_benar = $pgBenar;
            }
            $retur[$row->id_siswa] = $nilaiObj;
        }
        return $retur;
    }

    public function getNilaiSiswaByJadwal($id_jadwal, $id_siswa) {
        $builder = $this->db->table('cbt_siswa');
        $builder->where('id_jadwal', $id_jadwal);
        $builder->where('id_siswa', $id_siswa);
        $row = $builder->get()->getRow();

        if (!$row) {
            $builder2 = $this->db->table('cbt_rekap_siswa');
            $builder2->where('id_jadwal', $id_jadwal);
            $builder2->where('id_siswa', $id_siswa);
            $row = $builder2->get()->getRow();
        }

        if ($row && !empty($row->nilai_input)) {
            $nilaiInput = is_string($row->nilai_input) ? (json_decode($row->nilai_input) ?? @unserialize($row->nilai_input)) : $row->nilai_input;
            return (object)$nilaiInput;
        }
        return null;
    }

    public function getJawabanSiswa($id) {
        $builder = $this->db->table('cbt_siswa');
        $builder->where('id_cbt_siswa', $id);
        $row = $builder->get()->getRow();
        if (!$row) {
            $builder2 = $this->db->table('cbt_rekap_siswa');
            $builder2->where('id_rekap_siswa', $id);
            $row = $builder2->get()->getRow();
        }
        return $row;
    }

    public function getSiswaByKelas($id_tp, $id_smt, $kelas) {
        $builder = $this->db->table('kelas_siswa a');
        $builder->select('a.id_siswa, a.id_kelas, b.nama, b.nis, b.nisn, b.username, b.password, b.foto, b.agama,'.
            ' f.nama_kelas, f.kode_kelas,'.
            ' ss.ruang_id, ss.sesi_id,'.
            ' cr.kode_ruang, cr.nama_ruang,'.
            ' cs.kode_sesi, cs.nama_sesi, cs.istirahat,'.
            ' np.nomor_peserta');
        $builder->join('master_siswa b', 'b.id_siswa=a.id_siswa', 'left');
        $builder->join('master_kelas f', 'f.id_kelas=a.id_kelas', 'left');
        $builder->join('cbt_sesi_siswa ss', 'ss.siswa_id=a.id_siswa AND ss.tp_id='.$id_tp.' AND ss.smt_id='.$id_smt, 'left');
        $builder->join('cbt_ruang cr', 'cr.id_ruang=ss.ruang_id', 'left');
        $builder->join('cbt_sesi cs', 'cs.id_sesi=ss.sesi_id', 'left');
        $builder->join('cbt_nomor_peserta np', 'np.id_siswa=a.id_siswa AND np.id_tp='.$id_tp.' AND np.id_smt='.$id_smt, 'left');
        if (is_array($kelas)) {
            if (count($kelas) > 0) {
                $builder->whereIn('a.id_kelas', $kelas);
            }
        } else if (!empty($kelas)) {
            $builder->where('a.id_kelas', $kelas);
        }
        $builder->where('a.id_tp', $id_tp);
        $builder->where('a.id_smt', $id_smt);
        $builder->orderBy('b.nama', 'ASC');
        return $builder->get()->getResult();
    }

    public function getLogUjian($siswa_id, $id_jadwal) {
        $builder = $this->db->table('log_ujian');
        $builder->where('id_siswa', $siswa_id);
        $builder->where('id_jadwal', $id_jadwal);
        return $builder->get()->getResult();
    }
}
