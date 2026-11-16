<?php
/*   ________________________________________
    |               NextGen Garuda CBT       |
    |    Protected & Distributed via GitHub  |
    |________________________________________|
*/
/**
 * Created by IntelliJ IDEA.
 * User: BangRohman
 * Date: 25/06/2021
 * Time: 11:18
 */
namespace App\Controllers;

class Bukurapor extends BaseController
{
 protected $db;
 protected $rapor;
 protected $kelas;
 protected $dropdown;
 protected $master;
 protected $dashboard;
 protected $logging;
 protected $raporKurmer;
 public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $_0xe10c)
 {
 goto L_793fe;
 L_03722:
 $this->logging = new \App\Models\LogModel();
 goto L_d11b0;
 L_46d15:
 $this->kelas = new \App\Models\KelasModel();
 goto L_0b702;
 L_58b7d:
 $this->raporKurmer = new \App\Models\RaporKurmerModel();
 goto L_46d15;
 L_6e70c:
 $this->dashboard = new \App\Models\DashboardModel();
 goto L_03722;
 L_ff716:
 $this->master = new \App\Models\MasterModel();
 goto L_6e70c;
 L_d11b0:
 $this->db = \Config\Database::connect();
 L_793fe:
 parent::initController($request, $response, $_0xe10c);
 goto L_3fb42;
 L_3fb42:
 $this->rapor = new \App\Models\RaporModel();
 goto L_58b7d;
 L_0b702:
 $this->dropdown = new \App\Models\DropdownModel();
 goto L_ff716;
 }
 public function index()
 {
 goto L_06e83;
 L_158e9:
 $_0x8246 = $this->request->getGet("\x6a\156\x73") ?: "\x32";
 goto L_7dde8;
 L_9c05c:
 $_0xc80f = $this->dashboard->getSetting();
 goto L_d9e03;
 L_eb0df:
 $_0x47f8 = $_0x7019 ? $this->kelas->get_one($_0x7019) : (object) ["\x6e\141\x6d\141\x5f\153\x65\154\x61\163" => "\x2d", "\x69\144\x5f\153\x65\154\x61\163" => 0];
 goto L_cbd3e;
 L_7dde8:
 // 2: Akhir (SAS), 1: Tengah (STS)
 $_0xb788 = $this->dashboard->getTahunActive();
 goto L_23c21;
 L_bc713:
 $_0x6661 = [];
 goto L_b7b3f;
 L_a70ed:
 $_0xc098 = $this->raporKurmer->getSetting($_0xfe96, $_0x6e47);
 goto L_7e524;
 L_632b9:
 $_0x447c = $_0xfe96 ? $this->dashboard->getTahunById($_0xfe96) : $_0xb788;
 goto L_3d58d;
 L_06e83:
 $_0xfe96 = $this->request->getGet("\x74\160");
 goto L_276b2;
 L_fcbac:
 $_0xbf60 = session()->get("\x72\157\x6c\145");
 goto L_2e4f6;
 L_b7f22:
 $_0x1217 = $_0x1023->is_kemenag;
 goto L_a2396;
 L_2e4f6:
 $_0xbe67 = (object) ["\x69\144" => session()->get("\x69\144\x5f\165\x73\145\x72"), "\x75\163\x65\162\x6e\141\x6d\145" => session()->get("\x75\163\x65\162\x6e\141\x6d\145")];
 goto L_9c05c;
 L_31674:
 if (!$_0x6e47) {
 $_0x6e47 = $_0x1797 ? $_0x1797->id_smt : null;
 }
 goto L_632b9;
 L_23c21:
 $_0x1797 = $this->dashboard->getSemesterActive();
 goto L_bdd82;
 L_3d58d:
 $_0xc485 = $_0x6e47 ? $this->dashboard->getSemesterById($_0x6e47) : $_0x1797;
 goto L_fcbac;
 L_276b2:
 $_0x6e47 = $this->request->getGet("\x73\155\x74");
 goto L_5c60f;
 L_d9e03:
 if ($_0xbf60 == 1 || empty($_0xbf60)) {
 $_0xca12 = $_0xfe96 && $_0x6e47 ? $this->dropdown->getAllKelas($_0xfe96, $_0x6e47) : [];
 $_0xdede = null;
 } else {
 $_0xdede = $this->dashboard->getDataGuruByUserId(session()->get("\x69\144\x5f\165\x73\145\x72"), $_0xfe96, $_0x6e47);
 $_0xca12 = $_0xdede && !empty($_0xdede->wali_kelas) ? $this->dropdown->getAllKelasByArrayId($_0xfe96, $_0x6e47, $_0xdede->wali_kelas) : [];
 }
 goto L_bc713;
 L_dd308:
 $_0x504d = ["\x75\163\x65\162" => $_0xbe67, "\x67\165\x72\165" => $_0xdede, "\x6a\165\x64\165\x6c" => "\x4b\165\x6d\160\x75\154\x61\156\x20\116\x69\154\x61\151\x20\122\x61\160\x6f\162", "\x73\165\x62\152\x75\144\x75\154" => "\x4c\141\x70\157\x72\141\x6e\40\x48\141\x73\151\x6c\40\x42\145\x6c\141\x6a\141\x72\40\x50\145\x73\145\x72\164\x61\40\x44\151\x64\151\x6b\40\x2d\40\x4b\165\x72\151\x6b\165\x6c\165\x6d\40\x4d\145\x72\144\x65\153\x61", "\x73\145\x74\164\x69\156\x67" => $_0xc80f, "\x73\141\x74\165\x61\156\x5f\156\x61\155\x61" => $_0xf2b2, "\x69\163\x5f\153\x65\155\x65\156\x61\147" => $_0x1217, "\x69\163\x5f\163\x64" => $_0x1023->is_sd, "\x73\143\x68\157\x6f\154\x5f\164\x79\160\x65" => $_0x4c30, "\x74\160" => $this->dashboard->getTahun(), "\x74\160\x5f\141\x63\164\x69\166\x65" => $_0x447c, "\x73\155\x74" => $this->dashboard->getSemester(), "\x73\155\x74\137\x61\143\x74\151\x76\145" => $_0xc485, "\x74\160\x5f\163\x65\154\x65\143\x74\145\x64" => $_0xfe96, "\x73\155\x74\137\x73\145\x6c\145\x63\164\x65\144" => $_0x6e47, "\x6b\154\x73\137\x73\145\x6c\145\x63\164\x65\144" => $_0x7019, "\x6a\156\x73\137\x73\145\x6c\145\x63\164\x65\144" => $_0x8246, "\x6b\145\x6c\141\x73\145\x73" => $_0xca12, "\x6b\145\x6c\141\x73\137\x63\157\x75\156\x74" => $_0x6661, "\x6b\145\x6c\141\x73" => $_0x47f8, "\x73\151\x73\167\x61\163" => $_0xb4bb, "\x72\141\x70\157\x72\137\x73\145\x74\164\x69\156\x67" => $_0xc098, "\x69\163\x5f\141\x64\155\x69\156" => $_0xbf60 == 1 || empty($_0xbf60)];
 goto L_c4079;
 L_4911c:
 if (!$_0x7019 && !empty($_0xca12)) {
 // Prioritaskan kelas pertama yang memiliki siswa di semester & TP ini
 $_0xd97b = null;
 foreach ($_0xca12 as $_0x9972 => $_0x1246) {
 if (($_0x6661[$_0x9972] ?? 0) > 0) {
 $_0xd97b = $_0x9972;
 break;
 }
 }
 $_0x7019 = $_0xd97b ?: array_key_first($_0xca12);
 }
 goto L_eb0df;
 L_5c60f:
 $_0x7019 = $this->request->getGet("\x6b\154\x73");
 goto L_158e9;
 L_b7b3f:
 if (!empty($_0xca12)) {
 foreach ($_0xca12 as $_0x9972 => $_0x1246) {
 $_0x6661[$_0x9972] = $this->db->table("\x6b\145\x6c\141\x73\137\x73\151\x73\167\x61")->where("\x69\144\x5f\153\x65\154\x61\163", $_0x9972)->where("\x69\144\x5f\164\x70", $_0xfe96)->where("\x69\144\x5f\163\x6d\164", $_0x6e47)->countAllResults();
 }
 }
 goto L_4911c;
 L_c4079:
 return view("\x72\141\x70\157\x72\57\x61\162\x73\151\x70\162\x61\160\x6f\162", $_0x504d);
 L_7e524:
 $_0x1023 = detectSchoolType($_0xc80f);
 goto L_e6598;
 L_e6598:
 $_0xf2b2 = $_0x1023->satuan_nama;
 goto L_b7f22;
 L_bdd82:
 if (!$_0xfe96) {
 $_0xfe96 = $_0xb788 ? $_0xb788->id_tp : null;
 }
 goto L_31674;
 L_a2396:
 $_0x4c30 = $_0x1023->school_type;
 goto L_dd308;
 L_cbd3e:
 $_0xb4bb = $_0x7019 && $_0xfe96 && $_0x6e47 ? $this->rapor->getDetailSiswa($_0x7019, $_0xfe96, $_0x6e47) : [];
 goto L_a70ed;
 }
 public function getRaporSiswaLengkap($_0x9fcd, $_0xf135)
 {
 try {
 $_0xde7c = $this->request->getGet("\x74\160");
 $_0x74c5 = $this->request->getGet("\x73\155\x74");
 $_0x141d = $_0xde7c ? $this->dashboard->getTahunById($_0xde7c) : $this->dashboard->getTahunActive();
 $_0x7bde = $_0x74c5 ? $this->dashboard->getSemesterById($_0x74c5) : $this->dashboard->getSemesterActive();
 $_0xf5a9 = $this->raporKurmer->getRaporSiswaLengkap($_0x9fcd, $_0xf135, $_0x141d->id_tp, $_0x7bde->id_smt);
 return $this->output_json(["\x73\164\x61\164\x75\163" => true, "\x64\141\x74\141" => $_0xf5a9]);
 } catch (\Throwable $_0x1e7b) {
 log_message("\x65\162\x72\157\x72", "\x45\162\x72\157\x72\40\x69\156\x20\147\x65\164\x52\141\x70\157\x72\123\x69\163\x77\141\x4c\145\x6e\147\x6b\141\x70\72\x20" . $_0x1e7b->getMessage());
 return $this->output_json(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => $_0x1e7b->getMessage()]);
 }
 }
 public function getDataKelas()
 {
 goto L_872d0;
 L_8f6a9:
 $_0x2d83 = $this->request->getGet("\x73\155\x74");
 goto L_52f40;
 L_52f40:
 $_0x620b = $this->request->getGet("\x6b\154\x73");
 goto L_8e84b;
 L_8e84b:
 $_0x625f = (object) ["\x69\144" => session()->get("\x69\144\x5f\165\x73\145\x72"), "\x75\163\x65\162\x6e\141\x6d\145" => session()->get("\x75\163\x65\162\x6e\141\x6d\145")];
 goto L_296cf;
 L_296cf:
 $_0xb72a = null;
 goto L_24754;
 L_1c80a:
 return $this->output_json(["\x6b\145\x6c\141\x73" => $_0x53fb, "\x6a\141\x62\141\x74\141\x6e" => $_0xb72a]);
 L_872d0:
 $_0x8344 = $this->request->getGet("\x74\160");
 goto L_8f6a9;
 L_24754:
 if (session()->get("\x72\157\x6c\145") == 1) {
 $_0x53fb = $this->dropdown->getAllKelas($_0x8344, $_0x2d83);
 } else {
 $_0xad72 = $this->dashboard->getDataGuruByUserId(session()->get("\x69\144\x5f\165\x73\145\x72"), $_0x8344, $_0x2d83);
 //$guru = $this->dashboard->getDataGuruByUsername($user->username, $id_tp, $id_smt);
 $_0xe75a[$_0xad72->id_guru] = $_0xad72->nama_guru;
 $_0x53fb = $this->dropdown->getAllKelasByArrayId($_0x8344, $_0x2d83, [$_0x620b]);
 $_0xb72a = $this->master->getAllJabatanGuru($_0xad72->id_guru);
 }
 goto L_1c80a;
 }
 public function backupNilai()
 {
 goto L_4389a;
 L_fd504:
 $_0x9543 = $this->dashboard->getSemester();
 goto L_dc67d;
 L_5cc7c:
 $_0x5b0e = [];
 goto L_c0d11;
 L_77d3f:
 return $this->output_json($_0x220e);
 L_ab9b6:
 $_0x4c04 = $this->master->getAllMapel();
 goto L_66d70;
 L_bd2d9:
 $_0xdb93 = [];
 goto L_a7df7;
 L_5c0b1:
 $_0x2880 = $this->rapor->getAllFisik();
 goto L_1bcd8;
 L_66d70:
 $_0x4611 = [];
 goto L_5dc9e;
 L_3f0bf:
 $_0x77f8 = $this->rapor->getAllNilaiEkstra();
 goto L_aae75;
 L_3aded:
 $_0x220e["\x69\144\x73"] = $_0x4911;
 goto L_77d3f;
 L_ad25b:
 $_0x3526 = $this->dashboard->getTahun();
 goto L_fd504;
 L_dc67d:
 $_0x208b = $this->master->getAllWaliKelas();
 goto L_ab9b6;
 L_5dc9e:
 $_0xe7c9 = $this->rapor->getAllEkstra();
 goto L_d1108;
 L_a7df7:
 foreach ($_0xd527 as $_0xb045) {
 //id_siswa
 $_0xa201 = $_0xa405[$_0xb045->id_tp][$_0xb045->id_smt]->kkm_tunggal == "\x31";
 $_0x78ee = null;
 $_0xea68 = [];
 if (isset($_0xa6e3[$_0xb045->id_tp]) && isset($_0xa6e3[$_0xb045->id_tp][$_0xb045->id_smt]) && isset($_0xa6e3[$_0xb045->id_tp][$_0xb045->id_smt][$_0xb045->id_kelas])) {
 $_0xea68 = $_0xa6e3[$_0xb045->id_tp][$_0xb045->id_smt][$_0xb045->id_kelas];
 $_0x78ee = isset($_0xea68[1]) && isset($_0xea68[1][$_0xb045->id_mapel]) ? $_0xea68[1][$_0xb045->id_mapel] : null;
 }
 foreach ($_0x4c04 as $_0x972f) {
 if ($_0x972f->id_mapel == $_0xb045->id_mapel) {
 $_0xce19[$_0xb045->id_siswa][] = ["\x69\144\x5f\155\x61\160\x65\154" => $_0xb045->id_mapel, "\x6d\141\x70\145\x6c" => $_0xb045->mapel, "\x6b\153\x6d" => $_0xa201 ? $_0xa405[$_0xb045->id_tp][$_0xb045->id_smt]->kkm : ($_0x78ee == null ? '' : $_0x78ee->kkm), "\x70\137\x6e\151\x6c\141\x69" => $_0xb045->p_rata_rata, "\x70\137\x70\162\x65\144" => $_0xb045->p_predikat, "\x70\137\x64\145\x73\153" => $_0xb045->p_deskripsi, "\x6b\137\x6e\151\x6c\141\x69" => $_0xb045->k_rata_rata, "\x6b\137\x70\162\x65\144" => $_0xb045->k_predikat, "\x6b\137\x64\145\x73\153" => $_0xb045->k_deskripsi];
 $_0xc138[$_0xb045->id_siswa][] = ["\x69\144\x5f\155\x61\160\x65\154" => $_0xb045->id_mapel, "\x6d\141\x70\145\x6c" => $_0xb045->mapel, "\x6b\153\x6d" => $_0xa201 ? $_0xa405[$_0xb045->id_tp][$_0xb045->id_smt]->kkm : ($_0x78ee == null ? '' : $_0x78ee->kkm), "\x6e\151\x6c\141\x69" => $_0xb045->nilai_pts, "\x70\162\x65\144" => $_0xb045->pts_predikat];
 $_0x5b0e[$_0xb045->id_siswa][] = ["\x69\144\x5f\155\x61\160\x65\154" => $_0xb045->id_mapel, "\x6d\141\x70\145\x6c" => $_0xb045->mapel, "\x6b\153\x6d" => $_0xa201 ? $_0xa405[$_0xb045->id_tp][$_0xb045->id_smt]->kkm : ($_0x78ee == null ? '' : $_0x78ee->kkm), "\x6e\151\x6c\141\x69" => $_0xb045->nilai_pas];
 $_0x294b[$_0xb045->id_siswa][] = ["\x69\144\x5f\155\x61\160\x65\154" => $_0xb045->id_mapel, "\x6d\141\x70\145\x6c" => $_0xb045->mapel, "\x6b\153\x6d" => $_0xa201 ? $_0xa405[$_0xb045->id_tp][$_0xb045->id_smt]->kkm : ($_0x78ee == null ? '' : $_0x78ee->kkm), "\x6e\151\x6c\141\x69" => $_0xb045->nilai_rapor, "\x70\162\x65\144" => $_0xb045->rapor_predikat];
 }
 }
 $_0xdb93 = [];
 if (isset($_0x77f8[$_0xb045->id_tp]) && isset($_0x77f8[$_0xb045->id_tp][$_0xb045->id_smt]) && isset($_0x77f8[$_0xb045->id_tp][$_0xb045->id_smt][$_0xb045->id_siswa])) {
 foreach ($_0x77f8[$_0xb045->id_tp][$_0xb045->id_smt][$_0xb045->id_siswa] as $_0x8888) {
 $_0x9b59 = '';
 if (isset($_0xea68[2]) && isset($_0xea68[2][$_0x8888->id_ekstra])) {
 $_0x9b59 = $_0xea68[2][$_0x8888->id_ekstra]->kkm;
 }
 $_0xdb93[$_0xb045->id_siswa][] = ["\x6d\141\x70\145\x6c" => $_0x8888->kode_ekstra, "\x69\144\x5f\145\x6b\163\x74\162\x61" => $_0x8888->id_ekstra, "\x6e\141\x6d\141\x5f\145\x6b\163\x74\162\x61" => $_0x8888->nama_ekstra, "\x6b\153\x6d" => $_0xa201 ? $_0xa405[$_0xb045->id_tp][$_0xb045->id_smt]->kkm : $_0x9b59, "\x6e\151\x6c\141\x69" => $_0x8888->nilai, "\x70\162\x65\144" => $_0x8888->predikat, "\x64\145\x73\153" => $_0x8888->deskripsi];
 }
 }
 $_0x2a0b = null;
 $_0xc7cb = null;
 if (isset($_0x3d65[$_0xb045->id_tp]) && isset($_0x3d65[$_0xb045->id_tp][$_0xb045->id_smt]) && isset($_0x3d65[$_0xb045->id_tp][$_0xb045->id_smt][$_0xb045->id_siswa])) {
 $_0x2a0b = isset($_0x3d65[$_0xb045->id_tp][$_0xb045->id_smt][$_0xb045->id_siswa][1]) ? $_0x3d65[$_0xb045->id_tp][$_0xb045->id_smt][$_0xb045->id_siswa][1] : null;
 $_0xc7cb = isset($_0x3d65[$_0xb045->id_tp][$_0xb045->id_smt][$_0xb045->id_siswa][2]) ? $_0x3d65[$_0xb045->id_tp][$_0xb045->id_smt][$_0xb045->id_siswa][2] : null;
 }
 $_0x4905 = [];
 if (isset($_0x2880[$_0xb045->id_siswa])) {
 $_0x4905[] = $_0x2880[$_0xb045->id_siswa][$_0xb045->id_tp][$_0xb045->id_smt];
 }
 $_0x4611[$_0xb045->id_tp][$_0xb045->id_smt][$_0xb045->id_siswa] = ["\x75\151\x64" => $_0xb045->uid, "\x69\144\x5f\163\x69\163\x77\141" => $_0xb045->id_siswa, "\x74\160" => $_0xb045->tahun, "\x73\155\x74" => $_0xb045->nama_smt, "\x6b\145\x6c\141\x73" => $_0xb045->nama_kelas, "\x6c\145\x76\145\x6c" => $_0xb045->level_id, "\x77\141\x6c\151\x5f\153\x65\154\x61\163" => $_0xb045->nama_guru, "\x6a\165\x72\165\x73\141\x6e" => $_0xb045->nama_jurusan, "\x68\160\x68" => json_encode(isset($_0xce19[$_0xb045->id_siswa]) ? $_0xce19[$_0xb045->id_siswa] : []), "\x68\160\x74\163" => json_encode(isset($_0xc138[$_0xb045->id_siswa]) ? $_0xc138[$_0xb045->id_siswa] : []), "\x68\160\x61\163" => json_encode(isset($_0x5b0e[$_0xb045->id_siswa]) ? $_0x5b0e[$_0xb045->id_siswa] : []), "\x6e\151\x6c\141\x69\137\x72\141\x70\157\x72" => json_encode(isset($_0x294b[$_0xb045->id_siswa]) ? $_0x294b[$_0xb045->id_siswa] : []), "\x65\153\x73\164\x72\141" => json_encode(isset($_0xdb93[$_0xb045->id_siswa]) ? $_0xdb93[$_0xb045->id_siswa] : ''), "\x73\160\x72\151\x74\165\x61\154" => $_0x2a0b == null ? json_encode([]) : json_encode(["\x64\145\x73\153" => $_0x2a0b->deskripsi, "\x6e\151\x6c\141\x69" => $this->maybe_unserialize($_0x2a0b->nilai)["\x70\162\x65\144\x69\153\x61\164"]]), "\x73\157\x73\151\x61\154" => $_0xc7cb == null ? json_encode([]) : json_encode(["\x64\145\x73\153" => $_0xc7cb->deskripsi, "\x6e\151\x6c\141\x69" => $this->maybe_unserialize($_0xc7cb->nilai)["\x70\162\x65\144\x69\153\x61\164"]]), "\x72\141\x6e\153" => json_encode(["\x72\141\x6e\153" => $_0xb045->ranking, "\x73\141\x72\141\x6e" => $_0xb045->rank_deskripsi]), "\x70\162\x65\163\x74\141\x73\151" => json_encode([["\x6e\151\x6c\141\x69" => $_0xb045->p1, "\x64\145\x73\153" => $_0xb045->p1_desk], ["\x6e\151\x6c\141\x69" => $_0xb045->p2, "\x64\145\x73\153" => $_0xb045->p2_desk], ["\x6e\151\x6c\141\x69" => $_0xb045->p3, "\x64\145\x73\153" => $_0xb045->p3_desk]]), "\x61\142\x73\145\x6e" => $_0xb045->absen != null ? $_0xb045->absen : json_encode([]), "\x73\141\x72\141\x6e" => $_0xb045->saran != null ? $_0xb045->saran : "\x2d", "\x66\151\x73\151\x6b" => json_encode($_0x4905), "\x6e\141\x69\153" => $_0xb045->naik != null ? $_0xb045->naik : "\x31", "\x73\145\x74\164\x69\156\x67\137\x72\141\x70\157\x72" => json_encode((array) $_0xa405[$_0xb045->id_tp][$_0xb045->id_smt]), "\x73\145\x74\164\x69\156\x67\137\x6d\141\x70\145\x6c" => json_encode((array) $_0x4c04)];
 }
 goto L_f2b80;
 L_aae75:
 $_0x3d65 = $this->rapor->getAllNilaiSikap();
 goto L_5c0b1;
 L_f2b80:
 $_0x9767 = [];
 goto L_10e8f;
 L_b58eb:
 $_0xc138 = [];
 goto L_5cc7c;
 L_e6ecc:
 $_0xd527 = $this->rapor->getAllNilaiRapor();
 goto L_3f0bf;
 L_abe36:
 $this->db->transComplete();
 goto L_46032;
 L_10e8f:
 $_0x4911 = [];
 goto L_556d1;
 L_d1108:
 $_0xa405 = $this->rapor->getAllRaporSetting();
 goto L_49c86;
 L_c0d11:
 $_0x294b = [];
 goto L_bd2d9;
 L_46032:
 //$res['kelas_ekstra'] = $kelas_ekstra;
 $_0x220e["\x6e\151\x6c\141\x69\137\x65\153\x73\164\x72\141"] = $_0x4c04;
 goto L_a6405;
 L_f687a:
 $_0x220e["\x69\156\x73\145\x72\164"] = $_0x9767;
 goto L_3aded;
 L_49c86:
 $_0xa6e3 = $this->rapor->getAllKkm();
 goto L_e6ecc;
 L_de59b:
 if (count($_0x9767) > 0) {
 $this->db->table("\x62\165\x6b\165\x5f\156\x69\154\x61\151")->insertBatch($_0x9767);
 $this->rapor->deleteNilaiRapor();
 $this->logging->saveLog($this->LOG_TYPE->ADD, "\x42\141\x63\153\x75\160\x20\156\x69\154\x61\151\x20\162\x61\160\x6f\162");
 }
 goto L_abe36;
 L_556d1:
 foreach ($_0x3526 as $_0x9e7f) {
 foreach ($_0x9543 as $_0xf1bc) {
 if (isset($_0x4611[$_0x9e7f->id_tp]) && isset($_0x4611[$_0x9e7f->id_tp][$_0xf1bc->id_smt])) {
 foreach ($_0x4611[$_0x9e7f->id_tp][$_0xf1bc->id_smt] as $_0xb045) {
 $_0x4911[$_0xb045["\x69\144\x5f\163\x69\163\x77\141"]] = $_0xb045["\x69\144\x5f\163\x69\163\x77\141"];
 if (!$this->rapor->exists($_0xb045["\x75\151\x64"], $_0xb045["\x74\160"], $_0xb045["\x73\155\x74"], $_0xb045["\x6b\145\x6c\141\x73"])) {
 $_0x9767[] = $_0xb045;
 }
 }
 }
 }
 }
 goto L_afb44;
 L_1bcd8:
 $_0xce19 = [];
 goto L_b58eb;
 L_4389a:
 $_0xa166 = $this->dashboard->getSetting();
 goto L_ad25b;
 L_a6405:
 $_0x220e["\x61\154\x6c\137\x6e\151\x6c\141\x69"] = $_0x4611;
 goto L_f687a;
 L_afb44:
 $this->db->transStart();
 goto L_de59b;
 }
 public function restoreNilai()
 {
 goto L_4d93a;
 L_66eff:
 if (count($_0xcad4) > 0) {
 $_0xe72d += $this->db->table("\x72\141\x70\157\x72\137\x63\141\x74\141\x74\141\x6e\137\x77\141\x6c\151")->insertBatch($_0xcad4);
 }
 goto L_db540;
 L_0aa3a:
 if (count($_0x6b5b) > 0) {
 $_0xe72d += $this->db->table("\x72\141\x70\157\x72\137\x70\162\x65\163\x74\141\x73\151")->insertBatch($_0x6b5b);
 }
 goto L_66eff;
 L_394cf:
 return $_0xe72d;
 L_354f8:
 $_0xe72d = 0;
 goto L_0aa3a;
 L_ff08b:
 $_0xbd32 = [];
 goto L_177f5;
 L_725a8:
 $_0xa273 = [];
 goto L_d5c10;
 L_a76c7:
 $_0x67e4 = [];
 goto L_bd42a;
 L_cfee9:
 $this->db->transStart();
 goto L_354f8;
 L_7a9a6:
 if (count($_0xa273) > 0) {
 $_0xe72d += $this->db->table("\x72\141\x70\157\x72\137\x6e\151\x6c\141\x69\137\x68\141\x72\151\x61\156")->insertBatch($_0xa273);
 }
 goto L_32b54;
 L_8fe40:
 $_0x7384 = [];
 goto L_d4450;
 L_9a857:
 $_0x271c = [];
 goto L_4b41a;
 L_787d3:
 if (count($_0x271c) > 0) {
 $_0xe72d += $this->db->table("\x72\141\x70\157\x72\137\x6e\151\x6c\141\x69\137\x61\153\x68\151\x72")->insertBatch($_0x271c);
 }
 goto L_8aca3;
 L_72e14:
 $_0xcad4 = [];
 goto L_0c30b;
 L_177f5:
 $_0x5794 = [];
 goto L_62278;
 L_c6500:
 $_0xbedd = [];
 goto L_9c350;
 L_62278:
 foreach ($_0xd030 as $_0x5981 => $_0xd4cf) {
 $_0xbfbf = array_search($_0xd4cf->tp, array_column($_0x8e53, "\x74\141\x68\165\x6e"));
 $_0xeef2 = $_0x8e53[$_0xbfbf];
 $_0x98af = array_search($_0xd4cf->smt, array_column($_0x20ed, "\x6e\141\x6d\141\x5f\163\x6d\164"));
 $_0x6f3f = $_0x20ed[$_0x98af];
 $_0x8bc8 = '';
 foreach ($_0xd7a5 as $_0x351d) {
 if ($_0x351d->id_tp == $_0xeef2->id_tp && $_0x351d->id_smt == $_0x6f3f->id_smt && $_0x351d->nama_kelas == $_0xd4cf->kelas) {
 $_0x8bc8 = $_0x351d->id_kelas;
 }
 }
 $_0x7384[$_0xeef2->id_tp][$_0x6f3f->id_smt][$_0x5981][$_0x8bc8] = $this->maybe_unserialize($_0xd4cf->hph);
 $_0x8a16[$_0xeef2->id_tp][$_0x6f3f->id_smt][$_0x5981][$_0x8bc8] = $this->maybe_unserialize($_0xd4cf->hpts);
 $_0xb2a9[$_0xeef2->id_tp][$_0x6f3f->id_smt][$_0x5981][$_0x8bc8] = $this->maybe_unserialize($_0xd4cf->hpas);
 $_0x67e4[$_0xeef2->id_tp][$_0x6f3f->id_smt][$_0x5981][$_0x8bc8] = $this->maybe_unserialize($_0xd4cf->nilai_rapor);
 $_0x6a6a[$_0xeef2->id_tp][$_0x6f3f->id_smt][$_0x5981][$_0x8bc8] = $this->maybe_unserialize($_0xd4cf->ekstra);
 $_0x9227[$_0xeef2->id_tp][$_0x6f3f->id_smt][$_0x5981][$_0x8bc8] = $this->maybe_unserialize($_0xd4cf->spritual);
 $_0xe6ea[$_0xeef2->id_tp][$_0x6f3f->id_smt][$_0x5981][$_0x8bc8] = $this->maybe_unserialize($_0xd4cf->sosial);
 $_0xbedd[$_0xeef2->id_tp][$_0x6f3f->id_smt][$_0x5981][$_0x8bc8] = $this->maybe_unserialize($_0xd4cf->rank);
 $_0xba28[$_0xeef2->id_tp][$_0x6f3f->id_smt][$_0x5981][$_0x8bc8] = $this->maybe_unserialize($_0xd4cf->prestasi);
 $_0xbd32[$_0xeef2->id_tp][$_0x6f3f->id_smt][$_0x5981][$_0x8bc8] = ["\x6e\151\x6c\141\x69" => $_0xd4cf->absen, "\x64\145\x73\153\x72\151\x70\163\x69" => $_0xd4cf->saran];
 $_0x5794[$_0xeef2->id_tp][$_0x6f3f->id_smt][$_0x5981][$_0x8bc8] = $this->maybe_unserialize($_0xd4cf->fisik);
 foreach ($_0x5794[$_0xeef2->id_tp][$_0x6f3f->id_smt][$_0x5981][$_0x8bc8] as $_0xe98b) {
 $_0xe98b->kondisi = $this->maybe_unserialize($_0xe98b->kondisi);
 }
 //$setting_rapor = $this->maybe_unserialize($siswa->setting_rapor);
 //$setting_mapel = $this->maybe_unserialize($siswa->setting_mapel);
 }
 goto L_725a8;
 L_047dc:
 $_0x20ed = $this->dashboard->getSemester();
 goto L_8a607;
 L_db540:
 if (count($_0xb4a9) > 0) {
 $_0xe72d += $this->db->table("\x72\141\x70\157\x72\137\x6e\151\x6c\141\x69\137\x65\153\x73\164\x72\141")->insertBatch($_0xb4a9);
 }
 goto L_787d3;
 L_50760:
 $_0x9227 = [];
 goto L_01953;
 L_32b54:
 if (count($_0x5c55) > 0) {
 $_0xe72d += $this->db->table("\x72\141\x70\157\x72\137\x6e\151\x6c\141\x69\137\x73\151\x6b\141\x70")->insertBatch($_0x5c55);
 }
 goto L_be674;
 L_aebcd:
 if ($_0xe72d) {
 $this->db->table("\x62\165\x6b\165\x5f\156\x69\154\x61\151")->emptyTable();
 }
 goto L_05f3c;
 L_8aca3:
 if (count($_0xdc55) > 0) {
 $_0xe72d += $this->db->table("\x72\141\x70\157\x72\137\x6e\151\x6c\141\x69\137\x70\164\x73")->insertBatch($_0xdc55);
 }
 goto L_7a9a6;
 L_eb90d:
 $_0xd7a5 = $this->kelas->getAllKelas();
 goto L_8fe40;
 L_ef440:
 $_0xb2a9 = [];
 goto L_a76c7;
 L_4037d:
 /*
 $res['hph'] = $hph;
 $res['hpts'] = $hpts;
 $res['hpas'] = $hpas;
 $res['extra'] = $ekstra;
 $res['spritual'] = $spritual_insert;
 $res['sosial'] = $sosial_insert;
 $res['rank'] = $rank_insert;
 $res['prestasi'] = $prestasi;
 $res['absen'] = $absen_insert;
 $res['fisik'] = $fisik;
 //$res['hph_insert'] = $hph_insert;
 //$res['hpts_insert'] = $hpts_insert;
 //$res['index'] = $indexs;
 */
 //return $this->output_json($res);
 L_4d93a:
 $_0x8e53 = $this->dashboard->getTahun();
 goto L_047dc;
 L_05f3c:
 $this->db->transComplete();
 goto L_394cf;
 L_8a607:
 $_0x75ed = $this->master->getAllWaliKelas();
 goto L_aa05c;
 L_41bad:
 $_0x5c55 = [];
 goto L_c54d4;
 L_b45c9:
 $_0xd030 = $this->rapor->getDataKumpulanRapor();
 goto L_eb90d;
 L_0c30b:
 $_0x56f0 = [];
 goto L_1a218;
 L_4b41a:
 $_0xb4a9 = [];
 goto L_41bad;
 L_d5c10:
 $_0xdc55 = [];
 goto L_9a857;
 L_aa05c:
 $_0xe95f = $this->master->getAllMapel();
 goto L_b45c9;
 L_9c350:
 $_0xba28 = [];
 goto L_ff08b;
 L_00c39:
 $_0x6b5b = [];
 goto L_72e14;
 L_d4450:
 $_0x8a16 = [];
 goto L_ef440;
 L_be674:
 if (count($_0x3742) > 0) {
 $_0xe72d += $this->db->table("\x72\141\x70\157\x72\137\x6e\151\x6c\141\x69\137\x73\151\x6b\141\x70")->insertBatch($_0x3742);
 }
 goto L_aebcd;
 L_bd42a:
 $_0x6a6a = [];
 goto L_50760;
 L_c54d4:
 $_0x3742 = [];
 goto L_00c39;
 L_01953:
 $_0xe6ea = [];
 goto L_c6500;
 L_1a218:
 foreach ($_0x8e53 as $_0xeef2) {
 foreach ($_0x20ed as $_0x6f3f) {
 if (isset($_0x7384[$_0xeef2->id_tp]) && isset($_0x7384[$_0xeef2->id_tp][$_0x6f3f->id_smt])) {
 foreach ($_0x7384[$_0xeef2->id_tp][$_0x6f3f->id_smt] as $_0x5981 => $_0xa958) {
 foreach ($_0xa958 as $_0x6dd4 => $_0x69da) {
 foreach ($_0x69da as $_0x428c) {
 $_0x6954 = (int) $_0x428c["\x70\137\x6e\151\x6c\141\x69"];
 $_0x2f13 = (int) $_0x428c["\x6b\137\x6e\151\x6c\141\x69"];
 $_0x2bbf = ["\x69\144\x5f\156\x69\154\x61\151\x5f\150\x61\162\x69\141\x6e" => $_0x428c["\x69\144\x5f\155\x61\160\x65\154"] . $_0x6dd4 . $_0x5981 . $_0xeef2->id_tp . $_0x6f3f->id_smt, "\x69\144\x5f\163\x69\163\x77\141" => $_0x5981, "\x69\144\x5f\155\x61\160\x65\154" => $_0x428c["\x69\144\x5f\155\x61\160\x65\154"], "\x69\144\x5f\153\x65\154\x61\163" => $_0x6dd4, "\x69\144\x5f\164\x70" => $_0xeef2->id_tp, "\x69\144\x5f\163\x6d\164" => $_0x6f3f->id_smt, "\x70\137\x72\141\x74\141\x5f\162\x61\164\x61" => $_0x6954, "\x70\61" => $_0x6954 + 1, "\x70\62" => $_0x6954 - 1, "\x70\63" => $_0x6954, "\x70\64" => '', "\x70\65" => '', "\x70\66" => '', "\x70\67" => '', "\x70\70" => '', "\x70\137\x70\162\x65\144\x69\153\x61\164" => $_0x428c["\x70\137\x70\162\x65\144"], "\x70\137\x64\145\x73\153\x72\151\x70\163\x69" => $_0x428c["\x70\137\x64\145\x73\153"], "\x6b\137\x72\141\x74\141\x5f\162\x61\164\x61" => $_0x2f13, "\x6b\61" => $_0x2f13 + 1, "\x6b\62" => $_0x2f13 - 1, "\x6b\63" => $_0x2f13, "\x6b\64" => '', "\x6b\65" => '', "\x6b\66" => '', "\x6b\67" => '', "\x6b\70" => '', "\x6b\137\x70\162\x65\144\x69\153\x61\164" => $_0x428c["\x6b\137\x70\162\x65\144"], "\x6b\137\x64\145\x73\153\x72\151\x70\163\x69" => $_0x428c["\x6b\137\x64\145\x73\153"], "\x6a\155\x6c" => ''];
 $_0xa273[] = $_0x2bbf;
 }
 }
 }
 }
 if (isset($_0x8a16[$_0xeef2->id_tp]) && isset($_0x8a16[$_0xeef2->id_tp][$_0x6f3f->id_smt])) {
 foreach ($_0x8a16[$_0xeef2->id_tp][$_0x6f3f->id_smt] as $_0x5981 => $_0xc169) {
 foreach ($_0xc169 as $_0x6dd4 => $_0x69da) {
 foreach ($_0x69da as $_0x428c) {
 $_0x2bbf = ["\x69\144\x5f\156\x69\154\x61\151\x5f\160\x74\163" => $_0x428c["\x69\144\x5f\155\x61\160\x65\154"] . $_0x6dd4 . $_0x5981 . $_0xeef2->id_tp . $_0x6f3f->id_smt, "\x69\144\x5f\163\x69\163\x77\141" => $_0x5981, "\x69\144\x5f\155\x61\160\x65\154" => $_0x428c["\x69\144\x5f\155\x61\160\x65\154"], "\x69\144\x5f\153\x65\154\x61\163" => $_0x6dd4, "\x69\144\x5f\164\x70" => $_0xeef2->id_tp, "\x69\144\x5f\163\x6d\164" => $_0x6f3f->id_smt, "\x6e\151\x6c\141\x69" => $_0x428c["\x6e\151\x6c\141\x69"], "\x70\162\x65\144\x69\153\x61\164" => $_0x428c["\x70\162\x65\144"]];
 $_0xdc55[] = $_0x2bbf;
 }
 }
 }
 }
 if (isset($_0xb2a9[$_0xeef2->id_tp]) && isset($_0xb2a9[$_0xeef2->id_tp][$_0x6f3f->id_smt])) {
 foreach ($_0xb2a9[$_0xeef2->id_tp][$_0x6f3f->id_smt] as $_0x5981 => $_0x1e6e) {
 foreach ($_0x1e6e as $_0x6dd4 => $_0x69da) {
 foreach ($_0x69da as $_0x428c) {
 $_0x7d40 = $_0x67e4[$_0xeef2->id_tp][$_0x6f3f->id_smt][$_0x5981][$_0x6dd4];
 $_0x37a3 = array_search($_0x428c["\x69\144\x5f\155\x61\160\x65\154"], array_column($_0x7d40, "\x69\144\x5f\155\x61\160\x65\154"));
 $_0x7b99 = $_0x7d40[$_0x37a3];
 $_0x2bbf = ["\x69\144\x5f\156\x69\154\x61\151\x5f\141\x6b\150\x69\162" => $_0x428c["\x69\144\x5f\155\x61\160\x65\154"] . $_0x6dd4 . $_0x5981 . $_0xeef2->id_tp . $_0x6f3f->id_smt, "\x69\144\x5f\163\x69\163\x77\141" => $_0x5981, "\x69\144\x5f\155\x61\160\x65\154" => $_0x428c["\x69\144\x5f\155\x61\160\x65\154"], "\x69\144\x5f\153\x65\154\x61\163" => $_0x6dd4, "\x69\144\x5f\164\x70" => $_0xeef2->id_tp, "\x69\144\x5f\163\x6d\164" => $_0x6f3f->id_smt, "\x6e\151\x6c\141\x69" => $_0x428c["\x6e\151\x6c\141\x69"], "\x61\153\x68\151\x72" => $_0x7b99["\x6e\151\x6c\141\x69"], "\x70\162\x65\144\x69\153\x61\164" => $_0x7b99["\x70\162\x65\144"]];
 $_0x271c[] = $_0x2bbf;
 }
 }
 }
 }
 if (isset($_0x6a6a[$_0xeef2->id_tp]) && isset($_0x6a6a[$_0xeef2->id_tp][$_0x6f3f->id_smt])) {
 foreach ($_0x6a6a[$_0xeef2->id_tp][$_0x6f3f->id_smt] as $_0x5981 => $_0x1e6e) {
 foreach ($_0x1e6e as $_0x6dd4 => $_0x69da) {
 if ($_0x69da != '') {
 foreach ($_0x69da as $_0x428c) {
 $_0x2bbf = ["\x69\144\x5f\156\x69\154\x61\151\x5f\145\x6b\163\x74\162\x61" => $_0x428c["\x69\144\x5f\145\x6b\163\x74\162\x61"] . $_0x6dd4 . $_0x5981 . $_0xeef2->id_tp . $_0x6f3f->id_smt, "\x69\144\x5f\163\x69\163\x77\141" => $_0x5981, "\x69\144\x5f\145\x6b\163\x74\162\x61" => $_0x428c["\x69\144\x5f\145\x6b\163\x74\162\x61"], "\x69\144\x5f\153\x65\154\x61\163" => $_0x6dd4, "\x69\144\x5f\164\x70" => $_0xeef2->id_tp, "\x69\144\x5f\163\x6d\164" => $_0x6f3f->id_smt, "\x6e\151\x6c\141\x69" => $_0x428c["\x6e\151\x6c\141\x69"], "\x70\162\x65\144\x69\153\x61\164" => $_0x428c["\x70\162\x65\144"], "\x64\145\x73\153\x72\151\x70\163\x69" => $_0x428c["\x64\145\x73\153"]];
 $_0xb4a9[] = $_0x2bbf;
 }
 }
 }
 }
 }
 if (isset($_0x9227[$_0xeef2->id_tp]) && isset($_0x9227[$_0xeef2->id_tp][$_0x6f3f->id_smt])) {
 foreach ($_0x9227[$_0xeef2->id_tp][$_0x6f3f->id_smt] as $_0x5981 => $_0xc169) {
 foreach ($_0xc169 as $_0x6dd4 => $_0x69da) {
 $_0x2bbf = ["\x69\144\x5f\156\x69\154\x61\151\x5f\163\x69\153\x61\160" => $_0x6dd4 . $_0x5981 . $_0xeef2->id_tp . $_0x6f3f->id_smt . "\x31", "\x69\144\x5f\163\x69\163\x77\141" => $_0x5981, "\x69\144\x5f\153\x65\154\x61\163" => $_0x6dd4, "\x69\144\x5f\164\x70" => $_0xeef2->id_tp, "\x69\144\x5f\163\x6d\164" => $_0x6f3f->id_smt, "\x6a\145\x6e\151\x73" => "\x31", "\x6e\151\x6c\141\x69" => json_encode(["\x70\162\x65\144\x69\153\x61\164" => $_0x69da["\x6e\151\x6c\141\x69"], "\x73\154\x31" => '', "\x73\154\x32" => '', "\x73\154\x33" => '', "\x6d\142\x31" => '', "\x6d\142\x32" => '', "\x6d\142\x33" => '']), "\x64\145\x73\153\x72\151\x70\163\x69" => $_0x69da["\x64\145\x73\153"]];
 $_0x5c55[] = $_0x2bbf;
 }
 }
 }
 if (isset($_0xe6ea[$_0xeef2->id_tp]) && isset($_0xe6ea[$_0xeef2->id_tp][$_0x6f3f->id_smt])) {
 foreach ($_0xe6ea[$_0xeef2->id_tp][$_0x6f3f->id_smt] as $_0x5981 => $_0xc169) {
 foreach ($_0xc169 as $_0x6dd4 => $_0x69da) {
 $_0x2bbf = ["\x69\144\x5f\156\x69\154\x61\151\x5f\163\x69\153\x61\160" => $_0x6dd4 . $_0x5981 . $_0xeef2->id_tp . $_0x6f3f->id_smt . "\x32", "\x69\144\x5f\163\x69\163\x77\141" => $_0x5981, "\x69\144\x5f\153\x65\154\x61\163" => $_0x6dd4, "\x69\144\x5f\164\x70" => $_0xeef2->id_tp, "\x69\144\x5f\163\x6d\164" => $_0x6f3f->id_smt, "\x6a\145\x6e\151\x73" => "\x32", "\x6e\151\x6c\141\x69" => json_encode(["\x70\162\x65\144\x69\153\x61\164" => $_0x69da["\x6e\151\x6c\141\x69"], "\x73\154\x31" => '', "\x73\154\x32" => '', "\x73\154\x33" => '', "\x6d\142\x31" => '', "\x6d\142\x32" => '', "\x6d\142\x33" => '']), "\x64\145\x73\153\x72\151\x70\163\x69" => $_0x69da["\x64\145\x73\153"]];
 $_0x3742[] = $_0x2bbf;
 }
 }
 }
 if (isset($_0xbedd[$_0xeef2->id_tp]) && isset($_0xbedd[$_0xeef2->id_tp][$_0x6f3f->id_smt])) {
 foreach ($_0xbedd[$_0xeef2->id_tp][$_0x6f3f->id_smt] as $_0x5981 => $_0xc169) {
 foreach ($_0xc169 as $_0x6dd4 => $_0x69da) {
 $_0xdfdb = $_0xba28[$_0xeef2->id_tp][$_0x6f3f->id_smt][$_0x5981][$_0x6dd4];
 $_0x2bbf = ["\x69\144\x5f\162\x61\156\x6b\151\x6e\147" => $_0x6dd4 . $_0x5981 . $_0xeef2->id_tp . $_0x6f3f->id_smt, "\x69\144\x5f\163\x69\163\x77\141" => $_0x5981, "\x69\144\x5f\153\x65\154\x61\163" => $_0x6dd4, "\x69\144\x5f\164\x70" => $_0xeef2->id_tp, "\x69\144\x5f\163\x6d\164" => $_0x6f3f->id_smt, "\x72\141\x6e\153\x69\156\x67" => $_0x69da["\x72\141\x6e\153"], "\x64\145\x73\153\x72\151\x70\163\x69" => $_0x69da["\x73\141\x72\141\x6e"], "\x70\61" => $_0xdfdb[0]["\x6e\151\x6c\141\x69"], "\x70\61\x5f\144\x65\163\x6b" => $_0xdfdb[0]["\x64\145\x73\153"], "\x70\62" => $_0xdfdb[1]["\x6e\151\x6c\141\x69"], "\x70\62\x5f\144\x65\163\x6b" => $_0xdfdb[1]["\x64\145\x73\153"], "\x70\63" => $_0xdfdb[2]["\x6e\151\x6c\141\x69"], "\x70\63\x5f\144\x65\163\x6b" => $_0xdfdb[2]["\x64\145\x73\153"]];
 $_0x6b5b[] = $_0x2bbf;
 }
 }
 }
 if (isset($_0xbd32[$_0xeef2->id_tp]) && isset($_0xbd32[$_0xeef2->id_tp][$_0x6f3f->id_smt])) {
 foreach ($_0xbd32[$_0xeef2->id_tp][$_0x6f3f->id_smt] as $_0x5981 => $_0xc169) {
 foreach ($_0xc169 as $_0x6dd4 => $_0x69da) {
 $_0x2bbf = ["\x69\144\x5f\143\x61\164\x61\164\x61\156\x5f\167\x61\154\x69" => $_0x6dd4 . $_0x5981 . $_0xeef2->id_tp . $_0x6f3f->id_smt, "\x69\144\x5f\163\x69\163\x77\141" => $_0x5981, "\x69\144\x5f\153\x65\154\x61\163" => $_0x6dd4, "\x69\144\x5f\164\x70" => $_0xeef2->id_tp, "\x69\144\x5f\163\x6d\164" => $_0x6f3f->id_smt, "\x6e\151\x6c\141\x69" => $_0x69da["\x6e\151\x6c\141\x69"], "\x64\145\x73\153\x72\151\x70\163\x69" => $_0x69da["\x64\145\x73\153\x72\151\x70\163\x69"]];
 $_0xcad4[] = $_0x2bbf;
 }
 }
 }
 }
 }
 goto L_cfee9;
 }
 public function edit()
 {
 goto L_7e33c;
 L_9bff1:
 $_0x52a0["\x74\160\x5f\141\x63\164\x69\166\x65"] = $_0xd5a7;
 goto L_22d7b;
 L_6ecfa:
 $_0xd5a7 = $this->dashboard->getTahunActive();
 goto L_60cfc;
 L_35cf5:
 if (session()->get("\x72\157\x6c\145") == 1) {
 return view("\x73\145\x74\164\x69\156\x67\57\x64\141\x74\141\x72\141\x70\157\x72", $_0x52a0);
 } else {
 $_0xe289 = $this->dashboard->getDataGuruByUserId(session()->get("\x69\144\x5f\165\x73\145\x72"), $_0xd5a7->id_tp, $_0x1bde->id_smt);
 //$guru = $this->dashboard->getDataGuruByUsername($user->username, $tp->id_tp, $smt->id_smt);
 //$nguru[$guru->id_guru] = $guru->nama_guru;
 $_0x52a0["\x67\165\x72\165"] = $_0xe289;
 return view("\x73\145\x74\164\x69\156\x67\57\x64\141\x74\141\x72\141\x70\157\x72", $_0x52a0);
 }
 L_60cfc:
 $_0x1bde = $this->dashboard->getSemesterActive();
 goto L_ee1ef;
 L_11e3b:
 $_0x52a0["\x73\155\x74\137\x61\143\x74\151\x76\145"] = $_0x1bde;
 goto L_62445;
 L_f2734:
 $_0xa909 = $this->request->getGet("\x73\145\x6d\145\x73\164\x65\162");
 goto L_37ef2;
 L_a5263:
 $_0x52a0 = ["\x75\163\x65\162" => $_0x838b, "\x6a\165\x64\165\x6c" => "\x45\144\x69\164\x20\116\x69\154\x61\151", "\x73\165\x62\152\x75\144\x75\154" => "\x4e\151\x6c\141\x69\40\x52\141\x70\157\x72\40\x4b\145\x6c\141\x73\40" . $_0xf58d . "\x2c\40\x54\120\x3a" . $_0x81c1 . "\x2c\40\x53\115\x54\72" . $_0xa909, "\x73\145\x74\164\x69\156\x67" => $_0x3365];
 goto L_6ecfa;
 L_434a1:
 foreach ($_0x8582 as $_0xec6e) {
 $_0xec6e->hph = $this->maybe_unserialize($_0xec6e->hph);
 $_0xec6e->hpts = $this->maybe_unserialize($_0xec6e->hpts);
 $_0xec6e->hpas = $this->maybe_unserialize($_0xec6e->hpas);
 $_0xec6e->nilai_rapor = $this->maybe_unserialize($_0xec6e->nilai_rapor);
 $_0xec6e->ekstra = $this->maybe_unserialize($_0xec6e->ekstra);
 $_0xec6e->spritual = $this->maybe_unserialize($_0xec6e->spritual);
 $_0xec6e->sosial = $this->maybe_unserialize($_0xec6e->sosial);
 $_0xec6e->rank = $this->maybe_unserialize($_0xec6e->rank);
 $_0xec6e->prestasi = $this->maybe_unserialize($_0xec6e->prestasi);
 $_0xec6e->absen = $this->maybe_unserialize($_0xec6e->absen);
 $_0xec6e->fisik = $this->maybe_unserialize($_0xec6e->fisik);
 foreach ($_0xec6e->fisik as $_0x2bc5) {
 $_0x2bc5->kondisi = $this->maybe_unserialize($_0x2bc5->kondisi);
 }
 $_0xec6e->setting_rapor = $this->maybe_unserialize($_0xec6e->setting_rapor);
 $_0xec6e->setting_mapel = $this->maybe_unserialize($_0xec6e->setting_mapel);
 }
 goto L_51010;
 L_22d7b:
 $_0x52a0["\x73\155\x74"] = $this->dashboard->getSemester();
 goto L_11e3b;
 L_7e33c:
 $_0xf58d = $this->request->getGet("\x6b\145\x6c\141\x73");
 goto L_5f6d2;
 L_80cf1:
 $_0x3365 = $this->dashboard->getSetting();
 goto L_a5263;
 L_51010:
 $_0x52a0["\x73\151\x73\167\x61\163"] = $_0x8582;
 goto L_35cf5;
 L_37ef2:
 $_0x838b = (object) ["\x69\144" => session()->get("\x69\144\x5f\165\x73\145\x72"), "\x75\163\x65\162\x6e\141\x6d\145" => session()->get("\x75\163\x65\162\x6e\141\x6d\145")];
 goto L_80cf1;
 L_62445:
 $_0x8582 = $this->rapor->getDataKumpulanRapor($_0xf58d, $_0x81c1, $_0xa909);
 goto L_434a1;
 L_ee1ef:
 $_0x52a0["\x74\160"] = $this->dashboard->getTahun();
 goto L_9bff1;
 L_5f6d2:
 $_0x81c1 = $this->request->getGet("\x74\141\x68\165\x6e");
 goto L_f2734;
 }
 public function ledger()
 {
 goto L_7caca;
 L_925ae:
 $_0xa5b5["\x73\155\x74\137\x61\143\x74\151\x76\145"] = $_0x2c51;
 goto L_12db1;
 L_12db1:
 $_0x1250 = $this->rapor->getDataKumpulanRapor($_0x8c51, $_0xb987, $_0x868f);
 goto L_1cb38;
 L_d353a:
 $_0xa5b5["\x74\160"] = $this->dashboard->getTahun();
 goto L_9a461;
 L_377d8:
 $_0xa5b5["\x73\151\x73\167\x61\163"] = $_0x1250;
 goto L_767c7;
 L_7caca:
 $_0x8c51 = $this->request->getGet("\x6b\145\x6c\141\x73");
 goto L_9d586;
 L_9d586:
 $_0xb987 = $this->request->getGet("\x74\141\x68\165\x6e");
 goto L_63b1b;
 L_5686e:
 $_0x2c51 = $this->dashboard->getSemesterActive();
 goto L_d353a;
 L_767c7:
 if (session()->get("\x72\157\x6c\145") == 1) {
 return view("\x73\145\x74\164\x69\156\x67\57\x64\141\x74\141\x72\141\x70\157\x72", $_0xa5b5);
 } else {
 //$guru = $this->dashboard->getDataGuruByUsername($user->username, $tp->id_tp, $smt->id_smt);
 //$nguru[$guru->id_guru] = $guru->nama_guru;
 $_0xb3be = $this->dashboard->getDataGuruByUserId(session()->get("\x69\144\x5f\165\x73\145\x72"), $_0x6a9e->id_tp, $_0x2c51->id_smt);
 $_0xa5b5["\x67\165\x72\165"] = $_0xb3be;
 return view("\x73\145\x74\164\x69\156\x67\57\x64\141\x74\141\x72\141\x70\157\x72", $_0xa5b5);
 }
 L_63b1b:
 $_0x868f = $this->request->getGet("\x73\145\x6d\145\x73\164\x65\162");
 goto L_55e55;
 L_9a461:
 $_0xa5b5["\x74\160\x5f\141\x63\164\x69\166\x65"] = $_0x6a9e;
 goto L_9cf61;
 L_1cb38:
 foreach ($_0x1250 as $_0xa32f) {
 $_0xa32f->hph = $this->maybe_unserialize($_0xa32f->hph);
 $_0xa32f->hpts = $this->maybe_unserialize($_0xa32f->hpts);
 $_0xa32f->hpas = $this->maybe_unserialize($_0xa32f->hpas);
 $_0xa32f->nilai_rapor = $this->maybe_unserialize($_0xa32f->nilai_rapor);
 $_0xa32f->ekstra = $this->maybe_unserialize($_0xa32f->ekstra);
 $_0xa32f->spritual = $this->maybe_unserialize($_0xa32f->spritual);
 $_0xa32f->sosial = $this->maybe_unserialize($_0xa32f->sosial);
 $_0xa32f->rank = $this->maybe_unserialize($_0xa32f->rank);
 $_0xa32f->prestasi = $this->maybe_unserialize($_0xa32f->prestasi);
 $_0xa32f->absen = $this->maybe_unserialize($_0xa32f->absen);
 $_0xa32f->fisik = $this->maybe_unserialize($_0xa32f->fisik);
 foreach ($_0xa32f->fisik as $_0x6484) {
 $_0x6484->kondisi = $this->maybe_unserialize($_0x6484->kondisi);
 }
 $_0xa32f->setting_rapor = $this->maybe_unserialize($_0xa32f->setting_rapor);
 $_0xa32f->setting_mapel = $this->maybe_unserialize($_0xa32f->setting_mapel);
 }
 goto L_377d8;
 L_55e55:
 $_0x456e = (object) ["\x69\144" => session()->get("\x69\144\x5f\165\x73\145\x72"), "\x75\163\x65\162\x6e\141\x6d\145" => session()->get("\x75\163\x65\162\x6e\141\x6d\145")];
 goto L_225fe;
 L_f6939:
 $_0x6a9e = $this->dashboard->getTahunActive();
 goto L_5686e;
 L_2299e:
 $_0xa5b5 = ["\x75\163\x65\162" => $_0x456e, "\x6a\165\x64\165\x6c" => "\x45\144\x69\164\x20\116\x69\154\x61\151", "\x73\165\x62\152\x75\144\x75\154" => "\x4e\151\x6c\141\x69\40\x52\141\x70\157\x72\40\x4b\145\x6c\141\x73\40" . $_0x8c51 . "\x2c\40\x54\120\x3a" . $_0xb987 . "\x2c\40\x53\115\x54\72" . $_0x868f, "\x73\145\x74\164\x69\156\x67" => $_0xc4e4];
 goto L_f6939;
 L_225fe:
 $_0xc4e4 = $this->dashboard->getSetting();
 goto L_2299e;
 L_9cf61:
 $_0xa5b5["\x73\155\x74"] = $this->dashboard->getSemester();
 goto L_925ae;
 }
 public function dkn()
 {
 goto L_22f6f;
 L_ae0b1:
 $_0xd4cf = ["\x75\163\x65\162" => $_0xd5d1, "\x6a\165\x64\165\x6c" => "\x45\144\x69\164\x20\116\x69\154\x61\151", "\x73\165\x62\152\x75\144\x75\154" => "\x4e\151\x6c\141\x69\40\x52\141\x70\157\x72\40\x4b\145\x6c\141\x73\40" . $_0xa3d7 . "\x2c\40\x54\120\x3a" . $_0xd79b . "\x2c\40\x53\115\x54\72" . $_0x69da, "\x73\145\x74\164\x69\156\x67" => $_0x1238];
 goto L_0948a;
 L_f704c:
 $_0xcd96 = $this->dashboard->getSemesterActive();
 goto L_5c0c2;
 L_0948a:
 $_0x9ae6 = $this->dashboard->getTahunActive();
 goto L_f704c;
 L_4b3e3:
 $_0x69da = $this->request->getGet("\x73\145\x6d\145\x73\164\x65\162");
 goto L_21df7;
 L_21df7:
 $_0xd5d1 = (object) ["\x69\144" => session()->get("\x69\144\x5f\165\x73\145\x72"), "\x75\163\x65\162\x6e\141\x6d\145" => session()->get("\x75\163\x65\162\x6e\141\x6d\145")];
 goto L_4c468;
 L_2db06:
 $_0xa3b2 = $this->rapor->getDataKumpulanRapor($_0xa3d7, $_0xd79b, $_0x69da);
 goto L_3e071;
 L_b4614:
 $_0xd4cf["\x74\160\x5f\141\x63\164\x69\166\x65"] = $_0x9ae6;
 goto L_c99fc;
 L_4c468:
 $_0x1238 = $this->dashboard->getSetting();
 goto L_ae0b1;
 L_30696:
 $_0xd4cf["\x73\155\x74\137\x61\143\x74\151\x76\145"] = $_0xcd96;
 goto L_2db06;
 L_5c0c2:
 $_0xd4cf["\x74\160"] = $this->dashboard->getTahun();
 goto L_b4614;
 L_37af8:
 $_0xd4cf["\x73\151\x73\167\x61\163"] = $_0xa3b2;
 goto L_dceca;
 L_4844d:
 $_0xd79b = $this->request->getGet("\x74\141\x68\165\x6e");
 goto L_4b3e3;
 L_dceca:
 if (session()->get("\x72\157\x6c\145") == 1) {
 return view("\x73\145\x74\164\x69\156\x67\57\x64\141\x74\141\x72\141\x70\157\x72", $_0xd4cf);
 } else {
 //$guru = $this->dashboard->getDataGuruByUsername($user->username, $tp->id_tp, $smt->id_smt);
 //$nguru[$guru->id_guru] = $guru->nama_guru;
 $_0xdacf = $this->dashboard->getDataGuruByUserId(session()->get("\x69\144\x5f\165\x73\145\x72"), $_0x9ae6->id_tp, $_0xcd96->id_smt);
 $_0xd4cf["\x67\165\x72\165"] = $_0xdacf;
 return view("\x73\145\x74\164\x69\156\x67\57\x64\141\x74\141\x72\141\x70\157\x72", $_0xd4cf);
 }
 L_22f6f:
 $_0xa3d7 = $this->request->getGet("\x6b\145\x6c\141\x73");
 goto L_4844d;
 L_3e071:
 foreach ($_0xa3b2 as $_0xb382) {
 $_0xb382->hph = $this->maybe_unserialize($_0xb382->hph);
 $_0xb382->hpts = $this->maybe_unserialize($_0xb382->hpts);
 $_0xb382->hpas = $this->maybe_unserialize($_0xb382->hpas);
 $_0xb382->nilai_rapor = $this->maybe_unserialize($_0xb382->nilai_rapor);
 $_0xb382->ekstra = $this->maybe_unserialize($_0xb382->ekstra);
 $_0xb382->spritual = $this->maybe_unserialize($_0xb382->spritual);
 $_0xb382->sosial = $this->maybe_unserialize($_0xb382->sosial);
 $_0xb382->rank = $this->maybe_unserialize($_0xb382->rank);
 $_0xb382->prestasi = $this->maybe_unserialize($_0xb382->prestasi);
 $_0xb382->absen = $this->maybe_unserialize($_0xb382->absen);
 $_0xb382->fisik = $this->maybe_unserialize($_0xb382->fisik);
 foreach ($_0xb382->fisik as $_0x7429) {
 $_0x7429->kondisi = $this->maybe_unserialize($_0x7429->kondisi);
 }
 $_0xb382->setting_rapor = $this->maybe_unserialize($_0xb382->setting_rapor);
 $_0xb382->setting_mapel = $this->maybe_unserialize($_0xb382->setting_mapel);
 }
 goto L_37af8;
 L_c99fc:
 $_0xd4cf["\x73\155\x74"] = $this->dashboard->getSemester();
 goto L_30696;
 }
 function group_by($_0xa124, $_0x46a6)
 {
 goto L_e3efd;
 L_e79f6:
 foreach ($_0x46a6 as $_0x7ab2) {
 if (array_key_exists($_0xa124, $_0x7ab2)) {
 $_0x6822[$_0x7ab2->{$_0xa124}][] = $_0x7ab2;
 } else {
 $_0x6822[''][] = $_0x7ab2;
 }
 }
 goto L_c0167;
 L_c0167:
 return $_0x6822;
 L_e3efd:
 $_0x6822 = array();
 goto L_e79f6;
 }
}