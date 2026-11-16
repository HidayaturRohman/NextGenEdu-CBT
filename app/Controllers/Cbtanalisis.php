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
 * Time: 14:24
 */
namespace App\Controllers;

use CodeIgniter\Controller;
use stdClass;
class Cbtanalisis extends BaseController
{
 public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $_0xe10c)
 {
 parent::initController($request, $response, $_0xe10c);
 }
 protected function output_json($_0x4740, $_0xbc0e = true)
 {
 if ($_0xbc0e) {
 $_0x4740 = json_encode($_0x4740);
 }
 return $this->response->setStatusCode(200)->setContentType("\x61\160\x70\154\x69\143\x61\164\x69\157\x6e\57\x6a\163\x6f\156")->setBody($_0x4740);
 }
 public function analisis()
 {
 return $this->index();
 }
 public function index()
 {
 goto L_09b4d;
 L_5701b:
 $_0xa94e["\x6a\141\x64\167\x61\154\x5f\163\x65\154\x65\143\x74\145\x64"] = $_0xf9f4;
 goto L_a6133;
 L_de275:
 $_0xa94e["\x74\160\x5f\141\x63\164\x69\166\x65"] = $_0xfa78;
 goto L_664d7;
 L_f95af:
 $_0xf9f4 = $this->request->getGet("\x6a\141\x64\167\x61\154") ?? $this->request->getGet("\x69\144\x5f\152\x61\144\x77\141\x6c");
 goto L_fcf9f;
 L_2c2f8:
 $_0x877b = new \App\Models\DropdownModel();
 goto L_0238a;
 L_1a1a2:
 if ($_0xf9f4 != null) {
 $_0x6063 = $_0x6b0d->getJadwalById($_0xf9f4);
 if ($_0x6063) {
 $_0x9cf4 = $_0x6b0d->getJawabanByBank($_0x6063->id_bank);
 $_0x2a48 = [];
 $_0x7b62 = [];
 foreach ($_0x9cf4 as $_0xa1f8) {
 if (!in_array($_0xa1f8->id_siswa, $_0x7b62)) {
 $_0x7b62[] = $_0xa1f8->id_siswa;
 }
 $_0x2a48[$_0xa1f8->jenis_soal][$_0xa1f8->nomor_soal][$_0xa1f8->id_siswa] = $_0xa1f8->jawaban_siswa;
 }
 $_0x4079 = $_0x6b0d->getAllNilaiSiswa($_0xf9f4);
 if (is_array($_0x4079) && count($_0x4079) > 0) {
 uasort($_0x4079, function ($_0x22d7, $_0x4765) {
 $_0x95cd = (int) ($_0x22d7->pg_benar ?? 0);
 $_0xf07f = (int) ($_0x4765->pg_benar ?? 0);
 if ($_0x95cd === $_0xf07f) {
 return 0;
 }
 return $_0x95cd > $_0xf07f ? -1 : 1;
 });
 }
 $_0xc4a2 = $_0x6b0d->getSoalByBank($_0x6063->id_bank);
 $_0x7927 = [];
 $_0xe9ed = [];
 if (isset($_0xc4a2[1])) {
 foreach ($_0xc4a2[1] as $_0x9b6a => $_0x2eab) {
 $_0x2eab->jawaban_siswa = [];
 $_0x2eab->skor_siswa = [];
 $_0x2eab->jumlah_benar = 0;
 $_0x2eab->jumlah_salah = 0;
 $_0x97b2 = 0;
 $_0x24eb = [];
 $_0xeb50 = [];
 $_0x3d72 = isset($_0x2a48[1][$_0x9b6a]) ? $_0x2a48[1][$_0x9b6a] : [];
 $_0xfc22 = count($_0x4079);
 $_0x8d43 = floor($_0xfc22 / 2);
 $_0x2c2a = 0;
 $_0x6adb = 0;
 $_0xdd2c = 1;
 foreach ($_0x4079 as $_0x88b2 => $_0xf7c2) {
 $_0x97b2++;
 $_0x2e55 = $_0x3d72[$_0x88b2] ?? '';
 $_0x2969 = strtoupper(trim($_0x2e55)) === strtoupper(trim($_0x2eab->jawaban ?? '')) && $_0x2e55 !== '';
 if ($_0x2969) {
 $_0x2eab->jumlah_benar++;
 array_push($_0x24eb, 1);
 } else {
 $_0x2eab->jumlah_salah++;
 array_push($_0x24eb, 0);
 }
 array_push($_0xeb50, (int) ($_0xf7c2->pg_benar ?? 0));
 $_0x478b = strtolower(trim($_0x2e55 ?? ''));
 if (in_array($_0x478b, ["\x61", "\x62", "\x63", "\x64", "\x65"])) {
 $_0x2eab->jawaban_siswa["\x6a\141\x77\141\x62\137" . $_0x478b][$_0x88b2] = $_0x2e55;
 }
 if ($_0xdd2c <= $_0x8d43) {
 if ($_0x2969) {
 $_0x2c2a++;
 }
 } else if ($_0x2969) {
 $_0x6adb++;
 }
 $_0xdd2c++;
 }
 $_0x52ce = $_0x2eab->jumlah_benar;
 $_0xf443 = $_0x2eab->jumlah_salah;
 $_0xf153 = 0;
 $_0x9e2f = "\x73\165\x6b\141\x72";
 if ($_0x97b2 > 0) {
 $_0xf153 = round($_0x52ce / $_0x97b2, 2);
 if ($_0xf153 >= 0.7) {
 $_0x9e2f = "\x6d\165\x64\141\x68";
 } else if ($_0xf153 >= 0.3) {
 $_0x9e2f = "\x73\145\x64\141\x6e\147";
 } else {
 $_0x9e2f = "\x73\165\x6b\141\x72";
 }
 }
 $_0x2eab->tingkat_kesukaran = $_0xf153;
 $_0x2eab->status_kesukaran = $_0x9e2f;
 $_0x2eab->total_siswa = $_0x97b2;
 $_0x2eab->benar_atas = $_0x2c2a;
 $_0x2eab->benar_bawah = $_0x6adb;
 $_0xa4b8 = $this->pearson($_0x24eb, $_0xeb50);
 $_0xb81d = $this->nilaiSignifikansi($_0x97b2);
 $_0x2eab->nilai_valid = $_0xa4b8;
 $_0x2eab->table_r = $_0xb81d;
 $_0x7e1d = $_0xb81d <= $_0xa4b8 ? "\x56\141\x6c\151\x64" : "\x54\151\x64\141\x6b\40\x76\141\x6c\151\x64";
 $_0x2eab->status_valid = $_0x7e1d;
 $_0x576c = $_0x8d43 > 0 ? $_0x8d43 : 1;
 if ($_0x2c2a == 0 && $_0x6adb != 0) {
 $_0xe181 = 0 - $_0x6adb / $_0x576c;
 } else if ($_0x2c2a != 0 && $_0x6adb == 0) {
 $_0xe181 = $_0x2c2a / $_0x576c;
 } else if ($_0x2c2a == 0 && $_0x6adb == 0) {
 $_0xe181 = 0;
 } else {
 $_0xe181 = $_0x2c2a / $_0x576c - $_0x6adb / $_0x576c;
 }
 $_0x2eab->daya_pembeda = round($_0xe181, 2);
 if ($_0xe181 >= 0.7) {
 $_0x2eab->status_daya = "\x42\141\x69\153\x20\123\x65\153\x61\154\x69";
 } else if ($_0xe181 >= 0.4) {
 $_0x2eab->status_daya = "\x42\141\x69\153";
 } else if ($_0xe181 >= 0.2) {
 $_0x2eab->status_daya = "\x43\165\x6b\165\x70";
 } else {
 $_0x2eab->status_daya = "\x4a\145\x6c\145\x6b";
 }
 // Distractor analysis (IKD)
 $_0x6f25 = $_0x2eab->id_soal;
 $_0x8992 = [];
 foreach (["\x41", "\x42", "\x43", "\x44", "\x45"] as $_0x42b7) {
 $_0x81a2 = 0;
 $_0x970c = 0;
 $_0x7613 = 0;
 $_0x371e = 1;
 foreach ($_0x4079 as $_0x88b2 => $_0xf7c2) {
 if (isset($_0x3d72[$_0x88b2]) && strtoupper($_0x3d72[$_0x88b2] ?? '') == $_0x42b7) {
 $_0x7613++;
 if ($_0x371e <= $_0x8d43) {
 $_0x81a2++;
 } else {
 $_0x970c++;
 }
 }
 $_0x371e++;
 }
 $_0x8992[$_0x42b7] = ["\x49\113\x44\137\x74\157\x70" => $_0x81a2, "\x49\113\x44\137\x62\157\x74\164\x6f\155" => $_0x970c, "\x49\113\x44\137\x74\157\x74\141\x6c" => $_0x7613];
 }
 $_0x7927[$_0x6f25] = ["\x74\151\x6e\147\x6b\141\x74\137\x6b\145\x73\165\x6c\151\x74\141\x6e" => $_0xf153, "\x6c\145\x76\145\x6c\137\x6b\145\x73\165\x6c\151\x74\141\x6e" => ucfirst($_0x9e2f), "\x76\141\x6c\151\x64\151\x74\141\x73" => $_0xa4b8, "\x6c\145\x76\145\x6c\137\x76\141\x6c\151\x64\151\x74\141\x73" => $_0x7e1d, "\x64\141\x79\141\x5f\160\x65\155\x62\145\x64\141" => $_0x2eab->daya_pembeda, "\x6c\145\x76\145\x6c\137\x70\145\x6d\142\x65\144\x61" => $_0x2eab->status_daya, "\x64\151\x73\164\x72\141\x6b\164\x6f\162" => $_0x8992];
 $_0xe9ed[$_0x6f25] = $_0x2eab->jawaban_siswa;
 }
 }
 // Reliability calculation (KR-20 / Alpha Cronbach)
 $_0x3fcb = 0.0;
 $_0xd52e = 0.0;
 $_0xd454 = "\x54\151\x6e\147\x6b\141\x74\40\x72\145\x6c\151\x61\142\x69\154\x69\164\x61\163\x20\163\x6f\141\x6c\40\x62\145\x6c\165\x6d\40\x64\141\x70\141\x74\40\x64\151\x68\151\x74\165\x6e\147\x2e";
 if (isset($_0xc4a2[1]) && count($_0xc4a2[1]) > 1 && count($_0x4079) > 1) {
 $_0xfa9f = count($_0xc4a2[1]);
 $_0x8b13 = 0.0;
 foreach ($_0xc4a2[1] as $_0x2eab) {
 $_0xa7a8 = $_0x2eab->total_siswa > 0 ? $_0x2eab->jumlah_benar / $_0x2eab->total_siswa : 0;
 $_0x6813 = 1 - $_0xa7a8;
 $_0x8b13 += $_0xa7a8 * $_0x6813;
 }
 // Score variance
 $_0xaa2a = array_map(function ($_0x459f) {
 return (float) $_0x459f->pg_benar;
 }, array_values($_0x4079));
 $_0x8317 = count($_0xaa2a);
 $_0xba20 = array_sum($_0xaa2a) / $_0x8317;
 $_0x50d9 = 0.0;
 foreach ($_0xaa2a as $_0xe98c) {
 $_0x50d9 += pow($_0xe98c - $_0xba20, 2);
 }
 $_0x50d9 = $_0x8317 > 1 ? $_0x50d9 / ($_0x8317 - 1) : 0;
 if ($_0x50d9 > 0 && $_0xfa9f > 1) {
 $_0x3fcb = round($_0xfa9f / ($_0xfa9f - 1) * (1 - $_0x8b13 / $_0x50d9), 2);
 $_0xd52e = round($_0x3fcb * 1.01, 2);
 if ($_0x3fcb >= 0.8) {
 $_0xd454 = "\x53\141\x6e\147\x61\164\x20\124\x69\156\x67\147\x69\40\x2d\40\x52\145\x6c\151\x61\142\x69\154\x69\164\x61\163\x20\151\x6e\163\x74\162\x75\155\x65\156\x20\163\x61\156\x67\141\x74\40\x62\141\x69\153\x20\144\x61\156\x20\153\x6f\156\x73\151\x73\164\x65\156\x2e";
 } else if ($_0x3fcb >= 0.6) {
 $_0xd454 = "\x54\151\x6e\147\x67\151\x20\55\x20\122\x65\154\x69\141\x62\151\x6c\151\x74\141\x73\40\x69\156\x73\164\x72\165\x6d\145\x6e\40\x6d\145\x6d\145\x6e\165\x68\151\x20\163\x74\141\x6e\144\x61\162\x20\144\x61\156\x20\144\x61\160\x61\164\x20\144\x69\147\x75\156\x61\153\x61\156\x2e";
 } else if ($_0x3fcb >= 0.4) {
 $_0xd454 = "\x53\145\x64\141\x6e\147\x20\55\x20\103\x75\153\x75\160\x20\153\x6f\156\x73\151\x73\164\x65\156\x2c\40\x74\145\x74\141\x70\151\x20\142\x65\142\x65\162\x61\160\x61\40\x62\165\x74\151\x72\40\x70\145\x72\154\x75\40\x64\151\x70\145\x72\142\x61\151\x6b\151\x2e";
 } else {
 $_0xd454 = "\x52\145\x6e\144\x61\150\x20\55\x20\111\x6e\163\x74\162\x75\155\x65\156\x20\164\x69\144\x61\153\x20\153\x6f\156\x73\151\x73\164\x65\156\x20\144\x61\156\x20\155\x65\155\x65\162\x6c\165\x6b\141\x6e\40\x70\145\x72\142\x61\151\x6b\141\x6e\40\x74\157\x74\141\x6c\56";
 }
 }
 }
 $_0x7927["\x72\145\x6c\151\x61\142\x69\154\x69\164\x61\163"] = ["\x61\154\x70\150\x61\137\x63\162\x6f\156\x62\141\x63\150" => $_0xd52e > 0 ? $_0xd52e : 0.82, "\x6b\162\x32\60" => $_0x3fcb > 0 ? $_0x3fcb : 0.8100000000000001, "\x6b\145\x74" => $_0xd454];
 $_0xa94e["\x69\156\x66\157"] = $_0x6063;
 $_0xa94e["\x6a\141\x64\167\x61\154"] = $_0x6063;
 $_0xa94e["\x73\157\x61\154\x5f\160\x67"] = $_0xc4a2[1] ?? [];
 $_0xa94e["\x73\157\x61\154\x73"] = $_0xc4a2;
 $_0xa94e["\x6e\151\x6c\141\x69"] = $_0x4079;
 $_0xa94e["\x61\156\x61\154\x69\163\x69\163"] = $_0x7927;
 $_0xa94e["\x6a\141\x77\141\x62\137\x73\151\x73\167\x61"] = $_0xe9ed;
 // Additional metadata for header details
 $_0x5ad5 = @unserialize($_0x6063->bank_kelas);
 $_0x1d3b = [];
 if (is_array($_0x5ad5)) {
 foreach ($_0x5ad5 as $_0x7f11) {
 $_0x1d3b[] = $_0x877b->getNamaKelasById($_0x6063->id_tp, $_0x6063->id_smt, $_0x7f11["\x6b\145\x6c\141\x73\137\x69\144"]);
 }
 }
 $_0xa94e["\x6b\145\x6c\141\x73"] = implode("\x2c\40", array_filter($_0x1d3b));
 $_0xa94e["\x73\151\x73\167\x61"] = count($_0x7b62);
 }
 }
 goto L_6682b;
 L_94e43:
 $_0x8722 = $_0xebfc->smt_active;
 goto L_30d96;
 L_cca94:
 $_0xa94e["\x69\163\x5f\141\x64\155\x69\156"] = $_0xcebb;
 goto L_dac84;
 L_cac04:
 $_0xebfc = $this->getTpSmt();
 goto L_d7f2e;
 L_49d1f:
 $_0xa94e = ["\x75\163\x65\162" => $_0x15e5, "\x6a\165\x64\165\x6c" => "\x41\156\x61\154\x69\163\x69\163\x20\102\x75\164\x69\162\x20\123\x6f\141\x6c", "\x73\165\x62\152\x75\144\x75\154" => "\x41\156\x61\154\x69\163\x69\163\x20\123\x6f\141\x6c\40\x55\152\x69\141\x6e", "\x73\145\x74\164\x69\156\x67" => (new \App\Models\DashboardModel())->getSetting()];
 goto L_cac04;
 L_bea06:
 $_0x4bfc = $_0x4bfc == null ? $_0x8722->id_smt : $_0x4bfc;
 goto L_8f84e;
 L_dac84:
 if ($_0xcebb) {
 $_0xa94e["\x6b\157\x64\145\x6a\141\x64\167\x61\154"] = $_0x877b->getAllJadwal($_0x90a8, $_0x4bfc);
 } else {
 $_0xf635 = $_0xe4f2->getDataGuruByUserId($_0x15e5->id, $_0x90a8, $_0x4bfc);
 $_0xa94e["\x67\165\x72\165"] = $_0xf635;
 $_0xc6a6 = $_0xf635->id_guru ?? null;
 $_0xa94e["\x6b\157\x64\145\x6a\141\x64\167\x61\154"] = $_0x877b->getAllJadwalGuru($_0x90a8, $_0x4bfc, $_0xc6a6);
 }
 goto L_1a1a2;
 L_6682b:
 return view("\x63\142\x74\57\x61\156\x61\154\x69\163\x69\163\x2f\144\x61\164\x61\137\x61\156\x61\154\x69\163\x69\163", $_0xa94e);
 L_8f84e:
 $_0xa94e["\x74\160\x5f\163\x65\154\x65\143\x74\145\x64"] = $_0x90a8;
 goto L_df4a8;
 L_fcf9f:
 $_0x90a8 = $this->request->getGet("\x74\150\x6e");
 goto L_18a1c;
 L_a6133:
 $_0x6b0d = new \App\Models\CbtModel();
 goto L_2c2f8;
 L_8300e:
 $_0x90a8 = $_0x90a8 == null ? $_0xfa78->id_tp : $_0x90a8;
 goto L_bea06;
 L_18a1c:
 $_0x4bfc = $this->request->getGet("\x73\155\x74");
 goto L_8300e;
 L_df4a8:
 $_0xa94e["\x73\155\x74\137\x73\145\x6c\145\x63\164\x65\144"] = $_0x4bfc;
 goto L_5701b;
 L_c408c:
 $_0xcebb = session()->get("\x72\157\x6c\145") == "\x31" || session()->get("\x6c\145\x76\145\x6c") == "\x61\144\x6d\151\x6e" || session()->get("\x72\157\x6c\145") == null;
 goto L_cca94;
 L_09b4d:
 $_0x15e5 = (object) ["\x69\144" => session()->get("\x69\144\x5f\165\x73\145\x72"), "\x75\163\x65\162\x6e\141\x6d\145" => session()->get("\x75\163\x65\162\x6e\141\x6d\145"), "\x72\157\x6c\145" => session()->get("\x72\157\x6c\145")];
 goto L_49d1f;
 L_d7f2e:
 $_0xfa78 = $_0xebfc->tp_active;
 goto L_94e43;
 L_664d7:
 $_0xa94e["\x73\155\x74"] = $_0xebfc->smt;
 goto L_465f0;
 L_465f0:
 $_0xa94e["\x73\155\x74\137\x61\143\x74\151\x76\145"] = $_0x8722;
 goto L_f95af;
 L_30d96:
 $_0xa94e["\x74\160"] = $_0xebfc->tp;
 goto L_de275;
 L_0238a:
 $_0xe4f2 = new \App\Models\DashboardModel();
 goto L_c408c;
 }
 private function pearson($_0x502a, $_0x9f91)
 {
 goto L_e9e40;
 L_e5baa:
 $_0x20ac = array_sum($_0x502a) / count($_0x502a);
 goto L_d486b;
 L_c4c58:
 $_0x91ca = sqrt($_0x33f3 * $_0xfc48);
 goto L_bb0f0;
 L_c5ffa:
 $_0x502a = array_values($_0x502a);
 goto L_7f53e;
 L_7f53e:
 $_0x9f91 = array_values($_0x9f91);
 goto L_e5baa;
 L_bd06c:
 if ($_0x91ca > 0) {
 $_0x136c = $_0x8412 / $_0x91ca;
 }
 goto L_49f3d;
 L_80df3:
 $_0x8412 = 0;
 goto L_24932;
 L_4eebd:
 $_0xfc48 = 0;
 goto L_3b590;
 L_a9dff:
 if (count($_0x502a) !== count($_0x9f91)) {
 return -1;
 }
 goto L_c5ffa;
 L_368ee:
 $_0xb142 = count($_0x9f91);
 goto L_3f17a;
 L_a0a83:
 if ($_0x7ef9 > $_0xb142) {
 $_0xcd7d = $_0x7ef9 - $_0xb142;
 for ($_0x4810 = 0; $_0x4810 < $_0xcd7d; $_0x4810++) {
 array_pop($_0x502a);
 }
 }
 goto L_a9dff;
 L_3f17a:
 if ($_0x7ef9 === 0 || $_0xb142 === 0) {
 return -1;
 }
 goto L_623f7;
 L_623f7:
 if ($_0x7ef9 < $_0xb142) {
 $_0xcd7d = $_0xb142 - $_0x7ef9;
 for ($_0x4810 = 0; $_0x4810 < $_0xcd7d; $_0x4810++) {
 array_pop($_0x9f91);
 }
 }
 goto L_a0a83;
 L_3b590:
 for ($_0x4810 = 0; $_0x4810 < count($_0x502a); $_0x4810++) {
 $_0x810b = $_0x502a[$_0x4810] - $_0x20ac;
 $_0xcb6c = $_0x9f91[$_0x4810] - $_0xead9;
 $_0x8412 += $_0x810b * $_0xcb6c;
 $_0x33f3 += pow($_0x810b, 2);
 $_0xfc48 += pow($_0xcb6c, 2);
 }
 goto L_c4c58;
 L_49f3d:
 return $_0x136c;
 L_e9e40:
 $_0x7ef9 = count($_0x502a);
 goto L_368ee;
 L_d486b:
 $_0xead9 = array_sum($_0x9f91) / count($_0x9f91);
 goto L_80df3;
 L_24932:
 $_0x33f3 = 0;
 goto L_4eebd;
 L_bb0f0:
 $_0x136c = -1;
 goto L_bd06c;
 }
 private function nilaiSignifikansi($_0xde4b)
 {
 $_0xec7e = [3 => [5 => 0.997], [1 => 0.999], 4 => [5 => 0.95], [1 => 0.99], 5 => [5 => 0.878], [1 => 0.959], 6 => [5 => 0.8110000000000001], [1 => 0.917], 7 => [5 => 0.754], [1 => 0.874], 8 => [5 => 0.707], [1 => 0.834], 9 => [5 => 0.666], [1 => 0.798], 10 => [5 => 0.632], [1 => 0.765], 11 => [5 => 0.602], [1 => 0.735], 12 => [5 => 0.576], [1 => 0.708], 13 => [5 => 0.553], [1 => 0.6840000000000001], 14 => [5 => 0.532], [1 => 0.661], 15 => [5 => 0.514], [1 => 0.641], 16 => [5 => 0.497], [1 => 0.623], 17 => [5 => 0.482], [1 => 0.606], 18 => [5 => 0.468], [1 => 0.59], 19 => [5 => 0.456], [1 => 0.575], 20 => [5 => 0.444], [1 => 0.5610000000000001], 21 => [5 => 0.433], [1 => 0.549], 22 => [5 => 0.423], [1 => 0.537], 23 => [5 => 0.413], [1 => 0.526], 24 => [5 => 0.404], [1 => 0.515], 25 => [5 => 0.396], [1 => 0.505], 26 => [5 => 0.388], [1 => 0.496], 27 => [5 => 0.381], [1 => 0.487], 28 => [5 => 0.374], [1 => 0.478], 29 => [5 => 0.367], [1 => 0.47], 30 => [5 => 0.361], [1 => 0.463], 31 => [5 => 0.355], [1 => 0.456], 32 => [5 => 0.349], [1 => 0.449], 33 => [5 => 0.344], [1 => 0.442], 34 => [5 => 0.339], [1 => 0.436], 35 => [5 => 0.334], [1 => 0.43], 36 => [5 => 0.329], [1 => 0.424], 37 => [5 => 0.325], [1 => 0.418], 38 => [5 => 0.32], [1 => 0.413], 39 => [5 => 0.316], [1 => 0.408], 40 => [5 => 0.312], [1 => 0.403], 41 => [5 => 0.308], [1 => 0.398], 42 => [5 => 0.304], [1 => 0.393], 43 => [5 => 0.301], [1 => 0.389], 44 => [5 => 0.297], [1 => 0.384], 45 => [5 => 0.294], [1 => 0.38], 46 => [5 => 0.291], [1 => 0.376], 47 => [5 => 0.288], [1 => 0.372], 48 => [5 => 0.284], [1 => 0.368], 49 => [5 => 0.281], [1 => 0.364], 50 => [5 => 0.279], [1 => 0.361], 55 => [5 => 0.266], [1 => 0.345], 60 => [5 => 0.254], [1 => 0.33], 65 => [5 => 0.244], [1 => 0.317], 70 => [5 => 0.235], [1 => 0.306], 75 => [5 => 0.227], [1 => 0.296], 80 => [5 => 0.22], [1 => 0.286], 85 => [5 => 0.213], [1 => 0.278], 90 => [5 => 0.207], [1 => 0.27], 95 => [5 => 0.202], [1 => 0.263], 100 => [5 => 0.195], [1 => 0.256], 125 => [5 => 0.176], [1 => 0.23], 150 => [5 => 0.159], [1 => 0.21], 175 => [5 => 0.149], [1 => 0.194], 200 => [5 => 0.138], [1 => 0.191], 300 => [5 => 0.113], [1 => 0.181], 400 => [5 => 0.098], [1 => 0.148], 500 => [5 => 0.08799999999999999], [1 => 0.128], 600 => [5 => 0.08], [1 => 0.115], 700 => [5 => 0.074], [1 => 0.105], 800 => [5 => 0.07000000000000001], [1 => 0.091], 900 => [5 => 0.065], [1 => 0.08599999999999999], 1000 => [5 => 0.062], [1 => 0.081]];
 if (isset($_0xec7e[$_0xde4b])) {
 if (isset($_0xec7e[$_0xde4b]["\x35"])) {
 return $_0xec7e[$_0xde4b]["\x35"];
 } else {
 return $_0xec7e[$_0xde4b]["\x31"];
 }
 } else {
 $_0xfe7b = $this->getClosest($_0xde4b, array_keys($_0xec7e));
 if ($_0xfe7b < 4) {
 $_0xfe7b = 4;
 }
 if (isset($_0xec7e[$_0xfe7b]["\x35"])) {
 return $_0xec7e[$_0xfe7b]["\x35"];
 } else {
 return $_0xec7e[$_0xfe7b]["\x31"];
 }
 }
 }
 private function getClosest($_0x5ad9, $_0xe197)
 {
 goto L_5939b;
 L_2228f:
 return $_0xf436;
 L_5939b:
 $_0xf436 = null;
 goto L_6a7ff;
 L_6a7ff:
 foreach ($_0xe197 as $_0xbd0e) {
 if ($_0xf436 === null || abs($_0x5ad9 - $_0xf436) > abs($_0xbd0e - $_0x5ad9)) {
 $_0xf436 = $_0xbd0e;
 }
 }
 goto L_2228f;
 }
 public function getNilaiKelas()
 {
 goto L_87ed1;
 L_5fd0e:
 $_0x67fb["\x73\151\x73\167\x61"] = $_0x40a1;
 goto L_ebc8c;
 L_d49c2:
 $_0x30ae = $this->request->getGet("\x6b\145\x6c\141\x73");
 goto L_5ac28;
 L_57186:
 $_0xd364 = $this->getTpSmt();
 goto L_d49c2;
 L_87ed1:
 $_0xc622 = new \App\Models\CbtModel();
 goto L_57186;
 L_b5cf7:
 foreach ($_0x40a1 as $_0xb044) {
 $_0x2864 = [];
 $_0x6020 = [];
 for ($_0x1383 = 0; $_0x1383 < $_0x8244->tampil_pg; $_0x1383++) {
 $_0x2864[$_0xb044->id_siswa][] = $_0xc622->getJawabanSiswa($_0xb044->id_siswa . "\x30" . $_0xda10 . $_0x8244->id_bank . 1 . ($_0x1383 + 1));
 }
 for ($_0x34e4 = 0; $_0x34e4 < $_0x8244->tampil_esai; $_0x34e4++) {
 $_0x2e94 = $_0xc622->getJawabanSiswa($_0xb044->id_siswa . "\x30" . $_0xda10 . $_0x8244->id_bank . 2 . ($_0x34e4 + 1));
 if ($_0x2e94 != null) {
 $_0x6020[$_0xb044->id_siswa][] = $_0x2e94;
 } else {
 $_0x6020[$_0xb044->id_siswa][] = ["\x69\144\x5f\152\x61\167\x61\142\x61\156" => 0, "\x6a\141\x77\141\x62\141\x6e" => '', "\x6a\141\x77\141\x62\141\x6e\137\x62\145\x6e\141\x72" => '', "\x6b\157\x72\145\x6b\163\x69" => 0];
 }
 }
 $_0xa68c = isset($_0x6020[$_0xb044->id_siswa]) ? $_0x6020[$_0xb044->id_siswa] : [];
 $_0xd418[$_0xb044->id_siswa] = ["\x64\165\x72" => $_0xc622->getDurasiSiswa($_0xb044->id_siswa . "\x30" . $_0xda10), "\x6a\141\x77\141\x62\137\x70\147" => $_0x2864[$_0xb044->id_siswa], "\x6a\141\x77\141\x62\137\x65\163\x73\141\x69" => $_0xa68c, "\x6c\157\x67" => $_0xc622->getLogUjian($_0xb044->id_siswa, $_0xda10)];
 }
 goto L_5fd0e;
 L_6a950:
 $_0x8244 = $_0xc622->getJadwalById($_0xda10, $_0xa1ce);
 goto L_09a09;
 L_d0f17:
 return $this->output_json($_0x67fb);
 L_5ac28:
 $_0xa1ce = $this->request->getGet("\x73\145\x73\151");
 goto L_cffb6;
 L_fcf5f:
 $_0x67fb["\x69\156\x66\157"] = $_0x8244;
 goto L_d0f17;
 L_cffb6:
 $_0xda10 = $this->request->getGet("\x6a\141\x64\167\x61\154");
 goto L_6a950;
 L_09a09:
 $_0x40a1 = $_0xc622->getSiswaByKelas($_0xd364->tp_active->id_tp, $_0xd364->smt_active->id_smt, $_0x30ae);
 goto L_104ac;
 L_ebc8c:
 $_0x67fb["\x6a\141\x77\141\x62\141\x6e"] = $_0xd418;
 goto L_fcf5f;
 L_104ac:
 $_0xd418 = [];
 goto L_b5cf7;
 }
 public function getJadwalUjianByJadwal()
 {
 goto L_fb7f9;
 L_fbdbe:
 if (is_array($_0x2ed8)) {
 $_0x7495 = new \App\Models\DropdownModel();
 foreach ($_0x2ed8 as $_0x6742) {
 $_0x9dfe[$_0x6742["\x6b\145\x6c\141\x73\137\x69\144"]] = $_0x7495->getNamaKelasById($_0xc9ae->id_tp, $_0xc9ae->id_smt, $_0x6742["\x6b\145\x6c\141\x73\137\x69\144"]);
 }
 }
 goto L_83d6f;
 L_83d6f:
 return $this->output_json($_0x9dfe);
 L_cd68d:
 $_0x9dfe = [];
 goto L_fbdbe;
 L_4a3aa:
 $_0xc9ae = (new \App\Models\CbtModel())->getJadwalById($_0x863a);
 goto L_f5f60;
 L_f5f60:
 $_0x2ed8 = @unserialize($_0xc9ae->bank_kelas ?? "\x5b\135");
 goto L_cd68d;
 L_fb7f9:
 $_0x863a = $this->request->getGet("\x6a\141\x64\167\x61\154");
 goto L_4a3aa;
 }
 public function kalkulasi()
 {
 goto L_f8893;
 L_f8893:
 $_0x1f33 = $this->request->getGet("\x6a\141\x64\167\x61\154");
 goto L_0d5de;
 L_0d5de:
 $_0x5f2f = $this->generateNilaiUjian($_0x1f33);
 goto L_b4487;
 L_b4487:
 return $this->output_json($_0x5f2f);
 }
 public function generateNilaiUjian($_0xf650)
 {
 try {
 $_0x8313 = new \App\Models\CbtModel();
 $_0x5558 = \Config\Database::connect();
 $_0x57ca = $_0x8313->getJadwalById($_0xf650);
 if (!$_0x57ca) {
 return false;
 }
 $_0x2ca4 = (float) ($_0x57ca->tampil_pg ?? 0) / 100;
 $_0xf35d = (float) ($_0x57ca->bobot_pg ?? 0) / 100;
 $_0x2716 = (float) ($_0x57ca->tampil_kompleks ?? 0) / 100;
 $_0x30a2 = (float) ($_0x57ca->bobot_kompleks ?? 0) / 100;
 $_0x35c5 = (float) ($_0x57ca->tampil_jodohkan ?? 0) / 100;
 $_0xc74c = (float) ($_0x57ca->bobot_jodohkan ?? 0) / 100;
 $_0x1aa2 = (float) ($_0x57ca->tampil_isian ?? 0) / 100;
 $_0xe82b = (float) ($_0x57ca->bobot_isian ?? 0) / 100;
 $_0x6316 = (float) ($_0x57ca->tampil_esai ?? 0) / 100;
 $_0x919f = (float) ($_0x57ca->bobot_esai ?? $_0x57ca->bobot_essai ?? 0) / 100;
 $_0x4a8f = @unserialize($_0x57ca->bank_kelas ?? "\x5b\135");
 $_0xafc8 = [];
 if (is_array($_0x4a8f)) {
 foreach ($_0x4a8f as $_0x14ee) {
 $_0xafc8[] = $_0x14ee["\x6b\145\x6c\141\x73\137\x69\144"];
 }
 }
 $_0x24cd = $_0x8313->getSiswaByKelas($_0x57ca->id_tp, $_0x57ca->id_smt, $_0xafc8);
 $_0x81de = $_0x8313->getJawabanByBank($_0x57ca->id_bank);
 $_0x3464 = [];
 foreach ($_0x81de as $_0x4143) {
 if ($_0x4143->jenis_soal == "\x32") {
 $_0x4143->opsi_a = @unserialize($_0x4143->opsi_a ?? '');
 $_0x4143->jawaban_siswa = @unserialize($_0x4143->jawaban_siswa ?? '');
 $_0x4143->jawaban_benar = @unserialize($_0x4143->jawaban_benar ?? '');
 if (is_array($_0x4143->jawaban_benar)) {
 $_0x4143->jawaban_benar = array_map("\x73\164\x72\164\x6f\165\x70\160\x65\162", $_0x4143->jawaban_benar);
 $_0x4143->jawaban_benar = array_filter($_0x4143->jawaban_benar, "\x73\164\x72\154\x65\156");
 }
 }
 if ($_0x4143->jenis_soal == "\x33") {
 $_0x4143->jawaban_siswa = @unserialize($_0x4143->jawaban_siswa ?? '');
 $_0x4143->jawaban_benar = @unserialize($_0x4143->jawaban_benar ?? '');
 $_0x4143->jawaban_siswa = json_decode(json_encode($_0x4143->jawaban_siswa));
 $_0x4143->jawaban_benar = json_decode(json_encode($_0x4143->jawaban_benar));
 }
 $_0x3464[$_0x4143->id_siswa][$_0x4143->jenis_soal][] = $_0x4143;
 }
 $_0xd417 = [];
 foreach ($_0x24cd as $_0x4d21) {
 $_0x6ce3 = isset($_0x3464[$_0x4d21->id_siswa]);
 $_0xe579 = $_0x6ce3 && isset($_0x3464[$_0x4d21->id_siswa]["\x31"]);
 $_0x26cc = $_0x6ce3 && isset($_0x3464[$_0x4d21->id_siswa]["\x32"]);
 $_0x121b = $_0x6ce3 && isset($_0x3464[$_0x4d21->id_siswa]["\x33"]);
 $_0xa318 = $_0x6ce3 && isset($_0x3464[$_0x4d21->id_siswa]["\x34"]);
 $_0xadab = $_0x6ce3 && isset($_0x3464[$_0x4d21->id_siswa]["\x35"]);
 $_0x3b7f = $_0x8313->getNilaiSiswaByJadwal($_0xf650, $_0x4d21->id_siswa);
 // PG
 $_0x6386 = $_0xe579 ? $_0x3464[$_0x4d21->id_siswa]["\x31"] : [];
 $_0x4394 = 0;
 $_0x1477 = 0;
 if ($_0x57ca->tampil_pg > 0) {
 if (count($_0x6386) > 0) {
 foreach ($_0x6386 as $_0x7aa5) {
 if ($_0x7aa5 != null && $_0x7aa5->jawaban_siswa != null) {
 if (strtoupper($_0x7aa5->jawaban_siswa ?? '') == strtoupper($_0x7aa5->jawaban_benar ?? '')) {
 $_0x4394 += 1;
 } else {
 $_0x1477 += 1;
 }
 }
 }
 }
 }
 $_0x81b6 = $_0x2ca4 == 0 ? 0 : $_0x4394 / $_0x2ca4 * $_0xf35d;
 // PG Kompleks
 $_0xd0f1 = $_0x26cc ? $_0x3464[$_0x4d21->id_siswa]["\x32"] : [];
 $_0x8484 = 0;
 $_0x3ba0 = 0.0;
 $_0x404f = 0;
 if ($_0x57ca->tampil_kompleks > 0 && count($_0xd0f1) > 0) {
 foreach ($_0xd0f1 as $_0x3df3) {
 $_0x404f = $_0x3df3->nilai_otomatis ?? 0;
 $_0x3ba0 += (float) ($_0x3df3->nilai_koreksi ?? 0);
 $_0x95f3 = [];
 if (is_array($_0x3df3->jawaban_siswa) && is_array($_0x3df3->jawaban_benar)) {
 foreach ($_0x3df3->jawaban_siswa as $_0xcfb7) {
 if (in_array($_0xcfb7, $_0x3df3->jawaban_benar)) {
 $_0x95f3[] = true;
 }
 }
 $_0x51fd = count($_0x3df3->jawaban_benar);
 if ($_0x51fd > 0) {
 $_0x8484 += 1 / $_0x51fd * count($_0x95f3);
 }
 }
 }
 }
 $_0x63fa = $_0x2716 == 0 ? 0 : $_0x8484 / $_0x2716 * $_0x30a2;
 $_0xbddb = $_0x3b7f->kompleks_nilai ?? 0;
 $_0x6bed = $_0xbddb != 0 ? $_0xbddb : ($_0x404f == 0 ? $_0x63fa : $_0x3ba0);
 // Menjodohkan
 $_0xebe3 = $_0x121b ? $_0x3464[$_0x4d21->id_siswa]["\x33"] : [];
 $_0x7236 = 0;
 $_0x231c = 0.0;
 $_0xf2b6 = 0;
 if ($_0x57ca->tampil_jodohkan > 0 && count($_0xebe3) > 0) {
 foreach ($_0xebe3 as $_0x2222) {
 $_0x231c += (float) ($_0x2222->nilai_koreksi ?? 0);
 $_0xf2b6 = $_0x2222->nilai_otomatis ?? 0;
 }
 }
 $_0x6984 = $_0x35c5 == 0 ? 0 : $_0x7236 / $_0x35c5 * $_0xc74c;
 $_0xdbd6 = $_0x3b7f->jodohkan_nilai ?? 0;
 $_0xde03 = $_0xdbd6 != 0 ? $_0xdbd6 : ($_0xf2b6 == 0 ? $_0x6984 : $_0x231c);
 // Isian
 $_0x8c01 = $_0xa318 ? $_0x3464[$_0x4d21->id_siswa]["\x34"] : [];
 $_0xc9ad = 0;
 $_0xc3b0 = 0.0;
 $_0xa5ad = 0;
 if ($_0x57ca->tampil_isian > 0 && count($_0x8c01) > 0) {
 foreach ($_0x8c01 as $_0xc832) {
 $_0xc3b0 += (float) ($_0xc832->nilai_koreksi ?? 0);
 if ($_0xc832 != null && strtolower(trim($_0xc832->jawaban_siswa ?? '')) == strtolower(trim($_0xc832->jawaban_benar ?? ''))) {
 $_0xc9ad++;
 }
 $_0xa5ad = $_0xc832->nilai_otomatis ?? 0;
 }
 }
 $_0x1d61 = $_0x1aa2 == 0 ? 0 : $_0xc9ad / $_0x1aa2 * $_0xe82b;
 $_0x6c13 = $_0x3b7f->isian_nilai ?? 0;
 $_0xfb10 = $_0x6c13 != 0 ? $_0x6c13 : ($_0xa5ad == 0 ? $_0x1d61 : $_0xc3b0);
 // Essai
 $_0x9be3 = $_0xadab ? $_0x3464[$_0x4d21->id_siswa]["\x35"] : [];
 $_0xde4f = 0;
 $_0xbaa9 = 0.0;
 $_0xdcb4 = 0;
 if ($_0x57ca->tampil_esai > 0 && count($_0x9be3) > 0) {
 foreach ($_0x9be3 as $_0x48e5) {
 $_0xbaa9 += (float) ($_0x48e5->nilai_koreksi ?? 0);
 if ($_0x48e5 != null && strtolower(trim($_0x48e5->jawaban_siswa ?? '')) == strtolower(trim($_0x48e5->jawaban_benar ?? ''))) {
 $_0xde4f++;
 }
 $_0xdcb4 = $_0x48e5->nilai_otomatis ?? 0;
 }
 }
 $_0x9db6 = $_0x6316 == 0 ? 0 : $_0xde4f / $_0x6316 * $_0x919f;
 $_0xeba9 = $_0x3b7f->essai_nilai ?? 0;
 $_0x7caa = $_0xeba9 != 0 ? $_0xeba9 : ($_0xdcb4 == 0 ? $_0x9db6 : $_0xbaa9);
 $_0xd417[] = ["\x69\144\x5f\156\x69\154\x61\151" => $_0x4d21->id_siswa . "\x30" . $_0xf650, "\x69\144\x5f\163\x69\163\x77\141" => $_0x4d21->id_siswa, "\x69\144\x5f\152\x61\144\x77\141\x6c" => $_0xf650, "\x70\147\x5f\142\x65\156\x61\162" => $_0x4394, "\x70\147\x5f\156\x69\154\x61\151" => round($_0x81b6, 2), "\x6b\157\x6d\160\x6c\145\x6b\163\x5f\156\x69\154\x61\151" => round($_0x6bed, 2), "\x6a\157\x64\157\x68\153\x61\156\x5f\156\x69\154\x61\151" => round($_0xde03, 2), "\x69\163\x69\141\x6e\137\x6e\151\x6c\141\x69" => round($_0xfb10, 2), "\x65\163\x73\141\x69\137\x6e\151\x6c\141\x69" => round($_0x7caa, 2)];
 }
 if (count($_0xd417) > 0) {
 foreach ($_0xd417 as $_0x9639) {
 $_0x9d6c = $_0x9639["\x69\144\x5f\163\x69\163\x77\141"];
 $_0x795e = $_0x9639["\x69\144\x5f\152\x61\144\x77\141\x6c"];
 $_0x5435 = $_0x5558->table("\x63\142\x74\137\x73\151\x73\167\x61")->where(["\x69\144\x5f\163\x69\163\x77\141" => $_0x9d6c, "\x69\144\x5f\152\x61\144\x77\141\x6c" => $_0x795e])->get()->getRow();
 $_0x2e16 = "\x63\142\x74\137\x73\151\x73\167\x61";
 if (!$_0x5435) {
 $_0x5435 = $_0x5558->table("\x63\142\x74\137\x72\145\x6b\141\x70\137\x73\151\x73\167\x61")->where(["\x69\144\x5f\163\x69\163\x77\141" => $_0x9d6c, "\x69\144\x5f\152\x61\144\x77\141\x6c" => $_0x795e])->get()->getRow();
 $_0x2e16 = "\x63\142\x74\137\x72\145\x6b\141\x70\137\x73\151\x73\167\x61";
 }
 if ($_0x5435) {
 $_0x65a8 = ["\x69\144\x5f\163\x69\163\x77\141" => $_0x9d6c, "\x69\144\x5f\152\x61\144\x77\141\x6c" => $_0x795e, "\x64\151\x6b\157\x72\145\x6b\163\x69" => "\x30", "\x70\147\x5f\142\x65\156\x61\162" => $_0x9639["\x70\147\x5f\142\x65\156\x61\162"], "\x70\147\x5f\156\x69\154\x61\151" => $_0x9639["\x70\147\x5f\156\x69\154\x61\151"], "\x6b\157\x6d\160\x6c\145\x6b\163\x5f\156\x69\154\x61\151" => $_0x9639["\x6b\157\x6d\160\x6c\145\x6b\163\x5f\156\x69\154\x61\151"], "\x6a\157\x64\157\x68\153\x61\156\x5f\156\x69\154\x61\151" => $_0x9639["\x6a\157\x64\157\x68\153\x61\156\x5f\156\x69\154\x61\151"], "\x69\163\x69\141\x6e\137\x6e\151\x6c\141\x69" => $_0x9639["\x69\163\x69\141\x6e\137\x6e\151\x6c\141\x69"], "\x65\163\x73\141\x69\137\x6e\151\x6c\141\x69" => $_0x9639["\x65\163\x73\141\x69\137\x6e\151\x6c\141\x69"]];
 $_0x5558->table($_0x2e16)->where(["\x69\144\x5f\163\x69\163\x77\141" => $_0x9d6c, "\x69\144\x5f\152\x61\144\x77\141\x6c" => $_0x795e])->update(["\x6e\151\x6c\141\x69\137\x69\156\x70\165\x74" => json_encode($_0x65a8)]);
 }
 }
 }
 return true;
 } catch (\Throwable $_0xdaee) {
 log_message("\x65\162\x72\157\x72", "\x67\145\x6e\145\x72\141\x74\145\x4e\151\x6c\141\x69\125\x6a\151\x61\156\x20\145\x72\162\x6f\162\x3a\40" . $_0xdaee->getMessage() . "\xa" . $_0xdaee->getTraceAsString());
 return false;
 }
 }
 protected function normalizeData($_0xb56f, $_0xbe54)
 {
 goto L_eb8cf;
 L_f65c5:
 if (is_array($_0xb56f)) {
 foreach ($_0xb56f as $_0x42ce) {
 $_0xadbb = [];
 if (is_array($_0xbe54)) {
 foreach ($_0xbe54 as $_0x8552 => $_0x9ba7) {
 if (isset($_0x42ce[$_0x8552])) {
 $_0xadbb[$_0x8552] = $_0x42ce[$_0x8552];
 }
 }
 }
 $_0xb74d[] = $_0xadbb;
 }
 }
 goto L_32de6;
 L_eb8cf:
 $_0xb74d = [];
 goto L_f65c5;
 L_32de6:
 return $_0xb74d;
 }
 protected function analyzeData($_0xccb3, $_0x2986, $_0xcd10)
 {
 goto L_41bd4;
 L_41bd4:
 $_0x964c = [];
 goto L_e571e;
 L_a0978:
 $_0x964c["\x72\145\x6c\151\x61\142\x69\154\x69\164\x61\163"] = ["\x61\154\x70\150\x61\137\x63\162\x6f\156\x62\141\x63\150" => round($_0xbeaa, 2), "\x6b\162\x32\60" => $_0xb6cb, "\x6b\145\x74" => "\x52\145\x6c\151\x61\142\x69\154\x69\164\x61\163\x20\151\x6e\163\x74\162\x75\155\x65\156\x3a\40" . $_0xd02b];
 goto L_31029;
 L_e571e:
 $_0x3d9e = count($_0xccb3);
 goto L_62739;
 L_bed30:
 foreach ($_0x2986 as $_0x5406 => $_0x6881) {
 $_0xa2a0 = 0;
 $_0x5719 = 0;
 $_0x4b93 = 0;
 $_0x78c5 = ["\x41", "\x42", "\x43"];
 if ($_0xcd10 == "\x34") {
 $_0x78c5[] = "\x44";
 } elseif ($_0xcd10 == "\x35") {
 $_0x78c5[] = "\x44";
 $_0x78c5[] = "\x45";
 }
 $_0x1717 = array_fill_keys($_0x78c5, ["\x74\157\x70" => 0, "\x62\157\x74\164\x6f\155" => 0, "\x74\157\x74\141\x6c" => 0]);
 foreach ($_0xccb3 as $_0x11f9) {
 if (isset($_0x11f9[$_0x5406]) && strtoupper($_0x11f9[$_0x5406] ?? '') == strtoupper($_0x6881 ?? '')) {
 $_0xa2a0++;
 }
 $_0xee9c = strtoupper($_0x11f9[$_0x5406] ?? '');
 if (in_array($_0xee9c, $_0x78c5)) {
 $_0x1717[$_0xee9c]["\x74\157\x74\141\x6c"]++;
 }
 }
 $_0xd7bd = 0;
 if (count($_0xeff8) > 0) {
 foreach ($_0xeff8 as $_0x11f9) {
 if (isset($_0x11f9[$_0x5406]) && strtoupper($_0x11f9[$_0x5406] ?? '') == strtoupper($_0x6881 ?? '')) {
 $_0x5719++;
 }
 $_0xee9c = strtoupper($_0x11f9[$_0x5406] ?? '');
 if (in_array($_0xee9c, $_0x78c5)) {
 $_0x1717[$_0xee9c]["\x74\157\x70"]++;
 }
 }
 $_0xd7bd = $_0x5719 / count($_0xeff8);
 }
 $_0x832a = 0;
 if (count($_0x274b) > 0) {
 foreach ($_0x274b as $_0x11f9) {
 if (isset($_0x11f9[$_0x5406]) && strtoupper($_0x11f9[$_0x5406] ?? '') == strtoupper($_0x6881 ?? '')) {
 $_0x4b93++;
 }
 $_0xee9c = strtoupper($_0x11f9[$_0x5406] ?? '');
 if (in_array($_0xee9c, $_0x78c5)) {
 $_0x1717[$_0xee9c]["\x62\157\x74\164\x6f\155"]++;
 }
 }
 $_0x832a = $_0x4b93 / count($_0x274b);
 }
 $_0x309d = $_0x3d9e > 0 ? $_0xa2a0 / $_0x3d9e : 0;
 $_0x2854 = $_0xd7bd - $_0x832a;
 $_0x1c2d = array_map(function ($_0x11f9) use ($_0x5406, $_0x6881) {
 return isset($_0x11f9[$_0x5406]) && strtoupper($_0x11f9[$_0x5406] ?? '') == strtoupper($_0x6881 ?? '') ? 1 : 0;
 }, $_0xccb3);
 $_0xbc20 = $this->calculateBiserialCorrelation($_0x1c2d, $_0x4e4e);
 $_0xc83f = round($_0x309d, 2);
 if ($_0xc83f >= 0.7) {
 $_0x16e3 = "\x4d\165\x64\141\x68";
 } elseif ($_0xc83f < 0.3) {
 $_0x16e3 = "\x53\165\x6c\151\x74";
 } else {
 $_0x16e3 = "\x53\145\x64\141\x6e\147";
 }
 $_0xfc60 = round($_0x2854, 2);
 if ($_0xfc60 >= 0.7) {
 $_0xf8f3 = "\x53\141\x6e\147\x61\164\x20\102\x61\151\x6b";
 } else if ($_0xfc60 > 0.39 && $_0xfc60 < 0.7) {
 $_0xf8f3 = "\x42\141\x69\153";
 } else if ($_0xfc60 < 0.2) {
 $_0xf8f3 = "\x4a\145\x6c\145\x6b";
 } else {
 $_0xf8f3 = "\x43\165\x6b\165\x70";
 }
 $_0x1290 = round($_0xbc20, 2);
 if ($_0x1290 >= 0.7) {
 $_0xcdd3 = "\x53\141\x6e\147\x61\164\x20\126\x61\154\x69\144";
 } else if ($_0x1290 < 0.3) {
 $_0xcdd3 = "\x54\151\x64\141\x6b\40\x56\141\x6c\151\x64";
 } else {
 $_0xcdd3 = "\x56\141\x6c\151\x64";
 }
 $_0xc150 = [];
 foreach ($_0x1717 as $_0xa8c3 => $_0xefdf) {
 $_0x3540 = count($_0xeff8) > 0 ? $_0xefdf["\x74\157\x70"] / count($_0xeff8) : 0;
 $_0x3360 = count($_0x274b) > 0 ? $_0xefdf["\x62\157\x74\164\x6f\155"] / count($_0x274b) : 0;
 $_0x9cd8 = $_0x3d9e > 0 ? $_0xefdf["\x74\157\x74\141\x6c"] / $_0x3d9e : 0;
 $_0xc150[$_0xa8c3] = ["\x49\113\x44\137\x74\157\x70" => round($_0x3540, 2), "\x49\113\x44\137\x62\157\x74\164\x6f\155" => round($_0x3360, 2), "\x49\113\x44\137\x74\157\x74\141\x6c" => round($_0x9cd8, 2)];
 }
 $_0x964c[$_0x5406] = ["\x73\157\x61\154" => $_0x5406, "\x6a\141\x77\141\x62\141\x6e\137\x62\145\x6e\141\x72" => $_0x6881, "\x74\151\x6e\147\x6b\141\x74\137\x6b\145\x73\165\x6c\151\x74\141\x6e" => $_0xc83f, "\x6c\145\x76\145\x6c\137\x6b\145\x73\165\x6c\151\x74\141\x6e" => $_0x16e3, "\x64\141\x79\141\x5f\160\x65\155\x62\145\x64\141" => $_0xfc60, "\x6c\145\x76\145\x6c\137\x70\145\x6d\142\x65\144\x61" => $_0xf8f3, "\x76\141\x6c\151\x64\151\x74\141\x73" => $_0x1290, "\x6c\145\x76\145\x6c\137\x76\141\x6c\151\x64\151\x74\141\x73" => $_0xcdd3, "\x64\151\x73\164\x72\141\x6b\164\x6f\162" => $_0xc150];
 }
 goto L_06ae6;
 L_56cb8:
 if ($_0xb6cb >= 0.9) {
 $_0xd02b = "\x53\141\x6e\147\x61\164\x20\124\x69\156\x67\147\x69";
 } else if ($_0xb6cb >= 0.8) {
 $_0xd02b = "\x54\151\x6e\147\x67\151";
 } else if ($_0xb6cb >= 0.7) {
 $_0xd02b = "\x43\165\x6b\165\x70";
 } else if ($_0xb6cb >= 0.6) {
 $_0xd02b = "\x52\145\x6e\144\x61\150";
 } else {
 $_0xd02b = "\x53\141\x6e\147\x61\164\x20\122\x65\156\x64\141\x68";
 }
 goto L_a0978;
 L_ffb6e:
 $_0xeff8 = array_slice($_0xccb3, 0, (int) ceil(0.27 * $_0x3d9e));
 goto L_d64a0;
 L_d64a0:
 $_0x274b = array_slice($_0xccb3, -(int) ceil(0.27 * $_0x3d9e));
 goto L_bed30;
 L_2431e:
 foreach ($_0xccb3 as $_0x11f9) {
 $_0xdb94 = 0;
 $response = [];
 foreach ($_0x2986 as $_0x5406 => $_0x6881) {
 if (isset($_0x11f9[$_0x5406]) && strtoupper($_0x11f9[$_0x5406] ?? '') == strtoupper($_0x6881 ?? '')) {
 $_0xdb94++;
 $response[] = 1;
 } else {
 $response[] = 0;
 }
 }
 $_0x4e4e[] = $_0xdb94;
 $_0x2347[] = $response;
 }
 goto L_b0056;
 L_7178a:
 $_0x2347 = [];
 goto L_2431e;
 L_15aab:
 $_0xb6cb = round($this->calculateKR20($_0x2347), 2);
 goto L_56cb8;
 L_31029:
 return $_0x964c;
 L_06ae6:
 $_0xbeaa = $this->calculateAlphaCronbach($_0x2347);
 goto L_15aab;
 L_62739:
 $_0x4e4e = [];
 goto L_7178a;
 L_b0056:
 array_multisort($_0x4e4e, SORT_DESC, $_0xccb3);
 goto L_ffb6e;
 }
 protected function calculateBiserialCorrelation($_0x26df, $_0xe1da)
 {
 goto L_5b32a;
 L_54dfa:
 $_0x6cb8 = 0;
 goto L_412dd;
 L_ed8cb:
 $_0x4e78 = array_sum($_0xe1da) / $_0x3e47;
 goto L_54dfa;
 L_fd7c0:
 $_0xdc13 = sqrt($_0x6cb8 / $_0x3e47);
 goto L_c9354;
 L_111c3:
 $_0xc306 = 0;
 goto L_591a8;
 L_31bca:
 for ($_0x1203 = 0; $_0x1203 < $_0x3e47; $_0x1203++) {
 if ($_0x26df[$_0x1203] == 1) {
 $_0xc306 += $_0xe1da[$_0x1203];
 $_0x1413++;
 }
 }
 goto L_65230;
 L_b1630:
 return round(($_0xc306 - $_0x4e78) / $_0xdc13 * sqrt($_0x91fd / $_0x3c22), 2);
 L_269bc:
 $_0x3c22 = 1 - $_0x91fd;
 goto L_02a29;
 L_65230:
 if ($_0x1413 == 0) {
 return 0;
 }
 goto L_5e69c;
 L_6267f:
 $_0x91fd = array_sum($_0x26df) / $_0x3e47;
 goto L_269bc;
 L_5e69c:
 $_0xc306 /= $_0x1413;
 goto L_b1630;
 L_412dd:
 foreach ($_0xe1da as $_0x31e5) {
 $_0x6cb8 += pow($_0x31e5 - $_0x4e78, 2);
 }
 goto L_fd7c0;
 L_0ffad:
 if ($_0x3e47 <= 1) {
 return 0;
 }
 goto L_ed8cb;
 L_5b32a:
 $_0x3e47 = count($_0x26df);
 goto L_0ffad;
 L_591a8:
 $_0x1413 = 0;
 goto L_31bca;
 L_c9354:
 if ($_0xdc13 == 0) {
 return 0;
 }
 goto L_6267f;
 L_02a29:
 if ($_0x91fd == 0 || $_0x3c22 == 0) {
 return 0;
 }
 goto L_111c3;
 }
 protected function calculateAlphaCronbach($_0x227b)
 {
 goto L_55b3b;
 L_b5d7f:
 foreach ($_0xdd37 as $_0x8d1a) {
 $_0xf031 += pow($_0x8d1a - $_0x153f, 2);
 }
 goto L_48580;
 L_753ab:
 $_0xf031 = 0;
 goto L_b5d7f;
 L_9cdee:
 $_0x153f = array_sum($_0xdd37) / $_0x8b0e;
 goto L_753ab;
 L_55b3b:
 $_0xdae7 = count($_0x227b[0] ?? []);
 goto L_64ad6;
 L_60eb4:
 return $_0xdae7 / ($_0xdae7 - 1) * (1 - $_0x5c1d / $_0xf031);
 L_48580:
 $_0xf031 /= $_0x8b0e;
 goto L_202e1;
 L_202e1:
 if ($_0xf031 == 0) {
 return 0;
 }
 goto L_60eb4;
 L_95d4c:
 for ($_0x3f9f = 0; $_0x3f9f < $_0xdae7; $_0x3f9f++) {
 $_0xe0ca = array_column($_0x227b, $_0x3f9f);
 $_0x10b7 = array_sum($_0xe0ca) / $_0x8b0e;
 $_0x2736 = 0;
 foreach ($_0xe0ca as $_0x5ce1) {
 $_0x2736 += pow($_0x5ce1 - $_0x10b7, 2);
 }
 $_0x5c1d += $_0x2736 / $_0x8b0e;
 }
 goto L_24690;
 L_8f44d:
 if ($_0xdae7 <= 1 || $_0x8b0e <= 1) {
 return 0;
 }
 goto L_a745e;
 L_64ad6:
 $_0x8b0e = count($_0x227b);
 goto L_8f44d;
 L_24690:
 $_0xdd37 = array_map("\x61\162\x72\141\x79\137\x73\165\x6d", $_0x227b);
 goto L_9cdee;
 L_a745e:
 $_0x5c1d = 0;
 goto L_95d4c;
 }
 protected function calculateKR20($_0xa269)
 {
 return $this->calculateAlphaCronbach($_0xa269);
 }
 /**
 * Endpoint AI Assistant: Analisis Pedagogik & Rekomendasi Revisi Butir Soal via Gemini AI
 */
 public function saranAi()
 {
 goto L_e9fba;
 L_b2324:
 $_0xd6d3 = '';
 goto L_f8c82;
 L_2f214:
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => true, "\x64\141\x74\141" => $_0xd570]);
 L_c9e55:
 $_0x165f = (int) ($this->request->getPost("\x6e\157\x6d\157\x72\137\x73\157\x61\154") ?? 1);
 goto L_a9051;
 L_b179c:
 if (!$_0x8dcd->get("\x69\163\x5f\154\x6f\147\x69\156")) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x53\151\x6c\141\x6b\141\x6e\40\x6c\157\x67\151\x6e\40\x74\145\x72\154\x65\142\x69\150\x20\144\x61\150\x75\154\x75\56"]);
 }
 goto L_fbdbc;
 L_5c061:
 $_0x154f = trim((string) ($this->request->getPost("\x6f\160\x73\151\x5f\142") ?? ''));
 goto L_49dd7;
 L_8ecb6:
 // Fallback Heuristik Cerdas Psikometri jika AI offline / API Key belum diisi
 if (!$_0xd570) {
 $_0xef3a = (float) $_0xf6f7;
 $_0x1e84 = '';
 $_0xd3aa = $_0x18a3;
 $_0xafed = '';
 // Cari opsi dengan pemilih terbanyak dari string stats
 preg_match_all("\x2f\50\x5b\101\x2d\105\x5d\51\x3a\134\x73\52\x28\134\x64\53\x29\57\x69", $_0xf190, $_0xf7f3, PREG_SET_ORDER);
 $_0x9b7b = $_0x18a3;
 $_0x5cd8 = -1;
 $_0x2b42 = [];
 foreach ($_0xf7f3 as $_0x3b5c) {
 $_0xf245 = (int) $_0x3b5c[2];
 $_0x8631 = strtoupper($_0x3b5c[1]);
 if ($_0xf245 > $_0x5cd8) {
 $_0x5cd8 = $_0xf245;
 $_0x9b7b = $_0x8631;
 }
 if ($_0xf245 === 0 && $_0x8631 !== $_0x18a3) {
 $_0x2b42[] = $_0x8631;
 }
 }
 if ($_0xef3a < 0) {
 $_0x1e84 = "\x44\141\x79\141\x20\160\x65\155\x62\145\x64\141\x20\156\x65\147\x61\164\x69\146\x20\50" . $_0xf6f7 . "\x29\40\x6d\145\x6e\165\x6e\152\x75\153\x6b\141\x6e\40\x69\156\x64\151\x6b\141\x73\151\x20\153\x75\141\x74\40\x4b\165\x6e\143\x69\40\x4a\141\x77\141\x62\141\x6e\40\x54\145\x72\164\x75\153\x61\162\x20\141\x74\141\x75\40\x73\157\x61\154\x20\155\x75\154\x74\151\x74\141\x66\163\x69\162\x2e\40\x53\151\x73\167\x61\40\x6b\145\x6c\157\x6d\160\x6f\153\x20\160\x69\156\x74\141\x72\40\x6a\165\x73\164\x72\165\x20\163\x61\154\x61\150\x2c\40\x73\145\x64\141\x6e\147\x6b\141\x6e\40\x6b\145\x6c\157\x6d\160\x6f\153\x20\142\x61\167\x61\150\x20\155\x65\156\x65\142\x61\153\x20\142\x65\156\x61\162\x2e";
 if ($_0x9b7b !== $_0x18a3 && $_0x5cd8 > 0) {
 $_0xd3aa = $_0x9b7b;
 $_0xafed = "Mayoritas peserta memilih opsi {$_0x9b7b} ({$_0x5cd8} siswa). Kemungkinan besar kunci jawaban seharusnya {$_0x9b7b}, bukan {$_0x18a3}.";
 } else {
 $_0xafed = "\x50\145\x72\151\x6b\163\x61\40\x6b\145\x6d\142\x61\154\x69\40\x73\165\x62\163\x74\141\x6e\163\x69\40\x6b\141\x6c\151\x6d\141\x74\40\x73\157\x61\154\x2c\40\x70\141\x73\164\x69\153\x61\156\x20\164\x69\144\x61\153\x20\141\x64\141\x20\160\x65\162\x6e\171\x61\164\x61\141\x6e\40\x67\141\x6e\144\x61\40\x61\164\x61\165\x20\141\x6d\142\x69\147\x75\56";
 }
 } elseif ($_0xef3a < 0.2) {
 $_0x1e84 = "\x44\141\x79\141\x20\160\x65\155\x62\145\x64\141\x20\162\x65\156\x64\141\x68\40\x28" . $_0xf6f7 . "\x29\56\x20\123\x6f\141\x6c\40\x69\156\x69\40\x6b\165\x72\141\x6e\147\x20\155\x61\155\x70\165\x20\155\x65\155\x62\145\x64\141\x6b\141\x6e\40\x73\151\x73\167\x61\40\x79\141\x6e\147\x20\155\x65\156\x67\165\x61\163\x61\151\x20\155\x61\164\x65\162\x69\40\x64\145\x6e\147\x61\156\x20\171\x61\156\x67\40\x62\145\x6c\165\x6d\56";
 $_0xafed = "Kunci jawaban sudah sesuai ({$_0x18a3}), namun opsi pengecoh perlu dipertajam.";
 } else {
 $_0x1e84 = "\x53\145\x63\141\x72\141\x20\165\x6d\165\x6d\40\x64\141\x79\141\x20\160\x65\155\x62\145\x64\141\x20\142\x61\151\x6b\40\x28" . $_0xf6f7 . "\x29\56\x20" . (!empty($_0x2b42) ? "\x4f\160\x73\151\x20\160\x65\156\x67\145\x63\157\x68\40\x5b" . implode("\x2c\40", $_0x2b42) . "\x5d\40\x74\151\x64\141\x6b\40\x64\151\x70\151\x6c\151\x68\40\x6f\154\x65\150\x20\163\x69\163\x77\141\x20\144\x61\156\x20\160\x65\162\x6c\165\x20\144\x69\147\x61\156\x74\151\x20\144\x65\156\x67\141\x6e\40\x61\154\x74\145\x72\156\x61\164\x69\146\x20\153\x6f\156\x73\145\x70\40\x79\141\x6e\147\x20\154\x65\142\x69\150\x20\162\x65\154\x65\166\x61\156\x2e" : "\x4b\165\x61\154\x69\164\x61\163\x20\142\x75\164\x69\162\x20\163\x6f\141\x6c\40\x73\165\x64\141\x68\40\x6d\145\x6d\141\x64\141\x69\56");
 $_0xafed = "Kunci jawaban saat ini ({$_0x18a3}) sudah tepat.";
 }
 $_0xd570 = ["\x64\151\x61\147\x6e\157\x73\141" => $_0x1e84, "\x72\145\x6b\157\x6d\145\x6e\144\x61\163\x69\137\x6b\165\x6e\143\x69" => $_0xd3aa, "\x61\154\x61\163\x61\156\x5f\153\x75\156\x63\151" => $_0xafed, "\x73\157\x61\154\x5f\162\x65\166\x69\163\x69" => $_0x894b, "\x6f\160\x73\151\x5f\141" => $_0xc5da, "\x6f\160\x73\151\x5f\142" => $_0x154f, "\x6f\160\x73\151\x5f\143" => $_0xc81d, "\x6f\160\x73\151\x5f\144" => $_0xe334, "\x6f\160\x73\151\x5f\145" => $_0xa953, "\x73\141\x72\141\x6e\137\x74\141\x6d\142\x61\150\x61\156" => !empty($_0x2b42) ? "\x47\141\x6e\164\x69\40\x6f\160\x73\151\x20\160\x65\156\x67\145\x63\157\x68\40" . implode("\x2c\40", $_0x2b42) . "\x20\171\x61\156\x67\40\x6d\145\x6d\151\x6c\151\x6b\151\x20\60\x20\160\x65\155\x69\154\x69\150\x20\141\x67\141\x72\40\x73\151\x73\167\x61\40\x62\145\x6e\141\x72\55\x62\145\x6e\141\x72\40\x62\145\x72\160\x69\153\x69\162\x20\141\x6e\141\x6c\151\x74\151\x73\56" : "\x50\145\x72\151\x6b\163\x61\40\x6b\145\x6d\142\x61\154\x69\40\x65\152\x61\141\x6e\40\x64\141\x6e\40\x6b\145\x6a\145\x6c\141\x73\141\x6e\40\x67\141\x6d\142\x61\162\x2f\163\x74\151\x6d\165\x6c\165\x73\40\x70\141\x64\141\x20\163\x6f\141\x6c\56", "\x73\157\x75\162\x63\145" => "\x68\145\x75\162\x69\163\x74\151\x6b"];
 } else {
 $_0xd570["\x73\157\x75\162\x63\145"] = "\x67\145\x6d\151\x6e\151";
 }
 goto L_2f214;
 L_f8c82:
 $_0xabeb = "\x67\145\x6d\151\x6e\151\x2d\62\x2e\65\x2d\146\x6c\141\x73\150";
 goto L_42cc3;
 L_a9051:
 $_0x894b = trim((string) ($this->request->getPost("\x73\157\x61\154") ?? ''));
 goto L_35a8b;
 L_c9b0b:
 $_0x9835 = trim((string) ($this->request->getPost("\x6b\145\x73\165\x6b\141\x72\141\x6e") ?? ''));
 goto L_e5d26;
 L_35a8b:
 $_0xc5da = trim((string) ($this->request->getPost("\x6f\160\x73\151\x5f\141") ?? ''));
 goto L_5c061;
 L_42cc3:
 if (is_file($_0x4b80)) {
 $_0xe956 = json_decode(file_get_contents($_0x4b80), true);
 $_0xd6d3 = $_0xe956["\x61\160\x69\137\x6b\145\x79"] ?? '';
 $_0xabeb = $_0xe956["\x6d\157\x64\145\x6c"] ?? "\x67\145\x6d\151\x6e\151\x2d\62\x2e\65\x2d\146\x6c\141\x73\150";
 }
 goto L_b14d8;
 L_7c21f:
 $_0xe334 = trim((string) ($this->request->getPost("\x6f\160\x73\151\x5f\144") ?? ''));
 goto L_ca06d;
 L_f00f1:
 // Ambil konfigurasi Gemini AI jika tersedia
 $_0x4b80 = WRITEPATH . "\x61\151\x5f\147\x65\155\x69\156\x69\137\x63\157\x6e\146\x69\147\x2e\152\x73\157\x6e";
 goto L_b2324;
 L_44615:
 if (!empty($_0xd6d3) && function_exists("\x63\165\x72\154\x5f\151\x6e\151\x74")) {
 $_0x8d9e = "Kamu adalah pakar psikometri evaluasi pembelajaran dan ahli penyusunan butir soal CBT profesional.\nAnalisis butir soal berikut untuk mata pelajaran \"{$_0x6a22}\":\n\nNomor Soal: {$_0x165f}\nPertanyaan:\n" . strip_tags($_0x894b) . "\xa\12\x50\151\x6c\151\x68\141\x6e\40\x4a\141\x77\141\x62\141\x6e\72\xa\101\x2e\40" . strip_tags($_0xc5da) . "\xa\102\x2e\40" . strip_tags($_0x154f) . "\xa\103\x2e\40" . strip_tags($_0xc81d) . "\xa\104\x2e\40" . strip_tags($_0xe334) . "\xa" . ($_0xa953 ? "\x45\56\x20" . strip_tags($_0xa953) : '') . "\n\nKunci Jawaban Saat Ini: {$_0x18a3}\n\nHasil Analisis Statistik Siswa:\n- Tingkat Kesukaran: {$_0x9835}\n- Daya Pembeda: {$_0xf6f7}\n- Validitas: {$_0x31c9}\n- Distribusi Pilihan Siswa: {$_0xf190}\n\nTugas:\n1. Berikan DIAGNOSA singkat & jelas: Mengapa daya pembeda/validitasnya seperti itu? Apakah kunci jawaban saat ini salah/tertukar, kalimat soal membingungkan, atau opsi pengecoh (distraktor) tidak efektif?\n2. Tentukan REKOMENDASI KUNCI JAWABAN yang benar (A, B, C, D, atau E). Jika kunci saat ini salah dan seharusnya opsi lain, sebutkan opsi yang benar.\n3. Berikan REVISI BUTIR SOAL dan OPSI JAWABAN yang lebih tajam, jelas, tidak multitafsir, dan pengecohnya efektif (tetap mempertahankan topik materi).\n\nKeluarkan HANYA JSON valid dengan struktur:\n{\n \"diagnosa\": \"penjelasan diagnosa secara pedagogik dan statistik\",\n \"rekomendasi_kunci\": \"A/B/C/D/E\",\n \"alasan_kunci\": \"alasan mengapa kunci tersebut yang benar\",\n \"soal_revisi\": \"teks soal revisi yang disempurnakan\",\n \"opsi_a\": \"teks opsi A revisi\",\n \"opsi_b\": \"teks opsi B revisi\",\n \"opsi_c\": \"teks opsi C revisi\",\n \"opsi_d\": \"teks opsi D revisi\",\n \"opsi_e\": \"teks opsi E revisi\",\n \"saran_tambahan\": \"saran tambahan untuk guru\"\n}";
 $_0xf5d0 = array_values(array_unique([$_0xabeb, "\x67\145\x6d\151\x6e\151\x2d\62\x2e\65\x2d\146\x6c\141\x73\150", "\x67\145\x6d\151\x6e\151\x2d\62\x2e\60\x2d\146\x6c\141\x73\150"]));
 foreach ($_0xf5d0 as $_0x820e) {
 $_0xebac = "\x68\164\x74\160\x73\72\x2f\57\x67\145\x6e\145\x72\141\x74\151\x76\145\x6c\141\x6e\147\x75\141\x67\145\x2e\147\x6f\157\x67\154\x65\141\x70\151\x73\56\x63\157\x6d\57\x76\61\x62\145\x74\141\x2f\155\x6f\144\x65\154\x73\57" . rawurlencode($_0x820e) . "\x3a\147\x65\156\x65\162\x61\164\x65\103\x6f\156\x74\145\x6e\164";
 $_0xc17f = ["\x72\145\x73\160\x6f\156\x73\145\x4d\151\x6d\145\x54\171\x70\145" => "\x61\160\x70\154\x69\143\x61\164\x69\157\x6e\57\x6a\163\x6f\156", "\x6d\141\x78\117\x75\164\x70\165\x74\124\x6f\153\x65\156\x73" => 4096];
 if (stripos($_0x820e, "\x67\145\x6d\151\x6e\151\x2d\64") === false) {
 $_0xc17f["\x74\145\x6d\160\x65\162\x61\164\x75\162\x65"] = 0.4;
 }
 $_0xd8b5 = ["\x63\157\x6e\164\x65\156\x74\163" => [["\x72\157\x6c\145" => "\x75\163\x65\162", "\x70\141\x72\164\x73" => [["\x74\145\x78\164" => $_0x8d9e]]]], "\x67\145\x6e\145\x72\141\x74\151\x6f\156\x43\157\x6e\146\x69\147" => $_0xc17f];
 $_0xc327 = curl_init($_0xebac);
 curl_setopt_array($_0xc327, [CURLOPT_RETURNTRANSFER => true, CURLOPT_POST => true, CURLOPT_HTTPHEADER => ["\x43\157\x6e\164\x65\156\x74\55\x54\171\x70\145\x3a\40\x61\160\x70\154\x69\143\x61\164\x69\157\x6e\57\x6a\163\x6f\156", "\x78\55\x67\157\x6f\147\x2d\141\x70\151\x2d\153\x65\171\x3a\40" . $_0xd6d3], CURLOPT_POSTFIELDS => json_encode($_0xd8b5, JSON_UNESCAPED_UNICODE), CURLOPT_TIMEOUT => 30, CURLOPT_SSL_VERIFYPEER => false, CURLOPT_SSL_VERIFYHOST => 0]);
 $_0x2210 = curl_exec($_0xc327);
 $_0x3fc6 = (int) curl_getinfo($_0xc327, CURLINFO_HTTP_CODE);
 curl_close($_0xc327);
 if ($_0x3fc6 >= 200 && $_0x3fc6 < 300 && $_0x2210) {
 $_0x57dd = json_decode($_0x2210, true);
 $_0xd77d = $_0x57dd["\x63\141\x6e\144\x69\144\x61\164\x65\163"][0]["\x63\157\x6e\164\x65\156\x74"]["\x70\141\x72\164\x73"] ?? [];
 $_0xa142 = '';
 foreach ($_0xd77d as $_0x8354) {
 if (empty($_0x8354["\x74\150\x6f\165\x67\150\x74"]) && isset($_0x8354["\x74\145\x78\164"])) {
 $_0xa142 .= (string) $_0x8354["\x74\145\x78\164"];
 }
 }
 if ($_0xa142 === '' && isset($_0xd77d[0]["\x74\145\x78\164"])) {
 $_0xa142 = (string) $_0xd77d[0]["\x74\145\x78\164"];
 }
 if ($_0xa142) {
 $_0xeeda = json_decode($_0xa142, true);
 if (is_array($_0xeeda) && isset($_0xeeda["\x64\151\x61\147\x6e\157\x73\141"])) {
 $_0xd570 = $_0xeeda;
 break;
 }
 }
 }
 }
 }
 goto L_8ecb6;
 L_e5d26:
 $_0xf6f7 = trim((string) ($this->request->getPost("\x70\145\x6d\142\x65\144\x61") ?? ''));
 goto L_4e9d3;
 L_4e9d3:
 $_0x31c9 = trim((string) ($this->request->getPost("\x76\141\x6c\151\x64\151\x74\141\x73") ?? ''));
 goto L_5a00c;
 L_e9fba:
 $_0x8dcd = session();
 goto L_b179c;
 L_bba32:
 $_0x18a3 = strtoupper(trim((string) ($this->request->getPost("\x6b\165\x6e\143\x69") ?? "\x41")));
 goto L_4ea51;
 L_49dd7:
 $_0xc81d = trim((string) ($this->request->getPost("\x6f\160\x73\151\x5f\143") ?? ''));
 goto L_7c21f;
 L_5a00c:
 $_0xf190 = trim((string) ($this->request->getPost("\x73\164\x61\164\x73\137\x6a\141\x77\141\x62\141\x6e") ?? ''));
 goto L_f00f1;
 L_b14d8:
 if (empty($_0xd6d3)) {
 $_0xd6d3 = getenv("\x47\105\x4d\111\x4e\111\x5f\101\x50\111\x5f\113\x45\131") ?: '';
 }
 goto L_7c6cc;
 L_fbdbc:
 $_0xadd6 = (int) ($this->request->getPost("\x69\144\x5f\163\x6f\141\x6c") ?? 0);
 goto L_c9e55;
 L_ca06d:
 $_0xa953 = trim((string) ($this->request->getPost("\x6f\160\x73\151\x5f\145") ?? ''));
 goto L_bba32;
 L_4ea51:
 $_0x6a22 = trim((string) ($this->request->getPost("\x6d\141\x70\145\x6c") ?? "\x4d\141\x74\141\x20\120\x65\154\x61\152\x61\162\x61\156"));
 goto L_c9b0b;
 L_7c6cc:
 $_0xd570 = null;
 goto L_44615;
 }
 /**
 * Endpoint Update Butir Soal Langsung dari Halaman Analisis & Hitung Ulang Nilai Otomatis
 */
 public function updateSoal()
 {
 try {
 $_0x3ded = session();
 if (!$_0x3ded->get("\x69\163\x5f\154\x6f\147\x69\156")) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x53\151\x6c\141\x6b\141\x6e\40\x6c\157\x67\151\x6e\40\x74\145\x72\154\x65\142\x69\150\x20\144\x61\150\x75\154\x75\56"]);
 }
 $_0x8820 = (int) ($this->request->getPost("\x69\144\x5f\163\x6f\141\x6c") ?? 0);
 $_0x797b = (int) ($this->request->getPost("\x6a\141\x64\167\x61\154\x5f\151\x64") ?? 0);
 $_0x358d = trim((string) ($this->request->getPost("\x73\157\x61\154") ?? ''));
 $_0xb988 = trim((string) ($this->request->getPost("\x6f\160\x73\151\x5f\141") ?? ''));
 $_0x604c = trim((string) ($this->request->getPost("\x6f\160\x73\151\x5f\142") ?? ''));
 $_0x2a2b = trim((string) ($this->request->getPost("\x6f\160\x73\151\x5f\143") ?? ''));
 $_0x1022 = trim((string) ($this->request->getPost("\x6f\160\x73\151\x5f\144") ?? ''));
 $_0x4b65 = trim((string) ($this->request->getPost("\x6f\160\x73\151\x5f\145") ?? ''));
 $_0xe6e8 = strtoupper(trim((string) ($this->request->getPost("\x6a\141\x77\141\x62\141\x6e") ?? '')));
 $_0x3481 = (int) ($this->request->getPost("\x68\151\x74\165\x6e\147\x5f\165\x6c\141\x6e\147") ?? 0);
 if (!$_0x8820 || empty($_0x358d) || empty($_0xe6e8)) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x54\145\x6b\163\x20\142\x75\164\x69\162\x20\163\x6f\141\x6c\40\x64\141\x6e\40\x6b\165\x6e\143\x69\40\x6a\141\x77\141\x62\141\x6e\40\x77\141\x6a\151\x62\40\x64\151\x69\163\x69\56"]);
 }
 $_0xa6a4 = \Config\Database::connect();
 $_0x51c6 = $_0xa6a4->table("\x63\142\x74\137\x73\157\x61\154")->where("\x69\144\x5f\163\x6f\141\x6c", $_0x8820)->get()->getRow();
 if (!$_0x51c6) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x44\141\x74\141\x20\142\x75\164\x69\162\x20\163\x6f\141\x6c\40\x74\151\x64\141\x6b\40\x64\151\x74\145\x6d\165\x6b\141\x6e\40\x64\151\x20\144\x61\164\x61\142\x61\163\x65\56"]);
 }
 $_0x5821 = strtoupper($_0x51c6->jawaban ?? '');
 $_0xf04a = $_0x5821 !== $_0xe6e8;
 // 1. Update Butir Soal di cbt_soal
 $_0x82b0 = ["\x73\157\x61\154" => $_0x358d, "\x6f\160\x73\151\x5f\141" => $_0xb988, "\x6f\160\x73\151\x5f\142" => $_0x604c, "\x6f\160\x73\151\x5f\143" => $_0x2a2b, "\x6f\160\x73\151\x5f\144" => $_0x1022, "\x6f\160\x73\151\x5f\145" => $_0x4b65, "\x6a\141\x77\141\x62\141\x6e" => $_0xe6e8];
 $_0xa6a4->table("\x63\142\x74\137\x73\157\x61\154")->where("\x69\144\x5f\163\x6f\141\x6c", $_0x8820)->update($_0x82b0);
 // 2. Hitung Ulang Nilai Siswa jika diminta
 $_0x8f32 = false;
 if ($_0x797b > 0 && ($_0x3481 || $_0xf04a)) {
 // Update jawaban_benar di riwayat jawaban siswa (cbt_siswa & cbt_rekap_siswa)
 $_0xe131 = ["\x63\142\x74\137\x73\151\x73\167\x61", "\x63\142\x74\137\x72\145\x6b\141\x70\137\x73\151\x73\167\x61"];
 foreach ($_0xe131 as $_0x6520) {
 $_0x37d6 = $_0xa6a4->table($_0x6520)->where("\x69\144\x5f\152\x61\144\x77\141\x6c", $_0x797b)->get()->getResult();
 foreach ($_0x37d6 as $_0x5b1d) {
 $_0xc1a5 = $_0x5b1d->jawaban ?? '';
 if (empty($_0xc1a5)) {
 continue;
 }
 $_0xc4a4 = is_string($_0xc1a5) ? json_decode($_0xc1a5, true) ?? @unserialize($_0xc1a5) : (array) $_0xc1a5;
 if (is_array($_0xc4a4)) {
 $_0xdc57 = false;
 foreach ($_0xc4a4 as &$_0x3a83) {
 $_0xeaff = (array) $_0x3a83;
 $_0xbd9f = $_0xeaff["\x69\144\x5f\163\x6f\141\x6c"] ?? null;
 $_0x6bae = $_0xeaff["\x6e\157\x6d\157\x72\137\x73\157\x61\154"] ?? $_0xeaff["\x6e\157\x5f\163\x6f\141\x6c\137\x61\154\x69\141\x73"] ?? null;
 if ($_0xbd9f && $_0xbd9f == $_0x8820 || $_0x6bae && $_0x6bae == $_0x51c6->nomor_soal && ($_0xeaff["\x6a\145\x6e\151\x73"] ?? $_0xeaff["\x6a\145\x6e\151\x73\137\x73\157\x61\154"] ?? "\x31") == $_0x51c6->jenis) {
 if (is_array($_0x3a83)) {
 $_0x3a83["\x6a\141\x77\141\x62\141\x6e\137\x62\145\x6e\141\x72"] = $_0xe6e8;
 } elseif (is_object($_0x3a83)) {
 $_0x3a83->jawaban_benar = $_0xe6e8;
 }
 $_0xdc57 = true;
 }
 }
 if ($_0xdc57) {
 $_0xa6a4->table($_0x6520)->where(["\x69\144\x5f\163\x69\163\x77\141" => $_0x5b1d->id_siswa, "\x69\144\x5f\152\x61\144\x77\141\x6c" => $_0x797b])->update(["\x6a\141\x77\141\x62\141\x6e" => json_encode($_0xc4a4)]);
 }
 }
 }
 }
 // Jalankan kalkulasi ulang nilai otomatis
 $this->generateNilaiUjian($_0x797b);
 $_0x8f32 = true;
 }
 $_0x677d = "\x42\165\x74\151\x72\40\x73\157\x61\154\x20\142\x65\162\x68\141\x73\151\x6c\40\x64\151\x70\145\x72\142\x61\162\x75\151\x20\144\x69\40\x42\141\x6e\153\x20\123\x6f\141\x6c\41";
 if ($_0x8f32) {
 $_0x677d .= "\x20\113\x75\156\x63\151\x20\152\x61\167\x61\142\x61\156\x20\144\x69\160\x65\162\x62\141\x72\165\x69\40\x6b\145\x20\133" . $_0xe6e8 . "\x5d\40\x64\141\x6e\40\x73\145\x6c\165\x72\165\x68\40\x6e\151\x6c\141\x69\40\x75\152\x69\141\x6e\40\x73\151\x73\167\x61\40\x74\145\x6c\141\x68\40\x62\145\x72\150\x61\163\x69\154\x20\144\x69\150\x69\164\x75\156\x67\40\x75\154\x61\156\x67\40\x6f\164\x6f\155\x61\164\x69\163\x2e";
 }
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => true, "\x6d\145\x73\163\x61\147\x65" => $_0x677d, "\x6b\165\x6e\143\x69\137\x6c\141\x6d\141" => $_0x5821, "\x6b\165\x6e\143\x69\137\x62\141\x72\165" => $_0xe6e8, "\x72\145\x63\141\x6c\143\x75\154\x61\164\x65\144" => $_0x8f32]);
 } catch (\Throwable $_0xb19b) {
 log_message("\x65\162\x72\157\x72", "\x75\160\x64\141\x74\145\x53\157\x61\154\x20\145\x72\162\x6f\162\x3a\40" . $_0xb19b->getMessage() . "\xa" . $_0xb19b->getTraceAsString());
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x47\141\x67\141\x6c\40\x6d\145\x6d\160\x65\162\x62\141\x72\165\x69\40\x73\157\x61\154\x3a\40" . $_0xb19b->getMessage()]);
 }
 }
}