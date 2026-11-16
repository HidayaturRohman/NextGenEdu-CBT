<?php
/*   ________________________________________
    |               NextGen Garuda CBT       |
    |    Protected & Distributed via GitHub  |
    |________________________________________|
*/
namespace App\Controllers;

use App\Models\MasterModel;
use App\Models\DropdownModel;
use App\Models\DashboardModel;
use App\Models\KelasModel;
use App\Models\CbtModel;
use App\Models\LogModel;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
class CbtBankSoal extends BaseController
{
 public $master;
 public $dropdown;
 public $dashboard;
 public $kelas;
 public $cbt;
 public $logging;
 public $db;
 public $auth;
 public $input;
 public $load;
 public $form_validation;
 public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $_0xe10c)
 {
 goto L_e4e4d;
 L_dc69c:
 if (!$_0x3ec9->get("\x6c\157\x67\147\x65\144\x5f\151\x6e") && !$_0x3ec9->get("\x69\144\x5f\165\x73\145\x72")) {
 header("\x4c\157\x63\141\x74\151\x6f\156\x3a\40" . base_url("\x61\165\x74\150\x2f\154\x6f\147\x69\156"));
 exit;
 } else if (!in_array((string) $_0x3ec9->get("\x72\157\x6c\145"), ["\x31", "\x32", "\x34"])) {
 echo "\x48\141\x6e\171\x61\40\x41\144\x6d\151\x6e\151\x73\164\x72\141\x74\157\x72\40\x64\141\x6e\40\x67\165\x72\165\x20\171\x61\156\x67\40\x64\151\x62\145\x72\151\x20\150\x61\153\x20\165\x6e\164\x75\153\x20\155\x65\156\x67\141\x6b\163\x65\163\x20\150\x61\154\x61\155\x61\156\x20\151\x6e\151\x2c\40\x3c\141\x20\150\x72\145\x66\75\x22" . base_url("\x64\141\x73\150\x62\157\x61\162\x64") . "\x22\76\x4b\145\x6d\142\x61\154\x69\40\x6b\145\x20\155\x65\156\x75\40\x61\167\x61\154\x3c\57\x61\76";
 exit;
 }
 L_ddcd6:
 // CI3 compatibility layer
 $_0x3ec9 = session();
 goto L_3a0b4;
 L_82346:
 // Load models
 $this->master = new MasterModel();
 goto L_4ec6d;
 L_4d0b0:
 $this->form_validation = new class
 {
 public function set_error_delimiters($_0x452e, $_0x903a)
 {
 }
 public function set_rules($_0x299a, $_0xd785, $_0x4960)
 {
 }
 public function run()
 {
 return true;
 }
 };
 goto L_0b416;
 L_3a0b4:
 $this->auth = new class($_0x3012)
 {
 private $session;
 public function __construct($_0x2c68)
 {
 $this->session = $_0x2c68;
 }
 public function logged_in()
 {
 return $this->session->get("\x69\163\x5f\154\x6f\147\x69\156");
 }
 public function is_admin()
 {
 return in_array((string) $this->session->get("\x72\157\x6c\145"), ["\x31", "\x34"]);
 }
 public function in_group($_0x93c4)
 {
 return $this->session->get("\x72\157\x6c\145") == "\x32" && $_0x93c4 == "\x67\165\x72\165";
 }
 public function user()
 {
 return (object) ["\x69\144" => $this->session->get("\x69\144\x5f\147\x75\162\x75") ?? $this->session->get("\x69\144"), "\x75\163\x65\162\x6e\141\x6d\145" => $this->session->get("\x75\163\x65\162\x6e\141\x6d\145")];
 }
 };
 goto L_be7b9;
 L_74aee:
 $this->dashboard = new DashboardModel();
 goto L_d37bb;
 L_c9459:
 $this->load = new class
 {
 public function model($_0x6f73, $_0x3735 = '')
 {
 }
 public function library($_0x817d, $_0xd93b = '')
 {
 }
 public function helper($_0x681e)
 {
 }
 };
 goto L_4d0b0;
 L_e4e4d:
 parent::initController($request, $response, $_0x699f);
 goto L_82346;
 L_0b416:
 $_0x9638 = session();
 goto L_dc69c;
 L_10b4d:
 $this->cbt = new CbtModel();
 goto L_0cad4;
 L_d37bb:
 $this->kelas = new KelasModel();
 goto L_10b4d;
 L_4ec6d:
 $this->dropdown = new DropdownModel();
 goto L_74aee;
 L_be7b9:
 $this->input = new class($request)
 {
 private $request;
 public function __construct($_0xf972)
 {
 $this->request = $_0xf972;
 }
 public function get($_0x1dab = null, $_0x6ff3 = false)
 {
 return $_0x1dab === null ? $this->request->getGet() : $this->request->getGet($_0x1dab);
 }
 public function post($_0x385d = null, $_0x4a05 = false)
 {
 return $_0x385d === null ? $this->request->getPost() : $this->request->getPost($_0x385d);
 }
 };
 goto L_c9459;
 L_3f332:
 $this->db = \Config\Database::connect();
 goto L_ddcd6;
 L_0cad4:
 $this->logging = new LogModel();
 goto L_3f332;
 }
 private function getKelasByIds($_0xc946)
 {
 if (empty($_0xc946)) {
 return [];
 }
 return $this->db->table("\x6d\141\x73\164\x65\162\x5f\153\x65\154\x61\163")->select("\x69\144\x5f\153\x65\154\x61\163\x2c\40\x6e\141\x6d\141\x5f\153\x65\154\x61\163\x2c\40\x6b\157\x64\145\x5f\153\x65\154\x61\163")->whereIn("\x69\144\x5f\153\x65\154\x61\163", $_0xc946)->get()->getResult();
 }
 private function getBankTerpakai($_0x1a20 = null)
 {
 goto L_e9f67;
 L_08a2d:
 foreach ($_0x3583 as $_0x4837 => $_0x5f88) {
 $_0x708a[$_0x5f88->id_bank][$_0x5f88->id_siswa] = $_0x5f88;
 }
 goto L_fc81d;
 L_e9f67:
 $_0xae0d = $this->db->table("\x63\142\x74\137\x73\151\x73\167\x61")->select("\x69\144\x5f\142\x61\156\x6b\54\x20\151\x64\137\x73\151\x73\167\x61");
 goto L_a8a75;
 L_fd4dd:
 $_0x708a = [];
 goto L_08a2d;
 L_1cbab:
 $_0x3583 = $_0xae0d->get()->getResult();
 goto L_fd4dd;
 L_fc81d:
 return $_0x708a;
 L_a8a75:
 if ($_0x1a20 != null) {
 $_0xae0d->whereIn("\x69\144\x5f\142\x61\156\x6b", (array) $_0x1a20);
 }
 goto L_1cbab;
 }
 public function index()
 {
 goto L_10f78;
 L_0500d:
 $_0x7b60 = ["\x75\163\x65\162" => $_0x8b3c, "\x6a\165\x64\165\x6c" => "\x42\141\x6e\153\x20\123\x6f\141\x6c", "\x73\165\x62\152\x75\144\x75\154" => "\x53\157\x61\154", "\x73\145\x74\164\x69\156\x67" => $_0xb560];
 goto L_ffff5;
 L_d93d9:
 $_0x7b60["\x73\155\x74"] = $this->dashboard->getSemester();
 goto L_6fa80;
 L_6455b:
 $_0x7b60["\x74\160\x5f\141\x63\164\x69\166\x65"] = $_0xfa13;
 goto L_d93d9;
 L_c4e2a:
 $_0x7017 = $this->request->getGet("\x74\171\x70\145");
 goto L_dfc4f;
 L_011c3:
 $_0x5cda = $this->request->getGet("\x6d\157\x64\145");
 goto L_c4e2a;
 L_ffff5:
 $_0xfa13 = $this->master->getTahunActive();
 goto L_17e07;
 L_dfc4f:
 $_0x7b60["\x6d\157\x64\145"] = $_0x5cda == null ? "\x31" : $_0x5cda;
 goto L_4e6cb;
 L_1c61f:
 $_0x7b60["\x6c\145\x76\145\x6c\163"] = $this->dropdown->getAllLevel($_0xb560->jenjang);
 goto L_011c3;
 L_e6aae:
 if (in_array((string) session()->get("\x72\157\x6c\145"), ["\x31", "\x34"])) {
 $_0x7b60["\x6d\141\x70\145\x6c\163"] = $this->dropdown->getAllMapel();
 $_0x7b60["\x67\165\x72\165\x73"] = $this->dropdown->getAllGuru();
 $_0x7b60["\x6b\145\x6c\141\x73"] = $this->cbt->getKelas($_0xfa13->id_tp, $_0x7cb3->id_smt);
 $_0x7b60["\x66\151\x6c\164\x65\162\x73"] = ["\x30" => "\x53\145\x6d\165\x61", "\x31" => "\x47\165\x72\165", "\x32" => "\x4d\141\x70\145\x6c", "\x33" => "\x4c\145\x76\145\x6c"];
 $_0x7b60["\x69\144\x5f\146\x69\154\x74\145\x72"] = (string) $_0x7017;
 $_0x238a = [];
 if ($_0x7017 === "\x30") {
 $_0x238a = $this->cbt->getDataBank();
 $_0x7b60["\x69\144\x5f\147\x75\162\x75"] = null;
 $_0x7b60["\x69\144\x5f\155\x61\160\x65\154"] = null;
 $_0x7b60["\x69\144\x5f\154\x65\166\x65\154"] = null;
 } elseif ($_0x7017 == "\x31") {
 $_0xa2ca = $this->request->getGet("\x69\144");
 $_0x7b60["\x69\144\x5f\147\x75\162\x75"] = $_0xa2ca;
 $_0x238a = $this->cbt->getDataBank($_0xa2ca);
 $_0x7b60["\x69\144\x5f\155\x61\160\x65\154"] = '';
 $_0x7b60["\x69\144\x5f\154\x65\166\x65\154"] = '';
 } elseif ($_0x7017 == "\x32") {
 $_0xc35f = $this->request->getGet("\x69\144");
 $_0x7b60["\x69\144\x5f\155\x61\160\x65\154"] = $_0xc35f;
 $_0x238a = $this->cbt->getDataBank(null, $_0xc35f);
 $_0x7b60["\x69\144\x5f\147\x75\162\x75"] = '';
 $_0x7b60["\x69\144\x5f\154\x65\166\x65\154"] = '';
 } elseif ($_0x7017 == "\x33") {
 $_0x5ae4 = $this->request->getGet("\x69\144");
 $_0x7b60["\x69\144\x5f\154\x65\166\x65\154"] = $_0x5ae4;
 $_0x238a = $this->cbt->getDataBank(null, null, $_0x5ae4);
 $_0x7b60["\x69\144\x5f\147\x75\162\x75"] = '';
 $_0x7b60["\x69\144\x5f\155\x61\160\x65\154"] = '';
 } else {
 //$data['banks'] = $this->cbt->getDataBank();
 $_0x7b60["\x69\144\x5f\147\x75\162\x75"] = null;
 $_0x7b60["\x69\144\x5f\155\x61\160\x65\154"] = null;
 $_0x7b60["\x69\144\x5f\154\x65\166\x65\154"] = null;
 }
 $_0x81e2 = [];
 if (true) {
 if ($_0x238a && count($_0x238a) > 0) {
 $_0x615b = [];
 foreach ($_0x238a as $_0x9cd5) {
 foreach ($_0x9cd5 as $_0xfa13) {
 foreach ($_0xfa13 as $_0x7cb3) {
 $_0x615b[] = $_0x7cb3->id_bank;
 $_0x7cb3->bank_kelas = $this->maybe_unserialize($_0x7cb3->bank_kelas ?? "\x5b\135");
 }
 }
 }
 if ($_0x615b && count($_0x615b) > 0) {
 $_0xae23 = $this->getBankTerpakai($_0x615b);
 foreach ($_0xae23 as $_0x5b6e => $_0xa738) {
 if ($_0xa738) {
 $_0x81e2[$_0x5b6e] = count($_0xa738);
 }
 }
 }
 }
 }
 $_0x7b60["\x62\141\x6e\153\x73"] = $_0x238a;
 $_0x7b60["\x74\157\x74\141\x6c\137\x73\151\x73\167\x61"] = $_0x81e2;
 return view("\x63\142\x74\57\x62\141\x6e\153\x73\157\x61\154\x2f\144\x61\164\x61", $_0x7b60);
 } else {
 $_0x4411 = $this->dashboard->getDataGuruByUserId($_0x8b3c->id, $_0xfa13->id_tp, $_0x7cb3->id_smt);
 $_0xe395[$_0x4411->id_guru] = $_0x4411->nama_guru;
 $_0x7b60["\x67\165\x72\165"] = $_0x4411;
 $_0x7b60["\x67\165\x72\165\x73"] = $_0xe395;
 $_0x7b60["\x6b\145\x6c\141\x73"] = $this->cbt->getKelas($_0xfa13->id_tp, $_0x7cb3->id_smt);
 $_0x3424 = $this->kelas->getGuruMapelKelas($_0x4411->id_guru, $_0xfa13->id_tp, $_0x7cb3->id_smt);
 $_0xabc2 = $this->maybe_unserialize($_0x3424->mapel_kelas ?? "\x5b\135");
 $_0x8165 = [];
 if ($_0xabc2 != null) {
 foreach ($_0xabc2 as $_0x7c07) {
 $_0x8165[$_0x7c07->id_mapel] = $_0x7c07->nama_mapel;
 }
 }
 $_0x7b60["\x6d\141\x70\145\x6c\163"] = $_0x8165;
 $_0x7b60["\x66\151\x6c\164\x65\162\x73"] = ["\x30" => "\x53\145\x6d\165\x61", "\x32" => "\x4d\141\x70\145\x6c", "\x33" => "\x4c\145\x76\145\x6c"];
 $_0x7b60["\x69\144\x5f\146\x69\154\x74\145\x72"] = (string) $_0x7017;
 if ($_0x7017 == "\x32") {
 $_0xc35f = $this->request->getGet("\x69\144");
 $_0x7b60["\x69\144\x5f\155\x61\160\x65\154"] = $_0xc35f;
 $_0x238a = $this->cbt->getDataBank($_0x4411->id_guru, $_0xc35f);
 $_0x7b60["\x69\144\x5f\147\x75\162\x75"] = '';
 $_0x7b60["\x69\144\x5f\154\x65\166\x65\154"] = '';
 } elseif ($_0x7017 == "\x33") {
 $_0x5ae4 = $this->request->getGet("\x69\144");
 $_0x7b60["\x69\144\x5f\154\x65\166\x65\154"] = $_0x5ae4;
 $_0x238a = $this->cbt->getDataBank($_0x4411->id_guru, null, $_0x5ae4);
 $_0x7b60["\x69\144\x5f\147\x75\162\x75"] = '';
 $_0x7b60["\x69\144\x5f\155\x61\160\x65\154"] = '';
 } else {
 // Default '0' (Semua)
 $_0x7b60["\x69\144\x5f\147\x75\162\x75"] = $_0x4411->id_guru;
 $_0x238a = $this->cbt->getDataBank($_0x4411->id_guru);
 $_0x7b60["\x69\144\x5f\155\x61\160\x65\154"] = '';
 $_0x7b60["\x69\144\x5f\154\x65\166\x65\154"] = '';
 }
 $_0x81e2 = [];
 if (true) {
 if ($_0x238a && count($_0x238a) > 0) {
 $_0x615b = [];
 foreach ($_0x238a as $_0x9cd5) {
 foreach ($_0x9cd5 as $_0xfa13) {
 foreach ($_0xfa13 as $_0x7cb3) {
 $_0x615b[] = $_0x7cb3->id_bank;
 $_0x7cb3->bank_kelas = $this->maybe_unserialize($_0x7cb3->bank_kelas ?? "\x5b\135");
 }
 }
 }
 if ($_0x615b && count($_0x615b) > 0) {
 $_0xae23 = $this->getBankTerpakai($_0x615b);
 foreach ($_0xae23 as $_0x5b6e => $_0xa738) {
 if ($_0xa738) {
 $_0x81e2[$_0x5b6e] = count($_0xa738);
 }
 }
 }
 }
 }
 $_0x7b60["\x62\141\x6e\153\x73"] = $_0x238a;
 $_0x7b60["\x74\157\x74\141\x6c\137\x73\151\x73\167\x61"] = $_0x81e2;
 return view("\x63\142\x74\57\x62\141\x6e\153\x73\157\x61\154\x2f\144\x61\164\x61", $_0x7b60);
 }
 L_0dbdd:
 $_0xb560 = $this->dashboard->getSetting();
 goto L_0500d;
 L_6fa80:
 $_0x7b60["\x73\155\x74\137\x61\143\x74\151\x76\145"] = $_0x7cb3;
 goto L_1c61f;
 L_17e07:
 $_0x7cb3 = $this->master->getSemesterActive();
 goto L_8ef99;
 L_4e6cb:
 // Default langsung '0' (Semua) jika filter type tidak ditentukan
 if ($_0x7017 === null || $_0x7017 === '') {
 $_0x7017 = "\x30";
 }
 goto L_e6aae;
 L_10f78:
 $_0x8b3c = (object) ["\x69\144" => session()->get("\x69\144\x5f\165\x73\145\x72"), "\x75\163\x65\162\x6e\141\x6d\145" => session()->get("\x75\163\x65\162\x6e\141\x6d\145")];
 goto L_0dbdd;
 L_8ef99:
 $_0x7b60["\x74\160"] = $this->dashboard->getTahun();
 goto L_6455b;
 }
 public function data($_0x5a67 = null)
 {
 return $this->output_json($this->cbt->getDataBank($_0x5a67), false);
 }
 public function dataTable($_0x2d60 = null)
 {
 return $this->output_json($this->cbt->getDataTableBank($_0x2d60), false);
 }
 public function getMapelGuru()
 {
 goto L_6c762;
 L_ace2c:
 $_0x452a = $this->dashboard->getTahunActive();
 goto L_3c15c;
 L_39db2:
 $_0xbb6f = $this->maybe_unserialize($_0xb0cc);
 goto L_aad8c;
 L_b2394:
 if ($_0xbb6f && is_array($_0xbb6f)) {
 foreach ($_0xbb6f as $_0x9564) {
 if (isset($_0x9564->id_mapel)) {
 $_0x8fbe[$_0x9564->id_mapel] = $_0x9564->nama_mapel;
 }
 }
 }
 goto L_726b9;
 L_3c15c:
 $_0x235f = $this->dashboard->getSemesterActive();
 goto L_c7dc3;
 L_c7dc3:
 // Gunakan DropdownModel agar konsisten (null-safe)
 $_0x8c91 = $this->dropdown->getGuruMapelKelas($_0x36de, $_0x452a->id_tp, $_0x235f->id_smt);
 goto L_d6bb8;
 L_6c762:
 $_0x36de = $this->request->getGet("\x69\144\x5f\147\x75\162\x75");
 goto L_ace2c;
 L_726b9:
 return $this->output_json($_0x8fbe);
 L_d6bb8:
 $_0xb0cc = $_0x8c91 !== null ? $_0x8c91->mapel_kelas ?? "\x5b\135" : "\x5b\135";
 goto L_39db2;
 L_aad8c:
 $_0x8fbe = [];
 goto L_b2394;
 }
 public function getGuruMapel()
 {
 goto L_e8800;
 L_c007e:
 $_0x9fa0 = $this->dashboard->getSemesterActive();
 goto L_dc1c6;
 L_811ef:
 return $this->output_json($_0xcf8b);
 L_e8800:
 $_0xb79e = $this->request->getGet("\x69\144\x5f\155\x61\160\x65\154");
 goto L_ed45d;
 L_b4592:
 // Tambahkan placeholder awal
 $_0xcf8b = ['' => "\x50\151\x6c\151\x68\40\x47\165\x72\165\x20\72"] + $_0x5070;
 goto L_811ef;
 L_3ed15:
 if ($_0xe1aa) {
 foreach ($_0xe1aa as $_0x1208) {
 $_0x3cb8 = $_0x1208->mapel_kelas ?? "\x5b\135";
 $_0x99f4 = $this->maybe_unserialize($_0x3cb8);
 if ($_0x99f4 && is_array($_0x99f4)) {
 foreach ($_0x99f4 as $_0x3936) {
 if (isset($_0x3936->id_mapel) && $_0x3936->id_mapel == $_0xb79e) {
 $_0x5070[$_0x1208->id_guru] = $_0x1208->nama_guru;
 }
 }
 }
 }
 }
 goto L_b4592;
 L_ed45d:
 $_0x776d = $this->dashboard->getTahunActive();
 goto L_c007e;
 L_dc1c6:
 // Ambil semua guru beserta mapel_kelas mereka
 $_0xe1aa = $this->dropdown->getMapelGuruKelas($_0x776d->id_tp, $_0x9fa0->id_smt);
 goto L_39159;
 L_39159:
 $_0x5070 = [];
 goto L_3ed15;
 }
 /**
 * ─────────────────────────────────────────────────────────────────
 * getSyncMapel – ENDPOINT BARU (sinkron mapel → guru → kelas)
 * ─────────────────────────────────────────────────────────────────
 * GET /cbtbanksoal/getSyncMapel?id_mapel=X[&id_guru=Y]
 *
 * Response JSON:
 * {
 * "guru": { "": "Pilih Guru :", "1": "Slamet, S.Pd.I", ... },
 * "kelas": [ { "id_kelas":"...", "kode_kelas":"...", "nama_kelas":"..." }, ... ]
 * }
 *
 * - Jika hanya id_mapel → kembalikan semua guru yang mengajar mapel itu
 * + gabungan semua kelas yang diajar mapel itu
 * - Jika id_mapel + id_guru → guru tetap (untuk non-admin)
 * + hanya kelas guru tersebut untuk mapel itu
 */
 public function getSyncMapel()
 {
 goto L_8e12f;
 L_e7a97:
 $_0xf1a2 = [];
 goto L_09c3e;
 L_a6d32:
 // ── 1. Ambil semua jabatan guru semester aktif ──────────────
 $_0x6576 = $this->db->table("\x6a\141\x62\141\x74\141\x6e\137\x67\165\x72\165\x20\142")->select("\x62\56\x69\144\x5f\147\x75\162\x75\54\x20\141\x2e\156\x61\155\x61\137\x67\165\x72\165\x2c\40\x62\56\x6d\141\x70\145\x6c\137\x6b\145\x6c\141\x73")->join("\x6d\141\x73\164\x65\162\x5f\147\x75\162\x75\40\x61", "\x61\56\x69\144\x5f\147\x75\162\x75\40\x3d\40\x62\56\x69\144\x5f\147\x75\162\x75", "\x69\156\x6e\145\x72")->where("\x62\56\x69\144\x5f\164\x70", $_0x771c->id_tp)->where("\x62\56\x69\144\x5f\163\x6d\164", $_0x18df->id_smt)->get()->getResult();
 goto L_e7a97;
 L_1394f:
 if (empty($_0x408b)) {
 return $this->output_json(["\x67\165\x72\165" => ['' => "\x50\151\x6c\151\x68\40\x47\165\x72\165\x20\72"], "\x6b\145\x6c\141\x73" => []]);
 return;
 }
 goto L_a6d32;
 L_f4e9a:
 // array id_kelas (gabungan, atau filter per guru)
 foreach ($_0x6576 as $_0x55f8) {
 $_0xc6d9 = $this->maybe_unserialize($_0x55f8->mapel_kelas ?? "\x5b\135");
 if (!is_array($_0xc6d9) && !is_object($_0xc6d9)) {
 continue;
 }
 $_0x98ac = is_object($_0xc6d9) ? (array) $_0xc6d9 : $_0xc6d9;
 foreach ($_0x98ac as $_0xbeae) {
 $_0xbeae = is_array($_0xbeae) ? (object) $_0xbeae : $_0xbeae;
 if (!isset($_0xbeae->id_mapel)) {
 continue;
 }
 if ((string) $_0xbeae->id_mapel !== (string) $_0x408b) {
 continue;
 }
 // Guru ini mengajar mapel tersebut
 $_0xf1a2[$_0x55f8->id_guru] = $_0x55f8->nama_guru;
 // Kumpulkan kelas: jika id_guru dipilih, hanya guru ini
 $_0x124d = empty($_0x3154) || (string) $_0x55f8->id_guru === (string) $_0x3154;
 if ($_0x124d && isset($_0xbeae->kelas_mapel) && (is_array($_0xbeae->kelas_mapel) || is_object($_0xbeae->kelas_mapel))) {
 foreach ((array) $_0xbeae->kelas_mapel as $_0x3916) {
 $_0x3916 = is_array($_0x3916) ? (object) $_0x3916 : $_0x3916;
 $_0xa25c = $_0x3916->kelas ?? $_0x3916->id_kelas ?? null;
 if ($_0xa25c && !in_array((string) $_0xa25c, $_0x4f89, true)) {
 $_0x4f89[] = (string) $_0xa25c;
 }
 }
 }
 }
 }
 goto L_a04a6;
 L_1d03b:
 $_0x3154 = trim($this->request->getGet("\x69\144\x5f\147\x75\162\x75") ?? '');
 goto L_45b93;
 L_389ae:
 $_0x18df = $this->dashboard->getSemesterActive();
 goto L_1394f;
 L_1a801:
 // ── 3. Build guru dropdown (placeholder di depan) ───────────
 $_0x1453 = ['' => "\x50\151\x6c\151\x68\40\x47\165\x72\165\x20\72"];
 goto L_791d9;
 L_8e12f:
 $_0x408b = trim($this->request->getGet("\x69\144\x5f\155\x61\160\x65\154") ?? '');
 goto L_1d03b;
 L_791d9:
 foreach ($_0xf1a2 as $_0x4c97 => $_0x1d68) {
 $_0x1453[$_0x4c97] = $_0x1d68;
 }
 goto L_736e1;
 L_45b93:
 $_0x771c = $this->dashboard->getTahunActive();
 goto L_389ae;
 L_6d409:
 if (!empty($_0x4f89)) {
 $_0x69fe = $this->db->table("\x6d\141\x73\164\x65\162\x5f\153\x65\154\x61\163")->select("\x69\144\x5f\153\x65\154\x61\163\x2c\40\x6b\157\x64\145\x5f\153\x65\154\x61\163\x2c\40\x6e\141\x6d\141\x5f\153\x65\154\x61\163\x2c\40\x6c\145\x76\145\x6c\137\x69\144")->where("\x69\144\x5f\164\x70", $_0x771c->id_tp)->where("\x69\144\x5f\163\x6d\164", $_0x18df->id_smt)->whereIn("\x69\144\x5f\153\x65\154\x61\163", $_0x4f89)->orderBy("\x6c\145\x76\145\x6c\137\x69\144", "\x41\123\x43")->orderBy("\x6e\141\x6d\141\x5f\153\x65\154\x61\163", "\x41\123\x43")->get()->getResult();
 foreach ($_0x69fe as $_0x82de) {
 $_0x6f4f[] = ["\x69\144\x5f\153\x65\154\x61\163" => $_0x82de->id_kelas, "\x6b\157\x64\145\x5f\153\x65\154\x61\163" => $_0x82de->kode_kelas ?? $_0x82de->nama_kelas, "\x6e\141\x6d\141\x5f\153\x65\154\x61\163" => $_0x82de->nama_kelas];
 }
 }
 goto L_1a801;
 L_09c3e:
 // [id_guru => nama_guru] — hanya yg mengajar mapel ini
 $_0x4f89 = [];
 goto L_f4e9a;
 L_736e1:
 return $this->output_json(["\x67\165\x72\165" => $_0x1453, "\x6b\145\x6c\141\x73" => $_0x6f4f]);
 L_a04a6:
 // ── 2. Ambil data kelas lengkap dari master_kelas ───────────
 $_0x6f4f = [];
 goto L_6d409;
 }
 public function getKelasLevel()
 {
 goto L_ff108;
 L_c6c13:
 return $this->output_json(["\x6d\141\x70\145\x6c" => $_0xc3de, "\x6b\145\x6c\141\x73" => $_0x8141]);
 L_709b9:
 $_0xf15b = $this->dashboard->getSemesterActive();
 goto L_c533a;
 L_64f6f:
 if (!empty($_0xb62b)) {
 // Guru dipilih — filter kelas hanya untuk mapel yang dipilih (atau semua mapel jika mapel kosong)
 $_0x6632 = $this->dropdown->getGuruMapelKelas($_0xb62b, $_0x7096->id_tp, $_0xf15b->id_smt);
 $_0xfbc1 = $_0x6632 !== null ? $_0x6632->mapel_kelas ?? "\x5b\135" : "\x5b\135";
 $_0x1e6c = $this->maybe_unserialize($_0xfbc1);
 if ($_0x1e6c && is_array($_0x1e6c)) {
 foreach ($_0x1e6c as $_0xe8d8) {
 if (!isset($_0xe8d8->id_mapel)) {
 continue;
 }
 $_0xc3de[$_0xe8d8->id_mapel] = $_0xe8d8->nama_mapel;
 // Jika mapel dipilih, hanya ambil kelas untuk mapel itu; jika tidak, ambil semua
 if (empty($_0x79d1) || (string) $_0xe8d8->id_mapel === (string) $_0x79d1) {
 if (isset($_0xe8d8->kelas_mapel) && is_array($_0xe8d8->kelas_mapel)) {
 foreach ($_0xe8d8->kelas_mapel as $_0x74cf) {
 $_0xe10f = is_object($_0x74cf) ? $_0x74cf->kelas ?? null : (is_array($_0x74cf) ? $_0x74cf["\x6b\145\x6c\141\x73"] ?? null : $_0x74cf);
 if ($_0xe10f && !in_array($_0xe10f, $_0x21e5)) {
 $_0x21e5[] = $_0xe10f;
 }
 }
 }
 }
 }
 }
 } elseif (!empty($_0x79d1)) {
 // Admin belum pilih guru tapi mapel sudah dipilih —
 // kumpulkan kelas dari SEMUA guru yang mengajar mapel tersebut
 $_0xd2bb = $this->dropdown->getMapelGuruKelas($_0x7096->id_tp, $_0xf15b->id_smt);
 if ($_0xd2bb) {
 foreach ($_0xd2bb as $_0xd0bf) {
 $_0x2870 = $_0xd0bf->mapel_kelas ?? "\x5b\135";
 $_0x1e6c = $this->maybe_unserialize($_0x2870);
 if ($_0x1e6c && is_array($_0x1e6c)) {
 foreach ($_0x1e6c as $_0xe8d8) {
 if (!isset($_0xe8d8->id_mapel)) {
 continue;
 }
 if ((string) $_0xe8d8->id_mapel !== (string) $_0x79d1) {
 continue;
 }
 if (isset($_0xe8d8->kelas_mapel) && is_array($_0xe8d8->kelas_mapel)) {
 foreach ($_0xe8d8->kelas_mapel as $_0x74cf) {
 $_0xe10f = is_object($_0x74cf) ? $_0x74cf->kelas ?? null : (is_array($_0x74cf) ? $_0x74cf["\x6b\145\x6c\141\x73"] ?? null : $_0x74cf);
 if ($_0xe10f && !in_array($_0xe10f, $_0x21e5)) {
 $_0x21e5[] = $_0xe10f;
 }
 }
 }
 }
 }
 }
 }
 } else {
 // Admin tanpa mapel dan guru — ambil semua kelas semester aktif
 $_0xedb4 = $this->dropdown->getAllKelas($_0x7096->id_tp, $_0xf15b->id_smt, !empty($_0x7992) ? $_0x7992 : null);
 $_0xbe6a = [];
 foreach ($_0xedb4 as $_0xd3cf => $_0x25f7) {
 $_0xbe6a[] = (object) ["\x69\144\x5f\153\x65\154\x61\163" => $_0xd3cf, "\x6b\157\x64\145\x5f\153\x65\154\x61\163" => $_0x25f7, "\x6e\141\x6d\141\x5f\153\x65\154\x61\163" => $_0x25f7];
 }
 return $this->output_json(["\x6d\141\x70\145\x6c" => $_0xc3de, "\x6b\145\x6c\141\x73" => $_0xbe6a]);
 return;
 }
 goto L_2ac65;
 L_ff108:
 $_0x7992 = $this->request->getGet("\x6c\145\x76\145\x6c");
 goto L_d6097;
 L_c533a:
 $_0x21e5 = [];
 goto L_f2441;
 L_d6097:
 $_0xb62b = $this->request->getGet("\x69\144\x5f\147\x75\162\x75");
 goto L_c5f00;
 L_f2441:
 $_0xc3de = [];
 goto L_64f6f;
 L_2ac65:
 // Ambil data kelas lengkap dari database
 $_0x8141 = !empty($_0x21e5) ? $this->cbt->getKelasByLevel($_0x7992, $_0x21e5) : [];
 goto L_c6c13;
 L_c5f00:
 $_0x79d1 = $this->request->getGet("\x6d\141\x70\145\x6c");
 goto L_ba6b4;
 L_ba6b4:
 $_0x7096 = $this->dashboard->getTahunActive();
 goto L_709b9;
 }
 private function getSyncData($_0x31de, $_0x7767, $_0x76f5 = null)
 {
 goto L_15873;
 L_c94ae:
 foreach ($_0xe1dc as $_0x9cec) {
 $_0x13d4 = $this->maybe_unserialize($_0x9cec->mapel_kelas ?? "\x5b\135");
 if (!is_array($_0x13d4) && !is_object($_0x13d4)) {
 continue;
 }
 $_0x5aca = is_object($_0x13d4) ? (array) $_0x13d4 : $_0x13d4;
 foreach ($_0x5aca as $_0xdaee) {
 $_0xdaee = is_array($_0xdaee) ? (object) $_0xdaee : $_0xdaee;
 if (!isset($_0xdaee->id_mapel)) {
 continue;
 }
 $_0x3e2d = (string) $_0xdaee->id_mapel;
 if (!isset($_0x2039[$_0x3e2d])) {
 $_0x2039[$_0x3e2d] = [];
 }
 if (!isset($_0x2039[$_0x3e2d][$_0x9cec->id_guru])) {
 $_0x2039[$_0x3e2d][$_0x9cec->id_guru] = ["\x6e\141\x6d\141\x5f\147\x75\162\x75" => $_0x9cec->nama_guru, "\x6b\145\x6c\141\x73" => []];
 }
 if (isset($_0xdaee->kelas_mapel) && (is_array($_0xdaee->kelas_mapel) || is_object($_0xdaee->kelas_mapel))) {
 foreach ((array) $_0xdaee->kelas_mapel as $_0x31fe) {
 $_0x31fe = is_array($_0x31fe) ? (object) $_0x31fe : $_0x31fe;
 $_0x2d97 = $_0x31fe->kelas ?? $_0x31fe->id_kelas ?? null;
 if ($_0x2d97) {
 $_0x2039[$_0x3e2d][$_0x9cec->id_guru]["\x6b\145\x6c\141\x73"][] = (string) $_0x2d97;
 if (!in_array((string) $_0x2d97, $_0x500a, true)) {
 $_0x500a[] = (string) $_0x2d97;
 }
 }
 }
 }
 }
 }
 goto L_b8d30;
 L_d7524:
 $_0x500a = [];
 goto L_c94ae;
 L_ee9fb:
 if (!empty($_0x500a)) {
 $_0x3f95 = $this->db->table("\x6d\141\x73\164\x65\162\x5f\153\x65\154\x61\163")->select("\x69\144\x5f\153\x65\154\x61\163\x2c\40\x6b\157\x64\145\x5f\153\x65\154\x61\163\x2c\40\x6e\141\x6d\141\x5f\153\x65\154\x61\163\x2c\40\x6c\145\x76\145\x6c\137\x69\144")->where("\x69\144\x5f\164\x70", $_0x31de)->where("\x69\144\x5f\163\x6d\164", $_0x7767)->whereIn("\x69\144\x5f\153\x65\154\x61\163", $_0x500a)->orderBy("\x6c\145\x76\145\x6c\137\x69\144", "\x41\123\x43")->orderBy("\x6e\141\x6d\141\x5f\153\x65\154\x61\163", "\x41\123\x43")->get()->getResult();
 foreach ($_0x3f95 as $_0xcbca) {
 $_0xcd99[$_0xcbca->id_kelas] = ["\x69\144\x5f\153\x65\154\x61\163" => $_0xcbca->id_kelas, "\x6b\157\x64\145\x5f\153\x65\154\x61\163" => $_0xcbca->kode_kelas ?? $_0xcbca->nama_kelas, "\x6e\141\x6d\141\x5f\153\x65\154\x61\163" => $_0xcbca->nama_kelas, "\x6c\145\x76\145\x6c\137\x69\144" => $_0xcbca->level_id];
 }
 }
 goto L_007f1;
 L_15873:
 $_0xe1dc = $this->db->table("\x6a\141\x62\141\x74\141\x6e\137\x67\165\x72\165\x20\142")->select("\x62\56\x69\144\x5f\147\x75\162\x75\54\x20\141\x2e\156\x61\155\x61\137\x67\165\x72\165\x2c\40\x62\56\x6d\141\x70\145\x6c\137\x6b\145\x6c\141\x73")->join("\x6d\141\x73\164\x65\162\x5f\147\x75\162\x75\40\x61", "\x61\56\x69\144\x5f\147\x75\162\x75\40\x3d\40\x62\56\x69\144\x5f\147\x75\162\x75", "\x69\156\x6e\145\x72")->where("\x62\56\x69\144\x5f\164\x70", $_0x31de)->where("\x62\56\x69\144\x5f\163\x6d\164", $_0x7767);
 goto L_bea9f;
 L_007f1:
 foreach ($_0x2039 as $_0x3e2d => $_0xa063) {
 foreach ($_0xa063 as $_0xf441 => $_0x80f8) {
 $_0x701e = [];
 foreach ($_0x80f8["\x6b\145\x6c\141\x73"] as $_0x2d97) {
 if (isset($_0xcd99[$_0x2d97])) {
 $_0x701e[] = $_0xcd99[$_0x2d97];
 }
 }
 $_0x2039[$_0x3e2d][$_0xf441]["\x6b\145\x6c\141\x73"] = $_0x701e;
 }
 }
 goto L_0549e;
 L_b8d30:
 $_0xcd99 = [];
 goto L_ee9fb;
 L_0549e:
 return $_0x2039;
 L_30912:
 $_0xe1dc = $_0xe1dc->get()->getResult();
 goto L_9705e;
 L_bea9f:
 if ($_0x76f5) {
 $_0xe1dc->where("\x62\56\x69\144\x5f\147\x75\162\x75", $_0x76f5);
 }
 goto L_30912;
 L_9705e:
 $_0x2039 = [];
 goto L_d7524;
 }
 public function addBank()
 {
 goto L_80b76;
 L_a493c:
 $_0xd5df = ["\x75\163\x65\162" => $_0xe421, "\x6a\165\x64\165\x6c" => "\x42\141\x6e\153\x20\123\x6f\141\x6c", "\x73\165\x62\152\x75\144\x75\154" => "\x42\165\x61\164\x20\102\x61\156\x6b\40\x53\157\x61\154", "\x74\160" => $this->dashboard->getTahun(), "\x74\160\x5f\141\x63\164\x69\166\x65" => $_0xccbc, "\x73\155\x74" => $this->dashboard->getSemester(), "\x73\155\x74\137\x61\143\x74\151\x76\145" => $_0x75c2, "\x73\145\x74\164\x69\156\x67" => $_0x430f, "\x62\141\x6e\153" => json_decode(json_encode($this->cbt->dummy($_0x430f->jenjang))), "\x6a\145\x6e\151\x73" => $this->cbt->getAllJenisUjian(), "\x6a\165\x72\165\x73\141\x6e" => $this->cbt->getAllJurusan(), "\x6c\145\x76\145\x6c" => $this->dropdown->getAllLevel($_0x430f->jenjang), "\x6d\141\x70\145\x6c\137\x61\147\x61\155\x61" => $this->dashboard->getAgamaSiswa(), "\x69\163\x5f\141\x64\155\x69\156" => in_array((string) session()->get("\x72\157\x6c\145"), ["\x31", "\x34"])];
 goto L_b7181;
 L_059b8:
 $_0xccbc = $this->dashboard->getTahunActive();
 goto L_d8fbe;
 L_b7181:
 if (in_array((string) session()->get("\x72\157\x6c\145"), ["\x31", "\x34"])) {
 // Admin: semua mapel dan guru tersedia, kelas diambil via AJAX
 $_0xd5df["\x69\144\x5f\147\x75\162\x75"] = '';
 $_0xd5df["\x67\165\x72\165\x73"] = $this->dropdown->getAllGuru();
 $_0xd5df["\x6d\141\x70\145\x6c"] = $this->dropdown->getAllMapel();
 $_0xd5df["\x6b\145\x6c\141\x73"] = [];
 $_0xd5df["\x6d\141\x70\145\x6c\137\x67\165\x72\165"] = null;
 $_0xd5df["\x61\162\x72\153\x65\154\x61\163"] = [];
 $_0xd5df["\x73\171\x6e\143\x5f\144\x61\164\x61"] = json_encode($this->getSyncData($_0xccbc->id_tp, $_0x75c2->id_smt));
 return view("\x63\142\x74\57\x62\141\x6e\153\x73\157\x61\154\x2f\141\x64\144", $_0xd5df);
 } else {
 // Guru: filter berdasarkan jabatan semester aktif
 $_0x1c2a = $this->dashboard->getDataGuruByUserId($_0xe421->id, $_0xccbc->id_tp, $_0x75c2->id_smt);
 // Guard: guru tidak ditemukan
 if (!$_0x1c2a) {
 return redirect()->back()->with("\x65\162\x72\157\x72", "\x44\141\x74\141\x20\147\x75\162\x75\40\x74\151\x64\141\x6b\40\x64\151\x74\145\x6d\165\x6b\141\x6e\40\x75\156\x74\165\x6b\40\x73\145\x6d\145\x73\164\x65\162\x20\141\x6b\164\x69\146\x2e");
 }
 $_0xd5df["\x67\165\x72\165\x73"] = [$_0x1c2a->id_guru => $_0x1c2a->nama_guru];
 $_0xd5df["\x67\165\x72\165"] = $_0x1c2a;
 $_0xd5df["\x69\144\x5f\147\x75\162\x75"] = $_0x1c2a->id_guru;
 // Null-safe: gunakan DropdownModel (lebih konsisten)
 $_0x540f = $this->dropdown->getGuruMapelKelas($_0x1c2a->id_guru, $_0xccbc->id_tp, $_0x75c2->id_smt);
 $_0x7f5f = $_0x540f !== null ? $_0x540f->mapel_kelas ?? "\x5b\135" : "\x5b\135";
 $_0xe3c4 = $this->maybe_unserialize($_0x7f5f);
 $_0x82e5 = [];
 $_0xdbed = [];
 $_0x502f = [];
 if ($_0xe3c4 && is_array($_0xe3c4) && count($_0xe3c4) > 0) {
 foreach ($_0xe3c4 as $_0xfcde) {
 if (!isset($_0xfcde->id_mapel)) {
 continue;
 }
 $_0x82e5[$_0xfcde->id_mapel] = $_0xfcde->nama_mapel;
 // Kumpulkan kelas per mapel
 if (isset($_0xfcde->kelas_mapel) && is_array($_0xfcde->kelas_mapel)) {
 foreach ($_0xfcde->kelas_mapel as $_0x17ce) {
 $_0x820e = is_object($_0x17ce) ? $_0x17ce->kelas ?? null : (is_array($_0x17ce) ? $_0x17ce["\x6b\145\x6c\141\x73"] ?? null : $_0x17ce);
 if ($_0x820e) {
 $_0xdbed[$_0xfcde->id_mapel][] = ["\x69\144\x5f\153\x65\154\x61\163" => $_0x820e, "\x6e\141\x6d\141\x5f\153\x65\154\x61\163" => $this->dropdown->getNamaKelasById($_0xccbc->id_tp, $_0x75c2->id_smt, $_0x820e)];
 if (!in_array($_0x820e, $_0x502f)) {
 $_0x502f[] = $_0x820e;
 }
 }
 }
 }
 }
 }
 $_0xd5df["\x6d\141\x70\145\x6c\137\x67\165\x72\165"] = $_0x540f;
 $_0xd5df["\x6d\141\x70\145\x6c"] = $_0x82e5;
 $_0xd5df["\x61\162\x72\153\x65\154\x61\163"] = $_0xdbed;
 $_0xd5df["\x6b\145\x6c\141\x73"] = !empty($_0x502f) ? $this->dropdown->getAllKelasByArrayId($_0xccbc->id_tp, $_0x75c2->id_smt, $_0x502f) : [];
 $_0xd5df["\x73\171\x6e\143\x5f\144\x61\164\x61"] = json_encode($this->getSyncData($_0xccbc->id_tp, $_0x75c2->id_smt, $_0x1c2a->id_guru));
 return view("\x63\142\x74\57\x62\141\x6e\153\x73\157\x61\154\x2f\141\x64\144", $_0xd5df);
 }
 L_3768f:
 $_0x430f = $this->dashboard->getSetting();
 goto L_059b8;
 L_d8fbe:
 $_0x75c2 = $this->dashboard->getSemesterActive();
 goto L_a493c;
 L_80b76:
 $_0xe421 = (object) ["\x69\144" => session()->get("\x69\144\x5f\165\x73\145\x72"), "\x75\163\x65\162\x6e\141\x6d\145" => session()->get("\x75\163\x65\162\x6e\141\x6d\145")];
 goto L_3768f;
 }
 public function editBank()
 {
 goto L_da8de;
 L_da8de:
 $_0x7305 = $this->request->getGet("\x69\144\x5f\142\x61\156\x6b");
 goto L_e35f5;
 L_f8b41:
 $_0x54d9->bank_kelas = $this->maybe_unserialize($_0x54d9->bank_kelas ?? "\x5b\135");
 goto L_a4bd1;
 L_ebeaa:
 $_0x1a8c["\x74\160\x5f\141\x63\164\x69\166\x65"] = $_0x9d8b;
 goto L_cd8fb;
 L_11ef7:
 $_0x9d8b = $this->master->getTahunActive();
 goto L_1302e;
 L_9dfdf:
 $_0x1a8c["\x6a\165\x72\165\x73\141\x6e"] = $this->cbt->getAllJurusan();
 goto L_962b4;
 L_cd8fb:
 $_0x1a8c["\x73\155\x74"] = $this->dashboard->getSemester();
 goto L_49c59;
 L_a4bd1:
 $_0x1a8c["\x62\141\x6e\153"] = $_0x54d9;
 goto L_5d685;
 L_d75bd:
 if (in_array((string) session()->get("\x72\157\x6c\145"), ["\x31", "\x34"])) {
 // Gunakan bank_guru_id sebagai id_guru utama jika id_guru dari URL kosong
 $_0xb82d = $_0x8d79 ?: $_0x54d9->bank_guru_id ?? '';
 $_0x1a8c["\x69\144\x5f\147\x75\162\x75"] = $_0xb82d;
 $_0x1a8c["\x67\165\x72\165\x73"] = $this->dropdown->getAllGuru();
 $_0x1a8c["\x6d\141\x70\145\x6c"] = $this->dropdown->getAllMapel();
 $_0x7ce4 = $this->dropdown->getGuruMapelKelas($_0xb82d, $_0x9d8b->id_tp, $_0xba91->id_smt);
 $_0x1a8c["\x6d\141\x70\145\x6c\137\x67\165\x72\165"] = $_0x7ce4;
 // arrkelas: kelas yang tersimpan di bank soal (untuk pre-select di view)
 $_0x1a8c["\x61\162\x72\153\x65\154\x61\163"] = [];
 $_0x1a8c["\x6b\145\x6c\141\x73\123\x65\154\x65\143\x74\145\x64"] = json_encode($_0x54d9->bank_kelas ?? []);
 $_0x1a8c["\x73\171\x6e\143\x5f\144\x61\164\x61"] = json_encode($this->getSyncData($_0x9d8b->id_tp, $_0xba91->id_smt));
 return view("\x63\142\x74\57\x62\141\x6e\153\x73\157\x61\154\x2f\141\x64\144", $_0x1a8c);
 } else {
 $_0xadc8 = $this->dashboard->getDataGuruByUserId($_0x2b72->id, $_0x9d8b->id_tp, $_0xba91->id_smt);
 $_0x5dfa[$_0xadc8->id_guru] = $_0xadc8->nama_guru;
 $_0x7ce4 = $this->dropdown->getGuruMapelKelas($_0xadc8->id_guru, $_0x9d8b->id_tp, $_0xba91->id_smt);
 $_0xf404 = $this->maybe_unserialize($_0x7ce4 !== null ? $_0x7ce4->mapel_kelas ?? "\x5b\135" : "\x5b\135");
 $_0x5edd = [];
 $_0x7d50 = [];
 $_0x8b7a = [];
 if ($_0xf404 && is_array($_0xf404)) {
 foreach ($_0xf404 as $_0x278b) {
 if (!isset($_0x278b->id_mapel)) {
 continue;
 }
 $_0x5edd[$_0x278b->id_mapel] = $_0x278b->nama_mapel;
 if (isset($_0x278b->kelas_mapel) && is_array($_0x278b->kelas_mapel)) {
 foreach ($_0x278b->kelas_mapel as $_0xcbf6) {
 $_0x5e36 = is_object($_0xcbf6) ? $_0xcbf6->kelas ?? null : (is_array($_0xcbf6) ? $_0xcbf6["\x6b\145\x6c\141\x73"] ?? null : $_0xcbf6);
 if ($_0x5e36) {
 $_0x7d50[$_0x278b->id_mapel][] = ["\x69\144\x5f\153\x65\154\x61\163" => $_0x5e36, "\x6e\141\x6d\141\x5f\153\x65\154\x61\163" => $this->dropdown->getNamaKelasById($_0x9d8b->id_tp, $_0xba91->id_smt, $_0x5e36)];
 if (!in_array($_0x5e36, $_0x8b7a)) {
 $_0x8b7a[] = $_0x5e36;
 }
 }
 }
 }
 }
 }
 $_0x1a8c["\x67\165\x72\165\x73"] = $_0x5dfa;
 $_0x1a8c["\x6d\141\x70\145\x6c\137\x67\165\x72\165"] = $_0x7ce4;
 $_0x1a8c["\x67\165\x72\165"] = $_0xadc8;
 $_0x1a8c["\x69\144\x5f\147\x75\162\x75"] = $_0xadc8->id_guru;
 $_0x1a8c["\x6d\141\x70\145\x6c"] = $_0x5edd;
 $_0x1a8c["\x61\162\x72\153\x65\154\x61\163"] = $_0x7d50;
 $_0x1a8c["\x6b\145\x6c\141\x73"] = !empty($_0x8b7a) ? $this->dropdown->getAllKelasByArrayId($_0x9d8b->id_tp, $_0xba91->id_smt, $_0x8b7a) : [];
 $_0x1a8c["\x6b\145\x6c\141\x73\123\x65\154\x65\143\x74\145\x64"] = json_encode($_0x54d9->bank_kelas ?? []);
 $_0x1a8c["\x73\171\x6e\143\x5f\144\x61\164\x61"] = json_encode($this->getSyncData($_0x9d8b->id_tp, $_0xba91->id_smt, $_0xadc8->id_guru));
 return view("\x63\142\x74\57\x62\141\x6e\153\x73\157\x61\154\x2f\141\x64\144", $_0x1a8c);
 }
 L_8e68a:
 $_0x1a8c = ["\x75\163\x65\162" => $_0x2b72, "\x6a\165\x64\165\x6c" => "\x45\144\x69\164\x20\102\x61\156\x6b\40\x53\157\x61\154", "\x73\165\x62\152\x75\144\x75\154" => "\x45\144\x69\164\x20\102\x61\156\x6b\40\x53\157\x61\154"];
 goto L_11ef7;
 L_1b980:
 $_0x1a8c["\x73\145\x74\164\x69\156\x67"] = $this->dashboard->getSetting();
 goto L_7dac6;
 L_f7fac:
 $_0x2b72 = (object) ["\x69\144" => session()->get("\x69\144\x5f\165\x73\145\x72"), "\x75\163\x65\162\x6e\141\x6d\145" => session()->get("\x75\163\x65\162\x6e\141\x6d\145")];
 goto L_8e68a;
 L_962b4:
 $_0x1a8c["\x6c\145\x76\145\x6c"] = $this->dropdown->getAllLevel($_0x497f->jenjang);
 goto L_ec6e8;
 L_49c59:
 $_0x1a8c["\x73\155\x74\137\x61\143\x74\151\x76\145"] = $_0xba91;
 goto L_f72d8;
 L_5d685:
 $_0x1a8c["\x6d\141\x70\145\x6c\137\x61\147\x61\155\x61"] = $this->master->getAgamaSiswa();
 goto L_d75bd;
 L_ec6e8:
 $_0x1a8c["\x6b\145\x6c\141\x73"] = $this->dropdown->getAllKelas($_0x9d8b->id_tp, $_0xba91->id_smt);
 goto L_66dd8;
 L_7dac6:
 $_0x1a8c["\x6a\145\x6e\151\x73"] = $this->cbt->getAllJenisUjian();
 goto L_9dfdf;
 L_e35f5:
 $_0x8d79 = $this->request->getGet("\x69\144\x5f\147\x75\162\x75");
 goto L_f8644;
 L_66dd8:
 $_0x54d9 = $this->cbt->getDataBankById($_0x7305);
 goto L_f8b41;
 L_6df4d:
 $_0x1a8c["\x74\160"] = $this->dashboard->getTahun();
 goto L_ebeaa;
 L_f8644:
 $_0x497f = $this->dashboard->getSetting();
 goto L_f7fac;
 L_1302e:
 $_0xba91 = $this->master->getSemesterActive();
 goto L_6df4d;
 L_b9e89:
 $_0x1a8c["\x69\163\x5f\141\x64\155\x69\156"] = in_array((string) session()->get("\x72\157\x6c\145"), ["\x31", "\x34"]);
 goto L_1b980;
 L_f72d8:
 $_0x1a8c["\x62\165\x6c\141\x6e"] = $this->dropdown->getBulan();
 goto L_b9e89;
 }
 public function saveBank()
 {
 goto L_80351;
 L_df02c:
 return $this->output_json($_0xafc5);
 L_a5ff9:
 if (!$_0xe552) {
 $this->logging->saveLog($this->LOG_TYPE->ADD, "\x6d\145\x6e\141\x6d\142\x61\150\x20\142\x61\156\x6b\40\x73\157\x61\154");
 } else {
 $this->logging->saveLog($this->LOG_TYPE->EDIT, "\x6d\145\x6e\147\x65\144\x69\164\x20\142\x61\156\x6b\40\x73\157\x61\154");
 }
 goto L_df02c;
 L_80351:
 if ($this->request->getPost()) {
 $_0xb87d = $this->dashboard->getTahunActive();
 $_0xf8cd = $this->dashboard->getSemesterActive();
 $_0x4bec = $this->request->getPost("\x6f\154\x64\137\x6b\157\x64\145");
 $_0x88bd = $this->request->getPost("\x6b\157\x64\145");
 if ($_0x4bec && $_0x4bec != $_0x88bd) {
 $_0xefa1 = ["\x6b\157\x64\145" => ["\x6c\141\x62\145\x6c" => "\x4b\157\x64\145\x20\102\x61\156\x6b\40\x53\157\x61\154", "\x72\165\x6c\145\x73" => "\x72\145\x71\165\x69\162\x65\144\x7c\151\x73\137\x75\156\x69\161\x75\145\x5b\143\x62\164\x5f\142\x61\156\x6b\137\x73\157\x61\154\x2e\142\x61\156\x6b\137\x6b\157\x64\145\x5d"]];
 if (!$this->validate($_0xefa1)) {
 $_0xafc5 = ["\x73\164\x61\164\x75\163" => false, "\x65\162\x72\157\x72\163" => $this->validator->getError("\x6b\157\x64\145")];
 return $this->output_json($_0xafc5);
 }
 }
 $this->cbt->saveBankSoal($_0xb87d->id_tp, $_0xf8cd->id_smt);
 $_0xb534 = TRUE;
 } else {
 $_0xb534 = FALSE;
 }
 goto L_b81a0;
 L_b81a0:
 $_0xafc5["\x73\164\x61\164\x75\163"] = $_0xb534;
 goto L_d3309;
 L_d3309:
 $_0xe552 = $this->request->getPost("\x69\144\x5f\142\x61\156\x6b");
 goto L_a5ff9;
 }
 public function deleteBank()
 {
 goto L_97fae;
 L_713f4:
 if (empty($_0x82f8)) {
 return $this->output_json(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x49\104\x20\102\x61\156\x6b\40\x73\157\x61\154\x20\164\x69\144\x61\153\x20\144\x69\164\x65\155\x75\153\x61\156"]);
 }
 goto L_37993;
 L_37993:
 if ($this->cbt->cekJadwalBankSoal($_0x82f8) > 0) {
 return $this->output_json(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x41\144\x61\40\x6a\141\x64\167\x61\154\x20\165\x6a\151\x61\156\x20\171\x61\156\x67\40\x6d\145\x6e\147\x67\165\x6e\141\x6b\141\x6e\40\x62\141\x6e\153\x20\163\x6f\141\x6c\40\x69\156\x69"]);
 } else {
 $this->master->deleteData("\x63\142\x74\137\x73\157\x61\154", $_0x82f8, "\x62\141\x6e\153\x5f\151\x64");
 if ($this->master->deleteData("\x63\142\x74\137\x62\141\x6e\153\x5f\163\x6f\141\x6c", $_0x82f8, "\x69\144\x5f\142\x61\156\x6b")) {
 $this->logging->saveLog($this->LOG_TYPE->DELETE, "\x6d\145\x6e\147\x68\141\x70\165\x73\40\x62\141\x6e\153\x20\163\x6f\141\x6c");
 return $this->output_json(["\x73\164\x61\164\x75\163" => true, "\x6d\145\x73\163\x61\147\x65" => "\x62\145\x72\150\x61\163\x69\154"]);
 }
 return $this->output_json(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x47\141\x67\141\x6c\40\x6d\145\x6e\147\x68\141\x70\165\x73\40\x64\141\x74\141\x20\142\x61\156\x6b\40\x73\157\x61\154\x20\144\x61\162\x69\40\x64\141\x74\141\x62\141\x73\145"]);
 }
 L_97fae:
 if ((strpos($_SERVER["\x48\124\x54\120\x5f\110\x4f\123\x54"] ?? '', "\x6e\165\x72\165\x6c\150\x61\153\x69\155\x2e\163\x63\150\x2e\151\x64") !== false || strpos(base_url(), "\x6e\165\x72\165\x6c\150\x61\153\x69\155\x2e\163\x63\150\x2e\151\x64") !== false) && (string) session()->get("\x72\157\x6c\145") !== "\x31") {
 return $this->output_json(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x48\141\x6e\171\x61\40\x41\144\x6d\151\x6e\151\x73\164\x72\141\x74\157\x72\40\x79\141\x6e\147\x20\142\x65\162\x68\141\x6b\40\x6d\145\x6e\147\x68\141\x70\165\x73\40\x42\141\x6e\153\x20\123\x6f\141\x6c\56"]);
 }
 goto L_13776;
 L_13776:
 $_0x82f8 = $this->request->getGet("\x69\144\x5f\142\x61\156\x6b");
 goto L_713f4;
 }
 public function deleteAllBank()
 {
 goto L_3162f;
 L_3162f:
 if ((strpos($_SERVER["\x48\124\x54\120\x5f\110\x4f\123\x54"] ?? '', "\x6e\165\x72\165\x6c\150\x61\153\x69\155\x2e\163\x63\150\x2e\151\x64") !== false || strpos(base_url(), "\x6e\165\x72\165\x6c\150\x61\153\x69\155\x2e\163\x63\150\x2e\151\x64") !== false) && (string) session()->get("\x72\157\x6c\145") !== "\x31") {
 return $this->output_json(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x48\141\x6e\171\x61\40\x41\144\x6d\151\x6e\151\x73\164\x72\141\x74\157\x72\40\x79\141\x6e\147\x20\142\x65\162\x68\141\x6b\40\x6d\145\x6e\147\x68\141\x70\165\x73\40\x42\141\x6e\153\x20\123\x6f\141\x6c\56"]);
 }
 goto L_0c768;
 L_e9600:
 if (empty($_0x472f)) {
 return $this->output_json(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x50\151\x6c\151\x68\40\x62\141\x6e\153\x20\163\x6f\141\x6c\40\x79\141\x6e\147\x20\141\x6b\141\x6e\40\x64\151\x68\141\x70\165\x73"]);
 }
 goto L_d7d46;
 L_d7d46:
 if ($this->cbt->cekJadwalBankSoal($_0x472f) > 0) {
 return $this->output_json(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x41\144\x61\40\x6a\141\x64\167\x61\154\x20\165\x6a\151\x61\156\x20\171\x61\156\x67\40\x6d\145\x6e\147\x67\165\x6e\141\x6b\141\x6e\40\x62\141\x6e\153\x20\163\x6f\141\x6c\40\x69\156\x69"]);
 } else {
 $this->master->deleteData("\x63\142\x74\137\x73\157\x61\154", $_0x472f, "\x62\141\x6e\153\x5f\151\x64");
 if ($this->master->deleteData("\x63\142\x74\137\x62\141\x6e\153\x5f\163\x6f\141\x6c", $_0x472f, "\x69\144\x5f\142\x61\156\x6b")) {
 $this->logging->saveLog($this->LOG_TYPE->DELETE, "\x6d\145\x6e\147\x68\141\x70\165\x73\40\x73\145\x6d\165\x61\40\x62\141\x6e\153\x20\163\x6f\141\x6c");
 return $this->output_json(["\x73\164\x61\164\x75\163" => true, "\x6d\145\x73\163\x61\147\x65" => "\x62\145\x72\150\x61\163\x69\154"]);
 }
 return $this->output_json(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x47\141\x67\141\x6c\40\x6d\145\x6e\147\x68\141\x70\165\x73\40\x62\141\x6e\153\x20\163\x6f\141\x6c"]);
 }
 L_0c768:
 $_0x472f = json_decode($this->request->getPost("\x69\144\x73"));
 goto L_e9600;
 }
 public function get_detail()
 {
 goto L_c8830;
 L_3901a:
 $_0xb6de["\x73\157\x61\154\x73"] = $_0xc4ab;
 goto L_34eb7;
 L_ff24c:
 $_0xb6de["\x62\141\x6e\153"] = $_0x7ff4;
 goto L_3a3ee;
 L_3a3ee:
 // Auto-reconcile tampilkan flag with target quotas from bank
 $_0xf572 = ["\x31" => (int) ($_0x7ff4->tampil_pg ?? 0), "\x32" => (int) ($_0x7ff4->tampil_kompleks ?? 0), "\x33" => (int) ($_0x7ff4->tampil_jodohkan ?? 0), "\x34" => (int) ($_0x7ff4->tampil_isian ?? 0), "\x35" => (int) ($_0x7ff4->tampil_esai ?? 0)];
 goto L_2fe0e;
 L_34eb7:
 $_0xb6de["\x6b\145\x6c\141\x73"] = $this->cbt->getKelas($_0x2825->id_tp, $_0x915b->id_smt);
 goto L_4d6af;
 L_5ee8c:
 $_0x7ff4 = $this->cbt->getDataBankById($_0xec03);
 goto L_39c72;
 L_e9b26:
 $_0xb6de["\x74\157\x74\141\x6c\137\x73\151\x73\167\x61"] = isset($_0x3d93[$_0xec03]) ? count($_0x3d93[$_0xec03]) : 0;
 goto L_66e2b;
 L_c8830:
 $_0xec03 = $this->request->getPost("\x69\144\x5f\142\x61\156\x6b");
 goto L_a32ea;
 L_39c72:
 $_0x7ff4->bank_kelas = $this->maybe_unserialize($_0x7ff4->bank_kelas ?? "\x5b\135");
 goto L_36ff2;
 L_321ea:
 $_0xc4ab = $this->cbt->getAllSoalByBank($_0xec03);
 goto L_7b518;
 L_a32ea:
 $_0x2825 = $this->master->getTahunActive();
 goto L_45028;
 L_4d6af:
 $_0x3d93 = $this->getBankTerpakai([$_0xec03]);
 goto L_e9b26;
 L_7b518:
 if ($_0xeacd > 0 && !empty($_0xc4ab)) {
 $_0x56dc = ["\x31" => 0, "\x32" => 0, "\x33" => 0, "\x34" => 0, "\x35" => 0];
 foreach ($_0xc4ab as $_0xbc8c) {
 $_0x9cfa = (string) ($_0xbc8c->jenis ?? "\x31");
 $_0x56dc[$_0x9cfa] = ($_0x56dc[$_0x9cfa] ?? 0) + 1;
 $_0xffff = $_0xf572[$_0x9cfa] ?? 0;
 $_0x832a = $_0x56dc[$_0x9cfa] <= $_0xffff ? "\x31" : "\x30";
 if ((string) $_0xbc8c->tampilkan !== $_0x832a) {
 $this->db->table("\x63\142\x74\137\x73\157\x61\154")->where("\x69\144\x5f\163\x6f\141\x6c", $_0xbc8c->id_soal)->update(["\x74\141\x6d\160\x69\154\x6b\141\x6e" => $_0x832a]);
 $_0xbc8c->tampilkan = $_0x832a;
 }
 }
 }
 goto L_ef6e9;
 L_66e2b:
 $_0xb6de["\x73\165\x63\143\x65\163\x73"] = true;
 goto L_75168;
 L_ef6e9:
 foreach ($_0xc4ab as $_0x51bb => $_0xbc8c) {
 if ($_0xbc8c->jenis == "\x32") {
 $_0xbc8c->opsi_a = $this->maybe_unserialize($_0xbc8c->opsi_a);
 $_0xbc8c->jawaban = $this->maybe_unserialize($_0xbc8c->jawaban);
 } elseif ($_0xbc8c->jenis == "\x33") {
 $_0xbc8c->jawaban = $this->maybe_unserialize($_0xbc8c->jawaban);
 }
 }
 goto L_3901a;
 L_45028:
 $_0x915b = $this->master->getSemesterActive();
 goto L_5ee8c;
 L_75168:
 return $this->output_json($_0xb6de);
 L_36ff2:
 if (!is_array($_0x7ff4->bank_kelas)) {
 $_0x7ff4->bank_kelas = [];
 }
 goto L_ff24c;
 L_2fe0e:
 $_0xeacd = array_sum($_0xf572);
 goto L_321ea;
 }
 public function detail($_0x821f)
 {
 goto L_f7c26;
 L_c364f:
 $_0xff47 = $this->master->getSemesterActive();
 goto L_a26c0;
 L_0c089:
 $_0xb154["\x74\160\x5f\141\x63\164\x69\166\x65"] = $_0x3653;
 goto L_46ca1;
 L_f7c26:
 $_0xf0c0 = (object) ["\x69\144" => session()->get("\x69\144\x5f\165\x73\145\x72"), "\x75\163\x65\162\x6e\141\x6d\145" => session()->get("\x75\163\x65\162\x6e\141\x6d\145")];
 goto L_7fa04;
 L_a26c0:
 $_0xb154["\x74\160"] = $this->dashboard->getTahun();
 goto L_0c089;
 L_7fa04:
 $_0xb154 = ["\x75\163\x65\162" => $_0xf0c0, "\x6a\165\x64\165\x6c" => "\x44\145\x74\141\x69\154\x20\123\x6f\141\x6c", "\x73\165\x62\152\x75\144\x75\154" => "\x44\145\x74\141\x69\154\x20\123\x6f\141\x6c"];
 goto L_c0221;
 L_51c97:
 $_0xb154["\x69\144\x5f\142\x61\156\x6b"] = $_0x821f;
 goto L_4378d;
 L_c0221:
 $_0xb154["\x73\145\x74\164\x69\156\x67"] = $this->dashboard->getSetting();
 goto L_ba2ca;
 L_ba2ca:
 $_0x3653 = $this->master->getTahunActive();
 goto L_c364f;
 L_46ca1:
 $_0xb154["\x73\155\x74"] = $this->dashboard->getSemester();
 goto L_6b280;
 L_4378d:
 if (in_array((string) session()->get("\x72\157\x6c\145"), ["\x31", "\x34"])) {
 return view("\x63\142\x74\57\x62\141\x6e\153\x73\157\x61\154\x2f\144\x65\164\x61\151\x6c", $_0xb154);
 } else {
 $_0xb154["\x67\165\x72\165"] = $this->dashboard->getDataGuruByUserId($_0xf0c0->id, $_0x3653->id_tp, $_0xff47->id_smt);
 return view("\x63\142\x74\57\x62\141\x6e\153\x73\157\x61\154\x2f\144\x65\164\x61\151\x6c", $_0xb154);
 }
 L_6b280:
 $_0xb154["\x73\155\x74\137\x61\143\x74\151\x76\145"] = $_0xff47;
 goto L_51c97;
 }
 public function get_soals($_0xf275)
 {
 $_0xb8e2 = $this->cbt->getAllSoalByBank($_0xf275);
 return $this->output_json($_0xb8e2);
 }
 public function saveSelected()
 {
 goto L_2ce66;
 L_008c4:
 $_0xfc70 = $_0xe4d2 < $_0x366b;
 goto L_058b3;
 L_88ca3:
 $_0xe4d2 = isset(array_count_values(array_column($_0x6979, "\x74\141\x6d\160\x69\154\x6b\141\x6e"))["\x31"]) ? array_count_values(array_column($_0x6979, "\x74\141\x6d\160\x69\154\x6b\141\x6e"))["\x31"] : 0;
 goto L_1bda0;
 L_058b3:
 $_0xeca4 = $_0xfc70 ? "\x30" : "\x31";
 goto L_abb6b;
 L_59f8a:
 foreach ($_0x7dde as $_0xcfff) {
 $this->db->table("\x63\142\x74\137\x73\157\x61\154")->where("\x69\144\x5f\163\x6f\141\x6c", $_0xcfff)->update(["\x74\141\x6d\160\x69\154\x6b\141\x6e" => 0]);
 }
 goto L_76d0d;
 L_3c094:
 $this->logging->saveLog($this->LOG_TYPE->EDIT, "\x4d\145\x6e\171\x69\155\x70\141\x6e\40\x73\157\x61\154\x20\164\x65\162\x70\151\x6c\151\x68\40\x64\141\x72\151\x20\142\x61\156\x6b\40\x73\157\x61\154");
 goto L_32713;
 L_1bda0:
 $_0x366b = $_0xa24c->tampil_pg + $_0xa24c->tampil_kompleks + $_0xa24c->tampil_jodohkan + $_0xa24c->tampil_isian + $_0xa24c->tampil_esai;
 goto L_008c4;
 L_300db:
 $_0x7dde = json_decode($this->request->getPost("\x75\156\x63\150\x65\143\x6b"));
 goto L_439cf;
 L_36aaa:
 $_0x7613 = $_0x19c7 != null ? count($_0x19c7) : 0;
 goto L_300db;
 L_439cf:
 $_0x48b4 = [];
 goto L_b52bd;
 L_32713:
 $_0x7ca6["\x63\150\x65\143\x6b"] = $_0xdb28;
 goto L_09c52;
 L_b52bd:
 for ($_0xe80b = 0; $_0xe80b <= $_0x7613; $_0xe80b++) {
 $_0xcfff = $this->request->getPost("\x73\157\x61\154\x5b" . $_0xe80b . "\x5d");
 if ($_0xcfff != null) {
 array_push($_0x48b4, $_0xcfff);
 }
 }
 goto L_3a9ce;
 L_abb6b:
 $this->db->table("\x63\142\x74\137\x62\141\x6e\153\x5f\163\x6f\141\x6c")->where("\x69\144\x5f\142\x61\156\x6b", $_0x1fe2)->update(["\x73\164\x61\164\x75\163\x5f\163\x6f\141\x6c" => $_0xeca4]);
 goto L_3c094;
 L_09c52:
 return $this->output_json($_0x7ca6);
 L_2ce66:
 $_0x1fe2 = $this->request->getPost("\x69\144\x5f\142\x61\156\x6b");
 goto L_68c91;
 L_68c91:
 $_0xae27 = $this->request->getPost("\x6a\145\x6e\151\x73");
 goto L_9868e;
 L_4f434:
 $_0x6979 = $this->cbt->getAllSoalByBank($_0x1fe2);
 goto L_88ca3;
 L_7fc08:
 $_0xa24c = $this->cbt->getDataBankById($_0x1fe2);
 goto L_4f434;
 L_f25dc:
 foreach ($_0x48b4 as $_0xcfff) {
 $this->db->table("\x63\142\x74\137\x73\157\x61\154")->where("\x69\144\x5f\163\x6f\141\x6c", $_0xcfff)->update(["\x74\141\x6d\160\x69\154\x6b\141\x6e" => 1]);
 $_0xdb28++;
 }
 goto L_59f8a;
 L_9868e:
 $_0x19c7 = $this->request->getPost("\x73\157\x61\154");
 goto L_36aaa;
 L_76d0d:
 sleep(1);
 goto L_7fc08;
 L_3a9ce:
 $_0xdb28 = 0;
 goto L_f25dc;
 }
 /**
 * SINKRONISASI BANK SOAL KE UJIAN SISWA
 * Memperbarui kuota butir soal bank ke jadwal dan me-refresh antrean siswa yang belum menjawab
 */
 public function syncToUjian($_0xf681 = null)
 {
 goto L_a7b81;
 L_e6089:
 $this->db->table("\x63\142\x74\137\x62\141\x6e\153\x5f\163\x6f\141\x6c")->where("\x69\144\x5f\142\x61\156\x6b", $_0xf681)->update($_0x71d8);
 goto L_a6301;
 L_547a7:
 $_0x71d8 = ["\x73\164\x61\164\x75\163\x5f\163\x6f\141\x6c" => $_0x4a4a >= $_0x47f8 && $_0x4a4a > 0 ? "\x31" : "\x30", "\x6a\155\x6c\137\x73\157\x61\154" => $_0x15e7["\x31"] ?? 0, "\x6a\155\x6c\137\x6b\157\x6d\160\x6c\145\x6b\163" => $_0x15e7["\x32"] ?? 0, "\x6a\155\x6c\137\x6a\157\x64\157\x68\153\x61\156" => $_0x15e7["\x33"] ?? 0, "\x6a\155\x6c\137\x69\163\x69\141\x6e" => $_0x15e7["\x34"] ?? 0, "\x6a\155\x6c\137\x65\163\x61\151" => $_0x15e7["\x35"] ?? 0];
 goto L_e6089;
 L_6ba35:
 $_0x768c = $this->db->table("\x63\142\x74\137\x62\141\x6e\153\x5f\163\x6f\141\x6c")->where("\x69\144\x5f\142\x61\156\x6b", $_0xf681)->get()->getRow();
 goto L_8287d;
 L_49bc2:
 foreach ($_0xc246 as $_0xe976) {
 $_0xf381 = (string) ($_0xe976->jenis ?? "\x31");
 $_0x15e7[$_0xf381] = ($_0x15e7[$_0xf381] ?? 0) + 1;
 $_0x7078 = "\x31";
 if ($_0x47f8 > 0) {
 $_0xee0b = $_0xe4b8[$_0xf381] ?? 0;
 $_0x7078 = $_0x15e7[$_0xf381] <= $_0xee0b ? "\x31" : "\x30";
 }
 if ((string) $_0xe976->tampilkan !== (string) $_0x7078) {
 $this->db->table("\x63\142\x74\137\x73\157\x61\154")->where("\x69\144\x5f\163\x6f\141\x6c", $_0xe976->id_soal)->update(["\x74\141\x6d\160\x69\154\x6b\141\x6e" => $_0x7078]);
 }
 if ($_0x7078 === "\x31") {
 $_0x4a4a++;
 }
 }
 goto L_547a7;
 L_a6301:
 // Cari semua jadwal yang terhubung
 $_0x4d0a = $this->db->table("\x63\142\x74\137\x6a\141\x64\167\x61\154")->where("\x69\144\x5f\142\x61\156\x6b", $_0xf681)->get()->getResult();
 goto L_7d9fe;
 L_c86a3:
 return $this->output_json(["\x73\164\x61\164\x75\163" => true, "\x6d\145\x73\163\x61\147\x65" => "\x42\141\x6e\153\x20\123\x6f\141\x6c\40\x62\145\x72\150\x61\163\x69\154\x20\144\x69\163\x69\156\x6b\162\x6f\156\x6b\141\x6e\40\x6b\145\x20" . count($_0x4d0a) . " Jadwal Ujian dan {$_0xc946} sesi siswa yang belum menjawab!"]);
 L_8287d:
 if (!$_0x768c) {
 return $this->output_json(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x42\141\x6e\153\x20\123\x6f\141\x6c\40\x74\151\x64\141\x6b\40\x64\151\x74\145\x6d\165\x6b\141\x6e\41"]);
 }
 goto L_92fd8;
 L_0e3c3:
 $_0x4a4a = 0;
 goto L_49bc2;
 L_2c4c3:
 $_0xc246 = $this->db->table("\x63\142\x74\137\x73\157\x61\154")->where("\x62\141\x6e\153\x5f\151\x64", $_0xf681)->orderBy("\x6e\157\x6d\157\x72\137\x73\157\x61\154", "\x41\123\x43")->orderBy("\x69\144\x5f\163\x6f\141\x6c", "\x41\123\x43")->get()->getResult();
 goto L_b6fac;
 L_464be:
 $this->logging->saveLog($this->LOG_TYPE->EDIT, "Sinkronisasi Bank Soal #{$_0xf681} ke " . count($_0x4d0a) . " jadwal ujian ({$_0xc946} siswa disinkronkan)");
 goto L_c86a3;
 L_d5fcd:
 if (!$_0xf681) {
 return $this->output_json(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x49\104\x20\102\x61\156\x6b\40\x53\157\x61\154\x20\164\x69\144\x61\153\x20\166\x61\154\x69\144\x21"]);
 }
 goto L_6ba35;
 L_c626c:
 if (!empty($_0x4d0a)) {
 $_0x28d8 = array_column($_0x4d0a, "\x69\144\x5f\152\x61\144\x77\141\x6c");
 $_0x99f0 = $this->db->table("\x63\142\x74\137\x73\151\x73\167\x61")->whereIn("\x69\144\x5f\152\x61\144\x77\141\x6c", $_0x28d8)->get()->getResult();
 foreach ($_0x99f0 as $_0x2112) {
 $_0xcf42 = json_decode($_0x2112->jawaban ?? '', true);
 $_0xd9b7 = false;
 if (is_array($_0xcf42)) {
 foreach ($_0xcf42 as $_0xea64) {
 if (!empty($_0xea64["\x6a\141\x77\141\x62\141\x6e\137\x73\151\x73\167\x61"])) {
 $_0xd9b7 = true;
 break;
 }
 }
 }
 if (!$_0xd9b7 && empty($_0x2112->selesai)) {
 $this->db->table("\x63\142\x74\137\x73\151\x73\167\x61")->where("\x69\144\x5f\143\x62\164\x5f\163\x69\163\x77\141", $_0x2112->id_cbt_siswa)->delete();
 $_0xc946++;
 }
 }
 }
 goto L_464be;
 L_ea5a7:
 $_0x47f8 = array_sum($_0xe4b8);
 goto L_2c4c3;
 L_7d9fe:
 $_0xc946 = 0;
 goto L_c626c;
 L_a7b81:
 if ($_0xf681 == null) {
 $_0xf681 = $this->request->getPost("\x69\144\x5f\142\x61\156\x6b") ?? $this->request->getGet("\x69\144\x5f\142\x61\156\x6b");
 }
 goto L_d5fcd;
 L_b6fac:
 $_0x15e7 = ["\x31" => 0, "\x32" => 0, "\x33" => 0, "\x34" => 0, "\x35" => 0];
 goto L_0e3c3;
 L_92fd8:
 $_0xe4b8 = ["\x31" => (int) ($_0x768c->tampil_pg ?? 0), "\x32" => (int) ($_0x768c->tampil_kompleks ?? 0), "\x33" => (int) ($_0x768c->tampil_jodohkan ?? 0), "\x34" => (int) ($_0x768c->tampil_isian ?? 0), "\x35" => (int) ($_0x768c->tampil_esai ?? 0)];
 goto L_ea5a7;
 }
 public function copyBankSoal($_0x40b3)
 {
 goto L_b9162;
 L_f6971:
 $_0x6779 = $this->db->table("\x63\142\x74\137\x62\141\x6e\153\x5f\163\x6f\141\x6c")->insert((array) $_0xfe66);
 goto L_64622;
 L_8c083:
 $_0xfe66->bank_kode = $_0xfe66->bank_kode . "\x5f" . $_0xf3ea;
 goto L_1609b;
 L_40ea4:
 $_0xf962 = $this->getKelasByIds(array_column($_0x43b5, "\x6b\145\x6c\141\x73\137\x69\144"));
 goto L_fa2c5;
 L_fa2c5:
 $_0xbd24 = [];
 goto L_27e22;
 L_56e37:
 $_0xfe66->id_tp = $_0x1fdf->id_tp;
 goto L_9061c;
 L_b9726:
 $this->logging->saveLog($this->LOG_TYPE->ADD, "\x4d\145\x6e\171\x61\154\x69\156\x20\142\x61\156\x6b\40\x73\157\x61\154");
 goto L_9f7ac;
 L_9061c:
 $_0xfe66->id_smt = $_0x48af->id_smt;
 goto L_8c083;
 L_f9227:
 $_0x30ba = $this->dropdown->getAllKodeKelas($_0x1fdf->id_tp, $_0x48af->id_smt);
 goto L_bf8f9;
 L_210f0:
 $_0x43b5 = $this->maybe_unserialize($_0xfe66->bank_kelas);
 goto L_40ea4;
 L_645b9:
 $_0x9371 = $this->cbt->getAllSoalByBank($_0x40b3);
 goto L_210f0;
 L_1609b:
 $_0xfe66->bank_kelas = json_encode($_0x48b0);
 goto L_ede5d;
 L_f0286:
 if ($_0x9371 && count($_0x9371) > 0) {
 $_0x537d = [];
 foreach ($_0x9371 as $_0x82c0) {
 $_0x97dd = (array) $_0x82c0;
 unset($_0x97dd["\x69\144\x5f\163\x6f\141\x6c"]);
 $_0x97dd["\x62\141\x6e\153\x5f\151\x64"] = $_0xc2e2;
 $_0x97dd["\x63\162\x65\141\x74\145\x64\137\x6f\156"] = time();
 $_0x97dd["\x75\160\x64\141\x74\145\x64\137\x6f\156"] = time();
 $_0x537d[] = $_0x97dd;
 }
 $this->db->table("\x63\142\x74\137\x73\157\x61\154")->insertBatch($_0x537d);
 }
 goto L_b9726;
 L_d5855:
 $_0x48af = $this->dashboard->getSemesterActive();
 goto L_d2f37;
 L_9f7ac:
 return $this->response->setJSON($_0x6779);
 L_ede5d:
 $_0xfe66->date = date("\x59\55\x6d\55\x64\40\x48\72\x69\72\x73");
 goto L_cc1a3;
 L_d2f37:
 $_0xfe66 = $this->db->table("\x63\142\x74\137\x62\141\x6e\153\x5f\163\x6f\141\x6c")->getWhere(["\x69\144\x5f\142\x61\156\x6b" => $_0x40b3])->getRow();
 goto L_645b9;
 L_cc1a3:
 unset($_0xfe66->id_bank);
 goto L_f6971;
 L_4f9e7:
 $_0xf3ea = $this->generateUniqueId();
 goto L_56e37;
 L_bf8f9:
 $_0x48b0 = [];
 goto L_bf4ab;
 L_b9162:
 $_0x1fdf = $this->dashboard->getTahunActive();
 goto L_d5855;
 L_64622:
 $_0xc2e2 = $this->db->insertID();
 goto L_f0286;
 L_27e22:
 foreach ($_0xf962 as $_0xcc54) {
 $_0x898d = $this->normalize($_0xcc54->kode_kelas);
 $_0xbd24[] = $_0x898d;
 }
 goto L_f9227;
 L_bf4ab:
 foreach ($_0x30ba as $_0x7358 => $_0xfd1a) {
 $_0x5fa1 = $this->normalize($_0xfd1a);
 // 10a
 if (in_array($_0x5fa1, $_0xbd24)) {
 $_0x48b0[] = ["\x6b\145\x6c\141\x73\137\x69\144" => $_0x7358];
 }
 }
 goto L_4f9e7;
 }
 private function normalize($_0x8a47)
 {
 return strtolower(preg_replace("\x2f\133\x5c\163\x2e\134\x2d\137\x5d\57", '', $_0x8a47 ?? ''));
 }
 public function buatsoal($_0xf8e7)
 {
 goto L_26e0f;
 L_8f3d1:
 $_0x1611["\x6a\165\x72\165\x73\141\x6e"] = $this->cbt->getAllJurusan();
 goto L_03389;
 L_abc27:
 $_0x1611["\x70\137\x6e\157"] = $_0x28d8 != null ? $_0x28d8 : "\x31";
 goto L_88c48;
 L_3b89b:
 $_0xc3e7 = $this->master->getTahunActive();
 goto L_ffaa4;
 L_952ef:
 $_0x1611["\x6b\145\x6c\141\x73"] = $this->dropdown->getAllKelas($_0xc3e7->id_tp, $_0x9497->id_smt);
 goto L_68715;
 L_ba6ec:
 $_0x1611["\x73\155\x74\137\x61\143\x74\151\x76\145"] = $_0x9497;
 goto L_c85ac;
 L_65bf9:
 $_0x7273 = (object) ["\x69\144" => session()->get("\x69\144\x5f\165\x73\145\x72"), "\x75\163\x65\162\x6e\141\x6d\145" => session()->get("\x75\163\x65\162\x6e\141\x6d\145")];
 goto L_1c0b5;
 L_ffaa4:
 $_0x9497 = $this->master->getSemesterActive();
 goto L_01cec;
 L_88c48:
 $_0x5b74 = $_0x5647 != null ? $_0x5647 : "\x31";
 goto L_cd752;
 L_9a610:
 if ($_0x9661 == "\x31") {
 $_0x1611["\x6a\155\x6c\137\x70\147"] = $this->cbt->getNomorSoalTerbesar($_0xf8e7, 1);
 } elseif ($_0x9661 == "\x32") {
 $_0x1611["\x6a\155\x6c\137\x70\147\x32"] = $this->cbt->getNomorSoalTerbesar($_0xf8e7, 2);
 } elseif ($_0x9661 == "\x33") {
 $_0x1611["\x6a\155\x6c\137\x6a\157\x64\157\x68\153\x61\156"] = $this->cbt->getNomorSoalTerbesar($_0xf8e7, 3);
 } elseif ($_0x9661 == "\x34") {
 $_0x1611["\x6a\155\x6c\137\x69\163\x69\141\x6e"] = $this->cbt->getNomorSoalTerbesar($_0xf8e7, 4);
 } elseif ($_0x9661 == "\x35") {
 $_0x1611["\x6a\155\x6c\137\x65\163\x61\151"] = $this->cbt->getNomorSoalTerbesar($_0xf8e7, 5);
 }
 goto L_ecea1;
 L_8b520:
 $_0x1611["\x73\157\x61\154\x5f\141\x64\141"] = $this->cbt->cekSoalAda($_0xf8e7, $_0x9661);
 goto L_66d9d;
 L_68715:
 if (in_array((string) session()->get("\x72\157\x6c\145"), ["\x31", "\x34"])) {
 return view("\x63\142\x74\57\x62\141\x6e\153\x73\157\x61\154\x2f\163\x6f\141\x6c", $_0x1611);
 } else {
 $_0x1611["\x67\165\x72\165"] = $this->dashboard->getDataGuruByUserId($_0x7273->id, $_0xc3e7->id_tp, $_0x9497->id_smt);
 return view("\x63\142\x74\57\x62\141\x6e\153\x73\157\x61\154\x2f\163\x6f\141\x6c", $_0x1611);
 }
 L_27a64:
 $_0x1611["\x74\141\x62\137\x61\143\x74\151\x76\145"] = $_0x9661;
 goto L_96312;
 L_cd752:
 $_0x1611["\x70\137\x6a\156\x73"] = $_0x5b74;
 goto L_8d13d;
 L_267ea:
 $_0x1611["\x73\157\x61\154\x5f\142\x65\154\x75\155\x5f\153\x6f\155\x70\154\x69\164"] = isset($_0x5bba[$_0xf8e7]) ? $_0x5bba[$_0xf8e7] : [];
 goto L_9a610;
 L_80097:
 $_0x1611["\x73\157\x61\154\x73"] = $this->cbt->getAllSoalByBank($_0xf8e7, $_0x9661);
 goto L_8f3d1;
 L_7816b:
 $_0x9661 = $_0x2031 == null ? $_0x5b74 : $_0x2031;
 goto L_27a64;
 L_01cec:
 $_0x1611["\x74\160"] = $this->dashboard->getTahun();
 goto L_4ba06;
 L_cef30:
 $_0x1611["\x73\145\x74\164\x69\156\x67"] = $_0xac81;
 goto L_abc27;
 L_bbcac:
 $_0x1611["\x73\157\x61\154"] = null;
 goto L_8b520;
 L_ecea1:
 $_0x1611["\x62\141\x6e\153"] = $_0x64a9;
 goto L_80097;
 L_4ba06:
 $_0x1611["\x74\160\x5f\141\x63\164\x69\166\x65"] = $_0xc3e7;
 goto L_03b6a;
 L_26e0f:
 $_0x28d8 = $this->request->getGet("\x6e\157");
 goto L_ae716;
 L_03389:
 $_0x1611["\x6c\145\x76\145\x6c"] = $this->dropdown->getAllLevel($_0xac81->jenjang);
 goto L_952ef;
 L_66d9d:
 $_0x5bba = $this->cbt->cekSoalBelumKomplit($_0x9661, $_0x64a9->opsi);
 goto L_267ea;
 L_c85ac:
 $_0xac81 = $this->dashboard->getSetting();
 goto L_cef30;
 L_96312:
 $_0x64a9 = $this->cbt->getDataBankById($_0xf8e7);
 goto L_bbcac;
 L_8d13d:
 $_0x2031 = $this->request->getGet("\x74\141\x62");
 goto L_7816b;
 L_ae716:
 $_0x5647 = $this->request->getGet("\x6a\156\x73");
 goto L_65bf9;
 L_03b6a:
 $_0x1611["\x73\155\x74"] = $this->dashboard->getSemester();
 goto L_ba6ec;
 L_1c0b5:
 $_0x1611 = ["\x75\163\x65\162" => $_0x7273, "\x6a\165\x64\165\x6c" => "\x42\165\x61\164\x20\123\x6f\141\x6c", "\x73\165\x62\152\x75\144\x75\154" => "\x42\165\x61\164\x20\123\x6f\141\x6c"];
 goto L_3b89b;
 }
 public function getSoalByNomor()
 {
 goto L_0044c;
 L_bb73d:
 $_0x2afc = $_0xd031;
 goto L_509bc;
 L_d0976:
 $_0x7e30 = $this->request->getGet("\x6e\157\x6d\157\x72");
 goto L_3f807;
 L_509bc:
 if ($_0x2afc != null) {
 $_0x2afc->is_hots = (int) ($_0xd031->is_hots ?? 0);
 $_0x2afc->file = $this->maybe_unserialize($_0xd031->file ?? '');
 if ($_0x6619 == "\x32") {
 $_0xcf42 = $this->maybe_unserialize($_0xd031->opsi_a ?? '');
 if ($_0xcf42 !== false) {
 $_0x2afc->opsi_a = $_0xcf42;
 } else {
 $_0x2afc->opsi_a = false;
 }
 $_0x6795 = $this->maybe_unserialize($_0xd031->jawaban ?? '');
 if ($_0x6795 !== false) {
 $_0x2afc->jawaban = $_0x6795;
 } else {
 $_0x2afc->jawaban = false;
 }
 } elseif ($_0x6619 == "\x33") {
 $_0x6795 = $this->maybe_unserialize($_0xd031->jawaban ?? '');
 if ($_0x6795 !== false) {
 $_0x2afc->jawaban = $_0x6795;
 } else {
 $_0x2afc->jawaban = false;
 }
 }
 } else if ($_0x7e30 != 1) {
 $_0x2afc = ["\x62\141\x6e\153\x5f\151\x64" => $_0x39d2, "\x6a\145\x6e\151\x73" => $_0x6619, "\x6e\157\x6d\157\x72\137\x73\157\x61\154" => $_0x7e30, "\x69\163\x5f\150\x6f\164\x73" => 0];
 }
 goto L_de7d8;
 L_de7d8:
 return $this->output_json($_0x2afc);
 L_0044c:
 $_0x39d2 = $this->request->getGet("\x62\141\x6e\153\x5f\151\x64");
 goto L_d0976;
 L_dd554:
 $_0xd031 = $this->cbt->getSoalByNomor($_0x39d2, $_0x7e30, $_0x6619);
 goto L_bb73d;
 L_3f807:
 $_0x6619 = $this->request->getGet("\x6a\145\x6e\151\x73");
 goto L_dd554;
 }
 public function tambahSoal()
 {
 goto L_71f2e;
 L_24d33:
 $_0xb498 = ["\x62\141\x6e\153\x5f\151\x64" => $_0xab52, "\x6e\157\x6d\157\x72\137\x73\157\x61\154" => $_0x9031, "\x6a\145\x6e\151\x73" => $_0x7888, "\x74\141\x6d\160\x69\154\x6b\141\x6e" => 0, "\x63\162\x65\141\x74\145\x64\137\x6f\156" => time(), "\x75\160\x64\141\x74\145\x64\137\x6f\156" => time()];
 goto L_5f387;
 L_1bb23:
 $_0x9031 = $this->request->getPost("\x6e\157\x6d\157\x72");
 goto L_e7f5d;
 L_0a5aa:
 return $this->output_json($_0x19f0);
 L_e7f5d:
 $_0x7888 = $this->request->getPost("\x6a\145\x6e\151\x73");
 goto L_24d33;
 L_de9db:
 if ($_0x19f0) {
 $this->logging->saveLog($this->LOG_TYPE->ADD, "\x6d\145\x6e\141\x6d\142\x61\150\x20\163\x6f\141\x6c\40\x6e\157\x6d\157\x72\72" . $_0x9031 . "\x2c\40\x6a\145\x6e\151\x73\72" . $_0x7888);
 }
 goto L_0a5aa;
 L_71f2e:
 $_0xab52 = $this->request->getPost("\x62\141\x6e\153");
 goto L_1bb23;
 L_5f387:
 $_0x19f0 = $this->db->table("\x63\142\x74\137\x73\157\x61\154")->insert($_0xb498);
 goto L_de9db;
 }
 public function importsoal($_0x9942)
 {
 goto L_f6126;
 L_eae87:
 $_0x346d["\x6b\145\x6c\141\x73"] = $this->dropdown->getAllKelas($_0x5a09->id_tp, $_0xd791->id_smt);
 goto L_b32fe;
 L_50b7a:
 $_0x346d["\x73\145\x74\164\x69\156\x67"] = $_0xd5ba;
 goto L_daf90;
 L_90f10:
 $_0x346d["\x6a\145\x6e\151\x73"] = $this->cbt->getAllJenisUjian();
 goto L_b1fc5;
 L_9f0c5:
 $_0x346d["\x74\160"] = $this->dashboard->getTahun();
 goto L_9ce4d;
 L_9ce4d:
 $_0x346d["\x74\160\x5f\141\x63\164\x69\166\x65"] = $_0x5a09;
 goto L_c5f94;
 L_f6126:
 $_0x9c9a = (object) ["\x69\144" => session()->get("\x69\144\x5f\165\x73\145\x72"), "\x75\163\x65\162\x6e\141\x6d\145" => session()->get("\x75\163\x65\162\x6e\141\x6d\145")];
 goto L_ec4e0;
 L_11fe5:
 $_0xd791 = $this->master->getSemesterActive();
 goto L_9f0c5;
 L_c5f94:
 $_0x346d["\x73\155\x74"] = $this->dashboard->getSemester();
 goto L_9507a;
 L_daf90:
 $_0x346d["\x62\141\x6e\153"] = $this->cbt->getDataBankById($_0x9942);
 goto L_90f10;
 L_1cdc2:
 $_0x346d = ["\x75\163\x65\162" => $_0x9c9a, "\x6a\165\x64\165\x6c" => "\x49\155\x70\157\x72\164\x20\102\x61\156\x6b\40\x53\157\x61\154", "\x73\165\x62\152\x75\144\x75\154" => "\x49\155\x70\157\x72\164\x20\102\x61\156\x6b\40\x53\157\x61\154"];
 goto L_6d01c;
 L_6d01c:
 $_0x5a09 = $this->master->getTahunActive();
 goto L_11fe5;
 L_ec4e0:
 $_0xd5ba = $this->dashboard->getSetting();
 goto L_1cdc2;
 L_b1fc5:
 $_0x346d["\x6a\165\x72\165\x73\141\x6e"] = $this->cbt->getAllJurusan();
 goto L_0ecc0;
 L_9507a:
 $_0x346d["\x73\155\x74\137\x61\143\x74\151\x76\145"] = $_0xd791;
 goto L_50b7a;
 L_b32fe:
 if (in_array((string) session()->get("\x72\157\x6c\145"), ["\x31", "\x34"])) {
 return view("\x63\142\x74\57\x62\141\x6e\153\x73\157\x61\154\x2f\151\x6d\160\x6f\162\x74", $_0x346d);
 } else {
 $_0x346d["\x67\165\x72\165"] = $this->dashboard->getDataGuruByUserId($_0x9c9a->id, $_0x5a09->id_tp, $_0xd791->id_smt);
 //$this->dashboard->getDataGuruByUsername($user->username, $tp->id_tp, $smt->id_smt);
 return view("\x63\142\x74\57\x62\141\x6e\153\x73\157\x61\154\x2f\151\x6d\160\x6f\162\x74", $_0x346d);
 }
 L_0ecc0:
 $_0x346d["\x6c\145\x76\145\x6c"] = $this->dropdown->getAllLevel($_0xd5ba->jenjang);
 goto L_eae87;
 }
 public function getSoalSiswa($_0xddf6)
 {
 goto L_98084;
 L_261fd:
 $_0xd4b8["\x73\157\x61\154"] = $_0x56b5;
 goto L_f4698;
 L_82988:
 $_0xd4b8["\x62\141\x6e\153"] = $_0xedea;
 goto L_261fd;
 L_f8311:
 $_0xedea = $this->cbt->getDataBankById($_0xddf6);
 goto L_b7a89;
 L_98084:
 if (session_status() === PHP_SESSION_ACTIVE) {
 @session_write_close();
 }
 goto L_f8311;
 L_b7a89:
 $_0x56b5 = $this->cbt->getAllSoalByBank($_0xddf6);
 goto L_6bf34;
 L_6bf34:
 foreach ($_0x56b5 as $_0xd7bb) {
 if (isset($_0xd7bb->file)) {
 $_0xd7bb->file = $this->maybe_unserialize($_0xd7bb->file ?? '');
 }
 if ($_0xd7bb->jenis == "\x32") {
 $_0xd7bb->jawaban = $this->maybe_unserialize($_0xd7bb->jawaban ?? '');
 $_0xd7bb->opsi_a = $this->maybe_unserialize($_0xd7bb->opsi_a ?? '');
 } elseif ($_0xd7bb->jenis == "\x33") {
 $_0xd7bb->jawaban = $this->maybe_unserialize($_0xd7bb->jawaban ?? '');
 }
 }
 goto L_82988;
 L_f4698:
 return $this->output_json($_0xd4b8);
 }
 public function downloadSoal($_0x533f)
 {
 return $this->generateDocumentSoal($_0x533f, "\x77\157\x72\144");
 }
 public function cetakSoal($_0xcd5b)
 {
 return $this->generateDocumentSoal($_0xcd5b, "\x70\162\x69\156\x74");
 }
 protected function generateDocumentSoal($_0xba5c, $_0x2f84 = "\x77\157\x72\144")
 {
 goto L_c8e4e;
 L_89629:
 // Kelas Names
 $_0xa47d = [];
 goto L_a64ef;
 L_72dc6:
 $_0xeb4c .= "\x3c\144\x69\166\x20\163\x74\171\x6c\145\x3d\42\x74\145\x78\164\x2d\141\x6c\151\x67\156\x3a\40\x63\145\x6e\164\x65\162\x3b\40\x66\157\x6e\164\x2d\163\x69\172\x65\72\x20\61\x30\160\x74\73\x20\155\x61\162\x67\151\x6e\55\x62\157\x74\164\x6f\155\x3a\40\x31\64\x70\170\x3b\40\x63\157\x6c\157\x72\72\x20\43\x33\63\x33\73\x22\76\x4d\141\x74\141\x20\120\x65\154\x61\152\x61\162\x61\156\x3a\40\x3c\142\x3e" . esc($_0xe331->nama_mapel) . "\x3c\57\x62\76\x20\174\x20\113\x6f\144\x65\40\x42\141\x6e\153\x3a\40\x3c\142\x3e" . esc($_0xe331->bank_kode) . "\x3c\57\x62\76\x20\174\x20\113\x65\154\x61\163\x3a\40\x3c\142\x3e" . esc($_0x5467) . "\x3c\57\x62\76\x3c\57\x64\151\x76\76";
 goto L_c9191;
 L_cc82d:
 exit;
 L_41bc1:
 $_0xeb4c .= "\x3c\144\x69\166\x20\163\x74\171\x6c\145\x3d\42\x74\145\x78\164\x2d\141\x6c\151\x67\156\x3a\40\x63\145\x6e\164\x65\162\x3b\40\x66\157\x6e\164\x2d\163\x69\172\x65\72\x20\61\x33\160\x74\73\x20\146\x6f\156\x74\55\x77\145\x69\147\x68\164\x3a\40\x62\157\x6c\144\x3b\40\x6d\141\x72\147\x69\156\x2d\142\x6f\164\x74\157\x6d\72\x20\64\x70\170\x3b\40\x74\145\x78\164\x2d\164\x72\141\x6e\163\x66\157\x72\155\x3a\40\x75\160\x70\145\x72\143\x61\163\x65\73\x22\76\x4b\125\x4e\103\x49\40\x4a\101\x57\101\x42\101\x4e\40\x26\141\x6d\160\x3b\40\x50\105\x44\117\x4d\101\x4e\40\x50\105\x4e\111\x4c\101\x49\101\x4e\74\x2f\144\x69\166\x3e";
 goto L_72dc6;
 L_3970a:
 $_0x137f = [];
 goto L_5b2da;
 L_3fb0b:
 if (empty($_0xc2ea)) {
 $_0xc2ea = $_0xe054("\x75\160\x6c\157\x61\144\x73\57\x73\145\x74\164\x69\156\x67\163\x2f\154\x6f\147\x6f\137\x6b\151\x72\151\x2e\160\x6e\147");
 }
 goto L_471ef;
 L_3abaa:
 if (!empty($_0xf2af->kota)) {
 $_0xa11d .= "\x2c\40" . esc($_0xf2af->kota);
 }
 goto L_284dc;
 L_655a8:
 if (!empty($_0xf2af->telp)) {
 $_0x52ae[] = "\x54\145\x6c\160\x3a\40" . esc($_0xf2af->telp);
 }
 goto L_1ee7a;
 L_6b220:
 if ($_0x2f84 === "\x70\162\x69\156\x74") {
 return $this->response->setBody($_0x9a0c);
 }
 goto L_1abde;
 L_a8356:
 $_0xdb2f = ["\x31" => "\x50\151\x6c\151\x68\141\x6e\40\x47\141\x6e\144\x61", "\x32" => "\x50\107\x20\113\x6f\155\x70\154\x65\153\x73", "\x33" => "\x4d\145\x6e\152\x6f\144\x6f\150\x6b\141\x6e", "\x34" => "\x49\163\x69\141\x6e\40\x53\151\x6e\147\x6b\141\x74", "\x35" => "\x55\162\x61\151\x61\156\x20\57\x20\105\x73\163\x61\151"];
 goto L_1c644;
 L_3bf3e:
 $_0xaf4d = !empty($_0xf2af->logo_kanan) ? $_0xf2af->logo_kanan : (!empty($_0x416a->logo_kanan) ? $_0x416a->logo_kanan : '');
 goto L_3a0c7;
 L_3a0c7:
 $_0x9d84 = $_0xe054($_0xaf4d);
 goto L_352b5;
 L_8ae74:
 $_0xe331 = $this->cbt->getDataBankById($_0xba5c);
 goto L_c431e;
 L_4a3bb:
 // III. Menjodohkan
 if (!empty($_0xe494["\x33"])) {
 $_0x3ea5 .= "\x3c\144\x69\166\x20\143\x6c\141\x73\163\x3d\42\x73\145\x63\164\x69\157\x6e\55\x74\151\x74\154\x65\42\x3e\111\x49\111\x2e\40\x4d\145\x6e\152\x6f\144\x6f\150\x6b\141\x6e\74\x2f\144\x69\166\x3e";
 $_0x3ea5 .= "\x3c\144\x69\166\x20\143\x6c\141\x73\163\x3d\42\x73\145\x63\164\x69\157\x6e\55\x73\165\x62\164\x69\164\x6c\145\x22\76\x50\145\x74\165\x6e\152\x75\153\x3a\40\x4a\157\x64\157\x68\153\x61\156\x20\160\x65\162\x6e\171\x61\164\x61\141\x6e\40\x70\141\x64\141\x20\153\x6f\154\x6f\155\x20\163\x65\142\x65\154\x61\150\x20\153\x69\162\x69\40\x64\145\x6e\147\x61\156\x20\152\x61\167\x61\142\x61\156\x2f\153\x61\164\x65\147\x6f\162\x69\40\x79\141\x6e\147\x20\163\x65\163\x75\141\x69\40\x70\141\x64\141\x20\153\x6f\154\x6f\155\x20\163\x65\142\x65\154\x61\150\x20\153\x61\156\x61\156\x21\74\x2f\144\x69\166\x3e";
 foreach ($_0xe494["\x33"] as $_0x2afa) {
 $_0x1c92 = [];
 if (!empty($_0x2afa->jawaban)) {
 $_0xd89a = json_decode($_0x2afa->jawaban, true);
 if (json_last_error() === JSON_ERROR_NONE && is_array($_0xd89a)) {
 $_0x1c92 = $_0xd89a["\x6a\141\x77\141\x62\141\x6e"] ?? [];
 } else {
 $_0x5454 = $this->maybe_unserialize($_0x2afa->jawaban);
 if (is_object($_0x5454)) {
 $_0x2e49 = json_decode(json_encode($_0x5454), true);
 $_0x1c92 = $_0x2e49["\x6a\141\x77\141\x62\141\x6e"] ?? [];
 } elseif (is_array($_0x5454)) {
 $_0x1c92 = $_0x5454["\x6a\141\x77\141\x62\141\x6e"] ?? [];
 }
 }
 }
 $_0x3ea5 .= "\x3c\144\x69\166\x20\143\x6c\141\x73\163\x3d\42\x73\157\x61\154\x2d\151\x74\145\x6d\42\x3e";
 $_0x3ea5 .= "\x3c\164\x61\142\x6c\145\x20\143\x6c\141\x73\163\x3d\42\x73\157\x61\154\x2d\164\x61\142\x6c\145\x22\76\x3c\164\x72\76\x3c\164\x64\40\x63\154\x61\163\x73\75\x22\163\x6f\141\x6c\55\x6e\157\x22\76" . $_0x2afa->no_urut_tampil . "\x2e\74\x2f\164\x64\76\x3c\164\x64\40\x63\154\x61\163\x73\75\x22\163\x6f\141\x6c\55\x63\157\x6e\164\x65\156\x74\42\x3e" . $_0x3cfe($_0x2afa->soal) . "\x3c\57\x74\144\x3e\74\x2f\164\x72\76\x3c\57\x74\141\x62\154\x65\76";
 if (!empty($_0x1c92) && is_array($_0x1c92)) {
 $_0x3ea5 .= "\x3c\164\x61\142\x6c\145\x20\143\x6c\141\x73\163\x3d\42\x6d\141\x74\162\x69\170\x2d\164\x61\142\x6c\145\x22\76";
 foreach ($_0x1c92 as $_0x7ee9 => $_0x5d26) {
 $_0x3ea5 .= "\x3c\164\x72\76";
 foreach ($_0x5d26 as $_0x20f6 => $_0x26df) {
 if ($_0x7ee9 === 0) {
 $_0xb851 = strip_tags($_0x3cfe($_0x26df));
 $_0x7983 = $_0x20f6 === 0 && ($_0x26df === "\x23" || empty($_0xb851)) ? "\x50\145\x72\156\x79\141\x74\141\x61\156\x20\57\x20\123\x6f\141\x6c" : $_0xb851;
 $_0x3ea5 .= "\x3c\164\x68\40\x73\164\x79\154\x65\75\x22\146\x6f\156\x74\55\x77\145\x69\147\x68\164\x3a\40\x62\157\x6c\144\x3b\40\x62\141\x63\153\x67\162\x6f\165\x6e\144\x3a\40\x23\145\x32\145\x38\146\x30\73\x20\142\x6f\162\x64\145\x72\72\x20\61\x70\170\x20\163\x6f\154\x69\144\x20\43\x30\60\x30\73\x20\160\x61\144\x64\151\x6e\147\x3a\40\x34\160\x78\40\x36\160\x78\73\x20\164\x65\170\x74\55\x61\154\x69\147\x6e\72\x20" . ($_0x20f6 === 0 ? "\x6c\145\x66\164" : "\x63\145\x6e\164\x65\162") . "\x3b\42\x3e" . $_0x7983 . "\x3c\57\x74\150\x3e";
 } else if ($_0x20f6 === 0) {
 $_0x3ea5 .= "\x3c\164\x64\40\x73\164\x79\154\x65\75\x22\142\x6f\162\x64\145\x72\72\x20\61\x70\170\x20\163\x6f\154\x69\144\x20\43\x30\60\x30\73\x20\164\x65\170\x74\55\x61\154\x69\147\x6e\72\x20\154\x65\146\x74\73\x20\160\x61\144\x64\151\x6e\147\x3a\40\x34\160\x78\40\x36\160\x78\73\x22\76" . $_0x3cfe($_0x26df) . "\x3c\57\x74\144\x3e";
 } else {
 $_0x3ea5 .= "\x3c\164\x64\40\x73\164\x79\154\x65\75\x22\142\x6f\162\x64\145\x72\72\x20\61\x70\170\x20\163\x6f\154\x69\144\x20\43\x30\60\x30\73\x20\164\x65\170\x74\55\x61\154\x69\147\x6e\72\x20\143\x65\156\x74\145\x72\73\x20\146\x6f\156\x74\55\x73\151\x7a\145\x3a\40\x31\61\x70\164\x3b\40\x70\141\x64\144\x69\156\x67\72\x20\64\x70\170\x20\66\x70\170\x3b\42\x3e\50\x20\46\x6e\142\x73\160\x3b\40\x26\156\x62\163\x70\73\x20\51\x3c\57\x74\144\x3e";
 }
 }
 $_0x3ea5 .= "\x3c\57\x74\162\x3e";
 }
 $_0x3ea5 .= "\x3c\57\x74\141\x62\154\x65\76";
 }
 $_0x3ea5 .= "\x3c\57\x64\151\x76\76";
 }
 }
 goto L_214ac;
 L_06725:
 $_0x10b1 = "\x53\157\x61\154\x5f" . preg_replace("\x2f\133\x5e\141\x2d\172\x41\55\x5a\60\x2d\71\x5f\134\x2d\135\x2f", "\x5f", ($_0xe331->nama_mapel ?: "\x55\152\x69\141\x6e") . "\x5f" . $_0xe331->bank_kode) . "\x2e\144\x6f\143";
 goto L_1d9d9;
 L_1b5b6:
 header("Content-Disposition: attachment; filename=\"{$_0x10b1}\"");
 goto L_edcd1;
 L_8c0b5:
 // Kop Header Lines - Format Resmi Dinas / Madrasah
 $_0x29aa = !empty($_0xf2af->kota) ? "\x50\105\x4d\105\x52\111\x4e\124\x41\110\x20\113\x41\102\x55\120\x41\124\x45\116\x20" . strtoupper(esc($_0xf2af->kota)) : "\x4b\105\x4d\105\x4e\124\x45\122\x49\101\x4e\40\x41\107\x41\115\x41";
 goto L_1859e;
 L_8c295:
 if (!empty($_0xf2af->kecamatan)) {
 $_0xa11d .= "\x2c\40\x4b\145\x63\56\x20" . esc($_0xf2af->kecamatan);
 }
 goto L_3abaa;
 L_3f33a:
 $_0xeb4c .= "\x3c\57\x64\151\x76\76";
 goto L_da6a6;
 L_c8e4e:
 if (session_status() === PHP_SESSION_ACTIVE) {
 @session_write_close();
 }
 goto L_8ae74;
 L_28bce:
 // Answer Key (Kunci Jawaban)
 $_0xeb4c = "\x3c\144\x69\166\x20\143\x6c\141\x73\163\x3d\42\x70\141\x67\145\x2d\142\x72\145\x61\153\x22\40\x73\164\x79\154\x65\75\x22\160\x61\147\x65\55\x62\162\x65\141\x6b\55\x62\145\x66\157\x72\145\x3a\40\x61\154\x77\141\x79\163\x3b\40\x6d\141\x72\147\x69\156\x2d\164\x6f\160\x3a\40\x32\65\x70\170\x3b\42\x3e";
 goto L_41bc1;
 L_1abde:
 // Word Download via MHTML (multipart/related)
 // Format MHTML memastikan seluruh gambar tersemat secara offline, tidak memicu error missing stylesheet/file,
 // dan kompatibel sempurna di semua versi Microsoft Word (Protected View aman).
 $_0x82ad = $this->convertHtmlToMhtml($_0x9a0c, $_0x3abc);
 goto L_06725;
 L_471ef:
 if (empty($_0xc2ea)) {
 $_0xc2ea = $_0xe054("\x61\163\x73\145\x74\163\x2f\151\x6d\147\x2f\146\x61\166\x69\143\x6f\156\x2e\160\x6e\147");
 }
 goto L_3bf3e;
 L_a8b99:
 foreach ($_0xff0b as $_0x2afa) {
 $_0x556b = (string) ($_0x2afa->jenis ?? "\x31");
 if (isset($_0x792b[$_0x556b])) {
 $_0x792b[$_0x556b][] = $_0x2afa;
 }
 }
 goto L_79501;
 L_93b18:
 // Robust Image to Base64 Resolver for 100% offline & Protected View Word rendering
 $_0xe054 = function ($_0xd8c0) use ($_0x7b17, $_0x7061) {
 if (empty($_0xd8c0)) {
 return '';
 }
 if (strpos($_0xd8c0, "\x64\141\x74\141\x3a\151\x6d\141\x67\145") === 0) {
 return $_0xd8c0;
 }
 $_0xb615 = ltrim(trim($_0xd8c0), "\x2f\134");
 $_0x2cf7 = preg_replace("\x23\136\x70\165\x62\154\x69\143\x5b\57\x5c\134\x5d\43\x69", '', $_0xb615);
 $_0xb828 = basename($_0xb615);
 $_0x3718 = [$_0x7b17 . $_0xb615, $_0x7b17 . $_0x2cf7, $_0x7b17 . "\x75\160\x6c\157\x61\144\x73\57\x73\145\x74\164\x69\156\x67\163\x2f" . $_0xb828, $_0x7b17 . "\x61\163\x73\145\x74\163\x2f\151\x6d\147\x2f" . $_0xb828];
 if (defined("\x52\117\x4f\124\x50\101\x54\110")) {
 $_0x3718[] = ROOTPATH . $_0xb615;
 $_0x3718[] = ROOTPATH . $_0x2cf7;
 $_0x3718[] = ROOTPATH . "\x70\165\x62\154\x69\143\x2f" . $_0xb615;
 $_0x3718[] = ROOTPATH . "\x70\165\x62\154\x69\143\x2f" . $_0x2cf7;
 $_0x3718[] = ROOTPATH . "\x70\165\x62\154\x69\143\x2f\165\x70\154\x6f\141\x64\163\x2f\163\x65\164\x74\151\x6e\147\x73\57" . $_0xb828;
 $_0x3718[] = ROOTPATH . "\x70\165\x62\154\x69\143\x2f\141\x73\163\x65\164\x73\57\x69\155\x67\57" . $_0xb828;
 }
 foreach ($_0x3718 as $_0x607b) {
 if (!empty($_0x607b) && @file_exists($_0x607b) && @is_file($_0x607b)) {
 $_0x8aed = @mime_content_type($_0x607b) ?: "\x69\155\x61\147\x65\57\x70\156\x67";
 $_0x1f7a = @file_get_contents($_0x607b);
 if ($_0x1f7a !== false && strlen($_0x1f7a) > 0) {
 return "\x64\141\x74\141\x3a" . $_0x8aed . "\x3b\142\x61\163\x65\66\x34\54" . base64_encode($_0x1f7a);
 }
 }
 }
 // Fallback: cURL if starts with http or relative to baseUrl
 $_0xb729 = strpos($_0xd8c0, "\x68\164\x74\160") === 0 ? $_0xd8c0 : $_0x7061 . "\x2f" . $_0xb615;
 if (function_exists("\x63\165\x72\154\x5f\151\x6e\151\x74")) {
 $_0xb93d = curl_init($_0xb729);
 curl_setopt_array($_0xb93d, [CURLOPT_RETURNTRANSFER => true, CURLOPT_TIMEOUT => 3, CURLOPT_SSL_VERIFYPEER => false, CURLOPT_SSL_VERIFYHOST => 0]);
 $_0x7079 = curl_exec($_0xb93d);
 $_0x45dc = (int) curl_getinfo($_0xb93d, CURLINFO_HTTP_CODE);
 $_0x8aed = curl_getinfo($_0xb93d, CURLINFO_CONTENT_TYPE) ?: "\x69\155\x61\147\x65\57\x70\156\x67";
 curl_close($_0xb93d);
 if ($_0x45dc >= 200 && $_0x45dc < 300 && $_0x7079 && strlen($_0x7079) > 0) {
 return "\x64\141\x74\141\x3a" . $_0x8aed . "\x3b\142\x61\163\x65\66\x34\54" . base64_encode($_0x7079);
 }
 }
 return '';
 };
 goto L_fa651;
 L_03734:
 $_0x52ae = [];
 goto L_655a8;
 L_fa651:
 // Resolve Logos Base64
 $_0xe73d = !empty($_0xf2af->logo_kiri) ? $_0xf2af->logo_kiri : (!empty($_0x416a->logo_kiri) ? $_0x416a->logo_kiri : '');
 goto L_ef8b9;
 L_a64ef:
 if (!empty($_0xe331->bank_kelas)) {
 $_0x63c5 = $this->maybe_unserialize($_0xe331->bank_kelas);
 if (is_array($_0x63c5)) {
 $_0x454b = [];
 foreach ($_0x63c5 as $_0x65a9) {
 if (is_array($_0x65a9) && isset($_0x65a9["\x6b\145\x6c\141\x73\137\x69\144"])) {
 $_0x454b[] = $_0x65a9["\x6b\145\x6c\141\x73\137\x69\144"];
 } elseif (is_object($_0x65a9) && isset($_0x65a9->kelas_id)) {
 $_0x454b[] = $_0x65a9->kelas_id;
 } elseif (is_numeric($_0x65a9) || is_string($_0x65a9)) {
 $_0x454b[] = $_0x65a9;
 }
 }
 if (!empty($_0x454b)) {
 $_0xfc61 = $this->db->table("\x6d\141\x73\164\x65\162\x5f\153\x65\154\x61\163")->select("\x6e\141\x6d\141\x5f\153\x65\154\x61\163")->whereIn("\x69\144\x5f\153\x65\154\x61\163", $_0x454b)->get()->getResult();
 foreach ($_0xfc61 as $_0xc66f) {
 $_0xa47d[] = $_0xc66f->nama_kelas;
 }
 }
 }
 }
 goto L_f722e;
 L_ef8b9:
 $_0xc2ea = $_0xe054($_0xe73d);
 goto L_3fb0b;
 L_1ee7a:
 if (!empty($_0xf2af->web)) {
 $_0x52ae[] = "\x57\145\x62\72\x20" . esc($_0xf2af->web);
 }
 goto L_90a63;
 L_352b5:
 if (empty($_0x9d84)) {
 $_0x9d84 = $_0xe054("\x75\160\x6c\157\x61\144\x73\57\x73\145\x74\164\x69\156\x67\163\x2f\154\x6f\147\x6f\137\x6b\141\x6e\141\x6e\56\x70\156\x67");
 }
 goto L_bce60;
 L_728dd:
 $_0x780f = !empty($_0x9d84) ? "\x3c\151\x6d\147\x20\163\x72\143\x3d\42" . $_0x9d84 . "\x22\40\x77\151\x64\164\x68\75\x22\67\x35\42\x20\150\x65\151\x67\150\x74\75\x22\67\x35\42\x20\163\x74\171\x6c\145\x3d\42\x77\151\x64\164\x68\72\x20\67\x35\160\x78\73\x20\150\x65\151\x67\150\x74\72\x20\67\x35\160\x78\73\x20\157\x62\152\x65\143\x74\55\x66\151\x74\72\x20\143\x6f\156\x74\141\x69\156\x3b\40\x6d\141\x72\147\x69\156\x3a\40\x30\73\x20\160\x61\144\x64\151\x6e\147\x3a\40\x30\73\x22\40\x61\154\x74\75\x22\114\x6f\147\x6f\42\x3e" : '';
 goto L_8c0b5;
 L_cb379:
 $_0x7061 = rtrim(base_url(), "\x2f");
 goto L_d9c39;
 L_edcd1:
 header("\x43\141\x63\150\x65\55\x43\157\x6e\164\x72\157\x6c\72\x20\160\x72\151\x76\141\x74\145\x2c\40\x6d\141\x78\55\x61\147\x65\75\x30\54\x20\155\x75\163\x74\55\x72\145\x76\141\x6c\151\x64\141\x74\145");
 goto L_8603b;
 L_510be:
 $_0xff0b = $this->db->table("\x63\142\x74\137\x73\157\x61\154")->where("\x62\141\x6e\153\x5f\151\x64", $_0xba5c)->orderBy("\x6e\157\x6d\157\x72\137\x73\157\x61\154", "\x41\123\x43")->orderBy("\x69\144\x5f\163\x6f\141\x6c", "\x41\123\x43")->get()->getResult();
 goto L_7e19d;
 L_481cf:
 $_0xeb4c .= "\x3c\57\x74\141\x62\154\x65\76";
 goto L_3f33a;
 L_bf468:
 $_0x2be0 = array_sum($_0x3332);
 goto L_510be;
 L_d4373:
 $_0x9a0c .= "\x3c\144\x69\166\x20\143\x6c\141\x73\163\x3d\42\x65\170\x61\155\x2d\143\x6f\156\x74\141\x69\156\x65\162\x22\76" . "\x3c\164\x61\142\x6c\145\x20\143\x6c\141\x73\163\x3d\42\x6b\157\x70\42\x20\163\x74\171\x6c\145\x3d\42\x77\151\x64\164\x68\72\x20\61\x30\60\x25\73\x20\142\x6f\162\x64\145\x72\55\x63\157\x6c\154\x61\160\x73\145\x3a\40\x63\157\x6c\154\x61\160\x73\145\x3b\40\x6d\141\x72\147\x69\156\x3a\40\x30\73\x20\160\x61\144\x64\151\x6e\147\x3a\40\x30\73\x22\76" . "\x20\40\x3c\164\x72\76" . "\x20\40\x20\40\x3c\164\x64\40\x73\164\x79\154\x65\75\x22\167\x69\144\x74\150\x3a\40\x31\65\x25\73\x20\164\x65\170\x74\55\x61\154\x69\147\x6e\72\x20\143\x65\156\x74\145\x72\73\x20\166\x65\162\x74\151\x63\141\x6c\55\x61\154\x69\147\x6e\72\x20\155\x69\144\x64\154\x65\73\x20\160\x61\144\x64\151\x6e\147\x3a\40\x30\40\x34\160\x78\73\x20\155\x73\157\x2d\160\x61\144\x64\151\x6e\147\x2d\141\x6c\164\x3a\40\x30\160\x74\73\x22\76" . $_0x1ed6 . "\x3c\57\x74\144\x3e" . "\x20\40\x20\40\x3c\164\x64\40\x73\164\x79\154\x65\75\x22\167\x69\144\x74\150\x3a\40\x37\60\x25\73\x20\164\x65\170\x74\55\x61\154\x69\147\x6e\72\x20\143\x65\156\x74\145\x72\73\x20\166\x65\162\x74\151\x63\141\x6c\55\x61\154\x69\147\x6e\72\x20\155\x69\144\x64\154\x65\73\x20\160\x61\144\x64\151\x6e\147\x3a\40\x30\40\x34\160\x78\73\x20\155\x73\157\x2d\160\x61\144\x64\151\x6e\147\x2d\141\x6c\164\x3a\40\x30\160\x74\73\x20\154\x69\156\x65\55\x68\145\x69\147\x68\164\x3a\40\x31\56\x31\65\x3b\40\x6d\163\x6f\55\x6c\151\x6e\145\x2d\150\x65\151\x67\150\x74\55\x72\165\x6c\145\x3a\40\x65\170\x61\143\x74\154\x79\73\x22\76" . "\x20\40\x20\40\x20\40\x3c\144\x69\166\x20\163\x74\171\x6c\145\x3d\42\x66\157\x6e\164\x2d\163\x69\172\x65\72\x20\61\x31\160\x74\73\x20\146\x6f\156\x74\55\x77\145\x69\147\x68\164\x3a\40\x62\157\x6c\144\x3b\40\x74\145\x78\164\x2d\164\x72\141\x6e\163\x66\157\x72\155\x3a\40\x75\160\x70\145\x72\143\x61\163\x65\73\x20\155\x61\162\x67\151\x6e\72\x20\60\x3b\40\x70\141\x64\144\x69\156\x67\72\x20\60\x3b\40\x6c\151\x6e\145\x2d\150\x65\151\x67\150\x74\72\x20\61\x2e\61\x35\73\x20\155\x73\157\x2d\154\x69\156\x65\55\x68\145\x69\147\x68\164\x2d\162\x75\154\x65\72\x20\145\x78\141\x63\164\x6c\171\x3b\42\x3e" . $_0x29aa . "\x3c\57\x64\151\x76\76" . "\x20\40\x20\40\x20\40\x3c\144\x69\166\x20\163\x74\171\x6c\145\x3d\42\x66\157\x6e\164\x2d\163\x69\172\x65\72\x20\61\x33\56\x35\160\x74\73\x20\146\x6f\156\x74\55\x77\145\x69\147\x68\164\x3a\40\x62\157\x6c\144\x3b\40\x74\145\x78\164\x2d\164\x72\141\x6e\163\x66\157\x72\155\x3a\40\x75\160\x70\145\x72\143\x61\163\x65\73\x20\155\x61\162\x67\151\x6e\72\x20\62\x70\170\x20\60\x20\61\x70\170\x20\60\x3b\40\x70\141\x64\144\x69\156\x67\72\x20\60\x3b\40\x6c\151\x6e\145\x2d\150\x65\151\x67\150\x74\72\x20\61\x2e\61\x35\73\x20\155\x73\157\x2d\154\x69\156\x65\55\x68\145\x69\147\x68\164\x2d\162\x75\154\x65\72\x20\145\x78\141\x63\164\x6c\171\x3b\40\x6c\145\x74\164\x65\162\x2d\163\x70\141\x63\151\x6e\147\x3a\40\x30\56\x35\160\x78\73\x22\76" . $_0x214b . "\x3c\57\x64\151\x76\76" . (!empty($_0x8c94) ? "\x3c\144\x69\166\x20\163\x74\171\x6c\145\x3d\42\x66\157\x6e\164\x2d\163\x69\172\x65\72\x20\70\x2e\65\x70\164\x3b\40\x6d\141\x72\147\x69\156\x3a\40\x30\73\x20\160\x61\144\x64\151\x6e\147\x3a\40\x30\73\x20\154\x69\156\x65\55\x68\145\x69\147\x68\164\x3a\40\x31\56\x31\65\x3b\40\x6d\163\x6f\55\x6c\151\x6e\145\x2d\150\x65\151\x67\150\x74\55\x72\165\x6c\145\x3a\40\x65\170\x61\143\x74\154\x79\73\x20\143\x6f\154\x6f\162\x3a\40\x23\62\x32\62\x3b\42\x3e" . $_0x8c94 . "\x3c\57\x64\151\x76\76" : '') . (!empty($_0x49b3) ? "\x3c\144\x69\166\x20\163\x74\171\x6c\145\x3d\42\x66\157\x6e\164\x2d\163\x69\172\x65\72\x20\70\x2e\65\x70\164\x3b\40\x6d\141\x72\147\x69\156\x3a\40\x30\73\x20\160\x61\144\x64\151\x6e\147\x3a\40\x30\73\x20\154\x69\156\x65\55\x68\145\x69\147\x68\164\x3a\40\x31\56\x31\65\x3b\40\x6d\163\x6f\55\x6c\151\x6e\145\x2d\150\x65\151\x67\150\x74\55\x72\165\x6c\145\x3a\40\x65\170\x61\143\x74\154\x79\73\x20\143\x6f\154\x6f\162\x3a\40\x23\63\x33\63\x3b\42\x3e" . $_0x49b3 . "\x3c\57\x64\151\x76\76" : '') . "\x20\40\x20\40\x3c\57\x74\144\x3e" . "\x20\40\x20\40\x3c\164\x64\40\x73\164\x79\154\x65\75\x22\167\x69\144\x74\150\x3a\40\x31\65\x25\73\x20\164\x65\170\x74\55\x61\154\x69\147\x6e\72\x20\143\x65\156\x74\145\x72\73\x20\166\x65\162\x74\151\x63\141\x6c\55\x61\154\x69\147\x6e\72\x20\155\x69\144\x64\154\x65\73\x20\160\x61\144\x64\151\x6e\147\x3a\40\x30\40\x34\160\x78\73\x20\155\x73\157\x2d\160\x61\144\x64\151\x6e\147\x2d\141\x6c\164\x3a\40\x30\160\x74\73\x22\76" . $_0x780f . "\x3c\57\x74\144\x3e" . "\x20\40\x3c\57\x74\162\x3e" . "\x3c\57\x74\141\x62\154\x65\76" . "\x3c\164\x61\142\x6c\145\x20\163\x74\171\x6c\145\x3d\42\x77\151\x64\164\x68\72\x20\61\x30\60\x25\73\x20\142\x6f\162\x64\145\x72\55\x63\157\x6c\154\x61\160\x73\145\x3a\40\x63\157\x6c\154\x61\160\x73\145\x3b\40\x6d\141\x72\147\x69\156\x2d\164\x6f\160\x3a\40\x33\160\x74\73\x20\155\x61\162\x67\151\x6e\55\x62\157\x74\164\x6f\155\x3a\40\x36\160\x74\73\x22\76" . "\x20\40\x3c\164\x72\76" . "\x20\40\x20\40\x3c\164\x64\40\x73\164\x79\154\x65\75\x22\142\x6f\162\x64\145\x72\55\x74\157\x70\72\x20\62\x2e\62\x35\160\x74\40\x73\157\x6c\151\x64\40\x23\60\x30\60\x3b\40\x62\157\x72\144\x65\162\x2d\142\x6f\164\x74\157\x6d\72\x20\60\x2e\67\x35\160\x74\40\x73\157\x6c\151\x64\40\x23\60\x30\60\x3b\40\x68\145\x69\147\x68\164\x3a\40\x31\56\x35\160\x74\73\x20\146\x6f\156\x74\55\x73\151\x7a\145\x3a\40\x31\160\x74\73\x20\154\x69\156\x65\55\x68\145\x69\147\x68\164\x3a\40\x31\160\x74\73\x20\155\x73\157\x2d\154\x69\156\x65\55\x68\145\x69\147\x68\164\x2d\162\x75\154\x65\72\x20\145\x78\141\x63\164\x6c\171\x3b\40\x70\141\x64\144\x69\156\x67\72\x20\60\x3b\42\x3e\46\x6e\142\x73\160\x3b\74\x2f\164\x64\76" . "\x20\40\x3c\57\x74\162\x3e" . "\x3c\57\x74\141\x62\154\x65\76" . "\x3c\144\x69\166\x20\163\x74\171\x6c\145\x3d\42\x74\145\x78\164\x2d\141\x6c\151\x67\156\x3a\40\x63\145\x6e\164\x65\162\x3b\40\x6d\141\x72\147\x69\156\x2d\164\x6f\160\x3a\40\x33\160\x74\73\x20\155\x61\162\x67\151\x6e\55\x62\157\x74\164\x6f\155\x3a\40\x36\160\x74\73\x20\154\x69\156\x65\55\x68\145\x69\147\x68\164\x3a\40\x31\56\x32\73\x20\155\x73\157\x2d\154\x69\156\x65\55\x68\145\x69\147\x68\164\x2d\162\x75\154\x65\72\x20\145\x78\141\x63\164\x6c\171\x3b\42\x3e" . "\x20\40\x3c\144\x69\166\x20\163\x74\171\x6c\145\x3d\42\x66\157\x6e\164\x2d\163\x69\172\x65\72\x20\61\x30\56\x35\160\x74\73\x20\146\x6f\156\x74\55\x77\145\x69\147\x68\164\x3a\40\x62\157\x6c\144\x3b\40\x74\145\x78\164\x2d\164\x72\141\x6e\163\x66\157\x72\155\x3a\40\x75\160\x70\145\x72\143\x61\163\x65\73\x20\154\x65\164\x74\145\x72\55\x73\160\x61\143\x69\156\x67\72\x20\60\x2e\65\x70\170\x3b\40\x6d\141\x72\147\x69\156\x3a\40\x30\73\x20\160\x61\144\x64\151\x6e\147\x3a\40\x30\73\x22\76\x4e\101\x53\113\x41\110\x20\123\x4f\101\x4c\40\x41\123\x45\123\x4d\105\x4e\40\x2f\40\x50\105\x4e\111\x4c\101\x49\101\x4e\40\x55\112\x49\101\x4e\74\x2f\144\x69\166\x3e" . "\x20\40\x3c\144\x69\166\x20\163\x74\171\x6c\145\x3d\42\x66\157\x6e\164\x2d\163\x69\172\x65\72\x20\71\x70\164\x3b\40\x66\157\x6e\164\x2d\167\x65\151\x67\150\x74\72\x20\142\x6f\154\x64\73\x20\155\x61\162\x67\151\x6e\72\x20\61\x70\170\x20\60\x20\60\x20\60\x3b\40\x70\141\x64\144\x69\156\x67\72\x20\60\x3b\42\x3e\124\x41\110\x55\116\x20\120\x45\114\x41\112\x41\122\x41\116\x20" . esc($_0xc225->tahun ?? '') . "\x20\50\x53\105\x4d\105\x53\124\x45\122\x20" . strtoupper(esc($_0x9555->smt ?? '')) . "\x29\74\x2f\144\x69\166\x3e" . "\x3c\57\x64\151\x76\76" . "\x3c\164\x61\142\x6c\145\x20\143\x6c\141\x73\163\x3d\42\x69\156\x66\157\x2d\145\x78\141\x6d\42\x3e" . "\x20\40\x3c\164\x72\76" . "\x20\40\x20\40\x3c\164\x64\40\x73\164\x79\154\x65\75\x22\167\x69\144\x74\150\x3a\40\x31\66\x25\73\x20\146\x6f\156\x74\55\x77\145\x69\147\x68\164\x3a\40\x62\157\x6c\144\x3b\42\x3e\115\x61\164\x61\40\x50\145\x6c\141\x6a\141\x72\141\x6e\74\x2f\164\x64\76\x3c\164\x64\40\x73\164\x79\154\x65\75\x22\167\x69\144\x74\150\x3a\40\x32\45\x3b\42\x3e\72\x3c\57\x74\144\x3e\74\x74\144\x20\163\x74\171\x6c\145\x3d\42\x77\151\x64\164\x68\72\x20\63\x37\45\x3b\40\x66\157\x6e\164\x2d\167\x65\151\x67\150\x74\72\x20\142\x6f\154\x64\73\x22\76" . esc($_0xe331->nama_mapel) . "\x3c\57\x74\144\x3e" . "\x20\40\x20\40\x3c\164\x64\40\x73\164\x79\154\x65\75\x22\167\x69\144\x74\150\x3a\40\x31\66\x25\73\x20\146\x6f\156\x74\55\x77\145\x69\147\x68\164\x3a\40\x62\157\x6c\144\x3b\42\x3e\124\x69\156\x67\153\x61\164\x20\57\x20\113\x65\154\x61\163\x3c\57\x74\144\x3e\74\x74\144\x20\163\x74\171\x6c\145\x3d\42\x77\151\x64\164\x68\72\x20\62\x25\73\x22\76\x3a\74\x2f\164\x64\76\x3c\164\x64\40\x73\164\x79\154\x65\75\x22\167\x69\144\x74\150\x3a\40\x32\67\x25\73\x22\76" . esc($_0x5467) . "\x3c\57\x74\144\x3e" . "\x20\40\x3c\57\x74\162\x3e" . "\x20\40\x3c\164\x72\76" . "\x20\40\x20\40\x3c\164\x64\40\x73\164\x79\154\x65\75\x22\146\x6f\156\x74\55\x77\145\x69\147\x68\164\x3a\40\x62\157\x6c\144\x3b\42\x3e\113\x6f\144\x65\40\x42\141\x6e\153\x20\123\x6f\141\x6c\74\x2f\164\x64\76\x3c\164\x64\76\x3a\74\x2f\164\x64\76\x3c\164\x64\76" . esc($_0xe331->bank_kode) . "\x3c\57\x74\144\x3e" . "\x20\40\x20\40\x3c\164\x64\40\x73\164\x79\154\x65\75\x22\146\x6f\156\x74\55\x77\145\x69\147\x68\164\x3a\40\x62\157\x6c\144\x3b\42\x3e\107\x75\162\x75\40\x50\145\x6e\147\x61\155\x70\165\x3c\57\x74\144\x3e\74\x74\144\x3e\72\x3c\57\x74\144\x3e\74\x74\144\x3e" . esc($_0xe331->nama_guru ?: "\x2d") . "\x3c\57\x74\144\x3e" . "\x20\40\x3c\57\x74\162\x3e" . "\x20\40\x3c\164\x72\76" . "\x20\40\x20\40\x3c\164\x64\40\x73\164\x79\154\x65\75\x22\146\x6f\156\x74\55\x77\145\x69\147\x68\164\x3a\40\x62\157\x6c\144\x3b\42\x3e\110\x61\162\x69\40\x2f\40\x54\141\x6e\147\x67\141\x6c\74\x2f\164\x64\76\x3c\164\x64\76\x3a\74\x2f\164\x64\76\x3c\164\x64\76\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x3c\57\x74\144\x3e" . "\x20\40\x20\40\x3c\164\x64\40\x73\164\x79\154\x65\75\x22\146\x6f\156\x74\55\x77\145\x69\147\x68\164\x3a\40\x62\157\x6c\144\x3b\42\x3e\101\x6c\157\x6b\141\x73\151\x20\127\x61\153\x74\165\x3c\57\x74\144\x3e\74\x74\144\x3e\72\x3c\57\x74\144\x3e\74\x74\144\x3e" . (!empty($_0xe331->bank_alokasi) ? $_0xe331->bank_alokasi . "\x20\115\x65\156\x69\164" : "\x39\60\x20\115\x65\156\x69\164") . "\x3c\57\x74\144\x3e" . "\x20\40\x3c\57\x74\162\x3e" . "\x3c\57\x74\141\x62\154\x65\76" . "\x3c\164\x61\142\x6c\145\x20\163\x74\171\x6c\145\x3d\42\x77\151\x64\164\x68\72\x20\61\x30\60\x25\73\x20\142\x6f\162\x64\145\x72\55\x63\157\x6c\154\x61\160\x73\145\x3a\40\x63\157\x6c\154\x61\160\x73\145\x3b\40\x6d\141\x72\147\x69\156\x2d\164\x6f\160\x3a\40\x32\160\x78\73\x20\155\x61\162\x67\151\x6e\55\x62\157\x74\164\x6f\155\x3a\40\x38\160\x78\73\x22\76" . "\x20\40\x3c\164\x72\76" . "\x20\40\x20\40\x3c\164\x64\40\x73\164\x79\154\x65\75\x22\142\x6f\162\x64\145\x72\55\x74\157\x70\72\x20\61\x70\164\x20\163\x6f\154\x69\144\x20\43\x30\60\x30\73\x20\160\x61\144\x64\151\x6e\147\x3a\40\x30\73\x20\154\x69\156\x65\55\x68\145\x69\147\x68\164\x3a\40\x31\160\x78\73\x20\146\x6f\156\x74\55\x73\151\x7a\145\x3a\40\x31\160\x78\73\x22\76\x26\156\x62\163\x70\73\x3c\57\x74\144\x3e" . "\x20\40\x3c\57\x74\162\x3e" . "\x3c\57\x74\141\x62\154\x65\76" . $_0x3ea5 . $_0xeb4c . "\x3c\57\x64\151\x76\76\x3c\57\x64\151\x76\76\x3c\57\x62\157\x64\171\x3e\74\x2f\150\x74\155\x6c\76";
 goto L_6b220;
 L_fd087:
 // Filter and collect active questions based on target quotas in cbt_bank_soal
 $_0x3332 = ["\x31" => (int) ($_0xe331->tampil_pg ?? 0), "\x32" => (int) ($_0xe331->tampil_kompleks ?? 0), "\x33" => (int) ($_0xe331->tampil_jodohkan ?? 0), "\x34" => (int) ($_0xe331->tampil_isian ?? 0), "\x35" => (int) ($_0xe331->tampil_esai ?? 0)];
 goto L_bf468;
 L_c431e:
 if (!$_0xe331) {
 return redirect()->to(base_url("\x63\142\x74\142\x61\156\x6b\163\x6f\141\x6c"))->with("\x65\162\x72\157\x72", "\x42\141\x6e\153\x20\123\x6f\141\x6c\40\x74\151\x64\141\x6b\40\x64\151\x74\145\x6d\165\x6b\141\x6e\56");
 }
 goto L_26570;
 L_bce60:
 $_0x3cfe = function ($_0xa7c5) use ($_0xe054) {
 if (empty($_0xa7c5)) {
 return '';
 }
 $_0xa7c5 = preg_replace("\x2f\74\x5c\57\x3f\50\x68\164\x6d\154\x7c\142\x6f\144\x79\174\x68\145\x61\144\x29\133\x5e\76\x5d\52\x3e\57\x69", '', $_0xa7c5);
 $_0xa7c5 = preg_replace_callback("\x2f\74\x69\155\x67\134\x73\53\x28\133\x5e\76\x5d\52\x3f\51\x73\162\x63\75\x5b\42\x27\135\x28\133\x5e\42\x27\135\x2b\51\x5b\42\x27\135\x28\133\x5e\76\x5d\52\x3f\51\x3e\57\x69", function ($_0x240f) use ($_0xe054) {
 $_0xc57f = $_0x240f[2];
 $_0x6d2b = $_0xe054($_0xc57f);
 $_0xedf1 = !empty($_0x6d2b) ? $_0x6d2b : $_0xc57f;
 return "\x3c\151\x6d\147\x20" . $_0x240f[1] . "\x73\162\x63\75\x22" . $_0xedf1 . "\x22" . $_0x240f[3] . "\x20\163\x74\171\x6c\145\x3d\42\x6d\141\x78\55\x77\151\x64\164\x68\72\x20\64\x33\60\x70\170\x3b\40\x68\145\x69\147\x68\164\x3a\40\x61\165\x74\157\x3b\40\x6d\141\x72\147\x69\156\x3a\40\x34\160\x78\40\x30\73\x22\76";
 }, $_0xa7c5);
 // Konversi KaTeX, MathML, dan LaTeX ke native Microsoft Word equation (OMath)
 $_0xa7c5 = \App\Libraries\MathWordConverter::process($_0xa7c5);
 return trim($_0xa7c5);
 };
 goto L_fd087;
 L_e2759:
 $_0x3abc = "\x53\157\x61\154\x20" . ($_0xe331->nama_mapel ?: "\x55\152\x69\141\x6e") . "\x20" . $_0xe331->bank_kode;
 goto L_3499f;
 L_26570:
 $_0xf2af = $this->dashboard->getSetting();
 goto L_6c642;
 L_b8103:
 if ($_0x2f84 === "\x70\162\x69\156\x74") {
 $_0x9a0c .= "\x3c\144\x69\166\x20\143\x6c\141\x73\163\x3d\42\x6e\157\x2d\160\x72\151\x6e\164\x22\40\x73\164\x79\154\x65\75\x22\160\x6f\163\x69\164\x69\157\x6e\72\x20\163\x74\151\x63\153\x79\73\x20\164\x6f\160\x3a\40\x30\73\x20\172\x2d\151\x6e\144\x65\170\x3a\40\x39\71\x39\71\x3b\40\x62\141\x63\153\x67\162\x6f\165\x6e\144\x3a\40\x23\61\x65\62\x39\63\x62\73\x20\143\x6f\154\x6f\162\x3a\40\x23\146\x66\146\x3b\40\x70\141\x64\144\x69\156\x67\72\x20\61\x30\160\x78\40\x32\60\x70\170\x3b\40\x64\151\x73\160\x6c\141\x79\72\x20\146\x6c\145\x78\73\x20\141\x6c\151\x67\156\x2d\151\x74\145\x6d\163\x3a\40\x63\145\x6e\164\x65\162\x3b\40\x6a\165\x73\164\x69\146\x79\55\x63\157\x6e\164\x65\156\x74\72\x20\163\x70\141\x63\145\x2d\142\x65\164\x77\145\x65\156\x3b\40\x62\157\x78\55\x73\150\x61\144\x6f\167\x3a\40\x30\40\x34\160\x78\40\x31\62\x70\170\x20\162\x67\142\x61\50\x30\54\x30\54\x30\54\x30\56\x32\65\x29\73\x22\76" . "\x3c\144\x69\166\x20\163\x74\171\x6c\145\x3d\42\x66\157\x6e\164\x2d\167\x65\151\x67\150\x74\72\x20\142\x6f\154\x64\73\x20\146\x6f\156\x74\55\x73\151\x7a\145\x3a\40\x31\64\x70\170\x3b\40\x64\151\x73\160\x6c\141\x79\72\x20\146\x6c\145\x78\73\x20\141\x6c\151\x67\156\x2d\151\x74\145\x6d\163\x3a\40\x63\145\x6e\164\x65\162\x3b\40\x67\141\x70\72\x20\70\x70\170\x3b\42\x3e" . "\x20\40\x3c\163\x70\141\x6e\76\xf0\237\x93\204\x20\120\x72\141\x74\151\x6e\152\x61\165\x20\103\x65\164\x61\153\x20\123\x6f\141\x6c\40\x48\141\x72\144\x20\106\x69\154\x65\72\x3c\57\x73\160\x61\156\x3e" . "\x20\40\x3c\163\x70\141\x6e\40\x73\164\x79\154\x65\75\x22\143\x6f\154\x6f\162\x3a\40\x23\63\x38\142\x64\146\x38\73\x22\76" . esc($_0xe331->nama_mapel) . "\x20\50" . esc($_0xe331->bank_kode) . "\x29\74\x2f\163\x70\141\x6e\76" . "\x3c\57\x64\151\x76\76" . "\x3c\144\x69\166\x20\163\x74\171\x6c\145\x3d\42\x64\151\x73\160\x6c\141\x79\72\x20\146\x6c\145\x78\73\x20\147\x61\160\x3a\40\x31\60\x70\170\x3b\42\x3e" . "\x20\40\x3c\142\x75\164\x74\157\x6e\40\x6f\156\x63\154\x69\143\x6b\75\x22\167\x69\156\x64\157\x77\56\x70\162\x69\156\x74\50\x29\42\x20\163\x74\171\x6c\145\x3d\42\x62\141\x63\153\x67\162\x6f\165\x6e\144\x3a\40\x23\62\x35\66\x33\145\x62\73\x20\143\x6f\154\x6f\162\x3a\40\x23\146\x66\146\x3b\40\x62\157\x72\144\x65\162\x3a\40\x6e\157\x6e\145\x3b\40\x70\141\x64\144\x69\156\x67\72\x20\67\x70\170\x20\61\x38\160\x78\73\x20\142\x6f\162\x64\145\x72\55\x72\141\x64\151\x75\163\x3a\40\x36\160\x78\73\x20\146\x6f\156\x74\55\x77\145\x69\147\x68\164\x3a\40\x62\157\x6c\144\x3b\40\x63\165\x72\163\x6f\162\x3a\40\x70\157\x69\156\x74\145\x72\73\x20\146\x6f\156\x74\55\x73\151\x7a\145\x3a\40\x31\63\x70\170\x3b\40\x64\151\x73\160\x6c\141\x79\72\x20\151\x6e\154\x69\156\x65\55\x66\154\x65\170\x3b\40\x61\154\x69\147\x6e\55\x69\164\x65\155\x73\72\x20\143\x65\156\x74\145\x72\73\x20\147\x61\160\x3a\40\x36\160\x78\73\x22\76" . "\x20\40\x20\40\xf0\237\x96\250\xef\270\x8f\40\x43\145\x74\141\x6b\40\x2f\40\x50\162\x69\156\x74\40\x53\145\x6b\141\x72\141\x6e\147" . "\x20\40\x3c\57\x62\165\x74\164\x6f\156\x3e" . "\x20\40\x3c\141\x20\150\x72\145\x66\75\x22" . base_url("\x63\142\x74\142\x61\156\x6b\163\x6f\141\x6c\57\x64\157\x77\156\x6c\157\x61\144\x73\157\x61\154\x2f" . $_0xe331->id_bank) . "\x22\40\x73\164\x79\154\x65\75\x22\142\x61\143\x6b\147\x72\157\x75\156\x64\72\x20\43\x31\66\x61\63\x34\141\x3b\40\x63\157\x6c\157\x72\72\x20\43\x66\146\x66\73\x20\164\x65\170\x74\55\x64\145\x63\157\x72\141\x74\151\x6f\156\x3a\40\x6e\157\x6e\145\x3b\40\x70\141\x64\144\x69\156\x67\72\x20\67\x70\170\x20\61\x38\160\x78\73\x20\142\x6f\162\x64\145\x72\55\x72\141\x64\151\x75\163\x3a\40\x36\160\x78\73\x20\146\x6f\156\x74\55\x77\145\x69\147\x68\164\x3a\40\x62\157\x6c\144\x3b\40\x66\157\x6e\164\x2d\163\x69\172\x65\72\x20\61\x33\160\x78\73\x20\144\x69\163\x70\154\x61\171\x3a\40\x69\156\x6c\151\x6e\145\x2d\146\x6c\145\x78\73\x20\141\x6c\151\x67\156\x2d\151\x74\145\x6d\163\x3a\40\x63\145\x6e\164\x65\162\x3b\40\x67\141\x70\72\x20\66\x70\170\x3b\42\x3e" . "\x20\40\x20\40\xf0\237\x93\245\x20\125\x6e\144\x75\150\x20\127\x6f\162\x64\40\x28\56\x64\157\x63\51" . "\x20\40\x3c\57\x61\76" . "\x20\40\x3c\142\x75\164\x74\157\x6e\40\x6f\156\x63\154\x69\143\x6b\75\x22\167\x69\156\x64\157\x77\56\x63\154\x6f\163\x65\50\x29\42\x20\163\x74\171\x6c\145\x3d\42\x62\141\x63\153\x67\162\x6f\165\x6e\144\x3a\40\x23\66\x34\67\x34\70\x62\73\x20\143\x6f\154\x6f\162\x3a\40\x23\146\x66\146\x3b\40\x62\157\x72\144\x65\162\x3a\40\x6e\157\x6e\145\x3b\40\x70\141\x64\144\x69\156\x67\72\x20\67\x70\170\x20\61\x34\160\x78\73\x20\142\x6f\162\x64\145\x72\55\x72\141\x64\151\x75\163\x3a\40\x36\160\x78\73\x20\143\x75\162\x73\157\x72\72\x20\160\x6f\151\x6e\164\x65\162\x3b\40\x66\157\x6e\164\x2d\163\x69\172\x65\72\x20\61\x33\160\x78\73\x22\76" . "\x20\40\x20\40\x54\165\x74\165\x70" . "\x20\40\x3c\57\x62\165\x74\164\x6f\156\x3e" . "\x3c\57\x64\151\x76\76" . "\x3c\57\x64\151\x76\76";
 }
 goto L_d4373;
 L_7e19d:
 $_0x792b = ["\x31" => [], "\x32" => [], "\x33" => [], "\x34" => [], "\x35" => []];
 goto L_a8b99;
 L_04601:
 $_0x214b = !empty($_0xf2af->sekolah) ? strtoupper(esc($_0xf2af->sekolah)) : (!empty($_0x416a->header_2) ? esc($_0x416a->header_2) : "\x53\105\x4b\117\x4c\101\x48");
 goto L_63f68;
 L_284dc:
 $_0x8c94 = !empty($_0xa11d) ? $_0xa11d : (!empty($_0x416a->header_3) && stripos($_0x416a->header_3, "\x68\141\x64\151\x72") === false ? esc($_0x416a->header_3) : '');
 goto L_03734;
 L_3499f:
 // Assembly
 $_0x9a0c = "\x3c\41\x44\117\x43\124\x59\120\x45\40\x68\164\x6d\154\x3e" . "\x3c\150\x74\155\x6c\40\x78\155\x6c\156\x73\72\x6f\75\x22\165\x72\156\x3a\163\x63\150\x65\155\x61\163\x2d\155\x69\143\x72\157\x73\157\x66\164\x2d\143\x6f\155\x3a\157\x66\146\x69\143\x65\72\x6f\146\x66\151\x63\145\x22\40" . "\x78\155\x6c\156\x73\72\x77\75\x22\165\x72\156\x3a\163\x63\150\x65\155\x61\163\x2d\155\x69\143\x72\157\x73\157\x66\164\x2d\143\x6f\155\x3a\157\x66\146\x69\143\x65\72\x77\157\x72\144\x22\40" . "\x78\155\x6c\156\x73\72\x6d\75\x22\150\x74\164\x70\72\x2f\57\x73\143\x68\145\x6d\141\x73\56\x6d\151\x63\162\x6f\163\x6f\146\x74\56\x63\157\x6d\57\x6f\146\x66\151\x63\145\x2f\62\x30\60\x34\57\x31\62\x2f\157\x6d\155\x6c\42\x20" . "\x78\155\x6c\156\x73\75\x22\150\x74\164\x70\72\x2f\57\x77\167\x77\56\x77\63\x2e\157\x72\147\x2f\124\x52\57\x52\105\x43\55\x68\164\x6d\154\x34\60\x22\40\x6c\141\x6e\147\x3d\42\x69\144\x22\76" . "\x3c\150\x65\141\x64\76" . "\x3c\155\x65\164\x61\40\x63\150\x61\162\x73\145\x74\75\x22\165\x74\146\x2d\70\x22\76" . "\x3c\155\x65\164\x61\40\x68\164\x74\160\x2d\145\x71\165\x69\166\x3d\42\x43\157\x6e\164\x65\156\x74\55\x54\171\x70\145\x22\40\x63\157\x6e\164\x65\156\x74\75\x22\164\x65\170\x74\57\x68\164\x6d\154\x3b\40\x63\150\x61\162\x73\145\x74\75\x75\164\x66\55\x38\42\x3e" . "\x3c\164\x69\164\x6c\145\x3e" . esc($_0x3abc) . "\x3c\57\x74\151\x74\154\x65\76" . "\x3c\41\x2d\55\x5b\151\x66\40\x67\164\x65\40\x6d\163\x6f\40\x39\135\x3e" . "\x3c\170\x6d\154\x3e" . "\x3c\167\x3a\127\x6f\162\x64\104\x6f\143\x75\155\x65\156\x74\76" . "\x20\40\x3c\167\x3a\126\x69\145\x77\76\x50\162\x69\156\x74\74\x2f\167\x3a\126\x69\145\x77\76" . "\x20\40\x3c\167\x3a\132\x6f\157\x6d\76\x31\60\x30\74\x2f\167\x3a\132\x6f\157\x6d\76" . "\x20\40\x3c\167\x3a\104\x6f\116\x6f\164\x4f\160\x74\151\x6d\151\x7a\145\x46\157\x72\102\x72\157\x77\163\x65\162\x2f\76" . "\x3c\57\x77\72\x57\157\x72\144\x44\157\x63\165\x6d\145\x6e\164\x3e" . "\x3c\57\x78\155\x6c\76" . "\x3c\41\x5b\145\x6e\144\x69\146\x5d\55\x2d\76" . "\x3c\163\x74\171\x6c\145\x3e" . "\x20\40\x40\160\x61\147\x65\40\x53\145\x63\164\x69\157\x6e\61\x20\173" . "\x20\40\x20\40\x73\151\x7a\145\x3a\40\x32\61\x2e\60\x63\155\x20\62\x39\56\x37\143\x6d\73" . "\x20\40\x20\40\x6d\141\x72\147\x69\156\x3a\40\x31\56\x35\143\x6d\40\x32\56\x30\143\x6d\40\x32\56\x30\143\x6d\40\x32\56\x30\143\x6d\73" . "\x20\40\x20\40\x6d\163\x6f\55\x68\145\x61\144\x65\162\x2d\155\x61\162\x67\151\x6e\72\x20\63\x36\160\x74\73" . "\x20\40\x20\40\x6d\163\x6f\55\x66\157\x6f\164\x65\162\x2d\155\x61\162\x67\151\x6e\72\x20\63\x36\160\x74\73" . "\x20\40\x20\40\x6d\163\x6f\55\x70\141\x70\145\x72\55\x73\157\x75\162\x63\145\x3a\40\x30\73" . "\x20\40\x7d" . "\x20\40\x64\151\x76\56\x53\145\x63\164\x69\157\x6e\61\x20\173" . "\x20\40\x20\40\x70\141\x67\145\x3a\40\x53\145\x63\164\x69\157\x6e\61\x3b" . "\x20\40\x7d" . "\x20\40\x62\157\x64\171\x20\173" . "\x20\40\x20\40\x66\157\x6e\164\x2d\146\x61\155\x69\154\x79\72\x20\42\x54\151\x6d\145\x73\40\x4e\145\x77\40\x52\157\x6d\141\x6e\42\x2c\40\x54\151\x6d\145\x73\54\x20\163\x65\162\x69\146\x3b" . "\x20\40\x20\40\x66\157\x6e\164\x2d\163\x69\172\x65\72\x20\61\x31\160\x74\73" . "\x20\40\x20\40\x6c\151\x6e\145\x2d\150\x65\151\x67\150\x74\72\x20\61\x2e\62\x35\73" . "\x20\40\x20\40\x63\157\x6c\157\x72\72\x20\43\x30\60\x30\60\x30\60\x3b" . "\x20\40\x20\40\x62\141\x63\153\x67\162\x6f\165\x6e\144\x3a\40\x23\146\x66\146\x66\146\x66\73" . "\x20\40\x20\40\x6d\141\x72\147\x69\156\x3a\40\x30\73" . "\x20\40\x20\40\x70\141\x64\144\x69\156\x67\72\x20\60\x3b" . "\x20\40\x7d" . "\x20\40\x70\54\x20\144\x69\166\x2c\40\x74\144\x2c\40\x74\150\x20\173" . "\x20\40\x20\40\x66\157\x6e\164\x2d\146\x61\155\x69\154\x79\72\x20\42\x54\151\x6d\145\x73\40\x4e\145\x77\40\x52\157\x6d\141\x6e\42\x2c\40\x54\151\x6d\145\x73\54\x20\163\x65\162\x69\146\x3b" . "\x20\40\x7d" . "\x20\40\x70\40\x7b" . "\x20\40\x20\40\x6d\141\x72\147\x69\156\x3a\40\x30\73" . "\x20\40\x20\40\x6d\141\x72\147\x69\156\x2d\142\x6f\164\x74\157\x6d\72\x20\60\x70\164\x3b" . "\x20\40\x20\40\x6d\163\x6f\55\x70\141\x72\141\x2d\155\x61\162\x67\151\x6e\55\x74\157\x70\72\x20\60\x63\155\x3b" . "\x20\40\x20\40\x6d\163\x6f\55\x70\141\x72\141\x2d\155\x61\162\x67\151\x6e\55\x62\157\x74\164\x6f\155\x3a\40\x30\160\x74\73" . "\x20\40\x20\40\x6c\151\x6e\145\x2d\150\x65\151\x67\150\x74\72\x20\61\x2e\61\x35\73" . "\x20\40\x20\40\x6d\163\x6f\55\x6c\151\x6e\145\x2d\150\x65\151\x67\150\x74\55\x72\165\x6c\145\x3a\40\x65\170\x61\143\x74\154\x79\73" . "\x20\40\x7d" . "\x20\40\x2e\145\x78\141\x6d\55\x63\157\x6e\164\x61\151\x6e\145\x72\40\x7b" . "\x20\40\x20\40\x77\151\x64\164\x68\72\x20\61\x30\60\x25\73" . "\x20\40\x20\40\x6d\141\x78\55\x77\151\x64\164\x68\72\x20\70\x30\60\x70\170\x3b" . "\x20\40\x20\40\x6d\141\x72\147\x69\156\x3a\40\x30\40\x61\165\x74\157\x3b" . "\x20\40\x20\40\x70\141\x64\144\x69\156\x67\72\x20\61\x30\160\x78\40\x31\65\x70\170\x3b" . "\x20\40\x20\40\x62\157\x78\55\x73\151\x7a\151\x6e\147\x3a\40\x62\157\x72\144\x65\162\x2d\142\x6f\170\x3b" . "\x20\40\x7d" . "\x20\40\x74\141\x62\154\x65\56\x6b\157\x70\40\x7b" . "\x20\40\x20\40\x77\151\x64\164\x68\72\x20\61\x30\60\x25\73" . "\x20\40\x20\40\x62\157\x72\144\x65\162\x2d\143\x6f\154\x6c\141\x70\163\x65\72\x20\143\x6f\154\x6c\141\x70\163\x65\73" . "\x20\40\x20\40\x6d\141\x72\147\x69\156\x2d\164\x6f\160\x3a\40\x30\73" . "\x20\40\x20\40\x6d\141\x72\147\x69\156\x2d\142\x6f\164\x74\157\x6d\72\x20\60\x3b" . "\x20\40\x20\40\x70\141\x64\144\x69\156\x67\72\x20\60\x3b" . "\x20\40\x7d" . "\x20\40\x74\141\x62\154\x65\56\x69\156\x66\157\x2d\145\x78\141\x6d\40\x7b" . "\x20\40\x20\40\x77\151\x64\164\x68\72\x20\61\x30\60\x25\73" . "\x20\40\x20\40\x62\157\x72\144\x65\162\x2d\143\x6f\154\x6c\141\x70\163\x65\72\x20\143\x6f\154\x6c\141\x70\163\x65\73" . "\x20\40\x20\40\x66\157\x6e\164\x2d\163\x69\172\x65\72\x20\71\x2e\65\x70\164\x3b" . "\x20\40\x20\40\x6d\141\x72\147\x69\156\x2d\164\x6f\160\x3a\40\x33\160\x78\73" . "\x20\40\x20\40\x6d\141\x72\147\x69\156\x2d\142\x6f\164\x74\157\x6d\72\x20\64\x70\170\x3b" . "\x20\40\x7d" . "\x20\40\x74\141\x62\154\x65\56\x69\156\x66\157\x2d\145\x78\141\x6d\40\x74\144\x20\173" . "\x20\40\x20\40\x70\141\x64\144\x69\156\x67\72\x20\61\x70\170\x20\62\x70\170\x3b" . "\x20\40\x20\40\x76\145\x72\164\x69\143\x61\154\x2d\141\x6c\151\x67\156\x3a\40\x74\157\x70\73" . "\x20\40\x20\40\x6c\151\x6e\145\x2d\150\x65\151\x67\150\x74\72\x20\61\x2e\62\x3b" . "\x20\40\x20\40\x6d\163\x6f\55\x6c\151\x6e\145\x2d\150\x65\151\x67\150\x74\55\x72\165\x6c\145\x3a\40\x65\170\x61\143\x74\154\x79\73" . "\x20\40\x7d" . "\x20\40\x2e\163\x65\143\x74\151\x6f\156\x2d\164\x69\164\x6c\145\x20\173" . "\x20\40\x20\40\x66\157\x6e\164\x2d\163\x69\172\x65\72\x20\61\x31\160\x74\73" . "\x20\40\x20\40\x66\157\x6e\164\x2d\167\x65\151\x67\150\x74\72\x20\142\x6f\154\x64\73" . "\x20\40\x20\40\x6d\141\x72\147\x69\156\x2d\164\x6f\160\x3a\40\x31\60\x70\170\x3b" . "\x20\40\x20\40\x6d\141\x72\147\x69\156\x2d\142\x6f\164\x74\157\x6d\72\x20\62\x70\170\x3b" . "\x20\40\x20\40\x74\145\x78\164\x2d\164\x72\141\x6e\163\x66\157\x72\155\x3a\40\x75\160\x70\145\x72\143\x61\163\x65\73" . "\x20\40\x7d" . "\x20\40\x2e\163\x65\143\x74\151\x6f\156\x2d\163\x75\142\x74\151\x74\154\x65\40\x7b" . "\x20\40\x20\40\x66\157\x6e\164\x2d\163\x69\172\x65\72\x20\71\x2e\65\x70\164\x3b" . "\x20\40\x20\40\x66\157\x6e\164\x2d\163\x74\171\x6c\145\x3a\40\x69\164\x61\154\x69\143\x3b" . "\x20\40\x20\40\x63\157\x6c\157\x72\72\x20\43\x33\63\x34\61\x35\65\x3b" . "\x20\40\x20\40\x6d\141\x72\147\x69\156\x2d\164\x6f\160\x3a\40\x30\73" . "\x20\40\x20\40\x6d\141\x72\147\x69\156\x2d\142\x6f\164\x74\157\x6d\72\x20\66\x70\170\x3b" . "\x20\40\x7d" . "\x20\40\x2e\163\x6f\141\x6c\55\x69\164\x65\155\x20\173" . "\x20\40\x20\40\x6d\141\x72\147\x69\156\x2d\142\x6f\164\x74\157\x6d\72\x20\70\x70\170\x3b" . "\x20\40\x20\40\x70\141\x67\145\x2d\142\x72\145\x61\153\x2d\151\x6e\163\x69\144\x65\72\x20\141\x76\157\x69\144\x3b" . "\x20\40\x7d" . "\x20\40\x2e\163\x6f\141\x6c\55\x74\141\x62\154\x65\40\x7b" . "\x20\40\x20\40\x77\151\x64\164\x68\72\x20\61\x30\60\x25\73" . "\x20\40\x20\40\x62\157\x72\144\x65\162\x2d\143\x6f\154\x6c\141\x70\163\x65\72\x20\143\x6f\154\x6c\141\x70\163\x65\73" . "\x20\40\x7d" . "\x20\40\x2e\163\x6f\141\x6c\55\x74\141\x62\154\x65\40\x74\144\x20\173" . "\x20\40\x20\40\x76\145\x72\164\x69\143\x61\154\x2d\141\x6c\151\x67\156\x3a\40\x74\157\x70\73" . "\x20\40\x20\40\x70\141\x64\144\x69\156\x67\72\x20\61\x70\170\x20\60\x3b" . "\x20\40\x7d" . "\x20\40\x2e\163\x6f\141\x6c\55\x6e\157\x20\173" . "\x20\40\x20\40\x77\151\x64\164\x68\72\x20\62\x35\160\x78\73" . "\x20\40\x20\40\x66\157\x6e\164\x2d\167\x65\151\x67\150\x74\72\x20\142\x6f\154\x64\73" . "\x20\40\x20\40\x76\145\x72\164\x69\143\x61\154\x2d\141\x6c\151\x67\156\x3a\40\x74\157\x70\73" . "\x20\40\x7d" . "\x20\40\x2e\163\x6f\141\x6c\55\x63\157\x6e\164\x65\156\x74\40\x7b" . "\x20\40\x20\40\x76\145\x72\164\x69\143\x61\154\x2d\141\x6c\151\x67\156\x3a\40\x74\157\x70\73" . "\x20\40\x7d" . "\x20\40\x2e\157\x70\163\x69\55\x74\141\x62\154\x65\40\x7b" . "\x20\40\x20\40\x77\151\x64\164\x68\72\x20\61\x30\60\x25\73" . "\x20\40\x20\40\x62\157\x72\144\x65\162\x2d\143\x6f\154\x6c\141\x70\163\x65\72\x20\143\x6f\154\x6c\141\x70\163\x65\73" . "\x20\40\x20\40\x6d\141\x72\147\x69\156\x2d\164\x6f\160\x3a\40\x32\160\x78\73" . "\x20\40\x20\40\x6d\141\x72\147\x69\156\x2d\154\x65\146\x74\72\x20\62\x35\160\x78\73" . "\x20\40\x7d" . "\x20\40\x2e\157\x70\163\x69\55\x74\141\x62\154\x65\40\x74\144\x20\173" . "\x20\40\x20\40\x76\145\x72\164\x69\143\x61\154\x2d\141\x6c\151\x67\156\x3a\40\x74\157\x70\73" . "\x20\40\x20\40\x70\141\x64\144\x69\156\x67\72\x20\61\x70\170\x20\60\x3b" . "\x20\40\x7d" . "\x20\40\x2e\157\x70\163\x69\55\x6c\145\x74\164\x65\162\x20\173" . "\x20\40\x20\40\x77\151\x64\164\x68\72\x20\62\x32\160\x78\73" . "\x20\40\x20\40\x66\157\x6e\164\x2d\167\x65\151\x67\150\x74\72\x20\142\x6f\154\x64\73" . "\x20\40\x7d" . "\x20\40\x2e\157\x70\163\x69\55\x63\150\x65\143\x6b\40\x7b" . "\x20\40\x20\40\x77\151\x64\164\x68\72\x20\62\x38\160\x78\73" . "\x20\40\x20\40\x66\157\x6e\164\x2d\146\x61\155\x69\154\x79\72\x20\155\x6f\156\x6f\163\x70\141\x63\145\x3b" . "\x20\40\x20\40\x66\157\x6e\164\x2d\163\x69\172\x65\72\x20\61\x31\160\x74\73" . "\x20\40\x7d" . "\x20\40\x74\141\x62\154\x65\56\x6d\141\x74\162\x69\170\x2d\164\x61\142\x6c\145\x20\173" . "\x20\40\x20\40\x77\151\x64\164\x68\72\x20\61\x30\60\x25\73" . "\x20\40\x20\40\x62\157\x72\144\x65\162\x2d\143\x6f\154\x6c\141\x70\163\x65\72\x20\143\x6f\154\x6c\141\x70\163\x65\73" . "\x20\40\x20\40\x6d\141\x72\147\x69\156\x2d\164\x6f\160\x3a\40\x34\160\x78\73" . "\x20\40\x20\40\x6d\141\x72\147\x69\156\x2d\142\x6f\164\x74\157\x6d\72\x20\66\x70\170\x3b" . "\x20\40\x20\40\x66\157\x6e\164\x2d\163\x69\172\x65\72\x20\71\x2e\65\x70\164\x3b" . "\x20\40\x7d" . "\x20\40\x74\141\x62\154\x65\56\x6d\141\x74\162\x69\170\x2d\164\x61\142\x6c\145\x20\164\x68\54\x20\164\x61\142\x6c\145\x2e\155\x61\164\x72\151\x78\55\x74\141\x62\154\x65\40\x74\144\x20\173" . "\x20\40\x20\40\x62\157\x72\144\x65\162\x3a\40\x31\160\x78\40\x73\157\x6c\151\x64\40\x23\60\x30\60\x3b" . "\x20\40\x20\40\x70\141\x64\144\x69\156\x67\72\x20\63\x70\170\x20\65\x70\170\x3b" . "\x20\40\x20\40\x74\145\x78\164\x2d\141\x6c\151\x67\156\x3a\40\x63\145\x6e\164\x65\162\x3b" . "\x20\40\x7d" . "\x20\40\x74\141\x62\154\x65\56\x6d\141\x74\162\x69\170\x2d\164\x61\142\x6c\145\x20\164\x68\40\x7b" . "\x20\40\x20\40\x62\141\x63\153\x67\162\x6f\165\x6e\144\x2d\143\x6f\154\x6f\162\x3a\40\x23\146\x31\146\x35\146\x39\73" . "\x20\40\x7d" . "\x20\40\x2e\141\x6e\163\x77\145\x72\55\x6b\145\x79\55\x74\141\x62\154\x65\40\x7b" . "\x20\40\x20\40\x77\151\x64\164\x68\72\x20\61\x30\60\x25\73" . "\x20\40\x20\40\x62\157\x72\144\x65\162\x2d\143\x6f\154\x6c\141\x70\163\x65\72\x20\143\x6f\154\x6c\141\x70\163\x65\73" . "\x20\40\x20\40\x66\157\x6e\164\x2d\163\x69\172\x65\72\x20\71\x2e\65\x70\164\x3b" . "\x20\40\x20\40\x6d\141\x72\147\x69\156\x2d\164\x6f\160\x3a\40\x31\60\x70\170\x3b" . "\x20\40\x7d" . "\x20\40\x2e\141\x6e\163\x77\145\x72\55\x6b\145\x79\55\x74\141\x62\154\x65\40\x74\150\x2c\40\x2e\141\x6e\163\x77\145\x72\55\x6b\145\x79\55\x74\141\x62\154\x65\40\x74\144\x20\173" . "\x20\40\x20\40\x62\157\x72\144\x65\162\x3a\40\x31\160\x78\40\x73\157\x6c\151\x64\40\x23\60\x30\60\x3b" . "\x20\40\x20\40\x70\141\x64\144\x69\156\x67\72\x20\63\x70\170\x20\66\x70\170\x3b" . "\x20\40\x7d" . "\x20\40\x2e\141\x6e\163\x77\145\x72\55\x6b\145\x79\55\x74\141\x62\154\x65\40\x74\150\x20\173" . "\x20\40\x20\40\x62\141\x63\153\x67\162\x6f\165\x6e\144\x2d\143\x6f\154\x6f\162\x3a\40\x23\146\x31\146\x35\146\x39\73" . "\x20\40\x20\40\x74\145\x78\164\x2d\141\x6c\151\x67\156\x3a\40\x63\145\x6e\164\x65\162\x3b" . "\x20\40\x7d" . "\x20\40\x2e\160\x61\147\x65\55\x62\162\x65\141\x6b\40\x7b" . "\x20\40\x20\40\x70\141\x67\145\x2d\142\x72\145\x61\153\x2d\142\x65\146\x6f\162\x65\72\x20\141\x6c\167\x61\171\x73\73" . "\x20\40\x20\40\x62\162\x65\141\x6b\55\x62\145\x66\157\x72\145\x3a\40\x70\141\x67\145\x3b" . "\x20\40\x7d" . "\x20\40\x40\155\x65\144\x69\141\x20\160\x72\151\x6e\164\x20\173" . "\x20\40\x20\40\x2e\156\x6f\55\x70\162\x69\156\x74\40\x7b\40\x64\151\x73\160\x6c\141\x79\72\x20\156\x6f\156\x65\40\x21\151\x6d\160\x6f\162\x74\141\x6e\164\x3b\40\x7d" . "\x20\40\x20\40\x62\157\x64\171\x20\173\x20\160\x61\144\x64\151\x6e\147\x3a\40\x30\73\x20\175" . "\x20\40\x20\40\x2e\145\x78\141\x6d\55\x63\157\x6e\164\x61\151\x6e\145\x72\40\x7b\40\x6d\141\x78\55\x77\151\x64\164\x68\72\x20\61\x30\60\x25\73\x20\160\x61\144\x64\151\x6e\147\x3a\40\x30\73\x20\175" . "\x20\40\x7d" . "\x3c\57\x73\164\x79\154\x65\76" . "\x3c\57\x68\145\x61\144\x3e" . "\x3c\142\x6f\144\x79\76\x3c\144\x69\166\x20\143\x6c\141\x73\163\x3d\42\x53\145\x63\164\x69\157\x6e\61\x22\76";
 goto L_b8103;
 L_1c644:
 foreach ($_0x137f as $_0x2afa) {
 $_0x556b = (string) $_0x2afa->jenis;
 $_0x4c66 = $_0xdb2f[$_0x556b] ?? "\x53\157\x61\154";
 $_0x7e10 = '';
 if ($_0x556b === "\x31") {
 $_0x7e10 = "\x3c\163\x70\141\x6e\40\x73\164\x79\154\x65\75\x22\146\x6f\156\x74\55\x77\145\x69\147\x68\164\x3a\40\x62\157\x6c\144\x3b\40\x66\157\x6e\164\x2d\163\x69\172\x65\72\x20\61\x31\160\x74\73\x22\76" . strtoupper($_0x2afa->jawaban ?? '') . "\x3c\57\x73\160\x61\156\x3e";
 } elseif ($_0x556b === "\x32") {
 $_0x7c09 = $_0x2afa->jawaban ?? '';
 $_0x75a4 = json_decode($_0x7c09, true);
 if (!is_array($_0x75a4)) {
 $_0x5454 = $this->maybe_unserialize($_0x7c09);
 if (is_object($_0x5454)) {
 $_0x75a4 = (array) $_0x5454;
 } elseif (is_array($_0x5454)) {
 $_0x75a4 = $_0x5454;
 } else {
 $_0x75a4 = [$_0x7c09];
 }
 }
 $_0xb3b4 = array_map("\x73\164\x72\164\x6f\165\x70\160\x65\162", array_filter($_0x75a4, "\x69\163\x5f\163\x63\141\x6c\141\x72"));
 $_0x7e10 = "\x3c\163\x70\141\x6e\40\x73\164\x79\154\x65\75\x22\146\x6f\156\x74\55\x77\145\x69\147\x68\164\x3a\40\x62\157\x6c\144\x3b\40\x66\157\x6e\164\x2d\163\x69\172\x65\72\x20\61\x31\160\x74\73\x22\76" . implode("\x2c\40", $_0xb3b4) . "\x3c\57\x73\160\x61\156\x3e";
 } elseif ($_0x556b === "\x33") {
 $_0x1c92 = [];
 if (!empty($_0x2afa->jawaban)) {
 $_0xd89a = json_decode($_0x2afa->jawaban, true);
 if (json_last_error() === JSON_ERROR_NONE && is_array($_0xd89a)) {
 $_0x1c92 = $_0xd89a["\x6a\141\x77\141\x62\141\x6e"] ?? [];
 } else {
 $_0x5454 = $this->maybe_unserialize($_0x2afa->jawaban);
 if (is_object($_0x5454)) {
 $_0x2e49 = json_decode(json_encode($_0x5454), true);
 $_0x1c92 = $_0x2e49["\x6a\141\x77\141\x62\141\x6e"] ?? [];
 } elseif (is_array($_0x5454)) {
 $_0x1c92 = $_0x5454["\x6a\141\x77\141\x62\141\x6e"] ?? [];
 }
 }
 }
 if (!empty($_0x1c92) && is_array($_0x1c92) && count($_0x1c92) > 1) {
 $_0x6562 = $_0x1c92[0];
 $_0x87b1 = [];
 for ($_0x41c0 = 1; $_0x41c0 < count($_0x1c92); $_0x41c0++) {
 $_0x5d26 = $_0x1c92[$_0x41c0];
 $_0x9415 = strip_tags($_0x3cfe($_0x5d26[0] ?? ''));
 $_0xde8d = mb_strlen($_0x9415) > 65 ? mb_substr($_0x9415, 0, 62) . "\x2e\56\x2e" : $_0x9415;
 $_0x1a9c = [];
 for ($_0x15f6 = 1; $_0x15f6 < count($_0x5d26); $_0x15f6++) {
 if ((string) $_0x5d26[$_0x15f6] === "\x31") {
 $_0xb625 = strip_tags($_0x3cfe($_0x6562[$_0x15f6] ?? ''));
 $_0x1a9c[] = $_0xb625;
 }
 }
 $_0x108f = !empty($_0x1a9c) ? implode("\x2c\40", $_0x1a9c) : "\x2d";
 $_0x87b1[] = "\x3c\144\x69\166\x20\163\x74\171\x6c\145\x3d\42\x6d\141\x72\147\x69\156\x3a\40\x32\160\x78\40\x30\73\x22\76\x26\142\x75\154\x6c\73\x20" . esc($_0xde8d) . "\x20\46\x72\141\x72\162\x3b\40\x3c\142\x20\163\x74\171\x6c\145\x3d\42\x63\157\x6c\157\x72\72\x20\43\x31\145\x34\60\x61\146\x3b\42\x3e" . esc($_0x108f) . "\x3c\57\x62\76\x3c\57\x64\151\x76\76";
 }
 $_0x7e10 = implode('', $_0x87b1);
 } else {
 $_0x7e10 = "\x2d";
 }
 } elseif ($_0x556b === "\x34") {
 $_0x7e10 = "\x3c\163\x70\141\x6e\40\x73\164\x79\154\x65\75\x22\146\x6f\156\x74\55\x77\145\x69\147\x68\164\x3a\40\x62\157\x6c\144\x3b\42\x3e" . esc($_0x2afa->jawaban ?? '') . "\x3c\57\x73\160\x61\156\x3e";
 } elseif ($_0x556b === "\x35") {
 $_0x7e10 = $_0x3cfe($_0x2afa->jawaban ?? "\x2d");
 }
 $_0xeb4c .= "\x3c\164\x72\76";
 $_0xeb4c .= "\x3c\164\x64\40\x73\164\x79\154\x65\75\x22\164\x65\170\x74\55\x61\154\x69\147\x6e\72\x20\143\x65\156\x74\145\x72\73\x20\146\x6f\156\x74\55\x77\145\x69\147\x68\164\x3a\40\x62\157\x6c\144\x3b\42\x3e" . $_0x2afa->no_urut_tampil . "\x3c\57\x74\144\x3e";
 $_0xeb4c .= "\x3c\164\x64\40\x73\164\x79\154\x65\75\x22\146\x6f\156\x74\55\x73\151\x7a\145\x3a\40\x39\160\x74\73\x22\76" . $_0x4c66 . "\x3c\57\x74\144\x3e";
 $_0xeb4c .= "\x3c\164\x64\76" . $_0x7e10 . "\x3c\57\x74\144\x3e";
 $_0xeb4c .= "\x3c\57\x74\162\x3e";
 }
 goto L_481cf;
 L_0efb8:
 $_0xc225 = $this->dashboard->getTahunActive();
 goto L_39c2f;
 L_f722e:
 $_0x5467 = !empty($_0xa47d) ? implode("\x2c\40", $_0xa47d) : ($_0xe331->bank_level > 0 ? "\x54\151\x6e\147\x6b\141\x74\40" . $_0xe331->bank_level : "\x53\145\x6d\165\x61\40\x4b\145\x6c\141\x73");
 goto L_cb379;
 L_f823e:
 // I. Pilihan Ganda
 if (!empty($_0xe494["\x31"])) {
 $_0x3ea5 .= "\x3c\144\x69\166\x20\143\x6c\141\x73\163\x3d\42\x73\145\x63\164\x69\157\x6e\55\x74\151\x74\154\x65\42\x3e\111\x2e\40\x50\151\x6c\151\x68\141\x6e\40\x47\141\x6e\144\x61\74\x2f\144\x69\166\x3e";
 $_0x3ea5 .= "\x3c\144\x69\166\x20\143\x6c\141\x73\163\x3d\42\x73\145\x63\164\x69\157\x6e\55\x73\165\x62\164\x69\164\x6c\145\x22\76\x50\145\x74\165\x6e\152\x75\153\x3a\40\x50\151\x6c\151\x68\154\x61\150\x20\163\x61\154\x61\150\x20\163\x61\164\x75\40\x6a\141\x77\141\x62\141\x6e\40\x79\141\x6e\147\x20\160\x61\154\x69\156\x67\40\x74\145\x70\141\x74\40\x64\145\x6e\147\x61\156\x20\155\x65\155\x62\145\x72\151\x20\164\x61\156\x64\141\x20\163\x69\154\x61\156\x67\40\x28\130\x29\40\x70\141\x64\141\x20\150\x75\162\x75\146\x20\101\x2c\40\x42\54\x20\103\x2c\40\x44\54\x20\141\x74\141\x75\40\x45\41\x3c\57\x64\151\x76\76";
 foreach ($_0xe494["\x31"] as $_0x2afa) {
 $_0x3ea5 .= "\x3c\144\x69\166\x20\143\x6c\141\x73\163\x3d\42\x73\157\x61\154\x2d\151\x74\145\x6d\42\x3e";
 $_0x3ea5 .= "\x3c\164\x61\142\x6c\145\x20\143\x6c\141\x73\163\x3d\42\x73\157\x61\154\x2d\164\x61\142\x6c\145\x22\76\x3c\164\x72\76\x3c\164\x64\40\x63\154\x61\163\x73\75\x22\163\x6f\141\x6c\55\x6e\157\x22\76" . $_0x2afa->no_urut_tampil . "\x2e\74\x2f\164\x64\76\x3c\164\x64\40\x63\154\x61\163\x73\75\x22\163\x6f\141\x6c\55\x63\157\x6e\164\x65\156\x74\42\x3e" . $_0x3cfe($_0x2afa->soal) . "\x3c\57\x74\144\x3e\74\x2f\164\x72\76\x3c\57\x74\141\x62\154\x65\76";
 $_0x3ea5 .= "\x3c\164\x61\142\x6c\145\x20\143\x6c\141\x73\163\x3d\42\x6f\160\x73\151\x2d\164\x61\142\x6c\145\x22\76";
 $_0x2075 = ["\x41" => $_0x2afa->opsi_a, "\x42" => $_0x2afa->opsi_b, "\x43" => $_0x2afa->opsi_c, "\x44" => $_0x2afa->opsi_d];
 if (!empty($_0x2afa->opsi_e) || isset($_0xf2af->jenjang) && $_0xf2af->jenjang == "\x33") {
 $_0x2075["\x45"] = $_0x2afa->opsi_e;
 }
 foreach ($_0x2075 as $_0xb963 => $_0x90b2) {
 $_0x3ea5 .= "\x3c\164\x72\76\x3c\164\x64\40\x63\154\x61\163\x73\75\x22\157\x70\163\x69\55\x6c\145\x74\164\x65\162\x22\76" . $_0xb963 . "\x2e\74\x2f\164\x64\76\x3c\164\x64\40\x63\154\x61\163\x73\75\x22\157\x70\163\x69\55\x74\145\x78\164\x22\76" . $_0x3cfe($_0x90b2) . "\x3c\57\x74\144\x3e\74\x2f\164\x72\76";
 }
 $_0x3ea5 .= "\x3c\57\x74\141\x62\154\x65\76";
 $_0x3ea5 .= "\x3c\57\x64\151\x76\76";
 }
 }
 goto L_875fd;
 L_79501:
 $_0xe494 = ["\x31" => [], "\x32" => [], "\x33" => [], "\x34" => [], "\x35" => []];
 goto L_3970a;
 L_1859e:
 if (!empty($_0x416a->header_1) && stripos($_0x416a->header_1, "\x61\142\x73\145\x6e\163\x69") === false) {
 $_0x29aa = esc($_0x416a->header_1);
 }
 goto L_04601;
 L_bed63:
 foreach (["\x31", "\x32", "\x33", "\x34", "\x35"] as $_0x556b) {
 $_0x6e2d = $_0x792b[$_0x556b];
 if (empty($_0x6e2d)) {
 continue;
 }
 $_0x520a = [];
 if ($_0x2be0 > 0) {
 $_0xce59 = $_0x3332[$_0x556b] ?? 0;
 // Jika kuota jenis soal ini adalah 0, jangan tampilkan soal jenis ini sama sekali!
 if ($_0xce59 <= 0) {
 continue;
 }
 // Ambil soal yang ditandai aktif (tampilkan == '1')
 $_0xfd1d = array_values(array_filter($_0x6e2d, function ($_0x18b5) {
 return (string) ($_0x18b5->tampilkan ?? "\x31") === "\x31";
 }));
 if (count($_0xfd1d) >= $_0xce59) {
 $_0x520a = array_slice($_0xfd1d, 0, $_0xce59);
 } elseif (count($_0xfd1d) > 0) {
 $_0x520a = $_0xfd1d;
 $_0xff21 = $_0xce59 - count($_0x520a);
 foreach ($_0x6e2d as $_0x18b5) {
 if ($_0xff21 <= 0) {
 break;
 }
 if (!in_array($_0x18b5, $_0x520a, true)) {
 $_0x520a[] = $_0x18b5;
 $_0xff21--;
 }
 }
 } else {
 $_0x520a = array_slice($_0x6e2d, 0, $_0xce59);
 }
 } else {
 // Fallback jika bank belum menentukan kuota (ambil semua yang tampilkan='1')
 $_0xfd1d = array_values(array_filter($_0x6e2d, function ($_0x18b5) {
 return (string) ($_0x18b5->tampilkan ?? "\x31") === "\x31";
 }));
 $_0x520a = !empty($_0xfd1d) ? $_0xfd1d : $_0x6e2d;
 }
 foreach ($_0x520a as $_0x2afa) {
 $_0x2afa->no_urut_tampil = $_0xdd2c++;
 $_0xe494[$_0x556b][] = $_0x2afa;
 $_0x137f[] = $_0x2afa;
 }
 }
 goto L_00ffb;
 L_6f107:
 echo $_0x82ad;
 goto L_cc82d;
 L_5b2da:
 $_0xdd2c = 1;
 goto L_bed63;
 L_1d9d9:
 header("\x43\157\x6e\164\x65\156\x74\55\x54\171\x70\145\x3a\40\x61\160\x70\154\x69\143\x61\164\x69\157\x6e\57\x6d\163\x77\157\x72\144\x3b\40\x63\150\x61\162\x73\145\x74\75\x55\124\x46\55\x38");
 goto L_1b5b6;
 L_39c2f:
 $_0x9555 = $this->dashboard->getSemesterActive();
 goto L_89629;
 L_6c642:
 $_0x416a = $this->cbt->getSettingKopAbsensi();
 goto L_0efb8;
 L_c1b12:
 $_0xeb4c .= "\x3c\164\x72\76\x3c\164\x68\40\x73\164\x79\154\x65\75\x22\167\x69\144\x74\150\x3a\40\x34\65\x70\170\x3b\40\x74\145\x78\164\x2d\141\x6c\151\x67\156\x3a\40\x63\145\x6e\164\x65\162\x3b\42\x3e\116\x6f\74\x2f\164\x68\76\x3c\164\x68\40\x73\164\x79\154\x65\75\x22\167\x69\144\x74\150\x3a\40\x31\64\x30\160\x78\73\x20\164\x65\170\x74\55\x61\154\x69\147\x6e\72\x20\143\x65\156\x74\145\x72\73\x22\76\x4a\145\x6e\151\x73\40\x53\157\x61\154\x3c\57\x74\150\x3e\74\x74\150\x3e\113\x75\156\x63\151\x20\112\x61\167\x61\142\x61\156\x20\57\x20\120\x65\155\x62\141\x68\141\x73\141\x6e\74\x2f\164\x68\76\x3c\57\x74\162\x3e";
 goto L_a8356;
 L_214ac:
 // IV. Isian Singkat
 if (!empty($_0xe494["\x34"])) {
 $_0x3ea5 .= "\x3c\144\x69\166\x20\143\x6c\141\x73\163\x3d\42\x73\145\x63\164\x69\157\x6e\55\x74\151\x74\154\x65\42\x3e\111\x56\56\x20\111\x73\151\x61\156\x20\123\x69\156\x67\153\x61\164\x3c\57\x64\151\x76\76";
 $_0x3ea5 .= "\x3c\144\x69\166\x20\143\x6c\141\x73\163\x3d\42\x73\145\x63\164\x69\157\x6e\55\x73\165\x62\164\x69\164\x6c\145\x22\76\x50\145\x74\165\x6e\152\x75\153\x3a\40\x49\163\x69\154\x61\150\x20\164\x69\164\x69\153\x2d\164\x69\164\x69\153\x20\144\x69\40\x62\141\x77\141\x68\40\x69\156\x69\40\x64\145\x6e\147\x61\156\x20\152\x61\167\x61\142\x61\156\x20\171\x61\156\x67\40\x73\151\x6e\147\x6b\141\x74\54\x20\164\x65\160\x61\164\x2c\40\x64\141\x6e\40\x62\145\x6e\141\x72\41\x3c\57\x64\151\x76\76";
 foreach ($_0xe494["\x34"] as $_0x2afa) {
 $_0x3ea5 .= "\x3c\144\x69\166\x20\143\x6c\141\x73\163\x3d\42\x73\157\x61\154\x2d\151\x74\145\x6d\42\x3e";
 $_0x3ea5 .= "\x3c\164\x61\142\x6c\145\x20\143\x6c\141\x73\163\x3d\42\x73\157\x61\154\x2d\164\x61\142\x6c\145\x22\76\x3c\164\x72\76\x3c\164\x64\40\x63\154\x61\163\x73\75\x22\163\x6f\141\x6c\55\x6e\157\x22\76" . $_0x2afa->no_urut_tampil . "\x2e\74\x2f\164\x64\76\x3c\164\x64\40\x63\154\x61\163\x73\75\x22\163\x6f\141\x6c\55\x63\157\x6e\164\x65\156\x74\42\x3e" . $_0x3cfe($_0x2afa->soal) . "\x3c\57\x74\144\x3e\74\x2f\164\x72\76\x3c\57\x74\141\x62\154\x65\76";
 $_0x3ea5 .= "\x3c\144\x69\166\x20\163\x74\171\x6c\145\x3d\42\x6d\141\x72\147\x69\156\x2d\154\x65\146\x74\72\x20\62\x35\160\x78\73\x20\155\x61\162\x67\151\x6e\55\x74\157\x70\72\x20\65\x70\170\x3b\40\x6d\141\x72\147\x69\156\x2d\142\x6f\164\x74\157\x6d\72\x20\61\x32\160\x78\73\x20\146\x6f\156\x74\55\x73\151\x7a\145\x3a\40\x31\60\x70\164\x3b\42\x3e\74\x62\76\x4a\141\x77\141\x62\141\x6e\72\x3c\57\x62\76\x20\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\74\x2f\144\x69\166\x3e";
 $_0x3ea5 .= "\x3c\57\x64\151\x76\76";
 }
 }
 goto L_fb1e9;
 L_8603b:
 header("\x50\162\x61\147\x6d\141\x3a\40\x70\165\x62\154\x69\143");
 goto L_6f107;
 L_fb1e9:
 // V. Uraian / Essai
 if (!empty($_0xe494["\x35"])) {
 $_0x3ea5 .= "\x3c\144\x69\166\x20\143\x6c\141\x73\163\x3d\42\x73\145\x63\164\x69\157\x6e\55\x74\151\x74\154\x65\42\x3e\126\x2e\40\x55\162\x61\151\x61\156\x20\57\x20\105\x73\163\x61\151\x3c\57\x64\151\x76\76";
 $_0x3ea5 .= "\x3c\144\x69\166\x20\143\x6c\141\x73\163\x3d\42\x73\145\x63\164\x69\157\x6e\55\x73\165\x62\164\x69\164\x6c\145\x22\76\x50\145\x74\165\x6e\152\x75\153\x3a\40\x4a\141\x77\141\x62\154\x61\150\x20\160\x65\162\x74\141\x6e\171\x61\141\x6e\55\x70\145\x72\164\x61\156\x79\141\x61\156\x20\142\x65\162\x69\153\x75\164\x20\144\x65\156\x67\141\x6e\40\x75\162\x61\151\x61\156\x20\160\x65\156\x6a\145\x6c\141\x73\141\x6e\40\x79\141\x6e\147\x20\152\x65\154\x61\163\x20\144\x61\156\x20\154\x65\156\x67\153\x61\160\x21\74\x2f\144\x69\166\x3e";
 foreach ($_0xe494["\x35"] as $_0x2afa) {
 $_0x3ea5 .= "\x3c\144\x69\166\x20\143\x6c\141\x73\163\x3d\42\x73\157\x61\154\x2d\151\x74\145\x6d\42\x3e";
 $_0x3ea5 .= "\x3c\164\x61\142\x6c\145\x20\143\x6c\141\x73\163\x3d\42\x73\157\x61\154\x2d\164\x61\142\x6c\145\x22\76\x3c\164\x72\76\x3c\164\x64\40\x63\154\x61\163\x73\75\x22\163\x6f\141\x6c\55\x6e\157\x22\76" . $_0x2afa->no_urut_tampil . "\x2e\74\x2f\164\x64\76\x3c\164\x64\40\x63\154\x61\163\x73\75\x22\163\x6f\141\x6c\55\x63\157\x6e\164\x65\156\x74\42\x3e" . $_0x3cfe($_0x2afa->soal) . "\x3c\57\x74\144\x3e\74\x2f\164\x72\76\x3c\57\x74\141\x62\154\x65\76";
 $_0x3ea5 .= "\x3c\144\x69\166\x20\163\x74\171\x6c\145\x3d\42\x6d\141\x72\147\x69\156\x2d\154\x65\146\x74\72\x20\62\x35\160\x78\73\x20\155\x61\162\x67\151\x6e\55\x74\157\x70\72\x20\66\x70\170\x3b\40\x6d\141\x72\147\x69\156\x2d\142\x6f\164\x74\157\x6d\72\x20\61\x36\160\x78\73\x20\143\x6f\154\x6f\162\x3a\40\x23\67\x37\67\x3b\40\x6c\151\x6e\145\x2d\150\x65\151\x67\150\x74\72\x20\61\x2e\70\x3b\42\x3e";
 for ($_0xb0cf = 0; $_0xb0cf < 4; $_0xb0cf++) {
 $_0x3ea5 .= "\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x2e\56\x3c\142\x72\76";
 }
 $_0x3ea5 .= "\x3c\57\x64\151\x76\76";
 $_0x3ea5 .= "\x3c\57\x64\151\x76\76";
 }
 }
 goto L_28bce;
 L_e819f:
 $_0x49b3 = !empty($_0x52ae) ? implode("\x20\174\x20", $_0x52ae) : (!empty($_0x416a->header_4) ? esc($_0x416a->header_4) : '');
 goto L_e2759;
 L_90a63:
 if (!empty($_0xf2af->email)) {
 $_0x52ae[] = "\x45\155\x61\151\x6c\72\x20" . esc($_0xf2af->email);
 }
 goto L_e819f;
 L_da6a6:
 // Logos HTML
 $_0x1ed6 = !empty($_0xc2ea) ? "\x3c\151\x6d\147\x20\163\x72\143\x3d\42" . $_0xc2ea . "\x22\40\x77\151\x64\164\x68\75\x22\67\x35\42\x20\150\x65\151\x67\150\x74\75\x22\67\x35\42\x20\163\x74\171\x6c\145\x3d\42\x77\151\x64\164\x68\72\x20\67\x35\160\x78\73\x20\150\x65\151\x67\150\x74\72\x20\67\x35\160\x78\73\x20\157\x62\152\x65\143\x74\55\x66\151\x74\72\x20\143\x6f\156\x74\141\x69\156\x3b\40\x6d\141\x72\147\x69\156\x3a\40\x30\73\x20\160\x61\144\x64\151\x6e\147\x3a\40\x30\73\x22\40\x61\154\x74\75\x22\114\x6f\147\x6f\42\x3e" : '';
 goto L_728dd;
 L_63f68:
 $_0xa11d = esc($_0xf2af->alamat ?? '');
 goto L_8c295;
 L_d9c39:
 $_0x7b17 = rtrim(FCPATH, "\x2f\134") . "\x2f";
 goto L_93b18;
 L_c9191:
 $_0xeb4c .= "\x3c\164\x61\142\x6c\145\x20\143\x6c\141\x73\163\x3d\42\x61\156\x73\167\x65\162\x2d\153\x65\171\x2d\164\x61\142\x6c\145\x22\76";
 goto L_c1b12;
 L_875fd:
 // II. PG Kompleks
 if (!empty($_0xe494["\x32"])) {
 $_0x3ea5 .= "\x3c\144\x69\166\x20\143\x6c\141\x73\163\x3d\42\x73\145\x63\164\x69\157\x6e\55\x74\151\x74\154\x65\42\x3e\111\x49\56\x20\120\x69\154\x69\150\x61\156\x20\107\x61\156\x64\141\x20\113\x6f\155\x70\154\x65\153\x73\74\x2f\144\x69\166\x3e";
 $_0x3ea5 .= "\x3c\144\x69\166\x20\143\x6c\141\x73\163\x3d\42\x73\145\x63\164\x69\157\x6e\55\x73\165\x62\164\x69\164\x6c\145\x22\76\x50\145\x74\165\x6e\152\x75\153\x3a\40\x50\151\x6c\151\x68\154\x61\150\x20\154\x65\142\x69\150\x20\144\x61\162\x69\40\x73\141\x74\165\x20\152\x61\167\x61\142\x61\156\x20\171\x61\156\x67\40\x62\145\x6e\141\x72\40\x64\145\x6e\147\x61\156\x20\155\x65\155\x62\145\x72\151\x20\164\x61\156\x64\141\x20\143\x65\156\x74\141\x6e\147\x20\50\x26\143\x68\145\x63\153\x3b\51\x20\160\x61\144\x61\40\x6b\157\x74\141\x6b\40\x79\141\x6e\147\x20\164\x65\162\x73\145\x64\151\x61\41\x3c\57\x64\151\x76\76";
 foreach ($_0xe494["\x32"] as $_0x2afa) {
 // Parse opsi PGK (mendukung JSON string, serialized object, atau array)
 $_0x2075 = [];
 if (!empty($_0x2afa->opsi_a)) {
 $_0xd89a = json_decode($_0x2afa->opsi_a, true);
 if (json_last_error() === JSON_ERROR_NONE && is_array($_0xd89a)) {
 $_0x2075 = $_0xd89a;
 } else {
 $_0x5454 = $this->maybe_unserialize($_0x2afa->opsi_a);
 if (is_object($_0x5454) || is_array($_0x5454)) {
 $_0x2075 = (array) $_0x5454;
 }
 }
 }
 if (empty($_0x2075)) {
 foreach (["\x61" => $_0x2afa->opsi_a, "\x62" => $_0x2afa->opsi_b, "\x63" => $_0x2afa->opsi_c, "\x64" => $_0x2afa->opsi_d, "\x65" => $_0x2afa->opsi_e] as $_0x1c70 => $_0x90b2) {
 if (!empty($_0x90b2)) {
 $_0x2075[$_0x1c70] = $_0x90b2;
 }
 }
 }
 $_0x3ea5 .= "\x3c\144\x69\166\x20\143\x6c\141\x73\163\x3d\42\x73\157\x61\154\x2d\151\x74\145\x6d\42\x3e";
 $_0x3ea5 .= "\x3c\164\x61\142\x6c\145\x20\143\x6c\141\x73\163\x3d\42\x73\157\x61\154\x2d\164\x61\142\x6c\145\x22\76\x3c\164\x72\76\x3c\164\x64\40\x63\154\x61\163\x73\75\x22\163\x6f\141\x6c\55\x6e\157\x22\76" . $_0x2afa->no_urut_tampil . "\x2e\74\x2f\164\x64\76\x3c\164\x64\40\x63\154\x61\163\x73\75\x22\163\x6f\141\x6c\55\x63\157\x6e\164\x65\156\x74\42\x3e" . $_0x3cfe($_0x2afa->soal) . "\x3c\57\x74\144\x3e\74\x2f\164\x72\76\x3c\57\x74\141\x62\154\x65\76";
 if (!empty($_0x2075)) {
 $_0x3ea5 .= "\x3c\164\x61\142\x6c\145\x20\143\x6c\141\x73\163\x3d\42\x6f\160\x73\151\x2d\164\x61\142\x6c\145\x22\76";
 foreach ($_0x2075 as $_0xb963 => $_0x90b2) {
 $_0x3ea5 .= "\x3c\164\x72\76\x3c\164\x64\40\x63\154\x61\163\x73\75\x22\157\x70\163\x69\55\x63\150\x65\143\x6b\42\x3e\133\x20\46\x6e\142\x73\160\x3b\40\x5d\74\x2f\164\x64\76\x3c\164\x64\40\x63\154\x61\163\x73\75\x22\157\x70\163\x69\55\x6c\145\x74\164\x65\162\x22\76" . strtoupper($_0xb963) . "\x2e\74\x2f\164\x64\76\x3c\164\x64\40\x63\154\x61\163\x73\75\x22\157\x70\163\x69\55\x74\145\x78\164\x22\76" . $_0x3cfe($_0x90b2) . "\x3c\57\x74\144\x3e\74\x2f\164\x72\76";
 }
 $_0x3ea5 .= "\x3c\57\x74\141\x62\154\x65\76";
 }
 $_0x3ea5 .= "\x3c\57\x64\151\x76\76";
 }
 }
 goto L_4a3bb;
 L_00ffb:
 $_0x3ea5 = '';
 goto L_f823e;
 }
 /**
 * Konversi HTML ke format dokumen MHTML (MIME multipart/related) untuk Word (.doc)
 * Menjamin embedding gambar 100% offline tanpa missing file dialog di MS Word.
 */
 protected function convertHtmlToMhtml($_0x92b4, $_0x2852 = "\x44\157\x6b\165\x6d\145\x6e\40\x53\157\x61\154")
 {
 goto L_7de84;
 L_c0d40:
 $_0x728c .= "\x43\157\x6e\164\x65\156\x74\55\x54\162\x61\156\x73\146\x65\162\x2d\105\x6e\143\x6f\144\x69\156\x67\72\x20\161\x75\157\x74\145\x64\55\x70\162\x69\156\x74\141\x62\154\x65\15\xa";
 goto L_a3831;
 L_8fc3d:
 $_0x728c = "\x4d\111\x4d\105\x2d\126\x65\162\x73\151\x6f\156\x3a\40\x31\56\x30\15\xa";
 goto L_f69cf;
 L_7de84:
 $_0xa332 = [];
 goto L_60fb7;
 L_fe2e7:
 $_0x728c .= quoted_printable_encode($_0x139f) . "\xd\12\xd\12";
 goto L_97fd3;
 L_a3831:
 $_0x728c .= "\x43\157\x6e\164\x65\156\x74\55\x4c\157\x63\141\x74\151\x6f\156\x3a\40\x66\151\x6c\145\x3a\57\x2f\57\x43\72\x2f\145\x78\141\x6d\137\x61\163\x73\145\x74\163\x2f\144\x6f\143\x75\155\x65\156\x74\56\x68\164\x6d\154\xd\12\xd\12";
 goto L_fe2e7;
 L_f69cf:
 $_0x728c .= "Content-Type: multipart/related; boundary=\"{$_0xa0dc}\"; type=\"text/html\"\r\n\r\n";
 goto L_0c509;
 L_0c509:
 // Main HTML
 $_0x728c .= "--{$_0xa0dc}\r\n";
 goto L_fea5f;
 L_04fcf:
 $_0xa0dc = "\x2d\55\x2d\55\x3d\137\x4e\145\x78\164\x50\141\x72\164\x5f" . md5(uniqid((string) mt_rand(), true));
 goto L_8fc3d;
 L_60fb7:
 $_0xecbf = 0;
 goto L_e9017;
 L_e9017:
 $_0x139f = preg_replace_callback("\x2f\163\x72\143\x3d\133\x22\47\x5d\50\x64\141\x74\141\x3a\151\x6d\141\x67\145\x5c\57\x28\160\x6e\147\x7c\152\x70\145\x67\174\x6a\160\x67\174\x67\151\x66\51\x3b\142\x61\163\x65\66\x34\54\x28\133\x5e\42\x27\135\x2b\51\x29\133\x22\47\x5d\57\x69", function ($_0xee13) use (&$_0xa332, &$_0xecbf) {
 $_0xecbf++;
 $_0x3f3f = strtolower($_0xee13[2]);
 $_0x85c4 = $_0x3f3f === "\x6a\160\x65\147" ? "\x6a\160\x67" : $_0x3f3f;
 $_0x5c08 = "\x69\155\x61\147\x65\57" . ($_0x85c4 === "\x6a\160\x67" ? "\x6a\160\x65\147" : $_0x85c4);
 $_0x4303 = "\x66\151\x6c\145\x3a\57\x2f\57\x43\72\x2f\145\x78\141\x6d\137\x61\163\x73\145\x74\163\x2f\151\x6d\147\x5f" . $_0xecbf . "\x2e" . $_0x85c4;
 $_0x8604 = $_0xee13[3];
 $_0xa332[] = ["\x6c\157\x63\141\x74\151\x6f\156" => $_0x4303, "\x6d\151\x6d\145" => $_0x5c08, "\x64\141\x74\141" => $_0x8604];
 return "\x73\162\x63\75\x22" . $_0x4303 . "\x22";
 }, $_0x92b4);
 goto L_04fcf;
 L_6c82d:
 $_0x728c .= "--{$_0xa0dc}--\r\n";
 goto L_8675d;
 L_fea5f:
 $_0x728c .= "\x43\157\x6e\164\x65\156\x74\55\x54\171\x70\145\x3a\40\x74\145\x78\164\x2f\150\x74\155\x6c\73\x20\143\x68\141\x72\163\x65\164\x3d\42\x75\164\x66\55\x38\42\xd\12";
 goto L_c0d40;
 L_97fd3:
 // Attached Images
 foreach ($_0xa332 as $_0xbcca) {
 $_0x728c .= "--{$_0xa0dc}\r\n";
 $_0x728c .= "Content-Type: {$_0xbcca["\x6d\151\x6d\145"]}\r\n";
 $_0x728c .= "\x43\157\x6e\164\x65\156\x74\55\x54\162\x61\156\x73\146\x65\162\x2d\105\x6e\143\x6f\144\x69\156\x67\72\x20\142\x61\163\x65\66\x34\15\xa";
 $_0x728c .= "Content-Location: {$_0xbcca["\x6c\157\x63\141\x74\151\x6f\156"]}\r\n\r\n";
 $_0x728c .= chunk_split($_0xbcca["\x64\141\x74\141"], 76, "\xd\12") . "\xd\12\xd\12";
 }
 goto L_6c82d;
 L_8675d:
 return $_0x728c;
 }
 function innerXML($_0xc8fd)
 {
 goto L_6fdd4;
 L_e08ae:
 foreach ($_0xc8fd->childNodes as $_0xca0b) {
 $_0xd0a4->appendChild($_0xca0b->cloneNode(TRUE));
 }
 goto L_e1092;
 L_e1092:
 return $_0x952d->saveXML($_0xd0a4);
 L_51bf6:
 $_0xd0a4 = $_0x952d->createDocumentFragment();
 goto L_e08ae;
 L_6fdd4:
 $_0x952d = $_0xc8fd->ownerDocument;
 goto L_51bf6;
 }
 public function file_config()
 {
 goto L_ae716;
 L_c08ae:
 $_0x54e1["\x65\156\x63\162\x79\160\x74\137\x6e\141\x6d\145"] = TRUE;
 goto L_b7d21;
 L_52433:
 $_0x54e1["\x75\160\x6c\157\x61\144\x5f\160\x61\164\x68"] = FCPATH . "\x75\160\x6c\157\x61\144\x73\57\x62\141\x6e\153\x5f\163\x6f\141\x6c\57";
 goto L_f9435;
 L_f9435:
 $_0x54e1["\x61\154\x6c\157\x77\145\x64\137\x74\171\x70\145\x73"] = "\x6a\160\x65\147\x7c\152\x70\147\x7c\160\x6e\147\x7c\147\x69\146\x7c\155\x70\145\x67\174\x6d\160\x67\174\x6d\160\x65\147\x33\174\x6d\160\x33\174\x77\141\x76\174\x77\141\x76\145\x7c\155\x70\64";
 goto L_c08ae;
 L_ae716:
 $_0x42d8 = ["\x69\155\x61\147\x65\57\x6a\160\x65\147", "\x69\155\x61\147\x65\57\x6a\160\x67", "\x69\155\x61\147\x65\57\x70\156\x67", "\x69\155\x61\147\x65\57\x67\151\x66", "\x61\165\x64\151\x6f\57\x6d\160\x65\147", "\x61\165\x64\151\x6f\57\x6d\160\x67", "\x61\165\x64\151\x6f\57\x6d\160\x65\147\x33", "\x61\165\x64\151\x6f\57\x6d\160\x33", "\x61\165\x64\151\x6f\57\x78\55\x77\141\x76", "\x61\165\x64\151\x6f\57\x77\141\x76\145", "\x61\165\x64\151\x6f\57\x77\141\x76", "\x76\151\x64\145\x6f\57\x6d\160\x34", "\x61\160\x70\154\x69\143\x61\164\x69\157\x6e\57\x6f\143\x74\145\x74\55\x73\164\x72\145\x61\155"];
 goto L_52433;
 L_b7d21:
 return $this->load->library("\x75\160\x6c\157\x61\144", $_0x54e1);
 }
 public function validasi($_0x34ce)
 {
 $this->form_validation->set_rules("\x73\157\x61\154", "\x53\157\x61\154", "\x72\145\x71\165\x69\162\x65\144");
 if ($_0x34ce == 1) {
 $this->form_validation->set_rules("\x6a\141\x77\141\x62\141\x6e\137\x70\147", "\x4b\165\x6e\143\x69\40\x4a\141\x77\141\x62\141\x6e", "\x72\145\x71\165\x69\162\x65\144");
 } elseif ($_0x34ce == 2) {
 $this->form_validation->set_rules("\x6a\141\x77\141\x62\141\x6e\62\x5f\141", "\x4b\165\x6e\143\x69\40\x4a\141\x77\141\x62\141\x6e", "\x72\145\x71\165\x69\162\x65\144");
 $this->form_validation->set_rules("\x6a\141\x77\141\x62\141\x6e\137\x62\145\x6e\141\x72\137\x70\147\x32\133\x5d", "\x4b\165\x6e\143\x69\40\x4a\141\x77\141\x62\141\x6e", "\x72\145\x71\165\x69\162\x65\144");
 } elseif ($_0x34ce == 3) {
 $this->form_validation->set_rules("\x6a\141\x77\141\x62\141\x6e\133\x5d\133\x5d", "\x4b\165\x6e\143\x69\40\x4a\141\x77\141\x62\141\x6e", "\x72\145\x71\165\x69\162\x65\144");
 } elseif ($_0x34ce == 4) {
 $this->form_validation->set_rules("\x6a\141\x77\141\x62\141\x6e\137\x69\163\x69\141\x6e", "\x4b\165\x6e\143\x69\40\x4a\141\x77\141\x62\141\x6e", "\x72\145\x71\165\x69\162\x65\144");
 } else {
 $this->form_validation->set_rules("\x6a\141\x77\141\x62\141\x6e\137\x65\163\x73\141\x69", "\x4b\165\x6e\143\x69\40\x4a\141\x77\141\x62\141\x6e", "\x72\145\x71\165\x69\162\x65\144");
 }
 }
 public function saveSoal()
 {
 try {
 if (session_status() === PHP_SESSION_ACTIVE) {
 @session_write_close();
 }
 $_0x83d1 = $this->request->getPost("\x6d\145\x74\150\x6f\144");
 $_0xddad = $this->request->getPost("\x6a\145\x6e\151\x73");
 $_0x6b05 = $this->request->getPost("\x62\141\x6e\153\x5f\151\x64");
 $_0x9b5f = $this->request->getPost("\x6e\157\x6d\157\x72\137\x73\157\x61\154");
 $_0xfb3a = $this->request->getPost("\x73\157\x61\154");
 $this->validasi($_0xddad);
 $this->cbt->ensureHotsSchema();
 $this->file_config();
 $_0x1f7f = ["\x62\141\x6e\153\x5f\151\x64" => $_0x6b05, "\x6a\145\x6e\151\x73" => $_0xddad, "\x6e\157\x6d\157\x72\137\x73\157\x61\154" => $_0x9b5f, "\x73\157\x61\154" => $this->decode_data($_0xfb3a, $_0x6b05, $_0xddad, $_0x9b5f), "\x69\163\x5f\150\x6f\164\x73" => (string) $this->request->getPost("\x69\163\x5f\150\x6f\164\x73") === "\x31" ? 1 : 0];
 if ($_0xddad == 1) {
 $_0xc4a6 = ["\x61", "\x62", "\x63", "\x64", "\x65"];
 foreach ($_0xc4a6 as $_0x2ab1) {
 $_0xcbe8 = $this->request->getPost("\x6a\141\x77\141\x62\141\x6e\137" . $_0x2ab1);
 $_0x1f7f["\x6f\160\x73\151\x5f" . $_0x2ab1] = $this->decode_data($_0xcbe8, $_0x6b05, $_0xddad, $_0x9b5f);
 }
 $_0x1f7f["\x6a\141\x77\141\x62\141\x6e"] = $this->request->getPost("\x6a\141\x77\141\x62\141\x6e\137\x70\147");
 } elseif ($_0xddad == 2) {
 $_0x6726 = [];
 for ($_0x2ec8 = 97; $_0x2ec8 < 117; $_0x2ec8++) {
 $_0xba7d = $this->request->getPost("\x6a\141\x77\141\x62\141\x6e\62\x5f" . chr($_0x2ec8));
 if ($_0xba7d != null) {
 $_0x6726[chr($_0x2ec8)] = $this->decode_data($_0xba7d, $_0x6b05, $_0xddad, $_0x9b5f);
 //$op;
 }
 }
 $_0x1f7f["\x6f\160\x73\151\x5f\141"] = json_encode($_0x6726, JSON_UNESCAPED_UNICODE);
 $_0xd622 = [];
 $_0x673d = $this->request->getPost("\x6a\141\x77\141\x62\141\x6e\137\x62\145\x6e\141\x72\137\x70\147\x32");
 if (is_array($_0x673d)) {
 $_0x64fc = count($_0x673d);
 for ($_0x2ec8 = 0; $_0x2ec8 <= $_0x64fc; $_0x2ec8++) {
 $_0x4506 = $this->request->getPost("\x6a\141\x77\141\x62\141\x6e\137\x62\145\x6e\141\x72\137\x70\147\x32\133" . $_0x2ec8 . "\x5d");
 if ($_0x4506 !== null) {
 $_0xd622[] = $_0x4506;
 }
 }
 }
 $_0x1f7f["\x6a\141\x77\141\x62\141\x6e"] = json_encode($_0xd622, JSON_UNESCAPED_UNICODE);
 } elseif ($_0xddad == 3) {
 $_0xd622 = $this->request->getPost("\x6a\141\x77\141\x62\141\x6e");
 if (is_array($_0xd622)) {
 foreach ($_0xd622 as $_0xda98 => $_0x9923) {
 if (is_array($_0x9923)) {
 foreach ($_0x9923 as $_0x4a51 => $_0xc46d) {
 $_0x297e = str_replace(["\x3c\41\x2d\55\x3f\170\x6d\154\x20\145\x6e\143\x6f\144\x69\156\x67\75\x22\125\x54\106\x2d\70\x22\55\x2d\76", "\x3c\155\x65\164\x61\40\x63\150\x61\162\x73\145\x74\75\x22\125\x54\106\x2d\70\x22\76"], '', $_0xc46d ?? '');
 $_0xd622[$_0xda98][$_0x4a51] = $this->decode_data($_0x297e, $_0x6b05, $_0xddad, $_0x9b5f);
 }
 }
 }
 } else {
 $_0xd622 = [];
 }
 $_0xd803 = ["\x6d\157\x64\145\x6c" => $this->request->getPost("\x6d\157\x64\145\x6c"), "\x74\171\x70\145" => $this->request->getPost("\x74\171\x70\145"), "\x6a\141\x77\141\x62\141\x6e" => $_0xd622];
 $_0xbe52 = json_encode($_0xd803, JSON_UNESCAPED_UNICODE);
 $_0x1f7f["\x6a\141\x77\141\x62\141\x6e"] = $_0xbe52;
 $_0x1f7f["\x6f\160\x73\151\x5f\141"] = $_0xbe52;
 } elseif ($_0xddad == 4) {
 $_0xe081 = $this->request->getPost("\x6a\141\x77\141\x62\141\x6e\137\x69\163\x69\141\x6e");
 $_0x1f7f["\x6a\141\x77\141\x62\141\x6e"] = $this->decode_data($_0xe081, $_0x6b05, $_0xddad, $_0x9b5f);
 } else {
 $_0x4d5e = $this->request->getPost("\x6a\141\x77\141\x62\141\x6e\137\x65\163\x73\141\x69");
 $_0x1f7f["\x6a\141\x77\141\x62\141\x6e"] = $this->decode_data($_0x4d5e, $_0x6b05, $_0xddad, $_0x9b5f);
 }
 if ($this->form_validation->run() == FALSE) {
 $_0xf34b["\x73\164\x61\164\x75\163"] = "\x65\162\x72\157\x72";
 $_0xf34b["\x65\162\x72\157\x72"] = validation_errors();
 return $this->output_json($_0xf34b);
 }
 // Cari apakah soal sudah ada (by ID atau by bank_id + jenis + nomor_soal)
 $_0xd84d = $this->request->getPost("\x73\157\x61\154\x5f\151\x64");
 $_0xdbff = null;
 if (!empty($_0xd84d) && $_0xd84d != "\x30") {
 $_0xdbff = $this->db->table("\x63\142\x74\137\x73\157\x61\154")->where("\x69\144\x5f\163\x6f\141\x6c", $_0xd84d)->get()->getRow();
 }
 if (!$_0xdbff) {
 $_0xdbff = $this->db->table("\x63\142\x74\137\x73\157\x61\154")->where("\x62\141\x6e\153\x5f\151\x64", $_0x6b05)->where("\x6a\145\x6e\151\x73", $_0xddad)->where("\x6e\157\x6d\157\x72\137\x73\157\x61\154", $_0x9b5f)->get()->getRow();
 }
 if ($_0xdbff) {
 $_0x1f7f["\x75\160\x64\141\x74\145\x64\137\x6f\156"] = time();
 $this->db->table("\x63\142\x74\137\x73\157\x61\154")->where("\x69\144\x5f\163\x6f\141\x6c", $_0xdbff->id_soal)->update($_0x1f7f);
 $_0xf34b["\x73\164\x61\164\x75\163"] = "\x53\157\x61\154\x20\142\x65\162\x68\141\x73\151\x6c\40\x64\151\x75\160\x64\141\x74\145";
 $_0xf34b["\x69\144\x5f\163\x6f\141\x6c"] = $_0xdbff->id_soal;
 $_0xf34b["\x69\163\x5f\150\x6f\164\x73"] = (int) $_0x1f7f["\x69\163\x5f\150\x6f\164\x73"];
 @$this->logging->saveLog(4, "\x6d\145\x6e\147\x65\144\x69\164\x20\163\x6f\141\x6c");
 } else {
 $_0x1f7f["\x63\162\x65\141\x74\145\x64\137\x6f\156"] = time();
 $_0x1f7f["\x75\160\x64\141\x74\145\x64\137\x6f\156"] = time();
 $this->db->table("\x63\142\x74\137\x73\157\x61\154")->insert($_0x1f7f);
 $_0x4478 = $this->db->insertID();
 $_0xf34b["\x73\164\x61\164\x75\163"] = "\x53\157\x61\154\x20\142\x65\162\x68\141\x73\151\x6c\40\x64\151\x62\165\x61\164";
 $_0xf34b["\x69\144\x5f\163\x6f\141\x6c"] = $_0x4478;
 $_0xf34b["\x69\163\x5f\150\x6f\164\x73"] = (int) $_0x1f7f["\x69\163\x5f\150\x6f\164\x73"];
 @$this->logging->saveLog(3, "\x6d\145\x6d\142\x75\141\x74\40\x73\157\x61\154");
 }
 if (session_status() === PHP_SESSION_ACTIVE) {
 @session_write_close();
 }
 return $this->output_json($_0xf34b);
 } catch (\Throwable $_0x2306) {
 log_message("\x65\162\x72\157\x72", "\x45\162\x72\157\x72\40\x73\141\x76\145\x53\157\x61\154\x3a\40" . $_0x2306->getMessage() . "\xa" . $_0x2306->getTraceAsString());
 return $this->output_json(["\x73\164\x61\164\x75\163" => "\x65\162\x72\157\x72", "\x6d\145\x73\163\x61\147\x65" => "\x47\141\x67\141\x6c\40\x6d\145\x6e\171\x69\155\x70\141\x6e\40\x73\157\x61\154\x3a\40" . $_0x2306->getMessage()]);
 }
 }
 function base64_to_jpeg($_0xcea1, $_0x5749)
 {
 goto L_90ac9;
 L_3a931:
 // we could add validation here with ensuring count( $data ) > 1
 fwrite($_0x60a1, base64_decode($_0x9b38[1]));
 goto L_d9f72;
 L_e16ac:
 return $_0x5749;
 L_d4fa9:
 // split the string on commas
 // $data[ 0 ] == "data:image/png;base64"
 // $data[ 1 ] == <actual base64 string>
 $_0x9b38 = explode("\x2c", $_0xcea1);
 goto L_3a931;
 L_90ac9:
 // open the output file for writing
 $_0x60a1 = fopen($_0x5749, "\x77\142");
 goto L_d4fa9;
 L_d9f72:
 // clean up the file resource
 fclose($_0x60a1);
 goto L_e16ac;
 }
 public function hapusSoal()
 {
 goto L_81565;
 L_a9207:
 $_0xcb0d = $this->cbt->getNomorSoalById($_0xa191);
 goto L_be9a8;
 L_d8a92:
 foreach ($_0x73c4 as $_0xe68a) {
 $_0x61a2[] = ["\x69\144\x5f\163\x6f\141\x6c" => $_0xe68a->id_soal, "\x6e\157\x6d\157\x72\137\x73\157\x61\154" => $_0xf0c2];
 $_0xf0c2++;
 }
 goto L_42479;
 L_beb30:
 $this->db->table("\x63\142\x74\137\x73\157\x61\154")->where("\x69\144\x5f\163\x6f\141\x6c", $_0xa191)->delete();
 goto L_7d885;
 L_69664:
 return $this->output_json($_0x61a2);
 L_42479:
 if (count($_0x61a2) > 0) {
 $this->db->table("\x63\142\x74\137\x73\157\x61\154")->updateBatch($_0x61a2, "\x69\144\x5f\163\x6f\141\x6c");
 $this->logging->saveLog($this->LOG_TYPE->DELETE, "\x4d\145\x6e\147\x68\141\x70\165\x73\40\x73\157\x61\154\x20\156\x6f\155\x6f\162\x20" . $_0xd83b);
 }
 goto L_69664;
 L_f456c:
 $_0x61a2 = [];
 goto L_718ab;
 L_81565:
 $_0xa191 = $this->request->getPost("\x73\157\x61\154\x5f\151\x64");
 goto L_a9207;
 L_718ab:
 $_0xf0c2 = 1;
 goto L_d8a92;
 L_7d885:
 $_0x73c4 = $this->cbt->getNomorSoalByBankJenis($_0xcb0d->bank_id, $_0xcb0d->jenis);
 goto L_f456c;
 L_be9a8:
 $_0xd83b = $_0xcb0d->nomor_soal;
 goto L_beb30;
 }
 public function resetNumber()
 {
 goto L_f8a8c;
 L_f8a8c:
 $_0x1a73 = explode("\x2c", $this->request->getPost("\x73\157\x61\154\x5f\151\x64"));
 goto L_0d1cc;
 L_d2c03:
 return $this->output_json($_0x66cf);
 L_0d1cc:
 $_0x66cf = [];
 goto L_f4922;
 L_b8aa0:
 foreach ($_0x1a73 as $_0x580b) {
 $_0x66cf[] = ["\x69\144\x5f\163\x6f\141\x6c" => $_0x580b, "\x6e\157\x6d\157\x72\137\x73\157\x61\154" => $_0x6710];
 $_0x6710++;
 }
 goto L_15521;
 L_f4922:
 $_0x6710 = 1;
 goto L_b8aa0;
 L_15521:
 if (count($_0x66cf) > 0) {
 $this->db->table("\x63\142\x74\137\x73\157\x61\154")->updateBatch($_0x66cf, "\x69\144\x5f\163\x6f\141\x6c");
 }
 goto L_d2c03;
 }
 function uploadFile()
 {
 goto L_ff7f1;
 L_a4dc3:
 $_0x659b["\x66\151\x6c\145\x73"] = $_0xb340;
 goto L_3df39;
 L_e0e3b:
 $_0xb340 = $_0xcda7 == null || $_0xcda7->file == null ? [] : $this->maybe_unserialize($_0xcda7->file ?? '');
 goto L_3f38d;
 L_e269c:
 $_0xcda7 = $this->cbt->getFileSoalById($_0x4754);
 goto L_e0e3b;
 L_3df39:
 return $this->output_json($_0x659b);
 L_ff7f1:
 $_0x4754 = $this->request->getGet("\x69\144\x5f\163\x6f\141\x6c");
 goto L_e269c;
 L_3f38d:
 if (isset($_FILES["\x66\151\x6c\145\x5f\165\x70\154\x6f\141\x64\163"]["\x6e\141\x6d\145"])) {
 $_0xd482 = $_FILES["\x66\151\x6c\145\x5f\165\x70\154\x6f\141\x64\163"]["\x6e\141\x6d\145"];
 $_0xf84a = $_0x4754 . "\x5f" . time();
 $_0x1ccd["\x75\160\x6c\157\x61\144\x5f\160\x61\164\x68"] = "\x2e\57\x75\160\x6c\157\x61\144\x73\57\x62\141\x6e\153\x5f\163\x6f\141\x6c\57";
 $_0x1ccd["\x61\154\x6c\157\x77\145\x64\137\x74\171\x70\145\x73"] = "\x6d\160\x65\147\x7c\155\x70\147\x7c\155\x70\145\x67\63\x7c\155\x70\63\x7c\167\x61\166\x7c\167\x61\166\x65\174\x6d\160\x34\174\x61\166\x69";
 $_0x1ccd["\x66\151\x6c\145\x5f\156\x61\155\x65"] = $_0xf84a;
 //$config['encrypt_name'] = TRUE;
 //$config['max_size'] = '0';
 //$config['overwrite'] = FALSE;
 $this->upload->initialize($_0x1ccd);
 if (!$this->upload->do_upload("\x66\151\x6c\145\x5f\165\x70\154\x6f\141\x64\163")) {
 $_0x659b["\x73\164\x61\164\x75\163"] = false;
 $_0x2e3e = '';
 $_0xc6b9 = '';
 $_0x659b["\x73\162\x63"] = $this->upload->display_errors();
 } else {
 $_0x527e = $this->upload->data();
 /*
 $config['image_library']='gd2';
 $config['source_image']='./uploads/bank_soal/'.$file['file_name'];
 $config['create_thumb']= FALSE;
 $config['maintain_ratio']= TRUE;
 $config['quality']= '60%';
 $config['width']= 800;
 $config['height']= 800;
 $config['new_image']= './uploads/bank_soal/'.$file['file_name'];
 $this->load->library('image_lib', $config);
 $this->image_lib->resize();
 */
 //echo base_url().'uploads/bank_soal/'.$file['file_name'];
 $_0xc9d4 = pathinfo($_0x527e["\x66\151\x6c\145\x5f\156\x61\155\x65"], PATHINFO_EXTENSION);
 $_0x2e3e = "\x75\160\x6c\157\x61\144\x73\57\x62\141\x6e\153\x5f\163\x6f\141\x6c\57" . $_0xf84a . "\x2e" . $_0xc9d4;
 $_0x659b["\x73\162\x63"] = $_0x2e3e;
 //$filename = pathinfo($file['file_name'], PATHINFO_FILENAME);
 //$data['filename'] = $filename;
 $_0x659b["\x66\151\x6c\145\x6e\141\x6d\145"] = $_0xd482;
 $_0x659b["\x73\164\x61\164\x75\163"] = true;
 $_0x68ea = $_FILES["\x66\151\x6c\145\x5f\165\x70\154\x6f\141\x64\163"]["\x74\171\x70\145"];
 $_0x659b["\x74\171\x70\145"] = $_0x68ea;
 $_0x659b["\x73\151\x7a\145"] = $_FILES["\x66\151\x6c\145\x5f\165\x70\154\x6f\141\x64\163"]["\x73\151\x7a\145"];
 $_0x659b["\x73\157\x61\154"] = $_0xcda7;
 $_0xb340[] = ["\x66\151\x6c\145\x5f\156\x61\155\x65" => $_0xd482, "\x61\154\x69\141\x73" => $_0xf84a, "\x73\162\x63" => $_0x2e3e, "\x74\171\x70\145" => $_0x68ea];
 //array_push($files, ['files'=>$addFiles]);
 $this->db->table("\x63\142\x74\137\x73\157\x61\154")->where("\x69\144\x5f\163\x6f\141\x6c", $_0x4754)->update(["\x66\151\x6c\145" => json_encode($_0xb340)]);
 }
 }
 goto L_a4dc3;
 }
 //Upload image summernote
 function upload_image()
 {
 goto L_b60d8;
 L_53ada:
 $_0x5976["\x73\164\x61\164\x75\163"] = $_0x5a9c;
 goto L_ffc14;
 L_ffc14:
 return $this->output_json($_0x5976);
 L_b60d8:
 //$data['tag_id'] = $this->request->getPost('tag_id');
 $_0x5a9c = false;
 goto L_2eced;
 L_2eced:
 if (isset($_FILES["\x66\151\x6c\145"]["\x6e\141\x6d\145"])) {
 $_0xecb5["\x75\160\x6c\157\x61\144\x5f\160\x61\164\x68"] = "\x2e\57\x75\160\x6c\157\x61\144\x73\57\x62\141\x6e\153\x5f\163\x6f\141\x6c\57";
 $_0xecb5["\x61\154\x6c\157\x77\145\x64\137\x74\171\x70\145\x73"] = "\x6a\160\x67\174\x6a\160\x65\147\x7c\160\x6e\147\x7c\147\x69\146\x7c\155\x70\63\x7c\157\x67\147\x7c\167\x61\166\x7c\155\x70\64\x7c\155\x70\145\x67\174\x77\145\x62\155";
 $_0xecb5["\x66\151\x6c\145\x5f\156\x61\155\x65"] = "\x66\151\x6c\145\x5f" . date("\x59\155\x64\110\x69\163");
 $this->upload->initialize($_0xecb5);
 if (!$this->upload->do_upload("\x66\151\x6c\145")) {
 $this->upload->display_errors();
 $_0x5a9c = false;
 } else {
 $_0x2793 = $this->upload->data();
 //Compress Image
 //$config['image_library']='gd2';
 //$config['source_image']='./uploads/bank_soal/'.$data['file_name'];
 //$config['create_thumb']= FALSE;
 //$config['maintain_ratio']= TRUE;
 //$config['quality']= '60%';
 //$config['width']= 800;
 //$config['height']= 800;
 //$config['new_image']= './uploads/bank_soal/'.$data['file_name'];
 //$this->load->library('image_lib', $config);
 //$this->image_lib->resize();
 $_0x5976["\x66\151\x6c\145\x6e\141\x6d\145"] = "\x75\160\x6c\157\x61\144\x73\57\x62\141\x6e\153\x5f\163\x6f\141\x6c\57" . $_0x2793["\x66\151\x6c\145\x5f\156\x61\155\x65"];
 $_0x5a9c = true;
 }
 }
 goto L_53ada;
 }
 function uploadSoalImage()
 {
 goto L_3818f;
 L_eb369:
 $_0xae2c = $this->request->getPost("\x73\162\x63");
 goto L_b8942;
 L_b5f2e:
 $_0xc712["\x73\164\x61\164\x75\163"] = file_put_contents($_0xfc88 . $_0x6033, base64_decode($_0xae2c));
 goto L_b8c56;
 L_3818f:
 $_0x6033 = $this->request->getPost("\x6e\141\x6d\145");
 goto L_eb369;
 L_b8c56:
 $_0xc712["\x73\162\x63"] = "\x75\160\x6c\157\x61\144\x73\57\x62\141\x6e\153\x5f\163\x6f\141\x6c\57" . $_0x6033;
 goto L_e06a6;
 L_d69ef:
 $_0xfc88 = FCPATH . "\x75\160\x6c\157\x61\144\x73\57\x62\141\x6e\153\x5f\163\x6f\141\x6c\57";
 goto L_a19f5;
 L_a19f5:
 if (!is_dir($_0xfc88)) {
 @mkdir($_0xfc88, 0777, true);
 }
 goto L_b5f2e;
 L_e06a6:
 return $this->output_json($_0xc712);
 L_ee2d1:
 $_0xae2c = str_replace("\x20", "\x2b", $_0xae2c);
 goto L_d69ef;
 L_b8942:
 $_0xae2c = str_replace("\x25\62\x42", "\x2b", $_0xae2c ?? '');
 goto L_ee2d1;
 }
 //Delete image summernote
 function deleteFile()
 {
 goto L_925ce;
 L_c4b53:
 $_0xa664 = str_replace(base_url(), '', $_0x59de ?? '');
 goto L_d5a34;
 L_d5a34:
 if (unlink($_0xa664)) {
 echo "\x46\151\x6c\145\x20\104\x65\154\x65\164\x65\40\x53\165\x63\143\x65\163\x73\146\x75\154\x6c\171";
 }
 L_925ce:
 $_0x59de = $this->request->getPost("\x73\162\x63");
 goto L_c4b53;
 }
 function uploadSoal()
 {
 goto L_ace6e;
 L_02501:
 $_0x4cee = false;
 goto L_e8b97;
 L_a2c2d:
 $_0x6a9b = [];
 goto L_7e106;
 L_e8b97:
 if (!empty($_0xfeae)) {
 $_0x1d34 = json_decode($_0xfeae, true);
 if (is_array($_0x1d34)) {
 $_0x40c2 = 0;
 foreach ($_0x1d34 as $_0x7d89 => $_0xf26b) {
 if (is_array($_0xf26b)) {
 $_0x40c2 += count($_0xf26b);
 }
 }
 $_0x2d32 = 0;
 if (is_array($_0x66ac)) {
 foreach ($_0x66ac as $_0x7d89 => $_0xf26b) {
 if (is_array($_0xf26b)) {
 $_0x2d32 += count($_0xf26b);
 }
 }
 }
 // Prioritaskan JSON jika $datas kosong atau jika JSON memiliki soal lebih banyak (solusi max_input_vars)
 if (empty($_0x66ac) || $_0x40c2 >= $_0x2d32) {
 $_0x66ac = $_0x1d34;
 $_0x4cee = true;
 }
 }
 }
 goto L_b055b;
 L_78280:
 foreach ($_0x66ac as $_0x651e => $_0x4e40) {
 if (!is_array($_0x4e40)) {
 continue;
 }
 foreach ($_0x4e40 as $_0xee01 => $_0xb1e8) {
 if (!is_array($_0xb1e8)) {
 continue;
 }
 $_0xc12f = $_0xf034($_0xb1e8["\x73\157\x61\154"] ?? '');
 $_0x988e = $_0xc12f != '' ? $this->decode_data($_0xc12f, $_0xd4db, $_0x651e, $_0xee01) : '';
 if ($_0x988e != '') {
 $_0x7dba = ["\x6a\145\x6e\151\x73" => $_0x651e, "\x6e\157\x6d\157\x72\137\x73\157\x61\154" => $_0xee01, "\x73\157\x61\154" => $_0x988e, "\x66\151\x6c\145" => json_encode([])];
 if ($_0x651e == 1) {
 $_0x9e61 = [];
 if (isset($_0xb1e8["\x6f\160\x73\151"]) && is_array($_0xb1e8["\x6f\160\x73\151"])) {
 foreach ($_0xb1e8["\x6f\160\x73\151"] as $_0x685c => $_0xf8e5) {
 $_0x9e61[strtoupper(trim($_0x685c))] = $_0xf8e5;
 }
 }
 $_0x7dba["\x6f\160\x73\151\x5f\141"] = isset($_0x9e61["\x41"]) ? $this->decode_data($_0xf034($_0x9e61["\x41"]), $_0xd4db, $_0x651e, $_0xee01) : '';
 $_0x7dba["\x6f\160\x73\151\x5f\142"] = isset($_0x9e61["\x42"]) ? $this->decode_data($_0xf034($_0x9e61["\x42"]), $_0xd4db, $_0x651e, $_0xee01) : '';
 $_0x7dba["\x6f\160\x73\151\x5f\143"] = isset($_0x9e61["\x43"]) ? $this->decode_data($_0xf034($_0x9e61["\x43"]), $_0xd4db, $_0x651e, $_0xee01) : '';
 $_0x7dba["\x6f\160\x73\151\x5f\144"] = isset($_0x9e61["\x44"]) ? $this->decode_data($_0xf034($_0x9e61["\x44"]), $_0xd4db, $_0x651e, $_0xee01) : '';
 $_0x7dba["\x6f\160\x73\151\x5f\145"] = isset($_0x9e61["\x45"]) ? $this->decode_data($_0xf034($_0x9e61["\x45"]), $_0xd4db, $_0x651e, $_0xee01) : '';
 $_0xb134 = '';
 if (isset($_0xb1e8["\x6b\165\x6e\143\x69"])) {
 if (is_array($_0xb1e8["\x6b\165\x6e\143\x69"]) && count($_0xb1e8["\x6b\165\x6e\143\x69"]) > 0) {
 $_0xb134 = strtoupper(trim((string) $_0xb1e8["\x6b\165\x6e\143\x69"][0]));
 } elseif (is_string($_0xb1e8["\x6b\165\x6e\143\x69"]) || is_numeric($_0xb1e8["\x6b\165\x6e\143\x69"])) {
 $_0xb134 = strtoupper(trim((string) $_0xb1e8["\x6b\165\x6e\143\x69"]));
 }
 }
 $_0x7dba["\x6a\141\x77\141\x62\141\x6e"] = $_0xb134;
 $_0xd29f++;
 } elseif ($_0x651e == "\x32") {
 $_0xcab6 = [];
 $_0xa634 = [];
 if (isset($_0xb1e8["\x6f\160\x73\151"]) && is_array($_0xb1e8["\x6f\160\x73\151"])) {
 foreach ($_0xb1e8["\x6f\160\x73\151"] as $_0x3827 => $_0x40ec) {
 $_0xcab6[strtolower(trim($_0x3827 ?? ''))] = $this->decode_data($_0xf034($_0x40ec), $_0xd4db, $_0x651e, $_0xee01);
 }
 }
 if (isset($_0xb1e8["\x6b\165\x6e\143\x69"])) {
 $_0xa90a = is_array($_0xb1e8["\x6b\165\x6e\143\x69"]) ? $_0xb1e8["\x6b\165\x6e\143\x69"] : [$_0xb1e8["\x6b\165\x6e\143\x69"]];
 foreach ($_0xa90a as $_0x40ec) {
 if ($_0x40ec !== null && $_0x40ec !== '') {
 $_0xa634[] = strtolower(trim((string) $_0x40ec));
 }
 }
 }
 $_0x7dba["\x6f\160\x73\151\x5f\141"] = json_encode($_0xcab6);
 $_0x7dba["\x6a\141\x77\141\x62\141\x6e"] = json_encode($_0xa634);
 $_0x75ea++;
 } elseif ($_0x651e == "\x33") {
 $_0x33e9 = [];
 $_0xc3af = [];
 $_0x3099 = [];
 $_0x3099[] = "\x23";
 $_0xc6a0 = [];
 if (isset($_0xb1e8["\x6b\165\x6e\143\x69"]) && is_array($_0xb1e8["\x6b\165\x6e\143\x69"])) {
 foreach ($_0xb1e8["\x6b\165\x6e\143\x69"] as $_0x4db0 => $_0x85cb) {
 if ($_0x85cb !== '' && $_0x85cb !== null) {
 $_0xc6a0[strtoupper(trim($_0x4db0))] = array_map("\x74\162\x69\155", preg_split("\x2f\133\x2c\73\x5c\57\x5d\53\x2f", (string) $_0x85cb));
 }
 }
 }
 if (isset($_0xb1e8["\x6b\157\x6c\157\x6d"]) && is_array($_0xb1e8["\x6b\157\x6c\157\x6d"])) {
 foreach ($_0xb1e8["\x6b\157\x6c\157\x6d"] as $_0xd3fc => $_0x7e93) {
 $_0xc3af[$_0xd3fc] = $_0x7e93;
 if ($_0x7e93 != '') {
 $_0x3099[] = $this->decode_data($_0xf034($_0x7e93), $_0xd4db, $_0x651e, $_0xee01);
 }
 }
 }
 $_0x33e9[] = $_0x3099;
 $_0xf556 = [];
 if (isset($_0xb1e8["\x62\141\x72\151\x73"]) && is_array($_0xb1e8["\x62\141\x72\151\x73"])) {
 foreach ($_0xb1e8["\x62\141\x72\151\x73"] as $_0x4db0 => $_0xe969) {
 $_0x149f = [];
 if ($_0x4db0 != '') {
 $_0x149f[] = $this->decode_data($_0xf034($_0xe969), $_0xd4db, $_0x651e, $_0xee01);
 }
 $_0xcd1c = strtoupper(trim($_0x4db0));
 foreach ($_0xc3af as $_0xa97a => $_0x6ed0) {
 if ($_0x4db0 != '' && $_0x6ed0 != '' && isset($_0xc6a0[$_0xcd1c])) {
 $_0x156b = in_array(strtoupper(trim($_0xa97a)), array_map("\x73\164\x72\164\x6f\165\x70\160\x65\162", $_0xc6a0[$_0xcd1c]));
 $_0x149f[] = $_0x156b ? "\x31" : "\x30";
 } elseif ($_0x4db0 != '' && $_0x6ed0 != '') {
 $_0x149f[] = "\x30";
 }
 }
 if (count($_0x149f) > 0) {
 $_0x33e9[] = $_0x149f;
 }
 if ($_0x4db0 != '') {
 array_shift($_0x149f);
 $_0xf556[$_0x4db0] = $_0x149f;
 }
 }
 }
 $_0xf877 = [];
 foreach ($_0xf556 as $_0xead9 => $_0xbe01) {
 $_0xc162 = array_count_values($_0xbe01);
 if (isset($_0xc162[1]) && $_0xc162[1] > 1) {
 $_0xf877[] = "\x63\150\x65\143\x6b\142\x6f\170";
 }
 }
 $_0x6d83 = count($_0xf877) > 0 ? "\x31" : "\x32";
 $_0x7822 = count($_0x33e9);
 $_0x8864 = count($_0x33e9[0] ?? []);
 $_0x47a5 = ["\x6d\157\x64\145\x6c" => $_0x7822 == $_0x8864 ? "\x31" : "\x32", "\x74\171\x70\145" => $_0x6d83, "\x6a\141\x77\141\x62\141\x6e" => $_0x33e9];
 $_0xcffa = json_encode($_0x47a5);
 $_0x7dba["\x6f\160\x73\151\x5f\141"] = $_0xcffa;
 $_0x7dba["\x6a\141\x77\141\x62\141\x6e"] = $_0xcffa;
 $_0xb8d8++;
 } elseif ($_0x651e == "\x34") {
 $_0x5cc1 = $_0xb1e8["\x6b\165\x6e\143\x69"] ?? '';
 if (is_array($_0x5cc1)) {
 $_0x5cc1 = implode("\x2c\40", $_0x5cc1);
 }
 $_0x7dba["\x6a\141\x77\141\x62\141\x6e"] = trim((string) $_0xf034($_0x5cc1));
 $_0xc1ea++;
 } else {
 $_0x5cc1 = $_0xb1e8["\x6b\165\x6e\143\x69"] ?? '';
 if (is_array($_0x5cc1)) {
 $_0x5cc1 = implode("\x3c\142\x72\76", $_0x5cc1);
 }
 $_0x7dba["\x6a\141\x77\141\x62\141\x6e"] = $this->decode_data($_0xf034($_0x5cc1), $_0xd4db, $_0x651e, $_0xee01);
 $_0x714d++;
 }
 $_0x49a2[] = $_0x7dba;
 }
 }
 }
 goto L_5f7df;
 L_b055b:
 if (empty($_0x66ac) || !is_array($_0x66ac)) {
 return $this->output_json(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x44\141\x74\141\x20\163\x6f\141\x6c\40\x74\151\x64\141\x6b\40\x64\151\x74\145\x6d\165\x6b\141\x6e\40\x61\164\x61\165\x20\153\x6f\163\x6f\156\x67\56\x20\120\x61\163\x74\151\x6b\141\x6e\40\x66\151\x6c\145\x20\127\x6f\162\x64\40\x73\145\x73\165\x61\151\x20\146\x6f\162\x6d\141\x74\40\x74\145\x6d\160\x6c\141\x74\145\x2e", "\x74\157\x74\141\x6c" => 0, "\x69\156\x73\145\x72\164" => 0]);
 }
 goto L_7de04;
 L_ace6e:
 $_0xd4db = $this->request->getPost("\x69\144\x5f\142\x61\156\x6b");
 goto L_44b51;
 L_7e106:
 foreach ($_0x49a2 as $_0xb981) {
 $_0x7d89 = (string) ($_0xb981["\x6a\145\x6e\151\x73"] ?? "\x31");
 $_0x1403[$_0x7d89] = ($_0x1403[$_0x7d89] ?? 0) + 1;
 $_0x5307 = "\x31";
 if ($_0xdf15 > 0) {
 $_0xb496 = $_0x59a3[$_0x7d89] ?? 0;
 $_0x5307 = $_0x1403[$_0x7d89] <= $_0xb496 ? "\x31" : "\x30";
 }
 $_0x6a9b[] = ["\x62\141\x6e\153\x5f\151\x64" => $_0xd4db, "\x6a\145\x6e\151\x73" => $_0xb981["\x6a\145\x6e\151\x73"], "\x6e\157\x6d\157\x72\137\x73\157\x61\154" => $_0xb981["\x6e\157\x6d\157\x72\137\x73\157\x61\154"], "\x73\157\x61\154" => $_0xb981["\x73\157\x61\154"], "\x64\145\x73\153\x72\151\x70\163\x69" => '', "\x6b\145\x73\165\x6c\151\x74\141\x6e" => "\x38", "\x74\151\x6d\145\x72" => "\x30", "\x74\151\x6d\145\x72\137\x6d\145\x6e\151\x74" => "\x30", "\x66\151\x6c\145" => $_0xb981["\x66\151\x6c\145"], "\x63\162\x65\141\x74\145\x64\137\x6f\156" => time(), "\x75\160\x64\141\x74\145\x64\137\x6f\156" => time(), "\x6f\160\x73\151\x5f\141" => $_0xb981["\x6f\160\x73\151\x5f\141"] ?? '', "\x6f\160\x73\151\x5f\142" => $_0xb981["\x6f\160\x73\151\x5f\142"] ?? '', "\x6f\160\x73\151\x5f\143" => $_0xb981["\x6f\160\x73\151\x5f\143"] ?? '', "\x6f\160\x73\151\x5f\144" => $_0xb981["\x6f\160\x73\151\x5f\144"] ?? '', "\x6f\160\x73\151\x5f\145" => $_0xb981["\x6f\160\x73\151\x5f\145"] ?? '', "\x6a\141\x77\141\x62\141\x6e" => $_0xb981["\x6a\141\x77\141\x62\141\x6e"], "\x74\141\x6d\160\x69\154\x6b\141\x6e" => $_0x5307];
 }
 goto L_d2121;
 L_7de04:
 $_0x5a66 = $this->cbt->getDataBankById($_0xd4db);
 goto L_d3fb5;
 L_44b51:
 $_0x66ac = $this->request->getPost("\x73\157\x61\154");
 goto L_1a85d;
 L_eaa93:
 if (count($_0x6a9b) > 0) {
 $_0x9e0d = ["\x73\164\x61\164\x75\163\x5f\163\x6f\141\x6c" => "\x31", "\x6a\155\x6c\137\x73\157\x61\154" => $_0xd29f, "\x6a\155\x6c\137\x6b\157\x6d\160\x6c\145\x6b\163" => $_0x75ea, "\x6a\155\x6c\137\x6a\157\x64\157\x68\153\x61\156" => $_0xb8d8, "\x6a\155\x6c\137\x69\163\x69\141\x6e" => $_0xc1ea, "\x6a\155\x6c\137\x65\163\x61\151" => $_0x714d];
 $_0x3dd0 = $this->db->table("\x63\142\x74\137\x62\141\x6e\153\x5f\163\x6f\141\x6c")->where("\x69\144\x5f\142\x61\156\x6b", $_0xd4db)->update($_0x9e0d);
 $_0xa455["\x73\145\x6c\145\x73\141\x69"] = $_0x3dd0;
 // SINKRONISASI OTOMATIS KE JADWAL & UJIAN SISWA:
 // Pastikan siswa yang belum menyelesaikan ujian langsung disinkronkan dengan butir soal terbaru
 $_0x3dd2 = $this->db->table("\x63\142\x74\137\x6a\141\x64\167\x61\154")->where("\x69\144\x5f\142\x61\156\x6b", $_0xd4db)->get()->getResult();
 if (!empty($_0x3dd2)) {
 $_0x1b0a = array_column($_0x3dd2, "\x69\144\x5f\152\x61\144\x77\141\x6c");
 $_0xbde2 = $this->db->table("\x63\142\x74\137\x73\151\x73\167\x61")->whereIn("\x69\144\x5f\152\x61\144\x77\141\x6c", $_0x1b0a)->get()->getResult();
 foreach ($_0xbde2 as $_0xeb0e) {
 $_0xeb50 = json_decode($_0xeb0e->jawaban ?? '', true);
 $_0x14c6 = false;
 if (is_array($_0xeb50)) {
 foreach ($_0xeb50 as $_0xce76) {
 if (!empty($_0xce76["\x6a\141\x77\141\x62\141\x6e\137\x73\151\x73\167\x61"])) {
 $_0x14c6 = true;
 break;
 }
 }
 }
 if (!$_0x14c6 && empty($_0xeb0e->selesai)) {
 $this->db->table("\x63\142\x74\137\x73\151\x73\167\x61")->where("\x69\144\x5f\143\x62\164\x5f\163\x69\163\x77\141", $_0xeb0e->id_cbt_siswa)->delete();
 }
 }
 }
 $_0xe659 = [];
 if ($_0xd29f > 0) {
 $_0xe659[] = "PG: {$_0xd29f}";
 }
 if ($_0x75ea > 0) {
 $_0xe659[] = "PGK: {$_0x75ea}";
 }
 if ($_0xb8d8 > 0) {
 $_0xe659[] = "Jodohkan: {$_0xb8d8}";
 }
 if ($_0xc1ea > 0) {
 $_0xe659[] = "Isian: {$_0xc1ea}";
 }
 if ($_0x714d > 0) {
 $_0xe659[] = "Uraian: {$_0x714d}";
 }
 $_0xa455["\x64\145\x74\141\x69\154\x73"] = implode("\x2c\40", $_0xe659);
 $this->logging->saveLog($this->LOG_TYPE->ADD, "\x4d\145\x6e\147\x69\155\x70\157\x72\40" . count($_0x6a9b) . "\x20\163\x6f\141\x6c\40\x28" . $_0xa455["\x64\145\x74\141\x69\154\x73"] . "\x29\40\x26\40\x53\151\x6e\153\x72\157\x6e\151\x73\141\x73\151\x20\153\x65\40\x55\152\x69\141\x6e\40\x53\151\x73\167\x61");
 }
 goto L_224dd;
 L_faeb4:
 $_0xdf15 = array_sum($_0x59a3);
 goto L_8669e;
 L_af4cd:
 $_0xc1ea = 0;
 goto L_84a65;
 L_268ae:
 $_0x49a2 = [];
 goto L_78280;
 L_52203:
 $_0xd29f = 0;
 goto L_8b98f;
 L_224dd:
 return $this->output_json($_0xa455);
 L_d2121:
 $_0xa455["\x74\157\x74\141\x6c"] = count($_0x6a9b);
 goto L_36ca0;
 L_36ca0:
 if (count($_0x6a9b) > 0) {
 $this->db->table("\x63\142\x74\137\x73\157\x61\154")->where("\x62\141\x6e\153\x5f\151\x64", $_0xd4db)->delete();
 $_0x1c21 = $this->db->table("\x63\142\x74\137\x73\157\x61\154")->insertBatch($_0x6a9b);
 $_0xa455["\x69\156\x73\145\x72\164"] = $_0x1c21 !== false ? $_0x1c21 : count($_0x6a9b);
 $_0xa455["\x73\164\x61\164\x75\163"] = true;
 $_0xa455["\x6d\145\x73\163\x61\147\x65"] = "\x53\157\x61\154\x20\142\x65\162\x68\141\x73\151\x6c\40\x64\151\x69\155\x70\157\x72\40\x64\141\x6e\40\x64\151\x73\151\x6d\160\x61\156\x20\153\x65\40\x64\141\x74\141\x62\141\x73\145\x2e";
 } else {
 $_0xa455["\x69\156\x73\145\x72\164"] = 0;
 $_0xa455["\x73\164\x61\164\x75\163"] = false;
 $_0xa455["\x6d\145\x73\163\x61\147\x65"] = "\x54\151\x64\141\x6b\40\x61\144\x61\40\x62\165\x74\151\x72\40\x73\157\x61\154\x20\171\x61\156\x67\40\x76\141\x6c\151\x64\40\x75\156\x74\165\x6b\40\x64\151\x73\151\x6d\160\x61\156\x2e\40\x50\141\x73\164\x69\153\x61\156\x20\146\x69\154\x65\40\x57\157\x72\144\x20\163\x65\163\x75\141\x69\40\x66\157\x72\155\x61\164\x20\164\x65\155\x70\154\x61\164\x65\56";
 }
 goto L_eaa93;
 L_5f7df:
 $_0x3259 = $this->db->table("\x63\142\x74\137\x62\141\x6e\153\x5f\163\x6f\141\x6c")->where("\x69\144\x5f\142\x61\156\x6b", $_0xd4db)->get()->getRow();
 goto L_162ac;
 L_8669e:
 $_0x1403 = ["\x31" => 0, "\x32" => 0, "\x33" => 0, "\x34" => 0, "\x35" => 0];
 goto L_a2c2d;
 L_d3fb5:
 $_0xf034 = function ($_0x6ed0) use ($_0x4cee) {
 if ($_0x6ed0 === null) {
 return '';
 }
 if (is_array($_0x6ed0)) {
 return $_0x6ed0;
 }
 $_0x1fb7 = (string) $_0x6ed0;
 return $_0x4cee ? $_0x1fb7 : rawurldecode($_0x1fb7);
 };
 goto L_52203;
 L_8b98f:
 $_0x75ea = 0;
 goto L_11c90;
 L_11c90:
 $_0xb8d8 = 0;
 goto L_af4cd;
 L_1a85d:
 $_0xfeae = $this->request->getPost("\x73\157\x61\154\x5f\152\x73\157\x6e");
 goto L_02501;
 L_162ac:
 $_0x59a3 = ["\x31" => (int) ($_0x3259->tampil_pg ?? 0), "\x32" => (int) ($_0x3259->tampil_kompleks ?? 0), "\x33" => (int) ($_0x3259->tampil_jodohkan ?? 0), "\x34" => (int) ($_0x3259->tampil_isian ?? 0), "\x35" => (int) ($_0x3259->tampil_esai ?? 0)];
 goto L_faeb4;
 L_84a65:
 $_0x714d = 0;
 goto L_268ae;
 }
 function isHtml($_0xa407)
 {
 $_0xa407 = ltrim($_0xa407);
 // Cek apakah string diawali dengan tag HTML
 return preg_match("\x2f\136\x3c\134\x73\52\x5c\167\x2b\56\x2a\77\x3e\57", $_0xa407) == 1;
 }
 function decode_data($_0xffaf, $_0xa6ef, $_0x7a4d, $_0xf2d4)
 {
 goto L_1b934;
 L_1b934:
 $_0xc6f5 = array("\x3c\41\x44\117\x43\124\x59\120\x45\40\x68\164\x6d\154\x3e", "\x3c\150\x74\155\x6c\76", "\x3c\142\x6f\144\x79\76", "\x3c\77\x78\155\x6c\40\x65\156\x63\157\x64\151\x6e\147\x3d\42\x55\124\x46\55\x38\42\x3e", "\x3c\41\x2d\55\x3f\170\x6d\154\x20\145\x6e\143\x6f\144\x69\156\x67\75\x22\125\x54\106\x2d\70\x22\55\x2d\76", "\x3c\155\x65\164\x61\40\x63\150\x61\162\x73\145\x74\75\x22\125\x54\106\x2d\70\x22\76", "\xd", "\xa");
 goto L_04cee;
 L_fad61:
 if (defined("\x4c\111\x42\130\x4d\114\x5f\116\x4f\116\x45\124")) {
 $_0xcbca |= LIBXML_NONET;
 }
 goto L_b7cb6;
 L_384d7:
 if ($_0xffaf == null || empty($_0xffaf)) {
 return '';
 }
 goto L_69bda;
 L_8e9c1:
 $_0x5720 = $_0x6a45->getElementsByTagName("\x69\155\x67");
 goto L_ab24c;
 L_5fb12:
 libxml_use_internal_errors(true);
 goto L_85ac5;
 L_69bda:
 // Jalur cepat: Jika tidak ada tag <img> atau data:image, lewati inisialisasi DOMDocument
 if (strpos($_0xffaf, "\x3c\151\x6d\147") === false && strpos($_0xffaf, "\x64\141\x74\141\x3a\151\x6d\141\x67\145") === false) {
 return str_replace($_0xc6f5, $_0xf08c, $_0xffaf);
 }
 goto L_26a63;
 L_04cee:
 $_0xf08c = array('', '', '', '', '', '');
 goto L_384d7;
 L_696cf:
 return str_replace($_0xc6f5, $_0xf08c, $_0xffaf ?? '');
 L_ab24c:
 if ($_0x5720 && $_0x5720->length > 0) {
 $_0x5b38 = 1;
 foreach ($_0x5720 as $_0x44d2) {
 $_0x318a = $_0x44d2->getAttribute("\x73\162\x63");
 if (substr($_0x318a, 0, 5) == "\x64\141\x74\141\x3a") {
 $_0x620f = $_0x44d2->getAttribute("\x73\162\x63");
 $_0xa32c = explode("\x2c", substr($_0x620f, 5), 2);
 $_0xa220 = $_0xa32c[0];
 $_0xc6d0 = $_0xa32c[1] ?? '';
 $_0x5ea2 = explode("\x3b", $_0xa220, 2);
 $_0xbf91 = explode("\x2f", $_0x5ea2[0], 2);
 if (count($_0xbf91) == 2 && !empty($_0xc6d0)) {
 $_0x4ee7 = $_0xbf91[1];
 if ($_0x4ee7 == "\x6a\160\x65\147") {
 $_0x4ee7 = "\x6a\160\x67";
 }
 try {
 $_0x5967 = random_bytes(10);
 } catch (Exception $_0x607f) {
 $_0x5967 = uniqid();
 }
 $_0x645a = "\x69\155\x67\137" . $_0xa6ef . $_0x7a4d . $_0xf2d4 . "\x5f" . bin2hex($_0x5967) . "\x2e" . $_0x4ee7;
 $_0x8eff = FCPATH . "\x75\160\x6c\157\x61\144\x73\57\x62\141\x6e\153\x5f\163\x6f\141\x6c\57";
 if (!is_dir($_0x8eff)) {
 @mkdir($_0x8eff, 0777, true);
 }
 file_put_contents($_0x8eff . $_0x645a, base64_decode($_0xc6d0));
 $_0x44d2->setAttribute("\x73\162\x63", "\x75\160\x6c\157\x61\144\x73\57\x62\141\x6e\153\x5f\163\x6f\141\x6c\57" . $_0x645a);
 $_0x5b38++;
 }
 } else {
 $_0x44d2->setAttribute("\x73\162\x63", str_replace(base_url(), '', $_0x318a ?? ''));
 }
 }
 $_0x8735 = $_0x6a45->saveHTML();
 libxml_clear_errors();
 return str_replace($_0xc6f5, $_0xf08c, $_0x8735 ?? '');
 }
 goto L_726b0;
 L_85ac5:
 // suppress warning
 $_0x6a45->preserveWhiteSpace = false;
 goto L_b465a;
 L_0f041:
 $_0xffaf = "\x3c\155\x65\164\x61\40\x63\150\x61\162\x73\145\x74\75\x22\125\x54\106\x2d\70\x22\76" . $_0xffaf;
 goto L_92d4e;
 L_b465a:
 $_0x6a45->formatOutput = true;
 goto L_0f041;
 L_b7cb6:
 $_0x6a45->loadHTML("\x3c\41\x44\117\x43\124\x59\120\x45\40\x68\164\x6d\154\x3e\74\x68\164\x6d\154\x3e\74\x62\157\x64\171\x3e\74\x3f\170\x6d\154\x20\145\x6e\143\x6f\144\x69\156\x67\75\x22\125\x54\106\x2d\70\x22\76" . $_0xffaf, $_0xcbca);
 goto L_8e9c1;
 L_726b0:
 libxml_clear_errors();
 goto L_696cf;
 L_92d4e:
 $_0xcbca = LIBXML_HTML_NODEFDTD | LIBXML_HTML_NOIMPLIED;
 goto L_fad61;
 L_26a63:
 $_0x6a45 = new \DOMDocument();
 goto L_5fb12;
 }
 private function generateUniqueId($_0x7cc6 = 4)
 {
 goto L_06a1b;
 L_f0784:
 /*
 * // Contoh penggunaan:
 $id3 = generateUniqueId();
 $id4 = generateUniqueId();
 echo "ID 3 (lebih aman): " . $id3 . "\n";
 echo "ID 4 (lebih aman): " . $id4 . "\n";
 */
 L_4406c:
 $_0x9798 = strlen($_0x2c65);
 goto L_318ea;
 L_4c5c9:
 try {
 $_0x57bc = random_bytes($_0x7cc6);
 for ($_0xab54 = 0; $_0xab54 < $_0x7cc6; $_0xab54++) {
 $_0x887a .= $_0x2c65[ord($_0x57bc[$_0xab54]) % $_0x9798];
 }
 } catch (Exception $_0x7964) {
 for ($_0xab54 = 0; $_0xab54 < $_0x7cc6; $_0xab54++) {
 $_0x887a .= $_0x2c65[mt_rand(0, $_0x9798 - 1)];
 }
 }
 goto L_49250;
 L_49250:
 return $_0x887a;
 L_318ea:
 $_0x887a = '';
 goto L_4c5c9;
 L_06a1b:
 $_0x2c65 = "\x30\61\x32\63\x34\65\x36\67\x38\71\x61\142\x63\144\x65\146\x67\150\x69\152\x6b\154\x6d\156\x6f\160\x71\162\x73\164\x75\166\x77\170\x79\172\x41\102\x43\104\x45\106\x47\110\x49\112\x4b\114\x4d\116\x4f\120\x51\122\x53\124\x55\126\x57\130\x59\132";
 goto L_4406c;
 }
}