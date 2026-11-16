<?php
/*   ________________________________________
    |               NextGen Garuda CBT       |
    |    Protected & Distributed via GitHub  |
    |________________________________________|
*/
/**
 * Created by IntelliJ IDEA.
 * User: Hidayatur Rohman
 * Date: 07/07/20
 * Time: 14:24
 */
namespace App\Controllers;

use CodeIgniter\Controller;
class Cbtnilai extends BaseController
{
 public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $_0xe10c)
 {
 parent::initController($request, $response, $_0xe10c);
 }
 /**
 * @throws JsonException
 */
 public function index()
 {
 goto L_d28fa;
 L_6a185:
 $_0x14b3 = $this->getTpSmt();
 goto L_724be;
 L_6ff27:
 $_0xde49["\x6b\145\x6c\141\x73\137\x73\145\x6c\145\x63\164\x65\144"] = $_0x25e0;
 goto L_09e89;
 L_ec5da:
 if ((string) session()->get("\x72\157\x6c\145") === "\x31") {
 // Admin & Staff
 $_0xde49["\x6b\145\x6c\141\x73"] = (new \App\Models\DropdownModel())->getAllKelas($_0x8d7f->id_tp, $_0x8974->id_smt);
 return view("\x63\142\x74\57\x6e\151\x6c\141\x69\57\x64\141\x74\141\x5f\156\x69\154\x61\151", $_0xde49);
 } else {
 // Guru
 $_0x2b57 = (new \App\Models\CbtModel())->getJadwalGuru($_0x8d7f->id_tp, $_0x8974->id_smt, $_0xa5a4);
 $_0x593b = [];
 foreach ($_0x2b57 as $_0xbbc2) {
 $_0x71dd = $this->maybe_unserialize($_0xbbc2->bank_kelas ?? []);
 foreach ($_0x71dd as $_0xa953) {
 if (is_array($_0xa953)) {
 $_0x593b[] = $_0xa953["\x6b\145\x6c\141\x73\137\x69\144"];
 } elseif (is_object($_0xa953)) {
 $_0x593b[] = $_0xa953->kelas_id;
 }
 }
 }
 $_0xde49["\x6b\145\x6c\141\x73"] = count($_0x593b) > 0 ? (new \App\Models\DropdownModel())->getNamaKelasByArrId($_0x8d7f->id_tp, $_0x8974->id_smt, $_0x593b) : [];
 return view("\x63\142\x74\57\x6e\151\x6c\141\x69\57\x64\141\x74\141\x5f\156\x69\154\x61\151", $_0xde49);
 }
 L_724be:
 $_0x8d7f = $_0x14b3->tp_active;
 goto L_df066;
 L_f0cb4:
 $_0xcaa5 = $this->request->getGet("\x79\142");
 goto L_449dd;
 L_90f47:
 $_0x80c2 = $this->request->getGet("\x78\142");
 goto L_f8ed0;
 L_b6390:
 $_0x3173 = $this->request->getGet("\x79\141");
 goto L_f0cb4;
 L_f8ed0:
 if (session()->get("\x72\157\x6c\145") == 2) {
 $_0xa06f = (new \App\Models\DashboardModel())->getDataGuruByUserId($_0x5069->id, $_0x8d7f->id_tp, $_0x8974->id_smt);
 $_0xde49["\x67\165\x72\165"] = $_0xa06f;
 $_0xb53d = ["\x69\144\x5f\164\x70" => $_0x8d7f->id_tp, "\x69\144\x5f\163\x6d\164" => $_0x8974->id_smt, "\x62\141\x6e\153\x5f\147\x75\162\x75\137\x69\144" => $_0xa06f->id_guru];
 $_0xa5a4 = $_0xa06f->id_guru;
 } else {
 $_0xb53d = ["\x69\144\x5f\164\x70" => $_0x8d7f->id_tp, "\x69\144\x5f\163\x6d\164" => $_0x8974->id_smt];
 $_0xa5a4 = null;
 }
 goto L_e4d1e;
 L_09e89:
 $_0xde49["\x6a\141\x64\167\x61\154\x5f\163\x65\154\x65\143\x74\145\x64"] = $_0xe9d9;
 goto L_b6390;
 L_f5584:
 $_0xde49["\x73\155\x74\137\x61\143\x74\151\x76\145"] = $_0x8974;
 goto L_0a8e8;
 L_df066:
 $_0x8974 = $_0x14b3->smt_active;
 goto L_3f770;
 L_449dd:
 $_0x72a2 = $this->request->getGet("\x78\141");
 goto L_90f47;
 L_f91b3:
 $_0xde49 = ["\x75\163\x65\162" => $_0x5069, "\x6a\165\x64\165\x6c" => "\x48\141\x73\151\x6c\40\x55\152\x69\141\x6e\40\x53\151\x73\167\x61", "\x73\165\x62\152\x75\144\x75\154" => "\x4e\151\x6c\141\x69\40\x53\151\x73\167\x61", "\x73\145\x74\164\x69\156\x67" => (new \App\Models\DashboardModel())->getSetting()];
 goto L_6a185;
 L_e4d1e:
 if ($_0xe9d9 !== null) {
 if ($_0x3173 != null) {
 $_0x8366 = ["\x79\141" => $_0x3173, "\x79\142" => $_0xcaa5, "\x78\141" => $_0x72a2, "\x78\142" => $_0x80c2];
 $_0xde49["\x63\157\x6e\166\x65\162\x74"] = $_0x8366;
 }
 $_0xd7d1 = \Config\Database::connect()->table("\x63\142\x74\137\x6a\141\x64\167\x61\154\x20\152");
 $_0xd7d1->select("\x6a\56\x69\144\x5f\152\x61\144\x77\141\x6c\54\x20\152\x2e\151\x64\137\x74\160\x2c\40\x6a\56\x69\144\x5f\163\x6d\164\x2c\40\x6a\56\x69\144\x5f\142\x61\156\x6b\54\x20\152\x2e\151\x64\137\x6a\145\x6e\151\x73\54\x20\142\x2e\142\x61\156\x6b\137\x6b\157\x64\145\x2c\40\x62\56\x62\141\x6e\153\x5f\153\x65\154\x61\163\x2c\40\x6d\56\x6b\157\x64\145\x20\141\x73\40\x6d\141\x70\145\x6c\137\x6b\157\x64\145\x2c\40\x6d\56\x6e\141\x6d\141\x5f\155\x61\160\x65\154\x20\141\x73\40\x6d\141\x70\145\x6c\137\x6e\141\x6d\141\x5f\155\x61\160\x65\154");
 $_0xd7d1->join("\x63\142\x74\137\x62\141\x6e\153\x5f\163\x6f\141\x6c\40\x62", "\x6a\56\x69\144\x5f\142\x61\156\x6b\40\x3d\40\x62\56\x69\144\x5f\142\x61\156\x6b", "\x69\156\x6e\145\x72");
 $_0xd7d1->join("\x6d\141\x73\164\x65\162\x5f\155\x61\160\x65\154\x20\155", "\x62\56\x62\141\x6e\153\x5f\155\x61\160\x65\154\x5f\151\x64\40\x3d\40\x6d\56\x69\144\x5f\155\x61\160\x65\154", "\x69\156\x6e\145\x72");
 $_0xd7d1->where("\x6a\56\x69\144\x5f\164\x70", $_0x8d7f->id_tp);
 $_0xd7d1->where("\x6a\56\x69\144\x5f\163\x6d\164", $_0x8974->id_smt);
 if ($_0xa5a4 !== null) {
 $_0xd7d1->where("\x62\56\x62\141\x6e\153\x5f\147\x75\162\x75\137\x69\144", $_0xa5a4);
 }
 $_0xffbc = $_0xd7d1->get()->getResult();
 $_0x2e8d = [];
 foreach ($_0xffbc as $_0xb186) {
 $_0x71dd = $this->maybe_unserialize($_0xb186->bank_kelas ?? []);
 foreach ($_0x71dd as $_0xa953) {
 $_0xa528 = is_array($_0xa953) ? $_0xa953["\x6b\145\x6c\141\x73\137\x69\144"] ?? $_0xa953[0] ?? null : (is_object($_0xa953) ? $_0xa953->kelas_id ?? null : $_0xa953);
 if ($_0xa528 !== null && $_0xa528 == $_0x25e0) {
 $_0x2e8d[$_0xb186->id_jadwal] = $_0xb186->mapel_kode . "\x20\50" . $_0xb186->bank_kode . "\x29";
 }
 }
 }
 $_0xde49["\x6a\141\x64\167\x61\154"] = $_0x2e8d;
 } else {
 $_0xde49["\x6a\141\x64\167\x61\154"] = [];
 $_0xde49["\x6e\151\x6c\141\x69"] = [];
 }
 goto L_a3ac3;
 L_b694a:
 $_0xe9d9 = $this->request->getGet("\x69\144\x5f\152\x61\144\x77\141\x6c");
 goto L_6ff27;
 L_9c8d8:
 $_0xde49["\x73\155\x74"] = $_0x14b3->smt;
 goto L_8f245;
 L_a3ac3:
 $_0xde49["\x74\160\x5f\152\x61\144\x77\141\x6c"] = $_0x8d7f->tahun;
 goto L_ec5da;
 L_3f770:
 $_0xde49["\x74\160"] = $_0x14b3->tp;
 goto L_9c8d8;
 L_8f245:
 $_0xde49["\x74\160\x5f\141\x63\164\x69\166\x65"] = $_0x8d7f;
 goto L_f5584;
 L_d28fa:
 $_0x5069 = (object) ["\x69\144" => session()->get("\x69\144\x5f\165\x73\145\x72"), "\x75\163\x65\162\x6e\141\x6d\145" => session()->get("\x75\163\x65\162\x6e\141\x6d\145")];
 goto L_f91b3;
 L_0a8e8:
 $_0x25e0 = $this->request->getGet("\x69\144\x5f\153\x65\154\x61\163");
 goto L_b694a;
 }
 public function get_nilai_siswa()
 {
 goto L_80951;
 L_b1b65:
 return $this->response->setJSON($_0xebdf);
 L_1da54:
 $_0xebdf["\x6b\145\x6c\141\x73"] = (new \App\Models\DropdownModel())->getAllKelas($_0x9362->id_tp, $_0x1b19->id_smt);
 goto L_3dcad;
 L_83704:
 $_0xebdf["\x6a\141\x64\167\x61\154\x5f\163\x65\154\x65\143\x74\145\x64"] = $_0xb5f3;
 goto L_bd389;
 L_b8e02:
 $_0xebdf["\x6b\145\x6c\141\x73\137\x73\145\x6c\145\x63\164\x65\144"] = $_0x1b2b;
 goto L_83704;
 L_3dcad:
 $_0xebdf["\x6a\141\x64\167\x61\154"] = $_0x4d2c;
 goto L_b8e02;
 L_80951:
 $_0x1b2b = $this->request->getPost("\x69\144\x5f\153\x65\154\x61\163") ?? $this->request->getPost("\x6b\145\x6c\141\x73") ?? $this->request->getVar("\x69\144\x5f\153\x65\154\x61\163");
 goto L_ca9e1;
 L_67326:
 $_0x619e = $this->getTpSmt();
 goto L_c8fe6;
 L_fbf43:
 $_0x4d2c = $this->olah_nilai(1, $_0x9362->id_tp, $_0x1b19->id_smt, $_0x1b2b, $_0xb5f3, true);
 goto L_13894;
 L_bd389:
 $_0xebdf["\x73\165\x63\143\x65\163\x73"] = true;
 goto L_b1b65;
 L_d996f:
 $_0xebdf["\x74\160"] = $_0x619e->tp;
 goto L_560b9;
 L_5b11d:
 $_0xebdf["\x74\160\x5f\152\x61\144\x77\141\x6c"] = $_0x9362->tahun;
 goto L_fbf43;
 L_beac7:
 $_0xebdf["\x74\160\x5f\141\x63\164\x69\166\x65"] = $_0x9362;
 goto L_ab138;
 L_4ff60:
 $_0x1b19 = $_0x619e->smt_active;
 goto L_d996f;
 L_c8fe6:
 $_0x9362 = $_0x619e->tp_active;
 goto L_4ff60;
 L_13894:
 if ($_0x4d2c !== null) {
 if (isset($_0x4d2c->sesisiswa)) {
 $_0x4d2c->sesisiswa = is_array($_0x4d2c->sesisiswa) ? array_values($_0x4d2c->sesisiswa) : (is_object($_0x4d2c->sesisiswa) ? array_values((array) $_0x4d2c->sesisiswa) : []);
 }
 if (is_object($_0x4d2c)) {
 unset($_0x4d2c->soal_kompleks, $_0x4d2c->soal_jodohkan, $_0x4d2c->soal_isian, $_0x4d2c->soal_esai);
 } elseif (is_array($_0x4d2c)) {
 unset($_0x4d2c["\x73\157\x61\154\x5f\153\x6f\155\x70\154\x65\153\x73"], $_0x4d2c["\x73\157\x61\154\x5f\152\x6f\144\x6f\150\x6b\141\x6e"], $_0x4d2c["\x73\157\x61\154\x5f\151\x73\151\x61\156"], $_0x4d2c["\x73\157\x61\154\x5f\145\x73\141\x69"]);
 }
 }
 goto L_1da54;
 L_ca9e1:
 $_0xb5f3 = $this->request->getPost("\x69\144\x5f\152\x61\144\x77\141\x6c") ?? $this->request->getPost("\x6a\141\x64\167\x61\154") ?? $this->request->getVar("\x69\144\x5f\152\x61\144\x77\141\x6c");
 goto L_67326;
 L_ab138:
 $_0xebdf["\x73\155\x74\137\x61\143\x74\151\x76\145"] = $_0x1b19;
 goto L_5b11d;
 L_560b9:
 $_0xebdf["\x73\155\x74"] = $_0x619e->smt;
 goto L_beac7;
 }
 public function save_pengurangan()
 {
 goto L_c1697;
 L_b41e4:
 $_0x82ae["\x63\142\x74"] = $_0x67c2;
 goto L_30a1a;
 L_53cd2:
 $_0xf030 = [];
 goto L_78352;
 L_c1697:
 $_0x678e = \Config\Database::connect();
 goto L_3020c;
 L_939c7:
 $_0x76a4 = [];
 goto L_b475b;
 L_4df34:
 $_0xf75f = array_column($_0x3a72, "\x69\144\x5f\163\x69\163\x77\141");
 goto L_4311b;
 L_5a4ce:
 $_0xda9e = false;
 goto L_7efcb;
 L_9cdfb:
 return $this->response->setJSON($_0x82ae);
 L_4311b:
 if (empty($_0xf75f)) {
 return $this->response->setJSON(["\x73\165\x63\143\x65\163\x73" => false, "\x6d\145\x73\163\x61\147\x65" => "\x54\151\x64\141\x6b\40\x61\144\x61\40\x73\151\x73\167\x61\40\x74\145\x72\160\x69\154\x69\150"]);
 }
 goto L_9fe80;
 L_78352:
 foreach ($_0xae33 as $_0x72f3) {
 $_0x7f08 = $_0x72f3->id_siswa;
 if (isset($_0xc811[$_0x7f08])) {
 $_0xb274 = $_0xc811[$_0x7f08];
 $_0x67c2[] = ["\x69\144\x5f\143\x62\164\x5f\163\x69\163\x77\141" => $_0xb274->id_cbt_siswa, "\x70\145\x6c\141\x6e\147\x67\141\x72\141\x6e" => json_encode($_0x72f3->pelanggaran)];
 }
 if (isset($_0x76a4[$_0x7f08])) {
 $_0xecf7 = $_0x76a4[$_0x7f08];
 $_0xf030[] = ["\x69\144\x5f\162\x65\153\x61\160\x5f\163\x69\163\x77\141" => $_0xecf7->id_rekap_siswa, "\x70\145\x6c\141\x6e\147\x67\141\x72\141\x6e" => json_encode($_0x72f3->pelanggaran)];
 }
 }
 goto L_5a4ce;
 L_30a1a:
 $_0x82ae["\x72\145\x6b\141\x70"] = $_0xf030;
 goto L_4917d;
 L_7efcb:
 $_0xb0bc = false;
 goto L_56963;
 L_b2798:
 $_0x67c2 = [];
 goto L_53cd2;
 L_a70a8:
 $_0x3a72 = json_decode($this->request->getPost("\x69\144\x5f\163\x69\163\x77\141"), true) ?: [];
 goto L_358aa;
 L_b475b:
 foreach ($_0xcab4 as $_0x9fc2) {
 $_0x76a4[$_0x9fc2->id_siswa] = $_0x9fc2;
 }
 goto L_b2798;
 L_dbf30:
 $_0xcab4 = $_0x678e->table("\x63\142\x74\137\x72\145\x6b\141\x70\137\x73\151\x73\167\x61")->select("\x69\144\x5f\162\x65\153\x61\160\x5f\163\x69\163\x77\141\x2c\151\x64\137\x73\151\x73\167\x61\54\x69\144\x5f\152\x61\144\x77\141\x6c\54\x70\145\x6c\141\x6e\147\x67\141\x72\141\x6e")->whereIn("\x69\144\x5f\163\x69\163\x77\141", $_0xf75f)->where("\x69\144\x5f\152\x61\144\x77\141\x6c", $_0xec44)->get()->getResult();
 goto L_939c7;
 L_533fd:
 if (count($_0xf030) > 0) {
 $_0xb0bc = $_0x678e->table("\x63\142\x74\137\x72\145\x6b\141\x70\137\x73\151\x73\167\x61")->updateBatch($_0xf030, "\x69\144\x5f\162\x65\153\x61\160\x5f\163\x69\163\x77\141");
 }
 goto L_b41e4;
 L_4917d:
 $_0x82ae["\x73\165\x63\143\x65\163\x73"] = $_0xda9e || $_0xb0bc;
 goto L_9cdfb;
 L_3020c:
 $_0xec44 = $this->request->getPost("\x69\144\x5f\152\x61\144\x77\141\x6c");
 goto L_a70a8;
 L_53254:
 $_0xc811 = [];
 goto L_b1a0b;
 L_358aa:
 $_0xae33 = json_decode($this->request->getPost("\x61\162\x72\137\x70\157\x69\156\x74")) ?: [];
 goto L_a6f4b;
 L_a6f4b:
 $_0x82ae["\x70\157\x73\164"] = $_0xae33;
 goto L_4df34;
 L_9fe80:
 $_0x5ad9 = $_0x678e->table("\x63\142\x74\137\x73\151\x73\167\x61")->select("\x69\144\x5f\143\x62\164\x5f\163\x69\163\x77\141\x2c\151\x64\137\x73\151\x73\167\x61\54\x69\144\x5f\152\x61\144\x77\141\x6c\54\x70\145\x6c\141\x6e\147\x67\141\x72\141\x6e")->whereIn("\x69\144\x5f\163\x69\163\x77\141", $_0xf75f)->where("\x69\144\x5f\152\x61\144\x77\141\x6c", $_0xec44)->get()->getResult();
 goto L_53254;
 L_b1a0b:
 foreach ($_0x5ad9 as $_0x9fc2) {
 $_0xc811[$_0x9fc2->id_siswa] = $_0x9fc2;
 }
 goto L_dbf30;
 L_56963:
 if (count($_0x67c2) > 0) {
 $_0xda9e = $_0x678e->table("\x63\142\x74\137\x73\151\x73\167\x61")->updateBatch($_0x67c2, "\x69\144\x5f\143\x62\164\x5f\163\x69\163\x77\141");
 }
 goto L_533fd;
 }
 public function mark_all()
 {
 goto L_c18f5;
 L_d17fc:
 $_0x41d0 = array_column($_0x8cfd, "\x69\144\x5f\163\x69\163\x77\141");
 goto L_7a869;
 L_db70a:
 $_0x47a6 = $_0xa8dd->table("\x63\142\x74\137\x73\151\x73\167\x61")->select("\x69\144\x5f\143\x62\164\x5f\163\x69\163\x77\141\x2c\151\x64\137\x73\151\x73\167\x61\54\x6e\151\x6c\141\x69\137\x69\156\x70\165\x74")->where("\x69\144\x5f\152\x61\144\x77\141\x6c", $_0x5277)->whereIn("\x69\144\x5f\163\x69\163\x77\141", $_0x41d0)->get()->getResult();
 goto L_e64c6;
 L_234c7:
 foreach ($_0x8cfd as $_0x70ba) {
 $_0x82f7[$_0x70ba["\x69\144\x5f\163\x69\163\x77\141"]] = $_0x70ba["\x6d\145\x6d\165\x6c\141\x69"];
 }
 goto L_db70a;
 L_c18f5:
 $_0xa8dd = \Config\Database::connect();
 goto L_8e4ff;
 L_37302:
 $_0x3ba5 = $_0xa8dd->table("\x63\142\x74\137\x72\145\x6b\141\x70\137\x73\151\x73\167\x61")->select("\x69\144\x5f\162\x65\153\x61\160\x5f\163\x69\163\x77\141\x2c\151\x64\137\x73\151\x73\167\x61\54\x6e\151\x6c\141\x69\137\x69\156\x70\165\x74")->where("\x69\144\x5f\152\x61\144\x77\141\x6c", $_0x5277)->whereIn("\x69\144\x5f\163\x69\163\x77\141", $_0x41d0)->get()->getResult();
 goto L_f511e;
 L_f2e1d:
 (new \App\Models\LogModel())->saveLog($this->LOG_TYPE->EDIT, "\x4d\145\x6e\147\x6b\157\x72\145\x6b\163\x69\40\x68\141\x73\151\x6c\40\x75\152\x69\141\x6e\40\x73\151\x73\167\x61");
 goto L_21cea;
 L_a9c8f:
 $_0x8cfd = json_decode($this->request->getPost("\x69\144\x5f\163\x69\163\x77\141"), true) ?: [];
 goto L_d0b50;
 L_f511e:
 $_0xfd2d = [];
 goto L_8d5e0;
 L_afe60:
 $_0x7c3a = $this->request->getPost("\x69\144\x5f\153\x65\154\x61\163");
 goto L_a9c8f;
 L_7a869:
 $_0x82f7 = [];
 goto L_234c7;
 L_8d5e0:
 if (!empty($_0x3ba5)) {
 foreach ($_0x3ba5 as $_0xd9ac) {
 if (isset($_0x82f7[$_0xd9ac->id_siswa])) {
 $_0x9b57 = json_decode($_0xd9ac->nilai_input ?? "\x7b\175", true) ?: [];
 $_0x9b57["\x64\151\x6b\157\x72\145\x6b\163\x69"] = $_0x82f7[$_0xd9ac->id_siswa] == "\x32" ? "\x30" : "\x31";
 $_0xfd2d[] = ["\x69\144\x5f\162\x65\153\x61\160\x5f\163\x69\163\x77\141" => $_0xd9ac->id_rekap_siswa, "\x6e\151\x6c\141\x69\137\x69\156\x70\165\x74" => json_encode($_0x9b57)];
 }
 }
 if (!empty($_0xfd2d)) {
 $_0xa8dd->table("\x63\142\x74\137\x72\145\x6b\141\x70\137\x73\151\x73\167\x61")->updateBatch($_0xfd2d, "\x69\144\x5f\162\x65\153\x61\160\x5f\163\x69\163\x77\141");
 }
 }
 goto L_f2e1d;
 L_21cea:
 return $this->response->setJSON(["\x73\165\x63\143\x65\163\x73" => true]);
 L_e64c6:
 $_0x1ab5 = [];
 goto L_aeba0;
 L_d0b50:
 if (empty($_0x8cfd)) {
 return $this->response->setJSON(["\x73\165\x63\143\x65\163\x73" => false, "\x6d\145\x73\163\x61\147\x65" => "\x54\151\x64\141\x6b\40\x61\144\x61\40\x73\151\x73\167\x61\40\x74\145\x72\160\x69\154\x69\150"]);
 }
 goto L_d17fc;
 L_aeba0:
 if (!empty($_0x47a6)) {
 foreach ($_0x47a6 as $_0x8042) {
 if (isset($_0x82f7[$_0x8042->id_siswa])) {
 $_0xc8a6 = json_decode($_0x8042->nilai_input ?? "\x7b\175", true) ?: [];
 $_0xc8a6["\x64\151\x6b\157\x72\145\x6b\163\x69"] = $_0x82f7[$_0x8042->id_siswa] == "\x32" ? "\x30" : "\x31";
 $_0x1ab5[] = ["\x69\144\x5f\143\x62\164\x5f\163\x69\163\x77\141" => $_0x8042->id_cbt_siswa, "\x6e\151\x6c\141\x69\137\x69\156\x70\165\x74" => json_encode($_0xc8a6)];
 }
 }
 if (!empty($_0x1ab5)) {
 $_0xa8dd->table("\x63\142\x74\137\x73\151\x73\167\x61")->updateBatch($_0x1ab5, "\x69\144\x5f\143\x62\164\x5f\163\x69\163\x77\141");
 }
 }
 goto L_37302;
 L_8e4ff:
 $_0x5277 = $this->request->getPost("\x69\144\x5f\152\x61\144\x77\141\x6c");
 goto L_afe60;
 }
 public function koreksi()
 {
 goto L_b7e28;
 L_67ac2:
 $_0x682f = (object) ["\x69\144" => $_0x3ec1->get("\x69\144\x5f\165\x73\145\x72"), "\x75\163\x65\162\x6e\141\x6d\145" => $_0x3ec1->get("\x75\163\x65\162\x6e\141\x6d\145"), "\x66\151\x72\163\x74\137\x6e\141\x6d\145" => $_0x3ec1->get("\x75\163\x65\162\x6e\141\x6d\145"), "\x72\157\x6c\145\x5f\156\x61\155\x65" => $_0x3ec1->get("\x72\157\x6c\145\x5f\156\x61\155\x65"), "\x66\157\x74\157" => $_0x3ec1->get("\x66\157\x74\157") ?? ''];
 goto L_3eebc;
 L_bdbcc:
 $_0x1f0c["\x6a\141\x64\167\x61\154"] = $_0x5e47;
 goto L_a1d94;
 L_d3d37:
 $_0x1f0c["\x73\157\x61\154\x5f\160\x67"] = array_values($_0x20f6);
 goto L_24296;
 L_65c19:
 $_0x1f0c["\x74\160\x5f\141\x63\164\x69\166\x65"] = $_0x9e7f;
 goto L_b9fd8;
 L_b171c:
 $_0x1f0c["\x6a\145\x6e\151\x73"] = $_0x5e47->jenis;
 goto L_f4d06;
 L_b9fd8:
 $_0x1f0c["\x73\155\x74\137\x61\143\x74\151\x76\145"] = $_0xf1bc;
 goto L_6bec2;
 L_493aa:
 $_0xfa95 = array_filter($_0x5e47->soal_jodohkan, function ($_0xcdb8) {
 return (is_object($_0xcdb8) ? $_0xcdb8->tampilkan : $_0xcdb8["\x74\141\x6d\160\x69\154\x6b\141\x6e"]) == "\x31";
 });
 goto L_25812;
 L_da5df:
 $_0x50df = (string) $_0x3ec1->get("\x72\157\x6c\145") === "\x31";
 goto L_67ac2;
 L_32eb3:
 $_0x4016 = $this->request->getGet("\x69\144\x5f\152\x61\144\x77\141\x6c");
 goto L_2c59a;
 L_25812:
 $_0x6ef4 = array_filter($_0x5e47->soal_isian, function ($_0xcdb8) {
 return (is_object($_0xcdb8) ? $_0xcdb8->tampilkan : $_0xcdb8["\x74\141\x6d\160\x69\154\x6b\141\x6e"]) == "\x31";
 });
 goto L_e956c;
 L_e956c:
 $_0xa14f = array_filter($_0x5e47->soal_esai, function ($_0xcdb8) {
 return (is_object($_0xcdb8) ? $_0xcdb8->tampilkan : $_0xcdb8["\x74\141\x6d\160\x69\154\x6b\141\x6e"]) == "\x31";
 });
 goto L_d3d37;
 L_2835f:
 $_0x5e47->sesisiswa = $_0x5e47->sesisiswa[0];
 goto L_ca2c8;
 L_3eebc:
 $_0x1f0c = ["\x75\163\x65\162" => $_0x682f, "\x6a\165\x64\165\x6c" => "\x4b\157\x72\145\x6b\163\x69\40\x48\141\x73\151\x6c\40\x53\151\x73\167\x61", "\x73\165\x62\152\x75\144\x75\154" => "\x48\141\x73\151\x6c\40\x53\151\x73\167\x61", "\x73\145\x74\164\x69\156\x67" => (new \App\Models\DashboardModel())->getSetting()];
 goto L_d303c;
 L_24296:
 $_0x1f0c["\x73\157\x61\154\x5f\153\x6f\155\x70\154\x65\153\x73"] = array_values($_0xc2dc);
 goto L_3cd9b;
 L_cd2d3:
 if ($_0x50df) {
 return view("\x63\142\x74\57\x6e\151\x6c\141\x69\57\x6b\157\x72\145\x6b\163\x69", $_0x1f0c);
 } else {
 $_0x76c0 = (new \App\Models\DashboardModel())->getDataGuruByUserId($_0x682f->id, $_0x9e7f->id_tp, $_0xf1bc->id_smt);
 $_0x1f0c["\x67\165\x72\165"] = $_0x76c0;
 return view("\x63\142\x74\57\x6e\151\x6c\141\x69\57\x6b\157\x72\145\x6b\163\x69", $_0x1f0c);
 }
 L_bda3d:
 $_0x1f0c["\x69\144\x5f\152\x61\144\x77\141\x6c"] = $_0x5e47->id_jadwal;
 goto L_d255d;
 L_2c59a:
 $_0x826a = $this->getTpSmt();
 goto L_6e212;
 L_f4d06:
 $_0x1f0c["\x74\160\x5f\152\x61\144\x77\141\x6c"] = $_0x9e7f->tahun;
 goto L_bdbcc;
 L_d255d:
 $_0x1f0c["\x69\144\x5f\142\x61\156\x6b"] = $_0x5e47->id_bank;
 goto L_b171c;
 L_219c4:
 $_0xf1bc = $_0x826a->smt_active;
 goto L_7c559;
 L_d3913:
 $_0x1f0c["\x73\157\x61\154\x5f\151\x73\151\x61\156"] = array_values($_0x6ef4);
 goto L_af749;
 L_fc9d9:
 $_0x1f0c["\x69\163\x5f\162\x65\153\x61\160"] = 0;
 goto L_cd2d3;
 L_6bec2:
 $_0x5e47 = $this->olah_nilai(2, $_0x9e7f->id_tp, $_0xf1bc->id_smt, $_0x8379, $_0x4016, true);
 goto L_2835f;
 L_b73e4:
 $_0x1f0c["\x69\156\x66\157"] = $_0x5e47->bank;
 goto L_bda3d;
 L_d303c:
 $_0x8379 = $this->request->getGet("\x69\144\x5f\163\x69\163\x77\141");
 goto L_32eb3;
 L_6e212:
 $_0x9e7f = $_0x826a->tp_active;
 goto L_219c4;
 L_3cd9b:
 $_0x1f0c["\x73\157\x61\154\x5f\152\x6f\144\x6f\150\x6b\141\x6e"] = array_values($_0xfa95);
 goto L_d3913;
 L_ca2c8:
 $_0x1f0c["\x73\151\x73\167\x61"] = $_0x5e47->sesisiswa;
 goto L_b73e4;
 L_32e0a:
 $_0x1f0c["\x73\155\x74"] = $_0xf1bc;
 goto L_65c19;
 L_b7e28:
 $_0x3ec1 = session();
 goto L_da5df;
 L_c7012:
 $_0xc2dc = array_filter($_0x5e47->soal_kompleks, function ($_0xcdb8) {
 return (is_object($_0xcdb8) ? $_0xcdb8->tampilkan : $_0xcdb8["\x74\141\x6d\160\x69\154\x6b\141\x6e"]) == "\x31";
 });
 goto L_493aa;
 L_7c559:
 $_0x1f0c["\x74\160"] = $_0x826a->tp;
 goto L_32e0a;
 L_af749:
 $_0x1f0c["\x73\157\x61\154\x5f\145\x73\141\x69"] = array_values($_0xa14f);
 goto L_fc9d9;
 L_a1d94:
 $_0x20f6 = array_filter($_0x5e47->soal_pg, function ($_0xcdb8) {
 return (is_object($_0xcdb8) ? $_0xcdb8->tampilkan : $_0xcdb8["\x74\141\x6d\160\x69\154\x6b\141\x6e"]) == "\x31";
 });
 goto L_c7012;
 }
 /**
 * AJAX: ambil data soal + jawaban siswa untuk halaman koreksi
 */
 public function get_koreksi()
 {
 goto L_f9f30;
 L_cc550:
 $_0x5e87 = $this->request->getPost("\x6a\141\x64\167\x61\154");
 goto L_47100;
 L_f9f30:
 $_0x4ce2 = $this->request->getPost("\x69\163\x5f\162\x65\153\x61\160");
 goto L_2e436;
 L_2e436:
 $_0xf313 = $this->request->getPost("\x73\151\x73\167\x61");
 goto L_cc550;
 L_47100:
 if ($_0x4ce2 > 0) {
 return $this->getKoreksiRekap($_0xf313, $_0x5e87);
 } else {
 return $this->getKoreksiNilai($_0xf313, $_0x5e87);
 }
 }
 private function getKoreksiNilai($_0x8414, $_0x5731)
 {
 goto L_55b73;
 L_190b2:
 $_0xa003->sesisiswa = $_0xa003->sesisiswa[0] ?? null;
 goto L_b855c;
 L_b855c:
 $_0xc972 = array_filter((array) ($_0xa003->soal_pg ?? []), function ($_0x5456) {
 return (is_object($_0x5456) ? $_0x5456->tampilkan : $_0x5456["\x74\141\x6d\160\x69\154\x6b\141\x6e"] ?? '') == "\x31";
 });
 goto L_a77eb;
 L_ac076:
 $_0xf460 = ["\x73\151\x73\167\x61" => $_0xa003->sesisiswa, "\x69\156\x66\157" => $_0xa003->bank, "\x69\144\x5f\152\x61\144\x77\141\x6c" => $_0xa003->id_jadwal, "\x6a\145\x6e\151\x73" => $_0xa003->jenis, "\x74\160\x5f\152\x61\144\x77\141\x6c" => $_0x77fb->tahun, "\x73\157\x61\154\x5f\160\x67" => array_values($_0xc972), "\x73\157\x61\154\x5f\153\x6f\155\x70\154\x65\153\x73" => array_values($_0xdcaa), "\x73\157\x61\154\x5f\152\x6f\144\x6f\150\x6b\141\x6e" => array_values($_0x1311), "\x73\157\x61\154\x5f\151\x73\151\x61\156" => array_values($_0x17cf), "\x73\157\x61\154\x5f\145\x73\141\x69" => array_values($_0xd874), "\x69\163\x5f\162\x65\153\x61\160" => 0, "\x73\165\x63\143\x65\163\x73" => true];
 goto L_ae402;
 L_ae402:
 return $this->response->setJSON($_0xf460);
 L_55b73:
 $_0x7ba4 = $this->getTpSmt();
 goto L_eb0b6;
 L_eb0b6:
 $_0x77fb = $_0x7ba4->tp_active;
 goto L_736a8;
 L_4c9e5:
 $_0x1311 = array_filter((array) ($_0xa003->soal_jodohkan ?? []), function ($_0x5456) {
 return (is_object($_0x5456) ? $_0x5456->tampilkan : $_0x5456["\x74\141\x6d\160\x69\154\x6b\141\x6e"] ?? '') == "\x31";
 });
 goto L_f29f4;
 L_3676f:
 $_0xa003 = $this->olah_nilai(2, $_0x77fb->id_tp, $_0x8fea->id_smt, $_0x8414, $_0x5731, true);
 goto L_190b2;
 L_736a8:
 $_0x8fea = $_0x7ba4->smt_active;
 goto L_3676f;
 L_f29f4:
 $_0x17cf = array_filter((array) ($_0xa003->soal_isian ?? []), function ($_0x5456) {
 return (is_object($_0x5456) ? $_0x5456->tampilkan : $_0x5456["\x74\141\x6d\160\x69\154\x6b\141\x6e"] ?? '') == "\x31";
 });
 goto L_eff67;
 L_eff67:
 $_0xd874 = array_filter((array) ($_0xa003->soal_esai ?? []), function ($_0x5456) {
 return (is_object($_0x5456) ? $_0x5456->tampilkan : $_0x5456["\x74\141\x6d\160\x69\154\x6b\141\x6e"] ?? '') == "\x31";
 });
 goto L_ac076;
 L_a77eb:
 $_0xdcaa = array_filter((array) ($_0xa003->soal_kompleks ?? []), function ($_0x5456) {
 return (is_object($_0x5456) ? $_0x5456->tampilkan : $_0x5456["\x74\141\x6d\160\x69\154\x6b\141\x6e"] ?? '') == "\x31";
 });
 goto L_4c9e5;
 }
 private function getKoreksiRekap($_0x401b, $_0x1186)
 {
 // Untuk mode rekap, delegasikan ke controller Cbtrekap jika ada
 // Sementara kembalikan response kosong dengan flag untuk ditangani di sisi JS
 return $this->response->setJSON(["\x73\165\x63\143\x65\163\x73" => false, "\x6d\145\x73\163\x61\147\x65" => "\x4d\157\x64\145\x20\162\x65\153\x61\160\x20\142\x65\154\x75\155\x20\144\x69\144\x75\153\x75\156\x67\40\x64\151\x20\147\x65\164\x5f\153\x6f\162\x65\153\x73\151\x20\103\x49\64", "\x69\163\x5f\162\x65\153\x61\160" => $_0x401b]);
 }
 /**
 * AJAX: tandai satu siswa sudah dikoreksi
 */
 public function tandaikoreksi()
 {
 goto L_f6ef0;
 L_fe35b:
 $_0x2d05 = $this->request->getPost("\x6a\141\x64\167\x61\154");
 goto L_2f278;
 L_b2250:
 if ($_0x6c2d) {
 $_0xd86c = $this->maybe_unserialize($_0x6c2d->nilai_input ?? "\x7b\175");
 if (is_array($_0xd86c)) {
 $_0xd86c["\x64\151\x6b\157\x72\145\x6b\163\x69"] = "\x31";
 } else {
 $_0xd86c->dikoreksi = "\x31";
 }
 $_0xfe67->table("\x63\142\x74\137\x73\151\x73\167\x61")->where("\x69\144\x5f\143\x62\164\x5f\163\x69\163\x77\141", $_0x6c2d->id_cbt_siswa)->update(["\x6e\151\x6c\141\x69\137\x69\156\x70\165\x74" => json_encode($_0xd86c)]);
 }
 goto L_3ca48;
 L_7a802:
 $_0x294d = $this->request->getPost("\x73\151\x73\167\x61");
 goto L_fe35b;
 L_3e7bc:
 (new \App\Models\LogModel())->saveLog($this->LOG_TYPE->EDIT, "\x4d\145\x6e\141\x6e\144\x61\151\x20\153\x6f\162\x65\153\x73\151\x20\150\x61\163\x69\154\x20\165\x6a\151\x61\156\x20\163\x69\163\x77\141");
 goto L_df3f6;
 L_98086:
 $_0xc226 = true;
 goto L_a4b9c;
 L_df3f6:
 return $this->response->setJSON(["\x73\165\x63\143\x65\163\x73" => $_0x625a && $_0xc226]);
 L_3ca48:
 // Update cbt_rekap_siswa
 $_0xa84e = $_0xfe67->table("\x63\142\x74\137\x72\145\x6b\141\x70\137\x73\151\x73\167\x61")->select("\x69\144\x5f\162\x65\153\x61\160\x5f\163\x69\163\x77\141\x2c\40\x6e\151\x6c\141\x69\137\x69\156\x70\165\x74")->where(["\x69\144\x5f\163\x69\163\x77\141" => $_0x294d, "\x69\144\x5f\152\x61\144\x77\141\x6c" => $_0x2d05])->get()->getRow();
 goto L_a5468;
 L_f6ef0:
 $_0xfe67 = \Config\Database::connect();
 goto L_7a802;
 L_a4b9c:
 // Update cbt_siswa
 $_0x6c2d = $_0xfe67->table("\x63\142\x74\137\x73\151\x73\167\x61")->select("\x69\144\x5f\143\x62\164\x5f\163\x69\163\x77\141\x2c\40\x6e\151\x6c\141\x69\137\x69\156\x70\165\x74")->where(["\x69\144\x5f\152\x61\144\x77\141\x6c" => $_0x2d05, "\x69\144\x5f\163\x69\163\x77\141" => $_0x294d])->get()->getRow();
 goto L_b2250;
 L_a5468:
 if ($_0xa84e) {
 $_0x5c86 = $this->maybe_unserialize($_0xa84e->nilai_input ?? "\x7b\175");
 if (is_array($_0x5c86)) {
 $_0x5c86["\x64\151\x6b\157\x72\145\x6b\163\x69"] = "\x31";
 } else {
 $_0x5c86->dikoreksi = "\x31";
 }
 $_0xfe67->table("\x63\142\x74\137\x72\145\x6b\141\x70\137\x73\151\x73\167\x61")->where("\x69\144\x5f\162\x65\153\x61\160\x5f\163\x69\163\x77\141", $_0xa84e->id_rekap_siswa)->update(["\x6e\151\x6c\141\x69\137\x69\156\x70\165\x74" => json_encode($_0x5c86)]);
 }
 goto L_3e7bc;
 L_2f278:
 $_0x625a = true;
 goto L_98086;
 }
 public function inputEssai()
 {
 goto L_50282;
 L_b4e54:
 $_0x3c94 = (string) $_0xa9bb->get("\x72\157\x6c\145") === "\x31";
 goto L_70a70;
 L_05b8b:
 $_0xe7e9["\x6b\145\x6c\141\x73\137\x73\145\x6c\145\x63\164\x65\144"] = $_0xab80;
 goto L_557ef;
 L_21ae9:
 $_0xdefd = $_0xba15->smt_active;
 goto L_7470d;
 L_4028c:
 $_0xe7e9["\x74\160\x5f\141\x63\164\x69\166\x65"] = $_0x1084;
 goto L_a855a;
 L_7c153:
 $_0xba15 = $this->getTpSmt();
 goto L_dd6ce;
 L_af49e:
 $_0xe7e9["\x6b\145\x6c\141\x73"] = $_0x99cd->table("\x6d\141\x73\164\x65\162\x5f\153\x65\154\x61\163")->where(["\x69\144\x5f\164\x70" => $_0x1084->id_tp, "\x69\144\x5f\163\x6d\164" => $_0xdefd->id_smt, "\x69\144\x5f\153\x65\154\x61\163" => $_0xab80])->get()->getResult();
 goto L_05b8b;
 L_dd6ce:
 $_0x1084 = $_0xba15->tp_active;
 goto L_21ae9;
 L_dbe02:
 $_0xe7e9 = ["\x75\163\x65\162" => $_0xa8a6, "\x6a\165\x64\165\x6c" => "\x49\156\x70\165\x74\40\x4e\151\x6c\141\x69\40\x4d\141\x6e\165\x61\154", "\x73\165\x62\152\x75\144\x75\154" => '', "\x70\162\x6f\146\x69\154\x65" => null, "\x73\145\x74\164\x69\156\x67" => (new \App\Models\DashboardModel())->getSetting()];
 goto L_039eb;
 L_88d64:
 $_0x99cd = \Config\Database::connect();
 goto L_af49e;
 L_62b36:
 $_0xd128 = $this->olah_nilai(1, $_0x1084->id_tp, $_0xdefd->id_smt, $_0xab80, $_0x42b4);
 goto L_bcec3;
 L_7470d:
 $_0xa9bb = session();
 goto L_b4e54;
 L_a855a:
 $_0xe7e9["\x73\155\x74\137\x61\143\x74\151\x76\145"] = $_0xdefd;
 goto L_88d64;
 L_bcec3:
 $_0xe7e9["\x6a\141\x64\167\x61\154"] = $_0xd128;
 goto L_1e649;
 L_039eb:
 $_0xe7e9["\x74\160"] = $_0xba15->tp;
 goto L_0ba9e;
 L_1e649:
 if ($_0x3c94) {
 return view("\x63\142\x74\57\x6e\151\x6c\141\x69\57\x69\156\x70\165\x74\137\x6e\151\x6c\141\x69", $_0xe7e9);
 } else {
 $_0xe5e4 = (new \App\Models\DashboardModel())->getDataGuruByUserId($_0xa8a6->id, $_0x1084->id_tp, $_0xdefd->id_smt);
 $_0xe7e9["\x67\165\x72\165"] = $_0xe5e4;
 return view("\x63\142\x74\57\x6e\151\x6c\141\x69\57\x69\156\x70\165\x74\137\x6e\151\x6c\141\x69", $_0xe7e9);
 }
 L_0ba9e:
 $_0xe7e9["\x73\155\x74"] = $_0xdefd;
 goto L_4028c;
 L_557ef:
 $_0xe7e9["\x6a\141\x64\167\x61\154\x5f\163\x65\154\x65\143\x74\145\x64"] = $_0x42b4;
 goto L_62b36;
 L_70a70:
 $_0xa8a6 = (object) ["\x69\144" => $_0xa9bb->get("\x69\144\x5f\165\x73\145\x72"), "\x75\163\x65\162\x6e\141\x6d\145" => $_0xa9bb->get("\x75\163\x65\162\x6e\141\x6d\145"), "\x66\151\x72\163\x74\137\x6e\141\x6d\145" => $_0xa9bb->get("\x75\163\x65\162\x6e\141\x6d\145"), "\x72\157\x6c\145\x5f\156\x61\155\x65" => $_0xa9bb->get("\x72\157\x6c\145\x5f\156\x61\155\x65"), "\x66\157\x74\157" => $_0xa9bb->get("\x66\157\x74\157") ?? ''];
 goto L_dbe02;
 L_50282:
 $_0xab80 = $this->request->getGet("\x69\144\x5f\153\x65\154\x61\163");
 goto L_ced05;
 L_ced05:
 $_0x42b4 = $this->request->getGet("\x69\144\x5f\152\x61\144\x77\141\x6c");
 goto L_7c153;
 }
 public function simpankoreksi()
 {
 goto L_79527;
 L_8871e:
 $_0x6834 = $this->request->getPost("\x6a\141\x64\167\x61\154");
 goto L_aefe5;
 L_4dd99:
 $_0x5007 = $this->request->getPost("\x69\163\x5f\162\x65\153\x61\160");
 goto L_1dead;
 L_2f4ec:
 if ($_0x93ce && isset($_0x93ce->nilai)) {
 $_0x4913 = $this->maybe_unserialize($_0x93ce->nilai);
 if (!is_array($_0x4913)) {
 $_0x4913 = [];
 }
 $_0xd406 = 0;
 foreach ($_0x4913 as $_0xcb93 => $_0xa222) {
 $_0x9ec0 = is_object($_0xa222) ? $_0xa222 : (object) $_0xa222;
 $_0x1cce = $_0x9ec0->id_soal ?? null;
 if (($_0x9ec0->point_soal ?? 0) != 0) {
 $_0xd406 = $_0x9ec0->point_soal;
 }
 $_0x7da9 = array_filter($_0x1a14, function ($_0xe822) use ($_0x1cce) {
 return (string) ($_0xe822->id_soal ?? '') == (string) $_0x1cce;
 });
 if (!empty($_0x7da9)) {
 $_0x634d = array_values($_0x7da9)[0];
 if (is_object($_0x4913[$_0xcb93])) {
 $_0x4913[$_0xcb93]->nilai_koreksi = $_0x634d->koreksi;
 $_0x4913[$_0xcb93]->nilai_otomatis = 1;
 } else {
 $_0x4913[$_0xcb93]["\x6e\151\x6c\141\x69\137\x6b\157\x72\145\x6b\163\x69"] = $_0x634d->koreksi;
 $_0x4913[$_0xcb93]["\x6e\151\x6c\141\x69\137\x6f\164\x6f\155\x61\164\x69\163"] = 1;
 }
 }
 }
 $_0xe8c5 = array_map(function ($_0x1a31) {
 return is_object($_0x1a31) ? $_0x1a31->id_soal ?? null : $_0x1a31["\x69\144\x5f\163\x6f\141\x6c"] ?? null;
 }, $_0x4913);
 $_0x16a6 = array_filter($_0x1a14, function ($_0xe822) use ($_0xe8c5) {
 return !in_array($_0xe822->id_soal, $_0xe8c5);
 });
 if (!empty($_0x16a6)) {
 foreach ($_0x16a6 as $_0x2caf) {
 $_0x4913[] = (object) ["\x69\144\x5f\142\x61\156\x6b" => (string) $_0x2d05, "\x69\144\x5f\152\x61\144\x77\141\x6c" => (string) $_0x6834, "\x69\144\x5f\163\x6f\141\x6c" => (string) $_0x2caf->id_soal, "\x6e\151\x6c\141\x69\137\x6b\157\x72\145\x6b\163\x69" => $_0x2caf->koreksi, "\x6e\151\x6c\141\x69\137\x6f\164\x6f\155\x61\164\x69\163" => "\x31", "\x70\157\x69\156\x74\137\x73\157\x61\154" => (string) $_0xd406];
 }
 }
 $_0x9d66->table("\x63\142\x74\137\x72\145\x6b\141\x70\137\x73\151\x73\167\x61")->where("\x69\144\x5f\162\x65\153\x61\160\x5f\163\x69\163\x77\141", $_0x93ce->id_rekap_siswa)->update(["\x6e\151\x6c\141\x69" => json_encode($_0x4913)]);
 }
 goto L_a4587;
 L_6bd4c:
 if ($_0x7f46 && isset($_0x7f46->nilai)) {
 $_0x8c64 = $this->maybe_unserialize($_0x7f46->nilai);
 if (!is_array($_0x8c64)) {
 $_0x8c64 = [];
 }
 $_0xd406 = 0;
 foreach ($_0x8c64 as $_0xcb93 => $_0xa222) {
 $_0x9ec0 = is_object($_0xa222) ? $_0xa222 : (object) $_0xa222;
 if (($_0x9ec0->point_soal ?? 0) != 0) {
 $_0xd406 = $_0x9ec0->point_soal;
 }
 $_0x1cce = $_0x9ec0->id_soal ?? null;
 $_0x7da9 = array_filter($_0x1a14, function ($_0xe822) use ($_0x1cce) {
 return (string) ($_0xe822->id_soal ?? '') == (string) $_0x1cce;
 });
 if (!empty($_0x7da9)) {
 $_0x634d = array_values($_0x7da9)[0];
 if (is_object($_0x8c64[$_0xcb93])) {
 $_0x8c64[$_0xcb93]->nilai_koreksi = $_0x634d->koreksi;
 $_0x8c64[$_0xcb93]->nilai_otomatis = 1;
 } else {
 $_0x8c64[$_0xcb93]["\x6e\151\x6c\141\x69\137\x6b\157\x72\145\x6b\163\x69"] = $_0x634d->koreksi;
 $_0x8c64[$_0xcb93]["\x6e\151\x6c\141\x69\137\x6f\164\x6f\155\x61\164\x69\163"] = 1;
 }
 }
 }
 $_0xe8c5 = array_map(function ($_0x1a31) {
 return is_object($_0x1a31) ? $_0x1a31->id_soal ?? null : $_0x1a31["\x69\144\x5f\163\x6f\141\x6c"] ?? null;
 }, $_0x8c64);
 $_0x16a6 = array_filter($_0x1a14, function ($_0xe822) use ($_0xe8c5) {
 return !in_array($_0xe822->id_soal, $_0xe8c5);
 });
 if (!empty($_0x16a6)) {
 foreach ($_0x16a6 as $_0x2caf) {
 $_0x8c64[] = (object) ["\x69\144\x5f\142\x61\156\x6b" => (string) $_0x2d05, "\x69\144\x5f\152\x61\144\x77\141\x6c" => (string) $_0x6834, "\x69\144\x5f\163\x6f\141\x6c" => (string) $_0x2caf->id_soal, "\x6e\151\x6c\141\x69\137\x6b\157\x72\145\x6b\163\x69" => $_0x2caf->koreksi, "\x6e\151\x6c\141\x69\137\x6f\164\x6f\155\x61\164\x69\163" => "\x31", "\x70\157\x69\156\x74\137\x73\157\x61\154" => (string) $_0xd406];
 }
 }
 if (isset($_0x7f46->id_cbt_siswa)) {
 $_0x9d66->table("\x63\142\x74\137\x73\151\x73\167\x61")->where("\x69\144\x5f\143\x62\164\x5f\163\x69\163\x77\141", $_0x7f46->id_cbt_siswa)->update(["\x6e\151\x6c\141\x69" => json_encode($_0x8c64)]);
 }
 }
 goto L_da0b8;
 L_629de:
 $_0x1a14 = json_decode($this->request->getPost("\x6e\151\x6c\141\x69") ?? "\x5b\135") ?: [];
 goto L_43977;
 L_40027:
 $_0x78e3 = true;
 goto L_d9518;
 L_79527:
 $_0x9d66 = \Config\Database::connect();
 goto L_4dd99;
 L_43977:
 if (!is_array($_0x1a14)) {
 return $this->response->setJSON(["\x73\165\x63\143\x65\163\x73" => false, "\x6d\145\x73\163\x61\147\x65" => "\x46\157\x72\155\x61\164\x20\144\x61\164\x61\40\x6e\151\x6c\141\x69\40\x74\151\x64\141\x6b\40\x76\141\x6c\151\x64"]);
 }
 goto L_40027;
 L_618d1:
 $_0x16a6 = [];
 goto L_6bd4c;
 L_1dead:
 $_0xd428 = $this->request->getPost("\x73\151\x73\167\x61");
 goto L_8871e;
 L_aefe5:
 $_0x2d05 = $this->request->getPost("\x62\141\x6e\153");
 goto L_03904;
 L_da0b8:
 $_0xd14d = true;
 goto L_d5333;
 L_d9518:
 $_0x7f46 = $_0x9d66->table("\x63\142\x74\137\x73\151\x73\167\x61")->where(["\x69\144\x5f\163\x69\163\x77\141" => $_0xd428, "\x69\144\x5f\152\x61\144\x77\141\x6c" => $_0x6834])->get()->getRow();
 goto L_618d1;
 L_a4587:
 (new \App\Models\LogModel())->saveLog($this->LOG_TYPE->EDIT, "\x4d\145\x6e\147\x6b\157\x72\145\x6b\163\x69\40\x68\141\x73\151\x6c\40\x75\152\x69\141\x6e\40\x73\151\x73\167\x61");
 goto L_58eb1;
 L_03904:
 $_0x798e = $this->request->getPost("\x66\151\x65\154\x64");
 goto L_629de;
 L_58eb1:
 return $this->response->setJSON(["\x73\165\x63\143\x65\163\x73" => $_0x78e3 && $_0xd14d, "\x63\142\x74\137\x73\151\x73\167\x61" => $_0x7f46, "\x6d\151\x73\163" => $_0x16a6, "\x72\145\x6b\141\x70\137\x73\151\x73\167\x61" => $_0x93ce]);
 L_d5333:
 $_0x93ce = $_0x9d66->table("\x63\142\x74\137\x72\145\x6b\141\x70\137\x73\151\x73\167\x61")->where(["\x69\144\x5f\163\x69\163\x77\141" => $_0xd428, "\x69\144\x5f\152\x61\144\x77\141\x6c" => $_0x6834])->get()->getRow();
 goto L_2f4ec;
 }
}