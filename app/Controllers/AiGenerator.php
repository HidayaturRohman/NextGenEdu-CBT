<?php
/*   ________________________________________
    |               NextGen Garuda CBT       |
    |    Protected & Distributed via GitHub  |
    |________________________________________|
*/
namespace App\Controllers;

use App\Models\DashboardModel;
/**
 * Controller Mandiri & Terisolasi untuk Fitur Gemini AI Generator
 * (Pengaturan API di Data Umum, Bank Soal CBT & Materi/Tugas E-Learning)
 *
 * Prinsip Arsitektur Zero-Side-Effect:
 * - Tidak mengubah model/controller/helper bawaan aplikasi.
 * - Menyimpan konfigurasi API Key secara mandiri di writable/ai_gemini_config.json
 * sehingga tidak memerlukan perubahan struktur tabel database (Zero DB Migration Risk).
 * - Seluruh proses dibungkus try-catch berlapis agar tidak pernah mengganggu modul lain.
 */
class AiGenerator extends BaseController
{
 protected $db;
 protected $dashboardModel;
 public function __construct()
 {
 $this->db = \Config\Database::connect();
 $this->dashboardModel = new DashboardModel();
 }
 /**
 * Halaman Pengaturan API Gemini AI di menu Data Umum
 */
 public function index()
 {
 goto L_6ab61;
 L_4024c:
 $_0x64e2 = $_0x2798["\x61\160\x69\137\x6b\145\x79"] ?? '';
 goto L_00257;
 L_bc133:
 $_0x3a9b = static function (string $_0xf014): string {
 $_0xc8c6 = strlen($_0xf014);
 if ($_0xc8c6 < 8) {
 return '';
 }
 return substr($_0xf014, 0, 4) . str_repeat("\x2a", max(4, min(16, $_0xc8c6 - 8))) . substr($_0xf014, -4);
 };
 goto L_394e9;
 L_394e9:
 $_0x402d = ["\x75\163\x65\162" => (object) ["\x69\144" => $_0xa0ad->get("\x69\144\x5f\165\x73\145\x72"), "\x75\163\x65\162\x6e\141\x6d\145" => $_0xa0ad->get("\x75\163\x65\162\x6e\141\x6d\145"), "\x66\151\x72\163\x74\137\x6e\141\x6d\145" => $_0xa0ad->get("\x75\163\x65\162\x6e\141\x6d\145"), "\x72\157\x6c\145\x5f\156\x61\155\x65" => $_0xa0ad->get("\x72\157\x6c\145\x5f\156\x61\155\x65"), "\x66\157\x74\157" => $_0xa0ad->get("\x66\157\x74\157") ?? ''], "\x6a\165\x64\165\x6c" => "\x50\145\x6e\147\x61\164\x75\162\x61\156\x20\101\x50\111\x20\107\x65\155\x69\156\x69\40\x41\111", "\x73\165\x62\152\x75\144\x75\154" => "\x4b\157\x6e\146\x69\147\x75\162\x61\163\x69\40\x41\163\x69\163\x74\145\x6e\40\x43\145\x72\144\x61\163\x20\120\x65\155\x62\165\x61\164\x20\123\x6f\141\x6c\40\x43\102\x54\40\x26\40\x4d\141\x74\145\x72\151\x2f\124\x75\147\x61\163", "\x73\145\x74\164\x69\156\x67" => $this->dashboardModel->getSetting(), "\x74\160" => $this->dashboardModel->getTahun(), "\x74\160\x5f\141\x63\164\x69\166\x65" => $_0x1476, "\x73\155\x74" => $this->dashboardModel->getSemester(), "\x73\155\x74\137\x61\143\x74\151\x76\145" => $_0xf7c5, "\x61\151\x5f\143\x6f\156\x66\151\x67" => $_0x2798, "\x68\141\x73\137\x6b\145\x79" => $_0xdc86, "\x6d\141\x73\153\x65\144\x5f\153\x65\171" => $_0x8a25, "\x68\141\x73\137\x63\146" => !empty($_0x2798["\x63\146\x5f\141\x63\143\x6f\165\x6e\164\x5f\151\x64"]) && !empty($_0x2798["\x63\146\x5f\141\x70\151\x5f\164\x6f\153\x65\156"]), "\x6d\141\x73\153\x65\144\x5f\143\x66" => $_0x3a9b((string) ($_0x2798["\x63\146\x5f\141\x70\151\x5f\164\x6f\153\x65\156"] ?? '')), "\x68\141\x73\137\x68\146" => !empty($_0x2798["\x68\146\x5f\141\x70\151\x5f\164\x6f\153\x65\156"]), "\x6d\141\x73\153\x65\144\x5f\150\x66" => $_0x3a9b((string) ($_0x2798["\x68\146\x5f\141\x70\151\x5f\164\x6f\153\x65\156"] ?? '')), "\x68\141\x73\137\x70\157\x6c\154" => !empty($_0x2798["\x70\157\x6c\154\x69\156\x61\164\x69\157\x6e\163\x5f\153\x65\171"]), "\x6d\141\x73\153\x65\144\x5f\160\x6f\154\x6c" => $_0x3a9b((string) ($_0x2798["\x70\157\x6c\154\x69\156\x61\164\x69\157\x6e\163\x5f\153\x65\171"] ?? ''))];
 goto L_77e8f;
 L_1bfaf:
 $_0xf7c5 = $this->dashboardModel->getSemesterActive();
 goto L_145b0;
 L_3ed06:
 $_0x8a25 = $_0xdc86 ? substr($_0x64e2, 0, 6) . str_repeat("\x2a", max(4, strlen($_0x64e2) - 10)) . substr($_0x64e2, -4) : '';
 goto L_bc133;
 L_77e8f:
 return view("\x75\155\x75\155\x2f\141\x69\137\x73\145\x74\164\x69\156\x67", $_0x402d);
 L_20d71:
 if (!$_0xa0ad->get("\x69\163\x5f\154\x6f\147\x69\156") && !$_0xa0ad->get("\x69\144\x5f\165\x73\145\x72")) {
 return redirect()->to("\x61\165\x74\150\x2f\154\x6f\147\x69\156");
 }
 goto L_6251f;
 L_6251f:
 if (!in_array((string) $_0xa0ad->get("\x72\157\x6c\145"), ["\x31", "\x34"])) {
 return redirect()->to("\x64\141\x73\150\x62\157\x61\162\x64")->with("\x65\162\x72\157\x72", "\x48\141\x6e\171\x61\40\x41\144\x6d\151\x6e\151\x73\164\x72\141\x74\157\x72\40\x79\141\x6e\147\x20\144\x61\160\x61\164\x20\155\x65\156\x67\141\x6b\163\x65\163\x20\120\x65\156\x67\141\x74\165\x72\141\x6e\40\x41\120\x49\56");
 }
 goto L_95d52;
 L_145b0:
 $_0x2798 = $this->getAiConfig();
 goto L_4024c;
 L_95d52:
 $_0x1476 = $this->dashboardModel->getTahunActive();
 goto L_1bfaf;
 L_6ab61:
 $_0xa0ad = session();
 goto L_20d71;
 L_00257:
 $_0xdc86 = strlen($_0x64e2) > 10;
 goto L_3ed06;
 }
 /**
 * Lokasi file konfigurasi mandiri Gemini AI
 */
 private function getConfigFilePath(): string
 {
 return WRITEPATH . "\x61\151\x5f\147\x65\155\x69\156\x69\137\x63\157\x6e\146\x69\147\x2e\152\x73\157\x6e";
 }
 /**
 * Membaca konfigurasi API Key & Model Gemini + Provider Gambar Gratis
 */
 private function getAiConfig(): array
 {
 goto L_7e830;
 L_7e830:
 $_0x524b = ["\x61\160\x69\137\x6b\145\x79" => '', "\x6d\157\x64\145\x6c" => "\x67\145\x6d\151\x6e\151\x2d\62\x2e\65\x2d\146\x6c\141\x73\150", "\x69\155\x67\137\x70\162\x6f\166\x69\144\x65\162" => "\x61\165\x74\157", "\x63\146\x5f\141\x63\143\x6f\165\x6e\164\x5f\151\x64" => '', "\x63\146\x5f\141\x70\151\x5f\164\x6f\153\x65\156" => '', "\x68\146\x5f\141\x70\151\x5f\164\x6f\153\x65\156" => '', "\x70\157\x6c\154\x69\156\x61\164\x69\157\x6e\163\x5f\153\x65\171" => '', "\x75\160\x64\141\x74\145\x64\137\x61\164" => null, "\x75\160\x64\141\x74\145\x64\137\x62\171" => null];
 goto L_420e4;
 L_420e4:
 try {
 $_0xf134 = getenv("\x47\105\x4d\111\x4e\111\x5f\101\x50\111\x5f\113\x45\131");
 if (!empty($_0xf134)) {
 $_0x524b["\x61\160\x69\137\x6b\145\x79"] = trim((string) $_0xf134);
 }
 $_0x5e01 = $this->getConfigFilePath();
 if (is_file($_0x5e01) && is_readable($_0x5e01)) {
 $_0x259b = file_get_contents($_0x5e01);
 $_0x8f15 = json_decode($_0x259b, true);
 if (is_array($_0x8f15)) {
 foreach (["\x61\160\x69\137\x6b\145\x79", "\x6d\157\x64\145\x6c", "\x69\155\x67\137\x70\162\x6f\166\x69\144\x65\162", "\x63\146\x5f\141\x63\143\x6f\165\x6e\164\x5f\151\x64", "\x63\146\x5f\141\x70\151\x5f\164\x6f\153\x65\156", "\x68\146\x5f\141\x70\151\x5f\164\x6f\153\x65\156", "\x70\157\x6c\154\x69\156\x61\164\x69\157\x6e\163\x5f\153\x65\171"] as $_0xb330) {
 if (!empty($_0x8f15[$_0xb330])) {
 $_0x524b[$_0xb330] = trim((string) $_0x8f15[$_0xb330]);
 }
 }
 $_0x524b["\x75\160\x64\141\x74\145\x64\137\x61\164"] = $_0x8f15["\x75\160\x64\141\x74\145\x64\137\x61\164"] ?? null;
 $_0x524b["\x75\160\x64\141\x74\145\x64\137\x62\171"] = $_0x8f15["\x75\160\x64\141\x74\145\x64\137\x62\171"] ?? null;
 }
 }
 } catch (\Throwable $_0x34bc) {
 log_message("\x65\162\x72\157\x72", "\x5b\101\x69\107\x65\156\x65\162\x61\164\x6f\162\x5d\40\x47\141\x67\141\x6c\40\x6d\145\x6d\142\x61\143\x61\40\x63\157\x6e\146\x69\147\x3a\40" . $_0x34bc->getMessage());
 }
 goto L_a9f3d;
 L_a9f3d:
 return $_0x524b;
 }
 /**
 * Cek status apakah pengguna sudah login sebagai Admin / Guru
 */
 private function isAuthorized(): bool
 {
 goto L_c7693;
 L_c7693:
 $_0x861a = session()->get("\x69\163\x5f\154\x6f\147\x69\156") || session()->get("\x69\144\x5f\165\x73\145\x72") || session()->get("\x69\163\x4c\157\x67\147\x65\144\x49\156");
 goto L_55a64;
 L_55a64:
 $_0xb1bb = (string) session()->get("\x72\157\x6c\145");
 goto L_dc37b;
 L_dc37b:
 // Role 1 = Admin, Role 2 = Guru
 return !empty($_0x861a) && in_array($_0xb1bb, ["\x31", "\x32"], true);
 }
 /**
 * GET aigenerator/status
 * Mengembalikan status ketersediaan API Key Gemini (disamarkan demi keamanan)
 */
 public function status()
 {
 goto L_79512;
 L_c569e:
 $_0x385d = $_0x546f["\x61\160\x69\137\x6b\145\x79"] ?? '';
 goto L_b0a1f;
 L_b82e9:
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => true, "\x68\141\x73\137\x6b\145\x79" => $_0xa04e, "\x6d\141\x73\153\x65\144\x5f\153\x65\171" => $_0x3801, "\x6d\157\x64\145\x6c" => $_0x546f["\x6d\157\x64\145\x6c"] ?? "\x67\145\x6d\151\x6e\151\x2d\62\x2e\65\x2d\146\x6c\141\x73\150", "\x69\155\x67\137\x70\162\x6f\166\x69\144\x65\162" => $_0x546f["\x69\155\x67\137\x70\162\x6f\166\x69\144\x65\162"] ?? "\x61\165\x74\157", "\x68\141\x73\137\x63\146" => !empty($_0x546f["\x63\146\x5f\141\x63\143\x6f\165\x6e\164\x5f\151\x64"]) && !empty($_0x546f["\x63\146\x5f\141\x70\151\x5f\164\x6f\153\x65\156"]), "\x68\141\x73\137\x68\146" => !empty($_0x546f["\x68\146\x5f\141\x70\151\x5f\164\x6f\153\x65\156"]), "\x68\141\x73\137\x70\157\x6c\154" => !empty($_0x546f["\x70\157\x6c\154\x69\156\x61\164\x69\157\x6e\163\x5f\153\x65\171"]), "\x75\160\x64\141\x74\145\x64\137\x61\164" => $_0x546f["\x75\160\x64\141\x74\145\x64\137\x61\164"], "\x63\163\x72\146\x5f\150\x61\163\x68" => csrf_hash()]);
 L_b0a1f:
 $_0xa04e = strlen($_0x385d) > 10;
 goto L_66229;
 L_66229:
 $_0x3801 = $_0xa04e ? substr($_0x385d, 0, 6) . str_repeat("\x2a", max(4, strlen($_0x385d) - 10)) . substr($_0x385d, -4) : '';
 goto L_b82e9;
 L_79512:
 if (!$this->isAuthorized()) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x53\145\x73\151\x20\164\x69\144\x61\153\x20\166\x61\154\x69\144\x20\141\x74\141\x75\40\x61\153\x73\145\x73\40\x64\151\x74\157\x6c\141\x6b\56"]);
 }
 goto L_ea781;
 L_ea781:
 $_0x546f = $this->getAiConfig();
 goto L_c569e;
 }
 /**
 * POST aigenerator/savekey
 * Menyimpan Gemini API Key dan konfigurasi provider gambar gratis ke writable/ai_gemini_config.json
 */
 public function savekey()
 {
 if (!$this->isAuthorized()) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x41\153\x73\145\x73\40\x64\151\x74\157\x6c\141\x6b\56", "\x63\163\x72\146\x5f\150\x61\163\x68" => csrf_hash()]);
 }
 try {
 $_0xc7ae = $this->getAiConfig();
 $_0xe136 = trim((string) $this->request->getPost("\x61\160\x69\137\x6b\145\x79"));
 $_0xa55f = trim((string) $this->request->getPost("\x6d\157\x64\145\x6c")) ?: ($_0xc7ae["\x6d\157\x64\145\x6c"] ?: "\x67\145\x6d\151\x6e\151\x2d\62\x2e\65\x2d\146\x6c\141\x73\150");
 $_0xaa40 = trim((string) $this->request->getPost("\x69\155\x67\137\x70\162\x6f\166\x69\144\x65\162")) ?: ($_0xc7ae["\x69\155\x67\137\x70\162\x6f\166\x69\144\x65\162"] ?: "\x61\165\x74\157");
 $_0xb854 = trim((string) $this->request->getPost("\x63\146\x5f\141\x63\143\x6f\165\x6e\164\x5f\151\x64"));
 $_0xfb72 = trim((string) $this->request->getPost("\x63\146\x5f\141\x70\151\x5f\164\x6f\153\x65\156"));
 $_0x7c7c = trim((string) $this->request->getPost("\x68\146\x5f\141\x70\151\x5f\164\x6f\153\x65\156"));
 $_0xbd64 = trim((string) $this->request->getPost("\x70\157\x6c\154\x69\156\x61\164\x69\157\x6e\163\x5f\153\x65\171"));
 if ($_0xe136 === '' && !empty($_0xc7ae["\x61\160\x69\137\x6b\145\x79"])) {
 $_0xe136 = $_0xc7ae["\x61\160\x69\137\x6b\145\x79"];
 }
 if ($_0xb854 === '' && $this->request->getPost("\x63\146\x5f\141\x63\143\x6f\165\x6e\164\x5f\151\x64") === null && !empty($_0xc7ae["\x63\146\x5f\141\x63\143\x6f\165\x6e\164\x5f\151\x64"])) {
 $_0xb854 = $_0xc7ae["\x63\146\x5f\141\x63\143\x6f\165\x6e\164\x5f\151\x64"];
 } elseif ($_0xb854 === '' && !empty($_0xc7ae["\x63\146\x5f\141\x63\143\x6f\165\x6e\164\x5f\151\x64"]) && $_0xfb72 === '') {
 $_0xb854 = $_0xc7ae["\x63\146\x5f\141\x63\143\x6f\165\x6e\164\x5f\151\x64"];
 }
 if ($_0xfb72 === '' && !empty($_0xc7ae["\x63\146\x5f\141\x70\151\x5f\164\x6f\153\x65\156"])) {
 $_0xfb72 = $_0xc7ae["\x63\146\x5f\141\x70\151\x5f\164\x6f\153\x65\156"];
 }
 if ($_0x7c7c === '' && !empty($_0xc7ae["\x68\146\x5f\141\x70\151\x5f\164\x6f\153\x65\156"])) {
 $_0x7c7c = $_0xc7ae["\x68\146\x5f\141\x70\151\x5f\164\x6f\153\x65\156"];
 }
 if ($_0xbd64 === '' && !empty($_0xc7ae["\x70\157\x6c\154\x69\156\x61\164\x69\157\x6e\163\x5f\153\x65\171"])) {
 $_0xbd64 = $_0xc7ae["\x70\157\x6c\154\x69\156\x61\164\x69\157\x6e\163\x5f\153\x65\171"];
 }
 if (strlen($_0xe136) < 15 && empty($_0xfb72) && empty($_0x7c7c) && empty($_0xbd64)) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x46\157\x72\155\x61\164\x20\101\x50\111\x20\113\x65\171\x20\164\x69\144\x61\153\x20\166\x61\154\x69\144\x20\141\x74\141\x75\40\x62\145\x6c\165\x6d\40\x61\144\x61\40\x6b\165\x6e\143\x69\40\x41\120\x49\40\x79\141\x6e\147\x20\144\x69\151\x73\151\x2e", "\x63\163\x72\146\x5f\150\x61\163\x68" => csrf_hash()]);
 }
 $_0xe7ab = ["\x61\165\x74\157", "\x63\154\x6f\165\x64\146\x6c\141\x72\145", "\x68\165\x67\147\x69\156\x67\146\x61\143\x65", "\x70\157\x6c\154\x69\156\x61\164\x69\157\x6e\163\x5f\153\x65\171", "\x67\145\x6d\151\x6e\151\x5f\166\x65\143\x74\157\x72", "\x67\145\x6d\151\x6e\151\x5f\156\x61\164\x69\166\x65"];
 if (!in_array($_0xaa40, $_0xe7ab, true)) {
 $_0xaa40 = "\x61\165\x74\157";
 }
 $_0x643d = ["\x61\160\x69\137\x6b\145\x79" => $_0xe136, "\x6d\157\x64\145\x6c" => $_0xa55f, "\x69\155\x67\137\x70\162\x6f\166\x69\144\x65\162" => $_0xaa40, "\x63\146\x5f\141\x63\143\x6f\165\x6e\164\x5f\151\x64" => $_0xb854, "\x63\146\x5f\141\x70\151\x5f\164\x6f\153\x65\156" => $_0xfb72, "\x68\146\x5f\141\x70\151\x5f\164\x6f\153\x65\156" => $_0x7c7c, "\x70\157\x6c\154\x69\156\x61\164\x69\157\x6e\163\x5f\153\x65\171" => $_0xbd64, "\x75\160\x64\141\x74\145\x64\137\x61\164" => date("\x59\55\x6d\55\x64\40\x48\72\x69\72\x73"), "\x75\160\x64\141\x74\145\x64\137\x62\171" => session()->get("\x75\163\x65\162\x6e\141\x6d\145") ?? "\x61\144\x6d\151\x6e"];
 $_0xe0ee = @file_put_contents($this->getConfigFilePath(), json_encode($_0x643d, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
 if ($_0xe0ee === false) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x47\141\x67\141\x6c\40\x6d\145\x6e\171\x69\155\x70\141\x6e\40\x6b\157\x6e\146\x69\147\x75\162\x61\163\x69\40\x64\151\x20\146\x6f\154\x64\145\x72\40\x77\162\x69\164\x61\142\x6c\145\x2e", "\x63\163\x72\146\x5f\150\x61\163\x68" => csrf_hash()]);
 }
 $_0x9bd9 = strlen($_0xe136) > 10;
 $_0x5170 = $_0x9bd9 ? substr($_0xe136, 0, 6) . str_repeat("\x2a", max(4, strlen($_0xe136) - 10)) . substr($_0xe136, -4) : "\x42\145\x6c\165\x6d\40\x64\151\x61\164\x75\162";
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => true, "\x6d\145\x73\163\x61\147\x65" => "\x4b\157\x6e\146\x69\147\x75\162\x61\163\x69\40\x41\120\x49\40\x41\111\x20\50\x54\145\x6b\163\x20\46\x20\107\x61\155\x62\141\x72\51\x20\142\x65\162\x68\141\x73\151\x6c\40\x64\151\x73\151\x6d\160\x61\156\x21", "\x68\141\x73\137\x6b\145\x79" => $_0x9bd9, "\x6d\141\x73\153\x65\144\x5f\153\x65\171" => $_0x5170, "\x69\155\x67\137\x70\162\x6f\166\x69\144\x65\162" => $_0xaa40, "\x68\141\x73\137\x63\146" => $_0xb854 !== '' && $_0xfb72 !== '', "\x68\141\x73\137\x68\146" => $_0x7c7c !== '', "\x68\141\x73\137\x70\157\x6c\154" => $_0xbd64 !== '', "\x75\160\x64\141\x74\145\x64\137\x61\164" => $_0x643d["\x75\160\x64\141\x74\145\x64\137\x61\164"], "\x6d\157\x64\145\x6c" => $_0xa55f, "\x63\163\x72\146\x5f\150\x61\163\x68" => csrf_hash()]);
 } catch (\Throwable $_0x68a7) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x54\145\x72\152\x61\144\x69\40\x6b\145\x73\141\x6c\141\x68\141\x6e\72\x20" . $_0x68a7->getMessage(), "\x63\163\x72\146\x5f\150\x61\163\x68" => csrf_hash()]);
 }
 }
 /**
 * POST aigenerator/testkey
 * Menguji koneksi API Key ke server Google Gemini
 */
 public function testkey()
 {
 if (!$this->isAuthorized()) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x41\153\x73\145\x73\40\x64\151\x74\157\x6c\141\x6b\56", "\x63\163\x72\146\x5f\150\x61\163\x68" => csrf_hash()]);
 }
 try {
 $_0x47d8 = trim((string) $this->request->getPost("\x6d\157\x64\145\x6c"));
 if ($_0x47d8 === "\x5f\137\x63\165\x73\164\x6f\155\x5f\137") {
 $_0x47d8 = trim((string) $this->request->getPost("\x63\165\x73\164\x6f\155\x5f\155\x6f\144\x65\154"));
 }
 $_0x66fb = trim((string) $this->request->getPost("\x61\160\x69\137\x6b\145\x79"));
 $_0x2563 = $this->callGeminiApi("\x4a\141\x77\141\x62\40\x73\151\x6e\147\x6b\141\x74\40\x64\141\x6c\141\x6d\40\x31\40\x6b\141\x6c\151\x6d\141\x74\40\x42\141\x68\141\x73\141\x20\111\x6e\144\x6f\156\x65\163\x69\141\x3a\40\x48\141\x6c\157\x2c\40\x61\163\x69\163\x74\145\x6e\40\x41\111\x20\103\x42\124\x20\163\x69\141\x70\40\x6d\145\x6d\142\x61\156\x74\165\x20\147\x75\162\x75\40\x6d\145\x6e\171\x75\163\x75\156\x20\163\x6f\141\x6c\56", false, $_0x47d8 !== '' ? $_0x47d8 : null, $_0x66fb !== '' ? $_0x66fb : null);
 if ($_0x2563["\x73\165\x63\143\x65\163\x73"]) {
 $_0xb031 = trim(strip_tags((string) $_0x2563["\x74\145\x78\164"]));
 $_0xccf6 = !empty($_0x2563["\x66\141\x6c\154\x62\141\x63\153\x5f\165\x73\145\x64"]);
 $_0xfe5d = $_0x2563["\x70\162\x65\146\x65\162\x72\145\x64\137\x6d\157\x64\145\x6c"] ?? $_0x2563["\x6d\157\x64\145\x6c"] ?? "\x47\145\x6d\151\x6e\151";
 $_0x1379 = $_0x2563["\x6d\157\x64\145\x6c"] ?? "\x47\145\x6d\151\x6e\151";
 $_0xed2b = '';
 if ($_0xccf6 && !empty($_0x2563["\x66\141\x69\154\x65\144\x5f\141\x74\164\x65\155\x70\164\x73"][0]["\x65\162\x72\157\x72"])) {
 $_0xed2b = (string) $_0x2563["\x66\141\x69\154\x65\144\x5f\141\x74\164\x65\155\x70\164\x73"][0]["\x65\162\x72\157\x72"];
 }
 $_0xe5be = $_0xccf6 ? "\x4d\157\x64\145\x6c\40\x64\151\x70\151\x6c\151\x68\40\x22" . $_0xfe5d . "\x22\40\x74\151\x64\141\x6b\40\x64\141\x70\141\x74\40\x64\151\x70\141\x6b\141\x69\40\x28" . ($_0xed2b !== '' ? $_0xed2b : "\x67\141\x67\141\x6c\57\x74\151\x64\141\x6b\40\x74\145\x72\163\x65\144\x69\141") . "\x29\56\x20\123\x69\163\x74\145\x6d\40\x66\141\x6c\154\x62\141\x63\153\x20\153\x65\40\x22" . $_0x1379 . "\x22\40\xe2\200\x94\40\x52\145\x73\160\x6f\156\x73\72\x20\42" . $_0xb031 . "\x22" : "\x4b\157\x6e\145\x6b\163\x69\40\x42\145\x72\150\x61\163\x69\154\x21\40\x4d\157\x64\145\x6c\40\x61\153\x74\151\x66\72\x20" . $_0x1379 . "\x20\342\x80\224\x20\122\x65\163\x70\157\x6e\163\x3a\40\x22" . $_0xb031 . "\x22";
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => true, "\x6d\145\x73\163\x61\147\x65" => $_0xe5be, "\x6d\157\x64\145\x6c\137\x75\163\x65\144" => $_0x1379, "\x70\162\x65\146\x65\162\x72\145\x64\137\x6d\157\x64\145\x6c" => $_0xfe5d, "\x66\141\x6c\154\x62\141\x63\153\x5f\165\x73\145\x64" => $_0xccf6, "\x70\162\x65\146\x65\162\x72\145\x64\137\x65\162\x72\157\x72" => $_0xed2b, "\x63\163\x72\146\x5f\150\x61\163\x68" => csrf_hash()]);
 }
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => $_0x2563["\x65\162\x72\157\x72"], "\x63\163\x72\146\x5f\150\x61\163\x68" => csrf_hash()]);
 } catch (\Throwable $_0x49cb) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x47\141\x67\141\x6c\40\x6d\145\x6e\147\x75\152\x69\40\x6b\157\x6e\145\x6b\163\x69\72\x20" . $_0x49cb->getMessage(), "\x63\163\x72\146\x5f\150\x61\163\x68" => csrf_hash()]);
 }
 }
 /**
 * GET aigenerator/listmodels
 * Mengambil daftar model Gemini terbaru langsung dari server Google AI (mendukung Gemini 2.5, 3.0, dst)
 */
 public function listmodels()
 {
 if (!$this->isAuthorized()) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x41\153\x73\145\x73\40\x64\151\x74\157\x6c\141\x6b\56"]);
 }
 try {
 $_0x7be9 = $this->getAiConfig();
 $_0xbeda = trim((string) ($this->request->getGet("\x61\160\x69\137\x6b\145\x79") ?: $_0x7be9["\x61\160\x69\137\x6b\145\x79"] ?? ''));
 if (empty($_0xbeda)) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x4d\141\x73\165\x6b\153\x61\156\x20\141\x74\141\x75\40\x73\151\x6d\160\x61\156\x20\101\x50\111\x20\113\x65\171\x20\164\x65\162\x6c\145\x62\151\x68\40\x64\141\x68\165\x6c\165\x20\165\x6e\164\x75\153\x20\155\x65\155\x75\141\x74\40\x64\141\x66\164\x61\162\x20\155\x6f\144\x65\154\x20\144\x61\162\x69\40\x47\157\x6f\147\x6c\145\x2e"]);
 }
 $_0xfbc7 = "\x68\164\x74\160\x73\72\x2f\57\x67\145\x6e\145\x72\141\x74\151\x76\145\x6c\141\x6e\147\x75\141\x67\145\x2e\147\x6f\157\x67\154\x65\141\x70\151\x73\56\x63\157\x6d\57\x76\61\x62\145\x74\141\x2f\155\x6f\144\x65\154\x73";
 $_0x722d = curl_init($_0xfbc7);
 curl_setopt_array($_0x722d, [CURLOPT_RETURNTRANSFER => true, CURLOPT_HTTPHEADER => ["\x78\55\x67\157\x6f\147\x2d\141\x70\151\x2d\153\x65\171\x3a\40" . $_0xbeda], CURLOPT_TIMEOUT => 20, CURLOPT_CONNECTTIMEOUT => 10, CURLOPT_SSL_VERIFYPEER => false, CURLOPT_SSL_VERIFYHOST => 0]);
 $response = curl_exec($_0x722d);
 $_0x9e20 = (int) curl_getinfo($_0x722d, CURLINFO_HTTP_CODE);
 curl_close($_0x722d);
 $_0x21a8 = json_decode((string) $response, true);
 if ($_0x9e20 < 200 || $_0x9e20 >= 300 || empty($_0x21a8["\x6d\157\x64\145\x6c\163"])) {
 $_0x4fba = $_0x21a8["\x65\162\x72\157\x72"]["\x6d\145\x73\163\x61\147\x65"] ?? "\x47\141\x67\141\x6c\40\x6d\145\x6d\165\x61\164\x20\144\x61\146\x74\141\x72\40\x6d\157\x64\145\x6c\40\x28\110\x54\124\x50\40" . $_0x9e20 . "\x29";
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => $_0x4fba]);
 }
 $_0xd304 = [];
 foreach ($_0x21a8["\x6d\157\x64\145\x6c\163"] as $_0xe263) {
 $_0x957b = str_replace("\x6d\157\x64\145\x6c\163\x2f", '', (string) ($_0xe263["\x6e\141\x6d\145"] ?? ''));
 $_0x406d = $_0xe263["\x73\165\x70\160\x6f\162\x74\145\x64\107\x65\156\x65\162\x61\164\x69\157\x6e\115\x65\164\x68\157\x64\163"] ?? [];
 if (stripos($_0x957b, "\x67\145\x6d\151\x6e\151") !== false && in_array("\x67\145\x6e\145\x72\141\x74\145\x43\157\x6e\164\x65\156\x74", $_0x406d, true)) {
 $_0xd304[] = ["\x69\144" => $_0x957b, "\x74\151\x74\154\x65" => ($_0xe263["\x64\151\x73\160\x6c\141\x79\116\x61\155\x65"] ?? $_0x957b) . "\x20\50" . $_0x957b . "\x29"];
 }
 }
 // Urutkan agar versi terbaru (3.x / 2.5) berada di atas
 usort($_0xd304, function ($_0x380a, $_0x784e) {
 return strcmp($_0x784e["\x69\144"], $_0x380a["\x69\144"]);
 });
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => true, "\x6d\157\x64\145\x6c\163" => $_0xd304]);
 } catch (\Throwable $_0x929e) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => $_0x929e->getMessage()]);
 }
 }
 /**
 * Mengekstrak teks jawaban utama dari parts Gemini (melewati blok internal thought)
 */
 private function extractCandidateText(array $_0x5e30): string
 {
 goto L_6d2d1;
 L_6d2d1:
 $_0x86ad = $_0x5e30["\x63\141\x6e\144\x69\144\x61\164\x65\163"][0]["\x63\157\x6e\164\x65\156\x74"]["\x70\141\x72\164\x73"] ?? [];
 goto L_ac3b1;
 L_9b79b:
 return $_0x3fc5;
 L_77eb5:
 $_0x3fc5 = '';
 goto L_9449a;
 L_9449a:
 foreach ($_0x86ad as $_0xf234) {
 if (!empty($_0xf234["\x74\150\x6f\165\x67\150\x74"])) {
 continue;
 }
 if (isset($_0xf234["\x74\145\x78\164"])) {
 $_0x3fc5 .= (string) $_0xf234["\x74\145\x78\164"];
 }
 }
 goto L_c3710;
 L_c3710:
 if ($_0x3fc5 === '' && isset($_0x86ad[0]["\x74\145\x78\164"])) {
 $_0x3fc5 = (string) $_0x86ad[0]["\x74\145\x78\164"];
 }
 goto L_9b79b;
 L_ac3b1:
 if (!is_array($_0x86ad) || empty($_0x86ad)) {
 return '';
 }
 goto L_77eb5;
 }
 /**
 * Memanggil Google Gemini REST API dengan fallback model otomatis
 */
 private function callGeminiApi(string $_0xd82d, bool $_0x41e1 = true, ?string $_0x3aaf = null, ?string $_0xda43 = null, int $_0xdfcf = 8192): array
 {
 goto L_5397c;
 L_efff5:
 if (empty($_0x9b2c)) {
 return ["\x73\165\x63\143\x65\163\x73" => false, "\x65\162\x72\157\x72" => "\x41\120\x49\40\x4b\145\x79\40\x47\145\x6d\151\x6e\151\x20\142\x65\154\x75\155\x20\144\x69\141\x74\165\x72\56\x20\123\x69\154\x61\153\x61\156\x20\141\x74\165\x72\40\x41\120\x49\40\x4b\145\x79\40\x74\145\x72\154\x65\142\x69\150\x20\144\x61\150\x75\154\x75\40\x6d\145\x6c\141\x6c\165\x69\40\x6d\145\x6e\165\x20\104\x61\164\x61\40\x55\155\x75\155\x20\55\x3e\40\x50\145\x6e\147\x61\164\x75\162\x61\156\x20\101\x50\111\x20\101\x49\56"];
 }
 goto L_259ba;
 L_5397c:
 $_0xb011 = $this->getAiConfig();
 goto L_5723c;
 L_69054:
 $_0xb9e5 = "\x47\141\x67\141\x6c\40\x6d\145\x6e\147\x68\165\x62\165\x6e\147\x69\40\x6c\141\x79\141\x6e\141\x6e\40\x47\157\x6f\147\x6c\145\x20\107\x65\155\x69\156\x69\40\x41\120\x49\56";
 goto L_42577;
 L_b5ebe:
 $_0x11eb = $_0x3aaf !== null && trim($_0x3aaf) !== '' ? trim($_0x3aaf) : ($_0xb011["\x6d\157\x64\145\x6c"] ?: "\x67\145\x6d\151\x6e\151\x2d\62\x2e\65\x2d\146\x6c\141\x73\150");
 goto L_cf3ae;
 L_259ba:
 if (!function_exists("\x63\165\x72\154\x5f\151\x6e\151\x74")) {
 return ["\x73\165\x63\143\x65\163\x73" => false, "\x65\162\x72\157\x72" => "\x45\153\x73\164\x65\156\x73\151\x20\120\x48\120\x20\143\x55\122\x4c\40\x62\145\x6c\165\x6d\40\x61\153\x74\151\x66\40\x64\151\x20\163\x65\162\x76\145\x72\40\x69\156\x69\56"];
 }
 goto L_b5ebe;
 L_8884a:
 return ["\x73\165\x63\143\x65\163\x73" => false, "\x65\162\x72\157\x72" => $_0xb9e5, "\x66\141\x69\154\x65\144\x5f\141\x74\164\x65\155\x70\164\x73" => $_0xc814];
 L_5723c:
 $_0x9b2c = $_0xda43 !== null && trim($_0xda43) !== '' ? trim($_0xda43) : $_0xb011["\x61\160\x69\137\x6b\145\x79"] ?? '';
 goto L_efff5;
 L_5979d:
 foreach ($_0x5dc8 as $_0xb224) {
 $_0xc72a = "\x68\164\x74\160\x73\72\x2f\57\x67\145\x6e\145\x72\141\x74\151\x76\145\x6c\141\x6e\147\x75\141\x67\145\x2e\147\x6f\157\x67\154\x65\141\x70\151\x73\56\x63\157\x6d\57\x76\61\x62\145\x74\141\x2f\155\x6f\144\x65\154\x73\57" . rawurlencode($_0xb224) . "\x3a\147\x65\156\x65\162\x61\164\x65\103\x6f\156\x74\145\x6e\164";
 $_0xe7cb = stripos($_0xb224, "\x67\145\x6d\151\x6e\151\x2d\64") !== false;
 $_0x8458 = stripos($_0xb224, "\x67\145\x6d\151\x6e\151\x2d\63") !== false;
 $_0xd6cc = ["\x6d\141\x78\117\x75\164\x70\165\x74\124\x6f\153\x65\156\x73" => max($_0xdfcf, $_0xe7cb || $_0x8458 ? 16384 : 8192)];
 if (!$_0xe7cb) {
 $_0xd6cc["\x74\145\x6d\160\x65\162\x61\164\x75\162\x65"] = 0.65;
 $_0xd6cc["\x74\157\x70\120"] = 0.9;
 }
 if ($_0x41e1) {
 $_0xd6cc["\x72\145\x73\160\x6f\156\x73\145\x4d\151\x6d\145\x54\171\x70\145"] = "\x61\160\x70\154\x69\143\x61\164\x69\157\x6e\57\x6a\163\x6f\156";
 }
 $_0xbaca = ["\x63\157\x6e\164\x65\156\x74\163" => [["\x72\157\x6c\145" => "\x75\163\x65\162", "\x70\141\x72\164\x73" => [["\x74\145\x78\164" => $_0xd82d]]]], "\x67\145\x6e\145\x72\141\x74\151\x6f\156\x43\157\x6e\146\x69\147" => $_0xd6cc];
 $_0x298d = curl_init($_0xc72a);
 curl_setopt_array($_0x298d, [CURLOPT_RETURNTRANSFER => true, CURLOPT_POST => true, CURLOPT_HTTPHEADER => ["\x43\157\x6e\164\x65\156\x74\55\x54\171\x70\145\x3a\40\x61\160\x70\154\x69\143\x61\164\x69\157\x6e\57\x6a\163\x6f\156", "\x78\55\x67\157\x6f\147\x2d\141\x70\151\x2d\153\x65\171\x3a\40" . $_0x9b2c], CURLOPT_POSTFIELDS => json_encode($_0xbaca, JSON_UNESCAPED_UNICODE), CURLOPT_TIMEOUT => 60, CURLOPT_CONNECTTIMEOUT => 15, CURLOPT_SSL_VERIFYPEER => false, CURLOPT_SSL_VERIFYHOST => 0]);
 $response = curl_exec($_0x298d);
 $_0xc2ed = (int) curl_getinfo($_0x298d, CURLINFO_HTTP_CODE);
 $_0xfa70 = curl_error($_0x298d);
 curl_close($_0x298d);
 if ($response === false || !empty($_0xfa70)) {
 $_0xb9e5 = "\x4b\157\x6e\145\x6b\163\x69\40\x6b\145\x20\107\x6f\157\x67\154\x65\40\x47\145\x6d\151\x6e\151\x20\147\x61\147\x61\154\x3a\40" . $_0xfa70;
 $_0xc814[] = ["\x6d\157\x64\145\x6c" => $_0xb224, "\x65\162\x72\157\x72" => $_0xb9e5];
 continue;
 }
 $_0xc7de = json_decode($response, true);
 if ($_0xc2ed >= 200 && $_0xc2ed < 300 && is_array($_0xc7de)) {
 $_0x384f = $this->extractCandidateText($_0xc7de);
 if ($_0x384f !== '') {
 return ["\x73\165\x63\143\x65\163\x73" => true, "\x74\145\x78\164" => $_0x384f, "\x6d\157\x64\145\x6c" => $_0xb224, "\x70\162\x65\146\x65\162\x72\145\x64\137\x6d\157\x64\145\x6c" => $_0x11eb, "\x66\141\x6c\154\x62\141\x63\153\x5f\165\x73\145\x64" => $_0xb224 !== $_0x11eb, "\x66\141\x69\154\x65\144\x5f\141\x74\164\x65\155\x70\164\x73" => $_0xc814];
 }
 }
 $_0xe94d = $_0xc7de["\x65\162\x72\157\x72"]["\x6d\145\x73\163\x61\147\x65"] ?? "\x48\124\x54\120\x20" . $_0xc2ed;
 $_0xb9e5 = "\x47\145\x6d\151\x6e\151\x20\101\x50\111\x20\50" . $_0xb224 . "\x29\72\x20" . $_0xe94d;
 $_0xc814[] = ["\x6d\157\x64\145\x6c" => $_0xb224, "\x65\162\x72\157\x72" => $_0xe94d];
 if (stripos($_0xe94d, "\x41\120\x49\137\x4b\105\x59\137\x49\116\x56\101\x4c\111\x44") !== false || stripos($_0xe94d, "\x41\120\x49\40\x6b\145\x79\40\x6e\157\x74\40\x76\141\x6c\151\x64") !== false) {
 break;
 }
 }
 goto L_8884a;
 L_42577:
 $_0xc814 = [];
 goto L_5979d;
 L_cf3ae:
 $_0x5dc8 = array_values(array_unique([$_0x11eb, "\x67\145\x6d\151\x6e\151\x2d\62\x2e\65\x2d\146\x6c\141\x73\150", "\x67\145\x6d\151\x6e\151\x2d\62\x2e\65\x2d\160\x72\157", "\x67\145\x6d\151\x6e\151\x2d\62\x2e\60\x2d\146\x6c\141\x73\150"]));
 goto L_69054;
 }
 /**
 * Membersihkan dan mem-parsing output JSON dari Gemini
 */
 private function extractJsonFromText(string $_0x719d)
 {
 goto L_14c16;
 L_8b364:
 $_0x39d6 = strrpos($_0x6878, "\x7d");
 goto L_dd93f;
 L_5384e:
 $_0x6878 = preg_replace("\x2f\134\x73\52\x60\140\x60\44\x2f", '', $_0x6878);
 goto L_ed81d;
 L_14c16:
 $_0x6878 = trim($_0x719d);
 goto L_1c26e;
 L_4e2e8:
 return null;
 L_cb0cf:
 $_0xa2d8 = strpos($_0x6878, "\x7b");
 goto L_8b364;
 L_ed81d:
 $_0x6878 = trim($_0x6878);
 goto L_bc117;
 L_bc117:
 $_0xaeaf = json_decode($_0x6878, true);
 goto L_9a7b4;
 L_1c26e:
 $_0x6878 = preg_replace("\x2f\136\x60\140\x60\50\x3f\72\x6a\163\x6f\156\x29\77\x5c\163\x2a\57\x69", '', $_0x6878);
 goto L_5384e;
 L_dd93f:
 if ($_0xa2d8 !== false && $_0x39d6 !== false && $_0x39d6 > $_0xa2d8) {
 $_0xd4b9 = substr($_0x6878, $_0xa2d8, $_0x39d6 - $_0xa2d8 + 1);
 $_0xfee6 = json_decode($_0xd4b9, true);
 if (json_last_error() === JSON_ERROR_NONE && is_array($_0xfee6)) {
 return $_0xfee6;
 }
 }
 goto L_4e2e8;
 L_9a7b4:
 if (json_last_error() === JSON_ERROR_NONE && is_array($_0xaeaf)) {
 return $_0xaeaf;
 }
 goto L_cb0cf;
 }
 /**
 * POST aigenerator/generatesoal
 * Menghasilkan butir soal CBT (1 soal ke editor ATAU paket banyak soal sekaligus ke database)
 */
 public function generatesoal()
 {
 if (!$this->isAuthorized()) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x53\145\x73\151\x20\164\x65\154\x61\150\x20\142\x65\162\x61\153\x68\151\x72\56\x20\123\x69\154\x61\153\x61\156\x20\155\x75\141\x74\40\x75\154\x61\156\x67\40\x68\141\x6c\141\x6d\141\x6e\56", "\x63\163\x72\146\x5f\150\x61\163\x68" => csrf_hash()]);
 }
 try {
 $_0x761e = (int) $this->request->getPost("\x62\141\x6e\153\x5f\151\x64");
 $_0xf308 = (string) ($this->request->getPost("\x6a\145\x6e\151\x73") ?: "\x31");
 $_0x4f77 = (int) ($this->request->getPost("\x6e\157\x6d\157\x72\137\x73\157\x61\154") ?: 1);
 $_0xd884 = (string) ($this->request->getPost("\x6d\157\x64\145") ?: "\x73\151\x6e\147\x6c\145");
 // 'single' atau 'batch'
 $_0x6b42 = max(1, min(20, (int) ($this->request->getPost("\x6a\165\x6d\154\x61\150\x5f\163\x6f\141\x6c") ?: 1)));
 if ($_0xd884 === "\x73\151\x6e\147\x6c\145") {
 $_0x6b42 = 1;
 }
 $_0x57a3 = trim((string) $this->request->getPost("\x74\157\x70\151\x6b"));
 $_0x8379 = trim((string) ($this->request->getPost("\x6b\145\x73\165\x6c\151\x74\141\x6e") ?: "\x53\145\x64\141\x6e\147\x20\50\x4d\117\x54\123\x29"));
 $_0x9cf9 = stripos($_0x8379, "\x48\117\x54\123") !== false && stripos($_0x8379, "\x43\141\x6d\160\x75\162\x61\156") === false ? 1 : 0;
 (new \App\Models\CbtModel())->ensureHotsSchema();
 $_0x3de6 = trim((string) $this->request->getPost("\x69\156\x73\164\x72\165\x6b\163\x69\137\x74\141\x6d\142\x61\150\x61\156"));
 if ($_0x57a3 === '') {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x54\157\x70\151\x6b\40\x2f\40\x4d\141\x74\145\x72\151\x20\57\x20\124\x75\152\x75\141\x6e\40\x50\145\x6d\142\x65\154\x61\152\x61\162\x61\156\x20\167\x61\152\x69\142\x20\144\x69\151\x73\151\x2e", "\x63\163\x72\146\x5f\150\x61\163\x68" => csrf_hash()]);
 }
 // Ambil informasi Bank Soal secara aman
 $_0x3903 = $this->db->table("\x63\142\x74\137\x62\141\x6e\153\x5f\163\x6f\141\x6c\40\x61")->select("\x61\56\x2a\54\x20\142\x2e\156\x61\155\x61\137\x6d\141\x70\145\x6c")->join("\x6d\141\x73\164\x65\162\x5f\155\x61\160\x65\154\x20\142", "\x62\56\x69\144\x5f\155\x61\160\x65\154\x20\75\x20\141\x2e\142\x61\156\x6b\137\x6d\141\x70\145\x6c\137\x69\144", "\x6c\145\x66\164")->where("\x61\56\x69\144\x5f\142\x61\156\x6b", $_0x761e)->get()->getRow();
 $_0x90c7 = $_0x3903->nama_mapel ?? "\x4d\141\x74\141\x20\120\x65\154\x61\152\x61\162\x61\156\x20\125\x6d\165\x6d";
 $_0xc4fa = $_0x3903->bank_level ?? '';
 $_0x370f = isset($_0x3903->opsi) && (int) $_0x3903->opsi >= 3 ? (int) $_0x3903->opsi : 5;
 $_0x9e2e = "\x41\54\x20\102\x2c\40\x43\54\x20\104\x2c\40\x45";
 if ($_0x370f === 3) {
 $_0x9e2e = "\x41\54\x20\102\x2c\40\x43";
 } elseif ($_0x370f === 4) {
 $_0x9e2e = "\x41\54\x20\102\x2c\40\x43\54\x20\104";
 }
 $_0xb2be = '';
 if ($_0xf308 === "\x31") {
 $_0xb2be = <<<EOT
 Jenis Soal: Pilihan Ganda Biasa (1 Jawaban Benar) dengan {$_0x370f} pilihan ({$_0x9e2e}).
 Format JSON yang WAJIB dikembalikan:
 {
 "items": [
 {
 "soal": "<p>Teks pertanyaan lengkap dan jelas (boleh memuat kutipan/stimulus/tabel HTML jika relevan)...</p>",
 "opsi_a": "<p>Teks pilihan A</p>",
 "opsi_b": "<p>Teks pilihan B</p>",
 "opsi_c": "<p>Teks pilihan C</p>",
 "opsi_d": "<p>Teks pilihan D</p>",
 "opsi_e": "<p>Teks pilihan E</p>",
 "jawaban": "a"
 }
 ]
 }
 Catatan Penting Pilihan Ganda:
 - Jangan tuliskan huruf "A.", "B.", dst di dalam teks opsi karena sistem sudah menampilkan label abjad secara otomatis.
 - Field "jawaban" wajib berisi 1 huruf kecil kunci jawaban yang benar ("a", "b", "c", "d", atau "e") sesuai jumlah opsi ({$_0x9e2e}).
 EOT;
 } elseif ($_0xf308 === "\x32") {
 $_0xb2be = "\x4a\145\x6e\151\x73\40\x53\157\x61\154\x3a\40\x50\151\x6c\151\x68\141\x6e\40\x47\141\x6e\144\x61\40\x4b\157\x6d\160\x6c\145\x6b\163\x20\50\x4c\145\x62\151\x68\40\x64\141\x72\151\x20\61\x20\112\x61\167\x61\142\x61\156\x20\102\x65\156\x61\162\x2c\40\x74\145\x72\144\x61\160\x61\164\x20\65\x20\157\x70\163\x69\40\x41\40\x73\141\x6d\160\x61\151\x20\105\x20\144\x61\156\x20\62\x20\141\x74\141\x75\40\x33\40\x6b\165\x6e\143\x69\40\x6a\141\x77\141\x62\141\x6e\40\x62\145\x6e\141\x72\51\x2e\12\x46\157\x72\155\x61\164\x20\112\x53\117\x4e\40\x79\141\x6e\147\x20\127\x41\112\x49\102\x20\144\x69\153\x65\155\x62\141\x6c\151\x6b\141\x6e\72\xa\173\xa\40\x20\42\x69\164\x65\155\x73\42\x3a\40\x5b\12\x20\40\x20\40\x7b\12\x20\40\x20\40\x20\40\x22\163\x6f\141\x6c\42\x3a\40\x22\74\x70\76\x54\145\x6b\163\x20\160\x65\162\x74\141\x6e\171\x61\141\x6e\40\x50\151\x6c\151\x68\141\x6e\40\x47\141\x6e\144\x61\40\x4b\157\x6d\160\x6c\145\x6b\163\x20\50\x50\151\x6c\151\x68\154\x61\150\x20\154\x65\142\x69\150\x20\144\x61\162\x69\40\x73\141\x74\165\x20\152\x61\167\x61\142\x61\156\x20\171\x61\156\x67\40\x62\145\x6e\141\x72\51\x2e\56\x2e\74\x2f\160\x3e\42\x2c\12\x20\40\x20\40\x20\40\x22\157\x70\163\x69\137\x70\147\x32\42\x3a\40\x7b\12\x20\40\x20\40\x20\40\x20\40\x22\141\x22\72\x20\42\x3c\160\x3e\120\x65\162\x6e\171\x61\164\x61\141\x6e\40\x70\151\x6c\151\x68\141\x6e\40\x41\74\x2f\160\x3e\42\x2c\12\x20\40\x20\40\x20\40\x20\40\x22\142\x22\72\x20\42\x3c\160\x3e\120\x65\162\x6e\171\x61\164\x61\141\x6e\40\x70\151\x6c\151\x68\141\x6e\40\x42\74\x2f\160\x3e\42\x2c\12\x20\40\x20\40\x20\40\x20\40\x22\143\x22\72\x20\42\x3c\160\x3e\120\x65\162\x6e\171\x61\164\x61\141\x6e\40\x70\151\x6c\151\x68\141\x6e\40\x43\74\x2f\160\x3e\42\x2c\12\x20\40\x20\40\x20\40\x20\40\x22\144\x22\72\x20\42\x3c\160\x3e\120\x65\162\x6e\171\x61\164\x61\141\x6e\40\x70\151\x6c\151\x68\141\x6e\40\x44\74\x2f\160\x3e\42\x2c\12\x20\40\x20\40\x20\40\x20\40\x22\145\x22\72\x20\42\x3c\160\x3e\120\x65\162\x6e\171\x61\164\x61\141\x6e\40\x70\151\x6c\151\x68\141\x6e\40\x45\74\x2f\160\x3e\42\xa\40\x20\40\x20\40\x20\175\x2c\12\x20\40\x20\40\x20\40\x22\152\x61\167\x61\142\x61\156\x5f\160\x67\62\x22\72\x20\133\x22\141\x22\54\x20\42\x63\42\x5d\12\x20\40\x20\40\x7d\12\x20\40\x5d\12\x7d";
 } elseif ($_0xf308 === "\x33") {
 $_0xb2be = "\x4a\145\x6e\151\x73\40\x53\157\x61\154\x3a\40\x4d\145\x6e\152\x6f\144\x6f\150\x6b\141\x6e\40\x28\115\x65\155\x61\163\x61\156\x67\153\x61\156\x20\160\x65\162\x6e\171\x61\164\x61\141\x6e\40\x64\151\x20\102\x61\162\x69\163\x20\113\x69\162\x69\40\x64\145\x6e\147\x61\156\x20\160\x61\163\x61\156\x67\141\x6e\40\x79\141\x6e\147\x20\164\x65\160\x61\164\x20\144\x69\40\x4b\157\x6c\157\x6d\40\x4b\141\x6e\141\x6e\54\x20\164\x65\162\x64\151\x72\151\x20\144\x61\162\x69\40\x33\40\x61\164\x61\165\x20\64\x20\160\x61\163\x61\156\x67\40\x70\145\x72\156\x79\141\x74\141\x61\156\x29\56\xa\106\x6f\162\x6d\141\x74\40\x4a\123\x4f\116\x20\171\x61\156\x67\40\x57\101\x4a\111\x42\40\x64\151\x6b\145\x6d\142\x61\154\x69\153\x61\156\x3a\12\x7b\12\x20\40\x22\151\x74\145\x6d\163\x22\72\x20\133\xa\40\x20\40\x20\173\xa\40\x20\40\x20\40\x20\42\x73\157\x61\154\x22\72\x20\42\x3c\160\x3e\120\x61\163\x61\156\x67\153\x61\156\x6c\141\x68\40\x70\145\x72\156\x79\141\x74\141\x61\156\x20\142\x65\162\x69\153\x75\164\x20\144\x65\156\x67\141\x6e\40\x6a\141\x77\141\x62\141\x6e\40\x79\141\x6e\147\x20\164\x65\160\x61\164\x21\74\x2f\160\x3e\42\x2c\12\x20\40\x20\40\x20\40\x22\160\x61\163\x61\156\x67\141\x6e\42\x3a\40\x5b\12\x20\40\x20\40\x20\40\x20\40\x7b\42\x62\141\x72\151\x73\42\x3a\40\x22\120\x65\162\x6e\171\x61\164\x61\141\x6e\40\x31\42\x2c\40\x22\153\x6f\154\x6f\155\x22\72\x20\42\x50\141\x73\141\x6e\147\x61\156\x20\102\x65\156\x61\162\x20\61\x22\175\x2c\12\x20\40\x20\40\x20\40\x20\40\x7b\42\x62\141\x72\151\x73\42\x3a\40\x22\120\x65\162\x6e\171\x61\164\x61\141\x6e\40\x32\42\x2c\40\x22\153\x6f\154\x6f\155\x22\72\x20\42\x50\141\x73\141\x6e\147\x61\156\x20\102\x65\156\x61\162\x20\62\x22\175\x2c\12\x20\40\x20\40\x20\40\x20\40\x7b\42\x62\141\x72\151\x73\42\x3a\40\x22\120\x65\162\x6e\171\x61\164\x61\141\x6e\40\x33\42\x2c\40\x22\153\x6f\154\x6f\155\x22\72\x20\42\x50\141\x73\141\x6e\147\x61\156\x20\102\x65\156\x61\162\x20\63\x22\175\xa\40\x20\40\x20\40\x20\135\xa\40\x20\40\x20\175\xa\40\x20\135\xa\175";
 } elseif ($_0xf308 === "\x34") {
 $_0xb2be = "\x4a\145\x6e\151\x73\40\x53\157\x61\154\x3a\40\x49\163\x69\141\x6e\40\x53\151\x6e\147\x6b\141\x74\40\x28\112\x61\167\x61\142\x61\156\x20\142\x65\162\x75\160\x61\40\x31\40\x6b\141\x74\141\x2c\40\x61\156\x67\153\x61\54\x20\141\x74\141\x75\40\x69\163\x74\151\x6c\141\x68\40\x73\151\x6e\147\x6b\141\x74\40\x79\141\x6e\147\x20\160\x61\163\x74\151\x29\56\xa\106\x6f\162\x6d\141\x74\40\x4a\123\x4f\116\x20\171\x61\156\x67\40\x57\101\x4a\111\x42\40\x64\151\x6b\145\x6d\142\x61\154\x69\153\x61\156\x3a\12\x7b\12\x20\40\x22\151\x74\145\x6d\163\x22\72\x20\133\xa\40\x20\40\x20\173\xa\40\x20\40\x20\40\x20\42\x73\157\x61\154\x22\72\x20\42\x3c\160\x3e\124\x65\153\x73\40\x70\145\x72\164\x61\156\x79\141\x61\156\x20\151\x73\151\x61\156\x20\163\x69\156\x67\153\x61\164\x20\171\x61\156\x67\40\x6a\145\x6c\141\x73\56\x2e\56\x3c\57\x70\76\x22\54\xa\40\x20\40\x20\40\x20\42\x6a\141\x77\141\x62\141\x6e\42\x3a\40\x22\113\x61\164\x61\57\x49\163\x74\151\x6c\141\x68\40\x4b\165\x6e\143\x69\40\x53\151\x6e\147\x6b\141\x74\42\xa\40\x20\40\x20\175\xa\40\x20\135\xa\175\xa\103\x61\164\x61\164\x61\156\x3a\40\x46\151\x65\154\x64\40\x22\152\x61\167\x61\142\x61\156\x22\40\x75\156\x74\165\x6b\40\x49\163\x69\141\x6e\40\x53\151\x6e\147\x6b\141\x74\40\x68\141\x72\165\x73\40\x62\145\x72\165\x70\141\x20\164\x65\153\x73\40\x62\151\x61\163\x61\40\x54\101\x4e\120\x41\40\x74\141\x67\40\x48\124\x4d\114\x20\50\x63\157\x6e\164\x6f\150\x3a\40\x22\106\x6f\164\x6f\163\x69\156\x74\145\x73\151\x73\42\x20\141\x74\141\x75\40\x22\61\x39\64\x35\42\x29\56";
 } else {
 $_0xb2be = "\x4a\145\x6e\151\x73\40\x53\157\x61\154\x3a\40\x45\163\x73\141\x69\40\x2f\40\x55\162\x61\151\x61\156\x2e\12\x46\157\x72\155\x61\164\x20\112\x53\117\x4e\40\x79\141\x6e\147\x20\127\x41\112\x49\102\x20\144\x69\153\x65\155\x62\141\x6c\151\x6b\141\x6e\72\xa\173\xa\40\x20\42\x69\164\x65\155\x73\42\x3a\40\x5b\12\x20\40\x20\40\x7b\12\x20\40\x20\40\x20\40\x22\163\x6f\141\x6c\42\x3a\40\x22\74\x70\76\x54\145\x6b\163\x20\160\x65\162\x74\141\x6e\171\x61\141\x6e\40\x75\162\x61\151\x61\156\x2f\145\x73\163\x61\151\x2e\56\x2e\74\x2f\160\x3e\42\x2c\12\x20\40\x20\40\x20\40\x22\152\x61\167\x61\142\x61\156\x22\72\x20\42\x3c\160\x3e\74\x62\76\x4b\165\x6e\143\x69\40\x4a\141\x77\141\x62\141\x6e\40\x26\141\x6d\160\x3b\40\x52\165\x62\162\x69\153\x20\120\x65\156\x69\154\x61\151\x61\156\x3a\74\x2f\142\x3e\74\x62\162\x3e\61\x2e\40\x2e\56\x2e\74\x62\162\x3e\62\x2e\40\x2e\56\x2e\74\x2f\160\x3e\42\xa\40\x20\40\x20\175\xa\40\x20\135\xa\175";
 }
 $_0x687d = $_0x3de6 !== '' ? "Instruksi Khusus dari Guru: {$_0x3de6}\n" : '';
 $_0x9701 = <<<EOT
 Anda adalah Pakar Penyusun Soal Asesmen Pendidikan Indonesia (Kurikulum Merdeka & K-13).
 Tugas Anda: Buatlah tepat {$_0x6b42} butir soal berkualitas tinggi dalam Bahasa Indonesia yang baku, jelas, dan edukatif.
 
 Konteks Bank Soal:
 - Mata Pelajaran: {$_0x90c7}
 - Tingkat Kelas: Kelas {$_0xc4fa}
 - Topik / Materi / Tujuan Pembelajaran: {$_0x57a3}
 - Tingkat Kesulitan: {$_0x8379}
 {$_0x687d}
 {$_0xb2be}
 
 Kembalikan HANYA JSON murni yang valid sesuai format di atas tanpa teks pengantar apa pun. Pastikan array "items" berisi tepat {$_0x6b42} objek soal.
 EOT;
 $_0x5876 = $this->callGeminiApi($_0x9701, true);
 if (!$_0x5876["\x73\165\x63\143\x65\163\x73"]) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => $_0x5876["\x65\162\x72\157\x72"], "\x63\163\x72\146\x5f\150\x61\163\x68" => csrf_hash()]);
 }
 $_0x88b0 = $this->extractJsonFromText($_0x5876["\x74\145\x78\164"]);
 if (!$_0x88b0 || empty($_0x88b0["\x69\164\x65\155\x73"]) || !is_array($_0x88b0["\x69\164\x65\155\x73"])) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x52\145\x73\160\x6f\156\x73\40\x41\111\x20\164\x69\144\x61\153\x20\144\x61\160\x61\164\x20\144\x69\160\x72\157\x73\145\x73\40\x6d\145\x6e\152\x61\144\x69\40\x73\164\x72\165\x6b\164\x75\162\x20\163\x6f\141\x6c\56\x20\123\x69\154\x61\153\x61\156\x20\143\x6f\142\x61\40\x6b\154\x69\153\x20\107\x65\156\x65\162\x61\164\x65\40\x6b\145\x6d\142\x61\154\x69\56", "\x63\163\x72\146\x5f\150\x61\163\x68" => csrf_hash()]);
 }
 $_0xcb6c = $_0x88b0["\x69\164\x65\155\x73"];
 foreach ($_0xcb6c as &$_0x341a) {
 if ($_0xf308 === "\x33") {
 $_0x3e5e = $_0x341a["\x70\141\x73\141\x6e\147\x61\156"] ?? [];
 $_0x420b = ["\x23"];
 $_0x9856 = [];
 foreach ($_0x3e5e as $_0xa4eb => $_0x4233) {
 $_0x1b27 = trim(strip_tags((string) ($_0x4233["\x6b\157\x6c\157\x6d"] ?? "\x4b\157\x6c\157\x6d\40" . ($_0xa4eb + 1))));
 $_0x420b[] = $_0x1b27;
 }
 foreach ($_0x3e5e as $_0xa4eb => $_0x4233) {
 $_0x9718 = trim(strip_tags((string) ($_0x4233["\x62\141\x72\151\x73"] ?? "\x42\141\x72\151\x73\40" . ($_0xa4eb + 1))));
 $_0x2ec8 = [$_0x9718];
 for ($_0x15b4 = 0; $_0x15b4 < count($_0x3e5e); $_0x15b4++) {
 $_0x2ec8[] = $_0x15b4 === $_0xa4eb ? "\x31" : "\x30";
 }
 $_0x9856[] = $_0x2ec8;
 }
 $_0xad32 = array_merge([$_0x420b], $_0x9856);
 $_0x341a["\x6a\157\x64\157\x68\153\x61\156\x5f\144\x61\164\x61"] = ["\x6d\157\x64\145\x6c" => "\x31", "\x74\171\x70\145" => "\x32", "\x6a\141\x77\141\x62\141\x6e" => $_0xad32];
 }
 }
 unset($_0x341a);
 // MODE 1: Single (Isi ke Editor Nomor Aktif)
 if ($_0xd884 === "\x73\151\x6e\147\x6c\145") {
 $_0xf682 = $_0xcb6c[0];
 $_0xf682["\x69\163\x5f\150\x6f\164\x73"] = isset($_0xf682["\x69\163\x5f\150\x6f\164\x73"]) ? (int) $_0xf682["\x69\163\x5f\150\x6f\164\x73"] === 1 ? 1 : 0 : $_0x9cf9;
 $_0x5e12 = 0;
 if ($_0x761e > 0 && $_0x4f77 > 0) {
 $_0x4073 = $this->db->table("\x63\142\x74\137\x73\157\x61\154")->where("\x62\141\x6e\153\x5f\151\x64", $_0x761e)->where("\x6a\145\x6e\151\x73", $_0xf308)->where("\x6e\157\x6d\157\x72\137\x73\157\x61\154", $_0x4f77)->get()->getRow();
 if ($_0x4073) {
 $_0x5e12 = (int) $_0x4073->id_soal;
 } else {
 $this->db->table("\x63\142\x74\137\x73\157\x61\154")->insert(["\x62\141\x6e\153\x5f\151\x64" => $_0x761e, "\x6e\157\x6d\157\x72\137\x73\157\x61\154" => $_0x4f77, "\x6a\145\x6e\151\x73" => $_0xf308, "\x74\141\x6d\160\x69\154\x6b\141\x6e" => 0, "\x69\163\x5f\150\x6f\164\x73" => (int) $_0xf682["\x69\163\x5f\150\x6f\164\x73"], "\x63\162\x65\141\x74\145\x64\137\x6f\156" => time(), "\x75\160\x64\141\x74\145\x64\137\x6f\156" => time()]);
 $_0x5e12 = (int) $this->db->insertID();
 }
 }
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => true, "\x6d\157\x64\145" => "\x73\151\x6e\147\x6c\145", "\x6a\145\x6e\151\x73" => $_0xf308, "\x6e\157\x6d\157\x72\137\x73\157\x61\154" => $_0x4f77, "\x69\144\x5f\163\x6f\141\x6c" => $_0x5e12, "\x64\141\x74\141" => $_0xf682, "\x6d\157\x64\145\x6c\137\x75\163\x65\144" => $_0x5876["\x6d\157\x64\145\x6c"] ?? "\x67\145\x6d\151\x6e\151", "\x63\163\x72\146\x5f\150\x61\163\x68" => csrf_hash()]);
 }
 // MODE 2: Batch (Simpan Paket Banyak Soal Sekaligus ke Bank Soal)
 $_0xac75 = 0;
 $_0x69e0 = $this->db->table("\x63\142\x74\137\x73\157\x61\154")->where("\x62\141\x6e\153\x5f\151\x64", $_0x761e)->where("\x6a\145\x6e\151\x73", $_0xf308)->orderBy("\x6e\157\x6d\157\x72\137\x73\157\x61\154", "\x41\123\x43")->get()->getResult();
 $_0x88e9 = [];
 $_0xcbda = 0;
 foreach ($_0x69e0 as $_0x9f18) {
 $_0x8c41 = (int) $_0x9f18->nomor_soal;
 if ($_0x8c41 > $_0xcbda) {
 $_0xcbda = $_0x8c41;
 }
 $_0xd964 = trim(strip_tags((string) ($_0x9f18->soal ?? '')));
 if ($_0xd964 === '') {
 $_0x88e9[$_0x8c41] = (int) $_0x9f18->id_soal;
 }
 }
 $_0x48e9 = array_keys($_0x88e9);
 $_0x5987 = 0;
 foreach ($_0xcb6c as $_0x341a) {
 $_0x7801 = (string) ($_0x341a["\x73\157\x61\154"] ?? '');
 if (trim($_0x7801) === '') {
 continue;
 }
 $_0xb61c = 0;
 $_0x9c8c = 0;
 if ($_0x5987 < count($_0x48e9)) {
 $_0xb61c = $_0x48e9[$_0x5987];
 $_0x9c8c = $_0x88e9[$_0xb61c];
 $_0x5987++;
 } else {
 $_0xcbda++;
 $_0xb61c = $_0xcbda;
 }
 $_0x82a0 = ["\x62\141\x6e\153\x5f\151\x64" => $_0x761e, "\x6a\145\x6e\151\x73" => $_0xf308, "\x6e\157\x6d\157\x72\137\x73\157\x61\154" => $_0xb61c, "\x73\157\x61\154" => $_0x7801, "\x74\141\x6d\160\x69\154\x6b\141\x6e" => 1, "\x69\163\x5f\150\x6f\164\x73" => isset($_0x341a["\x69\163\x5f\150\x6f\164\x73"]) ? (int) $_0x341a["\x69\163\x5f\150\x6f\164\x73"] === 1 ? 1 : 0 : $_0x9cf9, "\x75\160\x64\141\x74\145\x64\137\x6f\156" => time()];
 if ($_0xf308 === "\x31") {
 $_0x82a0["\x6f\160\x73\151\x5f\141"] = (string) ($_0x341a["\x6f\160\x73\151\x5f\141"] ?? '');
 $_0x82a0["\x6f\160\x73\151\x5f\142"] = (string) ($_0x341a["\x6f\160\x73\151\x5f\142"] ?? '');
 $_0x82a0["\x6f\160\x73\151\x5f\143"] = (string) ($_0x341a["\x6f\160\x73\151\x5f\143"] ?? '');
 $_0x82a0["\x6f\160\x73\151\x5f\144"] = $_0x370f >= 4 ? (string) ($_0x341a["\x6f\160\x73\151\x5f\144"] ?? '') : null;
 $_0x82a0["\x6f\160\x73\151\x5f\145"] = $_0x370f >= 5 ? (string) ($_0x341a["\x6f\160\x73\151\x5f\145"] ?? '') : null;
 $_0x82a0["\x6a\141\x77\141\x62\141\x6e"] = strtolower(trim((string) ($_0x341a["\x6a\141\x77\141\x62\141\x6e"] ?? "\x61")));
 } elseif ($_0xf308 === "\x32") {
 $_0x7902 = $_0x341a["\x6f\160\x73\151\x5f\160\x67\62"] ?? [];
 $_0xe2df = $_0x341a["\x6a\141\x77\141\x62\141\x6e\137\x70\147\x32"] ?? ["\x61"];
 $_0x82a0["\x6f\160\x73\151\x5f\141"] = json_encode($_0x7902, JSON_UNESCAPED_UNICODE);
 $_0x82a0["\x6a\141\x77\141\x62\141\x6e"] = json_encode(array_values((array) $_0xe2df), JSON_UNESCAPED_UNICODE);
 } elseif ($_0xf308 === "\x33") {
 $_0x523e = json_encode($_0x341a["\x6a\157\x64\157\x68\153\x61\156\x5f\144\x61\164\x61"], JSON_UNESCAPED_UNICODE);
 $_0x82a0["\x6f\160\x73\151\x5f\141"] = $_0x523e;
 $_0x82a0["\x6a\141\x77\141\x62\141\x6e"] = $_0x523e;
 } elseif ($_0xf308 === "\x34") {
 $_0x82a0["\x6a\141\x77\141\x62\141\x6e"] = trim(strip_tags((string) ($_0x341a["\x6a\141\x77\141\x62\141\x6e"] ?? '')));
 } else {
 $_0x82a0["\x6a\141\x77\141\x62\141\x6e"] = (string) ($_0x341a["\x6a\141\x77\141\x62\141\x6e"] ?? '');
 }
 if ($_0x9c8c > 0) {
 $this->db->table("\x63\142\x74\137\x73\157\x61\154")->where("\x69\144\x5f\163\x6f\141\x6c", $_0x9c8c)->update($_0x82a0);
 } else {
 $_0x82a0["\x63\162\x65\141\x74\145\x64\137\x6f\156"] = time();
 $this->db->table("\x63\142\x74\137\x73\157\x61\154")->insert($_0x82a0);
 }
 $_0xac75++;
 }
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => true, "\x6d\157\x64\145" => "\x62\141\x74\143\x68", "\x73\141\x76\145\x64\137\x63\157\x75\156\x74" => $_0xac75, "\x6d\145\x73\163\x61\147\x65" => "Berhasil membuat dan menyimpan {$_0xac75} butir soal baru dengan Gemini AI!", "\x6d\157\x64\145\x6c\137\x75\163\x65\144" => $_0x5876["\x6d\157\x64\145\x6c"] ?? "\x67\145\x6d\151\x6e\151", "\x63\163\x72\146\x5f\150\x61\163\x68" => csrf_hash()]);
 } catch (\Throwable $_0x55a7) {
 log_message("\x65\162\x72\157\x72", "\x5b\101\x69\107\x65\156\x65\162\x61\164\x6f\162\x3a\72\x67\145\x6e\145\x72\141\x74\145\x73\157\x61\154\x5d\40" . $_0x55a7->getMessage());
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x47\141\x67\141\x6c\40\x6d\145\x6d\160\x72\157\x73\145\x73\40\x70\145\x6d\142\x75\141\x74\141\x6e\40\x73\157\x61\154\x3a\40" . $_0x55a7->getMessage(), "\x63\163\x72\146\x5f\150\x61\163\x68" => csrf_hash()]);
 }
 }
 /**
 * POST aigenerator/generatemateri
 * Menghasilkan Materi Belajar (jenis=1) atau Tugas / LKPD Siswa (jenis=2)
 * untuk halaman elearning/materi_add.php
 */
 public function generatemateri()
 {
 if (!$this->isAuthorized()) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x53\145\x73\151\x20\164\x65\154\x61\150\x20\142\x65\162\x61\153\x68\151\x72\56\x20\123\x69\154\x61\153\x61\156\x20\155\x75\141\x74\40\x75\154\x61\156\x67\40\x68\141\x6c\141\x6d\141\x6e\56", "\x63\163\x72\146\x5f\150\x61\163\x68" => csrf_hash()]);
 }
 try {
 $_0x481f = (string) ($this->request->getPost("\x6a\145\x6e\151\x73") ?: "\x32");
 $_0x1313 = trim((string) ($this->request->getPost("\x6e\141\x6d\141\x5f\155\x61\160\x65\154") ?: "\x4d\141\x74\141\x20\120\x65\154\x61\152\x61\162\x61\156"));
 $_0x4a1b = trim((string) ($this->request->getPost("\x6e\141\x6d\141\x5f\153\x65\154\x61\163") ?: "\x53\145\x6d\165\x61\40\x4b\145\x6c\141\x73"));
 $_0x5dd3 = trim((string) $this->request->getPost("\x74\157\x70\151\x6b"));
 $_0xd21e = trim((string) ($this->request->getPost("\x66\157\x72\155\x61\164\x5f\157\x75\164\x70\165\x74") ?: "\x4c\113\x50\104\x20\46\x20\114\x61\164\x69\150\x61\156\x20\124\x65\162\x73\164\x72\165\x6b\164\x75\162"));
 $_0x42ba = trim((string) $this->request->getPost("\x69\156\x73\164\x72\165\x6b\163\x69\137\x74\141\x6d\142\x61\150\x61\156"));
 if ($_0x5dd3 === '') {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x54\157\x70\151\x6b\40\x2f\40\x4b\157\x6d\160\x65\164\x65\156\x73\151\x20\104\x61\163\x61\162\x20\57\x20\124\x75\152\x75\141\x6e\40\x50\145\x6d\142\x65\154\x61\152\x61\162\x61\156\x20\167\x61\152\x69\142\x20\144\x69\151\x73\151\x2e", "\x63\163\x72\146\x5f\150\x61\163\x68" => csrf_hash()]);
 }
 $_0x9e3d = $_0x481f === "\x31" ? "\x4d\141\x74\145\x72\151\x20\120\x65\155\x62\145\x6c\141\x6a\141\x72\141\x6e\40\x2f\40\x42\141\x68\141\x6e\40\x41\152\x61\162" : "\x54\165\x67\141\x73\40\x53\151\x73\167\x61\40\x2f\40\x4c\145\x6d\142\x61\162\x20\113\x65\162\x6a\141\x20\120\x65\163\x65\162\x74\141\x20\104\x69\144\x69\153\x20\50\x4c\113\x50\104\x29";
 $_0x1f32 = $_0x42ba !== '' ? "Instruksi Tambahan Guru: {$_0x42ba}\n" : '';
 $_0x6d09 = <<<EOT
 Anda adalah Guru Ahli & Pengembang Perangkat Ajar Kurikulum Merdeka di Indonesia.
 Susunlah {$_0x9e3d} yang rapi, menarik, terstruktur, dan siap digunakan oleh siswa di kelas maupun secara mandiri.
 
 Detail Konteks:
 - Kategori: {$_0x9e3d}
 - Mata Pelajaran: {$_0x1313}
 - Target Kelas: {$_0x4a1b}
 - Topik / Materi Pokok: {$_0x5dd3}
 - Format Penyajian: {$_0xd21e}
 {$_0x1f32}
 
 Kembalikan respons dalam format JSON valid dengan struktur berikut:
 {
 "judul": "Judul {$_0x9e3d} yang ringkas dan menarik (maksimal 90 karakter)",
 "catatan_buku": "Saran instruksi bacaan singkat untuk siswa (1 kalimat)",
 "html_content": "HTML lengkap yang rapi menggunakan inline style sederhana, heading <h5>, <ul>/<ol>, tabel <table class='table table-bordered'> bila perlu, callout box berwarna lembut, langkah pengerjaan yang jelas, soal latihan/tugas, dan petunjuk pengumpulan tugas."
 }
 
 Catatan Penting:
 - Jangan gunakan tag <html>, <head>, atau <body> di dalam "html_content", cukup elemen konten langsung (<div>, <h5>, <p>, <ol>, <table>, dll).
 - Pastikan isi sangat jelas, aplikatif, dan mudah dipahami siswa.
 EOT;
 $_0x4c70 = $this->callGeminiApi($_0x6d09, true);
 if (!$_0x4c70["\x73\165\x63\143\x65\163\x73"]) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => $_0x4c70["\x65\162\x72\157\x72"], "\x63\163\x72\146\x5f\150\x61\163\x68" => csrf_hash()]);
 }
 $_0xf5ee = $this->extractJsonFromText($_0x4c70["\x74\145\x78\164"]);
 if (!$_0xf5ee || empty($_0xf5ee["\x68\164\x6d\154\x5f\143\x6f\156\x74\145\x6e\164"])) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x52\145\x73\160\x6f\156\x73\40\x41\111\x20\164\x69\144\x61\153\x20\144\x61\160\x61\164\x20\144\x69\160\x72\157\x73\145\x73\56\x20\123\x69\154\x61\153\x61\156\x20\143\x6f\142\x61\40\x6b\154\x69\153\x20\107\x65\156\x65\162\x61\164\x65\40\x6b\145\x6d\142\x61\154\x69\56", "\x63\163\x72\146\x5f\150\x61\163\x68" => csrf_hash()]);
 }
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => true, "\x6a\165\x64\165\x6c" => trim((string) ($_0xf5ee["\x6a\165\x64\165\x6c"] ?? $_0x5dd3)), "\x63\141\x74\141\x74\141\x6e\137\x62\165\x6b\165" => trim((string) ($_0xf5ee["\x63\141\x74\141\x74\141\x6e\137\x62\165\x6b\165"] ?? '')), "\x68\164\x6d\154\x5f\143\x6f\156\x74\145\x6e\164" => (string) $_0xf5ee["\x68\164\x6d\154\x5f\143\x6f\156\x74\145\x6e\164"], "\x6d\157\x64\145\x6c\137\x75\163\x65\144" => $_0x4c70["\x6d\157\x64\145\x6c"] ?? "\x67\145\x6d\151\x6e\151", "\x63\163\x72\146\x5f\150\x61\163\x68" => csrf_hash()]);
 } catch (\Throwable $_0xab04) {
 log_message("\x65\162\x72\157\x72", "\x5b\101\x69\107\x65\156\x65\162\x61\164\x6f\162\x3a\72\x67\145\x6e\145\x72\141\x74\145\x6d\141\x74\145\x72\151\x5d\40" . $_0xab04->getMessage());
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x47\141\x67\141\x6c\40\x6d\145\x6d\160\x72\157\x73\145\x73\40\x70\145\x6d\142\x75\141\x74\141\x6e\40\x6b\157\x6e\164\x65\156\x3a\40" . $_0xab04->getMessage(), "\x63\163\x72\146\x5f\150\x61\163\x68" => csrf_hash()]);
 }
 }
 /**
 * Mencari model Gemini yang mendukung output gambar melalui endpoint :generateContent
 */
 private function discoverImageModels(string $_0x43ac): array
 {
 goto L_536f4;
 L_536f4:
 $_0x8c81 = ["\x67\145\x6d\151\x6e\151\x2d\62\x2e\65\x2d\146\x6c\141\x73\150\x2d\151\x6d\141\x67\145", "\x67\145\x6d\151\x6e\151\x2d\63\x2e\61\x2d\146\x6c\141\x73\150\x2d\151\x6d\141\x67\145\x2d\160\x72\145\x76\151\x65\167", "\x67\145\x6d\151\x6e\151\x2d\62\x2e\60\x2d\146\x6c\141\x73\150\x2d\160\x72\145\x76\151\x65\167\x2d\151\x6d\141\x67\145\x2d\147\x65\156\x65\162\x61\164\x69\157\x6e", "\x67\145\x6d\151\x6e\151\x2d\63\x2d\160\x72\157\x2d\151\x6d\141\x67\145\x2d\160\x72\145\x76\151\x65\167", "\x67\145\x6d\151\x6e\151\x2d\62\x2e\60\x2d\146\x6c\141\x73\150\x2d\145\x78\160\x2d\151\x6d\141\x67\145\x2d\147\x65\156\x65\162\x61\164\x69\157\x6e"];
 goto L_c2910;
 L_c2910:
 $_0x4d69 = [];
 goto L_ea868;
 L_f8ed3:
 return $_0x8c81;
 L_9110a:
 if (!empty($_0x4d69)) {
 $_0x7be3 = [];
 foreach ($_0x8c81 as $_0x7cc5) {
 if (in_array($_0x7cc5, $_0x4d69, true)) {
 $_0x7be3[] = $_0x7cc5;
 }
 }
 foreach ($_0x4d69 as $_0xb4ff) {
 if (!in_array($_0xb4ff, $_0x7be3, true)) {
 $_0x7be3[] = $_0xb4ff;
 }
 }
 return $_0x7be3;
 }
 goto L_f8ed3;
 L_ea868:
 if (function_exists("\x63\165\x72\154\x5f\151\x6e\151\x74")) {
 $_0xff88 = curl_init("\x68\164\x74\160\x73\72\x2f\57\x67\145\x6e\145\x72\141\x74\151\x76\145\x6c\141\x6e\147\x75\141\x67\145\x2e\147\x6f\157\x67\154\x65\141\x70\151\x73\56\x63\157\x6d\57\x76\61\x62\145\x74\141\x2f\155\x6f\144\x65\154\x73\77\x70\141\x67\145\x53\151\x7a\145\x3d\61\x30\60");
 curl_setopt_array($_0xff88, [CURLOPT_RETURNTRANSFER => true, CURLOPT_HTTPHEADER => ["\x78\55\x67\157\x6f\147\x2d\141\x70\151\x2d\153\x65\171\x3a\40" . $_0x43ac], CURLOPT_TIMEOUT => 8, CURLOPT_CONNECTTIMEOUT => 5, CURLOPT_SSL_VERIFYPEER => false, CURLOPT_SSL_VERIFYHOST => 0]);
 $_0xf0b1 = curl_exec($_0xff88);
 $_0x3695 = (int) curl_getinfo($_0xff88, CURLINFO_HTTP_CODE);
 curl_close($_0xff88);
 if ($_0xf0b1 !== false && $_0x3695 >= 200 && $_0x3695 < 300) {
 $_0x8cca = json_decode($_0xf0b1, true);
 foreach ($_0x8cca["\x6d\157\x64\145\x6c\163"] ?? [] as $_0xc75e) {
 $_0x39b8 = $_0xc75e["\x73\165\x70\160\x6f\162\x74\145\x64\107\x65\156\x65\162\x61\164\x69\157\x6e\115\x65\164\x68\157\x64\163"] ?? [];
 if (!in_array("\x67\145\x6e\145\x72\141\x74\145\x43\157\x6e\164\x65\156\x74", $_0x39b8, true)) {
 continue;
 }
 $_0x8595 = str_replace("\x6d\157\x64\145\x6c\163\x2f", '', (string) ($_0xc75e["\x6e\141\x6d\145"] ?? ''));
 if ($_0x8595 === '') {
 continue;
 }
 if (stripos($_0x8595, "\x69\155\x61\147\x65") !== false || stripos($_0x8595, "\x6e\141\x6e\157\x2d\142\x61\156\x61\156\x61") !== false) {
 $_0x4d69[] = $_0x8595;
 }
 }
 }
 }
 goto L_9110a;
 }
 /**
 * POST aigenerator/generateimage
 * Menghasilkan gambar ilustrasi AI untuk disisipkan ke soal tertentu di Bank Soal, Materi, atau Tugas.
 */
 public function generateimage()
 {
 if (!$this->isAuthorized()) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x53\145\x73\151\x20\164\x65\154\x61\150\x20\142\x65\162\x61\153\x68\151\x72\56\x20\123\x69\154\x61\153\x61\156\x20\155\x75\141\x74\40\x75\154\x61\156\x67\40\x68\141\x6c\141\x6d\141\x6e\56", "\x63\163\x72\146\x5f\150\x61\163\x68" => csrf_hash()]);
 }
 try {
 $_0xc15b = trim((string) $this->request->getPost("\x70\162\x6f\155\x70\164"));
 $_0x955b = strtolower(trim((string) ($this->request->getPost("\x63\157\x6e\164\x65\170\x74") ?: "\x62\141\x6e\153\x5f\163\x6f\141\x6c")));
 $_0x575d = trim((string) ($this->request->getPost("\x73\164\x79\154\x65") ?: "\x49\154\x75\163\x74\162\x61\163\x69\40\x45\144\x75\153\x61\163\x69\40\x42\165\x6b\165\x20\120\x61\153\x65\164"));
 $_0x7760 = trim((string) ($this->request->getPost("\x63\157\x6e\164\x65\170\x74\137\x74\145\x78\164") ?: ''));
 $_0x3a89 = trim((string) ($this->request->getPost("\x61\163\x70\145\x63\164\x5f\162\x61\164\x69\157") ?: ''));
 $_0x923f = strtolower(trim((string) ($this->request->getPost("\x72\145\x6e\144\x65\162\x5f\155\x6f\144\x65") ?: "\x61\165\x74\157")));
 $_0xebc9 = ["\x61\165\x74\157", "\x76\145\x63\164\x6f\162", "\x6e\141\x74\151\x76\145", "\x63\154\x6f\165\x64\146\x6c\141\x72\145", "\x68\165\x67\147\x69\156\x67\146\x61\143\x65", "\x70\157\x6c\154\x69\156\x61\164\x69\157\x6e\163\x5f\141\x6e\157\x6e", "\x70\157\x6c\154\x69\156\x61\164\x69\157\x6e\163\x5f\153\x65\171"];
 if (!in_array($_0x923f, $_0xebc9, true)) {
 $_0x923f = "\x61\165\x74\157";
 }
 $_0x7914 = $_0x7760 !== '' ? mb_substr(trim((string) preg_replace("\x2f\134\x73\53\x2f", "\x20", strip_tags($_0x7760))), 0, 320) : '';
 if ($_0xc15b === '' && $_0x7914 !== '') {
 $_0xc15b = "\x49\154\x75\163\x74\162\x61\163\x69\40\x65\144\x75\153\x61\164\x69\146\x20\171\x61\156\x67\40\x6d\145\x6e\147\x67\141\x6d\142\x61\162\x6b\141\x6e\40\x73\157\x61\154\x20\142\x65\162\x69\153\x75\164\x3a\40" . $_0x7914;
 }
 if ($_0xc15b === '') {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x44\145\x73\153\x72\151\x70\163\x69\40\x2f\40\x70\162\x6f\155\x70\164\x20\147\x61\155\x62\141\x72\40\x77\141\x6a\151\x62\40\x64\151\x69\163\x69\40\x74\145\x72\154\x65\142\x69\150\x20\144\x61\150\x75\154\x75\56", "\x63\163\x72\146\x5f\150\x61\163\x68" => csrf_hash()]);
 }
 if (!function_exists("\x63\165\x72\154\x5f\151\x6e\151\x74")) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x45\153\x73\164\x65\156\x73\151\x20\120\x48\120\x20\143\x55\122\x4c\40\x62\145\x6c\165\x6d\40\x61\153\x74\151\x66\40\x64\151\x20\163\x65\162\x76\145\x72\40\x69\156\x69\56", "\x63\163\x72\146\x5f\150\x61\163\x68" => csrf_hash()]);
 }
 $_0x550c = $this->getAiConfig();
 $_0xf8d9 = trim((string) ($_0x550c["\x61\160\x69\137\x6b\145\x79"] ?? ''));
 // Terapkan provider default dari Pengaturan Admin saat guru memakai mode "auto"
 $_0x7adf = $_0x923f;
 $_0xcf91 = strtolower((string) ($_0x550c["\x69\155\x67\137\x70\162\x6f\166\x69\144\x65\162"] ?? "\x61\165\x74\157"));
 if ($_0x923f === "\x61\165\x74\157" && $_0xcf91 !== "\x61\165\x74\157") {
 $_0x206b = ["\x67\145\x6d\151\x6e\151\x5f\166\x65\143\x74\157\x72" => "\x76\145\x63\164\x6f\162", "\x67\145\x6d\151\x6e\151\x5f\156\x61\164\x69\166\x65" => "\x6e\141\x74\151\x76\145", "\x63\154\x6f\165\x64\146\x6c\141\x72\145" => "\x63\154\x6f\165\x64\146\x6c\141\x72\145", "\x68\165\x67\147\x69\156\x67\146\x61\143\x65" => "\x68\165\x67\147\x69\156\x67\146\x61\143\x65", "\x70\157\x6c\154\x69\156\x61\164\x69\157\x6e\163\x5f\153\x65\171" => "\x70\157\x6c\154\x69\156\x61\164\x69\157\x6e\163\x5f\153\x65\171"];
 if (isset($_0x206b[$_0xcf91])) {
 $_0x7adf = $_0x206b[$_0xcf91];
 }
 }
 // 1) Jalur langsung: Cloudflare Workers AI (Gratis 10.000 neurons/hari tanpa kartu kredit)
 if ($_0x7adf === "\x63\154\x6f\165\x64\146\x6c\141\x72\145") {
 if (empty($_0x550c["\x63\146\x5f\141\x63\143\x6f\165\x6e\164\x5f\151\x64"]) || empty($_0x550c["\x63\146\x5f\141\x70\151\x5f\164\x6f\153\x65\156"])) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x3c\142\x3e\103\x6c\157\x75\144\x66\154\x61\162\x65\40\x41\143\x63\157\x75\156\x74\40\x49\104\x20\57\x20\101\x50\111\x20\124\x6f\153\x65\156\x20\142\x65\154\x75\155\x20\144\x69\151\x73\151\x2e\74\x2f\142\x3e\74\x62\162\x3e\74\x73\155\x61\154\x6c\76\x53\151\x6c\141\x6b\141\x6e\40\x64\141\x66\164\x61\162\x20\147\x72\141\x74\151\x73\40\x64\151\x20\144\x61\163\x68\56\x63\154\x6f\165\x64\146\x6c\141\x72\145\x2e\143\x6f\155\x20\50\x74\141\x6e\160\x61\40\x6b\141\x72\164\x75\40\x6b\162\x65\144\x69\164\x29\54\x20\154\x61\154\x75\40\x6d\141\x73\165\x6b\153\x61\156\x20\153\x65\40\x6d\145\x6e\165\x20\74\x62\76\x44\141\x74\141\x20\125\x6d\165\x6d\40\x26\162\x61\162\x72\73\x20\120\x65\156\x67\141\x74\165\x72\141\x6e\40\x41\120\x49\40\x41\111\x3c\57\x62\76\x2e\74\x2f\163\x6d\141\x6c\154\x3e", "\x63\163\x72\146\x5f\150\x61\163\x68" => csrf_hash()]);
 }
 $_0xbdf6 = $this->buildEnglishImagePrompt($_0xc15b, $_0x575d, $_0x7914);
 $_0xa980 = $this->generateViaCloudflareFlux($_0x550c["\x63\146\x5f\141\x63\143\x6f\165\x6e\164\x5f\151\x64"], $_0x550c["\x63\146\x5f\141\x70\151\x5f\164\x6f\153\x65\156"], $_0xbdf6, $_0x955b);
 if ($_0xa980["\x73\165\x63\143\x65\163\x73"]) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => true, "\x69\163\x5f\166\x65\143\x74\157\x72" => false, "\x66\151\x6c\145\x6e\141\x6d\145" => $_0xa980["\x66\151\x6c\145\x6e\141\x6d\145"], "\x75\162\x6c" => $_0xa980["\x75\162\x6c"], "\x6d\157\x64\145\x6c\137\x75\163\x65\144" => "\x43\154\x6f\165\x64\146\x6c\141\x72\145\x20\106\x4c\125\x58\56\x31\55\x73\143\x68\156\x65\154\x6c\40\x28\107\x72\141\x74\151\x73\51", "\x66\141\x6c\154\x62\141\x63\153\x5f\165\x73\145\x64" => false, "\x66\141\x6c\154\x62\141\x63\153\x5f\156\x6f\164\x69\143\x65" => '', "\x63\163\x72\146\x5f\150\x61\163\x68" => csrf_hash()]);
 }
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x43\154\x6f\165\x64\146\x6c\141\x72\145\x20\127\x6f\162\x6b\145\x72\163\x20\101\x49\40\x67\141\x67\141\x6c\72\x20" . esc($_0xa980["\x65\162\x72\157\x72"]), "\x63\163\x72\146\x5f\150\x61\163\x68" => csrf_hash()]);
 }
 // 2) Jalur langsung: Hugging Face Router (Gratis Token hf_...)
 if ($_0x7adf === "\x68\165\x67\147\x69\156\x67\146\x61\143\x65") {
 if (empty($_0x550c["\x68\146\x5f\141\x70\151\x5f\164\x6f\153\x65\156"])) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x3c\142\x3e\110\x75\147\x67\151\x6e\147\x20\106\x61\143\x65\40\x54\157\x6b\145\x6e\40\x62\145\x6c\165\x6d\40\x64\151\x69\163\x69\56\x3c\57\x62\76\x3c\142\x72\76\x3c\163\x6d\141\x6c\154\x3e\102\x75\141\x74\40\x74\157\x6b\145\x6e\40\x67\162\x61\164\x69\163\x20\50\x52\145\x61\144\x29\40\x64\151\x20\150\x75\147\x67\151\x6e\147\x66\141\x63\145\x2e\143\x6f\57\x73\145\x74\164\x69\156\x67\163\x2f\164\x6f\153\x65\156\x73\40\x6c\141\x6c\165\x20\164\x65\155\x70\145\x6c\40\x70\141\x64\141\x20\155\x65\156\x75\40\x3c\142\x3e\104\x61\164\x61\40\x55\155\x75\155\x20\46\x72\141\x72\162\x3b\40\x50\145\x6e\147\x61\164\x75\162\x61\156\x20\101\x50\111\x20\101\x49\74\x2f\142\x3e\56\x3c\57\x73\155\x61\154\x6c\76", "\x63\163\x72\146\x5f\150\x61\163\x68" => csrf_hash()]);
 }
 $_0xbdf6 = $this->buildEnglishImagePrompt($_0xc15b, $_0x575d, $_0x7914);
 $_0x5cd2 = $this->generateViaHuggingFaceFlux($_0x550c["\x68\146\x5f\141\x70\151\x5f\164\x6f\153\x65\156"], $_0xbdf6, $_0x955b);
 if ($_0x5cd2["\x73\165\x63\143\x65\163\x73"]) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => true, "\x69\163\x5f\166\x65\143\x74\157\x72" => false, "\x66\151\x6c\145\x6e\141\x6d\145" => $_0x5cd2["\x66\151\x6c\145\x6e\141\x6d\145"], "\x75\162\x6c" => $_0x5cd2["\x75\162\x6c"], "\x6d\157\x64\145\x6c\137\x75\163\x65\144" => "\x48\165\x67\147\x69\156\x67\106\x61\143\x65\40\x46\114\x55\130\x2e\61\x2d\163\x63\150\x6e\145\x6c\154\x20\50\x47\162\x61\164\x69\163\x29", "\x66\141\x6c\154\x62\141\x63\153\x5f\165\x73\145\x64" => false, "\x66\141\x6c\154\x62\141\x63\153\x5f\156\x6f\164\x69\143\x65" => '', "\x63\163\x72\146\x5f\150\x61\163\x68" => csrf_hash()]);
 }
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x48\165\x67\147\x69\156\x67\40\x46\141\x63\145\x20\106\x4c\125\x58\40\x67\141\x67\141\x6c\72\x20" . esc($_0x5cd2["\x65\162\x72\157\x72"]), "\x63\163\x72\146\x5f\150\x61\163\x68" => csrf_hash()]);
 }
 // 3) Jalur langsung: Pollinations (Keyed atau Keyless Gratis Terbatas)
 if ($_0x7adf === "\x70\157\x6c\154\x69\156\x61\164\x69\157\x6e\163\x5f\141\x6e\157\x6e" || $_0x7adf === "\x70\157\x6c\154\x69\156\x61\164\x69\157\x6e\163\x5f\153\x65\171") {
 $_0xebf7 = trim((string) ($_0x550c["\x70\157\x6c\154\x69\156\x61\164\x69\157\x6e\163\x5f\153\x65\171"] ?? ''));
 if ($_0x7adf === "\x70\157\x6c\154\x69\156\x61\164\x69\157\x6e\163\x5f\153\x65\171" && $_0xebf7 === '') {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x3c\142\x3e\120\x6f\154\x6c\151\x6e\141\x74\151\x6f\156\x73\40\x41\120\x49\40\x4b\145\x79\40\x62\145\x6c\165\x6d\40\x64\151\x69\163\x69\56\x3c\57\x62\76\x3c\142\x72\76\x3c\163\x6d\141\x6c\154\x3e\101\x6d\142\x69\154\x20\153\x65\171\x20\147\x72\141\x74\151\x73\40\x64\151\x20\145\x6e\164\x65\162\x2e\160\x6f\154\x6c\151\x6e\141\x74\151\x6f\156\x73\56\x61\151\x2f\153\x65\171\x73\40\x6c\141\x6c\165\x20\163\x69\155\x70\141\x6e\40\x64\151\x20\74\x62\76\x50\145\x6e\147\x61\164\x75\162\x61\156\x20\101\x50\111\x20\101\x49\74\x2f\142\x3e\54\x20\141\x74\141\x75\40\x70\151\x6c\151\x68\40\x6d\157\x64\145\x20\164\x61\156\x70\141\x20\144\x61\146\x74\141\x72\56\x3c\57\x73\155\x61\154\x6c\76", "\x63\163\x72\146\x5f\150\x61\163\x68" => csrf_hash()]);
 }
 $_0xb665 = $_0x7adf === "\x70\157\x6c\154\x69\156\x61\164\x69\157\x6e\163\x5f\153\x65\171" ? $_0xebf7 : '';
 $_0xbdf6 = $this->buildEnglishImagePrompt($_0xc15b, $_0x575d, $_0x7914);
 $_0x5e99 = $this->generateViaPollinations($_0xb665, $_0xbdf6, $_0x955b);
 if ($_0x5e99["\x73\165\x63\143\x65\163\x73"]) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => true, "\x69\163\x5f\166\x65\143\x74\157\x72" => false, "\x66\151\x6c\145\x6e\141\x6d\145" => $_0x5e99["\x66\151\x6c\145\x6e\141\x6d\145"], "\x75\162\x6c" => $_0x5e99["\x75\162\x6c"], "\x6d\157\x64\145\x6c\137\x75\163\x65\144" => $_0xb665 !== '' ? "\x50\157\x6c\154\x69\156\x61\164\x69\157\x6e\163\x20\106\x4c\125\x58\40\x28\113\x65\171\x29" : "\x50\157\x6c\154\x69\156\x61\164\x69\157\x6e\163\x20\106\x4c\125\x58\40\x28\107\x72\141\x74\151\x73\40\x54\141\x6e\160\x61\40\x44\141\x66\164\x61\162\x29", "\x66\141\x6c\154\x62\141\x63\153\x5f\165\x73\145\x64" => false, "\x66\141\x6c\154\x62\141\x63\153\x5f\156\x6f\164\x69\143\x65" => '', "\x63\163\x72\146\x5f\150\x61\163\x68" => csrf_hash()]);
 }
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => $_0x5e99["\x65\162\x72\157\x72"], "\x63\163\x72\146\x5f\150\x61\163\x68" => csrf_hash()]);
 }
 // 4) Jalur langsung: Ilustrasi Vektor / Diagram AI via Gemini teks aktif
 if ($_0x7adf === "\x76\145\x63\164\x6f\162") {
 if ($_0xf8d9 === '') {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x41\120\x49\40\x4b\145\x79\40\x47\145\x6d\151\x6e\151\x20\142\x65\154\x75\155\x20\144\x69\141\x74\165\x72\56\x20\123\x69\154\x61\153\x61\156\x20\141\x74\165\x72\40\x6d\145\x6c\141\x6c\165\x69\40\x6d\145\x6e\165\x20\104\x61\164\x61\40\x55\155\x75\155\x20\55\x3e\40\x50\145\x6e\147\x61\164\x75\162\x61\156\x20\101\x50\111\x20\101\x49\56", "\x63\163\x72\146\x5f\150\x61\163\x68" => csrf_hash()]);
 }
 $_0x7de2 = $this->generateVectorSvgFallback($_0xc15b, $_0x575d, $_0x7914, $_0x955b);
 if ($_0x7de2["\x73\165\x63\143\x65\163\x73"]) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => true, "\x69\163\x5f\166\x65\143\x74\157\x72" => true, "\x73\166\x67\137\x63\157\x64\145" => $_0x7de2["\x73\166\x67\137\x63\157\x64\145"], "\x66\151\x6c\145\x6e\141\x6d\145" => $_0x7de2["\x66\151\x6c\145\x6e\141\x6d\145"], "\x75\162\x6c" => $_0x7de2["\x75\162\x6c"], "\x6d\157\x64\145\x6c\137\x75\163\x65\144" => $_0x7de2["\x6d\157\x64\145\x6c\137\x75\163\x65\144"], "\x66\141\x6c\154\x62\141\x63\153\x5f\165\x73\145\x64" => false, "\x66\141\x6c\154\x62\141\x63\153\x5f\156\x6f\164\x69\143\x65" => '', "\x63\163\x72\146\x5f\150\x61\163\x68" => csrf_hash()]);
 }
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => $_0x7de2["\x65\162\x72\157\x72"] ?? "\x47\141\x67\141\x6c\40\x6d\145\x6d\142\x75\141\x74\40\x69\154\x75\163\x74\162\x61\163\x69\40\x76\145\x6b\164\x6f\162\x20\101\x49\56", "\x63\163\x72\146\x5f\150\x61\163\x68" => csrf_hash()]);
 }
 // 5) Mode AUTO cerdas: Jika admin sudah isi Cloudflare / HF / Pollinations Key, prioritaskan dulu!
 $_0xcac9 = [];
 if ($_0x7adf === "\x61\165\x74\157") {
 if (!empty($_0x550c["\x63\146\x5f\141\x63\143\x6f\165\x6e\164\x5f\151\x64"]) && !empty($_0x550c["\x63\146\x5f\141\x70\151\x5f\164\x6f\153\x65\156"])) {
 $_0xbdf6 = $this->buildEnglishImagePrompt($_0xc15b, $_0x575d, $_0x7914);
 $_0xa980 = $this->generateViaCloudflareFlux($_0x550c["\x63\146\x5f\141\x63\143\x6f\165\x6e\164\x5f\151\x64"], $_0x550c["\x63\146\x5f\141\x70\151\x5f\164\x6f\153\x65\156"], $_0xbdf6, $_0x955b);
 if ($_0xa980["\x73\165\x63\143\x65\163\x73"]) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => true, "\x69\163\x5f\166\x65\143\x74\157\x72" => false, "\x66\151\x6c\145\x6e\141\x6d\145" => $_0xa980["\x66\151\x6c\145\x6e\141\x6d\145"], "\x75\162\x6c" => $_0xa980["\x75\162\x6c"], "\x6d\157\x64\145\x6c\137\x75\163\x65\144" => "\x43\154\x6f\165\x64\146\x6c\141\x72\145\x20\106\x4c\125\x58\56\x31\55\x73\143\x68\156\x65\154\x6c\40\x28\107\x72\141\x74\151\x73\51", "\x66\141\x6c\154\x62\141\x63\153\x5f\165\x73\145\x64" => false, "\x66\141\x6c\154\x62\141\x63\153\x5f\156\x6f\164\x69\143\x65" => '', "\x63\163\x72\146\x5f\150\x61\163\x68" => csrf_hash()]);
 }
 $_0xcac9[] = "\x43\154\x6f\165\x64\146\x6c\141\x72\145\x3a\40" . $_0xa980["\x65\162\x72\157\x72"];
 }
 if (!empty($_0x550c["\x68\146\x5f\141\x70\151\x5f\164\x6f\153\x65\156"])) {
 $_0xbdf6 = $_0xbdf6 ?? $this->buildEnglishImagePrompt($_0xc15b, $_0x575d, $_0x7914);
 $_0x5cd2 = $this->generateViaHuggingFaceFlux($_0x550c["\x68\146\x5f\141\x70\151\x5f\164\x6f\153\x65\156"], $_0xbdf6, $_0x955b);
 if ($_0x5cd2["\x73\165\x63\143\x65\163\x73"]) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => true, "\x69\163\x5f\166\x65\143\x74\157\x72" => false, "\x66\151\x6c\145\x6e\141\x6d\145" => $_0x5cd2["\x66\151\x6c\145\x6e\141\x6d\145"], "\x75\162\x6c" => $_0x5cd2["\x75\162\x6c"], "\x6d\157\x64\145\x6c\137\x75\163\x65\144" => "\x48\165\x67\147\x69\156\x67\106\x61\143\x65\40\x46\114\x55\130\x2e\61\x2d\163\x63\150\x6e\145\x6c\154\x20\50\x47\162\x61\164\x69\163\x29", "\x66\141\x6c\154\x62\141\x63\153\x5f\165\x73\145\x64" => false, "\x66\141\x6c\154\x62\141\x63\153\x5f\156\x6f\164\x69\143\x65" => '', "\x63\163\x72\146\x5f\150\x61\163\x68" => csrf_hash()]);
 }
 $_0xcac9[] = "\x48\165\x67\147\x69\156\x67\106\x61\143\x65\72\x20" . $_0x5cd2["\x65\162\x72\157\x72"];
 }
 if (!empty($_0x550c["\x70\157\x6c\154\x69\156\x61\164\x69\157\x6e\163\x5f\153\x65\171"])) {
 $_0xbdf6 = $_0xbdf6 ?? $this->buildEnglishImagePrompt($_0xc15b, $_0x575d, $_0x7914);
 $_0x5e99 = $this->generateViaPollinations($_0x550c["\x70\157\x6c\154\x69\156\x61\164\x69\157\x6e\163\x5f\153\x65\171"], $_0xbdf6, $_0x955b);
 if ($_0x5e99["\x73\165\x63\143\x65\163\x73"]) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => true, "\x69\163\x5f\166\x65\143\x74\157\x72" => false, "\x66\151\x6c\145\x6e\141\x6d\145" => $_0x5e99["\x66\151\x6c\145\x6e\141\x6d\145"], "\x75\162\x6c" => $_0x5e99["\x75\162\x6c"], "\x6d\157\x64\145\x6c\137\x75\163\x65\144" => "\x50\157\x6c\154\x69\156\x61\164\x69\157\x6e\163\x20\106\x4c\125\x58", "\x66\141\x6c\154\x62\141\x63\153\x5f\165\x73\145\x64" => false, "\x66\141\x6c\154\x62\141\x63\153\x5f\156\x6f\164\x69\143\x65" => '', "\x63\163\x72\146\x5f\150\x61\163\x68" => csrf_hash()]);
 }
 $_0xcac9[] = "\x50\157\x6c\154\x69\156\x61\164\x69\157\x6e\163\x3a\40" . $_0x5e99["\x65\162\x72\157\x72"];
 }
 }
 if ($_0xf8d9 === '') {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x41\120\x49\40\x4b\145\x79\40\x47\145\x6d\151\x6e\151\x20\142\x65\154\x75\155\x20\144\x69\141\x74\165\x72\56\x20\123\x69\154\x61\153\x61\156\x20\141\x74\165\x72\40\x6d\145\x6c\141\x6c\165\x69\40\x6d\145\x6e\165\x20\104\x61\164\x61\40\x55\155\x75\155\x20\55\x3e\40\x50\145\x6e\147\x61\164\x75\162\x61\156\x20\101\x50\111\x20\101\x49\56", "\x63\163\x72\146\x5f\150\x61\163\x68" => csrf_hash()]);
 }
 $_0xf1e1 = "\x42\165\x61\164\x6b\141\x6e\40\x73\141\x74\165\x20\147\x61\155\x62\141\x72\40\x69\154\x75\163\x74\162\x61\163\x69\40\x70\145\x6e\144\x69\144\x69\153\x61\156\x20\171\x61\156\x67\40\x6a\145\x6c\141\x73\40\x75\156\x74\165\x6b\40\x6b\145\x62\165\x74\165\x68\141\x6e\40\x73\157\x61\154\x2f\155\x61\164\x65\162\x69\40\x73\145\x6b\157\x6c\141\x68\40\x64\151\x20\111\x6e\144\x6f\156\x65\163\x69\141\x2e\12" . "Deskripsi gambar yang diminta guru: {$_0xc15b}\n" . "Gaya visual: {$_0x575d}.\n";
 if ($_0x3a89 !== '' && in_array($_0x3a89, ["\x31\72\x31", "\x34\72\x33", "\x33\72\x34", "\x31\66\x3a\71"], true)) {
 $_0xf1e1 .= "Rasio komposisi yang disarankan: {$_0x3a89}.\n";
 }
 if ($_0x7914 !== '') {
 $_0xf1e1 .= "Konteks teks soal/materi terkait: {$_0x7914}\n";
 }
 $_0xf1e1 .= "\x50\141\x6e\144\x75\141\x6e\40\x6b\165\x61\154\x69\164\x61\163\x3a\40\x74\141\x6d\160\x69\154\x61\156\x20\162\x61\160\x69\54\x20\164\x65\162\x61\156\x67\54\x20\153\x6f\156\x74\162\x61\163\x20\152\x65\154\x61\163\x20\163\x61\141\x74\40\x64\151\x62\141\x63\141\x20\163\x69\163\x77\141\x20\144\x69\40\x48\120\x20\155\x61\165\x70\165\x6e\40\x6b\157\x6d\160\x75\164\x65\162\x2c\40\x6c\141\x74\141\x72\40\x62\145\x72\163\x69\150\x2e\40" . "\x4a\151\x6b\141\x20\144\x65\163\x6b\162\x69\160\x73\151\x20\155\x65\155\x69\156\x74\141\x20\154\x61\142\x65\154\x2f\163\x69\155\x62\157\x6c\57\x68\165\x72\165\x66\40\x74\145\x72\164\x65\156\x74\165\x2c\40\x74\141\x6d\160\x69\154\x6b\141\x6e\40\x64\145\x6e\147\x61\156\x20\152\x65\154\x61\163\x3b\40\x6a\151\x6b\141\x20\164\x69\144\x61\153\x20\144\x69\155\x69\156\x74\141\x20\164\x65\153\x73\54\x20\150\x69\156\x64\141\x72\151\x20\164\x75\154\x69\163\x61\156\x20\141\x63\141\x6b\40\x61\164\x61\165\x20\167\x61\164\x65\162\x6d\141\x72\153\x2e";
 // Batasi maksimal 2 percobaan model native agar tidak membuang waktu 10+ detik pada API Key Free Tier
 $_0x5091 = array_slice($this->discoverImageModels($_0xf8d9), 0, $_0x7adf === "\x6e\141\x74\151\x76\145" ? 4 : 2);
 $_0x256f = "\x47\141\x67\141\x6c\40\x6d\145\x6e\147\x68\141\x73\151\x6c\153\x61\156\x20\147\x61\155\x62\141\x72\40\x64\141\x72\151\x20\107\x6f\157\x67\154\x65\40\x47\145\x6d\151\x6e\151\x20\101\x50\111\x2e";
 $_0xadff = [];
 $_0x2aec = false;
 foreach ($_0x5091 as $_0x15d6) {
 $_0xde52 = "\x68\164\x74\160\x73\72\x2f\57\x67\145\x6e\145\x72\141\x74\151\x76\145\x6c\141\x6e\147\x75\141\x67\145\x2e\147\x6f\157\x67\154\x65\141\x70\151\x73\56\x63\157\x6d\57\x76\61\x62\145\x74\141\x2f\155\x6f\144\x65\154\x73\57" . rawurlencode($_0x15d6) . "\x3a\147\x65\156\x65\162\x61\164\x65\103\x6f\156\x74\145\x6e\164";
 $_0xa0ab = ["\x63\157\x6e\164\x65\156\x74\163" => [["\x70\141\x72\164\x73" => [["\x74\145\x78\164" => $_0xf1e1]]]], "\x67\145\x6e\145\x72\141\x74\151\x6f\156\x43\157\x6e\146\x69\147" => ["\x72\145\x73\160\x6f\156\x73\145\x4d\157\x64\141\x6c\151\x74\151\x65\163" => ["\x54\105\x58\124", "\x49\115\x41\107\x45"]]];
 $_0xacf9 = curl_init($_0xde52);
 curl_setopt_array($_0xacf9, [CURLOPT_RETURNTRANSFER => true, CURLOPT_POST => true, CURLOPT_HTTPHEADER => ["\x43\157\x6e\164\x65\156\x74\55\x54\171\x70\145\x3a\40\x61\160\x70\154\x69\143\x61\164\x69\157\x6e\57\x6a\163\x6f\156", "\x78\55\x67\157\x6f\147\x2d\141\x70\151\x2d\153\x65\171\x3a\40" . $_0xf8d9], CURLOPT_POSTFIELDS => json_encode($_0xa0ab, JSON_UNESCAPED_UNICODE), CURLOPT_TIMEOUT => 60, CURLOPT_CONNECTTIMEOUT => 12, CURLOPT_SSL_VERIFYPEER => false, CURLOPT_SSL_VERIFYHOST => 0]);
 $response = curl_exec($_0xacf9);
 $_0xaf3a = (int) curl_getinfo($_0xacf9, CURLINFO_HTTP_CODE);
 $_0xec1c = curl_error($_0xacf9);
 curl_close($_0xacf9);
 if ($response === false || !empty($_0xec1c)) {
 $_0x256f = "\x4b\157\x6e\145\x6b\163\x69\40\x6b\145\x20\107\x6f\157\x67\154\x65\40\x47\145\x6d\151\x6e\151\x20\147\x61\147\x61\154\x3a\40" . $_0xec1c;
 $_0xadff[] = ["\x6d\157\x64\145\x6c" => $_0x15d6, "\x65\162\x72\157\x72" => $_0x256f];
 continue;
 }
 $_0xd160 = json_decode($response, true);
 if ($_0xaf3a >= 200 && $_0xaf3a < 300 && is_array($_0xd160)) {
 $_0x2c5b = null;
 $_0x21de = '';
 foreach ($_0xd160["\x63\141\x6e\144\x69\144\x61\164\x65\163"] ?? [] as $_0x9bb1) {
 foreach ($_0x9bb1["\x63\157\x6e\164\x65\156\x74"]["\x70\141\x72\164\x73"] ?? [] as $_0xedce) {
 if (!is_array($_0xedce) || !empty($_0xedce["\x74\150\x6f\165\x67\150\x74"])) {
 continue;
 }
 if (isset($_0xedce["\x74\145\x78\164"]) && trim((string) $_0xedce["\x74\145\x78\164"]) !== '') {
 $_0x21de .= trim((string) $_0xedce["\x74\145\x78\164"]) . "\xa";
 }
 $_0x945d = $_0xedce["\x69\156\x6c\151\x6e\145\x44\141\x74\141"] ?? $_0xedce["\x69\156\x6c\151\x6e\145\x5f\144\x61\164\x61"] ?? null;
 if (is_array($_0x945d) && !empty($_0x945d["\x64\141\x74\141"])) {
 $_0xfda8 = str_replace(["\x20", "\xd", "\xa"], '', (string) $_0x945d["\x64\141\x74\141"]);
 $_0xabbe = base64_decode($_0xfda8, true);
 if ($_0xabbe !== false && strlen($_0xabbe) > 64 && @getimagesizefromstring($_0xabbe) !== false) {
 $_0x2c5b = $_0xabbe;
 break 2;
 }
 }
 }
 }
 if ($_0x2c5b !== null) {
 $_0x325e = $this->saveRasterBinary($_0x2c5b, $_0x955b, "\x61\151\x5f");
 if (!$_0x325e["\x73\165\x63\143\x65\163\x73"]) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => $_0x325e["\x65\162\x72\157\x72"], "\x63\163\x72\146\x5f\150\x61\163\x68" => csrf_hash()]);
 }
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => true, "\x69\163\x5f\166\x65\143\x74\157\x72" => false, "\x66\151\x6c\145\x6e\141\x6d\145" => $_0x325e["\x66\151\x6c\145\x6e\141\x6d\145"], "\x75\162\x6c" => $_0x325e["\x75\162\x6c"], "\x6d\157\x64\145\x6c\137\x75\163\x65\144" => $_0x15d6, "\x63\141\x70\164\x69\157\x6e" => trim($_0x21de), "\x66\141\x6c\154\x62\141\x63\153\x5f\165\x73\145\x64" => false, "\x66\141\x6c\154\x62\141\x63\153\x5f\156\x6f\164\x69\143\x65" => '', "\x63\163\x72\146\x5f\150\x61\163\x68" => csrf_hash()]);
 }
 $_0xbdbc = $_0xd160["\x63\141\x6e\144\x69\144\x61\164\x65\163"][0]["\x66\151\x6e\151\x73\150\x52\145\x61\163\x6f\156"] ?? '';
 $_0x53da = trim($_0x21de) !== '' ? trim($_0x21de) : ($_0xbdbc !== '' ? "\x46\151\x6e\151\x73\150\x52\145\x61\163\x6f\156\x3a\40" . $_0xbdbc : "\x4d\157\x64\145\x6c\40\x74\151\x64\141\x6b\40\x6d\145\x6e\147\x65\155\x62\141\x6c\151\x6b\141\x6e\40\x64\141\x74\141\x20\147\x61\155\x62\141\x72\56");
 $_0x256f = "\x47\145\x6d\151\x6e\151\x20\50" . $_0x15d6 . "\x29\72\x20" . $_0x53da;
 $_0xadff[] = ["\x6d\157\x64\145\x6c" => $_0x15d6, "\x65\162\x72\157\x72" => $_0x53da];
 continue;
 }
 $_0x3c66 = $_0xd160["\x65\162\x72\157\x72"]["\x6d\145\x73\163\x61\147\x65"] ?? "\x48\124\x54\120\x20" . $_0xaf3a;
 $_0x256f = "\x47\145\x6d\151\x6e\151\x20\101\x50\111\x20\50" . $_0x15d6 . "\x29\72\x20" . $_0x3c66;
 $_0xadff[] = ["\x6d\157\x64\145\x6c" => $_0x15d6, "\x65\162\x72\157\x72" => $_0x3c66];
 if (stripos($_0x3c66, "\x6c\151\x6d\151\x74\72\x20\60") !== false || stripos($_0x3c66, "\x71\165\x6f\164\x61") !== false || stripos($_0x3c66, "\x62\151\x6c\154\x69\156\x67") !== false || stripos($_0x3c66, "\x52\105\x53\117\x55\122\x43\105\x5f\105\x58\110\x41\125\x53\124\x45\104") !== false || $_0xaf3a === 429 || $_0xaf3a === 403) {
 $_0x2aec = true;
 // Hentikan loop model native seketika karena satu API key Free Tier berbagi status limit: 0
 break;
 }
 if (stripos($_0x3c66, "\x41\120\x49\137\x4b\105\x59\137\x49\116\x56\101\x4c\111\x44") !== false || stripos($_0x3c66, "\x41\120\x49\40\x6b\145\x79\40\x6e\157\x74\40\x76\141\x6c\151\x64") !== false) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x41\120\x49\40\x4b\145\x79\40\x47\157\x6f\147\x6c\145\x20\107\x65\155\x69\156\x69\40\x74\151\x64\141\x6b\40\x76\141\x6c\151\x64\72\x20" . esc($_0x3c66), "\x66\141\x69\154\x65\144\x5f\141\x74\164\x65\155\x70\164\x73" => $_0xadff, "\x63\163\x72\146\x5f\150\x61\163\x68" => csrf_hash()]);
 }
 }
 // Fallback otomatis ke Ilustrasi Vektor/Diagram SVG via model teks aktif
 $_0xa9b1 = '';
 if ($_0x7adf === "\x61\165\x74\157") {
 $_0x6256 = $this->generateVectorSvgFallback($_0xc15b, $_0x575d, $_0x7914, $_0x955b);
 if ($_0x6256["\x73\165\x63\143\x65\163\x73"]) {
 $_0xc099 = (string) ($_0x550c["\x6d\157\x64\145\x6c"] ?: "\x67\145\x6d\151\x6e\151\x2d\62\x2e\65\x2d\146\x6c\141\x73\150");
 $_0x6cb1 = implode("\x2c\40", array_slice(array_column($_0xadff, "\x6d\157\x64\145\x6c"), 0, 2));
 $_0xfd7b = $_0x2aec ? "\x6b\165\x6f\164\x61\40\x46\162\x65\145\x20\124\x69\145\x72\40\x6d\157\x64\145\x6c\40\x67\141\x6d\142\x61\162\x20\156\x61\164\x69\166\x65\40\x47\157\x6f\147\x6c\145\x20\50\x3c\143\x6f\144\x65\76" . esc($_0x6cb1 ?: "\x67\145\x6d\151\x6e\151\x2d\52\x2d\151\x6d\141\x67\145") . "\x3c\57\x63\157\x64\145\x3e\51\x20\142\x65\162\x6e\151\x6c\141\x69\40\x3c\142\x3e\154\x69\155\x69\164\x3a\40\x30\74\x2f\142\x3e\40\x2f\40\x62\165\x74\165\x68\40\x42\151\x6c\154\x69\156\x67\40\x61\153\x74\151\x66" : "\x6d\157\x64\145\x6c\40\x67\141\x6d\142\x61\162\x20\156\x61\164\x69\166\x65\40\x47\157\x6f\147\x6c\145\x20\164\x69\144\x61\153\x20\155\x65\156\x67\145\x6d\142\x61\154\x69\153\x61\156\x20\147\x61\155\x62\141\x72";
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => true, "\x69\163\x5f\166\x65\143\x74\157\x72" => true, "\x73\166\x67\137\x63\157\x64\145" => $_0x6256["\x73\166\x67\137\x63\157\x64\145"], "\x66\151\x6c\145\x6e\141\x6d\145" => $_0x6256["\x66\151\x6c\145\x6e\141\x6d\145"], "\x75\162\x6c" => $_0x6256["\x75\162\x6c"], "\x6d\157\x64\145\x6c\137\x75\163\x65\144" => $_0x6256["\x6d\157\x64\145\x6c\137\x75\163\x65\144"], "\x66\141\x6c\154\x62\141\x63\153\x5f\165\x73\145\x64" => true, "\x66\141\x6c\154\x62\141\x63\153\x5f\156\x6f\164\x69\143\x65" => "\x49\156\x66\157\x3a\40\x4b\141\x72\145\x6e\141\x20" . $_0xfd7b . "\x20\50\x73\145\x64\141\x6e\147\x6b\141\x6e\40\x3c\143\x6f\144\x65\76" . esc($_0xc099) . "\x3c\57\x63\157\x64\145\x3e\40\x61\144\x61\154\x61\150\x20\155\x6f\144\x65\154\x20\164\x65\153\x73\51\x2c\40\x73\151\x73\164\x65\155\x20\157\x74\157\x6d\141\x74\151\x73\40\x62\145\x72\141\x6c\151\x68\40\x6b\145\x20\74\x62\76\x49\154\x75\163\x74\162\x61\163\x69\40\x44\151\x61\147\x72\141\x6d\40\x56\145\x6b\164\x6f\162\x20\101\x49\40\x47\162\x61\164\x69\163\x3c\57\x62\76\x20\155\x65\155\x61\153\x61\151\x20\74\x63\157\x64\145\x3e" . esc($_0x6256["\x6d\157\x64\145\x6c\137\x75\163\x65\144"]) . "\x3c\57\x63\157\x64\145\x3e\56\x3c\142\x72\76\x3c\163\x6d\141\x6c\154\x20\143\x6c\141\x73\163\x3d\42\x74\145\x78\164\x2d\155\x75\164\x65\144\x22\76\x54\151\x70\163\x3a\40\x55\156\x74\165\x6b\40\x67\141\x6d\142\x61\162\x20\146\x6f\164\x6f\57\x6b\141\x72\164\x75\156\x20\162\x65\141\x6c\151\x73\164\x69\163\x20\147\x72\141\x74\151\x73\40\x68\141\x72\151\x61\156\x20\164\x61\156\x70\141\x20\102\x69\154\x6c\151\x6e\147\x20\107\x6f\157\x67\154\x65\54\x20\164\x61\155\x62\141\x68\153\x61\156\x20\124\x6f\153\x65\156\x20\147\x72\141\x74\151\x73\40\x3c\142\x3e\103\x6c\157\x75\144\x66\154\x61\162\x65\40\x57\157\x72\153\x65\162\x73\40\x41\111\x20\50\x46\114\x55\130\x2e\61\x2d\163\x63\150\x6e\145\x6c\154\x29\74\x2f\142\x3e\40\x64\151\x20\155\x65\156\x75\40\x44\141\x74\141\x20\125\x6d\165\x6d\40\x26\162\x61\162\x72\73\x20\120\x65\156\x67\141\x74\165\x72\141\x6e\40\x41\120\x49\40\x41\111\x2e\74\x2f\163\x6d\141\x6c\154\x3e", "\x66\141\x69\154\x65\144\x5f\141\x74\164\x65\155\x70\164\x73" => $_0xadff, "\x63\163\x72\146\x5f\150\x61\163\x68" => csrf_hash()]);
 }
 $_0xa9b1 = (string) ($_0x6256["\x65\162\x72\157\x72"] ?? '');
 }
 $_0xbab0 = array_values(array_unique(array_column($_0xadff, "\x6d\157\x64\145\x6c")));
 $_0x5caf = !empty($_0xbab0) ? implode("\x2c\40", $_0xbab0) : "\x67\145\x6d\151\x6e\151\x2d\62\x2e\65\x2d\146\x6c\141\x73\150\x2d\151\x6d\141\x67\145";
 $_0x6058 = (string) ($_0x550c["\x6d\157\x64\145\x6c"] ?: "\x67\145\x6d\151\x6e\151\x2d\62\x2e\65\x2d\146\x6c\141\x73\150");
 if ($_0x2aec || stripos($_0x256f, "\x71\165\x6f\164\x61") !== false || stripos($_0x256f, "\x6c\151\x6d\151\x74\72\x20\60") !== false || stripos($_0x256f, "\x34\62\x39") !== false) {
 $_0x3c5d = "\x3c\163\x74\162\x6f\156\x67\76\x4b\165\x6f\164\x61\40\x4d\157\x64\145\x6c\40\x47\141\x6d\142\x61\162\x20\116\x61\164\x69\166\x65\40\x47\157\x6f\147\x6c\145\x20\107\x65\155\x69\156\x69\40\x3d\40\x30\40\x28\102\x75\164\x75\150\x20\102\x69\154\x6c\151\x6e\147\x20\101\x6b\164\x69\146\x29\56\x3c\57\x73\164\x72\157\x6e\147\x3e\74\x62\162\x3e" . "\x4d\157\x64\145\x6c\40\x75\164\x61\155\x61\40\x41\156\x64\141\x20\50\x3c\143\x6f\144\x65\76" . esc($_0x6058) . "\x3c\57\x63\157\x64\145\x3e\51\x20\142\x65\162\x6a\141\x6c\141\x6e\40\x64\151\x20\160\x61\153\x65\164\x20\147\x72\141\x74\151\x73\40\x75\156\x74\165\x6b\40\x74\145\x6b\163\x2c\40\x73\145\x64\141\x6e\147\x6b\141\x6e\40\x6d\157\x64\145\x6c\40\x67\141\x6d\142\x61\162\x20\156\x61\164\x69\166\x65\40\x47\157\x6f\147\x6c\145\x20\50\x3c\143\x6f\144\x65\76" . esc($_0x5caf) . "\x3c\57\x63\157\x64\145\x3e\51\x20\144\x69\153\x75\156\x63\151\x20\160\x61\144\x61\40\x3c\142\x3e\154\x69\155\x69\164\x3a\40\x30\74\x2f\142\x3e\40\x6f\154\x65\150\x20\107\x6f\157\x67\154\x65\40\x74\141\x6e\160\x61\40\x42\151\x6c\154\x69\156\x67\56" . ($_0xa9b1 !== '' ? "\x3c\142\x72\76\x3c\163\x6d\141\x6c\154\x20\143\x6c\141\x73\163\x3d\42\x74\145\x78\164\x2d\144\x61\156\x67\145\x72\42\x3e\106\x61\154\x6c\142\x61\143\x6b\40\x56\145\x6b\164\x6f\162\x20\101\x49\40\x6a\165\x67\141\x20\147\x61\147\x61\154\x3a\40" . esc($_0xa9b1) . "\x3c\57\x73\155\x61\154\x6c\76" : '') . (!empty($_0xcac9) ? "\x3c\142\x72\76\x3c\163\x6d\141\x6c\154\x20\143\x6c\141\x73\163\x3d\42\x74\145\x78\164\x2d\144\x61\156\x67\145\x72\42\x3e" . esc(implode("\x20\174\x20", $_0xcac9)) . "\x3c\57\x73\155\x61\154\x6c\76" : '') . "\x3c\142\x72\76\x3c\163\x6d\141\x6c\154\x20\143\x6c\141\x73\163\x3d\42\x74\145\x78\164\x2d\155\x75\164\x65\144\x20\144\x2d\142\x6c\157\x63\153\x20\155\x74\55\x31\42\x3e\74\x69\40\x63\154\x61\163\x73\75\x22\146\x61\163\x20\146\x61\55\x6c\151\x67\150\x74\142\x75\154\x62\40\x6d\145\x2d\61\x20\164\x65\170\x74\55\x77\141\x72\156\x69\156\x67\42\x3e\74\x2f\151\x3e\74\x62\76\x53\157\x6c\165\x73\151\x20\124\x65\162\x62\141\x69\153\x20\107\x72\141\x74\151\x73\72\x3c\57\x62\76\x20\101\x74\165\x72\40\x74\157\x6b\145\x6e\40\x67\162\x61\164\x69\163\x20\74\x62\76\x43\154\x6f\165\x64\146\x6c\141\x72\145\x20\127\x6f\162\x6b\145\x72\163\x20\101\x49\40\x28\106\x4c\125\x58\56\x31\55\x73\143\x68\156\x65\154\x6c\51\x3c\57\x62\76\x20\144\x69\40\x3c\151\x3e\104\x61\164\x61\40\x55\155\x75\155\x20\46\x72\141\x72\162\x3b\40\x50\145\x6e\147\x61\164\x75\162\x61\156\x20\101\x50\111\x20\101\x49\74\x2f\151\x3e\40\x28\147\x72\141\x74\151\x73\40\x31\60\x2e\60\x30\60\x20\116\x65\165\x72\157\x6e\163\x2f\150\x61\162\x69\40\x74\141\x6e\160\x61\40\x6b\141\x72\164\x75\40\x6b\162\x65\144\x69\164\x29\54\x20\141\x74\141\x75\40\x63\157\x62\141\x20\155\x6f\144\x65\40\x3c\142\x3e\104\x69\141\x67\162\x61\155\x20\57\x20\111\x6c\165\x73\164\x72\141\x73\151\x20\126\x65\153\x74\157\x72\40\x41\111\x3c\57\x62\76\x20\57\x20\74\x62\76\x50\157\x6c\154\x69\156\x61\164\x69\157\x6e\163\x20\124\x61\156\x70\141\x20\104\x61\146\x74\141\x72\74\x2f\142\x3e\40\x70\141\x64\141\x20\144\x72\157\x70\144\x6f\167\x6e\40\x64\151\x20\141\x74\141\x73\56\x3c\57\x73\155\x61\154\x6c\76";
 } else {
 $_0x3c5d = esc($_0x256f) . ($_0xa9b1 !== '' ? "\x3c\142\x72\76\x3c\163\x6d\141\x6c\154\x20\143\x6c\141\x73\163\x3d\42\x74\145\x78\164\x2d\144\x61\156\x67\145\x72\42\x3e\106\x61\154\x6c\142\x61\143\x6b\40\x56\145\x6b\164\x6f\162\x3a\40" . esc($_0xa9b1) . "\x3c\57\x73\155\x61\154\x6c\76" : '') . "\x3c\142\x72\76\x3c\163\x6d\141\x6c\154\x20\143\x6c\141\x73\163\x3d\42\x74\145\x78\164\x2d\155\x75\164\x65\144\x20\144\x2d\142\x6c\157\x63\153\x20\155\x74\55\x31\42\x3e\115\x6f\144\x65\154\x20\144\x69\143\x6f\142\x61\72\x20\74\x63\157\x64\145\x3e" . esc($_0x5caf) . "\x3c\57\x63\157\x64\145\x3e\56\x3c\57\x73\155\x61\154\x6c\76";
 }
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => $_0x3c5d, "\x66\141\x69\154\x65\144\x5f\141\x74\164\x65\155\x70\164\x73" => $_0xadff, "\x63\163\x72\146\x5f\150\x61\163\x68" => csrf_hash()]);
 } catch (\Throwable $_0x98b2) {
 log_message("\x65\162\x72\157\x72", "\x5b\101\x69\107\x65\156\x65\162\x61\164\x6f\162\x3a\72\x67\145\x6e\145\x72\141\x74\145\x69\155\x61\147\x65\135\x20" . $_0x98b2->getMessage());
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x47\141\x67\141\x6c\40\x6d\145\x6d\160\x72\157\x73\145\x73\40\x70\145\x6d\142\x75\141\x74\141\x6e\40\x67\141\x6d\142\x61\162\x20\101\x49\72\x20" . $_0x98b2->getMessage(), "\x63\163\x72\146\x5f\150\x61\163\x68" => csrf_hash()]);
 }
 }
 /**
 * Menyimpan bytes gambar raster yang telah tervalidasi ke uploads/bank_soal atau uploads/materi
 */
 private function saveRasterBinary(string $_0x1ef7, string $_0xed07, string $_0x2c51 = "\x61\151\x5f"): array
 {
 goto L_8f8e6;
 L_bfd86:
 $_0xcc57 = $_0xed07 === "\x6d\141\x74\145\x72\151" ? "\x75\160\x6c\157\x61\144\x73\57\x6d\141\x74\145\x72\151\x2f" : "\x75\160\x6c\157\x61\144\x73\57\x62\141\x6e\153\x5f\163\x6f\141\x6c\57";
 goto L_a8593;
 L_26e0e:
 if (!is_dir($_0x284f)) {
 @mkdir($_0x284f, 0775, true);
 }
 goto L_4e92d;
 L_a8593:
 $_0x284f = FCPATH . $_0xcc57;
 goto L_26e0e;
 L_41dec:
 $_0x1261 = $_0x284f . $_0x365f;
 goto L_43cfd;
 L_4e92d:
 $_0x365f = $_0x2c51 . date("\x59\155\x64\110\x69\163") . "\x5f" . bin2hex(random_bytes(4)) . "\x2e" . $_0x50fb;
 goto L_41dec;
 L_aca4e:
 $_0x50fb = $_0xc9dd[strtolower((string) $_0x62c8["\x6d\151\x6d\145"])] ?? "\x70\156\x67";
 goto L_bfd86;
 L_43cfd:
 if (@file_put_contents($_0x1261, $_0x1ef7) === false || !is_file($_0x1261)) {
 return ["\x73\165\x63\143\x65\163\x73" => false, "\x65\162\x72\157\x72" => "\x53\145\x72\166\x65\162\x20\147\x61\147\x61\154\x20\155\x65\156\x79\151\x6d\160\x61\156\x20\146\x69\154\x65\40\x67\141\x6d\142\x61\162\x20\153\x65\40\x66\157\x6c\144\x65\162\x20" . $_0xcc57 . "\x2e"];
 }
 goto L_a9327;
 L_ff140:
 if (!$_0x62c8 || empty($_0x62c8["\x6d\151\x6d\145"])) {
 return ["\x73\165\x63\143\x65\163\x73" => false, "\x65\162\x72\157\x72" => "\x52\145\x73\160\x6f\156\x73\40\x70\162\x6f\166\x69\144\x65\162\x20\164\x69\144\x61\153\x20\142\x65\162\x69\163\x69\40\x67\141\x6d\142\x61\162\x20\171\x61\156\x67\40\x76\141\x6c\151\x64\56"];
 }
 goto L_ac7f2;
 L_a9327:
 return ["\x73\165\x63\143\x65\163\x73" => true, "\x66\151\x6c\145\x6e\141\x6d\145" => $_0xcc57 . $_0x365f, "\x75\162\x6c" => base_url($_0xcc57 . $_0x365f)];
 L_8f8e6:
 $_0x62c8 = @getimagesizefromstring($_0x1ef7);
 goto L_ff140;
 L_ac7f2:
 $_0xc9dd = ["\x69\155\x61\147\x65\57\x6a\160\x65\147" => "\x6a\160\x67", "\x69\155\x61\147\x65\57\x6a\160\x67" => "\x6a\160\x67", "\x69\155\x61\147\x65\57\x77\145\x62\160" => "\x77\145\x62\160", "\x69\155\x61\147\x65\57\x67\151\x66" => "\x67\151\x66", "\x69\155\x61\147\x65\57\x70\156\x67" => "\x70\156\x67"];
 goto L_aca4e;
 }
 /**
 * Mengubah deskripsi gambar Bahasa Indonesia/soal menjadi prompt visual Bahasa Inggris untuk FLUX
 */
 private function buildEnglishImagePrompt(string $_0xa01c, string $_0xa87e, string $_0x6839): string
 {
 goto L_f797b;
 L_eb3c9:
 $_0x814e = trim($_0xa01c . ($_0xa87e !== '' ? "\x2c\40" . $_0xa87e : ''));
 goto L_603a2;
 L_e3d4f:
 return mb_substr($_0x814e, 0, 320);
 L_f797b:
 $_0xfbff = $this->getAiConfig();
 goto L_eb3c9;
 L_221e0:
 if (!empty($_0x5ea5["\x73\165\x63\143\x65\163\x73"]) && trim((string) ($_0x5ea5["\x74\145\x78\164"] ?? '')) !== '') {
 $_0xfffb = trim(str_replace(["\x22", "\xd", "\xa"], ['', "\x20", "\x20"], (string) $_0x5ea5["\x74\145\x78\164"]));
 if (strlen($_0xfffb) > 10) {
 return mb_substr($_0xfffb, 0, 380);
 }
 }
 goto L_e3d4f;
 L_603a2:
 if (empty($_0xfbff["\x61\160\x69\137\x6b\145\x79"])) {
 return mb_substr($_0x814e, 0, 320);
 }
 goto L_4dcef;
 L_4dcef:
 $_0x6382 = "\x54\162\x61\156\x73\154\x61\164\x65\40\x61\156\x64\40\x65\156\x72\151\x63\150\x20\164\x68\151\x73\40\x49\156\x64\157\x6e\145\x73\151\x61\156\x20\163\x63\150\x6f\157\x6c\40\x69\154\x6c\165\x73\164\x72\141\x74\151\x6f\156\x20\162\x65\161\x75\145\x73\164\x20\151\x6e\164\x6f\40\x4f\116\x45\40\x63\157\x6e\143\x69\163\x65\40\x45\156\x67\154\x69\163\x68\40\x69\155\x61\147\x65\55\x67\145\x6e\145\x72\141\x74\151\x6f\156\x20\160\x72\157\x6d\160\x74\40\x28\155\x61\170\x20\65\x35\40\x77\157\x72\144\x73\51\x20\163\x75\151\x74\141\x62\154\x65\40\x66\157\x72\40\x61\40\x74\145\x78\164\x62\157\x6f\153\x20\166\x69\163\x75\141\x6c\40\x6f\162\x20\106\x4c\125\x58\40\x41\111\x20\151\x6d\141\x67\145\x20\147\x65\156\x65\162\x61\164\x6f\162\x2e\12" . "Teacher prompt: {$_0xa01c}\n" . "Visual style: {$_0xa87e}\n" . ($_0x6839 !== '' ? "Question context (do NOT reveal any quiz answer inside the image): {$_0x6839}\n" : '') . "\x52\165\x6c\145\x73\72\x20\106\x6f\143\x75\163\x20\157\x6e\40\x63\154\x65\141\x72\40\x76\151\x73\165\x61\154\x20\163\x63\145\x6e\145\x2c\40\x6f\142\x6a\145\x63\164\x73\54\x20\143\x6f\155\x70\157\x73\151\x74\151\x6f\156\x2c\40\x62\162\x69\147\x68\164\x20\143\x6c\141\x73\163\x72\157\x6f\155\x20\154\x69\147\x68\164\x69\156\x67\54\x20\143\x6c\145\x61\156\x20\141\x65\163\x74\150\x65\164\x69\143\x2c\40\x6e\157\x20\162\x61\156\x64\157\x6d\40\x75\156\x72\145\x61\144\x61\142\x6c\145\x20\147\x69\142\x62\145\x72\151\x73\150\x20\164\x65\170\x74\54\x20\156\x6f\40\x77\141\x74\145\x72\155\x61\162\x6b\56\x20\122\x65\164\x75\162\x6e\40\x4f\116\x4c\131\x20\164\x68\145\x20\163\x69\156\x67\154\x65\40\x45\156\x67\154\x69\163\x68\40\x70\162\x6f\155\x70\164\x20\163\x65\156\x74\145\x6e\143\x65\56";
 goto L_8916c;
 L_8916c:
 $_0x5ea5 = $this->callGeminiApi($_0x6382, false, null, null, 1024);
 goto L_221e0;
 }
 /**
 * Cloudflare Workers AI REST API (@cf/black-forest-labs/flux-1-schnell) — Gratis 10.000 Neurons/hari
 */
 private function generateViaCloudflareFlux(string $_0x678f, string $_0xec1f, string $_0x5b5f, string $_0xbb5d): array
 {
 goto L_28dc5;
 L_aa23c:
 $_0xb149 = curl_init($_0x69ba);
 goto L_fe9b6;
 L_c5bb2:
 $_0xb173 = curl_error($_0xb149);
 goto L_b5155;
 L_28dc5:
 $_0x69ba = "\x68\164\x74\160\x73\72\x2f\57\x61\160\x69\56\x63\154\x6f\165\x64\146\x6c\141\x72\145\x2e\143\x6f\155\x2f\143\x6c\151\x65\156\x74\57\x76\64\x2f\141\x63\143\x6f\165\x6e\164\x73\57" . rawurlencode(trim($_0x678f)) . "\x2f\141\x69\57\x72\165\x6e\57\x40\143\x66\57\x62\154\x61\143\x6b\55\x66\157\x72\145\x73\164\x2d\154\x61\142\x73\57\x66\154\x75\170\x2d\61\x2d\163\x63\150\x6e\145\x6c\154";
 goto L_aa23c;
 L_b5155:
 curl_close($_0xb149);
 goto L_1d018;
 L_38216:
 $_0x47be = curl_exec($_0xb149);
 goto L_120fc;
 L_120fc:
 $_0x5a68 = (int) curl_getinfo($_0xb149, CURLINFO_HTTP_CODE);
 goto L_c5bb2;
 L_9e078:
 if ($_0x5a68 >= 200 && $_0x5a68 < 300 && !empty($_0x3273["\x73\165\x63\143\x65\163\x73"]) && !empty($_0x3273["\x72\145\x73\165\x6c\164"]["\x69\155\x61\147\x65"])) {
 $_0xbfb8 = base64_decode(str_replace(["\x20", "\xd", "\xa"], '', (string) $_0x3273["\x72\145\x73\165\x6c\164"]["\x69\155\x61\147\x65"]), true);
 if ($_0xbfb8 !== false && strlen($_0xbfb8) > 100) {
 return $this->saveRasterBinary($_0xbfb8, $_0xbb5d, "\x61\151\x5f\143\x66\137");
 }
 }
 goto L_4b2ec;
 L_4b2ec:
 $_0x7160 = $_0x3273["\x65\162\x72\157\x72\163"][0]["\x6d\145\x73\163\x61\147\x65"] ?? "\x48\124\x54\120\x20" . $_0x5a68;
 goto L_07abf;
 L_fe9b6:
 curl_setopt_array($_0xb149, [CURLOPT_RETURNTRANSFER => true, CURLOPT_POST => true, CURLOPT_HTTPHEADER => ["\x41\165\x74\150\x6f\162\x69\172\x61\164\x69\157\x6e\72\x20\102\x65\141\x72\145\x72\40" . trim($_0xec1f), "\x43\157\x6e\164\x65\156\x74\55\x54\171\x70\145\x3a\40\x61\160\x70\154\x69\143\x61\164\x69\157\x6e\57\x6a\163\x6f\156"], CURLOPT_POSTFIELDS => json_encode(["\x70\162\x6f\155\x70\164" => $_0x5b5f, "\x6e\165\x6d\137\x73\164\x65\160\x73" => 4]), CURLOPT_TIMEOUT => 45, CURLOPT_CONNECTTIMEOUT => 12, CURLOPT_SSL_VERIFYPEER => false, CURLOPT_SSL_VERIFYHOST => 0]);
 goto L_38216;
 L_1d018:
 if ($_0x47be === false || !empty($_0xb173)) {
 return ["\x73\165\x63\143\x65\163\x73" => false, "\x65\162\x72\157\x72" => "\x4b\157\x6e\145\x6b\163\x69\40\x43\154\x6f\165\x64\146\x6c\141\x72\145\x20\147\x61\147\x61\154\x3a\40" . $_0xb173];
 }
 goto L_3decc;
 L_3decc:
 $_0x3273 = json_decode($_0x47be, true);
 goto L_9e078;
 L_07abf:
 return ["\x73\165\x63\143\x65\163\x73" => false, "\x65\162\x72\157\x72" => $_0x7160];
 }
 /**
 * Hugging Face Router Inference API (black-forest-labs/FLUX.1-schnell)
 */
 private function generateViaHuggingFaceFlux(string $_0x6c0d, string $_0x3543, string $_0x32f9): array
 {
 goto L_4952e;
 L_4952e:
 $_0x70a1 = "\x68\164\x74\160\x73\72\x2f\57\x72\157\x75\164\x65\162\x2e\150\x75\147\x67\151\x6e\147\x66\141\x63\145\x2e\143\x6f\57\x68\146\x2d\151\x6e\146\x65\162\x65\156\x63\145\x2f\155\x6f\144\x65\154\x73\57\x62\154\x61\143\x6b\55\x66\157\x72\145\x73\164\x2d\154\x61\142\x73\57\x46\114\x55\130\x2e\61\x2d\163\x63\150\x6e\145\x6c\154";
 goto L_52e6f;
 L_d0f59:
 $_0x9f4b = (int) curl_getinfo($_0xfaa3, CURLINFO_HTTP_CODE);
 goto L_f0c29;
 L_f85ab:
 curl_setopt_array($_0xfaa3, [CURLOPT_RETURNTRANSFER => true, CURLOPT_POST => true, CURLOPT_HTTPHEADER => ["\x41\165\x74\150\x6f\162\x69\172\x61\164\x69\157\x6e\72\x20\102\x65\141\x72\145\x72\40" . trim($_0x6c0d), "\x43\157\x6e\164\x65\156\x74\55\x54\171\x70\145\x3a\40\x61\160\x70\154\x69\143\x61\164\x69\157\x6e\57\x6a\163\x6f\156"], CURLOPT_POSTFIELDS => json_encode(["\x69\156\x70\165\x74\163" => $_0x3543]), CURLOPT_TIMEOUT => 60, CURLOPT_CONNECTTIMEOUT => 12, CURLOPT_SSL_VERIFYPEER => false, CURLOPT_SSL_VERIFYHOST => 0]);
 goto L_1ec50;
 L_8662a:
 $_0xc429 = $_0x195e["\x65\162\x72\157\x72"] ?? "\x48\124\x54\120\x20" . $_0x9f4b;
 goto L_8fc50;
 L_6c038:
 if ($_0x9f4b >= 200 && $_0x9f4b < 300 && strlen($_0x1cf9) > 200 && @getimagesizefromstring($_0x1cf9) !== false) {
 return $this->saveRasterBinary($_0x1cf9, $_0x32f9, "\x61\151\x5f\150\x66\137");
 }
 goto L_61012;
 L_d3fcc:
 curl_close($_0xfaa3);
 goto L_0ade4;
 L_f0c29:
 $_0xea34 = curl_error($_0xfaa3);
 goto L_d3fcc;
 L_0ade4:
 if ($_0x1cf9 === false || !empty($_0xea34)) {
 return ["\x73\165\x63\143\x65\163\x73" => false, "\x65\162\x72\157\x72" => "\x4b\157\x6e\145\x6b\163\x69\40\x48\165\x67\147\x69\156\x67\40\x46\141\x63\145\x20\147\x61\147\x61\154\x3a\40" . $_0xea34];
 }
 goto L_6c038;
 L_1ec50:
 $_0x1cf9 = curl_exec($_0xfaa3);
 goto L_d0f59;
 L_52e6f:
 $_0xfaa3 = curl_init($_0x70a1);
 goto L_f85ab;
 L_8fc50:
 return ["\x73\165\x63\143\x65\163\x73" => false, "\x65\162\x72\157\x72" => is_string($_0xc429) ? $_0xc429 : "\x48\124\x54\120\x20" . $_0x9f4b];
 L_61012:
 $_0x195e = json_decode($_0x1cf9, true);
 goto L_8662a;
 }
 /**
 * Pollinations AI (Keyed via gen.pollinations.ai atau Gratis Terbatas via image.pollinations.ai)
 */
 private function generateViaPollinations(string $_0xfa78, string $_0x1e6e, string $_0x19d4): array
 {
 goto L_0c78b;
 L_146ee:
 return ["\x73\165\x63\143\x65\163\x73" => false, "\x65\162\x72\157\x72" => "\x50\157\x6c\154\x69\156\x61\164\x69\157\x6e\163\x20\164\x69\144\x61\153\x20\155\x65\156\x67\145\x6d\142\x61\154\x69\153\x61\156\x20\147\x61\155\x62\141\x72\40\x28\110\x54\124\x50\40" . $_0xe697 . "\x29\56"];
 L_f52ad:
 if ($_0x28fa === false || !empty($_0xf442)) {
 return ["\x73\165\x63\143\x65\163\x73" => false, "\x65\162\x72\157\x72" => "\x4b\157\x6e\145\x6b\163\x69\40\x50\157\x6c\154\x69\156\x61\164\x69\157\x6e\163\x20\147\x61\147\x61\154\x3a\40" . $_0xf442];
 }
 goto L_832c9;
 L_3ff80:
 curl_setopt_array($_0x7ab1, [CURLOPT_RETURNTRANSFER => true, CURLOPT_FOLLOWLOCATION => true, CURLOPT_HTTPHEADER => $_0x13a7, CURLOPT_TIMEOUT => 40, CURLOPT_CONNECTTIMEOUT => 12, CURLOPT_USERAGENT => "\x4d\157\x7a\151\x6c\154\x61\57\x35\56\x30\40\x28\143\x6f\155\x70\141\x74\151\x62\154\x65\73\x20\114\x4d\123\x2d\123\x63\150\x6f\157\x6c\55\x41\111\x2f\61\x2e\60\x29", CURLOPT_SSL_VERIFYPEER => false, CURLOPT_SSL_VERIFYHOST => 0]);
 goto L_d45f5;
 L_efaf2:
 if ($_0xe697 === 402 || $_0xe697 === 429) {
 return ["\x73\165\x63\143\x65\163\x73" => false, "\x65\162\x72\157\x72" => "\x3c\142\x3e\113\x75\157\x74\141\x20\163\x65\155\x65\156\x74\141\x72\141\x20\120\x6f\154\x6c\151\x6e\141\x74\151\x6f\156\x73\40\x61\156\x6f\156\x69\155\x20\160\x65\156\x75\150\x20\50\x48\124\x54\120\x20" . $_0xe697 . "\x29\56\x3c\57\x62\76\x3c\142\x72\76\x3c\163\x6d\141\x6c\154\x20\143\x6c\141\x73\163\x3d\42\x74\145\x78\164\x2d\155\x75\164\x65\144\x22\76\x45\156\x64\160\x6f\151\x6e\164\x20\147\x72\141\x74\151\x73\40\x74\141\x6e\160\x61\40\x64\141\x66\164\x61\162\x20\155\x65\155\x62\141\x74\141\x73\151\x20\146\x72\145\x6b\165\x65\156\x73\151\x20\160\x65\162\x6d\151\x6e\164\x61\141\x6e\40\x70\145\x72\40\x49\120\x20\163\x65\162\x76\145\x72\56\x20\125\x6e\164\x75\153\x20\153\x75\157\x74\141\x20\150\x61\162\x69\141\x6e\40\x67\162\x61\164\x69\163\x20\171\x61\156\x67\40\x73\164\x61\142\x69\154\x20\50\x7e\61\x30\60\x2b\40\x67\141\x6d\142\x61\162\x2f\150\x61\162\x69\40\x74\141\x6e\160\x61\40\x6b\141\x72\164\x75\40\x6b\162\x65\144\x69\164\x29\54\x20\163\x69\154\x61\153\x61\156\x20\141\x74\165\x72\40\x3c\142\x3e\103\x6c\157\x75\144\x66\154\x61\162\x65\40\x57\157\x72\153\x65\162\x73\40\x41\111\x3c\57\x62\76\x20\144\x69\40\x50\145\x6e\147\x61\164\x75\162\x61\156\x20\101\x50\111\x20\101\x49\40\x61\164\x61\165\x20\160\x69\154\x69\150\x20\155\x6f\144\x65\40\x3c\142\x3e\104\x69\141\x67\162\x61\155\x20\126\x65\153\x74\157\x72\40\x41\111\x3c\57\x62\76\x2e\74\x2f\163\x6d\141\x6c\154\x3e"];
 }
 goto L_146ee;
 L_1f5df:
 $_0xe697 = (int) curl_getinfo($_0x7ab1, CURLINFO_HTTP_CODE);
 goto L_023ca;
 L_7ba23:
 curl_close($_0x7ab1);
 goto L_f52ad;
 L_639bf:
 $_0x7ab1 = curl_init($_0x3c26);
 goto L_3ff80;
 L_f18f9:
 if ($_0xfa78 !== '') {
 $_0x3c26 = "https://gen.pollinations.ai/image/{$_0xd048}?model=flux&width=800&height=500&nologo=true&seed={$_0x41c4}";
 $_0x13a7 = ["\x41\165\x74\150\x6f\162\x69\172\x61\164\x69\157\x6e\72\x20\102\x65\141\x72\145\x72\40" . trim($_0xfa78)];
 } else {
 $_0x3c26 = "https://image.pollinations.ai/prompt/{$_0xd048}?width=800&height=500&nologo=true&model=flux&seed={$_0x41c4}";
 $_0x13a7 = [];
 }
 goto L_639bf;
 L_93823:
 $_0xd048 = rawurlencode($_0x1e6e);
 goto L_f18f9;
 L_d45f5:
 $_0x28fa = curl_exec($_0x7ab1);
 goto L_1f5df;
 L_832c9:
 if ($_0xe697 >= 200 && $_0xe697 < 300 && strlen($_0x28fa) > 500 && @getimagesizefromstring($_0x28fa) !== false) {
 return $this->saveRasterBinary($_0x28fa, $_0x19d4, "\x61\151\x5f\160\x6f\154\x6c\137");
 }
 goto L_efaf2;
 L_023ca:
 $_0xf442 = curl_error($_0x7ab1);
 goto L_7ba23;
 L_0c78b:
 $_0x41c4 = mt_rand(10000, 9999999);
 goto L_93823;
 }
 /**
 * Membersihkan dan memastikan SVG aman serta memiliki viewBox + ukuran eksplisit
 */
 private function sanitizeGeneratedSvg(string $_0x18d4): string
 {
 goto L_bc2df;
 L_7f457:
 $_0x3403 = str_replace("\x60\140\x60", '', (string) $_0x3403);
 goto L_6c431;
 L_14cc2:
 $_0xcd06 = preg_replace("\x2f\152\x61\166\x61\163\x63\162\x69\160\x74\134\x73\52\x3a\57\x69", '', $_0xcd06);
 goto L_d378a;
 L_ebdb9:
 $_0xcd06 = preg_replace("\x2f\74\x73\143\x72\151\x70\164\x5c\142\x5b\136\x3e\135\x2a\134\x2f\76\x2f\151", '', $_0xcd06);
 goto L_70a8d;
 L_407a7:
 $_0xcd06 = trim($_0xeda6[0]);
 goto L_15d27;
 L_70a8d:
 $_0xcd06 = preg_replace("\x2f\74\x66\157\x72\145\x69\147\x6e\117\x62\152\x65\143\x74\134\x62\133\x5e\76\x5d\52\x3e\133\x5c\163\x5c\123\x5d\52\x3f\74\x5c\57\x66\157\x72\145\x69\147\x6e\117\x62\152\x65\143\x74\76\x2f\151", '', $_0xcd06);
 goto L_e0cdd;
 L_e226f:
 $_0xcd06 = preg_replace("\x2f\134\x62\50\x3f\72\x78\154\x69\156\x6b\72\x29\77\x68\162\x65\146\x5c\163\x2a\75\x5c\163\x2a\50\x3f\72\x22\134\x73\52\x28\77\x3a\150\x74\164\x70\163\x3f\72\x7c\134\x2f\134\x2f\174\x6a\141\x76\141\x73\143\x72\151\x70\164\x3a\51\x5b\136\x22\135\x2a\42\x7c\47\x5c\163\x2a\50\x3f\72\x68\164\x74\160\x73\77\x3a\174\x5c\57\x5c\57\x7c\152\x61\166\x61\163\x63\162\x69\160\x74\72\x29\133\x5e\47\x5d\52\x27\51\x2f\151", '', $_0xcd06);
 goto L_14cc2;
 L_bc2df:
 $_0x3403 = preg_replace("\x2f\140\x60\140\x28\77\x3a\163\x76\147\x7c\170\x6d\154\x7c\150\x74\155\x6c\51\x3f\134\x73\52\x2f\151", '', $_0x18d4);
 goto L_7f457;
 L_77de5:
 $_0xcd06 = preg_replace("\x2f\134\x73\157\x6e\133\x61\55\x7a\60\x2d\71\x5f\135\x2b\134\x73\52\x3d\134\x73\52\x28\77\x3a\42\x5b\136\x22\135\x2a\42\x7c\47\x5b\136\x27\135\x2a\47\x7c\133\x5e\134\x73\76\x5d\53\x29\57\x69", '', $_0xcd06);
 goto L_e226f;
 L_ab92c:
 return $_0xcd06;
 L_6c431:
 if (!preg_match("\x2f\74\x73\166\x67\134\x62\133\x5e\76\x5d\52\x3e\133\x5c\163\x5c\123\x5d\52\x3f\74\x5c\57\x73\166\x67\76\x2f\151", $_0x3403, $_0xeda6)) {
 return '';
 }
 goto L_407a7;
 L_e0cdd:
 $_0xcd06 = preg_replace("\x2f\74\x66\157\x72\145\x69\147\x6e\117\x62\152\x65\143\x74\134\x62\133\x5e\76\x5d\52\x5c\57\x3e\57\x69", '', $_0xcd06);
 goto L_77de5;
 L_d378a:
 // Pastikan atribut xmlns, viewBox, width, dan height ada pada elemen <svg>
 if (preg_match("\x2f\136\x3c\163\x76\147\x5c\142\x28\133\x5e\76\x5d\52\x29\76\x2f\151", $_0xcd06, $_0x4097)) {
 $_0xe7d1 = $_0x4097[1];
 if (stripos($_0xe7d1, "\x78\155\x6c\156\x73\75") === false) {
 $_0xe7d1 .= "\x20\170\x6d\154\x6e\163\x3d\42\x68\164\x74\160\x3a\57\x2f\167\x77\167\x2e\167\x33\56\x6f\162\x67\57\x32\60\x30\60\x2f\163\x76\147\x22";
 }
 $_0xc115 = 800;
 $_0xbdc1 = 480;
 if (preg_match("\x2f\166\x69\145\x77\102\x6f\170\x5c\163\x2a\75\x5c\163\x2a\133\x22\47\x5d\134\x73\52\x5b\55\x5c\144\x2e\135\x2b\134\x73\53\x5b\55\x5c\144\x2e\135\x2b\134\x73\53\x28\133\x5c\144\x2e\135\x2b\51\x5c\163\x2b\50\x5b\134\x64\56\x5d\53\x29\134\x73\52\x5b\42\x27\135\x2f\151", $_0xe7d1, $_0x5136)) {
 $_0xc115 = max(200, min(2000, (int) round((float) $_0x5136[1])));
 $_0xbdc1 = max(150, min(2000, (int) round((float) $_0x5136[2])));
 } else {
 $_0xe7d1 .= "\x20\166\x69\145\x77\102\x6f\170\x3d\42\x30\40\x30\40\x38\60\x30\40\x34\70\x30\42";
 }
 if (!preg_match("\x2f\134\x62\167\x69\144\x74\150\x5c\163\x2a\75\x2f\151", $_0xe7d1)) {
 $_0xe7d1 .= "\x20\167\x69\144\x74\150\x3d\42" . $_0xc115 . "\x22";
 }
 if (!preg_match("\x2f\134\x62\150\x65\151\x67\150\x74\134\x73\52\x3d\57\x69", $_0xe7d1)) {
 $_0xe7d1 .= "\x20\150\x65\151\x67\150\x74\75\x22" . $_0xbdc1 . "\x22";
 }
 $_0xcd06 = preg_replace("\x2f\136\x3c\163\x76\147\x5c\142\x5b\136\x3e\135\x2a\76\x2f\151", "\x3c\163\x76\147" . $_0xe7d1 . "\x3e", $_0xcd06, 1);
 }
 goto L_ab92c;
 L_15d27:
 // Hapus tag berpotensi berbahaya & objek eksternal agar aman dan tidak me-taint HTML5 Canvas
 $_0xcd06 = preg_replace("\x2f\74\x73\143\x72\151\x70\164\x5c\142\x5b\136\x3e\135\x2a\76\x5b\134\x73\134\x53\135\x2a\77\x3c\134\x2f\163\x63\162\x69\160\x74\76\x2f\151", '', $_0xcd06);
 goto L_ebdb9;
 }
 /**
 * Menghasilkan ilustrasi diagram/kartu vektor SVG berkualitas pendidikan memakai model teks aktif (Free Tier friendly)
 */
 private function generateVectorSvgFallback(string $_0x43e8, string $_0x4b8a, string $_0x8bcd, string $_0xf050): array
 {
 goto L_5d6c5;
 L_6740d:
 $_0x22be = "\x61\151\x5f\166\x65\143\x5f" . date("\x59\155\x64\110\x69\163") . "\x5f" . bin2hex(random_bytes(4)) . "\x2e\163\x76\147";
 goto L_ecded;
 L_9df0d:
 if ($_0x3c92 === '') {
 return ["\x73\165\x63\143\x65\163\x73" => false, "\x65\162\x72\157\x72" => "\x4d\157\x64\145\x6c\40\x28" . ($_0x7202["\x6d\157\x64\145\x6c"] ?? "\x67\145\x6d\151\x6e\151") . "\x29\40\x62\145\x6c\165\x6d\40\x6d\145\x6e\147\x65\155\x62\141\x6c\151\x6b\141\x6e\40\x74\141\x67\40\x3c\163\x76\147\x3e\56\x2e\56\x3c\57\x73\166\x67\76\x20\171\x61\156\x67\40\x6c\145\x6e\147\x6b\141\x70\56"];
 }
 goto L_4dd62;
 L_08de7:
 if (!is_dir($_0x4ba9)) {
 @mkdir($_0x4ba9, 0775, true);
 }
 goto L_6740d;
 L_142dc:
 $_0x7202 = $this->callGeminiApi($_0xa2f8, false, null, null, 16384);
 goto L_ecab1;
 L_5d6c5:
 $_0xf9ee = $_0x8bcd !== '' ? "Konteks teks soal/materi: {$_0x8bcd}\n" : '';
 goto L_da717;
 L_ecab1:
 if (!$_0x7202["\x73\165\x63\143\x65\163\x73"]) {
 return ["\x73\165\x63\143\x65\163\x73" => false, "\x65\162\x72\157\x72" => $_0x7202["\x65\162\x72\157\x72"] ?? "\x47\141\x67\141\x6c\40\x6d\145\x6e\147\x68\165\x62\165\x6e\147\x69\40\x6d\157\x64\145\x6c\40\x74\145\x6b\163\x20\101\x49\40\x75\156\x74\165\x6b\40\x6d\145\x6d\142\x75\141\x74\40\x69\154\x75\163\x74\162\x61\163\x69\40\x76\145\x6b\164\x6f\162\x2e"];
 }
 goto L_becbc;
 L_668b6:
 return ["\x73\165\x63\143\x65\163\x73" => true, "\x73\166\x67\137\x63\157\x64\145" => $_0x3c92, "\x66\151\x6c\145\x6e\141\x6d\145" => $_0xbf1c . $_0x22be, "\x75\162\x6c" => base_url($_0xbf1c . $_0x22be), "\x6d\157\x64\145\x6c\137\x75\163\x65\144" => $_0x7202["\x6d\157\x64\145\x6c"] ?? "\x67\145\x6d\151\x6e\151"];
 L_4dd62:
 $_0xbf1c = $_0xf050 === "\x6d\141\x74\145\x72\151" ? "\x75\160\x6c\157\x61\144\x73\57\x6d\141\x74\145\x72\151\x2f" : "\x75\160\x6c\157\x61\144\x73\57\x62\141\x6e\153\x5f\163\x6f\141\x6c\57";
 goto L_e3318;
 L_da717:
 $_0xa2f8 = <<<EOT
 Buatkan SATU gambar vektor SVG pendidikan (`viewBox="0 0 800 480" width="800" height="480"`) untuk soal/materi sekolah.
 
 Topik gambar: {$_0x43e8}
 Gaya visual: {$_0x4b8a}
 {$_0xf9ee}
 Aturan WAJIB:
 1. Jawab HANYA kode `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 800 480" width="800" height="480">...</svg>` secara utuh (tanpa markdown/komentar di luar tag).
 2. Buat desain bersih dan ringkas (sekitar 20-45 elemen vektor `<rect>`, `<circle>`, `<path>`, `<line>`, `<polygon>`, `<text>`), latar terang `#f8fafc`/`#ffffff`, kartu rapi (`rx="12"`), warna harmonis, margin minimal 28px.
 3. Teks harus jelas dan tidak bertumpuk (`font-family="Arial, Tahoma, sans-serif"`). Jika menyentuh kosakata Arab, pakai teks Arab UTF-8 yang jelas sebagai konteks stimulus visual.
 4. JANGAN tampilkan jawaban soal di dalam gambar jika input berupa pertanyaan ujian.
 5. Dilarang memakai `<script>`, `<foreignObject>`, atau link eksternal `http://`/`https://`.
 EOT;
 goto L_142dc;
 L_becbc:
 $_0x3c92 = $this->sanitizeGeneratedSvg((string) ($_0x7202["\x74\145\x78\164"] ?? ''));
 goto L_9df0d;
 L_e3318:
 $_0x4ba9 = FCPATH . $_0xbf1c;
 goto L_08de7;
 L_ecded:
 $_0x1eda = $_0x4ba9 . $_0x22be;
 goto L_4ee74;
 L_4ee74:
 if (@file_put_contents($_0x1eda, $_0x3c92) === false || !is_file($_0x1eda)) {
 return ["\x73\165\x63\143\x65\163\x73" => false, "\x65\162\x72\157\x72" => "\x53\145\x72\166\x65\162\x20\147\x61\147\x61\154\x20\155\x65\156\x79\151\x6d\160\x61\156\x20\146\x69\154\x65\40\x53\126\x47\40\x6b\145\x20\146\x6f\154\x64\145\x72\40" . $_0xbf1c . "\x2e"];
 }
 goto L_668b6;
 }
 /**
 * POST aigenerator/savecanvasimage
 * Menyimpan hasil render PNG (konversi vektor SVG dari browser) menjadi file PNG standar di uploads/.
 */
 public function savecanvasimage()
 {
 if (!$this->isAuthorized()) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x53\145\x73\151\x20\164\x65\154\x61\150\x20\142\x65\162\x61\153\x68\151\x72\56", "\x63\163\x72\146\x5f\150\x61\163\x68" => csrf_hash()]);
 }
 try {
 $_0xfd63 = trim((string) $this->request->getPost("\x69\155\x61\147\x65\137\x62\141\x73\145\x36\64"));
 $_0xe94b = strtolower(trim((string) ($this->request->getPost("\x63\157\x6e\164\x65\170\x74") ?: "\x62\141\x6e\153\x5f\163\x6f\141\x6c")));
 $_0xc841 = trim((string) $this->request->getPost("\x72\145\x70\154\x61\143\x65\137\x66\151\x6c\145\x6e\141\x6d\145"));
 if (!preg_match("\x2f\136\x64\141\x74\141\x3a\151\x6d\141\x67\145\x5c\57\x70\156\x67\73\x62\141\x73\145\x36\64\x2c\50\x5b\101\x2d\132\x61\55\x7a\60\x2d\71\x2b\134\x2f\75\x5c\162\x5c\156\x5d\53\x29\44\x2f", $_0xfd63, $_0x9c5b)) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x46\157\x72\155\x61\164\x20\147\x61\155\x62\141\x72\40\x50\116\x47\40\x74\151\x64\141\x6b\40\x76\141\x6c\151\x64\56", "\x63\163\x72\146\x5f\150\x61\163\x68" => csrf_hash()]);
 }
 $_0x2a6e = base64_decode(str_replace(["\xd", "\xa"], '', $_0x9c5b[1]), true);
 if ($_0x2a6e === false || strlen($_0x2a6e) < 100 || strlen($_0x2a6e) > 5 * 1024 * 1024) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x55\153\x75\162\x61\156\x20\141\x74\141\x75\40\x69\163\x69\40\x64\141\x74\141\x20\147\x61\155\x62\141\x72\40\x50\116\x47\40\x74\151\x64\141\x6b\40\x76\141\x6c\151\x64\56", "\x63\163\x72\146\x5f\150\x61\163\x68" => csrf_hash()]);
 }
 $_0x6115 = @getimagesizefromstring($_0x2a6e);
 if (!$_0x6115 || ($_0x6115["\x6d\151\x6d\145"] ?? '') !== "\x69\155\x61\147\x65\57\x70\156\x67") {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x44\141\x74\141\x20\171\x61\156\x67\40\x64\151\x6b\151\x72\151\x6d\40\x62\165\x6b\141\x6e\40\x67\141\x6d\142\x61\162\x20\120\x4e\107\x20\171\x61\156\x67\40\x73\141\x68\56", "\x63\163\x72\146\x5f\150\x61\163\x68" => csrf_hash()]);
 }
 $_0x8112 = $_0xe94b === "\x6d\141\x74\145\x72\151" ? "\x75\160\x6c\157\x61\144\x73\57\x6d\141\x74\145\x72\151\x2f" : "\x75\160\x6c\157\x61\144\x73\57\x62\141\x6e\153\x5f\163\x6f\141\x6c\57";
 $_0x72ca = FCPATH . $_0x8112;
 if (!is_dir($_0x72ca)) {
 @mkdir($_0x72ca, 0775, true);
 }
 $_0x1bdd = "\x61\151\x5f\146\x69\147\x5f" . date("\x59\155\x64\110\x69\163") . "\x5f" . bin2hex(random_bytes(4)) . "\x2e\160\x6e\147";
 $_0xd1ed = $_0x72ca . $_0x1bdd;
 if (@file_put_contents($_0xd1ed, $_0x2a6e) === false || !is_file($_0xd1ed)) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x47\141\x67\141\x6c\40\x6d\145\x6e\171\x69\155\x70\141\x6e\40\x66\151\x6c\145\x20\120\x4e\107\x20\153\x65\40" . $_0x8112, "\x63\163\x72\146\x5f\150\x61\163\x68" => csrf_hash()]);
 }
 // Hapus file SVG sementara jika ada agar disk tetap bersih
 if ($_0xc841 !== '' && strpos($_0xc841, $_0x8112 . "\x61\151\x5f\166\x65\143\x5f") === 0 && substr($_0xc841, -4) === "\x2e\163\x76\147") {
 $_0xefff = basename($_0xc841);
 if (is_file($_0x72ca . $_0xefff)) {
 @unlink($_0x72ca . $_0xefff);
 }
 }
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => true, "\x66\151\x6c\145\x6e\141\x6d\145" => $_0x8112 . $_0x1bdd, "\x75\162\x6c" => base_url($_0x8112 . $_0x1bdd), "\x63\163\x72\146\x5f\150\x61\163\x68" => csrf_hash()]);
 } catch (\Throwable $_0xa2f0) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x47\141\x67\141\x6c\40\x6d\145\x6e\171\x69\155\x70\141\x6e\40\x67\141\x6d\142\x61\162\x20\120\x4e\107\x3a\40" . $_0xa2f0->getMessage(), "\x63\163\x72\146\x5f\150\x61\163\x68" => csrf_hash()]);
 }
 }
}