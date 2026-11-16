<?php
/*   ________________________________________
    |               NextGen Garuda CBT       |
    |    Protected & Distributed via GitHub  |
    |________________________________________|
*/
namespace App\Controllers;

use App\Models\CbtModel;
use App\Models\DashboardModel;
use App\Models\DropdownModel;
use App\Models\KelasModel;
use App\Models\MasterModel;
class CbtJadwal extends BaseController
{
 protected $cbtModel;
 protected $dashboardModel;
 protected $dropdownModel;
 protected $kelasModel;
 protected $masterModel;
 public function __construct()
 {
 goto L_70270;
 L_7095a:
 $this->ensureExambroSchema();
 L_cdb45:
 $this->ensureKameraSchema();
 goto L_7095a;
 L_70270:
 $this->cbtModel = new CbtModel();
 goto L_df841;
 L_c826a:
 $this->dropdownModel = new DropdownModel();
 goto L_3c9ea;
 L_8ba7d:
 $this->masterModel = new MasterModel();
 goto L_cdb45;
 L_3c9ea:
 $this->kelasModel = new KelasModel();
 goto L_8ba7d;
 L_df841:
 $this->dashboardModel = new DashboardModel();
 goto L_c826a;
 }
 private function ensureExambroSchema()
 {
 try {
 $_0xc5a9 = \Config\Database::connect();
 if (!$_0xc5a9->fieldExists("\x6c\157\x63\153\x5f\142\x72\157\x77\163\x65\162", "\x63\142\x74\137\x6a\141\x64\167\x61\154")) {
 $_0x8baa = \Config\Database::forge();
 $_0x8baa->addColumn("\x63\142\x74\137\x6a\141\x64\167\x61\154", ["\x6c\157\x63\153\x5f\142\x72\157\x77\163\x65\162" => ["\x74\171\x70\145" => "\x49\116\x54", "\x63\157\x6e\163\x74\162\x61\151\x6e\164" => 11, "\x64\145\x66\141\x75\154\x74" => 0]]);
 }
 } catch (\Throwable $_0x44a9) {
 }
 }
 private function ensureKameraSchema()
 {
 try {
 $_0x5ca0 = \Config\Database::connect();
 if (!$_0x5ca0->fieldExists("\x6b\141\x6d\145\x72\141", "\x63\142\x74\137\x6a\141\x64\167\x61\154")) {
 $_0xfbc0 = \Config\Database::forge();
 $_0xfbc0->addColumn("\x63\142\x74\137\x6a\141\x64\167\x61\154", ["\x6b\141\x6d\145\x72\141" => ["\x74\171\x70\145" => "\x49\116\x54", "\x63\157\x6e\163\x74\162\x61\151\x6e\164" => 11, "\x64\145\x66\141\x75\154\x74" => 0]]);
 }
 if (!$_0x5ca0->tableExists("\x63\142\x74\137\x6b\141\x6d\145\x72\141\x5f\163\x74\162\x65\141\x6d")) {
 $_0x5ca0->query("\x43\122\x45\101\x54\105\x20\124\x41\102\x4c\105\x20\111\x46\40\x4e\117\x54\40\x45\130\x49\123\x54\123\x20\143\x62\164\x5f\153\x61\155\x65\162\x61\137\x73\164\x72\145\x61\155\x20\50\xa\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\151\x64\40\x49\116\x54\40\x41\125\x54\117\x5f\111\x4e\103\x52\105\x4d\105\x4e\124\x20\120\x52\111\x4d\101\x52\131\x20\113\x45\131\x2c\12\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x69\144\x5f\152\x61\144\x77\141\x6c\40\x49\116\x54\40\x4e\117\x54\40\x4e\125\x4c\114\x2c\12\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x69\144\x5f\163\x69\163\x77\141\x20\111\x4e\124\x20\116\x4f\124\x20\116\x55\114\x4c\54\xa\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\163\x74\141\x74\165\x73\40\x56\101\x52\103\x48\101\x52\50\x32\60\x29\40\x44\105\x46\101\x55\114\x54\40\x27\163\x74\141\x6e\144\x62\171\x27\54\xa\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\163\x64\160\x5f\157\x66\146\x65\162\x20\114\x4f\116\x47\124\x45\130\x54\40\x4e\125\x4c\114\x2c\12\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x73\144\x70\137\x61\156\x73\167\x65\162\x20\114\x4f\116\x47\124\x45\130\x54\40\x4e\125\x4c\114\x2c\12\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x6c\141\x73\164\x5f\146\x72\141\x6d\145\x20\114\x4f\116\x47\124\x45\130\x54\40\x4e\125\x4c\114\x2c\12\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x75\160\x64\141\x74\145\x64\137\x61\164\x20\104\x41\124\x45\124\x49\115\x45\40\x4e\125\x4c\114\x2c\12\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x55\116\x49\121\x55\105\x20\113\x45\131\x20\165\x6e\151\x71\137\x6a\141\x64\167\x61\154\x5f\163\x69\163\x77\141\x20\50\x69\144\x5f\152\x61\144\x77\141\x6c\54\x20\151\x64\137\x73\151\x73\167\x61\51\xa\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\51\x20\105\x4e\107\x49\116\x45\75\x49\156\x6e\157\x44\102\x20\104\x45\106\x41\125\x4c\124\x20\103\x48\101\x52\123\x45\124\x3d\165\x74\146\x38\155\x62\64");
 }
 } catch (\Throwable $_0xdacd) {
 // Silently ignore if already exists
 }
 }
 private function getJadwalTerpakai($_0xb14a = null)
 {
 goto L_0a09d;
 L_11582:
 foreach ($_0x49cb as $_0x62ea) {
 $_0x7816[$_0x62ea->id_jadwal][$_0x62ea->id_siswa] = $_0x62ea;
 }
 goto L_4ea81;
 L_0a09d:
 $_0xbcdb = \Config\Database::connect();
 goto L_54e92;
 L_83466:
 $_0x7816 = [];
 goto L_11582;
 L_9c231:
 $_0xfcfc->select("\x69\144\x5f\142\x61\156\x6b\54\x69\144\x5f\152\x61\144\x77\141\x6c\54\x69\144\x5f\163\x69\163\x77\141");
 goto L_c484c;
 L_54e92:
 $_0xfcfc = $_0xbcdb->table("\x63\142\x74\137\x73\151\x73\167\x61");
 goto L_9c231;
 L_c484c:
 if ($_0xb14a != null) {
 $_0xfcfc->where("\x69\144\x5f\152\x61\144\x77\141\x6c", $_0xb14a);
 }
 goto L_d02e7;
 L_4ea81:
 return $_0x7816;
 L_d02e7:
 $_0x49cb = $_0xfcfc->get()->getResult();
 goto L_83466;
 }
 public function index()
 {
 goto L_b88b3;
 L_6df26:
 $_0xc79f["\x73\145\x73\151\x73"] = $this->dropdownModel->getAllSesi();
 goto L_e1393;
 L_3c3de:
 $_0xf088 = $this->request->getGet("\x6d\157\x64\145");
 goto L_5e31a;
 L_954ef:
 $_0xc79f["\x6d\141\x70\145\x6c\163"] = $this->dropdownModel->getAllMapel();
 goto L_679a3;
 L_0d8d0:
 $_0xe620 = (string) $_0xf315->get("\x72\157\x6c\145") === "\x31";
 goto L_a36cb;
 L_66e7b:
 $_0xc79f["\x69\144\x5f\154\x65\166\x65\154"] = '';
 goto L_3a773;
 L_b88b3:
 $_0xf315 = session();
 goto L_0d8d0;
 L_679a3:
 $_0xc79f["\x66\151\x6c\164\x65\162\x73"] = ["\x30" => "\x53\145\x6d\165\x61", "\x31" => "\x47\165\x72\165", "\x32" => "\x4d\141\x70\145\x6c", "\x33" => "\x4c\145\x76\145\x6c"];
 goto L_243f9;
 L_9f2ba:
 $_0x1932 = $this->dashboardModel->getSetting();
 goto L_4d537;
 L_b506b:
 if ($_0xf088) {
 $_0xd439 = $this->getJadwalTerpakai();
 $_0xf24e = [];
 foreach ($_0xd439 as $_0x58a8 => $_0x8108) {
 $_0xf24e[$_0x58a8] = count($_0x8108);
 }
 $_0xc79f["\x74\157\x74\141\x6c\137\x73\151\x73\167\x61"] = $_0xf24e;
 }
 goto L_cea08;
 L_730a4:
 // Note: cekRekapSiswa() method missing?
 $_0xc79f["\x67\165\x72\165\x73"] = $this->dropdownModel->getAllGuru();
 goto L_954ef;
 L_ee548:
 $_0xc79f["\x6c\145\x76\145\x6c"] = $_0x1dff;
 goto L_b506b;
 L_a36cb:
 $_0x7c29 = (object) ["\x69\144" => $_0xf315->get("\x69\144\x5f\165\x73\145\x72"), "\x66\151\x72\163\x74\137\x6e\141\x6d\145" => $_0xf315->get("\x75\163\x65\162\x6e\141\x6d\145"), "\x72\157\x6c\145\x5f\156\x61\155\x65" => $_0xf315->get("\x72\157\x6c\145\x5f\156\x61\155\x65"), "\x66\157\x74\157" => $_0xf315->get("\x66\157\x74\157") ?? ''];
 goto L_9ad64;
 L_3a773:
 if ($_0xe620) {
 $_0xc099 = [];
 if ($_0xf768 == "\x30") {
 $_0xc099 = $this->cbtModel->getAllDataJadwal($_0x7d6c->id_tp, $_0xfca1->id_smt);
 $_0xc79f["\x69\144\x5f\147\x75\162\x75"] = null;
 $_0xc79f["\x69\144\x5f\155\x61\160\x65\154"] = null;
 $_0xc79f["\x69\144\x5f\154\x65\166\x65\154"] = null;
 } elseif ($_0xf768 == "\x31") {
 $_0xbbd1 = $this->request->getGet("\x69\144");
 $_0xc79f["\x69\144\x5f\147\x75\162\x75"] = $_0xbbd1;
 $_0xc099 = $this->cbtModel->getAllDataJadwal($_0x7d6c->id_tp, $_0xfca1->id_smt, $_0xbbd1);
 $_0xc79f["\x69\144\x5f\155\x61\160\x65\154"] = '';
 $_0xc79f["\x69\144\x5f\154\x65\166\x65\154"] = '';
 } elseif ($_0xf768 == "\x32") {
 $_0xda44 = $this->request->getGet("\x69\144");
 $_0xc79f["\x69\144\x5f\155\x61\160\x65\154"] = $_0xda44;
 $_0xc099 = $this->cbtModel->getAllDataJadwal($_0x7d6c->id_tp, $_0xfca1->id_smt, null, $_0xda44);
 $_0xc79f["\x69\144\x5f\147\x75\162\x75"] = '';
 $_0xc79f["\x69\144\x5f\154\x65\166\x65\154"] = '';
 } elseif ($_0xf768 == "\x33") {
 $_0x43ff = $this->request->getGet("\x69\144");
 $_0xc79f["\x69\144\x5f\154\x65\166\x65\154"] = $_0x43ff;
 $_0xc099 = $this->cbtModel->getAllDataJadwal($_0x7d6c->id_tp, $_0xfca1->id_smt, null, null, $_0x43ff);
 $_0xc79f["\x69\144\x5f\147\x75\162\x75"] = '';
 $_0xc79f["\x69\144\x5f\155\x61\160\x65\154"] = '';
 } else {
 $_0xc79f["\x69\144\x5f\147\x75\162\x75"] = null;
 $_0xc79f["\x69\144\x5f\155\x61\160\x65\154"] = null;
 $_0xc79f["\x69\144\x5f\154\x65\166\x65\154"] = null;
 }
 if (count($_0xc099) > 0) {
 foreach ($_0xc099 as $_0x26cd => $_0x37f5) {
 foreach ($_0x37f5 as $_0x92ca => $_0xbbdf) {
 foreach ($_0xbbdf as $_0x7393 => $_0x4a41) {
 $_0x4a41->bank_kelas = $this->maybe_unserialize($_0x4a41->bank_kelas ?? "\x5b\135");
 }
 }
 }
 }
 $_0xc79f["\x6a\141\x64\167\x61\154\x73"] = $_0xc099;
 return view("\x63\142\x74\57\x6a\141\x64\167\x61\154\x2f\144\x61\164\x61", $_0xc79f);
 } else {
 $_0xb504 = $this->dashboardModel->getDataGuruByUserId($_0x7c29->id, $_0x7d6c->id_tp, $_0xfca1->id_smt);
 $_0xc79f["\x69\144\x5f\147\x75\162\x75"] = $_0xb504 ? $_0xb504->id_guru : '';
 $_0xc099 = $this->cbtModel->getAllDataJadwal($_0x7d6c->id_tp, $_0xfca1->id_smt, $_0xc79f["\x69\144\x5f\147\x75\162\x75"]);
 if (count($_0xc099) > 0) {
 foreach ($_0xc099 as $_0x26cd => $_0x37f5) {
 foreach ($_0x37f5 as $_0x92ca => $_0xbbdf) {
 foreach ($_0xbbdf as $_0x7393 => $_0x4a41) {
 $_0x4a41->bank_kelas = $this->maybe_unserialize($_0x4a41->bank_kelas ?? "\x5b\135");
 }
 }
 }
 }
 $_0xc79f["\x6a\141\x64\167\x61\154\x73"] = $_0xc099;
 return view("\x63\142\x74\57\x6a\141\x64\167\x61\154\x2f\144\x61\164\x61", $_0xc79f);
 }
 L_48fdc:
 $_0xc79f["\x6c\145\x76\145\x6c\163"] = $this->dropdownModel->getAllLevel($_0x1932->jenjang);
 goto L_fe5ec;
 L_fc614:
 $_0xfca1 = $this->dashboardModel->getSemesterActive();
 goto L_ff6cb;
 L_9ad64:
 $_0x92ca = $this->request->getGet("\x6c\145\x76\145\x6c");
 goto L_5f86c;
 L_fe5ec:
 $_0xc79f["\x6b\145\x6c\141\x73"] = $this->cbtModel->getKelas($_0x7d6c->id_tp, $_0xfca1->id_smt);
 goto L_cab1f;
 L_e3be8:
 $_0xc79f["\x72\165\x61\156\x67\163"] = $this->cbtModel->getRuang();
 goto L_6df26;
 L_d3227:
 $_0xc79f["\x6a\155\x6c\115\x61\160\x65\154"] = [];
 goto L_ee548;
 L_ef948:
 $_0x41b8 = isset($_SERVER["\x48\124\x54\120\x5f\110\x4f\123\x54"]) && strpos($_SERVER["\x48\124\x54\120\x5f\110\x4f\123\x54"], "\x6e\165\x72\165\x6c\150\x61\153\x69\155\x2e\163\x63\150\x2e\151\x64") !== false || strpos(base_url(), "\x6e\165\x72\165\x6c\150\x61\153\x69\155\x2e\163\x63\150\x2e\151\x64") !== false;
 goto L_0a48c;
 L_e1393:
 $_0xc79f["\x6a\145\x6e\151\x73"] = $this->dropdownModel->getAllJenisUjian();
 goto L_2cb2e;
 L_013b2:
 if ($_0xf768 === null || $_0xf768 === '') {
 $_0xf768 = "\x30";
 }
 goto L_c612f;
 L_cab1f:
 $_0xc79f["\x72\145\x6b\141\x70\163"] = $this->cekRekapSiswa();
 goto L_730a4;
 L_243f9:
 $_0xc79f["\x69\144\x5f\146\x69\154\x74\145\x72"] = (string) $_0xf768;
 goto L_a4a61;
 L_ff6cb:
 if (!$_0xe620) {
 return redirect()->to("\x63\142\x74\142\x61\156\x6b\163\x6f\141\x6c")->with("\x65\162\x72\157\x72", "\x41\153\x73\145\x73\40\x64\151\x74\157\x6c\141\x6b\72\x20\120\x65\156\x67\145\x6c\157\x6c\141\x61\156\x20\144\x61\156\x20\160\x65\155\x62\165\x61\164\x61\156\x20\152\x61\144\x77\141\x6c\40\x75\152\x69\141\x6e\40\x68\141\x6e\171\x61\40\x64\141\x70\141\x74\40\x64\151\x6c\141\x6b\165\x6b\141\x6e\40\x6f\154\x65\150\x20\101\x64\155\x69\156\x69\163\x74\162\x61\164\x6f\162\x20\57\x20\120\x61\156\x69\164\x69\141\x20\125\x6a\151\x61\156\x2e");
 }
 goto L_ef948;
 L_cea08:
 $_0xc79f["\x61\144\x61\137\x75\152\x69\141\x6e"] = $this->cbtModel->getDataJadwalByTgl(date("\x59\55\x6d\55\x64"));
 goto L_48fdc;
 L_0a48c:
 $_0xc79f = ["\x75\163\x65\162" => $_0x7c29, "\x69\163\x5f\141\x64\155\x69\156" => $_0xe620, "\x69\163\x5f\156\x75\162\x75\154\x5f\150\x61\153\x69\155" => $_0x41b8, "\x6a\165\x64\165\x6c" => "\x4a\141\x64\167\x61\154\x20\120\x65\156\x69\154\x61\151\x61\156", "\x73\165\x62\152\x75\144\x75\154" => "\x4a\141\x64\167\x61\154\x20\125\x6a\151\x61\156\x2f\125\x6c\141\x6e\147\x61\156", "\x73\145\x74\164\x69\156\x67" => $_0x1932, "\x74\160" => $this->dashboardModel->getTahun(), "\x74\160\x5f\141\x63\164\x69\166\x65" => $_0x7d6c, "\x73\155\x74" => $this->dashboardModel->getSemester(), "\x73\155\x74\137\x61\143\x74\151\x76\145" => $_0xfca1];
 goto L_3c3de;
 L_343ed:
 $_0xc79f["\x6a\155\x6c\111\x73\164"] = [];
 goto L_d3227;
 L_2cb2e:
 $_0xc79f["\x6a\141\x64\167\x61\154"] = $this->cbtModel->dummyJadwal();
 goto L_343ed;
 L_5e31a:
 $_0xf768 = $this->request->getGet("\x74\171\x70\145");
 goto L_013b2;
 L_a4a61:
 $_0xc79f["\x69\144\x5f\155\x61\160\x65\154"] = '';
 goto L_66e7b;
 L_4d537:
 $_0x7d6c = $this->dashboardModel->getTahunActive();
 goto L_fc614;
 L_c612f:
 $_0xc79f["\x6d\157\x64\145"] = $_0xf088 == null ? "\x31" : $_0xf088;
 goto L_e3be8;
 L_5f86c:
 $_0x1dff = $_0x92ca == null ? "\x30" : $_0x92ca;
 goto L_9f2ba;
 }
 protected function cekRekapSiswa()
 {
 // Dummy implementation since logic was not provided
 return [];
 }
 public function add($_0xb4c5)
 {
 goto L_9f6b5;
 L_2123e:
 $_0xc1d5 = $this->request->getGet("\x65\156\x61\142\x6c\145");
 goto L_7769a;
 L_2e719:
 $_0x54e6["\x6a\141\x64\167\x61\154"] = $_0x26d6;
 goto L_d1900;
 L_44d7f:
 $_0x54e6["\x64\151\x73\141\x62\154\x65\137\x6f\160\x73\151"] = $_0xc1d5 != null && $_0xc1d5 == 1;
 goto L_eb08f;
 L_38117:
 $_0x7234 = (string) $_0x9b25->get("\x72\157\x6c\145") === "\x31";
 goto L_e66e2;
 L_d1900:
 $_0xf270 = $this->dropdownModel->getAllGuru();
 goto L_df80a;
 L_eb08f:
 if ($_0x7234) {
 $_0x54e6["\x67\165\x72\165"] = $_0xf270;
 $_0x54e6["\x6d\141\x70\145\x6c"] = $this->dropdownModel->getAllMapel();
 return view("\x63\142\x74\57\x6a\141\x64\167\x61\154\x2f\141\x64\144", $_0x54e6);
 } else {
 // Guru branch not implemented for dummy user
 }
 L_a4cc9:
 $_0x54e6["\x6b\145\x6c\141\x73"] = $this->cbtModel->getKelas($_0x2b36->id_tp, $_0xaafb->id_smt);
 goto L_44d7f;
 L_b0463:
 $_0x54e6["\x6a\145\x6e\151\x73"] = $this->dropdownModel->getAllJenisUjian();
 goto L_a4cc9;
 L_7df4c:
 $_0x2b36 = $this->dashboardModel->getTahunActive();
 goto L_c9c37;
 L_7769a:
 $_0x1342 = $this->dashboardModel->getSetting();
 goto L_df82d;
 L_df82d:
 $_0x54e6 = ["\x75\163\x65\162" => $_0xcaa6, "\x6a\165\x64\165\x6c" => $_0xb4c5 == 0 ? "\x54\141\x6d\142\x61\150\x20\112\x61\144\x77\141\x6c\40\x55\152\x69\141\x6e" : "\x45\144\x69\164\x20\112\x61\144\x77\141\x6c\40\x55\152\x69\141\x6e", "\x73\165\x62\152\x75\144\x75\154" => "\x4a\141\x64\167\x61\154\x20\125\x6a\151\x61\156", "\x73\145\x74\164\x69\156\x67" => $_0x1342];
 goto L_7df4c;
 L_96762:
 $_0x54e6["\x74\160"] = $this->dashboardModel->getTahun();
 goto L_d0932;
 L_c9c37:
 $_0xaafb = $this->dashboardModel->getSemesterActive();
 goto L_96762;
 L_b712e:
 $_0x54e6["\x73\155\x74"] = $this->dashboardModel->getSemester();
 goto L_528de;
 L_df80a:
 $_0x54e6["\x72\165\x61\156\x67\163"] = $this->cbtModel->getRuang();
 goto L_b2ff4;
 L_9b7d9:
 if ($_0xb4c5 == 0) {
 $_0x26d6 = $this->cbtModel->dummyJadwal();
 $_0x26d6->bank_kelas = [];
 } else {
 $_0x26d6 = $this->cbtModel->getJadwalById($_0xb4c5);
 $_0x26d6->bank_kelas = $this->maybe_unserialize($_0x26d6->bank_kelas ?? "\x5b\135");
 }
 goto L_2e719;
 L_b5b22:
 $_0xcaa6 = (object) ["\x69\144" => $_0x9b25->get("\x69\144\x5f\165\x73\145\x72"), "\x66\151\x72\163\x74\137\x6e\141\x6d\145" => $_0x9b25->get("\x75\163\x65\162\x6e\141\x6d\145"), "\x72\157\x6c\145\x5f\156\x61\155\x65" => $_0x9b25->get("\x72\157\x6c\145\x5f\156\x61\155\x65"), "\x66\157\x74\157" => $_0x9b25->get("\x66\157\x74\157") ?? ''];
 goto L_2123e;
 L_d0932:
 $_0x54e6["\x74\160\x5f\141\x63\164\x69\166\x65"] = $_0x2b36;
 goto L_b712e;
 L_e66e2:
 if (!$_0x7234) {
 return redirect()->to("\x63\142\x74\152\x61\144\x77\141\x6c")->with("\x65\162\x72\157\x72", "\x41\153\x73\145\x73\40\x64\151\x74\157\x6c\141\x6b\72\x20\110\x61\156\x79\141\x20\101\x64\155\x69\156\x69\163\x74\162\x61\164\x6f\162\x20\171\x61\156\x67\40\x62\145\x72\150\x61\153\x20\155\x65\156\x61\155\x62\141\x68\40\x61\164\x61\165\x20\155\x65\156\x67\145\x64\151\x74\40\x4a\141\x64\167\x61\154\x20\125\x6a\151\x61\156\x2e");
 }
 goto L_b5b22;
 L_b2ff4:
 $_0x54e6["\x73\145\x73\151\x73"] = $this->dropdownModel->getAllSesi();
 goto L_b0463;
 L_528de:
 $_0x54e6["\x73\155\x74\137\x61\143\x74\151\x76\145"] = $_0xaafb;
 goto L_9b7d9;
 L_9f6b5:
 $_0x9b25 = session();
 goto L_38117;
 }
 public function getBankMapel($_0xfb19)
 {
 goto L_0188a;
 L_f0356:
 $_0x8521 = true;
 goto L_81026;
 L_a29e2:
 return $this->response->setJSON(["\x62\141\x6e\153" => $_0x82a4, "\x6a\141\x64\167\x61\154" => $_0xa298, "\x6b\145\x6c\141\x73" => $_0xe9c2, "\x61\154\x6c\137\x6b\145\x6c\141\x73" => $_0xe658]);
 L_54d7a:
 $_0x2ae9 = $this->dashboardModel->getSemesterActive();
 goto L_f0356;
 L_7587d:
 $_0xe658 = $this->cbtModel->getKelas($_0xab24->id_tp, $_0x2ae9->id_smt);
 goto L_a29e2;
 L_ef7b0:
 $_0xe9c2 = [];
 goto L_d4e59;
 L_a1f61:
 $_0xa298 = [];
 goto L_ef7b0;
 L_0188a:
 $_0xab24 = $this->dashboardModel->getTahunActive();
 goto L_54d7a;
 L_d4e59:
 foreach ($_0x2d71 as $_0x79c7 => $_0x121c) {
 $_0xfeea = $this->cbtModel->getJumlahJenisSoal($_0x79c7);
 $_0x8b1d = isset($_0xfeea["\x31"]) ? count($_0xfeea["\x31"]) : 0;
 $_0xa15e = isset($_0xfeea["\x32"]) ? count($_0xfeea["\x32"]) : 0;
 $_0xcf1a = isset($_0xfeea["\x33"]) ? count($_0xfeea["\x33"]) : 0;
 $_0xcca9 = isset($_0xfeea["\x34"]) ? count($_0xfeea["\x34"]) : 0;
 $_0x312f = isset($_0xfeea["\x35"]) ? count($_0xfeea["\x35"]) : 0;
 $_0xee4b = $_0x8b1d == (int) $_0x121c->tampil_pg;
 $_0x8bf9 = $_0xa15e == (int) $_0x121c->tampil_kompleks;
 $_0xa3fa = $_0xcf1a == (int) $_0x121c->tampil_jodohkan;
 $_0x492a = $_0xcca9 == (int) $_0x121c->tampil_isian;
 $_0x9151 = $_0x312f == (int) $_0x121c->tampil_esai;
 if ($_0xee4b && $_0x8bf9 && $_0xa3fa && $_0x492a && $_0x9151) {
 $_0xe9c2[$_0x79c7] = $this->maybe_unserialize($_0x121c->bank_kelas ?? "\x5b\135");
 $_0x82a4[$_0x79c7] = $_0x121c->bank_kode;
 if ($_0x121c->id_jadwal) {
 $_0xa298[] = $_0x121c->id_bank;
 }
 }
 }
 goto L_7587d;
 L_81026:
 // TODO: Implement real auth
 if ($_0x8521) {
 $_0x2d71 = $this->cbtModel->getAllBankSoalByMapel($_0xab24->id_tp, $_0x2ae9->id_smt, $_0xfb19);
 } else {
 // $guru = ...
 // $banks = $this->cbtModel->getAllBankSoalByMapel($tp->id_tp, $smt->id_smt, $id_mapel, $guru->id_guru);
 }
 goto L_94a1c;
 L_94a1c:
 $_0x82a4 = [];
 goto L_a1f61;
 }
 public function saveJadwal()
 {
 goto L_aa423;
 L_99945:
 $_0xa376["\x73\165\x63\143\x65\163\x73"] = $_0xcdc7;
 goto L_9aab7;
 L_c5bd0:
 $_0xe978 = $this->dashboardModel->getTahunActive();
 goto L_9072e;
 L_9072e:
 $_0x6fd8 = $this->dashboardModel->getSemesterActive();
 goto L_3a273;
 L_4b20b:
 $_0x42d5 = $this->request->getPost("\x61\143\x61\153\x5f\157\x70\163\x69");
 goto L_bac6a;
 L_fd1d7:
 return $this->response->setJSON($_0xa376);
 L_8ab1c:
 $_0xaef3 = $this->request->getPost("\x6b\141\x6d\145\x72\141");
 goto L_84863;
 L_aa423:
 $_0x2973 = (string) session()->get("\x72\157\x6c\145") === "\x31";
 goto L_cb742;
 L_3babd:
 try {
 $_0xe45a = \Config\Database::connect();
 if (!$_0xe45a->fieldExists("\x6b\141\x6d\145\x72\141", "\x63\142\x74\137\x6a\141\x64\167\x61\154")) {
 $_0xc7ba = \Config\Database::forge();
 $_0xc7ba->addColumn("\x63\142\x74\137\x6a\141\x64\167\x61\154", ["\x6b\141\x6d\145\x72\141" => ["\x74\171\x70\145" => "\x49\116\x54", "\x63\157\x6e\163\x74\162\x61\151\x6e\164" => 11, "\x64\145\x66\141\x75\154\x74" => 0]]);
 }
 } catch (\Throwable $_0x7b1a) {
 }
 goto L_a2b6a;
 L_3a273:
 $_0xc7e5 = $this->request->getPost("\x69\144\x5f\152\x61\144\x77\141\x6c");
 goto L_b9714;
 L_147b0:
 $_0x5446 = strip_tags($this->request->getPost("\x62\141\x6e\153\x5f\151\x64") ?? '');
 goto L_6e0d1;
 L_a096d:
 $_0x8c9a = strip_tags($this->request->getPost("\x64\165\x72\141\x73\151\x5f\165\x6a\151\x61\156") ?? '');
 goto L_bc271;
 L_25469:
 $_0x5c1d = strip_tags($this->request->getPost("\x74\147\x6c\137\x6d\165\x6c\141\x69") ?? '');
 goto L_e2980;
 L_e41ad:
 $_0x6f24 = $this->request->getPost("\x72\145\x73\145\x74\137\x6c\157\x67\151\x6e");
 goto L_d8e6f;
 L_de8f8:
 $_0xcdc7 = $this->request->getPost("\x73\164\x61\164\x75\163");
 goto L_e41ad;
 L_89437:
 $_0xcdc7 = $_0x60b5["\x73\165\x63\143\x65\163\x73"];
 goto L_99945;
 L_bac6a:
 $_0x96ff = $this->request->getPost("\x68\141\x73\151\x6c\137\x74\141\x6d\160\x69\154");
 goto L_284c7;
 L_a2b6a:
 $_0x60b5 = $this->cbtModel->saveJadwalUjian($_0xf688, $_0xc7e5);
 goto L_89437;
 L_cb742:
 if (!$_0x2973) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x41\153\x73\145\x73\40\x64\151\x74\157\x6c\141\x6b\72\x20\110\x61\156\x79\141\x20\101\x64\155\x69\156\x69\163\x74\162\x61\164\x6f\162\x20\171\x61\156\x67\40\x62\145\x72\150\x61\153\x20\155\x65\156\x79\151\x6d\160\x61\156\x20\112\x61\144\x77\141\x6c\40\x55\152\x69\141\x6e\56"]);
 }
 goto L_c5bd0;
 L_8e357:
 if (!empty($_0xc7e5)) {
 $_0xe5d0 = $this->cbtModel->getJadwalById($_0xc7e5);
 if ($_0xe5d0) {
 if ($_0xd33c === null) {
 $_0xd33c = $_0xe5d0->acak_soal;
 }
 if ($_0x42d5 === null) {
 $_0x42d5 = $_0xe5d0->acak_opsi;
 }
 }
 }
 goto L_bf13c;
 L_bc271:
 $_0x3fed = strip_tags($this->request->getPost("\x6a\141\x72\141\x6b") ?? '');
 goto L_8e357;
 L_84863:
 $_0x9c4c = $this->request->getPost("\x6c\157\x63\153\x5f\142\x72\157\x77\163\x65\162") ?? "\x30";
 goto L_147b0;
 L_bf13c:
 $_0xf688 = array("\x69\144\x5f\164\x70" => $_0xe978->id_tp, "\x69\144\x5f\163\x6d\164" => $_0x6fd8->id_smt, "\x69\144\x5f\142\x61\156\x6b" => $_0x5446, "\x69\144\x5f\152\x65\156\x69\163" => $_0x63bd, "\x74\147\x6c\137\x6d\165\x6c\141\x69" => $_0x5c1d, "\x74\147\x6c\137\x73\145\x6c\145\x73\141\x69" => $_0x91d0, "\x64\165\x72\141\x73\151\x5f\165\x6a\151\x61\156" => $_0x8c9a, "\x6a\141\x72\141\x6b" => $_0x3fed, "\x61\143\x61\153\x5f\163\x6f\141\x6c" => $_0xd33c ? "\x31" : "\x30", "\x61\143\x61\153\x5f\157\x70\163\x69" => $_0x42d5 ? "\x31" : "\x30", "\x68\141\x73\151\x6c\137\x74\141\x6d\160\x69\154" => $_0x96ff ? "\x31" : "\x30", "\x74\157\x6b\145\x6e" => $_0xe709 ? "\x31" : "\x30", "\x73\164\x61\164\x75\163" => $_0xcdc7 ? "\x31" : "\x30", "\x72\145\x73\145\x74\137\x6c\157\x67\151\x6e" => $_0x6f24 ? "\x31" : "\x30", "\x70\145\x6c\141\x6e\147\x67\141\x72\141\x6e" => $_0xb56f ? "\x31" : "\x30", "\x6b\141\x6d\145\x72\141" => $_0xaef3 ? "\x31" : "\x30", "\x6c\157\x63\153\x5f\142\x72\157\x77\163\x65\162" => (int) $_0x9c4c, "\x75\154\x61\156\x67" => 0);
 goto L_3babd;
 L_d8e6f:
 $_0xb56f = $this->request->getPost("\x70\145\x6c\141\x6e\147\x67\141\x72\141\x6e");
 goto L_8ab1c;
 L_e2980:
 $_0x91d0 = strip_tags($this->request->getPost("\x74\147\x6c\137\x73\145\x6c\145\x73\141\x69") ?? '');
 goto L_a096d;
 L_b9714:
 $_0xd33c = $this->request->getPost("\x61\143\x61\153\x5f\163\x6f\141\x6c");
 goto L_4b20b;
 L_6e0d1:
 $_0x63bd = strip_tags($this->request->getPost("\x6a\145\x6e\151\x73\137\x69\144") ?? '');
 goto L_25469;
 L_9aab7:
 $_0xa376["\x6d\145\x73\163\x61\147\x65"] = $_0xcdc7 ? "\x4a\141\x64\167\x61\154\x20\142\x65\162\x68\141\x73\151\x6c\40\x64\151\x73\151\x6d\160\x61\156" : $_0x60b5["\x65\162\x72\157\x72\163"] ?? "\x42\141\x6e\153\x20\163\x6f\141\x6c\40\x73\165\x64\141\x68\40\x64\151\x67\165\x6e\141\x6b\141\x6e";
 goto L_fd1d7;
 L_284c7:
 $_0xe709 = $this->request->getPost("\x74\157\x6b\145\x6e");
 goto L_de8f8;
 }
 public function aktifkan_jadwal()
 {
 goto L_95c81;
 L_52a76:
 $_0xea66 = \Config\Database::connect();
 goto L_d0e94;
 L_7aed8:
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => true]);
 L_aa6f7:
 if ($_0x2be8 && !((string) session()->get("\x72\157\x6c\145") === "\x31")) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x41\153\x73\145\x73\40\x64\151\x74\157\x6c\141\x6b\72\x20\110\x61\156\x79\141\x20\101\x64\155\x69\156\x69\163\x74\162\x61\164\x6f\162\x20\171\x61\156\x67\40\x62\145\x72\150\x61\153\x20\155\x65\156\x67\165\x62\141\x68\40\x73\164\x61\164\x75\163\x20\112\x61\144\x77\141\x6c\40\x55\152\x69\141\x6e\56"]);
 }
 goto L_b0735;
 L_95c81:
 $_0x2be8 = isset($_SERVER["\x48\124\x54\120\x5f\110\x4f\123\x54"]) && strpos($_SERVER["\x48\124\x54\120\x5f\110\x4f\123\x54"], "\x6e\165\x72\165\x6c\150\x61\153\x69\155\x2e\163\x63\150\x2e\151\x64") !== false || strpos(base_url(), "\x6e\165\x72\165\x6c\150\x61\153\x69\155\x2e\163\x63\150\x2e\151\x64") !== false;
 goto L_aa6f7;
 L_b0735:
 $_0xb6e9 = $this->request->getPost("\x6d\145\x74\150\x6f\144");
 goto L_821e9;
 L_821e9:
 $_0xbdd3 = $this->request->getPost("\x69\144\x5f\152\x61\144\x77\141\x6c");
 goto L_64281;
 L_d0e94:
 $_0xea66->table("\x63\142\x74\137\x6a\141\x64\167\x61\154")->where("\x69\144\x5f\152\x61\144\x77\141\x6c", $_0xbdd3)->update(["\x73\164\x61\164\x75\163" => $_0xa87f]);
 goto L_7aed8;
 L_64281:
 $_0xa87f = $_0xb6e9 == "\x31" ? "\x30" : "\x31";
 goto L_52a76;
 }
 public function deleteJadwal()
 {
 goto L_075bc;
 L_18f5c:
 $_0x89f5["\x73\164\x61\164\x75\163"] = $_0x64e5;
 goto L_e5478;
 L_afd5e:
 $_0x3da4 = $_0xfe67->table("\x63\142\x74\137\x72\145\x6b\141\x70\137\x6a\141\x64\167\x61\154")->where("\x69\144\x5f\152\x61\144\x77\141\x6c", $_0x54b0)->countAllResults();
 goto L_e491c;
 L_e5478:
 $_0x89f5["\x6d\145\x73\163\x61\147\x65"] = $_0x64e5 ? "\x62\145\x72\150\x61\163\x69\154" : "\x4a\141\x64\167\x61\154\x20\125\x6a\151\x61\156\x20\147\x61\147\x61\154\x20\144\x69\150\x61\160\x75\163";
 goto L_95bcb;
 L_446f2:
 $_0x64e5 = $this->hapus($_0x54b0);
 goto L_18f5c;
 L_075bc:
 $_0xf28c = (string) session()->get("\x72\157\x6c\145") === "\x31";
 goto L_73516;
 L_98e46:
 $_0xfcfc = isset($_0xaa90[$_0x54b0]) && count($_0xaa90[$_0x54b0]) > 0;
 goto L_1c9e2;
 L_73516:
 if (!$_0xf28c) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x41\153\x73\145\x73\40\x64\151\x74\157\x6c\141\x6b\72\x20\110\x61\156\x79\141\x20\101\x64\155\x69\156\x69\163\x74\162\x61\164\x6f\162\x20\171\x61\156\x67\40\x62\145\x72\150\x61\153\x20\155\x65\156\x67\150\x61\160\x75\163\x20\112\x61\144\x77\141\x6c\40\x55\152\x69\141\x6e\56"]);
 }
 goto L_75774;
 L_95bcb:
 return $this->response->setJSON($_0x89f5);
 L_e491c:
 if ($_0xfcfc && $_0x3da4 == 0) {
 $_0x89f5["\x6d\145\x73\163\x61\147\x65"] = "\x48\141\x73\151\x6c\40\x55\152\x69\141\x6e\40\x62\145\x6c\165\x6d\40\x64\151\x72\145\x6b\141\x70";
 return $this->response->setJSON($_0x89f5);
 }
 goto L_446f2;
 L_a129f:
 $_0xaa90 = $this->getJadwalTerpakai();
 goto L_98e46;
 L_75774:
 $_0x54b0 = $this->request->getGet("\x69\144\x5f\152\x61\144\x77\141\x6c");
 goto L_a129f;
 L_1c9e2:
 $_0xfe67 = \Config\Database::connect();
 goto L_afd5e;
 }
 private function hapus($_0x7f9a)
 {
 goto L_821d2;
 L_744c7:
 return true;
 L_2e4de:
 if ($this->masterModel->deleteData("\x63\142\x74\137\x6a\141\x64\167\x61\154", $_0x7f9a, "\x69\144\x5f\152\x61\144\x77\141\x6c")) {
 $this->masterModel->deleteData("\x63\142\x74\137\x73\151\x73\167\x61", $_0x7f9a, "\x69\144\x5f\152\x61\144\x77\141\x6c");
 $this->masterModel->deleteData("\x63\142\x74\137\x70\145\x6e\147\x61\167\x61\163", $_0x7f9a, "\x69\144\x5f\152\x61\144\x77\141\x6c");
 $_0xe011->table("\x63\142\x74\137\x72\145\x6b\141\x70\137\x6a\141\x64\167\x61\154")->where("\x69\144\x5f\152\x61\144\x77\141\x6c", $_0x7f9a)->delete();
 $_0xe011->table("\x63\142\x74\137\x72\145\x6b\141\x70\137\x73\151\x73\167\x61")->where("\x69\144\x5f\152\x61\144\x77\141\x6c", $_0x7f9a)->delete();
 $_0xe011->table("\x63\142\x74\137\x73\157\x61\154\x5f\163\x69\163\x77\141")->where("\x69\144\x5f\152\x61\144\x77\141\x6c", $_0x7f9a)->delete();
 $_0xe011->table("\x63\142\x74\137\x6e\151\x6c\141\x69")->where("\x69\144\x5f\152\x61\144\x77\141\x6c", $_0x7f9a)->delete();
 return true;
 }
 goto L_744c7;
 L_821d2:
 $_0xe011 = \Config\Database::connect();
 goto L_2e4de;
 }
 public function deleteAllJadwal()
 {
 goto L_91d0e;
 L_2b1e2:
 foreach ($_0x4e1e as $_0xd556) {
 $_0x4c39[$_0xd556->id_jadwal] = $_0xd556->id_jadwal;
 }
 goto L_5e587;
 L_de710:
 $_0xe8f9 = array_count_values($_0x4691);
 goto L_df9ac;
 L_fa946:
 $_0xe084["\x62\141\x63\153\x75\160\x65\144"] = $_0x4c39;
 goto L_1e010;
 L_3ac2a:
 $_0x99cd = \Config\Database::connect();
 goto L_96a10;
 L_b4388:
 if (empty($_0x53e9)) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x54\151\x64\141\x6b\40\x61\144\x61\40\x64\141\x74\141\x20\144\x69\160\x69\154\x69\150"]);
 }
 goto L_3ac2a;
 L_91d0e:
 $_0x5ede = (string) session()->get("\x72\157\x6c\145") === "\x31";
 goto L_f9148;
 L_1e010:
 return $this->response->setJSON($_0xe084);
 L_788d7:
 foreach ($_0x53e9 as $_0x23b0) {
 $_0x2e1f = isset($_0x7873[$_0x23b0]) && count($_0x7873[$_0x23b0]) > 0;
 $_0x4691[] = $_0x2e1f && !isset($_0x4c39[$_0x23b0]) ? 1 : 0;
 }
 goto L_de710;
 L_115e2:
 $_0x4c39 = [];
 goto L_2b1e2;
 L_f9148:
 if (!$_0x5ede) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x41\153\x73\145\x73\40\x64\151\x74\157\x6c\141\x6b\72\x20\110\x61\156\x79\141\x20\101\x64\155\x69\156\x69\163\x74\162\x61\164\x6f\162\x20\171\x61\156\x67\40\x62\145\x72\150\x61\153\x20\155\x65\156\x67\150\x61\160\x75\163\x20\112\x61\144\x77\141\x6c\40\x55\152\x69\141\x6e\56"]);
 }
 goto L_2b413;
 L_df9ac:
 if (isset($_0xe8f9[1]) && $_0xe8f9[1] > 0) {
 $_0xe084["\x73\164\x61\164\x75\163"] = false;
 $_0xe084["\x6d\145\x73\163\x61\147\x65"] = "\x41\144\x61\40\x68\141\x73\151\x6c\40\x55\152\x69\141\x6e\40\x79\141\x6e\147\x20\142\x65\154\x75\155\x20\144\x69\162\x65\153\x61\160";
 } else {
 $_0x70ec = $_0x99cd->table("\x63\142\x74\137\x6a\141\x64\167\x61\154")->whereIn("\x69\144\x5f\152\x61\144\x77\141\x6c", $_0x53e9)->delete();
 if ($_0x70ec) {
 $_0x99cd->table("\x63\142\x74\137\x73\151\x73\167\x61")->whereIn("\x69\144\x5f\152\x61\144\x77\141\x6c", $_0x53e9)->delete();
 $_0x99cd->table("\x63\142\x74\137\x70\145\x6e\147\x61\167\x61\163")->whereIn("\x69\144\x5f\152\x61\144\x77\141\x6c", $_0x53e9)->delete();
 $_0x99cd->table("\x63\142\x74\137\x72\145\x6b\141\x70\137\x6a\141\x64\167\x61\154")->whereIn("\x69\144\x5f\152\x61\144\x77\141\x6c", $_0x53e9)->delete();
 $_0x99cd->table("\x63\142\x74\137\x72\145\x6b\141\x70\137\x73\151\x73\167\x61")->whereIn("\x69\144\x5f\152\x61\144\x77\141\x6c", $_0x53e9)->delete();
 $_0x99cd->table("\x63\142\x74\137\x73\157\x61\154\x5f\163\x69\163\x77\141")->whereIn("\x69\144\x5f\152\x61\144\x77\141\x6c", $_0x53e9)->delete();
 $_0x99cd->table("\x63\142\x74\137\x6e\151\x6c\141\x69")->whereIn("\x69\144\x5f\152\x61\144\x77\141\x6c", $_0x53e9)->delete();
 $this->logging->saveLog(5, "\x6d\145\x6e\147\x68\141\x70\165\x73\40\x73\145\x6d\165\x61\40\x6a\141\x64\167\x61\154\x20\165\x6a\151\x61\156");
 $_0xe084["\x73\164\x61\164\x75\163"] = true;
 $_0xe084["\x6d\145\x73\163\x61\147\x65"] = "\x62\145\x72\150\x61\163\x69\154";
 } else {
 $_0xe084["\x73\164\x61\164\x75\163"] = false;
 $_0xe084["\x6d\145\x73\163\x61\147\x65"] = "\x4a\141\x64\167\x61\154\x20\125\x6a\151\x61\156\x20\163\x65\144\x61\156\x67\40\x64\151\x67\165\x6e\141\x6b\141\x6e";
 }
 }
 goto L_b7c31;
 L_96a10:
 $_0x4e1e = $_0x99cd->table("\x63\142\x74\137\x72\145\x6b\141\x70\137\x6a\141\x64\167\x61\154")->select("\x69\144\x5f\152\x61\144\x77\141\x6c")->whereIn("\x69\144\x5f\152\x61\144\x77\141\x6c", $_0x53e9)->get()->getResult();
 goto L_115e2;
 L_5420b:
 $_0x4691 = [];
 goto L_788d7;
 L_2b413:
 $_0x53e9 = json_decode($this->request->getPost("\x63\150\x65\143\x6b\145\x64"));
 goto L_b4388;
 L_b7c31:
 $_0xe084["\x64\151\x67\165\x6e\141\x6b\141\x6e"] = $_0xe8f9;
 goto L_fa946;
 L_5e587:
 $_0x7873 = $this->cbtModel->getJadwalTerpakai();
 goto L_5420b;
 }
 public function get_all_norekap()
 {
 goto L_40cd2;
 L_3ab09:
 $_0xad0d->join("\x63\142\x74\137\x73\145\x73\151\x5f\163\x69\163\x77\141\x20\142", "\x61\56\x69\144\x5f\163\x69\163\x77\141\x20\75\x20\142\x2e\163\x69\163\x77\141\x5f\151\x64\40\x41\116\x44\40\x61\56\x69\144\x5f\164\x70\40\x3d\40\x62\56\x74\160\x5f\151\x64\40\x41\116\x44\40\x61\56\x69\144\x5f\163\x6d\164\x20\75\x20\142\x2e\163\x6d\164\x5f\151\x64", "\x6c\145\x66\164");
 goto L_2e2be;
 L_3a7e6:
 $_0x5558 = \Config\Database::connect();
 goto L_000ae;
 L_51929:
 $_0x8906 = [];
 goto L_f096c;
 L_39c87:
 $_0x25eb = [];
 goto L_5f589;
 L_09d14:
 return $this->response->setJSON($_0x2c11);
 L_e24de:
 foreach ($_0x8c5c as $_0x47b9) {
 $_0xc64c[] = $_0x47b9->id_siswa;
 $_0x25eb[$_0x47b9->id_siswa] = $_0x47b9->id_tp;
 $_0xbaf6[$_0x47b9->id_siswa] = $_0x47b9->id_smt;
 $_0x47b9->jawaban_pg = !empty($_0x47b9->jawaban_pg) ? @unserialize($_0x47b9->jawaban_pg) : null;
 $_0x47b9->soal_kompleks = !empty($_0x47b9->soal_kompleks) ? @unserialize($_0x47b9->soal_kompleks) : null;
 $_0x47b9->soal_jodohkan = !empty($_0x47b9->soal_jodohkan) ? @unserialize($_0x47b9->soal_jodohkan) : null;
 $_0x47b9->soal_isian = !empty($_0x47b9->soal_isian) ? @unserialize($_0x47b9->soal_isian) : null;
 $_0x47b9->soal_essai = !empty($_0x47b9->soal_essai) ? @unserialize($_0x47b9->soal_essai) : null;
 if ($_0x47b9->jawaban_pg === false) {
 $_0x47b9->jawaban_pg = json_decode($_0x47b9->jawaban_pg);
 }
 if ($_0x47b9->soal_kompleks === false) {
 $_0x47b9->soal_kompleks = json_decode($_0x47b9->soal_kompleks);
 }
 if ($_0x47b9->soal_jodohkan === false) {
 $_0x47b9->soal_jodohkan = json_decode($_0x47b9->soal_jodohkan);
 }
 if ($_0x47b9->soal_isian === false) {
 $_0x47b9->soal_isian = json_decode($_0x47b9->soal_isian);
 }
 if ($_0x47b9->soal_essai === false) {
 $_0x47b9->soal_essai = json_decode($_0x47b9->soal_essai);
 }
 }
 goto L_51929;
 L_000ae:
 $_0xad0d = $_0x5558->table("\x63\142\x74\137\x72\145\x6b\141\x70\137\x6e\151\x6c\141\x69\40\x61");
 goto L_22f2d;
 L_efe06:
 $_0xad0d->join("\x63\142\x74\137\x73\145\x73\151\x20\144", "\x64\56\x69\144\x5f\163\x65\163\x69\75\x62\56\x73\145\x73\151\x5f\151\x64", "\x6c\145\x66\164");
 goto L_4ac0e;
 L_809c5:
 $_0x2c11["\x72\145\x6b\141\x70"] = $_0x8c5c;
 goto L_3dde8;
 L_3bc6b:
 $_0xad0d->join("\x6c\157\x67\137\x75\152\x69\141\x6e\40\x67", "\x67\56\x69\144\x5f\163\x69\163\x77\141\x20\75\x20\141\x2e\151\x64\137\x73\151\x73\167\x61\40\x41\116\x44\40\x61\56\x69\144\x5f\152\x61\144\x77\141\x6c\40\x3d\40\x67\56\x69\144\x5f\152\x61\144\x77\141\x6c\40\x41\116\x44\40\x67\56\x6c\157\x67\137\x74\171\x70\145\x3d\47\x31\47", "\x6c\145\x66\164");
 goto L_5dda8;
 L_5dda8:
 $_0xad0d->whereIn("\x61\56\x69\144\x5f\152\x61\144\x77\141\x6c", $_0x1f6e);
 goto L_385b9;
 L_3dde8:
 $_0x2c11["\x73\157\x61\154\x5f\163\x69\163\x77\141"] = $_0x8906;
 goto L_09d14;
 L_40a89:
 $_0xc64c = [];
 goto L_39c87;
 L_385b9:
 $_0x8c5c = $_0xad0d->get()->getResult();
 goto L_40a89;
 L_40cd2:
 $_0x1f6e = json_decode($this->request->getPost("\x69\144\x73\137\x6a\141\x64\167\x61\154"));
 goto L_957a5;
 L_22f2d:
 $_0xad0d->select("\x61\56\x69\144\x5f\162\x65\153\x61\160\x5f\156\x69\154\x61\151\x2c\40\x61\56\x69\144\x5f\152\x61\144\x77\141\x6c\54\x20\141\x2e\151\x64\137\x74\160\x2c\40\x61\56\x74\160\x2c\40\x61\56\x69\144\x5f\163\x6d\164\x2c\40\x61\56\x73\155\x74\54\x20\141\x2e\151\x64\137\x6a\145\x6e\151\x73\54\x20\141\x2e\153\x6f\144\x65\137\x6a\145\x6e\151\x73\54" . "\x61\56\x69\144\x5f\142\x61\156\x6b\54\x20\141\x2e\151\x64\137\x6d\141\x70\145\x6c\54\x20\141\x2e\151\x64\137\x73\151\x73\167\x61\54\x20\141\x2e\151\x64\137\x6b\145\x6c\141\x73\54\x20\141\x2e\153\x65\154\x61\163\x2c\40\x61\56\x6d\165\x6c\141\x69\54\x20\141\x2e\163\x65\154\x65\163\x61\151\x2c\40\x61\56\x64\165\x72\141\x73\151\x2c\40\x61\56\x62\157\x62\157\x74\137\x70\147\x2c" . "\x61\56\x6a\141\x77\141\x62\141\x6e\137\x70\147\x2c\40\x61\56\x6e\151\x6c\141\x69\137\x70\147\x2c\40\x61\56\x62\157\x62\157\x74\137\x65\163\x61\151\x2c\40\x61\56\x6a\141\x77\141\x62\141\x6e\137\x65\163\x61\151\x2c\40\x61\56\x6e\151\x6c\141\x69\137\x65\163\x61\151\x2c\40\x61\56\x69\144\x5f\147\x75\162\x75\54\x20\141\x2e\156\x61\155\x61\137\x73\151\x73\167\x61\54\x20\141\x2e\156\x6f\137\x70\145\x73\145\x72\164\x61\54" . "\x61\56\x73\157\x61\154\x5f\153\x6f\155\x70\154\x65\153\x73\54\x20\141\x2e\163\x6f\141\x6c\137\x6a\157\x64\157\x68\153\x61\156\x2c\40\x61\56\x73\157\x61\154\x5f\151\x73\151\x61\156\x2c\40\x61\56\x73\157\x61\154\x5f\145\x73\163\x61\151\x2c" . "\x62\56\x73\151\x73\167\x61\137\x69\144\x2c\40\x62\56\x6b\145\x6c\141\x73\137\x69\144\x2c\40\x62\56\x72\165\x61\156\x67\137\x69\144\x2c\40\x62\56\x73\145\x73\151\x5f\151\x64\54\x20\142\x2e\164\x70\137\x69\144\x2c\40\x62\56\x73\155\x74\137\x69\144\x2c" . "\x63\56\x2a\54\x64\56\x2a\54\x67\56\x72\145\x73\145\x74\40\x61\163\x20\162\x65\163\x65\164\x5f\151\x7a\151\x6e\54" . "\x65\56\x69\144\x5f\156\x69\154\x61\151\x2c\40\x65\56\x70\147\x5f\142\x65\156\x61\162\x2c\40\x65\56\x70\147\x5f\156\x69\154\x61\151\x2c\40\x65\56\x65\163\x73\141\x69\137\x6e\151\x6c\141\x69\54\x20\145\x2e\153\x6f\155\x70\154\x65\153\x73\137\x6e\151\x6c\141\x69\54\x20\145\x2e\152\x6f\144\x6f\150\x6b\141\x6e\137\x6e\151\x6c\141\x69\54\x20\145\x2e\151\x73\151\x61\156\x5f\156\x69\154\x61\151\x2c\145\x2e\144\x69\153\x6f\162\x65\153\x73\151\x2c" . "\x66\56\x69\144\x5f\144\x75\162\x61\163\x69\54\x20\146\x2e\163\x74\141\x74\165\x73\54\x20\146\x2e\154\x61\155\x61\137\x75\152\x69\141\x6e\54\x20\146\x2e\155\x75\154\x61\151\x2c\40\x66\56\x73\145\x6c\145\x73\141\x69\54\x20\146\x2e\162\x65\163\x65\164\x20\141\x73\40\x72\145\x73\145\x74\137\x77\141\x6b\164\x75");
 goto L_3ab09;
 L_f096c:
 if (!empty($_0xc64c)) {
 $_0x8906 = $_0x5558->table("\x63\142\x74\137\x73\157\x61\154\x5f\163\x69\163\x77\141")->whereIn("\x69\144\x5f\152\x61\144\x77\141\x6c", $_0x1f6e)->whereIn("\x69\144\x5f\163\x69\163\x77\141", $_0xc64c)->get()->getResult();
 }
 goto L_aa213;
 L_2d521:
 $_0xad0d->join("\x63\142\x74\137\x64\165\x72\141\x73\151\x5f\163\x69\163\x77\141\x20\146", "\x66\56\x69\144\x5f\163\x69\163\x77\141\x20\75\x20\141\x2e\151\x64\137\x73\151\x73\167\x61\40\x41\116\x44\40\x61\56\x69\144\x5f\152\x61\144\x77\141\x6c\40\x3d\40\x66\56\x69\144\x5f\152\x61\144\x77\141\x6c", "\x6c\145\x66\164");
 goto L_3bc6b;
 L_aa213:
 $_0x2c11["\x73\165\x63\143\x65\163\x73"] = true;
 goto L_809c5;
 L_2e2be:
 $_0xad0d->join("\x63\142\x74\137\x72\165\x61\156\x67\40\x63", "\x63\56\x69\144\x5f\162\x75\141\x6e\147\x3d\142\x2e\162\x75\141\x6e\147\x5f\151\x64", "\x6c\145\x66\164");
 goto L_efe06;
 L_957a5:
 if (empty($_0x1f6e)) {
 return $this->response->setJSON(["\x73\165\x63\143\x65\163\x73" => false]);
 }
 goto L_3a7e6;
 L_4ac0e:
 $_0xad0d->join("\x63\142\x74\137\x6e\151\x6c\141\x69\40\x65", "\x65\56\x69\144\x5f\163\x69\163\x77\141\x20\75\x20\141\x2e\151\x64\137\x73\151\x73\167\x61\40\x41\116\x44\40\x61\56\x69\144\x5f\152\x61\144\x77\141\x6c\40\x3d\40\x65\56\x69\144\x5f\152\x61\144\x77\141\x6c", "\x6c\145\x66\164");
 goto L_2d521;
 L_5f589:
 $_0xbaf6 = [];
 goto L_e24de;
 }
 public function toggleAksesGuru()
 {
 goto L_db10a;
 L_76228:
 $_0xa65f = $this->request->getPost("\x73\164\x61\164\x75\163") == "\x31" ? "\x31" : "\x30";
 goto L_0e5b0;
 L_0e5b0:
 $_0x4c43 = \Config\Database::connect();
 goto L_2a0f7;
 L_a409e:
 \App\Models\DashboardModel::clearStaticCache();
 goto L_1be40;
 L_f7afb:
 if ($_0xbed0) {
 $_0x4c43->table("\x73\145\x74\164\x69\156\x67")->where("\x69\144\x5f\163\x65\164\x74\151\x6e\147", $_0xbed0->id_setting ?? 1)->update(["\x67\165\x72\165\x5f\142\x69\163\x61\137\x6a\141\x64\167\x61\154" => $_0xa65f]);
 } else {
 $_0x4c43->table("\x73\145\x74\164\x69\156\x67")->insert(["\x67\165\x72\165\x5f\142\x69\163\x61\137\x6a\141\x64\167\x61\154" => $_0xa65f]);
 }
 goto L_a409e;
 L_920af:
 $_0x491e = (string) $_0xc5f2->get("\x72\157\x6c\145") === "\x31";
 goto L_fc58f;
 L_d4511:
 $_0xbed0 = $_0x4c43->table("\x73\145\x74\164\x69\156\x67")->get()->getRow();
 goto L_f7afb;
 L_1be40:
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => true, "\x67\165\x72\165\x5f\142\x69\163\x61\137\x6a\141\x64\167\x61\154" => $_0xa65f, "\x6d\145\x73\163\x61\147\x65" => $_0xa65f == "\x31" ? "\x4d\145\x6e\165\x20\112\x61\144\x77\141\x6c\40\x55\152\x69\141\x6e\40\x75\156\x74\165\x6b\40\x61\153\x75\156\x20\147\x75\162\x75\40\x42\105\x52\110\x41\123\x49\114\x20\104\x49\101\x4b\124\x49\106\x4b\101\x4e\56" : "\x4d\145\x6e\165\x20\112\x61\144\x77\141\x6c\40\x55\152\x69\141\x6e\40\x75\156\x74\165\x6b\40\x61\153\x75\156\x20\147\x75\162\x75\40\x42\105\x52\110\x41\123\x49\114\x20\104\x49\123\x45\115\x42\125\x4e\131\x49\113\x41\116\x20\50\x48\141\x6e\171\x61\40\x41\144\x6d\151\x6e\40\x79\141\x6e\147\x20\144\x61\160\x61\164\x20\155\x65\156\x67\145\x6c\157\x6c\141\x20\152\x61\144\x77\141\x6c\40\x75\152\x69\141\x6e\51\x2e"]);
 L_fc58f:
 if (!$_0x491e) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x55\156\x61\165\x74\150\x6f\162\x69\172\x65\144\x3a\40\x48\141\x6e\171\x61\40\x61\144\x6d\151\x6e\151\x73\164\x72\141\x74\157\x72\40\x79\141\x6e\147\x20\144\x61\160\x61\164\x20\155\x65\156\x67\165\x62\141\x68\40\x70\145\x6e\147\x61\164\x75\162\x61\156\x20\151\x6e\151\x2e"]);
 }
 goto L_76228;
 L_db10a:
 $_0xc5f2 = session();
 goto L_920af;
 L_2a0f7:
 $this->dashboardModel->ensureJadwalSettings();
 goto L_d4511;
 }
}