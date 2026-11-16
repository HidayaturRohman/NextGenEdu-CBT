<?php
/*   ________________________________________
    |               NextGen Garuda CBT       |
    |    Protected & Distributed via GitHub  |
    |________________________________________|
*/
namespace App\Controllers;

use App\Models\SettingsModel;
use App\Models\DashboardModel;
use CodeIgniter\Files\File;
class Settings extends BaseController
{
 protected $settingsModel;
 protected $dashboardModel;
 public function __construct()
 {
 $this->settingsModel = new SettingsModel();
 $this->dashboardModel = new DashboardModel();
 }
 /**
 * Dapatkan semua kemungkinan direktori upload settings di berbagai konfigurasi webserver.
 */
 private function getUploadDirectories()
 {
 $_0x3afe = [rtrim(FCPATH, "\x2f\134") . "\x2f\165\x70\154\x6f\141\x64\163\x2f\163\x65\164\x74\151\x6e\147\x73\57", rtrim(ROOTPATH, "\x2f\134") . "\x2f\165\x70\154\x6f\141\x64\163\x2f\163\x65\164\x74\151\x6e\147\x73\57", rtrim(ROOTPATH, "\x2f\134") . "\x2f\160\x75\142\x6c\151\x63\57\x75\160\x6c\157\x61\144\x73\57\x73\145\x74\164\x69\156\x67\163\x2f"];
 return array_values(array_unique(array_filter($_0x3afe)));
 }
 /**
 * Pastikan path logo/tanda tangan di tabel setting menunjuk file yang benar-benar ada.
 * Jika file ada di salah satu direktori, sinkronkan ke semua direktori lain dan perbaiki DB.
 */
 private function healLogoPaths($_0x5106)
 {
 goto L_f9788;
 L_8ae17:
 foreach ($_0x851f as $_0xb8cb => $_0x7bad) {
 $_0x1977 = ltrim((string) ($_0x5106->{$_0xb8cb} ?? ''), "\x2f");
 $_0x73f0 = null;
 $_0x9a8d = null;
 if ($_0x1977 !== '' && $_0x1977 !== "\x75\160\x6c\157\x61\144\x73\57\x73\145\x74\164\x69\156\x67\163" && $_0x1977 !== "\x75\160\x6c\157\x61\144\x73\57\x73\145\x74\164\x69\156\x67\163\x2f") {
 $_0x85a0 = basename($_0x1977);
 foreach ($_0x4322 as $_0x1264) {
 if (is_file($_0x1264 . $_0x85a0) && filesize($_0x1264 . $_0x85a0) > 0) {
 $_0x73f0 = $_0x1264 . $_0x85a0;
 $_0x9a8d = "\x75\160\x6c\157\x61\144\x73\57\x73\145\x74\164\x69\156\x67\163\x2f" . $_0x85a0;
 break;
 }
 }
 }
 if (!$_0x73f0) {
 foreach (array_unique([$_0x7bad, $_0xb8cb]) as $_0xade3) {
 foreach ($_0x4322 as $_0x1264) {
 $_0xbb5a = glob($_0x1264 . $_0xade3 . "\x2a");
 if ($_0xbb5a) {
 usort($_0xbb5a, function ($_0xbcb3, $_0x3062) {
 return filemtime($_0x3062) - filemtime($_0xbcb3);
 });
 foreach ($_0xbb5a as $_0x1f06) {
 if (is_file($_0x1f06) && filesize($_0x1f06) > 0) {
 $_0x73f0 = $_0x1f06;
 $_0x9a8d = "\x75\160\x6c\157\x61\144\x73\57\x73\145\x74\164\x69\156\x67\163\x2f" . basename($_0x1f06);
 break 3;
 }
 }
 }
 }
 }
 }
 if ($_0x73f0) {
 $_0x85a0 = basename($_0x73f0);
 foreach ($_0x4322 as $_0x1264) {
 if (!is_file($_0x1264 . $_0x85a0)) {
 if (!is_dir($_0x1264)) {
 @mkdir($_0x1264, 0777, true);
 }
 @copy($_0x73f0, $_0x1264 . $_0x85a0);
 }
 }
 if ($_0x1977 !== $_0x9a8d) {
 $_0x3bc1[$_0xb8cb] = $_0x9a8d;
 $_0x5106->{$_0xb8cb} = $_0x9a8d;
 }
 }
 }
 goto L_8d181;
 L_8d181:
 if (!empty($_0x3bc1)) {
 try {
 \Config\Database::connect()->table("\x73\145\x74\164\x69\156\x67")->where("\x69\144\x5f\163\x65\164\x74\151\x6e\147", 1)->update($_0x3bc1);
 \App\Models\DashboardModel::clearStaticCache();
 } catch (\Throwable $_0x34bc) {
 }
 }
 goto L_0889e;
 L_45eb4:
 $_0x4322 = $this->getUploadDirectories();
 goto L_7cac5;
 L_f9788:
 if (!$_0x5106) {
 return $_0x5106;
 }
 goto L_4e691;
 L_0889e:
 return $_0x5106;
 L_4e691:
 $_0x851f = ["\x6c\157\x67\157\x5f\153\x69\162\x69" => "\x6c\157\x67\157\x5f\153\x69\162\x69", "\x6c\157\x67\157\x5f\153\x61\156\x61\156" => "\x6c\157\x67\157\x5f\153\x61\156\x61\156", "\x74\141\x6e\144\x61\137\x74\141\x6e\147\x61\156" => "\x74\141\x6e\144\x61\164\x61\156\x67\141\x6e"];
 goto L_45eb4;
 L_7cac5:
 $_0x3bc1 = [];
 goto L_8ae17;
 }
 public function index()
 {
 goto L_2772b;
 L_5507a:
 $_0x274a = ["\x75\163\x65\162" => $_0xc0d6, "\x6a\165\x64\165\x6c" => "\x50\162\x6f\146\x69\154\x65\40\x53\145\x6b\157\x6c\141\x68", "\x73\165\x62\152\x75\144\x75\154" => '', "\x70\162\x6f\146\x69\154\x65" => null, "\x73\145\x74\164\x69\156\x67" => $this->healLogoPaths($this->dashboardModel->getSetting()), "\x74\160" => $this->dashboardModel->getTahun(), "\x74\160\x5f\141\x63\164\x69\166\x65" => $this->dashboardModel->getTahunActive(), "\x73\155\x74" => $this->dashboardModel->getSemester(), "\x73\155\x74\137\x61\143\x74\151\x76\145" => $this->dashboardModel->getSemesterActive()];
 goto L_ba110;
 L_2772b:
 $_0x5476 = session();
 goto L_5237d;
 L_5237d:
 if (!$_0x5476->get("\x69\163\x5f\154\x6f\147\x69\156")) {
 return redirect()->to("\x61\165\x74\150\x2f\154\x6f\147\x69\156");
 }
 goto L_ec69e;
 L_ec69e:
 if ($_0x5476->get("\x72\157\x6c\145") != "\x31") {
 return redirect()->to("\x64\141\x73\150\x62\157\x61\162\x64")->with("\x65\162\x72\157\x72", "\x48\141\x6e\171\x61\40\x41\144\x6d\151\x6e\151\x73\164\x72\141\x74\157\x72\40\x79\141\x6e\147\x20\142\x6f\154\x65\150\x20\155\x65\156\x67\141\x6b\163\x65\163\x20\150\x61\154\x61\155\x61\156\x20\151\x6e\151");
 }
 goto L_30a27;
 L_ba110:
 return view("\x73\145\x74\164\x69\156\x67\57\x64\141\x74\141", $_0x274a);
 L_30a27:
 $_0xc0d6 = ["\x66\151\x72\163\x74\137\x6e\141\x6d\145" => $_0x5476->get("\x75\163\x65\162\x6e\141\x6d\145"), "\x72\157\x6c\145\x5f\156\x61\155\x65" => $_0x5476->get("\x72\157\x6c\145\x5f\156\x61\155\x65"), "\x66\157\x74\157" => $_0x5476->get("\x66\157\x74\157") ?? ''];
 goto L_5507a;
 }
 public function dbManager()
 {
 goto L_38617;
 L_e3581:
 if (!$_0x2371->get("\x69\163\x5f\154\x6f\147\x69\156")) {
 return redirect()->to("\x61\165\x74\150\x2f\154\x6f\147\x69\156");
 }
 goto L_508cf;
 L_73466:
 $_0x4142 = FCPATH . "\x62\141\x63\153\x75\160\x73\57";
 goto L_66c40;
 L_3e6aa:
 $_0x91ee = [];
 goto L_06efe;
 L_06efe:
 if (is_dir($_0x4142)) {
 $_0x91c2 = array_diff(scandir($_0x4142), ["\x2e", "\x2e\56", "\x2e\150\x74\141\x63\143\x65\163\x73"]);
 foreach ($_0x91c2 as $_0xd6e8) {
 $_0x8bdf = $_0x4142 . $_0xd6e8;
 if (is_file($_0x8bdf)) {
 $_0x783f = pathinfo($_0xd6e8);
 $_0x6696 = strtolower($_0x783f["\x65\170\x74\145\x6e\163\x69\157\x6e"] ?? '');
 if (!in_array($_0x6696, ["\x73\161\x6c", "\x7a\151\x70"])) {
 continue;
 }
 $_0x91ee[] = ["\x6e\141\x6d\141" => $_0x783f["\x66\151\x6c\145\x6e\141\x6d\145"], "\x74\171\x70\145" => $_0x6696, "\x6b\141\x74\145\x67\157\x72\151" => $_0x6696 === "\x73\161\x6c" ? "\x44\141\x74\141\x62\141\x73\145\x20\50\x2e\163\x71\154\x29" : "\x42\145\x72\153\x61\163\x20\125\x70\154\x6f\141\x64\40\x28\56\x7a\151\x70\51", "\x73\151\x7a\145" => $this->formatBytes(filesize($_0x8bdf)), "\x74\147\x6c" => filemtime($_0x8bdf), "\x73\162\x63" => $_0xd6e8];
 }
 }
 }
 goto L_7106b;
 L_7106b:
 usort($_0x91ee, function ($_0x774b, $_0x539d) {
 return $_0x539d["\x74\147\x6c"] <=> $_0x774b["\x74\147\x6c"];
 });
 goto L_04a8e;
 L_04a8e:
 $_0x6ca0 = ["\x75\163\x65\162" => ["\x66\151\x72\163\x74\137\x6e\141\x6d\145" => $_0x2371->get("\x75\163\x65\162\x6e\141\x6d\145"), "\x72\157\x6c\145\x5f\156\x61\155\x65" => $_0x2371->get("\x72\157\x6c\145\x5f\156\x61\155\x65"), "\x66\157\x74\157" => $_0x2371->get("\x66\157\x74\157") ?? ''], "\x6a\165\x64\165\x6c" => "\x42\141\x63\153\x75\160\x20\144\x61\156\x20\122\x65\163\x74\157\x72\145", "\x73\165\x62\152\x75\144\x75\154" => "\x42\141\x63\153\x75\160\x20\144\x61\156\x20\122\x65\163\x74\157\x72\145", "\x74\160" => $this->dashboardModel->getTahun(), "\x74\160\x5f\141\x63\164\x69\166\x65" => $this->dashboardModel->getTahunActive(), "\x73\155\x74" => $this->dashboardModel->getSemester(), "\x73\155\x74\137\x61\143\x74\151\x76\145" => $this->dashboardModel->getSemesterActive(), "\x73\145\x74\164\x69\156\x67" => $this->settingsModel->getSetting(), "\x6c\151\x73\164" => $_0x91ee];
 goto L_a575b;
 L_66c40:
 if (!is_dir($_0x4142)) {
 @mkdir($_0x4142, 0777, true);
 }
 goto L_af1f6;
 L_ad9db:
 if (!file_exists($_0x3341)) {
 @file_put_contents($_0x3341, "\x4f\162\x64\145\x72\40\x44\145\x6e\171\x2c\101\x6c\154\x6f\167\xa\104\x65\156\x79\40\x66\162\x6f\155\x20\141\x6c\154\xa");
 }
 goto L_3e6aa;
 L_a575b:
 return view("\x73\145\x74\164\x69\156\x67\57\x64\142", $_0x6ca0);
 L_38617:
 $_0x2371 = session();
 goto L_e3581;
 L_508cf:
 if ($_0x2371->get("\x72\157\x6c\145") != "\x31") {
 return redirect()->to("\x64\141\x73\150\x62\157\x61\162\x64")->with("\x65\162\x72\157\x72", "\x48\141\x6e\171\x61\40\x41\144\x6d\151\x6e\151\x73\164\x72\141\x74\157\x72");
 }
 goto L_73466;
 L_af1f6:
 // Pasang .htaccess di direktori backups agar file backup tidak bisa diakses publik secara bebas
 $_0x3341 = $_0x4142 . "\x2e\150\x74\141\x63\143\x65\163\x73";
 goto L_ad9db;
 }
 public function backupDb()
 {
 goto L_a777b;
 L_5ed0d:
 try {
 $_0x17e4 = \Config\Database::connect();
 $_0xae7f = $_0x17e4->listTables();
 $_0xc63d = FCPATH . "\x62\141\x63\153\x75\160\x73\57";
 if (!is_dir($_0xc63d)) {
 @mkdir($_0xc63d, 0777, true);
 }
 $_0x342c = $_0xc63d . "\x2e\150\x74\141\x63\143\x65\163\x73";
 if (!file_exists($_0x342c)) {
 @file_put_contents($_0x342c, "\x4f\162\x64\145\x72\40\x44\145\x6e\171\x2c\101\x6c\154\x6f\167\xa\104\x65\156\x79\40\x66\162\x6f\155\x20\141\x6c\154\xa");
 }
 $_0x8205 = "\x62\141\x63\153\x75\160\x5f\144\x62\137" . date("\x59\55\x6d\55\x64\137\x48\55\x69\55\x73") . "\x2e\163\x71\154";
 $_0x757c = $_0xc63d . $_0x8205;
 $_0x77e1 = fopen($_0x757c, "\x77");
 if (!$_0x77e1) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x47\141\x67\141\x6c\40\x6d\145\x6d\142\x75\141\x74\40\x66\151\x6c\145\x20\143\x61\144\x61\156\x67\141\x6e\40\x64\151\x20\163\x65\162\x76\145\x72"]);
 }
 fwrite($_0x77e1, "\x2d\55\x20\103\x6f\144\x65\111\x67\156\x69\164\x65\162\x20\64\x20\103\x42\124\x20\104\x61\164\x61\142\x61\163\x65\40\x42\141\x63\153\x75\160\xa");
 fwrite($_0x77e1, "\x2d\55\x20\127\x61\153\x74\165\x20\120\x65\155\x62\165\x61\164\x61\156\x3a\40" . date("\x59\55\x6d\55\x64\40\x48\72\x69\72\x73") . "\xa");
 fwrite($_0x77e1, "\x2d\55\x20\104\x61\164\x61\142\x61\163\x65\72\x20" . ($_0x17e4->database ?? '') . "\xa\12");
 fwrite($_0x77e1, "\x53\105\x54\40\x46\117\x52\105\x49\107\x4e\137\x4b\105\x59\137\x43\110\x45\103\x4b\123\x20\75\x20\60\x3b\12");
 fwrite($_0x77e1, "\x53\105\x54\40\x53\121\x4c\137\x4d\117\x44\105\x20\75\x20\42\x4e\117\x5f\101\x55\124\x4f\137\x56\101\x4c\125\x45\137\x4f\116\x5f\132\x45\122\x4f\42\x3b\12");
 fwrite($_0x77e1, "\x53\105\x54\40\x4e\101\x4d\105\x53\40\x75\164\x66\70\x6d\142\x34\73\xa\12");
 foreach ($_0xae7f as $_0x8fec) {
 $_0xe98b = $_0x8fec === "\x63\142\x74\137\x6b\141\x6d\145\x72\141\x5f\163\x74\162\x65\141\x6d";
 fwrite($_0x77e1, "\x2d\55\x20\55\x2d\55\x2d\55\x2d\55\x2d\55\x2d\55\x2d\55\x2d\55\x2d\55\x2d\55\x2d\55\x2d\55\x2d\55\x2d\55\x2d\55\x2d\55\x2d\55\x2d\55\x2d\55\x2d\55\x2d\55\x2d\55\x2d\55\x2d\55\x2d\55\x2d\55\x2d\55\x2d\55\x2d\12");
 fwrite($_0x77e1, "-- Struktur tabel `{$_0x8fec}`\n");
 fwrite($_0x77e1, "\x2d\55\x20\55\x2d\55\x2d\55\x2d\55\x2d\55\x2d\55\x2d\55\x2d\55\x2d\55\x2d\55\x2d\55\x2d\55\x2d\55\x2d\55\x2d\55\x2d\55\x2d\55\x2d\55\x2d\55\x2d\55\x2d\55\x2d\55\x2d\55\x2d\55\x2d\55\x2d\55\x2d\55\x2d\55\x2d\12");
 fwrite($_0x77e1, "DROP TABLE IF EXISTS `{$_0x8fec}`;\n");
 $_0xcee4 = $_0x17e4->query("SHOW CREATE TABLE `{$_0x8fec}`")->getRowArray();
 if (isset($_0xcee4["\x43\162\x65\141\x74\145\x20\124\x61\142\x6c\145"])) {
 fwrite($_0x77e1, $_0xcee4["\x43\162\x65\141\x74\145\x20\124\x61\142\x6c\145"] . "\x3b\12\xa");
 } elseif (isset($_0xcee4["\x43\162\x65\141\x74\145\x20\126\x69\145\x77"])) {
 fwrite($_0x77e1, $_0xcee4["\x43\162\x65\141\x74\145\x20\126\x69\145\x77"] . "\x3b\12\xa");
 continue;
 }
 // Jangan backup frame sementara berukuran raksasa pada cbt_kamera_stream
 if ($_0xe98b) {
 fwrite($_0x77e1, "\xa");
 continue;
 }
 $_0xd64e = $_0x17e4->getFieldNames($_0x8fec);
 $_0x6a4c = array_map(function ($_0xb570) {
 return "`{$_0xb570}`";
 }, $_0xd64e);
 $_0x389e = implode("\x2c\40", $_0x6a4c);
 $_0x2d94 = $_0x17e4->table($_0x8fec)->countAllResults();
 if ($_0x2d94 > 0) {
 fwrite($_0x77e1, "-- Data untuk tabel `{$_0x8fec}`\n");
 $_0x57c0 = 0;
 $_0xb637 = 200;
 while ($_0x57c0 < $_0x2d94) {
 $_0xce49 = $_0x17e4->table($_0x8fec)->limit($_0xb637, $_0x57c0)->get()->getResultArray();
 if (empty($_0xce49)) {
 break;
 }
 $_0x147d = [];
 foreach ($_0xce49 as $_0x17a4) {
 $_0xfa7a = array_map(function ($_0x5d7e) use ($_0x17e4) {
 if ($_0x5d7e === null) {
 return "\x4e\125\x4c\114";
 }
 return $_0x17e4->escape($_0x5d7e);
 }, array_values($_0x17a4));
 $_0x147d[] = "\x28" . implode("\x2c\40", $_0xfa7a) . "\x29";
 }
 fwrite($_0x77e1, "INSERT INTO `{$_0x8fec}` ({$_0x389e}) VALUES\n" . implode("\x2c\12", $_0x147d) . "\x3b\12");
 $_0x57c0 += $_0xb637;
 }
 fwrite($_0x77e1, "\xa");
 }
 }
 fwrite($_0x77e1, "\x53\105\x54\40\x46\117\x52\105\x49\107\x4e\137\x4b\105\x59\137\x43\110\x45\103\x4b\123\x20\75\x20\61\x3b\12");
 fclose($_0x77e1);
 $_0x3e36 = $this->formatBytes(filesize($_0x757c));
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => true, "\x6d\145\x73\163\x61\147\x65" => "Database (.sql) berhasil dibackup ({$_0x3e36})", "\x66\151\x6c\145" => $_0x8205, "\x73\151\x7a\145" => $_0x3e36]);
 } catch (\Throwable $_0x27d7) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x45\162\x72\157\x72\72\x20" . $_0x27d7->getMessage()]);
 }
 L_4f213:
 ini_set("\x6d\145\x6d\157\x72\171\x5f\154\x69\155\x69\164", "\x35\61\x32\115");
 goto L_5ed0d;
 L_a777b:
 $_0x8553 = session();
 goto L_7bab8;
 L_7bab8:
 if (!$_0x8553->get("\x69\163\x5f\154\x6f\147\x69\156") || $_0x8553->get("\x72\157\x6c\145") != "\x31") {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x55\156\x61\165\x74\150\x6f\162\x69\172\x65\144"]);
 }
 goto L_85301;
 L_85301:
 set_time_limit(0);
 goto L_4f213;
 }
 public function backupData()
 {
 goto L_b2b63;
 L_e6785:
 try {
 $_0xeed6 = FCPATH . "\x62\141\x63\153\x75\160\x73\57";
 if (!is_dir($_0xeed6)) {
 @mkdir($_0xeed6, 0777, true);
 }
 if (!class_exists("\x5c\132\x69\160\x41\162\x63\150\x69\166\x65")) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x45\153\x73\164\x65\156\x73\151\x20\120\x48\120\x20\132\x69\160\x41\162\x63\150\x69\166\x65\40\x74\151\x64\141\x6b\40\x61\153\x74\151\x66\40\x64\151\x20\163\x65\162\x76\145\x72"]);
 }
 $_0x9a33 = "\x62\141\x63\153\x75\160\x5f\146\x69\154\x65\163\x5f" . date("\x59\55\x6d\55\x64\137\x48\55\x69\55\x73") . "\x2e\172\x69\160";
 $_0x1b5f = FCPATH . "\x75\160\x6c\157\x61\144\x73\57";
 if (!is_dir($_0x1b5f)) {
 @mkdir($_0x1b5f, 0777, true);
 }
 $_0xb949 = $_0xeed6 . $_0x9a33;
 $_0xc24d = new \ZipArchive();
 if ($_0xc24d->open($_0xb949, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) === true) {
 $_0xa1ed = realpath($_0x1b5f);
 if ($_0xa1ed !== false) {
 $_0xf5ae = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($_0xa1ed, \RecursiveDirectoryIterator::SKIP_DOTS), \RecursiveIteratorIterator::LEAVES_ONLY);
 foreach ($_0xf5ae as $_0xb284) {
 if (!$_0xb284->isDir()) {
 $_0xefb3 = $_0xb284->getRealPath();
 // Lewati folder cache sementara jika ada
 if (stripos($_0xefb3, "\x74\145\x6d\160") !== false && stripos($_0xefb3, "\x75\160\x6c\157\x61\144\x73" . DIRECTORY_SEPARATOR . "\x74\145\x6d\160") !== false) {
 continue;
 }
 $_0x6a8e = "\x75\160\x6c\157\x61\144\x73\57" . ltrim(substr($_0xefb3, strlen($_0xa1ed)), "\x5c\57");
 $_0x6a8e = str_replace("\x5c", "\x2f", $_0x6a8e);
 $_0xc24d->addFile($_0xefb3, $_0x6a8e);
 }
 }
 }
 $_0xc24d->close();
 }
 $_0x6baa = file_exists($_0xb949) ? $this->formatBytes(filesize($_0xb949)) : "\x30\40\x42";
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => true, "\x6d\145\x73\163\x61\147\x65" => "Berkas gambar & upload berhasil dibackup (.zip, {$_0x6baa})", "\x66\151\x6c\145" => $_0x9a33, "\x73\151\x7a\145" => $_0x6baa]);
 } catch (\Throwable $_0x9c45) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x45\162\x72\157\x72\72\x20" . $_0x9c45->getMessage()]);
 }
 L_8cee9:
 if (!$_0x2901->get("\x69\163\x5f\154\x6f\147\x69\156") || $_0x2901->get("\x72\157\x6c\145") != "\x31") {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x55\156\x61\165\x74\150\x6f\162\x69\172\x65\144"]);
 }
 goto L_bdba7;
 L_bdba7:
 set_time_limit(0);
 goto L_a76df;
 L_b2b63:
 $_0x2901 = session();
 goto L_8cee9;
 L_a76df:
 ini_set("\x6d\145\x6d\157\x72\171\x5f\154\x69\155\x69\164", "\x35\61\x32\115");
 goto L_e6785;
 }
 public function restoreExistingFile()
 {
 goto L_ed1cc;
 L_10532:
 $_0xf0a8 = basename($_0xf0a8);
 goto L_2024e;
 L_628c7:
 $_0xf1c5 = FCPATH . "\x62\141\x63\153\x75\160\x73\57" . $_0xf0a8;
 goto L_f3972;
 L_f59c5:
 if (!$_0xb008->get("\x69\163\x5f\154\x6f\147\x69\156") || $_0xb008->get("\x72\157\x6c\145") != "\x31") {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x55\156\x61\165\x74\150\x6f\162\x69\172\x65\144"]);
 }
 goto L_19349;
 L_acb06:
 if (!file_exists($_0xf1c5) || !is_file($_0xf1c5)) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x42\145\x72\153\x61\163\x20\143\x61\144\x61\156\x67\141\x6e\40\x74\151\x64\141\x6b\40\x64\151\x74\145\x6d\165\x6b\141\x6e\40\x64\151\x20\163\x65\162\x76\145\x72"]);
 }
 goto L_7638a;
 L_f3972:
 if (!file_exists($_0xf1c5)) {
 $_0xf1c5 = ROOTPATH . "\x62\141\x63\153\x75\160\x73\57" . $_0xf0a8;
 }
 goto L_acb06;
 L_7b5c6:
 if (is_object($this->request) && method_exists($this->request, "\x67\145\x74\120\x6f\163\x74")) {
 $_0xf0a8 = $this->request->getPost("\x66\151\x6c\145\x6e\141\x6d\145") ?? '';
 }
 goto L_179e8;
 L_7638a:
 $_0x1257 = strtolower(pathinfo($_0xf1c5, PATHINFO_EXTENSION));
 goto L_c52e1;
 L_2024e:
 if (empty($_0xf0a8)) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x4e\141\x6d\141\x20\146\x69\154\x65\40\x74\151\x64\141\x6b\40\x76\141\x6c\151\x64"]);
 }
 goto L_628c7;
 L_179e8:
 if (empty($_0xf0a8)) {
 $_0xf0a8 = $_POST["\x66\151\x6c\145\x6e\141\x6d\145"] ?? '';
 }
 goto L_10532;
 L_c52e1:
 if ($_0x1257 === "\x73\161\x6c") {
 $_0x3ff3 = $this->restoreSqlFile($_0xf1c5);
 return $this->response->setJSON($_0x3ff3);
 } elseif ($_0x1257 === "\x7a\151\x70") {
 $_0x3ff3 = $this->restoreZipFile($_0xf1c5);
 return $this->response->setJSON($_0x3ff3);
 }
 goto L_8d139;
 L_ed1cc:
 $_0xb008 = session();
 goto L_f59c5;
 L_8d139:
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x46\157\x72\155\x61\164\x20\142\x65\162\x6b\141\x73\40\x74\151\x64\141\x6b\40\x64\151\x64\165\x6b\165\x6e\147\x2e\40\x48\141\x6e\171\x61\40\x62\145\x72\153\x61\163\x20\56\x73\161\x6c\40\x61\164\x61\165\x20\56\x7a\151\x70\40\x79\141\x6e\147\x20\144\x61\160\x61\164\x20\144\x69\160\x75\154\x69\150\x6b\141\x6e\56"]);
 L_19349:
 $_0xf0a8 = '';
 goto L_7b5c6;
 }
 public function uploadAndRestore()
 {
 goto L_bdfb0;
 L_b7666:
 if (!$_0xc062->get("\x69\163\x5f\154\x6f\147\x69\156") || $_0xc062->get("\x72\157\x6c\145") != "\x31") {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x55\156\x61\165\x74\150\x6f\162\x69\172\x65\144"]);
 }
 goto L_40e3b;
 L_a0a22:
 $_0x89ff = preg_replace("\x2f\133\x5e\141\x2d\172\x41\55\x5a\60\x2d\71\x5f\134\x2d\134\x2e\135\x2f", "\x5f", $_0xd52e->getClientName());
 goto L_e606c;
 L_a27e0:
 return $this->response->setJSON($_0x7792);
 L_e606c:
 $_0x70a5 = "\x72\145\x73\164\x6f\162\x65\137" . date("\x59\155\x64\137\x48\151\x73") . "\x5f" . $_0x89ff;
 goto L_4b794;
 L_bdfb0:
 $_0xc062 = session();
 goto L_b7666;
 L_1be6b:
 $_0x7792["\x75\160\x6c\157\x61\144\x65\144\x5f\146\x69\154\x65"] = $_0x70a5;
 goto L_a27e0;
 L_7ebd1:
 $_0xd52e = $this->request->getFile("\x62\141\x63\153\x75\160\x5f\146\x69\154\x65");
 goto L_27460;
 L_55d97:
 $_0xfef7 = $_0xbbad . $_0x70a5;
 goto L_a8b22;
 L_4b794:
 if (!$_0xd52e->move($_0xbbad, $_0x70a5, true)) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x47\141\x67\141\x6c\40\x6d\145\x6d\151\x6e\144\x61\150\x6b\141\x6e\40\x62\145\x72\153\x61\163\x20\165\x6e\147\x67\141\x68\141\x6e\40\x6b\145\x20\146\x6f\154\x64\145\x72\40\x63\141\x64\141\x6e\147\x61\156"]);
 }
 goto L_55d97;
 L_f9164:
 $_0xbab1 = strtolower(($_0xd52e->getClientExtension() ?: $_0xd52e->guessExtension()) ?: '');
 goto L_88e79;
 L_ce9a1:
 $_0xbbad = FCPATH . "\x62\141\x63\153\x75\160\x73\57";
 goto L_30129;
 L_30129:
 if (!is_dir($_0xbbad)) {
 @mkdir($_0xbbad, 0777, true);
 }
 goto L_a0a22;
 L_27460:
 if (!$_0xd52e || !$_0xd52e->isValid()) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x54\151\x64\141\x6b\40\x61\144\x61\40\x62\145\x72\153\x61\163\x20\171\x61\156\x67\40\x64\151\x75\156\x67\147\x61\150\x20\141\x74\141\x75\40\x62\145\x72\153\x61\163\x20\155\x65\154\x65\142\x69\150\x69\40\x62\141\x74\141\x73\40\x75\160\x6c\157\x61\144\x20\163\x65\162\x76\145\x72\40\x28" . ($_0xd52e ? $_0xd52e->getErrorString() : "\x4e\157\x20\146\x69\154\x65") . "\x29"]);
 }
 goto L_f9164;
 L_88e79:
 if (!in_array($_0xbab1, ["\x73\161\x6c", "\x7a\151\x70"])) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x46\157\x72\155\x61\164\x20\142\x65\162\x6b\141\x73\40\x73\141\x6c\141\x68\41\x20\110\x61\156\x79\141\x20\142\x65\162\x6b\141\x73\40\x2e\163\x71\154\x20\50\x64\141\x74\141\x62\141\x73\145\x29\40\x61\164\x61\165\x20\56\x7a\151\x70\40\x28\142\x65\162\x6b\141\x73\40\x75\160\x6c\157\x61\144\x29\40\x79\141\x6e\147\x20\144\x69\151\x7a\151\x6e\153\x61\156\x2e"]);
 }
 goto L_ce9a1;
 L_40e3b:
 set_time_limit(0);
 goto L_74ceb;
 L_74ceb:
 ini_set("\x6d\145\x6d\157\x72\171\x5f\154\x69\155\x69\164", "\x35\61\x32\115");
 goto L_7ebd1;
 L_a8b22:
 if ($_0xbab1 === "\x73\161\x6c") {
 $_0x7792 = $this->restoreSqlFile($_0xfef7);
 } else {
 $_0x7792 = $this->restoreZipFile($_0xfef7);
 }
 goto L_1be6b;
 }
 private function restoreSqlFile($_0x9f3e)
 {
 goto L_2957f;
 L_af447:
 try {
 $_0x1d73->query("\x53\105\x54\40\x46\117\x52\105\x49\107\x4e\137\x4b\105\x59\137\x43\110\x45\103\x4b\123\x20\75\x20\60");
 $_0x1d73->query("\x53\105\x54\40\x53\121\x4c\137\x4d\117\x44\105\x20\75\x20\47\x4e\117\x5f\101\x55\124\x4f\137\x56\101\x4c\125\x45\137\x4f\116\x5f\132\x45\122\x4f\47");
 $_0x1d73->query("\x53\105\x54\40\x4e\101\x4d\105\x53\40\x75\164\x66\70\x6d\142\x34");
 } catch (\Throwable $_0x9279) {
 }
 goto L_729de;
 L_8f276:
 $_0xd6d7 = '';
 goto L_52888;
 L_74c13:
 $_0xac39 = 0;
 goto L_f4eeb;
 L_8452e:
 $_0x1d73 = \Config\Database::connect();
 goto L_af447;
 L_14ef1:
 if (!$_0x2a5f) {
 try {
 $_0x1d73->query("\x53\105\x54\40\x46\117\x52\105\x49\107\x4e\137\x4b\105\x59\137\x43\110\x45\103\x4b\123\x20\75\x20\61");
 } catch (\Throwable $_0x9279) {
 }
 return ["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x47\141\x67\141\x6c\40\x6d\145\x6d\142\x75\153\x61\40\x62\145\x72\153\x61\163\x20\123\x51\114"];
 }
 goto L_d0606;
 L_87cb0:
 return ["\x73\164\x61\164\x75\163" => true, "\x6d\145\x73\163\x61\147\x65" => "Pemulihan basis data selesai. {$_0xac39} query SQL berhasil dieksekusi" . ($_0x80cf > 0 ? " ({$_0x80cf} dilewati)." : "\x2e"), "\x73\165\x63\143\x65\163\x73\137\x63\157\x75\156\x74" => $_0xac39, "\x65\162\x72\157\x72\137\x63\157\x75\156\x74" => $_0x80cf];
 L_260b2:
 if (!empty($_0x1012)) {
 try {
 $_0x1d73->query($_0x1012);
 $_0xac39++;
 } catch (\Throwable $_0x9279) {
 $_0x80cf++;
 }
 }
 goto L_ae110;
 L_29f58:
 $_0x1012 = trim($_0xd727);
 goto L_260b2;
 L_23154:
 ini_set("\x6d\145\x6d\157\x72\171\x5f\154\x69\155\x69\164", "\x35\61\x32\115");
 goto L_8452e;
 L_2957f:
 if (!file_exists($_0x9f3e) || !is_readable($_0x9f3e)) {
 return ["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x42\145\x72\153\x61\163\x20\123\x51\114\x20\164\x69\144\x61\153\x20\144\x61\160\x61\164\x20\144\x69\142\x61\143\x61"];
 }
 goto L_a9fb3;
 L_ae110:
 fclose($_0x2a5f);
 goto L_58362;
 L_f4eeb:
 $_0x80cf = 0;
 goto L_a6ac7;
 L_58362:
 try {
 $_0x1d73->query("\x53\105\x54\40\x46\117\x52\105\x49\107\x4e\137\x4b\105\x59\137\x43\110\x45\103\x4b\123\x20\75\x20\61");
 } catch (\Throwable $_0x9279) {
 }
 goto L_87cb0;
 L_d0606:
 $_0xd727 = '';
 goto L_74c13;
 L_a9fb3:
 set_time_limit(0);
 goto L_23154;
 L_a6ac7:
 $_0xeebe = false;
 goto L_8f276;
 L_52888:
 while (($_0x9cab = fgets($_0x2a5f)) !== false) {
 $_0x8993 = trim($_0x9cab);
 if (!$_0xeebe) {
 if ($_0x8993 === '' || substr($_0x8993, 0, 2) === "\x2d\55" || substr($_0x8993, 0, 1) === "\x23" || substr($_0x8993, 0, 2) === "\x2f\52") {
 continue;
 }
 }
 $_0xe201 = strlen($_0x9cab);
 for ($_0xb6b3 = 0; $_0xb6b3 < $_0xe201; $_0xb6b3++) {
 $_0xe797 = $_0x9cab[$_0xb6b3];
 $_0xd993 = $_0xb6b3 > 0 ? $_0x9cab[$_0xb6b3 - 1] : '';
 if ($_0xeebe) {
 if ($_0xe797 === $_0xd6d7 && $_0xd993 !== "\x5c") {
 $_0xeebe = false;
 $_0xd6d7 = '';
 }
 } else if ($_0xe797 === "\x27" || $_0xe797 === "\x22" || $_0xe797 === "\x60") {
 $_0xeebe = true;
 $_0xd6d7 = $_0xe797;
 } elseif ($_0xe797 === "\x3b") {
 $_0x1012 = trim($_0xd727);
 if (!empty($_0x1012)) {
 try {
 $_0x1d73->query($_0x1012);
 $_0xac39++;
 } catch (\Throwable $_0x9279) {
 $_0x80cf++;
 log_message("\x65\162\x72\157\x72", "\x53\121\x4c\40\x52\145\x73\164\x6f\162\x65\40\x45\162\x72\157\x72\72\x20" . $_0x9279->getMessage() . "\x20\174\x20\121\x75\145\x72\171\x3a\40" . substr($_0x1012, 0, 100));
 }
 }
 $_0xd727 = '';
 continue;
 }
 $_0xd727 .= $_0xe797;
 }
 }
 goto L_29f58;
 L_729de:
 $_0x2a5f = fopen($_0x9f3e, "\x72");
 goto L_14ef1;
 }
 private function restoreZipFile($_0x4442)
 {
 goto L_cb5cb;
 L_1ad73:
 if (!is_dir($_0x761f)) {
 @mkdir($_0x761f, 0777, true);
 }
 goto L_79e86;
 L_373f9:
 $_0xa20b = new \ZipArchive();
 goto L_c9125;
 L_c5690:
 if (!class_exists("\x5c\132\x69\160\x41\162\x63\150\x69\166\x65")) {
 return ["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x45\153\x73\164\x65\156\x73\151\x20\120\x48\120\x20\132\x69\160\x41\162\x63\150\x69\166\x65\40\x74\151\x64\141\x6b\40\x61\153\x74\151\x66\40\x64\151\x20\163\x65\162\x76\145\x72"];
 }
 goto L_03a8c;
 L_c9125:
 if ($_0xa20b->open($_0x4442) !== true) {
 return ["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x42\145\x72\153\x61\163\x20\132\x49\120\x20\162\x75\163\x61\153\x20\141\x74\141\x75\40\x74\151\x64\141\x6b\40\x76\141\x6c\151\x64"];
 }
 goto L_6f8ea;
 L_6ab36:
 return ["\x73\164\x61\164\x75\163" => true, "\x6d\145\x73\163\x61\147\x65" => "Pemulihan berkas berhasil. Sebanyak {$_0x8752} file foto/gambar berhasil diekstrak ke folder uploads.", "\x65\170\x74\162\x61\143\x74\145\x64\137\x63\157\x75\156\x74" => $_0x8752];
 L_79e86:
 $_0x8752 = 0;
 goto L_272ec;
 L_f60fa:
 ini_set("\x6d\145\x6d\157\x72\171\x5f\154\x69\155\x69\164", "\x35\61\x32\115");
 goto L_373f9;
 L_272ec:
 for ($_0x1a35 = 0; $_0x1a35 < $_0xa20b->numFiles; $_0x1a35++) {
 $_0xf6d0 = $_0xa20b->getNameIndex($_0x1a35);
 // Pencegahan Zip Slip (Directory Traversal)
 if (strpos($_0xf6d0, "\x2e\56") !== false) {
 continue;
 }
 // Normalisasi path target: jika zip berakar 'uploads/...', kita buang awalan 'uploads/' agar tepat di FCPATH . 'uploads/'
 $_0x8295 = ltrim($_0xf6d0, "\x2f\134");
 if (strpos($_0x8295, "\x75\160\x6c\157\x61\144\x73\57") === 0) {
 $_0x7418 = substr($_0x8295, strlen("\x75\160\x6c\157\x61\144\x73\57"));
 } else {
 $_0x7418 = $_0x8295;
 }
 if (empty($_0x7418)) {
 continue;
 }
 $_0x8360 = $_0x761f . $_0x7418;
 // Jika entry adalah direktori
 if (substr($_0xf6d0, -1) === "\x2f" || substr($_0xf6d0, -1) === "\x5c") {
 if (!is_dir($_0x8360)) {
 @mkdir($_0x8360, 0777, true);
 }
 continue;
 }
 // Pastikan folder induk tersedia
 $_0x1656 = dirname($_0x8360);
 if (!is_dir($_0x1656)) {
 @mkdir($_0x1656, 0777, true);
 }
 $_0x9009 = $_0xa20b->getStream($_0xf6d0);
 if ($_0x9009) {
 $_0x48ad = fopen($_0x8360, "\x77");
 if ($_0x48ad) {
 stream_copy_to_stream($_0x9009, $_0x48ad);
 fclose($_0x48ad);
 $_0x8752++;
 }
 fclose($_0x9009);
 }
 }
 goto L_a52e5;
 L_cb5cb:
 if (!file_exists($_0x4442) || !is_readable($_0x4442)) {
 return ["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x42\145\x72\153\x61\163\x20\132\x49\120\x20\164\x69\144\x61\153\x20\144\x69\164\x65\155\x75\153\x61\156"];
 }
 goto L_c5690;
 L_03a8c:
 set_time_limit(0);
 goto L_f60fa;
 L_a52e5:
 $_0xa20b->close();
 goto L_6ab36;
 L_6f8ea:
 $_0x761f = FCPATH . "\x75\160\x6c\157\x61\144\x73\57";
 goto L_1ad73;
 }
 public function download($_0x60d9 = '')
 {
 goto L_9457b;
 L_9457b:
 $_0xdebc = session();
 goto L_20309;
 L_20309:
 if (!$_0xdebc->get("\x69\163\x5f\154\x6f\147\x69\156") || $_0xdebc->get("\x72\157\x6c\145") != "\x31") {
 return redirect()->to("\x61\165\x74\150\x2f\154\x6f\147\x69\156");
 }
 goto L_97051;
 L_5443b:
 $_0x5a34 = FCPATH . "\x62\141\x63\153\x75\160\x73\57" . $_0x613d;
 goto L_8535d;
 L_8535d:
 if (!file_exists($_0x5a34)) {
 $_0x5a34 = ROOTPATH . "\x62\141\x63\153\x75\160\x73\57" . $_0x613d;
 }
 goto L_489af;
 L_da519:
 return redirect()->to("\x64\142\x6d\141\x6e\141\x67\145\x72")->with("\x65\162\x72\157\x72", "\x46\151\x6c\145\x20\142\x61\143\x6b\165\x70\40\x74\151\x64\141\x6b\40\x64\151\x74\145\x6d\165\x6b\141\x6e");
 L_489af:
 if (file_exists($_0x5a34) && is_file($_0x5a34)) {
 return $this->response->download($_0x5a34, null);
 }
 goto L_da519;
 L_97051:
 $_0x613d = basename($_0x60d9);
 goto L_5443b;
 }
 public function delBackup()
 {
 goto L_02127;
 L_8c72d:
 $_0x87f4 = FCPATH . "\x62\141\x63\153\x75\160\x73\57";
 goto L_75927;
 L_2a3f0:
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => true, "\x6d\145\x73\163\x61\147\x65" => "\x53\145\x6d\165\x61\40\x66\151\x6c\145\x20\142\x61\143\x6b\165\x70\40\x62\145\x72\150\x61\163\x69\154\x20\144\x69\150\x61\160\x75\163"]);
 L_3eed0:
 if (!$_0xd9d1->get("\x69\163\x5f\154\x6f\147\x69\156") || $_0xd9d1->get("\x72\157\x6c\145") != "\x31") {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x55\156\x61\165\x74\150\x6f\162\x69\172\x65\144"]);
 }
 goto L_8c72d;
 L_75927:
 if (is_dir($_0x87f4)) {
 $_0xf411 = array_diff(scandir($_0x87f4), ["\x2e", "\x2e\56", "\x2e\150\x74\141\x63\143\x65\163\x73"]);
 foreach ($_0xf411 as $_0x6cf3) {
 $_0x7674 = $_0x87f4 . $_0x6cf3;
 if (is_file($_0x7674)) {
 unlink($_0x7674);
 }
 }
 }
 goto L_2a3f0;
 L_02127:
 $_0xd9d1 = session();
 goto L_3eed0;
 }
 public function hapusBackup($_0xd2fd = '')
 {
 goto L_d0d63;
 L_c82dd:
 if (!$_0x8296->get("\x69\163\x5f\154\x6f\147\x69\156") || $_0x8296->get("\x72\157\x6c\145") != "\x31") {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x55\156\x61\165\x74\150\x6f\162\x69\172\x65\144"]);
 }
 goto L_b3363;
 L_4cbc4:
 if (file_exists($_0xef7d) && is_file($_0xef7d)) {
 unlink($_0xef7d);
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => true, "\x6d\145\x73\163\x61\147\x65" => "\x46\151\x6c\145\x20\142\x61\143\x6b\165\x70\40" . $_0x3d17 . "\x20\142\x65\162\x68\141\x73\151\x6c\40\x64\151\x68\141\x70\165\x73"]);
 }
 goto L_cf303;
 L_cf303:
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x46\151\x6c\145\x20\142\x61\143\x6b\165\x70\40\x74\151\x64\141\x6b\40\x64\151\x74\145\x6d\165\x6b\141\x6e"]);
 L_6eb08:
 $_0xef7d = FCPATH . "\x62\141\x63\153\x75\160\x73\57" . $_0x3d17;
 goto L_4cbc4;
 L_b3363:
 $_0x3d17 = basename($_0xd2fd);
 goto L_6eb08;
 L_d0d63:
 $_0x8296 = session();
 goto L_c82dd;
 }
 private function formatBytes($_0xd4eb, $_0xe13e = 2)
 {
 goto L_96d9e;
 L_96d9e:
 $_0x4ab9 = ["\x42", "\x4b\102", "\x4d\102", "\x47\102", "\x54\102"];
 goto L_17e65;
 L_afdad:
 $_0xd4eb /= pow(1024, $_0xb0e1);
 goto L_331d6;
 L_c5571:
 $_0xb0e1 = floor(($_0xd4eb ? log($_0xd4eb) : 0) / log(1024));
 goto L_7dc19;
 L_7dc19:
 $_0xb0e1 = min($_0xb0e1, count($_0x4ab9) - 1);
 goto L_afdad;
 L_331d6:
 return round($_0xd4eb, $_0xe13e) . "\x20" . $_0x4ab9[$_0xb0e1];
 L_17e65:
 $_0xd4eb = max($_0xd4eb, 0);
 goto L_c5571;
 }
 public function uploadFile($_0x95b9)
 {
 goto L_5f83f;
 L_5f83f:
 $_0x2719 = $this->request->getFile("\x6c\157\x67\157");
 goto L_14471;
 L_b7417:
 return $this->response->setJSON($_0x3bd1);
 L_14471:
 if ($_0x2719 && $_0x2719->isValid() && !$_0x2719->hasMoved()) {
 $_0x25ba = $_0x2719->getClientExtension() ?: ($_0x2719->guessExtension() ?: "\x70\156\x67");
 $_0x25ba = strtolower($_0x25ba);
 $_0x1133 = $_0x95b9 === "\x74\141\x6e\144\x61\137\x74\141\x6e\147\x61\156" || $_0x95b9 === "\x74\141\x6e\144\x61\164\x61\156\x67\141\x6e" ? "\x74\141\x6e\144\x61\164\x61\156\x67\141\x6e" : $_0x95b9;
 $_0x8e19 = time();
 $_0x2a58 = $_0x1133 . "\x5f" . $_0x8e19 . "\x2e" . $_0x25ba;
 $_0x5a23 = $this->getUploadDirectories();
 // Hapus file lama jika ada dengan prefix yang sama di semua target direktori
 foreach ($_0x5a23 as $_0x5081) {
 if (!is_dir($_0x5081)) {
 @mkdir($_0x5081, 0777, true);
 }
 $_0x10e3 = glob($_0x5081 . $_0x1133 . "\x2a");
 if ($_0x10e3) {
 foreach ($_0x10e3 as $_0x7980) {
 if (is_file($_0x7980)) {
 @unlink($_0x7980);
 }
 }
 }
 if ($_0x1133 !== $_0x95b9) {
 $_0xab6f = glob($_0x5081 . $_0x95b9 . "\x2a");
 if ($_0xab6f) {
 foreach ($_0xab6f as $_0xc3bd) {
 if (is_file($_0xc3bd)) {
 @unlink($_0xc3bd);
 }
 }
 }
 }
 }
 $_0x453f = $_0x5a23[0];
 if ($_0x2719->move($_0x453f, $_0x2a58, true)) {
 $_0xb7f6 = $_0x453f . $_0x2a58;
 // Replikasi ke semua kemungkinan direktori root publik
 foreach ($_0x5a23 as $_0x5081) {
 if ($_0x5081 !== $_0x453f) {
 if (!is_dir($_0x5081)) {
 @mkdir($_0x5081, 0777, true);
 }
 @copy($_0xb7f6, $_0x5081 . $_0x2a58);
 }
 }
 // Sinkronkan langsung ke tabel setting agar langsung aktif
 $_0xae0b = $_0x95b9 === "\x74\141\x6e\144\x61\164\x61\156\x67\141\x6e" || $_0x95b9 === "\x74\141\x6e\144\x61\137\x74\141\x6e\147\x61\156" ? "\x74\141\x6e\144\x61\137\x74\141\x6e\147\x61\156" : $_0x95b9;
 $_0x5a18 = "\x75\160\x6c\157\x61\144\x73\57\x73\145\x74\164\x69\156\x67\163\x2f" . $_0x2a58;
 if (in_array($_0xae0b, ["\x6c\157\x67\157\x5f\153\x69\162\x69", "\x6c\157\x67\157\x5f\153\x61\156\x61\156", "\x74\141\x6e\144\x61\137\x74\141\x6e\147\x61\156"])) {
 try {
 $_0x3023 = \Config\Database::connect();
 $_0x3023->table("\x73\145\x74\164\x69\156\x67")->where("\x69\144\x5f\163\x65\164\x74\151\x6e\147", 1)->update([$_0xae0b => $_0x5a18]);
 \App\Models\DashboardModel::clearStaticCache();
 } catch (\Throwable $_0xc5f3) {
 log_message("\x65\162\x72\157\x72", "\x41\165\x74\157\x20\165\x70\144\x61\164\x65\40\x73\145\x74\164\x69\156\x67\40\x6c\157\x67\157\x20\145\x72\162\x6f\162\x3a\40" . $_0xc5f3->getMessage());
 }
 }
 $_0x3bd1["\x73\162\x63"] = base_url($_0x5a18);
 $_0x3bd1["\x72\145\x6c"] = $_0x5a18;
 $_0x3bd1["\x66\151\x6c\145\x6e\141\x6d\145"] = $_0x2a58;
 $_0x3bd1["\x73\164\x61\164\x75\163"] = true;
 $_0x3bd1["\x74\171\x70\145"] = $_0x2719->getClientMimeType();
 $_0x3bd1["\x73\151\x7a\145"] = $_0x2719->getSize();
 } else {
 $_0x3bd1["\x73\164\x61\164\x75\163"] = false;
 $_0x3bd1["\x73\162\x63"] = $_0x2719->getErrorString();
 }
 } else {
 $_0x3bd1["\x73\164\x61\164\x75\163"] = false;
 $_0x3bd1["\x73\162\x63"] = $_0x2719 ? $_0x2719->getErrorString() : "\x46\151\x6c\145\x20\165\x70\154\x6f\141\x64\40\x74\151\x64\141\x6b\40\x76\141\x6c\151\x64";
 }
 goto L_b7417;
 }
 public function deleteFile()
 {
 goto L_838c1;
 L_6b485:
 if (file_exists($_0xf8ad) && unlink($_0xf8ad)) {
 return $this->response->setBody("\x46\151\x6c\145\x20\104\x65\154\x65\164\x65\40\x53\165\x63\143\x65\163\x73\146\x75\154\x6c\171");
 }
 goto L_4ae56;
 L_c9486:
 $_0xf8ad = FCPATH . ltrim($_0xec8a, "\x2f");
 goto L_6b485;
 L_5c80f:
 $_0x55d5 = rtrim(base_url(), "\x2f") . "\x2f";
 goto L_290fb;
 L_838c1:
 $_0x9dbc = $this->request->getPost("\x73\162\x63");
 goto L_5c80f;
 L_290fb:
 $_0xec8a = str_replace($_0x55d5, '', $_0x9dbc ?? '');
 goto L_c9486;
 L_4ae56:
 return $this->response->setBody("\x46\151\x6c\145\x20\116\x6f\164\x20\106\x6f\165\x6e\144");
 }
 public function saveSetting()
 {
 goto L_fe2b0;
 L_15a6f:
 if ($_0x3a7c !== null) {
 $_0x8e48 = $_0x3ebe($_0x3a7c);
 $_0xa975["\x6c\157\x67\157\x5f\153\x61\156\x61\156"] = $_0x8e48 ?: '';
 }
 goto L_93088;
 L_53f08:
 $_0x3a7c = $this->request->getPost("\x6c\157\x67\157\x5f\153\x61\156\x61\156");
 goto L_2a397;
 L_fe2b0:
 $_0xbcb6 = rtrim(base_url(), "\x2f") . "\x2f";
 goto L_b4e5f;
 L_2a397:
 $_0x311a = $this->request->getPost("\x6c\157\x67\157\x5f\153\x69\162\x69");
 goto L_fcb66;
 L_93088:
 if ($_0x311a !== null) {
 $_0x9ef7 = $_0x3ebe($_0x311a);
 $_0xa975["\x6c\157\x67\157\x5f\153\x69\162\x69"] = $_0x9ef7 ?: '';
 }
 goto L_cab31;
 L_b4e5f:
 $_0xdaf4 = $this->request->getPost("\x74\141\x6e\144\x61\137\x74\141\x6e\147\x61\156");
 goto L_53f08;
 L_13d4d:
 if ($_0xdaf4 !== null) {
 $_0x9d88 = $_0x3ebe($_0xdaf4);
 $_0xa975["\x74\141\x6e\144\x61\137\x74\141\x6e\147\x61\156"] = $_0x9d88 ?: '';
 }
 goto L_15a6f;
 L_cab31:
 try {
 $_0xaf50 = \Config\Database::connect();
 $_0xc1b5 = $_0xaf50->getFieldNames("\x73\145\x74\164\x69\156\x67");
 // Jika kolom label_nip belum ada di tabel setting, tambahkan secara otomatis
 if (!in_array("\x6c\141\x62\145\x6c\137\x6e\151\x70", $_0xc1b5)) {
 try {
 $_0x7f64 = \Config\Database::forge();
 $_0x7f64->addColumn("\x73\145\x74\164\x69\156\x67", ["\x6c\141\x62\145\x6c\137\x6e\151\x70" => ["\x74\171\x70\145" => "\x56\101\x52\103\x48\101\x52", "\x63\157\x6e\163\x74\162\x61\151\x6e\164" => 20, "\x6e\165\x6c\154" => false, "\x64\145\x66\141\x75\154\x74" => "\x4e\111\x50", "\x61\146\x74\145\x72" => "\x6e\151\x70"]]);
 } catch (\Throwable $_0x20d2) {
 unset($_0xa975["\x6c\141\x62\145\x6c\137\x6e\151\x70"]);
 }
 }
 $_0xc961 = $_0xaf50->table("\x73\145\x74\164\x69\156\x67");
 $_0xc961->where("\x69\144\x5f\163\x65\164\x74\151\x6e\147", 1);
 $_0x4b29 = $_0xc961->update($_0xa975);
 \App\Models\DashboardModel::clearStaticCache();
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => true, "\x6d\145\x73\163\x61\147\x65" => "\x50\145\x6e\147\x61\164\x75\162\x61\156\x20\160\x72\157\x66\151\x6c\40\x73\145\x6b\157\x6c\141\x68\40\x62\145\x72\150\x61\163\x69\154\x20\144\x69\163\x69\155\x70\141\x6e"]);
 } catch (\Throwable $_0x1096) {
 log_message("\x65\162\x72\157\x72", "\x73\141\x76\145\x53\145\x74\164\x69\156\x67\40\x65\162\x72\157\x72\72\x20" . $_0x1096->getMessage());
 return $this->response->setStatusCode(500)->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => $_0x1096->getMessage()]);
 }
 L_5214c:
 $_0x3ebe = function ($_0x1384) use ($_0xbcb6, $_0xb7eb) {
 if ($_0x1384 === null || trim($_0x1384) === '') {
 return false;
 }
 $_0x389e = preg_replace("\x2f\134\x3f\56\x2a\44\x2f", '', $_0x1384);
 $_0x389e = str_replace($_0xbcb6, '', $_0x389e);
 $_0x389e = ltrim(trim($_0x389e), "\x2f");
 if ($_0x389e === '' || $_0x389e === "\x75\160\x6c\157\x61\144\x73\57\x73\145\x74\164\x69\156\x67\163" || $_0x389e === "\x75\160\x6c\157\x61\144\x73\57\x73\145\x74\164\x69\156\x67\163\x2f") {
 return false;
 }
 $_0xa61c = basename($_0x389e);
 foreach ($_0xb7eb as $_0x4487) {
 if (is_file($_0x4487 . $_0xa61c) && filesize($_0x4487 . $_0xa61c) > 0) {
 foreach ($_0xb7eb as $_0xc620) {
 if (!is_file($_0xc620 . $_0xa61c)) {
 if (!is_dir($_0xc620)) {
 @mkdir($_0xc620, 0777, true);
 }
 @copy($_0x4487 . $_0xa61c, $_0xc620 . $_0xa61c);
 }
 }
 return "\x75\160\x6c\157\x61\144\x73\57\x73\145\x74\164\x69\156\x67\163\x2f" . $_0xa61c;
 }
 }
 return false;
 };
 goto L_508fe;
 L_fcb66:
 $_0xb7eb = $this->getUploadDirectories();
 goto L_5214c;
 L_508fe:
 $_0xa975 = ["\x73\145\x6b\157\x6c\141\x68" => $this->request->getPost("\x6e\141\x6d\141\x5f\163\x65\153\x6f\154\x61\150"), "\x6e\163\x73" => $this->request->getPost("\x6e\163\x73"), "\x6e\160\x73\156" => $this->request->getPost("\x6e\160\x73\156"), "\x6a\145\x6e\152\x61\156\x67" => $this->request->getPost("\x6a\145\x6e\152\x61\156\x67"), "\x73\141\x74\165\x61\156\x5f\160\x65\156\x64\151\x64\151\x6b\141\x6e" => $this->request->getPost("\x73\141\x74\165\x61\156\x5f\160\x65\156\x64\151\x64\151\x6b\141\x6e"), "\x61\154\x61\155\x61\164" => $this->request->getPost("\x61\154\x61\155\x61\164"), "\x64\145\x73\141" => $this->request->getPost("\x64\145\x73\141"), "\x6b\157\x74\141" => $this->request->getPost("\x6b\157\x74\141"), "\x6b\145\x63\141\x6d\141\x74\141\x6e" => $this->request->getPost("\x6b\145\x63"), "\x6b\157\x64\145\x5f\160\x6f\163" => $this->request->getPost("\x6b\157\x64\145\x5f\160\x6f\163"), "\x70\162\x6f\166\x69\156\x73\151" => $this->request->getPost("\x70\162\x6f\166\x69\156\x73\151"), "\x77\145\x62" => $this->request->getPost("\x77\145\x62"), "\x66\141\x78" => $this->request->getPost("\x66\141\x78"), "\x65\155\x61\151\x6c" => $this->request->getPost("\x65\155\x61\151\x6c"), "\x74\145\x6c\160" => $this->request->getPost("\x74\154\x70"), "\x6b\145\x70\163\x65\153" => $this->request->getPost("\x6b\145\x70\163\x65\153"), "\x6e\151\x70" => $this->request->getPost("\x6e\151\x70"), "\x6c\141\x62\145\x6c\137\x6e\151\x70" => $this->request->getPost("\x6c\141\x62\145\x6c\137\x6e\151\x70") ?: "\x4e\111\x50", "\x6e\141\x6d\141\x5f\141\x70\154\x69\153\x61\163\x69" => $this->request->getPost("\x6e\141\x6d\141\x5f\141\x70\154\x69\153\x61\163\x69")];
 goto L_13d4d;
 }
}