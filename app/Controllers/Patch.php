<?php
/*   ________________________________________
    |               NextGen Garuda CBT       |
    |    Protected & Distributed via GitHub  |
    |________________________________________|
*/
namespace App\Controllers;

use App\Models\SettingsModel;
use App\Models\DashboardModel;
class Patch extends BaseController
{
 protected $settingsModel;
 protected $dashboardModel;
 protected $db;
 public function __construct()
 {
 goto L_085d4;
 L_085d4:
 $this->settingsModel = new SettingsModel();
 goto L_fd044;
 L_fd044:
 $this->dashboardModel = new DashboardModel();
 goto L_0ddb0;
 L_0ddb0:
 $this->db = \Config\Database::connect();
 goto L_a4ae2;
 L_a4ae2:
 helper(["\x75\162\x6c", "\x66\157\x72\155", "\x66\151\x6c\145\x73\171\x73\164\x65\155"]);
 }
 /**
 * Helper verifikasi hak akses Administrator
 */
 private function isAdmin(): bool
 {
 goto L_9de24;
 L_2e508:
 $_0xc18c = (string) ($_0x3ec9->get("\x72\157\x6c\145\x5f\156\x61\155\x65") ?? '');
 goto L_4a7db;
 L_44caa:
 $_0x2652 = (string) $_0x3ec9->get("\x72\157\x6c\145");
 goto L_2e508;
 L_80e0e:
 if (!$_0x3ec9->get("\x69\163\x5f\154\x6f\147\x69\156")) {
 return false;
 }
 goto L_44caa;
 L_4a7db:
 $_0x3017 = (string) ($_0x3ec9->get("\x6c\145\x76\145\x6c") ?? '');
 goto L_528ac;
 L_9de24:
 $_0x3ec9 = session();
 goto L_80e0e;
 L_528ac:
 return $_0x2652 === "\x31" || strtolower($_0xc18c) === "\x61\144\x6d\151\x6e\151\x73\164\x72\141\x74\157\x72" || strtolower($_0x3017) === "\x61\144\x6d\151\x6e" || $_0x3ec9->get("\x69\163\x5f\141\x64\155\x69\156") === true;
 }
 /**
 * Halaman Utama Patch & Versi Sistem
 */
 public function index()
 {
 goto L_5ad30;
 L_4bbe1:
 $_0x6c24 = is_writable($_0xd7bf);
 goto L_35f37;
 L_3f23a:
 $_0xb184 = is_writable(APPPATH);
 goto L_79963;
 L_7daba:
 // Ambil riwayat patch dari DB
 $_0x87cf = [];
 goto L_67969;
 L_ffe39:
 $_0x1af3 = ["\x66\151\x72\163\x74\137\x6e\141\x6d\145" => $_0x3012->get("\x75\163\x65\162\x6e\141\x6d\145") ?? "\x41\144\x6d\151\x6e", "\x72\157\x6c\145\x5f\156\x61\155\x65" => $_0x3012->get("\x72\157\x6c\145\x5f\156\x61\155\x65") ?? "\x41\144\x6d\151\x6e\151\x73\164\x72\141\x74\157\x72", "\x66\157\x74\157" => $_0x3012->get("\x66\157\x74\157") ?? ''];
 goto L_7daba;
 L_c1c9b:
 $_0x3012 = session();
 goto L_04906;
 L_a1e62:
 // Cek status writable folder
 $_0xd7bf = WRITEPATH . "\x70\141\x74\143\x68\145\x73" . DIRECTORY_SEPARATOR . "\x62\141\x63\153\x75\160\x73" . DIRECTORY_SEPARATOR;
 goto L_822b9;
 L_cfb36:
 $_0x8c3f = defined("\x41\120\x50\137\x56\105\x52\123\x49\117\x4e") ? APP_VERSION : "\x33\56\x30\56\x35";
 goto L_c2e14;
 L_5ad30:
 if (!$this->isAdmin()) {
 return redirect()->to("\x64\141\x73\150\x62\157\x61\162\x64")->with("\x65\162\x72\157\x72", "\x48\141\x6e\171\x61\40\x41\144\x6d\151\x6e\151\x73\164\x72\141\x74\157\x72\40\x79\141\x6e\147\x20\142\x65\162\x68\141\x6b\40\x6d\145\x6e\147\x61\153\x73\145\x73\40\x6d\145\x6e\165\x20\120\x61\164\x63\150");
 }
 goto L_c1c9b;
 L_d7ca5:
 if (is_dir($_0xd7bf)) {
 $_0xca85 = scandir($_0xd7bf);
 foreach ($_0xca85 as $_0x5663) {
 if ($_0x5663 === "\x2e" || $_0x5663 === "\x2e\56" || substr($_0x5663, -4) !== "\x2e\172\x69\160") {
 continue;
 }
 $_0x7f76 = $_0xd7bf . $_0x5663;
 $_0xb0b1[] = ["\x6e\141\x6d\145" => $_0x5663, "\x73\151\x7a\145" => round(filesize($_0x7f76) / 1024, 2) . "\x20\113\x42", "\x74\151\x6d\145" => date("\x59\55\x6d\55\x64\40\x48\72\x69\72\x73", filemtime($_0x7f76))];
 }
 // Sort terbaru lebih dulu
 usort($_0xb0b1, fn($_0x55d0, $_0xde6c) => strcmp($_0xde6c["\x74\151\x6d\145"], $_0x55d0["\x74\151\x6d\145"]));
 }
 goto L_cfb36;
 L_35f37:
 // Scan file backup yang tersimpan di disk
 $_0xb0b1 = [];
 goto L_d7ca5;
 L_67969:
 try {
 $_0x87cf = $this->db->table("\x63\142\x74\137\x70\141\x74\143\x68\137\x68\151\x73\164\x6f\162\x79")->orderBy("\x61\160\x70\154\x69\145\x64\137\x61\164", "\x44\105\x53\103")->get()->getResultArray();
 } catch (\Throwable $_0x34bc) {
 // fallback jika tabel belum siap
 }
 goto L_a1e62;
 L_07267:
 return view("\x73\145\x74\164\x69\156\x67\57\x70\141\x74\143\x68", $_0x274a);
 L_822b9:
 if (!is_dir($_0xd7bf)) {
 @mkdir($_0xd7bf, 0755, true);
 }
 goto L_3f23a;
 L_79963:
 $_0xde78 = is_writable(FCPATH);
 goto L_57c35;
 L_57c35:
 $_0x2f11 = is_writable(WRITEPATH);
 goto L_4bbe1;
 L_04906:
 // Pastikan tabel cbt_patch_history ada beserta kolom-kolomnya
 $this->ensurePatchTable();
 goto L_ffe39;
 L_c2e14:
 $_0x274a = ["\x75\163\x65\162" => $_0x1af3, "\x6a\165\x64\165\x6c" => "\x50\141\x74\143\x68\40\x26\40\x56\145\x72\163\x69\40\x41\160\x6c\151\x6b\141\x73\151", "\x73\165\x62\152\x75\144\x75\154" => "\x4d\141\x6e\141\x6a\145\x6d\145\x6e\40\x50\145\x6d\142\x61\162\x75\141\x6e\40\x53\151\x73\164\x65\155\x2c\40\x42\141\x63\153\x75\160\x20\46\x20\122\x6f\154\x6c\142\x61\143\x6b", "\x73\145\x74\164\x69\156\x67" => $this->dashboardModel->getSetting(), "\x74\160" => $this->dashboardModel->getTahun(), "\x74\160\x5f\141\x63\164\x69\166\x65" => $this->dashboardModel->getTahunActive(), "\x73\155\x74" => $this->dashboardModel->getSemester(), "\x73\155\x74\137\x61\143\x74\151\x76\145" => $this->dashboardModel->getSemesterActive(), "\x63\165\x72\162\x65\156\x74\137\x76\145\x72\163\x69\157\x6e" => $_0x8c3f, "\x70\150\x70\137\x76\145\x72\163\x69\157\x6e" => PHP_VERSION, "\x7a\151\x70\137\x65\156\x61\142\x6c\145\x64" => extension_loaded("\x7a\151\x70"), "\x77\162\x69\164\x61\142\x6c\145\x5f\141\x70\160" => $_0xb184, "\x77\162\x69\164\x61\142\x6c\145\x5f\160\x75\142\x6c\151\x63" => $_0xde78, "\x77\162\x69\164\x61\142\x6c\145\x5f\146\x6f\154\x64\145\x72" => $_0x2f11, "\x77\162\x69\164\x61\142\x6c\145\x5f\142\x61\143\x6b\165\x70" => $_0x6c24, "\x6d\141\x78\137\x75\160\x6c\157\x61\144" => ini_get("\x75\160\x6c\157\x61\144\x5f\155\x61\170\x5f\146\x69\154\x65\163\x69\172\x65"), "\x70\157\x73\164\x5f\155\x61\170" => ini_get("\x70\157\x73\164\x5f\155\x61\170\x5f\163\x69\172\x65"), "\x6d\145\x6d\157\x72\171\x5f\154\x69\155\x69\164" => ini_get("\x6d\145\x6d\157\x72\171\x5f\154\x69\155\x69\164"), "\x6d\141\x78\137\x65\170\x65\143" => ini_get("\x6d\141\x78\137\x65\170\x65\143\x75\164\x69\157\x6e\137\x74\151\x6d\145"), "\x68\151\x73\164\x6f\162\x79" => $_0x87cf, "\x64\151\x73\153\x5f\142\x61\143\x6b\165\x70\163" => $_0xb0b1];
 goto L_07267;
 }
 /**
 * Pratinjau / Validasi File Patch Sebelum Diterapkan (Dry Run)
 */
 public function preview()
 {
 goto L_efd9f;
 L_cf858:
 $_0xc272 = $this->resolveZipStructure($_0xa621, $_0x3add->getClientName());
 goto L_0a4a7;
 L_efd9f:
 if (!$this->isAdmin()) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x41\153\x73\145\x73\40\x64\151\x74\157\x6c\141\x6b\56\x20\123\x65\163\x69\40\x61\144\x6d\151\x6e\151\x73\164\x72\141\x74\157\x72\40\x74\151\x64\141\x6b\40\x73\141\x68\56"]);
 }
 goto L_b1de7;
 L_e490d:
 $_0x6f20 = strtolower($_0x3add->getClientExtension());
 goto L_ff1a9;
 L_80dec:
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => true, "\x6d\141\x6e\151\x66\145\x73\164" => $_0xc272["\x6d\141\x6e\151\x66\145\x73\164"], "\x63\165\x72\162\x65\156\x74\137\x76\145\x72\163\x69\157\x6e" => $_0xd778, "\x74\141\x72\147\x65\164\x5f\166\x65\162\x73\151\x6f\156" => $_0xc272["\x6d\141\x6e\151\x66\145\x73\164"]["\x76\145\x72\163\x69\157\x6e"], "\x76\145\x72\163\x69\157\x6e\137\x77\141\x72\156\x69\156\x67" => $_0x6faf, "\x66\151\x6c\145\x73\137\x63\157\x75\156\x74" => count($_0xc272["\x66\151\x6c\145\x73"]), "\x66\151\x6c\145\x73\137\x74\157\x5f\165\x70\144\x61\164\x65" => $_0xc272["\x66\151\x6c\145\x73\137\x74\157\x5f\165\x70\144\x61\164\x65\137\x63\157\x75\156\x74"], "\x66\151\x6c\145\x73\137\x6e\145\x77" => $_0xc272["\x66\151\x6c\145\x73\137\x6e\145\x77\137\x63\157\x75\156\x74"], "\x68\141\x73\137\x73\161\x6c" => $_0xc272["\x68\141\x73\137\x73\161\x6c"], "\x73\161\x6c\137\x71\165\x65\162\x69\145\x73\137\x63\157\x75\156\x74" => $_0xc272["\x73\161\x6c\137\x71\165\x65\162\x69\145\x73\137\x63\157\x75\156\x74"], "\x75\156\x77\162\x69\164\x61\142\x6c\145\x5f\143\x6f\165\x6e\164" => count($_0xc272["\x75\156\x77\162\x69\164\x61\142\x6c\145\x5f\160\x61\164\x68\163"]), "\x75\156\x77\162\x69\164\x61\142\x6c\145\x5f\160\x61\164\x68\163" => $_0xc272["\x75\156\x77\162\x69\164\x61\142\x6c\145\x5f\160\x61\164\x68\163"], "\x73\141\x6d\160\x6c\145\x5f\146\x69\154\x65\163" => array_slice($_0xc272["\x66\151\x6c\145\x73"], 0, 15)]);
 L_f8e99:
 $_0xbdb4 = $_0xc272["\x6d\141\x6e\151\x66\145\x73\164"]["\x6d\151\x6e\137\x76\145\x72\163\x69\157\x6e"] ?? null;
 goto L_f7ed2;
 L_0a4a7:
 $_0xa621->close();
 goto L_e955d;
 L_250e7:
 $_0xa3e1 = $_0x3add->getTempName();
 goto L_2756d;
 L_f7ed2:
 $_0x6faf = null;
 goto L_d4f83;
 L_05e06:
 if ($_0xa621->open($_0xa3e1) !== true) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x47\141\x67\141\x6c\40\x6d\145\x6d\142\x61\143\x61\40\x61\162\x73\151\x70\40\x5a\111\x50\56\x20\106\x69\154\x65\40\x6d\165\x6e\147\x6b\151\x6e\40\x72\165\x73\141\x6b\40\x61\164\x61\165\x20\153\x6f\162\x75\160\x2e"]);
 }
 goto L_cf858;
 L_84b89:
 $_0xd778 = defined("\x41\120\x50\137\x56\105\x52\123\x49\117\x4e") ? APP_VERSION : "\x33\56\x30\56\x35";
 goto L_f8e99;
 L_e955d:
 if (!$_0xc272["\x73\165\x63\143\x65\163\x73"]) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => $_0xc272["\x65\162\x72\157\x72"]]);
 }
 goto L_84b89;
 L_ff1a9:
 if ($_0x6f20 !== "\x7a\151\x70") {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x46\157\x72\155\x61\164\x20\146\x69\154\x65\40\x68\141\x72\165\x73\40\x62\145\x72\165\x70\141\x20\141\x72\163\x69\160\x20\56\x7a\151\x70"]);
 }
 goto L_250e7;
 L_d059d:
 if (!$_0x3add || !$_0x3add->isValid()) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x46\151\x6c\145\x20\160\x61\164\x63\150\x20\164\x69\144\x61\153\x20\166\x61\154\x69\144\x20\141\x74\141\x75\40\x74\151\x64\141\x6b\40\x64\151\x74\145\x6d\165\x6b\141\x6e\72\x20" . ($_0x3add ? $_0x3add->getErrorString() : "\x4e\157\x20\146\x69\154\x65")]);
 }
 goto L_e490d;
 L_d4f83:
 if ($_0xbdb4 && version_compare($_0xd778, $_0xbdb4, "\x3c")) {
 $_0x6faf = "Peringatan: Patch ini membutuhkan minimal versi CBT v{$_0xbdb4}, sedangkan sistem saat ini adalah v{$_0xd778}.";
 }
 goto L_80dec;
 L_2756d:
 $_0xa621 = new \ZipArchive();
 goto L_05e06;
 L_cbbaa:
 $_0x3add = $this->request->getFile("\x70\141\x74\143\x68\137\x66\151\x6c\145");
 goto L_d059d;
 L_b1de7:
 if (!extension_loaded("\x7a\151\x70")) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x45\153\x73\164\x65\156\x73\151\x20\120\x48\120\x20\132\x69\160\x41\162\x63\150\x69\166\x65\40\x74\151\x64\141\x6b\40\x61\153\x74\151\x66\40\x64\151\x20\163\x65\162\x76\145\x72\40\x69\156\x69\56"]);
 }
 goto L_cbbaa;
 }
 /**
 * Eksekusi Pemasangan Patch (.zip)
 */
 public function apply()
 {
 goto L_f8857;
 L_5cf61:
 if ($_0x31f3->open($_0xb421) !== true) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x47\141\x67\141\x6c\40\x6d\145\x6d\142\x75\153\x61\40\x66\151\x6c\145\x20\132\x49\120\x20\160\x61\164\x63\150\x2e\40\x41\162\x73\151\x70\40\x6d\165\x6e\147\x6b\151\x6e\40\x72\165\x73\141\x6b\56"]);
 }
 goto L_bfb21;
 L_d3cc9:
 @ini_set("\x6d\141\x78\137\x65\170\x65\143\x75\164\x69\157\x6e\137\x74\151\x6d\145", "\x33\60\x30");
 goto L_ec156;
 L_f39fa:
 $_0xcb52 = [];
 goto L_cd1d3;
 L_d1901:
 $_0x54c1 = $this->request->getFile("\x70\141\x74\143\x68\137\x66\151\x6c\145");
 goto L_62316;
 L_ded6e:
 // 5. Catat ke Database Riwayat Patch
 $_0xd464 = session();
 goto L_a40d4;
 L_ee2e7:
 if (!is_dir($_0xb13a)) {
 @mkdir($_0xb13a, 0755, true);
 }
 goto L_d5205;
 L_cebd1:
 if (!empty($_0xdc04["\x66\151\x6c\145\x73\137\x74\157\x5f\142\x61\143\x6b\165\x70"])) {
 $_0xcce1 = new \ZipArchive();
 if ($_0xcce1->open($_0xe2f0, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) === true) {
 // Simpan metadata backup
 $_0xcce1->addFromString("\x62\141\x63\153\x75\160\x5f\155\x65\164\x61\56\x6a\163\x6f\156", json_encode(["\x70\162\x65\166\x5f\166\x65\162\x73\151\x6f\156" => $_0xb0d2, "\x6e\145\x78\164\x5f\166\x65\162\x73\151\x6f\156" => $_0x2847, "\x63\162\x65\141\x74\145\x64\137\x61\164" => date("\x59\55\x6d\55\x64\40\x48\72\x69\72\x73"), "\x66\151\x6c\145\x73\137\x63\157\x75\156\x74" => count($_0xdc04["\x66\151\x6c\145\x73\137\x74\157\x5f\142\x61\143\x6b\165\x70"])], JSON_PRETTY_PRINT));
 foreach ($_0xdc04["\x66\151\x6c\145\x73\137\x74\157\x5f\142\x61\143\x6b\165\x70"] as $_0xbb6c) {
 $_0xcce1->addFile($_0xbb6c["\x66\165\x6c\154\x5f\160\x61\164\x68"], $_0xbb6c["\x72\145\x6c\137\x70\141\x74\150"]);
 }
 $_0xcce1->close();
 }
 }
 goto L_59953;
 L_9b245:
 // 4. Update Versi di Constants.php
 $this->updateAppVersionConstant($_0x2847);
 goto L_ded6e;
 L_f32ee:
 $_0xb0d2 = defined("\x41\120\x50\137\x56\105\x52\123\x49\117\x4e") ? APP_VERSION : "\x33\56\x30\56\x35";
 goto L_2f203;
 L_d5205:
 $_0xeca9 = "\x62\141\x63\153\x75\160\x5f\166" . $_0xb0d2 . "\x5f" . date("\x59\155\x64\137\x48\151\x73") . "\x2e\172\x69\160";
 goto L_6ada3;
 L_06dd0:
 if (!$_0xdc04["\x73\165\x63\143\x65\163\x73"]) {
 $_0x31f3->close();
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => $_0xdc04["\x65\162\x72\157\x72"]]);
 }
 goto L_c8870;
 L_5acd9:
 $_0xb421 = $_0x54c1->getTempName();
 goto L_5ac86;
 L_74982:
 try {
 $this->db->table("\x63\142\x74\137\x70\141\x74\143\x68\137\x68\151\x73\164\x6f\162\x79")->insert(["\x76\145\x72\163\x69\157\x6e" => $_0x2847, "\x70\162\x65\166\x5f\166\x65\162\x73\151\x6f\156" => $_0xb0d2, "\x6e\141\x6d\145" => "\x50\141\x74\143\x68\40\x76" . $_0x2847, "\x64\145\x73\143\x72\151\x70\164\x69\157\x6e" => $_0x8082, "\x61\160\x70\154\x69\145\x64\137\x61\164" => date("\x59\55\x6d\55\x64\40\x48\72\x69\72\x73"), "\x61\160\x70\154\x69\145\x64\137\x62\171" => $_0xd464->get("\x75\163\x65\162\x6e\141\x6d\145") ?? "\x61\144\x6d\151\x6e", "\x66\151\x6c\145\x73\137\x63\157\x75\156\x74" => $_0x2d26, "\x68\141\x73\137\x73\161\x6c" => $_0x255c ? 1 : 0, "\x62\141\x63\153\x75\160\x5f\146\x69\154\x65" => !empty($_0xdc04["\x66\151\x6c\145\x73\137\x74\157\x5f\142\x61\143\x6b\165\x70"]) ? $_0xeca9 : null, "\x6d\141\x6e\151\x66\145\x73\164\x5f\144\x61\164\x61" => json_encode($_0xf5ee), "\x73\164\x61\164\x75\163" => "\x61\160\x70\154\x69\145\x64"]);
 } catch (\Throwable $_0x3ecc) {
 // log error jika ada kendala db
 }
 goto L_3c754;
 L_cd1d3:
 foreach ($_0xdc04["\x66\151\x6c\145\x73"] as $_0xef18) {
 $_0x229f = dirname($_0xef18["\x64\145\x73\164\x5f\160\x61\164\x68"]);
 if (!is_dir($_0x229f)) {
 if (!@mkdir($_0x229f, 0755, true)) {
 $_0xcb52[] = $_0xef18["\x72\145\x6c\137\x70\141\x74\150"] . "\x20\50\x47\141\x67\141\x6c\40\x6d\145\x6d\142\x75\141\x74\40\x66\157\x6c\144\x65\162\x20\164\x75\152\x75\141\x6e\51";
 continue;
 }
 }
 $_0x9e6f = $_0x31f3->getFromName($_0xef18["\x7a\151\x70\137\x6e\141\x6d\145"]);
 if ($_0x9e6f === false) {
 $_0xcb52[] = $_0xef18["\x72\145\x6c\137\x70\141\x74\150"] . "\x20\50\x47\141\x67\141\x6c\40\x6d\145\x6e\147\x65\153\x73\164\x72\141\x6b\40\x69\163\x69\40\x64\141\x72\151\x20\172\x69\160\x29";
 continue;
 }
 // Jika file sudah ada, coba berikan permission tulis
 if (file_exists($_0xef18["\x64\145\x73\164\x5f\160\x61\164\x68"])) {
 @chmod($_0xef18["\x64\145\x73\164\x5f\160\x61\164\x68"], 0666);
 }
 if (@file_put_contents($_0xef18["\x64\145\x73\164\x5f\160\x61\164\x68"], $_0x9e6f) === false) {
 $_0xcb52[] = $_0xef18["\x72\145\x6c\137\x70\141\x74\150"] . "\x20\50\x47\141\x67\141\x6c\40\x6d\145\x6e\165\x6c\151\x73\40\x66\151\x6c\145\x20\55\x20\160\x65\162\x69\153\x73\141\x20\160\x65\162\x6d\151\x73\163\x69\157\x6e\51";
 } else {
 @chmod($_0xef18["\x64\145\x73\164\x5f\160\x61\164\x68"], 0644);
 $_0x2d26++;
 }
 }
 goto L_ae652;
 L_a269f:
 if (!empty($_0xdc04["\x73\161\x6c\137\x65\156\x74\162\x79\137\x6e\141\x6d\145"])) {
 $_0x255c = true;
 $_0xbf14 = $_0x31f3->getFromName($_0xdc04["\x73\161\x6c\137\x65\156\x74\162\x79\137\x6e\141\x6d\145"]);
 if (!empty(trim($_0xbf14))) {
 $_0xb226 = $this->runSqlScript($_0xbf14);
 }
 }
 goto L_201fe;
 L_2f203:
 // 1. Buat Auto-Backup File yang akan Ditimpa
 $_0xb13a = WRITEPATH . "\x70\141\x74\143\x68\145\x73" . DIRECTORY_SEPARATOR . "\x62\141\x63\153\x75\160\x73" . DIRECTORY_SEPARATOR;
 goto L_ee2e7;
 L_dac1d:
 $_0x2847 = $_0xf5ee["\x76\145\x72\163\x69\157\x6e"];
 goto L_f30e5;
 L_6e68e:
 if (!extension_loaded("\x7a\151\x70")) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x45\153\x73\164\x65\156\x73\151\x20\120\x48\120\x20\132\x69\160\x41\162\x63\150\x69\166\x65\40\x74\151\x64\141\x6b\40\x61\153\x74\151\x66\40\x64\151\x20\163\x65\162\x76\145\x72\40\x69\156\x69\56"]);
 }
 goto L_d1901;
 L_62316:
 if (!$_0x54c1 || !$_0x54c1->isValid()) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x46\151\x6c\145\x20\160\x61\164\x63\150\x20\164\x69\144\x61\153\x20\166\x61\154\x69\144\x20\141\x74\141\x75\40\x74\151\x64\141\x6b\40\x64\151\x74\145\x6d\165\x6b\141\x6e\40\x73\141\x61\164\x20\144\x69\165\x6e\147\x67\141\x68\72\x20" . ($_0x54c1 ? $_0x54c1->getErrorString() : "\x4e\157\x20\146\x69\154\x65")]);
 }
 goto L_b0615;
 L_f8857:
 if (!$this->isAdmin()) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x41\153\x73\145\x73\40\x64\151\x74\157\x6c\141\x6b\56\x20\123\x65\163\x69\40\x61\144\x6d\151\x6e\151\x73\164\x72\141\x74\157\x72\40\x74\151\x64\141\x6b\40\x73\141\x68\56"]);
 }
 goto L_d3cc9;
 L_a40d4:
 $this->ensurePatchTable();
 goto L_74982;
 L_c8870:
 $_0xf5ee = $_0xdc04["\x6d\141\x6e\151\x66\145\x73\164"];
 goto L_dac1d;
 L_201fe:
 $_0x31f3->close();
 goto L_9b245;
 L_5ac86:
 $_0x31f3 = new \ZipArchive();
 goto L_5cf61;
 L_ec156:
 @ini_set("\x6d\145\x6d\157\x72\171\x5f\154\x69\155\x69\164", "\x35\61\x32\115");
 goto L_6e68e;
 L_59953:
 // 2. Ekstrak dan Terapkan File ke Direktori Tujuan
 $_0x2d26 = 0;
 goto L_f39fa;
 L_344ee:
 $_0xb226 = null;
 goto L_a269f;
 L_bfb21:
 $_0xdc04 = $this->resolveZipStructure($_0x31f3, $_0x54c1->getClientName());
 goto L_06dd0;
 L_f30e5:
 $_0x8082 = $_0xf5ee["\x64\145\x73\143\x72\151\x70\164\x69\157\x6e"] ?? "\x50\145\x6d\142\x61\162\x75\141\x6e\40\x61\160\x6c\151\x6b\141\x73\151\x20\103\x42\124";
 goto L_f32ee;
 L_6ada3:
 $_0xe2f0 = $_0xb13a . $_0xeca9;
 goto L_cebd1;
 L_ae652:
 // 3. Eksekusi Script SQL (jika ada update.sql)
 $_0x255c = false;
 goto L_344ee;
 L_b0615:
 $_0xc902 = strtolower($_0x54c1->getClientExtension());
 goto L_6cb91;
 L_3c754:
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => true, "\x6d\145\x73\163\x61\147\x65" => "\x50\141\x74\143\x68\40\x76" . $_0x2847 . "\x20\142\x65\162\x68\141\x73\151\x6c\40\x64\151\x74\145\x72\141\x70\153\x61\156\x20\144\x65\156\x67\141\x6e\40\x61\155\x61\156\x21", "\x76\145\x72\163\x69\157\x6e" => $_0x2847, "\x70\162\x65\166\x5f\166\x65\162\x73\151\x6f\156" => $_0xb0d2, "\x66\151\x6c\145\x73\137\x63\157\x75\156\x74" => $_0x2d26, "\x62\141\x63\153\x75\160\x5f\146\x69\154\x65" => !empty($_0xdc04["\x66\151\x6c\145\x73\137\x74\157\x5f\142\x61\143\x6b\165\x70"]) ? $_0xeca9 : "\x54\151\x64\141\x6b\40\x61\144\x61\40\x66\151\x6c\145\x20\154\x61\155\x61\40\x79\141\x6e\147\x20\144\x69\164\x69\155\x70\141", "\x68\141\x73\137\x73\161\x6c" => $_0x255c, "\x73\161\x6c\137\x73\164\x61\164\x75\163" => $_0xb226, "\x66\141\x69\154\x65\144\x5f\146\x69\154\x65\163" => $_0xcb52]);
 L_6cb91:
 if ($_0xc902 !== "\x7a\151\x70") {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x46\157\x72\155\x61\164\x20\146\x69\154\x65\40\x68\141\x72\165\x73\40\x62\145\x72\165\x70\141\x20\141\x72\163\x69\160\x20\56\x7a\151\x70"]);
 }
 goto L_5acd9;
 }
 /**
 * Kembalikan (Rollback) Patch Sebelumnya Menggunakan File Backup
 */
 public function rollback()
 {
 goto L_6b3c9;
 L_cea7e:
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => true, "\x6d\145\x73\163\x61\147\x65" => "\x50\141\x74\143\x68\40\x76" . $_0x363f["\x76\145\x72\163\x69\157\x6e"] . "\x20\142\x65\162\x68\141\x73\151\x6c\40\x64\151\x2d\162\x6f\154\x6c\142\x61\143\x6b\40\x6b\145\x20\166" . $_0xd831 . "\x21", "\x72\145\x76\145\x72\164\x5f\166\x65\162\x73\151\x6f\156" => $_0xd831, "\x72\145\x73\164\x6f\162\x65\144\x5f\146\x69\154\x65\163" => $_0x3370, "\x66\141\x69\154\x65\144\x5f\146\x69\154\x65\163" => $_0x36c3]);
 L_ef548:
 if (!$_0xd831) {
 // Cari versi sebelum patch ini
 $_0x5e12 = $this->db->table("\x63\142\x74\137\x70\141\x74\143\x68\137\x68\151\x73\164\x6f\162\x79")->where("\x69\144\x5f\160\x61\164\x63\150\x20\74", $_0xea70)->where("\x73\164\x61\164\x75\163", "\x61\160\x70\154\x69\145\x64")->orderBy("\x69\144\x5f\160\x61\164\x63\150", "\x44\105\x53\103")->get()->getRowArray();
 $_0xd831 = $_0x5e12 ? $_0x5e12["\x76\145\x72\163\x69\157\x6e"] : "\x33\56\x30\56\x35";
 }
 goto L_9ba91;
 L_d2165:
 if (empty($_0xfb69)) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x50\141\x74\143\x68\40\x69\156\x69\40\x74\151\x64\141\x6b\40\x6d\145\x6d\151\x6c\151\x6b\151\x20\141\x72\163\x69\160\x20\142\x61\143\x6b\165\x70\40\x74\145\x72\163\x69\155\x70\141\x6e\56"]);
 }
 goto L_b2adc;
 L_83bb2:
 $_0x363f = $this->db->table("\x63\142\x74\137\x70\141\x74\143\x68\137\x68\151\x73\164\x6f\162\x79")->where("\x69\144\x5f\160\x61\164\x63\150", $_0xea70)->get()->getRowArray();
 goto L_40b41;
 L_7e44a:
 $_0x36c3 = [];
 goto L_a8fee;
 L_b2adc:
 $_0xfee1 = WRITEPATH . "\x70\141\x74\143\x68\145\x73" . DIRECTORY_SEPARATOR . "\x62\141\x63\153\x75\160\x73" . DIRECTORY_SEPARATOR . basename($_0xfb69);
 goto L_3be1a;
 L_6b3c9:
 if (!$this->isAdmin()) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x41\153\x73\145\x73\40\x64\151\x74\157\x6c\141\x6b\56\x20\123\x65\163\x69\40\x61\144\x6d\151\x6e\151\x73\164\x72\141\x74\157\x72\40\x74\151\x64\141\x6b\40\x73\141\x68\56"]);
 }
 goto L_04843;
 L_9ba91:
 $this->updateAppVersionConstant($_0xd831);
 goto L_ee048;
 L_ca3ba:
 $_0x3370 = 0;
 goto L_7e44a;
 L_4ed44:
 if ($_0x5b44->open($_0xfee1) !== true) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x47\141\x67\141\x6c\40\x6d\145\x6d\142\x75\153\x61\40\x66\151\x6c\145\x20\141\x72\163\x69\160\x20\142\x61\143\x6b\165\x70\56"]);
 }
 goto L_ca3ba;
 L_83830:
 if (empty($_0xea70)) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x49\104\x20\120\x61\164\x63\150\x20\164\x69\144\x61\153\x20\144\x69\164\x65\156\x74\165\x6b\141\x6e\56"]);
 }
 goto L_83bb2;
 L_ee048:
 // Update status riwayat
 $this->db->table("\x63\142\x74\137\x70\141\x74\143\x68\137\x68\151\x73\164\x6f\162\x79")->where("\x69\144\x5f\160\x61\164\x63\150", $_0xea70)->update(["\x73\164\x61\164\x75\163" => "\x72\157\x6c\154\x65\144\x5f\142\x61\143\x6b"]);
 goto L_cea7e;
 L_fb399:
 $_0xfb69 = $_0x363f["\x62\141\x63\153\x75\160\x5f\146\x69\154\x65"];
 goto L_d2165;
 L_40b41:
 if (!$_0x363f) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x44\141\x74\141\x20\162\x69\167\x61\171\x61\164\x20\160\x61\164\x63\150\x20\164\x69\144\x61\153\x20\144\x69\164\x65\155\x75\153\x61\156\x2e"]);
 }
 goto L_fb399;
 L_c2666:
 for ($_0x4141 = 0; $_0x4141 < $_0x5b44->numFiles; $_0x4141++) {
 $_0xc17c = $_0x5b44->statIndex($_0x4141);
 $_0x2ee0 = $_0xc17c["\x6e\141\x6d\145"];
 if ($_0x2ee0 === "\x62\141\x63\153\x75\160\x5f\155\x65\164\x61\56\x6a\163\x6f\156") {
 continue;
 }
 if (substr($_0x2ee0, -1) === "\x2f" || substr($_0x2ee0, -1) === "\x5c") {
 continue;
 }
 $_0xf782 = $this->mapRelativePathToAbsolute($_0x2ee0);
 $_0xf711 = dirname($_0xf782);
 if (!is_dir($_0xf711)) {
 @mkdir($_0xf711, 0755, true);
 }
 $_0x4be1 = $_0x5b44->getFromName($_0x2ee0);
 if ($_0x4be1 === false) {
 $_0x36c3[] = $_0x2ee0 . "\x20\50\x47\141\x67\141\x6c\40\x6d\145\x6d\142\x61\143\x61\40\x69\163\x69\40\x62\141\x63\153\x75\160\x29";
 continue;
 }
 if (file_exists($_0xf782)) {
 @chmod($_0xf782, 0666);
 }
 if (@file_put_contents($_0xf782, $_0x4be1) === false) {
 $_0x36c3[] = $_0x2ee0 . "\x20\50\x47\141\x67\141\x6c\40\x6d\145\x6e\165\x6c\151\x73\40\x66\151\x6c\145\x20\160\x65\155\x75\154\x69\150\x61\156\x29";
 } else {
 @chmod($_0xf782, 0644);
 $_0x3370++;
 }
 }
 goto L_fa82c;
 L_1bb81:
 // Kembalikan nomor versi
 $_0xd831 = !empty($_0x363f["\x70\162\x65\166\x5f\166\x65\162\x73\151\x6f\156"]) ? $_0x363f["\x70\162\x65\166\x5f\166\x65\162\x73\151\x6f\156"] : null;
 goto L_ef548;
 L_04843:
 $_0xea70 = $this->request->getPost("\x69\144\x5f\160\x61\164\x63\150");
 goto L_83830;
 L_fa82c:
 $_0x5b44->close();
 goto L_1bb81;
 L_5cbc3:
 $_0x5b44 = new \ZipArchive();
 goto L_4ed44;
 L_a8fee:
 $_0x92a6 = realpath(ROOTPATH) . DIRECTORY_SEPARATOR;
 goto L_c2666;
 L_3be1a:
 if (!file_exists($_0xfee1)) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x46\151\x6c\145\x20\141\x72\163\x69\160\x20\142\x61\143\x6b\165\x70\40\x74\151\x64\141\x6b\40\x64\151\x74\145\x6d\165\x6b\141\x6e\40\x64\151\x20\163\x65\162\x76\145\x72\72\x20" . $_0xfb69]);
 }
 goto L_5cbc3;
 }
 /**
 * Download file backup arsip sebelum patch
 */
 public function downloadBackup($_0x18ca)
 {
 goto L_e2316;
 L_c272a:
 return redirect()->to("\x70\141\x74\143\x68")->with("\x65\162\x72\157\x72", "\x46\151\x6c\145\x20\142\x61\143\x6b\165\x70\40\x74\151\x64\141\x6b\40\x64\151\x74\145\x6d\165\x6b\141\x6e\56");
 L_d13d1:
 $_0x18ca = basename($_0x18ca);
 goto L_b9826;
 L_e2316:
 if (!$this->isAdmin()) {
 return redirect()->to("\x64\141\x73\150\x62\157\x61\162\x64")->with("\x65\162\x72\157\x72", "\x41\153\x73\145\x73\40\x64\151\x74\157\x6c\141\x6b\56");
 }
 goto L_d13d1;
 L_b9826:
 $_0x9152 = WRITEPATH . "\x70\141\x74\143\x68\145\x73" . DIRECTORY_SEPARATOR . "\x62\141\x63\153\x75\160\x73" . DIRECTORY_SEPARATOR . $_0x18ca;
 goto L_b6ee5;
 L_b6ee5:
 if (file_exists($_0x9152)) {
 return $this->response->download($_0x9152, null);
 }
 goto L_c272a;
 }
 /**
 * Hapus file backup dari server untuk menghemat ruang disk
 */
 public function deleteBackup()
 {
 goto L_ad591;
 L_54b97:
 if (empty($_0xf0a8)) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x4e\141\x6d\141\x20\146\x69\154\x65\40\x74\151\x64\141\x6b\40\x76\141\x6c\151\x64\56"]);
 }
 goto L_57f56;
 L_cac95:
 $_0xf0a8 = basename($this->request->getPost("\x66\151\x6c\145\x6e\141\x6d\145") ?? '');
 goto L_54b97;
 L_ad591:
 if (!$this->isAdmin()) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x41\153\x73\145\x73\40\x64\151\x74\157\x6c\141\x6b\56"]);
 }
 goto L_cac95;
 L_57f56:
 $_0x7f5c = WRITEPATH . "\x70\141\x74\143\x68\145\x73" . DIRECTORY_SEPARATOR . "\x62\141\x63\153\x75\160\x73" . DIRECTORY_SEPARATOR . $_0xf0a8;
 goto L_887ef;
 L_887ef:
 if (file_exists($_0x7f5c)) {
 @unlink($_0x7f5c);
 // Bersihkan nama backup di history jika ada
 try {
 $this->db->table("\x63\142\x74\137\x70\141\x74\143\x68\137\x68\151\x73\164\x6f\162\x79")->where("\x62\141\x63\153\x75\160\x5f\146\x69\154\x65", $_0xf0a8)->update(["\x62\141\x63\153\x75\160\x5f\146\x69\154\x65" => null]);
 } catch (\Throwable $_0x658b) {
 }
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => true, "\x6d\145\x73\163\x61\147\x65" => "\x46\151\x6c\145\x20\142\x61\143\x6b\165\x70\40" . $_0xf0a8 . "\x20\142\x65\162\x68\141\x73\151\x6c\40\x64\151\x68\141\x70\165\x73\56"]);
 }
 goto L_bcc24;
 L_bcc24:
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x46\151\x6c\145\x20\142\x61\143\x6b\165\x70\40\x74\151\x64\141\x6b\40\x64\151\x74\145\x6d\165\x6b\141\x6e\40\x64\151\x20\163\x65\162\x76\145\x72\56"]);
 }
 /**
 * Helper Tool: Buat Paket Patch .ZIP (Untuk Pengembang / Admin)
 */
 public function createPatch()
 {
 goto L_4609b;
 L_65e1e:
 $_0x9a9f = $_0xc0c1 . $_0xdcea;
 goto L_171ae;
 L_10136:
 // 3. Masukkan file-file terpilih
 $_0xc8e1 = 0;
 goto L_c651c;
 L_63e44:
 // 2. Masukkan update.sql jika ada
 if (!empty($_0x9abe)) {
 $_0x4c84->addFromString("\x75\160\x64\141\x74\145\x2e\163\x71\154", $_0x9abe);
 }
 goto L_10136;
 L_171ae:
 $_0x4c84 = new \ZipArchive();
 goto L_5c368;
 L_74c39:
 if (empty($_0x841a)) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x4e\157\x6d\157\x72\40\x76\145\x72\163\x69\40\x77\141\x6a\151\x62\40\x64\151\x69\163\x69\56"]);
 }
 goto L_17610;
 L_0c032:
 $_0xdcea = "\x70\141\x74\143\x68\55\x76" . preg_replace("\x2f\133\x5e\141\x2d\172\x41\55\x5a\60\x2d\71\x5f\134\x2d\134\x2e\135\x2f", '', $_0x841a) . "\x2e\172\x69\160";
 goto L_65e1e;
 L_17610:
 $_0xc0c1 = WRITEPATH . "\x70\141\x74\143\x68\145\x73" . DIRECTORY_SEPARATOR . "\x67\145\x6e\145\x72\141\x74\145\x64" . DIRECTORY_SEPARATOR;
 goto L_82471;
 L_82471:
 if (!is_dir($_0xc0c1)) {
 @mkdir($_0xc0c1, 0755, true);
 }
 goto L_0c032;
 L_4609b:
 if (!$this->isAdmin()) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x41\153\x73\145\x73\40\x64\151\x74\157\x6c\141\x6b\56"]);
 }
 goto L_93761;
 L_ed4df:
 $_0x5cfa = trim($this->request->getPost("\x66\151\x6c\145\x5f\154\x69\163\x74") ?? '');
 goto L_74c39;
 L_02726:
 foreach ($_0x5e46 as $_0x1bd4) {
 $_0x86c1 = trim($_0x1bd4);
 if (empty($_0x86c1)) {
 continue;
 }
 $_0xcede = $this->mapRelativePathToAbsolute($_0x86c1);
 if (file_exists($_0xcede) && !is_dir($_0xcede)) {
 $_0x4c84->addFile($_0xcede, "\x66\151\x6c\145\x73\57" . str_replace("\x5c", "\x2f", $_0x86c1));
 $_0xc8e1++;
 }
 }
 goto L_05a5b;
 L_99cb2:
 $_0x2b5a = trim($this->request->getPost("\x64\145\x73\143\x72\151\x70\164\x69\157\x6e") ?? '');
 goto L_e4042;
 L_d5552:
 $_0x4c84->addFromString("\x6d\141\x6e\151\x66\145\x73\164\x2e\152\x73\157\x6e", json_encode($_0xb755, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
 goto L_63e44;
 L_1e63c:
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => true, "\x6d\145\x73\163\x61\147\x65" => "\x50\141\x6b\145\x74\40\x50\141\x74\143\x68\40\x62\145\x72\150\x61\163\x69\154\x20\144\x69\142\x75\141\x74\41", "\x66\151\x6c\145\x6e\141\x6d\145" => $_0xdcea, "\x66\151\x6c\145\x73\137\x63\157\x75\156\x74" => $_0xc8e1, "\x64\157\x77\156\x6c\157\x61\144\x5f\165\x72\154" => base_url("\x70\141\x74\143\x68\57\x64\157\x77\156\x6c\157\x61\144\x5f\147\x65\156\x65\162\x61\164\x65\144\x2f" . $_0xdcea)]);
 L_5c368:
 if ($_0x4c84->open($_0x9a9f, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) !== true) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x47\141\x67\141\x6c\40\x6d\145\x6d\142\x75\141\x74\40\x66\151\x6c\145\x20\141\x72\163\x69\160\x20\132\x49\120\x2e"]);
 }
 goto L_eb95a;
 L_eb95a:
 // 1. Masukkan manifest.json
 $_0xb755 = ["\x6e\141\x6d\145" => "\x43\102\x54\40\x50\141\x74\143\x68\40\x76" . $_0x841a, "\x76\145\x72\163\x69\157\x6e" => $_0x841a, "\x64\145\x73\143\x72\151\x70\164\x69\157\x6e" => $_0x2b5a, "\x72\145\x6c\145\x61\163\x65\137\x64\141\x74\145" => date("\x59\55\x6d\55\x64\40\x48\72\x69\72\x73"), "\x61\165\x74\150\x6f\162" => session()->get("\x75\163\x65\162\x6e\141\x6d\145") ?? "\x41\144\x6d\151\x6e\40\x43\102\x54"];
 goto L_d5552;
 L_e4042:
 $_0x9abe = trim($this->request->getPost("\x73\161\x6c\137\x71\165\x65\162\x79") ?? '');
 goto L_ed4df;
 L_05a5b:
 $_0x4c84->close();
 goto L_1e63c;
 L_c651c:
 $_0x5e46 = explode("\xa", str_replace("\xd", '', $_0x5cfa));
 goto L_02726;
 L_93761:
 $_0x841a = trim($this->request->getPost("\x76\145\x72\163\x69\157\x6e") ?? '');
 goto L_99cb2;
 }
 /**
 * Download patch hasil generate
 */
 public function downloadGenerated($_0xf14e)
 {
 goto L_aea61;
 L_311ce:
 if (file_exists($_0x6f16)) {
 return $this->response->download($_0x6f16, null);
 }
 goto L_23406;
 L_23406:
 return redirect()->to("\x70\141\x74\143\x68")->with("\x65\162\x72\157\x72", "\x46\151\x6c\145\x20\164\x69\144\x61\153\x20\144\x69\164\x65\155\x75\153\x61\156\x2e");
 L_29402:
 $_0x6f16 = WRITEPATH . "\x70\141\x74\143\x68\145\x73" . DIRECTORY_SEPARATOR . "\x67\145\x6e\145\x72\141\x74\145\x64" . DIRECTORY_SEPARATOR . $_0xf14e;
 goto L_311ce;
 L_aea61:
 if (!$this->isAdmin()) {
 return redirect()->to("\x64\141\x73\150\x62\157\x61\162\x64");
 }
 goto L_68397;
 L_68397:
 $_0xf14e = basename($_0xf14e);
 goto L_29402;
 }
 // =========================================================
 // PRIVATE ENGINE HELPERS
 // =========================================================
 /**
 * Memetakan relative path (misal: app/Controllers/Patch.php) ke Absolute Path server
 */
 private function mapRelativePathToAbsolute(string $_0xdd86): string
 {
 goto L_8c569;
 L_27c07:
 if (strpos($_0x6878, "\x61\160\x70\57") === 0) {
 return APPPATH . str_replace("\x2f", DIRECTORY_SEPARATOR, substr($_0x6878, 4));
 }
 goto L_00564;
 L_2ed2e:
 $_0x6878 = ltrim($_0x1f1e, "\x2f");
 goto L_27c07;
 L_8c569:
 $_0x1f1e = str_replace("\x5c", "\x2f", $_0xdd86);
 goto L_2ed2e;
 L_4069e:
 if (strpos($_0x6878, "\x77\162\x69\164\x61\142\x6c\145\x2f") === 0) {
 return WRITEPATH . str_replace("\x2f", DIRECTORY_SEPARATOR, substr($_0x6878, 9));
 }
 goto L_6594e;
 L_6594e:
 return ROOTPATH . str_replace("\x2f", DIRECTORY_SEPARATOR, $_0x6878);
 L_00564:
 if (strpos($_0x6878, "\x70\165\x62\154\x69\143\x2f") === 0) {
 return FCPATH . str_replace("\x2f", DIRECTORY_SEPARATOR, substr($_0x6878, 7));
 }
 goto L_4069e;
 }
 /**
 * Menganalisis dan menormalisasi struktur ZIP patch
 */
 private function resolveZipStructure(\ZipArchive $_0x32d2, string $_0xa63e): array
 {
 goto L_8645b;
 L_d1dd7:
 for ($_0x58bd = 0; $_0x58bd < $_0x32d2->numFiles; $_0x58bd++) {
 $_0x368e = $_0x32d2->statIndex($_0x58bd);
 $_0x3071 = $_0x368e["\x6e\141\x6d\145"];
 // Skip direktori, macos metadata
 if (substr($_0x3071, -1) === "\x2f" || substr($_0x3071, -1) === "\x5c") {
 continue;
 }
 if (strpos($_0x3071, "\x5f\137\x4d\101\x43\117\x53\130") !== false || basename($_0x3071) === "\x2e\104\x53\137\x53\164\x6f\162\x65") {
 continue;
 }
 // Cek update.sql
 if (basename($_0x3071) === "\x75\160\x64\141\x74\145\x2e\163\x71\154") {
 $_0xe0f1 = $_0x3071;
 $_0x6a7d = $_0x32d2->getFromName($_0x3071);
 if ($_0x6a7d) {
 $_0x6b9b = preg_replace("\x2f\55\x2d\56\x2a\44\x2f\155", '', $_0x6a7d);
 $_0x6b9b = preg_replace("\x2f\43\x2e\52\x24\57\x6d", '', $_0x6b9b);
 $_0x6b9b = preg_replace("\x2f\134\x2f\134\x2a\56\x2a\77\x5c\52\x5c\57\x2f\163", '', $_0x6b9b);
 $_0x7cf0 = array_filter(array_map("\x74\162\x69\155", explode("\x3b", $_0x6b9b)));
 $_0x6131 = count($_0x7cf0);
 }
 continue;
 }
 // Skip manifest.json
 if (basename($_0x3071) === "\x6d\141\x6e\151\x66\145\x73\164\x2e\152\x73\157\x6e") {
 continue;
 }
 // Normalisasi path
 $_0xd717 = str_replace("\x5c", "\x2f", $_0x3071);
 // Hilangkan prefix folder pembungkus jika ada
 if (!empty($_0x1597) && strpos($_0xd717, $_0x1597) === 0) {
 $_0xd717 = substr($_0xd717, strlen($_0x1597));
 }
 // Hilangkan prefix files/ jika ada
 if (strpos($_0xd717, "\x66\151\x6c\145\x73\57") === 0) {
 $_0xd717 = substr($_0xd717, 6);
 }
 // Validasi Keamanan Path Traversal
 if (strpos($_0xd717, "\x2e\56") !== false || strpos($_0xd717, "\x3a") !== false) {
 return ["\x73\165\x63\143\x65\163\x73" => false, "\x65\162\x72\157\x72" => "\x4b\145\x61\155\x61\156\x61\156\x3a\40\x54\145\x72\144\x65\164\x65\153\x73\151\x20\165\x70\141\x79\141\x20\152\x61\154\x75\162\x20\144\x69\162\x65\153\x74\157\x72\151\x20\164\x69\144\x61\153\x20\141\x6d\141\x6e\40\x28" . $_0xd717 . "\x29"];
 }
 $_0xbf17 = $this->mapRelativePathToAbsolute($_0xd717);
 $_0x5e15 = file_exists($_0xbf17);
 if ($_0x5e15) {
 $_0xb3fb++;
 $_0xe8e2[] = ["\x72\145\x6c\137\x70\141\x74\150" => $_0xd717, "\x66\165\x6c\154\x5f\160\x61\164\x68" => $_0xbf17];
 if (!is_writable($_0xbf17)) {
 $_0xd9ac[] = $_0xd717 . "\x20\50\x46\151\x6c\145\x20\164\x69\144\x61\153\x20\144\x61\160\x61\164\x20\144\x69\164\x75\154\x69\163\x29";
 }
 } else {
 $_0xb7cb++;
 $_0x16a5 = dirname($_0xbf17);
 // Cek apakah direktori induk bisa dibuat / ditulis
 $_0x5766 = $_0x16a5;
 while (!is_dir($_0x5766) && strlen($_0x5766) > 3) {
 $_0x5766 = dirname($_0x5766);
 }
 if (is_dir($_0x5766) && !is_writable($_0x5766)) {
 $_0xd9ac[] = $_0xd717 . "\x20\50\x44\151\x72\145\x6b\164\x6f\162\x69\40\x69\156\x64\165\x6b\40\x74\151\x64\141\x6b\40\x64\141\x70\141\x74\40\x64\151\x74\165\x6c\151\x73\72\x20" . basename($_0x5766) . "\x29";
 }
 }
 $_0x63c3[] = ["\x7a\151\x70\137\x6e\141\x6d\145" => $_0x3071, "\x72\145\x6c\137\x70\141\x74\150" => $_0xd717, "\x64\145\x73\164\x5f\160\x61\164\x68" => $_0xbf17, "\x69\163\x5f\165\x70\144\x61\164\x65" => $_0x5e15, "\x73\151\x7a\145" => $_0x368e["\x73\151\x7a\145"] ?? 0];
 }
 goto L_f24f8;
 L_02366:
 $_0xe8e2 = [];
 goto L_92389;
 L_810e8:
 $_0x1597 = '';
 goto L_b1e7e;
 L_92389:
 $_0xd9ac = [];
 goto L_21692;
 L_a2aba:
 $_0x7c5c = [];
 goto L_ce496;
 L_29324:
 // Jika manifest tidak ditemukan, buat fallback cerdas
 if (!$_0x7c5c || empty($_0x7c5c["\x76\145\x72\163\x69\157\x6e"])) {
 // Ambil nomor versi dari nama file patch (contoh: patch-v3.0.6.zip -> 3.0.6)
 preg_match("\x2f\166\x3f\50\x5c\144\x2b\134\x2e\134\x64\53\x28\134\x2e\134\x64\53\x29\77\x29\57\x69", $_0xa63e, $_0x81a9);
 $_0x8d9c = $_0x81a9[1] ?? (defined("\x41\120\x50\137\x56\105\x52\123\x49\117\x4e") ? APP_VERSION . "\x2d\160\x61\164\x63\150" : "\x33\56\x30\56\x36\55\x70\141\x74\143\x68");
 $_0x7c5c = ["\x76\145\x72\163\x69\157\x6e" => $_0x8d9c, "\x6e\141\x6d\145" => "\x50\141\x74\143\x68\40" . $_0xa63e, "\x64\145\x73\143\x72\151\x70\164\x69\157\x6e" => "\x50\145\x6d\142\x61\162\x75\141\x6e\40\x6f\164\x6f\155\x61\164\x69\163\x20\144\x61\162\x69\40\x70\141\x6b\145\x74\40\x61\162\x73\151\x70\40" . $_0xa63e, "\x72\145\x6c\145\x61\163\x65\137\x64\141\x74\145" => date("\x59\55\x6d\55\x64")];
 }
 goto L_3793d;
 L_3793d:
 // 2. Kumpulkan file yang akan diekstrak
 $_0x63c3 = [];
 goto L_02366;
 L_09667:
 $_0x6131 = 0;
 goto L_d1dd7;
 L_eb72c:
 return ["\x73\165\x63\143\x65\163\x73" => true, "\x6d\141\x6e\151\x66\145\x73\164" => $_0x7c5c, "\x66\151\x6c\145\x73" => $_0x63c3, "\x66\151\x6c\145\x73\137\x74\157\x5f\142\x61\143\x6b\165\x70" => $_0xe8e2, "\x66\151\x6c\145\x73\137\x74\157\x5f\165\x70\144\x61\164\x65\137\x63\157\x75\156\x74" => $_0xb3fb, "\x66\151\x6c\145\x73\137\x6e\145\x77\137\x63\157\x75\156\x74" => $_0xb7cb, "\x68\141\x73\137\x73\161\x6c" => !empty($_0xe0f1), "\x73\161\x6c\137\x65\156\x74\162\x79\137\x6e\141\x6d\145" => $_0xe0f1, "\x73\161\x6c\137\x71\165\x65\162\x69\145\x73\137\x63\157\x75\156\x74" => $_0x6131, "\x75\156\x77\162\x69\164\x61\142\x6c\145\x5f\160\x61\164\x68\163" => $_0xd9ac];
 L_8b380:
 $_0xe0f1 = null;
 goto L_09667;
 L_ce496:
 if ($_0x7922) {
 $_0x33cc = $_0x32d2->getFromName($_0x7922);
 $_0x7c5c = json_decode($_0x33cc, true);
 }
 goto L_29324;
 L_036ad:
 $_0xb7cb = 0;
 goto L_8b380;
 L_f24f8:
 if (empty($_0x63c3) && empty($_0xe0f1)) {
 return ["\x73\165\x63\143\x65\163\x73" => false, "\x65\162\x72\157\x72" => "\x50\141\x6b\145\x74\40\x5a\111\x50\40\x74\151\x64\141\x6b\40\x62\145\x72\151\x73\151\x20\146\x69\154\x65\40\x61\160\x6c\151\x6b\141\x73\151\x20\171\x61\156\x67\40\x76\141\x6c\151\x64\40\x61\164\x61\165\x20\163\x6b\162\x69\160\x20\144\x61\164\x61\142\x61\163\x65\56"];
 }
 goto L_eb72c;
 L_8645b:
 // 1. Cari manifest.json (bisa di root atau dalam subfolder)
 $_0x7922 = null;
 goto L_810e8;
 L_b1e7e:
 for ($_0x58bd = 0; $_0x58bd < $_0x32d2->numFiles; $_0x58bd++) {
 $_0x47a5 = $_0x32d2->getNameIndex($_0x58bd);
 if (basename($_0x47a5) === "\x6d\141\x6e\151\x66\145\x73\164\x2e\152\x73\157\x6e" && strpos($_0x47a5, "\x5f\137\x4d\101\x43\117\x53\130") === false) {
 $_0x7922 = $_0x47a5;
 $_0x1597 = dirname($_0x47a5);
 if ($_0x1597 === "\x2e" || $_0x1597 === "\x2f" || $_0x1597 === "\x5c") {
 $_0x1597 = '';
 } else {
 $_0x1597 = rtrim(str_replace("\x5c", "\x2f", $_0x1597), "\x2f") . "\x2f";
 }
 break;
 }
 }
 goto L_a2aba;
 L_21692:
 $_0xb3fb = 0;
 goto L_036ad;
 }
 /**
 * Memastikan tabel cbt_patch_history memiliki struktur mutakhir
 */
 private function ensurePatchTable()
 {
 try {
 $this->db->query("\x43\122\x45\101\x54\105\x20\124\x41\102\x4c\105\x20\111\x46\40\x4e\117\x54\40\x45\130\x49\123\x54\123\x20\140\x63\142\x74\137\x70\141\x74\143\x68\137\x68\151\x73\164\x6f\162\x79\140\x20\50\xa\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\140\x69\144\x5f\160\x61\164\x63\150\x60\40\x49\116\x54\40\x41\125\x54\117\x5f\111\x4e\103\x52\105\x4d\105\x4e\124\x20\120\x52\111\x4d\101\x52\131\x20\113\x45\131\x2c\12\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x60\166\x65\162\x73\151\x6f\156\x60\40\x56\101\x52\103\x48\101\x52\50\x35\60\x29\40\x4e\117\x54\40\x4e\125\x4c\114\x2c\12\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x60\160\x72\145\x76\137\x76\145\x72\163\x69\157\x6e\140\x20\126\x41\122\x43\110\x41\122\x28\65\x30\51\x20\104\x45\106\x41\125\x4c\124\x20\116\x55\114\x4c\54\xa\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\140\x6e\141\x6d\145\x60\40\x56\101\x52\103\x48\101\x52\50\x31\65\x30\51\x20\104\x45\106\x41\125\x4c\124\x20\116\x55\114\x4c\54\xa\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\140\x64\145\x73\143\x72\151\x70\164\x69\157\x6e\140\x20\124\x45\130\x54\54\xa\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\140\x61\160\x70\154\x69\145\x64\137\x61\164\x60\40\x44\101\x54\105\x54\111\x4d\105\x20\116\x4f\124\x20\116\x55\114\x4c\54\xa\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\140\x61\160\x70\154\x69\145\x64\137\x62\171\x60\40\x56\101\x52\103\x48\101\x52\50\x31\60\x30\51\x20\104\x45\106\x41\125\x4c\124\x20\116\x55\114\x4c\54\xa\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\140\x66\151\x6c\145\x73\137\x63\157\x75\156\x74\140\x20\111\x4e\124\x20\104\x45\106\x41\125\x4c\124\x20\60\x2c\12\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x60\150\x61\163\x5f\163\x71\154\x60\40\x54\111\x4e\131\x49\116\x54\50\x31\51\x20\104\x45\106\x41\125\x4c\124\x20\60\x2c\12\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x60\142\x61\143\x6b\165\x70\137\x66\151\x6c\145\x60\40\x56\101\x52\103\x48\101\x52\50\x32\65\x35\51\x20\104\x45\106\x41\125\x4c\124\x20\116\x55\114\x4c\54\xa\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\140\x6d\141\x6e\151\x66\145\x73\164\x5f\144\x61\164\x61\140\x20\114\x4f\116\x47\124\x45\130\x54\40\x44\105\x46\101\x55\114\x54\40\x4e\125\x4c\114\x2c\12\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x60\163\x74\141\x74\165\x73\140\x20\126\x41\122\x43\110\x41\122\x28\62\x30\51\x20\104\x45\106\x41\125\x4c\124\x20\47\x61\160\x70\154\x69\145\x64\47\xa\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\51\x20\105\x4e\107\x49\116\x45\75\x49\156\x6e\157\x44\102\x20\104\x45\106\x41\125\x4c\124\x20\103\x48\101\x52\123\x45\124\x3d\165\x74\146\x38\155\x62\64\x3b");
 // Periksa jika tabel lama belum memiliki kolom prev_version atau status
 $_0x999c = $this->db->getFieldNames("\x63\142\x74\137\x70\141\x74\143\x68\137\x68\151\x73\164\x6f\162\x79");
 if (!in_array("\x70\162\x65\166\x5f\166\x65\162\x73\151\x6f\156", $_0x999c)) {
 @$this->db->query("\x41\114\x54\105\x52\40\x54\101\x42\114\x45\40\x60\143\x62\164\x5f\160\x61\164\x63\150\x5f\150\x69\163\x74\157\x72\171\x60\40\x41\104\x44\40\x43\117\x4c\125\x4d\116\x20\140\x70\162\x65\166\x5f\166\x65\162\x73\151\x6f\156\x60\40\x56\101\x52\103\x48\101\x52\50\x35\60\x29\40\x44\105\x46\101\x55\114\x54\40\x4e\125\x4c\114\x20\101\x46\124\x45\122\x20\140\x76\145\x72\163\x69\157\x6e\140\x3b");
 }
 if (!in_array("\x73\164\x61\164\x75\163", $_0x999c)) {
 @$this->db->query("\x41\114\x54\105\x52\40\x54\101\x42\114\x45\40\x60\143\x62\164\x5f\160\x61\164\x63\150\x5f\150\x69\163\x74\157\x72\171\x60\40\x41\104\x44\40\x43\117\x4c\125\x4d\116\x20\140\x73\164\x61\164\x75\163\x60\40\x56\101\x52\103\x48\101\x52\50\x32\60\x29\40\x44\105\x46\101\x55\114\x54\40\x27\141\x70\160\x6c\151\x65\144\x27\40\x41\106\x54\105\x52\40\x60\155\x61\156\x69\146\x65\163\x74\137\x64\141\x74\141\x60\73");
 }
 } catch (\Throwable $_0x9d99) {
 // Ignore jika tabel sudah ada atau database read-only
 }
 }
 /**
 * Memperbarui konstanta APP_VERSION di Constants.php
 */
 private function updateAppVersionConstant(string $_0xdc52): bool
 {
 goto L_0a077;
 L_b442a:
 if (preg_match($_0x73d4, $_0xa3c7)) {
 $_0xec28 = preg_replace($_0x73d4, "\x24\173\x31\175" . $_0xdc52 . "\x24\173\x32\175", $_0xa3c7);
 $_0x94dd = @file_put_contents($_0x682a, $_0xec28);
 @chmod($_0x682a, 0644);
 return $_0x94dd !== false;
 }
 goto L_d3854;
 L_d3854:
 return false;
 L_0a077:
 $_0x682a = APPPATH . "\x43\157\x6e\146\x69\147" . DIRECTORY_SEPARATOR . "\x43\157\x6e\163\x74\141\x6e\164\x73\56\x70\150\x70";
 goto L_a590f;
 L_a590f:
 if (!is_writable($_0x682a)) {
 @chmod($_0x682a, 0666);
 }
 goto L_eb701;
 L_eb701:
 if (!is_writable($_0x682a)) {
 return false;
 }
 goto L_8c84f;
 L_8c84f:
 $_0xa3c7 = file_get_contents($_0x682a);
 goto L_a52ad;
 L_a52ad:
 $_0x73d4 = "\x2f\50\x64\145\x66\151\x6e\145\x64\134\x28\47\x41\120\x50\137\x56\105\x52\123\x49\117\x4e\47\x5c\51\x5c\163\x2a\134\x7c\134\x7c\134\x73\52\x64\145\x66\151\x6e\145\x5c\50\x27\101\x50\120\x5f\126\x45\122\x53\111\x4f\116\x27\54\x5c\163\x2a\47\x29\133\x5e\47\x5d\53\x28\47\x5c\51\x3b\51\x2f";
 goto L_b442a;
 }
 /**
 * Eksekusi script SQL yang terpecah secara aman
 */
 private function runSqlScript(string $_0xafe5): array
 {
 goto L_a4cc1;
 L_ad0b7:
 return ["\x65\170\x65\143\x75\164\x65\144" => $_0xc955, "\x65\162\x72\157\x72\163" => $_0x5771];
 L_215bc:
 foreach ($_0x57dd as $_0x88eb) {
 $_0x88eb = trim($_0x88eb);
 if (empty($_0x88eb)) {
 continue;
 }
 try {
 $this->db->query($_0x88eb);
 $_0xc955++;
 } catch (\Throwable $_0x6a8c) {
 // Jangan gagal fatal jika error adalah Duplicate column name atau Table already exists
 $_0xb2b1 = $_0x6a8c->getMessage();
 if (stripos($_0xb2b1, "\x44\165\x70\154\x69\143\x61\164\x65\40\x63\157\x6c\165\x6d\156") !== false || stripos($_0xb2b1, "\x61\154\x72\145\x61\144\x79\40\x65\170\x69\163\x74\163") !== false) {
 $_0xc955++;
 } else {
 $_0x5771[] = $_0xb2b1;
 }
 }
 }
 goto L_ad0b7;
 L_591ab:
 $_0x57dd = array_filter(array_map("\x74\162\x69\155", explode("\x3b", $_0x5dfe)));
 goto L_f5fcd;
 L_4c27d:
 $_0x5dfe = preg_replace("\x2f\134\x2f\134\x2a\56\x2a\77\x5c\52\x5c\57\x2f\163", '', $_0x5dfe);
 goto L_591ab;
 L_a1dbc:
 $_0x5dfe = preg_replace("\x2f\43\x2e\52\x24\57\x6d", '', $_0x5dfe);
 goto L_4c27d;
 L_a4cc1:
 $_0x5dfe = preg_replace("\x2f\55\x2d\56\x2a\44\x2f\155", '', $_0xafe5);
 goto L_a1dbc;
 L_7c897:
 $_0x5771 = [];
 goto L_215bc;
 L_f5fcd:
 $_0xc955 = 0;
 goto L_7c897;
 }
}