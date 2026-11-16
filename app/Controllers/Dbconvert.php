<?php
/*   ________________________________________
    |               NextGen Garuda CBT       |
    |    Protected & Distributed via GitHub  |
    |________________________________________|
*/
namespace App\Controllers;

use App\Models\DashboardModel;
class Dbconvert extends BaseController
{
 protected $dashboardModel;
 public function __construct()
 {
 $this->dashboardModel = new DashboardModel();
 }
 public function index()
 {
 goto L_5b7d3;
 L_3ad58:
 $_0x3047["\x74\141\x62\154\x65\163"] = $_0x1623;
 goto L_ca9bb;
 L_9aecc:
 if (!$_0xa7c0->get("\x69\163\x5f\154\x6f\147\x69\156")) {
 return redirect()->to("\x61\165\x74\150\x2f\154\x6f\147\x69\156");
 }
 goto L_7b2ce;
 L_69208:
 $_0x507d = 0;
 goto L_2b278;
 L_7d510:
 // Cek path penyimpanan dan status writable
 $_0xbf3c = FCPATH . "\x75\160\x6c\157\x61\144\x73\57\x62\141\x6e\153\x5f\163\x6f\141\x6c\57";
 goto L_70374;
 L_cc3fd:
 $_0xbc70 = ["\x63\142\x74\137\x73\157\x61\154" => ["\x6c\141\x62\145\x6c" => "\x42\141\x6e\153\x20\123\x6f\141\x6c\40\x28\123\x6f\141\x6c\40\x26\40\x4f\160\x73\151\x20\112\x61\167\x61\142\x61\156\x29", "\x70\153" => "\x69\144\x5f\163\x6f\141\x6c"], "\x63\142\x74\137\x73\151\x73\167\x61" => ["\x6c\141\x62\145\x6c" => "\x52\145\x6b\141\x6d\40\x4a\141\x77\141\x62\141\x6e\40\x53\151\x73\167\x61\40\x73\141\x61\164\x20\125\x6a\151\x61\156", "\x70\153" => "\x69\144\x5f\143\x62\164\x5f\163\x69\163\x77\141"], "\x63\142\x74\137\x72\145\x6b\141\x70\137\x6a\141\x64\167\x61\154" => ["\x6c\141\x62\145\x6c" => "\x52\145\x6b\141\x70\40\x4a\141\x64\167\x61\154\x20\46\x20\101\x72\163\x69\160\x20\123\x6f\141\x6c\40\x55\152\x69\141\x6e", "\x70\153" => "\x69\144\x5f\162\x65\153\x61\160"], "\x63\142\x74\137\x72\145\x6b\141\x70\137\x73\151\x73\167\x61" => ["\x6c\141\x62\145\x6c" => "\x52\145\x6b\141\x70\40\x48\141\x73\151\x6c\40\x26\40\x4a\141\x77\141\x62\141\x6e\40\x53\151\x73\167\x61", "\x70\153" => "\x69\144\x5f\162\x65\153\x61\160\x5f\163\x69\163\x77\141"]];
 goto L_6171a;
 L_5b7d3:
 $_0xa7c0 = session();
 goto L_9aecc;
 L_2b278:
 $_0xeeef = 0;
 goto L_c4816;
 L_2113f:
 $_0x3047["\x74\157\x74\141\x6c\137\x62\141\x73\145\x36\64\x5f\141\x6c\154"] = $_0xeeef;
 goto L_7d510;
 L_70374:
 if (!is_dir($_0xbf3c)) {
 @mkdir($_0xbf3c, 0777, true);
 }
 goto L_804f8;
 L_804f8:
 $_0x3047["\x75\160\x6c\157\x61\144\x5f\144\x69\162"] = "\x75\160\x6c\157\x61\144\x73\57\x62\141\x6e\153\x5f\163\x6f\141\x6c\57";
 goto L_6f21f;
 L_c4816:
 foreach ($_0xbc70 as $_0x650f => $_0x5e44) {
 $_0x585d = 0;
 $_0xb137 = 0;
 try {
 $_0x585d = (int) $_0xcbdc->table($_0x650f)->countAllResults();
 } catch (\Throwable $_0x44d6) {
 }
 if ($_0x585d > 0) {
 $_0xb137 = $this->getBase64Count($_0xcbdc, $_0x650f);
 }
 $_0x1623[$_0x650f] = ["\x6e\141\x6d\145" => $_0x650f, "\x6c\141\x62\145\x6c" => $_0x5e44["\x6c\141\x62\145\x6c"], "\x74\157\x74\141\x6c\137\x72\157\x77\163" => $_0x585d, "\x62\141\x73\145\x36\64\x5f\162\x6f\167\x73" => $_0xb137];
 $_0x507d += $_0x585d;
 $_0xeeef += $_0xb137;
 }
 goto L_3ad58;
 L_ca9bb:
 $_0x3047["\x74\157\x74\141\x6c\137\x72\157\x77\163\x5f\141\x6c\154"] = $_0x507d;
 goto L_2113f;
 L_6f21f:
 $_0x3047["\x69\163\x5f\167\x72\151\x74\141\x62\154\x65"] = is_writable($_0xbf3c);
 goto L_69b03;
 L_7b2ce:
 if ($_0xa7c0->get("\x72\157\x6c\145") != "\x31") {
 return redirect()->to("\x64\141\x73\150\x62\157\x61\162\x64")->with("\x65\162\x72\157\x72", "\x48\141\x6e\171\x61\40\x41\144\x6d\151\x6e\151\x73\164\x72\141\x74\157\x72\40\x79\141\x6e\147\x20\144\x69\142\x65\162\x69\40\x68\141\x6b\40\x75\156\x74\165\x6b\40\x6d\145\x6e\147\x61\153\x73\145\x73\40\x68\141\x6c\141\x6d\141\x6e\40\x69\156\x69");
 }
 goto L_745eb;
 L_69b03:
 return view("\x73\145\x74\164\x69\156\x67\57\x63\157\x6e\166\x65\162\x74\145\x72", $_0x3047);
 L_6171a:
 $_0x1623 = [];
 goto L_69208;
 L_9c306:
 $_0xcbdc = \Config\Database::connect();
 goto L_cc3fd;
 L_745eb:
 $_0x3047 = ["\x75\163\x65\162" => ["\x69\144" => $_0xa7c0->get("\x75\163\x65\162\x5f\151\x64"), "\x66\151\x72\163\x74\137\x6e\141\x6d\145" => $_0xa7c0->get("\x75\163\x65\162\x6e\141\x6d\145"), "\x72\157\x6c\145\x5f\156\x61\155\x65" => $_0xa7c0->get("\x72\157\x6c\145\x5f\156\x61\155\x65"), "\x66\157\x74\157" => $_0xa7c0->get("\x66\157\x74\157") ?? ''], "\x6a\165\x64\165\x6c" => "\x49\155\x61\147\x65\40\x43\157\x6e\166\x65\162\x74\145\x72", "\x73\165\x62\152\x75\144\x75\154" => "\x43\157\x6e\166\x65\162\x74\40\x49\155\x61\147\x65\40\x42\101\x53\105\x5f\66\x34\40\x6b\145\x20\106\x69\154\x65", "\x70\162\x6f\146\x69\154\x65" => null, "\x73\145\x74\164\x69\156\x67" => $this->dashboardModel->getSetting(), "\x74\160" => $this->dashboardModel->getTahun(), "\x74\160\x5f\141\x63\164\x69\166\x65" => $this->dashboardModel->getTahunActive(), "\x73\155\x74" => $this->dashboardModel->getSemester(), "\x73\155\x74\137\x61\143\x74\151\x76\145" => $this->dashboardModel->getSemesterActive()];
 goto L_9c306;
 }
 public function status()
 {
 goto L_5c329;
 L_ae68e:
 $_0x25d2 = \Config\Database::connect();
 goto L_edefc;
 L_5c329:
 $_0x7836 = session();
 goto L_4f370;
 L_4f370:
 if (!$_0x7836->get("\x69\163\x5f\154\x6f\147\x69\156") || $_0x7836->get("\x72\157\x6c\145") != "\x31") {
 return ($this->response ?? response())->setStatusCode(403)->setJSON(["\x73\165\x63\143\x65\163\x73" => false, "\x6d\145\x73\163\x61\147\x65" => "\x55\156\x61\165\x74\150\x6f\162\x69\172\x65\144"]);
 }
 goto L_ae68e;
 L_6200a:
 return ($this->response ?? response())->setJSON(["\x73\165\x63\143\x65\163\x73" => true, "\x74\141\x62\154\x65\163" => $_0x69a9]);
 L_9ff18:
 foreach ($_0x7247 as $_0xaa73) {
 $_0xfc68 = 0;
 $_0x5b6e = 0;
 try {
 $_0xfc68 = (int) $_0x25d2->table($_0xaa73)->countAllResults();
 if ($_0xfc68 > 0) {
 $_0x5b6e = $this->getBase64Count($_0x25d2, $_0xaa73);
 }
 } catch (\Throwable $_0x81f5) {
 }
 $_0x69a9[$_0xaa73] = ["\x74\157\x74\141\x6c" => $_0xfc68, "\x62\141\x73\145\x36\64" => $_0x5b6e];
 }
 goto L_6200a;
 L_245d3:
 $_0x69a9 = [];
 goto L_9ff18;
 L_edefc:
 $_0x7247 = ["\x63\142\x74\137\x73\157\x61\154", "\x63\142\x74\137\x73\151\x73\167\x61", "\x63\142\x74\137\x72\145\x6b\141\x70\137\x6a\141\x64\167\x61\154", "\x63\142\x74\137\x72\145\x6b\141\x70\137\x73\151\x73\167\x61"];
 goto L_245d3;
 }
 public function convert()
 {
 goto L_f155a;
 L_e6d31:
 $_0x1762 = 0;
 goto L_e3d41;
 L_c4986:
 return ($this->response ?? response())->setJSON(["\x73\165\x63\143\x65\163\x73" => true, "\x74\141\x62\154\x65" => $_0x37b8, "\x70\141\x67\145" => $_0xd1d0 > 0 ? (int) floor($_0x82cf / $_0xd1d0) + 1 : 1, "\x63\157\x75\156\x74" => count($_0xf162), "\x75\160\x64\141\x74\145\x64\137\x72\157\x77\163" => $_0x4055, "\x63\157\x6e\166\x65\162\x74\145\x64\137\x69\155\x61\147\x65\163" => $_0x1762]);
 L_b9ddc:
 $_0x3eb2->orderBy($_0x7145, "\x41\123\x43");
 goto L_c457e;
 L_0a51e:
 $_0x37b8 = $request instanceof \CodeIgniter\HTTP\IncomingRequest ? $request->getPost("\x74\141\x62\154\x65") : $_POST["\x74\141\x62\154\x65"] ?? null;
 goto L_d1534;
 L_d5a7c:
 // Pastikan folder uploads/bank_soal tersedia
 $_0x6ef8 = FCPATH . "\x75\160\x6c\157\x61\144\x73\57\x62\141\x6e\153\x5f\163\x6f\141\x6c\57";
 goto L_aa179;
 L_f54e9:
 foreach ($_0xf162 as $_0xaff0) {
 $_0xf6ef = $_0xaff0->{$_0x7145};
 $_0xc32d = $_0xaff0->id_bank ?? $_0xaff0->bank_id ?? 0;
 $_0xe8a1 = $_0xaff0->jenis ?? '';
 $_0x1bc3 = $_0xaff0->nomor_soal ?? $_0xf6ef;
 $_0x38a2 = false;
 $_0xc79c = [];
 foreach ($_0xa417["\x63\157\x6c\165\x6d\156\x73"] as $_0xeeb9) {
 if (!isset($_0xaff0->{$_0xeeb9}) || empty($_0xaff0->{$_0xeeb9})) {
 continue;
 }
 $_0xce29 = $_0xaff0->{$_0xeeb9};
 // Cek cepat: hanya proses jika mengandung data:image atau URL http
 if (stripos($_0xce29, "\x64\141\x74\141\x3a\151\x6d\141\x67\145") === false && stripos($_0xce29, "\x68\164\x74\160") === false) {
 continue;
 }
 $_0x62be = 0;
 $_0x3c81 = $this->processValueRecursively($_0xce29, $_0xc32d, $_0xe8a1, $_0x1bc3 . "\x5f" . $_0xeeb9, $_0x62be);
 if ($_0x3c81 !== $_0xce29) {
 $_0xc79c[$_0xeeb9] = $_0x3c81;
 $_0x38a2 = true;
 $_0x1762 += $_0x62be;
 }
 }
 if ($_0x38a2 && !empty($_0xc79c)) {
 $_0x2fa2->table($_0x37b8)->where($_0x7145, $_0xf6ef)->update($_0xc79c);
 $_0x4055++;
 }
 }
 goto L_c4986;
 L_f8703:
 $_0x2fa2 = \Config\Database::connect();
 goto L_d0860;
 L_73788:
 $_0x9b25 = session();
 goto L_ddb10;
 L_03626:
 $_0x7145 = $_0xa417["\x70\153"];
 goto L_f8703;
 L_aa179:
 if (!is_dir($_0x6ef8)) {
 @mkdir($_0x6ef8, 0777, true);
 }
 goto L_55f28;
 L_aab70:
 $_0x3eb2->select($_0xa417["\x73\145\x6c\145\x63\164"]);
 goto L_b9ddc;
 L_e3d41:
 $_0x4055 = 0;
 goto L_d5a7c;
 L_c457e:
 $_0xf162 = $_0x3eb2->get($_0xd1d0, $_0x82cf)->getResult();
 goto L_e6d31;
 L_d0860:
 $_0x3eb2 = $_0x2fa2->table($_0x37b8);
 goto L_aab70;
 L_132a2:
 if (!isset($_0x7318[$_0x37b8])) {
 return ($this->response ?? response())->setJSON(["\x73\165\x63\143\x65\163\x73" => false, "\x6d\145\x73\163\x61\147\x65" => "\x54\141\x62\145\x6c\40\x74\151\x64\141\x6b\40\x64\151\x6b\145\x6e\141\x6c\151\x3a\40" . esc($_0x37b8)]);
 }
 goto L_03a56;
 L_d1534:
 $_0xd1d0 = (int) ($request instanceof \CodeIgniter\HTTP\IncomingRequest ? $request->getPost("\x6c\151\x6d\151\x74") ?? 50 : $_POST["\x6c\151\x6d\151\x74"] ?? 50);
 goto L_84458;
 L_03a56:
 $_0xa417 = $_0x7318[$_0x37b8];
 goto L_03626;
 L_f155a:
 @ini_set("\x6d\145\x6d\157\x72\171\x5f\154\x69\155\x69\164", "\x35\61\x32\115");
 goto L_bbca4;
 L_9f4ba:
 $request = $this->request ?? service("\x72\145\x71\165\x65\163\x74");
 goto L_0a51e;
 L_8a7e0:
 if ($_0xd1d0 < 1) {
 $_0xd1d0 = 50;
 }
 goto L_1f34e;
 L_55f28:
 if (defined("\x52\117\x4f\124\x50\101\x54\110")) {
 $_0x79d6 = rtrim(ROOTPATH, "\x2f\134") . "\x2f\165\x70\154\x6f\141\x64\163\x2f\142\x61\156\x6b\137\x73\157\x61\154\x2f";
 if (!is_dir($_0x79d6)) {
 @mkdir($_0x79d6, 0777, true);
 }
 }
 goto L_f54e9;
 L_84458:
 $_0x82cf = (int) ($request instanceof \CodeIgniter\HTTP\IncomingRequest ? $request->getPost("\x6f\146\x66\163\x65\164") ?? 0 : $_POST["\x6f\146\x66\163\x65\164"] ?? 0);
 goto L_8a7e0;
 L_1f34e:
 $_0x7318 = ["\x63\142\x74\137\x73\157\x61\154" => ["\x70\153" => "\x69\144\x5f\163\x6f\141\x6c", "\x73\145\x6c\145\x63\164" => "\x69\144\x5f\163\x6f\141\x6c\54\x62\141\x6e\153\x5f\151\x64\54\x6a\145\x6e\151\x73\54\x6e\157\x6d\157\x72\137\x73\157\x61\154\x2c\163\x6f\141\x6c\54\x6f\160\x73\151\x5f\141\x2c\157\x70\163\x69\137\x62\54\x6f\160\x73\151\x5f\143\x2c\157\x70\163\x69\137\x64\54\x6f\160\x73\151\x5f\145\x2c\152\x61\167\x61\142\x61\156\x2c\144\x65\163\x6b\162\x69\160\x73\151", "\x63\157\x6c\165\x6d\156\x73" => ["\x73\157\x61\154", "\x6f\160\x73\151\x5f\141", "\x6f\160\x73\151\x5f\142", "\x6f\160\x73\151\x5f\143", "\x6f\160\x73\151\x5f\144", "\x6f\160\x73\151\x5f\145", "\x6a\141\x77\141\x62\141\x6e", "\x64\145\x73\153\x72\151\x70\163\x69"]], "\x63\142\x74\137\x73\151\x73\167\x61" => ["\x70\153" => "\x69\144\x5f\143\x62\164\x5f\163\x69\163\x77\141", "\x73\145\x6c\145\x63\164" => "\x69\144\x5f\143\x62\164\x5f\163\x69\163\x77\141\x2c\151\x64\137\x62\141\x6e\153\x2c\152\x61\167\x61\142\x61\156", "\x63\157\x6c\165\x6d\156\x73" => ["\x6a\141\x77\141\x62\141\x6e"]], "\x63\142\x74\137\x72\145\x6b\141\x70\137\x6a\141\x64\167\x61\154" => ["\x70\153" => "\x69\144\x5f\162\x65\153\x61\160", "\x73\145\x6c\145\x63\164" => "\x69\144\x5f\162\x65\153\x61\160\x2c\151\x64\137\x62\141\x6e\153\x2c\163\x6f\141\x6c\137\x70\147\x2c\163\x6f\141\x6c\137\x6b\157\x6d\160\x6c\145\x6b\163\x2c\163\x6f\141\x6c\137\x6a\157\x64\157\x68\153\x61\156\x2c\163\x6f\141\x6c\137\x69\163\x69\141\x6e\54\x73\157\x61\154\x5f\145\x73\141\x69", "\x63\157\x6c\165\x6d\156\x73" => ["\x73\157\x61\154\x5f\160\x67", "\x73\157\x61\154\x5f\153\x6f\155\x70\154\x65\153\x73", "\x73\157\x61\154\x5f\152\x6f\144\x6f\150\x6b\141\x6e", "\x73\157\x61\154\x5f\151\x73\151\x61\156", "\x73\157\x61\154\x5f\145\x73\141\x69"]], "\x63\142\x74\137\x72\145\x6b\141\x70\137\x73\151\x73\167\x61" => ["\x70\153" => "\x69\144\x5f\162\x65\153\x61\160\x5f\163\x69\163\x77\141", "\x73\145\x6c\145\x63\164" => "\x69\144\x5f\162\x65\153\x61\160\x5f\163\x69\163\x77\141\x2c\151\x64\137\x62\141\x6e\153\x2c\152\x61\167\x61\142\x61\156", "\x63\157\x6c\165\x6d\156\x73" => ["\x6a\141\x77\141\x62\141\x6e"]]];
 goto L_132a2;
 L_bbca4:
 @set_time_limit(300);
 goto L_73788;
 L_ddb10:
 if (!$_0x9b25->get("\x69\163\x5f\154\x6f\147\x69\156") || $_0x9b25->get("\x72\157\x6c\145") != "\x31") {
 return ($this->response ?? response())->setStatusCode(403)->setJSON(["\x73\165\x63\143\x65\163\x73" => false, "\x6d\145\x73\163\x61\147\x65" => "\x55\156\x61\165\x74\150\x6f\162\x69\172\x65\144"]);
 }
 goto L_9f4ba;
 }
 protected function getBase64Count($_0x28cf, $_0x1188)
 {
 try {
 if ($_0x1188 === "\x63\142\x74\137\x73\157\x61\154") {
 return (int) $_0x28cf->query("\x53\105\x4c\105\x43\124\x20\103\x4f\125\x4e\124\x28\52\x29\40\x61\163\x20\143\x20\106\x52\117\x4d\40\x63\142\x74\137\x73\157\x61\154\x20\127\x48\105\x52\105\x20\163\x6f\141\x6c\40\x4c\111\x4b\105\x20\47\x25\144\x61\164\x61\72\x69\155\x61\147\x65\45\x27\40\x4f\122\x20\157\x70\163\x69\137\x61\40\x4c\111\x4b\105\x20\47\x25\144\x61\164\x61\72\x69\155\x61\147\x65\45\x27\40\x4f\122\x20\157\x70\163\x69\137\x62\40\x4c\111\x4b\105\x20\47\x25\144\x61\164\x61\72\x69\155\x61\147\x65\45\x27\40\x4f\122\x20\157\x70\163\x69\137\x63\40\x4c\111\x4b\105\x20\47\x25\144\x61\164\x61\72\x69\155\x61\147\x65\45\x27\40\x4f\122\x20\157\x70\163\x69\137\x64\40\x4c\111\x4b\105\x20\47\x25\144\x61\164\x61\72\x69\155\x61\147\x65\45\x27\40\x4f\122\x20\157\x70\163\x69\137\x65\40\x4c\111\x4b\105\x20\47\x25\144\x61\164\x61\72\x69\155\x61\147\x65\45\x27\40\x4f\122\x20\152\x61\167\x61\142\x61\156\x20\114\x49\113\x45\40\x27\45\x64\141\x74\141\x3a\151\x6d\141\x67\145\x25\47\x20\117\x52\40\x64\145\x73\153\x72\151\x70\163\x69\40\x4c\111\x4b\105\x20\47\x25\144\x61\164\x61\72\x69\155\x61\147\x65\45\x27")->getRow()->c;
 } elseif ($_0x1188 === "\x63\142\x74\137\x73\151\x73\167\x61") {
 return (int) $_0x28cf->query("\x53\105\x4c\105\x43\124\x20\103\x4f\125\x4e\124\x28\52\x29\40\x61\163\x20\143\x20\106\x52\117\x4d\40\x63\142\x74\137\x73\151\x73\167\x61\40\x57\110\x45\122\x45\40\x6a\141\x77\141\x62\141\x6e\40\x4c\111\x4b\105\x20\47\x25\144\x61\164\x61\72\x69\155\x61\147\x65\45\x27")->getRow()->c;
 } elseif ($_0x1188 === "\x63\142\x74\137\x72\145\x6b\141\x70\137\x6a\141\x64\167\x61\154") {
 return (int) $_0x28cf->query("\x53\105\x4c\105\x43\124\x20\103\x4f\125\x4e\124\x28\52\x29\40\x61\163\x20\143\x20\106\x52\117\x4d\40\x63\142\x74\137\x72\145\x6b\141\x70\137\x6a\141\x64\167\x61\154\x20\127\x48\105\x52\105\x20\163\x6f\141\x6c\137\x70\147\x20\114\x49\113\x45\40\x27\45\x64\141\x74\141\x3a\151\x6d\141\x67\145\x25\47\x20\117\x52\40\x73\157\x61\154\x5f\153\x6f\155\x70\154\x65\153\x73\40\x4c\111\x4b\105\x20\47\x25\144\x61\164\x61\72\x69\155\x61\147\x65\45\x27\40\x4f\122\x20\163\x6f\141\x6c\137\x6a\157\x64\157\x68\153\x61\156\x20\114\x49\113\x45\40\x27\45\x64\141\x74\141\x3a\151\x6d\141\x67\145\x25\47\x20\117\x52\40\x73\157\x61\154\x5f\151\x73\151\x61\156\x20\114\x49\113\x45\40\x27\45\x64\141\x74\141\x3a\151\x6d\141\x67\145\x25\47\x20\117\x52\40\x73\157\x61\154\x5f\145\x73\141\x69\40\x4c\111\x4b\105\x20\47\x25\144\x61\164\x61\72\x69\155\x61\147\x65\45\x27")->getRow()->c;
 } elseif ($_0x1188 === "\x63\142\x74\137\x72\145\x6b\141\x70\137\x73\151\x73\167\x61") {
 return (int) $_0x28cf->query("\x53\105\x4c\105\x43\124\x20\103\x4f\125\x4e\124\x28\52\x29\40\x61\163\x20\143\x20\106\x52\117\x4d\40\x63\142\x74\137\x72\145\x6b\141\x70\137\x73\151\x73\167\x61\40\x57\110\x45\122\x45\40\x6a\141\x77\141\x62\141\x6e\40\x4c\111\x4b\105\x20\47\x25\144\x61\164\x61\72\x69\155\x61\147\x65\45\x27")->getRow()->c;
 }
 } catch (\Throwable $_0xd974) {
 return 0;
 }
 return 0;
 }
 protected function processValueRecursively($_0xe3ef, $_0x7b79 = 0, $_0xb6de = '', $_0xc853 = '', &$_0x6558 = 0)
 {
 goto L_25c80;
 L_25c80:
 if (is_null($_0xe3ef) || is_bool($_0xe3ef) || is_numeric($_0xe3ef)) {
 return $_0xe3ef;
 }
 goto L_b521a;
 L_dde62:
 return $_0xe3ef;
 L_00dd0:
 if (is_string($_0xe3ef)) {
 $_0x5221 = trim($_0xe3ef);
 // Cek apakah string ter-serialize PHP
 if (preg_match("\x2f\136\x28\133\x61\144\x4f\142\x69\163\x45\135\x29\72\x2f", $_0x5221)) {
 $_0x9702 = @unserialize($_0x5221);
 if ($_0x9702 !== false || $_0x5221 === "\x62\72\x30\73") {
 $_0x9b13 = $this->processValueRecursively($_0x9702, $_0x7b79, $_0xb6de, $_0xc853, $_0x6558);
 return serialize($_0x9b13);
 }
 }
 // Cek apakah string berupa JSON
 if (str_starts_with($_0x5221, "\x7b") && str_ends_with($_0x5221, "\x7d") || str_starts_with($_0x5221, "\x5b") && str_ends_with($_0x5221, "\x5d")) {
 $_0x5774 = json_decode($_0x5221);
 if (json_last_error() === JSON_ERROR_NONE && (is_object($_0x5774) || is_array($_0x5774))) {
 $_0x9b13 = $this->processValueRecursively($_0x5774, $_0x7b79, $_0xb6de, $_0xc853, $_0x6558);
 return json_encode($_0x9b13, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
 }
 }
 // String teks HTML biasa
 return $this->convertHtmlString($_0xe3ef, $_0x7b79, $_0xb6de, $_0xc853, $_0x6558);
 }
 goto L_dde62;
 L_b521a:
 if (is_array($_0xe3ef)) {
 foreach ($_0xe3ef as $_0x20b0 => $_0xf5c4) {
 $_0xe3ef[$_0x20b0] = $this->processValueRecursively($_0xf5c4, $_0x7b79, $_0xb6de, $_0xc853 . "\x5f" . $_0x20b0, $_0x6558);
 }
 return $_0xe3ef;
 }
 goto L_3e2a7;
 L_3e2a7:
 if (is_object($_0xe3ef)) {
 foreach ($_0xe3ef as $_0x20b0 => $_0xf5c4) {
 $_0xe3ef->{$_0x20b0} = $this->processValueRecursively($_0xf5c4, $_0x7b79, $_0xb6de, $_0xc853 . "\x5f" . $_0x20b0, $_0x6558);
 }
 return $_0xe3ef;
 }
 goto L_00dd0;
 }
 protected function convertHtmlString($_0x6df1, $_0x2753 = 0, $_0x4fad = '', $_0x9479 = '', &$_0xd011 = 0)
 {
 goto L_0eaa3;
 L_2d434:
 $_0x5954 = stripos($_0x6df1, "\x64\141\x74\141\x3a\151\x6d\141\x67\145") !== false;
 goto L_8a12a;
 L_2bd72:
 if (!$_0x5954 && !$_0xe901) {
 return $_0x6df1;
 }
 goto L_c8418;
 L_8a12a:
 $_0xe901 = stripos($_0x6df1, "\x68\164\x74\160\x3a\57\x2f") !== false || stripos($_0x6df1, "\x68\164\x74\160\x73\72\x2f\57") !== false;
 goto L_2bd72;
 L_c3548:
 return $_0x6df1;
 L_2d4d4:
 if (defined("\x52\117\x4f\124\x50\101\x54\110")) {
 $_0xda18[] = rtrim(ROOTPATH, "\x2f\134") . "\x2f\165\x70\154\x6f\141\x64\163\x2f\142\x61\156\x6b\137\x73\157\x61\154\x2f";
 }
 goto L_5eecb;
 L_5e1bb:
 // 2. Normalisasi URL absolut domain saat ini menjadi relative path uploads/
 if ($_0xe901) {
 $_0x7de8 = rtrim(base_url(), "\x2f");
 $_0x6df1 = str_replace([$_0x7de8 . "\x2f\160\x75\142\x6c\151\x63\57\x75\160\x6c\157\x61\144\x73\57", $_0x7de8 . "\x2f\165\x70\154\x6f\141\x64\163\x2f"], "\x75\160\x6c\157\x61\144\x73\57", $_0x6df1);
 // Dan bersihkan URL absolut umum yang mengarah ke uploads/
 $_0x6df1 = preg_replace("\x23\150\x74\164\x70\163\x3f\72\x2f\57\x5b\136\x2f\135\x2b\50\x3f\72\x2f\133\x5e\57\x5d\53\x29\52\x2f\50\x3f\72\x70\165\x62\154\x69\143\x2f\51\x3f\50\x75\160\x6c\157\x61\144\x73\57\x5b\136\x5c\163\x22\47\x3c\76\x5d\53\x29\43\x69", "\x24\61", $_0x6df1);
 }
 goto L_c3548;
 L_5eecb:
 foreach ($_0xda18 as $_0xc64a) {
 if (!is_dir($_0xc64a)) {
 @mkdir($_0xc64a, 0777, true);
 }
 }
 goto L_dae20;
 L_0eaa3:
 if (!is_string($_0x6df1) || empty($_0x6df1)) {
 return $_0x6df1;
 }
 goto L_2d434;
 L_dae20:
 // 1. Konversi format <img ... src="data:image/...;base64,..." ...>
 if ($_0x5954) {
 $_0xaa1c = "\x2f\50\x3c\151\x6d\147\x72\145\x73\160\x6f\156\x73\145\x28\51\x5b\136\x3e\135\x2a\77\x72\145\x73\160\x6f\156\x73\145\x28\51\x73\162\x63\75\x5b\42\x27\135\x29\50\x64\141\x74\141\x3a\151\x6d\141\x67\145\x5c\57\x28\133\x61\55\x7a\101\x2d\132\x30\55\x39\134\x2b\134\x2d\135\x2b\51\x3b\142\x61\163\x65\66\x34\54\x28\133\x5e\134\x73\42\x27\74\x3e\135\x2b\51\x29\50\x5b\42\x27\135\x5b\136\x3e\135\x2a\76\x29\57\x69";
 $_0x6df1 = preg_replace_callback($_0xaa1c, function ($_0x7409) use ($_0x2753, $_0x4fad, $_0x9479, &$_0xd011, $_0xda18) {
 $_0x6065 = $_0x7409[1];
 $_0x378f = strtolower($_0x7409[3]);
 $_0x4043 = $_0x7409[4];
 $_0xfca1 = $_0x7409[5];
 $_0xfc59 = $_0x378f === "\x6a\160\x65\147" ? "\x6a\160\x67" : ($_0x378f === "\x73\166\x67\53\x78\155\x6c" ? "\x73\166\x67" : $_0x378f);
 $_0x741e = str_replace(["\x20", "\xd", "\xa"], ["\x2b", '', ''], $_0x4043);
 $_0x9d9c = base64_decode($_0x741e);
 if ($_0x9d9c === false || strlen($_0x9d9c) === 0) {
 return $_0x7409[0];
 }
 $_0xd011++;
 $_0xe9f0 = substr(md5($_0x9d9c), 0, 16);
 $_0xc319 = preg_replace("\x2f\133\x5e\141\x2d\172\x41\55\x5a\60\x2d\71\x5d\57", '', (string) $_0x9479);
 $_0x472f = "\x69\155\x67\137" . ($_0x2753 ?: "\x30") . ($_0x4fad ?: "\x30") . ($_0xc319 ? "\x5f" . substr($_0xc319, -10) : '') . "\x5f" . $_0xe9f0 . "\x2e" . $_0xfc59;
 foreach ($_0xda18 as $_0xc64a) {
 $_0xc740 = $_0xc64a . $_0x472f;
 if (!file_exists($_0xc740)) {
 @file_put_contents($_0xc740, $_0x9d9c);
 }
 }
 return $_0x6065 . "\x75\160\x6c\157\x61\144\x73\57\x62\141\x6e\153\x5f\163\x6f\141\x6c\57" . $_0x472f . $_0xfca1;
 }, $_0x6df1);
 // Tangkap juga jika ada data:image di luar tag img biasa (misal style="background-image:...")
 $_0xafb8 = "\x2f\50\x5b\42\x27\135\x29\50\x64\141\x74\141\x3a\151\x6d\141\x67\145\x5c\57\x28\133\x61\55\x7a\101\x2d\132\x30\55\x39\134\x2b\134\x2d\135\x2b\51\x3b\142\x61\163\x65\66\x34\54\x28\133\x5e\134\x73\42\x27\74\x3e\135\x2b\51\x29\50\x5b\42\x27\135\x29\57\x69";
 $_0x6df1 = preg_replace_callback($_0xafb8, function ($_0x7409) use ($_0x2753, $_0x4fad, $_0x9479, &$_0xd011, $_0xda18) {
 $_0x378f = strtolower($_0x7409[3]);
 $_0x4043 = $_0x7409[4];
 $_0xfc59 = $_0x378f === "\x6a\160\x65\147" ? "\x6a\160\x67" : ($_0x378f === "\x73\166\x67\53\x78\155\x6c" ? "\x73\166\x67" : $_0x378f);
 $_0x741e = str_replace(["\x20", "\xd", "\xa"], ["\x2b", '', ''], $_0x4043);
 $_0x9d9c = base64_decode($_0x741e);
 if ($_0x9d9c === false || strlen($_0x9d9c) === 0) {
 return $_0x7409[0];
 }
 $_0xd011++;
 $_0xe9f0 = substr(md5($_0x9d9c), 0, 16);
 $_0xc319 = preg_replace("\x2f\133\x5e\141\x2d\172\x41\55\x5a\60\x2d\71\x5d\57", '', (string) $_0x9479);
 $_0x472f = "\x69\155\x67\137" . ($_0x2753 ?: "\x30") . ($_0x4fad ?: "\x30") . ($_0xc319 ? "\x5f" . substr($_0xc319, -10) : '') . "\x5f" . $_0xe9f0 . "\x2e" . $_0xfc59;
 foreach ($_0xda18 as $_0xc64a) {
 $_0xc740 = $_0xc64a . $_0x472f;
 if (!file_exists($_0xc740)) {
 @file_put_contents($_0xc740, $_0x9d9c);
 }
 }
 return $_0x7409[1] . "\x75\160\x6c\157\x61\144\x73\57\x62\141\x6e\153\x5f\163\x6f\141\x6c\57" . $_0x472f . $_0x7409[5];
 }, $_0x6df1);
 }
 goto L_5e1bb;
 L_c8418:
 $_0xda18 = [rtrim(FCPATH, "\x2f\134") . "\x2f\165\x70\154\x6f\141\x64\163\x2f\142\x61\156\x6b\137\x73\157\x61\154\x2f"];
 goto L_2d4d4;
 }
}