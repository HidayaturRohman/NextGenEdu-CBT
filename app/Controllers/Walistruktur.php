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
use App\Models\DropdownModel;
class Walistruktur extends BaseController
{
 protected $masterModel;
 protected $dashboardModel;
 protected $kelasModel;
 protected $dropdownModel;
 public function __construct()
 {
 goto L_864a0;
 L_84dd5:
 $this->dashboardModel = new DashboardModel();
 goto L_1472c;
 L_864a0:
 $this->masterModel = new MasterModel();
 goto L_84dd5;
 L_1472c:
 $this->kelasModel = new KelasModel();
 goto L_fe213;
 L_fe213:
 $this->dropdownModel = new DropdownModel();
 }
 public function index()
 {
 goto L_9cf0d;
 L_517b1:
 if (!$_0x1df7 || !$_0x1df7->wali_kelas) {
 return redirect()->to("\x64\141\x73\150\x62\157\x61\162\x64")->with("\x65\162\x72\157\x72", "\x41\156\x64\141\x20\142\x75\153\x61\156\x20\167\x61\154\x69\40\x6b\145\x6c\141\x73\56");
 }
 goto L_1283d;
 L_1283d:
 $_0x4740 = ["\x75\163\x65\162" => ["\x66\151\x72\163\x74\137\x6e\141\x6d\145" => $_0xa7c0->get("\x75\163\x65\162\x6e\141\x6d\145"), "\x72\157\x6c\145\x5f\156\x61\155\x65" => $_0xa7c0->get("\x72\157\x6c\145\x5f\156\x61\155\x65"), "\x66\157\x74\157" => $_0xa7c0->get("\x66\157\x74\157") ?? ''], "\x6a\165\x64\165\x6c" => "\x53\164\x72\165\x6b\164\x75\162\x20\117\x72\147\x61\156\x69\163\x61\163\x69", "\x73\165\x62\152\x75\144\x75\154" => "\x53\164\x72\165\x6b\164\x75\162\x20\117\x72\147\x61\156\x69\163\x61\163\x69", "\x73\145\x74\164\x69\156\x67" => $this->dashboardModel->getSetting(), "\x74\160" => $this->dashboardModel->getTahun(), "\x74\160\x5f\141\x63\164\x69\166\x65" => $_0x131b, "\x73\155\x74" => $this->dashboardModel->getSemester(), "\x73\155\x74\137\x61\143\x74\151\x76\145" => $_0xfe73, "\x67\165\x72\165" => $_0x1df7, "\x69\144\x5f\153\x65\154\x61\163" => $_0x1df7->wali_kelas, "\x69\163\x5f\141\x64\155\x69\156" => $_0xa7c0->get("\x72\157\x6c\145") == "\x31"];
 goto L_8ce06;
 L_8ce06:
 $_0xdfb7 = $this->kelasModel->getStrukturKelas($_0x1df7->wali_kelas);
 goto L_d3e8d;
 L_6c94c:
 return view("\x6d\145\x6d\142\x65\162\x73\57\x67\165\x72\165\x2f\167\x61\154\x69\57\x73\164\x72\165\x6b\164\x75\162", $_0x4740);
 L_d3e8d:
 if ($_0xdfb7 == null) {
 $_0x4740["\x73\164\x72\165\x6b\164\x75\162"] = json_decode(json_encode($this->kelasModel->dummyStruktur()));
 } else {
 $_0x4740["\x73\164\x72\165\x6b\164\x75\162"] = $_0xdfb7;
 }
 goto L_1a9cc;
 L_82ec2:
 $_0x4740["\x73\151\x73\167\x61\163"] = $_0xb823;
 goto L_6c94c;
 L_5fa39:
 $_0x131b = $this->dashboardModel->getTahunActive();
 goto L_4c2b7;
 L_c90a0:
 if ($_0xa7c0->get("\x72\157\x6c\145") != "\x31" && $_0xa7c0->get("\x72\157\x6c\145") != "\x32") {
 return redirect()->to("\x64\141\x73\150\x62\157\x61\162\x64")->with("\x65\162\x72\157\x72", "\x48\141\x6e\171\x61\40\x41\144\x6d\151\x6e\151\x73\164\x72\141\x74\157\x72\40\x64\141\x6e\40\x67\165\x72\165\x20\171\x61\156\x67\40\x64\151\x62\145\x72\151\x20\150\x61\153\x20\165\x6e\164\x75\153\x20\155\x65\156\x67\141\x6b\163\x65\163\x20\150\x61\154\x61\155\x61\156\x20\151\x6e\151\x2e");
 }
 goto L_5fa39;
 L_4d463:
 $_0x1df7 = $this->dashboardModel->getDataGuruByUserId($_0xa7c0->get("\x69\144\x5f\165\x73\145\x72"), $_0x131b->id_tp ?? null, $_0xfe73->id_smt ?? null);
 goto L_517b1;
 L_4c2b7:
 $_0xfe73 = $this->dashboardModel->getSemesterActive();
 goto L_4d463;
 L_9b220:
 $_0xeb06 = $this->db->table("\x6b\145\x6c\141\x73\137\x73\151\x73\167\x61\40\x61")->select("\x61\56\x2a\54\x20\142\x2e\156\x61\155\x61\54\x20\142\x2e\156\x69\163\x2c\40\x62\56\x6e\151\x73\156\x2c\40\x62\56\x75\163\x65\162\x6e\141\x6d\145\x2c\40\x62\56\x6a\145\x6e\151\x73\137\x6b\145\x6c\141\x6d\151\x6e\54\x20\143\x2e\156\x61\155\x61\137\x6b\145\x6c\141\x73\54\x20\143\x2e\154\x65\166\x65\154\x5f\151\x64")->join("\x6d\141\x73\164\x65\162\x5f\163\x69\163\x77\141\x20\142", "\x61\56\x69\144\x5f\163\x69\163\x77\141\x3d\142\x2e\151\x64\137\x73\151\x73\167\x61")->join("\x6d\141\x73\164\x65\162\x5f\153\x65\154\x61\163\x20\143", "\x61\56\x69\144\x5f\153\x65\154\x61\163\x3d\143\x2e\151\x64\137\x6b\145\x6c\141\x73")->where("\x61\56\x69\144\x5f\153\x65\154\x61\163", $_0x1df7->wali_kelas)->where("\x61\56\x69\144\x5f\164\x70", $_0x131b->id_tp ?? null)->where("\x61\56\x69\144\x5f\163\x6d\164", $_0xfe73->id_smt ?? null)->orderBy("\x62\56\x6e\141\x6d\141", "\x41\123\x43")->get()->getResult();
 goto L_303c8;
 L_e58bf:
 if (!$_0xa7c0->get("\x69\163\x5f\154\x6f\147\x69\156")) {
 return redirect()->to("\x61\165\x74\150\x2f\154\x6f\147\x69\156");
 }
 goto L_c90a0;
 L_1a9cc:
 $_0x4740["\x67\165\x72\165\x73"] = $this->dropdownModel->getAllGuru();
 goto L_9b220;
 L_9cf0d:
 $_0xa7c0 = session();
 goto L_e58bf;
 L_79ea9:
 if ($_0xeb06) {
 foreach ($_0xeb06 as $_0x6a39 => $_0xfd65) {
 $_0xb823[$_0xfd65->id_siswa] = $_0xfd65->nama;
 }
 }
 goto L_82ec2;
 L_303c8:
 $_0xb823[''] = "\x50\151\x6c\151\x68\40\x53\151\x73\167\x61";
 goto L_79ea9;
 }
 public function save()
 {
 goto L_3147b;
 L_c3eac:
 // MySQL replace INTO equivalent for CodeIgniter 4 query builder
 $_0x4dce = $_0xcbdc->table("\x6b\145\x6c\141\x73\137\x73\164\x72\165\x6b\164\x75\162")->where("\x69\144\x5f\153\x65\154\x61\163", $_0xc79f["\x69\144\x5f\153\x65\154\x61\163"])->get()->getRow();
 goto L_59d26;
 L_3147b:
 $_0xc79f = ["\x69\144\x5f\153\x65\154\x61\163" => $this->request->getPost("\x69\144\x5f\153\x65\154\x61\163"), "\x6b\145\x74\165\x61" => $this->request->getPost("\x6b\145\x74\165\x61"), "\x77\141\x6b\151\x6c\137\x6b\145\x74\165\x61" => $this->request->getPost("\x77\141\x6b\151\x6c\137\x6b\145\x74\165\x61"), "\x73\145\x6b\162\x65\164\x61\162\x69\163\x5f\61" => $this->request->getPost("\x73\145\x6b\162\x65\164\x61\162\x69\163\x5f\61"), "\x73\145\x6b\162\x65\164\x61\162\x69\163\x5f\62" => $this->request->getPost("\x73\145\x6b\162\x65\164\x61\162\x69\163\x5f\62"), "\x62\145\x6e\144\x61\150\x61\162\x61\137\x31" => $this->request->getPost("\x62\145\x6e\144\x61\150\x61\162\x61\137\x31"), "\x62\145\x6e\144\x61\150\x61\162\x61\137\x32" => $this->request->getPost("\x62\145\x6e\144\x61\150\x61\162\x61\137\x32"), "\x73\151\x65\137\x65\153\x73\164\x72\141\x6b\165\x72\151\x6b\165\x6c\145\x72" => $this->request->getPost("\x73\151\x65\137\x65\153\x73\164\x72\141\x6b\165\x72\151\x6b\165\x6c\145\x72"), "\x73\151\x65\137\x75\160\x61\143\x61\162\x61" => $this->request->getPost("\x73\151\x65\137\x75\160\x61\143\x61\162\x61"), "\x73\151\x65\137\x6f\154\x61\150\x72\141\x67\141" => $this->request->getPost("\x73\151\x65\137\x6f\154\x61\150\x72\141\x67\141"), "\x73\151\x65\137\x6b\145\x61\147\x61\155\x61\141\x6e" => $this->request->getPost("\x73\151\x65\137\x6b\145\x61\147\x61\155\x61\141\x6e"), "\x73\151\x65\137\x6b\145\x61\155\x61\156\x61\156" => $this->request->getPost("\x73\151\x65\137\x6b\145\x61\155\x61\156\x61\156"), "\x73\151\x65\137\x6b\145\x74\145\x72\164\x69\142\x61\156" => $this->request->getPost("\x73\151\x65\137\x6b\145\x74\145\x72\164\x69\142\x61\156"), "\x73\151\x65\137\x6b\145\x62\145\x72\163\x69\150\x61\156" => $this->request->getPost("\x73\151\x65\137\x6b\145\x62\145\x72\163\x69\150\x61\156"), "\x73\151\x65\137\x6b\145\x69\156\x64\141\x68\141\x6e" => $this->request->getPost("\x73\151\x65\137\x6b\145\x69\156\x64\141\x68\141\x6e"), "\x73\151\x65\137\x6b\145\x73\145\x68\141\x74\141\x6e" => $this->request->getPost("\x73\151\x65\137\x6b\145\x73\145\x68\141\x74\141\x6e"), "\x73\151\x65\137\x6b\145\x6b\145\x6c\165\x61\162\x67\141\x61\156" => $this->request->getPost("\x73\151\x65\137\x6b\145\x6b\145\x6c\165\x61\162\x67\141\x61\156"), "\x73\151\x65\137\x68\165\x6d\141\x73" => $this->request->getPost("\x73\151\x65\137\x68\165\x6d\141\x73")];
 goto L_153cc;
 L_59d26:
 if ($_0x4dce) {
 $_0x2f33 = $_0xcbdc->table("\x6b\145\x6c\141\x73\137\x73\164\x72\165\x6b\164\x75\162")->where("\x69\144\x5f\153\x65\154\x61\163", $_0xc79f["\x69\144\x5f\153\x65\154\x61\163"])->update($_0xc79f);
 } else {
 $_0x2f33 = $_0xcbdc->table("\x6b\145\x6c\141\x73\137\x73\164\x72\165\x6b\164\x75\162")->insert($_0xc79f);
 }
 goto L_f9a90;
 L_f9a90:
 return $this->response->setJSON($_0x2f33);
 L_153cc:
 $_0xcbdc = \Config\Database::connect();
 goto L_c3eac;
 }
}