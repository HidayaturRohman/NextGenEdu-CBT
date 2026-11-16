<?php
/*   ________________________________________
    |               NextGen Garuda CBT       |
    |    Protected & Distributed via GitHub  |
    |________________________________________|
*/
namespace App\Controllers;

use App\Models\MasterModel;
use App\Models\DashboardModel;
use App\Models\KelasModel;
class Walicatatan extends BaseController
{
 protected $masterModel;
 protected $dashboardModel;
 protected $kelasModel;
 public function __construct()
 {
 goto L_94de8;
 L_a7a7c:
 $this->kelasModel = new KelasModel();
 L_af09f:
 $this->dashboardModel = new DashboardModel();
 goto L_a7a7c;
 L_94de8:
 $this->masterModel = new MasterModel();
 goto L_af09f;
 }
 public function index()
 {
 goto L_48499;
 L_48499:
 $_0x49ce = session();
 goto L_7a20a;
 L_21465:
 $_0x6af0 = $this->dashboardModel->getDataGuruByUserId($_0x49ce->get("\x69\144\x5f\165\x73\145\x72"), $_0x641c->id_tp ?? null, $_0x6017->id_smt ?? null);
 goto L_e910b;
 L_80e80:
 $_0x6017 = $this->dashboardModel->getSemesterActive();
 goto L_21465;
 L_e910b:
 if (!$_0x6af0 || !$_0x6af0->wali_kelas) {
 return redirect()->to("\x64\141\x73\150\x62\157\x61\162\x64")->with("\x65\162\x72\157\x72", "\x41\156\x64\141\x20\142\x75\153\x61\156\x20\167\x61\154\x69\40\x6b\145\x6c\141\x73\56");
 }
 goto L_831d8;
 L_7a20a:
 if (!$_0x49ce->get("\x69\163\x5f\154\x6f\147\x69\156")) {
 return redirect()->to("\x61\165\x74\150\x2f\154\x6f\147\x69\156");
 }
 goto L_9ae0e;
 L_831d8:
 $_0x372a = ["\x75\163\x65\162" => ["\x66\151\x72\163\x74\137\x6e\141\x6d\145" => $_0x49ce->get("\x75\163\x65\162\x6e\141\x6d\145"), "\x72\157\x6c\145\x5f\156\x61\155\x65" => $_0x49ce->get("\x72\157\x6c\145\x5f\156\x61\155\x65"), "\x66\157\x74\157" => $_0x49ce->get("\x66\157\x74\157") ?? ''], "\x6a\165\x64\165\x6c" => "\x43\141\x74\141\x74\141\x6e\40\x57\141\x6c\151\x20\113\x65\154\x61\163", "\x73\165\x62\152\x75\144\x75\154" => "\x43\141\x74\141\x74\141\x6e\40\x4b\145\x6c\141\x73", "\x73\145\x74\164\x69\156\x67" => $this->dashboardModel->getSetting(), "\x74\160" => $this->dashboardModel->getTahun(), "\x74\160\x5f\141\x63\164\x69\166\x65" => $_0x641c, "\x73\155\x74" => $this->dashboardModel->getSemester(), "\x73\155\x74\137\x61\143\x74\151\x76\145" => $_0x6017, "\x67\165\x72\165" => $_0x6af0, "\x69\163\x5f\141\x64\155\x69\156" => $_0x49ce->get("\x72\157\x6c\145") == "\x31"];
 goto L_f9d12;
 L_666c4:
 $_0x641c = $this->dashboardModel->getTahunActive();
 goto L_80e80;
 L_f9d12:
 $_0x372a["\x63\141\x74\141\x74\141\x6e\137\x6b\145\x6c\141\x73"] = $this->kelasModel->getCatatanKelas($_0x6af0->wali_kelas, $_0x641c->id_tp ?? null, $_0x6017->id_smt ?? null);
 goto L_87373;
 L_9ae0e:
 if ($_0x49ce->get("\x72\157\x6c\145") != "\x31" && $_0x49ce->get("\x72\157\x6c\145") != "\x32") {
 return redirect()->to("\x64\141\x73\150\x62\157\x61\162\x64")->with("\x65\162\x72\157\x72", "\x48\141\x6e\171\x61\40\x41\144\x6d\151\x6e\151\x73\164\x72\141\x74\157\x72\40\x64\141\x6e\40\x67\165\x72\165\x20\171\x61\156\x67\40\x64\151\x62\145\x72\151\x20\150\x61\153\x20\165\x6e\164\x75\153\x20\155\x65\156\x67\141\x6b\163\x65\163\x20\150\x61\154\x61\155\x61\156\x20\151\x6e\151\x2e");
 }
 goto L_666c4;
 L_228c2:
 return view("\x6d\145\x6d\142\x65\162\x73\57\x67\165\x72\165\x2f\167\x61\154\x69\57\x63\141\x74\141\x74\141\x6e", $_0x372a);
 L_87373:
 $_0x372a["\x63\141\x74\141\x74\141\x6e\137\x73\151\x73\167\x61"] = $this->kelasModel->getCatatanSiswa($_0x641c->id_tp ?? null, $_0x6017->id_smt ?? null, $_0x6af0->wali_kelas);
 goto L_228c2;
 }
 public function siswa()
 {
 goto L_1e9e7;
 L_42df2:
 $_0x8974 = $this->dashboardModel->getSemesterActive();
 goto L_91bd6;
 L_1e9e7:
 $_0xa0ad = session();
 goto L_c885b;
 L_c885b:
 if (!$_0xa0ad->get("\x69\163\x5f\154\x6f\147\x69\156")) {
 return redirect()->to("\x61\165\x74\150\x2f\154\x6f\147\x69\156");
 }
 goto L_823f4;
 L_823f4:
 $_0x359b = $this->request->getGet("\x69\144\x5f\163\x69\163\x77\141");
 goto L_7df6a;
 L_91bd6:
 $_0x132c = $this->dashboardModel->getDataGuruByUserId($_0xa0ad->get("\x69\144\x5f\165\x73\145\x72"), $_0xf3ce->id_tp ?? null, $_0x8974->id_smt ?? null);
 goto L_75704;
 L_75704:
 $_0x2991 = ["\x75\163\x65\162" => ["\x66\151\x72\163\x74\137\x6e\141\x6d\145" => $_0xa0ad->get("\x75\163\x65\162\x6e\141\x6d\145"), "\x72\157\x6c\145\x5f\156\x61\155\x65" => $_0xa0ad->get("\x72\157\x6c\145\x5f\156\x61\155\x65"), "\x66\157\x74\157" => $_0xa0ad->get("\x66\157\x74\157") ?? ''], "\x6a\165\x64\165\x6c" => "\x43\141\x74\141\x74\141\x6e\40\x53\151\x73\167\x61", "\x73\165\x62\152\x75\144\x75\154" => "\x43\141\x74\141\x74\141\x6e\40\x53\151\x73\167\x61", "\x73\145\x74\164\x69\156\x67" => $this->dashboardModel->getSetting(), "\x74\160" => $this->dashboardModel->getTahun(), "\x74\160\x5f\141\x63\164\x69\166\x65" => $_0xf3ce, "\x73\155\x74" => $this->dashboardModel->getSemester(), "\x73\155\x74\137\x61\143\x74\151\x76\145" => $_0x8974, "\x67\165\x72\165" => $_0x132c, "\x73\151\x73\167\x61" => $this->masterModel->getSiswaById($_0x359b), "\x63\141\x74\141\x74\141\x6e\137\x73\151\x73\167\x61" => $this->kelasModel->getAllCatatanSiswa($_0x359b, $_0xf3ce->id_tp ?? null, $_0x8974->id_smt ?? null), "\x69\144\x5f\153\x65\154\x61\163" => $_0x337b, "\x69\163\x5f\141\x64\155\x69\156" => $_0xa0ad->get("\x72\157\x6c\145") == "\x31"];
 goto L_330e0;
 L_ffaec:
 $_0xf3ce = $this->dashboardModel->getTahunActive();
 goto L_42df2;
 L_330e0:
 return view("\x6d\145\x6d\142\x65\162\x73\57\x67\165\x72\165\x2f\167\x61\154\x69\57\x70\145\x72\163\x69\163\x77\141", $_0x2991);
 L_7df6a:
 $_0x337b = $this->request->getGet("\x69\144\x5f\153\x65\154\x61\163");
 goto L_ffaec;
 }
 public function saveCatatanKelas()
 {
 goto L_68ae9;
 L_68f16:
 $_0x5834 = $_0x25d2->table("\x6b\145\x6c\141\x73\137\x63\141\x74\141\x74\141\x6e\137\x77\141\x6c\151")->insert($_0x2efc);
 goto L_beffa;
 L_e3402:
 $_0x25d2 = \Config\Database::connect();
 goto L_68f16;
 L_70ac9:
 $_0x2efc = ["\x69\144\x5f\164\x70" => $_0x5641->id_tp ?? null, "\x69\144\x5f\163\x6d\164" => $_0xd78c->id_smt ?? null, "\x74\171\x70\145" => "\x31", "\x6c\145\x76\145\x6c" => $_0xdfb1, "\x69\144\x5f\153\x65\154\x61\163" => $_0xdede->wali_kelas, "\x74\145\x78\164" => $_0xe35c, "\x72\145\x61\144\x69\156\x67" => json_encode([])];
 goto L_e3402;
 L_68ae9:
 $_0x5476 = session();
 goto L_ddf14;
 L_2be55:
 $_0xdfb1 = $this->request->getPost("\x6c\145\x76\145\x6c");
 goto L_70ac9;
 L_ddf14:
 $_0x5641 = $this->dashboardModel->getTahunActive();
 goto L_92a69;
 L_f606d:
 $_0xe35c = $this->request->getPost("\x74\145\x78\164");
 goto L_2be55;
 L_beffa:
 return $this->response->setJSON($_0x5834);
 L_b5223:
 $_0xdede = $this->dashboardModel->getDataGuruByUserId($_0x5476->get("\x69\144\x5f\165\x73\145\x72"), $_0x5641->id_tp ?? null, $_0xd78c->id_smt ?? null);
 goto L_f606d;
 L_92a69:
 $_0xd78c = $this->dashboardModel->getSemesterActive();
 goto L_b5223;
 }
 public function saveCatatanSiswa()
 {
 goto L_ccc0b;
 L_65a13:
 $_0x1dff = $this->request->getPost("\x6c\145\x76\145\x6c");
 goto L_25ff3;
 L_37fd7:
 $_0xfbcc = $this->dashboardModel->getSemesterActive();
 goto L_a24db;
 L_a24db:
 $_0x6221 = $this->dashboardModel->getDataGuruByUserId($_0x531b->get("\x69\144\x5f\165\x73\145\x72"), $_0x7d6c->id_tp ?? null, $_0xfbcc->id_smt ?? null);
 goto L_d3463;
 L_25ff3:
 $_0xebdf = ["\x69\144\x5f\164\x70" => $_0x7d6c->id_tp ?? null, "\x69\144\x5f\163\x6d\164" => $_0xfbcc->id_smt ?? null, "\x74\171\x70\145" => "\x32", "\x6c\145\x76\145\x6c" => $_0x1dff, "\x69\144\x5f\153\x65\154\x61\163" => $_0x6221->wali_kelas, "\x69\144\x5f\163\x69\163\x77\141" => $_0x7efb, "\x74\145\x78\164" => $_0x521f, "\x72\145\x61\144\x69\156\x67" => json_encode([])];
 goto L_93e43;
 L_93e43:
 $_0xee2a = \Config\Database::connect();
 goto L_36c98;
 L_d3463:
 $_0x7efb = $this->request->getPost("\x69\144\x5f\163\x69\163\x77\141");
 goto L_966b0;
 L_36c98:
 $_0x840c = $_0xee2a->table("\x6b\145\x6c\141\x73\137\x63\141\x74\141\x74\141\x6e\137\x77\141\x6c\151")->insert($_0xebdf);
 goto L_55556;
 L_44aef:
 $_0x7d6c = $this->dashboardModel->getTahunActive();
 goto L_37fd7;
 L_ccc0b:
 $_0x531b = session();
 goto L_44aef;
 L_55556:
 return $this->response->setJSON($_0x840c);
 L_966b0:
 $_0x521f = $this->request->getPost("\x74\145\x78\164");
 goto L_65a13;
 }
 public function hapus($_0x1f5e)
 {
 goto L_5f14e;
 L_9b70e:
 $_0x3054 = $_0x17e4->table("\x6b\145\x6c\141\x73\137\x63\141\x74\141\x74\141\x6e\137\x77\141\x6c\151")->where("\x69\144\x5f\143\x61\164\x61\164\x61\156", $_0x1f5e)->delete();
 goto L_d1f74;
 L_d1f74:
 return $this->response->setJSON($_0x3054);
 L_5f14e:
 $_0x17e4 = \Config\Database::connect();
 goto L_9b70e;
 }
}