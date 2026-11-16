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
class CbtPengawas extends BaseController
{
 protected $cbt;
 protected $dashboard;
 protected $dropdown;
 public function __construct()
 {
 goto L_d4079;
 L_e6d1b:
 $this->dashboard = new DashboardModel();
 goto L_e3f7b;
 L_e3f7b:
 $this->dropdown = new DropdownModel();
 L_d4079:
 $this->cbt = new CbtModel();
 goto L_e6d1b;
 }
 private function getDistinctTgl($_0x8a12, $_0x8e19, $_0x29fc)
 {
 goto L_caead;
 L_229e1:
 $_0xa4f8->where("\x61\56\x69\144\x5f\163\x6d\164", $_0x8e19);
 goto L_4ca13;
 L_e46e0:
 $_0xa4f8->where("\x61\56\x69\144\x5f\152\x65\156\x69\163", $_0x29fc);
 goto L_3ba79;
 L_4ca13:
 $_0xa4f8->orderBy("\x61\56\x74\147\x6c\137\x6d\165\x6c\141\x69", "\x41\123\x43");
 goto L_7b3e1;
 L_ae4fd:
 $_0x6a73 = [];
 goto L_62b37;
 L_1ee8c:
 $_0xa4f8->select("\x61\56\x69\144\x5f\152\x65\156\x69\163\x2c\40\x61\56\x74\147\x6c\137\x6d\165\x6c\141\x69");
 goto L_e46e0;
 L_e6e5b:
 $_0xa4f8 = $_0xb5c3->table("\x63\142\x74\137\x6a\141\x64\167\x61\154\x20\141");
 goto L_01c01;
 L_caead:
 $_0xb5c3 = \Config\Database::connect();
 goto L_e6e5b;
 L_f0122:
 return $_0x6a73;
 L_3ba79:
 $_0xa4f8->where("\x61\56\x69\144\x5f\164\x70", $_0x8a12);
 goto L_229e1;
 L_7b3e1:
 $_0x3ecc = $_0xa4f8->get()->getResult();
 goto L_ae4fd;
 L_62b37:
 if ($_0x3ecc) {
 foreach ($_0x3ecc as $_0xfa86 => $_0x62ea) {
 $_0x6a73[$_0x62ea->tgl_mulai] = date("\x64\40\x46\40\x59", strtotime($_0x62ea->tgl_mulai ?? ''));
 }
 }
 goto L_f0122;
 L_01c01:
 $_0xa4f8->distinct();
 goto L_1ee8c;
 }
 public function index()
 {
 goto L_644fb;
 L_644fb:
 $_0x3012 = session();
 goto L_c7046;
 L_dde76:
 $_0x2991["\x67\165\x72\165\x73"] = $this->dropdown->getAllGuru();
 goto L_25596;
 L_25596:
 $_0x8269 = $this->cbt->getDistinctJenisJadwal($_0xc825->id_tp, $_0xa7e6->id_smt);
 goto L_54247;
 L_38008:
 $_0x687b = $this->dropdown->getAllKelas($_0xc825->id_tp, $_0xa7e6->id_smt);
 goto L_a38a5;
 L_079bb:
 $_0xa7e6 = $this->dashboard->getSemesterActive();
 goto L_5cd19;
 L_934bb:
 $_0x803b = $this->dashboard->getSetting();
 goto L_78dc6;
 L_6f23f:
 if ($_0x8269 && count($_0x8269) > 0) {
 foreach ($_0x8269 as $_0x4cd6) {
 $_0x9201[] = $_0x4cd6->id_jenis;
 }
 }
 goto L_b5b58;
 L_f6144:
 $_0xb7d1 = (object) ["\x69\144" => $_0x3012->get("\x69\144\x5f\165\x73\145\x72"), "\x66\151\x72\163\x74\137\x6e\141\x6d\145" => $_0x3012->get("\x75\163\x65\162\x6e\141\x6d\145"), "\x72\157\x6c\145\x5f\156\x61\155\x65" => $_0x3012->get("\x72\157\x6c\145\x5f\156\x61\155\x65"), "\x66\157\x74\157" => $_0x3012->get("\x66\157\x74\157") ?? ''];
 goto L_934bb;
 L_54247:
 $_0x9201 = [];
 goto L_6f23f;
 L_b5b58:
 if ($_0x9201 && count($_0x9201) > 0) {
 $_0x2991["\x6a\145\x6e\151\x73"] = $this->cbt->getAllJenisUjianByArrJenis($_0x9201);
 } else {
 $_0x2991["\x6a\145\x6e\151\x73"] = ['' => "\x62\145\x6c\165\x6d\40\x61\144\x61\40\x6a\141\x64\167\x61\154\x20\165\x6a\151\x61\156"];
 }
 goto L_5dc89;
 L_11ca3:
 $_0x2991["\x74\160\x5f\141\x63\164\x69\166\x65"] = $_0xc825;
 goto L_8fc96;
 L_78dc6:
 $_0x2991 = ["\x75\163\x65\162" => $_0xb7d1, "\x6a\165\x64\165\x6c" => "\x41\164\x75\162\x20\120\x65\156\x67\141\x77\141\x73", "\x73\165\x62\152\x75\144\x75\154" => "\x50\145\x6e\147\x61\167\x61\163\x20\125\x6a\151\x61\156\x2f\125\x6c\141\x6e\147\x61\156", "\x73\145\x74\164\x69\156\x67" => $_0x803b];
 goto L_c9d75;
 L_8fc96:
 $_0x2991["\x73\155\x74"] = $this->dashboard->getSemester();
 goto L_22577;
 L_5cd19:
 $_0x2991["\x74\160"] = $this->dashboard->getTahun();
 goto L_11ca3;
 L_5dc89:
 return view("\x63\142\x74\57\x70\145\x6e\147\x61\167\x61\163\x2f\144\x61\164\x61", $_0x2991);
 L_c9d75:
 $_0xc825 = $this->dashboard->getTahunActive();
 goto L_079bb;
 L_c7046:
 $_0x9891 = $_0x3012->get("\x72\157\x6c\145") == "\x31";
 goto L_f6144;
 L_a38a5:
 $_0x2991["\x6b\145\x6c\141\x73"] = $_0x687b;
 goto L_dde76;
 L_22577:
 $_0x2991["\x73\155\x74\137\x61\143\x74\151\x76\145"] = $_0xa7e6;
 goto L_38008;
 }
 public function get_tanggal()
 {
 goto L_27e2d;
 L_ba1ac:
 return $this->response->setJSON($_0x2330);
 L_bfe42:
 $_0x7a01 = $this->dashboard->getTahunActive();
 goto L_4bfd8;
 L_68c9f:
 $_0x2330 = $this->getDistinctTgl($_0x7a01->id_tp, $_0xfbcc->id_smt, $_0x1791);
 goto L_ba1ac;
 L_4bfd8:
 $_0xfbcc = $this->dashboard->getSemesterActive();
 goto L_68c9f;
 L_27e2d:
 $_0x1791 = json_decode($this->request->getGet("\x6a\145\x6e\151\x73"));
 goto L_bfe42;
 }
 public function get_pengawas()
 {
 goto L_b9ac7;
 L_9e934:
 $_0x5d17["\x6b\145\x6c\141\x73\145\x73"] = $this->dropdown->getAllKelas($_0x7d6c->id_tp, $_0xfca1->id_smt);
 goto L_523bc;
 L_7d4f2:
 $_0x3eb2->join("\x63\142\x74\137\x72\165\x61\156\x67\40\x72", "\x72\56\x69\144\x5f\162\x75\141\x6e\147\x20\75\x20\141\x2e\162\x75\141\x6e\147\x5f\151\x64", "\x6c\145\x66\164");
 goto L_795f3;
 L_ace10:
 $_0x3eb2 = $_0x992d->table("\x63\142\x74\137\x6a\141\x64\167\x61\154\x20\141");
 goto L_f5da4;
 L_e51c2:
 $_0x5d17["\x70\145\x6e\147\x61\167\x61\163"] = $this->cbt->getAllPengawas($_0x7d6c->id_tp, $_0xfca1->id_smt, null, null);
 goto L_bf709;
 L_4f05f:
 $_0x5d17["\x6a\141\x64\167\x61\154\x73\137\x75\152\x69\141\x6e"] = $_0x4b32;
 goto L_ffd42;
 L_bf709:
 $_0x5d17["\x67\165\x72\165\x73"] = $this->dropdown->getAllGuru();
 goto L_9e934;
 L_50b51:
 $_0x5ebb = [];
 goto L_085d6;
 L_6b887:
 $_0x3eb2 = $_0x992d->table("\x63\142\x74\137\x73\145\x73\151\x5f\163\x69\163\x77\141\x20\141");
 goto L_735c7;
 L_2226a:
 $_0x3eb2->join("\x6d\141\x73\164\x65\162\x5f\153\x65\154\x61\163\x20\153", "\x6b\56\x69\144\x5f\153\x65\154\x61\163\x20\75\x20\103\x4f\101\x4c\105\x53\103\x45\50\x4e\125\x4c\114\x49\106\x28\141\x2e\153\x65\154\x61\163\x5f\151\x64\54\x20\60\x29\54\x20\153\x73\56\x69\144\x5f\153\x65\154\x61\163\x29", "\x6c\145\x66\164");
 goto L_7d4f2;
 L_85354:
 $_0x5d17["\x61\162\x72\137\x6b\145\x6c\141\x73"] = $_0x1bf6;
 goto L_4f05f;
 L_795f3:
 $_0x3eb2->join("\x63\142\x74\137\x73\145\x73\151\x20\163\x65", "\x73\145\x2e\151\x64\137\x73\145\x73\151\x20\75\x20\141\x2e\163\x65\163\x69\137\x69\144", "\x6c\145\x66\164");
 goto L_acf19;
 L_a93b8:
 $_0xada0 = $_0x3eb2->get()->getResultArray();
 goto L_97da4;
 L_196a5:
 $_0x3eb2->join("\x6b\145\x6c\141\x73\137\x73\151\x73\167\x61\40\x6b\163", "\x6b\163\x2e\151\x64\137\x73\151\x73\167\x61\40\x3d\40\x61\56\x73\151\x73\167\x61\137\x69\144\x20\101\x4e\104\x20\153\x73\56\x69\144\x5f\164\x70\40\x3d\40\x61\56\x74\160\x5f\151\x64\40\x41\116\x44\40\x6b\163\x2e\151\x64\137\x73\155\x74\40\x3d\40\x61\56\x73\155\x74\137\x69\144", "\x6c\145\x66\164");
 goto L_2226a;
 L_2a4be:
 $_0x1bf6 = [];
 goto L_c2985;
 L_4e6ee:
 $_0x3eb2->where("\x61\56\x73\155\x74\137\x69\144", $_0xfca1->id_smt);
 goto L_a93b8;
 L_735c7:
 $_0x3eb2->select("\x61\56\x2a\54\x20\163\x2e\151\x64\137\x73\151\x73\167\x61\54\x20\163\x2e\156\x61\155\x61\54\x20\163\x2e\156\x69\163\x2c\40\x73\56\x6e\151\x73\156\x2c\40\x73\56\x61\147\x61\155\x61\54\x20\153\x2e\153\x6f\144\x65\137\x6b\145\x6c\141\x73\54\x20\153\x2e\156\x61\155\x61\137\x6b\145\x6c\141\x73\54\x20\162\x2e\153\x6f\144\x65\137\x72\165\x61\156\x67\54\x20\162\x2e\156\x61\155\x61\137\x72\165\x61\156\x67\54\x20\163\x65\56\x6b\157\x64\145\x5f\163\x65\163\x69\54\x20\163\x65\56\x6e\141\x6d\141\x5f\163\x65\163\x69");
 goto L_b83fd;
 L_ba823:
 $_0x3eb2->where("\x61\56\x74\160\x5f\151\x64", $_0x7d6c->id_tp);
 goto L_4e6ee;
 L_7ca92:
 $_0x3eb2->where("\x61\56\x69\144\x5f\152\x65\156\x69\163", $_0x9e5b);
 goto L_c664c;
 L_ab7cd:
 $_0x3eb2->join("\x63\142\x74\137\x62\141\x6e\153\x5f\163\x6f\141\x6c\40\x62", "\x62\56\x69\144\x5f\142\x61\156\x6b\40\x3d\40\x61\56\x69\144\x5f\142\x61\156\x6b", "\x6c\145\x66\164");
 goto L_50d18;
 L_a7ab4:
 $_0xfca1 = $this->dashboard->getSemesterActive();
 goto L_e8456;
 L_c2985:
 $_0x4b32 = [];
 goto L_91e6e;
 L_d4cc3:
 $_0x5d17["\x72\165\x61\156\x67\163"] = array_values($_0x2374);
 goto L_85354;
 L_bdcba:
 foreach ($_0xada0 as $_0xd935) {
 if (!in_array($_0xd935["\x73\151\x73\167\x61\137\x69\144"], $_0xbba8)) {
 $_0xbba8[] = $_0xd935["\x73\151\x73\167\x61\137\x69\144"];
 }
 // Compatibility
 $_0xd935["\x73\151\x73\167\x61"] = ["\x69\144\x5f\163\x69\163\x77\141" => $_0xd935["\x69\144\x5f\163\x69\163\x77\141"], "\x6e\141\x6d\141" => $_0xd935["\x6e\141\x6d\141"], "\x6e\151\x73" => $_0xd935["\x6e\151\x73"], "\x6e\151\x73\156" => $_0xd935["\x6e\151\x73\156"], "\x61\147\x61\155\x61" => $_0xd935["\x61\147\x61\155\x61"]];
 $_0xd935["\x6b\145\x6c\141\x73"] = ["\x6b\157\x64\145\x5f\153\x65\154\x61\163" => $_0xd935["\x6b\157\x64\145\x5f\153\x65\154\x61\163"], "\x6e\141\x6d\141\x5f\153\x65\154\x61\163" => $_0xd935["\x6e\141\x6d\141\x5f\153\x65\154\x61\163"]];
 $_0xd935["\x72\165\x61\156\x67"] = ["\x6b\157\x64\145\x5f\162\x75\141\x6e\147" => $_0xd935["\x6b\157\x64\145\x5f\162\x75\141\x6e\147"], "\x6e\141\x6d\141\x5f\162\x75\141\x6e\147" => $_0xd935["\x6e\141\x6d\141\x5f\162\x75\141\x6e\147"]];
 $_0xd935["\x73\145\x73\151"] = ["\x6b\157\x64\145\x5f\163\x65\163\x69" => $_0xd935["\x6b\157\x64\145\x5f\163\x65\163\x69"], "\x6e\141\x6d\141\x5f\163\x65\163\x69" => $_0xd935["\x6e\141\x6d\141\x5f\163\x65\163\x69"]];
 $_0xa6c5[] = $_0xd935;
 }
 goto L_24555;
 L_50d18:
 $_0x3eb2->join("\x6d\141\x73\164\x65\162\x5f\155\x61\160\x65\154\x20\155", "\x6d\56\x69\144\x5f\155\x61\160\x65\154\x20\75\x20\142\x2e\142\x61\156\x6b\137\x6d\141\x70\145\x6c\137\x69\144", "\x6c\145\x66\164");
 goto L_aad6d;
 L_67721:
 if (!$_0x184a) {
 $_0x5d17["\x73\145\x73\151\x73\151\x73\167\x61"] = $_0xa6c5;
 $_0x5d17["\x63\142\x74\163\x69\163\x77\141"] = [];
 $_0x5d17["\x72\165\x61\156\x67\163"] = array_values($_0x2374);
 $_0x5d17["\x61\162\x72\137\x6b\145\x6c\141\x73"] = $_0x1bf6;
 $_0x5d17["\x6a\141\x64\167\x61\154\x73\137\x75\152\x69\141\x6e"] = $_0x4b32;
 return $this->response->setJSON($_0x5d17);
 }
 goto L_a450e;
 L_a425f:
 $_0x184a = $_0x3eb2->get()->getResult();
 goto L_67721;
 L_a450e:
 // Add jadwal info back for compatibility
 foreach ($_0x184a as $_0xc459) {
 $_0xc459->jadwal = new \stdClass();
 // mock if needed
 }
 goto L_4a66e;
 L_ffd42:
 return $this->response->setJSON($_0x5d17);
 L_57fc6:
 $_0x3eb2->where("\x61\56\x69\144\x5f\163\x6d\164", $_0xfca1->id_smt);
 goto L_899f3;
 L_acf19:
 if (count($_0x1bf6) > 0) {
 $_0x3eb2->whereIn("\x43\117\x41\114\x45\123\x43\105\x28\116\x55\114\x4c\111\x46\50\x61\56\x6b\145\x6c\141\x73\137\x69\144\x2c\40\x30\51\x2c\40\x6b\163\x2e\151\x64\137\x6b\145\x6c\141\x73\51", $_0x1bf6);
 }
 goto L_ba823;
 L_e9951:
 foreach ($_0x2374 as $_0x1a61) {
 $_0xef11[] = $_0x1a61;
 }
 goto L_6b887;
 L_523bc:
 if (!$_0xe1c4) {
 $_0x5d17["\x73\145\x73\151\x73\151\x73\167\x61"] = $_0xa6c5;
 $_0x5d17["\x63\142\x74\163\x69\163\x77\141"] = $_0x64dd;
 $_0x5d17["\x72\165\x61\156\x67\163"] = [];
 $_0x5d17["\x61\162\x72\137\x6b\145\x6c\141\x73"] = $_0x1bf6;
 $_0x5d17["\x6a\141\x64\167\x61\154\x73\137\x75\152\x69\141\x6e"] = $_0x4b32;
 return $this->response->setJSON($_0x5d17);
 }
 goto L_50b51;
 L_7c291:
 if (count($_0xbba8) > 0) {
 $_0x3eb2->whereIn("\x69\144\x5f\163\x69\163\x77\141", $_0xbba8);
 }
 goto L_c192c;
 L_97da4:
 if (!$_0xada0) {
 $_0x5d17["\x73\145\x73\151\x73\151\x73\167\x61"] = $_0xa6c5;
 $_0x5d17["\x63\142\x74\163\x69\163\x77\141"] = $_0x64dd;
 $_0x5d17["\x72\165\x61\156\x67\163"] = array_values($_0x2374);
 $_0x5d17["\x61\162\x72\137\x6b\145\x6c\141\x73"] = $_0x1bf6;
 $_0x5d17["\x6a\141\x64\167\x61\154\x73\137\x75\152\x69\141\x6e"] = $_0x4b32;
 return $this->response->setJSON($_0x5d17);
 }
 goto L_36bc5;
 L_c664c:
 $_0xe1c4 = $_0x3eb2->get()->getResult();
 goto L_2a4be;
 L_aad6d:
 $_0x3eb2->where("\x61\56\x69\144\x5f\164\x70", $_0x7d6c->id_tp);
 goto L_57fc6;
 L_e8456:
 $_0x992d = \Config\Database::connect();
 goto L_ace10;
 L_c192c:
 if (count($_0x5ebb) > 0) {
 $_0x3eb2->whereIn("\x69\144\x5f\152\x61\144\x77\141\x6c", $_0x5ebb);
 }
 goto L_a425f;
 L_ea24c:
 $_0x64dd = [];
 goto L_a6ce4;
 L_41f30:
 $_0x3eb2->select("\x69\144\x5f\142\x61\156\x6b\54\x69\144\x5f\143\x62\164\x5f\163\x69\163\x77\141\x2c\151\x64\137\x6a\141\x64\167\x61\154\x2c\151\x64\137\x73\151\x73\167\x61\54\x6c\141\x6d\141\x5f\165\x6a\151\x61\156\x2c\155\x75\154\x61\151\x2c\162\x65\163\x65\164\x5f\151\x7a\151\x6e\54\x72\145\x73\145\x74\137\x77\141\x6b\164\x75\54\x73\145\x6c\145\x73\141\x69\54\x73\164\x61\164\x75\163");
 goto L_7c291;
 L_a6ce4:
 $_0x5d17["\x74\157\x64\141\x79"] = date("\x59\55\x6d\55\x64");
 goto L_e51c2;
 L_b83fd:
 $_0x3eb2->join("\x6d\141\x73\164\x65\162\x5f\163\x69\163\x77\141\x20\163", "\x73\56\x69\144\x5f\163\x69\163\x77\141\x20\75\x20\141\x2e\163\x69\163\x77\141\x5f\151\x64", "\x6c\145\x66\164");
 goto L_196a5;
 L_b9ac7:
 $_0x9e5b = $this->request->getPost("\x6a\145\x6e\151\x73");
 goto L_0e9a0;
 L_24555:
 $_0x3eb2 = $_0x992d->table("\x63\142\x74\137\x73\151\x73\167\x61");
 goto L_41f30;
 L_0e9a0:
 $_0xe752 = $this->request->getPost("\x74\141\x6e\147\x67\141\x6c");
 goto L_63627;
 L_4a66e:
 $_0x5d17["\x73\145\x73\151\x73\151\x73\167\x61"] = $_0xa6c5;
 goto L_2b841;
 L_15f0d:
 $_0x2374 = $this->cbt->getDistinctSesi($_0x7d6c->id_tp, $_0xfca1->id_smt, $_0x1bf6);
 goto L_4e158;
 L_2b841:
 $_0x5d17["\x63\142\x74\163\x69\163\x77\141"] = (array) $_0x184a;
 goto L_d4cc3;
 L_4e158:
 $_0xef11 = [];
 goto L_e9951;
 L_085d6:
 foreach ($_0xe1c4 as $_0x500a) {
 $_0x5ebb[] = $_0x500a->id_jadwal;
 $_0x7a35 = $this->maybe_unserialize($_0x500a->bank_kelas);
 $_0x500a->bank_kelas = [];
 if ($_0x7a35) {
 foreach ($_0x7a35 as $_0x92ce) {
 $_0xafbf = (array) $_0x92ce;
 if (isset($_0xafbf["\x6b\145\x6c\141\x73\137\x69\144"])) {
 $_0x500a->bank_kelas[] = strval($_0xafbf["\x6b\145\x6c\141\x73\137\x69\144"]);
 if ($_0xafbf["\x6b\145\x6c\141\x73\137\x69\144"]) {
 $_0x1bf6[] = $_0xafbf["\x6b\145\x6c\141\x73\137\x69\144"];
 }
 }
 }
 }
 $_0x4b32[] = $_0x500a;
 }
 goto L_15f0d;
 L_f5da4:
 $_0x3eb2->select("\x61\56\x69\144\x5f\152\x61\144\x77\141\x6c\54\x20\141\x2e\151\x64\137\x74\160\x2c\40\x61\56\x69\144\x5f\163\x6d\164\x2c\40\x61\56\x69\144\x5f\142\x61\156\x6b\54\x20\141\x2e\151\x64\137\x6a\145\x6e\151\x73\54\x20\141\x2e\164\x67\154\x5f\155\x75\154\x61\151\x2c\40\x61\56\x74\147\x6c\137\x73\145\x6c\145\x73\141\x69\54\x20\141\x2e\163\x74\141\x74\165\x73\54\x20\141\x2e\152\x61\155\x5f\153\x65\54\x20" . "\x62\56\x62\141\x6e\153\x5f\153\x6f\144\x65\54\x20\142\x2e\142\x61\156\x6b\137\x6b\145\x6c\141\x73\54\x20\142\x2e\163\x6f\141\x6c\137\x61\147\x61\155\x61\54\x20\142\x2e\142\x61\156\x6b\137\x67\165\x72\165\x5f\151\x64\54\x20" . "\x6d\56\x6b\157\x64\145\x2c\40\x6d\56\x6e\141\x6d\141\x5f\155\x61\160\x65\154");
 goto L_ab7cd;
 L_91e6e:
 $_0xa6c5 = [];
 goto L_ea24c;
 L_63627:
 $_0x7d6c = $this->dashboard->getTahunActive();
 goto L_a7ab4;
 L_899f3:
 $_0x3eb2->where("\x61\56\x74\147\x6c\137\x6d\165\x6c\141\x69", $_0xe752);
 goto L_7ca92;
 L_36bc5:
 $_0xbba8 = [];
 goto L_bdcba;
 }
 public function savePengawas()
 {
 goto L_c8337;
 L_0e61c:
 if (count($_0x416d) > 0) {
 $_0xef97->insertBatch($_0x416d);
 $_0x9b03 += count($_0x416d);
 }
 goto L_919c3;
 L_f597e:
 $_0x9b03 = 0;
 goto L_0e61c;
 L_b91fb:
 $_0x416d = [];
 goto L_361b9;
 L_1420f:
 $_0x92ba = $_0xc38a->id_smt;
 goto L_e3de8;
 L_46e74:
 $_0xc38a = $this->dashboard->getSemesterActive();
 goto L_c2165;
 L_361b9:
 $_0x5b0f = [];
 goto L_dc309;
 L_919c3:
 if (count($_0x5b0f) > 0) {
 $_0xef97->updateBatch($_0x5b0f, "\x69\144\x5f\160\x65\156\x67\141\x77\141\x73");
 $_0x9b03 += count($_0x5b0f);
 }
 goto L_0b435;
 L_6fc20:
 $_0x322d = $this->dashboard->getTahunActive();
 goto L_46e74;
 L_60137:
 $_0xa49e["\x73\164\x61\164\x75\163"] = $_0x9b03;
 goto L_79fa4;
 L_dc309:
 foreach ($_0xd22e as $_0x78d3) {
 if (isset($_0x78d3->jadwal)) {
 $_0xec88 = $_0x78d3->ruang;
 $_0x28ac = $_0x78d3->sesi;
 $_0x305b = $_0x78d3->jadwal;
 $_0x34e3 = $_0x1ee6 . $_0x92ba . $_0x305b . $_0xec88 . $_0x28ac;
 $_0x98f9 = ["\x69\144\x5f\160\x65\156\x67\141\x77\141\x73" => $_0x34e3, "\x69\144\x5f\152\x61\144\x77\141\x6c" => $_0x305b, "\x69\144\x5f\164\x70" => $_0x1ee6, "\x69\144\x5f\163\x6d\164" => $_0x92ba, "\x69\144\x5f\162\x75\141\x6e\147" => $_0xec88, "\x69\144\x5f\163\x65\163\x69" => $_0x28ac, "\x69\144\x5f\147\x75\162\x75" => implode("\x2c", $_0x78d3->guru)];
 if ($_0xef97->where("\x69\144\x5f\160\x65\156\x67\141\x77\141\x73", $_0x34e3)->countAllResults() > 0) {
 $_0x5b0f[] = $_0x98f9;
 } else {
 $_0x416d[] = $_0x98f9;
 }
 }
 }
 goto L_f597e;
 L_968bf:
 $_0xa49e["\x75\160\x64\141\x74\145"] = $_0x5b0f;
 goto L_60137;
 L_c8337:
 $_0xd22e = json_decode($this->request->getPost("\x64\141\x74\141"));
 goto L_6fc20;
 L_0b435:
 $_0xa49e["\x69\156\x73\145\x72\164"] = $_0x416d;
 goto L_968bf;
 L_79fa4:
 return $this->response->setJSON($_0xa49e);
 L_e3de8:
 $_0x83f0 = \Config\Database::connect();
 goto L_f5bd2;
 L_c2165:
 $_0x1ee6 = $_0x322d->id_tp;
 goto L_1420f;
 L_f5bd2:
 $_0xef97 = $_0x83f0->table("\x63\142\x74\137\x70\145\x6e\147\x61\167\x61\163");
 goto L_b91fb;
 }
}