<?php
/*   ________________________________________
    |               NextGen Garuda CBT       |
    |    Protected & Distributed via GitHub  |
    |________________________________________|
*/
namespace App\Controllers;

class Guru extends BaseController
{
 public function __construct()
 {
 }
 /**
 * Ambil pengumuman/post untuk guru
 */
 public function getpost()
 {
 goto L_cfce0;
 L_6b0e9:
 $_0x3df1 = $_0xb2ae->table("\x70\157\x73\164\x20\141");
 goto L_13a5a;
 L_57495:
 $_0x8898 = rtrim(base_url(), "\x2f") . "\x2f";
 goto L_6163a;
 L_13a5a:
 $_0x3df1->select("\x61\56\x2a\54\x20\142\x2e\156\x61\155\x61\137\x67\165\x72\165\x2c\40\x62\56\x66\157\x74\157\x2c\40\x28\123\x45\114\x45\103\x54\40\x43\117\x55\116\x54\50\x70\157\x73\164\x5f\143\x6f\155\x6d\145\x6e\164\x73\56\x69\144\x5f\143\x6f\155\x6d\145\x6e\164\x29\40\x46\122\x4f\115\x20\160\x6f\163\x74\137\x63\157\x6d\155\x65\156\x74\163\x20\127\x48\105\x52\105\x20\141\x2e\151\x64\137\x70\157\x73\164\x20\75\x20\160\x6f\163\x74\137\x63\157\x6d\155\x65\156\x74\163\x2e\151\x64\137\x70\157\x73\164\x29\40\x41\123\x20\152\x6d\154");
 goto L_0a2b9;
 L_cfce0:
 $_0x74ac = $this->request->getGet("\x68\141\x6c\141\x6d\141\x6e") ?? 0;
 goto L_a74e7;
 L_0afec:
 $_0x3df1->orderBy("\x61\56\x75\160\x64\141\x74\145\x64", "\x64\145\x73\143");
 goto L_dc712;
 L_a74e7:
 $_0xa9f0 = 5;
 goto L_9d7e9;
 L_dc712:
 $_0x3df1->limit($_0xa9f0, $_0xd0c0);
 goto L_84e3d;
 L_0cbbb:
 $_0x3df1->groupStart()->like("\x61\56\x6b\145\x70\141\x64\141", "\x32")->orLike("\x61\56\x6b\145\x70\141\x64\141", "\x61\154\x6c")->groupEnd();
 goto L_0afec;
 L_f4b15:
 $_0xb2ae = \Config\Database::connect();
 goto L_6b0e9;
 L_84e3d:
 $_0x76a7 = $_0x3df1->get()->getResult();
 goto L_57495;
 L_0a2b9:
 $_0x3df1->join("\x6d\141\x73\164\x65\162\x5f\147\x75\162\x75\40\x62", "\x61\56\x64\141\x72\151\x20\75\x20\142\x2e\151\x64\137\x67\165\x72\165", "\x6c\145\x66\164");
 goto L_0cbbb;
 L_9d7e9:
 $_0xd0c0 = (int) $_0x74ac * $_0xa9f0;
 goto L_f4b15;
 L_6163a:
 if (count($_0x76a7) > 0) {
 foreach ($_0x76a7 as $_0xe6e6) {
 if ($_0xe6e6->dari > 0) {
 $_0xa90a = FCPATH . ltrim($_0xe6e6->foto ?? '', "\x2f");
 $_0xe6e6->foto = $_0xe6e6->foto && file_exists($_0xa90a) ? $_0x8898 . ltrim($_0xe6e6->foto, "\x2f") : $_0x8898 . "\x61\163\x73\145\x74\163\x2f\151\x6d\147\x2f\147\x75\162\x75\56\x70\156\x67";
 }
 }
 }
 goto L_ecbc3;
 L_ecbc3:
 return $this->response->setJSON($_0x76a7);
 }
 public function index()
 {
 goto L_1632e;
 L_590b3:
 $_0x3012 = session();
 goto L_6e495;
 L_1632e:
 $_0x262b = (new \App\Models\DashboardModel())->getTahunActive();
 goto L_669aa;
 L_03688:
 if ($_0xa702) {
 $this->unpackDapodikExtra($_0xa702, $_0x262b);
 }
 goto L_d6a83;
 L_d6a83:
 $_0xc79f = ["\x75\163\x65\162" => $_0x2003, "\x6a\165\x64\165\x6c" => "\x50\162\x6f\146\x69\154\x65", "\x73\165\x62\152\x75\144\x75\154" => "\x50\162\x6f\146\x69\154\x65\40\x53\141\x79\141", "\x73\145\x74\164\x69\156\x67" => (new \App\Models\DashboardModel())->getSetting()];
 goto L_f4794;
 L_59cc1:
 $_0x2003 = (object) ["\x69\144" => $_0x3012->get("\x69\144\x5f\165\x73\145\x72"), "\x75\163\x65\162\x6e\141\x6d\145" => $_0x3012->get("\x75\163\x65\162\x6e\141\x6d\145")];
 goto L_a0f52;
 L_f4794:
 $_0xc79f["\x74\160"] = (new \App\Models\DashboardModel())->getTahun();
 goto L_1a6a1;
 L_41151:
 $_0xd3d0 = [["\x6c\141\x62\145\x6c" => "\x4e\141\x6d\141\x20\114\x65\156\x67\153\x61\160", "\x6e\141\x6d\145" => "\x6e\141\x6d\141\x5f\147\x75\162\x75", "\x76\141\x6c\165\x65" => $_0xa702->nama_guru ?? '', "\x69\143\x6f\156" => "\x66\141\x72\40\x66\141\x2d\165\x73\145\x72", "\x74\171\x70\145" => "\x74\145\x78\164"], ["\x6c\141\x62\145\x6c" => "\x45\155\x61\151\x6c", "\x6e\141\x6d\145" => "\x65\155\x61\151\x6c", "\x76\141\x6c\165\x65" => $_0xa702->email ?? '', "\x69\143\x6f\156" => "\x66\141\x72\40\x66\141\x2d\145\x6e\166\x65\154\x6f\160\x65", "\x74\171\x70\145" => "\x74\145\x78\164"], ["\x6c\141\x62\145\x6c" => $_0xc79f["\x73\145\x74\164\x69\156\x67"]->label_nip ?? "\x4e\111\x50", "\x6e\141\x6d\145" => "\x6e\151\x70", "\x76\141\x6c\165\x65" => $_0xa702->nip ?? '', "\x69\143\x6f\156" => "\x66\141\x72\40\x66\141\x2d\151\x64\55\x63\141\x72\144", "\x74\171\x70\145" => "\x74\145\x78\164"], ["\x6c\141\x62\145\x6c" => "\x4a\145\x6e\151\x73\40\x4b\145\x6c\141\x6d\151\x6e", "\x6e\141\x6d\145" => "\x6a\145\x6e\151\x73\137\x6b\145\x6c\141\x6d\151\x6e", "\x76\141\x6c\165\x65" => $_0xa702->jenis_kelamin ?? '', "\x69\143\x6f\156" => "\x66\141\x73\40\x66\141\x2d\166\x65\156\x75\163\x2d\155\x61\162\x73", "\x74\171\x70\145" => "\x74\145\x78\164"], ["\x6c\141\x62\145\x6c" => "\x4e\157\x2e\40\x48\141\x6e\144\x70\150\x6f\156\x65", "\x6e\141\x6d\145" => "\x6e\157\x5f\150\x70", "\x76\141\x6c\165\x65" => $_0xa702->no_hp ?? '', "\x69\143\x6f\156" => "\x66\141\x20\146\x61\55\x70\150\x6f\156\x65", "\x74\171\x70\145" => "\x6e\165\x6d\142\x65\162"], ["\x6c\141\x62\145\x6c" => "\x41\147\x61\155\x61", "\x6e\141\x6d\145" => "\x61\147\x61\155\x61", "\x76\141\x6c\165\x65" => $_0xa702->agama ?? '', "\x69\143\x6f\156" => "\x66\141\x72\40\x66\141\x2d\165\x73\145\x72", "\x74\171\x70\145" => "\x74\145\x78\164"]];
 goto L_9286b;
 L_a0f52:
 $_0xa702 = (new \App\Models\DashboardModel())->getDetailGuruByUserId($_0x2003->id, $_0x262b->id_tp, $_0x4e85->id_smt);
 goto L_03688;
 L_6e495:
 if (!$_0x3012->get("\x69\163\x5f\154\x6f\147\x69\156")) {
 return redirect()->to("\x61\165\x74\150");
 }
 goto L_59cc1;
 L_1a6a1:
 $_0xc79f["\x74\160\x5f\141\x63\164\x69\166\x65"] = $_0x262b;
 goto L_ed055;
 L_f5b36:
 $_0xdde8 = [["\x6c\141\x62\145\x6c" => "\x4b\124\x50", "\x69\144" => "\x6b\164\x70\137\x69\144", "\x6e\141\x6d\145" => "\x6b\164\x70\137\x69\144", "\x76\141\x6c\165\x65" => '', "\x74\171\x70\145" => "\x66\151\x6c\145"], ["\x6c\141\x62\145\x6c" => "\x4b\113", "\x69\144" => "\x6b\153\x5f\151\x64", "\x6e\141\x6d\145" => "\x6b\153\x5f\151\x64", "\x76\141\x6c\165\x65" => '', "\x74\171\x70\145" => "\x66\151\x6c\145"], ["\x6c\141\x62\145\x6c" => "\x53\145\x72\164\x69\146\x69\153\x61\164", "\x69\144" => "\x73\145\x72\164\x69\146\x69\153\x61\164", "\x6e\141\x6d\145" => "\x73\145\x72\164\x69\146\x69\153\x61\164\x5b\135", "\x76\141\x6c\165\x65" => '', "\x74\171\x70\145" => "\x66\151\x6c\145"]];
 goto L_af62e;
 L_669aa:
 $_0x4e85 = (new \App\Models\DashboardModel())->getSemesterActive();
 goto L_590b3;
 L_af62e:
 $_0xc79f["\x69\156\x70\165\x74\137\x70\162\x6f\146\x69\154\x65"] = json_decode(json_encode($_0xd3d0), FALSE);
 goto L_096e6;
 L_ed055:
 $_0xc79f["\x73\155\x74"] = (new \App\Models\DashboardModel())->getSemester();
 goto L_a831b;
 L_a831b:
 $_0xc79f["\x73\155\x74\137\x61\143\x74\151\x76\145"] = $_0x4e85;
 goto L_7ee5f;
 L_7ee5f:
 $_0xc79f["\x67\165\x72\165"] = $_0xa702;
 goto L_41151;
 L_9286b:
 $_0x7f48 = [["\x6c\141\x62\145\x6c" => "\x4e\111\x4b", "\x6e\141\x6d\145" => "\x6e\157\x5f\153\x74\160", "\x76\141\x6c\165\x65" => $_0xa702->no_ktp ?? '', "\x69\143\x6f\156" => "\x66\141\x72\40\x66\141\x2d\151\x64\55\x63\141\x72\144", "\x74\171\x70\145" => "\x6e\165\x6d\142\x65\162"], ["\x6c\141\x62\145\x6c" => "\x54\145\x6d\160\x61\164\x20\114\x61\150\x69\162", "\x6e\141\x6d\145" => "\x74\145\x6d\160\x61\164\x5f\154\x61\150\x69\162", "\x76\141\x6c\165\x65" => $_0xa702->tempat_lahir ?? '', "\x69\143\x6f\156" => "\x66\141\x20\146\x61\55\x6d\141\x70\55\x6d\141\x72\153\x65\162", "\x74\171\x70\145" => "\x74\145\x78\164"], ["\x6c\141\x62\145\x6c" => "\x54\147\x6c\56\x20\114\x61\150\x69\162", "\x6e\141\x6d\145" => "\x74\147\x6c\137\x6c\141\x68\151\x72", "\x76\141\x6c\165\x65" => $_0xa702->tgl_lahir ?? '', "\x69\143\x6f\156" => "\x66\141\x20\146\x61\55\x63\141\x6c\145\x6e\144\x61\162", "\x74\171\x70\145" => "\x74\145\x78\164"], ["\x6c\141\x62\145\x6c" => "\x41\154\x61\155\x61\164", "\x6e\141\x6d\145" => "\x61\154\x61\155\x61\164\x5f\152\x61\154\x61\156", "\x76\141\x6c\165\x65" => $_0xa702->alamat_jalan ?? '', "\x69\143\x6f\156" => "\x66\141\x20\146\x61\55\x6d\141\x70\55\x6d\141\x72\153\x65\162", "\x74\171\x70\145" => "\x74\145\x78\164"], ["\x6c\141\x62\145\x6c" => "\x4b\145\x63\141\x6d\141\x74\141\x6e", "\x6e\141\x6d\145" => "\x6b\145\x63\141\x6d\141\x74\141\x6e", "\x76\141\x6c\165\x65" => $_0xa702->kecamatan ?? '', "\x69\143\x6f\156" => "\x66\141\x20\146\x61\55\x6d\141\x70\55\x6d\141\x72\153\x65\162", "\x74\171\x70\145" => "\x74\145\x78\164"], ["\x6c\141\x62\145\x6c" => "\x4b\157\x74\141\x2f\113\x61\142\x2e", "\x6e\141\x6d\145" => "\x6b\141\x62\165\x70\141\x74\145\x6e", "\x76\141\x6c\165\x65" => $_0xa702->kabupaten ?? '', "\x69\143\x6f\156" => "\x66\141\x20\146\x61\55\x6d\141\x70\55\x6d\141\x72\153\x65\162", "\x74\171\x70\145" => "\x74\145\x78\164"], ["\x6c\141\x62\145\x6c" => "\x50\162\x6f\166\x69\156\x73\151", "\x6e\141\x6d\145" => "\x70\162\x6f\166\x69\156\x73\151", "\x76\141\x6c\165\x65" => $_0xa702->provinsi ?? '', "\x69\143\x6f\156" => "\x66\141\x20\146\x61\55\x6d\141\x70\55\x6d\141\x72\153\x65\162", "\x74\171\x70\145" => "\x74\145\x78\164"], ["\x6c\141\x62\145\x6c" => "\x4b\157\x64\145\x20\120\x6f\163", "\x6e\141\x6d\145" => "\x6b\157\x64\145\x5f\160\x6f\163", "\x76\141\x6c\165\x65" => $_0xa702->kode_pos ?? '', "\x69\143\x6f\156" => "\x66\141\x20\146\x61\55\x65\156\x76\145\x6c\157\x70\145", "\x74\171\x70\145" => "\x6e\165\x6d\142\x65\162"]];
 goto L_f5b36;
 L_096e6:
 $_0xc79f["\x69\156\x70\165\x74\137\x61\154\x61\155\x61\164"] = json_decode(json_encode($_0x7f48), FALSE);
 goto L_a16d8;
 L_5d583:
 return view("\x6d\145\x6d\142\x65\162\x73\57\x67\165\x72\165\x2f\160\x72\157\x66\151\x6c\145", $_0xc79f);
 L_a16d8:
 $_0xc79f["\x69\156\x70\165\x74\137\x64\157\x6b\165\x6d\145\x6e"] = json_decode(json_encode($_0xdde8), FALSE);
 goto L_5d583;
 }
 /**
 * Save guru profile — CI4 native validation & file upload.
 * @throws \Random\RandomException
 */
 public function save()
 {
 goto L_537ec;
 L_6c557:
 // ── CI4 File uploads ───────────────────────────────────────────────
 $_0x213f = json_decode($_0xb869->dokumen ?? "\x5b\135", true) ?: [];
 goto L_37632;
 L_99c35:
 if (!is_dir($_0x578a)) {
 mkdir($_0x578a, 0777, true);
 }
 goto L_5d2c0;
 L_5b1ad:
 if (is_string($_0x63c5["\x72\151\x77\141\x79\141\x74\137\x6b\147\x62"])) {
 $_0x63c5["\x72\151\x77\141\x79\141\x74\137\x6b\147\x62"] = json_decode($_0x63c5["\x72\151\x77\141\x79\141\x74\137\x6b\147\x62"], true) ?: [];
 }
 goto L_825f0;
 L_47d32:
 // ── Dapodik Extra Payload (Sinkron Buku Induk 100%) ──────────────────
 $_0x63c5 = ["\x6c\141\x73\164\x5f\165\x70\144\x61\164\x65" => date("\x59\55\x6d\55\x64\40\x48\72\x69\72\x73"), "\x6e\157\x5f\163\x75\162\x61\164\x5f\164\x75\147\x61\163" => trim($this->request->getPost("\x6e\157\x5f\163\x75\162\x61\164\x5f\164\x75\147\x61\163") ?? ''), "\x74\147\x6c\137\x73\165\x72\141\x74\137\x74\165\x67\141\x73" => trim($this->request->getPost("\x74\147\x6c\137\x73\165\x72\141\x74\137\x74\165\x67\141\x73") ?? ''), "\x74\141\x68\165\x6e\137\x61\152\x61\162\x61\156" => trim($this->request->getPost("\x74\141\x68\165\x6e\137\x61\152\x61\162\x61\156") ?? ''), "\x73\145\x6b\157\x6c\141\x68\137\x69\156\x64\165\x6b" => trim($this->request->getPost("\x73\145\x6b\157\x6c\141\x68\137\x69\156\x64\165\x6b") ?? "\x59\141"), "\x6e\141\x6d\141\x5f\151\x62\165" => trim($this->request->getPost("\x6e\141\x6d\141\x5f\151\x62\165") ?? ''), "\x6e\141\x6d\141\x5f\163\x75\141\x6d\151\x5f\151\x73\164\x72\151" => trim($this->request->getPost("\x6e\141\x6d\141\x5f\163\x75\141\x6d\151\x5f\151\x73\164\x72\151") ?? ''), "\x70\145\x6b\145\x72\152\x61\141\x6e\137\x73\165\x61\155\x69\137\x69\163\x74\162\x69" => trim($this->request->getPost("\x70\145\x6b\145\x72\152\x61\141\x6e\137\x73\165\x61\155\x69\137\x69\163\x74\162\x69") ?? ''), "\x6e\141\x6d\141\x5f\167\x61\152\x69\142\x5f\160\x61\152\x61\153" => trim($this->request->getPost("\x6e\141\x6d\141\x5f\167\x61\152\x69\142\x5f\160\x61\152\x61\153") ?? $_0x40a1), "\x73\153\x5f\143\x70\156\x73" => trim($this->request->getPost("\x73\153\x5f\143\x70\156\x73") ?? ''), "\x74\155\x74\137\x63\160\x6e\163" => trim($this->request->getPost("\x74\155\x74\137\x63\160\x6e\163") ?? ''), "\x74\155\x74\137\x73\153\x5f\160\x65\156\x67\141\x6e\147\x6b\141\x74\141\x6e" => trim($this->request->getPost("\x74\155\x74\137\x73\153\x5f\160\x65\156\x67\141\x6e\147\x6b\141\x74\141\x6e") ?? ''), "\x73\165\x6d\142\x65\162\x5f\147\x61\152\x69" => trim($this->request->getPost("\x73\165\x6d\142\x65\162\x5f\147\x61\152\x69") ?? "\x41\120\x42\104\x20\120\x72\157\x76\151\x6e\163\x69"), "\x70\141\x6e\147\x6b\141\x74\137\x67\157\x6c\157\x6e\147\x61\156" => trim($this->request->getPost("\x70\141\x6e\147\x6b\141\x74\137\x67\157\x6c\157\x6e\147\x61\156") ?? ''), "\x74\155\x74\137\x70\141\x6e\147\x6b\141\x74\137\x67\157\x6c\157\x6e\147\x61\156" => trim($this->request->getPost("\x74\155\x74\137\x70\141\x6e\147\x6b\141\x74\137\x67\157\x6c\157\x6e\147\x61\156") ?? ''), "\x6d\141\x73\141\x5f\153\x65\162\x6a\141" => trim($this->request->getPost("\x6d\141\x73\141\x5f\153\x65\162\x6a\141") ?? ''), "\x73\153\x5f\160\x65\156\x67\141\x6e\147\x6b\141\x74\141\x6e" => trim($this->request->getPost("\x73\153\x5f\160\x65\156\x67\141\x6e\147\x6b\141\x74\141\x6e") ?? ''), "\x74\155\x74\137\x70\145\x6e\147\x61\156\x67\153\x61\164\x61\156" => trim($this->request->getPost("\x74\155\x74\137\x70\145\x6e\147\x61\156\x67\153\x61\164\x61\156") ?? ''), "\x6c\145\x6d\142\x61\147\x61\137\x70\145\x6e\147\x61\156\x67\153\x61\164" => trim($this->request->getPost("\x6c\145\x6d\142\x61\147\x61\137\x70\145\x6e\147\x61\156\x67\153\x61\164") ?? "\x50\145\x6d\145\x72\151\x6e\164\x61\150\x20\113\x61\142\x2f\113\x6f\164\x61"), "\x6b\141\x72\160\x65\147" => trim($this->request->getPost("\x6b\141\x72\160\x65\147") ?? ''), "\x6b\141\x72\151\x73\137\x6b\141\x72\163\x75" => trim($this->request->getPost("\x6b\141\x72\151\x73\137\x6b\141\x72\163\x75") ?? ''), "\x6b\157\x6d\160\x65\164\x65\156\x73\151" => trim($this->request->getPost("\x6b\157\x6d\160\x65\164\x65\156\x73\151") ?? ''), "\x70\145\x6e\144\x69\144\x69\153\x61\156\x5f\164\x65\162\x61\153\x68\151\x72" => trim($this->request->getPost("\x70\145\x6e\144\x69\144\x69\153\x61\156\x5f\164\x65\162\x61\153\x68\151\x72") ?? ''), "\x73\164\x61\164\x75\163\x5f\153\x75\154\x69\141\x68" => trim($this->request->getPost("\x73\164\x61\164\x75\163\x5f\153\x75\154\x69\141\x68") ?? "\x54\151\x64\141\x6b"), "\x74\165\x67\141\x73\137\x74\141\x6d\142\x61\150\x61\156" => trim($this->request->getPost("\x74\147\x73\137\x74\141\x6d\142\x61\150\x61\156") ?? ''), "\x74\155\x74\137\x74\141\x6d\142\x61\150\x61\156" => trim($this->request->getPost("\x74\155\x74\137\x74\141\x6d\142\x61\150\x61\156") ?? ''), "\x74\163\x74\137\x74\141\x6d\142\x61\150\x61\156" => trim($this->request->getPost("\x74\163\x74\137\x74\141\x6d\142\x61\150\x61\156") ?? ''), "\x6a\141\x6d\137\x74\165\x67\141\x73\137\x74\141\x6d\142\x61\150\x61\156" => trim($this->request->getPost("\x6a\141\x6d\137\x74\165\x67\141\x73\137\x74\141\x6d\142\x61\150\x61\156") ?? ''), "\x74\141\x68\165\x6e\137\x70\145\x6e\163\x69\165\x6e" => trim($this->request->getPost("\x74\141\x68\165\x6e\137\x70\145\x6e\163\x69\165\x6e") ?? ''), "\x6a\141\x6d\137\x6d\145\x6e\147\x61\152\x61\162" => trim($this->request->getPost("\x6a\141\x6d\137\x6d\145\x6e\147\x61\152\x61\162") ?? ''), "\x74\157\x74\141\x6c\137\x6a\141\x6d" => trim($this->request->getPost("\x74\157\x74\141\x6c\137\x6a\141\x6d") ?? ''), "\x72\151\x77\141\x79\141\x74\137\x6b\147\x62" => $this->request->getPost("\x72\151\x77\141\x79\141\x74\137\x6b\147\x62") ?: [], "\x72\151\x77\141\x79\141\x74\137\x6b\145\x70\141\x6e\147\x6b\141\x74\141\x6e" => $this->request->getPost("\x72\151\x77\141\x79\141\x74\137\x6b\145\x70\141\x6e\147\x6b\141\x74\141\x6e") ?: [], "\x6c\141\x6d\160\x69\162\x61\156\x5f\160\x65\155\x62\145\x6c\141\x6a\141\x72\141\x6e" => $this->request->getPost("\x6c\141\x6d\160\x69\162\x61\156\x5f\160\x65\155\x62\145\x6c\141\x6a\141\x72\141\x6e") ?: []];
 goto L_5b1ad;
 L_6d9b4:
 if ($_0x8265) {
 if (!isset($_0x213f["\x73\145\x72\164\x69\146\x69\153\x61\164"])) {
 $_0x213f["\x73\145\x72\164\x69\146\x69\153\x61\164"] = [];
 }
 foreach ($_0x8265 as $_0xcd39) {
 if ($_0xcd39 && $_0xcd39->isValid() && !$_0xcd39->hasMoved()) {
 $_0xdafe = "\x73\145\x72\164\x5f" . $_0x9d1e . "\x5f" . bin2hex(random_bytes(8)) . "\x2e" . $_0xcd39->getClientExtension();
 $_0xcd39->move($_0x578a, $_0xdafe);
 $_0x213f["\x73\145\x72\164\x69\146\x69\153\x61\164"][] = "\x75\160\x6c\157\x61\144\x73\57\x70\162\x6f\146\x69\154\x65\163\x2f" . $_0xdafe;
 }
 }
 }
 goto L_57779;
 L_64088:
 $_0xd410 = $this->request->getPost("\x74\145\x6d\160\x61\164\x5f\154\x61\150\x69\162");
 goto L_7e536;
 L_7ed13:
 $_0xe5f2 = $this->request->getPost("\x6b\141\x62\165\x70\141\x74\145\x6e");
 goto L_8a358;
 L_37632:
 $_0xb3d0 = [];
 goto L_683aa;
 L_58c42:
 if ($_0xb160) {
 // Sync user account if username exists
 if ($_0xb869 && !empty($_0xb869->username)) {
 $_0xf9ea = \Config\Database::connect();
 $_0xf9ea->table("\x75\163\x65\162\x73")->where("\x75\163\x65\162\x6e\141\x6d\145", $_0xb869->username)->update(["\x66\151\x72\163\x74\137\x6e\141\x6d\145" => $_0x40a1, "\x65\155\x61\151\x6c" => $_0x6a6e ?? '']);
 }
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => true, "\x6d\145\x73\163\x61\147\x65" => "\x50\162\x6f\146\x69\154\x65\40\x67\165\x72\165\x20\142\x65\162\x68\141\x73\151\x6c\40\x64\151\x73\151\x6d\160\x61\156", "\x64\157\x6b\165\x6d\145\x6e" => $_0x213f, "\x65\162\x72\157\x72\163" => $_0xb3d0]);
 }
 goto L_2ea33;
 L_e1b7b:
 $_0xce43 = $this->request->getPost("\x6e\157\x5f\150\x70");
 goto L_ea5f9;
 L_a9b13:
 $_0x40a1 = $this->request->getPost("\x6e\141\x6d\141\x5f\147\x75\162\x75");
 goto L_3d25d;
 L_8a358:
 $_0xe84f = $this->request->getPost("\x70\162\x6f\166\x69\156\x73\151");
 goto L_cc435;
 L_e4d86:
 if ($_0x289c && $_0x289c->isValid() && !$_0x289c->hasMoved()) {
 $_0xdafe = "\x6b\153\x5f" . $_0x9d1e . "\x5f" . bin2hex(random_bytes(8)) . "\x2e" . $_0x289c->getClientExtension();
 $_0x289c->move($_0x578a, $_0xdafe);
 $_0x213f["\x6b\153"] = "\x75\160\x6c\157\x61\144\x73\57\x70\162\x6f\146\x69\154\x65\163\x2f" . $_0xdafe;
 }
 goto L_6eff7;
 L_2ea33:
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x47\141\x67\141\x6c\40\x6d\145\x6e\171\x69\155\x70\141\x6e\40\x70\162\x6f\146\x69\154\x65\40\x67\165\x72\165\x2e", "\x65\162\x72\157\x72\163" => ["\x67\145\x6e\145\x72\141\x6c" => "\x47\141\x67\141\x6c\40\x6d\145\x6e\171\x69\155\x70\141\x6e\40\x70\162\x6f\146\x69\154\x65\40\x67\165\x72\165\x2e"]]);
 L_566aa:
 $_0xb869 = (new \App\Models\MasterModel())->getGuruById($_0xd5cd, $_0x8a79->id_tp, $_0x202e->id_smt);
 goto L_08864;
 L_93ad1:
 $_0x8c4c = $this->request->getPost("\x61\154\x61\155\x61\164\x5f\152\x61\154\x61\156");
 goto L_7646c;
 L_7646c:
 $_0x17ad = $this->request->getPost("\x6b\145\x63\141\x6d\141\x74\141\x6e");
 goto L_7ed13;
 L_3863a:
 // ── Update DB ─────────────────────────────────────────────────────
 $_0xb160 = (new \App\Models\MasterModel())->updateData("\x6d\141\x73\164\x65\162\x5f\147\x75\162\x75", $_0x2256, "\x69\144\x5f\147\x75\162\x75", $_0xd5cd);
 goto L_58c42;
 L_3d25d:
 $_0x6a6e = $this->request->getPost("\x65\155\x61\151\x6c");
 goto L_e13bc;
 L_e7393:
 if ($_0x8795 && $_0x8795->isValid() && !$_0x8795->hasMoved()) {
 $_0xdafe = "\x6b\164\x70\137" . $_0x9d1e . "\x5f" . bin2hex(random_bytes(8)) . "\x2e" . $_0x8795->getClientExtension();
 $_0x8795->move($_0x578a, $_0xdafe);
 $_0x213f["\x6b\164\x70"] = "\x75\160\x6c\157\x61\144\x73\57\x70\162\x6f\146\x69\154\x65\163\x2f" . $_0xdafe;
 }
 goto L_4a02a;
 L_825f0:
 if (is_string($_0x63c5["\x72\151\x77\141\x79\141\x74\137\x6b\145\x70\141\x6e\147\x6b\141\x74\141\x6e"])) {
 $_0x63c5["\x72\151\x77\141\x79\141\x74\137\x6b\145\x70\141\x6e\147\x6b\141\x74\141\x6e"] = json_decode($_0x63c5["\x72\151\x77\141\x79\141\x74\137\x6b\145\x70\141\x6e\147\x6b\141\x74\141\x6e"], true) ?: [];
 }
 goto L_cfed4;
 L_4a02a:
 $_0x289c = $this->request->getFile("\x6b\153\x5f\151\x64");
 goto L_e4d86;
 L_e13bc:
 $_0x2b9f = $this->request->getPost("\x6a\145\x6e\151\x73\137\x6b\145\x6c\141\x6d\151\x6e");
 goto L_e1b7b;
 L_7e536:
 $_0xa50e = $this->request->getPost("\x74\147\x6c\137\x6c\141\x68\151\x72");
 goto L_93ad1;
 L_34a10:
 // ── Build update payload ───────────────────────────────────────────
 $_0x2256 = ["\x6e\151\x70" => $_0xf658, "\x6a\145\x6e\151\x73\137\x6e\151\x70" => $_0x8e0c, "\x6e\141\x6d\141\x5f\147\x75\162\x75" => $_0x40a1, "\x65\155\x61\151\x6c" => $_0x6a6e, "\x6a\145\x6e\151\x73\137\x6b\145\x6c\141\x6d\151\x6e" => $_0x2b9f, "\x6e\157\x5f\150\x70" => $_0xce43, "\x61\147\x61\155\x61" => $_0x7295, "\x6e\157\x5f\153\x74\160" => $_0x5f68, "\x74\145\x6d\160\x61\164\x5f\154\x61\150\x69\162" => $_0xd410, "\x74\147\x6c\137\x6c\141\x68\151\x72" => strpos((string) $_0xa50e, "\x30\60\x30\60\x2d") !== false ? null : ($_0xa50e ?: null), "\x61\154\x61\155\x61\164\x5f\152\x61\154\x61\156" => $_0x8c4c, "\x6b\145\x63\141\x6d\141\x74\141\x6e" => $_0x17ad, "\x6b\141\x62\165\x70\141\x74\145\x6e" => $_0xe5f2, "\x70\162\x6f\166\x69\156\x73\151" => $_0xe84f, "\x6b\157\x64\145\x5f\160\x6f\163" => (int) ($_0x9e82 ?: 0), "\x6e\165\x70\164\x6b" => trim($this->request->getPost("\x6e\165\x70\164\x6b") ?? ''), "\x6e\160\x77\160" => trim($this->request->getPost("\x6e\160\x77\160") ?? ''), "\x6b\157\x64\145\x5f\147\x75\162\x75" => trim($this->request->getPost("\x6b\157\x64\145\x5f\147\x75\162\x75") ?? ''), "\x73\164\x61\164\x75\163\x5f\156\x69\153\x61\150" => trim($this->request->getPost("\x73\164\x61\164\x75\163\x5f\156\x69\153\x61\150") ?? ''), "\x6b\145\x77\141\x72\147\x61\156\x65\147\x61\162\x61\141\x6e" => trim($this->request->getPost("\x6b\145\x77\141\x72\147\x61\156\x65\147\x61\162\x61\141\x6e") ?? "\x57\116\x49"), "\x6a\145\x6e\151\x73\137\x70\164\x6b" => trim($this->request->getPost("\x6a\145\x6e\151\x73\137\x70\164\x6b") ?? "\x47\165\x72\165\x20\115\x61\160\x65\154"), "\x73\164\x61\164\x75\163\x5f\160\x65\147\x61\167\x61\151" => trim($this->request->getPost("\x73\164\x61\164\x75\163\x5f\160\x65\147\x61\167\x61\151") ?? "\x47\124\x59\57\x50\124\x59"), "\x74\147\x73\137\x74\141\x6d\142\x61\150\x61\156" => trim($this->request->getPost("\x74\147\x73\137\x74\141\x6d\142\x61\150\x61\156") ?? ''), "\x6b\145\x61\150\x6c\151\x61\156\x5f\151\x73\171\x61\162\x61\164" => trim($this->request->getPost("\x6b\145\x61\150\x6c\151\x61\156\x5f\151\x73\171\x61\162\x61\164") ?? "\x54\151\x64\141\x6b"), "\x72\164\x5f\162\x77" => trim($this->request->getPost("\x72\164\x5f\162\x77") ?? ''), "\x64\165\x73\165\x6e" => trim($this->request->getPost("\x64\165\x73\165\x6e") ?? ''), "\x6b\145\x6c\165\x72\141\x68\141\x6e" => trim($this->request->getPost("\x6b\145\x6c\165\x72\141\x68\141\x6e") ?? '')];
 goto L_47d32;
 L_e4a91:
 $_0x5f68 = $this->request->getPost("\x6e\157\x5f\153\x74\160");
 goto L_64088;
 L_b2bf1:
 $_0xf658 = $this->request->getPost("\x6e\151\x70");
 goto L_474fc;
 L_5d2c0:
 $_0x9d1e = !empty($_0xf658) ? $_0xf658 : "\x67\165\x72\165\x5f" . $_0xd5cd;
 goto L_c83ef;
 L_42e84:
 $_0x2256["\x64\157\x6b\165\x6d\145\x6e"] = json_encode($_0x213f, JSON_UNESCAPED_UNICODE);
 goto L_3863a;
 L_c83ef:
 $_0x8795 = $this->request->getFile("\x6b\164\x70\137\x69\144");
 goto L_e7393;
 L_474fc:
 $_0x8e0c = $this->request->getPost("\x6a\145\x6e\151\x73\137\x6e\151\x70") ?: "\x4e\111\x50";
 goto L_a9b13;
 L_4be67:
 if (!$this->validate(["\x6e\141\x6d\141\x5f\147\x75\162\x75" => "\x72\145\x71\165\x69\162\x65\144\x7c\164\x72\151\x6d\174\x6d\151\x6e\137\x6c\145\x6e\147\x74\150\x5b\61\x5d\174\x6d\141\x78\137\x6c\145\x6e\147\x74\150\x5b\61\x35\60\x5d", "\x6e\151\x70" => "\x70\145\x72\155\x69\164\x5f\145\x6d\160\x74\171\x7c\155\x61\170\x5f\154\x65\156\x67\164\x68\133\x35\60\x5d" . $_0xb227])) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x56\141\x6c\151\x64\141\x73\151\x20\147\x61\147\x61\154\x3a\40" . implode("\x2c\40", array_filter([$this->validator->getError("\x6e\141\x6d\141\x5f\147\x75\162\x75"), $this->validator->getError("\x6e\151\x70")])), "\x65\162\x72\157\x72\163" => ["\x6e\151\x70" => $this->validator->getError("\x6e\151\x70"), "\x6e\141\x6d\141\x5f\147\x75\162\x75" => $this->validator->getError("\x6e\141\x6d\141\x5f\147\x75\162\x75")]]);
 }
 goto L_34a10;
 L_cfed4:
 if (is_string($_0x63c5["\x6c\141\x6d\160\x69\162\x61\156\x5f\160\x65\155\x62\145\x6c\141\x6a\141\x72\141\x6e"])) {
 $_0x63c5["\x6c\141\x6d\160\x69\162\x61\156\x5f\160\x65\155\x62\145\x6c\141\x6a\141\x72\141\x6e"] = json_decode($_0x63c5["\x6c\141\x6d\160\x69\162\x61\156\x5f\160\x65\155\x62\145\x6c\141\x6a\141\x72\141\x6e"], true) ?: [];
 }
 goto L_6c557;
 L_6eff7:
 $_0x8265 = $this->request->getFileMultiple("\x73\145\x72\164\x69");
 goto L_6d9b4;
 L_bf1a3:
 $_0x202e = (new \App\Models\DashboardModel())->getSemesterActive();
 goto L_566aa;
 L_08864:
 // ── CI4 Validation ─────────────────────────────────────────────────
 $_0xb227 = '';
 goto L_865fb;
 L_ea5f9:
 $_0x7295 = $this->request->getPost("\x61\147\x61\155\x61");
 goto L_e4a91;
 L_537ec:
 $_0xd5cd = $this->request->getPost("\x69\144\x5f\147\x75\162\x75");
 goto L_b2bf1;
 L_57779:
 // Simpan _dapodik_extra ke dokumen JSON
 $_0x213f["\x5f\144\x61\160\x6f\144\x69\153\x5f\145\x78\164\x72\141"] = $_0x63c5;
 goto L_42e84;
 L_865fb:
 if (!empty($_0xf658) && (!$_0xb869 || $_0xb869->nip != $_0xf658)) {
 $_0xb227 = "\x7c\151\x73\137\x75\156\x69\161\x75\145\x5b\155\x61\163\x74\145\x72\137\x67\165\x72\165\x2e\156\x69\160\x5d";
 }
 goto L_4be67;
 L_b3643:
 $_0x8a79 = (new \App\Models\DashboardModel())->getTahunActive();
 goto L_bf1a3;
 L_683aa:
 $_0x578a = FCPATH . "\x75\160\x6c\157\x61\144\x73\57\x70\162\x6f\146\x69\154\x65\163\x2f";
 goto L_99c35;
 L_cc435:
 $_0x9e82 = $this->request->getPost("\x6b\157\x64\145\x5f\160\x6f\163");
 goto L_b3643;
 }
 function strContains($_0x47cd, $_0xb41d)
 {
 return strpos($_0x47cd, $_0xb41d) !== false;
 }
 function uploadFile($_0xf3fd)
 {
 goto L_88e9a;
 L_88e9a:
 $_0xb304 = (new \App\Models\MasterModel())->getGuruById($_0xf3fd);
 goto L_71ebe;
 L_71ebe:
 $_0x3d97 = ["\x73\162\x63" => ''];
 goto L_bcf72;
 L_e7ce9:
 return $this->response->setJSON($_0x3d97);
 L_bcf72:
 if (isset($_FILES["\x66\157\x74\157"]["\x6e\141\x6d\145"])) {
 $_0x5ff2 = $this->request->getFile("\x66\157\x74\157");
 if ($_0x5ff2 && $_0x5ff2->isValid() && !$_0x5ff2->hasMoved()) {
 $_0x86af = FCPATH . "\x75\160\x6c\157\x61\144\x73\57\x70\162\x6f\146\x69\154\x65\163\x2f";
 if (!is_dir($_0x86af)) {
 mkdir($_0x86af, 0777, true);
 }
 $_0x35e7 = $_0xb304 && !empty($_0xb304->nip) ? $_0xb304->nip : ($_0xb304 && !empty($_0xb304->username) ? $_0xb304->username : "\x67\165\x72\165\x5f" . $_0xf3fd);
 $_0x9c09 = $_0x35e7 . "\x2e" . $_0x5ff2->getClientExtension();
 $_0x5ff2->move($_0x86af, $_0x9c09, true);
 $_0x6d07 = "\x75\160\x6c\157\x61\144\x73\57\x70\162\x6f\146\x69\154\x65\163\x2f" . $_0x9c09;
 (new \App\Models\MasterModel())->updateData("\x6d\141\x73\164\x65\162\x5f\147\x75\162\x75", ["\x66\157\x74\157" => $_0x6d07], "\x69\144\x5f\147\x75\162\x75", $_0xf3fd);
 $_0x3d97["\x73\164\x61\164\x75\163"] = true;
 $_0x3d97["\x73\162\x63"] = base_url() . $_0x6d07;
 $_0x3d97["\x66\151\x6c\145\x6e\141\x6d\145"] = pathinfo($_0x9c09, PATHINFO_FILENAME);
 } else {
 $_0x3d97["\x73\164\x61\164\x75\163"] = false;
 $_0x3d97["\x73\162\x63"] = "\x55\160\x6c\157\x61\144\x20\147\x61\147\x61\154";
 }
 $_0x3d97["\x74\171\x70\145"] = $_FILES["\x66\157\x74\157"]["\x74\171\x70\145"];
 $_0x3d97["\x73\151\x7a\145"] = $_FILES["\x66\157\x74\157"]["\x73\151\x7a\145"];
 }
 goto L_e7ce9;
 }
 function deleteFile($_0x36de)
 {
 goto L_0ce74;
 L_0ce74:
 $_0xb0de = $this->request->getGet("\x73\162\x63");
 goto L_d630b;
 L_aa38e:
 if ($_0xe25d != "\x67\165\x72\165\x2e\160\x6e\147") {
 if (file_exists(FCPATH . ltrim($_0xe25d, "\x2f")) && unlink(FCPATH . ltrim($_0xe25d, "\x2f"))) {
 (new \App\Models\MasterModel())->updateData("\x6d\141\x73\164\x65\162\x5f\147\x75\162\x75", ["\x66\157\x74\157" => ''], "\x69\144\x5f\147\x75\162\x75", $_0x36de);
 echo "\x46\151\x6c\145\x20\104\x65\154\x65\164\x65\40\x53\165\x63\143\x65\163\x73\146\x75\154\x6c\171";
 }
 }
 L_d630b:
 $_0xe25d = str_replace(base_url(), '', $_0xb0de ?? '');
 goto L_aa38e;
 }
 function delete_dokumen($_0x46b4)
 {
 goto L_9c6cd;
 L_9c6cd:
 $_0x2eba = $this->request->getGet("\x73\162\x63");
 goto L_b546e;
 L_fb819:
 $_0x34ca = explode("\x2f", $_0xe530);
 goto L_e82d6;
 L_f99ba:
 $_0x7332 = json_decode($_0x641b->dokumen ?? "\x5b\135", true) ?: [];
 goto L_9b6c3;
 L_4bc59:
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => true, "\x6d\145\x73\163\x61\147\x65" => "\x44\157\x6b\165\x6d\145\x6e\40\x64\145\x6c\145\x74\145\x64\40\x73\165\x63\143\x65\163\x73\146\x75\154\x6c\171\x2e", "\x64\157\x6b\165\x6d\145\x6e" => $_0x7332]);
 L_37a03:
 if ($_0xd614 == "\x73\145\x72\164") {
 $_0xd614 = "\x73\145\x72\164\x69\146\x69\153\x61\164";
 }
 goto L_e2e0e;
 L_17f85:
 $_0x1d6c = explode("\x5f", $_0x637c);
 goto L_5ccec;
 L_0480f:
 $_0x641b = $_0x7388->table("\x6d\141\x73\164\x65\162\x5f\147\x75\162\x75")->select("\x69\144\x5f\147\x75\162\x75\54\x20\156\x61\155\x61\137\x67\165\x72\165\x2c\40\x64\157\x6b\165\x6d\145\x6e")->where("\x69\144\x5f\147\x75\162\x75", $_0x46b4)->get()->getRow();
 goto L_f99ba;
 L_be77f:
 if (file_exists($_0xe530)) {
 unlink(FCPATH . ltrim($_0xe530, "\x2f"));
 }
 goto L_286e2;
 L_b546e:
 $_0xe530 = str_replace(base_url(), '', $_0x2eba ?? '');
 goto L_fb819;
 L_5ccec:
 $_0xd614 = $_0x1d6c[0];
 goto L_37a03;
 L_e82d6:
 $_0x637c = end($_0x34ca);
 goto L_17f85;
 L_286e2:
 (new \App\Models\MasterModel())->updateData("\x6d\141\x73\164\x65\162\x5f\147\x75\162\x75", ["\x64\157\x6b\165\x6d\145\x6e" => json_encode($_0x7332)], "\x69\144\x5f\147\x75\162\x75", $_0x46b4);
 goto L_4bc59;
 L_e2e0e:
 $_0x7388 = \Config\Database::connect();
 goto L_0480f;
 L_9b6c3:
 if (isset($_0x7332[$_0xd614]) && is_array($_0x7332[$_0xd614])) {
 $_0x7332[$_0xd614] = array_values(array_filter($_0x7332[$_0xd614], fn($_0x5d3c) => $_0x5d3c !== $_0xe530));
 } else {
 unset($_0x7332[$_0xd614]);
 }
 goto L_be77f;
 }
 protected function unpackDapodikExtra(&$_0xbbf6, $_0xa28c = null)
 {
 goto L_ee4b5;
 L_e6a3c:
 if (empty($_0xbbf6->status_kuliah)) {
 $_0xbbf6->status_kuliah = "\x54\151\x64\141\x6b";
 }
 goto L_c791c;
 L_5435a:
 if (!is_array($_0xbbf6->lampiran_pembelajaran)) {
 $_0xbbf6->lampiran_pembelajaran = is_string($_0xbbf6->lampiran_pembelajaran) ? json_decode($_0xbbf6->lampiran_pembelajaran, true) : [];
 }
 L_ff05b:
 foreach ($_0xfa0e as $_0xe0ec) {
 if (!isset($_0xbbf6->{$_0xe0ec})) {
 $_0xbbf6->{$_0xe0ec} = in_array($_0xe0ec, ["\x72\151\x77\141\x79\141\x74\137\x6b\147\x62", "\x72\151\x77\141\x79\141\x74\137\x6b\145\x70\141\x6e\147\x6b\141\x74\141\x6e", "\x6c\141\x6d\160\x69\162\x61\156\x5f\160\x65\155\x62\145\x6c\141\x6a\141\x72\141\x6e"]) ? [] : '';
 }
 }
 goto L_8e6f7;
 L_1bac2:
 if (empty($_0xbbf6->lembaga_pengangkat)) {
 $_0xbbf6->lembaga_pengangkat = "\x50\145\x6d\145\x72\151\x6e\164\x61\150\x20\113\x61\142\x2f\113\x6f\164\x61";
 }
 goto L_e6a3c;
 L_8b1b3:
 if (is_string($_0xcb67) && !empty(trim($_0xcb67))) {
 $_0x2ebd = json_decode($_0xcb67, true);
 if (is_array($_0x2ebd) && isset($_0x2ebd["\x5f\144\x61\160\x6f\144\x69\153\x5f\145\x78\164\x72\141"])) {
 $_0x9334 = $_0x2ebd["\x5f\144\x61\160\x6f\144\x69\153\x5f\145\x78\164\x72\141"];
 foreach ($_0xfa0e as $_0xe0ec) {
 if (isset($_0x9334[$_0xe0ec])) {
 $_0xbbf6->{$_0xe0ec} = $_0x9334[$_0xe0ec];
 }
 }
 }
 }
 goto L_9d4dc;
 L_8e6f7:
 $_0xcb67 = $_0xbbf6->dokumen ?? '';
 goto L_8b1b3;
 L_840a7:
 if (empty($_0xbbf6->sekolah_induk)) {
 $_0xbbf6->sekolah_induk = "\x59\141";
 }
 goto L_53874;
 L_9d4dc:
 if (empty($_0xbbf6->tahun_ajaran) && $_0xa28c) {
 $_0xbbf6->tahun_ajaran = $_0xa28c->tahun ?? date("\x59") . "\x2f" . (date("\x59") + 1);
 }
 goto L_840a7;
 L_578a1:
 if (empty($_0xbbf6->sumber_gaji)) {
 $_0xbbf6->sumber_gaji = "\x41\120\x42\104\x20\120\x72\157\x76\151\x6e\163\x69";
 }
 goto L_1bac2;
 L_61779:
 if (!is_array($_0xbbf6->riwayat_kepangkatan)) {
 $_0xbbf6->riwayat_kepangkatan = is_string($_0xbbf6->riwayat_kepangkatan) ? json_decode($_0xbbf6->riwayat_kepangkatan, true) : [];
 }
 goto L_5435a;
 L_ee4b5:
 $_0xfa0e = ["\x6c\141\x73\164\x5f\165\x70\144\x61\164\x65", "\x6e\157\x5f\163\x75\162\x61\164\x5f\164\x75\147\x61\163", "\x74\147\x6c\137\x73\165\x72\141\x74\137\x74\165\x67\141\x73", "\x74\141\x68\165\x6e\137\x61\152\x61\162\x61\156", "\x73\145\x6b\157\x6c\141\x68\137\x69\156\x64\165\x6b", "\x6e\141\x6d\141\x5f\151\x62\165", "\x6e\141\x6d\141\x5f\163\x75\141\x6d\151\x5f\151\x73\164\x72\151", "\x70\145\x6b\145\x72\152\x61\141\x6e\137\x73\165\x61\155\x69\137\x69\163\x74\162\x69", "\x6e\141\x6d\141\x5f\167\x61\152\x69\142\x5f\160\x61\152\x61\153", "\x73\153\x5f\143\x70\156\x73", "\x74\155\x74\137\x63\160\x6e\163", "\x74\155\x74\137\x73\153\x5f\160\x65\156\x67\141\x6e\147\x6b\141\x74\141\x6e", "\x73\165\x6d\142\x65\162\x5f\147\x61\152\x69", "\x70\141\x6e\147\x6b\141\x74\137\x67\157\x6c\157\x6e\147\x61\156", "\x74\155\x74\137\x70\141\x6e\147\x6b\141\x74\137\x67\157\x6c\157\x6e\147\x61\156", "\x6d\141\x73\141\x5f\153\x65\162\x6a\141", "\x73\153\x5f\160\x65\156\x67\141\x6e\147\x6b\141\x74\141\x6e", "\x74\155\x74\137\x70\145\x6e\147\x61\156\x67\153\x61\164\x61\156", "\x6c\145\x6d\142\x61\147\x61\137\x70\145\x6e\147\x61\156\x67\153\x61\164", "\x6b\141\x72\160\x65\147", "\x6b\141\x72\151\x73\137\x6b\141\x72\163\x75", "\x6b\157\x6d\160\x65\164\x65\156\x73\151", "\x70\145\x6e\144\x69\144\x69\153\x61\156\x5f\164\x65\162\x61\153\x68\151\x72", "\x73\164\x61\164\x75\163\x5f\153\x75\154\x69\141\x68", "\x74\165\x67\141\x73\137\x74\141\x6d\142\x61\150\x61\156", "\x74\155\x74\137\x74\141\x6d\142\x61\150\x61\156", "\x74\163\x74\137\x74\141\x6d\142\x61\150\x61\156", "\x6a\141\x6d\137\x74\165\x67\141\x73\137\x74\141\x6d\142\x61\150\x61\156", "\x74\141\x68\165\x6e\137\x70\145\x6e\163\x69\165\x6e", "\x6a\141\x6d\137\x6d\145\x6e\147\x61\152\x61\162", "\x74\157\x74\141\x6c\137\x6a\141\x6d", "\x72\151\x77\141\x79\141\x74\137\x6b\147\x62", "\x72\151\x77\141\x79\141\x74\137\x6b\145\x70\141\x6e\147\x6b\141\x74\141\x6e", "\x6c\141\x6d\160\x69\162\x61\156\x5f\160\x65\155\x62\145\x6c\141\x6a\141\x72\141\x6e"];
 goto L_ff05b;
 L_53874:
 if (empty($_0xbbf6->nama_wajib_pajak)) {
 $_0xbbf6->nama_wajib_pajak = $_0xbbf6->nama_guru ?? '';
 }
 goto L_578a1;
 L_c791c:
 if (!is_array($_0xbbf6->riwayat_kgb)) {
 $_0xbbf6->riwayat_kgb = is_string($_0xbbf6->riwayat_kgb) ? json_decode($_0xbbf6->riwayat_kgb, true) : [];
 }
 goto L_61779;
 }
}