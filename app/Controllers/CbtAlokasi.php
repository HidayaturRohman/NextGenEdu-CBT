<?php
/*   ________________________________________
    |               NextGen Garuda CBT       |
    |    Protected & Distributed via GitHub  |
    |________________________________________|
*/
namespace App\Controllers;

use App\Models\CbtModel;
use App\Models\DashboardModel;
use App\Models\DropdownModel;
use App\Models\KelasModel;
class CbtAlokasi extends BaseController
{
 protected $cbt;
 protected $dashboard;
 protected $dropdown;
 protected $kelas;
 public function __construct()
 {
 goto L_62fec;
 L_62fec:
 $this->cbt = new CbtModel();
 goto L_b9a69;
 L_b9a69:
 $this->dashboard = new DashboardModel();
 goto L_6db44;
 L_6db44:
 $this->dropdown = new DropdownModel();
 goto L_0c3ce;
 L_0c3ce:
 $this->kelas = new KelasModel();
 }
 private function getDistinctTgl($_0x8a12, $_0x8e19, $_0x29fc)
 {
 goto L_de01d;
 L_dcb4c:
 $_0xa4f8->where("\x61\56\x69\144\x5f\152\x65\156\x69\163", $_0x29fc);
 goto L_a7344;
 L_0e378:
 $_0xa4f8 = $_0xc2c4->table("\x63\142\x74\137\x6a\141\x64\167\x61\154\x20\141");
 goto L_1c569;
 L_8c077:
 $_0xa4f8->select("\x61\56\x69\144\x5f\152\x65\156\x69\163\x2c\40\x61\56\x74\147\x6c\137\x6d\165\x6c\141\x69");
 goto L_dcb4c;
 L_55baa:
 $_0x71a0 = [];
 goto L_9b086;
 L_a7344:
 $_0xa4f8->where("\x61\56\x69\144\x5f\164\x70", $_0x8a12);
 goto L_14af7;
 L_de01d:
 $_0xc2c4 = \Config\Database::connect();
 goto L_0e378;
 L_be5c5:
 $_0xa4f8->orderBy("\x61\56\x74\147\x6c\137\x6d\165\x6c\141\x69", "\x41\123\x43");
 goto L_4b6f0;
 L_4b6f0:
 $_0x3ecc = $_0xa4f8->get()->getResult();
 goto L_55baa;
 L_de286:
 return $_0x71a0;
 L_14af7:
 $_0xa4f8->where("\x61\56\x69\144\x5f\163\x6d\164", $_0x8e19);
 goto L_be5c5;
 L_1c569:
 $_0xa4f8->distinct();
 goto L_8c077;
 L_9b086:
 if ($_0x3ecc) {
 foreach ($_0x3ecc as $_0xfa86 => $_0x62ea) {
 $_0x71a0[$_0x62ea->tgl_mulai] = date("\x64\40\x46\40\x59", strtotime($_0x62ea->tgl_mulai ?? ''));
 }
 }
 goto L_de286;
 }
 public function detail()
 {
 goto L_2b37b;
 L_d2eca:
 $_0x499b["\x73\155\x74\137\x61\143\x74\151\x76\145"] = $_0x3eef;
 goto L_c45b8;
 L_4ce53:
 if ($_0x964a) {
 return view("\x63\142\x74\57\x61\154\x6f\153\x61\163\x69\57\x64\141\x74\141\x5f\144\x65\164\x61\151\x6c", $_0x499b);
 }
 L_de741:
 $_0x499b["\x74\160"] = $this->dashboard->getTahun();
 goto L_688bf;
 L_688bf:
 $_0x499b["\x74\160\x5f\141\x63\164\x69\166\x65"] = $_0xc825;
 goto L_5091f;
 L_5091f:
 $_0x499b["\x73\155\x74"] = $this->dashboard->getSemester();
 goto L_d2eca;
 L_81a66:
 if ($_0x6c67 && count($_0x6c67) > 0) {
 foreach ($_0x6c67 as $_0xa2d8) {
 $_0x7c0f[] = $_0xa2d8->id_jenis;
 }
 }
 goto L_c680b;
 L_37ae3:
 $_0x7c0f = [];
 goto L_81a66;
 L_84441:
 $_0x1932 = $this->dashboard->getSetting();
 goto L_bce22;
 L_bce22:
 $_0x499b = ["\x75\163\x65\162" => $_0x276e, "\x6a\165\x64\165\x6c" => "\x41\154\x6f\153\x61\163\x69\40\x57\141\x6b\164\x75", "\x73\165\x62\152\x75\144\x75\154" => "\x41\154\x6f\153\x61\163\x69\40\x57\141\x6b\164\x75\40\x55\152\x69\141\x6e", "\x73\145\x74\164\x69\156\x67" => $_0x1932];
 goto L_a3e9e;
 L_93d98:
 $_0x964a = $_0x7180->get("\x72\157\x6c\145") == "\x31";
 goto L_0a430;
 L_2b37b:
 $_0x7180 = session();
 goto L_93d98;
 L_c45b8:
 $_0x6c67 = $this->cbt->getDistinctJenisJadwal($_0xc825->id_tp, $_0x3eef->id_smt);
 goto L_37ae3;
 L_0a430:
 $_0x276e = (object) ["\x69\144" => $_0x7180->get("\x69\144\x5f\165\x73\145\x72"), "\x66\151\x72\163\x74\137\x6e\141\x6d\145" => $_0x7180->get("\x75\163\x65\162\x6e\141\x6d\145"), "\x72\157\x6c\145\x5f\156\x61\155\x65" => $_0x7180->get("\x72\157\x6c\145\x5f\156\x61\155\x65"), "\x66\157\x74\157" => $_0x7180->get("\x66\157\x74\157") ?? ''];
 goto L_84441;
 L_a3e9e:
 $_0xc825 = $this->dashboard->getTahunActive();
 goto L_1a25f;
 L_1a25f:
 $_0x3eef = $this->dashboard->getSemesterActive();
 goto L_de741;
 L_c680b:
 if ($_0x7c0f && count($_0x7c0f) > 0) {
 $_0x499b["\x6a\145\x6e\151\x73"] = $this->cbt->getAllJenisUjianByArrJenis($_0x7c0f);
 } else {
 $_0x499b["\x6a\145\x6e\151\x73"] = ['' => "\x62\145\x6c\165\x6d\40\x61\144\x61\40\x6a\141\x64\167\x61\154\x20\165\x6a\151\x61\156"];
 }
 goto L_4ce53;
 }
 public function index()
 {
 goto L_9953b;
 L_56012:
 $_0x8cb2 = $this->cbt->getDistinctJenisJadwal($_0xd061->id_tp, $_0x62c5->id_smt);
 goto L_66032;
 L_f453b:
 if ($_0xc946 && count($_0xc946) > 0) {
 $_0x9bb5["\x6a\145\x6e\151\x73"] = $this->cbt->getAllJenisUjianByArrJenis($_0xc946);
 } else {
 $_0x9bb5["\x6a\145\x6e\151\x73"] = ['' => "\x62\145\x6c\165\x6d\40\x61\144\x61\40\x6a\141\x64\167\x61\154\x20\165\x6a\151\x61\156"];
 }
 goto L_9a28e;
 L_22f0b:
 $_0xdc11 = $this->dashboard->getSetting();
 goto L_3e2a4;
 L_31332:
 $_0x9bb5["\x6a\145\x6e\151\x73\137\x73\145\x6c\145\x63\164\x65\144"] = $_0x6e23;
 goto L_389ea;
 L_4a254:
 $_0x9bb5["\x73\155\x74"] = $this->dashboard->getSemester();
 goto L_cf8f5;
 L_05c73:
 $_0x2303 = $_0xca12->get("\x72\157\x6c\145") == "\x31";
 goto L_0e139;
 L_df4ea:
 $_0x9bb5["\x74\160"] = $this->dashboard->getTahun();
 goto L_954bf;
 L_0e139:
 $_0x9cfc = (object) ["\x69\144" => $_0xca12->get("\x69\144\x5f\165\x73\145\x72"), "\x66\151\x72\163\x74\137\x6e\141\x6d\145" => $_0xca12->get("\x75\163\x65\162\x6e\141\x6d\145"), "\x72\157\x6c\145\x5f\156\x61\155\x65" => $_0xca12->get("\x72\157\x6c\145\x5f\156\x61\155\x65"), "\x66\157\x74\157" => $_0xca12->get("\x66\157\x74\157") ?? ''];
 goto L_22f0b;
 L_15b8c:
 if ($_0x8cb2 && count($_0x8cb2) > 0) {
 foreach ($_0x8cb2 as $_0xf744) {
 $_0xc946[] = $_0xf744->id_jenis;
 }
 }
 goto L_f453b;
 L_9a28e:
 $_0x6e23 = $this->request->getGet("\x6a\145\x6e\151\x73");
 goto L_31332;
 L_87fff:
 if ($_0x2303) {
 $_0x408b = [];
 $_0xc88f = [];
 if ($_0x6e23) {
 $_0x408b = $this->cbt->getAllJadwalByTanggal($_0xd061->id_tp, $_0x62c5->id_smt, $_0x6e23);
 $_0xc88f = $this->cbt->getAllPengawas($_0xd061->id_tp, $_0x62c5->id_smt);
 }
 $_0x2318 = [];
 foreach ($_0x408b as $_0x24e0) {
 $_0x24e0->bank_kelas = $this->maybe_unserialize($_0x24e0->bank_kelas ?? []);
 foreach ($_0x24e0->bank_kelas as $_0xeb0f) {
 if (!in_array($_0xeb0f->kelas_id, $_0x2318)) {
 $_0x2318[] = $_0xeb0f->kelas_id;
 }
 }
 }
 $_0x3b55 = [];
 if (count($_0x2318) > 0) {
 $_0x33a2 = $this->cbt->getDistinctSesi($_0xd061->id_tp, $_0x62c5->id_smt, $_0x2318);
 foreach ($_0x33a2 as $_0x3194) {
 if (!isset($_0x3b55[$_0x3194->ruang_id])) {
 $_0x3b55[$_0x3194->ruang_id] = (object) ["\x72\165\x61\156\x67\137\x69\144" => $_0x3194->ruang_id, "\x6b\157\x64\145\x5f\162\x75\141\x6e\147" => $_0x3194->kode_ruang, "\x6e\141\x6d\141\x5f\162\x75\141\x6e\147" => $_0x3194->nama_ruang, "\x73\145\x73\151" => []];
 }
 $_0x3b55[$_0x3194->ruang_id]->sesi[$_0x3194->sesi_id] = (object) ["\x73\145\x73\151\x5f\151\x64" => $_0x3194->sesi_id, "\x6b\157\x64\145\x5f\163\x65\163\x69" => $_0x3194->kode_sesi, "\x6e\141\x6d\141\x5f\163\x65\163\x69" => $_0x3194->nama_sesi, "\x77\141\x6b\164\x75\137\x6d\165\x6c\141\x69" => $_0x3194->waktu_mulai, "\x77\141\x6b\164\x75\137\x61\153\x68\151\x72" => $_0x3194->waktu_akhir, "\x69\163\x74\151\x72\141\x68\141\x74" => $_0x3194->istirahat, "\x6b\145\x6c\141\x73\137\x69\144" => $_0x3194->kelas_id, "\x6e\141\x6d\141\x5f\153\x65\154\x61\163" => $_0x3194->nama_kelas, "\x70\145\x73\145\x72\164\x61" => $_0x3194->peserta];
 }
 }
 $_0x9bb5["\x73\145\x73\151\x73"] = array_values($_0x3b55);
 $_0x9bb5["\x6a\141\x64\167\x61\154\x73"] = $_0x408b;
 $_0x9bb5["\x70\145\x6e\147\x61\167\x61\163"] = $_0xc88f;
 $_0x9bb5["\x6b\145\x6c\141\x73"] = $this->dropdown->getAllKelas($_0xd061->id_tp, $_0x62c5->id_smt);
 $_0x9bb5["\x72\165\x61\156\x67"] = $this->dropdown->getAllRuang();
 $_0x9bb5["\x74\141\x6e\147\x67\141\x6c"] = $this->getDistinctTgl($_0xd061->id_tp, $_0x62c5->id_smt, $_0x6e23);
 return view("\x63\142\x74\57\x61\154\x6f\153\x61\163\x69\57\x64\141\x74\141", $_0x9bb5);
 } else {
 $_0xece8 = $this->dashboard->getDataGuruByUserId($_0x9cfc->id, $_0xd061->id_tp, $_0x62c5->id_smt);
 $_0x9bb5["\x67\165\x72\165"] = $_0xece8;
 $_0x4572 = $_0xece8 ? $_0xece8->id_guru : '';
 $_0x3aff = $_0x4572 ? $this->kelas->getGuruMapelKelas($_0x4572, $_0xd061->id_tp, $_0x62c5->id_smt) : null;
 $_0xa519 = $this->maybe_unserialize($_0x3aff->mapel_kelas ?? "\x5b\135");
 $_0x408b = [];
 $_0xc88f = [];
 if ($_0x6e23) {
 $_0x408b = $this->cbt->getAllJadwalByTanggal($_0xd061->id_tp, $_0x62c5->id_smt, $_0x6e23, $_0x4572);
 $_0xc88f = $this->cbt->getAllPengawas($_0xd061->id_tp, $_0x62c5->id_smt);
 }
 $_0x2318 = [];
 foreach ($_0x408b as $_0x24e0) {
 $_0x24e0->bank_kelas = $this->maybe_unserialize($_0x24e0->bank_kelas ?? []);
 foreach ($_0x24e0->bank_kelas as $_0xeb0f) {
 if (!in_array($_0xeb0f->kelas_id, $_0x2318)) {
 $_0x2318[] = $_0xeb0f->kelas_id;
 }
 }
 }
 $_0x3b55 = [];
 if (count($_0x2318) > 0) {
 $_0x33a2 = $this->cbt->getDistinctSesi($_0xd061->id_tp, $_0x62c5->id_smt, $_0x2318);
 foreach ($_0x33a2 as $_0x3194) {
 if (!isset($_0x3b55[$_0x3194->ruang_id])) {
 $_0x3b55[$_0x3194->ruang_id] = (object) ["\x72\165\x61\156\x67\137\x69\144" => $_0x3194->ruang_id, "\x6b\157\x64\145\x5f\162\x75\141\x6e\147" => $_0x3194->kode_ruang, "\x6e\141\x6d\141\x5f\162\x75\141\x6e\147" => $_0x3194->nama_ruang, "\x73\145\x73\151" => []];
 }
 $_0x3b55[$_0x3194->ruang_id]->sesi[$_0x3194->sesi_id] = (object) ["\x73\145\x73\151\x5f\151\x64" => $_0x3194->sesi_id, "\x6b\157\x64\145\x5f\163\x65\163\x69" => $_0x3194->kode_sesi, "\x6e\141\x6d\141\x5f\163\x65\163\x69" => $_0x3194->nama_sesi, "\x77\141\x6b\164\x75\137\x6d\165\x6c\141\x69" => $_0x3194->waktu_mulai, "\x77\141\x6b\164\x75\137\x61\153\x68\151\x72" => $_0x3194->waktu_akhir, "\x69\163\x74\151\x72\141\x68\141\x74" => $_0x3194->istirahat, "\x6b\145\x6c\141\x73\137\x69\144" => $_0x3194->kelas_id, "\x6e\141\x6d\141\x5f\153\x65\154\x61\163" => $_0x3194->nama_kelas, "\x70\145\x73\145\x72\164\x61" => $_0x3194->peserta];
 }
 }
 $_0x9bb5["\x73\145\x73\151\x73"] = array_values($_0x3b55);
 $_0x9bb5["\x6a\141\x64\167\x61\154\x73"] = $_0x408b;
 $_0x9bb5["\x70\145\x6e\147\x61\167\x61\163"] = $_0xc88f;
 $_0x9bb5["\x6b\145\x6c\141\x73"] = $this->dropdown->getAllKelas($_0xd061->id_tp, $_0x62c5->id_smt);
 $_0x9bb5["\x72\165\x61\156\x67"] = $this->dropdown->getAllRuang();
 $_0x9bb5["\x74\141\x6e\147\x67\141\x6c"] = $this->getDistinctTgl($_0xd061->id_tp, $_0x62c5->id_smt, $_0x6e23);
 return view("\x63\142\x74\57\x61\154\x6f\153\x61\163\x69\57\x64\141\x74\141", $_0x9bb5);
 }
 L_774d8:
 if (!in_array((string) $_0xca12->get("\x72\157\x6c\145"), ["\x31", "\x34"])) {
 return redirect()->to("\x63\142\x74\142\x61\156\x6b\163\x6f\141\x6c")->with("\x65\162\x72\157\x72", "\x41\153\x73\145\x73\40\x64\151\x74\157\x6c\141\x6b\72\x20\110\x61\156\x79\141\x20\101\x64\155\x69\156\x69\163\x74\162\x61\164\x6f\162\x2f\120\x72\157\x6b\164\x6f\162\x20\171\x61\156\x67\40\x62\145\x72\150\x61\153\x20\155\x65\156\x67\145\x6c\157\x6c\141\x20\101\x6c\157\x6b\141\x73\151\x20\127\x61\153\x74\165\x20\125\x6a\151\x61\156\x2e");
 }
 goto L_9435e;
 L_9435e:
 $_0xca12 = session();
 goto L_05c73;
 L_93025:
 if ($_0xdc11->jenjang == "\x31") {
 $_0x2281 = ["\x30" => "\x50\151\x6c\151\x68\40\x4c\145\x76\145\x6c", "\x31" => "\x31", "\x32" => "\x32", "\x33" => "\x33", "\x34" => "\x34", "\x35" => "\x35", "\x36" => "\x36"];
 } elseif ($_0xdc11->jenjang == "\x32") {
 $_0x2281 = ["\x30" => "\x50\151\x6c\151\x68\40\x4c\145\x76\145\x6c", "\x37" => "\x37", "\x38" => "\x38", "\x39" => "\x39"];
 } elseif ($_0xdc11->jenjang == "\x33") {
 $_0x2281 = ["\x30" => "\x50\151\x6c\151\x68\40\x4c\145\x76\145\x6c", "\x31\60" => "\x31\60", "\x31\61" => "\x31\61", "\x31\62" => "\x31\62"];
 }
 goto L_e0f71;
 L_69267:
 $_0xd061 = $this->dashboard->getTahunActive();
 goto L_2aef2;
 L_2aef2:
 $_0x62c5 = $this->dashboard->getSemesterActive();
 goto L_df4ea;
 L_e0f71:
 $_0x9bb5["\x6c\145\x76\145\x6c\163"] = $_0x2281;
 goto L_87fff;
 L_8499b:
 if (!$_0xca12->get("\x69\163\x5f\154\x6f\147\x69\156")) {
 return redirect()->to("\x61\165\x74\150\x2f\154\x6f\147\x69\156");
 }
 goto L_774d8;
 L_389ea:
 $_0x2281 = [];
 goto L_93025;
 L_cf8f5:
 $_0x9bb5["\x73\155\x74\137\x61\143\x74\151\x76\145"] = $_0x62c5;
 goto L_56012;
 L_3e2a4:
 $_0x9bb5 = ["\x75\163\x65\162" => $_0x9cfc, "\x6a\165\x64\165\x6c" => "\x41\154\x6f\153\x61\163\x69\40\x57\141\x6b\164\x75", "\x73\165\x62\152\x75\144\x75\154" => "\x41\154\x6f\153\x61\163\x69\40\x57\141\x6b\164\x75\40\x55\152\x69\141\x6e", "\x73\145\x74\164\x69\156\x67" => $_0xdc11];
 goto L_69267;
 L_954bf:
 $_0x9bb5["\x74\160\x5f\141\x63\164\x69\166\x65"] = $_0xd061;
 goto L_4a254;
 L_66032:
 $_0xc946 = [];
 goto L_15b8c;
 L_9953b:
 $_0xca12 = session();
 goto L_8499b;
 }
 public function get_tanggal()
 {
 goto L_01abc;
 L_01abc:
 $_0x41cb = $this->request->getGet("\x6a\145\x6e\151\x73");
 goto L_af184;
 L_af184:
 $_0x5c31 = $this->dashboard->getTahunActive();
 goto L_f8214;
 L_8c631:
 $_0x966a = $this->getDistinctTgl($_0x5c31->id_tp, $_0xaafb->id_smt, $_0x41cb);
 goto L_4c132;
 L_f8214:
 $_0xaafb = $this->dashboard->getSemesterActive();
 goto L_8c631;
 L_4c132:
 return $this->response->setJSON($_0x966a);
 }
 public function get_alokasi()
 {
 goto L_1c1df;
 L_04f9d:
 $_0x25ea = $_0xcf7d->get("\x72\157\x6c\145") == "\x31";
 goto L_0e1de;
 L_29b70:
 $_0xa336 = null;
 goto L_101e7;
 L_9ee39:
 $_0xe9d2 = $this->cbt->getAllPengawas($_0x3540->id_tp, $_0xb48d->id_smt);
 goto L_d4341;
 L_c628b:
 $_0x2457 = [];
 goto L_63568;
 L_63537:
 foreach ($_0xe9d2 as $_0xae1e) {
 $_0xb84c[$_0xae1e->id_jadwal][$_0xae1e->id_ruang][$_0xae1e->id_sesi] = $_0xae1e;
 }
 goto L_c628b;
 L_b7ec2:
 $_0xb48d = $this->dashboard->getSemesterActive();
 goto L_c81d0;
 L_dacf3:
 return $this->response->setJSON(["\x6a\141\x64\167\x61\154\x73\137\x75\152\x69\141\x6e" => $_0xffb2, "\x72\165\x61\156\x67\163" => $_0x12ff, "\x70\145\x6e\147\x61\167\x61\163" => $_0xb84c]);
 L_63568:
 foreach ($_0xffb2 as $_0xe568) {
 $_0xe568->bank_kelas = $this->maybe_unserialize($_0xe568->bank_kelas ?? []);
 $_0xd400 = [];
 foreach ($_0xe568->bank_kelas as $_0x9115) {
 if (!in_array($_0x9115->kelas_id, $_0x2457)) {
 $_0x2457[] = $_0x9115->kelas_id;
 }
 $_0xd400[] = (string) $_0x9115->kelas_id;
 }
 $_0xe568->bank_kelas = $_0xd400;
 }
 goto L_8cf48;
 L_7fedd:
 $_0xffb2 = $this->cbt->getAllJadwalByTanggal($_0x3540->id_tp, $_0xb48d->id_smt, $_0x9df3, $_0xa336, $_0x3a38);
 goto L_9ee39;
 L_101e7:
 if (!$_0x25ea) {
 $_0x64d4 = $this->dashboard->getDataGuruByUserId($_0xcbce, $_0x3540->id_tp, $_0xb48d->id_smt);
 $_0xa336 = $_0x64d4 ? $_0x64d4->id_guru : '';
 }
 goto L_7fedd;
 L_d4341:
 $_0xb84c = [];
 goto L_63537;
 L_1c1df:
 $_0x9df3 = $this->request->getPost("\x6a\145\x6e\151\x73");
 goto L_ef684;
 L_0e1de:
 $_0xcbce = $_0xcf7d->get("\x69\144\x5f\165\x73\145\x72");
 goto L_29b70;
 L_ef684:
 $_0x3a38 = $this->request->getPost("\x74\141\x6e\147\x67\141\x6c");
 goto L_7e469;
 L_c81d0:
 $_0xcf7d = session();
 goto L_04f9d;
 L_7e469:
 $_0x3540 = $this->dashboard->getTahunActive();
 goto L_b7ec2;
 L_995d8:
 if (count($_0x2457) > 0) {
 $_0x12ff = $this->cbt->getDistinctSesi($_0x3540->id_tp, $_0xb48d->id_smt, $_0x2457);
 }
 goto L_dacf3;
 L_8cf48:
 $_0x12ff = [];
 goto L_995d8;
 }
 public function saveAlokasi()
 {
 $_0x50a5 = $this->request->getPost("\x61\154\x6f\153\x61\163\x69");
 if ($_0x50a5) {
 $_0xcbed = json_decode($_0x50a5, true);
 $_0x6dfe = \Config\Database::connect();
 $_0x990c = $_0x6dfe->table("\x63\142\x74\137\x70\145\x6e\147\x61\167\x61\163");
 $_0x7350 = $_0x6dfe->table("\x63\142\x74\137\x6a\141\x64\167\x61\154");
 $_0xedb0 = [];
 foreach ($_0xcbed as $_0x8cc7) {
 $_0x2df8 = $_0x8cc7["\x69\144\x5f\160\x65\156\x67\141\x77\141\x73"];
 $_0x1f4d = $_0x990c->where("\x69\144\x5f\160\x65\156\x67\141\x77\141\x73", $_0x2df8)->get()->getNumRows();
 if ($_0x1f4d > 0) {
 $_0x990c->where("\x69\144\x5f\160\x65\156\x67\141\x77\141\x73", $_0x2df8)->update($_0x8cc7);
 } else {
 $_0x990c->insert($_0x8cc7);
 }
 if (!in_array($_0x8cc7["\x69\144\x5f\152\x61\144\x77\141\x6c"], $_0xedb0)) {
 $_0x7350->where("\x69\144\x5f\152\x61\144\x77\141\x6c", $_0x8cc7["\x69\144\x5f\152\x61\144\x77\141\x6c"])->update(["\x6a\141\x6d\137\x6b\145" => $_0x8cc7["\x6a\141\x6d\137\x6b\145"]]);
 $_0xedb0[] = $_0x8cc7["\x69\144\x5f\152\x61\144\x77\141\x6c"];
 }
 }
 echo json_encode(["\x73\164\x61\164\x75\163" => true, "\x6d\163\x67" => count($_0xedb0) . "\x20\101\x6c\157\x6b\141\x73\151\x20\167\x61\153\x74\165\x20\152\x61\144\x77\141\x6c\40\x62\145\x72\150\x61\163\x69\154\x20\144\x69\163\x69\155\x70\141\x6e"]);
 } else {
 echo json_encode(["\x73\164\x61\164\x75\163" => false, "\x6d\163\x67" => "\x54\151\x64\141\x6b\40\x61\144\x61\40\x64\141\x74\141\x20\171\x61\156\x67\40\x64\151\x73\151\x6d\160\x61\156"]);
 }
 }
}