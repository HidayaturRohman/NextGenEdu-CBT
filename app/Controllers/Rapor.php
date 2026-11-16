<?php
/*   ________________________________________
    |               NextGen Garuda CBT       |
    |    Protected & Distributed via GitHub  |
    |________________________________________|
*/
/**
 * Created by IntelliJ IDEA.
 * User: Hidayatur Rohman
 * Date: 07/07/20
 * Time: 14:10
 */
namespace App\Controllers;

class Rapor extends BaseController
{
 protected $db;
 protected $rapor;
 protected $raporKurmer;
 protected $kelas;
 protected $dropdown;
 protected $master;
 protected $dashboard;
 protected $logging;
 public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $_0xe10c)
 {
 goto L_d528e;
 L_c542a:
 $this->kelas = new \App\Models\KelasModel();
 goto L_cf7af;
 L_62184:
 $this->raporKurmer = new \App\Models\RaporKurmerModel();
 goto L_c542a;
 L_56a92:
 $this->master = new \App\Models\MasterModel();
 goto L_d6c42;
 L_d6c42:
 $this->dashboard = new \App\Models\DashboardModel();
 goto L_12452;
 L_47d7a:
 // Pastikan kolom ttd_rapor_ringkas otomatis ditambahkan jika belum ada di database live
 if ($this->db->tableExists("\x72\141\x70\157\x72\137\x6b\165\x72\155\x65\162\x5f\163\x65\164\x74\151\x6e\147")) {
 $_0xe77d = $this->db->getFieldNames("\x72\141\x70\157\x72\137\x6b\165\x72\155\x65\162\x5f\163\x65\164\x74\151\x6e\147");
 if (!in_array("\x74\164\x64\137\x72\141\x70\157\x72\137\x72\151\x6e\147\x6b\141\x73", $_0xe77d)) {
 $this->db->query("\x41\114\x54\105\x52\40\x54\101\x42\114\x45\40\x60\162\x61\160\x6f\162\x5f\153\x75\162\x6d\145\x72\137\x73\145\x74\164\x69\156\x67\140\x20\101\x44\104\x20\103\x4f\114\x55\115\x4e\40\x60\164\x74\144\x5f\162\x61\160\x6f\162\x5f\162\x69\156\x67\153\x61\163\x60\40\x56\101\x52\103\x48\101\x52\50\x32\60\x29\40\x44\105\x46\101\x55\114\x54\40\x27\63\x27");
 }
 }
 L_d528e:
 parent::initController($request, $response, $_0xe10c);
 goto L_21c6f;
 L_21c6f:
 $this->rapor = new \App\Models\RaporModel();
 goto L_62184;
 L_cf7af:
 $this->dropdown = new \App\Models\DropdownModel();
 goto L_56a92;
 L_12452:
 $this->logging = new \App\Models\LogModel();
 goto L_a49ab;
 L_a49ab:
 $this->db = \Config\Database::connect();
 goto L_47d7a;
 }
 private function resolveWaliKelasId($_0x3d30, $_0xbf29, $_0x920b)
 {
 goto L_8a193;
 L_48493:
 $_0x7006 = $this->request->getGet("\x6b\145\x6c\141\x73") ?? ($_0xf494->wali_kelas ?? $this->request->getGet("\x6b\145\x6c\141\x73") ?? null) ?? null;
 goto L_799b8;
 L_799b8:
 if (!$_0x7006) {
 $_0x177e = $this->kelas->getKelasList($_0xbf29, $_0x920b);
 if (!empty($_0x177e)) {
 $_0x7006 = $_0x177e[0]->id_kelas;
 }
 }
 goto L_7e07b;
 L_8a193:
 $_0xf494 = $this->dashboard->getDataGuruByUsername($_0x3d30, $_0xbf29, $_0x920b);
 goto L_48493;
 L_7e07b:
 return [$_0xf494, $_0x7006];
 }
 public function index()
 {
 goto L_38134;
 L_d5e90:
 $_0x3e9c["\x6b\153\x6d\137\x64\162\x6f\160"] = ["\x54\151\x64\141\x6b", "\x59\141"];
 goto L_dfc59;
 L_38134:
 $_0x6df4 = (object) ["\x69\144" => session()->get("\x69\144\x5f\165\x73\145\x72"), "\x75\163\x65\162\x6e\141\x6d\145" => session()->get("\x75\163\x65\162\x6e\141\x6d\145")];
 goto L_0eeec;
 L_dfc59:
 $_0xc867 = session()->get("\x72\157\x6c\145");
 goto L_d8574;
 L_d4d0d:
 $_0x49e8 = $this->dashboard->getSemesterActive();
 goto L_85ce9;
 L_bcadb:
 $_0x3e9c["\x73\155\x74\137\x61\143\x74\151\x76\145"] = $_0x49e8;
 goto L_9d545;
 L_9d545:
 $_0x3e9c["\x72\141\x70\157\x72"] = $this->raporKurmer->getSetting($_0xc825->id_tp, $_0x49e8->id_smt);
 goto L_d5e90;
 L_d8574:
 if ($_0xc867 == 1 || empty($_0xc867)) {
 return view("\x73\145\x74\164\x69\156\x67\57\x72\141\x70\157\x72", $_0x3e9c);
 } else {
 return redirect()->to("\x72\141\x70\157\x72\57\x72\141\x70\157\x72\153\x6b\155");
 }
 L_85ce9:
 $_0x3e9c["\x74\160"] = $this->dashboard->getTahun();
 goto L_8e94f;
 L_9a3b7:
 $_0x3e9c["\x73\155\x74"] = $this->dashboard->getSemester();
 goto L_bcadb;
 L_8e94f:
 $_0x3e9c["\x74\160\x5f\141\x63\164\x69\166\x65"] = $_0xc825;
 goto L_9a3b7;
 L_0eeec:
 $_0x3e9c = ["\x75\163\x65\162" => $_0x6df4, "\x6a\165\x64\165\x6c" => "\x50\145\x6e\147\x61\164\x75\162\x61\156\x20\122\x61\160\x6f\162", "\x73\165\x62\152\x75\144\x75\154" => "\x50\145\x6e\147\x61\164\x75\162\x61\156\x20\122\x61\160\x6f\162", "\x73\145\x74\164\x69\156\x67" => $this->dashboard->getSetting()];
 goto L_ed775;
 L_ed775:
 $_0xc825 = $this->dashboard->getTahunActive();
 goto L_d4d0d;
 }
 public function saveRaporAdmin()
 {
 goto L_7bcd0;
 L_25101:
 $_0x52fb = $this->raporKurmer->saveSetting($_0x2f4b);
 goto L_73b30;
 L_73b30:
 return $this->output_json(["\x73\164\x61\164\x75\163" => (bool) $_0x52fb]);
 L_015d2:
 $_0x2f4b = ["\x69\144\x5f\164\x70" => $_0x5641->id_tp, "\x69\144\x5f\163\x6d\164" => $_0xd78c->id_smt, "\x66\141\x73\145" => $this->request->getPost("\x66\141\x73\145") ?? "\x44", "\x74\145\x6d\160\x61\164" => $this->request->getPost("\x74\145\x6d\160\x61\164") ?? "\x53\165\x6d\142\x65\162\x61\147\x75\156\x67", "\x74\141\x6e\147\x67\141\x6c\137\x72\141\x70\157\x72" => $this->request->getPost("\x74\141\x6e\147\x67\141\x6c\137\x72\141\x70\157\x72"), "\x74\141\x6e\147\x67\141\x6c\137\x70\164\x73" => $this->request->getPost("\x74\141\x6e\147\x67\141\x6c\137\x70\164\x73"), "\x6b\153\x6d\137\x64\145\x66\141\x75\154\x74" => $this->request->getPost("\x6b\153\x6d\137\x64\145\x66\141\x75\154\x74") ?? 75, "\x62\157\x62\157\x74\137\x73\165\x6d\141\x74\151\x66" => $this->request->getPost("\x62\157\x62\157\x74\137\x73\165\x6d\141\x74\151\x66") ?? 50, "\x62\157\x62\157\x74\137\x73\141\x73" => $this->request->getPost("\x62\157\x62\157\x74\137\x73\141\x73") ?? 50, "\x6e\151\x70\137\x6b\145\x70\163\x65\153" => $this->request->getPost("\x6e\151\x70\137\x6b\145\x70\163\x65\153") ?? 0, "\x6e\151\x70\137\x77\141\x6c\151\x6b\145\x6c\141\x73" => $this->request->getPost("\x6e\151\x70\137\x77\141\x6c\151\x6b\145\x6c\141\x73") ?? 0, "\x77\141\x74\145\x72\155\x61\162\x6b\137\x74\145\x6b\163" => $this->request->getPost("\x77\141\x74\145\x72\155\x61\162\x6b\137\x74\145\x6b\163") ?? "\x4d\124\x73\40\x48\151\x64\141\x79\141\x74\165\x6c\40\x49\163\x6c\141\x6d\151\x79\141\x68", "\x6d\157\x64\145\x6c\137\x6b\157\x70" => $this->request->getPost("\x6d\157\x64\145\x6c\137\x6b\157\x70") ?? 1, "\x6d\157\x64\145\x5f\162\x61\160\x6f\162" => $this->request->getPost("\x6d\157\x64\145\x5f\162\x61\160\x6f\162") ?? "\x73\145\x6d\165\x61", "\x63\142\x74\137\x63\157\x6e\166\x65\162\x74\137\x6d\157\x64\145" => $this->request->getPost("\x63\142\x74\137\x63\157\x6e\166\x65\162\x74\137\x6d\157\x64\145") ?? "\x6b\141\x74\162\x6f\154", "\x63\142\x74\137\x6b\141\x74\162\x6f\154\x5f\155\x69\156" => $this->request->getPost("\x63\142\x74\137\x6b\141\x74\162\x6f\154\x5f\155\x69\156") ?? 60, "\x63\142\x74\137\x6b\141\x74\162\x6f\154\x5f\155\x61\170" => $this->request->getPost("\x63\142\x74\137\x6b\141\x74\162\x6f\154\x5f\155\x61\170") ?? 100, "\x61\165\x74\157\x5f\146\x69\154\x6c\137\x63\142\x74" => $this->request->getPost("\x61\165\x74\157\x5f\146\x69\154\x6c\137\x63\142\x74") ? 1 : 0, "\x74\164\x64\137\x72\141\x70\157\x72\137\x72\151\x6e\147\x6b\141\x73" => $this->request->getPost("\x74\164\x64\137\x72\141\x70\157\x72\137\x72\151\x6e\147\x6b\141\x73") ?? "\x33"];
 goto L_25101;
 L_7bcd0:
 $_0x5641 = $this->dashboard->getTahunActive();
 goto L_9ea35;
 L_9ea35:
 $_0xd78c = $this->dashboard->getSemesterActive();
 goto L_015d2;
 }
 public function mapel($_0xda18 = null)
 {
 goto L_4df81;
 L_5b500:
 $_0x4e10 = $this->raporKurmer->getAllMapelStatusRapor($_0xda18, $_0x5ff7->id_tp, $_0x15c2->id_smt);
 goto L_36d3b;
 L_bbee5:
 $_0x8cbb = $this->kelas->getKelasList($_0x5ff7->id_tp, $_0x15c2->id_smt);
 goto L_10ba2;
 L_85678:
 $_0x5ff7 = $this->dashboard->getTahunActive();
 goto L_f6c0c;
 L_f6c0c:
 $_0x15c2 = $this->dashboard->getSemesterActive();
 goto L_bbee5;
 L_10ba2:
 $_0xd184 = $_0xda18 ? $this->kelas->get_one($_0xda18) : null;
 goto L_5b500;
 L_36d3b:
 $_0x97cc = $this->raporKurmer->getSetting($_0x5ff7->id_tp, $_0x15c2->id_smt);
 goto L_6c2b6;
 L_90943:
 return view("\x73\145\x74\164\x69\156\x67\57\x6d\141\x70\145\x6c\137\x72\141\x70\157\x72", $_0x5d17);
 L_6c2b6:
 $_0x5d17 = ["\x75\163\x65\162" => $_0xe24d, "\x6a\165\x64\165\x6c" => "\x4b\145\x6c\157\x6c\141\x20\46\x20\122\x65\166\x69\163\x69\40\x4d\141\x70\145\x6c\40\x52\141\x70\157\x72", "\x73\165\x62\152\x75\144\x75\154" => "\x50\145\x6e\147\x61\164\x75\162\x61\156\x20\115\x61\164\x61\40\x50\145\x6c\141\x6a\141\x72\141\x6e\40\x79\141\x6e\147\x20\124\x61\155\x70\151\x6c\40\x64\151\x20\122\x61\160\x6f\162", "\x73\145\x74\164\x69\156\x67" => $this->dashboard->getSetting(), "\x74\160" => $this->dashboard->getTahun(), "\x74\160\x5f\141\x63\164\x69\166\x65" => $_0x5ff7, "\x73\155\x74" => $this->dashboard->getSemester(), "\x73\155\x74\137\x61\143\x74\151\x76\145" => $_0x15c2, "\x6b\145\x6c\141\x73" => $_0xd184, "\x6b\145\x6c\141\x73\114\x69\163\x74" => $_0x8cbb, "\x6d\141\x70\145\x6c\137\x6c\151\x73\164" => $_0x4e10["\x6d\141\x70\145\x6c\137\x6c\151\x73\164"], "\x6d\157\x64\145\x5f\155\x61\160\x65\154" => $_0x4e10["\x6d\157\x64\145\x5f\155\x61\160\x65\154\x5f\162\x61\160\x6f\162"], "\x72\141\x70\157\x72\137\x73\145\x74\164\x69\156\x67" => $_0x97cc];
 goto L_90943;
 L_4df81:
 $_0xe24d = (object) ["\x69\144" => session()->get("\x69\144\x5f\165\x73\145\x72"), "\x75\163\x65\162\x6e\141\x6d\145" => session()->get("\x75\163\x65\162\x6e\141\x6d\145")];
 goto L_85678;
 }
 public function saveMapelRapor()
 {
 goto L_692bb;
 L_dfcfd:
 $_0x566c = array_map("\x69\156\x74\166\x61\154", (array) $_0xa2ed);
 goto L_de1a2;
 L_5a690:
 $_0x3c6a = $this->request->getPost("\x63\165\x73\164\x6f\155\x5f\157\x72\144\x65\162") ?? [];
 goto L_39e82;
 L_1f59c:
 $_0xa2ed = $this->request->getPost("\x61\143\x74\151\x76\145\x5f\155\x61\160\x65\154\x73") ?? [];
 goto L_40649;
 L_40649:
 $_0x4e42 = $this->request->getPost("\x63\165\x73\164\x6f\155\x5f\156\x61\155\x65\163") ?? [];
 goto L_5a690;
 L_ed821:
 foreach ($_0x4e42 as $_0x5316 => $_0x7b4e) {
 $_0x7b4e = trim($_0x7b4e);
 if ($_0x7b4e !== '') {
 $_0x8a9b[(int) $_0x5316] = $_0x7b4e;
 }
 }
 goto L_0d140;
 L_e1dce:
 foreach ($_0x3c6a as $_0x5316 => $_0x7b4e) {
 if ($_0x7b4e !== '' && is_numeric($_0x7b4e)) {
 $_0xf8b3[(int) $_0x5316] = (int) $_0x7b4e;
 }
 }
 goto L_8db5e;
 L_18317:
 if (!empty($_0x7127)) {
 $_0x78e3["\x6d\141\x70\145\x6c\137\x70\145\x72\137\x6b\145\x6c\141\x73"][$_0x7127] = $_0x566c;
 }
 goto L_10f43;
 L_692bb:
 $_0xfd7e = $this->dashboard->getTahunActive();
 goto L_b105c;
 L_8db5e:
 $_0x78e3 = ["\x6d\157\x64\145" => $_0xc5d3, "\x61\143\x74\151\x76\145\x5f\155\x61\160\x65\154\x73" => $_0x566c, "\x63\165\x73\164\x6f\155\x5f\156\x61\155\x65\163" => $_0x8a9b, "\x63\165\x73\164\x6f\155\x5f\157\x72\144\x65\162" => $_0xf8b3];
 goto L_18317;
 L_d6ece:
 $_0xc5d3 = $this->request->getPost("\x6d\157\x64\145") ?? "\x6f\164\x6f\155\x61\164\x69\163";
 goto L_1f59c;
 L_0d140:
 $_0xf8b3 = [];
 goto L_e1dce;
 L_10f43:
 $_0x64f9 = $this->raporKurmer->saveMapelRaporConfig($_0x78e3, $_0xfd7e->id_tp, $_0x7505->id_smt);
 goto L_6f040;
 L_de1a2:
 $_0x8a9b = [];
 goto L_ed821;
 L_b105c:
 $_0x7505 = $this->dashboard->getSemesterActive();
 goto L_d6ece;
 L_39e82:
 $_0x7127 = $this->request->getPost("\x69\144\x5f\153\x65\154\x61\163");
 goto L_dfcfd;
 L_6f040:
 return $this->output_json(["\x73\164\x61\164\x75\163" => (bool) $_0x64f9, "\x6d\145\x73\163\x61\147\x65" => "\x50\145\x6e\147\x61\164\x75\162\x61\156\x20\155\x61\160\x65\154\x20\162\x61\160\x6f\162\x20\142\x65\162\x68\141\x73\151\x6c\40\x64\151\x73\151\x6d\160\x61\156"]);
 }
 public function syncMapelUjian()
 {
 goto L_a9c95;
 L_bd1aa:
 $_0x4398 = $this->dashboard->getSemesterActive();
 goto L_13cd1;
 L_e7be6:
 return $this->output_json(["\x73\164\x61\164\x75\163" => (bool) $_0x5264, "\x6d\145\x73\163\x61\147\x65" => "\x42\145\x72\150\x61\163\x69\154\x20\155\x65\156\x79\145\x73\165\x61\151\x6b\141\x6e\40\x6d\141\x70\145\x6c\40\x72\141\x70\157\x72\40\x73\145\x63\141\x72\141\x20\157\x74\157\x6d\141\x74\151\x73\40\x64\145\x6e\147\x61\156\x20\155\x61\160\x65\154\x20\171\x61\156\x67\40\x64\151\x75\152\x69\153\x61\156"]);
 L_a9c95:
 $_0xb552 = $this->dashboard->getTahunActive();
 goto L_bd1aa;
 L_8d1f7:
 $_0x5264 = $this->raporKurmer->syncMapelUjianToRapor($_0xb552->id_tp, $_0x4398->id_smt, $_0xa002);
 goto L_e7be6;
 L_13cd1:
 $_0xa002 = $this->request->getPost("\x69\144\x5f\153\x65\154\x61\163") ?? null;
 goto L_8d1f7;
 }
 public function resetStandarMts()
 {
 goto L_2e6c1;
 L_98655:
 return $this->output_json(["\x73\164\x61\164\x75\163" => (bool) $_0x220e, "\x6d\145\x73\163\x61\147\x65" => "\x42\145\x72\150\x61\163\x69\154\x20\155\x65\156\x65\162\x61\160\x6b\141\x6e\40\x31\65\x20\155\x61\160\x65\154\x20\163\x74\141\x6e\144\x61\162\x20\115\x54\163\x20\113\x65\155\x65\156\x61\147"]);
 L_db7e2:
 $_0x220e = $this->raporKurmer->resetStandarMtsToRapor($_0x2b36->id_tp, $_0xaafb->id_smt);
 goto L_98655;
 L_2e6c1:
 $_0x2b36 = $this->dashboard->getTahunActive();
 goto L_ca738;
 L_ca738:
 $_0xaafb = $this->dashboard->getSemesterActive();
 goto L_db7e2;
 }
 public function raporkkm()
 {
 goto L_4cb81;
 L_f9ffb:
 $_0xca82["\x73\155\x74\137\x61\143\x74\151\x76\145"] = $_0x4d43;
 goto L_56440;
 L_cfdbf:
 $_0xe1a2 = [];
 goto L_058ba;
 L_ea514:
 $_0xca82["\x67\165\x72\165"] = $_0xb469;
 goto L_c3851;
 L_4cb81:
 $_0xaa61 = (object) ["\x69\144" => session()->get("\x69\144\x5f\165\x73\145\x72"), "\x75\163\x65\162\x6e\141\x6d\145" => session()->get("\x75\163\x65\162\x6e\141\x6d\145")];
 goto L_7da44;
 L_22486:
 $_0xca82["\x6b\145\x6c\141\x73"] = $_0xd4a5;
 goto L_3ed8c;
 L_56440:
 $_0xb469 = $this->dashboard->getDataGuruByUsername($_0xaa61->username, $_0xdb4e->id_tp, $_0x4d43->id_smt);
 goto L_74bb4;
 L_7da44:
 $_0xca82 = ["\x75\163\x65\162" => $_0xaa61, "\x6a\165\x64\165\x6c" => "\x4b\113\x4d\40\x64\141\x6e\40\x42\157\x62\157\x74", "\x73\165\x62\152\x75\144\x75\154" => "\x49\156\x70\165\x74\40\x4b\113\x4d\40\x64\141\x6e\40\x42\157\x62\157\x74\40\x4e\151\x6c\141\x69", "\x73\145\x74\164\x69\156\x67" => $this->dashboard->getSetting()];
 goto L_903a1;
 L_50f6e:
 return view("\x6d\145\x6d\142\x65\162\x73\57\x67\165\x72\165\x2f\162\x61\160\x6f\162\x2f\153\x6b\155\x2f\144\x61\164\x61", $_0xca82);
 L_d71ff:
 if ($_0xcc68 != null) {
 foreach ($_0xcc68 as $_0x7b6a) {
 $_0xe1a2[$_0x7b6a->id_mapel] = $_0x7b6a->nama_mapel;
 foreach ($_0x7b6a->kelas_mapel as $_0xfcd2) {
 $_0x2fac = array_search($_0xfcd2->kelas, array_column($_0x3ec1, "\x69\144\x5f\153\x65\154\x61\163"));
 if ($_0x2fac !== false) {
 $_0xd4a5[$_0x7b6a->id_mapel][] = ["\x69\144\x5f\153\x65\154\x61\163" => $_0xfcd2->kelas, "\x6e\141\x6d\141\x5f\153\x65\154\x61\163" => $_0x3ec1[$_0x2fac]->nama_kelas];
 }
 }
 }
 }
 goto L_ea514;
 L_c3851:
 $_0xca82["\x6d\141\x70\145\x6c"] = $_0xe1a2;
 goto L_22486;
 L_80494:
 $_0x4d43 = $this->dashboard->getSemesterActive();
 goto L_c793a;
 L_c793a:
 $_0xca82["\x74\160"] = $this->dashboard->getTahun();
 goto L_09edb;
 L_058ba:
 $_0xd4a5 = [];
 goto L_47d77;
 L_903a1:
 $_0xdb4e = $this->dashboard->getTahunActive();
 goto L_80494;
 L_3ed8c:
 $_0xca82["\x65\153\x73\164\x72\141"] = [];
 goto L_50f6e;
 L_74bb4:
 $_0x5a38 = $this->kelas->getGuruMapelKelas($_0xb469->id_guru ?? 0, $_0xdb4e->id_tp, $_0x4d43->id_smt);
 goto L_d7378;
 L_d7378:
 $_0xcc68 = $_0x5a38 && isset($_0x5a38->mapel_kelas) ? $this->maybe_unserialize($_0x5a38->mapel_kelas) : [];
 goto L_cfdbf;
 L_09edb:
 $_0xca82["\x74\160\x5f\141\x63\164\x69\166\x65"] = $_0xdb4e;
 goto L_0e05f;
 L_0e05f:
 $_0xca82["\x73\155\x74"] = $this->dashboard->getSemester();
 goto L_f9ffb;
 L_47d77:
 $_0x3ec1 = $this->kelas->getKelasList($_0xdb4e->id_tp, $_0x4d43->id_smt);
 goto L_d71ff;
 }
 public function raporkikd()
 {
 goto L_51a3d;
 L_5a461:
 $_0x66d0["\x73\155\x74"] = $this->dashboard->getSemester();
 goto L_96257;
 L_829ee:
 $_0x66d0["\x74\160"] = $this->dashboard->getTahun();
 goto L_98857;
 L_330a1:
 $_0xe843 = $this->dashboard->getDataGuruByUsername($_0x1845->username, $_0xf063->id_tp, $_0x76c3->id_smt);
 goto L_54e66;
 L_8e47c:
 $_0xda22 = [];
 goto L_dcab5;
 L_5979d:
 $_0x66d0["\x6b\145\x6c\141\x73"] = $_0xf8e5;
 goto L_bed23;
 L_bed23:
 return view("\x6d\145\x6d\142\x65\162\x73\57\x67\165\x72\165\x2f\162\x61\160\x6f\162\x2f\153\x69\153\x64\57\x64\141\x74\141", $_0x66d0);
 L_d6f3b:
 $_0x66d0 = ["\x75\163\x65\162" => $_0x1845, "\x6a\165\x64\165\x6c" => "\x49\156\x64\151\x6b\141\x74\157\x72\40\x4b\104", "\x73\165\x62\152\x75\144\x75\154" => "\x52\151\x6e\147\x6b\141\x73\141\x6e\40\x4d\141\x74\145\x72\151\x20\120\x65\156\x69\154\x61\151\x61\156", "\x73\145\x74\164\x69\156\x67" => $this->dashboard->getSetting()];
 goto L_1b558;
 L_98857:
 $_0x66d0["\x74\160\x5f\141\x63\164\x69\166\x65"] = $_0xf063;
 goto L_5a461;
 L_54e66:
 $_0x96ad = $this->kelas->getGuruMapelKelas($_0xe843->id_guru ?? 0, $_0xf063->id_tp, $_0x76c3->id_smt);
 goto L_5af48;
 L_a3d75:
 $_0x66d0["\x6d\141\x70\145\x6c"] = $_0xda22;
 goto L_5979d;
 L_09971:
 $_0x15ec = $this->kelas->getKelasList($_0xf063->id_tp, $_0x76c3->id_smt);
 goto L_5aaed;
 L_ce98f:
 $_0x76c3 = $this->dashboard->getSemesterActive();
 goto L_829ee;
 L_51a3d:
 $_0x1845 = (object) ["\x69\144" => session()->get("\x69\144\x5f\165\x73\145\x72"), "\x75\163\x65\162\x6e\141\x6d\145" => session()->get("\x75\163\x65\162\x6e\141\x6d\145")];
 goto L_d6f3b;
 L_5aaed:
 if ($_0x99f4 != null) {
 foreach ($_0x99f4 as $_0x3936) {
 $_0xda22[$_0x3936->id_mapel] = $_0x3936->nama_mapel;
 foreach ($_0x3936->kelas_mapel as $_0x5080) {
 $_0x6df0 = array_search($_0x5080->kelas, array_column($_0x15ec, "\x69\144\x5f\153\x65\154\x61\163"));
 if ($_0x6df0 !== false) {
 $_0xf8e5[$_0x3936->id_mapel][] = ["\x69\144\x5f\153\x65\154\x61\163" => $_0x5080->kelas, "\x6e\141\x6d\141\x5f\153\x65\154\x61\163" => $_0x15ec[$_0x6df0]->nama_kelas];
 }
 }
 }
 }
 goto L_42eb5;
 L_5af48:
 $_0x99f4 = $_0x96ad && isset($_0x96ad->mapel_kelas) ? $this->maybe_unserialize($_0x96ad->mapel_kelas) : [];
 goto L_8e47c;
 L_1b558:
 $_0xf063 = $this->dashboard->getTahunActive();
 goto L_ce98f;
 L_42eb5:
 $_0x66d0["\x67\165\x72\165"] = $_0xe843;
 goto L_a3d75;
 L_96257:
 $_0x66d0["\x73\155\x74\137\x61\143\x74\151\x76\145"] = $_0x76c3;
 goto L_330a1;
 L_dcab5:
 $_0xf8e5 = [];
 goto L_09971;
 }
 public function datakikd($_0x603a, $_0x4590)
 {
 goto L_7a642;
 L_cc41a:
 return $this->output_json($_0xfa1b);
 L_1f222:
 $_0x2742 = [];
 goto L_02f6a;
 L_1c509:
 $_0xfa1b["\x6b\145\x6c\141\x73"] = $_0x4590;
 goto L_a5ea2;
 L_7834d:
 $_0xfa1b["\x6d\141\x70\145\x6c"] = $_0x603a;
 goto L_1c509;
 L_9147a:
 $_0xf6d1 = $this->dashboard->getSemesterActive();
 goto L_00743;
 L_a5ea2:
 $_0xfa1b["\x6b\151\x6b\144"] = $_0x2742;
 goto L_cc41a;
 L_00743:
 $_0x5e63 = $this->rapor->getKikdMapelKelas($_0x603a, $_0x4590, $_0x9ad5->id_tp, $_0xf6d1->id_smt);
 goto L_1f222;
 L_02f6a:
 if ($_0x4590 != null) {
 $_0x4492 = ["\x31", "\x32"];
 foreach ($_0x4492 as $_0x8686) {
 for ($_0xdfc2 = 0; $_0xdfc2 < 8; $_0xdfc2++) {
 $_0x4cca = $_0xdfc2 + 1;
 $_0xdd1b = array_search($_0x603a . $_0x4590 . $_0x8686 . $_0x4cca, array_column($_0x5e63, "\x69\144\x5f\153\x69\153\x64"));
 if ($_0xdd1b !== false) {
 $_0x2742[$_0x8686][$_0x603a . $_0x4590 . $_0x8686 . $_0x4cca] = $_0x5e63[$_0xdd1b];
 } else {
 $_0x2742[$_0x8686][$_0x603a . $_0x4590 . $_0x8686 . $_0x4cca] = ["\x6d\141\x74\145\x72\151\x5f\153\x69\153\x64" => ''];
 }
 }
 }
 }
 goto L_7834d;
 L_7a642:
 $_0x9ad5 = $this->dashboard->getTahunActive();
 goto L_9147a;
 }
 public function saveKikd()
 {
 goto L_d572b;
 L_d572b:
 $_0x3da5 = $this->request->getPost("\x6d\141\x74\145\x72\151");
 goto L_4e38a;
 L_5c40e:
 $_0x64e1 = $this->dashboard->getSemesterActive();
 goto L_d0243;
 L_7b4f4:
 //$inputs = [];
 foreach ((array) $_0x3da5 as $_0xdaf6 => $_0xf49c) {
 foreach ($_0xf49c as $_0xb2d8 => $_0x2e3d) {
 foreach ($_0x2e3d as $_0xdefe => $_0x73f5) {
 $_0x79f6 = ["\x69\144\x5f\153\x69\153\x64" => $_0xdefe, "\x69\144\x5f\155\x61\160\x65\154\x5f\153\x65\154\x61\163" => $_0xb2d8, "\x61\163\x70\145\x6b" => $_0xdaf6, "\x69\144\x5f\164\x70" => $_0xe99f->id_tp, "\x69\144\x5f\163\x6d\164" => $_0x64e1->id_smt, "\x6d\141\x74\145\x72\151\x5f\153\x69\153\x64" => $_0x73f5];
 //$inputs[] = $input;
 $_0x30db = $this->db->table("\x72\141\x70\157\x72\137\x6b\151\x6b\144")->replace($_0x79f6);
 }
 }
 }
 goto L_4ff6e;
 L_f971a:
 $_0x82bc["\x6a\163\x6f\156"] = $_0x3da5;
 L_d0243:
 $_0x30db = false;
 goto L_7b4f4;
 L_4e38a:
 $_0xe99f = $this->dashboard->getTahunActive();
 goto L_5c40e;
 L_4ff6e:
 $_0x82bc["\x73\164\x61\164\x75\163"] = $_0x30db;
 goto L_f971a;
 }
 public function getTpList($_0xf9d4, $_0xd2a5 = 0)
 {
 goto L_2b16c;
 L_b906f:
 $_0x8fea = $this->dashboard->getSemesterActive();
 goto L_2e1bc;
 L_2e1bc:
 $_0x32f4 = $this->raporKurmer->getListTp($_0xf9d4, $_0xe0fc->id_tp, $_0x8fea->id_smt, $_0xd2a5 > 0 ? $_0xd2a5 : null);
 goto L_51aba;
 L_2b16c:
 $_0xe0fc = $this->dashboard->getTahunActive();
 goto L_b906f;
 L_51aba:
 return $this->output_json($_0x32f4);
 }
 public function saveTp()
 {
 goto L_58dfa;
 L_5ca69:
 $_0x5982 = $this->dashboard->getSemesterActive();
 goto L_ccdef;
 L_4cdd3:
 $_0xa0d5 = $this->dashboard->getDataGuruByUsername($_0xcf0c->username, $_0xe791->id_tp, $_0x5982->id_smt);
 goto L_a8680;
 L_49b68:
 return $this->output_json(["\x73\164\x61\164\x75\163" => (bool) $_0x40ae]);
 L_a8680:
 $_0xf99f = ["\x69\144\x5f\164\x70\137\x6d\141\x70\145\x6c" => $this->request->getPost("\x69\144\x5f\164\x70\137\x6d\141\x70\145\x6c") ?: null, "\x69\144\x5f\164\x70" => $_0xe791->id_tp, "\x69\144\x5f\163\x6d\164" => $_0x5982->id_smt, "\x69\144\x5f\155\x61\160\x65\154" => $this->request->getPost("\x69\144\x5f\155\x61\160\x65\154"), "\x69\144\x5f\153\x65\154\x61\163" => $this->request->getPost("\x69\144\x5f\153\x65\154\x61\163") ?: null, "\x69\144\x5f\147\x75\162\x75" => $_0xa0d5->id_guru ?? null, "\x6b\157\x64\145\x5f\164\x70" => $this->request->getPost("\x6b\157\x64\145\x5f\164\x70"), "\x6c\151\x6e\147\x6b\165\x70\137\x6d\141\x74\145\x72\151" => $this->request->getPost("\x6c\151\x6e\147\x6b\165\x70\137\x6d\141\x74\145\x72\151"), "\x74\165\x6a\165\x61\156\x5f\160\x65\155\x62\145\x6c\141\x6a\141\x72\141\x6e" => $this->request->getPost("\x74\165\x6a\165\x61\156\x5f\160\x65\155\x62\145\x6c\141\x6a\141\x72\141\x6e"), "\x69\163\x5f\141\x63\164\x69\166\x65" => 1];
 goto L_0a792;
 L_ccdef:
 $_0xcf0c = (object) ["\x69\144" => session()->get("\x69\144\x5f\165\x73\145\x72"), "\x75\163\x65\162\x6e\141\x6d\145" => session()->get("\x75\163\x65\162\x6e\141\x6d\145")];
 goto L_4cdd3;
 L_0a792:
 $_0x40ae = $this->raporKurmer->saveTp($_0xf99f);
 goto L_49b68;
 L_58dfa:
 $_0xe791 = $this->dashboard->getTahunActive();
 goto L_5ca69;
 }
 public function deleteTp($_0xb308)
 {
 $_0xd0ea = $this->raporKurmer->deleteTp($_0xb308);
 return $this->output_json(["\x73\164\x61\164\x75\163" => (bool) $_0xd0ea]);
 }
 public function getKktp($_0xe9b4, $_0xb0bc = 0)
 {
 goto L_bf2f6;
 L_bf2f6:
 $_0x60ee = $this->dashboard->getTahunActive();
 goto L_50976;
 L_50976:
 $_0x379e = $this->dashboard->getSemesterActive();
 goto L_fa69a;
 L_fa69a:
 $_0x51fe = $this->raporKurmer->getKktp($_0xe9b4, $_0x60ee->id_tp, $_0x379e->id_smt, $_0xb0bc > 0 ? $_0xb0bc : null);
 goto L_fbff0;
 L_fbff0:
 return $this->output_json($_0x51fe);
 }
 public function saveKktp()
 {
 goto L_97a63;
 L_14bf9:
 $_0xc0bc = $this->raporKurmer->saveKktp($_0x9783);
 goto L_731a1;
 L_7620c:
 $_0x30f3 = $this->dashboard->getSemesterActive();
 goto L_7ef84;
 L_97a63:
 $_0x803b = $this->dashboard->getTahunActive();
 goto L_7620c;
 L_731a1:
 return $this->output_json(["\x73\164\x61\164\x75\163" => (bool) $_0xc0bc]);
 L_7ef84:
 $_0x9783 = ["\x69\144\x5f\164\x70" => $_0x803b->id_tp, "\x69\144\x5f\163\x6d\164" => $_0x30f3->id_smt, "\x69\144\x5f\155\x61\160\x65\154" => $this->request->getPost("\x69\144\x5f\155\x61\160\x65\154"), "\x69\144\x5f\153\x65\154\x61\163" => $this->request->getPost("\x69\144\x5f\153\x65\154\x61\163") ?: null, "\x6b\153\x6d" => $this->request->getPost("\x6b\153\x6d") ?? 75];
 goto L_14bf9;
 }
 public function raporNilai($_0xd76e = null)
 {
 goto L_b6b97;
 L_2f06b:
 $_0x5ede = $_0x1b9f->get("\x72\157\x6c\145") == "\x31" || strtolower($_0x1b9f->get("\x72\157\x6c\145\x5f\156\x61\155\x65") ?? '') === "\x61\144\x6d\151\x6e\151\x73\164\x72\141\x74\157\x72";
 goto L_01b18;
 L_431fe:
 $_0xbbc3["\x65\153\x73\164\x72\141"] = [];
 goto L_b2428;
 L_ae3c7:
 $_0xbbc3["\x6c\145\x76\145\x6c\163"] = array_unique($_0xa5eb);
 goto L_431fe;
 L_4e1ce:
 if (!empty($_0xc5f4)) {
 foreach ($_0xc5f4 as $_0xaa84) {
 $_0xd3d2[$_0xaa84->id_mapel] = $_0xaa84->nama_mapel;
 if (!empty($_0xaa84->kelas_mapel)) {
 foreach ($_0xaa84->kelas_mapel as $_0x3693) {
 $_0x6d06 = $this->kelas->get_one($_0x3693->kelas);
 if ($_0x6d06 != null) {
 $_0xa5eb[] = $_0x6d06->level_id;
 $_0xa82c[$_0xaa84->id_mapel][] = ["\x69\144\x5f\153\x65\154\x61\163" => $_0x6d06->id_kelas, "\x6c\145\x76\145\x6c" => $_0x6d06->level_id, "\x6e\141\x6d\141\x5f\153\x65\154\x61\163" => $_0x6d06->nama_kelas];
 $_0x1c8b[$_0xaa84->id_mapel][$_0x6d06->nama_kelas] = count($this->kelas->getKelasSiswa($_0x6d06->id_kelas, $_0xcbd1->id_tp, $_0x72af->id_smt));
 $_0x822f[$_0xaa84->id_mapel][$_0x6d06->nama_kelas] = $this->rapor->cekNilaiHarianKelas($_0xaa84->id_mapel, $_0x6d06->id_kelas, $_0xcbd1->id_tp, $_0x72af->id_smt);
 $_0x3cdd[$_0xaa84->id_mapel][$_0x6d06->nama_kelas] = $this->rapor->cekNilaiPtsKelas($_0xaa84->id_mapel, $_0x6d06->id_kelas, $_0xcbd1->id_tp, $_0x72af->id_smt);
 $_0x18c1[$_0xaa84->id_mapel][$_0x6d06->nama_kelas] = $this->rapor->cekNilaiAkhirKelas($_0xaa84->id_mapel, $_0x6d06->id_kelas, $_0xcbd1->id_tp, $_0x72af->id_smt);
 }
 }
 }
 }
 }
 goto L_42981;
 L_01b18:
 // Jika login sebagai Admin dan belum memiliki penugasan guru pengampu spesifik,
 // buka akses ke semua mapel aktif rapor dan semua kelas
 if ($_0x5ede && empty($_0xc5f4)) {
 $_0x9d36 = $this->raporKurmer->getSetting($_0xcbd1->id_tp, $_0x72af->id_smt);
 $_0x541f = !empty($_0x9d36->mapel_rapor) ? is_array($_0x9d36->mapel_rapor) ? $_0x9d36->mapel_rapor : json_decode($_0x9d36->mapel_rapor, true) : [];
 $_0x6d4c = $_0x541f["\x61\143\x74\151\x76\145\x5f\155\x61\160\x65\154\x73"] ?? [];
 $_0x3ca7 = $this->db->table("\x6d\141\x73\164\x65\162\x5f\155\x61\160\x65\154")->where("\x73\164\x61\164\x75\163", "\x31")->where("\x6a\145\x6e\152\x61\156\x67\40\x21\75", 3);
 if (!empty($_0x6d4c)) {
 $_0x3ca7->whereIn("\x69\144\x5f\155\x61\160\x65\154", $_0x6d4c);
 }
 $_0x875f = $_0x3ca7->orderBy("\x75\162\x75\164\x61\156\x5f\164\x61\155\x70\151\x6c", "\x41\123\x43")->get()->getResult();
 $_0x46b1 = $this->kelas->getKelasList($_0xcbd1->id_tp, $_0x72af->id_smt);
 foreach ($_0x875f as $_0xd6f2) {
 $_0xd3d2[$_0xd6f2->id_mapel] = $_0xd6f2->nama_mapel;
 foreach ($_0x46b1 as $_0x544b) {
 $_0xa5eb[] = $_0x544b->level_id;
 $_0xa82c[$_0xd6f2->id_mapel][] = ["\x69\144\x5f\153\x65\154\x61\163" => $_0x544b->id_kelas, "\x6c\145\x76\145\x6c" => $_0x544b->level_id, "\x6e\141\x6d\141\x5f\153\x65\154\x61\163" => $_0x544b->nama_kelas];
 $_0x1c8b[$_0xd6f2->id_mapel][$_0x544b->nama_kelas] = count($this->kelas->getKelasSiswa($_0x544b->id_kelas, $_0xcbd1->id_tp, $_0x72af->id_smt));
 $_0x822f[$_0xd6f2->id_mapel][$_0x544b->nama_kelas] = $this->rapor->cekNilaiHarianKelas($_0xd6f2->id_mapel, $_0x544b->id_kelas, $_0xcbd1->id_tp, $_0x72af->id_smt);
 $_0x3cdd[$_0xd6f2->id_mapel][$_0x544b->nama_kelas] = $this->rapor->cekNilaiPtsKelas($_0xd6f2->id_mapel, $_0x544b->id_kelas, $_0xcbd1->id_tp, $_0x72af->id_smt);
 $_0x18c1[$_0xd6f2->id_mapel][$_0x544b->nama_kelas] = $this->rapor->cekNilaiAkhirKelas($_0xd6f2->id_mapel, $_0x544b->id_kelas, $_0xcbd1->id_tp, $_0x72af->id_smt);
 }
 }
 }
 goto L_b77ba;
 L_02ba5:
 $_0x18c1 = [];
 goto L_4e1ce;
 L_d5e2c:
 $_0xbbc3["\x74\160\x5f\141\x63\164\x69\166\x65"] = $_0xcbd1;
 goto L_2a321;
 L_ca41d:
 $_0x65ff = $_0x2dda ? $this->kelas->getGuruMapelKelas($_0x2dda->id_guru ?? 0, $_0xcbd1->id_tp, $_0x72af->id_smt) : null;
 goto L_8aca0;
 L_63325:
 $_0xe518 = "\x50\151\x6c\151\x68\40\x4d\141\x74\141\x20\120\x65\154\x61\152\x61\162\x61\156\x20\144\x61\156\x20\113\x65\154\x61\163";
 goto L_d7c2f;
 L_82759:
 $_0xf1b9 = $_0x9d36->mode_rapor ?? "\x73\145\x6d\165\x61";
 goto L_aff21;
 L_b77ba:
 $_0xbbc3["\x67\165\x72\165"] = $_0x2dda;
 goto L_e0439;
 L_c8092:
 $_0xbbc3 = ["\x75\163\x65\162" => $_0xa2d6, "\x6a\165\x64\165\x6c" => $_0xe1c8, "\x73\165\x62\152\x75\144\x75\154" => $_0xe518, "\x73\145\x74\164\x69\156\x67" => $this->dashboard->getSetting(), "\x72\141\x70\157\x72\137\x73\145\x74\164\x69\156\x67" => $_0x9d36, "\x73\145\x74\164\x69\156\x67\137\x6d\157\x64\145" => $_0xf1b9, "\x63\165\x72\162\x65\156\x74\137\x6d\157\x64\145" => $_0x8499];
 goto L_9a7ce;
 L_7c7bb:
 $_0xbbc3["\x70\141\x73"] = $_0x18c1;
 goto L_93f5f;
 L_9a7ce:
 $_0xbbc3["\x74\160"] = $this->dashboard->getTahun();
 goto L_d5e2c;
 L_7671e:
 $_0x822f = [];
 goto L_b2383;
 L_2c4ee:
 $_0xbbc3["\x73\155\x74\137\x61\143\x74\151\x76\145"] = $_0x72af;
 goto L_74c3c;
 L_b827d:
 $_0x72af = $this->dashboard->getSemesterActive();
 goto L_dfe3e;
 L_bbf0b:
 $_0xbbc3["\x6d\141\x70\145\x6c"] = $_0xd3d2;
 goto L_57282;
 L_b2428:
 $_0xbbc3["\x73\151\x73\167\x61\163"] = $_0x1c8b;
 goto L_04363;
 L_74c3c:
 $_0x2dda = $this->dashboard->getDataGuruByUsername($_0xa2d6->username, $_0xcbd1->id_tp, $_0x72af->id_smt);
 goto L_ca41d;
 L_ae9b4:
 $_0xe1c8 = "\x49\156\x70\165\x74\40\x4e\151\x6c\141\x69\40\x52\141\x70\157\x72";
 goto L_63325;
 L_aff21:
 $_0x8499 = $_0xd76e ? strtolower($_0xd76e) : ($_0xf1b9 !== "\x73\145\x6d\165\x61" ? $_0xf1b9 : "\x73\145\x6d\165\x61");
 goto L_ae9b4;
 L_e0439:
 $_0xbbc3["\x6d\141\x70\145\x6c\163"] = $_0xc5f4;
 goto L_bbf0b;
 L_bd139:
 $_0xbbc3["\x6c\145\x76\145\x6c"] = array_unique($_0xa5eb);
 goto L_ae3c7;
 L_57282:
 $_0xbbc3["\x6b\145\x6c\141\x73"] = $_0xa82c;
 goto L_e1d6b;
 L_b9baa:
 $_0x1c8b = [];
 goto L_4c766;
 L_4c766:
 $_0xd3d2 = [];
 goto L_f58a1;
 L_42981:
 $_0x1b9f = session();
 goto L_2f06b;
 L_e1d6b:
 $_0xbbc3["\x6b\145\x6c\141\x73\137\x6d\141\x70\145\x6c"] = $_0xa82c;
 goto L_bd139;
 L_d7c2f:
 if ($_0x8499 === "\x70\164\x73") {
 $_0xe1c8 = "\x49\156\x70\165\x74\40\x4e\151\x6c\141\x69\40\x50\124\x53\40\x28\124\x65\156\x67\141\x68\40\x53\145\x6d\145\x73\164\x65\162\x29";
 $_0xe518 = "\x50\145\x6e\151\x6c\141\x69\141\x6e\40\x53\165\x6d\141\x74\151\x66\40\x54\145\x6e\147\x61\150\x20\123\x65\155\x65\163\x74\145\x72";
 } elseif ($_0x8499 === "\x73\141\x73") {
 $_0xe1c8 = "\x49\156\x70\165\x74\40\x4e\151\x6c\141\x69\40\x53\101\x53\40\x28\101\x6b\150\x69\162\x20\123\x65\155\x65\163\x74\145\x72\51";
 $_0xe518 = "\x50\145\x6e\151\x6c\141\x69\141\x6e\40\x53\165\x6d\141\x74\151\x66\40\x41\153\x68\151\x72\40\x53\145\x6d\145\x73\164\x65\162\x20\46\x20\103\x61\160\x61\151\x61\156\x20\113\x6f\155\x70\145\x74\145\x6e\163\x69";
 }
 goto L_c8092;
 L_93f5f:
 return view("\x6d\145\x6d\142\x65\162\x73\57\x67\165\x72\165\x2f\162\x61\160\x6f\162\x2f\156\x69\154\x61\151\x2f\144\x61\164\x61", $_0xbbc3);
 L_f58a1:
 $_0xa82c = [];
 goto L_571d9;
 L_b2383:
 $_0x3cdd = [];
 goto L_02ba5;
 L_04363:
 $_0xbbc3["\x68\141\x72\151\x61\156"] = $_0x822f;
 goto L_116d8;
 L_571d9:
 $_0xa5eb = [];
 goto L_7671e;
 L_116d8:
 $_0xbbc3["\x70\164\x73"] = $_0x3cdd;
 goto L_7c7bb;
 L_b6b97:
 $_0xa2d6 = (object) ["\x69\144" => session()->get("\x69\144\x5f\165\x73\145\x72"), "\x75\163\x65\162\x6e\141\x6d\145" => session()->get("\x75\163\x65\162\x6e\141\x6d\145")];
 goto L_52641;
 L_52641:
 $_0xcbd1 = $this->dashboard->getTahunActive();
 goto L_b827d;
 L_2a321:
 $_0xbbc3["\x73\155\x74"] = $this->dashboard->getSemester();
 goto L_2c4ee;
 L_8aca0:
 $_0xc5f4 = $_0x65ff && $_0x65ff->mapel_kelas != null ? $this->maybe_unserialize($_0x65ff->mapel_kelas ?? "\x5b\135") : [];
 goto L_b9baa;
 L_dfe3e:
 $_0x9d36 = $this->raporKurmer->getSetting($_0xcbd1->id_tp, $_0x72af->id_smt);
 goto L_82759;
 }
 public function statusNilai($_0x54e5 = null)
 {
 goto L_d1555;
 L_ac00f:
 // Tampilkan juga mapel umum lain jika ada nilai yang tercatat
 $_0xe360 = $this->master->getAllMapel();
 goto L_47573;
 L_2a530:
 $_0xd3d8 = $_0x54e5 ? $this->kelas->getKelasSiswa($_0x54e5, $_0xede1->id_tp, $_0xba91->id_smt) : [];
 goto L_8565e;
 L_0ef14:
 $_0x98d9 = [];
 goto L_f2605;
 L_47573:
 if (!empty($_0xe360)) {
 foreach ($_0xe360 as $_0x849d) {
 if (!in_array($_0x849d->id_mapel, $_0x98d9)) {
 $_0x2502 = $this->db->table("\x72\141\x70\157\x72\137\x6b\165\x72\155\x65\162\x5f\156\x69\154\x61\151")->where("\x69\144\x5f\164\x70", $_0xede1->id_tp)->where("\x69\144\x5f\163\x6d\164", $_0xba91->id_smt)->where("\x69\144\x5f\153\x65\154\x61\163", $_0x54e5)->where("\x69\144\x5f\155\x61\160\x65\154", $_0x849d->id_mapel)->groupStart()->where("\x6e\151\x6c\141\x69\137\x61\153\x68\151\x72\40\x49\123\x20\116\x4f\124\x20\116\x55\114\x4c")->orWhere("\x72\141\x74\141\x5f\163\x75\155\x61\164\x69\146\x20\111\x53\40\x4e\117\x54\40\x4e\125\x4c\114")->orWhere("\x6e\151\x6c\141\x69\137\x73\164\x73\40\x49\123\x20\116\x4f\124\x20\116\x55\114\x4c")->groupEnd()->countAllResults();
 if ($_0x2502 > 0) {
 $_0x50af = $_0x84ba > 0 ? round($_0x2502 / $_0x84ba * 100) : 0;
 $_0xc507 = $_0x84ba > 0 && $_0x2502 >= $_0x84ba;
 $_0xc161[] = ["\x69\144\x5f\155\x61\160\x65\154" => $_0x849d->id_mapel, "\x6e\141\x6d\141\x5f\155\x61\160\x65\154" => $_0x849d->nama_mapel, "\x6e\141\x6d\141\x5f\147\x75\162\x75" => "\x2d", "\x74\145\x72\151\x73\151" => $_0x2502, "\x74\157\x74\141\x6c\137\x73\151\x73\167\x61" => $_0x84ba, "\x70\145\x72\163\x65\156" => $_0x50af, "\x69\163\x5f\163\x65\154\x65\163\x61\151" => $_0xc507];
 }
 }
 }
 }
 goto L_78e0e;
 L_087ed:
 $_0x9674 = $_0xb356 > 0 ? round($_0xe432 / $_0xb356 * 100) : 0;
 goto L_cb479;
 L_06ac0:
 $_0xede1 = $this->dashboard->getTahunActive();
 goto L_6e757;
 L_2bdd3:
 if (!$_0x54e5) {
 list($_0x86e5, $_0x54e5) = $this->resolveWaliKelasId($_0x5f03->username, $_0xede1->id_tp, $_0xba91->id_smt);
 } else {
 $_0x86e5 = $this->dashboard->getDataGuruByUsername($_0x5f03->username, $_0xede1->id_tp, $_0xba91->id_smt);
 }
 goto L_4096b;
 L_c3b3a:
 // Pastikan SEMUA mapel yang aktif untuk rapor kelas ini (termasuk mapel manual / ujian kertas seperti Aqidatul Awwam)
 // selalu tampil di daftar status nilai agar guru / admin dapat langsung mengisi nilai manualnya
 $_0xadb8 = $this->raporKurmer->getMapelRaporKelas($_0x54e5, $_0xede1->id_tp, $_0xba91->id_smt);
 goto L_bb5c7;
 L_28688:
 $_0xe432 = count(array_filter($_0xc161, fn($_0x6f5e) => $_0x6f5e["\x69\163\x5f\163\x65\154\x65\163\x61\151"]));
 goto L_087ed;
 L_8b1be:
 $_0xa336 = $this->master->getGuruMapel($_0xede1->id_tp, $_0xba91->id_smt);
 goto L_992b8;
 L_4096b:
 $_0x6d9c = $this->kelas->getKelasList($_0xede1->id_tp, $_0xba91->id_smt);
 goto L_d8880;
 L_d1555:
 $_0x5f03 = (object) ["\x69\144" => session()->get("\x69\144\x5f\165\x73\145\x72"), "\x75\163\x65\162\x6e\141\x6d\145" => session()->get("\x75\163\x65\162\x6e\141\x6d\145")];
 goto L_06ac0;
 L_78e0e:
 $_0xb356 = count($_0xc161);
 goto L_28688;
 L_8565e:
 $_0x84ba = count($_0xd3d8);
 goto L_8b1be;
 L_e9212:
 return view("\x6d\145\x6d\142\x65\162\x73\57\x67\165\x72\165\x2f\162\x61\160\x6f\162\x2f\163\x74\141\x74\165\x73\137\x6e\151\x6c\141\x69", $_0xc6b4);
 L_992b8:
 $_0xc161 = [];
 goto L_0ef14;
 L_f2605:
 foreach ($_0xa336 as $_0xbe06) {
 $_0xec3e = !empty($_0xbe06->mapel_kelas) ? is_array($_0xbe06->mapel_kelas) ? $_0xbe06->mapel_kelas : $this->maybe_unserialize($_0xbe06->mapel_kelas) : [];
 if (!empty($_0xec3e)) {
 foreach ($_0xec3e as $_0xd7f3) {
 if (!empty($_0xd7f3->kelas_mapel)) {
 foreach ($_0xd7f3->kelas_mapel as $_0x5b29) {
 if ($_0x5b29->kelas == $_0x54e5) {
 $_0xd778 = $_0xd7f3->id_mapel;
 $_0x98d9[] = $_0xd778;
 $_0x2502 = $this->db->table("\x72\141\x70\157\x72\137\x6b\165\x72\155\x65\162\x5f\156\x69\154\x61\151")->where("\x69\144\x5f\164\x70", $_0xede1->id_tp)->where("\x69\144\x5f\163\x6d\164", $_0xba91->id_smt)->where("\x69\144\x5f\153\x65\154\x61\163", $_0x54e5)->where("\x69\144\x5f\155\x61\160\x65\154", $_0xd778)->groupStart()->where("\x6e\151\x6c\141\x69\137\x61\153\x68\151\x72\40\x49\123\x20\116\x4f\124\x20\116\x55\114\x4c")->orWhere("\x72\141\x74\141\x5f\163\x75\155\x61\164\x69\146\x20\111\x53\40\x4e\117\x54\40\x4e\125\x4c\114")->orWhere("\x6e\151\x6c\141\x69\137\x73\164\x73\40\x49\123\x20\116\x4f\124\x20\116\x55\114\x4c")->groupEnd()->countAllResults();
 $_0x50af = $_0x84ba > 0 ? round($_0x2502 / $_0x84ba * 100) : 0;
 $_0xc507 = $_0x84ba > 0 && $_0x2502 >= $_0x84ba;
 $_0xc161[] = ["\x69\144\x5f\155\x61\160\x65\154" => $_0xd778, "\x6e\141\x6d\141\x5f\155\x61\160\x65\154" => $_0xd7f3->nama_mapel, "\x6e\141\x6d\141\x5f\147\x75\162\x75" => $_0xbe06->nama_guru, "\x74\145\x72\151\x73\151" => $_0x2502, "\x74\157\x74\141\x6c\137\x73\151\x73\167\x61" => $_0x84ba, "\x70\145\x72\163\x65\156" => $_0x50af, "\x69\163\x5f\163\x65\154\x65\163\x61\151" => $_0xc507];
 }
 }
 }
 }
 }
 }
 goto L_c3b3a;
 L_f58fc:
 if ($_0x9f3a && !$_0x54e5) {
 $_0x54e5 = $_0x9f3a->id_kelas;
 }
 goto L_2a530;
 L_6e757:
 $_0xba91 = $this->dashboard->getSemesterActive();
 goto L_2bdd3;
 L_cb479:
 $_0xc6b4 = ["\x75\163\x65\162" => $_0x5f03, "\x6a\165\x64\165\x6c" => "\x53\164\x61\164\x75\163\x20\116\x69\154\x61\151", "\x73\165\x62\152\x75\144\x75\154" => $_0x9f3a ? "\x4b\145\x6c\141\x73\40" . ($_0x9f3a->nama_kelas ?? "\x2d") : "\x53\164\x61\164\x75\163\x20\113\x65\164\x65\162\x69\163\x69\141\x6e\40\x4e\151\x6c\141\x69\40\x52\141\x70\157\x72", "\x73\145\x74\164\x69\156\x67" => $this->dashboard->getSetting(), "\x74\160" => $this->dashboard->getTahun(), "\x74\160\x5f\141\x63\164\x69\166\x65" => $_0xede1, "\x73\155\x74" => $this->dashboard->getSemester(), "\x73\155\x74\137\x61\143\x74\151\x76\145" => $_0xba91, "\x67\165\x72\165" => $_0x86e5, "\x6b\145\x6c\141\x73" => $_0x9f3a, "\x6b\145\x6c\141\x73\114\x69\163\x74" => $_0x6d9c, "\x6d\141\x70\145\x6c\123\x74\141\x74\165\x73" => $_0xc161, "\x74\157\x74\141\x6c\123\x69\163\x77\141" => $_0x84ba, "\x74\157\x74\141\x6c\115\x61\160\x65\154" => $_0xb356, "\x6d\141\x70\145\x6c\123\x65\154\x65\163\x61\151" => $_0xe432, "\x70\162\x6f\147\x72\145\x73\122\x61\160\x6f\162" => $_0x9674];
 goto L_e9212;
 L_bb5c7:
 if (!empty($_0xadb8)) {
 foreach ($_0xadb8 as $_0xef4f) {
 if (!in_array($_0xef4f->id_mapel, $_0x98d9)) {
 $_0x98d9[] = $_0xef4f->id_mapel;
 $_0x2502 = $this->db->table("\x72\141\x70\157\x72\137\x6b\165\x72\155\x65\162\x5f\156\x69\154\x61\151")->where("\x69\144\x5f\164\x70", $_0xede1->id_tp)->where("\x69\144\x5f\163\x6d\164", $_0xba91->id_smt)->where("\x69\144\x5f\153\x65\154\x61\163", $_0x54e5)->where("\x69\144\x5f\155\x61\160\x65\154", $_0xef4f->id_mapel)->groupStart()->where("\x6e\151\x6c\141\x69\137\x61\153\x68\151\x72\40\x49\123\x20\116\x4f\124\x20\116\x55\114\x4c")->orWhere("\x72\141\x74\141\x5f\163\x75\155\x61\164\x69\146\x20\111\x53\40\x4e\117\x54\40\x4e\125\x4c\114")->orWhere("\x6e\151\x6c\141\x69\137\x73\164\x73\40\x49\123\x20\116\x4f\124\x20\116\x55\114\x4c")->groupEnd()->countAllResults();
 $_0x50af = $_0x84ba > 0 ? round($_0x2502 / $_0x84ba * 100) : 0;
 $_0xc507 = $_0x84ba > 0 && $_0x2502 >= $_0x84ba;
 $_0xc161[] = ["\x69\144\x5f\155\x61\160\x65\154" => $_0xef4f->id_mapel, "\x6e\141\x6d\141\x5f\155\x61\160\x65\154" => $_0xef4f->nama_mapel, "\x6e\141\x6d\141\x5f\147\x75\162\x75" => "\x2d", "\x74\145\x72\151\x73\151" => $_0x2502, "\x74\157\x74\141\x6c\137\x73\151\x73\167\x61" => $_0x84ba, "\x70\145\x72\163\x65\156" => $_0x50af, "\x69\163\x5f\163\x65\154\x65\163\x61\151" => $_0xc507];
 }
 }
 }
 goto L_ac00f;
 L_d8880:
 $_0x9f3a = $_0x54e5 ? $this->kelas->get_one($_0x54e5) : (!empty($_0x6d9c) ? $_0x6d9c[0] : null);
 goto L_f58fc;
 }
 public function raporNilaiGuru($_0xc7a5 = null, $_0xcf44 = null)
 {
 return redirect()->to("\x72\141\x70\157\x72\57\x73\164\x61\164\x75\163\x6e\151\x6c\141\x69");
 }
 public function legacyRaporNilaiGuru($_0xe274 = null, $_0x214a = null)
 {
 goto L_e7a1d;
 L_10af8:
 $_0xa84f["\x6d\141\x70\145\x6c\137\x73\145\x6c\145\x63\164\x65\144"] = $_0x214a;
 goto L_4e99e;
 L_54f9e:
 return view("\x6d\145\x6d\142\x65\162\x73\57\x67\165\x72\165\x2f\162\x61\160\x6f\162\x2f\156\x69\154\x61\151\x2f\156\x69\154\x61\151\x67\165\x72\165", $_0xa84f);
 L_c8e90:
 $_0xf387 = $this->dropdown->getAllEkskul();
 goto L_19fd3;
 L_3278f:
 $_0x1866 = $this->dashboard->getDataGuruByUsername($_0x9edc->username, $_0x51f9->id_tp, $_0x689e->id_smt);
 goto L_674e0;
 L_d7646:
 $_0x689e = $this->dashboard->getSemesterActive();
 goto L_f70f3;
 L_349d0:
 $_0xa84f["\x73\155\x74\137\x61\143\x74\151\x76\145"] = $_0x689e;
 goto L_3278f;
 L_2890a:
 $_0xa84f = ["\x75\163\x65\162" => $_0x9edc, "\x6a\165\x64\165\x6c" => "\x53\145\x6d\165\x61\40\x4e\151\x6c\141\x69", "\x73\165\x62\152\x75\144\x75\154" => "\x53\145\x6d\165\x61\40\x4e\151\x6c\141\x69\40\x52\141\x70\157\x72", "\x73\145\x74\164\x69\156\x67" => $this->dashboard->getSetting()];
 goto L_0ad75;
 L_d37c8:
 $_0x79bf = $this->dropdown->getAllMapel();
 goto L_70e53;
 L_19fd3:
 $_0xa84f["\x65\153\x73\164\x72\141"] = $_0x5b6d + $_0xf387;
 goto L_a9a3a;
 L_e7a1d:
 $_0x9edc = (object) ["\x69\144" => session()->get("\x69\144\x5f\165\x73\145\x72"), "\x75\163\x65\162\x6e\141\x6d\145" => session()->get("\x75\163\x65\162\x6e\141\x6d\145")];
 goto L_2890a;
 L_70d64:
 $_0xd3bb = $this->master->getGuruMapel($_0x51f9->id_tp, $_0x689e->id_smt);
 goto L_9e551;
 L_0ad75:
 $_0x51f9 = $this->dashboard->getTahunActive();
 goto L_d7646;
 L_f70f3:
 $_0xa84f["\x74\160"] = $this->dashboard->getTahun();
 goto L_fa5dd;
 L_69aa3:
 $_0x5b6d[''] = "\x50\151\x6c\151\x68\40\x45\163\x6b\165\x6c";
 goto L_c8e90;
 L_4e99e:
 $_0xa84f["\x66\151\x6c\164\x65\162\x5f\163\x65\154\x65\143\x74\145\x64"] = $_0xe274;
 goto L_70d64;
 L_a96fa:
 if ($_0x214a != null) {
 $_0xbe8d = $this->rapor->getRaporSetting($_0x51f9->id_tp, $_0x689e->id_smt);
 if ($_0xbe8d) {
 if ($_0xbe8d->kkm_tunggal == "\x31") {
 $_0x8ebb = $_0xbe8d;
 $_0x7997 = $_0xbe8d;
 } else {
 $_0x8ebb = $this->rapor->getKkm($_0x214a . ($_0x1866->wali_kelas ?? $this->request->getGet("\x6b\145\x6c\141\x73") ?? null) . $_0x51f9->id_tp . $_0x689e->id_smt . "\x31");
 $_0x7997 = $this->rapor->getKkm($_0x214a . ($_0x1866->wali_kelas ?? $this->request->getGet("\x6b\145\x6c\141\x73") ?? null) . $_0x51f9->id_tp . $_0x689e->id_smt . "\x32");
 }
 }
 $_0xf07d = $this->kelas->getKelasSiswa($_0x1866->wali_kelas ?? $this->request->getGet("\x6b\145\x6c\141\x73") ?? null, $_0x51f9->id_tp, $_0x689e->id_smt);
 $_0xa66e = [];
 $_0x2581[] = [];
 if (($_0x1866->wali_kelas ?? $this->request->getGet("\x6b\145\x6c\141\x73") ?? null) != null) {
 $_0x323b = ["\x31", "\x32"];
 foreach ($_0x323b as $_0x89d7) {
 for ($_0x6819 = 0; $_0x6819 < 8; $_0x6819++) {
 $_0x3b4e = $_0x6819 + 1;
 $_0x2581[$_0x89d7][$_0x214a . ($_0x1866->wali_kelas ?? $this->request->getGet("\x6b\145\x6c\141\x73") ?? null) . $_0x89d7 . $_0x3b4e] = $this->rapor->getKikdMapel($_0x214a . ($_0x1866->wali_kelas ?? $this->request->getGet("\x6b\145\x6c\141\x73") ?? null) . $_0x89d7 . $_0x3b4e, $_0x51f9->id_tp, $_0x689e->id_smt);
 }
 }
 }
 if ($_0xe274 == "\x31") {
 $_0x1d82 = '';
 foreach ($_0xd3bb as $_0xd883) {
 foreach ($_0xd883->mapel_kelas as $_0xd63e) {
 if ($_0xd63e->id_mapel == $_0x214a) {
 foreach ($_0xd63e->kelas_mapel as $_0x162e) {
 if ($_0x162e->kelas == ($_0x1866->wali_kelas ?? $this->request->getGet("\x6b\145\x6c\141\x73") ?? null)) {
 $_0x1d82 = $_0xd883->nama_guru;
 }
 }
 }
 }
 }
 for ($_0x6819 = 0; $_0x6819 < count($_0xf07d); $_0x6819++) {
 $_0x5c0c = $_0xf07d[$_0x6819];
 $_0x455d = ["\x70\61" => '', "\x70\62" => '', "\x70\63" => '', "\x70\64" => '', "\x70\65" => '', "\x70\66" => '', "\x70\67" => '', "\x70\70" => '', "\x70\137\x72\141\x74\141\x5f\162\x61\164\x61" => '', "\x70\137\x70\162\x65\144\x69\153\x61\164" => "\x3d", "\x70\137\x64\145\x73\153\x72\151\x70\163\x69" => '', "\x6b\61" => '', "\x6b\62" => '', "\x6b\63" => '', "\x6b\64" => '', "\x6b\65" => '', "\x6b\66" => '', "\x6b\67" => '', "\x6b\70" => '', "\x6b\137\x72\141\x74\141\x5f\162\x61\164\x61" => '', "\x6b\137\x70\162\x65\144\x69\153\x61\164" => '', "\x6b\137\x64\145\x73\153\x72\151\x70\163\x69" => ''];
 $_0x98cc = $this->rapor->getNilaiHarianKelas($_0x214a, $_0x1866->wali_kelas ?? $this->request->getGet("\x6b\145\x6c\141\x73") ?? null, $_0x5c0c->id_siswa, $_0x51f9->id_tp, $_0x689e->id_smt);
 $_0xa66e[$_0x5c0c->id_siswa] = $_0x98cc == null ? json_decode(json_encode($_0x455d)) : $_0x98cc;
 }
 } else {
 $_0x1d82 = '';
 foreach ($_0xd3bb as $_0xd883) {
 foreach ($_0xd883->ekstra_kelas as $_0xd63e) {
 if ($_0xd63e->id_ekstra == $_0x214a) {
 foreach ($_0xd63e->kelas_ekstra as $_0x162e) {
 if ($_0x162e->kelas == ($_0x1866->wali_kelas ?? $this->request->getGet("\x6b\145\x6c\141\x73") ?? null)) {
 $_0x1d82 = $_0xd883->nama_guru;
 }
 }
 }
 }
 }
 $_0x21f0 = ["\x64\145\x73\153\x72\151\x70\163\x69" => '', "\x6e\151\x6c\141\x69" => '', "\x70\162\x65\144\x69\153\x61\164" => ''];
 for ($_0x6819 = 0; $_0x6819 < count($_0xf07d); $_0x6819++) {
 $_0x5c0c = $_0xf07d[$_0x6819];
 $_0xf1ec = $this->rapor->getEkstraKelas($_0x214a, $_0x5c0c->id_siswa, $_0x51f9->id_tp, $_0x689e->id_smt);
 $_0xa66e[$_0x5c0c->id_siswa] = $_0xf1ec == null ? json_decode(json_encode($_0x21f0)) : $_0xf1ec;
 }
 }
 $_0xa84f["\x73\151\x73\167\x61"] = $_0xf07d;
 $_0xa84f["\x6e\151\x6c\141\x69"] = $_0xa66e;
 $_0xa84f["\x6b\153\x6d"] = $_0x8ebb ?? null;
 $_0xa84f["\x6b\153\x6d\137\x65\153\x73\164\x72\141"] = $_0x7997 ?? null;
 //$data['guru_mapels'] = $jabatan_guru;
 $_0xa84f["\x67\165\x72\165\x5f\155\x61\160\x65\154"] = $_0x1d82;
 }
 goto L_54f9e;
 L_a9a3a:
 $_0xa84f["\x66\151\x6c\164\x65\162"] = ['' => "\x46\151\x6c\164\x65\162\x20\142\x65\162\x64\141\x73\141\x72\153\x61\156", "\x31" => "\x4d\141\x74\141\x20\120\x65\154\x61\152\x61\162\x61\156", "\x32" => "\x45\153\x73\164\x72\141\x6b\165\x72\151\x6b\165\x6c\145\x72"];
 goto L_f9b25;
 L_fa5dd:
 $_0xa84f["\x74\160\x5f\141\x63\164\x69\166\x65"] = $_0x51f9;
 goto L_aa0c2;
 L_70e53:
 $_0xa84f["\x6d\141\x70\145\x6c"] = $_0x5b6d + $_0x79bf;
 goto L_69aa3;
 L_aa0c2:
 $_0xa84f["\x73\155\x74"] = $this->dashboard->getSemester();
 goto L_349d0;
 L_674e0:
 $_0xa84f["\x67\165\x72\165"] = $_0x1866;
 goto L_32dbe;
 L_9e551:
 foreach ($_0xd3bb as $_0xce8b) {
 $_0xce8b->mapel_kelas = $_0xce8b->mapel_kelas == null ? [] : $this->maybe_unserialize($_0xce8b->mapel_kelas ?? "\x5b\135");
 $_0xce8b->ekstra_kelas = $_0xce8b->ekstra_kelas == null ? [] : $this->maybe_unserialize($_0xce8b->ekstra_kelas ?? "\x5b\135");
 }
 goto L_a96fa;
 L_f9b25:
 $_0xa84f["\x65\153\x73\164\x72\141\x5f\163\x65\154\x65\143\x74\145\x64"] = $_0x214a;
 goto L_10af8;
 L_32dbe:
 $_0x5b6d[''] = "\x50\151\x6c\151\x68\40\x4d\141\x70\145\x6c";
 goto L_d37c8;
 }
 public function raporCekNilai($_0x46f7 = null, $_0x6caa = null)
 {
 goto L_c78de;
 L_33d1d:
 $_0xcccc["\x6d\141\x70\145\x6c"] = $_0xf967 + $_0x2d44;
 goto L_c17dd;
 L_e6ec0:
 return view("\x6d\145\x6d\142\x65\162\x73\57\x67\165\x72\165\x2f\162\x61\160\x6f\162\x2f\156\x69\154\x61\151\x2f\160\x65\162\x69\153\x73\141", $_0xcccc);
 L_e9301:
 $_0x2d44 = $this->dropdown->getAllMapel();
 goto L_33d1d;
 L_c17dd:
 $_0xf967[''] = "\x50\151\x6c\151\x68\40\x45\163\x6b\165\x6c";
 goto L_bc82c;
 L_07671:
 $_0xf9f1 = $this->master->getGuruMapel($_0xf57a->id_tp, $_0x87fc->id_smt);
 goto L_2138f;
 L_dd35f:
 $_0x4189 = $this->kelas->getGuruMapelKelas($_0xe7a2->id_guru ?? 0, $_0xf57a->id_tp, $_0x87fc->id_smt);
 goto L_824b6;
 L_47fb8:
 $_0xe7a2 = $this->dashboard->getDataGuruByUsername($_0x6118->username, $_0xf57a->id_tp, $_0x87fc->id_smt);
 goto L_dd35f;
 L_e55b7:
 $_0xcccc["\x65\153\x73\164\x72\141\x5f\163\x65\154\x65\143\x74\145\x64"] = $_0x6caa;
 goto L_a6707;
 L_ef32c:
 $_0xcccc["\x74\160"] = $this->dashboard->getTahun();
 goto L_5016e;
 L_c75ef:
 $_0xf57a = $this->dashboard->getTahunActive();
 goto L_a6428;
 L_067c1:
 /*
 $mapel = '';
 $kelas = [];
 
 foreach ($mapels as $m) {
 if ($m->id_mapel == $id_mapel) {
 $mapel = ['id_mapel' => $m->id_mapel, 'nama_mapel' => $m->nama_mapel];
 }
 foreach ($m->kelas_mapel as $kls) {
 if ($kls->kelas == $id_kelas) {
 $kelas = ['id_kelas' => $kls->kelas, 'nama_kelas' => $this->dropdown->getNamaKelasById($tp->id_tp, $smt->id_smt, $kls->kelas)];
 }
 }
 }
 
 $siswas = $id_kelas ? $this->kelas->getKelasSiswa($id_kelas, $tp->id_tp, $smt->id_smt) : [];
 $nilai = [];
 
 for ($i = 0; $i < count($siswas); $i++) {
 $siswa = $siswas[$i];
 $dummyNilai = ['nhar' => '', 'npts' => '', 'npas' => ''];
 
 $ns = $this->rapor->getNilaiAkhirKelas($id_mapel, $id_kelas, $siswa->id_siswa, $tp->id_tp, $smt->id_smt);
 $nilai[$siswa->id_siswa] = $ns == null ? $dummyNilai : $ns;
 }
 
 $setting = $this->rapor->getRaporSetting($tp->id_tp, $smt->id_smt);
 $kkm = $this->rapor->getKkm($id_mapel . $id_kelas . '1', $tp->id_tp, $smt->id_smt);
 
 $data = [
 'user' => $user,
 'judul' => 'Semua Nilai',
 'subjudul' => 'Semua Nilai Rapor',
 'setting' => $this->dashboard->getSetting(),
 'guru' => $guru,
 //'mapel' => $mapel,
 //'kelas' => $kelas,
 'siswa' => $siswas,
 'nilai' => $nilai,
 'kkm_guru' => $kkm,
 'kkm_setting' => $setting
 ];
 */
 $_0xcccc = ["\x75\163\x65\162" => $_0x6118, "\x6a\165\x64\165\x6c" => "\x53\145\x6d\165\x61\40\x4e\151\x6c\141\x69", "\x73\165\x62\152\x75\144\x75\154" => "\x53\145\x6d\165\x61\40\x4e\151\x6c\141\x69\40\x52\141\x70\157\x72", "\x73\145\x74\164\x69\156\x67" => $this->dashboard->getSetting(), "\x67\165\x72\165" => $_0xe7a2];
 goto L_ef32c;
 L_824b6:
 $_0x4054 = $this->maybe_unserialize($_0x4189->mapel_kelas ?? "\x5b\135");
 goto L_067c1;
 L_c78de:
 $_0x6118 = (object) ["\x69\144" => session()->get("\x69\144\x5f\165\x73\145\x72"), "\x75\163\x65\162\x6e\141\x6d\145" => session()->get("\x75\163\x65\162\x6e\141\x6d\145")];
 goto L_c75ef;
 L_b6a9f:
 $_0xf967[''] = "\x50\151\x6c\151\x68\40\x4d\141\x70\145\x6c";
 goto L_e9301;
 L_3bca4:
 if ($_0x6caa != null) {
 $_0xb65c = $this->rapor->getRaporSetting($_0xf57a->id_tp, $_0x87fc->id_smt);
 if ($_0xb65c->kkm_tunggal == "\x31") {
 $_0x8107 = $_0xb65c;
 } else {
 $_0x1c03 = $_0x46f7 == "\x31" ? "\x31" : "\x32";
 $_0x8107 = $this->rapor->getKkm($_0x6caa . ($_0xe7a2->wali_kelas ?? $this->request->getGet("\x6b\145\x6c\141\x73") ?? null) . $_0xf57a->id_tp . $_0x87fc->id_smt . $_0x1c03);
 }
 $_0x90d9 = $this->kelas->getKelasSiswa($_0xe7a2->wali_kelas ?? $this->request->getGet("\x6b\145\x6c\141\x73") ?? null, $_0xf57a->id_tp, $_0x87fc->id_smt);
 $_0xa064 = [];
 $_0xd3f3[] = [];
 if (($_0xe7a2->wali_kelas ?? $this->request->getGet("\x6b\145\x6c\141\x73") ?? null) != null) {
 $_0xc449 = ["\x31", "\x32"];
 foreach ($_0xc449 as $_0x4cf4) {
 for ($_0xad3a = 0; $_0xad3a < 8; $_0xad3a++) {
 $_0xf900 = $_0xad3a + 1;
 $_0xd3f3[$_0x4cf4][$_0x6caa . ($_0xe7a2->wali_kelas ?? $this->request->getGet("\x6b\145\x6c\141\x73") ?? null) . $_0x4cf4 . $_0xf900] = $this->rapor->getKikdMapel($_0x6caa . ($_0xe7a2->wali_kelas ?? $this->request->getGet("\x6b\145\x6c\141\x73") ?? null) . $_0x4cf4 . $_0xf900, $_0xf57a->id_tp, $_0x87fc->id_smt);
 }
 }
 }
 if ($_0x46f7 == "\x31") {
 $_0xdfcc = '';
 foreach ($_0xf9f1 as $_0x1da0) {
 foreach ($_0x1da0->mapel_kelas as $_0x131d) {
 if ($_0x131d->id_mapel == $_0x6caa) {
 foreach ($_0x131d->kelas_mapel as $_0xdabb) {
 if ($_0xdabb->kelas == ($_0xe7a2->wali_kelas ?? $this->request->getGet("\x6b\145\x6c\141\x73") ?? null)) {
 $_0xdfcc = $_0x1da0->nama_guru;
 }
 }
 }
 }
 }
 for ($_0xad3a = 0; $_0xad3a < count($_0x90d9); $_0xad3a++) {
 $_0x9099 = $_0x90d9[$_0xad3a];
 $_0x2fea = ["\x70\61" => '', "\x70\62" => '', "\x70\63" => '', "\x70\64" => '', "\x70\65" => '', "\x70\66" => '', "\x70\67" => '', "\x70\70" => '', "\x70\137\x72\141\x74\141\x5f\162\x61\164\x61" => '', "\x70\137\x70\162\x65\144\x69\153\x61\164" => "\x3d", "\x70\137\x64\145\x73\153\x72\151\x70\163\x69" => '', "\x6b\61" => '', "\x6b\62" => '', "\x6b\63" => '', "\x6b\64" => '', "\x6b\65" => '', "\x6b\66" => '', "\x6b\67" => '', "\x6b\70" => '', "\x6b\137\x72\141\x74\141\x5f\162\x61\164\x61" => '', "\x6b\137\x70\162\x65\144\x69\153\x61\164" => '', "\x6b\137\x64\145\x73\153\x72\151\x70\163\x69" => ''];
 $_0x633b = $this->rapor->getNilaiHarianKelas($_0x6caa, $_0xe7a2->wali_kelas ?? $this->request->getGet("\x6b\145\x6c\141\x73") ?? null, $_0x9099->id_siswa, $_0xf57a->id_tp, $_0x87fc->id_smt);
 $_0xa064[$_0x9099->id_siswa] = $_0x633b == null ? json_decode(json_encode($_0x2fea)) : $_0x633b;
 }
 } else {
 $_0xdfcc = '';
 foreach ($_0xf9f1 as $_0x1da0) {
 foreach ($_0x1da0->ekstra_kelas as $_0x131d) {
 if ($_0x131d->id_ekstra == $_0x6caa) {
 foreach ($_0x131d->kelas_ekstra as $_0xdabb) {
 if ($_0xdabb->kelas == ($_0xe7a2->wali_kelas ?? $this->request->getGet("\x6b\145\x6c\141\x73") ?? null)) {
 $_0xdfcc = $_0x1da0->nama_guru;
 }
 }
 }
 }
 }
 $_0xb289 = ["\x64\145\x73\153\x72\151\x70\163\x69" => '', "\x6e\151\x6c\141\x69" => '', "\x70\162\x65\144\x69\153\x61\164" => ''];
 for ($_0xad3a = 0; $_0xad3a < count($_0x90d9); $_0xad3a++) {
 $_0x9099 = $_0x90d9[$_0xad3a];
 $_0x6295 = $this->rapor->getEkstraKelas($_0x6caa, $_0x9099->id_siswa, $_0xf57a->id_tp, $_0x87fc->id_smt);
 $_0xa064[$_0x9099->id_siswa] = $_0x6295 == null ? json_decode(json_encode($_0xb289)) : $_0x6295;
 }
 }
 $_0xcccc["\x73\151\x73\167\x61"] = $_0x90d9;
 $_0xcccc["\x6e\151\x6c\141\x69"] = $_0xa064;
 $_0xcccc["\x6b\153\x6d"] = $_0x8107;
 //$data['guru_mapels'] = $jabatan_guru;
 $_0xcccc["\x67\165\x72\165\x5f\155\x61\160\x65\154"] = $_0xdfcc;
 }
 goto L_e6ec0;
 L_5016e:
 $_0xcccc["\x74\160\x5f\141\x63\164\x69\166\x65"] = $_0xf57a;
 goto L_8565a;
 L_a6428:
 $_0x87fc = $this->dashboard->getSemesterActive();
 goto L_47fb8;
 L_6e4df:
 $_0xcccc["\x73\155\x74\137\x61\143\x74\151\x76\145"] = $_0x87fc;
 goto L_b6a9f;
 L_a6707:
 $_0xcccc["\x6d\141\x70\145\x6c\137\x73\145\x6c\145\x63\164\x65\144"] = $_0x6caa;
 goto L_5ed6f;
 L_2138f:
 foreach ($_0xf9f1 as $_0x5a9f) {
 $_0x5a9f->mapel_kelas = $_0x5a9f->mapel_kelas == null ? [] : $this->maybe_unserialize($_0x5a9f->mapel_kelas ?? "\x5b\135");
 $_0x5a9f->ekstra_kelas = $_0x5a9f->ekstra_kelas == null ? [] : $this->maybe_unserialize($_0x5a9f->ekstra_kelas ?? "\x5b\135");
 }
 goto L_3bca4;
 L_9fac4:
 $_0xcccc["\x65\153\x73\164\x72\141"] = $_0xf967 + $_0x5d74;
 goto L_7b521;
 L_5ed6f:
 $_0xcccc["\x66\151\x6c\164\x65\162\x5f\163\x65\154\x65\143\x74\145\x64"] = $_0x46f7;
 goto L_07671;
 L_bc82c:
 $_0x5d74 = $this->dropdown->getAllEkskul();
 goto L_9fac4;
 L_7b521:
 $_0xcccc["\x66\151\x6c\164\x65\162"] = ['' => "\x46\151\x6c\164\x65\162\x20\142\x65\162\x64\141\x73\141\x72\153\x61\156", "\x31" => "\x4d\141\x74\141\x20\120\x65\154\x61\152\x61\162\x61\156", "\x32" => "\x45\153\x73\164\x72\141\x6b\165\x72\151\x6b\165\x6c\145\x72"];
 goto L_e55b7;
 L_8565a:
 $_0xcccc["\x73\155\x74"] = $this->dashboard->getSemester();
 goto L_6e4df;
 }
 public function inputHarian($_0xffd3, $_0xa6db)
 {
 goto L_4decf;
 L_4decf:
 $_0xff0a = $this->dashboard->getTahunActive();
 goto L_466d9;
 L_d7d22:
 if (($_0x408e->mode_rapor ?? "\x73\145\x6d\165\x61") === "\x73\164\x73") {
 return $this->inputPts($_0xffd3, $_0xa6db);
 }
 goto L_96445;
 L_466d9:
 $_0xc8bd = $this->dashboard->getSemesterActive();
 goto L_c6277;
 L_96445:
 return $this->inputSas($_0xffd3, $_0xa6db);
 L_c6277:
 $_0x408e = $this->raporKurmer->getSetting($_0xff0a->id_tp, $_0xc8bd->id_smt);
 goto L_d7d22;
 }
 public function inputPts($_0x78ac, $_0xcfaa)
 {
 goto L_57ebe;
 L_296ae:
 $_0xd19e = $this->rapor->getDetailSiswa($_0xcfaa, $_0xefa7->id_tp, $_0xb8d7->id_smt);
 goto L_f0069;
 L_3976e:
 $_0x4c6f = $this->raporKurmer->getCbtScoresForClass($_0x78ac, $_0xcfaa, $_0xefa7->id_tp, $_0xb8d7->id_smt, "\x70\164\x73", $_0xbc0a, $_0x138d, $_0x82ea);
 goto L_5c390;
 L_6a832:
 $_0xb8d7 = $this->dashboard->getSemesterActive();
 goto L_66da2;
 L_1a88f:
 // Ambil Nilai CBT PTS jika ada
 $_0xbc0a = $_0xb64d->cbt_convert_mode ?? "\x6b\141\x74\162\x6f\154";
 goto L_71fcb;
 L_c65fc:
 $_0xe934 = $this->kelas->get_one($_0xcfaa);
 goto L_7a1b5;
 L_7a1b5:
 $_0x83ce = $this->dashboard->getDataGuruByUsername($_0x5747->username, $_0xefa7->id_tp, $_0xb8d7->id_smt);
 goto L_253c3;
 L_6414a:
 $_0x348a = ["\x75\163\x65\162" => $_0x5747, "\x6a\165\x64\165\x6c" => "\x50\145\x6e\151\x6c\141\x69\141\x6e\40\x50\124\x53\40\x28\124\x65\156\x67\141\x68\40\x53\145\x6d\145\x73\164\x65\162\x29", "\x73\165\x62\152\x75\144\x75\154" => "\x49\156\x70\165\x74\40\x4e\151\x6c\141\x69\40\x50\124\x53\40\x26\40\x4e\151\x6c\141\x69\40\x41\153\x68\151\x72\40\x54\145\x6e\147\x61\150\x20\123\x65\155\x65\163\x74\145\x72", "\x73\145\x74\164\x69\156\x67" => $this->dashboard->getSetting(), "\x72\141\x70\157\x72\137\x73\145\x74\164\x69\156\x67" => $_0xb64d, "\x74\160" => $this->dashboard->getTahun(), "\x74\160\x5f\141\x63\164\x69\166\x65" => $_0xefa7, "\x73\155\x74" => $this->dashboard->getSemester(), "\x73\155\x74\137\x61\143\x74\151\x76\145" => $_0xb8d7, "\x67\165\x72\165" => $_0x83ce, "\x6d\141\x70\145\x6c" => $_0x7458 ? (array) $_0x7458 : ["\x69\144\x5f\155\x61\160\x65\154" => $_0x78ac, "\x6e\141\x6d\141\x5f\155\x61\160\x65\154" => "\x4d\141\x74\141\x20\120\x65\154\x61\152\x61\162\x61\156"], "\x6b\145\x6c\141\x73" => $_0xe934 ? (array) $_0xe934 : ["\x69\144\x5f\153\x65\154\x61\163" => $_0xcfaa, "\x6e\141\x6d\141\x5f\153\x65\154\x61\163" => "\x4b\145\x6c\141\x73"], "\x73\151\x73\167\x61\163" => $_0xd19e, "\x6e\151\x6c\141\x69" => $_0x54b7, "\x6b\153\x74\160" => $_0x8d53, "\x63\142\x74\137\x73\143\x6f\162\x65\163" => $_0x4c6f];
 goto L_fbfeb;
 L_21c09:
 $_0xefa7 = $this->dashboard->getTahunActive();
 goto L_6a832;
 L_e7772:
 $_0x82ea = $_0xb64d->cbt_katrol_max ?? 100;
 goto L_3976e;
 L_0cdc3:
 if (!$_0x7458) {
 $_0x7458 = $this->db->table("\x6d\141\x73\164\x65\162\x5f\155\x61\160\x65\154")->where("\x69\144\x5f\155\x61\160\x65\154", $_0x78ac)->get()->getRow();
 }
 goto L_c65fc;
 L_f0069:
 $_0x54b7 = $this->raporKurmer->getNilaiKelas($_0x78ac, $_0xcfaa, $_0xefa7->id_tp, $_0xb8d7->id_smt);
 goto L_d8cfe;
 L_fbfeb:
 return view("\x6d\145\x6d\142\x65\162\x73\57\x67\165\x72\165\x2f\162\x61\160\x6f\162\x2f\156\x69\154\x61\151\x2f\151\x6e\160\x75\164\x5f\160\x74\163", $_0x348a);
 L_253c3:
 $_0xb64d = $this->raporKurmer->getSetting($_0xefa7->id_tp, $_0xb8d7->id_smt);
 goto L_296ae;
 L_66da2:
 $_0x7458 = $this->master->getMapelById($_0x78ac);
 goto L_0cdc3;
 L_71fcb:
 $_0x138d = $_0xb64d->cbt_katrol_min ?? 60;
 goto L_e7772;
 L_57ebe:
 $_0x5747 = (object) ["\x69\144" => session()->get("\x69\144\x5f\165\x73\145\x72"), "\x75\163\x65\162\x6e\141\x6d\145" => session()->get("\x75\163\x65\162\x6e\141\x6d\145")];
 goto L_21c09;
 L_57e67:
 if ($_0xfc98 && !empty($_0x4c6f)) {
 foreach ($_0xd19e as $_0x1ac8) {
 if (isset($_0x4c6f[$_0x1ac8->id_siswa])) {
 $_0xa478 = $_0x4c6f[$_0x1ac8->id_siswa]["\x66\151\x6e\141\x6c"];
 if ($_0xa478 > 0) {
 if (!isset($_0x54b7[$_0x1ac8->id_siswa])) {
 $_0xf1e6 = new \stdClass();
 $_0xf1e6->id_siswa = $_0x1ac8->id_siswa;
 $_0xf1e6->nilai_sts = $_0xa478;
 $_0xf1e6->nilai_akhir = $_0xa478;
 $_0x54b7[$_0x1ac8->id_siswa] = $_0xf1e6;
 } else {
 if ($_0x54b7[$_0x1ac8->id_siswa]->nilai_sts === null || $_0x54b7[$_0x1ac8->id_siswa]->nilai_sts === '' || $_0x54b7[$_0x1ac8->id_siswa]->nilai_sts == 0) {
 $_0x54b7[$_0x1ac8->id_siswa]->nilai_sts = $_0xa478;
 }
 if ($_0x54b7[$_0x1ac8->id_siswa]->nilai_akhir === null || $_0x54b7[$_0x1ac8->id_siswa]->nilai_akhir === '' || $_0x54b7[$_0x1ac8->id_siswa]->nilai_akhir == 0) {
 $_0x54b7[$_0x1ac8->id_siswa]->nilai_akhir = $_0xa478;
 }
 }
 }
 }
 }
 }
 goto L_6414a;
 L_d8cfe:
 $_0x8d53 = $this->raporKurmer->getKktp($_0x78ac, $_0xefa7->id_tp, $_0xb8d7->id_smt, $_0xcfaa);
 goto L_1a88f;
 L_5c390:
 // Auto-fill jika disetting auto_fill_cbt dan nilai di rapor masih kosong
 $_0xfc98 = !isset($_0xb64d->auto_fill_cbt) || $_0xb64d->auto_fill_cbt == 1;
 goto L_57e67;
 }
 public function inputSas($_0xd393, $_0x8a9b)
 {
 goto L_03b37;
 L_9533e:
 $_0x2d91 = ["\x75\163\x65\162" => $_0xf50c, "\x6a\165\x64\165\x6c" => "\x50\145\x6e\151\x6c\141\x69\141\x6e\40\x53\101\x53\40\x28\101\x6b\150\x69\162\x20\123\x65\155\x65\163\x74\145\x72\51", "\x73\165\x62\152\x75\144\x75\154" => "\x49\156\x70\165\x74\40\x4e\151\x6c\141\x69\40\x53\165\x6d\141\x74\151\x66\40\x4c\115\x31\55\x4c\115\x34\54\x20\123\x41\123\x2c\40\x64\141\x6e\40\x43\141\x70\141\x69\141\x6e\40\x4b\157\x6d\160\x65\164\x65\156\x73\151", "\x73\145\x74\164\x69\156\x67" => $this->dashboard->getSetting(), "\x72\141\x70\157\x72\137\x73\145\x74\164\x69\156\x67" => $_0xfb1c, "\x74\160" => $this->dashboard->getTahun(), "\x74\160\x5f\141\x63\164\x69\166\x65" => $_0x4498, "\x73\155\x74" => $this->dashboard->getSemester(), "\x73\155\x74\137\x61\143\x74\151\x76\145" => $_0xf450, "\x67\165\x72\165" => $_0xd074, "\x6d\141\x70\145\x6c" => $_0x9ab1 ? (array) $_0x9ab1 : ["\x69\144\x5f\155\x61\160\x65\154" => $_0xd393, "\x6e\141\x6d\141\x5f\155\x61\160\x65\154" => "\x4d\141\x74\141\x20\120\x65\154\x61\152\x61\162\x61\156"], "\x6b\145\x6c\141\x73" => $_0x77b7 ? (array) $_0x77b7 : ["\x69\144\x5f\153\x65\154\x61\163" => $_0x8a9b, "\x6e\141\x6d\141\x5f\153\x65\154\x61\163" => "\x4b\145\x6c\141\x73"], "\x73\151\x73\167\x61\163" => $_0x1337, "\x74\160\x73" => $_0x2cd5, "\x6e\151\x6c\141\x69" => $_0x243a, "\x6b\153\x74\160" => $_0xfdde, "\x63\142\x74\137\x73\143\x6f\162\x65\163" => $_0xf9c1];
 goto L_830c3;
 L_64678:
 $_0xf9c1 = $this->raporKurmer->getCbtScoresForClass($_0xd393, $_0x8a9b, $_0x4498->id_tp, $_0xf450->id_smt, "\x73\141\x73", $_0x9a4c, $_0xa623, $_0x3744);
 goto L_49c50;
 L_ab5a6:
 $_0x3744 = $_0xfb1c->cbt_katrol_max ?? 100;
 goto L_64678;
 L_21b25:
 $_0x77b7 = $this->kelas->get_one($_0x8a9b);
 goto L_94fcd;
 L_75194:
 $_0x243a = $this->raporKurmer->getNilaiKelas($_0xd393, $_0x8a9b, $_0x4498->id_tp, $_0xf450->id_smt);
 goto L_364ab;
 L_eec02:
 $_0x2cd5 = $this->raporKurmer->getListTp($_0xd393, $_0x4498->id_tp, $_0xf450->id_smt, $_0x8a9b);
 goto L_75194;
 L_364ab:
 $_0xfdde = $this->raporKurmer->getKktp($_0xd393, $_0x4498->id_tp, $_0xf450->id_smt, $_0x8a9b);
 goto L_ebcd5;
 L_ebcd5:
 // Ambil Nilai CBT SAS jika ada
 $_0x9a4c = $_0xfb1c->cbt_convert_mode ?? "\x6b\141\x74\162\x6f\154";
 goto L_09d5c;
 L_03b37:
 $_0xf50c = (object) ["\x69\144" => session()->get("\x69\144\x5f\165\x73\145\x72"), "\x75\163\x65\162\x6e\141\x6d\145" => session()->get("\x75\163\x65\162\x6e\141\x6d\145")];
 goto L_a772a;
 L_830c3:
 return view("\x6d\145\x6d\142\x65\162\x73\57\x67\165\x72\165\x2f\162\x61\160\x6f\162\x2f\156\x69\154\x61\151\x2f\151\x6e\160\x75\164\x5f\163\x61\163", $_0x2d91);
 L_b459d:
 $_0xfb1c = $this->raporKurmer->getSetting($_0x4498->id_tp, $_0xf450->id_smt);
 goto L_068eb;
 L_4a8bc:
 if (!$_0x9ab1) {
 $_0x9ab1 = $this->db->table("\x6d\141\x73\164\x65\162\x5f\155\x61\160\x65\154")->where("\x69\144\x5f\155\x61\160\x65\154", $_0xd393)->get()->getRow();
 }
 goto L_21b25;
 L_bd980:
 if ($_0x75db && !empty($_0xf9c1)) {
 foreach ($_0x1337 as $_0x938b) {
 if (isset($_0xf9c1[$_0x938b->id_siswa])) {
 $_0xd4f5 = $_0xf9c1[$_0x938b->id_siswa]["\x66\151\x6e\141\x6c"];
 if ($_0xd4f5 > 0) {
 if (!isset($_0x243a[$_0x938b->id_siswa])) {
 $_0x816b = new \stdClass();
 $_0x816b->id_siswa = $_0x938b->id_siswa;
 $_0x816b->nilai_sas = $_0xd4f5;
 $_0x243a[$_0x938b->id_siswa] = $_0x816b;
 } else if ($_0x243a[$_0x938b->id_siswa]->nilai_sas === null || $_0x243a[$_0x938b->id_siswa]->nilai_sas === '' || $_0x243a[$_0x938b->id_siswa]->nilai_sas == 0) {
 $_0x243a[$_0x938b->id_siswa]->nilai_sas = $_0xd4f5;
 }
 }
 }
 }
 }
 goto L_9533e;
 L_b8a0e:
 $_0x9ab1 = $this->master->getMapelById($_0xd393);
 goto L_4a8bc;
 L_93860:
 $_0xf450 = $this->dashboard->getSemesterActive();
 goto L_b8a0e;
 L_09d5c:
 $_0xa623 = $_0xfb1c->cbt_katrol_min ?? 60;
 goto L_ab5a6;
 L_068eb:
 $_0x1337 = $this->rapor->getDetailSiswa($_0x8a9b, $_0x4498->id_tp, $_0xf450->id_smt);
 goto L_eec02;
 L_a772a:
 $_0x4498 = $this->dashboard->getTahunActive();
 goto L_93860;
 L_94fcd:
 $_0xd074 = $this->dashboard->getDataGuruByUsername($_0xf50c->username, $_0x4498->id_tp, $_0xf450->id_smt);
 goto L_b459d;
 L_49c50:
 // Auto-fill jika disetting auto_fill_cbt dan nilai di rapor masih kosong
 $_0x75db = !isset($_0xfb1c->auto_fill_cbt) || $_0xfb1c->auto_fill_cbt == 1;
 goto L_bd980;
 }
 public function saveNilaiPts()
 {
 goto L_1f25b;
 L_d9ab5:
 foreach ($_0xaaba as $_0xe8bf => $_0x2174) {
 $_0xc4e7 = ["\x69\144\x5f\164\x70" => $_0x4aa4->id_tp, "\x69\144\x5f\163\x6d\164" => $_0x1dd4->id_smt, "\x69\144\x5f\153\x65\154\x61\163" => $_0x5d11, "\x69\144\x5f\155\x61\160\x65\154" => $_0x419c, "\x69\144\x5f\163\x69\163\x77\141" => $_0xe8bf, "\x6e\151\x6c\141\x69\137\x73\164\x73" => !empty($_0x2174["\x6e\151\x6c\141\x69\137\x73\164\x73"]) && is_numeric($_0x2174["\x6e\151\x6c\141\x69\137\x73\164\x73"]) ? floatval($_0x2174["\x6e\151\x6c\141\x69\137\x73\164\x73"]) : null, "\x6e\151\x6c\141\x69\137\x61\153\x68\151\x72" => isset($_0x2174["\x6e\151\x6c\141\x69\137\x61\153\x68\151\x72"]) && is_numeric($_0x2174["\x6e\151\x6c\141\x69\137\x61\153\x68\151\x72"]) ? floatval($_0x2174["\x6e\151\x6c\141\x69\137\x61\153\x68\151\x72"]) : (!empty($_0x2174["\x6e\151\x6c\141\x69\137\x73\164\x73"]) && is_numeric($_0x2174["\x6e\151\x6c\141\x69\137\x73\164\x73"]) ? floatval($_0x2174["\x6e\151\x6c\141\x69\137\x73\164\x73"]) : null)];
 $this->raporKurmer->saveNilaiPts($_0xc4e7);
 }
 goto L_48c12;
 L_ece6a:
 $_0x1dd4 = $this->dashboard->getSemesterActive();
 goto L_f6d37;
 L_48c12:
 return $this->output_json(["\x73\164\x61\164\x75\163" => true]);
 L_d7ec9:
 $_0xaaba = $this->request->getPost("\x73\151\x73\167\x61") ?? [];
 goto L_d9ab5;
 L_f6d37:
 $_0x419c = $this->request->getPost("\x69\144\x5f\155\x61\160\x65\154");
 goto L_890de;
 L_890de:
 $_0x5d11 = $this->request->getPost("\x69\144\x5f\153\x65\154\x61\163");
 goto L_d7ec9;
 L_1f25b:
 $_0x4aa4 = $this->dashboard->getTahunActive();
 goto L_ece6a;
 }
 public function saveNilaiSas()
 {
 goto L_bf01b;
 L_a06b0:
 return $this->output_json(["\x73\164\x61\164\x75\163" => true]);
 L_bf01b:
 $_0x7a71 = $this->dashboard->getTahunActive();
 goto L_805ba;
 L_1285f:
 $_0xea17 = $this->request->getPost("\x69\144\x5f\155\x61\160\x65\154");
 goto L_7e960;
 L_805ba:
 $_0xb365 = $this->dashboard->getSemesterActive();
 goto L_1285f;
 L_2b3e0:
 $_0xcad0 = $this->raporKurmer->getListTp($_0xea17, $_0x7a71->id_tp, $_0xb365->id_smt, $_0xb472);
 goto L_411fa;
 L_7e960:
 $_0xb472 = $this->request->getPost("\x69\144\x5f\153\x65\154\x61\163");
 goto L_1d795;
 L_1d795:
 $_0xe3b3 = $this->request->getPost("\x73\151\x73\167\x61") ?? [];
 goto L_2b3e0;
 L_411fa:
 foreach ($_0xe3b3 as $_0x460e => $_0x61cb) {
 $_0xd923 = $_0x61cb["\x73\165\x6d\141\x74\151\x66"] ?? [];
 $_0xe49f = ["\x69\144\x5f\164\x70" => $_0x7a71->id_tp, "\x69\144\x5f\163\x6d\164" => $_0xb365->id_smt, "\x69\144\x5f\153\x65\154\x61\163" => $_0xb472, "\x69\144\x5f\155\x61\160\x65\154" => $_0xea17, "\x69\144\x5f\163\x69\163\x77\141" => $_0x460e, "\x6e\151\x6c\141\x69\137\x73\165\x6d\141\x74\151\x66" => $_0xd923, "\x72\141\x74\141\x5f\163\x75\155\x61\164\x69\146" => !empty($_0x61cb["\x72\141\x74\141\x5f\163\x75\155\x61\164\x69\146"]) && is_numeric($_0x61cb["\x72\141\x74\141\x5f\163\x75\155\x61\164\x69\146"]) ? floatval($_0x61cb["\x72\141\x74\141\x5f\163\x75\155\x61\164\x69\146"]) : null, "\x6e\151\x6c\141\x69\137\x73\141\x73" => !empty($_0x61cb["\x6e\151\x6c\141\x69\137\x73\141\x73"]) && is_numeric($_0x61cb["\x6e\151\x6c\141\x69\137\x73\141\x73"]) ? floatval($_0x61cb["\x6e\151\x6c\141\x69\137\x73\141\x73"]) : null, "\x6e\151\x6c\141\x69\137\x61\153\x68\151\x72" => isset($_0x61cb["\x6e\151\x6c\141\x69\137\x61\153\x68\151\x72"]) && is_numeric($_0x61cb["\x6e\151\x6c\141\x69\137\x61\153\x68\151\x72"]) ? floatval($_0x61cb["\x6e\151\x6c\141\x69\137\x61\153\x68\151\x72"]) : null, "\x64\145\x73\153\x72\151\x70\163\x69\137\x63\141\x70\141\x69\141\x6e" => $_0x61cb["\x64\145\x73\153\x72\151\x70\163\x69\137\x63\141\x70\141\x69\141\x6e"] ?? null];
 $this->raporKurmer->saveNilaiSas($_0xe49f, $_0xcad0);
 }
 goto L_a06b0;
 }
 public function tarikNilaiCbt()
 {
 goto L_cab32;
 L_8a739:
 $_0x840b = $this->request->getPost("\x69\144\x5f\155\x61\160\x65\154");
 goto L_91dc6;
 L_cab32:
 $_0x146d = $this->dashboard->getTahunActive();
 goto L_ebcdc;
 L_5b9ef:
 $_0x428a = $this->raporKurmer->getSetting($_0x146d->id_tp, $_0xdd79->id_smt);
 goto L_66bca;
 L_e6bba:
 $_0x919b = $_0x428a->cbt_katrol_min ?? 60;
 goto L_2f920;
 L_644ca:
 $_0x5a26 = $this->request->getPost("\x6d\157\x64\145");
 goto L_5b9ef;
 L_91dc6:
 $_0x4ad1 = $this->request->getPost("\x69\144\x5f\153\x65\154\x61\163");
 goto L_9a1ba;
 L_caca2:
 return $this->output_json(["\x73\164\x61\164\x75\163" => true, "\x73\143\x6f\162\x65\163" => $_0x2376, "\x63\157\x75\156\x74" => count($_0x2376), "\x6d\157\x64\145" => $_0x5a26, "\x6d\151\x6e" => $_0x919b, "\x6d\141\x78" => $_0xb5b5]);
 L_2f920:
 $_0xb5b5 = $_0x428a->cbt_katrol_max ?? 100;
 goto L_eb4fa;
 L_ebcdc:
 $_0xdd79 = $this->dashboard->getSemesterActive();
 goto L_8a739;
 L_eb4fa:
 $_0x2376 = $this->raporKurmer->getCbtScoresForClass($_0x840b, $_0x4ad1, $_0x146d->id_tp, $_0xdd79->id_smt, $_0xbacb, $_0x5a26, $_0x919b, $_0xb5b5);
 goto L_caca2;
 L_66bca:
 if (!$_0x5a26) {
 $_0x5a26 = $_0x428a->cbt_convert_mode ?? "\x6b\141\x74\162\x6f\154";
 }
 goto L_e6bba;
 L_9a1ba:
 $_0xbacb = $this->request->getPost("\x74\151\x70\145") ?? "\x70\164\x73";
 goto L_644ca;
 }
 public function saveNilaiAsesmen()
 {
 return $this->saveNilaiSas();
 }
 public function downloadNilaiHarian($_0xaf26, $_0xf62e)
 {
 goto L_401da;
 L_92b3a:
 $_0x8153 = $this->dashboard->getSemesterActive();
 goto L_ad100;
 L_e74aa:
 $_0xf081 = [];
 goto L_48756;
 L_2d6ba:
 $_0x62b2 = [];
 goto L_10901;
 L_26360:
 $_0xb3b3 = $this->rapor->getKikdMapelKelas($_0xaf26, $_0xf62e, $_0xa892->id_tp, $_0x8153->id_smt);
 goto L_72c19;
 L_48756:
 foreach ($_0x6912 as $_0x6ee1) {
 $_0x88a8 = $_0x6ee1->no;
 $_0xf081[] = ["\x6e\157" => $_0x88a8, "\x6e\157\x70" => $_0x88a8, "\x6b\157\x64\145\x70" => $_0x6ee1->kodep, "\x70" => $_0x6ee1->p, "\x6e\157\x6b" => $_0x88a8, "\x6b\157\x64\145\x6b" => isset($_0x62b2[$_0x88a8]) ? $_0x62b2[$_0x88a8]->kodek : '', "\x6b" => isset($_0x62b2[$_0x88a8]) ? $_0x62b2[$_0x88a8]->k : ''];
 }
 goto L_cdb98;
 L_ea481:
 $_0xa3c4 = [];
 goto L_a7169;
 L_92aa4:
 foreach ($_0x8606 as $_0xbd92 => $_0x98ed) {
 $_0x98ed->no = $_0xbd92 + 1;
 $_0x98ed->no_induk = $_0x98ed->nisn != null ? "\x27" . $_0x98ed->nisn : "\x27" . $_0x98ed->nis;
 $_0x98ed->p1 = isset($_0x69fa[$_0x98ed->id_siswa]) ? $_0x69fa[$_0x98ed->id_siswa]->p1 ?? '' : '';
 $_0x98ed->p2 = isset($_0x69fa[$_0x98ed->id_siswa]) ? $_0x69fa[$_0x98ed->id_siswa]->p2 ?? '' : '';
 $_0x98ed->p3 = isset($_0x69fa[$_0x98ed->id_siswa]) ? $_0x69fa[$_0x98ed->id_siswa]->p3 ?? '' : '';
 $_0x98ed->p4 = isset($_0x69fa[$_0x98ed->id_siswa]) ? $_0x69fa[$_0x98ed->id_siswa]->p4 ?? '' : '';
 $_0x98ed->p5 = isset($_0x69fa[$_0x98ed->id_siswa]) ? $_0x69fa[$_0x98ed->id_siswa]->p5 ?? '' : '';
 $_0x98ed->p6 = isset($_0x69fa[$_0x98ed->id_siswa]) ? $_0x69fa[$_0x98ed->id_siswa]->p6 ?? '' : '';
 $_0x98ed->p7 = isset($_0x69fa[$_0x98ed->id_siswa]) ? $_0x69fa[$_0x98ed->id_siswa]->p7 ?? '' : '';
 $_0x98ed->p8 = isset($_0x69fa[$_0x98ed->id_siswa]) ? $_0x69fa[$_0x98ed->id_siswa]->p8 ?? '' : '';
 $_0x98ed->k1 = isset($_0x69fa[$_0x98ed->id_siswa]) ? $_0x69fa[$_0x98ed->id_siswa]->k1 ?? '' : '';
 $_0x98ed->k2 = isset($_0x69fa[$_0x98ed->id_siswa]) ? $_0x69fa[$_0x98ed->id_siswa]->k2 ?? '' : '';
 $_0x98ed->k3 = isset($_0x69fa[$_0x98ed->id_siswa]) ? $_0x69fa[$_0x98ed->id_siswa]->k3 ?? '' : '';
 $_0x98ed->k4 = isset($_0x69fa[$_0x98ed->id_siswa]) ? $_0x69fa[$_0x98ed->id_siswa]->k4 ?? '' : '';
 $_0x98ed->k5 = isset($_0x69fa[$_0x98ed->id_siswa]) ? $_0x69fa[$_0x98ed->id_siswa]->k5 ?? '' : '';
 $_0x98ed->k6 = isset($_0x69fa[$_0x98ed->id_siswa]) ? $_0x69fa[$_0x98ed->id_siswa]->k6 ?? '' : '';
 $_0x98ed->k7 = isset($_0x69fa[$_0x98ed->id_siswa]) ? $_0x69fa[$_0x98ed->id_siswa]->k7 ?? '' : '';
 $_0x98ed->k8 = isset($_0x69fa[$_0x98ed->id_siswa]) ? $_0x69fa[$_0x98ed->id_siswa]->k8 ?? '' : '';
 }
 goto L_26360;
 L_17ac3:
 $_0x69fa = $this->rapor->getAllNilaiHarianKelas($_0xaf26, $_0xf62e, $_0xa892->id_tp, $_0x8153->id_smt);
 goto L_92aa4;
 L_ad100:
 $_0x8606 = $_0xf62e ? $this->kelas->getKelasSiswa($_0xf62e, $_0xa892->id_tp, $_0x8153->id_smt) : [];
 goto L_17ac3;
 L_cdb98:
 if (count($_0xb3b3) == 0) {
 for ($_0xab95 = 0; $_0xab95 < 8; $_0xab95++) {
 $_0x88a8 = $_0xab95 + 1;
 $_0xf081[] = ["\x6e\157\x6b" => $_0x88a8, "\x6b\157\x64\145\x6b" => "\x4b" . $_0x88a8, "\x6b" => $_0x88a8 == 1 ? "\x50\162\x61\153\x74\151\x6b\57\x50\157\x72\164\x6f\146\x6f\154\x69\157\x2f\120\x72\157\x79\145\x6b\40\x79\141\x6e\147\x20\144\x69\156\x69\154\x61\151\x20\50\x6c\151\x68\141\x74\40\x74\141\x62\145\x6c\40\x4b\101\x54\101\x20\113\x45\122\x4a\101\x20\163\x65\142\x65\154\x61\150\x20\153\x61\156\x61\156\x29" : '', "\x6e\157\x70" => $_0x88a8, "\x6b\157\x64\145\x70" => "\x50" . $_0x88a8, "\x70" => $_0x88a8 == 1 ? "\x4d\141\x74\145\x72\151\x20\171\x61\156\x67\40\x64\151\x6e\151\x6c\141\x69\40\x28\154\x69\150\x61\164\x20\164\x61\142\x65\154\x20\113\x41\124\x41\40\x4b\105\x52\112\x41\40\x73\145\x62\145\x6c\141\x68\40\x6b\141\x6e\141\x6e\51" : ''];
 }
 }
 goto L_6240d;
 L_6240d:
 return $this->output_json(["\x73\151\x73\167\x61" => $_0x8606, "\x6b\151\x6b\144" => $_0xf081]);
 L_a7169:
 foreach ($_0xb3b3 as $_0x2ef9) {
 $_0xbb13 = substr($_0x2ef9->id_kikd, -1);
 $_0x97f3 = new \stdClass();
 $_0x97f3->no = $_0xbb13;
 if ($_0x2ef9->aspek == 1) {
 $_0x97f3->nop = $_0xbb13;
 $_0x97f3->kodep = "\x50" . $_0xbb13;
 $_0x97f3->p = $_0x2ef9->materi_kikd;
 $_0x6912[] = $_0x97f3;
 } else {
 $_0x97f3->nok = $_0xbb13;
 $_0x97f3->kodek = "\x4b" . $_0xbb13;
 $_0x97f3->k = $_0x2ef9->materi_kikd;
 $_0xa3c4[] = $_0x97f3;
 }
 }
 goto L_2d6ba;
 L_401da:
 $_0xa892 = $this->dashboard->getTahunActive();
 goto L_92b3a;
 L_72c19:
 $_0x6912 = [];
 goto L_ea481;
 L_10901:
 foreach ($_0xa3c4 as $_0x7d3b) {
 $_0x62b2[$_0x7d3b->no] = $_0x7d3b;
 }
 goto L_e74aa;
 }
 public function uploadNilaiHarian()
 {
 goto L_62aeb;
 L_7df42:
 $_0x5884 = [];
 goto L_8b45c;
 L_5ffff:
 $this->db->transComplete();
 goto L_b5124;
 L_6f4cc:
 foreach ($_0x57c0 as $_0xa0ab) {
 $_0xa0ab["\x69\144\x5f\156\x69\154\x61\151\x5f\150\x61\162\x69\141\x6e"] = $_0x6718 . $_0xd01e . $_0xa0ab["\x69\144"] . $_0x6e77->id_tp . $_0xdebf->id_smt;
 $_0xa0ab["\x69\144\x5f\163\x69\163\x77\141"] = $_0xa0ab["\x69\144"];
 $_0xa0ab["\x69\144\x5f\155\x61\160\x65\154"] = $_0x6718;
 $_0xa0ab["\x69\144\x5f\153\x65\154\x61\163"] = $_0xd01e;
 $_0xa0ab["\x69\144\x5f\164\x70"] = $_0x6e77->id_tp;
 $_0xa0ab["\x69\144\x5f\163\x6d\164"] = $_0xdebf->id_smt;
 unset($_0xa0ab["\x69\144"]);
 unset($_0xa0ab["\x6e\151\x73\156"]);
 unset($_0xa0ab["\x6e\141\x6d\141\x73\151\x73\167\x61"]);
 $_0x5884[] = $_0xa0ab;
 }
 goto L_f812b;
 L_4ca1c:
 foreach ($_0x5884 as $_0x79cf) {
 $_0x8ae3 = $this->db->table("\x72\141\x70\157\x72\137\x6e\151\x6c\141\x69\137\x68\141\x72\151\x61\156")->replace($_0x79cf);
 if ($_0x8ae3) {
 $_0x6575++;
 }
 }
 goto L_e87b8;
 L_cca58:
 $_0xd01e = $this->request->getPost("\x69\144\x5f\153\x65\154\x61\163");
 goto L_38f4f;
 L_3e02a:
 $this->db->transStart();
 goto L_4ca1c;
 L_538d8:
 $_0x6575 = 0;
 goto L_3e02a;
 L_e87b8:
 foreach ($_0xcb38 as $_0x6a56) {
 if ($_0x6a56 != null) {
 $this->db->table("\x72\141\x70\157\x72\137\x6b\151\x6b\144")->replace($_0x6a56);
 }
 }
 goto L_5c8fd;
 L_62aeb:
 $_0x57c0 = $this->request->getPost("\x73\151\x73\167\x61");
 goto L_435f1;
 L_5c8fd:
 foreach ($_0x356b as $_0x9405) {
 if ($_0x9405 != null) {
 $this->db->table("\x72\141\x70\157\x72\137\x6b\151\x6b\144")->replace($_0x9405);
 }
 }
 goto L_5ffff;
 L_8b45c:
 $_0xcb38 = [];
 goto L_544c4;
 L_38f4f:
 $_0x6e77 = $this->dashboard->getTahunActive();
 goto L_aca2f;
 L_aca2f:
 $_0xdebf = $this->dashboard->getSemesterActive();
 goto L_7df42;
 L_2de4a:
 $_0x6718 = $this->request->getPost("\x69\144\x5f\155\x61\160\x65\154");
 goto L_cca58;
 L_544c4:
 $_0x356b = [];
 goto L_6f4cc;
 L_b5124:
 return $this->output_json($_0x6575);
 L_f812b:
 foreach ($_0xfdce as $_0x57c3) {
 $_0xcb38[] = ["\x69\144\x5f\153\x69\153\x64" => $_0x6718 . $_0xd01e . "\x31" . $_0x57c3["\x6e\157"], "\x69\144\x5f\155\x61\160\x65\154\x5f\153\x65\154\x61\163" => $_0x6718 . $_0xd01e, "\x61\163\x70\145\x6b" => 1, "\x69\144\x5f\164\x70" => $_0x6e77->id_tp, "\x69\144\x5f\163\x6d\164" => $_0xdebf->id_smt, "\x6d\141\x74\145\x72\151\x5f\153\x69\153\x64" => $_0x57c3["\x6d\141\x74\145\x72\151\x70\145\x6e\147\x65\164\x61\150\x75\141\x6e\171\x61\156\x67\144\x69\156\x69\154\x61\151"] != null ? strip_tags($_0x57c3["\x6d\141\x74\145\x72\151\x70\145\x6e\147\x65\164\x61\150\x75\141\x6e\171\x61\156\x67\144\x69\156\x69\154\x61\151"] ?? '') : ''];
 $_0x356b[] = ["\x69\144\x5f\153\x69\153\x64" => $_0x6718 . $_0xd01e . "\x32" . $_0x57c3["\x6e\157"], "\x69\144\x5f\155\x61\160\x65\154\x5f\153\x65\154\x61\163" => $_0x6718 . $_0xd01e, "\x61\163\x70\145\x6b" => 2, "\x69\144\x5f\164\x70" => $_0x6e77->id_tp, "\x69\144\x5f\163\x6d\164" => $_0xdebf->id_smt, "\x6d\141\x74\145\x72\151\x5f\153\x69\153\x64" => $_0x57c3["\x6d\141\x74\145\x72\151\x6b\145\x74\145\x72\141\x6d\160\x69\154\x61\156\x79\141\x6e\147\x64\151\x6e\151\x6c\141\x69"] != null ? strip_tags($_0x57c3["\x6d\141\x74\145\x72\151\x6b\145\x74\145\x72\141\x6d\160\x69\154\x61\156\x79\141\x6e\147\x64\151\x6e\151\x6c\141\x69"] ?? '') : ''];
 }
 goto L_538d8;
 L_435f1:
 $_0xfdce = $this->request->getPost("\x6b\151\x6b\144");
 goto L_2de4a;
 }
 public function importHarian()
 {
 goto L_e2161;
 L_e2161:
 $_0xd350 = $this->request->getPost("\x73\151\x73\167\x61");
 goto L_544b5;
 L_91013:
 $this->db->transComplete();
 goto L_31fdc;
 L_4101e:
 foreach ((array) $_0xd350 as $_0x60d4) {
 $_0xa1ce = $this->db->table("\x72\141\x70\157\x72\137\x6e\151\x6c\141\x69\137\x68\141\x72\151\x61\156")->replace($_0x60d4);
 if ($_0xa1ce) {
 $_0x4e58++;
 }
 }
 goto L_91013;
 L_31fdc:
 $_0x60d4["\x75\160\x64\141\x74\145\x64"] = $_0x4e58;
 goto L_a991b;
 L_a991b:
 return $this->output_json($_0x60d4);
 L_544b5:
 $_0x4e58 = 0;
 goto L_00dc5;
 L_00dc5:
 $this->db->transStart();
 goto L_4101e;
 }
 public function inputPtsK13($_0xcb4a, $_0x9242)
 {
 goto L_5ae05;
 L_9b0ba:
 $_0x3548["\x74\160\x5f\141\x63\164\x69\166\x65"] = $_0xb24f;
 goto L_a1c26;
 L_31c9d:
 for ($_0xa1e5 = 0; $_0xa1e5 < count($_0xfc1c); $_0xa1e5++) {
 $_0x9b2b = $_0xfc1c[$_0xa1e5];
 $_0x65c2 = ["\x70\61" => '', "\x70\62" => '', "\x70\63" => '', "\x70\64" => '', "\x70\65" => '', "\x70\66" => '', "\x70\67" => '', "\x70\70" => '', "\x70\137\x72\141\x74\141\x5f\162\x61\164\x61" => '', "\x70\137\x70\162\x65\144\x69\153\x61\164" => "\x3d", "\x70\137\x64\145\x73\153\x72\151\x70\163\x69" => '', "\x6b\61" => '', "\x6b\62" => '', "\x6b\63" => '', "\x6b\64" => '', "\x6b\65" => '', "\x6b\66" => '', "\x6b\67" => '', "\x6b\70" => '', "\x6b\137\x72\141\x74\141\x5f\162\x61\164\x61" => '', "\x6b\137\x70\162\x65\144\x69\153\x61\164" => '', "\x6b\137\x64\145\x73\153\x72\151\x70\163\x69" => ''];
 $_0x3ed3 = $this->rapor->getNilaiPtsKelas($_0xcb4a, $_0x9242, $_0x9b2b->id_siswa, $_0xb24f->id_tp, $_0x8c4e->id_smt);
 $_0x4b03[$_0x9b2b->id_siswa] = $_0x3ed3 == null ? $_0x65c2 : $_0x3ed3;
 }
 goto L_f7a49;
 L_64e55:
 $_0x3548["\x74\160"] = $this->dashboard->getTahun();
 goto L_9b0ba;
 L_f405c:
 $_0xb24f = $this->dashboard->getTahunActive();
 goto L_929a6;
 L_0d3f5:
 if ($_0x238a != null) {
 if ($_0x238a->kkm_tunggal == "\x31") {
 $_0x13bc = $_0x238a;
 } else {
 $_0x13bc = $this->rapor->getKkm($_0xcb4a . $_0x9242 . $_0xb24f->id_tp . $_0x8c4e->id_smt . "\x31");
 }
 }
 goto L_7f9c5;
 L_2fb10:
 return view("\x6d\145\x6d\142\x65\162\x73\57\x67\165\x72\165\x2f\162\x61\160\x6f\162\x2f\156\x69\154\x61\151\x2f\160\x74\163", $_0x3548);
 L_ebc4e:
 $_0x3548["\x73\155\x74\137\x61\143\x74\151\x76\145"] = $_0x8c4e;
 goto L_9507a;
 L_929a6:
 $_0x8c4e = $this->dashboard->getSemesterActive();
 goto L_f32be;
 L_46b43:
 $_0xe20f = [];
 goto L_17886;
 L_a1c26:
 $_0x3548["\x73\155\x74"] = $this->dashboard->getSemester();
 goto L_ebc4e;
 L_395cc:
 $_0xd2ef = $this->maybe_unserialize($_0xd45f->mapel_kelas ?? "\x5b\135");
 goto L_45912;
 L_ea01e:
 $_0xfc1c = $_0x9242 ? $this->kelas->getKelasSiswa($_0x9242, $_0xb24f->id_tp, $_0x8c4e->id_smt) : [];
 goto L_52305;
 L_9507a:
 $_0x3548["\x73\145\x74\164\x69\156\x67\137\x72\141\x70\157\x72"] = $_0x238a;
 goto L_2fb10;
 L_f32be:
 $_0x7bc2 = $this->dashboard->getDataGuruByUsername($_0xfd78->username, $_0xb24f->id_tp, $_0x8c4e->id_smt);
 goto L_7b49a;
 L_f7a49:
 $_0x238a = $this->rapor->getRaporSetting($_0xb24f->id_tp, $_0x8c4e->id_smt);
 goto L_0d98e;
 L_45912:
 $_0x3bf2 = '';
 goto L_46b43;
 L_52305:
 $_0x4b03 = [];
 goto L_31c9d;
 L_7f9c5:
 $_0x3548 = ["\x75\163\x65\162" => $_0xfd78, "\x6a\165\x64\165\x6c" => "\x4e\151\x6c\141\x69\40\x50\124\x53\40\x4b\145\x6c\141\x73\40", "\x73\165\x62\152\x75\144\x75\154" => "\x49\156\x70\165\x74\40\x4e\151\x6c\141\x69\40\x50\124\x53\40\x4d\141\x70\145\x6c\40", "\x73\145\x74\164\x69\156\x67" => $this->dashboard->getSetting(), "\x67\165\x72\165" => $_0x7bc2, "\x6d\141\x70\145\x6c" => $_0x3bf2, "\x6b\145\x6c\141\x73" => $_0xe20f, "\x73\151\x73\167\x61" => $_0xfc1c, "\x6e\151\x6c\141\x69" => $_0x4b03, "\x6b\153\x6d" => $_0x13bc];
 goto L_64e55;
 L_7b49a:
 $_0xd45f = $this->kelas->getGuruMapelKelas($_0x7bc2->id_guru ?? 0, $_0xb24f->id_tp, $_0x8c4e->id_smt);
 goto L_395cc;
 L_0d98e:
 $_0x13bc = null;
 goto L_0d3f5;
 L_5ae05:
 $_0xfd78 = (object) ["\x69\144" => session()->get("\x69\144\x5f\165\x73\145\x72"), "\x75\163\x65\162\x6e\141\x6d\145" => session()->get("\x75\163\x65\162\x6e\141\x6d\145")];
 goto L_f405c;
 L_17886:
 foreach ($_0xd2ef as $_0x5482) {
 if ($_0x5482->id_mapel == $_0xcb4a) {
 $_0x3bf2 = ["\x69\144\x5f\155\x61\160\x65\154" => $_0x5482->id_mapel, "\x6e\141\x6d\141\x5f\155\x61\160\x65\154" => $_0x5482->nama_mapel];
 }
 foreach ($_0x5482->kelas_mapel as $_0xbf92) {
 if ($_0xbf92->kelas == $_0x9242) {
 $_0xe20f = ["\x69\144\x5f\153\x65\154\x61\163" => $_0xbf92->kelas, "\x6e\141\x6d\141\x5f\153\x65\154\x61\163" => $this->dropdown->getNamaKelasById($_0xb24f->id_tp, $_0x8c4e->id_smt, $_0xbf92->kelas)];
 }
 }
 }
 goto L_ea01e;
 }
 public function downloadTemplatePts($_0x22ce, $_0x92a5)
 {
 goto L_2211b;
 L_8287e:
 $_0x1307 = $this->rapor->getAllNilaiPtsKelas($_0x22ce, $_0x92a5, $_0xb5c5->id_tp, $_0xe2b5->id_smt);
 goto L_c3671;
 L_c3671:
 foreach ($_0xf220 as $_0x20d7 => $_0x1268) {
 $_0x1268->no = $_0x20d7 + 1;
 $_0x1268->no_induk = $_0x1268->nisn != null ? "\x27" . $_0x1268->nisn : "\x27" . $_0x1268->nis;
 $_0x1268->nilai = isset($_0x1307[$_0x1268->id_siswa]) ? $_0x1307[$_0x1268->id_siswa]->nilai : '';
 $_0x1268->predikat = isset($_0x1307[$_0x1268->id_siswa]) ? $_0x1307[$_0x1268->id_siswa]->predikat : '';
 }
 goto L_74050;
 L_2211b:
 $_0xb5c5 = $this->dashboard->getTahunActive();
 goto L_1d007;
 L_182dc:
 $_0xf220 = $_0x92a5 ? $this->kelas->getKelasSiswa($_0x92a5, $_0xb5c5->id_tp, $_0xe2b5->id_smt) : [];
 goto L_8287e;
 L_1d007:
 $_0xe2b5 = $this->dashboard->getSemesterActive();
 goto L_182dc;
 L_74050:
 return $this->output_json(["\x73\151\x73\167\x61" => $_0xf220]);
 }
 public function uploadNilaiPts()
 {
 goto L_7df4e;
 L_7234d:
 $_0x32ba = $this->dashboard->getTahunActive();
 goto L_33b0b;
 L_33b0b:
 $_0x8bc4 = $this->dashboard->getSemesterActive();
 goto L_30ea5;
 L_95fd2:
 return $this->output_json($_0x27ce);
 L_13b0c:
 foreach ($_0x449e as $_0xc5d7) {
 $_0xcf35 = $this->db->table("\x72\141\x70\157\x72\137\x6e\151\x6c\141\x69\137\x70\164\x73")->replace($_0xc5d7);
 if ($_0xcf35) {
 $_0x27ce++;
 }
 }
 goto L_95fd2;
 L_879d6:
 $_0x27ce = 0;
 goto L_13b0c;
 L_df451:
 $_0x3cb8 = $this->request->getPost("\x69\144\x5f\155\x61\160\x65\154");
 goto L_80a66;
 L_7df4e:
 $_0x2700 = $this->request->getPost("\x73\151\x73\167\x61");
 goto L_df451;
 L_f8aa4:
 foreach ($_0x2700 as $_0x6bb4) {
 $_0x6bb4["\x69\144\x5f\156\x69\154\x61\151\x5f\160\x74\163"] = $_0x3cb8 . $_0x585e . $_0x6bb4["\x69\144"] . $_0x32ba->id_tp . $_0x8bc4->id_smt;
 $_0x6bb4["\x69\144\x5f\163\x69\163\x77\141"] = $_0x6bb4["\x69\144"];
 $_0x6bb4["\x69\144\x5f\155\x61\160\x65\154"] = $_0x3cb8;
 $_0x6bb4["\x69\144\x5f\153\x65\154\x61\163"] = $_0x585e;
 $_0x6bb4["\x69\144\x5f\164\x70"] = $_0x32ba->id_tp;
 $_0x6bb4["\x69\144\x5f\163\x6d\164"] = $_0x8bc4->id_smt;
 unset($_0x6bb4["\x69\144"]);
 unset($_0x6bb4["\x6e\151\x73\156"]);
 unset($_0x6bb4["\x6e\141\x6d\141\x73\151\x73\167\x61"]);
 $_0x449e[] = $_0x6bb4;
 }
 goto L_879d6;
 L_80a66:
 $_0x585e = $this->request->getPost("\x69\144\x5f\153\x65\154\x61\163");
 goto L_7234d;
 L_30ea5:
 $_0x449e = [];
 goto L_f8aa4;
 }
 public function importPts()
 {
 goto L_3621a;
 L_b4812:
 return $this->response->setJSON($_0x1d4d);
 L_48d12:
 foreach ($_0xc185 as $_0xf839) {
 $_0xf5b6 = $this->db->table("\x72\141\x70\157\x72\137\x6e\151\x6c\141\x69\137\x70\164\x73")->replace($_0xf839);
 if ($_0xf5b6) {
 $_0x1d4d++;
 }
 }
 goto L_b7f9b;
 L_b7f9b:
 $this->db->transComplete();
 goto L_b4812;
 L_13632:
 $this->db->transStart();
 goto L_48d12;
 L_b5185:
 $_0x1d4d = 0;
 goto L_13632;
 L_3621a:
 $_0xc185 = $this->request->getPost("\x73\151\x73\167\x61");
 goto L_b5185;
 }
 public function inputPas($_0x63b1, $_0xb13d)
 {
 goto L_38203;
 L_9eada:
 $_0x7167 = [];
 goto L_de1e8;
 L_da8e4:
 $_0xf8bf = '';
 goto L_68cca;
 L_e8703:
 $_0x85e3 = $this->maybe_unserialize($_0x192e->mapel_kelas ?? "\x5b\135");
 goto L_da8e4;
 L_d21bf:
 foreach ($_0x85e3 as $_0x800f) {
 if ($_0x800f->id_mapel == $_0x63b1) {
 $_0xf8bf = ["\x69\144\x5f\155\x61\160\x65\154" => $_0x800f->id_mapel, "\x6e\141\x6d\141\x5f\155\x61\160\x65\154" => $_0x800f->nama_mapel];
 }
 foreach ($_0x800f->kelas_mapel as $_0x6b1f) {
 if ($_0x6b1f->kelas == $_0xb13d) {
 $_0x5879 = ["\x69\144\x5f\153\x65\154\x61\163" => $_0x6b1f->kelas, "\x6e\141\x6d\141\x5f\153\x65\154\x61\163" => $this->dropdown->getNamaKelasById($_0x8f46->id_tp, $_0xd836->id_smt, $_0x6b1f->kelas)];
 }
 }
 }
 goto L_96717;
 L_6a7f9:
 return view("\x6d\145\x6d\142\x65\162\x73\57\x67\165\x72\165\x2f\162\x61\160\x6f\162\x2f\156\x69\154\x61\151\x2f\160\x61\163", $_0x9148);
 L_96717:
 $_0xb612 = $_0xb13d ? $this->kelas->getKelasSiswa($_0xb13d, $_0x8f46->id_tp, $_0xd836->id_smt) : [];
 goto L_9eada;
 L_ab45c:
 $_0x9148["\x73\155\x74"] = $this->dashboard->getSemester();
 goto L_91426;
 L_70ce3:
 $_0x192e = $this->kelas->getGuruMapelKelas($_0x28d7->id_guru ?? 0, $_0x8f46->id_tp, $_0xd836->id_smt);
 goto L_e8703;
 L_fd7e9:
 $_0x8f46 = $this->dashboard->getTahunActive();
 goto L_2f24f;
 L_c0615:
 $_0x9148["\x74\160"] = $this->dashboard->getTahun();
 goto L_d83a8;
 L_30e8e:
 $_0x3e18 = null;
 goto L_7dbfb;
 L_7dbfb:
 if ($_0xc2bb != null) {
 if ($_0xc2bb->kkm_tunggal == "\x31") {
 $_0x3e18 = $_0xc2bb;
 } else {
 $_0x3e18 = $this->rapor->getKkm($_0x63b1 . $_0xb13d . $_0x8f46->id_tp . $_0xd836->id_smt . "\x31");
 }
 }
 goto L_db82b;
 L_e1179:
 $_0xc2bb = $this->rapor->getRaporSetting($_0x8f46->id_tp, $_0xd836->id_smt);
 goto L_30e8e;
 L_2f24f:
 $_0xd836 = $this->dashboard->getSemesterActive();
 goto L_2e0fd;
 L_38203:
 $_0x8b9b = (object) ["\x69\144" => session()->get("\x69\144\x5f\165\x73\145\x72"), "\x75\163\x65\162\x6e\141\x6d\145" => session()->get("\x75\163\x65\162\x6e\141\x6d\145")];
 goto L_fd7e9;
 L_db82b:
 $_0x9148 = ["\x75\163\x65\162" => $_0x8b9b, "\x6a\165\x64\165\x6c" => "\x4e\151\x6c\141\x69\40\x41\153\x68\151\x72\40\x4b\145\x6c\141\x73\40", "\x73\165\x62\152\x75\144\x75\154" => "\x49\156\x70\165\x74\40\x4e\151\x6c\141\x69\40\x41\153\x68\151\x72\40\x4d\141\x70\145\x6c\40", "\x73\145\x74\164\x69\156\x67" => $this->dashboard->getSetting(), "\x67\165\x72\165" => $_0x28d7, "\x6d\141\x70\145\x6c" => $_0xf8bf, "\x6b\145\x6c\141\x73" => $_0x5879, "\x73\151\x73\167\x61" => $_0xb612, "\x6e\151\x6c\141\x69" => $_0x7167, "\x6b\153\x6d" => $_0x3e18, "\x73\145\x74\164\x69\156\x67\137\x72\141\x70\157\x72" => $_0xc2bb];
 goto L_c0615;
 L_d83a8:
 $_0x9148["\x74\160\x5f\141\x63\164\x69\166\x65"] = $_0x8f46;
 goto L_ab45c;
 L_de1e8:
 for ($_0xc7ab = 0; $_0xc7ab < count($_0xb612); $_0xc7ab++) {
 $_0x6dda = $_0xb612[$_0xc7ab];
 $_0x7a50 = ["\x6e\150\x61\162" => '', "\x6e\160\x74\163" => '', "\x6e\160\x61\163" => ''];
 $_0x3681 = $this->rapor->getNilaiAkhirKelas($_0x63b1, $_0xb13d, $_0x6dda->id_siswa, $_0x8f46->id_tp, $_0xd836->id_smt);
 $_0x7167[$_0x6dda->id_siswa] = $_0x3681 == null ? $_0x7a50 : $_0x3681;
 }
 goto L_e1179;
 L_68cca:
 $_0x5879 = [];
 goto L_d21bf;
 L_2e0fd:
 $_0x28d7 = $this->dashboard->getDataGuruByUsername($_0x8b9b->username, $_0x8f46->id_tp, $_0xd836->id_smt);
 goto L_70ce3;
 L_91426:
 $_0x9148["\x73\155\x74\137\x61\143\x74\151\x76\145"] = $_0xd836;
 goto L_6a7f9;
 }
 public function downloadTemplatePas($_0xad04, $_0xf40c)
 {
 goto L_796d4;
 L_f3b3c:
 $_0x9216 = $this->rapor->getAllNilaiAkhirKelas($_0xad04, $_0xf40c, $_0xdada->id_tp, $_0x9a6a->id_smt);
 goto L_e2cdc;
 L_796d4:
 $_0xdada = $this->dashboard->getTahunActive();
 goto L_46a87;
 L_46a87:
 $_0x9a6a = $this->dashboard->getSemesterActive();
 goto L_ce29d;
 L_7080a:
 return $this->output_json(["\x73\151\x73\167\x61" => $_0x6d47]);
 L_e2cdc:
 foreach ($_0x6d47 as $_0x51be => $_0x74c1) {
 $_0x74c1->no = $_0x51be + 1;
 $_0x74c1->no_induk = $_0x74c1->nisn != null ? "\x27" . $_0x74c1->nisn : "\x27" . $_0x74c1->nis;
 $_0x74c1->nilai = isset($_0x9216[$_0x74c1->id_siswa]) ? $_0x9216[$_0x74c1->id_siswa]->npas : '';
 //$siswa->npas = isset($nilais[$siswa->id_siswa]) ? $nilais[$siswa->id_siswa]->npas : '';
 }
 goto L_7080a;
 L_ce29d:
 $_0x6d47 = $_0xf40c ? $this->kelas->getKelasSiswa($_0xf40c, $_0xdada->id_tp, $_0x9a6a->id_smt) : [];
 goto L_f3b3c;
 }
 public function uploadNilaiPas()
 {
 goto L_7ecd4;
 L_7ecd4:
 $_0xd116 = $this->request->getPost("\x73\151\x73\167\x61");
 goto L_4676d;
 L_dbbb6:
 $_0xea00 = $this->dashboard->getSemesterActive();
 goto L_e844f;
 L_e844f:
 foreach ($_0xd116 as $_0x4ab5) {
 $_0x4ab5["\x69\144\x5f\156\x69\154\x61\151\x5f\141\x6b\150\x69\162"] = $_0xc318 . $_0x7da8 . $_0x4ab5["\x69\144"] . $_0xc3c1->id_tp . $_0xea00->id_smt;
 $_0x4ab5["\x69\144\x5f\163\x69\163\x77\141"] = $_0x4ab5["\x69\144"];
 $_0x4ab5["\x69\144\x5f\155\x61\160\x65\154"] = $_0xc318;
 $_0x4ab5["\x69\144\x5f\153\x65\154\x61\163"] = $_0x7da8;
 $_0x4ab5["\x69\144\x5f\164\x70"] = $_0xc3c1->id_tp;
 $_0x4ab5["\x69\144\x5f\163\x6d\164"] = $_0xea00->id_smt;
 unset($_0x4ab5["\x69\144"]);
 unset($_0x4ab5["\x6e\151\x73\156"]);
 unset($_0x4ab5["\x6e\141\x6d\141\x73\151\x73\167\x61"]);
 $_0xb3c5[] = $_0x4ab5;
 }
 goto L_dcba7;
 L_3805d:
 foreach ($_0xb3c5 as $_0x725b) {
 $_0x78b9 = $this->db->table("\x72\141\x70\157\x72\137\x6e\151\x6c\141\x69\137\x61\153\x68\151\x72")->replace($_0x725b);
 if ($_0x78b9) {
 $_0x972f++;
 }
 }
 goto L_411a4;
 L_b4cfc:
 $_0xc3c1 = $this->dashboard->getTahunActive();
 goto L_dbbb6;
 L_7af8b:
 $_0x7da8 = $this->request->getPost("\x69\144\x5f\153\x65\154\x61\163");
 goto L_b4cfc;
 L_411a4:
 return $this->output_json($_0x972f);
 L_dcba7:
 $_0x972f = 0;
 goto L_3805d;
 L_4676d:
 $_0xc318 = $this->request->getPost("\x69\144\x5f\155\x61\160\x65\154");
 goto L_7af8b;
 L_d1f56:
 /*
 $config['upload_path'] = './uploads/import/';
 $config['allowed_types'] = 'xls|xlsx|csv';
 $config['max_size'] = 2048;
 $config['encrypt_name'] = true;
 
 // $this->load->library('upload', $config);
 
 if (!$this->upload->do_upload('upload_file')) {
 $error = $this->upload->display_errors();
 echo $error;
 die;
 } else {
 $file = $this->upload->data('full_path');
 $ext = $this->upload->data('file_ext');
 
 switch ($ext) {
 case '.xlsx':
 $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
 break;
 case '.xls':
 $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
 break;
 case '.csv':
 $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
 break;
 default:
 echo "unknown file ext";
 die;
 }
 
 $tp = $this->dashboard->getTahunActive();
 $smt = $this->dashboard->getSemesterActive();
 $siswas = $id_kelas ? $this->kelas->getKelasSiswa($id_kelas, $tp->id_tp, $smt->id_smt) : [];
 
 $spreadsheet = $reader->load($file);
 $sheetData = $spreadsheet->getActiveSheet()->toArray();
 //$sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
 $datas = [];
 $readed = 0;
 foreach ($siswas as $siswa) {
 for ($i = 1; $i < count($sheetData); $i++) {
 if ($sheetData[$i][0] != null) {
 $readed++;
 $nisn = $sheetData[$i][1];
 $no_induk = $siswa->nisn != null ? "'".$siswa->nisn : "'".$siswa->nis;
 if ($no_induk == $nisn) {
 $datas[] = ['id_nilai_akhir' => $id_mapel . $id_kelas . $siswa->id_siswa . $tp->id_tp . $smt->id_smt, 'id_siswa' => $siswa->id_siswa, 'id_mapel' => $id_mapel, 'id_kelas' => $id_kelas, 'nilai' => $sheetData[$i][3],];
 }
 }
 }
 }
 
 unlink($file);
 
 $updated = 0;
 foreach ($datas as $data) {
 $update = $this->db->table('rapor_nilai_akhir')->replace($data);
 if ($update) $updated++;
 }
 return $this->response->setJSON($updated);
 }
 */
 }
 public function importPas()
 {
 goto L_7d297;
 L_39e21:
 $this->db->transStart();
 goto L_5732c;
 L_5732c:
 foreach ($_0x4c8a as $_0x7536) {
 $_0x7fd4 = $this->db->table("\x72\141\x70\157\x72\137\x6e\151\x6c\141\x69\137\x61\153\x68\151\x72")->replace($_0x7536);
 if ($_0x7fd4) {
 $_0x9042++;
 }
 }
 goto L_d6f7a;
 L_7d297:
 $_0x4c8a = $this->request->getPost("\x73\151\x73\167\x61");
 goto L_53814;
 L_d6f7a:
 $this->db->transComplete();
 goto L_e30d6;
 L_53814:
 $_0x9042 = 0;
 goto L_39e21;
 L_e30d6:
 return $this->response->setJSON($_0x9042);
 }
 //Ekstrakurikuler
 public function inputEkstra($_0x549c, $_0x45ee)
 {
 goto L_50d8e;
 L_caa1b:
 $_0xb0fe = $this->maybe_unserialize($_0x2038->ekstra_kelas ?? "\x5b\135");
 goto L_00f69;
 L_c2a7c:
 for ($_0x88ea = 0; $_0x88ea < count($_0xd513); $_0x88ea++) {
 $_0xbcff = $_0xd513[$_0x88ea];
 $_0x4216 = ["\x70\61" => '', "\x70\62" => '', "\x70\63" => '', "\x70\64" => '', "\x70\65" => '', "\x70\66" => '', "\x70\67" => '', "\x70\70" => '', "\x70\137\x72\141\x74\141\x5f\162\x61\164\x61" => '', "\x70\137\x70\162\x65\144\x69\153\x61\164" => "\x3d", "\x70\137\x64\145\x73\153\x72\151\x70\163\x69" => '', "\x6b\61" => '', "\x6b\62" => '', "\x6b\63" => '', "\x6b\64" => '', "\x6b\65" => '', "\x6b\66" => '', "\x6b\67" => '', "\x6b\70" => '', "\x6b\137\x72\141\x74\141\x5f\162\x61\164\x61" => '', "\x6b\137\x70\162\x65\144\x69\153\x61\164" => '', "\x6b\137\x64\145\x73\153\x72\151\x70\163\x69" => ''];
 $_0xe0c9 = $this->rapor->getNilaiEkstraKelas($_0x549c, $_0x45ee, $_0xbcff->id_siswa, $_0x7223->id_tp, $_0xc2eb->id_smt);
 $_0xeba8[$_0xbcff->id_siswa] = $_0xe0c9 == null ? $_0x4216 : $_0xe0c9;
 }
 goto L_ced1f;
 L_b11b2:
 $_0xd513 = $_0x45ee ? $this->kelas->getKelasSiswa($_0x45ee, $_0x7223->id_tp, $_0xc2eb->id_smt) : [];
 goto L_52f28;
 L_ced1f:
 $_0xa6d7 = $this->rapor->getRaporSetting($_0x7223->id_tp, $_0xc2eb->id_smt);
 goto L_a601f;
 L_a601f:
 if ($_0xa6d7->kkm_tunggal == "\x31") {
 $_0x7f82 = $_0xa6d7;
 } else {
 $_0x7f82 = $this->rapor->getKkm($_0x549c . $_0x45ee . $_0x7223->id_tp . $_0xc2eb->id_smt . "\x32");
 }
 goto L_afff7;
 L_c20a7:
 $_0xc2eb = $this->dashboard->getSemesterActive();
 goto L_991df;
 L_7bf47:
 $_0xd964["\x74\160\x5f\141\x63\164\x69\166\x65"] = $_0x7223;
 goto L_04759;
 L_00f69:
 $_0x54f2 = '';
 goto L_f0d7c;
 L_53c44:
 $_0x7223 = $this->dashboard->getTahunActive();
 goto L_c20a7;
 L_a7262:
 return view("\x6d\145\x6d\142\x65\162\x73\57\x67\165\x72\165\x2f\162\x61\160\x6f\162\x2f\156\x69\154\x61\151\x2f\145\x6b\163\x74\162\x61", $_0xd964);
 L_42f05:
 $_0x2038 = $this->kelas->getGuruMapelKelas($_0x6e20->id_guru ?? 0, $_0x7223->id_tp, $_0xc2eb->id_smt);
 goto L_caa1b;
 L_88f27:
 $_0xd964["\x73\155\x74\137\x61\143\x74\151\x76\145"] = $_0xc2eb;
 goto L_a7262;
 L_991df:
 $_0x6e20 = $this->dashboard->getDataGuruByUsername($_0xe89a->username, $_0x7223->id_tp, $_0xc2eb->id_smt);
 goto L_42f05;
 L_04759:
 $_0xd964["\x73\155\x74"] = $this->dashboard->getSemester();
 goto L_88f27;
 L_8d20d:
 foreach ($_0xb0fe as $_0x512a) {
 if ($_0x512a->id_ekstra == $_0x549c) {
 $_0x54f2 = ["\x69\144\x5f\145\x6b\163\x74\162\x61" => $_0x512a->id_ekstra, "\x6e\141\x6d\141\x5f\145\x6b\163\x74\162\x61" => $_0x512a->nama_ekstra];
 }
 foreach ($_0x512a->kelas_ekstra as $_0x5434) {
 if ($_0x5434->kelas == $_0x45ee) {
 $_0x80ea = ["\x69\144\x5f\153\x65\154\x61\163" => $_0x5434->kelas, "\x6e\141\x6d\141\x5f\153\x65\154\x61\163" => $this->dropdown->getNamaKelasById($_0x7223->id_tp, $_0xc2eb->id_smt, $_0x5434->kelas)];
 }
 }
 }
 goto L_b11b2;
 L_f0d7c:
 $_0x80ea = [];
 goto L_8d20d;
 L_70a66:
 $_0xd964["\x74\160"] = $this->dashboard->getTahun();
 goto L_7bf47;
 L_afff7:
 $_0xd964 = ["\x75\163\x65\162" => $_0xe89a, "\x6a\165\x64\165\x6c" => "\x4e\151\x6c\141\x69\40\x45\153\x73\164\x72\141\x6b\165\x72\151\x6b\165\x6c\145\x72\40", "\x73\165\x62\152\x75\144\x75\154" => "\x49\156\x70\165\x74\40\x4e\151\x6c\141\x69\40\x50\124\x53\40\x45\153\x73\164\x72\141\x20", "\x73\145\x74\164\x69\156\x67" => $this->dashboard->getSetting(), "\x67\165\x72\165" => $_0x6e20, "\x65\153\x73\164\x72\141" => $_0x54f2, "\x6b\145\x6c\141\x73" => $_0x80ea, "\x73\151\x73\167\x61" => $_0xd513, "\x6e\151\x6c\141\x69" => $_0xeba8, "\x6b\153\x6d" => $_0x7f82];
 goto L_70a66;
 L_50d8e:
 $_0xe89a = (object) ["\x69\144" => session()->get("\x69\144\x5f\165\x73\145\x72"), "\x75\163\x65\162\x6e\141\x6d\145" => session()->get("\x75\163\x65\162\x6e\141\x6d\145")];
 goto L_53c44;
 L_52f28:
 $_0xeba8 = [];
 goto L_c2a7c;
 }
 public function downloadTemplateEkstra($_0x11ad, $_0x171f)
 {
 goto L_50dc3;
 L_b29fb:
 $_0x96bd = $this->rapor->getAllNilaiEkstraKelas($_0x11ad, $_0x171f, $_0x307f->id_tp, $_0x670f->id_smt);
 goto L_e11a8;
 L_ae019:
 return $this->output_json(["\x73\151\x73\167\x61" => $_0x7941]);
 L_50dc3:
 $_0x307f = $this->dashboard->getTahunActive();
 goto L_60d62;
 L_8ee65:
 $_0x7941 = $_0x171f ? $this->kelas->getKelasSiswa($_0x171f, $_0x307f->id_tp, $_0x670f->id_smt) : [];
 goto L_b29fb;
 L_e11a8:
 foreach ($_0x7941 as $_0xabb6 => $_0x60c7) {
 $_0x60c7->no = $_0xabb6 + 1;
 $_0x60c7->no_induk = $_0x60c7->nisn != null ? "\x27" . $_0x60c7->nisn : "\x27" . $_0x60c7->nis;
 $_0x60c7->nilai = isset($_0x96bd[$_0x60c7->id_siswa]) ? $_0x96bd[$_0x60c7->id_siswa]->nilai : '';
 }
 goto L_ae019;
 L_60d62:
 $_0x670f = $this->dashboard->getSemesterActive();
 goto L_8ee65;
 }
 public function uploadNilaiEkstra()
 {
 goto L_c1702;
 L_47d4f:
 foreach ($_0x68c8 as $_0x20aa) {
 $_0xc446 = $this->db->table("\x72\141\x70\157\x72\137\x6e\151\x6c\141\x69\137\x65\153\x73\164\x72\141")->replace($_0x20aa);
 if ($_0xc446) {
 $_0xa293++;
 }
 }
 goto L_854af;
 L_39773:
 $_0x81f5 = $this->request->getPost("\x69\144\x5f\145\x6b\163\x74\162\x61");
 goto L_a5b05;
 L_c1702:
 $_0xdb81 = $this->request->getPost("\x73\151\x73\167\x61");
 goto L_39773;
 L_1bf92:
 $_0xa293 = 0;
 goto L_47d4f;
 L_2d17e:
 $_0xc0e0 = $this->dashboard->getTahunActive();
 goto L_f4be0;
 L_f4be0:
 $_0x7ef3 = $this->dashboard->getSemesterActive();
 goto L_2672b;
 L_854af:
 return $this->response->setJSON($_0xa293);
 L_2672b:
 foreach ($_0xdb81 as $_0x7e56) {
 $_0x7e56["\x69\144\x5f\156\x69\154\x61\151\x5f\145\x6b\163\x74\162\x61"] = $_0x81f5 . $_0x79e4 . $_0x7e56["\x69\144"] . $_0xc0e0->id_tp . $_0x7ef3->id_smt;
 $_0x7e56["\x69\144\x5f\163\x69\163\x77\141"] = $_0x7e56["\x69\144"];
 $_0x7e56["\x69\144\x5f\145\x6b\163\x74\162\x61"] = $_0x81f5;
 $_0x7e56["\x69\144\x5f\153\x65\154\x61\163"] = $_0x79e4;
 $_0x7e56["\x69\144\x5f\164\x70"] = $_0xc0e0->id_tp;
 $_0x7e56["\x69\144\x5f\163\x6d\164"] = $_0x7ef3->id_smt;
 unset($_0x7e56["\x69\144"]);
 unset($_0x7e56["\x6e\151\x73\156"]);
 unset($_0x7e56["\x6e\141\x6d\141\x73\151\x73\167\x61"]);
 $_0x68c8[] = $_0x7e56;
 }
 goto L_1bf92;
 L_a5b05:
 $_0x79e4 = $this->request->getPost("\x69\144\x5f\153\x65\154\x61\163");
 goto L_2d17e;
 }
 public function importEkstra()
 {
 goto L_136b0;
 L_1018d:
 $_0x3cf7 = 0;
 goto L_67023;
 L_136b0:
 $_0xe989 = $this->request->getPost("\x73\151\x73\167\x61");
 goto L_1018d;
 L_ffa14:
 foreach ($_0xe989 as $_0xd035) {
 $_0x2319 = $this->db->table("\x72\141\x70\157\x72\137\x6e\151\x6c\141\x69\137\x65\153\x73\164\x72\141")->replace($_0xd035);
 if ($_0x2319) {
 $_0x3cf7++;
 }
 }
 goto L_2e046;
 L_67023:
 $this->db->transStart();
 goto L_ffa14;
 L_2e046:
 $this->db->transComplete();
 goto L_8707c;
 L_8707c:
 return $this->response->setJSON($_0x3cf7);
 }
 //END Ekstrakurikuler
 public function raporSikap()
 {
 goto L_26cb9;
 L_0dbee:
 $_0xffba = $_0x770a ? $this->raporKurmer->getDiknasCapaianList($_0x770a->id_kegiatan) : [];
 goto L_1b487;
 L_ea03a:
 list($_0x77dc, $_0x8ef1) = $this->resolveWaliKelasId($_0x6f02->username, $_0xa991->id_tp, $_0xfee1->id_smt);
 goto L_ed4dc;
 L_8ec7c:
 $_0x770a = $_0x8ef1 ? $this->raporKurmer->getDiknasKokurikulerKegiatan($_0x8ef1, $_0xa991->id_tp, $_0xfee1->id_smt) : null;
 goto L_0dbee;
 L_b9296:
 if (!empty($_0x23d1)) {
 $_0x842c = $_0x23d1[0]->is_kirim ?? 0;
 }
 goto L_8ec7c;
 L_ed4dc:
 $_0xd9a9 = $_0x8ef1 ? $this->kelas->get_one($_0x8ef1) : (object) ["\x6e\141\x6d\141\x5f\153\x65\154\x61\163" => "\x2d"];
 goto L_40ba2;
 L_083c3:
 $_0xfee1 = $this->dashboard->getSemesterActive();
 goto L_ea03a;
 L_67791:
 $_0xa8d5 = $_0x5fe7->satuan_nama;
 goto L_241fa;
 L_5f3f3:
 return view("\x6d\145\x6d\142\x65\162\x73\57\x67\165\x72\165\x2f\162\x61\160\x6f\162\x2f\163\x69\153\x61\160\x2f\144\x61\164\x61", $_0xf9fb);
 L_f27d9:
 $_0xf622 = $this->dashboard->getSetting();
 goto L_79827;
 L_26cb9:
 $_0x6f02 = (object) ["\x69\144" => session()->get("\x69\144\x5f\165\x73\145\x72"), "\x75\163\x65\162\x6e\141\x6d\145" => session()->get("\x75\163\x65\162\x6e\141\x6d\145")];
 goto L_42bb2;
 L_241fa:
 $_0x294e = $_0x5fe7->is_kemenag;
 goto L_9b06e;
 L_79827:
 $_0x5fe7 = detectSchoolType($_0xf622);
 goto L_67791;
 L_40ba2:
 $_0xd9cc = $_0x8ef1 ? $this->rapor->getDetailSiswa($_0x8ef1, $_0xa991->id_tp, $_0xfee1->id_smt) : [];
 goto L_47aa8;
 L_46409:
 $_0xf9fb = ["\x75\163\x65\162" => $_0x6f02, "\x6a\165\x64\165\x6c" => "\x50\145\x6e\151\x6c\141\x69\141\x6e\40\x4b\157\x6b\165\x72\151\x6b\165\x6c\145\x72", "\x73\165\x62\152\x75\144\x75\154" => $_0x294e ? "\x50\145\x6e\151\x6c\141\x69\141\x6e\40\x4b\157\x6b\165\x72\151\x6b\165\x6c\145\x72\40\x42\145\x72\142\x61\163\x69\163\x20\113\x65\155\x65\156\x61\147\x20\50\x44\120\x4c\40\x2f\40\x50\141\x6e\143\x61\40\x43\151\x6e\164\x61\51" : "\x50\145\x6e\151\x6c\141\x69\141\x6e\40\x4b\157\x6b\165\x72\151\x6b\165\x6c\145\x72\40\x42\145\x72\142\x61\163\x69\163\x20\113\x65\155\x65\156\x64\151\x6b\156\x61\163\x20\50\x50\65\x20\113\x75\162\x69\153\x75\154\x75\155\x20\115\x65\162\x64\145\x6b\141\x29", "\x73\145\x74\164\x69\156\x67" => $_0xf622, "\x73\141\x74\165\x61\156\x5f\156\x61\155\x61" => $_0xa8d5, "\x69\163\x5f\153\x65\155\x65\156\x61\147" => $_0x294e, "\x73\143\x68\157\x6f\154\x5f\164\x79\160\x65" => $_0xa71c, "\x69\144\x5f\153\x65\154\x61\163" => $_0x8ef1, "\x6b\145\x6c\141\x73" => $_0xd9a9, "\x73\151\x73\167\x61\163" => $_0xd9cc, "\x70\65" => $_0x8ef1 ? $this->raporKurmer->getP5Kelas($_0x8ef1, $_0xa991->id_tp, $_0xfee1->id_smt) : [], "\x6b\145\x6d\145\x6e\141\x67\137\x6b\145\x67\151\x61\164\x61\156" => $_0x23d1, "\x6b\145\x6d\145\x6e\141\x67\137\x69\163\x5f\153\x69\162\x69\155" => $_0x842c, "\x64\151\x6b\156\x61\163\x5f\153\x65\147\x69\141\x74\141\x6e" => $_0x770a, "\x64\151\x6b\156\x61\163\x5f\143\x61\160\x61\151\x61\156" => $_0xffba, "\x64\151\x6b\156\x61\163\x5f\143\x61\164\x61\164\x61\156" => $_0xd831];
 goto L_5f3f3;
 L_f069a:
 $_0x842c = 0;
 goto L_b9296;
 L_9b06e:
 $_0xa71c = $_0x5fe7->school_type;
 goto L_46409;
 L_42bb2:
 $_0xa991 = $this->dashboard->getTahunActive();
 goto L_083c3;
 L_47aa8:
 $_0x23d1 = $_0x8ef1 ? $this->raporKurmer->getKemenagKokurikulerList($_0x8ef1, $_0xa991->id_tp, $_0xfee1->id_smt) : [];
 goto L_f069a;
 L_1b487:
 $_0xd831 = $_0x770a ? $this->raporKurmer->getDiknasCatatanList($_0x770a->id_kegiatan) : [];
 goto L_f27d9;
 }
 public function saveKemenagKegiatan()
 {
 goto L_2e2d8;
 L_42630:
 $_0xc306 = $this->raporKurmer->saveKemenagKegiatan($_0x79e9);
 goto L_2a5c8;
 L_fd372:
 $_0x242d = $this->request->getPost("\x69\144\x5f\153\x65\147\x69\141\x74\141\x6e");
 goto L_6b712;
 L_83bb0:
 $_0x6441 = $this->request->getPost("\x64\145\x73\153\x72\151\x70\163\x69");
 goto L_9a51a;
 L_93db7:
 $_0x79e9 = ["\x69\144\x5f\153\x65\147\x69\141\x74\141\x6e" => $_0x242d ?: null, "\x69\144\x5f\164\x70" => $_0x10e0->id_tp, "\x69\144\x5f\163\x6d\164" => $_0xaef3->id_smt, "\x69\144\x5f\153\x65\154\x61\163" => $_0x30ed, "\x64\160\x6c\137\x70\141\x6e\143\x61\137\x63\151\x6e\164\x61" => trim($_0xd5c8), "\x64\145\x73\153\x72\151\x70\163\x69" => trim($_0x6441)];
 goto L_42630;
 L_2e2d8:
 $_0x10e0 = $this->dashboard->getTahunActive();
 goto L_730c1;
 L_730c1:
 $_0xaef3 = $this->dashboard->getSemesterActive();
 goto L_26ff2;
 L_6b712:
 $_0xd5c8 = $this->request->getPost("\x64\160\x6c\137\x70\141\x6e\143\x61\137\x63\151\x6e\164\x61");
 goto L_83bb0;
 L_26ff2:
 $_0x30ed = $this->request->getPost("\x69\144\x5f\153\x65\154\x61\163");
 goto L_fd372;
 L_2a5c8:
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => true, "\x69\144" => $_0xc306, "\x6d\145\x73\163\x61\147\x65" => "\x4b\145\x67\151\x61\164\x61\156\x20\153\x6f\153\x75\162\x69\153\x75\154\x65\162\x20\142\x65\162\x68\141\x73\151\x6c\40\x64\151\x73\151\x6d\160\x61\156"]);
 L_9a51a:
 if (empty($_0xd5c8) || empty($_0x6441)) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x44\120\x4c\40\x2f\40\x50\141\x6e\143\x61\40\x43\151\x6e\164\x61\40\x64\141\x6e\40\x44\145\x73\153\x72\151\x70\163\x69\40\x68\141\x72\165\x73\40\x64\151\x69\163\x69"]);
 }
 goto L_93db7;
 }
 public function deleteKemenagKegiatan()
 {
 goto L_0c10e;
 L_ec072:
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => true, "\x6d\145\x73\163\x61\147\x65" => "\x4b\145\x67\151\x61\164\x61\156\x20\153\x6f\153\x75\162\x69\153\x75\154\x65\162\x20\142\x65\162\x68\141\x73\151\x6c\40\x64\151\x68\141\x70\165\x73"]);
 L_0c10e:
 $_0xcd4e = $this->request->getPost("\x69\144\x5f\153\x65\147\x69\141\x74\141\x6e");
 goto L_cbc2e;
 L_cbc2e:
 if (empty($_0xcd4e)) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x49\104\x20\113\x65\147\x69\141\x74\141\x6e\40\x74\151\x64\141\x6b\40\x76\141\x6c\151\x64"]);
 }
 goto L_e7278;
 L_e7278:
 $this->raporKurmer->deleteKemenagKegiatan($_0xcd4e);
 goto L_ec072;
 }
 public function getKemenagNilai($_0x5df1)
 {
 goto L_d653c;
 L_9bf90:
 $_0x5068 = $this->rapor->getDetailSiswa($_0x5bc6->id_kelas, $_0xd5c3->id_tp, $_0x6cbd->id_smt);
 goto L_67496;
 L_c6794:
 $_0x6cbd = $this->dashboard->getSemesterActive();
 goto L_9f5f1;
 L_d653c:
 $_0x6457 = (object) ["\x69\144" => session()->get("\x69\144\x5f\165\x73\145\x72"), "\x75\163\x65\162\x6e\141\x6d\145" => session()->get("\x75\163\x65\162\x6e\141\x6d\145")];
 goto L_83a77;
 L_9f5f1:
 $_0x5bc6 = $this->db->table("\x72\141\x70\157\x72\137\x6b\145\x6d\145\x6e\141\x67\137\x6b\157\x6b\165\x72\151\x6b\165\x6c\145\x72")->where("\x69\144\x5f\153\x65\147\x69\141\x74\141\x6e", $_0x5df1)->get()->getRow();
 goto L_eda12;
 L_83a77:
 $_0xd5c3 = $this->dashboard->getTahunActive();
 goto L_c6794;
 L_67496:
 $_0xbce4 = $this->raporKurmer->getKemenagNilaiMap($_0x5df1);
 goto L_31932;
 L_eda12:
 if (!$_0x5bc6) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x4b\145\x67\151\x61\164\x61\156\x20\164\x69\144\x61\153\x20\144\x69\164\x65\155\x75\153\x61\156"]);
 }
 goto L_9bf90;
 L_31932:
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => true, "\x6b\145\x67\151\x61\164\x61\156" => $_0x5bc6, "\x73\151\x73\167\x61\163" => $_0x5068, "\x6e\151\x6c\141\x69\137\x6d\141\x70" => $_0xbce4]);
 }
 public function saveKemenagNilai()
 {
 goto L_a6b9c;
 L_0bd4b:
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => true, "\x6d\145\x73\163\x61\147\x65" => "\x4e\151\x6c\141\x69\40\x6b\157\x6b\165\x72\151\x6b\165\x6c\145\x72\40\x62\145\x72\150\x61\163\x69\154\x20\144\x69\163\x69\155\x70\141\x6e"]);
 L_5add5:
 $_0x644b = $this->request->getPost("\x6e\151\x6c\141\x69") ?? [];
 goto L_abb2e;
 L_abb2e:
 if (empty($_0x9164)) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x4b\145\x67\151\x61\164\x61\156\x20\164\x69\144\x61\153\x20\166\x61\154\x69\144"]);
 }
 goto L_c01a1;
 L_a6b9c:
 $_0x9164 = $this->request->getPost("\x69\144\x5f\153\x65\147\x69\141\x74\141\x6e");
 goto L_5add5;
 L_c01a1:
 $this->raporKurmer->saveKemenagNilaiMassal($_0x9164, $_0x644b);
 goto L_0bd4b;
 }
 public function toggleKemenagKirim()
 {
 goto L_e3f80;
 L_95443:
 $_0xf5ce = $this->request->getPost("\x69\144\x5f\153\x65\154\x61\163");
 goto L_44f0e;
 L_bc4f5:
 $_0xa515 = $_0xb1fb === 1 ? "\x4e\151\x6c\141\x69\40\x70\162\x6f\171\x65\153\x20\153\x6f\153\x75\162\x69\153\x75\154\x65\162\x20\142\x65\162\x68\141\x73\151\x6c\40\x64\151\x6b\151\x72\151\x6d\56" : "\x50\145\x6e\147\x69\162\x69\155\x61\156\x20\156\x69\154\x61\151\x20\153\x6f\153\x75\162\x69\153\x75\154\x65\162\x20\142\x65\162\x68\141\x73\151\x6c\40\x64\151\x62\141\x74\141\x6c\153\x61\156\x2e";
 goto L_37c6b;
 L_37c6b:
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => true, "\x69\163\x5f\153\x69\162\x69\155" => $_0xb1fb, "\x6d\145\x73\163\x61\147\x65" => $_0xa515]);
 L_44f0e:
 $_0xb1fb = (int) $this->request->getPost("\x73\164\x61\164\x75\163");
 goto L_73772;
 L_73772:
 // 1 = Kirim, 0 = Batal Kirim
 $this->raporKurmer->toggleKemenagKirim($_0xf5ce, $_0xbbdf->id_tp, $_0xecaf->id_smt, $_0xb1fb);
 goto L_bc4f5;
 L_e3f80:
 $_0xbbdf = $this->dashboard->getTahunActive();
 goto L_3f483;
 L_3f483:
 $_0xecaf = $this->dashboard->getSemesterActive();
 goto L_95443;
 }
 public function saveDiknasKegiatan()
 {
 goto L_cf05d;
 L_ef934:
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => true, "\x69\144" => $_0x7ff9, "\x6d\145\x73\163\x61\147\x65" => "\x4b\145\x67\151\x61\164\x61\156\x20\153\x6f\153\x75\162\x69\153\x75\154\x65\162\x20\142\x65\162\x68\141\x73\151\x6c\40\x64\151\x73\151\x6d\160\x61\156"]);
 L_7484e:
 $_0xad5f = $this->request->getPost("\x6b\157\x6f\162\x64\151\x6e\141\x74\157\x72");
 goto L_9a333;
 L_cf05d:
 $_0xbcb2 = $this->dashboard->getTahunActive();
 goto L_962c7;
 L_649d4:
 $_0x2dbe = $this->request->getPost("\x69\144\x5f\153\x65\154\x61\163");
 goto L_17bb6;
 L_de5aa:
 $_0xe784 = $this->request->getPost("\x6e\141\x6d\141\x5f\153\x65\154\x6f\155\x70\157\x6b");
 goto L_8540c;
 L_9a333:
 if (empty($_0x4a73)) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x4e\141\x6d\141\x20\153\x65\147\x69\141\x74\141\x6e\40\x68\141\x72\165\x73\40\x64\151\x69\163\x69"]);
 }
 goto L_c5177;
 L_43842:
 $_0x4a73 = $this->request->getPost("\x6e\141\x6d\141\x5f\153\x65\147\x69\141\x74\141\x6e");
 goto L_4e114;
 L_4e114:
 $_0xb6a2 = $this->request->getPost("\x64\145\x73\153\x72\151\x70\163\x69");
 goto L_7484e;
 L_8540c:
 $_0x9e2e = $this->request->getPost("\x74\145\x6d\141");
 goto L_43842;
 L_962c7:
 $_0xd4e9 = $this->dashboard->getSemesterActive();
 goto L_649d4;
 L_c5177:
 $_0x7399 = ["\x69\144\x5f\153\x65\147\x69\141\x74\141\x6e" => $_0xc053 ?: null, "\x69\144\x5f\164\x70" => $_0xbcb2->id_tp, "\x69\144\x5f\163\x6d\164" => $_0xd4e9->id_smt, "\x69\144\x5f\153\x65\154\x61\163" => $_0x2dbe, "\x6e\141\x6d\141\x5f\153\x65\154\x6f\155\x70\157\x6b" => trim($_0xe784 ?: "\x4b\145\x6c\157\x6d\160\x6f\153\x20\61"), "\x74\145\x6d\141" => trim($_0x9e2e ?: "\x4b\145\x61\162\x69\146\x61\156\x20\114\x6f\153\x61\154"), "\x6e\141\x6d\141\x5f\153\x65\147\x69\141\x74\141\x6e" => trim($_0x4a73), "\x64\145\x73\153\x72\151\x70\163\x69" => trim($_0xb6a2 ?? ''), "\x6b\157\x6f\162\x64\151\x6e\141\x74\157\x72" => trim($_0xad5f ?? '')];
 goto L_faf55;
 L_faf55:
 $_0x7ff9 = $this->raporKurmer->saveDiknasKokurikulerKegiatan($_0x7399);
 goto L_ef934;
 L_17bb6:
 $_0xc053 = $this->request->getPost("\x69\144\x5f\153\x65\147\x69\141\x74\141\x6e");
 goto L_de5aa;
 }
 public function saveDiknasCapaian()
 {
 goto L_bfc33;
 L_b21d8:
 $_0xb096 = $this->request->getPost("\x64\151\x6d\145\x6e\163\x69\137\x69\144");
 goto L_788ac;
 L_00988:
 $_0xe062 = $this->request->getPost("\x63\141\x70\141\x69\141\x6e\137\x61\153\x68\151\x72");
 goto L_18be6;
 L_25bc7:
 $_0xaedc = $this->raporKurmer->saveDiknasCapaian($_0xedfd);
 goto L_e6854;
 L_bfc33:
 $_0xb039 = $this->request->getPost("\x69\144\x5f\153\x65\147\x69\141\x74\141\x6e");
 goto L_a60ff;
 L_e6854:
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => true, "\x69\144" => $_0xaedc, "\x6d\145\x73\163\x61\147\x65" => "\x43\141\x70\141\x69\141\x6e\40\x70\162\x6f\146\x69\154\x20\142\x65\162\x68\141\x73\151\x6c\40\x64\151\x73\151\x6d\160\x61\156"]);
 L_18be6:
 $_0x1664 = $this->request->getPost("\x75\162\x75\164\x61\156");
 goto L_952f9;
 L_a60ff:
 $_0xc601 = $this->request->getPost("\x69\144\x5f\143\x61\160\x61\151\x61\156");
 goto L_b21d8;
 L_952f9:
 if (empty($_0xb039) || empty($_0xe062)) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x43\141\x70\141\x69\141\x6e\40\x61\153\x68\151\x72\40\x68\141\x72\165\x73\40\x64\151\x69\163\x69"]);
 }
 goto L_ac0a8;
 L_ac0a8:
 $_0xedfd = ["\x69\144\x5f\143\x61\160\x61\151\x61\156" => $_0xc601 ?: null, "\x69\144\x5f\153\x65\147\x69\141\x74\141\x6e" => $_0xb039, "\x64\151\x6d\145\x6e\163\x69\137\x69\144" => $_0xb096 ?: 1, "\x64\151\x6d\145\x6e\163\x69" => trim($_0x6464 ?: "\x4b\145\x69\155\x61\156\x61\156\x20\144\x61\156\x20\113\x65\164\x61\153\x77\141\x61\156\x20\164\x65\162\x68\141\x64\141\x70\40\x54\165\x68\141\x6e\40\x59\115\x45"), "\x63\141\x70\141\x69\141\x6e\137\x61\153\x68\151\x72" => trim($_0xe062), "\x75\162\x75\164\x61\156" => $_0x1664 ?: 1];
 goto L_25bc7;
 L_788ac:
 $_0x6464 = $this->request->getPost("\x64\151\x6d\145\x6e\163\x69");
 goto L_00988;
 }
 public function deleteDiknasCapaian()
 {
 goto L_e4ce0;
 L_e4ce0:
 $_0xd1c1 = $this->request->getPost("\x69\144\x5f\143\x61\160\x61\151\x61\156");
 goto L_0fb84;
 L_0fb84:
 if (empty($_0xd1c1)) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x49\104\x20\103\x61\160\x61\151\x61\156\x20\164\x69\144\x61\153\x20\166\x61\154\x69\144"]);
 }
 goto L_bcbb7;
 L_bcbb7:
 $this->raporKurmer->deleteDiknasCapaian($_0xd1c1);
 goto L_72f62;
 L_72f62:
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => true, "\x6d\145\x73\163\x61\147\x65" => "\x43\141\x70\141\x69\141\x6e\40\x62\145\x72\150\x61\163\x69\154\x20\144\x69\150\x61\160\x75\163"]);
 }
 public function getDiknasNilai($_0xd948, $_0x3fcf)
 {
 goto L_dcae6;
 L_1ef34:
 $_0x13ea = $this->db->table("\x72\141\x70\157\x72\137\x64\151\x6b\156\x61\163\x5f\153\x6f\153\x75\162\x69\153\x75\154\x65\162\x5f\153\x65\147\x69\141\x74\141\x6e")->where("\x69\144\x5f\153\x65\147\x69\141\x74\141\x6e", $_0xd948)->get()->getRow();
 goto L_9e7ef;
 L_a7046:
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => true, "\x6b\145\x67\151\x61\164\x61\156" => $_0x13ea, "\x73\151\x73\167\x61\163" => $_0x3db2, "\x6e\151\x6c\141\x69\137\x6d\141\x70" => $_0x1dab]);
 L_a8e96:
 $_0x3db2 = $this->rapor->getDetailSiswa($_0x13ea->id_kelas, $_0x73e1->id_tp, $_0xc329->id_smt);
 goto L_ec94d;
 L_ec94d:
 $_0x1dab = $this->raporKurmer->getDiknasNilaiMap($_0xd948, $_0x3fcf);
 goto L_a7046;
 L_97adb:
 $_0xc329 = $this->dashboard->getSemesterActive();
 goto L_1ef34;
 L_dcae6:
 $_0x73e1 = $this->dashboard->getTahunActive();
 goto L_97adb;
 L_9e7ef:
 if (!$_0x13ea) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x4b\145\x67\151\x61\164\x61\156\x20\164\x69\144\x61\153\x20\144\x69\164\x65\155\x75\153\x61\156"]);
 }
 goto L_a8e96;
 }
 public function saveDiknasNilai()
 {
 goto L_2f385;
 L_47df6:
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => true, "\x6d\145\x73\163\x61\147\x65" => "\x4e\151\x6c\141\x69\40\x70\162\x65\144\x69\153\x61\164\x20\144\x61\156\x20\144\x65\163\x6b\162\x69\160\x73\151\x20\156\x61\162\x61\163\x69\40\x62\145\x72\150\x61\163\x69\154\x20\144\x69\163\x69\155\x70\141\x6e\40\x26\40\x64\151\x73\151\x6e\153\x72\157\x6e\153\x61\156"]);
 L_cfd5f:
 if (empty($_0x4e9a) || empty($_0x8deb)) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x4b\145\x67\151\x61\164\x61\156\x20\144\x61\156\x20\143\x61\160\x61\151\x61\156\x20\164\x69\144\x61\153\x20\166\x61\154\x69\144"]);
 }
 goto L_3569f;
 L_86b24:
 $_0x74aa = $this->request->getPost("\x6e\151\x6c\141\x69") ?? [];
 goto L_cfd5f;
 L_2f385:
 $_0x4e9a = $this->request->getPost("\x69\144\x5f\153\x65\147\x69\141\x74\141\x6e");
 goto L_fa98f;
 L_fa98f:
 $_0x8deb = $this->request->getPost("\x69\144\x5f\143\x61\160\x61\151\x61\156");
 goto L_86b24;
 L_3569f:
 $this->raporKurmer->saveDiknasNilaiMassal($_0x4e9a, $_0x8deb, $_0x74aa);
 goto L_47df6;
 }
 public function getDiknasCatatan($_0xf265)
 {
 goto L_a4fb5;
 L_a4fb5:
 $_0x5fa1 = $this->dashboard->getTahunActive();
 goto L_15832;
 L_0082b:
 $_0x6198 = $this->rapor->getDetailSiswa($_0x4fc0->id_kelas, $_0x5fa1->id_tp, $_0xfbc7->id_smt);
 goto L_61dae;
 L_e24b1:
 $_0x4fc0 = $this->db->table("\x72\141\x70\157\x72\137\x64\151\x6b\156\x61\163\x5f\153\x6f\153\x75\162\x69\153\x75\154\x65\162\x5f\153\x65\147\x69\141\x74\141\x6e")->where("\x69\144\x5f\153\x65\147\x69\141\x74\141\x6e", $_0xf265)->get()->getRow();
 goto L_9e48a;
 L_61dae:
 $_0xaa66 = $this->raporKurmer->getDiknasCatatanList($_0xf265);
 goto L_e86ab;
 L_cf541:
 $_0xaa66 = $this->raporKurmer->getDiknasCatatanList($_0xf265);
 goto L_209da;
 L_209da:
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => true, "\x6b\145\x67\151\x61\164\x61\156" => $_0x4fc0, "\x73\151\x73\167\x61\163" => $_0x6198, "\x63\141\x74\141\x74\141\x6e\137\x6d\141\x70" => $_0xaa66]);
 L_e86ab:
 // Jika ada siswa yang belum punya catatan, otomatis generate
 foreach ($_0x6198 as $_0x6880) {
 if (empty($_0xaa66[$_0x6880->id_siswa])) {
 $this->raporKurmer->syncDiknasNarasiSiswa($_0xf265, $_0x6880->id_siswa);
 }
 }
 goto L_cf541;
 L_15832:
 $_0xfbc7 = $this->dashboard->getSemesterActive();
 goto L_e24b1;
 L_9e48a:
 if (!$_0x4fc0) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x4b\145\x67\151\x61\164\x61\156\x20\164\x69\144\x61\153\x20\144\x69\164\x65\155\x75\153\x61\156"]);
 }
 goto L_0082b;
 }
 public function saveDiknasCatatan()
 {
 goto L_f8da9;
 L_f8da9:
 $_0x65b7 = $this->request->getPost("\x69\144\x5f\153\x65\147\x69\141\x74\141\x6e");
 goto L_fd6c9;
 L_fd6c9:
 $_0xb605 = $this->request->getPost("\x63\141\x74\141\x74\141\x6e") ?? [];
 goto L_278b0;
 L_70a36:
 $this->raporKurmer->saveDiknasCatatanMassal($_0x65b7, $_0xb605);
 goto L_41abc;
 L_278b0:
 if (empty($_0x65b7)) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x4b\145\x67\151\x61\164\x61\156\x20\164\x69\144\x61\153\x20\166\x61\154\x69\144"]);
 }
 goto L_70a36;
 L_41abc:
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => true, "\x6d\145\x73\163\x61\147\x65" => "\x44\145\x73\153\x72\151\x70\163\x69\40\x63\141\x70\141\x69\141\x6e\40\x6b\157\x6b\165\x72\151\x6b\165\x6c\145\x72\40\x62\145\x72\150\x61\163\x69\154\x20\144\x69\163\x69\155\x70\141\x6e"]);
 }
 public function saveP5()
 {
 goto L_b911e;
 L_5ce80:
 $_0x88c3 = $this->dashboard->getSemesterActive();
 goto L_43dca;
 L_43dca:
 $_0xf8d3 = $this->request->getPost("\x69\144\x5f\153\x65\154\x61\163");
 goto L_d1c36;
 L_d1c36:
 $_0xaf12 = $this->request->getPost("\x73\151\x73\167\x61") ?? [];
 goto L_41b9e;
 L_b911e:
 $_0xd8de = $this->dashboard->getTahunActive();
 goto L_5ce80;
 L_8b84a:
 return $this->output_json(["\x73\164\x61\164\x75\163" => true]);
 L_41b9e:
 foreach ($_0xaf12 as $_0x7373 => $_0xbab8) {
 $_0xb1d7 = ["\x69\144\x5f\164\x70" => $_0xd8de->id_tp, "\x69\144\x5f\163\x6d\164" => $_0x88c3->id_smt, "\x69\144\x5f\153\x65\154\x61\163" => $_0xf8d3, "\x69\144\x5f\163\x69\163\x77\141" => $_0x7373, "\x74\145\x6d\141" => $_0xbab8["\x74\145\x6d\141"] ?? null, "\x64\145\x73\153\x72\151\x70\163\x69" => $_0xbab8["\x64\145\x73\153\x72\151\x70\163\x69"] ?? null];
 $this->raporKurmer->saveP5($_0xb1d7);
 }
 goto L_8b84a;
 }
 public function saveSikap()
 {
 goto L_2bf2e;
 L_f4f00:
 $_0x2168["\x73\164\x61\164\x75\163"] = $_0xc584;
 goto L_a46ff;
 L_95061:
 $_0x785c = $this->dashboard->getSemesterActive();
 goto L_f0cd3;
 L_f0cd3:
 foreach ($_0x9ff2 as $_0xc416) {
 $_0x2168 = ["\x69\144\x5f\163\x69\153\x61\160" => $_0xc416->id_sikap, "\x69\144\x5f\153\x65\154\x61\163" => $_0xc416->kelas, "\x6a\145\x6e\151\x73" => $_0xc416->jenis, "\x6b\157\x64\145" => $_0xc416->kode, "\x73\151\x6b\141\x70" => $_0xc416->sikap, "\x69\144\x5f\164\x70" => $_0xc122->id_tp, "\x69\144\x5f\163\x6d\164" => $_0x785c->id_smt];
 $_0xc584 = $this->db->table("\x72\141\x70\157\x72\137\x64\141\x74\141\x5f\163\x69\153\x61\160")->replace($_0x2168);
 }
 goto L_f4f00;
 L_a46ff:
 return $this->output_json($_0x2168);
 L_2bf2e:
 $_0x9ff2 = json_decode($this->request->getPost("\x73\151\x6b\141\x70"));
 goto L_0ef94;
 L_0ef94:
 $_0xc122 = $this->dashboard->getTahunActive();
 goto L_95061;
 }
 public function raporSpiritual()
 {
 goto L_7e551;
 L_dfe86:
 list($_0xf161, $_0xe12f) = $this->resolveWaliKelasId($_0xeed2->username, $_0xc64f->id_tp, $_0x7687->id_smt);
 goto L_38082;
 L_8af4e:
 for ($_0xab54 = 0; $_0xab54 < count($_0xe16d); $_0xab54++) {
 $_0x61e2 = $_0xe16d[$_0xab54];
 $_0x7105 = ["\x70\162\x65\144\x69\153\x61\164" => '', "\x73\154\x31" => '', "\x73\154\x32" => '', "\x73\154\x33" => '', "\x6d\142\x31" => '', "\x6d\142\x32" => '', "\x6d\142\x33" => ''];
 $_0x3dd4 = $this->rapor->getNilaiSikapKelas($_0xe12f, $_0x61e2->id_siswa, $_0xc64f->id_tp, $_0x7687->id_smt, "\x31");
 $_0x386e[$_0x61e2->id_siswa] = $_0x3dd4 == null ? $_0x7105 : $this->maybe_unserialize($_0x3dd4->nilai);
 }
 goto L_5931c;
 L_b56e9:
 $_0xe16d = $_0xe12f ? $this->kelas->getKelasSiswa($_0xe12f, $_0xc64f->id_tp, $_0x7687->id_smt) : [];
 goto L_7fbb6;
 L_2802d:
 for ($_0xab54 = 0; $_0xab54 < 10; $_0xab54++) {
 $_0x71a7 = $_0xab54 + 1;
 $_0x8a04 = ["\x69\144\x5f\163\x69\153\x61\160" => $_0xe12f . 1 . $_0x71a7, "\x6a\145\x6e\151\x73" => "\x31", "\x6b\157\x64\145" => $_0x71a7, "\x73\151\x6b\141\x70" => $this->rapor->getDummyDeskripsiSpiritual()[$_0xab54]];
 array_push($_0x6658, $_0x8a04);
 }
 goto L_2aa4c;
 L_78d17:
 $_0x7687 = $this->dashboard->getSemesterActive();
 goto L_dfe86;
 L_79f3e:
 $_0xbfeb["\x74\160\x5f\141\x63\164\x69\166\x65"] = $_0xc64f;
 goto L_385b5;
 L_b9810:
 $_0xc64f = $this->dashboard->getTahunActive();
 goto L_78d17;
 L_385b5:
 $_0xbfeb["\x73\155\x74"] = $this->dashboard->getSemester();
 goto L_3f097;
 L_5dcb8:
 $_0x6658 = [];
 goto L_2802d;
 L_3eabc:
 $_0xbfeb["\x74\160"] = $this->dashboard->getTahun();
 goto L_79f3e;
 L_7e551:
 $_0xeed2 = (object) ["\x69\144" => session()->get("\x69\144\x5f\165\x73\145\x72"), "\x75\163\x65\162\x6e\141\x6d\145" => session()->get("\x75\163\x65\162\x6e\141\x6d\145")];
 goto L_b9810;
 L_f1814:
 return view("\x6d\145\x6d\142\x65\162\x73\57\x67\165\x72\165\x2f\162\x61\160\x6f\162\x2f\163\x69\153\x61\160\x2f\163\x70\151\x72\151\x74\165\x61\154", $_0xbfeb);
 L_38082:
 $_0x71b7 = $_0xe12f ? $this->kelas->get_one($_0xe12f, $_0xc64f->id_tp, $_0x7687->id_smt) : (object) ["\x6e\141\x6d\141\x5f\153\x65\154\x61\163" => "\x2d"];
 goto L_5dcb8;
 L_5931c:
 $_0xbfeb = ["\x75\163\x65\162" => $_0xeed2, "\x6a\165\x64\165\x6c" => "\x4e\151\x6c\141\x69\40\x53\160\x69\162\x69\164\x75\141\x6c\40\x4b\145\x6c\141\x73\40", "\x73\165\x62\152\x75\144\x75\154" => "\x49\156\x70\165\x74\40\x4e\151\x6c\141\x69", "\x73\145\x74\164\x69\156\x67" => $this->dashboard->getSetting(), "\x67\165\x72\165" => $_0xf161, "\x6b\145\x6c\141\x73" => $_0x71b7, "\x73\151\x73\167\x61" => $_0xe16d, "\x6e\151\x6c\141\x69" => $_0x386e, "\x73\160\x69\162\x69\164\x75\141\x6c" => $_0x46d2];
 goto L_3eabc;
 L_370ca:
 if (count($_0x46d2) == 0) {
 $_0x46d2 = json_decode(json_encode($_0x6658));
 }
 goto L_b56e9;
 L_2aa4c:
 $_0x46d2 = $this->rapor->getDeskripsiSikapByJenis($_0xe12f, "\x31", $_0xc64f->id_tp, $_0x7687->id_smt);
 goto L_370ca;
 L_3f097:
 $_0xbfeb["\x73\155\x74\137\x61\143\x74\151\x76\145"] = $_0x7687;
 goto L_f1814;
 L_7fbb6:
 $_0x386e = [];
 goto L_8af4e;
 }
 public function importSpiritual($_0x2cdd)
 {
 goto L_738df;
 L_bc41d:
 foreach ($_0x3a23 as $_0xfbbd) {
 $_0xf632 = $this->db->table("\x72\141\x70\157\x72\137\x6e\151\x6c\141\x69\137\x73\151\x6b\141\x70")->replace($_0xfbbd);
 if ($_0xf632) {
 $_0x19a4++;
 }
 }
 goto L_b35c5;
 L_2a8bc:
 foreach ($_0xcb09 as $_0x6c48) {
 $_0x4b8f = $_0x6c48[11];
 if ($_0x4b8f != "\x69\144") {
 $_0x3a23[] = ["\x69\144\x5f\156\x69\154\x61\151\x5f\163\x69\153\x61\160" => $_0x2cdd . $_0x4b8f . $_0xeb68->id_tp . $_0xabd8->id_smt . "\x31", "\x69\144\x5f\163\x69\163\x77\141" => $_0x4b8f, "\x69\144\x5f\153\x65\154\x61\163" => $_0x2cdd, "\x6a\145\x6e\151\x73" => 1, "\x6e\151\x6c\141\x69" => json_encode(["\x70\162\x65\144\x69\153\x61\164" => $_0x6c48[3], "\x73\154\x31" => $_0x6c48[4], "\x73\154\x32" => $_0x6c48[5], "\x73\154\x33" => $_0x6c48[6], "\x6d\142\x31" => $_0x6c48[7], "\x6d\142\x32" => $_0x6c48[8], "\x6d\142\x33" => $_0x6c48[9]]), "\x64\145\x73\153\x72\151\x70\163\x69" => $_0x6c48[10], "\x69\144\x5f\164\x70" => $_0xeb68->id_tp, "\x69\144\x5f\163\x6d\164" => $_0xabd8->id_smt];
 }
 }
 goto L_0e1bc;
 L_f8b31:
 $_0x3a23 = [];
 goto L_2a8bc;
 L_675b9:
 $_0xeb68 = $this->dashboard->getTahunActive();
 goto L_83b37;
 L_0e1bc:
 $_0x19a4 = 0;
 goto L_bc41d;
 L_83b37:
 $_0xabd8 = $this->dashboard->getSemesterActive();
 goto L_f8b31;
 L_738df:
 $_0xcb09 = json_decode($this->request->getPost("\x6e\151\x6c\141\x69"));
 goto L_675b9;
 L_b35c5:
 return $this->response->setJSON($_0x19a4);
 }
 public function raporSosial()
 {
 goto L_c2573;
 L_c2573:
 $_0xa332 = (object) ["\x69\144" => session()->get("\x69\144\x5f\165\x73\145\x72"), "\x75\163\x65\162\x6e\141\x6d\145" => session()->get("\x75\163\x65\162\x6e\141\x6d\145")];
 goto L_63f4d;
 L_e03b8:
 $_0xc470 = [];
 goto L_863d5;
 L_92946:
 $_0xe2a6["\x74\160"] = $this->dashboard->getTahun();
 goto L_db8bb;
 L_60108:
 $_0xc599 = $_0x32ab ? $this->kelas->get_one($_0x32ab, $_0x62cc->id_tp, $_0x35bc->id_smt) : (object) ["\x6e\141\x6d\141\x5f\153\x65\154\x61\163" => "\x2d"];
 goto L_e03b8;
 L_010fa:
 $_0x35bc = $this->dashboard->getSemesterActive();
 goto L_fd715;
 L_db8bb:
 $_0xe2a6["\x74\160\x5f\141\x63\164\x69\166\x65"] = $_0x62cc;
 goto L_9164a;
 L_363d2:
 $_0xe2a6["\x73\155\x74\137\x61\143\x74\151\x76\145"] = $_0x35bc;
 goto L_3f987;
 L_286be:
 if (count($_0x8362) == 0) {
 $_0x8362 = json_decode(json_encode($_0xc470));
 }
 goto L_ccfb7;
 L_ca9c2:
 for ($_0x78d0 = 0; $_0x78d0 < count($_0xdfbd); $_0x78d0++) {
 $_0x8050 = $_0xdfbd[$_0x78d0];
 $_0x90b7 = ["\x70\162\x65\144\x69\153\x61\164" => '', "\x73\154\x31" => '', "\x73\154\x32" => '', "\x73\154\x33" => '', "\x6d\142\x31" => '', "\x6d\142\x32" => '', "\x6d\142\x33" => ''];
 $_0xdc66 = $this->rapor->getNilaiSikapKelas($_0x32ab, $_0x8050->id_siswa, $_0x62cc->id_tp, $_0x35bc->id_smt, "\x32");
 $_0xd9dc[$_0x8050->id_siswa] = $_0xdc66 == null ? $_0x90b7 : $this->maybe_unserialize($_0xdc66->nilai);
 }
 goto L_3f696;
 L_3f696:
 $_0xe2a6 = ["\x75\163\x65\162" => $_0xa332, "\x6a\165\x64\165\x6c" => "\x4e\151\x6c\141\x69\40\x53\157\x73\151\x61\154\x20\113\x65\154\x61\163\x20", "\x73\165\x62\152\x75\144\x75\154" => "\x49\156\x70\165\x74\40\x4e\151\x6c\141\x69\40\x50\124\x53\40\x4d\141\x70\145\x6c\40", "\x73\145\x74\164\x69\156\x67" => $this->dashboard->getSetting(), "\x67\165\x72\165" => $_0x7ecf, "\x6b\145\x6c\141\x73" => $_0xc599, "\x73\151\x73\167\x61" => $_0xdfbd, "\x6e\151\x6c\141\x69" => $_0xd9dc, "\x73\157\x73\151\x61\154" => $_0x8362];
 goto L_92946;
 L_3f987:
 return view("\x6d\145\x6d\142\x65\162\x73\57\x67\165\x72\165\x2f\162\x61\160\x6f\162\x2f\163\x69\153\x61\160\x2f\163\x6f\163\x69\141\x6c", $_0xe2a6);
 L_7462b:
 $_0x8362 = $this->rapor->getDeskripsiSikapByJenis($_0x32ab, "\x32", $_0x62cc->id_tp, $_0x35bc->id_smt);
 goto L_286be;
 L_863d5:
 for ($_0x78d0 = 0; $_0x78d0 < 10; $_0x78d0++) {
 $_0x91c6 = $_0x78d0 + 1;
 $_0x9e15 = ["\x69\144\x5f\163\x69\153\x61\160" => $_0x32ab . 2 . $_0x91c6, "\x6a\145\x6e\151\x73" => "\x32", "\x6b\157\x64\145" => $_0x91c6, "\x73\151\x6b\141\x70" => $this->rapor->getDummyDeskripsiSosial()[$_0x78d0]];
 array_push($_0xc470, $_0x9e15);
 }
 goto L_7462b;
 L_ccfb7:
 $_0xdfbd = $_0x32ab ? $this->kelas->getKelasSiswa($_0x32ab, $_0x62cc->id_tp, $_0x35bc->id_smt) : [];
 goto L_d2f92;
 L_fd715:
 list($_0x7ecf, $_0x32ab) = $this->resolveWaliKelasId($_0xa332->username, $_0x62cc->id_tp, $_0x35bc->id_smt);
 goto L_60108;
 L_63f4d:
 $_0x62cc = $this->dashboard->getTahunActive();
 goto L_010fa;
 L_9164a:
 $_0xe2a6["\x73\155\x74"] = $this->dashboard->getSemester();
 goto L_363d2;
 L_d2f92:
 $_0xd9dc = [];
 goto L_ca9c2;
 }
 public function importSosial($_0x6737)
 {
 goto L_02f33;
 L_02f33:
 $_0x6980 = json_decode($this->request->getPost("\x6e\151\x6c\141\x69"));
 goto L_14b4c;
 L_35829:
 $_0x99ee = $this->dashboard->getSemesterActive();
 goto L_acc0e;
 L_be4c3:
 return $this->response->setJSON($_0x35e4);
 L_acc0e:
 $_0x110e = [];
 goto L_224ae;
 L_224ae:
 foreach ($_0x6980 as $_0x4008) {
 $_0x6914 = $_0x4008[13];
 if ($_0x6914 != "\x69\144") {
 $_0x110e[] = ["\x69\144\x5f\156\x69\154\x61\151\x5f\163\x69\153\x61\160" => $_0x6737 . $_0x6914 . $_0xc9f3->id_tp . $_0x99ee->id_smt . "\x32", "\x69\144\x5f\163\x69\163\x77\141" => $_0x6914, "\x69\144\x5f\153\x65\154\x61\163" => $_0x6737, "\x6a\145\x6e\151\x73" => 2, "\x6e\151\x6c\141\x69" => json_encode(["\x70\162\x65\144\x69\153\x61\164" => $_0x4008[3], "\x61\61" => $_0x4008[4], "\x61\62" => $_0x4008[5], "\x61\63" => $_0x4008[6], "\x62\61" => $_0x4008[7], "\x62\62" => $_0x4008[8], "\x62\63" => $_0x4008[9], "\x63\61" => $_0x4008[10], "\x63\62" => $_0x4008[11]]), "\x64\145\x73\153\x72\151\x70\163\x69" => $_0x4008[12], "\x69\144\x5f\164\x70" => $_0xc9f3->id_tp, "\x69\144\x5f\163\x6d\164" => $_0x99ee->id_smt];
 }
 }
 goto L_535ba;
 L_14b4c:
 $_0xc9f3 = $this->dashboard->getTahunActive();
 goto L_35829;
 L_535ba:
 $_0x35e4 = 0;
 goto L_dbb3d;
 L_dbb3d:
 foreach ($_0x110e as $_0xa0fa) {
 $_0x4416 = $this->db->table("\x72\141\x70\157\x72\137\x6e\151\x6c\141\x69\137\x73\151\x6b\141\x70")->replace($_0xa0fa);
 if ($_0x4416) {
 $_0x35e4++;
 }
 }
 goto L_be4c3;
 }
 public function raporPrestasi()
 {
 goto L_9fe1d;
 L_ced2b:
 $_0xd9cb = [];
 goto L_8837b;
 L_8837b:
 $_0xcbba = [];
 goto L_b26f1;
 L_9fe1d:
 $_0xa942 = (object) ["\x69\144" => session()->get("\x69\144\x5f\165\x73\145\x72"), "\x75\163\x65\162\x6e\141\x6d\145" => session()->get("\x75\163\x65\162\x6e\141\x6d\145")];
 goto L_39d8f;
 L_12521:
 $_0x616d = $this->master->getAllMapel();
 goto L_0a67a;
 L_ed0cb:
 for ($_0x9275 = 0; $_0x9275 < 6; $_0x9275++) {
 $_0x2f2c = $_0x9275 + 1;
 $_0x5146 = ["\x69\144\x5f\143\x61\164\x61\164\x61\156" => $_0x4fdc . 1 . $_0x2f2c, "\x6a\145\x6e\151\x73" => "\x33", "\x6b\157\x64\145" => $_0x9228[$_0x9275], "\x64\145\x73\153\x72\151\x70\163\x69" => $this->rapor->getDummyDeskripsiRanking()[$_0x9275], "\x72\141\x6e\153" => $_0xc84f[$_0x9275]];
 array_push($_0xbb01, $_0x5146);
 }
 goto L_4bc29;
 L_2a3ba:
 $_0x2f59 = $_0x4fdc ? $this->kelas->getKelasSiswa($_0x4fdc, $_0xefc3->id_tp, $_0xb8b3->id_smt) : [];
 goto L_6cb0e;
 L_a78a4:
 for ($_0x9275 = 0; $_0x9275 < count($_0x2f59); $_0x9275++) {
 $_0x5618 = $_0x2f59[$_0x9275];
 $_0xa12a = $_0x5618->id_siswa;
 $_0x3695 = ["\x72\141\x6e\153\x69\156\x67" => '', "\x64\145\x73\153\x72\151\x70\163\x69" => '', "\x70\61" => '', "\x70\61\x5f\144\x65\163\x6b" => '', "\x70\62" => '', "\x70\62\x5f\144\x65\163\x6b" => '', "\x70\63" => '', "\x70\63\x5f\144\x65\163\x6b" => ''];
 foreach ($_0x616d as $_0xf8fd) {
 $_0xb163 = $this->rapor->getJmlNilaiMapelHarianSiswa($_0xf8fd->id_mapel, $_0xa12a, $_0xefc3->id_tp, $_0xb8b3->id_smt);
 $_0x2cb2[$_0xa12a][$_0xf8fd->id_mapel] = $_0xb163 == null ? 0 : $_0xb163->jml;
 $_0x98a1[$_0xa12a][$_0xf8fd->id_mapel] = $_0xb163 == null ? 0 : $_0xb163->p_rata_rata;
 $_0xd9cb[$_0xa12a][$_0xf8fd->id_mapel] = $_0xb163 == null ? 0 : $_0xb163->k_rata_rata;
 $_0x1179 = $this->rapor->getNilaiMapelPtsSiswa($_0xf8fd->id_mapel, $_0xa12a, $_0xefc3->id_tp, $_0xb8b3->id_smt);
 $_0xcbba[$_0xa12a][$_0xf8fd->id_mapel] = $_0x1179 == null ? 0 : $_0x1179->nilai;
 $_0x1093 = $this->rapor->getNilaiMapelPasSiswa($_0xf8fd->id_mapel, $_0xa12a, $_0xefc3->id_tp, $_0xb8b3->id_smt);
 $_0xeb0d[$_0xa12a][$_0xf8fd->id_mapel] = $_0x1093 == null ? 0 : $_0x1093->akhir;
 }
 $_0xcf0d = $this->rapor->getRankingKelas($_0x4fdc, $_0x5618->id_siswa, $_0xefc3->id_tp, $_0xb8b3->id_smt);
 $_0x23d4[$_0x5618->id_siswa] = $_0xcf0d == null ? $_0x3695 : $_0xcf0d;
 }
 goto L_f2093;
 L_8fcff:
 $_0x3383["\x74\160\x5f\141\x63\164\x69\166\x65"] = $_0xefc3;
 goto L_b481c;
 L_57a71:
 $_0xc84f = ["\x31\40\x7e\40\x33", "\x34\40\x7e\40\x31\60", "\x31\61\x20\176\x20\61\x35", "\x31\66\x20\176\x20\62\x30", "\x32\61\x20\176\x20\62\x35", "\x32\66\x20\76\x20\76"];
 goto L_36ecd;
 L_6cb0e:
 $_0x23d4 = [];
 goto L_397af;
 L_2dad9:
 return view("\x6d\145\x6d\142\x65\162\x73\57\x67\165\x72\165\x2f\162\x61\160\x6f\162\x2f\160\x72\145\x73\164\x61\163\x69\57\x64\141\x74\141", $_0x3383);
 L_b26f1:
 $_0xeb0d = [];
 goto L_a78a4;
 L_3a6b7:
 $_0x3383["\x73\155\x74\137\x61\143\x74\151\x76\145"] = $_0xb8b3;
 goto L_2dad9;
 L_f2093:
 $_0xb8b5[] = [];
 goto L_d51c4;
 L_f7d93:
 $_0xbb01 = [];
 goto L_57a71;
 L_39d8f:
 $_0xefc3 = $this->dashboard->getTahunActive();
 goto L_17369;
 L_521eb:
 $_0x64d6 = $_0x4fdc ? $this->kelas->get_one($_0x4fdc) : (object) ["\x6e\141\x6d\141\x5f\153\x65\154\x61\163" => "\x2d"];
 goto L_f7d93;
 L_1927c:
 $_0x3383["\x74\160"] = $this->dashboard->getTahun();
 goto L_8fcff;
 L_d51c4:
 /*
 foreach ($nilaiRata_k as $key=>$mapel) {
 $nilaiRata[$key][] = [];
 foreach ($mapel as $m) {
 if (isset($nilaiRata[$key]) && isset($nilaiRata[$key][$mapel])) {
 $nilaiRata[$key][$mapel] += $m;
 } else {
 $nilaiRata[$key][$mapel] = $m;
 }
 //array_push($nilaiRata, $m);
 //$nilaiRata += $m;
 }
 }
 
 foreach ($nilaiPas as $key=>$mapel) {
 foreach ($mapel as $m) {
 if (isset($nilaiRata[$key]) && isset($nilaiRata[$key][$mapel])) {
 $nilaiRata[$key][$mapel] += $m;
 } else {
 $nilaiRata[$key][$mapel] = $m;
 }
 //array_push($nilaiRata, $m);
 //$nilaiRata += $m;
 }
 }
 */
 $_0x3383 = ["\x75\163\x65\162" => $_0xa942, "\x6a\165\x64\165\x6c" => "\x52\141\x6e\153\x69\156\x67\40\x26\40\x50\162\x65\163\x74\141\x73\151\x20\113\x65\154\x61\163\x20", "\x73\165\x62\152\x75\144\x75\154" => "\x49\156\x70\165\x74\40\x4e\151\x6c\141\x69", "\x73\145\x74\164\x69\156\x67" => $this->dashboard->getSetting(), "\x67\165\x72\165" => $_0xf4ad, "\x6b\145\x6c\141\x73" => $_0x64d6, "\x73\151\x73\167\x61" => $_0x2f59, "\x6e\151\x6c\141\x69" => $_0x23d4, "\x6e\151\x6c\141\x69\110\x61\162\x69\141\x6e" => $_0x2cb2, "\x6e\151\x6c\141\x69\122\x61\164\x61\137\x70" => $_0x98a1, "\x6e\151\x6c\141\x69\122\x61\164\x61\137\x6b" => $_0xd9cb, "\x6e\151\x6c\141\x69\122\x61\164\x61" => $_0xb8b5, "\x6e\151\x6c\141\x69\120\x74\163" => $_0xcbba, "\x6e\151\x6c\141\x69\120\x61\163" => $_0xeb0d, "\x64\145\x73\153\x52\141\x6e\153\x69\156\x67" => $_0x654a, "\x6d\141\x70\145\x6c\163" => $_0x616d];
 goto L_1927c;
 L_0a67a:
 list($_0xf4ad, $_0x4fdc) = $this->resolveWaliKelasId($_0xa942->username, $_0xefc3->id_tp, $_0xb8b3->id_smt);
 goto L_521eb;
 L_d93a2:
 $_0xdc8f = $this->dashboard->getSetting();
 goto L_12521;
 L_77163:
 if (count($_0x654a) == 0) {
 $_0x654a = json_decode(json_encode($_0xbb01));
 }
 goto L_2a3ba;
 L_b481c:
 $_0x3383["\x73\155\x74"] = $this->dashboard->getSemester();
 goto L_3a6b7;
 L_4bc29:
 $_0x654a = $this->rapor->getDeskripsiCatatanByJenis($_0x4fdc, "\x31", $_0xefc3->id_tp, $_0xb8b3->id_smt);
 goto L_77163;
 L_17369:
 $_0xb8b3 = $this->dashboard->getSemesterActive();
 goto L_d93a2;
 L_932b2:
 $_0x98a1 = [];
 goto L_ced2b;
 L_397af:
 $_0x2cb2 = [];
 goto L_932b2;
 L_36ecd:
 $_0x9228 = ["\x31", "\x34", "\x31\61", "\x31\66", "\x32\61", "\x32\66"];
 goto L_ed0cb;
 }
 public function savePrestasi()
 {
 goto L_a32c1;
 L_7c3ef:
 $_0x2df5["\x73\164\x61\164\x75\163"] = $_0xc919;
 goto L_974c5;
 L_b2937:
 $_0x33fb = $this->dashboard->getTahunActive();
 goto L_398c4;
 L_1405d:
 foreach ($_0xf422 as $_0xa8ab) {
 $_0x2df5 = ["\x69\144\x5f\143\x61\164\x61\164\x61\156" => $_0xa8ab->id_catatan, "\x69\144\x5f\153\x65\154\x61\163" => $_0xa8ab->kelas, "\x6a\145\x6e\151\x73" => $_0xa8ab->jenis, "\x6b\157\x64\145" => $_0xa8ab->kode, "\x72\141\x6e\153" => $_0xa8ab->rank, "\x64\145\x73\153\x72\151\x70\163\x69" => $_0xa8ab->deskripsi, "\x69\144\x5f\164\x70" => $_0x33fb->id_tp, "\x69\144\x5f\163\x6d\164" => $_0x8de8->id_smt];
 $_0xc919 = $this->db->table("\x72\141\x70\157\x72\137\x64\141\x74\141\x5f\143\x61\164\x61\164\x61\156")->replace($_0x2df5);
 }
 goto L_7c3ef;
 L_974c5:
 return $this->output_json($_0x2df5);
 L_398c4:
 $_0x8de8 = $this->dashboard->getSemesterActive();
 goto L_1405d;
 L_a32c1:
 $_0xf422 = json_decode($this->request->getPost("\x63\141\x74\141\x74\141\x6e"));
 goto L_b2937;
 }
 public function importPrestasi($_0xfdf8)
 {
 goto L_55a81;
 L_d76f2:
 $_0x5085 = [];
 goto L_4e0ed;
 L_55a81:
 $_0x63f0 = json_decode($this->request->getPost("\x6e\151\x6c\141\x69"));
 goto L_48a2d;
 L_7fa85:
 $_0x5f53 = 0;
 goto L_3b28a;
 L_48a2d:
 $_0x5a6d = $this->dashboard->getTahunActive();
 goto L_6be96;
 L_4a559:
 return $this->response->setJSON($_0x5f53);
 L_3b28a:
 foreach ($_0x5085 as $_0xdd6a) {
 $_0xd788 = $this->db->table("\x72\141\x70\157\x72\137\x70\162\x65\163\x74\141\x73\151")->replace($_0xdd6a);
 if ($_0xd788) {
 $_0x5f53++;
 }
 }
 goto L_4a559;
 L_4e0ed:
 foreach ($_0x63f0 as $_0xa3fc) {
 $_0x8ae0 = $_0xa3fc[12];
 $_0x5085[] = ["\x69\144\x5f\162\x61\156\x6b\151\x6e\147" => $_0xfdf8 . $_0x8ae0 . $_0x5a6d->id_tp . $_0xa70b->id_smt, "\x69\144\x5f\163\x69\163\x77\141" => $_0x8ae0, "\x69\144\x5f\153\x65\154\x61\163" => $_0xfdf8, "\x69\144\x5f\164\x70" => $_0x5a6d->id_tp, "\x69\144\x5f\163\x6d\164" => $_0xa70b->id_smt, "\x72\141\x6e\153\x69\156\x67" => $_0xa3fc[4], "\x64\145\x73\153\x72\151\x70\163\x69" => $_0xa3fc[5], "\x70\61" => $_0xa3fc[6], "\x70\61\x5f\144\x65\163\x6b" => $_0xa3fc[7], "\x70\62" => $_0xa3fc[8], "\x70\62\x5f\144\x65\163\x6b" => $_0xa3fc[9], "\x70\63" => $_0xa3fc[10], "\x70\63\x5f\144\x65\163\x6b" => $_0xa3fc[11]];
 }
 goto L_7fa85;
 L_6be96:
 $_0xa70b = $this->dashboard->getSemesterActive();
 goto L_d76f2;
 }
 public function raporCatatan()
 {
 goto L_1aef8;
 L_5e4b8:
 list($_0x1d29, $_0xd67e) = $this->resolveWaliKelasId($_0xb2c2->username, $_0x23b1->id_tp, $_0x6301->id_smt);
 goto L_17ab4;
 L_65c2c:
 $_0xc471 = ["\x75\163\x65\162" => $_0xb2c2, "\x6a\165\x64\165\x6c" => "\x4b\145\x68\141\x64\151\x72\141\x6e\40\x26\40\x43\141\x74\141\x74\141\x6e\40\x57\141\x6c\151\x20\113\x65\154\x61\163", "\x73\165\x62\152\x75\144\x75\154" => "\x49\156\x70\165\x74\40\x41\142\x73\145\x6e\163\x69\40\x64\141\x6e\40\x43\141\x74\141\x74\141\x6e\40\x4d\157\x74\151\x76\141\x73\151", "\x6b\145\x6c\141\x73" => $_0xe423, "\x73\151\x73\167\x61\163" => $_0x7a22, "\x6b\145\x68\141\x64\151\x72\141\x6e" => $_0xd67e ? $this->raporKurmer->getKehadiranKelas($_0xd67e, $_0x23b1->id_tp, $_0x6301->id_smt) : []];
 goto L_ad69f;
 L_17ab4:
 $_0xe423 = $_0xd67e ? $this->kelas->get_one($_0xd67e) : (object) ["\x6e\141\x6d\141\x5f\153\x65\154\x61\163" => "\x2d"];
 goto L_b129b;
 L_1aef8:
 $_0xb2c2 = (object) ["\x69\144" => session()->get("\x69\144\x5f\165\x73\145\x72"), "\x75\163\x65\162\x6e\141\x6d\145" => session()->get("\x75\163\x65\162\x6e\141\x6d\145")];
 goto L_099c3;
 L_099c3:
 $_0x23b1 = $this->dashboard->getTahunActive();
 goto L_0f043;
 L_b129b:
 $_0x7a22 = $_0xd67e ? $this->rapor->getDetailSiswa($_0xd67e, $_0x23b1->id_tp, $_0x6301->id_smt) : [];
 goto L_65c2c;
 L_ad69f:
 return view("\x6d\145\x6d\142\x65\162\x73\57\x67\165\x72\165\x2f\162\x61\160\x6f\162\x2f\143\x61\164\x61\164\x61\156\x2f\144\x61\164\x61", $_0xc471);
 L_0f043:
 $_0x6301 = $this->dashboard->getSemesterActive();
 goto L_5e4b8;
 }
 public function saveKehadiranCatatan()
 {
 goto L_f5579;
 L_416be:
 $_0xadb3 = $this->request->getPost("\x73\151\x73\167\x61") ?? [];
 goto L_24339;
 L_f5579:
 $_0x331c = $this->dashboard->getTahunActive();
 goto L_a41b3;
 L_a41b3:
 $_0x8a62 = $this->dashboard->getSemesterActive();
 goto L_3e651;
 L_20890:
 return $this->output_json(["\x73\164\x61\164\x75\163" => true]);
 L_24339:
 foreach ($_0xadb3 as $_0x1b83 => $_0xc1c5) {
 $_0xcaaa = ["\x69\144\x5f\164\x70" => $_0x331c->id_tp, "\x69\144\x5f\163\x6d\164" => $_0x8a62->id_smt, "\x69\144\x5f\153\x65\154\x61\163" => $_0x5a18, "\x69\144\x5f\163\x69\163\x77\141" => $_0x1b83, "\x73\141\x6b\151\x74" => intval($_0xc1c5["\x73\141\x6b\151\x74"] ?? 0), "\x69\172\x69\156" => intval($_0xc1c5["\x69\172\x69\156"] ?? 0), "\x61\154\x70\141" => intval($_0xc1c5["\x61\154\x70\141"] ?? 0), "\x63\141\x74\141\x74\141\x6e\137\x77\141\x6c\151" => $_0xc1c5["\x63\141\x74\141\x74\141\x6e\137\x77\141\x6c\151"] ?? null];
 $this->raporKurmer->saveKehadiran($_0xcaaa);
 }
 goto L_20890;
 L_3e651:
 $_0x5a18 = $this->request->getPost("\x69\144\x5f\153\x65\154\x61\163");
 goto L_416be;
 }
 public function saveCatatan()
 {
 goto L_267d5;
 L_0db78:
 $_0xe471 = $this->dashboard->getTahunActive();
 goto L_f87e0;
 L_9fd62:
 foreach ($_0xcda6 as $_0x784c) {
 $_0x641b = ["\x69\144\x5f\143\x61\164\x61\164\x61\156" => $_0x784c->id_catatan, "\x69\144\x5f\153\x65\154\x61\163" => $_0x784c->kelas, "\x6a\145\x6e\151\x73" => $_0x784c->jenis, "\x6b\157\x64\145" => $_0x784c->kode, "\x72\141\x6e\153" => $_0x784c->rank, "\x64\145\x73\153\x72\151\x70\163\x69" => $_0x784c->deskripsi, "\x69\144\x5f\164\x70" => $_0xe471->id_tp, "\x69\144\x5f\163\x6d\164" => $_0xc36b->id_smt];
 $_0x19fe = $this->db->table("\x72\141\x70\157\x72\137\x64\141\x74\141\x5f\143\x61\164\x61\164\x61\156")->replace($_0x641b);
 }
 goto L_abc99;
 L_abc99:
 $_0x641b["\x73\164\x61\164\x75\163"] = $_0x19fe;
 goto L_131d5;
 L_131d5:
 return $this->output_json($_0x641b);
 L_267d5:
 $_0xcda6 = json_decode($this->request->getPost("\x63\141\x74\141\x74\141\x6e"));
 goto L_0db78;
 L_f87e0:
 $_0xc36b = $this->dashboard->getSemesterActive();
 goto L_9fd62;
 }
 public function importCatatan($_0xc47c)
 {
 goto L_e3e11;
 L_f337c:
 $_0xdb34 = [];
 goto L_673f0;
 L_dbc97:
 return $this->response->setJSON($_0x11d0);
 L_e3e11:
 $_0x3ab3 = json_decode($this->request->getPost("\x6e\151\x6c\141\x69"));
 goto L_30dac;
 L_673f0:
 foreach ($_0x3ab3 as $_0x9df2) {
 $_0xb383 = $_0x9df2[10];
 if ($_0xb383 != "\x69\144") {
 $_0xdb34[] = ["\x69\144\x5f\143\x61\164\x61\164\x61\156\x5f\167\x61\154\x69" => $_0xc47c . $_0xb383 . $_0x1364->id_tp . $_0xad77->id_smt, "\x69\144\x5f\163\x69\163\x77\141" => $_0xb383, "\x69\144\x5f\153\x65\154\x61\163" => $_0xc47c, "\x6e\151\x6c\141\x69" => json_encode(["\x6f\160\x31" => $_0x9df2[3], "\x6f\160\x32" => $_0x9df2[4], "\x6f\160\x33" => $_0x9df2[5], "\x73" => $_0x9df2[6], "\x69" => $_0x9df2[7], "\x61" => $_0x9df2[8]]), "\x64\145\x73\153\x72\151\x70\163\x69" => $_0x9df2[9], "\x69\144\x5f\164\x70" => $_0x1364->id_tp, "\x69\144\x5f\163\x6d\164" => $_0xad77->id_smt];
 }
 }
 goto L_85b11;
 L_85b11:
 $_0x11d0 = 0;
 goto L_907a6;
 L_907a6:
 foreach ($_0xdb34 as $_0xa070) {
 $_0xe5c5 = $this->db->table("\x72\141\x70\157\x72\137\x63\141\x74\141\x74\141\x6e\137\x77\141\x6c\151")->replace($_0xa070);
 if ($_0xe5c5) {
 $_0x11d0++;
 }
 }
 goto L_dbc97;
 L_30dac:
 $_0x1364 = $this->dashboard->getTahunActive();
 goto L_dbd58;
 L_dbd58:
 $_0xad77 = $this->dashboard->getSemesterActive();
 goto L_f337c;
 }
 public function raporFisik()
 {
 goto L_9b96f;
 L_f15d1:
 for ($_0x9eaa = 0; $_0x9eaa < 4; $_0x9eaa++) {
 $_0xc44b = $_0x9eaa + 1;
 foreach ($_0xd65d as $_0x47c5) {
 $_0x76b4 = ["\x69\144\x5f\146\x69\163\x69\153" => $_0x8620 . $_0x47c5 . $_0xc44b, "\x6a\145\x6e\151\x73" => $_0x47c5, "\x6b\157\x64\145" => $_0xc44b, "\x64\145\x73\153\x72\151\x70\163\x69" => $this->rapor->getDummyDeskripsiFisik($_0x47c5)[$_0x9eaa]];
 array_push($_0xcc3d, $_0x76b4);
 }
 }
 goto L_2c3f1;
 L_b8ef2:
 return view("\x6d\145\x6d\142\x65\162\x73\57\x67\165\x72\165\x2f\162\x61\160\x6f\162\x2f\146\x69\163\x69\153\x2f\144\x61\164\x61", $_0x562d);
 L_2c3f1:
 $_0x4834 = $this->rapor->getDeskripsiFisikKelas($_0x8620, $_0x4823->id_tp, $_0x1f53->id_smt);
 goto L_8c8a8;
 L_667c1:
 $_0x562d["\x74\160"] = $this->dashboard->getTahun();
 goto L_7c8c7;
 L_2ce93:
 if ($_0x1f53->id_smt == "\x31") {
 $_0x5983 = "\x32";
 } else {
 $_0x5983 = "\x31";
 }
 goto L_b322c;
 L_8c8a8:
 if ($_0x4834 == null) {
 $_0x4834 = json_decode(json_encode($_0xcc3d));
 }
 goto L_54627;
 L_9c625:
 $_0x562d = ["\x75\163\x65\162" => $_0x8706, "\x6a\165\x64\165\x6c" => "\x41\142\x73\145\x6e\163\x69\40\x26\40\x43\141\x74\141\x74\141\x6e\40\x4b\145\x6c\141\x73\40", "\x73\165\x62\152\x75\144\x75\154" => "\x49\156\x70\165\x74\40\x4e\151\x6c\141\x69", "\x73\145\x74\164\x69\156\x67" => $this->dashboard->getSetting(), "\x67\165\x72\165" => $_0x167c, "\x6b\145\x6c\141\x73" => $_0x8607, "\x73\151\x73\167\x61" => $_0xf608, "\x6e\151\x6c\141\x69" => $_0x5f61, "\x64\145\x73\153\x46\151\x73\151\x6b" => $_0x4834];
 goto L_667c1;
 L_54627:
 $_0xf608 = $_0x8620 ? $this->kelas->getKelasSiswa($_0x8620, $_0x4823->id_tp, $_0x1f53->id_smt) : [];
 goto L_5ada7;
 L_a5ee4:
 $_0x8607 = $_0x8620 ? $this->kelas->get_one($_0x8620) : (object) ["\x6e\141\x6d\141\x5f\153\x65\154\x61\163" => "\x2d"];
 goto L_18e99;
 L_b322c:
 for ($_0x9eaa = 0; $_0x9eaa < count($_0xf608); $_0x9eaa++) {
 $_0xe8e3 = $_0xf608[$_0x9eaa];
 $_0x160a = ["\x6b\157\x6e\144\x69\163\x69" => ["\x74\145\x6c\151\x6e\147\x61" => '', "\x6d\141\x74\141" => '', "\x67\151\x67\151" => '', "\x6c\141\x69\156" => ''], "\x73\155\x74" . $_0x1f53->id_smt => ["\x74\151\x6e\147\x67\151" => '', "\x62\145\x72\141\x74" => '', "\x74\160" => $_0x4823->id_tp], "\x73\155\x74" . $_0x5983 => ["\x74\151\x6e\147\x67\151" => '', "\x62\145\x72\141\x74" => '', "\x74\160" => $_0x4823->id_tp]];
 $_0xb4d5 = $this->rapor->getFisikKelas($_0x8620, $_0xe8e3->id_siswa, $_0x4823->id_tp, $_0x1f53->id_smt);
 $_0xee2e = $this->rapor->getFisikKelas($_0x8620, $_0xe8e3->id_siswa, $_0x4823->id_tp, $_0x5983);
 $_0x5f61[$_0xe8e3->id_siswa] = $_0xb4d5 != null ? ["\x6b\157\x6e\144\x69\163\x69" => $this->maybe_unserialize($_0xb4d5->kondisi), "\x73\155\x74" . $_0xb4d5->id_smt => ["\x74\151\x6e\147\x67\151" => $_0xb4d5->tinggi, "\x62\145\x72\141\x74" => $_0xb4d5->berat, "\x74\160" => $_0xb4d5->id_tp], "\x73\155\x74" . $_0x5983 => ["\x74\151\x6e\147\x67\151" => $_0xee2e != null ? $_0xee2e->tinggi : '', "\x62\145\x72\141\x74" => $_0xee2e != null ? $_0xee2e->berat : '', "\x74\160" => $_0x4823->id_tp]] : $_0x160a;
 }
 goto L_9c625;
 L_18e99:
 $_0xcc3d = [];
 goto L_657f6;
 L_f0331:
 list($_0x167c, $_0x8620) = $this->resolveWaliKelasId($_0x8706->username, $_0x4823->id_tp, $_0x1f53->id_smt);
 goto L_a5ee4;
 L_9b96f:
 $_0x8706 = (object) ["\x69\144" => session()->get("\x69\144\x5f\165\x73\145\x72"), "\x75\163\x65\162\x6e\141\x6d\145" => session()->get("\x75\163\x65\162\x6e\141\x6d\145")];
 goto L_5e288;
 L_7c8c7:
 $_0x562d["\x74\160\x5f\141\x63\164\x69\166\x65"] = $_0x4823;
 goto L_44e4f;
 L_5e288:
 $_0x4823 = $this->dashboard->getTahunActive();
 goto L_633f9;
 L_5ada7:
 $_0x5f61 = [];
 goto L_2ce93;
 L_633f9:
 $_0x1f53 = $this->dashboard->getSemesterActive();
 goto L_f0331;
 L_44e4f:
 $_0x562d["\x73\155\x74"] = $this->dashboard->getSemester();
 goto L_ed78e;
 L_657f6:
 //$this->rapor->getDummyDeskripsiFisik($id_kelas);
 //jenis: 1=pendengaran, 2=penglihatan, 3=gigi, 4=lain-lain
 $_0xd65d = ["\x31", "\x32", "\x33", "\x34"];
 goto L_f15d1;
 L_ed78e:
 $_0x562d["\x73\155\x74\137\x61\143\x74\151\x76\145"] = $_0x1f53;
 goto L_b8ef2;
 }
 public function saveFisik()
 {
 goto L_2a007;
 L_f080f:
 $_0x4680["\x73\164\x61\164\x75\163"] = $_0xa26c;
 goto L_c3c3c;
 L_339af:
 $_0xf71a = $this->dashboard->getTahunActive();
 goto L_e8b04;
 L_332f0:
 $_0xa26c = false;
 goto L_339af;
 L_e8b04:
 $_0xa06a = $this->dashboard->getSemesterActive();
 goto L_3d01d;
 L_3d01d:
 foreach ($_0xa9ca as $_0x1c20) {
 $_0x7f3e = $_0x1c20[0];
 $_0x61f5 = $_0x1c20[0];
 $_0x4680 = ["\x69\144\x5f\146\x69\163\x69\153" => $_0x5722 . $_0x61f5 . $_0x7f3e, "\x69\144\x5f\153\x65\154\x61\163" => $_0x5722, "\x6a\145\x6e\151\x73" => $_0x1c20->jenis, "\x6b\157\x64\145" => $_0x1c20->kode, "\x64\145\x73\153\x72\151\x70\163\x69" => $_0x1c20->deskripsi, "\x69\144\x5f\164\x70" => $_0xf71a->id_tp, "\x69\144\x5f\163\x6d\164" => $_0xa06a->id_smt];
 $_0xa26c = $this->db->table("\x72\141\x70\157\x72\137\x64\141\x74\141\x5f\146\x69\163\x69\153")->replace($_0x4680);
 }
 goto L_f080f;
 L_2a007:
 $_0x5722 = $this->request->getPost("\x6b\145\x6c\141\x73");
 goto L_bdcfa;
 L_c3c3c:
 return $this->output_json($_0x4680);
 L_bdcfa:
 $_0xa9ca = json_decode($this->request->getPost("\x66\151\x73\151\x6b"));
 goto L_332f0;
 }
 public function importFisik($_0xa010)
 {
 goto L_b1832;
 L_ad51e:
 $_0xbf58 = [];
 goto L_9044f;
 L_74f93:
 $_0xaeb1 = $this->dashboard->getSemesterActive();
 goto L_ad51e;
 L_9044f:
 foreach ($_0x5edf as $_0xf99e) {
 $_0xd7ef = $_0xf99e[11];
 $_0x49e0 = $_0xaeb1->id_smt == 1 ? $_0xf99e[3] : $_0xf99e[4];
 $_0x8955 = $_0xaeb1->id_smt == 1 ? $_0xf99e[5] : $_0xf99e[6];
 if ($_0xd7ef != "\x69\144") {
 $_0xbf58[] = ["\x69\144\x5f\146\x69\163\x69\153" => $_0xa010 . $_0xd7ef . $_0x9e6b->id_tp . $_0xaeb1->id_smt, "\x69\144\x5f\153\x65\154\x61\163" => $_0xa010, "\x69\144\x5f\163\x69\163\x77\141" => $_0xd7ef, "\x69\144\x5f\164\x70" => $_0x9e6b->id_tp, "\x69\144\x5f\163\x6d\164" => $_0xaeb1->id_smt, "\x74\151\x6e\147\x67\151" => $_0x49e0, "\x62\145\x72\141\x74" => $_0x8955, "\x6b\157\x6e\144\x69\163\x69" => json_encode(["\x74\145\x6c\151\x6e\147\x61" => $_0xf99e[7], "\x6d\141\x74\141" => $_0xf99e[8], "\x67\151\x67\151" => $_0xf99e[9], "\x6c\141\x69\156" => $_0xf99e[10]])];
 }
 }
 goto L_cf83b;
 L_54d28:
 foreach ($_0xbf58 as $_0xf762) {
 $_0x138e = $this->db->table("\x72\141\x70\157\x72\137\x66\151\x73\151\x6b")->replace($_0xf762);
 if ($_0x138e) {
 $_0x1ba0++;
 }
 }
 goto L_3d003;
 L_3d003:
 return $this->response->setJSON($_0x1ba0);
 L_b1832:
 $_0x5edf = json_decode($this->request->getPost("\x6e\151\x6c\141\x69"));
 goto L_f7ada;
 L_f7ada:
 $_0x9e6b = $this->dashboard->getTahunActive();
 goto L_74f93;
 L_cf83b:
 $_0x1ba0 = 0;
 goto L_54d28;
 }
 public function raporNaik()
 {
 goto L_8c365;
 L_2154d:
 $_0x3780 = $this->rapor->getKenaikanSiswa($_0xc423, $_0xb22b->id_tp, $_0xb556->id_smt);
 goto L_99c10;
 L_6029f:
 $_0xac25["\x73\155\x74\137\x61\143\x74\151\x76\145"] = $_0xb556;
 goto L_cd77a;
 L_cd85a:
 list($_0x6c66, $_0xc423) = $this->resolveWaliKelasId($_0xeadc->username, $_0xb22b->id_tp, $_0xb556->id_smt);
 goto L_fd22e;
 L_93348:
 $_0xac25["\x74\160"] = $this->dashboard->getTahun();
 goto L_bc945;
 L_1201c:
 $_0xac25["\x73\155\x74"] = $this->dashboard->getSemester();
 goto L_6029f;
 L_cd77a:
 return view("\x6d\145\x6d\142\x65\162\x73\57\x67\165\x72\165\x2f\162\x61\160\x6f\162\x2f\153\x65\156\x61\151\x6b\141\x6e\57\x64\141\x74\141", $_0xac25);
 L_fd22e:
 $_0x6514 = $_0xc423 ? $this->kelas->get_one($_0xc423) : (object) ["\x6e\141\x6d\141\x5f\153\x65\154\x61\163" => "\x2d"];
 goto L_2154d;
 L_a83cb:
 $_0xb556 = $this->dashboard->getSemesterActive();
 goto L_cd85a;
 L_bc945:
 $_0xac25["\x74\160\x5f\141\x63\164\x69\166\x65"] = $_0xb22b;
 goto L_1201c;
 L_99c10:
 $_0xac25 = ["\x75\163\x65\162" => $_0xeadc, "\x6a\165\x64\165\x6c" => "\x4b\145\x6e\141\x69\153\x61\156\x20\113\x65\154\x61\163\x20", "\x73\165\x62\152\x75\144\x75\154" => "\x53\151\x73\167\x61\40\x4b\145\x6c\141\x73\40", "\x73\145\x74\164\x69\156\x67" => $this->dashboard->getSetting(), "\x67\165\x72\165" => $_0x6c66, "\x6b\145\x6c\141\x73" => $_0x6514, "\x73\151\x73\167\x61\163" => $_0x3780];
 goto L_93348;
 L_8c365:
 $_0xeadc = (object) ["\x69\144" => session()->get("\x69\144\x5f\165\x73\145\x72"), "\x75\163\x65\162\x6e\141\x6d\145" => session()->get("\x75\163\x65\162\x6e\141\x6d\145")];
 goto L_60fb4;
 L_60fb4:
 $_0xb22b = $this->dashboard->getTahunActive();
 goto L_a83cb;
 }
 public function saveNaik()
 {
 goto L_b3969;
 L_43e1e:
 $_0xa032 = 0;
 goto L_c3b96;
 L_b3969:
 $_0x7b29 = json_decode($this->request->getPost("\x6e\141\x69\153"));
 goto L_26724;
 L_c3b96:
 foreach ($_0x7b29 as $_0xcec3) {
 $_0x2c37 = ["\x69\144\x5f\156\x61\151\x6b" => $_0xcec3->id_siswa . $_0xab30->id_tp . $_0x124e->id_smt, "\x69\144\x5f\163\x69\163\x77\141" => $_0xcec3->id_siswa, "\x69\144\x5f\164\x70" => $_0xab30->id_tp, "\x69\144\x5f\163\x6d\164" => $_0x124e->id_smt, "\x6e\141\x69\153" => $_0xcec3->naik];
 $_0x26d5 = $this->db->table("\x72\141\x70\157\x72\137\x6e\141\x69\153")->replace($_0x2c37);
 if ($_0x26d5) {
 $_0xa032++;
 }
 }
 goto L_14bcf;
 L_7b98e:
 //return $this->output_json($data);
 L_14bcf:
 return $this->response->setJSON($_0xa032);
 L_607f6:
 $_0x124e = $this->dashboard->getSemesterActive();
 goto L_43e1e;
 L_26724:
 $_0xab30 = $this->dashboard->getTahunActive();
 goto L_607f6;
 }
 public function cetakPts($_0x1234 = null)
 {
 goto L_db0fa;
 L_5581b:
 if (($_0x64de->mode_rapor ?? "\x73\145\x6d\165\x61") === "\x73\141\x73") {
 session()->setFlashdata("\x65\162\x72\157\x72", "\x41\153\x73\145\x73\40\x52\141\x70\157\x72\40\x53\124\x53\40\x28\124\x65\156\x67\141\x68\40\x53\145\x6d\145\x73\164\x65\162\x29\40\x73\141\x61\164\x20\151\x6e\151\x20\163\x65\144\x61\156\x67\40\x64\151\x6e\157\x6e\141\x6b\164\x69\146\x6b\141\x6e\40\x6f\154\x65\150\x20\101\x64\155\x69\156\x69\163\x74\162\x61\164\x6f\162\x2e");
 return redirect()->to("\x72\141\x70\157\x72\57\x63\145\x74\141\x6b\141\x6b\150\x69\162");
 }
 goto L_d7598;
 L_dae5c:
 $_0x3554 = $this->dashboard->getTahunActive();
 goto L_9e661;
 L_db0fa:
 $_0x1dc9 = (object) ["\x69\144" => session()->get("\x69\144\x5f\165\x73\145\x72"), "\x75\163\x65\162\x6e\141\x6d\145" => session()->get("\x75\163\x65\162\x6e\141\x6d\145")];
 goto L_dae5c;
 L_a0538:
 $_0x9dcc = $_0x84f0->satuan_nama;
 goto L_105ee;
 L_a9e07:
 $_0x3a12 = $this->dashboard->getSetting();
 goto L_989a8;
 L_ad38f:
 $_0x65f3 = $_0x1234 ? $this->kelas->get_one($_0x1234) : (object) ["\x6e\141\x6d\141\x5f\153\x65\154\x61\163" => "\x2d"];
 goto L_d2afe;
 L_d7598:
 if (!$_0x1234) {
 list($_0x1b86, $_0x1234) = $this->resolveWaliKelasId($_0x1dc9->username, $_0x3554->id_tp, $_0xe2d1->id_smt);
 } else {
 $_0x1b86 = $this->dashboard->getDataGuruByUsername($_0x1dc9->username, $_0x3554->id_tp, $_0xe2d1->id_smt);
 }
 goto L_ad38f;
 L_37bef:
 $_0xf548 = $_0x84f0->school_type;
 goto L_e0a6b;
 L_440be:
 $_0x64de = $this->raporKurmer->getSetting($_0x3554->id_tp, $_0xe2d1->id_smt);
 goto L_5581b;
 L_34d8a:
 return view("\x6d\145\x6d\142\x65\162\x73\57\x67\165\x72\165\x2f\162\x61\160\x6f\162\x2f\143\x65\164\x61\153\x2f\160\x74\163", $_0xdbc5);
 L_d2afe:
 $_0x1291 = $_0x1234 ? $this->rapor->getDetailSiswa($_0x1234, $_0x3554->id_tp, $_0xe2d1->id_smt) : [];
 goto L_a9e07;
 L_e0a6b:
 $_0xdbc5 = ["\x75\163\x65\162" => $_0x1dc9, "\x67\165\x72\165" => $_0x1b86, "\x6a\165\x64\165\x6c" => "\x43\145\x74\141\x6b\40\x52\141\x70\157\x72\40\x54\145\x6e\147\x61\150\x20\50\x53\124\x53\51", "\x73\165\x62\152\x75\144\x75\154" => "\x4c\141\x70\157\x72\141\x6e\40\x4e\151\x6c\141\x69\40\x41\153\x68\151\x72\40\x50\145\x73\145\x72\164\x61\40\x44\151\x64\151\x6b", "\x73\145\x74\164\x69\156\x67" => $_0x3a12, "\x73\141\x74\165\x61\156\x5f\156\x61\155\x61" => $_0x9dcc, "\x69\163\x5f\153\x65\155\x65\156\x61\147" => $_0xc1de, "\x69\163\x5f\163\x64" => $_0x84f0->is_sd, "\x73\143\x68\157\x6f\154\x5f\164\x79\160\x65" => $_0xf548, "\x74\160\x5f\141\x63\164\x69\166\x65" => $_0x3554, "\x73\155\x74\137\x61\143\x74\151\x76\145" => $_0xe2d1, "\x6b\145\x6c\141\x73" => $_0x65f3, "\x73\151\x73\167\x61\163" => $_0x1291, "\x72\141\x70\157\x72\137\x73\145\x74\164\x69\156\x67" => $_0x64de];
 goto L_34d8a;
 L_9e661:
 $_0xe2d1 = $this->dashboard->getSemesterActive();
 goto L_440be;
 L_989a8:
 $_0x84f0 = detectSchoolType($_0x3a12);
 goto L_a0538;
 L_105ee:
 $_0xc1de = $_0x84f0->is_kemenag;
 goto L_37bef;
 }
 public function cetakAkhir($_0x9c1a = null)
 {
 goto L_2ec53;
 L_e643b:
 $_0x822e = $_0x9c1a ? $this->rapor->getDetailSiswa($_0x9c1a, $_0x42b4->id_tp, $_0x15c4->id_smt) : [];
 goto L_a6bde;
 L_155fc:
 $_0x42b4 = $this->dashboard->getTahunActive();
 goto L_509fc;
 L_073c9:
 $_0x530a = $_0xfaa6->school_type;
 goto L_d0e79;
 L_8e66c:
 $_0x8c0f = $_0xfaa6->is_kemenag;
 goto L_073c9;
 L_509fc:
 $_0x15c4 = $this->dashboard->getSemesterActive();
 goto L_c3af0;
 L_2ec53:
 $_0x6d44 = (object) ["\x69\144" => session()->get("\x69\144\x5f\165\x73\145\x72"), "\x75\163\x65\162\x6e\141\x6d\145" => session()->get("\x75\163\x65\162\x6e\141\x6d\145")];
 goto L_155fc;
 L_d0e79:
 $_0x5bd7 = ["\x75\163\x65\162" => $_0x6d44, "\x67\165\x72\165" => $_0x72f7, "\x6a\165\x64\165\x6c" => "\x43\145\x74\141\x6b\40\x52\141\x70\157\x72\40\x41\153\x68\151\x72\40\x28\123\x41\123\x29", "\x73\165\x62\152\x75\144\x75\154" => "\x4c\141\x70\157\x72\141\x6e\40\x48\141\x73\151\x6c\40\x42\145\x6c\141\x6a\141\x72\40\x50\145\x73\145\x72\164\x61\40\x44\151\x64\151\x6b", "\x73\145\x74\164\x69\156\x67" => $_0x2dd2, "\x73\141\x74\165\x61\156\x5f\156\x61\155\x61" => $_0x7448, "\x69\163\x5f\153\x65\155\x65\156\x61\147" => $_0x8c0f, "\x69\163\x5f\163\x64" => $_0xfaa6->is_sd, "\x73\143\x68\157\x6f\154\x5f\164\x79\160\x65" => $_0x530a, "\x74\160\x5f\141\x63\164\x69\166\x65" => $_0x42b4, "\x73\155\x74\137\x61\143\x74\151\x76\145" => $_0x15c4, "\x6b\145\x6c\141\x73" => $_0xd171, "\x73\151\x73\167\x61\163" => $_0x822e, "\x72\141\x70\157\x72\137\x73\145\x74\164\x69\156\x67" => $_0x27ae];
 goto L_360ec;
 L_84358:
 if (($_0x27ae->mode_rapor ?? "\x73\145\x6d\165\x61") === "\x73\164\x73") {
 session()->setFlashdata("\x65\162\x72\157\x72", "\x41\153\x73\145\x73\40\x52\141\x70\157\x72\40\x53\101\x53\57\x53\101\x54\40\x28\101\x6b\150\x69\162\x20\123\x65\155\x65\163\x74\145\x72\51\x20\163\x61\141\x74\40\x69\156\x69\40\x73\145\x64\141\x6e\147\x20\144\x69\156\x6f\156\x61\153\x74\151\x66\153\x61\156\x20\157\x6c\145\x68\40\x41\144\x6d\151\x6e\151\x73\164\x72\141\x74\157\x72\56");
 return redirect()->to("\x72\141\x70\157\x72\57\x63\145\x74\141\x6b\160\x74\163");
 }
 goto L_079e0;
 L_231a5:
 $_0x7448 = $_0xfaa6->satuan_nama;
 goto L_8e66c;
 L_360ec:
 return view("\x6d\145\x6d\142\x65\162\x73\57\x67\165\x72\165\x2f\162\x61\160\x6f\162\x2f\143\x65\164\x61\153\x2f\141\x6b\150\x69\162", $_0x5bd7);
 L_43e35:
 $_0xd171 = $_0x9c1a ? $this->kelas->get_one($_0x9c1a) : (object) ["\x6e\141\x6d\141\x5f\153\x65\154\x61\163" => "\x2d"];
 goto L_e643b;
 L_c3af0:
 $_0x27ae = $this->raporKurmer->getSetting($_0x42b4->id_tp, $_0x15c4->id_smt);
 goto L_84358;
 L_16b4d:
 $_0xfaa6 = detectSchoolType($_0x2dd2);
 goto L_231a5;
 L_a6bde:
 $_0x2dd2 = $this->dashboard->getSetting();
 goto L_16b4d;
 L_079e0:
 if (!$_0x9c1a) {
 list($_0x72f7, $_0x9c1a) = $this->resolveWaliKelasId($_0x6d44->username, $_0x42b4->id_tp, $_0x15c4->id_smt);
 } else {
 $_0x72f7 = $this->dashboard->getDataGuruByUsername($_0x6d44->username, $_0x42b4->id_tp, $_0x15c4->id_smt);
 }
 goto L_43e35;
 }
 public function getRaporSiswaLengkap($_0xa1c4, $_0xc84d)
 {
 try {
 $_0x3626 = $this->request->getGet("\x74\160");
 $_0xddf5 = $this->request->getGet("\x73\155\x74");
 $_0x7149 = $_0x3626 ? $this->dashboard->getTahunById($_0x3626) : $this->dashboard->getTahunActive();
 $_0x2639 = $_0xddf5 ? $this->dashboard->getSemesterById($_0xddf5) : $this->dashboard->getSemesterActive();
 $_0x66f1 = $this->raporKurmer->getRaporSiswaLengkap($_0xa1c4, $_0xc84d, $_0x7149->id_tp, $_0x2639->id_smt);
 return $this->output_json(["\x73\164\x61\164\x75\163" => true, "\x64\141\x74\141" => $_0x66f1]);
 } catch (\Throwable $_0xaea5) {
 log_message("\x65\162\x72\157\x72", "\x45\162\x72\157\x72\40\x69\156\x20\147\x65\164\x52\141\x70\157\x72\123\x69\163\x77\141\x4c\145\x6e\147\x6b\141\x70\72\x20" . $_0xaea5->getMessage());
 return $this->output_json(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => $_0xaea5->getMessage()]);
 }
 }
 public function cetakSampul($_0x485f, $_0x21d6)
 {
 goto L_24ede;
 L_e4d28:
 $_0x9f3f["\x73\155\x74\137\x61\143\x74\151\x76\145"] = $_0x384f;
 goto L_8ed63;
 L_24ede:
 $_0x865c = $this->dashboard->getTahunActive();
 goto L_a1ec8;
 L_671dd:
 $_0x9f3f = $this->raporKurmer->getRaporSiswaLengkap($_0x21d6, $_0x485f, $_0x865c->id_tp, $_0x384f->id_smt);
 goto L_18fd5;
 L_8ed63:
 return view("\x6d\145\x6d\142\x65\162\x73\57\x67\165\x72\165\x2f\162\x61\160\x6f\162\x2f\143\x65\164\x61\153\x2f\163\x61\155\x70\165\x6c", $_0x9f3f);
 L_a1ec8:
 $_0x384f = $this->dashboard->getSemesterActive();
 goto L_671dd;
 L_18fd5:
 $_0x9f3f["\x74\160\x5f\141\x63\164\x69\166\x65"] = $_0x865c;
 goto L_e4d28;
 }
 public function cetakIdentitas($_0x3835, $_0xbfb2)
 {
 goto L_f9ca5;
 L_0983c:
 $_0xef55["\x73\155\x74\137\x61\143\x74\151\x76\145"] = $_0xaf9d;
 goto L_4e254;
 L_4e254:
 return view("\x6d\145\x6d\142\x65\162\x73\57\x67\165\x72\165\x2f\162\x61\160\x6f\162\x2f\143\x65\164\x61\153\x2f\151\x64\145\x6e\164\x69\164\x61\163", $_0xef55);
 L_516ed:
 $_0xef55["\x74\160\x5f\141\x63\164\x69\166\x65"] = $_0xf8ed;
 goto L_0983c;
 L_f9ca5:
 $_0xf8ed = $this->dashboard->getTahunActive();
 goto L_1f52d;
 L_8e887:
 $_0xef55 = $this->raporKurmer->getRaporSiswaLengkap($_0xbfb2, $_0x3835, $_0xf8ed->id_tp, $_0xaf9d->id_smt);
 goto L_516ed;
 L_1f52d:
 $_0xaf9d = $this->dashboard->getSemesterActive();
 goto L_8e887;
 }
 public function cetakLeger($_0x6372 = null)
 {
 goto L_f316e;
 L_15c22:
 $_0xbca6 = $this->dashboard->getSetting();
 goto L_cf797;
 L_3aa1a:
 $_0x6465 = $this->dashboard->getSemesterActive();
 goto L_b0311;
 L_b2f28:
 $_0x4d26 = $this->raporKurmer->getNilaiLegerKelas($_0x6372, $_0xad71->id_tp, $_0x6465->id_smt, $_0x3ac4, $_0xe322, $_0x7d5e);
 goto L_15c22;
 L_0f706:
 $_0x3ac4 = $this->raporKurmer->getMapelRaporKelas($_0x6372, $_0xad71->id_tp, $_0x6465->id_smt);
 goto L_377cd;
 L_f316e:
 $_0xfb5d = (object) ["\x69\144" => session()->get("\x69\144\x5f\165\x73\145\x72"), "\x75\163\x65\162\x6e\141\x6d\145" => session()->get("\x75\163\x65\162\x6e\141\x6d\145")];
 goto L_c1d98;
 L_5f1d1:
 if (!empty($_0x9a9b->guru_id)) {
 $_0x1270 = $this->db->table("\x6d\141\x73\164\x65\162\x5f\147\x75\162\x75")->where("\x69\144\x5f\147\x75\162\x75", $_0x9a9b->guru_id)->get()->getRow();
 if ($_0x1270) {
 $_0x6a27 = $_0x1270;
 }
 }
 goto L_a6a2a;
 L_01359:
 return view("\x6d\145\x6d\142\x65\162\x73\57\x67\165\x72\165\x2f\162\x61\160\x6f\162\x2f\154\x65\147\x65\162\x2f\144\x61\164\x61", $_0xad09);
 L_a4368:
 $_0xad09 = ["\x75\163\x65\162" => $_0xfb5d, "\x67\165\x72\165" => $_0x6a27, "\x67\165\x72\165\x5f\153\x65\160\x73\145\x6b" => $_0x9d7c, "\x6a\165\x64\165\x6c" => "\x4c\145\x67\147\x65\162\x20\116\x69\154\x61\151\x20\122\x61\160\x6f\162", "\x73\165\x62\152\x75\144\x75\154" => "\x52\145\x6b\141\x70\151\x74\165\x6c\141\x73\151\x20\116\x69\154\x61\151\x20\101\x6b\150\x69\162\x20\113\x65\154\x61\163", "\x74\160\x5f\141\x63\164\x69\166\x65" => $_0xad71, "\x73\155\x74\137\x61\143\x74\151\x76\145" => $_0x6465, "\x6b\145\x6c\141\x73\145\x73" => $_0x9a9b, "\x73\151\x73\167\x61\163" => $_0xe322, "\x6d\141\x70\145\x6c\163" => $_0x3ac4, "\x6e\151\x6c\141\x69" => $_0x4d26, "\x73\145\x74\164\x69\156\x67" => $_0xbca6, "\x69\163\x5f\153\x65\155\x65\156\x61\147" => $_0x9571->is_kemenag, "\x73\143\x68\157\x6f\154\x5f\164\x79\160\x65" => $_0x9571->school_type, "\x72\141\x70\157\x72\137\x73\145\x74\164\x69\156\x67" => $_0xbee5, "\x63\165\x72\162\x65\156\x74\137\x6d\157\x64\145" => $_0x1d30];
 goto L_01359;
 L_377cd:
 if (empty($_0x3ac4)) {
 $_0x3ac4 = $this->master->getAllMapel();
 }
 goto L_5f1d1;
 L_607e5:
 $_0xbee5 = $this->raporKurmer->getSetting($_0xad71->id_tp, $_0x6465->id_smt);
 goto L_2136e;
 L_44d62:
 $_0xe322 = $_0x6372 ? $this->rapor->getDetailSiswa($_0x6372, $_0xad71->id_tp, $_0x6465->id_smt) : [];
 goto L_0f706;
 L_b0311:
 if (!$_0x6372) {
 list($_0x6a27, $_0x6372) = $this->resolveWaliKelasId($_0xfb5d->username, $_0xad71->id_tp, $_0x6465->id_smt);
 } else {
 $_0x6a27 = $this->dashboard->getDataGuruByUsername($_0xfb5d->username, $_0xad71->id_tp, $_0x6465->id_smt);
 }
 goto L_25779;
 L_b27ae:
 $_0x9d7c = $this->db->table("\x6d\141\x73\164\x65\162\x5f\147\x75\162\x75")->like("\x6e\141\x6d\141\x5f\147\x75\162\x75", "\x52\157\x7a\141\x6b")->get()->getRow();
 goto L_607e5;
 L_49b59:
 $_0x1d30 = $_0x7d5e ?: $_0xbee5->cbt_convert_mode ?? "\x6b\141\x74\162\x6f\154";
 goto L_b2f28;
 L_25779:
 $_0x9a9b = $_0x6372 ? $this->kelas->get_one($_0x6372) : (object) ["\x6e\141\x6d\141\x5f\153\x65\154\x61\163" => "\x2d"];
 goto L_44d62;
 L_cf797:
 $_0x9571 = detectSchoolType($_0xbca6);
 goto L_a4368;
 L_2136e:
 $_0x7d5e = $this->request->getGet("\x6d\157\x64\145");
 goto L_49b59;
 L_a6a2a:
 if (empty($_0x6a27)) {
 $_0x6a27 = $this->db->table("\x6d\141\x73\164\x65\162\x5f\147\x75\162\x75")->where("\x75\163\x65\162\x6e\141\x6d\145", $_0xfb5d->username)->get()->getRow();
 }
 goto L_b27ae;
 L_c1d98:
 $_0xad71 = $this->dashboard->getTahunActive();
 goto L_3aa1a;
 }
 public function cetakRanking($_0xe40d = null)
 {
 goto L_bed82;
 L_bed82:
 $_0xe246 = (object) ["\x69\144" => session()->get("\x69\144\x5f\165\x73\145\x72"), "\x75\163\x65\162\x6e\141\x6d\145" => session()->get("\x75\163\x65\162\x6e\141\x6d\145")];
 goto L_14acb;
 L_f2833:
 if (empty($_0x2a69)) {
 $_0x2a69 = $this->master->getAllMapel();
 }
 goto L_226bc;
 L_fa280:
 if (empty($_0x5261)) {
 $_0x5261 = $this->db->table("\x6d\141\x73\164\x65\162\x5f\147\x75\162\x75")->where("\x75\163\x65\162\x6e\141\x6d\145", $_0xe246->username)->get()->getRow();
 }
 goto L_f9fd8;
 L_0e8fe:
 $_0xab36 = $this->dashboard->getSemesterActive();
 goto L_11d2c;
 L_f18e8:
 return view("\x6d\145\x6d\142\x65\162\x73\57\x67\165\x72\165\x2f\162\x61\160\x6f\162\x2f\154\x65\147\x65\162\x2f\162\x61\156\x6b\151\x6e\147", $_0xe248);
 L_c510b:
 $_0x4f2b = $this->dashboard->getSetting();
 goto L_29181;
 L_11d2c:
 if (!$_0xe40d) {
 list($_0x5261, $_0xe40d) = $this->resolveWaliKelasId($_0xe246->username, $_0xfb2b->id_tp, $_0xab36->id_smt);
 } else {
 $_0x5261 = $this->dashboard->getDataGuruByUsername($_0xe246->username, $_0xfb2b->id_tp, $_0xab36->id_smt);
 }
 goto L_e3946;
 L_9b23f:
 $_0x44af = $this->raporKurmer->getSetting($_0xfb2b->id_tp, $_0xab36->id_smt);
 goto L_e3763;
 L_344f8:
 $_0x5271 = $_0x2b04 ?: $_0x44af->cbt_convert_mode ?? "\x6b\141\x74\162\x6f\154";
 goto L_b8bfe;
 L_4b0c5:
 $_0xe248 = ["\x75\163\x65\162" => $_0xe246, "\x67\165\x72\165" => $_0x5261, "\x67\165\x72\165\x5f\153\x65\160\x73\145\x6b" => $_0x45ef, "\x6a\165\x64\165\x6c" => "\x52\141\x6e\153\x69\156\x67\40\x4e\151\x6c\141\x69\40\x4b\145\x6c\141\x73", "\x73\165\x62\152\x75\144\x75\154" => "\x50\145\x72\151\x6e\147\x6b\141\x74\40\x4e\151\x6c\141\x69\40\x43\141\x70\141\x69\141\x6e\40\x42\145\x6c\141\x6a\141\x72\40\x50\145\x73\145\x72\164\x61\40\x44\151\x64\151\x6b", "\x74\160\x5f\141\x63\164\x69\166\x65" => $_0xfb2b, "\x73\155\x74\137\x61\143\x74\151\x76\145" => $_0xab36, "\x6b\145\x6c\141\x73\145\x73" => $_0xccc1, "\x73\151\x73\167\x61\163" => $_0x4500, "\x6d\141\x70\145\x6c\163" => $_0x2a69, "\x6e\151\x6c\141\x69" => $_0xec69, "\x73\145\x74\164\x69\156\x67" => $_0x4f2b, "\x69\163\x5f\153\x65\155\x65\156\x61\147" => $_0x2a48->is_kemenag, "\x73\143\x68\157\x6f\154\x5f\164\x79\160\x65" => $_0x2a48->school_type, "\x72\141\x70\157\x72\137\x73\145\x74\164\x69\156\x67" => $_0x44af, "\x69\163\x5f\162\x61\156\x6b\151\x6e\147" => true, "\x63\165\x72\162\x65\156\x74\137\x6d\157\x64\145" => $_0x5271];
 goto L_f18e8;
 L_e3763:
 $_0x2b04 = $this->request->getGet("\x6d\157\x64\145");
 goto L_344f8;
 L_9f9f1:
 $_0x4500 = $_0xe40d ? $this->rapor->getDetailSiswa($_0xe40d, $_0xfb2b->id_tp, $_0xab36->id_smt) : [];
 goto L_6f7d2;
 L_e3946:
 $_0xccc1 = $_0xe40d ? $this->kelas->get_one($_0xe40d) : (object) ["\x6e\141\x6d\141\x5f\153\x65\154\x61\163" => "\x2d"];
 goto L_9f9f1;
 L_29181:
 $_0x2a48 = detectSchoolType($_0x4f2b);
 goto L_4b0c5;
 L_226bc:
 if (!empty($_0xccc1->guru_id)) {
 $_0xdd23 = $this->db->table("\x6d\141\x73\164\x65\162\x5f\147\x75\162\x75")->where("\x69\144\x5f\147\x75\162\x75", $_0xccc1->guru_id)->get()->getRow();
 if ($_0xdd23) {
 $_0x5261 = $_0xdd23;
 }
 }
 goto L_fa280;
 L_6f7d2:
 $_0x2a69 = $this->raporKurmer->getMapelRaporKelas($_0xe40d, $_0xfb2b->id_tp, $_0xab36->id_smt);
 goto L_f2833;
 L_f9fd8:
 $_0x45ef = $this->db->table("\x6d\141\x73\164\x65\162\x5f\147\x75\162\x75")->like("\x6e\141\x6d\141\x5f\147\x75\162\x75", "\x52\157\x7a\141\x6b")->get()->getRow();
 goto L_9b23f;
 L_b8bfe:
 $_0xec69 = $this->raporKurmer->getNilaiLegerKelas($_0xe40d, $_0xfb2b->id_tp, $_0xab36->id_smt, $_0x2a69, $_0x4500, $_0x2b04);
 goto L_c510b;
 L_14acb:
 $_0xfb2b = $this->dashboard->getTahunActive();
 goto L_0e8fe;
 }
 public function downloadLeger()
 {
 goto L_b0bb1;
 L_f9b87:
 $_0x9c03 = [];
 goto L_4d6ad;
 L_52015:
 $_0x5ad8 = [];
 goto L_7f0bf;
 L_aa92e:
 $_0x6d83 = $this->dashboard->getSetting();
 goto L_4d5a0;
 L_72ff2:
 $_0x8b39["\x65\153\x73\164\x72\141\x73"] = $_0xb73f;
 goto L_b9383;
 L_9f809:
 $_0x6cf5 = [];
 goto L_9ec45;
 L_27dab:
 foreach ($_0x9e7d as $_0xb1c3) {
 $_0xb1c3->nilai = $this->maybe_unserialize($_0xb1c3->nilai);
 }
 goto L_f00a1;
 L_0e492:
 $_0x382d = [];
 goto L_97861;
 L_d9a5e:
 $_0x8b39["\x6b\153\x6d"] = $_0x5ad8;
 goto L_2b578;
 L_0db0f:
 $_0x770e = $this->dashboard->getSemesterActive();
 goto L_aa92e;
 L_ba459:
 $_0x8b39["\x73\155\x74\137\x61\143\x74\151\x76\145"] = $_0x770e;
 goto L_87ee9;
 L_f0600:
 $_0x70bf = [];
 goto L_e345d;
 L_7db33:
 $_0xe1e9 = [];
 goto L_1fd91;
 L_2b625:
 $_0x8b39["\x64\145\x73\153\x72\151\x70\163\x69"] = $_0x81fc;
 goto L_811c8;
 L_be8ec:
 $_0x81fc = [];
 goto L_852c5;
 L_852c5:
 $_0x3440 = [];
 goto L_c99d0;
 L_4d5a0:
 $_0x9f31 = (object) ["\x69\144" => session()->get("\x69\144\x5f\165\x73\145\x72"), "\x75\163\x65\162\x6e\141\x6d\145" => session()->get("\x75\163\x65\162\x6e\141\x6d\145")];
 goto L_c9965;
 L_21a43:
 $_0x8b39["\x74\160"] = $this->dashboard->getTahun();
 goto L_cc981;
 L_6ceb4:
 $_0x8b39["\x6e\151\x6c\141\x69\137\x65\153\x73\164\x72\141"] = $_0x6cf5;
 goto L_4633b;
 L_811c8:
 $_0x8b39["\x61\142\x73\145\x6e\163\x69"] = $_0x3440;
 goto L_6ceb4;
 L_15101:
 $_0xbc2e = [];
 goto L_c4f2f;
 L_2ef5f:
 $_0xa629 = [];
 goto L_fbccd;
 L_bc5ad:
 $_0x968e = [];
 goto L_15101;
 L_e345d:
 $_0xbda7 = [];
 goto L_bc5ad;
 L_f8cec:
 $_0x8b39["\x6b\145\x6c\141\x73\137\x6c\151\x73\164"] = $this->kelas->getKelasList($_0x4e62->id_tp, $_0x770e->id_smt);
 goto L_ee299;
 L_97861:
 $_0x4a05 = [];
 goto L_ddbdc;
 L_7f0bf:
 $_0x2cea = [];
 goto L_f9b87;
 L_648c5:
 $_0x8b39["\x73\151\x73\167\x61\163"] = $_0x9e55;
 goto L_72ff2;
 L_4633b:
 $_0x8b39["\x6d\141\x70\145\x6c\137\x65\153\x73\164\x72\141"] = $_0xc7b3;
 goto L_d9a5e;
 L_f6a26:
 $_0xfc83 = [];
 goto L_0e492;
 L_0f7cb:
 $_0xee4a = [];
 goto L_4ced9;
 L_b6038:
 $_0x8b39["\x6d\141\x70\145\x6c\163"] = $_0xb041;
 goto L_648c5;
 L_b9383:
 $_0x8b39["\x6e\151\x6c\141\x69"] = (array) json_decode(json_encode($_0x9c03));
 goto L_d82bd;
 L_f00a1:
 $_0x1054 = $this->rapor->getRaporSetting($_0x4e62->id_tp, $_0x770e->id_smt);
 goto L_52015;
 L_3900c:
 $_0xb041 = $this->master->getAllMapel();
 goto L_639f5;
 L_9ec45:
 for ($_0x345e = 0; $_0x345e < count($_0x9e55); $_0x345e++) {
 $_0x9e2f = $_0x9e55[$_0x345e];
 $_0x807e = $_0x9e2f->id_siswa;
 foreach ($_0xb041 as $_0x47cd) {
 $_0x9273 = ["\x70\162\x65\144\x69\153\x61\164" => ''];
 $_0x4126 = $this->rapor->getNilaiSikapKelas($_0x9746, $_0x9e2f->id_siswa, $_0x4e62->id_tp, $_0x770e->id_smt, "\x31");
 $_0x2cea[$_0x9e2f->id_siswa][1] = ["\x64\145\x73\153\x72\151\x70\163\x69" => $_0x4126 == null ? '' : $_0x4126->deskripsi, "\x70\162\x65\144\x69\153\x61\164" => $_0x4126 == null ? $_0x9273 : $this->maybe_unserialize($_0x4126->nilai)];
 $_0xe13e = $this->rapor->getNilaiSikapKelas($_0x9746, $_0x9e2f->id_siswa, $_0x4e62->id_tp, $_0x770e->id_smt, "\x32");
 $_0x2cea[$_0x9e2f->id_siswa][2] = ["\x64\145\x73\153\x72\151\x70\163\x69" => $_0xe13e == null ? '' : $_0xe13e->deskripsi, "\x70\162\x65\144\x69\153\x61\164" => $_0xe13e == null ? $_0x9273 : $this->maybe_unserialize($_0xe13e->nilai)];
 $_0x97d3 = ["\x6b\137\x72\141\x74\141\x5f\162\x61\164\x61" => '', "\x6b\137\x70\162\x65\144\x69\153\x61\164" => '', "\x70\137\x72\141\x74\141\x5f\162\x61\164\x61" => '', "\x6e\151\x6c\141\x69\137\x70\141\x73" => '', "\x6e\151\x6c\141\x69" => '', "\x70\162\x65\144\x69\153\x61\164" => ''];
 $_0xe662 = $this->rapor->getNilaiRapor($_0x47cd->id_mapel, $_0x9746, $_0x807e, $_0x4e62->id_tp, $_0x770e->id_smt);
 $_0x9c03[$_0x807e][$_0x47cd->id_mapel] = $_0xe662 == null ? $_0x97d3 : $_0xe662;
 //$nilai[$id_siswa][] = $nr==null ? $dummyNilai : $nr;
 $_0x2080 = $this->rapor->getNilaiMapelPtsSiswa($_0x47cd->id_mapel, $_0x807e, $_0x4e62->id_tp, $_0x770e->id_smt);
 $_0xdb1e[$_0x807e][$_0x47cd->id_mapel] = $_0x2080 == null ? 0 : $_0x2080->nilai;
 $_0x4862 = ["\x72\141\x6e\153\x69\156\x67" => '', "\x72\141\x6e\153\x5f\144\x65\163\x6b\162\x69\160\x73\151" => '', "\x70\61" => '', "\x70\61\x5f\144\x65\163\x6b" => '', "\x70\62" => '', "\x70\62\x5f\144\x65\163\x6b" => '', "\x70\63" => '', "\x70\63\x5f\144\x65\163\x6b" => '', "\x73\141\x72\141\x6e" => ''];
 $_0xdd4d = ["\x73" => '', "\x69" => '', "\x61" => ''];
 //$nd = $this->rapor->getRaporDeskripsi($id_kelas, $siswa->id_siswa, $tp->id_tp, $smt->id_smt);
 //$desks[$id_siswa] = $nd == null ? $dummyDesks : $nd;
 //$absensi[$id_siswa] = $nd == null ? $dummyAbsen : $this->maybe_unserialize($nd->nilai);
 $_0x3440[$_0x807e] = isset($_0x9e7d[$_0x807e]) ? $_0x9e7d[$_0x807e]->nilai : ["\x6e\151\x6c\141\x69" => $_0xdd4d];
 if ($_0x1054->kkm_tunggal == "\x31") {
 $_0x5ad8[$_0x47cd->id_mapel] = $_0x1054;
 } else {
 $_0x5ad8[$_0x47cd->id_mapel] = $this->rapor->getKkm($_0x47cd->id_mapel . $_0x9746 . $_0x4e62->id_tp . $_0x770e->id_smt . "\x31");
 }
 foreach ($_0xb73f as $_0xd7e9) {
 $_0x7ada = ["\x64\145\x73\153\x72\151\x70\163\x69" => '', "\x6e\151\x6c\141\x69" => '', "\x70\162\x65\144\x69\153\x61\164" => ''];
 $_0x535b = $this->maybe_unserialize($_0xd7e9->ekstra);
 foreach ($_0x535b as $_0x19ef) {
 $_0x36f3 = $_0x19ef->ekstra;
 $_0xc7b3[$_0x36f3] = $this->kelas->getEkskulById($_0x36f3);
 if ($_0x36f3 != null) {
 $_0xe4a2 = $this->rapor->getEkstraKelas($_0x36f3, $_0x9e2f->id_siswa, $_0x4e62->id_tp, $_0x770e->id_smt);
 $_0x6cf5[$_0x807e][$_0x36f3] = $_0xe4a2 == null ? json_decode(json_encode($_0x7ada)) : $_0xe4a2;
 }
 }
 }
 }
 }
 goto L_21a43;
 L_c32db:
 $_0x9e7d = $_0x9746 ? $this->rapor->getCatatanWaliByKelas($_0x9746, $_0x4e62->id_tp, $_0x770e->id_smt) : [];
 goto L_27dab;
 L_c99d0:
 $_0xc7b3 = [];
 goto L_9f809;
 L_c4f2f:
 $_0x3bc4 = [];
 goto L_2ef5f;
 L_2b578:
 $_0x8b39["\x72\141\x70\157\x72"] = $_0x1054;
 goto L_6645a;
 L_9e1f4:
 $_0x6a23 = $_0x9746 ? $this->kelas->get_one($_0x9746) : (object) ["\x6e\141\x6d\141\x5f\153\x65\154\x61\163" => "\x2d"];
 goto L_1ce6a;
 L_639f5:
 $_0xb73f = $_0x9746 ? $this->kelas->getKelasEkskul($_0x9746, $_0x4e62->id_tp, $_0x770e->id_smt) : [];
 goto L_2ac0a;
 L_9e24f:
 $_0x6087 = [];
 goto L_f0600;
 L_1ce6a:
 $_0x9e55 = $_0x9746 ? $this->kelas->getKelasSiswa($_0x9746, $_0x4e62->id_tp, $_0x770e->id_smt) : [];
 goto L_3900c;
 L_6645a:
 $_0x8b39["\x6e\141\x69\153"] = $_0x9746 ? $this->rapor->getKenaikanRapor($_0x9746, $_0x4e62->id_tp, $_0x770e->id_smt) : [];
 goto L_0f7cb;
 L_fbccd:
 $_0x1a90 = [];
 goto L_cd524;
 L_cd524:
 $_0xe798 = [];
 goto L_72764;
 L_2ac0a:
 $_0x6324 = $_0x9746 ? $this->rapor->getPrestasiByKelas($_0x9746, $_0x4e62->id_tp, $_0x770e->id_smt) : [];
 goto L_c32db;
 L_7ea39:
 $_0xd22a = [];
 goto L_9e24f;
 L_72764:
 $_0x3087 = [];
 goto L_82b79;
 L_ddbdc:
 for ($_0x345e = 0; $_0x345e < count($_0x9e55); $_0x345e++) {
 $_0x9e2f = $_0x9e55[$_0x345e];
 $_0x9c03 = $_0x9c03[$_0x9e2f->id_siswa];
 $_0xee4a[] = $_0x345e + 1;
 $_0x4d89[] = $_0x9e2f->nisn;
 $_0xd22a[] = $_0x9e2f->nama;
 $_0x6087[] = $_0x9c03->p1;
 $_0x70bf[] = $_0x9c03->p2;
 $_0xbda7[] = $_0x9c03->p3;
 $_0x968e[] = $_0x9c03->p4;
 $_0xbc2e[] = $_0x9c03->p5;
 $_0x3bc4[] = $_0x9c03->p6;
 $_0xa629[] = $_0x9c03->p7;
 $_0x1a90[] = $_0x9c03->p8;
 $_0xe798[] = $_0x9c03->k1;
 $_0x3087[] = $_0x9c03->k2;
 $_0x1a27[] = $_0x9c03->k3;
 $_0xe1e9[] = $_0x9c03->k4;
 $_0xc6ef[] = $_0x9c03->k5;
 $_0xfc83[] = $_0x9c03->k6;
 $_0x382d[] = $_0x9c03->k7;
 $_0x4a05[] = $_0x9c03->k8;
 }
 goto L_697ab;
 L_9b93c:
 $_0x8b39["\x73\155\x74"] = $this->dashboard->getSemester();
 goto L_ba459;
 L_ee299:
 $_0x8b39["\x6b\145\x6c\141\x73\145\x73"] = $_0x6a23;
 goto L_b6038;
 L_82b79:
 $_0x1a27 = [];
 goto L_7db33;
 L_1fd91:
 $_0xc6ef = [];
 goto L_f6a26;
 L_87ee9:
 $_0x8b39["\x67\165\x72\165"] = $_0xb7dd;
 goto L_bf211;
 L_bf211:
 $_0x8b39["\x69\144\x5f\153\x65\154\x61\163"] = $_0x9746;
 goto L_f8cec;
 L_d82bd:
 $_0x8b39["\x6e\151\x6c\141\x69\137\x70\164\x73"] = (array) json_decode(json_encode($_0xdb1e));
 goto L_c0494;
 L_697ab:
 return $this->output_json($_0x8b39);
 L_cc981:
 $_0x8b39["\x74\160\x5f\141\x63\164\x69\166\x65"] = $_0x4e62;
 goto L_9b93c;
 L_c0494:
 $_0x8b39["\x73\151\x6b\141\x70"] = $_0x2cea;
 goto L_2b625;
 L_b0bb1:
 $_0x4e62 = $this->dashboard->getTahunActive();
 goto L_0db0f;
 L_4d6ad:
 $_0xdb1e = [];
 goto L_be8ec;
 L_c9965:
 list($_0xb7dd, $_0x9746) = $this->resolveWaliKelasId($_0x9f31->username, $_0x4e62->id_tp, $_0x770e->id_smt);
 goto L_9e1f4;
 L_4ced9:
 $_0x4d89 = [];
 goto L_7ea39;
 }
 public function dkn()
 {
 goto L_28e74;
 L_b02bc:
 list($_0x29b9, $_0x39f7) = $this->resolveWaliKelasId($_0x360a->username, $_0x1e97->id_tp, $_0xae5f->id_smt);
 goto L_2cda5;
 L_4234e:
 $_0xa922 = $_0x39f7 ? $this->rapor->getCatatanWaliByKelas($_0x39f7, $_0x1e97->id_tp, $_0xae5f->id_smt) : [];
 goto L_2dfb7;
 L_190c0:
 $_0x360a = (object) ["\x69\144" => session()->get("\x69\144\x5f\165\x73\145\x72"), "\x75\163\x65\162\x6e\141\x6d\145" => session()->get("\x75\163\x65\162\x6e\141\x6d\145")];
 goto L_75031;
 L_82ae4:
 $_0xa021 = [];
 goto L_b88df;
 L_18dad:
 $_0x2cd9["\x72\141\x70\157\x72"] = $_0x7270;
 goto L_129d1;
 L_ec43c:
 $_0x2cd9["\x67\165\x72\165"] = $_0x29b9;
 goto L_77fd6;
 L_49ba4:
 $_0x2cd9["\x73\155\x74"] = $this->dashboard->getSemester();
 goto L_fab31;
 L_48210:
 $_0xd265 = $this->master->getAllMapel();
 goto L_8b006;
 L_9d7a1:
 $_0x635c = [];
 goto L_b3adf;
 L_1ddd9:
 $_0x2cd9["\x6e\151\x6c\141\x69"] = $_0xa587;
 goto L_11cd6;
 L_3f88f:
 $_0x7270 = $this->rapor->getRaporSetting($_0x1e97->id_tp, $_0xae5f->id_smt);
 goto L_9d7a1;
 L_8b006:
 $_0x1e04 = $_0x39f7 ? $this->kelas->getKelasEkskul($_0x39f7, $_0x1e97->id_tp, $_0xae5f->id_smt) : [];
 goto L_162a2;
 L_8e41f:
 $_0x2cd9["\x74\160\x5f\141\x63\164\x69\166\x65"] = $_0x1e97;
 goto L_49ba4;
 L_949a7:
 $_0x2cd9["\x65\153\x73\164\x72\141\x73"] = $_0x1e04;
 goto L_1ddd9;
 L_b3e5d:
 return view("\x6d\145\x6d\142\x65\162\x73\57\x67\165\x72\165\x2f\162\x61\160\x6f\162\x2f\144\x6b\156\x2f\144\x61\164\x61", $_0x2cd9);
 L_b88df:
 $_0x9355 = [];
 goto L_4850a;
 L_11cd6:
 $_0x2cd9["\x6e\151\x6c\141\x69\137\x70\164\x73"] = $_0xa021;
 goto L_3881d;
 L_fab31:
 $_0x2cd9["\x73\155\x74\137\x61\143\x74\151\x76\145"] = $_0xae5f;
 goto L_ec43c;
 L_dbbd1:
 $_0xae5f = $this->dashboard->getSemesterActive();
 goto L_b02bc;
 L_e724c:
 $_0x2cd9["\x6d\141\x70\145\x6c\137\x65\153\x73\164\x72\141"] = $_0x2bb9;
 goto L_0edc5;
 L_80f9a:
 $_0x725f = $_0x39f7 ? $this->kelas->getKelasSiswa($_0x39f7, $_0x1e97->id_tp, $_0xae5f->id_smt) : [];
 goto L_48210;
 L_defbd:
 $_0x2cd9["\x64\145\x73\153\x72\151\x70\163\x69"] = $_0x9355;
 goto L_d0e2f;
 L_0e29e:
 $_0x2cd9["\x6b\145\x6c\141\x73\137\x6c\151\x73\164"] = $this->kelas->getKelasList($_0x1e97->id_tp, $_0xae5f->id_smt);
 goto L_beb7d;
 L_3d9cb:
 $_0x2cd9["\x6e\151\x6c\141\x69\137\x65\153\x73\164\x72\141"] = $_0x42b1;
 goto L_e724c;
 L_2cda5:
 $_0xaf00 = $_0x39f7 ? $this->kelas->get_one($_0x39f7) : (object) ["\x6e\141\x6d\141\x5f\153\x65\154\x61\163" => "\x2d"];
 goto L_80f9a;
 L_2dfb7:
 foreach ($_0xa922 as $_0x547f) {
 $_0x547f->nilai = $this->maybe_unserialize($_0x547f->nilai);
 }
 goto L_3f88f;
 L_0edc5:
 $_0x2cd9["\x6b\153\x6d"] = $_0x635c;
 goto L_18dad;
 L_37873:
 $_0x42b1 = [];
 goto L_35341;
 L_fbed7:
 $_0x2bb9 = [];
 goto L_37873;
 L_0ba3e:
 $_0x2cd9["\x6d\141\x70\145\x6c\163"] = $_0xd265;
 goto L_a968d;
 L_b3adf:
 $_0xa027 = [];
 goto L_86dec;
 L_4850a:
 $_0xd1fc = [];
 goto L_fbed7;
 L_581e9:
 $_0x2cd9["\x74\160"] = $this->dashboard->getTahun();
 goto L_8e41f;
 L_75031:
 $_0x2cd9 = ["\x75\163\x65\162" => $_0x360a, "\x6a\165\x64\165\x6c" => "\x44\141\x66\164\x61\162\x20\113\x75\155\x70\165\x6c\141\x6e\40\x4e\151\x6c\141\x69\40\x4b\145\x6c\141\x73\40", "\x73\165\x62\152\x75\144\x75\154" => "\x43\145\x74\141\x6b\40\x44\113\x4e\40", "\x73\145\x74\164\x69\156\x67" => $_0xa312];
 goto L_097aa;
 L_beb7d:
 $_0x2cd9["\x6b\145\x6c\141\x73\145\x73"] = $_0xaf00;
 goto L_0ba3e;
 L_a968d:
 $_0x2cd9["\x73\151\x73\167\x61\163"] = $_0x725f;
 goto L_949a7;
 L_86dec:
 $_0xa587 = [];
 goto L_82ae4;
 L_77fd6:
 $_0x2cd9["\x69\144\x5f\153\x65\154\x61\163"] = $_0x39f7;
 goto L_0e29e;
 L_129d1:
 $_0x2cd9["\x6e\141\x69\153"] = $_0x39f7 ? $this->rapor->getKenaikanRapor($_0x39f7, $_0x1e97->id_tp, $_0xae5f->id_smt) : [];
 goto L_b3e5d;
 L_35341:
 for ($_0xd105 = 0; $_0xd105 < count($_0x725f); $_0xd105++) {
 $_0x7b74 = $_0x725f[$_0xd105];
 $_0x6bfe = $_0x7b74->id_siswa;
 foreach ($_0xd265 as $_0xac4d) {
 $_0xd667 = ["\x70\162\x65\144\x69\153\x61\164" => ''];
 $_0x5323 = $this->rapor->getNilaiSikapKelas($_0x39f7, $_0x7b74->id_siswa, $_0x1e97->id_tp, $_0xae5f->id_smt, "\x31");
 $_0xa027[$_0x7b74->id_siswa][1] = ["\x64\145\x73\153\x72\151\x70\163\x69" => $_0x5323 == null ? '' : $_0x5323->deskripsi, "\x70\162\x65\144\x69\153\x61\164" => $_0x5323 == null ? $_0xd667 : $this->maybe_unserialize($_0x5323->nilai)];
 $_0xdb9b = $this->rapor->getNilaiSikapKelas($_0x39f7, $_0x7b74->id_siswa, $_0x1e97->id_tp, $_0xae5f->id_smt, "\x32");
 $_0xa027[$_0x7b74->id_siswa][2] = ["\x64\145\x73\153\x72\151\x70\163\x69" => $_0xdb9b == null ? '' : $_0xdb9b->deskripsi, "\x70\162\x65\144\x69\153\x61\164" => $_0xdb9b == null ? $_0xd667 : $this->maybe_unserialize($_0xdb9b->nilai)];
 $_0xbab6 = ["\x6d\141\x70\145\x6c" => $_0xac4d->nama_mapel, "\x6b\137\x72\141\x74\141\x5f\162\x61\164\x61" => '', "\x6b\137\x70\162\x65\144\x69\153\x61\164" => '', "\x70\137\x72\141\x74\141\x5f\162\x61\164\x61" => '', "\x6e\151\x6c\141\x69\137\x70\141\x73" => '', "\x6e\151\x6c\141\x69" => '', "\x70\162\x65\144\x69\153\x61\164" => ''];
 $_0x2264 = $this->rapor->getNilaiRapor($_0xac4d->id_mapel, $_0x39f7, $_0x6bfe, $_0x1e97->id_tp, $_0xae5f->id_smt);
 $_0x2264["\x6d\141\x70\145\x6c"] = $_0xac4d->nama_mapel;
 $_0xa587[$_0x6bfe][$_0xac4d->id_mapel] = $_0x2264 == null ? $_0xbab6 : $_0x2264;
 //$nilai[$id_siswa][] = $nr==null ? $dummyNilai : $nr;
 $_0xa882 = $this->rapor->getNilaiMapelPtsSiswa($_0xac4d->id_mapel, $_0x6bfe, $_0x1e97->id_tp, $_0xae5f->id_smt);
 $_0xa021[$_0x6bfe][$_0xac4d->id_mapel] = $_0xa882 == null ? 0 : $_0xa882->nilai;
 $_0x1200 = ["\x72\141\x6e\153\x69\156\x67" => '', "\x72\141\x6e\153\x5f\144\x65\163\x6b\162\x69\160\x73\151" => '', "\x70\61" => '', "\x70\61\x5f\144\x65\163\x6b" => '', "\x70\62" => '', "\x70\62\x5f\144\x65\163\x6b" => '', "\x70\63" => '', "\x70\63\x5f\144\x65\163\x6b" => '', "\x73\141\x72\141\x6e" => ''];
 $_0x872f = ["\x73" => '', "\x69" => '', "\x61" => ''];
 $_0xc472 = $this->rapor->getRaporDeskripsi($_0x39f7, $_0x7b74->id_siswa, $_0x1e97->id_tp, $_0xae5f->id_smt);
 $_0x9355[$_0x6bfe] = $_0xc472 == null ? json_decode(json_encode($_0x1200)) : $_0xc472;
 $_0xd1fc[$_0x6bfe] = $_0xc472 == null ? $_0x872f : $this->maybe_unserialize($_0xc472->nilai);
 if (isset($_0x7270->kkm_tunggal) && $_0x7270->kkm_tunggal == "\x31") {
 $_0x635c[$_0xac4d->id_mapel] = $_0x7270;
 } else {
 $_0x635c[$_0xac4d->id_mapel] = $this->rapor->getKkm($_0xac4d->id_mapel . $_0x39f7 . $_0x1e97->id_tp . $_0xae5f->id_smt . "\x31");
 }
 foreach ($_0x1e04 as $_0xf33a) {
 $_0x49c9 = ["\x64\145\x73\153\x72\151\x70\163\x69" => '', "\x6e\151\x6c\141\x69" => '', "\x70\162\x65\144\x69\153\x61\164" => ''];
 $_0x87f0 = $this->maybe_unserialize($_0xf33a->ekstra);
 foreach ($_0x87f0 as $_0x234a) {
 $_0xd28d = $_0x234a->ekstra;
 $_0x2bb9[$_0xd28d] = $this->kelas->getEkskulById($_0xd28d);
 if ($_0xd28d != null) {
 $_0xe9bf = $this->rapor->getEkstraKelas($_0xd28d, $_0x7b74->id_siswa, $_0x1e97->id_tp, $_0xae5f->id_smt);
 $_0x42b1[$_0x6bfe][$_0xd28d] = $_0xe9bf == null ? json_decode(json_encode($_0x49c9)) : $_0xe9bf;
 }
 }
 }
 }
 }
 goto L_581e9;
 L_3881d:
 $_0x2cd9["\x73\151\x6b\141\x70"] = $_0xa027;
 goto L_defbd;
 L_097aa:
 $_0x1e97 = $this->dashboard->getTahunActive();
 goto L_dbbd1;
 L_d0e2f:
 $_0x2cd9["\x61\142\x73\145\x6e\163\x69"] = $_0xd1fc;
 goto L_3d9cb;
 L_28e74:
 $_0xa312 = $this->dashboard->getSetting();
 goto L_190c0;
 L_162a2:
 $_0xf05d = $_0x39f7 ? $this->rapor->getPrestasiByKelas($_0x39f7, $_0x1e97->id_tp, $_0xae5f->id_smt) : [];
 goto L_4234e;
 }
}