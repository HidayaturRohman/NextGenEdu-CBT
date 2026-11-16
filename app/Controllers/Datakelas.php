<?php
/*   ________________________________________
    |               NextGen Garuda CBT       |
    |    Protected & Distributed via GitHub  |
    |________________________________________|
*/
namespace App\Controllers;

use App\Models\DashboardModel;
use App\Models\KelasModel;
use App\Models\MasterModel;
use App\Models\DropdownModel;
use App\Models\RaporModel;
class Datakelas extends BaseController
{
 protected $dashboardModel;
 protected $kelasModel;
 protected $masterModel;
 protected $dropdownModel;
 protected $raporModel;
 public function __construct()
 {
 goto L_e0fb2;
 L_e0fb2:
 $this->dashboardModel = new DashboardModel();
 goto L_33ccd;
 L_32557:
 $this->dropdownModel = new DropdownModel();
 goto L_d82bd;
 L_33ccd:
 $this->kelasModel = new KelasModel();
 goto L_31350;
 L_d82bd:
 $this->raporModel = new RaporModel();
 L_31350:
 $this->masterModel = new MasterModel();
 goto L_32557;
 }
 public function index()
 {
 goto L_bb2e8;
 L_9b734:
 $_0xf91e = $this->dashboardModel->getSemesterActive();
 goto L_9e4f7;
 L_4a41d:
 if ($_0xb267 > 0) {
 $_0x30ff = $this->kelasModel->getKelasList($_0x131b->id_tp, $_0xf91e->id_smt);
 $_0x63ec = $this->dashboardModel->getTpBefore($_0x131b->tahun);
 if ($_0x63ec) {
 $_0x44ba = $this->kelasModel->getKelasList($_0x63ec->id_tp, "\x32");
 }
 }
 goto L_324a7;
 L_18ddf:
 $_0x44ba = [];
 goto L_d1c46;
 L_ee51e:
 $_0x131b = $this->dashboardModel->getTahunActive();
 goto L_9b734;
 L_72897:
 $_0xcf62 = $this->dashboardModel->getSetting();
 goto L_ee51e;
 L_f357c:
 if (!$_0xd7aa->get("\x69\163\x5f\154\x6f\147\x69\156")) {
 return redirect()->to("\x61\165\x74\150\x2f\154\x6f\147\x69\156");
 } elseif (!in_array((string) $_0xd7aa->get("\x72\157\x6c\145"), ["\x31", "\x34"])) {
 return redirect()->to("\x64\141\x73\150\x62\157\x61\162\x64")->with("\x65\162\x72\157\x72", "\x41\153\x73\145\x73\40\x64\151\x74\157\x6c\141\x6b\72\x20\110\x61\156\x79\141\x20\101\x64\155\x69\156\x69\163\x74\162\x61\164\x6f\162\x20\171\x61\156\x67\40\x62\145\x72\150\x61\153\x20\155\x65\156\x67\145\x6c\157\x6c\141\x20\115\x61\163\x74\145\x72\40\x44\141\x74\141\x20\113\x65\154\x61\163\x2e");
 }
 goto L_72897;
 L_09cf4:
 return view("\x6d\141\x73\164\x65\162\x2f\153\x65\154\x61\163\x2f\144\x61\164\x61", $_0x3e9c);
 L_d1c46:
 $_0xb267 = $this->kelasModel->count_all();
 goto L_4a41d;
 L_9e4f7:
 $_0x30ff = [];
 goto L_18ddf;
 L_324a7:
 $_0x3e9c = ["\x75\163\x65\162" => ["\x66\151\x72\163\x74\137\x6e\141\x6d\145" => $_0xd7aa->get("\x75\163\x65\162\x6e\141\x6d\145"), "\x72\157\x6c\145\x5f\156\x61\155\x65" => $_0xd7aa->get("\x72\157\x6c\145\x5f\156\x61\155\x65"), "\x66\157\x74\157" => $_0xd7aa->get("\x66\157\x74\157") ?? ''], "\x6a\165\x64\165\x6c" => "\x4b\145\x6c\141\x73", "\x73\165\x62\152\x75\144\x75\154" => "\x44\141\x74\141\x20\113\x65\154\x61\163", "\x73\145\x74\164\x69\156\x67" => $_0xcf62, "\x74\160" => $this->dashboardModel->getTahun(), "\x74\160\x5f\141\x63\164\x69\166\x65" => $_0x131b, "\x73\155\x74" => $this->dashboardModel->getSemester(), "\x73\155\x74\137\x61\143\x74\151\x76\145" => $_0xf91e, "\x6b\145\x6c\141\x73" => $_0x30ff, "\x6b\145\x6c\141\x73\137\x6c\141\x6d\141" => $_0x44ba, "\x6a\165\x72\165\x73\141\x6e" => $this->kelasModel->get_jurusan(), "\x6c\145\x76\145\x6c" => $this->kelasModel->getLevel($_0xcf62->jenjang), "\x67\165\x72\165" => $this->kelasModel->get_guru()];
 goto L_09cf4;
 L_bb2e8:
 $_0xd7aa = session();
 goto L_f357c;
 }
 public function detail($_0x4a92)
 {
 goto L_f9f6b;
 L_abb08:
 $_0xf051 = $this->dashboardModel->getSetting();
 goto L_bf3a2;
 L_56cf3:
 $_0x5e96 = ["\x75\163\x65\162" => ["\x66\151\x72\163\x74\137\x6e\141\x6d\145" => $_0x9155->get("\x75\163\x65\162\x6e\141\x6d\145"), "\x72\157\x6c\145\x5f\156\x61\155\x65" => $_0x9155->get("\x72\157\x6c\145\x5f\156\x61\155\x65"), "\x66\157\x74\157" => $_0x9155->get("\x66\157\x74\157") ?? ''], "\x6a\165\x64\165\x6c" => "\x44\145\x74\141\x69\154\x20\113\x65\154\x61\163", "\x73\165\x62\152\x75\144\x75\154" => "\x44\145\x74\141\x69\154\x20\113\x65\154\x61\163", "\x73\145\x74\164\x69\156\x67" => $_0xf051, "\x74\160" => $this->dashboardModel->getTahun(), "\x74\160\x5f\141\x63\164\x69\166\x65" => $_0xbf22, "\x73\155\x74" => $this->dashboardModel->getSemester(), "\x73\155\x74\137\x61\143\x74\151\x76\145" => $_0x3982, "\x6b\145\x6c\141\x73" => $_0x64cd, "\x6a\165\x72\165\x73\141\x6e" => $this->kelasModel->get_jurusan(), "\x6c\145\x76\145\x6c" => $this->kelasModel->getLevel($_0xf051->jenjang), "\x67\165\x72\165" => $this->kelasModel->get_guru(), "\x73\151\x73\167\x61\163" => $this->kelasModel->get_siswa_kelas($_0x4a92, $_0xbf22->id_tp, $_0x3982->id_smt), "\x73\164\x72\165\x6b\164\x75\162" => $_0x4e01];
 goto L_4115b;
 L_4115b:
 return view("\x6d\141\x73\164\x65\162\x2f\153\x65\154\x61\163\x2f\144\x65\164\x61\151\x6c", $_0x5e96);
 L_2aa51:
 if (!in_array((string) $_0x9155->get("\x72\157\x6c\145"), ["\x31", "\x34"])) {
 return redirect()->to("\x64\141\x73\150\x62\157\x61\162\x64")->with("\x65\162\x72\157\x72", "\x41\153\x73\145\x73\40\x64\151\x74\157\x6c\141\x6b\72\x20\110\x61\156\x79\141\x20\101\x64\155\x69\156\x69\163\x74\162\x61\164\x6f\162\x20\171\x61\156\x67\40\x62\145\x72\150\x61\153\x20\155\x65\156\x67\145\x6c\157\x6c\141\x20\115\x61\163\x74\145\x72\40\x44\141\x74\141\x20\113\x65\154\x61\163\x2e");
 }
 goto L_abb08;
 L_f9f6b:
 $_0x9155 = session();
 goto L_17459;
 L_14d75:
 $_0x3982 = $this->dashboardModel->getSemesterActive();
 goto L_4d99e;
 L_49166:
 if ($_0x64cd) {
 $_0x6cdf = $_0x64cd->jumlah_siswa;
 if (is_string($_0x6cdf) && strpos($_0x6cdf, "\x61\72") === 0) {
 $_0x64cd->siswa = @unserialize($_0x6cdf) ?: [];
 } elseif (is_string($_0x6cdf) && (strpos($_0x6cdf, "\x5b") === 0 || strpos($_0x6cdf, "\x7b") === 0)) {
 $_0x64cd->siswa = json_decode($_0x6cdf, true) ?: [];
 } else {
 $_0x64cd->siswa = [];
 }
 }
 goto L_e3ec2;
 L_4d99e:
 $_0x64cd = $this->kelasModel->get_one($_0x4a92);
 goto L_49166;
 L_bf3a2:
 $_0xbf22 = $this->dashboardModel->getTahunActive();
 goto L_14d75;
 L_0bd39:
 if ($_0x4e01 == null) {
 $_0x4e01 = $this->kelasModel->dummyStruktur();
 }
 goto L_56cf3;
 L_e3ec2:
 $_0x4e01 = $this->kelasModel->getStrukturKelas($_0x4a92);
 goto L_0bd39;
 L_17459:
 if (!$_0x9155->get("\x69\163\x5f\154\x6f\147\x69\156")) {
 return redirect()->to("\x61\165\x74\150\x2f\154\x6f\147\x69\156");
 }
 goto L_2aa51;
 }
 public function add()
 {
 goto L_5279e;
 L_5279e:
 $_0x7180 = session();
 goto L_3a8ee;
 L_062d0:
 return view("\x6d\141\x73\164\x65\162\x2f\153\x65\154\x61\163\x2f\141\x64\144", $_0x504d);
 L_3c801:
 $_0x15c2 = $this->dashboardModel->getSemesterActive();
 goto L_9d681;
 L_9d681:
 $_0x504d = ["\x75\163\x65\162" => ["\x66\151\x72\163\x74\137\x6e\141\x6d\145" => $_0x7180->get("\x75\163\x65\162\x6e\141\x6d\145"), "\x72\157\x6c\145\x5f\156\x61\155\x65" => $_0x7180->get("\x72\157\x6c\145\x5f\156\x61\155\x65"), "\x66\157\x74\157" => $_0x7180->get("\x66\157\x74\157") ?? ''], "\x6a\165\x64\165\x6c" => "\x4b\145\x6c\141\x73", "\x73\165\x62\152\x75\144\x75\154" => "\x54\141\x6d\142\x61\150\x20\113\x65\154\x61\163", "\x73\145\x74\164\x69\156\x67" => $_0xac7b, "\x74\160" => $this->dashboardModel->getTahun(), "\x74\160\x5f\141\x63\164\x69\166\x65" => $_0xe308, "\x73\155\x74" => $this->dashboardModel->getSemester(), "\x73\155\x74\137\x61\143\x74\151\x76\145" => $_0x15c2, "\x6b\145\x6c\141\x73" => (object) $this->kelasModel->dummy(), "\x6a\165\x72\165\x73\141\x6e" => $this->kelasModel->get_jurusan(), "\x6c\145\x76\145\x6c" => $this->kelasModel->getLevel($_0xac7b->jenjang), "\x67\165\x72\165" => $this->kelasModel->get_guru(), "\x73\151\x73\167\x61" => $this->kelasModel->getAllSiswa($_0xe308->id_tp, $_0x15c2->id_smt), "\x73\151\x73\167\x61\153\x65\154\x61\163" => []];
 goto L_062d0;
 L_3a8ee:
 if (!$_0x7180->get("\x69\163\x5f\154\x6f\147\x69\156")) {
 return redirect()->to("\x61\165\x74\150\x2f\154\x6f\147\x69\156");
 }
 goto L_fa458;
 L_fa458:
 if (!in_array((string) $_0x7180->get("\x72\157\x6c\145"), ["\x31", "\x34"])) {
 return redirect()->to("\x64\141\x73\150\x62\157\x61\162\x64")->with("\x65\162\x72\157\x72", "\x41\153\x73\145\x73\40\x64\151\x74\157\x6c\141\x6b\72\x20\110\x61\156\x79\141\x20\101\x64\155\x69\156\x69\163\x74\162\x61\164\x6f\162\x20\171\x61\156\x67\40\x62\145\x72\150\x61\153\x20\155\x65\156\x67\145\x6c\157\x6c\141\x20\115\x61\163\x74\145\x72\40\x44\141\x74\141\x20\113\x65\154\x61\163\x2e");
 }
 goto L_e90c1;
 L_a84b2:
 $_0xe308 = $this->dashboardModel->getTahunActive();
 goto L_3c801;
 L_e90c1:
 $_0xac7b = $this->dashboardModel->getSetting();
 goto L_a84b2;
 }
 public function edit($_0xd304 = '')
 {
 goto L_9c85f;
 L_13f84:
 return view("\x6d\141\x73\164\x65\162\x2f\153\x65\154\x61\163\x2f\141\x64\144", $_0x5d17);
 L_8b4be:
 if ($_0x4fe0) {
 $_0x30f5 = $_0x4fe0->jumlah_siswa;
 if (is_string($_0x30f5) && strpos($_0x30f5, "\x61\72") === 0) {
 $_0x4fe0->jumlah_siswa = @unserialize($_0x30f5) ?: [];
 } elseif (is_string($_0x30f5) && (strpos($_0x30f5, "\x5b") === 0 || strpos($_0x30f5, "\x7b") === 0)) {
 $_0x4fe0->jumlah_siswa = json_decode($_0x30f5, true) ?: [];
 } else {
 $_0x4fe0->jumlah_siswa = [];
 }
 }
 goto L_8e5f2;
 L_cab52:
 if (!in_array((string) $_0xca12->get("\x72\157\x6c\145"), ["\x31", "\x34"])) {
 return redirect()->to("\x64\141\x73\150\x62\157\x61\162\x64")->with("\x65\162\x72\157\x72", "\x41\153\x73\145\x73\40\x64\151\x74\157\x6c\141\x6b\72\x20\110\x61\156\x79\141\x20\101\x64\155\x69\156\x69\163\x74\162\x61\164\x6f\162\x20\171\x61\156\x67\40\x62\145\x72\150\x61\153\x20\155\x65\156\x67\145\x6c\157\x6c\141\x20\115\x61\163\x74\145\x72\40\x44\141\x74\141\x20\113\x65\154\x61\163\x2e");
 }
 goto L_23fcd;
 L_23fcd:
 $_0xd5a7 = $this->dashboardModel->getSetting();
 goto L_61937;
 L_61937:
 $_0x74da = $this->dashboardModel->getTahunActive();
 goto L_84b0f;
 L_2b40f:
 $_0x4fe0 = $this->kelasModel->get_one($_0xd304);
 goto L_8b4be;
 L_84b0f:
 $_0xcd96 = $this->dashboardModel->getSemesterActive();
 goto L_2b40f;
 L_14241:
 if (!$_0xca12->get("\x69\163\x5f\154\x6f\147\x69\156")) {
 return redirect()->to("\x61\165\x74\150\x2f\154\x6f\147\x69\156");
 }
 goto L_cab52;
 L_9c85f:
 $_0xca12 = session();
 goto L_14241;
 L_8e5f2:
 $_0x5d17 = ["\x75\163\x65\162" => ["\x66\151\x72\163\x74\137\x6e\141\x6d\145" => $_0xca12->get("\x75\163\x65\162\x6e\141\x6d\145"), "\x72\157\x6c\145\x5f\156\x61\155\x65" => $_0xca12->get("\x72\157\x6c\145\x5f\156\x61\155\x65"), "\x66\157\x74\157" => $_0xca12->get("\x66\157\x74\157") ?? ''], "\x6a\165\x64\165\x6c" => "\x4b\145\x6c\141\x73", "\x73\165\x62\152\x75\144\x75\154" => "\x45\144\x69\164\x20\113\x65\154\x61\163", "\x73\145\x74\164\x69\156\x67" => $_0xd5a7, "\x74\160" => $this->dashboardModel->getTahun(), "\x74\160\x5f\141\x63\164\x69\166\x65" => $_0x74da, "\x73\155\x74" => $this->dashboardModel->getSemester(), "\x73\155\x74\137\x61\143\x74\151\x76\145" => $_0xcd96, "\x69\144\x5f\153\x65\154\x61\163" => $_0xd304, "\x6b\145\x6c\141\x73" => $_0x4fe0, "\x6a\165\x72\165\x73\141\x6e" => $this->kelasModel->get_jurusan(), "\x6c\145\x76\145\x6c" => $this->kelasModel->getLevel($_0xd5a7->jenjang), "\x67\165\x72\165" => $this->kelasModel->get_guru(), "\x73\151\x73\167\x61" => $this->kelasModel->getAllSiswa($_0x74da->id_tp, $_0xcd96->id_smt), "\x73\151\x73\167\x61\153\x65\154\x61\163" => $this->kelasModel->get_siswa_kelas($_0xd304, $_0x74da->id_tp, $_0xcd96->id_smt)];
 goto L_13f84;
 }
 public function save()
 {
 goto L_18031;
 L_9e8ea:
 $_0x5de9 = $this->dashboardModel->getSemesterActive()->id_smt;
 goto L_cff4f;
 L_08970:
 $_0x596d = null;
 goto L_1c6e5;
 L_52bca:
 return $this->response->setJSON(["\x73\151\x73\167\x61" => $_0x88e9, "\x75\160\x64\141\x74\145" => $_0xbd33, "\x73\164\x61\164\x75\163" => $_0x37cf]);
 L_c3159:
 for ($_0x3b5b = 0, $_0x116b = count($_0x4d75); $_0x3b5b < $_0x116b; $_0x3b5b++) {
 $_0x8058 = $_0x4d75[$_0x3b5b] ?? null;
 if ($_0x8058 !== null) {
 $_0x890e[] = ["\x69\144" => $_0x8058];
 }
 }
 goto L_8d9f3;
 L_3165b:
 $_0xbc4a = ["\x6e\141\x6d\141\x5f\153\x65\154\x61\163" => $this->request->getPost("\x6e\141\x6d\141\x5f\153\x65\154\x61\163"), "\x6b\157\x64\145\x5f\153\x65\154\x61\163" => $this->request->getPost("\x6b\157\x64\145\x5f\153\x65\154\x61\163"), "\x6a\165\x72\165\x73\141\x6e\137\x69\144" => $this->request->getPost("\x6a\165\x72\165\x73\141\x6e\137\x69\144") ?? '', "\x69\144\x5f\164\x70" => $_0x5bd7, "\x69\144\x5f\163\x6d\164" => $_0x5de9, "\x6c\145\x76\145\x6c\137\x69\144" => $this->request->getPost("\x6c\145\x76\145\x6c\137\x69\144"), "\x67\165\x72\165\x5f\151\x64" => $this->request->getPost("\x67\165\x72\165\x5f\151\x64") ?? '', "\x73\151\x73\167\x61\137\x69\144" => $this->request->getPost("\x73\151\x73\167\x61\137\x69\144"), "\x6a\165\x6d\154\x61\150\x5f\163\x69\163\x77\141" => $_0x6779];
 goto L_08970;
 L_18031:
 $_0xc6c1 = \Config\Database::connect();
 goto L_0c5c7;
 L_8d9f3:
 $_0x6779 = json_encode($_0x890e);
 goto L_3165b;
 L_00cfe:
 $_0x88e9 = 0;
 goto L_158d1;
 L_bc322:
 $_0x6d67 = $this->request->getPost("\x67\165\x72\165\x5f\151\x64");
 goto L_bf89f;
 L_bf89f:
 $_0x5bd7 = $this->dashboardModel->getTahunActive()->id_tp;
 goto L_9e8ea;
 L_158d1:
 if ($_0x37cf) {
 $_0x4267 = $_0x8233 ?: $_0x596d;
 if ($_0x6d67) {
 // Hapus wali kelas lama dari kelas ini
 $_0xc6c1->table("\x6a\141\x62\141\x74\141\x6e\137\x67\165\x72\165")->where("\x69\144\x5f\153\x65\154\x61\163", $_0x4267)->where("\x69\144\x5f\164\x70", $_0x5bd7)->where("\x69\144\x5f\163\x6d\164", $_0x5de9)->update(["\x69\144\x5f\153\x65\154\x61\163" => 0]);
 // Hapus penugasan wali kelas lain jika guru ini sudah ditugaskan di kelas lain
 $_0xc6c1->table("\x6d\141\x73\164\x65\162\x5f\153\x65\154\x61\163")->where("\x69\144\x5f\164\x70", $_0x5bd7)->where("\x69\144\x5f\163\x6d\164", $_0x5de9)->where("\x69\144\x5f\153\x65\154\x61\163\x20\41\x3d", $_0x4267)->where("\x67\165\x72\165\x5f\151\x64", $_0x6d67)->update(["\x67\165\x72\165\x5f\151\x64" => '']);
 // Update atau Insert wali kelas baru
 $_0xca88 = $_0xc6c1->table("\x6a\141\x62\141\x74\141\x6e\137\x67\165\x72\165")->where("\x69\144\x5f\152\x61\142\x61\164\x61\156\x5f\147\x75\162\x75", $_0x6d67 . $_0x5bd7 . $_0x5de9)->get()->getRow();
 if ($_0xca88) {
 $_0xc6c1->table("\x6a\141\x62\141\x74\141\x6e\137\x67\165\x72\165")->where("\x69\144\x5f\152\x61\142\x61\164\x61\156\x5f\147\x75\162\x75", $_0x6d67 . $_0x5bd7 . $_0x5de9)->update(["\x69\144\x5f\153\x65\154\x61\163" => $_0x4267, "\x69\144\x5f\152\x61\142\x61\164\x61\156" => "\x34"]);
 } else {
 $_0xc6c1->table("\x6a\141\x62\141\x74\141\x6e\137\x67\165\x72\165")->insert(["\x69\144\x5f\152\x61\142\x61\164\x61\156\x5f\147\x75\162\x75" => $_0x6d67 . $_0x5bd7 . $_0x5de9, "\x69\144\x5f\147\x75\162\x75" => $_0x6d67, "\x69\144\x5f\153\x65\154\x61\163" => $_0x4267, "\x69\144\x5f\152\x61\142\x61\164\x61\156" => "\x34", "\x69\144\x5f\164\x70" => $_0x5bd7, "\x69\144\x5f\163\x6d\164" => $_0x5de9, "\x6d\141\x70\145\x6c\137\x6b\145\x6c\141\x73" => "\x5b\135", "\x65\153\x73\164\x72\141\x5f\153\x65\154\x61\163" => "\x5b\135"]);
 }
 } else {
 // Jika wali kelas dikosongkan untuk kelas ini
 $_0xc6c1->table("\x6a\141\x62\141\x74\141\x6e\137\x67\165\x72\165")->where("\x69\144\x5f\153\x65\154\x61\163", $_0x4267)->where("\x69\144\x5f\164\x70", $_0x5bd7)->where("\x69\144\x5f\163\x6d\164", $_0x5de9)->update(["\x69\144\x5f\153\x65\154\x61\163" => 0]);
 }
 $_0xbd33 = true;
 $_0x2917 = [];
 if ($_0x8233) {
 $_0xc6c1->table("\x6b\145\x6c\141\x73\137\x73\151\x73\167\x61")->where("\x69\144\x5f\153\x65\154\x61\163", $_0x8233)->where("\x69\144\x5f\164\x70", $_0x5bd7)->where("\x69\144\x5f\163\x6d\164", $_0x5de9)->update(["\x69\144\x5f\153\x65\154\x61\163" => 0]);
 }
 $_0x4267 = $_0x8233 ?: $_0x596d;
 foreach ($_0x4d75 as $_0x55d0) {
 if ($_0x55d0 != null) {
 $_0x2917[] = ["\x69\144\x5f\153\x65\154\x61\163\x5f\163\x69\163\x77\141" => $_0x5bd7 . $_0x5de9 . $_0x55d0, "\x69\144\x5f\164\x70" => $_0x5bd7, "\x69\144\x5f\163\x6d\164" => $_0x5de9, "\x69\144\x5f\153\x65\154\x61\163" => $_0x4267, "\x69\144\x5f\163\x69\163\x77\141" => $_0x55d0];
 }
 }
 if (!empty($_0x2917)) {
 foreach ($_0x2917 as $_0x55be) {
 $_0xc6c1->table("\x6b\145\x6c\141\x73\137\x73\151\x73\167\x61")->replace($_0x55be);
 $_0x88e9++;
 }
 }
 }
 goto L_52bca;
 L_0c5c7:
 $_0x8233 = $this->request->getPost("\x69\144\x5f\153\x65\154\x61\163");
 goto L_bc322;
 L_74093:
 $_0xf3d4 = ["\x6e\141\x6d\141\x5f\153\x65\154\x61\163" => "\x72\145\x71\165\x69\162\x65\144", "\x6b\157\x64\145\x5f\153\x65\154\x61\163" => "\x72\145\x71\165\x69\162\x65\144", "\x6c\145\x76\145\x6c\137\x69\144" => "\x72\145\x71\165\x69\162\x65\144", "\x73\151\x73\167\x61\137\x69\144" => "\x72\145\x71\165\x69\162\x65\144"];
 goto L_3f3e6;
 L_3f3e6:
 $_0x890e = [];
 goto L_c3159;
 L_b0604:
 $_0xbd33 = false;
 goto L_00cfe;
 L_cff4f:
 $_0x4d75 = $this->request->getPost("\x73\151\x73\167\x61") ?? [];
 goto L_74093;
 L_1c6e5:
 if ($_0x8233) {
 if ($this->validate($_0xf3d4)) {
 $_0x37cf = $_0xc6c1->table("\x6d\141\x73\164\x65\162\x5f\153\x65\154\x61\163")->where("\x69\144\x5f\153\x65\154\x61\163", $_0x8233)->update($_0xbc4a);
 } else {
 $_0x37cf = false;
 }
 } else if ($this->validate($_0xf3d4)) {
 $_0x37cf = $_0xc6c1->table("\x6d\141\x73\164\x65\162\x5f\153\x65\154\x61\163")->insert($_0xbc4a);
 $_0x596d = $_0xc6c1->insertID();
 } else {
 $_0x37cf = false;
 }
 goto L_b0604;
 }
 public function hapus($_0x9c45 = null)
 {
 goto L_2bacd;
 L_2bacd:
 $_0xdfda = \Config\Database::connect();
 goto L_10b58;
 L_ac947:
 $_0xdfda->query("\x53\105\x54\40\x46\117\x52\105\x49\107\x4e\137\x4b\105\x59\137\x43\110\x45\103\x4b\123\x3d\61");
 goto L_85e06;
 L_7931c:
 if (!$_0xe9a5 || empty($_0xe9a5)) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x74\157\x74\141\x6c" => 0]);
 }
 goto L_22074;
 L_ae181:
 if ($_0x9c45 !== null) {
 $_0xe9a5 = [$_0x9c45];
 }
 goto L_7931c;
 L_364e1:
 $_0xdfda->table("\x6d\141\x73\164\x65\162\x5f\153\x65\154\x61\163")->whereIn("\x69\144\x5f\153\x65\154\x61\163", $_0xe9a5)->delete();
 goto L_ac947;
 L_10b58:
 $_0xe9a5 = $this->request->getPost("\x63\150\x65\143\x6b\145\x64");
 goto L_ae181;
 L_85e06:
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => true, "\x6b\145\x6c\141\x73" => count($_0xe9a5), "\x74\157\x74\141\x6c" => count($_0xe9a5)]);
 L_22074:
 $_0xdfda->query("\x53\105\x54\40\x46\117\x52\105\x49\107\x4e\137\x4b\105\x59\137\x43\110\x45\103\x4b\123\x3d\60");
 goto L_364e1;
 }
 public function bulk_create()
 {
 goto L_ada23;
 L_a1217:
 if ($_0x4689 && is_array($_0x4689)) {
 $_0x46d3 = \Config\Database::connect();
 try {
 $_0xdc8d = $_0x46d3->table("\x6d\141\x73\164\x65\162\x5f\153\x65\154\x61\163")->insertBatch($_0x4689);
 return $this->response->setJSON(["\x73\165\x63\143\x65\163\x73" => true, "\x69\156\x73\145\x72\164" => $_0xdc8d]);
 } catch (\Exception $_0xb768) {
 file_put_contents(WRITEPATH . "\x62\165\x6c\153\x5f\145\x72\162\x6f\162\x2e\164\x78\164", $_0xb768->getMessage());
 return $this->response->setJSON(["\x73\165\x63\143\x65\163\x73" => false, "\x69\156\x73\145\x72\164" => 0, "\x65\162\x72\157\x72" => $_0xb768->getMessage()]);
 }
 }
 goto L_a8537;
 L_a8537:
 return $this->response->setJSON(["\x73\165\x63\143\x65\163\x73" => false, "\x69\156\x73\145\x72\164" => 0, "\x65\162\x72\157\x72" => "\x4e\157\x20\160\x6f\163\x74\163\x20\160\x61\162\x73\145\x64", "\x72\141\x77" => $_0x23ba]);
 L_296b7:
 $_0x4689 = json_decode($_0x23ba);
 goto L_a1217;
 L_ada23:
 $_0x23ba = $this->request->getPost("\x6b\145\x6c\141\x73");
 goto L_296b7;
 }
 public function test_bulk()
 {
 goto L_34128;
 L_d0555:
 try {
 $_0x8e7c = $_0x1d94->table("\x6d\141\x73\164\x65\162\x5f\153\x65\154\x61\163")->insertBatch($_0x1dce);
 return $this->response->setJSON(["\x73\165\x63\143\x65\163\x73" => true, "\x69\156\x73\145\x72\164" => $_0x8e7c]);
 } catch (\Exception $_0xe2f4) {
 return $this->response->setJSON(["\x73\165\x63\143\x65\163\x73" => false, "\x65\162\x72\157\x72" => $_0xe2f4->getMessage()]);
 }
 L_47437:
 $_0x1d94 = \Config\Database::connect();
 goto L_d0555;
 L_34128:
 $_0x1dce = [["\x6c\145\x76\145\x6c\137\x69\144" => "\x31", "\x6e\141\x6d\141\x5f\153\x65\154\x61\163" => "\x49\40\x31", "\x6b\157\x64\145\x5f\153\x65\154\x61\163" => "\x49\61", "\x69\144\x5f\164\x70" => "\x31", "\x69\144\x5f\163\x6d\164" => "\x31", "\x6a\165\x6d\154\x61\150\x5f\163\x69\163\x77\141" => "\x5b\135"]];
 goto L_47437;
 }
 public function kenaikan()
 {
 goto L_d0fe7;
 L_c04f7:
 if ($_0x2b8c != null) {
 $_0x8fb3["\x73\151\x73\167\x61\137\x6b\145\x6c\141\x73\137\x62\141\x72\165"] = $this->masterModel->getSiswaKelasBaru($_0xf70e->id_tp, $_0x7f75->id_smt);
 $_0xd827 = [];
 $_0x178f = "\x30";
 if ($_0x382d) {
 $_0xd827 = $this->raporModel->getKenaikanSiswa($_0x2b8c, $_0x382d->id_tp, "\x32");
 $_0x48f8 = \Config\Database::connect();
 $_0x7297 = $_0x48f8->table("\x6d\141\x73\164\x65\162\x5f\153\x65\154\x61\163")->where("\x69\144\x5f\153\x65\154\x61\163", $_0x2b8c)->where("\x69\144\x5f\164\x70", $_0x382d->id_tp)->where("\x69\144\x5f\163\x6d\164", "\x32")->get()->getRow();
 $_0x178f = $_0x7297 ? $_0x7297->level_id + 1 : "\x30";
 }
 $_0x8fb3["\x73\151\x73\167\x61\163"] = $_0xd827;
 $_0x8fb3["\x74\171\x70\145\x5f\163\x65\154\x65\143\x74\145\x64"] = $_0x8a1f;
 $_0x8fb3["\x6c\145\x76\145\x6c"] = $_0x178f;
 $_0x8fb3["\x6b\145\x6c\141\x73\145\x73"] = $_0x5e73[$_0x178f] ?? [];
 }
 goto L_84261;
 L_06964:
 $_0x4f68 = $this->dashboardModel->getSetting();
 goto L_868f1;
 L_f5c61:
 $_0xf70e = $this->dashboardModel->getTahunActive();
 goto L_60f8e;
 L_0553c:
 $_0xe2bb = [];
 goto L_ec007;
 L_d0fe7:
 $_0x27da = session();
 goto L_d2b71;
 L_53f14:
 $_0x8fb3["\x6b\145\x6c\141\x73\137\x62\141\x72\165"] = $_0xdfec;
 goto L_1656d;
 L_5ffab:
 $_0xdfec = [];
 goto L_6ec4f;
 L_d2b71:
 if (!$_0x27da->get("\x69\163\x5f\154\x6f\147\x69\156")) {
 return redirect()->to("\x61\165\x74\150\x2f\154\x6f\147\x69\156");
 }
 goto L_f2ad9;
 L_9c543:
 $_0x8fb3["\x73\151\x73\167\x61\137\x6b\145\x6c\141\x73"] = $_0x7997;
 goto L_c04f7;
 L_6d4cf:
 $_0x178f = $_0x4f68->jenjang == "\x31" ? "\x36" : ($_0x4f68->jenjang == "\x32" ? "\x39" : "\x31\62");
 goto L_d470d;
 L_84261:
 return view("\x6d\141\x73\164\x65\162\x2f\153\x65\154\x61\163\x2f\156\x61\151\x6b\153\x65\154\x61\163", $_0x8fb3);
 L_f2ad9:
 if (!in_array((string) $_0x27da->get("\x72\157\x6c\145"), ["\x31", "\x34"])) {
 return redirect()->to("\x64\141\x73\150\x62\157\x61\162\x64")->with("\x65\162\x72\157\x72", "\x48\141\x6e\171\x61\40\x41\144\x6d\151\x6e\151\x73\164\x72\141\x74\157\x72");
 }
 goto L_743c1;
 L_1656d:
 $_0xbf06 = $this->group_kelas_by_level($_0xa252);
 goto L_54fd3;
 L_6ec4f:
 $_0x7997 = [];
 goto L_0553c;
 L_8f032:
 $_0x8fb3["\x6b\145\x6c\141\x73\137\x6c\141\x6d\141"] = $_0xa252;
 goto L_53f14;
 L_868f1:
 $_0x8fb3 = ["\x75\163\x65\162" => ["\x66\151\x72\163\x74\137\x6e\141\x6d\145" => $_0x27da->get("\x75\163\x65\162\x6e\141\x6d\145"), "\x72\157\x6c\145\x5f\156\x61\155\x65" => $_0x27da->get("\x72\157\x6c\145\x5f\156\x61\155\x65"), "\x66\157\x74\157" => $_0x27da->get("\x66\157\x74\157") ?? ''], "\x6a\165\x64\165\x6c" => "\x4b\145\x6e\141\x69\153\x61\156\x20\113\x65\154\x61\163", "\x73\165\x62\152\x75\144\x75\154" => "\x4b\145\x6e\141\x69\153\x61\156\x20\113\x65\154\x61\163\x20\57\x20\114\x75\154\x75\163", "\x73\145\x74\164\x69\156\x67" => $_0x4f68, "\x74\160" => $this->dashboardModel->getTahun(), "\x74\160\x5f\141\x63\164\x69\166\x65" => $_0xf70e, "\x73\155\x74" => $this->dashboardModel->getSemester(), "\x73\155\x74\137\x61\143\x74\151\x76\145" => $_0x7f75];
 goto L_6d4cf;
 L_54fd3:
 $_0x8fb3["\x62\165\x61\164\x5f\153\x65\154\x61\163\x5f\142\x61\162\x75"] = $_0xbf06;
 goto L_51c57;
 L_51c57:
 $_0x8fb3["\x61\154\x6c\137\x6b\145\x6c\141\x73\137\x62\141\x72\165"] = $_0xe2bb;
 goto L_9c543;
 L_60f8e:
 $_0x7f75 = $this->dashboardModel->getSemesterActive();
 goto L_06964;
 L_d470d:
 $_0x382d = $this->dashboardModel->getTpBefore($_0xf70e->tahun);
 goto L_f9636;
 L_743c1:
 $_0x2b8c = $this->request->getGet("\x6b\145\x6c\141\x73");
 goto L_decab;
 L_decab:
 $_0x8a1f = $this->request->getGet("\x74\171\x70\145");
 goto L_f5c61;
 L_f9636:
 $_0xa252 = [];
 goto L_5ffab;
 L_ec007:
 if ($_0x382d) {
 $_0xa252 = $this->dropdownModel->getAllKelas($_0x382d->id_tp, "\x32", "\x21\75" . $_0x178f);
 $_0xdfec = $this->dropdownModel->getAllKelas($_0xf70e->id_tp, "\x31");
 $_0xb7eb = array_keys($_0xdfec);
 if (count($_0xb7eb) > 0) {
 $_0x82ac = $this->kelasModel->getKelasSiswa($_0xb7eb);
 foreach ($_0x82ac as $_0x46ec) {
 $_0x7997[$_0x46ec->nama_kelas][] = $_0x46ec->id_siswa;
 }
 }
 $_0x7fd0 = $this->dropdownModel->getAllKelas($_0x382d->id_tp, "\x32");
 $_0x2605 = array_keys($_0x7fd0);
 if (count($_0x2605) > 0) {
 $_0xe6ee = $this->kelasModel->getKelasSiswa($_0x2605);
 foreach ($_0xe6ee as $_0x8a84) {
 $_0x7997[$_0x8a84->id_kelas][] = $_0x8a84->id_siswa;
 }
 }
 $_0x5e73 = $this->group_kelas_by_level($_0x7fd0);
 // id_kelas lama, nama_kelas baru
 foreach ($_0x5e73 as $_0x862b => $_0x94a9) {
 foreach ($_0x94a9 as $_0x713d => $_0x200d) {
 $_0xe2bb[$_0x713d] = $_0x200d;
 }
 }
 }
 goto L_8f032;
 }
 public function group_kelas_by_level($_0x3c5b)
 {
 goto L_f8b8f;
 L_b1af5:
 return $_0xa170;
 L_33dac:
 foreach ($_0x3c5b as $_0x32ca => $_0x2760) {
 $_0x3668 = $_0x2760;
 $_0xf0d0 = "\x2d";
 // Simpan kls asli, uppercase-kan untuk pencocokan saja
 $_0x77df = strtoupper(trim($_0x2760));
 // ROMAWI
 foreach ($_0x32b1 as $_0xd790 => $_0x3651) {
 if (preg_match("\x2f\136" . $_0xd790 . "\x28\133\x5c\163\x5c\55\x41\55\x5a\60\x2d\71\x5d\56\x2a\51\x3f\44\x2f\151", $_0x77df, $_0x2bee)) {
 if ($_0x3651 >= 12) {
 $_0x3668 = "\x4c\165\x6c\165\x73";
 $_0xf0d0 = "\x4c\165\x6c\165\x73";
 } else {
 $_0x4f05 = $_0x2bee[1] ?? '';
 $_0x3668 = $_0xda8d[$_0x3651 + 1] . $_0x4f05;
 $_0xf0d0 = $_0x3651 + 1;
 }
 break;
 // romawi match
 }
 }
 // ANGKA biasa, jika belum match romawi
 if ($_0xf0d0 == "\x2d") {
 if (preg_match("\x2f\136\x28\134\x64\173\x31\54\x32\175\x29\50\x5b\134\x73\134\x2d\101\x2d\132\x30\55\x39\135\x2e\52\x29\77\x24\57", $_0x2760, $_0x2bee)) {
 $_0x3651 = (int) $_0x2bee[1];
 $_0x4f05 = $_0x2bee[2] ?? '';
 if ($_0x3651 >= 12) {
 $_0x3668 = "\x4c\165\x6c\165\x73";
 $_0xf0d0 = "\x4c\165\x6c\165\x73";
 } else {
 $_0x3668 = $_0x3651 + 1 . $_0x4f05;
 $_0xf0d0 = $_0x3651 + 1;
 }
 }
 }
 // Tetapkan level berdasarkan hasil kelas_baru (bukan dari angka sebelumnya!)
 if (preg_match("\x2f\136\x28\134\x64\173\x31\54\x32\175\x29\133\x5c\163\x5c\55\x5d\52\x2f", $_0x3668, $_0xb95d)) {
 $_0xf0d0 = (int) $_0xb95d[1];
 } elseif (preg_match("\x2f\136\x28\130\x49\111\x7c\130\x49\174\x58\174\x49\130\x7c\126\x49\111\x49\174\x56\111\x49\174\x56\111\x7c\126\x7c\111\x56\174\x49\111\x49\174\x49\111\x7c\111\x29\133\x5c\163\x5c\55\x5d\52\x2f", strtoupper($_0x3668), $_0xb95d)) {
 $_0xf0d0 = $_0x32b1[$_0xb95d[1]];
 } elseif ($_0x3668 == "\x4c\165\x6c\165\x73") {
 $_0xf0d0 = "\x4c\165\x6c\165\x73";
 } else {
 $_0xf0d0 = "\x2d";
 }
 if (!isset($_0xa170[$_0xf0d0])) {
 $_0xa170[$_0xf0d0] = [];
 }
 $_0xa170[$_0xf0d0][$_0x32ca] = $_0x3668;
 }
 goto L_b1af5;
 L_f8b8f:
 $_0x32b1 = ["\x58\111\x49" => 12, "\x58\111" => 11, "\x58" => 10, "\x49\130" => 9, "\x56\111\x49\111" => 8, "\x56\111\x49" => 7, "\x56\111" => 6, "\x56" => 5, "\x49\126" => 4, "\x49\111\x49" => 3, "\x49\111" => 2, "\x49" => 1];
 goto L_435fc;
 L_b0181:
 $_0xa170 = [];
 goto L_33dac;
 L_435fc:
 $_0xda8d = [1 => "\x49", 2 => "\x49\111", 3 => "\x49\111\x49", 4 => "\x49\126", 5 => "\x56", 6 => "\x56\111", 7 => "\x56\111\x49", 8 => "\x56\111\x49\111", 9 => "\x49\130", 10 => "\x58", 11 => "\x58\111", 12 => "\x58\111\x49"];
 goto L_b0181;
 }
 public function naikKelas()
 {
 goto L_7fc6c;
 L_081b8:
 $_0x6920["\x75\160\x64\141\x74\145"] = $_0x155d;
 goto L_82f09;
 L_d7b2e:
 // get kls baru manually
 $_0xd984 = $_0xe011->table("\x6d\141\x73\164\x65\162\x5f\153\x65\154\x61\163")->whereIn("\x6e\141\x6d\141\x5f\153\x65\154\x61\163", array_values($_0x66dd))->where("\x69\144\x5f\164\x70", $_0x17e9->id_tp)->where("\x69\144\x5f\163\x6d\164", $_0xa9fa->id_smt)->get()->getResult();
 goto L_beb0a;
 L_5e050:
 $_0x54da = [];
 goto L_a5aa0;
 L_beb0a:
 $_0xbfb9 = [];
 goto L_4deb0;
 L_0a462:
 $_0xcdf8 = [];
 goto L_02564;
 L_df3fe:
 if (empty($_0x2c38)) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x54\151\x64\141\x6b\40\x61\144\x61\40\x64\141\x74\141"]);
 }
 goto L_a0eca;
 L_45cd8:
 $_0x6920["\x6c\141\x6d\141"] = $_0xd232;
 goto L_83fa1;
 L_2b49e:
 $_0x7dbe = [];
 goto L_56f39;
 L_83fa1:
 $_0x6920["\x62\141\x72\165"] = $_0xd984;
 goto L_081b8;
 L_a0eca:
 $_0x2c38 = array_unique($_0x2c38);
 goto L_0b875;
 L_82f09:
 $_0x6920["\x69\156\x73\145\x72\164"] = $_0xcdf8;
 goto L_5eb73;
 L_fe5e6:
 $_0x17e9 = $this->dashboardModel->getTahunActive();
 goto L_9481d;
 L_3f7de:
 // nama baru
 $_0x9a35 = [];
 goto L_77074;
 L_9481d:
 $_0xa9fa = $this->dashboardModel->getSemesterActive();
 goto L_79994;
 L_38b54:
 $_0x2e57 = $this->request->getPost("\x6d\157\x64\145");
 goto L_e524e;
 L_da61f:
 // id lama
 $_0x66dd = [];
 goto L_3f7de;
 L_6fd59:
 $_0x6e80 = [];
 goto L_209ee;
 L_209ee:
 foreach ($_0x66dd as $_0xf547 => $_0x85cb) {
 $_0x23a5 = $_0x54da[$_0xf547] ?? null;
 if (!$_0x23a5) {
 continue;
 }
 $_0x26c8 = $_0xbfb9[$_0x85cb] ?? null;
 if ($_0x26c8 == null) {
 $_0x81dc = $_0x9a35[$_0xf547];
 $_0xef82 = array("\x6e\141\x6d\141\x5f\153\x65\154\x61\163" => $_0x85cb, "\x6b\157\x64\145\x5f\153\x65\154\x61\163" => $_0x85cb, "\x6a\165\x72\165\x73\141\x6e\137\x69\144" => $_0x23a5->jurusan_id ?? '', "\x69\144\x5f\164\x70" => $_0x17e9->id_tp, "\x69\144\x5f\163\x6d\164" => $_0xa9fa->id_smt, "\x6c\145\x76\145\x6c\137\x69\144" => (int) $_0x23a5->level_id + 1, "\x67\165\x72\165\x5f\151\x64" => $_0x23a5->guru_id, "\x73\151\x73\167\x61\137\x69\144" => $_0x23a5->siswa_id, "\x6a\165\x6d\154\x61\150\x5f\163\x69\163\x77\141" => json_encode($_0x81dc));
 $_0xcdf8[] = $_0xef82;
 $_0xe011->table("\x6d\141\x73\164\x65\162\x5f\153\x65\154\x61\163")->insert($_0xef82);
 $_0x96fe = $_0xe011->insertID();
 $_0x6e80[$_0x96fe] = $_0x81dc;
 } else {
 if ($_0x2e57 == "\x70\145\x72\163\x69\163\x77\141") {
 $_0xb5ad = $_0x26c8->jumlah_siswa;
 $_0x6e2e = [];
 if (is_string($_0xb5ad) && strpos($_0xb5ad, "\x61\72") === 0) {
 $_0x6e2e = @unserialize($_0xb5ad) ?: [];
 } elseif (is_string($_0xb5ad) && (strpos($_0xb5ad, "\x5b") === 0 || strpos($_0xb5ad, "\x7b") === 0)) {
 $_0x6e2e = json_decode($_0xb5ad, true) ?: [];
 // convert to object for array_column logic
 $_0x6e2e = array_map(function ($_0x7646) {
 return (object) $_0x7646;
 }, $_0x6e2e);
 }
 $_0xff97 = array_map(function ($_0xc95f) {
 return $_0xc95f->id;
 }, $_0x9a35[$_0xf547]);
 $_0xdf21 = array_map(function ($_0xc95f) {
 return isset($_0xc95f->id) ? $_0xc95f->id : null;
 }, $_0x6e2e);
 $_0xdf21 = array_filter($_0xdf21);
 $_0x3bb1 = array_merge($_0xff97, $_0xdf21);
 $_0x8654 = array_unique($_0x3bb1);
 $_0xb05c = [];
 if (count($_0x8654) > 0) {
 foreach ($_0x8654 as $_0x2477) {
 $_0xb05c[] = (object) ["\x69\144" => $_0x2477];
 }
 }
 $_0x81dc = $_0xb05c;
 } else {
 $_0x81dc = $_0x9a35[$_0xf547];
 }
 $_0x6e80[$_0x26c8->id_kelas] = $_0x81dc;
 $_0xe77b = array("\x6e\141\x6d\141\x5f\153\x65\154\x61\163" => $_0x26c8->nama_kelas, "\x6b\157\x64\145\x5f\153\x65\154\x61\163" => $_0x26c8->kode_kelas, "\x6a\165\x72\165\x73\141\x6e\137\x69\144" => $_0x26c8->jurusan_id ?? '', "\x69\144\x5f\164\x70" => $_0x17e9->id_tp, "\x69\144\x5f\163\x6d\164" => $_0xa9fa->id_smt, "\x6c\145\x76\145\x6c\137\x69\144" => $_0x26c8->level_id, "\x67\165\x72\165\x5f\151\x64" => $_0x26c8->guru_id, "\x73\151\x73\167\x61\137\x69\144" => $_0x26c8->siswa_id, "\x6a\165\x6d\154\x61\150\x5f\163\x69\163\x77\141" => json_encode($_0x81dc));
 $_0xe011->table("\x6d\141\x73\164\x65\162\x5f\153\x65\154\x61\163")->where("\x69\144\x5f\153\x65\154\x61\163", $_0x26c8->id_kelas)->update($_0xe77b);
 $_0x155d[] = $_0xe77b;
 }
 }
 goto L_2b49e;
 L_9a05c:
 $_0x291a = json_decode($_0xbdfc);
 goto L_38b54;
 L_5eb73:
 $_0x6920["\x72\145\x73"] = $_0x7dbe;
 goto L_3c156;
 L_a5aa0:
 foreach ($_0xd232 as $_0xf3c6) {
 $_0x54da[$_0xf3c6->id_kelas] = $_0xf3c6;
 }
 goto L_d7b2e;
 L_c0ed9:
 // assumed you might need it, let's use standard query if not exist
 // get kls lama manually
 $_0xd232 = $_0xe011->table("\x6d\141\x73\164\x65\162\x5f\153\x65\154\x61\163")->whereIn("\x69\144\x5f\153\x65\154\x61\163", $_0x2c38)->get()->getResult();
 goto L_5e050;
 L_4deb0:
 foreach ($_0xd984 as $_0xb05c) {
 $_0xbfb9[$_0xb05c->nama_kelas] = $_0xb05c;
 }
 goto L_0a462;
 L_56f39:
 foreach ($_0x6e80 as $_0x505a => $_0xbaa9) {
 foreach ($_0xbaa9 as $_0x3a26) {
 $_0xa01b = ["\x69\144\x5f\153\x65\154\x61\163\x5f\163\x69\163\x77\141" => $_0x17e9->id_tp . $_0xa9fa->id_smt . $_0x3a26->id, "\x69\144\x5f\164\x70" => $_0x17e9->id_tp, "\x69\144\x5f\163\x6d\164" => $_0xa9fa->id_smt, "\x69\144\x5f\153\x65\154\x61\163" => $_0x505a, "\x69\144\x5f\163\x69\163\x77\141" => $_0x3a26->id];
 $_0xe011->table("\x6b\145\x6c\141\x73\137\x73\151\x73\167\x61")->replace($_0xa01b);
 $_0x7dbe[] = $_0xa01b;
 }
 }
 goto L_45cd8;
 L_7fc6c:
 $_0xe011 = \Config\Database::connect();
 goto L_fe5e6;
 L_77074:
 // ambil dari kelas lama
 if ($_0x291a && is_array($_0x291a)) {
 foreach ($_0x291a as $_0xf878) {
 $_0x2c38[] = $_0xf878->id_kls_lama;
 $_0x66dd[$_0xf878->id_kls_lama] = $_0xf878->nama_kls_baru;
 $_0x9a35[$_0xf878->id_kls_lama][] = (object) ["\x69\144" => $_0xf878->id_siswa];
 }
 }
 goto L_df3fe;
 L_3c156:
 return $this->response->setJSON($_0x6920);
 L_0b875:
 $_0xd232 = $this->kelasModel->getAllKelasByArrId($_0x2c38);
 goto L_c0ed9;
 L_e524e:
 $_0x2c38 = [];
 goto L_da61f;
 L_02564:
 $_0x155d = [];
 goto L_6fd59;
 L_79994:
 $_0xbdfc = $this->request->getPost("\x6b\145\x6c\141\x73");
 goto L_9a05c;
 }
 public function manage()
 {
 goto L_03b60;
 L_1a92f:
 if (!in_array((string) $_0x23d9->get("\x72\157\x6c\145"), ["\x31", "\x34"])) {
 return redirect()->to("\x64\141\x73\150\x62\157\x61\162\x64")->with("\x65\162\x72\157\x72", "\x48\141\x6e\171\x61\40\x41\144\x6d\151\x6e\151\x73\164\x72\141\x74\157\x72");
 }
 goto L_a500a;
 L_03b60:
 $_0x23d9 = session();
 goto L_05193;
 L_a500a:
 $_0x9d8b = $this->dashboardModel->getTahunActive();
 goto L_ea658;
 L_05193:
 if (!$_0x23d9->get("\x69\163\x5f\154\x6f\147\x69\156")) {
 return redirect()->to("\x61\165\x74\150\x2f\154\x6f\147\x69\156");
 }
 goto L_1a92f;
 L_ea658:
 $_0x24f5 = $this->dashboardModel->getSemesterActive();
 goto L_c2698;
 L_c2698:
 $_0x8385 = ["\x75\163\x65\162" => ["\x66\151\x72\163\x74\137\x6e\141\x6d\145" => $_0x23d9->get("\x75\163\x65\162\x6e\141\x6d\145"), "\x72\157\x6c\145\x5f\156\x61\155\x65" => $_0x23d9->get("\x72\157\x6c\145\x5f\156\x61\155\x65"), "\x66\157\x74\157" => $_0x23d9->get("\x66\157\x74\157") ?? ''], "\x6a\165\x64\165\x6c" => "\x43\157\x70\171\x20\113\x65\154\x61\163", "\x73\165\x62\152\x75\144\x75\154" => "\x43\157\x70\171\x20\104\x61\164\x61\40\x4b\145\x6c\141\x73\40\x6b\145\x20\123\x4d\124\x20\111\x49", "\x73\145\x74\164\x69\156\x67" => $this->dashboardModel->getSetting(), "\x74\160" => $this->dashboardModel->getTahun(), "\x74\160\x5f\141\x63\164\x69\166\x65" => $_0x9d8b, "\x73\155\x74" => $this->dashboardModel->getSemester(), "\x73\155\x74\137\x61\143\x74\151\x76\145" => $_0x24f5, "\x6b\145\x6c\141\x73" => $this->dropdownModel->getAllKelas($_0x9d8b->id_tp, "\x31"), "\x6b\145\x6c\141\x73\62" => $this->dropdownModel->getAllKelas($_0x9d8b->id_tp, "\x32")];
 goto L_e5186;
 L_e5186:
 return view("\x6d\141\x73\164\x65\162\x2f\153\x65\154\x61\163\x2f\160\x65\162\x73\145\x6d\145\x73\164\x65\162", $_0x8385);
 }
 public function persemester()
 {
 goto L_8f362;
 L_bd934:
 // Jika Guru (Role 2)
 if ($_0x24b4->get("\x72\157\x6c\145") == "\x32") {
 $_0x9ae6 = $this->dashboardModel->getTahunActive();
 $_0x2398 = $this->dashboardModel->getSemesterActive();
 $_0xdacf = $this->dashboardModel->getDataGuruByUserId($_0x24b4->get("\x69\144\x5f\165\x73\145\x72"), $_0x9ae6->id_tp ?? null, $_0x2398->id_smt ?? null);
 if (!empty($_0xdacf->wali_kelas)) {
 return redirect()->to("\x77\141\x6c\151\x73\151\x73\167\x61");
 }
 return redirect()->to("\x64\141\x74\141\x6b\145\x6c\141\x73");
 }
 goto L_75a9b;
 L_70b5a:
 if (!$_0x24b4->get("\x69\163\x5f\154\x6f\147\x69\156")) {
 return redirect()->to("\x61\165\x74\150\x2f\154\x6f\147\x69\156");
 }
 goto L_bd934;
 L_8f362:
 $_0x24b4 = session();
 goto L_70b5a;
 L_75a9b:
 // Jika Admin (Role 1)
 return redirect()->to("\x64\141\x74\141\x6b\145\x6c\141\x73");
 }
 public function copyFromSmt1()
 {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x4e\157\x74\40\x66\165\x6c\154\x79\40\x70\157\x72\164\x65\144\x20\171\x65\164"]);
 }
 public function copyAllFromSmt1()
 {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x4e\157\x74\40\x66\165\x6c\154\x79\40\x70\157\x72\164\x65\144\x20\171\x65\164"]);
 }
 public function copyKelasBefore()
 {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x4e\157\x74\40\x66\165\x6c\154\x79\40\x70\157\x72\164\x65\144\x20\171\x65\164"]);
 }
 public function copySiswaFromSmt1()
 {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x4e\157\x74\40\x66\165\x6c\154\x79\40\x70\157\x72\164\x65\144\x20\171\x65\164"]);
 }
 public function naikkan_semua()
 {
 goto L_dc3e3;
 L_ba19c:
 foreach ($_0x795e as $_0x6333) {
 $_0x8d6b[] = $_0x6333;
 }
 goto L_64f2e;
 L_c8d12:
 $_0x6b94 = $this->dashboardModel->getTpBefore($_0x2faf->tahun);
 goto L_6e3e2;
 L_d6bec:
 $_0x78df = $this->dashboardModel->getSemesterActive();
 goto L_6aef9;
 L_4c255:
 $_0x8d6b = [];
 goto L_ba19c;
 L_a2486:
 // gabungkan ke kelas asal
 foreach ($_0x8d6b as $_0x8f97) {
 if (in_array($_0x8f97->id_kelas, array_keys($_0x8548))) {
 $_0x5a16[$_0x8f97->id_kelas] = $_0x8f97;
 } elseif ($_0x6b94 != null && $_0x8f97->id_tp == $_0x6b94->id_tp && $_0x8f97->id_smt == "\x32" && in_array($_0x8f97->nama_kelas, $_0x8548)) {
 $_0xc907[$_0x8f97->nama_kelas] = $_0x8f97;
 } else if ($_0x8f97->id_tp == $_0x2faf->id_tp && $_0x8f97->id_smt == $_0x78df->id_smt) {
 $_0x2bd2[$_0x8f97->nama_kelas] = $_0x8f97;
 }
 }
 goto L_22bbf;
 L_34344:
 $_0x2faf = $this->dashboardModel->getTahunActive();
 goto L_d6bec;
 L_1b91a:
 if (!$_0x8548) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x54\151\x64\141\x6b\40\x61\144\x61\40\x64\141\x74\141"]);
 }
 goto L_c8d12;
 L_8f1da:
 $_0x487d["\x72\145\x73"] = count($_0xc91a);
 goto L_4525f;
 L_57aeb:
 $_0x54c7 = [];
 goto L_9755e;
 L_ef2fa:
 $_0xe729 = [];
 goto L_85d67;
 L_0d1bd:
 $_0x487d["\x75\160\x64\141\x74\145"] = $_0x54c7;
 goto L_b99b2;
 L_10f73:
 // ambil data siswa, guru, jurusan
 $_0xc907 = [];
 goto L_a9add;
 L_2c2ec:
 $_0x487d["\x69\144\x5f\153\x65\154\x61\163"] = $_0xe729;
 goto L_8f1da;
 L_4cbfe:
 $_0x1ce4 = [];
 goto L_a8c15;
 L_6e3e2:
 $_0x795e = $_0xc621->table("\x6d\141\x73\164\x65\162\x5f\153\x65\154\x61\163")->get()->getResult();
 goto L_4c255;
 L_dc3e3:
 $_0xc621 = \Config\Database::connect();
 goto L_34344;
 L_9755e:
 foreach ($_0x8548 as $_0xa84d => $_0xb4ab) {
 if ($_0xa84d != '') {
 $_0x5bbf = $_0x2bd2[$_0xb4ab] ?? null;
 // digabungkan ke kelas asal
 $_0xb96a = $_0xc907[$_0xb4ab] ?? null;
 // ambil nama_kelas, kode_kelas
 $_0x2a7b = $_0x5a16[$_0xa84d] ?? null;
 // ambil data siswa, guru, jurusan
 if (!$_0x2a7b) {
 continue;
 }
 $_0x215e = $_0x2a7b->jumlah_siswa;
 $_0xf34c = [];
 if (is_string($_0x215e) && strpos($_0x215e, "\x61\72") === 0) {
 $_0xf34c = @unserialize($_0x215e) ?: [];
 } elseif (is_string($_0x215e) && (strpos($_0x215e, "\x5b") === 0 || strpos($_0x215e, "\x7b") === 0)) {
 $_0xf34c = json_decode($_0x215e, true) ?: [];
 $_0xf34c = array_map(function ($_0xe2b5) {
 return (object) $_0xe2b5;
 }, $_0xf34c);
 }
 if ($_0x5bbf == null) {
 $_0xf5b8 = array("\x6e\141\x6d\141\x5f\153\x65\154\x61\163" => $_0xb4ab, "\x6b\157\x64\145\x5f\153\x65\154\x61\163" => $_0xb96a ? $_0xb96a->kode_kelas : $_0xb4ab, "\x6a\165\x72\165\x73\141\x6e\137\x69\144" => $_0x2a7b->jurusan_id ?? '', "\x69\144\x5f\164\x70" => $_0x2faf->id_tp, "\x69\144\x5f\163\x6d\164" => $_0x78df->id_smt, "\x6c\145\x76\145\x6c\137\x69\144" => (int) $_0x2a7b->level_id + 1, "\x67\165\x72\165\x5f\151\x64" => $_0x2a7b->guru_id ?? '', "\x73\151\x73\167\x61\137\x69\144" => $_0x2a7b->siswa_id, "\x6a\165\x6d\154\x61\150\x5f\163\x69\163\x77\141" => json_encode($_0xf34c));
 $_0x8533[] = $_0xf5b8;
 $_0xc621->table("\x6d\141\x73\164\x65\162\x5f\153\x65\154\x61\163")->insert($_0xf5b8);
 $_0x560c = $_0xc621->insertID();
 $_0xe405[$_0x560c] = $_0xf34c;
 $_0xe729[] = $_0x560c;
 } else {
 $_0xc50b = $_0x5bbf->jumlah_siswa;
 $_0x6d0f = [];
 if (is_string($_0xc50b) && strpos($_0xc50b, "\x61\72") === 0) {
 $_0x6d0f = @unserialize($_0xc50b) ?: [];
 } elseif (is_string($_0xc50b) && (strpos($_0xc50b, "\x5b") === 0 || strpos($_0xc50b, "\x7b") === 0)) {
 $_0x6d0f = json_decode($_0xc50b, true) ?: [];
 $_0x6d0f = array_map(function ($_0xe2b5) {
 return (object) $_0xe2b5;
 }, $_0x6d0f);
 }
 $_0xe194 = array_map(function ($_0x43da) {
 return isset($_0x43da->id) ? $_0x43da->id : null;
 }, $_0xf34c);
 $_0xbbaa = array_map(function ($_0x43da) {
 return isset($_0x43da->id) ? $_0x43da->id : null;
 }, $_0x6d0f);
 $_0xe194 = array_filter($_0xe194);
 $_0xbbaa = array_filter($_0xbbaa);
 $_0xb134 = array_merge($_0xe194, $_0xbbaa);
 $_0xeb69 = array_unique($_0xb134);
 $_0x3402 = [];
 if (count($_0xeb69) > 0) {
 foreach ($_0xeb69 as $_0xe1b3) {
 $_0x3402[] = (object) ["\x69\144" => $_0xe1b3];
 }
 }
 $_0xe729[] = $_0x5bbf->id_kelas;
 $_0xe405[$_0x5bbf->id_kelas] = $_0x3402;
 $_0xccb1 = array("\x6e\141\x6d\141\x5f\153\x65\154\x61\163" => $_0x5bbf->nama_kelas, "\x6b\157\x64\145\x5f\153\x65\154\x61\163" => $_0x5bbf->kode_kelas, "\x6a\165\x72\165\x73\141\x6e\137\x69\144" => $_0x5bbf->jurusan_id ?? '', "\x69\144\x5f\164\x70" => $_0x5bbf->id_tp, "\x69\144\x5f\163\x6d\164" => $_0x5bbf->id_smt, "\x6c\145\x76\145\x6c\137\x69\144" => $_0x5bbf->level_id, "\x67\165\x72\165\x5f\151\x64" => $_0x5bbf->guru_id, "\x73\151\x73\167\x61\137\x69\144" => $_0x5bbf->siswa_id, "\x6a\165\x6d\154\x61\150\x5f\163\x69\163\x77\141" => json_encode($_0x3402));
 $_0xc621->table("\x6d\141\x73\164\x65\162\x5f\153\x65\154\x61\163")->where("\x69\144\x5f\153\x65\154\x61\163", $_0x5bbf->id_kelas)->update($_0xccb1);
 $_0x54c7[] = $_0xccb1;
 }
 }
 }
 goto L_4cbfe;
 L_a0195:
 $_0x8533 = [];
 goto L_57aeb;
 L_4525f:
 return $this->response->setJSON($_0x487d);
 L_a9add:
 // kelas next level untuk ambil nama_kelas, kode_kelas
 $_0x2bd2 = [];
 goto L_a2486;
 L_22bbf:
 $_0xc91a = [];
 goto L_ef2fa;
 L_b99b2:
 $_0x487d["\x73\151\x73\167\x61"] = $_0xe405;
 goto L_2c2ec;
 L_85d67:
 $_0xe405 = [];
 goto L_a0195;
 L_c5cbf:
 $_0x487d["\x69\156\x73\145\x72\164"] = $_0x8533;
 goto L_0d1bd;
 L_6aef9:
 $_0x8548 = $this->request->getPost("\x6b\145\x6c\141\x73\137\x62\141\x72\165");
 goto L_1b91a;
 L_a8c15:
 foreach ($_0xe729 as $_0xfe3b) {
 foreach ($_0xe405[$_0xfe3b] as $_0xe811) {
 if (isset($_0xe811->id)) {
 $_0xf5b8 = ["\x69\144\x5f\153\x65\154\x61\163\x5f\163\x69\163\x77\141" => $_0x2faf->id_tp . $_0x78df->id_smt . $_0xe811->id, "\x69\144\x5f\164\x70" => $_0x2faf->id_tp, "\x69\144\x5f\163\x6d\164" => $_0x78df->id_smt, "\x69\144\x5f\153\x65\154\x61\163" => $_0xfe3b, "\x69\144\x5f\163\x69\163\x77\141" => $_0xe811->id];
 $_0x1ce4[] = $_0xf5b8;
 $_0xc621->table("\x6b\145\x6c\141\x73\137\x73\151\x73\167\x61")->replace($_0xf5b8);
 $_0xc91a[] = $_0xf5b8;
 }
 }
 }
 goto L_c5cbf;
 L_64f2e:
 $_0x5a16 = [];
 goto L_10f73;
 }
 public function getFromSmt1($_0x76be)
 {
 goto L_ad809;
 L_20b0d:
 $_0xf117 = $this->kelasModel->getKelasSiswa($_0x76be, $_0xe2ba->id_tp, "\x31");
 goto L_bb658;
 L_16862:
 return $this->response->setJSON(["\x73\155\x74\61" => $_0xf117, "\x73\155\x74\62" => $_0xd454]);
 L_bb658:
 $_0x2fbe = $this->kelasModel->getKelasSiswa($_0x76be, $_0xe2ba->id_tp, "\x32");
 goto L_2de96;
 L_ad809:
 $_0xe2ba = $this->dashboardModel->getTahunActive();
 goto L_20b0d;
 L_2de96:
 $_0xd454 = [];
 goto L_61c1b;
 L_61c1b:
 if (!empty($_0x2fbe)) {
 foreach ($_0x2fbe as $_0x3223) {
 $_0xd454[] = $_0x3223->id_siswa;
 }
 }
 goto L_16862;
 }
 public function update_kelas($_0xcfff)
 {
 goto L_d1830;
 L_c1dd9:
 return $this->response->setJSON($_0xa7b7);
 L_62ea9:
 if (is_array($_0x5ae0)) {
 foreach ($_0x5ae0 as $_0x4c86) {
 if ($_0x4c86 != null) {
 $_0xdff2 = ["\x69\144\x5f\153\x65\154\x61\163\x5f\163\x69\163\x77\141" => $_0xaa91 . $_0x54bc . $_0x4c86, "\x69\144\x5f\164\x70" => $_0xaa91, "\x69\144\x5f\163\x6d\164" => $_0x54bc, "\x69\144\x5f\153\x65\154\x61\163" => $_0xcfff, "\x69\144\x5f\163\x69\163\x77\141" => $_0x4c86];
 $_0x7b5e->table("\x6b\145\x6c\141\x73\137\x73\151\x73\167\x61")->replace($_0xdff2);
 }
 }
 }
 goto L_c1dd9;
 L_147f7:
 if (count($_0xa7b7) > 0) {
 foreach ($_0xa7b7 as $_0x4c86 => $_0x1c69) {
 $_0xdff2 = ["\x69\144\x5f\153\x65\154\x61\163\x5f\163\x69\163\x77\141" => $_0xaa91 . $_0x54bc . $_0x4c86, "\x69\144\x5f\164\x70" => $_0xaa91, "\x69\144\x5f\163\x6d\164" => $_0x54bc, "\x69\144\x5f\153\x65\154\x61\163" => 0, "\x69\144\x5f\163\x69\163\x77\141" => $_0x4c86];
 $_0x7b5e->table("\x6b\145\x6c\141\x73\137\x73\151\x73\167\x61")->replace($_0xdff2);
 }
 }
 goto L_037f7;
 L_4e4ae:
 $_0x7b5e = \Config\Database::connect();
 goto L_147f7;
 L_53671:
 $_0x54bc = $this->dashboardModel->getSemesterActive()->id_smt;
 goto L_34eb0;
 L_037f7:
 $_0x5ae0 = $this->request->getPost("\x73\151\x73\167\x61");
 goto L_62ea9;
 L_34eb0:
 $_0xa7b7 = $this->kelasModel->get_status_siswa_kelas($_0xcfff, $_0xaa91, $_0x54bc);
 goto L_4e4ae;
 L_d1830:
 $_0xaa91 = $this->dashboardModel->getTahunActive()->id_tp;
 goto L_53671;
 }
 private function normalize($_0x2534)
 {
 return strtolower(preg_replace("\x2f\133\x5c\163\x2e\134\x2d\137\x5d\57", '', $_0x2534 ?? ''));
 }
}