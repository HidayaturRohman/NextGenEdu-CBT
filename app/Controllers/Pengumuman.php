<?php
/*   ________________________________________
    |               NextGen Garuda CBT       |
    |    Protected & Distributed via GitHub  |
    |________________________________________|
*/
namespace App\Controllers;

use App\Models\DashboardModel;
use App\Models\DropdownModel;
use App\Models\PostModel;
class Pengumuman extends BaseController
{
 protected $dashboardModel;
 protected $dropdownModel;
 protected $postModel;
 public function __construct()
 {
 goto L_da0f3;
 L_a0469:
 $this->dropdownModel = new DropdownModel();
 goto L_85eb3;
 L_85eb3:
 $this->postModel = new PostModel();
 L_da0f3:
 $this->dashboardModel = new DashboardModel();
 goto L_a0469;
 }
 public function index()
 {
 goto L_64d16;
 L_60f39:
 $_0xc5a9 = \Config\Database::connect();
 goto L_b4592;
 L_b4592:
 $_0x4740 = ["\x75\163\x65\162" => ["\x66\151\x72\163\x74\137\x6e\141\x6d\145" => $_0xa7c0->get("\x75\163\x65\162\x6e\141\x6d\145"), "\x72\157\x6c\145\x5f\156\x61\155\x65" => $_0xa7c0->get("\x72\157\x6c\145\x5f\156\x61\155\x65"), "\x66\157\x74\157" => $_0xa7c0->get("\x66\157\x74\157") ?? ''], "\x6a\165\x64\165\x6c" => "\x50\145\x6e\147\x75\155\x75\155\x61\156", "\x73\145\x74\164\x69\156\x67" => $this->dashboardModel->getSetting(), "\x74\160" => $this->dashboardModel->getTahun(), "\x74\160\x5f\141\x63\164\x69\166\x65" => $_0x131b, "\x73\155\x74" => $this->dashboardModel->getSemester(), "\x73\155\x74\137\x61\143\x74\151\x76\145" => $_0xfe73, "\x69\163\x5f\141\x64\155\x69\156" => in_array((string) $_0xa7c0->get("\x72\157\x6c\145"), ["\x31", "\x34"]), "\x72\165\x6e\156\x69\156\x67\137\x74\145\x78\164" => $this->dashboardModel->getRunningText(), "\x67\165\x72\165\x73" => $this->dropdownModel->getAllGuru(), "\x6b\145\x6c\141\x73" => $this->dropdownModel->getAllKodeKelas($_0x131b->id_tp ?? null, $_0xfe73->id_smt ?? null)];
 goto L_a389c;
 L_4d090:
 $_0xfe73 = $this->dashboardModel->getSemesterActive();
 goto L_60f39;
 L_bc395:
 if (!in_array((string) $_0xa7c0->get("\x72\157\x6c\145"), ["\x31", "\x32", "\x34"])) {
 return redirect()->to("\x64\141\x73\150\x62\157\x61\162\x64")->with("\x65\162\x72\157\x72", "\x48\141\x6e\171\x61\40\x41\144\x6d\151\x6e\151\x73\164\x72\141\x74\157\x72\40\x64\141\x6e\40\x67\165\x72\165\x20\171\x61\156\x67\40\x64\151\x62\145\x72\151\x20\150\x61\153\x20\165\x6e\164\x75\153\x20\155\x65\156\x67\141\x6b\163\x65\163\x20\150\x61\154\x61\155\x61\156\x20\151\x6e\151\x2e");
 }
 goto L_ab85c;
 L_ab85c:
 $_0x131b = $this->dashboardModel->getTahunActive();
 goto L_4d090;
 L_b17a5:
 if (!$_0xa7c0->get("\x69\163\x5f\154\x6f\147\x69\156")) {
 return redirect()->to("\x61\165\x74\150\x2f\154\x6f\147\x69\156");
 }
 goto L_bc395;
 L_a389c:
 if (in_array((string) $_0xa7c0->get("\x72\157\x6c\145"), ["\x31", "\x34"])) {
 $_0x4740["\x73\165\x62\152\x75\144\x75\154"] = "\x53\145\x6d\165\x61\40\x50\145\x6e\147\x75\155\x75\155\x61\156";
 $_0x4740["\x70\145\x6e\147\x75\155\x75\155\x61\156\x73"] = $this->postModel->getPostUser(0);
 return view("\x70\145\x6e\147\x75\155\x75\155\x61\156\x2f\144\x61\164\x61", $_0x4740);
 } else {
 $_0x4740["\x73\165\x62\152\x75\144\x75\154"] = "\x50\145\x6e\147\x75\155\x75\155\x61\156\x20\101\x6e\144\x61";
 $_0x6d9d = $_0xc5a9->table("\x6d\141\x73\164\x65\162\x5f\147\x75\162\x75")->where("\x69\144\x5f\165\x73\145\x72", $_0xa7c0->get("\x69\144\x5f\165\x73\145\x72"))->get()->getRow();
 $_0x4740["\x67\165\x72\165"] = $_0x6d9d;
 $_0x4740["\x70\145\x6e\147\x75\155\x75\155\x61\156\x73"] = $this->postModel->getPostUser($_0x6d9d ? $_0x6d9d->id_guru : 0);
 return view("\x70\145\x6e\147\x75\155\x75\155\x61\156\x2f\144\x61\164\x61", $_0x4740);
 }
 L_64d16:
 $_0xa7c0 = session();
 goto L_b17a5;
 }
 public function kepada($_0x9195 = null, $_0xb649 = null)
 {
 goto L_e0fe7;
 L_869b5:
 $_0x84c9 = $this->dashboardModel->getTahunActive();
 goto L_bcf0b;
 L_ce643:
 // Fetch pengumumans just like CI3 did!
 $_0x442d = $_0xbcdb->table("\x70\157\x73\164\x20\141");
 goto L_0d5c4;
 L_d53a2:
 $_0x36d0 = $_0xbcdb->table("\x70\157\x73\164\x5f\162\x65\160\x6c\171")->countAllResults();
 goto L_7ff45;
 L_0d5c4:
 $_0x442d->select("\x61\56\x2a\54\x20\142\x2e\156\x61\155\x61\137\x67\165\x72\165\x2c\40\x62\56\x66\157\x74\157");
 goto L_a8b87;
 L_7f16c:
 if (!$_0x9155->get("\x69\163\x5f\154\x6f\147\x69\156")) {
 return redirect()->to("\x61\165\x74\150\x2f\154\x6f\147\x69\156");
 }
 goto L_1d868;
 L_bcf0b:
 $_0xa7e6 = $this->dashboardModel->getSemesterActive();
 goto L_af725;
 L_1abf6:
 $_0x442d->orderBy("\x61\56\x74\141\x6e\147\x67\141\x6c", "\x64\145\x73\143");
 goto L_18942;
 L_5cdf6:
 $_0x9470 = [];
 goto L_e979a;
 L_da880:
 $_0x59fb["\x62\141\x6c\141\x73\141\x6e\163\x5f\144\x61\164\x61"] = $_0x9470;
 goto L_38738;
 L_7e315:
 $_0xfad0 = [];
 goto L_5cdf6;
 L_8df2b:
 if (in_array((string) $_0x9155->get("\x72\157\x6c\145"), ["\x31", "\x34"])) {
 return view("\x70\145\x6e\147\x75\155\x75\155\x61\156\x2f\144\x61\164\x61", $_0x59fb);
 } else {
 $_0x59fb["\x67\165\x72\165"] = $_0xbcdb->table("\x6d\141\x73\164\x65\162\x5f\147\x75\162\x75")->where("\x69\144\x5f\165\x73\145\x72", $_0x9155->get("\x69\144\x5f\165\x73\145\x72"))->get()->getRow();
 return view("\x70\145\x6e\147\x75\155\x75\155\x61\156\x2f\144\x61\164\x61", $_0x59fb);
 }
 L_e979a:
 foreach ($_0xa639 as $_0x391c) {
 $_0x67a3 = $_0xbcdb->table("\x70\157\x73\164\x5f\143\x6f\155\x6d\145\x6e\164\x73\40\x61");
 $_0x67a3->select("\x61\56\x2a\54\x20\142\x2e\156\x61\155\x61\137\x67\165\x72\165\x2c\40\x62\56\x66\157\x74\157");
 $_0x67a3->join("\x6d\141\x73\164\x65\162\x5f\147\x75\162\x75\40\x62", "\x61\56\x64\141\x72\151\x3d\142\x2e\151\x64\137\x67\165\x72\165", "\x6c\145\x66\164");
 $_0x67a3->orderBy("\x61\56\x74\141\x6e\147\x67\141\x6c", "\x64\145\x73\143");
 $_0x67a3->where("\x61\56\x69\144\x5f\160\x6f\163\x74", $_0x391c->id_post);
 $_0xcd20 = $_0x67a3->get()->getResult();
 foreach ($_0xcd20 as $_0xad30) {
 $_0x3fb6 = $_0xbcdb->table("\x70\157\x73\164\x5f\162\x65\160\x6c\171\x20\141");
 $_0x3fb6->select("\x61\56\x2a\54\x20\142\x2e\156\x61\155\x61\137\x67\165\x72\165\x2c\40\x62\56\x66\157\x74\157");
 $_0x3fb6->join("\x6d\141\x73\164\x65\162\x5f\147\x75\162\x75\40\x62", "\x61\56\x64\141\x72\151\x3d\142\x2e\151\x64\137\x67\165\x72\165", "\x6c\145\x66\164");
 $_0x3fb6->orderBy("\x61\56\x74\141\x6e\147\x67\141\x6c", "\x64\145\x73\143");
 $_0x3fb6->where("\x61\56\x69\144\x5f\143\x6f\155\x6d\145\x6e\164", $_0xad30->id_comment);
 $_0x9470[$_0x391c->id_post][$_0xad30->id_comment] = $_0x3fb6->get()->getResult();
 }
 $_0xfad0[$_0x391c->id_post] = $_0xcd20;
 }
 goto L_50ed2;
 L_a8b87:
 $_0x442d->join("\x6d\141\x73\164\x65\162\x5f\147\x75\162\x75\40\x62", "\x61\56\x64\141\x72\151\x3d\142\x2e\151\x64\137\x67\165\x72\165", "\x6c\145\x66\164");
 goto L_1abf6;
 L_7ff45:
 $_0x59fb = ["\x75\163\x65\162" => ["\x66\151\x72\163\x74\137\x6e\141\x6d\145" => $_0x9155->get("\x75\163\x65\162\x6e\141\x6d\145"), "\x72\157\x6c\145\x5f\156\x61\155\x65" => $_0x9155->get("\x72\157\x6c\145\x5f\156\x61\155\x65"), "\x66\157\x74\157" => $_0x9155->get("\x66\157\x74\157") ?? ''], "\x6a\165\x64\165\x6c" => "\x50\145\x6e\147\x75\155\x75\155\x61\156", "\x73\165\x62\152\x75\144\x75\154" => "\x53\145\x6d\165\x61\40\x50\145\x6e\147\x75\155\x75\155\x61\156", "\x73\145\x74\164\x69\156\x67" => $this->dashboardModel->getSetting(), "\x74\160" => $this->dashboardModel->getTahun(), "\x74\160\x5f\141\x63\164\x69\166\x65" => $_0x84c9, "\x73\155\x74" => $this->dashboardModel->getSemester(), "\x73\155\x74\137\x61\143\x74\151\x76\145" => $_0xa7e6, "\x63\157\x6d\155\x65\156\x74\163" => $_0x7897, "\x62\141\x6c\141\x73\141\x6e\163" => $_0x36d0, "\x69\144\x5f\153\x65\160\x61\144\x61" => $_0xb649, "\x69\163\x5f\141\x64\155\x69\156" => in_array((string) $_0x9155->get("\x72\157\x6c\145"), ["\x31", "\x34"]), "\x72\165\x6e\156\x69\156\x67\137\x74\145\x78\164" => $this->dashboardModel->getRunningText(), "\x67\165\x72\165\x73" => $this->dropdownModel->getAllGuru(), "\x6b\145\x6c\141\x73" => $this->dropdownModel->getAllKodeKelas($_0x84c9->id_tp ?? null, $_0xa7e6->id_smt ?? null)];
 goto L_ce643;
 L_3357e:
 $_0x59fb["\x63\157\x6d\155\x65\156\x74\163\x5f\144\x61\164\x61"] = $_0xfad0;
 goto L_da880;
 L_3e025:
 $_0xbcdb = \Config\Database::connect();
 goto L_869b5;
 L_e0fe7:
 $_0x9155 = session();
 goto L_7f16c;
 L_50ed2:
 $_0x59fb["\x70\145\x6e\147\x75\155\x75\155\x61\156\x73"] = $_0xa639;
 goto L_3357e;
 L_af725:
 $_0x7897 = $_0xbcdb->table("\x70\157\x73\164\x5f\143\x6f\155\x6d\145\x6e\164\x73")->countAllResults();
 goto L_d53a2;
 L_38738:
 if ($_0x9195 == "\x73\145\x6d\165\x61\137\x67\165\x72\165") {
 $_0x59fb["\x6b\145\x70\141\x64\141"] = "\x53\145\x6d\165\x61\40\x47\165\x72\165";
 } elseif ($_0x9195 == "\x73\145\x6d\165\x61\137\x73\151\x73\167\x61") {
 $_0x59fb["\x6b\145\x70\141\x64\141"] = "\x53\145\x6d\165\x61\40\x53\151\x73\167\x61";
 } else {
 $_0x59fb["\x6b\145\x70\141\x64\141"] = urldecode($_0x9195 ?? '');
 }
 goto L_8df2b;
 L_1d868:
 if (!in_array((string) $_0x9155->get("\x72\157\x6c\145"), ["\x31", "\x32", "\x34"])) {
 return redirect()->to("\x64\141\x73\150\x62\157\x61\162\x64")->with("\x65\162\x72\157\x72", "\x48\141\x6e\171\x61\40\x41\144\x6d\151\x6e\151\x73\164\x72\141\x74\157\x72\40\x64\141\x6e\40\x67\165\x72\165\x20\171\x61\156\x67\40\x64\151\x62\145\x72\151\x20\150\x61\153\x20\165\x6e\164\x75\153\x20\155\x65\156\x67\141\x6b\163\x65\163\x20\150\x61\154\x61\155\x61\156\x20\151\x6e\151\x2e");
 }
 goto L_3e025;
 L_18942:
 $_0xa639 = $_0x442d->get()->getResult();
 goto L_7e315;
 }
 public function getPost($_0xa0c2 = 0)
 {
 goto L_408e2;
 L_aca93:
 $_0xd0bc = $_0x7e95->table("\x70\157\x73\164\x20\141");
 goto L_ab8d7;
 L_ab8d7:
 $_0xd0bc->select("\x61\56\x2a\54\x20\142\x2e\156\x61\155\x61\137\x67\165\x72\165\x2c\40\x62\56\x66\157\x74\157\x2c\40\x28\123\x45\114\x45\103\x54\40\x43\117\x55\116\x54\50\x70\157\x73\164\x5f\143\x6f\155\x6d\145\x6e\164\x73\56\x69\144\x5f\143\x6f\155\x6d\145\x6e\164\x29\40\x46\122\x4f\115\x20\160\x6f\163\x74\137\x63\157\x6d\155\x65\156\x74\163\x20\127\x48\105\x52\105\x20\141\x2e\151\x64\137\x70\157\x73\164\x20\75\x20\160\x6f\163\x74\137\x63\157\x6d\155\x65\156\x74\163\x2e\151\x64\137\x70\157\x73\164\x29\40\x41\123\x20\152\x6d\154");
 goto L_a3a58;
 L_42424:
 $_0xd0bc->limit($_0x18f8, $_0x19ab);
 goto L_3fbfc;
 L_a5191:
 return $this->response->setJSON($_0x9977);
 L_3fbfc:
 $_0x9977 = $_0xd0bc->get()->getResult();
 goto L_cb605;
 L_a3a58:
 $_0xd0bc->join("\x6d\141\x73\164\x65\162\x5f\147\x75\162\x75\40\x62", "\x61\56\x64\141\x72\151\x20\75\x20\142\x2e\151\x64\137\x67\165\x72\165", "\x6c\145\x66\164");
 goto L_8b3eb;
 L_cb605:
 $_0x9d22 = rtrim(base_url(), "\x2f") . "\x2f";
 goto L_a1fbd;
 L_408e2:
 $_0x18f8 = 5;
 goto L_840dc;
 L_a1fbd:
 if (count($_0x9977) > 0) {
 foreach ($_0x9977 as $_0x10dc) {
 if ($_0x10dc->dari > 0) {
 $_0x1b30 = FCPATH . ltrim($_0x10dc->foto ?? '', "\x2f");
 $_0x10dc->foto = $_0x10dc->foto && file_exists($_0x1b30) ? $_0x9d22 . ltrim($_0x10dc->foto, "\x2f") : $_0x9d22 . "\x61\163\x73\145\x74\163\x2f\151\x6d\147\x2f\147\x75\162\x75\56\x70\156\x67";
 }
 }
 }
 goto L_a5191;
 L_61c0d:
 $_0x7e95 = \Config\Database::connect();
 goto L_aca93;
 L_840dc:
 $_0x19ab = (int) $_0xa0c2 * $_0x18f8;
 goto L_61c0d;
 L_8b3eb:
 $_0xd0bc->orderBy("\x61\56\x75\160\x64\141\x74\145\x64", "\x64\145\x73\143");
 goto L_42424;
 }
 public function getComments($_0x204f, $_0x2779 = 0)
 {
 return $this->getComment($_0x204f, $_0x2779);
 }
 public function getComment($_0xc92c, $_0xc977 = 0)
 {
 goto L_8ca29;
 L_2f232:
 $_0x1089 = \Config\Database::connect();
 goto L_c22fd;
 L_49df9:
 $_0xb716->where("\x61\56\x69\144\x5f\160\x6f\163\x74", $_0xc92c);
 goto L_44f34;
 L_44f34:
 $_0xb716->orderBy("\x61\56\x74\141\x6e\147\x67\141\x6c", "\x64\145\x73\143");
 goto L_8d48c;
 L_7abd6:
 $_0xb716->select("\x61\56\x2a\54\x20\142\x2e\156\x61\155\x61\137\x67\165\x72\165\x2c\40\x62\56\x66\157\x74\157\x2c\40\x63\56\x6e\141\x6d\141\x20\141\x73\40\x6e\141\x6d\141\x5f\163\x69\163\x77\141\x2c\40\x63\56\x66\157\x74\157\x20\141\x73\40\x66\157\x74\157\x5f\163\x69\163\x77\141\x2c\40\x28\123\x45\114\x45\103\x54\40\x43\117\x55\116\x54\50\x70\157\x73\164\x5f\162\x65\160\x6c\171\x2e\151\x64\137\x72\145\x70\154\x79\51\x20\106\x52\117\x4d\40\x70\157\x73\164\x5f\162\x65\160\x6c\171\x20\127\x48\105\x52\105\x20\141\x2e\151\x64\137\x63\157\x6d\155\x65\156\x74\40\x3d\40\x70\157\x73\164\x5f\162\x65\160\x6c\171\x2e\151\x64\137\x63\157\x6d\155\x65\156\x74\51\x20\101\x53\40\x6a\155\x6c");
 goto L_7cce5;
 L_c515d:
 $_0xb716 = $_0x1089->table("\x70\157\x73\164\x5f\143\x6f\155\x6d\145\x6e\164\x73\40\x61");
 goto L_7abd6;
 L_8d48c:
 $_0xb716->limit($_0xe65b, $_0x591b);
 goto L_26215;
 L_98946:
 return $this->response->setJSON($_0xec7d);
 L_0831b:
 $_0xb716->join("\x6d\141\x73\164\x65\162\x5f\163\x69\163\x77\141\x20\143", "\x61\56\x64\141\x72\151\x3d\143\x2e\151\x64\137\x73\151\x73\167\x61", "\x6c\145\x66\164");
 goto L_49df9;
 L_26215:
 $_0xec7d = $_0xb716->get()->getResult();
 goto L_98946;
 L_7cce5:
 $_0xb716->join("\x6d\141\x73\164\x65\162\x5f\147\x75\162\x75\40\x62", "\x61\56\x64\141\x72\151\x3d\142\x2e\151\x64\137\x67\165\x72\165", "\x6c\145\x66\164");
 goto L_0831b;
 L_9fd05:
 $_0x591b = (int) $_0xc977 * $_0xe65b;
 goto L_2f232;
 L_8ca29:
 $_0xe65b = 5;
 goto L_9fd05;
 L_c22fd:
 $_0x1089->query("\x53\105\x54\40\x53\121\x4c\137\x42\111\x47\137\x53\105\x4c\105\x43\124\x53\75\x31");
 goto L_c515d;
 }
 public function getReplies($_0xd0fe, $_0xf65c)
 {
 goto L_d96e0;
 L_cb049:
 $_0xf1e1->join("\x6d\141\x73\164\x65\162\x5f\163\x69\163\x77\141\x20\143", "\x61\56\x64\141\x72\151\x3d\143\x2e\151\x64\137\x73\151\x73\167\x61", "\x6c\145\x66\164");
 goto L_462cb;
 L_58638:
 $_0xb1c6->query("\x53\105\x54\40\x53\121\x4c\137\x42\111\x47\137\x53\105\x4c\105\x43\124\x53\75\x31");
 goto L_a07bc;
 L_30e66:
 $_0xf1e1->orderBy("\x61\56\x74\141\x6e\147\x67\141\x6c", "\x64\145\x73\143");
 goto L_f4cde;
 L_cb3e0:
 $_0xf1e1->join("\x6d\141\x73\164\x65\162\x5f\147\x75\162\x75\40\x62", "\x61\56\x64\141\x72\151\x3d\142\x2e\151\x64\137\x67\165\x72\165", "\x6c\145\x66\164");
 goto L_cb049;
 L_a07bc:
 $_0xf1e1 = $_0xb1c6->table("\x70\157\x73\164\x5f\162\x65\160\x6c\171\x20\141");
 goto L_c4d7f;
 L_b5a34:
 return $this->response->setJSON($_0xf357);
 L_f4cde:
 $_0xf1e1->limit($_0x4ea2, $_0x57c0);
 goto L_ec343;
 L_a07bb:
 $_0x57c0 = $_0xf65c * $_0x4ea2;
 goto L_03a31;
 L_c4d7f:
 $_0xf1e1->select("\x61\56\x2a\54\x20\142\x2e\156\x61\155\x61\137\x67\165\x72\165\x2c\40\x62\56\x66\157\x74\157\x2c\40\x63\56\x6e\141\x6d\141\x20\141\x73\40\x6e\141\x6d\141\x5f\163\x69\163\x77\141\x2c\40\x63\56\x66\157\x74\157\x20\141\x73\40\x66\157\x74\157\x5f\163\x69\163\x77\141");
 goto L_cb3e0;
 L_462cb:
 $_0xf1e1->where("\x61\56\x69\144\x5f\143\x6f\155\x6d\145\x6e\164", $_0xd0fe);
 goto L_30e66;
 L_d96e0:
 $_0x4ea2 = 5;
 goto L_a07bb;
 L_03a31:
 $_0xb1c6 = \Config\Database::connect();
 goto L_58638;
 L_ec343:
 $_0xf357 = $_0xf1e1->get()->getResult();
 goto L_b5a34;
 }
 public function save()
 {
 goto L_b7d0d;
 L_a11d0:
 $_0xb870 = \Config\Database::connect();
 goto L_390f9;
 L_16bcb:
 $_0x709f = $this->request->getPost("\x64\141\x72\151");
 goto L_1e660;
 L_b7d0d:
 $_0x6c30 = session();
 goto L_51003;
 L_db95a:
 $_0x1e53 = $this->request->getPost("\x6b\145\x70\141\x64\141");
 goto L_36634;
 L_f869e:
 $_0xb870->table("\x70\157\x73\164")->insertBatch($_0xd4f4);
 goto L_32c1d;
 L_c7fcf:
 foreach ($_0x1e53 as $_0x84b9) {
 $_0xd4f4[] = ["\x6b\145\x70\141\x64\141" => $_0x84b9, "\x64\141\x72\151" => $_0x709f, "\x64\141\x72\151\x5f\147\x72\157\x75\160" => $_0xc58a, "\x74\145\x78\164" => $_0xfae6, "\x74\141\x6e\147\x67\141\x6c" => date("\x59\55\x6d\55\x64\40\x48\72\x69\72\x73"), "\x75\160\x64\141\x74\145\x64" => date("\x59\55\x6d\55\x64\40\x48\72\x69\72\x73")];
 }
 goto L_a11d0;
 L_59935:
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => $_0xb870->transStatus()]);
 L_36634:
 $_0xd4f4 = [];
 goto L_c7fcf;
 L_32c1d:
 $_0xb870->transComplete();
 goto L_59935;
 L_1e660:
 $_0xc58a = $_0x6c30->get("\x72\157\x6c\145");
 goto L_db95a;
 L_51003:
 $_0xfae6 = $this->request->getPost("\x74\145\x78\164");
 goto L_16bcb;
 L_390f9:
 $_0xb870->transStart();
 goto L_f869e;
 }
 public function saveKomentar()
 {
 goto L_1ca3d;
 L_413ba:
 $_0xd399 = ["\x69\144\x5f\160\x6f\163\x74" => $_0xe1c7, "\x64\141\x72\151" => $_0x7ed5, "\x64\141\x72\151\x5f\147\x72\157\x75\160" => $_0x9ecd, "\x74\145\x78\164" => $_0x4faf, "\x74\141\x6e\147\x67\141\x6c" => date("\x59\55\x6d\55\x64\40\x48\72\x69\72\x73"), "\x74\171\x70\145" => $_0x79b1];
 goto L_83520;
 L_88a32:
 $_0x7ed5 = $this->request->getPost("\x64\141\x72\151");
 goto L_fd75d;
 L_986e1:
 if (empty($_0x7ed5)) {
 if ($_0x9ecd === 1) {
 $_0x7ed5 = 0;
 } elseif ($_0x9ecd === 2) {
 $_0xd8d0 = $_0x3777->get("\x69\144\x5f\147\x75\162\x75");
 if (empty($_0xd8d0)) {
 $_0x3ffa = $_0x1af9->table("\x6d\141\x73\164\x65\162\x5f\147\x75\162\x75")->where("\x75\163\x65\162\x6e\141\x6d\145", $_0x3777->get("\x75\163\x65\162\x6e\141\x6d\145"))->get()->getRow();
 if (!$_0x3ffa && !empty($_0x3777->get("\x75\163\x65\162\x5f\151\x64"))) {
 $_0x3ffa = $_0x1af9->table("\x6d\141\x73\164\x65\162\x5f\147\x75\162\x75")->where("\x69\144\x5f\165\x73\145\x72", $_0x3777->get("\x75\163\x65\162\x5f\151\x64"))->get()->getRow();
 }
 $_0xd8d0 = $_0x3ffa ? $_0x3ffa->id_guru : 0;
 }
 $_0x7ed5 = $_0xd8d0;
 } elseif ($_0x9ecd === 3) {
 $_0x1a97 = $_0x3777->get("\x69\144\x5f\163\x69\163\x77\141");
 if (empty($_0x1a97)) {
 $_0x9e30 = $_0x1af9->table("\x6d\141\x73\164\x65\162\x5f\163\x69\163\x77\141")->where("\x75\163\x65\162\x6e\141\x6d\145", $_0x3777->get("\x75\163\x65\162\x6e\141\x6d\145"))->orWhere("\x6e\151\x73", $_0x3777->get("\x75\163\x65\162\x6e\141\x6d\145"))->get()->getRow();
 $_0x1a97 = $_0x9e30 ? $_0x9e30->id_siswa : 0;
 }
 $_0x7ed5 = $_0x1a97;
 }
 }
 goto L_413ba;
 L_fd75d:
 $_0x9ecd = (int) ($_0x3777->get("\x72\157\x6c\145") ?? 1);
 goto L_42ec3;
 L_94736:
 $_0x57bd = $_0x1af9->insertID();
 goto L_7f6ed;
 L_83520:
 $_0x1af9->transStart();
 goto L_067d2;
 L_b7064:
 $_0x4faf = $this->request->getPost("\x74\145\x78\164");
 goto L_88a32;
 L_6a65e:
 $_0xe1c7 = $this->request->getPost("\x69\144\x5f\160\x6f\163\x74");
 goto L_b7064;
 L_7f6ed:
 $_0x1af9->transComplete();
 goto L_45975;
 L_067d2:
 $_0xe060 = $_0x1af9->table("\x70\157\x73\164\x5f\143\x6f\155\x6d\145\x6e\164\x73")->insert($_0xd399);
 goto L_94736;
 L_42ec3:
 $_0x79b1 = $this->request->getPost("\x74\171\x70\145") ?: "\x31";
 goto L_070b9;
 L_1ca3d:
 $_0x3777 = session();
 goto L_6a65e;
 L_45975:
 if ($_0xe060) {
 $_0x1af9->query("\x53\105\x54\40\x53\121\x4c\137\x42\111\x47\137\x53\105\x4c\105\x43\124\x53\75\x31");
 $_0xaaa6 = $_0x1af9->table("\x70\157\x73\164\x5f\143\x6f\155\x6d\145\x6e\164\x73\40\x61");
 $_0xaaa6->select("\x61\56\x2a\54\x20\142\x2e\156\x61\155\x61\137\x67\165\x72\165\x2c\40\x62\56\x66\157\x74\157\x2c\40\x63\56\x6e\141\x6d\141\x20\141\x73\40\x6e\141\x6d\141\x5f\163\x69\163\x77\141\x2c\40\x63\56\x66\157\x74\157\x20\141\x73\40\x66\157\x74\157\x5f\163\x69\163\x77\141\x2c\40\x28\123\x45\114\x45\103\x54\40\x43\117\x55\116\x54\50\x70\157\x73\164\x5f\162\x65\160\x6c\171\x2e\151\x64\137\x72\145\x70\154\x79\51\x20\106\x52\117\x4d\40\x70\157\x73\164\x5f\162\x65\160\x6c\171\x20\127\x48\105\x52\105\x20\141\x2e\151\x64\137\x63\157\x6d\155\x65\156\x74\40\x3d\40\x70\157\x73\164\x5f\162\x65\160\x6c\171\x2e\151\x64\137\x63\157\x6d\155\x65\156\x74\51\x20\101\x53\40\x6a\155\x6c");
 $_0xaaa6->join("\x6d\141\x73\164\x65\162\x5f\147\x75\162\x75\40\x62", "\x61\56\x64\141\x72\151\x3d\142\x2e\151\x64\137\x67\165\x72\165", "\x6c\145\x66\164");
 $_0xaaa6->join("\x6d\141\x73\164\x65\162\x5f\163\x69\163\x77\141\x20\143", "\x61\56\x64\141\x72\151\x3d\143\x2e\151\x64\137\x73\151\x73\167\x61", "\x6c\145\x66\164");
 $_0xaaa6->where("\x61\56\x69\144\x5f\143\x6f\155\x6d\145\x6e\164", $_0x57bd);
 $_0x5e59 = $_0xaaa6->get()->getRow();
 if ($_0x5e59 && !isset($_0x5e59->jml)) {
 $_0x5e59->jml = 0;
 }
 return $this->response->setJSON($_0x5e59 ? [$_0x5e59] : []);
 } else {
 return $this->response->setJSON([]);
 }
 L_070b9:
 $_0x1af9 = \Config\Database::connect();
 goto L_986e1;
 }
 public function saveBalasan()
 {
 goto L_a6b2f;
 L_2e645:
 $_0x7388->transComplete();
 goto L_442c1;
 L_c6562:
 $_0x3252 = $this->request->getPost("\x64\141\x72\151");
 goto L_01c0b;
 L_4ef83:
 $_0xfa1b = ["\x69\144\x5f\143\x6f\155\x6d\145\x6e\164" => $_0xfcbe, "\x64\141\x72\151" => $_0x3252, "\x64\141\x72\151\x5f\147\x72\157\x75\160" => $_0x19b2, "\x74\145\x78\164" => $_0x2f68, "\x74\141\x6e\147\x67\141\x6c" => date("\x59\55\x6d\55\x64\40\x48\72\x69\72\x73"), "\x74\171\x70\145" => $_0xf778];
 goto L_9c60d;
 L_22023:
 $_0xf778 = $this->request->getPost("\x74\171\x70\145") ?: "\x31";
 goto L_7a5b3;
 L_bf024:
 $_0x2f68 = $this->request->getPost("\x74\145\x78\164");
 goto L_c6562;
 L_b799c:
 if (empty($_0x3252)) {
 if ($_0x19b2 === 1) {
 $_0x3252 = 0;
 } elseif ($_0x19b2 === 2) {
 $_0xdf5a = $_0xd99e->get("\x69\144\x5f\147\x75\162\x75");
 if (empty($_0xdf5a)) {
 $_0x3f1d = $_0x7388->table("\x6d\141\x73\164\x65\162\x5f\147\x75\162\x75")->where("\x75\163\x65\162\x6e\141\x6d\145", $_0xd99e->get("\x75\163\x65\162\x6e\141\x6d\145"))->get()->getRow();
 if (!$_0x3f1d && !empty($_0xd99e->get("\x75\163\x65\162\x5f\151\x64"))) {
 $_0x3f1d = $_0x7388->table("\x6d\141\x73\164\x65\162\x5f\147\x75\162\x75")->where("\x69\144\x5f\165\x73\145\x72", $_0xd99e->get("\x75\163\x65\162\x5f\151\x64"))->get()->getRow();
 }
 $_0xdf5a = $_0x3f1d ? $_0x3f1d->id_guru : 0;
 }
 $_0x3252 = $_0xdf5a;
 } elseif ($_0x19b2 === 3) {
 $_0x8379 = $_0xd99e->get("\x69\144\x5f\163\x69\163\x77\141");
 if (empty($_0x8379)) {
 $_0x905f = $_0x7388->table("\x6d\141\x73\164\x65\162\x5f\163\x69\163\x77\141")->where("\x75\163\x65\162\x6e\141\x6d\145", $_0xd99e->get("\x75\163\x65\162\x6e\141\x6d\145"))->orWhere("\x6e\151\x73", $_0xd99e->get("\x75\163\x65\162\x6e\141\x6d\145"))->get()->getRow();
 $_0x8379 = $_0x905f ? $_0x905f->id_siswa : 0;
 }
 $_0x3252 = $_0x8379;
 }
 }
 goto L_4ef83;
 L_79b88:
 $_0xc088 = $_0x7388->insertID();
 goto L_2e645;
 L_7a5b3:
 $_0x7388 = \Config\Database::connect();
 goto L_b799c;
 L_3a74c:
 $_0x8e9b = $_0x7388->table("\x70\157\x73\164\x5f\162\x65\160\x6c\171")->insert($_0xfa1b);
 goto L_79b88;
 L_a6b2f:
 $_0xd99e = session();
 goto L_aeec1;
 L_01c0b:
 $_0x19b2 = (int) ($_0xd99e->get("\x72\157\x6c\145") ?? 1);
 goto L_22023;
 L_aeec1:
 $_0xfcbe = $this->request->getPost("\x69\144\x5f\143\x6f\155\x6d\145\x6e\164");
 goto L_bf024;
 L_442c1:
 if ($_0x8e9b) {
 $_0xc45d = $_0x7388->table("\x70\157\x73\164\x5f\162\x65\160\x6c\171\x20\141");
 $_0xc45d->select("\x61\56\x2a\54\x20\142\x2e\156\x61\155\x61\137\x67\165\x72\165\x2c\40\x62\56\x66\157\x74\157\x2c\40\x63\56\x6e\141\x6d\141\x20\141\x73\40\x6e\141\x6d\141\x5f\163\x69\163\x77\141\x2c\40\x63\56\x66\157\x74\157\x20\141\x73\40\x66\157\x74\157\x5f\163\x69\163\x77\141");
 $_0xc45d->join("\x6d\141\x73\164\x65\162\x5f\147\x75\162\x75\40\x62", "\x61\56\x64\141\x72\151\x3d\142\x2e\151\x64\137\x67\165\x72\165", "\x6c\145\x66\164");
 $_0xc45d->join("\x6d\141\x73\164\x65\162\x5f\163\x69\163\x77\141\x20\143", "\x61\56\x64\141\x72\151\x3d\143\x2e\151\x64\137\x73\151\x73\167\x61", "\x6c\145\x66\164");
 $_0xc45d->where("\x61\56\x69\144\x5f\162\x65\160\x6c\171", $_0xc088);
 $_0x3914 = $_0xc45d->get()->getRow();
 return $this->response->setJSON($_0x3914 ? [$_0x3914] : []);
 } else {
 return $this->response->setJSON([]);
 }
 L_9c60d:
 $_0x7388->transStart();
 goto L_3a74c;
 }
 public function hapusPost($_0xc93e)
 {
 goto L_e214b;
 L_dd905:
 $_0x7402->transComplete();
 goto L_dc890;
 L_6ef02:
 $_0x3e27["\x70\157\x73\164"] = $_0x7402->table("\x70\157\x73\164")->where("\x69\144\x5f\160\x6f\163\x74", $_0xc93e)->delete();
 goto L_a6592;
 L_0ccc4:
 $_0x7402->transStart();
 goto L_af01b;
 L_e214b:
 $_0x7402 = \Config\Database::connect();
 goto L_0ccc4;
 L_a6592:
 $_0x5b84 = $this->postModel->getIdComments($_0xc93e);
 goto L_aed5c;
 L_aed5c:
 if (count($_0x5b84) > 0) {
 $_0xd1bf = [];
 foreach ($_0x5b84 as $_0x4007) {
 $_0xd1bf[] = $_0x4007->id_comment;
 }
 $_0xdff0 = $this->postModel->getIdReplies($_0xd1bf);
 if (count($_0xdff0) > 0) {
 $_0x209b = [];
 foreach ($_0xdff0 as $_0x31ab) {
 $_0x209b[] = $_0x31ab->id_reply;
 }
 $_0x3e27["\x72\145\x70\154\x79"] = $_0x7402->table("\x70\157\x73\164\x5f\162\x65\160\x6c\171")->whereIn("\x69\144\x5f\162\x65\160\x6c\171", $_0x209b)->delete();
 }
 $_0x3e27["\x63\157\x6d\155\x65\156\x74"] = $_0x7402->table("\x70\157\x73\164\x5f\143\x6f\155\x6d\145\x6e\164\x73")->whereIn("\x69\144\x5f\143\x6f\155\x6d\145\x6e\164", $_0xd1bf)->delete();
 }
 goto L_dd905;
 L_dc890:
 return $this->response->setJSON($_0x3e27);
 L_af01b:
 $_0x3e27 = [];
 goto L_6ef02;
 }
 public function hapusKomentar($_0xa722)
 {
 goto L_9f753;
 L_9c5d6:
 return $this->response->setJSON($_0x30fc);
 L_c3820:
 $_0x30fc["\x63\157\x6d\155\x65\156\x74"] = $_0x8e0d->table("\x70\157\x73\164\x5f\143\x6f\155\x6d\145\x6e\164\x73")->where("\x69\144\x5f\143\x6f\155\x6d\145\x6e\164", $_0xa722)->delete();
 goto L_a96ec;
 L_a96ec:
 $_0x4dda = $this->postModel->getIdReplies($_0xa722);
 goto L_6e1b9;
 L_6a5b1:
 $_0x8e0d->transStart();
 goto L_35c81;
 L_35c81:
 $_0x30fc = [];
 goto L_c3820;
 L_9f753:
 $_0x8e0d = \Config\Database::connect();
 goto L_6a5b1;
 L_6f95f:
 $_0x8e0d->transComplete();
 goto L_9c5d6;
 L_6e1b9:
 if (count($_0x4dda) > 0) {
 $_0x806b = [];
 foreach ($_0x4dda as $_0x9361) {
 $_0x806b[] = $_0x9361->id_reply;
 }
 $_0x30fc["\x72\145\x70\154\x79"] = $_0x8e0d->table("\x70\157\x73\164\x5f\162\x65\160\x6c\171")->whereIn("\x69\144\x5f\162\x65\160\x6c\171", $_0x806b)->delete();
 }
 goto L_6f95f;
 }
 public function hapusBalasan($_0xfcb2)
 {
 goto L_92012;
 L_946bd:
 $_0xfe67->transStart();
 goto L_4287b;
 L_4287b:
 $_0x148f = [];
 goto L_982e0;
 L_1bd4d:
 $_0xfe67->transComplete();
 goto L_9df26;
 L_9df26:
 return $this->response->setJSON($_0x148f);
 L_92012:
 $_0xfe67 = \Config\Database::connect();
 goto L_946bd;
 L_982e0:
 $_0x148f["\x62\141\x6c\141\x73\141\x6e"] = $_0xfe67->table("\x70\157\x73\164\x5f\162\x65\160\x6c\171")->where("\x69\144\x5f\162\x65\160\x6c\171", $_0xfcb2)->delete();
 goto L_1bd4d;
 }
 public function getRunningText()
 {
 $_0xf99f["\x72\165\x6e\156\x69\156\x67\137\x74\145\x78\164"] = $this->dashboardModel->getRunningText();
 return $this->response->setJSON($_0xf99f);
 }
 public function saveRunningText()
 {
 goto L_8faf7;
 L_b8418:
 $_0x80d6 = \Config\Database::connect();
 goto L_76262;
 L_f12a0:
 $_0xc79d = [];
 goto L_b8418;
 L_e18de:
 if ($_0x3e3e) {
 foreach ($_0x3e3e as $_0x8bd4) {
 $_0x90ee = ["\x74\145\x78\164" => isset($_0x8bd4->text) ? trim($_0x8bd4->text) : ''];
 $_0xdfc8 = $_0x80d6->table("\x72\165\x6e\156\x69\156\x67\137\x74\145\x78\164")->where("\x69\144\x5f\164\x65\170\x74", $_0x8bd4->id_text)->countAllResults();
 if ($_0xdfc8 > 0) {
 $_0xea66 = $_0x80d6->table("\x72\165\x6e\156\x69\156\x67\137\x74\145\x78\164")->where("\x69\144\x5f\164\x65\170\x74", $_0x8bd4->id_text)->update($_0x90ee);
 } else {
 $_0x90ee["\x69\144\x5f\164\x65\170\x74"] = $_0x8bd4->id_text;
 $_0xea66 = $_0x80d6->table("\x72\165\x6e\156\x69\156\x67\137\x74\145\x78\164")->insert($_0x90ee);
 }
 $_0xc79d[] = true;
 }
 }
 goto L_995ae;
 L_e4667:
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => true, "\x73\165\x63\143\x65\163\x73" => true, "\x6d\145\x73\163\x61\147\x65" => "\x52\165\x6e\156\x69\156\x67\40\x74\145\x78\164\x20\142\x65\162\x68\141\x73\151\x6c\40\x64\151\x73\151\x6d\160\x61\156"]);
 L_98730:
 $_0xd2fb = json_decode($this->request->getPost("\x64\145\x6c\145\x74\145\x64"));
 goto L_7cdf4;
 L_8faf7:
 $_0x3e3e = json_decode($this->request->getPost("\x74\145\x78\164"));
 goto L_f12a0;
 L_995ae:
 $_0xd94f = [];
 goto L_98730;
 L_76262:
 // Ensure table exists
 $_0x80d6->query("\x43\122\x45\101\x54\105\x20\124\x41\102\x4c\105\x20\111\x46\40\x4e\117\x54\40\x45\130\x49\123\x54\123\x20\140\x72\165\x6e\156\x69\156\x67\137\x74\145\x78\164\x60\40\x28\12\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x60\151\x64\137\x74\145\x78\164\x60\40\x69\156\x74\40\x4e\117\x54\40\x4e\125\x4c\114\x20\101\x55\124\x4f\137\x49\116\x43\122\x45\115\x45\116\x54\54\xa\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\140\x74\145\x78\164\x60\40\x76\141\x72\143\x68\141\x72\50\x32\65\x35\51\x20\103\x48\101\x52\101\x43\124\x45\122\x20\123\x45\124\x20\165\x74\146\x38\155\x62\64\x20\103\x4f\114\x4c\101\x54\105\x20\165\x74\146\x38\155\x62\64\x5f\147\x65\156\x65\162\x61\154\x5f\143\x69\40\x44\105\x46\101\x55\114\x54\40\x4e\125\x4c\114\x2c\12\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x50\122\x49\115\x41\122\x59\40\x4b\105\x59\40\x28\140\x69\144\x5f\164\x65\170\x74\140\x29\40\x55\123\x49\116\x47\40\x42\124\x52\105\x45\12\x20\40\x20\40\x20\40\x20\40\x29\40\x45\116\x47\111\x4e\105\x3d\111\x6e\156\x6f\104\x42\40\x44\105\x46\101\x55\114\x54\40\x43\110\x41\122\x53\105\x54\75\x75\164\x66\70\x6d\142\x34\40\x43\117\x4c\114\x41\124\x45\75\x75\164\x66\70\x6d\142\x34\137\x67\145\x6e\145\x72\141\x6c\137\x63\151");
 goto L_e18de;
 L_7cdf4:
 if ($_0xd2fb) {
 foreach ($_0xd2fb as $_0x3aac) {
 $_0xd94f[] = $_0x80d6->table("\x72\165\x6e\156\x69\156\x67\137\x74\145\x78\164")->where("\x69\144\x5f\164\x65\170\x74", $_0x3aac)->delete();
 }
 }
 goto L_e4667;
 }
}