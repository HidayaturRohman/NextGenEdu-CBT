<?php
/*   ________________________________________
    |               NextGen Garuda CBT       |
    |    Protected & Distributed via GitHub  |
    |________________________________________|
*/
namespace App\Controllers;

use App\Models\DashboardModel;
use App\Models\UsersModel;
use App\Models\MasterModel;
use App\Models\DropdownModel;
class Userguru extends BaseController
{
 protected $dashboardModel;
 protected $usersModel;
 protected $masterModel;
 public function __construct()
 {
 goto L_6b5d2;
 L_5c4d0:
 $this->usersModel = new UsersModel();
 goto L_14667;
 L_14667:
 $this->masterModel = new MasterModel();
 L_6b5d2:
 $this->dashboardModel = new DashboardModel();
 goto L_5c4d0;
 }
 public function data()
 {
 goto L_bc494;
 L_58d69:
 return $this->response->setJSON($_0x3047);
 L_b264b:
 $_0x8e19 = $this->dashboardModel->getSemesterActive();
 goto L_9cce1;
 L_9cce1:
 $_0x3047 = $this->usersModel->getUserGuru($_0x641c->id_tp, $_0x8e19->id_smt);
 goto L_58d69;
 L_bc494:
 $_0x641c = $this->dashboardModel->getTahunActive();
 goto L_b264b;
 }
 public function index()
 {
 goto L_ab516;
 L_8b9ff:
 return view("\x75\163\x65\162\x73\57\x67\165\x72\165\x2f\144\x61\164\x61", $_0xa94e);
 L_30147:
 if (!in_array((string) $_0x4ea3->get("\x72\157\x6c\145"), ["\x31", "\x34"])) {
 return redirect()->to("\x64\141\x73\150\x62\157\x61\162\x64")->with("\x65\162\x72\157\x72", "\x48\141\x6e\171\x61\40\x41\144\x6d\151\x6e\151\x73\164\x72\141\x74\157\x72");
 }
 goto L_dce1b;
 L_ab516:
 $_0x4ea3 = session();
 goto L_9e770;
 L_9e770:
 if (!$_0x4ea3->get("\x69\163\x5f\154\x6f\147\x69\156")) {
 return redirect()->to("\x61\165\x74\150\x2f\154\x6f\147\x69\156");
 }
 goto L_30147;
 L_dce1b:
 $_0xa94e = ["\x75\163\x65\162" => ["\x69\144" => $_0x4ea3->get("\x75\163\x65\162\x5f\151\x64"), "\x66\151\x72\163\x74\137\x6e\141\x6d\145" => $_0x4ea3->get("\x75\163\x65\162\x6e\141\x6d\145"), "\x72\157\x6c\145\x5f\156\x61\155\x65" => $_0x4ea3->get("\x72\157\x6c\145\x5f\156\x61\155\x65"), "\x66\157\x74\157" => $_0x4ea3->get("\x66\157\x74\157") ?? ''], "\x6a\165\x64\165\x6c" => "\x55\163\x65\162\x20\115\x61\156\x61\147\x65\155\x65\156\x74", "\x73\165\x62\152\x75\144\x75\154" => "\x44\141\x74\141\x20\125\x73\145\x72\40\x47\165\x72\165", "\x73\145\x74\164\x69\156\x67" => $this->dashboardModel->getSetting(), "\x74\160" => $this->dashboardModel->getTahun(), "\x74\160\x5f\141\x63\164\x69\166\x65" => $this->dashboardModel->getTahunActive(), "\x73\155\x74" => $this->dashboardModel->getSemester(), "\x73\155\x74\137\x61\143\x74\151\x76\145" => $this->dashboardModel->getSemesterActive(), "\x67\165\x72\165\x73" => (new DropdownModel())->getAllGuru()];
 goto L_8b9ff;
 }
 public function activate()
 {
 goto L_3f604;
 L_b9330:
 $_0x6d9d = $this->usersModel->getDataGuru($_0xd2a3);
 goto L_c8e8c;
 L_88439:
 $_0xac7b = $this->request->getPost("\x69\144");
 goto L_df2fb;
 L_5279c:
 if (count($_0x37e0) > 1 && $_0x306b == "\x61\153\x74\151\x66\153\x61\156") {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\163\x67" => "\x41\144\x61\40" . count($_0x37e0) . "\x20\165\x73\145\x72\156\x61\155\x65\40\x6d\145\x6e\147\x67\165\x6e\141\x6b\141\x6e\40" . $_0x6d9d->username . "\x2c\40\x73\151\x6c\141\x68\153\x61\156\x20\147\x61\156\x74\151\x20\165\x73\145\x72\156\x61\155\x65", "\x75\163\x65\162\x73" => $_0x37e0]);
 }
 goto L_882e0;
 L_a9e3f:
 $_0x232e = $_0x306b == "\x61\153\x74\151\x66\153\x61\156" ? 1 : 0;
 goto L_b5f0a;
 L_dd84d:
 if (!$_0xac7b && !empty($_0x6d9d->username)) {
 $_0x14b4 = $_0x52d5->table("\x75\163\x65\162\x73")->where("\x75\163\x65\162\x6e\141\x6d\145", trim($_0x6d9d->username))->get()->getRow();
 if ($_0x14b4) {
 $_0xac7b = $_0x14b4->id;
 }
 }
 goto L_1235d;
 L_a5572:
 $_0x346e = $_0x306b == "\x61\153\x74\151\x66\153\x61\156" ? "\x20\144\x69\141\x6b\164\x69\146\x6b\141\x6e" : "\x20\144\x69\156\x6f\156\x61\153\x74\151\x66\153\x61\156";
 goto L_c8e98;
 L_882e0:
 $_0x52d5 = \Config\Database::connect();
 goto L_a9e3f;
 L_b5f0a:
 // Cari user yang sudah ada jika $id_user belum terisi atau kosong
 if (!$_0xac7b && !empty($_0x6d9d->id_user)) {
 $_0xac7b = $_0x6d9d->id_user;
 }
 goto L_dd84d;
 L_3f604:
 $_0xd2a3 = $this->request->getPost("\x69\144\x5f\147\x75\162\x75");
 goto L_88439;
 L_29d68:
 $_0x306b = $this->request->getPost("\x69\163\x5f\141\x63\164\x69\166\x65");
 goto L_b9330;
 L_19dad:
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => $_0x3eca, "\x6d\163\x67" => $_0x3eca ? "\x47\165\x72\165\x20" . $_0xf5e8 . $_0x346e : "\x47\165\x72\165\x20" . $_0xf5e8 . "\x20\147\x61\147\x61\154" . $_0x346e]);
 L_c8e98:
 if ($_0xac7b) {
 $_0x2291 = $_0x52d5->table("\x75\163\x65\162\x73")->where("\x69\144", $_0xac7b)->update(["\x61\143\x74\151\x76\145" => $_0x232e]);
 $_0x3eca = (bool) $_0x2291;
 if (empty($_0x6d9d->id_user)) {
 $_0x52d5->table("\x6d\141\x73\164\x65\162\x5f\147\x75\162\x75")->where("\x69\144\x5f\147\x75\162\x75", $_0xd2a3)->update(["\x69\144\x5f\165\x73\145\x72" => $_0xac7b]);
 }
 } else if ($_0x306b == "\x61\153\x74\151\x66\153\x61\156") {
 $_0x7e75 = explode("\x20", $_0x6d9d->nama_guru ?? '');
 $_0x7224 = $_0x7e75[0];
 $_0x7023 = end($_0x7e75);
 $_0x21c6 = ["\x75\163\x65\162\x6e\141\x6d\145" => trim($_0x6d9d->username ?? ''), "\x70\141\x73\163\x77\157\x72\144" => password_hash(trim($_0x6d9d->password ?? ''), PASSWORD_BCRYPT), "\x66\151\x72\163\x74\137\x6e\141\x6d\145" => $_0x7224, "\x6c\141\x73\164\x5f\156\x61\155\x65" => $_0x7023, "\x63\162\x65\141\x74\145\x64\137\x6f\156" => time(), "\x61\143\x74\151\x76\145" => 1];
 $_0x52d5->table("\x75\163\x65\162\x73")->insert($_0x21c6);
 $_0x3037 = $_0x52d5->insertID();
 $_0x52d5->table("\x75\163\x65\162\x73\137\x67\162\x6f\165\x70\163")->insert(["\x75\163\x65\162\x5f\151\x64" => $_0x3037, "\x67\162\x6f\165\x70\137\x69\144" => "\x32"]);
 $_0x3eca = $_0x52d5->table("\x6d\141\x73\164\x65\162\x5f\147\x75\162\x75")->where("\x69\144\x5f\147\x75\162\x75", $_0xd2a3)->update(["\x69\144\x5f\165\x73\145\x72" => $_0x3037]);
 } else {
 // Jika akun user memang belum ada di tabel users dan perintahnya nonaktifkan, anggap sukses (karena memang belum aktif)
 $_0x3eca = true;
 }
 goto L_19dad;
 L_1235d:
 $_0x3eca = false;
 goto L_a5572;
 L_df2fb:
 $_0xf5e8 = $this->request->getPost("\x6e\141\x6d\141");
 goto L_29d68;
 L_c8e8c:
 $_0x37e0 = $this->usersModel->usernameCheck($_0x6d9d->username ?? "\x2d", "\x6d\141\x73\164\x65\162\x5f\147\x75\162\x75");
 goto L_5279c;
 }
 public function aktifkanSemua()
 {
 goto L_06cc5;
 L_06cc5:
 $_0x9258 = $this->usersModel->getDuplicateUsernames("\x6d\141\x73\164\x65\162\x5f\147\x75\162\x75");
 goto L_3cd40;
 L_373dc:
 $_0xba68 = $_0x121f == "\x61\153\x74\151\x66\153\x61\156" ? 1 : 0;
 goto L_6d615;
 L_56a5e:
 $_0xe79c->table("\x75\163\x65\162\x73")->whereIn("\x69\144", function ($_0x49b5) {
 return $_0x49b5->select("\x75\163\x65\162\x5f\151\x64")->from("\x75\163\x65\162\x73\137\x67\162\x6f\165\x70\163")->where("\x67\162\x6f\165\x70\137\x69\144", "\x32");
 })->update(["\x61\143\x74\151\x76\145" => $_0xba68]);
 goto L_25af5;
 L_25af5:
 $_0x2f06 = $_0x121f == "\x61\153\x74\151\x66\153\x61\156" ? "\x20\147\x75\162\x75\40\x64\151\x61\153\x74\151\x66\153\x61\156\x2e" : "\x20\147\x75\162\x75\40\x64\151\x6e\157\x6e\141\x6b\164\x69\146\x6b\141\x6e\56";
 goto L_44434;
 L_bcba5:
 $_0xe79c = \Config\Database::connect();
 goto L_373dc;
 L_77727:
 $_0x121f = $this->request->getPost("\x69\163\x5f\141\x63\164\x69\166\x65");
 goto L_bcba5;
 L_44434:
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => true, "\x6a\165\x6d\154\x61\150" => 1, "\x6d\163\x67" => "\x53\145\x6d\165\x61" . $_0x2f06]);
 L_3cd40:
 if (!empty($_0x9258)) {
 $_0x2f06 = '';
 foreach ($_0x9258 as $_0xb830) {
 $_0x2f06 .= "<br>Username: {$_0xb830->username} duplikat {$_0xb830->total} kali<br>";
 }
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\163\x67" => "\x54\145\x72\144\x61\160\x61\164\x20\165\x73\145\x72\156\x61\155\x65\40\x64\165\x70\154\x69\153\x61\164\x2c\40\x73\151\x6c\141\x68\153\x61\156\x20\147\x61\156\x74\151\x20\165\x73\145\x72\156\x61\155\x65\40\x74\145\x72\154\x65\142\x69\150\x20\144\x61\150\x75\154\x75\41" . $_0x2f06]);
 }
 goto L_77727;
 L_6d615:
 if ($_0xba68 === 1) {
 $_0x1b07 = $_0xe79c->table("\x6d\141\x73\164\x65\162\x5f\147\x75\162\x75\40\x61")->select("\x61\56\x69\144\x5f\147\x75\162\x75\54\x20\141\x2e\156\x61\155\x61\137\x67\165\x72\165\x2c\40\x61\56\x75\163\x65\162\x6e\141\x6d\145\x2c\40\x61\56\x70\141\x73\163\x77\157\x72\144")->join("\x75\163\x65\162\x73\40\x63", "\x61\56\x75\163\x65\162\x6e\141\x6d\145\x3d\143\x2e\165\x73\145\x72\156\x61\155\x65", "\x6c\145\x66\164")->where("\x63\56\x69\144\x20\111\x53\40\x4e\125\x4c\114")->get()->getResult();
 foreach ($_0x1b07 as $_0xe233) {
 $_0x45e6 = explode("\x20", $_0xe233->nama_guru ?? '');
 $_0xa0c7 = $_0x45e6[0];
 $_0xa2c0 = count($_0x45e6) > 1 ? end($_0x45e6) : '';
 $_0x3fb0 = ["\x75\163\x65\162\x6e\141\x6d\145" => trim($_0xe233->username ?? ''), "\x70\141\x73\163\x77\157\x72\144" => password_hash(trim($_0xe233->password ?? ''), PASSWORD_BCRYPT), "\x66\151\x72\163\x74\137\x6e\141\x6d\145" => $_0xa0c7, "\x6c\141\x73\164\x5f\156\x61\155\x65" => $_0xa2c0, "\x63\162\x65\141\x74\145\x64\137\x6f\156" => time(), "\x61\143\x74\151\x76\145" => 1];
 $_0xe79c->table("\x75\163\x65\162\x73")->insert($_0x3fb0);
 $_0x2e41 = $_0xe79c->insertID();
 $_0xe79c->table("\x75\163\x65\162\x73\137\x67\162\x6f\165\x70\163")->insert(["\x75\163\x65\162\x5f\151\x64" => $_0x2e41, "\x67\162\x6f\165\x70\137\x69\144" => "\x32"]);
 $_0xe79c->table("\x6d\141\x73\164\x65\162\x5f\147\x75\162\x75")->where("\x69\144\x5f\147\x75\162\x75", $_0xe233->id_guru)->update(["\x69\144\x5f\165\x73\145\x72" => $_0x2e41]);
 }
 }
 goto L_56a5e;
 }
 public function update_iduser()
 {
 goto L_7a950;
 L_ceab4:
 if (!empty($_0x7b84)) {
 $_0x1089->table("\x6d\141\x73\164\x65\162\x5f\147\x75\162\x75")->updateBatch($_0x7b84, "\x69\144\x5f\147\x75\162\x75");
 }
 goto L_232b4;
 L_e8ab5:
 foreach ($_0x252e as $_0xd62c) {
 $_0x7b84[] = ["\x69\144\x5f\147\x75\162\x75" => $_0xd62c->id_guru, "\x69\144\x5f\165\x73\145\x72" => $_0xd62c->id];
 }
 goto L_ceab4;
 L_7a950:
 $_0x1089 = \Config\Database::connect();
 goto L_35f21;
 L_3ab70:
 $_0x7b84 = [];
 goto L_e8ab5;
 L_232b4:
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => true]);
 L_35f21:
 $_0x252e = $_0x1089->table("\x6d\141\x73\164\x65\162\x5f\147\x75\162\x75\40\x61")->select("\x61\56\x69\144\x5f\147\x75\162\x75\54\x20\143\x2e\151\x64")->join("\x75\163\x65\162\x73\40\x63", "\x61\56\x75\163\x65\162\x6e\141\x6d\145\x3d\143\x2e\165\x73\145\x72\156\x61\155\x65", "\x6c\145\x66\164")->get()->getResult();
 goto L_3ab70;
 }
 public function edit($_0x1c57)
 {
 goto L_d375c;
 L_d375c:
 $_0x752b = session();
 goto L_b1421;
 L_7925b:
 if ($_0x752b->get("\x72\157\x6c\145") == "\x31") {
 $_0x2fa2 = \Config\Database::connect();
 $_0xcdef["\x67\162\x6f\165\x70\163"] = $_0x2fa2->table("\x67\162\x6f\165\x70\163")->get()->getResult();
 $_0xcdef["\x6b\145\x6c\141\x73\163"] = $this->usersModel->getKelas($_0x5c31->id_tp, $_0x33f2->id_smt);
 $_0xcdef["\x6d\141\x70\145\x6c\163"] = $this->usersModel->getMapel();
 $_0xcdef["\x6c\145\x76\145\x6c\163"] = $this->usersModel->getLevelGuru();
 }
 goto L_69b62;
 L_4f788:
 $_0x4411 = $this->usersModel->getDetailGuru($_0x1c57);
 goto L_200ea;
 L_ebce9:
 $_0x5c31 = $this->dashboardModel->getTahunActive();
 goto L_081c3;
 L_081c3:
 $_0x33f2 = $this->dashboardModel->getSemesterActive();
 goto L_4f788;
 L_200ea:
 $_0x9ac4 = $this->usersModel->getUsers($_0x4411->username ?? '');
 goto L_6a31f;
 L_69b62:
 return view("\x75\163\x65\162\x73\57\x67\165\x72\165\x2f\145\x64\151\x74", $_0xcdef);
 L_b1421:
 if (!$_0x752b->get("\x69\163\x5f\154\x6f\147\x69\156")) {
 return redirect()->to("\x61\165\x74\150\x2f\154\x6f\147\x69\156");
 }
 goto L_ebce9;
 L_6a31f:
 $_0xcdef = ["\x75\163\x65\162" => ["\x69\144" => $_0x752b->get("\x75\163\x65\162\x5f\151\x64"), "\x66\151\x72\163\x74\137\x6e\141\x6d\145" => $_0x752b->get("\x75\163\x65\162\x6e\141\x6d\145"), "\x72\157\x6c\145\x5f\156\x61\155\x65" => $_0x752b->get("\x72\157\x6c\145\x5f\156\x61\155\x65"), "\x66\157\x74\157" => $_0x752b->get("\x66\157\x74\157") ?? ''], "\x6a\165\x64\165\x6c" => "\x55\163\x65\162\x20\115\x61\156\x61\147\x65\155\x65\156\x74", "\x73\165\x62\152\x75\144\x75\154" => "\x45\144\x69\164\x20\104\x61\164\x61\40\x55\163\x65\162", "\x73\145\x74\164\x69\156\x67" => $this->dashboardModel->getSetting(), "\x75\163\x65\162\x73" => $_0x9ac4, "\x67\165\x72\165" => $_0x4411, "\x74\160" => $this->dashboardModel->getTahun(), "\x74\160\x5f\141\x63\164\x69\166\x65" => $_0x5c31, "\x73\155\x74" => $this->dashboardModel->getSemester(), "\x73\155\x74\137\x61\143\x74\151\x76\145" => $_0x33f2, "\x69\163\x5f\141\x64\155\x69\156" => $_0x752b->get("\x72\157\x6c\145") == "\x31"];
 goto L_7925b;
 }
 public function editLogin()
 {
 goto L_5f6ad;
 L_3e930:
 $_0x819c = trim((string) ($this->request->getPost("\x6e\145\x77") ?? $_POST["\x6e\145\x77"] ?? ''));
 goto L_72559;
 L_8f31d:
 $_0xf7b9 = trim((string) ($this->request->getPost("\x75\163\x65\162\x6e\141\x6d\145") ?? $_POST["\x75\163\x65\162\x6e\141\x6d\145"] ?? ''));
 goto L_3e930;
 L_b7378:
 // Sinkronisasi ke master_guru
 $_0xbd55 = ["\x75\163\x65\162\x6e\141\x6d\145" => $_0xf7b9, "\x69\144\x5f\165\x73\145\x72" => $_0x942e];
 goto L_08349;
 L_4913e:
 if (!empty($_0x5a67->username)) {
 $_0xff5a = $_0xdfda->table("\x75\163\x65\162\x73")->where("\x75\163\x65\162\x6e\141\x6d\145", $_0x5a67->username)->get()->getRow();
 }
 goto L_39aca;
 L_940ef:
 if ($_0xff5a) {
 $_0x9348 = ["\x75\163\x65\162\x6e\141\x6d\145" => $_0xf7b9];
 if (!empty($_0x819c)) {
 $_0x9348["\x70\141\x73\163\x77\157\x72\144"] = password_hash($_0x819c, PASSWORD_BCRYPT);
 }
 $_0xdfda->table("\x75\163\x65\162\x73")->where("\x69\144", $_0xff5a->id)->update($_0x9348);
 $_0x5b8a = $_0xdfda->table("\x75\163\x65\162\x73\137\x67\162\x6f\165\x70\163")->where(["\x75\163\x65\162\x5f\151\x64" => $_0xff5a->id, "\x67\162\x6f\165\x70\137\x69\144" => "\x32"])->get()->getRow();
 if (!$_0x5b8a) {
 $_0xdfda->table("\x75\163\x65\162\x73\137\x67\162\x6f\165\x70\163")->insert(["\x75\163\x65\162\x5f\151\x64" => $_0xff5a->id, "\x67\162\x6f\165\x70\137\x69\144" => "\x32"]);
 }
 $_0x942e = $_0xff5a->id;
 } else {
 // Jika akun belum terdaftar di tabel users, otomatis daftarkan akun baru
 $_0xfadf = explode("\x20", $_0x5a67->nama_guru ?? "\x47\165\x72\165");
 $_0x605c = ["\x75\163\x65\162\x6e\141\x6d\145" => $_0xf7b9, "\x70\141\x73\163\x77\157\x72\144" => password_hash($_0x2900, PASSWORD_BCRYPT), "\x66\151\x72\163\x74\137\x6e\141\x6d\145" => $_0xfadf[0], "\x6c\141\x73\164\x5f\156\x61\155\x65" => count($_0xfadf) > 1 ? end($_0xfadf) : '', "\x65\155\x61\151\x6c" => !empty($_0x5a67->email) ? $_0x5a67->email : $_0xf7b9 . "\x40\143\x62\164\x2e\154\x6f\143\x61\154", "\x63\162\x65\141\x74\145\x64\137\x6f\156" => time(), "\x61\143\x74\151\x76\145" => 1];
 $_0xdfda->table("\x75\163\x65\162\x73")->insert($_0x605c);
 $_0x942e = $_0xdfda->insertID();
 $_0xdfda->table("\x75\163\x65\162\x73\137\x67\162\x6f\165\x70\163")->insert(["\x75\163\x65\162\x5f\151\x64" => $_0x942e, "\x67\162\x6f\165\x70\137\x69\144" => "\x32"]);
 }
 goto L_b7378;
 L_2380f:
 // Cek duplikasi jika username diubah
 if ($_0xf7b9 !== $_0x5a67->username) {
 $_0xff10 = $_0xdfda->table("\x6d\141\x73\164\x65\162\x5f\147\x75\162\x75")->where("\x75\163\x65\162\x6e\141\x6d\145", $_0xf7b9)->where("\x69\144\x5f\147\x75\162\x75\40\x21\75", $_0x36de)->get()->getRow();
 if ($_0xff10) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x74\145\x78\164" => "\x55\163\x65\162\x6e\141\x6d\145\x20\163\x75\144\x61\150\x20\144\x69\147\x75\156\x61\153\x61\156\x20\157\x6c\145\x68\40\x67\165\x72\165\x20\154\x61\151\x6e\56", "\x65\162\x72\157\x72\163" => ["\x75\163\x65\162\x6e\141\x6d\145" => "\x55\163\x65\162\x6e\141\x6d\145\x20\163\x75\144\x61\150\x20\144\x69\147\x75\156\x61\153\x61\156\x20\157\x6c\145\x68\40\x67\165\x72\165\x20\154\x61\151\x6e\56", "\x6f\154\x64" => '', "\x6e\145\x77" => '', "\x6e\145\x77\137\x63\157\x6e\146\x69\162\x6d" => '']]);
 }
 $_0x28fe = $_0xdfda->table("\x75\163\x65\162\x73")->where("\x75\163\x65\162\x6e\141\x6d\145", $_0xf7b9)->get()->getRow();
 if ($_0x28fe && $_0x28fe->id != ($_0x5a67->id_user ?? 0) && $_0x28fe->username !== $_0x5a67->username) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x74\145\x78\164" => "\x55\163\x65\162\x6e\141\x6d\145\x20\163\x75\144\x61\150\x20\144\x69\147\x75\156\x61\153\x61\156\x20\157\x6c\145\x68\40\x61\153\x75\156\x20\154\x61\151\x6e\56", "\x65\162\x72\157\x72\163" => ["\x75\163\x65\162\x6e\141\x6d\145" => "\x55\163\x65\162\x6e\141\x6d\145\x20\163\x75\144\x61\150\x20\144\x69\147\x75\156\x61\153\x61\156\x20\157\x6c\145\x68\40\x61\153\x75\156\x20\154\x61\151\x6e\56", "\x6f\154\x64" => '', "\x6e\145\x77" => '', "\x6e\145\x77\137\x63\157\x6e\146\x69\162\x6d" => '']]);
 }
 }
 goto L_58e83;
 L_246a2:
 // Cari user yang sesuai di tabel users (utamakan cari by username lama guru, lalu by id_user)
 $_0xff5a = null;
 goto L_4913e;
 L_48cd6:
 $_0x942e = null;
 goto L_940ef;
 L_58e83:
 // Validasi password baru jika diisi
 if (!empty($_0x819c)) {
 if (!empty($_0x337c) && $_0x819c !== $_0x337c) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x74\145\x78\164" => "\x4b\157\x6e\146\x69\162\x6d\141\x73\151\x20\160\x61\163\x73\167\x6f\162\x64\40\x62\141\x72\165\x20\164\x69\144\x61\153\x20\143\x6f\143\x6f\153\x2e", "\x65\162\x72\157\x72\163" => ["\x6e\145\x77\137\x63\157\x6e\146\x69\162\x6d" => "\x4b\157\x6e\146\x69\162\x6d\141\x73\151\x20\160\x61\163\x73\167\x6f\162\x64\40\x62\141\x72\165\x20\164\x69\144\x61\153\x20\143\x6f\143\x6f\153\x2e", "\x75\163\x65\162\x6e\141\x6d\145" => '', "\x6f\154\x64" => '', "\x6e\145\x77" => '']]);
 }
 if (strlen($_0x819c) < 4) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x74\145\x78\164" => "\x50\141\x73\163\x77\157\x72\144\x20\142\x61\162\x75\40\x6d\151\x6e\151\x6d\141\x6c\40\x34\40\x6b\141\x72\141\x6b\164\x65\162\x2e", "\x65\162\x72\157\x72\163" => ["\x6e\145\x77" => "\x50\141\x73\163\x77\157\x72\144\x20\142\x61\162\x75\40\x6d\151\x6e\151\x6d\141\x6c\40\x34\40\x6b\141\x72\141\x6b\164\x65\162\x2e", "\x75\163\x65\162\x6e\141\x6d\145" => '', "\x6f\154\x64" => '', "\x6e\145\x77\137\x63\157\x6e\146\x69\162\x6d" => '']]);
 }
 }
 goto L_08cd3;
 L_72559:
 $_0x337c = trim((string) ($this->request->getPost("\x6e\145\x77\137\x63\157\x6e\146\x69\162\x6d") ?? $_POST["\x6e\145\x77\137\x63\157\x6e\146\x69\162\x6d"] ?? ''));
 goto L_7f5d1;
 L_08cd3:
 // Tentukan password yang akan disimpan
 $_0x2900 = !empty($_0x819c) ? $_0x819c : $_0x5a67->password ?? "\x31\62\x33\64\x35\66";
 goto L_246a2;
 L_39aca:
 if (!$_0xff5a && !empty($_0x5a67->id_user)) {
 $_0xff5a = $_0xdfda->table("\x75\163\x65\162\x73")->where("\x69\144", $_0x5a67->id_user)->get()->getRow();
 }
 goto L_48cd6;
 L_bcfe4:
 $_0x3dbf = $_0xdfda->table("\x6d\141\x73\164\x65\162\x5f\147\x75\162\x75")->where("\x69\144\x5f\147\x75\162\x75", $_0x36de)->update($_0xbd55);
 goto L_faed1;
 L_7f5d1:
 if ($_0x36de <= 0) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x74\145\x78\164" => "\x49\104\x20\107\x75\162\x75\40\x74\151\x64\141\x6b\40\x76\141\x6c\151\x64\56", "\x65\162\x72\157\x72\163" => ["\x75\163\x65\162\x6e\141\x6d\145" => "\x49\104\x20\107\x75\162\x75\40\x74\151\x64\141\x6b\40\x76\141\x6c\151\x64\56", "\x6f\154\x64" => '', "\x6e\145\x77" => '', "\x6e\145\x77\137\x63\157\x6e\146\x69\162\x6d" => '']]);
 }
 goto L_78266;
 L_faed1:
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => (bool) $_0x3dbf, "\x74\145\x78\164" => $_0x3dbf ? "\x42\145\x72\150\x61\163\x69\154\x20\155\x65\156\x67\147\x61\156\x74\151\x20\165\x73\145\x72\156\x61\155\x65\57\x70\141\x73\163\x77\157\x72\144\x2e" : "\x47\141\x67\141\x6c\40\x6d\145\x6e\147\x67\141\x6e\164\x69\40\x75\163\x65\162\x6e\141\x6d\145\x2f\160\x61\163\x73\167\x6f\162\x64\56", "\x65\162\x72\157\x72\163" => ["\x75\163\x65\162\x6e\141\x6d\145" => '', "\x6f\154\x64" => '', "\x6e\145\x77" => '', "\x6e\145\x77\137\x63\157\x6e\146\x69\162\x6d" => '']]);
 L_08349:
 if (!empty($_0x819c)) {
 $_0xbd55["\x70\141\x73\163\x77\157\x72\144"] = $_0x819c;
 }
 goto L_bcfe4;
 L_ead15:
 if (empty($_0xf7b9)) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x74\145\x78\164" => "\x55\163\x65\162\x6e\141\x6d\145\x20\164\x69\144\x61\153\x20\142\x6f\154\x65\150\x20\153\x6f\163\x6f\156\x67\56", "\x65\162\x72\157\x72\163" => ["\x75\163\x65\162\x6e\141\x6d\145" => "\x55\163\x65\162\x6e\141\x6d\145\x20\167\x61\152\x69\142\x20\144\x69\151\x73\151\x2e", "\x6f\154\x64" => '', "\x6e\145\x77" => '', "\x6e\145\x77\137\x63\157\x6e\146\x69\162\x6d" => '']]);
 }
 goto L_2380f;
 L_5f6ad:
 $_0x36de = (int) ($this->request->getPost("\x69\144\x5f\147\x75\162\x75") ?? $_POST["\x69\144\x5f\147\x75\162\x75"] ?? 0);
 goto L_8f31d;
 L_37515:
 $_0x5a67 = $_0xdfda->table("\x6d\141\x73\164\x65\162\x5f\147\x75\162\x75")->where("\x69\144\x5f\147\x75\162\x75", $_0x36de)->get()->getRow();
 goto L_3c24d;
 L_78266:
 $_0xdfda = \Config\Database::connect();
 goto L_37515;
 L_3c24d:
 if (!$_0x5a67) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x74\145\x78\164" => "\x44\141\x74\141\x20\147\x75\162\x75\40\x74\151\x64\141\x6b\40\x64\151\x74\145\x6d\165\x6b\141\x6e\56", "\x65\162\x72\157\x72\163" => ["\x75\163\x65\162\x6e\141\x6d\145" => "\x44\141\x74\141\x20\147\x75\162\x75\40\x74\151\x64\141\x6b\40\x64\151\x74\145\x6d\165\x6b\141\x6e\56", "\x6f\154\x64" => '', "\x6e\145\x77" => '', "\x6e\145\x77\137\x63\157\x6e\146\x69\162\x6d" => '']]);
 }
 goto L_ead15;
 }
 public function reset_login()
 {
 goto L_81bb7;
 L_9a1b5:
 $_0xdf3a = $this->request->getPost("\x6e\141\x6d\141");
 goto L_db5fe;
 L_db5fe:
 $_0xd979 = session();
 goto L_2c4c7;
 L_ea455:
 $_0x6dfe = \Config\Database::connect();
 goto L_064bb;
 L_81bb7:
 $_0xb288 = $this->request->getPost("\x75\163\x65\162\x6e\141\x6d\145");
 goto L_9a1b5;
 L_2c4c7:
 if (!$_0xd979->get("\x69\163\x5f\154\x6f\147\x69\156") || !in_array((string) $_0xd979->get("\x72\157\x6c\145"), ["\x31", "\x34"])) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\163\x67" => "\x59\157\x75\40\x6d\165\x73\164\x20\142\x65\40\x61\156\x20\141\x64\155\x69\156\x69\163\x74\162\x61\164\x6f\162\x20\164\x6f\40\x76\151\x65\167\x20\164\x68\151\x73\40\x70\141\x67\145\x2e"]);
 }
 goto L_ea455;
 L_b2083:
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\163\x67" => "\x55\163\x65\162\x20" . $_0xdf3a . "\x20\147\x61\147\x61\154\x20\144\x69\162\x65\163\x65\164"]);
 L_064bb:
 if ($_0x6dfe->table("\x6c\157\x67\151\x6e\137\x61\164\x74\145\x6d\160\x74\163")->where("\x6c\157\x67\151\x6e", $_0xb288)->delete()) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => true, "\x6d\163\x67" => "\x55\163\x65\162\x20" . $_0xdf3a . "\x20\142\x65\162\x68\141\x73\151\x6c\40\x64\151\x72\145\x73\145\x74"]);
 }
 goto L_b2083;
 }
}