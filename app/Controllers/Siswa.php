<?php
/*   ________________________________________
    |               NextGen Garuda CBT       |
    |    Protected & Distributed via GitHub  |
    |________________________________________|
*/
namespace App\Controllers;

use App\Models\DashboardModel;
use App\Models\CbtModel;
class Siswa extends BaseController
{
 protected $dashboardModel;
 protected $cbtModel;
 public function __construct()
 {
 $this->dashboardModel = new DashboardModel();
 $this->cbtModel = new CbtModel();
 }
 /**
 * Ambil pengumuman/post untuk siswa
 */
 public function getpost()
 {
 goto L_a826f;
 L_701ac:
 $_0xdef1 = $this->request->getGet("\x6b\145\x6c\141\x73");
 goto L_92a27;
 L_e0fb2:
 $_0xd7ad = (int) $_0x3ab2 * $_0x3794;
 goto L_03c5d;
 L_cfeb8:
 $_0x3a9c->groupStart()->like("\x61\56\x6b\145\x70\141\x64\141", "\x33")->orLike("\x61\56\x6b\145\x70\141\x64\141", "\x61\154\x6c")->orLike("\x61\56\x6b\145\x70\141\x64\141", (string) $_0xdef1)->groupEnd();
 goto L_b29ea;
 L_03c5d:
 $_0xb5c3 = \Config\Database::connect();
 goto L_ea1fb;
 L_a826f:
 $_0x3ab2 = $this->request->getGet("\x68\141\x6c\141\x6d\141\x6e") ?? 0;
 goto L_701ac;
 L_6e628:
 $_0x3a9c->select("\x61\56\x2a\54\x20\142\x2e\156\x61\155\x61\137\x67\165\x72\165\x2c\40\x62\56\x66\157\x74\157\x2c\40\x28\123\x45\114\x45\103\x54\40\x43\117\x55\116\x54\50\x70\157\x73\164\x5f\143\x6f\155\x6d\145\x6e\164\x73\56\x69\144\x5f\143\x6f\155\x6d\145\x6e\164\x29\40\x46\122\x4f\115\x20\160\x6f\163\x74\137\x63\157\x6d\155\x65\156\x74\163\x20\127\x48\105\x52\105\x20\141\x2e\151\x64\137\x70\157\x73\164\x20\75\x20\160\x6f\163\x74\137\x63\157\x6d\155\x65\156\x74\163\x2e\151\x64\137\x70\157\x73\164\x29\40\x41\123\x20\152\x6d\154");
 goto L_2d70b;
 L_4db26:
 $_0x3a9c->limit($_0x3794, $_0xd7ad);
 goto L_f7809;
 L_b29ea:
 $_0x3a9c->orderBy("\x61\56\x75\160\x64\141\x74\145\x64", "\x64\145\x73\143");
 goto L_4db26;
 L_f7809:
 $_0x76a7 = $_0x3a9c->get()->getResult();
 goto L_bd76c;
 L_2d70b:
 $_0x3a9c->join("\x6d\141\x73\164\x65\162\x5f\147\x75\162\x75\40\x62", "\x61\56\x64\141\x72\151\x20\75\x20\142\x2e\151\x64\137\x67\165\x72\165", "\x6c\145\x66\164");
 goto L_cfeb8;
 L_ea1fb:
 $_0x3a9c = $_0xb5c3->table("\x70\157\x73\164\x20\141");
 goto L_6e628;
 L_bd76c:
 $_0xf8f2 = rtrim(base_url(), "\x2f") . "\x2f";
 goto L_bcaab;
 L_cc653:
 return $this->response->setJSON($_0x76a7);
 L_bcaab:
 if (count($_0x76a7) > 0) {
 foreach ($_0x76a7 as $_0x9ed1) {
 if ($_0x9ed1->dari > 0) {
 $_0xde0d = FCPATH . ltrim($_0x9ed1->foto ?? '', "\x2f");
 $_0x9ed1->foto = $_0x9ed1->foto && file_exists($_0xde0d) ? $_0xf8f2 . ltrim($_0x9ed1->foto, "\x2f") : $_0xf8f2 . "\x61\163\x73\145\x74\163\x2f\151\x6d\147\x2f\147\x75\162\x75\56\x70\156\x67";
 }
 }
 }
 goto L_cc653;
 L_92a27:
 $_0x3794 = 5;
 goto L_e0fb2;
 }
 /**
 * Ambil komentar berdasarkan id_post
 */
 public function getComment($_0x8b70, $_0x6525 = 0)
 {
 return $this->getComments($_0x8b70, $_0x6525);
 }
 public function getComments($_0x657e, $_0x8b2b = 0)
 {
 goto L_aeef7;
 L_902d2:
 $_0x8c96->orderBy("\x61\56\x74\141\x6e\147\x67\141\x6c", "\x64\145\x73\143");
 goto L_51668;
 L_7e976:
 $_0x8c96 = $_0xccb1->table("\x70\157\x73\164\x5f\143\x6f\155\x6d\145\x6e\164\x73\40\x61");
 goto L_18a9b;
 L_11822:
 $_0x8c96->limit($_0x44d2, $_0xba08);
 goto L_20e1d;
 L_18a9b:
 $_0x8c96->select("\x61\56\x2a\54\x20\142\x2e\156\x61\155\x61\137\x67\165\x72\165\x2c\40\x62\56\x66\157\x74\157\x2c\40\x63\56\x6e\141\x6d\141\x20\141\x73\40\x6e\141\x6d\141\x5f\163\x69\163\x77\141\x2c\40\x63\56\x66\157\x74\157\x20\141\x73\40\x66\157\x74\157\x5f\163\x69\163\x77\141\x2c\40\x28\123\x45\114\x45\103\x54\40\x43\117\x55\116\x54\50\x70\157\x73\164\x5f\162\x65\160\x6c\171\x2e\151\x64\137\x72\145\x70\154\x79\51\x20\106\x52\117\x4d\40\x70\157\x73\164\x5f\162\x65\160\x6c\171\x20\127\x48\105\x52\105\x20\141\x2e\151\x64\137\x63\157\x6d\155\x65\156\x74\40\x3d\40\x70\157\x73\164\x5f\162\x65\160\x6c\171\x2e\151\x64\137\x63\157\x6d\155\x65\156\x74\51\x20\101\x53\40\x6a\155\x6c");
 goto L_4dd25;
 L_23822:
 $_0xccb1 = \Config\Database::connect();
 goto L_c4cd3;
 L_20e1d:
 $_0xe8d6 = $_0x8c96->get()->getResult();
 goto L_4fd25;
 L_51668:
 $_0x8c96->where("\x61\56\x69\144\x5f\160\x6f\163\x74", $_0x657e);
 goto L_11822;
 L_4fd25:
 return $this->response->setJSON($_0xe8d6);
 L_aeef7:
 $_0x44d2 = 10;
 goto L_2d2eb;
 L_4dd25:
 $_0x8c96->join("\x6d\141\x73\164\x65\162\x5f\147\x75\162\x75\40\x62", "\x61\56\x64\141\x72\151\x3d\142\x2e\151\x64\137\x67\165\x72\165", "\x6c\145\x66\164");
 goto L_f325e;
 L_f325e:
 $_0x8c96->join("\x6d\141\x73\164\x65\162\x5f\163\x69\163\x77\141\x20\143", "\x61\56\x64\141\x72\151\x3d\143\x2e\151\x64\137\x73\151\x73\167\x61", "\x6c\145\x66\164");
 goto L_902d2;
 L_2d2eb:
 $_0xba08 = (int) $_0x8b2b * $_0x44d2;
 goto L_23822;
 L_c4cd3:
 $_0xccb1->query("\x53\105\x54\40\x53\121\x4c\137\x42\111\x47\137\x53\105\x4c\105\x43\124\x53\75\x31");
 goto L_7e976;
 }
 /**
 * Ambil balasan komentar berdasarkan id_comment
 */
 public function getReplies($_0x3a5b, $_0x390f)
 {
 goto L_d7746;
 L_d3263:
 return $this->response->setJSON($_0x3b69);
 L_1b579:
 $_0x4ed8->select("\x61\56\x2a\54\x20\142\x2e\156\x61\155\x61\137\x67\165\x72\165\x2c\40\x62\56\x66\157\x74\157\x2c\40\x63\56\x6e\141\x6d\141\x20\141\x73\40\x6e\141\x6d\141\x5f\163\x69\163\x77\141\x2c\40\x63\56\x66\157\x74\157\x20\141\x73\40\x66\157\x74\157\x5f\163\x69\163\x77\141");
 goto L_ee2fc;
 L_ee2fc:
 $_0x4ed8->join("\x6d\141\x73\164\x65\162\x5f\147\x75\162\x75\40\x62", "\x61\56\x64\141\x72\151\x3d\142\x2e\151\x64\137\x67\165\x72\165", "\x6c\145\x66\164");
 goto L_9dd7e;
 L_9dd7e:
 $_0x4ed8->join("\x6d\141\x73\164\x65\162\x5f\163\x69\163\x77\141\x20\143", "\x61\56\x64\141\x72\151\x3d\143\x2e\151\x64\137\x73\151\x73\167\x61", "\x6c\145\x66\164");
 goto L_60686;
 L_3bf7e:
 $_0x4ed8 = $_0xeff4->table("\x70\157\x73\164\x5f\162\x65\160\x6c\171\x20\141");
 goto L_1b579;
 L_ee11b:
 $_0x82cf = (int) $_0x390f * $_0xf6f6;
 goto L_102dc;
 L_ce4ef:
 $_0x4ed8->where("\x61\56\x69\144\x5f\143\x6f\155\x6d\145\x6e\164", $_0x3a5b);
 goto L_7b0ef;
 L_7b0ef:
 $_0x4ed8->limit($_0xf6f6, $_0x82cf);
 goto L_5a788;
 L_102dc:
 $_0xeff4 = \Config\Database::connect();
 goto L_ef00e;
 L_ef00e:
 $_0xeff4->query("\x53\105\x54\40\x53\121\x4c\137\x42\111\x47\137\x53\105\x4c\105\x43\124\x53\75\x31");
 goto L_3bf7e;
 L_60686:
 $_0x4ed8->orderBy("\x61\56\x74\141\x6e\147\x67\141\x6c", "\x64\145\x73\143");
 goto L_ce4ef;
 L_d7746:
 $_0xf6f6 = 5;
 goto L_ee11b;
 L_5a788:
 $_0x3b69 = $_0x4ed8->get()->getResult();
 goto L_d3263;
 }
 /**
 * Simpan komentar dari siswa
 */
 public function saveKomentar()
 {
 goto L_5343a;
 L_4c395:
 $_0x7e95 = \Config\Database::connect();
 goto L_cc361;
 L_943fa:
 $_0x3eb2->where("\x61\56\x69\144\x5f\143\x6f\155\x6d\145\x6e\164", $_0x44d6);
 goto L_6c62e;
 L_8de95:
 $_0x7e95->query("\x53\105\x54\40\x53\121\x4c\137\x42\111\x47\137\x53\105\x4c\105\x43\124\x53\75\x31");
 goto L_99b91;
 L_f4852:
 $_0x3eb2->orderBy("\x61\56\x74\141\x6e\147\x67\141\x6c", "\x64\145\x73\143");
 goto L_943fa;
 L_cc361:
 $_0x7e95->table("\x70\157\x73\164\x5f\143\x6f\155\x6d\145\x6e\164\x73")->insert($_0x7b60);
 goto L_bfa4f;
 L_6f7df:
 $_0x3eb2->select("\x61\56\x2a\54\x20\142\x2e\156\x61\155\x61\137\x67\165\x72\165\x2c\40\x62\56\x66\157\x74\157\x2c\40\x63\56\x6e\141\x6d\141\x20\141\x73\40\x6e\141\x6d\141\x5f\163\x69\163\x77\141\x2c\40\x63\56\x66\157\x74\157\x20\141\x73\40\x66\157\x74\157\x5f\163\x69\163\x77\141\x2c\40\x28\123\x45\114\x45\103\x54\40\x43\117\x55\116\x54\50\x70\157\x73\164\x5f\162\x65\160\x6c\171\x2e\151\x64\137\x72\145\x70\154\x79\51\x20\106\x52\117\x4d\40\x70\157\x73\164\x5f\162\x65\160\x6c\171\x20\127\x48\105\x52\105\x20\141\x2e\151\x64\137\x63\157\x6d\155\x65\156\x74\40\x3d\40\x70\157\x73\164\x5f\162\x65\160\x6c\171\x2e\151\x64\137\x63\157\x6d\155\x65\156\x74\51\x20\101\x53\40\x6a\155\x6c");
 goto L_5c2ad;
 L_5343a:
 $_0x4d6d = session();
 goto L_cc338;
 L_1417d:
 return $this->response->setJSON($_0xa33c);
 L_82829:
 $_0xe2d7 = $this->dashboardModel->getSemesterActive();
 goto L_84b27;
 L_501d1:
 $_0x3eb2->join("\x6d\141\x73\164\x65\162\x5f\163\x69\163\x77\141\x20\143", "\x61\56\x64\141\x72\151\x3d\143\x2e\151\x64\137\x73\151\x73\167\x61", "\x6c\145\x66\164");
 goto L_f4852;
 L_4af64:
 $_0x7ab3 = 3;
 goto L_c1d13;
 L_5c2ad:
 $_0x3eb2->join("\x6d\141\x73\164\x65\162\x5f\147\x75\162\x75\40\x62", "\x61\56\x64\141\x72\151\x3d\142\x2e\151\x64\137\x67\165\x72\165", "\x6c\145\x66\164");
 goto L_501d1;
 L_15053:
 $_0xae32 = $this->cbtModel->getDataSiswa($_0xb14e, $_0xfd7e->id_tp, $_0xe2d7->id_smt);
 goto L_82845;
 L_82845:
 if (!$_0xae32) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x44\141\x74\141\x20\163\x69\163\x77\141\x20\164\x69\144\x61\153\x20\144\x69\164\x65\155\x75\153\x61\156"]);
 }
 goto L_dec4c;
 L_c1d13:
 $_0x7b60 = ["\x74\171\x70\145" => "\x31", "\x69\144\x5f\160\x6f\163\x74" => $this->request->getPost("\x69\144\x5f\160\x6f\163\x74"), "\x64\141\x72\151" => $_0xcf37, "\x64\141\x72\151\x5f\147\x72\157\x75\160" => $_0x7ab3, "\x74\145\x78\164" => $this->request->getPost("\x74\145\x78\164"), "\x74\141\x6e\147\x67\141\x6c" => date("\x59\55\x6d\55\x64\40\x48\72\x69\72\x73")];
 goto L_4c395;
 L_cc338:
 $_0xfd7e = $this->dashboardModel->getTahunActive();
 goto L_82829;
 L_6c62e:
 $_0xa33c = $_0x3eb2->get()->getResult();
 goto L_1417d;
 L_99b91:
 $_0x3eb2 = $_0x7e95->table("\x70\157\x73\164\x5f\143\x6f\155\x6d\145\x6e\164\x73\40\x61");
 goto L_6f7df;
 L_bfa4f:
 $_0x44d6 = $_0x7e95->insertID();
 goto L_8de95;
 L_84b27:
 $_0xb14e = $_0x4d6d->get("\x75\163\x65\162\x6e\141\x6d\145") ?? '';
 goto L_15053;
 L_dec4c:
 $_0xcf37 = $_0xae32->id_siswa;
 goto L_4af64;
 }
 /**
 * Simpan balasan komentar dari siswa
 */
 public function saveBalasan()
 {
 goto L_05c23;
 L_45409:
 $_0x5bae = $_0xc011->get()->getResult();
 goto L_5ff8e;
 L_5ff8e:
 return $this->response->setJSON($_0x5bae);
 L_ae884:
 $_0xc011->join("\x6d\141\x73\164\x65\162\x5f\163\x69\163\x77\141\x20\143", "\x61\56\x64\141\x72\151\x3d\143\x2e\151\x64\137\x73\151\x73\167\x61", "\x6c\145\x66\164");
 goto L_69fc1;
 L_aa951:
 $_0xc011->join("\x6d\141\x73\164\x65\162\x5f\147\x75\162\x75\40\x62", "\x61\56\x64\141\x72\151\x3d\142\x2e\151\x64\137\x67\165\x72\165", "\x6c\145\x66\164");
 goto L_ae884;
 L_1261d:
 $_0xe61e = $this->cbtModel->getDataSiswa($_0xf962, $_0xb552->id_tp, $_0xda91->id_smt);
 goto L_83f5b;
 L_86ff1:
 $_0x197f = $_0xe61e->id_siswa;
 goto L_43f8e;
 L_0777b:
 $_0x6c3d = $_0x28cf->insertID();
 goto L_c6224;
 L_c21db:
 $_0xda91 = $this->dashboardModel->getSemesterActive();
 goto L_d724a;
 L_72b70:
 $_0xc011->where("\x61\56\x69\144\x5f\162\x65\160\x6c\171", $_0x6c3d);
 goto L_45409;
 L_43f8e:
 $_0x329f = 3;
 goto L_875c8;
 L_735c4:
 $_0xc011->select("\x61\56\x2a\54\x20\142\x2e\156\x61\155\x61\137\x67\165\x72\165\x2c\40\x62\56\x66\157\x74\157\x2c\40\x63\56\x6e\141\x6d\141\x20\141\x73\40\x6e\141\x6d\141\x5f\163\x69\163\x77\141\x2c\40\x63\56\x66\157\x74\157\x20\141\x73\40\x66\157\x74\157\x5f\163\x69\163\x77\141");
 goto L_aa951;
 L_83f5b:
 if (!$_0xe61e) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x44\141\x74\141\x20\163\x69\163\x77\141\x20\164\x69\144\x61\153\x20\144\x69\164\x65\155\x75\153\x61\156"]);
 }
 goto L_86ff1;
 L_c6224:
 $_0x28cf->query("\x53\105\x54\40\x53\121\x4c\137\x42\111\x47\137\x53\105\x4c\105\x43\124\x53\75\x31");
 goto L_0bd12;
 L_875c8:
 $_0x5a3d = ["\x69\144\x5f\143\x6f\155\x6d\145\x6e\164" => $this->request->getPost("\x69\144\x5f\143\x6f\155\x6d\145\x6e\164"), "\x64\141\x72\151" => $_0x197f, "\x64\141\x72\151\x5f\147\x72\157\x75\160" => $_0x329f, "\x74\145\x78\164" => $this->request->getPost("\x74\145\x78\164"), "\x74\141\x6e\147\x67\141\x6c" => date("\x59\55\x6d\55\x64\40\x48\72\x69\72\x73")];
 goto L_b21bc;
 L_2301f:
 $_0x28cf->table("\x70\157\x73\164\x5f\162\x65\160\x6c\171")->insert($_0x5a3d);
 goto L_0777b;
 L_0bd12:
 $_0xc011 = $_0x28cf->table("\x70\157\x73\164\x5f\162\x65\160\x6c\171\x20\141");
 goto L_735c4;
 L_05c23:
 $_0x7bf0 = session();
 goto L_0e383;
 L_d724a:
 $_0xf962 = $_0x7bf0->get("\x75\163\x65\162\x6e\141\x6d\145") ?? '';
 goto L_1261d;
 L_69fc1:
 $_0xc011->orderBy("\x61\56\x74\141\x6e\147\x67\141\x6c", "\x64\145\x73\143");
 goto L_72b70;
 L_0e383:
 $_0xb552 = $this->dashboardModel->getTahunActive();
 goto L_c21db;
 L_b21bc:
 $_0x28cf = \Config\Database::connect();
 goto L_2301f;
 }
 /**
 * Upload file oleh siswa (CI4 style)
 */
 public function uploadFile()
 {
 goto L_d9355;
 L_c8030:
 $_0xe9c3 = $this->request->getFile("\x66\151\x6c\145\x5f\165\x70\154\x6f\141\x64\163");
 goto L_d771f;
 L_d9355:
 $_0xd071 = $this->request->getPost("\x6d\141\x78\55\x73\151\x7a\145") ?: 2048;
 goto L_c8030;
 L_62848:
 $_0xf6c5 = FCPATH . "\x75\160\x6c\157\x61\144\x73\57\x66\151\x6c\145\x5f\163\x69\163\x77\141\x2f";
 goto L_08e34;
 L_08e34:
 if (!is_dir($_0xf6c5)) {
 mkdir($_0xf6c5, 0777, true);
 }
 goto L_186dc;
 L_d771f:
 if (!$_0xe9c3 || !$_0xe9c3->isValid()) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x73\162\x63" => "\x46\151\x6c\145\x20\164\x69\144\x61\153\x20\166\x61\154\x69\144\x20\141\x74\141\x75\40\x74\151\x64\141\x6b\40\x61\144\x61\40\x66\151\x6c\145\x20\171\x61\156\x67\40\x64\151\x75\160\x6c\157\x61\144\x2e"]);
 }
 goto L_d194e;
 L_d204b:
 $_0xbe05 = strtolower($_0xe9c3->getClientExtension());
 goto L_01faa;
 L_186dc:
 $_0xc266 = $_0xe9c3->getRandomName();
 goto L_0150a;
 L_d194e:
 $_0xbd6d = ["\x6a\160\x67", "\x6a\160\x65\147", "\x70\156\x67", "\x67\151\x66", "\x6d\160\x65\147", "\x6d\160\x67", "\x6d\160\x33", "\x77\141\x76", "\x6d\160\x34", "\x61\166\x69", "\x64\157\x63", "\x64\157\x63\170", "\x78\154\x73", "\x78\154\x73\170", "\x70\160\x74", "\x70\160\x74\170", "\x63\163\x76", "\x70\144\x66", "\x72\164\x66", "\x74\170\x74"];
 goto L_d204b;
 L_01faa:
 if (!in_array($_0xbe05, $_0xbd6d)) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x73\162\x63" => "\x54\151\x70\145\x20\146\x69\154\x65\40\x74\151\x64\141\x6b\40\x64\151\x69\172\x69\156\x6b\141\x6e\56"]);
 }
 goto L_37bb8;
 L_df623:
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => true, "\x73\162\x63" => "\x75\160\x6c\157\x61\144\x73\57\x66\151\x6c\145\x5f\163\x69\163\x77\141\x2f" . $_0xc266, "\x66\151\x6c\145\x6e\141\x6d\145" => pathinfo($_0xc266, PATHINFO_FILENAME), "\x74\171\x70\145" => $_0xe9c3->getClientMimeType(), "\x73\151\x7a\145" => $_0xe9c3->getSize()]);
 L_37bb8:
 if ($_0xe9c3->getSize() > $_0xd071 * 1024) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x73\162\x63" => "\x55\153\x75\162\x61\156\x20\146\x69\154\x65\40\x6d\145\x6c\145\x62\151\x68\151\x20\142\x61\164\x61\163\x20\155\x61\153\x73\151\x6d\165\x6d\56"]);
 }
 goto L_62848;
 L_0150a:
 $_0xe9c3->move($_0xf6c5, $_0xc266);
 goto L_df623;
 }
 /**
 * Hapus file yang diupload siswa
 */
 public function deleteFile()
 {
 goto L_5ea79;
 L_5ea79:
 $_0x9c9e = $this->request->getPost("\x73\162\x63");
 goto L_8bf18;
 L_8bf18:
 $_0xb399 = FCPATH . $_0x9c9e;
 goto L_23182;
 L_23182:
 if ($_0x9c9e && file_exists($_0xb399)) {
 unlink($_0xb399);
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => true]);
 }
 goto L_e0135;
 L_e0135:
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false]);
 }
 /**
 * Halaman perpustakaan digital siswa (alias)
 */
 public function perpustakaan()
 {
 return $this->perpus();
 }
 /**
 * Halaman perpustakaan digital siswa
 */
 public function perpus()
 {
 return redirect()->to(base_url("\x73\151\x73\167\x61"));
 }
 /**
 * Halaman catatan siswa dari guru
 */
 public function catatan()
 {
 goto L_c2379;
 L_2d830:
 $_0x4326 = ["\x75\163\x65\162" => ["\x66\151\x72\163\x74\137\x6e\141\x6d\145" => $_0x62eb->get("\x75\163\x65\162\x6e\141\x6d\145"), "\x72\157\x6c\145\x5f\156\x61\155\x65" => $_0x62eb->get("\x72\157\x6c\145\x5f\156\x61\155\x65"), "\x66\157\x74\157" => $_0x62eb->get("\x66\157\x74\157") ?? ''], "\x73\151\x73\167\x61" => $_0xd428, "\x6a\165\x64\165\x6c" => "\x43\141\x74\141\x74\141\x6e", "\x73\165\x62\152\x75\144\x75\154" => "\x43\141\x74\141\x74\141\x6e\40\x44\141\x72\151\x20\107\x75\162\x75", "\x73\145\x74\164\x69\156\x67" => $this->dashboardModel->getSetting(), "\x74\160" => $this->dashboardModel->getTahun(), "\x74\160\x5f\141\x63\164\x69\166\x65" => $_0x1e6d, "\x73\155\x74" => $this->dashboardModel->getSemester(), "\x73\155\x74\137\x61\143\x74\151\x76\145" => $_0x9fa0, "\x63\141\x74\141\x74\141\x6e" => $_0x29ad, "\x72\165\x6e\156\x69\156\x67\137\x74\145\x78\164" => $this->dashboardModel->getRunningText()];
 goto L_8c9e3;
 L_8c9e3:
 return view("\x6d\145\x6d\142\x65\162\x73\57\x73\151\x73\167\x61\57\x63\141\x74\141\x74\141\x6e\57\x64\141\x74\141", $_0x4326);
 L_fec00:
 $_0xf4f7 = \Config\Database::connect();
 goto L_f4dab;
 L_f4dab:
 // Catatan dari mapel
 $_0x6e2e = $_0xf4f7->table("\x6b\145\x6c\141\x73\137\x63\141\x74\141\x74\141\x6e\137\x6d\141\x70\145\x6c\40\x6d")->select("\x6d\56\x2a\54\x20\147\x2e\156\x61\155\x61\137\x67\165\x72\165\x2c\40\x67\56\x66\157\x74\157\x2c\40\x67\56\x6e\151\x70")->join("\x6d\141\x73\164\x65\162\x5f\147\x75\162\x75\40\x67", "\x6d\56\x69\144\x5f\147\x75\162\x75\40\x3d\40\x67\56\x69\144\x5f\147\x75\162\x75", "\x6c\145\x66\164")->where("\x6d\56\x69\144\x5f\153\x65\154\x61\163", $_0xd428->id_kelas)->where("\x6d\56\x69\144\x5f\164\x70", $_0x1e6d->id_tp)->where("\x6d\56\x69\144\x5f\163\x6d\164", $_0x9fa0->id_smt)->get()->getResult();
 goto L_6ebe9;
 L_e6d8b:
 $_0x1e6d = $this->dashboardModel->getTahunActive();
 goto L_3848a;
 L_9f67d:
 foreach ($_0xe54c as $_0x29ec) {
 if ($_0x29ec->type == "\x32" && $_0x29ec->id_siswa == $_0xd428->id_siswa || $_0x29ec->type == "\x31" && $_0x29ec->id_kelas == $_0xd428->id_kelas) {
 $_0x29ad[] = ["\x69\144\x5f\143\x61\164\x61\164\x61\156" => $_0x29ec->id_catatan, "\x6e\141\x6d\141\x5f\147\x75\162\x75" => $_0x29ec->nama_guru, "\x66\157\x74\157\x5f\147\x75\162\x75" => $_0x29ec->foto && file_exists(FCPATH . $_0x29ec->foto) ? $_0x29ec->foto : "\x75\160\x6c\157\x61\144\x73\57\x70\162\x6f\146\x69\154\x65\163\x2f" . $_0x29ec->nip . "\x2e\152\x70\147", "\x69\144\x5f\163\x69\163\x77\141" => $_0xd428->id_siswa, "\x74\147\x6c" => $_0x29ec->tgl, "\x74\141\x62\154\x65" => "\x77\141\x6c\151", "\x6c\145\x76\145\x6c" => $_0x29ec->level, "\x74\171\x70\145" => $_0x29ec->type, "\x72\145\x61\144\x65\144" => $_0x29ec->readed, "\x72\145\x61\144\x69\156\x67" => $this->maybe_unserialize($_0x29ec->reading ?? '')];
 }
 }
 goto L_cd8c9;
 L_5bbc9:
 if (!$_0xd428) {
 return redirect()->to("\x64\141\x73\150\x62\157\x61\162\x64")->with("\x65\162\x72\157\x72", "\x44\141\x74\141\x20\163\x69\163\x77\141\x20\164\x69\144\x61\153\x20\144\x69\164\x65\155\x75\153\x61\156");
 }
 goto L_fec00;
 L_ee530:
 $_0x29ad = [];
 goto L_1f836;
 L_1a99c:
 if (!$_0x62eb->get("\x69\163\x5f\154\x6f\147\x69\156")) {
 return redirect()->to("\x61\165\x74\150\x2f\154\x6f\147\x69\156");
 }
 goto L_e6d8b;
 L_b3788:
 $_0xd428 = $this->cbtModel->getDataSiswa($_0xb288, $_0x1e6d->id_tp, $_0x9fa0->id_smt);
 goto L_5bbc9;
 L_649fa:
 $_0xb288 = $_0x62eb->get("\x75\163\x65\162\x6e\141\x6d\145") ?? '';
 goto L_b3788;
 L_3848a:
 $_0x9fa0 = $this->dashboardModel->getSemesterActive();
 goto L_649fa;
 L_c2379:
 $_0x62eb = session();
 goto L_1a99c;
 L_6ebe9:
 // Catatan dari wali kelas
 $_0xe54c = $_0xf4f7->table("\x6b\145\x6c\141\x73\137\x63\141\x74\141\x74\141\x6e\137\x77\141\x6c\151\x20\167")->select("\x77\56\x2a\54\x20\147\x2e\156\x61\155\x61\137\x67\165\x72\165\x2c\40\x67\56\x66\157\x74\157\x2c\40\x67\56\x6e\151\x70")->join("\x6a\141\x62\141\x74\141\x6e\137\x67\165\x72\165\x20\152", "\x6a\56\x69\144\x5f\153\x65\154\x61\163\x20\75\x20\167\x2e\151\x64\137\x6b\145\x6c\141\x73", "\x6c\145\x66\164")->join("\x6d\141\x73\164\x65\162\x5f\147\x75\162\x75\40\x67", "\x6a\56\x69\144\x5f\147\x75\162\x75\40\x3d\40\x67\56\x69\144\x5f\147\x75\162\x75", "\x6c\145\x66\164")->where("\x77\56\x69\144\x5f\153\x65\154\x61\163", $_0xd428->id_kelas)->where("\x77\56\x69\144\x5f\164\x70", $_0x1e6d->id_tp)->where("\x77\56\x69\144\x5f\163\x6d\164", $_0x9fa0->id_smt)->get()->getResult();
 goto L_ee530;
 L_cd8c9:
 usort($_0x29ad, function ($_0x1327, $_0x6155) {
 return strtotime($_0x6155["\x74\147\x6c"]) - strtotime($_0x1327["\x74\147\x6c"]);
 });
 goto L_2d830;
 L_1f836:
 foreach ($_0x6e2e as $_0x29ec) {
 if ($_0x29ec->type == "\x32" && $_0x29ec->id_siswa == $_0xd428->id_siswa || $_0x29ec->type == "\x31" && $_0x29ec->id_kelas == $_0xd428->id_kelas) {
 $_0x29ad[] = ["\x69\144\x5f\143\x61\164\x61\164\x61\156" => $_0x29ec->id_catatan, "\x6e\141\x6d\141\x5f\147\x75\162\x75" => $_0x29ec->nama_guru, "\x66\157\x74\157\x5f\147\x75\162\x75" => $_0x29ec->foto && file_exists(FCPATH . $_0x29ec->foto) ? $_0x29ec->foto : "\x75\160\x6c\157\x61\144\x73\57\x70\162\x6f\146\x69\154\x65\163\x2f" . $_0x29ec->nip . "\x2e\152\x70\147", "\x69\144\x5f\163\x69\163\x77\141" => $_0xd428->id_siswa, "\x74\147\x6c" => $_0x29ec->tgl, "\x74\141\x62\154\x65" => "\x6d\141\x70\145\x6c", "\x6c\145\x76\145\x6c" => $_0x29ec->level, "\x74\171\x70\145" => $_0x29ec->type, "\x72\145\x61\144\x65\144" => $_0x29ec->readed, "\x72\145\x61\144\x69\156\x67" => $this->maybe_unserialize($_0x29ec->reading ?? '')];
 }
 }
 goto L_9f67d;
 }
 /**
 * Detail catatan siswa
 */
 public function detailCatatan($_0xd3c6, $_0xe23b)
 {
 goto L_c26be;
 L_9708e:
 $_0xe978 = $this->dashboardModel->getTahunActive();
 goto L_dc37f;
 L_87ff6:
 $_0x6520 = $_0xd3c6 === "\x6d\141\x70\145\x6c" ? "\x6b\145\x6c\141\x73\137\x63\141\x74\141\x74\141\x6e\137\x6d\141\x70\145\x6c" : "\x6b\145\x6c\141\x73\137\x63\141\x74\141\x74\141\x6e\137\x77\141\x6c\151";
 goto L_22c9e;
 L_dc37f:
 $_0x18df = $this->dashboardModel->getSemesterActive();
 goto L_bdd39;
 L_aaf34:
 return $this->response->setJSON(["\x72\145\x61\144\x69\156\x67" => $_0xf32f, "\x64\145\x74\141\x69\154" => $_0xe8a7]);
 L_22c9e:
 $_0xe8a7 = $_0xe45a->table($_0x6520)->where("\x69\144\x5f\143\x61\164\x61\164\x61\156", $_0xe23b)->get()->getRow();
 goto L_6bfdd;
 L_c26be:
 $_0x50dd = session();
 goto L_9708e;
 L_2187e:
 if ($_0xe8a7 && $_0x4aab) {
 $_0xe8a7->id_siswa = $_0x4aab->id_siswa;
 $_0xf32f = $_0xe8a7->reading != null ? $this->maybe_unserialize($_0xe8a7->reading ?? '') : [];
 }
 goto L_aaf34;
 L_87d86:
 $_0xe45a = \Config\Database::connect();
 goto L_87ff6;
 L_6bfdd:
 $_0xf32f = [];
 goto L_2187e;
 L_bdd39:
 $_0x55d7 = $_0x50dd->get("\x75\163\x65\162\x6e\141\x6d\145") ?? '';
 goto L_b7f47;
 L_b7f47:
 $_0x4aab = $this->cbtModel->getDataSiswa($_0x55d7, $_0xe978->id_tp, $_0x18df->id_smt);
 goto L_87d86;
 }
 /**
 * Tandai catatan sudah dibaca
 */
 public function readed($_0xcd57, $_0x12a4)
 {
 goto L_13f4d;
 L_03dbe:
 $_0xe2b8 = $_0xcd57 === "\x6d\141\x70\145\x6c" ? "\x6b\145\x6c\141\x73\137\x63\141\x74\141\x74\141\x6e\137\x6d\141\x70\145\x6c" : "\x6b\145\x6c\141\x73\137\x63\141\x74\141\x74\141\x6e\137\x77\141\x6c\151";
 goto L_42839;
 L_a6093:
 $_0xdda9 = $_0xc068->readed == "\x30" ? date("\x59\55\x6d\55\x64\40\x48\72\x69\72\x73") : "\x30";
 goto L_4af74;
 L_db19d:
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => (bool) $_0x8454]);
 L_8d0d8:
 $_0x4470 = $this->cbtModel->getDataSiswa($_0x5b0c, $_0xeef2->id_tp, $_0x8131->id_smt);
 goto L_03dbe;
 L_be641:
 $_0x8131 = $this->dashboardModel->getSemesterActive();
 goto L_50c82;
 L_50c82:
 $_0x5b0c = $_0x598c->get("\x75\163\x65\162\x6e\141\x6d\145") ?? '';
 goto L_8d0d8;
 L_4af74:
 if ($_0xc068->type == "\x31" && $_0x4470) {
 $_0x1dc6 = $this->maybe_unserialize($_0xc068->reading ?? '');
 if (!is_array($_0x1dc6)) {
 $_0x1dc6 = [];
 }
 if (!in_array($_0x4470->id_siswa, $_0x1dc6)) {
 $_0x1dc6[] = $_0x4470->id_siswa;
 }
 $_0x8454 = $_0x736f->table($_0xe2b8)->where("\x69\144\x5f\143\x61\164\x61\164\x61\156", $_0x12a4)->update(["\x72\145\x61\144\x69\156\x67" => json_encode($_0x1dc6)]);
 } else {
 $_0x8454 = $_0x736f->table($_0xe2b8)->where("\x69\144\x5f\143\x61\164\x61\164\x61\156", $_0x12a4)->update(["\x72\145\x61\144\x65\144" => $_0xdda9]);
 }
 goto L_db19d;
 L_05f58:
 if (!$_0xc068) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false]);
 }
 goto L_a6093;
 L_13f4d:
 $_0x598c = session();
 goto L_10511;
 L_10511:
 $_0xeef2 = $this->dashboardModel->getTahunActive();
 goto L_be641;
 L_42839:
 $_0x736f = \Config\Database::connect();
 goto L_8ce55;
 L_8ce55:
 $_0xc068 = $_0x736f->table($_0xe2b8)->where("\x69\144\x5f\143\x61\164\x61\164\x61\156", $_0x12a4)->get()->getRow();
 goto L_05f58;
 }
 /**
 * Ambil timer CBT siswa
 */
 public function getTimer($_0x7301, $_0xa992)
 {
 $_0x7f2c["\x64\165\x72\141\x73\151"] = $this->cbtModel->getDurasiSiswa($_0x7301 . "\x30" . $_0xa992);
 return $this->response->setJSON($_0x7f2c);
 }
 /**
 * Helper: hitung total hari tertentu dalam satu bulan
 */
 protected function total_hari($_0xf793, $_0x7f40, $_0x524c)
 {
 goto L_c9f12;
 L_12fcf:
 $_0x32a4 = $_0xf793 == "\x37" ? 0 : $_0xf793;
 goto L_320f4;
 L_320f4:
 for ($_0xf356 = 1; $_0xf356 <= $_0xe6b3; $_0xf356++) {
 if (date("\x4e", strtotime($_0x524c . "\x2d" . $_0x7f40 . "\x2d" . $_0xf356)) == $_0x32a4) {
 $_0xc628++;
 $_0x3a99[] = date("\x59\55\x6d\55\x64", strtotime($_0x524c . "\x2d" . $_0x7f40 . "\x2d" . $_0xf356));
 }
 }
 goto L_0217f;
 L_0217f:
 return $_0x3a99;
 L_5e1b0:
 $_0x3a99 = [];
 goto L_f7e6a;
 L_c9f12:
 $_0xc628 = 0;
 goto L_5e1b0;
 L_f7e6a:
 $_0xe6b3 = date("\x74", strtotime("{$_0x524c}-{$_0x7f40}-01"));
 goto L_12fcf;
 }
 /**
 * Helper: unserialize data (PHP serialize atau JSON)
 */
 protected function maybe_unserialize($_0x8e98)
 {
 goto L_5edd5;
 L_a1c20:
 $_0x668a = @unserialize($_0x8e98);
 goto L_17939;
 L_e21a6:
 return $_0x8e98;
 L_5edd5:
 if (is_array($_0x8e98)) {
 return $_0x8e98;
 }
 goto L_a1c20;
 L_64d4a:
 $_0xda90 = json_decode($_0x8e98, true);
 goto L_c952d;
 L_c952d:
 if (json_last_error() === JSON_ERROR_NONE) {
 return $_0xda90;
 }
 goto L_e21a6;
 L_17939:
 if ($_0x668a !== false) {
 return $_0x668a;
 }
 goto L_64d4a;
 }
 /**
 * Endpoint untuk mengambil jumlah notifikasi aktif siswa (Ujian, Tugas, Pengumuman)
 */
 public function get_badge_notifikasi()
 {
 goto L_6d095;
 L_f664f:
 $_0x61b7->groupStart()->like("\x61\56\x6b\145\x70\141\x64\141", "\x33")->orLike("\x61\56\x6b\145\x70\141\x64\141", "\x61\154\x6c");
 goto L_08674;
 L_19de3:
 $_0x8ee0 = $this->dashboardModel->getTahunActive();
 goto L_4b89f;
 L_964fd:
 // ==========================================
 // 1. HITUNG UJIAN AKTIF (YANG BELUM SELESAI)
 // ==========================================
 if ($_0x3089) {
 $_0x130f = $_0xe1f3->table("\x63\142\x74\137\x6a\141\x64\167\x61\154\x20\152")->select("\x6a\56\x69\144\x5f\152\x61\144\x77\141\x6c\54\x20\152\x2e\164\x67\154\x5f\155\x75\154\x61\151\x2c\40\x6a\56\x74\147\x6c\137\x73\145\x6c\145\x73\141\x69\54\x20\142\x2e\142\x61\156\x6b\137\x6b\145\x6c\141\x73\54\x20\142\x2e\142\x61\156\x6b\137\x6c\145\x76\145\x6c\54\x20\142\x2e\163\x6f\141\x6c\137\x61\147\x61\155\x61")->join("\x63\142\x74\137\x62\141\x6e\153\x5f\163\x6f\141\x6c\40\x62", "\x62\56\x69\144\x5f\142\x61\156\x6b\40\x3d\40\x6a\56\x69\144\x5f\142\x61\156\x6b", "\x69\156\x6e\145\x72")->where("\x6a\56\x69\144\x5f\164\x70", $_0xafba)->where("\x6a\56\x69\144\x5f\163\x6d\164", $_0x60b5)->where("\x6a\56\x73\164\x61\164\x75\163", "\x31")->where("\x62\56\x73\164\x61\164\x75\163", "\x31")->where("\x44\101\x54\105\x28\152\x2e\164\x67\154\x5f\155\x75\154\x61\151\x29\40\x3c\75", $_0xb53e)->where("\x44\101\x54\105\x28\152\x2e\164\x67\154\x5f\163\x65\154\x65\163\x61\151\x29\40\x3e\75", $_0xb53e);
 if (!empty($_0x431a)) {
 $_0x130f->groupStart()->where("\x62\56\x62\141\x6e\153\x5f\154\x65\166\x65\154", $_0x431a)->orWhere("\x62\56\x62\141\x6e\153\x5f\154\x65\166\x65\154", "\x30")->orWhere("\x62\56\x62\141\x6e\153\x5f\154\x65\166\x65\154", '')->groupEnd();
 }
 $_0xf4de = $_0x130f->get()->getResult();
 if (!empty($_0xf4de)) {
 $_0x4d62 = array_column($_0xe1f3->table("\x63\142\x74\137\x73\151\x73\167\x61")->select("\x69\144\x5f\152\x61\144\x77\141\x6c")->where("\x69\144\x5f\163\x69\163\x77\141", $_0x722d)->where("\x73\145\x6c\145\x73\141\x69\40\x49\123\x20\116\x4f\124\x20\116\x55\114\x4c")->get()->getResultArray(), "\x69\144\x5f\152\x61\144\x77\141\x6c");
 $_0xbdfb = array_flip($_0x4d62);
 foreach ($_0xf4de as $_0x1f33) {
 if (isset($_0xbdfb[$_0x1f33->id_jadwal])) {
 continue;
 }
 if (!empty($_0x1f33->soal_agama) && $_0x1f33->soal_agama !== "\x2d" && $_0x1f33->soal_agama !== "\x30") {
 if (strtolower(trim($_0x1f33->soal_agama)) !== strtolower(trim($_0x6b11->agama ?? ''))) {
 continue;
 }
 }
 $_0x839e = !empty($_0x1f33->bank_kelas) ? $_0x1f33->bank_kelas : '';
 $_0xef0d = is_array($_0x839e) ? $_0x839e : @unserialize($_0x839e);
 if (!$_0xef0d && !empty($_0x839e)) {
 $_0xef0d = json_decode($_0x839e, true) ?: [];
 }
 $_0xbb69 = [];
 if (is_array($_0xef0d)) {
 foreach ($_0xef0d as $_0xf916) {
 if (is_object($_0xf916)) {
 $_0xbb69[] = (string) ($_0xf916->kelas_id ?? '');
 } elseif (is_array($_0xf916)) {
 $_0xbb69[] = (string) ($_0xf916["\x6b\145\x6c\141\x73\137\x69\144"] ?? '');
 } else {
 $_0xbb69[] = (string) $_0xf916;
 }
 }
 }
 $_0xbb69 = array_filter($_0xbb69);
 if (empty($_0xbb69) || in_array("\x30", $_0xbb69, true) || in_array((string) $_0x3089, $_0xbb69, true)) {
 $_0xb8b2++;
 }
 }
 }
 }
 goto L_28d10;
 L_c9cc3:
 if (!$_0x6b11) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x75\152\x69\141\x6e" => 0, "\x74\165\x67\141\x73" => 0, "\x70\145\x6e\147\x75\155\x75\155\x61\156" => 0]);
 }
 goto L_536f5;
 L_ef5cd:
 $_0x61b7->select("\x43\117\x55\116\x54\50\x61\56\x69\144\x5f\160\x6f\163\x74\51\x20\141\x73\40\x74\157\x74\141\x6c");
 goto L_f664f;
 L_4b89f:
 $_0xfc66 = $this->dashboardModel->getSemesterActive();
 goto L_947d6;
 L_210f0:
 if ($_0xb886 === 0) {
 $_0x3c6d = $_0xe1f3->table("\x70\157\x73\164\x20\141")->select("\x43\117\x55\116\x54\50\x61\56\x69\144\x5f\160\x6f\163\x74\51\x20\141\x73\40\x74\157\x74\141\x6c");
 $_0x3c6d->groupStart()->like("\x61\56\x6b\145\x70\141\x64\141", "\x33")->orLike("\x61\56\x6b\145\x70\141\x64\141", "\x61\154\x6c");
 if ($_0x3089) {
 $_0x3c6d->orLike("\x61\56\x6b\145\x70\141\x64\141", (string) $_0x3089);
 }
 $_0x3c6d->groupEnd();
 $_0x2022 = $_0x3c6d->get()->getRow();
 $_0xb886 = min((int) ($_0x2022->total ?? 0), 1);
 }
 goto L_7d26d;
 L_1589a:
 $_0xb886 = (int) ($_0x6769->total ?? 0);
 goto L_210f0;
 L_b489d:
 $_0x431a = $_0x2868->level_id ?? null;
 goto L_93af2;
 L_08674:
 if ($_0x3089) {
 $_0x61b7->orLike("\x61\56\x6b\145\x70\141\x64\141", (string) $_0x3089);
 }
 goto L_d523b;
 L_89d04:
 // Ambil kelas siswa di tahun & semester aktif
 $_0x2868 = $_0xe1f3->table("\x6b\145\x6c\141\x73\137\x73\151\x73\167\x61\40\x6b\163")->select("\x6b\163\x2e\151\x64\137\x6b\145\x6c\141\x73\54\x20\153\x2e\154\x65\166\x65\154\x5f\151\x64\54\x20\153\x2e\153\x6f\144\x65\137\x6b\145\x6c\141\x73")->join("\x6d\141\x73\164\x65\162\x5f\153\x65\154\x61\163\x20\153", "\x6b\56\x69\144\x5f\153\x65\154\x61\163\x20\75\x20\153\x73\56\x69\144\x5f\153\x65\154\x61\163", "\x6c\145\x66\164")->where(["\x6b\163\x2e\151\x64\137\x73\151\x73\167\x61" => $_0x722d, "\x6b\163\x2e\151\x64\137\x74\160" => $_0xafba, "\x6b\163\x2e\151\x64\137\x73\155\x74" => $_0x60b5])->get()->getRow();
 goto L_a1d86;
 L_7d26d:
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => true, "\x75\152\x69\141\x6e" => $_0xb8b2, "\x74\165\x67\141\x73" => $_0xa5b7, "\x70\145\x6e\147\x75\155\x75\155\x61\156" => $_0xb886]);
 L_bff45:
 // ==========================================
 // 3. HITUNG PENGUMUMAN BARU / AKTIF
 // ==========================================
 $_0x61b7 = $_0xe1f3->table("\x70\157\x73\164\x20\141");
 goto L_ef5cd;
 L_b43fe:
 $_0x60b5 = $_0xfc66->id_smt ?? 0;
 goto L_e60d6;
 L_1e3ab:
 $_0xe1f3 = \Config\Database::connect();
 goto L_19de3;
 L_947d6:
 $_0xafba = $_0x8ee0->id_tp ?? 0;
 goto L_b43fe;
 L_d523b:
 $_0x61b7->groupEnd();
 goto L_4ebd3;
 L_28d10:
 // ==========================================
 // 2. HITUNG TUGAS AKTIF (YANG BELUM SELESAI - MODEL LMS)
 // ==========================================
 if ($_0x3089) {
 $_0x88ab = $_0xe1f3->table("\x6b\145\x6c\141\x73\137\x6a\141\x64\167\x61\154\x5f\155\x61\164\x65\162\x69\40\x6b\152\x6d")->select("\x6b\152\x6d\56\x69\144\x5f\153\x6a\155\x2c\40\x6b\152\x6d\56\x6a\141\x64\167\x61\154\x5f\155\x61\164\x65\162\x69")->join("\x6b\145\x6c\141\x73\137\x6d\141\x74\145\x72\151\x20\153\x6d", "\x6b\155\x2e\151\x64\137\x6d\141\x74\145\x72\151\x20\75\x20\153\x6a\155\x2e\151\x64\137\x6d\141\x74\145\x72\151\x20\101\x4e\104\x20\153\x6d\56\x73\164\x61\164\x75\163\x20\75\x20\61", "\x69\156\x6e\145\x72")->where("\x6b\152\x6d\56\x69\144\x5f\153\x65\154\x61\163", $_0x3089)->where("\x6b\152\x6d\56\x6a\145\x6e\151\x73", "\x32")->where("\x6b\155\x2e\151\x64\137\x74\160", $_0xafba)->where("\x6b\155\x2e\151\x64\137\x73\155\x74", $_0x60b5)->get()->getResult();
 if (!empty($_0x88ab)) {
 $_0x64cf = array_column($_0x88ab, "\x69\144\x5f\153\x6a\155");
 $_0xf604 = array_column($_0xe1f3->table("\x6c\157\x67\137\x6d\141\x74\145\x72\151")->select("\x69\144\x5f\155\x61\164\x65\162\x69")->where("\x69\144\x5f\163\x69\163\x77\141", $_0x722d)->whereIn("\x69\144\x5f\155\x61\164\x65\162\x69", $_0x64cf)->where("\x66\151\x6e\151\x73\150\x5f\164\x69\155\x65\40\x49\123\x20\116\x4f\124\x20\116\x55\114\x4c")->where("\x75\154\x61\156\x67\40\x21\75", "\x31")->get()->getResultArray(), "\x69\144\x5f\155\x61\164\x65\162\x69");
 $_0xe587 = array_flip($_0xf604);
 foreach ($_0x88ab as $_0x6016) {
 if (!isset($_0xe587[$_0x6016->id_kjm])) {
 $_0xa5b7++;
 }
 }
 }
 }
 goto L_bff45;
 L_4ebd3:
 $_0x22f5 = date("\x59\55\x6d\55\x64\40\x48\72\x69\72\x73", strtotime("\x2d\67\x20\144\x61\171\x73"));
 goto L_951d0;
 L_f66ab:
 // Cari data siswa
 $_0x6b11 = null;
 goto L_8e718;
 L_37158:
 if (!$_0x6b11 && $_0x8145 !== '') {
 $_0x6b11 = $_0xe1f3->table("\x6d\141\x73\164\x65\162\x5f\163\x69\163\x77\141")->groupStart()->where("\x75\163\x65\162\x6e\141\x6d\145", $_0x8145)->orWhere("\x6e\151\x73", $_0x8145)->orWhere("\x6e\151\x73\156", $_0x8145)->groupEnd()->get()->getRow();
 }
 goto L_c9cc3;
 L_35a58:
 $_0xa5b7 = 0;
 goto L_57e03;
 L_20b4b:
 $_0xb53e = date("\x59\55\x6d\55\x64");
 goto L_964fd;
 L_57e03:
 $_0xb886 = 0;
 goto L_20b4b;
 L_a1d86:
 $_0x3089 = $_0x2868->id_kelas ?? null;
 goto L_b489d;
 L_ca062:
 $_0x8145 = trim((string) ($_0xa3cb->get("\x75\163\x65\162\x6e\141\x6d\145") ?? ''));
 goto L_f66ab;
 L_3f53d:
 if (!$_0xa3cb->get("\x69\163\x5f\154\x6f\147\x69\156")) {
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => false, "\x75\152\x69\141\x6e" => 0, "\x74\165\x67\141\x73" => 0, "\x70\145\x6e\147\x75\155\x75\155\x61\156" => 0]);
 }
 goto L_1e3ab;
 L_6d0d7:
 $_0x6769 = $_0x61b7->get()->getRow();
 goto L_1589a;
 L_8e718:
 if ($_0x722d > 0) {
 $_0x6b11 = $_0xe1f3->table("\x6d\141\x73\164\x65\162\x5f\163\x69\163\x77\141")->where("\x69\144\x5f\163\x69\163\x77\141", $_0x722d)->get()->getRow();
 }
 goto L_37158;
 L_93af2:
 $_0xb8b2 = 0;
 goto L_35a58;
 L_951d0:
 $_0x61b7->where("\x61\56\x75\160\x64\141\x74\145\x64\40\x3e\75", $_0x22f5);
 goto L_6d0d7;
 L_536f5:
 $_0x722d = (int) $_0x6b11->id_siswa;
 goto L_89d04;
 L_e60d6:
 $_0x722d = (int) ($_0xa3cb->get("\x69\144\x5f\163\x69\163\x77\141") ?? 0);
 goto L_ca062;
 L_6d095:
 $_0xa3cb = session();
 goto L_3f53d;
 }
}