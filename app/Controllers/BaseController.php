<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

abstract class BaseController extends Controller
{
    protected $request;
    protected $helpers = ['form', 'url'];
    protected $logging;
    protected $db;

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);
        
        // Initialize MY_Controller specific properties
        $this->initMyController();
    }

    protected $LOG_TYPE = [];

    protected $default_data = [];

    protected $namaHari = [
        'Sunday' => 'Minggu',
        'Monday' => 'Senin',
        'Tuesday' => 'Selasa',
        'Wednesday' => 'Rabu',
        'Thursday' => 'Kamis',
        'Friday' => 'Jumat',
        'Saturday' => 'Sabtu'
    ];

    protected $namaBulan = [
        'January' => 'Jan',
        'February' => 'Feb',
        'March' => 'Mar',
        'April' => 'Apr',
        'May' => 'Mei',
        'June' => 'Jun',
        'July' => 'Jul',
        'August' => 'Agu',
        'September' => 'Sep',
        'October' => 'Okt',
        'November' => 'Nov',
        'December' => 'Des'
    ];

    protected function initMyController()
    {
        $session = \Config\Services::session();

        $tahun_sekarang = date('Y');
        $bulan_sekarang = date('n'); // 1-12

        if ($bulan_sekarang >= 7) {
            // Semester Ganjil dimulai Juli
            $tahun_ajaran = $tahun_sekarang . '/' . ($tahun_sekarang + 1);
            $semester     = '1'; // atau 'Ganjil'
        } else {
            // Semester Genap dimulai Januari
            $tahun_ajaran = ($tahun_sekarang - 1) . '/' . $tahun_sekarang;
            $semester     = '2'; // atau 'Genap'
        }

        $this->default_data['thn_sekarang'] = $tahun_sekarang;
        $this->default_data['tp_sekarang']  = $tahun_ajaran;
        $this->default_data['smt_sekarang'] = $semester;

        // Make is_admin globally available to all views
        \Config\Services::renderer()->setVar('is_admin', ((string)$session->get('role') === '1'));

        if (!file_exists(WRITEPATH . 'installed.txt')) {
            $this->default_data['setting'] = (object)[];
            return;
        }

        try {
            $this->db = \Config\Database::connect();
            $dashboardModel = new \App\Models\DashboardModel();
            $this->default_data['setting'] = $dashboardModel->getSetting();
            $this->logging = new \App\Models\LogModel();
        } catch (\Throwable $e) {
            $this->default_data['setting'] = (object)[];
        }

                $this->LOG_TYPE = (object) [
            'LOGIN' => 1,
            'LOGOUT' => 2,
            'ADD' => 3,
            'EDIT' => 4,
            'DELETE' => 5,
            'MATERI_OPEN' => 6,
            'MATERI_CLOSE' => 7,
            'TUGAS_SUBMIT' => 8,
            'TUGAS_SEND' => 9,
            'UJIAN_START' => 10,
            'UJIAN_FINISH' => 11,
            'UJIAN_VIEW_SCORE' => 12
        ];
    }

    protected function render_view($role, $main_view, $data = []) {
        $data = array_merge($this->default_data, $data);
        $html = view($main_view, $data);

        $out = '';
        if ($role == 1) {
            $out .= view('_templates/dashboard/_header', $data);
            $out .= $html;
            $out .= view('_templates/dashboard/_footer', $data);
        } elseif ($role == 2) {
            $out .= $html;
        } elseif ($role == 3) {
            $out .= view('members/siswa/templates/header', $data);
            $out .= $html;
            $out .= view('members/siswa/templates/footer', $data);
        }
        return $out;
    }

    public function submit($data){
        foreach ($data as $key=>$val) {
            $data[$key] = $val;
        }
        return $data;
    }


    protected function output_json($data, $encode = true) {
        if (ob_get_length()) ob_end_clean();

        if (!$encode) {
            // data sudah berupa string JSON
            return $this->response
                ->setContentType('application/json')
                ->setBody($data);
        }

        return $this->response->setJSON($data);
    }

    public function output_json_stream($data) {
        $this->response->setContentType('application/json');
        echo '[';
        $count = count($data);
        foreach ($data as $i => $row) {
            echo json_encode($row, JSON_UNESCAPED_UNICODE);
            if ($i < $count - 1) echo ',';
            flush(); // kirim sebagian data ke browser
        }
        echo ']';
    }

    protected function buildData($data) {
        $tp_smt = $this->getTpSmt();
        $tp = $tp_smt->tp_active;
        $smt = $tp_smt->smt_active;
        $data['tp'] = $tp_smt->tp;
        $data['smt'] = $tp_smt->smt;
        $data['tp_active'] = $tp;
        $data['smt_active'] = $smt;
        $data['is_admin'] = ((string)session()->get('role') === '1'); // Since auth is CI3
        $data['user'] = (object) [
            'username' => session()->get('username'),
            'nama_lengkap' => session()->get('username'),
            'first_name' => session()->get('username'),
            'foto' => session()->get('foto') ?? '',
            'jabatan' => session()->get('role_name') ?? 'Admin'
        ];
        return $data;
    }

    protected function getTpSmt()
    {
        $dashboardModel = new \App\Models\DashboardModel();
        $tps = (array)$dashboardModel->getTahun();
        $smts = (array)$dashboardModel->getSemester();
        
        $data['tp'] = $tps;
        $data['smt'] = $smts;
        $tp_fil = array_filter($tps, function($item) {
            return $item->active == '1';
        });
        $smt_fil = array_filter($smts, function($item) {
            return $item->active == '1';
        });
        $tp = reset($tp_fil);
        $smt = reset($smt_fil);

        $data['tp_active'] = $tp;
        $data['smt_active'] = $smt;
        return (object)$data;
    }

    private function arrToUpper($val)
    {
        return strtoupper($val ?? '');
    }

    protected function sortArrays(&$array)
    {
        foreach ($array as &$subArray) {
            if ($subArray) {
                sort($subArray);
            }
        }
    }

    protected function isUpdated()
    {
        return json_decode(json_encode(['latest' => 1, 'current' => 1, 'is_latest' => true]));
    }

    protected function is_serialized( $data, $strict = true ) {
        // If it isn't a string, it isn't serialized.
        if ( ! is_string( $data ) ) {
            return false;
        }
        $data = trim( $data );
        if ( 'N;' == $data ) {
            return true;
        }
        if ( strlen( $data ) < 4 ) {
            return false;
        }
        if ( ':' !== $data[1] ) {
            return false;
        }
        if ( $strict ) {
            $lastc = substr( $data, -1 );
            if ( ';' !== $lastc && '}' !== $lastc ) {
                return false;
            }
        } else {
            $semicolon = strpos( $data, ';' );
            $brace     = strpos( $data, '}' );
            // Either ; or } must exist.
            if ( false == $semicolon && false == $brace ) {
                return false;
            }
            // But neither must be in the first X characters.
            if ( false !== $semicolon && $semicolon < 3 ) {
                return false;
            }
            if ( false !== $brace && $brace < 4 ) {
                return false;
            }
        }
        $token = $data[0];
        switch ( $token ) {
            case 's':
                if ( $strict ) {
                    if ( '"' !== $data[strlen($data) - 2]) {
                        return false;
                    }
                } elseif ( false == strpos( $data, '"' ) ) {
                    return false;
                    //} elseif ( ! str_contains( $data, '"' ) ) {
                    //    return false;
                }
            // Or else fall through.
            case 'a':
            case 'O':
            case 'E':
                return (bool) preg_match( "/^{$token}:[0-9]+:/s", $data );
            case 'b':
            case 'i':
            case 'd':
                $end = $strict ? '$' : '';
                return (bool) preg_match( "/^{$token}:[0-9.E+-]+;$end/", $data );
        }
        return false;
    }

    /**
     * @throws JsonException
     */
    protected function maybe_unserialize($data ) {
        // Don't attempt to unserialize data that wasn't serialized going in.
        if ( $this->is_serialized( $data ) ) {
            $result = @unserialize( trim( $data ));
            return json_decode(json_encode($result));
        }

        $json = is_string($data) ? json_decode($data) : $data;
        if (json_last_error() == JSON_ERROR_NONE && (is_object($json) || is_array($json))) {
            return $json;
        }

        return $data;
    }

    protected function maybe_decode($data)
    {
        if ($data[0] == '[' || $data[0] == '{') {
            // new
            $data = json_decode($data);
            // return return ['1','2']
        } else {
            // old
            $kelasIds = $this->maybe_unserialize($data);
            // return = ['kelas_id'=>'1','kelas_id'=>'2']
            // convert to new
            $data = array_column($kelasIds, 'kelas_id');
            // return ['1','2']
        }
        return $data;
    }

    private function getToken() {
        return \Config\Database::connect()->table('cbt_token')->orderBy('id_token', 'ASC')->get()->getRow();
    }

    protected function getValidToken($ada_ujian) {
        $token = $this->getToken();
        if (!$token) {
            $data = (object)[
                'token' => '',
                'auto' => '0',
                'jarak' => '15',
                'elapsed' => '00:00:00',
                'now' => date('Y-m-d H:i:s')
            ];
            return $data;
        }

        if ($token->auto == '0') {
            $token->now = date('Y-m-d H:i:s');
            return $token;
        }

        $updated = date('Y-m-d H:i:s');
        try {
            $mulai = new \DateTime($token->updated ?? $updated);
            $nowDt = new \DateTime($updated);
            $diff = $mulai->diff($nowDt);
            $total_minutes = ($diff->days * 24 * 60) + ($diff->h * 60) + $diff->i;

            $jarak = isset($token->jarak) ? (int)$token->jarak : 15;
            if ($jarak < 1) $jarak = 15;

            if ($diff->invert === 0 && $total_minutes >= $jarak && (int)$ada_ujian > 0) {
                $new = $this->createNewToken();
                $token->token = $new;
                $token->updated = $updated;
                if (isset($this->cbt) && method_exists($this->cbt, 'saveToken')) {
                    $this->cbt->saveToken($token);
                } else {
                    $cbtModel = new \App\Models\CbtModel();
                    $cbtModel->saveToken($token);
                }
            }
        } catch (\Throwable $e) {
            // Keep existing token if timestamp invalid
        }
        $token->now = date('Y-m-d H:i:s');
        return $token;
    }

    protected function createNewToken() {
        $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $input_length = strlen($chars);
        $new_token = '';
        for($i = 0; $i < 6; $i++) {
            $random_character = $chars[mt_rand(0, $input_length - 1)];
            $new_token .= $random_character;
        }
        return $new_token;
    }

    protected function cekRekapSiswa()
    {
        $rek = [];
        $db = \Config\Database::connect();
        if ($db->tableExists('cbt_rekap_nilai')) {
            $rekap_nilai = $db->table('cbt_rekap_nilai')->select('id_rekap_nilai, id_jadwal')->get()->getResult();
            foreach ($rekap_nilai as $rekap) {
                $rek[$rekap->id_jadwal][] = $rekap;
            }
        }

        $jadwals = $db->table('cbt_jadwal')
                      ->select('cbt_jadwal.id_jadwal, COUNT(cbt_rekap_siswa.id_rekap_siswa) as rekapsiswa_count')
                      ->join('cbt_rekap_siswa', 'cbt_rekap_siswa.id_jadwal = cbt_jadwal.id_jadwal', 'left')
                      ->groupBy('cbt_jadwal.id_jadwal')
                      ->get()->getResult();

        $res = [];
        $ids_jadwal = [];
        if ($jadwals) {
            foreach ($jadwals as $jadwal) {
                $jml_nilai = isset($rek[$jadwal->id_jadwal]) ? count($rek[$jadwal->id_jadwal]) : 0;
                $jadwal->rekap_nilai = $jml_nilai;
                $jml_rekap = intval($jadwal->rekapsiswa_count);
                
                $jadwal->rekap_siswa = $jml_rekap;
                $jadwal->rekap = $jml_rekap < $jml_nilai ? '0' : '1';
                
                if ($jml_rekap < $jml_nilai) {
                    $res[$jadwal->id_jadwal] = $jadwal;
                }
            }
        }

        $data['rekaps'] = $res;
        $data['ids_jadwal'] = array_keys($res);
        return $data;
    }
    /*
    private function simpanNilai($arr_siswa) {
        $nilai = [];
        foreach ($arr_siswa as $cbt) {
            $input = $cbt->cbtsiswa->nilai_input;
            $nilai_in['id_siswa'] = $input->id_siswa;
            $nilai_in['id_jadwal'] = $input->id_jadwal;
            $nilai_in['dikoreksi'] = '0';

            $nilai_s = [
                'id_cbt_siswa' => $cbt->cbtsiswa->id_cbt_siswa,
                'nilai' => []
            ];
            if (isset($input->skor_pg['detail'])) {
                foreach ($input->skor_pg['detail'] as $detail) {
                    if (isset($detail->id_soal)) {
                        $nilai_s['nilai'][] = [
                            'id_bank'   => $cbt->cbtsiswa->id_bank,
                            'id_jadwal' => $cbt->cbtsiswa->id_jadwal,
                            'id_soal'   => $detail->id_soal,
                            'nilai_koreksi' => 0,
                            'nilai_otomatis' => 0,
                            'point_soal' => $detail->point_soal
                        ];
                        $nilai_in['pg_benar'] = $input->pg_benar;
                        $nilai_in['pg_nilai'] = $input->pg_nilai;
                    }
                }
            }
            if (isset($input->skor_kompleks['detail'])) {
                foreach ($input->skor_kompleks['detail'] as $detail) {
                    if (isset($detail->id_soal)) {
                        $nilai_s['nilai'][] = [
                            'id_bank' => $cbt->cbtsiswa->id_bank,
                            'id_jadwal' => $cbt->cbtsiswa->id_jadwal,
                            'id_soal' => $detail->id_soal,
                            'nilai_koreksi' => 0,
                            'nilai_otomatis' => 0,
                            'point_soal' => $detail->point_soal
                        ];
                    }
                }
            }
            if (isset($input->skor_jodohkan['detail'])) {
                foreach ($input->skor_jodohkan['detail'] as $detail) {
                    if (isset($detail->id_soal)) {
                        $nilai_s['nilai'][] = [
                            'id_bank' => $cbt->cbtsiswa->id_bank,
                            'id_jadwal' => $cbt->cbtsiswa->id_jadwal,
                            'id_soal' => $detail->id_soal,
                            'nilai_koreksi' => 0,
                            'nilai_otomatis' => 0,
                            'point_soal' => $detail->point_soal
                        ];
                    }
                }
            }
            if (isset($input->skor_isian['detail'])) {
                foreach ($input->skor_isian['detail'] as $detail) {
                    if (isset($detail->id_soal)) {
                        $nilai_s['nilai'][] = [
                            'id_bank' => $cbt->cbtsiswa->id_bank,
                            'id_jadwal' => $cbt->cbtsiswa->id_jadwal,
                            'id_soal' => $detail->id_soal,
                            'nilai_koreksi' => 0,
                            'nilai_otomatis' => 0,
                            'point_soal' => $detail->point_soal
                        ];
                    }
                }
            }
            if (isset($input->skor_essai['detail'])) {
                foreach ($input->skor_essai['detail'] as $detail) {
                    if (isset($detail->id_soal)) {
                        $nilai_s['nilai'][] = [
                            'id_bank' => $cbt->cbtsiswa->id_bank,
                            'id_jadwal' => $cbt->cbtsiswa->id_jadwal,
                            'id_soal' => $detail->id_soal,
                            'nilai_koreksi' => 0,
                            'nilai_otomatis' => 0,
                            'point_soal' => $detail->point_soal
                        ];
                    }
                }
            }
            $nilai_in['kompleks_nilai'] = '0';
            $nilai_in['jodohkan_nilai'] = '0';
            $nilai_in['isian_nilai'] = '0';
            $nilai_in['essai_nilai'] = '0';

            $nilai_s['nilai_input'] = json_encode($nilai_in);
            $nilai_s['nilai'] = json_encode($nilai_s['nilai']);
            $nilai[$cbt->cbtsiswa->id_cbt_siswa] = $nilai_s;
        }
        return $nilai;
    }
    */

    private function simpanNilai($arr_siswa) {
        $nilai = [];

        foreach ($arr_siswa as $cbt) {
            $input = $cbt->cbtsiswa->nilai_input;
            $id_cbt_siswa = $cbt->cbtsiswa->id_cbt_siswa;
            $id_bank = $cbt->cbtsiswa->id_bank;
            $id_jadwal = $cbt->cbtsiswa->id_jadwal;

            $nilai_in = [
                'id_siswa' => $input->id_siswa,
                'id_jadwal' => $id_jadwal,
                'dikoreksi' => '0',
                'pg_benar'  => $input->pg_benar ?? 0,
                'pg_nilai'  => $input->pg_nilai ?? 0,
                'kompleks_nilai' => $input->skor_kompleks['skor_total'] ?? ($input->kompleks_nilai ?? 0),
                'jodohkan_nilai' => $input->skor_jodohkan['skor_total'] ?? ($input->jodohkan_nilai ?? 0),
                'isian_nilai'    => $input->skor_isian['skor_total'] ?? ($input->isian_nilai ?? 0),
                'essai_nilai'    => $input->skor_essai['skor_total'] ?? ($input->essai_nilai ?? 0),
                'skor_total'     => $input->skor_total ?? ($input->pg_nilai ?? 0),
                'skor_asli'      => $input->skor_asli ?? ($input->pg_nilai ?? 0)
            ];

            $skorSemua = [];
            foreach (['skor_pg','skor_kompleks','skor_jodohkan','skor_isian','skor_essai'] as $tipe) {
                if (!empty($input->{$tipe}['detail'])) {
                    $skorSemua = array_merge($skorSemua, $input->{$tipe}['detail']);
                }
            }

            $nilai_detail = [];
            foreach ($skorSemua as $detail) {
                if (!isset($detail->id_soal)) continue;
                $nilai_detail[] = [
                    'id_bank'   => $id_bank,
                    'id_jadwal' => $id_jadwal,
                    'id_soal'   => $detail->id_soal,
                    'nilai_koreksi' => 0,
                    'nilai_otomatis' => 0,
                    'point_soal' => $detail->point_soal
                ];
            }

            $nilai[$id_cbt_siswa] = [
                'id_cbt_siswa' => $id_cbt_siswa,
                'nilai_input'  => json_encode($nilai_in),
                'nilai'        => json_encode($nilai_detail)
            ];
        }

        return $nilai;
    }

    /**
     * @throws JsonException
     */
    protected function olah_nilai($type_query, $id_tp, $id_smt, $query, $id_jadwal, $koreksi = false)
    {
        // type query: 1=kelas, 2=id_siswa
        // $this->load->model('Cbt_jadwal_model', 'cbt_jadwal_model');
        // $this->load->model('Cbt_siswa_model', 'cbt_siswa_model');
        // $this->load->model('Cbt_log_model', 'cbt_log_model');

        if ($type_query == 1) {
            $sesisiswa_where = [
                'ss.kelas_id' => $query,
                'ss.tp_id' => $id_tp,
                'ss.smt_id' => $id_smt
            ];
        } else if ($type_query == 2) {
            $sesisiswa_where = [
                'ss.siswa_id' => $query,
                'ss.tp_id' => $id_tp,
                'ss.smt_id' => $id_smt
            ];
        } else {
            $sesisiswa_where = [];
        }

        $db = \Config\Database::connect();
        $jadwalRow = $db->table('cbt_jadwal a')
            ->select('a.id_jadwal, a.id_tp, a.id_smt, a.id_bank, a.id_jenis, a.tgl_mulai, a.tgl_selesai, a.durasi_ujian, a.pelanggaran, a.acak_soal, a.acak_opsi, a.hasil_tampil, a.token, a.status, a.ulang, a.reset_login, a.rekap, a.jam_ke, a.jarak, a.pelanggaran, j.nama_jenis, j.kode_jenis')
            ->join('cbt_jenis j', 'a.id_jenis = j.id_jenis', 'left')
            ->where('a.id_jadwal', $id_jadwal)
            ->get()->getRowArray();
            
        if (!$jadwalRow) return null;

        $jadwal = $jadwalRow;
        $jadwal['jenis'] = (object)[
            'id_jenis'   => $jadwalRow['id_jenis'],
            'nama_jenis' => $jadwalRow['nama_jenis'] ?? '',
            'kode_jenis' => $jadwalRow['kode_jenis'] ?? ($jadwalRow['nama_jenis'] ?? '')
        ];
        unset($jadwal['nama_jenis'], $jadwal['kode_jenis']);

        $sesiBuilder = $db->table('cbt_sesi_siswa ss')
            ->select('ss.siswa_id, ss.kelas_id, ss.ruang_id, ss.sesi_id, ss.tp_id, ss.smt_id,
                      s.id_siswa, s.nama, s.nis, s.nisn, s.agama,
                      p.nomor_peserta,
                      k.kode_kelas, k.nama_kelas,
                      r.kode_ruang, r.nama_ruang,
                      se.kode_sesi, se.nama_sesi')
            ->join('master_siswa s', 'ss.siswa_id = s.id_siswa', 'left')
            ->join('cbt_nomor_peserta p', 'ss.siswa_id = p.id_siswa AND p.id_tp = ' . $id_tp, 'left')
            ->join('master_kelas k', 'ss.kelas_id = k.id_kelas', 'left')
            ->join('cbt_ruang r', 'ss.ruang_id = r.id_ruang', 'left')
            ->join('cbt_sesi se', 'ss.sesi_id = se.id_sesi', 'left');
            
        if (!empty($sesisiswa_where)) {
            $sesiBuilder->where($sesisiswa_where);
        }
        $sesisiswaRows = $sesiBuilder->get()->getResult();
        
        $jadwal['sesisiswa'] = [];
        foreach($sesisiswaRows as $sr) {
            $jadwal['sesisiswa'][] = (object)[
                'siswa_id'   => $sr->siswa_id,
                'kelas_id'   => $sr->kelas_id,
                'ruang_id'   => $sr->ruang_id,
                'sesi_id'    => $sr->sesi_id,
                'tp_id'      => $sr->tp_id,
                'smt_id'     => $sr->smt_id,
                'no_peserta' => $sr->nomor_peserta,
                'nis'        => $sr->nis,
                'nisn'       => $sr->nisn,
                'nama_siswa' => $sr->nama,
                'siswa'      => (object)['id_siswa' => $sr->id_siswa, 'nama' => $sr->nama, 'nis' => $sr->nis, 'nisn' => $sr->nisn, 'agama' => $sr->agama],
                'peserta'    => (object)['nomor_peserta' => $sr->nomor_peserta],
                'kelas'      => (object)['kode_kelas' => $sr->kode_kelas, 'nama_kelas' => $sr->nama_kelas],
                'ruang'      => (object)['kode_ruang' => $sr->kode_ruang, 'nama_ruang' => $sr->nama_ruang],
                'sesi'       => (object)['kode_sesi' => $sr->kode_sesi, 'nama_sesi' => $sr->nama_sesi],
            ];
        }

        // Fallback jika single siswa dan belum memiliki sesi terikat di TP/SMT tertentu
        if (empty($jadwal['sesisiswa']) && $type_query == 2) {
            $swSingle = $db->table('master_siswa s')
                ->select('s.id_siswa, s.nama, s.nis, s.nisn, s.agama, ks.id_kelas as kelas_id, k.kode_kelas, k.nama_kelas, np.nomor_peserta')
                ->join('kelas_siswa ks', 'ks.id_siswa = s.id_siswa', 'left')
                ->join('master_kelas k', 'k.id_kelas = ks.id_kelas', 'left')
                ->join('cbt_nomor_peserta np', 'np.id_siswa = s.id_siswa', 'left')
                ->where('s.id_siswa', $query)
                ->orderBy('ks.id_kelas_siswa', 'DESC')
                ->get()->getRow();
            if ($swSingle) {
                $jadwal['sesisiswa'][] = (object)[
                    'siswa_id'   => $swSingle->id_siswa,
                    'kelas_id'   => $swSingle->kelas_id,
                    'ruang_id'   => null,
                    'sesi_id'    => null,
                    'tp_id'      => $id_tp,
                    'smt_id'     => $id_smt,
                    'no_peserta' => $swSingle->nomor_peserta,
                    'nis'        => $swSingle->nis,
                    'nisn'       => $swSingle->nisn,
                    'nama_siswa' => $swSingle->nama,
                    'siswa'      => (object)['id_siswa' => $swSingle->id_siswa, 'nama' => $swSingle->nama, 'nis' => $swSingle->nis, 'nisn' => $swSingle->nisn, 'agama' => $swSingle->agama],
                    'peserta'    => (object)['nomor_peserta' => $swSingle->nomor_peserta],
                    'kelas'      => (object)['kode_kelas' => $swSingle->kode_kelas ?? '-', 'nama_kelas' => $swSingle->nama_kelas ?? '-'],
                    'ruang'      => (object)['kode_ruang' => 'R1', 'nama_ruang' => 'Ruang 1'],
                    'sesi'       => (object)['kode_sesi' => 'S1', 'nama_sesi' => 'Sesi 1'],
                ];
            }
        }

        $bankRow = $db->table('cbt_bank_soal b')
            ->select('b.id_bank, b.bank_kode, b.bank_kelas, b.opsi, b.jml_soal, b.kkm, b.tampil_pg, b.bobot_pg, b.jml_kompleks, b.tampil_kompleks, b.bobot_kompleks, b.jml_jodohkan, b.tampil_jodohkan, b.bobot_jodohkan, b.jml_isian, b.tampil_isian, b.bobot_isian, b.jml_esai, b.tampil_esai, b.bobot_esai, b.id_tp, b.id_smt, b.soal_agama,
                      m.kode, m.nama_mapel,
                      g.kode_guru, g.nama_guru')
            ->join('master_mapel m', 'b.bank_mapel_id = m.id_mapel', 'left')
            ->join('master_guru g', 'b.bank_guru_id = g.id_guru', 'left')
            ->where('b.id_bank', $jadwalRow['id_bank'])
            ->get()->getRow();
            
        if ($bankRow) {
            $bank = (object)[
                'bank_kode' => $bankRow->bank_kode,
                'bank_kelas' => $bankRow->bank_kelas,
                'opsi' => $bankRow->opsi,
                'jml_soal' => $bankRow->jml_soal,
                'kkm' => (int)($bankRow->kkm ?? 75),
                'tampil_pg' => $bankRow->tampil_pg,
                'bobot_pg' => $bankRow->bobot_pg,
                'jml_kompleks' => $bankRow->jml_kompleks,
                'tampil_kompleks' => $bankRow->tampil_kompleks,
                'bobot_kompleks' => $bankRow->bobot_kompleks,
                'jml_jodohkan' => $bankRow->jml_jodohkan,
                'tampil_jodohkan' => $bankRow->tampil_jodohkan,
                'bobot_jodohkan' => $bankRow->bobot_jodohkan,
                'jml_isian' => $bankRow->jml_isian,
                'tampil_isian' => $bankRow->tampil_isian,
                'bobot_isian' => $bankRow->bobot_isian,
                'jml_esai' => $bankRow->jml_esai,
                'tampil_esai' => $bankRow->tampil_esai,
                'bobot_esai' => $bankRow->bobot_esai,
                'id_tp' => $bankRow->id_tp,
                'id_smt' => $bankRow->id_smt,
                'soal_agama' => $bankRow->soal_agama,
                'mapel' => (object)['kode' => $bankRow->kode, 'nama_mapel' => $bankRow->nama_mapel],
                'guru' => (object)['kode_guru' => $bankRow->kode_guru, 'nama_guru' => $bankRow->nama_guru],
            ];
            
            $soalRows = $db->table('cbt_soal')
                ->select('id_soal, bank_id, mapel_id, jenis, nomor_soal, soal, opsi_a, opsi_b, opsi_c, opsi_d, opsi_e, jawaban, tampilkan')
                ->where('bank_id', $jadwalRow['id_bank'])
                ->where('tampilkan', '1')
                ->get()->getResult();
                
            $bank->soal = $soalRows;
            $jadwal['bank'] = $bank;
        }

        if (isset($jadwal['bank'])) {
            $info = $jadwal['bank'];
            foreach ($info->soal as $soal) {
                $soal->opsi_a = $this->maybe_unserialize($soal->opsi_a ?? '');
                $soal->jawaban = $this->maybe_unserialize($soal->jawaban ?? '');
            }
            $soals = (array)$info->soal;
            $info->soal = $soals;

            if ($info->bank_kelas[0] == '[' || $info->bank_kelas[0] == '{') {
                $info->bank_kelas = $this->maybe_unserialize($info->bank_kelas);
            } else {
                $kelasIds = $this->maybe_unserialize($info->bank_kelas);
                $info->bank_kelas = array_column($kelasIds, 'kelas_id');
            }

            // OPTIMASI: Ambil ID siswa yang relevan dari hasil filter jadwal.
            if ($type_query == 1) {
                $siswa_ids = array_column($jadwal['sesisiswa'] ?? [], 'siswa_id');
            } else {
                $siswa_ids = [$query];
            }

            if (empty($siswa_ids)) {
                // Jika tidak ada siswa yang cocok dengan filter, keluar lebih awal
                unset($info->soal);
                return (object)$jadwal;
            }

            $cbtsiswa = $db->table('cbt_siswa')
                ->where('id_jadwal', $id_jadwal)
                ->whereIn('id_siswa', $siswa_ids)
                ->get()->getResult();
            $logsiswa = $db->table('log_ujian')
                ->where('id_jadwal', $id_jadwal)
                ->whereIn('id_siswa', $siswa_ids)
                ->get()->getResult();

            if ($cbtsiswa && isset($jadwal['sesisiswa'])) {
                $map_cbt = [];
                $map_pelanggaran = [];
                foreach ($cbtsiswa as $cbt) {
                    $map_pelanggaran[$cbt->id_siswa] = $this->maybe_unserialize($cbt->pelanggaran ?? '{}');
                    $map_cbt[$cbt->id_siswa] = $cbt;
                }
                $map_log = [];
                foreach ($logsiswa as $log) {
                    $map_log[$log->id_siswa][] = $log;
                }
                $arr_cbt_empty = [];
                foreach ($jadwal['sesisiswa'] as $idx=>$siswa) {
                    if ($info->soal_agama != '-' && $info->soal_agama != '0' && $info->soal_agama !== $siswa->siswa->agama) {
                        unset($jadwal['sesisiswa'][$idx]);
                        $siswa->cbtsiswa = (object)[];
                        $siswa->log = [];
                    } else {
                        if (isset($map_cbt[$siswa->siswa_id])) {
                            $valNilai = $map_cbt[$siswa->siswa_id]->nilai ?? null;
                            $valInput = $map_cbt[$siswa->siswa_id]->nilai_input ?? null;
                            if (empty($valNilai) || $valNilai === '[]' || empty($valInput) || $valInput === '{}' || $valInput === '[]') {
                                $arr_cbt_empty[] = $map_cbt[$siswa->siswa_id]->id_cbt_siswa;
                            }
                        }
                        $siswa->cbtsiswa = $map_cbt[$siswa->siswa_id] ?? (object)[];
                        $siswa->log = $map_log[$siswa->siswa_id] ?? [];
                        $siswa->pelanggaran = $map_pelanggaran[$siswa->siswa_id] ?? (object)[];
                    }
                }
                $adaNilaiKosong = count($arr_cbt_empty) >0;
                $jadwal['sesisiswa'] = array_values($jadwal['sesisiswa']);
                $this->createPointSiswa($jadwal['sesisiswa'], $info, $adaNilaiKosong);

                if ($adaNilaiKosong) {
                    $arr_siswa = array_filter($jadwal['sesisiswa'], function ($cbt) use ($arr_cbt_empty) {
                        return in_array($cbt->id_cbt_siswa, $arr_cbt_empty);
                    });
                    $resultSiampan = $this->simpanNilai($arr_siswa);
                    $jadwal['ada_nilai_kosong'] = $resultSiampan;
                    if (!empty($resultSiampan)) {
                        \Config\Database::connect()->table('cbt_siswa')->updateBatch($resultSiampan, 'id_cbt_siswa');
                    }
                }
                $jadwal['type_query'] = $type_query;
                if ($koreksi) {
                    $jadwal['soal_pg'] = array_values(array_filter($soals, static function($val) {
                        $jenis = is_object($val) ? $val->jenis : $val['jenis'];
                        $tampilkan = is_object($val) ? $val->tampilkan : $val['tampilkan'];
                        return ($jenis == '1' && $tampilkan == '1');
                    }));
                    $jadwal['soal_kompleks'] = array_values(array_filter($soals, static function($val) {
                        $jenis = is_object($val) ? $val->jenis : $val['jenis'];
                        $tampilkan = is_object($val) ? $val->tampilkan : $val['tampilkan'];
                        return ($jenis == '2' && $tampilkan == '1');
                    }));
                    $jadwal['soal_jodohkan'] = array_values(array_filter($soals, static function($val) {
                        $jenis = is_object($val) ? $val->jenis : $val['jenis'];
                        $tampilkan = is_object($val) ? $val->tampilkan : $val['tampilkan'];
                        return ($jenis == '3' && $tampilkan == '1');
                    }));
                    $jadwal['soal_isian'] = array_values(array_filter($soals, static function($val) {
                        $jenis = is_object($val) ? $val->jenis : $val['jenis'];
                        $tampilkan = is_object($val) ? $val->tampilkan : $val['tampilkan'];
                        return ($jenis == '4' && $tampilkan == '1');
                    }));
                    $jadwal['soal_esai'] = array_values(array_filter($soals, static function($val) {
                        $jenis = is_object($val) ? $val->jenis : $val['jenis'];
                        $tampilkan = is_object($val) ? $val->tampilkan : $val['tampilkan'];
                        return ($jenis == '5' && $tampilkan == '1');
                    }));
                }
            }
            unset($info->soal);
        }
        return (object)$jadwal;
    }

    private function createMenit($durasi)
    {
        if (empty($waktu) || !is_string($waktu) || strpos($waktu, ':') == false) {
            return 0;
        }

        $parts = explode(":", $waktu);
        $jam   = isset($parts[0]) ? (int) $parts[0] : 0;
        $menit = isset($parts[1]) ? (int) $parts[1] : 0;
        $detik = isset($parts[2]) ? (int) $parts[2] : 0;

        $totalMenit = ($jam * 60) + $menit + ($detik / 60);
        return round($totalMenit, 2);
    }

    private function createPointSiswa($jadwal, $info, $adaNilaiKosong) {
        $bobot = $this->calculateWeights($info);
        $soals = $info->soal;
        foreach ($jadwal as $status) {
            $status->cbtsiswa->jawaban = $this->maybe_unserialize($status->cbtsiswa->jawaban ?? '[]', false, 512, JSON_THROW_ON_ERROR) ?? [];
            $status->cbtsiswa->nilai = $this->maybe_unserialize($status->cbtsiswa->nilai ?? '[]', false, 512, JSON_THROW_ON_ERROR) ?? [];
            $nilai_input = $this->maybe_unserialize($status->cbtsiswa->nilai_input ?? '{}', false, 512, JSON_THROW_ON_ERROR) ?? new \stdClass();

            $durasi = (object)[
                "status" => $status->cbtsiswa->status ?? '',
                "mulai" => $status->cbtsiswa->mulai ?? '',
                "selesai" => $status->cbtsiswa->selesai ?? '',
                "lama_ujian" => $status->cbtsiswa->lama_ujian ?? '',
                "reset_izin" => $status->cbtsiswa->reset_izin ?? '',
                "reset_waktu" => $status->cbtsiswa->reset_waktu ?? '',
                "menit" => $this->createMenit($status->cbtsiswa->lama_ujian ?? '')
            ];

            if (!isset($nilai_input->id_siswa) && isset($status->cbtsiswa->id_siswa)) {
                $nilai_input->id_siswa = $status->cbtsiswa->id_siswa;
                $nilai_input->id_jadwal = $status->cbtsiswa->id_jadwal;
                $nilai_input->dikoreksi = '0';
                $nilai_input->kompleks_nilai = '0';
                $nilai_input->jodohkan_nilai = '0';
                $nilai_input->isian_nilai = '0';
                $nilai_input->essai_nilai = '0';
            }
            $nilai_input->skor_pg = [];
            $nilai_input->skor_kompleks = [];
            $nilai_input->skor_jodohkan = [];
            $nilai_input->skor_isian = [];
            $nilai_input->skor_essai = [];

            $jawabans_siswa = [];
            $mapJwbn = [];
            if (is_array($status->cbtsiswa->jawaban)) {
                foreach ($status->cbtsiswa->jawaban as $jObj) {
                    if (is_object($jObj) && isset($jObj->id_soal)) {
                        $mapJwbn[(string)$jObj->id_soal] = $jObj;
                    } elseif (is_array($jObj) && isset($jObj['id_soal'])) {
                        $mapJwbn[(string)$jObj['id_soal']] = (object)$jObj;
                    }
                }
            }
            $mapNilai = [];
            if (is_array($status->cbtsiswa->nilai)) {
                foreach ($status->cbtsiswa->nilai as $nObj) {
                    if (is_object($nObj) && isset($nObj->id_soal)) {
                        $mapNilai[(string)$nObj->id_soal] = $nObj;
                    } elseif (is_array($nObj) && isset($nObj['id_soal'])) {
                        $mapNilai[(string)$nObj['id_soal']] = (object)$nObj;
                    }
                }
            }

            // Proses pengelompokan soal berdasarkan jenis_soal
            foreach ($soals as $dataSoal) {
                $sid = (string)$dataSoal->id_soal;
                if (isset($mapJwbn[$sid])) {
                    $no_soal = $dataSoal->nomor_soal;
                    $jawaban_siswa = (object)$mapJwbn[$sid];
                    if (!empty($dataSoal->jawaban)) {
                        $jawaban_siswa->jawaban_benar = $dataSoal->jawaban;
                    }
                    if ($dataSoal->jenis == '3') {
                        $arrAlphabet = range('A', 'Z');
                        if (!isset($jawaban_siswa->jawaban_siswa) || !isset($jawaban_siswa->jawaban_siswa->links)) {
                            $arrjwbnSiswa = [];
                            if ($jawaban_siswa->jawaban_siswa) {
                                foreach ($jawaban_siswa->jawaban_siswa->jawaban as $idx => $jbs) {
                                    if ($idx > 0) {
                                        $arrjwbnSiswa[$idx] = [];
                                        foreach ($jbs as $idxs => $jb) {
                                            if ($idxs > 0) {
                                                if ($jb == '1') {
                                                    $arrjwbnSiswa[$idx][] = $arrAlphabet[$idxs - 1];
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                            if ($jawaban_siswa->jawaban_siswa) {
                                $jawaban_siswa->jawaban_siswa->links = json_decode(json_encode($arrjwbnSiswa));
                            } else {
                                $jawaban_siswa->jawaban_siswa = ['links' => $arrjwbnSiswa];
                                $jawaban_siswa->jawaban_siswa = json_decode(json_encode($jawaban_siswa->jawaban_siswa));
                            }
                        }

                        $dataSoal->jawaban = json_decode(json_encode($dataSoal->jawaban));
                        $arrjwbn = [];
                        foreach ($dataSoal->jawaban->jawaban as $idx => $jbs) {
                            if ($idx > 0) {
                                $arrjwbn[$idx] = [];
                                foreach ($jbs as $idxs => $jb) {
                                    if ($idxs > 0) {
                                        if ($jb == '1') {
                                            $arrjwbn[$idx][] = $arrAlphabet[$idxs - 1];
                                        }
                                    }
                                }
                            }
                        }
                        $dataSoal->jawaban->links = json_decode(json_encode($arrjwbn));
                        $jawaban_siswa->jawaban_benar = $dataSoal->jawaban;
                        if ($jawaban_siswa->jawaban_benar) {
                            $jawaban_siswa->jawaban_benar->links = json_decode(json_encode($arrjwbn));
                        } else {
                            $jawaban_siswa->jawaban_benar = ['links' => $arrjwbn];
                            $jawaban_siswa->jawaban_benar = json_decode(json_encode($jawaban_siswa->jawaban_benar));
                        }
                    }
                    $nilai = $mapNilai[$sid] ?? [];
                    $jawabans_siswa[$dataSoal->jenis][$no_soal] = [
                        'jawab' => $jawaban_siswa,
                        'nilai' => (object)$nilai
                    ];
                } else {
                    $jawabans_siswa[$dataSoal->jenis][$dataSoal->nomor_soal] = [
                        'jawab' => null,
                        'nilai' => (object)[]
                    ];
                }
            }
            $ada_jawaban = count($status->cbtsiswa->jawaban) > 0;
            $ada_jawaban_pg = $ada_jawaban && isset($jawabans_siswa['1']);
            if ($ada_jawaban_pg) $this->processNilaiPg($info, $jawabans_siswa['1'], $bobot, $nilai_input, $status->cbtsiswa->nilai);
            $ada_jawaban_pg2 = $ada_jawaban && isset($jawabans_siswa['2']);
            if ($ada_jawaban_pg2) $this->processNilaiKompleks($info, $jawabans_siswa['2'], $bobot, $nilai_input, $status->cbtsiswa->nilai);
            $ada_jawaban_jodoh = $ada_jawaban && isset($jawabans_siswa['3']);
            if ($ada_jawaban_jodoh) $this->processNilaiJodohkan($info, $jawabans_siswa['3'], $bobot, $nilai_input, $status->cbtsiswa->nilai);
            $ada_jawaban_isian = $ada_jawaban && isset($jawabans_siswa['4']);
            if ($ada_jawaban_isian) $this->processNilaiIsian($info, $jawabans_siswa['4'], $bobot, $nilai_input, $status->cbtsiswa->nilai);
            $ada_jawaban_essai = $ada_jawaban && isset($jawabans_siswa['5']);
            if ($ada_jawaban_essai) $this->processNilaiEsai($info, $jawabans_siswa['5'], $bobot, $nilai_input, $status->cbtsiswa->nilai);

            $total = ($nilai_input->skor_pg['skor_total'] ?? 0) + ($nilai_input->skor_kompleks['skor_total'] ?? 0)
                + ($nilai_input->skor_jodohkan['skor_total'] ?? 0) + ($nilai_input->skor_isian['skor_total'] ?? 0)
                + ($nilai_input->skor_essai['skor_total'] ?? 0);
            $nilai_input->skor_total = round($total, 2);

            $total_asli = ($nilai_input->skor_pg['skor_total'] ?? 0) + ($nilai_input->skor_kompleks['skor_asli'] ?? 0)
                + ($nilai_input->skor_jodohkan['skor_asli'] ?? 0) + ($nilai_input->skor_isian['skor_asli'] ?? 0)
                + ($nilai_input->skor_essai['skor_asli'] ?? 0);
            $nilai_input->skor_asli = round($total_asli, 2);

            $this->kalkulasiWaktu($durasi);
            $sudahMulai = $durasi->mulai != '';
            $sudahSelesai = $durasi->selesai != '';
            $iconLoading = $sudahMulai ? '<i class="fa fa-spinner fa-spin"></i> ' : '';
            $loading = $sudahSelesai ? '<i class="fa fa-check"></i> ' : $iconLoading;
            $durasi->status_ujian = $loading . $durasi->durasi;
            $status->durasi = $durasi;

            $status->cbtsiswa->nilai_input = $nilai_input;
            $status->nilai_akhir = $nilai_input;
            $status->id_cbt_siswa = $status->cbtsiswa->id_cbt_siswa ?? '';
            if (!$adaNilaiKosong) {
                unset($status->cbtsiswa);
            }
        }
    }

    protected function processNilaiPg($info, $jawabans, $bobot, $nilai_input, $nilai) {
        $arrJawabanPg = [];
        $skor_pg = 0;
        if ($info->tampil_pg > 0) {
            $soals = $info->soal;
            $benar_pg = 0;

            // 🚀 Optimasi 1: Buat indeks jawaban agar pencarian cepat O(1)
            $mapJawaban = [];
            foreach ($jawabans as $j) {
                if (isset($j['jawab']->id_soal)) {
                    $mapJawaban[(string)$j['jawab']->id_soal] = $j['jawab'];
                }
            }

            // 🚀 Optimasi 2: Hitung sekali nilai poin benar
            $point_benar = $info->bobot_pg > 0 ? round($info->bobot_pg / $info->tampil_pg, 2) : 0;

            foreach ($soals as $soal) {
                if ($soal->jenis != '1') continue;

                $idsoal = (string)$soal->id_soal;
                $jawab = $mapJawaban[$idsoal] ?? null;

                $jawaban_siswa = strtoupper($jawab->jawaban_siswa ?? '-');
                $kunciSoal = !empty($soal->jawaban) ? $soal->jawaban : ($jawab->jawaban_benar ?? '');
                $jawaban_benar = strtoupper(is_string($kunciSoal) ? $kunciSoal : '');
                $benar = ($jawaban_siswa !== '-' && $jawaban_benar !== '' && $jawaban_siswa === $jawaban_benar);

                if ($benar) $benar_pg++;

                $arrJawabanPg[$soal->nomor_soal] = (object)[
                    'nomor' => $soal->nomor_soal,
                    'id_soal' => $idsoal,
                    'jawaban_benar' => $jawaban_benar,
                    'jawaban_siswa' => $jawaban_siswa,
                    'analisa' => $benar
                        ? '<i class="fa fa-check-circle text-green text-lg"></i>'
                        : '<i class="fa fa-times-circle text-red text-lg"></i>',
                    'skor_jawaban' => $benar ? $point_benar : 0,
                    'benar' => $benar,
                    'point_soal' => $point_benar
                ];
            }

            // 🚀 Optimasi 3: Hilangkan usort jika sudah urut
            ksort($arrJawabanPg);

            // 🚀 Optimasi 4: Minimalisasi pembulatan
            $skor_pg = ($benar_pg / $bobot->bagi_pg) * $bobot->bobot_pg;
            $nilai_input->pg_benar = $benar_pg;
            $nilai_input->pg_nilai = round($skor_pg, 2);

            $nilai_input->skor_pg = [
                'detail' => array_values($arrJawabanPg),
                'skor_total' => round($skor_pg, 2)
            ];
        }
    }

    /*
    protected function processNilaiPg($info, $jawabans, $bobot, $nilai_input, $nilai) {
        $arrJawabanPg = [];
        $skor_pg = 0;
        if ($info->tampil_pg > 0) {
            $soals = $info->soal;
            $benar_pg = 0;
            foreach ($soals as $soal) {
                if ($soal->jenis != '1') {
                    continue; // Skip if not an essay question
                }
                $idsoal = $soal->id_soal;
                $num = $soal->nomor_soal;
                $ada_jawaban = array_filter($jawabans, function ($item) use ($idsoal) {
                    return isset($item['jawab']->id_soal) && (string)$item['jawab']->id_soal == (string)$idsoal;
                });
                $jawaban = null;
                if (count($ada_jawaban) > 0) {
                    $jawaban = array_shift($ada_jawaban);
                }

                $jawab = $jawaban['jawab'] ?? null;
                $point_benar = $info->bobot_pg > 0 ? round($info->bobot_pg / $info->tampil_pg, 2) : 0;
                if ($jawab && isset($jawab->jawaban_siswa)) {
                    $benar = strtoupper($jawab->jawaban_siswa ?? '-') == strtoupper($jawab->jawaban_benar ?? '');
                    if ($benar) {
                        $benar_pg += 1;
                    }
                    $arrJawabanPg[$num] = (object)[
                        'nomor' => $num,
                        'id_soal' => $jawab->id_soal,
                        'jawaban_benar' => strtoupper($jawab->jawaban_benar ?? ''),
                        'jawaban_siswa' => strtoupper($jawab->jawaban_siswa ?? ''),
                        'analisa'=> $benar ? '<i class="fa fa-check-circle text-green text-lg"></i>' : '<i class="fa fa-times-circle text-red text-lg"></i>',
                        'skor_jawaban' => !$benar || $info->bobot_pg == 0 ? 0 : round($info->bobot_pg / $info->tampil_pg, 2),
                        'benar' => $benar,
                        'point_soal' => $point_benar
                    ];
                } else {
                    $arrJawabanPg[$num] = (object)[
                        'nomor' => $num,
                        'jawaban_benar' => strtoupper($jawab->jawaban_benar ?? ''),
                        'jawaban_siswa' => '',
                        'analisa'=> '<i class="fa fa-times-circle text-red text-lg"></i>',
                        'benar' => false,
                        'skor_jawaban' => 0
                    ];
                }

            }
            $skor_pg = ($benar_pg / $bobot->bagi_pg) * $bobot->bobot_pg;
            if (!isset($nilai_input->pg_benar)) {
                $nilai_input->pg_benar = $benar_pg;
                $nilai_input->pg_nilai = round($skor_pg, 2);
            }
        }
        usort($arrJawabanPg, function ($item1, $item2) {
            return $item1->nomor <=> $item2->nomor;
        });
        $nilai_input->skor_pg['detail'] = array_values($arrJawabanPg);
        $nilai_input->skor_pg['skor_total'] = round($skor_pg, 2);
    }
    */

    protected function processNilaiKompleks($info, $jawabans, $bobot, $nilai_input, $nilai) {
        $benar_pg2 = 0;
        $skor_total = 0.0;
        $detail = [];
        if ($info->tampil_kompleks > 0) {
            $soals = $info->soal;
            foreach ($soals as $soal) {
                if ($soal->jenis != '2') {
                    continue; // Skip if not an essay question
                }
                $idsoal = $soal->id_soal;
                $num = $soal->nomor_soal;
                $ada_jawaban = array_filter($jawabans, function ($item) use ($idsoal) {
                    return isset($item['jawab']->id_soal) && (string)$item['jawab']->id_soal == (string)$idsoal;
                });
                $jawaban = null;
                if (count($ada_jawaban) > 0) {
                    $jawaban = array_shift($ada_jawaban);
                }

                $jawab = $jawaban['jawab'] ?? null;
                $point_benar = $info->bobot_kompleks > 0 ? round($info->bobot_kompleks / $info->tampil_kompleks, 2) : 0;
                $nilai_pg2 = $jawaban['nilai'] ?? null;
                $jwbSiswaRaw = $jawab->jawaban_siswa ?? [];
                if (is_string($jwbSiswaRaw)) {
                    $jwbSiswaRaw = json_decode($jwbSiswaRaw, true) ?: [$jwbSiswaRaw];
                } elseif (is_object($jwbSiswaRaw)) {
                    $jwbSiswaRaw = (array)$jwbSiswaRaw;
                }
                $jawaban_siswa = is_array($jwbSiswaRaw) ? array_values(array_map('strtoupper', array_filter($jwbSiswaRaw, function ($item) {
                    return !is_null($item) && $item !== '';
                }))) : [];

                $jwbBenarRaw = !empty($soal->jawaban) ? $soal->jawaban : (!empty($jawab->jawaban_benar) ? $jawab->jawaban_benar : []);
                if (is_string($jwbBenarRaw)) {
                    $jwbBenarRaw = json_decode($jwbBenarRaw, true) ?: [$jwbBenarRaw];
                } elseif (is_object($jwbBenarRaw)) {
                    $jwbBenarRaw = (array)$jwbBenarRaw;
                }
                $jawaban_benar = is_array($jwbBenarRaw) ? array_values(array_map('strtoupper', array_filter($jwbBenarRaw, function ($item) {
                    return !is_null($item) && $item !== '';
                }))) : [];

                if ($jawab && !empty($jawaban_siswa)) {
                    $arr_benar = array_intersect($jawaban_siswa, $jawaban_benar);
                    if (count($jawaban_benar) > 0) {
                        $benar_pg2 += (1 / count($jawaban_benar)) * count($arr_benar);
                    }

                    $point_item = count($jawaban_benar) > 0 ? $point_benar / count($jawaban_benar) : 0;
                    $pk = $point_item * count($arr_benar);

                    $jml_benar = count($arr_benar);
                    if ($jml_benar == count($jawaban_benar)) {
                        $analisa = '<i class="fa fa-check-circle text-green text-lg"></i>';
                    } elseif (($jml_benar > 0) && ($jml_benar < count($jawaban_benar))) {
                        $analisa = '<i class="fa fa-times-circle text-yellow text-lg"></i>';
                    } else {
                        $analisa = '<i class="fa fa-times-circle text-red text-lg"></i>';
                    }

                    $point = round($pk, 2);

                    // nilai_otomatis: 0=otomatis (dari app), 1=nilai koreksi dari guru
                    // nilai_koreksi = dari menu koreksi
                    $skor_jawaban = $point;
                    if ($nilai_pg2 && isset($nilai_pg2->nilai_otomatis)) {
                        $skor_jawaban = $nilai_pg2->nilai_otomatis == '1' ? $nilai_pg2->nilai_koreksi : $point;
                    }

                    // skor_total = gabungan dari nilai koreksi dan nilai dari app
                    $skor_total += is_numeric($skor_jawaban) ? $skor_jawaban : 0;
                    $detail[$num] = (object)[
                        'nomor' => $num,
                        'id_soal' => $jawab->id_soal,
                        'jawaban_benar' => $jawaban_benar,
                        'jawaban_siswa' => $jawaban_siswa,
                        'analisa' => $analisa,
                        'nilai_otomatis' => $nilai_pg2->nilai_otomatis ?? '0', // 0=otomatis (dari app), 1=nilai koreksi dari guru
                        'nilai_asli' => $point, // dari aplikasi
                        'nilai_koreksi' => $nilai_pg2->nilai_koreksi ?? $point, // dari guru
                        'skor_jawaban' => $skor_jawaban,
                        'point_soal' => $point_benar
                    ];
                } else {
                    $ada_nilai = array_filter($nilai, function ($item) use ($idsoal) {
                        return (string)$item->id_soal == (string)$idsoal;
                    });
                    if (count($ada_nilai) > 0) {
                        $nilai_pg2 = array_shift($ada_nilai);
                        $skor_total += is_numeric($nilai_pg2->nilai_koreksi) ? $nilai_pg2->nilai_koreksi : 0;
                        $detail[$num] = (object)[
                            'nomor' => $num,
                            'id_soal' => $soal->id_soal,
                            'jawaban_benar' => $soal->jawaban ?? '--',
                            'jawaban_siswa' => $jawab->jawaban_siswa ?? '-',
                            'analisa' => '<i class="fa fa-times-circle text-yellow text-lg"></i>',
                            'nilai_otomatis' => $nilai_is->nilai_otomatis ?? '0', // 0=otomatis (dari app), 1=nilai koreksi dari guru
                            'nilai_asli' => '0', // dari aplikasi
                            'nilai_koreksi' => $nilai_is->nilai_koreksi ?? '0', // dari guru
                            'skor_jawaban' => $nilai_is->nilai_koreksi ?? '0',
                            'point_soal' => $point_benar
                        ];
                    } else {
                        $detail[$num] = (object)[
                            'nomor' => $num,
                            'id_soal' => $soal->id_soal,
                            'jawaban_benar' => '--',
                            'jawaban_siswa' => '-',
                            'analisa' => '<i class="fa fa-times-circle text-yellow text-lg"></i>',
                            'nilai_otomatis' => '0', // 0=otomatis (dari app), 1=nilai koreksi dari guru
                            'nilai_asli' => '0', // dari aplikasi
                            'nilai_koreksi' => '0', // dari guru
                            'skor_jawaban' => '0',
                            'point_soal' => $point_benar
                        ];
                    }
                }
            }
        }
        $nilai_input->skor_kompleks['jml_benar'] = round($benar_pg2, 2);
        $nilai_input->skor_kompleks['detail'] = array_values($detail);
        $nilai_input->skor_kompleks['skor_total'] = isset($nilai_input->kompleks_nilai) ? round($nilai_input->kompleks_nilai == '0' ? $skor_total : $nilai_input->kompleks_nilai, 2) : 0;
        $nilai_input->skor_kompleks['skor_asli'] = round($skor_total, 2);

        // skor dari app
        $s_pg2 = $bobot->bagi_pg2 == 0 ? 0 : ($benar_pg2 / $bobot->bagi_pg2) * $bobot->bobot_pg2;

        // $nilai_input->kompleks_nilai = dari input nilai tanpa koreksi
        // cek apakah ada nilai input
        $ada_nilai_input = isset($nilai_input->kompleks_nilai) && $nilai_input->kompleks_nilai != '0';

        // jika ada $nilai_input maka abaikan gabungan nilai koreksi dan nilai dari app
        $skor_total_app = $ada_nilai_input ? $nilai_input->kompleks_nilai : $s_pg2;
        $nilai_input->skor_kompleks['skor_total_app'] = round($skor_total_app, 2);
    }

    protected function processNilaiJodohkan($info, $jawabans, $bobot, $nilai_input, $nilai) {
        $benar_jod = 0;
        $skor_total = 0.0;
        $detail = [];

        if ($info->tampil_jodohkan > 0) {
            $soals = $info->soal;
            foreach ($soals as $soal) {
                if ($soal->jenis != '3') {
                    continue; // Skip if not an essay question
                }
                $idsoal = $soal->id_soal;
                $num = $soal->nomor_soal;
                $ada_jawaban = array_filter($jawabans, function ($item) use ($idsoal) {
                    return isset($item['jawab']->id_soal) && (string)$item['jawab']->id_soal == (string)$idsoal;
                });
                $jawaban = null;
                if (count($ada_jawaban) > 0) {
                    $jawaban = array_shift($ada_jawaban);
                }

                $jawab = $jawaban['jawab'] ?? null;
                $point_benar = $info->bobot_jodohkan > 0 ? round($info->bobot_jodohkan / $info->tampil_jodohkan, 2) : 0;
                $typeSoal = $jawab->jawaban_siswa->type ?? $jawab->jawaban_benar->type ?? $soal->jawaban->type ?? '1';
                $arrSoal = [];
                if (isset($jawab->jawaban_benar->jawaban) && (is_array($jawab->jawaban_benar->jawaban) || is_object($jawab->jawaban_benar->jawaban))) {
                    $arrSoal = json_decode(json_encode($jawab->jawaban_benar->jawaban), true);
                } elseif (isset($soal->jawaban->jawaban) && (is_array($soal->jawaban->jawaban) || is_object($soal->jawaban->jawaban))) {
                    $arrSoal = json_decode(json_encode($soal->jawaban->jawaban), true);
                }
                if ($jawab) {

                    $item_benar = 0;
                    $item_salah = 0;
                    $item_kurang = 0;
                    $items = 0;
                    $arrBenar = []; // count same each subitem

                    if (isset($jawab->jawaban_siswa->links)) {
                        $array1 = (array)$jawab->jawaban_benar->links;
                        $this->sortArrays($array1);
                        $array2 = (array)$jawab->jawaban_siswa->links;
                        $this->sortArrays($array2);

                        foreach ($array1 as $key => $subArray1) {
                            $arrBenar[$key] = new \stdClass();
                            $arrBenar[$key]->benar = 0;
                            $arrBenar[$key]->salah = 0;
                            $arrBenar[$key]->kurang = 0;
                            $items += count($subArray1);
                            if (isset($array2[$key])) {
                                $subArray2 = $array2[$key];

                                // Count the same items
                                $sameItems = array_intersect($subArray1, $subArray2);
                                //$sameCount += count($sameItems);
                                $item_benar += count($sameItems);
                                $arrBenar[$key]->benar += count($sameItems);

                                // Count the different items
                                $diffItems1 = array_diff($subArray1, $subArray2);
                                $diffItems2 = array_diff($subArray2, $subArray1);
                                //$differentCount += count($diffItems1) + count($diffItems2);
                                $item_kurang += count($diffItems1) + count($diffItems2);
                                $arrBenar[$key]->kurang += count($diffItems1);
                            } else {
                                // If the key doesn't exist in the second array, all items are different
                                $item_kurang += count($subArray1);
                                $arrBenar[$key]->kurang += count($subArray1);
                            }
                        }
                    }

                    $point_soal = $items == 0 ? 0 : ((1 / $items) * $item_benar) * $point_benar;
                    $benar_jod += $items == 0 ? 0 : (1 / $items) * $item_benar;

                    $headSoal = array_shift($arrSoal);
                    $arrJwbSoal = [];
                    foreach ($arrSoal as $kolSoal) {
                        $jwb = new \stdClass();
                        $jwb->type_soal = $typeSoal;
                        $jwb->subtitle = [];
                        foreach ($kolSoal as $pos => $kol) {
                            if ($kol == '1') {
                                $jwb->subtitle[] = $headSoal[$pos];
                            }
                        }
                        $jwb->title = array_shift($kolSoal);
                        $arrJwbSoal[] = $jwb;
                    }

                    $arrJawab = [];
                    $headJawab = [];
                    if (isset($jawab->jawaban_siswa->jawaban)) {
                        $arrJawab = $jawab->jawaban_siswa->jawaban;
                        $headJawab = array_shift($arrJawab);
                    }
                    $arrJwbJawab = [];
                    foreach ($arrJawab as $kolJawab) {
                        $jwbs = new \stdClass();
                        foreach ($kolJawab as $po => $kol) {
                            if ($kol == '1') {
                                $sub = $headJawab[$po];
                                $jwbs->subtitle[] = $sub;
                            }
                        }
                        $jwbs->title = array_shift($kolJawab);
                        $arrJwbJawab[] = $jwbs;
                    }

                    $point = round($point_soal, 2);
                    $nilai_jod = $jawaban['nilai'];
                    if ($nilai_jod) {
                        $skor_jawaban = isset($nilai_jod->nilai_otomatis) && $nilai_jod->nilai_otomatis == '1' ? $nilai_jod->nilai_koreksi : $point;
                    } else {
                        $skor_jawaban = $point;
                    }

                    $skor_total += is_numeric($skor_jawaban) ? $skor_jawaban : 0;

                    if ($item_benar == $items && $item_salah == 0 && $item_kurang == 0) {
                        $analisa = '<i class="fa fa-check-circle text-green text-lg"></i>';
                    } elseif ($item_benar == 0) {
                        $analisa = '<i class="fa fa-times-circle text-red text-lg"></i>';
                    } else {
                        $analisa = '<i class="fa fa-times-circle text-yellow text-lg"></i>';
                    }

                    $detail[$num] = (object)[
                        'nomor' => $num,
                        'id_soal' => $jawab->id_soal,
                        'jawaban_benar' => $jawab->jawaban_benar,
                        'jawaban_siswa' => $jawab->jawaban_siswa,
                        'type_soal' => $typeSoal,
                        'tabel_soal' => $arrJwbSoal,
                        'tabel_benar' => $arrBenar,
                        'tabel_jawab' => $arrJwbJawab,
                        'analisa' => $analisa,
                        'nilai_otomatis' => $nilai_jod->nilai_otomatis ?? '0', // 0=otomatis (dari app), 1=nilai koreksi dari guru
                        'nilai_asli' => $point, // dari aplikasi
                        'nilai_koreksi' => $nilai_jod->nilai_koreksi ?? $point, // dari guru
                        'skor_jawaban' => $skor_jawaban,
                        'point_soal' => $point_benar
                    ];
                } else {
                    $ada_nilai = array_filter($nilai, function ($item) use ($idsoal) {
                        return (string)$item->id_soal == (string)$idsoal;
                    });
                    $nilai_guru = count($ada_nilai) > 0 ? array_shift($ada_nilai) : null;
                    $skor_koreksi = $nilai_guru->nilai_koreksi ?? '0';

                    $arrJwbSoal = [];
                    if (!empty($arrSoal)) {
                        $headSoal = array_shift($arrSoal);
                        foreach ($arrSoal as $kolSoal) {
                            $jwb = new \stdClass();
                            $jwb->type_soal = $typeSoal;
                            $jwb->subtitle = [];
                            foreach ($kolSoal as $pos => $kol) {
                                if ($kol == '1') {
                                    $jwb->subtitle[] = $headSoal[$pos] ?? '';
                                }
                            }
                            $jwb->title = array_shift($kolSoal);
                            $arrJwbSoal[] = $jwb;
                        }
                    }

                    $skor_jawaban = ($nilai_guru && isset($nilai_guru->nilai_otomatis) && $nilai_guru->nilai_otomatis == '1') ? $skor_koreksi : 0;
                    $skor_total += is_numeric($skor_jawaban) ? (float)$skor_jawaban : 0;

                    $detail[$num] = (object)[
                        'nomor' => $num,
                        'id_soal' => $soal->id_soal,
                        'jawaban_benar' => $soal->jawaban ?? '--',
                        'jawaban_siswa' => '-',
                        'analisa' => '<i class="fa fa-times-circle text-red text-lg"></i>',
                        'nilai_otomatis' => $nilai_guru->nilai_otomatis ?? '0',
                        'nilai_asli' => '0',
                        'nilai_koreksi' => $skor_koreksi,
                        'skor_jawaban' => $skor_jawaban,
                        'point_soal' => $point_benar,
                        'type_soal' => $typeSoal ?? '',
                        'tabel_soal' => $arrJwbSoal,
                        'tabel_benar' => [],
                        'tabel_jawab' => []
                    ];
                }
            }
        }
        $nilai_input->skor_jodohkan['jml_benar'] = round($benar_jod, 2);
        $nilai_input->skor_jodohkan['detail'] = array_values($detail);
        $nilai_input->skor_jodohkan['skor_total'] = isset($nilai_input->jodohkan_nilai) ? round($nilai_input->jodohkan_nilai == '0' ? $skor_total : $nilai_input->jodohkan_nilai, 2) : 0;
        $nilai_input->skor_jodohkan['skor_asli'] = round($skor_total, 2);

        // skor dari app
        $s_jod = $bobot->bagi_jodoh == 0 ? 0 : ($benar_jod / $bobot->bagi_jodoh) * $bobot->bobot_jodoh;

        // $nilai_input->isian_nilai = dari input nilai tanpa koreksi
        // cek apakah ada nilai input
        $ada_nilai_input = isset($nilai_input->jodohkan_nilai) && $nilai_input->jodohkan_nilai != '0';

        // jika ada $nilai_input maka abaikan gabungan nilai koreksi dan nilai dari app
        $skor_total_app = $ada_nilai_input ? $nilai_input->jodohkan_nilai : $s_jod;
        $nilai_input->skor_jodohkan['skor_total_app'] = round($skor_total_app, 2);
    }

    protected function processNilaiIsian($info, $jawabans, $bobot, $nilai_input, $nilai) {
        $skor_total = 0.0;
        $benar_is = 0;
        $detail = [];

        if ($info->tampil_isian > 0) {
            $soals = $info->soal;
            foreach ($soals as $soal) {
                if ($soal->jenis != '4') {
                    continue; // Skip if not an essay question
                }
                $idsoal = $soal->id_soal;
                $num = $soal->nomor_soal;
                $ada_jawaban = array_filter($jawabans, function ($item) use ($idsoal) {
                    return isset($item['jawab']->id_soal) && (string)$item['jawab']->id_soal == (string)$idsoal;
                });
                $jawaban = null;
                if (count($ada_jawaban) > 0) {
                    $jawaban = array_shift($ada_jawaban);
                }

                $jawab = $jawaban['jawab'] ?? null;
                $point_benar = $info->bobot_isian > 0 ? round($info->bobot_isian / $info->tampil_isian, 2) : 0;
                if ($jawab && isset($jawab->jawaban_siswa)) {
                    $jawaban_siswa = strtolower(strip_tags($jawab->jawaban_siswa ?? '-'));
                    $kunciSoal = !empty($soal->jawaban) ? $soal->jawaban : ($jawab->jawaban_benar ?? '');
                    $jawaban_benar = strtolower(strip_tags(is_string($kunciSoal) ? $kunciSoal : ''));
                    $benar = ($jawaban_siswa !== '-' && $jawaban_benar !== '' && $jawaban_siswa === $jawaban_benar);

                    if ($benar) {
                        $benar_is++;
                    }

                    // Hitung poin hanya jika jawaban benar
                    $point = $benar ? $point_benar : 0; // Jawaban salah dapat 0 point

                    // Ambil nilai koreksi jika tersedia
                    $nilai_is = $jawaban['nilai'] ?? null;
                    $skor_jawaban = $nilai_is && isset($nilai_is->nilai_otomatis) && $nilai_is->nilai_otomatis == '1'
                        ? $nilai_is->nilai_koreksi
                        : $point;

                    $skor_total += is_numeric($skor_jawaban) ? $skor_jawaban : 0;

                    // Analisa benar atau salah
                    $analisa = $benar
                        ? '<i class="fa fa-check-circle text-green text-lg"></i>'
                        : '<i class="fa fa-times-circle text-yellow text-lg"></i>';

                    $detail[$num] = (object) [
                        'nomor' => $num,
                        'id_soal' => $jawab->id_soal ?? null,
                        'jawaban_benar' => $jawab->jawaban_benar ?? '--',
                        'jawaban_siswa' => $jawab->jawaban_siswa ?? '-',
                        'analisa' => $analisa,
                        'nilai_otomatis' => $nilai_is->nilai_otomatis ?? '0',
                        'nilai_asli' => $point,
                        'nilai_koreksi' => $nilai_is->nilai_koreksi ?? $point,
                        'skor_jawaban' => $skor_jawaban,
                        'point_soal' => $point_benar
                    ];
                } else {
                    $ada_nilai = array_filter($nilai, function ($item) use ($idsoal) {
                        return (string)$item->id_soal == (string)$idsoal;
                    });
                    if (count($ada_nilai) > 0) {
                        $nilai_is = array_shift($ada_nilai);
                        $skor_total += is_numeric($nilai_is->nilai_koreksi) ? $nilai_is->nilai_koreksi : 0;
                        $detail[$num] = (object)[
                            'nomor' => $num,
                            'id_soal' => $soal->id_soal,
                            'jawaban_benar' => $soal->jawaban ?? '--',
                            'jawaban_siswa' => $jawab->jawaban_siswa ?? '-',
                            'analisa' => '<i class="fa fa-times-circle text-yellow text-lg"></i>',
                            'nilai_otomatis' => $nilai_is->nilai_otomatis ?? '0', // 0=otomatis (dari app), 1=nilai koreksi dari guru
                            'nilai_asli' => '0', // dari aplikasi
                            'nilai_koreksi' => $nilai_is->nilai_koreksi ?? '0', // dari guru
                            'skor_jawaban' => $nilai_is->nilai_koreksi ?? '0',
                            'point_soal' => $point_benar
                        ];
                    } else {
                        $detail[$num] = (object)[
                            'nomor' => $num,
                            'id_soal' => $soal->id_soal,
                            'jawaban_benar' => '--',
                            'jawaban_siswa' => '-',
                            'analisa' => '<i class="fa fa-times-circle text-yellow text-lg"></i>',
                            'nilai_otomatis' => '0', // 0=otomatis (dari app), 1=nilai koreksi dari guru
                            'nilai_asli' => '0', // dari aplikasi
                            'nilai_koreksi' => '0', // dari guru
                            'skor_jawaban' => '0',
                            'point_soal' => $point_benar
                        ];
                    }
                }
            }
        }

        $nilai_input->skor_isian['jml_benar'] = round($benar_is, 2);
        $nilai_input->skor_isian['detail'] = array_values($detail);
        $nilai_input->skor_isian['skor_total'] = isset($nilai_input->isian_nilai)
            ? round($nilai_input->isian_nilai == '0' ? $skor_total : $nilai_input->isian_nilai, 2)
            : 0;
        $nilai_input->skor_isian['skor_asli'] = round($skor_total, 2);

        // Perhitungan skor dari aplikasi
        $s_is = $bobot->bagi_isian > 0
            ? ($benar_is / $bobot->bagi_isian) * $bobot->bobot_isian
            : 0;

        $ada_nilai_koreksi = isset($nilai_input->isian_nilai) && $nilai_input->isian_nilai != '0';
        $skor_total_app = $ada_nilai_koreksi ? $nilai_input->isian_nilai : $s_is;
        $nilai_input->skor_isian['skor_total_app'] = round($skor_total_app, 2);
    }

    protected function processNilaiEsai($info, $jawabans, $bobot, $nilai_input, $nilai) {
        $skor_total = 0.0;
        $benar_es = 0;
        $detail = [];

        if ($info->tampil_esai > 0) {
            $soals = $info->soal;
            foreach ($soals as $soal) {
                if ($soal->jenis != '5') {
                    continue; // Skip if not an essay question
                }
                $idsoal = $soal->id_soal;
                $num = $soal->nomor_soal;
                $ada_jawaban = array_filter($jawabans, function ($item) use ($idsoal) {
                    return isset($item['jawab']->id_soal) && (string)$item['jawab']->id_soal == (string)$idsoal;
                });

                $jawaban = null;
                if (count($ada_jawaban) > 0) {
                    $jawaban = array_shift($ada_jawaban);
                }

                $jawab = $jawaban['jawab'] ?? null;
                $point_benar = $info->bobot_esai > 0 ? round($info->bobot_esai / $info->tampil_esai, 2) : 0;
                if ($jawab && isset($jawab->jawaban_siswa)) {
                    $jawaban_siswa = strtolower(strip_tags($jawab->jawaban_siswa ?? '-'));
                    $kunciSoal = !empty($soal->jawaban) ? $soal->jawaban : ($jawab->jawaban_benar ?? '');
                    $jawaban_benar = strtolower(strip_tags(is_string($kunciSoal) ? $kunciSoal : ''));
                    $benar = ($jawaban_siswa !== '-' && $jawaban_benar !== '' && $jawaban_siswa === $jawaban_benar);

                    if ($benar) {
                        $benar_es++;
                    }

                    $point = $benar ? $point_benar : 0;

                    $nilai_es = $jawaban['nilai'] ?? null;
                    $skor_jawaban = $nilai_es && isset($nilai_es->nilai_otomatis) && $nilai_es->nilai_otomatis == '1'
                        ? $nilai_es->nilai_koreksi
                        : $point;

                    $skor_total += is_numeric($skor_jawaban) ? $skor_jawaban : 0;

                    $analisa = $benar
                        ? '<i class="fa fa-check-circle text-green text-lg"></i>'
                        : '<i class="fa fa-times-circle text-yellow text-lg"></i>';

                    $detail[$num] = (object)[
                        'nomor' => $num,
                        'id_soal' => $jawab->id_soal ?? null,
                        'jawaban_benar' => $jawab->jawaban_benar ?? '--',
                        'jawaban_siswa' => $jawab->jawaban_siswa ?? '-',
                        'analisa' => $analisa,
                        'nilai_otomatis' => $nilai_es->nilai_otomatis ?? '0',
                        'nilai_asli' => $point,
                        'nilai_koreksi' => $nilai_es->nilai_koreksi ?? $point,
                        'skor_jawaban' => $skor_jawaban,
                        'point_soal' => $point_benar
                    ];
                } else {
                    $ada_nilai = array_filter($nilai, function ($item) use ($idsoal) {
                        return (string)$item->id_soal == (string)$idsoal;
                    });
                    if (count($ada_nilai) > 0) {
                        $nilai_es = array_shift($ada_nilai);
                        $skor_total += is_numeric($nilai_es->nilai_koreksi) ? $nilai_es->nilai_koreksi : 0;
                        $detail[$num] = (object)[
                            'nomor' => $num,
                            'id_soal' => $soal->id_soal,
                            'jawaban_benar' => $soal->jawaban ?? '--',
                            'jawaban_siswa' => $jawab->jawaban_siswa ?? '-',
                            'analisa' => '<i class="fa fa-times-circle text-yellow text-lg"></i>',
                            'nilai_otomatis' => $nilai_es->nilai_otomatis ?? '0', // 0=otomatis (dari app), 1=nilai koreksi dari guru
                            'nilai_asli' => '0', // dari aplikasi
                            'nilai_koreksi' => $nilai_es->nilai_koreksi ?? '0', // dari guru
                            'skor_jawaban' => $nilai_es->nilai_koreksi ?? '0',
                            'point_soal' => $point_benar
                        ];
                    } else {
                        $detail[$num] = (object)[
                            'nomor' => $num,
                            'id_soal' => $soal->id_soal,
                            'jawaban_benar' => '--',
                            'jawaban_siswa' => '-',
                            'analisa' => '<i class="fa fa-times-circle text-yellow text-lg"></i>',
                            'nilai_otomatis' => '0', // 0=otomatis (dari app), 1=nilai koreksi dari guru
                            'nilai_asli' => '0', // dari aplikasi
                            'nilai_koreksi' => '0', // dari guru
                            'skor_jawaban' => '0',
                            'point_soal' => $point_benar
                        ];
                    }
                }
            }
        }

        $nilai_input->skor_essai['jml_benar'] = round($benar_es, 2);
        $nilai_input->skor_essai['detail'] = array_values($detail);
        $nilai_input->skor_essai['skor_total'] = isset($nilai_input->essai_nilai) ? round($nilai_input->essai_nilai == '0' ? $skor_total : $nilai_input->essai_nilai, 2) : 0;
        $nilai_input->skor_essai['skor_asli'] = round($skor_total, 2);

        $s_es = $bobot->bagi_essai == 0 ? 0 : ($benar_es / $bobot->bagi_essai) * $bobot->bobot_essai;
        $ada_nilai_koreksi = isset($nilai_input->essai_nilai) && $nilai_input->essai_nilai != '0';
        $skor_total_app = $ada_nilai_koreksi ? $nilai_input->essai_nilai : $s_es;
        $nilai_input->skor_essai['skor_total_app'] = round($skor_total_app, 2);
    }

    function kalkulasiWaktu($durasi) {
        // Reset waktu bisa dilakukan sebelum tanggal ujian berakhir
        // Jika tgl ujian sudah berakhir, silakan tambahkan tgl akhir ujian
        $lamanya = $durasi->lama_ujian;
        $mulai = strtotime($durasi->mulai ?? '') * 1000; // Konversi ke timestamp dalam milidetik
        if (!$lamanya || strpos($lamanya, ':') == false) {
            $selesai = strtotime($durasi->selesai ?? '') * 1000;
            $lama = $selesai - $mulai;
            $lamanya = gmdate('H:i:s', $lama / 1000); // Format H:i:s
        }
        //if (!empty($durasi->mulai) && !empty($durasi->selesai)) {}

        $durasi->lama_ujian = $lamanya;

        $elap = $lamanya ? explode(':', $lamanya) : [];
        $ej = ($elap[0] == "00") ? '' : ((int) $elap[0]) . ' jam ';
        $em = ($elap[1] == "00") ? '' : ((int) $elap[1]) . ' mnt ';
        $ed = ($elap[2] == "00") ? '' : ((int) $elap[2]) . ' dtk';
        $durasi->mulai_ujian = $durasi->mulai ? date('H:i', strtotime($durasi->mulai ?? '')) : '';
        if ($ej == '' && $em == '') {
            $durasi->durasi = $ed;
        } else {
            $durasi->durasi = $ej . $em; // . $ed;
        }
    }

    /**
     * Calculate weights for different question types
     * @param object $info Question bank info
     * @return object Calculated weights
     */
    protected function calculateWeights($info)
    {
        return (object)[
            'bagi_pg' => max(1, $info->tampil_pg) / 100,
            'bobot_pg' => $info->bobot_pg / 100,
            'bagi_pg2' => max(1, $info->tampil_kompleks) / 100,
            'bobot_pg2' => $info->bobot_kompleks / 100,
            'bagi_jodoh' => max(1, $info->tampil_jodohkan) / 100,
            'bobot_jodoh' => $info->bobot_jodohkan / 100,
            'bagi_isian' => max(1, $info->tampil_isian) / 100,
            'bobot_isian' => $info->bobot_isian / 100,
            'bagi_essai' => max(1, $info->tampil_esai) / 100,
            'bobot_essai' => $info->bobot_esai / 100
        ];
    }

    protected function createSkorSiswa($rekap, $koreksi) {
        $info = $rekap->bank_soal;
        $bobot = $this->calculateWeights($info);
        $soals = array_merge(
            $rekap->soal_pg,
            $rekap->soal_kompleks,
            $rekap->soal_jodohkan,
            $rekap->soal_isian,
            $rekap->soal_esai
        );
        $info->soal = $soals;

        foreach ($rekap->rekapsiswa as $rkp_siswa) {
            $ruang_sesi = $rkp_siswa->ruang_sesi;
            $rkp_siswa->ruang_sesi = $this->maybe_unserialize($ruang_sesi);

            $nilai = $rkp_siswa->nilai ?? '[]';
            $rkp_siswa->nilai = $this->maybe_unserialize($nilai);

            $jawaban = $rkp_siswa->jawaban ?? '[]';
            $rkp_jawaban = $this->maybe_unserialize($jawaban);

            $input = $rkp_siswa->nilai_input ?? '{}';
            $nilai_input = $this->maybe_unserialize($input);

            $durasi = (object)[
                "status" => $rkp_siswa->status ?? '',
                "mulai" => $rkp_siswa->mulai ?? '',
                "selesai" => $rkp_siswa->selesai ?? '',
                "lama_ujian" => $rkp_siswa->lama_ujian ?? '',
                "menit" => $this->createMenit($rkp_siswa->lama_ujian ?? '')
            ];

            $nilai_input->skor_pg = [];
            $nilai_input->skor_kompleks = [];
            $nilai_input->skor_jodohkan = [];
            $nilai_input->skor_isian = [];
            $nilai_input->skor_essai = [];

            $jawabans_siswa = [];
            $mapSoals = [];
            foreach ($soals as $sObj) {
                if (is_object($sObj) && isset($sObj->id_soal)) {
                    $mapSoals[(string)$sObj->id_soal] = $sObj;
                } elseif (is_array($sObj) && isset($sObj['id_soal'])) {
                    $mapSoals[(string)$sObj['id_soal']] = (object)$sObj;
                }
            }
            $mapRkpNilai = [];
            if (is_array($rkp_siswa->nilai ?? null)) {
                foreach ($rkp_siswa->nilai as $nObj) {
                    if (is_object($nObj) && isset($nObj->id_soal)) {
                        $mapRkpNilai[(string)$nObj->id_soal] = $nObj;
                    } elseif (is_array($nObj) && isset($nObj['id_soal'])) {
                        $mapRkpNilai[(string)$nObj['id_soal']] = (object)$nObj;
                    }
                }
            }

            // Proses pengelompokan soal berdasarkan jenis_soal
            foreach ($rkp_jawaban as $jawaban_siswa) {
                $sid = (string)($jawaban_siswa->id_soal ?? '');
                $dataSoal = $mapSoals[$sid] ?? null;
                $jawaban_benar = $dataSoal ? $dataSoal->jawaban : ($jawaban_siswa->jawaban_benar ?? null);
                $jawaban_siswa->jawaban_benar = $jawaban_benar;

                if ($dataSoal && $dataSoal->jenis == '3') {
                    $arrAlphabet = range('A', 'Z');
                    $jawaban_siswa->jawaban_siswa = $this->maybe_unserialize($jawaban_siswa->jawaban_siswa);
                    if (!isset($jawaban_siswa->jawaban_siswa) || !isset($jawaban_siswa->jawaban_siswa->links)) {
                        $arrjwbnSiswa = [];
                        if ($jawaban_siswa->jawaban_siswa) {
                            foreach ($jawaban_siswa->jawaban_siswa->jawaban as $idx => $jbs) {
                                if ($idx > 0) {
                                    $arrjwbnSiswa[$idx] = [];
                                    foreach ($jbs as $idxs => $jb) {
                                        if ($idxs > 0) {
                                            if ($jb == '1') {
                                                $arrjwbnSiswa[$idx][] = $arrAlphabet[$idxs - 1];
                                            }
                                        }
                                    }
                                }
                            }
                        }
                        if ($jawaban_siswa->jawaban_siswa) {
                            $jawaban_siswa->jawaban_siswa->links = json_decode(json_encode($arrjwbnSiswa));
                        } else {
                            $jawaban_siswa->jawaban_siswa = ['links' => $arrjwbnSiswa];
                            $jawaban_siswa->jawaban_siswa = json_decode(json_encode($jawaban_siswa->jawaban_siswa));
                        }
                    }

                    if ($jawaban_benar) {
                        $arrjwbn = [];
                        foreach ($jawaban_benar->jawaban as $idx => $jbs) {
                            if ($idx > 0) {
                                $arrjwbn[$idx] = [];
                                foreach ($jbs as $idxs => $jb) {
                                    if ($idxs > 0) {
                                        if ($jb == '1') {
                                            $arrjwbn[$idx][] = $arrAlphabet[$idxs - 1];
                                        }
                                    }
                                }
                            }
                        }

                        if ($jawaban_siswa->jawaban_benar) {
                            $jawaban_siswa->jawaban_benar->links = json_decode(json_encode($arrjwbn));
                        } else {
                            $jawaban_siswa->jawaban_benar = ['links' => $arrjwbn];
                            $jawaban_siswa->jawaban_benar = json_decode(json_encode($jawaban_siswa->jawaban_benar));
                        }
                    }
                }

                $nilaiObj = $mapRkpNilai[$sid] ?? null;
                if ($dataSoal) {
                    $jawabans_siswa[$dataSoal->jenis][$jawaban_siswa->id_soal] = [
                        'jawab' => $jawaban_siswa,
                        'nilai' => $nilaiObj ? (object)$nilaiObj : null,
                    ];
                }
            }

            $ada_jawaban = count($rkp_jawaban) > 0;
            $ada_jawaban_pg = $ada_jawaban && isset($jawabans_siswa['1']);
            if ($ada_jawaban_pg) $this->processNilaiPg($info, $jawabans_siswa['1'], $bobot, $nilai_input, $rkp_siswa->nilai);
            $ada_jawaban_pg2 = $ada_jawaban && isset($jawabans_siswa['2']);
            if ($ada_jawaban_pg2) $this->processNilaiKompleks($info, $jawabans_siswa['2'], $bobot, $nilai_input, $rkp_siswa->nilai);
            $ada_jawaban_jodoh = $ada_jawaban && isset($jawabans_siswa['3']);
            if ($ada_jawaban_jodoh) $this->processNilaiJodohkan($info, $jawabans_siswa['3'], $bobot, $nilai_input, $rkp_siswa->nilai);
            $ada_jawaban_isian = $ada_jawaban && isset($jawabans_siswa['4']);
            if ($ada_jawaban_isian) $this->processNilaiIsian($info, $jawabans_siswa['4'], $bobot, $nilai_input, $rkp_siswa->nilai);
            $ada_jawaban_essai = $ada_jawaban && isset($jawabans_siswa['5']);
            if ($ada_jawaban_essai) $this->processNilaiEsai($info, $jawabans_siswa['5'], $bobot, $nilai_input, $rkp_siswa->nilai);

            $total = ($nilai_input->skor_pg['skor_total'] ?? 0) + ($nilai_input->skor_kompleks['skor_total'] ?? 0)
                + ($nilai_input->skor_jodohkan['skor_total'] ?? 0) + ($nilai_input->skor_isian['skor_total'] ?? 0)
                + ($nilai_input->skor_essai['skor_total'] ?? 0);
            $nilai_input->skor_total = round($total, 2);

            $total_asli = ($nilai_input->skor_pg['skor_total'] ?? 0) + ($nilai_input->skor_kompleks['skor_asli'] ?? 0)
                + ($nilai_input->skor_jodohkan['skor_asli'] ?? 0) + ($nilai_input->skor_isian['skor_asli'] ?? 0)
                + ($nilai_input->skor_essai['skor_asli'] ?? 0);
            $nilai_input->skor_asli = round($total_asli, 2);

            $this->kalkulasiWaktu($durasi);
            $sudahMulai = $durasi->mulai != '';
            $sudahSelesai = $durasi->selesai != '';
            $iconLoading = $sudahMulai ? '<i class="fa fa-spinner fa-spin"></i> ' : '';
            $loading = $sudahSelesai ? '<i class="fa fa-check"></i> ' : $iconLoading;
            $durasi->status_ujian = $loading . $durasi->durasi;
            $rkp_siswa->durasi = $durasi;

            $rkp_siswa->nilai_akhir = $nilai_input;
            $rkp_siswa->pelanggaran = $this->maybe_unserialize($rkp_siswa->pelanggaran ?? '{}');

            //unset($rkp_siswa->jawaban, $rkp_siswa->nilai_input);
        }
        //if (!$koreksi) {
        //    unset($rekap->soal_pg, $rekap->soal_kompleks, $rekap->soal_jodohkan, $rekap->soal_isian, $rekap->soal_esai);
        //}
    }

    public function get_koreksi()
    {
        $is_rekap = $this->request->getPost('is_rekap');
        $id_siswa = $this->request->getPost('siswa');
        $id_jadwal = $this->request->getPost('jadwal');
        if ($is_rekap > 0) {
            $this->getKoreksiRekap($id_siswa, $id_jadwal);
        } else {
            $this->getKoreksiNilai($id_siswa, $id_jadwal);
        }
    }

    private function getKoreksiNilai($id_siswa, $id_jadwal) {
        $tp_smt = $this->getTpSmt();
        $tp = $tp_smt->tp_active;
        $smt = $tp_smt->smt_active;
        $data['tp'] = $tp_smt->tp;
        $data['smt'] = $tp_smt->smt;
        $data['tp_active'] = $tp;
        $data['smt_active'] = $smt;

        $jadwal = $this->olah_nilai(2, $tp->id_tp, $smt->id_smt, $id_siswa, $id_jadwal, true);
        $jadwal->sesisiswa = $jadwal->sesisiswa[0];

        $data['siswa'] = $jadwal->sesisiswa;
        $data['info'] = $jadwal->bank;
        $data['id_jadwal'] = $jadwal->id_jadwal;
        $data['jenis'] = $jadwal->jenis;
        $data['tp_jadwal'] = $tp->tahun;
        $data['jadwal'] = $jadwal;

        $soal_1 = array_filter($jadwal->soal_pg, function ($soal) {
            return $soal->tampilkan == '1';
        });
        $soal_2 = array_filter($jadwal->soal_kompleks, function ($soal) {
            return $soal->tampilkan == '1';
        });
        $soal_3 = array_filter($jadwal->soal_jodohkan, function ($soal) {
            return $soal->tampilkan == '1';
        });
        $soal_4 = array_filter($jadwal->soal_isian, function ($soal) {
            return $soal->tampilkan == '1';
        });
        $soal_5 = array_filter($jadwal->soal_esai, function ($soal) {
            return $soal->tampilkan == '1';
        });
        $data['soal_pg'] = array_values($soal_1);
        $data['soal_kompleks'] = array_values($soal_2);
        $data['soal_jodohkan'] = array_values($soal_3);
        $data['soal_isian'] = array_values($soal_4);
        $data['soal_esai'] = array_values($soal_5);

        $data['is_rekap'] = 0;
        $data['success'] = true;
        return $this->output_json($data);
    }

    /**
     * @throws JsonException
     */
    private function getKoreksiRekap($id_siswa, $id_jadwal) {
        $id_siswa = $this->request->getPost('siswa');
        $id_jadwal = $this->request->getPost('jadwal');

        $tp_smt = $this->getTpSmt();
        $tp = $tp_smt->tp_active;
        $smt = $tp_smt->smt_active;
        $data['tp'] = $tp_smt->tp;
        $data['smt'] = $tp_smt->smt;
        $data['tp_active'] = $tp;
        $data['smt_active'] = $smt;

        // $this->load->model('Rekap_jadwal_model', 'rekap_jadwal');
        $rekap = $this->rekap_jadwal
            ->where(['id_jadwal'=>$id_jadwal])
            ->with_rekapsiswa([
                'where'=>['id_siswa'=>$id_siswa],
                /*
                'with' => [
                    ['relation'=>'siswa', 'fields'=>'id_siswa,nama,nis,agama']
                ]
                */
            ])
            ->get();

        $rekap->jadwal = $this->maybe_unserialize($rekap->jadwal);
        $rekap->bank_soal = $this->maybe_unserialize($rekap->bank_soal);
        $rekap->kelas_bank = $this->maybe_unserialize($rekap->kelas_bank);
        $arrIdKelas = [];
        foreach ($rekap->kelas_bank as $kls) {
            if (isset($kls->id_kelas)) {
                $arrIdKelas[$kls->id_kelas] = $kls->nama_kelas;
            }
        }
        $rekap->pengawas = $this->maybe_unserialize($rekap->pengawas);
        $soal_1 = array_filter($this->maybe_unserialize($rekap->soal_pg), function ($soal) {
            return $soal->tampilkan == '1';
        });
        $soal_2 = array_filter($this->maybe_unserialize($rekap->soal_kompleks), function ($soal) {
            return $soal->tampilkan == '1';
        });
        $soal_3 = array_filter($this->maybe_unserialize($rekap->soal_jodohkan), function ($soal) {
            return $soal->tampilkan == '1';
        });
        $soal_4 = array_filter($this->maybe_unserialize($rekap->soal_isian), function ($soal) {
            return $soal->tampilkan == '1';
        });
        $soal_5 = array_filter($this->maybe_unserialize($rekap->soal_esai), function ($soal) {
            return $soal->tampilkan == '1';
        });
        $rekap->soal_pg = array_values($soal_1);
        $rekap->soal_kompleks = array_values($soal_2);
        $rekap->soal_jodohkan = array_values($soal_3);
        $rekap->soal_isian = array_values($soal_4);
        $rekap->soal_esai = array_values($soal_5);
        $rekap->rekapsiswa = (array) $rekap->rekapsiswa;

        $this->createSkorSiswa($rekap, true);

        $jadwal = $rekap->jadwal;
        $jadwal->sesisiswa = $rekap->rekapsiswa[0];
        unset($rekap->rekapsiswa);

        $data['soal_pg'] = $rekap->soal_pg;
        $data['soal_kompleks'] = $rekap->soal_kompleks;
        $data['soal_jodohkan'] = $rekap->soal_jodohkan;
        $data['soal_isian'] = $rekap->soal_isian;
        $data['soal_esai'] = $rekap->soal_esai;

        $data['is_rekap'] = $jadwal->sesisiswa->id_rekap_siswa;
        $data['rekap_mapel'] = $rekap->nama_mapel;
        $data['rekap_guru'] = $rekap->nama_guru;
        $data['siswa'] = $jadwal->sesisiswa;
        $data['info'] = $rekap->bank_soal;
        $data['id_jadwal'] = $rekap->id_jadwal;
        $data['tp_jadwal'] = $rekap->tp;
        $data['jenis'] = (object)['id_jenis'=>$rekap->id_jenis, 'kode_jenis'=>$rekap->kode_jenis];

        $data['success'] = true;
        return $this->output_json($data);
    }

    public function simpanKoreksi()
    {
        // $this->load->model('Cbt_siswa_model', 'cbt_siswa_model');
        // $this->load->model('Rekap_siswa_model', 'rekap_siswa');
        // $this->load->model('Log_model', 'logging');

        $isRekap = $this->request->getPost('is_rekap');
        $siswa = $this->request->getPost('siswa');
        $jadwal = $this->request->getPost('jadwal');
        $bank = $this->request->getPost('bank');
        $field = $this->request->getPost('field');

        // Pastikan JSON yang diterima valid
        $nilais = json_decode($this->request->getPost('nilai'));
        if (!is_array($nilais)) {
            return $this->output_json(['success' => false, 'message' => 'Format data nilai tidak valid']);
            return;
        }

        $updated1 = true;
        $cbtsiswa = $this->cbt_siswa_model->fields('id_cbt_siswa,nilai,jawaban')->where(['id_siswa' => $siswa, 'id_jadwal' => $jadwal])->get();
        $missing_ids = [];

        if ($cbtsiswa && isset($cbtsiswa->nilai)) {
            $cbtsiswa->nilai = $this->maybe_unserialize($cbtsiswa->nilai);
            if (!is_array($cbtsiswa->nilai)) {
                $cbtsiswa->nilai = [];
            }

            $point_soal = 0;
            foreach ($cbtsiswa->nilai as $key => $nilai) {
                if ($nilai->point_soal != 0) {
                    $point_soal = $nilai->point_soal;
                }
                $idsoal = $nilai->id_soal;
                $for_update = array_filter($nilais, function ($item) use ($idsoal) {
                    return (string)$item->id_soal == (string)$idsoal;
                });
                if (!empty($for_update)) {
                    $nilai_siswa = array_values($for_update)[0];
                    $cbtsiswa->nilai[$key]->nilai_koreksi = $nilai_siswa->koreksi;
                    $cbtsiswa->nilai[$key]->nilai_otomatis = 1;
                }
            }

            $cbt_ids = array_column($cbtsiswa->nilai, 'id_soal');
            $missing_ids = array_filter($nilais, function ($item) use ($cbt_ids) {
                return !in_array($item->id_soal, $cbt_ids);
            });

            if (!empty($missing_ids)) {
                foreach ($missing_ids as $missing) {
                    $cbtsiswa->nilai[] = [
                        "id_bank" => (string)$bank,
                        "id_jadwal" => (string)$jadwal,
                        "id_soal" => (string)$missing->id_soal,
                        "nilai_koreksi" => $missing->koreksi,
                        "nilai_otomatis" => '1',
                        "point_soal" => (string)$point_soal
                    ];
                }
            }

            if (isset($cbtsiswa->id_cbt_siswa)) {
                $updated1 = $this->db->table('cbt_siswa')->set('nilai', json_encode($cbtsiswa->nilai))->where('id_cbt_siswa', $cbtsiswa->id_cbt_siswa)->update();
            }
        }

        $updated2 = true;
        $rekapsiswa = $this->rekap_siswa->fields('id_rekap_siswa,nilai')->where(['id_siswa' => $siswa, 'id_jadwal' => $jadwal])->get();
        if ($rekapsiswa && isset($rekapsiswa->nilai)) {
            $rekapsiswa->nilai = $this->maybe_unserialize($rekapsiswa->nilai);
            if (!is_array($rekapsiswa->nilai)) {
                $rekapsiswa->nilai = [];
            }

            $point_soal = 0;
            foreach ($rekapsiswa->nilai as $key => $nilai) {
                $idsoal = $nilai->id_soal;
                if ($nilai->point_soal != 0) {
                    $point_soal = $nilai->point_soal;
                }
                $for_update = array_filter($nilais, function ($item) use ($idsoal) {
                    return (string)$item->id_soal == (string)$idsoal;
                });
                if (!empty($for_update)) {
                    $nilai_siswa = array_values($for_update)[0];
                    $rekapsiswa->nilai[$key]->nilai_koreksi = $nilai_siswa->koreksi;
                    $rekapsiswa->nilai[$key]->nilai_otomatis = 1;
                }
            }

            $cbt_ids = array_column($rekapsiswa->nilai, 'id_soal');
            $missing_ids = array_filter($nilais, function ($item) use ($cbt_ids) {
                return !in_array($item->id_soal, $cbt_ids);
            });

            if (!empty($missing_ids)) {
                foreach ($missing_ids as $missing) {
                    $rekapsiswa->nilai[] = [
                        "id_bank" => (string)$bank,
                        "id_jadwal" => (string)$jadwal,
                        "id_soal" => (string)$missing->id_soal,
                        "nilai_koreksi" => $missing->koreksi,
                        "nilai_otomatis" => '1',
                        "point_soal" => (string)$point_soal
                    ];
                }
            }

            $updated2 = $this->db->table('cbt_rekap_siswa')->set('nilai', json_encode($rekapsiswa->nilai))->where('id_rekap_siswa', $rekapsiswa->id_rekap_siswa)->update();
        }

        $cbtsiswa = $this->cbt_siswa_model->fields('id_cbt_siswa,nilai,jawaban')->where(['id_siswa' => $siswa, 'id_jadwal' => $jadwal])->get();
        if ($cbtsiswa) {
            $cbtsiswa->nilai = $this->maybe_unserialize($cbtsiswa->nilai);
        }
        $rekapsiswa = $this->rekap_siswa->fields('id_rekap_siswa,nilai')->where(['id_siswa' => $siswa, 'id_jadwal' => $jadwal])->get();
        if ($rekapsiswa) {
            $rekapsiswa->nilai = $this->maybe_unserialize($rekapsiswa->nilai);
        }
        $this->logging->saveLog($this->LOG_TYPE->EDIT, 'Mengkoreksi hasil ujian siswa');

        return $this->output_json([
            'success' => $updated1 && $updated2,
            'cbt_siswa' => $cbtsiswa,
            'miss' => $missing_ids,
            'rekap_siswa' => $rekapsiswa
        ]);
    }

    public function tandaiKoreksi()
    {
        $siswa = $this->request->getPost('siswa');
        $jadwal = $this->request->getPost('jadwal');

        // $this->load->model('Cbt_siswa_model', 'cbt_siswa_model');
        // $this->load->model('Rekap_siswa_model', 'rekap_siswa');
        // $this->load->model('Log_model', 'logging');

        $cbtsiswa = $this->cbt_siswa_model->fields('id_cbt_siswa,nilai_input')->where(['id_jadwal'=> $jadwal, 'id_siswa'=>$siswa])->get();

        $updated = true;
        if ($cbtsiswa) {
            $nilai_input = $this->maybe_unserialize($cbtsiswa->nilai_input ?? '{}');
            $nilai_input->dikoreksi = '1';

            $set_update = ['nilai_input' => json_encode($nilai_input)];
            $updated = $this->db->table('cbt_siswa')->set($set_update)->where('id_cbt_siswa', $cbtsiswa->id_cbt_siswa)->update();
            $data['cbtsiswa'] = $set_update;
        }

        $updated2 = true;
        $rekapsiswa = $this->rekap_siswa->fields('id_rekap_siswa,nilai_input')->where(['id_siswa'=>$siswa, 'id_jadwal'=>$jadwal])->get();
        if ($rekapsiswa) {
            $nilai_input2 = $this->maybe_unserialize($rekapsiswa->nilai_input ?? '{}');
            $nilai_input2->dikoreksi = '1';

            $set_update2 = ['nilai_input' => json_encode($nilai_input2)];
            $updated2 = $this->db->table('cbt_rekap_siswa')->set($set_update2)->where('id_rekap_siswa', $rekapsiswa->id_rekap_siswa)->update();
            $data['rekapsiswa'] = $set_update2;
        }
        $this->logging->saveLog($this->LOG_TYPE->EDIT, 'Mengkoreksi hasil ujian siswa');

        $data['success'] = $updated && $updated2;
        return $this->output_json($data);
    }

    public function mark_all()
    {
        //// $this->load->model('Cbt_model', 'cbt');
        // $this->load->model('Cbt_siswa_model', 'cbt_siswa_model');
        // $this->load->model('Rekap_siswa_model', 'rekap_siswa');
        // $this->load->model('Log_model', 'logging');

        $id_jadwal = $this->request->getPost('id_jadwal');
        $id_kelas = $this->request->getPost('id_kelas');
        $siswas = json_decode($this->request->getPost('id_siswa'));
        $id_siswa = array_column($siswas, 'id_siswa');
        $map_mulai = [];
        foreach ($siswas as $mulai) {
            $map_mulai[$mulai['id_siswa']] = $mulai['memulai'];
        }

        $tp_smt = $this->getTpSmt();
        $tp = $tp_smt->tp_active;
        $smt = $tp_smt->smt_active;

        $cbtsiswa = $this->cbt_siswa_model->fields('id_cbt_siswa,id_siswa,nilai_input')
            ->where(['id_jadwal'=> $id_jadwal])
            ->where('id_siswa', $id_siswa)
            ->get_all();

        if ($cbtsiswa) {
            foreach ($cbtsiswa as $cbt) {
                if (isset($map_mulai[$cbt->id_siswa])) {
                    $nilai_input = json_decode($cbt->nilai_input ?? '{}');
                    $nilai_input->dikoreksi = $map_mulai[$cbt->id_siswa] == '2' ? '0' : '1';
                    $cbt->nilai_input = json_encode($nilai_input);
                }
            }
            if (!empty($cbtsiswa)) {
                \Config\Database::connect()->table('cbt_siswa')->updateBatch((array)$cbtsiswa, 'id_cbt_siswa');
            }
        }

        $rekapsiswa = $this->rekap_siswa->fields('id_rekap_siswa,id_siswa,nilai_input')
            ->where(['id_jadwal'=> $id_jadwal])
            ->where('id_siswa', $id_siswa)
            ->get_all();

        if ($rekapsiswa) {
            foreach ($rekapsiswa as $rekap) {
                if (isset($map_mulai[$rekap->id_siswa])) {
                    $nilai_input2 = json_decode($rekap->nilai_input ?? '{}');
                    $nilai_input2->dikoreksi = $map_mulai[$rekap->id_siswa] == '2' ? '0' : '1';
                    $rekap->nilai_input = json_encode($nilai_input2);
                }
            }
            if (!empty($rekapsiswa)) {
                \Config\Database::connect()->table('cbt_rekap_siswa')->updateBatch((array)$rekapsiswa, 'id_rekap_siswa');
            }
        }

        $this->logging->saveLog($this->LOG_TYPE->EDIT, 'Mengkoreksi hasil ujian siswa');
        $data['success'] = true;
        $data['siswa'] = $siswas;
        $data['rekap'] = (array)$rekapsiswa;
        $data['cbt'] = (array)$cbtsiswa;
        return $this->output_json($data);
    }

    public function simpanNilaiInput()
    {
        // $this->load->model('Cbt_siswa_model', 'cbt_siswa_model');
        // $this->load->model('Rekap_siswa_model', 'rekap_siswa');
        // $this->load->model('Log_model', 'logging');

        $isRekap = $this->request->getPost('is_rekap');
        $jadwal = $this->request->getPost('jadwal');
        $banksoal = $this->request->getPost('bank_soal');
        $nilais = json_decode($this->request->getPost('nilai'));
        $idSiswa = json_decode($this->request->getPost('id_siswa'));

        $cbtSiswa = $this->cbt_siswa_model
            ->fields('id_cbt_siswa,id_siswa,nilai_input,status')
            ->where(['id_jadwal'=> $jadwal])
            ->where('id_siswa', $idSiswa)
            ->get_all();

        $map_cbt = [];
        foreach ($cbtSiswa as $cbt) {
            $map_cbt[$cbt->id_siswa] = $cbt;
        }

        $rekapSiswa = $this->rekap_siswa
            ->fields('id_rekap_siswa,id_siswa,nilai_input,status')
            ->where(['id_jadwal'=> $jadwal])
            ->where('id_siswa', $idSiswa)
            ->get_all();

        $map_rekap = [];
        if ($rekapSiswa) {
            foreach ($rekapSiswa as $rekap) {
                $map_rekap[$rekap->id_siswa] = $rekap;
            }
        }

        $insert_cbt = [];
        $insert_rekap = [];
        $updated = [];
        $rekaped = [];
        $blm_selesai = [];
        foreach ($nilais as $nilai) {
            $adaCbt = isset($map_cbt[$nilai->id_siswa]);
            if ($adaCbt) {
                $siswa = $map_cbt[$nilai->id_siswa];
                if ($siswa->status != '2') {
                    $blm_selesai[] = $siswa->id_siswa;
                } else {
                    $nilai_siswa = json_decode($siswa->nilai_input);
                    $nilai_siswa->kompleks_nilai = isset($nilai->kompleks_nilai) && $nilai->kompleks_nilai != null ? $nilai->kompleks_nilai : '0';
                    $nilai_siswa->jodohkan_nilai = isset($nilai->jodohkan_nilai) && $nilai->jodohkan_nilai != null ? $nilai->jodohkan_nilai : '0';
                    $nilai_siswa->isian_nilai = isset($nilai->isian_nilai) && $nilai->isian_nilai != null ? $nilai->isian_nilai : '0';
                    $nilai_siswa->essai_nilai = isset($nilai->essai_nilai) && $nilai->essai_nilai != null ? $nilai->essai_nilai : '0';
                    $forUpdate = [
                        'id_cbt_siswa' => $map_cbt[$nilai->id_siswa]->id_cbt_siswa,
                        'nilai_input' => json_encode($nilai_siswa)
                    ];
                    $updated[] = $forUpdate;
                }
            } else {
                $nilai_in['id_siswa'] = $nilai->id_siswa;
                $nilai_in['id_jadwal'] = $nilai->id_jadwal;
                $nilai_in['id_bank'] = $banksoal;
                $nilai_in['nilai_input'] = json_encode($nilai);
                $insert_cbt[] = $nilai_in;
            }

            $adaRekap = isset($map_rekap[$nilai->id_siswa]);
            if ($adaRekap) {
                $siswa = $map_rekap[$nilai->id_siswa];
                if ($siswa->status != '2') {
                    $blm_selesai[] = $siswa->id_siswa;
                } else {
                    $nilai_siswa = json_decode($siswa->nilai_input);
                    $nilai_siswa->kompleks_nilai = isset($nilai->kompleks_nilai) && $nilai->kompleks_nilai != null ? $nilai->kompleks_nilai : '0';
                    $nilai_siswa->jodohkan_nilai = isset($nilai->jodohkan_nilai) && $nilai->jodohkan_nilai != null ? $nilai->jodohkan_nilai : '0';
                    $nilai_siswa->isian_nilai = isset($nilai->isian_nilai) && $nilai->isian_nilai != null ? $nilai->isian_nilai : '0';
                    $nilai_siswa->essai_nilai = isset($nilai->essai_nilai) && $nilai->essai_nilai != null ? $nilai->essai_nilai : '0';
                    $forRekap = [
                        'id_rekap_siswa' => $map_rekap[$nilai->id_siswa]->id_rekap_siswa,
                        'nilai_input' => json_encode($nilai_siswa)
                    ];
                    $rekaped[] = $forRekap;
                }
            } else {
                $nilai_in['id_siswa'] = $nilai->id_siswa;
                $nilai_in['id_jadwal'] = $nilai->id_jadwal;
                $nilai_in['id_bank'] = $banksoal;
                $nilai_in['nilai_input'] = json_encode($nilai);
                $insert_rekap[] = $nilai_in;
            }
        }
        if (count($updated) > 0) {
            \Config\Database::connect()->table('cbt_siswa')->updateBatch($updated, 'id_cbt_siswa');
        }
        if (count($rekaped) > 0) {
            \Config\Database::connect()->table('cbt_rekap_siswa')->updateBatch($rekaped, 'id_rekap_siswa');
        }
        $this->logging->saveLog($this->LOG_TYPE->EDIT, 'Menginput nilai ujian siswa');
        $data['success'] = true;
        $data['data'] = $updated;
        $data['cbt'] = $cbtSiswa;
        $data['insert_cbt'] = $insert_cbt;
        $data['insert_rekap'] = $insert_rekap;
        $data['blm_selesai'] = count($blm_selesai);
        return $this->output_json($data);
    }

    // new analysis
    // Fungsi untuk normalisasi data
    protected function normalizeData($siswa, $kunci)
    {
        $normalizedData = [];
        foreach ($siswa as $jawaban) {
            $filteredJawaban = [];
            foreach ($kunci as $key => $value) {
                if (isset($jawaban[$key])) {
                    $filteredJawaban[$key] = $jawaban[$key];
                }
            }
            $normalizedData[] = $filteredJawaban;
        }
        return $normalizedData;
    }

    // Fungsi untuk menghitung tingkat kesulitan, daya pembeda, dan validitas
    protected function analyzeData($siswa, $kunci, $opsi)
    {
        $results = [];
        $totalStudents = count($siswa);

        // Hitung total skor setiap siswa
        $totalScores = [];
        $responseSiswa = [];
        foreach ($siswa as $jawabanSiswa) {
            $score = 0;
            $response = [];
            foreach ($kunci as $key => $correctAnswer) {
                if (isset($jawabanSiswa[$key]) && strtoupper($jawabanSiswa[$key] ?? '') == strtoupper($correctAnswer ?? '')) {
                    $score++;
                    $response[] = 1;
                } else {
                    $response[] = 0;
                }
            }
            $totalScores[] = $score;
            $responseSiswa[] = $response;
        }

        // Kelompokkan siswa berdasarkan skor
        array_multisort($totalScores, SORT_DESC, $siswa);
        $upperGroup = array_slice($siswa, 0, ceil(0.27 * $totalStudents));
        $lowerGroup = array_slice($siswa, -ceil(0.27 * $totalStudents));

        // Analisis per soal
        foreach ($kunci as $key => $correctAnswer) {
            $totalCorrect = 0;
            $upperCorrect = 0;
            $lowerCorrect = 0;

            $choices = ['A', 'B', 'C']; // Asumsi pilihan jawaban
            if ($opsi == '4') {
                $choices[] = 'D';
            } elseif ($opsi == '5') {
                $choices[] = 'D';
                $choices[] = 'E';
            }
            $distraktor = array_fill_keys($choices, ['top' => 0, 'bottom' => 0, 'total' => 0]);

            foreach ($siswa as $jawabanSiswa) {
                if (isset($jawabanSiswa[$key]) && strtoupper($jawabanSiswa[$key] ?? '') == strtoupper($correctAnswer ?? '')) {
                    $totalCorrect++;
                }
                $jawaban = strtoupper($jawabanSiswa[$key] ?? '');
                if (in_array($jawaban, $choices)) {
                    $distraktor[$jawaban]['total']++;
                }
            }
            $discriminationUpper = 0;
            if (count($upperGroup) > 0) {
                foreach ($upperGroup as $jawabanSiswa) {
                    if (isset($jawabanSiswa[$key]) && strtoupper($jawabanSiswa[$key] ?? '') == strtoupper($correctAnswer ?? '')) {
                        $upperCorrect++;
                    }
                    $jawaban = strtoupper($jawabanSiswa[$key] ?? '');
                    if (in_array($jawaban, $choices)) {
                        $distraktor[$jawaban]['top']++;
                    }
                }
                $discriminationUpper = $upperCorrect / count($upperGroup);
            }

            $discriminationLower = 0;
            if (count($lowerGroup) > 0) {
                foreach ($lowerGroup as $jawabanSiswa) {
                    if (isset($jawabanSiswa[$key]) && strtoupper($jawabanSiswa[$key] ?? '') == strtoupper($correctAnswer ?? '')) {
                        $lowerCorrect++;
                    }
                    $jawaban = strtoupper($jawabanSiswa[$key] ?? '');
                    if (in_array($jawaban, $choices)) {
                        $distraktor[$jawaban]['bottom']++;
                    }
                }
                $discriminationLower = $lowerCorrect / count($lowerGroup);
            }

            $difficulty = $totalStudents > 0 ? $totalCorrect / $totalStudents : 0;
            $discrimination = $discriminationUpper - $discriminationLower;

            // Hitung validitas (korelasi biserial)
            $correctResponses = array_map(function ($jawabanSiswa) use ($key, $correctAnswer) {
                return (isset($jawabanSiswa[$key]) && strtoupper($jawabanSiswa[$key] ?? '') == strtoupper($correctAnswer ?? '')) ? 1 : 0;
            }, $siswa);

            $validity = $this->calculateBiserialCorrelation($correctResponses, $totalScores);

            /*
             * tingkat kesulitan
             * Mudah:  P > 0.70
             * Sedang: 0.30 ≤ P ≤ 0.70
             * Sulit: P < 0.30
             */
            $kesulitan = round($difficulty, 2);
            if ($kesulitan >= 0.70) {
                $lvl_sulit = 'Mudah';
            } elseif ($kesulitan < 0.30) {
                $lvl_sulit = 'Sulit';
            } else {
                $lvl_sulit = 'Sedang';
            }

            /*
             * DAYA PEMBEDA
             * D > 0.40: Baik
             * 0.20 ≤ D ≤ 0.40: Cukup
             * D < 0.20: Buruk
             */
            $pembeda = round($discrimination, 2);
            if ($pembeda >= 0.70) {
                $lvl_pembeda = 'Sangat Baik';
            } else if ($pembeda > 0.39 && $pembeda < 0.70) {
                $lvl_pembeda = 'Baik';
            } else if ($pembeda < 0.20) {
                $lvl_pembeda = 'Jelek';
            } else {
                $lvl_pembeda = 'Cukup';
            }

            /*
             * VALIDITAS
             * r ≥ 0.70: Sangat valid
             * 0.30 ≤ r <0.70: Valid
             * r < 0.30: Tidak valid
             */
            $validitas = round($validity, 2);
            if ($validitas >= 0.70) {
                $lvl_valid = 'Sangat Valid';
            } else if ($validitas < 0.30) {
                $lvl_valid = 'Tidak Valid';
            } else {
                $lvl_valid = 'Valid';
            }

            // Tambahkan analisis distraktor ke hasil
            $distractorAnalysis = [];
            foreach ($distraktor as $choice => $data) {
                $top = count($upperGroup) > 0 ? $data['top'] / count($upperGroup) : 0;
                $bottom = count($lowerGroup) > 0 ? $data['bottom'] / count($lowerGroup) : 0;
                $total = $totalStudents > 0 ? $data['total'] / $totalStudents : 0;

                $distractorAnalysis[$choice] = [
                    'IKD_top' => round($top, 2),
                    'IKD_bottom' => round($bottom, 2),
                    'IKD_total' => round($total, 2),
                ];
            }

            $results[$key] = [
                "soal" => $key,
                "jawaban_benar" => $correctAnswer,
                "tingkat_kesulitan" => $kesulitan,
                "level_kesulitan" => $lvl_sulit,
                "daya_pembeda" => $pembeda,
                "level_pembeda" => $lvl_pembeda,
                "validitas" => $validitas,
                "level_validitas" => $lvl_valid,
                "distraktor" => $distractorAnalysis
            ];
        }
        $alphaCronbach = $this->calculateAlphaCronbach($responseSiswa);
        $kr20 = $this->calculateKR20($responseSiswa);
        $kr20 = round($kr20, 2);
        /*
         * > 0.90	    Sangat tinggi (excellent)
         * 0.80 - 0.89	Tinggi (good)
         * 0.70 - 0.79	Cukup (acceptable)
         * 0.60 - 0.69	Rendah (questionable)
         * 0.50 - 0.59	Sangat rendah (poor)
         * < 0.50	    Tidak dapat diterima (unacceptable)
         */
        if ($kr20 >= 0.90) {
            $ket = 'Sangat tinggi (Excellent)';
        } elseif ($kr20 > 0.79 && $kr20 < 0.90) {
            $ket = 'Tinggi (good)';
        } elseif ($kr20 > 0.69 && $kr20 < 0.80) {
            $ket = 'Cukup (acceptable)';
        } elseif ($kr20 > 0.59 && $kr20 < 0.70) {
            $ket = 'Rendah (questionable)';
        } elseif ($kr20 > 0.49 && $kr20 < 0.60) {
            $ket = 'Sangat rendah (poor)';
        } else {
            $ket = 'Tidak dapat diterima (unacceptable)';
        }
        $results['reliabilitas'] = [
            "alpha_cronbach" => round($alphaCronbach, 2),
            "kr20" => $kr20,
            "ket" => $ket
        ];

        return $results;
    }

    // Fungsi untuk menghitung korelasi biserial
    protected function calculateBiserialCorrelation($responses, $totalScores)
    {
        $sum = array_sum($totalScores);
        $stdDevTotal = 0;
        $p = 0;
        $q = 0;
        $meanCorrect = 0;
        $meanTotal = 0;
        if ($sum > 0) {
            $meanTotal = array_sum($totalScores) / count($totalScores);
            $stdDevTotal = sqrt(array_sum(array_map(function ($score) use ($meanTotal) {
                    return pow($score - $meanTotal, 2);
                }, $totalScores)) / count($totalScores));

            $meanCorrect = array_sum(array_filter($totalScores, function ($score, $index) use ($responses) {
                    return $responses[$index] == 1;
                }, ARRAY_FILTER_USE_BOTH)) / max(1, array_sum($responses));

            $p = array_sum($responses) / count($responses);
            $q = 1 - $p;
        }

        //return ($meanCorrect - $meanTotal) / $stdDevTotal * sqrt($p * $q);
        return ($stdDevTotal > 0 && $p > 0 && $q > 0)
            ? ($meanCorrect - $meanTotal) / $stdDevTotal * sqrt($p * $q)
            : 0;
    }

    private function calculateAlphaCronbach($responses) {
        $numStudents = count($responses);
        $numQuestions = isset($responses[0]) ? count($responses[0]) : 0;

        // Cek apakah data cukup untuk dihitung
        if ($numStudents < 2 || $numQuestions < 2) {
            return 0; // Tidak cukup data
        }

        // Hitung skor total per siswa
        $totalScores = array_map('array_sum', $responses);
        $sum = array_sum($totalScores);
        $meanTotal = $sum / $numStudents;

        // Hitung varian total skor
        $varTotal = array_sum(array_map(function($score) use ($meanTotal) {
                return pow($score - $meanTotal, 2);
            }, $totalScores)) / $numStudents;

        if ($varTotal == 0) {
            return 0; // Variasi total tidak ada, alpha tidak bisa dihitung
        }

        // Hitung varian per soal
        $itemVariances = [];
        for ($i = 0; $i < $numQuestions; $i++) {
            $itemScores = array_column($responses, $i);
            $meanItem = array_sum($itemScores) / $numStudents;

            $itemVariances[$i] = array_sum(array_map(function($score) use ($meanItem) {
                    return pow($score - $meanItem, 2);
                }, $itemScores)) / $numStudents;
        }

        $sumItemVariance = array_sum($itemVariances);

        if ($sumItemVariance == 0 || $numQuestions <= 1) {
            return 0; // Tidak cukup variasi soal atau soal terlalu sedikit
        }

        // Hitung Alpha Cronbach
        $alpha = ($numQuestions / ($numQuestions - 1)) * (1 - ($sumItemVariance / $varTotal));
        return $alpha;
    }

    private function calculateKR20($responses) {
        $numStudents = count($responses);
        $numQuestions = isset($responses[0]) ? count($responses[0]) : 0;

        // Validasi awal: minimal 2 siswa dan 2 soal
        if ($numStudents < 2 || $numQuestions < 2) {
            return 0;
        }

        // Hitung skor total tiap siswa
        $totalScores = array_map('array_sum', $responses);
        $sum = array_sum($totalScores);
        $meanTotal = $sum / $numStudents;

        // Hitung varian total skor
        $varTotal = array_sum(array_map(function($score) use ($meanTotal) {
                return pow($score - $meanTotal, 2);
            }, $totalScores)) / $numStudents;

        if ($varTotal == 0) {
            return 0; // Variasi total tidak ada, KR-20 tidak dapat dihitung
        }

        // Hitung jumlah pq tiap soal
        $pqSum = 0;
        for ($i = 0; $i < $numQuestions; $i++) {
            $itemScores = array_column($responses, $i);
            $p = array_sum($itemScores) / $numStudents;
            $q = 1 - $p;
            $pqSum += $p * $q;
        }

        if ($pqSum == 0) {
            return 0; // Tidak ada variasi antar item
        }

        // Hitung KR-20
        $kr20 = ($numQuestions / ($numQuestions - 1)) * (1 - ($pqSum / $varTotal));
        return $kr20;
    }

    public function get_web_info()
    {
        // Mengatur header CORS untuk mengizinkan permintaan lintas-origin
        // Di produksi, ganti '*' dengan domain frontend Anda yang spesifik (misal: 'http://localhost:8080')
        header('Access-Control-Allow-Origin: '.base_url());
        header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');
        header('Content-Type: application/json');

        // Tangani permintaan OPTIONS (preflight request untuk CORS)
        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
            //http_response_code(200);
            //exit();
            $data['success'] = false;
            $data['message'] = 'http_response_code(200)';
            return $this->output_json($data);
        }

        // Ambil URL dari POST request
        // CodeIgniter secara otomatis mem-parsing JSON body jika Content-Type adalah application/json
        $url = $this->request->getPost('url_address');

        if (empty($url)) {
            //echo json_encode(['error' => 'URL tidak disediakan.']);
            //$this->output->set_status_header(400); // Mengatur status HTTP
            //exit();

            $data['success'] = false;
            $data['message'] = 'URL tidak disediakan.';
            return $this->output_json($data);
        }

        // Validasi URL dasar
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            //echo json_encode(['error' => 'URL tidak valid.']);
            //$this->output->set_status_header(400);
            //exit();
            $data['success'] = false;
            $data['message'] = 'URL tidak valid.';
            return $this->output_json($data);
        }

        $extracted_info = [
            'title' => 'Tidak ada judul',
            'description' => 'Tidak ada deskripsi yang tersedia.',
            'image' => '',
            'url' => $url,
            'siteName' => parse_url($url, PHP_URL_HOST)
        ];

        try {
            // Menggunakan cURL untuk mengambil konten URL
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_MAXREDIRS, 5);
            curl_setopt($ch, CURLOPT_TIMEOUT, 15);
            //curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0');
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36',
                'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
                'Accept-Language: en-US,en;q=0.9,id;q=0.8',
                'Referer: ' . $url,
                'Cache-Control: no-cache',
                'Pragma: no-cache',
                'Connection: keep-alive',
                'Upgrade-Insecure-Requests: 1',
                'DNT: 1'
            ]);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_ENCODING, "");
            $html = curl_exec($ch);

            if (curl_errno($ch)) {
                throw new \Exception('cURL Error: ' . curl_error($ch));
            }
            curl_close($ch);

            if ($html == false || empty($html)) {
                throw new \Exception('Gagal mengambil konten dari URL.');
            }

            // Menggunakan DOMDocument untuk mem-parsing HTML
            $dom = new \DOMDocument();
            @$dom->loadHTML($html);
            $xpath = new \DOMXPath($dom);

            // Ekstrak Open Graph (OG) tags
            $og_title = $xpath->query('//meta[@property="og:title"]/@content')->item(0);
            $og_description = $xpath->query('//meta[@property="og:description"]/@content')->item(0);
            $og_image = $xpath->query('//meta[@property="og:image"]/@content')->item(0);
            $og_site_name = $xpath->query('//meta[@property="og:site_name"]/@content')->item(0);
            $og_url = $xpath->query('//meta[@property="og:url"]/@content')->item(0);

            if ($og_title) $extracted_info['title'] = $og_title->nodeValue;
            if ($og_description) $extracted_info['description'] = $og_description->nodeValue;
            if ($og_image) $extracted_info['image'] = $og_image->nodeValue;
            if ($og_site_name) $extracted_info['siteName'] = $og_site_name->nodeValue;
            if ($og_url) $extracted_info['url'] = $og_url->nodeValue;

            // Fallback jika OG tags tidak ada
            if ($extracted_info['title'] == 'Tidak ada judul') {
                $title_tag = $xpath->query('//title')->item(0);
                if ($title_tag) $extracted_info['title'] = $title_tag->nodeValue;
            }
            if ($extracted_info['description'] == 'Tidak ada deskripsi yang tersedia.') {
                $meta_description = $xpath->query('//meta[@name="description"]/@content')->item(0);
                if ($meta_description) $extracted_info['description'] = $meta_description->nodeValue;
            }
            if ($extracted_info['description'] == 'Tidak ada deskripsi yang tersedia.') {
                $meta_description = $xpath->query('//meta[@name="description"]/@content')->item(0);
                if ($meta_description) $extracted_info['description'] = $meta_description->nodeValue;
            }
            if (empty($extracted_info['image'])) {
                $link_image_src = $xpath->query('//link[@rel="image_src"]/@href')->item(0);
                if ($link_image_src) {
                    $extracted_info['image'] = $link_image_src->nodeValue;
                } else {
                    // Coba ambil gambar pertama dari body
                    $first_img = $xpath->query('//img')->item(0);
                    if ($first_img) $extracted_info['image'] = $first_img->getAttribute('src');
                }
            }

            // Pastikan URL gambar adalah absolut
            if (!empty($extracted_info['image']) && !preg_match('/^https?:\/\//i', $extracted_info['image'])) {
                $base_url_parts = parse_url($url);
                $scheme = isset($base_url_parts['scheme']) ? $base_url_parts['scheme'] . '://' : '';
                $host = isset($base_url_parts['host']) ? $base_url_parts['host'] : '';
                $path = isset($base_url_parts['path']) ? dirname($base_url_parts['path']) : '';

                $base_for_relative = rtrim($scheme . $host . $path, '/') . '/';
                $extracted_info['image'] = $base_for_relative . ltrim($extracted_info['image'], '/');
            }

        } catch (\Exception $e) {
            //echo json_encode(['error' => 'Gagal mengambil atau mem-parsing informasi dari URL: ' . $e->getMessage()]);
            //$this->output->set_status_header(500);
            //exit();
            $data['success'] = false;
            $data['message'] = 'Gagal mengambil atau mem-parsing informasi dari URL: ' . $e->getMessage();
            return $this->output_json($data);
        }

        // Mengirimkan informasi yang diekstrak sebagai respons JSON
        //echo json_encode($extracted_info);
        //exit(); // Penting untuk menghentikan eksekusi setelah mengirim JSON

        $data['success'] = true;
        $data['info'] = $extracted_info;
        return $this->output_json($data);

    }
}


