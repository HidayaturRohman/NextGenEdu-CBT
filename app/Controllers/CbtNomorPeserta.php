<?php
/*   ________________________________________
    |               NextGen Garuda CBT       |
    |    Protected & Distributed via GitHub  |
    |________________________________________|
*/
namespace App\Controllers;

use App\Models\DashboardModel;
use App\Models\CbtModel;
use App\Models\DropdownModel;
class CbtNomorPeserta extends BaseController
{
 protected $dashboardModel;
 protected $cbtModel;
 protected $dropdownModel;
 public function __construct()
 {
 goto L_f86b9;
 L_f86b9:
 $this->dashboardModel = new DashboardModel();
 goto L_ef059;
 L_9a869:
 $this->dropdownModel = new DropdownModel();
 L_ef059:
 $this->cbtModel = new CbtModel();
 goto L_9a869;
 }
 protected function getTpSmt()
 {
 goto L_071e2;
 L_cfdfe:
 return (object) ["\x74\160" => $this->dashboardModel->getTahun(), "\x74\160\x5f\141\x63\164\x69\166\x65" => $_0x8a12, "\x73\155\x74" => $this->dashboardModel->getSemester(), "\x73\155\x74\137\x61\143\x74\151\x76\145" => $_0x8e19];
 L_071e2:
 $_0x8a12 = $this->dashboardModel->getTahunActive();
 goto L_f764b;
 L_f764b:
 $_0x8e19 = $this->dashboardModel->getSemesterActive();
 goto L_cfdfe;
 }
 public function index()
 {
 goto L_75a22;
 L_01169:
 $_0xde49["\x73\155\x74"] = $_0xfabd->smt;
 goto L_77e07;
 L_9672a:
 $_0xde49["\x6b\145\x6c\141\x73"] = $this->dropdownModel->getAllKelas($_0x8d7f->id_tp, $_0x8974->id_smt);
 goto L_f1460;
 L_efcc7:
 $_0xde49["\x74\160"] = $_0xfabd->tp;
 goto L_c9bcb;
 L_4dd1b:
 $_0xde49["\x73\145\x73\151"] = $this->dropdownModel->getAllSesi();
 goto L_89380;
 L_f7eee:
 $_0xd253 = $_0xd7aa->get("\x72\157\x6c\145") == "\x31";
 goto L_5f1cb;
 L_e64bb:
 // DEBUG: dump session to file
 file_put_contents(WRITEPATH . "\x73\145\x73\163\x69\157\x6e\137\x64\145\x62\165\x67\56\x74\170\x74", print_r(session()->get(), true));
 goto L_443ba;
 L_89380:
 // Assuming admin
 $_0xde49["\x6a\141\x64\167\x61\154"] = $this->dropdownModel->getAllJadwal($_0x8d7f->id_tp, $_0x8974->id_smt);
 goto L_9672a;
 L_5f1cb:
 $_0x1af3 = (object) ["\x69\144" => $_0xd7aa->get("\x69\144\x5f\165\x73\145\x72"), "\x66\151\x72\163\x74\137\x6e\141\x6d\145" => $_0xd7aa->get("\x75\163\x65\162\x6e\141\x6d\145"), "\x72\157\x6c\145\x5f\156\x61\155\x65" => $_0xd7aa->get("\x72\157\x6c\145\x5f\156\x61\155\x65"), "\x66\157\x74\157" => $_0xd7aa->get("\x66\157\x74\157") ?? ''];
 goto L_9ec14;
 L_5eaca:
 if (!$_0xd7aa->get("\x69\163\x5f\154\x6f\147\x69\156")) {
 return redirect()->to("\x61\165\x74\150\x2f\154\x6f\147\x69\156");
 }
 goto L_b4fdd;
 L_f1460:
 return view("\x63\142\x74\57\x6e\157\x6d\157\x72\160\x65\163\x65\162\x74\141\x2f\144\x61\164\x61", $_0xde49);
 L_0edba:
 $_0xde49["\x72\165\x61\156\x67"] = $this->dropdownModel->getAllRuang();
 goto L_4dd1b;
 L_75a22:
 $_0xd7aa = session();
 goto L_5eaca;
 L_e8906:
 $_0x8974 = $_0xfabd->smt_active;
 goto L_efcc7;
 L_c9bcb:
 $_0xde49["\x74\160\x5f\141\x63\164\x69\166\x65"] = $_0x8d7f;
 goto L_01169;
 L_9ec14:
 $_0xde49 = ["\x75\163\x65\162" => $_0x1af3, "\x6a\165\x64\165\x6c" => "\x4e\157\x6d\157\x72\40\x50\145\x73\145\x72\164\x61", "\x73\165\x62\152\x75\144\x75\154" => "\x47\145\x6e\145\x72\141\x74\145\x20\116\x6f\155\x6f\162\x20\120\x65\163\x65\162\x74\141\x20\125\x6a\151\x61\156", "\x70\162\x6f\146\x69\154\x65" => null, "\x73\145\x74\164\x69\156\x67" => $this->dashboardModel->getSetting()];
 goto L_a40d2;
 L_77e07:
 $_0xde49["\x73\155\x74\137\x61\143\x74\151\x76\145"] = $_0x8974;
 goto L_0edba;
 L_443ba:
 $_0xd7aa = session();
 goto L_f7eee;
 L_b4fdd:
 if (!in_array((string) $_0xd7aa->get("\x72\157\x6c\145"), ["\x31", "\x34"])) {
 return redirect()->to("\x63\142\x74\142\x61\156\x6b\163\x6f\141\x6c")->with("\x65\162\x72\157\x72", "\x41\153\x73\145\x73\40\x64\151\x74\157\x6c\141\x6b\72\x20\110\x61\156\x79\141\x20\101\x64\155\x69\156\x69\163\x74\162\x61\164\x6f\162\x2f\120\x72\157\x6b\164\x6f\162\x20\171\x61\156\x67\40\x62\145\x72\150\x61\153\x20\155\x65\156\x67\145\x6c\157\x6c\141\x20\116\x6f\155\x6f\162\x20\120\x65\163\x65\162\x74\141\x20\125\x6a\151\x61\156\x2e");
 }
 goto L_e64bb;
 L_a98a8:
 $_0x8d7f = $_0xfabd->tp_active;
 goto L_e8906;
 L_a40d2:
 $_0xfabd = $this->getTpSmt();
 goto L_a98a8;
 }
 public function saveNomor()
 {
 try {
 $_0xf532 = $this->request->getPost("\x73\151\x73\167\x61");
 $_0x2826 = json_decode($_0xf532, true);
 if (!is_array($_0x2826)) {
 $_0x2826 = json_decode($_0xf532);
 }
 $_0xcaa1 = $this->getTpSmt();
 $_0xc825 = $_0xcaa1->tp_active;
 $_0xa7e6 = $_0xcaa1->smt_active;
 if (!$_0xc825 || !$_0xa7e6) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\163\x67" => "\x54\141\x68\165\x6e\40\x70\145\x6c\141\x6a\141\x72\141\x6e\40\x61\164\x61\165\x20\163\x65\155\x65\163\x74\145\x72\40\x61\153\x74\151\x66\40\x62\145\x6c\165\x6d\40\x64\151\x73\145\x74\56"]);
 }
 if (!is_array($_0x2826) || empty($_0x2826)) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\163\x67" => "\x44\141\x74\141\x20\163\x69\163\x77\141\x20\153\x6f\163\x6f\156\x67\40\x61\164\x61\165\x20\146\x6f\162\x6d\141\x74\40\x64\141\x74\141\x20\164\x69\144\x61\153\x20\166\x61\154\x69\144\x2e"]);
 }
 $_0x6790 = [];
 foreach ($_0x2826 as $_0x7ef7) {
 $_0x8843 = is_array($_0x7ef7) ? $_0x7ef7["\x69\144"] ?? null : $_0x7ef7->id ?? null;
 if ($_0x8843) {
 $_0x6790[] = $_0x8843;
 }
 }
 $_0x5596 = [];
 $_0xb8e1 = [];
 $_0xc507 = \Config\Database::connect();
 if (count($_0x6790) > 0) {
 $_0x55aa = $this->cbtModel->getAllNomorPeserta($_0xc825->id_tp, $_0xa7e6->id_smt, $_0x6790);
 foreach ($_0x2826 as $_0x7ef7) {
 $_0x8843 = is_array($_0x7ef7) ? $_0x7ef7["\x69\144"] ?? null : $_0x7ef7->id ?? null;
 $_0x68cd = is_array($_0x7ef7) ? $_0x7ef7["\x6e\157\x6d\157\x72"] ?? '' : $_0x7ef7->nomor ?? '';
 if (!$_0x8843) {
 continue;
 }
 $_0xffb2 = $_0x55aa[$_0x8843] ?? null;
 if ($_0xffb2) {
 $_0x5596[] = ["\x69\144\x5f\156\x6f\155\x6f\162" => $_0xffb2->id_nomor, "\x69\144\x5f\163\x69\163\x77\141" => $_0x8843, "\x69\144\x5f\164\x70" => $_0xc825->id_tp, "\x69\144\x5f\163\x6d\164" => $_0xa7e6->id_smt, "\x6e\157\x6d\157\x72\137\x70\145\x73\145\x72\164\x61" => $_0x68cd];
 } else {
 $_0xb8e1[] = ["\x69\144\x5f\163\x69\163\x77\141" => $_0x8843, "\x69\144\x5f\164\x70" => $_0xc825->id_tp, "\x69\144\x5f\163\x6d\164" => $_0xa7e6->id_smt, "\x6e\157\x6d\157\x72\137\x70\145\x73\145\x72\164\x61" => $_0x68cd];
 }
 }
 }
 if (count($_0xb8e1) > 0) {
 $_0xc507->table("\x63\142\x74\137\x6e\157\x6d\157\x72\137\x70\145\x73\145\x72\164\x61")->insertBatch($_0xb8e1);
 }
 if (count($_0x5596) > 0) {
 $_0xc507->table("\x63\142\x74\137\x6e\157\x6d\157\x72\137\x70\145\x73\145\x72\164\x61")->updateBatch($_0x5596, "\x69\144\x5f\156\x6f\155\x6f\162");
 }
 $_0xe55f = $this->cbtModel->hapus_duplikat_nomor_peserta();
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => true, "\x6d\163\x67" => "\x4e\157\x6d\157\x72\40\x70\145\x73\145\x72\164\x61\40\x62\145\x72\150\x61\163\x69\154\x20\144\x69\163\x69\155\x70\141\x6e", "\x69\156\x73\145\x72\164" => count($_0xb8e1), "\x75\160\x64\141\x74\145" => count($_0x5596), "\x64\165\x70\154\x69\153\x61\164" => $_0xe55f]);
 } catch (\Throwable $_0x8698) {
 return $this->response->setStatusCode(500)->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => $_0x8698->getMessage()]);
 }
 }
 public function resetNomor()
 {
 try {
 $_0x79b1 = $this->request->getGet("\x6b\145\x6c\141\x73");
 $_0xea68 = json_decode($_0x79b1, true);
 if (!is_array($_0xea68)) {
 $_0xea68 = json_decode($_0x79b1);
 }
 $_0x9362 = $this->dashboardModel->getTahunActive();
 $_0x1b19 = $this->dashboardModel->getSemesterActive();
 if (!$_0x9362 || !$_0x1b19 || empty($_0xea68)) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false]);
 }
 $_0x2369 = $this->cbtModel->getSiswaByKelasArray($_0x9362->id_tp, $_0x1b19->id_smt, (array) $_0xea68);
 $_0xc2dd = array_column($_0x2369, "\x69\144\x5f\163\x69\163\x77\141");
 $_0x3bb6 = [];
 if (count($_0xc2dd) > 0) {
 $_0x3bb6 = $this->cbtModel->getAllNomorPeserta($_0x9362->id_tp, $_0x1b19->id_smt, $_0xc2dd);
 }
 $_0x17ca = [];
 foreach ($_0x2369 as $_0x3056) {
 if (isset($_0x3bb6[$_0x3056->id_siswa])) {
 $_0x17ca[] = ["\x69\144\x5f\156\x6f\155\x6f\162" => $_0x3bb6[$_0x3056->id_siswa]->id_nomor, "\x6e\157\x6d\157\x72\137\x70\145\x73\145\x72\164\x61" => ''];
 }
 }
 if (count($_0x17ca) > 0) {
 $_0x8980 = \Config\Database::connect();
 $_0x8980->table("\x63\142\x74\137\x6e\157\x6d\157\x72\137\x70\145\x73\145\x72\164\x61")->updateBatch($_0x17ca, "\x69\144\x5f\156\x6f\155\x6f\162");
 }
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => true]);
 } catch (\Throwable $_0xe884) {
 return $this->response->setStatusCode(500)->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => $_0xe884->getMessage()]);
 }
 }
 public function getSiswaKelas()
 {
 try {
 $_0xf9a3 = $this->request->getPost("\x6b\145\x6c\141\x73");
 $_0xb8f5 = json_decode($_0xf9a3, true);
 if (!is_array($_0xb8f5)) {
 $_0xb8f5 = json_decode($_0xf9a3);
 }
 $_0x1ac6 = $this->dashboardModel->getTahunActive();
 $_0x7505 = $this->dashboardModel->getSemesterActive();
 $_0xcef5 = [];
 $_0x74f7 = [];
 if ($_0x1ac6 && $_0x7505 && !empty($_0xb8f5)) {
 $_0xcef5 = $this->cbtModel->getSiswaByKelasArray($_0x1ac6->id_tp, $_0x7505->id_smt, (array) $_0xb8f5);
 $_0x6392 = array_column($_0xcef5, "\x69\144\x5f\163\x69\163\x77\141");
 if (count($_0x6392) > 0) {
 $_0x74f7 = $this->cbtModel->getAllNomorPeserta($_0x1ac6->id_tp, $_0x7505->id_smt, $_0x6392);
 }
 }
 $_0xcdef["\x6b\145\x6c\141\x73"] = $_0xb8f5;
 $_0xcdef["\x73\151\x73\167\x61"] = $_0xcef5;
 $_0xcdef["\x6e\157\x6d\157\x72"] = $_0x74f7;
 return $this->response->setJSON($_0xcdef);
 } catch (\Throwable $_0xd0c2) {
 return $this->response->setStatusCode(500)->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => $_0xd0c2->getMessage()]);
 }
 }
}