<?php
/*   ________________________________________
    |               NextGen Garuda CBT       |
    |    Protected & Distributed via GitHub  |
    |________________________________________|
*/
namespace App\Controllers;

use App\Models\DashboardModel;
use App\Models\CbtModel;
use App\Models\DropdownModel;
class CbtSesiSiswa extends BaseController
{
 protected $dashboardModel;
 protected $cbtModel;
 protected $dropdownModel;
 public function __construct()
 {
 goto L_09e7b;
 L_09e7b:
 $this->dashboardModel = new DashboardModel();
 goto L_4d888;
 L_937d5:
 $this->dropdownModel = new DropdownModel();
 L_4d888:
 $this->cbtModel = new CbtModel();
 goto L_937d5;
 }
 public function index()
 {
 goto L_6fec6;
 L_7d56f:
 $_0x3047["\x72\165\x61\156\x67"] = $this->dropdownModel->getAllRuang();
 goto L_93f15;
 L_b2870:
 $_0x3047["\x6b\145\x6c\141\x73\137\x73\145\x6c\145\x63\164\x65\144"] = $_0xcbee;
 goto L_d912c;
 L_16d40:
 $_0x3047 = ["\x75\163\x65\162" => $_0xfa26, "\x6a\165\x64\165\x6c" => "\x41\164\x75\162\x20\122\x75\141\x6e\147\x20\144\x61\156\x20\123\x65\163\x69\40\x53\151\x73\167\x61", "\x73\165\x62\152\x75\144\x75\154" => "\x52\165\x61\156\x67\40\x64\141\x6e\40\x53\145\x73\151\x20\123\x69\163\x77\141", "\x73\145\x74\164\x69\156\x67" => $this->dashboardModel->getSetting(), "\x74\160" => $this->dashboardModel->getTahun(), "\x74\160\x5f\141\x63\164\x69\166\x65" => $_0x131b, "\x73\155\x74" => $this->dashboardModel->getSemester(), "\x73\155\x74\137\x61\143\x74\151\x76\145" => $_0xfe73, "\x70\162\x6f\146\x69\154\x65" => null];
 goto L_4217a;
 L_83c76:
 if (!$_0x39a4->get("\x69\163\x5f\154\x6f\147\x69\156")) {
 return redirect()->to("\x61\165\x74\150\x2f\154\x6f\147\x69\156");
 }
 goto L_6ca96;
 L_147d3:
 $_0x39a4 = session();
 goto L_bad40;
 L_bad40:
 $_0xd253 = $_0x39a4->get("\x72\157\x6c\145") == "\x31";
 goto L_20a6a;
 L_6fec6:
 $_0x39a4 = session();
 goto L_83c76;
 L_f9742:
 $_0xfe73 = $this->dashboardModel->getSemesterActive();
 goto L_147d3;
 L_40bbd:
 if ($_0xcbee != "\x30") {
 $_0xcf24 = $this->cbtModel->getRuangSesiSiswa($_0x1aa6, $_0x131b->id_tp, $_0xfe73->id_smt);
 }
 goto L_29c87;
 L_28b1a:
 $_0x131b = $this->dashboardModel->getTahunActive();
 goto L_f9742;
 L_a6b02:
 return view("\x63\142\x74\57\x73\145\x73\151\x73\151\x73\167\x61\57\x64\141\x74\141", $_0x3047);
 L_93f15:
 $_0x3047["\x69\163\x5f\141\x64\155\x69\156"] = $_0xd253;
 goto L_89aa5;
 L_89aa5:
 // Assume admin for now
 $_0x3047["\x6b\145\x6c\141\x73"] = $this->dropdownModel->getAllKelas($_0x131b->id_tp, $_0xfe73->id_smt);
 goto L_a6b02;
 L_29c87:
 $_0x3047["\x73\151\x73\167\x61\163"] = $_0xcf24;
 goto L_b2870;
 L_d912c:
 $_0x3047["\x73\145\x73\151"] = $this->dropdownModel->getAllSesi();
 goto L_7d56f;
 L_20a6a:
 $_0xfa26 = (object) ["\x69\144" => $_0x39a4->get("\x69\144\x5f\165\x73\145\x72"), "\x66\151\x72\163\x74\137\x6e\141\x6d\145" => $_0x39a4->get("\x75\163\x65\162\x6e\141\x6d\145"), "\x72\157\x6c\145\x5f\156\x61\155\x65" => $_0x39a4->get("\x72\157\x6c\145\x5f\156\x61\155\x65"), "\x66\157\x74\157" => $_0x39a4->get("\x66\157\x74\157") ?? ''];
 goto L_16d40;
 L_4217a:
 $_0x1aa6 = $this->request->getGet("\x6b\154\x73");
 goto L_4ee2a;
 L_4ee2a:
 $_0xcbee = $_0x1aa6 != null ? $_0x1aa6 : "\x30";
 goto L_b81b5;
 L_6ca96:
 if (!in_array((string) $_0x39a4->get("\x72\157\x6c\145"), ["\x31", "\x34"])) {
 return redirect()->to("\x63\142\x74\142\x61\156\x6b\163\x6f\141\x6c")->with("\x65\162\x72\157\x72", "\x41\153\x73\145\x73\40\x64\151\x74\157\x6c\141\x6b\72\x20\110\x61\156\x79\141\x20\101\x64\155\x69\156\x69\163\x74\162\x61\164\x6f\162\x2f\120\x72\157\x6b\164\x6f\162\x20\171\x61\156\x67\40\x62\145\x72\150\x61\153\x20\155\x65\156\x67\145\x6c\157\x6c\141\x20\122\x75\141\x6e\147\x20\46\x20\123\x65\163\x69\40\x53\151\x73\167\x61\56");
 }
 goto L_28b1a;
 L_b81b5:
 $_0xcf24 = [];
 goto L_40bbd;
 }
 public function editsesisiswa()
 {
 goto L_ad34a;
 L_3eda7:
 if (is_array($_0xd4e3)) {
 foreach ($_0xd4e3 as $_0x6120 => $_0x5c70) {
 foreach ($_0x5c70 as $_0xfb6e => $_0xbb75) {
 $_0x4076 = !empty($_0xbb75["\x72\165\x61\156\x67"]) && $_0xbb75["\x72\165\x61\156\x67"] != "\x30" ? $_0xbb75["\x72\165\x61\156\x67"] : null;
 $_0xfe41 = !empty($_0xbb75["\x73\145\x73\151"]) && $_0xbb75["\x73\145\x73\151"] != "\x30" ? $_0xbb75["\x73\145\x73\151"] : null;
 $_0xc0f2 = ["\x73\151\x73\167\x61\137\x69\144" => $_0x6120, "\x6b\145\x6c\141\x73\137\x69\144" => $_0xfb6e, "\x72\165\x61\156\x67\137\x69\144" => $_0x4076, "\x73\145\x73\151\x5f\151\x64" => $_0xfe41, "\x74\160\x5f\151\x64" => $_0xb84f->id_tp, "\x73\155\x74\137\x69\144" => $_0x3034->id_smt];
 if (isset($_0x8047[$_0x6120]) && !empty($_0x8047[$_0x6120]->id_sesi_siswa)) {
 $_0xc0f2["\x69\144\x5f\163\x65\163\x69\137\x73\151\x73\167\x61"] = $_0x8047[$_0x6120]->id_sesi_siswa;
 $_0xe0df[] = $_0xc0f2;
 } else if ($_0x4076 !== null || $_0xfe41 !== null) {
 $_0xea10[] = $_0xc0f2;
 }
 }
 }
 }
 goto L_4c4ba;
 L_ee5f3:
 $_0xb4bb = $this->cbtModel->getRuangSesiSiswa($_0xc3f9, $_0xb84f->id_tp, $_0x3034->id_smt);
 goto L_8a6b7;
 L_a74f9:
 if (count($_0xea10) > 0) {
 $_0x909b->table("\x63\142\x74\137\x73\145\x73\151\x5f\163\x69\163\x77\141")->insertBatch($_0xea10);
 }
 goto L_3789e;
 L_84d0d:
 $_0xc3f9 = $this->request->getPost("\x6b\145\x6c\141\x73");
 goto L_91115;
 L_cefc0:
 $_0xe0df = [];
 goto L_e8b75;
 L_3789e:
 if (count($_0xe0df) > 0) {
 $_0x909b->table("\x63\142\x74\137\x73\145\x73\151\x5f\163\x69\163\x77\141")->updateBatch($_0xe0df, "\x69\144\x5f\163\x65\163\x69\137\x73\151\x73\167\x61");
 }
 goto L_539cb;
 L_91115:
 $_0xb84f = $this->dashboardModel->getTahunActive();
 goto L_7435c;
 L_ac8fc:
 foreach ($_0xb4bb as $_0xc02e) {
 $_0x8047[$_0xc02e->id_siswa] = $_0xc02e;
 }
 goto L_cefc0;
 L_ad34a:
 $_0xd4e3 = $this->request->getPost("\x72\165\x61\156\x67\55\x73\145\x73\151");
 goto L_84d0d;
 L_8a6b7:
 $_0x8047 = [];
 goto L_ac8fc;
 L_4c4ba:
 $_0x909b = \Config\Database::connect();
 goto L_a74f9;
 L_539cb:
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => true]);
 L_e8b75:
 $_0xea10 = [];
 goto L_3eda7;
 L_7435c:
 $_0x3034 = $this->dashboardModel->getSemesterActive();
 goto L_ee5f3;
 }
 public function resetsesisiswa()
 {
 goto L_f39eb;
 L_881a7:
 $_0xfca1 = $this->dashboardModel->getSemesterActive();
 goto L_c03b7;
 L_c03b7:
 if (empty($_0xc494) || !$_0x3dd9 || !$_0xfca1) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x50\141\x72\141\x6d\145\x74\145\x72\40\x6b\145\x6c\141\x73\54\x20\124\x50\54\x20\141\x74\141\x75\40\x53\145\x6d\145\x73\164\x65\162\x20\164\x69\144\x61\153\x20\154\x65\156\x67\153\x61\160"]);
 }
 goto L_b7319;
 L_2dd3c:
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => true, "\x6d\145\x73\163\x61\147\x65" => "\x52\165\x61\156\x67\40\x64\141\x6e\40\x73\145\x73\151\x20\153\x65\154\x61\163\x20\142\x65\162\x68\141\x73\151\x6c\40\x64\151\x72\145\x73\145\x74"]);
 L_9438f:
 if (!empty($_0xa21a)) {
 $_0xb9cd->groupStart()->where("\x6b\145\x6c\141\x73\137\x69\144", $_0xc494)->orWhereIn("\x73\151\x73\167\x61\137\x69\144", $_0xa21a)->groupEnd();
 } else {
 $_0xb9cd->where("\x6b\145\x6c\141\x73\137\x69\144", $_0xc494);
 }
 goto L_734d4;
 L_ef85b:
 $_0xb9cd = $_0xf9ea->table("\x63\142\x74\137\x73\145\x73\151\x5f\163\x69\163\x77\141")->where("\x74\160\x5f\151\x64", $_0x3dd9->id_tp)->where("\x73\155\x74\137\x69\144", $_0xfca1->id_smt);
 goto L_9438f;
 L_734d4:
 $_0xb9cd->delete();
 goto L_2dd3c;
 L_42a00:
 $_0x3dd9 = $this->dashboardModel->getTahunActive();
 goto L_881a7;
 L_f39eb:
 $_0xc494 = $this->request->getPost("\x6b\145\x6c\141\x73") ?? $this->request->getGet("\x6b\145\x6c\141\x73");
 goto L_42a00;
 L_b984f:
 $_0xa21a = array_column($_0xada0, "\x69\144\x5f\163\x69\163\x77\141");
 goto L_0bf3a;
 L_0bf3a:
 $_0xf9ea = \Config\Database::connect();
 goto L_ef85b;
 L_b7319:
 $_0xada0 = $this->cbtModel->getRuangSesiSiswa($_0xc494, $_0x3dd9->id_tp, $_0xfca1->id_smt);
 goto L_b984f;
 }
}