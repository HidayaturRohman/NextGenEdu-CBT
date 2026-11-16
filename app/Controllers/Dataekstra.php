<?php
/*   ________________________________________
    |               NextGen Garuda CBT       |
    |    Protected & Distributed via GitHub  |
    |________________________________________|
*/
namespace App\Controllers;

use Nextgen\DataTables\DataTable;
use App\Models\MasterModel;
use App\Models\DashboardModel;
use App\Models\DropdownModel;
use App\Models\KelasModel;
class Dataekstra extends BaseController
{
 protected $masterModel;
 protected $dashboardModel;
 protected $dropdownModel;
 protected $kelasModel;
 public function __construct()
 {
 goto L_9fe28;
 L_50175:
 $this->dropdownModel = new DropdownModel();
 goto L_58f71;
 L_58f71:
 $this->kelasModel = new KelasModel();
 L_ed4d1:
 $this->dashboardModel = new DashboardModel();
 goto L_50175;
 L_9fe28:
 $this->masterModel = new MasterModel();
 goto L_ed4d1;
 }
 public function index()
 {
 goto L_d3e04;
 L_51989:
 $_0x3047["\x74\160"] = $this->dashboardModel->getTahun();
 goto L_9da5c;
 L_45c25:
 $_0x3047["\x6b\145\x6c\141\x73"] = $_0xa9f6;
 goto L_872e7;
 L_71080:
 if ($_0xa9f6) {
 foreach ($_0xa9f6 as $_0x8aec => $_0x8d74) {
 $_0x4878 = $this->kelasModel->getKelasEkskul($_0x8aec, $_0xfa78->id_tp, $_0x107d->id_smt);
 foreach ($_0x4878 as $_0xbf04) {
 $_0xbf04->ekstra = $this->maybe_unserialize($_0xbf04->ekstra);
 }
 $_0xc4e8[$_0x8aec] = $_0x4878;
 }
 }
 goto L_8f991;
 L_872e7:
 $_0x3047["\x70\145\x6d\142\x69\155\x62\151\x6e\147"] = $this->dropdownModel->getAllGuru();
 goto L_eb199;
 L_5205e:
 $_0x6df4 = ["\x66\151\x72\163\x74\137\x6e\141\x6d\145" => $_0x7f5b->get("\x75\163\x65\162\x6e\141\x6d\145"), "\x72\157\x6c\145\x5f\156\x61\155\x65" => $_0x7f5b->get("\x72\157\x6c\145\x5f\156\x61\155\x65"), "\x66\157\x74\157" => $_0x7f5b->get("\x66\157\x74\157") ?? ''];
 goto L_3faca;
 L_8c7d2:
 $_0xfa78 = $this->dashboardModel->getTahunActive();
 goto L_97f92;
 L_9da5c:
 $_0x3047["\x74\160\x5f\141\x63\164\x69\166\x65"] = $_0xfa78;
 goto L_37314;
 L_37314:
 $_0x3047["\x73\155\x74"] = $this->dashboardModel->getSemester();
 goto L_fdba3;
 L_176b3:
 $_0xa9f6 = $this->dropdownModel->getAllKelas($_0xfa78->id_tp, $_0x107d->id_smt);
 goto L_d05cb;
 L_fdba3:
 $_0x3047["\x73\155\x74\137\x61\143\x74\151\x76\145"] = $_0x107d;
 goto L_476b0;
 L_97f92:
 $_0x107d = $this->dashboardModel->getSemesterActive();
 goto L_51989;
 L_8f991:
 $_0x3047["\x65\153\x73\153\x75\154\x5f\153\x65\154\x61\163"] = $_0xc4e8;
 goto L_45c25;
 L_eb199:
 return view("\x6d\141\x73\164\x65\162\x2f\145\x6b\163\x74\162\x61\57\x64\141\x74\141", $_0x3047);
 L_d3e04:
 $_0x7f5b = session();
 goto L_e4d96;
 L_d05cb:
 $_0xc4e8 = [];
 goto L_71080;
 L_476b0:
 $_0x3047["\x65\153\x73\153\x75\154"] = $this->dropdownModel->getAllEkskul();
 goto L_176b3;
 L_e4d96:
 if (!$_0x7f5b->get("\x69\163\x5f\154\x6f\147\x69\156")) {
 return redirect()->to("\x61\165\x74\150\x2f\154\x6f\147\x69\156");
 } elseif (!in_array((string) $_0x7f5b->get("\x72\157\x6c\145"), ["\x31", "\x34"])) {
 return redirect()->to("\x64\141\x73\150\x62\157\x61\162\x64")->with("\x65\162\x72\157\x72", "\x41\153\x73\145\x73\40\x64\151\x74\157\x6c\141\x6b\72\x20\110\x61\156\x79\141\x20\101\x64\155\x69\156\x69\163\x74\162\x61\164\x6f\162\x20\171\x61\156\x67\40\x62\145\x72\150\x61\153\x20\155\x65\156\x67\145\x6c\157\x6c\141\x20\115\x61\163\x74\145\x72\40\x44\141\x74\141\x20\105\x6b\163\x74\162\x61\153\x75\162\x69\153\x75\154\x65\162\x2e");
 }
 goto L_5205e;
 L_3faca:
 $_0x3047 = ["\x75\163\x65\162" => $_0x6df4, "\x6a\165\x64\165\x6c" => "\x45\153\x73\164\x72\141\x6b\165\x72\151\x6b\165\x6c\145\x72", "\x73\165\x62\152\x75\144\x75\154" => "\x44\141\x74\141\x20\105\x6b\163\x74\162\x61\153\x75\162\x69\153\x75\154\x65\162", "\x70\162\x6f\146\x69\154\x65" => null, "\x73\145\x74\164\x69\156\x67" => $this->dashboardModel->getSetting()];
 goto L_8c7d2;
 }
 public function create()
 {
 goto L_5ef9e;
 L_58f45:
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => true, "\x6d\145\x73\163\x61\147\x65" => "\x44\141\x74\141\x20\142\x65\162\x68\141\x73\151\x6c\40\x64\151\x73\151\x6d\160\x61\156"]);
 L_5ef9e:
 $_0xc13d = ["\x6e\141\x6d\141\x5f\145\x6b\163\x74\162\x61" => $this->request->getPost("\x6e\141\x6d\141\x5f\145\x6b\163\x74\162\x61"), "\x6b\157\x64\145\x5f\145\x6b\163\x74\162\x61" => $this->request->getPost("\x6b\157\x64\145\x5f\145\x6b\163\x74\162\x61")];
 goto L_f8aa5;
 L_f8aa5:
 $_0x52d5 = db_connect();
 goto L_a2f17;
 L_a2f17:
 $_0x52d5->table("\x6d\141\x73\164\x65\162\x5f\145\x6b\163\x74\162\x61")->insert($_0xc13d);
 goto L_58f45;
 }
 public function read()
 {
 goto L_14ffa;
 L_9a45f:
 return DataTable::of($_0x12f2)->toJson(true);
 L_14ffa:
 $_0xbbb6 = db_connect();
 goto L_4fe92;
 L_4fe92:
 $_0x12f2 = $_0xbbb6->table("\x6d\141\x73\164\x65\162\x5f\145\x6b\163\x74\162\x61")->select("\x69\144\x5f\145\x6b\163\x74\162\x61\54\x20\156\x61\155\x61\137\x65\153\x73\164\x72\141\x2c\40\x6b\157\x64\145\x5f\145\x6b\163\x74\162\x61");
 goto L_9a45f;
 }
 public function update()
 {
 goto L_13a38;
 L_13a38:
 $_0x114a = $this->request->getPost("\x69\144\x5f\145\x6b\163\x74\162\x61");
 goto L_d0283;
 L_d0283:
 $_0x8610 = $this->request->getPost("\x6e\141\x6d\141\x5f\145\x6b\163\x74\162\x61");
 goto L_0ab9b;
 L_0ab9b:
 $_0x9435 = $this->request->getPost("\x6b\157\x64\145\x5f\145\x6b\163\x74\162\x61");
 goto L_93f2e;
 L_40a36:
 $_0xb200->table("\x6d\141\x73\164\x65\162\x5f\145\x6b\163\x74\162\x61")->where("\x69\144\x5f\145\x6b\163\x74\162\x61", $_0x114a)->update(["\x6e\141\x6d\141\x5f\145\x6b\163\x74\162\x61" => $_0x8610, "\x6b\157\x64\145\x5f\145\x6b\163\x74\162\x61" => $_0x9435]);
 goto L_05ba5;
 L_05ba5:
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => true, "\x6d\145\x73\163\x61\147\x65" => "\x44\141\x74\141\x20\142\x65\162\x68\141\x73\151\x6c\40\x64\151\x75\160\x64\141\x74\145"]);
 L_93f2e:
 $_0xb200 = db_connect();
 goto L_40a36;
 }
 public function delete($_0x18fc = null)
 {
 goto L_d4aed;
 L_6f7d3:
 if ($_0xaad4) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => true, "\x6d\145\x73\163\x61\147\x65" => "\x45\153\x73\153\x75\154\x20\142\x65\162\x68\141\x73\151\x6c\40\x64\151\x68\141\x70\165\x73"]);
 } else {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x45\153\x73\153\x75\154\x20\147\x61\147\x61\154\x20\144\x69\150\x61\160\x75\163"]);
 }
 L_05c8f:
 $_0xe0f1 = db_connect();
 goto L_267fe;
 L_d4aed:
 if ($_0x18fc === null) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x49\104\x20\164\x69\144\x61\153\x20\166\x61\154\x69\144"]);
 }
 goto L_05c8f;
 L_267fe:
 $_0xaad4 = $_0xe0f1->table("\x6d\141\x73\164\x65\162\x5f\145\x6b\163\x74\162\x61")->where("\x69\144\x5f\145\x6b\163\x74\162\x61", $_0x18fc)->delete();
 goto L_6f7d3;
 }
 public function delete_batch()
 {
 goto L_1d131;
 L_c83fc:
 if (empty($_0xc946) || !is_array($_0xc946)) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x54\151\x64\141\x6b\40\x61\144\x61\40\x64\141\x74\141\x20\171\x61\156\x67\40\x64\151\x70\151\x6c\151\x68"]);
 }
 goto L_ddb62;
 L_1d131:
 $_0xc946 = $this->request->getPost("\x69\144\x73");
 goto L_c83fc;
 L_bf54d:
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => true, "\x6d\145\x73\163\x61\147\x65" => count($_0xc946) . "\x20\144\x61\164\x61\40\x65\153\x73\153\x75\154\x20\142\x65\162\x68\141\x73\151\x6c\40\x64\151\x68\141\x70\165\x73"]);
 L_8c854:
 $_0xeff4->table("\x6d\141\x73\164\x65\162\x5f\145\x6b\163\x74\162\x61")->whereIn("\x69\144\x5f\145\x6b\163\x74\162\x61", $_0xc946)->delete();
 goto L_bf54d;
 L_ddb62:
 $_0xeff4 = db_connect();
 goto L_8c854;
 }
 public function detail($_0x4d60 = null)
 {
 goto L_ca31c;
 L_4a76e:
 $_0xe79c = db_connect();
 goto L_9ff9b;
 L_4ae67:
 $_0xebdf = ["\x75\163\x65\162" => $_0xc435, "\x6a\165\x64\165\x6c" => "\x44\145\x74\141\x69\154\x20\105\x6b\163\x74\162\x61\153\x75\162\x69\153\x75\154\x65\162", "\x73\165\x62\152\x75\144\x75\154" => $_0x9255 ? $_0x9255->nama_ekstra : "\x44\145\x74\141\x69\154", "\x73\145\x74\164\x69\156\x67" => $this->dashboardModel->getSetting(), "\x65\153\x73\164\x72\141" => $_0x9255];
 goto L_5fcec;
 L_ca31c:
 $_0x2daa = session();
 goto L_a01f2;
 L_9ff9b:
 $_0x9255 = $_0xe79c->table("\x6d\141\x73\164\x65\162\x5f\145\x6b\163\x74\162\x61")->where("\x69\144\x5f\145\x6b\163\x74\162\x61", $_0x4d60)->get()->getRow();
 goto L_4ae67;
 L_a01f2:
 if (!$_0x2daa->get("\x69\163\x5f\154\x6f\147\x69\156")) {
 return redirect()->to("\x61\165\x74\150\x2f\154\x6f\147\x69\156");
 }
 goto L_90787;
 L_90787:
 $_0xc435 = ["\x66\151\x72\163\x74\137\x6e\141\x6d\145" => $_0x2daa->get("\x75\163\x65\162\x6e\141\x6d\145"), "\x72\157\x6c\145\x5f\156\x61\155\x65" => $_0x2daa->get("\x72\157\x6c\145\x5f\156\x61\155\x65"), "\x66\157\x74\157" => $_0x2daa->get("\x66\157\x74\157") ?? ''];
 goto L_4a76e;
 L_5fcec:
 return view("\x6d\141\x73\164\x65\162\x2f\145\x6b\163\x74\162\x61\57\x64\145\x74\141\x69\154", $_0xebdf);
 }
 public function save()
 {
 goto L_d40d1;
 L_99a6a:
 $_0x8eed = db_connect();
 goto L_04bf6;
 L_71c1e:
 if (!$_0x5196) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false]);
 }
 goto L_b4029;
 L_e7265:
 $_0xe2d7 = $this->dashboardModel->getSemesterActive()->id_smt;
 goto L_9ccb2;
 L_de591:
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => true, "\x75\160\x64\141\x74\145" => $_0x60cd]);
 L_04bf6:
 foreach ($_0x5196 as $_0x262b => $_0x3381) {
 $_0x74db = $this->request->getPost("\x65\153\x73\153\x75\154" . $_0x3381->kls_id);
 $_0x1bf1 = [];
 if ($_0x74db) {
 if (is_array($_0x74db)) {
 foreach ($_0x74db as $_0x20f2) {
 if (!empty($_0x20f2)) {
 $_0x1bf1[] = ["\x65\153\x73\164\x72\141" => $_0x20f2];
 }
 }
 } else {
 $_0x1bf1[] = ["\x65\153\x73\164\x72\141" => $_0x74db];
 }
 }
 $_0x6736 = ["\x69\144\x5f\153\x65\154\x61\163\x5f\145\x6b\163\x74\162\x61" => $_0x3381->kls_id . $_0x5b5c . $_0xe2d7, "\x69\144\x5f\153\x65\154\x61\163" => $_0x3381->kls_id, "\x69\144\x5f\164\x70" => $_0x5b5c, "\x69\144\x5f\163\x6d\164" => $_0xe2d7, "\x65\153\x73\164\x72\141" => json_encode($_0x1bf1)];
 $_0xe41c = $_0x8eed->table("\x6b\145\x6c\141\x73\137\x65\153\x73\164\x72\141")->where("\x69\144\x5f\153\x65\154\x61\163\x5f\145\x6b\163\x74\162\x61", $_0x6736["\x69\144\x5f\153\x65\154\x61\163\x5f\145\x6b\163\x74\162\x61"])->countAllResults();
 if ($_0xe41c > 0) {
 $_0x60cd[] = $_0x8eed->table("\x6b\145\x6c\141\x73\137\x65\153\x73\164\x72\141")->where("\x69\144\x5f\153\x65\154\x61\163\x5f\145\x6b\163\x74\162\x61", $_0x6736["\x69\144\x5f\153\x65\154\x61\163\x5f\145\x6b\163\x74\162\x61"])->update($_0x6736);
 } else {
 $_0x60cd[] = $_0x8eed->table("\x6b\145\x6c\141\x73\137\x65\153\x73\164\x72\141")->insert($_0x6736);
 }
 }
 goto L_de591;
 L_b4029:
 $_0x5b5c = $this->dashboardModel->getTahunActive()->id_tp;
 goto L_e7265;
 L_d40d1:
 $_0x5196 = json_decode($this->request->getPost("\x6b\145\x6c\141\x73"));
 goto L_71c1e;
 L_9ccb2:
 $_0x60cd = [];
 goto L_99a6a;
 }
 public function import($_0xa9f8 = null)
 {
 goto L_4f052;
 L_c88e1:
 return view("\x6d\141\x73\164\x65\162\x2f\145\x6b\163\x74\162\x61\57\x69\155\x70\157\x72\164", $_0xcdef);
 L_87328:
 if ($_0xa9f8 != null) {
 $_0xcdef["\x69\155\x70\157\x72\164"] = $_0xa9f8;
 }
 goto L_c88e1;
 L_4f052:
 $_0x5419 = session();
 goto L_7dfb1;
 L_7dfb1:
 $_0xcdef = ["\x75\163\x65\162" => ["\x66\151\x72\163\x74\137\x6e\141\x6d\145" => $_0x5419->get("\x75\163\x65\162\x6e\141\x6d\145"), "\x72\157\x6c\145\x5f\156\x61\155\x65" => $_0x5419->get("\x72\157\x6c\145\x5f\156\x61\155\x65"), "\x66\157\x74\157" => $_0x5419->get("\x66\157\x74\157") ?? ''], "\x6a\165\x64\165\x6c" => "\x45\153\x73\164\x72\141\x6b\165\x72\151\x6b\165\x6c\145\x72", "\x73\165\x62\152\x75\144\x75\154" => "\x49\155\x70\157\x72\164\x20\105\x6b\163\x74\162\x61\153\x75\162\x69\153\x75\154\x65\162", "\x73\145\x74\164\x69\156\x67" => $this->dashboardModel->getSetting(), "\x74\160" => $this->dashboardModel->getTahun(), "\x74\160\x5f\141\x63\164\x69\166\x65" => $this->dashboardModel->getTahunActive(), "\x73\155\x74" => $this->dashboardModel->getSemester(), "\x73\155\x74\137\x61\143\x74\151\x76\145" => $this->dashboardModel->getSemesterActive()];
 goto L_87328;
 }
}