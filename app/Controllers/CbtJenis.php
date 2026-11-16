<?php
/*   ________________________________________
    |               NextGen Garuda CBT       |
    |    Protected & Distributed via GitHub  |
    |________________________________________|
*/
namespace App\Controllers;

use App\Models\DashboardModel;
use App\Models\CbtModel;
class CbtJenis extends BaseController
{
 protected $dashboardModel;
 protected $cbtModel;
 public function __construct()
 {
 $this->dashboardModel = new DashboardModel();
 $this->cbtModel = new CbtModel();
 }
 protected function getTpSmt()
 {
 goto L_f2270;
 L_31648:
 $_0xf91e = $this->dashboardModel->getSemesterActive();
 goto L_c135e;
 L_f2270:
 $_0xfd15 = $this->dashboardModel->getTahunActive();
 goto L_31648;
 L_c135e:
 return (object) ["\x74\160" => $this->dashboardModel->getTahun(), "\x74\160\x5f\141\x63\164\x69\166\x65" => $_0xfd15, "\x73\155\x74" => $this->dashboardModel->getSemester(), "\x73\155\x74\137\x61\143\x74\151\x76\145" => $_0xf91e];
 }
 public function index()
 {
 goto L_8429d;
 L_90a36:
 $_0xde49["\x73\155\x74"] = $_0xfabd->smt;
 goto L_38bdf;
 L_48242:
 if (!$_0x4ea3->get("\x69\163\x5f\154\x6f\147\x69\156")) {
 return redirect()->to("\x61\165\x74\150\x2f\154\x6f\147\x69\156");
 }
 goto L_96db0;
 L_44ede:
 $_0xde49["\x74\160\x5f\141\x63\164\x69\166\x65"] = $_0xfabd->tp_active;
 goto L_90a36;
 L_0f676:
 $_0xde49 = ["\x75\163\x65\162" => $_0x6442, "\x6a\165\x64\165\x6c" => "\x4a\145\x6e\151\x73\40\x55\152\x69\141\x6e", "\x73\165\x62\152\x75\144\x75\154" => "\x44\141\x74\141\x20\112\x65\156\x69\163\x20\125\x6a\151\x61\156", "\x70\162\x6f\146\x69\154\x65" => null, "\x73\145\x74\164\x69\156\x67" => $this->dashboardModel->getSetting()];
 goto L_3fdd5;
 L_38bdf:
 $_0xde49["\x73\155\x74\137\x61\143\x74\151\x76\145"] = $_0xfabd->smt_active;
 goto L_a1436;
 L_6396a:
 $_0x6442 = (object) ["\x69\144" => $_0x4ea3->get("\x69\144\x5f\165\x73\145\x72"), "\x66\151\x72\163\x74\137\x6e\141\x6d\145" => $_0x4ea3->get("\x75\163\x65\162\x6e\141\x6d\145") ?? "\x41\144\x6d\151\x6e", "\x72\157\x6c\145\x5f\156\x61\155\x65" => $_0x4ea3->get("\x72\157\x6c\145\x5f\156\x61\155\x65") ?? "\x41\144\x6d\151\x6e\151\x73\164\x72\141\x74\157\x72", "\x66\157\x74\157" => $_0x4ea3->get("\x66\157\x74\157") ?? ''];
 goto L_0f676;
 L_909d2:
 $_0xde49["\x74\160"] = $_0xfabd->tp;
 goto L_44ede;
 L_96db0:
 if (!in_array((string) $_0x4ea3->get("\x72\157\x6c\145"), ["\x31", "\x34"])) {
 return redirect()->to("\x63\142\x74\142\x61\156\x6b\163\x6f\141\x6c")->with("\x65\162\x72\157\x72", "\x41\153\x73\145\x73\40\x64\151\x74\157\x6c\141\x6b\72\x20\110\x61\156\x79\141\x20\101\x64\155\x69\156\x69\163\x74\162\x61\164\x6f\162\x2f\120\x72\157\x6b\164\x6f\162\x20\171\x61\156\x67\40\x62\145\x72\150\x61\153\x20\155\x65\156\x67\145\x6c\157\x6c\141\x20\112\x65\156\x69\163\x20\125\x6a\151\x61\156\x2e");
 }
 goto L_6396a;
 L_8429d:
 $_0x4ea3 = session();
 goto L_48242;
 L_3fdd5:
 $_0xfabd = $this->getTpSmt();
 goto L_909d2;
 L_a1436:
 return view("\x63\142\x74\57\x6a\145\x6e\151\x73\57\x64\141\x74\141", $_0xde49);
 }
 public function data()
 {
 goto L_15794;
 L_15794:
 // Used by datatables
 $_0x3ecc = $this->cbtModel->getJenis();
 goto L_0472b;
 L_9baca:
 return $this->response->setJSON(["\x64\141\x74\141" => $_0xae23]);
 L_0472b:
 $_0xae23 = [];
 goto L_3a0d1;
 L_81a6a:
 foreach ($_0x3ecc as $_0x62ea) {
 $_0xae23[] = ["\x69\144\x5f\152\x65\156\x69\163" => $_0x62ea->id_jenis, "\x6e\141\x6d\141\x5f\152\x65\156\x69\163" => $_0x62ea->nama_jenis, "\x6b\157\x64\145\x5f\152\x65\156\x69\163" => $_0x62ea->kode_jenis, "\x6b\141\x74\145\x67\157\x72\151" => $_0x62ea->kategori ?? "\x6c\141\x69\156\x6e\171\x61"];
 }
 goto L_9baca;
 L_3a0d1:
 $_0xdb10 = 1;
 goto L_81a6a;
 }
 public function add()
 {
 goto L_3cd3b;
 L_72517:
 $_0xb63a = ["\x6e\141\x6d\141\x5f\152\x65\156\x69\163" => trim($this->request->getPost("\x6e\141\x6d\141\x5f\152\x65\156\x69\163") ?? ''), "\x6b\157\x64\145\x5f\152\x65\156\x69\163" => trim($this->request->getPost("\x6b\157\x64\145\x5f\152\x65\156\x69\163") ?? ''), "\x6b\141\x74\145\x67\157\x72\151" => trim($this->request->getPost("\x6b\141\x74\145\x67\157\x72\151") ?? "\x6c\141\x69\156\x6e\171\x61")];
 goto L_fedd5;
 L_d4d31:
 $_0x5e96["\x73\164\x61\164\x75\163"] = (bool) $_0x9b9d;
 goto L_1d3b8;
 L_3cd3b:
 $_0x25d2 = \Config\Database::connect();
 goto L_72517;
 L_1c679:
 return $this->response->setJSON($_0x5e96);
 L_fedd5:
 $_0x9b9d = $_0x25d2->table("\x63\142\x74\137\x6a\145\x6e\151\x73")->insert($_0xb63a);
 goto L_d4d31;
 L_1d3b8:
 $_0x5e96["\x69\156\x73\145\x72\164"] = $_0xb63a;
 goto L_1c679;
 }
 public function update()
 {
 goto L_cfd70;
 L_bd89b:
 $_0x72fe = $this->cbtModel->updateJenis($_0x114a, $_0x8610, $_0x9435, $_0xe823);
 goto L_f1695;
 L_cfd70:
 $_0x114a = $this->request->getPost("\x69\144\x5f\152\x65\156\x69\163");
 goto L_aadf8;
 L_f1695:
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => $_0x72fe]);
 L_aadf8:
 $_0x8610 = $this->request->getPost("\x6e\141\x6d\141\x5f\152\x65\156\x69\163");
 goto L_aac1e;
 L_59271:
 $_0xe823 = $this->request->getPost("\x6b\141\x74\145\x67\157\x72\151") ?? "\x6c\141\x69\156\x6e\171\x61";
 goto L_bd89b;
 L_aac1e:
 $_0x9435 = $this->request->getPost("\x6b\157\x64\145\x5f\152\x65\156\x69\163");
 goto L_59271;
 }
 public function delete()
 {
 $_0x847f = $this->request->getPost("\x63\150\x65\143\x6b\145\x64");
 if (!$_0x847f) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false]);
 } else {
 $_0x97f6 = \Config\Database::connect();
 $_0x97f6->table("\x63\142\x74\137\x6a\145\x6e\151\x73")->whereIn("\x69\144\x5f\152\x65\156\x69\163", $_0x847f)->delete();
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => true, "\x74\157\x74\141\x6c" => count($_0x847f)]);
 }
 }
}