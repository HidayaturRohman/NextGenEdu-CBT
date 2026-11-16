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
class Cbtstatus extends BaseController
{
 public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $_0xe10c)
 {
 parent::initController($request, $response, $_0xe10c);
 }
 private function getDistinctRuang($_0xfd15, $_0x1710, $_0xf8a6)
 {
 goto L_ab90f;
 L_c24df:
 $_0x3a9c->orderBy("\x63\56\x6e\141\x6d\141\x5f\163\x65\163\x69", "\x41\123\x43");
 goto L_51d63;
 L_d96db:
 if (empty($_0xddae)) {
 $_0x719e = $_0x5bcd->table("\x63\142\x74\137\x73\145\x73\151")->orderBy("\x6e\141\x6d\141\x5f\163\x65\163\x69", "\x41\123\x43")->get()->getResult();
 foreach ($_0x719e as $_0xbcd7) {
 if (!empty($_0xbcd7->id_sesi)) {
 $_0xddae[$_0xbcd7->id_sesi] = $_0xbcd7->nama_sesi;
 }
 }
 }
 goto L_655b8;
 L_3db9a:
 $_0x42cd = [];
 goto L_05ac3;
 L_ab90f:
 $_0x5bcd = \Config\Database::connect();
 goto L_cc1c7;
 L_d5984:
 $_0x3a9c->select("\x61\56\x72\165\x61\156\x67\137\x69\144\x2c\40\x61\56\x73\145\x73\151\x5f\151\x64\54\x20\142\x2e\153\x6f\144\x65\137\x72\165\x61\156\x67\54\x20\142\x2e\156\x61\155\x61\137\x72\165\x61\156\x67\54\x20\143\x2e\153\x6f\144\x65\137\x73\145\x73\151\x2c\40\x63\56\x6e\141\x6d\141\x5f\163\x65\163\x69");
 goto L_04104;
 L_69758:
 $_0x92e1 = is_array($_0xf8a6) ? array_values(array_filter($_0xf8a6, function ($_0x9f73) {
 return $_0x9f73 !== null && $_0x9f73 !== '' && $_0x9f73 !== "\x30" && $_0x9f73 !== 0;
 })) : [];
 goto L_dc1bf;
 L_3d182:
 $_0x3a9c->join("\x63\142\x74\137\x72\165\x61\156\x67\40\x62", "\x62\56\x69\144\x5f\162\x75\141\x6e\147\x3d\141\x2e\162\x75\141\x6e\147\x5f\151\x64");
 goto L_028ec;
 L_8da72:
 // Fallback: jika cbt_sesi_siswa belum terdaftar, ambil semua master ruang dan sesi
 if (empty($_0x42cd)) {
 $_0x8338 = $_0x5bcd->table("\x63\142\x74\137\x72\165\x61\156\x67")->orderBy("\x6e\141\x6d\141\x5f\162\x75\141\x6e\147", "\x41\123\x43")->get()->getResult();
 foreach ($_0x8338 as $_0xfe1f) {
 if (!empty($_0xfe1f->id_ruang)) {
 $_0x42cd[$_0xfe1f->id_ruang] = $_0xfe1f->nama_ruang;
 }
 }
 }
 goto L_d96db;
 L_05ac3:
 $_0xddae = [];
 goto L_2b2ef;
 L_2b2ef:
 if ($_0x1eae) {
 foreach ($_0x1eae as $_0xedac) {
 if (!empty($_0xedac->ruang_id) && !empty($_0xedac->nama_ruang)) {
 $_0x42cd[$_0xedac->ruang_id] = $_0xedac->nama_ruang;
 }
 if (!empty($_0xedac->sesi_id) && !empty($_0xedac->nama_sesi)) {
 $_0xddae[$_0xedac->sesi_id] = $_0xedac->nama_sesi;
 }
 }
 }
 goto L_8da72;
 L_cc1c7:
 $_0x3a9c = $_0x5bcd->table("\x63\142\x74\137\x73\145\x73\151\x5f\163\x69\163\x77\141\x20\141");
 goto L_57e70;
 L_028ec:
 $_0x3a9c->join("\x63\142\x74\137\x73\145\x73\151\x20\143", "\x63\56\x69\144\x5f\163\x65\163\x69\75\x61\56\x73\145\x73\151\x5f\151\x64");
 goto L_69758;
 L_04104:
 if (!empty($_0xfd15)) {
 $_0x3a9c->where("\x61\56\x74\160\x5f\151\x64", $_0xfd15);
 }
 goto L_78e45;
 L_655b8:
 return ["\x72\165\x61\156\x67" => $_0x42cd, "\x73\145\x73\151" => $_0xddae];
 L_7b9d6:
 $_0x3a9c->orderBy("\x62\56\x6e\141\x6d\141\x5f\162\x75\141\x6e\147", "\x41\123\x43");
 goto L_c24df;
 L_57e70:
 $_0x3a9c->distinct();
 goto L_d5984;
 L_78e45:
 if (!empty($_0x1710)) {
 $_0x3a9c->where("\x61\56\x73\155\x74\137\x69\144", $_0x1710);
 }
 goto L_3d182;
 L_51d63:
 $_0x1eae = $_0x3a9c->get()->getResult();
 goto L_3db9a;
 L_dc1bf:
 if (count($_0x92e1) > 0) {
 $_0x3a9c->whereIn("\x61\56\x6b\145\x6c\141\x73\137\x69\144", $_0x92e1);
 }
 goto L_7b9d6;
 }
 private function getPengawasByGuru($_0xcf48, $_0xa08b, $_0x43ad)
 {
 goto L_349b7;
 L_7ca1c:
 $_0xf227->where("\x61\56\x69\144\x5f\163\x6d\164", $_0xa08b);
 goto L_fc3dc;
 L_efb05:
 $_0xf227 = $_0x97f6->table("\x63\142\x74\137\x70\145\x6e\147\x61\167\x61\163\x20\141");
 goto L_bedce;
 L_fc3dc:
 $_0xf227->like("\x61\56\x69\144\x5f\147\x75\162\x75", $_0x43ad);
 goto L_37645;
 L_37645:
 $_0xf227->join("\x63\142\x74\137\x6a\141\x64\167\x61\154\x20\142", "\x62\56\x69\144\x5f\152\x61\144\x77\141\x6c\75\x61\56\x69\144\x5f\152\x61\144\x77\141\x6c");
 goto L_e4c1c;
 L_cf0dd:
 $_0xf227->join("\x6d\141\x73\164\x65\162\x5f\155\x61\160\x65\154\x20\145", "\x65\56\x69\144\x5f\155\x61\160\x65\154\x3d\143\x2e\142\x61\156\x6b\137\x6d\141\x70\145\x6c\137\x69\144", "\x6c\145\x66\164");
 goto L_15897;
 L_12f0a:
 $_0xf227->where("\x61\56\x69\144\x5f\164\x70", $_0xcf48);
 goto L_7ca1c;
 L_bedce:
 $_0xf227->select("\x61\56\x69\144\x5f\160\x65\156\x67\141\x77\141\x73\54\x20\141\x2e\151\x64\137\x6a\141\x64\167\x61\154\x2c\40\x61\56\x69\144\x5f\162\x75\141\x6e\147\x2c\40\x61\56\x69\144\x5f\163\x65\163\x69\54\x20\141\x2e\151\x64\137\x67\165\x72\165\x2c\40\x61\56\x6a\141\x6d\137\x6b\145\x2c" . "\x20\142\x2e\164\x67\154\x5f\155\x75\154\x61\151\x2c\40\x62\56\x74\147\x6c\137\x73\145\x6c\145\x73\141\x69\54\x20\143\x2e\142\x61\156\x6b\137\x6b\157\x64\145\x2c\40\x63\56\x62\141\x6e\153\x5f\154\x65\166\x65\154\x2c\40\x63\56\x62\141\x6e\153\x5f\155\x61\160\x65\154\x5f\151\x64\54\x20\144\x2e\153\x6f\144\x65\137\x6a\145\x6e\151\x73\54\x20\145\x2e\153\x6f\144\x65\54\x20\145\x2e\156\x61\155\x61\137\x6d\141\x70\145\x6c");
 goto L_12f0a;
 L_15897:
 return $_0xf227->get()->getResult();
 L_349b7:
 $_0x97f6 = \Config\Database::connect();
 goto L_efb05;
 L_e4c1c:
 $_0xf227->join("\x63\142\x74\137\x62\141\x6e\153\x5f\163\x6f\141\x6c\40\x63", "\x62\56\x69\144\x5f\142\x61\156\x6b\75\x63\56\x69\144\x5f\142\x61\156\x6b");
 goto L_ecee0;
 L_ecee0:
 $_0xf227->join("\x63\142\x74\137\x6a\145\x6e\151\x73\40\x64", "\x64\56\x69\144\x5f\152\x65\156\x69\163\x3d\142\x2e\151\x64\137\x6a\145\x6e\151\x73", "\x6c\145\x66\164");
 goto L_cf0dd;
 }
 private function getJadwalById($_0xd402, $_0xa2ce = null)
 {
 goto L_35fbc;
 L_a9b59:
 $_0x39df->select("\x61\56\x2a\54\x20\142\x2e\157\x70\163\x69\54\x20\142\x2e\142\x61\156\x6b\137\x6b\157\x64\145\x2c\40\x62\56\x62\141\x6e\153\x5f\154\x65\166\x65\154\x2c\40\x62\56\x62\141\x6e\153\x5f\153\x65\154\x61\163\x2c" . "\x20\142\x2e\164\x61\155\x70\151\x6c\137\x70\147\x2c\40\x62\56\x74\141\x6d\160\x69\154\x5f\153\x6f\155\x70\154\x65\153\x73\54\x20\142\x2e\164\x61\155\x70\151\x6c\137\x6a\157\x64\157\x68\153\x61\156\x2c\40\x62\56\x74\141\x6d\160\x69\154\x5f\151\x73\151\x61\156\x2c\40\x62\56\x74\141\x6d\160\x69\154\x5f\145\x73\141\x69\54" . "\x20\142\x2e\142\x6f\142\x6f\164\x5f\160\x67\54\x20\142\x2e\142\x6f\142\x6f\164\x5f\153\x6f\155\x70\154\x65\153\x73\54\x20\142\x2e\142\x6f\142\x6f\164\x5f\152\x6f\144\x6f\150\x6b\141\x6e\54\x20\142\x2e\142\x6f\142\x6f\164\x5f\151\x73\151\x61\156\x2c\40\x62\56\x62\157\x62\157\x74\137\x65\163\x61\151\x2c" . "\x20\142\x2e\151\x64\137\x62\141\x6e\153\x2c\40\x62\56\x62\141\x6e\153\x5f\147\x75\162\x75\137\x69\144\x2c\40\x62\56\x73\157\x61\154\x5f\141\x67\141\x6d\141\x2c\40\x63\56\x6b\157\x64\145\x5f\152\x65\156\x69\163\x2c\40\x63\56\x6e\141\x6d\141\x5f\152\x65\156\x69\163\x2c" . "\x20\144\x2e\151\x64\137\x6d\141\x70\145\x6c\54\x20\144\x2e\153\x6f\144\x65\54\x20\144\x2e\156\x61\155\x61\137\x6d\141\x70\145\x6c\54\x20\146\x2e\151\x64\137\x67\165\x72\165\x2c\40\x66\56\x6e\141\x6d\141\x5f\147\x75\162\x75");
 goto L_d99a1;
 L_82ac8:
 $_0x39df = $_0x909b->table("\x63\142\x74\137\x6a\141\x64\167\x61\154\x20\141");
 goto L_a9b59;
 L_40144:
 if ($_0xa2ce != null) {
 $_0x39df->join("\x63\142\x74\137\x73\145\x73\151\x20\145", "\x65\56\x69\144\x5f\163\x65\163\x69\75" . (int) $_0xa2ce, "\x6c\145\x66\164");
 }
 goto L_00970;
 L_d99a1:
 $_0x39df->join("\x63\142\x74\137\x62\141\x6e\153\x5f\163\x6f\141\x6c\40\x62", "\x62\56\x69\144\x5f\142\x61\156\x6b\75\x61\56\x69\144\x5f\142\x61\156\x6b", "\x6c\145\x66\164");
 goto L_f2a07;
 L_00970:
 $_0x39df->join("\x6d\141\x73\164\x65\162\x5f\147\x75\162\x75\40\x66", "\x66\56\x69\144\x5f\147\x75\162\x75\75\x62\56\x62\141\x6e\153\x5f\147\x75\162\x75\137\x69\144", "\x6c\145\x66\164");
 goto L_ecd68;
 L_f2a07:
 $_0x39df->join("\x63\142\x74\137\x6a\145\x6e\151\x73\40\x63", "\x63\56\x69\144\x5f\152\x65\156\x69\163\x3d\141\x2e\151\x64\137\x6a\145\x6e\151\x73", "\x6c\145\x66\164");
 goto L_7da31;
 L_ecd68:
 $_0x39df->where("\x61\56\x69\144\x5f\152\x61\144\x77\141\x6c", $_0xd402);
 goto L_3c5fc;
 L_3c5fc:
 return $_0x39df->get()->getRow();
 L_35fbc:
 $_0x909b = \Config\Database::connect();
 goto L_82ac8;
 L_7da31:
 $_0x39df->join("\x6d\141\x73\164\x65\162\x5f\155\x61\160\x65\154\x20\144", "\x64\56\x69\144\x5f\155\x61\160\x65\154\x3d\142\x2e\142\x61\156\x6b\137\x6d\141\x70\145\x6c\137\x69\144", "\x6c\145\x66\164");
 goto L_40144;
 }
 private function getAllJadwal($_0x7d6c, $_0xfca1, $_0xbbd1 = null)
 {
 goto L_dc229;
 L_9b98a:
 $_0xae0d->select("\x61\56\x62\141\x6e\153\x5f\153\x6f\144\x65\54\x20\141\x2e\142\x61\156\x6b\137\x6b\145\x6c\141\x73\54\x20\142\x2e\151\x64\137\x6a\141\x64\167\x61\154\x2c\40\x64\56\x6b\157\x64\145");
 goto L_8c656;
 L_dc229:
 $_0xee2a = \Config\Database::connect();
 goto L_bad0d;
 L_0fa57:
 if ($_0xbbd1 != null) {
 $_0xae0d->where("\x61\56\x62\141\x6e\153\x5f\147\x75\162\x75\137\x69\144", $_0xbbd1);
 }
 goto L_d638d;
 L_bad0d:
 $_0xae0d = $_0xee2a->table("\x63\142\x74\137\x62\141\x6e\153\x5f\163\x6f\141\x6c\40\x61");
 goto L_9b98a;
 L_ae58d:
 $_0xae0d->join("\x6d\141\x73\164\x65\162\x5f\155\x61\160\x65\154\x20\144", "\x64\56\x69\144\x5f\155\x61\160\x65\154\x3d\141\x2e\142\x61\156\x6b\137\x6d\141\x70\145\x6c\137\x69\144", "\x6c\145\x66\164");
 goto L_0fa57;
 L_d638d:
 $_0xae0d->where("\x62\56\x69\144\x5f\164\x70", $_0x7d6c);
 goto L_0a4e9;
 L_8c656:
 $_0xae0d->join("\x63\142\x74\137\x6a\141\x64\167\x61\154\x20\142", "\x62\56\x69\144\x5f\142\x61\156\x6b\75\x61\56\x69\144\x5f\142\x61\156\x6b");
 goto L_ae58d;
 L_0a4e9:
 $_0xae0d->where("\x62\56\x69\144\x5f\163\x6d\164", $_0xfca1);
 goto L_f55ee;
 L_f55ee:
 return $_0xae0d->get()->getResult();
 }
 private function getDropJadwalGuru($_0x141d, $_0x7bde, $_0xc3d8)
 {
 goto L_06588;
 L_5ee44:
 return $_0x6efc;
 L_72af8:
 $_0xbea0->where("\x61\56\x69\144\x5f\163\x6d\164", $_0x7bde);
 goto L_f2483;
 L_52e71:
 $_0xbea0->select("\x61\56\x69\144\x5f\152\x61\144\x77\141\x6c\54\x20\142\x2e\142\x61\156\x6b\137\x6b\157\x64\145");
 goto L_0b3ea;
 L_bc85c:
 if ($_0x5b9f) {
 foreach ($_0x5b9f as $_0x4693) {
 $_0x6efc[$_0x4693->id_jadwal] = $_0x4693->bank_kode;
 }
 }
 goto L_5ee44;
 L_4abea:
 $_0x6efc = [];
 goto L_bc85c;
 L_ed0d9:
 $_0xbea0->where("\x61\56\x69\144\x5f\164\x70", $_0x141d);
 goto L_72af8;
 L_0b3ea:
 $_0xbea0->join("\x63\142\x74\137\x62\141\x6e\153\x5f\163\x6f\141\x6c\40\x62", "\x62\56\x69\144\x5f\142\x61\156\x6b\75\x61\56\x69\144\x5f\142\x61\156\x6b\40\x41\116\x44\40\x62\56\x62\141\x6e\153\x5f\147\x75\162\x75\137\x69\144\x3d" . (int) $_0xc3d8);
 goto L_ed0d9;
 L_f2483:
 $_0x5b9f = $_0xbea0->get()->getResult();
 goto L_4abea;
 L_06588:
 $_0x1089 = \Config\Database::connect();
 goto L_fbffa;
 L_fbffa:
 $_0xbea0 = $_0x1089->table("\x63\142\x74\137\x6a\141\x64\167\x61\154\x20\141");
 goto L_52e71;
 }
 public function getNamaKelasByArrId($_0x1ac6, $_0x7505, $_0x7112)
 {
 goto L_d876c;
 L_9f1b3:
 if (empty($_0x13b3)) {
 $_0x13b3 = $_0x2fa2->table("\x6d\141\x73\164\x65\162\x5f\153\x65\154\x61\163")->select("\x69\144\x5f\153\x65\154\x61\163\x2c\156\x61\155\x61\137\x6b\145\x6c\141\x73")->get()->getResult();
 }
 goto L_4e9b5;
 L_a59c2:
 return $_0x21bd;
 L_10979:
 $_0x13b3 = $_0xf1e1->get()->getResult();
 goto L_35af3;
 L_ca231:
 if ($_0x13b3) {
 foreach ($_0x13b3 as $_0x90db) {
 if (!empty($_0x90db->id_kelas)) {
 $_0x21bd[$_0x90db->id_kelas] = $_0x90db->nama_kelas;
 }
 }
 }
 goto L_a59c2;
 L_57b0c:
 $_0x9649 = is_array($_0x7112) ? array_values(array_filter($_0x7112, function ($_0xb671) {
 return $_0xb671 !== null && $_0xb671 !== '' && $_0xb671 !== "\x30" && $_0xb671 !== 0;
 })) : [];
 goto L_49358;
 L_d876c:
 $_0x2fa2 = \Config\Database::connect();
 goto L_5acb3;
 L_49358:
 if (count($_0x9649) > 0) {
 $_0xf1e1->whereIn("\x69\144\x5f\153\x65\154\x61\163", $_0x9649);
 }
 goto L_41db5;
 L_ab0a3:
 $_0xf1e1->select("\x69\144\x5f\153\x65\154\x61\163\x2c\156\x61\155\x61\137\x6b\145\x6c\141\x73");
 goto L_57b0c;
 L_b182b:
 if (!empty($_0x7505)) {
 $_0xf1e1->where("\x69\144\x5f\163\x6d\164", $_0x7505);
 }
 goto L_10979;
 L_4e9b5:
 $_0x21bd = [];
 goto L_ca231;
 L_35af3:
 // Fallback jika tidak ditemukan dengan filter TP/SMT
 if (empty($_0x13b3) && count($_0x9649) > 0) {
 $_0x13b3 = $_0x2fa2->table("\x6d\141\x73\164\x65\162\x5f\153\x65\154\x61\163")->select("\x69\144\x5f\153\x65\154\x61\163\x2c\156\x61\155\x61\137\x6b\145\x6c\141\x73")->whereIn("\x69\144\x5f\153\x65\154\x61\163", $_0x9649)->get()->getResult();
 }
 goto L_9f1b3;
 L_41db5:
 if (!empty($_0x1ac6)) {
 $_0xf1e1->where("\x69\144\x5f\164\x70", $_0x1ac6);
 }
 goto L_b182b;
 L_5acb3:
 $_0xf1e1 = $_0x2fa2->table("\x6d\141\x73\164\x65\162\x5f\153\x65\154\x61\163");
 goto L_ab0a3;
 }
 public function index()
 {
 goto L_14db9;
 L_b6644:
 $_0x5a3d["\x73\155\x74"] = (new \App\Models\DashboardModel())->getSemester();
 goto L_87cd5;
 L_ed6c5:
 return view("\x63\142\x74\57\x73\164\x61\164\x75\163\x2f\144\x61\164\x61\137\x73\164\x61\164\x75\163", $_0x5a3d);
 L_8f9db:
 $_0xeb4d = in_array((string) $_0x1b37->get("\x72\157\x6c\145"), ["\x31", "\x34"]);
 goto L_e850f;
 L_bed68:
 $_0x5a3d = ["\x75\163\x65\162" => $_0xaa61, "\x6a\165\x64\165\x6c" => "\x53\164\x61\164\x75\163\x20\125\x6a\151\x61\156\x20\123\x69\163\x77\141", "\x73\165\x62\152\x75\144\x75\154" => "\x53\164\x61\164\x75\163\x20\123\x69\163\x77\141", "\x73\145\x74\164\x69\156\x67" => (new \App\Models\DashboardModel())->getSetting()];
 goto L_d6557;
 L_01bdc:
 $_0xb48d = (new \App\Models\DashboardModel())->getSemesterActive();
 goto L_a9845;
 L_87cd5:
 $_0x5a3d["\x73\155\x74\137\x61\143\x74\151\x76\145"] = $_0xb48d;
 goto L_f9091;
 L_c73d5:
 if (!$_0xeb4d) {
 $_0x2d60 = (new \App\Models\DashboardModel())->getDataGuruByUserId($_0xaa61->id, $_0x452a->id_tp, $_0xb48d->id_smt);
 $_0x5a3d["\x67\165\x72\165"] = $_0x2d60;
 }
 goto L_ed6c5;
 L_af6a8:
 $_0x2898 = $this->getKioskExitCodeData();
 goto L_76a61;
 L_d57da:
 $_0x5a3d["\x69\156\x69\164\x5f\162\x75\141\x6e\147"] = $_0x6637["\x72\165\x61\156\x67"] ?? [];
 goto L_d7bcb;
 L_d6557:
 $_0x452a = (new \App\Models\DashboardModel())->getTahunActive();
 goto L_01bdc;
 L_7d4dd:
 $_0x6637 = $this->getDistinctRuang($_0x452a->id_tp ?? null, $_0xb48d->id_smt ?? null, []);
 goto L_7add3;
 L_76a61:
 $_0x5a3d["\x6b\151\x6f\163\x6b\137\x65\170\x69\164\x5f\143\x6f\144\x65"] = $_0x2898["\x63\157\x64\145"];
 goto L_1781b;
 L_14db9:
 $_0x1b37 = session();
 goto L_8f9db;
 L_486d9:
 $_0x5a3d["\x74\160\x5f\141\x63\164\x69\166\x65"] = $_0x452a;
 goto L_b6644;
 L_a9845:
 $_0x5a3d["\x74\160"] = (new \App\Models\DashboardModel())->getTahun();
 goto L_486d9;
 L_e850f:
 $_0xaa61 = (object) ["\x69\144" => $_0x1b37->get("\x69\144\x5f\165\x73\145\x72"), "\x75\163\x65\162\x6e\141\x6d\145" => $_0x1b37->get("\x75\163\x65\162\x6e\141\x6d\145"), "\x66\151\x72\163\x74\137\x6e\141\x6d\145" => $_0x1b37->get("\x75\163\x65\162\x6e\141\x6d\145"), "\x72\157\x6c\145\x5f\156\x61\155\x65" => $_0x1b37->get("\x72\157\x6c\145\x5f\156\x61\155\x65"), "\x66\157\x74\157" => $_0x1b37->get("\x66\157\x74\157") ?? ''];
 goto L_bed68;
 L_75dfe:
 $_0x5a3d["\x69\156\x69\164\x5f\153\x65\154\x61\163"] = $_0x9114 ?? [];
 goto L_c73d5;
 L_f9091:
 $_0x5a3d["\x69\163\x5f\141\x64\155\x69\156"] = true;
 goto L_af6a8;
 L_7add3:
 $_0x9114 = $this->getNamaKelasByArrId($_0x452a->id_tp ?? null, $_0xb48d->id_smt ?? null, []);
 goto L_d57da;
 L_1781b:
 $_0xd66c = \Config\Database::connect();
 goto L_7d4dd;
 L_d7bcb:
 $_0x5a3d["\x69\156\x69\164\x5f\163\x65\163\x69"] = $_0x6637["\x73\145\x73\151"] ?? [];
 goto L_75dfe;
 }
 public function getJadwalUjianByJadwal()
 {
 goto L_8d5db;
 L_13042:
 $_0x49c6 = (new \App\Models\DropdownModel())->getNamaKelasByArrId($_0xcae1->id_tp, $_0xcae1->id_smt, $_0xc766);
 goto L_7c8cc;
 L_81ab9:
 $_0x88de["\x74\160"] = (new \App\Models\DashboardModel())->getTahun();
 goto L_0f45b;
 L_ab0dc:
 $_0xe8a7 = (new \App\Models\DashboardModel())->getSemesterActive();
 goto L_81ab9;
 L_a6115:
 $_0xc766 = [];
 goto L_5ef5d;
 L_21618:
 $_0x6e07 = (new \App\Models\DashboardModel())->getTahunActive();
 goto L_ab0dc;
 L_0f45b:
 $_0x88de["\x74\160\x5f\141\x63\164\x69\166\x65"] = $_0x6e07;
 goto L_8b512;
 L_8d5db:
 if (session_status() === PHP_SESSION_ACTIVE) {
 session_write_close();
 }
 goto L_1dd77;
 L_6d478:
 $_0x88de["\x73\155\x74\137\x61\143\x74\151\x76\145"] = $_0xe8a7;
 goto L_97c4a;
 L_5ef5d:
 foreach ($_0x2b8c as $_0xb552 => $_0x3661) {
 $_0xc766[] = is_array($_0x3661) ? $_0x3661["\x6b\145\x6c\141\x73\137\x69\144"] ?? null : (is_object($_0x3661) ? $_0x3661->kelas_id ?? null : null);
 }
 goto L_13042;
 L_bfcaf:
 $_0xcae1 = $this->getJadwalById($_0x4987);
 goto L_21618;
 L_7c8cc:
 return $this->response->setJSON($_0x49c6);
 L_97c4a:
 $_0x2b8c = $this->maybe_unserialize($_0xcae1->bank_kelas ?? "\x5b\135");
 goto L_a6115;
 L_8b512:
 $_0x88de["\x73\155\x74"] = (new \App\Models\DashboardModel())->getSemester();
 goto L_6d478;
 L_1dd77:
 $_0x4987 = $this->request->getGet("\x69\144\x5f\152\x61\144\x77\141\x6c");
 goto L_bfcaf;
 }
 public function getTglJadwalUjian()
 {
 goto L_d6ba3;
 L_53218:
 $_0x1f0c["\x73\155\x74\137\x61\143\x74\151\x76\145"] = $_0x68b5;
 goto L_3a61c;
 L_3daee:
 $_0xaaa6->join("\x63\142\x74\137\x62\141\x6e\153\x5f\163\x6f\141\x6c\40\x62", "\x62\56\x69\144\x5f\142\x61\156\x6b\40\x3d\40\x61\56\x69\144\x5f\142\x61\156\x6b", "\x6c\145\x66\164");
 goto L_3db53;
 L_d7887:
 $_0xd348 = $this->getNamaKelasByArrId($_0xe978->id_tp ?? null, $_0x68b5->id_smt ?? null, []);
 goto L_dbcb5;
 L_39f8b:
 $_0x1f0c["\x74\160\x5f\141\x63\164\x69\166\x65"] = $_0xe978;
 goto L_c6e4f;
 L_4207e:
 $_0x1f0c["\x64\145\x66\141\x75\154\x74\137\x73\145\x73\151"] = $_0xba0f["\x73\145\x73\151"] ?? [];
 goto L_a5774;
 L_432e4:
 if (session_status() === PHP_SESSION_ACTIVE) {
 session_write_close();
 }
 goto L_0d7c3;
 L_ac095:
 $_0x1f0c["\x74\160"] = (new \App\Models\DashboardModel())->getTahun();
 goto L_39f8b;
 L_d1126:
 $_0x1f0c["\x73\145\x73\151"] = $_0x5f39;
 goto L_20064;
 L_c8b27:
 $_0x775e = $_0xb765->get("\x72\157\x6c\145");
 goto L_9ca34;
 L_3a61c:
 $_0xe45a = \Config\Database::connect();
 goto L_b91bd;
 L_74990:
 $_0x7792 = $_0xaaa6->get()->getResultArray();
 goto L_0aa8f;
 L_ba28e:
 $_0x1f0c["\x6a\141\x64\167\x61\154"] = $_0x4f40;
 goto L_fb0f1;
 L_1b18f:
 $_0xaaa6->orderBy("\x61\56\x74\147\x6c\137\x6d\165\x6c\141\x69", "\x44\105\x53\103");
 goto L_74990;
 L_0d7c3:
 $_0xe978 = (new \App\Models\DashboardModel())->getTahunActive();
 goto L_4e8a2;
 L_b5811:
 $_0xf2b3 = [];
 goto L_161f3;
 L_7f53d:
 foreach ($_0x7792 as $_0xa20a) {
 $_0x3a76[] = ["\x69\144\x5f\152\x61\144\x77\141\x6c" => $_0xa20a["\x69\144\x5f\152\x61\144\x77\141\x6c"], "\x69\144\x5f\164\x70" => $_0xa20a["\x69\144\x5f\164\x70"], "\x69\144\x5f\163\x6d\164" => $_0xa20a["\x69\144\x5f\163\x6d\164"], "\x69\144\x5f\142\x61\156\x6b" => $_0xa20a["\x69\144\x5f\142\x61\156\x6b"], "\x69\144\x5f\152\x65\156\x69\163" => $_0xa20a["\x69\144\x5f\152\x65\156\x69\163"], "\x74\147\x6c\137\x6d\165\x6c\141\x69" => $_0xa20a["\x74\147\x6c\137\x6d\165\x6c\141\x69"], "\x62\141\x6e\153" => (object) ["\x62\141\x6e\153\x5f\153\x65\154\x61\163" => $_0xa20a["\x62\141\x6e\153\x5f\153\x65\154\x61\163"] ?? "\x5b\135", "\x62\141\x6e\153\x5f\153\x6f\144\x65" => $_0xa20a["\x62\141\x6e\153\x5f\153\x6f\144\x65"] ?? "\x4a\141\x64\167\x61\154\x20\43" . $_0xa20a["\x69\144\x5f\152\x61\144\x77\141\x6c"], "\x62\141\x6e\153\x5f\147\x75\162\x75\137\x69\144" => $_0xa20a["\x62\141\x6e\153\x5f\147\x75\162\x75\137\x69\144"] ?? null, "\x6d\141\x70\145\x6c" => (object) ["\x6b\157\x64\145" => $_0xa20a["\x6b\157\x64\145"] ?? "\x2d", "\x6e\141\x6d\141\x5f\155\x61\160\x65\154" => $_0xa20a["\x6e\141\x6d\141\x5f\155\x61\160\x65\154"] ?? "\x2d"]]];
 }
 goto L_7c329;
 L_161f3:
 $_0xc080 = [];
 goto L_631ab;
 L_b91bd:
 // 1. Coba cari jadwal sesuai TP dan SMT aktif (left join agar jadwal tetap muncul meski bank soal lintas TP)
 $_0xaaa6 = $_0xe45a->table("\x63\142\x74\137\x6a\141\x64\167\x61\154\x20\141");
 goto L_6dac2;
 L_7413f:
 $_0x1f0c["\x6b\145\x6c\141\x73"] = $_0xf2b3;
 goto L_ba28e;
 L_d6ba3:
 $_0xb765 = session();
 goto L_c8b27;
 L_0aa8f:
 // 2. Fallback 1: Jika tidak ada pada SMT aktif, coba cek seluruh SMT pada TP aktif
 if (empty($_0x7792) && !empty($_0xe978)) {
 $_0xaaa6 = $_0xe45a->table("\x63\142\x74\137\x6a\141\x64\167\x61\154\x20\141");
 $_0xaaa6->select("\x61\56\x69\144\x5f\152\x61\144\x77\141\x6c\54\x20\141\x2e\151\x64\137\x74\160\x2c\40\x61\56\x69\144\x5f\163\x6d\164\x2c\40\x61\56\x69\144\x5f\142\x61\156\x6b\54\x20\141\x2e\151\x64\137\x6a\145\x6e\151\x73\54\x20\141\x2e\164\x67\154\x5f\155\x75\154\x61\151\x2c\40\x62\56\x62\141\x6e\153\x5f\153\x65\154\x61\163\x2c\40\x62\56\x62\141\x6e\153\x5f\153\x6f\144\x65\54\x20\142\x2e\142\x61\156\x6b\137\x67\165\x72\165\x5f\151\x64\54\x20\143\x2e\153\x6f\144\x65\54\x20\143\x2e\156\x61\155\x61\137\x6d\141\x70\145\x6c");
 $_0xaaa6->where("\x61\56\x69\144\x5f\164\x70", $_0xe978->id_tp);
 $_0xaaa6->join("\x63\142\x74\137\x62\141\x6e\153\x5f\163\x6f\141\x6c\40\x62", "\x62\56\x69\144\x5f\142\x61\156\x6b\40\x3d\40\x61\56\x69\144\x5f\142\x61\156\x6b", "\x6c\145\x66\164");
 $_0xaaa6->join("\x6d\141\x73\164\x65\162\x5f\155\x61\160\x65\154\x20\143", "\x63\56\x69\144\x5f\155\x61\160\x65\154\x20\75\x20\142\x2e\142\x61\156\x6b\137\x6d\141\x70\145\x6c\137\x69\144", "\x6c\145\x66\164");
 $_0xaaa6->orderBy("\x61\56\x74\147\x6c\137\x6d\165\x6c\141\x69", "\x44\105\x53\103");
 $_0x7792 = $_0xaaa6->get()->getResultArray();
 }
 goto L_ff8eb;
 L_a5774:
 $_0x1f0c["\x64\145\x66\141\x75\154\x74\137\x6b\145\x6c\141\x73"] = $_0xd348 ?? [];
 goto L_62f0a;
 L_3db53:
 $_0xaaa6->join("\x6d\141\x73\164\x65\162\x5f\155\x61\160\x65\154\x20\143", "\x63\56\x69\144\x5f\155\x61\160\x65\154\x20\75\x20\142\x2e\142\x61\156\x6b\137\x6d\141\x70\145\x6c\137\x69\144", "\x6c\145\x66\164");
 goto L_1b18f;
 L_20064:
 $_0x1f0c["\x61\154\x6c\137\x6a\141\x64\167\x61\154"] = $_0xf167;
 goto L_03158;
 L_631ab:
 $_0x5f39 = [];
 goto L_08d46;
 L_08d46:
 $_0xf167 = [];
 goto L_7144d;
 L_c6e4f:
 $_0x1f0c["\x73\155\x74"] = (new \App\Models\DashboardModel())->getSemester();
 goto L_53218;
 L_ff8eb:
 // 3. Fallback 2: Jika data jadwal ada di DB dari TP sebelumnya, tetap tampilkan agar dropdown tanggal tidak kosong
 if (empty($_0x7792)) {
 $_0xaaa6 = $_0xe45a->table("\x63\142\x74\137\x6a\141\x64\167\x61\154\x20\141");
 $_0xaaa6->select("\x61\56\x69\144\x5f\152\x61\144\x77\141\x6c\54\x20\141\x2e\151\x64\137\x74\160\x2c\40\x61\56\x69\144\x5f\163\x6d\164\x2c\40\x61\56\x69\144\x5f\142\x61\156\x6b\54\x20\141\x2e\151\x64\137\x6a\145\x6e\151\x73\54\x20\141\x2e\164\x67\154\x5f\155\x75\154\x61\151\x2c\40\x62\56\x62\141\x6e\153\x5f\153\x65\154\x61\163\x2c\40\x62\56\x62\141\x6e\153\x5f\153\x6f\144\x65\54\x20\142\x2e\142\x61\156\x6b\137\x67\165\x72\165\x5f\151\x64\54\x20\143\x2e\153\x6f\144\x65\54\x20\143\x2e\156\x61\155\x61\137\x6d\141\x70\145\x6c");
 $_0xaaa6->join("\x63\142\x74\137\x62\141\x6e\153\x5f\163\x6f\141\x6c\40\x62", "\x62\56\x69\144\x5f\142\x61\156\x6b\40\x3d\40\x61\56\x69\144\x5f\142\x61\156\x6b", "\x6c\145\x66\164");
 $_0xaaa6->join("\x6d\141\x73\164\x65\162\x5f\155\x61\160\x65\154\x20\143", "\x63\56\x69\144\x5f\155\x61\160\x65\154\x20\75\x20\142\x2e\142\x61\156\x6b\137\x6d\141\x70\145\x6c\137\x69\144", "\x6c\145\x66\164");
 $_0xaaa6->orderBy("\x61\56\x74\147\x6c\137\x6d\165\x6c\141\x69", "\x44\105\x53\103");
 $_0x7792 = $_0xaaa6->get()->getResultArray();
 }
 goto L_fb7c1;
 L_dc307:
 if (!empty($_0x68b5)) {
 $_0xaaa6->where("\x61\56\x69\144\x5f\163\x6d\164", $_0x68b5->id_smt);
 }
 goto L_3daee;
 L_62f0a:
 if ($_0x775e != "\x31" && $_0x775e != "\x34") {
 $_0x81ab = $_0x7405;
 $_0xf1cb = (new \App\Models\DashboardModel())->getDataGuruByUserId($_0x81ab->id, $_0xe978->id_tp, $_0x68b5->id_smt);
 $_0x1f0c["\x67\165\x72\165"] = $_0xf1cb;
 $_0xa686 = $_0xf1cb ? $_0xf1cb->id_guru : null;
 $_0x7e78 = $_0xa686 ? $this->getPengawasByGuru($_0xe978->id_tp, $_0x68b5->id_smt, $_0xa686) : [];
 $_0x1f0c["\x70\145\x6e\147\x61\167\x61\163"] = $_0x7e78;
 $_0x1f0c["\x68\141\x72\151\x5f\151\x6e\151"] = date("\x59\55\x6d\55\x64");
 }
 goto L_1626f;
 L_dbcb5:
 $_0x4f40 = [];
 goto L_b5811;
 L_fb7c1:
 $_0x3a76 = [];
 goto L_7f53d;
 L_03158:
 $_0x1f0c["\x64\145\x66\141\x75\154\x74\137\x72\165\x61\156\x67"] = $_0xba0f["\x72\165\x61\156\x67"] ?? [];
 goto L_4207e;
 L_7144d:
 if (!empty($_0x3a76)) {
 foreach ($_0x3a76 as $_0xbcfd => $_0xa908) {
 $_0xa908["\x62\141\x6e\153"]->bank_kelas = $this->maybe_unserialize($_0xa908["\x62\141\x6e\153"]->bank_kelas ?? []);
 $_0x200d = $_0xa908["\x62\141\x6e\153"]->bank_kelas;
 $_0x3094 = [];
 if (is_array($_0x200d)) {
 foreach ($_0x200d as $_0x66e7) {
 $_0x5549 = is_object($_0x66e7) ? $_0x66e7->kelas_id ?? null : (is_array($_0x66e7) ? $_0x66e7["\x6b\145\x6c\141\x73\137\x69\144"] ?? null : $_0x66e7);
 if ($_0x5549 !== null && $_0x5549 !== '' && $_0x5549 !== "\x30" && $_0x5549 !== 0) {
 if (!in_array((string) $_0x5549, $_0x3094)) {
 $_0x3094[] = (string) $_0x5549;
 }
 }
 }
 }
 if (empty($_0x3094)) {
 $_0x7250 = $_0xe45a->table("\x6d\141\x73\164\x65\162\x5f\153\x65\154\x61\163")->select("\x69\144\x5f\153\x65\154\x61\163")->get()->getResultArray();
 $_0x3094 = array_column($_0x7250, "\x69\144\x5f\153\x65\154\x61\163");
 }
 $_0xf746 = strtotime($_0xa908["\x74\147\x6c\137\x6d\165\x6c\141\x69"] ?? '');
 if (!$_0xf746) {
 $_0xf746 = time();
 }
 $_0x15c0 = $this->namaHari[date("\x6c", $_0xf746)] ?? date("\x6c", $_0xf746);
 $_0xcbf5 = date("\x64", $_0xf746);
 $_0xe1cf = $this->namaBulan[date("\x46", $_0xf746)] ?? date("\x46", $_0xf746);
 $_0x33e5 = date("\x59", $_0xf746);
 $_0x9fc8 = !empty($_0xa908["\x74\147\x6c\137\x6d\165\x6c\141\x69"]) ? $_0xa908["\x74\147\x6c\137\x6d\165\x6c\141\x69"] : date("\x59\55\x6d\55\x64");
 $_0x4f40[$_0x9fc8] = "{$_0x15c0}, {$_0xcbf5} {$_0xe1cf} {$_0x33e5}";
 $_0xf814 = $this->getDistinctRuang($_0xa908["\x69\144\x5f\164\x70"] ?? $_0xe978->id_tp ?? null, $_0xa908["\x69\144\x5f\163\x6d\164"] ?? $_0x68b5->id_smt ?? null, $_0x3094);
 foreach ($_0xf814["\x72\165\x61\156\x67"] as $_0x57c6 => $_0x4efa) {
 $_0xc080[$_0x9fc8][$_0x57c6] = $_0x4efa;
 }
 foreach ($_0xf814["\x73\145\x73\151"] as $_0x600a => $_0xc664) {
 $_0x5f39[$_0x9fc8][$_0x600a] = $_0xc664;
 }
 $_0xf2b3[$_0x9fc8][] = $this->getNamaKelasByArrId($_0xa908["\x69\144\x5f\164\x70"] ?? $_0xe978->id_tp ?? null, $_0xa908["\x69\144\x5f\163\x6d\164"] ?? $_0x68b5->id_smt ?? null, $_0x3094);
 $_0xf167[$_0x9fc8][$_0xa908["\x69\144\x5f\152\x61\144\x77\141\x6c"]] = $_0xa908["\x62\141\x6e\153"]->bank_kode;
 unset($_0x3a76[$_0xbcfd]["\x62\141\x6e\153"]);
 }
 }
 goto L_239d6;
 L_fb0f1:
 $_0x1f0c["\x72\165\x61\156\x67"] = $_0xc080;
 goto L_d1126;
 L_9ca34:
 $_0x7405 = (object) ["\x69\144" => $_0xb765->get("\x69\144\x5f\165\x73\145\x72"), "\x75\163\x65\162\x6e\141\x6d\145" => $_0xb765->get("\x75\163\x65\162\x6e\141\x6d\145"), "\x66\151\x72\163\x74\137\x6e\141\x6d\145" => $_0xb765->get("\x75\163\x65\162\x6e\141\x6d\145"), "\x72\157\x6c\145\x5f\156\x61\155\x65" => $_0xb765->get("\x72\157\x6c\145\x5f\156\x61\155\x65"), "\x66\157\x74\157" => $_0xb765->get("\x66\157\x74\157") ?? ''];
 goto L_432e4;
 L_1626f:
 return $this->response->setJSON($_0x1f0c);
 L_6dac2:
 $_0xaaa6->select("\x61\56\x69\144\x5f\152\x61\144\x77\141\x6c\54\x20\141\x2e\151\x64\137\x74\160\x2c\40\x61\56\x69\144\x5f\163\x6d\164\x2c\40\x61\56\x69\144\x5f\142\x61\156\x6b\54\x20\141\x2e\151\x64\137\x6a\145\x6e\151\x73\54\x20\141\x2e\164\x67\154\x5f\155\x75\154\x61\151\x2c\40\x62\56\x62\141\x6e\153\x5f\153\x65\154\x61\163\x2c\40\x62\56\x62\141\x6e\153\x5f\153\x6f\144\x65\54\x20\142\x2e\142\x61\156\x6b\137\x67\165\x72\165\x5f\151\x64\54\x20\143\x2e\153\x6f\144\x65\54\x20\143\x2e\156\x61\155\x61\137\x6d\141\x70\145\x6c");
 goto L_5e012;
 L_239d6:
 // Fallback: jika belum ada jadwal ujian sama sekali di database, sediakan tanggal hari ini + master ruang/sesi/kelas
 if (empty($_0x4f40)) {
 $_0x63cd = date("\x59\55\x6d\55\x64");
 $_0xc940 = time();
 $_0x15c0 = $this->namaHari[date("\x6c", $_0xc940)] ?? date("\x6c", $_0xc940);
 $_0xcbf5 = date("\x64", $_0xc940);
 $_0xe1cf = $this->namaBulan[date("\x46", $_0xc940)] ?? date("\x46", $_0xc940);
 $_0x33e5 = date("\x59", $_0xc940);
 $_0x4f40[$_0x63cd] = "{$_0x15c0}, {$_0xcbf5} {$_0xe1cf} {$_0x33e5} (Hari Ini)";
 $_0xc080[$_0x63cd] = $_0xba0f["\x72\165\x61\156\x67"] ?? [];
 $_0x5f39[$_0x63cd] = $_0xba0f["\x73\145\x73\151"] ?? [];
 $_0xf2b3[$_0x63cd][] = $_0xd348 ?? [];
 }
 goto L_7413f;
 L_5e012:
 if (!empty($_0xe978)) {
 $_0xaaa6->where("\x61\56\x69\144\x5f\164\x70", $_0xe978->id_tp);
 }
 goto L_dc307;
 L_7c329:
 $_0xba0f = $this->getDistinctRuang($_0xe978->id_tp ?? null, $_0x68b5->id_smt ?? null, []);
 goto L_d7887;
 L_4e8a2:
 $_0x68b5 = (new \App\Models\DashboardModel())->getSemesterActive();
 goto L_ac095;
 }
 public function getJadwalUjianByKelas()
 {
 goto L_0f0de;
 L_456f4:
 $_0xf9e7 = (new \App\Models\DashboardModel())->getTahunActive();
 goto L_6bccd;
 L_d615a:
 $_0x140b = $this->getAllJadwal($_0xf9e7->id_tp, $_0x379e->id_smt, $_0x7771);
 goto L_89e8f;
 L_6bccd:
 $_0x379e = (new \App\Models\DashboardModel())->getSemesterActive();
 goto L_0adbc;
 L_32e37:
 if ($_0x37df->get("\x72\157\x6c\145") == 2 || $_0x37df->get("\x72\157\x6c\145") == "\x32") {
 $_0x3819 = (object) ["\x69\144" => $_0x37df->get("\x69\144\x5f\165\x73\145\x72"), "\x75\163\x65\162\x6e\141\x6d\145" => $_0x37df->get("\x75\163\x65\162\x6e\141\x6d\145"), "\x66\151\x72\163\x74\137\x6e\141\x6d\145" => $_0x37df->get("\x75\163\x65\162\x6e\141\x6d\145"), "\x72\157\x6c\145\x5f\156\x61\155\x65" => $_0x37df->get("\x72\157\x6c\145\x5f\156\x61\155\x65"), "\x66\157\x74\157" => $_0x37df->get("\x66\157\x74\157") ?? ''];
 $_0xbea3 = (new \App\Models\DashboardModel())->getDataGuruByUserId($_0x3819->id, $_0xf9e7->id_tp, $_0x379e->id_smt);
 $_0x7771 = $_0xbea3 ? $_0xbea3->id_guru : null;
 } else {
 $_0x7771 = null;
 }
 goto L_d615a;
 L_89e8f:
 $_0x498d = [];
 goto L_46a0f;
 L_d7141:
 return $this->response->setJSON($_0x498d);
 L_0f0de:
 $_0xbe67 = $this->request->getGet("\x69\144\x5f\153\x65\154\x61\163");
 goto L_456f4;
 L_0adbc:
 $_0x37df = session();
 goto L_32e37;
 L_46a0f:
 foreach ($_0x140b as $_0xf13d) {
 $_0xdff0 = $this->maybe_unserialize($_0xf13d->bank_kelas ?? []);
 foreach ($_0xdff0 as $_0x1c53) {
 $_0xcdc8 = is_array($_0x1c53) ? $_0x1c53["\x6b\145\x6c\141\x73\137\x69\144"] ?? $_0x1c53[0] ?? null : (is_object($_0x1c53) ? $_0x1c53->kelas_id ?? null : $_0x1c53);
 if ($_0xcdc8 !== null && $_0xcdc8 == $_0xbe67) {
 $_0x2de9 = $_0xf13d->mapel_kode ?? $_0xf13d->kode ?? '';
 $_0x498d[$_0xf13d->id_jadwal] = $_0x2de9 . "\x20\50" . ($_0xf13d->bank_kode ?? '') . "\x29";
 }
 }
 }
 goto L_d7141;
 }
 // pengawas status siswa
 public function pengawas()
 {
 goto L_19f5f;
 L_33620:
 $_0x25a7["\x73\145\x74\164\x69\156\x67"] = (new \App\Models\DashboardModel())->getSetting();
 goto L_64794;
 L_210c1:
 $_0x1334 = (object) ["\x69\144" => $_0xf2fc->get("\x69\144\x5f\165\x73\145\x72"), "\x75\163\x65\162\x6e\141\x6d\145" => $_0xf2fc->get("\x75\163\x65\162\x6e\141\x6d\145"), "\x66\151\x72\163\x74\137\x6e\141\x6d\145" => $_0xf2fc->get("\x75\163\x65\162\x6e\141\x6d\145"), "\x72\157\x6c\145\x5f\156\x61\155\x65" => $_0xf2fc->get("\x72\157\x6c\145\x5f\156\x61\155\x65"), "\x66\157\x74\157" => $_0xf2fc->get("\x66\157\x74\157") ?? ''];
 goto L_99843;
 L_86c5d:
 $_0xab16 = $_0x187b->tp_active;
 goto L_54678;
 L_b5a09:
 $_0x25a7["\x6a\165\x64\165\x6c"] = "\x53\164\x61\164\x75\163\x20\125\x6a\151\x61\156\x20\123\x69\163\x77\141";
 goto L_61747;
 L_0ee48:
 $_0xe826 = $this->request->getGet("\x6a\141\x64\167\x61\154");
 goto L_b6cbb;
 L_19f5f:
 $_0xfbb3 = $this->request->getGet("\x72\165\x61\156\x67");
 goto L_d879b;
 L_ff0c8:
 return view("\x6d\145\x6d\142\x65\162\x73\57\x67\165\x72\165\x2f\143\x62\164\x2f\163\x74\141\x74\165\x73\57\x70\145\x6e\147\x61\167\x61\163", $_0x25a7);
 L_f1c0b:
 $_0x97ab = in_array((string) $_0xf2fc->get("\x72\157\x6c\145"), ["\x31", "\x34"]);
 goto L_210c1;
 L_da346:
 $_0x25a7["\x74\160"] = $_0x187b->tp;
 goto L_919e4;
 L_b6cbb:
 //$allJadwal = explode(',', $jadwal);
 $_0x25a7["\x6a\141\x64\167\x61\154\x5f\151\x64"] = $_0xe826;
 goto L_0287c;
 L_1ff83:
 if ($_0x4f3c) {
 $_0x4f3c->pengawas = $_0xa24d->table("\x63\142\x74\137\x70\145\x6e\147\x61\167\x61\163")->where("\x69\144\x5f\152\x61\144\x77\141\x6c", $_0xe826)->where("\x69\144\x5f\162\x75\141\x6e\147", $_0xfbb3)->where("\x69\144\x5f\163\x65\163\x69", $_0x93f8)->get()->getResult();
 }
 goto L_50e22;
 L_919e4:
 $_0x25a7["\x73\155\x74"] = $_0x187b->smt;
 goto L_80994;
 L_0287c:
 $_0x25a7["\x72\165\x61\156\x67\137\x69\144"] = $_0xfbb3;
 goto L_366fd;
 L_44839:
 $_0xf2fc = session();
 goto L_f1c0b;
 L_9eb4f:
 $_0x25a7["\x73\155\x74\137\x61\143\x74\151\x76\145"] = $_0x75c2;
 goto L_1dba8;
 L_a477a:
 $_0x25a7["\x69\144\x73\137\x70\145\x6e\147\x61\167\x61\163"] = $_0x3897;
 goto L_ff0c8;
 L_1dba8:
 $_0x1c2a = (new \App\Models\DashboardModel())->getDataGuruByUserId($_0x1334->id, $_0xab16->id_tp, $_0x75c2->id_smt);
 goto L_84b8a;
 L_d879b:
 $_0x93f8 = $this->request->getGet("\x73\145\x73\151");
 goto L_0ee48;
 L_50e22:
 $_0x3897 = [];
 goto L_0eb8d;
 L_99843:
 $_0x25a7["\x75\163\x65\162"] = $_0x1334;
 goto L_b5a09;
 L_e8c9e:
 $_0xa24d = \Config\Database::connect();
 goto L_c9fc3;
 L_80994:
 $_0x25a7["\x74\160\x5f\141\x63\164\x69\166\x65"] = $_0xab16;
 goto L_9eb4f;
 L_366fd:
 $_0x25a7["\x73\145\x73\151\x5f\151\x64"] = $_0x93f8;
 goto L_44839;
 L_64794:
 $_0x187b = $this->getTpSmt();
 goto L_86c5d;
 L_c9fc3:
 $_0x4f3c = $_0xa24d->table("\x63\142\x74\137\x6a\141\x64\167\x61\154")->select("\x69\144\x5f\152\x61\144\x77\141\x6c\54\x69\144\x5f\164\x70\54\x69\144\x5f\163\x6d\164\x2c\151\x64\137\x62\141\x6e\153\x2c\151\x64\137\x6a\145\x6e\151\x73\54\x74\147\x6c\137\x6d\165\x6c\141\x69\54\x74\147\x6c\137\x73\145\x6c\145\x73\141\x69\54\x64\165\x72\141\x73\151\x5f\165\x6a\151\x61\156\x2c\160\x65\154\x61\156\x67\147\x61\162\x61\156\x2c\141\x63\141\x6b\137\x73\157\x61\154\x2c\141\x63\141\x6b\137\x6f\160\x73\151\x2c\150\x61\163\x69\154\x5f\164\x61\155\x70\151\x6c\54\x74\157\x6b\145\x6e\54\x73\164\x61\164\x75\163\x2c\165\x6c\141\x6e\147\x2c\162\x65\163\x65\164\x5f\154\x6f\147\x69\156\x2c\162\x65\153\x61\160\x2c\152\x61\155\x5f\153\x65\54\x6a\141\x72\141\x6b\54\x70\145\x6c\141\x6e\147\x67\141\x72\141\x6e")->where("\x69\144\x5f\152\x61\144\x77\141\x6c", $_0xe826)->get()->getRow();
 goto L_1ff83;
 L_54678:
 $_0x75c2 = $_0x187b->smt_active;
 goto L_da346;
 L_61747:
 $_0x25a7["\x73\165\x62\152\x75\144\x75\154"] = "\x53\164\x61\164\x75\163\x20\123\x69\163\x77\141";
 goto L_33620;
 L_0eb8d:
 if ($_0x4f3c) {
 $_0xdccd = $_0x4f3c->pengawas;
 if ($_0xdccd) {
 foreach ($_0xdccd as $_0xf265) {
 $_0xf266 = explode("\x2c", $_0xf265->id_guru ?? '');
 foreach ($_0xf266 as $_0x37b1) {
 if (!in_array($_0x37b1, $_0x3897)) {
 $_0x3897[] = $_0x37b1;
 }
 }
 }
 }
 }
 goto L_a477a;
 L_84b8a:
 $_0x25a7["\x67\165\x72\165"] = $_0x1c2a;
 goto L_e8c9e;
 }
 // new akun guru
 public function get_status_ruang()
 {
 goto L_46b7a;
 L_9dc96:
 $_0xf34a = [];
 goto L_c9a05;
 L_bd5a1:
 $_0xabbe = $this->request->getGet("\x73\145\x73\151");
 goto L_a65e1;
 L_5db06:
 $_0x77bf = [];
 goto L_eac92;
 L_5b855:
 $_0xc762 = $this->getTpSmt();
 goto L_23f8c;
 L_731d2:
 $_0x5eb6 = [];
 goto L_b4b88;
 L_c9a05:
 foreach ($_0x6721 as $_0x3cb4) {
 $_0x3cb4->pelanggaran = $this->maybe_unserialize($_0x3cb4->pelanggaran ?? "\x7b\175");
 $_0xf34a[$_0x3cb4->id_siswa][$_0x3cb4->id_jadwal] = $_0x3cb4;
 }
 goto L_5c7c1;
 L_a65e1:
 $_0xbe7c = $this->request->getGet("\x6a\141\x64\167\x61\154");
 goto L_5b855;
 L_468d4:
 if (!$_0x9a27) {
 return $this->response->setJSON(["\x6a\141\x64\167\x61\154" => [], "\x69\144\x73\137\x70\145\x6e\147\x61\167\x61\163" => [], "\x70\145\x6e\147\x61\167\x61\163" => [], "\x74\157\x64\141\x79" => date("\x59\55\x6d\55\x64\40\x48\72\x69\72\x73"), "\x73\145\x73\151\x73\151\x73\167\x61" => [], "\x69\163\x5f\145\x6d\160\x74\171" => true, "\x6d\145\x73\163\x61\147\x65" => "\x6e\157\x20\152\x61\144\x77\141\x6c"]);
 }
 goto L_dcf14;
 L_07ee3:
 foreach ($_0x1d45 as $_0x7277) {
 $_0x8702["\x70\145\x6e\147\x61\167\x61\163"][] = (object) $_0x7277;
 }
 goto L_e294a;
 L_46b7a:
 if (session_status() === PHP_SESSION_ACTIVE) {
 session_write_close();
 }
 goto L_dfc0a;
 L_ae7ac:
 foreach ($_0x8702["\x62\141\x6e\153"]->bank_kelas as $_0xcd76) {
 $_0xf2e3 = is_array($_0xcd76) ? $_0xcd76["\x6b\145\x6c\141\x73\137\x69\144"] ?? null : (is_object($_0xcd76) ? $_0xcd76->kelas_id ?? null : null);
 if ($_0xf2e3 && !in_array($_0xf2e3, $_0xc68c)) {
 $_0xc68c[] = $_0xf2e3;
 }
 }
 goto L_6d36a;
 L_48b0f:
 $_0x6eab = [];
 goto L_0b0c5;
 L_97a50:
 $_0x8702["\x70\145\x6e\147\x61\167\x61\163"] = [];
 goto L_07ee3;
 L_18f17:
 $_0xd0c0 = $_0xd857->table("\x63\142\x74\137\x73\145\x73\151\x5f\163\x69\163\x77\141\x20\163\x73")->select("\x73\163\x2e\163\x69\163\x77\141\x5f\151\x64\54\x20\163\x73\56\x6b\145\x6c\141\x73\137\x69\144\x2c\40\x73\56\x69\144\x5f\163\x69\163\x77\141\x2c\40\x73\56\x6e\141\x6d\141\x2c\40\x73\56\x6e\151\x73\54\x20\163\x2e\156\x69\163\x6e\54\x20\163\x2e\141\x67\141\x6d\141\x2c\40\x6b\56\x6b\157\x64\145\x5f\153\x65\154\x61\163\x2c\40\x6b\56\x6e\141\x6d\141\x5f\153\x65\154\x61\163\x2c\40\x72\56\x6b\157\x64\145\x5f\162\x75\141\x6e\147\x2c\40\x72\56\x6e\141\x6d\141\x5f\162\x75\141\x6e\147\x2c\40\x73\145\x73\56\x6b\157\x64\145\x5f\163\x65\163\x69\54\x20\163\x65\163\x2e\156\x61\155\x61\137\x73\145\x73\151\x2c\40\x70\56\x6e\157\x6d\157\x72\137\x70\145\x73\145\x72\164\x61")->join("\x6d\141\x73\164\x65\162\x5f\163\x69\163\x77\141\x20\163", "\x73\56\x69\144\x5f\163\x69\163\x77\141\x20\75\x20\163\x73\56\x73\151\x73\167\x61\137\x69\144", "\x6c\145\x66\164")->join("\x6d\141\x73\164\x65\162\x5f\153\x65\154\x61\163\x20\153", "\x6b\56\x69\144\x5f\153\x65\154\x61\163\x20\75\x20\163\x73\56\x6b\145\x6c\141\x73\137\x69\144", "\x6c\145\x66\164")->join("\x63\142\x74\137\x72\165\x61\156\x67\40\x72", "\x72\56\x69\144\x5f\162\x75\141\x6e\147\x20\75\x20\163\x73\56\x72\165\x61\156\x67\137\x69\144", "\x6c\145\x66\164")->join("\x63\142\x74\137\x73\145\x73\151\x20\163\x65\163", "\x73\145\x73\56\x69\144\x5f\163\x65\163\x69\40\x3d\40\x73\163\x2e\163\x65\163\x69\137\x69\144", "\x6c\145\x66\164")->join("\x63\142\x74\137\x6e\157\x6d\157\x72\137\x70\145\x73\145\x72\164\x61\40\x70", "\x70\56\x69\144\x5f\163\x69\163\x77\141\x20\75\x20\163\x73\56\x73\151\x73\167\x61\137\x69\144\x20\101\x4e\104\x20\160\x2e\151\x64\137\x74\160\x20\75\x20\163\x73\56\x74\160\x5f\151\x64\40\x41\116\x44\40\x70\56\x69\144\x5f\163\x6d\164\x20\75\x20\163\x73\56\x73\155\x74\137\x69\144", "\x6c\145\x66\164")->where("\x73\163\x2e\164\x70\137\x69\144", $_0xb6a6->id_tp)->where("\x73\163\x2e\163\x6d\164\x5f\151\x64", $_0xfd81->id_smt)->where("\x73\163\x2e\162\x75\141\x6e\147\x5f\151\x64", $_0x68ca)->where("\x73\163\x2e\163\x65\163\x69\137\x69\144", $_0xabbe)->get()->getResultArray();
 goto L_2b0da;
 L_2fa54:
 $_0xd857 = \Config\Database::connect();
 goto L_5411c;
 L_b4b88:
 foreach ($_0xd0c0 as $_0x663f) {
 if (!in_array($_0x663f["\x73\151\x73\167\x61\137\x69\144"], $_0x5eb6)) {
 $_0x5eb6[] = $_0x663f["\x73\151\x73\167\x61\137\x69\144"];
 }
 $_0x1196[] = ["\x73\151\x73\167\x61\137\x69\144" => $_0x663f["\x73\151\x73\167\x61\137\x69\144"], "\x6b\145\x6c\141\x73\137\x69\144" => $_0x663f["\x6b\145\x6c\141\x73\137\x69\144"], "\x73\151\x73\167\x61" => (object) ["\x69\144\x5f\163\x69\163\x77\141" => $_0x663f["\x69\144\x5f\163\x69\163\x77\141"], "\x6e\141\x6d\141" => $_0x663f["\x6e\141\x6d\141"], "\x6e\151\x73" => $_0x663f["\x6e\151\x73"], "\x6e\151\x73\156" => $_0x663f["\x6e\151\x73\156"], "\x61\147\x61\155\x61" => $_0x663f["\x61\147\x61\155\x61"]], "\x6b\145\x6c\141\x73" => (object) ["\x6b\157\x64\145\x5f\153\x65\154\x61\163" => $_0x663f["\x6b\157\x64\145\x5f\153\x65\154\x61\163"], "\x6e\141\x6d\141\x5f\153\x65\154\x61\163" => $_0x663f["\x6e\141\x6d\141\x5f\153\x65\154\x61\163"]], "\x72\165\x61\156\x67" => (object) ["\x6b\157\x64\145\x5f\162\x75\141\x6e\147" => $_0x663f["\x6b\157\x64\145\x5f\162\x75\141\x6e\147"], "\x6e\141\x6d\141\x5f\162\x75\141\x6e\147" => $_0x663f["\x6e\141\x6d\141\x5f\162\x75\141\x6e\147"]], "\x73\145\x73\151" => (object) ["\x6b\157\x64\145\x5f\163\x65\163\x69" => $_0x663f["\x6b\157\x64\145\x5f\163\x65\163\x69"], "\x6e\141\x6d\141\x5f\163\x65\163\x69" => $_0x663f["\x6e\141\x6d\141\x5f\163\x65\163\x69"]], "\x70\145\x73\145\x72\164\x61" => (object) ["\x6e\157\x6d\157\x72\137\x70\145\x73\145\x72\164\x61" => $_0x663f["\x6e\157\x6d\157\x72\137\x70\145\x73\145\x72\164\x61"]]];
 }
 goto L_61f38;
 L_23f8c:
 $_0xb6a6 = $_0xc762->tp_active;
 goto L_e491a;
 L_5c7c1:
 $_0x5810 = count($_0x5eb6) > 0 ? $_0xd857->table("\x6c\157\x67\137\x75\152\x69\141\x6e")->whereIn("\x69\144\x5f\163\x69\163\x77\141", $_0x5eb6)->where("\x69\144\x5f\152\x61\144\x77\141\x6c", $_0xbe7c)->get()->getResult() : [];
 goto L_5db06;
 L_69bff:
 $_0xd81f = [];
 goto L_8e495;
 L_eac92:
 foreach ($_0x5810 as $_0x1413) {
 $_0x77bf[$_0x1413->id_siswa][$_0x1413->id_jadwal][] = $_0x1413;
 }
 goto L_69bff;
 L_e294a:
 $_0xa258 = [];
 goto L_770fb;
 L_2b0da:
 $_0x1196 = [];
 goto L_731d2;
 L_dfc0a:
 $_0x68ca = $this->request->getGet("\x72\165\x61\156\x67");
 goto L_bd5a1;
 L_74ea6:
 $_0x8702["\x62\141\x6e\153"]->bank_kelas = $this->maybe_unserialize($_0x8702["\x62\141\x6e\153"]->bank_kelas ?? []);
 goto L_ae7ac;
 L_a15bc:
 $_0x8702 = $_0x9a27;
 goto L_36821;
 L_e8909:
 $_0x6721 = count($_0x5eb6) > 0 ? $_0xd857->table("\x63\142\x74\137\x73\151\x73\167\x61")->select("\x69\144\x5f\142\x61\156\x6b\54\x69\144\x5f\143\x62\164\x5f\163\x69\163\x77\141\x2c\151\x64\137\x6a\141\x64\167\x61\154\x2c\151\x64\137\x73\151\x73\167\x61\54\x6c\141\x6d\141\x5f\165\x6a\151\x61\156\x2c\155\x75\154\x61\151\x2c\162\x65\163\x65\164\x5f\151\x7a\151\x6e\54\x72\145\x73\145\x74\137\x77\141\x6b\164\x75\54\x73\145\x6c\145\x73\141\x69\54\x73\164\x61\164\x75\163\x2c\160\x65\154\x61\156\x67\147\x61\162\x61\156")->whereIn("\x69\144\x5f\163\x69\163\x77\141", $_0x5eb6)->where("\x69\144\x5f\152\x61\144\x77\141\x6c", $_0xbe7c)->get()->getResult() : [];
 goto L_9dc96;
 L_5411c:
 $_0x9a27 = $_0xd857->table("\x63\142\x74\137\x6a\141\x64\167\x61\154\x20\152")->select("\x6a\56\x69\144\x5f\152\x61\144\x77\141\x6c\54\x20\152\x2e\151\x64\137\x74\160\x2c\40\x6a\56\x69\144\x5f\163\x6d\164\x2c\40\x6a\56\x69\144\x5f\142\x61\156\x6b\54\x20\152\x2e\151\x64\137\x6a\145\x6e\151\x73\54\x20\152\x2e\164\x67\154\x5f\155\x75\154\x61\151\x2c\40\x6a\56\x74\147\x6c\137\x73\145\x6c\145\x73\141\x69\54\x20\152\x2e\144\x75\162\x61\163\x69\137\x75\152\x69\141\x6e\54\x20\152\x2e\160\x65\154\x61\156\x67\147\x61\162\x61\156\x2c\40\x6a\56\x6b\141\x6d\145\x72\141\x2c\40\x6a\56\x61\143\x61\153\x5f\163\x6f\141\x6c\54\x20\152\x2e\141\x63\141\x6b\137\x6f\160\x73\151\x2c\40\x6a\56\x68\141\x73\151\x6c\137\x74\141\x6d\160\x69\154\x2c\40\x6a\56\x74\157\x6b\145\x6e\54\x20\152\x2e\163\x74\141\x74\165\x73\54\x20\152\x2e\165\x6c\141\x6e\147\x2c\40\x6a\56\x72\145\x73\145\x74\137\x6c\157\x67\151\x6e\54\x20\152\x2e\162\x65\153\x61\160\x2c\40\x6a\56\x6a\141\x6d\137\x6b\145\x2c\40\x6a\56\x6a\141\x72\141\x6b\54\x20\142\x2e\142\x61\156\x6b\137\x6b\145\x6c\141\x73\54\x20\142\x2e\142\x61\156\x6b\137\x6b\157\x64\145\x2c\40\x62\56\x62\141\x6e\153\x5f\147\x75\162\x75\137\x69\144\x2c\40\x6d\56\x6b\157\x64\145\x20\141\x73\40\x6d\141\x70\145\x6c\137\x6b\157\x64\145\x2c\40\x6d\56\x6e\141\x6d\141\x5f\155\x61\160\x65\154\x2c\40\x67\56\x6b\157\x64\145\x5f\147\x75\162\x75\54\x20\147\x2e\156\x61\155\x61\137\x67\165\x72\165\x2c\40\x6a\145\x6e\56\x6e\141\x6d\141\x5f\152\x65\156\x69\163\x2c\40\x6a\145\x6e\56\x6b\157\x64\145\x5f\152\x65\156\x69\163")->join("\x63\142\x74\137\x62\141\x6e\153\x5f\163\x6f\141\x6c\40\x62", "\x62\56\x69\144\x5f\142\x61\156\x6b\40\x3d\40\x6a\56\x69\144\x5f\142\x61\156\x6b", "\x6c\145\x66\164")->join("\x6d\141\x73\164\x65\162\x5f\155\x61\160\x65\154\x20\155", "\x6d\56\x69\144\x5f\155\x61\160\x65\154\x20\75\x20\142\x2e\142\x61\156\x6b\137\x6d\141\x70\145\x6c\137\x69\144", "\x6c\145\x66\164")->join("\x6d\141\x73\164\x65\162\x5f\147\x75\162\x75\40\x67", "\x67\56\x69\144\x5f\147\x75\162\x75\40\x3d\40\x62\56\x62\141\x6e\153\x5f\147\x75\162\x75\137\x69\144", "\x6c\145\x66\164")->join("\x63\142\x74\137\x6a\145\x6e\151\x73\40\x6a\145\x6e", "\x6a\145\x6e\56\x69\144\x5f\152\x65\156\x69\163\x20\75\x20\152\x2e\151\x64\137\x6a\145\x6e\151\x73", "\x6c\145\x66\164")->where("\x6a\56\x69\144\x5f\152\x61\144\x77\141\x6c", $_0xbe7c)->get()->getRowArray();
 goto L_468d4;
 L_cd6b1:
 $_0x8702["\x6a\145\x6e\151\x73"] = (object) ["\x6e\141\x6d\141\x5f\152\x65\156\x69\163" => $_0x9a27["\x6e\141\x6d\141\x5f\152\x65\156\x69\163"], "\x6b\157\x64\145\x5f\152\x65\156\x69\163" => $_0x9a27["\x6b\157\x64\145\x5f\152\x65\156\x69\163"]];
 goto L_97a50;
 L_e491a:
 $_0xfd81 = $_0xc762->smt_active;
 goto L_2fa54;
 L_55e07:
 return $this->response->setJSON(["\x69\144\x73\137\x70\145\x6e\147\x61\167\x61\163" => $_0xa258, "\x70\145\x6e\147\x61\167\x61\163" => $_0x6eab, "\x6a\141\x64\167\x61\154" => $_0x8702, "\x74\157\x64\141\x79" => date("\x59\55\x6d\55\x64\40\x48\72\x69\72\x73"), "\x73\145\x73\151\x73\151\x73\167\x61" => $_0xd81f, "\x69\163\x5f\145\x6d\160\x74\171" => false]);
 L_6d36a:
 foreach ($_0x8702["\x70\145\x6e\147\x61\167\x61\163"] as $_0x7277) {
 $_0xae4c = explode("\x2c", $_0x7277->id_guru ?? '');
 $_0xa258 = array_values(array_filter($_0xae4c));
 }
 goto L_48b0f;
 L_dcf14:
 $_0x1d45 = $_0xd857->table("\x63\142\x74\137\x70\145\x6e\147\x61\167\x61\163")->where("\x69\144\x5f\152\x61\144\x77\141\x6c", $_0xbe7c)->where("\x69\144\x5f\162\x75\141\x6e\147", $_0x68ca)->where("\x69\144\x5f\163\x65\163\x69", $_0xabbe)->get()->getResultArray();
 goto L_a15bc;
 L_61f38:
 if (!$_0x1196) {
 return $this->response->setJSON(["\x6a\141\x64\167\x61\154" => $_0x8702, "\x69\144\x73\137\x70\145\x6e\147\x61\167\x61\163" => $_0xa258, "\x70\145\x6e\147\x61\167\x61\163" => $_0x6eab, "\x74\157\x64\141\x79" => date("\x59\55\x6d\55\x64\40\x48\72\x69\72\x73"), "\x73\145\x73\151\x73\151\x73\167\x61" => [], "\x69\163\x5f\145\x6d\160\x74\171" => true, "\x6d\145\x73\163\x61\147\x65" => "\x6e\157\x20\163\x69\163\x77\141"]);
 }
 goto L_e8909;
 L_0b0c5:
 if (count($_0xa258) > 0) {
 $_0x6eab = $_0xd857->table("\x6d\141\x73\164\x65\162\x5f\147\x75\162\x75")->select("\x6e\141\x6d\141\x5f\147\x75\162\x75\54\x20\156\x69\160")->whereIn("\x69\144\x5f\147\x75\162\x75", $_0xa258)->get()->getResultArray();
 }
 goto L_18f17;
 L_770fb:
 $_0xc68c = [];
 goto L_74ea6;
 L_8e495:
 foreach ($_0x1196 as $_0xf868) {
 if (empty($_0xc68c) || in_array($_0xf868["\x6b\145\x6c\141\x73\137\x69\144"], $_0xc68c)) {
 $_0xf868["\x63\142\x74\163\x69\163\x77\141"] = $_0xf34a[$_0xf868["\x73\151\x73\167\x61\137\x69\144"]] ?? null;
 $_0xf868["\x6c\157\x67"] = $_0x77bf[$_0xf868["\x73\151\x73\167\x61\137\x69\144"]] ?? [];
 $_0xd81f[] = $_0xf868;
 }
 }
 goto L_55e07;
 L_36821:
 $_0x8702["\x62\141\x6e\153"] = (object) ["\x62\141\x6e\153\x5f\153\x65\154\x61\163" => $_0x9a27["\x62\141\x6e\153\x5f\153\x65\154\x61\163"], "\x62\141\x6e\153\x5f\153\x6f\144\x65" => $_0x9a27["\x62\141\x6e\153\x5f\153\x6f\144\x65"], "\x6d\141\x70\145\x6c" => (object) ["\x6b\157\x64\145" => $_0x9a27["\x6d\141\x70\145\x6c\137\x6b\157\x64\145"], "\x6e\141\x6d\141\x5f\155\x61\160\x65\154" => $_0x9a27["\x6e\141\x6d\141\x5f\155\x61\160\x65\154"]], "\x67\165\x72\165" => (object) ["\x6b\157\x64\145\x5f\147\x75\162\x75" => $_0x9a27["\x6b\157\x64\145\x5f\147\x75\162\x75"], "\x6e\141\x6d\141\x5f\147\x75\162\x75" => $_0x9a27["\x6e\141\x6d\141\x5f\147\x75\162\x75"]]];
 goto L_cd6b1;
 }
 // old
 public function getSiswaKelas()
 {
 goto L_f64f7;
 L_0d428:
 $_0x2c91 = [];
 goto L_84c94;
 L_c5c3c:
 $_0x41b3 = (new \App\Models\DashboardModel())->getTahunActive();
 goto L_57843;
 L_869cc:
 $_0xbb9e = (new \App\Models\CbtModel())->getDurasiSiswaByJadwal($_0xfc20);
 goto L_5ae48;
 L_6a699:
 $_0x281e = (new \App\Models\CbtModel())->getPengawasByJadwal($_0x41b3->id_tp, $_0x66a9->id_smt, $_0xfc20);
 goto L_0d428;
 L_9cbd2:
 $_0x2661["\x70\145\x6e\147\x61\167\x61\163"] = (new \App\Models\MasterModel())->getGuruByArrId($_0x2c91);
 goto L_d780a;
 L_84c94:
 foreach ($_0x281e as $_0xa094) {
 $_0x2c91 = explode("\x2c", $_0xa094->id_guru ?? '');
 }
 goto L_04758;
 L_2b568:
 $_0x2661["\x64\165\x72\141\x73\151"] = $_0x2b71;
 goto L_f05fe;
 L_b1d4f:
 //$sesi = $this->request->getGet('sesi');
 $_0xfc20 = $this->request->getGet("\x6a\141\x64\167\x61\154");
 goto L_c5c3c;
 L_f7d29:
 $_0x2661["\x73\151\x73\167\x61"] = array_values($_0x8878);
 goto L_2b568;
 L_04758:
 $_0x2b71 = [];
 goto L_661af;
 L_81283:
 $_0xdd4f = (new \App\Models\CbtModel())->getJadwalById($_0xfc20);
 goto L_491d4;
 L_661af:
 foreach ($_0x8878 as $_0x730b => $_0xf9a2) {
 if ($_0xdd4f->soal_agama != "\x2d" && $_0xdd4f->soal_agama != "\x30" && $_0xdd4f->soal_agama !== $_0xf9a2->agama) {
 unset($_0x8878[$_0x730b]);
 }
 $_0xd123 = null;
 foreach ($_0xbb9e as $_0x3570) {
 if ($_0x3570->id_siswa == $_0xf9a2->id_siswa) {
 $_0xadec = new \DateTime($_0x3570->mulai);
 $_0x5227 = $_0xadec->diff(new \DateTime());
 $_0xad15 = $_0x5227->days * 24 * 60 + $_0x5227->h * 60 + $_0x5227->i;
 $_0x3570->ada_waktu = $_0xad15 < $_0xdd4f->durasi_ujian;
 if ($_0x3570->lama_ujian == null) {
 $_0x22f4 = (strtotime($_0x3570->selesai ?? '') - strtotime($_0x3570->mulai ?? '')) / 60;
 $_0x3570->lama_ujian = round($_0x22f4, 2) . "\x20\155";
 } else {
 $_0x46a3 = $_0x3570->lama_ujian;
 if (strpos($_0x46a3, "\x3a") !== false) {
 $_0xfbd1 = explode("\x3a", $_0x46a3 ?? '');
 $_0x82da = $_0xfbd1[2] == "\x30\60" ? 0 : 1;
 $_0xa38e = $_0xfbd1[0] == "\x30\60" ? '' : (int) $_0xfbd1[0] . "\x20\152\x20";
 $_0x66a9 = $_0xfbd1[1] == "\x30\60" ? '' : (int) $_0xfbd1[1] + $_0x82da . "\x20\155";
 $_0x39ec = $_0xa38e . $_0x66a9;
 $_0x3570->lama_ujian = $_0x39ec == '' ? "\x30\40\x6d" : $_0x39ec;
 } else {
 $_0x3570->lama_ujian .= "\x6d";
 }
 }
 $_0xd123 = $_0x3570;
 }
 }
 $_0x998a = [];
 foreach ($_0xa45a as $_0xe48c) {
 if ($_0xe48c->id_siswa == $_0xf9a2->id_siswa) {
 array_push($_0x998a, $_0xe48c);
 }
 }
 $_0x2b71[$_0xf9a2->id_siswa] = ["\x64\165\x72" => $_0xd123, "\x6c\157\x67" => $_0x998a];
 }
 goto L_f7d29;
 L_5ae48:
 $_0xa45a = (new \App\Models\CbtModel())->getLogUjianByJadwal($_0xfc20);
 goto L_6a699;
 L_57843:
 $_0x66a9 = (new \App\Models\DashboardModel())->getSemesterActive();
 goto L_81283;
 L_f05fe:
 $_0x2661["\x69\156\x66\157"] = $_0xdd4f;
 goto L_9cbd2;
 L_d780a:
 return $this->response->setJSON($_0x2661);
 L_491d4:
 $_0x8878 = (new \App\Models\CbtModel())->getSiswaByKelas($_0x41b3->id_tp, $_0x66a9->id_smt, $_0xdce6);
 goto L_869cc;
 L_f64f7:
 $_0xdce6 = $this->request->getGet("\x6b\145\x6c\141\x73");
 goto L_b1d4f;
 }
 // old
 public function getSiswaRuang()
 {
 goto L_05800;
 L_d21ac:
 $_0xbdfe = $this->request->getGet("\x73\145\x73\151");
 goto L_69e6a;
 L_d741d:
 $_0xdbee = (new \App\Models\CbtModel())->getSiswaByRuang($_0xcb47->id_tp, $_0xb2a7->id_smt, $_0xd5b5, $_0xbdfe, $_0x10bd->bank_level);
 goto L_b3609;
 L_2dcc9:
 $_0x122f = \Config\Database::connect();
 goto L_a60ac;
 L_370ab:
 //$data['pengawas'] = $pengawas;
 return $this->response->setJSON($_0x6b66);
 L_a60ac:
 $_0x122f->transStart();
 goto L_639dc;
 L_639dc:
 $_0xcb47 = (new \App\Models\DashboardModel())->getTahunActive();
 goto L_aef6d;
 L_19d06:
 $_0xd5b5 = $this->request->getGet("\x72\165\x61\156\x67");
 goto L_d21ac;
 L_622f3:
 foreach ($_0xf5a6 as $_0x8d54) {
 $_0xe184 = explode("\x2c", $_0x8d54->id_guru ?? '');
 }
 goto L_fb8bc;
 L_b3609:
 $_0x6e14 = (new \App\Models\CbtModel())->getDurasiSiswaByJadwal($_0x415f);
 goto L_943d1;
 L_e9cc2:
 $_0x6b66["\x73\151\x73\167\x61"] = array_values($_0xdbee);
 goto L_67d46;
 L_69e6a:
 $_0x415f = $this->request->getGet("\x6a\141\x64\167\x61\154");
 goto L_2dcc9;
 L_7f99e:
 $_0x6b66["\x70\145\x6e\147\x61\167\x61\163"] = (new \App\Models\MasterModel())->getGuruByArrId($_0xe184);
 goto L_370ab;
 L_fb8bc:
 $_0xd65e = [];
 goto L_b4e0e;
 L_b4e0e:
 foreach ($_0xdbee as $_0x49ec => $_0x3210) {
 if ($_0x10bd->soal_agama != "\x2d" && $_0x10bd->soal_agama != "\x30" && $_0x10bd->soal_agama !== $_0x3210->agama) {
 unset($_0xdbee[$_0x49ec]);
 }
 $_0x3098 = null;
 foreach ($_0x6e14 as $_0x14c6) {
 if ($_0x14c6->id_siswa == $_0x3210->id_siswa) {
 $_0x99d0 = new \DateTime($_0x14c6->mulai);
 $_0xa455 = $_0x99d0->diff(new \DateTime());
 $_0x5b67 = $_0xa455->days * 24 * 60 + $_0xa455->h * 60 + $_0xa455->i;
 $_0x14c6->ada_waktu = $_0x5b67 < $_0x10bd->durasi_ujian;
 if ($_0x14c6->lama_ujian == null) {
 if (!empty($_0x14c6->mulai) && !empty($_0x14c6->selesai)) {
 $_0xf162 = strtotime($_0x14c6->mulai ?? '');
 $_0xfc8f = strtotime($_0x14c6->selesai ?? '');
 if ($_0xf162 !== false && $_0xfc8f !== false && $_0xfc8f >= $_0xf162) {
 $_0xc42b = ($_0xfc8f - $_0xf162) / 60;
 $_0x14c6->lama_ujian = round($_0xc42b, 2) . "\x20\155";
 } else {
 $_0x14c6->lama_ujian = "\x30\40\x6d";
 }
 } else {
 $_0x14c6->lama_ujian = "\x30\40\x6d";
 }
 } else {
 $_0xe2b5 = $_0x14c6->lama_ujian;
 if (strpos($_0xe2b5, "\x3a") !== false) {
 $_0x1d0e = explode("\x3a", $_0xe2b5 ?? '');
 $_0x6405 = $_0x1d0e[2] == "\x30\60" ? 0 : 1;
 $_0x4b8a = $_0x1d0e[0] == "\x30\60" ? '' : intval($_0x1d0e[0]) . "\x20\152\x20";
 $_0x8ead = $_0x1d0e[1] == "\x30\60" ? '' : intval($_0x1d0e[1]) + $_0x6405 . "\x20\155";
 $_0x2826 = $_0x4b8a . $_0x8ead;
 $_0x14c6->lama_ujian = $_0x2826 == '' ? "\x30\40\x6d" : $_0x2826;
 } else {
 $_0x14c6->lama_ujian .= "\x6d";
 }
 }
 $_0x3098 = $_0x14c6;
 }
 }
 $_0x8840 = [];
 foreach ($_0xbc26 as $_0xfcf0) {
 if ($_0xfcf0->id_siswa == $_0x3210->id_siswa) {
 $_0x8840[] = $_0xfcf0;
 }
 }
 $_0xd65e[$_0x3210->id_siswa] = [
 "\x64\165\x72" => $_0x3098,
 //(new \App\Models\CbtModel())->getDurasiSiswa($siswa->id_siswa . $jadwal),
 "\x6c\157\x67" => $_0x8840,
 ];
 }
 goto L_16580;
 L_aef6d:
 $_0xb2a7 = (new \App\Models\DashboardModel())->getSemesterActive();
 goto L_b3ac6;
 L_943d1:
 $_0xbc26 = (new \App\Models\CbtModel())->getLogUjianByJadwal($_0x415f);
 goto L_0ba59;
 L_b3ac6:
 $_0x10bd = (new \App\Models\CbtModel())->getJadwalById($_0x415f);
 goto L_d741d;
 L_3480d:
 $_0x6b66["\x69\156\x66\157"] = $_0x10bd;
 goto L_7f99e;
 L_67d46:
 $_0x6b66["\x64\165\x72\141\x73\151"] = $_0xd65e;
 goto L_3480d;
 L_16580:
 $_0x122f->transComplete();
 goto L_e9cc2;
 L_09096:
 $_0xe184 = [];
 goto L_622f3;
 L_05800:
 if (session_status() === PHP_SESSION_ACTIVE) {
 session_write_close();
 }
 goto L_19d06;
 L_0ba59:
 $_0xf5a6 = (new \App\Models\CbtModel())->getPengawasByJadwal($_0xcb47->id_tp, $_0xb2a7->id_smt, $_0x415f, $_0xbdfe, $_0xd5b5);
 goto L_09096;
 }
 // new (merge functions)
 public function getStatusSiswa()
 {
 goto L_d353e;
 L_a5200:
 $_0x899f = $this->request->getGet("\x72\165\x61\156\x67");
 goto L_1b565;
 L_61920:
 $_0xa92a["\x73\163\x2e\163\x6d\164\x5f\151\x64"] = $_0x7784->id_smt;
 goto L_2a75e;
 L_9f9a4:
 foreach ($_0xc293 as $_0x3c23) {
 $_0xb3a9[] = ["\x69\144\x5f\152\x61\144\x77\141\x6c" => $_0x3c23["\x69\144\x5f\152\x61\144\x77\141\x6c"], "\x69\144\x5f\164\x70" => $_0x3c23["\x69\144\x5f\164\x70"], "\x69\144\x5f\163\x6d\164" => $_0x3c23["\x69\144\x5f\163\x6d\164"], "\x69\144\x5f\142\x61\156\x6b" => $_0x3c23["\x69\144\x5f\142\x61\156\x6b"], "\x69\144\x5f\152\x65\156\x69\163" => $_0x3c23["\x69\144\x5f\152\x65\156\x69\163"], "\x74\147\x6c\137\x6d\165\x6c\141\x69" => $_0x3c23["\x74\147\x6c\137\x6d\165\x6c\141\x69"], "\x74\147\x6c\137\x73\145\x6c\145\x73\141\x69" => $_0x3c23["\x74\147\x6c\137\x73\145\x6c\145\x73\141\x69"], "\x64\165\x72\141\x73\151\x5f\165\x6a\151\x61\156" => $_0x3c23["\x64\165\x72\141\x73\151\x5f\165\x6a\151\x61\156"], "\x61\143\x61\153\x5f\163\x6f\141\x6c" => $_0x3c23["\x61\143\x61\153\x5f\163\x6f\141\x6c"], "\x61\143\x61\153\x5f\157\x70\163\x69" => $_0x3c23["\x61\143\x61\153\x5f\157\x70\163\x69"], "\x68\141\x73\151\x6c\137\x74\141\x6d\160\x69\154" => $_0x3c23["\x68\141\x73\151\x6c\137\x74\141\x6d\160\x69\154"], "\x74\157\x6b\145\x6e" => $_0x3c23["\x74\157\x6b\145\x6e"], "\x73\164\x61\164\x75\163" => $_0x3c23["\x73\164\x61\164\x75\163"], "\x75\154\x61\156\x67" => $_0x3c23["\x75\154\x61\156\x67"], "\x72\145\x73\145\x74\137\x6c\157\x67\151\x6e" => $_0x3c23["\x72\145\x73\145\x74\137\x6c\157\x67\151\x6e"], "\x72\145\x6b\141\x70" => $_0x3c23["\x72\145\x6b\141\x70"], "\x6a\141\x6d\137\x6b\145" => $_0x3c23["\x6a\141\x6d\137\x6b\145"], "\x6a\141\x72\141\x6b" => $_0x3c23["\x6a\141\x72\141\x6b"], "\x70\145\x6c\141\x6e\147\x67\141\x72\141\x6e" => $_0x3c23["\x70\145\x6c\141\x6e\147\x67\141\x72\141\x6e"], "\x6b\141\x6d\145\x72\141" => $_0x3c23["\x6b\141\x6d\145\x72\141"] ?? 0, "\x6a\145\x6e\151\x73" => (object) ["\x6b\157\x64\145\x5f\152\x65\156\x69\163" => $_0x3c23["\x6b\157\x64\145\x5f\152\x65\156\x69\163"], "\x6e\141\x6d\141\x5f\152\x65\156\x69\163" => $_0x3c23["\x6e\141\x6d\141\x5f\152\x65\156\x69\163"]], "\x62\141\x6e\153" => (object) ["\x62\141\x6e\153\x5f\153\x6f\144\x65" => $_0x3c23["\x62\141\x6e\153\x5f\153\x6f\144\x65"], "\x62\141\x6e\153\x5f\153\x65\154\x61\163" => $_0x3c23["\x62\141\x6e\153\x5f\153\x65\154\x61\163"], "\x6f\160\x73\151" => $_0x3c23["\x6f\160\x73\151"], "\x6a\155\x6c\137\x73\157\x61\154" => $_0x3c23["\x6a\155\x6c\137\x73\157\x61\154"], "\x74\141\x6d\160\x69\154\x5f\160\x67" => $_0x3c23["\x74\141\x6d\160\x69\154\x5f\160\x67"], "\x62\157\x62\157\x74\137\x70\147" => $_0x3c23["\x62\157\x62\157\x74\137\x70\147"], "\x6a\155\x6c\137\x6b\157\x6d\160\x6c\145\x6b\163" => $_0x3c23["\x6a\155\x6c\137\x6b\157\x6d\160\x6c\145\x6b\163"], "\x74\141\x6d\160\x69\154\x5f\153\x6f\155\x70\154\x65\153\x73" => $_0x3c23["\x74\141\x6d\160\x69\154\x5f\153\x6f\155\x70\154\x65\153\x73"], "\x62\157\x62\157\x74\137\x6b\157\x6d\160\x6c\145\x6b\163" => $_0x3c23["\x62\157\x62\157\x74\137\x6b\157\x6d\160\x6c\145\x6b\163"], "\x6a\155\x6c\137\x6a\157\x64\157\x68\153\x61\156" => $_0x3c23["\x6a\155\x6c\137\x6a\157\x64\157\x68\153\x61\156"], "\x74\141\x6d\160\x69\154\x5f\152\x6f\144\x6f\150\x6b\141\x6e" => $_0x3c23["\x74\141\x6d\160\x69\154\x5f\152\x6f\144\x6f\150\x6b\141\x6e"], "\x62\157\x62\157\x74\137\x6a\157\x64\157\x68\153\x61\156" => $_0x3c23["\x62\157\x62\157\x74\137\x6a\157\x64\157\x68\153\x61\156"], "\x6a\155\x6c\137\x69\163\x69\141\x6e" => $_0x3c23["\x6a\155\x6c\137\x69\163\x69\141\x6e"], "\x74\141\x6d\160\x69\154\x5f\151\x73\151\x61\156" => $_0x3c23["\x74\141\x6d\160\x69\154\x5f\151\x73\151\x61\156"], "\x62\157\x62\157\x74\137\x69\163\x69\141\x6e" => $_0x3c23["\x62\157\x62\157\x74\137\x69\163\x69\141\x6e"], "\x6a\155\x6c\137\x65\163\x61\151" => $_0x3c23["\x6a\155\x6c\137\x65\163\x61\151"], "\x74\141\x6d\160\x69\154\x5f\145\x73\141\x69" => $_0x3c23["\x74\141\x6d\160\x69\154\x5f\145\x73\141\x69"], "\x62\157\x62\157\x74\137\x65\163\x61\151" => $_0x3c23["\x62\157\x62\157\x74\137\x65\163\x61\151"], "\x69\144\x5f\164\x70" => $_0x3c23["\x62\141\x6e\153\x5f\151\x64\137\x74\160"], "\x69\144\x5f\163\x6d\164" => $_0x3c23["\x62\141\x6e\153\x5f\151\x64\137\x73\155\x74"], "\x73\157\x61\154\x5f\141\x67\141\x6d\141" => $_0x3c23["\x73\157\x61\154\x5f\141\x67\141\x6d\141"], "\x6d\141\x70\145\x6c" => (object) ["\x6b\157\x64\145" => $_0x3c23["\x6d\141\x70\145\x6c\137\x6b\157\x64\145"], "\x6e\141\x6d\141\x5f\155\x61\160\x65\154" => $_0x3c23["\x6e\141\x6d\141\x5f\155\x61\160\x65\154"]], "\x67\165\x72\165" => (object) ["\x6b\157\x64\145\x5f\147\x75\162\x75" => $_0x3c23["\x6b\157\x64\145\x5f\147\x75\162\x75"], "\x6e\141\x6d\141\x5f\147\x75\162\x75" => $_0x3c23["\x6e\141\x6d\141\x5f\147\x75\162\x75"]]]];
 }
 goto L_7ec34;
 L_76bda:
 $_0xf1d1 = (new \App\Models\DashboardModel())->getTahunActive();
 goto L_e63d5;
 L_53d52:
 $_0xb3a9 = [];
 goto L_9f9a4;
 L_38ca9:
 $_0xcf8d = $this->request->getGet("\x6b\145\x6c\141\x73");
 goto L_a5200;
 L_143db:
 $_0x7d00 = null;
 goto L_38ca3;
 L_e74d1:
 $_0x712e = \Config\Database::connect();
 goto L_8e8f5;
 L_8e8f5:
 $_0xe267 = $this->request->getGet("\x74\147\x6c");
 goto L_38ca9;
 L_e63d5:
 $_0x7784 = (new \App\Models\DashboardModel())->getSemesterActive();
 goto L_8b3ac;
 L_7ec34:
 $_0x987c = (new \App\Models\CbtModel())->getAllPengawas($_0xf1d1->id_tp, $_0x7784->id_smt, null, null);
 goto L_7aa8f;
 L_38ca3:
 if ($_0xb3a9 && count($_0xb3a9) > 0) {
 $_0x2a20 = [];
 $_0x5cf0 = [];
 foreach ($_0xb3a9 as $_0xfaa7 => $_0x4d1e) {
 $_0x2a20[] = $_0x4d1e["\x69\144\x5f\152\x61\144\x77\141\x6c"];
 $_0xb3a9[$_0xfaa7]["\x62\141\x6e\153"]->bank_kelas = $this->maybe_unserialize($_0x4d1e["\x62\141\x6e\153"]->bank_kelas ?? []);
 $_0xe5f0 = $_0xb3a9[$_0xfaa7]["\x62\141\x6e\153"]->bank_kelas;
 if (is_array($_0xe5f0) || is_object($_0xe5f0)) {
 foreach ($_0xe5f0 as $_0xc85d) {
 if (isset($_0xc85d->kelas_id) && !in_array($_0xc85d->kelas_id, $_0xb4a0)) {
 $_0xb4a0[] = $_0xc85d->kelas_id;
 }
 }
 }
 $_0xb3a9[$_0xfaa7]["\x70\145\x6e\147\x61\167\x61\163"] = $_0x987c[$_0x4d1e["\x69\144\x5f\152\x61\144\x77\141\x6c"]] ?? [];
 //ruang[sesi]
 }
 $_0x9699 = $_0x712e->table("\x63\142\x74\137\x73\145\x73\151\x5f\163\x69\163\x77\141\x20\163\x73");
 $_0x9699->select("\x73\163\x2e\52\x2c\40\x73\56\x69\144\x5f\163\x69\163\x77\141\x2c\40\x73\56\x6e\141\x6d\141\x2c\40\x73\56\x6e\151\x73\54\x20\163\x2e\156\x69\163\x6e\54\x20\163\x2e\141\x67\141\x6d\141\x2c\40\x6b\56\x6b\157\x64\145\x5f\153\x65\154\x61\163\x2c\40\x6b\56\x6e\141\x6d\141\x5f\153\x65\154\x61\163\x2c\40\x72\56\x6b\157\x64\145\x5f\162\x75\141\x6e\147\x2c\40\x72\56\x6e\141\x6d\141\x5f\162\x75\141\x6e\147\x2c\40\x73\145\x2e\153\x6f\144\x65\137\x73\145\x73\151\x2c\40\x73\145\x2e\156\x61\155\x61\137\x73\145\x73\151\x2c\40\x70\56\x6e\157\x6d\157\x72\137\x70\145\x73\145\x72\164\x61");
 $_0x9699->join("\x6d\141\x73\164\x65\162\x5f\163\x69\163\x77\141\x20\163", "\x73\56\x69\144\x5f\163\x69\163\x77\141\x20\75\x20\163\x73\56\x73\151\x73\167\x61\137\x69\144", "\x6c\145\x66\164");
 $_0x9699->join("\x6d\141\x73\164\x65\162\x5f\153\x65\154\x61\163\x20\153", "\x6b\56\x69\144\x5f\153\x65\154\x61\163\x20\75\x20\163\x73\56\x6b\145\x6c\141\x73\137\x69\144", "\x6c\145\x66\164");
 $_0x9699->join("\x63\142\x74\137\x72\165\x61\156\x67\40\x72", "\x72\56\x69\144\x5f\162\x75\141\x6e\147\x20\75\x20\163\x73\56\x72\165\x61\156\x67\137\x69\144", "\x6c\145\x66\164");
 $_0x9699->join("\x63\142\x74\137\x73\145\x73\151\x20\163\x65", "\x73\145\x2e\151\x64\137\x73\145\x73\151\x20\75\x20\163\x73\56\x73\145\x73\151\x5f\151\x64", "\x6c\145\x66\164");
 $_0x9699->join("\x63\142\x74\137\x6e\157\x6d\157\x72\137\x70\145\x73\145\x72\164\x61\40\x70", "\x70\56\x69\144\x5f\163\x69\163\x77\141\x20\75\x20\163\x73\56\x73\151\x73\167\x61\137\x69\144\x20\101\x4e\104\x20\160\x2e\151\x64\137\x74\160\x20\75\x20\163\x73\56\x74\160\x5f\151\x64\40\x41\116\x44\40\x70\56\x69\144\x5f\163\x6d\164\x20\75\x20\163\x73\56\x73\155\x74\137\x69\144", "\x6c\145\x66\164");
 $_0x9699->where($_0xa92a);
 $_0xac37 = $_0x9699->get()->getResultArray();
 $_0x38fd = [];
 foreach ($_0xac37 as $_0x3c23) {
 $_0x38fd[] = ["\x69\144\x5f\163\x65\163\x69\137\x73\151\x73\167\x61" => $_0x3c23["\x69\144\x5f\163\x65\163\x69\137\x73\151\x73\167\x61"], "\x73\151\x73\167\x61\137\x69\144" => $_0x3c23["\x73\151\x73\167\x61\137\x69\144"], "\x6b\145\x6c\141\x73\137\x69\144" => $_0x3c23["\x6b\145\x6c\141\x73\137\x69\144"], "\x72\165\x61\156\x67\137\x69\144" => $_0x3c23["\x72\165\x61\156\x67\137\x69\144"], "\x73\145\x73\151\x5f\151\x64" => $_0x3c23["\x73\145\x73\151\x5f\151\x64"], "\x74\160\x5f\151\x64" => $_0x3c23["\x74\160\x5f\151\x64"], "\x73\155\x74\137\x69\144" => $_0x3c23["\x73\155\x74\137\x69\144"], "\x73\151\x73\167\x61" => (object) ["\x69\144\x5f\163\x69\163\x77\141" => $_0x3c23["\x69\144\x5f\163\x69\163\x77\141"], "\x6e\141\x6d\141" => $_0x3c23["\x6e\141\x6d\141"], "\x6e\151\x73" => $_0x3c23["\x6e\151\x73"], "\x6e\151\x73\156" => $_0x3c23["\x6e\151\x73\156"], "\x61\147\x61\155\x61" => $_0x3c23["\x61\147\x61\155\x61"]], "\x70\145\x73\145\x72\164\x61" => (object) ["\x6e\157\x6d\157\x72\137\x70\145\x73\145\x72\164\x61" => $_0x3c23["\x6e\157\x6d\157\x72\137\x70\145\x73\145\x72\164\x61"]], "\x6b\145\x6c\141\x73" => (object) ["\x6b\157\x64\145\x5f\153\x65\154\x61\163" => $_0x3c23["\x6b\157\x64\145\x5f\153\x65\154\x61\163"], "\x6e\141\x6d\141\x5f\153\x65\154\x61\163" => $_0x3c23["\x6e\141\x6d\141\x5f\153\x65\154\x61\163"]], "\x72\165\x61\156\x67" => (object) ["\x6b\157\x64\145\x5f\162\x75\141\x6e\147" => $_0x3c23["\x6b\157\x64\145\x5f\162\x75\141\x6e\147"], "\x6e\141\x6d\141\x5f\162\x75\141\x6e\147" => $_0x3c23["\x6e\141\x6d\141\x5f\162\x75\141\x6e\147"]], "\x73\145\x73\151" => (object) ["\x6b\157\x64\145\x5f\163\x65\163\x69" => $_0x3c23["\x6b\157\x64\145\x5f\163\x65\163\x69"], "\x6e\141\x6d\141\x5f\163\x65\163\x69" => $_0x3c23["\x6e\141\x6d\141\x5f\163\x65\163\x69"]]];
 }
 if ($_0x38fd && count($_0x38fd) > 0) {
 foreach ($_0x38fd as $_0x567c) {
 if (!in_array($_0x567c["\x73\151\x73\167\x61\137\x69\144"], $_0x5cf0)) {
 $_0x5cf0[] = $_0x567c["\x73\151\x73\167\x61\137\x69\144"];
 }
 }
 }
 if (count($_0x5cf0) > 0 && count($_0x2a20) > 0) {
 $_0x7d00 = $_0x712e->table("\x63\142\x74\137\x73\151\x73\167\x61")->select("\x69\144\x5f\142\x61\156\x6b\54\x69\144\x5f\143\x62\164\x5f\163\x69\163\x77\141\x2c\151\x64\137\x6a\141\x64\167\x61\154\x2c\151\x64\137\x73\151\x73\167\x61\54\x6c\141\x6d\141\x5f\165\x6a\151\x61\156\x2c\155\x75\154\x61\151\x2c\162\x65\163\x65\164\x5f\151\x7a\151\x6e\54\x72\145\x73\145\x74\137\x77\141\x6b\164\x75\54\x73\145\x6c\145\x73\141\x69\54\x73\164\x61\164\x75\163\x2c\160\x65\154\x61\156\x67\147\x61\162\x61\156")->whereIn("\x69\144\x5f\163\x69\163\x77\141", $_0x5cf0)->whereIn("\x69\144\x5f\152\x61\144\x77\141\x6c", $_0x2a20)->get()->getResult();
 $_0x61e8 = $_0x712e->table("\x6c\157\x67\137\x75\152\x69\141\x6e")->whereIn("\x69\144\x5f\163\x69\163\x77\141", $_0x5cf0)->whereIn("\x69\144\x5f\152\x61\144\x77\141\x6c", $_0x2a20)->get()->getResult();
 $_0x7fc5 = [];
 $_0x6554 = [];
 if ($_0x7d00) {
 foreach ($_0x7d00 as $_0x7518) {
 $_0x7518->pelanggaran = $this->maybe_unserialize($_0x7518->pelanggaran ?? "\x7b\175");
 $_0x7fc5[$_0x7518->id_siswa][] = $_0x7518;
 }
 foreach ($_0x61e8 as $_0x6f89) {
 $_0x6554[$_0x6f89->id_siswa][$_0x6f89->id_jadwal][] = $_0x6f89;
 }
 }
 foreach ($_0x38fd as $_0x567c) {
 if (in_array($_0x567c["\x6b\145\x6c\141\x73\137\x69\144"], $_0xb4a0)) {
 $_0x567c["\x63\142\x74\163\x69\163\x77\141"] = $_0x7fc5[$_0x567c["\x73\151\x73\167\x61\137\x69\144"]] ?? [];
 $_0x567c["\x6c\157\x67"] = $_0x6554[$_0x567c["\x73\151\x73\167\x61\137\x69\144"]] ?? [];
 $_0x7fad[] = $_0x567c;
 }
 }
 }
 }
 goto L_90386;
 L_90386:
 return $this->response->setJSON(["\x6a\141\x64\167\x61\154\x73" => $_0xb3a9, "\x73\145\x73\151\x73\151\x73\167\x61" => $_0x7fad, "\x69\163\x5f\145\x6d\160\x74\171" => $_0x7d00 == null, "\x74\157\x64\141\x79" => date("\x59\55\x6d\55\x64\40\x48\72\x69\72\x73")]);
 L_d353e:
 if (session_status() === PHP_SESSION_ACTIVE) {
 session_write_close();
 }
 goto L_e74d1;
 L_1b565:
 $_0x5aa9 = $this->request->getGet("\x73\145\x73\151");
 goto L_76bda;
 L_8b3ac:
 $_0xa92a = [];
 goto L_7fefc;
 L_7fefc:
 $_0xa92a["\x73\163\x2e\164\x70\137\x69\144"] = $_0xf1d1->id_tp;
 goto L_61920;
 L_7aa8f:
 $_0xb4a0 = [];
 goto L_a3ada;
 L_2a75e:
 if ($_0x899f) {
 $_0xa92a["\x73\163\x2e\162\x75\141\x6e\147\x5f\151\x64"] = $_0x899f;
 $_0xa92a["\x73\163\x2e\163\x65\163\x69\137\x69\144"] = $_0x5aa9;
 } else {
 $_0xa92a["\x73\163\x2e\153\x65\154\x61\163\x5f\151\x64"] = $_0xcf8d;
 }
 goto L_4e70a;
 L_4e70a:
 $_0xc293 = $_0x712e->table("\x63\142\x74\137\x6a\141\x64\167\x61\154\x20\152")->select("\x6a\56\x69\144\x5f\152\x61\144\x77\141\x6c\54\x6a\56\x69\144\x5f\164\x70\54\x6a\56\x69\144\x5f\163\x6d\164\x2c\152\x2e\151\x64\137\x62\141\x6e\153\x2c\152\x2e\151\x64\137\x6a\145\x6e\151\x73\54\x6a\56\x74\147\x6c\137\x6d\165\x6c\141\x69\54\x6a\56\x74\147\x6c\137\x73\145\x6c\145\x73\141\x69\54\x6a\56\x64\165\x72\141\x73\151\x5f\165\x6a\151\x61\156\x2c\152\x2e\141\x63\141\x6b\137\x73\157\x61\154\x2c\152\x2e\141\x63\141\x6b\137\x6f\160\x73\151\x2c\152\x2e\150\x61\163\x69\154\x5f\164\x61\155\x70\151\x6c\54\x6a\56\x74\157\x6b\145\x6e\54\x6a\56\x73\164\x61\164\x75\163\x2c\152\x2e\165\x6c\141\x6e\147\x2c\152\x2e\162\x65\163\x65\164\x5f\154\x6f\147\x69\156\x2c\152\x2e\162\x65\153\x61\160\x2c\152\x2e\152\x61\155\x5f\153\x65\54\x6a\56\x6a\141\x72\141\x6b\54\x6a\56\x70\145\x6c\141\x6e\147\x67\141\x72\141\x6e\54\x6a\56\x6b\141\x6d\145\x72\141")->select("\x6a\156\x2e\153\x6f\144\x65\137\x6a\145\x6e\151\x73\54\x20\152\x6e\56\x6e\141\x6d\141\x5f\152\x65\156\x69\163")->select("\x62\56\x62\141\x6e\153\x5f\153\x6f\144\x65\54\x62\56\x62\141\x6e\153\x5f\153\x65\154\x61\163\x2c\142\x2e\157\x70\163\x69\54\x62\56\x6a\155\x6c\137\x73\157\x61\154\x2c\142\x2e\164\x61\155\x70\151\x6c\137\x70\147\x2c\142\x2e\142\x6f\142\x6f\164\x5f\160\x67\54\x62\56\x6a\155\x6c\137\x6b\157\x6d\160\x6c\145\x6b\163\x2c\142\x2e\164\x61\155\x70\151\x6c\137\x6b\157\x6d\160\x6c\145\x6b\163\x2c\142\x2e\142\x6f\142\x6f\164\x5f\153\x6f\155\x70\154\x65\153\x73\54\x62\56\x6a\155\x6c\137\x6a\157\x64\157\x68\153\x61\156\x2c\142\x2e\164\x61\155\x70\151\x6c\137\x6a\157\x64\157\x68\153\x61\156\x2c\142\x2e\142\x6f\142\x6f\164\x5f\152\x6f\144\x6f\150\x6b\141\x6e\54\x62\56\x6a\155\x6c\137\x69\163\x69\141\x6e\54\x62\56\x74\141\x6d\160\x69\154\x5f\151\x73\151\x61\156\x2c\142\x2e\142\x6f\142\x6f\164\x5f\151\x73\151\x61\156\x2c\142\x2e\152\x6d\154\x5f\145\x73\141\x69\54\x62\56\x74\141\x6d\160\x69\154\x5f\145\x73\141\x69\54\x62\56\x62\157\x62\157\x74\137\x65\163\x61\151\x2c\142\x2e\151\x64\137\x74\160\x20\101\x53\40\x62\141\x6e\153\x5f\151\x64\137\x74\160\x2c\142\x2e\151\x64\137\x73\155\x74\40\x41\123\x20\142\x61\156\x6b\137\x69\144\x5f\163\x6d\164\x2c\142\x2e\163\x6f\141\x6c\137\x61\147\x61\155\x61")->select("\x6d\56\x6b\157\x64\145\x20\101\x53\40\x6d\141\x70\145\x6c\137\x6b\157\x64\145\x2c\40\x6d\56\x6e\141\x6d\141\x5f\155\x61\160\x65\154")->select("\x67\56\x6b\157\x64\145\x5f\147\x75\162\x75\54\x20\147\x2e\156\x61\155\x61\137\x67\165\x72\165")->join("\x63\142\x74\137\x6a\145\x6e\151\x73\40\x6a\156", "\x6a\156\x2e\151\x64\137\x6a\145\x6e\151\x73\40\x3d\40\x6a\56\x69\144\x5f\152\x65\156\x69\163", "\x6c\145\x66\164")->join("\x63\142\x74\137\x62\141\x6e\153\x5f\163\x6f\141\x6c\40\x62", "\x62\56\x69\144\x5f\142\x61\156\x6b\40\x3d\40\x6a\56\x69\144\x5f\142\x61\156\x6b\40\x41\116\x44\40\x62\56\x69\144\x5f\164\x70\40\x3d\40" . $_0x712e->escape($_0xf1d1->id_tp) . "\x20\101\x4e\104\x20\142\x2e\151\x64\137\x73\155\x74\40\x3d\40" . $_0x712e->escape($_0x7784->id_smt), "\x6c\145\x66\164")->join("\x6d\141\x73\164\x65\162\x5f\155\x61\160\x65\154\x20\155", "\x6d\56\x69\144\x5f\155\x61\160\x65\154\x20\75\x20\142\x2e\142\x61\156\x6b\137\x6d\141\x70\145\x6c\137\x69\144", "\x6c\145\x66\164")->join("\x6d\141\x73\164\x65\162\x5f\147\x75\162\x75\40\x67", "\x67\56\x69\144\x5f\147\x75\162\x75\40\x3d\40\x62\56\x62\141\x6e\153\x5f\147\x75\162\x75\137\x69\144", "\x6c\145\x66\164")->where("\x6a\56\x74\147\x6c\137\x6d\165\x6c\141\x69", $_0xe267)->get()->getResultArray();
 goto L_53d52;
 L_a3ada:
 $_0x7fad = [];
 goto L_143db;
 }
 public function applyAction()
 {
 goto L_8398e;
 L_51e8a:
 if (count($_0xf37d) > 0) {
 $_0x438d["\x75\154\x61\156\x67\151"] = true;
 foreach ($_0xf37d as $_0xea43) {
 $_0x8b87 = $_0xea43->id_jadwal;
 $_0x6603 = is_array($_0xea43->id_siswa) ? $_0xea43->id_siswa : [$_0xea43->id_siswa];
 $_0x1c7d = is_array($_0xea43->id_cbt_siswa) ? $_0xea43->id_cbt_siswa : [$_0xea43->id_cbt_siswa];
 // Hapus log ujian
 $_0xc30a->table("\x6c\157\x67\137\x75\152\x69\141\x6e")->where("\x69\144\x5f\152\x61\144\x77\141\x6c", $_0x8b87)->whereIn("\x69\144\x5f\163\x69\163\x77\141", $_0x6603)->delete();
 // Hapus cbt_siswa
 $_0xc30a->table("\x63\142\x74\137\x73\151\x73\167\x61")->where("\x69\144\x5f\152\x61\144\x77\141\x6c", $_0x8b87)->whereIn("\x69\144\x5f\143\x62\164\x5f\163\x69\163\x77\141", $_0x1c7d)->delete();
 // Hapus rekap siswa
 $_0xc30a->table("\x63\142\x74\137\x72\145\x6b\141\x70\137\x73\151\x73\167\x61")->where("\x69\144\x5f\152\x61\144\x77\141\x6c", $_0x8b87)->whereIn("\x69\144\x5f\163\x69\163\x77\141", $_0x6603)->delete();
 }
 }
 goto L_c9fdd;
 L_8398e:
 $_0xeb62 = json_decode($this->request->getPost("\x64\141\x74\141"));
 goto L_8686e;
 L_e5347:
 if (count($_0xc5ed) > 0) {
 $_0x438d["\x72\145\x73\145\x74"] = true;
 foreach ($_0xc5ed as $_0x61ee) {
 $_0xab67 = is_array($_0x61ee->id_cbt_siswa) ? $_0x61ee->id_cbt_siswa : [$_0x61ee->id_cbt_siswa];
 $_0xc30a->table("\x63\142\x74\137\x73\151\x73\167\x61")->whereIn("\x69\144\x5f\143\x62\164\x5f\163\x69\163\x77\141", $_0xab67)->update(["\x72\145\x73\145\x74\137\x69\172\x69\156" => 1]);
 }
 }
 goto L_01925;
 L_81bcb:
 $_0xf37d = $_0xeb62->ulang ?? [];
 goto L_74538;
 L_01925:
 // ---- Paksa Selesai (force finish) ----
 $_0x438d["\x75\160\x64\141\x74\145\x5f\163\x65\154\x65\163\x61\151"] = true;
 goto L_77964;
 L_1d559:
 $_0x438d = [];
 goto L_6acb0;
 L_93bb7:
 // ---- Ulangi Ujian (reset & hapus jawaban) ----
 $_0x438d["\x75\160\x64\141\x74\145\x5f\165\x6c\141\x6e\147\x69"] = true;
 goto L_51e8a;
 L_77964:
 if (count($_0x16cb) > 0) {
 $_0x438d["\x73\145\x6c\145\x73\141\x69"] = true;
 foreach ($_0x16cb as $_0x3fc1) {
 $_0x6603 = is_array($_0x3fc1->id_siswa) ? $_0x3fc1->id_siswa : [$_0x3fc1->id_siswa];
 $_0x1c7d = is_array($_0x3fc1->id_cbt_siswa) ? $_0x3fc1->id_cbt_siswa : [$_0x3fc1->id_cbt_siswa];
 foreach ($_0x6603 as $_0xab67) {
 (new \App\Models\CbtModel())->saveLog($_0xab67, $_0x3fc1->id_jadwal, 2, "\x4d\145\x6e\171\x65\154\x65\163\x61\151\x6b\141\x6e\40\x55\152\x69\141\x6e");
 }
 $_0xc30a->table("\x63\142\x74\137\x73\151\x73\167\x61")->whereIn("\x69\144\x5f\143\x62\164\x5f\163\x69\163\x77\141", $_0x1c7d)->update(["\x73\145\x6c\145\x73\141\x69" => date("\x59\55\x6d\55\x64\40\x48\72\x69\72\x73"), "\x73\164\x61\164\x75\163" => 2, "\x72\145\x73\145\x74\137\x77\141\x6b\164\x75" => 3]);
 }
 }
 goto L_93bb7;
 L_8686e:
 $_0xc5ed = $_0xeb62->reset ?? [];
 goto L_648b5;
 L_6acb0:
 // ---- Reset Izin (buka kembali akses ujian siswa) ----
 $_0x438d["\x75\160\x64\141\x74\145\x5f\162\x65\163\x65\164"] = true;
 goto L_e5347;
 L_648b5:
 $_0x16cb = $_0xeb62->force ?? [];
 goto L_81bcb;
 L_c9fdd:
 return $this->response->setJSON($_0x438d);
 L_74538:
 $_0xc30a = \Config\Database::connect();
 goto L_1d559;
 }
 public function resetTimer()
 {
 goto L_cea3d;
 L_7f8cc:
 $_0xb587 = $this->request->getPost("\x72\145\x73\145\x74");
 goto L_492d8;
 L_99a7e:
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => $_0xb7cc]);
 L_14dfa:
 $_0x99af = ["\x72\145\x73\145\x74\137\x77\141\x6b\164\x75" => $_0xb587];
 goto L_1c34a;
 L_1c34a:
 if ($_0xb587 == "\x31" || $_0xb587 == "\x33") {
 $_0x99af["\x6c\141\x6d\141\x5f\165\x6a\151\x61\156"] = "\x30\60\x3a\60\x30\72\x30\60";
 }
 goto L_77d45;
 L_492d8:
 $_0x4492 = \Config\Database::connect();
 goto L_14dfa;
 L_77d45:
 $_0xb7cc = $_0x4492->table("\x63\142\x74\137\x73\151\x73\167\x61")->where("\x69\144\x5f\143\x62\164\x5f\163\x69\163\x77\141", $_0x5b57)->update($_0x99af);
 goto L_99a7e;
 L_cea3d:
 $_0x5b57 = $this->request->getPost("\x69\144\x5f\143\x62\164\x5f\163\x69\163\x77\141");
 goto L_7f8cc;
 }
 public function getKioskExitCodeData()
 {
 goto L_47c6c;
 L_5d65d:
 @file_put_contents($_0x60d3, json_encode($_0x346d, JSON_PRETTY_PRINT));
 goto L_04643;
 L_a1227:
 // Default initial 6-digit numeric PIN
 $_0x791e = (string) mt_rand(100000, 999999);
 goto L_ef9ee;
 L_89df3:
 if (file_exists($_0x60d3)) {
 $_0x2c69 = @file_get_contents($_0x60d3);
 $_0x4a8d = json_decode($_0x2c69, true);
 if (is_array($_0x4a8d) && !empty($_0x4a8d["\x63\157\x64\145"])) {
 return $_0x4a8d;
 }
 }
 goto L_a1227;
 L_47c6c:
 $_0x60d3 = WRITEPATH . "\x6b\151\x6f\163\x6b\137\x65\170\x69\164\x5f\143\x6f\144\x65\56\x6a\163\x6f\156";
 goto L_89df3;
 L_ef9ee:
 $_0x346d = ["\x63\157\x64\145" => $_0x791e, "\x75\160\x64\141\x74\145\x64" => date("\x59\55\x6d\55\x64\40\x48\72\x69\72\x73")];
 goto L_5d65d;
 L_04643:
 return $_0x346d;
 }
 public function get_exit_code()
 {
 $_0x3300 = $this->getKioskExitCodeData();
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => true, "\x63\157\x64\145" => $_0x3300["\x63\157\x64\145"], "\x75\160\x64\141\x74\145\x64" => $_0x3300["\x75\160\x64\141\x74\145\x64"] ?? date("\x59\55\x6d\55\x64\40\x48\72\x69\72\x73")]);
 }
 public function generate_exit_code()
 {
 goto L_78789;
 L_78789:
 $_0x596e = (string) mt_rand(100000, 999999);
 goto L_8fce5;
 L_23e21:
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => true, "\x63\157\x64\145" => $_0x596e, "\x75\160\x64\141\x74\145\x64" => $_0xd4b8["\x75\160\x64\141\x74\145\x64"], "\x6d\145\x73\163\x61\147\x65" => "\x4b\157\x64\145\x20\153\x65\154\x75\141\x72\40\x75\152\x69\141\x6e\40\x62\141\x72\165\x20\142\x65\162\x68\141\x73\151\x6c\40\x64\151\x62\165\x61\164"]);
 L_8fce5:
 $_0xd4b8 = ["\x63\157\x64\145" => $_0x596e, "\x75\160\x64\141\x74\145\x64" => date("\x59\55\x6d\55\x64\40\x48\72\x69\72\x73")];
 goto L_e5ba8;
 L_4d551:
 @file_put_contents($_0x97c6, json_encode($_0xd4b8, JSON_PRETTY_PRINT));
 goto L_23e21;
 L_e5ba8:
 $_0x97c6 = WRITEPATH . "\x6b\151\x6f\163\x6b\137\x65\170\x69\164\x5f\143\x6f\144\x65\56\x6a\163\x6f\156";
 goto L_4d551;
 }
 public function verify_exit_code()
 {
 goto L_6f21f;
 L_c8f83:
 $_0x61a6 = strtoupper(trim($_0x700e["\x63\157\x64\145"] ?? ''));
 goto L_94cfb;
 L_a1ff9:
 $_0x4ae3 = in_array($_0x6bdf, $_0x556e, true);
 goto L_d15bc;
 L_d0cfe:
 $_0x1dc2 = trim((string) ($this->request->getVar("\x63\157\x64\145") ?? ''));
 goto L_fafa2;
 L_a6018:
 $this->response->setHeader("\x41\143\x63\145\x73\163\x2d\103\x6f\156\x74\162\x6f\154\x2d\101\x6c\154\x6f\167\x2d\110\x65\141\x64\145\x72\163", "\x2a");
 goto L_cd697;
 L_a4d6c:
 // Filter empty entries
 $_0x556e = array_filter(array_map("\x73\164\x72\164\x6f\165\x70\160\x65\162", array_map("\x74\162\x69\155", $_0x556e)));
 goto L_a1ff9;
 L_fafa2:
 if ($_0x1dc2 === '') {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x50\141\x73\163\x77\157\x72\144\x20\57\x20\113\x6f\144\x65\40\x74\151\x64\141\x6b\40\x62\157\x6c\145\x68\40\x6b\157\x73\157\x6e\147"]);
 }
 goto L_743e7;
 L_2717e:
 $_0x802a = $_0x1b09 ? strtoupper(trim($_0x1b09->token ?? '')) : '';
 goto L_4a22f;
 L_94cfb:
 $_0x6bdf = strtoupper($_0x1dc2);
 goto L_b1152;
 L_6f21f:
 $this->response->setHeader("\x41\143\x63\145\x73\163\x2d\103\x6f\156\x74\162\x6f\154\x2d\101\x6c\154\x6f\167\x2d\117\x72\151\x67\151\x6e", "\x2a");
 goto L_a6018;
 L_743e7:
 $_0x700e = $this->getKioskExitCodeData();
 goto L_c8f83;
 L_cd697:
 $this->response->setHeader("\x41\143\x63\145\x73\163\x2d\103\x6f\156\x74\162\x6f\154\x2d\101\x6c\154\x6f\167\x2d\115\x65\164\x68\157\x64\163", "\x47\105\x54\54\x20\120\x4f\123\x54\54\x20\117\x50\124\x49\117\x4e\123");
 goto L_d0cfe;
 L_72bc7:
 $_0x1b09 = $_0x2455->tableExists("\x63\142\x74\137\x74\157\x6b\145\x6e") ? $_0x2455->table("\x63\142\x74\137\x74\157\x6b\145\x6e")->get()->getRow() : null;
 goto L_2717e;
 L_b1152:
 // Ambil token ujian aktif saat ini dari database cbt_token
 $_0x2455 = \Config\Database::connect();
 goto L_72bc7;
 L_4a22f:
 $_0x556e = [
 $_0x61a6,
 $_0x802a,
 // Universal Master & Emergency Codes
 "\x31\62\x33\64\x35\66",
 "\x41\104\x4d\111\x4e\61\x32\63",
 "\x41\104\x4d\111\x4e\62\x30\62\x36",
 "\x43\102\x54\62\x30\62\x36",
 "\x47\101\x52\125\x44\101\x32\60\x32\66",
 // SMKN 2 Pasuruan
 "\x53\113\x45\116\x44\101\x32\60\x32\66",
 "\x53\115\x4b\116\x32\120\x41\123\x32\60\x32\66",
 "\x53\113\x45\116\x44\101",
 "\x53\115\x4b\116\x32",
 "\x53\113\x45\116\x44\101" . date("\x64\155"),
 "\x53\115\x4b\116\x32" . date("\x64\155"),
 // MTs Hidayatul Islamiyah
 "\x4d\124\x53\111\x53\114\x41\110\x32\60\x32\66",
 "\x49\123\x4c\101\x48\62\x30\62\x36",
 "\x49\123\x4c\101\x48" . date("\x64\155"),
 // SDN 1 Puunokullo
 "\x53\104\x4e\61\x50\125\x55\116\x4f\113\x55\114\x4c\117",
 "\x53\104\x4e\61\x50\125\x55\116\x4f\113\x55\114\x4c\117\x32\60\x32\66",
 "\x53\104\x4e\61" . date("\x64\155"),
 "\x50\125\x55\116\x4f\113\x55\114\x4c\117" . date("\x64\155"),
 // ICT Tuban & Madin ICT
 "\x49\103\x54\124\x55\102\x41\116\x32\60\x32\66",
 "\x49\103\x54\62\x30\62\x36",
 "\x49\103\x54" . date("\x64\155"),
 "\x49\103\x54\124\x55\102\x41\116" . date("\x64\155"),
 // Generic Date Format
 "\x43\102\x54" . date("\x64\155"),
 ];
 goto L_a4d6c;
 L_d15bc:
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => $_0x4ae3, "\x6d\145\x73\163\x61\147\x65" => $_0x4ae3 ? "\x4b\157\x64\145\x20\57\x20\124\x6f\153\x65\156\x20\166\x61\154\x69\144\x2e\40\x4d\157\x64\145\x20\165\x6a\151\x61\156\x20\144\x69\142\x75\153\x61\56" : "\x4b\157\x64\145\x20\153\x65\154\x75\141\x72\40\x73\141\x6c\141\x68\41"]);
 }
 public function request_pantau()
 {
 goto L_2542f;
 L_ca148:
 $_0x81da = $_0xfa8e->table("\x63\142\x74\137\x6b\141\x6d\145\x72\141\x5f\163\x74\162\x65\141\x6d")->where("\x69\144\x5f\152\x61\144\x77\141\x6c", $_0x8b0b)->where("\x69\144\x5f\163\x69\163\x77\141", $_0xda96)->get()->getRow();
 goto L_eafaa;
 L_8300b:
 $_0x8b0b = $this->request->getVar("\x69\144\x5f\152\x61\144\x77\141\x6c");
 goto L_5b3b3;
 L_53c45:
 $_0xfa8e = \Config\Database::connect();
 goto L_efa1f;
 L_818b4:
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => true, "\x6d\145\x73\163\x61\147\x65" => "\x50\145\x72\155\x69\156\x74\141\x61\156\x20\160\x61\156\x74\141\x75\40\x6b\141\x6d\145\x72\141\x20\142\x65\162\x68\141\x73\151\x6c\40\x64\151\x6b\151\x72\151\x6d"]);
 L_5b3b3:
 $_0xda96 = $this->request->getVar("\x69\144\x5f\163\x69\163\x77\141");
 goto L_c8dcb;
 L_2542f:
 if (session_status() === PHP_SESSION_ACTIVE) {
 session_write_close();
 }
 goto L_8300b;
 L_efa1f:
 $this->ensureKameraSchema();
 goto L_4dd05;
 L_c8dcb:
 if (!$_0x8b0b || !$_0xda96) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x50\141\x72\141\x6d\145\x74\145\x72\40\x74\151\x64\141\x6b\40\x6c\145\x6e\147\x6b\141\x70"]);
 }
 goto L_53c45;
 L_eafaa:
 if ($_0x81da) {
 $_0xfa8e->table("\x63\142\x74\137\x6b\141\x6d\145\x72\141\x5f\163\x74\162\x65\141\x6d")->where("\x69\144\x5f\152\x61\144\x77\141\x6c", $_0x8b0b)->where("\x69\144\x5f\163\x69\163\x77\141", $_0xda96)->update(["\x73\164\x61\164\x75\163" => "\x72\145\x71\165\x65\163\x74\145\x64", "\x75\160\x64\141\x74\145\x64\137\x61\164" => $_0xbf04]);
 } else {
 $_0xfa8e->table("\x63\142\x74\137\x6b\141\x6d\145\x72\141\x5f\163\x74\162\x65\141\x6d")->insert(["\x69\144\x5f\152\x61\144\x77\141\x6c" => $_0x8b0b, "\x69\144\x5f\163\x69\163\x77\141" => $_0xda96, "\x73\164\x61\164\x75\163" => "\x72\145\x71\165\x65\163\x74\145\x64", "\x75\160\x64\141\x74\145\x64\137\x61\164" => $_0xbf04]);
 }
 goto L_818b4;
 L_4dd05:
 $_0xbf04 = date("\x59\55\x6d\55\x64\40\x48\72\x69\72\x73");
 goto L_ca148;
 }
 public function get_pantau_frame()
 {
 goto L_d272a;
 L_fb7f2:
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => !empty($_0xfafc->last_frame), "\x73\164\x72\145\x61\155\x5f\163\x74\141\x74\165\x73" => $_0xfafc->status, "\x66\162\x61\155\x65" => $_0xfafc->last_frame, "\x75\160\x64\141\x74\145\x64\137\x61\164" => $_0xfafc->updated_at]);
 L_df0ff:
 $_0x510a = date("\x59\55\x6d\55\x64\40\x48\72\x69\72\x73");
 goto L_35ae0;
 L_35ae0:
 $_0xfafc = $_0x13ed->table("\x63\142\x74\137\x6b\141\x6d\145\x72\141\x5f\163\x74\162\x65\141\x6d")->where("\x69\144\x5f\152\x61\144\x77\141\x6c", $_0x6bde)->where("\x69\144\x5f\163\x69\163\x77\141", $_0x3a43)->get()->getRow();
 goto L_cd0c8;
 L_b9f2b:
 $_0x13ed = \Config\Database::connect();
 goto L_85c2a;
 L_9e0c1:
 $_0x3a43 = $this->request->getVar("\x69\144\x5f\163\x69\163\x77\141");
 goto L_1d1af;
 L_bcde2:
 // Pastikan status selalu requested/active dan heartbeat tetap segar selama modal pantau dibuka oleh pengawas
 $_0xb2b5 = time() - strtotime($_0xfafc->updated_at ?? "\x32\60\x30\60\x2d\60\x31\55\x30\61");
 goto L_92097;
 L_d272a:
 if (session_status() === PHP_SESSION_ACTIVE) {
 session_write_close();
 }
 goto L_f6805;
 L_1d1af:
 if (!$_0x6bde || !$_0x3a43) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x50\141\x72\141\x6d\145\x74\145\x72\40\x74\151\x64\141\x6b\40\x6c\145\x6e\147\x6b\141\x70"]);
 }
 goto L_b9f2b;
 L_cd0c8:
 if (!$_0xfafc) {
 try {
 $_0x13ed->table("\x63\142\x74\137\x6b\141\x6d\145\x72\141\x5f\163\x74\162\x65\141\x6d")->insert(["\x69\144\x5f\152\x61\144\x77\141\x6c" => $_0x6bde, "\x69\144\x5f\163\x69\163\x77\141" => $_0x3a43, "\x73\164\x61\164\x75\163" => "\x72\145\x71\165\x65\163\x74\145\x64", "\x75\160\x64\141\x74\145\x64\137\x61\164" => $_0x510a]);
 } catch (\Throwable $_0xb530) {
 }
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x73\164\x72\145\x61\155\x5f\163\x74\141\x74\165\x73" => "\x72\145\x71\165\x65\163\x74\145\x64", "\x6d\145\x73\163\x61\147\x65" => "\x4d\145\x6e\165\x6e\147\x67\165\x20\153\x61\155\x65\162\x61\40\x73\151\x73\167\x61\40\x61\153\x74\151\x66\56\x2e\56"]);
 }
 goto L_bcde2;
 L_85c2a:
 $this->ensureKameraSchema();
 goto L_df0ff;
 L_92097:
 if (!in_array($_0xfafc->status, ["\x72\145\x71\165\x65\163\x74\145\x64", "\x61\143\x74\151\x76\145"]) || $_0xb2b5 > 8) {
 $_0x39d7 = $_0xfafc->status === "\x61\143\x74\151\x76\145" ? "\x61\143\x74\151\x76\145" : "\x72\145\x71\165\x65\163\x74\145\x64";
 $_0x13ed->table("\x63\142\x74\137\x6b\141\x6d\145\x72\141\x5f\163\x74\162\x65\141\x6d")->where("\x69\144\x5f\152\x61\144\x77\141\x6c", $_0x6bde)->where("\x69\144\x5f\163\x69\163\x77\141", $_0x3a43)->update(["\x73\164\x61\164\x75\163" => $_0x39d7, "\x75\160\x64\141\x74\145\x64\137\x61\164" => $_0x510a]);
 $_0xfafc->status = $_0x39d7;
 $_0xfafc->updated_at = $_0x510a;
 }
 goto L_fb7f2;
 L_f6805:
 $_0x6bde = $this->request->getVar("\x69\144\x5f\152\x61\144\x77\141\x6c");
 goto L_9e0c1;
 }
 public function stop_pantau()
 {
 goto L_d99b6;
 L_52668:
 if ($_0xe517 && $_0x5de9) {
 $_0xe4f8 = \Config\Database::connect();
 if ($_0xe4f8->tableExists("\x63\142\x74\137\x6b\141\x6d\145\x72\141\x5f\163\x74\162\x65\141\x6d")) {
 $_0xe4f8->table("\x63\142\x74\137\x6b\141\x6d\145\x72\141\x5f\163\x74\162\x65\141\x6d")->where("\x69\144\x5f\152\x61\144\x77\141\x6c", $_0xe517)->where("\x69\144\x5f\163\x69\163\x77\141", $_0x5de9)->update(["\x73\164\x61\164\x75\163" => "\x73\164\x61\156\x64\142\x79", "\x75\160\x64\141\x74\145\x64\137\x61\164" => date("\x59\55\x6d\55\x64\40\x48\72\x69\72\x73")]);
 }
 }
 goto L_04dce;
 L_d99b6:
 if (session_status() === PHP_SESSION_ACTIVE) {
 session_write_close();
 }
 goto L_4f376;
 L_04dce:
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => true]);
 L_4f376:
 $_0xe517 = $this->request->getVar("\x69\144\x5f\152\x61\144\x77\141\x6c");
 goto L_f9eca;
 L_f9eca:
 $_0x5de9 = $this->request->getVar("\x69\144\x5f\163\x69\163\x77\141");
 goto L_52668;
 }
 private function ensureKameraSchema()
 {
 try {
 $_0x7df1 = \Config\Database::connect();
 if (!$_0x7df1->fieldExists("\x6b\141\x6d\145\x72\141", "\x63\142\x74\137\x6a\141\x64\167\x61\154")) {
 $_0x34cc = \Config\Database::forge();
 $_0x34cc->addColumn("\x63\142\x74\137\x6a\141\x64\167\x61\154", ["\x6b\141\x6d\145\x72\141" => ["\x74\171\x70\145" => "\x49\116\x54", "\x63\157\x6e\163\x74\162\x61\151\x6e\164" => 11, "\x64\145\x66\141\x75\154\x74" => 0]]);
 }
 if (!$_0x7df1->tableExists("\x63\142\x74\137\x6b\141\x6d\145\x72\141\x5f\163\x74\162\x65\141\x6d")) {
 $_0x7df1->query("\x43\122\x45\101\x54\105\x20\124\x41\102\x4c\105\x20\111\x46\40\x4e\117\x54\40\x45\130\x49\123\x54\123\x20\143\x62\164\x5f\153\x61\155\x65\162\x61\137\x73\164\x72\145\x61\155\x20\50\xa\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\151\x64\40\x49\116\x54\40\x41\125\x54\117\x5f\111\x4e\103\x52\105\x4d\105\x4e\124\x20\120\x52\111\x4d\101\x52\131\x20\113\x45\131\x2c\12\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x69\144\x5f\152\x61\144\x77\141\x6c\40\x49\116\x54\40\x4e\117\x54\40\x4e\125\x4c\114\x2c\12\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x69\144\x5f\163\x69\163\x77\141\x20\111\x4e\124\x20\116\x4f\124\x20\116\x55\114\x4c\54\xa\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\163\x74\141\x74\165\x73\40\x56\101\x52\103\x48\101\x52\50\x32\60\x29\40\x44\105\x46\101\x55\114\x54\40\x27\163\x74\141\x6e\144\x62\171\x27\54\xa\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\163\x64\160\x5f\157\x66\146\x65\162\x20\114\x4f\116\x47\124\x45\130\x54\40\x4e\125\x4c\114\x2c\12\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x73\144\x70\137\x61\156\x73\167\x65\162\x20\114\x4f\116\x47\124\x45\130\x54\40\x4e\125\x4c\114\x2c\12\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x6c\141\x73\164\x5f\146\x72\141\x6d\145\x20\114\x4f\116\x47\124\x45\130\x54\40\x4e\125\x4c\114\x2c\12\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x75\160\x64\141\x74\145\x64\137\x61\164\x20\104\x41\124\x45\124\x49\115\x45\40\x4e\125\x4c\114\x2c\12\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x55\116\x49\121\x55\105\x20\113\x45\131\x20\165\x6e\151\x71\137\x6a\141\x64\167\x61\154\x5f\163\x69\163\x77\141\x20\50\x69\144\x5f\152\x61\144\x77\141\x6c\54\x20\151\x64\137\x73\151\x73\167\x61\51\xa\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\51\x20\105\x4e\107\x49\116\x45\75\x49\156\x6e\157\x44\102\x20\104\x45\106\x41\125\x4c\124\x20\103\x48\101\x52\123\x45\124\x3d\165\x74\146\x38\155\x62\64");
 }
 } catch (\Throwable $_0xccec) {
 }
 }
}