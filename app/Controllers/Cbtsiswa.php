<?php
/*   ________________________________________
    |               NextGen Garuda CBT       |
    |    Protected & Distributed via GitHub  |
    |________________________________________|
*/
namespace App\Controllers;

/**
 * Created by IntelliJ IDEA.
 * User: Hidayatur Rohman
 * Date: 07/07/20
 * Time: 14:10
 */
use CodeIgniter\I18n\Time;
use DateTime;
use DateInterval;
class Cbtsiswa extends BaseController
{
 public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $_0xe10c)
 {
 parent::initController($request, $response, $_0xe10c);
 }
 /**
 * Cek auth siswa — redirect ke login jika belum login
 * Dipanggil di awal setiap public method yang butuh auth
 */
 private function requireLogin()
 {
 if (!session()->get("\x69\163\x5f\154\x6f\147\x69\156")) {
 return redirect()->to(base_url("\x61\165\x74\150\x2f\154\x6f\147\x69\156"));
 }
 return null;
 }
 public function index()
 {
 }
 public function audit_soal()
 {
 goto L_e4dc4;
 L_0f0b0:
 $_0xb282 = $_0x2ba7->table("\x63\142\x74\137\x62\141\x6e\153\x5f\163\x6f\141\x6c")->get()->getResult();
 goto L_e7660;
 L_e4dc4:
 $_0x4ef2 = $this->request->getGet("\x73\145\x63\162\x65\164");
 goto L_15f3f;
 L_25209:
 return $this->response->setJSON($_0xccc0);
 L_e7660:
 $_0xccc0 = ["\x74\157\x74\141\x6c\137\x62\141\x6e\153" => count($_0xb282), "\x73\165\x6d\155\x61\162\x79" => ["\x74\157\x74\141\x6c\137\x73\157\x61\154" => 0, "\x73\157\x61\154\x5f\156\x6f\162\x6d\141\x6c" => 0, "\x73\157\x61\154\x5f\142\x65\162\x6d\141\x73\141\x6c\141\x68" => 0], "\x69\163\x73\165\x65\163" => []];
 goto L_11be6;
 L_a6e35:
 $_0x2ba7 = \Config\Database::connect();
 goto L_0f0b0;
 L_15f3f:
 if ($_0x4ef2 !== "\x6d\141\x68\144\x61\137\x61\165\x64\151\x74\137\x32\60\x32\66") {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x55\156\x61\165\x74\150\x6f\162\x69\172\x65\144"]);
 }
 goto L_a6e35;
 L_11be6:
 foreach ($_0xb282 as $_0xdf82) {
 $_0x5d6a = $_0xdf82->id_bank;
 $_0xbfc5 = $_0x2ba7->table("\x63\142\x74\137\x73\157\x61\154")->where("\x62\141\x6e\153\x5f\151\x64", $_0x5d6a)->orderBy("\x6e\157\x6d\157\x72\137\x73\157\x61\154", "\x41\123\x43")->get()->getResult();
 foreach ($_0xbfc5 as $_0xbcd7) {
 $_0xccc0["\x73\165\x6d\155\x61\162\x79"]["\x74\157\x74\141\x6c\137\x73\157\x61\154"]++;
 $_0xed8e = [];
 $_0xc5cf = trim(strip_tags((string) $_0xbcd7->soal));
 if ($_0xbcd7->jenis == "\x31") {
 $_0x4ade = trim(strip_tags((string) $_0xbcd7->opsi_a));
 $_0xc162 = trim(strip_tags((string) $_0xbcd7->opsi_b));
 $_0xed92 = trim(strip_tags((string) $_0xbcd7->opsi_c));
 $_0xd6a8 = trim(strip_tags((string) $_0xbcd7->opsi_d));
 $_0xfddd = 0;
 foreach ([$_0x4ade, $_0xc162, $_0xed92, $_0xd6a8] as $_0xd878) {
 if ($_0xd878 !== '' || !empty($_0xbcd7->file)) {
 $_0xfddd++;
 }
 }
 if ($_0xfddd < 2) {
 $_0xed8e[] = "PG opsi kurang dari 2 (terdeteksi: {$_0xfddd})";
 }
 } elseif ($_0xbcd7->jenis == "\x32") {
 $_0x21e8 = $_0xbcd7->opsi_a;
 $_0xf1a4 = is_string($_0x21e8) ? json_decode($_0x21e8, true) : (is_array($_0x21e8) ? $_0x21e8 : null);
 $_0xf7f8 = is_array($_0xf1a4) && count(array_filter($_0xf1a4)) >= 2;
 if (!$_0xf7f8) {
 $_0x5a6d = 0;
 foreach (["\x6f\160\x73\151\x5f\141", "\x6f\160\x73\151\x5f\142", "\x6f\160\x73\151\x5f\143", "\x6f\160\x73\151\x5f\144", "\x6f\160\x73\151\x5f\145"] as $_0x622d) {
 if (!empty($_0xbcd7->{$_0x622d}) && trim(strip_tags((string) $_0xbcd7->{$_0x622d})) !== '') {
 $_0x5a6d++;
 }
 }
 if ($_0x5a6d >= 2) {
 $_0xed8e[] = "PGK terpisah di opsi A-E ({$_0x5a6d} opsi, aman auto-fallback)";
 } else {
 $_0xed8e[] = "\x50\107\x4b\40\x6f\160\x73\151\x20\153\x6f\163\x6f\156\x67\40\x2f\40\x3c\40\x32\40\x6f\160\x73\151";
 }
 }
 } elseif ($_0xbcd7->jenis == "\x33") {
 $_0xaf61 = $_0xbcd7->jawaban;
 $_0xf1a4 = is_string($_0xaf61) ? json_decode($_0xaf61, true) : (is_array($_0xaf61) ? $_0xaf61 : null);
 $_0x4005 = $_0xf1a4["\x6a\141\x77\141\x62\141\x6e"] ?? $_0xf1a4["\x74\141\x62\145\x6c"] ?? null;
 if (!$_0x4005 && !empty($_0xbcd7->opsi_a)) {
 $_0x990f = json_decode($_0xbcd7->opsi_a, true);
 $_0x4005 = $_0x990f["\x6a\141\x77\141\x62\141\x6e"] ?? $_0x990f["\x74\141\x62\145\x6c"] ?? null;
 }
 if (!is_array($_0x4005) || count($_0x4005) < 2) {
 $_0xed8e[] = "\x4d\145\x6e\152\x6f\144\x6f\150\x6b\141\x6e\40\x74\141\x62\145\x6c\40\x62\145\x6c\165\x6d\40\x6c\145\x6e\147\x6b\141\x70";
 }
 }
 if (!empty($_0xed8e)) {
 $_0xccc0["\x73\165\x6d\155\x61\162\x79"]["\x73\157\x61\154\x5f\142\x65\162\x6d\141\x73\141\x6c\141\x68"]++;
 $_0xccc0["\x69\163\x73\165\x65\163"][] = ["\x62\141\x6e\153\x5f\151\x64" => $_0x5d6a, "\x62\141\x6e\153\x5f\153\x6f\144\x65" => $_0xdf82->bank_kode ?? $_0xdf82->kode_bank ?? "\x2d", "\x62\141\x6e\153\x5f\156\x61\155\x61" => $_0xdf82->bank_nama ?? $_0xdf82->nama_bsp ?? "\x2d", "\x69\144\x5f\163\x6f\141\x6c" => $_0xbcd7->id_soal, "\x6e\157\x6d\157\x72\137\x73\157\x61\154" => $_0xbcd7->nomor_soal, "\x6a\145\x6e\151\x73" => $_0xbcd7->jenis, "\x6d\141\x73\141\x6c\141\x68" => $_0xed8e, "\x63\165\x70\154\x69\153\x61\156" => mb_substr($_0xc5cf, 0, 70)];
 } else {
 $_0xccc0["\x73\165\x6d\155\x61\162\x79"]["\x73\157\x61\154\x5f\156\x6f\162\x6d\141\x6c"]++;
 }
 }
 }
 goto L_25209;
 }
 public function leavecbt()
 {
 goto L_33434;
 L_d9275:
 $_0x90f5 = (int) $this->request->getPost("\x73\151\x73\167\x61");
 goto L_7b3f6;
 L_ea174:
 if ($_0x90f5 <= 0 || $_0x4a66 <= 0) {
 return $this->response->setJSON(["\x73\165\x63\143\x65\163\x73" => false, "\x6d\145\x73\163\x61\147\x65" => "\x4d\151\x73\163\x69\156\x67\40\x6f\162\x20\151\x6e\166\x61\154\x69\144\x20\160\x61\162\x61\155\x65\164\x65\162\x73"]);
 }
 goto L_f5886;
 L_d7195:
 if ($_0x414a) {
 $_0xb95d = $_0xee2a->table("\x6c\157\x67\137\x75\152\x69\141\x6e")->where("\x69\144\x5f\154\x6f\147", $_0x414a->id_log)->update(["\x61\147\x65\156\x74" => "\x69\154\x6c\145\x67\141\x6c\40\x61\147\x65\156\x74", "\x64\145\x76\151\x63\145" => "\x69\154\x6c\145\x67\141\x6c\40\x64\145\x76\151\x63\145"]);
 }
 goto L_d41ed;
 L_7b3f6:
 $_0x4a66 = (int) $this->request->getPost("\x6a\141\x64\167\x61\154");
 goto L_ea174;
 L_493f7:
 if ($_0x8435) {
 $this->logging->saveLog(2, "\x4d\145\x6d\145\x72\154\x75\153\x61\156\x20\162\x65\163\x65\164\x20\151\x7a\151\x6e");
 }
 goto L_83753;
 L_33434:
 $this->logging = new \App\Models\LogModel();
 goto L_d9275;
 L_26e5f:
 $_0xee2a->transComplete();
 goto L_c6167;
 L_fcc7b:
 $_0xee2a->transStart();
 goto L_3ec8b;
 L_3ec8b:
 $_0x414a = $_0xee2a->table("\x6c\157\x67\137\x75\152\x69\141\x6e")->where("\x69\144\x5f\163\x69\163\x77\141", $_0x90f5)->where("\x69\144\x5f\152\x61\144\x77\141\x6c", $_0x4a66)->where("\x6c\157\x67\137\x74\171\x70\145", "\x31")->get()->getRow();
 goto L_cbed5;
 L_d41ed:
 $_0x5751 = $_0xee2a->table("\x63\142\x74\137\x73\151\x73\167\x61")->where("\x69\144\x5f\163\x69\163\x77\141", $_0x90f5)->where("\x69\144\x5f\152\x61\144\x77\141\x6c", $_0x4a66)->update(["\x72\145\x73\145\x74\137\x69\172\x69\156" => 0]);
 goto L_26e5f;
 L_c6167:
 $_0x8435 = $_0xee2a->transStatus() && $_0xb95d && $_0x5751;
 goto L_493f7;
 L_cbed5:
 $_0xb95d = true;
 goto L_d7195;
 L_f5886:
 $_0xee2a = \Config\Database::connect();
 goto L_fcc7b;
 L_83753:
 return $this->response->setJSON(["\x73\165\x63\143\x65\163\x73" => $_0x8435, "\x73\164\x61\164\x75\163" => $_0x8435, "\x6d\145\x73\163\x61\147\x65" => $_0x8435 ? "\x52\145\x73\145\x74\40\x69\172\x69\156\x20\141\x70\160\x6c\151\x65\144" : "\x46\141\x69\154\x65\144\x20\164\x6f\40\x61\160\x70\154\x79\40\x72\145\x73\145\x74\40\x69\172\x69\156"]);
 }
 public function hitung_pelanggaran()
 {
 goto L_f6ffc;
 L_e2da1:
 $_0xf6d4 = $this->maybe_unserialize($_0xe732->pelanggaran ?? "\x7b\175");
 goto L_4f65e;
 L_4f65e:
 if (!is_object($_0xf6d4) || !isset($_0xf6d4->{$_0x90ee})) {
 $_0xf6d4 = (object) ["\x72\151\x6e\147\x61\156" => 0, "\x73\145\x64\141\x6e\147" => 0, "\x62\145\x72\141\x74" => 0];
 }
 goto L_60b02;
 L_42038:
 $_0xe732 = $_0xfe87->table("\x63\142\x74\137\x73\151\x73\167\x61")->select("\x69\144\x5f\143\x62\164\x5f\163\x69\163\x77\141\x2c\40\x70\145\x6c\141\x6e\147\x67\141\x72\141\x6e")->where("\x69\144\x5f\163\x69\163\x77\141", $_0x10e7)->where("\x69\144\x5f\152\x61\144\x77\141\x6c", $_0x247a)->get()->getRow();
 goto L_32ea0;
 L_1695d:
 $_0xfe87 = \Config\Database::connect();
 goto L_42038;
 L_3dcf5:
 $_0xf71f = $_0xfe87->table("\x63\142\x74\137\x73\151\x73\167\x61")->where("\x69\144\x5f\163\x69\163\x77\141", $_0x10e7)->where("\x69\144\x5f\152\x61\144\x77\141\x6c", $_0x247a)->update(["\x70\145\x6c\141\x6e\147\x67\141\x72\141\x6e" => json_encode($_0xf6d4)]);
 goto L_c6e0f;
 L_4d3dd:
 $_0x10e7 = (int) $this->request->getPost("\x73\151\x73\167\x61");
 goto L_6d746;
 L_7f87d:
 return $this->response->setJSON(["\x73\165\x63\143\x65\163\x73" => $_0xf71f, "\x70\145\x6c\141\x6e\147\x67\141\x72\141\x6e" => $_0xf6d4]);
 L_40c52:
 $_0x90ee = $this->request->getPost("\x6a\145\x6e\151\x73");
 goto L_1695d;
 L_60b02:
 $_0xf6d4->{$_0x90ee} += 1;
 goto L_3dcf5;
 L_f6ffc:
 $this->logging = new \App\Models\LogModel();
 goto L_4d3dd;
 L_6d746:
 $_0x247a = (int) $this->request->getPost("\x6a\141\x64\167\x61\154");
 goto L_40c52;
 L_c6e0f:
 $this->logging->saveLog(2, "\x4d\145\x6c\141\x6b\165\x6b\141\x6e\40\x70\145\x6c\141\x6e\147\x67\141\x72\141\x6e\72\x20" . $_0x90ee);
 goto L_7f87d;
 L_32ea0:
 if (!$_0xe732) {
 return $this->response->setJSON(["\x73\165\x63\143\x65\163\x73" => false, "\x6d\145\x73\163\x61\147\x65" => "\x44\141\x74\141\x20\163\x69\163\x77\141\x20\164\x69\144\x61\153\x20\144\x69\164\x65\155\x75\153\x61\156"]);
 }
 goto L_e2da1;
 }
 private function resolveSiswa($_0xb8f8, $_0xb5d9, $_0x12a8)
 {
 goto L_bae55;
 L_de498:
 // Try by session nama
 $_0xf1c1 = session()->get("\x6e\141\x6d\141");
 goto L_933f9;
 L_080fe:
 $_0x33d8 = trim((string) $_0xb8f8);
 goto L_b5c4e;
 L_b020a:
 if ($_0xfbc3) {
 $_0x9674 = $_0x28cf->table("\x6d\141\x73\164\x65\162\x5f\163\x69\163\x77\141")->where("\x69\144\x5f\163\x69\163\x77\141", $_0xfbc3)->get()->getRow();
 if ($_0x9674) {
 return $_0x9674;
 }
 }
 goto L_de498;
 L_bae55:
 $_0x5c7a = $this->cbt ?? new \App\Models\CbtModel();
 goto L_d73f4;
 L_960b8:
 // Try by session ID
 $_0xfbc3 = session()->get("\x69\144\x5f\163\x69\163\x77\141") ?? session()->get("\x69\144\x5f\165\x73\145\x72") ?? session()->get("\x75\163\x65\162\x5f\151\x64");
 goto L_b020a;
 L_d73f4:
 $_0x9674 = $_0x5c7a->getDataSiswa($_0xb8f8, $_0xb5d9, $_0x12a8);
 goto L_9bbc4;
 L_af3b6:
 $_0x28cf = \Config\Database::connect();
 goto L_080fe;
 L_9bbc4:
 if ($_0x9674) {
 return $_0x9674;
 }
 goto L_af3b6;
 L_5c4b2:
 if ($_0x9674) {
 return $_0x9674;
 }
 goto L_960b8;
 L_b5c4e:
 // Try direct lookup from master_siswa
 $_0x9674 = $_0x28cf->table("\x6d\141\x73\164\x65\162\x5f\163\x69\163\x77\141")->groupStart()->where("\x75\163\x65\162\x6e\141\x6d\145", $_0x33d8)->orWhere("\x6e\151\x73", $_0x33d8)->orWhere("\x6e\151\x73\156", $_0x33d8)->groupEnd()->get()->getRow();
 goto L_5c4b2;
 L_933f9:
 if ($_0xf1c1) {
 $_0x9674 = $_0x28cf->table("\x6d\141\x73\164\x65\162\x5f\163\x69\163\x77\141")->where("\x6e\141\x6d\141", $_0xf1c1)->get()->getRow();
 if ($_0x9674) {
 return $_0x9674;
 }
 }
 goto L_85291;
 L_85291:
 // Ultimate safe fallback object so views never crash
 return (object) ["\x69\144\x5f\163\x69\163\x77\141" => $_0xfbc3 ?? 0, "\x6e\141\x6d\141" => $_0xf1c1 ?? $_0x33d8 ?? "\x50\145\x73\145\x72\164\x61\40\x55\152\x69\141\x6e", "\x75\163\x65\162\x6e\141\x6d\145" => $_0x33d8, "\x6e\151\x73" => '', "\x6e\151\x73\156" => '', "\x61\147\x61\155\x61" => '', "\x66\157\x74\157" => '', "\x6e\141\x6d\141\x5f\153\x65\154\x61\163" => "\x2d", "\x6b\157\x64\145\x5f\153\x65\154\x61\163" => "\x2d", "\x6e\157\x6d\157\x72\137\x70\145\x73\145\x72\164\x61" => "\x2d"];
 }
 public function cbt()
 {
 goto L_1483c;
 L_4b7e9:
 $_0xcaa6 = (object) session()->get();
 goto L_04919;
 L_04f9f:
 $_0x2d3a["\x74\160"] = $_0xc3d8->getTahun();
 goto L_c91c7;
 L_8e692:
 $_0x3540 = $_0xc3d8->getTahunActive();
 goto L_837cb;
 L_837cb:
 $_0xb48d = $_0xc3d8->getSemesterActive();
 goto L_4b7e9;
 L_58501:
 $_0x2d3a["\x73\155\x74"] = $_0xc3d8->getSemester();
 goto L_58946;
 L_bd317:
 $this->dashboard = $_0xc3d8;
 goto L_34a9a;
 L_c91c7:
 $_0x2d3a["\x74\160\x5f\141\x63\164\x69\166\x65"] = $_0x3540;
 goto L_58501;
 L_1483c:
 if ($_0xeea9 = $this->requireLogin()) {
 return $_0xeea9;
 }
 goto L_a7c1b;
 L_41fba:
 $_0xabaf = $_0x3540->id_tp ?? 0;
 goto L_9b847;
 L_34a9a:
 $this->cbt = new \App\Models\CbtModel();
 goto L_8e692;
 L_9b847:
 $_0xcde8 = $_0xb48d->id_smt ?? 0;
 goto L_06f02;
 L_58946:
 $_0x2d3a["\x73\155\x74\137\x61\143\x74\151\x76\145"] = $_0xb48d;
 goto L_1daa8;
 L_06f02:
 $_0x1666 = $this->resolveSiswa($_0x91a7, $_0xabaf, $_0xcde8);
 goto L_01fda;
 L_04919:
 $_0x91a7 = $_0xcaa6->username ?? session()->get("\x75\163\x65\162\x6e\141\x6d\145") ?? '';
 goto L_41fba;
 L_df02f:
 return view("\x6d\145\x6d\142\x65\162\x73\57\x73\151\x73\167\x61\57\x63\142\x74\57\x64\141\x74\141\x5f\152\x61\144\x77\141\x6c", $_0x2d3a);
 L_01fda:
 $_0x2d3a = ["\x75\163\x65\162" => $_0xcaa6, "\x73\151\x73\167\x61" => $_0x1666, "\x6a\165\x64\165\x6c" => "\x50\145\x6e\151\x6c\141\x69\141\x6e", "\x73\145\x74\164\x69\156\x67" => $_0xc3d8->getSetting()];
 goto L_04f9f;
 L_1daa8:
 $_0x2d3a["\x72\165\x6e\156\x69\156\x67\137\x74\145\x78\164"] = $_0xc3d8->getRunningText();
 goto L_df02f;
 L_a7c1b:
 $_0xc3d8 = new \App\Models\DashboardModel();
 goto L_bd317;
 }
 public function get_cbt_siswa()
 {
 goto L_f3ef8;
 L_00775:
 if (empty($_0x70c0->nama_sesi)) {
 $_0x70c0->nama_sesi = "\x53\145\x73\151\x20\61";
 }
 goto L_77f38;
 L_49385:
 $_0x86d9 = null;
 goto L_110b3;
 L_44ab1:
 $_0x696a = $_0x85e0->tp_active;
 goto L_1772e;
 L_12f9d:
 // Standarisasi jam & nama jika belum lengkap
 if (empty($_0x70c0->waktu_mulai)) {
 $_0x70c0->waktu_mulai = "\x30\66\x3a\60\x30\72\x30\60";
 }
 goto L_da729;
 L_8ef54:
 // Authoritative Sesi Siswa & Kelas Siswa (from kelas_siswa)
 $_0x70c0 = $_0x1d94->table("\x6b\145\x6c\141\x73\137\x73\151\x73\167\x61\40\x6b\163")->select("\x6b\163\x2e\151\x64\137\x73\151\x73\167\x61\40\x61\163\x20\163\x69\163\x77\141\x5f\151\x64\54\x20\153\x73\56\x69\144\x5f\153\x65\154\x61\163\x20\141\x73\40\x6b\145\x6c\141\x73\137\x69\144\x2c\40\x61\56\x72\165\x61\156\x67\137\x69\144\x2c\40\x61\56\x73\145\x73\151\x5f\151\x64\54\x20\141\x2e\164\x70\137\x69\144\x2c\40\x61\56\x73\155\x74\137\x69\144\x2c\40\x70\56\x6e\157\x6d\157\x72\137\x70\145\x73\145\x72\164\x61\54\x20\153\x2e\153\x6f\144\x65\137\x6b\145\x6c\141\x73\54\x20\153\x2e\156\x61\155\x61\137\x6b\145\x6c\141\x73\54\x20\153\x2e\154\x65\166\x65\154\x5f\151\x64\54\x20\162\x2e\153\x6f\144\x65\137\x72\165\x61\156\x67\54\x20\162\x2e\156\x61\155\x61\137\x72\165\x61\156\x67\54\x20\163\x2e\153\x6f\144\x65\137\x73\145\x73\151\x2c\40\x73\56\x6e\141\x6d\141\x5f\163\x65\163\x69\54\x20\163\x2e\167\x61\153\x74\165\x5f\155\x75\154\x61\151\x2c\40\x73\56\x77\141\x6b\164\x75\137\x61\153\x68\151\x72")->join("\x6d\141\x73\164\x65\162\x5f\153\x65\154\x61\163\x20\153", "\x6b\56\x69\144\x5f\153\x65\154\x61\163\x3d\153\x73\56\x69\144\x5f\153\x65\154\x61\163", "\x6c\145\x66\164")->join("\x63\142\x74\137\x73\145\x73\151\x5f\163\x69\163\x77\141\x20\141", "\x61\56\x73\151\x73\167\x61\137\x69\144\x3d\153\x73\56\x69\144\x5f\163\x69\163\x77\141\x20\101\x4e\104\x20\141\x2e\164\x70\137\x69\144\x3d\153\x73\56\x69\144\x5f\164\x70\40\x41\116\x44\40\x61\56\x73\155\x74\137\x69\144\x3d\153\x73\56\x69\144\x5f\163\x6d\164", "\x6c\145\x66\164")->join("\x63\142\x74\137\x6e\157\x6d\157\x72\137\x70\145\x73\145\x72\164\x61\40\x70", "\x70\56\x69\144\x5f\163\x69\163\x77\141\x3d\153\x73\56\x69\144\x5f\163\x69\163\x77\141\x20\101\x4e\104\x20\160\x2e\151\x64\137\x74\160\x3d\153\x73\56\x69\144\x5f\164\x70\40\x41\116\x44\40\x70\56\x69\144\x5f\163\x6d\164\x3d\153\x73\56\x69\144\x5f\163\x6d\164", "\x6c\145\x66\164")->join("\x63\142\x74\137\x72\165\x61\156\x67\40\x72", "\x72\56\x69\144\x5f\162\x75\141\x6e\147\x3d\141\x2e\162\x75\141\x6e\147\x5f\151\x64", "\x6c\145\x66\164")->join("\x63\142\x74\137\x73\145\x73\151\x20\163", "\x73\56\x69\144\x5f\163\x65\163\x69\75\x61\56\x73\145\x73\151\x5f\151\x64", "\x6c\145\x66\164")->where(["\x6b\163\x2e\151\x64\137\x73\151\x73\167\x61" => $_0x1dfa, "\x6b\163\x2e\151\x64\137\x74\160" => $_0x696a->id_tp, "\x6b\163\x2e\151\x64\137\x73\155\x74" => $_0x76c3->id_smt])->get()->getRow();
 goto L_c9b58;
 L_c9aff:
 $_0x16ba["\x73\155\x74"] = $_0x85e0->smt;
 goto L_bca77;
 L_0224e:
 $_0x86d9->cbtsiswa = $_0x8285;
 goto L_2e310;
 L_e91eb:
 $_0x86d9->sesisiswa->kelas_id = $_0x70c0->kelas_id;
 goto L_28d6e;
 L_9d239:
 $_0x16ba["\x73\155\x74\137\x61\143\x74\151\x76\145"] = $_0x76c3;
 goto L_49385;
 L_d1876:
 if (empty($_0x70c0->nama_ruang)) {
 $_0x70c0->nama_ruang = "\x52\165\x61\156\x67\40\x31";
 }
 goto L_00775;
 L_58eea:
 foreach ($_0x8285 as $_0x5e96) {
 $_0x8740 = $this->maybe_unserialize($_0x5e96->nilai_input ?? "\x7b\175");
 if (is_object($_0x8740)) {
 $_0x5e96->skor_total = $_0x8740->skor_total ?? $_0x8740->total_nilai ?? $_0x8740->pg_nilai ?? null;
 $_0x5e96->pg_benar = $_0x8740->pg_benar ?? null;
 } elseif (is_array($_0x8740)) {
 $_0x5e96->skor_total = $_0x8740["\x73\153\x6f\162\x5f\164\x6f\164\x61\154"] ?? $_0x8740["\x74\157\x74\141\x6c\137\x6e\151\x6c\141\x69"] ?? $_0x8740["\x70\147\x5f\156\x69\154\x61\151"] ?? null;
 $_0x5e96->pg_benar = $_0x8740["\x70\147\x5f\142\x65\156\x61\162"] ?? null;
 } else {
 $_0x5e96->skor_total = null;
 $_0x5e96->pg_benar = null;
 }
 // Jika sudah selesai ujian tapi nilai_input belum terisi, hitung otomatis sekarang
 if (!empty($_0x5e96->selesai) && $_0x5e96->skor_total === null) {
 try {
 $_0x5647 = $this->olah_nilai(2, $_0x696a->id_tp, $_0x76c3->id_smt, $_0x1dfa, $_0x5e96->id_jadwal, false);
 if ($_0x5647 && !empty($_0x5647->sesisiswa)) {
 $_0x232c = $_0x5647->sesisiswa[0]->nilai_akhir ?? null;
 if ($_0x232c) {
 $_0x5e96->skor_total = $_0x232c->skor_total ?? $_0x232c->pg_nilai ?? 0;
 $_0x5e96->pg_benar = $_0x232c->pg_benar ?? 0;
 }
 }
 } catch (\Throwable $_0x8b85) {
 }
 }
 }
 goto L_0224e;
 L_c9b58:
 // Fallback 1a: Jika belum ada di kelas_siswa TP/SMT aktif, ambil dari kelas_siswa terbaru
 if (!$_0x70c0) {
 $_0x70c0 = $_0x1d94->table("\x6b\145\x6c\141\x73\137\x73\151\x73\167\x61\40\x6b\163")->select("\x6b\163\x2e\151\x64\137\x73\151\x73\167\x61\40\x61\163\x20\163\x69\163\x77\141\x5f\151\x64\54\x20\153\x73\56\x69\144\x5f\153\x65\154\x61\163\x20\141\x73\40\x6b\145\x6c\141\x73\137\x69\144\x2c\40\x61\56\x72\165\x61\156\x67\137\x69\144\x2c\40\x61\56\x73\145\x73\151\x5f\151\x64\54\x20\141\x2e\164\x70\137\x69\144\x2c\40\x61\56\x73\155\x74\137\x69\144\x2c\40\x70\56\x6e\157\x6d\157\x72\137\x70\145\x73\145\x72\164\x61\54\x20\153\x2e\153\x6f\144\x65\137\x6b\145\x6c\141\x73\54\x20\153\x2e\156\x61\155\x61\137\x6b\145\x6c\141\x73\54\x20\153\x2e\154\x65\166\x65\154\x5f\151\x64\54\x20\162\x2e\153\x6f\144\x65\137\x72\165\x61\156\x67\54\x20\162\x2e\156\x61\155\x61\137\x72\165\x61\156\x67\54\x20\163\x2e\153\x6f\144\x65\137\x73\145\x73\151\x2c\40\x73\56\x6e\141\x6d\141\x5f\163\x65\163\x69\54\x20\163\x2e\167\x61\153\x74\165\x5f\155\x75\154\x61\151\x2c\40\x73\56\x77\141\x6b\164\x75\137\x61\153\x68\151\x72")->join("\x6d\141\x73\164\x65\162\x5f\153\x65\154\x61\163\x20\153", "\x6b\56\x69\144\x5f\153\x65\154\x61\163\x3d\153\x73\56\x69\144\x5f\153\x65\154\x61\163", "\x6c\145\x66\164")->join("\x63\142\x74\137\x73\145\x73\151\x5f\163\x69\163\x77\141\x20\141", "\x61\56\x73\151\x73\167\x61\137\x69\144\x3d\153\x73\56\x69\144\x5f\163\x69\163\x77\141", "\x6c\145\x66\164")->join("\x63\142\x74\137\x6e\157\x6d\157\x72\137\x70\145\x73\145\x72\164\x61\40\x70", "\x70\56\x69\144\x5f\163\x69\163\x77\141\x3d\153\x73\56\x69\144\x5f\163\x69\163\x77\141", "\x6c\145\x66\164")->join("\x63\142\x74\137\x72\165\x61\156\x67\40\x72", "\x72\56\x69\144\x5f\162\x75\141\x6e\147\x3d\141\x2e\162\x75\141\x6e\147\x5f\151\x64", "\x6c\145\x66\164")->join("\x63\142\x74\137\x73\145\x73\151\x20\163", "\x73\56\x69\144\x5f\163\x65\163\x69\75\x61\56\x73\145\x73\151\x5f\151\x64", "\x6c\145\x66\164")->where("\x6b\163\x2e\151\x64\137\x73\151\x73\167\x61", $_0x1dfa)->orderBy("\x6b\163\x2e\151\x64\137\x6b\145\x6c\141\x73\137\x73\151\x73\167\x61", "\x44\105\x53\103")->get()->getRow();
 }
 goto L_b5b72;
 L_ee763:
 $_0x16ba["\x6a\141\x64\167\x61\154\x5f\142\x65\146\x6f\162\x65"] = $_0x62dc;
 goto L_42f8c;
 L_a3eaa:
 $_0x85e0 = $this->getTpSmt();
 goto L_44ab1;
 L_1474c:
 if ($_0x1dfa <= 0) {
 $_0x4e8a = session()->get("\x69\144\x5f\163\x69\163\x77\141") ?? session()->get("\x69\144\x5f\165\x73\145\x72") ?? session()->get("\x75\163\x65\162\x5f\151\x64");
 $_0x1dfa = (int) ($_0x4e8a ?? 0);
 }
 goto L_773e4;
 L_169f9:
 $_0x16ba["\x74\157\x64\141\x79"] = date("\x59\55\x6d\55\x64\40\x48\72\x69\72\x73");
 goto L_44353;
 L_7dbdc:
 if ($_0x86d9->sesisiswa) {
 $_0xdacc = $_0x1d94->table("\x63\142\x74\137\x62\141\x6e\153\x5f\163\x6f\141\x6c\40\x62")->select("\x62\56\x62\141\x6e\153\x5f\153\x6f\144\x65\54\x62\56\x62\141\x6e\153\x5f\153\x65\154\x61\163\x2c\142\x2e\142\x61\156\x6b\137\x6c\145\x76\145\x6c\54\x62\56\x6f\160\x73\151\x2c\142\x2e\152\x6d\154\x5f\163\x6f\141\x6c\54\x62\56\x74\141\x6d\160\x69\154\x5f\160\x67\54\x62\56\x62\157\x62\157\x74\137\x70\147\x2c\142\x2e\152\x6d\154\x5f\153\x6f\155\x70\154\x65\153\x73\54\x62\56\x74\141\x6d\160\x69\154\x5f\153\x6f\155\x70\154\x65\153\x73\54\x62\56\x62\157\x62\157\x74\137\x6b\157\x6d\160\x6c\145\x6b\163\x2c\142\x2e\152\x6d\154\x5f\152\x6f\144\x6f\150\x6b\141\x6e\54\x62\56\x74\141\x6d\160\x69\154\x5f\152\x6f\144\x6f\150\x6b\141\x6e\54\x62\56\x62\157\x62\157\x74\137\x6a\157\x64\157\x68\153\x61\156\x2c\142\x2e\152\x6d\154\x5f\151\x73\151\x61\156\x2c\142\x2e\164\x61\155\x70\151\x6c\137\x69\163\x69\141\x6e\54\x62\56\x62\157\x62\157\x74\137\x69\163\x69\141\x6e\54\x62\56\x6a\155\x6c\137\x65\163\x61\151\x2c\142\x2e\164\x61\155\x70\151\x6c\137\x65\163\x61\151\x2c\142\x2e\142\x6f\142\x6f\164\x5f\145\x73\141\x69\54\x62\56\x69\144\x5f\164\x70\54\x62\56\x69\144\x5f\163\x6d\164\x2c\142\x2e\163\x6f\141\x6c\137\x61\147\x61\155\x61\54\x20\152\x2e\52\x2c\40\x6a\156\x73\56\x6e\141\x6d\141\x5f\152\x65\156\x69\163\x2c\40\x6a\156\x73\56\x6b\157\x64\145\x5f\152\x65\156\x69\163\x2c\40\x67\56\x69\144\x5f\147\x75\162\x75\54\x67\56\x6b\157\x64\145\x5f\147\x75\162\x75\54\x67\56\x6e\141\x6d\141\x5f\147\x75\162\x75\54\x20\155\x2e\151\x64\137\x6d\141\x70\145\x6c\54\x6d\56\x6b\157\x64\145\x2c\155\x2e\156\x61\155\x61\137\x6d\141\x70\145\x6c")->join("\x63\142\x74\137\x6a\141\x64\167\x61\154\x20\152", "\x6a\56\x69\144\x5f\142\x61\156\x6b\75\x62\56\x69\144\x5f\142\x61\156\x6b\40\x41\116\x44\40\x6a\56\x73\164\x61\164\x75\163\x3d\42\x31\42", "\x69\156\x6e\145\x72")->join("\x63\142\x74\137\x6a\145\x6e\151\x73\40\x6a\156\x73", "\x6a\156\x73\56\x69\144\x5f\152\x65\156\x69\163\x3d\152\x2e\151\x64\137\x6a\145\x6e\151\x73", "\x6c\145\x66\164")->join("\x6d\141\x73\164\x65\162\x5f\147\x75\162\x75\40\x67", "\x67\56\x69\144\x5f\147\x75\162\x75\75\x62\56\x62\141\x6e\153\x5f\147\x75\162\x75\137\x69\144", "\x6c\145\x66\164")->join("\x6d\141\x73\164\x65\162\x5f\155\x61\160\x65\154\x20\155", "\x6d\56\x69\144\x5f\155\x61\160\x65\154\x3d\142\x2e\142\x61\156\x6b\137\x6d\141\x70\145\x6c\137\x69\144", "\x6c\145\x66\164")->where("\x62\56\x73\164\x61\164\x75\163", "\x31");
 $_0xdacc->groupStart()->where("\x6a\56\x69\144\x5f\164\x70", $_0x696a->id_tp)->orWhere("\x62\56\x69\144\x5f\164\x70", $_0x696a->id_tp)->groupEnd();
 $_0xdacc->groupStart()->where("\x6a\56\x69\144\x5f\163\x6d\164", $_0x76c3->id_smt)->orWhere("\x62\56\x69\144\x5f\163\x6d\164", $_0x76c3->id_smt)->groupEnd();
 $_0xb2d1 = $_0x86d9->sesisiswa->kelas->level_id ?? null;
 if (!empty($_0xb2d1)) {
 $_0xdacc->groupStart()->where("\x62\56\x62\141\x6e\153\x5f\154\x65\166\x65\154", $_0xb2d1)->orWhere("\x62\56\x62\141\x6e\153\x5f\154\x65\166\x65\154", "\x30")->orWhere("\x62\56\x62\141\x6e\153\x5f\154\x65\166\x65\154", '')->orWhere("\x62\56\x62\141\x6e\153\x5f\154\x65\166\x65\154\x20\111\x53\40\x4e\125\x4c\114", null, false)->groupEnd();
 }
 $_0x3b88 = $_0xdacc->get()->getResult();
 $_0x5e9c = strtotime(date("\x59\55\x6d\55\x64"));
 foreach ($_0x3b88 as $_0xc547) {
 $_0x202a = new \stdClass();
 foreach (["\x62\141\x6e\153\x5f\153\x6f\144\x65", "\x62\141\x6e\153\x5f\153\x65\154\x61\163", "\x62\141\x6e\153\x5f\154\x65\166\x65\154", "\x6f\160\x73\151", "\x6a\155\x6c\137\x73\157\x61\154", "\x74\141\x6d\160\x69\154\x5f\160\x67", "\x62\157\x62\157\x74\137\x70\147", "\x6a\155\x6c\137\x6b\157\x6d\160\x6c\145\x6b\163", "\x74\141\x6d\160\x69\154\x5f\153\x6f\155\x70\154\x65\153\x73", "\x62\157\x62\157\x74\137\x6b\157\x6d\160\x6c\145\x6b\163", "\x6a\155\x6c\137\x6a\157\x64\157\x68\153\x61\156", "\x74\141\x6d\160\x69\154\x5f\152\x6f\144\x6f\150\x6b\141\x6e", "\x62\157\x62\157\x74\137\x6a\157\x64\157\x68\153\x61\156", "\x6a\155\x6c\137\x69\163\x69\141\x6e", "\x74\141\x6d\160\x69\154\x5f\151\x73\151\x61\156", "\x62\157\x62\157\x74\137\x69\163\x69\141\x6e", "\x6a\155\x6c\137\x65\163\x61\151", "\x74\141\x6d\160\x69\154\x5f\145\x73\141\x69", "\x62\157\x62\157\x74\137\x65\163\x61\151", "\x69\144\x5f\164\x70", "\x69\144\x5f\163\x6d\164", "\x73\157\x61\154\x5f\141\x67\141\x6d\141"] as $_0x9bc5) {
 $_0x202a->{$_0x9bc5} = $_0xc547->{$_0x9bc5} ?? null;
 }
 $_0x202a->jenis = (object) ["\x69\144\x5f\152\x65\156\x69\163" => $_0xc547->id_jenis, "\x6e\141\x6d\141\x5f\152\x65\156\x69\163" => $_0xc547->nama_jenis, "\x6b\157\x64\145\x5f\152\x65\156\x69\163" => $_0xc547->kode_jenis];
 $_0x202a->guru = (object) ["\x69\144\x5f\147\x75\162\x75" => $_0xc547->id_guru, "\x6b\157\x64\145\x5f\147\x75\162\x75" => $_0xc547->kode_guru, "\x6e\141\x6d\141\x5f\147\x75\162\x75" => $_0xc547->nama_guru];
 $_0x202a->mapel = (object) ["\x69\144\x5f\155\x61\160\x65\154" => $_0xc547->id_mapel, "\x6b\157\x64\145" => $_0xc547->kode, "\x6e\141\x6d\141\x5f\155\x61\160\x65\154" => $_0xc547->nama_mapel];
 if ($_0xc547->id_jadwal) {
 $_0x202a->jadwal = new \stdClass();
 foreach (["\x69\144\x5f\152\x61\144\x77\141\x6c", "\x69\144\x5f\164\x70", "\x69\144\x5f\163\x6d\164", "\x69\144\x5f\142\x61\156\x6b", "\x69\144\x5f\152\x65\156\x69\163", "\x74\147\x6c\137\x6d\165\x6c\141\x69", "\x74\147\x6c\137\x73\145\x6c\145\x73\141\x69", "\x64\165\x72\141\x73\151\x5f\165\x6a\151\x61\156", "\x70\145\x6c\141\x6e\147\x67\141\x72\141\x6e", "\x61\143\x61\153\x5f\163\x6f\141\x6c", "\x61\143\x61\153\x5f\157\x70\163\x69", "\x68\141\x73\151\x6c\137\x74\141\x6d\160\x69\154", "\x74\157\x6b\145\x6e", "\x73\164\x61\164\x75\163", "\x75\154\x61\156\x67", "\x72\145\x73\145\x74\137\x6c\157\x67\151\x6e", "\x72\145\x6b\141\x70", "\x6a\141\x6d\137\x6b\145", "\x6a\141\x72\141\x6b"] as $_0x9bc5) {
 $_0x202a->jadwal->{$_0x9bc5} = $_0xc547->{$_0x9bc5} ?? null;
 }
 $_0x202a->jadwal->jenis = $_0x202a->jenis;
 $_0x2b7b = $_0x1d94->table("\x63\142\x74\137\x70\145\x6e\147\x61\167\x61\163")->where(["\x69\144\x5f\152\x61\144\x77\141\x6c" => $_0xc547->id_jadwal, "\x69\144\x5f\162\x75\141\x6e\147" => $_0x86d9->sesisiswa->ruang_id, "\x69\144\x5f\163\x65\163\x69" => $_0x86d9->sesisiswa->sesi_id])->get()->getRow();
 $_0x202a->jadwal->pengawas = $_0x2b7b;
 $_0x202a->jadwal->jam_ke = $_0x2b7b->jam_ke ?? $_0x202a->jadwal->jam_ke ?? "\x31";
 $_0x1877 = !empty($_0x202a->jadwal->bank_kelas) ? $_0x202a->jadwal->bank_kelas : $_0x202a->bank_kelas;
 $_0xfaac = $this->maybe_unserialize($_0x1877 ?? "\x5b\135");
 $_0xb429 = [];
 if (is_array($_0xfaac)) {
 foreach ($_0xfaac as $_0x9bc5) {
 if (is_object($_0x9bc5)) {
 $_0xb429[] = (string) ($_0x9bc5->kelas_id ?? '');
 } elseif (is_array($_0x9bc5)) {
 $_0xb429[] = (string) ($_0x9bc5["\x6b\145\x6c\141\x73\137\x69\144"] ?? '');
 } else {
 $_0xb429[] = (string) $_0x9bc5;
 }
 }
 }
 $_0xb429 = array_filter($_0xb429);
 $_0x598e = (string) ($_0x86d9->sesisiswa->kelas_id ?? '');
 if (empty($_0xb429) || in_array("\x30", $_0xb429, true) || in_array($_0x598e, $_0xb429, true)) {
 $_0x9e47 = date("\x59\55\x6d\55\x64");
 $_0xf550 = date("\x59\55\x6d\55\x64", strtotime($_0x202a->jadwal->tgl_mulai ?? ''));
 $_0x5e97 = date("\x59\55\x6d\55\x64", strtotime($_0x202a->jadwal->tgl_selesai ?? ''));
 $_0xb78b = empty($_0x202a->soal_agama) || $_0x202a->soal_agama == "\x2d" || $_0x202a->soal_agama == "\x30" || strtolower(trim($_0x202a->soal_agama)) == strtolower(trim($_0x86d9->agama ?? ''));
 if ($_0xb78b) {
 // Ujian yang sedang aktif hari ini atau mendatang masuk ke jadwal_today
 if ($_0x9e47 >= $_0xf550 && $_0x9e47 <= $_0x5e97) {
 $_0xb19b[$_0x202a->jadwal->tgl_mulai][] = $_0x202a;
 } elseif ($_0x9e47 > $_0x5e97) {
 $_0x62dc[$_0x202a->jadwal->tgl_mulai][] = $_0x202a;
 } else {
 // Jadwal belum dimulai (hari ini < tgl_mulai)
 $_0xb19b[$_0x202a->jadwal->tgl_mulai][] = $_0x202a;
 }
 }
 }
 $_0x7bf4[] = $_0x202a;
 }
 }
 }
 goto L_9a42f;
 L_9a42f:
 $_0x16ba["\x62\141\x6e\153"] = $_0x7bf4;
 goto L_4c116;
 L_e0b6d:
 // Fallback 1d: Jika masih belum terisi, cek cbt_sesi_siswa berdasarkan kelas_id
 if ((empty($_0x70c0->ruang_id) || empty($_0x70c0->sesi_id)) && !empty($_0x70c0->kelas_id)) {
 $_0x99fe = $_0x1d94->table("\x63\142\x74\137\x73\145\x73\151\x5f\163\x69\163\x77\141\x20\141")->select("\x61\56\x72\165\x61\156\x67\137\x69\144\x2c\40\x61\56\x73\145\x73\151\x5f\151\x64\54\x20\162\x2e\153\x6f\144\x65\137\x72\165\x61\156\x67\54\x20\162\x2e\156\x61\155\x61\137\x72\165\x61\156\x67\54\x20\163\x2e\153\x6f\144\x65\137\x73\145\x73\151\x2c\40\x73\56\x6e\141\x6d\141\x5f\163\x65\163\x69\54\x20\163\x2e\167\x61\153\x74\165\x5f\155\x75\154\x61\151\x2c\40\x73\56\x77\141\x6b\164\x75\137\x61\153\x68\151\x72")->join("\x63\142\x74\137\x72\165\x61\156\x67\40\x72", "\x72\56\x69\144\x5f\162\x75\141\x6e\147\x3d\141\x2e\162\x75\141\x6e\147\x5f\151\x64", "\x6c\145\x66\164")->join("\x63\142\x74\137\x73\145\x73\151\x20\163", "\x73\56\x69\144\x5f\163\x65\163\x69\75\x61\56\x73\145\x73\151\x5f\151\x64", "\x6c\145\x66\164")->where("\x61\56\x6b\145\x6c\141\x73\137\x69\144", $_0x70c0->kelas_id)->orderBy("\x61\56\x69\144\x5f\163\x65\163\x69\137\x73\151\x73\167\x61", "\x44\105\x53\103")->get()->getRow();
 if ($_0x99fe) {
 if (empty($_0x70c0->ruang_id)) {
 $_0x70c0->ruang_id = $_0x99fe->ruang_id;
 $_0x70c0->kode_ruang = $_0x99fe->kode_ruang;
 $_0x70c0->nama_ruang = $_0x99fe->nama_ruang;
 }
 if (empty($_0x70c0->sesi_id)) {
 $_0x70c0->sesi_id = $_0x99fe->sesi_id;
 $_0x70c0->kode_sesi = $_0x99fe->kode_sesi;
 $_0x70c0->nama_sesi = $_0x99fe->nama_sesi;
 $_0x70c0->waktu_mulai = $_0x99fe->waktu_mulai;
 $_0x70c0->waktu_akhir = $_0x99fe->waktu_akhir;
 }
 }
 }
 goto L_18b38;
 L_e53e6:
 if (!$_0x86d9) {
 $_0x225d = trim((string) session()->get("\x75\163\x65\162\x6e\141\x6d\145"));
 $_0x86d9 = $_0x1d94->table("\x6d\141\x73\164\x65\162\x5f\163\x69\163\x77\141")->select("\x69\144\x5f\163\x69\163\x77\141\x2c\156\x61\155\x61\54\x6e\151\x73\54\x6e\151\x73\156\x2c\141\x67\141\x6d\141\x2c\146\x6f\164\x6f")->groupStart()->where("\x75\163\x65\162\x6e\141\x6d\145", $_0x225d)->orWhere("\x6e\151\x73", $_0x225d)->orWhere("\x6e\151\x73\156", $_0x225d)->groupEnd()->get()->getRow();
 }
 goto L_ccd8c;
 L_ba6c0:
 $_0x7bf4 = [];
 goto L_7dbdc;
 L_1bcd4:
 $_0x1dfa = (int) ($this->request->getGet("\x69\144\x5f\163\x69\163\x77\141") ?? 0);
 goto L_1474c;
 L_da729:
 if (empty($_0x70c0->waktu_akhir)) {
 $_0x70c0->waktu_akhir = "\x32\63\x3a\65\x39\72\x30\60";
 }
 goto L_d1876;
 L_773e4:
 $_0x1d94 = \Config\Database::connect();
 goto L_a3eaa;
 L_2e310:
 $_0xb19b = [];
 goto L_02589;
 L_28d6e:
 $_0x86d9->sesisiswa->ruang_id = $_0x70c0->ruang_id;
 goto L_e0a0b;
 L_1772e:
 $_0x76c3 = $_0x85e0->smt_active;
 goto L_7e39a;
 L_4c116:
 $_0x16ba["\x6a\141\x64\167\x61\154\x5f\164\x6f\144\x61\171"] = $_0xb19b;
 goto L_ee763;
 L_ce037:
 $_0x86d9->sesisiswa->kelas = (object) ["\x6b\157\x64\145\x5f\153\x65\154\x61\163" => $_0x70c0->kode_kelas, "\x6e\141\x6d\141\x5f\153\x65\154\x61\163" => $_0x70c0->nama_kelas, "\x6c\145\x76\145\x6c\137\x69\144" => $_0x70c0->level_id];
 goto L_94f48;
 L_b5b72:
 // Fallback 1b: Jika tidak ada di kelas_siswa, buat objek default dari master_kelas
 if (!$_0x70c0) {
 $_0x45a1 = $_0x1d94->table("\x6d\141\x73\164\x65\162\x5f\153\x65\154\x61\163")->orderBy("\x69\144\x5f\153\x65\154\x61\163", "\x41\123\x43")->get()->getRow();
 $_0x70c0 = new \stdClass();
 $_0x70c0->siswa_id = $_0x1dfa;
 $_0x70c0->kelas_id = $_0x45a1->id_kelas ?? null;
 $_0x70c0->kode_kelas = $_0x45a1->kode_kelas ?? "\x2d";
 $_0x70c0->nama_kelas = $_0x45a1->nama_kelas ?? "\x2d";
 $_0x70c0->level_id = $_0x45a1->level_id ?? null;
 $_0x70c0->ruang_id = null;
 $_0x70c0->sesi_id = null;
 $_0x70c0->nomor_peserta = null;
 }
 goto L_5febb;
 L_94f48:
 $_0x86d9->sesisiswa->ruang = (object) ["\x6b\157\x64\145\x5f\162\x75\141\x6e\147" => $_0x70c0->kode_ruang ?? "\x52\61", "\x6e\141\x6d\141\x5f\162\x75\141\x6e\147" => $_0x70c0->nama_ruang];
 goto L_5699e;
 L_ccd8c:
 if (!$_0x86d9) {
 return $this->response->setJSON($_0x16ba);
 }
 goto L_8ef54;
 L_44353:
 return $this->response->setJSON($_0x16ba);
 L_bca77:
 $_0x16ba["\x74\160\x5f\141\x63\164\x69\166\x65"] = $_0x696a;
 goto L_9d239;
 L_42f8c:
 $_0x16ba["\x73\151\x73\167\x61"] = $_0x86d9;
 goto L_169f9;
 L_e0a0b:
 $_0x86d9->sesisiswa->sesi_id = $_0x70c0->sesi_id;
 goto L_44d1c;
 L_5699e:
 $_0x86d9->sesisiswa->sesi = (object) ["\x6b\157\x64\145\x5f\163\x65\163\x69" => $_0x70c0->kode_sesi ?? "\x53\61", "\x6e\141\x6d\141\x5f\163\x65\163\x69" => $_0x70c0->nama_sesi, "\x77\141\x6b\164\x75\137\x6d\165\x6c\141\x69" => $_0x70c0->waktu_mulai, "\x77\141\x6b\164\x75\137\x61\153\x68\151\x72" => $_0x70c0->waktu_akhir];
 goto L_e2f3a;
 L_1150d:
 // Fallback 1f: Sesi default dari master cbt_sesi
 if (empty($_0x70c0->sesi_id)) {
 $_0x924f = $_0x1d94->table("\x63\142\x74\137\x73\145\x73\151")->orderBy("\x69\144\x5f\163\x65\163\x69", "\x41\123\x43")->get()->getRow();
 if ($_0x924f) {
 $_0x70c0->sesi_id = $_0x924f->id_sesi;
 $_0x70c0->kode_sesi = $_0x924f->kode_sesi;
 $_0x70c0->nama_sesi = $_0x924f->nama_sesi;
 $_0x70c0->waktu_mulai = $_0x924f->waktu_mulai;
 $_0x70c0->waktu_akhir = $_0x924f->waktu_akhir;
 }
 }
 goto L_d70b6;
 L_110b3:
 if ($_0x1dfa > 0) {
 $_0x86d9 = $_0x1d94->table("\x6d\141\x73\164\x65\162\x5f\163\x69\163\x77\141")->select("\x69\144\x5f\163\x69\163\x77\141\x2c\156\x61\155\x61\54\x6e\151\x73\54\x6e\151\x73\156\x2c\141\x67\141\x6d\141\x2c\146\x6f\164\x6f")->where("\x69\144\x5f\163\x69\163\x77\141", $_0x1dfa)->get()->getRow();
 }
 goto L_e53e6;
 L_7e39a:
 $_0x16ba["\x74\160"] = $_0x85e0->tp;
 goto L_c9aff;
 L_18b38:
 // Fallback 1e: Ruang default dari master cbt_ruang
 if (empty($_0x70c0->ruang_id)) {
 $_0x4e30 = $_0x1d94->table("\x63\142\x74\137\x72\165\x61\156\x67")->orderBy("\x69\144\x5f\162\x75\141\x6e\147", "\x41\123\x43")->get()->getRow();
 if ($_0x4e30) {
 $_0x70c0->ruang_id = $_0x4e30->id_ruang;
 $_0x70c0->kode_ruang = $_0x4e30->kode_ruang;
 $_0x70c0->nama_ruang = $_0x4e30->nama_ruang;
 }
 }
 goto L_1150d;
 L_77f38:
 $_0x86d9->sesisiswa = new \stdClass();
 goto L_e91eb;
 L_02589:
 $_0x62dc = [];
 goto L_ba6c0;
 L_f3ef8:
 if ($_0x4571 = $this->requireLogin()) {
 return $_0x4571;
 }
 goto L_1bcd4;
 L_5febb:
 // Fallback 1c: Jika ruang_id atau sesi_id belum terisi, cek cbt_sesi_siswa langsung berdasarkan id_siswa
 if (empty($_0x70c0->ruang_id) || empty($_0x70c0->sesi_id)) {
 $_0x5846 = $_0x1d94->table("\x63\142\x74\137\x73\145\x73\151\x5f\163\x69\163\x77\141\x20\141")->select("\x61\56\x72\165\x61\156\x67\137\x69\144\x2c\40\x61\56\x73\145\x73\151\x5f\151\x64\54\x20\162\x2e\153\x6f\144\x65\137\x72\165\x61\156\x67\54\x20\162\x2e\156\x61\155\x61\137\x72\165\x61\156\x67\54\x20\163\x2e\153\x6f\144\x65\137\x73\145\x73\151\x2c\40\x73\56\x6e\141\x6d\141\x5f\163\x65\163\x69\54\x20\163\x2e\167\x61\153\x74\165\x5f\155\x75\154\x61\151\x2c\40\x73\56\x77\141\x6b\164\x75\137\x61\153\x68\151\x72")->join("\x63\142\x74\137\x72\165\x61\156\x67\40\x72", "\x72\56\x69\144\x5f\162\x75\141\x6e\147\x3d\141\x2e\162\x75\141\x6e\147\x5f\151\x64", "\x6c\145\x66\164")->join("\x63\142\x74\137\x73\145\x73\151\x20\163", "\x73\56\x69\144\x5f\163\x65\163\x69\75\x61\56\x73\145\x73\151\x5f\151\x64", "\x6c\145\x66\164")->where("\x61\56\x73\151\x73\167\x61\137\x69\144", $_0x1dfa)->orderBy("\x61\56\x69\144\x5f\163\x65\163\x69\137\x73\151\x73\167\x61", "\x44\105\x53\103")->get()->getRow();
 if ($_0x5846) {
 if (empty($_0x70c0->ruang_id)) {
 $_0x70c0->ruang_id = $_0x5846->ruang_id;
 $_0x70c0->kode_ruang = $_0x5846->kode_ruang;
 $_0x70c0->nama_ruang = $_0x5846->nama_ruang;
 }
 if (empty($_0x70c0->sesi_id)) {
 $_0x70c0->sesi_id = $_0x5846->sesi_id;
 $_0x70c0->kode_sesi = $_0x5846->kode_sesi;
 $_0x70c0->nama_sesi = $_0x5846->nama_sesi;
 $_0x70c0->waktu_mulai = $_0x5846->waktu_mulai;
 $_0x70c0->waktu_akhir = $_0x5846->waktu_akhir;
 }
 }
 }
 goto L_e0b6d;
 L_e2f3a:
 $_0x8285 = $_0x1d94->table("\x63\142\x74\137\x73\151\x73\167\x61")->select("\x69\144\x5f\143\x62\164\x5f\163\x69\163\x77\141\x2c\151\x64\137\x62\141\x6e\153\x2c\151\x64\137\x6a\141\x64\167\x61\154\x2c\163\x74\141\x74\165\x73\54\x6c\141\x6d\141\x5f\165\x6a\151\x61\156\x2c\155\x75\154\x61\151\x2c\163\x65\154\x65\163\x61\151\x2c\162\x65\163\x65\164\x5f\167\x61\153\x74\165\x2c\162\x65\163\x65\164\x5f\151\x7a\151\x6e\54\x6e\151\x6c\141\x69\137\x69\156\x70\165\x74")->where("\x69\144\x5f\163\x69\163\x77\141", $_0x1dfa)->get()->getResult();
 goto L_58eea;
 L_44d1c:
 $_0x86d9->sesisiswa->peserta = (object) ["\x6e\157\x6d\157\x72\137\x70\145\x73\145\x72\164\x61" => $_0x70c0->nomor_peserta];
 goto L_ce037;
 L_d70b6:
 // Fallback 1g: Nomor peserta (jika belum di-generate di cbt_nomor_peserta, gunakan NIS / NISN / Username)
 if (empty($_0x70c0->nomor_peserta)) {
 $_0xa970 = $_0x1d94->table("\x63\142\x74\137\x6e\157\x6d\157\x72\137\x70\145\x73\145\x72\164\x61")->where("\x69\144\x5f\163\x69\163\x77\141", $_0x1dfa)->orderBy("\x69\144\x5f\156\x6f\155\x6f\162", "\x44\105\x53\103")->get()->getRow();
 $_0x70c0->nomor_peserta = $_0xa970->nomor_peserta ?? ($_0x86d9->nis ?: ($_0x86d9->nisn ?: $_0x86d9->username ?? "\x50\105\x53\105\x52\124\x41\55" . $_0x1dfa));
 }
 goto L_12f9d;
 }
 /**
 * Helper untuk mengambil data jadwal detail secara terstruktur
 */
 private function getJadwalDetailed($_0x6681, $_0x499d = null, $_0x4c40 = null)
 {
 goto L_c0596;
 L_15b9c:
 if (is_string($_0xd825)) {
 $_0xd825 = json_decode($_0xd825, true) ?? [];
 }
 goto L_a76d7;
 L_a76d7:
 $_0x5eac = [];
 goto L_b09ab;
 L_14815:
 $_0xb361 = (object) ["\x69\144\x5f\152\x61\144\x77\141\x6c" => $_0xf2f0->id_jadwal, "\x69\144\x5f\164\x70" => $_0xf2f0->id_tp, "\x69\144\x5f\163\x6d\164" => $_0xf2f0->id_smt, "\x69\144\x5f\142\x61\156\x6b" => $_0xf2f0->id_bank, "\x69\144\x5f\152\x65\156\x69\163" => $_0xf2f0->id_jenis, "\x74\147\x6c\137\x6d\165\x6c\141\x69" => $_0xf2f0->tgl_mulai, "\x74\147\x6c\137\x73\145\x6c\145\x73\141\x69" => $_0xf2f0->tgl_selesai, "\x64\165\x72\141\x73\151\x5f\165\x6a\151\x61\156" => $_0xf2f0->durasi_ujian, "\x70\145\x6c\141\x6e\147\x67\141\x72\141\x6e" => $_0xf2f0->pelanggaran, "\x61\143\x61\153\x5f\163\x6f\141\x6c" => $_0xf2f0->acak_soal, "\x61\143\x61\153\x5f\157\x70\163\x69" => $_0xf2f0->acak_opsi, "\x68\141\x73\151\x6c\137\x74\141\x6d\160\x69\154" => $_0xf2f0->hasil_tampil, "\x74\157\x6b\145\x6e" => $_0xf2f0->token, "\x73\164\x61\164\x75\163" => $_0xf2f0->status, "\x75\154\x61\156\x67" => $_0xf2f0->ulang, "\x72\145\x73\145\x74\137\x6c\157\x67\151\x6e" => $_0xf2f0->reset_login, "\x72\145\x6b\141\x70" => $_0xf2f0->rekap, "\x6c\157\x63\153\x5f\142\x72\157\x77\163\x65\162" => (int) ($_0xf2f0->lock_browser ?? 0), "\x6b\141\x6d\145\x72\141" => (int) ($_0xf2f0->kamera ?? 0), "\x6a\141\x6d\137\x6b\145" => $_0xf2f0->jam_ke ?? "\x31", "\x6a\141\x72\141\x6b" => $_0xf2f0->jarak ?? "\x30", "\x6a\145\x6e\151\x73" => (object) ["\x69\144\x5f\152\x65\156\x69\163" => $_0xf2f0->id_jenis, "\x6e\141\x6d\141\x5f\152\x65\156\x69\163" => $_0xf2f0->nama_jenis, "\x6b\157\x64\145\x5f\152\x65\156\x69\163" => $_0xf2f0->kode_jenis], "\x74\160" => (object) ["\x69\144\x5f\164\x70" => $_0xf2f0->id_tp, "\x74\141\x68\165\x6e" => $_0xf2f0->tahun], "\x73\155\x74" => (object) ["\x69\144\x5f\163\x6d\164" => $_0xf2f0->id_smt, "\x73\155\x74" => $_0xf2f0->smt], "\x62\141\x6e\153" => (object) ["\x69\144\x5f\142\x61\156\x6b" => $_0xf2f0->id_bank, "\x62\141\x6e\153\x5f\153\x6f\144\x65" => $_0xf2f0->bank_kode, "\x62\141\x6e\153\x5f\153\x65\154\x61\163" => $_0x5eac, "\x6f\160\x73\151" => $_0xf2f0->opsi, "\x6a\155\x6c\137\x73\157\x61\154" => $_0xf2f0->jml_soal, "\x74\141\x6d\160\x69\154\x5f\160\x67" => $_0xf2f0->tampil_pg, "\x62\157\x62\157\x74\137\x70\147" => $_0xf2f0->bobot_pg, "\x74\141\x6d\160\x69\154\x5f\153\x6f\155\x70\154\x65\153\x73" => $_0xf2f0->tampil_kompleks, "\x62\157\x62\157\x74\137\x6b\157\x6d\160\x6c\145\x6b\163" => $_0xf2f0->bobot_kompleks, "\x74\141\x6d\160\x69\154\x5f\152\x6f\144\x6f\150\x6b\141\x6e" => $_0xf2f0->tampil_jodohkan, "\x62\157\x62\157\x74\137\x6a\157\x64\157\x68\153\x61\156" => $_0xf2f0->bobot_jodohkan, "\x74\141\x6d\160\x69\154\x5f\151\x73\151\x61\156" => $_0xf2f0->tampil_isian, "\x62\157\x62\157\x74\137\x69\163\x69\141\x6e" => $_0xf2f0->bobot_isian, "\x74\141\x6d\160\x69\154\x5f\145\x73\141\x69" => $_0xf2f0->tampil_esai, "\x62\157\x62\157\x74\137\x65\163\x61\151" => $_0xf2f0->bobot_esai, "\x73\157\x61\154\x5f\141\x67\141\x6d\141" => $_0xf2f0->soal_agama, "\x6d\141\x70\145\x6c" => (object) ["\x69\144\x5f\155\x61\160\x65\154" => $_0xf2f0->id_mapel, "\x6b\157\x64\145" => $_0xf2f0->kode, "\x6e\141\x6d\141\x5f\155\x61\160\x65\154" => $_0xf2f0->nama_mapel], "\x67\165\x72\165" => (object) ["\x69\144\x5f\147\x75\162\x75" => $_0xf2f0->id_guru, "\x6b\157\x64\145\x5f\147\x75\162\x75" => $_0xf2f0->kode_guru, "\x6e\141\x6d\141\x5f\147\x75\162\x75" => $_0xf2f0->nama_guru]]];
 goto L_7d99a;
 L_58297:
 $_0xd825 = $this->maybe_unserialize($_0xf2f0->bank_kelas ?? "\x5b\135");
 goto L_15b9c;
 L_7d99a:
 // Attach soal list
 $_0x1b55 = $_0x80d6->table("\x63\142\x74\137\x73\157\x61\154")->where(["\x62\141\x6e\153\x5f\151\x64" => $_0xf2f0->id_bank, "\x74\141\x6d\160\x69\154\x6b\141\x6e" => "\x31"])->get()->getResult();
 goto L_e8dc4;
 L_b5ad8:
 $_0xf2f0 = $_0x80d6->table("\x63\142\x74\137\x6a\141\x64\167\x61\154\x20\141")->select("\x61\56\x2a\54\x20\142\x2e\151\x64\137\x62\141\x6e\153\x2c\40\x62\56\x62\141\x6e\153\x5f\153\x6f\144\x65\54\x20\142\x2e\142\x61\156\x6b\137\x6c\145\x76\145\x6c\54\x20\142\x2e\142\x61\156\x6b\137\x6b\145\x6c\141\x73\54\x20\142\x2e\157\x70\163\x69\54\x20\142\x2e\152\x6d\154\x5f\163\x6f\141\x6c\54\x20\142\x2e\164\x61\155\x70\151\x6c\137\x70\147\x2c\40\x62\56\x62\157\x62\157\x74\137\x70\147\x2c\40\x62\56\x6a\155\x6c\137\x6b\157\x6d\160\x6c\145\x6b\163\x2c\40\x62\56\x74\141\x6d\160\x69\154\x5f\153\x6f\155\x70\154\x65\153\x73\54\x20\142\x2e\142\x6f\142\x6f\164\x5f\153\x6f\155\x70\154\x65\153\x73\54\x20\142\x2e\152\x6d\154\x5f\152\x6f\144\x6f\150\x6b\141\x6e\54\x20\142\x2e\164\x61\155\x70\151\x6c\137\x6a\157\x64\157\x68\153\x61\156\x2c\40\x62\56\x62\157\x62\157\x74\137\x6a\157\x64\157\x68\153\x61\156\x2c\40\x62\56\x6a\155\x6c\137\x69\163\x69\141\x6e\54\x20\142\x2e\164\x61\155\x70\151\x6c\137\x69\163\x69\141\x6e\54\x20\142\x2e\142\x6f\142\x6f\164\x5f\151\x73\151\x61\156\x2c\40\x62\56\x6a\155\x6c\137\x65\163\x61\151\x2c\40\x62\56\x74\141\x6d\160\x69\154\x5f\145\x73\141\x69\54\x20\142\x2e\142\x6f\142\x6f\164\x5f\145\x73\141\x69\54\x20\142\x2e\151\x64\137\x74\160\x2c\40\x62\56\x69\144\x5f\163\x6d\164\x2c\40\x62\56\x73\157\x61\154\x5f\141\x67\141\x6d\141\x2c\40\x6a\156\x73\56\x6e\141\x6d\141\x5f\152\x65\156\x69\163\x2c\40\x6a\156\x73\56\x6b\157\x64\145\x5f\152\x65\156\x69\163\x2c\40\x67\56\x69\144\x5f\147\x75\162\x75\54\x20\147\x2e\153\x6f\144\x65\137\x67\165\x72\165\x2c\40\x67\56\x6e\141\x6d\141\x5f\147\x75\162\x75\54\x20\155\x2e\151\x64\137\x6d\141\x70\145\x6c\54\x20\155\x2e\153\x6f\144\x65\54\x20\155\x2e\156\x61\155\x61\137\x6d\141\x70\145\x6c\54\x20\164\x70\56\x74\141\x68\165\x6e\54\x20\163\x6d\164\x2e\163\x6d\164")->join("\x63\142\x74\137\x62\141\x6e\153\x5f\163\x6f\141\x6c\40\x62", "\x62\56\x69\144\x5f\142\x61\156\x6b\75\x61\56\x69\144\x5f\142\x61\156\x6b", "\x6c\145\x66\164")->join("\x63\142\x74\137\x6a\145\x6e\151\x73\40\x6a\156\x73", "\x6a\156\x73\56\x69\144\x5f\152\x65\156\x69\163\x3d\141\x2e\151\x64\137\x6a\145\x6e\151\x73", "\x6c\145\x66\164")->join("\x6d\141\x73\164\x65\162\x5f\147\x75\162\x75\40\x67", "\x67\56\x69\144\x5f\147\x75\162\x75\75\x62\56\x62\141\x6e\153\x5f\147\x75\162\x75\137\x69\144", "\x6c\145\x66\164")->join("\x6d\141\x73\164\x65\162\x5f\155\x61\160\x65\154\x20\155", "\x6d\56\x69\144\x5f\155\x61\160\x65\154\x3d\142\x2e\142\x61\156\x6b\137\x6d\141\x70\145\x6c\137\x69\144", "\x6c\145\x66\164")->join("\x6d\141\x73\164\x65\162\x5f\164\x70\40\x74\160", "\x74\160\x2e\151\x64\137\x74\160\x3d\141\x2e\151\x64\137\x74\160", "\x6c\145\x66\164")->join("\x6d\141\x73\164\x65\162\x5f\163\x6d\164\x20\163\x6d\164", "\x73\155\x74\56\x69\144\x5f\163\x6d\164\x3d\141\x2e\151\x64\137\x73\155\x74", "\x6c\145\x66\164")->where("\x61\56\x69\144\x5f\152\x61\144\x77\141\x6c", $_0x6681)->get()->getRow();
 goto L_c704a;
 L_e8dc4:
 $_0xb361->bank->soal = $_0x1b55;
 goto L_651bb;
 L_c704a:
 if (!$_0xf2f0) {
 return null;
 }
 goto L_58297;
 L_b09ab:
 if (is_array($_0xd825)) {
 foreach ($_0xd825 as $_0x1e44) {
 if (is_object($_0x1e44)) {
 $_0x5eac[] = $_0x1e44;
 } elseif (is_array($_0x1e44)) {
 $_0x5eac[] = (object) $_0x1e44;
 } else {
 $_0x5eac[] = (object) ["\x6b\145\x6c\141\x73\137\x69\144" => $_0x1e44];
 }
 }
 }
 goto L_14815;
 L_651bb:
 return $_0xb361;
 L_c0596:
 $_0x80d6 = \Config\Database::connect();
 goto L_b5ad8;
 }
 public function konfirmasi($_0x7f9a)
 {
 goto L_2305c;
 L_0722d:
 if ($_0x57ea && $_0x341e) {
 $_0xe7e9["\x6b\145\x6c\141\x73"] = $this->cbt->getKelas($_0x898d->id_tp, $_0xdefd->id_smt);
 $_0xc9a4 = $this->cbt->getDataGuru();
 $_0x672d = $this->cbt->getSiswaCbtInfo($_0xd7ee->id_siswa, $_0x898d->id_tp, $_0xdefd->id_smt);
 $_0xe8ff = null;
 if ($_0x672d) {
 $_0xe8ff = $this->cbt->getPengawas($_0x898d->id_tp . $_0xdefd->id_smt . $_0x7f9a . $_0x672d->id_ruang . $_0x672d->id_sesi);
 }
 $_0xbc0a = [];
 if ($_0xe8ff != null && !empty($_0xe8ff->id_guru)) {
 $_0xbc0a = $this->master->getGuruByArrId(explode("\x2c", $_0xe8ff->id_guru));
 }
 $_0xe7e9["\x6a\141\x64\167\x61\154"] = $_0x341e;
 $_0xe7e9["\x67\165\x72\165"] = $_0xc9a4;
 $_0xe7e9["\x70\145\x6e\147\x61\167\x61\163"] = $_0xbc0a;
 }
 goto L_ff229;
 L_217fc:
 $_0xe7e9 = ["\x75\163\x65\162" => $_0x8d50, "\x73\151\x73\167\x61" => $_0xd7ee, "\x6a\165\x64\165\x6c" => "\x50\145\x6e\151\x6c\141\x69\141\x6e", "\x73\145\x74\164\x69\156\x67" => $this->dashboard->getSetting()];
 goto L_dedf9;
 L_6c2d6:
 $_0xe7e9["\x73\155\x74\137\x61\143\x74\151\x76\145"] = $_0xdefd;
 goto L_ebd51;
 L_eea3f:
 $_0x4588 = $_0xe411["\x61\147\x65\156\x74"];
 goto L_e14dd;
 L_4d1ea:
 $_0x341e = $this->getJadwalDetailed($_0x7f9a, $_0x898d->id_tp, $_0xdefd->id_smt);
 goto L_3e9f6;
 L_ebd51:
 $_0xe411 = $this->isDeviceSupported();
 goto L_f39dd;
 L_5922a:
 $_0x57ea = true;
 goto L_120c8;
 L_5504d:
 if ($_0x341e && isset($_0x341e->reset_login) && $_0x341e->reset_login == "\x31") {
 $_0xc07f = $_0xcc51->table("\x63\142\x74\137\x73\151\x73\167\x61")->select("\x69\144\x5f\142\x61\156\x6b\54\x69\144\x5f\143\x62\164\x5f\163\x69\163\x77\141\x2c\151\x64\137\x6a\141\x64\167\x61\154\x2c\151\x64\137\x73\151\x73\167\x61\54\x6a\141\x77\141\x62\141\x6e\54\x6c\141\x6d\141\x5f\165\x6a\151\x61\156\x2c\155\x75\154\x61\151\x2c\163\x65\154\x65\163\x61\151\x2c\163\x74\141\x74\165\x73\54\x72\145\x73\145\x74\137\x69\172\x69\156")->where(["\x69\144\x5f\152\x61\144\x77\141\x6c" => $_0x7f9a, "\x69\144\x5f\163\x69\163\x77\141" => $_0x9b4e])->get()->getRow();
 if ($_0xc07f) {
 $_0x139a = $_0xcc51->table("\x6c\157\x67\137\x75\152\x69\141\x6e")->where(["\x69\144\x5f\152\x61\144\x77\141\x6c" => $_0x7f9a, "\x69\144\x5f\163\x69\163\x77\141" => $_0x9b4e, "\x6c\157\x67\137\x74\171\x70\145" => "\x31"])->orderBy("\x69\144\x5f\154\x6f\147", "\x44\105\x53\103")->get()->getRow();
 $_0xc07f->log = $_0x139a;
 if (isset($_0xc07f->log) && $_0xc07f->log) {
 if ($_0xc07f->reset_izin == 1 || $_0xc07f->reset_izin == "\x31") {
 $_0xcc51->table("\x6c\157\x67\137\x75\152\x69\141\x6e")->set("\x61\144\x64\162\x65\163\x73", $_0x69fc)->set("\x61\147\x65\156\x74", $_0x4588)->set("\x64\145\x76\151\x63\145", $_0x722a)->where("\x69\144\x5f\154\x6f\147", $_0xc07f->log->id_log)->update();
 $_0xcc51->table("\x63\142\x74\137\x73\151\x73\167\x61")->set("\x72\145\x73\145\x74\137\x69\172\x69\156", "\x30")->where("\x69\144\x5f\143\x62\164\x5f\163\x69\163\x77\141", $_0xc07f->id_cbt_siswa)->update();
 $_0xc07f->log->address = $_0x69fc;
 $_0xc07f->log->agent = $_0x4588;
 $_0xc07f->log->device = $_0x722a;
 $_0x57ea = true;
 } else {
 $_0x57ea = $_0xc07f->log->address == $_0x69fc && $_0xc07f->log->agent == $_0x4588 && $_0xc07f->log->device == $_0x722a;
 }
 }
 }
 }
 goto L_88589;
 L_b760f:
 $_0xe7e9["\x65\170\x61\155\x62\162\x6f\137\x63\150\x65\143\x6b"] = $this->checkExambroLock($_0x341e);
 goto L_9d1d1;
 L_ed0c5:
 $_0x8d50 = (object) session()->get();
 goto L_323b5;
 L_9d1d1:
 return view("\x6d\145\x6d\142\x65\162\x73\57\x73\151\x73\167\x61\57\x63\142\x74\57\x6b\157\x6e\146\x69\162\x6d\141\x73\151", $_0xe7e9);
 L_4e9e6:
 $this->dashboard = new \App\Models\DashboardModel();
 goto L_a9000;
 L_3e9f6:
 $_0x69fc = $_0xe411["\x61\144\x64\162\x65\163\x73"];
 goto L_eea3f;
 L_f39dd:
 $_0xe7e9["\x73\165\x70\160\x6f\162\x74"] = $_0xe411["\x73\164\x61\164\x75\163"];
 goto L_4d1ea;
 L_2305c:
 if ($_0x1732 = $this->requireLogin()) {
 return $_0x1732;
 }
 goto L_f8a19;
 L_dedf9:
 $_0x1647 = $this->getTpSmt();
 goto L_f92a5;
 L_90bb5:
 $_0x9b4e = $_0xd7ee ? $_0xd7ee->id_siswa : 0;
 goto L_217fc;
 L_4b1f2:
 $_0xdefd = $_0x1647->smt_active;
 goto L_2daed;
 L_82377:
 $_0xe7e9["\x73\155\x74"] = $_0x1647->smt;
 goto L_aaa7d;
 L_323b5:
 $_0xd7ee = $this->resolveSiswa($_0x8d50->username ?? session()->get("\x75\163\x65\162\x6e\141\x6d\145"), $_0x898d->id_tp ?? 0, $_0xdefd->id_smt ?? 0);
 goto L_90bb5;
 L_f92a5:
 $_0x898d = $_0x1647->tp_active;
 goto L_4b1f2;
 L_e14dd:
 $_0x722a = $_0xe411["\x64\145\x76\151\x63\145"];
 goto L_5922a;
 L_88589:
 $_0xb610 .= $_0x57ea ? '' : "\x3c\154\x69\76\x41\156\x64\141\x20\150\x61\162\x75\163\x20\155\x65\155\x69\156\x74\141\x20\162\x65\163\x65\164\x20\151\x7a\151\x6e\40\x6b\145\x20\160\x65\156\x67\141\x77\141\x73\41\x3c\57\x6c\151\x3e";
 goto L_b48ad;
 L_2daed:
 $_0xe7e9["\x74\160"] = $_0x1647->tp;
 goto L_82377;
 L_eb091:
 $this->master = new \App\Models\MasterModel();
 goto L_4e9e6;
 L_ff229:
 $_0xe7e9["\x65\162\x72\157\x72"] = "\x3c\165\x6c\76" . $_0xb610 . "\x3c\57\x75\154\x3e";
 goto L_b760f;
 L_a9000:
 $this->cbt = new \App\Models\CbtModel();
 goto L_314f7;
 L_aaa7d:
 $_0xe7e9["\x74\160\x5f\141\x63\164\x69\166\x65"] = $_0x898d;
 goto L_6c2d6;
 L_120c8:
 $_0xb610 = '';
 goto L_5504d;
 L_f8a19:
 $_0xcc51 = \Config\Database::connect();
 goto L_eb091;
 L_b48ad:
 $_0xe7e9["\x76\141\x6c\151\x64"] = $_0x57ea;
 goto L_0722d;
 L_49388:
 $_0xdefd = $this->dashboard->getSemesterActive();
 goto L_ed0c5;
 L_314f7:
 $_0x898d = $this->dashboard->getTahunActive();
 goto L_49388;
 }
 public function validasi_siswa()
 {
 goto L_26804;
 L_6c4ed:
 if (!$_0xffb0["\x61\154\x6c\157\x77\145\x64"]) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x74\157\x6b\145\x6e" => false, "\x74\157\x6b\145\x6e\137\x76\141\x6c\151\x64" => false, "\x65\170\x61\155\x62\162\x6f\137\x62\154\x6f\143\x6b\145\x64" => true, "\x74\151\x74\154\x65" => "\x41\153\x73\145\x73\40\x55\152\x69\141\x6e\40\x44\151\x6b\165\x6e\143\x69", "\x6d\145\x73\163\x61\147\x65" => $_0xffb0["\x70\145\x73\141\x6e\137\x62\154\x6f\153\x69\162"], "\x72\165\x6c\145\x5f\156\x61\155\x65" => $_0xffb0["\x72\165\x6c\145\x5f\156\x61\155\x65"], "\x6c\151\x6e\153\x5f\141\x6e\144\x72\157\x69\144" => $_0xffb0["\x6c\151\x6e\153\x5f\141\x6e\144\x72\157\x69\144"], "\x6c\151\x6e\153\x5f\160\x63" => $_0xffb0["\x6c\151\x6e\153\x5f\160\x63"]]);
 }
 goto L_cefe1;
 L_491ae:
 return $this->response->setJSON($_0x4bbb);
 L_2a27f:
 $_0xd54a = \Config\Database::connect();
 goto L_94d26;
 L_8151b:
 $_0x4bbb["\x6a\155\x6c\137\x73\157\x61\154"] = [["\x63\157\x75\156\x74\145\x64\137\x72\157\x77\163" => $_0xaedf]];
 goto L_7054e;
 L_26804:
 $_0xd3c8 = $this->request->getPost("\x6a\141\x64\167\x61\154");
 goto L_4676d;
 L_4676d:
 $_0x65ed = $this->request->getPost("\x73\151\x73\167\x61");
 goto L_5467e;
 L_ca8a9:
 $_0x6b31 = $_0x2b42["\x64\145\x76\151\x63\145"];
 goto L_18697;
 L_5fe66:
 $_0xd060 = $this->getJadwalDetailed($_0xd3c8, $_0x1d99->id_tp, $_0x4ae9->id_smt);
 goto L_27d4d;
 L_27d4d:
 if (!$_0xd060) {
 return $this->response->setJSON(["\x74\157\x6b\145\x6e" => false, "\x74\157\x6b\145\x6e\137\x76\141\x6c\151\x64" => false, "\x72\145\x61\163\x6f\156" => "\x6a\141\x64\167\x61\154\x5f\156\x6f\164\x5f\146\x6f\165\x6e\144", "\x74\157\x6b\145\x6e\137\x6d\163\x67" => "\x4a\141\x64\167\x61\154\x20\165\x6a\151\x61\156\x20\164\x69\144\x61\153\x20\144\x69\164\x65\155\x75\153\x61\156", "\x6d\145\x73\163\x61\147\x65" => "\x4a\141\x64\167\x61\154\x20\164\x69\144\x61\153\x20\144\x69\164\x65\155\x75\153\x61\156"]);
 }
 goto L_37dd5;
 L_76c72:
 $_0x296c = $this->getTpSmt();
 goto L_cc554;
 L_cc554:
 $_0x1d99 = $_0x296c->tp_active;
 goto L_9249f;
 L_b621b:
 $_0xa0ed = strtoupper(preg_replace("\x2f\133\x5c\163\x5c\170\x7b\62\x30\60\x42\175\x2d\134\x78\173\x32\60\x30\104\x7d\134\x78\173\x46\105\x46\106\x7d\135\x2b\57\x75", '', $_0x6874));
 goto L_2a27f;
 L_5467e:
 $_0x6874 = (string) ($this->request->getPost("\x74\157\x6b\145\x6e") ?? '');
 goto L_b621b;
 L_6eda4:
 $_0x63b8 = $_0x2b42["\x61\147\x65\156\x74"];
 goto L_ca8a9;
 L_0012f:
 $_0xaedf = isset($_0xd060->bank->soal) ? count($_0xd060->bank->soal) : 0;
 goto L_8151b;
 L_9249f:
 $_0x4ae9 = $_0x296c->smt_active;
 goto L_5fe66;
 L_33192:
 $_0x3fa6 = $_0x2b42["\x61\144\x64\162\x65\163\x73"];
 goto L_6eda4;
 L_18697:
 // Cek Keamanan Browser Exambro
 $_0xffb0 = $this->checkExambroLock($_0xd060);
 goto L_6c4ed;
 L_cefe1:
 $_0x4bbb = [];
 goto L_70140;
 L_3d399:
 $_0x4bbb["\x74\157\x6b\145\x6e\137\x76\141\x6c\151\x64"] = $_0x5083;
 goto L_7536b;
 L_7054e:
 $_0x4bbb["\x6a\141\x64\167\x61\154"] = $_0xd060;
 goto L_491ae;
 L_70140:
 $_0x5083 = true;
 goto L_91e0e;
 L_7536b:
 if ($_0x5083) {
 $_0x8853 = $_0xd54a->table("\x63\142\x74\137\x73\151\x73\167\x61")->select("\x69\144\x5f\142\x61\156\x6b\54\x69\144\x5f\143\x62\164\x5f\163\x69\163\x77\141\x2c\151\x64\137\x6a\141\x64\167\x61\154\x2c\151\x64\137\x73\151\x73\167\x61\54\x6a\141\x77\141\x62\141\x6e\54\x6c\141\x6d\141\x5f\165\x6a\151\x61\156\x2c\155\x75\154\x61\151\x2c\163\x65\154\x65\163\x61\151\x2c\163\x74\141\x74\165\x73\54\x72\145\x73\145\x74\137\x69\172\x69\156\x2c\162\x65\163\x65\164\x5f\167\x61\153\x74\165")->where(["\x69\144\x5f\152\x61\144\x77\141\x6c" => $_0xd3c8, "\x69\144\x5f\163\x69\163\x77\141" => $_0x65ed])->get()->getRow();
 if ($_0x8853) {
 $_0x8853->log = $_0xd54a->table("\x6c\157\x67\137\x75\152\x69\141\x6e")->where(["\x69\144\x5f\152\x61\144\x77\141\x6c" => $_0xd3c8, "\x69\144\x5f\163\x69\163\x77\141" => $_0x65ed, "\x6c\157\x67\137\x74\171\x70\145" => "\x31"])->get()->getRow();
 }
 $_0xbde7 = false;
 $_0x65aa = false;
 if ($_0x8853) {
 if ($_0xd060->reset_login == "\x31") {
 if ($_0x8853->log && $_0x8853->log->address == $_0x3fa6 && $_0x8853->log->agent == $_0x63b8 && $_0x8853->log->device == $_0x6b31) {
 $_0xbde7 = true;
 } else if ($_0x8853->reset_izin == "\x31") {
 $_0xbde7 = true;
 }
 } else {
 $_0xbde7 = true;
 }
 } else {
 $_0xbde7 = true;
 $_0x65aa = true;
 }
 $_0x4bbb["\x69\172\x69\156\x6b\141\x6e"] = $_0xbde7;
 $_0x2595 = false;
 if ($_0xbde7) {
 if ($_0x65aa) {
 $_0x2595 = true;
 } else if ($_0x8853->reset_waktu == "\x30") {
 $_0x814b = new \DateTime($_0x8853->mulai);
 $_0x9938 = $_0x814b->diff(new \DateTime());
 $_0x8804 = $_0x9938->days * 24 * 60 + $_0x9938->h * 60 + $_0x9938->i;
 $_0x4bbb["\x69\156\x74\145\x72\166\x61\154"] = ["\x64\141\x79\163" => $_0x9938->days, "\x68\141\x72\151" => $_0x9938->d, "\x6a\141\x6d" => $_0x9938->h, "\x6d\145\x6e\151\x74" => $_0x9938->i, "\x64\145\x74\151\x6b" => $_0x9938->s, "\x74\157\x74\141\x6c" => $_0x8804];
 $_0x2595 = $_0x8804 < $_0xd060->durasi_ujian;
 $_0x4bbb["\x77\141\x72\156"] = ["\x64\165\x72\141\x73\151\x5f\165\x6a\151\x61\156" => $_0xd060->durasi_ujian, "\x73\151\x73\167\x61\137\x6d\165\x6c\141\x69" => $_0x8853->mulai, "\x64\165\x72\141\x73\151\x5f\163\x69\163\x77\141" => $_0x8853->lama_ujian, "\x74\151\x6d\145\x72\137\x65\154\x61\160\x73\145\x64" => $_0x8804, "\x74\145\x72\154\x61\155\x70\141\x75\151" => $_0x8804 - $_0xd060->durasi_ujian, "\x73\164\x61\164\x75\163" => $_0x2595 ? 0 : 1, "\x6d\163\x67" => $_0x2595 ? '' : "\x57\141\x6b\164\x75\40\x75\152\x69\141\x6e\40\x73\165\x64\141\x68\40\x68\141\x62\151\x73"];
 } else {
 $_0x2595 = true;
 }
 }
 $_0x4bbb["\x61\144\x61\137\x77\141\x6b\164\x75"] = $_0x2595;
 }
 goto L_0012f;
 L_d5974:
 $_0x4bbb["\x74\157\x6b\145\x6e"] = $_0x5083;
 goto L_3d399;
 L_94d26:
 $this->cbt = new \App\Models\CbtModel();
 goto L_76c72;
 L_91e0e:
 if ((string) $_0xd060->token === "\x31") {
 $_0x194c = $this->cbt->getToken();
 if ($_0x194c == null) {
 $_0x5083 = false;
 $_0x4bbb["\x72\145\x61\163\x6f\156"] = "\x74\157\x6b\145\x6e\137\x6d\151\x73\163\x69\156\x67";
 $_0x4bbb["\x74\157\x6b\145\x6e\137\x6d\163\x67"] = "\x54\157\x6b\145\x6e\40\x75\152\x69\141\x6e\40\x62\145\x6c\165\x6d\40\x74\145\x72\163\x65\144\x69\141";
 } else {
 $_0x4be6 = strtoupper(preg_replace("\x2f\133\x5c\163\x5c\170\x7b\62\x30\60\x42\175\x2d\134\x78\173\x32\60\x30\104\x7d\134\x78\173\x46\105\x46\106\x7d\135\x2b\57\x75", '', (string) ($_0x194c->token ?? '')));
 $_0x5083 = $_0x4be6 !== '' && $_0xa0ed !== '' && hash_equals($_0x4be6, $_0xa0ed);
 if ($_0x5083) {
 session()->set("\x74\157\x6b\145\x6e", $_0x4be6);
 } else {
 $_0x4bbb["\x72\145\x61\163\x6f\156"] = "\x74\157\x6b\145\x6e\137\x6d\151\x73\155\x61\164\x63\150";
 }
 $_0x4bbb["\x74\157\x6b\145\x6e\137\x6d\163\x67"] = $_0x5083 ? '' : "\x54\157\x6b\145\x6e\40\x73\141\x6c\141\x68";
 }
 }
 goto L_d5974;
 L_37dd5:
 $_0x2b42 = $this->isDeviceSupported();
 goto L_33192;
 }
 public function createQueueNumber($_0xc7a0)
 {
 goto L_387d4;
 L_d1f2e:
 $_0x56d2 = $_0xc7a0->acak_soal == "\x31" || $_0xc7a0->acak_soal === 1;
 goto L_1576c;
 L_207b9:
 if (count($_0x4111) == 0) {
 return $_0x1a49;
 }
 goto L_c8ca1;
 L_55927:
 $_0x5ee3 = (string) ($_0xc7a0->bank->opsi ?? "\x35");
 goto L_cb22a;
 L_e0108:
 if (count($_0xd406) == 0) {
 return $_0x1a49;
 }
 goto L_efb32;
 L_66ab6:
 foreach ($_0xd406 as $_0xcc01) {
 $_0xce47 = (string) ($_0xcc01->jenis ?? "\x31");
 if (!isset($_0x4cbd[$_0xce47])) {
 $_0x4cbd[$_0xce47] = [];
 }
 $_0x4cbd[$_0xce47][] = $_0xcc01;
 }
 goto L_747e7;
 L_3cc27:
 return $_0x1a49;
 L_747e7:
 $_0xd43c = ["\x31" => (int) ($_0xc7a0->bank->tampil_pg ?? 0), "\x32" => (int) ($_0xc7a0->bank->tampil_kompleks ?? 0), "\x33" => (int) ($_0xc7a0->bank->tampil_jodohkan ?? 0), "\x34" => (int) ($_0xc7a0->bank->tampil_isian ?? 0), "\x35" => (int) ($_0xc7a0->bank->tampil_esai ?? 0)];
 goto L_47803;
 L_9cddf:
 $_0x8e98 = ["\x41", "\x42", "\x43", "\x44", "\x45"];
 goto L_55927;
 L_00751:
 // Group questions by jenis to keep questions organized sequentially by type
 // (1: Pilihan Ganda, 2: Kompleks, 3: Jodohkan, 4: Isian, 5: Esai)
 $_0x4cbd = ["\x31" => [], "\x32" => [], "\x33" => [], "\x34" => [], "\x35" => []];
 goto L_66ab6;
 L_fc18f:
 foreach (["\x31", "\x32", "\x33", "\x34", "\x35"] as $_0xce47) {
 $_0x7db5 = $_0x4cbd[$_0xce47] ?? [];
 if (empty($_0x7db5)) {
 continue;
 }
 // Sort by nomor_soal first
 usort($_0x7db5, static function ($_0x156e, $_0xcbc7) {
 return ($_0x156e->nomor_soal ?? 0) <=> ($_0xcbc7->nomor_soal ?? 0);
 });
 // Randomize questions within this jenis if acak_soal is enabled
 if ($_0x56d2) {
 shuffle($_0x7db5);
 }
 // Slice to tampil count if specified and less than available questions in bank
 $_0x30ce = $_0xd43c[$_0xce47] ?? 0;
 if ($_0x30ce > 0 && $_0x30ce < count($_0x7db5)) {
 $_0x7db5 = array_slice($_0x7db5, 0, $_0x30ce);
 }
 foreach ($_0x7db5 as $_0xcc01) {
 $_0xce10 = ["\x69\144\x5f\142\x61\156\x6b" => $_0xc7a0->bank->id_bank, "\x69\144\x5f\152\x61\144\x77\141\x6c" => $_0xc7a0->id_jadwal, "\x69\144\x5f\163\x6f\141\x6c" => $_0xcc01->id_soal, "\x6a\145\x6e\151\x73" => $_0xce47, "\x6e\157\x5f\163\x6f\141\x6c\137\x61\154\x69\141\x73" => $_0xa6d6, "\x6a\141\x77\141\x62\141\x6e\137\x62\145\x6e\141\x72" => $this->maybe_unserialize($_0xcc01->jawaban ?? ''), "\x6a\141\x77\141\x62\141\x6e\137\x61\154\x69\141\x73" => null, "\x6a\141\x77\141\x62\141\x6e\137\x73\151\x73\167\x61" => null];
 if ($_0xce47 == "\x31") {
 $_0x706f = $_0x4d08;
 if ($_0x7d6e) {
 shuffle($_0x706f);
 }
 $_0xce10["\x6f\160\x73\151\x5f\141\x6c\151\x61\163\x5f\141"] = $_0x706f[0] ?? "\x41";
 $_0xce10["\x6f\160\x73\151\x5f\141\x6c\151\x61\163\x5f\142"] = $_0x706f[1] ?? "\x42";
 $_0xce10["\x6f\160\x73\151\x5f\141\x6c\151\x61\163\x5f\143"] = $_0x706f[2] ?? "\x43";
 $_0xce10["\x6f\160\x73\151\x5f\141\x6c\151\x61\163\x5f\144"] = $_0x706f[3] ?? "\x44";
 $_0xce10["\x6f\160\x73\151\x5f\141\x6c\151\x61\163\x5f\145"] = $_0x706f[4] ?? "\x45";
 $_0xce10["\x70\157\x69\156\x74\137\x73\157\x61\154"] = ($_0xc7a0->bank->bobot_pg ?? 0) > 0 && ($_0xc7a0->bank->tampil_pg ?? 0) > 0 ? round($_0xc7a0->bank->bobot_pg / $_0xc7a0->bank->tampil_pg, 2) : 0;
 } elseif ($_0xce47 == "\x32") {
 $_0xce10["\x6f\160\x73\151\x5f\141\x6c\151\x61\163\x5f\141"] = "\x41";
 $_0xce10["\x70\157\x69\156\x74\137\x73\157\x61\154"] = ($_0xc7a0->bank->bobot_kompleks ?? 0) > 0 && ($_0xc7a0->bank->tampil_kompleks ?? 0) > 0 ? round($_0xc7a0->bank->bobot_kompleks / $_0xc7a0->bank->tampil_kompleks, 2) : 0;
 } elseif ($_0xce47 == "\x33") {
 $_0xce10["\x70\157\x69\156\x74\137\x73\157\x61\154"] = ($_0xc7a0->bank->bobot_jodohkan ?? 0) > 0 && ($_0xc7a0->bank->tampil_jodohkan ?? 0) > 0 ? round($_0xc7a0->bank->bobot_jodohkan / $_0xc7a0->bank->tampil_jodohkan, 2) : 0;
 } elseif ($_0xce47 == "\x34") {
 $_0xce10["\x70\157\x69\156\x74\137\x73\157\x61\154"] = ($_0xc7a0->bank->bobot_isian ?? 0) > 0 && ($_0xc7a0->bank->tampil_isian ?? 0) > 0 ? round($_0xc7a0->bank->bobot_isian / $_0xc7a0->bank->tampil_isian, 2) : 0;
 } elseif ($_0xce47 == "\x35") {
 $_0xce10["\x70\157\x69\156\x74\137\x73\157\x61\154"] = ($_0xc7a0->bank->bobot_esai ?? 0) > 0 && ($_0xc7a0->bank->tampil_esai ?? 0) > 0 ? round($_0xc7a0->bank->bobot_esai / $_0xc7a0->bank->tampil_esai, 2) : 0;
 }
 $_0x1a49[] = $_0xce10;
 $_0xa6d6++;
 }
 }
 goto L_3cc27;
 L_e7ebd:
 $_0x4111 = $_0xc7a0->bank->soal ?? [];
 goto L_207b9;
 L_47803:
 $_0xa6d6 = 1;
 goto L_d1f2e;
 L_efb32:
 $_0x3e0b = ["\x32" => ["\x41", "\x42"], "\x33" => ["\x41", "\x42", "\x43"], "\x34" => ["\x41", "\x42", "\x43", "\x44"]];
 goto L_9cddf;
 L_cb22a:
 $_0x4d08 = $_0x3e0b[$_0x5ee3] ?? $_0x8e98;
 goto L_00751;
 L_c8ca1:
 $_0xd406 = array_filter($_0x4111, function ($_0xcc01) {
 return ($_0xcc01->tampilkan ?? "\x31") == "\x31";
 });
 goto L_e0108;
 L_1576c:
 $_0x7d6e = $_0xc7a0->acak_opsi == "\x31" || $_0xc7a0->acak_opsi === 1;
 goto L_fc18f;
 L_387d4:
 $_0x1a49 = [];
 goto L_e7ebd;
 }
 private function jadwalSebelumnyaBelumSelesai($_0x32c2, $_0x5cc0, $_0xa459)
 {
 foreach ($_0x5cc0 as $_0x95b2) {
 if ($_0x95b2->tgl_mulai != $_0x32c2 && isset($_0xa459[$_0x95b2->id_jadwal])) {
 $_0x8326 = $_0xa459[$_0x95b2->id_jadwal];
 if ($_0x8326->status == "\x31" && !$_0x8326->selesai) {
 return $_0x95b2->id_jadwal;
 }
 }
 }
 return false;
 }
 public function penilaian($_0xde32)
 {
 goto L_9b99a;
 L_bdf00:
 $_0x4641["\x74\160"] = $_0x1cd0->tp;
 goto L_3fef7;
 L_c751f:
 $_0x718e = $_0x1cd0->smt_active;
 goto L_bdf00;
 L_d8444:
 if (!empty($_0x712b->id_siswa)) {
 session()->set("\x69\144\x5f\163\x69\163\x77\141", $_0x712b->id_siswa);
 }
 goto L_e793e;
 L_21ef0:
 $this->ensureKameraSchema();
 goto L_f898a;
 L_5b7c6:
 $_0x4641["\x73\155\x74\137\x61\143\x74\151\x76\145"] = $_0x718e;
 goto L_60619;
 L_b2827:
 $_0x5fcf = \Config\Database::connect();
 goto L_5b58e;
 L_3ffeb:
 $_0x6ea4 = (object) session()->get();
 goto L_7c086;
 L_8e7b5:
 $_0x718e = $this->dashboard->getSemesterActive();
 goto L_3ffeb;
 L_f898a:
 $_0xfcc7 = $_0x5fcf->table("\x63\142\x74\137\x6a\141\x64\167\x61\154\x20\152")->select("\x6a\56\x69\144\x5f\152\x61\144\x77\141\x6c\54\x6a\56\x69\144\x5f\164\x70\54\x6a\56\x69\144\x5f\163\x6d\164\x2c\152\x2e\151\x64\137\x62\141\x6e\153\x2c\152\x2e\151\x64\137\x6a\145\x6e\151\x73\54\x6a\56\x74\147\x6c\137\x6d\165\x6c\141\x69\54\x6a\56\x74\147\x6c\137\x73\145\x6c\145\x73\141\x69\54\x6a\56\x72\145\x73\145\x74\137\x6c\157\x67\151\x6e\54\x6a\56\x70\145\x6c\141\x6e\147\x67\141\x72\141\x6e\54\x6a\56\x6b\141\x6d\145\x72\141\x2c\152\x2e\154\x6f\143\x6b\137\x62\162\x6f\167\x73\145\x72\54\x62\56\x62\141\x6e\153\x5f\153\x6f\144\x65")->join("\x63\142\x74\137\x62\141\x6e\153\x5f\163\x6f\141\x6c\40\x62", "\x62\56\x69\144\x5f\142\x61\156\x6b\75\x6a\56\x69\144\x5f\142\x61\156\x6b", "\x6c\145\x66\164")->where("\x6a\56\x69\144\x5f\152\x61\144\x77\141\x6c", $_0xde32)->get()->getRow();
 goto L_ea6c3;
 L_e8e73:
 if ($_0xfcc7) {
 $_0xfcc7->bank = (object) ["\x69\144\x5f\142\x61\156\x6b" => $_0xfcc7->id_bank, "\x62\141\x6e\153\x5f\153\x6f\144\x65" => $_0xfcc7->bank_kode];
 $_0x4641["\x72\145\x73\145\x74\137\x6c\157\x67\151\x6e"] = $_0xfcc7->reset_login;
 $_0x4641["\x70\145\x6c\141\x6e\147\x67\141\x72\141\x6e"] = $_0xfcc7->pelanggaran;
 $_0x4641["\x6b\141\x6d\145\x72\141"] = $_0xfcc7->kamera ?? 0;
 $_0x4641["\x69\144\x5f\152\x61\144\x77\141\x6c"] = $_0xfcc7->id_jadwal;
 $_0x4641["\x69\144\x5f\142\x61\156\x6b"] = $_0xfcc7->id_bank;
 } else {
 $_0x4641["\x72\145\x73\145\x74\137\x6c\157\x67\151\x6e"] = "\x30";
 $_0x4641["\x70\145\x6c\141\x6e\147\x67\141\x72\141\x6e"] = "\x30";
 $_0x4641["\x6b\141\x6d\145\x72\141"] = 0;
 $_0x4641["\x69\144\x5f\152\x61\144\x77\141\x6c"] = $_0xde32;
 $_0x4641["\x69\144\x5f\142\x61\156\x6b"] = 0;
 }
 goto L_2ed12;
 L_760e1:
 $_0x1cd0 = $this->getTpSmt();
 goto L_5f1c9;
 L_d5754:
 $_0x4641 = ["\x75\163\x65\162" => $_0x6ea4, "\x73\151\x73\167\x61" => $_0x712b, "\x6a\165\x64\165\x6c" => "\x50\145\x6e\151\x6c\141\x69\141\x6e", "\x73\145\x74\164\x69\156\x67" => $this->dashboard->getSetting()];
 goto L_760e1;
 L_57c41:
 $_0x4641["\x74\160\x5f\141\x63\164\x69\166\x65"] = $_0xdf30;
 goto L_5b7c6;
 L_e793e:
 session()->set("\x69\144\x5f\152\x61\144\x77\141\x6c", $_0xde32);
 goto L_e8e73;
 L_5b58e:
 $this->dashboard = new \App\Models\DashboardModel();
 goto L_c35c1;
 L_c35c1:
 $this->cbt = new \App\Models\CbtModel();
 goto L_fb06e;
 L_7c086:
 $_0x712b = $this->resolveSiswa($_0x6ea4->username ?? session()->get("\x75\163\x65\162\x6e\141\x6d\145"), $_0xdf30->id_tp ?? 0, $_0x718e->id_smt ?? 0);
 goto L_d5754;
 L_fb06e:
 $_0xdf30 = $this->dashboard->getTahunActive();
 goto L_8e7b5;
 L_5f1c9:
 $_0xdf30 = $_0x1cd0->tp_active;
 goto L_c751f;
 L_2ed12:
 return view("\x6d\145\x6d\142\x65\162\x73\57\x73\151\x73\167\x61\57\x63\142\x74\57\x75\152\x69\141\x6e", $_0x4641);
 L_60619:
 $_0x4641["\x72\165\x6e\156\x69\156\x67\137\x74\145\x78\164"] = $this->dashboard->getRunningText();
 goto L_21ef0;
 L_ea6c3:
 if ($_0xfcc7) {
 $_0x6b70 = $this->checkExambroLock($_0xfcc7);
 if (!$_0x6b70["\x61\154\x6c\157\x77\145\x64"]) {
 return redirect()->to(base_url("\x63\142\x74\163\x69\163\x77\141\x2f\153\x6f\156\x66\151\x72\155\x61\163\x69\57" . $_0xde32));
 }
 }
 goto L_d8444;
 L_9b99a:
 if ($_0x9db7 = $this->requireLogin()) {
 return $_0x9db7;
 }
 goto L_b2827;
 L_3fef7:
 $_0x4641["\x73\155\x74"] = $_0x1cd0->smt;
 goto L_57c41;
 }
 public function validasi_jadwal()
 {
 goto L_35c10;
 L_7163c:
 $this->logging = new \App\Models\LogModel();
 goto L_e8c42;
 L_e8f98:
 if (!$_0x8de0) {
 return $this->output_json(["\x61\160\x70\162\x6f\166\x65\144" => false, "\x6d\145\x73\163\x61\147\x65" => "\x57\141\x6b\164\x75\40\x75\152\x69\141\x6e\40\x74\151\x64\141\x6b\40\x73\145\x73\165\x61\151", "\x65\162\x72\157\x72" => '']);
 }
 goto L_a80ce;
 L_3bd23:
 $_0x8cad = $this->getJadwalDetailed($_0xb998, $_0x3fe5->id_tp, $_0xb5ca->id_smt);
 goto L_eac34;
 L_2981c:
 if (empty($_0xb998)) {
 $_0xb998 = session()->get("\x69\144\x5f\152\x61\144\x77\141\x6c");
 }
 goto L_5372e;
 L_7bc37:
 $_0xb5ca = $this->dashboard->getSemesterActive();
 goto L_afceb;
 L_a80ce:
 $_0x3c28 = $_0x8cad->bank;
 goto L_c18cb;
 L_18589:
 if ($_0x38e6 && isset($_0x38e6->sesi->waktu_mulai) && isset($_0x38e6->sesi->waktu_akhir)) {
 $_0x20a2 = new \DateTime();
 $_0xfe7a = new \DateTime($_0x38e6->sesi->waktu_mulai);
 $_0x9540 = new \DateTime($_0x38e6->sesi->waktu_akhir);
 if ($_0x9540 < $_0xfe7a) {
 $_0x9540->modify("\x2b\61\x20\144\x61\171");
 }
 if ($_0x20a2 > $_0x9540) {
 return $this->output_json(["\x61\160\x70\162\x6f\166\x65\144" => false, "\x6d\145\x73\163\x61\147\x65" => "\x53\145\x73\151\x20\165\x6a\151\x61\156\x20\163\x75\144\x61\150\x20\142\x65\162\x61\153\x68\151\x72", "\x65\162\x72\157\x72" => '']);
 }
 if ($_0x20a2 < $_0xfe7a) {
 return $this->output_json(["\x61\160\x70\162\x6f\166\x65\144" => false, "\x6d\145\x73\163\x61\147\x65" => "\x53\145\x73\151\x20\165\x6a\151\x61\156\x20\142\x65\154\x75\155\x20\144\x69\155\x75\154\x61\151", "\x65\162\x72\157\x72" => '']);
 }
 }
 goto L_b21f0;
 L_f225e:
 $_0x3717 = $_0x8cad->tgl_selesai ?? '';
 goto L_6ecd7;
 L_8a1e4:
 $_0x758e = $_0x3457 && $_0x34b4["\x61\147\x65\156\x74"] != "\x75\156\x6b\156\x6f\167\x6e";
 goto L_728ce;
 L_3fbbc:
 $_0xee79 = null;
 goto L_5e14a;
 L_58c66:
 if (!$_0x58a8) {
 return $this->output_json(["\x61\160\x70\162\x6f\166\x65\144" => false, "\x6d\145\x73\163\x61\147\x65" => "\x54\151\x64\141\x6b\40\x61\144\x61\40\x73\157\x61\154", "\x65\162\x72\157\x72" => '']);
 }
 goto L_2354c;
 L_0a06e:
 $_0x34b4 = $this->isDeviceSupported();
 goto L_f51ab;
 L_29a5b:
 $_0x3fe5 = $_0xbf3e->tp_active;
 goto L_11f8e;
 L_ccdbc:
 $_0x38e6 = $_0xc598->table("\x63\142\x74\137\x73\145\x73\151\x5f\163\x69\163\x77\141\x20\141")->select("\x61\56\x2a\54\x20\163\x2e\167\x61\153\x74\165\x5f\155\x75\154\x61\151\x2c\40\x73\56\x77\141\x6b\164\x75\137\x61\153\x68\151\x72\54\x20\163\x2e\156\x61\155\x61\137\x73\145\x73\151\x2c\40\x73\56\x6b\157\x64\145\x5f\163\x65\163\x69\54\x20\162\x2e\156\x61\155\x61\137\x72\165\x61\156\x67\54\x20\162\x2e\153\x6f\144\x65\137\x72\165\x61\156\x67")->join("\x63\142\x74\137\x73\145\x73\151\x20\163", "\x73\56\x69\144\x5f\163\x65\163\x69\75\x61\56\x73\145\x73\151\x5f\151\x64", "\x6c\145\x66\164")->join("\x63\142\x74\137\x72\165\x61\156\x67\40\x72", "\x72\56\x69\144\x5f\162\x75\141\x6e\147\x3d\141\x2e\162\x75\141\x6e\147\x5f\151\x64", "\x6c\145\x66\164")->where(["\x61\56\x73\151\x73\167\x61\137\x69\144" => $_0xdc1e->id_siswa, "\x61\56\x74\160\x5f\151\x64" => $_0x3fe5->id_tp, "\x61\56\x73\155\x74\137\x69\144" => $_0xb5ca->id_smt])->get()->getRow();
 goto L_9e775;
 L_77cc5:
 $_0x318f = $this->maybe_unserialize($_0xb312);
 goto L_aae81;
 L_efda3:
 $_0x5d38 = $_0xc598->table("\x63\142\x74\137\x6a\141\x64\167\x61\154\x20\141")->select("\x61\56\x69\144\x5f\152\x61\144\x77\141\x6c\54\x20\141\x2e\164\x67\154\x5f\155\x75\154\x61\151\x2c\40\x61\56\x6a\141\x6d\137\x6b\145\x2c\40\x62\56\x69\144\x5f\142\x61\156\x6b\54\x20\142\x2e\142\x61\156\x6b\137\x6b\157\x64\145")->join("\x63\142\x74\137\x62\141\x6e\153\x5f\163\x6f\141\x6c\40\x62", "\x62\56\x69\144\x5f\142\x61\156\x6b\75\x61\56\x69\144\x5f\142\x61\156\x6b", "\x6c\145\x66\164")->where(["\x61\56\x69\144\x5f\164\x70" => $_0x3fe5->id_tp, "\x61\56\x69\144\x5f\163\x6d\164" => $_0xb5ca->id_smt])->get()->getResult();
 goto L_90471;
 L_fe212:
 $_0xa859 = $this->checkExambroLock($_0x8cad);
 goto L_80ef6;
 L_35c10:
 session()->set("\x76\141\x6c\151\x64\141\x73\151", "\x30");
 goto L_4f58d;
 L_ded3b:
 if ($_0xf3b0) {
 return $this->output_json(["\x61\160\x70\162\x6f\166\x65\144" => false, "\x6d\145\x73\163\x61\147\x65" => "\x53\157\x61\154\x20\141\x67\141\x6d\141\x20\164\x69\144\x61\153\x20\163\x65\163\x75\141\x69", "\x65\162\x72\157\x72" => '']);
 }
 goto L_ccdbc;
 L_e8c42:
 $_0x3fe5 = $this->dashboard->getTahunActive();
 goto L_7bc37;
 L_4ffc9:
 if (!$_0xf515) {
 return $this->output_json(["\x61\160\x70\162\x6f\166\x65\144" => false, "\x6d\145\x73\163\x61\147\x65" => "\x4b\145\x6c\141\x73\40\x74\151\x64\141\x6b\40\x73\145\x73\165\x61\151", "\x65\162\x72\157\x72" => "\x50\145\x72\151\x6b\163\x61\40\x6b\145\x6d\142\x61\154\x69\40\x6e\141\x6d\141\x20\153\x65\154\x61\163\x20\101\x6e\144\x61\40\x70\141\x64\141\x20\113\x61\162\x74\165\x20\101\x6e\144\x61"]);
 }
 goto L_3f38e;
 L_b7319:
 $_0x58a8 = isset($_0x3c28->soal) && count($_0x3c28->soal) > 0;
 goto L_58c66;
 L_50064:
 $_0x2191 = $_0x8cad->tgl_mulai ?? '';
 goto L_f225e;
 L_15118:
 $_0xb312 = !empty($_0x8cad->bank_kelas) ? $_0x8cad->bank_kelas : $_0x3c28->bank_kelas ?? [];
 goto L_77cc5;
 L_3f38e:
 $_0xf3b0 = $_0x3c28->soal_agama != "\x2d" && $_0x3c28->soal_agama != "\x30" && $_0x3c28->soal_agama != ($_0xdc1e->agama ?? '');
 goto L_ded3b;
 L_535a3:
 $this->dashboard = new \App\Models\DashboardModel();
 goto L_3f7c5;
 L_071d5:
 $_0x2f9b = $_0xee79 != null && !empty($_0xee79->selesai);
 goto L_35128;
 L_9e775:
 if (!$_0x38e6) {
 $_0x38e6 = $_0xc598->table("\x63\142\x74\137\x73\145\x73\151\x5f\163\x69\163\x77\141\x20\141")->select("\x61\56\x2a\54\x20\163\x2e\167\x61\153\x74\165\x5f\155\x75\154\x61\151\x2c\40\x73\56\x77\141\x6b\164\x75\137\x61\153\x68\151\x72\54\x20\163\x2e\156\x61\155\x61\137\x73\145\x73\151\x2c\40\x73\56\x6b\157\x64\145\x5f\163\x65\163\x69\54\x20\162\x2e\156\x61\155\x61\137\x72\165\x61\156\x67\54\x20\162\x2e\153\x6f\144\x65\137\x72\165\x61\156\x67")->join("\x63\142\x74\137\x73\145\x73\151\x20\163", "\x73\56\x69\144\x5f\163\x65\163\x69\75\x61\56\x73\145\x73\151\x5f\151\x64", "\x6c\145\x66\164")->join("\x63\142\x74\137\x72\165\x61\156\x67\40\x72", "\x72\56\x69\144\x5f\162\x75\141\x6e\147\x3d\141\x2e\162\x75\141\x6e\147\x5f\151\x64", "\x6c\145\x66\164")->where("\x61\56\x73\151\x73\167\x61\137\x69\144", $_0xdc1e->id_siswa)->orderBy("\x61\56\x69\144\x5f\163\x65\163\x69\137\x73\151\x73\167\x61", "\x44\105\x53\103")->get()->getRow();
 }
 goto L_c4ea7;
 L_f51ab:
 $_0x3457 = $_0x34b4["\x73\164\x61\164\x75\163"];
 goto L_8a1e4;
 L_796ca:
 if ($_0x5d38 != null) {
 foreach ($_0x5d38 as $_0x9b2c) {
 $_0xd403[$_0x9b2c->id_jadwal] = $_0x9b2c;
 }
 }
 goto L_068bf;
 L_53f4c:
 $_0xbf3e = $this->getTpSmt();
 goto L_29a5b;
 L_6ecd7:
 $_0x8de0 = $_0x55cb >= $_0x2191 && $_0x55cb <= $_0x3717;
 goto L_e8f98;
 L_35128:
 if ($_0x2f9b) {
 return $this->output_json(["\x61\160\x70\162\x6f\166\x65\144" => false, "\x6d\145\x73\163\x61\147\x65" => "\x41\156\x64\141\x20\163\x75\144\x61\150\x20\163\x65\154\x65\163\x61\151\x20\165\x6a\151\x61\156", "\x65\162\x72\157\x72" => '']);
 }
 goto L_efda3;
 L_aae81:
 if (is_array($_0x318f)) {
 foreach ($_0x318f as $_0x8c57) {
 if (is_object($_0x8c57)) {
 $_0xa474[] = (string) ($_0x8c57->kelas_id ?? '');
 } elseif (is_array($_0x8c57)) {
 $_0xa474[] = (string) ($_0x8c57["\x6b\145\x6c\141\x73\137\x69\144"] ?? '');
 } else {
 $_0xa474[] = (string) $_0x8c57;
 }
 }
 }
 goto L_820eb;
 L_265b4:
 $_0x3084 = [];
 goto L_3fbbc;
 L_0786a:
 $_0xfe3b = $_0xb6e2["\x69\172\x69\156\x6b\141\x6e"];
 goto L_65b58;
 L_b21f0:
 $_0xbc9f = $_0xc598->table("\x63\142\x74\137\x73\151\x73\167\x61")->select("\x69\144\x5f\142\x61\156\x6b\54\x69\144\x5f\143\x62\164\x5f\163\x69\163\x77\141\x2c\151\x64\137\x6a\141\x64\167\x61\154\x2c\151\x64\137\x73\151\x73\167\x61\54\x6a\141\x77\141\x62\141\x6e\54\x6c\141\x6d\141\x5f\165\x6a\151\x61\156\x2c\155\x75\154\x61\151\x2c\162\x65\163\x65\164\x5f\151\x7a\151\x6e\54\x72\145\x73\145\x74\137\x77\141\x6b\164\x75\54\x73\145\x6c\145\x73\141\x69\54\x73\164\x61\164\x75\163")->where("\x69\144\x5f\163\x69\163\x77\141", $_0xdc1e->id_siswa)->get()->getResult();
 goto L_265b4;
 L_2354c:
 $_0xa474 = [];
 goto L_15118;
 L_eac34:
 if (!$_0x8cad) {
 return $this->output_json(["\x61\160\x70\162\x6f\166\x65\144" => false, "\x6d\145\x73\163\x61\147\x65" => "\x4a\141\x64\167\x61\154\x20\164\x69\144\x61\153\x20\163\x65\163\x75\141\x69", "\x65\162\x72\157\x72" => "\x44\141\x74\141\x20\152\x61\144\x77\141\x6c\40\x74\151\x64\141\x6b\40\x64\151\x74\145\x6d\165\x6b\141\x6e"]);
 }
 goto L_fe212;
 L_87723:
 $_0x31b6 = $_0xb6e2["\x6d\165\x6c\141\x69\137\x62\141\x72\165"];
 goto L_1cf5e;
 L_f357d:
 if (!$_0x7189) {
 return $this->output_json(["\x61\160\x70\162\x6f\166\x65\144" => false, "\x6d\145\x73\163\x61\147\x65" => "\x57\141\x6b\164\x75\40\x41\156\x64\141\x20\163\x75\144\x61\150\x20\150\x61\142\x69\163", "\x65\162\x72\157\x72" => '']);
 }
 goto L_071d5;
 L_728ce:
 if (!$_0x758e) {
 return $this->output_json(["\x61\160\x70\162\x6f\166\x65\144" => false, "\x6d\145\x73\163\x61\147\x65" => $_0x34b4["\x61\147\x65\156\x74"] . "\x3a" . $_0x34b4["\x73\164\x61\164\x75\163"], "\x65\162\x72\157\x72" => "\x42\162\x6f\167\x73\145\x72\40\x74\151\x64\141\x6b\40\x64\151\x6b\145\x6e\141\x6c"]);
 }
 goto L_3bd23;
 L_f5b9c:
 if ((string) $_0x8cad->token === "\x31") {
 $_0x3646 = strtoupper(preg_replace("\x2f\133\x5c\163\x5c\170\x7b\62\x30\60\x42\175\x2d\134\x78\173\x32\60\x30\104\x7d\134\x78\173\x46\105\x46\106\x7d\135\x2b\57\x75", '', (string) (session()->get("\x74\157\x6b\145\x6e") ?? '')));
 $_0xa35e = $this->cbt->getToken();
 $_0x54c3 = $_0xa35e ? strtoupper(preg_replace("\x2f\133\x5c\163\x5c\170\x7b\62\x30\60\x42\175\x2d\134\x78\173\x32\60\x30\104\x7d\134\x78\173\x46\105\x46\106\x7d\135\x2b\57\x75", '', (string) ($_0xa35e->token ?? ''))) : '';
 $_0x5697 = $_0x54c3 !== '' && $_0x3646 !== '' && hash_equals($_0x54c3, $_0x3646);
 if (!$_0x5697) {
 return $this->output_json(["\x61\160\x70\162\x6f\166\x65\144" => false, "\x6d\145\x73\163\x61\147\x65" => "\x54\157\x6b\145\x6e\40\x74\151\x64\141\x6b\40\x76\141\x6c\151\x64", "\x65\162\x72\157\x72" => "\x48\165\x62\165\x6e\147\x69\40\x70\145\x6e\147\x61\167\x61\163\x20\165\x6e\164\x75\153\x20\155\x65\156\x64\141\x70\141\x74\153\x61\156\x20\164\x6f\153\x65\156\x20\171\x61\156\x67\40\x62\145\x6e\141\x72"]);
 }
 }
 goto L_77bb8;
 L_fa95a:
 if (!empty($_0x9ec6["\x72\145\x73\145\x74\137\x74\171\x70\145"])) {
 $this->handleResetWaktu($_0xee79, $_0x9ec6["\x72\145\x73\145\x74\137\x74\171\x70\145"]);
 }
 goto L_3ee2b;
 L_3f7c5:
 $this->cbt = new \App\Models\CbtModel();
 goto L_7163c;
 L_cf54d:
 foreach ($_0xd403 as $_0x94d5) {
 $_0xe50a = $_0x94d5->tgl_mulai;
 $_0xb7e0[$_0xe50a][] = $_0x94d5;
 }
 goto L_87723;
 L_ea718:
 $_0xb6e2 = $this->isSiswaDiizinkan($_0x8cad, $_0xee79, $_0x34b4["\x61\147\x65\156\x74"], $_0x34b4["\x61\144\x64\162\x65\163\x73"], $_0x34b4["\x64\145\x76\151\x63\145"]);
 goto L_0786a;
 L_27183:
 return $this->output_json(["\x61\144\x61\137\x73\157\x61\154" => $_0x58a8, "\x71\165\x65\165\x65" => $_0x51a5, "\x6a\155\x6c\137\x73\157\x61\154" => count($_0x51a5), "\x61\160\x70\162\x6f\166\x65\144" => true, "\x62\141\x6e\153" => $_0x3c28, "\x6a\141\x64\167\x61\154" => $_0x8cad, "\x6a\141\x64\167\x61\154\x73" => $_0xb7e0, "\x73\145\x73\151\x73\151\x73\167\x61" => $_0x38e6, "\x74\157\x64\141\x79" => $_0x55cb, "\x74\147\x6c\137\x63\157\x63\157\x6b" => $_0x8de0]);
 L_21311:
 $_0x9ec6 = $this->isWaktuMasihAda($_0xee79, $_0x8cad);
 goto L_20eb6;
 L_820eb:
 $_0xa474 = array_filter($_0xa474);
 goto L_afd1f;
 L_5d865:
 $_0x55cb = date("\x59\55\x6d\55\x64");
 goto L_50064;
 L_757b0:
 $_0xf515 = empty($_0xa474) || in_array($_0xa8bc, $_0xa474, true);
 goto L_4ffc9;
 L_a4901:
 if ($_0x38e6) {
 $_0x38e6->sesi = (object) ["\x69\144\x5f\163\x65\163\x69" => $_0x38e6->sesi_id, "\x77\141\x6b\164\x75\137\x6d\165\x6c\141\x69" => $_0x38e6->waktu_mulai, "\x77\141\x6b\164\x75\137\x61\153\x68\151\x72" => $_0x38e6->waktu_akhir];
 $_0x38e6->ruang = (object) ["\x69\144\x5f\162\x75\141\x6e\147" => $_0x38e6->ruang_id, "\x6e\141\x6d\141\x5f\162\x75\141\x6e\147" => $_0x38e6->nama_ruang];
 }
 goto L_18589;
 L_afd1f:
 $_0xa8bc = (string) ($_0xdc1e->kelas_id ?? '');
 goto L_757b0;
 L_11f8e:
 $_0xb5ca = $_0xbf3e->smt_active;
 goto L_0a06e;
 L_5372e:
 $_0xc598 = \Config\Database::connect();
 goto L_535a3;
 L_80ef6:
 if (!$_0xa859["\x61\154\x6c\157\x77\145\x64"]) {
 return $this->output_json(["\x61\160\x70\162\x6f\166\x65\144" => false, "\x6d\145\x73\163\x61\147\x65" => "\x41\153\x73\145\x73\40\x44\151\x6b\165\x6e\143\x69\40\x28\105\x78\141\x6d\142\x72\157\x29", "\x65\162\x72\157\x72" => $_0xa859["\x70\145\x73\141\x6e\137\x62\154\x6f\153\x69\162"]]);
 }
 goto L_f5b9c;
 L_77bb8:
 $_0x2f21 = $_0x8cad->status == "\x31";
 goto L_d872e;
 L_4f58d:
 $_0xb998 = $this->request->getPost("\x6a\141\x64\167\x61\154");
 goto L_2981c;
 L_20eb6:
 $_0x7189 = $_0x9ec6["\x61\144\x61\137\x77\141\x6b\164\x75"];
 goto L_f357d;
 L_8ea18:
 session()->set("\x76\141\x6c\151\x64\141\x73\151", "\x31");
 goto L_27183;
 L_73ba2:
 $_0xdc1e = $this->cbt->getDataSiswa($_0xde21->username, $_0x3fe5->id_tp, $_0xb5ca->id_smt);
 goto L_53f4c;
 L_3ee2b:
 $_0x51a5 = $this->inisialisasiJawaban($_0xdc1e, $_0x8cad, $_0xee79, $_0x31b6);
 goto L_8ea18;
 L_5e14a:
 if ($_0xbc9f) {
 foreach ($_0xbc9f as $_0xae4d) {
 $_0xae4d->log = $_0xc598->table("\x6c\157\x67\137\x75\152\x69\141\x6e")->where(["\x69\144\x5f\152\x61\144\x77\141\x6c" => $_0xae4d->id_jadwal, "\x69\144\x5f\163\x69\163\x77\141" => $_0xdc1e->id_siswa, "\x6c\157\x67\137\x74\171\x70\145" => "\x31"])->get()->getRow();
 if ($_0xae4d->id_jadwal == $_0xb998) {
 $_0xee79 = $_0xae4d;
 }
 $_0x3084[$_0xae4d->id_jadwal] = $_0xae4d;
 }
 }
 goto L_ea718;
 L_90471:
 $_0xd403 = [];
 goto L_796ca;
 L_d872e:
 if (!$_0x2f21) {
 return $this->output_json(["\x61\160\x70\162\x6f\166\x65\144" => false, "\x6d\145\x73\163\x61\147\x65" => "\x4a\141\x64\167\x61\154\x20\156\x6f\156\x61\153\x74\151\x66", "\x65\162\x72\157\x72" => "\x48\165\x62\165\x6e\147\x69\40\x70\145\x6e\147\x61\167\x61\163\x20\165\x6e\164\x75\153\x20\155\x65\156\x67\141\x6b\164\x69\146\x6b\141\x6e\40\x6a\141\x64\167\x61\154"]);
 }
 goto L_5d865;
 L_068bf:
 $_0xb7e0 = [];
 goto L_cf54d;
 L_c18cb:
 if (!$_0x3c28) {
 return $this->output_json(["\x61\160\x70\162\x6f\166\x65\144" => false, "\x6d\145\x73\163\x61\147\x65" => "\x44\141\x74\141\x20\142\x61\156\x6b\40\x73\157\x61\154\x20\164\x69\144\x61\153\x20\144\x69\164\x65\155\x75\153\x61\156", "\x65\162\x72\157\x72" => '']);
 }
 goto L_b7319;
 L_afceb:
 $_0xde21 = (object) session()->get();
 goto L_73ba2;
 L_c4ea7:
 if (!$_0x38e6 && !empty($_0xdc1e->kelas_id)) {
 $_0x38e6 = $_0xc598->table("\x63\142\x74\137\x73\145\x73\151\x5f\163\x69\163\x77\141\x20\141")->select("\x61\56\x2a\54\x20\163\x2e\167\x61\153\x74\165\x5f\155\x75\154\x61\151\x2c\40\x73\56\x77\141\x6b\164\x75\137\x61\153\x68\151\x72\54\x20\163\x2e\156\x61\155\x61\137\x73\145\x73\151\x2c\40\x73\56\x6b\157\x64\145\x5f\163\x65\163\x69\54\x20\162\x2e\156\x61\155\x61\137\x72\165\x61\156\x67\54\x20\162\x2e\153\x6f\144\x65\137\x72\165\x61\156\x67")->join("\x63\142\x74\137\x73\145\x73\151\x20\163", "\x73\56\x69\144\x5f\163\x65\163\x69\75\x61\56\x73\145\x73\151\x5f\151\x64", "\x6c\145\x66\164")->join("\x63\142\x74\137\x72\165\x61\156\x67\40\x72", "\x72\56\x69\144\x5f\162\x75\141\x6e\147\x3d\141\x2e\162\x75\141\x6e\147\x5f\151\x64", "\x6c\145\x66\164")->where("\x61\56\x6b\145\x6c\141\x73\137\x69\144", $_0xdc1e->kelas_id)->orderBy("\x61\56\x69\144\x5f\163\x65\163\x69\137\x73\151\x73\167\x61", "\x44\105\x53\103")->get()->getRow();
 }
 goto L_a4901;
 L_1cf5e:
 if (!empty($_0xb6e2["\x75\160\x64\141\x74\145\x5f\162\x65\163\x65\164\x5f\151\x7a\151\x6e"])) {
 $_0xee79 = $this->handleResetLogin($_0xee79, $_0x34b4["\x61\144\x64\162\x65\163\x73"], $_0x34b4["\x61\147\x65\156\x74"], $_0x34b4["\x64\145\x76\151\x63\145"], $_0xb998, $_0xdc1e);
 }
 goto L_fa95a;
 L_65b58:
 if (!$_0xfe3b) {
 return $this->output_json(["\x61\160\x70\162\x6f\166\x65\144" => false, "\x6d\145\x73\163\x61\147\x65" => $_0xb6e2["\x6d\163\x67"], "\x65\162\x72\157\x72" => '']);
 }
 goto L_21311;
 }
 public function save_played()
 {
 goto L_f585c;
 L_1f225:
 if (isset($_0x21cf->media) && is_array($_0x21cf->media)) {
 $_0xcd73 = array_filter($_0x21cf->media, function ($_0x77d0) use ($_0x9722, $_0x2956) {
 return isset($_0x77d0->id) && $_0x77d0->id == $_0x9722 && isset($_0x77d0->type) && $_0x77d0->type == $_0x2956;
 });
 if (!empty($_0xcd73)) {
 $_0x84df = array_keys($_0xcd73)[0];
 $_0x21cf->media[$_0x84df] = $_0x57ce;
 } else {
 $_0x21cf->media[] = $_0x57ce;
 }
 } else {
 $_0x21cf->media = [$_0x57ce];
 }
 goto L_d9003;
 L_c3098:
 $_0x21cf = $_0x8d78->jawaban[$_0x65ab];
 goto L_9bb9e;
 L_9fafb:
 $_0x2cb8 = $this->request->getPost("\x73\157\x61\154");
 goto L_0a8d4;
 L_f585c:
 $_0x6f58 = \Config\Database::connect();
 goto L_efb8f;
 L_efb8f:
 $_0x31f1 = $this->request->getPost("\x73\151\x73\167\x61");
 goto L_3d9d5;
 L_99cd0:
 $_0x8d78 = $_0x6f58->table("\x63\142\x74\137\x73\151\x73\167\x61")->select("\x69\144\x5f\142\x61\156\x6b\54\x69\144\x5f\143\x62\164\x5f\163\x69\163\x77\141\x2c\151\x64\137\x6a\141\x64\167\x61\154\x2c\151\x64\137\x73\151\x73\167\x61\54\x6a\141\x77\141\x62\141\x6e")->where(["\x69\144\x5f\152\x61\144\x77\141\x6c" => $_0x606c, "\x69\144\x5f\163\x69\163\x77\141" => $_0x31f1])->get()->getRow();
 goto L_c5372;
 L_c5372:
 if (!$_0x8d78) {
 return $this->response->setJSON(["\x73\165\x63\143\x65\163\x73" => false]);
 }
 goto L_961c4;
 L_9e87f:
 $_0x65ab = array_search($_0x2cb8, array_column($_0x8d78->jawaban, "\x69\144\x5f\163\x6f\141\x6c"));
 goto L_1267e;
 L_d9003:
 $_0x8d78->jawaban[$_0x65ab] = $_0x21cf;
 goto L_c5b98;
 L_9bb9e:
 $_0x57ce = ["\x74\171\x70\145" => $_0x2956, "\x70\154\x61\171" => $_0xa94a, "\x69\144" => $_0x9722];
 goto L_1f225;
 L_0a8d4:
 $_0x9722 = $this->request->getPost("\x6d\145\x64\151\x61");
 goto L_d7afa;
 L_c185c:
 if (!is_array($_0x8d78->jawaban)) {
 return $this->response->setJSON(["\x73\165\x63\143\x65\163\x73" => false]);
 }
 goto L_9e87f;
 L_013bf:
 return $this->response->setJSON(["\x73\165\x63\143\x65\163\x73" => $_0xd70b]);
 L_c5b98:
 $_0xd70b = $_0x6f58->table("\x63\142\x74\137\x73\151\x73\167\x61")->set("\x6a\141\x77\141\x62\141\x6e", json_encode($_0x8d78->jawaban))->where("\x69\144\x5f\143\x62\164\x5f\163\x69\163\x77\141", $_0x8d78->id_cbt_siswa)->update();
 goto L_013bf;
 L_152b1:
 $_0xa94a = $this->request->getPost("\x70\154\x61\171");
 goto L_99cd0;
 L_3d9d5:
 $_0x606c = $this->request->getPost("\x6a\141\x64\167\x61\154");
 goto L_9fafb;
 L_1267e:
 if ($_0x65ab === false) {
 return $this->response->setJSON(["\x73\165\x63\143\x65\163\x73" => false]);
 }
 goto L_c3098;
 L_961c4:
 $_0x8d78->jawaban = json_decode($_0x8d78->jawaban);
 goto L_c185c;
 L_d7afa:
 $_0x2956 = $this->request->getPost("\x74\171\x70\145");
 goto L_152b1;
 }
 public function loadNomorSoal()
 {
 try {
 $_0x341f = \Config\Database::connect();
 $this->dashboard = new \App\Models\DashboardModel();
 $this->cbt = new \App\Models\CbtModel();
 $_0xab94 = $this->request->getPost("\x6a\141\x64\167\x61\154");
 if (empty($_0xab94)) {
 $_0xab94 = session()->get("\x69\144\x5f\152\x61\144\x77\141\x6c");
 }
 $_0x136a = $this->request->getPost("\x73\151\x73\167\x61");
 if (empty($_0x136a)) {
 $_0x136a = session()->get("\x69\144\x5f\163\x69\163\x77\141") ?? session()->get("\x69\144\x5f\165\x73\145\x72") ?? session()->get("\x75\163\x65\162\x5f\151\x64");
 }
 $_0x3dc4 = $this->request->getPost("\x62\141\x6e\153");
 if (empty($_0x3dc4)) {
 $_0x3dc4 = session()->get("\x69\144\x5f\142\x61\156\x6b");
 }
 $this->cbt->ensureHotsSchema();
 $_0x1995 = $this->request->getPost("\x6e\157\x6d\157\x72");
 $_0x3088 = $this->request->getPost("\x74\151\x6d\145\x72");
 if (session_status() === PHP_SESSION_ACTIVE) {
 session_write_close();
 }
 $_0x15e9 = $this->isDeviceSupported();
 $_0x78d1 = $_0x15e9["\x61\144\x64\162\x65\163\x73"];
 $_0xd4b7 = $_0x15e9["\x61\147\x65\156\x74"];
 $_0x3c0f = $_0x15e9["\x64\145\x76\151\x63\145"];
 $_0x9bc3 = $_0x15e9["\x73\164\x61\164\x75\163"] && $_0xd4b7 != "\x75\156\x6b\156\x6f\167\x6e";
 if (!$_0x9bc3) {
 return $this->output_json(["\x61\160\x70\162\x6f\166\x65\144" => false, "\x6d\145\x73\163\x61\147\x65" => "\x50\145\x72\141\x6e\147\x6b\141\x74\57\x42\162\x6f\167\x73\145\x72\40\x74\151\x64\141\x6b\40\x64\151\x6b\145\x6e\141\x6c\41", "\x65\162\x72\157\x72" => '']);
 }
 $_0x9e63 = $this->getTpSmt();
 $_0xdd91 = $_0x9e63->tp_active;
 $_0x8ae1 = $_0x9e63->smt_active;
 $_0x676f = $_0x341f->table("\x63\142\x74\137\x6a\141\x64\167\x61\154")->where("\x69\144\x5f\152\x61\144\x77\141\x6c", $_0xab94)->get()->getRow();
 if (!$_0x676f) {
 return $this->output_json(["\x61\160\x70\162\x6f\166\x65\144" => false, "\x6d\145\x73\163\x61\147\x65" => "\x4a\141\x64\167\x61\154\x20\164\x69\144\x61\153\x20\163\x65\163\x75\141\x69", "\x65\162\x72\157\x72" => '']);
 }
 if (empty($_0x3dc4) && !empty($_0x676f->id_bank)) {
 $_0x3dc4 = $_0x676f->id_bank;
 }
 $_0x5652 = $_0x341f->table("\x63\142\x74\137\x73\157\x61\154")->select("\x69\144\x5f\163\x6f\141\x6c\54\x62\141\x6e\153\x5f\151\x64\54\x6d\141\x70\145\x6c\137\x69\144\x2c\152\x65\156\x69\163\x2c\156\x6f\155\x6f\162\x5f\163\x6f\141\x6c\54\x73\157\x61\154\x2c\157\x70\163\x69\137\x61\54\x6f\160\x73\151\x5f\142\x2c\157\x70\163\x69\137\x63\54\x6f\160\x73\151\x5f\144\x2c\157\x70\163\x69\137\x65\54\x6a\141\x77\141\x62\141\x6e\54\x74\141\x6d\160\x69\154\x6b\141\x6e\54\x69\163\x5f\150\x6f\164\x73")->where(["\x62\141\x6e\153\x5f\151\x64" => $_0x3dc4, "\x74\141\x6d\160\x69\154\x6b\141\x6e" => "\x31"])->get()->getResult();
 if (!$_0x5652) {
 return $this->output_json(["\x61\160\x70\162\x6f\166\x65\144" => false, "\x6d\145\x73\163\x61\147\x65" => "\x4e\157\x20\161\x75\145\x73\164\x69\157\x6e\163\x20\146\x6f\165\x6e\144\x2e", "\x65\162\x72\157\x72" => '']);
 }
 $_0xb6f8 = $_0x341f->table("\x63\142\x74\137\x73\151\x73\167\x61")->select("\x69\144\x5f\142\x61\156\x6b\54\x69\144\x5f\143\x62\164\x5f\163\x69\163\x77\141\x2c\151\x64\137\x6a\141\x64\167\x61\154\x2c\151\x64\137\x73\151\x73\167\x61\54\x6a\141\x77\141\x62\141\x6e\54\x6c\141\x6d\141\x5f\165\x6a\151\x61\156\x2c\155\x75\154\x61\151\x2c\162\x65\163\x65\164\x5f\151\x7a\151\x6e\54\x72\145\x73\145\x74\137\x77\141\x6b\164\x75\54\x73\145\x6c\145\x73\141\x69\54\x73\164\x61\164\x75\163")->where(["\x69\144\x5f\152\x61\144\x77\141\x6c" => $_0xab94, "\x69\144\x5f\163\x69\163\x77\141" => $_0x136a])->get()->getRow();
 if ($_0xb6f8) {
 $_0xb6f8->log = $_0x341f->table("\x6c\157\x67\137\x75\152\x69\141\x6e")->where(["\x69\144\x5f\152\x61\144\x77\141\x6c" => $_0xab94, "\x69\144\x5f\163\x69\163\x77\141" => $_0x136a, "\x6c\157\x67\137\x74\171\x70\145" => "\x31"])->get()->getRow();
 }
 if (!$_0xb6f8) {
 return $this->output_json(["\x61\160\x70\162\x6f\166\x65\144" => false, "\x6d\145\x73\163\x61\147\x65" => "\x54\151\x64\141\x6b\40\x61\144\x61\40\x64\141\x74\141\x20\123\x4f\101\x4c\54\x20\163\x69\154\x61\150\x6b\141\x6e\40\x6b\145\x6d\142\x61\154\x69\40\x6b\145\x20\155\x65\156\x75\40\x75\164\x61\155\x61\40\x64\141\x6e\40\x63\157\x62\141\x20\154\x61\147\x69\56", "\x65\162\x72\157\x72" => "\x44\151\x72\145\x63\164\x20\141\x63\143\x65\163\x73\40\x6e\157\x74\40\x61\154\x6c\157\x77\145\x64"]);
 }
 if ($_0x676f->reset_login == "\x31") {
 if ($_0xb6f8->log && $_0xb6f8->log->address == $_0x78d1 && $_0xb6f8->log->agent == $_0xd4b7 && $_0xb6f8->log->device == $_0x3c0f) {
 $_0x834c = true;
 } else {
 $_0x834c = $_0xb6f8->reset_izin == "\x31";
 }
 } else {
 $_0x834c = true;
 }
 if (!$_0x834c) {
 return $this->output_json(["\x61\160\x70\162\x6f\166\x65\144" => false, "\x6d\145\x73\163\x61\147\x65" => "\x54\151\x64\141\x6b\40\x61\144\x61\40\x69\172\x69\156\x20\165\x6e\164\x75\153\x20\155\x65\154\x61\156\x6a\165\x74\153\x61\156\x2e\74\x62\162\x20\57\x3e\110\x75\142\x75\156\x67\151\x20\101\x64\155\x69\156\x21", "\x65\162\x72\157\x72" => "\x42\145\x6c\165\x6d\40\x72\145\x73\145\x74\40\x69\172\x69\156"]);
 }
 $_0x31ce = new \DateTime($_0xb6f8->mulai);
 $_0x29bd = $_0x31ce->diff(new \DateTime());
 $_0x3881 = $_0x29bd->days * 24 * 60 + $_0x29bd->h * 60 + $_0x29bd->i;
 $_0x9352 = $_0x29bd->format("\x25\110\x3a\45\x49\72\x25\123");
 if ($_0xb6f8->reset_waktu != "\x30") {
 $_0x22a3 = $_0x341f->table("\x63\142\x74\137\x73\151\x73\167\x61");
 $_0x22a3->set("\x6c\141\x6d\141\x5f\165\x6a\151\x61\156", "\x30\60\x3a\60\x30\72\x30\60");
 $_0x22a3->set("\x72\145\x73\145\x74\137\x77\141\x6b\164\x75", 0);
 $_0x22a3->where("\x69\144\x5f\143\x62\164\x5f\163\x69\163\x77\141", $_0xb6f8->id_cbt_siswa);
 $_0x22a3->update();
 $_0xb6f8->lama_ujian = "\x30\60\x3a\60\x30\72\x30\60";
 $_0xb6f8->reset_waktu = "\x30";
 } else {
 $_0xb6f8->lama_ujian = $_0x9352;
 }
 $_0x1cb8 = $_0xb6f8->jawaban;
 if (is_string($_0x1cb8)) {
 $_0xf7b7 = json_decode($_0x1cb8);
 $_0xb6f8->jawaban = is_array($_0xf7b7) ? $_0xf7b7 : [];
 } elseif (!is_array($_0x1cb8)) {
 $_0xb6f8->jawaban = [];
 }
 if (is_array($_0xb6f8->jawaban)) {
 usort($_0xb6f8->jawaban, function ($_0x79d3, $_0xaecc) {
 $_0xab01 = is_object($_0x79d3) ? $_0x79d3->no_soal_alias ?? 0 : $_0x79d3["\x6e\157\x5f\163\x6f\141\x6c\137\x61\154\x69\141\x73"] ?? 0;
 $_0x4549 = is_object($_0xaecc) ? $_0xaecc->no_soal_alias ?? 0 : $_0xaecc["\x6e\157\x5f\163\x6f\141\x6c\137\x61\154\x69\141\x73"] ?? 0;
 return (int) $_0xab01 <=> (int) $_0x4549;
 });
 }
 $_0xdd91 = null;
 if (!empty($_0xb6f8->jawaban)) {
 foreach ($_0xb6f8->jawaban as $_0x4ef3) {
 $_0xff72 = is_object($_0x4ef3) ? $_0x4ef3->no_soal_alias ?? null : $_0x4ef3["\x6e\157\x5f\163\x6f\141\x6c\137\x61\154\x69\141\x73"] ?? null;
 if ($_0xff72 !== null && (string) $_0xff72 === (string) $_0x1995) {
 $_0xdd91 = is_object($_0x4ef3) ? $_0x4ef3 : (object) $_0x4ef3;
 break;
 }
 }
 if (!$_0xdd91) {
 $_0x7db0 = (int) $_0x1995 - 1;
 if (isset($_0xb6f8->jawaban[$_0x7db0])) {
 $_0xef13 = $_0xb6f8->jawaban[$_0x7db0];
 $_0xdd91 = is_object($_0xef13) ? $_0xef13 : (object) $_0xef13;
 } else {
 $_0xef13 = $_0xb6f8->jawaban[0];
 $_0xdd91 = is_object($_0xef13) ? $_0xef13 : (object) $_0xef13;
 }
 }
 }
 $_0xbcdb = null;
 $_0xa0c5 = "\x3c\144\x69\166\x20\143\x6c\141\x73\163\x3d\42\x64\55\x66\154\x65\170\x20\146\x6c\145\x78\55\x77\162\x61\160\x20\152\x75\163\x74\151\x66\171\x2d\143\x6f\156\x74\145\x6e\164\x2d\143\x65\156\x74\145\x72\40\x67\162\x69\144\x2d\156\x6f\155\x6f\162\x2d\160\x67\42\x3e";
 $_0x3b75 = [];
 foreach ($_0xb6f8->jawaban as $_0x5d26 => $_0xd5e9) {
 $_0x74f7 = is_object($_0xd5e9) ? $_0xd5e9 : (object) $_0xd5e9;
 $_0x5418 = $_0x74f7->id_soal ?? 0;
 $_0xfde2 = array_filter($_0x5652, function ($_0xeed8) use ($_0x5418) {
 return (string) $_0xeed8->id_soal === (string) $_0x5418;
 });
 $_0xeed8 = !empty($_0xfde2) ? array_values($_0xfde2)[0] : null;
 if (!$_0xeed8) {
 continue;
 }
 $_0xeed8->jawaban = $this->maybe_unserialize($_0xeed8->jawaban ?? '');
 $_0xeed8->opsi_a = $this->maybe_unserialize($_0xeed8->opsi_a ?? '');
 $_0x6f89 = false;
 $_0xdbc0 = $_0x74f7->jawaban_siswa ?? null;
 if ($_0xdbc0 !== null && $_0xdbc0 !== '' && $_0xdbc0 !== "\x5b\135" && $_0xdbc0 !== []) {
 if ($_0xeed8->jenis == "\x33") {
 $_0x50f4 = [];
 $_0x9455 = $_0xdbc0;
 if (is_string($_0x9455)) {
 $_0x9455 = json_decode($_0x9455, true);
 } elseif (is_object($_0x9455)) {
 $_0x9455 = (array) $_0x9455;
 }
 $_0x1dcb = null;
 if (is_array($_0x9455)) {
 if (isset($_0x9455["\x6a\141\x77\141\x62\141\x6e"])) {
 $_0x1dcb = $_0x9455["\x6a\141\x77\141\x62\141\x6e"];
 } else {
 $_0x1dcb = $_0x9455;
 }
 }
 if (is_array($_0x1dcb)) {
 foreach ($_0x1dcb as $_0xdce5 => $_0x8dbd) {
 $_0x8dbd = (array) $_0x8dbd;
 if ($_0xdce5 > 0 && is_array($_0x8dbd)) {
 foreach ($_0x8dbd as $_0x754b => $_0xa236) {
 if ($_0x754b > 0) {
 $_0x50f4[] = (string) $_0xa236;
 }
 }
 }
 }
 $_0x6f89 = in_array("\x31", $_0x50f4, true);
 }
 } elseif ($_0xeed8->jenis == "\x32") {
 $_0x91e6 = $_0xdbc0;
 if (is_string($_0x91e6)) {
 $_0x91e6 = json_decode($_0x91e6, true) ?: [$_0x91e6];
 }
 $_0x6f89 = is_array($_0x91e6) ? count(array_filter($_0x91e6)) > 0 : !empty($_0x91e6);
 } else {
 $_0x6f89 = is_array($_0xdbc0) ? count(array_filter($_0xdbc0)) > 0 : $_0xdbc0 !== '';
 }
 }
 $_0xd287 = $_0x74f7->no_soal_alias ?? $_0x5d26 + 1;
 $_0x2ee5 = !$_0x6f89 ? "\x6f\165\x74\154\x69\156\x65\55\x73\145\x63\157\x6e\144\x61\162\x79" : "\x70\162\x69\155\x61\162\x79";
 $_0x6dc6 = $_0x1995 == $_0xd287 ? "\x61\143\x74\151\x76\145" : '';
 $_0xa0c5 .= "\x3c\144\x69\166\x20\143\x6c\141\x73\163\x3d\42\x6d\142\x2d\64\x22\76" . "\x3c\144\x69\166\x20\151\x64\75\x22\142\x6f\170" . $_0xd287 . "\x22\40\x63\154\x61\163\x73\75\x22\144\x2d\146\x6c\145\x78\40\x66\154\x65\170\x2d\143\x6f\154\x75\155\x6e\40\x70\157\x73\151\x74\151\x6f\156\x2d\162\x65\154\x61\164\x69\166\x65\42\x20\163\x74\171\x6c\145\x3d\42\x77\151\x64\164\x68\72\x20\67\x30\160\x78\73\x20\150\x65\151\x67\150\x74\72\x20\66\x30\160\x78\73\x22\76" . "\x3c\142\x75\164\x74\157\x6e\40\x69\144\x3d\42\x62\164\x6e" . $_0xd287 . "\x22\40\x63\154\x61\163\x73\75\x22\142\x74\156\x20\142\x74\156\x2d" . $_0x2ee5 . "\x20\142\x6f\162\x64\145\x72\40\x64\55\x69\156\x6c\151\x6e\145\x2d\146\x6c\145\x78\40\x61\154\x69\147\x6e\55\x69\164\x65\155\x73\55\x63\145\x6e\164\x65\162\x20\152\x75\163\x74\151\x66\171\x2d\143\x6f\156\x74\145\x6e\164\x2d\143\x65\156\x74\145\x72\40\x70\55\x30\40" . $_0x6dc6 . "\x22\40" . "\x64\141\x74\141\x2d\160\x6f\163\x3d\42" . $_0x5d26 . "\x22\40\x64\141\x74\141\x2d\156\x6f\155\x6f\162\x73\157\x61\154\x3d\42" . $_0xd287 . "\x22\40" . "\x64\141\x74\141\x2d\151\x64\163\x6f\141\x6c\75\x22" . $_0xeed8->id_soal . "\x22\40\x64\141\x74\141\x2d\152\x65\156\x69\163\x3d\42" . $_0xeed8->jenis . "\x22\40" . "\x6f\156\x63\154\x69\143\x6b\75\x22\154\x6f\141\x64\123\x6f\141\x6c\50\x74\150\x69\163\x29\42\x20" . "\x73\164\x79\154\x65\75\x22\167\x69\144\x74\150\x3a\40\x35\60\x70\170\x3b\40\x68\145\x69\147\x68\164\x3a\40\x35\60\x70\170\x3b\42\x3e" . "\x3c\163\x70\141\x6e\40\x63\154\x61\163\x73\75\x22\146\x77\55\x62\157\x6c\144\x22\40\x73\164\x79\154\x65\75\x22\146\x6f\156\x74\55\x73\151\x7a\145\x3a\40\x31\64\x70\164\x3b\40\x6c\151\x6e\145\x2d\150\x65\151\x67\150\x74\72\x20\61\x3b\42\x3e" . $_0xd287 . "\x3c\57\x73\160\x61\156\x3e" . "\x3c\57\x62\165\x74\164\x6f\156\x3e";
 if ($_0x6f89) {
 $_0x5f89 = $_0xeed8->jenis == "\x31" ? $_0x74f7->jawaban_alias ?? "\x41" : "\x26\143\x68\145\x63\153\x3b";
 $_0x3b75[] = $_0x74f7->jawaban_alias ?? '';
 $_0xa0c5 .= "\x3c\144\x69\166\x20\151\x64\75\x22\142\x61\144\x67\145" . $_0xd287 . "\x22\40\x63\154\x61\163\x73\75\x22\142\x61\144\x67\145\x20\142\x61\144\x67\145\x2d\160\x69\154\x6c\40\x62\141\x64\147\x65\55\x73\165\x63\143\x65\163\x73\40\x62\157\x72\144\x65\162\x20\142\x6f\162\x64\145\x72\55\x64\141\x72\153\x22" . "\x20\163\x74\171\x6c\145\x3d\42\x66\157\x6e\164\x2d\163\x69\172\x65\72\x31\62\x70\164\x3b\40\x77\151\x64\164\x68\72\x20\63\x30\160\x78\73\x20\150\x65\151\x67\150\x74\72\x20\63\x30\160\x78\73\x20\155\x61\162\x67\151\x6e\55\x74\157\x70\72\x20\55\x36\60\x70\170\x3b\40\x6d\141\x72\147\x69\156\x2d\154\x65\146\x74\72\x20\63\x30\160\x78\73\x22\76" . $_0x5f89 . "\x3c\57\x64\151\x76\76";
 }
 if (!empty($_0xeed8->is_hots) && (int) $_0xeed8->is_hots === 1) {
 $_0xa0c5 .= "\x3c\163\x70\141\x6e\40\x63\154\x61\163\x73\75\x22\142\x61\144\x67\145\x20\142\x67\55\x64\141\x6e\147\x65\162\x20\164\x65\170\x74\55\x77\150\x69\164\x65\40\x70\157\x73\151\x74\151\x6f\156\x2d\141\x62\163\x6f\154\x75\164\x65\42\x20\163\x74\171\x6c\145\x3d\42\x62\157\x74\164\x6f\155\x3a\40\x30\73\x20\154\x65\146\x74\72\x20\66\x70\170\x3b\40\x66\157\x6e\164\x2d\163\x69\172\x65\72\x20\70\x70\170\x3b\40\x70\141\x64\144\x69\156\x67\72\x20\61\x70\170\x20\65\x70\170\x3b\40\x6c\151\x6e\145\x2d\150\x65\151\x67\150\x74\72\x20\61\x2e\61\x3b\40\x62\157\x72\144\x65\162\x2d\162\x61\144\x69\165\x73\72\x20\64\x70\170\x3b\40\x70\157\x69\156\x74\145\x72\55\x65\166\x65\156\x74\163\x3a\40\x6e\157\x6e\145\x3b\40\x7a\55\x69\156\x64\145\x78\72\x20\63\x3b\40\x62\141\x63\153\x67\162\x6f\165\x6e\144\x2d\143\x6f\154\x6f\162\x3a\40\x23\144\x63\62\x36\62\x36\40\x21\151\x6d\160\x6f\162\x74\141\x6e\164\x3b\42\x3e\110\x4f\124\x53\74\x2f\163\x70\141\x6e\76";
 }
 $_0xa0c5 .= "\x3c\57\x64\151\x76\76\x3c\57\x64\151\x76\76";
 if ($_0xdd91 && (string) ($_0xdd91->id_soal ?? '') === (string) $_0xeed8->id_soal) {
 $_0xbcdb = clone $_0xeed8;
 }
 }
 if (!$_0xbcdb && !empty($_0x5652)) {
 $_0xbcdb = clone $_0x5652[0];
 }
 $_0x76c1 = [];
 $_0xfb60 = [];
 if ($_0xbcdb) {
 switch ($_0xbcdb->jenis) {
 case "\x31":
 $_0x59d8 = strtoupper(trim((string) ($_0xdd91->jawaban_siswa ?? '')));
 $_0x79a9 = ["\x41", "\x42", "\x43", "\x44", "\x45"];
 $_0xfb60 = [];
 // Fallback jika opsi tersimpan sebagai serialized/JSON di opsi_a
 if (!empty($_0xbcdb->opsi_a) && is_string($_0xbcdb->opsi_a)) {
 $_0x5880 = $this->maybe_unserialize($_0xbcdb->opsi_a);
 $_0xca56 = is_string($_0x5880) ? json_decode($_0x5880, true) : $_0x5880;
 if (is_array($_0xca56)) {
 foreach (["\x41", "\x42", "\x43", "\x44", "\x45"] as $_0xc604) {
 $_0xf4a3 = strtolower($_0xc604);
 if (isset($_0xca56[$_0xc604]) || isset($_0xca56[$_0xf4a3])) {
 $_0xbcdb->{"\x6f\160\x73\151\x5f" . $_0xf4a3} = $_0xca56[$_0xc604] ?? $_0xca56[$_0xf4a3];
 }
 }
 }
 }
 foreach ($_0x79a9 as $_0xb843) {
 $_0x4c1f = "\x6f\160\x73\151\x5f\141\x6c\151\x61\163\x5f" . strtolower($_0xb843);
 $_0xb5a9 = "\x6f\160\x73\151\x5f" . strtolower($_0xb843);
 $_0xa08b = !empty($_0xdd91->{$_0x4c1f}) ? $_0xdd91->{$_0x4c1f} : $_0xb843;
 $_0xbde6 = $_0xbcdb->{$_0xb5a9} ?? '';
 if ($_0xbde6 !== null && trim((string) $_0xbde6) !== '') {
 $_0xfb60[] = ["\x76\141\x6c\101\x6c\151\x61\163" => $_0xa08b, "\x6f\160\x73\151" => $_0xbde6, "\x76\141\x6c\165\x65" => $_0xb843, "\x63\150\x65\143\x6b\145\x64" => $_0xb843 === $_0x59d8 ? "\x63\150\x65\143\x6b\145\x64" : ''];
 }
 }
 foreach ($_0x79a9 as $_0xb843) {
 unset($_0xbcdb->{"\x6f\160\x73\151\x5f" . strtolower($_0xb843)});
 }
 usort($_0xfb60, function ($_0x79d3, $_0xaecc) {
 return ($_0x79d3["\x76\141\x6c\101\x6c\151\x61\163"] ?? '') <=> ($_0xaecc["\x76\141\x6c\101\x6c\151\x61\163"] ?? '');
 });
 break;
 case "\x32":
 $_0x59d8 = [];
 if (isset($_0xdd91->jawaban_siswa)) {
 if (is_array($_0xdd91->jawaban_siswa)) {
 $_0x59d8 = $_0xdd91->jawaban_siswa;
 } elseif (is_string($_0xdd91->jawaban_siswa)) {
 $_0xf7b7 = json_decode($_0xdd91->jawaban_siswa, true);
 $_0x59d8 = is_array($_0xf7b7) ? $_0xf7b7 : [$_0xdd91->jawaban_siswa];
 } elseif (is_object($_0xdd91->jawaban_siswa)) {
 $_0x59d8 = (array) $_0xdd91->jawaban_siswa;
 }
 }
 $_0x2cc9 = array_map(function ($_0x4e48) {
 return strtoupper((string) $_0x4e48);
 }, (array) $_0x59d8);
 $_0xfb60 = [];
 $_0xd57b = $_0xbcdb->opsi_a ?? [];
 if (is_string($_0xd57b)) {
 $_0x886c = $this->maybe_unserialize($_0xd57b);
 $_0xd57b = is_string($_0x886c) ? json_decode($_0x886c, true) ?? $_0x886c : $_0x886c;
 }
 $_0x20e1 = is_object($_0xd57b) ? (array) $_0xd57b : (is_array($_0xd57b) ? $_0xd57b : []);
 // Fallback jika guru menginput PGK di kolom terpisah opsi_a, opsi_b, opsi_c, dst
 if (empty($_0x20e1)) {
 foreach (["\x41", "\x42", "\x43", "\x44", "\x45"] as $_0xc604) {
 $_0xb036 = "\x6f\160\x73\151\x5f" . strtolower($_0xc604);
 if (!empty($_0xbcdb->{$_0xb036}) && trim((string) $_0xbcdb->{$_0xb036}) !== '') {
 $_0x20e1[$_0xc604] = $_0xbcdb->{$_0xb036};
 }
 }
 }
 if (!empty($_0x20e1)) {
 foreach ($_0x20e1 as $_0x5d26 => $_0xf03f) {
 if ($_0xf03f === null || trim((string) $_0xf03f) === '') {
 continue;
 }
 $_0xb431 = strtoupper((string) $_0x5d26);
 $_0xfb60[] = ["\x6f\160\x73\151" => $_0xf03f, "\x76\141\x6c\165\x65" => $_0x5d26, "\x63\150\x65\143\x6b\145\x64" => in_array($_0xb431, $_0x2cc9, true) ? "\x63\150\x65\143\x6b\145\x64\75\x22\164\x72\165\x65\42" : ''];
 }
 }
 usort($_0xfb60, function ($_0x79d3, $_0xaecc) {
 return ($_0x79d3["\x76\141\x6c\165\x65"] ?? '') <=> ($_0xaecc["\x76\141\x6c\165\x65"] ?? '');
 });
 $_0x198b = $_0xbcdb->jawaban ?? [];
 if (is_string($_0x198b)) {
 $_0x198b = json_decode($_0x198b, true) ?? $_0x198b;
 }
 $_0x8474 = is_object($_0x198b) ? (array) $_0x198b : (is_array($_0x198b) ? $_0x198b : []);
 $_0xccd9 = count(array_filter($_0x8474));
 $_0x76c1 = [$_0xccd9 > 0 ? $_0xccd9 : max(1, count($_0x20e1))];
 break;
 case "\x33":
 $_0xb993 = $_0xbcdb->jawaban ?? [];
 if (is_string($_0xb993)) {
 $_0x886c = $this->maybe_unserialize($_0xb993);
 $_0xb993 = is_string($_0x886c) ? json_decode($_0x886c, true) ?? $_0x886c : $_0x886c;
 }
 $_0xd955 = is_object($_0xb993) ? (array) $_0xb993 : (is_array($_0xb993) ? $_0xb993 : []);
 $_0x76c1 = [];
 $_0x6606 = [];
 $_0x202f = [];
 $_0x8992 = isset($_0xd955["\x6a\141\x77\141\x62\141\x6e"]) ? (array) $_0xd955["\x6a\141\x77\141\x62\141\x6e"] : [];
 if (empty($_0x8992) && !empty($_0xbcdb->opsi_a)) {
 $_0x41dc = $_0xbcdb->opsi_a;
 if (is_string($_0x41dc)) {
 $_0x513f = $this->maybe_unserialize($_0x41dc);
 $_0x41dc = is_string($_0x513f) ? json_decode($_0x513f, true) ?? $_0x513f : $_0x513f;
 }
 if (is_object($_0x41dc)) {
 $_0x41dc = (array) $_0x41dc;
 }
 if (is_array($_0x41dc) && isset($_0x41dc["\x6a\141\x77\141\x62\141\x6e"])) {
 $_0x8992 = (array) $_0x41dc["\x6a\141\x77\141\x62\141\x6e"];
 $_0xd955 = $_0x41dc;
 } elseif (is_array($_0x41dc)) {
 $_0x8992 = $_0x41dc;
 }
 }
 if (!empty($_0x8992)) {
 $_0x8992 = array_values($_0x8992);
 foreach ($_0x8992 as $_0xf7c7 => $_0x1d35) {
 $_0xdb62 = array_values((array) $_0x1d35);
 $_0x8992[$_0xf7c7] = $_0xdb62;
 if (isset($_0xdb62[0])) {
 $_0x5d26 = (string) $_0xdb62[0];
 $_0x76c1[$_0x5d26] = count(array_filter(array_slice($_0xdb62, 1)));
 }
 }
 }
 $_0xfe88 = is_object($_0xdd91) ? $_0xdd91->jawaban_siswa ?? null : $_0xdd91["\x6a\141\x77\141\x62\141\x6e\137\x73\151\x73\167\x61"] ?? null;
 $_0xc45f = $_0xfe88 !== null && $_0xfe88 !== '' && $_0xfe88 !== "\x5b\135" && $_0xfe88 !== [];
 $_0x2cdb = $_0xc45f ? $_0xfe88 : $_0xbcdb->jawaban ?? null;
 if (is_string($_0x2cdb)) {
 $_0x2cdb = json_decode($_0x2cdb, true) ?: $_0x2cdb;
 }
 if (is_object($_0x2cdb)) {
 $_0x2cdb = (array) $_0x2cdb;
 }
 $_0x70a6 = null;
 if (is_array($_0x2cdb)) {
 if (isset($_0x2cdb["\x6a\141\x77\141\x62\141\x6e"])) {
 $_0x70a6 = (array) $_0x2cdb["\x6a\141\x77\141\x62\141\x6e"];
 } else {
 $_0x70a6 = $_0x2cdb;
 }
 }
 if (!empty($_0x70a6)) {
 $_0x70a6 = array_values($_0x70a6);
 foreach ($_0x70a6 as $_0x5d26 => $_0x3916) {
 $_0x3916 = array_values((array) $_0x3916);
 if ($_0x5d26 == 0) {
 $_0x6606 = $_0x3916;
 } else if ($_0xc45f) {
 $_0x202f[] = $_0x3916;
 } else {
 $_0xb817 = [isset($_0x3916[0]) ? $_0x3916[0] : ''];
 $_0x51e9 = count($_0x3916);
 for ($_0x4886 = 1; $_0x4886 < $_0x51e9; $_0x4886++) {
 $_0xb817[] = '';
 }
 $_0x202f[] = $_0xb817;
 }
 }
 }
 $_0x80ac = is_array($_0xd955) ? $_0xd955["\x6d\157\x64\145\x6c"] ?? "\x32" : "\x32";
 $_0x5117 = is_array($_0xd955) ? $_0xd955["\x74\171\x70\145"] ?? null : null;
 $_0xfb60 = ["\x74\141\x62\145\x6c" => array_values($_0x8992), "\x74\150\x65\141\x64" => array_values($_0x6606), "\x74\142\x6f\144\x79" => array_values($_0x202f), "\x6d\157\x64\145\x6c" => (string) $_0x80ac, "\x74\171\x70\145" => $_0x5117];
 break;
 }
 }
 $_0xa0c5 .= "\x3c\57\x64\151\x76\76";
 $_0xab2c["\x73\157\x61\154\x5f\155\x6f\144\x61\154"] = $_0xa0c5;
 $_0x4679 = ["\x73\164\x61\164\x75\163" => $_0xb6f8->status ?? '', "\x6d\165\x6c\141\x69" => $_0xb6f8->mulai ?? '', "\x73\145\x6c\145\x73\141\x69" => $_0xb6f8->selesai ?? '', "\x6c\141\x6d\141\x5f\165\x6a\151\x61\156" => $_0xb6f8->lama_ujian ?? '', "\x72\145\x73\145\x74\137\x69\172\x69\156" => $_0xb6f8->reset_izin ?? '', "\x72\145\x73\145\x74\137\x77\141\x6b\164\x75" => $_0xb6f8->reset_waktu ?? ''];
 $_0xab2c["\x6d\145\x64\151\x61"] = $_0xdd91->media ?? [];
 $_0xab2c["\x64\165\x72\141\x73\151"] = $_0x4679;
 $_0xab2c["\x74\151\x6d\145\x72"] = $_0x3088;
 $_0xab2c["\x73\157\x61\154\x5f\151\x64"] = $_0xbcdb->id_soal ?? 0;
 $_0xab2c["\x73\157\x61\154\x5f\163\x69\163\x77\141\x5f\151\x64"] = $_0xb6f8->id_cbt_siswa;
 $_0xab2c["\x73\157\x61\154\x5f\156\x6f\155\x6f\162"] = $_0xdd91->no_soal_alias ?? 1;
 $_0xab2c["\x73\157\x61\154\x5f\156\x6f\155\x6f\162\x5f\141\x73\154\x69"] = $_0xbcdb->nomor_soal ?? 1;
 $_0xab2c["\x73\157\x61\154\x5f\152\x65\156\x69\163"] = $_0xbcdb->jenis ?? "\x31";
 $_0xab2c["\x73\157\x61\154\x5f\151\x73\137\x68\157\x74\163"] = (int) ($_0xbcdb->is_hots ?? 0);
 $_0xab2c["\x73\157\x61\154\x5f\163\x6f\141\x6c"] = $_0xbcdb->soal ?? '';
 $_0xab2c["\x73\157\x61\154\x5f\157\x70\163\x69"] = $_0xfb60;
 $_0xab2c["\x73\157\x61\154\x5f\152\x61\167\x61\142\x61\156\x5f\163\x69\163\x77\141"] = $_0xdd91->jawaban_siswa ?? '';
 $_0xab2c["\x6d\141\x78\137\x6a\141\x77\141\x62\141\x6e"] = $_0x76c1;
 $_0xb6a7 = !empty($_0xb6f8->jawaban) && is_array($_0xb6f8->jawaban) ? count($_0xb6f8->jawaban) : count($_0x5652);
 $_0xab2c["\x73\157\x61\154\x5f\164\x6f\164\x61\154"] = $_0xb6a7;
 $_0xab2c["\x73\157\x61\154\x5f\164\x65\162\x6a\141\x77\141\x62"] = count($_0x3b75);
 $_0xab2c["\x6a\141\x72\141\x6b"] = $_0x676f->jarak ?? 0;
 $_0xab2c["\x73\165\x63\143\x65\163\x73"] = true;
 $_0xab2c["\x61\160\x70\162\x6f\166\x65\144"] = true;
 $_0xab2c["\x65\170\x70\151\x72\145\x64"] = false;
 $_0xab2c["\x69\156\x74\145\x72\166\x61\154"] = $_0x29bd;
 $_0xab2c["\x6c\157\x67"] = $_0xb6f8->log;
 $_0xab2c["\x6a\141\x64\167\x61\154"] = $_0x676f;
 return $this->response->setJSON($_0xab2c);
 } catch (\Throwable $_0x6415) {
 log_message("\x65\162\x72\157\x72", "\x6c\157\x61\144\x4e\157\x6d\157\x72\123\x6f\141\x6c\40\x45\170\x63\145\x70\164\x69\157\x6e\72\x20" . $_0x6415->getMessage() . "\x20\151\x6e\40" . $_0x6415->getFile() . "\x3a" . $_0x6415->getLine());
 return $this->output_json(["\x61\160\x70\162\x6f\166\x65\144" => false, "\x73\165\x63\143\x65\163\x73" => false, "\x6d\145\x73\163\x61\147\x65" => "\x47\141\x67\141\x6c\40\x6d\145\x6d\165\x61\164\x20\163\x6f\141\x6c\72\x20" . $_0x6415->getMessage(), "\x65\162\x72\157\x72" => $_0x6415->getMessage()]);
 }
 }
 private function checkExambroLock($_0x8b11)
 {
 goto L_28bac;
 L_bf12f:
 $_0x77b5 = false;
 goto L_bc460;
 L_76ee6:
 $_0x9b13 = null;
 goto L_af294;
 L_a21fb:
 $_0xc2c8 = \Config\Database::connect();
 goto L_76ee6;
 L_23928:
 $_0x2279 = trim($_0x9b13->link_android ?? '');
 goto L_81312;
 L_fcc2d:
 $_0xb2d8 = strtolower($_0xae96);
 goto L_91d36;
 L_7ef4e:
 $_0x7ae9 = false;
 goto L_a8978;
 L_bc460:
 foreach ($_0xceeb as $_0xc23e) {
 if ($_0xc23e !== '' && str_contains($_0xb2d8, $_0xc23e)) {
 $_0x77b5 = true;
 break;
 }
 }
 goto L_7ef4e;
 L_ee0e3:
 $_0x2273 = false;
 goto L_87cba;
 L_28bac:
 $_0x71d0 = (int) ($_0x8b11->lock_browser ?? 0);
 goto L_b6820;
 L_87cba:
 $_0x6fd1 = '';
 goto L_4cfbd;
 L_aa09d:
 $_0xae96 = (string) ($this->request->getUserAgent() ?? $this->request->getServer("\x48\124\x54\120\x5f\125\x53\105\x52\137\x41\107\x45\116\x54") ?? '');
 goto L_fcc2d;
 L_a8978:
 foreach ($_0xcb0e as $_0xc23e) {
 if ($_0xc23e !== '' && str_contains($_0xb2d8, $_0xc23e)) {
 $_0x7ae9 = true;
 break;
 }
 }
 goto L_ee0e3;
 L_af294:
 if ($_0xc2c8->tableExists("\x63\142\x74\137\x65\170\x61\155\x62\162\x6f\137\x73\145\x74\164\x69\156\x67")) {
 $_0x9b13 = $_0xc2c8->table("\x63\142\x74\137\x65\170\x61\155\x62\162\x6f\137\x73\145\x74\164\x69\156\x67")->where("\x69\144", 1)->get()->getRow();
 }
 goto L_2b3ab;
 L_4cfbd:
 if ($_0x71d0 === 1) {
 $_0x6fd1 = "\x57\141\x6a\151\x62\40\x45\170\x61\155\x62\162\x6f\40\x52\145\x73\155\x69\40\x28\101\x6e\144\x72\157\x69\144\x20\141\x74\141\x75\40\x50\103\x29";
 $_0x2273 = $_0x77b5 || $_0x7ae9;
 } elseif ($_0x71d0 === 2) {
 $_0x6fd1 = "\x48\141\x6e\171\x61\40\x45\170\x61\155\x62\162\x6f\40\x41\156\x64\162\x6f\151\x64";
 $_0x2273 = $_0x77b5;
 } elseif ($_0x71d0 === 3) {
 $_0x6fd1 = "\x48\141\x6e\171\x61\40\x45\170\x61\155\x62\162\x6f\40\x50\103\x20\50\x53\105\x42\40\x2f\40\x53\141\x66\145\x20\105\x78\141\x6d\40\x42\162\x6f\167\x73\145\x72\51";
 $_0x2273 = $_0x7ae9;
 }
 goto L_23928;
 L_81312:
 if (empty($_0x2279) || $_0x2279 === "\x23") {
 try {
 if ($_0xc2c8->tableExists("\x63\142\x74\137\x62\141\x6e\156\x65\162")) {
 $_0x6c38 = $_0xc2c8->table("\x63\142\x74\137\x62\141\x6e\156\x65\162")->where("\x73\164\x61\164\x75\163", 1)->groupStart()->like("\x75\162\x6c\137\x6c\151\x6e\153", "\x2e\141\x70\153")->orLike("\x6a\165\x64\165\x6c", "\x61\160\x6b")->orLike("\x6a\165\x64\165\x6c", "\x61\156\x64\162\x6f\151\x64")->groupEnd()->orderBy("\x75\162\x75\164\x61\156", "\x41\123\x43")->get()->getRow();
 if ($_0x6c38 && !empty($_0x6c38->url_link) && $_0x6c38->url_link !== "\x23") {
 $_0x2279 = filter_var($_0x6c38->url_link, FILTER_VALIDATE_URL) ? $_0x6c38->url_link : base_url($_0x6c38->url_link);
 }
 }
 } catch (\Throwable $_0xfdfb) {
 }
 }
 goto L_5698e;
 L_b6820:
 if ($_0x71d0 === 0) {
 return ["\x61\154\x6c\157\x77\145\x64" => true, "\x6d\157\x64\145" => 0, "\x72\165\x6c\145\x5f\156\x61\155\x65" => "\x42\145\x62\141\x73\40\x28\123\x65\155\x75\141\x20\102\x72\157\x77\163\x65\162\x29", "\x70\145\x73\141\x6e\137\x62\154\x6f\153\x69\162" => '', "\x6c\151\x6e\153\x5f\141\x6e\144\x72\157\x69\144" => '', "\x6c\151\x6e\153\x5f\160\x63" => '', "\x75\163\x65\162\x5f\141\x67\145\x6e\164" => ''];
 }
 goto L_a21fb;
 L_2b3ab:
 if (!$_0x9b13) {
 $_0x9b13 = (object) ["\x61\147\x65\156\x74\137\x61\156\x64\162\x6f\151\x64" => "\x4c\155\x73\105\x78\141\x6d\101\x70\160\x2c\116\x65\170\x74\147\x65\156\x4c\155\x73\101\x70\160\x2c\105\x78\141\x6d\142\x72\157\x41\156\x64\162\x6f\151\x64\54\x45\170\x61\155\x62\162\x6f\54\x46\154\x79\105\x78\141\x6d\54\x43\141\x6e\144\x79", "\x61\147\x65\156\x74\137\x70\143" => "\x53\105\x42\54\x53\141\x66\145\x45\170\x61\155\x42\162\x6f\167\x73\145\x72\54\x45\170\x61\155\x62\162\x6f\120\x43", "\x6c\151\x6e\153\x5f\141\x6e\144\x72\157\x69\144" => "\x68\164\x74\160\x73\72\x2f\57\x70\154\x61\171\x2e\147\x6f\157\x67\154\x65\56\x63\157\x6d\57\x73\164\x6f\162\x65\57\x61\160\x70\163\x2f\144\x65\164\x61\151\x6c\163\x3f\151\x64\75\x63\157\x6d\56\x65\170\x61\155\x62\162\x6f\56\x61\160\x70", "\x6c\151\x6e\153\x5f\160\x63" => "\x68\164\x74\160\x73\72\x2f\57\x73\141\x66\145\x65\170\x61\155\x62\162\x6f\167\x73\145\x72\56\x6f\162\x67\57\x64\157\x77\156\x6c\157\x61\144\x5f\145\x6e\56\x68\164\x6d\154", "\x70\145\x73\141\x6e\137\x62\154\x6f\153\x69\162" => "\x55\152\x69\141\x6e\40\x69\156\x69\40\x64\151\x6b\165\x6e\143\x69\40\x64\141\x6e\40\x48\101\x4e\131\x41\40\x44\101\x50\101\x54\40\x44\111\x41\113\x53\105\x53\40\x6d\145\x6c\141\x6c\165\x69\40\x61\160\x6c\151\x6b\141\x73\151\x20\105\x78\141\x6d\142\x72\157\x20\162\x65\163\x6d\151\x2e\40\x53\151\x6c\141\x6b\141\x6e\40\x62\165\x6b\141\x20\141\x74\141\x75\40\x75\156\x64\165\x68\40\x61\160\x6c\151\x6b\141\x73\151\x20\162\x65\163\x6d\151\x20\144\x69\40\x62\141\x77\141\x68\40\x69\156\x69\40\x75\156\x74\165\x6b\40\x6d\145\x6d\165\x6c\141\x69\40\x75\152\x69\141\x6e\56"];
 }
 goto L_aa09d;
 L_5698e:
 if (empty($_0x2279)) {
 $_0x2279 = "\x23";
 }
 goto L_60d45;
 L_91d36:
 $_0xceeb = array_filter(array_map("\x74\162\x69\155", explode("\x2c", strtolower($_0x9b13->agent_android ?? "\x65\170\x61\155\x62\162\x6f"))));
 goto L_5156e;
 L_60d45:
 return ["\x61\154\x6c\157\x77\145\x64" => $_0x2273, "\x6d\157\x64\145" => $_0x71d0, "\x72\165\x6c\145\x5f\156\x61\155\x65" => $_0x6fd1, "\x69\163\x5f\141\x6e\144\x72\157\x69\144" => $_0x77b5, "\x69\163\x5f\160\x63" => $_0x7ae9, "\x75\163\x65\162\x5f\141\x67\145\x6e\164" => $_0xae96, "\x70\145\x73\141\x6e\137\x62\154\x6f\153\x69\162" => $_0x9b13->pesan_blokir ?? "\x55\152\x69\141\x6e\40\x69\156\x69\40\x68\141\x6e\171\x61\40\x64\141\x70\141\x74\40\x64\151\x6b\145\x72\152\x61\153\x61\156\x20\155\x65\154\x61\154\x75\151\x20\141\x70\154\x69\153\x61\163\x69\40\x45\170\x61\155\x62\162\x6f\40\x72\145\x73\155\x69\56", "\x6c\151\x6e\153\x5f\141\x6e\144\x72\157\x69\144" => $_0x2279, "\x6c\151\x6e\153\x5f\160\x63" => $_0x9b13->link_pc ?? "\x23"];
 L_5156e:
 $_0xcb0e = array_filter(array_map("\x74\162\x69\155", explode("\x2c", strtolower($_0x9b13->agent_pc ?? "\x73\145\x62"))));
 goto L_bf12f;
 }
 private function isDeviceSupported()
 {
 goto L_16fe8;
 L_c76bf:
 return ["\x73\164\x61\164\x75\163" => $_0x818c, "\x61\147\x65\156\x74" => $_0x1375->isBrowser() ? $_0x1375->getBrowser() . "\x20" . $_0x1375->getVersion() : ($_0x1375->isMobile() ? $_0x1375->getMobile() : "\x75\156\x6b\156\x6f\167\x6e"), "\x64\145\x76\151\x63\145" => $_0x1375->getPlatform(), "\x61\144\x64\162\x65\163\x73" => $this->request->getIPAddress()];
 L_16fe8:
 $_0x1375 = $this->request->getUserAgent();
 goto L_c8124;
 L_c8124:
 $_0x818c = $_0x1375->isBrowser() || $_0x1375->isMobile();
 goto L_c76bf;
 }
 private function isSiswaDiizinkan($_0x783c, $_0xd71a, $_0xcc89, $_0x9097, $_0x8b41)
 {
 goto L_c58cb;
 L_487e9:
 $_0x65d1 = false;
 goto L_2f47d;
 L_c976c:
 if (isset($_0x783c->reset_login) && $_0x783c->reset_login == "\x31") {
 if (isset($_0xd71a->log) && $_0xd71a->log && $_0xd71a->log->address == $_0x9097 && $_0xd71a->log->agent == $_0xcc89 && $_0xd71a->log->device == $_0x8b41) {
 $_0x65d1 = true;
 } elseif ($_0xd71a->reset_izin == "\x31") {
 $_0x65d1 = true;
 $_0x737f = true;
 } else {
 $_0xa2b9 = "\x48\141\x72\165\x73\40\x72\145\x73\145\x74\40\x69\172\x69\156";
 }
 } else {
 $_0x65d1 = true;
 }
 goto L_5aa6b;
 L_5aa6b:
 return ["\x69\172\x69\156\x6b\141\x6e" => $_0x65d1, "\x6d\165\x6c\141\x69\137\x62\141\x72\165" => false, "\x75\160\x64\141\x74\145\x5f\162\x65\163\x65\164\x5f\151\x7a\151\x6e" => $_0x737f, "\x6d\163\x67" => $_0xa2b9];
 L_f913a:
 $_0xa2b9 = '';
 goto L_c976c;
 L_c58cb:
 if (!$_0xd71a) {
 return ["\x69\172\x69\156\x6b\141\x6e" => true, "\x6d\165\x6c\141\x69\137\x62\141\x72\165" => true, "\x6d\163\x67" => "\x6d\165\x6c\141\x69\40\x62\141\x72\165"];
 }
 goto L_487e9;
 L_2f47d:
 $_0x737f = false;
 goto L_f913a;
 }
 private function isWaktuMasihAda($_0xbe6b, $_0x1620)
 {
 goto L_04827;
 L_1e506:
 return ["\x61\144\x61\137\x77\141\x6b\164\x75" => false];
 L_d2804:
 switch ($_0xbe6b->reset_waktu) {
 case "\x30":
 $_0x597d = new \DateTime($_0xbe6b->mulai);
 $_0xaf00 = $_0x597d->diff(new \DateTime());
 $_0x5032 = $_0xaf00->days * 24 * 60 + $_0xaf00->h * 60 + $_0xaf00->i;
 return ["\x61\144\x61\137\x77\141\x6b\164\x75" => $_0x5032 < ($_0x1620->durasi_ujian ?? 120)];
 case "\x31":
 case "\x32":
 case "\x33":
 return ["\x61\144\x61\137\x77\141\x6b\164\x75" => true, "\x72\145\x73\145\x74\137\x74\171\x70\145" => $_0xbe6b->reset_waktu];
 }
 goto L_1e506;
 L_04827:
 if (!$_0xbe6b) {
 return ["\x61\144\x61\137\x77\141\x6b\164\x75" => true];
 }
 goto L_d2804;
 }
 private function inisialisasiJawaban($_0x1cb3, $_0x6891, $_0xf3ef, $_0x871f)
 {
 goto L_8e673;
 L_8e673:
 $_0x66c8 = \Config\Database::connect();
 goto L_4c9cc;
 L_2f413:
 return $_0x4643;
 L_4c9cc:
 if ($_0x871f) {
 (new \App\Models\CbtModel())->saveLog($_0x1cb3->id_siswa, $_0x6891->id_jadwal, 1, "\x4d\145\x6d\165\x6c\141\x69\40\x55\152\x69\141\x6e");
 (new \App\Models\LogModel())->saveLog(1, "\x4d\145\x6d\165\x6c\141\x69\40\x55\152\x69\141\x6e");
 $_0x4643 = $this->createQueueNumber($_0x6891);
 if (count($_0x4643) > 0) {
 $_0x66c8->table("\x63\142\x74\137\x73\151\x73\167\x61")->insert(["\x69\144\x5f\163\x69\163\x77\141" => $_0x1cb3->id_siswa, "\x69\144\x5f\152\x61\144\x77\141\x6c" => $_0x6891->id_jadwal, "\x69\144\x5f\142\x61\156\x6b" => $_0x6891->bank->id_bank, "\x6a\141\x77\141\x62\141\x6e" => json_encode($_0x4643), "\x6e\151\x6c\141\x69" => "\x5b\135", "\x6e\151\x6c\141\x69\137\x69\156\x70\165\x74" => "\x7b\175", "\x72\145\x73\145\x74\137\x77\141\x6b\164\x75" => "\x30", "\x72\145\x73\145\x74\137\x69\172\x69\156" => "\x30", "\x73\164\x61\164\x75\163" => "\x31", "\x6d\165\x6c\141\x69" => date("\x59\55\x6d\55\x64\40\x48\72\x69\72\x73"), "\x6c\141\x6d\141\x5f\165\x6a\151\x61\156" => "\x30\60\x3a\60\x30\72\x30\60"]);
 }
 } else {
 $_0x4643 = json_decode($_0xf3ef->jawaban, true);
 if (empty($_0x4643)) {
 $_0x4643 = $this->createQueueNumber($_0x6891);
 $_0x66c8->table("\x63\142\x74\137\x73\151\x73\167\x61")->set("\x6a\141\x77\141\x62\141\x6e", json_encode($_0x4643))->where("\x69\144\x5f\143\x62\164\x5f\163\x69\163\x77\141", $_0xf3ef->id_cbt_siswa)->update();
 } else {
 // Jika siswa belum menjawab satu pun soal dan belum selesai,
 // cek apakah queue perlu di-refresh mengikuti setting acak_soal / acak_opsi jadwal terbaru
 $_0xf5d9 = false;
 foreach ($_0x4643 as $_0x6aa6) {
 if (isset($_0x6aa6["\x6a\141\x77\141\x62\141\x6e\137\x73\151\x73\167\x61"]) && $_0x6aa6["\x6a\141\x77\141\x62\141\x6e\137\x73\151\x73\167\x61"] !== null && $_0x6aa6["\x6a\141\x77\141\x62\141\x6e\137\x73\151\x73\167\x61"] !== '' && $_0x6aa6["\x6a\141\x77\141\x62\141\x6e\137\x73\151\x73\167\x61"] !== "\x5b\135") {
 $_0xf5d9 = true;
 break;
 }
 }
 if (!$_0xf5d9 && ($_0xf3ef->status == "\x31" || empty($_0xf3ef->selesai))) {
 $_0xd0f4 = array_column($_0x6891->bank->soal ?? [], "\x69\144\x5f\163\x6f\141\x6c");
 $_0xf636 = array_column($_0x4643, "\x69\144\x5f\163\x6f\141\x6c");
 $_0x91ae = false;
 // SINKRONISASI OTOMATIS: Jika butir soal di bank telah diubah/diimpor ulang atau jumlahnya berbeda
 $_0x3b27 = $_0xd0f4;
 $_0xebf1 = $_0xf636;
 sort($_0x3b27);
 sort($_0xebf1);
 if ($_0x3b27 !== $_0xebf1 || count($_0xd0f4) !== count($_0xf636)) {
 $_0x91ae = true;
 }
 if (($_0x6891->acak_soal == "\x31" || $_0x6891->acak_soal === 1) && count($_0xd0f4) > 1 && $_0xd0f4 === $_0xf636) {
 $_0x91ae = true;
 }
 if (($_0x6891->acak_opsi == "\x31" || $_0x6891->acak_opsi === 1) && isset($_0x4643[0]["\x6f\160\x73\151\x5f\141\x6c\151\x61\163\x5f\141"]) && $_0x4643[0]["\x6f\160\x73\151\x5f\141\x6c\151\x61\163\x5f\141"] === "\x41" && isset($_0x4643[0]["\x6f\160\x73\151\x5f\141\x6c\151\x61\163\x5f\142"]) && $_0x4643[0]["\x6f\160\x73\151\x5f\141\x6c\151\x61\163\x5f\142"] === "\x42") {
 $_0x91ae = true;
 }
 if ($_0x91ae) {
 $_0x89be = $this->createQueueNumber($_0x6891);
 if (!empty($_0x89be)) {
 $_0x4643 = $_0x89be;
 $_0x66c8->table("\x63\142\x74\137\x73\151\x73\167\x61")->set("\x6a\141\x77\141\x62\141\x6e", json_encode($_0x4643))->where("\x69\144\x5f\143\x62\164\x5f\163\x69\163\x77\141", $_0xf3ef->id_cbt_siswa)->update();
 }
 }
 }
 }
 }
 goto L_2f413;
 }
 private function handleResetLogin($_0x4fa9, $_0xd3c8, $_0x810d, $_0x567a, $_0x9032, $_0x419a)
 {
 goto L_441c7;
 L_441c7:
 $_0x9f06 = \Config\Database::connect();
 goto L_e2553;
 L_a065f:
 if ($_0x4708) {
 $_0x4708->log = $_0x9f06->table("\x6c\157\x67\137\x75\152\x69\141\x6e")->where(["\x69\144\x5f\152\x61\144\x77\141\x6c" => $_0x9032, "\x69\144\x5f\163\x69\163\x77\141" => $_0x419a->id_siswa, "\x6c\157\x67\137\x74\171\x70\145" => "\x31"])->get()->getRow();
 }
 goto L_6172f;
 L_6172f:
 return $_0x4708;
 L_e6d43:
 $_0x4708 = $_0x9f06->table("\x63\142\x74\137\x73\151\x73\167\x61")->select("\x69\144\x5f\142\x61\156\x6b\54\x69\144\x5f\143\x62\164\x5f\163\x69\163\x77\141\x2c\151\x64\137\x6a\141\x64\167\x61\154\x2c\151\x64\137\x73\151\x73\167\x61\54\x6c\141\x6d\141\x5f\165\x6a\151\x61\156\x2c\155\x75\154\x61\151\x2c\162\x65\163\x65\164\x5f\151\x7a\151\x6e\54\x72\145\x73\145\x74\137\x77\141\x6b\164\x75\54\x73\145\x6c\145\x73\141\x69\54\x73\164\x61\164\x75\163")->where(["\x69\144\x5f\152\x61\144\x77\141\x6c" => $_0x9032, "\x69\144\x5f\163\x69\163\x77\141" => $_0x419a->id_siswa])->get()->getRow();
 goto L_a065f;
 L_b082c:
 $_0x9f06->table("\x63\142\x74\137\x73\151\x73\167\x61")->set("\x72\145\x73\145\x74\137\x69\172\x69\156", "\x30")->where("\x69\144\x5f\143\x62\164\x5f\163\x69\163\x77\141", $_0x4fa9->id_cbt_siswa)->update();
 goto L_e6d43;
 L_e2553:
 if (isset($_0x4fa9->log->id_log)) {
 $_0x9f06->table("\x6c\157\x67\137\x75\152\x69\141\x6e")->set("\x61\144\x64\162\x65\163\x73", $_0xd3c8)->set("\x61\147\x65\156\x74", $_0x810d)->set("\x64\145\x76\151\x63\145", $_0x567a)->where("\x69\144\x5f\154\x6f\147", $_0x4fa9->log->id_log)->update();
 }
 goto L_b082c;
 }
 private function handleResetWaktu($_0xc1d9, $_0xeec0)
 {
 $_0x54fe = \Config\Database::connect();
 switch ($_0xeec0) {
 case "\x31":
 case "\x33":
 $_0x54fe->table("\x63\142\x74\137\x73\151\x73\167\x61")->set(["\x6c\141\x6d\141\x5f\165\x6a\151\x61\156" => "\x30\60\x3a\60\x30\72\x30\60", "\x6d\165\x6c\141\x69" => date("\x59\55\x6d\55\x64\40\x48\72\x69\72\x73"), "\x72\145\x73\145\x74\137\x77\141\x6b\164\x75" => 0])->where("\x69\144\x5f\143\x62\164\x5f\163\x69\163\x77\141", $_0xc1d9->id_cbt_siswa)->update();
 break;
 case "\x32":
 $_0xcc59 = explode("\x3a", $_0xc1d9->lama_ujian ?? "\x30\60\x3a\60\x30\72\x30\60");
 $_0xca66 = new \DateTime();
 $_0x64af = (int) ($_0xcc59[0] ?? 0);
 $_0x3546 = (int) ($_0xcc59[1] ?? 0);
 $_0x9d91 = (int) ($_0xcc59[2] ?? 0);
 $_0xca66->sub(new \DateInterval("\x50\124" . $_0x64af . "\x48" . $_0x3546 . "\x4d" . $_0x9d91 . "\x53"));
 $_0x54fe->table("\x63\142\x74\137\x73\151\x73\167\x61")->set(["\x6d\165\x6c\141\x69" => $_0xca66->format("\x59\55\x6d\55\x64\40\x48\72\x69\72\x73"), "\x72\145\x73\145\x74\137\x77\141\x6b\164\x75" => 0])->where("\x69\144\x5f\143\x62\164\x5f\163\x69\163\x77\141", $_0xc1d9->id_cbt_siswa)->update();
 break;
 }
 }
 public function saveJawaban()
 {
 try {
 $_0xb42b = \Config\Database::connect();
 $_0x5493 = $this->request->getPost("\x62\141\x6e\153");
 if (empty($_0x5493)) {
 $_0x5493 = session()->get("\x69\144\x5f\142\x61\156\x6b");
 }
 $_0xd716 = $this->request->getPost("\x77\141\x6b\164\x75") ?? $this->request->getPost("\x74\151\x6d\145\x72");
 $_0x1afa = $this->request->getPost("\x73\151\x73\167\x61");
 if (empty($_0x1afa)) {
 $_0x1afa = session()->get("\x69\144\x5f\163\x69\163\x77\141") ?? session()->get("\x69\144\x5f\165\x73\145\x72") ?? session()->get("\x75\163\x65\162\x5f\151\x64");
 }
 $_0xa569 = $this->request->getPost("\x6a\141\x64\167\x61\154");
 if (empty($_0xa569)) {
 $_0xa569 = session()->get("\x69\144\x5f\152\x61\144\x77\141\x6c");
 }
 $_0x742b = $this->request->getPost("\x65\154\x61\160\x73\145\x64");
 if (session_status() === PHP_SESSION_ACTIVE) {
 session_write_close();
 }
 $_0x5f43 = $this->request->getPost("\x64\141\x74\141");
 if (is_string($_0x5f43)) {
 $_0x372a = json_decode($_0x5f43, true);
 if (is_array($_0x372a)) {
 $_0x5f43 = $_0x372a;
 }
 }
 $_0x31a1 = $_0xb42b->table("\x63\142\x74\137\x73\151\x73\167\x61")->select("\x69\144\x5f\142\x61\156\x6b\54\x69\144\x5f\143\x62\164\x5f\163\x69\163\x77\141\x2c\151\x64\137\x6a\141\x64\167\x61\154\x2c\151\x64\137\x73\151\x73\167\x61\54\x6a\141\x77\141\x62\141\x6e\54\x6c\141\x6d\141\x5f\165\x6a\151\x61\156\x2c\155\x75\154\x61\151\x2c\163\x65\154\x65\163\x61\151\x2c\163\x74\141\x74\165\x73")->where(["\x69\144\x5f\152\x61\144\x77\141\x6c" => $_0xa569, "\x69\144\x5f\163\x69\163\x77\141" => $_0x1afa])->get()->getRow();
 if (!$_0x31a1 && !empty($_0xa569) && !empty($_0x1afa)) {
 $_0x31a1 = $_0xb42b->table("\x63\142\x74\137\x73\151\x73\167\x61")->select("\x69\144\x5f\142\x61\156\x6b\54\x69\144\x5f\143\x62\164\x5f\163\x69\163\x77\141\x2c\151\x64\137\x6a\141\x64\167\x61\154\x2c\151\x64\137\x73\151\x73\167\x61\54\x6a\141\x77\141\x62\141\x6e\54\x6c\141\x6d\141\x5f\165\x6a\151\x61\156\x2c\155\x75\154\x61\151\x2c\163\x65\154\x65\163\x61\151\x2c\163\x74\141\x74\165\x73")->where("\x69\144\x5f\152\x61\144\x77\141\x6c", (int) $_0xa569)->where("\x69\144\x5f\163\x69\163\x77\141", (int) $_0x1afa)->get()->getRow();
 }
 if ($_0x31a1 && isset($_0x5f43["\x69\144\x5f\163\x6f\141\x6c"])) {
 $_0x9684 = $_0x5f43["\x69\144\x5f\163\x6f\141\x6c"];
 $_0x8570 = $_0x31a1->jawaban;
 if (is_string($_0x8570)) {
 $_0x8071 = json_decode($_0x8570);
 $_0x31a1->jawaban = is_array($_0x8071) ? $_0x8071 : [];
 } elseif (!is_array($_0x8570)) {
 $_0x31a1->jawaban = [];
 }
 $_0x8574 = false;
 foreach ($_0x31a1->jawaban as $_0x837d => $_0xfbdb) {
 $_0x4515 = is_object($_0xfbdb) ? $_0xfbdb->id_soal ?? null : $_0xfbdb["\x69\144\x5f\163\x6f\141\x6c"] ?? null;
 if ($_0x4515 !== null && (string) $_0x4515 === (string) $_0x9684) {
 $_0x8574 = $_0x837d;
 break;
 }
 }
 if ($_0x8574 !== false) {
 $_0xbc4b = $_0x31a1->jawaban[$_0x8574];
 if (!is_object($_0xbc4b)) {
 $_0xbc4b = (object) $_0xbc4b;
 }
 if (isset($_0x5f43["\x6a\145\x6e\151\x73"])) {
 if ($_0x5f43["\x6a\145\x6e\151\x73"] == 1) {
 $_0xbc4b->jawaban_siswa = $_0x5f43["\x6a\141\x77\141\x62\141\x6e\137\x73\151\x73\167\x61"] ?? '';
 $_0xbc4b->jawaban_alias = $_0x5f43["\x6a\141\x77\141\x62\141\x6e\137\x61\154\x69\141\x73"] ?? '';
 } elseif ($_0x5f43["\x6a\145\x6e\151\x73"] == 2) {
 $_0xa5eb = $_0x5f43["\x6a\141\x77\141\x62\141\x6e\137\x73\151\x73\167\x61"] ?? "\x5b\135";
 if (is_string($_0xa5eb)) {
 $_0x8071 = json_decode($_0xa5eb, true);
 $_0xbc4b->jawaban_siswa = is_array($_0x8071) ? $_0x8071 : [$_0xa5eb];
 } else {
 $_0xbc4b->jawaban_siswa = (array) $_0xa5eb;
 }
 $_0xbc4b->jawaban_alias = '';
 } elseif ($_0x5f43["\x6a\145\x6e\151\x73"] == 3) {
 $_0xf048 = $_0x5f43["\x6a\141\x77\141\x62\141\x6e\137\x73\151\x73\167\x61"] ?? "\x5b\135";
 if (is_string($_0xf048)) {
 $_0x8358 = json_decode($_0xf048, true);
 $_0xbc4b->jawaban_siswa = $_0x8358 !== null ? $_0x8358 : $_0xf048;
 } else {
 $_0xbc4b->jawaban_siswa = $_0xf048;
 }
 $_0xbc4b->jawaban_alias = '';
 } elseif ($_0x5f43["\x6a\145\x6e\151\x73"] == 4) {
 $_0xdd58 = $_0x5f43["\x6a\141\x77\141\x62\141\x6e\137\x73\151\x73\167\x61"] ?? $this->request->getPost("\x6a\141\x77\141\x62\141\x6e") ?? '';
 $_0xbc4b->jawaban_siswa = $_0xdd58;
 $_0xbc4b->jawaban_alias = '';
 } else {
 $_0xbc4b->jawaban_siswa = $_0x5f43["\x6a\141\x77\141\x62\141\x6e\137\x73\151\x73\167\x61"] ?? '';
 $_0xbc4b->jawaban_alias = '';
 }
 }
 $_0x31a1->jawaban[$_0x8574] = $_0xbc4b;
 $_0xf42a = $_0xb42b->table("\x63\142\x74\137\x73\151\x73\167\x61")->set("\x6a\141\x77\141\x62\141\x6e", json_encode($_0x31a1->jawaban));
 if (!empty($_0x742b) && $_0x742b !== "\x30" && $_0x742b !== "\x30\60\x3a\60\x30\72\x30\60") {
 $_0xf42a->set("\x6c\141\x6d\141\x5f\165\x6a\151\x61\156", $_0x742b);
 }
 $_0x8fac = $_0xf42a->where("\x69\144\x5f\143\x62\164\x5f\163\x69\163\x77\141", $_0x31a1->id_cbt_siswa)->update();
 $_0x6b40["\x73\165\x63\143\x65\163\x73"] = true;
 $_0x7398 = [];
 if (is_array($_0x31a1->jawaban)) {
 foreach ($_0x31a1->jawaban as $_0xb84d) {
 $_0x337d = is_object($_0xb84d) ? $_0xb84d : (object) $_0xb84d;
 $_0xb27d = $_0x337d->jawaban_siswa ?? null;
 if (!empty($_0xb27d) && $_0xb27d !== "\x5b\135" && $_0xb27d !== [] && $_0xb27d !== '') {
 $_0x7398[] = $_0xb84d;
 }
 }
 }
 $_0x6b40["\x73\157\x61\154\x5f\164\x65\162\x6a\141\x77\141\x62"] = count($_0x7398);
 return $this->response->setJSON($_0x6b40);
 }
 }
 return $this->response->setJSON(["\x73\165\x63\143\x65\163\x73" => false, "\x6d\145\x73\163\x61\147\x65" => "\x47\141\x67\141\x6c\40\x6d\145\x6e\171\x69\155\x70\141\x6e\40\x6a\141\x77\141\x62\141\x6e\72\x20\151\x64\40\x73\157\x61\154\x20\164\x69\144\x61\153\x20\166\x61\154\x69\144\x2e"]);
 } catch (\Throwable $_0x4a77) {
 log_message("\x65\162\x72\157\x72", "\x73\141\x76\145\x4a\141\x77\141\x62\141\x6e\40\x45\170\x63\145\x70\164\x69\157\x6e\72\x20" . $_0x4a77->getMessage());
 return $this->response->setJSON(["\x73\165\x63\143\x65\163\x73" => false, "\x6d\145\x73\163\x61\147\x65" => "\x47\141\x67\141\x6c\40\x6d\145\x6e\171\x69\155\x70\141\x6e\40\x6a\141\x77\141\x62\141\x6e\72\x20" . $_0x4a77->getMessage()]);
 }
 }
 public function selesaiUjian()
 {
 goto L_bdbb5;
 L_dec89:
 if (empty($_0xa5c3)) {
 $_0xa5c3 = session()->get("\x69\144\x5f\163\x69\163\x77\141") ?? session()->get("\x69\144\x5f\165\x73\145\x72") ?? session()->get("\x75\163\x65\162\x5f\151\x64");
 }
 goto L_9b897;
 L_211c8:
 $_0x8177 = $_0x8c6d->table("\x63\142\x74\137\x73\151\x73\167\x61")->set("\x73\145\x6c\145\x73\141\x69", date("\x59\55\x6d\55\x64\40\x48\72\x69\72\x73"))->set("\x73\164\x61\164\x75\163", 2)->where("\x69\144\x5f\163\x69\163\x77\141", $_0xa5c3)->where("\x69\144\x5f\152\x61\144\x77\141\x6c", $_0x3610)->update();
 goto L_10419;
 L_b0627:
 $_0x406d["\x68\141\x73\151\x6c\137\x74\141\x6d\160\x69\154"] = $_0x7d22;
 goto L_d5fe7;
 L_73b51:
 $_0x406d["\x73\165\x63\143\x65\163\x73"] = true;
 goto L_8ddce;
 L_fcb43:
 $_0x406d["\x73\164\x61\164\x75\163"] = $_0x8177;
 goto L_73b51;
 L_10419:
 (new \App\Models\CbtModel())->saveLog($_0xa5c3, $_0x3610, 2, "\x4d\145\x6e\171\x65\154\x65\163\x61\151\x6b\141\x6e\40\x55\152\x69\141\x6e");
 goto L_763cd;
 L_bdbb5:
 $_0xa5c3 = $this->request->getPost("\x73\151\x73\167\x61");
 goto L_dec89;
 L_e6b17:
 $_0x7e14 = $_0x1d91->smt_active;
 goto L_5a84c;
 L_d5fe7:
 try {
 $_0x9516 = $this->olah_nilai(2, $_0x2e09->id_tp, $_0x7e14->id_smt, $_0xa5c3, $_0x3610, false);
 if ($_0x9516 && !empty($_0x9516->sesisiswa)) {
 $_0x37fe = $_0x9516->sesisiswa[0]->nilai_akhir ?? null;
 $_0x34c2 = $_0x9516->bank ?? null;
 if ($_0x37fe && $_0x34c2) {
 $_0xa737 = round((float) ($_0x37fe->skor_total ?? $_0x37fe->skor_asli ?? 0), 2);
 $_0x703c = round((float) ($_0x37fe->skor_asli ?? $_0xa737), 2);
 $_0x406d["\x73\153\x6f\162\x5f\164\x6f\164\x61\154"] = $_0xa737;
 $_0x406d["\x73\153\x6f\162\x5f\141\x73\154\x69"] = $_0x703c;
 $_0xcc82 = (int) ($_0x34c2->tampil_pg ?? 0);
 $_0xed3d = (int) ($_0x34c2->tampil_kompleks ?? 0);
 $_0x636d = (int) ($_0x34c2->tampil_jodohkan ?? 0);
 $_0x6d23 = (int) ($_0x34c2->tampil_isian ?? 0);
 $_0xb3a8 = (int) ($_0x34c2->tampil_esai ?? 0);
 $_0xba73 = (int) ($_0x37fe->pg_benar ?? 0);
 $_0xfc40 = round((float) ($_0x37fe->skor_pg["\x73\153\x6f\162\x5f\164\x6f\164\x61\154"] ?? $_0x37fe->pg_nilai ?? 0), 2);
 $_0x5d12 = round((float) ($_0x37fe->skor_kompleks["\x6a\155\x6c\137\x62\145\x6e\141\x72"] ?? 0), 2);
 $_0x1b21 = round((float) ($_0x37fe->skor_kompleks["\x73\153\x6f\162\x5f\164\x6f\164\x61\154"] ?? 0), 2);
 $_0xcd43 = round((float) ($_0x37fe->skor_jodohkan["\x6a\155\x6c\137\x62\145\x6e\141\x72"] ?? 0), 2);
 $_0x4ae7 = round((float) ($_0x37fe->skor_jodohkan["\x73\153\x6f\162\x5f\164\x6f\164\x61\154"] ?? 0), 2);
 $_0x8399 = round((float) ($_0x37fe->skor_isian["\x6a\155\x6c\137\x62\145\x6e\141\x72"] ?? 0), 2);
 $_0xc5aa = round((float) ($_0x37fe->skor_isian["\x73\153\x6f\162\x5f\164\x6f\164\x61\154"] ?? 0), 2);
 $_0x86af = round((float) ($_0x37fe->skor_essai["\x6a\155\x6c\137\x62\145\x6e\141\x72"] ?? 0), 2);
 $_0xc09c = round((float) ($_0x37fe->skor_essai["\x73\153\x6f\162\x5f\164\x6f\164\x61\154"] ?? 0), 2);
 $_0xb462 = $_0xcc82 + $_0xed3d + $_0x636d + $_0x6d23 + $_0xb3a8;
 if ($_0xb462 === 0) {
 $_0xb462 = (int) ($_0x34c2->jml_soal ?? 0);
 }
 $_0x9a44 = round($_0xba73 + $_0x5d12 + $_0xcd43 + $_0x8399 + $_0x86af, 2);
 $_0x88c5 = max(0, round($_0xb462 - $_0x9a44, 2));
 $_0x406d["\x6a\155\x6c\137\x73\157\x61\154"] = $_0xb462;
 $_0x406d["\x74\157\x74\141\x6c\137\x62\145\x6e\141\x72"] = $_0x9a44;
 $_0x406d["\x74\157\x74\141\x6c\137\x73\141\x6c\141\x68"] = $_0x88c5;
 $_0x89d6 = [];
 if ($_0xcc82 > 0) {
 $_0x89d6[] = ["\x6c\141\x62\145\x6c" => "\x50\151\x6c\151\x68\141\x6e\40\x47\141\x6e\144\x61", "\x6b\157\x64\145" => "\x50\107", "\x73\157\x61\154" => $_0xcc82, "\x62\145\x6e\141\x72" => $_0xba73, "\x6e\151\x6c\141\x69" => $_0xfc40];
 }
 if ($_0xed3d > 0) {
 $_0x89d6[] = ["\x6c\141\x62\145\x6c" => "\x50\107\x20\113\x6f\155\x70\154\x65\153\x73", "\x6b\157\x64\145" => "\x50\107\x4b", "\x73\157\x61\154" => $_0xed3d, "\x62\145\x6e\141\x72" => $_0x5d12, "\x6e\151\x6c\141\x69" => $_0x1b21];
 }
 if ($_0x636d > 0) {
 $_0x89d6[] = ["\x6c\141\x62\145\x6c" => "\x4d\145\x6e\152\x6f\144\x6f\150\x6b\141\x6e", "\x6b\157\x64\145" => "\x4a\157\x64\157\x68\153\x61\156", "\x73\157\x61\154" => $_0x636d, "\x62\145\x6e\141\x72" => $_0xcd43, "\x6e\151\x6c\141\x69" => $_0x4ae7];
 }
 if ($_0x6d23 > 0) {
 $_0x89d6[] = ["\x6c\141\x62\145\x6c" => "\x49\163\x69\141\x6e\40\x53\151\x6e\147\x6b\141\x74", "\x6b\157\x64\145" => "\x49\163\x69\141\x6e", "\x73\157\x61\154" => $_0x6d23, "\x62\145\x6e\141\x72" => $_0x8399, "\x6e\151\x6c\141\x69" => $_0xc5aa];
 }
 if ($_0xb3a8 > 0) {
 $_0x89d6[] = ["\x6c\141\x62\145\x6c" => "\x55\162\x61\151\x61\156\x20\57\x20\105\x73\141\x69", "\x6b\157\x64\145" => "\x45\163\x61\151", "\x73\157\x61\154" => $_0xb3a8, "\x62\145\x6e\141\x72" => $_0x86af > 0 ? $_0x86af : "\x2d", "\x6e\151\x6c\141\x69" => $_0xc09c];
 }
 $_0x406d["\x62\162\x65\141\x6b\144\x6f\167\x6e"] = $_0x89d6;
 $_0x406d["\x70\147\x5f\142\x65\156\x61\162"] = $_0xba73;
 $_0x406d["\x70\147\x5f\163\x61\154\x61\150"] = max(0, $_0xcc82 - $_0xba73);
 $_0x406d["\x70\147\x5f\156\x69\154\x61\151"] = $_0xfc40;
 }
 }
 } catch (\Throwable $_0xfa1e) {
 log_message("\x65\162\x72\157\x72", "\x47\141\x67\141\x6c\40\x6f\154\x61\150\x5f\156\x69\154\x61\151\x20\163\x61\141\x74\40\x73\145\x6c\145\x73\141\x69\125\x6a\151\x61\156\x3a\40" . $_0xfa1e->getMessage());
 }
 goto L_13907;
 L_13907:
 return $this->response->setJSON($_0x406d);
 L_8ddce:
 // Hitung & simpan nilai ujian otomatis seketika
 $_0x1d91 = $this->getTpSmt();
 goto L_85e42;
 L_763cd:
 (new \App\Models\LogModel())->saveLog(1, "\x4d\145\x6e\171\x65\154\x65\163\x61\151\x6b\141\x6e\40\x55\152\x69\141\x6e");
 goto L_fcb43;
 L_f9e3a:
 $_0x8c6d = \Config\Database::connect();
 goto L_211c8;
 L_073ab:
 $_0x7d22 = (string) ($_0x59a7->hasil_tampil ?? "\x30");
 goto L_b0627;
 L_6e6bc:
 if (empty($_0x3610)) {
 $_0x3610 = session()->get("\x69\144\x5f\152\x61\144\x77\141\x6c");
 }
 goto L_f9e3a;
 L_5a84c:
 $_0x59a7 = $_0x8c6d->table("\x63\142\x74\137\x6a\141\x64\167\x61\154")->where("\x69\144\x5f\152\x61\144\x77\141\x6c", $_0x3610)->get()->getRow();
 goto L_073ab;
 L_85e42:
 $_0x2e09 = $_0x1d91->tp_active;
 goto L_e6b17;
 L_9b897:
 $_0x3610 = $this->request->getPost("\x6a\141\x64\167\x61\154");
 goto L_6e6bc;
 }
 public function ping_kamera()
 {
 goto L_3852e;
 L_a268b:
 $_0xb70a = \Config\Database::connect();
 goto L_b1709;
 L_3d889:
 try {
 $_0xc712 = $_0xb70a->table("\x63\142\x74\137\x6b\141\x6d\145\x72\141\x5f\163\x74\162\x65\141\x6d")->select("\x73\164\x61\164\x75\163\x2c\40\x75\160\x64\141\x74\145\x64\137\x61\164")->where("\x69\144\x5f\152\x61\144\x77\141\x6c", $_0xb6e5)->where("\x69\144\x5f\163\x69\163\x77\141", $_0xe778)->get()->getRow();
 if ($_0xc712 && in_array($_0xc712->status, ["\x72\145\x71\165\x65\163\x74\145\x64", "\x61\143\x74\151\x76\145"])) {
 $_0x9640 = time() - strtotime($_0xc712->updated_at ?? "\x32\60\x30\60\x2d\60\x31\55\x30\61");
 if ($_0x9640 <= 45) {
 return $this->response->setJSON(["\x61\143\x74\151\x76\145" => true, "\x73\164\x61\164\x75\163" => $_0xc712->status]);
 }
 }
 } catch (\Throwable $_0x91c5) {
 }
 goto L_6814f;
 L_13049:
 $_0xd2f5 = session()->get("\x75\163\x65\162\x6e\141\x6d\145");
 goto L_a9df6;
 L_b1709:
 $this->ensureKameraSchema();
 goto L_625a8;
 L_78b6f:
 if (!$_0xe778) {
 return $this->response->setJSON(["\x61\143\x74\151\x76\145" => false]);
 }
 goto L_3d889;
 L_625a8:
 if (!$_0xe778 && $_0xd2f5) {
 $_0x71f2 = $_0xb70a->table("\x6d\141\x73\164\x65\162\x5f\163\x69\163\x77\141")->select("\x69\144\x5f\163\x69\163\x77\141")->where("\x75\163\x65\162\x6e\141\x6d\145", $_0xd2f5)->get()->getRow();
 $_0xe778 = $_0x71f2->id_siswa ?? 0;
 }
 goto L_78b6f;
 L_e301a:
 if (!$_0xb6e5) {
 return $this->response->setJSON(["\x61\143\x74\151\x76\145" => false]);
 }
 goto L_a268b;
 L_6814f:
 return $this->response->setJSON(["\x61\143\x74\151\x76\145" => false]);
 L_a9df6:
 // Immediately close session to prevent blocking other concurrent requests
 if (session_status() === PHP_SESSION_ACTIVE) {
 session_write_close();
 }
 goto L_e301a;
 L_39311:
 $_0xe778 = $this->request->getVar("\x69\144\x5f\163\x69\163\x77\141") ?? session()->get("\x69\144\x5f\163\x69\163\x77\141") ?? session()->get("\x69\144\x5f\165\x73\145\x72") ?? session()->get("\x75\163\x65\162\x5f\151\x64");
 goto L_13049;
 L_3852e:
 $_0xb6e5 = $this->request->getVar("\x69\144\x5f\152\x61\144\x77\141\x6c");
 goto L_39311;
 }
 public function upload_kamera_frame()
 {
 goto L_8b955;
 L_8b955:
 $_0x6188 = $this->request->getPost("\x69\144\x5f\152\x61\144\x77\141\x6c") ?? $this->request->getVar("\x69\144\x5f\152\x61\144\x77\141\x6c");
 goto L_6d44d;
 L_28a74:
 $_0xd02a = $this->request->getPost("\x66\162\x61\155\x65") ?? $this->request->getVar("\x66\162\x61\155\x65");
 goto L_18e7a;
 L_20ec9:
 if (!$_0x6188 || empty($_0xd02a)) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x61\143\x74\151\x76\145" => false]);
 }
 goto L_ff46e;
 L_807ed:
 // Immediately close session to prevent blocking other concurrent requests
 if (session_status() === PHP_SESSION_ACTIVE) {
 session_write_close();
 }
 goto L_20ec9;
 L_01e9c:
 if (!$_0xa91c) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x61\143\x74\151\x76\145" => false]);
 }
 goto L_f7355;
 L_ff46e:
 $_0x100d = \Config\Database::connect();
 goto L_6e104;
 L_767ac:
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => true, "\x61\143\x74\151\x76\145" => $_0x48d9]);
 L_f7355:
 $_0x48d9 = false;
 goto L_6eba5;
 L_6e104:
 $this->ensureKameraSchema();
 goto L_6f667;
 L_6f667:
 if (!$_0xa91c && $_0x7c44) {
 $_0x314d = $_0x100d->table("\x6d\141\x73\164\x65\162\x5f\163\x69\163\x77\141")->select("\x69\144\x5f\163\x69\163\x77\141")->where("\x75\163\x65\162\x6e\141\x6d\145", $_0x7c44)->get()->getRow();
 $_0xa91c = $_0x314d->id_siswa ?? 0;
 }
 goto L_01e9c;
 L_6eba5:
 try {
 $_0x2280 = date("\x59\55\x6d\55\x64\40\x48\72\x69\72\x73");
 $_0x24b5 = $_0x100d->table("\x63\142\x74\137\x6b\141\x6d\145\x72\141\x5f\163\x74\162\x65\141\x6d")->select("\x73\164\x61\164\x75\163\x2c\40\x75\160\x64\141\x74\145\x64\137\x61\164")->where("\x69\144\x5f\152\x61\144\x77\141\x6c", $_0x6188)->where("\x69\144\x5f\163\x69\163\x77\141", $_0xa91c)->get()->getRow();
 if ($_0x24b5) {
 if (in_array($_0x24b5->status, ["\x72\145\x71\165\x65\163\x74\145\x64", "\x61\143\x74\151\x76\145"])) {
 $_0xd6ff = time() - strtotime($_0x24b5->updated_at ?? "\x32\60\x30\60\x2d\60\x31\55\x30\61");
 if ($_0xd6ff <= 45) {
 $_0x48d9 = true;
 }
 }
 // Selalu simpan last_frame terbaru agar saat pengawas membuka modal pantau, gambar langsung tampil seketika
 $_0x100d->table("\x63\142\x74\137\x6b\141\x6d\145\x72\141\x5f\163\x74\162\x65\141\x6d")->where("\x69\144\x5f\152\x61\144\x77\141\x6c", $_0x6188)->where("\x69\144\x5f\163\x69\163\x77\141", $_0xa91c)->update(["\x6c\141\x73\164\x5f\146\x72\141\x6d\145" => $_0xd02a, "\x73\164\x61\164\x75\163" => $_0x48d9 ? "\x61\143\x74\151\x76\145" : "\x73\164\x61\156\x64\142\x79", "\x75\160\x64\141\x74\145\x64\137\x61\164" => $_0x48d9 ? $_0x24b5->updated_at : $_0x2280]);
 } else {
 $_0x100d->table("\x63\142\x74\137\x6b\141\x6d\145\x72\141\x5f\163\x74\162\x65\141\x6d")->insert(["\x69\144\x5f\152\x61\144\x77\141\x6c" => $_0x6188, "\x69\144\x5f\163\x69\163\x77\141" => $_0xa91c, "\x73\164\x61\164\x75\163" => "\x73\164\x61\156\x64\142\x79", "\x6c\141\x73\164\x5f\146\x72\141\x6d\145" => $_0xd02a, "\x75\160\x64\141\x74\145\x64\137\x61\164" => $_0x2280]);
 }
 } catch (\Throwable $_0xc6ba) {
 $_0x48d9 = false;
 }
 goto L_767ac;
 L_18e7a:
 $_0x7c44 = session()->get("\x75\163\x65\162\x6e\141\x6d\145");
 goto L_807ed;
 L_6d44d:
 $_0xa91c = $this->request->getPost("\x69\144\x5f\163\x69\163\x77\141") ?? $this->request->getVar("\x69\144\x5f\163\x69\163\x77\141") ?? session()->get("\x69\144\x5f\163\x69\163\x77\141") ?? session()->get("\x69\144\x5f\165\x73\145\x72") ?? session()->get("\x75\163\x65\162\x5f\151\x64");
 goto L_28a74;
 }
 private function ensureKameraSchema()
 {
 try {
 $_0xe718 = \Config\Database::connect();
 if (!$_0xe718->fieldExists("\x6b\141\x6d\145\x72\141", "\x63\142\x74\137\x6a\141\x64\167\x61\154")) {
 $_0x402b = \Config\Database::forge();
 $_0x402b->addColumn("\x63\142\x74\137\x6a\141\x64\167\x61\154", ["\x6b\141\x6d\145\x72\141" => ["\x74\171\x70\145" => "\x49\116\x54", "\x63\157\x6e\163\x74\162\x61\151\x6e\164" => 11, "\x64\145\x66\141\x75\154\x74" => 0]]);
 }
 if (!$_0xe718->tableExists("\x63\142\x74\137\x6b\141\x6d\145\x72\141\x5f\163\x74\162\x65\141\x6d")) {
 $_0xe718->query("\x43\122\x45\101\x54\105\x20\124\x41\102\x4c\105\x20\111\x46\40\x4e\117\x54\40\x45\130\x49\123\x54\123\x20\143\x62\164\x5f\153\x61\155\x65\162\x61\137\x73\164\x72\145\x61\155\x20\50\xa\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\151\x64\40\x49\116\x54\40\x41\125\x54\117\x5f\111\x4e\103\x52\105\x4d\105\x4e\124\x20\120\x52\111\x4d\101\x52\131\x20\113\x45\131\x2c\12\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x69\144\x5f\152\x61\144\x77\141\x6c\40\x49\116\x54\40\x4e\117\x54\40\x4e\125\x4c\114\x2c\12\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x69\144\x5f\163\x69\163\x77\141\x20\111\x4e\124\x20\116\x4f\124\x20\116\x55\114\x4c\54\xa\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\163\x74\141\x74\165\x73\40\x56\101\x52\103\x48\101\x52\50\x32\60\x29\40\x44\105\x46\101\x55\114\x54\40\x27\163\x74\141\x6e\144\x62\171\x27\54\xa\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\163\x64\160\x5f\157\x66\146\x65\162\x20\114\x4f\116\x47\124\x45\130\x54\40\x4e\125\x4c\114\x2c\12\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x73\144\x70\137\x61\156\x73\167\x65\162\x20\114\x4f\116\x47\124\x45\130\x54\40\x4e\125\x4c\114\x2c\12\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x6c\141\x73\164\x5f\146\x72\141\x6d\145\x20\114\x4f\116\x47\124\x45\130\x54\40\x4e\125\x4c\114\x2c\12\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x75\160\x64\141\x74\145\x64\137\x61\164\x20\104\x41\124\x45\124\x49\115\x45\40\x4e\125\x4c\114\x2c\12\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x55\116\x49\121\x55\105\x20\113\x45\131\x20\165\x6e\151\x71\137\x6a\141\x64\167\x61\154\x5f\163\x69\163\x77\141\x20\50\x69\144\x5f\152\x61\144\x77\141\x6c\54\x20\151\x64\137\x73\151\x73\167\x61\51\xa\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\51\x20\105\x4e\107\x49\116\x45\75\x49\156\x6e\157\x44\102\x20\104\x45\106\x41\125\x4c\124\x20\103\x48\101\x52\123\x45\124\x3d\165\x74\146\x38\155\x62\64");
 }
 } catch (\Throwable $_0x5fb3) {
 }
 }
}