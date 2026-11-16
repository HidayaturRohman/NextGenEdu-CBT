<?php
/*   ________________________________________
    |               NextGen Garuda CBT       |
    |    Protected & Distributed via GitHub  |
    |________________________________________|
*/
namespace App\Controllers;

use App\Models\MasterModel;
use App\Models\DashboardModel;
use App\Models\DropdownModel;
use App\Models\KelasModel;
class Kelascatatan extends BaseController
{
 protected $masterModel;
 protected $dashboardModel;
 protected $dropdownModel;
 protected $kelasModel;
 public function __construct()
 {
 goto L_f06f7;
 L_d77be:
 $this->dashboardModel = new DashboardModel();
 goto L_dafdf;
 L_1b42e:
 $this->kelasModel = new KelasModel();
 L_f06f7:
 $this->masterModel = new MasterModel();
 goto L_d77be;
 L_dafdf:
 $this->dropdownModel = new DropdownModel();
 goto L_1b42e;
 }
 public function index()
 {
 goto L_d83c0;
 L_0199d:
 $_0x3047["\x6d\141\x70\145\x6c\137\x73\145\x6c\145\x63\164\x65\144"] = $_0xb222;
 goto L_9a688;
 L_c44b9:
 $_0x1710 = $this->dashboardModel->getSemesterActive();
 goto L_60566;
 L_a3fc8:
 if ($_0xd0c7->get("\x72\157\x6c\145") != "\x31" && $_0xd0c7->get("\x72\157\x6c\145") != "\x32") {
 return redirect()->to("\x64\141\x73\150\x62\157\x61\162\x64")->with("\x65\162\x72\157\x72", "\x48\141\x6e\171\x61\40\x41\144\x6d\151\x6e\151\x73\164\x72\141\x74\157\x72\40\x64\141\x6e\40\x67\165\x72\165\x20\171\x61\156\x67\40\x64\151\x62\145\x72\151\x20\150\x61\153\x20\165\x6e\164\x75\153\x20\155\x65\156\x67\141\x6b\163\x65\163\x20\150\x61\154\x61\155\x61\156\x20\151\x6e\151\x2e");
 }
 goto L_3c5f2;
 L_3c5f2:
 $_0x8d7f = $this->dashboardModel->getTahunActive();
 goto L_c44b9;
 L_d83c0:
 $_0xd0c7 = session();
 goto L_9d635;
 L_9d635:
 if (!$_0xd0c7->get("\x69\163\x5f\154\x6f\147\x69\156")) {
 return redirect()->to("\x61\165\x74\150\x2f\154\x6f\147\x69\156");
 }
 goto L_a3fc8;
 L_78ff0:
 if ($_0xd0c7->get("\x72\157\x6c\145") == "\x31") {
 $_0x3047["\x6d\141\x70\145\x6c"] = $this->dropdownModel->getAllMapel();
 $_0x3047["\x6b\145\x6c\141\x73"] = $this->dropdownModel->getAllKelas($_0x8d7f->id_tp ?? null, $_0x1710->id_smt ?? null);
 return view("\x6d\145\x6d\142\x65\162\x73\57\x67\165\x72\165\x2f\153\x65\154\x61\163\x2f\143\x61\164\x61\164\x61\156\x2f\144\x61\164\x61", $_0x3047);
 } else {
 $_0x6d9d = $this->dashboardModel->getDataGuruByUserId($_0xd0c7->get("\x69\144\x5f\165\x73\145\x72"), $_0x8d7f->id_tp ?? null, $_0x1710->id_smt ?? null);
 $_0x3047["\x67\165\x72\165"] = $_0x6d9d;
 $_0x3047["\x69\144\x5f\147\x75\162\x75"] = $_0x6d9d->id_guru;
 $_0xab40 = $this->kelasModel->getGuruMapelKelas($_0x6d9d->id_guru, $_0x8d7f->id_tp ?? null, $_0x1710->id_smt ?? null);
 $_0x85dc = json_decode($_0xab40->mapel_kelas ?? "\x5b\135");
 $_0xc9b6 = [];
 if ($_0x85dc != null) {
 foreach ($_0x85dc as $_0xef54) {
 foreach ($_0xef54->kelas_mapel as $_0x205a) {
 array_push($_0xc9b6, $_0x205a->kelas);
 }
 }
 }
 $_0x1a79 = [];
 if (count($_0xc9b6) > 0) {
 $_0x1a79 = $this->dropdownModel->getAllKelasByArrayId($_0x8d7f->id_tp ?? null, $_0x1710->id_smt ?? null, $_0xc9b6);
 }
 $_0xb075 = [];
 $_0xc7ce = [];
 if ($_0x85dc != null) {
 foreach ($_0x85dc as $_0x6801) {
 $_0xb075[$_0x6801->id_mapel] = $_0x6801->nama_mapel;
 foreach ($_0x6801->kelas_mapel as $_0x205a) {
 foreach ($_0x1a79 as $_0x631a => $_0x8675) {
 if ($_0x205a->kelas == $_0x631a) {
 $_0xc7ce[$_0x6801->id_mapel][$_0x631a] = $_0x8675;
 }
 }
 }
 }
 }
 $_0x3047["\x6d\141\x70\145\x6c"] = $_0xb075;
 $_0x3047["\x6b\145\x6c\141\x73"] = $_0xc7ce;
 return view("\x6d\145\x6d\142\x65\162\x73\57\x67\165\x72\165\x2f\153\x65\154\x61\163\x2f\143\x61\164\x61\164\x61\156\x2f\144\x61\164\x61", $_0x3047);
 }
 L_9a688:
 if ($_0xda18 != null) {
 $_0x9854 = $this->kelasModel->getCatatanMapelKelas($_0xda18, $_0xb222, $_0x8d7f->id_tp ?? null, $_0x1710->id_smt ?? null);
 foreach ($_0x9854 as $_0xa2f6) {
 $_0xa2f6->reading = json_decode($_0xa2f6->reading) ?? [];
 }
 $_0x3047["\x63\141\x74\137\x6b\145\x6c\141\x73"] = $_0x9854;
 $_0x3047["\x63\141\x74\137\x73\151\x73\167\x61"] = $this->kelasModel->getCatatanMapelSiswa($_0x8d7f->id_tp ?? null, $_0x1710->id_smt ?? null, $_0xda18, $_0xb222);
 }
 goto L_78ff0;
 L_dcf80:
 $_0xb222 = $this->request->getGet("\x6d\141\x70\145\x6c");
 goto L_a7075;
 L_a7075:
 $_0x3047["\x6b\145\x6c\141\x73\137\x73\145\x6c\145\x63\164\x65\144"] = $_0xda18;
 goto L_0199d;
 L_60566:
 $_0x3047 = ["\x75\163\x65\162" => ["\x66\151\x72\163\x74\137\x6e\141\x6d\145" => $_0xd0c7->get("\x75\163\x65\162\x6e\141\x6d\145"), "\x72\157\x6c\145\x5f\156\x61\155\x65" => $_0xd0c7->get("\x72\157\x6c\145\x5f\156\x61\155\x65"), "\x66\157\x74\157" => $_0xd0c7->get("\x66\157\x74\157") ?? ''], "\x6a\165\x64\165\x6c" => "\x43\141\x74\141\x74\141\x6e\40\x47\165\x72\165", "\x73\165\x62\152\x75\144\x75\154" => "\x43\141\x74\141\x74\141\x6e\40\x53\145\x6c\141\x6d\141\x20\120\x65\155\x62\145\x6c\141\x6a\141\x72\141\x6e", "\x73\145\x74\164\x69\156\x67" => $this->dashboardModel->getSetting(), "\x74\160" => $this->dashboardModel->getTahun(), "\x74\160\x5f\141\x63\164\x69\166\x65" => $_0x8d7f, "\x73\155\x74" => $this->dashboardModel->getSemester(), "\x73\155\x74\137\x61\143\x74\151\x76\145" => $_0x1710, "\x69\163\x5f\141\x64\155\x69\156" => $_0xd0c7->get("\x72\157\x6c\145") == "\x31"];
 goto L_b88d1;
 L_b88d1:
 $_0xda18 = $this->request->getGet("\x6b\145\x6c\141\x73");
 goto L_dcf80;
 }
 public function siswa()
 {
 goto L_f9c66;
 L_f9c66:
 $_0x5476 = session();
 goto L_c1987;
 L_7d29f:
 $_0x62c5 = $this->dashboardModel->getSemesterActive();
 goto L_644a5;
 L_c402b:
 $_0xe911 = $this->request->getGet("\x69\144");
 goto L_40d41;
 L_96e35:
 $_0x9bb5["\x63\141\x74\141\x74\141\x6e\137\x73\151\x73\167\x61"] = $this->kelasModel->getAllCatatanMapelSiswa($_0xe911, $_0xd3f2, $_0x7d6c->id_tp ?? null, $_0x62c5->id_smt ?? null);
 goto L_5dd9f;
 L_644a5:
 $_0x9bb5 = ["\x75\163\x65\162" => ["\x66\151\x72\163\x74\137\x6e\141\x6d\145" => $_0x5476->get("\x75\163\x65\162\x6e\141\x6d\145"), "\x72\157\x6c\145\x5f\156\x61\155\x65" => $_0x5476->get("\x72\157\x6c\145\x5f\156\x61\155\x65"), "\x66\157\x74\157" => $_0x5476->get("\x66\157\x74\157") ?? ''], "\x6a\165\x64\165\x6c" => "\x43\141\x74\141\x74\141\x6e\40\x53\151\x73\167\x61", "\x73\165\x62\152\x75\144\x75\154" => "\x43\141\x74\141\x74\141\x6e\40\x53\151\x73\167\x61", "\x73\145\x74\164\x69\156\x67" => $this->dashboardModel->getSetting(), "\x74\160" => $this->dashboardModel->getTahun(), "\x74\160\x5f\141\x63\164\x69\166\x65" => $_0x7d6c, "\x73\155\x74" => $this->dashboardModel->getSemester(), "\x73\155\x74\137\x61\143\x74\151\x76\145" => $_0x62c5, "\x69\163\x5f\141\x64\155\x69\156" => $_0x5476->get("\x72\157\x6c\145") == "\x31"];
 goto L_3e087;
 L_3e087:
 $_0x9bb5["\x73\151\x73\167\x61"] = $this->masterModel->getSiswaById($_0xe911);
 goto L_96e35;
 L_5dd9f:
 $_0x9bb5["\x6d\141\x70\145\x6c"] = $_0xd3f2;
 goto L_1b578;
 L_8313e:
 if ($_0x5476->get("\x72\157\x6c\145") == "\x31") {
 return view("\x6d\145\x6d\142\x65\162\x73\57\x67\165\x72\165\x2f\153\x65\154\x61\163\x2f\143\x61\164\x61\164\x61\156\x2f\160\x65\162\x73\151\x73\167\x61", $_0x9bb5);
 } else {
 $_0x124b = $this->dashboardModel->getDataGuruByUserId($_0x5476->get("\x69\144\x5f\165\x73\145\x72"), $_0x7d6c->id_tp ?? null, $_0x62c5->id_smt ?? null);
 $_0x9bb5["\x67\165\x72\165"] = $_0x124b;
 return view("\x6d\145\x6d\142\x65\162\x73\57\x67\165\x72\165\x2f\153\x65\154\x61\163\x2f\143\x61\164\x61\164\x61\156\x2f\160\x65\162\x73\151\x73\167\x61", $_0x9bb5);
 }
 L_c1987:
 if (!$_0x5476->get("\x69\163\x5f\154\x6f\147\x69\156")) {
 return redirect()->to("\x61\165\x74\150\x2f\154\x6f\147\x69\156");
 }
 goto L_c402b;
 L_25449:
 $_0x7d6c = $this->dashboardModel->getTahunActive();
 goto L_7d29f;
 L_1b578:
 $_0x9bb5["\x6b\145\x6c\141\x73"] = $_0xf135;
 goto L_8313e;
 L_40d41:
 $_0xd3f2 = $this->request->getGet("\x6d\141\x70\145\x6c");
 goto L_b8982;
 L_b8982:
 $_0xf135 = $this->request->getGet("\x6b\145\x6c\141\x73");
 goto L_25449;
 }
 public function saveCatatanKelas()
 {
 goto L_8c4d2;
 L_d0058:
 $_0xc673 = ["\x69\144\x5f\164\x70" => $_0x74da->id_tp ?? null, "\x69\144\x5f\163\x6d\164" => $_0xcd96->id_smt ?? null, "\x74\171\x70\145" => "\x31", "\x69\144\x5f\155\x61\160\x65\154" => $_0xba83, "\x69\144\x5f\153\x65\154\x61\163" => $_0x9844, "\x69\144\x5f\147\x75\162\x75" => $_0x7b3a->id_guru, "\x6c\145\x76\145\x6c" => $_0x748e, "\x74\145\x78\164" => $_0x35b5, "\x72\145\x61\144\x69\156\x67" => json_encode([])];
 goto L_f5507;
 L_b1694:
 $_0x7b3a = $this->dashboardModel->getDataGuruByUserId($_0xa40e->get("\x69\144\x5f\165\x73\145\x72"), $_0x74da->id_tp ?? null, $_0xcd96->id_smt ?? null);
 goto L_18ed7;
 L_fc917:
 $_0xcd96 = $this->dashboardModel->getSemesterActive();
 goto L_b1694;
 L_8c4d2:
 $_0xa40e = session();
 goto L_d8fec;
 L_dab08:
 $_0x748e = $this->request->getPost("\x6c\145\x76\145\x6c");
 goto L_d0058;
 L_18ed7:
 $_0x9844 = $this->request->getPost("\x69\144\x5f\153\x65\154\x61\163");
 goto L_2b4d4;
 L_d8fec:
 $_0x74da = $this->dashboardModel->getTahunActive();
 goto L_fc917;
 L_11d1c:
 $_0x1a68 = $_0x8036->table("\x6b\145\x6c\141\x73\137\x63\141\x74\141\x74\141\x6e\137\x6d\141\x70\145\x6c")->insert($_0xc673);
 goto L_5e22b;
 L_2b4d4:
 $_0xba83 = $this->request->getPost("\x69\144\x5f\155\x61\160\x65\154");
 goto L_ef1e9;
 L_ef1e9:
 $_0x35b5 = $this->request->getPost("\x74\145\x78\164");
 goto L_dab08;
 L_f5507:
 $_0x8036 = \Config\Database::connect();
 goto L_11d1c;
 L_5e22b:
 return $this->response->setJSON($_0x1a68);
 }
 public function saveCatatanSiswa()
 {
 goto L_ba678;
 L_ba678:
 $_0x34b1 = session();
 goto L_54d65;
 L_58ef4:
 $_0x3ca2 = $this->request->getPost("\x6c\145\x76\145\x6c");
 goto L_4c924;
 L_bcd6e:
 $_0xbc4a = $_0x2fa2->table("\x6b\145\x6c\141\x73\137\x63\141\x74\141\x74\141\x6e\137\x6d\141\x70\145\x6c")->insert($_0xcdef);
 goto L_f82d0;
 L_4c924:
 $_0xcdef = ["\x69\144\x5f\164\x70" => $_0x5c31->id_tp ?? null, "\x69\144\x5f\163\x6d\164" => $_0x33f2->id_smt ?? null, "\x74\171\x70\145" => "\x32", "\x69\144\x5f\155\x61\160\x65\154" => $_0x6ba6, "\x69\144\x5f\163\x69\163\x77\141" => $_0x28a1, "\x69\144\x5f\147\x75\162\x75" => $_0xa3a9->id_guru, "\x6c\145\x76\145\x6c" => $_0x3ca2, "\x74\145\x78\164" => $_0x7342, "\x72\145\x61\144\x69\156\x67" => json_encode([])];
 goto L_6f676;
 L_54d65:
 $_0x5c31 = $this->dashboardModel->getTahunActive();
 goto L_8b7f5;
 L_8b7f5:
 $_0x33f2 = $this->dashboardModel->getSemesterActive();
 goto L_6f6f1;
 L_90640:
 $_0x7342 = $this->request->getPost("\x74\145\x78\164");
 goto L_58ef4;
 L_f82d0:
 return $this->response->setJSON($_0xbc4a);
 L_876ad:
 $_0x6ba6 = $this->request->getPost("\x69\144\x5f\155\x61\160\x65\154");
 goto L_90640;
 L_6f676:
 $_0x2fa2 = \Config\Database::connect();
 goto L_bcd6e;
 L_62f07:
 $_0x28a1 = $this->request->getPost("\x69\144\x5f\163\x69\163\x77\141");
 goto L_876ad;
 L_6f6f1:
 $_0xa3a9 = $this->dashboardModel->getDataGuruByUserId($_0x34b1->get("\x69\144\x5f\165\x73\145\x72"), $_0x5c31->id_tp ?? null, $_0x33f2->id_smt ?? null);
 goto L_62f07;
 }
 public function hapus($_0x3e03)
 {
 goto L_efe9b;
 L_4a0ce:
 $_0xff07 = $_0x36b9->table("\x6b\145\x6c\141\x73\137\x63\141\x74\141\x74\141\x6e\137\x6d\141\x70\145\x6c")->where("\x69\144\x5f\143\x61\164\x61\164\x61\156", $_0x3e03)->delete();
 goto L_c88ef;
 L_c88ef:
 return $this->response->setJSON($_0xff07);
 L_efe9b:
 $_0x36b9 = \Config\Database::connect();
 goto L_4a0ce;
 }
}