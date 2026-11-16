<?php
/*   ________________________________________
    |               NextGen Garuda CBT       |
    |    Protected & Distributed via GitHub  |
    |________________________________________|
*/
namespace App\Controllers;

use App\Models\DashboardModel;
class Datalogs extends BaseController
{
 protected $dashboardModel;
 public function __construct()
 {
 $this->dashboardModel = new DashboardModel();
 }
 public function index()
 {
 goto L_4ea9d;
 L_477bf:
 $_0x3047 = ["\x75\163\x65\162" => ["\x66\151\x72\163\x74\137\x6e\141\x6d\145" => $_0x3ec9->get("\x75\163\x65\162\x6e\141\x6d\145"), "\x72\157\x6c\145\x5f\156\x61\155\x65" => $_0x3ec9->get("\x72\157\x6c\145\x5f\156\x61\155\x65"), "\x66\157\x74\157" => $_0x3ec9->get("\x66\157\x74\157") ?? ''], "\x6a\165\x64\165\x6c" => "\x4c\157\x67\40\x41\153\x74\151\x76\151\x74\141\x73", "\x73\165\x62\152\x75\144\x75\154" => "\x4c\157\x67\40\x41\153\x74\151\x76\151\x74\141\x73", "\x73\145\x74\164\x69\156\x67" => $this->dashboardModel->getSetting(), "\x74\160" => $this->dashboardModel->getTahun(), "\x73\155\x74" => $this->dashboardModel->getSemester(), "\x74\160\x5f\141\x63\164\x69\166\x65" => $_0x29ec, "\x73\155\x74\137\x61\143\x74\151\x76\145" => $_0xc13d, "\x69\163\x5f\141\x64\155\x69\156" => in_array((string) $_0x3ec9->get("\x72\157\x6c\145"), ["\x31", "\x34"])];
 goto L_ccfa1;
 L_ccfa1:
 if (in_array((string) $_0x3ec9->get("\x72\157\x6c\145"), ["\x31", "\x34"])) {
 return view("\x6d\141\x73\164\x65\162\x2f\154\x6f\147\x73\57\x64\141\x74\141", $_0x3047);
 } else if ($_0x3ec9->get("\x72\157\x6c\145") == "\x32") {
 // Guru
 $_0x1a9a = $_0xb5c3->table("\x6d\141\x73\164\x65\162\x5f\147\x75\162\x75")->where("\x69\144\x5f\165\x73\145\x72", $_0x3ec9->get("\x69\144\x5f\165\x73\145\x72"))->get()->getRow();
 $_0x3047["\x67\165\x72\165"] = $_0x1a9a;
 return view("\x6d\141\x73\164\x65\162\x2f\154\x6f\147\x73\57\x64\141\x74\141", $_0x3047);
 } else {
 return redirect()->to("\x64\141\x73\150\x62\157\x61\162\x64")->with("\x65\162\x72\157\x72", "\x41\153\x73\145\x73\40\x64\151\x74\157\x6c\141\x6b\56");
 }
 L_4ea9d:
 $_0x3ec9 = session();
 goto L_77285;
 L_455c1:
 $_0xc13d = $this->dashboardModel->getSemesterActive();
 goto L_477bf;
 L_97e4b:
 $_0x29ec = $this->dashboardModel->getTahunActive();
 goto L_455c1;
 L_77285:
 if (!$_0x3ec9->get("\x69\163\x5f\154\x6f\147\x69\156")) {
 return redirect()->to("\x61\165\x74\150\x2f\154\x6f\147\x69\156");
 }
 goto L_83cfa;
 L_83cfa:
 $_0xb5c3 = \Config\Database::connect();
 goto L_97e4b;
 }
 public function getlog()
 {
 goto L_4e487;
 L_4e143:
 $_0x24b9 = [];
 goto L_60ebf;
 L_cf483:
 $_0x73c1 = (int) ($this->request->getGet("\x70\141\x67\145") ?? 1);
 goto L_aef21;
 L_f2c92:
 if ($_0x9fd4 < 1) {
 $_0x9fd4 = 15;
 }
 goto L_cc971;
 L_3e4b8:
 $_0xd976 = ($_0x73c1 - 1) * $_0x9fd4;
 goto L_391a4;
 L_391a4:
 $_0x8bfb = $_0xcbdc->table("\x6c\157\x67\40\x61");
 goto L_3beb9;
 L_7c9e6:
 return $this->response->setJSON($_0xf7cd);
 L_097d8:
 if ($_0x54f8 && is_array($_0x54f8) && count($_0x54f8) > 0) {
 $_0x8bfb->whereIn("\x61\56\x69\144\x5f\147\x72\157\x75\160", $_0x54f8);
 }
 goto L_a8b30;
 L_03528:
 $_0x6790 = [];
 goto L_7cce0;
 L_60ebf:
 if (count($_0xe039) > 0) {
 $_0x24b9 = $_0xcbdc->table("\x6d\141\x73\164\x65\162\x5f\147\x75\162\x75")->whereIn("\x69\144\x5f\165\x73\145\x72", $_0xe039)->select("\x69\144\x5f\165\x73\145\x72\40\x61\163\x20\151\x64\54\x20\146\x6f\164\x6f")->get()->getResultArray();
 }
 goto L_ab229;
 L_ab229:
 $_0x8429 = [];
 goto L_57db4;
 L_7cce0:
 $_0x7aa2 = [];
 goto L_6bade;
 L_22fdc:
 $_0x82b7 = [];
 goto L_19db6;
 L_5b3ca:
 $_0xf7cd = ["\x73\151\x73\167\x61" => $_0x82b7, "\x67\165\x72\165" => $_0x24b9, "\x61\144\x6d\151\x6e\163" => $_0x8429, "\x6c\157\x67\163" => $_0x84f8, "\x74\157\x74\141\x6c" => $_0xd99e];
 goto L_7c9e6;
 L_b0321:
 $_0x8bfb->limit($_0x9fd4, $_0xd976);
 goto L_3e6a8;
 L_3e6a8:
 $_0x84f8 = $_0x8bfb->get()->getResult();
 goto L_cb65c;
 L_4e487:
 $_0xcbdc = \Config\Database::connect();
 goto L_cf483;
 L_dbef4:
 // array
 $_0x2749 = $this->request->getGet("\x73\145\x61\162\x63\150");
 goto L_3e4b8;
 L_45aab:
 $_0x8bfb->join("\x75\163\x65\162\x73\40\x62", "\x62\56\x69\144\x20\75\x20\141\x2e\151\x64\137\x75\163\x65\162", "\x6c\145\x66\164");
 goto L_097d8;
 L_19db6:
 if (count($_0x6790) > 0) {
 $_0x3c11 = $_0xcbdc->table("\x75\163\x65\162\x73\40\x64");
 $_0x3c11->select("\x64\56\x69\144\x2c\40\x61\56\x66\157\x74\157");
 $_0x3c11->join("\x6d\141\x73\164\x65\162\x5f\163\x69\163\x77\141\x20\141", "\x61\56\x75\163\x65\162\x6e\141\x6d\145\x20\75\x20\144\x2e\165\x73\145\x72\156\x61\155\x65");
 $_0x3c11->whereIn("\x64\56\x69\144", $_0x6790);
 $_0x82b7 = $_0x3c11->get()->getResultArray();
 }
 goto L_4e143;
 L_aef21:
 if ($_0x73c1 < 1) {
 $_0x73c1 = 1;
 }
 goto L_07e5d;
 L_a8b30:
 if (!empty($_0x2749)) {
 $_0x8bfb->groupStart()->like("\x62\56\x66\151\x72\163\x74\137\x6e\141\x6d\145", $_0x2749)->orLike("\x62\56\x6c\141\x73\164\x5f\156\x61\155\x65", $_0x2749)->orLike("\x61\56\x6c\157\x67\137\x64\145\x73\143", $_0x2749)->groupEnd();
 }
 goto L_67873;
 L_3beb9:
 $_0x8bfb->select("\x61\56\x2a\54\x20\142\x2e\146\x69\162\x73\164\x5f\156\x61\155\x65\54\x20\142\x2e\154\x61\163\x74\137\x6e\141\x6d\145");
 goto L_45aab;
 L_6bade:
 foreach ($_0x84f8 as $_0x4627) {
 if ($_0x4627->id_group == "\x32") {
 if ($_0x4627->id_user && !in_array($_0x4627->id_user, $_0xe039)) {
 $_0xe039[] = $_0x4627->id_user;
 }
 } elseif ($_0x4627->id_group == "\x33") {
 if ($_0x4627->id_user && !in_array($_0x4627->id_user, $_0x6790)) {
 $_0x6790[] = $_0x4627->id_user;
 }
 } else if ($_0x4627->id_user && !in_array($_0x4627->id_user, $_0x7aa2)) {
 $_0x7aa2[] = $_0x4627->id_user;
 }
 }
 goto L_22fdc;
 L_57db4:
 if (count($_0x7aa2) > 0) {
 $_0x8429 = $_0xcbdc->table("\x75\163\x65\162\x73")->whereIn("\x69\144", $_0x7aa2)->select("\x69\144\x2c\40\x66\157\x74\157")->get()->getResultArray();
 }
 goto L_5b3ca;
 L_cb65c:
 $_0xe039 = [];
 goto L_03528;
 L_85c51:
 $_0x8bfb->orderBy("\x61\56\x6c\157\x67\137\x74\151\x6d\145", "\x44\105\x53\103");
 goto L_b0321;
 L_67873:
 $_0xd99e = $_0x8bfb->countAllResults(false);
 goto L_85c51;
 L_cc971:
 $_0x54f8 = $this->request->getGet("\x66\151\x6c\164\x65\162");
 goto L_dbef4;
 L_07e5d:
 $_0x9fd4 = (int) ($this->request->getGet("\x6c\151\x6d\151\x74") ?? 15);
 goto L_f2c92;
 }
 public function hapuslog($_0xfe74 = null)
 {
 $_0xe79c = \Config\Database::connect();
 if ($_0xfe74 == "\x73\145\x6c\145\x63\164\x65\144") {
 $_0xce2b = $this->request->getGet("\x69\144\x73");
 if (is_array($_0xce2b)) {
 $_0xe79c->table("\x6c\157\x67")->whereIn("\x69\144\x5f\154\x6f\147", $_0xce2b)->delete();
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => true]);
 }
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false]);
 } elseif ($_0xfe74 == "\x61\154\x6c") {
 $_0xe79c->table("\x6c\157\x67")->truncate();
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => true]);
 } else {
 $_0xe79c->table("\x6c\157\x67")->where("\x69\144\x5f\154\x6f\147", $_0xfe74)->delete();
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => true]);
 }
 }
}