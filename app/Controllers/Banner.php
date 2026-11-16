<?php
/*   ________________________________________
    |               NextGen Garuda CBT       |
    |    Protected & Distributed via GitHub  |
    |________________________________________|
*/
namespace App\Controllers;

use App\Models\BannerModel;
use App\Models\DashboardModel;
class Banner extends BaseController
{
 protected $bannerModel;
 protected $dashboardModel;
 public function __construct()
 {
 $this->bannerModel = new BannerModel();
 $this->dashboardModel = new DashboardModel();
 }
 public function index()
 {
 goto L_34175;
 L_6b4de:
 $_0xf91e = $this->dashboardModel->getSemesterActive();
 goto L_4a6c7;
 L_4a6c7:
 $_0x4740 = ["\x75\163\x65\162" => ["\x66\151\x72\163\x74\137\x6e\141\x6d\145" => $_0xa7c0->get("\x75\163\x65\162\x6e\141\x6d\145"), "\x72\157\x6c\145\x5f\156\x61\155\x65" => $_0xa7c0->get("\x72\157\x6c\145\x5f\156\x61\155\x65"), "\x66\157\x74\157" => $_0xa7c0->get("\x66\157\x74\157") ?? ''], "\x6a\165\x64\165\x6c" => "\x55\160\x6c\157\x61\144\x20\102\x61\156\x6e\145\x72\40\x53\151\x73\167\x61", "\x73\165\x62\152\x75\144\x75\154" => "\x4b\145\x6c\157\x6c\141\x20\46\x20\125\x70\154\x6f\141\x64\40\x47\141\x6d\142\x61\162\x20\102\x61\156\x6e\145\x72\40\x49\156\x66\157\x72\155\x61\163\x69\40\x53\151\x73\167\x61", "\x73\145\x74\164\x69\156\x67" => $this->dashboardModel->getSetting(), "\x74\160" => $this->dashboardModel->getTahun(), "\x74\160\x5f\141\x63\164\x69\166\x65" => $_0x131b, "\x73\155\x74" => $this->dashboardModel->getSemester(), "\x73\155\x74\137\x61\143\x74\151\x76\145" => $_0xf91e, "\x62\141\x6e\156\x65\162\x73" => $this->bannerModel->getAllBanners()];
 goto L_f2644;
 L_b1be8:
 if (!$_0xa7c0->get("\x69\163\x5f\154\x6f\147\x69\156")) {
 return redirect()->to("\x61\165\x74\150\x2f\154\x6f\147\x69\156");
 }
 goto L_f88bd;
 L_f88bd:
 if (!in_array((string) $_0xa7c0->get("\x72\157\x6c\145"), ["\x31", "\x34"])) {
 return redirect()->to("\x64\141\x73\150\x62\157\x61\162\x64")->with("\x65\162\x72\157\x72", "\x48\141\x6e\171\x61\40\x41\144\x6d\151\x6e\151\x73\164\x72\141\x74\157\x72\40\x79\141\x6e\147\x20\144\x61\160\x61\164\x20\155\x65\156\x67\141\x6b\163\x65\163\x20\150\x61\154\x61\155\x61\156\x20\151\x6e\151\x2e");
 }
 goto L_db2e4;
 L_db2e4:
 $_0x131b = $this->dashboardModel->getTahunActive();
 goto L_6b4de;
 L_f2644:
 return view("\x62\141\x6e\156\x65\162\x2f\151\x6e\144\x65\170", $_0x4740);
 L_34175:
 $_0xa7c0 = session();
 goto L_b1be8;
 }
 public function save()
 {
 goto L_c468f;
 L_62f69:
 $_0x3030 = trim((string) $this->request->getPost("\x77\141\x72\156\x61\137\x62\147"));
 goto L_6a85b;
 L_b9ad5:
 // Sinkronisasi otomatis ke cbt_exambro_setting jika banner berisi link APK
 if (!empty($_0x6099) && stripos($_0x6099, "\x2e\141\x70\153") !== false) {
 try {
 $_0x2cca = \Config\Database::connect();
 if ($_0x2cca->tableExists("\x63\142\x74\137\x65\170\x61\155\x62\162\x6f\137\x73\145\x74\164\x69\156\x67")) {
 $_0x2cca->table("\x63\142\x74\137\x65\170\x61\155\x62\162\x6f\137\x73\145\x74\164\x69\156\x67")->where("\x69\144", 1)->update(["\x6c\151\x6e\153\x5f\141\x6e\144\x72\157\x69\144" => $_0x6099]);
 }
 } catch (\Throwable $_0x34c3) {
 }
 }
 goto L_a96a7;
 L_ac0f7:
 $_0x8dfa = trim((string) $this->request->getPost("\x6a\165\x64\165\x6c"));
 goto L_1d4ac;
 L_ab14e:
 if ($_0xa687 && $_0xa687->isValid() && !$_0xa687->hasMoved()) {
 $_0xa96b = ["\x69\155\x61\147\x65\57\x6a\160\x65\147", "\x69\155\x61\147\x65\57\x70\156\x67", "\x69\155\x61\147\x65\57\x77\145\x62\160", "\x69\155\x61\147\x65\57\x67\151\x66", "\x69\155\x61\147\x65\57\x6a\160\x67"];
 if (!in_array($_0xa687->getMimeType(), $_0xa96b)) {
 if ($this->request->isAJAX()) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x46\157\x72\155\x61\164\x20\147\x61\155\x62\141\x72\40\x68\141\x72\165\x73\40\x4a\120\x47\54\x20\120\x4e\107\x2c\40\x47\111\x46\54\x20\141\x74\141\x75\40\x57\145\x62\120\x21"]);
 }
 return redirect()->back()->with("\x65\162\x72\157\x72", "\x46\157\x72\155\x61\164\x20\147\x61\155\x62\141\x72\40\x68\141\x72\165\x73\40\x4a\120\x47\54\x20\120\x4e\107\x2c\40\x47\111\x46\54\x20\141\x74\141\x75\40\x57\145\x62\120\x21");
 }
 $_0x2319 = FCPATH . "\x75\160\x6c\157\x61\144\x73\57\x62\141\x6e\156\x65\162\x2f";
 if (!is_dir($_0x2319)) {
 @mkdir($_0x2319, 0777, true);
 }
 $_0x4f69 = "\x62\141\x6e\156\x65\162\x5f" . time() . "\x5f" . $_0xa687->getRandomName();
 $_0xa687->move($_0x2319, $_0x4f69);
 // Otomatis potong & kecilkan gambar ke ukuran proporsional (1200 x 600 px) & kompresi optimal
 $this->optimizeBannerImage($_0x2319 . $_0x4f69, 1200, 600);
 $_0xcb99["\x67\141\x6d\142\x61\162"] = "\x75\160\x6c\157\x61\144\x73\57\x62\141\x6e\156\x65\162\x2f" . $_0x4f69;
 // Hapus gambar lama jika update
 if (!empty($_0xf172)) {
 $_0x57e8 = $this->bannerModel->find($_0xf172);
 if ($_0x57e8 && !empty($_0x57e8["\x67\141\x6d\142\x61\162"]) && file_exists(FCPATH . $_0x57e8["\x67\141\x6d\142\x61\162"])) {
 @unlink(FCPATH . $_0x57e8["\x67\141\x6d\142\x61\162"]);
 }
 }
 }
 goto L_00dd3;
 L_a96a7:
 if ($this->request->isAJAX()) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => true, "\x6d\145\x73\163\x61\147\x65" => $_0x732c]);
 }
 goto L_850f5;
 L_5b743:
 if (empty($_0x8dfa)) {
 if ($this->request->isAJAX()) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x4a\165\x64\165\x6c\40\x62\141\x6e\156\x65\162\x20\164\x69\144\x61\153\x20\142\x6f\154\x65\150\x20\153\x6f\163\x6f\156\x67\41"]);
 }
 return redirect()->back()->with("\x65\162\x72\157\x72", "\x4a\165\x64\165\x6c\40\x62\141\x6e\156\x65\162\x20\164\x69\144\x61\153\x20\142\x6f\154\x65\150\x20\153\x6f\163\x6f\156\x67\41");
 }
 goto L_e845d;
 L_6a85b:
 $_0xfa00 = (int) $this->request->getPost("\x75\162\x75\164\x61\156");
 goto L_61eba;
 L_c468f:
 $_0x7180 = session();
 goto L_b0b10;
 L_10b32:
 $_0xf172 = $this->request->getPost("\x69\144\x5f\142\x61\156\x6e\145\x72");
 goto L_ac0f7;
 L_00dd3:
 if (!empty($_0xf172)) {
 $this->bannerModel->update($_0xf172, $_0xcb99);
 $_0x732c = "\x42\141\x6e\156\x65\162\x20\142\x65\162\x68\141\x73\151\x6c\40\x64\151\x70\145\x72\142\x61\162\x75\151\x21";
 } else {
 $_0xcb99["\x63\162\x65\141\x74\145\x64\137\x61\164"] = date("\x59\55\x6d\55\x64\40\x48\72\x69\72\x73");
 $this->bannerModel->insert($_0xcb99);
 $_0x732c = "\x42\141\x6e\156\x65\162\x20\142\x61\162\x75\40\x62\145\x72\150\x61\163\x69\154\x20\144\x69\164\x61\155\x62\141\x68\153\x61\156\x21";
 }
 goto L_b9ad5;
 L_a63fc:
 $_0x6099 = trim((string) $this->request->getPost("\x75\162\x6c\137\x6c\151\x6e\153"));
 goto L_54842;
 L_b0b10:
 if (!$_0x7180->get("\x69\163\x5f\154\x6f\147\x69\156") || !in_array((string) $_0x7180->get("\x72\157\x6c\145"), ["\x31", "\x34"])) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x41\153\x73\145\x73\40\x64\151\x74\157\x6c\141\x6b"]);
 }
 goto L_10b32;
 L_61eba:
 $_0xc4ff = $this->request->getPost("\x73\164\x61\164\x75\163") !== null ? (int) $this->request->getPost("\x73\164\x61\164\x75\163") : 1;
 goto L_5b743;
 L_1d4ac:
 $_0xee27 = trim((string) $this->request->getPost("\x73\165\x62\152\x75\144\x75\154"));
 goto L_a63fc;
 L_850f5:
 return redirect()->to(base_url("\x62\141\x6e\156\x65\162"))->with("\x73\165\x63\143\x65\163\x73", $_0x732c);
 L_cb0f6:
 // Handle Image Upload
 $_0xa687 = $this->request->getFile("\x67\141\x6d\142\x61\162");
 goto L_ab14e;
 L_54842:
 $_0xaf3b = trim((string) $this->request->getPost("\x74\157\x6d\142\x6f\154\x5f\164\x65\153\x73"));
 goto L_62f69;
 L_e845d:
 $_0xcb99 = ["\x6a\165\x64\165\x6c" => $_0x8dfa, "\x73\165\x62\152\x75\144\x75\154" => $_0xee27, "\x75\162\x6c\137\x6c\151\x6e\153" => $_0x6099, "\x74\157\x6d\142\x6f\154\x5f\164\x65\153\x73" => !empty($_0xaf3b) ? $_0xaf3b : "\x4c\151\x68\141\x74\40\x44\145\x74\141\x69\154", "\x77\141\x72\156\x61\137\x62\147" => !empty($_0x3030) ? $_0x3030 : "\x6c\151\x6e\145\x61\162\x2d\147\x72\141\x64\151\x65\156\x74\50\x31\63\x35\144\x65\147\x2c\40\x23\61\x65\63\x63\67\x32\40\x30\45\x2c\40\x23\62\x61\65\x32\71\x38\40\x31\60\x30\45\x29", "\x75\162\x75\164\x61\156" => $_0xfa00 > 0 ? $_0xfa00 : 1, "\x73\164\x61\164\x75\163" => $_0xc4ff, "\x75\160\x64\141\x74\145\x64\137\x61\164" => date("\x59\55\x6d\55\x64\40\x48\72\x69\72\x73")];
 goto L_cb0f6;
 }
 public function delete($_0xa403 = null)
 {
 goto L_425c3;
 L_968ae:
 if (!$_0xcd7f->get("\x69\163\x5f\154\x6f\147\x69\156") || !in_array((string) $_0xcd7f->get("\x72\157\x6c\145"), ["\x31", "\x34"])) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x41\153\x73\145\x73\40\x64\151\x74\157\x6c\141\x6b"]);
 }
 goto L_7b8df;
 L_7ba6e:
 if ($this->request->isAJAX()) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => true, "\x6d\145\x73\163\x61\147\x65" => "\x42\141\x6e\156\x65\162\x20\142\x65\162\x68\141\x73\151\x6c\40\x64\151\x68\141\x70\165\x73\41"]);
 }
 goto L_8d84a;
 L_63c45:
 if ($_0x5a6a) {
 if (!empty($_0x5a6a["\x67\141\x6d\142\x61\162"]) && file_exists(FCPATH . $_0x5a6a["\x67\141\x6d\142\x61\162"])) {
 @unlink(FCPATH . $_0x5a6a["\x67\141\x6d\142\x61\162"]);
 }
 $this->bannerModel->delete($_0xa403);
 }
 goto L_7ba6e;
 L_7b8df:
 $_0xa403 = $_0xa403 ?? $this->request->getPost("\x69\144\x5f\142\x61\156\x6e\145\x72");
 goto L_29295;
 L_425c3:
 $_0xcd7f = session();
 goto L_968ae;
 L_4f12f:
 $_0x5a6a = $this->bannerModel->find($_0xa403);
 goto L_63c45;
 L_29295:
 if (!$_0xa403) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x49\104\x20\102\x61\156\x6e\145\x72\40\x74\151\x64\141\x6b\40\x76\141\x6c\151\x64"]);
 }
 goto L_4f12f;
 L_8d84a:
 return redirect()->to(base_url("\x62\141\x6e\156\x65\162"))->with("\x73\165\x63\143\x65\163\x73", "\x42\141\x6e\156\x65\162\x20\142\x65\162\x68\141\x73\151\x6c\40\x64\151\x68\141\x70\165\x73\41");
 }
 public function toggle($_0x3a67 = null)
 {
 goto L_18471;
 L_a7843:
 return redirect()->to(base_url("\x62\141\x6e\156\x65\162"))->with("\x73\165\x63\143\x65\163\x73", "Banner berhasil {$_0x3e63}!");
 L_d5d91:
 $_0x3a67 = $_0x3a67 ?? $this->request->getPost("\x69\144\x5f\142\x61\156\x6e\145\x72");
 goto L_0029f;
 L_fd92d:
 $this->bannerModel->update($_0x3a67, ["\x73\164\x61\164\x75\163" => $_0x2b82, "\x75\160\x64\141\x74\145\x64\137\x61\164" => date("\x59\55\x6d\55\x64\40\x48\72\x69\72\x73")]);
 goto L_477ca;
 L_6351e:
 if ($this->request->isAJAX()) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => true, "\x6e\145\x77\137\x73\164\x61\164\x75\163" => $_0x2b82, "\x6d\145\x73\163\x61\147\x65" => "Banner berhasil {$_0x3e63}!"]);
 }
 goto L_a7843;
 L_2b83c:
 $_0x2b82 = $_0x53dc["\x73\164\x61\164\x75\163"] == 1 ? 0 : 1;
 goto L_fd92d;
 L_0029f:
 $_0x53dc = $this->bannerModel->find($_0x3a67);
 goto L_e06b2;
 L_477ca:
 $_0x3e63 = $_0x2b82 == 1 ? "\x64\151\x61\153\x74\151\x66\153\x61\156" : "\x64\151\x6e\157\x6e\141\x6b\164\x69\146\x6b\141\x6e";
 goto L_6351e;
 L_a3bc9:
 if (!$_0x2daa->get("\x69\163\x5f\154\x6f\147\x69\156") || !in_array((string) $_0x2daa->get("\x72\157\x6c\145"), ["\x31", "\x34"])) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x41\153\x73\145\x73\40\x64\151\x74\157\x6c\141\x6b"]);
 }
 goto L_d5d91;
 L_e06b2:
 if (!$_0x53dc) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x42\141\x6e\156\x65\162\x20\164\x69\144\x61\153\x20\144\x69\164\x65\155\x75\153\x61\156"]);
 }
 goto L_2b83c;
 L_18471:
 $_0x2daa = session();
 goto L_a3bc9;
 }
 /**
 * Otomatis memotong & mengecilkan gambar banner ke ukuran proporsional (1200 x 600 px)
 * dan mengompres kualitas agar file sangat ringan (< 150 KB) tanpa mengurangi ketajaman.
 */
 private function optimizeBannerImage(string $_0x7ba7, int $_0x67a4 = 1200, int $_0x5931 = 600): bool
 {
 goto L_f3527;
 L_d12a5:
 $_0xbaae = null;
 goto L_1cd86;
 L_e26ae:
 if ($_0xf712 <= 0 || $_0x886f <= 0) {
 @imagedestroy($_0xbaae);
 return false;
 }
 goto L_90a10;
 L_12bd4:
 if (!extension_loaded("\x67\144")) {
 return false;
 }
 goto L_31f34;
 L_7eb44:
 $_0xf712 = imagesx($_0xbaae);
 goto L_0329a;
 L_ee91a:
 if ($_0x938a > $_0xac22) {
 $_0xa5e8 = $_0x886f;
 $_0xda95 = (int) round($_0x886f * $_0xac22);
 $_0xb46b = (int) round(($_0xf712 - $_0xda95) / 2);
 $_0x7bd0 = 0;
 } else {
 $_0xda95 = $_0xf712;
 $_0xa5e8 = (int) round($_0xf712 / $_0xac22);
 $_0xb46b = 0;
 $_0x7bd0 = (int) round(($_0x886f - $_0xa5e8) / 2);
 }
 goto L_c1f75;
 L_a09bf:
 if ($_0x21b1 === "\x69\155\x61\147\x65\57\x70\156\x67") {
 imagealphablending($_0x1b92, false);
 imagesavealpha($_0x1b92, true);
 }
 goto L_1eb8f;
 L_0329a:
 $_0x886f = imagesy($_0xbaae);
 goto L_e26ae;
 L_1eb8f:
 imagecopyresampled($_0x1b92, $_0xbaae, 0, 0, $_0xb46b, $_0x7bd0, $_0x67a4, $_0x5931, $_0xda95, $_0xa5e8);
 goto L_fcff4;
 L_1cd86:
 switch ($_0x21b1) {
 case "\x69\155\x61\147\x65\57\x6a\160\x65\147":
 case "\x69\155\x61\147\x65\57\x6a\160\x67":
 $_0xbaae = @imagecreatefromjpeg($_0x7ba7);
 break;
 case "\x69\155\x61\147\x65\57\x70\156\x67":
 $_0xbaae = @imagecreatefrompng($_0x7ba7);
 break;
 case "\x69\155\x61\147\x65\57\x77\145\x62\160":
 if (function_exists("\x69\155\x61\147\x65\143\x72\145\x61\164\x65\146\x72\157\x6d\167\x65\142\x70")) {
 $_0xbaae = @imagecreatefromwebp($_0x7ba7);
 }
 break;
 }
 goto L_028b6;
 L_028b6:
 if (!$_0xbaae) {
 return false;
 }
 goto L_7eb44;
 L_45864:
 @imagedestroy($_0xbaae);
 goto L_30fc7;
 L_25512:
 if (!$_0x39f5) {
 return false;
 }
 goto L_85472;
 L_85472:
 $_0x21b1 = $_0x39f5["\x6d\151\x6d\145"] ?? '';
 goto L_d12a5;
 L_fcff4:
 if ($_0x21b1 === "\x69\155\x61\147\x65\57\x70\156\x67") {
 imagepng($_0x1b92, $_0x7ba7, 8);
 } elseif ($_0x21b1 === "\x69\155\x61\147\x65\57\x77\145\x62\160" && function_exists("\x69\155\x61\147\x65\167\x65\142\x70")) {
 imagewebp($_0x1b92, $_0x7ba7, 85);
 } else {
 imagejpeg($_0x1b92, $_0x7ba7, 85);
 }
 goto L_45864;
 L_31f34:
 $_0x39f5 = @getimagesize($_0x7ba7);
 goto L_25512;
 L_c1f75:
 $_0x1b92 = imagecreatetruecolor($_0x67a4, $_0x5931);
 goto L_a09bf;
 L_8a875:
 $_0x938a = $_0xf712 / $_0x886f;
 goto L_ee91a;
 L_30fc7:
 @imagedestroy($_0x1b92);
 goto L_5101c;
 L_90a10:
 $_0xac22 = $_0x67a4 / $_0x5931;
 goto L_8a875;
 L_5101c:
 return true;
 L_f3527:
 if (!file_exists($_0x7ba7)) {
 return false;
 }
 goto L_5b501;
 L_5b501:
 // Coba pakai CodeIgniter 4 Image manipulation service terlebih dahulu
 try {
 $_0x2466 = \Config\Services::image();
 $_0x2466->withFile($_0x7ba7)->fit($_0x67a4, $_0x5931, "\x63\145\x6e\164\x65\162")->save($_0x7ba7, 85);
 return true;
 } catch (\Throwable $_0x3ecc) {
 // Jika ada kendala di library, gunakan fallback native PHP GD
 }
 goto L_12bd4;
 }
}