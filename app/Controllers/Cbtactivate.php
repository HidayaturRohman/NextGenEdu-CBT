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

class Cbtactivate extends BaseController
{
 public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $_0xe10c)
 {
 parent::initController($request, $response, $_0xe10c);
 }
 public function index()
 {
 goto L_6b2c4;
 L_6b2c4:
 $_0x3ec9 = session();
 goto L_ce7a7;
 L_f25f7:
 if (true) {
 $_0xde49["\x72\165\x61\156\x67"] = (new \App\Models\DropdownModel())->getAllRuang();
 $_0xde49["\x73\145\x73\151"] = (new \App\Models\DropdownModel())->getAllSesi();
 $_0x5b3d = (new \App\Models\CbtModel())->getJadwalKelas($_0x8d7f->id_tp, $_0x8974->id_smt);
 $_0xbe83 = [];
 foreach ($_0x5b3d as $_0x5c7a) {
 $_0x1aa6 = $this->maybe_unserialize($_0x5c7a->bank_kelas ?? "\x5b\135");
 foreach ($_0x1aa6 as $_0xee88) {
 if (is_array($_0xee88)) {
 $_0xbe83[] = $_0xee88["\x6b\145\x6c\141\x73\137\x69\144"];
 } else if (is_object($_0xee88)) {
 $_0xbe83[] = $_0xee88->kelas_id;
 }
 }
 }
 $_0xde49["\x72\165\x61\156\x67\163"] = (new \App\Models\CbtModel())->getDistinctRuang($_0x8d7f->id_tp, $_0x8974->id_smt, $_0xbe83);
 return view("\x63\142\x74\57\x61\153\x74\151\x76\141\x73\151\x2f\144\x61\164\x61", $_0xde49);
 } else {
 $_0xd005 = (new \App\Models\DashboardModel())->getDataGuruByUserId($_0xce0d->id, $_0x8d7f->id_tp, $_0x8974->id_smt);
 $_0xde49["\x67\165\x72\165"] = $_0xd005;
 $_0xde49["\x72\165\x61\156\x67"] = (new \App\Models\DropdownModel())->getAllRuang();
 $_0xde49["\x73\145\x73\151"] = (new \App\Models\DropdownModel())->getAllSesi();
 $_0xde49["\x70\145\x6e\147\x61\167\x61\163"] = (new \App\Models\CbtModel())->getPengawasByGuru($_0x8d7f->id_tp, $_0x8974->id_smt, $_0xd005->id_guru);
 $_0x5b3d = (new \App\Models\CbtModel())->getJadwalGuru($_0x8d7f->id_tp, $_0x8974->id_smt, $_0xd005->id_guru);
 $_0xbe83 = [];
 foreach ($_0x5b3d as $_0x5c7a) {
 $_0x1aa6 = $this->maybe_unserialize($_0x5c7a->bank_kelas ?? "\x5b\135");
 foreach ($_0x1aa6 as $_0xee88) {
 if (is_array($_0xee88)) {
 $_0xbe83[] = $_0xee88["\x6b\145\x6c\141\x73\137\x69\144"];
 } else if (is_object($_0xee88)) {
 $_0xbe83[] = $_0xee88->kelas_id;
 }
 }
 }
 $_0xde49["\x72\165\x61\156\x67\163"] = (new \App\Models\CbtModel())->getDistinctRuang($_0x8d7f->id_tp, $_0x8974->id_smt, $_0xbe83);
 return view("\x63\142\x74\57\x61\153\x74\151\x76\141\x73\151\x2f\144\x61\164\x61", $_0xde49);
 }
 L_6d7bb:
 $_0x8d7f = (new \App\Models\DashboardModel())->getTahunActive();
 goto L_5ca54;
 L_9e2ec:
 $_0xde49["\x73\155\x74"] = (new \App\Models\DashboardModel())->getSemester();
 goto L_56356;
 L_0ff62:
 $_0xde49["\x74\160"] = (new \App\Models\DashboardModel())->getTahun();
 goto L_dec9b;
 L_56356:
 $_0xde49["\x73\155\x74\137\x61\143\x74\151\x76\145"] = $_0x8974;
 goto L_f25f7;
 L_dec9b:
 $_0xde49["\x74\160\x5f\141\x63\164\x69\166\x65"] = $_0x8d7f;
 goto L_9e2ec;
 L_21f64:
 $_0xce0d = (object) ["\x69\144" => $_0x3ec9->get("\x69\144\x5f\165\x73\145\x72"), "\x75\163\x65\162\x6e\141\x6d\145" => $_0x3ec9->get("\x75\163\x65\162\x6e\141\x6d\145"), "\x66\151\x72\163\x74\137\x6e\141\x6d\145" => $_0x3ec9->get("\x75\163\x65\162\x6e\141\x6d\145"), "\x72\157\x6c\145\x5f\156\x61\155\x65" => $_0x3ec9->get("\x72\157\x6c\145\x5f\156\x61\155\x65"), "\x66\157\x74\157" => $_0x3ec9->get("\x66\157\x74\157") ?? ''];
 goto L_770b5;
 L_770b5:
 $_0xde49 = ["\x75\163\x65\162" => $_0xce0d, "\x6a\165\x64\165\x6c" => "\x41\153\x74\151\x76\141\x73\151\x20\123\x69\163\x77\141", "\x73\165\x62\152\x75\144\x75\154" => "\x41\153\x74\151\x66\153\x61\156\x2f\116\x6f\156\x61\153\x74\151\x66\153\x61\156\x20\123\x69\163\x77\141", "\x70\162\x6f\146\x69\154\x65" => null, "\x73\145\x74\164\x69\156\x67" => (new \App\Models\DashboardModel())->getSetting()];
 goto L_6d7bb;
 L_5ca54:
 $_0x8974 = (new \App\Models\DashboardModel())->getSemesterActive();
 goto L_0ff62;
 L_ce7a7:
 $_0x1e8d = in_array((string) $_0x3ec9->get("\x72\157\x6c\145"), ["\x31", "\x34"]);
 goto L_21f64;
 }
 public function getSiswaRuang()
 {
 goto L_7e301;
 L_75d5c:
 $_0xfee4 = $this->request->getGet("\x73\145\x73\151");
 goto L_0f668;
 L_5c8c1:
 $_0x76f5 = (new \App\Models\CbtModel())->getSiswaByRuang($_0x5641->id_tp, $_0xd78c->id_smt, $_0x6f5c, $_0xfee4);
 goto L_bec48;
 L_bec48:
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => true, "\x73\151\x73\167\x61" => $_0x76f5]);
 L_7e301:
 $_0x6f5c = $this->request->getGet("\x72\165\x61\156\x67");
 goto L_75d5c;
 L_0f668:
 if (empty($_0x6f5c) || empty($_0xfee4)) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\163\x67" => "\x52\165\x61\156\x67\40\x64\141\x6e\40\x73\145\x73\151\x20\150\x61\162\x75\163\x20\144\x69\151\x73\151\x2e"]);
 }
 goto L_f45aa;
 L_0a4d4:
 $_0xd78c = (new \App\Models\DashboardModel())->getSemesterActive();
 goto L_5c8c1;
 L_f45aa:
 $_0x5641 = (new \App\Models\DashboardModel())->getTahunActive();
 goto L_0a4d4;
 }
 public function data()
 {
 return $this->response->setJSON((new \App\Models\CbtModel())->getJenis());
 }
 public function aktifkan_semua()
 {
 goto L_bac1a;
 L_029a9:
 $_0x377c = $this->request->getPost("\x61\143\x74\151\x76\145");
 goto L_f0a62;
 L_f0a62:
 $_0xc507 = \Config\Database::connect();
 goto L_fce09;
 L_d23c2:
 foreach ($_0x5ab5 as $_0xc743) {
 $_0xfd2d[] = ["\x69\144" => $_0xc743->id, "\x61\143\x74\151\x76\145" => $_0x377c == "\x61\153\x74\151\x66\153\x61\156" ? "\x31" : "\x30"];
 }
 goto L_7554c;
 L_76750:
 $_0x5ab5 = $_0x39df->get()->getResult();
 goto L_a27b5;
 L_535e0:
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => true, "\x6a\165\x6d\154\x61\150" => $_0x4bf7, "\x64\141\x74\141" => $_0x5ab5, "\x6d\163\x67" => $_0x4bf7 . "\x20\163\x69\163\x77\141\x20\144\x69\141\x6b\164\x69\146\x6b\141\x6e\56"]);
 L_f0795:
 $_0x39df->select("\x61\56\x69\144\x2c\40\x61\56\x61\143\x74\151\x76\145");
 goto L_e9d29;
 L_e9d29:
 $_0x39df->join("\x6d\141\x73\164\x65\162\x5f\163\x69\163\x77\141\x20\142", "\x61\56\x75\163\x65\162\x6e\141\x6d\145\x3d\142\x2e\165\x73\145\x72\156\x61\155\x65");
 goto L_a3675;
 L_7554c:
 if (count($_0xfd2d) > 0) {
 if (!$_0xc507->table("\x75\163\x65\162\x73")->updateBatch($_0xfd2d, "\x69\144")) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\163\x67" => "\x47\141\x67\141\x6c\40\x6d\145\x6e\147\x75\160\x64\141\x74\145\x20\144\x61\164\x61\40\x73\151\x73\167\x61\56"]);
 }
 (new \App\Models\LogModel())->saveLog(2, ($_0x377c == "\x61\153\x74\151\x66\153\x61\156" ? "\x4d\145\x6e\147\x61\153\x74\151\x66\153\x61\156" : "\x4d\145\x6e\157\x6e\141\x6b\164\x69\146\x6b\141\x6e") . "\x73\145\x6d\165\x61\40\x73\151\x73\167\x61");
 }
 goto L_3f83f;
 L_3f83f:
 $_0x4bf7 = count($_0x5ab5);
 goto L_535e0;
 L_a27b5:
 $_0xfd2d = [];
 goto L_d23c2;
 L_fce09:
 $_0x39df = $_0xc507->table("\x75\163\x65\162\x73\40\x61");
 goto L_f0795;
 L_bac1a:
 $_0x90c1 = $this->request->getPost("\x69\144\x73");
 goto L_029a9;
 L_a3675:
 if (!empty($_0x90c1)) {
 $_0x39df->whereIn("\x62\56\x69\144\x5f\163\x69\163\x77\141", $_0x90c1);
 } else {
 $_0x39df->where("\x31\75\x30");
 // Do not fetch all if no IDs provided
 }
 goto L_76750;
 }
 public function aktifkan_sesi()
 {
 goto L_2a410;
 L_33717:
 $_0xfbe9 = $this->request->getPost("\x61\143\x74\151\x76\145");
 goto L_53b2a;
 L_ab583:
 $_0x3eb2->select("\x61\56\x73\151\x73\167\x61\137\x69\144\x2c\40\x61\56\x72\165\x61\156\x67\137\x69\144\x2c\40\x61\56\x73\145\x73\151\x5f\151\x64\54\x20\142\x2e\156\x61\155\x61\54\x20\142\x2e\165\x73\145\x72\156\x61\155\x65\54\x20\142\x2e\160\x61\163\x73\167\x6f\162\x64\54\x20\142\x2e\156\x69\163\x2c\40\x64\56\x69\144");
 goto L_9943f;
 L_0fc89:
 $_0x3eb2->join("\x6b\145\x6c\141\x73\137\x73\151\x73\167\x61\40\x63", "\x61\56\x73\151\x73\167\x61\137\x69\144\x3d\143\x2e\151\x64\137\x73\151\x73\167\x61");
 goto L_faae2;
 L_41971:
 if (!empty($_0xee70)) {
 foreach ($_0xee70 as $_0x71ca) {
 $_0x118e = explode("\x2d", $_0x71ca);
 if (count($_0x118e) == 2) {
 $_0xfe69[] = $_0x118e[0];
 $_0x48b6[] = $_0x118e[1];
 }
 }
 }
 goto L_001bd;
 L_aeb0a:
 $_0x48b6 = [];
 goto L_41971;
 L_757c8:
 $_0x3eb2 = $_0x17e4->table("\x63\142\x74\137\x73\145\x73\151\x5f\163\x69\163\x77\141\x20\141");
 goto L_ab583;
 L_19d30:
 $_0x44c3 = $_0x3eb2->get()->getResult();
 goto L_e6b92;
 L_16c0f:
 $_0x25eb = count($_0x44c3);
 goto L_a457c;
 L_a457c:
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => true, "\x6a\165\x6d\154\x61\150" => $_0x25eb, "\x64\141\x74\141" => $_0x44c3, "\x6d\163\x67" => $_0x25eb . "\x20\163\x69\163\x77\141\x20\144\x69\156\x6f\156\x61\153\x74\151\x66\153\x61\156\x2e"]);
 L_191d9:
 $_0xfe69 = [];
 goto L_aeb0a;
 L_73e78:
 if (!empty($_0x48b6)) {
 $_0x3eb2->whereIn("\x61\56\x73\145\x73\151\x5f\151\x64", $_0x48b6);
 }
 goto L_19d30;
 L_249dc:
 if (!empty($_0xfe69)) {
 $_0x3eb2->whereIn("\x61\56\x72\165\x61\156\x67\137\x69\144", $_0xfe69);
 } else {
 $_0x3eb2->where("\x31\75\x30");
 }
 goto L_73e78;
 L_2a410:
 $_0xee70 = $this->request->getPost("\x69\144\x73");
 goto L_33717;
 L_366f6:
 foreach ($_0x44c3 as $_0x403c) {
 $_0x945c[] = ["\x69\144" => $_0x403c->id, "\x61\143\x74\151\x76\145" => $_0xfbe9 == "\x61\153\x74\151\x66\153\x61\156" ? "\x31" : "\x30"];
 }
 goto L_7ed3f;
 L_001bd:
 $_0x17e4 = \Config\Database::connect();
 goto L_757c8;
 L_acae3:
 $_0x202e = (new \App\Models\DashboardModel())->getSemesterActive();
 goto L_191d9;
 L_53b2a:
 $_0x6dc1 = (new \App\Models\DashboardModel())->getTahunActive();
 goto L_acae3;
 L_9943f:
 $_0x3eb2->join("\x6d\141\x73\164\x65\162\x5f\163\x69\163\x77\141\x20\142", "\x61\56\x73\151\x73\167\x61\137\x69\144\x3d\142\x2e\151\x64\137\x73\151\x73\167\x61");
 goto L_0fc89;
 L_d0b62:
 $_0x3eb2->where("\x61\56\x73\155\x74\137\x69\144", $_0x202e->id_smt);
 goto L_249dc;
 L_faae2:
 $_0x3eb2->join("\x75\163\x65\162\x73\40\x64", "\x62\56\x75\163\x65\162\x6e\141\x6d\145\x3d\144\x2e\165\x73\145\x72\156\x61\155\x65");
 goto L_2a1e5;
 L_7ed3f:
 if (count($_0x945c) > 0) {
 $_0x17e4->table("\x75\163\x65\162\x73")->updateBatch($_0x945c, "\x69\144");
 (new \App\Models\LogModel())->saveLog(2, ($_0xfbe9 == "\x61\153\x74\151\x66\153\x61\156" ? "\x4d\145\x6e\147\x61\153\x74\151\x66\153\x61\156" : "\x4d\145\x6e\157\x6e\141\x6b\164\x69\146\x6b\141\x6e") . "\x20\163\x69\163\x77\141\x20\163\x65\163\x69");
 }
 goto L_16c0f;
 L_2a1e5:
 $_0x3eb2->where("\x61\56\x74\160\x5f\151\x64", $_0x6dc1->id_tp);
 goto L_d0b62;
 L_e6b92:
 $_0x945c = [];
 goto L_366f6;
 }
}