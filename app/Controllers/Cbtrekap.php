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
class Cbtrekap extends BaseController
{
 public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $_0xe10c)
 {
 parent::initController($request, $response, $_0xe10c);
 }
 protected function isAdmin()
 {
 $_0x3ec9 = session();
 return in_array((string) $_0x3ec9->get("\x72\157\x6c\145"), ["\x31", "\x34"]) || $_0x3ec9->get("\x6c\145\x76\145\x6c") == "\x61\144\x6d\151\x6e" || $_0x3ec9->get("\x69\163\x5f\141\x64\155\x69\156") === true;
 }
 protected $guruContextCached = false;
 protected $guruContextData = null;
 protected function getGuruContext()
 {
 goto L_e3556;
 L_ec113:
 $_0xac2d = (new \App\Models\KelasModel())->getGuruMapelKelas($_0x84fe->id_guru, $_0x8d7f->id_tp ?? 1, $_0x8974->id_smt ?? 1);
 goto L_d957e;
 L_60938:
 if ($this->guruContextCached) {
 return $this->guruContextData;
 }
 goto L_3f08c;
 L_950cb:
 $_0x84fe = (new \App\Models\DashboardModel())->getDataGuruByUserId($_0xa0ac, $_0x8d7f->id_tp ?? 1, $_0x8974->id_smt ?? 1);
 goto L_8d700;
 L_e563f:
 $_0x8974 = $_0xfdd0->smt_active;
 goto L_950cb;
 L_8d700:
 if (!$_0x84fe) {
 $this->guruContextCached = true;
 $this->guruContextData = null;
 return null;
 }
 goto L_ec113;
 L_806c3:
 $_0x8d7f = $_0xfdd0->tp_active;
 goto L_e563f;
 L_c5e13:
 $_0xa0ac = $_0x4715->get("\x69\144\x5f\165\x73\145\x72");
 goto L_202c0;
 L_e3556:
 if ($this->isAdmin()) {
 return null;
 }
 goto L_60938;
 L_d957e:
 $_0x6264 = $this->maybe_unserialize($_0xac2d->mapel_kelas ?? "\x5b\135");
 goto L_1ea46;
 L_9d553:
 $_0xbd05 = [];
 goto L_149e7;
 L_3f08c:
 $_0x4715 = session();
 goto L_c5e13;
 L_149e7:
 if ($_0x6264) {
 foreach ($_0x6264 as $_0x186b) {
 if (isset($_0x186b->id_mapel) && $_0x186b->id_mapel !== '') {
 $_0xb54f[] = (string) $_0x186b->id_mapel;
 }
 if (isset($_0x186b->kelas_mapel) && is_array($_0x186b->kelas_mapel)) {
 foreach ($_0x186b->kelas_mapel as $_0xffe1) {
 $_0xb25f = is_array($_0xffe1) ? $_0xffe1["\x6b\145\x6c\141\x73"] ?? null : $_0xffe1->kelas ?? null;
 if ($_0xb25f !== null && $_0xb25f !== '') {
 $_0xbd05[] = (string) $_0xb25f;
 }
 }
 }
 }
 $_0xb54f = array_values(array_unique($_0xb54f));
 $_0xbd05 = array_values(array_unique($_0xbd05));
 }
 goto L_6fcdc;
 L_7ed99:
 $this->guruContextData = (object) ["\x67\165\x72\165" => $_0x84fe, "\x69\144\x5f\147\x75\162\x75" => $_0x84fe->id_guru, "\x6d\141\x70\145\x6c\137\x69\144\x73" => $_0xb54f, "\x6b\145\x6c\141\x73\137\x69\144\x73" => $_0xbd05];
 goto L_6f906;
 L_202c0:
 $_0xfdd0 = $this->getTpSmt();
 goto L_806c3;
 L_1ea46:
 $_0xb54f = [];
 goto L_9d553;
 L_6fcdc:
 $this->guruContextCached = true;
 goto L_7ed99;
 L_6f906:
 return $this->guruContextData;
 }
 public function index()
 {
 goto L_e6a7b;
 L_5abc4:
 $_0x59fb["\x73\145\x73\163\x69\157\x6e\137\x69\144"] = session_id();
 goto L_10b7e;
 L_e6a7b:
 $_0x5069 = (object) ["\x69\144" => session()->get("\x69\144\x5f\165\x73\145\x72"), "\x75\163\x65\162\x6e\141\x6d\145" => session()->get("\x75\163\x65\162\x6e\141\x6d\145")];
 goto L_4c73c;
 L_4c73c:
 $_0x59fb = ["\x75\163\x65\162" => $_0x5069, "\x6a\165\x64\165\x6c" => "\x52\145\x6b\141\x70\40\x48\141\x73\151\x6c\40\x50\145\x6e\151\x6c\141\x69\141\x6e", "\x73\165\x62\152\x75\144\x75\154" => "\x50\145\x6e\151\x6c\141\x69\141\x6e", "\x73\145\x74\164\x69\156\x67" => (new \App\Models\DashboardModel())->getSetting()];
 goto L_98f0f;
 L_10b7e:
 $_0x7182 = $this->isAdmin();
 goto L_990c1;
 L_3111e:
 $_0x59fb["\x74\160\x5f\141\x63\164\x69\166\x65"] = $_0x28f0;
 goto L_77683;
 L_9e740:
 $_0x4733 = $_0x968b->smt_active;
 goto L_a3b9c;
 L_98f0f:
 $_0x968b = $this->getTpSmt();
 goto L_ffcb8;
 L_a3b9c:
 $_0x59fb["\x74\160"] = $_0x968b->tp;
 goto L_3111e;
 L_990c1:
 $_0x59fb["\x69\163\x5f\141\x64\155\x69\156"] = $_0x7182;
 goto L_aa039;
 L_9d463:
 $_0x59fb["\x72\145\x6b\141\x70\163"] = $this->cekRekapSiswa();
 goto L_5abc4;
 L_77683:
 $_0x59fb["\x73\155\x74"] = $_0x968b->smt;
 goto L_ac70b;
 L_ac70b:
 $_0x59fb["\x73\155\x74\137\x61\143\x74\151\x76\145"] = $_0x4733;
 goto L_9d463;
 L_ffcb8:
 $_0x28f0 = $_0x968b->tp_active;
 goto L_9e740;
 L_aa039:
 if ($_0x7182) {
 $_0x59fb["\x69\144\x5f\147\x75\162\x75"] = '';
 $_0x59fb["\x6b\145\x6c\141\x73\137\x67\165\x72\165"] = [];
 return view("\x63\142\x74\57\x72\145\x6b\141\x70\57\x72\145\x6b\141\x70", $_0x59fb);
 } else {
 $_0x5ded = $this->getGuruContext();
 $_0x59fb["\x6b\145\x6c\141\x73\137\x67\165\x72\165"] = $_0x5ded ? $_0x5ded->kelas_ids : [];
 $_0x59fb["\x67\165\x72\165"] = $_0x5ded ? $_0x5ded->guru : null;
 $_0x59fb["\x69\144\x5f\147\x75\162\x75"] = $_0x5ded ? $_0x5ded->id_guru : '';
 return view("\x63\142\x74\57\x72\145\x6b\141\x70\57\x72\145\x6b\141\x70", $_0x59fb);
 }
 }
 public function get_count()
 {
 goto L_9a211;
 L_fb5ab:
 $_0xecb2 = ["\x73\165\x63\143\x65\163\x73" => true, "\x6a\141\x64\167\x61\154" => $_0x2e92, "\x72\145\x6b\141\x70" => $_0x255b];
 goto L_6a8a1;
 L_2e773:
 $_0x5a80 = $this->getGuruContext();
 goto L_650c8;
 L_6a8a1:
 return $this->response->setJSON($_0xecb2);
 L_9a211:
 $_0x7e95 = \Config\Database::connect();
 goto L_2e773;
 L_2760b:
 if ($_0x5a80) {
 $_0xbbd1 = $_0x5a80->id_guru;
 $_0x7647 = $_0x5a80->mapel_ids;
 $_0x57e4 = $_0x7e95->table("\x63\142\x74\137\x6a\141\x64\167\x61\154\x20\142")->join("\x63\142\x74\137\x62\141\x6e\153\x5f\163\x6f\141\x6c\40\x61", "\x62\56\x69\144\x5f\142\x61\156\x6b\75\x61\56\x69\144\x5f\142\x61\156\x6b", "\x6c\145\x66\164")->groupStart()->where("\x61\56\x62\141\x6e\153\x5f\147\x75\162\x75\137\x69\144", $_0xbbd1);
 if (!empty($_0x7647)) {
 $_0x57e4->orWhereIn("\x61\56\x62\141\x6e\153\x5f\155\x61\160\x65\154\x5f\151\x64", $_0x7647);
 }
 $_0x57e4->groupEnd();
 $_0x2e92 = $_0x57e4->countAllResults();
 $_0xa28e = $_0x7e95->table("\x63\142\x74\137\x72\145\x6b\141\x70\137\x6a\141\x64\167\x61\154\x20\141")->select("\x61\56\x69\144\x5f\152\x61\144\x77\141\x6c")->join("\x63\142\x74\137\x62\141\x6e\153\x5f\163\x6f\141\x6c\40\x62", "\x62\56\x69\144\x5f\142\x61\156\x6b\75\x61\56\x69\144\x5f\142\x61\156\x6b", "\x6c\145\x66\164")->groupStart()->where("\x61\56\x69\144\x5f\147\x75\162\x75", $_0xbbd1)->orWhere("\x62\56\x62\141\x6e\153\x5f\147\x75\162\x75\137\x69\144", $_0xbbd1);
 if (!empty($_0x7647)) {
 $_0xa28e->orWhereIn("\x61\56\x69\144\x5f\155\x61\160\x65\154", $_0x7647);
 $_0xa28e->orWhereIn("\x62\56\x62\141\x6e\153\x5f\155\x61\160\x65\154\x5f\151\x64", $_0x7647);
 }
 $_0xa28e->groupEnd();
 $_0xb21c = $_0xa28e->get()->getResult();
 $_0x598d = array_values(array_unique(array_filter(array_column($_0xb21c, "\x69\144\x5f\152\x61\144\x77\141\x6c"))));
 $_0x6f24 = $_0x7e95->table("\x63\142\x74\137\x72\145\x6b\141\x70\137\x73\151\x73\167\x61\40\x61")->select("\x61\56\x69\144\x5f\152\x61\144\x77\141\x6c")->join("\x63\142\x74\137\x62\141\x6e\153\x5f\163\x6f\141\x6c\40\x62", "\x62\56\x69\144\x5f\142\x61\156\x6b\75\x61\56\x69\144\x5f\142\x61\156\x6b", "\x6c\145\x66\164")->groupStart()->where("\x62\56\x62\141\x6e\153\x5f\147\x75\162\x75\137\x69\144", $_0xbbd1);
 if (!empty($_0x7647)) {
 $_0x6f24->orWhereIn("\x62\56\x62\141\x6e\153\x5f\155\x61\160\x65\154\x5f\151\x64", $_0x7647);
 }
 $_0x6f24->groupEnd();
 $_0xe9a2 = $_0x6f24->distinct()->get()->getResult();
 $_0xa9c7 = array_column($_0xe9a2, "\x69\144\x5f\152\x61\144\x77\141\x6c");
 $_0x598d = array_values(array_unique(array_filter(array_merge($_0x598d, $_0xa9c7))));
 $_0x255b = count($_0x598d);
 } elseif ($_0xba75) {
 $_0x2e92 = $_0x7e95->table("\x63\142\x74\137\x6a\141\x64\167\x61\154\x20\142")->join("\x63\142\x74\137\x62\141\x6e\153\x5f\163\x6f\141\x6c\40\x61", "\x62\56\x69\144\x5f\142\x61\156\x6b\75\x61\56\x69\144\x5f\142\x61\156\x6b\40\x41\116\x44\40\x61\56\x62\141\x6e\153\x5f\147\x75\162\x75\137\x69\144\x3d" . $_0x7e95->escape($_0xba75))->countAllResults();
 $_0x7e14 = $_0x7e95->table("\x63\142\x74\137\x72\145\x6b\141\x70\137\x73\151\x73\167\x61")->select("\x69\144\x5f\152\x61\144\x77\141\x6c")->distinct()->get()->getResult();
 $_0xb21c = $_0x7e95->table("\x63\142\x74\137\x72\145\x6b\141\x70\137\x6a\141\x64\167\x61\154")->select("\x69\144\x5f\152\x61\144\x77\141\x6c")->where("\x69\144\x5f\147\x75\162\x75", $_0xba75)->get()->getResult();
 $_0x598d = array_column($_0xb21c, "\x69\144\x5f\152\x61\144\x77\141\x6c");
 foreach ($_0x7e14 as $_0x64f9) {
 if (!in_array($_0x64f9->id_jadwal, $_0x598d)) {
 $_0x598d[] = $_0x64f9->id_jadwal;
 }
 }
 $_0x255b = count($_0x598d);
 } else {
 $_0x2e92 = $_0x7e95->table("\x63\142\x74\137\x6a\141\x64\167\x61\154")->countAllResults();
 $_0x255b = $_0x7e95->table("\x63\142\x74\137\x72\145\x6b\141\x70\137\x73\151\x73\167\x61")->select("\x69\144\x5f\152\x61\144\x77\141\x6c")->distinct()->countAllResults();
 }
 goto L_fb5ab;
 L_650c8:
 $_0xba75 = $this->request->getGet("\x69\144");
 goto L_2760b;
 }
 public function get_jadwal()
 {
 goto L_fffce;
 L_16a31:
 $_0x59c8 = $this->request->getGet("\x70\141\x67\145");
 goto L_c6591;
 L_9ce45:
 if ($_0x59c8) {
 $_0xf68c->limit($_0xb549, $_0xb715);
 } else if (!empty($_0x1089)) {
 $_0xf68c->whereIn("\x63\142\x74\137\x6a\141\x64\167\x61\154\x2e\151\x64\137\x6a\141\x64\167\x61\154", $_0x1089);
 }
 goto L_c02c8;
 L_5764b:
 $_0xf68c = $_0xc6c1->table("\x63\142\x74\137\x6a\141\x64\167\x61\154");
 goto L_3dbdd;
 L_64a10:
 $_0xb417 = (object) ["\x69\144" => session()->get("\x69\144\x5f\165\x73\145\x72"), "\x75\163\x65\162\x6e\141\x6d\145" => session()->get("\x75\163\x65\162\x6e\141\x6d\145")];
 goto L_a5825;
 L_bac32:
 $_0xf68c->join("\x6d\141\x73\164\x65\162\x5f\163\x6d\164", "\x6d\141\x73\164\x65\162\x5f\163\x6d\164\x2e\151\x64\137\x73\155\x74\40\x3d\40\x63\142\x74\137\x6a\141\x64\167\x61\154\x2e\151\x64\137\x73\155\x74", "\x6c\145\x66\164");
 goto L_da2a8;
 L_8cbe6:
 $_0xf68c->join("\x6d\141\x73\164\x65\162\x5f\164\x70", "\x6d\141\x73\164\x65\162\x5f\164\x70\56\x69\144\x5f\164\x70\40\x3d\40\x63\142\x74\137\x6a\141\x64\167\x61\154\x2e\151\x64\137\x74\160", "\x6c\145\x66\164");
 goto L_bac32;
 L_08116:
 $_0xbd85 = ["\x73\165\x63\143\x65\163\x73" => true, "\x6a\141\x64\167\x61\154" => $_0xd98c ? array_values(json_decode(json_encode($_0xd98c), true)) : [], "\x74\157\x74\141\x6c" => $_0x811f, "\x70\145\x6e\147\x61\167\x61\163" => $_0xb6be, "\x6b\145\x6c\141\x73\145\x73" => $_0x301a, "\x63\142\x74\163\x69\163\x77\141" => (array) $_0x37cc];
 goto L_5ed77;
 L_fffce:
 $_0xc6c1 = \Config\Database::connect();
 goto L_64a10;
 L_da2a8:
 $_0xf68c->join("\x63\142\x74\137\x62\141\x6e\153\x5f\163\x6f\141\x6c", "\x63\142\x74\137\x62\141\x6e\153\x5f\163\x6f\141\x6c\56\x69\144\x5f\142\x61\156\x6b\40\x3d\40\x63\142\x74\137\x6a\141\x64\167\x61\154\x2e\151\x64\137\x62\141\x6e\153", "\x6c\145\x66\164");
 goto L_b4684;
 L_33998:
 $_0x1089 = $this->request->getGet("\x69\144\x73") ? json_decode($this->request->getGet("\x69\144\x73")) : [];
 goto L_5764b;
 L_4fe99:
 $_0x811f = 0;
 goto L_c974b;
 L_c974b:
 if ($_0xd98c) {
 $_0x572b = array_column($_0xd98c, "\x69\144\x5f\152\x61\144\x77\141\x6c");
 $_0x82f6 = $_0xc6c1->table("\x63\142\x74\137\x6a\141\x64\167\x61\154")->join("\x63\142\x74\137\x62\141\x6e\153\x5f\163\x6f\141\x6c", "\x63\142\x74\137\x62\141\x6e\153\x5f\163\x6f\141\x6c\56\x69\144\x5f\142\x61\156\x6b\40\x3d\40\x63\142\x74\137\x6a\141\x64\167\x61\154\x2e\151\x64\137\x62\141\x6e\153", "\x6c\145\x66\164");
 if ($_0x62c6) {
 $_0x82f6->groupStart();
 $_0x82f6->where("\x63\142\x74\137\x62\141\x6e\153\x5f\163\x6f\141\x6c\56\x62\141\x6e\153\x5f\147\x75\162\x75\137\x69\144", $_0x62c6->id_guru);
 if (!empty($_0x62c6->mapel_ids)) {
 $_0x82f6->orWhereIn("\x63\142\x74\137\x62\141\x6e\153\x5f\163\x6f\141\x6c\56\x62\141\x6e\153\x5f\155\x61\160\x65\154\x5f\151\x64", $_0x62c6->mapel_ids);
 }
 $_0x82f6->groupEnd();
 }
 if (!empty($_0x1089) && !$_0x59c8) {
 $_0x82f6->whereIn("\x63\142\x74\137\x6a\141\x64\167\x61\154\x2e\151\x64\137\x6a\141\x64\167\x61\154", $_0x1089);
 }
 $_0x811f = $_0x82f6->countAllResults();
 if (count($_0x572b) > 0) {
 $_0x37cc = $_0xc6c1->table("\x63\142\x74\137\x73\151\x73\167\x61")->select("\x69\144\x5f\152\x61\144\x77\141\x6c\54\x69\144\x5f\163\x69\163\x77\141\x2c\155\x75\154\x61\151\x2c\163\x65\154\x65\163\x61\151\x2c\163\x74\141\x74\165\x73\54\x6e\151\x6c\141\x69\137\x69\156\x70\165\x74\54\x70\145\x6c\141\x6e\147\x67\141\x72\141\x6e")->whereIn("\x69\144\x5f\152\x61\144\x77\141\x6c", $_0x572b)->get()->getResult();
 foreach ($_0x37cc as $_0xab6f) {
 if (isset($_0xab6f->nilai_input) && is_string($_0xab6f->nilai_input)) {
 $_0xab6f->nilai_input = $this->maybe_unserialize($_0xab6f->nilai_input);
 $_0xab6f->pelanggaran = $this->maybe_unserialize($_0xab6f->pelanggaran ?? "\x7b\175");
 }
 }
 }
 foreach ($_0xd98c as $_0x8512) {
 $_0x8512->tp = $_0x8512->tp_tahun ?? "\x2d";
 $_0x8512->smt = $_0x8512->nama_smt ?? "\x2d";
 // Fetch Bank
 $_0x8512->bank = $_0xc6c1->table("\x63\142\x74\137\x62\141\x6e\153\x5f\163\x6f\141\x6c")->select("\x63\142\x74\137\x62\141\x6e\153\x5f\163\x6f\141\x6c\56\x73\157\x61\154\x5f\141\x67\141\x6d\141\x2c\143\x62\164\x5f\142\x61\156\x6b\137\x73\157\x61\154\x2e\142\x61\156\x6b\137\x6b\157\x64\145\x2c\143\x62\164\x5f\142\x61\156\x6b\137\x73\157\x61\154\x2e\142\x61\156\x6b\137\x6c\145\x76\145\x6c\54\x63\142\x74\137\x62\141\x6e\153\x5f\163\x6f\141\x6c\56\x62\141\x6e\153\x5f\153\x65\154\x61\163\x2c\143\x62\164\x5f\142\x61\156\x6b\137\x73\157\x61\154\x2e\153\x6b\155\x2c\143\x62\164\x5f\142\x61\156\x6b\137\x73\157\x61\154\x2e\164\x61\155\x70\151\x6c\137\x70\147\x2c\143\x62\164\x5f\142\x61\156\x6b\137\x73\157\x61\154\x2e\164\x61\155\x70\151\x6c\137\x6b\157\x6d\160\x6c\145\x6b\163\x2c\143\x62\164\x5f\142\x61\156\x6b\137\x73\157\x61\154\x2e\164\x61\155\x70\151\x6c\137\x6a\157\x64\157\x68\153\x61\156\x2c\143\x62\164\x5f\142\x61\156\x6b\137\x73\157\x61\154\x2e\164\x61\155\x70\151\x6c\137\x69\163\x69\141\x6e\54\x63\142\x74\137\x62\141\x6e\153\x5f\163\x6f\141\x6c\56\x74\141\x6d\160\x69\154\x5f\145\x73\141\x69\54\x63\142\x74\137\x62\141\x6e\153\x5f\163\x6f\141\x6c\56\x62\141\x6e\153\x5f\147\x75\162\x75\137\x69\144\x2c\40\x6d\141\x73\164\x65\162\x5f\155\x61\160\x65\154\x2e\156\x61\155\x61\137\x6d\141\x70\145\x6c")->join("\x6d\141\x73\164\x65\162\x5f\155\x61\160\x65\154", "\x6d\141\x73\164\x65\162\x5f\155\x61\160\x65\154\x2e\151\x64\137\x6d\141\x70\145\x6c\40\x3d\40\x63\142\x74\137\x62\141\x6e\153\x5f\163\x6f\141\x6c\56\x62\141\x6e\153\x5f\155\x61\160\x65\154\x5f\151\x64", "\x6c\145\x66\164")->where("\x69\144\x5f\142\x61\156\x6b", $_0x8512->id_bank)->get()->getRow();
 if ($_0x8512->bank) {
 $_0x8512->bank->mapel = (object) ["\x6e\141\x6d\141\x5f\155\x61\160\x65\154" => $_0x8512->bank->nama_mapel];
 }
 // Fetch Jenis
 $_0x8512->jenis = $_0xc6c1->table("\x63\142\x74\137\x6a\145\x6e\151\x73")->where("\x69\144\x5f\152\x65\156\x69\163", $_0x8512->id_jenis)->get()->getRow();
 $_0xdfef = $this->maybe_unserialize($_0x8512->bank->bank_kelas ?? []);
 $_0x8512->bank_kelas = is_array($_0xdfef) ? $_0xdfef : [];
 $_0x2ecb = [];
 foreach ($_0x8512->bank_kelas as $_0x5323) {
 if (is_array($_0x5323) && isset($_0x5323["\x6b\145\x6c\141\x73\137\x69\144"])) {
 $_0x2ecb[] = (string) $_0x5323["\x6b\145\x6c\141\x73\137\x69\144"];
 } else if (is_object($_0x5323) && isset($_0x5323->kelas_id)) {
 $_0x2ecb[] = (string) $_0x5323->kelas_id;
 }
 }
 // Fetch sesisiswa (filter TP/SMT sesuai jadwal agar tidak campur/duplikat)
 $_0x4449 = $_0xc6c1->table("\x63\142\x74\137\x73\145\x73\151\x5f\163\x69\163\x77\141")->select("\x63\142\x74\137\x73\145\x73\151\x5f\163\x69\163\x77\141\x2e\163\x69\163\x77\141\x5f\151\x64\54\x20\143\x62\164\x5f\163\x65\163\x69\137\x73\151\x73\167\x61\56\x73\151\x73\167\x61\137\x69\144\x20\141\x73\40\x69\144\x5f\163\x69\163\x77\141\x2c\40\x63\142\x74\137\x73\145\x73\151\x5f\163\x69\163\x77\141\x2e\153\x65\154\x61\163\x5f\151\x64\54\x20\155\x61\163\x74\145\x72\137\x73\151\x73\167\x61\56\x6e\141\x6d\141\x2c\40\x6d\141\x73\164\x65\162\x5f\163\x69\163\x77\141\x2e\156\x69\163\x2c\40\x6d\141\x73\164\x65\162\x5f\163\x69\163\x77\141\x2e\141\x67\141\x6d\141")->join("\x6d\141\x73\164\x65\162\x5f\163\x69\163\x77\141", "\x6d\141\x73\164\x65\162\x5f\163\x69\163\x77\141\x2e\151\x64\137\x73\151\x73\167\x61\40\x3d\40\x63\142\x74\137\x73\145\x73\151\x5f\163\x69\163\x77\141\x2e\163\x69\163\x77\141\x5f\151\x64", "\x6c\145\x66\164");
 if (!empty($_0x8512->id_tp)) {
 $_0x4449->where("\x63\142\x74\137\x73\145\x73\151\x5f\163\x69\163\x77\141\x2e\164\x70\137\x69\144", $_0x8512->id_tp);
 }
 if (!empty($_0x8512->id_smt)) {
 $_0x4449->where("\x63\142\x74\137\x73\145\x73\151\x5f\163\x69\163\x77\141\x2e\163\x6d\164\x5f\151\x64", $_0x8512->id_smt);
 }
 if (!empty($_0x2ecb)) {
 $_0x4449->whereIn("\x63\142\x74\137\x73\145\x73\151\x5f\163\x69\163\x77\141\x2e\153\x65\154\x61\163\x5f\151\x64", $_0x2ecb);
 } else {
 $_0x4449->where("\x31", "\x30", false);
 }
 $_0x16af = $_0x4449->get()->getResult();
 $_0x7493 = [];
 foreach ($_0x16af as $_0x9e24) {
 $_0x9e24->siswa = (object) ["\x69\144\x5f\163\x69\163\x77\141" => $_0x9e24->id_siswa, "\x6e\141\x6d\141" => $_0x9e24->nama, "\x6e\151\x73" => $_0x9e24->nis, "\x61\147\x61\155\x61" => $_0x9e24->agama];
 $_0x7493[] = $_0x9e24;
 }
 $_0xa70f = array_merge($_0xa70f, $_0x2ecb);
 $_0x8512->sesisiswa = array_values($_0x7493);
 }
 if (count($_0x572b) > 0) {
 $_0x9731 = $_0xc6c1->table("\x63\142\x74\137\x70\145\x6e\147\x61\167\x61\163")->whereIn("\x69\144\x5f\152\x61\144\x77\141\x6c", $_0x572b)->get()->getResultArray();
 $_0x2e48 = $_0xc6c1->table("\x6d\141\x73\164\x65\162\x5f\147\x75\162\x75")->get()->getResultArray();
 foreach ($_0x9731 as $_0x5c9b) {
 $_0x66cf = isset($_0x5c9b["\x69\144\x5f\147\x75\162\x75"]) ? explode("\x2c", $_0x5c9b["\x69\144\x5f\147\x75\162\x75"]) : [];
 $_0xc7a5 = ["\x69\144\x5f\160\x65\156\x67\141\x77\141\x73" => $_0x5c9b["\x69\144\x5f\160\x65\156\x67\141\x77\141\x73"] ?? '', "\x69\144\x5f\152\x61\144\x77\141\x6c" => $_0x5c9b["\x69\144\x5f\152\x61\144\x77\141\x6c"] ?? '', "\x69\144\x5f\162\x75\141\x6e\147" => $_0x5c9b["\x69\144\x5f\162\x75\141\x6e\147"] ?? '', "\x69\144\x5f\163\x65\163\x69" => $_0x5c9b["\x69\144\x5f\163\x65\163\x69"] ?? '', "\x70\145\x6e\147\x61\167\x61\163" => []];
 foreach ($_0x66cf as $_0x96e6) {
 $_0x7949 = null;
 foreach ($_0x2e48 as $_0x1336) {
 if ($_0x1336["\x69\144\x5f\147\x75\162\x75"] == $_0x96e6) {
 $_0x7949 = $_0x1336;
 break;
 }
 }
 if ($_0x96e6 != '') {
 $_0x689a = [];
 $_0x689a[$_0x96e6] = $_0x7949 ? $_0x7949["\x6e\141\x6d\141\x5f\147\x75\162\x75"] ?? "\x2d" : "\x2d";
 $_0xc7a5["\x70\145\x6e\147\x61\167\x61\163"][] = $_0x689a;
 }
 }
 $_0xb6be[] = $_0xc7a5;
 }
 }
 }
 goto L_21eb3;
 L_c02c8:
 $_0xd98c = $_0xf68c->get()->getResult();
 goto L_6a315;
 L_21eb3:
 $_0x301a = $_0xc6c1->table("\x6d\141\x73\164\x65\162\x5f\153\x65\154\x61\163")->select("\x69\144\x5f\153\x65\154\x61\163\x2c\153\x6f\144\x65\137\x6b\145\x6c\141\x73\54\x6e\141\x6d\141\x5f\153\x65\154\x61\163")->get()->getResultArray();
 goto L_08116;
 L_3dbdd:
 $_0xf68c->select("\x63\142\x74\137\x6a\141\x64\167\x61\154\x2e\52\x2c\40\x6d\141\x73\164\x65\162\x5f\164\x70\56\x74\141\x68\165\x6e\40\x61\163\x20\164\x70\137\x74\141\x68\165\x6e\54\x20\155\x61\163\x74\145\x72\137\x73\155\x74\56\x6e\141\x6d\141\x5f\163\x6d\164");
 goto L_8cbe6;
 L_5ed77:
 return $this->response->setJSON($_0xbd85);
 L_6a315:
 $_0xb6be = [];
 goto L_e1d68;
 L_e1d68:
 $_0x37cc = [];
 goto L_c38e7;
 L_334e4:
 $_0x62c6 = $this->getGuruContext();
 goto L_16a31;
 L_47e3a:
 if ($_0x59c8) {
 $_0xb549 = (int) $this->request->getGet("\x6c\151\x6d\151\x74");
 $_0xb715 = ((int) $_0x59c8 - 1) * $_0xb549;
 }
 goto L_33998;
 L_b4684:
 if ($_0x62c6) {
 $_0xf68c->groupStart();
 $_0xf68c->where("\x63\142\x74\137\x62\141\x6e\153\x5f\163\x6f\141\x6c\56\x62\141\x6e\153\x5f\147\x75\162\x75\137\x69\144", $_0x62c6->id_guru);
 if (!empty($_0x62c6->mapel_ids)) {
 $_0xf68c->orWhereIn("\x63\142\x74\137\x62\141\x6e\153\x5f\163\x6f\141\x6c\56\x62\141\x6e\153\x5f\155\x61\160\x65\154\x5f\151\x64", $_0x62c6->mapel_ids);
 }
 $_0xf68c->groupEnd();
 }
 goto L_9ce45;
 L_c6591:
 $_0xb549 = 0;
 goto L_c7be0;
 L_c38e7:
 $_0xa70f = [];
 goto L_4fe99;
 L_a5825:
 $_0x9950 = session()->get("\x72\157\x6c\145");
 goto L_334e4;
 L_c7be0:
 $_0xb715 = 0;
 goto L_47e3a;
 }
 public function ekspor_rekap()
 {
 goto L_59ee4;
 L_eedc2:
 return view("\x63\142\x74\57\x72\145\x6b\141\x70\57\x65\153\x73\160\x6f\162\x5f\162\x65\153\x61\160", $_0xfa1b);
 L_ae798:
 $_0xfa1b["\x72\145\x6b\141\x70"] = $_0xc7da;
 goto L_eedc2;
 L_ffc5f:
 $_0xc7da = $this->getRekapWithSiswa($_0xc023, null, $_0x4c26);
 goto L_ae798;
 L_2f7bd:
 $_0xc023 = $this->request->getPost("\x69\144\x5f\152\x61\144\x77\141\x6c");
 goto L_ffc5f;
 L_59ee4:
 $_0x4c26 = $this->request->getPost("\x69\144\x5f\153\x65\154\x61\163");
 goto L_2f7bd;
 }
 public function get_nilai_rekap()
 {
 goto L_d9166;
 L_29122:
 $_0x5765->bank_soal = $this->maybe_unserialize($_0x5765->bank_soal);
 goto L_d124d;
 L_d142a:
 $_0x5765->soal_kompleks = array_values($_0xc2dc);
 goto L_10a55;
 L_f9880:
 $_0x8f54["\x6a\141\x64\167\x61\154\x5f\163\x65\154\x65\143\x74\145\x64"] = $_0x37d1;
 goto L_5769a;
 L_ddf19:
 $_0x8f54["\x6b\145\x6c\141\x73\137\x73\145\x6c\145\x63\164\x65\144"] = $_0x5c6c;
 goto L_f9880;
 L_9fa6d:
 $_0x8f54["\x6b\145\x6c\141\x73"] = $_0x8f52;
 goto L_77284;
 L_e2c27:
 $_0x37d1 = $this->request->getPost("\x69\144\x5f\152\x61\144\x77\141\x6c");
 goto L_7ce54;
 L_9c400:
 $_0x5765->rekapsiswa = (array) $_0x5765->rekapsiswa;
 goto L_98551;
 L_03cf9:
 $_0x779b = [];
 goto L_9c400;
 L_edc7f:
 $_0x5765->rekapsiswa = array_values($_0x5765->rekapsiswa);
 goto L_d7540;
 L_c7f63:
 $_0x8f54["\x61\162\x72\137\x73\151\x73\167\x61"] = $_0x779b;
 goto L_55fac;
 L_f37ce:
 $_0xed4a = array_filter((array) $this->maybe_unserialize($_0x5765->soal_isian), function ($_0xa42e) {
 return is_object($_0xa42e) && isset($_0xa42e->tampilkan) && $_0xa42e->tampilkan == "\x31";
 });
 goto L_605bc;
 L_f4271:
 if (is_array($_0x5765->rekapsiswa)) {
 foreach ($_0x5765->rekapsiswa as $_0xf90c) {
 $_0xf90c->pelanggaran = $this->maybe_unserialize($_0xf90c->pelanggaran ?? "\x7b\175");
 $_0xc029 = $this->maybe_unserialize($_0xf90c->jawaban);
 $_0xaf02 = [];
 if (is_array($_0xc029)) {
 foreach ($_0xc029 as $_0xe72e) {
 if (is_object($_0xe72e)) {
 $_0xaf02[$_0xe72e->id_soal] = $_0xe72e->jawaban_siswa ?? '';
 }
 }
 }
 $_0x1496[] = $_0xaf02;
 }
 }
 goto L_95908;
 L_57d64:
 $_0x5765->soal_esai = array_values($_0xdf19);
 goto L_8647c;
 L_d8e9a:
 $_0x8f54["\x6b\165\x6e\143\x69"] = $_0xb461;
 goto L_9fa6d;
 L_55fac:
 $_0x8f54["\x72\145\x6b\141\x70"] = $_0x5765;
 goto L_ddf19;
 L_63669:
 $_0x1496 = [];
 goto L_f4271;
 L_7481b:
 $_0x5765->jadwal = $this->maybe_unserialize($_0x5765->jadwal);
 goto L_29122;
 L_03851:
 $_0x93c4 = [];
 goto L_01e1c;
 L_ed057:
 $_0xb461 = [];
 goto L_dc784;
 L_29043:
 $_0x8a18 = array_filter((array) $this->maybe_unserialize($_0x5765->soal_jodohkan), function ($_0xa42e) {
 return is_object($_0xa42e) && isset($_0xa42e->tampilkan) && $_0xa42e->tampilkan == "\x31";
 });
 goto L_f37ce;
 L_f6da9:
 $_0xc2dc = array_filter((array) $this->maybe_unserialize($_0x5765->soal_kompleks), function ($_0xa42e) {
 return is_object($_0xa42e) && isset($_0xa42e->tampilkan) && $_0xa42e->tampilkan == "\x31";
 });
 goto L_29043;
 L_01e1c:
 if (is_array($_0x5765->kelas_bank)) {
 foreach ($_0x5765->kelas_bank as $_0x2760) {
 $_0xd4ce = is_array($_0x2760) ? $_0x2760["\x69\144\x5f\153\x65\154\x61\163"] ?? $_0x2760["\x6b\145\x6c\141\x73\137\x69\144"] ?? null : $_0x2760->id_kelas ?? $_0x2760->kelas_id ?? null;
 if ($_0xd4ce) {
 $_0x93c4[] = ["\x6b\145\x6c\141\x73\137\x69\144" => $_0xd4ce];
 }
 }
 }
 goto L_50a19;
 L_7ce54:
 $_0x5765 = $this->getRekapWithSiswa($_0x37d1, null, $_0x5c6c);
 goto L_60fd8;
 L_dc784:
 foreach ($_0x5765->soal_pg as $_0xb9e3) {
 $_0xb461[$_0xb9e3->id_soal] = strtoupper($_0xb9e3->jawaban ?? '');
 }
 goto L_63669;
 L_117fc:
 $_0x5765->soal_isian = array_values($_0xed4a);
 goto L_57d64;
 L_95908:
 $_0xf361 = $this->normalizeData($_0x1496, $_0xb461);
 goto L_37a57;
 L_50a19:
 $_0x5765->bank_kelas = $_0x93c4;
 goto L_e3057;
 L_37a57:
 $_0xfc34 = $this->analyzeData($_0xf361, $_0xb461, $_0x5765->bank_soal->opsi ?? "\x34");
 goto L_03cf9;
 L_4b722:
 $_0x5765->pengawas = $this->maybe_unserialize($_0x5765->pengawas);
 goto L_ed057;
 L_10a55:
 $_0x5765->soal_jodohkan = array_values($_0x8a18);
 goto L_117fc;
 L_c9e45:
 $_0x8f54["\x61\156\x61\154\x69\163\x69\163"] = $_0xfc34;
 goto L_323a0;
 L_d9166:
 $_0x5c6c = $this->request->getPost("\x69\144\x5f\153\x65\154\x61\163");
 goto L_e2c27;
 L_98551:
 foreach ($_0x5765->rekapsiswa as $_0xccd5 => $_0xf90c) {
 $_0xf90c->siswa = $this->maybe_unserialize($_0xf90c->siswa ?? "\x7b\175");
 if (isset($_0x5765->bank_soal->soal_agama) && $_0x5765->bank_soal->soal_agama != "\x2d" && $_0x5765->bank_soal->soal_agama != "\x30" && $_0x5765->bank_soal->soal_agama !== ($_0xf90c->agama ?? $_0xf90c->siswa->agama ?? '')) {
 unset($_0x5765->rekapsiswa[$_0xccd5]);
 } else {
 $_0x779b[] = $_0xf90c->id_siswa;
 }
 }
 goto L_91574;
 L_48db5:
 if (is_array($_0x5765->kelas_bank)) {
 foreach ($_0x5765->kelas_bank as $_0x2760) {
 $_0xd4ce = is_array($_0x2760) ? $_0x2760["\x69\144\x5f\153\x65\154\x61\163"] ?? null : $_0x2760->id_kelas ?? null;
 $_0x685f = is_array($_0x2760) ? $_0x2760["\x6e\141\x6d\141\x5f\153\x65\154\x61\163"] ?? null : $_0x2760->nama_kelas ?? null;
 if ($_0xd4ce && $_0x685f) {
 $_0x8f52[$_0xd4ce] = $_0x685f;
 }
 }
 }
 goto L_4b722;
 L_adcf7:
 $_0x5765->soal_pg = array_values($_0x4d5e);
 goto L_d142a;
 L_91574:
 $_0xfe67 = \Config\Database::connect();
 goto L_89a8c;
 L_2c33d:
 if (count($_0x779b) > 0) {
 $_0x1ad1 = $_0xfe67->table("\x63\142\x74\137\x73\151\x73\167\x61")->select("\x69\144\x5f\152\x61\144\x77\141\x6c\54\x20\151\x64\137\x73\151\x73\167\x61\54\x20\155\x75\154\x61\151\x2c\40\x73\145\x6c\145\x73\141\x69\54\x20\154\x61\155\x61\137\x75\152\x69\141\x6e")->where("\x69\144\x5f\152\x61\144\x77\141\x6c", $_0x37d1)->whereIn("\x69\144\x5f\163\x69\163\x77\141", $_0x779b)->get()->getResult();
 if ($_0x1ad1) {
 foreach ($_0x1ad1 as $_0x5a06) {
 $_0x1a11[$_0x5a06->id_siswa] = $_0x5a06;
 }
 }
 }
 goto L_edc7f;
 L_60fd8:
 if (!$_0x5765) {
 return $this->response->setJSON(["\x73\165\x63\143\x65\163\x73" => false, "\x6d\145\x73\163\x61\147\x65" => "\x44\141\x74\141\x20\162\x65\153\x61\160\x20\164\x69\144\x61\153\x20\144\x69\164\x65\155\x75\153\x61\156"]);
 }
 goto L_7481b;
 L_605bc:
 $_0xdf19 = array_filter((array) $this->maybe_unserialize($_0x5765->soal_esai), function ($_0xa42e) {
 return is_object($_0xa42e) && isset($_0xa42e->tampilkan) && $_0xa42e->tampilkan == "\x31";
 });
 goto L_adcf7;
 L_e3057:
 $_0x4d5e = array_filter((array) $this->maybe_unserialize($_0x5765->soal_pg), function ($_0xa42e) {
 return is_object($_0xa42e) && isset($_0xa42e->tampilkan) && $_0xa42e->tampilkan == "\x31";
 });
 goto L_f6da9;
 L_d124d:
 $_0x5765->kelas_bank = $this->maybe_unserialize($_0x5765->kelas_bank);
 goto L_03851;
 L_d7540:
 $this->createSkorSiswa($_0x5765, false);
 goto L_c9e45;
 L_8647c:
 $_0x8f52 = [];
 goto L_48db5;
 L_323a0:
 $_0x8f54["\x64\165\x72\141\x73\151\x5f\163\x69\163\x77\141"] = $_0x1a11;
 goto L_d8e9a;
 L_89a8c:
 $_0x1a11 = [];
 goto L_2c33d;
 L_5769a:
 return $this->response->setJSON($_0x8f54);
 L_77284:
 $_0x8f54["\x73\165\x63\143\x65\163\x73"] = true;
 goto L_c7f63;
 }
 public function get_rekap()
 {
 goto L_17800;
 L_2083d:
 if ($_0xd1b5) {
 $_0x4449 = $_0xe011->table("\x63\142\x74\137\x72\145\x6b\141\x70\137\x6a\141\x64\167\x61\154\x20\141")->select("\x61\56\x69\144\x5f\152\x61\144\x77\141\x6c")->join("\x63\142\x74\137\x62\141\x6e\153\x5f\163\x6f\141\x6c\40\x62", "\x62\56\x69\144\x5f\142\x61\156\x6b\75\x61\56\x69\144\x5f\142\x61\156\x6b", "\x6c\145\x66\164")->groupStart()->where("\x61\56\x69\144\x5f\147\x75\162\x75", $_0xd1b5->id_guru)->orWhere("\x62\56\x62\141\x6e\153\x5f\147\x75\162\x75\137\x69\144", $_0xd1b5->id_guru);
 if (!empty($_0xd1b5->mapel_ids)) {
 $_0x4449->orWhereIn("\x61\56\x69\144\x5f\155\x61\160\x65\154", $_0xd1b5->mapel_ids);
 $_0x4449->orWhereIn("\x62\56\x62\141\x6e\153\x5f\155\x61\160\x65\154\x5f\151\x64", $_0xd1b5->mapel_ids);
 }
 $_0x4449->groupEnd();
 $_0x5064 = $_0x4449->get()->getResult();
 $_0xa641 = array_values(array_unique(array_filter(array_column($_0x5064, "\x69\144\x5f\152\x61\144\x77\141\x6c"))));
 $_0xb1b7 = $_0xe011->table("\x63\142\x74\137\x72\145\x6b\141\x70\137\x73\151\x73\167\x61\40\x61")->select("\x61\56\x69\144\x5f\152\x61\144\x77\141\x6c")->join("\x63\142\x74\137\x62\141\x6e\153\x5f\163\x6f\141\x6c\40\x62", "\x62\56\x69\144\x5f\142\x61\156\x6b\75\x61\56\x69\144\x5f\142\x61\156\x6b", "\x6c\145\x66\164")->groupStart()->where("\x62\56\x62\141\x6e\153\x5f\147\x75\162\x75\137\x69\144", $_0xd1b5->id_guru);
 if (!empty($_0xd1b5->mapel_ids)) {
 $_0xb1b7->orWhereIn("\x62\56\x62\141\x6e\153\x5f\155\x61\160\x65\154\x5f\151\x64", $_0xd1b5->mapel_ids);
 }
 $_0xb1b7->groupEnd();
 $_0x5a4c = $_0xb1b7->distinct()->get()->getResult();
 $_0xe19d = array_column($_0x5a4c, "\x69\144\x5f\152\x61\144\x77\141\x6c");
 $_0xa641 = array_values(array_unique(array_filter(array_merge($_0xa641, $_0xe19d))));
 } else {
 // Get unique id_jadwal from cbt_rekap_siswa
 $_0x5064 = $_0xe011->table("\x63\142\x74\137\x72\145\x6b\141\x70\137\x73\151\x73\167\x61")->select("\x69\144\x5f\152\x61\144\x77\141\x6c")->distinct()->get()->getResult();
 $_0xa641 = array_column($_0x5064, "\x69\144\x5f\152\x61\144\x77\141\x6c");
 }
 goto L_a09ac;
 L_7bd5a:
 $_0x1165 = [];
 goto L_9e5ec;
 L_59251:
 return $this->response->setJSON($_0x703b);
 L_ff6c3:
 $_0x9dfe = $_0xe011->table("\x6d\141\x73\164\x65\162\x5f\153\x65\154\x61\163")->select("\x69\144\x5f\153\x65\154\x61\163\x2c\153\x6f\144\x65\137\x6b\145\x6c\141\x73\54\x6e\141\x6d\141\x5f\153\x65\154\x61\163")->get()->getResultArray();
 goto L_028ac;
 L_42f8d:
 $_0x73c9 = $this->request->getGet("\x69\144\x73") ? json_decode($this->request->getGet("\x69\144\x73")) : [];
 goto L_cf404;
 L_1bd79:
 // Processing classes
 $_0xeadb = [];
 goto L_5e374;
 L_b3486:
 $_0x81b2 = [];
 goto L_7bd5a;
 L_b78ce:
 $_0x9717 = 0;
 goto L_47fad;
 L_cf404:
 if ($_0xda93) {
 $_0xd09d = array_slice($_0xa641, $_0x9717, $_0xce3f);
 } else if (!empty($_0x73c9)) {
 $_0xd09d = $_0x73c9;
 }
 goto L_b3486;
 L_fe4a2:
 $_0x3b47 = session()->get("\x72\157\x6c\145");
 goto L_ac059;
 L_5e374:
 foreach ($_0x1165 as $_0xcb93 => $_0xd12b) {
 foreach ($_0xd12b as $_0x9ab0) {
 if (!in_array($_0x9ab0, $_0xeadb)) {
 $_0xeadb[] = $_0x9ab0;
 }
 }
 }
 goto L_ff6c3;
 L_41dfc:
 $_0x944b = (object) ["\x69\144" => session()->get("\x69\144\x5f\165\x73\145\x72"), "\x75\163\x65\162\x6e\141\x6d\145" => session()->get("\x75\163\x65\162\x6e\141\x6d\145")];
 goto L_fe4a2;
 L_9e5ec:
 if (count($_0xd09d) > 0) {
 $_0x50a3 = [];
 $_0xc4b4 = $_0xe011->table("\x63\142\x74\137\x72\145\x6b\141\x70\137\x6a\141\x64\167\x61\154\x20\141")->select("\x61\56\x69\144\x5f\162\x65\153\x61\160\x2c\141\x2e\151\x64\137\x74\160\x2c\141\x2e\164\x70\54\x61\56\x69\144\x5f\163\x6d\164\x2c\141\x2e\163\x6d\164\x2c\141\x2e\151\x64\137\x6a\141\x64\167\x61\154\x2c\141\x2e\152\x61\144\x77\141\x6c\54\x61\56\x69\144\x5f\142\x61\156\x6b\54\x61\56\x69\144\x5f\152\x65\156\x69\163\x2c\141\x2e\153\x6f\144\x65\137\x6a\145\x6e\151\x73\54\x61\56\x74\147\x6c\137\x6d\165\x6c\141\x69\54\x61\56\x74\147\x6c\137\x73\145\x6c\145\x73\141\x69\54\x61\56\x62\141\x6e\153\x5f\163\x6f\141\x6c\54\x61\56\x6b\157\x64\145\x5f\142\x61\156\x6b\54\x61\56\x6c\145\x76\145\x6c\137\x62\141\x6e\153\x20\141\x73\40\x62\141\x6e\153\x5f\154\x65\166\x65\154\x2c\141\x2e\153\x65\154\x61\163\x5f\142\x61\156\x6b\54\x61\56\x69\144\x5f\147\x75\162\x75\54\x61\56\x6e\141\x6d\141\x5f\155\x61\160\x65\154\x2c\141\x2e\160\x65\156\x67\141\x77\141\x73")->join("\x63\142\x74\137\x62\141\x6e\153\x5f\163\x6f\141\x6c\40\x62", "\x62\56\x69\144\x5f\142\x61\156\x6b\75\x61\56\x69\144\x5f\142\x61\156\x6b", "\x6c\145\x66\164")->whereIn("\x61\56\x69\144\x5f\152\x61\144\x77\141\x6c", $_0xd09d);
 if ($_0xd1b5) {
 $_0xc4b4->groupStart();
 $_0xc4b4->where("\x61\56\x69\144\x5f\147\x75\162\x75", $_0xd1b5->id_guru);
 $_0xc4b4->orWhere("\x62\56\x62\141\x6e\153\x5f\147\x75\162\x75\137\x69\144", $_0xd1b5->id_guru);
 if (!empty($_0xd1b5->mapel_ids)) {
 $_0xc4b4->orWhereIn("\x61\56\x69\144\x5f\155\x61\160\x65\154", $_0xd1b5->mapel_ids);
 $_0xc4b4->orWhereIn("\x62\56\x62\141\x6e\153\x5f\155\x61\160\x65\154\x5f\151\x64", $_0xd1b5->mapel_ids);
 }
 $_0xc4b4->groupEnd();
 }
 $_0xcf5e = $_0xc4b4->get()->getResult();
 foreach ($_0xd09d as $_0x3dc6) {
 $_0x50a3[$_0x3dc6] = (object) ["\x69\144\x5f\152\x61\144\x77\141\x6c" => ''];
 }
 foreach ($_0xcf5e as $_0x1450) {
 $_0x50a3[$_0x1450->id_jadwal] = $_0x1450;
 }
 $_0xbebe = $_0xe011->table("\x63\142\x74\137\x72\145\x6b\141\x70\137\x73\151\x73\167\x61")->select("\x69\144\x5f\162\x65\153\x61\160\x5f\163\x69\163\x77\141\x2c\151\x64\137\x73\151\x73\167\x61\54\x69\144\x5f\164\x70\54\x74\160\x2c\151\x64\137\x73\155\x74\54\x73\155\x74\54\x69\144\x5f\142\x61\156\x6b\54\x73\151\x73\167\x61\54\x6e\141\x6d\141\x5f\163\x69\163\x77\141\x2c\151\x64\137\x6a\141\x64\167\x61\154\x2c\156\x69\154\x61\151\x5f\151\x6e\160\x75\164\x2c\155\x75\154\x61\151\x2c\163\x65\154\x65\163\x61\151\x2c\151\x64\137\x6b\145\x6c\141\x73\40\x61\163\x20\153\x65\154\x61\163\x5f\151\x64")->whereIn("\x69\144\x5f\152\x61\144\x77\141\x6c", $_0xd09d)->get()->getResult();
 if ($_0xbebe) {
 foreach ($_0xbebe as $_0xe469) {
 if (!isset($_0x1165[$_0xe469->id_jadwal])) {
 $_0x1165[$_0xe469->id_jadwal] = [];
 }
 if (!in_array($_0xe469->kelas_id, $_0x1165[$_0xe469->id_jadwal])) {
 $_0x1165[$_0xe469->id_jadwal][] = $_0xe469->kelas_id;
 }
 if (!is_object($_0xe469->siswa)) {
 $_0xe469->siswa = $this->maybe_unserialize($_0xe469->siswa ?? "\x7b\175");
 }
 if (!is_object($_0xe469->nilai_input)) {
 $_0xe469->nilai_input = $this->maybe_unserialize($_0xe469->nilai_input);
 }
 if (isset($_0x50a3[$_0xe469->id_jadwal])) {
 if ($_0x50a3[$_0xe469->id_jadwal]->id_jadwal == '') {
 $_0x4cc5 = (object) ["\x69\144\x5f\162\x65\153\x61\160" => rand(-99999999, -11111111), "\x69\144\x5f\164\x70" => $_0xe469->id_tp, "\x74\160" => $_0xe469->tp, "\x69\144\x5f\163\x6d\164" => $_0xe469->id_smt, "\x73\155\x74" => $_0xe469->smt, "\x69\144\x5f\152\x61\144\x77\141\x6c" => $_0xe469->id_jadwal, "\x6a\141\x64\167\x61\154" => null, "\x69\144\x5f\142\x61\156\x6b" => $_0xe469->id_bank];
 $_0x50a3[$_0xe469->id_jadwal] = $_0x4cc5;
 }
 if (!isset($_0x50a3[$_0xe469->id_jadwal]->rekapsiswa)) {
 $_0x50a3[$_0xe469->id_jadwal]->rekapsiswa = [];
 }
 $_0x50a3[$_0xe469->id_jadwal]->rekapsiswa[] = $_0xe469;
 }
 }
 }
 // Post-process rekaps
 foreach ($_0x50a3 as $_0x38a8) {
 if ($_0x38a8->id_jadwal != '') {
 $_0x38a8->jadwal = $this->maybe_unserialize($_0x38a8->jadwal ?? "\x7b\175");
 $_0x38a8->bank = $this->maybe_unserialize($_0x38a8->bank_soal ?? "\x7b\175");
 $_0xd1f3 = $this->maybe_unserialize($_0x38a8->kelas_bank ?? "\x5b\135");
 $_0x38a8->pengawas = $this->maybe_unserialize($_0x38a8->pengawas ?? "\x5b\135");
 unset($_0x38a8->bank_soal);
 unset($_0x38a8->kelas_bank);
 $_0x524b = [];
 if ($_0xd1f3 && (is_array($_0xd1f3) || is_object($_0xd1f3))) {
 foreach ($_0xd1f3 as $_0x23c5) {
 $_0xe979 = is_array($_0x23c5) ? $_0x23c5["\x69\144\x5f\153\x65\154\x61\163"] ?? $_0x23c5["\x6b\145\x6c\141\x73\137\x69\144"] ?? null : (is_object($_0x23c5) ? $_0x23c5->id_kelas ?? $_0x23c5->kelas_id ?? null : null);
 if ($_0xe979 !== null && $_0xe979 !== '') {
 $_0x524b[] = ["\x6b\145\x6c\141\x73\137\x69\144" => $_0xe979];
 }
 }
 } else {
 foreach ($_0x1165[$_0x38a8->id_jadwal] ?? [] as $_0x9f8f) {
 $_0x524b[] = ["\x6b\145\x6c\141\x73\137\x69\144" => $_0x9f8f];
 }
 }
 $_0x38a8->bank_kelas = $_0x524b;
 }
 }
 $_0x81b2 = array_values($_0x50a3);
 }
 goto L_1bd79;
 L_ac059:
 $_0xd1b5 = $this->getGuruContext();
 goto L_2bf6e;
 L_47fad:
 if ($_0xda93) {
 $_0xce3f = (int) $this->request->getGet("\x6c\151\x6d\151\x74");
 $_0x9717 = ((int) $_0xda93 - 1) * $_0xce3f;
 }
 goto L_2083d;
 L_a4b19:
 $_0xce3f = 0;
 goto L_b78ce;
 L_2bf6e:
 $_0xda93 = $this->request->getGet("\x70\141\x67\145");
 goto L_a4b19;
 L_17800:
 $_0xe011 = \Config\Database::connect();
 goto L_41dfc;
 L_a09ac:
 $_0xd09d = [];
 goto L_42f8d;
 L_028ac:
 $_0x703b = ["\x73\165\x63\143\x65\163\x73" => true, "\x72\145\x6b\141\x70" => array_values(json_decode(json_encode($_0x81b2), true)), "\x74\157\x74\141\x6c" => count($_0xa641), "\x6b\145\x6c\141\x73\145\x73" => $_0x9dfe, "\x62\141\x6e\153\x73\137\x6b\154\x73" => $_0x1165];
 goto L_59251;
 }
 public function rekap()
 {
 goto L_b42ca;
 L_a2b88:
 $_0x2855 = $_0xeee0 ? json_decode($_0xeee0, true) : [];
 goto L_8aa0f;
 L_412f2:
 if (!empty($_0x707d)) {
 $_0xafbe = $_0xf37a->table("\x63\142\x74\137\x62\141\x6e\153\x5f\163\x6f\141\x6c\40\x62")->select("\x62\56\x2a\54\x20\147\x2e\156\x61\155\x61\137\x67\165\x72\165\x2c\40\x6d\56\x6e\141\x6d\141\x5f\155\x61\160\x65\154\x2c\40\x6d\56\x6b\157\x64\145\x20\141\x73\40\x6b\157\x64\145\x5f\155\x61\160\x65\154")->join("\x6d\141\x73\164\x65\162\x5f\147\x75\162\x75\40\x67", "\x67\56\x69\144\x5f\147\x75\162\x75\75\x62\56\x62\141\x6e\153\x5f\147\x75\162\x75\137\x69\144", "\x6c\145\x66\164")->join("\x6d\141\x73\164\x65\162\x5f\155\x61\160\x65\154\x20\155", "\x6d\56\x69\144\x5f\155\x61\160\x65\154\x3d\142\x2e\142\x61\156\x6b\137\x6d\141\x70\145\x6c\137\x69\144", "\x6c\145\x66\164")->whereIn("\x62\56\x69\144\x5f\142\x61\156\x6b", (array) $_0x707d)->get()->getResult();
 foreach ($_0xafbe as $_0xb4de) {
 $_0xb4de->guru = (object) ["\x69\144\x5f\147\x75\162\x75" => $_0xb4de->bank_guru_id, "\x6e\141\x6d\141\x5f\147\x75\162\x75" => $_0xb4de->nama_guru];
 $_0xb4de->mapel = (object) ["\x69\144\x5f\155\x61\160\x65\154" => $_0xb4de->bank_mapel_id, "\x6e\141\x6d\141\x5f\155\x61\160\x65\154" => $_0xb4de->nama_mapel, "\x6b\157\x64\145" => $_0xb4de->kode_mapel];
 $_0xb4de->soal = $_0xf37a->table("\x63\142\x74\137\x73\157\x61\154")->where("\x62\141\x6e\153\x5f\151\x64", $_0xb4de->id_bank)->get()->getResult();
 $_0xdae2[] = (array) $_0xb4de;
 }
 }
 goto L_fe22b;
 L_30344:
 return $this->response->setJSON($_0x8385);
 L_93856:
 $_0xe762 = [];
 goto L_81d5a;
 L_96b00:
 if (is_array($_0x772d)) {
 foreach ($_0x772d as $_0x80dc) {
 try {
 $_0xa994 = [];
 $_0x6a1e = '';
 $_0x3689 = '';
 $_0x8aab = '';
 foreach ($_0x80dc as $_0xd623 => $_0xc8d6) {
 if ($_0xd623 == "\x69\144\x73") {
 $_0x2e5e = json_decode($_0xc8d6, true);
 if (json_last_error() !== JSON_ERROR_NONE || !is_array($_0x2e5e)) {
 throw new Exception("\x45\162\x72\157\x72\40\x64\145\x63\157\x64\151\x6e\147\x20\112\x53\117\x4e\40\x69\156\x20\47\x69\144\x73\47\x20\146\x69\145\x6c\144\x2e");
 }
 $_0x6a1e = $_0x2e5e["\x69\144\x5f\142\x61\156\x6b"] ?? '';
 $_0x3689 = $_0x2e5e["\x69\144\x5f\152\x65\156\x69\163"] ?? '';
 $_0x37b6 = $_0x2e5e["\x69\144\x5f\152\x61\144\x77\141\x6c"] ?? '';
 $_0x8aab = $_0x2e5e["\x69\144\x5f\162\x65\153\x61\160"] ?? '';
 if (!in_array($_0x37b6, $_0xf994, true)) {
 $_0xf994[] = $_0x37b6;
 }
 foreach ($_0x2e5e as $_0x58fe => $_0x4456) {
 if ($_0x58fe != "\x69\144\x5f\162\x65\153\x61\160") {
 $_0xa994[$_0x58fe] = $_0x4456;
 }
 }
 } else {
 $_0xa994[$_0xd623] = $_0xc8d6;
 }
 }
 $_0x5ed5 = array_search($_0x6a1e, array_column($_0xdae2, "\x69\144\x5f\142\x61\156\x6b"));
 if ($_0x5ed5 === false && !empty($_0x6a1e)) {
 $_0xb4de = $_0xf37a->table("\x63\142\x74\137\x62\141\x6e\153\x5f\163\x6f\141\x6c\40\x62")->select("\x62\56\x2a\54\x20\147\x2e\156\x61\155\x61\137\x67\165\x72\165\x2c\40\x6d\56\x6e\141\x6d\141\x5f\155\x61\160\x65\154\x2c\40\x6d\56\x6b\157\x64\145\x20\141\x73\40\x6b\157\x64\145\x5f\155\x61\160\x65\154")->join("\x6d\141\x73\164\x65\162\x5f\147\x75\162\x75\40\x67", "\x67\56\x69\144\x5f\147\x75\162\x75\75\x62\56\x62\141\x6e\153\x5f\147\x75\162\x75\137\x69\144", "\x6c\145\x66\164")->join("\x6d\141\x73\164\x65\162\x5f\155\x61\160\x65\154\x20\155", "\x6d\56\x69\144\x5f\155\x61\160\x65\154\x3d\142\x2e\142\x61\156\x6b\137\x6d\141\x70\145\x6c\137\x69\144", "\x6c\145\x66\164")->where("\x62\56\x69\144\x5f\142\x61\156\x6b", $_0x6a1e)->get()->getRow();
 if ($_0xb4de) {
 $_0xb4de->guru = (object) ["\x69\144\x5f\147\x75\162\x75" => $_0xb4de->bank_guru_id, "\x6e\141\x6d\141\x5f\147\x75\162\x75" => $_0xb4de->nama_guru];
 $_0xb4de->mapel = (object) ["\x69\144\x5f\155\x61\160\x65\154" => $_0xb4de->bank_mapel_id, "\x6e\141\x6d\141\x5f\155\x61\160\x65\154" => $_0xb4de->nama_mapel, "\x6b\157\x64\145" => $_0xb4de->kode_mapel];
 $_0xb4de->soal = $_0xf37a->table("\x63\142\x74\137\x73\157\x61\154")->where("\x62\141\x6e\153\x5f\151\x64", $_0x6a1e)->get()->getResult();
 $_0xdae2[] = (array) $_0xb4de;
 $_0x5ed5 = count($_0xdae2) - 1;
 }
 }
 if ($_0x5ed5 === false || !isset($_0xdae2[$_0x5ed5])) {
 throw new Exception("Data Bank Soal tidak ditemukan (id_bank: {$_0x6a1e})");
 }
 $_0x66ef = (object) $_0xdae2[$_0x5ed5];
 $_0x4d29 = $_0x66ef->bank_kelas ?? [];
 $_0x1601 = is_string($_0x4d29) ? $this->maybe_unserialize($_0x4d29) : $_0x4d29;
 unset($_0x66ef->bank_kelas);
 $_0x8f2b = [];
 if (is_array($_0x1601)) {
 foreach ($_0x1601 as $_0x5dc1) {
 if (is_object($_0x5dc1) && isset($_0x5dc1->kelas_id)) {
 $_0x8f2b[] = $_0x5dc1->kelas_id;
 } elseif (is_array($_0x5dc1) && isset($_0x5dc1["\x6b\145\x6c\141\x73\137\x69\144"])) {
 $_0x8f2b[] = $_0x5dc1["\x6b\145\x6c\141\x73\137\x69\144"];
 } elseif (is_numeric($_0x5dc1)) {
 $_0x8f2b[] = $_0x5dc1;
 }
 }
 }
 $_0x6972 = [];
 if (!empty($_0x8f2b)) {
 $_0x6972 = $_0xf37a->table("\x6d\141\x73\164\x65\162\x5f\153\x65\154\x61\163")->whereIn("\x69\144\x5f\153\x65\154\x61\163", $_0x8f2b)->get()->getResultArray();
 foreach ($_0x6972 as $_0xd623 => $_0xe18b) {
 if (isset($_0xe18b["\x6a\165\x6d\154\x61\150\x5f\163\x69\163\x77\141"]) && is_string($_0xe18b["\x6a\165\x6d\154\x61\150\x5f\163\x69\163\x77\141"])) {
 $_0x6972[$_0xd623]["\x6a\165\x6d\154\x61\150\x5f\163\x69\163\x77\141"] = $this->maybe_unserialize($_0xe18b["\x6a\165\x6d\154\x61\150\x5f\163\x69\163\x77\141"]);
 }
 }
 }
 $_0x6a62 = $_0xf37a->table("\x63\142\x74\137\x6a\145\x6e\151\x73")->where("\x69\144\x5f\152\x65\156\x69\163", $_0x3689)->get()->getRow();
 $_0xfc2e = $_0x6a62 ? $_0x6a62->kode_jenis : '';
 $_0x7846 = $_0x66ef->guru ?? (object) ["\x69\144\x5f\147\x75\162\x75" => '', "\x6e\141\x6d\141\x5f\147\x75\162\x75" => ''];
 $_0xc632 = $_0x66ef->mapel ?? (object) ["\x69\144\x5f\155\x61\160\x65\154" => '', "\x6e\141\x6d\141\x5f\155\x61\160\x65\154" => '', "\x6b\157\x64\145" => ''];
 $_0x4de8 = isset($_0x66ef->soal) && is_array($_0x66ef->soal) ? $_0x66ef->soal : [];
 foreach ($_0x4de8 as $_0x55ef) {
 if (isset($_0x55ef->opsi_a) && is_string($_0x55ef->opsi_a)) {
 $_0x55ef->opsi_a = $this->maybe_unserialize($_0x55ef->opsi_a);
 }
 if (isset($_0x55ef->jawaban) && is_string($_0x55ef->jawaban)) {
 $_0x55ef->jawaban = $this->maybe_unserialize($_0x55ef->jawaban);
 }
 }
 $_0x636a = array_filter($_0x4de8, static function ($_0x9336) {
 return isset($_0x9336->jenis) && $_0x9336->jenis == "\x31";
 });
 $_0x8dde = array_filter($_0x4de8, static function ($_0x9336) {
 return isset($_0x9336->jenis) && $_0x9336->jenis == "\x32";
 });
 $_0x6277 = array_filter($_0x4de8, static function ($_0x9336) {
 return isset($_0x9336->jenis) && $_0x9336->jenis == "\x33";
 });
 $_0xd5be = array_filter($_0x4de8, static function ($_0x9336) {
 return isset($_0x9336->jenis) && $_0x9336->jenis == "\x34";
 });
 $_0xd57b = array_filter($_0x4de8, static function ($_0x9336) {
 return isset($_0x9336->jenis) && $_0x9336->jenis == "\x35";
 });
 unset($_0x66ef->guru, $_0x66ef->mapel, $_0x66ef->soal);
 $_0xa994["\x62\141\x6e\153\x5f\163\x6f\141\x6c"] = json_encode($_0x66ef);
 $_0xa994["\x6b\157\x64\145\x5f\142\x61\156\x6b"] = $_0x66ef->bank_kode ?? '';
 $_0xa994["\x6b\145\x6c\141\x73\137\x62\141\x6e\153"] = json_encode($_0x6972);
 $_0xa994["\x6c\145\x76\145\x6c\137\x62\141\x6e\153"] = $_0x66ef->bank_level ?? '';
 $_0xa994["\x6b\157\x64\145\x5f\152\x65\156\x69\163"] = $_0xfc2e;
 $_0xa994["\x69\144\x5f\155\x61\160\x65\154"] = $_0xc632->id_mapel ?? $_0x66ef->bank_mapel_id ?? '';
 $_0xa994["\x6b\157\x64\145\x5f\155\x61\160\x65\154"] = $_0xc632->kode ?? '';
 $_0xa994["\x6e\141\x6d\141\x5f\155\x61\160\x65\154"] = $_0xc632->nama_mapel ?? '';
 $_0xa994["\x73\157\x61\154\x5f\160\x67"] = json_encode(array_values($_0x636a));
 $_0xa994["\x73\157\x61\154\x5f\153\x6f\155\x70\154\x65\153\x73"] = json_encode(array_values($_0x8dde));
 $_0xa994["\x73\157\x61\154\x5f\152\x6f\144\x6f\150\x6b\141\x6e"] = json_encode(array_values($_0x6277));
 $_0xa994["\x73\157\x61\154\x5f\151\x73\151\x61\156"] = json_encode(array_values($_0xd5be));
 $_0xa994["\x73\157\x61\154\x5f\145\x73\141\x69"] = json_encode(array_values($_0xd57b));
 $_0xa994["\x69\144\x5f\147\x75\162\x75"] = $_0x7846->id_guru ?? '';
 $_0xa994["\x6e\141\x6d\141\x5f\147\x75\162\x75"] = $_0x7846->nama_guru ?? '';
 if ($_0x8aab == '' && !empty($_0x37b6)) {
 $_0x4082 = $_0xf37a->table("\x63\142\x74\137\x72\145\x6b\141\x70\137\x6a\141\x64\167\x61\154")->select("\x69\144\x5f\162\x65\153\x61\160")->where("\x69\144\x5f\152\x61\144\x77\141\x6c", $_0x37b6)->orderBy("\x69\144\x5f\162\x65\153\x61\160", "\x41\123\x43")->get()->getRow();
 if ($_0x4082) {
 $_0x8aab = $_0x4082->id_rekap;
 }
 }
 if ($_0x8aab == '') {
 $_0xe762[] = $_0xa994;
 $_0xf37a->table("\x63\142\x74\137\x72\145\x6b\141\x70\137\x6a\141\x64\167\x61\154")->insert($_0xa994);
 } else {
 $_0xdd84[] = $_0xa994;
 $_0xf37a->table("\x63\142\x74\137\x72\145\x6b\141\x70\137\x6a\141\x64\167\x61\154")->where("\x69\144\x5f\162\x65\153\x61\160", $_0x8aab)->update($_0xa994);
 }
 $_0x8385["\x73\165\x63\143\x65\163\x73"] = true;
 $_0x8385["\x6d\145\x73\163\x61\147\x65"] = "\x53\165\x6b\163\x65\163";
 } catch (\Exception $_0x96a2) {
 $_0x8385["\x73\165\x63\143\x65\163\x73"] = false;
 $_0x8385["\x6d\145\x73\163\x61\147\x65"] = $_0x96a2->getMessage();
 continue;
 }
 }
 } else {
 $_0x8385["\x73\165\x63\143\x65\163\x73"] = false;
 $_0x8385["\x6d\145\x73\163\x61\147\x65"] = "\x47\141\x67\141\x6c";
 }
 goto L_9723d;
 L_9723d:
 $_0x8385["\x75\160\x64\141\x74\145\x64"] = is_array($_0xdd84) || $_0xdd84 instanceof \Countable ? count($_0xdd84) : 0;
 goto L_9b76b;
 L_99650:
 $_0xec66 = $this->request->getPost("\x69\144\x73\137\x62\141\x6e\153");
 goto L_a2b88;
 L_fe22b:
 $_0xf994 = [];
 goto L_96b00;
 L_f64dc:
 $_0x8385["\x70\157\x73\164"] = is_array($_0x772d) || $_0x772d instanceof \Countable ? count($_0x772d) : 0;
 goto L_30344;
 L_81d5a:
 $_0xdd84 = [];
 goto L_6ebc2;
 L_42067:
 $_0x772d = $this->request->getPost("\x72\145\x6b\141\x70");
 goto L_638ea;
 L_6ebc2:
 $_0xdae2 = [];
 goto L_412f2;
 L_9b76b:
 $_0x8385["\x69\156\x73\145\x72\164\x65\144"] = is_array($_0xe762) || $_0xe762 instanceof \Countable ? count($_0xe762) : 0;
 goto L_f64dc;
 L_b42ca:
 $_0xf37a = \Config\Database::connect();
 goto L_42067;
 L_8aa0f:
 $_0x707d = $_0xec66 ? json_decode($_0xec66, true) : [];
 goto L_4fa85;
 L_638ea:
 $_0xeee0 = $this->request->getPost("\x69\144\x73\137\x6a\141\x64\167\x61\154");
 goto L_99650;
 L_4fa85:
 if (!empty($_0x2855)) {
 $this->hapusDuplikatJadwal($_0x2855);
 }
 goto L_93856;
 }
 public function hapusDuplikatJadwal($_0x9aa5)
 {
 goto L_acada;
 L_3ddbd:
 $_0x7f0d = array_column($_0x1730->getResultArray(), "\x69\144\x5f\162\x65\153\x61\160");
 goto L_8773a;
 L_a4540:
 $_0x1730 = $_0x2fa5->table("\x63\142\x74\137\x72\145\x6b\141\x70\137\x6a\141\x64\167\x61\154")->selectMin("\x69\144\x5f\162\x65\153\x61\160")->whereIn("\x69\144\x5f\152\x61\144\x77\141\x6c", $_0x9aa5)->groupBy("\x69\144\x5f\152\x61\144\x77\141\x6c")->get();
 goto L_3ddbd;
 L_1b008:
 $_0x2fa5 = \Config\Database::connect();
 goto L_a4540;
 L_8773a:
 if (!empty($_0x7f0d)) {
 $_0x2fa5->table("\x63\142\x74\137\x72\145\x6b\141\x70\137\x6a\141\x64\167\x61\154")->whereIn("\x69\144\x5f\152\x61\144\x77\141\x6c", $_0x9aa5)->whereNotIn("\x69\144\x5f\162\x65\153\x61\160", $_0x7f0d)->delete();
 }
 L_acada:
 if (empty($_0x9aa5)) {
 return;
 }
 goto L_1b008;
 }
 private function getRekapSiswa($_0x795e = null)
 {
 goto L_a7f91;
 L_95e81:
 $_0xa0f7->select("\x69\144\x5f\162\x65\153\x61\160\x5f\163\x69\163\x77\141\x2c\151\x64\137\x6a\141\x64\167\x61\154\x2c\151\x64\137\x73\151\x73\167\x61");
 goto L_5bbe3;
 L_fe4a6:
 return $_0x8c7a;
 L_5bbe3:
 if ($_0x795e) {
 $_0xa0f7->whereIn("\x69\144\x5f\152\x61\144\x77\141\x6c", $_0x795e);
 }
 goto L_b7118;
 L_0e3fe:
 foreach ($_0x5208 as $_0x5e82) {
 $_0x8c7a[$_0x5e82->id_jadwal][$_0x5e82->id_siswa] = $_0x5e82;
 }
 goto L_fe4a6;
 L_a7f91:
 $_0xa0f7 = \Config\Database::connect()->table("\x63\142\x74\137\x72\145\x6b\141\x70\137\x73\151\x73\167\x61");
 goto L_95e81;
 L_b7118:
 $_0x5208 = $_0xa0f7->get()->getResult();
 goto L_e8175;
 L_e8175:
 $_0x8c7a = [];
 goto L_0e3fe;
 }
 private function countCbtSiswa($_0x34be)
 {
 goto L_060d3;
 L_74291:
 return $_0x3195->countAllResults();
 L_060d3:
 $_0x3195 = \Config\Database::connect()->table("\x63\142\x74\137\x73\151\x73\167\x61\40\x61");
 goto L_e3275;
 L_e3275:
 $_0x3195->whereIn("\x61\56\x69\144\x5f\152\x61\144\x77\141\x6c", $_0x34be);
 goto L_74291;
 }
 private function getCbtSiswa($_0xdab0, $_0x1041, $_0x4e04)
 {
 goto L_21fa5;
 L_cbe37:
 $_0x4749->select("\x61\56\x69\144\x5f\163\x69\163\x77\141\x2c\141\x2e\151\x64\137\x6a\141\x64\167\x61\154\x2c\141\x2e\151\x64\137\x62\141\x6e\153\x2c\141\x2e\156\x69\154\x61\151\x5f\151\x6e\160\x75\164\x2c\141\x2e\152\x61\167\x61\142\x61\156\x2c\141\x2e\156\x69\154\x61\151\x2c\141\x2e\155\x75\154\x61\151\x2c\141\x2e\163\x65\154\x65\163\x61\151\x2c\141\x2e\163\x74\141\x74\165\x73\54\x61\56\x6c\141\x6d\141\x5f\165\x6a\151\x61\156\x2c\141\x2e\160\x65\154\x61\156\x67\147\x61\162\x61\156\x2c" . "\x6a\56\x69\144\x5f\164\x70\54\x6a\56\x69\144\x5f\163\x6d\164\x2c\163\x2e\163\x6d\164\x2c\163\x2e\156\x61\155\x61\137\x73\155\x74\54\x74\56\x74\141\x68\165\x6e\54" . "\x43\117\x41\114\x45\123\x43\105\x28\143\x2e\153\x65\154\x61\163\x5f\151\x64\54\x20\153\x73\56\x69\144\x5f\153\x65\154\x61\163\x2c\40\x30\51\x20\141\x73\40\x69\144\x5f\153\x65\154\x61\163\x2c\40\x43\117\x41\114\x45\123\x43\105\x28\150\x2e\156\x61\155\x61\137\x6b\145\x6c\141\x73\54\x20\150\x6b\56\x6e\141\x6d\141\x5f\153\x65\154\x61\163\x2c\40\x22\42\x29\40\x61\163\x20\156\x61\155\x61\137\x6b\145\x6c\141\x73\54" . "\x65\56\x69\144\x5f\162\x75\141\x6e\147\x2c\145\x2e\156\x61\155\x61\137\x72\165\x61\156\x67\54\x65\56\x6b\157\x64\145\x5f\162\x75\141\x6e\147\x2c\146\x2e\151\x64\137\x73\145\x73\151\x2c\146\x2e\156\x61\155\x61\137\x73\145\x73\151\x2c\146\x2e\153\x6f\144\x65\137\x73\145\x73\151\x2c\146\x2e\167\x61\153\x74\165\x5f\155\x75\154\x61\151\x2c\146\x2e\167\x61\153\x74\165\x5f\141\x6b\150\x69\162\x2c\146\x2e\151\x73\164\x69\162\x61\150\x61\164\x2c\146\x2e\141\x6b\164\x69\146\x2c" . "\x67\56\x6e\157\x6d\157\x72\137\x70\145\x73\145\x72\164\x61");
 goto L_d068c;
 L_188f6:
 $_0x4749->join("\x6d\141\x73\164\x65\162\x5f\153\x65\154\x61\163\x20\150", "\x63\56\x6b\145\x6c\141\x73\137\x69\144\x3d\150\x2e\151\x64\137\x6b\145\x6c\141\x73", "\x6c\145\x66\164");
 goto L_e22ee;
 L_20d33:
 $_0x4749->join("\x6d\141\x73\164\x65\162\x5f\164\x70\40\x74", "\x6a\56\x69\144\x5f\164\x70\75\x74\56\x69\144\x5f\164\x70", "\x6c\145\x66\164");
 goto L_3cd0c;
 L_2dfa4:
 $_0x4749->whereIn("\x61\56\x69\144\x5f\152\x61\144\x77\141\x6c", $_0xdab0);
 goto L_38d8d;
 L_3cd0c:
 $_0x4749->join("\x6d\141\x73\164\x65\162\x5f\163\x6d\164\x20\163", "\x6a\56\x69\144\x5f\163\x6d\164\x3d\163\x2e\151\x64\137\x73\155\x74", "\x6c\145\x66\164");
 goto L_2dfa4;
 L_e22ee:
 $_0x4749->join("\x6d\141\x73\164\x65\162\x5f\153\x65\154\x61\163\x20\150\x6b", "\x6b\163\x2e\151\x64\137\x6b\145\x6c\141\x73\75\x68\153\x2e\151\x64\137\x6b\145\x6c\141\x73", "\x6c\145\x66\164");
 goto L_20d33;
 L_f5524:
 $_0x4749->join("\x63\142\x74\137\x6e\157\x6d\157\x72\137\x70\145\x73\145\x72\164\x61\40\x67", "\x61\56\x69\144\x5f\163\x69\163\x77\141\x3d\147\x2e\151\x64\137\x73\151\x73\167\x61\40\x41\116\x44\40\x6a\56\x69\144\x5f\164\x70\75\x67\56\x69\144\x5f\164\x70\40\x41\116\x44\40\x6a\56\x69\144\x5f\163\x6d\164\x3d\147\x2e\151\x64\137\x73\155\x74", "\x6c\145\x66\164");
 goto L_188f6;
 L_65a97:
 return $_0x4749->get()->getResult();
 L_21fa5:
 $_0x4749 = \Config\Database::connect()->table("\x63\142\x74\137\x73\151\x73\167\x61\40\x61");
 goto L_cbe37;
 L_8ba34:
 $_0x4749->join("\x6b\145\x6c\141\x73\137\x73\151\x73\167\x61\40\x6b\163", "\x61\56\x69\144\x5f\163\x69\163\x77\141\x3d\153\x73\56\x69\144\x5f\163\x69\163\x77\141\x20\101\x4e\104\x20\152\x2e\151\x64\137\x74\160\x3d\153\x73\56\x69\144\x5f\164\x70\40\x41\116\x44\40\x6a\56\x69\144\x5f\163\x6d\164\x3d\153\x73\56\x69\144\x5f\163\x6d\164", "\x6c\145\x66\164");
 goto L_34cd4;
 L_34cd4:
 $_0x4749->join("\x63\142\x74\137\x72\165\x61\156\x67\40\x65", "\x63\56\x72\165\x61\156\x67\137\x69\144\x3d\145\x2e\151\x64\137\x72\165\x61\156\x67", "\x6c\145\x66\164");
 goto L_539da;
 L_539da:
 $_0x4749->join("\x63\142\x74\137\x73\145\x73\151\x20\146", "\x63\56\x73\145\x73\151\x5f\151\x64\75\x66\56\x69\144\x5f\163\x65\163\x69", "\x6c\145\x66\164");
 goto L_f5524;
 L_38d8d:
 $_0x4749->limit($_0x1041, $_0x4e04);
 goto L_65a97;
 L_2bbcc:
 $_0x4749->join("\x63\142\x74\137\x73\145\x73\151\x5f\163\x69\163\x77\141\x20\143", "\x61\56\x69\144\x5f\163\x69\163\x77\141\x3d\143\x2e\163\x69\163\x77\141\x5f\151\x64\40\x41\116\x44\40\x6a\56\x69\144\x5f\164\x70\75\x63\56\x74\160\x5f\151\x64\40\x41\116\x44\40\x6a\56\x69\144\x5f\163\x6d\164\x3d\143\x2e\163\x6d\164\x5f\151\x64", "\x6c\145\x66\164");
 goto L_8ba34;
 L_d068c:
 $_0x4749->join("\x63\142\x74\137\x6a\141\x64\167\x61\154\x20\152", "\x61\56\x69\144\x5f\152\x61\144\x77\141\x6c\75\x6a\56\x69\144\x5f\152\x61\144\x77\141\x6c", "\x6c\145\x66\164");
 goto L_2bbcc;
 }
 private function getMasterSiswa($_0x7d2f)
 {
 goto L_173bc;
 L_f3d00:
 $_0xccb3 = [];
 goto L_560e7;
 L_560e7:
 foreach ($_0xdceb as $_0x2c55) {
 $_0xccb3[$_0x2c55->id_siswa] = $_0x2c55;
 }
 goto L_549b8;
 L_75365:
 $_0x830b->select("\x69\144\x5f\163\x69\163\x77\141\x2c\156\x69\163\x6e\54\x6e\151\x73\54\x6e\141\x6d\141\x2c\152\x65\156\x69\163\x5f\153\x65\154\x61\155\x69\156\x2c\141\x67\141\x6d\141");
 goto L_d0650;
 L_549b8:
 return $_0xccb3;
 L_d0650:
 $_0x830b->whereIn("\x69\144\x5f\163\x69\163\x77\141", $_0x7d2f);
 goto L_6691f;
 L_173bc:
 $_0x830b = \Config\Database::connect()->table("\x6d\141\x73\164\x65\162\x5f\163\x69\163\x77\141");
 goto L_75365;
 L_6691f:
 $_0xdceb = $_0x830b->get()->getResult();
 goto L_f3d00;
 }
 private function updateRekapedJadwal($_0xb4ac)
 {
 goto L_0b413;
 L_a470d:
 foreach ($_0xb4ac as $_0x3f87) {
 $_0xe820[] = ["\x69\144\x5f\152\x61\144\x77\141\x6c" => $_0x3f87, "\x72\145\x6b\141\x70" => "\x31"];
 }
 goto L_6fb8d;
 L_0b413:
 $_0xe820 = [];
 goto L_a470d;
 L_6fb8d:
 \Config\Database::connect()->table("\x63\142\x74\137\x6a\141\x64\167\x61\154")->updateBatch($_0xe820, "\x69\144\x5f\152\x61\144\x77\141\x6c");
 }
 public function rekap_nilai_siswa()
 {
 goto L_737dd;
 L_0a79b:
 $_0x3854 = $this->getRekapSiswa($_0xb3c1);
 goto L_d763c;
 L_d763c:
 $_0xf2ec = [];
 goto L_58af7;
 L_d002f:
 $_0xcc82 = $this->countCbtSiswa($_0xb3c1);
 goto L_959c9;
 L_737dd:
 $_0xb3c1 = json_decode($this->request->getPost("\x69\144\x6a\141\x64\167\x61\154"));
 goto L_0a79b;
 L_c476a:
 if (count($_0xf2ec) > 0) {
 $_0x44d2 = array_column($_0xf2ec, "\x69\144\x5f\163\x69\163\x77\141");
 $_0xeb6e = $this->getMasterSiswa($_0x44d2);
 $_0x70d1 = [];
 foreach ($_0xeb6e as $_0x4043) {
 $_0x70d1[$_0x4043->id_siswa] = $_0x4043;
 }
 $_0x418b = [];
 $_0x8f97 = [];
 foreach ($_0xf2ec as $_0x8034) {
 if ($_0x8034->selesai != null) {
 $_0x6aa2 = $_0x70d1[$_0x8034->id_siswa] ?? new \stdClass();
 $_0x516d = ["\x72\165\x61\156\x67" => ["\x69\144\x5f\162\x75\141\x6e\147" => $_0x8034->id_ruang, "\x6e\141\x6d\141\x5f\162\x75\141\x6e\147" => $_0x8034->nama_ruang, "\x6b\157\x64\145\x5f\162\x75\141\x6e\147" => $_0x8034->kode_ruang], "\x73\145\x73\151" => ["\x69\144\x5f\163\x65\163\x69" => $_0x8034->id_sesi, "\x6e\141\x6d\141\x5f\163\x65\163\x69" => $_0x8034->nama_sesi, "\x6b\157\x64\145\x5f\163\x65\163\x69" => $_0x8034->kode_sesi, "\x77\141\x6b\164\x75\137\x6d\165\x6c\141\x69" => $_0x8034->waktu_mulai, "\x77\141\x6b\164\x75\137\x61\153\x68\151\x72" => $_0x8034->waktu_akhir, "\x69\163\x74\151\x72\141\x68\141\x74" => $_0x8034->istirahat, "\x61\153\x74\151\x66" => $_0x8034->aktif]];
 $_0x2a61 = $this->hitungWaktu(["\x6d\165\x6c\141\x69" => $_0x8034->mulai, "\x73\145\x6c\145\x73\141\x69" => $_0x8034->selesai, "\x6c\141\x6d\141\x5f\165\x6a\151\x61\156" => $_0x8034->lama_ujian]);
 $_0x2f2d = $_0x8034->id_jadwal;
 $_0x6970 = $_0x8034->id_siswa;
 $_0xfa04 = ["\x69\144\x5f\163\x69\163\x77\141" => $_0x6970, "\x6e\141\x6d\141\x5f\163\x69\163\x77\141" => $_0x6aa2->nama ?? '', "\x61\147\x61\155\x61" => $_0x6aa2->agama ?? '', "\x6e\157\x5f\160\x65\163\x65\162\x74\141" => $_0x8034->nomor_peserta ?? '', "\x73\151\x73\167\x61" => json_encode($_0x6aa2), "\x69\144\x5f\164\x70" => $_0x8034->id_tp ?? '', "\x74\160" => $_0x8034->tahun ?? '', "\x69\144\x5f\163\x6d\164" => $_0x8034->id_smt ?? '', "\x73\155\x74" => $_0x8034->smt ?? '', "\x69\144\x5f\152\x61\144\x77\141\x6c" => $_0x2f2d, "\x69\144\x5f\142\x61\156\x6b" => $_0x8034->id_bank ?? '', "\x69\144\x5f\153\x65\154\x61\163" => $_0x8034->id_kelas ?? 0, "\x6b\145\x6c\141\x73" => $_0x8034->nama_kelas ?? '', "\x72\165\x61\156\x67\137\x73\145\x73\151" => json_encode($_0x516d), "\x6a\141\x77\141\x62\141\x6e" => $_0x8034->jawaban ?? '', "\x6e\151\x6c\141\x69" => $_0x8034->nilai ?? '', "\x6e\151\x6c\141\x69\137\x69\156\x70\165\x74" => $_0x8034->nilai_input ?? '', "\x73\164\x61\164\x75\163" => $_0x8034->status ?? "\x30", "\x6d\165\x6c\141\x69" => $_0x8034->mulai, "\x73\145\x6c\145\x73\141\x69" => $_0x8034->selesai, "\x6c\141\x6d\141\x5f\165\x6a\151\x61\156" => $_0x2a61["\x6c\141\x6d\141\x5f\165\x6a\151\x61\156"] ?? '', "\x70\145\x6c\141\x6e\147\x67\141\x72\141\x6e" => $_0x8034->pelanggaran ?? ''];
 if (isset($_0x3854[$_0x2f2d][$_0x6970])) {
 $_0xfa04["\x69\144\x5f\162\x65\153\x61\160\x5f\163\x69\163\x77\141"] = $_0x3854[$_0x2f2d][$_0x6970]->id_rekap_siswa;
 $_0x8f97[] = $_0xfa04;
 } else {
 $_0x418b[] = $_0xfa04;
 }
 }
 }
 if (count($_0x418b) > 0) {
 \Config\Database::connect()->table("\x63\142\x74\137\x72\145\x6b\141\x70\137\x73\151\x73\167\x61")->insertBatch($_0x418b);
 }
 if (count($_0x8f97) > 0) {
 \Config\Database::connect()->table("\x63\142\x74\137\x72\145\x6b\141\x70\137\x73\151\x73\167\x61")->updateBatch($_0x8f97, "\x69\144\x5f\162\x65\153\x61\160\x5f\163\x69\163\x77\141");
 }
 $this->updateRekapedJadwal($_0xb3c1);
 $this->logging->saveLog($this->LOG_TYPE->ADD, "\x4d\145\x72\145\x6b\141\x70\40\x68\141\x73\151\x6c\40\x75\152\x69\141\x6e");
 } elseif (!empty($_0xb3c1)) {
 $this->updateRekapedJadwal($_0xb3c1);
 }
 goto L_64626;
 L_e7aba:
 return $this->response->setJSON($_0xa09e);
 L_ecbe5:
 $_0xa09e["\x6d\145\x73\163\x61\147\x65"] = "\x42\145\x72\150\x61\163\x69\154";
 goto L_b3071;
 L_4f503:
 $_0xa09e["\x73\165\x63\143\x65\163\x73"] = true;
 goto L_e7aba;
 L_25c10:
 for ($_0xad3a = 0; $_0xad3a < $_0x7f31; $_0xad3a++) {
 $_0xb6c9 = $_0xad3a + 1;
 $_0xfc20 = ($_0xb6c9 - 1) * $_0xa265;
 $_0x8fe8 = $this->getCbtSiswa($_0xb3c1, $_0xa265, $_0xfc20);
 $_0xf2ec = array_merge($_0xf2ec, $_0x8fe8);
 }
 goto L_c476a;
 L_b3071:
 $_0xa09e["\x72\145\x6b\141\x70\137\x73\151\x73\167\x61"] = count($_0x3854);
 goto L_c9a2a;
 L_959c9:
 $_0x7f31 = ceil($_0xcc82 / $_0xa265);
 goto L_25c10;
 L_58af7:
 $_0xa265 = 500;
 goto L_d002f;
 L_c9a2a:
 $_0xa09e["\x63\142\x74"] = count($_0xf2ec);
 goto L_4f503;
 L_64626:
 gc_collect_cycles();
 goto L_ecbe5;
 }
 public function get_updated()
 {
 $_0xb1ba = $this->request->getPost("\x69\144\x73");
 $_0x4cb8 = $this->request->getPost("\x74\141\x62\154\x65");
 }
 function hitungWaktu($_0x5e72)
 {
 if (!empty($_0x5e72["\x6d\165\x6c\141\x69"]) && !empty($_0x5e72["\x73\145\x6c\145\x73\141\x69"])) {
 $_0x2a8b = isset($_0x5e72["\x6c\141\x6d\141\x5f\165\x6a\151\x61\156"]) ? $_0x5e72["\x6c\141\x6d\141\x5f\165\x6a\151\x61\156"] : null;
 if (empty($_0x2a8b) || strpos($_0x2a8b, "\x3a") == false) {
 $_0x472b = strtotime($_0x5e72["\x6d\165\x6c\141\x69"] ?? '');
 $_0xbdc0 = strtotime($_0x5e72["\x73\145\x6c\145\x73\141\x69"] ?? '');
 $_0x8687 = $_0xbdc0 - $_0x472b;
 $_0x8ea0 = floor($_0x8687 / 3600);
 $_0xe45e = floor($_0x8687 % 3600 / 60);
 $_0x869b = $_0x8687 % 60;
 $_0x5e72["\x6c\141\x6d\141\x5f\165\x6a\151\x61\156"] = sprintf("\x25\60\x32\144\x3a\45\x30\62\x64\72\x25\60\x32\144", $_0x8ea0, $_0xe45e, $_0x869b);
 }
 }
 return $_0x5e72;
 }
 public function rekap_nilai()
 {
 goto L_41535;
 L_813cd:
 $_0x780d["\x75\160\x64\141\x74\145"] = count($_0xc7bb);
 goto L_0603e;
 L_695bf:
 $_0xe767->select("\x61\56\x69\144\x5f\162\x65\153\x61\160\x5f\163\x69\163\x77\141\x2c\40\x61\56\x69\144\x5f\163\x69\163\x77\141\x2c\40\x61\56\x69\144\x5f\152\x61\144\x77\141\x6c\54\x20\141\x2e\156\x69\154\x61\151\x5f\151\x6e\160\x75\164\x2c\40\x61\56\x6d\165\x6c\141\x69\54\x20\141\x2e\163\x65\154\x65\163\x61\151\x2c\40\x61\56\x69\144\x5f\153\x65\154\x61\163\x20\141\x73\40\x6b\145\x6c\141\x73\137\x69\144\x2c\40\x63\56\x61\147\x61\155\x61");
 goto L_fec96;
 L_513b7:
 if (count($_0x79cd) > 0) {
 \Config\Database::connect()->table("\x63\142\x74\137\x72\145\x6b\141\x70\137\x73\151\x73\167\x61")->insertBatch($_0x79cd);
 }
 goto L_f3907;
 L_3a9ce:
 $_0x79cd = [];
 goto L_b9f0c;
 L_1809f:
 $_0x780d["\x64\141\x74\141"] = $_0x4149;
 goto L_d8006;
 L_cd7ed:
 $_0xd365 = [];
 goto L_3a9ce;
 L_c9667:
 $_0x6f84 = [];
 goto L_90d1b;
 L_58a4b:
 $_0xe767 = \Config\Database::connect()->table("\x63\142\x74\137\x72\145\x6b\141\x70\137\x73\151\x73\167\x61\40\x61");
 goto L_695bf;
 L_41535:
 $_0xec62 = $this->request->getPost("\x6e\151\x6c\141\x69");
 goto L_ab721;
 L_e64b6:
 foreach ($_0xec62 as $_0xf59d) {
 try {
 $_0x3b6d = [];
 $_0x2ff7 = 0;
 $_0x1407 = '';
 $_0x459a = '';
 foreach ($_0xf59d as $_0x4d6c => $_0xbd97) {
 if ($_0x4d6c == "\x69\144\x73") {
 $_0xb27c = json_decode($_0xbd97, true);
 if (json_last_error() !== JSON_ERROR_NONE || !is_array($_0xb27c)) {
 throw new Exception("\x45\162\x72\157\x72\40\x64\145\x63\157\x64\151\x6e\147\x20\112\x53\117\x4e\40\x69\156\x20\47\x69\144\x73\47\x20\146\x69\145\x6c\144\x2e");
 }
 $_0x1407 = $_0xb27c["\x69\144\x5f\163\x69\163\x77\141"];
 $_0x459a = $_0xb27c["\x69\144\x5f\152\x61\144\x77\141\x6c"];
 foreach ($_0xb27c as $_0xc3b1 => $_0x3117) {
 $_0x3b6d[$_0xc3b1] = $_0x3117;
 }
 } elseif ($_0x4d6c == "\x69\163\x5f\165\x70\144\x61\164\x65") {
 $_0x2ff7 = $_0xbd97;
 } else {
 $_0x3b6d[$_0x4d6c] = $_0xbd97;
 }
 }
 if (isset($_0xc495[$_0x459a][$_0x1407])) {
 $_0x3b6d["\x6a\141\x77\141\x62\141\x6e"] = $_0xc495[$_0x459a][$_0x1407]->jawaban;
 $_0x3b6d["\x6e\151\x6c\141\x69"] = $_0xc495[$_0x459a][$_0x1407]->nilai;
 $_0x3b6d["\x6e\151\x6c\141\x69\137\x69\156\x70\165\x74"] = $_0xc495[$_0x459a][$_0x1407]->nilai_input;
 if ($_0x2ff7) {
 $_0xc7bb[] = $_0x3b6d;
 } else {
 $_0x79cd[] = $_0x3b6d;
 }
 $_0xd365[] = $_0x459a;
 }
 } catch (\Exception $_0x826f) {
 $_0x780d["\x73\165\x63\143\x65\163\x73"] = false;
 $_0x780d["\x6d\145\x73\163\x61\147\x65"] = $_0x826f->getMessage();
 continue;
 }
 }
 goto L_513b7;
 L_5f4c3:
 $_0x4149 = $_0xe767->get()->getResult();
 goto L_42805;
 L_d20d6:
 $_0xe767->whereIn("\x61\56\x69\144\x5f\152\x61\144\x77\141\x6c", $_0x6c3f);
 goto L_5f4c3;
 L_d8006:
 $_0x780d["\x63\142\x74"] = $_0xc495;
 goto L_68d9d;
 L_68d9d:
 $_0x780d["\x66\157\x72\137\x69\156\x73\145\x72\164"] = $_0x79cd;
 goto L_3fe91;
 L_ab721:
 $_0x6c3f = json_decode($this->request->getPost("\x69\144\x6a\141\x64\167\x61\154"));
 goto L_1eaf4;
 L_6c159:
 $_0x780d["\x6d\145\x73\163\x61\147\x65"] = "\x42\145\x72\150\x61\163\x69\154";
 goto L_e52af;
 L_e52af:
 return $this->response->setJSON($_0x780d);
 L_aba9e:
 $_0xc495 = [];
 goto L_589b6;
 L_1eaf4:
 $_0x3ad2 = $this->cbt_siswa_model->fields("\x69\144\x5f\152\x61\144\x77\141\x6c\54\x69\144\x5f\163\x69\163\x77\141\x2c\152\x61\167\x61\142\x61\156\x2c\156\x69\154\x61\151\x2c\156\x69\154\x61\151\x5f\151\x6e\160\x75\164")->where("\x69\144\x5f\152\x61\144\x77\141\x6c", $_0x6c3f)->get_all();
 goto L_aba9e;
 L_0603e:
 $_0x780d["\x73\165\x63\143\x65\163\x73"] = true;
 goto L_6c159;
 L_0c4f9:
 $_0x780d["\x69\156\x73\145\x72\164"] = count($_0x79cd);
 goto L_813cd;
 L_b9f0c:
 $_0xc7bb = [];
 goto L_e64b6;
 L_3fe91:
 $_0x780d["\x66\157\x72\137\x75\160\x64\141\x74\145"] = $_0xc7bb;
 goto L_0c4f9;
 L_fec96:
 $_0xe767->join("\x6d\141\x73\164\x65\162\x5f\163\x69\163\x77\141\x20\143", "\x63\56\x69\144\x5f\163\x69\163\x77\141\x3d\141\x2e\151\x64\137\x73\151\x73\167\x61", "\x6c\145\x66\164");
 goto L_d20d6;
 L_62e12:
 \Config\Database::connect()->table("\x63\142\x74\137\x6a\141\x64\167\x61\154")->updateBatch($_0x6f84, "\x69\144\x5f\152\x61\144\x77\141\x6c");
 goto L_58a4b;
 L_f3907:
 if (count($_0xc7bb) > 0) {
 \Config\Database::connect()->table("\x63\142\x74\137\x72\145\x6b\141\x70\137\x73\151\x73\167\x61")->updateBatch($_0xc7bb, "\x69\144\x5f\162\x65\153\x61\160\x5f\163\x69\163\x77\141");
 }
 goto L_c9667;
 L_90d1b:
 foreach ($_0xd365 as $_0xfe62) {
 $_0x6f84[] = ["\x69\144\x5f\152\x61\144\x77\141\x6c" => $_0xfe62, "\x72\145\x6b\141\x70" => "\x31"];
 }
 goto L_62e12;
 L_42805:
 foreach ($_0x4149 as $_0xec81) {
 $_0xec81->nilai_input = $this->maybe_unserialize($_0xec81->nilai_input);
 }
 goto L_a6da1;
 L_589b6:
 foreach ($_0x3ad2 as $_0xf50a) {
 $_0xc495[$_0xf50a->id_jadwal][$_0xf50a->id_siswa] = $_0xf50a;
 }
 goto L_cd7ed;
 L_a6da1:
 $this->logging->saveLog($this->LOG_TYPE->ADD, "\x4d\145\x72\145\x6b\141\x70\40\x68\141\x73\151\x6c\40\x75\152\x69\141\x6e");
 goto L_1809f;
 }
 public function view_koreksi()
 {
 goto L_449f9;
 L_197f9:
 $_0x18e2 = in_array((string) $_0x63c3->get("\x72\157\x6c\145"), ["\x31", "\x34"]);
 goto L_9e2d0;
 L_72d94:
 $_0xc39f["\x73\155\x74\137\x61\143\x74\151\x76\145"] = $_0x64ef;
 goto L_31f7a;
 L_9e2d0:
 $_0x8bbd = (object) ["\x69\144" => $_0x63c3->get("\x69\144\x5f\165\x73\145\x72"), "\x75\163\x65\162\x6e\141\x6d\145" => $_0x63c3->get("\x75\163\x65\162\x6e\141\x6d\145"), "\x66\151\x72\163\x74\137\x6e\141\x6d\145" => $_0x63c3->get("\x75\163\x65\162\x6e\141\x6d\145"), "\x72\157\x6c\145\x5f\156\x61\155\x65" => $_0x63c3->get("\x72\157\x6c\145\x5f\156\x61\155\x65"), "\x66\157\x74\157" => $_0x63c3->get("\x66\157\x74\157") ?? ''];
 goto L_d2c47;
 L_c8572:
 $_0xc39f["\x74\160\x5f\141\x63\164\x69\166\x65"] = $_0xa320;
 goto L_72d94;
 L_7bcaa:
 $_0xc39f["\x74\160"] = $_0x80f2->tp;
 goto L_3ede9;
 L_278ed:
 $_0xc39f["\x69\163\x5f\162\x65\153\x61\160"] = true;
 goto L_41530;
 L_5495a:
 $_0xba1d = $this->request->getGet("\x69\144\x5f\152\x61\144\x77\141\x6c");
 goto L_8bf14;
 L_8bf14:
 $_0xc39f["\x6b\145\x6c\141\x73\137\x73\145\x6c\145\x63\164\x65\144"] = $_0x9167;
 goto L_32ea1;
 L_31f7a:
 $_0x9167 = $this->request->getGet("\x69\144\x5f\153\x65\154\x61\163");
 goto L_5495a;
 L_32ea1:
 $_0xc39f["\x6a\141\x64\167\x61\154\x5f\163\x65\154\x65\143\x74\145\x64"] = $_0xba1d;
 goto L_b15a3;
 L_24b59:
 return view("\x63\142\x74\57\x6e\151\x6c\141\x69\57\x64\141\x74\141\x5f\156\x69\154\x61\151", $_0xc39f);
 L_b15a3:
 if (!$this->isAdmin()) {
 $_0x6a4a = \Config\Database::connect()->table("\x6d\141\x73\164\x65\162\x5f\147\x75\162\x75")->where("\x69\144\x5f\165\x73\145\x72", $_0x8bbd->id)->get()->getRow();
 $_0xc39f["\x67\165\x72\165"] = $_0x6a4a;
 $_0xa4f5 = $_0x6a4a->id_guru ?? null;
 } else {
 $_0xa4f5 = null;
 }
 goto L_278ed;
 L_f9020:
 $_0xa320 = $_0x80f2->tp_active;
 goto L_49c6f;
 L_49c6f:
 $_0x64ef = $_0x80f2->smt_active;
 goto L_7bcaa;
 L_3ede9:
 $_0xc39f["\x73\155\x74"] = $_0x80f2->smt;
 goto L_c8572;
 L_41530:
 $_0xc39f["\x6b\145\x6c\141\x73"] = \Config\Database::connect()->table("\x6d\141\x73\164\x65\162\x5f\153\x65\154\x61\163")->get()->getResultArray();
 goto L_24b59;
 L_449f9:
 $_0x63c3 = session();
 goto L_197f9;
 L_d2c47:
 $_0xc39f = ["\x75\163\x65\162" => $_0x8bbd, "\x6a\165\x64\165\x6c" => "\x52\145\x6b\141\x70\40\x4e\151\x6c\141\x69\40\x53\151\x73\167\x61", "\x73\165\x62\152\x75\144\x75\154" => "\x4b\157\x72\145\x6b\163\x69\40\x52\145\x6b\141\x70", "\x73\145\x74\164\x69\156\x67" => is_object($_0x67d6 = \Config\Database::connect()->table("\x73\145\x74\164\x69\156\x67")->get()->getRow()) ? clone $_0x67d6 : new \stdClass()];
 goto L_ac7ad;
 L_ac7ad:
 $_0x80f2 = $this->getTpSmt();
 goto L_f9020;
 }
 /**
 * @throws \JsonException
 */
 public function koreksi()
 {
 goto L_6cb3f;
 L_8d5e9:
 $_0x4407["\x74\160\x5f\141\x63\164\x69\166\x65"] = $_0xc300;
 goto L_f7b57;
 L_1f2ed:
 $_0xc7fc = array_filter($_0xef87->soal_pg, function ($_0x39b5) {
 return $_0x39b5->tampilkan == "\x31";
 });
 goto L_aab31;
 L_4674a:
 if ($_0xf60b) {
 return view("\x63\142\x74\57\x6e\151\x6c\141\x69\57\x6b\157\x72\145\x6b\163\x69", $_0x4407);
 } else {
 return view("\x63\142\x74\57\x6e\151\x6c\141\x69\57\x6b\157\x72\145\x6b\163\x69", $_0x4407);
 }
 L_f44fe:
 $_0x4407["\x73\157\x61\154\x5f\160\x67"] = array_values($_0xc7fc);
 goto L_1f629;
 L_792c1:
 $_0x8a06 = $_0xe03d->smt_active;
 goto L_f91a6;
 L_1b2d1:
 $_0xc908 = [];
 goto L_0c46d;
 L_7f450:
 $_0xef87->bank_soal = $this->maybe_unserialize($_0xef87->bank_soal);
 goto L_c2005;
 L_f91a6:
 $_0x4407["\x74\160"] = $_0xe03d->tp;
 goto L_12780;
 L_0cd61:
 $_0x68b6 = array_filter($_0xef87->soal_isian, function ($_0x39b5) {
 return $_0x39b5->tampilkan == "\x31";
 });
 goto L_fe68d;
 L_6cb3f:
 $_0x6449 = session();
 goto L_5d7ae;
 L_9a84b:
 $_0xef87->soal_isian = $this->maybe_unserialize($_0xef87->soal_isian);
 goto L_59e84;
 L_aad20:
 $_0x4407["\x69\144\x5f\142\x61\156\x6b"] = $_0x8eeb->id_bank ?? null;
 goto L_9dd13;
 L_12780:
 $_0x4407["\x73\155\x74"] = $_0xe03d->smt;
 goto L_8d5e9;
 L_d050f:
 $_0xbbde = $this->request->getGet("\x69\144\x5f\152\x61\144\x77\141\x6c");
 goto L_1ecc0;
 L_9cb27:
 $_0x4407["\x69\144\x5f\152\x61\144\x77\141\x6c"] = $_0xef87->id_jadwal;
 goto L_aad20;
 L_59e84:
 $_0xef87->soal_esai = $this->maybe_unserialize($_0xef87->soal_esai ?? '');
 goto L_89f06;
 L_1f629:
 $_0x4407["\x73\157\x61\154\x5f\153\x6f\155\x70\154\x65\153\x73"] = array_values($_0xee40);
 goto L_eb6f0;
 L_c6e37:
 $_0xef87->soal_jodohkan = $this->maybe_unserialize($_0xef87->soal_jodohkan);
 goto L_9a84b;
 L_f3360:
 $_0x4407["\x69\163\x5f\162\x65\153\x61\160"] = $_0x8eeb->sesisiswa->id_rekap_siswa;
 goto L_50914;
 L_f7b57:
 $_0x4407["\x73\155\x74\137\x61\143\x74\151\x76\145"] = $_0x8a06;
 goto L_2cc6b;
 L_fadcc:
 $_0xc300 = $_0xe03d->tp_active;
 goto L_792c1;
 L_7c0f2:
 $_0x4407["\x72\145\x6b\141\x70\137\x67\165\x72\165"] = $_0xef87->nama_guru;
 goto L_0112d;
 L_fe68d:
 $_0xf5bc = array_filter($_0xef87->soal_esai, function ($_0x39b5) {
 return $_0x39b5->tampilkan == "\x31";
 });
 goto L_f44fe;
 L_9dd13:
 $_0x4407["\x74\160\x5f\152\x61\144\x77\141\x6c"] = $_0xef87->tp;
 goto L_2bf5c;
 L_341d8:
 $_0x4407["\x73\157\x61\154\x5f\151\x73\151\x61\156"] = array_values($_0x68b6);
 goto L_ca109;
 L_e8016:
 $_0xbce2 = (object) ["\x69\144" => $_0x6449->get("\x69\144\x5f\165\x73\145\x72"), "\x75\163\x65\162\x6e\141\x6d\145" => $_0x6449->get("\x75\163\x65\162\x6e\141\x6d\145"), "\x66\151\x72\163\x74\137\x6e\141\x6d\145" => $_0x6449->get("\x75\163\x65\162\x6e\141\x6d\145"), "\x72\157\x6c\145\x5f\156\x61\155\x65" => $_0x6449->get("\x72\157\x6c\145\x5f\156\x61\155\x65"), "\x66\157\x74\157" => $_0x6449->get("\x66\157\x74\157") ?? ''];
 goto L_9d887;
 L_2f066:
 $_0x4407["\x69\156\x66\157"] = $_0xef87->bank_soal;
 goto L_9cb27;
 L_eb6f0:
 $_0x4407["\x73\157\x61\154\x5f\152\x6f\144\x6f\150\x6b\141\x6e"] = array_values($_0x94f2);
 goto L_341d8;
 L_da802:
 $_0xda96 = $this->request->getGet("\x69\144\x5f\163\x69\163\x77\141");
 goto L_d050f;
 L_b12c0:
 $_0x8eeb->sesisiswa = array_values($_0xef87->rekapsiswa)[0];
 goto L_68635;
 L_68635:
 unset($_0xef87->rekapsiswa);
 goto L_1f2ed;
 L_ca109:
 $_0x4407["\x73\157\x61\154\x5f\145\x73\141\x69"] = array_values($_0xf5bc);
 goto L_f3360;
 L_98821:
 if (!$_0xef87) {
 return view("\x65\162\x72\157\x72\163\x2f\150\x74\155\x6c\57\x65\162\x72\157\x72\137\x34\60\x34", ["\x6d\145\x73\163\x61\147\x65" => "\x44\141\x74\141\x20\162\x65\153\x61\160\x20\164\x69\144\x61\153\x20\144\x69\164\x65\155\x75\153\x61\156"]);
 }
 goto L_f3e45;
 L_6e2e5:
 $_0xef87->soal_kompleks = $this->maybe_unserialize($_0xef87->soal_kompleks);
 goto L_c6e37;
 L_0c46d:
 foreach ($_0xef87->kelas_bank as $_0x9e28) {
 if (isset($_0x9e28->id_kelas)) {
 $_0xc908[$_0x9e28->id_kelas] = $_0x9e28->nama_kelas;
 }
 }
 goto L_e94d5;
 L_e94d5:
 $_0xef87->pengawas = $this->maybe_unserialize($_0xef87->pengawas);
 goto L_82723;
 L_f3e45:
 $_0xef87->jadwal = $this->maybe_unserialize($_0xef87->jadwal);
 goto L_7f450;
 L_2bf5c:
 $_0x4407["\x6a\145\x6e\151\x73"] = (object) ["\x69\144\x5f\152\x65\156\x69\163" => $_0xef87->id_jenis, "\x6b\157\x64\145\x5f\152\x65\156\x69\163" => $_0xef87->kode_jenis];
 goto L_4674a;
 L_5d7ae:
 $_0xf60b = in_array((string) $_0x6449->get("\x72\157\x6c\145"), ["\x31", "\x34"]);
 goto L_e8016;
 L_aab31:
 $_0xee40 = array_filter($_0xef87->soal_kompleks, function ($_0x39b5) {
 return $_0x39b5->tampilkan == "\x31";
 });
 goto L_3c8eb;
 L_89f06:
 $_0xef87->rekapsiswa = (array) $_0xef87->rekapsiswa;
 goto L_6b089;
 L_2cc6b:
 $_0xef87 = $this->getRekapWithSiswa($_0xbbde, $_0xda96);
 goto L_98821;
 L_c2005:
 $_0xef87->kelas_bank = $this->maybe_unserialize($_0xef87->kelas_bank);
 goto L_1b2d1;
 L_3c8eb:
 $_0x94f2 = array_filter($_0xef87->soal_jodohkan, function ($_0x39b5) {
 return $_0x39b5->tampilkan == "\x31";
 });
 goto L_0cd61;
 L_6b089:
 $this->createSkorSiswa($_0xef87, true);
 goto L_c7a08;
 L_0112d:
 $_0x4407["\x73\151\x73\167\x61"] = $_0x8eeb->sesisiswa;
 goto L_2f066;
 L_1ecc0:
 $_0xe03d = $this->getTpSmt();
 goto L_fadcc;
 L_82723:
 $_0xef87->soal_pg = $this->maybe_unserialize($_0xef87->soal_pg);
 goto L_6e2e5;
 L_c7a08:
 $_0x8eeb = $_0xef87->jadwal;
 goto L_b12c0;
 L_50914:
 $_0x4407["\x72\145\x6b\141\x70\137\x6d\141\x70\145\x6c"] = $_0xef87->nama_mapel;
 goto L_7c0f2;
 L_9d887:
 $_0x4407 = ["\x75\163\x65\162" => $_0xbce2, "\x6a\165\x64\165\x6c" => "\x4b\157\x72\145\x6b\163\x69\40\x48\141\x73\151\x6c\40\x53\151\x73\167\x61", "\x73\165\x62\152\x75\144\x75\154" => "\x48\141\x73\151\x6c\40\x53\151\x73\167\x61", "\x73\145\x74\164\x69\156\x67" => is_object($_0xaecd = \Config\Database::connect()->table("\x73\145\x74\164\x69\156\x67")->get()->getRow()) ? clone $_0xaecd : new \stdClass()];
 goto L_da802;
 }
 private function decodeIds($_0x90d7)
 {
 goto L_ce1c1;
 L_ce1c1:
 $_0x9822 = [];
 goto L_ad9ae;
 L_ad9ae:
 foreach ($_0x90d7 as $_0x1997) {
 try {
 $_0x30df = [];
 foreach ($_0x1997 as $_0xede1 => $_0x1d1a) {
 if ($_0xede1 == "\x69\144\x73") {
 $_0x159c = json_decode($_0x1d1a, true);
 if (json_last_error() !== JSON_ERROR_NONE || !is_array($_0x159c)) {
 throw new \Exception("\x45\162\x72\157\x72\40\x64\145\x63\157\x64\151\x6e\147\x20\112\x53\117\x4e\40\x69\156\x20\47\x69\144\x73\47\x20\146\x69\145\x6c\144\x2e");
 }
 foreach ($_0x159c as $_0x6451 => $_0x919a) {
 $_0x30df[$_0x6451] = $_0x919a;
 }
 } else {
 $_0x30df[$_0xede1] = $_0x1d1a;
 }
 }
 $_0x9822[] = $_0x30df;
 } catch (\Exception $_0xb25d) {
 error_log($_0xb25d->getMessage());
 continue;
 }
 }
 goto L_8b9bf;
 L_8b9bf:
 return $_0x9822;
 }
 /**
 * @throws \JsonException
 */
 public function inputEssai()
 {
 goto L_f9790;
 L_15990:
 $_0xaf38->pengawas = $this->maybe_unserialize($_0xaf38->pengawas);
 goto L_6bd7d;
 L_d30f4:
 $_0xaf38->soal_kompleks = array_filter($this->maybe_unserialize($_0xaf38->soal_kompleks), function ($_0x6eca) {
 return $_0x6eca->tampilkan == "\x31";
 });
 goto L_88fe4;
 L_8d368:
 foreach ($_0xaf38->rekapsiswa as $_0x369f => $_0xb2d1) {
 if ($_0xaf38->bank_soal->soal_agama != "\x2d" && $_0xaf38->bank_soal->soal_agama != "\x30" && $_0xaf38->bank_soal->soal_agama !== $_0xb2d1->siswa->agama) {
 unset($_0xaf38->rekapsiswa[$_0x369f]);
 }
 }
 goto L_0e080;
 L_e0439:
 $_0xaf38 = $this->getRekapWithSiswa($_0x3637, null, $_0xf343);
 goto L_94ad7;
 L_ed545:
 $_0x4847 = $_0xe2d6->tp_active;
 goto L_84154;
 L_0e080:
 $_0xaf38->rekapsiswa = array_values($_0xaf38->rekapsiswa);
 goto L_a7e7e;
 L_f21bf:
 $_0xaf38->bank_soal = $this->maybe_unserialize($_0xaf38->bank_soal);
 goto L_cb85f;
 L_3ebe8:
 $_0x5124["\x69\163\x5f\162\x65\153\x61\160"] = true;
 goto L_15990;
 L_3a8b8:
 $_0x5124["\x6a\141\x64\167\x61\154\x5f\163\x65\154\x65\143\x74\145\x64"] = $_0x3637;
 goto L_e0439;
 L_a7e7e:
 $this->createSkorSiswa($_0xaf38, false);
 goto L_57b68;
 L_31b03:
 $_0x5124["\x74\160"] = $_0xe2d6->tp;
 goto L_0e87b;
 L_0c650:
 $_0xe2d6 = $this->getTpSmt();
 goto L_ed545;
 L_d5bd0:
 $_0x5124["\x6b\145\x6c\141\x73\137\x73\145\x6c\145\x63\164\x65\144"] = $_0xf343;
 goto L_3a8b8;
 L_24e97:
 $_0x1f76 = session();
 goto L_676f0;
 L_94ad7:
 if (!$_0xaf38) {
 return view("\x65\162\x72\157\x72\163\x2f\150\x74\155\x6c\57\x65\162\x72\157\x72\137\x34\60\x34", ["\x6d\145\x73\163\x61\147\x65" => "\x44\141\x74\141\x20\162\x65\153\x61\160\x20\164\x69\144\x61\153\x20\144\x69\164\x65\155\x75\153\x61\156"]);
 }
 goto L_aff53;
 L_aff53:
 $_0xaf38->jadwal = $this->maybe_unserialize($_0xaf38->jadwal);
 goto L_f21bf;
 L_c8531:
 $_0xaf38->soal_esai = array_filter($this->maybe_unserialize($_0xaf38->soal_esai), function ($_0x6eca) {
 return $_0x6eca->tampilkan == "\x31";
 });
 goto L_58342;
 L_0e87b:
 $_0x5124["\x73\155\x74"] = $_0xe2d6->smt;
 goto L_179ff;
 L_57b68:
 $_0x5124["\x6a\141\x64\167\x61\154"] = $_0xaf38;
 goto L_566a6;
 L_676f0:
 $_0x8a59 = in_array((string) $_0x1f76->get("\x72\157\x6c\145"), ["\x31", "\x34"]);
 goto L_9bf36;
 L_265a3:
 foreach ($_0xaf38->kelas_bank as $_0x3517) {
 if (isset($_0x3517->id_kelas)) {
 $_0x2288[$_0x3517->id_kelas] = $_0x3517;
 }
 }
 goto L_84fa8;
 L_24b62:
 $_0x5124["\x73\155\x74\137\x61\143\x74\151\x76\145"] = $_0xffe2;
 goto L_d5bd0;
 L_58342:
 $_0xaf38->rekapsiswa = (array) $_0xaf38->rekapsiswa;
 goto L_8d368;
 L_e1a7a:
 $_0x3637 = $this->request->getGet("\x69\144\x5f\152\x61\144\x77\141\x6c");
 goto L_0c650;
 L_f9790:
 $_0xf343 = $this->request->getGet("\x69\144\x5f\153\x65\154\x61\163");
 goto L_e1a7a;
 L_215ba:
 $_0x2288 = [];
 goto L_265a3;
 L_84154:
 $_0xffe2 = $_0xe2d6->smt_active;
 goto L_24e97;
 L_84fa8:
 $_0x5124["\x6b\145\x6c\141\x73"] = $_0x2288[$_0xf343];
 goto L_3ebe8;
 L_88fe4:
 $_0xaf38->soal_jodohkan = array_filter($this->maybe_unserialize($_0xaf38->soal_jodohkan), function ($_0x6eca) {
 return $_0x6eca->tampilkan == "\x31";
 });
 goto L_86616;
 L_86616:
 $_0xaf38->soal_isian = array_filter($this->maybe_unserialize($_0xaf38->soal_isian), function ($_0x6eca) {
 return $_0x6eca->tampilkan == "\x31";
 });
 goto L_c8531;
 L_566a6:
 if ($_0x8a59) {
 return view("\x63\142\x74\57\x6e\151\x6c\141\x69\57\x69\156\x70\165\x74\137\x6e\151\x6c\141\x69", $_0x5124);
 } else {
 return view("\x63\142\x74\57\x6e\151\x6c\141\x69\57\x69\156\x70\165\x74\137\x6e\151\x6c\141\x69", $_0x5124);
 }
 L_179ff:
 $_0x5124["\x74\160\x5f\141\x63\164\x69\166\x65"] = $_0x4847;
 goto L_24b62;
 L_df7e2:
 $_0x5124 = ["\x75\163\x65\162" => $_0xe0c8, "\x6a\165\x64\165\x6c" => "\x49\156\x70\165\x74\40\x4e\151\x6c\141\x69\40\x4d\141\x6e\165\x61\154", "\x73\165\x62\152\x75\144\x75\154" => '', "\x70\162\x6f\146\x69\154\x65" => null, "\x73\145\x74\164\x69\156\x67" => is_object($_0x828d = \Config\Database::connect()->table("\x73\145\x74\164\x69\156\x67")->get()->getRow()) ? clone $_0x828d : new \stdClass()];
 goto L_31b03;
 L_6bd7d:
 $_0xaf38->soal_pg = array_filter($this->maybe_unserialize($_0xaf38->soal_pg), function ($_0x6eca) {
 return $_0x6eca->tampilkan == "\x31";
 });
 goto L_d30f4;
 L_9bf36:
 $_0xe0c8 = (object) ["\x69\144" => $_0x1f76->get("\x69\144\x5f\165\x73\145\x72"), "\x75\163\x65\162\x6e\141\x6d\145" => $_0x1f76->get("\x75\163\x65\162\x6e\141\x6d\145"), "\x66\151\x72\163\x74\137\x6e\141\x6d\145" => $_0x1f76->get("\x75\163\x65\162\x6e\141\x6d\145"), "\x72\157\x6c\145\x5f\156\x61\155\x65" => $_0x1f76->get("\x72\157\x6c\145\x5f\156\x61\155\x65"), "\x66\157\x74\157" => $_0x1f76->get("\x66\157\x74\157") ?? ''];
 goto L_df7e2;
 L_cb85f:
 $_0xaf38->kelas_bank = $this->maybe_unserialize($_0xaf38->kelas_bank);
 goto L_215ba;
 }
 public function hapusRekap()
 {
 goto L_f1312;
 L_4c2e3:
 $_0xa15c["\x74\157\x74\141\x6c"] = count($_0x50ad);
 goto L_d555d;
 L_67fec:
 // Delete from rekap tables
 $_0xad21 = $_0xd6ce->table("\x63\142\x74\137\x72\145\x6b\141\x70\137\x6a\141\x64\167\x61\154")->whereIn("\x69\144\x5f\152\x61\144\x77\141\x6c", $_0x50ad)->delete();
 goto L_57393;
 L_7eb32:
 $_0xa15c["\x73\165\x63\143\x65\163\x73"] = true;
 goto L_fe221;
 L_73dcc:
 if (!$this->isAdmin()) {
 $_0x69a3 = $this->getGuruContext();
 if (!$_0x69a3) {
 return $this->response->setJSON(["\x73\165\x63\143\x65\163\x73" => false, "\x6d\145\x73\163\x61\147\x65" => "\x41\153\x73\145\x73\40\x64\151\x74\157\x6c\141\x6b"]);
 }
 $_0xeb9f = $_0xd6ce->table("\x63\142\x74\137\x72\145\x6b\141\x70\137\x6a\141\x64\167\x61\154\x20\141")->select("\x61\56\x69\144\x5f\152\x61\144\x77\141\x6c")->join("\x63\142\x74\137\x62\141\x6e\153\x5f\163\x6f\141\x6c\40\x62", "\x62\56\x69\144\x5f\142\x61\156\x6b\40\x3d\40\x61\56\x69\144\x5f\142\x61\156\x6b", "\x6c\145\x66\164")->whereIn("\x61\56\x69\144\x5f\152\x61\144\x77\141\x6c", $_0x50ad)->groupStart()->where("\x61\56\x69\144\x5f\147\x75\162\x75", $_0x69a3->id_guru)->orWhere("\x62\56\x62\141\x6e\153\x5f\147\x75\162\x75\137\x69\144", $_0x69a3->id_guru);
 if (!empty($_0x69a3->mapel_ids)) {
 $_0xeb9f->orWhereIn("\x61\56\x69\144\x5f\155\x61\160\x65\154", $_0x69a3->mapel_ids);
 $_0xeb9f->orWhereIn("\x62\56\x62\141\x6e\153\x5f\155\x61\160\x65\154\x5f\151\x64", $_0x69a3->mapel_ids);
 }
 $_0xeb9f->groupEnd();
 $_0xe6bb = $_0xeb9f->get()->getResult();
 $_0xe3d8 = array_column($_0xe6bb, "\x69\144\x5f\152\x61\144\x77\141\x6c");
 $_0x50ad = array_values(array_intersect($_0x50ad, $_0xe3d8));
 if (empty($_0x50ad)) {
 return $this->response->setJSON(["\x73\165\x63\143\x65\163\x73" => false, "\x6d\145\x73\163\x61\147\x65" => "\x41\156\x64\141\x20\164\x69\144\x61\153\x20\155\x65\155\x69\154\x69\153\x69\40\x68\141\x6b\40\x75\156\x74\165\x6b\40\x6d\145\x6e\147\x68\141\x70\165\x73\40\x72\145\x6b\141\x70\57\x6a\141\x64\167\x61\154\x20\155\x61\160\x65\154\x20\151\x6e\151\x2e"]);
 }
 }
 goto L_4c2e3;
 L_f2ddb:
 $this->logging->saveLog(5, "\x4d\145\x6e\147\x68\141\x70\165\x73\40\x72\145\x6b\141\x70\40\x2f\40\x6a\141\x64\167\x61\154\x20\165\x6a\151\x61\156");
 goto L_8eceb;
 L_f1312:
 $_0xd6ce = \Config\Database::connect();
 goto L_1b64f;
 L_8eceb:
 session()->setFlashdata("\x72\145\x6b\141\x70\156\x69\154\x61\151", "\x3c\144\x69\166\x20\151\x64\75\x22\146\x6c\141\x73\150\x64\141\x74\141\x22\40\x63\154\x61\163\x73\75\x22\141\x6c\145\x72\164\x20\141\x6c\145\x72\164\x2d\144\x65\146\x61\165\x6c\164\x2d\163\x75\143\x63\145\x73\163\x20\141\x6c\151\x67\156\x2d\143\x6f\156\x74\145\x6e\164\x2d\143\x65\156\x74\145\x72\40\x77\55\x31\60\x30\42\x20\162\x6f\154\x65\75\x22\141\x6c\145\x72\164\x22\76\x20\102\x65\162\x68\141\x73\151\x6c\40\x6d\145\x6e\147\x68\141\x70\165\x73\40\x3c\142\x3e" . count($_0x50ad) . "\x3c\57\x62\76\x20\144\x61\164\x61\40\x3c\57\x64\151\x76\76");
 goto L_7f337;
 L_d555d:
 $_0x225f = $this->request->getPost("\x68\141\x70\165\x73\137\x6a\141\x64\167\x61\154");
 goto L_67fec;
 L_33f00:
 if ($_0x225f == "\x31" || $this->request->getPost("\x68\141\x70\165\x73\137\x61\154\x6c") == "\x31") {
 $_0xd6ce->table("\x63\142\x74\137\x6a\141\x64\167\x61\154")->whereIn("\x69\144\x5f\152\x61\144\x77\141\x6c", $_0x50ad)->delete();
 $_0xd6ce->table("\x63\142\x74\137\x73\151\x73\167\x61")->whereIn("\x69\144\x5f\152\x61\144\x77\141\x6c", $_0x50ad)->delete();
 $_0xd6ce->table("\x63\142\x74\137\x70\145\x6e\147\x61\167\x61\163")->whereIn("\x69\144\x5f\152\x61\144\x77\141\x6c", $_0x50ad)->delete();
 $_0xd6ce->table("\x63\142\x74\137\x73\157\x61\154\x5f\163\x69\163\x77\141")->whereIn("\x69\144\x5f\152\x61\144\x77\141\x6c", $_0x50ad)->delete();
 $_0xd6ce->table("\x63\142\x74\137\x6e\151\x6c\141\x69")->whereIn("\x69\144\x5f\152\x61\144\x77\141\x6c", $_0x50ad)->delete();
 } else {
 $_0xd6ce->table("\x63\142\x74\137\x6a\141\x64\167\x61\154")->whereIn("\x69\144\x5f\152\x61\144\x77\141\x6c", $_0x50ad)->update(["\x72\145\x6b\141\x70" => "\x30"]);
 }
 goto L_f2ddb;
 L_57393:
 $_0x2706 = $_0xd6ce->table("\x63\142\x74\137\x72\145\x6b\141\x70\137\x73\151\x73\167\x61")->whereIn("\x69\144\x5f\152\x61\144\x77\141\x6c", $_0x50ad)->delete();
 goto L_33f00;
 L_7f337:
 $_0xa15c["\x69\144\x73\137\x6a\141\x64\167\x61\154"] = $_0x50ad;
 goto L_7eb32;
 L_20cd3:
 if (empty($_0x50ad) || !is_array($_0x50ad)) {
 return $this->response->setJSON(["\x73\165\x63\143\x65\163\x73" => false, "\x6d\145\x73\163\x61\147\x65" => "\x54\151\x64\141\x6b\40\x61\144\x61\40\x64\141\x74\141\x20\144\x69\160\x69\154\x69\150"]);
 }
 goto L_73dcc;
 L_fe221:
 return $this->response->setJSON($_0xa15c);
 L_1b64f:
 $_0x50ad = json_decode($this->request->getPost("\x69\144\x73"));
 goto L_20cd3;
 }
 private function getRekapWithSiswa($_0xef67, $_0xbefa = null, $_0x3e10 = null)
 {
 goto L_71eb4;
 L_f4960:
 if ($_0xbefa != null) {
 $_0xf8d3->where("\x61\56\x69\144\x5f\163\x69\163\x77\141", $_0xbefa);
 }
 goto L_bc984;
 L_71eb4:
 $_0x86ea = \Config\Database::connect();
 goto L_c239f;
 L_555b5:
 $_0xf8d3 = $_0x86ea->table("\x63\142\x74\137\x72\145\x6b\141\x70\137\x73\151\x73\167\x61\40\x61")->select("\x61\56\x2a\54\x20\142\x2e\156\x61\155\x61\54\x20\142\x2e\156\x69\163\x2c\40\x62\56\x6e\151\x73\156\x2c\40\x62\56\x75\163\x65\162\x6e\141\x6d\145\x2c\40\x62\56\x6a\145\x6e\151\x73\137\x6b\145\x6c\141\x6d\151\x6e\54\x20\142\x2e\141\x67\141\x6d\141")->join("\x6d\141\x73\164\x65\162\x5f\163\x69\163\x77\141\x20\142", "\x61\56\x69\144\x5f\163\x69\163\x77\141\x3d\142\x2e\151\x64\137\x73\151\x73\167\x61", "\x6c\145\x66\164")->where("\x61\56\x69\144\x5f\152\x61\144\x77\141\x6c", $_0xef67);
 goto L_f4960;
 L_c239f:
 $_0xa548 = $_0x86ea->table("\x63\142\x74\137\x72\145\x6b\141\x70\137\x6a\141\x64\167\x61\154")->where("\x69\144\x5f\152\x61\144\x77\141\x6c", $_0xef67)->get()->getRow();
 goto L_8bfe5;
 L_7e27a:
 foreach ($_0xb8a1 as $_0x1836) {
 $_0x1836->siswa = (object) ["\x69\144\x5f\163\x69\163\x77\141" => $_0x1836->id_siswa, "\x6e\141\x6d\141" => $_0x1836->nama, "\x6e\151\x73" => $_0x1836->nis, "\x6e\151\x73\156" => $_0x1836->nisn, "\x75\163\x65\162\x6e\141\x6d\145" => $_0x1836->username, "\x61\147\x61\155\x61" => $_0x1836->agama];
 $_0x14f8[$_0x1836->id_siswa] = $_0x1836;
 }
 goto L_08817;
 L_a1da3:
 $_0x14f8 = [];
 goto L_7e27a;
 L_bc984:
 if ($_0x3e10 != null) {
 $_0xf8d3->where("\x61\56\x69\144\x5f\153\x65\154\x61\163", $_0x3e10);
 }
 goto L_738bc;
 L_738bc:
 $_0xb8a1 = $_0xf8d3->get()->getResult();
 goto L_a1da3;
 L_206d7:
 return $_0xa548;
 L_8bfe5:
 if (!$_0xa548) {
 return null;
 }
 goto L_555b5;
 L_08817:
 $_0xa548->rekapsiswa = $_0x14f8;
 goto L_206d7;
 }
 public function export_all()
 {
 goto L_660b9;
 L_f0a28:
 return view("\x63\142\x74\57\x72\145\x6b\141\x70\57\x65\153\x73\160\x6f\162\x5f\141\x6c\154", $_0x6e0f);
 L_ac8af:
 $_0x1ef0 = \Config\Database::connect();
 goto L_5b80f;
 L_d8943:
 if (!$_0xb572) {
 $_0xd1f7 = $this->getGuruContext();
 if ($_0xd1f7) {
 $_0xe1c8->join("\x63\142\x74\137\x62\141\x6e\153\x5f\163\x6f\141\x6c\40\x62", "\x62\56\x69\144\x5f\142\x61\156\x6b\40\x3d\40\x61\56\x69\144\x5f\142\x61\156\x6b", "\x6c\145\x66\164");
 $_0xe1c8->groupStart();
 $_0xe1c8->where("\x61\56\x69\144\x5f\147\x75\162\x75", $_0xd1f7->id_guru);
 $_0xe1c8->orWhere("\x62\56\x62\141\x6e\153\x5f\147\x75\162\x75\137\x69\144", $_0xd1f7->id_guru);
 if (!empty($_0xd1f7->mapel_ids)) {
 $_0xe1c8->orWhereIn("\x61\56\x69\144\x5f\155\x61\160\x65\154", $_0xd1f7->mapel_ids);
 $_0xe1c8->orWhereIn("\x62\56\x62\141\x6e\153\x5f\155\x61\160\x65\154\x5f\151\x64", $_0xd1f7->mapel_ids);
 }
 $_0xe1c8->groupEnd();
 $_0x6e0f["\x67\165\x72\165"] = $_0xd1f7->guru;
 }
 }
 goto L_aa42c;
 L_5b80f:
 $_0xe1c8 = $_0x1ef0->table("\x63\142\x74\137\x72\145\x6b\141\x70\137\x6a\141\x64\167\x61\154\x20\141")->select("\x61\56\x69\144\x5f\162\x65\153\x61\160\x2c\40\x61\56\x69\144\x5f\164\x70\54\x20\141\x2e\164\x70\54\x20\141\x2e\151\x64\137\x73\155\x74\54\x20\141\x2e\163\x6d\164\x2c\40\x61\56\x69\144\x5f\152\x61\144\x77\141\x6c\54\x20\141\x2e\151\x64\137\x6a\145\x6e\151\x73\54\x20\141\x2e\153\x6f\144\x65\137\x6a\145\x6e\151\x73\54\x20\141\x2e\153\x65\154\x61\163\x5f\142\x61\156\x6b");
 goto L_d8943;
 L_aa42c:
 $_0xcec5 = $_0xe1c8->get()->getResult();
 goto L_e24bf;
 L_41821:
 $_0xb572 = $this->isAdmin();
 goto L_62631;
 L_62631:
 $_0x28f6 = (object) ["\x69\144" => $_0x2e86->get("\x69\144\x5f\165\x73\145\x72"), "\x75\163\x65\162\x6e\141\x6d\145" => $_0x2e86->get("\x75\163\x65\162\x6e\141\x6d\145")];
 goto L_9e772;
 L_e43f2:
 $_0x6e0f["\x73\155\x74"] = (new \App\Models\DashboardModel())->getSemester();
 goto L_ccae0;
 L_9e772:
 $_0x6e0f = ["\x75\163\x65\162" => $_0x28f6, "\x6a\165\x64\165\x6c" => "\x45\153\x73\160\x6f\162\x20\110\x61\163\x69\154\x20\120\x65\156\x69\154\x61\151\x61\156", "\x73\165\x62\152\x75\144\x75\154" => "\x45\153\x73\160\x6f\162\x20\116\x69\154\x61\151", "\x73\145\x74\164\x69\156\x67" => (new \App\Models\DashboardModel())->getSetting()];
 goto L_ccdb5;
 L_ccae0:
 $_0x6e0f["\x73\155\x74\137\x61\143\x74\151\x76\145"] = $_0xb0a3;
 goto L_ac8af;
 L_c5b3c:
 $_0x6e0f["\x74\160\x5f\141\x63\164\x69\166\x65"] = $_0xc225;
 goto L_e43f2;
 L_d6cea:
 $_0x6e0f["\x74\160"] = (new \App\Models\DashboardModel())->getTahun();
 goto L_c5b3c;
 L_e24bf:
 if ($_0xcec5) {
 $_0x35a6 = [];
 $_0xc018 = [];
 $_0xb454 = [];
 $_0xca14 = [];
 foreach ($_0xcec5 as $_0x3e27) {
 $_0xb454[$_0x3e27->id_tp] = $_0x3e27->tp;
 $_0xca14[$_0x3e27->id_smt] = $_0x3e27->smt;
 $_0x35a6[$_0x3e27->id_tp][$_0x3e27->id_smt][$_0x3e27->id_jenis] = $_0x3e27->kode_jenis;
 $_0x3e27->kelas_bank = $this->maybe_unserialize($_0x3e27->kelas_bank);
 if (is_array($_0x3e27->kelas_bank)) {
 foreach ($_0x3e27->kelas_bank as $_0x58b8) {
 $_0x41c2 = is_array($_0x58b8) ? $_0x58b8["\x69\144\x5f\153\x65\154\x61\163"] ?? $_0x58b8["\x6b\145\x6c\141\x73\137\x69\144"] ?? null : $_0x58b8->id_kelas ?? $_0x58b8->kelas_id ?? null;
 $_0x7578 = is_array($_0x58b8) ? $_0x58b8["\x6e\141\x6d\141\x5f\153\x65\154\x61\163"] ?? null : $_0x58b8->nama_kelas ?? null;
 if ($_0x41c2 && $_0x7578) {
 $_0xc018[$_0x3e27->id_tp][$_0x3e27->id_smt][$_0x3e27->id_jenis][$_0x41c2] = $_0x7578;
 }
 }
 }
 unset($_0x3e27->kelas_bank);
 }
 $_0x6e0f["\x6a\145\x6e\151\x73"] = $_0x35a6;
 $_0x6e0f["\x6b\145\x6c\141\x73"] = $_0xc018;
 $_0x6e0f["\x74\141\x68\165\x6e\163"] = $_0xb454;
 $_0x6e0f["\x73\145\x6d\145\x73\164\x65\162"] = $_0xca14;
 $_0x6e0f["\x61\154\x6c\137\x72\145\x6b\141\x70"] = count($_0xcec5);
 }
 goto L_f0a28;
 L_660b9:
 $_0x2e86 = session();
 goto L_41821;
 L_ccdb5:
 $_0xc225 = (new \App\Models\DashboardModel())->getTahunActive();
 goto L_ab23f;
 L_ab23f:
 $_0xb0a3 = (new \App\Models\DashboardModel())->getSemesterActive();
 goto L_d6cea;
 }
 public function getNilaiKelas()
 {
 goto L_75d28;
 L_9877c:
 foreach ($_0x7188 as $_0x1001) {
 $_0xea50 = $_0x2cc6->table("\x63\142\x74\137\x72\145\x6b\141\x70\137\x73\151\x73\167\x61\40\x61")->select("\x61\56\x2a\54\x20\142\x2e\156\x61\155\x61\54\x20\142\x2e\156\x69\163\x2c\40\x62\56\x6e\151\x73\156\x2c\40\x62\56\x75\163\x65\162\x6e\141\x6d\145\x2c\40\x62\56\x61\147\x61\155\x61")->join("\x6d\141\x73\164\x65\162\x5f\163\x69\163\x77\141\x20\142", "\x61\56\x69\144\x5f\163\x69\163\x77\141\x3d\142\x2e\151\x64\137\x73\151\x73\167\x61", "\x6c\145\x66\164")->where("\x61\56\x69\144\x5f\152\x61\144\x77\141\x6c", $_0x1001->id_jadwal)->where("\x61\56\x69\144\x5f\153\x65\154\x61\163", $_0xb6c4)->get()->getResult();
 $_0x21a3 = [];
 foreach ($_0xea50 as $_0x3aad) {
 $_0x3aad->siswa = (object) ["\x69\144\x5f\163\x69\163\x77\141" => $_0x3aad->id_siswa, "\x6e\141\x6d\141" => $_0x3aad->nama, "\x6e\151\x73" => $_0x3aad->nis, "\x6e\151\x73\156" => $_0x3aad->nisn, "\x75\163\x65\162\x6e\141\x6d\145" => $_0x3aad->username, "\x61\147\x61\155\x61" => $_0x3aad->agama];
 $_0x21a3[$_0x3aad->id_siswa] = $_0x3aad;
 }
 $_0x1001->rekapsiswa = $_0x21a3;
 $_0x1001->pengawas = $this->maybe_unserialize($_0x1001->pengawas);
 $_0x1001->jadwal = $this->maybe_unserialize($_0x1001->jadwal);
 $_0x1001->bank_soal = $this->maybe_unserialize($_0x1001->bank_soal);
 $_0x1001->kelas_bank = $this->maybe_unserialize($_0x1001->kelas_bank);
 $_0x7d8f = [];
 if (is_array($_0x1001->kelas_bank)) {
 foreach ($_0x1001->kelas_bank as $_0x4860) {
 $_0xc866 = is_array($_0x4860) ? $_0x4860["\x69\144\x5f\153\x65\154\x61\163"] ?? $_0x4860["\x6b\145\x6c\141\x73\137\x69\144"] ?? null : $_0x4860->id_kelas ?? $_0x4860->kelas_id ?? null;
 if ($_0xc866) {
 $_0x7d8f[] = ["\x6b\145\x6c\141\x73\137\x69\144" => $_0xc866];
 }
 }
 }
 $_0x1001->bank_kelas = $_0x7d8f;
 $_0x36a1 = array_filter((array) $this->maybe_unserialize($_0x1001->soal_pg), function ($_0x216c) {
 return is_object($_0x216c) && isset($_0x216c->tampilkan) && $_0x216c->tampilkan == "\x31";
 });
 $_0xf842 = array_filter((array) $this->maybe_unserialize($_0x1001->soal_kompleks), function ($_0x216c) {
 return is_object($_0x216c) && isset($_0x216c->tampilkan) && $_0x216c->tampilkan == "\x31";
 });
 $_0x5c2b = array_filter((array) $this->maybe_unserialize($_0x1001->soal_jodohkan), function ($_0x216c) {
 return is_object($_0x216c) && isset($_0x216c->tampilkan) && $_0x216c->tampilkan == "\x31";
 });
 $_0x990c = array_filter((array) $this->maybe_unserialize($_0x1001->soal_isian), function ($_0x216c) {
 return is_object($_0x216c) && isset($_0x216c->tampilkan) && $_0x216c->tampilkan == "\x31";
 });
 $_0x3a08 = array_filter((array) $this->maybe_unserialize($_0x1001->soal_esai), function ($_0x216c) {
 return is_object($_0x216c) && isset($_0x216c->tampilkan) && $_0x216c->tampilkan == "\x31";
 });
 $_0x1001->soal_pg = array_values($_0x36a1);
 $_0x1001->soal_kompleks = array_values($_0xf842);
 $_0x1001->soal_jodohkan = array_values($_0x5c2b);
 $_0x1001->soal_isian = array_values($_0x990c);
 $_0x1001->soal_esai = array_values($_0x3a08);
 $this->createSkorSiswa($_0x1001, false);
 }
 goto L_53e64;
 L_d8553:
 if (!$_0xe9bf) {
 $_0x8a57 = $this->getGuruContext();
 if ($_0x8a57) {
 $_0x9342 = $_0x2cc6->table("\x63\142\x74\137\x72\145\x6b\141\x70\137\x6a\141\x64\167\x61\154\x20\141")->join("\x63\142\x74\137\x62\141\x6e\153\x5f\163\x6f\141\x6c\40\x62", "\x62\56\x69\144\x5f\142\x61\156\x6b\40\x3d\40\x61\56\x69\144\x5f\142\x61\156\x6b", "\x6c\145\x66\164")->where("\x61\56\x69\144\x5f\164\x70", $_0x186d)->where("\x61\56\x69\144\x5f\163\x6d\164", $_0x50d3)->where("\x61\56\x69\144\x5f\152\x65\156\x69\163", $_0x6051)->groupStart()->where("\x61\56\x69\144\x5f\147\x75\162\x75", $_0x8a57->id_guru)->orWhere("\x62\56\x62\141\x6e\153\x5f\147\x75\162\x75\137\x69\144", $_0x8a57->id_guru);
 if (!empty($_0x8a57->mapel_ids)) {
 $_0x9342->orWhereIn("\x61\56\x69\144\x5f\155\x61\160\x65\154", $_0x8a57->mapel_ids);
 $_0x9342->orWhereIn("\x62\56\x62\141\x6e\153\x5f\155\x61\160\x65\154\x5f\151\x64", $_0x8a57->mapel_ids);
 }
 $_0x9342->groupEnd();
 $_0x7188 = $_0x9342->get()->getResult();
 } else {
 $_0x7188 = [];
 }
 } else {
 $_0x7188 = $_0x2cc6->table("\x63\142\x74\137\x72\145\x6b\141\x70\137\x6a\141\x64\167\x61\154")->where($_0x4f32)->get()->getResult();
 }
 goto L_9877c;
 L_4899c:
 $_0x186d = $this->request->getGet("\x74\141\x68\165\x6e");
 goto L_e7f66;
 L_e7f66:
 $_0x50d3 = $this->request->getGet("\x73\155\x74");
 goto L_8b53d;
 L_53e64:
 return $this->response->setJSON($_0x5bb3);
 L_fbf78:
 $_0x8ef0 = [];
 goto L_eb32c;
 L_864bd:
 $_0xd4da = $_0x2cc6->table("\x63\142\x74\137\x73\145\x73\151\x5f\163\x69\163\x77\141\x20\141")->select("\x61\56\x2a\54\x20\142\x2e\151\x64\137\x73\151\x73\167\x61\54\x20\142\x2e\156\x69\163\x2c\40\x62\56\x6e\151\x73\156\x2c\40\x62\56\x6e\141\x6d\141\x2c\40\x62\56\x61\147\x61\155\x61\54\x20\143\x2e\156\x6f\155\x6f\162\x5f\160\x65\163\x65\162\x74\141")->join("\x6d\141\x73\164\x65\162\x5f\163\x69\163\x77\141\x20\142", "\x61\56\x73\151\x73\167\x61\137\x69\144\x3d\142\x2e\151\x64\137\x73\151\x73\167\x61", "\x6c\145\x66\164")->join("\x63\142\x74\137\x6e\157\x6d\157\x72\137\x70\145\x73\145\x72\164\x61\40\x63", "\x61\56\x73\151\x73\167\x61\137\x69\144\x3d\143\x2e\151\x64\137\x73\151\x73\167\x61", "\x6c\145\x66\164")->where("\x61\56\x6b\145\x6c\141\x73\137\x69\144", $_0xb6c4)->where("\x61\56\x74\160\x5f\151\x64", $_0x186d)->where("\x61\56\x73\155\x74\137\x69\144", $_0x50d3)->get()->getResult();
 goto L_fbf78;
 L_eb32c:
 foreach ($_0xd4da as $_0x9524) {
 $_0x9524->siswa = (object) ["\x69\144\x5f\163\x69\163\x77\141" => $_0x9524->id_siswa, "\x6e\151\x73" => $_0x9524->nis, "\x6e\151\x73\156" => $_0x9524->nisn, "\x6e\141\x6d\141" => $_0x9524->nama, "\x61\147\x61\155\x61" => $_0x9524->agama];
 $_0x9524->peserta = (object) ["\x6e\157\x6d\157\x72\137\x70\145\x73\145\x72\164\x61" => $_0x9524->nomor_peserta];
 $_0x8ef0[] = $_0x9524;
 }
 goto L_26ab6;
 L_26ab6:
 $_0x4f32 = ["\x69\144\x5f\164\x70" => $_0x186d, "\x69\144\x5f\163\x6d\164" => $_0x50d3, "\x69\144\x5f\152\x65\156\x69\163" => $_0x6051];
 goto L_d8553;
 L_75d28:
 $_0xb6c4 = $this->request->getGet("\x6b\145\x6c\141\x73");
 goto L_3ed8e;
 L_3ed8e:
 $_0x6051 = $this->request->getGet("\x6a\145\x6e\151\x73");
 goto L_4899c;
 L_dfad1:
 $_0x2cc6 = \Config\Database::connect();
 goto L_864bd;
 L_8b53d:
 $_0x658b = session();
 goto L_640f5;
 L_640f5:
 $_0xe9bf = $this->isAdmin();
 goto L_23ecd;
 L_23ecd:
 $_0x8443 = (object) ["\x69\144" => $_0x658b->get("\x69\144\x5f\165\x73\145\x72"), "\x75\163\x65\162\x6e\141\x6d\145" => $_0x658b->get("\x75\163\x65\162\x6e\141\x6d\145")];
 goto L_dfad1;
 }
}