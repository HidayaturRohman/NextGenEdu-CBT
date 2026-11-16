<?php
/*   ________________________________________
    |               NextGen Garuda CBT       |
    |    Protected & Distributed via GitHub  |
    |________________________________________|
*/
namespace App\Controllers;

use App\Models\DashboardModel;
use App\Models\CbtModel;
class CbtSesi extends BaseController
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
 goto L_68186;
 L_68186:
 $_0x8a12 = $this->dashboardModel->getTahunActive();
 goto L_b16a0;
 L_bd8cc:
 return (object) ["\x74\160" => $this->dashboardModel->getTahun(), "\x74\160\x5f\141\x63\164\x69\166\x65" => $_0x8a12, "\x73\155\x74" => $this->dashboardModel->getSemester(), "\x73\155\x74\137\x61\143\x74\151\x76\145" => $_0x8e19];
 L_b16a0:
 $_0x8e19 = $this->dashboardModel->getSemesterActive();
 goto L_bd8cc;
 }
 public function index()
 {
 goto L_d5539;
 L_2a839:
 $_0x8dba = $this->getTpSmt();
 goto L_64cca;
 L_5eeba:
 $_0x8d21 = (object) ["\x69\144" => $_0x4ea3->get("\x69\144\x5f\165\x73\145\x72"), "\x66\151\x72\163\x74\137\x6e\141\x6d\145" => $_0x4ea3->get("\x75\163\x65\162\x6e\141\x6d\145") ?? "\x41\144\x6d\151\x6e", "\x72\157\x6c\145\x5f\156\x61\155\x65" => $_0x4ea3->get("\x72\157\x6c\145\x5f\156\x61\155\x65") ?? "\x41\144\x6d\151\x6e\151\x73\164\x72\141\x74\157\x72", "\x66\157\x74\157" => $_0x4ea3->get("\x66\157\x74\157") ?? ''];
 goto L_e0800;
 L_64cca:
 $_0x402d["\x74\160"] = $_0x8dba->tp;
 goto L_03c34;
 L_9d812:
 $_0x402d["\x73\155\x74\137\x61\143\x74\151\x76\145"] = $_0x8dba->smt_active;
 goto L_f068f;
 L_7be62:
 if (!$_0x4ea3->get("\x69\163\x5f\154\x6f\147\x69\156")) {
 return redirect()->to("\x61\165\x74\150\x2f\154\x6f\147\x69\156");
 }
 goto L_65d2a;
 L_d5859:
 $_0x402d["\x73\155\x74"] = $_0x8dba->smt;
 goto L_9d812;
 L_e0800:
 $_0x402d = ["\x75\163\x65\162" => $_0x8d21, "\x6a\165\x64\165\x6c" => "\x53\145\x73\151\x20\125\x6a\151\x61\156", "\x73\165\x62\152\x75\144\x75\154" => "\x44\141\x74\141\x20\123\x65\163\x69\40\x55\152\x69\141\x6e", "\x70\162\x6f\146\x69\154\x65" => null, "\x73\145\x74\164\x69\156\x67" => $this->dashboardModel->getSetting()];
 goto L_2a839;
 L_65d2a:
 if (!in_array((string) $_0x4ea3->get("\x72\157\x6c\145"), ["\x31", "\x34"])) {
 return redirect()->to("\x63\142\x74\142\x61\156\x6b\163\x6f\141\x6c")->with("\x65\162\x72\157\x72", "\x41\153\x73\145\x73\40\x64\151\x74\157\x6c\141\x6b\72\x20\110\x61\156\x79\141\x20\101\x64\155\x69\156\x69\163\x74\162\x61\164\x6f\162\x2f\120\x72\157\x6b\164\x6f\162\x20\171\x61\156\x67\40\x62\145\x72\150\x61\153\x20\155\x65\156\x67\145\x6c\157\x6c\141\x20\123\x65\163\x69\40\x55\152\x69\141\x6e\56");
 }
 goto L_5eeba;
 L_f068f:
 return view("\x63\142\x74\57\x73\145\x73\151\x2f\144\x61\164\x61", $_0x402d);
 L_d5539:
 $_0x4ea3 = session();
 goto L_7be62;
 L_03c34:
 $_0x402d["\x74\160\x5f\141\x63\164\x69\166\x65"] = $_0x8dba->tp_active;
 goto L_d5859;
 }
 public function data()
 {
 goto L_6fc94;
 L_8f108:
 return $this->response->setJSON(["\x64\141\x74\141" => $_0xd924]);
 L_2cda7:
 foreach ($_0x49cb as $_0x62ea) {
 $_0xd924[] = ["\x69\144\x5f\163\x65\163\x69" => $_0x62ea->id_sesi, "\x6b\157\x64\145\x5f\163\x65\163\x69" => $_0x62ea->kode_sesi, "\x6e\141\x6d\141\x5f\163\x65\163\x69" => $_0x62ea->nama_sesi, "\x77\141\x6b\164\x75\137\x6d\165\x6c\141\x69" => $_0x62ea->waktu_mulai, "\x77\141\x6b\164\x75\137\x61\153\x68\151\x72" => $_0x62ea->waktu_akhir, "\x69\163\x74\151\x72\141\x68\141\x74" => isset($_0x62ea->istirahat) ? $_0x62ea->istirahat : ''];
 }
 goto L_8f108;
 L_01462:
 $_0xd924 = [];
 goto L_4379b;
 L_4379b:
 $_0xdb10 = 1;
 goto L_2cda7;
 L_6fc94:
 $_0x49cb = $this->cbtModel->getSesi();
 goto L_01462;
 }
 public function add()
 {
 goto L_ff003;
 L_ff003:
 $_0xbcdb = \Config\Database::connect();
 goto L_fc267;
 L_3e30d:
 $_0x5e96["\x73\164\x61\164\x75\163"] = $_0x5834;
 goto L_bcf79;
 L_fc267:
 $_0x5834 = ["\x6e\141\x6d\141\x5f\163\x65\163\x69" => $this->request->getPost("\x6e\141\x6d\141\x5f\163\x65\163\x69"), "\x6b\157\x64\145\x5f\163\x65\163\x69" => $this->request->getPost("\x6b\157\x64\145\x5f\163\x65\163\x69"), "\x77\141\x6b\164\x75\137\x6d\165\x6c\141\x69" => $this->request->getPost("\x77\141\x6b\164\x75\137\x6d\165\x6c\141\x69"), "\x77\141\x6b\164\x75\137\x61\153\x68\151\x72" => $this->request->getPost("\x77\141\x6b\164\x75\137\x61\153\x68\151\x72"), "\x69\163\x74\151\x72\141\x68\141\x74" => $this->request->getPost("\x69\163\x74\151\x72\141\x68\141\x74"), "\x61\153\x74\151\x66" => 1];
 goto L_870d7;
 L_870d7:
 $_0xbcdb->table("\x63\142\x74\137\x73\145\x73\151")->insert($_0x5834);
 goto L_3e30d;
 L_bcf79:
 return $this->response->setJSON($_0x5e96);
 }
 public function update()
 {
 goto L_08d1c;
 L_fa708:
 $_0x9358 = $this->request->getPost("\x6b\157\x64\145\x5f\163\x65\163\x69");
 goto L_300da;
 L_300da:
 $_0x8ddf = $this->request->getPost("\x77\141\x6b\164\x75\137\x6d\165\x6c\141\x69");
 goto L_bfe82;
 L_bfe82:
 $_0xb66f = $this->request->getPost("\x77\141\x6b\164\x75\137\x61\153\x68\151\x72");
 goto L_9839b;
 L_b33f0:
 $_0x8610 = $this->request->getPost("\x6e\141\x6d\141\x5f\163\x65\163\x69");
 goto L_fa708;
 L_08d1c:
 $_0xff44 = $this->request->getPost("\x69\144\x5f\163\x65\163\x69");
 goto L_b33f0;
 L_01b49:
 $_0x7b48 = $this->cbtModel->updateSesi($_0xff44, $_0x8610, $_0x9358, $_0x8ddf, $_0xb66f, $_0x3f28);
 goto L_6420d;
 L_6420d:
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => $_0x7b48]);
 L_9839b:
 $_0x3f28 = $this->request->getPost("\x69\163\x74\151\x72\141\x68\141\x74");
 goto L_01b49;
 }
 public function delete()
 {
 $_0xd68e = $this->request->getPost("\x63\150\x65\143\x6b\145\x64");
 if (!$_0xd68e) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false]);
 } else {
 $_0xe0f1 = \Config\Database::connect();
 $_0xe0f1->table("\x63\142\x74\137\x73\145\x73\151")->whereIn("\x69\144\x5f\163\x65\163\x69", $_0xd68e)->delete();
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => true, "\x74\157\x74\141\x6c" => count($_0xd68e)]);
 }
 }
}