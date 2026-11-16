<?php
/*   ________________________________________
    |               NextGen Garuda CBT       |
    |    Protected & Distributed via GitHub  |
    |________________________________________|
*/
namespace App\Controllers;

use App\Models\CbtModel;
use App\Models\DashboardModel;
class CbtToken extends BaseController
{
 protected $cbt;
 protected $dashboard;
 public function __construct()
 {
 $this->cbt = new CbtModel();
 $this->dashboard = new DashboardModel();
 }
 private function getToken()
 {
 goto L_da205;
 L_da205:
 $_0xc5a9 = \Config\Database::connect();
 goto L_9c0a8;
 L_ed075:
 return $_0xb047;
 L_9c0a8:
 $_0xb047 = $_0xc5a9->table("\x63\142\x74\137\x74\157\x6b\145\x6e")->orderBy("\x69\144\x5f\164\x6f\153\x65\156", "\x41\123\x43")->get()->getRow();
 goto L_f2637;
 L_f2637:
 if (!$_0xb047) {
 $_0xe75a = ["\x74\157\x6b\145\x6e" => $this->createNewToken(), "\x61\165\x74\157" => "\x30", "\x6a\141\x72\141\x6b" => "\x31\65", "\x75\160\x64\141\x74\145\x64" => date("\x59\55\x6d\55\x64\40\x48\72\x69\72\x73")];
 $_0xc5a9->table("\x63\142\x74\137\x74\157\x6b\145\x6e")->insert($_0xe75a);
 $_0xb047 = $_0xc5a9->table("\x63\142\x74\137\x74\157\x6b\145\x6e")->orderBy("\x69\144\x5f\164\x6f\153\x65\156", "\x41\123\x43")->get()->getRow() ?: (object) $_0xe75a;
 }
 goto L_ed075;
 }
 private function saveToken($_0xa94e)
 {
 goto L_c0dd1;
 L_103b5:
 $_0xd492 = array_intersect_key($_0xb808, array_flip($_0x65ac));
 goto L_16176;
 L_e29a9:
 if ($_0x760f) {
 $_0x332a = $_0xbc75->table("\x63\142\x74\137\x74\157\x6b\145\x6e");
 if (isset($_0x760f->id_token)) {
 $_0x332a->where("\x69\144\x5f\164\x6f\153\x65\156", $_0x760f->id_token);
 }
 return $_0x332a->update($_0xd492);
 } else {
 return $_0xbc75->table("\x63\142\x74\137\x74\157\x6b\145\x6e")->insert($_0xd492);
 }
 L_16176:
 if (isset($_0xd492["\x74\157\x6b\145\x6e"])) {
 $_0xd492["\x74\157\x6b\145\x6e"] = strtoupper(preg_replace("\x2f\133\x5c\163\x5c\170\x7b\62\x30\60\x42\175\x2d\134\x78\173\x32\60\x30\104\x7d\134\x78\173\x46\105\x46\106\x7d\135\x2b\57\x75", '', (string) $_0xd492["\x74\157\x6b\145\x6e"]));
 }
 goto L_1f478;
 L_c0dd1:
 $_0xbc75 = \Config\Database::connect();
 goto L_39a3d;
 L_18283:
 $_0x760f = $_0xbc75->table("\x63\142\x74\137\x74\157\x6b\145\x6e")->orderBy("\x69\144\x5f\164\x6f\153\x65\156", "\x41\123\x43")->get()->getRow();
 goto L_e29a9;
 L_41ec9:
 if (isset($_0xd492["\x6a\141\x72\141\x6b"])) {
 $_0xd492["\x6a\141\x72\141\x6b"] = max(1, (int) $_0xd492["\x6a\141\x72\141\x6b"]);
 }
 goto L_18283;
 L_1f478:
 if (isset($_0xd492["\x61\165\x74\157"])) {
 $_0xd492["\x61\165\x74\157"] = (int) $_0xd492["\x61\165\x74\157"];
 }
 goto L_41ec9;
 L_39a3d:
 $_0xb808 = json_decode(json_encode($_0xa94e), true);
 goto L_fc7da;
 L_fc7da:
 $_0x65ac = ["\x74\157\x6b\145\x6e", "\x61\165\x74\157", "\x6a\141\x72\141\x6b", "\x75\160\x64\141\x74\145\x64"];
 goto L_103b5;
 }
 protected function createNewToken()
 {
 goto L_ab008;
 L_5d490:
 $_0x5fba = '';
 goto L_58187;
 L_ab008:
 $_0x4a4c = "\x41\102\x43\104\x45\106\x47\110\x49\112\x4b\114\x4d\116\x4f\120\x51\122\x53\124\x55\126\x57\130\x59\132";
 goto L_5d490;
 L_cad19:
 return $_0x5fba;
 L_58187:
 for ($_0xe005 = 0; $_0xe005 < 6; $_0xe005++) {
 $_0x5fba .= $_0x4a4c[mt_rand(0, strlen($_0x4a4c) - 1)];
 }
 goto L_cad19;
 }
 protected function getValidToken($_0x3eaa = 0)
 {
 goto L_73c7d;
 L_73c7d:
 $_0x58d7 = $this->getToken();
 goto L_80f2d;
 L_c10f0:
 if ((string) ($_0x58d7->auto ?? "\x30") === "\x31" && (int) $_0x3eaa > 0) {
 try {
 $_0xfad8 = new \DateTime($_0x58d7->updated ?? $_0x610b);
 $_0x9bb4 = new \DateTime($_0x610b);
 $_0x4cee = $_0xfad8->diff($_0x9bb4);
 $_0xfe59 = $_0x4cee->days * 24 * 60 + $_0x4cee->h * 60 + $_0x4cee->i;
 $_0xab1e = isset($_0x58d7->jarak) ? (int) $_0x58d7->jarak : 15;
 if ($_0xab1e < 1) {
 $_0xab1e = 15;
 }
 if ($_0x4cee->invert === 0 && $_0xfe59 >= $_0xab1e) {
 $_0x58d7->token = $this->createNewToken();
 $_0x58d7->updated = $_0x610b;
 $this->saveToken($_0x58d7);
 }
 } catch (\Throwable $_0xf6f2) {
 // Pertahankan token existing bila parsing tanggal bermasalah
 }
 }
 goto L_03742;
 L_80f2d:
 $_0x610b = date("\x59\55\x6d\55\x64\40\x48\72\x69\72\x73");
 goto L_c10f0;
 L_81608:
 return $_0x58d7;
 L_03742:
 $_0x58d7 = $this->getToken();
 goto L_b6e7b;
 L_b6e7b:
 $_0x58d7->now = $_0x610b;
 goto L_81608;
 }
 public function index()
 {
 goto L_b173e;
 L_8e78f:
 if (!$_0xba78->get("\x69\163\x5f\154\x6f\147\x69\156")) {
 return redirect()->to("\x61\165\x74\150\x2f\154\x6f\147\x69\156");
 } elseif (!((string) $_0xba78->get("\x72\157\x6c\145") === "\x31")) {
 return redirect()->to("\x64\141\x73\150\x62\157\x61\162\x64")->with("\x65\162\x72\157\x72", "\x48\141\x6e\171\x61\40\x41\144\x6d\151\x6e\151\x73\164\x72\141\x74\157\x72\40\x79\141\x6e\147\x20\144\x69\142\x65\162\x69\40\x68\141\x6b\40\x75\156\x74\165\x6b\40\x6d\145\x6e\147\x61\153\x73\145\x73\40\x68\141\x6c\141\x6d\141\x6e\40\x69\156\x69");
 }
 goto L_5322a;
 L_4f6dc:
 $_0x940f = $this->dashboard->getTahunActive();
 goto L_4207e;
 L_0bfc8:
 $_0x5d17["\x74\160\x5f\141\x63\164\x69\166\x65"] = $_0x940f;
 goto L_157ab;
 L_7c24c:
 $_0x5d17["\x73\155\x74\137\x61\143\x74\151\x76\145"] = $_0x65a8;
 goto L_ed6fa;
 L_94fbc:
 $_0x5d17["\x74\157\x6b\145\x6e"] = $this->getValidToken($_0x3a8a);
 goto L_be182;
 L_3fc59:
 $_0x5d17["\x61\144\x61\137\x75\152\x69\141\x6e"] = $_0x3a8a;
 goto L_94fbc;
 L_e48b9:
 $_0x5d17["\x74\160"] = $this->dashboard->getTahun();
 goto L_0bfc8;
 L_be182:
 return view("\x63\142\x74\57\x74\157\x6b\145\x6e\57\x64\141\x74\141", $_0x5d17);
 L_5322a:
 $_0xc435 = (object) ["\x69\144" => $_0xba78->get("\x69\144\x5f\165\x73\145\x72"), "\x66\151\x72\163\x74\137\x6e\141\x6d\145" => $_0xba78->get("\x75\163\x65\162\x6e\141\x6d\145"), "\x72\157\x6c\145\x5f\156\x61\155\x65" => $_0xba78->get("\x72\157\x6c\145\x5f\156\x61\155\x65"), "\x66\157\x74\157" => $_0xba78->get("\x66\157\x74\157") ?? ''];
 goto L_54d1f;
 L_4207e:
 $_0x65a8 = $this->dashboard->getSemesterActive();
 goto L_e48b9;
 L_157ab:
 $_0x5d17["\x73\155\x74"] = $this->dashboard->getSemester();
 goto L_7c24c;
 L_ed6fa:
 $_0x8255 = $this->cbt->getDataJadwalByTgl(date("\x59\55\x6d\55\x64"));
 goto L_ef846;
 L_ef846:
 $_0x3a8a = is_array($_0x8255) ? count($_0x8255) : 0;
 goto L_3fc59;
 L_b173e:
 $_0xba78 = session();
 goto L_8e78f;
 L_dd4f0:
 $_0x5d17 = ["\x75\163\x65\162" => $_0xc435, "\x6a\165\x64\165\x6c" => "\x54\157\x6b\145\x6e\40\x55\152\x69\141\x6e", "\x73\165\x62\152\x75\144\x75\154" => "\x54\157\x6b\145\x6e", "\x73\145\x74\164\x69\156\x67" => $_0xa2a0];
 goto L_4f6dc;
 L_54d1f:
 $_0xa2a0 = $this->dashboard->getSetting();
 goto L_dd4f0;
 }
 public function generateToken()
 {
 goto L_c4d38;
 L_c1bfd:
 $_0x438d = $this->getToken();
 goto L_bf886;
 L_9ae81:
 $_0xc667 = (string) ($this->request->getVar("\x61\143\x74\151\x6f\156") ?? $this->request->getVar("\x73\157\x75\162\x63\145") ?? '');
 goto L_92c7e;
 L_4f289:
 $_0x7b9b = $this->cbt->getDataJadwalByTgl(date("\x59\55\x6d\55\x64"));
 goto L_66da2;
 L_56389:
 $_0x1157 = (string) ($this->request->getVar("\x63\165\x73\164\x6f\155") ?? '');
 goto L_0d5cb;
 L_c0730:
 return $this->response->setJSON($_0x438d);
 L_bf886:
 $_0x438d->now = date("\x59\55\x6d\55\x64\40\x48\72\x69\72\x73");
 goto L_83684;
 L_0d5cb:
 $_0x1cca = $this->request->getVar("\x64\141\x74\141");
 goto L_143c8;
 L_2675a:
 $_0x1de6 = $this->getToken();
 goto L_aa120;
 L_83684:
 $_0x438d->ada_ujian = $_0x2391;
 goto L_c0730;
 L_aa120:
 $_0x243a = date("\x59\55\x6d\55\x64\40\x48\72\x69\72\x73");
 goto L_4f289;
 L_bec9b:
 $_0xf48a = (string) $_0x34b1->get("\x72\157\x6c\145");
 goto L_66aa4;
 L_c4d38:
 $_0x34b1 = session();
 goto L_bec9b;
 L_d767d:
 // 1. Simpan Pengaturan Interval / Status Otomatis (hanya Admin/Staff)
 if ($_0xc667 === "\x73\151\x6d\160\x61\156") {
 if (!($_0xf48a === "\x31")) {
 return $this->response->setStatusCode(403)->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x48\141\x6e\171\x61\40\x41\144\x6d\151\x6e\151\x73\164\x72\141\x74\157\x72\40\x79\141\x6e\147\x20\144\x61\160\x61\164\x20\155\x65\156\x67\165\x62\141\x68\40\x70\145\x6e\147\x61\164\x75\162\x61\156\x20\164\x6f\153\x65\156"]);
 }
 $_0x922f = $this->request->getVar("\x61\165\x74\157");
 $_0x1075 = $this->request->getVar("\x6a\141\x72\141\x6b");
 $_0x5e5c = $_0x922f !== null ? (string) $_0x922f : (string) ($_0x4298->auto ?? $_0x1de6->auto ?? "\x30");
 $_0xac54 = $_0x1075 !== null ? (int) $_0x1075 : (int) ($_0x4298->jarak ?? $_0x1de6->jarak ?? 15);
 $_0x1de6->auto = $_0x5e5c === "\x31" ? "\x31" : "\x30";
 $_0x1de6->jarak = (string) max(1, $_0xac54);
 // Pertahankan token yang sedang aktif agar siswa tidak gagal validasi mendadak
 $_0x1de6->updated = $_0x243a;
 $this->saveToken($_0x1de6);
 } elseif ($_0x10a1 === "\x31") {
 if (!($_0xf48a === "\x31")) {
 return $this->response->setStatusCode(403)->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x48\141\x6e\171\x61\40\x41\144\x6d\151\x6e\151\x73\164\x72\141\x74\157\x72\40\x79\141\x6e\147\x20\144\x61\160\x61\164\x20\155\x65\156\x67\147\x65\156\x65\162\x61\164\x65\40\x74\157\x6b\145\x6e\40\x6d\141\x6e\165\x61\154"]);
 }
 $_0x97cc = strtoupper(preg_replace("\x2f\133\x5c\163\x5c\170\x7b\62\x30\60\x42\175\x2d\134\x78\173\x32\60\x30\104\x7d\134\x78\173\x46\105\x46\106\x7d\135\x2b\57\x75", '', $_0x1157));
 $_0x1de6->token = $_0x97cc !== '' ? $_0x97cc : $this->createNewToken();
 $_0x1de6->updated = $_0x243a;
 $this->saveToken($_0x1de6);
 } else if ((string) ($_0x1de6->auto ?? "\x30") === "\x31" && $_0x2391 > 0) {
 try {
 $_0x69a1 = new \DateTime($_0x1de6->updated ?? $_0x243a);
 $_0x767c = new \DateTime($_0x243a);
 $_0x469e = $_0x69a1->diff($_0x767c);
 $_0xe3e9 = $_0x469e->days * 24 * 60 + $_0x469e->h * 60 + $_0x469e->i;
 $_0x9358 = isset($_0x1de6->jarak) ? (int) $_0x1de6->jarak : 15;
 if ($_0x9358 < 1) {
 $_0x9358 = 15;
 }
 if ($_0x469e->invert === 0 && $_0xe3e9 >= $_0x9358) {
 $_0x1de6->token = $this->createNewToken();
 $_0x1de6->updated = $_0x243a;
 $this->saveToken($_0x1de6);
 }
 } catch (\Throwable $_0x20ba) {
 // Jangan overwrite token bila terjadi kesalahan tanggal
 }
 }
 goto L_c1bfd;
 L_143c8:
 $_0x4298 = is_string($_0x1cca) ? json_decode($_0x1cca) : (is_array($_0x1cca) || is_object($_0x1cca) ? (object) $_0x1cca : null);
 goto L_2675a;
 L_66da2:
 $_0x2391 = is_array($_0x7b9b) ? count($_0x7b9b) : 0;
 goto L_d767d;
 L_92c7e:
 $_0x10a1 = (string) ($this->request->getVar("\x66\157\x72\143\x65") ?? "\x30");
 goto L_56389;
 L_66aa4:
 if (!$_0x34b1->get("\x69\163\x5f\154\x6f\147\x69\156") || !in_array($_0xf48a, ["\x31", "\x32"], true)) {
 return $this->response->setStatusCode(403)->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x41\153\x73\145\x73\40\x64\151\x74\157\x6c\141\x6b"]);
 }
 goto L_9ae81;
 }
 public function loadToken()
 {
 goto L_38ecc;
 L_e37dc:
 $_0xa2df = $this->getValidToken($_0x3b6d);
 goto L_02efb;
 L_acb5f:
 return $this->response->setJSON($_0xa2df);
 L_efbb3:
 $_0x3b6d = is_array($_0xb3a5) ? count($_0xb3a5) : 0;
 goto L_e37dc;
 L_02efb:
 $_0xa2df->ada_ujian = $_0x3b6d;
 goto L_acb5f;
 L_38ecc:
 $_0xb3a5 = $this->cbt->getDataJadwalByTgl(date("\x59\55\x6d\55\x64"));
 goto L_efbb3;
 }
 public function checkTokenJadwal()
 {
 goto L_eb096;
 L_e2dc9:
 return $this->response->setJSON(["\x74\157\x6b\145\x6e" => $_0xd2b5, "\x61\144\x61\137\x75\152\x69\141\x6e" => $_0xa264]);
 L_85236:
 $_0xd2b5 = $this->getValidToken($_0xa264);
 goto L_e2dc9;
 L_9d877:
 $_0xa264 = is_array($_0xcd14) ? count($_0xcd14) : 0;
 goto L_85236;
 L_eb096:
 $_0xcd14 = $this->cbt->getDataJadwalByTgl(date("\x59\55\x6d\55\x64"));
 goto L_9d877;
 }
}