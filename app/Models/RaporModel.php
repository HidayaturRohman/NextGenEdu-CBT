<?php
namespace App\Models;
/**
 * Created by IntelliJ IDEA.
 * User: Hidayatur Rohman
 * Date: 01/08/20
 * Time: 16:10
 */

class RaporModel extends \CodeIgniter\Model {
    protected $table = 'dummy_table';

    public function getKikdMapel($id, $id_tp, $id_smt) {
        return $this->db->table('rapor_kikd')->where('id_kikd', $id)->where('id_tp', $id_tp)->where('id_smt', $id_smt)->get()->getRow();
    }

    public function getKikdMapelKelas($id_mapel, $id_kelas, $id_tp, $id_smt) {
        $builder = $this->db->table('rapor_kikd');
        $builder->where('id_mapel_kelas', $id_mapel.$id_kelas)
            //->where('id_kelas', $id_kelas)
            ->where('id_tp', $id_tp)
            ->where('id_smt', $id_smt);
        return $builder->get()->getResult();
    }

    public function getKkm($id) {
        return $this->db->table('rapor_kkm')->where('id_kkm', $id)->get()->getRow();
    }

    public function getArrKkm($ids) {
        $builder = $this->db->table('rapor_kkm');
        $builder->whereIn('id_kkm', $ids);
        $result = $builder->get()->getResult();
        $ret = [];
        if ($result) {
            foreach ($result as $key => $row) {
                $ret [$row->id_mapel] = $row;
            }
        }
        return $ret;
    }
    public function getRaporSetting($id_tp, $id_smt) {
        return $this->db->table('rapor_admin_setting')->where('id_tp', $id_tp)->where('id_smt', $id_smt)->get()->getRow();
    }

    public function getDetailSiswa($id_kelas, $id_tp, $id_smt){
        $this->db->query('SET SQL_BIG_SELECTS=1');
        $builder = $this->db->table('kelas_siswa a')->select('a.*, b.*, c.*');
        $builder->join('master_siswa b', 'a.id_siswa=b.id_siswa');
        $builder->join('master_kelas c', 'a.id_kelas=c.id_kelas');

        return $builder->where("a.id_kelas", $id_kelas)->where("a.id_tp", $id_tp)->where("a.id_smt", $id_smt)->orderBy('b.nama', 'ASC')->get()->getResult();
    }

    public function getDetailSiswaById($id_siswa, $id_tp, $id_smt){
        $this->db->query('SET SQL_BIG_SELECTS=1');
        $builder = $this->db->table('master_siswa a')->select('a.nama, a.nis, a.nisn, c.nama_kelas');
        $builder->join('kelas_siswa b', 'a.id_siswa=b.id_siswa');
        $builder->join('master_kelas c', 'b.id_kelas=c.id_kelas');

        return $builder->where("a.id_siswa", $id_siswa)->where("b.id_tp", $id_tp)->where("b.id_smt", $id_smt)->orderBy('a.nama', 'ASC')->get()->getRow();
    }

    public function cekNilaiHarianKelas($id_mapel, $id_kelas, $id_tp, $id_smt) {
        $builder = $this->db->table('rapor_nilai_harian')->select('p_rata_rata');
        return $builder->where('id_mapel', $id_mapel)->where('id_kelas', $id_kelas)->where('id_tp', $id_tp)->where('id_smt', $id_smt)->where('p_rata_rata !=', 'NULL')->get()->getNumRows();
    }

    public function getNilaiHarianKelas($id_mapel, $id_kelas, $id_siswa, $id_tp, $id_smt) {
        $builder = $this->db->table('rapor_nilai_harian')->select('*');
        return $builder->where('id_nilai_harian', $id_mapel.$id_kelas.$id_siswa.$id_tp.$id_smt)->get()->getRow();
    }

    public function getAllNilaiHarianKelas($id_mapel, $id_kelas, $id_tp, $id_smt) {
        $builder = $this->db->table('rapor_nilai_harian')->select('*');
        $result = $builder->where('id_mapel', $id_mapel)->where('id_kelas', $id_kelas)->where('id_tp', $id_tp)->where('id_smt', $id_smt)->get()->getResult();
        $ret = [];
        if ($result) {
            foreach ($result as $row) {
                $ret[$row->id_siswa] = $row;
            }
        }
        return $ret;

    }

    public function cekNilaiPtsKelas($id_mapel, $id_kelas, $id_tp, $id_smt) {
        $builder = $this->db->table('rapor_nilai_pts')->select('predikat');
        return $builder->where('id_mapel', $id_mapel)->where('id_kelas', $id_kelas)->where('id_tp', $id_tp)->where('id_smt', $id_smt)->where('predikat !=', 'NULL')->countAllResults();
    }

    public function getIdNilaiPts($arr_id) {
        $builder = $this->db->table('rapor_nilai_pts')->select('id_nilai_pts');
        $result = $builder->whereIn('id_nilai_pts', $arr_id)->get()->getResult();
        $ret = [];
        if ($result) {
            foreach ($result as $key => $row) {
                $ret [$row->id_nilai_pts] = $row;
            }
        }
        return $ret;
    }

    public function getNilaiPtsKelas($id_mapel, $id_kelas, $id_siswa, $id_tp, $id_smt) {
        $builder = $this->db->table('rapor_nilai_pts')->select('*');
        return $builder->where('id_nilai_pts', $id_mapel.$id_kelas.$id_siswa.$id_tp.$id_smt)->get()->getResult();
    }

    public function getAllNilaiPtsKelas($id_mapel, $id_kelas, $id_tp, $id_smt) {
        $builder = $this->db->table('rapor_nilai_pts')->select('*');
        $result = $builder->where('id_mapel', $id_mapel)->where('id_kelas', $id_kelas)->where('id_tp', $id_tp)->where('id_smt', $id_smt)->get()->getResult();
        $ret = [];
        if ($result) {
            foreach ($result as $row) {
                $ret[$row->id_siswa] = $row;
            }
        }
        return $ret;
    }

    public function getEkstraKelas($id_mapel, $id_siswa, $id_tp, $id_smt) {
        $builder = $this->db->table('rapor_nilai_ekstra')->select('nilai, predikat, deskripsi');
        return $builder->where('id_ekstra', $id_mapel)->where('id_siswa', $id_siswa)->where('id_tp', $id_tp)->where('id_smt', $id_smt)->get()->getResult();
    }

    public function cekNilaiEkstraKelas($id_mapel, $id_kelas, $id_tp, $id_smt) {
        $builder = $this->db->table('rapor_nilai_ekstra')->select('id_nilai_ekstra');
        return $builder->where('id_ekstra', $id_mapel)->where('id_kelas', $id_kelas)->where('id_tp', $id_tp)->where('id_smt', $id_smt)->get()->getNumRows();
    }

    public function getNilaiEkstraKelas($id_ekstra, $id_kelas, $id_siswa, $id_tp, $id_smt) {
        $builder = $this->db->table('rapor_nilai_ekstra')->select('*');
        return $builder->where('id_nilai_ekstra', $id_ekstra.$id_kelas.$id_siswa.$id_tp.$id_smt)->get()->getRow();
    }

    public function getAllNilaiEkstraKelas($id_ekstra, $id_kelas, $id_tp, $id_smt) {
        $builder = $this->db->table('rapor_nilai_ekstra')->select('*');
        $result = $builder->where('id_ekstra', $id_ekstra)->where('id_kelas', $id_kelas)->where('id_tp', $id_tp)->where('id_smt', $id_smt)->get()->getResult();
        $ret = [];
        if ($result) {
            foreach ($result as $row) {
                $ret[$row->id_siswa] = $row;
            }
        }
        return $ret;
    }

    public function cekNilaiAkhirKelas($id_mapel, $id_kelas, $id_tp, $id_smt) {
        $builder = $this->db->table('rapor_nilai_akhir')->select('id_nilai_akhir');
        return $builder->where('id_mapel', $id_mapel)->where('id_kelas', $id_kelas)->where('id_tp', $id_tp)->where('id_smt', $id_smt)->countAllResults();
    }

    public function getNilaiAkhirKelas($id_mapel, $id_kelas, $id_siswa, $id_tp, $id_smt) {
        $this->db->query('SET SQL_BIG_SELECTS=1');
        $builder = $this->db->table('rapor_nilai_harian a')->select('a.p_rata_rata as nhar, a.p_deskripsi, a.k_rata_rata, a.k_predikat, a.k_deskripsi, b.nilai as npts, c.nilai as npas, c.predikat');
        return $builder->join('rapor_nilai_pts b', 'b.id_nilai_pts=a.id_nilai_harian', 'left')->join('rapor_nilai_akhir c', 'c.id_nilai_akhir=a.id_nilai_harian', 'left')->where('a.id_nilai_harian', $id_mapel.$id_kelas.$id_siswa.$id_tp.$id_smt)->get()->getRow();
    }

    public function getAllNilaiAkhirKelas($id_mapel, $id_kelas, $id_tp, $id_smt) {
        $this->db->query('SET SQL_BIG_SELECTS=1');
        $builder = $this->db->table('rapor_nilai_harian a')->select('a.id_siswa, a.p_rata_rata as nhar, a.p_deskripsi, a.k_rata_rata, a.k_predikat, a.k_deskripsi, b.nilai as npts, c.nilai as npas, c.predikat');
        $result = $builder->join('rapor_nilai_pts b', 'b.id_nilai_pts=a.id_nilai_harian', 'left')->join('rapor_nilai_akhir c', 'c.id_nilai_akhir=a.id_nilai_harian', 'left')->where('a.id_mapel', $id_mapel)->where('a.id_kelas', $id_kelas)->where('a.id_tp', $id_tp)->where('a.id_smt', $id_smt)->get()->getResult();
        $ret = [];
        if ($result) {
            foreach ($result as $row) {
                $ret[$row->id_siswa] = $row;
            }
        }
        return $ret;
    }

    public function getNilaiAkhirByMapel($id_mapel, $id_kelas, $id_tp, $id_smt) {
        $this->db->query('SET SQL_BIG_SELECTS=1');
        $builder = $this->db->table('rapor_nilai_harian a')->select('a.id_siswa, a.p_rata_rata as nhar, a.p_deskripsi, a.k_rata_rata, a.k_predikat, a.k_deskripsi, b.nilai as npts, c.nilai as npas, c.predikat');
        return $builder->getResult()->join('rapor_nilai_pts b', 'b.id_nilai_pts=a.id_nilai_harian', 'left')->join('rapor_nilai_akhir c', 'c.id_nilai_akhir=a.id_nilai_harian', 'left')->where('a.id_mapel', $id_mapel)->where('a.id_kelas', $id_kelas)->where('a.id_tp', $id_tp)->where('a.id_smt', $id_smt)->get()->getResult();
    }

    public function getDeskripsiSikap($kelas, $id_tp, $id_smt) {
        return $this->db->table('rapor_data_sikap')->where('id_kelas', $kelas)->where('id_tp', $id_tp)->where('id_smt', $id_smt)->get()->getResult();
    }

    public function getAllDeskripsiSikap($kelas) {
        return $this->db->table('rapor_data_sikap')->where('id_kelas', $kelas)->get()->getResult();
    }

    public function getDeskripsiSikapByJenis($kelas, $jenis, $id_tp, $id_smt) {
        $builder = $this->db->table('rapor_data_sikap')->select('*');
        return $builder->where('id_kelas', $kelas)->where('jenis', $jenis)->where('id_tp', $id_tp)->where('id_smt', $id_smt)->get()->getResult();
    }

    public function getNilaiSikapKelas($id_kelas, $id_siswa, $id_tp, $id_smt, $jenis) {
        $builder = $this->db->table('rapor_nilai_sikap')->select('*');
        return $builder->where('id_nilai_sikap', $id_kelas.$id_siswa.$id_tp.$id_smt.$jenis)->get()->getRow();
    }

    public function getAllNilaiSikapKelas($id_kelas) {
        $builder = $this->db->table('rapor_nilai_sikap')->select('*');
        return $builder->where('id_kelas', $id_kelas)->get()->getResult();
    }

    public function getNilaiSikapByJenis($id_kelas, $jenis, $id_tp, $id_smt) {
        $builder = $this->db->table('rapor_nilai_sikap')->select('*');
        return $builder->where('id_kelas', $id_kelas)->where('jenis', $jenis)->where('id_tp', $id_tp)->where('id_smt', $id_smt)->get()->getResult();
    }

    public function getNilaiSikapByKelas($id_kelas, $id_tp, $id_smt) {
        $builder = $this->db->table('rapor_nilai_sikap')->select('*');
        return $builder->where('id_kelas', $id_kelas)->where('id_tp', $id_tp)->where('id_smt', $id_smt)->get()->getResult();
    }

    public function getNilaiSikapBySiswa($id_siswa, $id_tp, $id_smt) {
        $builder = $this->db->table('rapor_nilai_sikap')->select('*');
        return $builder->where('id_siswa', $id_siswa)->where('id_tp', $id_tp)->where('id_smt', $id_smt)->get()->getResult();
    }

    public function getDeskripsiCatatanByJenis($kelas, $jenis, $id_tp, $id_smt) {
        $builder = $this->db->table('rapor_data_catatan');
        $builder->where('jenis', $jenis)->where("id_kelas", $kelas)
            ->where('id_tp', $id_tp)->where('id_smt', $id_smt);
        return $builder->get()->getResult();
    }

    public function getCatatanKelas($id_kelas, $id_siswa, $id_tp, $id_smt) {
        $builder = $this->db->table('rapor_catatan_wali')->select('*');
        return $builder->where('id_catatan_wali', $id_kelas.$id_siswa.$id_tp.$id_smt)->get()->getRow();
    }

    public function getAllCatatanKelas($id_kelas) {
        $builder = $this->db->table('rapor_catatan_wali')->select('*');
        return $builder->where('id_kelas', $id_kelas)->get()->getResult();
    }

    public function getRankingKelas($id_kelas, $id_siswa, $id_tp, $id_smt) {
        $builder = $this->db->table('rapor_prestasi')->select('*');
        return $builder->where('id_ranking', $id_kelas.$id_siswa.$id_tp.$id_smt)->get()->getRow();
    }

    public function getAllRankingKelas($id_kelas) {
        $builder = $this->db->table('rapor_prestasi')->select('*');
        return $builder->where('id_kelas', $id_kelas)->get()->getResult();
    }

    public function getAllDeskripsiFisikKelas() {
        $result = $this->db->table('rapor_data_fisik')->get()->getResult();
        $ret = [];
        if ($result) {
            foreach ($result as $key => $row) {
                $ret [$row->id_kelas][$row->id_tp][$row->id_smt] = $row;
            }
        }
        return $ret;

    }

    public function getAllRaporFisik() {
        $result = $this->db->table('rapor_fisik')->get()->getResult();
        $ret = [];
        if ($result) {
            foreach ($result as $key => $row) {
                $ret [$row->id_siswa][$row->id_tp][$row->id_smt] = $row;
            }
        }
        return $ret;
    }

    public function getDeskripsiFisikKelas($kelas, $id_tp, $id_smt) {
        return $this->db->table('rapor_data_fisik')->where("id_fisik", $kelas)->where('id_tp', $id_tp)->where('id_smt', $id_smt)->get()->getResult();
    }

    public function getFisikKelas($id_kelas, $id_siswa, $id_tp, $id_smt) {
        $builder = $this->db->table('rapor_fisik')->select('*');
        return $builder->where('id_fisik', $id_kelas.$id_siswa.$id_tp.$id_smt)->get()->getRow();
    }

    public function getAllFisikKelas($id_kelas) {
        $builder = $this->db->table('rapor_fisik')->select('*');
        return $builder->where('id_kelas', $id_kelas)->get()->getResult();
    }

    public function getJmlNilaiMapelHarianSiswa($id_mapel, $id_siswa, $id_tp, $id_smt) {
        $builder = $this->db->table('rapor_nilai_harian')->select('p_rata_rata, k_rata_rata, jml');
        return $builder->where('id_mapel', $id_mapel)->where('id_siswa', $id_siswa)->where('id_tp', $id_tp)->where('id_smt', $id_smt)->get()->getRow();
    }

    public function getNilaiMapelHarianSiswa($id_mapel, $id_siswa, $id_tp, $id_smt) {
        $builder = $this->db->table('rapor_nilai_harian')->select('p1,p2,p3,p4,p5,k1,k2,k3,k4,k5');
        return $builder->where('id_mapel', $id_mapel)->where('id_siswa', $id_siswa)->where('id_tp', $id_tp)->where('id_smt', $id_smt)->get()->getRow();
    }

    public function getArrNilaiMapelHarianSiswa($ids_mapel, $ids_siswa, $id_tp, $id_smt) {
        $builder = $this->db->table('rapor_nilai_harian')->select('p1,p2,p3,p4,p5,k1,k2,k3,k4,k5,id_mapel,id_siswa');
        $nilais = $builder->whereIn('id_mapel', $ids_mapel)->whereIn('id_siswa', $ids_siswa)->where('id_tp', $id_tp)->where('id_smt', $id_smt)->get()->getResult();

        $rest = [];
        foreach ($nilais as $nilai) {
            $rest[$nilai->id_siswa][$nilai->id_mapel] = $nilai;
        }
        return $rest;
    }

    public function getNilaiMapelPtsSiswa($id_mapel, $id_siswa, $id_tp, $id_smt) {
        $builder = $this->db->table('rapor_nilai_pts')->select('nilai');
        return $builder->where('id_mapel', $id_mapel)->where('id_siswa', $id_siswa)->where('id_tp', $id_tp)->where('id_smt', $id_smt)->get()->getResult();
    }

    public function getArrNilaiMapelPtsSiswa($ids_mapel, $ids_siswa, $id_tp, $id_smt) {
        $builder = $this->db->table('rapor_nilai_pts')->select('nilai, id_mapel, id_siswa');
        $nilais = $builder->whereIn('id_mapel', $ids_mapel)->whereIn('id_siswa', $ids_siswa)->where('id_tp', $id_tp)->where('id_smt', $id_smt)->get()->getResult();

        $rest = [];
        foreach ($nilais as $nilai) {
            $rest[$nilai->id_siswa][$nilai->id_mapel] = $nilai;
        }
        return $rest;
    }

    public function getNilaiMapelPasSiswa($id_mapel, $id_siswa, $id_tp, $id_smt) {
        $builder = $this->db->table('rapor_nilai_akhir')->select('nilai,akhir');
        return $builder->where('id_mapel', $id_mapel)->where('id_siswa', $id_siswa)->where('id_tp', $id_tp)->where('id_smt', $id_smt)->get()->getResult();
    }

    public function getNilaiRapor($id_mapel, $id_kelas, $id_siswa, $id_tp, $id_smt) {
        $builder = $this->db->table('rapor_nilai_harian a')->select('a.p_rata_rata, a.p_deskripsi, a.k_rata_rata, a.k_predikat, a.k_deskripsi, b.nilai as nilai_pas, b.akhir as nilai, b.predikat');
        $builder->join('rapor_nilai_akhir b', 'b.id_nilai_akhir=a.id_nilai_harian', 'left');

        return $builder->where('a.id_nilai_harian', $id_mapel.$id_kelas.$id_siswa.$id_tp.$id_smt)->get()->getRowArray();
    }

    public function getNilaiMapelByKelas($id_mapel, $id_kelas, $id_tp, $id_smt) {
        $builder = $this->db->table('rapor_nilai_harian a')->select('a.p_rata_rata, a.p_deskripsi, a.k_rata_rata, a.k_predikat, a.k_deskripsi, b.nilai as nilai_pas, b.akhir as nilai, b.predikat');
        $builder->join('rapor_nilai_akhir b', 'b.id_nilai_akhir=a.id_nilai_harian', 'left');

        return $builder->where('a.id_mapel', $id_mapel)->where('a.id_kelas', $id_kelas)->where('a.id_tp', $id_tp)->where('a.id_smt', $id_smt)->get()->getResult();
    }

    public function getNilaiRaporByKelas($id_kelas, $id_tp, $id_smt) {
        $builder = $this->db->table('rapor_nilai_harian a')->select('a.id_nilai_harian, a.id_siswa, a.id_mapel, a.p_rata_rata, a.p_deskripsi, a.k_rata_rata, a.k_predikat, a.k_deskripsi, b.nilai as nilai_pas, b.akhir as nilai, b.predikat');
        $builder->join('rapor_nilai_akhir b', 'b.id_nilai_akhir=a.id_nilai_harian', 'left');

        return $builder->where('a.id_kelas', $id_kelas)->where('a.id_tp', $id_tp)->where('a.id_smt', $id_smt)->get()->getResult();
    }

    public function getPrestasiByKelas($id_kelas, $id_tp, $id_smt) {
        $builder = $this->db->table('rapor_prestasi')->select('id_siswa, ranking, deskripsi as rank_deskripsi, p1, p1_desk, p2, p2_desk, p3, p3_desk');
        $ranks = $builder->where('id_kelas', $id_kelas)->where('id_tp', $id_tp)->where('id_smt', $id_smt)->get()->getResult();

        $rest = [];
        foreach ($ranks as $rank) {
            $rest[$rank->id_siswa] = $rank;
        }
        return $rest;
    }

    public function getCatatanWaliByKelas($id_kelas, $id_tp, $id_smt) {
        $builder = $this->db->table('rapor_catatan_wali')->select('id_siswa, nilai, deskripsi as saran');
        $desks = $builder->where('id_kelas', $id_kelas)->where('id_tp', $id_tp)->where('id_smt', $id_smt)->get()->getResult();

        $rest = [];
        foreach ($desks as $desk) {
            $rest[$desk->id_siswa] = $desk;
        }
        return $rest;

    }

    public function getRaporDeskripsi($id_kelas, $id_siswa, $id_tp, $id_smt) {
        $builder = $this->db->table('rapor_prestasi b');
        $builder->select('b.ranking, b.deskripsi as rank_deskripsi, b.p1, b.p1_desk, b.p2, b.p2_desk, b.p3, b.p3_desk,'.
            ' c.nilai, c.deskripsi as saran');
        $builder = $builder;
        $builder->join('rapor_catatan_wali c', 'c.id_catatan_wali=b.id_ranking', 'left');

        return $builder->where('b.id_ranking', $id_kelas.$id_siswa.$id_tp.$id_smt)->get()->getResult();
    }

    public function getDummyDeskripsiSpiritual() {
        return [
            'berdoa sebelum dan sesudah melakukan kegiatan',
            'menjalankan ibadah sesuai dengan agamanya',
            'memberi salam pada saat awal dan akhir kegiatan',
            'bersyukur atas nikmat dan karunia Tuhan Yang Maha Esa',
            'mensyukuri kemampuan manusia dalam mengendalikan diri',
            'bersyukur ketika berhasil mengerjakan sesuatu',
            'berserah diri (tawakal) kepada Tuhan setelah berikhtiar atau melakukan usaha',
            'memelihara hubungan baik dengan sesama umat',
            'bersyukur sebagai bangsa Indonesia',
            'menghormati orang lain yang menjalankan ibadah sesuai dengan agamanya'];
    }

    public function getDummyDeskripsiSosial() {
        return [
            'jujur', 'disiplin', 'tanggung jawab', 'santun', 'percaya diri', 'peduli',
            'toleransi', 'gotong royong', 'rajin', 'tidak mudah menyerah'];
    }

    public function getDummyDeskripsiAbsensi() {
        return [
            'Kehadiran cukup baik namun perlu ditingkatkan.',
            'Usahakan hadir setiap hari.',
            'Jangan terlalu banyak alpa, diharapkan selalu hadir ke sekolah',
            'Kehadiranmu sangat jarang sekali'
        ];
    }

    public function getDummyDeskripsiCatatan() {
        return [
            'Selalu berusaha untuk mematuhi tata tertib sekolah dan patuh terhadap Guru.',
            'Selalu berusaha untuk mandiri dan tepat waktu dalam mengerjakan tugas.',
            'Mempunyai kemampuan dan motivasi yang tinggi untuk menggunakan waktu secara efisien.',
            'Diharapkan merubah penampilannya menjadi lebih rapi, seperti tentang potong rambut dan cara berpakaian.',
            'Masih perlu memperbanyak teman bergaul dan teman diskusi, kurangi aktifitas menyendiri.',
            'Diharapkan dapat meningkatkan komitmennya untuk lebih serius saat mengerjakan tugas dan tidak mudah menyerah.'];
    }

    public function getDummyDeskripsiRanking() {
        return [
            'Prestasinya sangat baik, perlu dipertahankan.',
            'Prestasi baik, perlu dipertahankan dan dtingkatkan.',
            'Prestasi cukup, perlu ditingkatkan belajar dan berdoa.',
            'Perlu ditingkatkan belajarnya, jangan lupa berdoa.',
            'Perlu dimaksimalkan belajarnya, usaha keras dan berdoa.',
            'Perlu usaha keras, maksimalkan belajarnya, lebih giat berdoa dan beribadah.'];
    }

    public function getDummyDeskripsiFisik($jenis) {
        //jenis: 1=pendengaran, 2=penglihatan, 3=gigi, 4=lain-lain
        if ($jenis == '1') return ['Baik', 'Kurang peka', 'Telinga perlu dibersihkan', ''];
        elseif ($jenis == '2') return ['Baik', 'Sering berair', 'Kurang jelas jika melihat jarak jauh', ''];
        elseif ($jenis == '3') return ['Baik, nampak putih dan bersih', 'Terdapat gigi yang gigis', 'Kebersihan gigi kurang terjaga', 'Ada gigi yang mau tanggal',];
        else return ['Tubuh sehat dan kuat', 'Mudah kecapekan', 'Kebersihan badan kurang terjaga', ''
        ];
    }

    public function getKenaikanSiswa($id_kelas, $id_tp, $id_smt, $level = null){
        $this->db->query('SET SQL_BIG_SELECTS=1');
        $builder = $this->db->table('kelas_siswa a')->select('a.*, b.nama, b.nis, b.nisn, b.username, c.id_kelas, c.nama_kelas, c.level_id, d.naik');
        $builder->join('master_siswa b', 'a.id_siswa=b.id_siswa', 'left');
        $builder->join('master_kelas c', 'a.id_kelas=c.id_kelas', 'left');
        $builder->join('rapor_naik d', 'a.id_siswa=d.id_siswa AND a.id_tp=d.id_tp AND a.id_smt=d.id_smt', 'left');

        if ($level!=null) {
            $builder->where("c.level_id", $level);
        }
        if ($id_kelas!=null) {
            $builder->where("a.id_kelas", $id_kelas);
        }
        return $builder->where("a.id_tp", $id_tp)->where("a.id_smt", $id_smt)->get()->getResult();
    }

    public function getSiswaLulus($id_tp, $id_smt, $level){
        $this->db->query('SET SQL_BIG_SELECTS=1');
        $builder = $this->db->table('kelas_siswa a')->select('b.*, c.nama_kelas as kelas_akhir, d.naik');
        $builder->join('master_siswa b', 'a.id_siswa=b.id_siswa', 'left');
        $builder->join('master_kelas c', 'a.id_kelas=c.id_kelas', 'left');
        $builder->join('rapor_naik d', 'a.id_siswa=d.id_siswa AND a.id_tp=d.id_tp AND a.id_smt=d.id_smt', 'left');

        $builder->where("c.level_id", $level);
        $builder->where("a.id_tp", $id_tp);
        $builder->where("a.id_smt", $id_smt);
        //$builder->where("d.naik !=",  0);
        return $builder->get()->getResult();
    }

    public function getJumlahLulus($id_tp, $id_smt, $level) {
        //$query = $this->db->query('SELECT * FROM my_table');
        //echo $query;
        $this->db->query('SET SQL_BIG_SELECTS=1');
        $builder = $this->db->table('kelas_siswa a')->select('a.*, b.nama, b.nis, b.nisn, b.username, c.id_kelas, c.nama_kelas, c.level_id, d.naik');
        $builder->join('master_kelas c', 'a.id_kelas=c.id_kelas', 'left');
        $builder->join('rapor_naik d', 'a.id_siswa=d.id_siswa AND a.id_tp=d.id_tp AND a.id_smt=d.id_smt', 'left');
        $builder->where("c.level_id", $level);
        $builder->where("a.id_tp", $id_tp);
        $builder->where("a.id_smt", $id_smt);
        return $builder->countAllResults();
    }

    public function getKenaikanRapor($id_kelas, $id_tp, $id_smt){
        $builder = $this->db->table('kelas_siswa a')->select('a.id_kelas, a.id_siswa, d.naik');
        $builder->join('rapor_naik d', 'a.id_siswa=d.id_siswa AND a.id_tp=d.id_tp AND a.id_smt=d.id_smt', 'left');

        $ress = $builder->where("a.id_kelas", $id_kelas)->where("a.id_tp", $id_tp)->where("a.id_smt", $id_smt)->get()->getResult();
        $ret = [];
        foreach ($ress as $res) {
            $ret[$res->id_siswa] = $res->naik;
        }
        return $ret;
    }

    public function getAllRaporSetting() {
        $result = $this->db->table('rapor_admin_setting')->get()->getResult();
        $ret = [];
        if ($result) {
            foreach ($result as $key => $row) {
                $ret [$row->id_tp][$row->id_smt] = $row;
            }
        }
        return $ret;
    }

    public function getAllKkm() {
        $result = $this->db->table('rapor_kkm')->get()->getResult();
        $ret = [];
        foreach ($result as $res) {
            $ret[$res->id_tp][$res->id_smt][$res->id_kelas][$res->jenis][$res->id_mapel] = $res;
        }
        return $ret;
    }

    public function getAllKkmRaporAkhir($kelas, $id_tp, $id_smt) {
        $builder = $this->db->table('rapor_kkm');
        $builder->where('id_kelas', $kelas)->where('id_tp', $id_tp)->where('id_smt', $id_smt);
        $result = $builder->get()->getResult();
        $ret = [];
        foreach ($result as $res) {
            $ret[$res->jenis][$res->id_mapel] = $res;
        }
        return $ret;
    }

    public function getAllNilaiAkhir() {
        $this->db->query('SET SQL_BIG_SELECTS=1');
        $builder = $this->db->table('rapor_nilai_harian a');
        $builder->select('a.id_tp, a.id_smt, a.id_siswa, a.p_rata_rata as nhar, a.p_deskripsi, a.k_rata_rata,'.
            ' a.k_predikat, a.k_deskripsi, b.nilai as npts, c.nilai as npas, c.predikat');
        $builder = $builder;
        $result = $builder->join('rapor_nilai_pts b', 'b.id_nilai_pts=a.id_nilai_harian', 'left')->join('rapor_nilai_akhir c', 'c.id_nilai_akhir=a.id_nilai_harian', 'left')->get()->getResult();

        $ret = [];
        foreach ($result as $res) {
            $ret[$res->id_tp][$res->id_smt][$res->id_siswa] = $res;
        }
        return $ret;
    }

    public function getDistinctTahunBukuNilai() {
        $builder = $this->db->table('buku_nilai');
        $builder->select('tp');
        $this->db->distinct();
        $result = $builder->get()->getResult();
        $ret = [];
        foreach ($result as $row) {
            $ret[$row->tp] = $row->tp;
        }
        return $ret;
    }

    public function getDistinctSmtBukuNilai() {
        $builder = $this->db->table('buku_nilai');
        $builder->select('smt');
        $this->db->distinct();
        $result = $builder->get()->getResult();
        $ret = [];
        foreach ($result as $row) {
            $ret[$row->smt] = $row->smt;
        }
        return $ret;
    }

    public function getDistinctKelasBukuNilai() {
        $builder = $this->db->table('buku_nilai');
        $builder->select('kelas');
        $this->db->distinct();
        $result = $builder->get()->getResult();
        $ret = [];
        foreach ($result as $row) {
            $ret[$row->kelas] = $row->kelas;
        }
        return $ret;
    }

    public function getFisikBySiswa($id_siswa) {
        $builder = $this->db->table('buku_nilai')->select('tp, fisik');
        $result = $builder->where('id_siswa', $id_siswa)->get()->getResult();
        $ret = [];
        if ($result) {
            foreach ($result as $key => $row) {
                $ret[$row->tp] = $row;
            }
        }
        return $ret;
    }

    public function getDataKumpulanRapor($kelas=null, $tp=null, $smt=null) {
        $builder = $this->db->table('buku_nilai a')->select('*');
        $builder->join('master_siswa b', 'a.id_siswa=b.id_siswa');
        if ($tp != null) $builder->where('a.tp', $tp);
        if ($smt != null) $builder->where('a.smt', $smt);
        if ($kelas != null) $builder->where('a.kelas', $kelas);
        $result = $builder->get()->getResult();
        $ret = [];
        if ($result) {
            foreach ($result as $key => $row) {
                $ret[$row->id_siswa] = $row;
            }
        }
        return $ret;
    }

    public function deleteNilaiRapor() {
        $this->db->table('rapor_nilai_harian')->empty_table();
        $this->db->table('rapor_nilai_akhir')->empty_table();
        $this->db->table('rapor_naik')->empty_table();
        $this->db->table('rapor_nilai_pts')->empty_table();
        $this->db->table('rapor_prestasi')->empty_table();
        $this->db->table('rapor_catatan_wali')->empty_table();
        $this->db->table('rapor_fisik')->empty_table();
        $this->db->table('rapor_nilai_ekstra')->empty_table();
        $this->db->table('rapor_nilai_sikap')->empty_table();
    }

    public function getAllNilaiRapor($ids_siswa = null) {
        $this->db->query('SET SQL_BIG_SELECTS=1');
        $builder = $this->db->table('rapor_nilai_harian a');
        $builder->select('a.id_tp, a.id_smt, a.id_mapel, a.id_siswa, a.p_rata_rata, a.p_predikat, a.p_deskripsi,'.
            ' a.k_rata_rata, a.k_predikat, a.k_deskripsi,'.
            ' b.nilai as nilai_pas, b.akhir as nilai_rapor, b.predikat as rapor_predikat,'.
            ' c.*, d.*, e. nama, e.uid, f.naik,'.
            ' g.nilai as nilai_pts, g.predikat as pts_predikat,'.
            ' h. id_kelas, h.nama_kelas, h.level_id, i.nama_jurusan, k.nama_guru,'.
            ' l.ranking, l.deskripsi as rank_deskripsi, l.p1, l.p1_desk, l.p2, l.p2_desk, l.p3, l.p3_desk,'.
            ' m.nilai as absen, m.deskripsi as saran, n.kondisi, n.tinggi, n.berat, p.kode as mapel');
        $builder = $builder;
        $builder->join('rapor_nilai_akhir b', 'b.id_nilai_akhir=a.id_nilai_harian', 'left');
        $builder->join('master_tp c', 'c.id_tp=a.id_tp', 'left');
        $builder->join('master_smt d', 'd.id_smt=a.id_smt', 'left');
        $builder->join('master_siswa e', 'e.id_siswa=a.id_siswa', 'left');
        $builder->join('rapor_naik f', 'a.id_siswa=f.id_siswa AND a.id_tp=f.id_tp AND a.id_smt=f.id_smt', 'left');
        $builder->join('rapor_nilai_pts g', 'g.id_nilai_pts=a.id_nilai_harian', 'left');

        $builder->join('master_kelas h', 'a.id_kelas=h.id_kelas AND a.id_tp=h.id_tp AND a.id_smt=h.id_smt', 'left');
        $builder->join('master_jurusan i', 'h.jurusan_id=i.id_jurusan', 'left');
        $builder->join('jabatan_guru j', 'a.id_kelas=j.id_kelas AND a.id_tp=j.id_tp AND a.id_smt=j.id_smt', 'left');
        $builder->join('master_guru k', 'j.id_guru=k.id_guru', 'left');

        $builder->join('rapor_prestasi l', 'a.id_siswa=l.id_siswa AND a.id_tp=l.id_tp AND a.id_smt=l.id_smt', 'left');
        $builder->join('rapor_catatan_wali m', 'a.id_siswa=m.id_siswa AND a.id_tp=m.id_tp AND a.id_smt=m.id_smt', 'left');
        $builder->join('rapor_fisik n', 'a.id_siswa=n.id_siswa AND a.id_tp=n.id_tp AND a.id_smt=n.id_smt', 'left');

        $builder->join('master_mapel p', 'a.id_mapel=p.id_mapel', 'left');

        if ($ids_siswa != null) {
            $builder->whereIn('a.id_siswa', $ids_siswa);
        }
        return $builder->get()->getResult();
    }

    public function getAllEkstra() {
        $builder = $this->db->table('kelas_ekstra')->select('*');
        $result = $builder->get()->getResult();
        $ret = [];
        if ($result) {
            foreach ($result as $key => $row) {
                $ret[$row->id_tp][$row->id_smt][$row->id_kelas] = unserialize($row->ekstra ?? '');
            }
        }
        return $ret;
    }

    public function getAllNilaiEkstra($ids_siswa = null) {
        $builder = $this->db->table('rapor_nilai_ekstra a')->select('a.*, b.nama_ekstra, b.kode_ekstra');
        $builder->join('master_ekstra b', 'a.id_ekstra=b.id_ekstra', 'left');
        if ($ids_siswa != null) {
            $builder->whereIn('a.id_siswa', $ids_siswa);
        }
        $result = $builder->get()->getResult();
        $ret = [];
        foreach ($result as $res) {
            $ret[$res->id_tp][$res->id_smt][$res->id_siswa][] = $res;
        }
        return $ret;
    }

    public function getAllNilaiSikap($ids_siswa = null) {
        $builder = $this->db->table('rapor_nilai_sikap')->select('*');
        if ($ids_siswa != null) {
            $builder->whereIn('id_siswa', $ids_siswa);
        }
        $result = $builder->get()->getResult();
        $ret = [];
        foreach ($result as $res) {
            $ret[$res->id_tp][$res->id_smt][$res->id_siswa][$res->jenis] = $res;
        }
        return $ret;
    }

    public function getAllFisik($ids_siswa = null) {
        $builder = $this->db->table('rapor_fisik')->select('id_tp, id_smt, id_siswa, kondisi, tinggi, berat');
        if ($ids_siswa != null) {
            $builder->whereIn('id_siswa', $ids_siswa);
        }
        $result = $builder->get()->getResult();
        $ret = [];
        foreach ($result as $res) {
            $ret[$res->id_siswa][$res->id_tp][$res->id_smt] = $res;
        }
        return $ret;
    }

    function exists($uid, $tp, $smt, $kelas){
        $this->db
            ->where('uid', $uid)
            ->where('tp', $tp)
            ->where('smt', $smt)
            ->where('kelas', $kelas);
        $query = $this->db->table('buku_nilai')->get()->getResult();
        if ($query->getNumRows() > 0){
            return true;
        }
        else{
            return false;
        }
    }
}
