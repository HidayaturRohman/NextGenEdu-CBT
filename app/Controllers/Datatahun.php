<?php
/*   ________________________________________
    |               NextGen Garuda CBT       |
    |    Protected & Distributed via GitHub  |
    |________________________________________|
*/
namespace App\Controllers;

use App\Models\DashboardModel;
use App\Models\LogModel;
use App\Models\MasterModel;
use Nextgen\DataTables\DataTable;
class Datatahun extends BaseController
{
 protected $dashboardModel;
 protected $masterModel;
 protected $logModel;
 public function __construct()
 {
 goto L_691ec;
 L_691ec:
 $this->dashboardModel = new DashboardModel();
 goto L_fd426;
 L_fd426:
 $this->masterModel = new MasterModel();
 goto L_b9a6c;
 L_b9a6c:
 $this->logModel = new LogModel();
 }
 public function index()
 {
 goto L_7fa33;
 L_6748d:
 if (!$_0x49ce->get("\x69\163\x5f\154\x6f\147\x69\156")) {
 return redirect()->to("\x61\165\x74\150\x2f\154\x6f\147\x69\156");
 } elseif (!in_array((string) $_0x49ce->get("\x72\157\x6c\145"), ["\x31", "\x34"])) {
 // admin
 $this->logModel->saveLog(1, "\x52\145\x64\151\x72\145\x63\164\x65\144\x20\164\x6f\40\x64\141\x73\150\x62\157\x61\162\x64\40\x62\145\x63\141\x75\163\x65\40\x72\157\x6c\145\x20\151\x73\40" . $_0x49ce->get("\x72\157\x6c\145"));
 return redirect()->to("\x64\141\x73\150\x62\157\x61\162\x64")->with("\x65\162\x72\157\x72", "\x48\141\x6e\171\x61\40\x41\144\x6d\151\x6e\151\x73\164\x72\141\x74\157\x72\40\x79\141\x6e\147\x20\144\x69\142\x65\162\x69\40\x68\141\x6b\40\x75\156\x74\165\x6b\40\x6d\145\x6e\147\x61\153\x73\145\x73\40\x68\141\x6c\141\x6d\141\x6e\40\x69\156\x69");
 }
 goto L_3b40d;
 L_7fa33:
 $_0x49ce = session();
 goto L_6748d;
 L_3b40d:
 $_0xfd15 = $this->dashboardModel->getTahunActive();
 goto L_cb400;
 L_cb400:
 $_0x1710 = $this->dashboardModel->getSemesterActive();
 goto L_bf4e3;
 L_f900b:
 return view("\x6d\141\x73\164\x65\162\x2f\164\x61\150\x75\156\x2f\144\x61\164\x61", $_0xa94e);
 L_72d59:
 $_0xa94e = ["\x75\163\x65\162" => ["\x66\151\x72\163\x74\137\x6e\141\x6d\145" => $_0x49ce->get("\x75\163\x65\162\x6e\141\x6d\145"), "\x72\157\x6c\145\x5f\156\x61\155\x65" => $_0x49ce->get("\x72\157\x6c\145\x5f\156\x61\155\x65"), "\x66\157\x74\157" => $_0x49ce->get("\x66\157\x74\157") ?? ''], "\x6a\165\x64\165\x6c" => "\x54\141\x68\165\x6e\40\x50\145\x6c\141\x6a\141\x72\141\x6e\40\x64\141\x6e\40\x53\145\x6d\145\x73\164\x65\162", "\x73\165\x62\152\x75\144\x75\154" => "\x41\164\x75\162\x20\124\x61\150\x75\156\x20\120\x65\154\x61\152\x61\162\x61\156\x20\144\x61\156\x20\123\x65\155\x65\163\x74\145\x72", "\x73\145\x74\164\x69\156\x67" => $this->dashboardModel->getSetting(), "\x74\160" => $this->dashboardModel->getTahun(), "\x74\160\x5f\141\x63\164\x69\166\x65" => $_0xfd15, "\x73\155\x74" => $this->dashboardModel->getSemester(), "\x73\155\x74\137\x61\143\x74\151\x76\145" => $_0x1710, "\x6a\155\x6c\137\x68\141\x72\151" => $_0xe848];
 goto L_f900b;
 L_407e6:
 if ($_0xfd15 && $_0x1710) {
 $_0xb5c3 = db_connect();
 $_0x2ba8 = $_0xb5c3->table("\x6d\141\x73\164\x65\162\x5f\150\x61\162\x69\137\x65\146\x65\153\x74\151\x66")->where("\x69\144\x5f\150\x61\162\x69\137\x65\146\x65\153\x74\151\x66", $_0xfd15->id_tp . $_0x1710->id_smt)->get()->getRow();
 if ($_0x2ba8 && isset($_0x2ba8->jml_hari_efektif)) {
 $_0xe848 = (string) $_0x2ba8->jml_hari_efektif;
 }
 }
 goto L_72d59;
 L_bf4e3:
 $_0xe848 = "\x30";
 goto L_407e6;
 }
 public function data()
 {
 goto L_f58f9;
 L_f58f9:
 $_0x5bcd = db_connect();
 goto L_63aa2;
 L_73be1:
 return DataTable::of($_0x332a)->toJson(true);
 L_63aa2:
 $_0x332a = $_0x5bcd->table("\x6d\141\x73\164\x65\162\x5f\164\x70")->select("\x69\144\x5f\164\x70\54\x20\164\x61\150\x75\156\x2c\40\x61\143\x74\151\x76\145");
 goto L_73be1;
 }
 public function gantiTahun()
 {
 goto L_a940c;
 L_412b5:
 if ($_0x1ac5) {
 foreach ($_0x1ac5 as $_0x264d) {
 $_0xbfa9 = trim($_0x264d->id ?? '');
 $_0x7ff5 = trim($_0x264d->tp ?? '');
 $_0xa0ae = $_0xbfa9 == $_0x6a07 ? 1 : 0;
 $_0xbb98[] = ["\x69\144\x5f\164\x70" => $_0xbfa9, "\x74\141\x68\165\x6e" => $_0x7ff5, "\x61\143\x74\151\x76\145" => $_0xa0ae];
 }
 $_0x55b8 = db_connect();
 $_0x55b8->table("\x6d\141\x73\164\x65\162\x5f\164\x70")->updateBatch($_0xbb98, "\x69\144\x5f\164\x70");
 $this->logModel->saveLog(4, "\x6d\145\x6e\147\x67\141\x6e\164\x69\40\x74\141\x68\165\x6e\40\x61\152\x61\162\x61\156\x20\141\x6b\164\x69\146");
 \App\Models\DashboardModel::clearStaticCache();
 }
 goto L_795bb;
 L_795bb:
 return $this->response->setJSON(["\x6d\163\x67" => "\x4d\145\x72\165\x62\141\x68\40\x54\141\x68\165\x6e\40\x41\153\x74\151\x66", "\x6d\145\x73\163\x61\147\x65" => "\x4d\145\x72\165\x62\141\x68\40\x54\141\x68\165\x6e\40\x41\153\x74\151\x66", "\x73\164\x61\164\x75\163" => true]);
 L_60c87:
 $_0x1ac5 = json_decode($this->request->getPost("\x74\141\x68\165\x6e"));
 goto L_c8c90;
 L_a940c:
 $_0x6a07 = $this->request->getPost("\x61\143\x74\151\x76\145");
 goto L_60c87;
 L_c8c90:
 $_0xbb98 = [];
 goto L_412b5;
 }
 public function gantiSemester()
 {
 goto L_9b0d3;
 L_a48df:
 $_0x95e1 = json_decode($this->request->getPost("\x73\145\x6d\145\x73\164\x65\162"));
 goto L_bca72;
 L_bca72:
 $_0xc529 = [];
 goto L_eeaa2;
 L_9b0d3:
 $_0x14b6 = $this->request->getPost("\x61\143\x74\151\x76\145");
 goto L_a48df;
 L_eeaa2:
 if ($_0x95e1) {
 foreach ($_0x95e1 as $_0xd600) {
 $_0x44f2 = trim($_0xd600->id ?? '');
 $_0xfbcc = trim(isset($_0xd600->smt) ? $_0xd600->smt : (isset($_0xd600->Semester) ? $_0xd600->Semester : ''));
 $_0x8b83 = $_0x44f2 == $_0x14b6 ? 1 : 0;
 $_0xc529[] = ["\x69\144\x5f\163\x6d\164" => $_0x44f2, "\x73\155\x74" => $_0xfbcc, "\x61\143\x74\151\x76\145" => $_0x8b83];
 }
 $_0x909b = db_connect();
 $_0x909b->table("\x6d\141\x73\164\x65\162\x5f\163\x6d\164")->updateBatch($_0xc529, "\x69\144\x5f\163\x6d\164");
 $this->logModel->saveLog(4, "\x6d\145\x6e\147\x67\141\x6e\164\x69\40\x73\145\x6d\145\x73\164\x65\162\x20\141\x6b\164\x69\146");
 \App\Models\DashboardModel::clearStaticCache();
 }
 goto L_769da;
 L_769da:
 return $this->response->setJSON(["\x6d\163\x67" => "\x4d\145\x72\165\x62\141\x68\40\x53\145\x6d\145\x73\164\x65\162\x20\101\x6b\164\x69\146", "\x6d\145\x73\163\x61\147\x65" => "\x4d\145\x72\165\x62\141\x68\40\x53\145\x6d\145\x73\164\x65\162\x20\101\x6b\164\x69\146", "\x73\164\x61\164\x75\163" => true]);
 }
 public function add()
 {
 goto L_dca22;
 L_08832:
 $_0xe79c = db_connect();
 goto L_ecf3a;
 L_1b370:
 return $this->response->setJSON($_0xebdf);
 L_43a13:
 \App\Models\DashboardModel::clearStaticCache();
 goto L_1b370;
 L_5051f:
 $_0x5cb8 = trim((string) $this->request->getPost("\x74\141\x68\165\x6e"));
 goto L_08832;
 L_ecf3a:
 if ($_0x221a == "\x61\144\x64") {
 $_0xe79c->table("\x6d\141\x73\164\x65\162\x5f\164\x70")->insert(["\x74\141\x68\165\x6e" => $_0x5cb8, "\x61\143\x74\151\x76\145" => 0]);
 $this->logModel->saveLog(3, "\x6d\145\x6e\141\x6d\142\x61\150\x20\164\x61\150\x75\156\x20\160\x65\154\x61\152\x61\162\x61\156");
 $_0xebdf = ["\x73\164\x61\164\x75\163" => true];
 } else {
 $_0x33d1 = $this->request->getPost("\x69\144\x5f\164\x61\150\x75\156");
 $_0xe79c->table("\x6d\141\x73\164\x65\162\x5f\164\x70")->where("\x69\144\x5f\164\x70", $_0x33d1)->update(["\x74\141\x68\165\x6e" => $_0x5cb8]);
 $this->logModel->saveLog(4, "\x6d\145\x6e\147\x65\144\x69\164\x20\164\x61\150\x75\156\x20\160\x65\154\x61\152\x61\162\x61\156");
 $_0xebdf = ["\x73\164\x61\164\x75\163" => true];
 }
 goto L_43a13;
 L_dca22:
 $_0x221a = $this->request->getPost("\x6d\145\x74\150\x6f\144");
 goto L_5051f;
 }
 public function hapusTahun()
 {
 goto L_30692;
 L_2fd14:
 $_0x8eed = db_connect();
 goto L_93fe9;
 L_29825:
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\163\x67" => "\x54\151\x64\141\x6b\40\x61\144\x61\40\x64\141\x74\141\x20\171\x61\156\x67\40\x64\151\x68\141\x70\165\x73", "\x6d\145\x73\163\x61\147\x65" => "\x54\151\x64\141\x6b\40\x61\144\x61\40\x64\141\x74\141\x20\171\x61\156\x67\40\x64\151\x68\141\x70\165\x73"]);
 L_93fe9:
 if (is_array($_0x2411) || !empty($_0x2411)) {
 if (!is_array($_0x2411)) {
 $_0x2411 = explode("\x2c", $_0x2411);
 }
 $_0x8eed->table("\x6d\141\x73\164\x65\162\x5f\164\x70")->whereIn("\x69\144\x5f\164\x70", $_0x2411)->delete();
 $this->logModel->saveLog(5, "\x6d\145\x6e\147\x68\141\x70\165\x73\40\x74\141\x68\165\x6e\40\x70\145\x6c\141\x6a\141\x72\141\x6e");
 \App\Models\DashboardModel::clearStaticCache();
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => true, "\x6d\163\x67" => count($_0x2411) . "\x20\144\x61\164\x61\40\x62\145\x72\150\x61\163\x69\154\x20\144\x69\150\x61\160\x75\163", "\x6d\145\x73\163\x61\147\x65" => count($_0x2411) . "\x20\144\x61\164\x61\40\x62\145\x72\150\x61\163\x69\154\x20\144\x69\150\x61\160\x75\163"]);
 }
 goto L_29825;
 L_30692:
 $_0x2411 = $this->request->getPost("\x68\141\x70\165\x73");
 goto L_2fd14;
 }
 public function saveHariEfektif()
 {
 goto L_41bf3;
 L_41bf3:
 $_0xfa13 = $this->dashboardModel->getTahunActive();
 goto L_79013;
 L_79013:
 $_0x95d0 = $this->dashboardModel->getSemesterActive();
 goto L_4e96f;
 L_e0504:
 $_0xfea9 = $_0xfe87->table("\x6d\141\x73\164\x65\162\x5f\150\x61\162\x69\137\x65\146\x65\153\x74\151\x66")->replace($_0xf373);
 goto L_3ea0e;
 L_4e96f:
 $_0xf373 = ["\x69\144\x5f\150\x61\162\x69\137\x65\146\x65\153\x74\151\x66" => $_0xfa13->id_tp . $_0x95d0->id_smt, "\x6a\155\x6c\137\x68\141\x72\151\x5f\145\x66\145\x6b\164\x69\146" => $this->request->getPost("\x6a\155\x6c\137\x68\141\x72\151")];
 goto L_a32e3;
 L_3ea0e:
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => $_0xfea9]);
 L_a32e3:
 $_0xfe87 = \Config\Database::connect();
 goto L_e0504;
 }
}