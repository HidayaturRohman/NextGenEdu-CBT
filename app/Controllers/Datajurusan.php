<?php
/*   ________________________________________
    |               NextGen Garuda CBT       |
    |    Protected & Distributed via GitHub  |
    |________________________________________|
*/
namespace App\Controllers;

use App\Models\DashboardModel;
use App\Models\DropdownModel;
use App\Models\LogModel;
use App\Models\MasterModel;
use Nextgen\DataTables\DataTable;
class Datajurusan extends BaseController
{
 protected $dashboardModel;
 protected $masterModel;
 protected $dropdownModel;
 protected $logModel;
 public function __construct()
 {
 goto L_fcaf7;
 L_7e41f:
 $this->masterModel = new MasterModel();
 goto L_96fa8;
 L_ece26:
 $this->logModel = new LogModel();
 L_96fa8:
 $this->dropdownModel = new DropdownModel();
 goto L_ece26;
 L_fcaf7:
 $this->dashboardModel = new DashboardModel();
 goto L_7e41f;
 }
 public function index()
 {
 goto L_8725d;
 L_77b55:
 $_0x3047["\x6a\165\x72\165\x73\141\x6e\137\x6d\141\x70\145\x6c\163"] = $_0x6f66;
 goto L_72351;
 L_19e42:
 $_0x4eef = [];
 goto L_c3942;
 L_65391:
 $_0x3047["\x6d\141\x70\145\x6c\137\x70\145\x6d\151\x6e\141\x74\141\x6e"] = $this->dropdownModel->getMapelPeminatan($_0x4eef);
 goto L_f3805;
 L_8725d:
 $_0xd0c7 = session();
 goto L_4b867;
 L_f3b7c:
 $_0x3047 = ["\x75\163\x65\162" => ["\x66\151\x72\163\x74\137\x6e\141\x6d\145" => $_0xd0c7->get("\x75\163\x65\162\x6e\141\x6d\145"), "\x72\157\x6c\145\x5f\156\x61\155\x65" => $_0xd0c7->get("\x72\157\x6c\145\x5f\156\x61\155\x65"), "\x66\157\x74\157" => $_0xd0c7->get("\x66\157\x74\157") ?? ''], "\x6a\165\x64\165\x6c" => "\x4a\165\x72\165\x73\141\x6e", "\x73\165\x62\152\x75\144\x75\154" => "\x44\141\x66\164\x61\162\x20\112\x75\162\x75\163\x61\156", "\x73\145\x74\164\x69\156\x67" => $this->dashboardModel->getSetting(), "\x74\160" => $this->dashboardModel->getTahun(), "\x74\160\x5f\141\x63\164\x69\166\x65" => $this->dashboardModel->getTahunActive(), "\x73\155\x74" => $this->dashboardModel->getSemester(), "\x73\155\x74\137\x61\143\x74\151\x76\145" => $this->dashboardModel->getSemesterActive()];
 goto L_0791a;
 L_72351:
 return view("\x6d\141\x73\164\x65\162\x2f\152\x75\162\x75\163\x61\156\x2f\144\x61\164\x61", $_0x3047);
 L_f3805:
 $_0x7763 = $this->masterModel->getDataJurusan();
 goto L_ca584;
 L_4b867:
 if (!$_0xd0c7->get("\x69\163\x5f\154\x6f\147\x69\156")) {
 return redirect()->to("\x61\165\x74\150\x2f\154\x6f\147\x69\156");
 } elseif (!in_array((string) $_0xd0c7->get("\x72\157\x6c\145"), ["\x31", "\x34"])) {
 // admin
 return redirect()->to("\x64\141\x73\150\x62\157\x61\162\x64")->with("\x65\162\x72\157\x72", "\x48\141\x6e\171\x61\40\x41\144\x6d\151\x6e\151\x73\164\x72\141\x74\157\x72\40\x79\141\x6e\147\x20\144\x69\142\x65\162\x69\40\x68\141\x6b\40\x75\156\x74\165\x6b\40\x6d\145\x6e\147\x61\153\x73\145\x73\40\x68\141\x6c\141\x6d\141\x6e\40\x69\156\x69");
 }
 goto L_f3b7c;
 L_ca584:
 $_0x6f66 = [];
 goto L_e23e5;
 L_c3942:
 foreach ($_0x4481 as $_0xc052) {
 $_0x4eef[] = $_0xc052->kode_kel_mapel;
 }
 goto L_65391;
 L_0791a:
 // Retrieve dropdown codes if DropdownModel logic is partially migrated. 
 // For Phase 3A, we'll keep it simple or use stubs if DropdownModel isn't ready.
 $_0x4481 = $this->dropdownModel->getAllKodePeminatan();
 goto L_76cb6;
 L_76cb6:
 $_0x3047["\x6b\157\x64\145\x5f\160\x65\155\x69\156\x61\164\x61\156"] = $_0x4481;
 goto L_19e42;
 L_39e44:
 $_0x3047["\x6a\165\x72\165\x73\141\x6e\163"] = $_0x7763;
 goto L_77b55;
 L_e23e5:
 foreach ($_0x7763 as $_0x11d3) {
 $_0x6f66[$_0x11d3->id_jurusan] = $this->masterModel->getDataJurusanMapel(explode("\x2c", $_0x11d3->mapel_peminatan ?? ''));
 }
 goto L_39e44;
 }
 public function data()
 {
 goto L_49c00;
 L_83a02:
 $_0x332a = $_0xbc75->table("\x6d\141\x73\164\x65\162\x5f\152\x75\162\x75\163\x61\156")->select("\x69\144\x5f\152\x75\162\x75\163\x61\156\x2c\40\x6e\141\x6d\141\x5f\152\x75\162\x75\163\x61\156\x2c\40\x6b\157\x64\145\x5f\152\x75\162\x75\163\x61\156\x2c\40\x6d\141\x70\145\x6c\137\x70\145\x6d\151\x6e\141\x74\141\x6e\54\x20\163\x74\141\x74\165\x73");
 goto L_2ba3c;
 L_2ba3c:
 return DataTable::of($_0x332a)->addNumbering("\x6e\157")->toJson(true);
 L_49c00:
 $_0xbc75 = db_connect();
 goto L_83a02;
 }
 public function add()
 {
 return $this->save();
 }
 public function update()
 {
 return $this->save();
 }
 public function save()
 {
 goto L_ae764;
 L_b4c91:
 $_0x6981 = $this->request->getPost("\x6d\157\x64\145");
 goto L_c47bf;
 L_ae764:
 $_0xcbdc = db_connect();
 goto L_adbf1;
 L_186fd:
 if ($_0xac99) {
 if (is_array($_0xac99)) {
 $_0xd810 = $_0xac99;
 } else {
 $_0xd810 = explode("\x2c", $_0xac99);
 }
 }
 goto L_b4c91;
 L_67038:
 $_0xd810 = [];
 goto L_0fd06;
 L_c47bf:
 if (empty($_0x6981)) {
 $_0x6981 = !empty($_0x664d) ? "\x65\144\x69\164" : "\x61\144\x64";
 }
 goto L_dc671;
 L_dc671:
 if ($_0x6981 == "\x65\144\x69\164" && !empty($_0x664d)) {
 $_0xbb98 = ["\x6e\141\x6d\141\x5f\152\x75\162\x75\163\x61\156" => $_0xc8ec, "\x6b\157\x64\145\x5f\152\x75\162\x75\163\x61\156" => $_0xc364, "\x6d\141\x70\145\x6c\137\x70\145\x6d\151\x6e\141\x74\141\x6e" => implode("\x2c", array_filter($_0xd810))];
 $_0xcbdc->table("\x6d\141\x73\164\x65\162\x5f\152\x75\162\x75\163\x61\156")->where("\x69\144\x5f\152\x75\162\x75\163\x61\156", $_0x664d)->update($_0xbb98);
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => true, "\x6d\145\x73\163\x61\147\x65" => "\x44\141\x74\141\x20\142\x65\162\x68\141\x73\151\x6c\40\x64\151\x75\160\x64\141\x74\145"]);
 } else {
 $_0xb8e1 = ["\x6e\141\x6d\141\x5f\152\x75\162\x75\163\x61\156" => $_0xc8ec, "\x6b\157\x64\145\x5f\152\x75\162\x75\163\x61\156" => $_0xc364, "\x6d\141\x70\145\x6c\137\x70\145\x6d\151\x6e\141\x74\141\x6e" => implode("\x2c", array_filter($_0xd810)), "\x73\164\x61\164\x75\163" => 1];
 $_0xcbdc->table("\x6d\141\x73\164\x65\162\x5f\152\x75\162\x75\163\x61\156")->insert($_0xb8e1);
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => true, "\x6d\145\x73\163\x61\147\x65" => "\x44\141\x74\141\x20\142\x65\162\x68\141\x73\151\x6c\40\x64\151\x74\141\x6d\142\x61\150\x6b\141\x6e"]);
 }
 L_0fd06:
 $_0xac99 = $this->request->getPost("\x6d\141\x70\145\x6c");
 goto L_186fd;
 L_ec08f:
 $_0xc8ec = $this->request->getPost("\x6e\141\x6d\141\x5f\152\x75\162\x75\163\x61\156");
 goto L_2e3da;
 L_adbf1:
 $_0x664d = $this->request->getPost("\x69\144\x5f\152\x75\162\x75\163\x61\156");
 goto L_ec08f;
 L_2e3da:
 $_0xc364 = $this->request->getPost("\x6b\157\x64\145\x5f\152\x75\162\x75\163\x61\156");
 goto L_67038;
 }
 public function delete()
 {
 goto L_c7ac1;
 L_6417f:
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => true, "\x74\157\x74\141\x6c" => count(is_array($_0x847f) ? $_0x847f : explode("\x2c", $_0x847f))]);
 L_c987a:
 $_0x97f6 = db_connect();
 goto L_04f5b;
 L_b26ad:
 if (!$_0x847f) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x74\157\x74\141\x6c" => "\x54\151\x64\141\x6b\40\x61\144\x61\40\x64\141\x74\141\x20\171\x61\156\x67\40\x64\151\x70\151\x6c\151\x68\41"]);
 }
 goto L_c987a;
 L_04f5b:
 // For simplicity in Phase 3A, we just delete the row if no constraints exist.
 if (is_array($_0x847f)) {
 $_0x97f6->table("\x6d\141\x73\164\x65\162\x5f\152\x75\162\x75\163\x61\156")->whereIn("\x69\144\x5f\152\x75\162\x75\163\x61\156", $_0x847f)->delete();
 } else {
 $_0x97f6->table("\x6d\141\x73\164\x65\162\x5f\152\x75\162\x75\163\x61\156")->where("\x69\144\x5f\152\x75\162\x75\163\x61\156", $_0x847f)->delete();
 }
 goto L_6417f;
 L_c7ac1:
 $_0x847f = $this->request->getPost("\x63\150\x65\143\x6b\145\x64");
 goto L_b26ad;
 }
 public function load_jurusan()
 {
 $_0x6997 = $this->masterModel->getDataJurusan();
 return $this->response->setJSON($_0x6997);
 }
 public function import($_0xffa2 = null)
 {
 goto L_1b4e8;
 L_5422b:
 $_0x9bb5 = ["\x75\163\x65\162" => ["\x66\151\x72\163\x74\137\x6e\141\x6d\145" => $_0x531b->get("\x75\163\x65\162\x6e\141\x6d\145"), "\x72\157\x6c\145\x5f\156\x61\155\x65" => $_0x531b->get("\x72\157\x6c\145\x5f\156\x61\155\x65"), "\x66\157\x74\157" => $_0x531b->get("\x66\157\x74\157") ?? ''], "\x6a\165\x64\165\x6c" => "\x49\155\x70\157\x72\164\x20\112\x75\162\x75\163\x61\156", "\x73\165\x62\152\x75\144\x75\154" => "\x49\155\x70\157\x72\164\x20\112\x75\162\x75\163\x61\156", "\x73\145\x74\164\x69\156\x67" => $this->dashboardModel->getSetting(), "\x74\160" => $this->dashboardModel->getTahun(), "\x74\160\x5f\141\x63\164\x69\166\x65" => $this->dashboardModel->getTahunActive(), "\x73\155\x74" => $this->dashboardModel->getSemester(), "\x73\155\x74\137\x61\143\x74\151\x76\145" => $this->dashboardModel->getSemesterActive()];
 goto L_73d33;
 L_73d33:
 if ($_0xffa2 != null) {
 $_0x9bb5["\x69\155\x70\157\x72\164"] = $_0xffa2;
 }
 goto L_29393;
 L_1b4e8:
 $_0x531b = session();
 goto L_5422b;
 L_29393:
 return view("\x6d\141\x73\164\x65\162\x2f\152\x75\162\x75\163\x61\156\x2f\151\x6d\160\x6f\162\x74", $_0x9bb5);
 }
 public function do_import()
 {
 goto L_f3837;
 L_f3837:
 $_0x72d6 = json_decode($this->request->getPost("\x6a\165\x72\165\x73\141\x6e"));
 goto L_9e10f;
 L_82acc:
 $_0x7e95 = db_connect();
 goto L_4e860;
 L_4e860:
 if (!empty($_0xf6e2)) {
 $_0x5bbc = $_0x7e95->table("\x6d\141\x73\164\x65\162\x5f\152\x75\162\x75\163\x61\156")->insertBatch($_0xf6e2);
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => $_0x5bbc]);
 }
 goto L_a0170;
 L_8be12:
 if ($_0x72d6) {
 foreach ($_0x72d6 as $_0xa04a) {
 $_0xf6e2[] = ["\x6e\141\x6d\141\x5f\152\x75\162\x75\163\x61\156" => $_0xa04a->nama, "\x6b\157\x64\145\x5f\152\x75\162\x75\163\x61\156" => $_0xa04a->kode, "\x73\164\x61\164\x75\163" => 1];
 }
 }
 goto L_82acc;
 L_9e10f:
 $_0xf6e2 = [];
 goto L_8be12;
 L_a0170:
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false]);
 }
}