<?php
/*   ________________________________________
    |               NextGen Garuda CBT       |
    |    Protected & Distributed via GitHub  |
    |________________________________________|
*/
namespace App\Controllers;

use App\Models\DashboardModel;
use App\Models\CbtModel;
class CbtRuang extends BaseController
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
 goto L_7a5c7;
 L_1c01b:
 $_0xf91e = $this->dashboardModel->getSemesterActive();
 goto L_9d64f;
 L_7a5c7:
 $_0xfd15 = $this->dashboardModel->getTahunActive();
 goto L_1c01b;
 L_9d64f:
 return (object) ["\x74\160" => $this->dashboardModel->getTahun(), "\x74\160\x5f\141\x63\164\x69\166\x65" => $_0xfd15, "\x73\155\x74" => $this->dashboardModel->getSemester(), "\x73\155\x74\137\x61\143\x74\151\x76\145" => $_0xf91e];
 }
 public function index()
 {
 goto L_18e1a;
 L_21252:
 return view("\x63\142\x74\57\x72\165\x61\156\x67\57\x64\141\x74\141", $_0xde49);
 L_494bf:
 $_0x8d21 = (object) ["\x69\144" => $_0x4ea3->get("\x69\144\x5f\165\x73\145\x72"), "\x66\151\x72\163\x74\137\x6e\141\x6d\145" => $_0x4ea3->get("\x75\163\x65\162\x6e\141\x6d\145") ?? "\x41\144\x6d\151\x6e", "\x72\157\x6c\145\x5f\156\x61\155\x65" => $_0x4ea3->get("\x72\157\x6c\145\x5f\156\x61\155\x65") ?? "\x41\144\x6d\151\x6e\151\x73\164\x72\141\x74\157\x72", "\x66\157\x74\157" => $_0x4ea3->get("\x66\157\x74\157") ?? ''];
 goto L_def3e;
 L_12c18:
 if (!$_0x4ea3->get("\x69\163\x5f\154\x6f\147\x69\156")) {
 return redirect()->to("\x61\165\x74\150\x2f\154\x6f\147\x69\156");
 }
 goto L_71b81;
 L_def3e:
 $_0xde49 = ["\x75\163\x65\162" => $_0x8d21, "\x6a\165\x64\165\x6c" => "\x52\165\x61\156\x67\40\x55\152\x69\141\x6e", "\x73\165\x62\152\x75\144\x75\154" => "\x44\141\x74\141\x20\122\x75\141\x6e\147\x20\125\x6a\151\x61\156", "\x70\162\x6f\146\x69\154\x65" => null, "\x73\145\x74\164\x69\156\x67" => $this->dashboardModel->getSetting()];
 goto L_95f9d;
 L_95f9d:
 $_0x13de = $this->getTpSmt();
 goto L_3cc82;
 L_b9189:
 $_0xde49["\x74\160\x5f\141\x63\164\x69\166\x65"] = $_0x13de->tp_active;
 goto L_77972;
 L_18e1a:
 $_0x4ea3 = session();
 goto L_12c18;
 L_3cc82:
 $_0xde49["\x74\160"] = $_0x13de->tp;
 goto L_b9189;
 L_d65e3:
 $_0xde49["\x73\155\x74\137\x61\143\x74\151\x76\145"] = $_0x13de->smt_active;
 goto L_21252;
 L_71b81:
 if (!in_array((string) $_0x4ea3->get("\x72\157\x6c\145"), ["\x31", "\x34"])) {
 return redirect()->to("\x63\142\x74\142\x61\156\x6b\163\x6f\141\x6c")->with("\x65\162\x72\157\x72", "\x41\153\x73\145\x73\40\x64\151\x74\157\x6c\141\x6b\72\x20\110\x61\156\x79\141\x20\101\x64\155\x69\156\x69\163\x74\162\x61\164\x6f\162\x2f\120\x72\157\x6b\164\x6f\162\x20\171\x61\156\x67\40\x62\145\x72\150\x61\153\x20\155\x65\156\x67\145\x6c\157\x6c\141\x20\122\x75\141\x6e\147\x20\125\x6a\151\x61\156\x2e");
 }
 goto L_494bf;
 L_77972:
 $_0xde49["\x73\155\x74"] = $_0x13de->smt;
 goto L_d65e3;
 }
 public function data()
 {
 goto L_84610;
 L_19062:
 $_0xd924 = [];
 goto L_cdfbf;
 L_84610:
 $_0x49cb = $this->cbtModel->getRuang();
 goto L_19062;
 L_77461:
 return $this->response->setJSON(["\x64\141\x74\141" => $_0xd924]);
 L_cdfbf:
 $_0xac17 = 1;
 goto L_0df89;
 L_0df89:
 foreach ($_0x49cb as $_0x15ed) {
 $_0xd924[] = ["\x69\144\x5f\162\x75\141\x6e\147" => $_0x15ed->id_ruang, "\x6b\157\x64\145\x5f\162\x75\141\x6e\147" => $_0x15ed->kode_ruang, "\x6e\141\x6d\141\x5f\162\x75\141\x6e\147" => $_0x15ed->nama_ruang, "\x6a\165\x6d\137\x73\145\x73\151" => $_0x15ed->jum_sesi];
 }
 goto L_77461;
 }
 public function add()
 {
 goto L_59d09;
 L_f55cf:
 $_0x2991["\x73\164\x61\164\x75\163"] = $_0xc13d;
 goto L_e650b;
 L_59d09:
 $_0x52d5 = \Config\Database::connect();
 goto L_aec96;
 L_261d1:
 $_0x52d5->table("\x63\142\x74\137\x72\165\x61\156\x67")->insert($_0xc13d);
 goto L_f55cf;
 L_e650b:
 return $this->response->setJSON($_0x2991);
 L_aec96:
 $_0xc13d = ["\x6e\141\x6d\141\x5f\162\x75\141\x6e\147" => $this->request->getPost("\x6e\141\x6d\141\x5f\162\x75\141\x6e\147"), "\x6b\157\x64\145\x5f\162\x75\141\x6e\147" => $this->request->getPost("\x6b\157\x64\145\x5f\162\x75\141\x6e\147")];
 goto L_261d1;
 }
 public function update()
 {
 goto L_34525;
 L_84335:
 $_0xec9a = $this->cbtModel->updateRuang($_0x664d, $_0x1f19, $_0xe332);
 goto L_dc96e;
 L_72f86:
 $_0xe332 = $this->request->getPost("\x6b\157\x64\145\x5f\162\x75\141\x6e\147");
 goto L_84335;
 L_34525:
 $_0x664d = $this->request->getPost("\x69\144\x5f\162\x75\141\x6e\147");
 goto L_1dc4b;
 L_1dc4b:
 $_0x1f19 = $this->request->getPost("\x6e\141\x6d\141\x5f\162\x75\141\x6e\147");
 goto L_72f86;
 L_dc96e:
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => $_0xec9a]);
 }
 public function delete()
 {
 $_0x63c7 = $this->request->getPost("\x63\150\x65\143\x6b\145\x64");
 if (!$_0x63c7) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false]);
 } else {
 $_0xb200 = \Config\Database::connect();
 $_0xb200->table("\x63\142\x74\137\x72\165\x61\156\x67")->whereIn("\x69\144\x5f\162\x75\141\x6e\147", $_0x63c7)->delete();
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => true, "\x74\157\x74\141\x6c" => count($_0x63c7)]);
 }
 }
}