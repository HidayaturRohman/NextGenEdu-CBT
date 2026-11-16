<?php
/*   ________________________________________
    |               NextGen Garuda CBT       |
    |    Protected & Distributed via GitHub  |
    |________________________________________|
*/
namespace App\Controllers;

use App\Models\DashboardModel;
use App\Models\MasterModel;
class Useradmin extends BaseController
{
 protected $dashboardModel;
 protected $masterModel;
 public function __construct()
 {
 $this->dashboardModel = new DashboardModel();
 $this->masterModel = new MasterModel();
 }
 public function data()
 {
 goto L_12e87;
 L_3ea08:
 $_0xc5a9 = \Config\Database::connect();
 goto L_fde93;
 L_75010:
 return view("\x75\163\x65\162\x73\57\x61\144\x6d\151\x6e\57\x64\141\x74\141", $_0x4740);
 L_43be7:
 foreach ($_0x9d2d as $_0x2f88) {
 if (is_numeric($_0x2f88->created_on) && $_0x2f88->created_on > 0) {
 $_0x2f88->created_on = date("\x59\55\x6d\55\x64\40\x48\72\x69\72\x73", $_0x2f88->created_on);
 }
 }
 goto L_9f961;
 L_9f961:
 $_0x4740 = ["\x75\163\x65\162" => (object) ["\x69\144" => $_0x4ea3->get("\x75\163\x65\162\x5f\151\x64"), "\x66\151\x72\163\x74\137\x6e\141\x6d\145" => $_0x4ea3->get("\x75\163\x65\162\x6e\141\x6d\145"), "\x72\157\x6c\145\x5f\156\x61\155\x65" => $_0x4ea3->get("\x72\157\x6c\145\x5f\156\x61\155\x65"), "\x66\157\x74\157" => $_0x4ea3->get("\x66\157\x74\157") ?? ''], "\x6a\165\x64\165\x6c" => "\x41\144\x6d\151\x6e\40\x4d\141\x6e\141\x67\145\x6d\145\x6e\164", "\x73\165\x62\152\x75\144\x75\154" => "\x44\141\x74\141\x20\101\x64\155\x69\156", "\x61\144\x6d\151\x6e\163" => $_0x9d2d, "\x69\163\x5f\141\x64\155\x69\156" => true, "\x73\145\x74\164\x69\156\x67" => $this->dashboardModel->getSetting(), "\x74\160" => $this->dashboardModel->getTahun(), "\x74\160\x5f\141\x63\164\x69\166\x65" => $this->dashboardModel->getTahunActive(), "\x73\155\x74" => $this->dashboardModel->getSemester(), "\x73\155\x74\137\x61\143\x74\151\x76\145" => $this->dashboardModel->getSemesterActive()];
 goto L_75010;
 L_ff879:
 if (!$_0x4ea3->get("\x69\163\x5f\154\x6f\147\x69\156")) {
 return redirect()->to("\x61\165\x74\150\x2f\154\x6f\147\x69\156");
 }
 goto L_0b753;
 L_fde93:
 $_0x9d2d = $_0xc5a9->table("\x75\163\x65\162\x73")->select("\x75\163\x65\162\x73\56\x69\144\x2c\40\x75\163\x65\162\x73\56\x75\163\x65\162\x6e\141\x6d\145\x2c\40\x75\163\x65\162\x73\56\x66\151\x72\163\x74\137\x6e\141\x6d\145\x2c\40\x75\163\x65\162\x73\56\x6c\141\x73\164\x5f\156\x61\155\x65\54\x20\165\x73\145\x72\163\x2e\145\x6d\141\x69\154\x2c\40\x75\163\x65\162\x73\56\x61\143\x74\151\x76\145\x2c\40\x75\163\x65\162\x73\56\x63\162\x65\141\x74\145\x64\137\x6f\156\x2c\40\x67\162\x6f\165\x70\163\x2e\156\x61\155\x65\40\x61\163\x20\154\x65\166\x65\154\x2c\40\x67\162\x6f\165\x70\163\x2e\156\x61\155\x65\40\x61\163\x20\147\x72\157\x75\160\x5f\156\x61\155\x65")->join("\x75\163\x65\162\x73\137\x67\162\x6f\165\x70\163", "\x75\163\x65\162\x73\137\x67\162\x6f\165\x70\163\x2e\165\x73\145\x72\137\x69\144\x20\75\x20\165\x73\145\x72\163\x2e\151\x64")->join("\x67\162\x6f\165\x70\163", "\x67\162\x6f\165\x70\163\x2e\151\x64\40\x3d\40\x75\163\x65\162\x73\137\x67\162\x6f\165\x70\163\x2e\147\x72\157\x75\160\x5f\151\x64")->where("\x75\163\x65\162\x73\137\x67\162\x6f\165\x70\163\x2e\147\x72\157\x75\160\x5f\151\x64", 1)->get()->getResult();
 goto L_43be7;
 L_0b753:
 if ($_0x4ea3->get("\x72\157\x6c\145") != "\x31") {
 return redirect()->to("\x64\141\x73\150\x62\157\x61\162\x64")->with("\x65\162\x72\157\x72", "\x48\141\x6e\171\x61\40\x41\144\x6d\151\x6e\151\x73\164\x72\141\x74\157\x72");
 }
 goto L_3ea08;
 L_12e87:
 $_0x4ea3 = session();
 goto L_ff879;
 }
 public function edit($_0x4324)
 {
 goto L_f82b1;
 L_90f99:
 $_0xd505 = $_0x5bcd->table("\x75\163\x65\162\x73")->where("\x69\144", $_0x4324)->get()->getRow();
 goto L_7165e;
 L_b0534:
 $_0x5bcd = \Config\Database::connect();
 goto L_90f99;
 L_7165e:
 if ($_0xd505) {
 $_0xc018 = $_0x5bcd->table("\x75\163\x65\162\x73\137\x67\162\x6f\165\x70\163")->where("\x75\163\x65\162\x5f\151\x64", $_0x4324)->get()->getRow();
 $_0xd505->group_id = $_0xc018 ? $_0xc018->group_id : '';
 }
 goto L_71a69;
 L_f82b1:
 $_0x3012 = session();
 goto L_7c004;
 L_7c004:
 if (!$_0x3012->get("\x69\163\x5f\154\x6f\147\x69\156")) {
 return redirect()->to("\x61\165\x74\150\x2f\154\x6f\147\x69\156");
 }
 goto L_09382;
 L_fc551:
 return view("\x75\163\x65\162\x73\57\x61\144\x6d\151\x6e\57\x65\144\x69\164", $_0x2991);
 L_71a69:
 $_0x2991 = ["\x75\163\x65\162" => (object) ["\x69\144" => $_0x3012->get("\x75\163\x65\162\x5f\151\x64"), "\x66\151\x72\163\x74\137\x6e\141\x6d\145" => $_0x3012->get("\x75\163\x65\162\x6e\141\x6d\145"), "\x72\157\x6c\145\x5f\156\x61\155\x65" => $_0x3012->get("\x72\157\x6c\145\x5f\156\x61\155\x65"), "\x66\157\x74\157" => $_0x3012->get("\x66\157\x74\157") ?? ''], "\x6a\165\x64\165\x6c" => "\x41\144\x6d\151\x6e\151\x73\164\x72\141\x74\157\x72", "\x73\165\x62\152\x75\144\x75\154" => "\x45\144\x69\164\x20\104\x61\164\x61\40\x41\144\x6d\151\x6e", "\x75\163\x65\162\x73" => $_0xd505, "\x67\162\x6f\165\x70\163" => $_0x5bcd->table("\x67\162\x6f\165\x70\163")->get()->getResult(), "\x6c\145\x76\145\x6c" => $_0x3012->get("\x72\157\x6c\145") == "\x31" ? "\x31" : "\x32", "\x73\145\x74\164\x69\156\x67" => $this->dashboardModel->getSetting(), "\x74\160" => $this->dashboardModel->getTahun(), "\x74\160\x5f\141\x63\164\x69\166\x65" => $this->dashboardModel->getTahunActive(), "\x73\155\x74" => $this->dashboardModel->getSemester(), "\x73\155\x74\137\x61\143\x74\151\x76\145" => $this->dashboardModel->getSemesterActive(), "\x69\163\x5f\141\x64\155\x69\156" => $_0x3012->get("\x72\157\x6c\145") == "\x31"];
 goto L_fc551;
 L_09382:
 if ($_0x3012->get("\x72\157\x6c\145") != "\x31") {
 return redirect()->to("\x64\141\x73\150\x62\157\x61\162\x64")->with("\x65\162\x72\157\x72", "\x48\141\x6e\171\x61\40\x41\144\x6d\151\x6e\151\x73\164\x72\141\x74\157\x72");
 }
 goto L_b0534;
 }
 public function create()
 {
 goto L_f0c99;
 L_95612:
 $_0xbf88 = trim((string) $this->request->getPost("\x66\151\x72\163\x74\137\x6e\141\x6d\145"));
 goto L_12cb4;
 L_b5254:
 try {
 $_0x52d5->table("\x75\163\x65\162\x73")->insert($_0x2f33);
 $_0x8028 = $_0x52d5->insertID();
 if (!empty($_0x8028)) {
 $_0x52d5->table("\x75\163\x65\162\x73\137\x67\162\x6f\165\x70\163")->insert(["\x75\163\x65\162\x5f\151\x64" => $_0x8028, "\x67\162\x6f\165\x70\137\x69\144" => "\x31"]);
 }
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => true, "\x6d\163\x67" => "\x41\153\x75\156\x20\101\x64\155\x69\156\x69\163\x74\162\x61\164\x6f\162\x20\142\x61\162\x75\40\x62\145\x72\150\x61\163\x69\154\x20\144\x69\142\x75\141\x74\56"]);
 } catch (\Exception $_0xdab2) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\163\x67" => "\x47\141\x67\141\x6c\40\x6d\145\x6e\171\x69\155\x70\141\x6e\40\x6b\145\x20\144\x61\164\x61\142\x61\163\x65\72\x20" . $_0xdab2->getMessage()]);
 }
 L_5a724:
 $_0x5f35 = trim((string) $this->request->getPost("\x65\155\x61\151\x6c"));
 goto L_08779;
 L_993b8:
 if (strlen($_0xbe4a) < 4) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\163\x67" => "\x50\141\x73\163\x77\157\x72\144\x20\155\x69\156\x69\155\x61\154\x20\64\x20\153\x61\162\x61\153\x74\145\x72\56"]);
 }
 goto L_3a9db;
 L_af46c:
 $_0xfdc9 = trim((string) $this->request->getPost("\x75\163\x65\162\x6e\141\x6d\145"));
 goto L_6f2ca;
 L_fd664:
 if (empty($_0xbf88)) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\163\x67" => "\x4e\141\x6d\141\x20\144\x65\160\x61\156\x20\167\x61\152\x69\142\x20\144\x69\151\x73\151\x2e"]);
 }
 goto L_70776;
 L_3ce06:
 $_0x52d5 = \Config\Database::connect();
 goto L_27cce;
 L_70776:
 if (empty($_0xbe4a)) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\163\x67" => "\x50\141\x73\163\x77\157\x72\144\x20\167\x61\152\x69\142\x20\144\x69\151\x73\151\x2e"]);
 }
 goto L_993b8;
 L_fd8a2:
 $_0xec9a = (string) $this->request->getPost("\x63\157\x6e\146\x69\162\x6d\137\x70\141\x73\163\x77\157\x72\144");
 goto L_95612;
 L_08779:
 if (empty($_0xfdc9)) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\163\x67" => "\x55\163\x65\162\x6e\141\x6d\145\x20\167\x61\152\x69\142\x20\144\x69\151\x73\151\x2e"]);
 }
 goto L_fd664;
 L_3fb4b:
 if (!$_0x5476->get("\x69\163\x5f\154\x6f\147\x69\156") || $_0x5476->get("\x72\157\x6c\145") != "\x31") {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\163\x67" => "\x41\153\x73\145\x73\40\x64\151\x74\157\x6c\141\x6b\56\x20\110\x61\156\x79\141\x20\101\x64\155\x69\156\x69\163\x74\162\x61\164\x6f\162\x20\171\x61\156\x67\40\x64\141\x70\141\x74\40\x6d\145\x6d\142\x75\141\x74\40\x61\153\x75\156\x20\141\x64\155\x69\156\x2e"]);
 }
 goto L_af46c;
 L_f0c99:
 $_0x5476 = session();
 goto L_3fb4b;
 L_c10cf:
 if (empty($_0x5f35)) {
 $_0x5f35 = $_0xfdc9 . "\x40\141\x64\155\x69\156\x2e\154\x6f\143\x61\154";
 }
 goto L_a2ac3;
 L_ceaf9:
 if (empty($_0xe271) || $_0xe271 === "\x3a\72\x31") {
 $_0xe271 = "\x31\62\x37\56\x30\56\x30\56\x31";
 }
 goto L_d1c71;
 L_d1c71:
 $_0x2f33 = ["\x69\160\x5f\141\x64\144\x72\145\x73\163" => $_0xe271, "\x75\163\x65\162\x6e\141\x6d\145" => $_0xfdc9, "\x70\141\x73\163\x77\157\x72\144" => password_hash($_0xbe4a, PASSWORD_BCRYPT), "\x66\151\x72\163\x74\137\x6e\141\x6d\145" => $_0xbf88, "\x6c\141\x73\164\x5f\156\x61\155\x65" => $_0xccdc, "\x65\155\x61\151\x6c" => $_0x5f35, "\x63\162\x65\141\x74\145\x64\137\x6f\156" => time(), "\x61\143\x74\151\x76\145" => 1];
 goto L_b5254;
 L_6f2ca:
 $_0xbe4a = (string) $this->request->getPost("\x70\141\x73\163\x77\157\x72\144");
 goto L_fd8a2;
 L_3a9db:
 if (!empty($_0xec9a) && $_0xbe4a !== $_0xec9a) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\163\x67" => "\x4b\157\x6e\146\x69\162\x6d\141\x73\151\x20\160\x61\163\x73\167\x6f\162\x64\40\x74\151\x64\141\x6b\40\x63\157\x63\157\x6b\56"]);
 }
 goto L_3ce06;
 L_a2ac3:
 $_0xe271 = $this->request->getIPAddress();
 goto L_ceaf9;
 L_0b133:
 if ($_0x623a > 0) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\163\x67" => "\x55\163\x65\162\x6e\141\x6d\145\x20\42" . $_0xfdc9 . "\x22\40\x73\165\x64\141\x68\40\x64\151\x67\165\x6e\141\x6b\141\x6e\56"]);
 }
 goto L_c10cf;
 L_27cce:
 $_0x623a = $_0x52d5->table("\x75\163\x65\162\x73")->where("\x75\163\x65\162\x6e\141\x6d\145", $_0xfdc9)->countAllResults();
 goto L_0b133;
 L_12cb4:
 $_0xccdc = trim((string) $this->request->getPost("\x6c\141\x73\164\x5f\156\x61\155\x65"));
 goto L_5a724;
 }
 public function edit_info()
 {
 goto L_3ee5b;
 L_3b8cd:
 $_0x466c = ["\x66\151\x72\163\x74\137\x6e\141\x6d\145" => $this->request->getPost("\x66\151\x72\163\x74\137\x6e\141\x6d\145"), "\x6c\141\x73\164\x5f\156\x61\155\x65" => $this->request->getPost("\x6c\141\x73\164\x5f\156\x61\155\x65"), "\x65\155\x61\151\x6c" => $this->request->getPost("\x65\155\x61\151\x6c"), "\x6a\141\x62\141\x74\141\x6e" => $this->request->getPost("\x6a\141\x62\141\x74\141\x6e")];
 goto L_9c025;
 L_3ee5b:
 $_0x3a67 = $this->request->getPost("\x69\144");
 goto L_3b8cd;
 L_24163:
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => (bool) $_0x9bc5]);
 L_9c025:
 $_0x9bc5 = $this->masterModel->updateData("\x75\163\x65\162\x73", $_0x466c, "\x69\144", $_0x3a67);
 goto L_24163;
 }
 public function edit_status($_0xd469 = null)
 {
 goto L_2c518;
 L_671ee:
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => (bool) $_0xee04]);
 L_c71cc:
 $_0x7ad7 = ["\x61\143\x74\151\x76\145" => $this->request->getPost("\x73\164\x61\164\x75\163")];
 goto L_1089a;
 L_1089a:
 $_0xee04 = $this->masterModel->updateData("\x75\163\x65\162\x73", $_0x7ad7, "\x69\144", $_0xd469);
 goto L_671ee;
 L_2c518:
 $_0xd469 = $_0xd469 ?? $this->request->getPost("\x69\144");
 goto L_c71cc;
 }
 public function edit_level()
 {
 goto L_b7a29;
 L_e80ee:
 $_0x1a10 = ["\x67\162\x6f\165\x70\137\x69\144" => $this->request->getPost("\x6c\145\x76\145\x6c")];
 goto L_45967;
 L_45967:
 $_0x8ec3 = $this->masterModel->updateData("\x75\163\x65\162\x73\137\x67\162\x6f\165\x70\163", $_0x1a10, "\x75\163\x65\162\x5f\151\x64", $_0xbd18);
 goto L_fc0a6;
 L_fc0a6:
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => (bool) $_0x8ec3]);
 L_b7a29:
 $_0xbd18 = $this->request->getPost("\x69\144");
 goto L_e80ee;
 }
 public function change_password()
 {
 goto L_063eb;
 L_19d85:
 $_0x7b21 = $_0x8980->table("\x75\163\x65\162\x73")->where("\x75\163\x65\162\x6e\141\x6d\145", $_0xb14e)->where("\x69\144\x20\41\x3d", $_0xba75)->countAllResults();
 goto L_58a77;
 L_78fb7:
 $_0xba75 = $this->request->getPost("\x69\144");
 goto L_69af6;
 L_3d0d2:
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => (bool) $_0x67a0, "\x6d\163\x67" => $_0x67a0 ? '' : "\x47\141\x67\141\x6c\40\x6d\145\x6e\171\x69\155\x70\141\x6e\40\x64\141\x74\141"]);
 L_58a77:
 if ($_0x7b21 > 0) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x65\162\x72\157\x72\163" => ["\x75\163\x65\162\x6e\141\x6d\145" => "\x55\163\x65\162\x6e\141\x6d\145\x20\163\x75\144\x61\150\x20\144\x69\147\x75\156\x61\153\x61\156"]]);
 }
 goto L_48022;
 L_a6051:
 $_0x67a0 = $_0x8980->table("\x75\163\x65\162\x73")->where("\x69\144", $_0xba75)->update($_0x85e7);
 goto L_3d0d2;
 L_063eb:
 $_0xb14e = $this->request->getPost("\x75\163\x65\162\x6e\141\x6d\145");
 goto L_78fb7;
 L_a2891:
 $_0x8980 = \Config\Database::connect();
 goto L_19d85;
 L_69af6:
 $_0xe888 = $this->request->getPost("\x6e\145\x77");
 goto L_a2891;
 L_48022:
 $_0x85e7 = ["\x75\163\x65\162\x6e\141\x6d\145" => $_0xb14e, "\x70\141\x73\163\x77\157\x72\144" => password_hash($_0xe888, PASSWORD_BCRYPT)];
 goto L_a6051;
 }
 public function delete($_0x1c57)
 {
 goto L_f8a17;
 L_52b53:
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => true]);
 L_f8a17:
 $_0xb6ab = \Config\Database::connect();
 goto L_29ce8;
 L_09256:
 $_0xb6ab->table("\x75\163\x65\162\x73\137\x67\162\x6f\165\x70\163")->where("\x75\163\x65\162\x5f\151\x64", $_0x1c57)->delete();
 goto L_52b53;
 L_29ce8:
 $_0xb6ab->table("\x75\163\x65\162\x73")->where("\x69\144", $_0x1c57)->delete();
 goto L_09256;
 }
 public function uploadFile($_0xf4ee)
 {
 goto L_a7268;
 L_22677:
 if ($_0x69d1 && $_0x69d1->isValid() && !$_0x69d1->hasMoved()) {
 $_0xdb7d = "\x66\157\x74\157\x5f" . $_0xf4ee . "\x2e" . $_0x69d1->getExtension();
 $_0xca15 = FCPATH . "\x75\160\x6c\157\x61\144\x73\57\x70\162\x6f\146\x69\154\x65\163\x2f";
 if (file_exists($_0xca15 . $_0xdb7d)) {
 unlink($_0xca15 . $_0xdb7d);
 }
 if ($_0x69d1->move($_0xca15, $_0xdb7d)) {
 $_0x8585 = "\x75\160\x6c\157\x61\144\x73\57\x70\162\x6f\146\x69\154\x65\163\x2f" . $_0xdb7d;
 $_0x5fc8 = \Config\Database::connect();
 $_0xa132 = $_0x5fc8->table("\x75\163\x65\162\x73")->where("\x69\144", $_0xf4ee)->get()->getRow();
 if ($_0xa132) {
 $_0x5fc8->table("\x75\163\x65\162\x73")->where("\x69\144", $_0xf4ee)->update(["\x66\157\x74\157" => $_0x8585]);
 } else {
 $_0x5fc8->table("\x75\163\x65\162\x73")->insert(["\x69\144" => $_0xf4ee, "\x66\157\x74\157" => $_0x8585]);
 }
 $_0x2d3a["\x73\162\x63"] = base_url() . $_0x8585;
 $_0x2d3a["\x66\151\x6c\145\x6e\141\x6d\145"] = "\x66\157\x74\157\x5f" . $_0xf4ee;
 $_0x2d3a["\x73\164\x61\164\x75\163"] = true;
 $_0x2d3a["\x74\171\x70\145"] = $_0x69d1->getClientMimeType();
 $_0x2d3a["\x73\151\x7a\145"] = $_0x69d1->getSize();
 } else {
 $_0x2d3a["\x73\162\x63"] = $_0x69d1->getErrorString();
 }
 }
 goto L_2ea36;
 L_a6322:
 $_0x2d3a = ["\x73\164\x61\164\x75\163" => false, "\x73\162\x63" => ''];
 goto L_22677;
 L_2ea36:
 return $this->response->setJSON($_0x2d3a);
 L_a7268:
 $_0x69d1 = $this->request->getFile("\x66\157\x74\157");
 goto L_a6322;
 }
 public function deleteFile()
 {
 goto L_7b1f9;
 L_3acd2:
 return $this->response->setBody("\x46\151\x6c\145\x20\116\x6f\164\x20\106\x6f\165\x6e\144");
 L_2684d:
 $_0xa364 = FCPATH . ltrim($_0xf281, "\x2f");
 goto L_5c6b5;
 L_7b1f9:
 $_0x9bf3 = $this->request->getPost("\x73\162\x63");
 goto L_0a2bf;
 L_0a2bf:
 $_0x5271 = rtrim(base_url(), "\x2f") . "\x2f";
 goto L_8d2b5;
 L_5c6b5:
 if (file_exists($_0xa364) && unlink($_0xa364)) {
 return $this->response->setBody("\x46\151\x6c\145\x20\104\x65\154\x65\164\x65\40\x53\165\x63\143\x65\163\x73\146\x75\154\x6c\171");
 }
 goto L_3acd2;
 L_8d2b5:
 $_0xf281 = str_replace($_0x5271, '', $_0x9bf3 ?? '');
 goto L_2684d;
 }
 public function saveProfile()
 {
 goto L_748bf;
 L_f4fb4:
 $_0xdfda = \Config\Database::connect();
 goto L_bfb32;
 L_1f3fc:
 $_0xad22 = $this->request->getPost("\x6a\141\x62\141\x74\141\x6e");
 goto L_b66d2;
 L_bfb32:
 $_0x46fd = $_0xdfda->table("\x75\163\x65\162\x73")->where("\x69\144", $_0x8553->get("\x75\163\x65\162\x5f\151\x64"))->update($_0xdc8d);
 goto L_714e7;
 L_714e7:
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => (bool) $_0x46fd]);
 L_b66d2:
 $_0x796b = $this->request->getPost("\x66\157\x74\157");
 goto L_2cc59;
 L_32138:
 $_0xdc8d = ["\x66\151\x72\163\x74\137\x6e\141\x6d\145" => $_0xaf50, "\x6a\141\x62\141\x74\141\x6e" => $_0xad22, "\x66\157\x74\157" => str_replace($_0x9752, '', $_0x796b ?? '')];
 goto L_f4fb4;
 L_98a2c:
 $_0x8553 = session();
 goto L_32138;
 L_2cc59:
 $_0x9752 = rtrim(base_url(), "\x2f") . "\x2f";
 goto L_98a2c;
 L_748bf:
 $_0xaf50 = $this->request->getPost("\x6e\141\x6d\141\x5f\154\x65\156\x67\153\x61\160");
 goto L_1f3fc;
 }
 public function profile()
 {
 goto L_5be42;
 L_5be42:
 $_0xde14 = session();
 goto L_91360;
 L_0f255:
 if ($_0x1e2f === "\x32") {
 return redirect()->to("\x67\165\x72\165\x2f\160\x72\157\x66\151\x6c\145");
 } elseif ($_0x1e2f === "\x33") {
 return redirect()->to("\x73\151\x73\167\x61");
 }
 goto L_9f466;
 L_91360:
 if (!$_0xde14->get("\x69\163\x5f\154\x6f\147\x69\156")) {
 return redirect()->to("\x61\165\x74\150\x2f\154\x6f\147\x69\156");
 }
 goto L_5579c;
 L_387be:
 $_0x1e2f = (string) ($_0xde14->get("\x72\157\x6c\145") ?? '');
 goto L_0f255;
 L_5579c:
 $_0xcf69 = $_0xde14->get("\x75\163\x65\162\x5f\151\x64");
 goto L_2bf0f;
 L_9f466:
 return $this->edit($_0xcf69);
 L_2bf0f:
 if (!$_0xcf69) {
 return redirect()->to("\x64\141\x73\150\x62\157\x61\162\x64");
 }
 goto L_387be;
 }
 public function gantipassword()
 {
 goto L_dbdc7;
 L_02c57:
 $_0x4c6b = $_0x1af9->table("\x75\163\x65\162\x73")->where("\x69\144", $_0x5660)->get()->getRow();
 goto L_dc858;
 L_11ea2:
 return view("\x75\163\x65\162\x73\57\x61\144\x6d\151\x6e\57\x67\141\x6e\164\x69\160\x61\163\x73\167\x6f\162\x64", $_0x680b);
 L_5cac6:
 $_0x1af9 = \Config\Database::connect();
 goto L_02c57;
 L_dc858:
 if (!$_0x4c6b) {
 return redirect()->to("\x64\141\x73\150\x62\157\x61\162\x64");
 }
 goto L_9edbf;
 L_289f8:
 if (!$_0x49c6->get("\x69\163\x5f\154\x6f\147\x69\156")) {
 return redirect()->to("\x61\165\x74\150\x2f\154\x6f\147\x69\156");
 }
 goto L_7a454;
 L_9edbf:
 $_0x680b = ["\x75\163\x65\162" => (object) ["\x69\144" => $_0x49c6->get("\x75\163\x65\162\x5f\151\x64"), "\x66\151\x72\163\x74\137\x6e\141\x6d\145" => $_0x49c6->get("\x75\163\x65\162\x6e\141\x6d\145"), "\x72\157\x6c\145\x5f\156\x61\155\x65" => $_0x49c6->get("\x72\157\x6c\145\x5f\156\x61\155\x65"), "\x66\157\x74\157" => $_0x49c6->get("\x66\157\x74\157") ?? ''], "\x75\163\x65\162\x73" => $_0x4c6b, "\x69\163\x5f\141\x64\155\x69\156" => $_0x49c6->get("\x72\157\x6c\145") == "\x31", "\x6a\165\x64\165\x6c" => "\x47\141\x6e\164\x69\40\x50\141\x73\163\x77\157\x72\144", "\x73\165\x62\152\x75\144\x75\154" => "\x55\142\x61\150\x20\120\x61\163\x73\167\x6f\162\x64\40\x41\153\x75\156", "\x73\145\x74\164\x69\156\x67" => $this->dashboardModel->getSetting(), "\x74\160" => $this->dashboardModel->getTahun(), "\x74\160\x5f\141\x63\164\x69\166\x65" => $this->dashboardModel->getTahunActive(), "\x73\155\x74" => $this->dashboardModel->getSemester(), "\x73\155\x74\137\x61\143\x74\151\x76\145" => $this->dashboardModel->getSemesterActive()];
 goto L_11ea2;
 L_dbdc7:
 $_0x49c6 = session();
 goto L_289f8;
 L_7a454:
 $_0x5660 = $_0x49c6->get("\x75\163\x65\162\x5f\151\x64");
 goto L_5cac6;
 }
}