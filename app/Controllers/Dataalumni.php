<?php
/*   ________________________________________
    |               NextGen Garuda CBT       |
    |    Protected & Distributed via GitHub  |
    |________________________________________|
*/
namespace App\Controllers;

class Dataalumni extends BaseController
{
 protected $rapor;
 protected $kelas;
 protected $dropdown;
 protected $master;
 protected $dashboard;
 protected $logging;
 protected $db;
 public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $_0xe10c)
 {
 goto L_78f76;
 L_7edae:
 $this->db = \Config\Database::connect();
 L_e73ca:
 $this->logging = new \App\Models\LogModel();
 goto L_7edae;
 L_249d4:
 $this->rapor = new \App\Models\RaporModel();
 goto L_0ca0c;
 L_78f76:
 parent::initController($request, $response, $_0xe10c);
 goto L_249d4;
 L_1f55d:
 $this->dropdown = new \App\Models\DropdownModel();
 goto L_ece71;
 L_66a59:
 $this->dashboard = new \App\Models\DashboardModel();
 goto L_e73ca;
 L_0ca0c:
 $this->kelas = new \App\Models\KelasModel();
 goto L_1f55d;
 L_ece71:
 $this->master = new \App\Models\MasterModel();
 goto L_66a59;
 }
 public function index()
 {
 goto L_262cd;
 L_509b3:
 return view("\x6d\141\x73\164\x65\162\x2f\141\x6c\165\x6d\156\x69\57\x64\141\x74\141", $_0x4740);
 L_262cd:
 $_0xa7c0 = session();
 goto L_252dc;
 L_0bccd:
 $_0x4796 = 0;
 goto L_41d46;
 L_ea621:
 $_0x216c = $this->dashboard->getSetting();
 goto L_9b7c3;
 L_721eb:
 $_0x9a99 = $this->request->getGet("\x74\141\x68\165\x6e");
 goto L_a940b;
 L_2cb48:
 $_0x2df9 = [];
 goto L_0bccd;
 L_73359:
 $_0x577a = 0;
 goto L_7e3a6;
 L_b6169:
 // 2. Statistik Buku Induk
 $_0xffc4 = 0;
 goto L_026eb;
 L_7e3a6:
 try {
 $_0xffc4 = (int) $this->db->table("\x62\165\x6b\165\x5f\151\x6e\144\x75\153")->where("\x73\164\x61\164\x75\163", "\x32")->countAllResults();
 $_0x574a = (int) $this->db->table("\x62\165\x6b\165\x5f\151\x6e\144\x75\153")->where("\x73\164\x61\164\x75\163", "\x33")->countAllResults();
 $_0x577a = (int) $this->db->table("\x62\165\x6b\165\x5f\151\x6e\144\x75\153")->where("\x73\164\x61\164\x75\163", "\x34")->countAllResults();
 } catch (\Throwable $_0xaad8) {
 }
 goto L_965a7;
 L_a788a:
 $_0xd99a = $this->master->getDistinctKelasAkhir();
 goto L_ff275;
 L_026eb:
 $_0x574a = 0;
 goto L_73359;
 L_bb3ce:
 // 1. Sinkronisasi buku_induk untuk siswa yang belum tercatat
 try {
 $_0xf4c3 = $this->db->table("\x6d\141\x73\164\x65\162\x5f\163\x69\163\x77\141")->countAllResults();
 $_0xa0b6 = $this->db->table("\x62\165\x6b\165\x5f\151\x6e\144\x75\153")->countAllResults();
 if ($_0xf4c3 > $_0xa0b6) {
 $_0x99f6 = $this->db->table("\x6d\141\x73\164\x65\162\x5f\163\x69\163\x77\141")->select("\x69\144\x5f\163\x69\163\x77\141\x2c\40\x75\151\x64")->get()->getResult();
 foreach ($_0x99f6 as $_0x3d45) {
 $_0x8794 = $this->db->table("\x62\165\x6b\165\x5f\151\x6e\144\x75\153")->select("\x69\144\x5f\163\x69\163\x77\141")->where("\x69\144\x5f\163\x69\163\x77\141", $_0x3d45->id_siswa)->countAllResults();
 if ($_0x8794 == 0) {
 $this->db->table("\x62\165\x6b\165\x5f\151\x6e\144\x75\153")->insert(["\x69\144\x5f\163\x69\163\x77\141" => $_0x3d45->id_siswa, "\x75\151\x64" => $_0x3d45->uid ?? null, "\x73\164\x61\164\x75\163" => 1]);
 }
 }
 }
 } catch (\Throwable $_0xaad8) {
 }
 goto L_b6169;
 L_41d46:
 try {
 $_0xe898 = $this->db->table("\x6d\141\x73\164\x65\162\x5f\153\x65\154\x61\163\x20\153")->select("\x6b\56\x69\144\x5f\153\x65\154\x61\163\x2c\40\x6b\56\x6e\141\x6d\141\x5f\153\x65\154\x61\163\x2c\40\x6b\56\x6c\145\x76\145\x6c\137\x69\144\x2c\40\x43\117\x55\116\x54\50\x6b\163\x2e\151\x64\137\x73\151\x73\167\x61\51\x20\141\x73\40\x6a\155\x6c\137\x73\151\x73\167\x61")->join("\x6b\145\x6c\141\x73\137\x73\151\x73\167\x61\40\x6b\163", "\x6b\56\x69\144\x5f\153\x65\154\x61\163\x20\75\x20\153\x73\56\x69\144\x5f\153\x65\154\x61\163\x20\101\x4e\104\x20\153\x73\56\x69\144\x5f\164\x70\40\x3d\40" . (int) $_0x28f0->id_tp . "\x20\101\x4e\104\x20\153\x73\56\x69\144\x5f\163\x6d\164\x20\75\x20" . (int) $_0x4733->id_smt, "\x6c\145\x66\164")->where("\x6b\56\x6c\145\x76\145\x6c\137\x69\144\x20\76\x3d", $_0xc1be)->groupBy("\x6b\56\x69\144\x5f\153\x65\154\x61\163")->orderBy("\x6b\56\x6c\145\x76\145\x6c\137\x69\144", "\x41\123\x43")->orderBy("\x6b\56\x6e\141\x6d\141\x5f\153\x65\154\x61\163", "\x41\123\x43");
 $_0x2df9 = $_0xe898->get()->getResult();
 foreach ($_0x2df9 as $_0x7014) {
 $_0x4796 += (int) $_0x7014->jml_siswa;
 }
 } catch (\Throwable $_0xaad8) {
 }
 goto L_7ad69;
 L_88bd6:
 $_0x8708 = 0;
 goto L_c7253;
 L_680e3:
 $_0x28f0 = $this->dashboard->getTahunActive();
 goto L_9ddea;
 L_e2688:
 if (!empty($_0x1c16) && $_0x1c16 !== "\x61\154\x6c" && $_0x1c16 !== "\x30") {
 $_0xa7bb->where("\x61\56\x6b\145\x6c\141\x73\137\x61\153\x68\151\x72", $_0x1c16);
 }
 goto L_b3af3;
 L_ff275:
 // 5. Cek kelulusan dari Rapor tahun sebelumnya
 $_0x4237 = $this->dashboard->getTpBefore($_0x28f0->tahun);
 goto L_88bd6;
 L_9ddea:
 $_0x4733 = $this->dashboard->getSemesterActive();
 goto L_26ed9;
 L_f18f3:
 $_0xf355 = $_0xa7bb->get()->getResult();
 goto L_b823f;
 L_b3af3:
 $_0xa7bb->orderBy("\x61\56\x74\141\x68\165\x6e\137\x6c\165\x6c\165\x73", "\x44\105\x53\103")->orderBy("\x62\56\x6e\141\x6d\141", "\x41\123\x43");
 goto L_f18f3;
 L_5454d:
 $_0x78b8 = $this->request->getGet("\x66\151\x6c\164\x65\162") ?? "\x32";
 goto L_721eb;
 L_252dc:
 if (!$_0xa7c0->get("\x69\163\x5f\154\x6f\147\x69\156")) {
 return redirect()->to("\x61\165\x74\150\x2f\154\x6f\147\x69\156");
 } elseif (!in_array((string) $_0xa7c0->get("\x72\157\x6c\145"), ["\x31", "\x34"])) {
 return redirect()->to("\x64\141\x73\150\x62\157\x61\162\x64")->with("\x65\162\x72\157\x72", "\x48\141\x6e\171\x61\40\x41\144\x6d\151\x6e\151\x73\164\x72\141\x74\157\x72\40\x79\141\x6e\147\x20\144\x69\142\x65\162\x69\40\x68\141\x6b\40\x75\156\x74\165\x6b\40\x6d\145\x6e\147\x61\153\x73\145\x73\40\x68\141\x6c\141\x6d\141\x6e\40\x69\156\x69");
 }
 goto L_5454d;
 L_a940b:
 $_0x1c16 = $this->request->getGet("\x6b\145\x6c\141\x73");
 goto L_25578;
 L_b823f:
 $_0x4740 = ["\x75\163\x65\162" => $_0x9cfc, "\x6a\165\x64\165\x6c" => "\x44\141\x74\141\x20\113\x65\154\x75\154\x75\163\x61\156\x20\46\x20\101\x6c\165\x6d\156\x69", "\x73\165\x62\152\x75\144\x75\154" => "\x44\141\x74\141\x20\101\x6c\165\x6d\156\x69", "\x73\145\x74\164\x69\156\x67" => $_0x216c, "\x73\143\x68\137\x69\156\x66\157" => $_0xdbdb, "\x74\160" => $_0x59bd, "\x74\160\x5f\141\x63\164\x69\166\x65" => $_0x28f0, "\x73\155\x74" => $this->dashboard->getSemester(), "\x73\155\x74\137\x61\143\x74\151\x76\145" => $_0x4733, "\x74\160\x5f\142\x65\146\x6f\162\x65" => $_0x4237, "\x74\141\x68\165\x6e\137\x6c\165\x6c\165\x73" => $_0xfe3c, "\x6b\145\x6c\141\x73\137\x61\153\x68\151\x72" => $_0xd99a, "\x66\151\x6c\164\x65\162\x5f\163\x65\154\x65\143\x74\145\x64" => $_0x78b8, "\x74\141\x68\165\x6e\137\x73\145\x6c\145\x63\164\x65\144" => $_0x9a99, "\x6b\145\x6c\141\x73\137\x73\145\x6c\145\x63\164\x65\144" => $_0x1c16, "\x6a\165\x6d\154\x61\150\x5f\154\x75\154\x75\163" => $_0x8708, "\x61\154\x75\155\x6e\151\x73" => $_0xf355, "\x74\157\x74\141\x6c\137\x61\154\x75\155\x6e\151" => $_0xffc4, "\x74\157\x74\141\x6c\137\x70\151\x6e\144\x61\150" => $_0x574a, "\x74\157\x74\141\x6c\137\x6b\145\x6c\165\x61\162" => $_0x577a, "\x74\157\x74\141\x6c\137\x61\153\x74\151\x66\137\x61\153\x68\151\x72" => $_0x4796, "\x6b\145\x6c\141\x73\137\x61\153\x68\151\x72\137\x61\153\x74\151\x66" => $_0x2df9, "\x6c\145\x76\145\x6c\137\x61\153\x68\151\x72" => $_0xc1be, "\x74\141\x68\165\x6e\137\x73\145\x6b\141\x72\141\x6e\147" => date("\x59")];
 goto L_509b3;
 L_965a7:
 // 3. Deteksi Level & Kelas Tingkat Akhir Aktif
 $_0xc1be = $_0xdbdb->is_sd ? 6 : ($_0xdbdb->is_sma ? 12 : 9);
 goto L_2cb48;
 L_c7253:
 if ($_0x4237) {
 try {
 $_0x53a3 = $this->rapor->getJumlahLulus($_0x4237->id_tp, "\x32", (string) $_0xc1be);
 $_0x28e9 = explode("\x2f", $_0x4237->tahun ?? "\x2d\57\x2d");
 $_0x8b3b = $this->master->getAlumniByTahun($_0x28e9[1] ?? '');
 if ($_0x53a3 > count($_0x8b3b)) {
 $_0x8708 = $_0x53a3;
 }
 } catch (\Throwable $_0xaad8) {
 }
 }
 goto L_92193;
 L_7ad69:
 // 4. Daftar Opsi Filter Tahun & Kelas dari Buku Induk
 $_0xfe3c = $this->master->getDistinctTahunLulus();
 goto L_a788a;
 L_26ed9:
 $_0x59bd = $this->dashboard->getTahun();
 goto L_bb3ce;
 L_25578:
 $_0x9cfc = (object) ["\x69\144" => session()->get("\x69\144\x5f\165\x73\145\x72") ?? session()->get("\x75\163\x65\162\x5f\151\x64"), "\x75\163\x65\162\x6e\141\x6d\145" => session()->get("\x75\163\x65\162\x6e\141\x6d\145")];
 goto L_ea621;
 L_92193:
 // 6. Query Data Siswa Sesuai Filter (SELALU terisi, default: semua alumni status 2)
 $_0xa7bb = $this->db->table("\x62\165\x6b\165\x5f\151\x6e\144\x75\153\x20\141")->select("\x61\56\x2a\54\x20\142\x2e\156\x61\155\x61\54\x20\142\x2e\156\x69\163\x2c\40\x62\56\x6e\151\x73\156\x2c\40\x62\56\x6a\145\x6e\151\x73\137\x6b\145\x6c\141\x6d\151\x6e\54\x20\142\x2e\146\x6f\164\x6f\54\x20\142\x2e\165\x73\145\x72\156\x61\155\x65\54\x20\142\x2e\164\x65\155\x70\141\x74\137\x6c\141\x68\151\x72\54\x20\142\x2e\164\x61\156\x67\147\x61\154\x5f\154\x61\150\x69\162\x2c\40\x62\56\x68\160")->join("\x6d\141\x73\164\x65\162\x5f\163\x69\163\x77\141\x20\142", "\x61\56\x69\144\x5f\163\x69\163\x77\141\x20\75\x20\142\x2e\151\x64\137\x73\151\x73\167\x61")->where("\x61\56\x73\164\x61\164\x75\163", $_0x78b8);
 goto L_c40e4;
 L_9b7c3:
 $_0xdbdb = detectSchoolType($_0x216c);
 goto L_680e3;
 L_c40e4:
 if (!empty($_0x9a99) && $_0x9a99 !== "\x61\154\x6c" && $_0x9a99 !== "\x30") {
 $_0xa7bb->where("\x61\56\x74\141\x68\165\x6e\137\x6c\165\x6c\165\x73", $_0x9a99);
 }
 goto L_e2688;
 }
 public function generateAlumni()
 {
 goto L_cfdc4;
 L_141f8:
 $this->db->transComplete();
 goto L_7226a;
 L_34e47:
 $this->db->transStart();
 goto L_39461;
 L_7226a:
 return $this->output_json(["\x73\164\x61\164\x75\163" => true, "\x63\157\x75\156\x74" => count($_0x4e39), "\x69\144\x73" => $_0x4e39, "\x6d\145\x73\163\x61\147\x65" => count($_0x4e39) . "\x20\163\x69\163\x77\141\x20\142\x65\162\x68\141\x73\151\x6c\40\x64\151\x67\145\x6e\145\x72\141\x74\145\x20\155\x65\156\x6a\141\x64\151\x20\141\x6c\165\x6d\156\x69\40\x64\141\x72\151\x20\144\x61\164\x61\40\x52\141\x70\157\x72\56"]);
 L_38751:
 $_0xaacd = [];
 goto L_825ce;
 L_825ce:
 $_0x2f84 = "\x2d";
 goto L_9a2a1;
 L_26f7c:
 $_0x4e39 = [];
 goto L_34e47;
 L_f0f7e:
 $_0x1ac6 = $this->dashboard->getTahunActive();
 goto L_d6941;
 L_cfdc4:
 $_0xbbbb = $this->dashboard->getSetting();
 goto L_f0f7e;
 L_39461:
 if (count($_0xaacd) > 0) {
 foreach ($_0xaacd as $_0xe61e) {
 if ($_0xe61e->naik == null || $_0xe61e->naik != "\x30") {
 $_0x4e39[] = $_0xe61e->id_siswa;
 $this->db->table("\x62\165\x6b\165\x5f\151\x6e\144\x75\153")->where("\x69\144\x5f\163\x69\163\x77\141", $_0xe61e->id_siswa)->update(["\x73\164\x61\164\x75\163" => "\x32", "\x74\141\x68\165\x6e\137\x6c\165\x6c\165\x73" => $_0x2f84[1] ?? date("\x59"), "\x6e\157\x5f\151\x6a\141\x7a\141\x68" => "\x2d\40\x2d", "\x6b\145\x6c\141\x73\137\x61\153\x68\151\x72" => $_0xe61e->kelas_akhir]);
 }
 }
 }
 goto L_141f8;
 L_9a2a1:
 if ($_0x1300) {
 $_0x2f84 = explode("\x2f", $_0x1300->tahun ?? "\x2d\57\x2d");
 $_0xaacd = $this->rapor->getSiswaLulus($_0x1300->id_tp, "\x32", $_0xd2ac);
 }
 goto L_26f7c;
 L_d6941:
 $_0x1300 = $this->dashboard->getTpBefore($_0x1ac6->tahun);
 goto L_81478;
 L_81478:
 $_0xd2ac = $_0xbbbb->jenjang == "\x31" ? "\x36" : ($_0xbbbb->jenjang == "\x32" ? "\x39" : "\x31\62");
 goto L_38751;
 }
 public function luluskanKelas()
 {
 goto L_30e58;
 L_f73bc:
 $_0xc255 = $this->dashboard->getTahunActive();
 goto L_d8894;
 L_da274:
 foreach ($_0xb829 as $_0xd2b7) {
 $_0x7a78 = $this->db->table("\x62\165\x6b\165\x5f\151\x6e\144\x75\153")->where("\x69\144\x5f\163\x69\163\x77\141", $_0xd2b7->id_siswa)->countAllResults();
 $_0x4e0e = ["\x73\164\x61\164\x75\163" => "\x32", "\x74\141\x68\165\x6e\137\x6c\165\x6c\165\x73" => $_0xc8a1, "\x6b\145\x6c\141\x73\137\x61\153\x68\151\x72" => $_0xd2b7->nama_kelas, "\x6e\157\x5f\151\x6a\141\x7a\141\x68" => !empty($_0x888c) ? $_0x888c : "\x2d\40\x2d"];
 if ($_0x7a78 > 0) {
 $this->db->table("\x62\165\x6b\165\x5f\151\x6e\144\x75\153")->where("\x69\144\x5f\163\x69\163\x77\141", $_0xd2b7->id_siswa)->update($_0x4e0e);
 } else {
 $_0x4e0e["\x69\144\x5f\163\x69\163\x77\141"] = $_0xd2b7->id_siswa;
 $this->db->table("\x62\165\x6b\165\x5f\151\x6e\144\x75\153")->insert($_0x4e0e);
 }
 $_0x3c00++;
 }
 goto L_7fca1;
 L_133a1:
 $_0xc8a1 = trim((string) ($this->request->getPost("\x74\141\x68\165\x6e\137\x6c\165\x6c\165\x73") ?? date("\x59")));
 goto L_0b6e1;
 L_d8894:
 $_0x2d84 = $this->dashboard->getSemesterActive();
 goto L_2a374;
 L_afbe3:
 if (empty($_0xc8a1)) {
 return ($this->response ?? response())->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x54\141\x68\165\x6e\40\x6b\145\x6c\165\x6c\165\x73\141\x6e\40\x77\141\x6a\151\x62\40\x64\151\x69\163\x69\56"]);
 }
 goto L_f73bc;
 L_02ca9:
 $this->db->transStart();
 goto L_13068;
 L_ff761:
 $_0xce1e = $this->request->getPost("\x69\144\x5f\153\x65\154\x61\163");
 goto L_133a1;
 L_0b6e1:
 $_0x888c = trim((string) ($this->request->getPost("\x6e\157\x5f\151\x6a\141\x7a\141\x68") ?? ''));
 goto L_afbe3;
 L_af7a1:
 if (empty($_0xb829)) {
 return ($this->response ?? response())->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x54\151\x64\141\x6b\40\x64\151\x74\145\x6d\165\x6b\141\x6e\40\x73\151\x73\167\x61\40\x61\153\x74\151\x66\40\x70\141\x64\141\x20\153\x65\154\x61\163\x20\164\x69\156\x67\153\x61\164\x20\141\x6b\150\x69\162\x20\171\x61\156\x67\40\x64\151\x70\151\x6c\151\x68\56"]);
 }
 goto L_02ca9;
 L_13068:
 $_0x3c00 = 0;
 goto L_da274;
 L_111bf:
 if (!$_0x823e->get("\x69\163\x5f\154\x6f\147\x69\156") || !in_array((string) $_0x823e->get("\x72\157\x6c\145"), ["\x31", "\x34"])) {
 return ($this->response ?? response())->setStatusCode(403)->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x55\156\x61\165\x74\150\x6f\162\x69\172\x65\144"]);
 }
 goto L_ff761;
 L_7fca1:
 $this->db->transComplete();
 goto L_56253;
 L_2a374:
 $_0xe8fa = $this->db->table("\x6b\145\x6c\141\x73\137\x73\151\x73\167\x61\40\x6b\163")->select("\x6b\163\x2e\151\x64\137\x73\151\x73\167\x61\54\x20\153\x73\56\x69\144\x5f\153\x65\154\x61\163\x2c\40\x6b\56\x6e\141\x6d\141\x5f\153\x65\154\x61\163\x2c\40\x73\56\x6e\141\x6d\141")->join("\x6d\141\x73\164\x65\162\x5f\153\x65\154\x61\163\x20\153", "\x6b\163\x2e\151\x64\137\x6b\145\x6c\141\x73\40\x3d\40\x6b\56\x69\144\x5f\153\x65\154\x61\163")->join("\x6d\141\x73\164\x65\162\x5f\163\x69\163\x77\141\x20\163", "\x6b\163\x2e\151\x64\137\x73\151\x73\167\x61\40\x3d\40\x73\56\x69\144\x5f\163\x69\163\x77\141")->where("\x6b\163\x2e\151\x64\137\x74\160", $_0xc255->id_tp)->where("\x6b\163\x2e\151\x64\137\x73\155\x74", $_0x2d84->id_smt);
 goto L_bb8a7;
 L_30e58:
 $_0x823e = session();
 goto L_111bf;
 L_bb8a7:
 if (!empty($_0xce1e) && $_0xce1e !== "\x61\154\x6c") {
 $_0xe8fa->where("\x6b\163\x2e\151\x64\137\x6b\145\x6c\141\x73", $_0xce1e);
 } else {
 $_0xe457 = $this->dashboard->getSetting();
 $_0x679c = $_0xe457->jenjang == "\x31" ? 6 : ($_0xe457->jenjang == "\x33" || $_0xe457->jenjang == "\x34" ? 12 : 9);
 $_0xe8fa->where("\x6b\56\x6c\145\x76\145\x6c\137\x69\144\x20\76\x3d", $_0x679c);
 }
 goto L_9f8ec;
 L_9f8ec:
 $_0xb829 = $_0xe8fa->get()->getResult();
 goto L_af7a1;
 L_56253:
 return ($this->response ?? response())->setJSON(["\x73\164\x61\164\x75\163" => true, "\x63\157\x75\156\x74" => $_0x3c00, "\x6d\145\x73\163\x61\147\x65" => "Alhamdulillah! Sebanyak {$_0x3c00} siswa berhasil diluluskan menjadi Alumni Tahun {$_0xc8a1}."]);
 }
 public function detail($_0x9b28)
 {
 goto L_dd088;
 L_1f3b1:
 if (!$_0xad90) {
 return redirect()->to("\x64\141\x74\141\x61\154\x75\155\x6e\151")->with("\x65\162\x72\157\x72", "\x44\141\x74\141\x20\141\x6c\165\x6d\156\x69\40\x74\151\x64\141\x6b\40\x64\151\x74\145\x6d\165\x6b\141\x6e\56");
 }
 goto L_709c6;
 L_7f858:
 return view("\x6d\141\x73\164\x65\162\x2f\141\x6c\165\x6d\156\x69\57\x65\144\x69\164", $_0x3421);
 L_e6eba:
 $_0x5ff8 = [["\x6e\141\x6d\145" => "\x6e\141\x6d\141\x5f\167\x61\154\x69", "\x6c\141\x62\145\x6c" => "\x4e\141\x6d\141\x20\127\x61\154\x69", "\x76\141\x6c\165\x65" => $_0xad90->nama_wali, "\x69\143\x6f\156" => "\x66\141\x72\40\x66\141\x2d\165\x73\145\x72", "\x74\171\x70\145" => "\x74\145\x78\164"], ["\x6e\141\x6d\145" => "\x70\145\x6e\144\x69\144\x69\153\x61\156\x5f\167\x61\154\x69", "\x6c\141\x62\145\x6c" => "\x50\145\x6e\144\x69\144\x69\153\x61\156\x20\127\x61\154\x69", "\x76\141\x6c\165\x65" => $_0xad90->pendidikan_wali, "\x69\143\x6f\156" => "\x66\141\x72\40\x66\141\x2d\165\x73\145\x72", "\x74\171\x70\145" => "\x74\145\x78\164"], ["\x6e\141\x6d\145" => "\x70\145\x6b\145\x72\152\x61\141\x6e\137\x77\141\x6c\151", "\x6c\141\x62\145\x6c" => "\x50\145\x6b\145\x72\152\x61\141\x6e\40\x57\141\x6c\151", "\x76\141\x6c\165\x65" => $_0xad90->pekerjaan_wali, "\x69\143\x6f\156" => "\x66\141\x72\40\x66\141\x2d\165\x73\145\x72", "\x74\171\x70\145" => "\x74\145\x78\164"], ["\x6e\141\x6d\145" => "\x61\154\x61\155\x61\164\x5f\167\x61\154\x69", "\x6c\141\x62\145\x6c" => "\x41\154\x61\155\x61\164\x20\127\x61\154\x69", "\x76\141\x6c\165\x65" => $_0xad90->alamat_wali, "\x69\143\x6f\156" => "\x66\141\x72\40\x66\141\x2d\165\x73\145\x72", "\x74\171\x70\145" => "\x74\145\x78\164"], ["\x6e\141\x6d\145" => "\x6e\157\x68\160\x5f\167\x61\154\x69", "\x6c\141\x62\145\x6c" => "\x4e\157\x2e\40\x48\120\x20\127\x61\154\x69", "\x76\141\x6c\165\x65" => $_0xad90->nohp_wali, "\x69\143\x6f\156" => "\x66\141\x72\40\x66\141\x2d\165\x73\145\x72", "\x74\171\x70\145" => "\x6e\165\x6d\142\x65\162"]];
 goto L_67771;
 L_709c6:
 $_0xebed = [["\x6c\141\x62\145\x6c" => "\x4e\141\x6d\141\x20\114\x65\156\x67\153\x61\160", "\x6e\141\x6d\145" => "\x6e\141\x6d\141", "\x76\141\x6c\165\x65" => $_0xad90->nama, "\x69\143\x6f\156" => "\x66\141\x72\40\x66\141\x2d\165\x73\145\x72", "\x63\154\x61\163\x73" => '', "\x74\171\x70\145" => "\x74\145\x78\164"], ["\x6c\141\x62\145\x6c" => "\x4e\111\x53", "\x6e\141\x6d\145" => "\x6e\151\x73", "\x76\141\x6c\165\x65" => $_0xad90->nis, "\x69\143\x6f\156" => "\x66\141\x72\40\x66\141\x2d\151\x64\55\x63\141\x72\144", "\x63\154\x61\163\x73" => '', "\x74\171\x70\145" => "\x6e\165\x6d\142\x65\162"], ["\x6e\141\x6d\145" => "\x6e\151\x73\156", "\x6c\141\x62\145\x6c" => "\x4e\111\x53\116", "\x76\141\x6c\165\x65" => $_0xad90->nisn, "\x69\143\x6f\156" => "\x66\141\x72\40\x66\141\x2d\151\x64\55\x63\141\x72\144", "\x63\154\x61\163\x73" => '', "\x74\171\x70\145" => "\x74\145\x78\164"], ["\x6c\141\x62\145\x6c" => "\x4a\145\x6e\151\x73\40\x4b\145\x6c\141\x6d\151\x6e", "\x6e\141\x6d\145" => "\x6a\145\x6e\151\x73\137\x6b\145\x6c\141\x6d\151\x6e", "\x76\141\x6c\165\x65" => $_0xad90->jenis_kelamin, "\x69\143\x6f\156" => "\x66\141\x73\40\x66\141\x2d\166\x65\156\x75\163\x2d\155\x61\162\x73", "\x63\154\x61\163\x73" => '', "\x74\171\x70\145" => "\x74\145\x78\164"], ["\x6e\141\x6d\145" => "\x6b\145\x6c\141\x73\137\x61\167\x61\154", "\x6c\141\x62\145\x6c" => "\x44\151\x74\145\x72\151\x6d\141\x20\144\x69\40\x6b\145\x6c\141\x73", "\x76\141\x6c\165\x65" => $_0xad90->kelas_awal, "\x69\143\x6f\156" => "\x66\141\x73\40\x66\141\x2d\147\x72\141\x64\165\x61\164\x69\157\x6e\55\x63\141\x70", "\x63\154\x61\163\x73" => '', "\x74\171\x70\145" => "\x74\145\x78\164"], ["\x6e\141\x6d\145" => "\x74\141\x68\165\x6e\137\x6d\141\x73\165\x6b", "\x6c\141\x62\145\x6c" => "\x54\147\x6c\40\x64\151\x74\145\x72\151\x6d\141", "\x76\141\x6c\165\x65" => $_0xad90->tahun_masuk, "\x69\143\x6f\156" => "\x74\141\x68\165\x6e\40\x66\141\x72\40\x66\141\x2d\143\x61\154\x65\156\x64\141\x72\55\x61\154\x74", "\x63\154\x61\163\x73" => "\x74\141\x68\165\x6e", "\x74\171\x70\145" => "\x74\145\x78\164"]];
 goto L_53f64;
 L_08ac1:
 $_0x3421 = ["\x75\163\x65\162" => $_0x1845, "\x6a\165\x64\165\x6c" => "\x41\154\x75\155\x6e\151", "\x73\165\x62\152\x75\144\x75\154" => "\x45\144\x69\164\x20\104\x61\164\x61\40\x41\154\x75\155\x6e\151", "\x61\154\x75\155\x6e\151" => $_0xad90, "\x73\145\x74\164\x69\156\x67" => $this->dashboard->getSetting(), "\x74\160" => $this->dashboard->getTahun(), "\x74\160\x5f\141\x63\164\x69\166\x65" => $this->dashboard->getTahunActive(), "\x73\155\x74" => $this->dashboard->getSemester(), "\x73\155\x74\137\x61\143\x74\151\x76\145" => $this->dashboard->getSemesterActive(), "\x69\156\x70\165\x74\137\x64\141\x74\141" => json_decode(json_encode($_0xebed), FALSE), "\x69\156\x70\165\x74\137\x62\151\x6f" => json_decode(json_encode($_0x67df), FALSE), "\x69\156\x70\165\x74\137\x6f\162\x74\165" => json_decode(json_encode($_0xc3b9), FALSE), "\x69\156\x70\165\x74\137\x77\141\x6c\151" => json_decode(json_encode($_0x5ff8), FALSE)];
 goto L_7f858;
 L_dd088:
 $_0xad90 = $this->master->getAlumniById($_0x9b28);
 goto L_1f3b1;
 L_f1caa:
 $_0xc3b9 = [["\x6e\141\x6d\145" => "\x6e\141\x6d\141\x5f\141\x79\141\x68", "\x6c\141\x62\145\x6c" => "\x4e\141\x6d\141\x20\101\x79\141\x68", "\x76\141\x6c\165\x65" => $_0xad90->nama_ayah, "\x69\143\x6f\156" => "\x66\141\x72\40\x66\141\x2d\165\x73\145\x72", "\x74\171\x70\145" => "\x74\145\x78\164"], ["\x6e\141\x6d\145" => "\x70\145\x6e\144\x69\144\x69\153\x61\156\x5f\141\x79\141\x68", "\x6c\141\x62\145\x6c" => "\x50\145\x6e\144\x69\144\x69\153\x61\156\x20\101\x79\141\x68", "\x76\141\x6c\165\x65" => $_0xad90->pendidikan_ayah, "\x69\143\x6f\156" => "\x66\141\x72\40\x66\141\x2d\165\x73\145\x72", "\x74\171\x70\145" => "\x74\145\x78\164"], ["\x6e\141\x6d\145" => "\x70\145\x6b\145\x72\152\x61\141\x6e\137\x61\171\x61\150", "\x6c\141\x62\145\x6c" => "\x50\145\x6b\145\x72\152\x61\141\x6e\40\x41\171\x61\150", "\x76\141\x6c\165\x65" => $_0xad90->pekerjaan_ayah, "\x69\143\x6f\156" => "\x66\141\x72\40\x66\141\x2d\165\x73\145\x72", "\x74\171\x70\145" => "\x74\145\x78\164"], ["\x6e\141\x6d\145" => "\x6e\157\x68\160\x5f\141\x79\141\x68", "\x6c\141\x62\145\x6c" => "\x4e\157\x2e\40\x48\120\x20\101\x79\141\x68", "\x76\141\x6c\165\x65" => $_0xad90->nohp_ayah, "\x69\143\x6f\156" => "\x66\141\x72\40\x66\141\x2d\165\x73\145\x72", "\x74\171\x70\145" => "\x6e\165\x6d\142\x65\162"], ["\x6e\141\x6d\145" => "\x61\154\x61\155\x61\164\x5f\141\x79\141\x68", "\x6c\141\x62\145\x6c" => "\x41\154\x61\155\x61\164\x20\101\x79\141\x68", "\x76\141\x6c\165\x65" => $_0xad90->alamat_ayah, "\x69\143\x6f\156" => "\x66\141\x72\40\x66\141\x2d\165\x73\145\x72", "\x74\171\x70\145" => "\x74\145\x78\164"], ["\x6e\141\x6d\145" => "\x6e\141\x6d\141\x5f\151\x62\165", "\x6c\141\x62\145\x6c" => "\x4e\141\x6d\141\x20\111\x62\165", "\x76\141\x6c\165\x65" => $_0xad90->nama_ibu, "\x69\143\x6f\156" => "\x66\141\x72\40\x66\141\x2d\165\x73\145\x72", "\x74\171\x70\145" => "\x74\145\x78\164"], ["\x6e\141\x6d\145" => "\x70\145\x6e\144\x69\144\x69\153\x61\156\x5f\151\x62\165", "\x6c\141\x62\145\x6c" => "\x50\145\x6e\144\x69\144\x69\153\x61\156\x20\111\x62\165", "\x76\141\x6c\165\x65" => $_0xad90->pendidikan_ibu, "\x69\143\x6f\156" => "\x66\141\x72\40\x66\141\x2d\165\x73\145\x72", "\x74\171\x70\145" => "\x74\145\x78\164"], ["\x6e\141\x6d\145" => "\x70\145\x6b\145\x72\152\x61\141\x6e\137\x69\142\x75", "\x6c\141\x62\145\x6c" => "\x50\145\x6b\145\x72\152\x61\141\x6e\40\x49\142\x75", "\x76\141\x6c\165\x65" => $_0xad90->pekerjaan_ibu, "\x69\143\x6f\156" => "\x66\141\x72\40\x66\141\x2d\165\x73\145\x72", "\x74\171\x70\145" => "\x74\145\x78\164"], ["\x6e\141\x6d\145" => "\x6e\157\x68\160\x5f\151\x62\165", "\x6c\141\x62\145\x6c" => "\x4e\157\x2e\40\x48\120\x20\111\x62\165", "\x76\141\x6c\165\x65" => $_0xad90->nohp_ibu, "\x69\143\x6f\156" => "\x66\141\x72\40\x66\141\x2d\165\x73\145\x72", "\x74\171\x70\145" => "\x6e\165\x6d\142\x65\162"], ["\x6e\141\x6d\145" => "\x61\154\x61\155\x61\164\x5f\151\x62\165", "\x6c\141\x62\145\x6c" => "\x41\154\x61\155\x61\164\x20\111\x62\165", "\x76\141\x6c\165\x65" => $_0xad90->alamat_ibu, "\x69\143\x6f\156" => "\x66\141\x72\40\x66\141\x2d\165\x73\145\x72", "\x74\171\x70\145" => "\x74\145\x78\164"]];
 goto L_e6eba;
 L_53f64:
 $_0x67df = [["\x6e\141\x6d\145" => "\x74\145\x6d\160\x61\164\x5f\154\x61\150\x69\162", "\x6c\141\x62\145\x6c" => "\x54\145\x6d\160\x61\164\x20\114\x61\150\x69\162", "\x76\141\x6c\165\x65" => $_0xad90->tempat_lahir, "\x69\143\x6f\156" => "\x66\141\x72\40\x66\141\x2d\155\x61\160", "\x63\154\x61\163\x73" => '', "\x74\171\x70\145" => "\x74\145\x78\164"], ["\x6e\141\x6d\145" => "\x74\141\x6e\147\x67\141\x6c\137\x6c\141\x68\151\x72", "\x6c\141\x62\145\x6c" => "\x54\141\x6e\147\x67\141\x6c\40\x4c\141\x68\151\x72", "\x76\141\x6c\165\x65" => $_0xad90->tanggal_lahir, "\x69\143\x6f\156" => "\x66\141\x72\40\x66\141\x2d\143\x61\154\x65\156\x64\141\x72", "\x63\154\x61\163\x73" => "\x74\141\x68\165\x6e", "\x74\171\x70\145" => "\x74\145\x78\164"], ["\x63\154\x61\163\x73" => '', "\x6e\141\x6d\145" => "\x61\147\x61\155\x61", "\x6c\141\x62\145\x6c" => "\x41\147\x61\155\x61", "\x76\141\x6c\165\x65" => $_0xad90->agama, "\x69\143\x6f\156" => "\x66\141\x72\40\x66\141\x2d\143\x61\154\x65\156\x64\141\x72", "\x74\171\x70\145" => "\x74\145\x78\164"], ["\x63\154\x61\163\x73" => '', "\x6e\141\x6d\145" => "\x61\154\x61\155\x61\164", "\x6c\141\x62\145\x6c" => "\x41\154\x61\155\x61\164", "\x76\141\x6c\165\x65" => $_0xad90->alamat, "\x69\143\x6f\156" => "\x66\141\x72\40\x66\141\x2d\165\x73\145\x72", "\x74\171\x70\145" => "\x74\145\x78\164"], ["\x63\154\x61\163\x73" => '', "\x6e\141\x6d\145" => "\x72\164", "\x6c\141\x62\145\x6c" => "\x52\164", "\x76\141\x6c\165\x65" => $_0xad90->rt, "\x69\143\x6f\156" => "\x66\141\x72\40\x66\141\x2d\165\x73\145\x72", "\x74\171\x70\145" => "\x74\145\x78\164"], ["\x63\154\x61\163\x73" => '', "\x6e\141\x6d\145" => "\x72\167", "\x6c\141\x62\145\x6c" => "\x52\167", "\x76\141\x6c\165\x65" => $_0xad90->rw, "\x69\143\x6f\156" => "\x66\141\x72\40\x66\141\x2d\165\x73\145\x72", "\x74\171\x70\145" => "\x74\145\x78\164"], ["\x63\154\x61\163\x73" => '', "\x6e\141\x6d\145" => "\x6b\145\x6c\165\x72\141\x68\141\x6e", "\x6c\141\x62\145\x6c" => "\x4b\145\x6c\165\x72\141\x68\141\x6e\57\x44\145\x73\141", "\x76\141\x6c\165\x65" => $_0xad90->kelurahan, "\x69\143\x6f\156" => "\x66\141\x72\40\x66\141\x2d\165\x73\145\x72", "\x74\171\x70\145" => "\x74\145\x78\164"], ["\x63\154\x61\163\x73" => '', "\x6e\141\x6d\145" => "\x6b\145\x63\141\x6d\141\x74\141\x6e", "\x6c\141\x62\145\x6c" => "\x4b\145\x63\141\x6d\141\x74\141\x6e", "\x76\141\x6c\165\x65" => $_0xad90->kecamatan, "\x69\143\x6f\156" => "\x66\141\x72\40\x66\141\x2d\165\x73\145\x72", "\x74\171\x70\145" => "\x74\145\x78\164"], ["\x63\154\x61\163\x73" => '', "\x6e\141\x6d\145" => "\x6b\141\x62\165\x70\141\x74\145\x6e", "\x6c\141\x62\145\x6c" => "\x4b\141\x62\165\x70\141\x74\145\x6e\57\x4b\157\x74\141", "\x76\141\x6c\165\x65" => $_0xad90->kabupaten, "\x69\143\x6f\156" => "\x66\141\x72\40\x66\141\x2d\165\x73\145\x72", "\x74\171\x70\145" => "\x74\145\x78\164"], ["\x63\154\x61\163\x73" => '', "\x6e\141\x6d\145" => "\x6b\157\x64\145\x5f\160\x6f\163", "\x6c\141\x62\145\x6c" => "\x4b\157\x64\145\x20\120\x6f\163", "\x76\141\x6c\165\x65" => $_0xad90->kode_pos, "\x69\143\x6f\156" => "\x66\141\x72\40\x66\141\x2d\165\x73\145\x72", "\x74\171\x70\145" => "\x74\145\x78\164"], ["\x63\154\x61\163\x73" => '', "\x6e\141\x6d\145" => "\x68\160", "\x6c\141\x62\145\x6c" => "\x48\160", "\x76\141\x6c\165\x65" => $_0xad90->hp, "\x69\143\x6f\156" => "\x66\141\x72\40\x66\141\x2d\165\x73\145\x72", "\x74\171\x70\145" => "\x74\145\x78\164"]];
 goto L_f1caa;
 L_67771:
 $_0x1845 = (object) ["\x69\144" => session()->get("\x69\144\x5f\165\x73\145\x72") ?? session()->get("\x75\163\x65\162\x5f\151\x64"), "\x75\163\x65\162\x6e\141\x6d\145" => session()->get("\x75\163\x65\162\x6e\141\x6d\145")];
 goto L_08ac1;
 }
 public function add()
 {
 goto L_693bc;
 L_693bc:
 $_0x8621 = (object) ["\x69\144" => session()->get("\x69\144\x5f\165\x73\145\x72") ?? session()->get("\x75\163\x65\162\x5f\151\x64"), "\x75\163\x65\162\x6e\141\x6d\145" => session()->get("\x75\163\x65\162\x6e\141\x6d\145")];
 goto L_57057;
 L_57057:
 $_0x8fb3 = ["\x75\163\x65\162" => $_0x8621, "\x6a\165\x64\165\x6c" => "\x41\154\x75\155\x6e\151", "\x73\165\x62\152\x75\144\x75\154" => "\x49\155\x70\157\x72\164\x20\104\x61\164\x61\40\x41\154\x75\155\x6e\151", "\x73\145\x74\164\x69\156\x67" => $this->dashboard->getSetting(), "\x74\160" => $this->dashboard->getTahun(), "\x74\160\x5f\141\x63\164\x69\166\x65" => $this->dashboard->getTahunActive(), "\x73\155\x74" => $this->dashboard->getSemester(), "\x73\155\x74\137\x61\143\x74\151\x76\145" => $this->dashboard->getSemesterActive(), "\x74\151\x70\145" => "\x61\144\x64"];
 goto L_e52df;
 L_e52df:
 return view("\x6d\141\x73\164\x65\162\x2f\141\x6c\165\x6d\156\x69\57\x61\144\x64", $_0x8fb3);
 }
 public function create()
 {
 goto L_3f5e9;
 L_64803:
 $_0x5ad4 = trim((string) ($this->request->getPost("\x6e\151\x73\156") ?? ''));
 goto L_90281;
 L_fe50b:
 $this->db->table("\x6d\141\x73\164\x65\162\x5f\163\x69\163\x77\141")->insert($_0x6c26);
 goto L_78b47;
 L_41431:
 if (!empty($_0x5ad4)) {
 $_0xad92 = $this->db->table("\x6d\141\x73\164\x65\162\x5f\163\x69\163\x77\141")->where("\x6e\151\x73\156", $_0x5ad4)->countAllResults();
 if ($_0xad92 > 0) {
 return ($this->response ?? response())->setJSON(["\x69\156\x73\145\x72\164" => false, "\x74\145\x78\164" => "\x4e\111\x53\116\x20\42" . $_0x5ad4 . "\x22\40\x73\165\x64\141\x68\40\x64\151\x67\165\x6e\141\x6b\141\x6e\56"]);
 }
 }
 goto L_a9ea5;
 L_18025:
 $_0x6c26 = ["\x6e\141\x6d\141" => $_0xb64b, "\x6e\151\x73" => $_0xc8ad, "\x6e\151\x73\156" => $_0x5ad4, "\x6a\145\x6e\151\x73\137\x6b\145\x6c\141\x6d\151\x6e" => $this->request->getPost("\x6a\145\x6e\151\x73\137\x6b\145\x6c\141\x6d\151\x6e") ?? "\x4c", "\x75\163\x65\162\x6e\141\x6d\145" => $_0x4b46, "\x70\141\x73\163\x77\157\x72\144" => !empty($_0xc8ad) ? $_0xc8ad : "\x31\62\x33\64\x35\66", "\x66\157\x74\157" => !empty($_0xc8ad) ? "\x75\160\x6c\157\x61\144\x73\57\x66\157\x74\157\x5f\163\x69\163\x77\141\x2f" . $_0xc8ad . "\x2e\152\x70\147" : ''];
 goto L_fe50b;
 L_eb9ec:
 $this->db->table("\x62\165\x6b\165\x5f\151\x6e\144\x75\153")->insert($_0x7748);
 goto L_ec458;
 L_90281:
 $_0xb64b = trim((string) ($this->request->getPost("\x6e\141\x6d\141\x5f\141\x6c\165\x6d\156\x69") ?? ''));
 goto L_419e6;
 L_ec458:
 return ($this->response ?? response())->setJSON(["\x69\156\x73\145\x72\164" => true, "\x74\145\x78\164" => "\x41\154\x75\155\x6e\151\x20\141\x74\141\x73\40\x6e\141\x6d\141\x20" . $_0xb64b . "\x20\142\x65\162\x68\141\x73\151\x6c\40\x64\151\x74\141\x6d\142\x61\150\x6b\141\x6e\41"]);
 L_deedf:
 // Cek NIS jika diisi
 if (!empty($_0xc8ad)) {
 $_0x9cf4 = $this->db->table("\x6d\141\x73\164\x65\162\x5f\163\x69\163\x77\141")->where("\x6e\151\x73", $_0xc8ad)->countAllResults();
 if ($_0x9cf4 > 0) {
 return ($this->response ?? response())->setJSON(["\x69\156\x73\145\x72\164" => false, "\x74\145\x78\164" => "\x4e\111\x53\40\x22" . $_0xc8ad . "\x22\40\x73\165\x64\141\x68\40\x64\151\x67\165\x6e\141\x6b\141\x6e\56"]);
 }
 }
 goto L_41431;
 L_13888:
 $_0x7748 = ["\x69\144\x5f\163\x69\163\x77\141" => $_0x255b, "\x6b\145\x6c\141\x73\137\x61\153\x68\151\x72" => trim((string) ($this->request->getPost("\x6b\145\x6c\141\x73\137\x61\153\x68\151\x72") ?? '')), "\x74\141\x68\165\x6e\137\x6c\165\x6c\165\x73" => trim((string) ($this->request->getPost("\x74\141\x68\165\x6e\137\x6c\165\x6c\165\x73") ?? date("\x59"))), "\x6e\157\x5f\151\x6a\141\x7a\141\x68" => trim((string) ($this->request->getPost("\x6e\157\x5f\151\x6a\141\x7a\141\x68") ?? "\x2d\40\x2d")), "\x73\164\x61\164\x75\163" => 2];
 goto L_eb9ec;
 L_419e6:
 if (empty($_0xb64b)) {
 return ($this->response ?? response())->setJSON(["\x69\156\x73\145\x72\164" => false, "\x74\145\x78\164" => "\x4e\141\x6d\141\x20\101\x6c\165\x6d\156\x69\40\x77\141\x6a\151\x62\40\x64\151\x69\163\x69\56"]);
 }
 goto L_deedf;
 L_a9ea5:
 $_0x4b46 = !empty($_0xc8ad) ? $_0xc8ad : (!empty($_0x5ad4) ? $_0x5ad4 : strtolower(str_replace("\x20", '', $_0xb64b)) . rand(100, 999));
 goto L_18025;
 L_3f5e9:
 $_0xc8ad = trim((string) ($this->request->getPost("\x6e\151\x73") ?? ''));
 goto L_64803;
 L_78b47:
 $_0x255b = $this->db->insertID();
 goto L_13888;
 }
 public function edit()
 {
 $_0xde19 = $this->request->getGet("\x69\144");
 return $this->detail($_0xde19);
 }
 public function batalkan()
 {
 goto L_f4cd6;
 L_f4cd6:
 $_0xa91e = $this->request->getPost("\x69\144");
 goto L_a7224;
 L_00a8e:
 $this->db->table("\x62\165\x6b\165\x5f\151\x6e\144\x75\153")->where("\x69\144\x5f\163\x69\163\x77\141", $_0xa91e)->update(["\x6b\145\x6c\141\x73\137\x61\153\x68\151\x72" => null, "\x74\147\x6c\137\x70\151\x6e\144\x61\150" => null, "\x73\164\x61\164\x75\163" => "\x31"]);
 goto L_b5c3b;
 L_a7224:
 if (!$_0xa91e) {
 return ($this->response ?? response())->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x49\104\x20\163\x69\163\x77\141\x20\164\x69\144\x61\153\x20\166\x61\154\x69\144"]);
 }
 goto L_00a8e;
 L_b5c3b:
 return ($this->response ?? response())->setJSON(["\x73\164\x61\164\x75\163" => true, "\x6d\145\x73\163\x61\147\x65" => "\x53\164\x61\164\x75\163\x20\141\x6c\165\x6d\156\x69\40\x62\145\x72\150\x61\163\x69\154\x20\144\x69\142\x61\164\x61\154\x6b\141\x6e\40\x64\141\x6e\40\x73\151\x73\167\x61\40\x64\151\x61\153\x74\151\x66\153\x61\156\x20\153\x65\155\x62\141\x6c\151\x2e"]);
 }
 public function updateData()
 {
 goto L_7100d;
 L_7100d:
 $_0x9333 = $this->request->getPost("\x69\144\x5f\163\x69\163\x77\141");
 goto L_01917;
 L_01917:
 $_0xc676 = trim((string) ($this->request->getPost("\x6e\151\x73") ?? ''));
 goto L_dbd74;
 L_eac28:
 $_0xf9e4 = ["\x6e\151\x73\156" => $_0x2d34, "\x6e\151\x73" => $_0xc676, "\x6e\141\x6d\141" => $this->request->getPost("\x6e\141\x6d\141"), "\x6a\145\x6e\151\x73\137\x6b\145\x6c\141\x6d\151\x6e" => $this->request->getPost("\x6a\145\x6e\151\x73\137\x6b\145\x6c\141\x6d\151\x6e"), "\x74\145\x6d\160\x61\164\x5f\154\x61\150\x69\162" => $this->request->getPost("\x74\145\x6d\160\x61\164\x5f\154\x61\150\x69\162"), "\x74\141\x6e\147\x67\141\x6c\137\x6c\141\x68\151\x72" => $this->request->getPost("\x74\141\x6e\147\x67\141\x6c\137\x6c\141\x68\151\x72"), "\x61\147\x61\155\x61" => $this->request->getPost("\x61\147\x61\155\x61"), "\x73\164\x61\164\x75\163\x5f\153\x65\154\x75\141\x72\147\x61" => $this->request->getPost("\x73\164\x61\164\x75\163\x5f\153\x65\154\x75\141\x72\147\x61"), "\x61\156\x61\153\x5f\153\x65" => $this->request->getPost("\x61\156\x61\153\x5f\153\x65"), "\x61\154\x61\155\x61\164" => $this->request->getPost("\x61\154\x61\155\x61\164"), "\x72\164" => $this->request->getPost("\x72\164"), "\x72\167" => $this->request->getPost("\x72\167"), "\x6b\145\x6c\165\x72\141\x68\141\x6e" => $this->request->getPost("\x6b\145\x6c\165\x72\141\x68\141\x6e"), "\x6b\145\x63\141\x6d\141\x74\141\x6e" => $this->request->getPost("\x6b\145\x63\141\x6d\141\x74\141\x6e"), "\x6b\141\x62\165\x70\141\x74\145\x6e" => $this->request->getPost("\x6b\141\x62\165\x70\141\x74\145\x6e"), "\x70\162\x6f\166\x69\156\x73\151" => $this->request->getPost("\x70\162\x6f\166\x69\156\x73\151"), "\x6b\157\x64\145\x5f\160\x6f\163" => $this->request->getPost("\x6b\157\x64\145\x5f\160\x6f\163"), "\x68\160" => $this->request->getPost("\x68\160"), "\x6e\141\x6d\141\x5f\141\x79\141\x68" => $this->request->getPost("\x6e\141\x6d\141\x5f\141\x79\141\x68"), "\x6e\157\x68\160\x5f\141\x79\141\x68" => $this->request->getPost("\x6e\157\x68\160\x5f\141\x79\141\x68"), "\x70\145\x6e\144\x69\144\x69\153\x61\156\x5f\141\x79\141\x68" => $this->request->getPost("\x70\145\x6e\144\x69\144\x69\153\x61\156\x5f\141\x79\141\x68"), "\x70\145\x6b\145\x72\152\x61\141\x6e\137\x61\171\x61\150" => $this->request->getPost("\x70\145\x6b\145\x72\152\x61\141\x6e\137\x61\171\x61\150"), "\x61\154\x61\155\x61\164\x5f\141\x79\141\x68" => $this->request->getPost("\x61\154\x61\155\x61\164\x5f\141\x79\141\x68"), "\x6e\141\x6d\141\x5f\151\x62\165" => $this->request->getPost("\x6e\141\x6d\141\x5f\151\x62\165"), "\x6e\157\x68\160\x5f\151\x62\165" => $this->request->getPost("\x6e\157\x68\160\x5f\151\x62\165"), "\x70\145\x6e\144\x69\144\x69\153\x61\156\x5f\151\x62\165" => $this->request->getPost("\x70\145\x6e\144\x69\144\x69\153\x61\156\x5f\151\x62\165"), "\x70\145\x6b\145\x72\152\x61\141\x6e\137\x69\142\x75" => $this->request->getPost("\x70\145\x6b\145\x72\152\x61\141\x6e\137\x69\142\x75"), "\x61\154\x61\155\x61\164\x5f\151\x62\165" => $this->request->getPost("\x61\154\x61\155\x61\164\x5f\151\x62\165"), "\x6e\141\x6d\141\x5f\167\x61\154\x69" => $this->request->getPost("\x6e\141\x6d\141\x5f\167\x61\154\x69"), "\x70\145\x6e\144\x69\144\x69\153\x61\156\x5f\167\x61\154\x69" => $this->request->getPost("\x70\145\x6e\144\x69\144\x69\153\x61\156\x5f\167\x61\154\x69"), "\x70\145\x6b\145\x72\152\x61\141\x6e\137\x77\141\x6c\151" => $this->request->getPost("\x70\145\x6b\145\x72\152\x61\141\x6e\137\x77\141\x6c\151"), "\x6e\157\x68\160\x5f\167\x61\154\x69" => $this->request->getPost("\x6e\157\x68\160\x5f\167\x61\154\x69"), "\x61\154\x61\155\x61\164\x5f\167\x61\154\x69" => $this->request->getPost("\x61\154\x61\155\x61\164\x5f\167\x61\154\x69"), "\x74\141\x68\165\x6e\137\x6d\141\x73\165\x6b" => $this->request->getPost("\x74\141\x68\165\x6e\137\x6d\141\x73\165\x6b"), "\x6b\145\x6c\141\x73\137\x61\167\x61\154" => $this->request->getPost("\x6b\145\x6c\141\x73\137\x61\167\x61\154"), "\x74\147\x6c\137\x6c\141\x68\151\x72\137\x61\171\x61\150" => $this->request->getPost("\x74\147\x6c\137\x6c\141\x68\151\x72\137\x61\171\x61\150"), "\x74\147\x6c\137\x6c\141\x68\151\x72\137\x69\142\x75" => $this->request->getPost("\x74\147\x6c\137\x6c\141\x68\151\x72\137\x69\142\x75"), "\x74\147\x6c\137\x6c\141\x68\151\x72\137\x77\141\x6c\151" => $this->request->getPost("\x74\147\x6c\137\x6c\141\x68\151\x72\137\x77\141\x6c\151"), "\x73\145\x6b\157\x6c\141\x68\137\x61\163\x61\154" => $this->request->getPost("\x73\145\x6b\157\x6c\141\x68\137\x61\163\x61\154")];
 goto L_c5346;
 L_dbd74:
 $_0x2d34 = trim((string) ($this->request->getPost("\x6e\151\x73\156") ?? ''));
 goto L_eac28;
 L_e1732:
 return ($this->response ?? response())->setJSON(["\x69\156\x73\145\x72\164" => $_0xf9e4, "\x74\145\x78\164" => "\x44\141\x74\141\x20\141\x6c\165\x6d\156\x69\40\x62\145\x72\150\x61\163\x69\154\x20\144\x69\160\x65\162\x62\141\x72\165\x69\56"]);
 L_c5346:
 $this->master->updateData("\x6d\141\x73\164\x65\162\x5f\163\x69\163\x77\141", $_0xf9e4, "\x69\144\x5f\163\x69\163\x77\141", $_0x9333);
 goto L_e1732;
 }
 public function uploadFile($_0xf47e)
 {
 goto L_c51b2;
 L_3c0d8:
 $_0xc564 = $this->request->getFile("\x66\157\x74\157");
 goto L_683b3;
 L_0e51a:
 return ($this->response ?? response())->setJSON($_0xff3e);
 L_683b3:
 if ($_0xc564 && $_0xc564->isValid() && !$_0xc564->hasMoved()) {
 $_0xcf77 = $_0xff86->nis . "\x2e" . $_0xc564->getExtension();
 $_0xc564->move(FCPATH . "\x75\160\x6c\157\x61\144\x73\57\x66\157\x74\157\x5f\163\x69\163\x77\141\x2f", $_0xcf77, true);
 $this->db->table("\x6d\141\x73\164\x65\162\x5f\163\x69\163\x77\141")->where("\x69\144\x5f\163\x69\163\x77\141", $_0xf47e)->update(["\x66\157\x74\157" => "\x75\160\x6c\157\x61\144\x73\57\x66\157\x74\157\x5f\163\x69\163\x77\141\x2f" . $_0xcf77]);
 $_0xff3e["\x73\162\x63"] = base_url("\x75\160\x6c\157\x61\144\x73\57\x66\157\x74\157\x5f\163\x69\163\x77\141\x2f" . $_0xcf77);
 $_0xff3e["\x66\151\x6c\145\x6e\141\x6d\145"] = pathinfo($_0xcf77, PATHINFO_FILENAME);
 $_0xff3e["\x73\164\x61\164\x75\163"] = true;
 $_0xff3e["\x74\171\x70\145"] = $_0xc564->getClientMimeType();
 $_0xff3e["\x73\151\x7a\145"] = $_0xc564->getSize();
 } else {
 $_0xff3e["\x73\164\x61\164\x75\163"] = false;
 $_0xff3e["\x73\162\x63"] = '';
 }
 goto L_0e51a;
 L_c51b2:
 $_0xff86 = $this->master->getAlumniById($_0xf47e);
 goto L_3c0d8;
 }
 public function deleteFoto()
 {
 goto L_a0b4f;
 L_2f921:
 $_0x7bb3 = str_replace(base_url(), '', $_0xce88 ?? '');
 goto L_2bc11;
 L_a0b4f:
 $_0xce88 = $this->request->getPost("\x73\162\x63");
 goto L_2f921;
 L_c5b43:
 return ($this->response ?? response())->setJSON(["\x73\164\x61\164\x75\163" => true, "\x6d\145\x73\163\x61\147\x65" => "\x46\157\x74\157\x20\142\x65\162\x68\141\x73\151\x6c\40\x64\151\x68\141\x70\165\x73"]);
 L_2bc11:
 if (file_exists(FCPATH . $_0x7bb3)) {
 @unlink(FCPATH . $_0x7bb3);
 }
 goto L_c5b43;
 }
 public function delete()
 {
 goto L_8619c;
 L_a2b21:
 $this->db->table("\x72\141\x70\157\x72\137\x6e\151\x6c\141\x69\137\x65\153\x73\164\x72\141")->where("\x69\144\x5f\163\x69\163\x77\141", $_0xc93e)->delete();
 goto L_f6dbb;
 L_5d744:
 $this->db->table("\x72\141\x70\157\x72\137\x70\162\x65\163\x74\141\x73\151")->where("\x69\144\x5f\163\x69\163\x77\141", $_0xc93e)->delete();
 goto L_5664d;
 L_98411:
 $this->db->table("\x72\141\x70\157\x72\137\x6e\151\x6c\141\x69\137\x70\164\x73")->where("\x69\144\x5f\163\x69\163\x77\141", $_0xc93e)->delete();
 goto L_a07bd;
 L_8619c:
 $_0xc93e = $this->request->getPost("\x69\144");
 goto L_840b4;
 L_f6dbb:
 $this->db->table("\x72\141\x70\157\x72\137\x6e\151\x6c\141\x69\137\x68\141\x72\151\x61\156")->where("\x69\144\x5f\163\x69\163\x77\141", $_0xc93e)->delete();
 goto L_98411;
 L_a29f4:
 $_0xbd4a = $this->db->table("\x6d\141\x73\164\x65\162\x5f\163\x69\163\x77\141")->where("\x69\144\x5f\163\x69\163\x77\141", $_0xc93e)->delete();
 goto L_36ddc;
 L_5c923:
 $this->db->table("\x72\141\x70\157\x72\137\x66\151\x73\151\x6b")->where("\x69\144\x5f\163\x69\163\x77\141", $_0xc93e)->delete();
 goto L_97bb1;
 L_a07bd:
 $this->db->table("\x72\141\x70\157\x72\137\x6e\151\x6c\141\x69\137\x73\151\x6b\141\x70")->where("\x69\144\x5f\163\x69\163\x77\141", $_0xc93e)->delete();
 goto L_5d744;
 L_6e271:
 $this->db->table("\x72\141\x70\157\x72\137\x63\141\x74\141\x74\141\x6e\137\x77\141\x6c\151")->where("\x69\144\x5f\163\x69\163\x77\141", $_0xc93e)->delete();
 goto L_5c923;
 L_97bb1:
 $this->db->table("\x72\141\x70\157\x72\137\x6e\141\x69\153")->where("\x69\144\x5f\163\x69\163\x77\141", $_0xc93e)->delete();
 goto L_2ecb1;
 L_2ecb1:
 $this->db->table("\x72\141\x70\157\x72\137\x6e\151\x6c\141\x69\137\x61\153\x68\151\x72")->where("\x69\144\x5f\163\x69\163\x77\141", $_0xc93e)->delete();
 goto L_a2b21;
 L_840b4:
 if (!$_0xc93e) {
 return ($this->response ?? response())->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x54\151\x64\141\x6b\40\x61\144\x61\40\x73\151\x73\167\x61\40\x79\141\x6e\147\x20\144\x69\160\x69\154\x69\150"]);
 }
 goto L_6e271;
 L_36ddc:
 return ($this->response ?? response())->setJSON(["\x73\164\x61\164\x75\163" => $_0xbd4a, "\x6d\145\x73\163\x61\147\x65" => $_0xbd4a ? "\x44\141\x74\141\x20\141\x6c\165\x6d\156\x69\40\x62\145\x72\150\x61\163\x69\154\x20\144\x69\150\x61\160\x75\163\x20\160\x65\162\x6d\141\x6e\145\x6e\56" : "\x47\141\x67\141\x6c\40\x6d\145\x6e\147\x68\141\x70\165\x73\40\x64\141\x74\141\x20\141\x6c\165\x6d\156\x69\56"]);
 L_5664d:
 $this->db->table("\x62\165\x6b\165\x5f\151\x6e\144\x75\153")->where("\x69\144\x5f\163\x69\163\x77\141", $_0xc93e)->delete();
 goto L_a29f4;
 }
 public function do_import()
 {
 goto L_b595a;
 L_2ff4c:
 $_0xbe70 = 0;
 goto L_fb622;
 L_b5894:
 $this->db->transStart();
 goto L_2ff4c;
 L_7d217:
 if (is_string($_0xef1b)) {
 $_0xef1b = json_decode($_0xef1b);
 }
 goto L_78b96;
 L_fb622:
 foreach ($_0xef1b as $_0x5ddb) {
 $_0xddd0 = (array) $_0x5ddb;
 $_0x58a2 = trim((string) ($_0xddd0["\x6e\141\x6d\141"] ?? $_0xddd0["\x6e\141\x6d\141\x5f\141\x6c\165\x6d\156\x69"] ?? ''));
 $_0xc84a = trim((string) ($_0xddd0["\x6e\151\x73"] ?? ''));
 $_0xdd4c = trim((string) ($_0xddd0["\x6e\151\x73\156"] ?? ''));
 $_0xb8e1 = trim((string) ($_0xddd0["\x6a\145\x6e\151\x73\137\x6b\145\x6c\141\x6d\151\x6e"] ?? "\x4c"));
 $_0xb260 = trim((string) ($_0xddd0["\x74\141\x68\165\x6e\137\x6c\165\x6c\165\x73"] ?? date("\x59")));
 $_0x7a25 = trim((string) ($_0xddd0["\x6b\145\x6c\141\x73\137\x61\153\x68\151\x72"] ?? ''));
 $_0xd494 = trim((string) ($_0xddd0["\x6e\157\x5f\151\x6a\141\x7a\141\x68"] ?? "\x2d\40\x2d"));
 if (empty($_0x58a2) && empty($_0xc84a)) {
 continue;
 }
 $_0xe597 = null;
 if (!empty($_0xc84a)) {
 $_0xe597 = $this->db->table("\x6d\141\x73\164\x65\162\x5f\163\x69\163\x77\141")->where("\x6e\151\x73", $_0xc84a)->get()->getRow();
 }
 if (!$_0xe597 && !empty($_0xdd4c)) {
 $_0xe597 = $this->db->table("\x6d\141\x73\164\x65\162\x5f\163\x69\163\x77\141")->where("\x6e\151\x73\156", $_0xdd4c)->get()->getRow();
 }
 $_0xa5cd = null;
 if ($_0xe597) {
 $_0xa5cd = $_0xe597->id_siswa;
 $this->db->table("\x6d\141\x73\164\x65\162\x5f\163\x69\163\x77\141")->where("\x69\144\x5f\163\x69\163\x77\141", $_0xa5cd)->update(["\x6e\141\x6d\141" => $_0x58a2, "\x6a\145\x6e\151\x73\137\x6b\145\x6c\141\x6d\151\x6e" => $_0xb8e1]);
 } else {
 $_0x793e = ["\x6e\141\x6d\141" => $_0x58a2, "\x6e\151\x73" => $_0xc84a, "\x6e\151\x73\156" => $_0xdd4c, "\x6a\145\x6e\151\x73\137\x6b\145\x6c\141\x6d\151\x6e" => $_0xb8e1, "\x75\163\x65\162\x6e\141\x6d\145" => !empty($_0xc84a) ? $_0xc84a : (!empty($_0xdd4c) ? $_0xdd4c : strtolower(str_replace("\x20", '', $_0x58a2)) . rand(100, 999)), "\x70\141\x73\163\x77\157\x72\144" => !empty($_0xc84a) ? $_0xc84a : "\x31\62\x33\64\x35\66", "\x66\157\x74\157" => !empty($_0xc84a) ? "\x75\160\x6c\157\x61\144\x73\57\x66\157\x74\157\x5f\163\x69\163\x77\141\x2f" . $_0xc84a . "\x2e\152\x70\147" : ''];
 $this->db->table("\x6d\141\x73\164\x65\162\x5f\163\x69\163\x77\141")->insert($_0x793e);
 $_0xa5cd = $this->db->insertID();
 }
 if ($_0xa5cd) {
 $_0x95b0 = $this->db->table("\x62\165\x6b\165\x5f\151\x6e\144\x75\153")->where("\x69\144\x5f\163\x69\163\x77\141", $_0xa5cd)->countAllResults();
 $_0x7be6 = ["\x73\164\x61\164\x75\163" => "\x32", "\x74\141\x68\165\x6e\137\x6c\165\x6c\165\x73" => $_0xb260, "\x6b\145\x6c\141\x73\137\x61\153\x68\151\x72" => $_0x7a25, "\x6e\157\x5f\151\x6a\141\x7a\141\x68" => $_0xd494];
 if ($_0x95b0 > 0) {
 $this->db->table("\x62\165\x6b\165\x5f\151\x6e\144\x75\153")->where("\x69\144\x5f\163\x69\163\x77\141", $_0xa5cd)->update($_0x7be6);
 } else {
 $_0x7be6["\x69\144\x5f\163\x69\163\x77\141"] = $_0xa5cd;
 $this->db->table("\x62\165\x6b\165\x5f\151\x6e\144\x75\153")->insert($_0x7be6);
 }
 $_0xbe70++;
 }
 }
 goto L_f8486;
 L_b595a:
 $_0xef1b = $this->request->getPost("\x61\154\x75\155\x6e\151");
 goto L_7d217;
 L_f8486:
 $this->db->transComplete();
 goto L_47278;
 L_47278:
 return ($this->response ?? response())->setJSON(["\x73\164\x61\164\x75\163" => true, "\x63\157\x75\156\x74" => $_0xbe70, "\x6d\145\x73\163\x61\147\x65" => "{$_0xbe70} data alumni berhasil diimport ke basis data."]);
 L_78b96:
 if (!$_0xef1b) {
 $_0xef1b = [];
 }
 goto L_b5894;
 }
 public function editKelulusan()
 {
 goto L_f991c;
 L_f2d23:
 $_0x41d1 = $this->request->getPost("\x6e\157\x5f\151\x6a\141\x7a\141\x68");
 goto L_7f2a3;
 L_7f2a3:
 $_0xd8ac = $this->request->getPost("\x6b\145\x6c\141\x73\137\x61\153\x68\151\x72");
 goto L_1305b;
 L_89207:
 $_0x716a = $this->request->getPost("\x74\141\x68\165\x6e\137\x6c\165\x6c\165\x73");
 goto L_f2d23;
 L_1305b:
 $_0xe403 = $this->db->table("\x62\165\x6b\165\x5f\151\x6e\144\x75\153")->where("\x69\144\x5f\163\x69\163\x77\141", $_0x2e07)->update(["\x6b\145\x6c\141\x73\137\x61\153\x68\151\x72" => $_0xd8ac, "\x74\141\x68\165\x6e\137\x6c\165\x6c\165\x73" => $_0x716a, "\x6e\157\x5f\151\x6a\141\x7a\141\x68" => $_0x41d1]);
 goto L_fce6b;
 L_fce6b:
 return ($this->response ?? response())->setJSON(["\x73\164\x61\164\x75\163" => $_0xe403, "\x6d\145\x73\163\x61\147\x65" => "\x44\141\x74\141\x20\153\x65\154\x75\154\x75\163\x61\156\x20\141\x6c\165\x6d\156\x69\40\x62\145\x72\150\x61\163\x69\154\x20\144\x69\160\x65\162\x62\141\x72\165\x69\56"]);
 L_f991c:
 $_0x2e07 = $this->request->getPost("\x69\144\x5f\163\x69\163\x77\141");
 goto L_89207;
 }
 public function excel()
 {
 goto L_6dfbf;
 L_75122:
 $_0x2afe = $this->request->getGet("\x74\141\x68\165\x6e");
 goto L_bccad;
 L_f546e:
 $_0x6f43 = $this->db->table("\x62\165\x6b\165\x5f\151\x6e\144\x75\153\x20\141")->select("\x61\56\x2a\54\x20\142\x2e\156\x61\155\x61\54\x20\142\x2e\156\x69\163\x2c\40\x62\56\x6e\151\x73\156\x2c\40\x62\56\x6a\145\x6e\151\x73\137\x6b\145\x6c\141\x6d\151\x6e\54\x20\142\x2e\164\x65\155\x70\141\x74\137\x6c\141\x68\151\x72\54\x20\142\x2e\164\x61\156\x67\147\x61\154\x5f\154\x61\150\x69\162")->join("\x6d\141\x73\164\x65\162\x5f\163\x69\163\x77\141\x20\142", "\x61\56\x69\144\x5f\163\x69\163\x77\141\x20\75\x20\142\x2e\151\x64\137\x73\151\x73\167\x61")->where("\x61\56\x73\164\x61\164\x75\163", $_0xdad5);
 goto L_6f755;
 L_8c320:
 echo "\x3c\164\x72\40\x73\164\x79\154\x65\75\x22\142\x61\143\x6b\147\x72\157\x75\156\x64\55\x63\157\x6c\157\x72\72\x23\146\x32\146\x32\146\x32\73\x20\146\x6f\156\x74\55\x77\145\x69\147\x68\164\x3a\142\x6f\154\x64\73\x22\76\xa\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\74\x74\150\x3e\116\x6f\74\x2f\164\x68\76\xa\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\74\x74\150\x3e\116\x49\123\x4e\74\x2f\164\x68\76\xa\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\74\x74\150\x3e\116\x49\123\x3c\57\x74\150\x3e\12\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x3c\164\x68\76\x4e\141\x6d\141\x20\114\x65\156\x67\153\x61\160\x3c\57\x74\150\x3e\12\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x3c\164\x68\76\x4a\113\x3c\57\x74\150\x3e\12\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x3c\164\x68\76\x4b\145\x6c\141\x73\40\x41\153\x68\151\x72\74\x2f\164\x68\76\xa\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\74\x74\150\x3e\124\x61\150\x75\156\x20\114\x75\154\x75\163\x3c\57\x74\150\x3e\12\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x3c\164\x68\76\x4e\157\x6d\157\x72\40\x49\152\x61\172\x61\150\x3c\57\x74\150\x3e\12\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x3c\57\x74\162\x3e";
 goto L_c3234;
 L_9b51c:
 $_0x9f37 = $this->dashboard->getSetting();
 goto L_fd977;
 L_8821e:
 echo "\x3c\57\x74\141\x62\154\x65\76";
 goto L_08030;
 L_c3234:
 $_0x277e = 1;
 goto L_bbcc5;
 L_dcdb3:
 header("\x43\141\x63\150\x65\55\x43\157\x6e\164\x72\157\x6c\72\x20\155\x61\170\x2d\141\x67\145\x3d\60");
 goto L_46196;
 L_08030:
 exit;
 L_6f755:
 if (!empty($_0x2afe) && $_0x2afe !== "\x61\154\x6c" && $_0x2afe !== "\x30") {
 $_0x6f43->where("\x61\56\x74\141\x68\165\x6e\137\x6c\165\x6c\165\x73", $_0x2afe);
 }
 goto L_bc60c;
 L_9d9fd:
 echo "\x3c\164\x72\76\x3c\164\x68\40\x63\157\x6c\163\x70\141\x6e\75\x22\70\x22\40\x73\164\x79\154\x65\75\x22\146\x6f\156\x74\55\x73\151\x7a\145\x3a\61\x36\160\x78\73\x20\146\x6f\156\x74\55\x77\145\x69\147\x68\164\x3a\142\x6f\154\x64\73\x20\164\x65\170\x74\55\x61\154\x69\147\x6e\72\x63\145\x6e\164\x65\162\x3b\42\x3e\104\x41\124\x41\40\x41\114\x55\115\x4e\111\x20\57\x20\113\x45\114\x55\114\x55\123\x41\116\x3c\57\x74\150\x3e\74\x2f\164\x72\76";
 goto L_1a186;
 L_b300b:
 header("\x43\157\x6e\164\x65\156\x74\55\x44\151\x73\160\x6f\163\x69\164\x69\157\x6e\72\x20\141\x74\164\x61\143\x68\155\x65\156\x74\73\x20\146\x69\154\x65\156\x61\155\x65\75\x22" . $_0x8f33 . "\x22");
 goto L_dcdb3;
 L_38e2e:
 header("\x43\157\x6e\164\x65\156\x74\55\x54\171\x70\145\x3a\40\x61\160\x70\154\x69\143\x61\164\x69\157\x6e\57\x76\156\x64\56\x6d\163\x2d\145\x78\143\x65\154\x3b\40\x63\150\x61\162\x73\145\x74\75\x75\164\x66\55\x38");
 goto L_b300b;
 L_bccad:
 $_0xc1b7 = $this->request->getGet("\x6b\145\x6c\141\x73");
 goto L_f546e;
 L_46196:
 echo "\x3c\164\x61\142\x6c\145\x20\142\x6f\162\x64\145\x72\75\x22\61\x22\76";
 goto L_9d9fd;
 L_7f103:
 $_0xa543 = $_0x6f43->get()->getResult();
 goto L_9b51c;
 L_fd977:
 $_0x8f33 = "\x44\141\x74\141\x5f\101\x6c\165\x6d\156\x69\137" . ($_0x2afe ? $_0x2afe . "\x5f" : '') . date("\x59\155\x64\137\x48\151\x73") . "\x2e\170\x6c\163";
 goto L_38e2e;
 L_1a186:
 echo "\x3c\164\x72\76\x3c\164\x68\40\x63\157\x6c\163\x70\141\x6e\75\x22\70\x22\40\x73\164\x79\154\x65\75\x22\146\x6f\156\x74\55\x73\151\x7a\145\x3a\61\x33\160\x78\73\x20\164\x65\170\x74\55\x61\154\x69\147\x6e\72\x63\145\x6e\164\x65\162\x3b\42\x3e" . esc($_0x9f37->sekolah ?? "\x53\105\x4b\117\x4c\101\x48") . "\x3c\57\x74\150\x3e\74\x2f\164\x72\76";
 goto L_35ddd;
 L_35ddd:
 echo "\x3c\164\x72\76\x3c\164\x68\40\x63\157\x6c\163\x70\141\x6e\75\x22\70\x22\76\x3c\57\x74\150\x3e\74\x2f\164\x72\76";
 goto L_8c320;
 L_61671:
 $_0x6f43->orderBy("\x61\56\x74\141\x68\165\x6e\137\x6c\165\x6c\165\x73", "\x44\105\x53\103")->orderBy("\x62\56\x6e\141\x6d\141", "\x41\123\x43");
 goto L_7f103;
 L_bbcc5:
 foreach ($_0xa543 as $_0x29a5) {
 echo "\x3c\164\x72\76";
 echo "\x3c\164\x64\40\x61\154\x69\147\x6e\75\x22\143\x65\156\x74\145\x72\42\x3e" . $_0x277e++ . "\x3c\57\x74\144\x3e";
 echo "\x3c\164\x64\40\x73\164\x79\154\x65\75\x22\155\x73\157\x2d\156\x75\155\x62\145\x72\55\x66\157\x72\155\x61\164\x3a\47\x40\47\x3b\42\x3e" . esc($_0x29a5->nisn ?? '') . "\x3c\57\x74\144\x3e";
 echo "\x3c\164\x64\40\x73\164\x79\154\x65\75\x22\155\x73\157\x2d\156\x75\155\x62\145\x72\55\x66\157\x72\155\x61\164\x3a\47\x40\47\x3b\42\x3e" . esc($_0x29a5->nis ?? '') . "\x3c\57\x74\144\x3e";
 echo "\x3c\164\x64\76" . esc($_0x29a5->nama ?? '') . "\x3c\57\x74\144\x3e";
 echo "\x3c\164\x64\40\x61\154\x69\147\x6e\75\x22\143\x65\156\x74\145\x72\42\x3e" . esc($_0x29a5->jenis_kelamin ?? '') . "\x3c\57\x74\144\x3e";
 echo "\x3c\164\x64\40\x61\154\x69\147\x6e\75\x22\143\x65\156\x74\145\x72\42\x3e" . esc($_0x29a5->kelas_akhir ?? "\x2d") . "\x3c\57\x74\144\x3e";
 echo "\x3c\164\x64\40\x61\154\x69\147\x6e\75\x22\143\x65\156\x74\145\x72\42\x3e" . esc($_0x29a5->tahun_lulus ?? "\x2d") . "\x3c\57\x74\144\x3e";
 echo "\x3c\164\x64\76" . esc($_0x29a5->no_ijazah ?? "\x2d") . "\x3c\57\x74\144\x3e";
 echo "\x3c\57\x74\162\x3e";
 }
 goto L_8821e;
 L_bc60c:
 if (!empty($_0xc1b7) && $_0xc1b7 !== "\x61\154\x6c" && $_0xc1b7 !== "\x30") {
 $_0x6f43->where("\x61\56\x6b\145\x6c\141\x73\137\x61\153\x68\151\x72", $_0xc1b7);
 }
 goto L_61671;
 L_6dfbf:
 $_0xdad5 = $this->request->getGet("\x66\151\x6c\164\x65\162") ?? "\x32";
 goto L_75122;
 }
}