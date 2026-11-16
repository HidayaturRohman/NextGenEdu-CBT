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
class Datamapel extends BaseController
{
 protected $dashboardModel;
 protected $masterModel;
 protected $dropdownModel;
 protected $logModel;
 public function __construct()
 {
 goto L_429ad;
 L_62dca:
 $this->logModel = new LogModel();
 L_fba0f:
 $this->masterModel = new MasterModel();
 goto L_640ff;
 L_640ff:
 $this->dropdownModel = new DropdownModel();
 goto L_62dca;
 L_429ad:
 $this->dashboardModel = new DashboardModel();
 goto L_fba0f;
 }
 public function index()
 {
 goto L_6bf9c;
 L_0810f:
 // Stub for now
 return view("\x6d\141\x73\164\x65\162\x2f\155\x61\160\x65\154\x2f\144\x61\164\x61", $_0x3047);
 L_4877d:
 $_0x3047["\x6b\141\x74\145\x67\157\x72\151"] = ["\x57\101\x4a\111\x42", "\x50\101\x49\40\x28\113\x65\155\x65\156\x61\147\x29", "\x50\105\x4d\111\x4e\101\x54\101\x4e\40\x41\113\x41\104\x45\115\x49\113", "\x41\113\x41\104\x45\115\x49\113\x20\113\x45\112\x55\122\x55\101\x4e", "\x4c\111\x4e\124\x41\123\x20\115\x49\116\x41\124", "\x4d\125\x4c\117\x4b"];
 goto L_6c6ab;
 L_2e130:
 $_0x3047 = ["\x75\163\x65\162" => ["\x66\151\x72\163\x74\137\x6e\141\x6d\145" => $_0x3ec9->get("\x75\163\x65\162\x6e\141\x6d\145"), "\x72\157\x6c\145\x5f\156\x61\155\x65" => $_0x3ec9->get("\x72\157\x6c\145\x5f\156\x61\155\x65"), "\x66\157\x74\157" => $_0x3ec9->get("\x66\157\x74\157") ?? ''], "\x6a\165\x64\165\x6c" => "\x4d\141\x74\141\x20\120\x65\154\x61\152\x61\162\x61\156", "\x73\165\x62\152\x75\144\x75\154" => "\x44\141\x66\164\x61\162\x20\115\x61\164\x61\40\x50\145\x6c\141\x6a\141\x72\141\x6e", "\x73\145\x74\164\x69\156\x67" => $_0xc80f, "\x74\160" => $this->dashboardModel->getTahun(), "\x74\160\x5f\141\x63\164\x69\166\x65" => $this->dashboardModel->getTahunActive(), "\x73\155\x74" => $this->dashboardModel->getSemester(), "\x73\155\x74\137\x61\143\x74\151\x76\145" => $this->dashboardModel->getSemesterActive()];
 goto L_4877d;
 L_f465a:
 $_0x3047["\x6d\141\x70\145\x6c\137\x6e\157\x6e\137\x61\153\x74\151\x66"] = [];
 goto L_0810f;
 L_ee985:
 $_0x3047["\x6b\145\x6c\157\x6d\160\x6f\153"] = $this->dropdownModel->getDataKelompokMapel();
 goto L_ede5f;
 L_4bd6d:
 $_0xc80f = $this->dashboardModel->getSetting();
 goto L_2e130;
 L_6bf9c:
 $_0x3ec9 = session();
 goto L_f2179;
 L_bb035:
 $_0x3047["\x73\165\x62\137\x6b\145\x6c\157\x6d\160\x6f\153\x5f\155\x61\160\x65\154"] = $this->masterModel->getDataSubKelompokMapel();
 goto L_ee985;
 L_ede5f:
 $_0x3047["\x73\164\x61\164\x75\163"] = ["\x4e\157\x6e\141\x6b\164\x69\146", "\x41\153\x74\151\x66"];
 goto L_f465a;
 L_6c6ab:
 $_0x3047["\x6b\145\x6c\157\x6d\160\x6f\153\x5f\155\x61\160\x65\154"] = $this->masterModel->getDataKelompokMapel();
 goto L_bb035;
 L_f2179:
 if (!$_0x3ec9->get("\x69\163\x5f\154\x6f\147\x69\156")) {
 return redirect()->to("\x61\165\x74\150\x2f\154\x6f\147\x69\156");
 } elseif (!in_array((string) $_0x3ec9->get("\x72\157\x6c\145"), ["\x31", "\x34"])) {
 return redirect()->to("\x64\141\x73\150\x62\157\x61\162\x64")->with("\x65\162\x72\157\x72", "\x41\153\x73\145\x73\40\x64\151\x74\157\x6c\141\x6b\72\x20\110\x61\156\x79\141\x20\101\x64\155\x69\156\x69\163\x74\162\x61\164\x6f\162\x20\171\x61\156\x67\40\x62\145\x72\150\x61\153\x20\155\x65\156\x67\145\x6c\157\x6c\141\x20\115\x61\163\x74\145\x72\40\x44\141\x74\141\x20\115\x61\164\x61\40\x50\145\x6c\141\x6a\141\x72\141\x6e\56");
 }
 goto L_4bd6d;
 }
 public function getDataKelompok()
 {
 goto L_79dc2;
 L_0508b:
 return DataTable::of($_0xa4f8)->toJson(true);
 L_27e99:
 $_0xa4f8 = $_0xc2c4->table("\x6d\141\x73\164\x65\162\x5f\153\x65\154\x6f\155\x70\157\x6b\137\x6d\141\x70\145\x6c")->select("\x69\144\x5f\153\x65\154\x5f\155\x61\160\x65\154\x2c\40\x6b\157\x64\145\x5f\153\x65\154\x5f\155\x61\160\x65\154\x2c\40\x6e\141\x6d\141\x5f\153\x65\154\x5f\155\x61\160\x65\154\x2c\40\x69\144\x5f\160\x61\162\x65\156\x74\54\x20\153\x61\164\x65\147\x6f\162\x69")->where("\x69\144\x5f\160\x61\162\x65\156\x74", "\x30");
 goto L_0508b;
 L_79dc2:
 $_0xc2c4 = db_connect();
 goto L_27e99;
 }
 public function getDataSubKelompok()
 {
 goto L_91ead;
 L_91ead:
 $_0xb5c3 = db_connect();
 goto L_214cb;
 L_214cb:
 $_0xd492 = $_0xb5c3->table("\x6d\141\x73\164\x65\162\x5f\153\x65\154\x6f\155\x70\157\x6b\137\x6d\141\x70\145\x6c\40\x61")->select("\x61\56\x69\144\x5f\153\x65\154\x5f\155\x61\160\x65\154\x2c\40\x61\56\x6b\157\x64\145\x5f\153\x65\154\x5f\155\x61\160\x65\154\x2c\40\x61\56\x6e\141\x6d\141\x5f\153\x65\154\x5f\155\x61\160\x65\154\x2c\40\x61\56\x69\144\x5f\160\x61\162\x65\156\x74\54\x20\141\x2e\153\x61\164\x65\147\x6f\162\x69\54\x20\142\x2e\156\x61\155\x61\137\x6b\145\x6c\137\x6d\141\x70\145\x6c\40\x61\163\x20\160\x61\162\x65\156\x74\137\x6e\141\x6d\145")->join("\x6d\141\x73\164\x65\162\x5f\153\x65\154\x6f\155\x70\157\x6b\137\x6d\141\x70\145\x6c\40\x62", "\x61\56\x69\144\x5f\160\x61\162\x65\156\x74\40\x3d\40\x62\56\x69\144\x5f\153\x65\154\x5f\155\x61\160\x65\154", "\x6c\145\x66\164")->where("\x61\56\x69\144\x5f\160\x61\162\x65\156\x74\40\x21\75", "\x30");
 goto L_2001e;
 L_2001e:
 return DataTable::of($_0xd492)->toJson(true);
 }
 public function read()
 {
 goto L_94b57;
 L_a6e7d:
 $_0xa395 = $_0xcb72->table("\x6d\141\x73\164\x65\162\x5f\155\x61\160\x65\154")->select("\x69\144\x5f\155\x61\160\x65\154\x2c\40\x75\162\x75\164\x61\156\x5f\164\x61\155\x70\151\x6c\54\x20\156\x61\155\x61\137\x6d\141\x70\145\x6c\54\x20\153\x6f\144\x65\54\x20\153\x65\154\x6f\155\x70\157\x6b\54\x20\144\x65\154\x65\164\x61\142\x6c\145\x2c\40\x73\164\x61\164\x75\163")->orderBy("\x6b\145\x6c\157\x6d\160\x6f\153", "\x41\123\x43")->orderBy("\x75\162\x75\164\x61\156\x5f\164\x61\155\x70\151\x6c", "\x41\123\x43");
 goto L_06240;
 L_94b57:
 $_0xcb72 = db_connect();
 goto L_a6e7d;
 L_06240:
 return DataTable::of($_0xa395)->toJson(true);
 }
 public function create()
 {
 goto L_6b700;
 L_37a5d:
 $_0xe999 = $this->request->getPost("\x75\162\x75\164\x61\156\x5f\164\x61\155\x70\151\x6c");
 goto L_7a228;
 L_6b700:
 $_0xf051 = $this->dashboardModel->getSetting();
 goto L_37a5d;
 L_297d5:
 $_0xc13d = ["\x6e\141\x6d\141\x5f\155\x61\160\x65\154" => $this->request->getPost("\x6e\141\x6d\141\x5f\155\x61\160\x65\154"), "\x6b\157\x64\145" => $this->request->getPost("\x6b\157\x64\145\x5f\155\x61\160\x65\154"), "\x6b\145\x6c\157\x6d\160\x6f\153" => $this->request->getPost("\x6b\145\x6c\157\x6d\160\x6f\153"), "\x73\164\x61\164\x75\163" => $this->request->getPost("\x73\164\x61\164\x75\163") ?? "\x31", "\x75\162\x75\164\x61\156" => $_0x7d8a, "\x75\162\x75\164\x61\156\x5f\164\x61\155\x70\151\x6c" => $_0x7d8a, "\x6a\145\x6e\152\x61\156\x67" => (int) ($_0xf051->jenjang ?? 0)];
 goto L_c9cb9;
 L_7a228:
 $_0x7d8a = $_0xe999 !== '' && $_0xe999 !== null ? (int) $_0xe999 : 0;
 goto L_297d5;
 L_c9cb9:
 $_0x25d2 = db_connect();
 goto L_0e6ca;
 L_0e6ca:
 $_0x25d2->table("\x6d\141\x73\164\x65\162\x5f\155\x61\160\x65\154")->insert($_0xc13d);
 goto L_edc51;
 L_edc51:
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => true]);
 }
 public function update()
 {
 goto L_ec737;
 L_c654c:
 $_0x808d = $this->request->getPost("\x75\162\x75\164\x61\156\x5f\164\x61\155\x70\151\x6c");
 goto L_ccf68;
 L_43130:
 $_0x114a = $this->request->getPost("\x69\144\x5f\155\x61\160\x65\154");
 goto L_0765a;
 L_a1cbf:
 $_0x2291 = ["\x6e\141\x6d\141\x5f\155\x61\160\x65\154" => $this->request->getPost("\x6e\141\x6d\141\x5f\155\x61\160\x65\154"), "\x6b\157\x64\145" => $this->request->getPost("\x6b\157\x64\145\x5f\155\x61\160\x65\154"), "\x6b\145\x6c\157\x6d\160\x6f\153" => $this->request->getPost("\x6b\145\x6c\157\x6d\160\x6f\153"), "\x73\164\x61\164\x75\163" => $this->request->getPost("\x73\164\x61\164\x75\163") ?? "\x31", "\x75\162\x75\164\x61\156" => $_0xde0a, "\x75\162\x75\164\x61\156\x5f\164\x61\155\x70\151\x6c" => $_0xde0a];
 goto L_af184;
 L_ec737:
 $_0xb200 = db_connect();
 goto L_43130;
 L_ccf68:
 $_0xde0a = $_0x808d !== '' && $_0x808d !== null ? (int) $_0x808d : 0;
 goto L_a1cbf;
 L_0765a:
 if (empty($_0x114a)) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x49\104\x20\115\x61\160\x65\154\x20\164\x69\144\x61\153\x20\144\x69\164\x65\155\x75\153\x61\156"]);
 }
 goto L_c654c;
 L_af184:
 $_0xb200->table("\x6d\141\x73\164\x65\162\x5f\155\x61\160\x65\154")->where("\x69\144\x5f\155\x61\160\x65\154", $_0x114a)->update($_0x2291);
 goto L_6d323;
 L_6d323:
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => true]);
 }
 public function delete()
 {
 goto L_441c3;
 L_b6ea1:
 if (is_array($_0x847f)) {
 $_0x97f6->table("\x6d\141\x73\164\x65\162\x5f\155\x61\160\x65\154")->whereIn("\x69\144\x5f\155\x61\160\x65\154", $_0x847f)->delete();
 } else {
 $_0x97f6->table("\x6d\141\x73\164\x65\162\x5f\155\x61\160\x65\154")->where("\x69\144\x5f\155\x61\160\x65\154", $_0x847f)->delete();
 }
 goto L_008ae;
 L_e0c6a:
 $_0x97f6 = db_connect();
 goto L_b6ea1;
 L_441c3:
 $_0x847f = $this->request->getPost("\x63\150\x65\143\x6b\145\x64");
 goto L_3608e;
 L_3608e:
 if (!$_0x847f) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x74\157\x74\141\x6c" => "\x54\151\x64\141\x6b\40\x61\144\x61\40\x64\141\x74\141\x20\171\x61\156\x67\40\x64\151\x70\151\x6c\151\x68\41"]);
 }
 goto L_e0c6a;
 L_008ae:
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => true, "\x74\157\x74\141\x6c" => count(is_array($_0x847f) ? $_0x847f : explode("\x2c", $_0x847f))]);
 }
 public function addKelompokMapel()
 {
 goto L_a202d;
 L_4be59:
 $_0xea10 = ["\x6e\141\x6d\141\x5f\153\x65\154\x5f\155\x61\160\x65\154" => $this->request->getPost("\x6e\141\x6d\141\x5f\153\x65\154\x5f\155\x61\160\x65\154"), "\x6b\157\x64\145\x5f\153\x65\154\x5f\155\x61\160\x65\154" => $this->request->getPost("\x6b\157\x64\145\x5f\153\x65\154\x5f\155\x61\160\x65\154"), "\x6b\141\x74\145\x67\157\x72\151" => $_0x23db ?: "\x57\101\x4a\111\x42", "\x69\144\x5f\160\x61\162\x65\156\x74" => $_0x5e0f];
 goto L_56ad7;
 L_b2a2f:
 $_0x23db = $this->request->getPost("\x6b\141\x74\145\x67\157\x72\151");
 goto L_ab5da;
 L_ab5da:
 $_0x909b = db_connect();
 goto L_03b95;
 L_56ad7:
 if (!empty($_0x3a67)) {
 $_0x909b->table("\x6d\141\x73\164\x65\162\x5f\153\x65\154\x6f\155\x70\157\x6b\137\x6d\141\x70\145\x6c")->where("\x69\144\x5f\153\x65\154\x5f\155\x61\160\x65\154", $_0x3a67)->update($_0xea10);
 } else {
 $_0x909b->table("\x6d\141\x73\164\x65\162\x5f\153\x65\154\x6f\155\x70\157\x6b\137\x6d\141\x70\145\x6c")->insert($_0xea10);
 }
 goto L_daf2e;
 L_daf2e:
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => true]);
 L_03b95:
 if ($_0x5e0f != 0 && empty($_0x23db)) {
 $_0xae50 = $_0x909b->table("\x6d\141\x73\164\x65\162\x5f\153\x65\154\x6f\155\x70\157\x6b\137\x6d\141\x70\145\x6c")->where("\x69\144\x5f\153\x65\154\x5f\155\x61\160\x65\154", $_0x5e0f)->get()->getRow();
 if ($_0xae50) {
 $_0x23db = $_0xae50->kategori;
 }
 }
 goto L_4be59;
 L_a202d:
 $_0x3a67 = $this->request->getPost("\x69\144\x5f\153\x65\154\x5f\155\x61\160\x65\154");
 goto L_2a63b;
 L_2a63b:
 $_0x5e0f = $this->request->getPost("\x69\144\x5f\160\x61\162\x65\156\x74") ?: 0;
 goto L_b2a2f;
 }
 public function hapusKelompok()
 {
 goto L_37042;
 L_53a5e:
 $_0x370f = $_0x992d->table("\x6d\141\x73\164\x65\162\x5f\153\x65\154\x6f\155\x70\157\x6b\137\x6d\141\x70\145\x6c")->whereIn("\x69\144\x5f\160\x61\162\x65\156\x74", is_array($_0x33d1) ? $_0x33d1 : [$_0x33d1])->countAllResults();
 goto L_69938;
 L_37042:
 $_0x33d1 = $this->request->getPost("\x69\144\x5f\153\x65\154");
 goto L_ebfa7;
 L_ebfa7:
 $_0x3867 = $this->request->getPost("\x6b\157\x64\145");
 goto L_3033e;
 L_ffa1e:
 $_0x992d = db_connect();
 goto L_2e4a5;
 L_2e4a5:
 $_0x77b1 = $_0x992d->table("\x6d\141\x73\164\x65\162\x5f\155\x61\160\x65\154")->whereIn("\x6b\145\x6c\157\x6d\160\x6f\153", is_array($_0x3867) ? $_0x3867 : [$_0x3867])->countAllResults();
 goto L_9dceb;
 L_d6f6a:
 if (count($_0x67cc) > 0) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x4b\145\x6c\157\x6d\160\x6f\153\x20\115\x61\160\x65\154\x20\144\x69\147\x75\156\x61\153\x61\156\x20\144\x69\40" . count($_0x67cc) . "\x20\164\x61\142\x65\154\x3a\74\x62\162\x3e" . implode("\x3c\142\x72\76", $_0x67cc)]);
 } else {
 $_0x992d->table("\x6d\141\x73\164\x65\162\x5f\153\x65\154\x6f\155\x70\157\x6b\137\x6d\141\x70\145\x6c")->where("\x69\144\x5f\153\x65\154\x5f\155\x61\160\x65\154", $_0x33d1)->delete();
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => true, "\x6d\145\x73\163\x61\147\x65" => "\x62\145\x72\150\x61\163\x69\154"]);
 }
 L_69938:
 if ($_0x370f > 0) {
 array_push($_0x67cc, "\x53\165\x62\40\x4b\145\x6c\157\x6d\160\x6f\153");
 }
 goto L_d6f6a;
 L_9dceb:
 if ($_0x77b1 > 0) {
 array_push($_0x67cc, "\x4d\141\x74\141\x20\120\x65\154\x61\152\x61\162\x61\156");
 }
 goto L_53a5e;
 L_3033e:
 // $id_parent = $this->request->getPost('id_parent');
 $_0x67cc = [];
 goto L_ffa1e;
 }
 public function aktifkan($_0xca1f)
 {
 goto L_960bb;
 L_ca34e:
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => true]);
 L_960bb:
 $_0x8980 = db_connect();
 goto L_ad89d;
 L_ad89d:
 $_0x8980->table("\x6d\141\x73\164\x65\162\x5f\155\x61\160\x65\154")->where("\x69\144\x5f\155\x61\160\x65\154", $_0xca1f)->update(["\x73\164\x61\164\x75\163" => "\x31"]);
 goto L_ca34e;
 }
 public function import()
 {
 goto L_1409d;
 L_147fd:
 $_0x6bcd = ["\x75\163\x65\162" => ["\x66\151\x72\163\x74\137\x6e\141\x6d\145" => $_0xa40e->get("\x75\163\x65\162\x6e\141\x6d\145"), "\x72\157\x6c\145\x5f\156\x61\155\x65" => $_0xa40e->get("\x72\157\x6c\145\x5f\156\x61\155\x65"), "\x66\157\x74\157" => $_0xa40e->get("\x66\157\x74\157") ?? ''], "\x6a\165\x64\165\x6c" => "\x4d\141\x74\141\x20\120\x65\154\x61\152\x61\162\x61\156", "\x73\165\x62\152\x75\144\x75\154" => "\x49\155\x70\157\x72\164\x20\115\x61\164\x61\40\x50\145\x6c\141\x6a\141\x72\141\x6e", "\x73\145\x74\164\x69\156\x67" => $this->dashboardModel->getSetting(), "\x74\160" => $this->dashboardModel->getTahun(), "\x74\160\x5f\141\x63\164\x69\166\x65" => $this->dashboardModel->getTahunActive(), "\x73\155\x74" => $this->dashboardModel->getSemester(), "\x73\155\x74\137\x61\143\x74\151\x76\145" => $this->dashboardModel->getSemesterActive()];
 goto L_077da;
 L_077da:
 $_0x96d3 = $this->request->getPost("\x69\155\x70\157\x72\164\x5f\144\x61\164\x61");
 goto L_84a10;
 L_84a10:
 if ($_0x96d3 != null) {
 $_0x6bcd["\x69\155\x70\157\x72\164"] = json_decode($_0x96d3);
 }
 goto L_f8ad6;
 L_f8ad6:
 return view("\x6d\141\x73\164\x65\162\x2f\155\x61\160\x65\154\x2f\151\x6d\160\x6f\162\x74", $_0x6bcd);
 L_1409d:
 $_0xa40e = session();
 goto L_147fd;
 }
 public function do_import()
 {
 goto L_89381;
 L_88bb7:
 return $this->response->setJSON($_0x42a7);
 L_a6f67:
 if (!empty($_0xdd79) && is_array($_0xdd79)) {
 $_0x8d26 = $this->dashboardModel->getSetting();
 $_0x1753 = (int) ($_0x8d26->jenjang ?? 0);
 $_0x5f9d = [];
 foreach ($_0xdd79 as $_0xe875) {
 $_0x1e7e = isset($_0xe875["\x75\162\x75\164\x61\156\x5f\164\x61\155\x70\151\x6c"]) && $_0xe875["\x75\162\x75\164\x61\156\x5f\164\x61\155\x70\151\x6c"] !== '' ? (int) $_0xe875["\x75\162\x75\164\x61\156\x5f\164\x61\155\x70\151\x6c"] : (isset($_0xe875["\x75\162\x75\164\x61\156"]) && $_0xe875["\x75\162\x75\164\x61\156"] !== '' ? (int) $_0xe875["\x75\162\x75\164\x61\156"] : 0);
 $_0x5f9d[] = ["\x6e\141\x6d\141\x5f\155\x61\160\x65\154" => $_0xe875["\x6e\141\x6d\141\x5f\155\x61\160\x65\154"] ?? '', "\x6b\157\x64\145" => $_0xe875["\x6b\157\x64\145"] ?? '', "\x6b\145\x6c\157\x6d\160\x6f\153" => !empty($_0xe875["\x6b\145\x6c\157\x6d\160\x6f\153"]) ? $_0xe875["\x6b\145\x6c\157\x6d\160\x6f\153"] : "\x57\101\x4a\111\x42", "\x73\164\x61\164\x75\163" => isset($_0xe875["\x73\164\x61\164\x75\163"]) && $_0xe875["\x73\164\x61\164\x75\163"] !== '' ? (string) $_0xe875["\x73\164\x61\164\x75\163"] : "\x31", "\x75\162\x75\164\x61\156" => $_0x1e7e, "\x75\162\x75\164\x61\156\x5f\164\x61\155\x70\151\x6c" => $_0x1e7e, "\x6a\145\x6e\152\x61\156\x67" => $_0x1753];
 }
 $_0xb1c6 = db_connect();
 $_0xb1c6->table("\x6d\141\x73\164\x65\162\x5f\155\x61\160\x65\154")->insertBatch($_0x5f9d);
 $_0x42a7 = true;
 } else {
 $_0x42a7 = false;
 }
 goto L_88bb7;
 L_89381:
 $_0xdd79 = $this->request->getPost("\x6d\141\x70\145\x6c");
 goto L_a6f67;
 }
}