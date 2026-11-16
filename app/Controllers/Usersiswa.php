<?php
/*   ________________________________________
    |               NextGen Garuda CBT       |
    |    Protected & Distributed via GitHub  |
    |________________________________________|
*/
namespace App\Controllers;

use App\Models\DashboardModel;
use App\Models\UsersModel;
class Usersiswa extends BaseController
{
 protected $dashboardModel;
 protected $usersModel;
 public function __construct()
 {
 $this->dashboardModel = new DashboardModel();
 $this->usersModel = new UsersModel();
 }
 public function index()
 {
 goto L_5b1f5;
 L_3c0eb:
 return view("\x75\163\x65\162\x73\57\x73\151\x73\167\x61\57\x64\141\x74\141", $_0x3047);
 L_5b1f5:
 $_0x3ec9 = session();
 goto L_da6b6;
 L_da6b6:
 if (!$_0x3ec9->get("\x69\163\x5f\154\x6f\147\x69\156")) {
 return redirect()->to("\x61\165\x74\150\x2f\154\x6f\147\x69\156");
 }
 goto L_5ad64;
 L_a868a:
 $_0x3047 = ["\x75\163\x65\162" => ["\x69\144" => $_0x3ec9->get("\x75\163\x65\162\x5f\151\x64"), "\x66\151\x72\163\x74\137\x6e\141\x6d\145" => $_0x3ec9->get("\x75\163\x65\162\x6e\141\x6d\145"), "\x72\157\x6c\145\x5f\156\x61\155\x65" => $_0x3ec9->get("\x72\157\x6c\145\x5f\156\x61\155\x65"), "\x66\157\x74\157" => $_0x3ec9->get("\x66\157\x74\157") ?? ''], "\x6a\165\x64\165\x6c" => "\x55\163\x65\162\x20\115\x61\156\x61\147\x65\155\x65\156\x74", "\x73\165\x62\152\x75\144\x75\154" => "\x44\141\x74\141\x20\125\x73\145\x72\40\x53\151\x73\167\x61", "\x73\145\x74\164\x69\156\x67" => $this->dashboardModel->getSetting(), "\x74\160" => $this->dashboardModel->getTahun(), "\x74\160\x5f\141\x63\164\x69\166\x65" => $this->dashboardModel->getTahunActive(), "\x73\155\x74" => $this->dashboardModel->getSemester(), "\x73\155\x74\137\x61\143\x74\151\x76\145" => $this->dashboardModel->getSemesterActive()];
 goto L_3c0eb;
 L_5ad64:
 if (!in_array((string) $_0x3ec9->get("\x72\157\x6c\145"), ["\x31", "\x34"])) {
 return redirect()->to("\x64\141\x73\150\x62\157\x61\162\x64")->with("\x65\162\x72\157\x72", "\x48\141\x6e\171\x61\40\x41\144\x6d\151\x6e\151\x73\164\x72\141\x74\157\x72");
 }
 goto L_a868a;
 }
 public function list()
 {
 goto L_7a59c;
 L_12cc3:
 $_0x7edc = $this->usersModel->getUserSiswaPage($_0x131b->id_tp, $_0xfe73->id_smt, $_0xd0c0, $_0x786c, $_0x3400);
 goto L_b645e;
 L_6f271:
 $_0x131b = $this->dashboardModel->getTahunActive();
 goto L_b97c8;
 L_9a253:
 $_0xd0c0 = ($_0xe37e - 1) * $_0x786c;
 goto L_6f271;
 L_d16c2:
 $_0x164b = $this->usersModel->getUserSiswaTotalPage($_0x3400);
 goto L_12cc3;
 L_f8dcb:
 $_0x786c = $this->request->getPost("\x6c\151\x6d\151\x74") ?: 10;
 goto L_0e01c;
 L_f37f1:
 foreach ($_0x7edc as $_0x23ca) {
 $_0xb00f = FCPATH . ltrim($_0x23ca->foto ?? '', "\x2f");
 $_0x23ca->foto = $_0x23ca->foto != null && $_0x23ca->foto != '' && file_exists($_0xb00f) ? $_0x411a . ltrim($_0x23ca->foto, "\x2f") : $_0x411a . "\x61\163\x73\145\x74\163\x2f\151\x6d\147\x2f\163\x69\163\x77\141\x5f\163\x6d\56\x70\156\x67";
 }
 goto L_5c120;
 L_b645e:
 $_0x411a = rtrim(base_url(), "\x2f") . "\x2f";
 goto L_f37f1;
 L_b97c8:
 $_0xfe73 = $this->dashboardModel->getSemesterActive();
 goto L_d16c2;
 L_5c120:
 return $this->response->setJSON(["\x6c\151\x73\164\x73" => $_0x7edc, "\x74\157\x74\141\x6c" => $_0x164b, "\x70\141\x67\145\x73" => ceil($_0x164b / $_0x786c), "\x73\145\x61\162\x63\150" => $_0x3400, "\x70\145\x72\160\x61\147\x65" => $_0x786c]);
 L_7a59c:
 $_0xe37e = $this->request->getPost("\x70\141\x67\145") ?: 1;
 goto L_f8dcb;
 L_0e01c:
 $_0x3400 = $this->request->getPost("\x73\145\x61\162\x63\150");
 goto L_9a253;
 }
 public function activate()
 {
 goto L_ed1bc;
 L_306ac:
 if ($_0x6b99) {
 $_0x3eca = $_0xccb1->table("\x75\163\x65\162\x73")->where("\x69\144", $_0x6b99->id)->update(["\x61\143\x74\151\x76\145" => $_0xca4d]);
 } else if ($_0xa03b == "\x61\153\x74\151\x66\153\x61\156") {
 $_0xe0ce = explode("\x20", $_0xe2b5->nama ?? '');
 $_0x57d2 = $_0xe0ce[0];
 $_0x55d5 = end($_0xe0ce);
 $_0xcfc8 = ["\x75\163\x65\162\x6e\141\x6d\145" => trim($_0xe2b5->username ?? ''), "\x70\141\x73\163\x77\157\x72\144" => password_hash(trim($_0xe2b5->password ?? ''), PASSWORD_BCRYPT), "\x66\151\x72\163\x74\137\x6e\141\x6d\145" => $_0x57d2, "\x6c\141\x73\164\x5f\156\x61\155\x65" => $_0x55d5, "\x63\162\x65\141\x74\145\x64\137\x6f\156" => time(), "\x61\143\x74\151\x76\145" => 1];
 $_0xccb1->table("\x75\163\x65\162\x73")->insert($_0xcfc8);
 $_0xde39 = $_0xccb1->insertID();
 $_0xccb1->table("\x75\163\x65\162\x73\137\x67\162\x6f\165\x70\163")->insert(["\x75\163\x65\162\x5f\151\x64" => $_0xde39, "\x67\162\x6f\165\x70\137\x69\144" => "\x33"]);
 $_0x3eca = true;
 }
 goto L_0b320;
 L_d9636:
 $_0xccb1 = \Config\Database::connect();
 goto L_826ea;
 L_ed1bc:
 $_0xe7f2 = $this->request->getPost("\x69\144\x5f\163\x69\163\x77\141");
 goto L_38c54;
 L_0b320:
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => $_0x3eca, "\x6d\163\x67" => $_0x3eca ? "\x53\151\x73\167\x61\40" . $_0xbb56 . $_0x5801 : "\x53\151\x73\167\x61\40" . $_0xbb56 . "\x20\147\x61\147\x61\154" . $_0x5801]);
 L_1f249:
 $_0x3eca = false;
 goto L_7369d;
 L_cf6fc:
 $_0x5801 = $_0xa03b == "\x61\153\x74\151\x66\153\x61\156" ? "\x20\144\x69\141\x6b\164\x69\146\x6b\141\x6e" : "\x20\144\x69\156\x6f\156\x61\153\x74\151\x66\153\x61\156";
 goto L_520d4;
 L_7369d:
 $_0x6b99 = $_0xccb1->table("\x75\163\x65\162\x73")->where("\x75\163\x65\162\x6e\141\x6d\145", $_0xe2b5->username)->get()->getRow();
 goto L_306ac;
 L_abac2:
 $_0xbb56 = $this->request->getPost("\x6e\141\x6d\141");
 goto L_cf6fc;
 L_c412e:
 $_0xca4d = $_0xa03b == "\x61\153\x74\151\x66\153\x61\156" ? 1 : 0;
 goto L_1f249;
 L_520d4:
 $_0xe232 = $this->usersModel->getDuplicateUsernames("\x6d\141\x73\164\x65\162\x5f\163\x69\163\x77\141");
 goto L_528d3;
 L_38c54:
 $_0xa03b = $this->request->getPost("\x69\163\x5f\141\x63\164\x69\166\x65");
 goto L_abac2;
 L_528d3:
 if (!empty($_0xe232)) {
 $_0xf11d = '';
 foreach ($_0xe232 as $_0xcf37) {
 $_0xf11d .= "<br>Username: {$_0xcf37->username} duplikat {$_0xcf37->total} kali<br>";
 }
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\163\x67" => "\x54\145\x72\144\x61\160\x61\164\x20\165\x73\145\x72\156\x61\155\x65\40\x64\165\x70\154\x69\153\x61\164\x2c\40\x73\151\x6c\141\x68\153\x61\156\x20\147\x61\156\x74\151\x20\165\x73\145\x72\156\x61\155\x65\40\x74\145\x72\154\x65\142\x69\150\x20\144\x61\150\x75\154\x75\41" . $_0xf11d]);
 }
 goto L_d9636;
 L_826ea:
 $_0xe2b5 = $this->usersModel->getDataSiswa($_0xe7f2);
 goto L_c412e;
 }
 public function aktifkanSemua()
 {
 goto L_47cd5;
 L_9fad2:
 $_0xc69c = $this->request->getPost("\x69\163\x5f\141\x63\164\x69\166\x65");
 goto L_37789;
 L_47cd5:
 $_0x124a = $this->usersModel->getDuplicateUsernames("\x6d\141\x73\164\x65\162\x5f\163\x69\163\x77\141");
 goto L_d2d2a;
 L_07540:
 $_0x4677 = $_0xc69c == "\x61\153\x74\151\x66\153\x61\156" ? "\x20\163\x69\163\x77\141\x20\144\x69\141\x6b\164\x69\146\x6b\141\x6e\56" : "\x20\163\x69\163\x77\141\x20\144\x69\156\x6f\156\x61\153\x74\151\x66\153\x61\156\x2e";
 goto L_3752a;
 L_1fe8e:
 if ($_0xa373 === 1) {
 $_0xd225 = $_0xfe87->table("\x6d\141\x73\164\x65\162\x5f\163\x69\163\x77\141\x20\141")->select("\x61\56\x69\144\x5f\163\x69\163\x77\141\x2c\40\x61\56\x6e\141\x6d\141\x2c\40\x61\56\x75\163\x65\162\x6e\141\x6d\145\x2c\40\x61\56\x70\141\x73\163\x77\157\x72\144")->join("\x75\163\x65\162\x73\40\x63", "\x61\56\x75\163\x65\162\x6e\141\x6d\145\x3d\143\x2e\165\x73\145\x72\156\x61\155\x65", "\x6c\145\x66\164")->where("\x63\56\x69\144\x20\111\x53\40\x4e\125\x4c\114")->get()->getResult();
 foreach ($_0xd225 as $_0x403c) {
 $_0xac85 = explode("\x20", $_0x403c->nama ?? '');
 $_0x4012 = $_0xac85[0];
 $_0x4215 = count($_0xac85) > 1 ? end($_0xac85) : '';
 $_0x779c = ["\x75\163\x65\162\x6e\141\x6d\145" => trim($_0x403c->username ?? ''), "\x70\141\x73\163\x77\157\x72\144" => password_hash(trim($_0x403c->password ?? ''), PASSWORD_BCRYPT), "\x66\151\x72\163\x74\137\x6e\141\x6d\145" => $_0x4012, "\x6c\141\x73\164\x5f\156\x61\155\x65" => $_0x4215, "\x63\162\x65\141\x74\145\x64\137\x6f\156" => time(), "\x61\143\x74\151\x76\145" => 1];
 $_0xfe87->table("\x75\163\x65\162\x73")->insert($_0x779c);
 $_0x666d = $_0xfe87->insertID();
 $_0xfe87->table("\x75\163\x65\162\x73\137\x67\162\x6f\165\x70\163")->insert(["\x75\163\x65\162\x5f\151\x64" => $_0x666d, "\x67\162\x6f\165\x70\137\x69\144" => "\x33"]);
 }
 }
 goto L_70b79;
 L_70b79:
 $_0xfe87->table("\x75\163\x65\162\x73")->whereIn("\x69\144", function ($_0x1882) {
 return $_0x1882->select("\x75\163\x65\162\x5f\151\x64")->from("\x75\163\x65\162\x73\137\x67\162\x6f\165\x70\163")->where("\x67\162\x6f\165\x70\137\x69\144", "\x33");
 })->update(["\x61\143\x74\151\x76\145" => $_0xa373]);
 goto L_07540;
 L_d2d2a:
 if (!empty($_0x124a)) {
 $_0x4677 = '';
 foreach ($_0x124a as $_0x79b8) {
 $_0x4677 .= "<br>Username: {$_0x79b8->username} duplikat {$_0x79b8->total} kali<br>";
 }
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\163\x67" => "\x54\145\x72\144\x61\160\x61\164\x20\165\x73\145\x72\156\x61\155\x65\40\x64\165\x70\154\x69\153\x61\164\x2c\40\x73\151\x6c\141\x68\153\x61\156\x20\147\x61\156\x74\151\x20\165\x73\145\x72\156\x61\155\x65\40\x74\145\x72\154\x65\142\x69\150\x20\144\x61\150\x75\154\x75\41" . $_0x4677]);
 }
 goto L_9fad2;
 L_ce7b3:
 $_0xa373 = $_0xc69c == "\x61\153\x74\151\x66\153\x61\156" ? 1 : 0;
 goto L_1fe8e;
 L_3752a:
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => true, "\x6a\165\x6d\154\x61\150" => 1, "\x6d\163\x67" => "\x53\145\x6d\165\x61" . $_0x4677]);
 L_37789:
 $_0xfe87 = \Config\Database::connect();
 goto L_ce7b3;
 }
 public function reset_login()
 {
 goto L_4f40f;
 L_d60c5:
 $_0x9a0b = $this->request->getPost("\x6e\141\x6d\141");
 goto L_97e06;
 L_4ef26:
 $_0xb1c6 = \Config\Database::connect();
 goto L_be078;
 L_4f40f:
 $_0x6706 = $this->request->getPost("\x75\163\x65\162\x6e\141\x6d\145");
 goto L_d60c5;
 L_be078:
 if ($_0xb1c6->table("\x6c\157\x67\151\x6e\137\x61\164\x74\145\x6d\160\x74\163")->where("\x6c\157\x67\151\x6e", $_0x6706)->delete()) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => true, "\x6d\163\x67" => "\x55\163\x65\162\x20" . $_0x9a0b . "\x20\142\x65\162\x68\141\x73\151\x6c\40\x64\151\x72\145\x73\145\x74"]);
 }
 goto L_6ef0f;
 L_6ef0f:
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\163\x67" => "\x55\163\x65\162\x20" . $_0x9a0b . "\x20\147\x61\147\x61\154\x20\144\x69\162\x65\163\x65\164"]);
 L_97e06:
 $_0x9c48 = session();
 goto L_8c5c5;
 L_8c5c5:
 if (!$_0x9c48->get("\x69\163\x5f\154\x6f\147\x69\156") || !in_array((string) $_0x9c48->get("\x72\157\x6c\145"), ["\x31", "\x34"])) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\163\x67" => "\x59\157\x75\40\x6d\165\x73\164\x20\142\x65\40\x61\156\x20\141\x64\155\x69\156\x69\163\x74\162\x61\164\x6f\162\x20\164\x6f\40\x76\151\x65\167\x20\164\x68\151\x73\40\x70\141\x67\145\x2e"]);
 }
 goto L_4ef26;
 }
 public function data()
 {
 goto L_66fee;
 L_7151a:
 return $this->response->setJSON($this->usersModel->getUserSiswa($_0x5587->id_tp, $_0x3a44->id_smt));
 L_66fee:
 $_0x5587 = $this->dashboardModel->getTahunActive();
 goto L_f015a;
 L_f015a:
 $_0x3a44 = $this->dashboardModel->getSemesterActive();
 goto L_7151a;
 }
}